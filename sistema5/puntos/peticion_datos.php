<?
session_start();
include('../conex_inicial.php');
include('../funciones/funciones.php');
$peticion=$_REQUEST['peticion'];
$codigo=$_REQUEST['codigo'];
$codprod=$_REQUEST['codprod'];
$prodet=$_REQUEST['prodet'];
$punto=$_REQUEST['punto'];
$puntosaldo=$_REQUEST['puntosaldo'];
$condicion=$_REQUEST['condicion'];
$efectivo=$_REQUEST['efectivo'];
$tienda=$_REQUEST['tienda'];

$fecha=date('d-m-Y');

switch($peticion){
	case "save_canje":
		 
		 $strSQL="select  max(num_corre) as codigo from canjes  where cod_ope='CJ' ";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$numero=$row['codigo']+1;
		$numero=str_pad($numero, 7, "0", STR_PAD_LEFT);
		$serie='001';
		$campotienda='saldo'.$tienda;
		 
		$strSQL3="insert into canjes(fecha,cliente,cod_ope,num_serie,num_corre,tienda,punt_canje,efectivo,cod_prod,punt_saldo,cod_vendedor,pc,estado)values('".cambiarfecha($fecha)."','".$codigo."','CJ','".$serie."','".$numero."','".$tienda."','".$punto."','".$efectivo."','".$codprod."','".$puntosaldo."','".$_SESSION['codvendedor']."','".$_SESSION['pc_ingreso']."','".$estado."')";
		mysql_query($strSQL3,$cn);
		
		
		$strSQL="select * from producto where idproducto='".$codprod."'  ";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$kardex=$row['kardex'];
		$nombreprod=$row['nombre'];
		$afecto=$row['igv'];
		$unidad=$row['und'];
		
		if($kardex=='S'){
			$strSQL3="update producto set $campotienda=$campotienda-1 where idproducto='".$codprod."'"; 
			mysql_query($strSQL3,$cn);
		}
				
		$auxiliar=$codigo;
		$doc="CJ";
		$femision=cambiarfecha($fecha);
		$fvencimiento=cambiarfecha($fecha);
		$moneda="01"; $impto="19";  		
		$strSQL="select  max(cod_cab) as cod_cab from cab_mov";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$codcab=$row['cod_cab']+1;		
		
		$strSQL3="insert into cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,caja,cliente,ruc,fecha,f_venc,moneda,impto1,tc,b_imp,igv,servicio,percepcion,total,saldo,tienda,sucursal,flag,flag_r,motivo,noperacion,items,condicion,incluidoigv,obs1,obs2,obs3,obs4,obs5,inafecto,fecha_aud,pc,kardex,deuda,transportista,chofer,dirPartida,dirDestino,numeroOT,fecharegis,flete,puntos)values('".$codcab."','2','".$doc."','".$numero."','".$serie."','".$_SESSION['codvendedor']."','".$caja."','".$auxiliar."','".$ruc."','".$femision."','".$fvencimiento."','".$moneda."','".$impto."','".$_SESSION['tc']."','".$monto."','".$impuesto1."','".$servicio."','".$percepcion."','".$total_doc."','".$saldo."','".$tienda."','".substr($tienda,0,1)."','".$flag."','".$flag_r."','".$motivo."','".$noperacion."','".$items."','".$condicion."','S','".$obs1."','".$obs2."','".$obs3."','".$obs4."','".$obs5."','S','".$femision."','".$_SESSION['pc_ingreso']."','S','N','".$transportista."','".$chofer."','".$dirPartida."','".$dirDestino."','".$serieOT."-".$numeroOT."','".cambiarfecha($fecharegis)."','".$_SESSION['montoFlete']."','".$_SESSION['totalPuntosDoc']."')"; 
		
		mysql_query($strSQL3,$cn);	
		
		$strSQL444="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,tcambio,moneda,precio,cantidad,imp_item,fechad,descargo,afectoigv,costo_inven,saldo_actual,notas,flag_kardex,unidad,flag_percep,porcen_percep,ancho,largo,mt2,factor,descOT,codanex,desc1,desc2,puntos) values('".$codcab."','2','".$doc."','".$serie."','".$numero."','".$auxiliar."','".$tienda."','".substr($tienda,0,1)."','".$codprod."','".$nombreprod."','".$_SESSION['tc']."','".$moneda."','0','1','0','".$femision."','".$kardex."','".$afecto."','".number_format($costo_inven1,2)."','".$saldo_actual."','','2','".$unidad."','','','','','','','','','".$desc1."','".$desc2."','')"; 
		  	  
	   	mysql_query($strSQL444,$cn);						
		
		echo $serie."|".$numero."|".$tienda."|".$codigo."|".$fecha."|".$punto."|".$efectivo."|".$codprod."|".$puntosaldo."|";
		
	break;
	case "anular_canje":
	//$codigo=str_pad($codigo, 11, "0", STR_PAD_LEFT);
		
	$strSQL_ref2="update canjes set estado='$condicion' where id='".$codigo."' ";
	mysql_query($strSQL_ref2);
	
	//actualizar saldo
	/*
	$resultados11 = mysql_query("select * from punto_mov  where cod_punto='".$codigo."' ",$cn); 
	$rowSM=mysql_fetch_array($resultados11);
	$cod_trans=$rowSM['cod_trans'];
	$puntacu=$rowSM['punt_acumulado'];
	
	if ($condicion=='A'){
		$Sal_D=" saldo_punto-'".$puntacu."' ";
	}else{
		$Sal_D=" '".$puntacu."'+saldo_punto ";
	}
		*/
	//validar desanular
	/*
	$resulA = mysql_query("select *,".$Sal_D." as SaldoX from transp_cliente 
	 where cod_trans='".$cod_trans."' ",$cn); 
	$rowA=mysql_fetch_array($resulA);
	$tol_p=$rowA['total_punto'];
	$SaldoX=$rowA['SaldoX'];
	*/
	/*
	if ($SaldoX>$tol_p){
		echo 'error';	
		$strSQL_ref2="update punto_mov set estado='A' where cod_punto='".$codigo."' ";
		mysql_query($strSQL_ref2);			
	}else{
		$strSQL_ref2="update transp_cliente set saldo_punto=".$Sal_D." 
		where cod_trans='".$cod_trans."'";
		mysql_query($strSQL_ref2);
	}
	*/
	
	break;
	
	case "rec_punto":
			
			
			
	$strSQL="SELECT MH.placa,sum( total ) / 1.38 AS tot_punto,fec_alta
FROM master_historial MH
INNER JOIN transp_cliente TC ON MH.placa = TC.placa
WHERE estado = 'S' 
GROUP BY MH.placa,fec_alta ";
	$resultadoX=mysql_query($strSQL,$cn);
	while($rowX=mysql_fetch_array($resultadoX)){
	
		//rnago por fecha de inico de actividad
		//echo $rowX['fec_alta'].'-';
		
		$resultados11 = mysql_query("select sum( total )  AS tot_punto, master_historial.*  from master_historial  
		where placa='".$rowX['placa']."'
		and fec_hor_des>='".$rowX['fec_alta']."'  ",$cn); 	
		 //	 fec_hor_des BETWEEN '".$rowX['fec_alta']."' AND '".cambiarfecha($fecha)."'
	    $rowTP=mysql_fetch_array($resultados11);
	    //echo $T_punto=$rowTP['tot_punto'].'<br>';	
		
		list($factor)=mysql_fetch_row(mysql_query("select factor from factores where '".substr($rowTP['fec_hor_des'],0,10)."'  between fecha and fecha2 limit 1"));

		if($factor=='' || $factor==0){
		$factor=1;
		}
		
					
		$strSQL_ref2=" update transp_cliente set total_punto='".$rowTP['tot_punto']/$factor."' 
		where  placa='".$rowX['placa']."' and estado ='S' ";		
		mysql_query($strSQL_ref2);
		
		
	}
	// recalculo de punto cangeados
	$strSQL_ref2=" update transp_cliente set saldo_punto='0' and estado='S' ";
	mysql_query($strSQL_ref2);
	
	$strSQL="SELECT placa,sum( punt_acumulado ) AS punto,fec_alta
FROM punto_mov PM
INNER JOIN transp_cliente TC ON PM.cod_trans = TC.cod_trans
WHERE TC.estado = 'S' and PM.estado <> 'A'
GROUP BY TC.cod_trans,fec_alta ";
	$resultadoX=mysql_query($strSQL,$cn);
	while($rowX=mysql_fetch_array($resultadoX)){		
	echo	$strSQL_ref2=" update transp_cliente set saldo_punto='".$rowX['punto']."'  
		where  placa='".$rowX['placa']."' and estado ='S' and fec_alta>='".substr($rowX['fec_alta'],0,10)."'  ";
		mysql_query($strSQL_ref2);
	}
	
		echo 'Recalculando punto ..';	
		
	break;
	

}
?>
