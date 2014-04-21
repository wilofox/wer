<?php
session_start();
include('conex_inicial.php');

$accion=$_REQUEST['accion'];
$importe=$_REQUEST['importe'];

$total_soles=0;
$total_dolares=0;

	
	$strSQL4="select * from pagos where referencia='".$_REQUEST['referencia']."' order by id";
	//echo "$strSQL4";
	  $resultado4=mysql_query($strSQL4,$cn);
	  while($row4=mysql_fetch_array($resultado4)){
	  
		if($row4['moneda']=='soles'){
		$total_soles=$total_soles+$row4['monto']-$row4['vuelto'];
		}
		if($row4['moneda']=='dolares'){
		$total_dolares=$total_dolares+($row4['monto']*$tc)-$row4['vuelto'];
		}
	  
	 }
	  $total=$total_soles+($total_dolares);
	  
//echo $tc;

if($accion=='acuenta'){
  echo number_format($total,2);
}

if($accion=='vuelto'){
  
  $vuelto=$total-$importe;
  echo number_format($vuelto,2);
     
}
?>