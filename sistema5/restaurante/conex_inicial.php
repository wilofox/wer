<?php
$hostname_conexion = "localhost";
$database_conexion = "panaderia3";
$username_conexion = "root";
$password_conexion = "1";
/*
$hostname_conexion = "209.126.254.114";
$database_conexion = "prolyam";
$username_conexion = "prolyam";
$password_conexion = "123prolyam";
*/
$cn = mysql_connect($hostname_conexion, $username_conexion, $password_conexion) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db("panaderia3",$cn);

$fecha=date('d/m/Y');
$strSQl0="select * from tcambio where fecha='$fecha'";
//echo $strSQl0;
$resultado0=mysql_query($strSQl0,$cn);
$row0=mysql_fetch_array($resultado0);
$tc=$row0['venta'];

?>