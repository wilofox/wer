<?php session_start();?>
<?php 
include('../conex_inicial.php');
include('../funciones/funciones.php');

//PAGINACION 1	
	$registros = 50; 
	$pagina = $_REQUEST['pagina']; 
	
	//echo $pagina;

	if ($pagina=='') { 
		$inicio = 0; 
		$pagina = 1; 
	}else{ 
		$inicio = ($pagina - 1) * $registros; 
	} 
	
if($_REQUEST['excel']=="S"){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=excel.xls");
}


$sucursal=$_GET['sucursal'];
$almacen=$_GET['almacen'];
$auxiliar=$_GET['auxiliar'];
$fecha1=formatofecha($_GET['fecha1']);
$fecha2=formatofecha($_GET['fecha2']);
$mostrar=$_GET['mostrar'];
$monto=$_GET['monto'];
$reporte=$_GET['treporte'];
$moneda=$_GET['moneda'];
$tipo=$_GET['tipo'];

$parametro=$sucursal."|".$monto."|".$reporte."|".$moneda."|";
//$doc=$_GET['doc'];

if($tipo=="1"){
	$titulo="COMPRAS POR PROVEEDOR";
	$titulo_det="Detalle de Compra";
	$titulo_det_pre="Valor Compra";
}else{
	$titulo="VENTAS POR CLIENTE";	
	$titulo_det="Detalle de Venta";
	$titulo_det_pre="Valor Venta";
}
if($monto=='BI'){
	$titulo_det_pre.=" No Inc. IGV.";
	$titulo_pre.="B.Imp";
}else{
	$titulo_det_pre.=" Inc. IGV.";
	$titulo_pre.="V.Total";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo////</title>
<style type="text/css">
<!--
.Estilo16 {color: #FFFFFF; font-weight: bold; font-size: 11px; font-family: Arial, Helvetica, sans-serif; }
.Estilo27 {color: #000000}
.Estilo28 {color: #000000; font-weight: bold; font-size: 11px; font-family: Arial, Helvetica, sans-serif; }
.Estilo34 {color: #FFFFFF}
.Estilo43 {color: #000000; font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo44 {font-size: 12px}
.Estilo45 {color: #666666}
.Estilo59 {color: #0C9}
.Estilo60 {color: #300}
-->
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="" >
	<input type="hidden"  id="sucursal" value="<?=$sucursal;?>">
	<input type="hidden"  id="almacen" value="<?=$almacen;?>">
	<input type="hidden"  id="auxiliar" value="<?=$auxiliar;?>">
	<input type="hidden"  id="mostrar" value="<?=$mostrar;?>">
	<input type="hidden"  id="fecha1" value="<?=formatofecha($fecha1);?>">
	<input type="hidden"  id="fecha2" value="<?=formatofecha($fecha2);?>">
	<input type="hidden"  id="monto" value="<?=$monto;?>">
	<input type="hidden"  id="treporte" value="<?=$reporte;?>">
	<input type="hidden"  id="moneda" value="<?=$moneda;?>">
    <input type="hidden"  id="tipo" value="<?=$tipo;?>">

	<table border="0" width="700px" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="4" align="right"><table width="120px" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="41" align="right" valign="top" class="Estilo28"><span class="Estilo27">Fecha</span>:</td>
		<td width="79" class="Estilo28"><?php echo date('d-m-Y')?> </td>
	</tr>
	<tr>
		<td align="right" class="Estilo28"><span class="Estilo27">Hora:</span></td>
		<td class="Estilo28"><?php echo date('H:i:s A')?></td>
	</tr>
	</table></td>
</tr>
<tr>
	<td colspan="4" align="left">&nbsp;</td>
</tr>
<tr>
	<td colspan="4" align="left"><div align="center"><p class="Estilo28"><?php echo $titulo;?> </p></div></td>
</tr>
<tr>
	<td colspan="4" align="center">
		<table width="269" height="38" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="4" align="center"><b><span class="Estilo27"></span></b></td>
		</tr>
		<tr>
			<td width="24" align="right" class="Estilo28"><span class="Estilo27">De:</span></td>
			<td width="115" class="Estilo28"><?php echo $_GET['fecha1'];?></td>
			<td width="20" align="right" class="Estilo28"><span class="Estilo27">Al:</span></td>
			<td width="110" class="Estilo28"><?php echo $_GET['fecha2'];?></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="4" align="left">&nbsp;</td>
</tr>
<tr>
	<td align="left" class="Estilo28"><span class="Estilo27"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Empresa:<span class="Estilo4">
	<?php 
	if($sucursal!="T"){
	$sql="Select * from sucursal where cod_suc='$sucursal'";

	$query=mysql_query($sql,$cn);
	$row=mysql_fetch_array($query);
	echo $row['des_suc'];
	$filtro_emp=" and dm.sucursal='".$sucursal."' ";
	}else{
		echo "T - Todas las Empresas";
		$filtro_emp="";
	}
	?></span></span></td>
	<td align="left" class="Estilo28">&nbsp;</td>
	<td align="left" class="Estilo28"><span class="Estilo27"><?php /*?>Filtro: <?php echo $valor;?><?php */?>&nbsp;&nbsp;&nbsp;&nbsp;</span><?php /*?></td>
</tr>
<tr>
	<td align="left" class="Estilo28"><span class="Estilo27"><?php */?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tienda&nbsp;
    <?php 
	if($almacen!="T"){
		$sql="Select * from tienda where cod_tienda='$almacen'";
		$query=mysql_query($sql,$cn);
		$row=mysql_fetch_array($query);
		echo $row['cod_tienda']. "-".$row['des_tienda'];
		$filtro_tienda=" and dm.tienda =".$almacen." ";
	}else{
		echo "T - Todas las Tiendas";
		$filtro_tienda="";
	}
	?></span></td>
    <td align="left" class="Estilo28">&nbsp;</td>
    <td align="left" class="Estilo28">&nbsp;</td>
    <td align="left" class="Estilo28">&nbsp;</td>
</tr>
<tr>
	<td colspan="4" align="left">&nbsp;</td>
</tr>
<tr>
	<td colspan="4" align="center">
    <?php ?> 
	<table width="949" border="0" cellpadding="0" cellspacing="2" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
	<tr>
		<td colspan="4"  align="left" bgcolor="#FFFFFF" class="Estilo16" valign="top">
		<table width="945" border="0" cellpadding="1" cellspacing="1"  style="vertical-align:top">
        <tr>
			<td width="79" bgcolor="#F0B442"><span class="Estilo27">Cod.Prod.</span></td>
			<td width="101" bgcolor="#F0B442"><span class="Estilo27">Cod.Anex. </span></td>
			<td width="437" bgcolor="#F0B442"><span class="Estilo27">Descripcion</span></td>
			<td width="85" bgcolor="#F0B442"><span class="Estilo27">Cantidad</span></td>
            <?php if($moneda=="00" || $moneda=="01"){?>
            <td width="112" bgcolor="#F0B442"><span class="Estilo27">Valor Soles</span></td>
            <?php }
			if($moneda=="00" || $moneda=="02"){?>
            <td width="112" bgcolor="#F0B442"><span class="Estilo27">Valor Dolares</span></td>
            <?php }?>
		</tr>
	<?php //}
	$cod_aux=explode("|",$auxiliar);
	
	for($i=0;$i<count($cod_aux);$i++){
		if($cod_aux[$i]!=""){
			if($i==0){
				$filtroaux=$cod_aux[$i];
			}else{
				$filtroaux=$cod_aux[$i]."','".$filtroaux;
			}
		}
	}
	$filtrotipo=" dm.tipo='$tipo' ";
	
	if($tipo==1){
		$rstemp	=	mysql_query("Select documentos from temp where cod_user='".$_SESSION['codvendedor']."' and reporte='REGISTRO_COMPRAS'",$cn);
	}else{
		$rstemp	=	mysql_query("Select documentos from temp where cod_user='".$_SESSION['codvendedor']."' and reporte='REGISTRO_VENTAS'",$cn);
	}
	$rowtemp=	mysql_fetch_array($rstemp);
	if( !empty( $rowtemp['documentos'] ) ){ 
		$filtro56 = " ".$rowtemp['documentos'];	
	}
	
	$filtro2="cm.*,cm.cod_ope as co,cm.tipo as tk,concat(cm.cod_ope,' ',cm.serie,'-',cm.Num_doc) as td,cm.cliente as rz,cm.fecha as fec,cm.total as total,cm.tc as tcambio,cm.impto1 as igv,cm.moneda as mone";
	//$strSQL="select ".$filtro2.",cm.tienda as 'tienda',cm.sucursal as suc from cab_mov cm, cliente c where cm.cliente=c.codcliente and ".$filtrotipo.$filtro_tienda.$filtro_emp." and cm.cod_ope in(".$filtro56.") and cm.cliente in('".$filtroaux."') and substring(cm.fecha,1,10) between '".$fecha1."' and '".$fecha2."' order by cm.cliente,cm.sucursal,cm.fecha asc ";
	$strSQL="select dm.* from det_mov dm where ".$filtrotipo.$filtro_tienda.$filtro_emp." and dm.cod_ope in(".$filtro56.") and dm.auxiliar in('".$filtroaux."') and substring(dm.fechad,1,10) between '".$fecha1."' and '".$fecha2."' order by dm.auxiliar,dm.sucursal,dm.cod_prod asc ";
	$cons="select dm.* from det_mov dm where ".$filtrotipo.$filtro_tienda.$filtro_emp." and dm.cod_ope in(".$filtro56.") and dm.auxiliar in('".$filtroaux."') and substring(dm.fechad,1,10) between '".$fecha1."' and '".$fecha2."'";
//cm.cliente = c.codcliente AND 

//Para el Detalle
//dt.cantidad as cantidad,dt.precio as precio,,dt.cod_prod, p.nombre,p.und from det_mov dt, producto p where p.idproducto = dt.cod_prod AND dt.cod_cab = cm.cod_cab
//------------	 
	$resultados = mysql_query($strSQL ,$cn);
	$total_registros = mysql_num_rows($resultados); 
	if($_REQUEST['excel']!="S"){ 
	  $strSQL=$strSQL."LIMIT $inicio, $registros";
	}
	 $resultadoreporte = mysql_query($strSQL,$cn); 
		
	$resultados2 =mysql_num_rows($resultadoreporte); 
	$total_paginas = ceil($total_registros / $registros); 
//-----------------	  
	  //echo $strSQL;
	//echo $filtroMov;
	 //$resultadoreporte = mysql_query($strSQL,$cn);  
	 
    //while($rowreporte=mysql_fetch_array($strSQL)){
	
	$trz="";
	$tsuc="";
	$trzs=0;
	$trzd=0;
	$tsucs=0;
	$tsucd=0;
	$inic=0;
	$inic_s=0;
	while($rowreporte=mysql_fetch_array($resultadoreporte)){ 	
		if($sucursal=="T"){
			if($inic_s>0 && $tsuc!=$rowreporte['sucursal']){
				$ttotal=MostrarTotales("empresa",$trz,$tsuc,$cons,$parametro);
				echo $ttotal;
				$tsucs=0;
				$tsucd=0;
			}
		}
			
		$cj=0;	
		$rssql=mysql_query("Select codcliente,ruc,razonsocial from cliente where codcliente='".$rowreporte['auxiliar']."'",$cn);
		$rwrs=mysql_fetch_array($rssql);
		if($trz!=$rowreporte['auxiliar']){
			$cont_pro=0;
			if($sucursal=="T"){
				if($ttotal!=MostrarTotales("empresa",$trz,$tsuc,$cons,$parametro)){
					echo MostrarTotales("empresa",$trz,$tsuc,$cons,$parametro);
				}
			}
			echo MostrarTotales("auxiliar",$trz,$tsuc,$cons,$parametro);
			$trz=$rowreporte['auxiliar'];
			$cj=1;
 ?>
	<tr>
		<td align="left" class="Estilo28" colspan="3"><span class="Estilo60"><?php echo "RAZON SOCIAL: ".$rwrs[2]; ?></span></td>
		<td colspan="2" align="left" class="Estilo28"><span class="Estilo60"><?php echo "Codigo: ".$rwrs[0];?></span></td>
		<td colspan="2" align="left" class="Estilo28"><span class="Estilo60"><?php echo "Ruc: ".$rwrs[1];?></span></td>
	</tr>
<?php }
if($sucursal=="T"){
	if($tsuc!=$rowreporte['sucursal'] || $cj>0){
		$tsuc=$rowreporte['sucursal'];
		$tsucs=0;
		$tsucd=0;
		$inic_s=1;
		$scsql=mysql_query("Select des_suc from sucursal where cod_suc='".$rowreporte['sucursal']."'",$cn);
		$scrs=mysql_fetch_array($scsql);
 ?>
	<tr>
		<td align="left" class="Estilo28" colspan="7"><span class="Estilo59"><?php echo $scrs[0]; ?></span></td>
	</tr>
<?php }}
if($tprod!=$rowreporte['cod_prod'] || $cj>0){	
	$tprod=$rowreporte['cod_prod'];
	$pr=explode("?",CalcularProducto($tprod,$trz,$tsuc,$cons,$parametro));?>
	<tr>
		<td width="79" valign="top" align="left" class="Estilo28"><span class="Estilo45"><?php echo $rowreporte['cod_prod'];$inic++; ?></span></td>
		<td width="101" valign="top" align="left" class="Estilo28"><span class="Estilo45"><?php echo $pr[3];?></span></td>
		<td width="437" valign="top" align="left" class="Estilo28"><span class="Estilo45"><?php echo $rowreporte['nom_prod']?></span></td>
		<td width="85" valign="top" align="right" class="Estilo28"><span class="Estilo45"><?php echo number_format($pr[0]);?></span></td>
		<td width="112" valign="top" align="right" class="Estilo28"><span class="Estilo45"><?php echo number_format($pr[1],2,".","");?></span></td>
		<td width="112" valign="top" align="right" class="Estilo28"><span class="Estilo45"><?php echo number_format($pr[2],2,".","");?></span></td>
	</tr>
    <?php }$cont_pro++;}
	if(($pagina==$total_paginas || $cont_pro==$cont_gen) || $_REQUEST['excel']=="S"){
		if($sucursal=="T"){
			echo MostrarTotales("empresa",$trz,$tsuc,$cons,$parametro);
		}
		echo MostrarTotales("auxiliar",$trz,$tsuc,$cons,$parametro);
	}?>
	</table></td>
</tr>
</table></td>
	</tr>
<tr>
	<td colspan="5" bgcolor="#FFFFFF"></td>
</tr>
<?php 
//PIE DE PAGINA
?>
</table></td>
<? 
if($_REQUEST['excel']!="S"){ ?>
<table width="100%" height="21" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td width="311" height="21" align="left" valign="bottom" style="color:#999999"><span class="Estilo29">Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (de <strong><?php echo $total_registros?></strong> productos)</span>.</td>
	<td width="526" align="right" valign="bottom" style="color:#999999"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:13px">
<?php if(($pagina - 1) > 0) { 
echo "<a style='cursor:pointer' onclick='cargardatos($pagina-1)'>< Anterior </a> "; 
} 

for ($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
		echo "<b style='color:#000000'>".$pagina."</b> "; 
	} else { 
		echo "<a style='cursor:pointer' href='#' onclick='cargardatos($i)'>$i</a> "; 
	}
}
if(($pagina + 1)<=$total_paginas) { 
	echo " <a style='cursor:pointer' onclick='cargardatos($pagina+1)'>Siguiente ></a>"; 
} 
?>&nbsp;&nbsp;</font>
	<input type="hidden" name="pag" id="pag" value="<?php echo $pagina?>" />
	<input type="hidden" name="docsNoAnu" id="docsNoAnu" value="<?php echo $_SESSION['docConSerie3']?>">
	<input type="hidden" name="docsNoDesAnu" id="docsNoDesAnu" value="<?php echo $_SESSION['docConSerie4']?>">
	</td>
</tr>
<tr>
	<td colspan="5" align="center" bgcolor="#FFFFFF" onclick="javascript:location.href='comprovee.php'" style="color:#00F; text-decoration:underline">Atras</td>
</tr>
</table>
<? } ?>
</td>
</tr>
</table>
</form>
<?php
function CalcularProducto($codigo,$auxiliar,$sucursal,$consulta,$param){
	include('../conex_inicial.php');
	$p=explode("|",$param);
	$mostrartotal=$p[1];
	$tiporep=$p[2];
	$moneda=$p[3];
	//$suc=$p[0];
	$tsucs=0;
	$tsucd=0;
	$cant=0;
	$canex="";
	$trzs=0;
	$trzd=0;
	$cssql=mysql_query($consulta." and dm.auxiliar='".$auxiliar."' and dm.sucursal='".$sucursal."' and dm.cod_prod='".$codigo."'",$cn);
	while($row_det=mysql_fetch_array($cssql)){
		$cons_cab=mysql_query("Select * from cab_mov where cod_cab='".$row_det['cod_cab']."'",$cn);
		$row_cab=mysql_fetch_array($cons_cab);
		$sql_prod=mysql_query("Select * from producto where idproducto='".$row_det['cod_prod']."'",$cn);
		$rw_prod=mysql_fetch_array($sql_prod);
		if($row_prod['cod_prod']!=""){
			$canex=$row_prod['cod_prod'];
		}else{
			if($row_prod['cod_anex1']!=""){
				$canex=$row_prod['codanex2'];
			}else{
				$canex=$row_prod['codanex3'];
			}
		}
		$cant+=number_format($row_det['cantidad']);
		switch($mostrartotal){
			case 'BI': 
				if($row_cab['incluidoigv']=="S" && $row_cab['inafecto']=="N" && $rw_prod['igv']=='S'){
					$precio=$row_det['imp_item']-($row_det['imp_item']*$row_cab['impto1']/100);
					}else{
						$precio=$row_det['imp_item'];
					}break;
			case 'TD':$precio=$row_det['imp_item'];break;
		}
		switch($moneda){
				case '00': 
					switch($row_det['moneda']){
						case '01':$tsucs+=number_format($precio,2,".","");break;
						case '02':$tsucd+=number_format($precio,2,".","");break;
					}break;
				case '01': 
					switch($row_det['moneda']){
						case '01':$tsucs+=number_format($precio,2,".","");break;
						case '02':$tsucs+=number_format($precio/$row_det['tc'],2,".","");break;
					}break;	
				case '02': 
					switch($row_det['moneda']){
						case '01':$tsucs+=number_format($precio*$row_det['tc'],2,".","");break;
						case '02':$tsucs+=number_format($precio,2,".","");break;
					}break;		
			}
	}
	$rpta=$cant."?".$tsucs."?".$tsucd."?".$canex;
	return $rpta;
}

function MostrarTotales($grupo,$auxiliar,$sucursal,$consulta,$param){
	include('../conex_inicial.php');
	$p=explode("|",$param);
	$mostrartotal=$p[1];
	$tiporep=$p[2];
	$moneda=$p[3];
	//$suc=$p[0];
	$tsucs=0;
	$tsucd=0;
	$trzs=0;
	$trzd=0;
	switch($grupo){
		case 'empresa':	
			$cssql=mysql_query($consulta." and dm.auxiliar='".$auxiliar."' and dm.sucursal='".$sucursal."'",$cn);
			while($row_det=mysql_fetch_array($cssql)){
				$sql_prod=mysql_query("Select * from producto where idproducto='".$row_det['cod_prod']."'",$cn);
				$rw_prod=mysql_fetch_array($sql_prod);
				$sql_cab=mysql_query("Select * from cab_mov where cod_cab='".$row_det['cod_cab']."'",$cn);
				$row_cab=mysql_fetch_array($sql_cab);
				switch($mostrartotal){
					case 'BI': 
						if($row_cab['incluidoigv']=="S" && $row_cab['inafecto']=="N" && $rw_prod['igv']=='S'){
							$precio=$row_det['imp_item']-($row_det['imp_item']*$row_cab['impto1']/100);
						}else{
							$precio=$row_det['imp_item'];
						}break;
					case 'TD':$precio=$row_det['imp_item'];break;
				}
				switch($moneda){
					case '00': 
						switch($row_det['moneda']){
							case '01':$tsucs+=number_format($precio,2,".","");break;
							case '02':$tsucd+=number_format($precio,2,".","");break;
						}break;
					case '01': 
						switch($row_det['moneda']){
							case '01':$tsucs+=number_format($precio,2,".","");break;
							case '02':$tsucs+=number_format($precio/$row_cab['tc'],2,".","");break;
						}break;	
					case '02': 
						switch($row_det['moneda']){
							case '01':$tsucs+=number_format($precio*$row_cab['tc'],2,".","");break;
							case '02':$tsucs+=number_format($precio,2,".","");break;
						}break;		
				}
			}break;
		case 'auxiliar':
			$cssql=mysql_query($consulta." and dm.auxiliar='".$auxiliar."'",$cn);
			while($row_det=mysql_fetch_array($cssql)){
				$sql_prod=mysql_query("Select * from producto where idproducto='".$row_det['cod_prod']."'",$cn);
				$rw_prod=mysql_fetch_array($sql_prod);
				$sql_cab=mysql_query("Select * from cab_mov where cod_cab='".$row_det['cod_cab']."'",$cn);
				$row_cab=mysql_fetch_array($sql_cab);
				switch($mostrartotal){
					case 'BI': 
						if($row_cab['incluidoigv']=="S" && $row_cab['inafecto']=="N" && $rw_prod['igv']=='S'){
							$precio=$row_det['imp_item']-($row_det['imp_item']*$row_cab['impto1']/100);
						}else{
							$precio=$row_det['imp_item'];
						}break;
					case 'TD':$precio=$row_det['imp_item'];break;
				}
				switch($moneda){
					case '00': 
						switch($row_cab['moneda']){
							case '01':$trzs+=number_format($precio,2,".","");break;
							case '02':$trzd+=number_format($precio,2,".","");break;
						}break;
					case '01': 
						switch($row_cab['moneda']){
							case '01':$trzs+=number_format($precio,2,".","");break;
							case '02':$trzs+=number_format($precio/$row_cab['tc'],2,".","");break;
						}break;	
					case '02': 
						switch($row_cab['moneda']){
							case '01':$trzs+=number_format($precio*$row_cab['tc'],2,".","");break;
							case '02':$trzs+=number_format($precio,2,".","");break;
						}break;		
				}
			}
	}
	$rpta="";
	$m1="";
	$m2="";
	switch($moneda){
		case '00':$m1="(S/.)";$m2="(US$.)";break;
		case '01':$m1="(S/.)";break;
		case '02':$m1="(US$.)";break;
	}
	if($tsucs>0 || $tsucd>0){
		$rpta.="<tr>
			<td align='left' class='Estilo28' colspan='7'><span class='Estilo60'><?php echo '  '?></span></td>
		</tr>
		<tr><td align='right' class='Estilo28' colspan='4'><span class='Estilo59'>Total Empresa: </span></td><td class='Estilo28' align='right'><span class='Estilo59'>".number_format($tsucs,2,'.','')."</span></td>";
	}
	if(($m2!="" && $tsucs>0) || ($m2!="" && $tsucd>0)){
		$rpta.="<td class='Estilo28' align='right'><span class='Estilo59'>".number_format($tsucd,2,'.','')."</span></td>";
	}
	if($tsucs>0 || $tsucd>0){
		$rpta.="</tr>
		<tr>
			<td align='left' class='Estilo28' colspan='7'><span class='Estilo60'><?php echo '  '?></span></td>
		</tr>
		<tr>
			<td align='left' class='Estilo28' colspan='7'><span class='Estilo60'><?php echo '  '?></span></td>
		</tr>";
	}
	if($trzs>0 || $trzd>0){
		$rpta.="<tr><td align='right' class='Estilo28' colspan='4'><span class='Estilo60'>Total Proveedor: </span></td><td class='Estilo28' align='right'><span class='Estilo60'>".number_format($trzs,2,'.','')."</span></td>";
	}
	if(($m2!="" && $trzs>0) || ($m2!="" && $trzd>0)){
		$rpta.="<td class='Estilo28' align='right'><span class='Estilo60'>".number_format($trzd,2,'.','')."</span></td>";
	}
	if(($trzs>0 || $trzd>0)){
		$rpta.="
		<tr>
			<td align='left' class='Estilo28' colspan='7'><span class='Estilo60'><?php echo '  '?></span></td>
		</tr>
		<tr>
			<td align='left' class='Estilo28' colspan='7'><span class='Estilo60'><?php echo '  '?></span></td>
		</tr>";
	}
	return $rpta;
}
?>
<script>
function cargardatos(pagina){
var sucursal=document.form1.sucursal.value;
var almacen=document.form1.almacen.value;
var auxiliar=document.form1.auxiliar.value;
var mostrar=document.form1.mostrar.value;
var fecha1=document.form1.fecha1.value;
var fecha2=document.form1.fecha2.value;
var monto=document.form1.monto.value;
var treporte=document.form1.treporte.value;
var moneda=document.form1.moneda.value;
var tipo=document.form1.tipo.value;

htmlreporte="?auxiliar="+auxiliar+"&mostrar="+mostrar+"&monto="+monto+"&treporte="+treporte+"&fecha1="+fecha1+"&fecha2="+fecha2+"&moneda="+moneda+"&tipo="+tipo+"&sucursal="+sucursal+"&almacen="+almacen+'&pagina='+pagina;

	document.form1.action="rpt_comprovee_cons.php"+htmlreporte;
	document.form1.submit();	

}
</script>

</body>
</html>