<?php include('conex_inicial.php');


$mesa=$_REQUEST['mesa'];

$strSQl="select * from mesa where id=$mesa";
$resultado=mysql_query($strSQl,$cn);
$row=mysql_fetch_array($resultado);

echo $row['estado'];

?>