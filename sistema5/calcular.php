<?php
session_start();
include('conex_inicial.php');

$accion=$_REQUEST['accion'];
$importe=$_REQUEST['importe'];

$total_soles=0;
$total_dolares=0;

	
	$strSQL4="select * from pagos where referencia='".$_SESSION['registro']."' order by id";
	  $resultado4=mysql_query($strSQL4,$cn);
	  while($row4=mysql_fetch_array($resultado4)){
	  
		if($row4['moneda']=='soles'){
		$total_soles=$total_soles+$row4['monto'];
		}
		if($row4['moneda']=='dolares'){
		$total_dolares=$total_dolares+$row4['monto'];
		}
	  
	  
	  }
	  $total=$total_soles+($total_dolares*$tc);

if($accion=='acuenta'){
  echo number_format($total,2);
}

if($accion=='vuelto'){
  
  $vuelto=$total-$importe;
  echo number_format($vuelto,2);
   
  
}
?>