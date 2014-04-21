<?php
	$hostname_conexion = "localhost";
	$database_conexion = "datablanco11";
	$username_conexion = "root";
	$password_conexion = "1";
	
	$cn = mysql_connect($hostname_conexion, $username_conexion, $password_conexion) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_conexion,$cn);
	
	for($x = 1000000; $x < 3000000 ; $x++ ){
		$res = mysql_query("INSERT INTO `auxiliar` VALUES ('', '".str_pad($x, 7, "0", STR_PAD_LEFT)."');" ,$cn);
	}
	
	echo "Listo!!!";
?>