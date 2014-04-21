<?php
include_once('miclase.php');
$clase= new miclase('');
$clase->listar_costos($_REQUEST['condicion'],$_REQUEST['texto'],$_REQUEST['pag']);	
?>
