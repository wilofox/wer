<?php
include_once('miclase.php');
$clase= new miclase('');
$clase->listar_medidas($_REQUEST['condicion'],$_REQUEST['texto'],$_REQUEST['pag']);	
?>
