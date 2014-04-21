<?php

function saldo_act($fecha1,$referencia,$importe,$moneda){
	include('../conex_inicial.php');
	
	$strSQL333="Select * from pagos where referencia='".$referencia."' and CONCAT(SUBSTR(fecha,7,4),'-',SUBSTR(fecha,4,2),'-',SUBSTR(fecha,1,2)) <= '".$fecha1."'";
	//echo "<br>".$strSQL333."<br>";
	$abonos=0;
	$cargos=0;
	$consulta32=mysql_query($strSQL333,$cn);
	$numrow=mysql_num_rows($consulta32);
	while($row=mysql_fetch_array($consulta32)){
		if($row['tipo']=='A'){
			if($moneda=='01' && ($row['moneda']=='dolares' || $row['moneda']=='02')){
				$abonos=$abonos+($row['monto']*$row['tcambio']);
			}else{
				if($moneda=='02' && ($row['moneda']=='soles' || $row['moneda']=='01')){
					$abonos=$abonos+($row['monto']/$row['tcambio']);
				}else{
					$abonos=$abonos+$row['monto'];
				}
			}
		}else{
			if($moneda=='01' && ($row['moneda']=='dolares' || $row['moneda']=='02')){
				$cargos=$cargos+($row['monto']*$row['tcambio']);
			}else{
				if($moneda=='02' && ($row['moneda']=='soles' || $row['moneda']=='02')){
					$cargos=$cargos+($row['monto']/$row['tcambio']);
				}else{
					$cargos=$cargos+$row['monto'];
				}
			}
		}
	}
	//echo "<br>"$importe."-".$abonos."="."<br>";
	if($moneda=='01'){
		$total=$importe-$abonos+$cargos;
	}else{
		$total=$importe-$abonos+$cargos;
	}
//	echo "<br>".$importe."-".$abonos."=".$total."<br>";
	if($numrow!=0){
		return number_format($total,2);
	}else{
		return  number_format($importe,2);
	}
	
}

function saldo_ant($fecha1,$cliente){
	include('../conex_inicial.php');
	
	$abonos_s=0;
	$abonos_d=0;
	
	$cargos_s=0;
	$cargos_d=0;
	
	$strSQL332="Select * from cab_mov  where cliente='".$cliente."' and condicion='2' and substring(fecha,1,10) < '".$fecha1."' and flag!='A' ";
	//echo $strSQL332;
	$consulta332=mysql_query($strSQL332,$cn);
	$numrow=mysql_num_rows($consulta332);
	while($row332=mysql_fetch_array($consulta332)){
		if($row332['moneda']=='01'){
		$cargos_s=$row332['total']+$row332['percepcion'];
		
		}else{
		$cargos_d=$row332['total']+$row332['percepcion'];
		}
	}
	
	$strSQL333="Select p.tipo,p.moneda,p.monto,p.tcambio,c.moneda as monedadoc from pagos p,cab_mov c where c.cliente='".$cliente."' and condicion='2' and p.referencia=c.cod_cab and CONCAT(SUBSTR(p.fecha,7,4),'-',SUBSTR(p.fecha,4,2),'-',SUBSTR(p.fecha,1,2)) < '".$fecha1."' and flag!='A' ";
	//echo "<br>".$strSQL333."<br>";

//	echo $moneda;
	$consulta32=mysql_query($strSQL333,$cn);
	$numrow=mysql_num_rows($consulta32);
	while($row=mysql_fetch_array($consulta32)){
	$moneda=$row['monedadoc'];
	
		if($row['tipo']=='A'){
			if($moneda=='01' && ($row['moneda']=='dolares' || $row['moneda']=='02')){
				    $abonos_s=$abonos_s+($row['monto']*$row['tcambio']);
			}else{
				if($moneda=='02' && ($row['moneda']=='soles' || $row['moneda']=='01')){
					$abonos_d=$abonos_d+($row['monto']/$row['tcambio']);
				}else{
					if($moneda=='01')
					$abonos_s=$abonos_s+$row['monto'];
					else
					$abonos_d=$abonos_d+$row['monto'];
					
				}
			}
		}else{
			if($moneda=='01' && ($row['moneda']=='dolares' || $row['moneda']=='02')){
				$cargos_s=$cargos_s+($row['monto']*$row['tcambio']);
			}else{
				if($moneda=='02' && ($row['moneda']=='soles' || $row['moneda']=='02')){
					$cargos_d=$cargos_d+($row['monto']/$row['tcambio']);
				}else{
					if($moneda=='01')
					$cargos_s=$cargos_s+$row['monto'];
					else
					$cargos_d=$cargos_d+$row['monto'];
				}
			}
		}
	}

	
	$saldo_s=$cargos_s-$abonos_s;
	$saldo_d=$cargos_d-$abonos_d;
		
	
		return number_format($saldo_s,2)."?".number_format($saldo_d,2)."?" ;
	
}

?>