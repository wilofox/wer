<?php 
session_start();
include("conex_inicial.php");

$turnos=$_SESSION['turno'];
$fecha=gmdate('Y-m-d',time()-18000);
$hora=gmdate('H:i:s',time()-18000);
$strSQlT="select * from turno where nombre='$turnos' and '$hora' between hinicio and hfin  ";
$resultadoT=mysql_query($strSQlT,$cn);
$cont=mysql_num_rows($resultadoT);

if($cont==0){
	if($_SESSION['turno']=='Tarde'){
	$_SESSION['turno']='Maana';
	}else{
	$_SESSION['turno']='Tarde';
	}
}


//$strSQlPC="select * from usuarios where codigo='".$_SESSION['codvendedor']."' and pc!='".$_SESSION['pc_ingreso']."'";
$strSQL="update usuarios set fechaConex='".$fecha." ".$hora."',estado='C' where codigo='".$_SESSION['codvendedor']."' and identificador='".$_SESSION['mac_pc']."|".$_SESSION['user_Windows']."'";
mysql_query($strSQL,$cn);

$strSQlPC="select * from usuarios where codigo='".$_SESSION['codvendedor']."' and identificador!='".$_SESSION['mac_pc']."|".$_SESSION['user_Windows']."'";
$resultadoPC=mysql_query($strSQlPC,$cn);
$contPC=mysql_num_rows($resultadoPC);

echo $cont."#".$contPC."#";






?>
