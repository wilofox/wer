<?php 
session_start();
include('../conex_inicial.php');

$codp = $_REQUEST["codp"];
$facp = $_REQUEST["facp"];
$fac1 = $_REQUEST["fac1"];
$saldo = $_REQUEST["saldo"];
$cant = $_REQUEST["cant"];

		$strSQL="select * from unixprod where producto='".$codp."' and unidad='".$fac1."'";
			$resultado_unid=mysql_query($strSQL,$cn);
			$row_unid=mysql_fetch_array($resultado_unid);
			//$Cantidad=$row_unid['factor'];
if ($row_unid['factor']<>''){			
	if ($row_unid['mconv']=='P'){
		//procentual
		//	echo $saldo*($facp/$row_unid['factor']);
			echo $saldo*$row_unid['factor'];
		}else{
		//nominal
		//echo ($saldo*$facp)/($row_unid['factor']*10);		 
		$FacSbU = explode('.',$row_unid['factor']);		
		if ($FacSbU[1]=!''){
		echo ($saldo/$FacSbU[0]);
		}else{
		echo ($saldo/$FacSbU[0])+($saldo/$FacSbU[1]);
		}					
	}
}else{
	echo 0;
}
			
?>


