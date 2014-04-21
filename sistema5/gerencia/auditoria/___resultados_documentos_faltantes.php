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

	if($opcion == 'numeros'){

		$serie_inicio = str_pad($_POST['serie_inicio'], 7, "0", STR_PAD_LEFT);
		$serie_termino = str_pad($_POST['serie_termino'], 7, "0", STR_PAD_LEFT);

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

		$fecha_inicio = formatofecha($_POST['inicio']);
		$fecha_termino = formatofecha($_POST['termino']);

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

	echo "<table><tr>";

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
			$cad = "<td><div class='nummero_faltante'>".$serie." - ".str_pad($x, 7, "0", STR_PAD_LEFT)." </div></td>";
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

	echo "</table>";

?>