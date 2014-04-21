<?php
include_once('miclase.php');
	$clase= new miclase('');
if ($_REQUEST['ventana']=='hc'){
	$clase->listar_histcontometro($_REQUEST['condicion'],$_REQUEST['texto'],$_REQUEST['fec1'],$_REQUEST['fec2'],$_REQUEST['tipo2'],$_REQUEST['texto2'],$_REQUEST['pag']);	
	//$clase->manguera_datos($_REQUEST['condicion']);
}else if ($_REQUEST['ventana']=='mg'){
	echo $clase->manguera_datos($_REQUEST['condicion']);
}else if ($_REQUEST['ventana']=='vhc'){
	echo $clase->validar_manguera($_REQUEST['condicion'],$_REQUEST['fecha'],$_REQUEST['manuera'],$_REQUEST['turno'],$_REQUEST['contometraje']);
}else if ($_REQUEST['ventana']=='vma'){
	echo $clase->marcajeI_manguera($_REQUEST['condicion'],$_REQUEST['fecha'],$_REQUEST['manuera'],$_REQUEST['turno'],$_REQUEST['contometraje']);
}else if ($_REQUEST['ventana']=='ict'){
	$clase->listar_informeContTanq($_REQUEST['condicion'],$_REQUEST['texto'],$_REQUEST['fec1'],$_REQUEST['fec2'],$_REQUEST['pag']);	
}else if ($_REQUEST['ventana']=='slt'){
	echo $clase->tienda_lis($_REQUEST['condicion']);
}else if ($_REQUEST['ventana']=='slm'){
	echo $clase->manguera_lis2($_REQUEST['condicion'],$_REQUEST['condicion2']);
}
?>
