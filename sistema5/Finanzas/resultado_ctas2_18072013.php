<?php 
include('../conex_inicial.php');
include('../funciones/funciones.php');
//include('operaciones.php');
$tipo=$_REQUEST['tipo'];
$titulo="Estado de Cuentas Corrientes";
if(isset($_REQUEST['excel'])){
	if($tipo=='1'){
		$titulo.=" Proveedores";
	}else{
		$titulo.=" Clientes";
	}
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=excel.xls");
}
$sucursal=$_REQUEST['sucursal'];
$tienda=$_REQUEST['tienda'];
$des_suc=str_replace("|","&",$_REQUEST['des_suc']);
$des_tie=$_REQUEST['des_tie'];
$codigo=$_REQUEST['cod_aux'];
$fecha1=$_REQUEST['fecha1'];
$fecha2=$_REQUEST['fecha2'];
$docs=$_REQUEST['docs'];
$reporte=$_REQUEST['reporte'];
$ordenar=$_REQUEST['ordenar'];

//echo $docs;
if($docs!=''){
//if($docs=='Cancelados' || $docs=='con Saldo'){
	
	if($ordenar=='1'){	
	$filtroOrdenar=" order by f_venc asc, Num_doc ";	
	}else{
	$filtroOrdenar=" order by fecha desc, Num_doc ";	
	}

$salidas=0;
$ingresos=0;


$resultados1 = mysql_query("select * from cliente where codcliente='$codigo'",$cn); 
while($row1=mysql_fetch_array($resultados1)){
	$descripcion=$row1['razonsocial'];
	$ruc_aux=$row1['ruc'];
}
	
	//854070903
	//0231
	
if($tienda=="0"){
	$tienda="Todas las Tiendas";
}	
	
	
if($sucursal==0){
	$filtro_multi=" and cab_mov.cod_ope not in ('NC','TN') and cab_mov.deuda='S' and cab_mov.tipo='$tipo' and cab_mov.flag!='A' ";
}else{
	if($tienda==0){
		$filtro_multi=" and sucursal='$sucursal' and cab_mov.cod_ope not in ('NC','TN') and cab_mov.deuda='S' and cab_mov.tipo='$tipo' and cab_mov.flag!='A'";
	}else{
		$filtro_multi=" and tienda='$tienda' and sucursal='$sucursal' and cab_mov.cod_ope not in ('NC','TN') and cab_mov.deuda='S' and cab_mov.flag!='A' and cab_mov.tipo='$tipo' ";
	}
}
		 		 
	$strSQL_pagos="SELECT *,cab_mov.moneda as mon FROM pagos INNER JOIN cab_mov ON cab_mov.cod_cab=pagos.referencia WHERE cliente='".$codigo."' and DATE(pagos.fecha) between '".$fecha1."' and '".$fecha2."' and cab_mov.flag!='A' ".$filtro_multi;
		// echo $strSQL_pagos."<br>";
	$resultado_pagos=mysql_query($strSQL_pagos,$cn);
	//$cont_p=mysql_num_rows($resultado_pagos);
	$dp=0;
	$doc1="";
	//Cancelados = saldo 0
	//Con saldo > 0
	while($rowp=mysql_fetch_array($resultado_pagos)){
		if($dp==0){
			$doc1="('".$rowp['cod_cab']."'";
			$dp=1;
		}else{
			$doc1.=",'".$rowp['cod_cab']."'";
		}
	}
	if($doc1!=""){
		$doc1=" AND cod_cab NOT IN ".$doc1.")";
	}
	//echo $doc;
	
	$strSQL_pagos="SELECT NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,cab_mov.*,moneda as mon from cab_mov where cliente='".$codigo."' and DATE(substr(cab_mov.fecha,1,10)) < '".$fecha2."' and cab_mov.flag!='A' ".$filtro_multi.$doc1." UNION ".$strSQL_pagos;
	$dp=0;
	$doc="";
	//echo $strSQL_pagos;
	$resultado_pagos2=mysql_query($strSQL_pagos,$cn);
	
	while($rowp2=mysql_fetch_array($resultado_pagos2)){
		if(saldo_act($fecha2,$rowp2['cod_cab'],$rowp2['total'],$rowp2['mon'])==0.00 && $docs=='Cancelados'){
			$visible=true;
		}else{
			if(saldo_act($fecha2,$rowp2['cod_cab'],$rowp2['total'],$rowp2['mon'])>0.00 && $docs=='con Saldo'){
				$visible=true;
			}else{
				if($docs=='Todos'){
					$visible=true;
				}else{
					$visible=false;
				}
			}
		}
		if($visible){
			if($dp==0){
				$doc="('".$rowp2['cod_cab']."'";
				$dp=1;
			}else{
				$doc.=",'".$rowp2['cod_cab']."'";
			}
		}
	}
	
	if($doc!=""){
		$doc=" AND cod_cab IN ".$doc.")";
	}
	//echo $doc;
	
	$strSQL_saldo="select * from cab_mov where tipo='$tipo' and cab_mov.flag!='A' ".$doc;
		 //echo $strSQL_saldo."<br>";
	$resultado_saldo=mysql_query($strSQL_saldo,$cn);
	$cont=mysql_num_rows($resultado_saldo);
	$saldo_s=0;
	$saldo_d=0;
	while($row_saldo=mysql_fetch_array($resultado_saldo)){
		if($row_saldo['moneda']=='01'){
			$saldo_s=number_format($saldo_s,2,'.','')+number_format(saldo_act($fecha2,$row_saldo['cod_cab'],$row_saldo['total'],$row_saldo['moneda']),2,'.','');
		}else{
			$saldo_d=number_format($saldo_d,2,'.','')+number_format(saldo_act($fecha2,$row_saldo['cod_cab'],$row_saldo['total'],$row_saldo['moneda']),2,'.','');
		}
	}
	
	$saldos=saldo_ant($fecha1,$codigo,$tipo);
	$temp=explode("?",$saldos);
	//print_r($temp);
	$saldo_ant_s=$temp[0];
	$saldo_ant_d=$temp[1];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>::: Detalle de Movimientos :::</title>
<style type="text/css">
<!--
<?php if(!isset($_REQUEST['excel'])){ ?>
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
<?php } ?>
.Estilo7 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.Estilo18 {font-size: 11px; font-weight: bold; color: #FFFFFF; }
.Estilo21 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
-->
<?php if(!isset($_REQUEST['excel'])){ ?>
body {
background-color:#F3F3F3;   
}
<?php } ?>
.Estilo117 {color:#003366; font-size: 10px; font-weight: bold; font-family:Tahoma, Arial;}
.Estilo122 {color: #000000; font-size: 11px; font-weight: bold; font-family: Tahoma, Arial; }
.Estilo126 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #000000; }
.Estilo128 {font-size: 11px; font-weight: bold; color: #FFFFFF; font-family: Arial, Helvetica, sans-serif; }
</style></head>

<link href="../styles.css" rel="stylesheet" type="text/css">

<body>
<table width="834" height="207" border="0" cellpadding="0" cellspacing="0">
<?php if(isset($_REQUEST['excel'])){ 
$estilo="";
$estilox="background-color:#009966";
?>
	<tr>
		<td colspan="13" align="center" class="Estilo117"><?php echo $titulo;?></td>
    </tr>
	<tr>
    <td height="19">&nbsp;</td>
    <td class="Estilo117">&nbsp;</td>
    <td colspan="8">&nbsp;</td>
    <td width="232" rowspan="5"><table width="193" height="72" border="0"  align="left" cellpadding="0" cellspacing="0" style="border:#CCCCCC solid 1px">
      <tr>
        <td height="25" colspan="2" class="Estilo117" align="center">Rango de Fechas </td>
      </tr>
      <tr>
        <td width="81" height="21" class="Estilo117">Desde:</td>
        <td width="94" class="Estilo117">Hasta:</td>
      </tr>
      <tr>
        <td height="24" class="Estilo7"><?php echo formatofecha($fecha1)?></td>
        <td class="Estilo7"><?php echo formatofecha($fecha2)?></td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td width="5" height="26">&nbsp;</td>
    <td width="87" class="Estilo117">Sucursal</td>
    <td colspan="4"><span class="Estilo7"><?php echo $des_suc;?></span></td>
	<td class="Estilo117">Tienda<span class="Estilo122">:</span></td>
	<td colspan="3" class="Estilo7"><?php echo $des_tie?></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="26" class="Estilo117">Cliente</td>
    <td class="Estilo7" colspan="4"><?php echo $codigo." - ".$descripcion;?></td>
	<td class="Estilo117">Ruc:</td>
	<td class="Estilo7" align="left" colspan="3"><?php echo $ruc_aux;?></td>
  </tr>
  <tr>
    <td rowspan="2">&nbsp;</td>
    <td height="26" class="Estilo117"><span class="Estilo117">Documentos :</span></td>
    <td width="82"><?php echo $docs;?></td>
    <td colspan="7"><span class="Estilo117">&nbsp;</span></td>
    <td width="14">&nbsp;</td>
  </tr>
  <tr>
    <td height="22" class="Estilo117"><span class="Estilo7"></span>Saldo Anterior:</td>
    <td class="Estilo117" align="right">Soles:</td>
    <td width="109" class="Estilo117"><?php echo $saldo_ant_s; ?></span></td>
    <td width="82"class="Estilo117" align="right">Dolares:</td>
    <td width="101"><span class="Estilo7"><?php echo $saldo_ant_d ?></span></td>
    <td width="44">&nbsp;</td>
    <td width="77" colspan="3">&nbsp;</td>
  </tr>
<?php }else{ 
$estilo="Estilo18";
$estilox="background:url(../imagenes/bg_contentbase4.gif); background-position:100px 50px";
?>	
    <tr>
    <td height="19">&nbsp;</td>
    <td class="Estilo117">&nbsp;</td>
    <td colspan="8">&nbsp;</td>
    <td width="232" rowspan="5"><table width="193" height="90" border="0"  align="left" cellpadding="0" cellspacing="0" style="border:#CCCCCC solid 1px">
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
        <td height="42" class="Estilo7"><input readonly name="fecha_ini" type="text" size="10" maxlength="10" value="<?php echo formatofecha($fecha1)?>"></td>
        <td class="Estilo7"><input name="fecha_fin" type="text" readonly size="10" maxlength="10" value="<?php echo formatofecha($fecha2)?>"></td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td width="5" height="26">&nbsp;</td>
    <td width="87" class="Estilo117">Sucursal</td>
    <td colspan="8"><span class="Estilo7">
      <input name="sucursal" type="text" value="<?php echo $des_suc;?>" size="25" maxlength="200" readonly>
      </span><span class="Estilo117">Tienda</span><span class="Estilo122">:
      </span><span class="Estilo126">
      </span><span class="Estilo7">
      <input name="tienda" type="text" value="<?php echo $des_tie?>" size="25" maxlength="200" readonly>
      </span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="26" class="Estilo117">Cliente</td>
    <td colspan="8"><span class="Estilo7">
      <input readonly style="background-color:#FFF1BB" name="codigo_prod" type="text" size="10" maxlength="10" value="<?php echo $codigo;?>">
      <input style="background-color:#FFF1BB" readonly name="descripcion" type="text" size="47" maxlength="200" value="<?php echo $descripcion;?>">
      <span class="Estilo117">Ruc:</span>
      <input  readonly="readonly" name="textfield2" type="text" size="10" maxlength="10" value="<?php echo $ruc_aux;?>">
&nbsp;</span></td>
  </tr>
  <tr>
    <td rowspan="2">&nbsp;</td>
    <td height="13" class="Estilo117"><span class="Estilo117">Documentos :</span></td>
    <td width="82"><input readonly name="textfield" type="text" size="12" maxlength="10" value="<?php echo $docs;?>"></td>
    <td colspan="6"><span class="Estilo117">&nbsp;</span></td>
    <td width="14">&nbsp;</td>
  </tr>
  <tr>
    <td height="22" class="Estilo117"><span class="Estilo7"></span>Saldo Anterior:</td>
    <td colspan="2" class="Estilo117" align="center">Soles:</td>
    <td width="109" class="Estilo117">
      <input name="saldo_ini_s" readonly type="text" size="10" maxlength="10" value="<?php echo $saldo_ant_s; ?>">
    </span></td>
    <td width="82"class="Estilo117" align="center">Dolares:</td>
    <td width="101"><span class="Estilo7">
      <input name="stock_ini_d"  readonly="readonly" type="text" size="10" maxlength="10" value="<?php echo $saldo_ant_d ?>">
    </span></td>
    <td width="44">&nbsp;</td>
    <td width="77">&nbsp;</td>
  </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td height="85" colspan="10">
	
	<table width="814" border="0" cellpadding="0" cellspacing="1">
      <tr style="<?php echo $estilox; ?>">
		<?php if(!isset($_REQUEST['excel'])){ ?>
        <td width="19" align="center"><span class="<?php echo $estilo;?>">O</span></td>
		<?php } ?>
        <td width="45" height="19" align="center"><span class="<?php echo $estilo;?>">Tienda</span></td>
        <td width="24" align="center"><span class="<?php echo $estilo;?>">TD</span></td>
        <td width="82" align="center"><span class="<?php echo $estilo;?>">Numero</span></td>
        <td width="81" align="center"><span class="<?php echo $estilo;?>">Fecha Emisi&oacute;n </span></td>
        <td width="92" align="center"><span class="<?php echo $estilo;?>">Fecha Venc.</span></td>        
        <td width="94" align="center"><span class="<?php echo $estilo;?>">Condicion</span></td>
        <td width="47" rowspan="2" align="center"><span class="<?php echo $estilo;?>">Moneda</span></td>
        <td width="39" rowspan="2" align="center"><span class="<?php echo $estilo;?>">T.C.</span></td>
        <td width="70" rowspan="2" align="center"><span class="<?php echo $estilo;?>"><?php 
		$day=(int)substr($fecha1,8,2);
		$month=(int)substr($fecha1,5,2);
		$year=(int)substr($fecha1,0,4);
		$dia=date("d/m/Y",(mktime(0,0,0,$month,$day,$year)-1));
		echo "Deuda Al ".$dia;
		?></span></td>
        <td colspan="2" align="center"><span class="<?php echo $estilo;?>">Movimientos del Periodo</span></td>
        <td width="71" rowspan="2" align="center"><span class="<?php echo $estilo;?>">Saldo</span></td>
        </tr>
      <tr style="<?php echo $estilox; ?>">
		<?php if(!isset($_REQUEST['excel'])){ ?>
        <td width="19" align="center"><span class="<?php echo $estilo;?>"></span></td>
		<?php } ?>
        <td width="45" height="19" align="center"><span class="<?php echo $estilo;?>"></span></td>
        <td width="24" align="center"><span class="<?php echo $estilo;?>"></span></td>
        <td width="82" align="center"><span class="<?php echo $estilo;?>"></span></td>
        <td width="81" align="center"><span class="<?php echo $estilo;?>">Fecha Pago</span></td>
        <td width="92" align="center"><span class="<?php echo $estilo;?>">Tipo Pago </span></td>
        <td width="94" align="center">&nbsp;</td>
        <td width="68" align="center"><span class="<?php echo $estilo;?>">Cargos</span></td>
        <td width="68" align="center"><span class="<?php echo $estilo;?>">Abonos</span></td>
        </tr>
	  
	 <?php 
	/*$strSQL_saldo_pa="select * from cab_mov where (date(fecha) >='".$fecha1."' and date(fecha) <='".$fecha2."' and cliente='".$codigo."' and deuda='S'".$filtro_multi.")".$ref_pa." UNION SELECT * from cab_mov where DATE(substr(cab_mov.fecha,1,10)) < '".$fecha1."' and cliente='".$codigo."'".$filtro_multi.$doc1.$filtroOrdenar;
	echo $strSQL_saldo_pa."<br>";
	echo $strSQL_saldo.$filtroOrdenar;*/
	$resultados10 = mysql_query($strSQL_saldo.$filtroOrdenar,$cn);
	$cont10=mysql_num_rows($resultados10);
//	if($cont10>1){	 
	$cont=0;
	while($row10=mysql_fetch_array($resultados10)){
		$s_ant=saldo_act($fecha1,$row10['cod_cab'], $row10['total'], $row10['moneda']);
		$s_act=saldo_act($fecha2,$row10['cod_cab'], $row10['total'], $row10['moneda']);
		if((($s_ant>0 && $docs=="con Saldo") || ($s_act==0 && $docs=="Cancelados") || $docs=="Todos") && substr($row10['fecha'],0,10)<$fecha1){
			$saldo_ant=number_format($s_ant,2,'.','');
			if($s_ant==0){
				$cargos=number_format($row10['total'],2,'.','')+number_format($row10['percepcion'],2,'.','');
			}else{
				$cargos="0";
			}
		}else{
			$saldo_ant='-';
			//if($row10['saldo']>0.00){
			//	$cargos=$row10['saldo'];
			//}else{
			$cargos=$row10['total']+$row10['percepcion'];
			//}
		}
		  
	   	
		$referencia=$row10['cod_cab'];
		$numero=$row10['serie']."-".$row10['Num_doc'];
		$documento=$row10['cod_ope'];
		$cliente=$row10['cliente'];
		$fecha=substr($row10['fecha'],0,10);
		$fechav=substr($row10['f_venc'],0,10);		  
		$tienda=$row10['tienda'];
		$incl_igv=$row10['incluidoigv'];
		$act_kar_IS=$row10['flag_kardex'];
		$prod_igv=$row10['afectoigv'];
		$inafecto=$row10['inafecto'];
		$tipo_cambio_doc=$row10['tc'];
		$moneda=$row10['moneda'];
		if($moneda=='01'){
			$mone="S/.";
		}else{
			$mone="US$.";
		}
		$condicion=$row10['condicion'];
		$strpagos="Select pagos.* from pagos WHERE referencia='".$referencia."' and fecha>='$fecha1' ORDER BY fechap";
	  
		$conpagos=mysql_query($strpagos,$cn);
		$numpagos=mysql_num_rows($conpagos);
		if(($s_ant>0 && $docs=="con Saldo") || (($docs=="Cancelados" && $s_act==0) && $numpagos>0 ) || ($docs=="Todos" && ($saldo_ant!=0 || $saldo_ant=="-"))){
		?>
			<tr>
			<?php if(!isset($_REQUEST['excel'])){ ?>
				<td align="center" bgcolor="#FFFFFF"><img style="cursor:pointer" onClick="doc_det('<?php echo $referencia;?>')" src="../imagenes/ico_lupa.png" width="14" height="14"></td>
			<?php } ?>	
				<td align="center" bgcolor="#FFFFFF"><span class="Estilo21"><?php echo $tienda?></span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="Estilo21"><?php echo $documento?></span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="Estilo21"><?php echo $numero?></span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="Estilo21"><?php echo formatofecha($fecha)?></span></td>        
				<td align="center" bgcolor="#FFFFFF"><span class="Estilo21"><?php echo formatofecha($fechav)?></span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="Estilo21"><?php
					$StrCond="Select * from condicion where codigo='".$condicion."'";
					$con=mysql_query($StrCond,$cn);
					$row_con=mysql_fetch_array($con);
					echo $row_con['nombre'];
				?></span></td>        
				<td align="center" bgcolor="#FFFFFF"><span class="Estilo21"><?php echo $mone?></span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="Estilo21"><?php echo $tipo_cambio_doc; ?></span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="Estilo21"><?php echo $saldo_ant; ?></span></td>
				<td align="right" bgcolor="#FFFFFF"><span class="Estilo21"><?php echo number_format($cargos,2,'.',''); ?></span></td>
				<td align="right" bgcolor="#FFFFFF"><span class="Estilo21"><?php echo number_format($haber,2,'.',''); ?></span></td>
				<td align="right" bgcolor="#FFFFFF"><span class="Estilo21"><?php 
					if($cargos>0.00){
						$saldo=$cargos;
					}else{
						$saldo=$saldo_ant+$cargos;
					}
					$saldo_ant=$saldo;
					echo number_format($saldo_ant,2,'.','');
				?></span></td>
			</tr> 
			<?php
			while($rowpa=mysql_fetch_array($conpagos)){
			?>
			<tr>
			<?php if(!isset($_REQUEST['excel'])){ ?>
				<td>
			<?php } ?>	
				<td>
				<td>
				<td>
				<td align="center" bgcolor="#FFFFFF"><span class="Estilo21"><?php echo formatofecha($rowpa['fecha']); ?></span>
				<td align="center" bgcolor="#FFFFFF"><span class="Estilo21"><?php 
					$tpago=$rowpa['t_pago']; 
					$strtp="Select * from t_pago where id='".$tpago."'";
					$contp=mysql_query($strtp,$cn);
					$rowtp=mysql_fetch_array($contp);
					echo $rowtp['descripcion']." ".$rowpa['numero'];
				?></span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="Estilo21"><?php echo "" ?></span>
				<td align="center" bgcolor="#FFFFFF"><span class="Estilo21"><?php 
					if($rowpa['moneda']=='01'){
						echo "S/.";
					}else{
						echo "US$";
					}
				?></span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="Estilo21"><?php 
					if($moneda!=$rowpa['moneda']){
						echo number_format($rowpa['tcambio'],4);
					}else{
						echo "";
					}
				?></span></td>
				<td align="center" bgcolor="#FFFFFF"><span class="Estilo21"><?php echo "" ?></span>
				<td align="right" bgcolor="#FFFFFF"><span class="Estilo21"><?php 
					if($rowpa['tipo']=='C'){
						echo number_format($rowpa['monto'],2,'.','');
					}else{
						echo "";
					}
				?></span>
				<td align="right" bgcolor="#FFFFFF"><span class="Estilo21"><?php 
					if($rowpa['tipo']=='A'){
						echo number_format($rowpa['monto'],2,'.','');
					}else{
						echo "";
					}
				?></span>
			<td align="right" bgcolor="#FFFFFF"><span class="Estilo21"><?php 
			//echo $moneda."!=".$rowpa['moneda']."<br>";
					if($moneda!=$rowpa['moneda']){
						switch($rowpa['moneda']){
							case '01':$mon1=number_format($rowpa['monto'],2,'.','')/$rowpa['tcambio'];break;
							case '02':$mon1=number_format($rowpa['monto'],2,'.','')*$rowpa['tcambio'];break;
						}
					}else{
						$mon1=number_format($rowpa['monto'],2,'.','');
					}
					if($rowpa['tipo']=='A'){
						$mon2=number_format($saldo_ant,2,'.','')-number_format($mon1,2,'.','');
					}else{
						$mon2=number_format($saldo_ant,2,'.','')+number_format($mon1,2,'.',''); 
					}
					$saldo_ant=number_format($mon2,2,'.','');
					echo $saldo_ant;
				?></span>			</tr>
			<?php
			}
			?>
			<tr>
				<td colspan="13" bgcolor="#FFFFFF" align="center" height="1px"></td>
			</tr>
			<?php
		}
	}
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
        <td>&nbsp;</td>
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
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
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
        <?php /*?><td align="right"><strong>Total Periodo: </strong></td>
        <td align="right"><input style="text-align:right" name="textfield3" type="text" size="5" value=" <?php echo $total_ingresos?>" maxlength="10">         </td>
        <td align="right"><input style="text-align:right" name="textfield32" type="text" size="5" value=" <?php echo $total_salidas?>" maxlength="10">          </td><?php */?>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
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
window.open("../doc_det2.php?referencia="+valor,"","toolbar=no,status=no, menubar=no, scrollbars=yes, width=520, height=320,left=300 top=250");
}
</script>
<?php
function saldo_act($fecha1,$referencia,$importe,$moneda){
	include('../conex_inicial.php');
	
	//$strSQL333="Select * from pagos where referencia='".$referencia."' and CONCAT(SUBSTR(fecha,7,4),'-',SUBSTR(fecha,4,2),'-',SUBSTR(fecha,1,2)) <= '".$fecha1."'";
	$strSQL333="Select * from pagos where referencia='".$referencia."' and fecha < '".$fecha1."'";
	//echo "<br>".$strSQL333."<br>";
	$abonos=0;
	$cargos=0;
	$consulta32=mysql_query($strSQL333,$cn);
	$numrow=mysql_num_rows($consulta32);
	while($row=mysql_fetch_array($consulta32)){
		if($moneda!=$row['moneda']){
			switch($row['moneda']){
				case '01':$montox=number_format($row['monto'],2,'.','')*$row['tcambio'];break;
				case '02':$montox=number_format($row['monto'],2,'.','')/$row['tcambio'];break;
			}
		}else{
			$montox=number_format($row['monto'],2,'.','');
		}
		switch($row['tipo']){
			case 'A':$abonos=number_format($abonos,2,'.','')+number_format($montox,2,'.','');break;
			case 'C':$cargos=number_format($cargos,2,'.','')+number_format($montox,2,'.','');break;
		}
	}
	//echo "<br>"$importe."-".$abonos."="."<br>";
	$total=(number_format($importe,2,'.','')+number_format($cargos,2,'.',''))-number_format($abonos,2,'.','');
	//	echo "<br>".$importe."-".$abonos."=".$total."<br>";
	return number_format($total,2,'.','');
}

function saldo_ant($fecha1,$cliente,$tip){
	include('../conex_inicial.php');
	
	$abonos_s=0;
	$abonos_d=0;
	$cargos_s=0;
	$cargos_d=0;
	
	$strSQL332="Select * from cab_mov  where cliente='".$cliente."' and tipo='$tip' and substr(fecha,1,10) < '".$fecha1."' and flag!='A' and cod_ope!='NC' and cod_ope!='TN' and deuda='S' ";
	//echo $strSQL332;
	$consulta332=mysql_query($strSQL332,$cn);
	$numrow=mysql_num_rows($consulta332);
	while($row332=mysql_fetch_array($consulta332)){
		if($row332['moneda']=='01'){
			$cargos_s=number_format($cargos_s,2,'.','')+number_format($row332['total'],2,'.','')+number_format($row332['percepcion'],2,'.','');
		}else{
			$cargos_d=number_format($cargos_d,2,'.','')+number_format($row332['total'],2,'.','')+number_format($row332['percepcion'],2,'.','');
		}
	}
	
	$strSQL333="Select p.tipo,p.moneda,p.monto,p.tcambio,c.moneda as monedadoc from pagos p inner join cab_mov c on c.cod_cab=p.referencia where p.estado!='A' and p.fecha < '".$fecha1."' and p.referencia in (Select cod_cab from cab_mov  where cliente='".$cliente."' and tipo='$tip' and substr(fecha,1,10) < '".$fecha1."' and flag!='A' and cod_ope!='NC' and cod_ope!='TN' and deuda='S' ) ";
	//echo "<br>".$strSQL333."<br>";

	$consulta32=mysql_query($strSQL333,$cn);
	$numrow=mysql_num_rows($consulta32);
	while($row=mysql_fetch_array($consulta32)){
		$moneda=$row['monedadoc'];
		if($moneda!=$row['moneda']){
			switch($row['moneda']){
				case '01':$montox=number_format($row['monto'],2,'.','')*$row['tcambio'];break;
				case '02':$montox=number_format($row['monto'],2,'.','')/$row['tcambio'];break;
			}
		}else{
			$montox=number_format($row['monto'],2,'.','');
		}
		switch($row['tipo']){
			case 'A':
				if($moneda=='01'){
					$abonos_s=number_format($abonos_s,2,'.','')+number_format($montox,2,'.','');
				}else{
					$abonos_d=number_format($abonos_d,2,'.','')+number_format($montox,2,'.','');
				}
				break;
			case 'C':
				if($moneda=='01'){
					$cargos_s=number_format($cargos_s,2,'.','')+number_format($montox,2,'.','');
				}else{
					$cargos_d=number_format($cargos_d,2,'.','')+number_format($montox,2,'.','');
				}
				break;
		}
	}
	$saldo_s=number_format($cargos_s,2,'.','')-number_format($abonos_s,2,'.','');
	$saldo_d=number_format($cargos_d,2,'.','')-number_format($abonos_d,2,'.','');
	return number_format($saldo_s,2,'.','')."?".number_format($saldo_d,2,'.','')."?" ;
}
?>