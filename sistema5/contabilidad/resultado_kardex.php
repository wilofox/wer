<?php 
	session_start();
	include('../conex_inicial.php');
	include('../funciones/funciones.php');
	include('../funciones/Recalculo.php');

	$sucursal = $_REQUEST['sucursal'];
	$xtienda = $_REQUEST['tienda'];
	$des_suc = str_replace("|","&",$_REQUEST['des_suc']);
	$des_tie = $_REQUEST['des_tie'];
	$codigo = $_REQUEST['cod_prod'];
	$fecha1 = $_REQUEST['fecha1'];
	$fecha2 = $_REQUEST['fecha2'];
	$salidas = 0;
	$ingresos = 0;
	
    list($dir_tienda)=mysql_fetch_row(mysql_query("select direccion from tienda where cod_tienda='".$xtienda."'"));
    list($ruc_emp)=mysql_fetch_row(mysql_query("select ruc from sucursal where cod_suc='".$sucursal."'"));
	
	$resultados1 = mysql_query("SELECT * FROM producto WHERE idproducto = '".$codigo."'", $cn); 
	
	while( $row1 = mysql_fetch_array( $resultados1 ) ){
		$descripcion = $row1['nombre'];
		$cod_prod = $row1['cod_prod'];
		$codunidad = $row1['und'];
		$factor = $row1['factor'];
		$factorC = $row1['factorCompra'];
		$ccajas=$row1['ccajas'];
		$clasificacion=$row1['clasificacion'];		
	}
	//echo "------>".$clasificacion;
	mysql_free_result($resultados1);
		
	if($ccajas=='S'){
	$controlEnvases="";
	}else{
	$controlEnvases=" style='display:none' ";	
	}
	
	if($xtienda == "0"){
		$tienda = "Todas las Tiendas";
	}

	if($sucursal == '0'){
		$filtro_multi = "";
	}else{
		if($xtienda == '0'){
			$filtro_multi = "  c.sucursal='".$sucursal."' and ";
		}else{
			$filtro_multi = " c.tienda='".$xtienda."' and c.sucursal='".$sucursal."'and ";
			//$filtro_multi=" and c.tienda='$tienda' and c.sucursal='$sucursal' ";
		}
	}

	 
/*		
		 $strSQL_sal="select sum(cantidad) as cantidad from det_mov d ,cab_mov c where date(fechad) <'".$fecha1."' and cod_prod='".$codigo."' and  ".$filtro_multi." costo_inven=0 and c.cod_cab=d.cod_cab ";
				 
		 $resultado_sal=mysql_query($strSQL_sal,$cn);
		 $cont_sal=mysql_num_rows($resultado_sal);
		 $row_sal=mysql_fetch_array($resultado_sal);
		 $stock_ini=$row_sal['cantidad'];
		 
		 if($cont_sal==0){
		 $stock_ini=0;
		 }		 
		
		 		
		  $strSQL_sal2="select sum(cantidad) as cantidad from det_mov d ,cab_mov c where date(fechad) <'".$fecha1."' and cod_prod='".$codigo."' and ".$filtro_multi." costo_inven!=0 and c.cod_cab=d.cod_cab";
				 
		 $resultado_sal2=mysql_query($strSQL_sal2,$cn);
		 $cont_sal2=mysql_num_rows($resultado_sal2);
		 $row_sal2=mysql_fetch_array($resultado_sal2);
		 $stock_ini2=$row_sal2['cantidad'];
		 
		 if($cont_sal2==0){
		 $stock_ini2=0;
		 }
		 
		 $stock_ini=$stock_ini2-$stock_ini;
		 		 
         $strSQL_saldo_ini="select costo_inven from det_mov d ,cab_mov c where date(fechad) <'".$fecha1."' and cod_prod='".$codigo."' and ".$filtro_multi." costo_inven!=0 and c.cod_cab=d.cod_cab order by fechad asc limit 1 ";
		 
		 $resultado_saldo_ini=mysql_query($strSQL_saldo_ini,$cn);
		 $row_saldo_ini=mysql_fetch_array($resultado_saldo_ini);
		 $costo_inven=$row_saldo_ini['costo_inven'];
		 $saldo=$stock_ini*$row_saldo_ini['costo_inven'];
*/

	$strSQL = "
			SELECT
				c.cod_cab,
				c.tienda,
				d.tipo,
				d.cantidad,
				d.precio,
				d.cod_det,
				c.moneda,
				d.afectoigv,
				tc,
				c.inafecto,
				c.cod_ope,
				flag_r,
				flag_kardex,
				impto1
			FROM 
				det_mov d,
				cab_mov c 
			WHERE kardex != 'N' 
			AND c.cod_cab = d.cod_cab 
			AND c.flag != 'A' 
			AND cod_prod = '".$codigo."' 
			AND ".$filtro_multi." SUBSTRING(fechad,1,10) < '".formatofecha($fecha1)."' 
			ORDER BY d.tienda ASC ,d.fechad ASC";

	$resultado = mysql_query($strSQL,$cn);
	$registro = mysql_num_rows($resultado);
	

	//echo $strSQL."<br>";
	
	$costo_inven_ant = 0;
	$saldo_ant = 0;
	$tienda = "";
	$i = 0;
	$costo_inven_ant = 0;
	$saldo_ant_costo = 0;
	$saldo_ant = 0;
	$costo_inv = 0;
	$saldo_actual = 0;
	
//--------------------------------------------------------------------------------------------------------------

//
//while($row=mysql_fetch_array($resultado)){
//	
//	//echo $row['flag_r']."<br>";
//	$impto=1+($row['impto1']/100);
//	
//	
//	if($row['flag_r']!='' && ($row['flag_kardex']==$row['tipo']) ){
//	
//		$strSQL_ref="select kardex from referencia r , cab_mov c where r.cod_cab='".$row['cod_cab']."' and r.cod_cab_ref=c.cod_cab and kardex='S'";
//		$resultado_ref=mysql_query($strSQL_ref,$cn);
//		$cont_ref=mysql_num_rows($resultado_ref);
//	
//	//echo $strSQL_ref."<br>";
//		
//		$temp="";
//		if($row['flag_kardex']==''){
//		$tipomov=$row['tipo'];
//		}else{
//		$tipomov=$row['flag_kardex'];
//		}	
//		
//		if($row['flag_kardex']!=''){
//			if($row['tipo']!=$row['flag_kardex']){
//			$temp="pasar";
//			}
//		}
//		
//			if($cont_ref>0 && $temp==""){
//			continue;
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
//
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
//	if($tipomov==1){
//	
//		$saldo_actual=$saldo_ant+$row['cantidad'];
//		//echo $row['tc'];
//		if($row['moneda']==02){
//		$precio_en_soles=$row['precio']*$row['tc'];
//		}else{
//		$precio_en_soles=$row['precio'];
//		}
//		
//	//	echo $row['inafecto']." ".$row['afectoigv'];
//		if($row['inafecto']=='N' && $row['afectoigv']=='S'){
//		  $importe_sin_igv=($row['cantidad']*$precio_en_soles)/$impto;
//		}else{
//		  $importe_sin_igv=($row['cantidad']*$precio_en_soles);
//		}
//		//-------------
//		//si el documento es inafecto y el producto afecto no se le saca igv
//		//si el documento es afecto y el producto inafecto no se le saca igv
//		//solo se le saca igv , si los dos son afectos. 
//		//-------------
//	
//			$costo_inv=(($saldo_ant_costo*$costo_inv_ant)+($importe_sin_igv))/($saldo_ant_costo + $row['cantidad']);
//
//			
//		$costo_inv=number_format($costo_inv,4,'.','');
//		
//		$saldo_ant_costo=$row['cantidad'];
//		$costo_inv_ant=$costo_inv;
//		
//		  /*
//		  $strSQL_updt="update det_mov set saldo_actual='".$saldo_actual."',costo_inven='".$costo_inv."' where cod_det='".$row['cod_det']."'";
//  
//		  mysql_query($strSQL_updt,$cn);
//		  
//		  */
//	  	
//	}else{
//	
//		$saldo_actual=$saldo_ant-$row['cantidad'];
//		
//		/*	
//		  $strSQL_updt="update det_mov set saldo_actual='".$saldo_actual."',costo_inven='0' where cod_det='".$row['cod_det']."'";
//		  mysql_query($strSQL_updt,$cn);
//		
//		}
//		
//		*/
//		
//		/*
//			$strSQL_upd_costo="update producto set saldo".$tienda."='".$saldo_actual."', costo_inven".$sucursal."='".$costo_inv."' where idproducto='".$codprod."'";
//			mysql_query($strSQL_upd_costo,$cn);
//			
//		*/	
//			
//		
//			
//		$i++;
//
//	
//}
//	//echo $saldo_actual."<br>";
//}
////echo $saldo_actual;

//--------------------------------------------------------------------------------------------------------------

	if($sucursal == 0){
		$filtrod = "";
	}else{
		$filtrod = " and d.sucursal='$sucursal' ";
		
	}

	if($xtienda != "0"){			
		$filtrod .= " and d.tienda='$xtienda' ";
		list($dir_tienda)=mysql_fetch_row(mysql_query("select direccion from tienda where cod_tienda='".$xtienda."'"));
		
	}else{
	
		list($dir_tienda)=mysql_fetch_row(mysql_query("select direccion from sucursal where cod_suc='".$sucursal."'"));
	}	

	$resp = explode("?",recalculo2($codigo,formatofecha($fecha1),$filtrod,"3",""));
	$resp2 = explode("?",recalculo2($codigo,formatofecha($fecha1),$filtrod,"2",$sucursal));

	// if($resp[0]!='hoy'){
	$tot_saldo = $resp[0];
	//echo $tot_saldo;
	$cos_saldo = number_format($resp2[1],4);
	//$saldoIni=$resp[2];
	
	
	$costo_inven =$cos_saldo; 
	$saldoIni=$resp[0]*$cos_saldo;
	
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>::: Detalle de Movimientos :::</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo7 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.Estilo18 {font-size: 11px; font-weight: bold; color: #FFFFFF; }
.Estilo21 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
-->
body {
background-color:#F3F3F3;   
}
.Estilo117 {color:#003366; font-size: 10px; font-weight: bold; font-family:Tahoma, Arial;}
.Estilo122 {color: #000000; font-size: 11px; font-weight: bold; font-family: Tahoma, Arial; }
.Estilo126 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #000000; }
.Estilo128 {font-size: 11px; font-weight: bold; color: #FFFFFF; font-family: Arial, Helvetica, sans-serif; }

.BorderTabla{border-bottom:#E8E8E8 solid 1px;}
.Estilo129 {font-family: Arial, Helvetica, sans-serif}
</style>
</head>

<link href="../styles.css" rel="stylesheet" type="text/css">

<body>
<?php 
$textonuevo="";


$tempTexto = file_get_contents("1.txt");

if($tempTexto==""){

//$titulo=" FORMATO 13.1: REGISTRO DE INVENTARIO PERMANENTE VALORIZADO - DETALLE DEL INVENTARIO VALORIZADO \nPERIODO  desde:".$_REQUEST['fecha1']. " hasta ".$_REQUEST['fecha2']." \n SUCURSAL : $des_suc \n RUC : $ruc_emp \n ESTABLECIMIENTO : $des_tie \n DIRECCI&Oacute;N: ".caracteres($dir_tienda);

$textonuevo="<table><tr>
		<td align='right'><strong></strong></td>
        <td colspan='14' align='left'><strong>FORMATO 13.1: REGISTRO DE INVENTARIO PERMANENTE VALORIZADO - DETALLE DEL INVENTARIO VALORIZADO </strong></td>
		<tr>
		<td align='right'><strong></strong></td>
		<td colspan='14' align='left'><strong>Desde:".$_REQUEST['fecha1']. " Hasta ".$_REQUEST['fecha2']."</strong></td>
		</tr>
		<tr>
		<td align='right'><strong></strong></td>
		<td colspan='14' align='left'><strong>SUCURSAL : $des_suc </strong></td>
		</tr>
		<tr>
		<td align='right'><strong></strong></td>
		<td colspan='14' align='left'><strong>RUC : $ruc_emp </strong></td>
		</tr>
		<tr>
		<td align='right'><strong></strong></td>
		<td colspan='14' align='left'><strong>ESTABLECIMIENTO : $des_tie </strong></td>
		</tr>
		<tr>
		<td align='right'><strong></strong></td>
		<td colspan='14' align='left'><strong>DIRECCI&Oacute;N: ".caracteres($dir_tienda)." </strong></td>		
		</tr>
		<tr>
		<td align='right'><strong></strong></td>
		<td colspan='14' align='left'><strong></strong></td>
		
		</tr>
		</table>";

}





$textonuevo.="<table width='95%' height='274' border='0' cellpadding='0' cellspacing='0'>
    
  <tr>
    <td>&nbsp;</td>
    <td height='22' class='Estilo117'>C&Oacute;DIGO DE EXISTENCIA: <span class='Estilo7'>".$codigo." </span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height='22' class='Estilo117'>TIPO:
	 <span class='Estilo7'>";
	 
	  $resultados11 = mysql_query("select * from clasificacion where idclasificacion='".$clasificacion."' ",$cn); 
		while($row11=mysql_fetch_array($resultados11)){					
		//echo $row11['codsunat']." - ".$row11['descripcion'];
		 list($nomSunatCla)=mysql_fetch_row(mysql_query("select descripcion from sunat where  codsunat='".$row11['codsunat']."' and tabla='clasificacion' "));			 		
		$codSunatC=$row11['codsunat'];				
		}
		
		$textonuevo.= $codSunatC." - ".caracteres($nomSunatCla);
		
		$textonuevo.="</span>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height='22' class='Estilo117'>DESCRIPCI&Oacute;N : <span class='Estilo7'><strong>".caracteres(strtoupper($descripcion))."</strong></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height='22' class='Estilo117'>C&Oacute;DIGO DE UNIDAD DE MEDIDA : <span class='Estilo7'>";
	
	$resultados11 = mysql_query("select * from unidades where id='".$codunidad."' ",$cn); 
		while($row11=mysql_fetch_array($resultados11)){					
		//echo $row11['codsunat']." - ".$row11['descripcion'];
		 list($nomSunatUnid)=mysql_fetch_row(mysql_query("select descripcion from sunat where  codsunat='".$row11['codsunat']."' and tabla='unidad' "));	
		
		$codSunatU=$row11['codsunat'];
		} 
		
		$textonuevo.=$codSunatU." - ".$nomSunatUnid;
		
		$textonuevo.=" </span></td>
  </tr>
  
  <tr style='display:none'>
    <td>&nbsp;</td>
    <td height='25' class='Estilo117'><span class='Estilo117'>&nbsp;METODO DE VALUACION : </span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height='85'>
	
	<table width='97%' border='0' cellpadding='0' cellspacing='0'>
      <tr bgcolor='#97CBFF'>
        <td height='19' colspan='4' align='center'><span class='Estilo128'>Comprobante de Pago</span></td>
        <td>&nbsp;</td>
        <td colspan='3' align='center'><span class='Estilo128'>Ingresos</span></td>
        <td colspan='3' align='center'><span class='Estilo128'>Salidas</span></td>
        <td colspan='3' align='center' ><span class='Estilo128'>Saldos</span></td>
        </tr>
      <tr bgcolor='#97CBFF'>
        <td width='74' height='20' align='center'><span class='Estilo128'>Fecha</span></td>
        <td width='23' align='center'><span class='Estilo128'>Tipo</span></td>
        <td width='45' align='center'><span class='Estilo128'>Serie  </span></td>
        <td width='50' align='center'><span class='Estilo128'>N&uacute;mero</span></td>
        <td width='99'><span class='Estilo128'>Tipo Operaci&oacute;n</span></td>
        <td align='center'><span class='Estilo128'>Cantidad</span></td>
        <td align='center'><span class='Estilo128'>Costo Unitario</span></td>
        <td align='center'><span class='Estilo128'>Costo Total</span></td>
        <td width='54' align='center'><span class='Estilo128'>Cantidad</span></td>
        <td width='53' align='center'><span class='Estilo128'>Costo Unitario</span></td>
        <td width='47' align='center'><span class='Estilo128'>Costo Total</span></td>
        <td width='64' align='center'><span class='Estilo128'>Cantidad</span></td>
        <td width='52' align='center'><span class='Estilo128'>Costo Unitario</span></td>
        <td width='45' align='center'><span class='Estilo128'>Costo Total</span></td>
        </tr>
		
		
		
		 <tr>
        <td height='20' align='center' bgcolor='#FFFFFF' class='BorderTabla'>&nbsp;</td>
        <td align='center' bgcolor='#FFFFFF' class='BorderTabla'>&nbsp;</td>
        <td align='center' bgcolor='#FFFFFF' class='BorderTabla'>&nbsp;</td>
        <td align='center' bgcolor='#FFFFFF' class='BorderTabla'>&nbsp;</td>
        <td align='center' bgcolor='#FFFFFF' class='BorderTabla'>16</td>
        <td align='center' bgcolor='#DBFBE0' class='BorderTabla'>&nbsp;</td>
        <td align='right' bgcolor='#DBFBE0' class='BorderTabla' >&nbsp;</td>
        <td align='right' bgcolor='#DBFBE0' class='BorderTabla'>&nbsp;</td>
        <td align='center' bgcolor='#FFFFFF' class='BorderTabla'>&nbsp;</td>
        <td align='right' bgcolor='#FFFFFF' class='BorderTabla'>&nbsp;</td>
        <td align='right' bgcolor='#FFFFFF' class='BorderTabla'>&nbsp;</td>
        <td align='right' bgcolor='#DBFBE0' class='BorderTabla'>".$tot_saldo."</td>
        <td align='right' bgcolor='#DBFBE0' class='BorderTabla'>".$cos_saldo."</td>
        <td align='right' bgcolor='#DBFBE0' class='BorderTabla'>".number_format($saldoIni,4)."</td>
        </tr>";
		
?>     	
	  
	 <?php 
	  
	  $existencia = $tot_saldo;

	 //$existencia=$stock_ini;
	// $costo_inven=0;
//	  echo "select c.flag_r,c.incluidoigv,c.serie,Num_doc,c.cod_ope,cliente,fecha,c.tienda,c.tipo,cantidad,c.cod_cab as referencia,precio,costo_inven,flag_kardex,afectoigv,c.moneda,c.tc,c.inafecto,d.cod_det,impto1,unidad from cab_mov c,det_mov d where  flag!='A' and ".$filtro_multi."  c.cod_cab=d.cod_cab and cod_prod='$codigo' and date(fechad) between '".formatofecha($fecha1)."' and '".formatofecha($fecha2)."' and kardex='S' order by substring(fechad,1,10),flag_kardex,substring(fechad,12,19) ";

	 $strSql = "
			SELECT 
				c.flag_r,
				c.incluidoigv,
				c.serie,
				Num_doc,
				c.cod_ope,
				cliente,
				fecha,
				c.tienda,
				c.tipo,
				cantidad,
				c.cod_cab as referencia,
				precio,
				costo_inven,
				flag_kardex,
				afectoigv,
				c.moneda,
				c.tc,
				c.inafecto,
				d.cod_det,
				impto1,
				unidad,
				sunat,
				c.condicion
			FROM 
				cab_mov c,
				det_mov d,
				operacion o 
			WHERE 
				flag != 'A' 
				AND ".$filtro_multi." c.cod_cab = d.cod_cab 
				AND cod_prod = '".$codigo."' 
				AND date(fechad) between '".formatofecha($fecha1)."' 
				AND '".formatofecha($fecha2)."'
				AND c.kardex = 'S'
				AND o.codigo=c.cod_ope
				AND o.sunat!=''
				ORDER BY substring(fechad,1,10), flag_kardex, substring(fechad,12,19)";

		//echo $strSql;

	  $resultados10 = mysql_query($strSql,$cn);

	
						//	 echo "select c.flag_r,c.incluidoigv,c.serie,Num_doc,c.cod_ope,cliente,fecha,c.tienda,c.tipo,cantidad,c.cod_cab as referencia,precio,costo_inven,flag_kardex,afectoigv,c.moneda,c.tc,c.inafecto,d.cod_det,impto1,unidad from cab_mov c,det_mov d where  flag!='A' and ".$filtro_multi."  c.cod_cab=d.cod_cab and cod_prod='$codigo' and date(fechad) between '".formatofecha($fecha1)."' and '".formatofecha($fecha2)."' and kardex='S' order by substring(fechad,1,10),flag_kardex,substring(fechad,12,19) ";
	
	// echo "select c.serie,Num_doc,c.cod_ope,cliente,fecha,c.tienda,c.tipo,cantidad from cab_mov c,det_mov d where c.cod_cab=d.cod_cab and cod_prod='$codigo' and date(fechad) between '".$fecha1."' and '".$fecha2."' order by fechad asc ";

$j=0;
	$totalReg=mysql_num_rows($resultados10); 
		/*
		if($totalReg==0){
		die;		
		}
		*/
		
	while($row10=mysql_fetch_array($resultados10)){
		$referencia=$row10['referencia'];
		$numero=$row10['serie']."-".$row10['Num_doc'];
		$serieDoc=$row10['serie'];
		$numeroDoc=$row10['Num_doc'];
		
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
		$envases=$row10['envases'];
		$doc_sunat=$row10['sunat'];
		
		if($row10['flag_r']!=''){
	$strSQL_ref="select kardex from referencia r , cab_mov c where r.cod_cab='".$row10['referencia']."' and r.cod_cab_ref=c.cod_cab and kardex='S'";
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
		
							
		if($row10['tipo']!=$act_kar_IS && $act_kar_IS!="" ){
			  $tipomov_temp=$act_kar_IS;					
		}else{
			  $tipomov_temp=$row10['tipo'];
		}
					
		//if($tipomov_temp=='1'){
			
		if($tipomov_temp==1){
		//echo $codigo."--><br>";
			// sub unidad kardex Yedem
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
			$salidas="0";
			
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
						if($factorSub!='' && $factorSub!=0){
						$punit=$punit/$factorSub;
						}
						
						//echo "sdg";
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
		
		$existCajas=$existCajas+$envases;	
		$totalI=$totalI+$envases;
	    }else{
		$existCajas=$existCajas-$envases;	
		$totalS=$totalS+$envases;

			//echo $codunidad;
			//echo $factor;
			//echo $row10['unidad'];
	//----------------subunidadesssss---------------------------	
			if ($codunidad!=$row10['unidad']){
			//$salidas=19;
			//echo "dg";
				$strSQL_unid="select * from unixprod where producto='".$codigo."' and unidad='".$row10['unidad']."'";
				$resultado_unid=mysql_query($strSQL_unid,$cn);
				$row_unid=mysql_fetch_array($resultado_unid);
				$factor_subund=$row_unid['factor'];
			//echo $factor_subund;
				 $salidas=$row10['cantidad'];
				if ($factor_subund<>""){
							if ($row_unid['mconv']=='P'){
							//procentual
								//$salidas=$salidas*($factor/$factor_subund);
								$salidas=$salidas*$factor_subund;
							}else{
					$FacSbU = explode('.',$factor_subund);
					$SuT1=$salidas*$FacSbU[0];	//5*1 - 5 
					$SuT2=$salidas*$FacSbU[1];	//5*3 -	15			
					//echo $SuT2;
					$CatSu = explode('.',number_format($SuT2/$factor,3,'.','.'));
					//echo $factor;
					//$CatSu = explode('.',$SuT2/$factor); //15/12 - 1.25						
					$SuT1=$SuT1+$CatSu[0]; //5+1 - 6
					$SuT2=($CatSu[1]*$factor)/100; // (25*12)/100 - 3
					$SuT2= number_format($SuT2,0,'','');			
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
			$ingresos="0";
			
			$debe="0";
		 	$haber=$costo_inven*$salidas;
			$saldo=$saldo-$haber;
		}
		
		$saldo_actual=0;		
		
		$textonuevo.="<tr>
        <td height='20' align='center' bgcolor='#FFFFFF' class='BorderTabla'><span class='Estilo21'>".formatofecha($fecha)."</span></td>
        <td align='center' bgcolor='#FFFFFF' class='BorderTabla'><span class='Estilo21'>&nbsp;".str_pad($doc_sunat,2,"0",STR_PAD_LEFT)."  </span></td>
        <td align='center' bgcolor='#FFFFFF' class='BorderTabla'><span class='Estilo21'>&nbsp;".str_pad($serieDoc,3,"0",STR_PAD_LEFT)."</span></td>
        <td align='center' bgcolor='#FFFFFF' class='BorderTabla'>&nbsp;".str_pad($numeroDoc,7,"0",STR_PAD_LEFT)."</td>
        <td align='center' bgcolor='#FFFFFF' class='BorderTabla'>&nbsp;";	
									
	 ?> 
	 
	 
	<?php 
		
		if($row10['tipo']=='1'){		
		 list($codSunatCond)=mysql_fetch_row(mysql_query("select codsunat1 from condicion where codigo='".$row10['condicion']."' "));	
		}else{ 
		list($codSunatCond)=mysql_fetch_row(mysql_query("select codsunat2 from condicion where codigo='".$row10['condicion']."' "));
		}
		$textonuevo.=str_pad($codSunatCond,2,"0",STR_PAD_LEFT);	
		$textonuevo.="</td>
        <td width='59' align='center' bgcolor='#DBFBE0' class='BorderTabla'><span class='Estilo21'>";		
		
		?>		
		<?php 
		if($ingresos!=''){
		$textonuevo.=$ingresos;		
		}else{
		$textonuevo.="&nbsp;";		
		}
		
		$textonuevo.="</span></td>
        <td width='34' align='right' bgcolor='#DBFBE0' class='BorderTabla' ><span class='Estilo21'>";
			
		?>
		
        <?php 
		if ($_SESSION['nivel_usu']==2){
		$textonuevo.="***";				
		}else{
		$textonuevo.=number_format($punit,4,'.',',');			
		}
		
		$textonuevo.="</span></td>
        <td width='43' align='right' bgcolor='#DBFBE0' class='BorderTabla'><span class='Estilo21'>"; 
		
	 	?>
		
       
          <?php 
			if ($_SESSION['nivel_usu']==2){
				//echo '';
				$textonuevo.="***";
				}else{
					if($debe!=''){
					
					$textonuevo.=number_format($debe,2,'.',',');
					}
				$totDebe=$totDebe+$debe;					
			}
			
		$textonuevo.="</span></td>
        <td align='center' bgcolor='#FFFFFF' class='BorderTabla'><span class='Estilo21'>";
		
		 ?>
       
		
		<?php 
		
		
		if($salidas!=''){		
		$textonuevo.=$salidas; 
		}else{
		$textonuevo.="&nbsp;"; 		
		}
		
		$textonuevo.="</span></td>
        <td align='right' bgcolor='#FFFFFF' class='BorderTabla'><span class='Estilo21'>";
				
		?>
		
		
        <?php 
		if ($_SESSION['nivel_usu']==2){
		$textonuevo.="***";
		}else{
		$textonuevo.=number_format($punit,4,'.',',');
		}
		
		$textonuevo.="</span></td>
        <td align='right' bgcolor='#FFFFFF' class='BorderTabla'><span class='Estilo21'>";
		
	 ?>
       
        <?php 
		
		if ($_SESSION['nivel_usu']==2){
		//echo '***';
		$textonuevo.="***";
		}else{
		//echo number_format($haber,4,".",",");
		//echo "$nuevoCosto*$salidas";
		$textonuevo.=number_format($nuevoCosto*$salidas,2,'.',',');		
		$totalHaber=$totalHaber+($nuevoCosto*$salidas);
		
		}
		
		$textonuevo.=" </span></td>
        <td align='right' bgcolor='#DBFBE0' class='BorderTabla'><span class='Estilo21'> ";
		
		 ?>
       
		<?php 
		//echo $existencia; 	
		/*
		if ($row_unid['mconv']<>'P'){
			$ExisVal = explode('.',$existencia);
			echo $ExisVal[0];
			if ($ExisVal[1]>0){
			echo ' / ';		
			echo $factor-(10-$ExisVal[1]);
			}
		}else{
			echo $existencia; 	
		}	
		*/
		//-----------------------------------------------------
		
			if($j==0){
				$stockAnterior=$tot_saldo;
				$costoAnterior=$cos_saldo;
				$nuevoCosto=$costoAnterior;
			}
			
			
			
			if($row10['tipo']==1){	
				$precioActual=$punit;
				$cantActual=$ingresos;
				
				if($cantActual+$stockAnterior!=0){
				   $nuevoCosto= (($stockAnterior * $costoAnterior)+($cantActual*$precioActual))/($cantActual+$stockAnterior);
				}else{
				   $nuevoCosto=0;
				}				
				

				//echo "(($stockAnterior * $costoAnterior)+($cantActual*$precioActual))/($cantActual+$stockAnterior)";
				$costoAnterior=$nuevoCosto;
			}

			$stockAnterior=$stockAnterior-$salidas+$ingresos;
			
			//-----------------------------------------------
		
		$textonuevo.=$existencia;
		
		$textonuevo.="</span><span class='Estilo21'>&nbsp;</span></td>
        <td align='right' bgcolor='#DBFBE0' class='BorderTabla'><span class='Estilo21'>";
		
		
			
		?>
			
			
          <?php 
		if ($_SESSION['nivel_usu']==2){
		//echo '***';
		$textonuevo.="***";
		}else{
		//echo number_format($punit,4,'.',',');
		$textonuevo.=number_format($nuevoCosto,4);
 		
		}
		
		$textonuevo.="</span></td>
        <td align='right' bgcolor='#DBFBE0' class='BorderTabla'><span class='Estilo21'>";
		
	 ?>
       
          <?php 
		 if ($_SESSION['nivel_usu']==2){
		 $textonuevo.="***";
		 }else{
	//echo number_format($saldo,2,".",",");
	//echo $existencia." * ".$nuevoCosto."  ";
		$textonuevo.=number_format($existencia*$nuevoCosto,2,'.',',');
	    
	
	if(!isset($_SESSION['totalValorizado'])){
		
		$_SESSION['totalValorizado']=0;
		
		}else{
		$_SESSION['totalValorizado']=$_SESSION['totalValorizado'] + number_format($existencia*$nuevoCosto,2,'.',',');	
		}
	
	
	}
	
	$textonuevo.="  </span></td>
        </tr> ";
		
		
		?>
      
	  
	  <?php  
	  
	  $j++;
	  }	
	  
	  if($total_ingresos=='')$total_ingresos=0;
	  if($total_salidas=='')$total_salidas=0;
	  
	  $textonuevo.="  <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan='2'>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan='3'>&nbsp;</td>
        <td colspan='3'>&nbsp;</td>
        <td colspan='3'>&nbsp;</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan='2'>&nbsp;</td>
        <td align='right'><strong>Total Periodo: </strong></td>
        <td align='right'>".$total_ingresos." </td>
        <td align='right'>&nbsp;</td>
        <td align='right'>".number_format($totDebe,2)." </td>
        <td align='right'>".$total_salidas."</td>
        <td align='right'>&nbsp;</td>
        <td align='right'>".number_format($totalHaber,2)."</td>
        <td colspan='3'>&nbsp;</td>
        </tr>";
		
	  ?>
	  

     <?php 
	 if($_REQUEST['ultimoItem']=='S'){	 
		
	$textonuevo.="  <tr>
        <td height='43' colspan='11' align='right'><strong>Total</strong><strong> General Valorizado: </strong></td>
        <td colspan='3' align='right'><strong>".$_SESSION['totalValorizado']."</strong></td>
      </tr> ";
	 
	 ?>
    
     <?php 
	}
	
	$textonuevo.=" </table></td>
  </tr>
</table>";

	 ?> 


<?php 
//$dato="prueba";





$file=fopen("1.txt","a+") or exit("Unable to open file!");

   fwrite($file,$titulo."\n".$textonuevo."\n");

fclose($file)


?>


</body>
</html>

<?php 
mysql_free_result($resultados10);

?>

<script>
function doc_det(valor){
window.open("../doc_det2.php?referencia="+valor,"","toolbar=no,status=no, menubar=no, scrollbars=yes, resizable=yes, width=520, height=320,left=300 top=250");
}

</script>




