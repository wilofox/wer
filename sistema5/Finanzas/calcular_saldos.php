<?php include('../conex_inicial.php');

$fecha=$_REQUEST['fecha'];
/////////////////
$tienda=$_REQUEST['tienda'];
/////////////////

if(!isset($_REQUEST['recaudacion'])){
$egreso_soles=0;
$ingreso_soles=0;
$egreso_dolar=0;
$ingreso_dolar=0;

//Calculo del saldo Inicial
$strSQL2="SELECT * FROM cajach c,t_pago t WHERE fecpago<'$fecha' and cod_tienda='$tienda' and c.tippago=t.id and t.modalidad='1'";
$resultado2=mysql_query($strSQL2,$cn);

while($row2=mysql_fetch_array($resultado2)){

if($row2['tipmov']=='E' && $row2['moneda']=='01'){
$egreso_soles=$egreso_soles+$row2['importe'];
}
if($row2['tipmov']=='I' && $row2['moneda']=='01'){
$ingreso_soles=$ingreso_soles+$row2['importe'];
}

if($row2['tipmov']=='E' && $row2['moneda']=='02'){
$egreso_dolar=$egreso_dolar+$row2['importe'];
}
if($row2['tipmov']=='I' && $row2['moneda']=='02'){
$ingreso_dolar=$ingreso_dolar+$row2['importe'];
}
}

$saldo_inicial_soles=$ingreso_soles-$egreso_soles;
$saldo_inicial_dolar=$ingreso_dolar-$egreso_dolar;
//Fin del Calculo

$egreso_soles=0;
$ingreso_soles=0;
$egreso_dolar=0;
$ingreso_dolar=0;


//$strSQL="select * from flujo where fecha='$fecha'";
$strSQL="select * from cajach c,t_pago t where fecpago='$fecha' and cod_tienda='$tienda' and c.tippago=t.id and t.modalidad='1'";
$resultado=mysql_query($strSQL,$cn);

while($row=mysql_fetch_array($resultado)){

if($row['tipmov']=='E' && $row['moneda']=='01'){
$egreso_soles=$egreso_soles+$row['importe'];
}
if($row['tipmov']=='I' && $row['moneda']=='01'){
$ingreso_soles=$ingreso_soles+$row['importe'];
}

if($row['tipmov']=='E' && $row['moneda']=='02'){
$egreso_dolar=$egreso_dolar+$row['importe'];
}
if($row['tipmov']=='I' && $row['moneda']=='02'){
$ingreso_dolar=$ingreso_dolar+$row['importe'];
}



}
$saldo_final_soles=($saldo_inicial_soles+$ingreso_soles)-$egreso_soles;
$saldo_final_dolar=($saldo_inicial_dolar+$ingreso_dolar)-$egreso_dolar;


echo number_format($egreso_soles,2).'?'.number_format($ingreso_soles,2).'?'.number_format($saldo_final_soles,2).'?'.number_format($egreso_dolar,2).'?'.number_format($ingreso_dolar,2).'?'.number_format($saldo_final_dolar,2).'?'.number_format($saldo_inicial_soles,2).'?'.number_format($saldo_inicial_dolar,2).'?';
}else{
	if(isset($_REQUEST['recaudacion'])){
		$mon=$_REQUEST['moneda'];
		if($mon==1){
			$mone="01";
		}else{
			$mone="02";
		}
		/*$nfecha=explode("-",$fecha);
		$fec=$nfecha[2]."/".$nfecha[1]."/".$nfecha[0];*/
		$strSQL="select * from pagos inner join cab_mov on cab_mov.cod_cab=pagos.referencia inner join t_pago on t_pago.id=pagos.t_pago where pagos.fecha='$fecha' and pagos.tipo='A' and cab_mov.tienda='$tienda' and cab_mov.tipo='2' and pagos.moneda='$mone' and t_pago.modalidad='1'";
		$strSQL4="select * from pagos inner join cab_mov on cab_mov.cod_cab=pagos.referencia where pagos.fecha='$fecha' and pagos.tipo='C' and cab_mov.tienda='$tienda' and cab_mov.tipo='2' and pagos.moneda='$mone' and pagos.t_pago='1'";
		//echo $strSQL;
		$monto=0;
		$con=mysql_query($strSQL,$cn);
		$num=mysql_num_rows($con);
		if($num>1){
			while($row=mysql_fetch_array($con)){
				$monto=number_format($monto,2,'.','')+number_format($row['monto'],2,'.','');
			}
		}else{
			if($num==1){
				$row=mysql_fetch_array($con);
				$monto=number_format($row['monto'],2,'.','');
			}else{
				$monto=0;
			}
		}
		$con21=mysql_query($strSQL4,$cn);
		while($rowc=mysql_fetch_array($con21)){
			$monto=number_format($monto,2,'.','')+number_format("-".$rowc['monto'],2,'.','');
		}
		$strSQL2="select * from cajach c,t_pago t where fecpago='$fecha' and tipmov='I' and cod_tienda='$tienda' and tippago='1' and importe='$monto' and observa='Recaudacion dia:".$fecha."' and codclie='VARIOS' and c.tippago=t.id and t.modalidad='1' ";
		$con2=mysql_query($strSQL2,$cn);
		$num2=mysql_num_rows($con2);
		if($num2==1){
			echo "disabled";
		}else{
			if($monto==0){
				echo $mone;
			}else{
				echo $mone."?".$monto."?";
			}
		}
	}
}
?>