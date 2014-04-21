<?php include('conex_inicial.php');

$fecha=$_REQUEST['fecha'];
$egreso_soles=0;
$ingreso_soles=0;
$egreso_dolar=0;
$ingreso_dolar=0;


$strSQL="select * from flujo where fecha='$fecha'";
$resultado=mysql_query($strSQL,$cn);

while($row=mysql_fetch_array($resultado)){

	if($row['tipo']=='E' && $row['moneda']=='S/'){
	$egreso_soles=$egreso_soles+$row['monto'];
	}
	if($row['tipo']=='I' && $row['moneda']=='S/'){
	$ingreso_soles=$ingreso_soles+$row['monto'];
	}
	
	if($row['tipo']=='E' && $row['moneda']=='U$'){
	$egreso_dolar=$egreso_dolar+$row['monto'];
	}
	if($row['tipo']=='I' && $row['moneda']=='U$'){
	$ingreso_dolar=$ingreso_dolar+$row['monto'];
	}
	
	
	
}
$saldo_final_soles=$ingreso_soles-$egreso_soles;
$saldo_final_dolar=$ingreso_dolar-$egreso_dolar;


echo number_format($egreso_soles,2).'?'.number_format($ingreso_soles,2).'?'.number_format($saldo_final_soles,2).'?'.number_format($egreso_dolar,2).'?'.number_format($ingreso_dolar,2).'?'.number_format($saldo_final_dolar,2).'?';

?>