<?php session_start();
include("conex_inicial.php");
include("funciones/funciones.php");
$Codigo=$_REQUEST['codigo'];

unset($_SESSION['pagos']);

$strSQl="select * from operacion where codigo='BV' or codigo='FA' ";
$resultado=mysql_query($strSQl,$cn);
while($row=mysql_fetch_array($resultado)){
		$cod_doc[]=$row['codigo'];
		$des_cod_doc[]=$row['descripcion'];
		$formato_imp[]=$row['formato'];
		$cola_imp[]=$row['cola'];
		$monedaope[]=$row['moneda'];
		$permisos[]=substr($row['p1'],12,1);
}
	//print_r($des_cod_doc);
	function php2js ($var) {

			if (is_array($var)) {
				$res = "[";
				$array = array();
				foreach ($var as $a_var) {
					$array[] = php2js($a_var);
				}
				//return "[" . join(",", $array) . "]";
				return "" . join(",", $array) . "";
				
			}
			elseif (is_bool($var)) {
				return $var ? "true" : "false";
			}
			elseif (is_int($var) || is_integer($var) || is_double($var) || is_float($var)) {
				return $var;
			}
			elseif (is_string($var)) {

				//return "\"" . addslashes(stripslashes($var)) . "\"";
				 return "" . addslashes(stripslashes($var)) . "";	
			}
		
			return FALSE;
		}

			$js1 = php2js($cod_doc); 
			$js2 = php2js($des_cod_doc); 
			$js3 = php2js($formato_imp); 
			$js4 = php2js($cola_imp); 
			$js5 = php2js($monedaope); 
			$js6 = php2js($permisos); 


$sqlMilFac="select * from cab_mov CM inner join det_mov DM on CM.cod_cab=DM.cod_cab
 where CM.cod_cab=$Codigo "; 
$ResulMultifac = mysql_query($sqlMilFac,$cn); 
$rowMilFac=mysql_fetch_array($ResulMultifac);

$doc_pago=$rowMilFac['cod_ope'];
if ($doc_pago=='B0'){
$doc_pago=0;
}elseif ($doc_pago=='F0'){
$doc_pago=1;
}else{
$doc_pago=2;
}

/// Recupera la lista de pagos realizados
/*$sqlMilFac2="select * from pagos where referencia='$Codigo' "; 
$ResulMultifac2 = mysql_query($sqlMilFac2,$cn); 
while($rowMilFac2=mysql_fetch_array($ResulMultifac2)){

	if($rowMilFac2['moneda']=='02'){
		$dolares=$rowMilFac2['monto'];
	}else{
		$soles=$rowMilFac2['monto'];
	}
  $_SESSION['pagos'][0][]=count($_SESSION['pagos'][0])+1;
  $_SESSION['pagos'][1][]=$rowMilFac2['tipo'];
  $_SESSION['pagos'][2][]=$rowMilFac2['t_pago'];
  $_SESSION['pagos'][3][]=$rowMilFac2['numero'];
  $_SESSION['pagos'][4][]=$soles;
  $_SESSION['pagos'][5][]=$rowMilFac2['tcambio'];
  $_SESSION['pagos'][6][]=$dolares;
  $_SESSION['pagos'][7][]=extraefecha($rowMilFac2['fecha']);
  $_SESSION['pagos'][8][]=$rowMilFac2['obs'];
}*/


?>
<script>

			var cod_doc="<?php echo $js1 ?>";
			var des_cod_doc="<?php echo $js2 ?>";
			var formato_imp="<?php echo $js3 ?>";
			var cola_imp="<?php echo $js4 ?>";
			var monedaope="<?php echo $js5 ?>";	
			var permisos="<?php echo $js6 ?>";
					
						
			var cod_doc=cod_doc.split(",");
			var des_cod_doc=des_cod_doc.split(",");
			var formato_imp=formato_imp.split(",");
			var cola_imp=cola_imp.split(",");
			var monedaope=monedaope.split(",");
			var permisos=permisos.split(",");
			
			
var temporal1="<?php echo $_SESSION['caja_serie']?>";
var temporal2="<?php echo $_SESSION['user']?>";
var temporal3="<?php echo $_SESSION['terminal']?>";
var temporal4="<?php echo $_SESSION['codvendedor']?>";
var temporal5="<?php echo $_SESSION['logeado']?>";
var temporal6="<?php echo $_SESSION['nivel_usu']?>";
var control_focus="";
/*
if(temporal1=="" || temporal2=="" || temporal3=="" || temporal4=="" || temporal5=="" || temporal6==""){
close();
window.open('pedido.php?caducado=s','principal');
}
*/
var temporal_teclas="";
</script>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Caja Recaudaci&oacute;n</title>
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
.Estilo48 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #FFFFFF; }
.Estilo49 {font-size: 11px; color: #FFFFFF; font-family: Arial, Helvetica, sans-serif;}
.Estilo53 {color: #A82222}
.Estilo54 {font-size: 14px}
.Estilo55 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	color: #CC0000;
}


-->
</style>
<link href="styles.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
.Estilo56 {font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #333333; }
.Estilo57 {color: #333333}
.Estilo58 {
	color: #F40B0B;
	font-weight: bold;
	/*font-size: 18px;*/
	font-size: 14px;
}
.Estilo61 {font-size: 18px}
.Estilo62 {color: #FFFFFF}

.Etiqueta01{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	}
-->
</style>
</head>
<script language="javascript" src="modulos_usuarios/miAJAXlib3.js"></script>
    <script src="jquery-1.2.6.js"></script>
    <script src="jquery.hotkeys.js"></script>
<!--<script src="mootools-comprimido-1.11.js"></script>-->


	<script type="text/javascript" src="modalbox/lib/prototype.js"></script>
	<script type="text/javascript" src="modalbox/lib/scriptaculous.js?load=effects"></script>
	
	<script type="text/javascript" src="modalbox/modalbox.js"></script>
	<link rel="stylesheet" href="modalbox/modalbox.css" type="text/css" />


<link rel="stylesheet" type="text/css" media="all" href="calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="calendario/calendar.js"></script>
<script type="text/javascript" src="calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendario/calendar-setup.js"></script>
<script>

jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_esc').addClass('dirty'); 
close()
return false; });

jQuery(document).bind('keypress', 'return',function (evt){jQuery('#_return').addClass('dirty'); 

	if(document.getElementById('clientes').style.visibility=='visible'){
		for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
			if(document.getElementById('tblproductos').rows[i].style.background=='#fcf7e4'){
			
		var temp=document.getElementById('tblproductos').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
		var razon=document.getElementById('tblproductos').rows[i].cells[1].childNodes[0].innerHTML;
		var direccion=document.getElementById('tblproductos').rows[i].cells[3].childNodes[0].innerHTML;
		var ruc=document.getElementById('tblproductos').rows[i].cells[2].childNodes[0].innerHTML;

		elegir(temp,razon,direccion,ruc);
		
			}
			
		}
	}
		
		
		
		if(document.form1.tpago2.value==1){
		///	document.form1.soles.focus();
		//	document.form1.soles.select();		
		}
		
return false; });

jQuery(document).bind('keydown', 'f7',function (evt){jQuery('#_f7').addClass('dirty');
	//insertar('P');
 return false; }); 	 
jQuery(document).bind('keydown', 'f2',function (evt){jQuery('#_f2').addClass('dirty');
 insertar('G');
 return false; }); 	 

function insertar(tipo){



if (tipo=='P'){
document.form1.temp_imp.value='S';
}
if (document.form1.acuenta.value=='0.00' && document.form1.condicion.value==1){
alert('Debe de realizar pago antes de mandar a imprimir');
return false
}
if (document.form1.ruc3.value=='' && document.form1.ruc3.disabled==''){
	alert("Es necesario asignarle el Ruc");
	document.form1.ruc3.focus();
return false
}
	if (temporal_teclas=="") {
	var total_doc=document.form1.importe.value;
		if(total_doc!=0){
			
			
			if(parseFloat(document.form1.acuenta.value)>parseFloat(document.form1.importe.value)){
			alert("El monto ingresado no puede ser mayor al importe del documento");
			return false;
			}
			temporal_teclas='grabar';
			grabar_doc();
		}else{
			alert('No se puede guardar este documento');			
		}	
	}else{
		event.keyCode=0;
		event.returnValue=false;
	}
}

function grabar_doc(){

			var total_doc=document.form1.importe.value;
			if(total_doc!=0){
			
			var temp_doc="";
			var tipomov="2";
			var sucursal=document.form1.sucursal.value;
			var tienda=document.form1.tienda.value;
			var responsable=document.form1.responsable.value;
			var condicion=document.form1.condicion.value;
			var femision=document.form1.fecha.value;
			var fvencimiento=document.form1.fecha2.value;
			var monto=document.form1.baseimp.value;
			var impuesto1=document.form1.impuesto1.value;
			var impto=document.form1.impto.value;

			var incluidoigv=document.form1.incluidoigv.value;
			var auxiliar=document.form1.cliente.value;
			var tmoneda=document.form1.moneda_doc.value;
			var tcambio=document.form1.tc.value;
			var vuelto=document.form1.vuelto.value;
			var moneda_v=document.form1.vueltoen.value;
			
			
			var correlativo_ref='';
			var serie_ref=<?=$rowMilFac['serie'];?>;
			var cod_cab_ref="";
			var doc=document.form1.op.value;
			var serie=document.form1.serie.value;
			var numero=document.form1.numero.value;

			var obs1="";
			var obs2="";
			var obs3="";
			var obs4="";
			var obs5="";
			
			var kardex_doc="S";			
			var act_kardex_doc="N";						
			//document.form1.accion2.value="grabar";
			var codigoDoc=document.form1.codigoD.value;
			var correlativo_ref=document.form1.correlativo_ref.value;
			var acuenta=document.form1.acuenta.value;
		
			
//alert('codigoDoc='+codigoDoc+'&peticion=save_canjepago&femision='+femision+'&vuelto='+vuelto+'&moneda_v='+moneda_v+'&total_doc='+total_doc+'&acuenta='+acuenta+'&serie='+serie+'&numero='+numero);
			//return false;
			//alert();
			
doAjax('compras/peticion_datos.php','&codigoDoc='+codigoDoc+'&peticion=save_canjepago&femision='+femision+'&fvencimiento='+fvencimiento+'&vuelto='+vuelto+'&moneda_v='+moneda_v+'&total_doc='+total_doc+'&acuenta='+acuenta+'&serie='+serie+'&numero='+numero+'&doc='+doc,'mostrar_grabacion','get','0','1','','');
								
			}else{
			alert('No se puede guardar el documento sin  detalle');						
			}
	
}

function mostrar_grabacion(texto){
//alert(texto);
	//return false;
		if(texto=='error'){		
			alert('Documento no grabó.....Verifique su conexión de red.');
			document.formulario.submit();
			return false;			
		}
		
		var xtemp=texto.split(":");
		//alert(xtemp);		
		if(texto!='' && texto!='error' && xtemp[0]!="cod_cab" ){
			
				var texto2=texto.split(":");
				//alert(texto);
				if(texto2[0]=='serie ingresada'){
				alert('Serie ya existe en stock.... \n Producto: '+texto2[2]+' \n Serie: ' + texto2[1]);					
				}else{
				alert("Cantidad no corresponde con las series del producto: "+texto);
				temporal_teclas="";
				return false;
				}
				
		}else{
			var cola_imp=document.form1.cola_imp.value;
			var formato=document.form1.formato_imp.value;
			var vuelto=document.form1.vuelto.value;
			//window.open("colaImp.php?cod_cab="+xtemp[1]+"&formato="+formato+"&cola_imp="+cola_imp,"","width=10,height=10,top=0,left=0,scroolbars=no,directories=no,location=no,menubar =no,titlebar=no,toolbar=no");

		// yedem	var 
			if(document.form1.temp_imp.value=='S'){
				//alert("Imprimir documento... ");
			win00=window.open('formatos/'+formato+'?codcab='+xtemp[1]+'&vuelto='+vuelto,'ventana2','width=850,height=1000,top=100,left=100,scroolbars=yes,status=yes');	
			//window.returnValue=true
			}	
			
			//if(xtemp[2]=='1'){
			//window.open("formatos/tempImpresion.php?CodDoc="+xtemp[1],"ventReimprimir","toolbar=no,status=yes, menubar=no, scrollbars=yes,resizable=yes, width=520, height=250,left=300 top=250");
			
			//window.open("formatos/ticket_pago.php?codcab="+xtemp[1],"ventReimprimir","toolbar=no,status=yes, menubar=no, scrollbars=yes,resizable=yes, width=520, height=250,left=300 top=250");
	
			
			//}
			
			window.close();
			window.parent.opener.recargar();
	   }
}
	 
function imprimir(sucursal,doc,serie,numero){
	//var formato=find_prm(tab_formato,tab_cod);
	//var impresion=find_prm(tab_impresion,tab_cod);

	var cola_imp=document.form1.cola_imp.value;
	var formato=document.form1.formato_imp.value;
	
	if(serie!='' && formato!=''){ 
	//var win00=window.open('formatos/'+formato+'?empresa='+sucursal+'&doc='+doc+'&serie='+serie+'&numero='+numero+'&impresion='+impresion+'&cola_imp='+cola_imp ,'ventana2','width=850,height=1000,top=100,left=100,scroolbars=yes,status=yes');	
	
	//formato="ticket_pago.php";
	//alert();
	var win00=window.open('formatos/'+formato+'?empresa='+sucursal+'&doc='+doc+'&serie='+serie+'&numero='+numero+'&impresion='+impresion+'&cola_imp='+cola_imp ,'ventana2','width=850,height=1000,top=100,left=100,scroolbars=yes,status=yes');	

	win00.focus();
	
	}else{
	alert('No es posible imprimir');
	}
	
	
}	 
	 
	 

function datosTextos() { 
var textos = 'CONTENIDO_TABLA'; 
	for (var i=0;i<document.getElementById('TablaDatos').rows.length;i++) { 
		textos = textos + document.getElementById('TablaDatos').rows[i].cells[0].innerHTML;
	} 
	alert(textos);
}</script>

<script>

function enfocar(){ 
	var operacion="<?php echo $cod_doc[0]; ?>";

	doAjax('generarnumero.php','operacion='+operacion,'gen_numero','get','0','1','','');
	document.form1.op.value=operacion;
	//2013
	//document.getElementById('boleta').childNodes[0].innerHTML=des_cod_doc[<?=$doc_pago;?>];
	mostrar_totales(<?=$rowMilFac['saldo'];?>);
}
function mostrar_totales(texto){
texto=Decimales(texto,2);
document.form1.importe.value=texto;
document.form1.importe2.value=texto;

	if(document.form1.moneda_doc.value=='01'){
		document.form1.total_s.value=texto;
		document.form1.total_d.value=Decimales(texto/document.form1.tcambio_det_pago.value,2);
		document.form1.pendiente_d.value=document.form1.total_d.value;
		document.form1.pendiente_s.value=document.form1.total_s.value;
	}else{			
		document.form1.total_s.value=Decimales(texto*document.form1.tcambio_det_pago.value,2);
		document.form1.total_d.value=texto;
		document.form1.pendiente_d.value=document.form1.total_d.value;
		document.form1.pendiente_s.value=document.form1.total_s.value;
	}
	///////--------------------
	if(document.form1.moneda_doc.value=='01'){
		document.form1.soles.value=document.form1.importe.value;
		document.form1.dolares.value=0;
		document.form1.soles.select();
	}else{
		document.form1.dolares.value=document.form1.importe.value;
		document.form1.soles.value=0;
		document.form1.dolares.select();
	}
	
}
function Decimales(Numero, Decimales) {

	pot = Math.pow(10,Decimales);
	num = parseInt(Numero * pot) / pot;
	nume = num.toString().split('.');

	entero = nume[0];
	decima = nume[1];

	if (decima != undefined) {
		fin = Decimales-decima.length; }
	else {
		decima = '';
		fin = Decimales; }

	for(i=0;i<fin;i++)
	  decima+=String.fromCharCode(48); 

	num=entero+'.'+decima;
	return num;
}

function lista_pago(texto){
var r = texto.split("?");
document.getElementById('pagos_d').innerHTML=r[0];
document.getElementById('pagos_d').style.visibility='visible';
document.form1.soles.value=0;
document.form1.soles.disabled=false;
document.form1.dolares.value=0;
document.form1.dolares.disabled=false;
document.form1.numero_tarjeta.value="";
//document.form1.tpago.focus();
var moneda_doc=document.form1.moneda_doc.value;
var tc_doc=document.form1.tc.value;
document.form1.acuenta.value=parseFloat(r[1].replace(',','')).toFixed(2);

//2013 --------------------------------
if (document.getElementById('boleta').childNodes[0].innerHTML=='FACTURA DE VENTA'){
$igv=1.18;
}else{ $igv=1; }
document.getElementById('txtST').innerHTML=(document.form1.acuenta.value/$igv).toFixed(2);
document.getElementById('txtIGV').innerHTML=(document.form1.acuenta.value-document.getElementById('txtST').innerHTML).toFixed(2);
document.getElementById('txtT').innerHTML=document.form1.acuenta.value;


//2013 --------------------------------

//alert();
if(document.form1.moneda_doc.value==02){
	var temp=parseFloat(document.form1.total_s.value.replace(',',''))-(parseFloat(r[1].replace(',',''))*tc_doc).toFixed(2);
	var temp2=parseFloat(document.form1.total_d.value.replace(',','')) - parseFloat(r[1].replace(',',''));

	var pendiente_s=parseFloat(temp).toFixed(2);
	var pendiente_d=parseFloat(temp2).toFixed(2);
	//alert(pendiente_s);
	
		if(pendiente_s < 0 || pendiente_d < 0){
		
		document.form1.pendiente_s.value="0.00";
		document.form1.pendiente_d.value="0.00";
		//alert();
		
			calcular_vuelto();
		
		}else{
		//alert(pendiente_s);
		document.form1.pendiente_s.value=parseFloat(pendiente_s).toFixed(2);
		document.form1.pendiente_d.value=parseFloat(pendiente_d).toFixed(2);
		
		document.form1.vuelto.value="0.00";
		}
}else{
		
 		//var pendiente_s=parseFloat(document.form1.total_s.value)-r[1];
		var pendiente_s=parseFloat(document.form1.total_s.value)-parseFloat(r[1].replace(',','')).toFixed(2);
		var pendiente_d=parseFloat(document.form1.total_d.value)-(parseFloat(r[1].replace(',','')).toFixed(2)/tc_doc).toFixed(2);	
		
		if(pendiente_s < 0 || pendiente_d < 0){
		document.form1.pendiente_s.value=0;
		document.form1.pendiente_d.value=0;
		//alert();
		//alert(document.getElementById('tbl_pagos').rows.length);
	//	document.form1.vuelto.value=;
		calcular_vuelto();
		}else{
		document.form1.pendiente_s.value=pendiente_s.toFixed(2);
		document.form1.pendiente_d.value=pendiente_d.toFixed(2);	
		document.form1.vuelto.value="0.00";	
		}
	
}

//control_focus.select();
//control_focus.focus();
 
}

function calcular_acuenta(texto){
//alert(texto);
var r = texto;
document.form1.acuenta.value=r;
}

function calcular_vuelto(){

if (document.form1.acuenta.value=='0.00'){
//alert('No puede cambiar de documento cuando ya haya realizado pagos');
return false
}

var filas=document.getElementById('tbl_pagos').rows.length;
var moneda_doc=document.form1.moneda_doc.value;
var monto_total=0;
var tc_doc=document.form1.tc.value;

			for(var i=1;i<filas;i++){
				//alert();
				if(document.getElementById('tbl_pagos').rows[i].cells[3].childNodes[0].innerHTML.replace(',','') > 0){
					var temp_monto=document.getElementById('tbl_pagos').rows[i].cells[3].childNodes[0].innerHTML.replace(',','');
					var temp_mon=01;
					//alert(temp_monto);
				}else{
					var temp_monto=document.getElementById('tbl_pagos').rows[i].cells[5].childNodes[0].innerHTML.replace(',','');
					var temp_mon=02;
					
				}
				var temp_tc=document.getElementById('tbl_pagos').rows[i].cells[4].childNodes[0].innerHTML;
					if(moneda_doc==02 && temp_mon==01){
					 monto_total=monto_total+parseFloat(temp_monto/temp_tc);
					// alert(monto_total);
					}else{
					  if(moneda_doc==01 && temp_mon==02){
					   monto_total=monto_total+parseFloat(temp_monto*temp_tc);
					  }else{
					  
						monto_total=monto_total+parseFloat(temp_monto);
						//alert(temp_monto);
					  }
					}
				
				
			}
			var vuelto=monto_total-parseFloat(document.form1.importe.value);
						
			var mon_vuelto=document.form1.vueltoen.value;
			//alert(mon_vuelto+"//"+moneda_doc);
				if(mon_vuelto=="01" && moneda_doc==02){
				var vuelto_total=vuelto*tc_doc;
				}else{
				  if(mon_vuelto=="02" && moneda_doc==01){
				  var vuelto_total=vuelto/tc_doc;
				  }else{
				  var vuelto_total=vuelto;
				  }
				}
		if (vuelto_total<0){
			document.form1.vuelto.value='0.00';
		}else{
			document.form1.vuelto.value=vuelto_total.toFixed(2);
		}
	
}

function listaprod(texto){
//alert(texto);
var r = texto;
document.getElementById('clientes').innerHTML=r;
document.getElementById('clientes').style.visibility='visible';
//alert('entro');

}

function nuevo_cliente(texto){
//alert(texto);
var r = texto;
document.getElementById('nuevo_cliente').innerHTML=r;
document.getElementById('nuevo_cliente').style.visibility='visible';
//alert('entro');
document.form1.crazonsocial.focus();

}


function validartecla(e,control){
//alert(e.keyCode);

	//if (((e.keyCode>=97) && (e.keyCode<=105)) || ((e.keyCode>=65) && (e.keyCode<=90)) || e.keyCode==8 || e.keyCode==32 ) 
	
	//if( ( (e.keyCode>=96) && (e.keyCode<=105) || (e.keyCode>=48) && (e.keyCode<=57) )  || ((e.keyCode>=65) && (e.keyCode<=90)) || e.keyCode==8 || e.keyCode==32 ) 
	//{
	if(e.keyCode==13){
	doAjax('peticion_ajax2.php','&peticion=buscar_cliente&ruc='+control.value,'rspta_buscar_cliente','get','0','1','',''); 
	}
		
}

function rspta_buscar_cliente(texto){
//alert(texto);
	var valor=texto.split("?");
	if(valor[0]==""){
	alert("Ruc no existe");
	ver_clientes();
	//document.form1.ruc3.focus();
	//document.form1.ruc3.select();
	}else{
	document.form1.cliente.value=valor[0];
	document.form1.cliente2.value=valor[1];
	document.form1.ruc3.value=valor[2];
	document.form1.direc2.value=valor[3];
	document.form1.ruc3.disabled=true;
	
		if(document.form1.moneda_doc.value=='02'){
			document.form1.dolares.select();
			document.form1.dolares.focus();
			}else{
			document.form1.soles.select();
			document.form1.soles.focus();
		}
	
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


	if(cadena[3]!=1062){
	
	document.form1.ruc3.value=cadena[0];
	//cadena[1]=cadena[1].replace("%","&");
	document.form1.cliente.value=cadena[1];
	
	document.form1.direc.value=cadena[2];
	
	document.form1.cliente2.value=cadena[1].replace("%","&");
	document.form1.direc2.value=cadena[2];
	}else{
	alert(" Este cliente ya se encuentra registrado");
	}

document.getElementById('tpago').style.visibility='visible';
document.getElementById('condicion').style.visibility='visible';
document.getElementById('vueltoen').style.visibility='visible';

document.form1.condicion.focus();


document.getElementById('boleta').style.display="none";
document.getElementById('factura').style.display="block";
doAjax('generarnumero.php','operacion=F0&servicio='+document.form1.servicio.value,'gen_numero','get','0','1','','');
document.form1.op.value='F0';
//alert(texto);
}


</script>

<?php 
$total=0;
//$tc=3.040;
$fecha=date('d-m-Y');
$serie='004';

if(isset($_REQUEST['mesa'])){

$_SESSION['registro']=rand(100000,999999);
$mesas=$_REQUEST['mesa'];

  $strSQL4="select * from comanda where mesa='$mesas' and estado='g'";
  $resultado4=mysql_query($strSQL4,$cn);
  while($row4=mysql_fetch_array($resultado4)){
 // echo number_format($row4['precio']*$row4['cantidad'],2);
	 $total=$total + ($row4['precio']*$row4['cantidad']); 
	 
	 
		  $strSQL5="select max(cod_det) as codigo from det_mov";
	  $resultado5=mysql_query($strSQL5,$cn);
	  $row5=mysql_fetch_array($resultado5);
	  $var=$row5['codigo']+1;
	  $cod_det=str_pad($var, 6, "0", STR_PAD_LEFT);
	   mysql_free_result($resultado5);
	 
		   $strSQL2= "insert into det_mov(cod_det,cod_cab,tipo,cod_prod,nom_prod,precio,cantidad,notas) values ('".$cod_det."','".$_SESSION['registro']."',1,'".$row4['cod_prod']."','".$row4['nom_prod']."','".$row4['precio']."','".$row4['cantidad']."','".$row4['notas']."')";
		  mysql_query($strSQL2);
			//echo $strSQL2."<br>"; 
  }
  		 
$servicio="comanda";
}else{
	/*if(isset($_SESSION['productos'][0])){ 
		 foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
		 
		  $total=$total + ($_SESSION['productos'][1][$subkey] * $_SESSION['productos'][2][$subkey]);
		 
		 }
		 
 	}*/
  $servicio="rapida";
}  

//documento referencia
if ($rowMilFac['cliente']<>''){
	$sqlCli="select * from cliente where codcliente='".$rowMilFac['cliente']."'  ";
	$resultadoCli=mysql_query($sqlCli,$cn);
		while($rowCli=mysql_fetch_array($resultadoCli)){
		$codcli= $rowCli['codcliente'];
		$razcli= $rowCli['razonsocial'];
		$ruccli= $rowCli['ruc'];
		$dircli= $rowCli['direccion'];
		} 
}else{
		$codcli= '000001';
		$razcli= 'varios';
		$ruccli= '';
		$dircli= '';
} 
?>
<script>

function terminar(){
window.close();
}

function cerrar(){
//window.parent.opener.formulario.ruc2.value="0";
//window.parent.opener.datos="";
}

jQuery(document).bind('keydown', 'f9',function (evt){jQuery('#_f9').addClass('dirty');

	if(document.form1.op.value==cod_doc[0]){
		document.form1.op.value=cod_doc[1];
		document.form1.formato_imp.value=formato_imp[1];
		document.form1.cola_imp.value=cola_imp[1];		
		document.getElementById('boleta').childNodes[0].innerHTML=des_cod_doc[1];
		document.form1.ruc3.disabled=false;
		document.form1.ruc3.focus();
		document.form1.ruc3.select();
	}else{
		document.form1.op.value=cod_doc[0];
		document.form1.formato_imp.value=formato_imp[0];
		document.form1.cola_imp.value=cola_imp[0];
		document.getElementById('boleta').childNodes[0].innerHTML=des_cod_doc[0];	
		document.form1.ruc3.disabled=true;	
		enfocar_montos();				
			
	}	
	var operacion=document.form1.op.value;
	doAjax('generarnumero.php','operacion='+operacion,'gen_numero','get','0','1','','');
	
return false; }); 
function enfocar_montos(){

	if(document.form1.soles.value=='' || document.form1.soles.value==0){
	document.form1.dolares.disabled=false;
	document.form1.dolares.select();
	document.form1.dolares.focus();
	}else{
	document.form1.soles.disabled=false;
	document.form1.soles.select();
	document.form1.soles.focus();
	}

}
function gen_numero(texto){

var cadena=texto.split('-');
document.form1.numero.value=cadena[0];
document.form1.serie.value=cadena[1];
cbo_cond();
}

</script>
<body  onLoad="enfocar();" onBlur="cambiar()" onUnload="cerrar()">
 <div id="AnularRk" style="position:absolute; left: 197px; top: 14px; width: 151px; height: 36px;"><span class="Estilo49" style="font-weight:bold; font-size:14px">Documento de Canje</span></div>
<table width="584" height="454" border="0" bgcolor="#FFFFFF">
  <tr>
    <td width="574" height="448" colspan="5" valign="top">
	
	<form id="form1" name="form1" method="post" action="" >
      <table width="574" height="475" border="0" cellpadding="0" cellspacing="0">
        <tr bgcolor="#6699CC">
          <td height="39" bgcolor="#004993">&nbsp;</td>
          <td colspan="2" bgcolor="#004993"><table width="286" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td colspan="4" height="5"></td>
              </tr>
            <tr>
              <td><span class="Estilo48" >F2 = </span></td>
              <td><span class="Estilo49" >Guardar </span></td>
              <td width="24">&nbsp;</td>
              <td width="187">&nbsp;</td>
            </tr>
            <tr>
              <td width="22"><span class="Estilo48">F7 = </span></td>
              <td width="53"><span class="Estilo49">Imprimir</span></td>
              <td><span class="Estilo48">F9 = </span></td>
              <td><span class="Estilo49">Documento</span></td>
            </tr>
          </table> <input id="codigoD" type="hidden" name="codigoD" value="<?=$Codigo;?>" >            
            <label for="textfield"></label></td>
          <td colspan="2" align="right" bgcolor="#004993">
		  <span class="Estilo25">Importe(<? if ($rowMilFac['moneda']=='01'){ echo 'S/.';}else{ echo 'US$';} ?>)</span>
            <input  style="text-align:right; font:bold ; font-size:12px" readonly  name="importe" type="text" id="importe" size="10" value="<?php echo $total_doc?>" />
            <input  name="importe2" type="hidden" id="importe2" size="10" value="<?php echo $total;?>" />
            <span class="Estilo15">
            <input  name="op" type="hidden" id="op" size="10" value="" />
            </span></td>
          </tr>
        <tr>
          <td width="20" height="36" >&nbsp;</td>
          <td width="77"><span class="Estilo15">Ruc:
		  <?
		  echo $_REQUEST['mesa'];
		  echo $_REQUEST['registro'];
		  ?>
            <input name="mesa" type="hidden" id="mesa" size="10" maxlength="10" value="<?php echo $_REQUEST['mesa']?>">
            <input name="registro" type="hidden" size="10" maxlength="10" value="<?php echo $_REQUEST['registro']?>">
            <input name="servicio" type="hidden" size="5" maxlength="5" value="<?php echo $servicio?>">            
          </span></td>
          <td width="302"><label for="textfield"></label>
            <input name="ruc3" type="text"  id="ruc3"   value="<?=$ruccli;?>" size="12" maxlength="11" disabled />
			
			<input id="ruc4" type="hidden" name="ruc4" value="1" >
            <input name="moneda_doc" id="moneda_doc" type="hidden" size="3" maxlength="5" value="<?php echo $rowMilFac['moneda']; ?>">
            <input name="sucursal" id="sucursal" type="hidden" size="3" maxlength="5" value="<?php echo $rowMilFac['sucursal']; ?>">
            <input name="tienda" id="tienda" type="hidden" size="3" maxlength="5" value="<?php echo $rowMilFac['tienda']; ?>">
            <input name="responsable" id="responsable" type="hidden" size="3" maxlength="5" value="<?php echo $rowMilFac['cod_vendedor']; ?>">
            <input name="incluidoigv" id="incluidoigv" type="hidden" size="3" maxlength="5" value="<?php echo $rowMilFac['incluidoigv']; ?>">			
            <input name="impto" id="impto" type="hidden" size="3" maxlength="5" value="<?php echo $rowMilFac['impto1']/100; ?>">
            <input name="impuesto1" id="impuesto1" type="hidden" size="3" maxlength="5" value="<?php echo $rowMilFac['igv']; ?>">
            <input name="baseimp" id="baseimp" type="hidden" size="3" maxlength="5" value="<?php echo $rowMilFac['b_imp']; ?>">
            <input name="cola_imp" id="cola_imp" type="hidden" size="3" maxlength="5" value="<?php echo $cola_imp[0]; ?>">
            <input name="formato_imp" id="formato_imp" type="hidden" size="3" maxlength="5" value="<?php echo $formato_imp[0]; ?>">
			<input name="correlativo_ref" id="correlativo_ref" type="hidden" size="3" value="<?php echo $rowMilFac['Num_doc']; ?>">	
			<input name="num_item" id="num_item" type="hidden" size="3" value="0">
			<input type="hidden" name="temp_imp" id="temp_imp" value="" size="5">
			<br><b>Refer.Doc. N&deg;:<?=$rowMilFac['serie'];?>-<?=$rowMilFac['Num_doc'];?></b>						</td>
          <td colspan="2" align="center" valign="middle"><div id="boleta" style="display:block;"><span class="Estilo54 Estilo58">BOLETA DE VENTA</span></div>
			
		<b class="Estilo54" style="color:#000000">N&deg;:</b><input name="serie" readonly  type="text" id="serie" size="3" maxlength="11" value="" class="Estilo54"/>
		-
		<input name="numero" readonly  type="text" id="numero" size="7" maxlength="11"  value="" class="Estilo54"/></td>
          </tr>
        <tr>
          <td height="22">&nbsp;</td>
          <td><span class="Estilo15">Cliente</span></td>
          <td><input name="cliente"  type="hidden" id="cliente" size="5" maxlength="5" value="<?=$codcli;?>" />
            <input name="cliente2" disabled="disabled"  type="text" id="cliente2" size="30" maxlength="200" value="<?=$razcli;?>" />
            <input name="tope" type="hidden" value="A" >
            <img style="cursor:pointer; visibility:hidden" onClick="ver_clientes()" src="imagenes/ico_lupa.jpg" width="15" height="15"></td>
		 
		  <td bgcolor="#FFFFFF"><!--<span class="Estilo56">Total (S/.) </span>--></td>
          <td width="87" bgcolor="#FFFFff" align="right"><input  style="text-align:right; font:bold ; font-size:12px; visibility:hidden" name="total_s" type="text" size="10" readonly value="<?php echo $total_sol; ?>" /></td>
		  
          </tr>
		<tr>
          <td height="22">&nbsp;</td>
          <td><span class="Estilo15">Direcci&oacute;n</span></td>
          <td><input  name="direc" type="hidden" id="direc" size="20" value="" />
            <input name="direc2" disabled="disabled"  type="text" id="cliente3" size="30" maxlength="200" value="<?=$dircli;?>" />
            <input type="hidden" name="tpago2" value="0"></td>
          <td width="153" bgcolor="#FFFFff"><!--<span class="Estilo15 Estilo57">Total (US$)</span>--></td>
          <td align="right" bgcolor="#FFFFff"><input style="text-align:right; font:bold ; font-size:12px; visibility:hidden" name="total_d" type="text" size="10" readonly value="<?php echo $total_dol; ?>" /></td>
        </tr>
        <tr>
          <td height="21">&nbsp;</td>
          <td><span class="Estilo15">Condici&oacute;n</span></td>
          <td>
		  
		  <?
				echo '<div id="cbo_cond" style="width:">           
					  </div>';

			?> 
		  
		  </td>
          <td style="background-co<!---->lor:#1789DD"><span class="Estilo27 Estilo62">A cuenta</span></td>
          <td align="right" style="background-color:#FFFFFF"><input style="text-align:right; font:bold ; font-size:12px; visibility:hidden" name="acuenta" type="text" size="10" readonly value="0.00"></td>
        </tr>
        <tr>
          <td height="22">&nbsp;</td>
          <td><span class="Estilo15">Fec.Doc. </span></td>
          <td><input name="fecha" type="text" id="fecha" size="9" maxlength="10" value="<?php echo $fecha?>" />
          <button type="reset" id="f_trigger_b" class="Estilo15"  >...</button>
              <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b",   
        singleClick    :    true,           
        step           :    1                
    });
              </script>
            <span class="Estilo15">&nbsp;&nbsp;F.Venc.
            <input name="fecha2" type="text" id="fecha2" size="9" maxlength="10" value="<?php echo $fecha?>" /> 
            <button type="reset" id="f_trigger_b2" class="Estilo15"  >...</button>
              <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha2",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b2",   
        singleClick    :    true,           
        step           :    1                
    });
              </script>
            </span></td>
          <td bgcolor="#FFFFff"><!--<span class="Estilo55">Saldo S/.</span>--></td>
          <td align="right" bgcolor="#FFFFff"><input readonly style="text-align:right; font:bold ; font-size:12px; visibility:hidden" name="pendiente_s" id="pendiente_s" type="text" size="10" value="<?php echo $total_sol;?>"></td>
        </tr>
        <tr>
          <td height="22">&nbsp;</td>
          <td><span class="Estilo15">T.C.</span></td>
          <td><input name="tc"  style="color:#990000; font:bold;  text-align:right"type="text" id="tc" size="4" maxlength="6" value="<?=$_SESSION['tc'];?>" readonly /></td>
          <td bgcolor="#FFFFff"><!--<span class="Estilo55">Saldo US$.</span>--></td>
          <td align="right" bgcolor="#FFFFff"><input readonly style="text-align:right; font:bold ; font-size:12px; visibility:hidden" name="pendiente_d" id="pendiente_d" type="text" size="10" value="<?php echo $total_dol ?>"></td>
        </tr>
        
        <tr>
          <td height="10" colspan="5"></td>
          </tr>
        <tr>
          <td colspan="5" height="5"></td>
          </tr>
        <tr>
          <td height="50" colspan="5" align="center"><table width="511" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td width="507" align="right" bgcolor="#E5E5E5"><label></label>
              <table width="549" height="58" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="158"><span class="Estilo27">T. Pago </span></td>
                  <td width="69"><span class="Estilo27">Numero</span></td>
                  <td width="73"><span class="Estilo27">Soles</span></td>
                  <td width="85"><span class="Estilo27">Dolares</span></td>
                  <td width="97"><span class="Estilo27">Fecha</span></td>
                  <td width="79"><span class="Estilo27">T.Cambio</span></td>
                </tr>
                <tr>
                  <td height="20">  
					
					 <select  id="tpago" name="tpago" onChange="colocar();" >
 <?
 //onFocus="enfocar_tpago()"
//$strSQL="select * from t_pago where codigo='CA' order by id ";		  
$strSQL="select * from t_pago order by id ";	
$resultado=mysql_query($strSQL,$cn);	
while($row=mysql_fetch_array($resultado)){
	echo "<option value=".$row['id'].">".$row['descripcion']."</option>"	;
}
  ?>
</select>                </td>
                  <td><input name="numero_tarjeta" type="text" disabled value="CASH" size="8" maxlength="15"></td>
    <td>
	<input name="soles" type="text" size="8" maxlength="15" value="0"  onFocus="cargar_monto(this)" onKeyPress="c_soles(event,this)">	</td>
                  <td>
				  <input name="dolares" type="text" size="8" maxlength="15" value="0" onKeyPress="c_dolares(event,this)">				  </td>
				  <td><input readonly name="fecha_det_pago" id="fecha_det_pago" type="text" size="8" maxlength="15" value="<?php echo $fecha?>" >
			
			<!--
				  <button type="reset" id="f_trigger_b2"  style="height:18" >...</button>
              
			  <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha_det_pago",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b2",   
        singleClick    :    true,           
        step           :    1                
    });
            </script>
			
-->					    </td>
				  <td><input <?php if($_SESSION['nivel_usu']=='4' || $_SESSION['nivel_usu']=='5'){ echo ""; } else{ echo "readonly"; } ?> name="tcambio_det_pago" id="tcambio_det_pago" type="text" size="8" maxlength="15" value="<?=$_SESSION['tc'];;?>" ></td>
                </tr>
                <tr>
                  <td height="25"><span class="Estilo27">Observaciones:</span></td>
                  <td colspan="5"><input name="obsp" type="text"  size="30" maxlength="30" value="<?php echo $_SESSION['user'] ;?>"></td>
                  </tr>
              </table></td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td colspan="5" height="5"></td>
          </tr>
        <tr>
          <td height="86" colspan="5" valign="top"><div id="pagos_d">
            <table id="tbl_pagos" width="500" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#EFEFEF" bgcolor="#E9E9E9">
  <tr  style="background-color:#1789DD">
    <td width="20" ><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tipo</font></strong></td>
    <td width="70" align="center"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">T.pago</font></strong></td>
    <td align="center" width="80"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">Numero</font></strong></td>
    <td align="center" width="80"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">Soles</font></strong></td>
    <td align="center" width="80"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">T.c</font></strong></td>
    <td align="center" width="80"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">Dolares</font></strong></td>
    <td align="center" width="130"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">Fecha</font></strong></td>
    <td align="center" width="130"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">Obs</font></strong></td>
    <td align="center" width="20"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">E</font></strong></td>
  </tr>
  <?php
  if ( $_SESSION['pagos'][0][0]==1){ //--------------error1-----------------------------
 	 foreach ( $_SESSION['pagos'][0] as $subkey=> $subvalue) { //---- abre
  ?>  
  <tr>
    <td width="112" align="center" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px; color:#333333"><?php echo $_SESSION['pagos'][1][$subkey] ?></font></td>
    <td width="112" align="center" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px;color:#333333">	
	<?php
	$strSQL41="select * from t_pago where id='".$_SESSION['pagos'][2][$subkey]."'";
  $resultado41=mysql_query($strSQL41,$cn);
  $row41=mysql_fetch_array($resultado41);	
  echo $row41['descripcion'];	
	 ?>	 
	 </font><input name="t_pagoT" type="hidden" id="t_pagoT" value="<?php echo $_SESSION['pagos'][2][$subkey]; ?>" size="8" maxlength="10" /></td>
    <td width="112" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px"><?php echo $_SESSION['pagos'][3][$subkey]?></font></td>
    <td width="112" align="right" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px;color:#0A64A7">
      <?php 
	echo number_format($_SESSION['pagos'][4][$subkey],2);
	
	?>
    </font></td>
    <td width="63" align="center" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px;color:#333333"><?php echo $_SESSION['pagos'][5][$subkey] ?></font></td>
    <td width="79" align="right" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px;color:#0A64A7">
      <?php 
	if($_SESSION['pagos'][6][$subkey]!=''){
	echo number_format($_SESSION['pagos'][6][$subkey],2);
	}
	
	?>
    </font></td>
    <td width="80" align="right" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px;color:#333333"><?php echo $_SESSION['pagos'][7][$subkey]?></font> </td>
    <td width="80" align="right" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px;color:#333333"><?php echo $_SESSION['pagos'][8][$subkey]?></font></td>
    <td width="63" align="center" bgcolor="#F4F4F4">
	<a style="cursor:pointer" onClick="javascript:eliminar_pagos('<?php echo $_SESSION['pagos'][0][$subkey] ?>','<?php echo $_SESSION['pagos'][2][$subkey]; ?>','<?php echo $_SESSION['pagos'][7][$subkey]; ?>')"><img src="imgenes/eliminar.gif" width="14" height="14" border="0" /></a>	</td>
  </tr>
  <?php 
  
 if ( $_SESSION['pagos'][0][0]==1){
 	 }//---- cierra
  }
}//-------------------error1--------------------------------
  ?>
</table>
          </div></td>
          </tr>
        <tr>
          <td height="23">&nbsp;</td>
          <td>&nbsp;</td>
          <td align="right">&nbsp;</td>
          <td colspan="2" align="left">&nbsp;</td>
          </tr>
        <tr>
          <td height="40">&nbsp;</td>
          <td><span class="Estilo15"><!--Vuelto en : --></span></td>
          <td align="left"><select name="vueltoen" onChange="calcular_vuelto()" style="visibility:hidden">
            <option value="01">SOLES  (S/.)</option>
            <option value="02">DOLARES (US$)</option>
          </select></td>
          <td colspan="2" align="left"><span class="Estilo27"><span class="Estilo53"><span class="Estilo54">
            <!--Vuelto-->
          </span></span></span> <input name="vuelto" type="text" style="text-align:right; vertical-align:middle; font:bold; font-size:22px; height:40px; visibility:hidden" value="0.00" size="9" readonly></td>
          </tr>
        <tr>
          <td height="19">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><span class="Estilo53">
		  <b>SubTotal<br>	
		  Impuesto1 ( 18 )% <br>
			TOTAL DOC</b></span> </td>
          <td  align="right"><span class="Estilo53">
		  <b><div id="txtST">0.00</div>
		  <div id="txtIGV">0.00</div>
		  <div id="txtT">0.00</div> </b></span></td>
        </tr>
        <tr>
          <td height="19">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2" style="padding-left:65px"><input onClick="insertar('P')" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(imagenes/boton_aplicar.gif) ; cursor:pointer; font:bold; font-size:11px" type="button" name="Submit" value="Imprimir" ></td>
          </tr>
        <tr>
          <td colspan="5"></td>
          </tr>
      </table>
	  <div id="clientes" style="position:absolute; left:67px; top:115px; width:300px; height:180px; z-index:1; visibility:hidden; z-index:1"> </div>
	  
	    <div id="nuevo_cliente" style="position:absolute; left:110px; top:110px; width:400px; height:280px; z-index:1; visibility:hidden; z-index:1"> </div>
      </form>
    </td>
  </tr>
</table>

</body>
</html>
 
<script>

function vaciar_monto(obj){
//obj.value=0;
}

function cargar_monto(obj){
/*
obj.value=document.form1.importe.value;
obj.select();

	if(document.form1.ruc3.value==""){
	document.form1.op.value='TB';
	}else{
	document.form1.op.value='TF';
	}
	
	doAjax('generarnumero.php','operacion='+document.form1.op.value+'&servicio='+document.form1.servicio.value,'gen_numero','get','0','1','','');
*/
}


function colocar(){

//Tipo de Documento a insertar Rk
	if(document.form1.tpago.value==7){
		document.form1.tope.value='C';
	}else{
		document.form1.tope.value='A';
	}	
//------------------

document.form1.numero_tarjeta.disabled="disabled";
	if(document.form1.tpago.value!=1){
		//document.form1.soles.value=document.form1.importe2.value;
		document.form1.tpago2.value=1;
		document.form1.numero_tarjeta.disabled="";
	}
	
}

function enfocar_tpago(){
document.form1.tpago2.value=1;
	if(document.form1.ruc3.value==""){
	document.form1.op.value='B0';
	}else{
	document.form1.op.value='F0';
	}

	doAjax('generarnumero.php','operacion='+document.form1.op.value+'&servicio='+document.form1.servicio.value,'gen_numero','get','0','1','','');
	
}


function c_soles(e,control){
//document.form1.dolares.disabled=true;
control_focus=control;
document.form1.dolares.value=0;
	
	if(e.keyCode == 13){
	
	if(control.value==0 || control.value==''){
	alert("Ingresar un monto");
	control.focus();
	document.form1.dolares.disabled=false;	
	return false;
	}
	
	var tpago=document.form1.tpago.value;
	var numero=document.form1.numero_tarjeta.value;
	var soles=document.form1.soles.value;
	var dolares=document.form1.dolares.value;
	var moneda_v=document.form1.vueltoen.value;
	var tope=document.form1.tope.value;
	var fecha_det_pago=document.form1.fecha_det_pago.value;
	var tcambio_det_pago=document.form1.tcambio_det_pago.value;
	var moneda_doc=document.form1.moneda_doc.value;
	var acuenta=document.form1.acuenta.value;
	document.form1.num_item.value="insert";
	var obsp=document.form1.obsp.value;
	//alert('pagos_det.php?tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares);
doAjax('pagos_det.php','tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares+'&moneda_v='+moneda_v+'&tope='+tope+'&fecha_det_pago='+fecha_det_pago+'&tcambio_det_pago='+tcambio_det_pago+'&moneda_doc='+moneda_doc+'&acuenta='+acuenta+'&obsp='+obsp,'lista_pago','get','0','1','','');
	}
}
function pago_credito(){
//document.form1.num_item.value="insert";
doAjax('pagos_det.php','tpago=1&numero=&soles=0&dolares=Credito&moneda_v=01&tope=A&fecha_det_pago=27-08-2011&tcambio_det_pago=2.7&moneda_doc=02&acuenta=0.00','lista_pago','get','0','1','','');
}

function c_dolares(e,control){
//document.form1.soles.disabled=true;
control_focus=control;
document.form1.soles.value=0;

	if(e.keyCode == 13){	
		if(control.value==0 || control.value=='' ){
			alert("Ingresar un monto");
			//alert(control.name);
			control.select();
			control.focus();			
			document.form1.soles.disabled=false;
			return false;
		}
		
	var tpago=document.form1.tpago.value;
	var numero=document.form1.numero_tarjeta.value;
	var soles=document.form1.soles.value;
	var dolares=document.form1.dolares.value;
	var moneda_v=document.form1.vueltoen.value;
	var tope=document.form1.tope.value;
	var fecha_det_pago=document.form1.fecha_det_pago.value;
	var tcambio_det_pago=document.form1.tcambio_det_pago.value;
	var moneda_doc=document.form1.moneda_doc.value;
	var acuenta=document.form1.acuenta.value;
	document.form1.num_item.value="insert";
	var obsp=document.form1.obsp.value;
	
	//alert('pagos_det.php?tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares);
doAjax('pagos_det.php','tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares+'&moneda_v='+moneda_v+'&tope='+tope+'&fecha_det_pago='+fecha_det_pago+'&tcambio_det_pago='+tcambio_det_pago+'&moneda_doc='+moneda_doc+'&acuenta='+acuenta+'&obsp='+obsp,'lista_pago','get','0','1','','');

	}
}

function cambiar(){
//window.parent.opener.formulario.ruc2.value="0";
//window.focus();
}

function cambiardoc(parametro){

	if(event.keyCode == 13 && parametro==1){
	
	document.form1.tpago.focus();
	
	}else{
	document.getElementById('boleta').style.display="none";
	document.getElementById('factura').style.display="block";
	doAjax('generarnumero.php','operacion=F0&servicio='+document.form1.servicio.value,'gen_numero','get','0','1','','');
	document.form1.op.value='F0';
	}

}

function cambiardoc2(){

/*	if(document.form1.ruc3.value=="" && document.getElementById('factura').style.display=="block"){

	
	document.form1.cliente.value="varios";
	document.form1.direc.value="";
	document.form1.cliente2.value="varios";
	document.form1.direc2.value="";
	
	document.getElementById('factura').style.display="none";
	document.getElementById('boleta').style.display="block";
	doAjax('generarnumero.php','operacion=TB&servicio='+document.form1.servicio.value,'gen_numero','get','0','1','','');
	document.form1.op.value='TB';
	
	}
*/

}


function cambiardoc3(){

/*
document.form1.ruc4.value=0;
	if(document.form1.ruc3.value=="" && document.getElementById('factura').style.display=="block"){
	document.getElementById('factura').style.display="none";
	document.getElementById('boleta').style.display="block";
	doAjax('generarnumero.php','operacion=TB&servicio='+document.form1.servicio.value,'gen_numero','get','0','1','','');
	document.form1.op.value='TB';
	

	//alert(cambio);
	}
*/
}

function cambiardoc4(){

//doAjax('generarnumero.php','operacion=TB&servicio='+document.form1.servicio.value,'gen_numero','get','0','1','','');
//document.form1.op.value='TB';
//document.form1.ruc4.value=1;

}


function elegir(cod,razon,direccion,ruc){

//alert(cod,razon,direccion,ruc);
//var razonn=razon.replace("%","&");
document.form1.cliente.value=cod;
document.form1.ruc3.value=ruc;
document.form1.direc.value=direccion;

document.form1.cliente2.value=razon.replace("%","&");;
document.form1.direc2.value=direccion;


document.getElementById('clientes').style.visibility='hidden';
//document.form1.ter.value=0;
document.getElementById('condicion').style.visibility='visible';
document.getElementById('tpago').style.visibility='visible';
document.getElementById('vueltoen').style.visibility='visible';
document.form1.soles.select();
document.form1.soles.focus();
	
	
	
}


function g_cliente(){

var razon=document.form1.crazonsocial.value;

razon=razon.replace("&","%");

doAjax('guardar_clie.php','&ccodcliente='+document.form1.ccodcliente.value+'&crazonsocial='+razon+'&cpersona='+document.form1.cpersona.value+'&cruc='+document.form1.cruc.value+'&capellido='+document.form1.capellido.value+'&cnombre='+document.form1.cnombre.value+'&cdni='+document.form1.cdni.value+'&cdireccion='+document.form1.cdireccion.value,'guardar_clie','get','0','1','','');

}

function cambiar_fondo(control,evento){

	if(evento=='e')
	control.style.backgroundImage='url(imagenes/boton_aplicar2.gif)';
	else
	control.style.backgroundImage='url(imagenes/boton_aplicar.gif)';

}

function eliminar_pagos(codigo,tipo_p,fechap){

	if(fechap!=document.form1.fecha_det_pago.value){		
		alert('No es posible eliminar pagos de fechas anteriores');		
		return false;
	}

	var respuesta=confirm("confirma que desea eliminar este dato?")
	var acuenta=document.form1.acuenta.value;
	var moneda_doc=document.form1.moneda_doc.value;
	
	
		if(respuesta)
		{
		document.form1.num_item.value="delete";
		doAjax('pagos_det.php','accion=eliminar&cod_pago='+codigo+'&acuenta='+acuenta+'&moneda_doc='+moneda_doc,'lista_pago','get','0','1','','');
	//	alert("eliminando Codigo numero: "+codigo);
		}
		else
		{
			//alert("no se pudo eliminar..");
		}

}



function ver_clientes(){

	var randomnumber=Math.floor(Math.random()*99999);
	Modalbox.show('lista_auxiliar.php?ran='+randomnumber+'&buton=sel_aux', {title: 'Lista de Auxiliares( CLIENTES )', width: 500});return false; 
	
}

function entrada(objeto){

	objeto.cells[0].childNodes[0].checked=true;
	document.form_clientes.cod_aux_sel.value=objeto.cells[1].childNodes[0].innerHTML;
	document.form_clientes.nom_aux_sel.value=objeto.cells[2].childNodes[0].innerHTML;
	document.form_clientes.ruc_aux_sel.value=objeto.cells[3].childNodes[0].innerHTML;
	document.form_clientes.dir_aux_sel.value=objeto.cells[1].childNodes[0].innerHTML;
		
//	temp=objeto;
	if(objeto.style.background=='url(sky_blue_sel.png)'){
//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='url(sky_blue_sel.png)';
		if(temp2!=''){
		//alert(temp.style.background);
		//alert(objeto.bgColor);
		temp2.style.background=temp2.bgColor;
		}
		temp2=objeto;
	}
	
}

function cargar(){
	
		try{
					 
			document.getElementById('lista_aux').rows[0].style.background='url(sky_blue_sel.png)';
			//	alert(document.getElementById('lista_aux').rows[0].style.background);	
			temp2=document.getElementById('lista_aux').rows[0];
			document.getElementById('lista_aux').rows[0].cells[0].childNodes[0].checked=true;
			document.form_clientes.cod_aux_sel.value=document.getElementById('lista_aux').rows[0].cells[1].childNodes[0].innerHTML;
		 } catch(e) { }
		 
}

 function entrar_btn(obj){
		  obj.cells[0].style.backgroundImage="url(imagenes/bordes_boton1.gif)";
		  obj.cells[1].style.backgroundImage="url(imagenes/bordes_boton2.gif)";
		  obj.cells[2].style.backgroundImage="url(imagenes/bordes_boton2.gif)";
		  obj.cells[3].style.backgroundImage="url(imagenes/bordes_boton3.gif)";
		  
 }
  function salir_btn(obj){
		  obj.cells[0].style.backgroundImage="";
		  obj.cells[1].style.backgroundImage="";
		  obj.cells[2].style.backgroundImage="";
		  obj.cells[3].style.backgroundImage="";
		  
 }
	
	
	function cbo_cond(){
	
	var doc=document.form1.op.value;
//	alert(doc);
	doAjax('compras/peticion_datos.php','&doc='+doc+'&peticion=cargar_cond','cargar_cbo_cond','get','0','1','','');
	
	}
	
	function cargar_cbo_cond(texto){
		try{
	document.getElementById('cbo_cond').innerHTML=texto;
		 } catch(e) { }
	}	
	
	function filtrar(){
	//var tipo_aux=document.form1.auxiliar.value;
	var valor=document.form_clientes.valor.value;
	doAjax('peticion_ajax2.php','&valor='+valor+'&peticion=filtrar_clientes','rspta_filtrar','get','0','1','','');
	
	}

	function rspta_filtrar(texto){
	//alert();
	document.getElementById('detalle_aux').innerHTML=texto;
	cargar();
	
	}
	
	function sel_aux(){
	
	if(document.form1.op.value=='F0' && document.form_clientes.ruc_aux_sel.value==''){
	alert(" Este cliente no tiene Ruc ");
	return false;	
	}
	document.form1.cliente.value=document.form_clientes.cod_aux_sel.value;
	document.form1.cliente2.value=document.form_clientes.nom_aux_sel.value;
	document.form1.ruc3.value=document.form_clientes.ruc_aux_sel.value;
	document.form1.ruc3.disabled=true;
	
		if(document.form1.moneda_doc.value=='02'){
		document.form1.dolares.select();
		document.form1.dolares.focus();
		}else{
		document.form1.soles.select();
		document.form1.soles.focus();
		}
	Modalbox.hide(); return false;
	
	}
	
	function enfocar_cbo(){ }
	function limpiar_enfoque(){ }
	function sumarFechaVen(){ }
	
		<?php
 if($_SESSION['verificadorruc']=="S"){
 ?>
function VerificadorRuc(){
	doc=document.form1.op.value;
	if(doc.substring(0,1)=='B'){
		alert("Esta opcion solo funciona con Documentos que exigen ruc ");
		return false;
	}
	var ruc=document.getElementById('ruc_aux').value;
	if(ruc.length==11){
		if(ruc.substring(0,2)>=10 && ruc.substring(0,2)<=20){
			doAjax('compras/peticionxcli.php','&opera=existe&ruc='+ruc,'rpta_validaruc','GET','0','0','','');
		}else{
			alert("Ruc Invalido");
		}
	}else{
		alert('Ruc invalido debe tener 11 digitos');
	}
}

function rpta_validaruc(texto){
	if(texto.substring(0,6)!="<br />"){
		var tempx=texto.split("//");
		if(tempx[0].substring(0,6)=="<br />"){
			var res=confirm("Servidor ocupado en estos momentos desea reintentar?");
			var ruc=document.getElementById('ruc_aux').value;
			doAjax('compras/peticionxcli.php','&opera=existe&ruc='+ruc,'rpta_validaruc','GET','0','0','','');
		}else{
			var temp=tempx[1].split("|");
			if(temp[2]=="A"){
				document.getElementById('ruc_aux').value=temp[0];
				document.getElementById('razonsocial_aux').value=temp[1].replace("&amp;","&");
				//document.getElementById('aux_telef').value=temp[4];
				document.getElementById('direccion_aux').value=temp[3];
				if(tempx[0]=="S"){
					if(confirm("Cliente con Ruc Registrado desea actualizar los datos?")){
						doAjax('compras/peticionxcli.php','&opera=actualiza&ruc='+temp[0]+'&razon='+temp[1].replace("&amp;","amp")+'&telefono='+temp[4]+'&direccion='+temp[3],'rpta_act_val','GET','0','0','','');
					}
				}
			}else{
				if(temp[0]=="/small><br/"){
					alert('Ruc no Existe');
				}else{
					if(temp[0].substring(0,6)=="<br />"){
						var res=confirm("Servidor ocupado en estos momentos desea reintentar?");
						var ruc=document.getElementById('ruc_aux').value;
						doAjax('compras/peticionxcli.php','&opera=existe&ruc='+ruc,'rpta_validaruc','GET','0','0','','');
					}else{
						alert('Ruc en Baja');
					}
				}
			}
		}
	}else{
		alert('Vuelva a intentarlo.Servidor ocupado...');
	}
}
function rpta_act_val(texto){
	var temp=texto.split("|");
	document.form1.cliente.value=temp[0];
	document.form1.cliente2.value=temp[1]; //document.form_clientes.razonsocial_aux.value;
	document.form1.ruc3.value=temp[2]; //document.form_clientes.ruc_aux.value;
	document.form1.direc2.value=temp[4]; //document.form_clientes.direccion_aux.value;
	document.form1.ruc3.disabled=true;
	
	Modalbox.hide();return false;
}
<?php } ?>

	
	function nuevo_auxiliar(){
	//Modalbox.hide();
	//alert();
	var randomnumber=Math.floor(Math.random()*99996);
	Modalbox.show('nuevo_auxiliar.php?ran='+randomnumber, {title: 'Nuevo Auxiliar( CLIENTES )', width: 500});return false; 
	}
	
	function  guardar_aux(){
	
	
	
	var ruc=document.form_clientes.ruc_aux.value;
	var dni=document.form_clientes.dni_aux.value;
	var razon=document.form_clientes.razonsocial_aux.value;
	var contacto=document.form_clientes.contacto_aux.value;
	var direccion=document.form_clientes.direccion_aux.value;
	
			
	var persona=document.form_clientes.persona_aux.value;
	
	if(razon==""){
	alert("Debe Ingresar el nombre del cliente o la razon social");
	return false;
	}
	if(persona=="juridico" && ruc==""){
	alert("Debe Ingresar el número de ruc");
		return false;
	}
	if(persona=="natural" && (ruc=="" && dni=="") ){
	alert("Debe Ingresar el número un número de documento");
	return false;
	}
	
	
	
	var tipo_aux='C';	
	/*
		if(document.formulario.persona[0].checked){
		persona='juridica';	
		}else{
		persona='natural';	
		}
						
		if(tipo_mov==1){
		tipo_aux='P';
		}else{
		tipo_aux='C';	
		}
		//alert(ruc.length);
		if( (doc=="F1" || doc=="FA") && (ruc=="" || ruc.length!=11) ){
			alert('Ingrese un numero de ruc válido');
			document.formulario.aux_ruc.focus();
			return false;
		}else{
					razon=razon.replace('&','amps');//)('&','/&#38;/')
					//alert(razon);
	*/	
	doAjax('compras/peticion_datos.php','&ruc='+ruc+'&dni='+dni+'&razon='+razon+'&contacto='+contacto+'&direccion='+direccion+'&persona='+persona+'&tipo_aux='+tipo_aux+'&peticion=save_aux','rspta_aux','get','0','1','','');
		//}
	
	}
	function rspta_aux() {
	//alert();
	document.form1.cliente.value=document.form_clientes.codigo_aux.value;
	document.form1.cliente2.value=document.form_clientes.razonsocial_aux.value;
	document.form1.ruc3.value=document.form_clientes.ruc_aux.value;
	document.form1.direc2.value=document.form_clientes.direccion_aux.value;
	document.form1.ruc3.disabled=true;
	
	Modalbox.hide();return false;
	
	}
	
	
</script>