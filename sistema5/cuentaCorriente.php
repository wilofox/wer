<?php session_start();
include("conex_inicial.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Caja Recaudacion</title>
<!--
<link rel="stylesheet" type="text/css" href="css/reset.css" media="all" />-->
<link rel="stylesheet" type="text/css" href="css/estilos.css" media="all" />

<script language="javascript" type="text/javascript" src="javascript/jquery-1.3.2.min.js"></script>
<script language="javascript" type="text/javascript" src="javascript/csspopup.js"></script>


<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo15 {font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo25 {font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #FFFFFF; }
.Estilo27 {font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #003366; }
.Estilo28 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 10px;
}
.Estilo30 {font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #990000; }
-->
</style></head>
<script language="javascript" src="miAJAXlib2.js"></script>
    <script src="jquery-1.2.6.js"></script>
    <script src="jquery.hotkeys.js"></script>
<script>

jQuery(document).bind('keydown', 'f5',function (evt){jQuery('#_up').addClass('dirty');
//	alert('f5');
	var tecla=window.event.keyCode;
  if (tecla==116) {//alert("F5 deshabilitado!")
  event.keyCode=0;
event.returnValue=false;}
return false; });

jQuery(document).bind('keypress', 'return',function (evt){jQuery('#_return').addClass('dirty'); 
	if(document.getElementById('clientes').style.visibility=='visible'){
		for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
			if(document.getElementById('tblproductos').rows[i].style.background=='#fcf7e4'){
			
		var temp=document.getElementById('tblproductos').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
		elegir(temp);
			}
		}
	}

return false; });

jQuery(document).bind('keydown', 'up',function (evt){jQuery('#_up').addClass('dirty');
 //alert('ee');
	//document.getElementById('TablaDatos').rows[0].style.background='#FFCC00';
	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
//	alert(document.getElementById('tblproductos').rows.length);
		if(document.getElementById('tblproductos').rows[i].style.background=='#fcf7e4' && (i!=0) ){
		document.getElementById('tblproductos').rows[i].style.background='#FFD3B7';
		document.getElementById('tblproductos').rows[i-1].style.background='#FCF7E4';
		break;
		}
	}
 return false; });

jQuery(document).bind('keydown', 'down',function (evt){jQuery('#_down').addClass('dirty');

	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
	//	alert(document.getElementById('tblproductos').rows.length);
		if(document.getElementById('tblproductos').rows[i].style.background=='#fcf7e4' && (i!=document.getElementById('tblproductos').rows.length-1)){
		//alert(document.getElementById('TablaDatos').rows[i].style.background);
		document.getElementById('tblproductos').rows[i].style.background='#FFD3B7';
		document.getElementById('tblproductos').rows[i+1].style.background='#FCF7E4';
		break;
		}
		}
 return false; });


jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_esc').addClass('dirty'); 

	if(document.getElementById('nuevo_cliente').style.visibility=='hidden'){
	document.getElementById('clientes').style.visibility='hidden';
	document.getElementById('condicion').style.visibility='visible';
	document.getElementById('tpago').style.visibility='visible';
	document.form1.cliente.focus();
	//alert("escape");
	}
	if(document.getElementById('nuevo_cliente').style.visibility=='visible'){
	document.getElementById('nuevo_cliente').style.visibility='hidden'
	}
	
return false; });

 jQuery(document).bind('keydown', 'f8',function (evt){jQuery('#_f8').addClass('dirty');
 
	 doAjax('lista_clientes.php','','listaprod','get','0','1','','');
	 document.getElementById('condicion').style.visibility='hidden';
	 document.getElementById('tpago').style.visibility='hidden';
	// document.formulario.pro.value=0;
//	 document.getElementById('productos').style.visibility='visible';
		 return false; }); 

jQuery(document).bind('keydown', 'f7',function (evt){jQuery('#_f7').addClass('dirty');
	 var codigo='<?php echo $_SESSION['registro']?>';
	 var ruc=document.form1.ruc3.value;
	 var cliente=document.form1.cliente.value;
	 var serie=document.form1.serie.value;
	 var numero=document.form1.numero.value;
	 var condicion=document.form1.condicion.value;
	 var fecha=document.form1.fecha.value;
	 var tc=document.form1.tc.value;
	 var importe=document.form1.importe2.value;
	 var operacion=document.form1.op.value;
	 var vuelto=document.form1.vuelto.value;
	 var moneda_v=document.form1.vueltoen.value;
	 var direccion=document.form1.direc.value;
	 var mesa=document.form1.mesa.value;
	 var idsesion='<?php echo session_id() ?>';
	// alert('imprimiendo codigo ' +codigo );
	window.open('imprimir_doc.php?ruc='+ruc+'&cliente='+cliente+'&serie='+serie+'&numero='+numero+'&condicion='+condicion+'&fecha='+fecha+'&tc='+tc+'&importe='+importe+'&operacion='+operacion+'&idsesion='+idsesion+'&vuelto='+vuelto+'&moneda_v='+moneda_v+'&direccion='+direccion+'&mesa='+mesa,'','width=1,height=1,top=0,left=0,scroolbars=no,directories=no,location=no,menubar =no,titlebar=no,toolbar=no');
	
	 return false; }); 
	 
function datosTextos() { 
var textos = 'CONTENIDO_TABLA'; 
for (var i=0;i<document.getElementById('TablaDatos').rows.length;i++) { 
	
	textos = textos + document.getElementById('TablaDatos').rows[i].cells[0].innerHTML;
	/*
	for (var j=0;j<4;j++) { 
	textos = textos + document.getElementById('TablaDatos').rows[i].cells[j].innerHTML;
	} 
	*/
} 
alert(textos);
}

</script>

<script>

function enfocar(){
//alert("entro");
//document.form1.ruc3.focus();
//window.opener.recargar();
//window.opener.refresh();
//window.opener.document.forms['formulario'].reset();
}

function lista_pago(texto){
var r = texto;
document.getElementById('pagos_d').innerHTML=r;
document.getElementById('pagos_d').style.visibility='visible';

document.form1.soles.value=0;
document.form1.soles.disabled=false;
document.form1.dolares.value=0;
document.form1.dolares.disabled=false;
document.form1.numero_tarjeta.value="";
//document.form1.tpago.focus();
var referencia=document.form1.referencia.value;

doAjax('calcular2.php','accion=acuenta&referencia='+referencia,'calcular_acuenta','get','0','1','','');

doAjax('calcular2.php','accion=vuelto&importe='+document.form1.importe.value+'&referencia='+referencia,'calcular_vuelto','get','0','1','','');
}

function calcular_acuenta(texto){
var r = texto;
document.form1.acuenta.value=r;
}

function calcular_vuelto(texto){
var r = texto;
var pos=texto.substring(1,texto.length);
//alert(r);
	if(r<0){
	document.form1.vuelto.value=0;
	
	document.form1.pendiente_s.value=pos;
	document.form1.pendiente_d.value=Math.round((pos/document.form1.tc.value)*100)/100 ;	
	}else{
	/*
		if(document.form1.vueltoen.value=='S'){
		document.form1.vuelto.value=r;	
		}else{
		document.form1.vuelto.value=Math.round((r/document.form1.tc.value)*100)/100 ;
		}*/
	if(r==0){
	document.form1.pendiente_s.value=0;	
	document.form1.pendiente_d.value=0;	
	}else{
	document.form1.pendiente_s.value='-'+r;	
	document.form1.pendiente_d.value='-'+Math.round((r/document.form1.tc.value)*100)/100;	
	}
	
	}
	
}

function gen_numero(texto){

var cadena=texto.split('-');
document.form1.numero.value=cadena[0];
document.form1.serie.value=cadena[1];
}

function listaprod(texto){

//alert(texto);
var r = texto;
document.getElementById('clientes').innerHTML=r;
document.getElementById('clientes').style.visibility='visible';
//alert('entro');
document.form1.txtnombre.focus();
}

function nuevo_cliente(texto){

//alert(texto);
var r = texto;
document.getElementById('nuevo_cliente').innerHTML=r;
document.getElementById('nuevo_cliente').style.visibility='visible';
//alert('entro');
document.form1.crazonsocial.focus();
}


function validartecla(e){
//alert(e.keyCode);
if (((e.keyCode>=97) && (e.keyCode<=105)) || ((e.keyCode>=65) && (e.keyCode<=90)) || e.keyCode==8 || e.keyCode==32 ) {
doAjax('detalle_clie.php','&nomb_det='+document.form1.txtnombre.value,'detalle_prod','get','0','1','',''); //alert('entro');
//alert('entro');
}
}

function detalle_prod(texto){
var r = texto;
document.getElementById('detalle').innerHTML=r;
document.getElementById('tblproductos').rows[0].style.background='#fcf7e4';

//document.getElementById('productos').style.visibility='visible';
//alert('entro');
//document.formulario.txtnombre.focus();
}

function guardar_clie(texto){
document.getElementById('nuevo_cliente').style.visibility='hidden';
document.getElementById('clientes').style.visibility='hidden';

var cadena=texto.split("?");
document.form1.ruc3.value=cadena[0];
document.form1.cliente.value=cadena[1];
document.form1.direc.value=cadena[2];
document.getElementById('tpago').style.visibility='visible';
document.getElementById('condicion').style.visibility='visible';
document.form1.condicion.focus();


document.getElementById('boleta').style.display="none";
document.getElementById('factura').style.display="block";
doAjax('generarnumero.php','operacion=TF&servicio='+document.form1.servicio.value,'gen_numero','get','0','1','','');
document.form1.op.value='TF';
//alert(texto);
}

function b_cuenta(texto){

	var cadena=texto.split("?");
	
	//alert(cadena);
if(cadena[6]!='A'){
	//alert(texto);
	document.form1.ruc3.value=cadena[0];
	document.form1.cliente.value=cadena[1];
	document.form1.importe.value=cadena[2];
	document.form1.tc.value=cadena[3];
	document.form1.fecha.value=cadena[4];
	document.form1.referencia.value=cadena[5];
	document.form1.total_s.value=cadena[2];
	
	document.form1.total_d.value=Math.round((cadena[2]/cadena[3])*100)/100 ;

doAjax('lista_pago_cuenta.php','referencia='+cadena[5],'lista_pago','get','0','1','','');

}else{
alert('Este Documento se encuentra Anulado');
location.href="cuentaCorriente";
}

}

</script>

<?php 

  if(isset($_REQUEST['accion'])){
  
  $motivo=$_REQUEST['motivo'];
  $numero=$_REQUEST['numero'];
  $serie=$_REQUEST['serie'];
  $doc=$_REQUEST['doc'];
  
  $strSQl="update cab_mov set flag='A',motivo='$motivo' where Num_doc='$numero' and serie='$serie' and cod_ope='$doc' ";
    mysql_query($strSQl,$cn);
	$codigo=$_REQUEST['referencia'];
	
//---------------------------------------------------------------------------------------------

$strSQL_cab="select * from cab_mov where cod_cab='$codigo'";	
$resultado_cab=mysql_query($strSQL_cab,$cn);
$row_cab=mysql_fetch_array($resultado_cab);
$campo="saldo".$row_cab['tienda'];

//-------------------------------------actualziar stocks----------------------------------------
	 	$strSQL3="select cod_prod,cantidad from det_mov where cod_cab='$codigo'";
		 $resultado3=mysql_query($strSQL3,$cn);
		 while($row3=mysql_fetch_array($resultado3)){
			$cantidad=$row3['cantidad'];
			$cod_pro=$row3['cod_prod'];		 
		 			
			$strSQL4="update producto set $campo=$campo+$cantidad where idproducto='$cod_pro'";
		 
		 	mysql_query($strSQL4,$cn);
		
		 }
//-------------------------------------------------------------------------------------------------		 
		 
	// echo "prueba".$_REQUEST['referencia'];
  }
    
    
?>

<script>

function terminar(){
window.close();
}

function cerrar(){
window.parent.opener.formulario.ruc2.value="0";
}
</script>
<body  onLoad="enfocar();" onBlur="cambiar()">


  <div id="capaPopUp" style="z-index:1;filter:alpha(opacity=40);-moz-opacity:.60;opacity:.60"></div>
    <div id="popUpDiv">
       <div id="capaContent">
           <table>
  <tr>
    <td colspan="3" style="font:Arial, Helvetica, sans-serif; color:#CC6600; font-size:12px"><strong>ELIMINACION DE DOCUMENTO</strong></td>

  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#003366">  <strong>Ingrese El Motivo por el cual Desea Anular este Documento</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center">
	
	<select name="motivo">
	<option value="001">Error de Digitación</option>
	<option value="002">Falla de Impresión</option>
	<option value="003">Reclamo de cliente</option>
	
	</select>
	
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><a href="javascript:void(0);" title="Cerrar" id="anular">Aceptar</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" title="Cerrar" id="cerrar">Cancelar</a></td>
    <td>&nbsp;</td>
  </tr>
</table> 

      </div>

    </div>

 <div id="wrapper">

<table width="733" height="425" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="277" colspan="5" valign="top">
	
	<form id="form1" name="form1" method="post" action="" >
      <table width="579" height="415" border="0" cellpadding="0" cellspacing="0">
        <tr bgcolor="#6699CC">
          <td height="19" colspan="7" bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
        <tr bgcolor="#6699CC">
          <td rowspan="2" bgcolor="#FFFFFF">&nbsp;</td>
          <td height="67" rowspan="2" bgcolor="#004993">&nbsp;</td>
          <td height="30" bgcolor="#004993"><span class="Estilo25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Documento</span></td>
          <td valign="middle" bgcolor="#004993">
           
		    <select name="doc" style="font:Verdana, Arial, Helvetica, sans-serif; font-size:10px">
              <option value="TB">Ticket Boleta</option>
              <option value="TF">Ticket Factura</option>
			  <option value="BV">Boleta de Venta</option>
			  <option value="FA">Factura de Venta</option>
			</select>
		    <input name="referencia" type="text" size="5" maxlength="5" ></td>
          <td bgcolor="#004993">&nbsp;</td>
          <td width="110" align="left" bgcolor="#004993"><label for="label"></label></td>
          <td width="31" rowspan="2" align="left" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr bgcolor="#6699CC">
          <td bgcolor="#004993"><span class="Estilo25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Numero</span></td>
          <td bgcolor="#004993"><input name="mesa" type="hidden" id="mesa" size="10" maxlength="10" value="<?php echo $_REQUEST['mesa']?>">
            <input name="registro" type="hidden" size="10" maxlength="10" value="<?php echo $_REQUEST['registro']?>">
            <input name="servicio" type="hidden" size="5" maxlength="5" value="<?php echo $servicio?>">
            <input name="serie"  type="text" id="serie" size="5" maxlength="11" value="" onKeyUp="enfocar_numero(event)" onBlur="ceros_serie()"/>
			
			
			<script>
			function enfocar_numero(e){
			
			if(e.keyCode==13){
			ceros_serie();
			document.form1.numero.select();
			}
			
			}
			
			</script>
            <input name="numero" type="text" id="numero" size="10" maxlength="11" onKeyPress="cargar_cuenta(event)" value=""/></td>
          <td bgcolor="#004993"><span class="Estilo25">Importe(S/.)</span></td>
          <td width="110" align="left" bgcolor="#004993"><input  style="text-align:right; font:bold" readonly="readonly"  name="importe" type="text" id="importe" size="10" value="<?php echo number_format($total,2);?>" />
            <input  name="importe2" type="hidden" id="importe2" size="10" value="<?php echo number_format($total,2);?>" /></td>
        </tr>
        <tr>
          <td width="23">&nbsp;</td>
          <td width="15" height="43">&nbsp;</td>
          <td width="104"><span class="Estilo15">Ruc:</span></td>
          <td width="195"><label for="textfield"></label>
     <!--       <input readonly="readonly" name="ruc3" type="text" id="ruc3" size="10" maxlength="11" onChange="cambiardoc2()" onKeyPress="cambiardoc();" onBlur="cambiardoc3()"  onFocus="cambiardoc4()"/>-->
	 <input readonly="readonly" name="ruc3" type="text" id="ruc3" size="10" maxlength="11" />
	 
            <input  name="direc" type="hidden" id="direc" size="10" value="" /></td>
          <td width="101">&nbsp;</td>
          <td colspan="2" valign="bottom">            </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><span class="Estilo15">Cliente</span></td>
          <td><input name="cliente" readonly="readonly"  type="text" id="cliente" size="20" maxlength="50" value="varios" /></td>
          <td><span class="Estilo15">Total (S/.) </span></td>
          <td colspan="2"><input  style="text-align:right" name="total_s" type="text" size="10" readonly="readonly" value="<?php 
		  echo number_format($total,2);

		  
		  ?>" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><span class="Estilo15">Total (US$) </span></td>
          <td colspan="2"><input style="text-align:right" name="total_d" type="text" size="10" readonly="readonly" value="<?php echo number_format($total/$tc,2); ?>" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="27">&nbsp;</td>
          <td><span class="Estilo15">Condici&oacute;n</span></td>
          <td colspan="4"><label for="select"></label>
            <select  disabled="disabled" name="condicion" id="condicion">
              <option value="0">Contado</option>
              <option value="1">Credito</option>
            </select>            <span class="Estilo15">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha
            &nbsp;
            &nbsp;
            <input readonly="readonly" name="fecha" type="text" id="fecha" size="10" maxlength="10" value="<?php echo $fecha?>" />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T.C.
            <input readonly="readonly" name="tc"  style="color:#990000; font:bold ; text-align:right"type="text" id="tc" size="5" maxlength="6" value="<?php echo $tc?>" />
            </span></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><span class="Estilo15">&nbsp;&nbsp;</span></td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        
        <tr>
          <td height="17" colspan="7" align="center"><table id="tabla_pago" style="display:none" width="465" border="1" cellpadding="0" cellspacing="0">
            <tr bgcolor="#004993">
              <td align="left" bgcolor="#D8D8D8"><table width="433" height="51" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="128"><span class="Estilo27">T. Pago </span></td>
                  <td width="95"><span class="Estilo27">Numero</span></td>
                  <td width="94"><span class="Estilo27">Soles</span></td>
                  <td width="116"><span class="Estilo27">Dolares</span></td>
                </tr>
                <tr>
                  <td height="35"><select disabled="disabled" name="tpago" onChange="colocar();">
                      <option value="1">Efectivo</option>
                      <option value="2">Visa</option>
                      <option value="3">Visa Electron</option>
		              <option value="4">Mastercard</option>
		              <option value="5">American Express</option>
					  <option value="6">Ripley</option>
                    </select>                  </td>
                  <td><input disabled="disabled" name="numero_tarjeta" type="text" size="10" maxlength="15" ></td>
    <td><input disabled="disabled" name="soles" type="text" size="10" maxlength="15" value="0" onKeyPress="c_soles(event)"></td>
                  <td><input disabled="disabled" name="dolares" type="text" size="10" maxlength="15" value="0" onKeyPress="c_dolares(event)" ></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td height="19" colspan="7"><div id="pagos_d"></div></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="28">&nbsp;</td>
          <td>&nbsp;</td>
          <td align="right">&nbsp;</td>
          <td colspan="3" align="left"><span class="Estilo27">A cuenta</span>
            <input style="text-align:right; font:bold" name="acuenta" type="text" size="7" readonly="readonly"></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="right">&nbsp;</td>
          <td colspan="3" align="left"><span class="Estilo27">&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <input style="text-align:right; font:bold" name="vuelto" type="hidden" size="7" readonly="readonly"></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><span class="Estilo30">Saldo(S/.)</span></td>
          <td><span class="Estilo30">Saldo(US$)</span></td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><input readonly="readonly" style="text-align:right; font:bold" name="pendiente_s" type="text" size="10"></td>
          <td><input readonly="readonly" style="text-align:right; font:bold" name="pendiente_d" type="text" size="10"></td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
      </table>
	  <div id="clientes" style="position:absolute; left:130px; top:114px; width:300px; height:180px; z-index:1; visibility:hidden; z-index:1"> </div>
	  
	    <div id="nuevo_cliente" style="position:absolute; left:110px; top:110px; width:400px; height:280px; z-index:1; visibility:hidden; z-index:1"> </div>
		
		    <div id="motivo" style="position:absolute; left:110px; top:110px; width:400px; height:280px; z-index:1; visibility:hidden; z-index:1"> </div>
		
      </form>    </td>
    <td width="131" valign="top"><table width="120" height="151" border="0" cellpadding="0" cellspacing="0"  style="vertical-align:top">
      <tr valign="top">
        <td height="34" align="center" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top"><a style="cursor:pointer" id="abrirPop" href="javascript:void(0);"><img src="imgenes/anular.gif" width="50" height="51" border="0"></a><br>
          <span class="Estilo28">ANULAR DOCUMENTO </span></td>
      </tr>
      <tr>
        <td align="center" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top"><a onClick="editar_tpago()" style="cursor:pointer"><img src="imgenes/editar_tpago.gif" width="50" height="44"></a><br>
          <span class="Estilo28">MODIFICAR  DOCUMENTO </span></td>
      </tr>
      <tr>
        <td align="center" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top"><a onClick="guardar_tpago()" style="cursor:pointer"><img src="imgenes/revert.png" width="35" height="35"></a></td>
      </tr>
      <tr>
        <td align="center" valign="top"><span class="Estilo28">GUARDAR<BR></span></td>
      </tr>
    </table></td>
  </tr>
</table>


</div>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-3621330-3");
pageTracker._trackPageview();
} catch(err) {}</script>

</body>
</html>
 
<script>

function ceros_serie(){
document.form1.serie.value=ponerCeros(document.form1.serie.value,3);
}


function ponerCeros(obj,i) {
  while (obj.length<i){
    obj = '0'+obj;
	}
//	alert(obj);
	return obj;
}


function cargar_cuenta(e){
var num=document.form1.numero.value;
var serie=document.form1.serie.value;
var doc=document.form1.doc.value;

	if(e.keyCode == 13){
	var numero=ponerCeros(num,7);
	document.form1.numero.value=numero;
doAjax('b_cuenta.php','serie='+serie+'&numero='+numero+'&doc='+doc,'b_cuenta','get','0','1','','');
	}
	
	
}

function colocar(){
	if(document.form1.tpago.value!=1){
		document.form1.soles.value=document.form1.importe2.value;
	}
}

function c_soles(e){
document.form1.dolares.disabled=true;

	if(e.keyCode == 13){
	var tpago=document.form1.tpago.value;
	var numero=document.form1.numero_tarjeta.value;
	var soles=document.form1.soles.value;
	var dolares=document.form1.dolares.value;
	var referencia=document.form1.referencia.value;
//	var moneda_v=document.form1.vueltoen.value;
	//alert('pagos_det.php?tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares);
doAjax('lista_pago_cuenta.php','referencia='+referencia+'&tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares+'&accion=insertar','lista_pago','get','0','1','','');

	}

}

function c_dolares(e){
document.form1.soles.disabled=true;

	if(e.keyCode == 13){
	var tpago=document.form1.tpago.value;
	var numero=document.form1.numero_tarjeta.value;
	var soles=document.form1.soles.value;
	var dolares=document.form1.dolares.value;
	var referencia=document.form1.referencia.value;
//	var moneda_v=document.form1.vueltoen.value;
	//alert('pagos_det.php?tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares);
doAjax('lista_pago_cuenta.php','referencia='+referencia+'&tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares+'&accion=insertar','lista_pago','get','0','1','','');
	}

}



function cambiar(){
//window.parent.opener.formulario.ruc2.value="0";
}


function cambiardoc(){
document.getElementById('boleta').style.display="none";
document.getElementById('factura').style.display="block";
doAjax('generarnumero.php','operacion=TF&servicio='+document.form1.servicio.value,'gen_numero','get','0','1','','');
document.form1.op.value='TF';
}

function cambiardoc2(){
	
//	alert("entro");
	
	if(document.form1.ruc3.value=="" && document.getElementById('factura').style.display=="block"){
	document.getElementById('factura').style.display="none";
	document.getElementById('boleta').style.display="block";
	doAjax('generarnumero.php','operacion=TB&servicio='+document.form1.servicio.value,'gen_numero','get','0','1','','');
	document.form1.op.value='TB';
	}


}


function cambiardoc3(){


	if(document.form1.ruc3.value=="" && document.getElementById('factura').style.display=="block"){
	document.getElementById('factura').style.display="none";
	document.getElementById('boleta').style.display="block";
	doAjax('generarnumero.php','operacion=TB&servicio='+document.form1.servicio.value,'gen_numero','get','0','1','','');
	document.form1.op.value='TB';
	}

}

function cambiardoc4(){
doAjax('generarnumero.php','operacion=TB&servicio='+document.form1.servicio.value,'gen_numero','get','0','1','','');
document.form1.op.value='TB';
}


function elegir(cod,razon,direccion,ruc){
document.form1.cliente.value=razon;
document.form1.ruc3.value=ruc;
document.form1.direc.value=direccion;

document.getElementById('clientes').style.visibility='hidden';
//document.form1.ter.value=0;
document.getElementById('condicion').style.visibility='visible';
document.getElementById('tpago').style.visibility='visible';
document.form1.condicion.focus();
if(ruc!=""){
cambiardoc();
}
}

function anular_doc(){
doAjax('motivo.php','','motivo','get','0','1','','');
}


function motivo(texto){
document.getElementById('motivo').innerHTML=texto;
document.getElementById('motivo').style.visibility='visible';

}

function editar_tpago(){
document.getElementById('tabla_pago').style.display='block';
document.form1.tpago.disabled=false;
document.form1.numero_tarjeta.disabled=false;
document.form1.soles.disabled=false;
document.form1.dolares.disabled=false;
}

function eliminar_pago(codigo){

	var referencia=document.form1.referencia.value;
	var respuesta=confirm("confirma que desea eliminar este dato?")
	if(respuesta)
	{
	doAjax('lista_pago_cuenta.php','accion=eliminar&cod_pago='+codigo+'&referencia='+referencia,'lista_pago','get','0','1','','');
//	alert("eliminando Codigo numero: "+codigo);
	}
	else
	{
		//alert("no se pudo eliminar..");
	}
	}


function guardar_tpago(){
	if(document.form1.pendiente_s.value==0){
	location.href="cuentaCorriente.php";
	}else{
	alert("El documento tiene un saldo pendiente");
	}
}


</script>