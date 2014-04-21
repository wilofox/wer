<?
	$moneda=$_REQUEST['moneda'];
	$util=$_REQUEST['util'];
	$reporte=$_REQUEST['reporte'];
	$sucursal=$_REQUEST['sucursal'];
	$almacen=$_REQUEST['almacen'];
	$cliente=$_REQUEST['cliente'];
	$ruc=$_REQUEST['ruc'];
	$producto=$_REQUEST['producto'];
	$respon=$_REQUEST['respon'];
	$documento=$_REQUEST['documento'];
	$filtro_cla=$_REQUEST['filtro_cla'];
	$filtro_cat=$_REQUEST['filtro_cat'];
	$filtro_sub=$_REQUEST['filtro_sub'];
	$fecha1=$_REQUEST['fecha1'];
	$fecha2=$_REQUEST['fecha2'];
	$ordenar=$_REQUEST['ordenar'];
	$cmbnum=$_REQUEST['cmbnum'];
	$Costo=$_REQUEST['Costo'];
	$utilizar=$_REQUEST['utilizar'];

	if(isset($_REQUEST['imprimir'])){
		$imprimir=$_REQUEST['imprimir'];
	}else{
		$imprimir=$_REQUEST['impirmir'];
	}
	
	if ($moneda=='01'){
		$NomMoneda='S/.';
	}else{
		$NomMoneda='US$.';
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Resultado Utilidad (<?=strtoupper("$reporte - $util");?>)</title>
<script language="javascript" src="../miAJAXlib2.js"></script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo101 {
	color: #333333;
	font-size: 12px;
}
-->
</style></head>


<link href="../styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
background-color:#F3F3F3;   
}
.texto1{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #000000;
}
.texto2{
	font-family: Verdana,Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #000000;
}

</style>
<body onLoad="cargardatos('');">

<form id="form1" name="form1" method="post" action="">
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td style="color:#0000FF">&nbsp;</td>
  </tr>
  <tr>
    <td width="30">&nbsp;</td>
    <td width="410" style="color:#0000FF"><b>EXPRESADO EN (<?=$NomMoneda;?>) </b></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<div style="padding-left:20px;">
<?
if ($util=='producto' and $reporte=='Consolidado' ){
?>
<table width="704" height="26" border="0" cellpadding="0" cellspacing="1">
  <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
    <td  colspan="2" align="center"   style=" border:#CCCCCC solid 1px" >&nbsp;</td>
    <?php if($imprimir=='true'){ ?>
    <td width="120"  align="center"  style=" border:#CCCCCC solid 1px"><span class="texto2"><strong>C&oacute;digo</strong></span></td>
    <?php }else{ ?>
    <td width="120"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>C&oacute;d. Anexo </strong></span></td>
    <?php } ?>
    <td width="199"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Productos</strong></span></td>
    <td width="63"  style=" border:#CCCCCC solid 1px"><span class="texto2"><strong>Cantidad</strong></span></td>
    <td width="80"   style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Total Venta </strong></span></td>
    <td width="82"   style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>
	<? if ($utilizar=='true'){ echo 'Total Costo';}else{ echo 'Tot. Refer';}?> </strong></span></td>
    <td width="63"   style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Utilidad</strong></span></td>
    <td width="76"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Porct.%</strong></span></td>
  </tr>
</table>
<?
}elseif ($util=='producto' and $reporte=='Detallado' ){
?>
<table width="810" height="26" border="0" cellpadding="0" cellspacing="1">
  <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
    <td  colspan="2" align="center"   style=" border:#CCCCCC solid 1px" >&nbsp;</td>
    <td width="17"  align="center"  style=" border:#CCCCCC solid 1px"><span class="texto2"><strong>TD</strong></span></td>
    <td width="66"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Numero</strong></span></td>
    <td width="56"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Fecha</strong></span></td>
    <?php if($imprimir=='true'){ ?>
    <td width="87"  style=" border:#CCCCCC solid 1px"><span class="texto2"><strong>Codigo</strong></span></td>
    <?php }else{ ?>
    <td width="87"   style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Cod. Espce.   </strong></span></td>
    <?php } ?>
    <td width="163"   style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Producto</strong></span></td>
    <td width="52"   style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Cantidad</strong></span></td>
    <td width="56"   style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Precio Venta </strong></span></td>
    <td width="57"   style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong><? if ($utilizar=='true'){ echo 'Precio Costo';}else{ echo 'Prec. Refer';}?></strong></span></td>
    <td width="63"   style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Total Venta </strong></span></td>
    <td width="60"   style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong><? if ($utilizar=='true'){ echo 'Total Costo';}else{ echo 'Tot. Refer';}?> </strong></span></td>
    <td width="59"   style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Utilidad</strong></span></td>
    <td width="61"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Porct.%</strong></span></td>
  </tr>
</table>
<?
}elseif ($util=='cliente' and $reporte=='Consolidado' ){
?>
<table width="700" height="26" border="0" cellpadding="0" cellspacing="1">
  <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
    <td  colspan="2" align="center"   style=" border:#CCCCCC solid 1px" >&nbsp;</td>
    <td width="51"  align="center"  style=" border:#CCCCCC solid 1px"><span class="texto2"><strong>C&oacute;digo</strong></span></td>
    <td width="83"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Ruc</strong></span></td>
    <td width="252"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Auxiliar</strong></span></td>
    <td width="82"  style=" border:#CCCCCC solid 1px"><span class="texto2"><strong>Total Venta </strong></span></td>
    <td width="82"   style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong><strong>
      <? if ($utilizar=='true'){ echo 'Total Costo';}else{ echo 'Tot. Refer';}?>
    </strong></strong></span></td>
    <td width="60"   style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Utilidad</strong></span></td>
    <td width="72"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Porct.%</strong></span></td>
  </tr>
</table>
<?
}elseif ($util=='cliente' and $reporte=='Detallado' ){
?>
<table width="810" height="26" border="0" cellpadding="0" cellspacing="1">
  <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
    <td  colspan="2" align="center"   style=" border:#CCCCCC solid 1px" >&nbsp;</td>
    <td width="23"  align="center"  style=" border:#CCCCCC solid 1px"><span class="texto2"><strong>TD</strong></span></td>
    <td width="70"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Numero</strong></span></td>
    <td width="62"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Fecha</strong></span></td>
    <?php if($imprimir=='true'){ ?>
    <td width="102"   style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Cod. Prod. </strong></span></td>
    <?php }else{ ?>
    <td width="102"   style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Cod. Anex. </strong></span></td>
    <?php } ?>
    <td width="120"   style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Producto</strong></span></td>
    <td width="60"   style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Cantidad</strong></span></td>
    <td width="52"   style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Precio Venta </strong></span></td>
    <td width="63"   style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>
      <? if ($utilizar=='true'){ echo 'Precio Costo';}else{ echo 'Prec. Refer';}?>
    </strong></span></td>
    <td width="61"   style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Total Venta </strong></span></td>
    <td width="57"   style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>
      <? if ($utilizar=='true'){ echo 'Total Costo';}else{ echo 'Tot. Refer';}?>
    </strong></span></td>
    <td width="68"   style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Utilidad</strong></span></td>
    <td width="76"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Proct.%</strong></span></td>
  </tr>
</table>
<?
}
?>
</div>

<div id="detalle">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="120">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><span class="Estilo101">Procesando Informaci&oacute;n</span><br>
      <br><img src="../imgenes/cargando2.gif" width="16" height="16"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>


</div>

</form>
</body>
</html>
<script>
function cargardatos(pagina){
//alert(pagina);
var moneda=<?=$moneda;?>;
var util="<?=$util;?>";
var reporte="<?=$reporte;?>";
var sucursal="<?=$sucursal;?>";
var almacen="<?=$almacen;?>";
var cliente="<?=$cliente;?>";
var ruc="<?=$ruc;?>";
var producto="<?=$producto;?>";
var respon="<?=$respon;?>";
var documento="<?php echo $_REQUEST['documento'];?>";
var filtro_cla="<?=$filtro_cla;?>";
var filtro_cat="<?=$filtro_cat;?>";
var filtro_sub="<?=$filtro_sub;?>";
var fecha1="<?=$fecha1;?>";
var fecha2="<?=$fecha2;?>";
var ordenar="<?=$ordenar;?>";
var cmbnum="<?=$cmbnum;?>";
var Costo="<?=$Costo;?>";
var utilizar="<?=$utilizar;?>";
var imprimir="<?=$imprimir;?>";

//alert(documento);
doAjax('cuerpo.php','&almacen='+almacen+'&sucursal='+sucursal+'&pagina='+pagina+"&moneda="+moneda+"&util="+util+"&reporte="+reporte+"&cliente="+cliente+"&ruc="+ruc+"&producto="+producto+"&respon="+respon+"&documento="+documento+"&filtro_cla="+filtro_cla+"&filtro_cat="+filtro_cat+"&filtro_sub="+filtro_sub+"&imprimir="+imprimir+"&fecha1="+fecha1+"&fecha2="+fecha2+"&ordenar="+ordenar+"&cmbnum="+cmbnum+"&utilizar="+utilizar+"&Costo="+Costo,'mostrar_filtro','get','0','1','','');

//doAjax('cuerpo.php',"?sucursal="+sucursal+"&almacen="+almacen+"&cliente="+cliente+"&ruc="+ruc+"&producto="+producto+"&moneda="+moneda+"&util="+util+"&reporte="+reporte+"&filtro_cla="+clasificacion+"&filtro_cat="+categoria+"&filtro_sub="+subcategoria+"&ordenar="+ordenar+"&fecha1="+fecha1+"&fecha2="+fecha2+"&impirmir="+impirmir+"&utilizar="+utilizar+"&Costo="+Costo+"&documento="+documento+"&Condicion="+Condicion+"&pagina="+pagina,'mostrar_filtro','get','0','1','','');

}
function mostrar_filtro(texto){
document.getElementById('detalle').innerHTML=texto;
//cargar();
//document.form1.carga.value='N';
}
function cambiar_color1(obj){
obj.style.background='#FFF1BB';
obj.style.border='#C0C0C0 solid 1px';
}

function cambiar_color2(obj){
obj.style.background='#F3F3F3';
obj.style.border=' ';
}
function generar_inventario(parametro){

var moneda = <?=$moneda;?>;
var util = "<?=$util;?>";
var reporte = "<?=$reporte;?>";
var sucursal = "<?=$sucursal;?>";
var almacen = "<?=$almacen;?>";
var cliente = "<?=$cliente;?>";
var ruc = "<?=$ruc;?>";
var producto = "<?=$producto;?>";
var respon = "<?=$respon;?>";
var documento = "<?php echo $_REQUEST['documento'];?>";
var filtro_cla = "<?=$filtro_cla;?>";
var filtro_cat = "<?=$filtro_cat;?>";
var filtro_sub = "<?=$filtro_sub;?>";
var fecha1 = "<?=$fecha1;?>";
var fecha2 = "<?=$fecha2;?>";
var ordenar = "<?=$ordenar;?>";
var cmbnum = "<?=$cmbnum;?>";
var Costo = "<?=$Costo;?>";
var utilizar = "<?=$utilizar;?>";
var imprimir = "<?=$imprimir;?>";
var pagina = document.form1.pagina.value;


//document.form1.pagina.value='utilitario_excel.php?almacen='+almacen+'&sucursal='+sucursal+'&pagina='+pagina+"&moneda="+moneda+"&util="+util+"&reporte="+reporte+"&cliente="+cliente+"&ruc="+ruc+"&producto="+producto+"&respon="+respon+"&documento="+documento+"&filtro_cla="+filtro_cla+"&filtro_cat="+filtro_cat+"&filtro_sub="+filtro_sub+"&fecha1="+fecha1+"&fecha2="+fecha2+"&ordenar="+ordenar+"&cmbnum="+cmbnum+"&utilizar="+utilizar+"&Costo="+Costo+'&formato='+parametro;

	if(parametro=='vista'){
		
window.open('utilitario_excel.php?almacen='+almacen+'&sucursal='+sucursal+'&pagina='+pagina+"&moneda="+moneda+"&util="+util+"&reporte="+reporte+"&cliente="+cliente+"&ruc="+ruc+"&producto="+producto+"&respon="+respon+"&documento="+documento+"&filtro_cla="+filtro_cla+"&filtro_cat="+filtro_cat+"&filtro_sub="+filtro_sub+"&imprimir="+imprimir+"&fecha1="+fecha1+"&fecha2="+fecha2+"&ordenar="+ordenar+"&cmbnum="+cmbnum+"&utilizar="+utilizar+"&Costo="+Costo+'&formato='+parametro,"vent2","toolbar=no,status=yes, menubar=no, scrollbars=no, width=750, height=700,left=50 top=50");
		//window.open("utilitario_excel.php?precio="+document.form1.precios.value+"&agr_cla="+agr_cla+"&agr_cat="+agr_cat+"&agr_sub="+agr_sub+"&filtro_cla="+clasificacion+"&filtro_cat="+categoria+"&filtro_sub="+subcategoria+"&ordenar="+ordenar+"&formato="+parametro+"&tienda="+tienda+"&precios="+precios+"&sucursal="+sucursal+"&incluir="+incluir+"&mon="+mon+"&valor="+valor+'&tpuser='+tpuser,"vent2","toolbar=no,status=yes, menubar=no, scrollbars=no, width=750, height=700,left=50 top=50");
		
	}else{
	
window.open('utilitario_excel.php?almacen='+almacen+'&sucursal='+sucursal+'&pagina='+pagina+"&moneda="+moneda+"&util="+util+"&reporte="+reporte+"&cliente="+cliente+"&ruc="+ruc+"&producto="+producto+"&respon="+respon+"&documento="+documento+"&filtro_cla="+filtro_cla+"&filtro_cat="+filtro_cat+"&filtro_sub="+filtro_sub+"&imprimir="+imprimir+"&fecha1="+fecha1+"&fecha2="+fecha2+"&ordenar="+ordenar+"&cmbnum="+cmbnum+"&utilizar="+utilizar+"&Costo="+Costo+'&formato='+parametro,"vent2","toolbar=no,status=yes, menubar=no, scrollbars=no, width=750, height=700,left=50 top=50");
	//window.open("utilitario_excel.php?precio="+document.form1.precios.value+"&agr_cla="+agr_cla+"&agr_cat="+agr_cat+"&agr_sub="+agr_sub+"&filtro_cla="+clasificacion+"&filtro_cat="+categoria+"&filtro_sub="+subcategoria+"&ordenar="+ordenar+"&formato="+parametro+"&tienda="+tienda+"&precios="+precios+"&sucursal="+sucursal+"&incluir="+incluir+"&mon="+mon+"&valor="+valor+'&tpuser='+tpuser,"vent2","toolbar=no,status=yes, menubar=no, scrollbars=no, width=700, height=700,left=50 top=50");
	
	}

}
</script>