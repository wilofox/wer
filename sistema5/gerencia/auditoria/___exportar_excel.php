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

		$sql = "
			SELECT 
				*
			FROM cab_mov 
			WHERE sucursal = '".$sucursal."'
				AND cod_ope = '".$documento."'
				AND serie = '".$serie."'
				AND Num_doc BETWEEN '".$serie_inicio."' AND '".$serie_termino."'
			ORDER BY Num_doc ASC
		";

		$qry = new Consulta($sql);
		while( $rw = $qry->VerRegistro() ){
			$rst[] = array(
				'Num_doc'	=> $rw['Num_doc']
			);
		}
	
		$serie_inicio = intval($serie_inicio);
		$serie_termino = intval($serie_termino);
	
	}else{

		$fecha_inicio = formatofecha($_GET['inicio']);
		$fecha_termino = formatofecha($_GET['termino']);

		$sql = "
			SELECT 
				*
			FROM cab_mov 
			WHERE sucursal = '".$sucursal."'
				AND cod_ope = '".$documento."'
				AND serie = '".$serie."'
				AND fecha BETWEEN '".$fecha_inicio."' AND DATE_ADD('".$fecha_termino."', INTERVAL 1 DAY)  
			ORDER BY Num_doc ASC
		";

		$qry = new Consulta($sql);
		while( $rw = $qry->VerRegistro() ){
			$rst[] = array(
				'Num_doc'	=> $rw['Num_doc']
			);
		}

		$serie_inicio = intval($rst[0]['Num_doc']);
		$serie_termino = intval($rst[count($rst)-1]['Num_doc']);

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

	$contador = 0;

	for($x = $serie_inicio ; $x <= $serie_termino ; $x++){

		$trig = 0;

		for($y = 0 ; $y < count($rst) ; $y++ ){
			$num_doc = intval($rst[$y]['Num_doc']);
			if($num_doc == $x){
				$trig = 1;
				$y = count($rst);
			}else{ 
				$trig = 0;
			}
		}

		if($trig == 0){ 
			$cad = "<td width='120' align='center'><div class='nummero_faltante'>".$serie." - ".str_pad($x, 7, "0", STR_PAD_LEFT)." </div></td>"; 
			echo $cad;
			if(($x % 5) == 0){
				echo "</tr><tr>";
			}
			
			$contador = $contador + 1;

		}

		$trig = 0;
	}

	if($cad == ''){
		echo "<tr><td><div class='nummero_faltante'>No se encontraron resultados</div></td></tr>";
	}

	echo "<tr><td colspan='5' align='right'><b>Total de documentos (".$contador.")</b></td></tr>";

	echo "</table>";
?>