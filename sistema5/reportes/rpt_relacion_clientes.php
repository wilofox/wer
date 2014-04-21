<?php 
include("../conex_inicial.php");
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<script language="javascript">
/*
//function desactivar(){
document.form1.tipocliente.disabled=true;
document.form1.vendedor.disabled=true;
//}
function activar(){
if(document.form1.persona.checked==true){
document.form1.tipocliente.disabled=false;
}else{
document.form1.tipocliente.disabled=true;
}
if(document.form1.vendedor2.checked==true){
document.form1.vendedor.disabled=false;
}else{
document.form1.vendedor.disabled=true;
}
}
*/
function enviar(){
if(document.form1.tipocliente.value!=0){
document.form1.action="rpt_relacion_clientes.php";
document.form1.submit();
}
}
function enviarFrm(){
document.form1.action="rpt_relacion_clientes_excel.php";
document.form1.submit();
}

function cargar_detalle(tipocliente){

//var tipocliente=document.form1.tipocliente.value;
//alert(tipocliente);

doAjax('detalle_clientes.php','tipocliente='+tipocliente,'view_det','get','0','1','','');

}

function view_det(texto){
//alert(texto);

//var r = texto.split('?');
document.getElementById('detalle').innerHTML=texto;
//document.form1.carga.value='N';
//document.getElementById('paginacion').innerHTML=r[1];

}

</script>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Relacion de Clientes</title>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.Estilo10 {font-family: Arial, Helvetica, sans-serif; color: #FFFFFF; font-size: 12px; font-weight: bold; }
.Estilo14 {font-size: 18px}
-->
</style>
</head>
<script language="javascript" src="miAJAXlib2.js"></script>
<body >
<table width="850" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><table width="820" border="0" cellspacing="0" cellpadding="0">
      <form name="form1" id="form1">
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><span class="Estilo1">Listado de Clientes</span></td>
        </tr>
        <tr>
          <td align="center"><table width="750" border="0" cellspacing="0" cellpadding="0">
            <tr height="20">
              <td colspan="7"><span class="Estilo14"></span></td>
            </tr>
            <tr height="30">
              <td width="27" align="left" class="Estilo1 Estilo14">&nbsp;</td>
              <td width="98" align="left" class="Estilo1">Tipo Cliente</td>
              <td width="192" align="left"><select name="tipocliente" id="tipocliente" onchange="cargar_detalle(this.value)" >
                <option value="0" selected="selected">---Seleccione---</option>
                <option value="N">Persona Natural</option>
                <option value="J">Persona Juridica</option>
              </select></td>
              <td width="83">&nbsp;</td>
              <td width="36"><table onClick="enviarFrm()"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="25" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="93" align="center"><img  src="../imagenes/ico-excel.gif" width="22" height="22"></td>
                </tr>
                
              </table></td>
              <td width="213" align="left"><span class="Estilo1">Exportar a Excel</span>
                  <input type="hidden" value="S"  id="excel" name="excel" ></td>
              <td width="101"></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td width="4">&nbsp;</td>
            </tr>
			
  <td colspan="7" align="center"> </td>
  </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center">	  <div id="detalle" style="width:760px; height:300px; overflow:scroll">
   
		     
		  </div></td>
        </tr>
        <tr>
          <td align="center"></td>
        </tr>
      </form>
    </table></td>
  </tr>
</table>
</body>
</html>
