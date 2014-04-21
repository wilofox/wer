<?php
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=ficheroExcel.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo " FORMATO 13.1: REGISTRO DE INVENTARIO PERMANENTE VALORIZADO - DETALLE DEL INVENTARIO VALORIZADO <br>";
echo "PERIODO  desde:".$_REQUEST['fecha1']. " hasta ".$_REQUEST['fecha2'];
echo $_POST['datos_a_enviar'];


?>