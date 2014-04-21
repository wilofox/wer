<?php session_start();
   include('../conex_inicial.php');
   $_SESSION['registro']=rand(100000,999999);

   if($_REQUEST['tipomov']==1){
 	$aux="Proveedor";
	$titulo="Ingresos - Compras";
   }else{
	$aux="Cliente";
	$titulo="Salidas - Ventas";
   }


?>
<script>
var temp="<?php echo $_REQUEST['caducado']?>";
if(temp=="s"){
window.parent.location.href="index.php";
}
</script>
<script language="JavaScript"> 
//(c) 1999-2001 Zone Web 
function click() { 
	if (event.button==2) { 
	alert ('Derechos Reservados a Prolyam Software.') 
	} 
} 
document.onmousedown=click ;



function find_prm(prm,codigo){
//alert(codigo);
		for (var i=0;i<prm.length;i++){
			if(codigo[i]==document.formulario.doc.value){
			return prm[i];
			}
		} 
}

</script> 


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
.Estilo14 {font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color:#333333 }
.Estilo15 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #990000;
}
.Estilo31 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FFFFFF; }
.Estilo32 {color: #FFFFFF}
.Estilo111 {color:#0066CC;}
.Estilo34 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
.Estilo112 {color: #000000}
-->
.Estilo_det{font:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#333333}

</style>
</head>

<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>
<!--
<LINK media=all href="../javascript/css.css" type=text/css rel=stylesheet>
<SCRIPT src="../javascript/main.js" type=text/javascript></SCRIPT>
<SCRIPT src="../javascript/jquery.js" type=text/javascript></SCRIPT>
<LINK href="../javascript/SyntaxHighlighter.css" type=text/css rel=stylesheet>
</LINK>
<SCRIPT language=javascript src="../javascript/shCore.js"></SCRIPT>
<SCRIPT language=javascript src="../javascript/shBrushJScript.js"></SCRIPT>
<SCRIPT language=javascript>$(function() { dp.SyntaxHighlighter.HighlightAll('code'); });</SCRIPT>
<SCRIPT src="../javascript/toggleDiv.js" type=text/javascript></SCRIPT>
-->
<SCRIPT src="../javascript/popup.js" type=text/javascript></SCRIPT>

<script language="javascript" src="../miAJAXlib.js"></script>
<!--<script language="javascript" src="jquery[1].hotkeys-0.7.7-packed.js"></script>-->

    <script src="../jquery-1.2.6.js"></script>
    <script src="../jquery.hotkeys.js"></script>
	<script src="../mootools-comprimido-1.11.js"></script>
	<!--<script src="../modal.js"></script>-->
	
	<!--<script language="javascript" src="miAJAXlib2.js"></script>-->
	

	
	
<?php 
$fecha=date("d-m-Y");
?>

<script>
var temporal_teclas="";
var  temp_mon="01";

 jQuery(document).bind('keydown', 'f4',function (evt){jQuery('#_up').addClass('dirty');
//	alert('f5');
	event.keyCode=0;
	event.returnValue=false;
	
	eliminar_doc();
	
return false; });


 


function eliminar_doc(){

	if( (document.getElementById('estado').innerHTML=="" || document.getElementById('estado').innerHTML=="INGRESO")){
		alert('La eliminación de documento no procede por falta de información');
		return false;
		}

		
	var permiso2=find_prm(tab3,tab_cod);
	if(permiso2=='S'){
	
	var sucursal=document.formulario.sucursal.value;
	var tienda=document.formulario.almacen.value;
	var numero=document.formulario.num_correlativo.value;
	var serie=document.formulario.num_serie.value;
	var doc=document.formulario.doc.value;
	var tipomov=document.formulario.tipomov.value;
	var auxiliar=document.formulario.auxiliar2.value;
	
	document.formulario.carga.value="S";
		if(confirm("Esta seguro que desea ELIMINAR este Documento ?")){
		doAjax('peticion_datos.php','&sucursal='+sucursal+'&tienda='+tienda+'&numero='+numero+'&serie='+serie+'&doc='+doc+'&tipomov='+tipomov+'&auxiliar='+auxiliar+'&peticion=eliminar_doc','mostrar_eliminacion','get','0','1','','');
		}else{
			
		}
	 
	 }else{
	 alert('No tiene permniso para eliminar este documento');
	 }
	
}


function anular_doc(){

	if(document.formulario.tipomov.value==1){
    alert('La solicitud de anulación no es permitida para este modulo');
	return false;
	}
	
	if( (document.getElementById('estado').innerHTML!="CONSULTA")){
	alert('La Anulación del documento no procede ');
	return false;
	}
		
	var permiso2=find_prm(tab2,tab_cod);
	if(permiso2=='S'){
	
	var sucursal=document.formulario.sucursal.value;
	var tienda=document.formulario.almacen.value;
	var numero=document.formulario.num_correlativo.value;
	var serie= document.formulario.num_serie.value;
	var doc=document.formulario.doc.value;
	var tipomov=document.formulario.tipomov.value;
	var auxiliar=document.formulario.auxiliar2.value;
	
	document.formulario.carga.value="S";
	
		if(confirm("Esta seguro que desea ANULAR este Documento ?")){
		doAjax('peticion_datos.php','&sucursal='+sucursal+'&tienda='+tienda+'&numero='+numero+'&serie='+serie+'&doc='+doc+'&tipomov='+tipomov+'&auxiliar='+auxiliar+'&peticion=anular_doc','mostrar_eliminacion','get','0','1','','');
		}else{
			return false;
		}
	
	}else{
	alert('No tiene permiso para anular este Documento');	
	}
		

	
}




function mostrar_eliminacion(texto){

document.formulario.submit();
}



jQuery(document).bind('keydown', 'f2',function (evt){jQuery('#_up').addClass('dirty');
	
//	var tecla=window.event.keyCode;
		
 	if (temporal_teclas=="") {
	
		var total_doc=document.formulario.total_doc.value;
		if(total_doc!=0){
		temporal_teclas='grabar';
		grabar_doc();
		}else{
		alert('No se puede guardar este documento');			
		}	
	}else{
	event.keyCode=0;
	event.returnValue=false;

	}

return false; });


function grabar_doc(){
		
			var total_doc=document.formulario.total_doc.value;
			if(total_doc!=0){
			
			//alert();
			var temp_doc=document.formulario.temp_doc.value;
			var responsable=document.formulario.responsable.value;
			var tipomov=document.formulario.tipomov.value;
			var tienda=document.formulario.almacen.value;
			var condicion=document.formulario.condicion.value;
			var femision=document.formulario.femi.value;
			var fvencimiento=document.formulario.fven.value;
			var monto=document.formulario.monto.value;
			var impuesto1=document.formulario.impuesto1.value;
			
			var incluidoigv=document.formulario.incluidoigv.value;
			var auxiliar=document.formulario.auxiliar2.value;
			var tmoneda=document.formulario.tmoneda.value;
			var tcambio=document.formulario.tcambio.value;
			var sucursal=document.formulario.sucursal.value;
			var correlativo_ref=document.formulario.correlativo_ref.value;
			var serie_ref=document.formulario.serie_ref.value;
			var cod_cab_ref=document.formulario.cod_cab_ref.value;
			
			//alert(serie_ref);
			var obs1=document.formulario.obs1.value;
			var obs2=document.formulario.obs1.value;
			var obs3=document.formulario.obs1.value;
			var obs4=document.formulario.obs1.value;
			var obs5=document.formulario.obs1.value;
						
						
			document.formulario.accion.value="grabar";
			
			//alert(document.getElementById('estado').innerHTML);

			  if(document.getElementById('estado').innerHTML=="CONSULTA" || document.getElementById('estado').innerHTML=="ANULADO"){
			  alert('Este documento solo es de consulta');
			  }else{
	doAjax('peticion_datos.php','&temp_doc='+temp_doc+'&responsable='+responsable+'&tipomov='+tipomov+'&tienda='+tienda+'&condicion='+condicion+'&femision='+femision+'&fvencimiento='+fvencimiento+'&monto='+monto+'&impuesto1='+impuesto1+'&total_doc='+total_doc+'&incluidoigv='+incluidoigv+'&auxiliar='+auxiliar+'&tmoneda='+tmoneda+'&tcambio='+tcambio+'&peticion=save_doc'+'&sucursal='+sucursal+'&correlativo_ref='+correlativo_ref+'&serie_ref='+serie_ref+'&obs1='+obs1+'&obs2='+obs2+'&obs3='+obs3+'&obs4='+obs4+'&obs5='+obs5+'&cod_cab_ref='+cod_cab_ref,'mostrar_grabacion','get','0','1','','');
			
		
			
				}
						
			}else{
			alert('No se puede guardar el documento sin  detalle');						
			}
	
}


function mostrar_grabacion(texto){

if(document.formulario.temp_imp.value=='S'){
imprimir();

}

document.formulario.submit();
//document.formulario.pruebas.value=texto;
}


jQuery(document).bind('keyup', 'up',function (evt){jQuery('#_up').addClass('dirty');
	//document.getElementById('TablaDatos').rows[0].style.background='#FFCC00';
	if(document.getElementById('productos').style.visibility=='visible'){
	
	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
//	alert(document.getElementById('tblproductos').rows.length);
		if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb' && (i!=0) ){
		document.getElementById('tblproductos').rows[i].style.background=document.getElementById('tblproductos').rows[i].bgColor;
		document.getElementById('tblproductos').rows[i-1].style.background='#FFF1BB';
		
		if(i%4==0 && i!=0){
		capa_desplazar = $('detalle');
		capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y - 60);
		}
		break;
		}
	  }
   }
   
   if(document.getElementById('auxiliares').style.visibility=='visible'){
	
	for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
//	alert(document.getElementById('tblproductos').rows.length);
		if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' && (i!=0) ){
		document.getElementById('tblproductos1').rows[i].style.background=document.getElementById('tblproductos1').rows[i].bgColor;
		document.getElementById('tblproductos1').rows[i-1].style.background='#FFF1BB';
		
		if(i%4==0 && i!=0){
		capa_desplazar = $('detalle1');
		capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y - 60);
		}
		break;
		}
	  }
   }
         
 return false; });

   jQuery('#platform-details').html('<code>' + navigator.userAgent + '</code>');
function domo(){

 jQuery(document).bind('keydown', 'f6',function (evt){jQuery('#_f6').addClass('dirty');
  	
		
	window.open('observaciones.php?doc='+document.formulario.doc.value,'','width=350,height=300,top=250,left=350,scroolbars=no,directories=no,location=no,menubar =no,titlebar=no,toolbar=no,status=yes');
	
  return false; });

//alert();
jQuery(document).bind('keyup', 'down',function (evt){jQuery('#_down').addClass('dirty');

 if(document.getElementById('productos').style.visibility=='visible'){
 //alert('entro');
	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
			
		//	alert(document.getElementById('tblproductos').rows.length);
			if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb' && (i!=document.getElementById('tblproductos').rows.length-1)){
			//alert(document.getElementById('TablaDatos').rows[i].style.background);
			document.getElementById('tblproductos').rows[i].style.background=document.getElementById('tblproductos').rows[i].bgColor;
			document.getElementById('tblproductos').rows[i+1].style.background='#FFF1BB';
			
			if(i%4==0 && i!=0){
			capa_desplazar = $('detalle');
			capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y + 60);
			}
			
			break;
				
			}
		}
 	}
	
	if(document.getElementById('auxiliares').style.visibility=='visible'){
 //alert('entro');
	for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
			
		//	alert(document.getElementById('tblproductos').rows.length);
			if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' && (i!=document.getElementById('tblproductos1').rows.length-1)){
			//alert(document.getElementById('TablaDatos').rows[i].style.background);
			document.getElementById('tblproductos1').rows[i].style.background=document.getElementById('tblproductos1').rows[i].bgColor;
			document.getElementById('tblproductos1').rows[i+1].style.background='#FFF1BB';
			
			if(i%4==0 && i!=0){
			capa_desplazar = $('detalle1');
			capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y + 60);
			}
			
			break;
				
			}
		}
 	}
	
	
 return false; });
 

jQuery(document).bind('keyup', 'return',function (evt){jQuery('#_return').addClass('dirty'); 

  	if(document.activeElement.name=='sucursal' || document.activeElement.name=='almacen' || document.activeElement.name=='doc' || document.activeElement.name=='responsable' || document.activeElement.name=='condicion' ){
	
		cambiar_enfoque(document.activeElement);
		
		if(document.activeElement.name=='almacen'){
		doAjax('../carga_cbo_tienda.php','','cargar_cbo','get','0','1','','');
		}
	}


		
	if(document.getElementById('productos').style.visibility=='visible'){
		for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
			if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb'){
			
		var temp=document.getElementById('tblproductos').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
		var temp1=document.getElementById('tblproductos').rows[i].cells[1].childNodes[0].innerHTML;
		var temp3=document.getElementById('tblproductos').rows[i].cells[3].innerHTML;
		
	   elegir(temp,temp1);
	   
	   //alert(temp3);
	   document.formulario.saldo.value=temp3;
	   
			}
		 }
	   }
	   if(document.getElementById('auxiliares').style.visibility=='visible'){

		for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
			if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb'){
			
		var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
		var temp1=document.getElementById('tblproductos1').rows[i].cells[1].childNodes[0].innerHTML;
		
		var doc=document.formulario.doc.value;
		var ruc=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[0].innerHTML;
			 if( (doc=='FA' || doc=='F1') && ruc==""  ){
			 alert(" Cliente no tiene Ruc ");
			 return false;
			 }else{
			 elegir2(temp,temp1);
			 }
		  
		//elegir2(temp,temp1);
			}
		 }
	   }
	   
	   
	   if(document.formulario.cantidad.value!="" && document.formulario.codprod.value!="" && document.formulario.punit.value!="" && document.formulario.cantidad.value!=0 && document.formulario.precio.value!=0)
		{
		 
			 for(var i=0;i<tab_nitems.length;i++){
			 
				 if(tab_cod[i]==document.formulario.doc.value){
						var items_max=tab_nitems[i];		 
				 }
			 
			 }
		 		
				var mer=parseInt(document.getElementById('nitems').innerHTML)+1;
	  //	alert(mer+"  "+items_max);		
		
					if(mer>items_max){
					alert('No es permitido más items en el documento...');
					return false;
					}
				
		
					var prms_doc_stock=find_prm(tab1,tab_cod);
			
					var cant=document.formulario.cantidad.value;
					var saldo=document.formulario.saldo.value;
					
					 if(document.formulario.tipomov.value==2){
					 						
						if( parseFloat(saldo) >= parseFloat(cant) || prms_doc_stock=='N' ){
						doAjax('buscar_item.php','','buscar_item2','get','0','1','','');
						}else{
						
						alert("Producto sin Stock ... \n Stock Disponible: "+saldo);	
						document.formulario.cantidad.value="";
						document.formulario.codprod.value="";
						document.formulario.precio.value="";
						document.formulario.punit.value="";
						document.formulario.codprod.select();
																
						}
					}else{
					doAjax('buscar_item.php','','buscar_item2','get','0','1','','');
					
					}	
								
		
						
		}else{
			//Para texto sin valor.
			if(document.formulario.cantidad.value=="" && document.formulario.termino.value!="" && document.formulario.codprod.value=="" && document.formulario.punit.value==""){
			enviar();
			}
			
		}
			
return false; });


jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_esc').addClass('dirty'); 

//document.formulario.codprod.focus();
//alert("escape");
salir();
		
return false; });



 
 
 


	jQuery(document).bind('keydown', 'f7',function (evt){jQuery('#_f7').addClass('dirty');

ant_imprimir();
	
	 return false; }); 
	
	
	 jQuery(document).bind('keydown', 'f8',function (evt){jQuery('#_f8').addClass('dirty');

 
	if(!document.formulario.codprod.disabled && document.getElementById('productos').style.visibility!='visible' ){
			
	   			
		if(document.getElementById('moneda').innerHTML=='(S/.)'){
		document.getElementById('moneda').innerHTML='(US$.)';
		document.formulario.tmoneda.value="02";
		}else{
		document.getElementById('moneda').innerHTML='(S/.)';
		document.formulario.tmoneda.value="01";
		}
		
		if(document.formulario.total_doc.value!=0.00){
		
		var permiso4=find_prm(tab4,tab_cod);
		doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&accion=cambiar_dolar&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4,'mostrar','get','0','1','','');
		}else{
		temp_mon="02";
		}
		
		
	}else{
		if(document.getElementById('productos').style.visibility=='visible'){
		
		   for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
			if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb'){
			
				var temp=document.getElementById('tblproductos').rows[i].cells[0].childNodes[0].childNodes[0]
		
				espec_prod(temp);
		//var temp3=document.getElementById('tblproductos').rows[i].cells[3].innerHTML;
				
	   
				}
			 }
		
		
		}
	
	
	 }	

		 return false; }); 
		 
 
		 
jQuery(document).bind('keydown', 'f9',function (evt){jQuery('#_f9').addClass('dirty');
	 
	// alert(document.getElementById('incluyeimp').innerHTML);
	
	
	
	cambiar_impuesto();
	
		
 return false; }); 
 
 jQuery(document).bind('keydown', 'f5',function (evt){jQuery('#_f6').addClass('dirty');
	 
	
	event.keyCode=0;
	event.returnValue=false;
	
	anular_doc();
	 
	
	
 return false; }); 
 
 
 jQuery(document).bind('keydown', 'f3',function (evt){jQuery('#_f3').addClass('dirty');
	event.returnValue=false;
	event.keyCode=0;
	
	  if(document.getElementById('auxiliares').style.visibility=='visible'){
	  ver_new_aux();
	  }
	
	
 return false; }); 
 
 
 jQuery(document).bind('keydown', 'Alt+r',function (evt){jQuery('#_Alt_r').addClass('dirty');
	event.returnValue=false;
	event.keyCode=0;
	
	vent_ref();
		
 return false; });
 
 	 
}


function cambiar_impuesto(){
	
	var permiso4=find_prm(tab4,tab_cod);
	
	 if(permiso4=='N'){
	
		if(document.formulario.incluidoigv.value=="S"){
			document.formulario.incluidoigv.value="N";
						
			}else{
			document.formulario.incluidoigv.value="S";
		
			}
			
		mostrar_detalle();	
	}	
	

/*
	if((!document.formulario.codprod.disabled) && permiso4!='S' ){	
			if(document.getElementById('incluyeimp').innerHTML=='( Incl.Impstos )'){
			document.getElementById('incluyeimp').innerHTML='( No Incl.Impstos )'
			document.formulario.incluidoigv.value="N";
			
			var total=document.formulario.total_doc.value;
			//var monto=Math.round((total/1.19)*100)/100;
			var igv=Math.round((total*0.19)*100)/100;
			
			document.formulario.monto.value=total;
			document.formulario.impuesto1.value=igv;
			document.formulario.total_doc.value=parseFloat(total)+parseFloat(igv);
			
			document.formulario.monto2.value=total;
			document.formulario.impuesto2.value=igv;
			document.formulario.total_doc2.value=parseFloat(total)+parseFloat(igv);
					
			}else{
			document.getElementById('incluyeimp').innerHTML='( Incl.Impstos )';
			document.formulario.incluidoigv.value="S";
			
			var total=document.formulario.monto.value;
			var monto=Math.round((total/1.19)*100)/100;
			var igv=Math.round((total-monto)*100)/100;
			
			document.formulario.monto.value=monto;
			document.formulario.impuesto1.value=igv;
			document.formulario.total_doc.value=total;
			
			document.formulario.monto2.value=monto;
			document.formulario.impuesto2.value=igv;
			document.formulario.total_doc2.value=total;
			
			
			}
		}

*/

}




//function ver(){alert("tecla f7");}
jQuery(document).ready(domo);


function salir(){

	if(document.getElementById('productos').style.visibility=='hidden' && document.getElementById('auxiliares').style.visibility=='hidden' && document.getElementById('new_aux').style.visibility=='hidden') {
	
			if(confirm("Esta seguro que desea salir...")){
			
					var total_doc=document.formulario.total_doc.value;
					var sucursal=document.formulario.sucursal.value;
					var tienda=document.formulario.almacen.value;
					var numero=document.formulario.num_correlativo.value;
					var serie= document.formulario.num_serie.value;
					var doc=document.formulario.doc.value;
					var tipomov=document.formulario.tipomov.value;
					var auxiliar=document.formulario.auxiliar2.value;
					
					//alert();
					if(document.formulario.num_correlativo.disabled && (document.getElementById('estado').innerHTML=="INGRESO" ||  document.getElementById('estado').innerHTML=="")){
					
				
				doAjax('peticion_datos.php','&sucursal='+sucursal+'&tienda='+tienda+'&numero='+numero+'&serie='+serie+'&doc='+doc+'&tipomov='+tipomov+'&auxiliar='+auxiliar+'&peticion=liberar_numero','liberar_numero','get','0','1','','');
														
					}else{
					document.formulario.submit();
					}
					
			}else{
			
			}
	}else{
	document.getElementById('productos').style.visibility='hidden';
	document.getElementById('auxiliares').style.visibility='hidden';
	document.getElementById('new_aux').style.visibility='hidden';
	document.formulario.prov_asoc.value='';
	
	
	
	}		
}


function liberar_numero(texto){
//alert(texto);
document.formulario.submit();
}


function iniciar(){
document.formulario.doc.focus();

//document.formulario.codprod.focus();

document.formulario.almacen.disabled=true;
//document.formulario.doc.disabled=true;
document.formulario.num_serie.disabled=true;
document.formulario.num_correlativo.disabled=true;
document.formulario.auxiliar.disabled=true;
document.formulario.responsable.disabled=true;
document.formulario.condicion.disabled=true;
document.formulario.femi.disabled=true;
document.formulario.fven.disabled=true;
document.formulario.codprod.disabled=true;
document.formulario.cantidad.disabled=true;

document.formulario.precio.readOnly=true;
document.formulario.punit.disabled=true;
document.formulario.pro.value=1;

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
document.formulario.punit.value="";
document.formulario.notas.value="";

	if(!document.formulario.codprod.disabled){
	document.formulario.codprod.focus();
	document.formulario.pro.value=1;
	}
	document.formulario.accion.value="";
	//cambiar_impuesto();
	
		if(document.formulario.total_doc.value==0.00){		
			if(document.getElementById('moneda').innerHTML=='(S/.)'){
			temp_mon="01";
			}else{
			temp_mon="02";
			}
		}
	
}

function mostrar_precio(texto){
//alert(texto);

var cadena=texto.split('?');
document.formulario.precio.value=cadena[0];
document.formulario.punit.value=cadena[1];

}

function listaprod(texto){


	var r = texto;
	var valor="";
	if(document.formulario.tempauxprod.value=='auxiliares'){
	document.getElementById('auxiliares').innerHTML=r;
	document.getElementById('auxiliares').style.visibility='visible';
	valor=document.formulario.auxiliar.value;
	
	selec_busq2();
	}
	if(document.formulario.tempauxprod.value=='productos'){
	document.getElementById('productos').innerHTML=r;
	document.getElementById('productos').style.visibility='visible';
	valor=document.formulario.codprod.value;
	
	selec_busq();
	}

	var temp=document.formulario.tempauxprod.value;
	var tipomov=document.formulario.tipomov.value;
	var tienda=document.formulario.almacen.value;
	
	var temp_criterio=temp_busqueda;
	
	//alert(temp_criterio);
	doAjax('det_aux.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc='+document.formulario.prov_asoc.value,'detalle_prod','get','0','1','','');
				//doAjax('det_aux.php','&clasificacion=1&temp=auxiliares&tipomov='+document.formulario.tipomov.value+'&prov_asoc='+texto,'detalle_prod','get','0','1','','');
	
}		
			
function detalle_prod(texto){
//alert(texto);
var r = texto;
if(document.formulario.tempauxprod.value=='auxiliares'){
document.getElementById('detalle1').innerHTML=r;
document.getElementById('tblproductos1').rows[0].style.background='#fff1bb';
}
if(document.formulario.tempauxprod.value=='productos'){
document.getElementById('detalle').innerHTML=r;
document.getElementById('tblproductos').rows[0].style.background='#fff1bb';
}
//document.getElementById('productos').style.visibility='visible';
//alert('entro');
//document.formulario.txtnombre.focus();
}

function recargar(){
document.formulario.submit();
}

function recargar2(){
alert('pedido');
}

function cargar_cbo(texto){
var r = texto;
document.getElementById('cbo_tienda').innerHTML=r;
document.formulario.almacen.focus();
}

</script>

<link href="../styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
background-color:#F3F3F3;   
}
.Estilo38 {color: #990000}
.Estilo113 {
	color: #CC3300;
	font-weight: bold;
	font-size: 10px;
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style>


<script>
function vaciar_sesiones(){

		
		
		if(document.formulario.num_correlativo.disabled && (document.getElementById('estado').innerHTML=="INGRESO" ||  document.getElementById('estado').innerHTML=="")){
	//	alert();
		var sucursal=document.formulario.sucursal.value;
		var numero=document.formulario.num_correlativo.value;
		var serie= document.formulario.num_serie.value;
		var doc=document.formulario.doc.value;
		var tipomov=document.formulario.tipomov.value;
		var auxiliar=document.formulario.auxiliar2.value;

		
		doAjax('vaciar_sesiones.php','&sucursal='+sucursal+'&numero='+numero+'&serie='+serie+'&doc='+doc+'&auxiliar='+auxiliar+'&tipomov='+tipomov,'dev_vaciar','get','0','1','','');
		}else{
		
		var tipomov="";
		doAjax('vaciar_sesiones.php','&tipomov='+tipomov,'dev_vaciar','get','0','1','','');
		
		}	
	

}


function dev_vaciar(texto){

alert(texto);
}

function buscar_item2(texto){

	if(texto==0){
	enviar();
	
	}else{
	
		if(confirm('Este item ya se encuentra ingresado en el detalle desea volver a ingresarlo? ')){
		enviar();
		}else{
		
		document.formulario.precio.value="";
		document.formulario.punit.value="";
		document.formulario.cantidad.value="";
		document.formulario.termino.value="";
		document.formulario.codprod.value="";
		document.formulario.codprod.focus();
		
		}
	
	}


}

</script>
<body  onload="iniciar();"   onUnload="vaciar_sesiones();" >
<form id="formulario" name="formulario" method="post" action="">
  <table width="759" border="0" cellpadding="0" cellspacing="0">
   
    
	
     <tr style="background:url(../imagenes/white-top-bottom.gif)">
          <td height="27" colspan="16" style="border:#999999">&nbsp;<span class="Estilo34">Generador de Documentos  :: <span class="Estilo14 Estilo38"><?php echo $titulo?>
            <input  type="hidden" name="tempauxprod" value="" />
            <input name="tipomov"  type="hidden" value="<?php echo $_REQUEST['tipomov']?>" />
            <input type="hidden" name="temp_doc">
            <input name="accion" type="hidden" size="5
	  " maxlength="10">
            <input name="incluidoigv" type="hidden" size="5
	  " maxlength="10" value="S">
            <input name="tmoneda" type="hidden" size="5" maxlength="10" value="01">
            <input name="carga" type="hidden" size="5" maxlength="10" value="F">
            <input name="obs1" type="hidden" size="8" maxlength="150">
            <input name="obs2" type="hidden" size="8" maxlength="150">
            <input name="obs3" type="hidden" size="8" maxlength="150">
            <input name="obs4" type="hidden" size="8" maxlength="150">
            <input name="obs5" type="hidden" size="8" maxlength="150">
            <input name="prov_asoc" type="hidden" size="8" maxlength="150">
            <input type="hidden" name="pruebas" >
            <input type="hidden" name="temp_imp" id="temp_imp" value="">
            <input type="hidden" name="cod_cab_ref" id="cod_cab_ref" value="">
          </span></span></td>
    </tr>
	
    <tr style="background:url(../imagenes/botones.gif);" >
      <td width="9" height="28">&nbsp;</td>
      <td width="5">&nbsp;</td>
      <td colspan="10"><table width="97%" border="0" cellpadding="0" cellspacing="0" style="border-bottom:#CCCCCC solid 1px">
        <tr>
		
          <td width="80" ><script>
		  function entrar_btn(obj){
		  obj.cells[0].style.backgroundImage="url(../imagenes/bordes_boton1.gif)";
		  obj.cells[1].style.backgroundImage="url(../imagenes/bordes_boton2.gif)";
		  obj.cells[2].style.backgroundImage="url(../imagenes/bordes_boton2.gif)";
		  obj.cells[3].style.backgroundImage="url(../imagenes/bordes_boton3.gif)";
		  
		  }
		  function salir_btn(obj){
		  obj.cells[0].style.backgroundImage="";
		  obj.cells[1].style.backgroundImage="";
		  obj.cells[2].style.backgroundImage="";
		  obj.cells[3].style.backgroundImage="";
		  
		  }
		  
		  
		  
		    </script>
              <table title="Grabar [F2]" width="80" height="21" border="0" cellpadding="0" cellspacing="0">
                <tr onClick="javascript:grabar_doc()" onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer;">
                  <td width="3" ></td>
                  <td width="20" ><span class="Estilo112"><img src="../imgenes/revert.png" width="14" height="16"></span></td>
                  <td width="54" ><span class="Estilo112">Grabar<span class="Estilo113">[F2]</span></span></td>
                  <td width="3" style="border:#666666 solid 1px" ></td>
                </tr>
            </table>			</td>
          <td width="72" >
		  
		  <table  title="Salir [Esc]"width="72" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="salir()">
                <td width="3" ></td>
                <td width="20" ><img src="../imagenes/salir.JPG"  width="16" height="16" border="0"></td>
                <td width="46" ><span class="Estilo112">Salir<span class="Estilo113">[Esc]</span></span></td>
                <td width="3" ></td>
              </tr>
          </table>		  </td>
          <td width="82">
		  
		  <table title="Eliminar Doc [F4]" onClick="eliminar_doc()" width="82" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer">
                <td width="3" ></td>
                <td width="20" ><span class="Estilo112"><img src="../imgenes/eliminar.png" width="16" height="16"></span></td>
                <td width="54" ><span class="Estilo112">Eliminar<span class="Estilo113">[F4]</span></span></td>
                <td width="5" ></td>
              </tr>
          </table>		  </td>
          <td width="76">
		  
		  <table title="Anular Doc.[F5]" width="76" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="anular_doc()">
                <td width="3" ></td>
                <td width="20" ><span class="Estilo112"><img src="../imgenes/debaja.png" width="16" height="16"></span></td>
                <td width="50" ><span class="Estilo112">Anular<span class="Estilo113">[F5]</span></span></td>
                <td width="3" ></td>
              </tr>
          </table>		  </td>
          <td width="80"><table title="Cambiar Moneda [F8]" width="80" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="">
                <td width="3" ></td>
                <td width="16" ><span class="Estilo112"><img src="../imagenes/dolar.gif" width="15" height="15"></span></td>
                <td width="58" ><span class="Estilo112">Moneda<span class="Estilo113">[F8]</span> </span></td>
                <td width="3" ></td>
              </tr>
          </table></td>
          <td width="70"><table title="Incl./no Incl.[F9]" width="70" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="">
              <td width="3" ></td>
              <td width="24" ><span class="Estilo112"><img src="../imagenes/igv.gif" width="20" height="16"></span></td>
              <td width="45" ><span class="Estilo112">&nbsp;Imp<span class="Estilo113">[F9]</span> </span></td>
              <td width="3" ></td>
            </tr>
          </table></td>
          <td width="71"><table title="Nuevo[F3]" width="75" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="ver_new_aux()">
              <td width="3" ></td>
              <td width="18" align="center" ><span class="Estilo112"><img src="../imagenes/nuevo.gif" width="14" height="16"></span></td>
              <td width="56" ><span class="Estilo112">Nuevo<span class="Estilo113">[F3]</span> </span></td>
              <td width="3" ></td>
            </tr>
          </table>
		  
		  
		  
		  
		  </td>
          <td width="192">
		  <table title="Nuevo[F3]" width="85" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="ant_imprimir()">
              <td width="3" ></td>
              <td width="20" align="center" ><img src="../imgenes/fileprint.png" width="16" height="16"></td>
              <td width="59" ><span class="Estilo112">Imprimir<span class="Estilo113">[F7]</span> </span></td>
              <td width="3" ></td>
            </tr>
          </table>
		  </td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td></td>
      <td height="10"></td>
      <td colspan="10" align="left"><div style="display:none" id="factura"><span class="Estilo1">FACTURA </span></div>      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td height="28">&nbsp;</td>
      <td colspan="10" rowspan="2" align="left" valign="top"><table width="724" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="64" height="26"><span class="Estilo14">Empresa</span></td>
          <td width="195">    
		  
		  <script>
		  
		  function cambiar_enfoque(control){
		 					
			if(control.name=="sucursal"){
			//alert();	
			document.formulario.almacen.disabled=false;
			document.formulario.almacen.focus();
			}
			if(control.name=="almacen" &&  document.formulario.num_serie.value==''){	
			document.formulario.doc.disabled=false;
			document.formulario.doc.focus();
			}
			
			if(control.name=="doc"){
			
			//document.formulario.num_serie.disabled=false;
			//document.formulario.num_serie.focus();
			//document.formulario.num_serie.select();
			var doc=document.formulario.doc.value;
			var sucursal=document.formulario.sucursal.value;
			
			
			//alert(doc);
			
			if(doc==0)doc=document.forms["formulario"][control.name].options[1].value;
			
			doAjax('peticion_datos.php','&serie='+document.formulario.num_serie.value+'&doc='+doc+'&sucursal='+sucursal+'&peticion=generar_numero','rpta_gen_numero','get','0','1','',''); 
			
			var permiso9=find_prm(tab9,tab_cod);
			
				if(permiso9=='N'){
				//document.formulario.incluidoigv.value='N';
				}
						
			}
			
			
			if(control.name=="responsable"){
			document.formulario.condicion.disabled=false;
			document.formulario.condicion.focus();
			}
			
			if(control.name=="condicion"){
			document.formulario.femi.disabled=false;
			document.formulario.femi.focus();
			document.formulario.femi.select();
			}
					
			var aBorrar = document.forms["formulario"][control.name].options[0];
			if(document.forms["formulario"][control.name].options[0].value=="0"){
		    aBorrar.parentNode.removeChild(aBorrar);
			}
			
				
			
		  }
		  
		  	  
		  function enfocar_cbo(control){
		//  alert(control.name);
		  var temp=control.name+'2';
		  eval("document.formulario."+temp+".value=1");		  
		  }
		  
		  function desenfocar(control){
		  var temp=eval(control.name+'2');
		  eval("document.formulario."+temp+".value=0");	
		 // document.formulario.temp.value=0;		  
		  }
		  
		  
		  function limpiar_enfoque(control){
		  
		 var arrValores = new Array();
        arrValores.push("almacen2");
        arrValores.push("sucursal2");
        arrValores.push("doc2");
		arrValores.push("responsable2");
		arrValores.push("condicion2");
		
		var temp=control.name+'2';
		
			for(var i=0; i< arrValores.length; i++) {
			   // document.write(arrValores[i] + '<br>');
			   if(arrValores[i]!=temp){
			   eval("document.formulario."+arrValores[i]+".value=0");
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
		
		function generar_ceros(e,ceros,control){
			var serie=document.formulario.num_serie.value;
			var numero=document.formulario.num_correlativo.value;
			var doc=document.formulario.doc.value;
			var sucursal=document.formulario.sucursal.value;
			var tipomov=document.formulario.tipomov.value;
				

				
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
			   
				   if(tipomov==2){
				   
				   document.formulario.num_serie.value=ponerCeros(valor,ceros);
				   
				   doAjax('peticion_datos.php','&serie='+document.formulario.num_serie.value+'&doc='+doc+'&sucursal='+sucursal+'&peticion=generar_numero','rpta_gen_numero','get','0','1','',''); 
				   }else{
					
					document.formulario.num_serie.value=ponerCeros(valor,ceros);
					document.formulario.num_correlativo.disabled=false;
					document.formulario.num_correlativo.focus();
					document.formulario.num_correlativo.select();
					}
		    	}
				
				if(control=='correlativo'){
				
				if(document.formulario.num_correlativo.value!=0){
				
					document.formulario.num_correlativo.value=ponerCeros(valor,ceros);
					
					numero=document.formulario.num_correlativo.value;
					
						if(tipomov==1){
						doAjax('peticion_datos.php','&serie='+serie+'&numero='+numero+'&doc='+doc+'&sucursal='+sucursal+'&peticion=buscar_prov&tipomov='+document.formulario.tipomov.value,'rpta_con_datos','get','0','1','','');
						}else{
												
						doAjax('peticion_datos.php','&serie='+serie+'&numero='+numero+'&doc='+doc+'&sucursal='+sucursal+'&peticion=buscar_prov2&tipomov='+document.formulario.tipomov.value,'rpta_bus_numero','get','0','1','','');
										
						}
				}													
					
				}
					if(control.name=='femi'){
					document.formulario.fven.disabled=false;
					document.formulario.fven.focus();
					document.formulario.fven.select();
					}					
					
					if(control.name=='fven'){
				
					var permiso11=find_prm(tab11,tab_cod);
					if(permiso11=='S' && (document.formulario.serie_ref.value=='' ||  document.formulario.correlativo_ref.value=='')){
					alert('Debe seleccionar un documento de referencia para poder continuar');
						document.formulario.doc_ref.focus();
										
					}else{
					document.formulario.codprod.disabled=false;
					document.formulario.codprod.focus();
					
					}
					
					
					
					
					//document.formulario.codprod.select();
					}
				     			
				}
		
		}
		
									  
			function rpta_con_datos(texto){
			//alert(texto);
				  if(texto==""){
				  
				document.formulario.auxiliar.disabled=false;
				document.formulario.auxiliar.focus();
				document.formulario.auxiliar.select();
				
				document.formulario.doc_ref.disabled=false;
				
				  			  
				  }else{
				  	  	
					 //if(confirm('Este documento tiene proveedores asociados desea seleccionar uno de ellos?')){
					  document.formulario.auxiliar.disabled=false;
					  document.formulario.tempauxprod.value='auxiliares';
					  document.formulario.prov_asoc.value=texto;
					  
					  doAjax('lista_aux.php','&temp=auxiliares&tipomov='+document.formulario.tipomov.value,'listaprod','get','0','1','','');
					  
//doAjax('det_aux.php','&clasificacion=1&temp=auxiliares&tipomov='+document.formulario.tipomov.value+'&prov_asoc='+texto,'detalle_prod','get','0','1','','');
					  
					  document.formulario.auxiliar.focus();
					  document.formulario.doc_ref.disabled=false;
					  //}else{
					   //document.formulario.auxiliar.disabled=false;
					   //document.formulario.auxiliar.focus();
					   //document.formulario.auxiliar.select();
					   //document.formulario.doc_ref.disabled=false;
					 // }
				  }
			}
		 
		  
		  function rpta_gen_numero(texto){
 
          document.formulario.num_serie.value=ponerCeros(document.formulario.num_serie.value,3);
		  document.formulario.num_correlativo.disabled=false;
		  
		  document.formulario.num_correlativo.value=ponerCeros(texto,7);
		  
		  document.formulario.num_correlativo.focus();
	      document.formulario.num_correlativo.select();
		  
		  }
		  		  
		  </script>
		  
            <select disabled="disabled" style="width:160"  name="sucursal" onChange="doAjax('../carga_cbo_tienda.php','','cargar_cbo','get','0','1','',''); cambiar_enfoque(this);" onFocus="enfocar_cbo(this);limpiar_enfoque(this)" >
			
			<!-- <option value="0"></option>-->
			
              <?php 
		
  $resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn); 
while($row1=mysql_fetch_array($resultados1))
{
		?>
              <option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
              <?php }?>
            </select>
            <input name="sucursal2" type="hidden" size="3" value="0" />         </td>
          <td width="56" class="Estilo14">N&uacute;mero</td>
          <td width="164"><input name="num_serie" type="text" size="5" maxlength="3" onKeyUp="generar_ceros(event,3,'serie')" onFocus="limpiar_enfoque(this);" value="001" disabled="disabled">
            <input  name="num_correlativo" type="text" size="10" maxlength="7" onKeyUp="generar_ceros(event,7,'correlativo')">
			<button title="[Alt+r]" disabled="disabled" onClick="vent_ref()" type="button" id="doc_ref"  style="height:18px"><span style=" font-family:Arial, Helvetica, sans-serif;font-size:9px">Ref</span></button>           </td>
          <td width="81" class="Estilo14">Condici&oacute;n</td>
          <td width="152"><span class="Estilo15">
            <div id="cbo_cond">
			<select name="condicion" style="width:120" onFocus="enfocar_cbo(this);limpiar_enfoque(this);">
              <option value="1">Contado Cash</option>
              <option value="2">Credito</option>
            </select>
			</div>
            </span></td>
          <td width="12"><span class="Estilo15">
            <input name="condicion2" type="hidden" size="3"  value="0"/>
          </span></td>
        </tr>
        <tr>
          <td ><span class="Estilo14">Tienda</span>
            <input name="almacen2" type="hidden" size="3"  value="0"/>          </td>
          <td><span class="Estilo15">
		   <div id="cbo_tienda">
		     <select  style="width:160" name="almacen"  onBlur="">
               <option value="101">Principal Iquitos</option>
             </select>
		   </div>    
            </span></td>
          <td class="Estilo14">
		  <?php
		  echo $aux;
		  ?>		  </td>
          <td><span class="Estilo15">
            <input autocomplete="off" name="auxiliar" type="text" size="18" maxlength="50" onKeyUp="validartecla(event,this,'auxiliares')">
            <input name="auxiliar2" type="hidden" size="3"  value=""/>
          </span></td>
          <td class="Estilo14">F.Emisi&oacute;n</td>
          <td><input name="femi" type="text" size="15" maxlength="50" value="<?php echo date('d-m-Y')?>"  onKeyUp="generar_ceros(event,'0',this)" >
		  
		  
		  
		  <button type="reset" id="f_trigger_b2"  style="height:18" >...</button>
              <script type="text/javascript">
    Calendar.setup({
        inputField     :    "femi",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b2",   
        singleClick    :    true,           
        step           :    1                
    });
            </script></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="38"><span class="Estilo14">Doc</span></td>
          <td>
		  <select style="width:160" name="doc"  onChange="cambiar_enfoque(this);" onFocus="enfocar_cbo(this);limpiar_enfoque(this);">
		  <option value="0"></option>
		  <?php 
		   $resultados10 = mysql_query("select * from operacion where codigo!='TB' and codigo!='TF' and codigo!='TS'  and tipo='".$_REQUEST['tipomov']."' order by descripcion ",$cn); 
			while($row10=mysql_fetch_array($resultados10))
			{
			
			$p1[]=substr($row10['p1'],0,1);
			$p2[]=substr($row10['p1'],1,1);
			$p3[]=substr($row10['p1'],2,1);
			$p4[]=substr($row10['p1'],3,1);
			$p5[]=substr($row10['p1'],4,1);
			$p6[]=substr($row10['p1'],5,1);
			$p7[]=substr($row10['p1'],6,1);
			$p8[]=substr($row10['p1'],7,1);
			$p9[]=substr($row10['p1'],8,1);
			$p10[]=substr($row10['p1'],9,1);
			$p11[]=substr($row10['p1'],10,1);
			
			$p1_cod[]=$row10['codigo'];
			$nitems[]=$row10['nitems'];
			
		  ?>
            <option value="<?php echo $row10['codigo']?>"><?php echo $row10['descripcion']?></option>
			
			<?php }?>
          </select>
		  <span class="Estilo15">
		  <input name="doc2" type="hidden" size="3"  value="0"/>
		  </span> </td>
          <td class="Estilo14">
		  
		  <?php
		  
		  if($_REQUEST['tipomov']==1){
		  echo "Responsable";
		  }else{
		  echo "Vendedor";
		  }
		  
		  ?>		  </td>
          <td><span class="Estilo15">
		  
		   <select name="responsable" style="width:120" onChange=""  onFocus="enfocar_cbo(this);limpiar_enfoque(this);">
		  <?php 
		    $resultados11 = mysql_query("select * from usuarios order by usuario ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
		  ?>
           
              <option value="<?php echo $row11['codigo']?>"><?php echo $row11['usuario'];?></option>
			  <?php }?>
            </select>
		   <input name="responsable2" type="hidden" size="3"  value="0"/>
          </span></td>
          <td class="Estilo14">F.Vencimiento</td>
          <td><input name="fven" type="text" size="15" maxlength="50"  value="<?php echo date('d-m-Y')?>"  onKeyUp="generar_ceros(event,'0',this)">
		  <button type="reset" id="f_trigger_b1" style="height:18; vertical-align:top" >...</button>
		  
		  
              <script type="text/javascript">
			  
			  var doc_p1="<?php echo $p1 ?>";

			  
    Calendar.setup({
        inputField     :    "fven",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b1",   
        singleClick    :    true,           
        step           :    1                
    });
            </script>	
			
			
			
			
			<?php 
			
		function php2js ($var) {

			if (is_array($var)) {
				$res = "[";
				$array = array();
				foreach ($var as $a_var) {
					$array[] = php2js($a_var);
				}
				return "[" . join(",", $array) . "]";
			}
			elseif (is_bool($var)) {
				return $var ? "true" : "false";
			}
			elseif (is_int($var) || is_integer($var) || is_double($var) || is_float($var)) {
				return $var;
			}
			elseif (is_string($var)) {
				return "\"" . addslashes(stripslashes($var)) . "\"";
			}
		
			return FALSE;
		}

			$js1 = php2js($p1); 
			$js2 = php2js($p2); 
			$js3 = php2js($p3); 
			$js4 = php2js($p4); 
			$js5 = php2js($p5); 
			$js6 = php2js($p6); 
			$js7 = php2js($p7); 
			$js8 = php2js($p8); 
			$js9 = php2js($p9); 
			$js10 = php2js($p10); 
			$js11 = php2js($p11); 
						
			$js_cod = php2js($p1_cod); 
			
			$js_nitems = php2js($nitems);
			
			?>
			
			
			<script language="JavaScript">
			var tab1 = <?php echo $js1; ?>;
			var tab2 = <?php echo $js2; ?>;
			var tab3 = <?php echo $js3; ?>;
			var tab4 = <?php echo $js4; ?>;
			var tab5 = <?php echo $js5; ?>;
			var tab6 = <?php echo $js6; ?>;
			var tab7 = <?php echo $js7; ?>;
			var tab8 = <?php echo $js8; ?>;
			var tab9 = <?php echo $js9; ?>;
			var tab10 = <?php echo $js10; ?>;
			var tab11 = <?php echo $js11; ?>;
			
		//	alert(tab11);
			var tab_cod = <?php echo $js_cod; ?>;
			var tab_nitems = <?php echo $js_nitems; ?>;
			
			</script>				  </td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="41">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td></td>
      <td ></td>
      <td colspan="10"><table width="746" height="5" border="0" cellpadding="0" cellspacing="0" style="border-top: #CCCCCC solid 1px">
        <tr>
          <td width="759" height="5"></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td height="20">&nbsp;</td>
      <td colspan="10"><span class="Estilo14">Producto:</span>
        <input autocomplete="off"  name="codprod"  type="text" size="8"  onKeyUp="validartecla(event,this,'productos')" onFocus="activar2;"/>
        <script>
		  function verfactor(){
		  var codigo=document.formulario.codprod.value;
		  doAjax('buscar_factor.php','&cod='+codigo,'mostrar_factor','get','0','1','','');
		  }
		  function mostrar_factor(texto){
			if(texto ==1){
			document.formulario.precio.readOnly=true;
			}else{
			document.formulario.precio.readOnly=false;
			}
			
			
		  }
		  
		  
		  
		  </script>
        <span class="Estilo15">
        <input name="pro" type="hidden" size="3"  value="0"/>
        </span><span class="Estilo14">
        <input name="termino" type="text" size="20" onFocus="activar(event);" onKeyUp="activar(event)">
          <span class="Estilo15">
          &nbsp;
          <input name="ter" type="hidden" size="3"  value="0"/>
      </span></span><span class="Estilo14">
        Cant.:
		<?php if($_REQUEST['tipomov']==2){?>
	  <input style="text-align:right" name="cantidad"  type="text" size="8" onKeyUp="doAjax('../calcular_precio.php','','mostrar_precio','get','0','1','','');" />
	 <?php }else{?>
 <input style=" text-align:right" name="cantidad"  type="text" size="8" onKeyUp="cambiar_foco(event)" />
	   <?php } ?>&nbsp;P.Unit:
		<input  name="punit" type="text" size="8" style=" text-align:right" onKeyUp="calcular_ptotal()" />
      &nbsp;</span><span class="Estilo14">Total:</span>
      <input style="font:bold; text-align:right" name="precio" type="text" size="8"   onKeyUp="calcular_cant()" />
      <input  name="precio2" type="hidden" size="3"/>	  
      <span class="Estilo14">Notas</span>
      <input name="notas" type="text" size="10" maxlength="30"></td>
    </tr>
    <tr>
      <td colspan="12"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="10">
	  <div id="resultado">
	    <table width="711" border="0" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
          <tr>
            <td width="47" height="18" align="center" bgcolor="#3366CC"><span class="Estilo31">C&oacute;digo</span></td>
            <td width="296" bgcolor="#3366CC"><span class="Estilo31">Descripci&oacute;n</span></td>
            <td width="73" align="center" bgcolor="#3366CC"><span class="Estilo31">UND</span></td>
            <td width="51" align="center" bgcolor="#3366CC"><span class="Estilo31">Cant.</span></td>
            <td width="71" bgcolor="#3366CC"><span class="Estilo32"><span class="Estilo31">P. Unit.</span></span></td>
            <td width="65" bgcolor="#3366CC"><span class="Estilo31">Total</span></td>
            <td width="52" align="center" bgcolor="#3366CC"><span class="Estilo31">Notas</span></td>
            <td width="44" align="center" bgcolor="#3366CC"><span class="Estilo31">E</span></td>
          </tr>
 
          <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
            <td align="center" bgcolor="#F5F5F5">&nbsp;</td>
            <td bgcolor="#F5F5F5">&nbsp;</td>
            <td align="right" bgcolor="#F5F5F5">&nbsp;</td>
            <td bgcolor="#F5F5F5"></td>
            <td align="right" bgcolor="#F5F5F5">&nbsp;</td>
            <td bgcolor="#F5F5F5">&nbsp;</td>
            <td align="center" bgcolor="#F5F5F5"></td>
            <td align="center" bgcolor="#F5F5F5"></td>
          </tr>
		  	  	  
          <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
            <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#FFFFFF">&nbsp;</td>
            <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#FFFFFF"></td>
            <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#FFFFFF"></td>
            <td colspan="2" align="center" bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
            <td align="left" bgcolor="#FFFFFF"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">Items</span></td>
            <td bgcolor="#FFFFFF"><strong id="nitems">0</strong></td>
            <td align="right" bgcolor="#FFFFFF"><input type="hidden" name="estado" value=""></td>
            <td colspan="2" bgcolor="#FFFFFF">Monto</td>
            <td align="right"><strong>
              <input name="monto" type="text" size="10" style="text-align:right"  value="<?php echo number_format($total,2);?>"/>
            </strong></td>
            <td colspan="2" align="center" bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
            <td align="left" bgcolor="#FFFFFF"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">Moneda</span></td>
            <td bgcolor="#FFFFFF"><label style="color:#FF0000" id="moneda"><?php echo "(S/.)" ?></label></td>
            <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
            <td colspan="2" bgcolor="#FFFFFF">Impuesto1(19%)</td>
            <td align="right"><strong>
              <input name="impuesto1" type="text" size="10" style="text-align:right"  value="<?php echo number_format($total*0.19,2);?>"/>
            </strong></td>
            <td colspan="2" align="center" bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
            <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#FFFFFF"></td>
            <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
            <td colspan="2" bgcolor="#FFFFFF"><span class="Estilo111" style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold">TOTAL DOC </span></td>
            <td width="65" align="right"><strong>
              <input name="total_doc" type="text" size="10" style="text-align:right"  value="<?php echo number_format($total+$total*0.19,2);?>"/>
            </strong></td>
            <td colspan="2" align="center" bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
        </table>
	  </div>	  </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="306">

<DIV id=modal style="BORDER-RIGHT: white 3px solid;  BORDER-TOP: white 3px solid; DISPLAY: none;   BORDER-LEFT: white 3px solid;  BORDER-BOTTOM: white 3px solid; BACKGROUND-COLOR:#003366; "> 
    
	  <table width="270" height="150" border="0">
  <tr>
    <td align="center" style="font:Arial, Helvetica, sans-serif; font:bold; font-size:12; color:#FFFFFF">Espere un momento por favor</td>
  </tr>
  <tr>
    <td align="center" valign="bottom" style="font:Arial, Helvetica, sans-serif; font:bold; font-size:10; color:#FFFFFF">Procesando Datos...</td>
  </tr>
  <tr>
    <td align="center"> <img height="45" width="45" src="../imgenes/cargando.gif">	 </td>
	 <tr>
    <td align="center"> 	
	 <INPUT name="button" type=button onClick="Popup.hide('modal')" value=OK>	 </td>
  </tr>
</table>
    </DIV>
	
	
   <!-- <A onClick="Popup.showModal('modal');return false;" href="#">Show Modal 
      Popup</A> <BR>-->
	  <!--
 <A onclick="Popup.showModal('modal',null,null,{'screenColor':'#000000','screenOpacity':.10});return false;" 
      href="http://www.javascripttoolbox.com/lib/popup/example.php#">Show Modal Popup With A Custom Screen</A> 

-->
	  <table width="268" border="0" align="left" cellpadding="0" cellspacing="0">
        <tr>
          <td width="71" align="left"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">Referencia</span></td>
          <td width="197" align="left">
		  <input readonly="readonly"  style="text-align:right" name="serie_ref" id="serie_ref" type="text" size="5" maxlength="3" />
            <input readonly="readonly" style="text-align:right" name="correlativo_ref" id="correlativo_ref" type="text" size="10" maxlength="7" /></td>
        </tr>
      </table></td>
      <td width="47">&nbsp;</td>
      <td width="79"><input name="prueba" type="hidden" size="10" maxlength="10">
      <input name="saldo" type="hidden" size="10" maxlength="10"></td>
      <td width="79">&nbsp;</td>
      <td width="79">&nbsp;</td>
      <td width="79">&nbsp;</td>
      <td width="76" colspan="3">&nbsp;</td>
    </tr>
  </table>
  
    
  
  <div id="new_aux" style="position:absolute; left:330px; top:146px; width:300px; height:180px; z-index:2; visibility:hidden">
  
  <table width="392" height="72" border="1" cellpadding="0" cellspacing="0" bgcolor="#EFD5C2"><!--FFD3B7-->
  <tr>
    <td><table width="413" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="5" align="right"></td>
      </tr>
      <tr>
        <td width="20" height="23" bgcolor="#004F9D">&nbsp;</td>
        <td width="62" bgcolor="#004F9D"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#FFFFFF"><strong>Nuevo </strong></font></td>
        <td width="141" bgcolor="#004F9D">&nbsp;</td>
        <td colspan="2" bgcolor="#004F9D">&nbsp;</td>
      </tr>
      
      <tr>
        <td colspan="5" height="10"></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">T. pers.</span>: </td>
        <td><input name="persona" type="radio" value="radiobutton" style="border: 0px; background-color:#EFD5C2" />
          <span style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold; color:#333333">Jur.</span>
          <input style="border: 0px; background-color:EFD5C2" checked="checked" name="persona" type="radio" value="radiobutton" />
  <span style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold; color:#333333">Nat.</span></td>
        <td width="32">&nbsp;</td>
        <td width="158">&nbsp;</td>
      </tr>
      <tr>
        <td height="20">&nbsp;&nbsp;</td>
        <td align="center"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Ruc</span></td>
        <td><input name="aux_ruc" type="text" size="17" maxlength="11" /></td>
        <td colspan="2"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Dni</span>
          <input name="aux_dni" type="text" size="15" maxlength="8" /></td>
      </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td align="center" style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Cli./Razon</td>
        <td colspan="3"><input name="aux_razon" type="text" size="42" maxlength="100" /></td>
        </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td align="center"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">Contacto</span></td>
        <td colspan="3"><input name="aux_contacto" type="text" size="42" maxlength="100" /></td>
        </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td align="center"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Cargo</span></td>
        <td colspan="3"><input type="text" name="aux_cargo" /></td>
        </tr>
      <tr>
        <td height="30">&nbsp;</td>
        <td><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Direcci&oacute;n</span></td>
        <td colspan="3"><textarea name="aux_direccion" cols="42" rows="3"></textarea></td>
        </tr>
      <tr>
        <td height="29">&nbsp;</td>
        <td colspan="4" align="left"><input type="button" name="Submit" value="Guardar" onClick="guardar_aux();" />
          <input type="button" name="Submit2" value="Cancelar" onClick="cancel_nuevo_aux()" /></td>
        </tr>
	     <tr>
        <td height="10"></td>
        <td></td>
        <td></td>
      </tr>
    </table>
    </td>
  </tr>
  
</table>
  
  
  </div>
  
  
  
  
  
  <div id="productos" style="position:absolute; left:74px; top:180px; width:300px; height:180px; z-index:1; visibility:hidden"> </div>
  
   <div id="auxiliares" style="position:absolute; left:330px; top:146px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>









</form>
</body>

<script>



function calcular_cant(){
var punit=document.formulario.punit.value;
var precio=document.formulario.precio.value;
var total=Math.round((precio/punit)*100)/100;

if(punit!="" && document.formulario.cantidad.value==""){
	if(total>0){
		document.formulario.cantidad.value=total;
	}else{
		document.formulario.cantidad.value="";
	}
}

document.formulario.punit.value=Math.round((precio/document.formulario.cantidad.value)*1000000)/1000000;

		
	
	
}


function gene(){
//document.formulario.suc.value='1';
doAjax('../carga_cbo_tienda.php','','cargar_cbo','get','0','1','','');
}

function activar(e){

	if(e.keyCode == 13){
	document.formulario.ter.value=0;
	document.formulario.cantidad.focus();
	}else{
	document.formulario.ter.value=1;
	}

}
function activar2(){
document.formulario.pro.value=1;
}


function imprimiendo(){

	if(document.formulario.ruc2.value=="1"){
	
//window.open('empresa.php','vent','width=585,height=480,top=180,left=200,status=yes,scrollbars=yes');

//showPopWin('empresa.php', null, 585, 480, '')
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

function enviar(){
	
	var punit='';
	if(document.formulario.codprod.value==''){
	punit=document.formulario.termino.value;
	}else{
	punit=document.formulario.punit.value;
	}	
	
	var permiso4=find_prm(tab4,tab_cod);
	var notas=document.formulario.notas.value;
	
	doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&punitario='+punit+'&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&notas='+notas,'mostrar','get','0','1','','');
	
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

function elegir(cod,des){
document.formulario.codprod.value=cod;
document.formulario.termino.value=des;

document.getElementById('productos').style.visibility='hidden';
document.formulario.ter.value=0;
//document.formulario.cantidad.value=1;

document.formulario.cantidad.disabled=false;
document.formulario.precio.readOnly=false;
document.formulario.punit.disabled=false;

document.formulario.cantidad.focus();
//alert('entro');
//document.formulario.ter.value=1;
}
function elegir2(cod,des){
document.formulario.auxiliar.value=des;
document.formulario.auxiliar2.value=cod;
document.getElementById('auxiliares').style.visibility='hidden';

			var serie=document.formulario.num_serie.value;
			var numero=document.formulario.num_correlativo.value;
			var doc=document.formulario.doc.value;
			var sucursal=document.formulario.sucursal.value;
			var tipomov=document.formulario.tipomov.value;
			
	if(tipomov==1){
	
	doAjax('peticion_datos.php','&serie='+serie+'&numero='+numero+'&doc='+doc+'&sucursal='+sucursal+'&auxiliar='+cod+'&peticion=buscar_prov2','rpta_con_datos2','get','0','1','','');
	}else{
	

	
	
				document.formulario.responsable.disabled=false;
				document.formulario.responsable.focus();
				
		}
		

}

function rpta_con_datos2(texto){
//alert(texto);
var temp=texto.split("?");
		if(temp[1]=="reservado"){
			document.formulario.temp_doc.value=temp[0];
			document.formulario.sucursal.disabled=true;
			document.formulario.doc.disabled=true;
			document.formulario.num_correlativo.disabled=true;
			document.formulario.num_serie.disabled=true;
			document.formulario.auxiliar.disabled=true;
			
			document.formulario.responsable.disabled=false;
			document.formulario.responsable.focus();
		}else{
			 
			 habilitar();
			 
			 seleccionar_cbo('almacen',temp[2]);
			 seleccionar_cbo('responsable',temp[3]);	
			 seleccionar_cbo('condicion',temp[4]);	
			 document.formulario.femi.value=temp[5].substring(0,10);
			 document.formulario.fven.value=temp[6].substring(0,10);
			 
			 			 
			 deshabilitar();
			 
			 var permiso4=find_prm(tab4,tab_cod);
			 
			 doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&punitario='+document.formulario.punit.value+'&accion=mostrarprod&permiso4='+permiso4,'mostrar','get','0','1','','');
			 
				 
				//  document.formulario.estado.value="CONSULTA";			
		}

}


	function rpta_bus_numero(texto){
	
//alert(texto);
//	return false;
		
		var temp=texto.split("?");
		
		if(temp[1]=="reservado"){
			document.formulario.temp_doc.value=temp[0];
			document.formulario.sucursal.disabled=true;
			document.formulario.doc.disabled=true;
			document.formulario.num_correlativo.disabled=true;
			document.formulario.num_serie.disabled=true;
			//document.formulario.auxiliar.disabled=true;
			
		    document.formulario.auxiliar.disabled=false;
			document.formulario.auxiliar.focus();
			document.formulario.auxiliar.select();
			document.formulario.doc_ref.disabled=false;
			
		   	
		}else{
			 if(temp[1]=="noreservado"){
			 document.formulario.num_correlativo.value="";
             document.formulario.num_serie.focus();
			 document.formulario.num_serie.select();
			 }else{
			 
			 habilitar();
			 
			 seleccionar_cbo('almacen',temp[2]);
			 seleccionar_cbo('responsable',temp[3]);	
			 seleccionar_cbo('condicion',temp[4]);	
			 document.formulario.femi.value=temp[5].substring(0,10);
			 document.formulario.fven.value=temp[6].substring(0,10);
			 document.formulario.auxiliar.value=temp[7];
			 document.formulario.incluidoigv.value=temp[8];
			 document.formulario.tmoneda.value=temp[9];
			 
			 document.formulario.serie_ref.value=temp[11];
			 document.formulario.correlativo_ref.value=temp[12];
			 
			 var estado=temp[10];
			 deshabilitar();
			 var permiso4=find_prm(tab4,tab_cod);
			 
			 //var notas=document.formulario.notas.value;
									 
	doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&punitario='+document.formulario.punit.value+'&accion=mostrarprod&estado='+estado+'&permiso4='+permiso4,'mostrar','get','0','1','','');
					
			 }
			 				 			
		}
		
	}


		function deshabilitar(){
		
		document.formulario.sucursal.disabled=true;
		document.formulario.almacen.disabled=true;
		document.formulario.doc.disabled=true;
		document.formulario.num_serie.disabled=true;
		document.formulario.num_correlativo.disabled=true;
		document.formulario.auxiliar.disabled=true;
		document.formulario.responsable.disabled=true;
		document.formulario.femi.disabled=true;
		document.formulario.fven.disabled=true;
	
		}
		
		function habilitar(){
		
		document.formulario.sucursal.disabled=false;
		document.formulario.almacen.disabled=false;
		document.formulario.doc.disabled=false;
		document.formulario.num_serie.disabled=false;
		document.formulario.num_correlativo.disabled=false;
		document.formulario.auxiliar.disabled=false;
		document.formulario.responsable.disabled=false;
		document.formulario.femi.disabled=false;
		document.formulario.fven.disabled=false;
		
		}
		
		

var temp_busqueda="";
var temp_busqueda2="";

function validartecla(e,valor,temp){
//alert(valor.value);
//((e.keyCode>=97) && (e.keyCode<=105)) || 
	var tipomov=document.formulario.tipomov.value;
	document.formulario.tempauxprod.value=temp;
	
	if(document.getElementById('productos').style.visibility=='visible'){
	temp_busqueda=document.formulario.busqueda.value;
	}else{
		if(document.getElementById('auxiliares').style.visibility=='visible'){
		temp_busqueda=document.formulario.busqueda2.value;
		//alert(temp_busqueda);
		}
	
	}
	
	if ( ( (e.keyCode>=96) && (e.keyCode<=105) || (e.keyCode>=48) && (e.keyCode<=57) )  || ((e.keyCode>=65) && (e.keyCode<=90)) || e.keyCode==8 || e.keyCode==32 ) {
	
	doAjax('lista_aux.php','&temp='+temp+'&tipomov='+tipomov,'listaprod','get','0','1','','');
	 //alert('entro');
	}
//alert(e.keyCode);

/*
	if( (e.keyCode>=97) && (e.keyCode<=105) || (e.keyCode>=48) && (e.keyCode<=57) ){
	
	doAjax('lista_aux.php','&temp='+temp+'&tipomov='+tipomov,'listaprod','get','0','1','','');
	doAjax('det_aux.php','&clasificacion=1&nomb_det='+valor.value+'&temp='+temp+'&tipomov='+tipomov,'detalle_prod','get','0','1','','');
	
	//document.getElementById('productos').style.visibility='hidden';
	//document.formulario.codprod.focus();
	}
	*/
	


}

function cambiar_foco(e){
	
	if(e.keyCode==13 && document.formulario.cantidad.value!=0){
	document.formulario.punit.focus();
	}

}

function calcular_ptotal(){
	var totalitem=document.formulario.punit.value*document.formulario.cantidad.value;
	document.formulario.precio.value=Math.round((totalitem)*1000)/1000;
	
	
	
}


function eliminar(codigo){

	if(!document.formulario.codprod.disabled){	
	var permiso4=find_prm(tab4,tab_cod);
	var notas=document.formulario.notas.value; 
	 	 
	doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&cod_delete='+codigo+'&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4,'mostrar','get','0','1',codigo,'eliminar');
	}
}


function seleccionar_cbo(control,valor){
		
		 var valor1=valor;
         var i;
	     for (i=0;i< eval("document.formulario."+control+".options.length");i++)
        {
		
         if (eval("document.formulario."+control+".options[i].value=="+valor1))
            {
			   eval("document.formulario."+control+".options[i].selected=true");
            }
        
        }
		
	}
	
	function ver_new_aux(){
	
		if(document.getElementById('auxiliares').style.visibility=='visible'){
		document.getElementById('auxiliares').style.visibility='hidden';
		document.getElementById('new_aux').style.visibility='visible';
		document.formulario.aux_ruc.focus();
		}
	}
	
	function cancel_nuevo_aux(){
	document.getElementById('auxiliares').style.visibility='visible';
	document.getElementById('new_aux').style.visibility='hidden';
	document.formulario.auxiliar.select();
	}
	
	function  guardar_aux(){
	
	var ruc=document.formulario.aux_ruc.value;
	
	//if(){
	
	var dni=document.formulario.aux_dni.value;
	var razon=document.formulario.aux_razon.value;
	var contacto=document.formulario.aux_contacto.value;
	var cargo=document.formulario.aux_cargo.value;
	var direccion=document.formulario.aux_direccion.value;
	var tipo_mov=document.formulario.tipomov.value;
	var doc=document.formulario.doc.value;
	
	var persona='';
	var tipo_aux='';	
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
	
		if( (persona=="juridica" || doc=="F1" || doc=="FA") && ruc=="" ){
			alert('Ingrese un numero de ruc válido');
			document.formulario.aux_ruc.focus();
			return false;
		}else{
					
		doAjax('peticion_datos.php','&ruc='+ruc+'&dni='+dni+'&razon='+razon+'&contacto='+contacto+'&cargo='+cargo+'&direccion='+direccion+'&persona='+persona+'&tipo_aux='+tipo_aux+'&peticion=save_aux','rspta_aux','get','0','1','','');
		}
	
	}
	
	function rspta_aux(texto){
	
	var temp=texto.split('?');
	
	
	elegir2(temp[0],temp[1])
	//document.formulario.auxiliar.value=temp[1];
	//document.formulario.auxiliar2.value=temp[0];
			
	document.getElementById('new_aux').style.visibility='hidden';		
	//document.formulario.responsable.disabled=false;
	//document.formulario.responsable.focus();		
			
	}
	
	function espec_prod(objeto){
	var codigo=objeto.innerHTML;
	
	window.open('espec_prod.php?codigo='+codigo,'','width=650,height=400,top=300,left=300,scroolbars=no,directories=no,location=no,menubar=no,titlebar=no,toolbar=no,status=yes');	
	
	}

	function selec_busq(){
	
	 var valor1=temp_busqueda;
	// alert(valor1);
 
     var i;
	 for (i=0;i<document.formulario.busqueda.options.length;i++)
        {
		
            if (document.formulario.busqueda.options[i].value==valor1)
               {
			   document.formulario.busqueda.options[i].selected=true;
               }
        
        }
	
	}
	
	function selec_busq2(){
	
	 var valor1=temp_busqueda;
	 //alert(valor1);
 
     var i;
	 for (i=0;i<document.formulario.busqueda2.options.length;i++)
        {
		
            if (document.formulario.busqueda2.options[i].value==valor1)
               {
			   document.formulario.busqueda2.options[i].selected=true;
               }
        
        }
	
	}
	


	function vent_ref(){
	

	var sucursal=document.formulario.sucursal.value;
	
		window.open('../add_refer.php?sucursal='+sucursal,'ventana','width=500,height=300,top=300,left=300,scroolbars=no,directories=no,location=no,menubar=no,titlebar=no,toolbar=no,status=yes');		
		
	}

	function cargar_ref(serie,numero,cod_cli_ref,des_cli_ref,cod_cab_ref){
	
	var permiso4=find_prm(tab4,tab_cod);
	
	doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&cargar_ref'+'&accion=mostrarprod','mostrar','get','0','1','','');
	
	document.formulario.serie_ref.value=serie;
	document.formulario.correlativo_ref.value=numero;
	document.formulario.auxiliar2.value=cod_cli_ref;
	document.formulario.auxiliar.value=des_cli_ref;
	document.formulario.cod_cab_ref.value=cod_cab_ref;
	
	document.formulario.responsable.disabled=false;
	document.formulario.responsable.focus();
	
	}
	
	function mostrar_detalle(){
	
	var permiso4=find_prm(tab4,tab_cod);
	
	doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&cargar_ref'+'&accion=mostrarprod','mostrar','get','0','1','','');
	
	document.formulario.codprod.focus();
	
	}
	
	
	function cbo_cond(){
	
	var doc=document.formulario.doc.value;
	doAjax('peticion_datos.php','&doc='+doc+'&peticion=cargar_cond','cargar_cbo_cond','get','0','1','','');
	
	}
	
	function cargar_cbo_cond(texto){
	document.getElementById('cbo_cond').innerHTML=texto;
	
	}
	
	function ant_imprimir(){
	
	var almacen=document.formulario.almacen.value;
	var serie=document.formulario.num_serie.value;
	var numero=document.formulario.num_correlativo.value;
	
		if(serie!='' && document.formulario.num_serie.disabled && document.formulario.total_doc.value!=0 && document.formulario.almacen.disabled && almacen!="0" && numero!='' ){
	
		imprimir();
		
		}else{
	
			document.formulario.temp_imp.value='S';
			grabar_doc();
			
		}	
	
	}
	
	function imprimir(){
	
	var sucursal=document.formulario.sucursal.value;
	var doc=document.formulario.doc.value;
	var serie=document.formulario.num_serie.value;
	var numero=document.formulario.num_correlativo.value;
	
	if(doc=='BV' || doc=='BI'){
	var formato='rpt_boleta.php';
	}else{
		if(doc=='FA' || doc=='FI'){
		var formato='rpt_factura.php';
		}else{
			if(doc=='GR'){
			var formato='rptguia.php';
			}else{
			
			var formato='';
			}
		
		
		}
	
	
	}
	
	
	if(serie!='' && document.formulario.num_serie.disabled && document.formulario.total_doc.value!=0 && formato!=''){ 
	var win00=window.open('../formatos/'+formato+'?empresa='+sucursal+'&doc='+doc+'&serie='+serie+'&numero='+numero,'ventana2','width=800,height=600,top=100,left=100,scroolbars=yes status=yes');	
	
	win00.focus();
	
	}else{
	alert('No es posible imprimir');
	}
	
	
	}
	
		
</script>
</html>
