<?php
include('../conex_inicial.php');
$codigo=$_REQUEST['CodDoc'];
$operacion=$_REQUEST['Condicion'];
$sql=mysql_query("Select * from multi_det where multi_id='".$codigo."'",$cn);
$e="";
while($r=mysql_fetch_array($sql)){
	if($r['monto']!=$r['saldo']){
		$e="pagada(s)";
	}
	if($r['estado']=="P"){
		$e="protestada(s)";
	}
	if($e!=""){
		break;
	}
}
if($e!=""){
	echo $e;
}else{
	switch($operacion){
		case 'A':
			$sql2=mysql_query("Select * from multi_det where multi_id='".$codigo."'",$cn);
			while($r=mysql_fetch_array($sql2)){
				$letra=$r['det_id'];
				$sql=mysql_query("Select * from multi_det where det_id='$letra'",$cn);
				$row=mysql_fetch_array($sql);
				$obs="Por Anulacion de Letra N° ".$row['letra'];
				$moneda=$row['moneda'];
				$total=$row['monto'];
				$let=mysql_query("Select sum(if(estado!='P' and estado!='A',monto,0)) as total from multi_det where multi_id='".$row['multi_id']."'",$cn);
				$rw_let=mysql_fetch_array($let);
				$total_let=$rw_let['total'];
				///Porcentaje a Restar x Documento
				//echo "(".$total."*100)/".$total_let;
				if($total_let==0){
					$porc_mon=1;
				}else{
					$porc_mon=($total*100)/$total_let;
				}
				//////////////////////////////////
				$doc=mysql_query("Select md.*,mc.tcambio as tca from multi_doc md inner join multicj mc on mc.multi_id=md.multi_id where md.multi_id='".$row['multi_id']."'",$cn);
				$can_doc=mysql_num_rows($doc);
				$total_doc=0.00;
				$ind=0;
				//echo "entra";
				while($rw_doc=mysql_fetch_array($doc)){
					//echo "entra1";
					$var="monto".$ind;
					$var2="codigo".$ind;
					$var3="tcamb".$ind;
					$var4="multi".$ind;
					$total_doc=number_format($rw_doc['monto'],2,'.','');
					$$var=($total_doc*$porc_mon)/100;
					$$var2=$rw_doc['cab_mov'];
					$$var3=$rw_doc['tca'];
					$$var4=$rw_doc['multi_id'];
					$sql=mysql_query("Select max(id) from pagos",$cn);
					$ro=mysql_fetch_array($sql);
					$id=str_pad($ro[0]+1,6,"0",STR_PAD_LEFT);
					mysql_query("insert into pagos (id,tipo,t_pago,fecha,fechav,numero,monto,moneda,vuelto,moneda_v,fechap,tcambio,referencia,estado,obs,pc,cod_user,refer_letra) values('".$id."','C','16','".date('Y-m-d')."','".date('Y-m-d')."','',".number_format($$var,2,'.','').",'".$moneda."',0,'".$moneda."','".date('Y-m-d H:m:i')."','".$$var3."','".$$var2."','','$obs','".$_SESSION['pc_ingreso']."','".$_SESSION['codvendedor']."','')",$cn);
					mysql_query("update multi_doc set monto=(monto-".number_format($$var,2,'.','').") where multi_id='".$$var4."' and cab_mov='".$$var2."'",$cn);
					$ind++;
				}
				$sql="update multi_det set estado='$operacion' where det_id='$letra'";
				mysql_query($sql,$cn);
			}
			$sql2="update multicj set estado='$operacion' where multi_id='".$$var4."'";
			mysql_query($sql2,$cn);
			break;
		case 'E':
			$sql_num=mysql_query("select numcje from multicj where multi_id='".$codigo."'",$cn);
			$rw_num=mysql_fetch_array($sql_num);
			$numero=$rw_num[0];
			mysql_free_result($sql_num);
			$sql3=mysql_query("Select * from multi_doc where multi_id='".$codigo."'",$cn);
			//echo $numero;
			while($rw_doc=mysql_fetch_array($sql3)){
				$mon_doc=mysql_fetch_array(mysql_query("Select moneda,saldo from cab_mov where cod_cab='".$rw_doc['cab_mov']."'",$cn));
				$sql2=mysql_query("Select * from multi_det where multi_id='".$codigo."'",$cn);
				while($r=mysql_fetch_array($sql2)){
					mysql_query("delete from pagos where referencia='".$rw_doc['cab_mov']."' and obs like '%".$r['letra']."%'",$cn);
				}
				mysql_query("delete from pagos where referencia='".$rw_doc['cab_mov']."' and obs like '%".$numero."%'",$cn);
				$sql_pa=mysql_query("Select * from pagos where referencia='".$rw_doc['cab_mov']."'",$cn);
				$monto_a=0;
				$monto_c=0;
				while($rw_pa=mysql_fetch_array($sql_pa)){
					switch($mon_doc[0]){
						case '01':
							switch($rw_pa['moneda']){
								case "02":
									if($rw_pa['tipo']=='C'){
										$monto_c=number_format($monto_c,2,".","")+number_format($rw_pa['monto']*$rw_pa['tcambio'],2,".","");
									}else{
										$monto_a=number_format($monto_a,2,".","")+number_format($rw_pa['monto']*$rw_pa['tcambio'],2,".","");
									}
								case "01":
									if($rw_pa['tipo']=='C'){
										$monto_c=number_format($monto_c,2,".","")+number_format($rw_pa['monto'],2,".","");
									}else{
										$monto_a=number_format($monto_a,2,".","")+number_format($rw_pa['monto'],2,".","");
									}
							}
							break;
						case '02':
							switch($rw_pa['moneda']){
								case "02":
									if($rw_pa['tipo']=='C'){
										$monto_c=number_format($monto_c,2,".","")+number_format($rw_pa['monto'],2,".","");
									}else{
										$monto_a=number_format($monto_a,2,".","")+number_format($rw_pa['monto'],2,".","");
									}
								case "01":
									if($rw_pa['tipo']=='C'){
										$monto_c=number_format($monto_c,2,".","")+number_format($rw_pa['monto']/$rw_pa['tcambio'],2,".","");
									}else{
										$monto_a=number_format($monto_a,2,".","")+number_format($rw_pa['monto']/$rw_pa['tcambio'],2,".","");
									}
							}
							break;
					}
				}
				//$rw_pag=mysql_fetch_array($rs_pag);
				//echo $rw_pag[4]."----";
				$saldo_fin=number_format($mon_doc[1],2,".","")+number_format($monto_c,2,".","")-number_format($monto_a,2,".","");
				mysql_query("update cab_mov set saldo=".$saldo_fin." where referencia='".$rw_doc['cab_mov']."'",$cn);
				mysql_query("delete from multi_det where multi_id='".$codigo."'",$cn);
				mysql_query("delete from multi_doc where multi_id='".$codigo."'",$cn);
				mysql_query("delete from multicj where multi_id='".$codigo."'",$cn);
			}
			//$obs="Por Anulacion de Letra N° ".$row['letra'];
			break;
	}
}
?>