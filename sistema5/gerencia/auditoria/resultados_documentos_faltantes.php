<?php

	include('../../conex_inicial.php'); 
	include('../../contabilidad/model/Mysql.php'); 
	include('../../funciones/funciones.php');
	include('../../contabilidad/model/Sucursal.php'); 
	include('../../contabilidad/model/Operacion.php');

	$sucursal = $_POST['sleSucursal'];
	$documento = $_POST['sleDocumento'];
	$serie = str_pad($_POST['txtSerie'], 3, "0", STR_PAD_LEFT);
	$opcion = $_POST['rdoOpcion'];

	/*	Buscar por rango de numeros	*/
	if($opcion == 'numeros'){

		$serie_inicio = str_pad($_POST['serie_inicio'], 7, "0", STR_PAD_LEFT);
		$serie_termino = str_pad($_POST['serie_termino'], 7, "0", STR_PAD_LEFT);

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

	/*	Buscar por rango de fechas	*/
	}else{

		$fecha_inicio = formatofecha($_POST['inicio']);
		$fecha_termino = formatofecha($_POST['termino']);

		function diff_dte($date1, $date2){
			   if (!is_integer($date1)) $date1 = strtotime($date1);
			   if (!is_integer($date2)) $date2 = strtotime($date2);  
			   return floor(abs($date1 - $date2) / 60 / 60 / 24);
		}  

		$totalDays = diff_dte($fecha_inicio, $fecha_termino);

		if($totalDays < 32){
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
		}

	}

	if($totalDays < 32){
		if($total_rango < 100000){
			if(count($rst) > 0){
		
				echo "<b>Total de documentos faltantes: ".count($rst).". </b><br><br>";
		
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
						echo "Falta del: ".$serie." - ".substr($segmentos_cadena[$y],0,7)."&nbsp;&nbsp;&nbsp;al&nbsp;&nbsp;&nbsp;".$serie." - ".substr($segmentos_cadena[$y],-7)." (".$total_rango." documentos.)<br>";
					}else{
						echo $segmentos_cadena[$y]."<br>";
					}
				}
		
			}else{
				echo "<tr><td>No se encontraron resultados</td></tr>";
			}
		}else{
			echo "<tr><td>El resultado supera los 100000 registros.</td></tr>";
		}
	}else{
		echo "<tr><td>El rango de fechas es muy alto, no debe superar 31 dias.</td></tr>";
	}

?>