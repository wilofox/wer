<?php 
include('conex_inicial.php');

$ccodcliente=$_REQUEST['ccodcliente'];
$cpersona=$_REQUEST['cpersona'];
$crazonsocial==$_REQUEST['crazonsocial'];
$cruc==$_REQUEST['cruc'];
$capellido==$_REQUEST['capellido'];
$cnombre==$_REQUEST['cnombre'];
$cdni==$_REQUEST['cdni'];
$cdireccion==$_REQUEST['cdireccion'];

$strSQL2= "insert into cliente (codcliente,razonsocial,ruc,nombres,apellidos,t_persona,doc_iden,direccion) values ('".$ccodcliente."','".$crazonsocial."','".$cruc."','".$cnombre."','".$capellido."','".$cpersona."','".$cdni."','".$cdireccion."')";
mysql_query($strSQL2);


echo $cruc."?".$crazonsocial."?".$cdireccion."?".mysql_errno($cn)."?";



?>