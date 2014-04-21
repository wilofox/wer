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
   
   
   
?><script>

//alert(window.parent.form1.tempCodVend.value);
//001 19820 NV  ven 010  cliente:
var temp="<?php echo $_REQUEST['caducado']?>";
var tempNivelUser="<?php echo $_SESSION['nivel_usu'] ?>";

//alert(tempNivelUser);
if(temp=="s"){
window.parent.location.href="index.php";
}
var tc_doc="<?php echo $tcambio; ?>";
</script><script language="JavaScript"> 
//(c) 1999-2001 Zone Web 
function click() { 
	if (event.button==2){ 
	//alert ('Derechos Reservados a Prolyam Software.') 
	} 
} 

document.onmousedown=click ;

function find_prm(prm,codigo){
//alert(prm.length);


	if(document.getElementById("capaCopiarDoc").style.visibility=="visible"){
		var doc=document.frmCopiarDoc.doc.value;
		//if(doc==0)doc=document.forms["formulario"]["doc"].options[1].value;	
	}else{
		var doc=document.formulario.doc.value;
		if(doc==0)doc=document.forms["formulario"]["doc"].options[1].value;
	}



		for (var i=0;i<prm.length;i++){
			if(codigo[i]==doc){
			return prm[i];
			}
		} 
}

</script><!--MMDW 5 -->
<html mmdw="0"  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta mmdw="1"  http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<!--MMDW 6 --><style type="text/css">
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

.Estilo118 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color: #FF0000; }
</style><!--MMDW 7 -->
</head>

<link mmdw="2"  rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<!--MMDW 8 --><script type="text/javascript" src="../javascript/mover_div.js"></script><!--MMDW 9 -->

<!--MMDW 10 --><script type="text/javascript" src="../calendario/calendar.js"></script><!--MMDW 11 -->
<!--MMDW 12 --><script type="text/javascript" src="../calendario/lang/calendar-en.js"></script><!--MMDW 13 -->
<!--MMDW 14 --><script type="text/javascript" src="../calendario/calendar-setup.js"></script><!--MMDW 15 -->
<!--MMDW 16 --><SCRIPT src="../javascript/popup.js" type=text/javascript></SCRIPT><!--MMDW 17 -->

<!--MMDW 18 --><script language="javascript" src="../miAJAXlib.js"></script><!--MMDW 19 -->
<!--<script language="javascript" src="jquery[1].hotkeys-0.7.7-packed.js"></script>-->

    <!--MMDW 20 --><script src="../jquery-1.2.6.js"></script><!--MMDW 21 -->
    <!--MMDW 22 --><script src="../jquery.hotkeys.js"></script><!--MMDW 23 -->
	<!--<script src="../mootools-comprimido-1.11.js"></script>-->
	<!--<script src="../modal.js"></script>-->
	<!--<script language="javascript" src="miAJAXlib2.js"></script>-->
	<!--MMDW 24 --><script type="text/javascript" src="../modalbox/lib/prototype.js"></script><!--MMDW 25 -->
	<!--MMDW 26 --><script type="text/javascript" src="../modalbox/lib/scriptaculous.js?load=effects"></script><!--MMDW 27 -->
	
	<!--MMDW 28 --><script type="text/javascript" src="../modalbox/modalbox.js"></script><!--MMDW 29 -->
	<link mmdw="3"  rel="stylesheet" href="../modalbox/modalbox.css" type="text/css" />
	

	
<!--MMDW 30 --><?php 
$fecha=date("d-m-Y");
?><!--MMDW 31 -->

<!--MMDW 32 --><script>
var scrollDivs=new Array();
scrollDivs[0]="choferes";
scrollDivs[1]="capaCopiarDoc";

var temporal_teclas="";
var temp_mon="01";
var array_percepsuc=new Array();
var array_idsuc=new Array();

 jQuery(document).bind('keydown', 'Ctrl+e',function (evt){jQuery('#_up').addClass('dirty');
//	alert('f5');
	event.keyCode=0;
	event.returnValue=false;
	
	eliminar_doc();
	
return false; });

 jQuery(document).bind('keydown', 'f4',function (evt){jQuery('#_up').addClass('dirty');
//	alert('f5');
	event.keyCode=0;
	event.returnValue=false;
	
	
		
	verCopiarDoc();
			
return false; });
 

function verCopiarDoc(){
	
	//alert(document.getElementById('estado').innerHTML);
	
	
	if(document.getElementById('estado').innerHTML=="CONSULTA" || document.getElementById('estado').innerHTML=="ANULADO"){
		if(document.formulario.tserie.value=='S'){
		alert("No se puede copiar documento con serie ");
		return false;
		}
	
	
		generateCoverDiv("capa_fondo","#000000",10);
		ocultarCbos();
		document.getElementById("capaCopiarDoc").style.visibility="visible";
		document.frmCopiarDoc.numeroOrigen.value=document.formulario.num_correlativo.value;
		document.frmCopiarDoc.serieOrigen.value=document.formulario.num_serie.value;
		document.frmCopiarDoc.auxOrigen.value=document.formulario.auxiliar.value;
		document.frmCopiarDoc.auxOrigen2.value=document.formulario.auxiliar2.value;
		document.frmCopiarDoc.cod_cabaCopiar.value=document.formulario.temp_doc.value;
		
            document.frmCopiarDoc.sucursal.style.visibility='visible';
			document.frmCopiarDoc.almacen.style.visibility='visible';
			document.frmCopiarDoc.doc.style.visibility='visible';
			document.frmCopiarDoc.responsable.style.visibility='visible';
		
		
		for(var i=0; i<document.formulario.doc.length;i++){
			if(document.formulario.doc.options[i].value==document.formulario.doc.value){
				document.frmCopiarDoc.docOrigen.value=document.formulario.doc.options[i].text;
			}	
		}
		
		document.frmCopiarDoc.sucursal.focus();
	
	}else{
	alert("No es posible copiar el documento");
	}	

}

function ocultarCbos(){
	
	/*
	for(var i=0;i<document.formulario.elements.length;i++){
	//alert(document.formulario.elements[i].type);
	 	if(document.formulario.elements[i].type=="select-one"){
		 document.formulario.elements[i].style.visibility="hidden";
		}
	}
	*/
	
	document.formulario.sucursal.style.visibility="hidden";
	document.formulario.almacen.style.visibility="hidden";
	document.formulario.doc.style.visibility="hidden";
	document.formulario.responsable.style.visibility="hidden";
	document.formulario.condicion.style.visibility="hidden";
	document.formulario.presentacion.style.visibility="hidden";
	
	
	
}

function mostrarCbos(){

	for(var i=0;i<document.formulario.elements.length;i++){
	//alert(document.formulario.elements[i].type);
	 	if(document.formulario.elements[i].type=="select-one"){
		 document.formulario.elements[i].style.visibility="visible";
		}
	}

}


function eliminar_doc(){

var feli="<?php echo date("d-m-Y")?>";
if((tempNivelUser==1 && feli==document.formulario.femi.value) || tempNivelUser!=1){
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
	var cod_cab=document.formulario.temp_doc.value;
	//alert(cod_cab);
	//return false;
	document.formulario.carga.value="S";
		if(confirm(" Esta seguro que desea ELIMINAR este Documento ?")){
		doAjax('peticion_datos.php','&sucursal='+sucursal+'&tienda='+tienda+'&numero='+numero+'&serie='+serie+'&doc='+doc+'&tipomov='+tipomov+'&auxiliar='+auxiliar+'&cod_cab='+cod_cab+'&peticion=eliminar_doc','mostrar_eliminacion','get','0','1','','');
		}else{
			
		}
	 
	 }else{
	 alert('No tiene permniso para eliminar este documento');
	 }
}else{
	alert('El usuario Nivel Vendedor no tiene autorizado la Eliminacion de Doc. Fechas Anteriores');
}
}

function anular_doc(){
var feli="<?php echo date("d-m-Y")?>";
//alert(feli+"=="+document.formulario.femi.value);
if((tempNivelUser==1 && feli==document.formulario.femi.value) || tempNivelUser!=1){
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
}else{
	alert('El usuario Nivel Vendedor no tiene autorizado la Anulacion de Doc. Fechas Anteriores');
}
}


function mostrar_eliminacion(texto){
	//document.formulario.pruebas.value=texto;
//alert(texto);return false;
	if(texto==''){
		document.formulario.submit();
	}else{
	
		if(texto=='referencia'){
			alert('Este documento se encuentra referenciado');		
		}else{
			alert('Una de las series de este documento ya tiene salida. ');
		}
	}
}



jQuery(document).bind('keydown', 'f2',function (evt){jQuery('#_up').addClass('dirty');
	
//	var tecla=window.event.keyCode;
		
 	if (temporal_teclas=="") {
	
		var total_doc=document.formulario.total_doc.value;
		if(total_doc!=0){
		temporal_teclas='grabar';
		grabar_doc();
		}else{
			var permiso16=find_prm(tab16,tab_cod);
		    if(permiso16=='S'){
			grabar_doc();
			}else{
			alert('No se puede guardar un documento sin valor');			
			}
			
		}	
		
	}else{
	event.keyCode=0;
	event.returnValue=false;

	}

return false; });


function grabar_doc(){
			
			var permiso16=find_prm(tab16,tab_cod);

			
			var total_doc=document.formulario.total_doc.value;
			
			if(total_doc!=0 || permiso16=='S'){
			
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
			var doc=document.formulario.doc.value;
			var serie=document.formulario.num_serie.value;
			var numero=document.formulario.num_correlativo.value;
			var auxiliar=document.formulario.auxiliar2.value;
			var impto=document.formulario.impto.value;
			var transportista=document.formulario.transportista.value;
			var chofer=document.formulario.id_chofer.value;
			var nom_chofer=document.formulario.nom_chofer.value;
			var percepcion=document.formulario.percepcion.value;
			var dirPartida=document.formulario.dirPartida.value;
			var dirDestino=document.formulario.dirDestino.value;

			//alert(serie_ref);
			
			var obs1=document.formulario.obs1.value;
			var obs2=document.formulario.obs1.value;
			var obs3=document.formulario.obs1.value;
			var obs4=document.formulario.obs1.value;
			var obs5=document.formulario.obs1.value;
			var fecharegis=document.formulario.fecharegis.value;
			
			var kardex_doc=find_prm(tab_kardex_doc,tab_cod);			
			var act_kardex_doc=find_prm(tab10,tab_cod);						
			document.formulario.accion.value="grabar";
			
			//alert(document.getElementById('estado').innerHTML);
			var porcen_percep=0;
				if(document.formulario.est_percep_clie.value!=0){
				porcen_percep=document.formulario.por_percep_clie.value;				
				}				
			
			
			
				  if(document.getElementById('estado').innerHTML=="CONSULTA" || document.getElementById('estado').innerHTML=="ANULADO"){
				  alert('Este documento solo es de consulta');
				  }else{
				  
				  document.formulario.tempSave.value="G";
				  serieOT=document.formulario.serieOT.value;
				  numeroOT=document.formulario.numeroOT.value;
				  
		doAjax('peticion_datos.php','&temp_doc='+temp_doc+'&responsable='+responsable+'&tipomov='+tipomov+'&tienda='+tienda+'&condicion='+condicion+'&femision='+femision+'&fvencimiento='+fvencimiento+'&monto='+monto+'&impuesto1='+impuesto1+'&total_doc='+total_doc+'&incluidoigv='+incluidoigv+'&auxiliar='+auxiliar+'&tmoneda='+tmoneda+'&tcambio='+tcambio+'&peticion=save_doc'+'&sucursal='+sucursal+'&correlativo_ref='+correlativo_ref+'&serie_ref='+serie_ref+'&obs1='+obs1+'&obs2='+obs2+'&obs3='+obs3+'&obs4='+obs4+'&obs5='+obs5+'&cod_cab_ref='+cod_cab_ref+'&kardex_doc='+kardex_doc+'&act_kardex_doc='+act_kardex_doc+'&doc='+doc+'&serie='+serie+'&numero='+numero+'&auxiliar='+auxiliar+'&impto='+impto+'&transportista='+transportista+'&chofer='+chofer+'&nom_chofer='+nom_chofer+'&percepcion='+percepcion+'&porcen_percep='+porcen_percep+'&dirPartida='+dirPartida+'&dirDestino='+dirDestino+'&fecharegis='+fecharegis+'&serieOT='+serieOT+'&numeroOT='+numeroOT,'mostrar_grabacion','get','0','1','','');
				
				  }
						
			}else{
			alert('No se puede guardar el documento sin  detalle');						
			}
	
}

function CountSubUnidad(texto){
//alert(texto);
	document.formulario.cantSubUnidad.value=texto;
}	
						
function mostrar_grabacion(texto){

document.formulario.tempSave.value="";
//alert(texto);
		if(texto=='error'){
		
			alert('Documento no grabó.....Verifique su conexión de red.');
			document.formulario.submit();
			return false;
			
		}
		
		if(texto!='' && texto!='error'){
			
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
		
			if(document.formulario.temp_imp.value=='S'){
			imprimir();
			}
			
			document.formulario.submit();
			
	   }

//document.formulario.pruebas.value=texto;


}

var tempColor="";
jQuery(document).bind('keyup', 'up',function (evt){jQuery('#_up').addClass('dirty');
	//document.getElementById('TablaDatos').rows[0].style.background='#FFCC00';
	if(document.getElementById('productos').style.visibility=='visible'){
	
	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
//	alert(document.getElementById('tblproductos').rows.length);
		if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb' && (i!=0) ){
		document.getElementById('tblproductos').rows[i].style.background=document.getElementById('tblproductos').rows[i].bgColor;
		document.getElementById('tblproductos').rows[i-1].style.background='#FFF1BB';
			
			tempColor=document.getElementById('tblproductos').rows[i-1];
			
			location.href="#ancla"+(i-1);
			document.formulario.codprod.focus();
			
			if(i%3==0 && i!=0){
			//capa_desplazar = $('detalle');
			//capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y - 60);
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
		
		tempColor=document.getElementById('tblproductos1').rows[i-1];
			
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
			
			tempColor=document.getElementById('tblproductos').rows[i+1];
			
			if(i%4==0 && i!=0){
			//alert();
			location.href="#ancla"+i;
			document.formulario.codprod.focus();
			
			//capa_desplazar = $('detalle');
			//var capa_desplazar=document.getElementById('detalle').style.overflowY.length;
			//document.getElementById('detalle').style.overflowY.length='200px';
			//document.getElementById('detalle').style.overflowY.length=capa_desplazar + 60 +'px';
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
			tempColor=document.getElementById('tblproductos1').rows[i+1];
			
			if(i%4==0 && i!=0){
			
			location.href="#ancla"+i;
			document.formulario.auxiliar.focus();
			//capa_desplazar = $('detalle1');
			//capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y + 60);
			}
			
			break;
				
			}
		}
 	}
	
	
 return false; });
 

jQuery(document).bind('keyup', 'return',function (evt){jQuery('#_return').addClass('dirty'); 
		
			var nombreVariable=document.getElementById('MB_frame');
			try {
				 if (typeof(eval(nombreVariable)) != 'undefined' ){
					 if (eval(nombreVariable) != null){
					return false();
					}
				}
			 } catch(e) { }
			 
			//alert(typeof(eval(nombreVariable)));
			if(isset(nombreVariable)){
			return false;
			}
			
  	if(document.activeElement.name=='sucursal' || document.activeElement.name=='almacen' || document.activeElement.name=='doc' || document.activeElement.name=='responsable' || document.activeElement.name=='condicion' || document.activeElement.name=='presentacion' ){
	
		cambiar_enfoque(document.activeElement);
		
		if(document.activeElement.name=='almacen' && document.formulario.almacen.value==0 ){
		doAjax('../carga_cbo_tienda.php','&codsuc='+document.formulario.sucursal.value,'cargar_cbo','get','0','1','','');
		}
		
		if(document.activeElement.name=='presentacion'){
		document.formulario.cantidad.focus();
		}
				
	}

	
	if(document.getElementById('productos').style.visibility=='visible'){
		for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
			if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb'){
			
		var temp=document.getElementById('tblproductos').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
		var temp1=document.getElementById('tblproductos').rows[i].cells[1].childNodes[0].innerHTML;
		var temp3=document.getElementById('tblproductos').rows[i].cells[3].innerHTML;
		var temp4=document.getElementById('tblproductos').rows[i].cells[4].innerHTML;
		// alert(temp4);
				
		var unidad=temp4.split("-");
		document.formulario.series.value=unidad[4];
		
		if(unidad[4]=='S'){		
			for (var h=0;h<document.getElementById('detalle_doc_gen').rows.length;h++) { 
			var temp1x=document.getElementById('detalle_doc_gen').rows[h].cells[0].childNodes[0].innerHTML;
				if(temp==temp1x){
				alert("Producto con serie ya registrado");
				return false;
				}
			}
		}
		   
	   document.formulario.uni_p.value=unidad[0];
	   document.formulario.factor_p.value=unidad[1];
	   document.formulario.precio_p.value=unidad[2];
	   document.formulario.prod_moneda.value=unidad[3];
	   
	   document.formulario.serie_ing.value="";
	   document.formulario.pruebas.value=unidad[5];
	   document.formulario.kardex_prod.value=unidad[11];
	   document.formulario.codAnexProd.value=unidad[15];
	  // document.formulario.precosto.value=unidad[6];
	   
	   
	   
	   var prod_moneda=unidad[3];
		if(document.formulario.tipomov.value==2){
				
			var precosto=unidad[6];
			/*
			if(prod_moneda=='01' && document.getElementById('moneda').innerHTML=='(US$.)'){
			precosto=parseFloat(precosto/tc_doc).toFixed(4);
			}else{
				if(prod_moneda=='02' && document.getElementById('moneda').innerHTML=='(S/.)'){
				precosto=parseFloat(precosto*tc_doc).toFixed(4);
				}
			
			}
			*/
			document.formulario.precosto.value=precosto;
						
	    }else{
			var precosto=unidad[6];
			if(precosto<0 || tempNivelUser==2){
			precosto=0.00;
			}
						
			if(document.getElementById('moneda').innerHTML=='(US$.)'){
			precosto=parseFloat(precosto/tc_doc).toFixed(4);
			}
			document.formulario.punit.value=precosto;
		
		}
		
		document.formulario.codBarraEnc.value=unidad[13];
	   
	   var tempDes=temp1.split("|");
	   elegir(temp,tempDes[1].substring(8,tempDes[1].length));
	   //elegir(temp,temp1);

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
		var ruc=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].innerHTML;
		
		var temp4=document.getElementById('tblproductos1').rows[i].cells[4].innerHTML.split("-");
		//alert(temp4);
		document.formulario.est_percep_clie.value=temp4[8];
		document.formulario.por_percep_clie.value=temp4[9];
		document.formulario.dirDestino.value=temp4[10];
		

			 if( (doc=='FA' || doc=='F1') && ruc==""  ){
			 alert(" Cliente no tiene Ruc ");
			 return false;
			 }else{
			 		 
			 temp1=temp1.replace('&amp;','&');
			 //alert(temp1);
			 elegir2(temp,temp1);
			 }		  

			}
		 }
	   }
	   
	   
	   if(document.formulario.cantidad.value!="" && document.formulario.codprod.value!="" && document.formulario.punit.value!="" && document.formulario.cantidad.value!=0  )
		{
		
		//-------------------control de items-------------------------------------------
		 
				 for(var i=0;i<tab_nitems.length;i++){
				 
					 if(tab_cod[i]==document.formulario.doc.value){
							var items_max=tab_nitems[i];		 
					 }
				 
				 }
		 		
				var mer=parseInt(document.getElementById('nitems').innerHTML)+1;
			
					if(mer>items_max){
					alert('No es permitido más items en el documento...');
					return false;
					}
				
		//--------------------------------------------------------------------------------
			
			
					var prms_doc_stock=find_prm(tab1,tab_cod);
			
					var cant=document.formulario.cantidad.value;
					var saldo=document.formulario.saldo.value;
					var kardex_prod=document.formulario.kardex_prod.value;
					 if(document.formulario.tipomov.value==2){
					 			
					//Cantidad de sub unidad
					//alert(saldo*(document.formulario.factor_p.value/2));
					//alert(((cant*2)*10)/document.formulario.factor_p.value);
						
					if (document.formulario.cantSubUnidad.value>0){
						saldo=document.formulario.cantSubUnidad.value;
					}
					
					
										
						if( parseFloat(saldo) >= parseFloat(cant) || prms_doc_stock=='N' || kardex_prod=='N' ){
						
							var permiso10=find_prm(tab10,tab_cod);
							//alert(permiso10);
							
								if(document.formulario.series.value=='S' && document.formulario.serie_ing.value=="" && permiso10=='S' ){
								//alert('el producto maneja series');
								
								var cant=document.formulario.cantidad.value;
								var randomnumber=Math.floor(Math.random()*99999);
								var producto=document.formulario.codprod.value;
								var fecha=document.formulario.femi.value;
								var tienda=document.formulario.almacen.value;
								var cod_cab_ref=document.formulario.cod_cab_ref.value;
									
									Modalbox.show('sal_series.php?cant='+cant+'&ran='+randomnumber+'&producto='+producto+'&fecha='+fecha+'&tienda='+tienda+'&cod_cab_ref='+cod_cab_ref, {title: 'Serie de productos ( SALIDAS )', width: 500}); 	return false;
									
									
									//alert();
									
								}
							
								if(document.formulario.pruebas.value!=""){
										var producto=document.formulario.codprod.value;
										var accion="";
										var series="_"+document.formulario.pruebas.value;
										var tienda=document.formulario.almacen.value;
										
										doAjax('peticion_datos.php','&peticion=sal_series&series='+series+'&producto='+producto+'&accion='+accion+'&tienda='+tienda,'rspta_aceptar_sal_serie','get','0','1','','');
								}
							
							
						  var permiso16=find_prm(tab16,tab_cod);
						 // alert(permiso16);
						  if(permiso16=='N'){
							if((document.formulario.precio.value==0 || document.formulario.precio.value=='' ) && document.formulario.doc.value!='GR'){
								//alert(document.formulario.doc.value);
								document.formulario.punit.focus();
								document.formulario.punit.select();							
								return false;
	
							}
							if(document.activeElement.name=='cantidad'){
							document.formulario.punit.focus();
							document.formulario.punit.select();	
							return false;
							}
						  }	
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
						var permiso16=find_prm(tab16,tab_cod);
					//	alert(permiso16);
						if(permiso16=='N'){
							if(document.formulario.punit.value==0 || document.formulario.punit.value=='' ){
							document.formulario.punit.focus();
							document.formulario.punit.select();
							return false;
							}
						}						
					doAjax('buscar_item.php','','buscar_item2','get','0','1','','');
					
					}	
								
						
		}else{
			//Para texto sin valor.
			//alert();
			//if(document.formulario.cantidad.value=="" && document.formulario.termino.value!="" && document.formulario.codprod.value=="" && document.formulario.punit.value=="" ){
			if(document.formulario.termino.value!="" && document.formulario.codprod.value==""){
			//alert();
			enviar();
			}else{
				
				nombreVariable=document.getElementById('MB_frame');
				
					if(document.formulario.cantidad.value!="" && document.formulario.termino.value!="" && document.formulario.codprod.value!="" && (document.formulario.punit.value=="" || document.formulario.punit.value==0) && !isset(nombreVariable) ){
					
					document.formulario.punit.focus();
					document.formulario.punit.select();
					
					}
				
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

 
	func_f8();	

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
  jQuery(document).bind('keydown', 'f10',function (evt){jQuery('#_f3').addClass('dirty');
	event.returnValue=false;
	event.keyCode=0;
	
	  if(document.getElementById('auxiliares').style.visibility=='visible'){
	  editCliente();
	  }
		
 return false; }); 
  
 jQuery(document).bind('keydown', 'Alt+r',function (evt){jQuery('#_Alt_r').addClass('dirty');
	event.returnValue=false;
	event.keyCode=0;
	if(!document.getElementById("doc_ref").disabled){
	vent_ref();
	}
		
 return false; });
 
  jQuery(document).bind('keydown', 'ctrl+r',function (evt){jQuery('#_Alt_r').addClass('dirty');
	event.returnValue=false;
	event.keyCode=0;
			
 return false; });
 jQuery(document).bind('keydown', 'ctrl+w',function (evt){jQuery('#_Alt_r').addClass('dirty');
	event.returnValue=false;
	event.keyCode=0;
			
 return false; });	 
 
}

  	 


function func_f8(){
	if(!document.formulario.codprod.disabled && document.getElementById('productos').style.visibility!='visible' ){
				
					
			cambiar_moneda_ini();
			
			
		}else{
			if(document.getElementById('productos').style.visibility=='visible'){
			
			   for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
				  if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb'){
				
					var temp=document.getElementById('tblproductos').rows[i].cells[0].childNodes[0].childNodes[0]
			
					//espec_prod(temp);
			//var temp3=document.getElementById('tblproductos').rows[i].cells[3].innerHTML;
			
				var codigo=temp.innerHTML;
				var moneda=document.formulario.tmoneda.value;
				var sucursal=document.formulario.sucursal.value;
				
					window.open('espec_prod.php?codigo='+codigo+'&moneda='+moneda+'&sucursal='+sucursal,'','width=650,height=420,top=300,left=300,scroolbars=yes,directories=no,location=no,menubar=no,titlebar=no,toolbar=no,status=yes');	
		   
					}
				 }
			
			
		   }
		
		
	 }
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
				
		var nombreVariable=document.getElementById('MB_frame');
		if(isset(nombreVariable)){
		Modalbox.hide();
		return false;		
		}
								
		if(document.getElementById('choferes').style.visibility=='visible'){
		document.getElementById('choferes').style.visibility='hidden';
		document.getElementById('cbo_uni').style.visibility='visible';
		
			if(document.getElementById("capaCopiarDoc").style.visibility=="visible"){
			document.frmCopiarDoc.sucursal.style.visibility='visible';
			document.frmCopiarDoc.almacen.style.visibility='visible';
			document.frmCopiarDoc.doc.style.visibility='visible';
			document.frmCopiarDoc.responsable.style.visibility='visible';
			
			//document.getElementById('choferes').style.zIndex='2';
			}

		
		return false;
		}
		
		
		
		
		
		if(document.getElementById('capaCopiarDoc').style.visibility=='visible'){
		
		elemento=document.getElementById('capa_fondo');
		elemento.parentNode.removeChild(elemento);
		
		vaciar_sesiones();
		document.getElementById('capaCopiarDoc').style.visibility='hidden';
		
		document.frmCopiarDoc.sucursal.options[0].selected="selected";
		document.frmCopiarDoc.almacen.options[0].selected="selected";
		document.frmCopiarDoc.doc.options[0].selected="selected";
		document.frmCopiarDoc.numero.value="";
		document.frmCopiarDoc.serie.value="";
		document.frmCopiarDoc.temp_doc.value="";
				document.frmCopiarDoc.sucursal.disabled=false;
				document.frmCopiarDoc.almacen.disabled=false;
				document.frmCopiarDoc.doc.disabled=false;
				document.frmCopiarDoc.serie.disabled=false;
				document.frmCopiarDoc.numero.disabled=false;
				document.frmCopiarDoc.btncopiar.disabled=true;
				
								
			document.frmCopiarDoc.sucursal.style.visibility='hidden';
			document.frmCopiarDoc.almacen.style.visibility='hidden';
			document.frmCopiarDoc.doc.style.visibility='hidden';
			document.frmCopiarDoc.responsable.style.visibility='hidden';				
		mostrarCbos();
		return false;
		}

		
		
		if(document.getElementById('cambiarDirec').style.visibility=='visible'){
		document.getElementById('cambiarDirec').style.visibility='hidden';
		document.getElementById('cbo_uni').style.visibility='visible';
		return false;
		}
		


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
	mostrar_cbos();
	document.getElementById('new_aux').style.visibility='hidden';
	document.formulario.prov_asoc.value='';
	
	
	
	}		
}


function liberar_numero(texto){
//alert(texto);
document.formulario.submit();
}

var user_tienda="<?php echo $_SESSION['user_tienda'] ?>";
var user_sucursal="<?php echo $_SESSION['user_sucursal'] ?>";

function iniciar(){
//alert(user_tienda+" "+user_sucursal);

if( (user_tienda.length==3 || user_sucursal!="0") && user_tienda!=0 ){

	seleccionar_cbo('sucursal',user_sucursal);
	doAjax('../carga_cbo_tienda.php','&codsuc='+document.formulario.sucursal.value,'cargar_cbo3','get','0','1','','')
}

	if(temp_mon=='02'){
			document.getElementById('moneda').innerHTML='(S/.)';	
	}else{
			document.getElementById('moneda').innerHTML='(US$.)';
	}

document.formulario.sucursal.focus();
//document.formulario.codprod.focus();

document.formulario.almacen.disabled=true;
document.formulario.doc.disabled=true;
document.formulario.num_serie.disabled=true;
document.formulario.num_correlativo.disabled=true;
document.formulario.auxiliar.disabled=true;
document.formulario.responsable.disabled=true;
document.formulario.condicion.disabled=true;
document.formulario.femi.disabled=true;
document.getElementById("f_trigger_b2").disabled=true;

document.formulario.fven.disabled=true;
document.getElementById("f_trigger_b1").disabled=true;

document.formulario.codprod.disabled=true;
document.formulario.cantidad.disabled=true;
document.formulario.notas.disabled=true;
document.formulario.termino.disabled=true;
document.formulario.precio.readOnly=true;
document.formulario.punit.disabled=true;
document.formulario.pro.value=1;

}

function mostrar(texto) {
//alert();
var r = texto;
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
		borrar();
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
	
	/*
		if(document.formulario.tempCopiar=='S'){
			if(document.form1.punit_det.length >0){
				  for (var i=0;i<document.form1.punit_det.length;i++){ 
					   cod=document.form1.punit_det[i].disabled=false;
					} 
			}else{	
				 document.form1.punit_det.disabled=false;
			}
		}
	*/
	

	
}

function borrar() { 
		
		var n=document.formulario.presentacion.options.length;
   		for (var i=0;i<n;i++)  {
		//alert(i);
        	aBorrar = document.forms["formulario"]["presentacion"].options[0];
			aBorrar.parentNode.removeChild(aBorrar);
			
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
	var temp_criterio='';
	
	if(document.formulario.tempauxprod.value=='auxiliares'){
	document.getElementById('auxiliares').innerHTML=r;
	document.getElementById('auxiliares').style.visibility='visible';
	ocultar_cbos();
	valor=document.formulario.auxiliar.value;    
	temp_criterio=temp_busqueda2;
	selec_busq2();
	}
	if(document.formulario.tempauxprod.value=='productos'){
	document.getElementById('productos').innerHTML=r;
	document.getElementById('productos').style.visibility='visible';
	valor=document.formulario.codprod.value;
	temp_criterio=temp_busqueda;
		
	selec_busq();
	}
//alert();
	var temp=document.formulario.tempauxprod.value;
	var tipomov=document.formulario.tipomov.value;
	var tienda=document.formulario.almacen.value;
	var moneda_doc=document.formulario.tmoneda.value;
	
	//-----------------------------control busqueda-------------------------------------------------
	var tipoBus="";
	var tempValor=valor;
	//alert(tempValor);
	//cancel_peticion()
	//alert(valor.value.substring(0,1));
	if(tempValor.substring(0,1)=='*' || tempValor.substring(0,2)=='**'){
				if(tempValor.length<5){
				return false;
				}
				tipoBus="aprox";
				if(tempValor.substring(0,2)=='**')
				tempValor=tempValor.substring(2,tempValor.length);
				else
				tempValor=tempValor.substring(1,tempValor.length);
						
		//alert();	}else{
				tipoBus="ini";
				if(tempValor.length<3){
				return false;
				}	
	}
	//-------------------------------------------------------------------------
	
	
	
//	alert(temp_criterio);
	doAjax('det_aux.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc='+document.formulario.prov_asoc.value+'&moneda_doc='+moneda_doc+'&tipoBus='+tipoBus,'detalle_prod','get','0','1','','');
//alert();				//doAjax('det_aux.php','&clasificacion=1&temp=auxiliares&tipomov='+document.formulario.tipomov.value+'&prov_asoc='+texto,'detalle_prod','get','0','1','','');
	
}		
		
function detalle_prod(texto){

//document.formulario.prueba.value=parseFloat(document.formulario.prueba.value)+1;
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
	if(document.getElementById("capaCopiarDoc").style.visibility=="visible"){
	document.getElementById('div2').innerHTML=r;
	cargar_cbo_doc();
	}else{
	document.getElementById('cbo_tienda').innerHTML=r;
	document.formulario.almacen.focus();
	cargar_cbo_doc();
	}
}

function cargar_cbo3(r){
    document.getElementById('cbo_tienda').innerHTML=r;
	document.formulario.almacen.focus();
		
	if(user_tienda.length==3){
		seleccionar_cbo('almacen',user_tienda);
				
	}
	
	 var tipomov=document.formulario.tipomov.value;
	 var empresa=document.formulario.sucursal.value;
	 var tempCodVend=window.parent.form1.tempCodVend.value;
		
		doAjax('../carga_cbo_doc.php','&tipomov='+tipomov+'&empresa='+empresa+'&tempCodVend='+tempCodVend,'res_cargar_cbo_doc3','get','0','1','','');
}

function res_cargar_cbo_doc3(texto){
var temp=texto.split("?");


document.getElementById('cbo_doc').innerHTML=temp[0];
	
	//alert(temp[12]+" "+temp[18]);
				
			 tab1 =temp[1].split(",");
			 tab2 =temp[2].split(",");
			 tab3 =temp[3].split(",");
			 tab4 =temp[4].split(",");
			 tab5 =temp[5].split(",");
			 tab6 =temp[6].split(",");
			 tab7 =temp[7].split(",");
			 tab8 =temp[8].split(",");
			 tab9 =temp[9].split(",");
			 tab10 = temp[10].split(",");
			 tab11 = temp[11].split(",");
			
			//alert(tab10);
			 tab_cod = temp[12].split(",");
			 tab_nitems =temp[13].split(",");
             tab_serie =temp[14].split(",");
			 tab_numero_ini =temp[15].split(",");
			 tab_numero_fin =temp[16].split(",");
			 tab_impresion =temp[17].split(",");
			 tab_formato =temp[18].split(",");
			 tab_kardex_doc=temp[19].split(","); 
			 tab_kardex_doc=temp[19].split(","); 	
			 tab_impuesto1=temp[20].split(",");
			 tab_min_percep=temp[24].split(","); 
			 tab_moneda=temp[26].split(","); 
			 
			 tab12 = temp[21].split(",");
			 tab13 = temp[22].split(",");
			 tab14 = temp[23].split(",");
			 tab15 = temp[25].split(",");
			 tab16 = temp[27].split(",");
			 tab17 = temp[28].split(",");
			 tab18 = temp[29].split(",");
			 tab19 = temp[33].split(",");
			 
			 document.formulario.doc.disabled=false;
			 document.formulario.doc.focus();
			 document.formulario.sucursal.disabled=true;
			 document.formulario.almacen.disabled=true;
			 
			 //tab19=temp[31].split(",");
			 //tab20=temp[32].split(",");
			 tab_cola1=temp[31].split(",");
			 //tab_cola2=temp[32].split(",");
			 tab_numauto=temp[34].split(",");
			 tab_descuento=temp[35].split(",");
			 tab_mostrarOT=temp[36].split(",");
			// alert(tab19);
			 
}


</script><!--MMDW 33 -->

<link mmdw="4"  href="../styles.css" rel="stylesheet" type="text/css">
<!--MMDW 34 --><style type="text/css">
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
.Estilo115 {
	color: #FF0000;
	font-weight: bold;
}
.Estilo116 {font-size: 11px}
-->
</style><!--MMDW 35 -->


<!--MMDW 36 --><script>
function vaciar_sesiones(){

	if(document.formulario.tempSave.value==""){
		if(document.getElementById("capaCopiarDoc").style.visibility=="visible"){
		
		var idtempdoc=document.frmCopiarDoc.temp_doc.value;
		doAjax('vaciar_sesiones.php','&idtempdoc='+idtempdoc,'','get','0','1','','');
		return false;
		
		}
		
		if(document.formulario.num_correlativo.disabled && (document.getElementById('estado').innerHTML=="INGRESO" ||  document.getElementById('estado').innerHTML=="")){
	//	alert();
		var sucursal=document.formulario.sucursal.value;
		var numero=document.formulario.num_correlativo.value;
		var serie= document.formulario.num_serie.value;
		var doc=document.formulario.doc.value;
		var tipomov=document.formulario.tipomov.value;
		var auxiliar=document.formulario.auxiliar2.value;
		var tienda=document.formulario.almacen.value;

		
		doAjax('vaciar_sesiones.php','&sucursal='+sucursal+'&numero='+numero+'&serie='+serie+'&doc='+doc+'&auxiliar='+auxiliar+'&tipomov='+tipomov+'&tienda='+tienda,'dev_vaciar','get','0','1','','');
		}else{
		
		var tipomov="";
		doAjax('vaciar_sesiones.php','&tipomov='+tipomov,'dev_vaciar','get','0','1','','');
		
		}	
	}

		
	

}


function dev_vaciar(texto){

//alert(texto);
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

</script><!--MMDW 37 -->
<body mmdw="5"   onload="iniciar();cambiar_moneda_ini();carga_div()"   onUnload="vaciar_sesiones()" >

<form mmdw="6"  id="formulario" name="formulario" method="post" action="">
  <table mmdw="7"  width="790" border="0" cellpadding="0" cellspacing="0">
   
     <tr mmdw="8"  style="background:url(../imagenes/white-top-bottom.gif)">
       <td mmdw="9"  height="27" colspan="13" style="border:#999999">&nbsp;<span mmdw="10"  class="Estilo34">Generador de Documentos  :: <span mmdw="11"  class="Estilo14 Estilo38"><!--MMDW 38 --><?php echo $titulo?><!--MMDW 39 -->
            <input mmdw="12"  name="tempauxprod"  type="hidden" value=""  size="5" />
            <input mmdw="13"  name="tipomov"  type="hidden" value="<?php echo $_REQUEST['tipomov']?>" size="5" />
            <input mmdw="14"  name="temp_doc" type="hidden" size="5">
            <input mmdw="15"  name="accion" type="hidden" size="5" maxlength="10">
            <input mmdw="16"  name="incluidoigv" type="hidden" size="5" maxlength="10" value="S">
            <input mmdw="17"  name="tmoneda" type="hidden" size="5" maxlength="10" value="02">
            <input mmdw="18"  name="carga" type="hidden" size="5" maxlength="10" value="F">
            <input mmdw="19"  name="obs1" type="hidden" size="8" maxlength="150">
            <input mmdw="20"  name="obs2" type="hidden" size="8" maxlength="150">
            <input mmdw="21"  name="obs3" type="hidden" size="8" maxlength="150">
            <input mmdw="22"  name="obs4" type="hidden" size="8" maxlength="150">
            <input mmdw="23"  name="obs5" type="hidden" size="8" maxlength="150">
            <input mmdw="24"  name="prov_asoc" type="hidden" size="8" maxlength="150">
            
            <input mmdw="25"  type="hidden" name="temp_imp" id="temp_imp" value="" size="5">
            <input mmdw="26"  name="cod_cab_ref" type="hidden" id="cod_cab_ref" value="" size="5" maxlength="7">
            <input mmdw="27"  name="cod_cab_ref2" type="hidden" id="cod_cab_ref2" value="" size="5" maxlength="7">
			<input mmdw="28"  type="hidden" name="uni_p" id="uni_p" value="" size="5">
			<input mmdw="29"  name="factor_p" type="hidden" id="factor_p" value="" size="5">
            <input mmdw="30"  type="hidden" name="precio_p" id="precio_p" value="" size="5">
			<input mmdw="31"  type="hidden" name="prod_moneda" id="prod_moneda" value="" size="5">
			<input mmdw="32"  name="series" type="hidden" id="series" value="" size="3" maxlength="3">
			<input mmdw="33"  name="pruebas" type="hidden" value='' size="5">
            <input mmdw="34"  name="correlativo" type="hidden" value='' size="5">
			<input mmdw="35"  name="serie_ing" type="hidden" id="serie_ing" value="" size="3" maxlength="3">
          
			
			<!--MMDW 40 --><script>
			function ver(){
			var nombreVariable=document.getElementById('MB_frame');
				//alert(nombreVariable);
				if(isset(nombreVariable)){
				alert('la variable si existe');
				}else{
				alert('la variable no existe');
				}
			
			}
			
			
		  function isset(variable_name) {
			try {
				 if (typeof(eval(variable_name)) != 'undefined')
				 if (eval(variable_name) != null)
				 return true;
			 } catch(e) { }
			return false;
		   }

			</script><!--MMDW 41 -->
            
            <input mmdw="36"  name="precosto" type="hidden" id="precosto" value="" size="5" maxlength="3">
            <input mmdw="37"  name="impto" id="impto" type="hidden" size="6" maxlength="6" value="">
            <input mmdw="38"  name="percep_suc" id="percep_suc" type="hidden" size="6" maxlength="6" value="">
            <input mmdw="39"  name="percep_doc" id="percep_doc" type="hidden" size="6" maxlength="6" value="">
            <input mmdw="40"  name="min_percep_doc" id="min_percep_doc" type="hidden" size="6" maxlength="6" value="">
            <input mmdw="41"  name="est_percep_clie" id="est_percep_clie" type="hidden" size="6" maxlength="6" value="">
            <input mmdw="42"  name="por_percep_clie" id="por_percep_clie" type="hidden" size="6" maxlength="6" value="">
            <input mmdw="43"  name="tempCopiar" id="tempCopiar" type="hidden" size="6" maxlength="6" value="">
            <input mmdw="44"  name="kardex_prod" id="kardex_prod" type="hidden" size="6" maxlength="6" value="">
			<input mmdw="45"  name="cantSubUnidad" id="cantSubUnidad" type="hidden" value="">
            <input mmdw="46"  name="codBarraEnc" id="codBarraEnc" type="hidden" value="">
            <input mmdw="47"  name="codAnexProd" id="codAnexProd" type="hidden" value="">
			<input mmdw="48"  name="tserie" id="tserie" type="hidden" value="">
            <input mmdw="49"  name="tempSave" id="tempSave" type="hidden" value="">
       </span></span></td>
    </tr>
	
    <tr mmdw="50"  style="background:url(../imagenes/botones.gif)" >
      <td mmdw="51"  width="5" height="28">&nbsp;</td>
      <td mmdw="52"  width="5">&nbsp;</td>
      <td mmdw="53"  colspan="7"><table mmdw="54"  width="98%" height="21" border="0" cellpadding="0" cellspacing="0" style="border-bottom:#CCCCCC solid 1px">
     <tr>
		
          <td mmdw="55"  width="85" >
		  
		  <!--MMDW 42 --><script>
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
		  
		  
		  
		    </script><!--MMDW 43 -->
              <table mmdw="56"  title="Grabar [F2]" width="80" height="21" border="0" cellpadding="0" cellspacing="0">
                <tr mmdw="57"  onClick="javascript:grabar_doc()" onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer;">
                  <td mmdw="58"  width="3" ></td>
                  <td mmdw="59"  width="20" ><span mmdw="60"  class="Estilo112"><img mmdw="61"  src="../imgenes/revert.png" width="14" height="16"></span></td>
                  <td mmdw="62"  width="54" ><span mmdw="63"  class="Estilo112">Grabar<span mmdw="64"  class="Estilo113">[F2]</span></span></td>
                  <td mmdw="65"  width="3" style="border:#666666 solid 1px" ></td>
                </tr>
            </table>			</td>
          <td mmdw="66"  width="72" >
		  
		  <table mmdw="67"   title="Salir [Esc]"width="72" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr mmdw="68"  onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="salir()">
                <td mmdw="69"  width="3" ></td>
                <td mmdw="70"  width="20" ><img mmdw="71"  src="../imagenes/salir.JPG"  width="16" height="16" border="0"></td>
                <td mmdw="72"  width="46" ><span mmdw="73"  class="Estilo112">Salir<span mmdw="74"  class="Estilo113">[Esc]</span></span></td>
                <td mmdw="75"  width="3" ></td>
              </tr>
          </table>		  </td>
          <td mmdw="76"  width="100">
		  
		  <table mmdw="77"  title="Eliminar Doc [Ctrl+E]" onClick="eliminar_doc()" width="100" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr mmdw="78"  onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer">
                <td mmdw="79"  width="3" ></td>
                <td mmdw="80"  width="20" ><span mmdw="81"  class="Estilo112"><img mmdw="82"  src="../imgenes/eliminar.png" width="16" height="16"></span></td>
                <td mmdw="83"  width="72" ><span mmdw="84"  class="Estilo112">Eliminar<span mmdw="85"  class="Estilo113">[Ctrl+E]</span></span></td>
                <td mmdw="86"  width="5" ></td>
              </tr>
          </table>		  </td>
          <td mmdw="87"  width="80">
		  
		  <table mmdw="88"  title="Anular Doc.[F5]" width="76" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr mmdw="89"  onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="anular_doc()">
                <td mmdw="90"  width="3" ></td>
                <td mmdw="91"  width="20" ><span mmdw="92"  class="Estilo112"><img mmdw="93"  src="../imgenes/debaja.png" width="16" height="16"></span></td>
                <td mmdw="94"  width="50" > <span mmdw="95"  class="Estilo112">Anular<span mmdw="96"  class="Estilo113">[F5]</span></span></td>
                <td mmdw="97"  width="3" ></td>
              </tr>
          </table>		  </td>
          <td mmdw="98"  width="85"><table mmdw="99"  title="Cambiar Moneda [F8]" width="80" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr mmdw="100"  onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="func_f8()">
                <td mmdw="101"  width="3" ></td>
                <td mmdw="102"  width="16" ><span mmdw="103"  class="Estilo112"><img mmdw="104"  src="../imagenes/dolar.gif" width="15" height="15"></span></td>
                <td mmdw="105"  width="58" ><span mmdw="106"  class="Estilo112">Moneda<span mmdw="107"  class="Estilo113">[F8]</span> </span></td>
                <td mmdw="108"  width="3" ></td>
              </tr>
          </table></td>
          <td mmdw="109"  width="73"><table mmdw="110"  title="Incl./no Incl.[F9]" width="70" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr mmdw="111"  onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="cambiar_impuesto()">
              <td mmdw="112"  width="3" ></td>
              <td mmdw="113"  width="24" ><span mmdw="114"  class="Estilo112"><img mmdw="115"  src="../imagenes/igv.gif" width="20" height="16"></span></td>
              <td mmdw="116"  width="45" ><span mmdw="117"  class="Estilo112">&nbsp;Imp<span mmdw="118"  class="Estilo113">[F9]</span> </span></td>
              <td mmdw="119"  width="3" ></td>
            </tr>
          </table></td>
          <td mmdw="120"  width="87">
		  <table mmdw="121"  title="Nuevo[F3]" width="85" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr mmdw="122"  onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="ant_imprimir()">
              <td mmdw="123"  width="3" ></td>
              <td mmdw="124"  width="20" align="center" ><img mmdw="125"  src="../imgenes/fileprint.png" width="16" height="16"></td>
              <td mmdw="126"  width="59" ><span mmdw="127"  class="Estilo112">Imprimir<span mmdw="128"  class="Estilo113">[F7]</span> </span></td>
              <td mmdw="129"  width="3" ></td>
            </tr>
          </table>		  </td>
          <td mmdw="130"  width="93"><table mmdw="131"  title="Copiar Documento[F4]" width="83" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr mmdw="132"  onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="verCopiarDoc()">
              <td mmdw="133"  width="3" ></td>
              <td mmdw="134"  width="20" align="center" ><img mmdw="135"  src="../imagenes/iconocopiar.gif" width="19" height="16"></td>
              <td mmdw="136"  width="59" ><span mmdw="137"  class="Estilo112">Copiar<span mmdw="138"  class="Estilo113">[F4]</span> </span></td>
              <td mmdw="139"  width="1" ></td>
            </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td></td>
      <td mmdw="140"  height="10"></td>
      <td mmdw="141"  colspan="7" align="left"><div mmdw="142"  style="display:none" id="factura"><span mmdw="143"  class="Estilo1">FACTURA </span></div>      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td mmdw="144"  height="28">&nbsp;</td>
      <td mmdw="145"  colspan="7" rowspan="2" align="left" valign="top"><table mmdw="146"  width="724" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td mmdw="147"  width="82" height="26"><span mmdw="148"  class="Estilo14">Empresa</span></td>
          <td mmdw="149"  width="182">
		  
		  <!--MMDW 44 --><script>
		  
		  function cambiar_enfoque(control){
		//  alert(control.name);
		
			var tipomov=document.formulario.tipomov.value;
			
			//----------------------------------------------------------------------------------
				if(document.getElementById("capaCopiarDoc").style.visibility=="visible"){
					if(control.name=="almacen"){
					document.frmCopiarDoc.doc.disabled=false;
					}
					if(control.name=="doc"){
					//alert();
					var permiso11=find_prm(tab11,tab_cod);
					var permiso13=find_prm(tab13,tab_cod);
					var permiso14=find_prm(tab14,tab_cod);
					var permiso15=find_prm(tab15,tab_cod);
										
					var min_percep_doc=find_prm(tab_min_percep,tab_cod);
					
					document.frmCopiarDoc.min_percep_doc.value=min_percep_doc;		
					document.frmCopiarDoc.percep_doc.value=permiso14;
					var impto=parseFloat(find_prm(tab_impuesto1,tab_cod)).toFixed(2)/100;
					document.frmCopiarDoc.impto.value=impto;
					}
					if(control.name=="sucursal"){
						
						buscar_valor(control);
						
					}
							
					
					return false;
				}
			
			//---------------------------------------------------------------------------------------					
			if(control.name=="sucursal"){
				if(control.value=="0"){
				buscar_valor(document.forms["formulario"][control.name].options[1]);
				}else{
				buscar_valor(control);
				}
			//alert();
			document.formulario.almacen.disabled=false;
			document.formulario.almacen.focus();
			}
			var temp_doc1=document.forms["formulario"][control.name].length;
			
				//alert(find_prm(tab_impuesto1,tab_cod));
						
				if(control.name=="almacen" &&  document.formulario.num_serie.value=='' && temp_doc1>1){
								
					if(control.value==0){
					llenar_dir(document.forms["formulario"][control.name].options[1].value);
					}else{
					llenar_dir(control.value);
					}
					document.formulario.doc.disabled=false;
					document.formulario.doc.focus();
				}
			if(control.name=="doc"){
			
			var permiso11=find_prm(tab11,tab_cod);
			var permiso13=find_prm(tab13,tab_cod);
			var permiso14=find_prm(tab14,tab_cod);
			var permiso15=find_prm(tab15,tab_cod);
			var permiso18=find_prm(tab18,tab_cod);
			//alert(tab19+" - "+tab_cod);
			var permiso19=find_prm(tab19,tab_cod);
			var mostrarOT=find_prm(tab_mostrarOT,tab_cod);
			
			//alert(mostrarOT);
			
			var min_percep_doc=find_prm(tab_min_percep,tab_cod);
			
			var numauto=find_prm(tab_numauto,tab_cod);
			var descuento=find_prm(tab_descuento,tab_cod);
			document.formulario.correlativo.value=numauto;
			temp_mon=find_prm(tab_moneda,tab_cod);
			document.formulario.tmoneda.value=temp_mon;
			if(temp_mon=='02'){
			document.getElementById('moneda').innerHTML='(US$.)';
			}else{
			document.getElementById('moneda').innerHTML='(S/.)';
			}
			
			
			document.formulario.min_percep_doc.value=min_percep_doc;		
			document.formulario.percep_doc.value=permiso14;
			
				if(permiso13=='S'){
					document.getElementById('row_transp').style.display="block";
				}else{
					document.getElementById('row_transp').style.display="none";
				}
				
				if(permiso19=='S' && document.formulario.tipomov.value=='1'){
					document.getElementById('row_transp2').style.display="block";
				}else{
					document.getElementById('row_transp2').style.display="none";
				}
				//alert(permiso19);
				
				if(mostrarOT=='S'){
					document.getElementById('row_transp3').style.display="block";
				}else{
					document.getElementById('row_transp3').style.display="none";
				}
				
					if(permiso11=='S')
					document.formulario.doc_ref.disabled=false;
					else
					document.formulario.doc_ref.disabled=true;
					
					if(permiso15=='S')
					document.formulario.btnCambiarDir.disabled=false;
					else
					document.formulario.btnCambiarDir.disabled=true;
					
					//alert(permiso18);
					if(permiso18=='S'){
					document.getElementById("capaPase").style.visibility="visible";
					}else{
					document.getElementById("capaPase").style.visibility="hidden";
					}
					//document.formulario.btnCambiarDir.disabled=false;
					//else
					//document.formulario.btnCambiarDir.disabled=true;
											
			var temp_serie=find_prm(tab_serie,tab_cod);
			var temp_numero_ini=find_prm(tab_numero_ini,tab_cod);
			var temp_numero_fin=find_prm(tab_numero_fin,tab_cod);
			
			document.getElementById('impto1').innerHTML=find_prm(tab_impuesto1,tab_cod);
			var impto=parseFloat(document.getElementById('impto1').innerHTML).toFixed(2)/100;
			document.formulario.impto.value=impto;
						
			
				if(temp_serie!=""){
				
				document.formulario.num_correlativo.value="";
				document.formulario.num_correlativo.disabled=false;
				document.formulario.num_correlativo.focus();
				document.formulario.num_correlativo.select();
										
				document.formulario.num_serie.value=temp_serie;
				document.formulario.num_serie.disabled=true;
				
				var doc=document.formulario.doc.value;
				var sucursal=document.formulario.sucursal.value;
				
				var aBorrar = document.forms["formulario"][control.name].options[0];
					if(doc=="0"){
					doc=document.forms["formulario"][control.name].options[1].value;
					}
				
				//alert();
				doAjax('peticion_datos.php','&serie='+document.formulario.num_serie.value+'&doc='+doc+'&sucursal='+sucursal+'&peticion=generar_numero&numero_ini='+temp_numero_ini+'&numero_fin='+temp_numero_fin+'&tipomov='+tipomov,'rpta_gen_numero','get','0','1','',''); 
										
				}else{
				document.formulario.num_correlativo.value="";
				document.formulario.num_serie.disabled=false;
				document.formulario.num_serie.focus();
				document.formulario.num_serie.select();
				}
			
			var permiso9=find_prm(tab9,tab_cod);
			//alert(permiso9); 
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
			document.getElementById("f_trigger_b2").disabled=false;
			document.formulario.femi.focus();
			document.formulario.femi.select();
			}
					
			var aBorrar = document.forms["formulario"][control.name].options[0];
			if(document.forms["formulario"][control.name].options[0].value=="0"){
		    aBorrar.parentNode.removeChild(aBorrar);
			}
			
			if(control.name=="doc"){
				//alert(document.formulario.doc.value);
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
			   
				   if(tipomov==2 || document.formulario.correlativo.value=='S'){
				   
				   document.formulario.num_serie.value=ponerCeros(valor,ceros);
				   
				   doAjax('peticion_datos.php','&serie='+document.formulario.num_serie.value+'&doc='+doc+'&sucursal='+sucursal+'&peticion=generar_numero&tipomov='+tipomov,'rpta_gen_numero','get','0','1','',''); 
				   }else{
					
					document.formulario.num_serie.value=ponerCeros(valor,ceros);
					document.formulario.num_correlativo.disabled=false;
					document.formulario.num_correlativo.focus();
					document.formulario.num_correlativo.select();
					}
		    	}
				
				if(control=='correlativo'){
				
				
				if(document.formulario.num_correlativo.value!=0){
				
				var temp_numero_ini=find_prm(tab_numero_ini,tab_cod);
				var temp_numero_fin=find_prm(tab_numero_fin,tab_cod);
				var temp_numero=document.formulario.num_correlativo.value;
					
				 if(temp_numero_ini!='' && temp_numero_fin!=''){	
				
					if(parseFloat(temp_numero)<parseFloat(temp_numero_ini) || parseFloat(temp_numero)>parseFloat(temp_numero_fin)){
					
					// alert(parseFloat(temp_numero)+"  "+parseFloat(temp_numero_ini)+"  "+parseFloat(temp_numero_fin));	
					alert('Número de documento no autorizado...');
					document.formulario.num_correlativo.value='';
					document.formulario.num_correlativo.select();
					
					return false;
					}
				 } 
				
					document.formulario.num_correlativo.value=ponerCeros(valor,ceros);
					
					numero=document.formulario.num_correlativo.value;
					
						if(tipomov==1){
						doAjax('peticion_datos.php','&serie='+serie+'&numero='+numero+'&doc='+doc+'&sucursal='+sucursal+'&peticion=buscar_prov&tipomov='+document.formulario.tipomov.value,'rpta_con_datos','get','0','1','','');
						}else{
							//alert();					
						doAjax('peticion_datos.php','&serie='+serie+'&numero='+numero+'&doc='+doc+'&sucursal='+sucursal+'&peticion=buscar_prov2&tipomov='+document.formulario.tipomov.value,'rpta_bus_numero','get','0','1','','');
										
						}
				}													
					
				}
					if(control.name=='femi'){
					
					validar_fecha_doc(control);
					
					//document.formulario.fven.disabled=false;
					//document.formulario.fven.focus();
					//document.formulario.fven.select();
					
					}					
					
					if(control.name=='fven'){
				
					/*
					//alert(permiso11);
					if(permiso11=='S' && (document.formulario.serie_ref.value=='' ||  document.formulario.correlativo_ref.value=='')){
					alert('Debe seleccionar un documento de referencia para poder continuar');
						document.formulario.doc_ref.focus();
										
					}else{*/
					
					validar_fecha_doc(control);
					//document.formulario.codprod.disabled=false;
					//document.formulario.codprod.focus();
					
					//}
					
					
					
					
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
				
				var permiso11=find_prm(tab11,tab_cod);		
					if(permiso11=='S'){
					
					document.formulario.doc_ref.disabled=false;
					}
				  			  
				  }else{
				  	  	
					 //if(confirm('Este documento tiene proveedores asociados desea seleccionar uno de ellos?')){
					  document.formulario.auxiliar.disabled=false;
					  document.formulario.tempauxprod.value='auxiliares';
					  document.formulario.prov_asoc.value=texto;
					  
					  doAjax('lista_aux.php','&temp=auxiliares&tipomov='+document.formulario.tipomov.value+'&modulo=tranf','listaprod','get','0','1','','');
					  
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
		  
		 // cbo_cond();
		  
		  }
		  		  
		  </script><!--MMDW 45 -->
		  
            <select mmdw="150"  style="width:160"  name="sucursal" onChange="doAjax('../carga_cbo_tienda.php','&codsuc='+document.formulario.sucursal.value,'cargar_cbo','get','0','1','',''); cambiar_enfoque(this);;buscar_valor(this)" onFocus="enfocar_cbo(this);limpiar_enfoque(this)" >
			
			 <option mmdw="151"  value="0"></option>
			
              <!--MMDW 46 --><?php 
		
  $resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn); 
  $k=0;
while($row1=mysql_fetch_array($resultados1))
{
echo "<script> array_idsuc[$k]='".$row1['cod_suc']."'; array_percepsuc[$k]='".$row1['percepcion']."'; </script>";
		?><!--MMDW 47 -->
              <option mmdw="152"  value="<?php echo $row1['cod_suc'] ?>"><!--MMDW 48 --><?php echo $row1['des_suc'] ?><!--MMDW 49 --></option>
              <!--MMDW 50 --><?php 
			  
$k++;
}?><!--MMDW 51 -->
            </select>

           <input mmdw="153"  name="sucursal2" type="hidden" size="3" value="0" />         </td>
          <td mmdw="154"  width="54" class="Estilo14">N&uacute;mero</td>
          <td mmdw="155"  width="159"><input mmdw="156"  name="num_serie" type="text" size="5" maxlength="3" onKeyUp="generar_ceros(event,3,'serie')" onFocus="limpiar_enfoque(this);">
            <input mmdw="157"   name="num_correlativo" type="text" size="10" maxlength="7" onKeyUp="generar_ceros(event,7,'correlativo')" ></td>
          <td mmdw="158"  width="80" class="Estilo14" >Condici&oacute;n</td>
          <td mmdw="159"  width="148"><span mmdw="160"  class="Estilo15">
            <div mmdw="161"  id="cbo_cond">
		
			<select mmdw="162"  name="condicion" style="width:120" onChange=""  onFocus="enfocar_cbo(this);limpiar_enfoque(this);cbo_cond()">
		  <!--MMDW 52 --><?php 
			$marcar="";
		    $resultados11 = mysql_query("select * from condicion order by codigo ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
					
		  ?><!--MMDW 53 -->
           
              <option mmdw="163"  <?php echo $marcar?> value="<?php echo $row11['codigo']?>"><!--MMDW 54 --><?php echo $row11['nombre'];?><!--MMDW 55 --></option>
			  <!--MMDW 56 --><?php 
			  }
			  ?><!--MMDW 57 -->
            </select>
			</div>
            </span></td>
          <td mmdw="164"  width="19"><span mmdw="165"  class="Estilo15">
            <input mmdw="166"  name="condicion2" type="hidden" size="3"  value="0"/>
          </span></td>
        </tr>
        <tr>
          <td ><span mmdw="167"  class="Estilo14">Tienda</span>
            <input mmdw="168"  name="almacen2" type="hidden" size="3"  value="0"/>          </td>
          <td><span mmdw="169"  class="Estilo15">
		   <div mmdw="170"  id="cbo_tienda">
		     <select mmdw="171"   style="width:160" name="almacen"  onBlur="">
               <option mmdw="172"  value="0"></option>
             </select>
		   </div>    
            </span></td>
          <td mmdw="173"  class="Estilo14">
		  <!--MMDW 58 --><?php
		  echo $aux;
		  ?><!--MMDW 59 -->		  </td>
          <td><span mmdw="174"  class="Estilo15">
            <input mmdw="175"  autocomplete="off" name="auxiliar" type="text" size="18" maxlength="50" onKeyUp="validartecla(event,this,'auxiliares')">
            <input mmdw="176"  name="auxiliar2" type="hidden" size="3"  value=""/>
          </span></td>
          <td mmdw="177"  class="Estilo14">F.Emisi&oacute;n</td>
          <td>
		  
		  <input mmdw="178"  name="femi" type="text" size="15" maxlength="10" value="<?php echo date('d-m-Y')?>"  onKeyUp="generar_ceros(event,'0',this)"  onChange="enfocar_fecha(this)" onBlur="sumarFechaVen(document.formulario.condicion)">
		  		  				  
		  <button mmdw="179"  disabled="disabled" type="reset" id="f_trigger_b2"  style="height:18" >...</button>
              <!--MMDW 60 --><script type="text/javascript">
    Calendar.setup({
        inputField     :    "femi",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b2",   
        singleClick    :    true,           
        step           :    1                
    });
            </script><!--MMDW 61 -->			</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td mmdw="180"  height="30">
		  <span mmdw="181"  class="Estilo14">Doc<span mmdw="182"  class="Estilo15">
            <input mmdw="183"  name="doc2" type="hidden" size="3"  value="0"/>
          </span></span></td>
          <td>
		  
		  <div mmdw="184"  id="cbo_doc">
		    <select mmdw="185"   style="width:160" name="doc"  onBlur="">
              <option mmdw="186"  value="0"></option>
            </select>
		  </div>		  </td>
          <td mmdw="187"  class="Estilo14">
		  
		  
		  <!--MMDW 62 --><?php
		  
		  if($_REQUEST['tipomov']==1){
		  echo "Responsable";
		  }else{
		  echo "Vendedor";
		  }
		  
		  ?><!--MMDW 63 -->		  </td>
          <td><span mmdw="188"  class="Estilo15">
		  
		   <select mmdw="189"  name="responsable" style="width:120" onChange=""  onFocus="enfocar_cbo(this);limpiar_enfoque(this);cbo_cond()">
		  <!--MMDW 64 --><?php 
			$marcar="";
		    $resultados11 = mysql_query("select * from usuarios order by usuario ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			$marcar="";
			if($row11['codigo']==$_SESSION['codvendedor']){
			$marcar=" selected='selected' ";
			}
			
		  ?><!--MMDW 65 -->
           
              <option mmdw="190"  <?php echo $marcar?> value="<?php echo $row11['codigo']?>"><!--MMDW 66 --><?php echo $row11['usuario'];?><!--MMDW 67 --></option>
			  <!--MMDW 68 --><?php }?><!--MMDW 69 -->
            </select>
		   <input mmdw="191"  name="responsable2" type="hidden" size="3"  value="0"/>
          </span></td>
          <td mmdw="192"  class="Estilo14">F.Vencimiento</td>
          <td><input mmdw="193"  name="fven" type="text" size="15" maxlength="10"  value="<?php echo date('d-m-Y')?>"  onKeyUp="generar_ceros(event,'0',this)" onChange="enfocar_fecha(this)">
		  <button mmdw="194"  type="reset" id="f_trigger_b1" style="height:18; vertical-align:top" disabled="disabled" >...</button>
		  
		  
              <!--MMDW 70 --><script type="text/javascript">
			  
			  var doc_p1="<?php echo $p1 ?>";

			  
    Calendar.setup({
        inputField     :    "fven",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b1",   
        singleClick    :    true,           
        step           :    1                
    });
            </script><!--MMDW 71 -->	
			
			
			
								
			<!--MMDW 72 --><script language="JavaScript">
			
			var tab1 ;
			var tab2 ;
			var tab3 ;
			var tab4 ;
			var tab5 ;
			var tab6 ;
			var tab7 ;
			var tab8 ;
			var tab9 ;
			var tab10 ;
			var tab11 ;
			var tab12;
			var tab13;
			var tab14;
			var tab15;
			var tab16;
			var tab17;
			var tab18;
			var tab19;
			
			var tab_numauto;
			var tab_descuento;
			var tab_mostrarOT;
			 			
		//	alert(tab11);
			var tab_cod;
			var tab_nitems;
			var tab_serie;
			var tab_numero_ini;
			var tab_numero_fin;
			var tab_impresion;
			var tab_formato;
			var tab_kardex_doc;
			var tab_impuesto1;
			var tab_min_percep;
			var tab_moneda;
			var tab_cola1;
			var tab_cola2;
			
			</script><!--MMDW 73 -->			</td>
			
			<td>&nbsp;</td>
        </tr>
        <tr mmdw="195"  style="display:none" id="row_transp">
          <td mmdw="196"  height="25"><span mmdw="197"  class="Estilo14">Transportista</span></td>
          <td><input mmdw="198"  disabled="disabled" name="nom_transp" id="nom_transp" type="text" size="22" maxlength="100" value="<?php echo $chofer ?>">
		<input mmdw="199"  name="transportista" id="transportista" type="hidden" size="8" maxlength="100" value="<?php echo $idchofer ?>">
		
		<button mmdw="200"   id="btn_transp" type="button" title="Cambiar transportista" style="height:18; vertical-align:top" onClick="cambiar_chofer('T')" >...</button>		</td>
          <td mmdw="201"  class="Estilo14">Chofer</td>
          <td>
		  <input mmdw="202"  disabled="disabled" name="nom_chofer" id="nom_chofer" type="text" size="18" maxlength="100" value="<?php echo $chofer ?>"> 
		   <input mmdw="203"  name="id_chofer" id="id_chofer" type="hidden" size="8" maxlength="100" value="<?php echo $idchofer ?>"> 
		  <button mmdw="204"   id="btn_chofer" type="button" title="Cambiar Chofer" style="height:18; vertical-align:top" onClick="cambiar_chofer('C')" >...</button>		  </td>
          <td mmdw="205"  class="Estilo14">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr mmdw="206"  style="display:none" id="row_transp2">
          <td mmdw="207"  height="25" colspan="2"><span mmdw="208"  class="Estilo118">Fecha de Registro &nbsp;&nbsp;</span>
            <input mmdw="209"  name="fecharegis" type="text" size="15" maxlength="10" value="<?php echo date('d-m-Y')?>"  onKeyUp="generar_ceros(event,'0',this)"  onChange="enfocar_fecha(this)" >
            <button mmdw="210"   type="reset" id="f_trigger_b3"  style="height:18" >...</button>            <!--MMDW 74 --><script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecharegis",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b3",   
        singleClick    :    true,           
        step           :    1                
    });
            </script><!--MMDW 75 --></td>
          <td mmdw="211"  class="Estilo14">&nbsp;</td>
          <td>&nbsp;</td>
          <td mmdw="212"  class="Estilo14">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr mmdw="213"  style="display:none" id="row_transp3">
          <td mmdw="214"  height="25" colspan="2"><span mmdw="215"  class="Estilo118">Numero O.T.   
              <input mmdw="216"  type="text" name="serieOT" id="serieOT" size="5" maxlength="3" onBlur="javascript:this.value=ponerCeros(this.value,3)" onKeyUp="generar_cerosOT(event,3,this)"> 
		   <input mmdw="217"  type="text" name="numeroOT" id="numeroOT" size="10" maxlength="7" onBlur="javascript:this.value=ponerCeros(this.value,7)" onKeyUp="generar_cerosOT(event,7,this)">
          </span></td>
          <td mmdw="218"  class="Estilo14">&nbsp;</td>
          <td>&nbsp;</td>
          <td mmdw="219"  class="Estilo14">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td mmdw="220"  height="41">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>
	 </td>
      <td ></td>
      <td mmdw="221"  colspan="7"><table mmdw="222"  width="767" height="5" border="0" cellpadding="0" cellspacing="0" style="border-top: #CCCCCC solid 1px">
        <tr>
          <td mmdw="223"  width="767" height="5"></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td ></td>
      <td mmdw="224"  colspan="7"><table mmdw="225"  width="766" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td mmdw="226"  width="72"><span mmdw="227"  class="Estilo14">Producto:
            
          </span></td>
          <td mmdw="228"  width="146" align="left" valign="middle">
		  
		  <div mmdw="229"  id="capaPase" style="visibility:hidden">
		  <span mmdw="230"  class="Estilo14"><span mmdw="231"  class="Estilo115">Pase</span>
              <input mmdw="232"  type="checkbox" name="chkpase" id="chkpase" value="checkbox" style="background:none; border:none">
&nbsp;&nbsp; </span>			</div>
			</td>
          <td mmdw="233"  width="143"><span mmdw="234"  class="Estilo14">Presentaci&oacute;n:</span></td>
          <td mmdw="235"  width="11">&nbsp;</td>
          <td mmdw="236"  width="66"><span mmdw="237"  class="Estilo14">Cant.:</span></td>
          <td mmdw="238"  width="11">&nbsp;</td>
          <td mmdw="239"  width="66"><span mmdw="240"  class="Estilo14">P.Unit:</span></td>
          <td mmdw="241"  width="10">&nbsp;</td>
          <td mmdw="242"  width="81"><span mmdw="243"  class="Estilo14">&nbsp;</span><span mmdw="244"  class="Estilo14">Total:</span></td>
          <td mmdw="245"  width="160"><span mmdw="246"  class="Estilo14">Notas</span></td>
        </tr>
        <tr>
          <td mmdw="247"  colspan="2"><input mmdw="248"  autocomplete="off"  name="codprod"  type="text" size="8"  onKeyUp="validartecla(event,this,'productos')" onFocus="activar2;"/>
            <!--MMDW 76 --><script>
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
		  
		    </script><!--MMDW 77 -->
            <span mmdw="249"  class="Estilo15">
            <input mmdw="250"  name="pro" type="hidden" size="3"  value="0"/>
              </span><span mmdw="251"  class="Estilo14">
            <input mmdw="252"  name="termino" type="text" size="20" onFocus="activar(event);" onKeyUp="activar(event)">
              </span></td>
          <td><span mmdw="253"  class="Estilo14"><span mmdw="254"  class="Estilo15">
           <div mmdw="255"  id="cbo_uni">
		    <select mmdw="256"  name="presentacion" style="width:140px"  id="presentacion">
			</select>
			</div>
			
          </span></span></td>
          <td>&nbsp;</td>
          <td><span mmdw="257"  class="Estilo14"><span mmdw="258"  class="Estilo15">
            <input mmdw="259"  name="ter" type="hidden" size="3"  value="0"/>
          </span></span><span mmdw="260"  class="Estilo14">
          <!--MMDW 78 --><?php if($_REQUEST['tipomov']==2){?><!--MMDW 79 -->
          <input mmdw="261"  style="text-align:right" name="cantidad" id="cantidad"  type="text" size="8" onKeyUp="calc_pre_total()" />
		  <!--doAjax('../calcular_precio.php','','mostrar_precio','get','0','1','','');-->
          <!--MMDW 80 --><?php }else{?><!--MMDW 81 -->
          <input mmdw="262"  style=" text-align:right" name="cantidad" id="cantidad"  type="text" size="8" onKeyUp="cambiar_foco(event);calcular_ptotal()" />
          <!--MMDW 82 --><?php } ?><!--MMDW 83 -->
          </span></td>
          <td>&nbsp;</td>
          <td><span mmdw="263"  class="Estilo14">
            <input mmdw="264"   name="punit" type="text" size="8" style=" text-align:right" onKeyUp="calcular_ptotal()" />
          </span></td>
          <td>&nbsp;</td>
          <td><input mmdw="265"  style="font:bold; text-align:right" name="precio" type="text" size="8"   onKeyUp="calcular_cant()" /></td>
          <td><input mmdw="266"   name="precio2" type="hidden" size="3"/>
            <input mmdw="267"  name="notas" type="text" size="15" maxlength="30"></td>
        </tr>
      </table></td>
    </tr>
    
    <tr>
      <td mmdw="268"  colspan="9"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td mmdw="269"  colspan="7">
	  <div mmdw="270"  id="resultado">
	    <table mmdw="271"  id="detalle_doc_gen" width="711" border="0" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
          <tr>
            <td mmdw="272"  width="47" height="18" align="center" bgcolor="#3366CC"><span mmdw="273"  class="Estilo31">C&oacute;digo</span></td>
            <td mmdw="274"  width="296" bgcolor="#3366CC"><span mmdw="275"  class="Estilo31">Descripci&oacute;n</span></td>
            <td mmdw="276"  width="73" align="center" bgcolor="#3366CC"><span mmdw="277"  class="Estilo31">UND</span></td>
            <td mmdw="278"  width="51" align="center" bgcolor="#3366CC"><span mmdw="279"  class="Estilo31">Cant.</span></td>
            <td mmdw="280"  width="71" bgcolor="#3366CC"><span mmdw="281"  class="Estilo32"><span mmdw="282"  class="Estilo31">P. Unit.</span></span></td>
            <td mmdw="283"  width="65" bgcolor="#3366CC"><span mmdw="284"  class="Estilo31">Total</span></td>
            <td mmdw="285"  width="52" align="center" bgcolor="#3366CC"><span mmdw="286"  class="Estilo31">Notas</span></td>
            <td mmdw="287"  width="44" align="center" bgcolor="#3366CC"><span mmdw="288"  class="Estilo31">E</span></td>
          </tr>
 
          <tr mmdw="289"  style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
            <td mmdw="290"  align="center" bgcolor="#F5F5F5">&nbsp;</td>
            <td mmdw="291"  bgcolor="#F5F5F5">&nbsp;</td>
            <td mmdw="292"  align="right" bgcolor="#F5F5F5">&nbsp;</td>
            <td mmdw="293"  bgcolor="#F5F5F5"></td>
            <td mmdw="294"  align="right" bgcolor="#F5F5F5">&nbsp;</td>
            <td mmdw="295"  bgcolor="#F5F5F5">&nbsp;</td>
            <td mmdw="296"  align="center" bgcolor="#F5F5F5"></td>
            <td mmdw="297"  align="center" bgcolor="#F5F5F5"></td>
          </tr>
		  	  	  
          <tr mmdw="298"  style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
            <td mmdw="299"  align="center" bgcolor="#FFFFFF">&nbsp;</td>
            <td mmdw="300"  bgcolor="#FFFFFF">&nbsp;</td>
            <td mmdw="301"  align="right" bgcolor="#FFFFFF">&nbsp;</td>
            <td mmdw="302"  bgcolor="#FFFFFF"></td>
            <td mmdw="303"  align="right" bgcolor="#FFFFFF">&nbsp;</td>
            <td mmdw="304"  bgcolor="#FFFFFF"></td>
            <td mmdw="305"  colspan="2" align="center" bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr mmdw="306"  style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
            <td mmdw="307"  align="left" bgcolor="#FFFFFF"><span mmdw="308"  style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">Items</span></td>
            <td mmdw="309"  bgcolor="#FFFFFF"><strong mmdw="310"  id="nitems">0</strong></td>
            <td mmdw="311"  align="right" bgcolor="#FFFFFF"><input mmdw="312"  name="estado" id="estado" type="hidden" value="" size="5"></td>
            <td mmdw="313"  colspan="2" bgcolor="#FFFFFF">SubTotal</td>
            <td mmdw="314"  align="right"><strong>
              <input mmdw="315"  name="monto" type="text" size="10" style="text-align:right"  value="<?php echo number_format($total,2);?>"/>
            </strong></td>
            <td mmdw="316"  colspan="2" align="center" bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr mmdw="317"  style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
            <td mmdw="318"  align="left" bgcolor="#FFFFFF"><span mmdw="319"  style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">Moneda</span></td>
            <td mmdw="320"  bgcolor="#FFFFFF"><label mmdw="321"  style="color:#FF0000" id="moneda"><!--MMDW 84 --><?php echo "(S/.)" ?><!--MMDW 85 --></label></td>
            <td mmdw="322"  align="right" bgcolor="#FFFFFF">&nbsp;</td>
            <td mmdw="323"  colspan="2" bgcolor="#FFFFFF"><table mmdw="324"  width="115" border="0" cellpadding="0" cellspacing="0">
              <tr>
                 <td mmdw="325"  width="59" height="18" bgcolor="#FFFFFF">Impuesto1 (</td>
            <td mmdw="326"  width="15" bgcolor="#FFFFFF"><div mmdw="327"  id="impto1">18</div></td>
            <td mmdw="328"  width="41" bgcolor="#FFFFFF">)%</td>
              </tr>
            </table></td>
            <td mmdw="329"  align="right"><strong>
              <input mmdw="330"  name="impuesto1" type="text" size="10" style="text-align:right"  value="<?php echo number_format($total*0.19,2);?>"/>
            </strong></td>
            <td mmdw="331"  colspan="2" align="center" bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr mmdw="332"  style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
            <td mmdw="333"  align="center" bgcolor="#FFFFFF">&nbsp;</td>
            <td mmdw="334"  bgcolor="#FFFFFF"></td>
            <td mmdw="335"  align="right" bgcolor="#FFFFFF">&nbsp;</td>
            <td mmdw="336"  colspan="2" bgcolor="#FFFFFF"><span mmdw="337"  class="Estilo111" style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold">TOTAL DOC </span></td>
            <td mmdw="338"  width="65" align="right"><strong>
              <input mmdw="339"  name="total_doc" type="text" size="10" style="text-align:right"  value="<?php echo number_format($total+$total*0.19,2);?>"/>
            </strong></td>
            <td mmdw="340"  colspan="2" align="center" bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
        </table>
	  </div>	  </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td mmdw="341"  width="550">

<DIV mmdw="342"  id=modal style="BORDER-RIGHT: white 3px solid;  BORDER-TOP: white 3px solid; DISPLAY: none;   BORDER-LEFT: white 3px solid;  BORDER-BOTTOM: white 3px solid; BACKGROUND-COLOR:#003366; "> 
    
	  <table mmdw="343"  width="270" height="150" border="0">
  <tr>
    <td mmdw="344"  align="center" style="font:Arial, Helvetica, sans-serif; font:bold; font-size:12; color:#FFFFFF">Espere un momento por favor</td>
  </tr>
  <tr>
    <td mmdw="345"  align="center" valign="bottom" style="font:Arial, Helvetica, sans-serif; font:bold; font-size:10; color:#FFFFFF">Procesando Datos...</td>
  </tr>
  <tr>
    <td mmdw="346"  align="center"> <img mmdw="347"  height="45" width="45" src="../imgenes/cargando.gif">	 </td>
	 <tr>
    <td mmdw="348"  align="center"> 	
	 <INPUT mmdw="349"  name="button" type=button onClick="Popup.hide('modal')" value=OK>	 </td>
  </tr>
</table>
    </DIV>
	

   <!-- <A onClick="Popup.showModal('modal');return false;" href="#">Show Modal 
      Popup</A> <BR>-->
	  <!--
 <A onclick="Popup.showModal('modal',null,null,{'screenColor':'#000000','screenOpacity':.10});return false;" 
      href="http://www.javascripttoolbox.com/lib/popup/example.php#">Show Modal Popup With A Custom Screen</A> 

-->
	  <table mmdw="350"  width="488" border="0" align="left" cellpadding="0" cellspacing="0">
        <tr>
          <td mmdw="351"  width="71" align="left"><span mmdw="352"  style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">Referencia</span>
		  <img mmdw="353"  style="cursor:pointer" alt="" onClick="doc_det(document.formulario.cod_cab_ref.value)" src="../imagenes/ico_lupa.png" width="12" height="12">		  </td>
          <td mmdw="354"  width="127" align="left">
		  <input mmdw="355"  readonly="readonly"  style="text-align:right" name="serie_ref" id="serie_ref" type="text" size="5" maxlength="3" />
            <input mmdw="356"  readonly="readonly" style="text-align:right" name="correlativo_ref" id="correlativo_ref" type="text" size="10" maxlength="7" /></td>
          <td mmdw="357"  width="290" align="left"><button mmdw="358"  title="[Alt+r]" disabled="disabled" onClick="vent_ref()" type="button" id="doc_ref"  style="height:18px"><span mmdw="359"  style=" font-family:Arial, Helvetica, sans-serif;font-size:9px">Referencia</span></button>
            <button mmdw="360"  title="[Alt+r]" disabled="disabled" onClick="vent_referenciado()" type="button" id="doc_ref2"  style="height:18px"><span mmdw="361"  style=" font-family:Arial, Helvetica, sans-serif;font-size:9px">Referenciado</span></button>
			
			 <button mmdw="362"  title="" disabled="disabled" onClick="cambiar_dir()" type="button" id="btnCambiarDir"  style="height:18px"><span mmdw="363"  style=" font-family:Arial, Helvetica, sans-serif;font-size:9px">Cambiar Direcci&oacute;n</span></button>
			
			</td>
          </tr>
      </table></td>
      <td mmdw="364"  width="62">&nbsp;</td>
      <td mmdw="365"  width="98"><input mmdw="366"  name="saldo" type="hidden" size="10" maxlength="10">
      <input mmdw="367"  name="prueba" type="hidden" size="10" maxlength="10" ></td>
      <td mmdw="368"  width="70" colspan="3">&nbsp;</td>
    </tr>
  </table>
   
  <div mmdw="369"  id="new_aux" style="position:absolute; left:274px; top:139px; width:300px; height:180px; z-index:2; visibility:hidden">
  
  <table mmdw="370"  width="392" height="72" border="1" cellpadding="0" cellspacing="0" bgcolor="#FEF5E2"><!--FFD3B7-->
  <tr>
    <td>
	<table mmdw="371"  width="413" border="0" cellpadding="0" cellspacing="0">
      <tr>
	      <td mmdw="372"  colspan="5" align="right"></td>
      </tr>
      <tr mmdw="373"  style="background:url(../imagenes/bg_contentbase2.gif) 100% 70%">
        <td mmdw="374"  width="20" height="23">&nbsp;</td>
        <td mmdw="375"  colspan="2"><span mmdw="376"  class="text5 Estilo116"><font mmdw="377"  face="Verdana, Arial, Helvetica, sans-serif" color="#FFFFFF"><strong>Nuevo Auxiliar </strong></font></span></td>
        <td mmdw="378"  colspan="2">&nbsp;</td>
      </tr>
      
      <tr>
        <td mmdw="379"  colspan="5" height="10"></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td mmdw="380"  width="62" align="center"><span mmdw="381"  style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">T. pers.</span>: </td>
        <td mmdw="382"  colspan="2"><input mmdw="383"  name="persona" type="radio" value="J" style="border:none; background:none" onClick="validarNewClie(this)" />
          <span mmdw="384"  style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold; color:#0066FF">Juridica.</span>
          <input mmdw="385"  style="border:none; background:none" checked="checked" name="persona" type="radio" value="N" onClick="validarNewClie(this)" />
  <span mmdw="386"  style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold; color:#0066FF">Natural.</span></td>
        <td mmdw="387"  width="158"><input mmdw="388"  name="accionAux" type="hidden" id="accionAux" size="5" maxlength="5">
          <input mmdw="389"  name="codClie" type="hidden" id="codClie" size="5" maxlength="5"></td>
      </tr>
      <tr>
        <td mmdw="390"  height="20">&nbsp;&nbsp;</td>
        <td mmdw="391"  align="center"><span mmdw="392"  style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Ruc</span></td>
        <td mmdw="393"  width="141"><input mmdw="394"  name="aux_ruc" type="text" size="17" maxlength="11"  disabled="disabled" /></td>
        <td mmdw="395"  colspan="2"><span mmdw="396"  style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Dni/CE</span>
          <input mmdw="397"  name="aux_dni" type="text" size="15" maxlength="8" />
		  <!--MMDW 86 --><script>
		  function validarNewClie(control){
			  if(control.name=='persona'){
			  	if(control.value=='J'){
				  document.formulario.aux_dni.value="";
				  document.formulario.aux_dni.disabled=true;
				  document.formulario.aux_ruc.disabled=false;
				  document.formulario.aux_ruc.focus();
				}else{
				  document.formulario.aux_ruc.value="";
				  document.formulario.aux_ruc.disabled=true;
				  document.formulario.aux_dni.disabled=false;
				  document.formulario.aux_dni.focus();  
				}
			  }
		  
		  }
		  
		  </script><!--MMDW 87 -->		  </td>
      </tr>
      <tr>
        <td mmdw="398"  height="20">&nbsp;</td>
        <td mmdw="399"  align="center" style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Cli./Razon</td>
        <td mmdw="400"  colspan="3"><input mmdw="401"  name="aux_razon" type="text" size="42" maxlength="100" /></td>
        </tr>
      <tr>
        <td mmdw="402"  height="20">&nbsp;</td>
        <td mmdw="403"  align="center"><span mmdw="404"  style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">Contacto</span></td>
        <td mmdw="405"  colspan="3"><input mmdw="406"  name="aux_contacto" type="text" size="42" maxlength="100" /></td>
        </tr>
      <tr>
        <td mmdw="407"  height="20">&nbsp;</td>
        <td mmdw="408"  align="center"><span mmdw="409"  style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Cargo</span></td>
        <td mmdw="410"  colspan="3"><input mmdw="411"  type="text" name="aux_cargo" /></td>
        </tr>
      <tr>
        <td mmdw="412"  height="30">&nbsp;</td>
        <td><span mmdw="413"  style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Direcci&oacute;n</span></td>
        <td mmdw="414"  colspan="3"><textarea mmdw="415"  name="aux_direccion" cols="42" rows="3"></textarea></td>
        </tr>
      <tr>
        <td mmdw="416"  height="29">&nbsp;</td>
        <td mmdw="417"  colspan="4" align="left"><input mmdw="418"  type="button" name="Submit" value="Guardar" onClick="guardar_aux();" />
          <input mmdw="419"  type="button" name="Submit2" value="Cancelar" onClick="cancel_nuevo_aux()" /></td>
        </tr>
	     <tr>
        <td mmdw="420"  height="10"></td>
        <td></td>
        <td></td>
      </tr>
    </table>
    </td>
  </tr>
  
</table>

  </div>
   
  <div mmdw="421"  id="productos" style="position:absolute; left:22px; top:205px; width:300px; height:180px; z-index:1; visibility:hidden"> </div>
  
   <div mmdw="422"  id="auxiliares" style="position:absolute; left:154px; top:138px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>

 <div mmdw="423"  id="choferes" style="position:absolute; left:274px; top:139px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>
 
 
 <div mmdw="424"  id="cambiarDirec" style="border:#238CE2 solid 1px; background:#E2FAFE; position:absolute; left:274px; top:139px; width:300px; height:180px; z-index:2; visibility:hidden; background-color: #F1FBFE;">
 
 <table mmdw="425"  width="298" height="148" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td mmdw="426"  height="26" style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px; color:#FFFFFF">&nbsp;</td>
    <td mmdw="427"  height="26" colspan="2" style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px; color:#FFFFFF"><strong>Cambiar Direcci&oacute;n </strong></td>
    <td mmdw="428"  height="26" align="center" style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px; color:#FFFFFF; text-decoration:underline; cursor:pointer" onClick="salir();"><strong>x</strong></td>
  </tr>
  <tr>
    <td mmdw="429"  height="9" colspan="4"></td>
  </tr>
  <tr>
    <td mmdw="430"  width="8">&nbsp;</td>
    <td mmdw="431"  width="95" height="23"><span mmdw="432"  class="Estilo112">Direcci&oacute;n Partida </span></td>
    <td mmdw="433"  width="169"><input mmdw="434"  type="text" name="dirPartida" id="dirPartida"></td>
    <td mmdw="435"  width="26" rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td mmdw="436"  width="8">&nbsp;</td>
    <td mmdw="437"  width="95" height="32"><span mmdw="438"  class="Estilo112">Direcci&oacute;n Destino </span></td>
    <td><input mmdw="439"  type="text" name="dirDestino" id="dirDestino"></td>
  </tr>
  <tr>
    <td mmdw="440"  height="46" colspan="4" align="center"><input mmdw="441"  onClick="salir();" type="button" name="Submit3" value="Aceptar">
      <input mmdw="442"  type="button" name="Submit4" value="Cancelar" onClick="salir();"></td>
    </tr>
</table>

 
</div>
 
</form>


 <div mmdw="443"  id="capaCopiarDoc" style="border:#238CE2 solid 1px; background:#E2FAFE; position:absolute; left:238px; top:15px; z-index:2; visibility:hidden; background-color: #F1FBFE; width: 340px;">
 <form mmdw="444"  id="frmCopiarDoc" name="frmCopiarDoc">
 <table mmdw="445"  width="372" height="363" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td mmdw="446"  height="26" style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px; color:#FFFFFF">&nbsp;</td>
    <td mmdw="447"  width="346" height="26" style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px; color:#FFFFFF"><strong>Copiar Documentos </strong></td>
    <td mmdw="448"  height="26" align="center" style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px; color:#FFFFFF; text-decoration:underline; cursor:pointer" onClick="salir();"><strong>x</strong></td>
  </tr>
  <tr>
    <td mmdw="449"  height="9" colspan="3"></td>
  </tr>
  <tr>
    <td mmdw="450"  height="25"></td>
    <td mmdw="451"  height="25"><fieldset><legend>Origen</legend>
      <table mmdw="452"  width="341" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td mmdw="453"  width="159">Documento</td>
          <td mmdw="454"  width="28">&nbsp;</td>
          <td mmdw="455"  width="154">N&uacute;mero</td>
        </tr>
        <tr>
          <td><input mmdw="456"  type="text" name="docOrigen" disabled="disabled"></td>
          <td>&nbsp;</td>
          <td><input mmdw="457"  name="serieOrigen" type="text" size="3" disabled="disabled">
            <input mmdw="458"  name="numeroOrigen" type="text" size="10" disabled="disabled">
            <input mmdw="459"  name="cod_cabaCopiar" type="hidden" size="5"></td>
        </tr>
      </table>
    </fieldset></td>
    <td mmdw="460"  height="25"></td>
  </tr>
  <tr>
    <td mmdw="461"  height="9" colspan="3"></td>
  </tr>
  <tr>
    <td mmdw="462"  height="9" colspan="3"></td>
  </tr>
  <tr>
    <td mmdw="463"  width="9">&nbsp;</td>
    <td mmdw="464"  height="23"><fieldset><legend>Destino</legend>
      <table mmdw="465"  width="335" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td mmdw="466"  colspan="2">Sucursal</td>
          <td mmdw="467"  colspan="2">Almacen</td>
          </tr>
        <tr>
          <td mmdw="468"  colspan="2"><select mmdw="469"  style="width:160"  name="sucursal"  onChange="doAjax('../carga_cbo_tienda.php','&codsuc='+document.frmCopiarDoc.sucursal.value,'cargar_cbo','get','0','1','','');cambiar_enfoque(this);" >
            <option mmdw="470"  value="0"></option>
            <!--MMDW 88 --><?php 
		
  $resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn); 
  $k=0;
while($row1=mysql_fetch_array($resultados1))
{
echo "<script> array_idsuc[$k]='".$row1['cod_suc']."'; array_percepsuc[$k]='".$row1['percepcion']."'; </script>";
		?><!--MMDW 89 -->
            <option mmdw="471"  value="<?php echo $row1['cod_suc'] ?>"><!--MMDW 90 --><?php echo $row1['des_suc'] ?><!--MMDW 91 --></option>
            <!--MMDW 92 --><?php 
			  
$k++;
}?><!--MMDW 93 -->
          </select></td>
          <td mmdw="472"  colspan="2"><div mmdw="473"  id="div2">
            <select mmdw="474"   style="width:160" name="almacen"  onBlur="">
              <option mmdw="475"  value="0"></option>
            </select>
          </div></td>
          </tr>
        <tr>
          <td mmdw="476"  colspan="2">Documento</td>
          <td mmdw="477"  width="118">Numero</td>
          <td mmdw="478"  width="47">&nbsp;</td>
        </tr>
        <tr>
          <td mmdw="479"  colspan="2"><div mmdw="480"  id="div3">
            <select mmdw="481"   style="width:160" name="doc"  onBlur="">
              <option mmdw="482"  value="0"></option>
            </select>
          </div></td>
          <td mmdw="483"  colspan="2"><input mmdw="484"   name="serie" type="text" size="3" onKeyUp="genNumCopiar(event,this)">
            <input mmdw="485"  name="numero"  type="text" size="10" onKeyUp="validarNumCopiar(event,this)">
			
			 <input mmdw="486"  name="temp_doc" type="hidden" size="5">
			</td>
          </tr>
        <tr>
          <td mmdw="487"  width="88">&nbsp;</td>
          <td mmdw="488"  width="82">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </fieldset> 
    
	
			<input mmdw="489"  name="impto" id="impto" type="hidden" size="6" maxlength="6" value="">
            <input mmdw="490"  name="percep_suc" id="percep_suc" type="hidden" size="6" maxlength="6" value="">
            <input mmdw="491"  name="percep_doc" id="percep_doc" type="hidden" size="6" maxlength="6" value="">
            <input mmdw="492"  name="min_percep_doc" id="min_percep_doc" type="hidden" size="6" maxlength="6" value="">
            <input mmdw="493"  name="est_percep_clie" id="est_percep_clie" type="hidden" size="6" maxlength="6" value="">
            <input mmdw="494"  name="por_percep_clie" id="por_percep_clie" type="hidden" size="6" maxlength="6" value="">
	
	</td>
    <td mmdw="495"  width="17" rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td mmdw="496"  width="9">&nbsp;</td>
    <td mmdw="497"  height="73"><label></label>
      <table mmdw="498"  width="342" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td mmdw="499"  width="170">Auxiliar &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a mmdw="500"  style="cursor:pointer" onClick="cambiar_chofer('A')">Edtar</a></td>
          <td mmdw="501"  width="165"><label></label>
Responsable </td>
        </tr>
        <tr>
          <td>
		    <input mmdw="502"  name="auxOrigen" type="text" disabled="disabled" size="25" >
            <input mmdw="503"  type="hidden" name="auxOrigen2">
									
			</td>
          <td>
		  
		  <select mmdw="504"  name="responsable" style="width:160" onChange=""  >
		  <!--MMDW 94 --><?php 
			$marcar="";
		    $resultados11 = mysql_query("select * from usuarios order by usuario ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			$marcar="";
			if($row11['codigo']==$_SESSION['codvendedor']){
			$marcar=" selected='selected' ";
			}
			
		  ?><!--MMDW 95 -->
           
              <option mmdw="505"  <?php echo $marcar?> value="<?php echo $row11['codigo']?>"><!--MMDW 96 --><?php echo $row11['usuario'];?><!--MMDW 97 --></option>
			  <!--MMDW 98 --><?php }?><!--MMDW 99 -->
            </select>		  </td>
        </tr>
        <tr>
          <td mmdw="506"  height="20">Fecha de Emisi&oacute;n </td>
          <td>Fecha de Venc. </td>
        </tr>
        <tr>
          <td mmdw="507"  height="20"><input mmdw="508"  name="femi" type="text" size="12" value="<?php echo date("d-m-Y")?>"></td>
          <td><input mmdw="509"  name="fven" type="text" size="12" value="<?php echo date("d-m-Y")?>"></td>
        </tr>
      </table></td>
    </tr>
  <tr mmdw="510"  style="visibility:hidden" >
    <td>&nbsp;</td>
    <td mmdw="511"  height="19"><label>
    <input mmdw="512"  type="checkbox" name="checkbox2" value="checkbox">
    Trasladar Series </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td mmdw="513"  height="46" colspan="3" align="center"><input mmdw="514"  disabled="disabled" onClick="copiarDoc();" type="button" name="btncopiar" value="Copiar">
      <input mmdw="515"  type="button" name="Submit4" value="Cancelar" onClick="salir();"></td>
    </tr>
</table>

 </form>
</div>


</body>

<!--MMDW 100 --><script>



function calcular_cant(){
/*
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
*/
var punit=parseFloat(document.formulario.punit.value);
var precio=parseFloat(document.formulario.precio.value);
var total=(precio/punit).toFixed(4);
//alert(total);
	if(total>0){
		document.formulario.cantidad.value=total;
	}else{
		document.formulario.cantidad.value="";
	}
		
	
	
}


function gene(){
//document.formulario.suc.value='1';
doAjax('../carga_cbo_tienda.php','&codsuc='+document.formulario.sucursal.value,'cargar_cbo','get','0','1','','');
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
document.formulario.pruebas.value="";
document.formulario.serie_ing.value="";
document.formulario.temp_doc.value="";
document.formulario.series.value="";

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
	//if(document.formulario.codprod.value==''){
	//punit=document.formulario.termino.value; //parseFloat(document.formulario.termino.value);
	//}else{
	var termino=document.formulario.termino.value;
	var punit=parseFloat(document.formulario.punit.value);
	//}
	
	var pase='N';
	if(document.formulario.chkpase.checked){
	var pase='S';
//	alert(isNaN(punit));
		  if(document.formulario.cantidad.value=='' || document.formulario.cantidad.value==0 || punit=='' || punit==0 || isNaN(punit)){
			alert("Los items del tipo pase necesitan ser ingresados con cantidad y precio ");	
			//return false;	
		  if(document.formulario.cantidad.value=='' || document.formulario.cantidad.value==0){
		  document.formulario.cantidad.focus();
		  return false;
		  }
		  if(punit=='' || punit==0 || isNaN(punit)){
		  document.formulario.punit.focus();
		  return false;
		  }
		 return false;
		} 
	}
	
///	if(document.formulario.chkpase.checked && ){
	
	//}
		
	var permiso4=find_prm(tab4,tab_cod);
	var notas=document.formulario.notas.value;
	var presentacion=document.formulario.presentacion.value;
	var permiso10=find_prm(tab10,tab_cod);
	
	if(document.formulario.serie_ing.value=="" && document.formulario.series.value=='S' && permiso10=='S'){
	alert('Ingresar las series para este item....');
	
	var cant=document.formulario.cantidad.value;
	var randomnumber=Math.floor(Math.random()*99999);
	var producto=document.formulario.codprod.value;
	var fecha=document.formulario.femi.value;
    var tienda=document.formulario.almacen.value;	
	var cod_cab_ref=document.formulario.cod_cab_ref.value;
	
		if(document.formulario.tipomov.value==1 ){
		
		Modalbox.show('ing_series.php?cant='+cant+'&ran='+randomnumber+'&producto='+producto+'&fecha='+fecha+'&tienda='+tienda+'&cod_cab_ref='+cod_cab_ref, {title: 'Serie de Productos ( INGRESOS )', width: 500}); return false;
		}else{
								
				Modalbox.show('sal_series.php?cant='+cant+'&ran='+randomnumber+'&producto='+producto+'&fecha='+fecha+'&tienda='+tienda+'&cod_cab_ref='+cod_cab_ref, {title: 'Serie de productos ( SALIDAS )', width: 500}); 
						
		}
	
	return false;
	}
	
	
	
	if(document.formulario.tmoneda.value==02){
	var punit2=parseFloat(punit*tc_doc).toFixed(2);
	}else{
	var punit2=punit;
	}
		
	
	/* Si funciona Precio menor al costo*/
	//punit
	
	//alert(punit2+" - "+parseFloat(document.formulario.precosto.value));
/*
	if(punit2<parseFloat(document.formulario.precosto.value) && parseFloat(document.formulario.tipomov.value)==2 ){
	alert('El precio no puede ser menor a el precio de costo');
	document.formulario.punit.focus();
	document.formulario.punit.select();
	return false;
	}
*/	
	
	
	var esserie=document.formulario.series.value;
	var precosto=document.formulario.precosto.value;
	var impto=document.formulario.impto.value;
	//------------------variables de percepcion---------------------------------
	var percep_suc=document.formulario.percep_suc.value;
	var percep_doc=document.formulario.percep_doc.value;
	var min_percep_doc=document.formulario.min_percep_doc.value;
	var est_percep_clie=document.formulario.est_percep_clie.value;
	var por_percep_clie=document.formulario.por_percep_clie.value;
	var total_doc=document.formulario.total_doc.value;
	var tipomov=document.formulario.tipomov.value;	
	var codAnexProd=document.formulario.codAnexProd.value;	

//	alert(document.formulario.tmoneda.value+" - "+temp_mon);
//alert(notas);
	doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&punitario='+punit+'&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&notas='+notas+'&presentacion='+presentacion+'&esserie='+esserie+'&permiso10='+permiso10+'&cargar_ref=noref&precosto='+precosto+'&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov+'&codAnexProd='+codAnexProd+'&termino='+termino+'&pase='+pase,'mostrar','get','0','1','','');
	
	document.formulario.chkpase.checked=false;
	
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
//document.formulario.cantidad.focus();
//alert();
//doAjax('carga_cbo_uni.php','&producto='+cod,'view_cbo_uni','get','0','1','','');
var uni_p=document.formulario.uni_p.value;
var factor_p=document.formulario.factor_p.value;
var precio_p=document.formulario.precio_p.value;
doAjax('../carga_cbo_uni.php','&producto='+cod+'&uni_p='+uni_p+'&factor_p='+factor_p+'&precio_p='+precio_p,'view_cbo_uni','get','0','1','','');

}

function view_cbo_uni(texto){
	document.getElementById('cbo_uni').innerHTML=texto;
	
	if(temp_busqueda=='cod_prod' && document.formulario.presentacion.length>1 && document.formulario.codBarraEnc.value==2){
	document.formulario.presentacion.options[1].selected="selected";
	calculos_pretot();
	}
	
	if(temp_busqueda=='serie'){
	//alert(temp_busqueda);
	document.formulario.cantidad.value=1;
	document.formulario.cantidad.disabled=true;
	calculos_pretot();
	document.formulario.punit.select();
	document.formulario.punit.focus();
	document.formulario.serie_ing.value="S";
	
	}else{
	
		//document.formulario.presentacion.focus();
		if(document.formulario.factor_p.value==1){
		document.formulario.cantidad.focus();
		}else{
		calc_pre_total();
		
		document.formulario.precio.focus();
		document.formulario.precio.select();
		}
		
	}
}

function elegir2(cod,des){
//razon.replace('&','amps')
des=des.replace('amps','&');

document.formulario.auxiliar.value=des;
document.formulario.auxiliar2.value=cod;
document.getElementById('auxiliares').style.visibility='hidden';
mostrar_cbos();

			var serie=document.formulario.num_serie.value;
			var numero=document.formulario.num_correlativo.value;
			var doc=document.formulario.doc.value;
			var sucursal=document.formulario.sucursal.value;
			var tipomov=document.formulario.tipomov.value;
			
	if(tipomov==1){
	
	doAjax('peticion_datos.php','&serie='+serie+'&numero='+numero+'&doc='+doc+'&sucursal='+sucursal+'&auxiliar='+cod+'&peticion=buscar_prov2&tipomov='+tipomov,'rpta_con_datos2','get','0','1','','');
	}else{
		
				document.formulario.responsable.disabled=false;
				document.formulario.responsable.focus();
				
	}
		

}

function rpta_con_datos2(texto){
var temp=texto.split("?");

//alert(temp);
		if(temp[1]=="reservado"){
			document.formulario.temp_doc.value=temp[0];
			document.formulario.sucursal.disabled=true;
			document.formulario.doc.disabled=true;
			document.formulario.num_correlativo.disabled=true;
			document.formulario.num_serie.disabled=true;
			document.formulario.auxiliar.disabled=true;
			document.formulario.almacen.disabled=true;
			
			
			document.formulario.responsable.disabled=false;
			document.formulario.responsable.focus();
		}else{
			 
			 habilitar();
			 
			 seleccionar_cbo('almacen',temp[2]);
			 seleccionar_cbo('responsable',temp[3]);	
			 seleccionar_cbo('condicion',temp[4]);	
			 document.formulario.femi.value=temp[5].substring(0,10);
			 document.formulario.fven.value=temp[6].substring(0,10);
			 document.formulario.temp_doc.value=temp[0];
			 
			 //alert(temp[8]);	
			 document.formulario.serie_ref.value=temp[11];
			 document.formulario.correlativo_ref.value=temp[12];
			 document.formulario.cod_cab_ref2.value=temp[14];
			 document.formulario.incluidoigv.value=temp[8];
			 
			 document.formulario.nom_transp.value=temp[22];
			 document.formulario.nom_chofer.value=temp[23];
			 		 			 
			 var tempOT=temp[20].split("-");
			 document.formulario.numeroOT.value=tempOT[1];
			 document.formulario.serieOT.value=tempOT[0];					 
								 
			 deshabilitar();
			 			 			 			 
			 var permiso4=find_prm(tab4,tab_cod);
			 var permiso10=find_prm(tab10,tab_cod);
			 var tmoneda2=temp[9];
			// alert(parseInt(temp[15])/100);
			 var impto=parseInt(temp[15])/100;
			 
			 var percep_suc=document.formulario.percep_suc.value;
		     var percep_doc=document.formulario.percep_doc.value;
			 var min_percep_doc=document.formulario.min_percep_doc.value;
			 var est_percep_clie=document.formulario.est_percep_clie.value;
			 var por_percep_clie=document.formulario.por_percep_clie.value;
			 var total_doc=document.formulario.total_doc.value;
			 var tipomov=document.formulario.tipomov.value;
			 	
							 			 
			 doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&punitario='+document.formulario.punit.value+'&accion=mostrarprod&permiso4='+permiso4+'&permiso10='+permiso10+'&tmoneda2='+tmoneda2+'&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov,'mostrar','get','0','1','','');				
		
		}

}


	function rpta_bus_numero(texto){
		//alert(texto);
		//document.formulario.prueba.value=texto;
		var temp=texto.split("?");
		//alert(temp);
		if(temp[1]=="reservado"){
		
		if(document.getElementById("capaCopiarDoc").style.visibility=="visible"){
				document.frmCopiarDoc.temp_doc.value=temp[0];
				
				document.frmCopiarDoc.sucursal.disabled=true;
				document.frmCopiarDoc.almacen.disabled=true;
				document.frmCopiarDoc.doc.disabled=true;
				document.frmCopiarDoc.serie.disabled=true;
				document.frmCopiarDoc.numero.disabled=true;
				document.frmCopiarDoc.btncopiar.disabled=false;
				
				return false;
		}
		
			document.formulario.temp_doc.value=temp[0];
			document.formulario.sucursal.disabled=true;
			document.formulario.doc.disabled=true;
			document.formulario.num_correlativo.disabled=true;
			document.formulario.num_serie.disabled=true;
			//document.formulario.auxiliar.disabled=true;
			document.formulario.almacen.disabled=true;
		    document.formulario.auxiliar.disabled=false;
			
			document.formulario.auxiliar.focus();
			document.formulario.auxiliar.select();
			
			var permiso11=find_prm(tab11,tab_cod);
			//alert(permiso11);
			if(permiso11=='S'){
			document.formulario.doc_ref.disabled=false;
			}
		   	
		}else{
		//alert();
			
			if(document.getElementById("capaCopiarDoc").style.visibility=="visible"){
				alert("Numero de Documento ya existe");
				document.frmCopiarDoc.numero.focus();
				document.frmCopiarDoc.numero.select();
				return false;
			}
		
		
			 if(temp[1]=="noreservado"){
			 document.formulario.num_correlativo.value="";
             document.formulario.num_serie.focus();
			 document.formulario.num_serie.select();
			 }else{
			 
			 habilitar();
			 
			 document.formulario.temp_doc.value=temp[0];
			 seleccionar_cbo('almacen',temp[2]);
			 
			// alert(temp[3]);
			 seleccionar_cbo('responsable',temp[3]);	
			 seleccionar_cbo('condicion',temp[4]);	
			 document.formulario.femi.value=temp[5].substring(0,10);
			 document.formulario.fven.value=temp[6].substring(0,10);
			 document.formulario.auxiliar.value=temp[7];
			 document.formulario.incluidoigv.value=temp[8];
			 document.formulario.tmoneda.value=temp[9];
			 temp_mon=temp[9];
			 
			 document.formulario.serie_ref.value=temp[11];
			 document.formulario.correlativo_ref.value=temp[12];
			 //alert();
			 document.formulario.cod_cab_ref2.value=temp[14];
			 document.formulario.auxiliar2.value=temp[19];
			 
			 document.formulario.nom_transp.value=temp[22];
			 document.formulario.nom_chofer.value=temp[23];
			 document.formulario.tserie.value=temp[24];
			 
			 //alert();
			 var tempOT=temp[20].split("-");
			 document.formulario.numeroOT.value=tempOT[1];
			 document.formulario.serieOT.value=tempOT[0];
			 
			 document.formulario.numeroOT.readOnly="readonly";
			 document.formulario.serieOT.readOnly="readonly";
			 					 
			 
			 
			 if(temp[16]!=0 && temp[17]!=0){
			// seleccionar_cbo('transportista',temp[16]);
			 document.formulario.transportista.value=temp[16];
			 document.formulario.id_chofer.value=temp[17];
			 
			 document.getElementById('btn_chofer').disabled=true;
			 }
			 //alert(temp[18]);
			 //alert(temp[16]);99080380
			 //alert(temp[17]);
			 
			 
			 var estado=temp[10];
			 deshabilitar();
			 var permiso4=find_prm(tab4,tab_cod);
			 var tmoneda=temp[9];
			 
			 //var notas=document.formulario.notas.value;
			 
			 if(temp[13]=='RO' || temp[13]=='RARO' || temp[13]=='RORO'){
			 document.formulario.doc_ref2.disabled=false;
			 			 
			 }
			
			var permiso10=find_prm(tab10,tab_cod);
			var impto=parseInt(temp[15])/100;
			
			 var percep_suc=document.formulario.percep_suc.value;
		     var percep_doc=document.formulario.percep_doc.value;
			 var min_percep_doc=document.formulario.min_percep_doc.value;
			 var est_percep_clie=document.formulario.est_percep_clie.value;
			 var por_percep_clie=document.formulario.por_percep_clie.value;
			 var total_doc=document.formulario.total_doc.value;
			 var percep_recp=temp[18];
			 var tipomov=document.formulario.tipomov.value;
			
			//alert();					 
	doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&punitario='+document.formulario.punit.value+'&accion=mostrarprod&estado='+estado+'&permiso4='+permiso4+'&tmoneda2='+tmoneda+'&permiso10='+permiso10+'&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&percep_recp='+percep_recp+'&tipomov='+tipomov,'mostrar','get','0','1','','');
					
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
		document.getElementById("f_trigger_b2").disabled=true;
		
		document.formulario.fven.disabled=true;
		document.getElementById("f_trigger_b1").disabled=true;
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
		document.getElementById("f_trigger_b2").disabled=false;
		document.formulario.fven.disabled=false;
		document.getElementById("f_trigger_b1").disabled=false;
		
		}
		
		

var temp_busqueda="<?php echo $_SESSION['filtro_busqueda']?>";

//alert(temp_busqueda);
var temp_busqueda2="";


function validartecla(e,valor,temp){
	var tipoBus="";
	var tempValor=valor.value;
	//cancel_peticion()
	//alert(valor.value.substring(0,1));
	if(tempValor.substring(0,1)=='*' || tempValor.substring(0,2)=='**'){
				if(tempValor.length<5){
				return false;
				}
				tipoBus="aprox";
				if(tempValor.substring(0,2)=='**')
				tempValor=tempValor.substring(2,tempValor.length);
				else
				tempValor=tempValor.substring(1,tempValor.length);
			
				}else{
				tipoBus="ini";
				if(tempValor.length<3){
				return false;
				}	
	}
	
	if(document.formulario.correlativo_ref.value!='' && document.formulario.serie_ref!=''){
	alert('no esta permitido ingresar mas items');
	return false;
	}
	
	document.formulario.cantidad.value="";		
	document.formulario.punit.value="";		
	
	//((e.keyCode>=97) && (e.keyCode<=105)) || 
	var tipomov=document.formulario.tipomov.value;
	document.formulario.tempauxprod.value=temp;
	
	if(document.getElementById('productos').style.visibility=='visible'){
	temp_busqueda=document.formulario.busqueda.value;
	}else{
		if(document.getElementById('auxiliares').style.visibility=='visible'){
		temp_busqueda2=document.formulario.busqueda2.value;
		//alert(temp_busqueda);
		}
	
	}
	
	if ( ( (e.keyCode>=96) && (e.keyCode<=105) || (e.keyCode>=48) && (e.keyCode<=57) )  || ((e.keyCode>=65) && (e.keyCode<=90)) || e.keyCode==8 || e.keyCode==32 ) {
	

		
		
		if(document.getElementById(temp).style.visibility!='visible' ){
			doAjax('lista_aux.php','&temp='+temp+'&tipomov='+tipomov+'&modulo=tranf&tipoBus='+tipoBus,'listaprod','get','0','1','','');
		}else{
		
		
			var valor="";
			var temp_criterio=temp_busqueda;
			if(document.formulario.tempauxprod.value=='auxiliares'){
			valor=document.formulario.auxiliar.value;
			temp_criterio=temp_busqueda2;
			//selec_busq2();
			}
			if(document.formulario.tempauxprod.value=='productos'){
			valor=document.formulario.codprod.value;
			temp_criterio=temp_busqueda;
			//selec_busq();
			}
		
			var temp=document.formulario.tempauxprod.value;
			var tipomov=document.formulario.tipomov.value;
			var tienda=document.formulario.almacen.value;
			
			var moneda_doc=document.formulario.tmoneda.value;
			
		
		//alert(tipoBus);
		doAjax('det_aux.php','&clasificacion=1&nomb_det='+tempValor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc='+document.formulario.prov_asoc.value+'&moneda_doc='+moneda_doc+'&tipoBus='+tipoBus,'detalle_prod','get','0','1','','');
		 //alert('entro');
		}
		
		
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
			
		
		if(document.formulario.series.value=='S'){
		var cant=document.formulario.cantidad.value;
		var randomnumber=Math.floor(Math.random()*99999);
		var producto=document.formulario.codprod.value;
		var fecha=document.formulario.femi.value;
		var tienda=document.formulario.almacen.value;
		var cod_cab_ref=document.formulario.cod_cab_ref.value; 
		//alert(document.formulario.tipomov.value+" "+find_prm(tab_kardex_doc,tab_cod));
		
			if(find_prm(tab_kardex_doc,tab_cod)=='I'){
			var kardex_documento='1';
			}else{
			var kardex_documento='2';
			}
		if(document.formulario.tipomov.value!=kardex_documento){
		
		Modalbox.show('sal_series.php?cant='+cant+'&ran='+randomnumber+'&producto='+producto+'&fecha='+fecha+'&tienda='+tienda+'&cod_cab_ref='+cod_cab_ref, {title: 'Serie de productos ( SALIDAS )', width: 500}); 	return false;

		}else{
			var permiso10=find_prm(tab10,tab_cod);
			if(permiso10=='S'){
		Modalbox.show('ing_series.php?cant='+cant+'&ran='+randomnumber+'&producto='+producto+'&fecha='+fecha+'&tienda='+tienda+'&cod_cab_ref='+cod_cab_ref, {title: 'Ingreso de Series', width: 500}); return false;
			}
		}
		
				
//		Modalbox.show('ing_series.php?cant='+cant+'&ran='+randomnumber+'&producto='+producto+'&fecha='+fecha+'&tienda='+tienda, {title: 'Ingreso de Series', width: 500}); return false;
		
	//	alert('series');
	
		}
	
	//alert();
	document.formulario.punit.select();
	document.formulario.punit.focus();
	event.keyCode=0;
	event.returnValue=false;
	}

}

function calcular_ptotal(){
	var totalitem=parseFloat(document.formulario.punit.value)*parseFloat(document.formulario.cantidad.value);
	document.formulario.precio.value=totalitem.toFixed(2);	
	//document.formulario.precio.value=(Math.round((totalitem)*1000)/1000).toFixed(4);	
	
}


function eliminar(codigo,prod){

	if(!document.formulario.codprod.disabled){	
	var permiso4=find_prm(tab4,tab_cod);
	var notas=document.formulario.notas.value; 
	var tienda=document.formulario.almacen.value;
	var permiso10=find_prm(tab10,tab_cod);
	 var impto=document.formulario.impto.value;
	var tipomov=document.formulario.tipomov.value;
		 
	doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&cod_delete='+codigo+'&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&tienda='+tienda+'&permiso10='+permiso10+'&cargar_ref&impto='+impto+'&tipomov='+tipomov+'&codSerie='+prod,'mostrar','get','0','1',codigo,'eliminar');
	}
}


function seleccionar_cbo(control,valor){
		
		 var valor1=valor;
         var i;
		// alert(valor1+" "+control);
	     for (i=0;i< eval("document.formulario."+control+".options.length");i++)
        {
		//alert(eval("document.formulario."+control+".options[i].value")+" "+valor1);
         if (eval("document.formulario."+control+".options[i].value=='"+valor1+"'"))
            {
		//	alert("entro");
			   eval("document.formulario."+control+".options[i].selected=true");
            }
        
        }
		
	}
	
	function ver_new_aux(){
		
		
			document.formulario.aux_ruc.value="";
			document.formulario.aux_dni.value="";
			document.formulario.aux_razon.value="";
			document.formulario.aux_direccion.value="";
			document.formulario.accionAux.value="";
			document.formulario.codClie.value="";
			
		if(document.getElementById('auxiliares').style.visibility=='visible'){
		document.getElementById('auxiliares').style.visibility='hidden';
	//	mostrar_cbos()
		document.getElementById('new_aux').style.visibility='visible';
		
		document.formulario.persona[1].checked=true;
		document.formulario.persona[0].checked=false;
		document.formulario.aux_ruc.disabled=true;
		document.formulario.aux_dni.disabled=false;
		document.formulario.aux_dni.focus();
		}
	}
	
	function cancel_nuevo_aux(){
	document.getElementById('auxiliares').style.visibility='visible';
	mostrar_cbos()
	document.getElementById('new_aux').style.visibility='hidden';
	document.formulario.auxiliar.select();
	}
	
	function  guardar_aux(){
	
	var ruc=document.formulario.aux_ruc.value;
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
		//alert(ruc.length);
		if(persona=='juridica'){
			if(ruc.substring(0,2)<'10' &&  ruc.substring(0,2)>'20'){
				//&&  ruc.substring(0,2)!='15'
			alert('Ingrese un número de ruc válido');
			document.formulario.aux_ruc.select();
			document.formulario.aux_ruc.focus();
			return false;
			}
			if(ruc=="" || ruc.length!=11){
			alert('Ingrese un número de ruc válido');
			document.formulario.aux_ruc.select();
			document.formulario.aux_ruc.focus();
			return false;
			}		
		}
		//return false;
		if( (doc=="F1" || doc=="FA") && (ruc=="" || ruc.length!=11) ){
			alert('Este documento necesita un número de ruc ');
			document.formulario.aux_ruc.focus();
			return false;
		}else{
					//alert(razon);
					razon=razon.replace('&','amps');//)('&','/&#38;/')
					//alert(razon);
															
		var accionAux=document.formulario.accionAux.value;
		var codClie=document.formulario.codClie.value;	
		//alert();	
		
		doAjax('peticion_datos.php','&ruc='+ruc+'&dni='+dni+'&razon='+razon+'&contacto='+contacto+'&cargo='+cargo+'&direccion='+direccion+'&persona='+persona+'&tipo_aux='+tipo_aux+'&peticion=save_aux&accionAux='+accionAux+'&codClie='+codClie,'rspta_aux','get','0','1','','');
		
		}
			
	}
	
	function rspta_aux(texto){
	var ruc=document.formulario.aux_ruc.value;
	var dni=document.formulario.aux_dni.value;
	
	
	var temp=texto.split('?');
	//alert(temp[2]);
	//alert(temp[3]);
	if(temp[2]>0){
	  if(ruc!=''){
	  //verificacion de ruc - activacion
	  		var alt='';
	  	   if (temp[4]=='S'){ var alt=' desea dale de alta'; }
		   if (!confirm('¿El ruc ingresado ya existe '+ alt +'?')){
			return false;
		   }else{/// Lo que sea
 	doAjax('peticion_datos.php','&ruc='+ruc+'&peticion=filtro_aux','','get','0','1','','');
	//return false;
		   } 
	  /*//alert("El ruc ingresado ya existe");
	  document.formulario.aux_ruc.select();
      document.formulario.aux_ruc.focus();*/
	  }else{
	  alert("El dni ingresado ya existe");
	  document.formulario.aux_dni.select();
      document.formulario.aux_dni.focus();
	  return false;
	  }
	  
	}
	//return false;
///	document.formulario.prueba.value=temp[2];
	elegir2(temp[0],temp[1])
	
	//document.formulario.auxiliar.value=temp[1];
	//document.formulario.auxiliar2.value=temp[0];
			
	document.getElementById('new_aux').style.visibility='hidden';		
	//document.formulario.responsable.disabled=false;
	//document.formulario.responsable.focus();		
			
			document.formulario.aux_ruc.value="";
			document.formulario.aux_dni.value="";
			document.formulario.aux_razon.value="";
			document.formulario.aux_direccion.value="";
			document.formulario.accionAux.value="";
			document.formulario.codClie.value="";
			
	}
	
	function espec_prod(objeto){
	
//	alert(objeto.parentNode.parentNode.parentNode.rowIndex);
	selecionarItem(objeto.parentNode.parentNode.parentNode.rowIndex);
	var codigo=objeto.innerHTML;
	var moneda=document.formulario.tmoneda.value;
	var sucursal=document.formulario.sucursal.value;
		//window.open('espec_prod.php?codigo='+codigo+'&moneda='+moneda+'&sucursal='+sucursal,'','width=650,height=420,top=300,left=300,scroolbars=yes,directories=no,location=no,menubar=no,titlebar=no,toolbar=no,status=yes');	
	
	}

	function selec_busq(){
	
	 var valor1=temp_busqueda;
	/// alert(valor1);
 	 var obj=document.formulario.busqueda;
	 if(isset(obj)){ 
		 var i;
		 for (i=0;i<document.formulario.busqueda.options.length;i++)
			{
			
				if (document.formulario.busqueda.options[i].value==valor1)
				   {
				   document.formulario.busqueda.options[i].selected=true;
				   }
			
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
	var tipomov=document.formulario.tipomov.value;
	var doc=document.formulario.doc.value;
	
		window.open('../add_refer.php?sucursal='+sucursal+'&tipomov='+tipomov+'&doc='+doc,'ventana','width=500,height=300,top=300,left=300,scroolbars=no,directories=no,location=no,menubar=no,titlebar=no,toolbar=no,status=yes');		
		
	}
	
	function vent_referenciado(){
	
	var sucursal=document.formulario.sucursal.value;
	var tipomov=document.formulario.tipomov.value;
	var doc=document.formulario.doc.value;
	var serie=document.formulario.num_serie.value;
	var numero=document.formulario.num_correlativo.value;
	var auxiliar=document.formulario.auxiliar2.value;
	
	window.open('../referenciados.php?sucursal='+sucursal+'&tipomov='+tipomov+'&doc='+doc+'&serie='+serie+'&numero='+numero+'&auxiliar='+auxiliar,'ventana','width=500,height=300,top=300,left=300,scroolbars=no,directories=no,location=no,menubar=no,titlebar=no,toolbar=no,status=yes');	
		
	}
	
		
	function cargar_ref(serie,numero,cod_cli_ref,des_cli_ref,cod_cab_ref,mon_doc_ref,impto){
	
	var permiso4=find_prm(tab4,tab_cod);
	var permiso10=find_prm(tab10,tab_cod);
	var tipomov=document.formulario.tipomov.value;
	
	document.formulario.tmoneda.value=mon_doc_ref;
	temp_mon=mon_doc_ref;
	//temp_mon=mon_doc_ref;
	var kardex_doc_ope=find_prm(tab_kardex_doc,tab_cod);
	//alert(kardex_doc_ope+"-"+impto);
	
	if( (kardex_doc_ope=='I' && tipomov=='2') ||  (kardex_doc_ope=='S' && tipomov=='1') ){
	impto=parseInt(impto)/100;
	document.formulario.impto.value=impto;
	}else{
	var impto=document.formulario.impto.value;
	}
	
			 var percep_suc=document.formulario.percep_suc.value;
		     var percep_doc=document.formulario.percep_doc.value;
			 var min_percep_doc=document.formulario.min_percep_doc.value;
			 var est_percep_clie=document.formulario.est_percep_clie.value;
			 var por_percep_clie=document.formulario.por_percep_clie.value;
			 var total_doc=document.formulario.total_doc.value;
			 var tipomov=document.formulario.tipomov.value;
		
	doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&permiso10='+permiso10+'&cargar_ref=ref'+'&accion=mostrarprod&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov,'mostrar','get','0','1','','');
	
	document.formulario.serie_ref.value=serie;
	document.formulario.correlativo_ref.value=numero;
	document.formulario.auxiliar2.value=cod_cli_ref;
	document.formulario.auxiliar.value=des_cli_ref;
	document.formulario.cod_cab_ref.value=cod_cab_ref;
	
	document.formulario.responsable.disabled=false;
	
	document.formulario.condicion.disabled=false;
	document.formulario.condicion.focus();
	
	}
	
	function mostrar_detalle(){
	//alert();
	var permiso4=find_prm(tab4,tab_cod);
	var permiso10=find_prm(tab10,tab_cod);
	//alert(temp_mon);
	var impto=document.formulario.impto.value;
	
			 var percep_suc=document.formulario.percep_suc.value;
		     var percep_doc=document.formulario.percep_doc.value;
			 var min_percep_doc=document.formulario.min_percep_doc.value;
			 var est_percep_clie=document.formulario.est_percep_clie.value;
			 var por_percep_clie=document.formulario.por_percep_clie.value;
			 var total_doc=document.formulario.total_doc.value;
			 var tipomov=document.formulario.tipomov.value;
		//alert(document.formulario.tmoneda.value+" - "+temp_mon);
	doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&permiso10='+permiso10+'&accion=mostrarprod&cargar_ref&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov+'&copiarDoc='+document.formulario.tempCopiar.value,'mostrar','get','0','1','','');

		document.formulario.codprod.focus();
		
	}
			
	function cbo_cond(){
	var doc=document.formulario.doc.value;
	//alert(doc);
	doAjax('peticion_datos.php','&doc='+doc+'&peticion=cargar_cond','cargar_cbo_cond','get','0','1','','');
	
	}
	
	function cargar_cbo_cond(texto){
		//alert(texto);
	document.getElementById('cbo_cond').innerHTML=texto;
		if(document.formulario.tempCopiar.value=='S'){
			if(document.formulario.impto.value!=document.frmCopiarDoc.impto.value){
			document.formulario.impto.value=document.frmCopiarDoc.impto.value;
			
			}else{
			document.formulario.impto.value=document.frmCopiarDoc.impto.value;
			}
			mostrar_detalle();
		}	
	
	}
	
	function ant_imprimir(){
		
	var formato=find_prm(tab_formato,tab_cod);
		
	if(formato==''){
	alert('Este tipo de documento no tiene asignado un formato de impresión');
	return false;
	}
					
	var almacen=document.formulario.almacen.value;
	var serie=document.formulario.num_serie.value;
	var numero=document.formulario.num_correlativo.value;
	
	if(serie!='' && document.formulario.num_serie.disabled  && almacen!="0" && numero!='' && document.getElementById('estado').innerHTML=="CONSULTA" ){
	
	//	if(serie!='' && document.formulario.num_serie.disabled && document.formulario.total_doc.value!=0 && almacen!="0" && numero!='' && document.getElementById('estado').innerHTML=="CONSULTA" ){
	
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
	
	
	var formato=find_prm(tab_formato,tab_cod);
	var impresion=find_prm(tab_impresion,tab_cod);
	var cola_imp=find_prm(tab_cola1,tab_cod);
	
	//alert(cola_imp);

	
	var permiso16=find_prm(tab16,tab_cod);
	//var url='../formatos/'+formato;
	
	if(serie!='' && document.formulario.num_serie.disabled && document.formulario.total_doc.value!=0 && formato!=''){
	//alert(cola_imp);
	var win00=window.open('../formatos/'+formato+'?empresa='+sucursal+'&doc='+doc+'&serie='+serie+'&numero='+numero+'&impresion='+impresion ,'ventana2','width=1000,height=1000,top=100,left=100,scroolbars=yes,status=yes');	
	win00.focus();
	
	}else{
		
		if(permiso16=='S' && document.formulario.total_doc.value==0){
		var win00=window.open('../formatos/'+formato+'?empresa='+sucursal+'&doc='+doc+'&serie='+serie+'&numero='+numero+'&impresion='+impresion ,'ventana2','width=1000,height=1000,top=100,left=100,scroolbars=yes,status=yes');	
	win00.focus();
		}else{
	
		alert('No es posible imprimir');
		}
	}
	
	
	}
	
	
function cargar_cbo_doc(){
	
	var tipomov=document.formulario.tipomov.value;
		
	if(document.getElementById("capaCopiarDoc").style.visibility=="visible"){
	var empresa=document.frmCopiarDoc.sucursal.value;
	}else{	
	var empresa=document.formulario.sucursal.value;
	}
	var tempCodVend=window.parent.form1.tempCodVend.value;
	
	doAjax('../carga_cbo_doc.php','&tipomov='+tipomov+'&empresa='+empresa+'&tempCodVend='+tempCodVend,'res_cargar_cbo_doc','get','0','1','','');
	
}
	
	function res_cargar_cbo_doc(texto){
	
	var temp=texto.split("?");
	//alert(texto);
	if(document.getElementById("capaCopiarDoc").style.visibility=="visible"){
	//alert(temp[0]);
	document.getElementById('div3').innerHTML=temp[0];
	}else{
	document.getElementById('cbo_doc').innerHTML=temp[0];
	}
	//alert(temp[12]+" "+temp[18]);
				
			 tab1 =temp[1].split(",");
			 tab2 =temp[2].split(",");
			 tab3 =temp[3].split(",");
			 tab4 =temp[4].split(",");
			 tab5 =temp[5].split(",");
			 tab6 =temp[6].split(",");
			 tab7 =temp[7].split(",");
			 tab8 =temp[8].split(",");
			 tab9 =temp[9].split(",");
			 tab10 = temp[10].split(",");
			 tab11 = temp[11].split(",");
			
			//alert(tab10);
			 tab_cod = temp[12].split(",");
			 tab_nitems =temp[13].split(",");
             tab_serie =temp[14].split(",");
			 tab_numero_ini =temp[15].split(",");
			 tab_numero_fin =temp[16].split(",");
			 tab_impresion =temp[17].split(",");
			 tab_formato =temp[18].split(",");
			 tab_kardex_doc=temp[19].split(","); 
			 tab_kardex_doc=temp[19].split(","); 	
			 tab_impuesto1=temp[20].split(",");
			 tab_min_percep=temp[24].split(","); 
			 tab_moneda=temp[26].split(","); 
			 
			 tab12 = temp[21].split(",");
			 tab13 = temp[22].split(",");
			 tab14 = temp[23].split(",");
			 tab15 = temp[25].split(",");
			 tab16 = temp[27].split(",");
			 tab17 = temp[28].split(",");
			 tab18 = temp[29].split(",");
			 tab19 = temp[33].split(",");
			 
			 tab_cola1=temp[31].split(",");
			 //tab_cola2=temp[32].split(",");
			 tab_numauto = temp[34].split(",");
			 tab_descuento = temp[35].split(",");
			 tab_mostrarOT=temp[36].split(",");
		//	 alert(tab16);			
			//alert(temp[21]+" "+temp[22]);
		//numero de documento no autorizado ...
		
	}
	
	
	function filtros(){
			
			
			
			
			
			var valor="";
			if(document.formulario.tempauxprod.value=='auxiliares'){
			valor=document.formulario.auxiliar.value;
			
			//selec_busq2();
			}
			if(document.formulario.tempauxprod.value=='productos'){
			valor=document.formulario.codprod.value;
			
			//selec_busq();
			}
			
			//-----------------------------control de busqueda-----------------------
			var tipoBus="";
			var tempValor=valor;
			//cancel_peticion()
			//alert(valor.value.substring(0,1));
			if(tempValor.substring(0,1)=='*' || tempValor.substring(0,2)=='**'){
				if(tempValor.length<5){
				return false;
				}
				tipoBus="aprox";
				//alert(tempValor.substring(0,2));
				if(tempValor.substring(0,2)=='**')
				tempValor=tempValor.substring(2,tempValor.length);
				else
				tempValor=tempValor.substring(1,tempValor.length);
			}else{
				tipoBus="ini";
				if(tempValor.length<3){
				return false;
				}	
			}
			
			//--------------------------------------------------------------------------------
		
			var temp=document.formulario.tempauxprod.value;
			var tipomov=document.formulario.tipomov.value;
			var tienda=document.formulario.almacen.value;
			
			var temp_criterio=temp_busqueda;
			
			var comboclasificacion=document.formulario.comboclasificacion.value;
			var categoria=document.formulario.combocategoria.value;
			var subcategoria=document.formulario.combosubcategoria.value;
			var moneda_doc=document.formulario.tmoneda.value; 
			
		
		doAjax('det_aux.php','&clasificacion=1&nomb_det='+tempValor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc='+document.formulario.prov_asoc.value+'&comboclasificacion='+comboclasificacion+'&categoria='+categoria+'&subcategoria='+subcategoria+'&moneda_doc='+moneda_doc+'&tipoBus'+tipoBus,'detalle_prod','get','0','1','','');
	
	
	}

function calc_pre_total(){
	var totalitem=parseFloat(document.formulario.punit.value)*parseFloat(document.formulario.cantidad.value);
	document.formulario.precio.value=totalitem.toFixed(2);
	calculos_pretot();	
}	

function calculos_pretot(){
try{
	 	for (i=0;i<document.formulario.presentacion.options.length;i++)
        {
		
         if (document.formulario.presentacion.options[i].value==document.formulario.presentacion.value)
            {
			   var des_pres=document.formulario.presentacion.options[i].text;
            }
        
        }
		

		
		var total_precio="";	
		var precio=parseFloat(des_pres.substring(10));
		//alert(precio);
		if(tempNivelUser==2){
		precio=0.00;
		}
		
		var moneda_doc=document.formulario.tmoneda.value;
		var moneda_prod=document.formulario.prod_moneda.value;
			
			if(moneda_prod=='01' && moneda_doc=='02'){
			total_precio=parseFloat(precio/tc_doc);
			}else{
				if(moneda_prod=='02' && moneda_doc=='01'){
				total_precio=parseFloat(precio*tc_doc);
				}else{
				total_precio=parseFloat(precio);
				}
			
			}
		
		
			if(document.formulario.tipomov.value=='2'){
				if(parseFloat(document.formulario.punit.value)==0 || document.formulario.punit.value==""){
				//document.formulario.punit.value=parseFloat(total_precio).toFixed(4);				
				document.formulario.precio.value=parseFloat((total_precio*document.formulario.cantidad.value)).toFixed(2);
				}	
			}
			document.formulario.punit.value=parseFloat(total_precio).toFixed(4);
		

//Yedem sub unidad
var cant=document.formulario.cantidad.value;
var saldo=document.formulario.saldo.value;

doAjax('sub_unidad.php','&codp='+document.formulario.codprod.value+'&facp='+document.formulario.factor_p.value+'&fac1='+document.formulario.presentacion.value+'&saldo='+saldo+'&cant='+cant,'CountSubUnidad','get','0','1','','');

}catch(e){
}		
	}
		
				
	function ocultar_cbos(){
	document.getElementById('presentacion').style.visibility='hidden';
	}
	function mostrar_cbos(){
	document.getElementById('presentacion').style.visibility='visible';
	}	
		

	function cambiar_fondo(control,evento){
	
	if(evento=='e')
	control.style.backgroundImage='url(../imagenes/boton_aplicar2.gif)';
	else
	control.style.backgroundImage='url(../imagenes/boton_aplicar.gif)';
	
	}
	
	function llenar_fecha(control,e){
	
		if(e.keyCode==13 || e==13){
		  
		   try {
				 if (typeof(eval(document.form_series.nroserie.length)) != 'undefined')
				 var ESarray='S';
				 else
				 var ESarray='N';
			 } catch(e) { }
			 
			 if(ESarray=='S'){
				 
					for(var i=0;i<document.form_series.nroserie.length;i++){
					
						if(document.form_series.nroserie[i].value==control.value && control!=document.form_series.nroserie[i]){
						alert('Este numero de serie ya se encuentra ingresado en la lista actual');
						
						control.value="";
						control.select();
						return false;
						}
					
					}
						 
				   for(var i=0;i<document.form_series.nroserie.length;i++){
					
						if(control==document.form_series.nroserie[i] ){
						
								if(i+1<document.form_series.nroserie.length){
								document.form_series.nroserie[i+1].focus();	
								document.form_series.fvenserie[i].value=document.form_series.temp_fvenserie.value;
								return false;
								}else{
								document.form_series.fvenserie[i].value=document.form_series.temp_fvenserie.value;
								alert("Ingreso de series completada...");
								}
						}	
									
				   }
					
			}else{
			
				if(document.form_series.nroserie.value!=''){
				alert("Ingreso de series completada...");
				}
			}
					
		}//cerrar if		
	
	
	}
	
	function llenar_fvenc(control){
		
			try {
				 if (typeof(eval(document.form_series.nroserie.length)) != 'undefined')
				 var ESarray='S';
				 else
				 var ESarray='N';
			 } catch(e) { }
			 
				if(ESarray=='S'){			 
				 
					if(control.value!=""){
					 for(var i=0;i<document.form_series.nroserie.length;i++){
						if(control==document.form_series.nroserie[i]){
						document.form_series.fvenserie[i].value=document.form_series.temp_fvenserie.value;
						return false;
						}
					 
					 }
					 
					} else{
					
						for(var i=0;i<document.form_series.nroserie.length;i++){
							if(control==document.form_series.nroserie[i]){
							document.form_series.fvenserie[i].value="";
							return false;
							}
					 
						 }
					 
				 	}
			 	
			 
			 }else{
			 
			 	   if(control.value!=""){
							if(control==document.form_series.nroserie){
							document.form_series.fvenserie.value=document.form_series.temp_fvenserie.value;
							return false;
							}
						 						 					 
					} else{			
						
							if(control==document.form_series.nroserie){
							document.form_series.fvenserie.value="";
							return false;
							}
					 									 
				 	}
				
			}
	
	}
	
	function cambiar_fecha(){
	
	document.getElementById("cambiar_fecha").style.display="block";
	
	}
	
	function aceptar_serie(){

		try {
				 if (typeof(eval(document.form_series.nroserie.length)) != 'undefined')
				 var ESarray='S';
				 else
				 var ESarray='N';
			 } catch(e) { }
				
		var series="";
		var tempSer=0;
		if(ESarray=='S'){
			for(var i=0;i<document.form_series.nroserie.length;i++){
				/*
				if(document.form_series.nroserie[i].value==""){
				alert("Las series no pueden quedar en blanco");
				return false;
				}*/
				if(document.form_series.nroserie[i].value!=""){
				tempSer=tempSer+1;
				series=series+"_"+document.form_series.nroserie[i].value;
				}
				
			
				
			}
			
			document.formulario.cantidad.value=tempSer;
			
		}else{
				if(document.form_series.nroserie.value==""){
				alert("Las series no pueden quedar en blanco");
				return false;
				}
				series=series+"_"+document.form_series.nroserie.value;
				
		}		
			
		
		
		
		var fvenc=document.form_series.temp_fvenserie.value;
		var producto=document.form_series.codprod2.value;
		var accion=document.form_series.accion_serie.value;
		var estado_doc=document.getElementById('estado').innerHTML;
		var temp_doc=document.formulario.temp_doc.value;
		var tienda=document.formulario.almacen.value;
		var tipomov=document.formulario.tipomov.value;
		
	doAjax('peticion_datos.php','&peticion=ing_series&series='+series+'&fvenc='+fvenc+'&producto='+producto+'&accion='+accion+'&estado_doc='+estado_doc+'&temp_doc='+temp_doc+'&tienda='+tienda+'&tipomov='+tipomov,'rspta_aceptar_serie','get','0','1','','');
	
	}
	
	function rspta_aceptar_serie(texto){
	
		if(texto==''){
		Modalbox.hide();
		
		document.formulario.serie_ing.value="S";
		document.formulario.punit.focus();
		document.formulario.punit.select();
																		
		}else{
		
		  try {
				 if (typeof(eval(document.form_series.nroserie.length)) != 'undefined')
				 var ESarray='S';
				 else
				 var ESarray='N';
			 } catch(e) { }
			 
			 if(ESarray=='S'){
				
				 for(var i=0;i<document.form_series.nroserie.length;i++){
						
						if(document.form_series.nroserie[i].value==texto){
						alert('Esta serie ya se encuentra ingresada en el Sistema.......\nNro.Serie:  '+texto);
						
						document.form_series.nroserie[i].focus();
						document.form_series.nroserie[i].select();
						return false;
						}
					
					}
			}else{			
			alert('Esta serie ya se encuentra ingresada en el Sistema.......\nNro.Serie:  '+texto);
			}
				
		}
		
		
	}
	
	var temp2="";
	function entrada(objeto){
	//objeto.cells[0].childNodes[0].checked=true;
	//
	if(tempColor=="" && document.getElementById('productos').style.visibility=='visible'){
	tempColor=document.getElementById('tblproductos').rows[0];
	document.getElementById('tblproductos').rows[0].style.background='';
	}
	if(tempColor=="" && document.getElementById('auxiliares').style.visibility=='visible'){
	tempColor=document.getElementById('tblproductos1').rows[0];
	document.getElementById('tblproductos1').rows[0].style.background='';
	}
	
	
		try{
		tempColor.style.background='#ffffff';
			if(objeto.style.background=='#fff1bb'){
		//objeto.style.background=objeto.bgColor;
		//temp=objeto;
			}else{
			objeto.style.background='#fff1bb';
				if(temp2!=''){
				//alert(temp.style.background);
				//alert(objeto.bgColor);
				temp2.style.background=temp2.bgColor;
				}
				temp2=objeto;
			}
		}catch(e){}
	}
	
	
	function entradae(objeto){
	
		if(document.activeElement.type=='text' || document.activeElement.type=='checkbox' ){
		objeto.cells[0].childNodes[0].checked=false;
		}
		//alert(objeto.innerHTML);
			if(objeto.style.background=='#fff1bb'){
			//alert(objeto.bgColor);
			objeto.style.background='#ffffff';
			objeto.cells[0].childNodes[0].checked=false;
			document.getElementById("label_cant_selec").innerHTML=contorl_item_selec();
			document.form_series.cant_selec.value=contorl_item_selec();
			}else{
			
				if( (contorl_item_selec()==document.form_series.cant_req.value ) && document.formulario.cod_cab_ref.value=='' ){
					
					if(document.form_series.accion_series.value=='editar'){
					alert('Solo puede cambiar el número de serie');
					return false;
					}
									
					if(confirm('Cantidad de item ya ha sido completada..... desea seguir agregando mas items?')){
					}else{
					return false;
					}
				}else{
				
				
				}
			
			objeto.style.background='#FFF1BB';
			objeto.cells[0].childNodes[0].checked=true;
			document.getElementById("label_cant_selec").innerHTML=contorl_item_selec();
			document.form_series.cant_selec.value=contorl_item_selec();
			}
	
	}
	
	function buscar_serie(serie,e){
		if(e.keyCode==13){	
		//alert();
			var temp='N';
			//alert(serie.value+ " "+ document.getElementById('tbl_series').rows[i].cells[1].innerHTML);
			
			if(contorl_item_selec()==document.form_series.cant_req.value){
			
				if(confirm('Cantidad de item ya ha sido completada desea seguir agregando mas items....')){
				
				}else{
				return false;
				}
			
			}	
				
				//alert(serie.value);
			   for (var i=1;i<document.getElementById('tbl_series').rows.length;i++) { 
			   
			        //alert(document.getElementById('tbl_series').rows[i].cells[1].childNodes[0].childNodes[0].value);
					if(document.getElementById('tbl_series').rows[i].cells[1].childNodes[0].childNodes[0].value.toUpperCase()==serie.value.toUpperCase()){
					
							document.getElementById('tbl_series').rows[i].style.background='#fff1bb';
							document.getElementById('tbl_series').rows[i].cells[0].childNodes[0].checked=true;
							document.getElementById("label_cant_selec").innerHTML=contorl_item_selec();
							document.form_series.cant_selec.value=contorl_item_selec();
							//alert(document.getElementById('tbl_series').rows[i].cells[0].innerHTML);
							document.form_series.scanner.focus();
							document.form_series.scanner.select();
							temp='S';
							return false;
							}
					}
				
				if(temp=='N'){
				alert('serie no encontrada');
				document.form_series.scanner.focus();
				document.form_series.scanner.select();
				}		
					
			}
	
	}
	
	
	function contorl_item_selec(){
	
		var contador=0;
		for (var i=1;i<document.getElementById('tbl_series').rows.length;i++) {
		
			if(document.getElementById('tbl_series').rows[i].cells[0].childNodes[0].checked){
				contador++;
			}
		}
		return contador;
	}
	
	function aceptar_sal_serie(){
		
		var accion=document.form_series.accion_series.value;
		var tienda=document.formulario.almacen.value;
		if(accion=='editar' && document.formulario.cod_cab_ref.value==''){
				if(contorl_item_selec()!=document.form_series.cant_req.value){
				alert('Solo puede cambiar el numero de serie');
				return false;
				}
			
		document.formulario.codprod.focus();
		}else{
		
			if(document.formulario.cod_cab_ref.value!=''){
			
				cambiar_cant_series();
				//alert();
				return;
		
		
			}else{
				document.formulario.cantidad.value=document.form_series.cant_selec.value;
				calculos_pretot();
				//alert();
				
				document.formulario.punit.focus();
				document.formulario.punit.select();
			}
		}
		var producto=document.form_series.codprod2.value;	
				
		var series="";
		
		
			for (var i=1;i<document.getElementById('tbl_series').rows.length;i++) {
			 
				if(document.getElementById('tbl_series').rows[i].cells[0].childNodes[0].checked){
				series=series+"_"+document.getElementById('tbl_series').rows[i].cells[1].childNodes[0].childNodes[0].value;
				}
			}
		if(series!=""){	

		doAjax('peticion_datos.php','&peticion=sal_series&series='+series+'&producto='+producto+'&accion='+accion+'&tienda='+tienda,'rspta_aceptar_sal_serie','get','0','1','','');
		}else{
			alert("No ha ingresado ningun número de serie..");
			return false;
		}
				
		
	}
	
	function rspta_aceptar_sal_serie(texto){
	//alert(texto);
	document.formulario.serie_ing.value="S";
		if(document.formulario.pruebas.value==""){
		Modalbox.hide();
		
		}
	document.formulario.pruebas.value="";
		
	}
	
	function cambiar_cant_series(){
	
		var producto=document.form_series.codprod2.value;	
				
		var series="";
		var cant=0;
		
			for (var i=1;i<document.getElementById('tbl_series').rows.length;i++) {
			 
				if(document.getElementById('tbl_series').rows[i].cells[0].childNodes[0].checked){
				series=series+"_"+document.getElementById('tbl_series').rows[i].cells[1].childNodes[0].innerHTML;
				cant++;
				}
			}
		if(series!=""){	

		doAjax('peticion_datos.php','&peticion=cambiar_cant_series&series='+series+'&producto='+producto+'&cant_nueva='+cant,'rspta_cambiar_cant_series','get','0','1','','');
		}else{
			alert("No ha ingresado ningun número de serie..");
			return false;
		}
	
	
	}
	
	
	function rspta_cambiar_cant_series(){
	
				var permiso4=find_prm(tab4,tab_cod);
				var permiso10=find_prm(tab10,tab_cod);
				//var cod_cab_ref=document.formularo.cod_cab_ref.value;
				var impto=document.formulario.impto.value;
			 var percep_suc=document.formulario.percep_suc.value;
		     var percep_doc=document.formulario.percep_doc.value;
			 var min_percep_doc=document.formulario.min_percep_doc.value;
			 var est_percep_clie=document.formulario.est_percep_clie.value;
			 var por_percep_clie=document.formulario.por_percep_clie.value;
			 var total_doc=document.formulario.total_doc.value;
			 var tipomov=document.formulario.tipomov.value;
				
				doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&permiso10='+permiso10+'&cargar_ref=ref&accion=mostrarprod&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov,'mostrar','get','0','1','','');
				Modalbox.hide();
	}
	
	
	
	function editar_serie(codprod,control){
	
	var tipomov=document.formulario.tipomov.value;
	var randomnumber=Math.floor(Math.random()*99999);
	var cantidad=control.innerHTML;
	var estado_doc=document.getElementById('estado').innerHTML;
	var temp_doc=document.formulario.temp_doc.value;
	var tienda=document.formulario.almacen.value;
	var cod_cab_ref=document.formulario.cod_cab_ref.value; 
	var cab_doc=document.formulario.temp_doc.value;
	var tipo_mov=document.formulario.tipomov.value;
	var kardex_doc=find_prm(tab_kardex_doc,tab_cod);
		
		
		if(find_prm(tab_kardex_doc,tab_cod)=='I'){
			var kardex_documento='1';
			}else{
			var kardex_documento='2';
			}
	
		
		if(tipomov==1){
		
				if(tipomov!=kardex_documento ){
				
				Modalbox.show('sal_series.php?accion=editar&ran='+randomnumber+'&producto='+codprod+'&cant='+cantidad+'&estado_doc='+estado_doc+'&temp_doc='+temp_doc+'&tienda='+tienda+'&cod_cab_ref='+cod_cab_ref+'&cab_doc='+cab_doc+'&tipo_mov='+tipo_mov+'&kardex_doc='+kardex_doc, {title: 'Serie de productos ( Salidas )', width: 500}); 
				
				}else{
		Modalbox.show('ing_series.php?accion=editar&ran='+randomnumber+'&producto='+codprod+'&estado_doc='+estado_doc+'&temp_doc='+temp_doc+'&tienda='+tienda+'&cab_doc='+cab_doc+'&cod_cab_ref='+cod_cab_ref, {title: 'Serie de productos ( Ingresos )', width: 500}); 
				}
		
		}else{
		Modalbox.show('sal_series.php?accion=editar&ran='+randomnumber+'&producto='+codprod+'&cant='+cantidad+'&estado_doc='+estado_doc+'&temp_doc='+temp_doc+'&tienda='+tienda+'&cod_cab_ref='+cod_cab_ref+'&cab_doc='+cab_doc+'&tipo_mov='+tipo_mov+'&kardex_doc='+kardex_doc, {title: 'Serie de productos ( Salidas )', width: 500}); 
		}
		

				
	
	}
	
	
	function enfocar_codprod(){
	var pagina = self.location.href.match( /\/([^/]+)$/ )[1];
		if(pagina=='transferencia.php'){
		document.form1.codprod.focus();document.form1.codprod.select();
		}else{
		document.formulario.codprod.focus();document.formulario.codprod.select();
		}
	}
	
		function cambiar_moneda_ini(){
		
			
		
			if(document.getElementById('moneda').innerHTML=='(S/.)'){
			document.getElementById('moneda').innerHTML='(US$.)';
			document.formulario.tmoneda.value="02";
			//document.formulario.precosto.value=document.formulario.precosto.value/tc_doc;
			}else{
			document.getElementById('moneda').innerHTML='(S/.)';
			document.formulario.tmoneda.value="01";
			//document.formulario.precosto.value=document.formulario.precosto.value*tc_doc;
			
			}
			
			if(document.formulario.total_doc.value!=0.00){
			
			var permiso4=find_prm(tab4,tab_cod);
			var permiso10=find_prm(tab10,tab_cod);
			var impto=document.formulario.impto.value;
			
			
			 var percep_suc=document.formulario.percep_suc.value;
		     var percep_doc=document.formulario.percep_doc.value;
			 var min_percep_doc=document.formulario.min_percep_doc.value;
			 var est_percep_clie=document.formulario.est_percep_clie.value;
			 var por_percep_clie=document.formulario.por_percep_clie.value;
			 var total_doc=document.formulario.total_doc.value;
			var tipomov=document.formulario.tipomov.value;
		
			doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&accion=cambiar_dolar&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&permiso10='+permiso10+'&cargar_ref&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov,'mostrar','get','0','1','','');
			}else{
				if(document.getElementById('moneda').innerHTML=='(S/.)'){
				temp_mon="01";
				}else{
				temp_mon="02";
				}
			}
		
		}


function doc_det(valor){

if(valor==''){
valor=document.formulario.cod_cab_ref2.value;
}
window.open("../doc_det2.php?referencia="+valor,"","toolbar=no,status=no, menubar=no, scrollbars=yes, width=520, height=320,left=300 top=250");

}

function recalcular_precios(control,producto,e,precosto,mon_prod,pre_actual){


	if(e.keyCode==13){
	var precio_nuevo=parseFloat(control.value);
	var tc_doc=document.formulario.tcambio.value;
	//alert(precio_nuevo+" "+producto);
	if(mon_prod==1 && document.getElementById('moneda').innerHTML=='(US$.)'){
			precosto=parseFloat(precosto/tc_doc).toFixed(4);
			}else{
				if(mon_prod==2 && document.getElementById('moneda').innerHTML=='(S/.)'){
				precosto=parseFloat(precosto*tc_doc).toFixed(4);
				}
			
	}
	
	//alert(mon_prod+" "+precosto);
	/* Precio Menor al costo en el detalle*/
/*	
	if(precio_nuevo<precosto){
	alert('El precio no puede ser menor a el precio de costo');
	control.value=pre_actual;
	control.focus();
	control.select();
	return false;
	}
*/	
		
	
		var permiso4=find_prm(tab4,tab_cod);
		var permiso10=find_prm(tab10,tab_cod);
		var impto=document.formulario.impto.value;	
		
		 var percep_suc=document.formulario.percep_suc.value;
	     var percep_doc=document.formulario.percep_doc.value;
		 var min_percep_doc=document.formulario.min_percep_doc.value;
		 var est_percep_clie=document.formulario.est_percep_clie.value;
		 var por_percep_clie=document.formulario.por_percep_clie.value;
		 var total_doc=document.formulario.total_doc.value;
		var tipomov=document.formulario.tipomov.value;
		
		//alert(producto);
		
	doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&accion=cambiar_dolar&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&permiso10='+permiso10+'&precio_nuevo='+precio_nuevo+'&producto='+producto+'&cambiar_precio&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov,'mostrar','get','0','1','','');
	
	}

}


function validar_fecha_doc(objeto){

	//alert(objeto.value.length);
	if(objeto.value.length==8){
	var dia=objeto.value.substr(0,2);
	var mes=objeto.value.substr(2,2);
	var anio=objeto.value.substr(4,4);
	var fechaNueva=dia+"-"+mes+"-"+anio;
	//alert(fechaNueva);
	objeto.value=fechaNueva;
	}


	var array_fecha=objeto.value.split("-");
	//alert(array_fecha.length);
	
		if(array_fecha.length==3){
		
				//alert(!isNaN(array_fecha[2]));
				if( !isNaN(array_fecha[0]) && !isNaN(array_fecha[1]) && !isNaN(array_fecha[2]) && array_fecha[0].length==2 && array_fecha[1].length==2 && array_fecha[2].length==4 ){
				
				if( (array_fecha[0]>0 && array_fecha[0]<32) &&  (array_fecha[1]>0 && array_fecha[1]<13) && (array_fecha[2]>2000 && array_fecha[2]<2100) ){
				
					if(objeto.name=='femi'){
						document.formulario.fven.disabled=false;
						document.getElementById("f_trigger_b1").disabled=false;
						document.formulario.femi.disabled=true;
						document.getElementById("f_trigger_b2").disabled=true;
						
						var texto=document.formulario.condicion.options[document.formulario.condicion.selectedIndex].text;
						var temp=texto.split(" ");
						if(isNaN(parseInt(temp[1]))){
						document.formulario.fven.value=document.formulario.femi.value;
						}
						
						document.formulario.fven.select();
						document.formulario.fven.focus();
					}else{
												
						var myDate1 = new Date(objeto.value);
						var myDate2 = new Date(document.formulario.femi.value);
						//alert(myDate1 +" "+ myDate2);
						if(compare_dates(objeto.value,document.formulario.femi.value)){
												
				//			if(objeto.value >= document.formulario.femi.value){
							document.formulario.codprod.disabled=false;
							document.formulario.punit.disabled=false;
							document.formulario.cantidad.disabled=false;
							document.formulario.notas.disabled=false;
							document.formulario.termino.disabled=false;
							
							document.formulario.codprod.focus();
							document.formulario.fven.disabled=true;
							document.getElementById("f_trigger_b1").disabled=true;
							}else{
							alert("La fecha de vencimiento no puede ser menor a la fecha de emisión");
							document.formulario.fven.select();
							document.formulario.fven.focus();
							}
					}
				
				
				
				}else{
				alert("Fecha no valida");
				retornar_fecha(objeto);	
				
				}
				
				
			
				
			}else{
			alert("El formato de fecha no es correcto");
			retornar_fecha(objeto);			
			}
			
		
		}else{
		alert("Fecha incorrecta");
		retornar_fecha(objeto);		
		}
	
}

function retornar_fecha(objeto){

				if(objeto.name=='femi'){
					document.formulario.femi.select();
					document.formulario.femi.focus();
					
				}else{
					
					document.formulario.fven.select();
					document.formulario.fven.focus();
					
				}
				return false;
}

function enfocar_fecha(objeto){

objeto.select();
objeto.focus();
}

function mostrar_chofer(control){
//alert(control.value);
	var valor=control.value.split("?");

	document.formulario.id_chofer.value=valor[1];
	document.formulario.nom_chofer.value=valor[2];

}

function cambiar_chofer(param){

	doAjax('../peticion_ajax2.php','&peticion=mostrar_chofer&tabla='+param,'mostrar_chofer2','get','0','1','','');
	
}

function mostrar_chofer2(texto){

if(document.getElementById("capaCopiarDoc").style.visibility=="visible"){
document.frmCopiarDoc.sucursal.style.visibility='hidden';
document.frmCopiarDoc.almacen.style.visibility='hidden';
document.frmCopiarDoc.doc.style.visibility='hidden';
document.frmCopiarDoc.responsable.style.visibility='hidden';
}
document.getElementById('choferes').style.zIndex='100';

document.getElementById('choferes').innerHTML=texto;
document.getElementById('choferes').style.visibility='visible';
document.getElementById('cbo_uni').style.visibility='hidden';
document.formulario.valor_chofer.focus();
}

function sel_chofer(codigo,nombre){
	
	if(document.formulario.transpChofer.value=='A'){
		document.frmCopiarDoc.auxOrigen2.value=codigo;
		document.frmCopiarDoc.auxOrigen.value=nombre;
		
	}else{
		if(document.formulario.transpChofer.value=='C'){
		document.formulario.id_chofer.value=codigo;
		document.formulario.nom_chofer.value=nombre;
		}else{
		document.formulario.transportista.value=codigo;
		document.formulario.nom_transp.value=nombre;
		}
	}	

salir();
}

function busqueda_chofer(pag){

var tabla=document.formulario.transpChofer.value;
var valor=document.formulario.valor_chofer.value;

doAjax('../peticion_ajax2.php','&peticion=buscar_chofer&valor='+valor+'&tabla='+tabla+'&pag='+pag,'mostrar_bus_chofer','get','0','1','','');
}

function cargar_datos(pag){
//alert();
busqueda_chofer(pag);
}

function mostrar_bus_chofer(texto){
temp=texto.split("~");
document.getElementById('detalle_chofer').innerHTML=temp[0];
document.getElementById('divpagina').innerHTML=temp[1];

}

function buscar_valor(control){

	for(var i=0;i<array_idsuc.length;i++){
		if(control.value==array_idsuc[i]){
		
			if(document.getElementById("capaCopiarDoc").style.visibility=="visible"){
		
			document.frmCopiarDoc.percep_suc.value=array_percepsuc[i];
			}else{	
			//alert();
			document.formulario.percep_suc.value=array_percepsuc[i];
			}
		}
	}
}

function cambiar_dir(){
document.getElementById('cambiarDirec').style.visibility='visible';
document.getElementById('cbo_uni').style.visibility='hidden';
document.formulario.dirPartida.focus();
document.formulario.dirPartida.select();
}

function llenar_dir(tienda){
var dir_tienda=document.formulario.dir_tienda.value.split("~");
var cod_tienda=document.formulario.cod_tienda.value.split("~");
//alert(cod_tienda);
	for(var i=0;i<dir_tienda.length;i++){
	//alert(cod_tienda[i] +" "+tienda);
		if(cod_tienda[i]==tienda){
		   document.formulario.dirPartida.value=dir_tienda[i];
		}
			
	}
//document.formulario.dirPartida.value=;

}


function genNumCopiar(e,control){

 		
		if(e.keyCode==13){
		//alert()
				if(control.name=='serie'){
			   		var valor=document.frmCopiarDoc.serie.value;
					var ceros=3;
					var doc=document.frmCopiarDoc.doc.value;
					var sucursal=document.frmCopiarDoc.sucursal.value;
					var tipomov=document.formulario.tipomov.value;
						     
				   document.frmCopiarDoc.serie.value=ponerCeros(valor,ceros);
				   
				   doAjax('peticion_datos.php','&serie='+document.frmCopiarDoc.serie.value+'&doc='+doc+'&sucursal='+sucursal+'&peticion=generar_numero&tipomov='+tipomov,'genNumCopiar2','get','0','1','',''); 
				  
		    	}
				
			}	
}

function genNumCopiar2(texto){
//alert(texto);
 		//  document.frmCopiarDoc.num_serie.value=ponerCeros(document.formulario.num_serie.value,3);
		  document.frmCopiarDoc.numero.disabled=false;
		  document.frmCopiarDoc.numero.value=ponerCeros(texto,7);
		  
		  document.frmCopiarDoc.numero.focus();
	      document.frmCopiarDoc.numero.select();

}

function validarNumCopiar(e,control){

		var serie=document.frmCopiarDoc.serie.value;
		var numero=ponerCeros(document.frmCopiarDoc.numero.value,7);
		var doc=document.frmCopiarDoc.doc.value;
		var sucursal=document.frmCopiarDoc.sucursal.value;
		var tipomov=document.formulario.tipomov.value;
		
		
	   if(e.keyCode==13){
	    document.frmCopiarDoc.numero.value=numero;
		  if(tipomov==1){
		 
			doAjax('peticion_datos.php','&serie='+serie+'&numero='+numero+'&doc='+doc+'&sucursal='+sucursal+'&peticion=buscar_prov2&tipomov='+document.formulario.tipomov.value,'rpta_bus_numero','get','0','1','','');
		  }else{
			doAjax('peticion_datos.php','&serie='+serie+'&numero='+numero+'&doc='+doc+'&sucursal='+sucursal+'&peticion=buscar_prov2&tipomov='+document.formulario.tipomov.value,'rpta_bus_numero','get','0','1','','');
										
		  }
	   }					
						
}


function generateCoverDiv(id, color, opacity)
{
    var navegador=1;
    if(navigator.userAgent.indexOf("MSIE")>=0) navegador=0;
    
    var layer=document.createElement('div');
    layer.id=id;
    layer.style.width=document.body.offsetWidth+'px';
    layer.style.height=document.body.offsetHeight+'px';
	//layer.style.width=’100%’;
	//layer.style.height=’100%’
	
    layer.style.backgroundColor=color;
    layer.style.position='absolute';
    layer.style.top=0;
    layer.style.left=0;
    layer.style.zIndex=0;
    if(navegador==0) layer.style.filter='alpha(opacity='+opacity+')';
    else layer.style.opacity=opacity/100;
    
    document.body.appendChild(layer);
} 
			
function copiarDoc(){

		document.formulario.num_serie.value=document.frmCopiarDoc.serie.value;
		document.formulario.num_correlativo.value=document.frmCopiarDoc.numero.value;
		seleccionar_cbo('sucursal',document.frmCopiarDoc.sucursal.value);
		seleccionar_cbo('almacen',document.frmCopiarDoc.almacen.value);
		seleccionar_cbo('doc',document.frmCopiarDoc.doc.value);
		seleccionar_cbo('responsable',document.frmCopiarDoc.responsable.value);
		 		
        document.formulario.auxiliar.value=document.frmCopiarDoc.auxOrigen.value;
		document.formulario.auxiliar2.value=document.frmCopiarDoc.auxOrigen2.value;
		
		document.formulario.min_percep_doc.value=document.frmCopiarDoc.min_percep_doc.value;		
		document.formulario.percep_doc.value=document.frmCopiarDoc.percep_doc.value;
		
		document.formulario.percep_suc.value=document.frmCopiarDoc.percep_suc.value;
		document.formulario.temp_doc.value=document.frmCopiarDoc.temp_doc.value;
		
		document.formulario.femi.value=document.frmCopiarDoc.femi.value;
		document.formulario.fven.value=document.frmCopiarDoc.fven.value;
		
		document.formulario.numeroOT.readOnly="";
		document.formulario.serieOT.readOnly="";
		
		document.getElementById('estado').innerHTML="INGRESO";					
		//document,formulario.condicion.focus();
		document.formulario.codprod.disabled=false;
		document.formulario.notas.disabled=false;
		document.formulario.termino.disabled=false;
		
		elemento=document.getElementById('capa_fondo');
		elemento.parentNode.removeChild(elemento);
		document.getElementById('capaCopiarDoc').style.visibility='hidden';
		
		document.frmCopiarDoc.sucursal.style.visibility='hidden';
		document.frmCopiarDoc.almacen.style.visibility='hidden';
		document.frmCopiarDoc.doc.style.visibility='hidden';
		document.frmCopiarDoc.responsable.style.visibility='hidden';
		mostrarCbos();
		
		document.formulario.tempCopiar.value="S";
		cbo_cond();
										
}

function sumarFechaVen(control){
//alert();
	var texto=control.options[control.selectedIndex].text;
	
	var temp=texto.split(" ");
	//alert(temp[1]);
	var fechaEmi=document.formulario.femi.value;
	addToDate(fechaEmi, parseInt(temp[1]));
//	alert(fechaEmi+" "+parseInt(temp[1]));
//	alert(addToDate(fechaEmi, parseInt(temp[1])));
document.formulario.fven.value=addToDate(fechaEmi, parseInt(temp[1]));
}

//-------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------
var aFinMes = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31); 
function finMes(nMes, nAno){ 
return aFinMes[nMes - 1] + (((nMes == 2) && (nAno % 4) == 0)? 1: 0); 
} 
function padNmb(nStr, nLen, sChr){ 
var sRes = String(nStr); 
for (var i = 0; i < nLen - String(nStr).length; i++) 
sRes = sChr + sRes; 
return sRes; 
} 
function makeDateFormat(nDay, nMonth, nYear){ 
var sRes; 
sRes = padNmb(nDay, 2, "0") + "-" + padNmb(nMonth, 2, "0") + "-" + padNmb(nYear, 4, "0"); 
return sRes; 
} 
function incDate(sFec0){ 
var nDia = parseInt(sFec0.substr(0, 2), 10); 
var nMes = parseInt(sFec0.substr(3, 2), 10); 
var nAno = parseInt(sFec0.substr(6, 4), 10); 
nDia += 1; 
if (nDia > finMes(nMes, nAno)){ 
nDia = 1; 
nMes += 1; 
if (nMes == 13){ 
nMes = 1; 
nAno += 1; 
} 
} 
return makeDateFormat(nDia, nMes, nAno); 
} 
function decDate(sFec0){ 
var nDia = Number(sFec0.substr(0, 2)); 
var nMes = Number(sFec0.substr(3, 2)); 
var nAno = Number(sFec0.substr(6, 4)); 
nDia -= 1; 
if (nDia == 0){ 
nMes -= 1; 
if (nMes == 0){ 
nMes = 12; 
nAno -= 1; 
} 
nDia = finMes(nMes, nAno); 
} 
return makeDateFormat(nDia, nMes, nAno); 
} 
function addToDate(sFec0, sInc){ 
var nInc = Math.abs(parseInt(sInc)); 
var sRes = sFec0; 
if (parseInt(sInc) >= 0) 
for (var i = 0; i < nInc; i++) sRes = incDate(sRes); 
else 
for (var i = 0; i < nInc; i++) sRes = decDate(sRes); 
return sRes; 
} 

//if(compare_dates(objeto.value,document.formulario.femi.value)){
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
            if (xDay>= yDay)   
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

//--------------------------------------------------------------------------------------	


function selecionarItem(indice){

//if(document.getElementById('productos').style.visibility=='visible'){
		//for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
		//	if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb'){
			
		var temp=document.getElementById('tblproductos').rows[indice].cells[0].childNodes[0].childNodes[0].innerHTML;
		var temp1=document.getElementById('tblproductos').rows[indice].cells[1].childNodes[0].innerHTML;
		var temp3=document.getElementById('tblproductos').rows[indice].cells[3].innerHTML;
		var temp4=document.getElementById('tblproductos').rows[indice].cells[4].innerHTML;
		// alert(temp4);
		   var unidad=temp4.split("-");
		 document.formulario.series.value=unidad[4]; 
		  if(unidad[4]=='S'){		
			for (var h=0;h<document.getElementById('detalle_doc_gen').rows.length;h++) { 
			var temp1x=document.getElementById('detalle_doc_gen').rows[h].cells[0].childNodes[0].innerHTML;
				if(temp==temp1x){
				alert("Producto con serie ya registrado");
				return false;
				}
			}
		}  
		
	   document.formulario.uni_p.value=unidad[0];
	   document.formulario.factor_p.value=unidad[1];
	   document.formulario.precio_p.value=unidad[2];
	   document.formulario.prod_moneda.value=unidad[3];
	    
	   document.formulario.serie_ing.value="";
	   document.formulario.pruebas.value=unidad[5];
	   document.formulario.kardex_prod.value=unidad[11];
	   document.formulario.codAnexProd.value=unidad[15];
	  // document.formulario.precosto.value=unidad[6];
	   
	  
		
	   
	   var prod_moneda=unidad[3];
		if(document.formulario.tipomov.value==2){
				
			var precosto=unidad[6];
			/*
			if(prod_moneda=='01' && document.getElementById('moneda').innerHTML=='(US$.)'){
			precosto=parseFloat(precosto/tc_doc).toFixed(4);
			}else{
				if(prod_moneda=='02' && document.getElementById('moneda').innerHTML=='(S/.)'){
				precosto=parseFloat(precosto*tc_doc).toFixed(4);
				}
			
			}
			*/
			document.formulario.precosto.value=precosto;
						
	    }else{
			var precosto=unidad[6];
			if(precosto<0 || tempNivelUser==2){
			precosto=0.00;
			}
						
			if(document.getElementById('moneda').innerHTML=='(US$.)'){
			precosto=parseFloat(precosto/tc_doc).toFixed(4);
			}
			document.formulario.punit.value=precosto;
		
		}
		
		document.formulario.codBarraEnc.value=unidad[13];
	   var tempDes=temp1.split("|");
	   elegir(temp,tempDes[1].substring(8,tempDes[1].length));
	   //elegir(temp,temp1);

	   document.formulario.saldo.value=temp3;
	   
		//	}
	//	 }
	//   }


}
	
	
	
 function editCliente(){
	if(document.getElementById('auxiliares').style.visibility=='visible'){

		for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
			if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb'){
				var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
				//var temp2=document.getElementById('tblproductos1').rows[i].cells[1].childNodes[0].innerHTML;
				//var temp3=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[0].childNodes[0].childNodes[0].innerHTML;
				
			//alert(temp);
			buscarCliente(temp);
			
			}
		}
	}
		
 }
 
  function buscarCliente(codigo){
  document.getElementById('auxiliares').style.visibility='hidden';
  doAjax('peticion_datos.php','&codigo='+codigo+'&peticion=buscar_cliente','mostrarCliente','get','0','1','','');
  
  }
  
  function mostrarCliente(texto){

  var temp=texto.split('?');
  
  var codigo=temp[0];
  var razon=temp[1];
  var ruc=temp[2];
  var direccion=temp[3];
  var tipo=temp[4];
  var dni=temp[5];
  var email=temp[6];
  
  document.getElementById('new_aux').style.visibility='visible';
  
  document.formulario.aux_razon.value=razon;
  document.formulario.aux_dni.value=dni;
  document.formulario.aux_ruc.value=ruc;
  document.formulario.aux_direccion.value=direccion;
//  alert(tipo+" "+ document.formulario.persona[1].value);
	  if(tipo!='natural'){
	  document.formulario.persona[0].checked=true;
	  document.formulario.persona[1].checked=false;
	 
	  document.formulario.aux_ruc.disabled=false;
	  document.formulario.aux_dni.disabled=true;
	  }else{
	   document.formulario.persona[1].checked=true;
	  document.formulario.persona[0].checked=false;
	  document.formulario.aux_ruc.disabled=true;
	  document.formulario.aux_dni.disabled=false;
	  }
  
  document.formulario.accionAux.value='e';
  document.formulario.codClie.value=codigo;
  //codClie
  } 	

  function editTexto(objeto){
    objeto.readOnly=false;
	objeto.focus();
	objeto.select();
    objeto.style.border='solid 1px';
	objeto.style.background='#E8FECF';
  }
  
  function saveTexto(objeto,evento,pos){
	  
	  if(evento.keyCode==13){
	  
	  var valor=objeto.value;
	  		doAjax('peticion_datos.php','&pos='+pos+'&valor='+valor+'&peticion=saveTexto','','get','0','1','','');
		
	  
	   objeto.readOnly=true;
	   document.formulario.codprod.focus();
       objeto.style.border='none';
	   objeto.style.background='';
	  }
	  
  }
  
function generar_cerosOT(e,ceros,control){

	if(e.keyCode==13){
	
		control.value=ponerCeros(control.value,ceros);
		if(control.name=='serieOT'){
		document.formulario.numeroOT.focus();
		document.formulario.numeroOT.select();
		}
		
	}

}
  
function selec_cli(objeto){
	selecionarCli(objeto.parentNode.parentNode.parentNode.rowIndex);
}
	
function selecionarCli(indice){
	var temp=document.getElementById('tblproductos1').rows[indice].cells[0].childNodes[0].childNodes[0].innerHTML;
	var temp1=document.getElementById('tblproductos1').rows[indice].cells[1].childNodes[0].innerHTML;
		
	var doc=document.formulario.doc.value;
	var ruc=document.getElementById('tblproductos1').rows[indice].cells[2].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].innerHTML;
		
	var temp4=document.getElementById('tblproductos1').rows[indice].cells[4].innerHTML.split("-");
	//alert(temp4);
	document.formulario.est_percep_clie.value=temp4[8];
	document.formulario.por_percep_clie.value=temp4[9];
	document.formulario.dirDestino.value=temp4[10];
		

	if( (doc=='FA' || doc=='F1') && ruc==""  ){
		 alert(" Cliente no tiene Ruc ");
		 return false;
	}else{
		temp1=temp1.replace('&amp;','&');
		//alert(temp1);
		elegir2(temp,temp1);
	}
	/*document.formulario.auxiliar2.value=temp;
	document.formulario.auxiliar.value=temp1;
	document.getElementById('auxiliares').style.visibility='hidden';
	mostrar_cbos();
	document.formulario.auxiliar.focus();
	document.formulario.auxiliar.select();*/
	//document.formulario.codprod.select();
}  
			
</script><!--MMDW 101 -->
</html>
<!-- MMDW:success -->