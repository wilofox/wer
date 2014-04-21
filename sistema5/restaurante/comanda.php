<?php session_start();
include('conex_inicial.php');
 $_SESSION['registro']=rand(100000,999999);
// echo $_SESSION['registro'];
?>
<?php 



	if($_REQUEST['ac']=='g'){
	
	$codi=$_REQUEST['codigo'];
	$mesa=$_REQUEST['mesa'];
	
	$strSQL="update comanda set estado='g' where cod_cab='$codi'";
	$strSQL2="update mesa set estado='O' where id='$mesa'";
	//echo $strSQL2;
	mysql_query($strSQL);
	mysql_query($strSQL2);
	header("location: comanda.php");
	}

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--



.Estilo1 {
	color: #990000;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
}
.Estilo14 { font:Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color:#333333}
.Estilo15 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #990000;
}
.Estilo34 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #990000; }
.Estilo35 {color: #990000}
.Estilo40 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	color: #990000;
	font-weight: bold;
}
.Estilo31 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color:#FFFFFF; }

-->
</style>
</head>
<script language="javascript" src="../miAJAXlib.js"></script>
<!--<script language="javascript" src="jquery[1].hotkeys-0.7.7-packed.js"></script>-->

    <script src="../jquery-1.2.6.js"></script>
	
    <script src="../jquery.hotkeys.js"></script>
	<script src="../mootools-comprimido-1.11.js"></script>
	<!--
	<script src="../jquery.alerts.js" type="text/javascript"></script>
	<link href="../jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />
	-->
<?php 
$fecha=date("d-m-Y");

?>
<script>


var add_mesa="<?php echo $_REQUEST['add_mesa']?>";



jQuery(document).bind('keydown', 'f5',function (evt){jQuery('#_up').addClass('dirty');
//	alert('f5');
	var tecla=window.event.keyCode;
  if (tecla==116) {//alert("F5 deshabilitado!")
  event.keyCode=0;
event.returnValue=false;}
return false; });

jQuery(document).bind('keydown', 'up',function (evt){jQuery('#_up').addClass('dirty');
 //alert('ee');
	//document.getElementById('TablaDatos').rows[0].style.background='#FFCC00';
	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
//	alert(document.getElementById('tblproductos').rows.length);
		if(document.getElementById('tblproductos').rows[i].style.background=='#fcf7e4' && (i!=0) ){
		document.getElementById('tblproductos').rows[i].style.background='#FFD3B7';
		document.getElementById('tblproductos').rows[i-1].style.background='#FCF7E4';
		
		if(i%4==0 && i!=0){
		capa_desplazar = $('detalle');
		capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y - 50);
		}
		break;
		}
	}
 return false; });




   jQuery('#platform-details').html('<code>' + navigator.userAgent + '</code>');
function domo(){


jQuery(document).bind('keydown', 'down',function (evt){jQuery('#_down').addClass('dirty');
 
// alert('entro');
//if(document.getElementById('productos').style.visibility=='visible'){

	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
		
	//	alert(document.getElementById('tblproductos').rows.length);
		if(document.getElementById('tblproductos').rows[i].style.background=='#fcf7e4' && (i!=document.getElementById('tblproductos').rows.length-1)){
		//alert(document.getElementById('TablaDatos').rows[i].style.background);
		document.getElementById('tblproductos').rows[i].style.background='#FFD3B7';
		document.getElementById('tblproductos').rows[i+1].style.background='#FCF7E4';
		
		if(i%4==0 && i!=0){
		capa_desplazar = $('detalle');
		capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y + 50);
		}
		
		break;
			
		}
		
	}
	
//}	
 return false; });


jQuery(document).bind('keydown', 'return',function (evt){jQuery('#_return').addClass('dirty'); 

	if(document.getElementById('productos').style.visibility=='visible'){
		for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
			if(document.getElementById('tblproductos').rows[i].style.background=='#fcf7e4'){
			
		var temp=document.getElementById('tblproductos').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
		elegir(temp);
			}
		}
	}

if(document.formulario.suc.value==1){
document.formulario.almacen.focus();
document.formulario.alm.value=1;
document.formulario.suc.value=0;
}else{

	if(document.formulario.alm.value==1){
	document.formulario.responsable.focus();
	document.formulario.res.value=1;
	document.formulario.alm.value=0;
	}else{
		if(document.formulario.res.value==1){
		document.formulario.mesa.focus();
		document.formulario.me.value=1;
		document.formulario.res.value=0;
		}else{
			if(document.formulario.me.value==1){
			document.formulario.codprod.focus();
			document.formulario.pro.value=1;
			document.formulario.me.value=0;
			}else{
				if(document.formulario.pro.value==1){
				document.formulario.termino.focus();
				document.formulario.termino.select();
				document.formulario.ter.value=1;
				document.formulario.pro.value=0;
				}else{
					if(document.formulario.ter.value==1){
					document.formulario.cantidad.focus();
					document.formulario.ter.value=0;			
					}else{
					
						if(document.formulario.cantidad.value!="")
						{
						enviar(event);
						}
					
	}}}}}}

return false; });

jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_esc').addClass('dirty'); 

	if(document.getElementById('productos').style.visibility=='visible'){
	document.getElementById('productos').style.visibility='hidden';
	document.formulario.codprod.focus();
	}

	if(document.getElementById('mesas').style.visibility=='visible'){
	document.getElementById('mesas').style.visibility='hidden';
	document.formulario.mesa.focus();
	document.formulario.me.value=1;
	}

//alert("escape");
return false; });

	jQuery(document).bind('keydown', 'f2',function (evt){jQuery('#_f2').addClass('dirty');
	var codigo='<?php echo $_SESSION['registro']?>';
	// alert('imprimiendo codigo ' +codigo );
//	window.open('prueba2.php?sucu='+document.formulario.sucursal.value+'&tien='+document.formulario.almacen.value,'','width=1,height=1,top=0,left=0,scroolbars=no,directories=no,location=no,menubar =no,titlebar=no,toolbar=no');
//document.formulario.submit();
location.href="comanda.php?codigo="+codigo+"&ac=g&mesa="+document.formulario.mesa.value;
	 return false; }); 
	
	 jQuery(document).bind('keydown', 'f8',function (evt){jQuery('#_f8').addClass('dirty');
	
    if(document.formulario.pro.value==1){
	 doAjax('lista_productos.php','','listaprod','get','0','1','','');
	 document.formulario.pro.value=0;
	 }
	 
	 if(document.formulario.me.value==1){
	 doAjax('mesas_estado.php','','mesas_estado','get','0','1','','');
	 document.formulario.me.value=0;
	 
	 }
	 
//	 document.getElementById('productos').style.visibility='visible';
		 return false; }); 
}
//function ver(){alert("tecla f7");}
jQuery(document).ready(domo);


function iniciar(){

doAjax('../carga_cbo_tienda.php','','cargar_cbo','get','0','1','','');
if(add_mesa==""){
document.formulario.sucursal.focus();
document.formulario.precio.disabled=true;
document.formulario.suc.value=1;
}

}

function mostrar(texto) {
var r = texto;
//alert(r);
//alert('La hora del servidor es: '+horaservidor);
//document.getElementById('cabecera').style.display="none";
document.getElementById('resultado').innerHTML=r;
document.getElementById('resultado').style.display="block";
document.formulario.precio2.value='<?php echo $_SESSION['registro']?>';
document.formulario.codprod.value="";
document.formulario.cantidad.value="";
document.formulario.precio.value="";
document.formulario.termino.value="";
document.formulario.mesa.disabled=true;
document.formulario.codprod.focus();
document.formulario.pro.value=1;

}

function mostrar_precio(texto){
//alert(texto);
var temp=texto.split('?');
document.formulario.precio.value=temp[1];
}

function listaprod(texto){
//alert(texto);
var r = texto;
document.getElementById('productos').innerHTML=r;
document.getElementById('productos').style.visibility='visible';
//alert('entro');
document.formulario.txtnombre.focus();
}

function mesas_estado(texto){
var r = texto;
document.getElementById('mesas').innerHTML=r;
document.getElementById('mesas').style.visibility='visible';


}


function detalle_prod(texto){
var r = texto;
document.getElementById('detalle').innerHTML=r;
document.getElementById('tblproductos').rows[0].style.background='#fcf7e4';

//document.getElementById('productos').style.visibility='visible';
//alert('entro');
//document.formulario.txtnombre.focus();
}

function recargar(){
document.formulario.submit();
}

function recargar2(){
//alert('pedido');
}



function cargar_cbo(texto){
//alert(texto);
var r = texto;
document.getElementById('cbo_tienda').innerHTML=r;
}

function estado_mesa(texto){
var r = texto;

	if(r=="O"){
		if(confirm("Esta mesa se encuentra OCUPADA..\r Desea agregarle comandas?"))
		{
		document.formulario.codprod.focus();
		document.formulario.me.value=0;
		}else{
		document.formulario.mesa.focus();
		document.formulario.mesa.select();
		}	
		/*
		jConfirm('Can you confirm this?', 'Confirmation Dialog', function(r) {
   		jAlert('Confirmed: ' + r, 'Confirmation Results');});
		
		*/
	}

}

</script>



<link href="../styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-image: url(../imagenes/bg3.jpg);
}
-->
</style>


<body  onload="iniciar();">
<form id="formulario" name="formulario" method="post" action="">
  <table width="789" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="23">&nbsp;</td>
      <td width="107">&nbsp;</td>
      <td width="33">&nbsp;</td>
      <td width="26">&nbsp;</td>
      <td width="63">&nbsp;</td>
      <td width="109">&nbsp;</td>
      <td width="69">&nbsp;</td>
      <td width="90">&nbsp;</td>
      <td width="158"><label for="Submit"></label></td>
      <td width="111">&nbsp;</td>
    </tr>
    <tr>
      <td height="22">&nbsp;</td>
      <td colspan="2" align="left"><input name="serie" type="hidden" size="3" value="000" />
          <input name="textfield2" type="hidden" size="8"  disabled="disabled" value="0000000"/>
          <span class="Estilo14">Documento</span></td>
      <td>&nbsp;</td>
      <td><span class="Estilo14">Sucursal</span></td>
      <td colspan="3"><span class="Estilo15">
        <select name="sucursal" onChange="doAjax('../carga_cbo_tienda.php','','cargar_cbo','get','0','1','','');" onFocus="gene()" >
          <?php 
		
  $resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn); 
while($row1=mysql_fetch_array($resultados1))
{
		?>
          <option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
          <?php }?>
        </select>
        <input name="suc" type="hidden" size="3" value="0" />
        <input name="ruc2" type="hidden" size="10"/>
</span></td>
      <td><span class="Estilo14">&nbsp;&nbsp;</span></td>
      <td rowspan="8"><table width="100%" height="96%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><img src="../imgenes/revert.png" width="32" height="32"></td>
        </tr>
        <tr>
          <td align="center"><span class="Estilo14">Guardar <span class="Estilo35">[F2]</span></span></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><img src="../imgenes/fileprint.gif" width="32" height="32"></td>
        </tr>
        <tr>
          <td align="center"><span class="Estilo14">Imprimir<span class="Estilo35"> [F7]</span></span></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><img style=" cursor:pointer" onClick="javascript:location.href='comanda.php'" src="../imgenes/cancel.gif" width="28" height="28"></td>
        </tr>
        <tr>
          <td align="center"><span class="Estilo14">Cancelar</span></td>
        </tr>

        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><a href="comanda_mesa.php"><img src="../images/view_choose.gif" width="32" height="32" border="0"></a></td>
        </tr>
        <tr>
          <td align="center"><span class="Estilo14">Ver Mesas </span></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="28">&nbsp;</td>
      <td colspan="2"><span class="Estilo40">COMANDA</span></td>
      <td>&nbsp;</td>
      <td><span class="Estilo14">Tienda</span></td>
      <td><div id="cbo_tienda"> </div>
        <span class="Estilo15">
        <input name="alm" type="hidden" size="3"  value="0"/>
      </span></td>
      <td>&nbsp;</td>
      <td><span class="Estilo14">Responsable</span></td>
      <td><span class="Estilo15">
        <select name="responsable" onFocus="javascript:document.formulario.res.value='1'">
          <option>responsable 1</option>
        </select>
        <input name="res" type="hidden" size="3"  value="0"/>
      </span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2"><div id="boleta" style="display:block"><span class="Estilo1"></span></div>
          <div style="display:none" id="factura"><span class="Estilo1">FACTURA </span></div></td>
      <td>&nbsp;</td>
      <td><span class="Estilo14">Fecha</span></td>
      <td><span class="Estilo15"><input type="text"  style="color:#990000; font:bold" value="<?php echo $fecha?>" size="10" maxlength="15" disabled="disabled">
      </span></td>
      <td>&nbsp;</td>
      <td><span class="Estilo34">MESA N&ordm;</span></td>
      <td><input style="font:bold; background-color: #FEF4E0" name="mesa" type="text" size="8" maxlength="5" onBlur="verificar_mesa()" onFocus="activar3()" value="">
      <input name="me" type="hidden" size="5" maxlength="5"></td>
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
    </tr>
    <tr>
      <td height="28">&nbsp;</td>
      <td colspan="8" valign="top"><table width="641" height="39" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
        <tr>
          <td width="15" align="right">&nbsp;</td>
          <td width="620" align="right"><table width="612" height="25" border="0" align="left" cellpadding="0" cellspacing="0">
            <tr>
              <td width="175"><table width="172" border="0" cellpadding="0" cellspacing="0" id="pro" >
                  <tr>
                    <td width="172"><span class="Estilo14">Producto:</span>
                        <input autocomplete='off'  name="codprod"  type="text" size="8"  onfocus="activar2();" onBlur="desactivar2()"/>
                        <span class="Estilo15">
                        <input type="button" name="f8" value="f8">
                        <input name="pro" type="hidden" size="3"  value="0"/>
                      </span></td>
                  </tr>
              </table></td>
              <td width="199"><span class="Estilo14">Termino</span><span class="Estilo14">:
                <input name="termino" type="text" size="15" onFocus="activar();" onBlur="javascript:imprimiendo();"/>
                    <span class="Estilo15">
                    <input name="ter" type="hidden" size="3"  value="0"/>
                  </span></span><span class="Estilo14"> </span></td>
              <td width="139"><span class="Estilo14">Cantidad:
                <input name="cantidad"  type="text" size="5" onKeyUp="" />
              </span></td>
              <td width="153"><span class="Estilo14">&nbsp;Precio:
                <input name="precio" type="text" size="10" />
                    <input name="precio2" type="hidden" size="3"/>
              </span></td>
            </tr>
          </table></td>
        </tr>
      </table>
      <span class="Estilo14">&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
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
    </tr>
    <tr>
      <td height="43">&nbsp;</td>
      <td colspan="8">
	  <div id="resultado"></div>	  </td>
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
      <td align="center">&nbsp;</td>
    </tr>
  </table>
  
  <div id="productos" style="position:absolute; left:98px; top:150px; width:300px; height:180px; z-index:1; visibility:hidden"> </div>

  <div id="mesas" style="position:absolute; left:420px; top:114px; width:260px; height:180px; z-index:1; visibility:hidden"> </div>


</form>
</body>

<script>

function verificar_mesa(){
	if(document.getElementById('mesas').style.visibility!='visible'){
	doAjax('verificar_mesa.php','&mesa='+document.formulario.mesa.value,'estado_mesa','get','0','1','','');
	}

}

function gene(){
document.formulario.suc.value='1';
doAjax('../carga_cbo_tienda.php','','cargar_cbo','get','0','1','','');
}

function activar(){
document.formulario.ter.value=1;
}

function activar2(){
//document.getElementById(valor).value=1;
document.formulario.pro.value=1;
document.formulario.me.value=0;
}


function activar3(){
//document.getElementById(valor).value=1;
document.formulario.me.value=1;

document.formulario.alm.value=0;
document.formulario.res.value=0;
document.formulario.suc.value=0;

}

function desactivar2(){
document.formulario.pro.value=0;
}

function imprimiendo(){
	if(document.formulario.ruc2.value=="1"){
	
window.open('empresa.php','vent','width=585,height=480,top=180,left=200,status=yes,scrollbars=yes');
//	showModelessDialog('empresa.php','vent','width=585,height=480,top=180,left=200,status=yes,scrollbars=yes');
	/*
		window.open('empresa.php','','width=560,height=400,top=250,left=150,scroolbars=no,directories=no,location=no,menubar =no,titlebar=no,toolbar=no');
	//window.opener.document.form1.ruc.focus();
	*/
	}
	
}

function cambiardoc(){
document.getElementById('boleta').style.display="none";
document.getElementById('factura').style.display="block";
}

function cambiardoc2(){
	
//	alert("entro");
	
	if(document.formulario.ruc.value=="" && document.getElementById('factura').style.display=="block"){
	document.getElementById('factura').style.display="none";
	document.getElementById('boleta').style.display="block";
	
	}


}

function enviar(e){
	if(e.keyCode == 13){
	doAjax('pedido_det.php','&mesa='+document.formulario.mesa.value,'mostrar','get','0','1','','');
	//alert('entro');
	}
}

function pintar(enl){
alert(enl);
//document.getElementById('pro').style.borderColor='#FF0000';
//document.formulario.codprod.style.background = "#FFDDCC";
//document.formulario.codprod.style. = "#FFDDCC";
}


function cerrar_div(){
document.getElementById('productos').style.visibility='hidden';
}

function elegir(cod){
document.formulario.codprod.value=cod;
document.getElementById('productos').style.visibility='hidden';
document.formulario.ter.value=0;
document.formulario.termino.focus();
//alert('entro');
//document.formulario.ter.value=1;
doAjax('../calcular_precio.php','','mostrar_precio','get','0','1','','');
}

function validartecla(e){
//alert(e.keyCode);
if (((e.keyCode>=97) && (e.keyCode<=105)) || ((e.keyCode>=65) && (e.keyCode<=90)) || e.keyCode==8 || e.keyCode==32 ) {
doAjax('../detalle.php','&clasificacion=2&nomb_det='+window.document.formulario.txtnombre.value,'detalle_prod','get','0','1','',''); //alert('entro');
//alert('entro');
}
}


//alert(add_mesa);
if(add_mesa!=""){
document.formulario.mesa.value=add_mesa;
document.formulario.mesa.disabled=true;
document.formulario.codprod.focus();
}

</script>
</html>
