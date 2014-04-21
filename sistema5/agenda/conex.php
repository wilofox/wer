<?php
	$hostname_conexion = "localhost";
	$database_conexion = "datablanco11";
	$username_conexion = "root";
	$password_conexion = "1";

	$cn = mysql_connect($hostname_conexion, $username_conexion, $password_conexion) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($database_conexion,$cn);
?>