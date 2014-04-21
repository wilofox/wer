<?php
	session_start();
	include("../conex_inicial.php");

	$_POST['id_usuario'] = $_SESSION['codvendedor'];

	$fecha_inicio = implode( "-", array_reverse( preg_split( "/\D/", $_POST['startDate'] ) ) )." ";
	$fecha_inicio .= $_POST['startHour'].":";
	$fecha_inicio .= $_POST['startMin'].":00";

	$fecha_final = implode( "-", array_reverse( preg_split( "/\D/", $_POST['endDate'] ) ) )." ";
	$fecha_final .= $_POST['endHour'].":";
	$fecha_final .= $_POST['endMin'].":00";

	$sql = "INSERT INTO agenda VALUES('',
		'".str_pad($_POST['id_usuario'], 3, "0",STR_PAD_LEFT)."',
		'".$fecha_inicio."',
		'".$fecha_final."',
		'".$_POST['colorBackground']."',
		'".$_POST['colorForeground']."',
		'".$_POST['what']."'
	)";

	$rest = mysql_query($sql,$cn);
	
	echo $sql;

?>