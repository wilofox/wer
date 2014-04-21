<?php 
session_start();
include('../conex_inicial.php');
include('../funciones/funciones.php');

list($nomb_lider)=mysql_fetch_row(mysql_query("select razonsocial from cliente where codcliente ='".$_REQUEST['codigo']."'"));

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Clientes x Lider</title>
<style type="text/css">
<!--
.Estilo2 {font-weight: bold; color: #0066CC; font-size: 14px; font-family: Arial, Helvetica, sans-serif;}
.Estilo10 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo14 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 11px; color: #FFFFFF; }
img { behavior: url(../ventas/iepngfix.htc); }
.Estilo15 { color: #333333; font-size: 11px; font-family: Arial, Helvetica, sans-serif; }
.Estilo16 {color: #FF0000}
.Estilo118 { color: #333333; font-size: 11px; font-family: Arial, Helvetica, sans-serif; }
-->
.anulado {text-decoration:line-through;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#990000; }
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
</style>
</head>

<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>
<script language="javascript" src="../Finanzas/miAJAXlib3.js"></script>

<body onLoad="cargarClientes()">
<form name="form1" method="post" action="">
  <table width="680" height="470" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="34" bgcolor="#EFEFEF" class="Estilo2">&nbsp;</td>
      <td height="34" colspan="3" align="center" bgcolor="#EFEFEF" class="Estilo2">CLIENTES POR L&Iacute;DER
        <input type="hidden" name="codLider" id="codLider" value="<?php  echo $_REQUEST['codigo']?>">
      <input type="hidden" name="carga" id="carga"></td>
    </tr>
    <tr>
      <td height="19" colspan="4" class="Estilo2">&nbsp;</td>
    </tr>
    <tr>
      <td height="19" class="Estilo2">&nbsp;</td>
      <td width="263" height="19" align="left" class="Estilo15"><span class="Estilo16">L&Iacute;DER:</span> <span><b><?php echo $nomb_lider;?></b></span></td>
      <td width="278" align="left" class="Estilo15"><strong>Del</strong>
          <input readonly="" style="height:18px; font:Arial, Helvetica, sans-serif; font-size:11px; text-align:center; background:none; border:none; border-bottom:#CCCCCC solid 1 px"  name="fecha1" type="text" id="fecha1" size="10"   maxlength="10" value="<?php if(isset($_REQUEST['fecha'])){echo $_REQUEST['fecha'];}else{ echo date('01-m-Y',time()-3600);} ?>">
          <button type="reset" id="f_trigger_b2" style="height:20px" >...</button>
        <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha1",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b2",   
        singleClick    :    true,           
        step           :    1                
    });
      </script>
          <strong>Al :</strong>
          <input readonly="" style="height:18px; font:Arial, Helvetica, sans-serif; font-size:11px; text-align:center; background:none; border:none; border-bottom:#CCCCCC solid 1 px;" name="fecha2" type="text" id="fecha2" size="10"   maxlength="10" value="<?php if(isset($_REQUEST['fecha2'])){echo $_REQUEST['fecha2'];}else{ echo date('d-m-Y',time()-3600);} ?>">
          <button type="reset" id="f_trigger_b3" style="height:20px" >...</button>
		  
        <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha2",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b3",   
        singleClick    :    true,           
        step           :    1                
    });
                        </script></td>
      <td width="131" align="left" class="Estilo15"><input onClick="cargarClientes()" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(../imagenes/boton_aplicar.gif) ; cursor:pointer; font:bold" type="button" name="Submit" value="Procesar" >      </td>
    </tr>
    <tr>
      <td height="19" class="Estilo2">&nbsp;</td>
      <td height="19" colspan="3" align="left" class="Estilo15">&nbsp;</td>
    </tr>
    <tr>
      <td width="8" height="132">&nbsp;</td>
      <td colspan="3" valign="top"><table width="640" border="0" cellspacing="1" cellpadding="0">
          <tr>
            <td width="50" align="center" bgcolor="#0099FF"><span class="Estilo14">C&oacute;digo</span></td>
            <td width="310" bgcolor="#0099FF"><span class="Estilo14">Raz&oacute;n Social </span></td>
            <td width="75" align="center" bgcolor="#0099FF"><span class="Estilo14">Ruc</span></td>
            <td width="65" align="center" bgcolor="#0099FF"><span class="Estilo14">Cant. Docum.</span></td>
            <td width="65" align="center" bgcolor="#0099FF"><span class="Estilo14">Total Compras </span></td>
            <td width="65" align="center" bgcolor="#0099FF"><span class="Estilo14">Total Puntos </span></td>
            <td width="55" align="center" bgcolor="#0099FF"><span class="Estilo14">Detalles</span></td>
          </tr>
          <tr>
            <td colspan="7" bgcolor="#F9F9F9"><div style="overflow-y: scroll; height:150px; width:636px" id="listaClientes"></div></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
      <td><strong class="Estilo15">Documentos</strong></td>
      <td colspan="2"  class="Estilo15"><span class="Estilo16">
        <input type="hidden" name="codcliente">
        CLIENTE:&nbsp;&nbsp;</span><b>
      <label class="Estilo15" id="lblCliente"></label></b></td>
    </tr>
    <tr>
      <td height="27">&nbsp;</td>
      <td colspan="3"><table width="638" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td width="125" height="19" align="center" bgcolor="#01BBDC"><span class="Estilo14">Fecha <strong><img src="../imgenes/arrowmain.gif" width="8" height="16" onClick="verOrder()" style="cursor:pointer"></strong></span></td>
          <td width="63" align="center" bgcolor="#01BBDC"><span class="Estilo14">Tienda</span></td>
          <td width="62" align="center" bgcolor="#01BBDC"><span class="Estilo14">Doc</span></td>
          <td width="108" align="center" bgcolor="#01BBDC"><span class="Estilo14">N&uacute;mero</span></td>
          <td width="111" align="center" bgcolor="#01BBDC"><span class="Estilo14">Importe</span></td>
          <td width="75" align="center" bgcolor="#01BBDC"><span class="Estilo14">Puntos</span></td>
          <td width="86" align="center" bgcolor="#01BBDC"><span class="Estilo14">Detalles</span></td>
        </tr>
        <tr>
          <td colspan="7" bgcolor="#F9F9F9"><div style="overflow-y: scroll; height:150px; width:636px" id="divDoc"></div></td>
        </tr>
      </table></td>
    </tr>
  </table>
  
   <div id="divOrder" style="position:absolute; left: 102px; top: 336px; height: 48px; width: 95px; visibility:hidden">
	    <table width="75" height="48" border="1"  bgcolor="#1DC0BC">
	              <tr>
	                <td><table width="92" border="0" cellpadding="0" cellspacing="0">
	                    <tr  onMouseOver="entradaOrder(this)" onMouseOut="entradaOrder(this)" style="cursor:pointer" onClick="ordenar('fecha','asc')">
	                      <td height="18" class="Estilo118 Estilo119 Estilo121" style="font:bold; color:#FFFFFF">&nbsp;Ascendente</td>
                    </tr>
	                    <tr onMouseOver="entradaOrder(this)" onMouseOut="entradaOrder(this)" style="cursor:pointer" onClick="ordenar('fecha','desc')" >
	                      <td height="18" class="Estilo118 Estilo119 Estilo121" style="font:bold; color:#FFFFFF">&nbsp;Descendente</td>
                    </tr>
                    </table></td>
                </tr>
        </table>
  </div>
  
</form>
</body>
</html>
<script>
function cambiar_fondo(control,evento){

if(evento=='e')
control.style.backgroundImage='url(../imagenes/boton_aplicar2.gif)';
else
control.style.backgroundImage='url(../imagenes/boton_aplicar.gif)';
}

function cargarClientes(){

var fecha1=document.form1.fecha1.value;
var fecha2=document.form1.fecha2.value;
var codLider=document.form1.codLider.value;

doAjax('peticion_datos.php','&peticion=cargarClientes&fecha1='+fecha1+'&fecha2='+fecha2+'&codLider='+codLider,'rs_cargarClientes','get','0','1','listaClientes','');

}

function rs_cargarClientes(texto){

document.getElementById("listaClientes").innerHTML=texto;
temp=document.getElementById('tblClie').rows[0];
document.form1.carga.value="";
}

function cargarDoc(codcliente,campoOrder,tOrder){

var fecha1=document.form1.fecha1.value;
var fecha2=document.form1.fecha2.value;

doAjax('peticion_datos.php','&peticion=cargarDoc&fecha1='+fecha1+'&fecha2='+fecha2+'&codcliente='+codcliente+'&campoOrder='+campoOrder+'&tOrder='+tOrder,'rs_cargarDoc','get','0','1','divDoc','');

}

function rs_cargarDoc(texto){
var tempTex=texto.split("|");

document.getElementById("divDoc").innerHTML=tempTex[0];
document.getElementById("lblCliente").innerHTML=tempTex[1];
document.form1.codcliente.value=tempTex[2];
//alert(tempTex[1]);
document.form1.carga.value="";
}

function doc_det(valor){

window.open("../doc_det2.php?referencia="+valor,"","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=620, height=320,left=300 top=250");

}
var temp="";
function entrada(objeto){

//	objeto.style.background='url(../imagenes/sky_blue_sel.png)';
	//objeto.cells[0].childNodes[0].checked=true;
//	temp=objeto;
	if(objeto.style.background=='url(../imagenes/sky_blue_sel.png)'){
	//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='url(../imagenes/sky_blue_sel.png)';
	
	temp.style.background=temp.bgColor;
	//'#E9F3FE';
	temp=objeto;
	}

}
function verOrder(){
	document.getElementById("divOrder").style.visibility="visible";
}
function entradaOrder(objeto){

//	objeto.style.background='url(../imagenes/sky_blue_sel.png)';
	//objeto.cells[0].childNodes[0].checked=true;
//	temp=objeto;
	if(objeto.style.background=='url(../imagenes/sky_blue_sel.png)'){
	objeto.style.background=objeto.bgColor;
	objeto.cells[0].style.color="#FFFFFF";
	}else{
	objeto.style.background='url(../imagenes/sky_blue_sel.png)';
	//alert(objeto.cells[0].innerHTML);
	objeto.cells[0].style.color="#000000";
	//temp2.style.background=temp2.bgColor;
	//'#E9F3FE';
	temp2=objeto;
	}

}

function ordenar(campo,torder){
var codcliente=document.form1.codcliente.value;
cargarDoc(codcliente,campo,torder);
document.getElementById("divOrder").style.visibility="hidden";
}

</script>