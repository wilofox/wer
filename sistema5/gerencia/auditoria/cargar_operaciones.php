<?php 
	include('../../conex_inicial.php'); 
	include('../../contabilidad/model/Mysql.php'); 
	include('../../contabilidad/model/Tiendas.php');
	include('../../contabilidad/model/Operacion.php'); 	

	$objOperacion = new Operacion;
	$aryOperacion = $objOperacion->getOperacion_Json($_POST['id_tipo']);

	echo $aryOperacion;
?>