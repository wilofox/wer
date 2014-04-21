<input type="button" name="Submit" value="Recalculo Terminado" onclick="javascript:window.close();" />
<?php 

include('conex_inicial.php');
include('funciones/Recalculo.php');

$codprod=$_REQUEST['codigo2'];

//$strSQL_upd_costo="update producto set saldo101='0',saldo102='0',saldo103='0',saldo201='0',saldo202='0',saldo301='0',saldo302='0' where idproducto='".$codprod."'";

//echo $strSQL_upd_costo;
//mysql_query($strSQL_upd_costo,$cn);


/*
$strSQL_vacios="select * from cab_mov where cod_ope='' and  Num_doc='' and serie='' ";
$resultado_vacios=mysql_query($strSQL_vacios,$cn);
//$cont_vacios=mysql_num_rows($resultado_vacios);
while($row_vacios=mysql_fetch_array($resultado_vacios)){

$strDelete_vacios1="delete from cab_mov where cod_cab='".$row_vacios['cod_cab']."'";
$strDelete_vacios2="delete from det_mov where cod_cab='".$row_vacios['cod_cab']."'";
$strDelete_vacios3="delete from pagos where referencia='".$row_vacios['cod_cab']."'";

mysql_query($strDelete_vacios1);
mysql_query($strDelete_vacios2);
mysql_query($strDelete_vacios3);

}
*/

//-----------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------

//$strSQL="select c.cliente,c.cod_cab,c.tienda,d.tipo,d.cantidad,d.precio,d.cod_det,c.moneda,d.afectoigv,tc,c.inafecto,c.cod_ope,flag_r,flag_kardex,impto1,d.cod_prod,unidad,c.Num_doc,c.serie,c.cod_ope from det_mov d,cab_mov c where kardex!='N' and c.cod_cab=d.cod_cab and c.flag!='A' and cod_prod='".$codprod."' order by d.tienda asc ,d.fechad asc";
//$resultado=mysql_query($strSQL,$cn);
//$registro=mysql_num_rows($resultado);
//
////echo $strSQL."<br>";
//$costo_inven_ant=0;
//$saldo_ant=0;
//$tienda="";
//$i=0;
//$costo_inven_ant=0;
//$saldo_ant_costo=0;
//$saldo_ant=0;
//$costo_inv=0;
//
//
//while($row=mysql_fetch_array($resultado)){
//	
//	//echo $row['Num_doc']."  ".$row['serie']."  ".$row['cod_ope']."<br>";
//	
//	if($row['Num_doc']=='' or $row['serie']=='' or $row['cod_ope']==''){
//	continue;
//	}
//		
//	$strSQLOper="select * from operacion where codigo='".$row['cod_ope']."' and tipo='".$row['tipo']."'";
//	$resultadoOper=mysql_query($strSQLOper,$cn);
//	$contOper=mysql_num_rows($resultadoOper);
//	if($contOper==0){
//	continue;
//	}
//		
//		if($row['tipo']=='1' && $row['cod_ope']!='TS'){
//			$strSQL_ref="select * from cliente where codcliente='".$row['cliente']."' and (tipo_aux='P' or tipo_aux='A')";
//			$resultado_ref=mysql_query($strSQL_ref,$cn);
//			$cont_ref=mysql_num_rows($resultado_ref);
//			
//			if($cont_ref==0){
//			continue;
//			}
//		}
//	$impto=($row['impto1']/100)+1;	
//	
//	//echo $row['flag_r']."<br>";
//	if($row['flag_r']!='' && ($row['flag_kardex']==$row['tipo']) ){
//	
//		$strSQL_ref="select kardex from referencia r , cab_mov c where r.cod_cab='".$row['cod_cab']."' and r.cod_cab_ref=c.cod_cab and kardex='S'";
//		$resultado_ref=mysql_query($strSQL_ref,$cn);
//		$cont_ref=mysql_num_rows($resultado_ref);
//	
//		//echo $strSQL_ref." ".$cont_ref."<br>";
//	
//			if($cont_ref>0){
//			continue;
//			}else{
//			
//			/*$strSQL_ref="select kardex from referencia r , cab_mov c where r.cod_cab_ref='".$row['cod_cab']."' and r.cod_cab=c.cod_cab and kardex='S'";
//		   $resultado_ref=mysql_query($strSQL_ref,$cn);
//		   $cont_ref=mysql_num_rows($resultado_ref);
//				if($cont_ref>0){
//				continue;
//				}
//			*/
//			}
//	
//	/*
//	$strSQL_ref="select kardex from referencia r , cab_mov c where cod_cab_ref='".$row['cod_cab']."' and r.cod_cab=c.cod_cab ";
//	$resultado_ref=mysql_query($strSQL_ref,$cn);
//	$row_ref=mysql_fetch_array($resultado_ref);
//	
//		if($row_ref['kardex']=='S'){
//		continue;
//		}
//	*/
//	
//	}
//	/*if($row['tipo']=="1"){
//		$opera="+";
//	}else{
//		$opera="-";
//	}
//	echo $row['Num_doc']."  ".$row['serie']."  ".$row['cod_ope']." ".$row['tipo']." ".$row['tienda']."<br>";
//	echo $row['cod_prod']."  ".$row['cantidad']."  ".$opera."<br>";*/
//	if($i==0){
//	$tienda=$row['tienda'];
//	$sucursal=substr($row['tienda'],0,1);
//	}
//
//		if($tienda==$row['tienda']){
//			$saldo_ant=$saldo_actual;
//		}else{
//			$saldo_ant=0;
//			$tienda=$row['tienda'];	
//		}
//	
//		if($sucursal==substr($row['tienda'],0,1)){
//			$costo_inven_ant=$costo_inv;
//				
//		}else{
//		
//		   //$strSQL_upd_costo="update producto set costo_inven".$sucursal."='".$costo_inv."' where idproducto='".$codprod."'";
//			//mysql_query($strSQL_upd_costo,$cn);
//				
//			$costo_inven_ant=0;
//			$saldo_ant_costo=0;
//			$sucursal=substr($row['tienda'],0,1);
//			
//		}
//		
//	///---------------------------------------calculo de costos------------------------------------
//	
//	if($row['flag_kardex']==''){
//	$tipomov=$row['tipo'];
//	}else{
//	$tipomov=$row['flag_kardex'];
//	}
//		
//		//-------------------------Calculo Costo Inventario subunidad----------------------------
//					$strSQL_unid100="select * from unixprod where producto='".$row['cod_prod']."' and unidad='".$row['unidad']."'";
//					$resultado_unid100=mysql_query($strSQL_unid100,$cn);
//					$row_unid100=mysql_fetch_array($resultado_unid100);
//					$factor_subund100=$row_unid100['factor'];
//					if($factor_subund100=='' || $factor_subund100==0){
//					$factor_subund100=1;
//					}
//					//$imp_item=$imp_item/$factor_subund100;
//					//---------------------------------------------------------------------------------------
//		
//		$temp_cantidad=$row['cantidad'];
//		$temp_unidad=$row['unidad'];
//		
//					$strSQL_unid101="select * from producto where idproducto='".$row['cod_prod']."'";	
//					$resultado_unid101=mysql_query($strSQL_unid101,$cn);
//					$row_unid101=mysql_fetch_array($resultado_unid101);
//					$und_pr=$row_unid101['und'];
//					$factor_pr=$row_unid101['factor'];
//		
//		
//	if($tipomov==1){
//										
//		
//		//------------------------------convercion de subunidades------------------------------------------------
//		//echo $und_pr."-".$temp_unidad."<br>";
//			if($und_pr != $temp_unidad){
//				
//					$strSQL_unid="select * from unixprod where producto='".$row['cod_prod']."' and unidad='".$temp_unidad."'";
//					$resultado_unid=mysql_query($strSQL_unid,$cn);
//					$row_unid=mysql_fetch_array($resultado_unid);
//					$factor_subund=$row_unid['factor'];
//																
//				     //$temp_subunidad=(($factor_subund)*$_SESSION['productos3'][1][$subkey]);
//						$temp_subunidad=$temp_cantidad;
//					if ($factor_subund<>""){
//					//echo "sh";
//						if ($row_unid['mconv']=='P'){
//						//echo "procentual<br>";
//					//	echo "$temp_subunidad*($factor_pr/$factor_subund)";
//							$temp_subunidad=$temp_subunidad*$factor_subund;
//							
//							$precio_en_soles=$row['precio']/$row_unid['factor'];	
//						}else{
//						//echo "nominal<br>";
//						//nominal
//							//$temp_subunidad=(($temp_subunidad*$factor_subund)*10)/$row4['factor'];
//							$FacSbU = explode('.',$factor_subund);
//							//echo $FacSbU[0]		
//							$SuT1=$temp_subunidad*$FacSbU[0];	//5*1 - 5 
//							$SuT2=$temp_subunidad*$FacSbU[1];	//5*3 -	15				
//					$CatSu = explode('.',number_format($SuT2/$factor_pr,3,'.','.'));//agrege para redondeo
//							//$CatSu = explode('.',$SuT2/$row4['factor']); //15/12 - 1.25  /* 2.083
//							$SuT1=$SuT1+$CatSu[0]; //5+1 - 6
//							$SuT2=($CatSu[1]*$factor_pr)/100; // (25*12)/100 - 3							
//							$SuT2= number_format($SuT2,0,'','');	 //agrege para redondeo
//							$temp_subunidad=$SuT1.'.'.$SuT2 ; //6.3
//							
//							
//							if($FacSbU[1]==0 || $FacSbU[1]==""){
//							$precio_en_soles=$row['precio']/$row_unid['factor'];;
//							}else{
//							$precio_en_soles=$row['precio']/$temp_cantidad;							
//							}
//							
//						}						
//					}
//				
//						
//				}else{
//				 $temp_subunidad=$temp_cantidad;
//				 $precio_en_soles=$row['precio'];
//				}		
//		//--------------------------------------------------------------------------------------------------
//	//	echo $temp_subunidad."<br>";
//		$temp_cantidad=$temp_subunidad;
//		//echo $temp_subunidad."<br>";
//		
//		//echo $row['precio']."/".$factor_subund100."<br>";
//		//echo $precio_en_soles."<br>";
//		$saldo_actual=$saldo_ant+$temp_cantidad;
//		
//		//echo $saldo_actual."<br>";
//		//echo $row['tc'];
//		if($row['moneda']==02){
//		$precio_en_soles=$precio_en_soles*$row['tc'];
//		}else{
//		$precio_en_soles=$precio_en_soles;
//		}
//		
//		//	echo $row['inafecto']." ".$row['afectoigv'];
//		if($row['inafecto']=='N' && $row['afectoigv']=='S'){
//		  $importe_sin_igv=($temp_cantidad*$precio_en_soles)/$impto;
//		}else{
//		  $importe_sin_igv=($temp_cantidad*$precio_en_soles);
//		}
//		///echo $importe_sin_igv;
//		
//		//-------------
//		//si el documento es inafecto y el producto afecto no se le saca igv
//		//si el documento es afecto y el producto inafecto no se le saca igv
//		//solo se le saca igv , si los dos son afectos. 
//		//-------------
//		//if($row['cod_ope']=='TS'){
//		//	$costo_inv=$costo_inv_ant;
//		//}else{
//		
//		//echo $importe_sin_igv."/".$factor_subund100."<br>";
//	//	echo "(($saldo_ant_costo*$costo_inv_ant)+($importe_sin_igv))/($saldo_ant_costo + ".$temp_cantidad.")"."<br>"	;
//		$costo_inv=(($saldo_ant_costo*$costo_inv_ant)+($importe_sin_igv))/($saldo_ant_costo + $temp_cantidad);
//	//	echo "(($saldo_ant_costo*$costo_inv_ant)+($importe_sin_igv))/($saldo_ant_costo + ".$temp_cantidad.")"."<br>"	;
//		//	echo $costo_inv."<br>";		
//		//}
//			
//		  $costo_inv=number_format($costo_inv,4,'.','');
//		
//		  $saldo_ant_costo=$temp_cantidad;
//		  $costo_inv_ant=$costo_inv;
//		
//		  $strSQL_updt="update det_mov set saldo_actual='".$saldo_actual."',costo_inven='".$costo_inv."' where cod_det='".$row['cod_det']."'";
//		  
//		 // echo $strSQL_updt."<br>";
//		  
//		  mysql_query($strSQL_updt,$cn);
//			//$saldo_actual
//	  	
//	}else{//caso si es ventas
//		 	
//			if($und_pr != $temp_unidad){
//				
//					$strSQL_unid="select * from unixprod where producto='".$row['cod_prod']."' and unidad='".$temp_unidad."'";
//					$resultado_unid=mysql_query($strSQL_unid,$cn);
//					$row_unid=mysql_fetch_array($resultado_unid);
//					$factor_subund=$row_unid['factor'];
//																
//				     //$temp_subunidad=(($factor_subund)*$_SESSION['productos3'][1][$subkey]);
//						$temp_subunidad=$temp_cantidad;
//					if ($factor_subund<>""){
//					//echo "sh";
//						if ($row_unid['mconv']=='P'){
//						//echo "procentual<br>";
//					//	echo "$temp_subunidad*($factor_pr/$factor_subund)";
//							$temp_subunidad=$temp_subunidad*$factor_subund;
//														
//						}else{
//						//echo "nominal<br>";
//						//nominal
//							//$temp_subunidad=(($temp_subunidad*$factor_subund)*10)/$row4['factor'];
//							$FacSbU = explode('.',$factor_subund);
//							//echo $FacSbU[0]		
//							$SuT1=$temp_subunidad*$FacSbU[0];	//5*1 - 5 
//							$SuT2=$temp_subunidad*$FacSbU[1];	//5*3 -	15				
//					$CatSu = explode('.',number_format($SuT2/$factor_pr,3,'.','.'));//agrege para redondeo
//							//$CatSu = explode('.',$SuT2/$row4['factor']); //15/12 - 1.25  /* 2.083
//							$SuT1=$SuT1+$CatSu[0]; //5+1 - 6
//							$SuT2=($CatSu[1]*$factor_pr)/100; // (25*12)/100 - 3							
//							$SuT2= number_format($SuT2,0,'','');	 //agrege para redondeo
//							$temp_subunidad=$SuT1.'.'.$SuT2 ; //6.3
//							
//										
//							
//						}						
//					}
//				
//						
//				}else{
//				 $temp_subunidad=$temp_cantidad;
//				}	 
//				$temp_cantidad=$temp_subunidad;
//		 // 	echo $temp_cantidad."  ";
//		  $saldo_actual=$saldo_ant-$temp_cantidad;
//		  		  
//		   $strSQL_updt="update det_mov set saldo_actual='".$saldo_actual."',costo_inven='0' where cod_det='".$row['cod_det']."'";
//
//		  mysql_query($strSQL_updt,$cn);
//		
//	}
//		
//		//echo $strSQL_updt."<br>";
//		//  echo $saldo_actual."<br>";
//			//if($registro==1){
//			//if()
//		
//			$strSQL_upd_costo="update producto set saldo".$tienda."='".$saldo_actual."', costo_inven".$sucursal."='".$costo_inv."' where idproducto='".$codprod."'";
//			mysql_query($strSQL_upd_costo,$cn);
//			
//		//	echo $strSQL_upd_costo."<br>";
//			
//			//}
//			
//		$i++;
//	
//	
//}

//-----------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------

if(isset($_REQUEST['codsucursal'])){
$filtro=" where cod_suc='".$_REQUEST['codsucursal']."'  ";

}

//***********************************************************************************************************

$strSQLTienda="select * from tienda  $filtro order by cod_tienda ";
$resultad0=mysql_query($strSQLTienda);



$codsucursal=0;

//echo $codprod;

while($rowTienda=mysql_fetch_array($resultad0)){

		if(substr($rowTienda['cod_tienda'],0,1)!=$codsucursal){
		$cos_saldo=0;
		}

		//recalculoActCost($codprod,gmdate("Y-m-d",time()-18000)," and c.tienda='".$rowTienda['cod_tienda']."'","2",substr($rowTienda['cod_tienda'],0,1));
		//echo $_REQUEST['calcular'] ;
		if($_REQUEST['calcular']=='saldos'){		
		
			 $resp=explode("?",recalculo2($codprod,gmdate("Y-m-d",time()-18000)," and c.tienda='".$rowTienda['cod_tienda']."'","4","",'recalculo'));
			// print_r($resp); echo "<br>";		
			$tot_saldo=$resp[0];
			$campoTienda="saldo".$rowTienda['cod_tienda'];	
			$strSQLUpdate="update producto set $campoTienda='".number_format($tot_saldo,4,'.','')."' where idproducto='".$codprod."' ";
			mysql_query($strSQLUpdate);
		
		}else{			
		
			 $resp2=explode("?",recalculo2($codprod,gmdate("Y-m-d",time()-18000)," and c.tienda='".$rowTienda['cod_tienda']."'","1",substr($rowTienda['cod_tienda'],0,1),'recalculo'));
					
			if($resp2[1]>0){
			 $cos_saldo=number_format($resp2[1],4,'.','');
			}
			 
			$campoSucursal="costo_inven".substr($rowTienda['cod_tienda'],0,1);							
			//$codsucursal=substr($rowTienda['cod_tienda'],0,1);						
			$strSQLUpdate="update producto set $campoSucursal='".$cos_saldo."' where idproducto='".$codprod."' ";
			mysql_query($strSQLUpdate);
			
			
		
		}
		//echo $strSQLUpdate."<br>";
		
}
//	die();

//******************************************************************************************************
/*
//---------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------

//$strSQL="select d.serie,d.numero,d.fechad,c.cod_cab,c.tienda,d.tipo,d.cantidad,d.precio,d.cod_det,c.moneda,d.afectoigv,tc,c.inafecto,c.cod_ope,flag_r,flag_kardex ,c.incluidoigv, d.fechad as fant,(select saldo_actual from det_mov det, cab_mov cab where kardex!='N' and cab.cod_cab=det.cod_cab and cab.flag!='A' and cod_prod='".$codprod."' and det.fechad < fant order by substring(fechad,1,10) desc,substring(fechad,12,19) desc  limit 1) as saldo_ant from det_mov d,cab_mov c where kardex!='N' and c.cod_cab=d.cod_cab and c.flag!='A' and cod_prod='".$codprod."' and c.cod_ope!='TS' and  ( (c.tipo='1' and flag_kardex='1') || (c.tipo='2' and flag_kardex='1') ) order by substring(fechad,1,10),substring(fechad,12,19) ";

$strSQL="select d.serie,d.numero,d.fechad,c.cod_cab,c.tienda,c.sucursal,d.tipo,d.cantidad,d.precio,d.cod_det,c.moneda,d.afectoigv,tc,c.inafecto,c.cod_ope,flag_r,flag_kardex ,c.incluidoigv, d.fechad,impto1 from det_mov d,cab_mov c where kardex!='N' and c.cod_cab=d.cod_cab and c.flag!='A' and cod_prod='".$codprod."' and c.cod_ope!='TS' and  ( (c.tipo='1' and flag_kardex='1') || (c.tipo='2' and flag_kardex='1') ) order by substring(fechad,1,10),substring(fechad,12,19) ";


$resultado=mysql_query($strSQL,$cn);
$registro=mysql_num_rows($resultado);

//"select saldo from det_mov d, cab_mov c where kardex!='N' and c.cod_cab=d.cod_cab and c.flag!='A' and cod_prod='".$codprod."' and c.cod_ope!='TS' and fechad<fechadoc order by fechad desc limit 1 "

//echo 

//echo $strSQL."<br><br>";
$costo_inven_ant=0;
$saldo_ant=0;
$tienda="";
$i=0;
$costo_inven_ant=0;

$saldo_ant=0;
$costo_inv=0;

while($row=mysql_fetch_array($resultado)){
	//echo "***<br>";
	//$saldo_ant_costo=$row['saldo_ant'];
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
				echo $documento." ".$numero;
				continue;
				}
		
	}
	
	
	//if($i==0){
//	$tienda=$row['tienda'];
//	$sucursal=substr($row['tienda'],0,1);
//	}
	
	$saldo_ant_costo=saldo_anterior($row['fechad'],$codprod,$row['sucursal'],$row['cod_cab']);
	
		if($sucursal==substr($row['tienda'],0,1)){
			$costo_inven_ant=$costo_inv;
				
		}else{
	
			$costo_inven_ant=0;
		//	$saldo_ant_costo=0;
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
	
		//	echo $row['serie']." ".$row['numero']." ".$row['fechad']." ".$row['cod_ope']."<br> (($saldo_ant_costo*$costo_inv_ant)+($importe_sin_igv))/($saldo_ant_costo + ".$row['cantidad'].")=$costo_inv<br>";	
			if(($saldo_ant_costo + $row['cantidad'])!=0){
				$costo_inv=(($saldo_ant_costo*$costo_inv_ant)+($importe_sin_igv))/($saldo_ant_costo + $row['cantidad']);
		
		
				
			$costo_inv=number_format($costo_inv,4,'.','');
			
		//	$saldo_ant_costo=$row['cantidad'];
			$costo_inv_ant=$costo_inv;
			}
			$strSQL_updt="update det_mov set costo_inven='".$costo_inv."' where cod_det='".$row['cod_det']."'";
	//	   mysql_query($strSQL_updt,$cn);
		   
		  $strSQL_upd_costo="update producto costo_inven".$sucursal."='".$costo_inv."' where idproducto='".$codprod."'";
			mysql_query($strSQL_upd_costo,$cn);
			
	$i++;
	
}
//---------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------
*/


//---------------------------------------------TRANSFERENCIAS---------------------------------------------------
//----------------------------------------------             ----------------------------------------------------

if(isset($_REQUEST['sucursal'])){
$sucursalx=$_REQUEST['sucursal'];
}else{
$sucursalx=$_REQUEST['codsucursal'];
}

$strSQL="select d.fechad,numero,c.serie,c.sucursal,c.cod_cab,d.tipo,d.cantidad,c.cod_ope from det_mov d,cab_mov c where c.cod_cab=d.cod_cab and c.flag!='A' and cod_prod='".$codprod."' and c.cod_ope='TS' and c.sucursal='".$_REQUEST['sucursal']."' order by d.fechad,c.tipo asc ";
//echo $strSQL."<br>";
$resultado=mysql_query($strSQL,$cn);
//$registro=mysql_num_rows($resultado);
$numero="";
$serie="";
while($row=mysql_fetch_array($resultado)){
	
	
	//echo $numero."=".$row['numero']."   ".$serie."=".$row['serie']."<br>";
	
		if($serie.$numero!=$row['serie'].$row['numero']){
		
		$sucursal_origen=$row['sucursal'];
		$fecha_origen=$row['fechad'];
		$cod_cab_origen=$row['cod_cab'];
		/*
		$strSQL2="select c.cod_cab,c.tienda,d.tipo,d.cantidad,d.precio,saldo_actual,costo_inven from det_mov d,cab_mov c where kardex!='N' and c.cod_cab=d.cod_cab and c.flag!='A' and cod_prod='".$codprod."' and c.tipo='1' and c.cod_ope!='TS' and fechad < '".$fecha_origen."' and c.sucursal='".$sucursal_origen."' order by d.fechad desc  limit 1";
		
		$resultado2=mysql_query($strSQL2,$cn);
		$row2=mysql_fetch_array($resultado2);
		*/
		//$costo_origen=$row2['costo_inven'];
		
		//echo $row['cod_cab']." ".$row['tipo']." ".$row['cod_ope']." ".$row['serie']." - ".$row['numero']."  <br>";
		
		$resp2=explode("?",recalculo2($codprod,substr($fecha_origen,0,10)," ","2",$sucursal_origen,'recalculo'));
				// echo $resp2[1]."<br>";
		 if($resp2[1]!=0){
		 $cos_saldo=number_format($resp2[1],4,'.','');
		 }
		 
		$numero=$row['numero'];
		$serie=$row['serie'];
		
		$str_upd2="update det_mov set precio='".$cos_saldo."',costo_inven='".$cos_saldo."' where cod_cab='".$row['cod_cab']."'  and cod_prod='".$codprod."'";
		//echo  $str_upd2."<br><br>"; 
		
		mysql_query($str_upd2,$cn);	
		
		continue;
		
		}
		$numero=$row['numero'];
		$serie=$row['serie'];
		
		$str_upd1="update det_mov set precio='".$cos_saldo."',costo_inven='".$cos_saldo."' where cod_cab='".$row['cod_cab']."' and cod_prod='".$codprod."' ";
		mysql_query($str_upd1,$cn);	
		
			
			
	//	echo $str_upd2."<br>";
	
	/*	
	$sucursal_destino=$row['sucursal'];
	$fecha_destino=$row['fechad'];
	$cantidad=$row['cantidad'];
	
	$strSQL3="select c.cod_cab,c.tienda,d.tipo,d.cantidad,d.precio,saldo_actual,costo_inven from det_mov d,cab_mov c where kardex!='N' and c.cod_cab=d.cod_cab and c.flag!='A' and cod_prod='".$codprod."' and c.tipo='1' and c.cod_ope!='TS' and fechad < '".$fecha_destino."' and c.sucursal='".$sucursal_destino."' order by d.fechad desc  limit 1";
	
	$resultado3=mysql_query($strSQL3,$cn);
	$row3=mysql_fetch_array($resultado3);
	$costo_destino=	$row3['costo_inven'];
	$saldo_destino=$row3['saldo_actual'];
	
		
		if($saldo_destino + $cantidad==0){
		$costo_inv=0;
		}else{
		$costo_inv=(($saldo_destino*$costo_destino)+($costo_origen*$cantidad))/($saldo_destino + $cantidad);
		}
		$costo_inv=number_format($costo_inv,4,'.','');
		
		//echo "(($saldo_destino*$costo_destino)+($costo_origen*$cantidad))/($saldo_destino + $cantidad)<br>";
		
	$str_upd1="update det_mov set precio='".$costo_origen."',costo_inven='".$costo_inv."' where cod_cab='".$cod_cab_origen."' ";
	$str_upd2="update det_mov set precio='".$costo_origen."',costo_inven='".$costo_inv."' where cod_cab='".$row['cod_cab']."' ";	
	
	//echo $str_upd1."<br>";
	//echo $str_upd2."<br>------------------<br>";
			
			
			mysql_query($str_upd1,$cn);	
			mysql_query($str_upd2,$cn);	
		*/
}



//select numero,c.serie,c.cod_cab,d.tipo,d.cantidad,c.cod_ope from det_mov d,cab_mov c where c.cod_cab=d.cod_cab and c.flag!='A' and cod_prod='001859' and c.cod_ope='TS' order by d.fechad

//select numero,c.serie,c.cod_cab,d.tipo,d.cantidad,c.cod_ope, SUM(if(c.tipo=1,c.serie,0)) AS alm_ing,SUM(if(c.tipo=2,c.serie,0)) AS alm_sal from det_mov d,cab_mov c where c.cod_cab=d.cod_cab and c.flag!='A' and cod_prod='001859' and c.cod_ope='TS' group by numero  order by d.fechad

?>
