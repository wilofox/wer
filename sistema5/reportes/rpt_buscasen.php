<?php session_start();?>
<?php 
include('../conex_inicial.php');
include('../funciones/funciones.php');

//PAGINACION 1	
	$registros = 30; 
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
$buscarpor=$_GET['buscarpor'];
$valor=$_GET['valor'];
$fecha1=formatofecha($_GET['fecha1']);
$fecha2=formatofecha($_GET['fecha2']);
$chkIngresos=$_GET['chkIngresos'];
$chkSalidas=$_GET['chkSalidas'];
$chkTodos=$_GET['chkTodos'];
$factor=$_GET['factor'];


if($factor=='0'){
$filtroFactor=" ";
}else{
$filtroFactor=" and p.factor='1000' ";
}

if($chkIngresos==""){
	if($chkSalidas==""){
		$titulo="";
	}else{
		$titulo="DE SALIDAS";
	}
}else{
	$titulo="DE INGRESOS";	
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
.EstiloAnul {text-decoration:line-through; color:#FF0000 }
-->
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="" >
	<input type="hidden"  id="sucursal" value="<?=$sucursal;?>">
	<input type="hidden"  id="almacen" value="<?=$almacen;?>">
	<input type="hidden"  id="buscarpor" value="<?=$buscarpor;?>">
	<input type="hidden"  id="valor" value="<?=$valor;?>">
	<input type="hidden"  id="fecha1" value="<?=formatofecha($fecha1);?>">
	<input type="hidden"  id="fecha2" value="<?=formatofecha($fecha2);?>">
	<input type="hidden"  id="chkTodos" value="<?=$chkTodos;?>">
	<input type="hidden"  id="chkIngresos" value="<?=$chkIngresos;?>">
	<input type="hidden"  id="chkSalidas" value="<?=$chkSalidas;?>">

	<table border="0" width="756" align="center" cellpadding="0" cellspacing="0">
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
	<td colspan="4" align="left"><div align="center"><p class="Estilo28">BUSQUEDA SENSITIVA EN DOCUMENTOS <?php echo $titulo;?> </p></div></td>
</tr>
<tr>
	<td colspan="4" align="center">
		<table width="743" height="24" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="21" height="24" align="right" class="Estilo28">&nbsp;</td>
			<td width="304" height="24" align="right" class="Estilo28"><span class="Estilo27">De:</span></td>
			<td width="57" align="right" class="Estilo28"><?php echo $fecha1;?></td>
			<td width="34" align="right" class="Estilo28"><span class="Estilo27">Al:</span></td>
			<td width="57" align="right" class="Estilo28"><?php echo $fecha2;?></td>
			<td width="270" class="Estilo28">&nbsp;</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="4" align="left">&nbsp;</td>
</tr>
<tr>
	<td width="438" align="left" class="Estilo28"><span class="Estilo27"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sucursal:<span class="Estilo4">
	<?php 
	if($sucursal!="T"){
	$sql="Select * from sucursal where cod_suc='$sucursal'";

	$query=mysql_query($sql,$cn);
	$row=mysql_fetch_array($query);
	echo $row['des_suc'];
	$filtro_emp=" and dt.sucursal='".$sucursal."' ";
	}else{
		echo "T - Todos las Empresas";
		$filtro_emp="";
	}
	?></span></span></td>
	<td width="23" align="left" class="Estilo28">&nbsp;</td>
	<td width="197" align="left" class="Estilo28"><span class="Estilo27">Filtro: <?php if($valor=="**"){ echo "Todos"; }else{ echo $valor;}?>&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
</tr>
<tr>
	<td align="left" class="Estilo28"><span class="Estilo27">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tienda&nbsp;
    <?php 
	if($almacen!="T"){
		$sql="Select * from tienda where cod_tienda='$almacen'";
		$query=mysql_query($sql,$cn);
		$row=mysql_fetch_array($query);
		echo $row['cod_tienda']. "-".$row['des_tienda'];
		$filtro_tienda=" and dt.tienda ='".$almacen."' ";
	}else{
		echo "T - Todas las Tiendas";
		$filtro_tienda="";
	}
	?></span></td>
    <td align="left" class="Estilo28">&nbsp;</td>
    <td align="left" class="Estilo28"><span class="Estilo27">Busqueda: <?php echo $buscarpor;?>&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
    <td width="98" align="left" class="Estilo28">&nbsp;</td>
</tr>
<tr>
	<td colspan="4" align="left">&nbsp;</td>
</tr>
<tr>
	<td colspan="4" align="center">
	<table width="750" border="0" cellpadding="0" cellspacing="2" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
	<tr>
		<td width="746" colspan="4"  align="left" valign="baseline" class="Estilo16">
		<table width="744" border="0" cellspacing="1" cellpadding="1">
		<tr>
			<td width="337" height="16" align="left" bgcolor="#006699" class="Estilo16" colspan="4"><span class="Estilo8 Estilo34">Documento</span></td>
			<td width="400"  align="left" bgcolor="#006699" class="Estilo16" colspan="5">Detalle</td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td colspan="4"  align="left" class="Estilo16" valign="top">
		<table width="744" border="0" cellpadding="1" cellspacing="1"  style="vertical-align:top">
		<tr>
			<td width="65" bgcolor="#F0B442"><span class="Estilo27">Tienda</span></td>
			<td width="53" bgcolor="#F0B442"><span class="Estilo27">Fecha </span></td>
			<td width="88" bgcolor="#F0B442"><span class="Estilo27">N&deg; Doc</span></td>
			<td width="150" bgcolor="#F0B442"><span class="Estilo27">Cliente/Proveedor</span></td>
			<td width="51" bgcolor="#F0B442"><span class="Estilo27">Cod.Prod</span></td>
			<td width="144" bgcolor="#F0B442"><span class="Estilo27">Descripcion</span></td>
			<td width="56" bgcolor="#F0B442" style="color:#000000"><span class="Estilo27">Cantidad </span></td>
			<td width="65" bgcolor="#F0B442"><span class="Estilo27">Precio Unit</span></td>
            <td width="72" bgcolor="#F0B442"><span class="Estilo27">Precio Total</span></td>
		</tr>
		
    <?php
	if($chkSalidas!=""){
		$cod_doc=explode("|",$chkSalidas);
	}else{
		if($chkIngresos!=""){
			$cod_doc=explode("|",$chkIngresos);
		}else{
			$cod_doc=explode("|",$chkTodos);
		}
	}
	
	for($i=0;$i<count($cod_doc);$i++){
		if($cod_doc[$i]!=""){
			if($i==0){
				$filtrodocs=$cod_doc[$i];
			}else{
				$filtrodocs=$cod_doc[$i]."','".$filtrodocs;
			}
		}
	}
	if($chkTodos!=""){
		$filtrotipo="";
	}else{
		if($chkIngresos!=""){
			$filtrotipo=" and dt.tipo='1' ";
		}else{
			$filtrotipo=" and dt.tipo='2' ";
		}
	}
	$cons3=" where";
	$cons4=", dt.nom_prod as nombre";
	
	switch($buscarpor){
		case 'Cod.Sist.':$valor_det=str_pad($valor,6,"0",STR_PAD_LEFT);$filtro_det=" and dt.cod_prod='".$valor_det."' ";break;
		case 'Cod.Anex.':
		$cons4=", p.nombre,p.und";$cons3=", producto p where p.idproducto = dt.cod_prod AND ";
		$filtro_det=" and (p.cod_prod like'%".$valor."%' or p.codanex2 like'%".$valor."%' or p.codanex3 like'%".$valor."%')  $filtroFactor ";break;
		case 'Descripcion':
		$cons4=", p.nombre,p.und";$cons3=", producto p where p.idproducto = dt.cod_prod AND ";
		$filtro_det=" and dt.nom_prod like'%".$valor."%'  $filtroFactor ";break;
		case 'Notas':
		$cons4=", p.nombre,p.und";$cons3=", producto p where p.idproducto = dt.cod_prod AND ";
		$filtro_det=" and dt.notas like'%".$valor."%'  $filtroFactor";break;
	}
	if($valor=="**"){
		$cons4=", p.nombre,p.und";$cons3=", producto p where p.idproducto = dt.cod_prod AND ";
		$filtro_det=" $filtroFactor";
		
	}
	$filtro2="cm.cod_cab as ref,cm.cod_ope as co,cm.serie as se,cm.Num_doc as nd,cm.tipo as tk,concat(cm.cod_ope,' ',cm.serie,'-',cm.Num_doc) as td,cm.cliente as rz,cm.fecha as fec,dt.cantidad as cantidad,dt.precio as precio,dt.imp_item as total";
	
	$strSQL="select ".$filtro2.",dt.tienda as 'tienda',cm.flag as flag,dt.cod_prod".$cons4." from det_mov dt, cab_mov cm ".$cons3." dt.cod_cab = cm.cod_cab ".$filtrotipo.$filtro_tienda.$filtro_emp.$filtro_det." and dt.cod_ope in('".$filtrodocs."') and  substring(dt.fechad,1,10) between '".$fecha1."' and '".$fecha2."'  order by dt.fechad asc ";	
	
	//echo $strSQL;
//cm.cliente = c.codcliente AND 
//------------	 
	$sql2=mysql_query("Select SUM(IF(cm.moneda='01',dt.imp_item,0)) AS gran_total_s, SUM(IF(cm.moneda='02',dt.imp_item,0)) AS gran_total_d,SUM(dt.cantidad) as cantidadDet from det_mov dt, cab_mov cm ".$cons3." dt.cod_cab = cm.cod_cab ".$filtrotipo.$filtro_tienda.$filtro_emp.$filtro_det." and dt.cod_ope in('".$filtrodocs."') and  substring(dt.fechad,1,10) between '".$fecha1."' and '".$fecha2."'  order by dt.fechad asc ",$cn);
	$totales=mysql_fetch_array($sql2);
	
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
	while($rowreporte=mysql_fetch_array($resultadoreporte)){ 
	if($rowreporte['flag']=="A"){
		$anul="EstiloAnul";
	}else{
		$anul="Estilo45";
	}
		 
 ?>
	<tr>
		<td width="65" align="left" class="Estilo28"><span class="<?php echo $anul;?>"><?php if($_REQUEST['excel']!="S"){?>
	<img style="cursor:pointer" alt="" onClick="doc_det('<?php echo $rowreporte['ref'];?>')" src="../imagenes/ico_lupa.png" width="15" height="15">
	<?php }?><?php echo $rowreporte['tienda'] ?></span></td>
		<td width="53" align="left" class="Estilo28"><span class="<?php echo $anul;?>"><?php echo formatobarrafecha(substr($rowreporte['fec'],0,10))?></span></td>
		<td width="88" align="left" class="Estilo28"><span class="<?php echo $anul;?>"><?php echo $rowreporte['td']?></span></td>
		<td width="150" align="left" class="Estilo28"><span class="<?php echo $anul;?>"><?php 
		if($rowreporte['co']=='TS'){
			switch($rowreporte['tk']){
				case '1':$tt="2";echo "Transferencia Ingreso de";break;
				case '2':$tt="1";echo "Transferencia Salida a";break;
			}
			$rstrans=mysql_query("Select tienda from cab_mov where cod_ope='TS' and tipo='".$tt."' and serie='".$rowreporte['se']."' and Num_doc='".$rowreporte['nd']."'",$cn);
			$rwtrans=mysql_fetch_array($rstrans);
			$sqlti=mysql_query("Select * from tienda where cod_tienda='".$rwtrans[0]."'",$cn);
			$rwtienda=mysql_fetch_array($sqlti);
			echo ": ".$rwtienda['cod_tienda']." - ".$rwtienda['des_tienda'];
		}else{
			$rssql=mysql_query("Select razonsocial from cliente where codcliente='".$rowreporte['rz']."'",$cn);
			$rwrs=mysql_fetch_array($rssql);
			echo $rwrs[0];
		}
		?></span></td>
		<td width="51" align="left" class="Estilo28"><span class="<?php echo $anul;?>"><?php if ($rowreporte['cod_prod']=="TEXTO"){ echo "";}else{ echo $rowreporte['cod_prod']; }?></span></td>
		<td width="144" align="left" class="Estilo28"><span class="<?php echo $anul;?>"><?php echo $rowreporte['nombre']?></span></td>
		<td width="56" align="right" class="Estilo28"><span class="<?php echo $anul;?>"><?php echo $rowreporte['cantidad']?></span></td>
		<td width="65" align="right" class="Estilo28"><span class="<?php echo $anul;?>"><?php echo number_format($rowreporte['precio'],2,".","")?></span></td>
        <td width="72" align="right" class="Estilo28"><span class="<?php echo $anul;?>"><?php echo number_format($rowreporte['total'],2,".","")?></span></td>
	</tr>
    <?php }
	if($pagina==$total_paginas || $_REQUEST['excel']=="S"){
		if($totales[0]>0.00){
	?>
    <tr>
		<td>&nbsp;</td>
	</tr>
    <tr>
		<td colspan="6" align="right" class="Estilo28"><span class="Estilo45">TOTALES  </span></td>
        <td width="56" align="right" class="Estilo28"><span class="Estilo45"><?php echo number_format($totales[2],2,".",",")?></span></td>
        <td width="65" align="right" class="Estilo28">&nbsp;</td>
        <td width="72" align="right" class="Estilo28"><span class="Estilo45">S/.<?php echo number_format($totales[0],2,".",",")?></span></td>
	</tr>
    <?php }
	if($totales[1]>0.00){
	?>
    <tr>
		<td colspan="6" align="right" class="Estilo28"><span class="Estilo45">TOTALES  </span></td>
        <td width="56" align="right" class="Estilo28"><span class="Estilo45"><?php echo number_format($totales[2],2,".",",")?></span></td>
        <td width="65" align="right" class="Estilo28">&nbsp;</td>
        <td width="72" align="right" class="Estilo28"><span class="Estilo45">US$.<?php echo number_format($totales[1],2,".",",")?></span></td>
	</tr>
    <?php
	}
	}
	?>
	</table></td>
</tr>
</table></td>
	</tr>
    <?php if($_REQUEST['excel']!="S"){?>
<tr>
	<td colspan="5" align="center" bgcolor="#FFFFFF" style="color:#00F; text-decoration:underline">
	
	<a href="javascript:history.back(1)">Atr&aacute;s</a>
	
	</td>
</tr>
<?php }?>
<?php 
//PIE DE PAGINA
?>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
</table></td>
<? if($_REQUEST['excel']!="S"){ ?>
<table width="100%" height="21" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td width="311" height="21" align="left" valign="bottom" style="color:#333333"><span class="Estilo10">Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (de <strong><?php echo $total_registros?></strong> productos)</span>.</td>
    <td width="116" align="right" valign="bottom" style="color:#999999"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:13px">Ir a pag. <input type="text" size="3" maxlength="3" value="<?php echo $pagina?>" onkeyup="validar_pag(this,<?php echo $total_paginas;?>);" /></font></td>
    <td width="410" align="right" valign="bottom" style="color:#999999"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:13px">
      <?php 
			  
 if(($pagina - 1) > 0) { 
 echo "<a style='cursor:pointer' onclick='cargardatos(1)'>< Primera </a> ";
//echo "<a style='cursor:pointer' onclick='buscar_prod($pagina-1)'>< Anterior </a> "; 
} 
if($pagina+4<=$total_paginas){
	if($pagina>4){
	$inicio=$pagina-4;
	}else{
		$inicio=1;
	}
	$mostrar=$pagina+4;
}else{
	if(($pagina!=$total_paginas) && ($pagina+4<$total_paginas)){
	$inicio=$pagina-4;
	}else{
	$inicio=1;
	}
	$temp=$total_paginas-$pagina;
	$mostrar=$pagina+$temp;
}
for ($i=$inicio; $i<=$mostrar; $i++){ 
	if ($pagina == $i) { 
		echo "<b style='color:#000000'>".$pagina."</b> "; 
	} else { 
		echo "<a style='cursor:pointer' href='#' onclick='cargardatos($i)'>$i</a> "; 
	}
}
if(($pagina + 1)<=$total_paginas) { 
//echo " <a style='cursor:pointer' onclick='buscar_prod($pagina+1)'>Siguiente ></a>"; 
echo "<a style='cursor:pointer' onclick='cargardatos($total_paginas)'>Ultima ></a> ";
} 
?>&nbsp;&nbsp;</font>
	<input type="hidden" name="pag" id="pag" value="<?php echo $pagina?>" />
	<input type="hidden" name="docsNoAnu" id="docsNoAnu" value="<?php echo $_SESSION['docConSerie3']?>">
	<input type="hidden" name="docsNoDesAnu" id="docsNoDesAnu" value="<?php echo $_SESSION['docConSerie4']?>">
	</td>
</tr>
</table>
<? } ?>
</td>
</tr>
</table>
</form>

<script>
function validar_pag(pagina,total){
	if(isNaN(pagina.value)){
		pagina.value=1;
		cargardatos(1);
	}else{
		if(pagina.value<total){
			pagina.value=pagina.value;
			cargardatos(pagina.value);
		}else{
			cargardatos(total);
		}
	}
}
function cargardatos(pagina){
var sucursal=document.form1.sucursal.value;
var almacen=document.form1.almacen.value;
var buscarpor=document.form1.buscarpor.value;
var valor=document.form1.valor.value;
var fecha1=document.form1.fecha1.value;
var fecha2=document.form1.fecha2.value;
var chkTodos=document.form1.chkTodos.value;
var chkIngresos=document.form1.chkIngresos.value;
var chkSalidas=document.form1.chkSalidas.value;

htmlreporte="?chkTodos="+chkTodos+"&chkIngresos="+chkIngresos+"&chkSalidas="+chkSalidas+"&buscarpor="+buscarpor+"&fecha1="+fecha1+"&fecha2="+fecha2+"&valor="+valor+"&sucursal="+sucursal+"&almacen="+almacen+'&pagina='+pagina;

	document.form1.action="rpt_buscasen.php"+htmlreporte;
	document.form1.submit();	

}
function doc_det(valor){

window.open("../doc_det2.php?referencia="+valor,"","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=320,left=300 top=250");

}
</script>

</body>
</html>