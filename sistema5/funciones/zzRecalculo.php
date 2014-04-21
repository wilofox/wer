<?php 
function Recalculo($codigo,$fechak,$filtro){
	include('../conex_inicial.php');
	if($fechak!=date('Y-m-d')){
		$saldotot=0;
		$costotot=0;
		$costo_inven_ant=0;
		$saldo_ant=0;
		$tienda="";
		$i=0;
		$costo_inven_ant=0;
		$saldo_ant_costo=0;
		$saldo_ant=0;
		$costo_inv=0;
		$sql="select c.cliente,c.cod_cab,c.tienda,d.tipo,d.cantidad,d.precio,d.cod_det,c.moneda,d.afectoigv,tc,c.inafecto,c.cod_ope,flag_r,flag_kardex,impto1,d.cod_prod,unidad,c.Num_doc,c.serie,c.cod_ope from det_mov d,cab_mov c where cod_prod='".$codigo."' and substr(d.fechad,1,11)<='".$fechak."' $filtro and kardex!='N' and c.cod_cab=d.cod_cab and c.flag!='A' order by d.fechad asc";
		$resultadog=mysql_query($sql,$cn);
		while($row=mysql_fetch_array($resultadog)){	
			if($row['Num_doc']=='' or $row['serie']=='' or $row['cod_ope']==''){
				continue;
			}
			if($row['tipo']=='1' && $row['cod_ope']!='TS'){
				$strSQL_ref="select * from cliente where codcliente='".$row['cliente']."' and tipo_aux='P'";
				$resultado_ref=mysql_query($strSQL_ref,$cn);
				$cont_ref=mysql_num_rows($resultado_ref);
			
				if($cont_ref==0){
					continue;
				}
			}
			$impto=($row['impto1']/100)+1;	
	
			if($row['flag_r']!='' && ($row['flag_kardex']==$row['tipo']) ){
	
				$strSQL_ref="select kardex from referencia r , cab_mov c where r.cod_cab='".$row['cod_cab']."' and r.cod_cab_ref=c.cod_cab and kardex='S'";
				//echo "<br>";
				$resultado_ref=mysql_query($strSQL_ref,$cn);
				$cont_ref=mysql_num_rows($resultado_ref);
	
				if($cont_ref>0){
					continue;
				}else{
				}
			}
			
			if($i==0){
				$tienda=$row['tienda'];
				$sucursal=substr($row['tienda'],0,1);
			}

			if($tienda==$row['tienda']){
				$saldo_ant=$saldo_actual;
			}else{
				$saldo_ant=0;
				$tienda=$row['tienda'];	
			}
	
			if($sucursal==substr($row['tienda'],0,1)){
				$costo_inven_ant=$costo_inv;
			}else{
				$costo_inven_ant=0;
				$saldo_ant_costo=0;
				$sucursal=substr($row['tienda'],0,1);
			}
		
			///---------------------------------------calculo de costos------------------------------------
	
			if($row['flag_kardex']==''){
				$tipomov=$row['tipo'];
			}else{
				$tipomov=$row['flag_kardex'];
			}
		
			//-------------------------Calculo Costo Inventario subunidad----------------------------
			$strSQL_unid100="select * from unixprod where producto='".$row['cod_prod']."' and unidad='".$row['unidad']."'";
			$resultado_unid100=mysql_query($strSQL_unid100,$cn);
			$row_unid100=mysql_fetch_array($resultado_unid100);
			$factor_subund100=$row_unid100['factor'];
			if($factor_subund100=='' || $factor_subund100==0){
				$factor_subund100=1;
			}
			//$imp_item=$imp_item/$factor_subund100;
			//---------------------------------------------------------------------------------------
		
			$temp_cantidad=$row['cantidad'];
			$temp_unidad=$row['unidad'];
		
			$strSQL_unid101="select * from producto where idproducto='".$row['cod_prod']."'";	
			$resultado_unid101=mysql_query($strSQL_unid101,$cn);
			$row_unid101=mysql_fetch_array($resultado_unid101);
			$und_pr=$row_unid101['und'];
			$factor_pr=$row_unid101['factor'];
			
			if($tipomov==1){
			//------------------------------convercion de subunidades------------------------------------------------
			//echo $und_pr."-".$temp_unidad."<br>";
				if($und_pr != $temp_unidad){
					$strSQL_unid="select * from unixprod where producto='".$row['cod_prod']."' and unidad='".$temp_unidad."'";
					$resultado_unid=mysql_query($strSQL_unid,$cn);
					$row_unid=mysql_fetch_array($resultado_unid);
					$factor_subund=$row_unid['factor'];
					//$temp_subunidad=(($factor_subund)*$_SESSION['productos3'][1][$subkey]);
					$temp_subunidad=$temp_cantidad;
					if ($factor_subund<>""){
						//echo "sh";
						if ($row_unid['mconv']=='P'){
							$temp_subunidad=$temp_subunidad*$factor_subund;
							$precio_en_soles=$row['precio']/$row_unid['factor'];	
						}else{
							$FacSbU = explode('.',$factor_subund);
							$SuT1=$temp_subunidad*$FacSbU[0];	//5*1 - 5 
							$SuT2=$temp_subunidad*$FacSbU[1];	//5*3 -	15				
							$CatSu = explode('.',number_format($SuT2/$factor_pr,3,'.','.'));//agrege para redondeo
							$SuT1=$SuT1+$CatSu[0]; //5+1 - 6
							$SuT2=($CatSu[1]*$factor_pr)/100; // (25*12)/100 - 3							
							$SuT2= number_format($SuT2,0,'','');	 //agrege para redondeo
							$temp_subunidad=$SuT1.'.'.$SuT2 ; //6.3
							if($FacSbU[1]==0 || $FacSbU[1]==""){
								$precio_en_soles=$row['precio']/$row_unid['factor'];;
							}else{
								$precio_en_soles=$row['precio']/$temp_cantidad;							
							}
						}						
					}	
				}else{
					$temp_subunidad=$temp_cantidad;
					$precio_en_soles=$row['precio'];
				}		
				//--------------------------------------------------------------------------------------------------
				//	echo $temp_subunidad."<br>";
				$temp_cantidad=$temp_subunidad;
				//echo $temp_subunidad."<br>";
		
				//echo $row['precio']."/".$factor_subund100."<br>";
				//echo $precio_en_soles."<br>";
				$saldo_actual=$saldo_ant+$temp_cantidad;
				
				//echo "Saldo Tienda $tienda : ".$saldo_actual."<br>";
				//echo $row['tc'];
				if($row['moneda']==02){
					$precio_en_soles=$precio_en_soles*$row['tc'];
				}else{
					$precio_en_soles=$precio_en_soles;
				}
		
				if($row['inafecto']=='N' && $row['afectoigv']=='S'){
					$importe_sin_igv=($temp_cantidad*$precio_en_soles)/$impto;
				}else{
					$importe_sin_igv=($temp_cantidad*$precio_en_soles);
				}
				$costo_inv=(($saldo_ant_costo*$costo_inv_ant)+($importe_sin_igv))/($saldo_ant_costo + $temp_cantidad);			
				$costo_inv=number_format($costo_inv,4,'.','');
				$saldo_ant_costo=$temp_cantidad;
				$costo_inv_ant=$costo_inv;
		
				//$strSQL_updt="update det_mov set saldo_actual='".$saldo_actual."',costo_inven='".$costo_inv."' where cod_det='".$row['cod_det']."'";
		  		$saldotot=$saldo_actual;
				$costotot=$costo_inv;
				//echo $strSQL_updt;
		  		//mysql_query($strSQL_updt,$cn);
				//$saldo_actual
			}else{//caso si es ventas
		 	
				if($und_pr != $temp_unidad){
					$strSQL_unid="select * from unixprod where producto='".$row['cod_prod']."' and unidad='".$temp_unidad."'";
					$resultado_unid=mysql_query($strSQL_unid,$cn);
					$row_unid=mysql_fetch_array($resultado_unid);
					$factor_subund=$row_unid['factor'];
					$temp_subunidad=$temp_cantidad;
					if ($factor_subund<>""){
						if ($row_unid['mconv']=='P'){
							$temp_subunidad=$temp_subunidad*$factor_subund;
						}else{
							$FacSbU = explode('.',$factor_subund);
							$SuT1=$temp_subunidad*$FacSbU[0];	//5*1 - 5 
							$SuT2=$temp_subunidad*$FacSbU[1];	//5*3 -	15				
							$CatSu = explode('.',number_format($SuT2/$factor_pr,3,'.','.'));//agrege para redondeo
							$SuT1=$SuT1+$CatSu[0]; //5+1 - 6
							$SuT2=($CatSu[1]*$factor_pr)/100; // (25*12)/100 - 3							
							$SuT2= number_format($SuT2,0,'','');	 //agrege para redondeo
							$temp_subunidad=$SuT1.'.'.$SuT2 ; //6.3
						}						
					}	
				}else{
					$temp_subunidad=$temp_cantidad;
				}	 
				$temp_cantidad=$temp_subunidad;
				$saldo_actual=$saldo_ant-$temp_cantidad;
				
				//$strSQL_updt="update det_mov set saldo_actual='".$saldo_actual."',costo_inven='0' where cod_det='".$row['cod_det']."'";
				//mysql_query($strSQL_updt,$cn);
			}
			$saldotot=$saldo_actual;
			$costotot=$costo_inv;
		//	$strSQL_upd_costo="update producto set saldo".$tienda."='".$saldo_actual."', costo_inven".$sucursal."='".$costo_inv."' where idproducto='".$codprod."'";
			//mysql_query($strSQL_upd_costo,$cn);
			
		//	echo $strSQL_upd_costo."<br>";
			
			//}
			$i++;
		}
		$strSQL="select d.serie, d.numero, d.fechad, c.cod_cab, c.tienda, c.sucursal, d.tipo, d.cantidad, d.precio, d.cod_det, c.moneda, d.afectoigv, tc, c.inafecto, c.cod_ope, flag_r, flag_kardex, c.incluidoigv, d.fechad, impto1 from det_mov d,cab_mov c where kardex!='N' and c.cod_cab=d.cod_cab and c.flag!='A' and cod_prod='".$codigo."' and c.cod_ope!='TS' and substr(d.fechad,1,11)<='".$fechak."' $filtro and  ( (c.tipo='1' and flag_kardex='1') || (c.tipo='2' and flag_kardex='1') ) order by substring(fechad,1,10),substring(fechad,12,19) ";
		$resultado=mysql_query($strSQL,$cn);
		$registro=mysql_num_rows($resultado);
		//$saldotot=0;
		//$costotot=0;
		$costo_inven_ant=0;
		$saldo_ant=0;
		$tienda="";
		$i=0;
		$costo_inven_ant=0;

		$saldo_ant=0;
		$costo_inv=0;

		while($row=mysql_fetch_array($resultado)){
			$impto=($row['impto1']/100)+1;
		
			if($row['flag_r']!=''){
				$strSQL_ref="select kardex from referencia r , cab_mov c where r.cod_cab='".$row['cod_cab']."' and r.cod_cab_ref=c.cod_cab and kardex='S'";
				$resultado_ref=mysql_query($strSQL_ref,$cn);
				$cont_ref=mysql_num_rows($resultado_ref);
				//echo $strSQL_ref."<br>";
				$temp="";
		
				if($row['flag_kardex']!=''){
					if($row['tipo']!=$row['flag_kardex']){
						$temp="pasar";
					}
				}
	
	
				if($cont_ref >0 && $temp==""){
					//echo $documento." ".$numero;
					continue;
				}
			}
	
			$saldo_ant_costo=saldo_anterior($row['fechad'],$codigo,$row['sucursal'],$row['cod_cab']);
			//$saldotot=$saldo_ant_costo;
			if($sucursal==substr($row['tienda'],0,1)){
				$costo_inven_ant=$costo_inv;
			}else{
				$costo_inven_ant=0;
				$sucursal=substr($row['tienda'],0,1);
			}
			
			if($row['moneda']==02){
				$precio_en_soles=$row['precio']*$row['tc'];
			}else{
				$precio_en_soles=$row['precio'];
			}
				
			if($row['inafecto']=='N' && $row['afectoigv']=='S' && $row['incluidoigv']=='S' ){
				$importe_sin_igv=($row['cantidad']*$precio_en_soles)/$impto;
			}else{
				$importe_sin_igv=($row['cantidad']*$precio_en_soles);
			}
			//echo "((".$saldo_ant_costo."*".$costo_inv_ant.")+(".$importe_sin_igv."))/(".$saldo_ant_costo."+".$row['cantidad'].")";
			if($saldo_ant_costo + $row['cantidad']!=0){
				$costo_inv=(($saldo_ant_costo*$costo_inv_ant)+($importe_sin_igv))/($saldo_ant_costo + $row['cantidad']);
				$costo_inv=number_format($costo_inv,4,'.','');
			
				$costo_inv_ant=$costo_inv;
			
				$costotot=$costo_inv;
			}
			//$strSQL_updt="update det_mov set costo_inven='".$costo_inv."' where cod_det='".$row['cod_det']."'";
			//	   mysql_query($strSQL_updt,$cn);
		   
			//$strSQL_upd_costo="update producto costo_inven".$sucursal."='".$costo_inv."' where idproducto='".$codprod."'";
			//mysql_query($strSQL_upd_costo,$cn);
			$i++;
		}
		//---------------------------------------------TRANSFERENCIAS---------------------------------------------------
		//----------------------------------------------             ----------------------------------------------------
		$strSQL="select d.fechad,numero,c.serie,c.sucursal,c.cod_cab,d.tipo,d.cantidad,c.cod_ope from det_mov d,cab_mov c where c.cod_cab=d.cod_cab and c.flag!='A' and cod_prod='".$codigo."' and substr(d.fechad,1,11)<='".$fechak."' $filtro and c.cod_ope='TS' order by d.fechad,c.tipo desc ";
		//echo $strSQL;
		$resultado=mysql_query($strSQL,$cn);
		//$registro=mysql_num_rows($resultado);
		$numero="";
		$serie="";
		while($row=mysql_fetch_array($resultado)){
			if($serie.$numero!=$row['serie'].$row['numero']){
				$sucursal_origen=$row['sucursal'];
				$fecha_origen=$row['fechad'];
				$cod_cab_origen=$row['cod_cab'];
		
				$strSQL2="select c.cod_cab,c.tienda,d.tipo,d.cantidad,d.precio,saldo_actual,costo_inven from det_mov d,cab_mov c where kardex!='N' and c.cod_cab=d.cod_cab and c.flag!='A' and cod_prod='".$codigo."' and c.tipo='1' and c.cod_ope!='TS' and fechad < '".$fecha_origen."' and c.sucursal='".$sucursal_origen."' order by d.fechad desc  limit 1";
		
				$resultado2=mysql_query($strSQL2,$cn);
				$row2=mysql_fetch_array($resultado2);
				$costo_origen=$row2['costo_inven'];
		
				$numero=$row['numero'];
				$serie=$row['serie'];
		
				continue;
		
			}
			$numero=$row['numero'];
			$serie=$row['serie'];
			$sucursal_destino=$row['sucursal'];
			$fecha_destino=$row['fechad'];
			$cantidad=$row['cantidad'];
	
			$strSQL3="select c.cod_cab,c.tienda,d.tipo,d.cantidad,d.precio,saldo_actual,costo_inven from det_mov d,cab_mov c where kardex!='N' and c.cod_cab=d.cod_cab and c.flag!='A' and cod_prod='".$codigo."' and c.tipo='1' and c.cod_ope!='TS' and fechad < '".$fecha_destino."' and c.sucursal='".$sucursal_destino."' order by d.fechad desc  limit 1";
	
			$resultado3=mysql_query($strSQL3,$cn);
			$row3=mysql_fetch_array($resultado3);
			$costo_destino=	$row3['costo_inven'];
			$saldo_destino=$row3['saldo_actual'];
	
	
			$costo_inv=(($saldo_destino*$costo_destino)+($costo_origen*$cantidad))/($saldo_destino + $cantidad);
			$costo_inv=number_format($costo_inv,4,'.','');
		
			//echo "(($saldo_destino*$costo_destino)+($costo_origen*$cantidad))/($saldo_destino + $cantidad)<br>";
		
			//$str_upd1="update det_mov set precio='".$costo_origen."'costo_inven='".$costo_inv."' where cod_cab='".$cod_cab_origen."' ";
			//$str_upd2="update det_mov set precio='".$costo_origen."',costo_inven='".$costo_inv."' where cod_cab='".$row['cod_cab']."' ";	
			
			//$costotot=$costo_inv;
			
			//mysql_query($str_upd1,$cn);	
			//mysql_query($str_upd2,$cn);	
		}
		return $saldotot."?".$costotot."?";
	}else{
		return "hoy?";
	}
}
function saldo_anterior($fechad,$producto,$sucursal,$codcab){

	include('conex_inicial.php');
	
	$strSQL="select c.cod_cab,c.cod_ope,d.serie,numero,c.tienda,d.tipo,d.cantidad,d.precio,d.cod_det,c.moneda,d.afectoigv,tc,c.inafecto,flag_r,flag_kardex from det_mov d,cab_mov c where kardex!='N' and c.cod_cab=d.cod_cab and c.flag!='A' and cod_prod='".$producto."' and d.fechad <= '".$fechad."' order by substring(fechad,1,10),flag_kardex,substring(fechad,12,19)";
	
	//echo $strSQL;
	$resultado=mysql_query($strSQL,$cn);
	$registro=mysql_num_rows($resultado);
	
	//echo $registro."<br>";
	while($row10=mysql_fetch_array($resultado)){
	

	if($row10['cod_cab']==$codcab){
	break;
	}

	$act_kar_IS=$row10['flag_kardex'];
	//echo "ads<br>";
			 if($row10['flag_r']!=''){
		$strSQL_ref="select kardex from referencia r , cab_mov c where r.cod_cab='".$row10['cod_cab']."' and r.cod_cab_ref=c.cod_cab and kardex='S'";
		$resultado_ref=mysql_query($strSQL_ref,$cn);
		$cont_ref=mysql_num_rows($resultado_ref);
		
		//echo $strSQL_ref."<br>";
		
			$temp="";
			
			
					if($row10['flag_kardex']!=''){
						if($row10['tipo']!=$row10['flag_kardex']){
						$temp="pasar";
						}
					}
		
		
					if($cont_ref >0 && $temp==""){
					//	echo "<br>.Doc ".$documento." ".$numero."<br>";
					continue;
					}
			
				}
		
							
		if($row10['tipo']!=$act_kar_IS && $act_kar_IS!="" ){
			  $tipomov_temp=$act_kar_IS;					
		}else{
			  $tipomov_temp=$row10['tipo'];
		}
					
		//if($tipomov_temp=='1'){
		//echo "<br>".$row10['cod_cab']." ".$tipomov_temp." ".$row10['cantidad']."<br>";
		if($tipomov_temp==1){
			
			$ingresos=$row10['cantidad'];
			$total_ingresos=$total_ingresos+$ingresos;
			$existencia=$existencia+$ingresos;
			$salidas="";
			
		
			
	    }else{	
						
			$salidas=$row10['cantidad'];
			$total_salidas=$total_salidas+$salidas;
			$existencia=$existencia-$salidas;
			$ingresos="";
		} 
		
	
	
	}

//echo "<br>existencia=".$existencia."<br>";
return $existencia;
}	

/*
function saldo_anterior($fechad,$producto,$sucursal,$codcab){
	include('../conex_inicial.php');
	
	$strSQL="select c.cod_cab,c.cod_ope,d.serie,numero,c.tienda,d.tipo,d.cantidad,d.precio,d.cod_det,c.moneda,d.afectoigv,tc,c.inafecto,flag_r,flag_kardex from det_mov d,cab_mov c where kardex!='N' and c.cod_cab=d.cod_cab and c.flag!='A' and cod_prod='".$producto."' and d.fechad <= '".$fechad."' order by substring(fechad,1,10),flag_kardex,substring(fechad,12,19)";
	
	//echo $strSQL;
	$resultado=mysql_query($strSQL,$cn);
	$registro=mysql_num_rows($resultado);
	
	//echo $registro."<br>";
	while($row10=mysql_fetch_array($resultado)){
	
		if($row10['cod_cab']==$codcab){
			break;
		}

		$act_kar_IS=$row10['flag_kardex'];
		//echo "ads<br>";
		if($row10['flag_r']!=''){
			$strSQL_ref="select kardex from referencia r , cab_mov c where r.cod_cab='".$row10['cod_cab']."' and r.cod_cab_ref=c.cod_cab and kardex='S'";
			$resultado_ref=mysql_query($strSQL_ref,$cn);
			$cont_ref=mysql_num_rows($resultado_ref);
		
			//echo $strSQL_ref."<br>";
		
			$temp="";
			
			
			if($row10['flag_kardex']!=''){
				if($row10['tipo']!=$row10['flag_kardex']){
					$temp="pasar";
				}
			}
		
		
			if($cont_ref >0 && $temp==""){
				continue;
			}
		}
		
		if($row10['tipo']!=$act_kar_IS && $act_kar_IS!="" ){
			$tipomov_temp=$act_kar_IS;					
		}else{
			$tipomov_temp=$row10['tipo'];
		}
					
		if($tipomov_temp==1){
			$ingresos=$row10['cantidad'];
			$total_ingresos=$total_ingresos+$ingresos;
			$existencia=$existencia+$ingresos;
			$salidas="";
		}else{	
			$salidas=$row10['cantidad'];
			$total_salidas=$total_salidas+$salidas;
			$existencia=$existencia-$salidas;
			$ingresos="";
		} 
	}
return $existencia;
}
*/

///kardex fisico
function recalculo2($codigo,$fechak,$filtro,$tipo,$sucursal,$archivo=NULL){
	if(file_exists('../conex_inicial.php') && $archivo!='recalculo'){
	include('../conex_inicial.php');
	}else{
	include('conex_inicial.php');
	}
	//if($fechak!=date('Y-m-d')){	
		$costo_inven_ant=0;
		$saldo_ant=0;
		$tienda="";
		$i=0;
		$costo_inven_ant=0;
		$saldo_ant_costo=0;
		$saldo_ant=0;
		$costo_inven=0;
		$saldo_actual=0;
		$costtot=0;
		$costoAnterior=0;
				
		if($tipo=='1'){
		$filtro= " and c.sucursal='".$sucursal."' and substring(d.fechad,1,10)<='".$fechak."' "; 
		}
		
		if($tipo=='2'){
		$filtro= " and c.sucursal='".$sucursal."' and substring(d.fechad,1,10)<'".$fechak."' "; 
		}
		
		if($tipo=='3'){
			$filtrof=" and substring(d.fechad,1,10)<'".$fechak."' ";
		}
		
		if($tipo=='4'){
            $filtrof=" and substring(d.fechad,1,10)<='".$fechak."' ";
			//$filtrof="substring(d.fechad,1,10)<='".$fechak."'";
		}
		
		$sql_kardex=mysql_query("select idproducto from producto where idproducto='".$codigo."'",$cn) or die(mysql_error());  
		
		$row_kardex=mysql_fetch_array($sql_kardex);
		if($row_kardex[0]=="N"){
			return $existencia."?".$costo_inven."?"; 
		}
		
		//$contx1=mysql_num_rows($sql_kardex);
		//echo "zzzz<----->$contx1 <br>";
		//mysql_error();
		
		$sqlx="select  c.incluidoigv,c.cliente,c.kardex,c.cod_cab,c.tienda,d.tipo,d.cantidad,d.precio,d.costo_inven,d.cod_det,c.moneda,d.afectoigv,tc,c.inafecto,c.cod_ope,flag_r,flag_kardex,impto1,d.cod_prod,unidad,c.cod_cab as referencia,c.Num_doc,c.serie,c.cod_ope,c.sucursal from det_mov d,cab_mov c where cod_prod='".$codigo."' $filtrof $filtro and kardex='S' and c.cod_cab=d.cod_cab and c.flag!='A' order by substring(d.fechad,1,10),d.flag_kardex,substring(d.fechad,12,19)";
		
		//$sqlx="select  c.*,c.cod_cab as referencia,d.* from det_mov d,cab_mov c where cod_prod='".$codigo."' $filtrof $filtro and kardex='S' and c.cod_cab=d.cod_cab and c.flag!='A' order by substring(d.fechad,1,10),d.flag_kardex,substring(d.fechad,12,19)";
	
		$resultadox=mysql_query($sqlx,$cn);
		$contx=mysql_num_rows($resultadox);
		//echo $sqlx."<----->$contx <br>";
		
		$j=0;
		//while($row10=mysql_fetch_array($resultado)){
		while($row10=mysql_fetch_array($resultadox)){
		
		//echo "-->".$row10['cod_ope'];
		
			$strSQLddd="select * from operacion where codigo ='".$row10['cod_ope']."' and tipo='".$row10['tipo']."'";
			$resultadodd=mysql_query($strSQLddd,$cn);
			if(mysql_num_rows($resultadodd)==0){
			continue;
			}
															
			$referencia=$row10['referencia'];
			$numero=$row10['serie']."-".$row10['Num_doc'];
			$documento=$row10['cod_ope'];
			$cliente=$row10['cliente'];
			$fecha=substr($row10['fecha'],0,10);
			$tienda=$row10['tienda'];
			$incl_igv=$row10['incluidoigv'];
			$act_kar_IS=$row10['flag_kardex'];
			$prod_igv=$row10['afectoigv'];
			$inafecto=$row10['inafecto'];
			$tipo_cambio_doc=$row10['tc'];
			$impto=1+($row10['impto1']/100);
		
			if($row10['flag_r']!=''){
				$strSQL_ref="select kardex from referencia r , cab_mov c where r.cod_cab='".$row10['referencia']."' and r.cod_cab_ref=c.cod_cab and kardex='S'";
				//echo $strSQL_ref."<br>";
				$resultado_ref=mysql_query($strSQL_ref,$cn);
				$cont_ref=mysql_num_rows($resultado_ref);
				$temp="";
				
				if($row10['flag_kardex']!=''){
					if($row10['tipo']!=$row10['flag_kardex']){
						$temp="pasar";
					}
				}
				if($cont_ref >0 && $temp==""){
					continue;
				}
			}
			
			 //echo $sql."<br>";
			//echo $row10['cod_ope']." - ".$row10['tipo']." - ".$row10['cantidad']."<br>";
			
			
			if($row10['tipo']!=$act_kar_IS && $act_kar_IS!="" ){
				$tipomov_temp=$act_kar_IS;					
			}else{
				$tipomov_temp=$row10['tipo'];
			}
			if($tipomov_temp==1){
				if ($row10['unidad']!=$codunidad){			
					$strSQL_unid="select * from unixprod where producto='".$codigo."' and unidad='".$row10['unidad']."'";
					$resultado_unid=mysql_query($strSQL_unid,$cn);
					$tempCont=mysql_num_rows($resultado_unid);
					if($tempCont!=0){
						$row_unid=mysql_fetch_array($resultado_unid);
						$ingresos=$row10['cantidad']*$row_unid['factor'];
						$factorSub=$row_unid['factor'];
					}else{
						$ingresos=$row10['cantidad'];
						$factorSub=$row_unid['factor'];
					}
				}else{
					$ingresos=$row10['cantidad'];
				}
				//-------------------------
				//$ingresos=$row10['cantidad'];
				$total_ingresos=$total_ingresos+$ingresos;
				$existencia=$existencia+$ingresos+$saldo_actual;
				$salidas="";
			
				if($row10['moneda']=='02'){
					$precio_soles=$row10['precio']*$row10['tc'];
				}else{
					$precio_soles=$row10['precio'];
				}
				// sub unidad kardex Yedem
				// echo $ingresos;
							
				//-------------------------
							
				if($row10['tipo']==1){	
				//echo "dsf";
					/////------------------------sun unidad--------------------------
					//echo $row10['unidad']." - ".$codunidad."<br>";
					if ($row10['unidad']!=$codunidad){	
						$costo_inven=$row10['costo_inven'];
						//echo $incl_igv." - ".$prod_igv;
						if($inafecto=='N'){	
						//echo $incl_igv." - ".$prod_igv."<br>";
							if($incl_igv=='S' && $prod_igv=='S'){
								$punit=$precio_soles/$impto;
								//$punit=$punit/$ingresos;
								if($factorSub!='' &&  $factorSub!='0'){
								$punit=$punit/$factorSub;
								}
							}else{
								$punit=$precio_soles;
							}
						}else{
							$punit=$precio_soles;
						}
						$debe=$punit*$ingresos;
					}else{
				
						//$ingSu=$ingresos; 
						//Anterior				
						$costo_inven=$row10['costo_inven'];
						//echo $incl_igv." - ".$prod_igv;
						if($inafecto=='N'){	
							if($incl_igv=='S' && $prod_igv=='S'){
								$punit=$precio_soles/$impto;
								//echo "punti: ".$punit."<br>";
							}else{
								$punit=$precio_soles;
							}
						}else{
							$punit=$precio_soles;
						}
						$debe=$punit*$ingresos;
					}
					//-------------------------------------------------------------------- 					 
				}else{
					$debe=$costo_inven*$ingresos;				
				}
				$haber="";
				$saldo=$saldo+$debe;	
			}else{	
				$punit="";
				//----------------subunidadesssss---------------------------	
				if ($codunidad!=$row10['unidad']){
					$strSQL_unid="select * from unixprod where producto='".$codigo."' and unidad='".$row10['unidad']."'";
					$resultado_unid=mysql_query($strSQL_unid,$cn);
					$row_unid=mysql_fetch_array($resultado_unid);
					$factor_subund=$row_unid['factor'];
					$salidas=$row10['cantidad'];
					if ($factor_subund<>""){
						if ($row_unid['mconv']=='P'){
							$salidas=$salidas*$factor_subund;
						}else{
							$FacSbU = explode('.',$factor_subund);
							$SuT1=$salidas*$FacSbU[0];	//5*1 - 5 
							$SuT2=$salidas*$FacSbU[1];	//5*3 -	15	
							if($factor!=0){
								$CatSu = explode('.',number_format($SuT2/$factor,3,'.','.'));
								$SuT1=$SuT1+$CatSu[0]; //5+1 - 6
								$SuT2=($CatSu[1]*$factor)/100; // (25*12)/100 - 3
								$SuT2= number_format($SuT2,0,'','');			
							}
							$salidas=$SuT1.'.'.$SuT2 ; //6.3
						}						
					}
				}else{
					$salidas=$row10['cantidad'];
				}
				//$totalCostoVenta=$totalCostoVenta+($salidas*$costoAnterior);
				//------------------------------------------------------------------	
				//$salidas=$row10['cantidad'];
				$total_salidas=$total_salidas+$salidas;
				$existencia=$existencia-$salidas+$saldo_actual;
				//echo $existencia."<br>";
				$ingresos="";
			
				$debe="";
			 	$haber=$costo_inven*$salidas;
				$saldo=$saldo-$haber;
			}
			$saldo_actual=0;
			
			//---------------nuevo calculo de costo inventario------------------------------
			if($j==0){
				$stockAnterior=0;
				$costoAnterior=0;
				$nuevoCosto=0;
			}
					
			if($row10['tipo']==1){	
				$precioActual=$punit;
				$cantActual=$ingresos;
				
				
				if($cantActual+$stockAnterior==0){
				$nuevoCosto=0;
				}else{
				
				    if($stockAnterior<0){
						 if(($stockAnterior+$cantActual)<0){
						 $nuevoCosto=0;
						 }else{
						 $nuevoCosto=$precioActual;
						 }
					
					}else{				
					
				   	 $nuevoCosto= (($stockAnterior * $costoAnterior)+($cantActual*$precioActual))/($cantActual+$stockAnterior);
				    }
				
				//$nuevoCosto= (($stockAnterior * $costoAnterior)+($cantActual*$precioActual))/($cantActual+$stockAnterior);
				}
				
				
			   // echo "<br><br>".$row10['sucursal']." ".$row10['tienda']." ".$row10['Num_doc']." ".$row10['serie']." ".$row10['cod_ope']." ".$row10['cantidad']." ---> ".$saldo."<br>";
				//echo "<br>(($stockAnterior * $costoAnterior)+($cantActual*$precioActual))/($cantActual+$stockAnterior)= ".$nuevoCosto;
				
				//echo "<br>";
				$costoAnterior=$nuevoCosto;											
			}
						
			$stockAnterior=$stockAnterior-$salidas+$ingresos;
			
			//echo "<br>".$row10['sucursal']." ".$row10['tienda']." ".$row10['Num_doc']." ".$row10['serie']." ".$row10['cod_ope']." ".$row10['cantidad']." ---> ".$existencia;
						
			
			$strSQL_updt="update det_mov set costo_inven='".$nuevoCosto."' where cod_det='".$row10['cod_det']."'";
			mysql_query($strSQL_updt,$cn);			
			//-----------------------------------------------------------------------------
			$j++;			
		}
		if($existencia==""){
			$existencia=0;
		}
			
		return $existencia."?".$nuevoCosto."?".$saldo."?";
		
	//}else{
	//	return "hoy?";
	//}
}

function recalculo3($codigo,$fechak,$fechak2,$filtro,$tipo,$sucursal){
	if(file_exists('../conex_inicial.php')){
	include('../conex_inicial.php');
	}else{
	include('conex_inicial.php');
	}
	//if($fechak!=date('Y-m-d')){
		$costo_inven_ant=0;
		$saldo_ant=0;
		$tienda="";
		$i=0;
		$costo_inven_ant=0;
		$saldo_ant_costo=0;
		$saldo_ant=0;
		$costo_inven=0;
		$saldo_actual=0;
		$costtot=0;
		
		if($tipo=='2'){
		$filtro= " and c.sucursal='".$sucursal."' "; 
		}
		
		$sql_kardex=mysql_query("Select kardex from producto where idproducto='".$codigo."'",$cn);
		$row_kardex=mysql_fetch_array($sql_kardex);
		if($row_kardex[0]=="N"){
			return $existencia."?".$costo_inven."?"; 
		}
		
		$sql="select  c.incluidoigv,c.cliente,c.kardex,c.cod_cab,c.tienda,d.tipo,d.cantidad,d.precio,d.costo_inven,d.cod_det,c.moneda,d.afectoigv,tc,c.inafecto,c.cod_ope,flag_r,flag_kardex,impto1,d.cod_prod,unidad,c.cod_cab as referencia,c.Num_doc,c.serie,c.cod_ope from det_mov d,cab_mov c where cod_prod='".$codigo."' and substr(d.fechad,1,10) between '".$fechak."' and '".$fechak2."' $filtro and kardex='S' and c.cod_cab=d.cod_cab and c.flag!='A' order by  substring(d.fechad,1,10),d.flag_kardex,substring(d.fechad,12,19)";
		$resultado=mysql_query($sql,$cn);
//echo $sql."<br>";
		while($row10=mysql_fetch_array($resultado)){
		
			$strSQLddd="select * from operacion where codigo ='".$row10['cod_ope']."' and tipo='".$row10['tipo']."'";
			$resultadodd=mysql_query($strSQLddd,$cn);
			if(mysql_num_rows($resultadodd)==0){
			continue;
			}		
			
						
			$referencia=$row10['referencia'];
			$numero=$row10['serie']."-".$row10['Num_doc'];
			$documento=$row10['cod_ope'];
			$cliente=$row10['cliente'];
			$fecha=substr($row10['fecha'],0,10);
			$tienda=$row10['tienda'];
			$incl_igv=$row10['incluidoigv'];
			$act_kar_IS=$row10['flag_kardex'];
			$prod_igv=$row10['afectoigv'];
			$inafecto=$row10['inafecto'];
			$tipo_cambio_doc=$row10['tc'];
			$impto=1+($row10['impto1']/100);
		
			if($row10['flag_r']!=''){
				$strSQL_ref="select kardex from referencia r , cab_mov c where r.cod_cab='".$row10['referencia']."' and r.cod_cab_ref=c.cod_cab and kardex='S'";
				//echo $strSQL_ref."<br>";
				$resultado_ref=mysql_query($strSQL_ref,$cn);
				$cont_ref=mysql_num_rows($resultado_ref);
				$temp="";
				
				if($row10['flag_kardex']!=''){
					if($row10['tipo']!=$row10['flag_kardex']){
						$temp="pasar";
					}
				}
				if($cont_ref >0 && $temp==""){
					continue;
				}
			}
			
			//echo $row10['cod_ope']."<br>";
						
			if($row10['tipo']!=$act_kar_IS && $act_kar_IS!="" ){
				$tipomov_temp=$act_kar_IS;					
			}else{
				$tipomov_temp=$row10['tipo'];
			}
			if($tipomov_temp==1){
				if ($row10['unidad']!=$codunidad){			
					$strSQL_unid="select * from unixprod where producto='".$codigo."' and unidad='".$row10['unidad']."'";
					$resultado_unid=mysql_query($strSQL_unid,$cn);
					$tempCont=mysql_num_rows($resultado_unid);
					if($tempCont!=0){
						$row_unid=mysql_fetch_array($resultado_unid);
						$ingresos=$row10['cantidad']*$row_unid['factor'];
						$factorSub=$row_unid['factor'];
					}else{
						$ingresos=$row10['cantidad'];
						$factorSub=$row_unid['factor'];
					}
				}else{
					$ingresos=$row10['cantidad'];
				}
				//-------------------------
				//$ingresos=$row10['cantidad'];
				$total_ingresos=$total_ingresos+$ingresos;
				$existencia=$existencia+$ingresos+$saldo_actual;
				$salidas="";
			
				if($row10['moneda']=='02'){
					$precio_soles=$row10['precio']*$row10['tc'];
				}else{
					$precio_soles=$row10['precio'];
				}
				// sub unidad kardex Yedem
				// echo $ingresos;
				
				//-------------------------
			
				if($row10['tipo']==1){	
					/////------------------------sun unidad--------------------------
					if ($row10['unidad']!=$codunidad){	
						$costo_inven=$row10['costo_inven'];
						//echo $incl_igv." - ".$prod_igv;
						if($inafecto=='N'){	
							if($incl_igv=='S' && $prod_igv=='S'){
								$punit=$precio_soles/$impto;
								//$punit=$punit/$ingresos;
								if($factorSub!='' && $factorSub!='0'){
								$punit=$punit/$factorSub;
								}
								
							}else{
								$punit=$precio_soles;
							}
						}else{
							$punit=$precio_soles;
						}
						$debe=$punit*$ingresos;
					}else{
						//$ingSu=$ingresos; 
						//Anterior				
						$costo_inven=$row10['costo_inven'];
						//echo $incl_igv." - ".$prod_igv;
						if($inafecto=='N'){	
							if($incl_igv=='S' && $prod_igv=='S'){
								$punit=$precio_soles/$impto;
							}else{
								$punit=$precio_soles;
							}
						}else{
							$punit=$precio_soles;
						}
						$debe=$punit*$ingresos;
					}
					//-------------------------------------------------------------------- 					 
				}else{
					$debe=$costo_inven*$ingresos;				
				}
				$haber="";
				$saldo=$saldo+$debe;	
			}else{	
				$punit="";
				//----------------subunidadesssss---------------------------	
				if ($codunidad!=$row10['unidad']){
					$strSQL_unid="select * from unixprod where producto='".$codigo."' and unidad='".$row10['unidad']."'";
					$resultado_unid=mysql_query($strSQL_unid,$cn);
					$row_unid=mysql_fetch_array($resultado_unid);
					$factor_subund=$row_unid['factor'];
					$salidas=$row10['cantidad'];
					if ($factor_subund<>""){
						if ($row_unid['mconv']=='P'){
							$salidas=$salidas*$factor_subund;
						}else{
							$FacSbU = explode('.',$factor_subund);
							$SuT1=$salidas*$FacSbU[0];	//5*1 - 5 
							$SuT2=$salidas*$FacSbU[1];	//5*3 -	15	
							if($factor!=0){
								$CatSu = explode('.',number_format($SuT2/$factor,3,'.','.'));
								$SuT1=$SuT1+$CatSu[0]; //5+1 - 6
								$SuT2=($CatSu[1]*$factor)/100; // (25*12)/100 - 3
								$SuT2= number_format($SuT2,0,'','');			
							}
							$salidas=$SuT1.'.'.$SuT2 ; //6.3
						}						
					}
				}else{
					$salidas=$row10['cantidad'];
				}
				//------------------------------------------------------------------	
				//$salidas=$row10['cantidad'];
				$total_salidas=$total_salidas+$salidas;
				$existencia=$existencia-$salidas+$saldo_actual;
				$ingresos="";
			
				$debe="";
			 	$haber=$costo_inven*$salidas;
				$saldo=$saldo-$haber;
			}
			$saldo_actual=0;
		}
		if($existencia==""){
			$existencia=0;
		}
		return $existencia."?".$costo_inven."?";
	//}else{
	//	return "hoy?";
	//}
}

function recalculoActCost($codigo,$fechak,$filtro,$tipo,$sucursal){
	if(file_exists('../conex_inicial.php')){
	include('../conex_inicial.php');
	}else{
	include('conex_inicial.php');
	}
	//if($fechak!=date('Y-m-d')){
	$costo_inven_ant=0;
	$saldo_ant=0;
	$tienda="";
	$i=0;
	$costo_inven_ant=0;
	$saldo_ant_costo=0;
	$saldo_ant=0;
	$costo_inven=0;
	$saldo_actual=0;
	$costtot=0;
	
	if($tipo=='2'){
		$filtro= " and c.sucursal='".$sucursal."' "; 
	}
		
	$sql_kardex=mysql_query("Select kardex from producto where idproducto='".$codigo."'",$cn);
	$row_kardex=mysql_fetch_array($sql_kardex);
	if($row_kardex[0]=="N"){
		return $existencia."?".$costo_inven."?"; 
	}
		
	$sql="select c.cliente,c.kardex,c.cod_cab,c.tienda,d.tipo,d.cantidad,d.precio,d.costo_inven,d.cod_det,c.moneda,d.afectoigv,tc,c.inafecto,c.cod_ope,flag_r,flag_kardex,impto1,d.fechad,c.incluidoigv,d.cod_prod,unidad,c.cod_cab as referencia,c.Num_doc,c.serie,c.cod_ope from det_mov d,cab_mov c where cod_prod='".$codigo."' and substr(d.fechad,1,10)<='".$fechak."' $filtro and kardex!='N' and c.cod_cab=d.cod_cab and c.flag!='A' order by  substring(d.fechad,1,10),d.flag_kardex,substring(d.fechad,12,19)";
	$resultado=mysql_query($sql,$cn);
//echo $sql."<br>";
	while($row10=mysql_fetch_array($resultado)){
		
		$strSQLddd="select * from operacion where codigo ='".$row10['cod_ope']."' and tipo='".$row10['tipo']."'";
		$resultadodd=mysql_query($strSQLddd,$cn);
		if(mysql_num_rows($resultadodd)==0){
			continue;
		}		
			
						
		$referencia=$row10['referencia'];
		$numero=$row10['serie']."-".$row10['Num_doc'];
		$documento=$row10['cod_ope'];
		$cliente=$row10['cliente'];
		$fecha=substr($row10['fecha'],0,10);
		$tienda=$row10['tienda'];
		$incl_igv=$row10['incluidoigv'];
		$act_kar_IS=$row10['flag_kardex'];
		$prod_igv=$row10['afectoigv'];
		$inafecto=$row10['inafecto'];
		$tipo_cambio_doc=$row10['tc'];
		$impto=1+($row10['impto1']/100);

		if($row10['flag_r']!=''){
			$strSQL_ref="select kardex from referencia r , cab_mov c where r.cod_cab='".$row10['cod_cab']."' and r.cod_cab_ref=c.cod_cab and kardex='S'";
			$resultado_ref=mysql_query($strSQL_ref,$cn);
			$cont_ref=mysql_num_rows($resultado_ref);
	//echo $strSQL_ref."<br>";
	
			$temp="";
		
			if($row10['flag_kardex']!=''){
				if($row10['tipo']!=$row10['flag_kardex']){
					$temp="pasar";
				}
			}
	
	
			if($cont_ref >0 && $temp==""){
				//echo $documento." ".$numero;
				continue;
			}
		
		}
		
		
		
			$saldo_ant_costo=saldo_anterior($row10['fechad'],$codigo,$row10['sucursal'],$row10['cod_cab']);
	
			//echo $saldo_ant_costo."<br>";
		
			if($sucursal==substr($row10['tienda'],0,1)){
				$costo_inven_ant=$costo_inv;
			}else{
	
				$costo_inven_ant=0;
		//	$saldo_ant_costo=0;
				$sucursal=substr($row10['tienda'],0,1);
			
			}
	
			if($row10['moneda']==02){
				$precio_en_soles=$row10['precio']*$row10['tc'];
			}else{
				$precio_en_soles=$row10['precio'];
			}
				
			if($row10['inafecto']=='N' && $row10['afectoigv']=='S' && $row10['incluidoigv']=='S' ){
				$importe_sin_igv=($row10['cantidad']*$precio_en_soles)/$impto;
			}else{
				$importe_sin_igv=($row10['cantidad']*$precio_en_soles);
			}
			//echo $row10['cantidad']."*$precio_en_soles)/$impto<br>";
		//	echo "(($saldo_ant_costo*$costo_inv_ant)+($importe_sin_igv))/($saldo_ant_costo + ".$row10['cantidad'].")"."<br>";
		
		
		if(($saldo_ant_costo + $row10['cantidad']!=0)){
			$costo_inv=(($saldo_ant_costo*$costo_inv_ant)+($importe_sin_igv))/($saldo_ant_costo + $row10['cantidad']);
	     }
			$costo_inv=number_format($costo_inv,4,'.','');
			
			$costo_inv_ant=$costo_inv;
	if($row10['tipo']=="1" && $row10['flag_kardex']==$row10['tipo']){
			
			$strSQL_updt="update det_mov set costo_inven='".$costo_inv."' where cod_det='".$row10['cod_det']."'";
			mysql_query($strSQL_updt,$cn);
		     
	//mysql_query($strSQL_upd_costo,$cn);
		}
	}
}

?>