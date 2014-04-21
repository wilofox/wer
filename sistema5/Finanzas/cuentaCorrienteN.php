<?php 
session_start();
include("../conex_inicial.php");
include("../funciones/funciones.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Caja Recaudacion</title>
<!--
<link rel="stylesheet" type="text/css" href="css/reset.css" media="all" />-->

<link href="../styles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../css/estilos.css" media="all" />
<script language="javascript" type="text/javascript" src="../javascript/jquery-1.3.2.min.js"></script>
<script language="javascript" type="text/javascript" src="../javascript/csspopup.js"></script>


<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
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
<script language="javascript" src="miAJAXlib3.js"></script>
    <script src="../jquery-1.2.6.js"></script>
    <script src="../jquery.hotkeys.js"></script>
    <link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
	<script type="text/javascript" src="../calendario/calendar.js"></script>
	<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
	<script type="text/javascript" src="../calendario/calendar-setup.js"></script>
<script>

var tempNivelUser="<?php echo $_SESSION['nivel_usu'] ?>";

jQuery(document).bind('keydown', 'f5',function (evt){jQuery('#_up').addClass('dirty');
//	alert('f5');
	var tecla=window.event.keyCode;
  if (tecla==116) {//alert("F5 deshabilitado!")
  event.keyCode=0;
event.returnValue=false;}
return false; });

jQuery(document).bind('keypress', 'return',function (evt){jQuery('#_return').addClass('dirty'); 
/*	if(document.getElementById('auxiliares').style.visibility=='visible'){
		for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
			if(document.getElementById('tblproductos1').rows[i].style.background=='#fcf7e4'){
			
		var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
		elegir(temp);
			}
		}
	}
	*/
	if(document.getElementById('auxiliares').style.visibility=='visible'){
		for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
			//if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb'  || document.getElementById('tblproductos1').rows[i].style.background == 'none repeat scroll 0% 0% rgb(255, 241, 187)' ){
				if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb'  || document.getElementById('tblproductos1').rows[i].style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || document.getElementById('tblproductos1').rows[i].style.background=='rgb(255, 241, 187)' ){
			
				if(navigator.appName!='Microsoft Internet Explorer'){
					var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[1].childNodes[1].innerHTML;
					var temp1=document.getElementById('tblproductos1').rows[i].cells[1].childNodes[0].innerHTML;
					var doc=document.form1.doc.value;
					var ruc=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[0].childNodes[1].childNodes[0].childNodes[3].childNodes[0].innerHTML;
				}else{
					var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
					var temp1=document.getElementById('tblproductos1').rows[i].cells[1].childNodes[0].innerHTML;
					var doc=document.form1.doc.value;
					var ruc=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[0].childNodes[0].childNodes[0].childNodes[1].childNodes[0].innerHTML;
				}

			 	if( (doc=='FA' || doc=='F1') && ruc==""  ){
			 		alert(" Cliente no tiene Ruc ");
			 		return false;
			 	}else{
			 		temp1=temp1.replace('&amp;','&');
			 		elegir(temp,temp1,"",ruc);
			 	}		  

			}
		}
	}
return false; });

/*jQuery(document).bind('keydown', 'up',function (evt){jQuery('#_up').addClass('dirty');
 //alert('ee');
	//document.getElementById('TablaDatos').rows[0].style.background='#FFCC00';
   if(document.getElementById('auxiliares').style.visibility=='visible'){
	
	for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
//	alert(document.getElementById('tblproductos').rows.length);
	if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' && (i!=0) ){
		document.getElementById('tblproductos1').rows[i].style.background=document.getElementById('tblproductos1').rows[i].bgColor;
		document.getElementById('tblproductos1').rows[i-1].style.background='#FFF1BB';
		
			
			location.href="#ancla"+(i-1);
			document.formulario.auxiliar.focus();
			
			if(i%4==0 && i!=0){
			//	capa_desplazar = $('detalle1');
		//	capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y - 60);
			}
			break;
		}
	  }
   }

	
	
//	for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
//	alert(document.getElementById('tblproductos').rows.length);
//		if(document.getElementById('tblproductos1').rows[i].style.background=='#fcf7e4' && (i!=0) ){
//		document.getElementById('tblproductos1').rows[i].style.background='#FFD3B7';
//		document.getElementById('tblproductos1').rows[i-1].style.background='#FCF7E4';
//		break;
//		}
//	}
 return false; });*/

jQuery(document).bind('keyup', 'up',function (evt){jQuery('#_up').addClass('dirty');
	//document.getElementById('TablaDatos').rows[0].style.background='#FFCC00';   
   if(document.getElementById('auxiliares').style.visibility=='visible'){
	
	for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
//	alert(document.getElementById('tblproductos').rows.length);
		//if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' || document.getElementById('tblproductos1').rows[i].style.background == 'none repeat scroll 0% 0% rgb(255, 241, 187)' && (i!=0) ){
		if((document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' || document.getElementById('tblproductos1').rows[i].style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || document.getElementById('tblproductos1').rows[i].style.background=='rgb(255, 241, 187)') && (i!=0) ){	
		document.getElementById('tblproductos1').rows[i].style.background=document.getElementById('tblproductos1').rows[i].bgColor;
		document.getElementById('tblproductos1').rows[i-1].style.background='#FFF1BB';
		
			
			location.href="#ancla"+(i-1);
			document.form1.cliente.focus();
			
			if(i%4==0 && i!=0){
			//	capa_desplazar = $('detalle1');
		//	capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y - 60);
			}
			break;
		}
	  }
   }
         
 return false; });

 /*
jQuery(document).bind('keydown', 'backspace',function (evt){jQuery('#_up').addClass('dirty');
 

 	var tecla=window.event.keyCode;
  if (tecla==8) {//alert("F5 deshabilitado!")
  event.keyCode=0;}
//event.returnValue=false;}

 return false; });
*/
/*jQuery(document).bind('keydown', 'down',function (evt){jQuery('#_down').addClass('dirty');

	for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
	//	alert(document.getElementById('tblproductos').rows.length);
		if(document.getElementById('tblproductos1').rows[i].style.background=='#fcf7e4' && (i!=document.getElementById('tblproductos1').rows.length-1)){
		//alert(document.getElementById('TablaDatos').rows[i].style.background);
		document.getElementById('tblproductos1').rows[i].style.background='#FFD3B7';
		document.getElementById('tblproductos1').rows[i+1].style.background='#FCF7E4';
		break;
		}
		}
 return false; });
*/
jQuery(document).bind('keyup', 'down',function (evt){jQuery('#_down').addClass('dirty');

	if(document.getElementById('auxiliares').style.visibility=='visible'){
 //alert('entro');
	for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
			
		//	alert(document.getElementById('tblproductos').rows.length);
			//if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' || document.getElementById('tblproductos1').rows[i].style.background == 'none repeat scroll 0% 0% rgb(255, 241, 187)' && (i!=document.getElementById('tblproductos1').rows.length-1)){
		if((document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' || document.getElementById('tblproductos1').rows[i].style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || document.getElementById('tblproductos1').rows[i].style.background=='rgb(255, 241, 187)') && (i!=document.getElementById('tblproductos1').rows.length-1)){	
			//alert(document.getElementById('TablaDatos').rows[i].style.background);
			document.getElementById('tblproductos1').rows[i].style.background=document.getElementById('tblproductos1').rows[i].bgColor;
			document.getElementById('tblproductos1').rows[i+1].style.background='#FFF1BB';
			
			if(i%4==0 && i!=0){
			
			location.href="#ancla"+i;
			document.form1.cliente.focus();
			//capa_desplazar = $('detalle1');
			//capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y + 60);
			}
			
			break;
				
			}
		}
 	}
	
	
 return false; });

jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_esc').addClass('dirty'); 

	if(document.getElementById('nuevo_cliente').style.visibility=='hidden'){
	document.getElementById('auxiliares').style.visibility='hidden';
	document.getElementById('condicion').style.visibility='visible';
	document.getElementById('tpago').style.visibility='visible';
	document.form1.cliente.focus();
	//alert("escape");
	}
	if(document.getElementById('nuevo_cliente').style.visibility=='visible'){
	document.getElementById('nuevo_cliente').style.visibility='hidden'
	}
	
return false; });

jQuery(document).bind('keydown', 'insert',function (evt){jQuery('#_esc').addClass('dirty'); 

	//alert("insert");
	if(document.form1.referencia.value!=""){
		//alert("editapago");
		editar_tpago();
	}
	
return false; });

 jQuery(document).bind('keydown', 'f8',function (evt){jQuery('#_f8').addClass('dirty');
 
	 doAjax('lista_aux.php','','listaprod','get','0','1','','');
	 document.getElementById('condicion').style.visibility='hidden';
	 document.getElementById('tpago').style.visibility='hidden';
	// document.formulario.pro.value=0;
//	 document.getElementById('productos').style.visibility='visible';
		 return false; }); 
 
 jQuery(document).bind('keydown', 'f2',function (evt){jQuery('#_f8').addClass('dirty');
 
	 //doAjax('lista_aux.php','','listaprod','get','0','1','','');
	 //document.getElementById('condicion').style.visibility='hidden';
	 //document.getElementById('tpago').style.visibility='hidden';
	// document.formulario.pro.value=0;
//	 document.getElementById('productos').style.visibility='visible';
		if(confirm("Desea Actualizar el saldo en el Documento")){
			guardar_tpago();
		}else{
			alert("Cambios Guardados Temporalmente");
		}
		document.form1.submit();
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
	 
function asignarsuc(dato){
var suc=dato;
document.form1.suc4.value=suc;
}

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
/*

var f = new Date();
		var dia="";
		if(f.getDate()<10){
			dia="0"+f.getDate();
		}else{
			dia=f.getDate();
		}
		var mes="";
		if(f.getMonth()+1<10){
			mes="0"+(f.getMonth()+1);
		}else{
			mes=f.getDate();
		}
		var fecha_acutal=dia + "-" + mes + "-" + f.getFullYear();
	
		var tcond1=(document.form1.cond_ini.value).split("-");
		
		if(document.form1.nivel.value!=4 && document.form1.nivel.value!=5 && document.form1.nivel.value!=11){	
				
				//alert(fecha_acutal+" "+fechap);
				if(fecha_acutal!=fechap){
				alert("No esta autorizado para insertar pagos de fechas anteriores");
				return false;			
				}			
		}	
	*/
}

function lista_pago(texto){
var r = texto;
document.getElementById('pagos_d').innerHTML=r;
document.getElementById('pagos_d').style.visibility='visible';

temp=0;

document.form1.soles.value=0;
document.form1.soles.disabled=false;
document.form1.dolares.value=0;
document.form1.dolares.disabled=false;
document.form1.numero_tarjeta.value="";
var referencia=document.form1.referencia.value;
var mon_doc=document.form1.mone_doc.value;

doAjax('calcular2.php','accion=acuenta&importe='+document.form1.importe.value+'&referencia='+referencia+'&mone_doc='+mon_doc,'calcular_acuenta','get','0','1','','');

}

function calcular_acuenta(texto){

//alert(texto);
var r = texto.split("?");
	if(r[0]<0){
	}else{
		if(r[0]==0){
			document.form1.cargos.value=0.00;	
		}else{
			document.form1.cargos.value=parseFloat(r[0]).toFixed(2);	
		}
	}

	document.form1.total_s.value=parseFloat(r[1]);
		if(document.form1.mone_doc.value=='01'){
			document.form1.total_d.value=Math.round((parseFloat(document.form1.total_s.value)/parseFloat(document.form1.tcact.value))*100)/100;	
		}else{
			document.form1.total_d.value=Math.round((parseFloat(document.form1.total_s.value)*parseFloat(document.form1.tcact.value))*100)/100;
		}
	document.form1.total_d.value=parseFloat(document.form1.total_d.value).toFixed(2);
	document.form1.total_s.value=parseFloat(document.form1.total_s.value).toFixed(2);	

document.form1.acuenta.value=r[2];
document.form1.acuenta.value=parseFloat(document.form1.acuenta.value).toFixed(2);

if(r[3]<0){
	}else{
	if(r[3]==0){
	document.form1.pendiente_s.value=0.00;	
	document.form1.pendiente_d.value=0.00;	
	}else{
	document.form1.pendiente_s.value=parseFloat(r[3]).toFixed(2);
		if(document.form1.mone_doc.value=='01'){
			document.form1.pendiente_d.value=Math.round((r[3]/document.form1.tcact.value)*100)/100;
		}else{
			document.form1.pendiente_d.value=Math.round((r[3]*document.form1.tcact.value)*100)/100;	
		}
	}
	document.form1.pendiente_s.value=parseFloat(document.form1.pendiente_s.value).toFixed(2);
	document.form1.pendiente_d.value=parseFloat(document.form1.pendiente_d.value).toFixed(2);
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
document.getElementById('auxiliares').innerHTML=r;
document.getElementById('auxiliares').style.visibility='visible';
//alert('entro');
//document.form1.txtnombre.focus();
	valor=document.form1.cliente.value;
	var temp='auxiliares';
	var tipomov=document.form1.tipo.value;
	var tienda='';
	//var moneda_doc=document.formulario.tmoneda.value;
	
	//alert(temp_criterio);+'&criterio='+temp_criterio +'&moneda_doc='+moneda_doc
	doAjax('det_aux.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&prov_asoc='+document.form1.prov_asoc.value,'detalle_prod','get','0','1','','');
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
var temp='auxiliares';
var tipomov=document.form1.tipo.value;
if (((e.keyCode>=97) && (e.keyCode<=105)) || ((e.keyCode>=65) && (e.keyCode<=90)) || e.keyCode==8 || e.keyCode==32 ) {
//doAjax('det_aux.php','&nomb_det='+document.form1.txtnombre.value,'detalle_prod','get','0','1','',''); //alert('entro');
//alert('entro');
doAjax('lista_aux.php','&temp='+temp+'&tipomov='+tipomov+'&modulo=tranf','listaprod','get','0','1','','');
}
}

			function rpta_con_datos(texto){
			//alert(texto);
				  if(texto==""){				  			  
				    alert("Documento no Existe");
				  }else{
				  	  	
					 //if(confirm('Este documento tiene proveedores asociados desea seleccionar uno de ellos?')){
					  document.form1.cliente.disabled=false;
					  document.form1.tempauxprod.value='auxiliares';
					  document.form1.prov_asoc.value=texto;
					  
					  doAjax('lista_aux.php','&temp=auxiliares&tipomov='+document.form1.tipo.value+'&modulo=tranf','listaprod','get','0','1','','');
					  
//doAjax('det_aux.php','&clasificacion=1&temp=auxiliares&tipomov='+document.formulario.tipomov.value+'&prov_asoc='+texto,'detalle_prod','get','0','1','','');
					  
					  document.form1.cliente.focus();
//					  document.formulario.doc_ref.disabled=false;
					  //}else{
					   //document.formulario.auxiliar.disabled=false;
					   //document.formulario.auxiliar.focus();
					   //document.formulario.auxiliar.select();
					   //document.formulario.doc_ref.disabled=false;
					 // }
				  }
			}

function detalle_prod(texto){
var r = texto;
document.getElementById('detalle1').innerHTML=r;
document.getElementById('tblproductos1').rows[0].style.background='#fff1bb';

//document.getElementById('productos').style.visibility='visible';
//alert('entro');
//document.formulario.txtnombre.focus();
}

function guardar_clie(texto){
document.getElementById('nuevo_cliente').style.visibility='hidden';
document.getElementById('auxiliares').style.visibility='hidden';

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
//document.form1.op.value='TF';
//alert(texto);

}

function obtener_tc(dato){
	var fecha=dato;
	doAjax('calcular2.php','accion=TC&fecha='+fecha,'colocar_tc','get','0','1','','');
}

function colocar_tc(texto){
document.form1.tcact.value=texto;
document.form1.tcact2.value=texto;
calcular_vuelto(document.form1.pendiente_s.value);
}

function cambiarEnfo(){
	document.form1.serie.focus();
	document.form1.serie.select();
}

function selec_busq(valor1){
	var i;
	for (i=0;i<document.form1.condicion.options.length;i++){
		if (document.form1.condicion.options[i].value==valor1){
			document.form1.condicion.options[i].selected=true;
		}
	}
	
		var f = new Date();
		var dia="";
		if(f.getDate()<10){
			dia="0"+f.getDate();
		}else{
			dia=f.getDate();
		}
		var mes="";
		if(f.getMonth()+1<10){
			mes="0"+(f.getMonth()+1);
		}else{
			mes=f.getMonth()+1;
		}
		var fecha_acutal=dia + "/" + mes + "/" + f.getFullYear();
	
	
		var fdoc=document.form1.fecha.value;
		//alert(fdoc+" "+);
		if(document.form1.nivel.value!=4 && document.form1.nivel.value!=5 && document.form1.nivel.value!=11){	
				//alert(document.form1.nivel.value+" "+fecha_acutal+" "+fdoc);
				if(document.form1.nivel.value==6 && fecha_acutal==fdoc){
				
				document.form1.condicion.disabled=false;	
				
				}else{
				
					if(fecha_acutal!=fdoc){
					//alert();
						document.form1.condicion.disabled=true;		
					}
				
				}
		
				
		 }
		 
	
}

function cambiar_cond(control){
	var tcond2=(control.value).split("-");
	var tcond1=(document.form1.cond_ini.value).split("-");
	if(tcond1[1]=="S" && tcond2[1]=="N"){
		//alert("Cambio no Autorizado...");
		if(parseFloat(document.form1.pendiente_s.value)>0){
		alert("No es posible cambiar a CONTADO porque existe un saldo pendiente.");
		selec_busq(document.form1.cond_ini.value);
		}else{
		
		}
		//
	}
	
	
}

function cbo_cond(){
	//alert(document.form1.suc4.value);
	if(document.form1.suc4.value!=""){
		var user="<?php echo $_SESSION['codvendedor'];?>";
		var emp=document.form1.suc4.value;
		var doc=document.form1.doc.value;
		var tip="<?php echo $_REQUEST['tipo'];?>";
		if(doc!="-"){			
			doAjax('operaciones.php','&doc='+doc+'&tipo='+tip+'&suc='+emp+'&user='+user+'&Modulo=Creditos&accionx=numero','rpta_serie','get','0','1','','');			
		}else{
			alert("Seleccione un documento");
		}
	}else{
		alert('Debe tener una Empresa seleccionada');
	}
}

function rpta_serie(texto){
	//alert(texto);
	if(texto!=""){
		document.form1.serie.value=texto;
		document.form1.serie.readOnly=true;
		document.form1.numero.focus();
		document.form1.numero.select();
	}else{
		document.form1.serie.focus();
		document.form1.serie.select();
	}
	cbo_cond2();
}

function cbo_cond2(){	
	var doc=document.form1.doc.value;
	var niv=document.form1.nivel.value;
	doAjax('operaciones.php','&doc='+doc+'&niv='+niv+'&Modulo=Creditos&accionx=condiciones','cargar_cbo_cond2','get','0','1','','');
		
}

function cargar_cbo_cond2(texto){
//alert(texto);
	document.getElementById('cbo_cond').innerHTML=texto;	
			
}

function salir(){
	document.getElementById('auxiliares').style.visibility='hidden';
}

function b_cuenta(texto){

	var cadena=texto.split("|||");
	
if(cadena[6]!='A' && cadena[5]!=''){
	//alert(texto);
	document.form1.ruc3.value=cadena[0];
	document.form1.cliente.value=cadena[7];
	document.form1.cliente2.value=cadena[1];
	document.form1.importe.value=cadena[2];
	document.form1.tc.value=cadena[3];
	document.form1.fecha.value=cadena[4];
	document.form1.referencia.value=cadena[5];
	//document.form1.total_s.value=cadena[2];
	
	document.form1.txtrespon.value=cadena[8];
	document.form1.fecha2.value=cadena[10];
	document.form1.mone_doc.value=cadena[9];
	//document.form1.total_d.value=Math.round((cadena[2]/cadena[3])*100)/100 ;
	document.form1.moneorigen.value=cadena[9];
	var co=cadena[11].split("-");
	if(co[1]==''){
		document.form1.cond_ini.value=co[0]+"-N";
	}else{
		document.form1.cond_ini.value=cadena[11];
	}
	//alert(co[1]);
	selec_busq(cadena[11]);
	if(cadena[9]=='02'){
		document.getElementById('mon_document').innerHTML='Importe US$.';
		document.getElementById('total_tdoc').innerHTML='Total(US$.)';
		document.getElementById('saldos').innerHTML='Saldo(US$.)';
		document.getElementById('saldod').innerHTML='Saldo(S/.)';
	}else{
		if(cadena[9]=='01'){
			document.getElementById('mon_document').innerHTML='Importe S/.';
			document.getElementById('total_tdoc').innerHTML='Total(S/.)';
			document.getElementById('saldos').innerHTML='Saldo(S/.)';
			document.getElementById('saldod').innerHTML='Saldo(US$.)';
		}else{
			document.getElementById('mon_document').innerHTML='Importe';
			document.getElementById('total_tdoc').innerHTML='Total';
			document.getElementById('saldos').innerHTML='Saldo';
			document.getElementById('saldod').innerHTML='Saldo';
		}
	}
	document.form1.cancelar.disabled=false;
	var tcond1=(document.form1.cond_ini.value).split("-");
	
doAjax('lista_pago_cuenta.php','referencia='+cadena[5]+'&deuda='+tcond1[1],'lista_pago','get','0','1','','');

}else{
	if(cadena[6]=='A'){
		alert('Este Documento se encuentra Anulado');
	}else{
		alert('Documento no Existe');
	}
//location.href="cuentaCorrienteN.php";
document.form1.submit();
}

}
function cargar_docs(auxiliar){
	var texto=auxiliar.split(',');
	var aux=texto[0];
	var tipo=texto[1];

var tipomov=document.form1.tipo.value;

var suc=document.form1.suc4.value;
	
	window.open('add_docs_deuda.php?auxiliar='+aux+'&tipomov='+tipo+'&sucursal='+suc,'ventana','width=500,height=300,top=300,left=300,scroolbars=no,directories=no,location=no,menubar=no,titlebar=no,toolbar=no,status=yes');		
		
}
</script>

<?php 
	$tip=$_REQUEST['tipo'];
	if($tip=='1'){
		$aux="Proveedores";
		$titulo="Cuentas Proveedores :: Pago Cuentas ";
	}else{
		$aux="Clientes";
		$titulo="Cr&eacute;ditos y Cobranzas :: Cobranza Cuentas ";
	}
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
window.parent.opener.form1.ruc2.value="0";
}

function validarfecha(fecha){


	var fdoc=document.form1.fecha.value;
	
	if(!compare_dates(fdoc,fecha)){	
	//if(fdoc<=fecha){
		obtener_tc(fecha);
	}else{
		alert("Fecha de pago no puede ser menor a la Fecha del documento");
		var fact="<?php echo date('d/m/Y'); ?>";
		document.form1.fechadp.value=fact;
		return false;
	}
}
</script>
<body onLoad="enfocar();" onBlur="cambiar();">
  <div id="capaPopUp" style="z-index:1;filter:alpha(opacity=40);-moz-opacity:.60;opacity:.60"></div>
    <div id="popUpDiv">
       <div id="capaContent">
           <table>
  <tr>
    <td colspan="3" style="font:Arial, Helvetica, sans-serif; color:#CC6600; font-size:12px"><strong>ELIMINACION DE DOCUMENTO</strong></td>

  </tr>
  <tr>
    <td width="1">&nbsp;</td>
    <td width="325" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#003366">  <strong>Ingrese El Motivo por el cual Desea Anular este Documento</strong></td>
    <td width="6">&nbsp;</td>
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
   <table width="810" height="425" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
   <tr>
       <td width="5" bgcolor="#FFFFFF">   
       <td width="656" height="27" style="background:url(../imagenes/white-top-bottom.gif); border:#999999"><span class="Estilo1">Finanzas :: <?php echo $titulo.$aux?> </span></td> 
       <td style="background:url(../imagenes/white-top-bottom.gif)"></td>    </tr>
     <tr>
       <td height="277" colspan="2" valign="top"><form id="form1" name="form1" method="post" action="" >
         <table width="660" height="390" border="0" cellpadding="0" cellspacing="0">
           <tr bgcolor="#6699CC">
             <td rowspan="3" bgcolor="#FFFFFF">&nbsp;</td>
             <td height="67" rowspan="3" bgcolor="#004993">&nbsp;</td>
             <td height="26" bgcolor="#004993"><span class="Estilo25">Empresa</span></td>
             <td colspan="2" valign="middle" bgcolor="#004993"><?php 
		  $se="";
		  $di="";
				  $SQL34="Select * from sucursal";
				  $consult1=mysql_query($SQL34,$cn);
				  while($row34=mysql_fetch_array($consult1)){
					if($row34['cod_suc']==$_SESSION['user_sucursal']){
        		        $se="selected";
						$di="disabled='true'";
					}	
				  }
			?>
               <input type="hidden" name="suc4" id="suc4" value="<?php echo $_SESSION['user_sucursal'];?>">
               <select <?php echo $di?> name="suc" id="suc" style="font:Verdana, Arial, Helvetica, sans-serif; font-size:10px" onChange="asignarsuc(this.value)">
                 <option value="0"> Seleccione Empresa</option>
                 <?php 
				  $SQL34="Select * from sucursal";
				  $consult1=mysql_query($SQL34,$cn);
				  while($row34=mysql_fetch_array($consult1)){
			  ?>
                 <option <?php
			if($row34['cod_suc']==$_SESSION['user_sucursal']){
				echo $se;
			}
			?>
             value="<?php echo $row34['cod_suc']; ?>"> <?php echo $row34['des_suc']; }?></option>
               </select></td>
             <td align="right" colspan="2" bgcolor="#004993"><input  name="importe2" type="hidden" id="importe2" size="10" value="<?php echo number_format($total,2);?>" />
               <input type="hidden" name="mone_doc" id="mone_doc" value="">
               <input  name="direc" type="hidden" id="direc" size="10" value="" />
               <input type="hidden" name="cliente2" value="">
               <input style="text-align:right; font:bold" name="total_d" id="total_d" type="hidden" size="10" readonly value="<?php 
			echo $mon;
			$tc=$_SESSION['tc'];
			if($mon=='01'){
		  	echo number_format($total*$tc,2);
		  }else{
			  echo number_format($totals/$tc,2);
		  }		  
		  ?>" />
               <input name="mesa2" type="hidden" id="mesa2" size="10" maxlength="10" value="<?php echo $_REQUEST['mesa']?>">
               <input name="registro2" type="hidden" size="10" maxlength="10" value="<?php echo $_REQUEST['registro']?>">
               <input name="servicio2" type="hidden" size="5" maxlength="5" value="<?php echo $servicio?>">
               <input type="hidden" value="" name="auxiliar2" id="auxiliar2" size="6">
               <input name="nivel" type="hidden" id="nivel" value="<? echo $_SESSION['nivel_usu']?>" size="5" maxlength="5">
               <input name="suc3" type="hidden" id="suc3" value="<? echo $_SESSION['user_sucursal']?>" size="5" maxlength="5"></td>
             <td bgcolor="#004993"><input name="tempauxprod" type="hidden" value="auxiliares" size="15" />
               <input name="prov_asoc" type="hidden" value="" size="40" />
               <input name="tipo" id="tipo" type="hidden" value="<?php echo $_REQUEST['tipo']?>" size="5" />
               <input name="moneorigen" id="moneorigen" type="hidden" value="<?php echo $_REQUEST['tipo']?>" size="5" /></td>
             <td width="5" rowspan="3" align="left" bgcolor="#FFFFFF">&nbsp;</td>
           </tr>
           <tr bgcolor="#6699CC">
             <td height="24" bgcolor="#004993"><span class="Estilo25">Documento</span></td>
             <td colspan="2" valign="middle" bgcolor="#004993">
             <?php //echo $_SESSION['user_sucursal'];
			 /*$wherex="";
			   if($_SESSION['user_sucursal']!="" || $_SESSION['user_sucursal']!="0" ){
				   $wherex="and empresa='".$_SESSION['user_sucursal']."'";
			   }
			   echo $SQL32="Select * from docuser inner join operacion op on op.codigo=docuser.doc where substr(op.p1,5,1)='S' and op.tipo='".$tip."' and usuario='".$_SESSION['codvendedor']."' $wherex";*/
			   ?>
             <select name="doc" id="doc" style="font:Verdana, Arial, Helvetica, sans-serif; font-size:10px" onChange="cbo_cond()">
               <?php /*  <option value="TB">Ticket Boleta</option>
              <option value="TF">Ticket Factura</option>
			  <option value="BV">Boleta de Venta</option>
			  <option value="FA">Factura de Venta</option>
			</select>*/ ?>
            <option value="-">Seleccione Documento</option>
               <?php 
			   $wherex="";
			   if($_SESSION['user_sucursal']!="" && $_SESSION['user_sucursal']!="0" ){
				   $wherex="and empresa='".$_SESSION['user_sucursal']."'";
				   $SQL32="Select * from docuser inner join operacion op on op.codigo=docuser.doc where substr(op.p1,5,1)='S' and op.tipo='".$tip."' and usuario='".$_SESSION['codvendedor']."' and tipomov='".$_REQUEST['tipo']."' $wherex";
			   
			   }else{
			   		$SQL32="Select * from operacion  where substr(p1,5,1)='S' and tipo='".$tip."' ";
			   
			   }
			   
				  //$SQL32="Select * from operacion where substr(p1,5,1)='S' and tipo='".$tip."'";
				  $consult=mysql_query($SQL32,$cn);
				  while($row32=mysql_fetch_array($consult)){
			  ?>
               <option value="<?php echo $row32['codigo']; ?>"> <?php echo $row32['descripcion']; }?></option>
             </select>
			 <?php //echo $SQL32; ?>

               <input name="referencia" type="hidden" size="5" maxlength="5" ><input type="hidden" name="cond_ini" id="cond_ini" value=""></td>
             <td align="right" colspan="2" bgcolor="#004993"><span class="Estilo25"> T.C. Actual&nbsp;&nbsp;&nbsp;</span></td>
             <td bgcolor="#004993"><input name="tcact" readonly type="text" id="tcact" value="<?php echo $_SESSION['tc_promedio'];?>" size="10" maxlength="10" onFocus="cambiarEnfo()"></td>
           </tr>
           <tr bgcolor="#6699CC">
             <td height="26" bgcolor="#004993"><span class="Estilo25">N&uacute;mero</span></td>
             <td colspan="2" bgcolor="#004993"><input name="mesa" type="hidden" id="mesa" size="10" maxlength="10" value="<?php echo $_REQUEST['mesa']?>">
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
			
               <input name="numero" type="text" id="numero" size="10" maxlength="11" onKeyPress="cargar_cuenta(event)" value=""/>
			   
			   </td>
             <td width="144" align="left" bgcolor="#004993">&nbsp;</td>
             <td bgcolor="#004993" class="Estilo25"><div id="mon_document" class="Estilo25">Importe US$.</div></td>
             
             <td width="87" align="left" bgcolor="#004993"><input  style="text-align:right; font:bold" readonly  name="importe" type="text" id="importe" size="10" value="<?php echo number_format($total,2); ?>" /></td>
           </tr>
           <tr>
             <td>&nbsp;</td>
             <td height="22">&nbsp;</td>
             <td><span class="Estilo15">Ruc:</span></td>
             <td colspan="2"><input readonly name="ruc3" type="text" id="ruc3" size="10" maxlength="11" /></td>
             <td align="left">&nbsp;</td>
             <td align="left" bgcolor="#FFFF99" class="Estilo15">Cargos</td>
             <td align="left" bgcolor="#FFFF99"><input style="text-align:right; font:bold" name="cargos" id="cargos" type="text" size="10" readonly></td>
             <td align="left">&nbsp;</td>
           </tr>
           <tr>
             <td width="6">&nbsp;</td>
             <td width="5" height="23">&nbsp;</td>
             <td width="91"><span class="Estilo15"><?php echo $aux; ?></span></td>
             <td colspan="2"><label for="textfield"></label>
               <!--       <input readonly="readonly" name="ruc3" type="text" id="ruc3" size="10" maxlength="11" onChange="cambiardoc2()" onKeyPress="cambiardoc();" onBlur="cambiardoc3()"  onFocus="cambiardoc4()"/>-->
               <input name="cliente" readonly  type="text" id="cliente" size="35" maxlength="75" value="" /></td>
             <td><span class="Estilo14">
               <input style="height:17px" type="button" id="cancelar" name="cancelar" disabled onClick="cargar_docs(document.form1.cliente2.value+','+document.form1.tipo.value)" value="Ver Pendientes..." />
             </span></td>
             <td width="97" bgcolor="#FFFF99"><div id="total_tdoc" class="Estilo15">Total(S/.)</div></td>
             <td bgcolor="#FFFF99"><input style="text-align:right; font:bold" name="total_s" id="total_s" type="text" size="10" readonly value="<?php 
		  echo number_format($total,2);
		  ?>" /></td>
             <td valign="bottom">&nbsp;</td>
           </tr>
           <tr>
             <td height="23">&nbsp;</td>
             <td>&nbsp;</td>
             <td ><span class="Estilo15">Condici&oacute;n</span></td>
             <td width="140"><div id="cbo_cond">
			 
			 
             <select style="width:130" disabled='disabled' name="condicion" id="condicion">
               <?php
				$StrCondi="Select * from condicion";
				$conCondi=mysql_query($StrCondi,$cn);
				while($rowcondi=mysql_fetch_array($conCondi)){
			?>
               <option value="<?php echo $rowcondi['codigo']; ?>"><?php echo $rowcondi['nombre']; } ?></option>
             </select></div></td>
             <td><span class="Estilo15">&nbsp;T.C.Doc.</span></td>
             <td><span class="Estilo15">
               <input readonly name="tc"  style="color:#990000; font:bold ; text-align:right"type="text" id="tc" size="5" maxlength="6" value="<?php echo $tc_doc;?>" />
             </span></td>
             <td bgcolor="#FFFF99"><span class="Estilo15">A cuenta</span></td>
             <td bgcolor="#FFFF99"><input style="text-align:right; font:bold" name="acuenta" type="text" size="10" readonly></td>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td>&nbsp;</td>
             <td height="22">&nbsp;</td>
             <td><span class="Estilo15">Respon.</span></td>
             <td colspan="2"><input name="txtrespon" readonly  type="text" id="txtrespon" size="20" maxlength="50" value="" /></td>
             <td >&nbsp;</td>
             <td bgcolor="#FFFF99"><div class="Estilo30" id="saldos">Saldo(S/.)</div></td>
             <td bgcolor="#FFFF99"><input readonly style="text-align:right; font:bold" name="pendiente_s" type="text" size="10"></td>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td>&nbsp;</td>
             <td height="23">&nbsp;</td>
             <td align="center"><span class="Estilo15">Fec. Doc.</span></td>
             <td><span class="Estilo15">
               <input readonly name="fecha" type="text" id="fecha" size="10" maxlength="10" value="<?php echo $fecha?>" />
             </span></td>
             <td width="87"><span class="Estilo15">Fec. Venc.</span></td>
             <td><span class="Estilo15">
               <input readonly name="fecha2" type="text" id="fecha2" size="10" maxlength="10" value="<?php echo $fecha?>" />
             </span></td>
             <td bgcolor="#FFFF99"><div class="Estilo30" id="saldod">Saldo(US$.)</div></td>
             <td bgcolor="#FFFF99"><input readonly style="text-align:right; font:bold" name="pendiente_d" type="text" size="10"></td>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td height="19">&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td colspan="2"><span class="Estilo15">&nbsp;&nbsp;</span></td>
             <td>&nbsp;</td>
             <td colspan="3">&nbsp;</td>
           </tr>
           <tr>
             <td height="17" colspan="9" align="center"><table id="tabla_pago" style="display:none" width="662" border="1" cellpadding="0" cellspacing="0">
               <tr bgcolor="#004993">
                 <td width="658" align="left" bgcolor="#D8D8D8"><table width="654" height="51" border="0" cellpadding="0" cellspacing="0">
                   <tr>
                     <td width="50" align="center"><span class="Estilo27">T. Ope </span></td>
                     <td width="122" align="center"><span class="Estilo27">T. Pago </span></td>
                     <td width="72" align="center"><span class="Estilo27">N&uacute;mero</span></td>
                     <td width="57" align="center"><span class="Estilo27">Soles</span></td>
                     <td width="57" align="center"><span class="Estilo27">D&oacute;lares</span></td>
                     <td width="105" align="center"><span class="Estilo27">Fecha</span></td>
                     <td width="51" align="center"><span class="Estilo27">T.C.</span></td>
                     <td width="140" align="center"><span class="Estilo27">Obs.</span></td>
                   </tr>
                   <tr>
                     <td height="20" align="center"><select style="width:50" disabled="disabled" id="tope" name="tope" onChange="colocar();">
                       <option value="A" selected="selected">A - Abono</option>
                       <option value="C">C - Cargo</option>
                     </select>
                     <td height="35" align="center"><select style="width:120" disabled="disabled" id="tpago" name="tpago" onChange="colocar();">
                       <?php 
                      	$SQL33="Select * from t_pago";
				  		$consult2=mysql_query($SQL33,$cn);
				  		while($row33=mysql_fetch_array($consult2)){
					  ?>
                       <option value="<?php echo $row33['id']; ?>"><?php echo $row33['descripcion']; }?></option>
                     </select></td>
                     <td align="center"><input style="width:70" disabled="disabled" name="numero_tarjeta" type="text" size="10" maxlength="15" ></td>
                     <td align="center"><input disabled="disabled" style="width:50" name="soles" type="text" size="10" maxlength="15" value="0" onKeyup="c_soles(event)"></td>
                     <td align="center"><input style="width:50" disabled="disabled" name="dolares" type="text" size="10" maxlength="15" value="0" onKeyup="c_dolares(event)" ></td>
                     <td align="center">
					 
					 <input name="fechadp" id="fechadp" type="text" size="10" maxlength="10" value="<?php echo date('d/m/Y')?>"  onKeyUp="" onChange="validarfecha(this.value)" >
					 
					 
                       <button type="reset" id="f_trigger_b1" style="height:18; vertical-align:top" >...</button>
                       <script type="text/javascript">
					Calendar.setup({
        			inputField     :    "fechadp",      
        			ifFormat       :    "%d/%m/%Y",      
        			showsTime      :    false,            
        			button         :    "f_trigger_b1",   
        			singleClick    :    true,           
        			step           :    1                
    				});
            	</script></td>
                     <td align="center">
					 <input <?php if($_SESSION['nivel_usu']!='4' && $_SESSION['nivel_usu']!='5'){ echo "readonly";} ?> style="width:40" name="tcact2" type="text" id="tcact2" value="<?php echo $_SESSION['tc_promedio'];?>" size="7" maxlength="10">
					 
                     <td align="center">
					 <textarea style="width:130; height:30" name="obs" id="obs" cols="50" rows="3"></textarea>
                     </tr>
                 </table></td>
               </tr>
             </table></td>
           </tr>
           <tr>
             <td height="19">&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td colspan="2">&nbsp;</td>
             <td>&nbsp;</td>
             <td colspan="3">&nbsp;</td>
           </tr>
           <tr>
             <td height="19" colspan="9"><div id="pagos_d"></div></td>
           </tr>
           <tr>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td colspan="2" align="right">&nbsp;</td>
             <td colspan="4" align="left"><span class="Estilo27">&nbsp;&nbsp;&nbsp;&nbsp;</span>
               <input style="text-align:right; font:bold" name="vuelto" type="hidden" size="7" readonly></td>
           </tr>
           <tr>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td colspan="7" class="Estilo28"><em>Nota:<span class="Estilo15"> Los Cambios se guardan automaticamente (Las Condiciones y saldos se actualizan con F2)</span></em></td>
            </tr>
           <tr>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td colspan="2">&nbsp;</td>
             <td>&nbsp;</td>
             <td colspan="3">&nbsp;</td>
           </tr>
           <tr>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td colspan="2">&nbsp;</td>
             <td>&nbsp;</td>
             <td colspan="3">&nbsp;</td>
           </tr>
         </table>
         <div id="auxiliares" style="position:absolute; left:130px; top:114px; width:300px; height:180px; z-index:1; visibility:hidden; z-index:1"> </div>
         <div id="nuevo_cliente" style="position:absolute; left:110px; top:110px; width:400px; height:280px; z-index:1; visibility:hidden; z-index:1"> </div>
         <div id="motivo" style="position:absolute; left:110px; top:110px; width:400px; height:280px; z-index:1; visibility:hidden; z-index:1"> </div>
       </form></td>
       <td width="154" colspan="-3" valign="top"><table width="130" height="151" border="0" cellpadding="0" cellspacing="0"  style="vertical-align:top">
         <tr valign="top">
           <td width="125" height="34" align="center" valign="top">&nbsp;</td>
         </tr>
         <tr>
           <td align="center" valign="top"><input type="hidden" name="guardar" value="<a style=cursor:pointer id=abrirPop href=javascript:void(0);><img src=imgenes/anular.gif width=50 height=51 border=0></a><br>
          <span class=Estilo28>ANULAR DOCUMENTO </span>"></td>
         </tr>
         <tr>
           <td align="center" valign="top">&nbsp;</td>
         </tr>
         <tr>
           <td align="center" valign="top"><a onClick="editar_tpago()" style="cursor:pointer"><img src="imgenes/editar_tpago.gif" width="50" height="44"></a><br>
             <span class="Estilo28">AGREGAR PAGOS [Insert]</span></td>
         </tr>
         <tr>
           <td align="center" valign="top">&nbsp;</td>
         </tr>
         <!--   <tr>
        <td align="center" valign="top">
		
		<a onClick="guardar_tpago()" style="cursor:pointer"><img src="imgenes/revert.png" width="35" height="35"></a>
		
		</td>
      </tr>
      <tr>
        <td align="center" valign="top"><span class="Estilo28">ACTUALIZAR SALDOS [F2]<BR></span></td>
      </tr>-->
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
	if(document.form1.suc4.value!=0){
		var suc=document.form1.suc4.value;
	}else{
		var suc=document.form1.suc3.value;
	}
	if(suc==0){
		alert("Selecciones una Suscursal");
		document.form1.suc.focus();
		return false;
	}
	//alert(suc);
var num=document.form1.numero.value;
var serie=document.form1.serie.value;
var doc=document.form1.doc.value;

	if(e.keyCode == 13){
	var numero=ponerCeros(num,7);
	document.form1.numero.value=numero;
		if(document.form1.tipo.value==2){
			doAjax('b_cuenta.php','serie='+serie+'&numero='+numero+'&doc='+doc+'&suc='+suc+'&tipo='+document.form1.tipo.value,'b_cuenta','get','0','1','','');
		}else{
			doAjax('../compras/peticion_datos.php','&serie='+serie+'&numero='+numero+'&doc='+doc+'&sucursal='+suc+'&peticion=buscar_prov&tipomov='+document.form1.tipo.value,'rpta_con_datos','get','0','1','','');
		}
	}
	
	
}

function colocar(){
	if(document.form1.tpago.value!=1){
		document.form1.soles.value=document.form1.importe2.value;
	}
}

var temp=0;

function c_soles(e){

document.form1.dolares.disabled=true;

	if(e.keyCode == 13){
	//*********************************** validacion de niveles y fecha *******************
		var f = new Date();
		var dia="";
		if(f.getDate()<10){
			dia="0"+f.getDate();
		}else{
			dia=f.getDate();
		}
		var mes="";
		if(f.getMonth()+1<10){
			mes="0"+(f.getMonth()+1);
		}else{
			mes=(f.getMonth()+1);
			//alert(mes);
		}
		
		var fecha_acutal=dia + "/" + mes + "/" + f.getFullYear();
	
	
	var tcond1=(document.form1.cond_ini.value).split("-");
	var fechap=document.form1.fechadp.value;
	
	if(tcond1[1]=='S'){
		
		if(document.form1.nivel.value!=4 && document.form1.nivel.value!=5 && document.form1.nivel.value!=11){	
				
				//alert(fecha_acutal+" "+fechap);
				if(fecha_acutal!=fechap){
				alert("Solo es posible insertar pagos de la fecha actual");
				return false;			
				}			
		}	
	}else{
	alert("No es posible insertar pagos en documentos al contado. ")
	return false;
	
	}
	
	//*********************************************************************************
	
	
		if(document.form1.soles.value!=0){
			var tipo=document.form1.tope.value;
			var tc=document.form1.tcact2.value;
			var fecha=document.form1.fechadp.value;
			var tpago=document.form1.tpago.value;
			var numero=document.form1.numero_tarjeta.value;
			var soles=parseFloat(document.form1.soles.value);
			var dolares=parseFloat(document.form1.dolares.value);
			var referencia=document.form1.referencia.value;
			/*
			if(document.getElementById('saldos').innerHTML=='Saldo(S/.)'){
				var saldo=parseFloat(document.form1.pendiente_s.value);
			}else{
				var saldo=parseFloat(document.form1.pendiente_d.value);
			}
			*/		
			
			//if(document.form1.moneorigen.value == '01'){
					
			//}else{
						
			var saldo=(parseFloat(document.form1.importe.value)+parseFloat(document.form1.cargos.value)-parseFloat(document.form1.acuenta.value)).toFixed(2);			
			
			//}
			//alert(document.form1.importe.value+"+"+document.form1.cargos.value+"-"+document.form1.acuenta.value);
			//alert(tipo);
			
			if(tipo=='A'){
				//alert(document.form1.moneorigen.value);
				if(document.form1.moneorigen.value == '01'){
					//alert(saldo+"-"+soles);
					var saldof=(parseFloat(saldo)-parseFloat(soles)).toFixed(2);
				}else{
					var saldof=(parseFloat(saldo)-(parseFloat(soles)/parseFloat(tc)).toFixed(2));				
				}
								
			}else{
				if(soles > saldo){
					//alert(parseFloat(saldo));
				var saldof=(parseFloat(soles)+parseFloat(saldo)).toFixed(2);
				}else{
					//alert(parseFloat(saldo));
					var saldof=(parseFloat(saldo)+parseFloat(soles)).toFixed(2);
				}
			}
			
			//alert(saldof);
			
			if(saldof>=0){
				var obs=document.form1.obs.value;
				temp=1;
				var tcond1=(document.form1.cond_ini.value).split("-");
				
				doAjax('lista_pago_cuenta.php','referencia='+referencia+'&tpago='+tpago+'&tc='+tc+'&tipo='+tipo+'&fecha='+fecha+'&numero='+numero+'&soles='+soles+'&dolares='+dolares+'&accion=insertar&obs='+obs+'&deuda='+tcond1[1],'lista_pago','get','0','1','','');
			}else{
				alert("No es posible insertar este movimiento Importe mayor a Saldo Pendiente");
				document.form1.soles.value=0;
				document.form1.dolares.disabled=false;
				document.form1.soles.focus();
				document.form1.soles.select();
			}
		}else{
			alert("Ingrese Monto Valido");
			document.form1.dolares.disabled=false;
			document.form1.soles.focus();
			document.form1.soles.select();
		}
//	var moneda_v=document.form1.vueltoen.value;
	//alert('pagos_det.php?tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares);
	
//doAjax('lista_pago_cuenta.php','referencia='+referencia+'&tpago='+tpago+'&tc='+tc+'&tipo='+tipo+'&fecha='+fecha+'&numero='+numero+'&soles='+soles+'&dolares='+dolares+'&accion=insertar','lista_pago','get','0','1','','');

	}

}

function c_dolares(e){
document.form1.soles.disabled=true;

	if(e.keyCode == 13){
	//*********************************** validacion de niveles y fecha *******************
			var f = new Date();
		var dia="";
		if(f.getDate()<10){
			dia="0"+f.getDate();
		}else{
			dia=f.getDate();
		}
		var mes="";
		if(f.getMonth()+1<10){
			mes="0"+(f.getMonth()+1);
		}else{
			mes=(f.getMonth()+1);
		}
		var fecha_acutal=dia + "/" + mes + "/" + f.getFullYear();
	
	
	var tcond1=(document.form1.cond_ini.value).split("-");
	var fechap=document.form1.fechadp.value;
	
	if(tcond1[1]=='S'){
		
		if(document.form1.nivel.value!=4 && document.form1.nivel.value!=5 && document.form1.nivel.value!=11){	
				
				//alert(fecha_acutal+" "+fechap);
				
				if(fecha_acutal!=fechap){
				alert("Solo es posible insertar pagos de la fecha actual");
				return false;			
				}			
		}	
	}else{
	alert("No es posible insertar pagos en documentos al contado. ")
	return false;
	
	}
	
	//*********************************************************************************
	
		if(document.form1.dolares.value!=0){
			var tipo=document.form1.tope.value;
			var tc=document.form1.tcact2.value;
			var fecha=document.form1.fechadp.value;
			var tpago=document.form1.tpago.value;
			var numero=document.form1.numero_tarjeta.value;
			var soles=parseFloat(document.form1.soles.value);
			var dolares=parseFloat(document.form1.dolares.value);
			var referencia=document.form1.referencia.value;
//	var moneda_v=document.form1.vueltoen.value;
	//alert('pagos_det.php?tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares);
//doAjax('lista_pago_cuenta.php','referencia='+referencia+'&tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares+'&accion=insertar','lista_pago','get','0','1','','');
			
			/*
			if(document.getElementById('saldos').innerHTML=='Saldo(US$.)'){
				var saldo=parseFloat(document.form1.pendiente_s.value);
			}else{
				var saldo=parseFloat(document.form1.pendiente_d.value);
			}
			
			
			if(document.form1.moneorigen.value='01'){
			var saldo=parseFloat(document.form1.pendiente_s.value);
			}else{
			var saldo=parseFloat(document.form1.pendiente_d.value);			
			}
			*/			
			//alert(saldo);
			
			
			var saldo=(parseFloat(document.form1.importe.value)+parseFloat(document.form1.cargos.value))-parseFloat(document.form1.acuenta.value);
			/*
			if(tipo=='A'){
				//var saldof=saldo-dolares;
				var saldof=parseFloat(document.form1.pendiente_s.value) - (dolares*parseFloat(document.form1.tcact2.value));
				
			}else{
				var saldof=saldo+dolares;
			}
			*/
			
			if(tipo=='A'){
				//alert(document.form1.moneorigen.value);
				if(document.form1.moneorigen.value == '02'){
					//alert(saldo+"-"+dolares);
					var saldof=(parseFloat(saldo)-parseFloat(dolares)).toFixed(2);
				}else{
					var saldof=(parseFloat(saldo)-(parseFloat(dolares)*parseFloat(tc)).toFixed(2));								
				}
			}else{
				if(dolares > saldo){
					//alert(parseFloat(saldo));
				var saldof=(parseFloat(dolares)+parseFloat(saldo)).toFixed(2);
				}else{
					//alert(parseFloat(saldo));
					var saldof=(parseFloat(saldo)+parseFloat(dolares)).toFixed(2);
				}
			}			
			
			if(saldof>=0){
			var obs=document.form1.obs.value;
			temp=1;
			var tcond1=(document.form1.cond_ini.value).split("-");
			
				doAjax('lista_pago_cuenta.php','referencia='+referencia+'&tpago='+tpago+'&tc='+tc+'&tipo='+tipo+'&fecha='+fecha+'&numero='+numero+'&soles='+soles+'&dolares='+dolares+'&accion=insertar&obs='+obs+'&deuda='+tcond1[1],'lista_pago','get','0','1','','');
			}else{
				alert("No es posible insertar este movimiento Importe mayor a Saldo Pendiente");
				document.form1.dolares.value=0;
				document.form1.soles.disabled=false;
				document.form1.dolares.focus();
				document.form1.dolares.select();
			}
		}else{
			alert("Ingrese Monto Valido");
			document.form1.soles.disabled=false;
			document.form1.dolares.focus();
			document.form1.dolares.select();
		}
		
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
/*document.form1.cliente2.value=cod;	
document.form1.cliente.value=razon;
document.form1.ruc3.value=ruc;
document.form1.direc.value=direccion;
*/
if(document.form1.suc4.value!=0){
	var suc=document.form1.suc4.value;
}else{
	var suc=document.form1.suc3.value;
}
if(suc==0){
	alert("Selecciones una Suscursal");
	document.form1.suc.focus();
	return false;
}
	//alert(suc);
var num=document.form1.numero.value;
var serie=document.form1.serie.value;
var doc=document.form1.doc.value;

document.getElementById('auxiliares').style.visibility='hidden';
//document.form1.ter.value=0;
document.getElementById('condicion').style.visibility='visible';
document.getElementById('tpago').style.visibility='visible';
//document.form1.condicion.focus();
//if(ruc!=""){
//cambiardoc();
//}
doAjax('b_cuenta.php','serie='+serie+'&numero='+num+'&doc='+doc+'&suc='+suc+'&tipo='+document.form1.tipo.value+'&aux='+cod,'b_cuenta','get','0','1','','');
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
document.form1.tope.disabled=false;
document.form1.tpago.disabled=false;
document.form1.numero_tarjeta.disabled=false;
if(document.form1.nivel.value=="4" || document.form1.nivel.value=="5"){
	document.form1.f_trigger_b1.disabled=false;
	//document.form1.fechadp.readonly='';
	//document.form1.tcact2.readonly=false;
}else{
	document.form1.f_trigger_b1.disabled=true;
	document.form1.fechadp.readOnly='readonly';
	document.form1.tcact2.readOnly='readonly';
}
document.form1.soles.disabled=false;
document.form1.dolares.disabled=false;
}

function eliminar_pago(codigo,tipo,monto,mone,tc,fechap,tipopago){

		var f = new Date();
		var dia="";
		if(f.getDate()<10){
			dia="0"+f.getDate();
		}else{
			dia=f.getDate();
		}
		var mes="";
		if(f.getMonth()+1<10){
			mes="0"+(f.getMonth()+1);
		}else{
			mes=(f.getMonth()+1);
		}
		var fecha_acutal=dia + "-" + mes + "-" + f.getFullYear();
	
	
	if(tipopago=='15'){ /// tipo de pago= percepcion
	alert(" No es posible eliminar este tipo de pago ");
	return false;
	}
	
	var tcond1=(document.form1.cond_ini.value).split("-");
	
	if(tcond1[1]=='S'){
		
		if(document.form1.nivel.value!=4 && document.form1.nivel.value!=5 && document.form1.nivel.value!=11){	
				
				//alert(fecha_acutal+" "+fechap);
				if(fecha_acutal!=fechap){
				alert("No esta autorizado para eliminar pagos de fechas anteriores");
				return false;			
				}			
		}	
	}else{
	alert("No es posible eliminar pagos de documentos al contado. ")
	return false;
	
	}
	
	if(tipo=='A'){
		if(document.form1.moneorigen.value=='01' && mone=='dolares'){
			var val1=monto*tc;
		}else{
			if(document.form1.moneorigen.value=='02' && mone=='soles'){
				var val1=monto/tc;
			}else{
				var val1=monto;
			}
		}
		//var saldof=parseFloat(document.form1.pendiente_s.value)+parseFloat(val1);
		var saldof=(parseFloat(document.form1.importe.value)+parseFloat(document.form1.cargos.value))-(parseFloat(document.form1.acuenta.value)-parseFloat(val1));
	}else{
		if(document.form1.moneorigen.value=='01' && mone=='dolares'){
			var val1=monto*tc;
		}else{
			if(document.form1.moneorigen.value=='02' && mone=='soles'){
				var val1=monto/tc;
			}else{
				var val1=monto;
			}
		}
		//var saldof=parseFloat(document.form1.pendiente_s.value)-parseFloat(val1);
		var saldof=(parseFloat(document.form1.importe.value)+parseFloat(document.form1.cargos.value)+parseFloat(val1))-parseFloat(document.form1.acuenta.value);
	}
	var referencia=document.form1.referencia.value;
	var respuesta=confirm("confirma que desea eliminar este dato?");
	
	//if(respuesta && (document.form1.nivel.value==4 || document.form1.nivel.value==5 || document.form1.nivel.value==9 || document.form1.nivel.value==11)  && saldof>=0)
	
	if(respuesta && saldof>=0)
	{
	
	
	var tcond1=(document.form1.cond_ini.value).split("-");
	
	
	doAjax('lista_pago_cuenta.php','accion=eliminar&cod_pago='+codigo+'&referencia='+referencia+'&deuda='+tcond1[1],'lista_pago','get','0','1','','');
//	alert("eliminando Codigo numero: "+codigo);
	}else{
	
		if(saldof >= 0){
			alert("No esta autorizado a eliminar pagos...Contacte con el Administrador de la Tienda");
		}else{
			alert("No se puede eliminar pago...verifique saldo");
		}
		//alert("no se pudo eliminar..");
	}
}

function guardar_tpago(){
	if(document.form1.pendiente_s.value>=0){
	//location.href="cuentaCorrienteN.php";
	var refer=document.form1.referencia.value;
	var sald=document.form1.pendiente_s.value;
	/*
	if(document.getElementById('condicion').disabled==true){
		var cond="";
	}else{
	*/
		var x=document.getElementById('condicion').value
		var tx=x.split("-");
		//alert(tx[0]);
		var cond="&cond="+tx[0];
	//}
	var tcond1=(document.form1.cond_ini.value).split("-");
	doAjax('lista_pago_cuenta.php','accion=guardar_saldo&referencia='+refer+cond+'&saldo='+sald+'&deuda='+tcond1[1],'','get','0','1','','');
	document.form1.submit();
	}else{
	alert("El documento tiene un saldo negativo");
	}
}


function compare_dates(fecha, fecha2)   
  {   
    var xMonth=fecha.substring(3, 5);   
    var xDay=fecha.substring(0, 2);   
    var xYear=fecha.substring(6,10);   
    var yMonth=fecha2.substring(3, 5);   
    var yDay=fecha2.substring(0, 2);   
    var yYear=fecha2.substring(6,10);   
    if (xYear > yYear)   
    {   
        return(true)   
    }   
    else  
    {   
      if (xYear == yYear)   
      {    
        if (xMonth> yMonth)   
        {   
            return(true)   
        }   
        else  
        {    
          if (xMonth == yMonth)   
          {   
            if (xDay > yDay)   
              return(true);   
            else  
              return(false);   
          }   
          else  
            return(false);   
        }   
      }   
      else  
        return(false);   
    }   
}  

function cambiar_tpago(control,id,campo){
	
	var t_pago=control.value;
	//var t_pago=control.value;

	doAjax('operaciones.php','&t_pago='+t_pago+'&id='+id+'&Modulo=Creditos&accionx=save_tipopago&campo='+campo,'rpta_t_pago','get','0','1','','');	

}
function rpta_t_pago(data){
//alert(data);
}

</script>