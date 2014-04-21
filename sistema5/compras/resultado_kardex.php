<?php 
	//session_start();

	include('../conex_inicial.php');
	include('../funciones/funciones.php');
	include('../funciones/Recalculo.php');


	if(isset($_REQUEST['excel'])){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=excel.xls");
	}else{
	//session_start();
	}
	
	
	$sucursal = $_REQUEST['sucursal'];
	$xtienda = $_REQUEST['tienda'];
	$des_suc = str_replace("|","&",$_REQUEST['des_suc']);
	$des_tie = $_REQUEST['des_tie'];
	$codigo = $_REQUEST['cod_prod'];
	$fecha1 = $_REQUEST['fecha1'];
	$fecha2 = $_REQUEST['fecha2'];
	$salidas = 0;
	$ingresos = 0;

	$resultados1 = mysql_query("SELECT * FROM producto WHERE idproducto = '".$codigo."'", $cn); 
	
	while( $row1 = mysql_fetch_array( $resultados1 ) ){
		$descripcion = $row1['nombre'];
		$cod_prod = $row1['cod_prod'];
		$codunidad = $row1['und'];
		$factor = $row1['factor'];
		$factorC = $row1['factorCompra'];
		$ccajas=$row1['ccajas'];
	}
	
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
	
	$strSQL4x="select * from modelo where cod_prod='".$codigo."'";
					
							//echo $strSQL4x;
	$resultado4x=mysql_query($strSQL4x,$cn);
	$contModel=mysql_num_rows($resultado4x);
	
		if($contModel>0){
			$esmodelo='S';							
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
	}	

	$resp = explode("?",recalculo2($codigo,formatofecha($fecha1),$filtrod,"3","",''));
	$resp2 = explode("?",recalculo2($codigo,formatofecha($fecha1),$filtrod,"2",$sucursal,''));

	// if($resp[0]!='hoy'){
	$tot_saldo = $resp[0];
	//echo $tot_saldo;
	if($resp2[1]!=''){
	$cos_saldo = number_format($resp2[1],4);
	}
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
<table width="100%" height="207" border="0" cellpadding="0" cellspacing="0">
    <tr>
    <td height="19">&nbsp;</td>
    <td class="Estilo117">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="193" rowspan="5">
	
	<table width="193" height="90" border="0"  align="left" cellpadding="0" cellspacing="0" style="border:#CCCCCC solid 1px">
      <tr>
        <td height="25" colspan="3" class="Estilo117">&nbsp;&nbsp;&nbsp;&nbsp;Rango de Fechas </td>
      </tr>
      <tr>
        <td width="16" class="Estilo117">&nbsp;</td>
        <td width="81" height="21" class="Estilo117">Desde:</td>
        <td width="94" class="Estilo117">Hasta:</td>
      </tr>
      <tr>
        <td class="Estilo7">&nbsp;</td>
        <td height="42" class="Estilo7"><input readonly="readolnly" name="fecha_ini" type="text" size="10" maxlength="10" value="<?php echo $fecha1;?>"></td>
        <td class="Estilo7"><input name="fecha_fin" type="text" readonly="readolnly" size="10" maxlength="10" value="<?php echo $fecha2; ?>"></td>
      </tr>
    </table>
	
	</td>
    </tr>
  <tr>
    <td width="5" height="26">&nbsp;</td>
    <td width="74" class="Estilo117">Sucursal</td>
    <td colspan="2"><span class="Estilo7">
      <input name="sucursal" type="text" value="<?php echo $des_suc; ?>" size="25" maxlength="200" readonly="readonly">
      </span><span class="Estilo117">Tienda</span><span class="Estilo122">:
      </span><span class="Estilo126">
      </span><span class="Estilo7">
      <input name="tienda" type="text" value="<?php echo $des_tie; ?>" size="25" maxlength="200" readonly="readonly">
      </span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="26" class="Estilo117">Producto</td>
    <td colspan="2"><span class="Estilo7">
      <input readonly="readonly" style="background-color:#FFF1BB" name="codigo_prod" type="text" size="10" maxlength="10" value="<?php echo $codigo; ?>">
      <input style="background-color:#FFF1BB" readonly="readonly" name="descripcion" type="text" size="55" maxlength="200" value="<?php echo $descripcion; ?>">
    </span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="26" class="Estilo117">Cod.Anexo</td>
    <td colspan="2"><span class="Estilo7"><span class="Estilo117">
      <input  readonly="readonly" name="textfield22" type="text" size="16" value="<?php echo $cod_prod  ?>">
    </span></span><span class="Estilo7"><span class="Estilo117">&nbsp;&nbsp;&nbsp;Unidad Principal:
          <input  readonly="readonly" name="textfield2" type="text" size="14" value="<?
	 $resultados11 = mysql_query("select * from unidades where id='".$codunidad."' ",$cn); 
	while($row11=mysql_fetch_array($resultados11)){					
		echo $row11['descripcion'].' ('.$factor.') ';
		
			  }  
	  ?>">
&nbsp;</span></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="25" class="Estilo117"><span class="Estilo117">Moneda</span></td>
    <td width="113"><input readonly="readolnly" name="textfield" type="text" size="12" maxlength="10" value="SOLES S/."></td>
    <td width="490"><span class="Estilo117">&nbsp;&nbsp;</span><span class="Estilo7">
      &nbsp;</span><span class="Estilo117">Stock Inicial:</span><span class="Estilo7">
      <input style="text-align:right" name="stock_ini"  readonly="readonly" type="text" size="10" maxlength="10" value="<?php echo $tot_saldo ?>">
      <input name="saldo_ini" readonly="readonly" type="hidden" size="10" maxlength="10" value="<?php echo $saldo;?>">
      <span class="Estilo117">Costo Inventario </span>
      <input style="text-align:right" name="costo_ini" readonly="readonly" type="text" size="10" maxlength="10" value="<?php echo $cos_saldo;?>">
      <span class="Estilo117">&nbsp;&nbsp;Saldo Inicial: 
     
	  <input style="text-align:right" name="saldoIni" id="saldoIni" readonly="readonly" type="text" size="10" maxlength="10" value="<?php echo number_format($saldoIni,4); ?>">
    </span></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="85" colspan="4">
	
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr style="background:url(../imagenes/bg_contentbase4.gif); background-position:100px 50px">
        <td width="17" align="center"><span class="Estilo18">O</span></td>
        <td width="38" height="19" align="center"><span class="Estilo128">Tienda</span></td>
        <td width="70" align="center"><span class="Estilo128">Fecha</span></td>
        <td width="21" align="center"><span class="Estilo128">TD</span></td>
        <td width="81" align="center"><span class="Estilo128">N&uacute;mero</span></td>
        <td width="80"><span class="Estilo128">Cliente/Proveedor</span></td>
        <td width="80" align="center"><span class="Estilo128">Doc.Ref</span></td>
        <td width="65" align="center" <?php echo $controlEnvases ?>><span class="Estilo128">Cajas</span></td>
        <td width="65" align="center"><span class="Estilo128">Ingresos</span></td>
        <td width="65" align="center"><span class="Estilo128">Salidas</span></td>
        <td width="65" align="center" ><span class="Estilo128">Existencia</span></td>
        <td width="65" align="center" <?php echo $controlEnvases ?>><span class="Estilo128">Exist.Cajas</span></td>
        <td width="65" align="center"><span class="Estilo128">Debe</span></td>
        <td width="65" align="center"><span class="Estilo128">Haber</span></td>
        <td width="65" align="center"><span class="Estilo128">Saldo</span></td>
		 <td width="65" align="center"><span class="Estilo128">Tc.doc</span></td>
        <td width="65" align="center"><span class="Estilo128">C.compra</span></td>
		<td width="65" align="center"><span class="Estilo128">C. Inv</span></td>
      </tr>
	  
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
				envases 
			FROM 
				cab_mov c,
				det_mov d 
			WHERE 
				flag != 'A' 
				AND ".$filtro_multi." c.cod_cab = d.cod_cab 
				AND cod_prod = '".$codigo."' 
				AND date(fechad) between '".formatofecha($fecha1)."' 
				AND '".formatofecha($fecha2)."'
				AND kardex = 'S' 
				ORDER BY substring(fechad,1,10), flag_kardex, substring(fechad,12,19)";

		//echo $strSql;

	  $resultados10 = mysql_query($strSql,$cn);

	
						//	 echo "select c.flag_r,c.incluidoigv,c.serie,Num_doc,c.cod_ope,cliente,fecha,c.tienda,c.tipo,cantidad,c.cod_cab as referencia,precio,costo_inven,flag_kardex,afectoigv,c.moneda,c.tc,c.inafecto,d.cod_det,impto1,unidad from cab_mov c,det_mov d where  flag!='A' and ".$filtro_multi."  c.cod_cab=d.cod_cab and cod_prod='$codigo' and date(fechad) between '".formatofecha($fecha1)."' and '".formatofecha($fecha2)."' and kardex='S' order by substring(fechad,1,10),flag_kardex,substring(fechad,12,19) ";
	
	// echo "select c.serie,Num_doc,c.cod_ope,cliente,fecha,c.tienda,c.tipo,cantidad from cab_mov c,det_mov d where c.cod_cab=d.cod_cab and cod_prod='$codigo' and date(fechad) between '".$fecha1."' and '".$fecha2."' order by fechad asc ";

$j=0;
	while($row10=mysql_fetch_array($resultados10)){
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
		$envases=$row10['envases'];
		
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
						
			$punit="";
			
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
			
			if($esmodelo=='S' && $documento=="TS")$salidas=0;
//------------------------------------------------------------------	
			//$salidas=$row10['cantidad'];
			$total_salidas=$total_salidas+$salidas;
			
			//$existencia=53;
			
			//echo "$existencia-$salidas+$saldo_actual = ";
			//echo  ((int)$existencia - (int)$salidas + (int)$saldo_actual);
			$existencia=(number_format($existencia,5,'.','') - $salidas + $saldo_actual);
			//echo $existencia;
			
			$ingresos="";
			
			$debe="";
		 	$haber=$costo_inven*$salidas;
			$saldo=$saldo-$haber;
		}
		
		$saldo_actual=0;
																	
	 ?> 

      <tr>
        <td height="20px" align="center" bgcolor="#FFFFFF" class="BorderTabla"><img style="cursor:pointer" onClick="doc_det('<?php echo $referencia;?>')" src="../imagenes/ico_lupa.png" width="14" height="14"></td>
        <td align="center" bgcolor="#FFFFFF" class="BorderTabla" ><span class="Estilo21" ><?php echo $tienda?></span></td>
        <td align="center" bgcolor="#FFFFFF" class="BorderTabla"><span class="Estilo21"><?php echo formatofecha($fecha)?></span></td>
        <td align="center" bgcolor="#FFFFFF" class="BorderTabla"><span class="Estilo21"><?php echo $documento?></span></td>
        <td align="center" bgcolor="#FFFFFF" class="BorderTabla"><span class="Estilo21"><?php echo $numero?></span></td>
        <td bgcolor="#FFFFFF" class="BorderTabla"><span class="Estilo21"><?php 
		if($documento=="TS"){
			switch($tipomov_temp){
				case '1': echo "Transferencia desde Tienda: ";$t_ts="2"; break;
				case '2': echo "Transferencia a Tienda: ";$t_ts="1"; break;
			}
			$con_ortrans=mysql_query("Select * from tienda where cod_tienda in(Select tienda from cab_mov where serie='".substr($numero,0,3)."' and Num_doc='".substr($numero,4,7)."' and tipo='$t_ts')",$cn);
			$row_ortrans=mysql_fetch_array($con_ortrans);
			echo $row_ortrans['cod_tienda']."-".$row_ortrans['des_tienda'];
		}else{
			$strSQL_clie="select * from cliente where codcliente='".$cliente."'";
			$resultado_clie=mysql_query($strSQL_clie,$cn);
			$row_clie=mysql_fetch_array($resultado_clie);
				
			echo $row_clie['razonsocial'];
		}
		
		?></span>&nbsp;</td>
        <td align="center" bgcolor="#FFFFFF" class="BorderTabla"><?php 
		
		//$referencia
		list($cod_cabRef)	=	mysql_fetch_array(mysql_query("select cod_cab from referencia where cod_cab_ref='".$referencia."'"));
		
		
		list($cod_cabRef,$serieRef,$numeroRef)	=	mysql_fetch_array(mysql_query("select cod_ope,serie,Num_doc from cab_mov where cod_cab='".$cod_cabRef."'"));
		
		echo $cod_cabRef." ".$serieRef." ".$numeroRef;
		?></td>
        <td align="center" class="BorderTabla" bgcolor="#FFFFFF" <?php echo $controlEnvases ?>>
		<?php if($envases!='')echo $envases; else echo "&nbsp;"; ?>		</td>
        <td align="center" bgcolor="#DBFBE0" class="BorderTabla"><span class="Estilo21">
		<?php if($ingresos!='')echo $ingresos; else echo "&nbsp;"; ?>
		</span></td>
        <td align="center" bgcolor="#FFFFFF" class="BorderTabla"><span class="Estilo21">
		
		<?php 
		//echo $salidas;
		/*if ($row_unid['mconv']<>'P'){
			$ExisVal = explode('.',$salidas);
			echo $ExisVal[0];
			if ($ExisVal[1]>0){
			echo ' / ';		
			echo $ExisVal[1];
			}
		}else{
			echo $salidas;
		}
		*/
		if($esmodelo=='S' && $documento=="TS" && $tipomov_temp=='2'){
			 echo "**";
		}else{
		
			if($salidas!='')echo $salidas; else echo "&nbsp;";
		
		}
		//echo $salidas; 
		
		
		?>
		
		</span></td>
        <td align="center" bgcolor="#DBFBE0" class="BorderTabla"><span class="Estilo21">
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
				
					if($stockAnterior<0){
					 if(($stockAnterior+$cantActual)<0){
					 $nuevoCosto=0;
					 }else{
					 $nuevoCosto=$precioActual;
					 }
					
					}else{				
					
				   	  $nuevoCosto= (($stockAnterior * $costoAnterior)+($cantActual*$precioActual))/($cantActual+$stockAnterior);
				   }
				   
				   
				}else{
				   $nuevoCosto=0;
				}				
				

				//echo "(($stockAnterior * $costoAnterior)+($cantActual*$precioActual))/($cantActual+$stockAnterior)";
				$costoAnterior=$nuevoCosto;
			}
			
			//echo "$stockAnterior-$salidas+$ingresos";
			$stockAnterior=$stockAnterior-$salidas+$ingresos;
			
			//-----------------------------------------------
		
		
			echo $existencia; ?></span><span class="Estilo21">&nbsp;</span></td>
        <td align="center" bgcolor="#FFFFFF" class="BorderTabla" <?php echo $controlEnvases ?>><?php echo $existCajas; ?></td>
        <td align="right" bgcolor="#FFFFFF" class="BorderTabla"><span class="Estilo21">
		<?php 
			if ($_SESSION['nivel_usu']==2){
				echo '***';
				}else{
					if($debe!=''){
					echo number_format($debe,4,".",",");
					$totDebe=$totDebe+$debe;					
					}
			}
			
			
		 ?>
		 </span></td>
        <td align="right" bgcolor="#DBFBE0" class="BorderTabla"><span class="Estilo21"><?php 
		if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	//echo number_format($haber,4,".",",");
	//echo "$nuevoCosto*$salidas";
	echo number_format($nuevoCosto*$salidas,4,".",",");
	$totalHaber=$totalHaber+($nuevoCosto*$salidas);
	
	}
		 ?></span></td>
        <td align="right" bgcolor="#FFFFFF" class="BorderTabla"><span class="Estilo21"><?php 
		 if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	//echo number_format($saldo,2,".",",");
	//echo $existencia." * ".$nuevoCosto."  ";
	echo number_format($existencia*number_format($nuevoCosto,4,'.',''),4);
	}
		?></span></td>
		<td align="right" bgcolor="#DBFBE0" class="BorderTabla"><span class="Estilo21"><?php 
		
		if($row10['moneda']=='02'){
		echo $tipo_cambio_doc; 
		}
		
		?></span>&nbsp;</td>
        <td align="right" bgcolor="#FFFFFF" class="BorderTabla"><span class="Estilo21"><?php 
		if ($_SESSION['nivel_usu']==2){
		echo '***';
		}else{
			if($punit!=''){
			echo number_format($punit,4,".",",");
			}
		}
	 ?></span></td>
		 <td align="right" bgcolor="#FCE85C" class="BorderTabla"><span class="Estilo21">
		 <?php 
		 if ($_SESSION['nivel_usu']==2){
			echo '***';
			}else{

			//echo number_format($costo_inven,4)."  ----  ".number_format($nuevoCosto,4);
						
			echo number_format($nuevoCosto,4);						
			
		 }
		  ?>
		  
		  </span></td>
      </tr> 
	  
	  <?php  
	  
	  $j++;
	  }	
	  
	  ?>
	  
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td <?php echo $controlEnvases ?>>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td <?php echo $controlEnvases ?>>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
		 <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right"><strong>Total Periodo: </strong></td>
        <td align="right">&nbsp;</td>
        <td align="right" <?php echo $controlEnvases ?>>&nbsp;</td>
        <td align="right"><input style="text-align:right" name="textfield3" type="text" size="8" value=" <?php echo $total_ingresos?>" maxlength="10">         </td>
        <td align="right"><input style="text-align:right" name="textfield32" type="text" size="8" value=" <?php echo $total_salidas?>" maxlength="10">          </td>
        <td>&nbsp;</td>
        <td <?php echo $controlEnvases ?>>&nbsp;</td>
        <td align="right" bgcolor="#FFFFFF"><?php echo number_format($totDebe,2)?></td>
        <td align="right" bgcolor="#CCFFCC"><?php echo number_format($totalHaber,2); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
		 <td>&nbsp;</td>
      </tr>
      <tr <?php echo $controlEnvases ?>>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right"><span class="Estilo129">Total Cajas Ingreso </span></td>
        <td align="right">&nbsp;</td>
        <td align="center"><?php echo $totalI ?></td>
        <td align="right">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
        <td align="right" bgcolor="#CCFFCC">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr <?php echo $controlEnvases ?>>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right"><span class="Estilo129">Total Cajas Salida </span></td>
        <td align="right">&nbsp;</td>
        <td align="center"><?php echo $totalS ?></td>
        <td align="right">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
        <td align="right" bgcolor="#CCFFCC">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

<script>
function doc_det(valor){
window.open("../doc_det2.php?referencia="+valor,"","toolbar=no,status=no, menubar=no, scrollbars=yes, resizable=yes, width=520, height=320,left=300 top=250");
}

</script>




