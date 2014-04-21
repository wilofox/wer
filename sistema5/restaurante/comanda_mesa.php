<?php 
include('conex_inicial.php');
?>

<style type="text/css">

.Estilo9 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.Estilo12 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo13 {font-size: 10px}
-->


<!--
.Estilo11 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }
.Estilo17 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #000000; }
.Estilo19 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FFFFFF; }
.Estilo20 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 14px;
	color: #990000;
}
-->
</style>

<script language="javascript" src="../miAJAXlib2.js"></script>
<script>
function entrada(objeto){
//document.getElementById('prueba').value=objeto.style.background;
//alert(objeto.style.background);
if((objeto.style.background == '' || objeto.style.background == '#f3f3f3') && objeto.style.backgroundColor!='#993300'){ 
objeto.style.background='#FFE479';
//document.getElementById('prueba').value=objeto.style.background;
//est=0;
}
//alert(objeto.style.background);
//objeto.style.color='#fff';
//document.getElementById('prueba').value=objeto.style.background;
//document.getElementById('prueba2').value=est;
}

function salida(objeto){
//alert(objeto.style.background);
//document.getElementById('prueba').value=objeto.style.background;
if(objeto.style.background == '#ffe479'){ 
objeto.style.background='#F3F3F3';
//objeto.style.background='#EEEEEE';
objeto.style.color='#000';
}
//document.getElementById('prueba').value=objeto.style.background;
//document.getElementById('prueba2').value=est;
}


function cargar_detalle(cod){
 doAjax('detalle_mesa.php','&mesa='+cod,'detalle_mesa','get','0','1','','');
//alert(cod);
document.getElementById('numero').innerHTML=cod;
}

function detalle_mesa(texto){
//alert(texto);
var r = texto;
document.getElementById('detalle').innerHTML=r;
}


function recargar(){
document.formulario.submit();
}

</script>



<body>
<table width="753" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="28">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td colspan="4"><form name="formulario" method="post" action="">
      <input name="ruc2" type="hidden" size="10"/>
          </form>    </td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td width="194"><span class="Estilo20">LISTADO DE MESAS </span></td>
    <td width="51"><a onClick="recargar();"><img style="cursor:pointer" src="../imgenes/actualziar.gif" width="29" height="26" border="0"></a></td>
    <td>&nbsp;</td>
    <td width="285"> <span style=" font-family:Arial, Helvetica, sans-serif; font:bold; font-size:12px">DETALLE MESA</span><span class="Estilo20"> N&ordm; 
    <label id="numero"></label></span></td>
    <td width="36" align="center" valign="middle"><a  onClick="agregar_comanda();"><img src="../imgenes/view_bottom.gif" alt="Agregar Comanda" width="29" height="29" border="0"></a></td>
    <td width="62" align="center" valign="middle"><a onClick="facturar();"><img src="../imgenes/visa2.gif" alt="Caja - Facturacion" width="48" height="30"></a></td>

    <td width="67" valign="middle"><img onClick="precuenta();" alt="Imprimir" src="../imgenes/fileprint.gif" width="40" height="30"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="205">&nbsp;</td>
    <td colspan="2" align="left" valign="top"><div style="width:100%; height:130px;">
      <table width="228" height="94" border="1" align="left" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bgcolor="#F3F3F3">
        <tr>
          <td width="60" height="26" align="center" bgcolor="#CFCFCF"><span class="Estilo17">CODIGO</span></td>
          <td width="66" align="center" bgcolor="#CFCFCF"><span class="Estilo17">&nbsp;&nbsp;NOMBRE</span></td>
          <td width="88" align="center" bgcolor="#CFCFCF"><span class="Estilo17">&nbsp;&nbsp;ESTADO</span></td>
        </tr>
        <?php 

//*-------------actualizando-------------------------

$strSQL77="select * from mesa where id not in (select mesa from comanda where estado!='')";
$resultado77=mysql_query($strSQL77,$cn);
while($row77=mysql_fetch_array($resultado77))
{
$strSQL78="update mesa set estado='L' where id='".$row77['id']."'";
mysql_query($strSQL78,$cn);
}

//---------------------------------------


$strSQL="select * from mesa";
$resultado=mysql_query($strSQL,$cn);
while($row=mysql_fetch_array($resultado))
{
	if($row['estado']=='O'){

?>
        <tr  onmouseover="entrada(this)" onMouseOut="salida(this)" onClick="cargar_detalle('<?php echo $row['id']?>');" style="background-color:#993300; cursor:pointer">
          <td height="20"  align="center"><span class="Estilo19"><?php echo $row['id']?></span></td>
          <td><span class="Estilo19"><span class="Estilo17">&nbsp;</span><span class="Estilo17">&nbsp;</span><?php echo $row['descripcion']?></span></td>
          <td align="left"><span class="Estilo19"><span class="Estilo17">&nbsp;</span><span class="Estilo17">&nbsp;</span> <?php echo "OCUPADO";?></span></td>
        </tr>
        <?php
	}else{
	
	?>
        <tr style="cursor:pointer" onMouseOver="entrada(this)" onMouseOut="salida(this)" onClick="cargar_detalle('<?php echo $row['id']?>');">
          <td height="20" align="center"><span class="Estilo11"><?php echo $row['id']?></span></td>
          <td><span class="Estilo11"><span class="Estilo17">&nbsp;</span><span class="Estilo17">&nbsp;</span><?php echo $row['descripcion']?></span></td>
          <td align="left"><span class="Estilo11"><span class="Estilo17">&nbsp;</span><span class="Estilo17">&nbsp;</span> <?php echo "LIBRE";?></span></td>
        </tr>
        <?php
	}

}
 ?>
        <tr bgcolor="#CFCFCF">
          <td height="16"></td>
          <td></td>
          <td></td>
        </tr>
      </table>
    </div></td>
    <td valign="top">&nbsp;</td>
    <td colspan="4" valign="top"><div id="detalle" style="width:100%; height:130px;"></div>
	<div id="comanda" style="width:100%; height:130px;"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
</table>

</body>


<script>

function agregar_comanda(){
var num_mesa=document.getElementById('numero').innerHTML;

location.href="comanda.php?add_mesa="+num_mesa;



}


function facturar(){

var num_mesa=document.getElementById('numero').innerHTML;
	if(num_mesa!=""){
	window.open('../empresa.php?mesa='+num_mesa,'vent','width=585,height=480,top=180,left=200,status=yes,scrollbars=yes');
	}
	//window.open.document.form1.mesa.value=num_mesa;
	
}


function eliminar(cod){
	if(confirm('Esta seguro que desea eliminar este producto?')){
	
	var mesa=document.getElementById('numero').innerHTML;
	doAjax('detalle_mesa.php','&mesa='+mesa+'&codigo='+cod,'detalle_mesa','get','0','1','','');
	//location.href='lista_sucursal.php?cod='+cod;
	//this.form1.submit();
	}
//window.open('editar_producto.php?cod='+cod,'ventana','height=470 width=500');
}

function precuenta(){

var mesa=document.getElementById('numero').innerHTML;
window.open('imp_precuenta.php?mesa='+mesa,'','width=1,height=1,top=0,left=0,scroolbars=no,directories=no,location=no,menubar =no,titlebar=no,toolbar=no');
}

</script>