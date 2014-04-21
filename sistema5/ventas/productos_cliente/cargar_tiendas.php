<?php 
	include('../../conex_inicial.php'); 
	include('../../contabilidad/model/Mysql.php'); 
	include('../../contabilidad/model/Tiendas.php');

	$objTiendas = new Tiendas;
	$aryTiendas = $objTiendas->getTiendas_Json($_POST['id_sucursal']);

	echo $aryTiendas;
?>