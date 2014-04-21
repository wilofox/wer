<?php 
include('conex_inicial.php');

$codigo=$_REQUEST['cod'];

$strSQL="select * from producto where cod_prod='$codigo'";
$resultado=mysql_query($strSQL,$cn);
$row=mysql_fetch_array($resultado); 

echo $row['factor'];

?>
