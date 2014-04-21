<?php
include_once('miclase.php');
	$clase= new miclase('');
if ($_REQUEST['ventana']=='hc'){
	$clase->listar_histvarillaje($_REQUEST['condicion'],$_REQUEST['texto'],$_REQUEST['fec1'],$_REQUEST['fec2'],$_REQUEST['tipo2'],$_REQUEST['texto2'],$_REQUEST['pag']);
	//$clase->manguera_datos($_REQUEST['condicion']);
}else if ($_REQUEST['ventana']=='mg'){
	echo $clase->tanque_datos($_REQUEST['condicion']);
}else if ($_REQUEST['ventana']=='vhc'){
	//echo $clase->validar_manguera($_REQUEST['condicion'],$_REQUEST['fecha'],$_REQUEST['tanque'],$_REQUEST['contometraje']);
}else if ($_REQUEST['ventana']=='ttv'){
	echo $clase->tipo_tanque($_REQUEST['condicion']);
}
?>
