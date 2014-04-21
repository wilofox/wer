<?php
include('conex_inicial.php');
$sql=mysql_query("select * from cab_mov where deuda='S' and condicion in(Select condicion from detope where documento=cab_mov.cod_ope and deuda!='S')",$cn);
while($row=mysql_fetch_array($sql)){
	$mon_ori=$row['moneda'];
	$tot_ori=$row['total'];
	$tot_abo=0;
	$tot_car=0;
	$sql_pa=mysql_query("select * from pagos where referencia='".$row['cod_cab']."'",$cn);
	while($row_pa=mysql_fetch_array($sql_pa)){
		$mon_pago=$row_pa['monto'];
		$tca_pago=$row_pa['tcambio'];
		$mne_pago=$row_pa['moneda'];
		$temp_pago=0;
		if($mne_pago!=$mon_ori){
			switch($mne_pago){
				case '01':$temp_pago=number_format($mon_pago/$tca_pago,2,'.','');break;
				case '02':$temp_pago=number_format($mon_pago*$tca_pago,2,'.','');break;
			}
		}else{
			$temp_pago=number_format($mon_pago,2,'.','');
		}
				
		switch($row_pa['tipo']){
			case 'A':$tot_abo=number_format($tot_abo,2,'.','')+number_format($temp_pago,2,'.','');break;
			case 'C':$tot_car=number_format($tot_car,2,'.','')+number_format($temp_pago,2,'.','');break;
		}
	}
	mysql_free_result($sql_pa);
	$saldo=number_format((number_format($tot_ori,2,'.','')+number_format($tot_car,2,'.',''))-number_format($tot_abo,2,'.',''),2,'.','');
	mysql_query("update cab_mov set saldo='".$saldo."' where cod_cab='".$row['cod_cab']."'",$cn);
	echo $tot_ori."-".$tot_abo."+".$tot_car."=".$saldo."==>".$row['saldo']."<br>";
}
?>