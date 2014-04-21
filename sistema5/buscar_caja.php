<?php 
include('conex_inicial.php');

$caja=$_REQUEST['usu'];

$strSQL="select * from caja where codigo='$caja'";
$resultado=mysql_query($strSQL,$cn);
$row=mysql_fetch_array($resultado); 

echo $row['descripcion']."-".$row['serie1']."-".$row['num1_fa']."-".$row['num1_bv']."-".$row['serie2']."-".$row['num2_fa']."-".$row['num2_bv']."-"."";

?>
