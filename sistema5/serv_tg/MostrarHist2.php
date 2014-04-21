<?php 
include('../conex_inicial.php');
$codigo=$_REQUEST['codcab'];
if($codigo!=""){
	$sql=mysql_query("Select * from det_mov where substr(nom_prod,1,8)='SERVICIO' and cod_cab=$codigo",$cn);
	$row=mysql_fetch_array($sql);
	$cliente=$row['auxiliar'];
}else{
$cliente="todos";
}
//$servicio=$row['cod_prod'];
$servicio="todos";
header("location:MostrarHist.php?clie=$cliente&prod=$servicio&bcli=cliente");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin título</title>
</head>

<body>
</body>
</html>