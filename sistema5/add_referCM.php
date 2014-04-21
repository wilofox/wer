<?php 
session_start();
include('conex_inicial.php');
unset($_SESSION['productos']);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cambio de Mercaderia</title>
<link href="styles.css" rel="stylesheet" type="text/css">
<script language="javascript" src="miAJAXlib2.js"></script>
    <script src="jquery-1.2.6.js"></script>
    <script src="jquery.hotkeys.js"></script>
	<script src="mootools-comprimido-1.11.js"></script>
<style type="text/css">
<!--
body {
	background-color:#F3F3F3;   
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo11 {font-family: Verdana, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FFFFFF; }
.Estilo13 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #000000; }
.Estilo_det {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color:#000000; }
.Estilo1 {font-family: Arial, Helvetica, sans-serif}
.Estilo2 {font-size: 11px}
.texto1 {	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #000000;
}
-->
</style></head>

<body  onLoad="javascript:detalle_ref(event)" >
<form name="form1" method="post" action="">

				  	<?
					$strSQLX="select * from cab_mov where cod_cab='".$_REQUEST['codigo']."' ";
					$resultadoX=mysql_query($strSQLX,$cn);
					$rowX=mysql_fetch_array($resultadoX); 	
					//echo $rowX['cod_ope'];				
					
					$strSQLD="select * from docuser where usuario='".$_SESSION['codvendedor']."' and doc='CM' and tipomov='2' ";
					$resultadoD=mysql_query($strSQLD,$cn);
					$rowD=mysql_fetch_array($resultadoD); 
					//echo $rowD['serie'];
					if ($rowD['serie']==""){
					$ser_docNT='001';
					}else{
					$ser_docNT=$rowD['serie'];
					}
					
					$strSQLC="select max(Num_doc) as Num_doc from cab_mov where serie='".$rowD['serie']."' and cod_ope='CM' and tipo='2' ";
					$resultadoC=mysql_query($strSQLC,$cn);
					$rowC=mysql_fetch_array($resultadoC); 
					$rowC['Num_doc']=$rowC['Num_doc']+1;
					$cod_docNT=$rowC['Num_doc'];
					$cod_docNT=str_pad($cod_docNT, 7, "0", STR_PAD_LEFT);
					//echo  $cod_docNT;					
					?>
					
  <table width="500" height="321" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="12" height="65">&nbsp;</td>
      <td width="472"><table width="474" height="50" border="0" cellpadding="0" cellspacing="0" style="border:#999999 solid 1px">
          <tr>
            <td width="472" align="center"><table width="447" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="202"><span class="Estilo13" style="font-size:18px">Cambio de Mercaderia </span></td>
                  <td width="177"><span class="Estilo13" style="font-size:18px; color:#FF0000">
                    (<input class="textStyocultar"  name="codSNC" type="text" readonly id="codSNC" size="3" value="<?=$ser_docNT;?>" border="0" style="background-color:#F3F3F3; color:#FF0000; text-align:center;font-size:18px;" />-<input class="textStyocultar"  name="codCNC" type="text" readonly id="codCNC" size="8" value="<?=$cod_docNT;?>" border="0" style="background-color:#F3F3F3; color:#FF0000; text-align:center;font-size:18px;" />)
                  </span>		  <input name="doc" type="hidden"  value="<?php echo $rowX['cod_ope']?>" size="5" maxlength="3" readonly>
                  <input type="hidden" name="sucursal" value="<?php echo $_REQUEST['sucursal']?>">
                  <input type="hidden" name="codigo" value="<?php echo $_REQUEST['codigo']?>"></td>
                  <td width="68">
                    <input name="cod_ref" type="hidden" value="" size="8">
                    <input name="cod_cli_ref" type="hidden" value="" size="8">
                    <input name="des_cli_ref" type="hidden" value="" size="8">
					<input name="moneda_doc" id="moneda_doc" type="hidden" value="" size="8">	
                    <input name="impto" id="impto" type="hidden" value="" size="8">    				</td>
                </tr>
                <tr>
                  <td><div align="right"><span class="Estilo13" >Documento  Origen :</span> </div></td>
                  <td><input name="serie" type="text" value="<?=$rowX['serie'];?>" size="3" maxlength="3" readonly class="textStyocultar" style="background-color:#F3F3F3;">
                  <input name="numero" type="text" value="<?=$rowX['Num_doc'];?>" size="9" maxlength="7" autocomplete='off' readonly class="textStyocultar" style="background-color:#F3F3F3;"></td>
                  <td>&nbsp;</td>
                </tr>
            </table></td>
          </tr>
      </table></td>
      <td width="16">&nbsp;</td>
    </tr>
    <tr>
      <td height="125">&nbsp;</td>
      <td valign="top" style="border:#999999 solid 1px">	 
	  <table width="474" border="0" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
  <tr  style="background:url(imagenes/bg_contentbase4.gif); background-position:100% 60%">
    <td width="14" align="center">&nbsp;</td>
    <td width="48" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>Cod</strong></span></td>
    <td width="203"><span class="Estilo2 Estilo1 Estilo11"><strong>Descripci&oacute;n</strong></span></td>
    <td width="42" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>Uni.</strong></span></td>
    <td width="42" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>Cant.</strong></span></td>
    <td width="51" height="18" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>PUnit.</strong></span></td>
    <td width="52" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>Total</strong></span></td>
  </tr>
</table> 
	  <div id='det_doc' style="height:100; overflow:auto"></div>	  </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><br><table width="474" height="32" border="0" cellpadding="0" cellspacing="0" style="border:#999999 solid 1px" >
        <tr>
          <td width="472" align="center"><table width="447" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="134"><span class="Estilo13" style="font-size:12px">Cambio de Mercaderia </span></td>
                <td width="21"><span class="text8">--&gt;</span></td>
                <td width="252" class="text8"><div id='det_prod' class="text8" style="overflow:auto">(Seleccione producto a cambiar)</div> </td>
                <td width="40" ><span class="Estilo13" style="font-size:12px"> Por</span></td>
              </tr>
              <tr>
                <td colspan="4">&nbsp;</td>
                </tr>
              <tr>
                <td colspan="3">	  <span  style="color:#0066FF; font:bold; font-size:9px">Buscar por: </span>
                   <select name="busqueda" style="width:110px" disabled>
                    
                    <option value="idproducto">codigo Sistema</option>
                    <option value="nombre" selected="selected">Descripcion</option>
                    <option value="cod_prod">Codigo Barras </option>
					<option value="serie">Series</option>
                       </select>
                  <input autocomplete="off"  name="codprod"  type="text" onKeyUp="buscar_camprodCM(this)" disabled />
                  <input type="hidden" name="codP" value=""></td>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td colspan="4">
				<input type="hidden" name="cantidadP" value="">
                  <input type="hidden" name="precioP" value="">
                  <input type="hidden" name="totalP" value=""></td>
                </tr>
          </table>
	
		  </td>
        </tr>
      </table><br></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td valign="top" style="border:#999999 solid 1px"><table width="474" border="0" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
        <tr  style="background:url(imagenes/bg_contentbase4.gif); background-position:100% 60%">
          <td width="14" align="center">&nbsp;</td>
          <td width="48" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>Cod</strong></span></td>
          <td width="203"><span class="Estilo2 Estilo1 Estilo11"><strong>Descripci&oacute;n</strong></span></td>
          <td width="42" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>Uni.</strong></span></td>
          <td width="42" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>Cant.</strong></span></td>
          <td width="51" height="18" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>PUnit.</strong></span></td>
          <td width="52" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>Total</strong></span></td>
        </tr>
      </table>
        <div id='det_prodCM' class="text8" style="height:100;overflow:auto"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><br>
        <br>
	      <input type="button" name="Submit" value="Crear C.M." onClick="save_ref()">
      <input type="button" name="Submit2" value="Cancelar" onClick="vaciar_sesiones();detalle_ref(event);"></td>
		  
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<script>
jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_esc').addClass('dirty'); 
close()
return false; });

function detalle_ref(e){
  // if(e.keyCode==13){
	generar_ceros(e,7,"numero");	
	doc=document.form1.doc.value;
	numero=document.form1.numero.value;
	serie=document.form1.serie.value;
	sucursal=document.form1.sucursal.value;
    doAjax('peticion_ajax5.php','&serie='+serie+'&numero='+numero+'&doc='+doc+'&sucursal='+sucursal+'&det_ref'+'&accion=buscar&peticion=buscar_prod','rpta_det_ref','get','0','1','','');  
  //  }
}

function rpta_det_ref(texto){
	var temp=texto.split('?');	
	if(temp[0]=='N'){
	alert('Documento no Existe');
	document.getElementById('det_doc').innerHTML=temp[6];
	document.form1.cod_ref.value="";
	document.form1.cod_cli_ref.value="";
	document.form1.des_cli_ref.value="";
	document.form1.moneda_doc.value="";
	document.form1.impto.value="";			
	}else{	
	document.getElementById('det_doc').innerHTML=temp[6];
	document.form1.cod_ref.value=temp[1];
	document.form1.cod_cli_ref.value=temp[2];
	document.form1.des_cli_ref.value=temp[3];
	document.form1.moneda_doc.value=temp[4];
	document.form1.impto.value=temp[5];	
	}
cargar();		
}

function quitar_items(codigo){
	
	var cod_cli_ref=document.form1.cod_cli_ref.value;
	var des_cli_ref=document.form1.des_cli_ref.value;
	
doAjax('peticion_ajax5.php','&cod='+codigo+'&det_ref'+'&accion=quitar&cod_ref='+document.form1.cod_ref.value+'&codcliente_ref='+cod_cli_ref+'&descliente_ref='+des_cli_ref,'rpta_det_ref','get','0','1','',''); 
	
}

	
	function generar_ceros(e,ceros,control){
			var serie=document.form1.serie.value;
			var numero=document.form1.numero.value;
			
			if(e.keyCode==13 ){

				var valor="";
				if(control=='serie'){
				valor=serie
				}else{
				valor=numero
				}
				
				valor = parseFloat(valor);
				//alert(valor);
				if(isNaN(valor)){
				alert('Por favor digite un número válido');
				return false;
				}else{
				
				valor=valor.toString();
				}
						
			   if(control=='serie'){
				 document.form1.serie.value=ponerCeros(valor,ceros);
				 document.form1.numero.focus();
                 document.form1.numero.select();
				}
				if(control=='numero'){
				 document.form1.numero.value=ponerCeros(valor,ceros);
				}
				
			}  
	}	
	
	
	 function ponerCeros(obj,i) {
		  while (obj.length<i){
			obj = '0'+obj;
			}
		//	alert(obj);
			return obj;
		}		


function save_ref(){
alert();
try {
		var cont = 0; 
		for(var i=0;i<document.form1.codigoNT.length;i++){
				if (document.form1.codigoNT[i].checked) {
				cont = cont + 1;
				}		
		}
		if (document.form1.codigoNT.length==undefined){
			if (document.form1.codigoNT.checked) {
				cont = 1;
			}
		}
} catch(e) { }
if (cont==0){
return false;
}

var serie=document.form1.serie.value;
var numero=document.form1.numero.value;
var doc=document.form1.doc.value;
var cod_cli_ref=document.form1.cod_cli_ref.value;
var des_cli_ref=document.form1.des_cli_ref.value;
var cod_cab_ref=document.form1.cod_ref.value;
var moneda_doc=document.form1.moneda_doc.value;
var impto=document.form1.impto.value;
var codSNC=document.form1.codSNC.value;

//window.opener.cargar_ref(serie,numero,cod_cli_ref,des_cli_ref,cod_cab_ref,moneda_doc,impto);
doAjax('compras/peticion_datos.php','&peticion=save_CM&serie='+serie+'&numero='+numero+'&doc='+doc+'&codSNC='+codSNC,'mostrar_grabacion','get','0','1','','');
//close();
}
function mostrar_grabacion(texto){
	alert(texto);
	close();
}
	jQuery(document).bind('keydown', 'return',function (evt){jQuery('#_return').addClass('dirty'); 
	
	if(document.activeElement.name=='doc'){
		
		document.form1.serie.focus();	
	}
	
	return false; });

function vaciar_sesiones(){
doAjax('compras/vaciar_sesiones.php','','','get','0','1','','');
}
function marcar_NC(Valor){
if (Valor=='T'){
	if(document.form1.CodNT.checked){	
			for(var i=0;i<document.form1.codigoNT.length;i++){
				if (document.form1.codigoNT[i].disabled){			
				}else{
				document.form1.codigoNT[i].checked=true;
				document.form1.cant_det[i].disabled="";	
				}			
			}				
	}else{
	
			for(var i=0;i<document.form1.codigoNT.length;i++){
				document.form1.codigoNT[i].checked=false;			
				document.form1.cant_det[i].disabled="disabled";		
				}
	}	
}else{

	for(var i=0;i<document.form1.codigoNT.length;i++){
		if (document.form1.codigoNT[i].checked){
			document.form1.cant_det[i].disabled="";
			//document.form1.cant_det[i].focus();
		}else{
			document.form1.cant_det[i].disabled="disabled";	
		}			
					
	}
	if (document.form1.codigoNT.length==undefined){
		if (document.form1.codigoNT.checked){
			document.form1.cant_det.disabled="";
		}else{
			document.form1.cant_det.disabled="disabled";	
		}	
	}
}		

}


var temp="";
function enfocar_prod(objeto){
	objeto.cells[0].childNodes[0].checked=true;
	
	if(objeto.style.background=='url(imagenes/sky_blue_sel.png)'){
	}else{
	objeto.style.background='url(imagenes/sky_blue_sel.png)';
	temp.style.background=temp.bgColor;
	temp=objeto;
	}
	
}

function cargar(){
	try {
document.getElementById('lista_prodCM').rows[0].style.background='url(imagenes/sky_blue_sel.png)';
temp=document.getElementById('lista_prodCM').rows[0];
document.getElementById('lista_prodCM').rows[0].cells[0].childNodes[0].checked=true;
	 } catch(e) { }

}
var temp2="";
function enfocar_prod2(objeto){
	objeto.cells[0].childNodes[0].checked=true;
	
	if(objeto.style.background=='url(imagenes/sky_blue_sel.png)'){
	}else{
	objeto.style.background='url(imagenes/sky_blue_sel.png)';
	temp2.style.background=temp2.bgColor;
	temp2=objeto;
	}
	
}

function cargar2(){
	try {
document.getElementById('prod_CM').rows[0].style.background='url(imagenes/sky_blue_sel.png)';
temp2=document.getElementById('prod_CM').rows[0];
document.getElementById('prod_CM').rows[0].cells[0].childNodes[0].checked=true;
	 } catch(e) { }

}
function doc_det(valor){
	if (document.form1.XDato.length==undefined){
		var valor=document.form1.XDato.value;
	}else{
		for(var i=0;i<document.form1.XDato.length;i++){
				if (document.form1.XDato[i].checked){
					var valor=document.form1.XDato[i].value;
				}
		}
	}
	var codDM=document.form1.codigo.value;
    doAjax('peticion_ajax5.php','&codDM='+codDM+'&codprod='+valor+'&peticion=cambio_producto','det_camprod','get','0','1','','');  
}
function det_camprod(texto){

document.form1.busqueda.disabled=false;
document.form1.codprod.disabled=false;
	//alert(texto);
	//document.getElementById('det_prod').innerHTML=texto;	
	var temp=texto.split('?');	
	document.getElementById('det_prod').innerHTML=temp[0];
	document.form1.codP.value=temp[1];
	var codP=document.form1.codP.value;
	document.form1.cantidadP.value=temp[2];
	document.form1.precioP.value=temp[3];
	document.form1.totalP.value=temp[4];
	var cantidadP=document.form1.cantidadP.value;
	var precioP=document.form1.precioP.value;
	var totalP=document.form1.totalP.value;
	var busqueda=document.form1.busqueda.value;
	var codprod=document.form1.codprod.value;
	var codDM=document.form1.codigo.value;
	
doAjax('peticion_ajax5.php','&codDM='+codDM+'&codP='+temp[1]+'&cantidadP='+cantidadP+'&precioP='+precioP+'&totalP='+totalP+'&busqueda='+busqueda+'&codprod='+codprod+'&peticion=cambio_prodMC','det_camprodCM','get','0','1','',''); 
;	
}

function det_camprodCM(texto){
	//alert(texto);
	document.getElementById('det_prodCM').innerHTML=texto;	
	cargar2()
}
function buscar_camprodCM(objeto){
var codP=document.form1.codP.value;
var cantidadP=document.form1.cantidadP.value;
var precioP=document.form1.precioP.value;
var totalP=document.form1.totalP.value;
var busqueda=document.form1.busqueda.value;
var codprod=document.form1.codprod.value;
var codDM=document.form1.codigo.value;
doAjax('peticion_ajax5.php','&codDM='+codDM+'&codP='+codP+'&cantidadP='+cantidadP+'&precioP='+precioP+'&totalP='+totalP+'&busqueda='+busqueda+'&codprod='+codprod+'&peticion=cambio_prodMC','det_camprodCM','get','0','1','',''); 

}
function Modificar_Precio(e,valor,it,prod){
	if(e.keyCode==13){
		var monto="";
		monto=valor.value;
		monto=parseFloat(monto);
		
		if(isNaN(monto)){
			alert('Por favor digite cantidad válida');
			valor.value='0';
			return false;
		}
		//alert(prod);
	
var codP=document.form1.codP.value;
var cantidadP=document.form1.cantidadP.value;
var precioP=document.form1.precioP.value;
var totalP=document.form1.totalP.value;
var busqueda=document.form1.busqueda.value;
var codprod=document.form1.codprod.value;
var codDM=document.form1.codigo.value;

doAjax('peticion_ajax5.php','&codDM='+codDM+'&codP='+codP+'&cantidadP='+cantidadP+'&precioP='+precioP+'&totalP='+totalP+'&busqueda='+busqueda+'&codprod='+codprod+'&peticion=cambio_prodMC&monto='+monto+'&prod='+prod,'det_camprodCM','get','0','1','',''); 

	}

}

</script>