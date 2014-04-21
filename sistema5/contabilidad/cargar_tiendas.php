<?php 
	include('../conex_inicial.php'); 
	include('model/Mysql.php'); 
	include('model/Tiendas.php'); 

	$objTiendas = new Tiendas;
	$aryTiendas = $objTiendas->getTiendas_Json($_POST['id_sucursal']);

	echo $aryTiendas;
?>