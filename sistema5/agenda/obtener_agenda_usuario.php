<?php
	session_start();
	include("../conex_inicial.php");

	$_POST['id_usuario'] = $_SESSION['codvendedor'];

	$sql = "
		SELECT a.id_agenda, u.usuario, a.fecha_inicio_agenda, a.fecha_final_agenda, a.color_fondo_item, a.color_texto_item, a.texto_agenda
		FROM usuarios u, agenda a
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
			'color_texto_item' => $row['color_texto_item'],
			
			'texto_agenda' => $row['texto_agenda'],
			
			'anio_inicial' => substr($row['fecha_inicio_agenda'],0,4),
			'mes_inicial' => substr($row['fecha_inicio_agenda'],5,2),
			'dia_inicial' => substr($row['fecha_inicio_agenda'],8,2),
			'hora_inicial' => substr($row['fecha_inicio_agenda'],11,2),
			'minuto_inicial' => substr($row['fecha_inicio_agenda'],14,2),
			
			'anio_final' => substr($row['fecha_final_agenda'],0,4),
			'mes_final' => substr($row['fecha_final_agenda'],5,2),
			'dia_final' => substr($row['fecha_final_agenda'],8,2),
			'hora_final' => substr($row['fecha_final_agenda'],11,2),
			'minuto_final' => substr($row['fecha_final_agenda'],14,2)
		);
	}

	$respuesta['data'] = $result;
	$respuesta['error'] = 'ok';

	header('Content-type: text/plain');
	echo json_encode($respuesta);
?>