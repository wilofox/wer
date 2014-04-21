<?php
	session_start();
	include("../conex_inicial.php");

	$sql = "DELETE FROM agenda WHERE id_agenda = ".$_POST['id_agenda'];
	$rest = mysql_query($sql,$cn);

	echo $sql;
?>