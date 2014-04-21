<?php
include_once('miclase.php');
$clase= new miclase('');
$peticion=$_REQUEST['peticion'];

switch($peticion){
	case "lisProxArea":
	$clase->lisProxArea($_REQUEST['condicion'],$_REQUEST['texto'],$_REQUEST['pag'],$_REQUEST['codArea'],$_REQUEST['arrayCodProc'],$_REQUEST['accion']);	
	break;
	
	case "tblFactUtil":
	$clase->tblFactUtil($_REQUEST['condicion'],$_REQUEST['texto'],$_REQUEST['pag']);	
	break;
	
	
}

?>