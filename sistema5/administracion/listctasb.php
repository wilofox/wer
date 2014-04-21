<?php
include_once('miclase.php');
$clase= new miclase('');
$clase->listar_ctasb($_REQUEST['tipo'],$_REQUEST['texto'],$_REQUEST['pag']);	
?>
