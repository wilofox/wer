<?php
include_once('miclase.php');
$clase= new miclase('');
$clase->listar_manguera($_REQUEST['condicion'],$_REQUEST['texto'],$_REQUEST['pag']);	
?>
