<?php
include_once('miclase.php');
$clase= new miclase('');
$clase->listar_art_clas($_REQUEST['condicion'],$_REQUEST['texto'],$_REQUEST['pag']);	
?>
