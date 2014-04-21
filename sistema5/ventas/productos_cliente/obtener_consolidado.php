<?php
	/*session_start();
	include("../../conex_inicial.php");

	$_POST['id_usuario'] = $_SESSION['codvendedor'];

	$sql = "
		SELECT *
		FROM usuarios u
		WHERE a.id_usuario = u.codigo
		AND u.codigo = '".str_pad($_POST['id_usuario'], 3, "0",STR_PAD_LEFT)."'";

	$rest = mysql_query($sql,$cn);
	while($row = mysql_fetch_array($rest)){
		$result[] = array(
			'id_agenda' => $row['id_agenda'],
			'nombre_usuario' => $row['usuario'],
			'apellido_usuario' => $row['usuario'],
			'nivel' => $row['usuario'],
			'color_fondo_item' => $row['color_fondo_item'],
			'color_texto_item' => $row['color_texto_item']
		);
	}

	$respuesta['data'] = $result;
	$respuesta['error'] = 'ok';

	header('Content-type: text/plain');
	echo json_encode($respuesta);*/
	
	echo $_GET['codcliente'];
	
?>