<?php 
include('conex_inicial.php');
$rownpago=mysql_fetch_array(mysql_query("select MAX(id) as id_p from pagos",$cn));
$pa_id=$rownpago['id_p']+1;
$sql="Select * from cab_mov where condicion in(Select condicion from detope where documento=cab_mov.cod_ope and deuda!='S') and deuda='S' and tipo='2'";
$res=mysql_query($sql,$cn);
while($rowxrep=mysql_fetch_array($res)){
	echo "------------------------------------------------------<br>";
	echo "cod.:".$rowxrep['cod_ope']."<br>";
	echo "numero.:".$rowxrep['serie']."-".$rowxrep['Num_doc']."<br>";
	//$rowcond=mysql_fetch_array(mysql_query("select descondi from detope where documento='".$rowxrep['cod_ope']."' and condicion='".$rowxrep['condicion']."'",$cn));
	echo "cond.:".$rowxrep['condicion']."-"."<br>";
	echo "monto:".$rowxrep['total']."<br>";
	echo "saldo:".$rowxrep['saldo']."<br>";
	$pa_referencia=$rowxrep['cod_cab'];
	$sql_pagos=mysql_query("Select * from pagos where referencia='".$pa_referencia."'",$cn);
	if(mysql_num_rows($sql_pagos)==0){
		$pa_tip="A";
		$pa_t_pago="1";
		$pa_fecha=substr($rowxrep['fecha'],0,10);
		$pa_numero="CASH";
		$pa_monto=$rowxrep['total'];
		$pa_moneda=$rowxrep['moneda'];
		$pa_fechap=$rowxrep['fecha_aud'];
		$pa_tcambio=$rowxrep['tc'];
	
		$pa_pc=$rowxrep['pc'];
		$pa_cod_user=$rowxrep['usuario'];
		mysql_query("insert into pagos (id,tipo,t_pago,fecha,fechav,numero,monto,moneda,fechap,tcambio,referencia,pc,cod_user) values ('".$pa_id."','".$pa_tip."','".$pa_t_pago."','".$pa_fecha."','".$pa_fecha."','".$pa_numero."','".$pa_monto."','".$pa_moneda."','".$pa_fechap."','".$pa_tcambio."','".$pa_referencia."','".$pa_pc."','".$pa_cod_user."')",$cn);
		$pa_id=number_format($pa_id,0,'.','')+1;
	}
	/*
	
	
	*/
	//mysql_query("update cab_mov set saldo=0 where cod_cab='".$pa_referencia."'",$cn);
	
}
?>