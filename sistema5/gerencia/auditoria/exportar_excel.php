<?php

	header("Content-Type: application/vnd.ms-excel");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=reporte_documentos_faltantes.xls");

	include('../../conex_inicial.php'); 
	include('../../contabilidad/model/Mysql.php'); 
	include('../../funciones/funciones.php');
	include('../../contabilidad/model/Sucursal.php'); 
	include('../../contabilidad/model/Operacion.php');

	$sucursal = $_GET['sleSucursal'];
	$documento = $_GET['sleDocumento'];
	$serie = str_pad($_GET['txtSerie'], 3, "0", STR_PAD_LEFT);
	$opcion = $_GET['rdoOpcion'];
	$sleApp = $_GET['sleApp'];

	if($opcion == 'numeros'){

		$serie_inicio = str_pad($_GET['serie_inicio'], 7, "0", STR_PAD_LEFT);
		$serie_termino = str_pad($_GET['serie_termino'], 7, "0", STR_PAD_LEFT);

		$sql1 = "
			CREATE TEMPORARY TABLE mov 
				SELECT cm.cod_ope, cm.serie, cm.Num_doc, cm.sucursal FROM cab_mov cm
				WHERE cm.sucursal = '".$sucursal."'
				AND cm.cod_ope = '".$documento."' 
				AND cm.serie = '".$serie."' ORDER BY cm.Num_doc; ";

		//echo $sql1."<br>";

		$qry = new Consulta($sql1);

		$qry3 = new Consulta("SELECT * FROM mov");
		while( $rw = $qry3->VerRegistro() ){
			$rst_tmp[] = array(
				'Num_doc'	=> $rw['Num_doc']
			);
		}

		//echo count($rst_tmp)."<br>".$rst_tmp[0]['Num_doc']." -> ".$rst_tmp[count($rst_tmp)-1]['Num_doc']."<br>";

		$total_rango = (int)$rst_tmp[count($rst_tmp)-1]['Num_doc'] - (int)$rst_tmp[0]['Num_doc'];

		if($total_rango < 100000){
			if(count($rst_tmp) > 0){

				$sql2 = "
					SELECT auxiliar.otro 
					FROM auxiliar 
					LEFT JOIN mov
					ON auxiliar.otro = mov.Num_doc 
					WHERE mov.Num_doc IS NULL
					AND auxiliar.otro BETWEEN '".$serie_inicio."' AND '".$serie_termino."';
				";
		
				$qry = new Consulta($sql2);
				while( $rw = $qry->VerRegistro() ){
					$rst[] = array(
						'otro'	=> $rw['otro']
					);
				}
		
				$qry = new Consulta("DROP TABLE mov");
			}
		}

		$serie_inicio = intval($serie_inicio);
		$serie_termino = intval($serie_termino);

	/*	Buscar por rango de fechas	*/
	}else{

		$fecha_inicio = formatofecha($_GET['inicio']);
		$fecha_termino = formatofecha($_GET['termino']);

		$sql1 = "
			CREATE TEMPORARY TABLE mov 
				SELECT cm.cod_ope, cm.serie, cm.Num_doc, cm.sucursal FROM cab_mov cm
				WHERE cm.sucursal = '".$sucursal."'
				AND cm.cod_ope = '".$documento."' 
				AND cm.serie = '".$serie."' 
				AND cm.fecha BETWEEN '".$fecha_inicio."' AND DATE_ADD('".$fecha_termino."', INTERVAL 1 DAY) 
				ORDER BY cm.Num_doc";

		//echo $sql1."<br>";

		$qry1 = new Consulta($sql1);

		$qry3 = new Consulta("SELECT * FROM mov");
		while( $rw = $qry3->VerRegistro() ){
			$rst_tmp[] = array(
				'Num_doc'	=> $rw['Num_doc']
			);
		}

		//echo count($rst_tmp)."<br>".$rst_tmp[0]['Num_doc']." -> ".$rst_tmp[count($rst_tmp)-1]['Num_doc']."<br>";

		$total_rango = (int)$rst_tmp[count($rst_tmp)-1]['Num_doc'] - (int)$rst_tmp[0]['Num_doc'];

		if($total_rango < 100000){
			if(count($rst_tmp) > 0){
				$sql2 = "
					SELECT auxiliar.otro 
					FROM auxiliar 
					LEFT JOIN mov
					ON auxiliar.otro = mov.Num_doc 
					WHERE mov.Num_doc IS NULL 
					AND auxiliar.otro BETWEEN '".$rst_tmp[0]['Num_doc']."' AND '".$rst_tmp[count($rst_tmp)-1]['Num_doc']."';";
	
				//echo $sql2."<br>";
	
				$qry2 = new Consulta($sql2);
				while( $rw = $qry2->VerRegistro() ){
					$rst[] = array(
						'otro'	=> $rw['otro']
					);
				}
	
				$qry3 = new Consulta("DROP TABLE mov");
			}
		}

		$serie_inicio = (int)$rst_tmp[0]['Num_doc'];
		$serie_termino = (int)$rst_tmp[count($rst_tmp)-1]['Num_doc'];

	}

	$objOperacion = new Operacion( $documento );
	$objSucursal = new Sucursal( $sucursal );

	if($sleApp == 1){ $sleApp = 'Compras'; }else{ $sleApp = 'Ventas'; }

	echo "<table>
		<tr>
			<td colspan='3'><b>Prolyam</b></td>
			<td colspan='2' align='right'><b>Fecha : ".date('d/m/Y')."</b></td>
		</tr>
		
		<tr>
			<td colspan='3'></td>
			<td colspan='2' align='right'><b>Hora : ".date('h:i:s')."</b></td>
		</tr>
		
		<tr><td colspan='5' align='center'><b>Documentos Faltantes (".$sleApp.")</b></td></tr>
		<tr><td colspan='5' align='center'><b>".$objSucursal->des_suc."</b></td></tr>
		<tr>
			<td colspan='2' height='40' valign='middle'><b>".$documento." - ".$objOperacion->descripcion."</b></td>
			<td colspan='3' align='right' valign='middle'><b>Desde : ".$serie." - ".str_pad($serie_inicio, 7, "0", STR_PAD_LEFT)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hasta : ".$serie." - ".str_pad($serie_termino, 7, "0", STR_PAD_LEFT)."</b></td>
		</tr>

		<tr>";

		if($total_rango < 100000){
			if(count($rst) > 0){

				echo "<tr><td colspan='5' align='center'><b>Total de documentos faltantes: ".count($rst).".</b></td></tr>";
		
				for($x = 0 ; $x < count($rst) ; $x++){
					$resta = (int)$rst[$x+1]['otro'] - (int)$rst[$x]['otro'];
					$cad .= $rst[$x]['otro'];
					if($resta > 1){
						$cad .= "<br>";				
					}
				}
		
				$segmentos_cadena = explode("<br>", $cad); 
		
				for($y = 0 ; $y < count($segmentos_cadena) ; $y++ ){
					if(strlen($segmentos_cadena[$y]) > 7){
						$total_rango = (strlen($segmentos_cadena[$y]) / 7);
						echo "<tr><td colspan='5'>Falta del: ".$serie." - ".substr($segmentos_cadena[$y],0,7)."&nbsp;&nbsp;&nbsp;al&nbsp;&nbsp;&nbsp;".$serie." - ".substr($segmentos_cadena[$y],-7)." (".$total_rango." documentos.)</td></tr>";
					}else{
						echo "<tr><td colspan='5'>".$segmentos_cadena[$y]."</td></tr>";
					}
				}

			}else{
				echo "<tr><td>No se encontraron resultados</td></tr>";
			}
		}else{
			echo "<tr><td>El resultado supera los 100000 registros.</td></tr>";
		}

	echo "</table>";
?>