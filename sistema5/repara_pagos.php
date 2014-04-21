<?php
include('conex_inicial.php');
$sqlp=mysql_query("Select * from cab_mov where condicion in(Select condicion from detope where documento=cab_mov.cod_ope and deuda!='S') and saldo<0",$cn);
while($row=mysql_fetch_array($sqlp)){
	$mon_ori=$row['moneda'];
	$tot_ori=number_format($row['total'],2,'.','')+number_format($row['percepcion'],2,'.','');
	$tot_abo=0;
	$tot_car=0;
	$sql_pa=mysql_query("select * from pagos where referencia='".$row['cod_cab']."' order by id",$cn);
	$temp_canc=number_format($tot_ori,2,'.','');
	while($row_pa=mysql_fetch_array($sql_pa)){
		if($row_pa['tipo']=='A'){
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
			//if($temp_pago>$tot_ori){
			$temp_canc=number_format($temp_canc,2,'.','')-number_format($temp_pago,2,'.','');
			if($temp_canc>-1){
				echo $row_pa['id']."-".$row_pa['referencia']."-".$mne_pago."-".$temp_pago."-".$tca_pago."-".$mon_ori."-".$temp_canc."<br>";
			}else{
				$temp_canc=number_format($temp_canc,2,'.','')+number_format($temp_pago,2,'.','');
				echo "Eliminar-".$row_pa['id']."-".$row_pa['referencia']."-".$mne_pago."-".$temp_pago."-".$tca_pago."-".$mon_ori."-".$temp_canc."<br>";
			}
			//}
		}
	}
	mysql_free_result($sql_pa);
}
?>