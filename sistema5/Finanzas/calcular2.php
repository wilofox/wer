<?php
session_start();
include('../conex_inicial.php');

$accion=$_REQUEST['accion'];

if($accion!="TC"){
	$importe=$_REQUEST['importe'];
	if($_REQUEST['Modulo']!="CancelaLetra"){
		$campo="referencia";
		$tabla="cab_mov";
		$campo2="cod_cab";
		$isd="";
	}else{
		$campo="refer_letra";
		$tabla="multi_det";
		$campo2="det_id";
		$isd=$_REQUEST['referencia'];
	}
  	$mon_d=$_REQUEST['mone_doc'];
  
  $total_soles=0;
  $total_dolares=0;
  $cargo_soles=0;
  $cargo_dolares=0;
  $cargo=0;  
	  $strSQL4="select * from pagos where $campo='".$_REQUEST['referencia']."' order by id";
	  //echo "$strSQL4";
		$resultado4=mysql_query($strSQL4,$cn);
	while($row4=mysql_fetch_array($resultado4)){
		if($row4['tipo']=='A'){
			if($mon_d=='01'){
				if($row4['moneda']=='soles' || $row4['moneda']=='01'){
					$total_soles=number_format($total_soles,2,'.','')+number_format($row4['monto'],2,'.','')-number_format($row4['vuelto'],2,'.','');
				}
				if($row4['moneda']=='dolares' || $row4['moneda']=='02'){
					$total_dolares=$total_dolares+($row4['monto']*$row4['tcambio'])-$row4['vuelto'];
				}
			}else{
				if($row4['moneda']=='soles' || $row4['moneda']=='01'){
					$total_soles=$total_soles+($row4['monto']/$row4['tcambio'])-$row4['vuelto'];
				}
				if($row4['moneda']=='dolares' || $row4['moneda']=='02'){
					$total_dolares=$total_dolares+$row4['monto']-$row4['vuelto'];
				}
			}
		}else{
			if($row4['tipo']=='C'){
				if($mon_d=='01'){
					if($row4['moneda']=='soles' || $row4['moneda']=='01'){
						$cargo_soles=$cargo_soles+$row4['monto'];
					}
					if($row4['moneda']=='dolares' || $row4['moneda']=='02'){
						$cargo_dolares=$cargo_dolares+($row4['monto']*$row4['tcambio']);
					}
				}else{
					if($row4['moneda']=='soles' || $row4['moneda']=='01'){
						$cargo_soles=$cargo_soles+($row4['monto']/$row4['tcambio']);
					}
					if($row4['moneda']=='dolares' || $row4['moneda']=='02'){
						$cargo_dolares=$cargo_dolares+($row4['monto']);
					}
				}
			}
		}
	}
	$cargo=$cargo_soles+$cargo_dolares;
	$total=$total_soles+($total_dolares);
}else{
	$fec=$_REQUEST['fecha'];
	$Sql1="SELECT * FROM tcambio WHERE DATE(CONCAT(SUBSTR(fecha,7,4),'-',SUBSTR(fecha,4,2),'-',SUBSTR(fecha,1,2)))<=DATE(CONCAT(SUBSTR('$fec',7,4),'-',SUBSTR('$fec',4,2),'-',SUBSTR('$fec',1,2))) ORDER BY DATE(CONCAT(SUBSTR(fecha,7,4),'-',SUBSTR(fecha,4,2),'-',SUBSTR(fecha,1,2))) DESC LIMIT 1";
	$Consulta1=mysql_query($Sql1,$cn);
	$row1=mysql_fetch_array($Consulta1);
	echo $row1['venta'];
}
//echo $tc;

if($accion=='acuenta'){
//	if($mon_d=='01'){
  		$acta=number_format($total,2,'.','');
//		echo 
//	}else{
//		echo number_format($total/$tc,2);
//	}
//}

//if($accion=='vuelto'){
	//if($mon_d=='01'){
		$vuelto=$importe+$cargo-$total;
 		//echo number_format($vuelto,2);
		$vueltos=number_format($vuelto,2,'.','');
	//}else{	echo 
	//	$vuelto=$importe-($total/$tc)+($cargo/$tc);
 	//	echo number_format($vuelto,2);
	//}
	
//}
//if($accion=='cargos'){
	//if($mon_d=='01'){
		//$cargos=$total-$importe;
 		//echo number_format($vuelto,2);
		$cargos=number_format($cargo,2,'.','');
		//echo 
	//}else{
	//	$cargos=($cargo/$tc);
 	//	echo number_format($cargos,2);
	//}
	
//}
//if($accion=='total'){
	if($cargo>0){
		$tot2=$importe+$cargo;
		$total2=number_format($tot2,2,'.','');
//		echo 
	}else{
		if($cargo<0){
		$cargo=0;
		}
		if($vueltos<0){
		$vueltos=0;
		}
		$total2=number_format($importe,2,'.','');
		//echo number_format($importe,2);
	}
	echo $cargos."?".$total2."?".$acta."?".$vueltos."?".$isd."?";
	
		$ref=$_REQUEST['referencia'];
		$sql="Update $tabla set saldo=".$vueltos." where $campo2='".$ref."'";
		//echo $sql; 
		mysql_query($sql,$cn);
	
}
?>