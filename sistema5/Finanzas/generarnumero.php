<?php 
session_start();
include('../conex_inicial.php');
//$_SESSION['serie']='001';
switch($accion){
	case 'numcanje':
		$series=$_REQUEST['sucu'];
		$cod_operacion=$_REQUEST['tipo'];
		$campo1="tipo";
		$tabla="multicj";
		$campo="numcje";
		$campo2="cod_suc";
		break;
	default:
		$series=$_SESSION['caja_serie'];
		$cod_operacion=$_REQUEST['operacion'];
		$campo1="cod_ope";
		$tabla="cab_mov";
		$campo="num_doc";
		$campo2="serie";
		break;
}

//$servicio=$_REQUEST['servicio'];

$strSQL33="select max(".$campo.") as codigo from ".$tabla." where ".$campo1."='$cod_operacion' and ".$campo2."='$series'";
  $resultado33=mysql_query($strSQL33,$cn);
  $row33=mysql_fetch_array($resultado33);
  $var33=$row33['codigo']+1;
  $num_doc=str_pad($var33, 7, "0", STR_PAD_LEFT);
  mysql_free_result($resultado33);

echo $num_doc."-".$series."-".$strSQL33;

?>
