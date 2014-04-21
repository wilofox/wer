<?php session_start();
   include('../conex_inicial.php');
?>

<script language="JavaScript"> 
var tc_doc="<?php echo $tcambio; ?>";
var temp="<?php echo $_REQUEST['caducado']?>";
var tempNivelUser="<?php echo $_SESSION['nivel_usu'] ?>";

function find_prm(prm,codigo){
//alert(999);
	/*if(document.getElementById("capaCopiarDoc").style.visibility=="visible"){
		var doc=document.frmCopiarDoc.doc.value;
	}else{
		var doc=document.formulario.doc.value;
		if(doc==0)doc="PV";
	}
		for (var i=0;i<prm.length;i++){
			if(codigo[i]==doc){
			return prm[i];
			}
		} */
		
}

</script>

 <script language="JavaScript">
			
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
			
			
			</script>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Generador de Modelo</title>
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
<script type="text/javascript" src="../javascript/mover_div.js"></script>
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>
<SCRIPT src="../javascript/popup.js" type=text/javascript></SCRIPT>
<script language="javascript" src="../miAJAXlib.js"></script>
<script src="../jquery-1.2.6.js"></script>
<script src="../jquery.hotkeys.js"></script>
<script type="text/javascript" src="../modalbox/lib/prototype.js"></script>
<script type="text/javascript" src="../modalbox/lib/scriptaculous.js?load=effects"></script>
<script type="text/javascript" src="../modalbox/modalbox.js"></script>
<link rel="stylesheet" href="../modalbox/modalbox.css" type="text/css" />

<script>
var scrollDivs=new Array();
scrollDivs[0]="choferes";
scrollDivs[1]="capaCopiarDoc";

var temporal_teclas="";
var temp_mon="01";
var array_percepsuc=new Array();
var array_idsuc=new Array();

function ocultarCbos(){	
alert(2);
	document.formulario.sucursal.style.visibility="hidden";
	document.formulario.almacen.style.visibility="hidden";
	document.formulario.doc.style.visibility="hidden";
	document.formulario.responsable.style.visibility="hidden";
	document.formulario.condicion.style.visibility="hidden";
	document.formulario.presentacion.style.visibility="hidden";
		
}

function mostrarCbos(){
alert(3);
	for(var i=0;i<document.formulario.elements.length;i++){
	 	if(document.formulario.elements[i].type=="select-one"){
		 document.formulario.elements[i].style.visibility="visible";
		}
	}

}

jQuery(document).bind('keydown', 'f2',function (evt){jQuery('#_up').addClass('dirty');
	
	/*if (document.formulario.alias.value==''){
		alert('Falta Nombre de Alias');
		 document.formulario.codanexo.focus();	
		return false;
	}*/
	if (document.formulario.auxiliar.value=='' || document.formulario.auxiliar2.value=='' ){
		 alert('Falta asignar Modelo');
		// document.formulario.alias.focus();		
		 	document.formulario.auxiliar.focus();	  
		  return false;	
	}	
	if (document.formulario.factor.value==0 || document.formulario.factor.value==''){
		alert('La cantidad a generar debe ser mayor a Cero');
		document.formulario.auxiliar.focus();		
		return false;
	}

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
//alert(7);	
			var total_doc=document.formulario.total_doc.value;
			if(total_doc!=0 ){
			var auxiliar=document.formulario.auxiliar2.value;		
			var auxiliar2=document.formulario.auxiliar.value;
			var fac_modelo=document.formulario.fac_modelo.value;
			var factor=document.formulario.factor.value;
			var alias=document.formulario.alias.value;	
			var incluidoigv=document.formulario.incluidoigv.value;			
			var tmoneda=document.formulario.tmoneda.value;
			var tcambio=document.formulario.tcambio.value;
			var temp_doc=document.formulario.temp_doc.value;
			var responsable=document.formulario.responsable.value;
			var tipomov=document.formulario.tipomov.value;
			var tienda=document.formulario.almacen.value;
			var femision=document.formulario.femi.value;
			var fvencimiento=document.formulario.fven.value;			
			var monto=document.formulario.monto.value;
			var obs1=document.formulario.obs1.value;
			var obs2=document.formulario.obs1.value;
			var obs3=document.formulario.obs1.value;
			var obs4=document.formulario.obs1.value;
			var obs5=document.formulario.obs1.value;
			
			var codanexo=document.formulario.codanexo.value;
			var pvp1=document.formulario.pvp1.value;
			var pvp2=document.formulario.pvp2.value;
			var pvp3=document.formulario.pvp3.value;
			var pvp4=document.formulario.pvp4.value;
			var pvp5=document.formulario.pvp5.value;
			
			var modo_imp=document.formulario.modo_imp.value;
			
			
			document.formulario.accion.value="grabar";			

			if(document.getElementById('estado').innerHTML=="CONSULTA" || document.getElementById('estado').innerHTML=="ANULADO"){
			  alert('Este documento solo es de consulta');
			}else{
			 doAjax('../modelo_trasformacion/peticion_datos.php','&peticion=save_doc&temp_doc='+temp_doc+'&responsable='+responsable+'&femision='+femision+'&fvencimiento='+fvencimiento+'&monto='+monto+'&total_doc='+total_doc+'&incluidoigv='+incluidoigv+'&auxiliar='+auxiliar+'&auxiliar2='+auxiliar2+'&fac_modelo='+fac_modelo+'&factor='+factor+'&alias='+alias+'&tmoneda='+tmoneda+'&tcambio='+tcambio+'&obs1='+obs1+'&obs2='+obs2+'&obs3='+obs3+'&obs4='+obs4+'&obs5='+obs5+'&codanexo='+codanexo+'&pvp1='+pvp1+'&pvp2='+pvp2+'&pvp3='+pvp3+'&pvp4='+pvp4+'&pvp5='+pvp5+'&modo_imp='+modo_imp,'mostrar_grabacion','get','0','1','','');  
		
		    }						
	}else{
	alert('No se puede guardar el documento sin  detalle');						
	}
	
}

function CountSubUnidad(texto){
//alert(8);
	document.formulario.cantSubUnidad.value=texto;
}
function mostrar_grabacion(texto){
	window.location.reload()
	//close();
return false;
alert(9);
		if(texto=='numero'){
			var serie=document.formulario.num_serie.value;
			var sucursal=document.formulario.sucursal.value;
			var V2=document.formulario.almacen.value;
			var doc=document.formulario.doc.value;
			var tipomov=document.formulario.tipomov.value;
			var temp_numero_ini=1;//find_prm(10,'PV');
			var temp_numero_fin=9999999;//find_prm(9999999,'PV');

//alert(sucursal);
			doAjax('peticion_datos.php','&serie='+document.formulario.num_serie.value+'&doc='+doc+'&sucursal='+sucursal+'&ptovta34&peticion=generar_numero&numero_ini='+temp_numero_ini+'&numero_fin='+temp_numero_fin+'&tipomov='+tipomov,'rpta_gen_numero2','get','0','1','','');
			return false;
		}
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
	if(document.getElementById('productos').style.visibility=='visible'){
	
	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
		if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb' && (i!=0) ){
		document.getElementById('tblproductos').rows[i].style.background=document.getElementById('tblproductos').rows[i].bgColor;
		document.getElementById('tblproductos').rows[i-1].style.background='#FFF1BB';
			tempColor=document.getElementById('tblproductos').rows[i-1];
			
			location.href="#ancla"+(i-1);
				if (campoX=='auxiliar'){
					document.formulario.auxiliar.focus();
				}else{
					document.formulario.codprod.focus();
				}
			
			if(i%3==0 && i!=0){
			}
			break;
		}
	  }
   }
   
   if(document.getElementById('auxiliares').style.visibility=='visible'){
	
	for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
		if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' && (i!=0) ){
		document.getElementById('tblproductos1').rows[i].style.background=document.getElementById('tblproductos1').rows[i].bgColor;
		document.getElementById('tblproductos1').rows[i-1].style.background='#FFF1BB';
		
			tempColor=document.getElementById('tblproductos1').rows[i-1];
			location.href="#ancla"+(i-1);
			document.formulario.auxiliar.focus();
			
			if(i%4==0 && i!=0){
			}
			break;
		}
	  }
   }
         
 return false; });

   jQuery('#platform-details').html('<code>' + navigator.userAgent + '</code>');

function domo(){
//alert(200);
 jQuery(document).bind('keydown', 'f6',function (evt){jQuery('#_f6').addClass('dirty');
  	
	if(isset(document.getElementById('lista_aux'))){
	nuevo_auxiliar("e");
	}else{

	}
  return false; });


jQuery(document).bind('keyup', 'down',function (evt){jQuery('#_down').addClass('dirty');
 if(document.getElementById('productos').style.visibility=='visible'){
	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
			if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb' && (i!=document.getElementById('tblproductos').rows.length-1)){
			document.getElementById('tblproductos').rows[i].style.background=document.getElementById('tblproductos').rows[i].bgColor;
			document.getElementById('tblproductos').rows[i+1].style.background='#FFF1BB';
			
			tempColor=document.getElementById('tblproductos').rows[i+1];
			
			if(i%4==0 && i!=0){
			location.href="#ancla"+i;
					if (campoX=='auxiliar'){
						document.formulario.auxiliar.focus();
					}else{
						document.formulario.codprod.focus();
					}			
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
		

	if(document.activeElement.name=='factor' ){	
		document.formulario.codprod.focus();
	}else if(document.activeElement.name=='alias' ){	
		document.formulario.auxiliar.focus();
	}else if(document.activeElement.name=='auxiliar' ){	
		document.formulario.factor.focus();
	}else if(document.activeElement.name=='fven' ){	
		document.formulario.codprod.focus();
	}else if(document.activeElement.name=='codanexo' ){	
		document.formulario.auxiliar.focus();
		//document.formulario.alias.focus();
	}


			var nombreVariable=document.getElementById('MB_frame');
			try {
				 if (typeof(eval(nombreVariable)) != 'undefined' ){
					 if (eval(nombreVariable) != null){
					return false();
					}
				}
			 } catch(e) { }

			if(isset(nombreVariable)){
			return false;
			}	
	
	if(document.getElementById('productos').style.visibility=='visible'){
		for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
			if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb'){
						
	var temp=document.getElementById('tblproductos').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
	var temp1=document.getElementById('tblproductos').rows[i].cells[1].childNodes[0].innerHTML;
	var temp3=document.getElementById('tblproductos').rows[i].cells[3].innerHTML;
	var temp4=document.getElementById('tblproductos').rows[i].cells[4].innerHTML;
	var unidad=temp4.split("-");
	
	   document.formulario.uni_p.value=unidad[0];
	   document.formulario.factor_p.value=unidad[1];
	   document.formulario.precio_p.value=unidad[2];
	   document.formulario.prod_moneda.value=unidad[3];
	   document.formulario.series.value=unidad[4];
	   document.formulario.serie_ing.value="";
	   document.formulario.pruebas.value=unidad[5];
	   document.formulario.kardex_prod.value=unidad[11];
	   document.formulario.codAnexProd.value=unidad[15];
	   document.formulario.esmodelo.value=unidad[20];
	   
	   if(unidad[20]>0){
	   
	   alert("Este item ya se encuentra definido como un modelo.");
	   
	   document.formulario.auxiliar.value='';
	   document.formulario.auxiliar2.value='';
	   document.formulario.auxiliar.focus();
	   return false;
	   
	   }
	   
	  // document.formulario.precosto.value=unidad[6];
	   //alert(unidad[15]);
	   
	   var prod_moneda=unidad[3];
		if(document.formulario.tipomov.value==2){
			var precosto=unidad[6];			
			if(prod_moneda=='01' && document.getElementById('moneda').innerHTML=='(US$.)'){
			precosto=parseFloat(precosto/tc_doc).toFixed(4);
			}else{
				if(prod_moneda=='02' && document.getElementById('moneda').innerHTML=='(S/.)'){
				precosto=parseFloat(precosto*tc_doc).toFixed(4);
				}
			
			}
			document.formulario.precosto.value=precosto;
			precosto=unidad[2];			
			if(prod_moneda=='01' && document.getElementById('moneda').innerHTML=='(US$.)'){
			precosto=parseFloat(precosto/tc_doc).toFixed(4);
			}else{
				if(prod_moneda=='02' && document.getElementById('moneda').innerHTML=='(S/.)'){
				precosto=parseFloat(precosto*tc_doc).toFixed(4);
				}
			
			}
			document.formulario.punit.value=parseFloat(precosto).toFixed(4);			
	    }else{
		alert('A2')
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
		if (campoX=='auxiliar'){
		
			var tempDes=temp1.split("|");
	  	 	elegir3(temp,tempDes[1].substring(8,tempDes[1].length));	
		//alert()		  
		}else{
			var tempDes=temp1.split("|");
	   		elegir(temp,tempDes[1].substring(8,tempDes[1].length));
		}   
	   document.formulario.saldo.value=temp3;

	   
			}
		 }
	   }

//-------------------------------------------------------------------------------
	   
	   if(document.getElementById('auxiliares').style.visibility=='visible'){

		for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
			if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb'){
			
		var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
		var temp1=document.getElementById('tblproductos1').rows[i].cells[1].childNodes[0].innerHTML;
		var doc='';//document.formulario.doc.value;
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
	   
//-------------------------------------------------------------------------------

	   if(document.formulario.cantidad.value!="" && document.formulario.codprod.value!="" && document.formulario.punit.value!="" && document.formulario.cantidad.value!=0  ){
		
		//-------------------control de items-------------------------------------------
				/* for(var i=0;i<tab_nitems.length;i++){
					 if(tab_cod[i]==document.formulario.doc.value){
							var items_max=tab_nitems[i];		 
					 }
				 
				 }*/
		 		
				var mer=parseInt(document.getElementById('nitems').innerHTML)+1;
				items_max=50;
					if(mer>items_max){
					alert('No es permitido más items en el documento...');
					return false;
					}

		//--------------------------------------------------------------------------------
			
			
					var prms_doc_stock=find_prm(tab1,tab_cod);	
					var cant=document.formulario.cantidad.value;
					var saldo=document.formulario.saldo.value;
					var kardex_prod=document.formulario.kardex_prod.value;
					saldo=999;					
				 if(document.formulario.tipomov.value==2){
					if (document.formulario.cantSubUnidad.value>0){
						saldo=document.formulario.cantSubUnidad.value;
					}				
											
			if( parseFloat(saldo) >= parseFloat(cant) || prms_doc_stock=='N' || kardex_prod=='N' ){
						
							var permiso10=find_prm(tab10,tab_cod);
					
					if(document.formulario.series.value=='S' && document.formulario.serie_ing.value=="" && permiso10=='S' ){							
									if (prms_doc_stock=='S'){
									var cant=document.formulario.cantidad.value;
									var randomnumber=Math.floor(Math.random()*99999);
									var producto=document.formulario.codprod.value;
									var fecha=document.formulario.femi.value;
									var tienda=document.formulario.almacen.value;
									var cod_cab_ref=document.formulario.cod_cab_ref.value;
										
										Modalbox.show('sal_series.php?cant='+cant+'&ran='+randomnumber+'&producto='+producto+'&fecha='+fecha+'&tienda='+tienda+'&cod_cab_ref='+cod_cab_ref, {title: 'Serie de productos ( SALIDAS )', width: 500}); 	return false;
										//alert();
										}
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
						if(permiso16=='N'){
							if(document.formulario.punit.value==0 || document.formulario.punit.value=='' ){
							document.formulario.punit.focus();
							document.formulario.punit.select();
							return false;
							}
						}
						doAjax('buscar_item.php','','buscar_item2','get','0','1','','');						
					}	
			/*if (document.formulario.codprod.valuee!=""){
				enviar();		
			}*/
		}else{
		//alert(document.formulario.termino.value+'//'+document.formulario.codprod.value);
			if(document.formulario.termino.value!="" && document.formulario.codprod.value==""){
			alert('1A');
			return false;
			enviar();
			}else{				
				nombreVariable=document.getElementById('MB_frame');
				
					if(document.formulario.cantidad.value!="" && document.formulario.termino.value!="" && document.formulario.codprod.value!="" && (document.formulario.punit.value=="" || document.formulario.punit.value==0) && !isset(nombreVariable) ){
					alert('1B');
					document.formulario.punit.focus();
					document.formulario.punit.select();
					}
				
			}	
						
		}	

		
return false; });


jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_esc').addClass('dirty'); 
salir();
return false; });

	 
jQuery(document).bind('keydown', 'f9',function (evt){jQuery('#_f9').addClass('dirty');
event.returnValue=false;
event.keyCode=0;
 return false; }); 
 
jQuery(document).bind('keydown', 'f10',function (evt){jQuery('#_f10').addClass('dirty');
return false; }); 
 
jQuery(document).bind('keydown', 'f5',function (evt){jQuery('#_f6').addClass('dirty');
return false; }); 
  
jQuery(document).bind('keydown', 'f3',function (evt){jQuery('#_f3').addClass('dirty');
 event.returnValue=false;
event.keyCode=0;
 return false; }); 
  
 jQuery(document).bind('keydown', 'Alt+r',function (evt){jQuery('#_Alt_r').addClass('dirty');
	event.returnValue=false;
 return false; });
}

function cambiar_impuesto(){
alert(11);	
	var permiso4=find_prm(tab4,tab_cod);
	 if(permiso4=='N'){
	
		   if(document.formulario.incluidoigv.value=="S"){
			document.formulario.incluidoigv.value="N";
						
			}else{
			document.formulario.incluidoigv.value="S";
		
			}
		mostrar_detalle();	
	}	
	

}


jQuery(document).ready(domo);

function salir(){
		//alert(12);
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
			}
		
		return false;
		}
		
		
		if(document.getElementById('capaCopiarDoc').style.visibility=='visible'){
		
		elemento=document.getElementById('capa_fondo');
		elemento.parentNode.removeChild(elemento);
		
		vaciar_sesiones2();
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
					//var doc=document.formulario.doc.value;
					var tipomov=document.formulario.tipomov.value;
					var auxiliar=document.formulario.auxiliar2.value;
					
					//alert();
					if(document.formulario.num_correlativo.disabled && (document.getElementById('estado').innerHTML=="INGRESO" ||  document.getElementById('estado').innerHTML=="")){
					
				
				doAjax('peticion_datos.php','&sucursal='+sucursal+'&tienda='+tienda+'&numero='+numero+'&serie='+serie+'&doc='+doc+'&tipomov='+tipomov+'&auxiliar='+auxiliar+'&peticion=liberar_numero','liberar_numero','get','0','1','','');
														
					}else{
					close();
					//document.formulario.submit();
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


var user_tienda="<?php echo $_SESSION['user_tienda'] ?>";
var user_sucursal="<?php echo $_SESSION['user_sucursal'] ?>";
function iniciar(){
alert(14);	
	if(temp_mon=='02'){
			document.getElementById('moneda').innerHTML='(S/.)';	
	}else{
			document.getElementById('moneda').innerHTML='(US$.)';
	}

var tse=1;
if(tse!=""){
document.formulario.num_serie.value=1;
//alert(document.formulario.num_serie.value);
var serie=document.formulario.num_serie.value;
var sucursal=document.formulario.sucursal.value;
var V2=document.formulario.almacen.value;
var doc=document.formulario.doc.value;
var tipomov=document.formulario.tipomov.value;
var temp_numero_ini=1;//find_prm(10,'PV');
var temp_numero_fin=9999999;//find_prm(9999999,'PV');

//alert(sucursal);
doAjax('peticion_datos.php','&serie='+document.formulario.num_serie.value+'&doc='+doc+'&sucursal='+sucursal+'&ptovta34&peticion=generar_numero&numero_ini='+temp_numero_ini+'&numero_fin='+temp_numero_fin+'&tipomov='+tipomov,'rpta_gen_numero','get','0','1','','');
document.formulario.auxiliar.focus();
	
	
return false		
alert(119);
document.formulario.sucursal.focus();
document.formulario.almacen.disabled=true;
document.formulario.doc.disabled=true;
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
	selecComboSuc();
}else{
	if(tempNivelUser==1){
	window.parent.location.href('../index.php');
	}else{
	window.parent.location.href('../principal.php');	
	}
}
}

function mostrar(texto) {
//alert(16);
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
 calculoPV(1);		
}
function calculoPV_det(vt,v1,v2,v3,val) {
		
	 if (v2.value=='' || eval(v2.value)<eval(vt) ){ 
		if (val!=1){		
			  //alert('El precio de venta debe ser mayor total costo');
			  v1.value=0; 
			  v3.value='0.00';
			 return false;
		}
	 }
 	// recalculo
	 if (v1.value=='' || v2.value=='' ){
		if (val!=2){
			v2.value=vt;
		}
		v3.value='0.00';
	 }else{
			 if (val==2){	 	
				v3.value=(eval(v2.value)-eval(vt)).toFixed(2);
				v1.value=((eval(v3.value)/eval(vt))*100).toFixed(0);
			 }else{
				v2.value=vt*((parseFloat(v1.value)+100)/100);
				v3.value=(vt*(parseFloat(v1.value)/100)).toFixed(2);
				v2.value=(parseFloat(v2.value)).toFixed(2);
			 } 	
	 }
	 //return '|'+v1+'|'+v2+'|'+v3;
}
function calculoPV(val) {

if (document.getElementById('nitems').innerHTML!=0){	
	calculoPV_det(document.formulario.total_doc.value,document.formulario.pv1,document.formulario.pvp1,document.formulario.pvu1,val);
	calculoPV_det(document.formulario.total_doc.value,document.formulario.pv2,document.formulario.pvp2,document.formulario.pvu2,val);
	calculoPV_det(document.formulario.total_doc.value,document.formulario.pv3,document.formulario.pvp3,document.formulario.pvu3,val);
	calculoPV_det(document.formulario.total_doc.value,document.formulario.pv4,document.formulario.pvp4,document.formulario.pvu4,val);
	calculoPV_det(document.formulario.total_doc.value,document.formulario.pv5,document.formulario.pvp5,document.formulario.pvu5,val);
}

return false;
/* 	 if (document.formulario.pvp1.value=='' || eval(document.formulario.pvp1.value)<eval(document.formulario.total_doc.value) ){ 
		if (val!=1){		
		  //alert('El precio de venta debe ser mayor total costo');
		  document.formulario.pv1.value=0; 
		  document.formulario.pvu1.value='0.00';
		 return false;
		}
	 }
 
 if (document.formulario.pv1.value=='' || document.formulario.pvp1.value=='' ){
 	if (val!=2){
		document.formulario.pvp1.value=document.formulario.total_doc.value;
	}
	document.formulario.pvu1.value='0.00';
 }else{
	 if (val==2){	 	
	 	document.formulario.pvu1.value=(eval(document.formulario.pvp1.value)-eval(document.formulario.total_doc.value)).toFixed(2);
		document.formulario.pv1.value=((eval(document.formulario.pvu1.value)/eval(document.formulario.total_doc.value))*100).toFixed(2);
	 }else{
	 	document.formulario.pvp1.value=document.formulario.total_doc.value*((parseFloat(document.formulario.pv1.value)+100)/100);
 		document.formulario.pvu1.value=(document.formulario.total_doc.value*(parseFloat(document.formulario.pv1.value)/100)).toFixed(2);
 		document.formulario.pvp1.value=(parseFloat(document.formulario.pvp1.value)).toFixed(2);
	 }
 	
 }*/
 

}
function borrar() { 
//alert(17);
		var n=document.formulario.presentacion.options.length;
   		for (var i=0;i<n;i++)  {
		//alert(i);
        	aBorrar = document.forms["formulario"]["presentacion"].options[0];
			aBorrar.parentNode.removeChild(aBorrar);
			
		}
} 


function listaprod(texto){
//alert(19);
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
	var temp=document.formulario.tempauxprod.value;
	var tipomov=document.formulario.tipomov.value;
	var tienda=document.formulario.almacen.value;
	var moneda_doc=document.formulario.tmoneda.value;
	
	if (campoX=='auxiliar'){
		valor='pro';
	}
//alert(valor+'//'+ temp+'//'+ tipomov+'//'+ tienda+'//'+temp_criterio +'//'+ document.formulario.prov_asoc.value+'//'+moneda_doc);

	doAjax('det_aux.php','&ptovta34&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc='+document.formulario.prov_asoc.value+'&moneda_doc='+moneda_doc+'&esmodel','detalle_prod','get','0','1','','');
				
}		
		
function detalle_prod(texto){
//alert(20);
	var r = texto;
	/*if(document.formulario.tempauxprod.value=='auxiliares'){
	document.getElementById('detalle1').innerHTML=r;
	document.getElementById('tblproductos1').rows[0].style.background='#fff1bb';
	}*/
	//if(document.formulario.tempauxprod.value=='productos'){
	document.getElementById('detalle').innerHTML=r;
	document.getElementById('tblproductos').rows[0].style.background='#fff1bb';
	//}	
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
.Estilo114 {color: #333333}
.Estilo115 {font-family: Arial, Helvetica, sans-serif}
-->
</style>


<script>
	    function ponerCeros(obj,i) {
		alert(33);
		  while (obj.length<i){
			obj = '0'+obj;
			}
		//	alert(obj);
			return obj;
		}
		
		function generar_ceros(e,ceros,control){
		return false;
		alert(34);
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
				   
				   doAjax('peticion_datos.php','&serie='+document.formulario.num_serie.value+'&doc='+doc+'&sucursal='+sucursal+'&ptovta34&peticion=generar_numero&tipomov='+tipomov,'rpta_gen_numero','get','0','1','',''); 
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
					}					
					
					if(control.name=='fven'){					
					validar_fecha_doc(control);
					}
				     			
				}
		
		}
		
	
</script>
<body  onload="cambiar_moneda_ini();" onUnload="vaciar_sesiones2()" >
<form id="formulario" name="formulario" method="post" action="">
  <table width="789" border="0" cellpadding="0" cellspacing="0">
      
      <tr style="background:url(../imagenes/white-top-bottom.gif)">
       <td height="27" colspan="13" style="border:#999999">&nbsp;<span class="Estilo34"> Generador de Modelo  :: <span class="Estilo14 Estilo38"><?php echo $titulo?>
            <input name="tempauxprod"  type="hidden" value=""  size="5" />
            <input name="tipomov"  type="hidden" value="2" size="5" /><?php //echo $_REQUEST['tipomov']?>
            <input name="temp_doc" type="hidden" size="5">
            <input name="accion" type="hidden" size="5" maxlength="10">
            <input name="incluidoigv" type="hidden" size="5" maxlength="10" value="S">
            <input name="tmoneda" type="hidden" size="5" maxlength="10" value="01">
            <input name="carga" type="hidden" size="5" maxlength="10" value="F">
            <input name="obs1" type="hidden" size="8" maxlength="150">
            <input name="obs2" type="hidden" size="8" maxlength="150">
            <input name="obs3" type="hidden" size="8" maxlength="150">
            <input name="obs4" type="hidden" size="8" maxlength="150">
            <input name="obs5" type="hidden" size="8" maxlength="150">
            <input name="prov_asoc" type="hidden" size="8" maxlength="150">
            
            <input type="hidden" name="temp_imp" id="temp_imp" value="" size="5">
            <input name="cod_cab_ref" type="hidden" id="cod_cab_ref" value="" size="5" maxlength="7">
            <input name="cod_cab_ref2" type="hidden" id="cod_cab_ref2" value="" size="5" maxlength="7">
			<input type="hidden" name="uni_p" id="uni_p" value="" size="5">
			<input name="factor_p" type="hidden" id="factor_p" value="" size="5">
            <input type="hidden" name="precio_p" id="precio_p" value="" size="5">
			<input type="hidden" name="prod_moneda" id="prod_moneda" value="" size="5">
			<input name="series" type="hidden" id="series" value="" size="3" maxlength="3">
			<input name="pruebas" type="hidden" value='' size="5">
			<input name="serie_ing" type="hidden" id="serie_ing" value="" size="3" maxlength="3">
             <input name="doc" type="hidden" id="doc" value="" size="3" maxlength="3">
			
			<script>
		
		  function isset(variable_name) {
		  //alert(38);
			try {
				 if (typeof(eval(variable_name)) != 'undefined')
				 if (eval(variable_name) != null)
				 return true;
			 } catch(e) { }
			return false;
		   }

			</script>
            
            <input name="precosto" type="hidden" id="precosto" value="" size="5" maxlength="3">
            <input name="impto" id="impto" type="hidden" size="6" maxlength="6" value="">
            <input name="percep_suc" id="percep_suc" type="hidden" size="6" maxlength="6" value="">
            <input name="percep_doc" id="percep_doc" type="hidden" size="6" maxlength="6" value="">
            <input name="min_percep_doc" id="min_percep_doc" type="hidden" size="6" maxlength="6" value="">
            <input name="est_percep_clie" id="est_percep_clie" type="hidden" size="6" maxlength="6" value="">
            <input name="por_percep_clie" id="por_percep_clie" type="hidden" size="6" maxlength="6" value="">
            <input name="tempCopiar" id="tempCopiar" type="hidden" size="6" maxlength="6" value="">
            <input name="kardex_prod" id="kardex_prod" type="hidden" size="6" maxlength="6" value="">
			<input name="cantSubUnidad" id="cantSubUnidad" type="hidden" value="">
            <input name="codBarraEnc" id="codBarraEnc" type="hidden" value="">
            <input name="codAnexProd" id="codAnexProd" type="hidden" value="">
			<input name="tipodoc" id="tipodoc" type="hidden" value="2">
			
			<input name="usetrans" id="usetrans" type="hidden" value="<?=$usetrans;?>">
			<input name="num_serie" type="hidden" size="5" maxlength="3" >
			
            <input  name="num_correlativo" type="hidden" size="10" maxlength="7">
		  <input name="sucursal" type="hidden" size="3" value="<?php echo $_SESSION['user_sucursal'] ?>" /> 
		  <input name="almacen" type="hidden" size="3"  value="<?php echo $_SESSION['user_tienda'] ?>"/>
		   <input name="esmodelo" type="hidden" size="3"  value=""/>
           <input name="femi" type="hidden" size="10"  id="femi" maxlength="10" onChange="enfocar_fecha(this)" value="<?php echo date('d-m-Y')?>" >
           <button type="reset" id="f_trigger_b2"  style="height:18; visibility:hidden" >...</button>
           <script type="text/javascript">
    Calendar.setup({
        inputField     :    "femi",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b2",   
        singleClick    :    true,           
        step           :    1                
    });
            </script>
           <a href="#" onClick="vaciar_sesiones2();">
           <input name="textarea" type="hidden" value="" size="20">
           </a></span></span></td>
    </tr>
	
    <tr style="background:url(../imagenes/botones.gif)" >
      <td width="5" height="28">&nbsp;</td>
      <td width="5">&nbsp;</td>
      <td colspan="7"><table width="98%" height="21" border="0" cellpadding="0" cellspacing="0" style="border-bottom:#CCCCCC solid 1px">
        <tr>
		
          <td width="86" >
		  
		  <script>
		  function entrar_btn(obj){
		  //alert(39);
		  obj.cells[0].style.backgroundImage="url(../imagenes/bordes_boton1.gif)";
		  obj.cells[1].style.backgroundImage="url(../imagenes/bordes_boton2.gif)";
		  obj.cells[2].style.backgroundImage="url(../imagenes/bordes_boton2.gif)";
		  obj.cells[3].style.backgroundImage="url(../imagenes/bordes_boton3.gif)";
		  
		  }
		  function salir_btn(obj){
		  //alert(40);
		  obj.cells[0].style.backgroundImage="";
		  obj.cells[1].style.backgroundImage="";
		  obj.cells[2].style.backgroundImage="";
		  obj.cells[3].style.backgroundImage="";
		  
		  }
		  
		  
		  
		    </script>
             <table  title="Salir [Esc]"width="72" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="salir()">
                <td width="3" ></td>
                <td width="20" ><img src="../imagenes/salir.JPG"  width="16" height="16" border="0"></td>
                <td width="46" ><span class="Estilo112">Salir<span class="Estilo113">[Esc]</span></span></td>
                <td width="3" ></td>
              </tr>
          </table> 			</td>
          <td width="80" >
		  <table title="Grabar [F2]" width="80" height="21" border="0" cellpadding="0" cellspacing="0">
                <tr onClick="javascript:grabar_doc()" onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer;">
                  <td width="3" ></td>
                  <td width="20" ><span class="Estilo112"><img src="../imgenes/revert.png" width="14" height="16"></span></td>
                  <td width="54" ><span class="Estilo112">Grabar<span class="Estilo113">[F2]</span></span></td>
                  <td width="3" style="border:#666666 solid 1px" ></td>
                </tr>
            </table>  		    </td>
          <td width="141"><table title="Nuevo Item" width="114" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onClick="javascript:nuevoItem()" onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer;">
              <td width="4" ></td>
              <td width="18" ><span class="Estilo112"><img src="../imagenes/nuevo.gif" width="14" height="16"></span></td>
              <td width="86" ><span class="Estilo112">Nuevo Item</span></td>
              <td width="6" style="border:#666666 solid 1px" ></td>
            </tr>
          </table></td>
          <td width="80">
		  <table style="display:none" title="Incl./no Incl.[F9]" width="70" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="cambiar_impuesto()">
              <td width="3" ></td>
              <td width="24" ><span class="Estilo112"><img src="../imagenes/igv.gif" width="20" height="16"></span></td>
              <td width="45" ><span class="Estilo112">&nbsp;Imp<span class="Estilo113">[F9]</span> </span></td>
              <td width="3" ></td>
            </tr>
          </table>  		    
		  <table title="Cambiar Moneda [F8]" width="80" height="21" border="0" cellpadding="0" cellspacing="0" style="visibility:hidden">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="func_f8()">
              <td width="3" ></td>
              <td width="16" ><span class="Estilo112"><img src="../imagenes/dolar.gif" width="15" height="15"></span></td>
              <td width="58" ><span class="Estilo112">Moneda<span class="Estilo113">[F8]</span> </span></td>
              <td width="3" ></td>
            </tr>
          </table></td>
          <td width="83"><table title="Nuevo[F3]" width="83" height="21" border="0" cellpadding="0" cellspacing="0" style="visibility:hidden">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="ant_imprimir()">
              <td width="3" ></td>
              <td width="20" align="center" ><img src="../imgenes/fileprint.png" width="16" height="16"></td>
              <td width="59" ><span class="Estilo112">Imprimir<span class="Estilo113">[F7]</span> </span></td>
              <td width="1" ></td>
            </tr>
          </table></td>
          <td width="28">&nbsp;</td>
          <td width="277"><input name="codanexo" type="hidden" id="codanexo" size="6" maxlength="6" onKeyPress="numero()">
            <input name="alias" type="hidden" id="alias"  style="height:20; border-color:#CCCCCC"  size="20" maxlength="100" autocomplete="off" >
            <span class="Estilo15">
            <select name="responsable"  disabled id="responsable" style="width:140;visibility:hidden"  onFocus="enfocar_cbo(this);limpiar_enfoque(this);cbo_cond();"  onChange="">
              <?php 
			$marcar="";
		    $resultados11 = mysql_query("select * from usuarios order by usuario ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			$marcar="";
			if($row11['codigo']==$_SESSION['codvendedor']){
			$marcar=" selected='selected' ";
			}
			
		  ?>
              <option <?php echo $marcar?> value="<?php echo $row11['codigo']?>"><?php echo $row11['usuario'];?></option>
              <?php }?>
            </select>
            <input name="responsable2" type="hidden" size="3"  value="0"/>
            <input name="fven" type="hidden" id="fven" onChange="enfocar_fecha(this)"  onKeyUp="generar_ceros(event,'0',this)"   size="10" maxlength="10" disabled>
            <button type="reset" id="f_trigger_b1" style="height:18; vertical-align:top; visibility:hidden" disabled >...</button>
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
            <input name="ckbFecha" type="checkbox" id="ckbFecha" style="border-color:#CCCCCC; visibility:hidden"  onClick="FechaBaja()" value="checkbox" >
            </span></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td></td>
      <td height="10"></td>
      <td colspan="7" align="left"><div style="display:none" id="factura"><span class="Estilo1">FACTURA </span></div>      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="7" rowspan="2" align="left" valign="top"><table width="781" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="318" height="26"><span class="Estilo14">Modelo</span><span class="Estilo15">
            <input name="auxiliar" type="text" id="auxiliar" onKeyUp="validartecla(event,this,'productos')" size="35" maxlength="50" autocomplete="off"  >
            <input name="auxiliar2" type="hidden" id="auxiliar2" size="3"/>
          </span><img style="cursor:pointer" onClick="ver_clientes()" src="../imagenes/ico_lupa.jpg" width="15" height="15"></td>
          <td width="29" class="Estilo14">Und</td>
          <td width="103"><div id="Factor_uniM">
              <select name="fac_modelo" style="width:100px;height:20; border-color:#CCCCCC"  id="fac_modelo">
              </select>
          </div></td>
          <td width="331"><span class="Estilo14">Cant. G.</span>
              <input name="factor" type="text" id="factor"  style="height:20; border-color:#CCCCCC"  size="3" maxlength="6" autocomplete="off" onKeyPress="numero()" >
              <a href="#" onClick="vaciar_sesiones2();"><span class="Estilo14">Modo Imp. </span>
              <select name="modo_imp" id="modo_imp" style="width:120px">
                <option value="1">Caracter&iacute;sticas Detallado</option>
                <option value="4" selected="selected">Caracter&iacute;sticas sin modelo</option>
                <option value="2">Detallado x Consolidado</option>
                <!--muestra solo el modelo con la descripcion de los productos  q contiene -->
                <option value="3" selected="selected">Detallado x Item</option>
                <!--no se muestra la fila modelo-->
              </select>
            </a></td>
        </tr>
        <tr>
          <td height="10" colspan="5" ></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td></td>
      <td ></td>
      <td colspan="7"><table width="767" height="5" border="0" cellpadding="0" cellspacing="0" style="border-top: #CCCCCC solid 1px">
        <tr>
          <td width="767" height="5"></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td ></td>
      <td colspan="7"><table width="624" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="218"><span class="Estilo14">Producto:</span></td>
          <td width="143"><span class="Estilo14">Presentaci&oacute;n:</span></td>
          <td width="11">&nbsp;</td>
          <td width="66"><span class="Estilo14">Cant.:</span></td>
          <td width="11">&nbsp;</td>
          <td width="66"><span class="Estilo14">P.Unit:</span></td>
          <td width="10">&nbsp;</td>
          <td width="99"><span class="Estilo14">&nbsp;</span><span class="Estilo14">Total:</span></td>
          </tr>
        <tr>
          <td><input autocomplete="off"  name="codprod"  type="text" size="8"  onKeyUp="validartecla2(event,this,'productos')" />
            <script>
		  function verfactor(){
		  alert(41);
		  var codigo=document.formulario.codprod.value;
		  doAjax('buscar_factor.php','&cod='+codigo,'mostrar_factor','get','0','1','','');
		  }
		  function mostrar_factor(texto){
		  alert(42);
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
            <span class="Estilo15"> </span></span></td>
          <td><span class="Estilo14"><span class="Estilo15">
           <div id="cbo_uni">
		    <select name="presentacion" style="width:140px"  id="presentacion">
			</select>
			</div>
			
          </span></span></td>
          <td>&nbsp;</td>
          <td><span class="Estilo14"><span class="Estilo15">
            <input name="ter" type="hidden" size="3"  value="0"/>
          </span></span><span class="Estilo14">
          <input style=" text-align:right" name="cantidad" id="cantidad"  type="text" size="8" onKeyUp="cambiar_foco(event);calcular_ptotal()" onKeyPress="numero()" />
          </span></td>
          <td>&nbsp;</td>
          <td><span class="Estilo14">
            <input  name="punit" type="text" size="8" style=" text-align:right" onKeyUp="calcular_ptotal()" onKeyPress="numerodesc()" />
          </span></td>
          <td>&nbsp;</td>
          <td><input style="font:bold; text-align:right" name="precio" type="text" size="8"   onKeyUp="calcular_cant()" onKeyPress="numerodesc()" />
            <input  name="precio2" type="hidden" size="3"/>
            <input name="notas" type="hidden" size="15" maxlength="30"></td>
          </tr>
      </table></td>
    </tr>
    
    <tr>
      <td colspan="9"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="7">
	  <div id="resultado">
	    <table width="679" border="0" cellpadding="1" cellspacing="1" bordercolor="#F5F5F5" bgcolor="#F5F5F5">
          <tr>
            <td width="49" height="18" align="center" bgcolor="#3366CC"><span class="Estilo31">C&oacute;digo</span></td>
            <td width="309" bgcolor="#3366CC"><span class="Estilo31">Art&iacute;culo</span></td>
            <td width="76" align="center" bgcolor="#3366CC"><span class="Estilo31">UND</span></td>
            <td width="53" align="center" bgcolor="#3366CC"><span class="Estilo31">Cant.</span></td>
            <td width="74" bgcolor="#3366CC"><span class="Estilo32"><span class="Estilo31">P. Costo</span></span></td>
            <td width="62" bgcolor="#3366CC"><span class="Estilo31">Total</span></td>
            <td width="55" align="center" bgcolor="#3366CC"><span class="Estilo31">E</span></td>
          </tr>
 
          <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
            <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#FFFFFF">&nbsp;</td>
            <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#FFFFFF"></td>
            <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#FFFFFF">&nbsp;</td>
            <td align="center" bgcolor="#FFFFFF"></td>
          </tr>
		  	  	  
          <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
            <td align="center">&nbsp;</td>
            <td>&nbsp;</td>
            <td align="right">&nbsp;</td>
            <td></td>
            <td align="right">&nbsp;</td>
            <td></td>
            <td colspan="2" align="center">&nbsp;</td>
          </tr>
          <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
            <td align="left"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">Items</span></td>
            <td><strong id="nitems">0</strong></td>
            <td align="right"><input name="estado" type="hidden" value="" size="5"></td>
            <td colspan="2" style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333" >Total Costo</td>
            <td align="right"><strong>
              <input name="monto" type="text" size="10" style="text-align:right"  value="<?php echo number_format($total,2);?>"/>
            </strong></td>
            <td colspan="2" align="center"><strong>
              <input name="total_doc" type="hidden" size="10" style="text-align:right"  value="<?php echo number_format($total+$total*0.19,2);?>"/>
            </strong></td>
          </tr>
          <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
            <td align="left"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">Moneda</span></td>
            <td><label style="color:#FF0000" id="moneda"><?php echo "(S/.)" ?></label></td>
            <td align="right">&nbsp;</td>
            <td colspan="2"><table width="115" border="0" cellpadding="0" cellspacing="0" style="visibility:hidden">
              <tr>
                 <td width="59" height="18" bgcolor="#FFFFFF" >Impuesto1 (</td>
            <td width="15" bgcolor="#FFFFFF"><div id="impto1">18</div></td>
            <td width="41" bgcolor="#FFFFFF">)%</td>
              </tr>
            </table></td>
            <td align="right"><strong>
              <input name="impuesto1" type="hidden" size="10" style="text-align:right;"  value="<?php echo number_format($total*0.19,2);?>"/>
            </strong></td>
            <td colspan="2" align="center">&nbsp;</td>
          </tr>
         </table>
	  </div>	  </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="558">

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
	  <table width="488" border="0" align="left" cellpadding="0" cellspacing="0"  style="display:none">
        <tr>
          <td width="71" align="left"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">Referencia</span>
		  <img style="cursor:pointer" alt="" onClick="doc_det(document.formulario.cod_cab_ref.value)" src="../imagenes/ico_lupa.png" width="12" height="12">		  </td>
          <td width="127" align="left">
		  <input readonly="readonly"  style="text-align:right" name="serie_ref" id="serie_ref" type="text" size="5" maxlength="3" />
            <input readonly="readonly" style="text-align:right" name="correlativo_ref" id="correlativo_ref" type="text" size="10" maxlength="7" /></td>
          <td width="290" align="left"><button title="[Alt+r]" disabled="disabled" onClick="vent_ref()" type="button" id="doc_ref"  style="height:18px"><span style=" font-family:Arial, Helvetica, sans-serif;font-size:9px">Referencia</span></button>
            <button title="[Alt+r]" disabled="disabled" onClick="vent_referenciado()" type="button" id="doc_ref2"  style="height:18px"><span style=" font-family:Arial, Helvetica, sans-serif;font-size:9px">Referenciado</span></button>
			
			 <button title="" disabled="disabled" onClick="cambiar_dir()" type="button" id="btnCambiarDir"  style="height:18px"><span style=" font-family:Arial, Helvetica, sans-serif;font-size:9px">Cambiar Direccion</span></button>			</td>
          </tr>
      </table>
	  <table width="534" height="27" border="0" cellpadding="0" cellspacing="0" style="display:none">
        <tr>
          <td width="176" ><fieldset style=" padding:10px">
            <legend>Porcentaje % de venta </legend>
            <table width="135" height="80" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="39%" height="15" ><span class="Estilo122">%PV 1 </span></td>
                <td width="61%"><input name="pv1" type="text" id="pv1" style="text-align:right" onKeyPress="numero()" value="10" size="8" maxlength="3" onKeyUp="calculoPV(1);">
                %</td>
              </tr>
              <tr>
                <td height="15" ><span class="Estilo122">%PV 2 </span></td>
                <td><input name="pv2" type="text" id="pv2" style="text-align:right" onKeyPress="numero()" value="10" size="8" maxlength="3"  onKeyUp="calculoPV(1);">
                %</td>
              </tr>
              <tr >
                <td height="16"><span class="Estilo122">%PV 3 </span></td>
                <td><input name="pv3" type="text" id="pv3" style="text-align:right" onKeyPress="numero()" value="10" size="8" maxlength="3"  onKeyUp="calculoPV(1);">
                %</td>
              </tr>
              <tr>
                <td height="17" ><span class="Estilo122">%PV 4</span></td>
                <td><input name="pv4" type="text" id="pv4" style="text-align:right" onKeyPress="numero()" value="10" size="8" maxlength="3"  onKeyUp="calculoPV(1);">
                %</td>
              </tr>
              <tr>
                <td height="17" ><span class="Estilo122">%PV 5 </span></td>
                <td><input name="pv5" type="text" id="pv5" style="text-align:right" onKeyPress="numero()" value="10" size="8" maxlength="3"  onKeyUp="calculoPV(1);">
                %</td>
              </tr>
            </table>
          </fieldset></td>
          <td width="33" >&nbsp;</td>
          <td width="182" ><fieldset style=" padding:10px">
            <legend>Precio de venta </legend>
            <table width="135" height="80" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="39%" height="15" ><span class="Estilo122">P.V. 1 </span></td>
                <td width="61%"><input name="pvp1" type="text" id="pvp1" style="text-align:right" onKeyPress="numerodesc()" value="0.00" size="11" maxlength="11" onKeyUp="calculoPV(2);" ></td>
              </tr>
              <tr>
                <td height="15" ><span class="Estilo122">P.V. 2 </span></td>
                <td><input name="pvp2" type="text" id="pvp2" style="text-align:right" onKeyPress="numerodesc()" value="0.00" size="11" maxlength="11" onKeyUp="calculoPV(2);"></td>
              </tr>
              <tr >
                <td height="16"><span class="Estilo122">P.V. 3 </span></td>
                <td><input name="pvp3" type="text" id="pvp3" style="text-align:right" onKeyPress="numerodesc()" value="0.00" size="11" maxlength="11" onKeyUp="calculoPV(2);" ></td>
              </tr>
              <tr>
                <td height="17" ><span class="Estilo122">P.V. 4</span></td>
                <td><input name="pvp4" type="text" id="pvp4" style="text-align:right" onKeyPress="numerodesc()" value="0.00" size="11" maxlength="11" onKeyUp="calculoPV(2);"></td>
              </tr>
              <tr>
                <td height="17" ><span class="Estilo122">P.V. 5 </span></td>
                <td><input name="pvp5" type="text" id="pvp5" style="text-align:right" onKeyPress="numerodesc()" value="0.00" size="11" maxlength="11" onKeyUp="calculoPV(2);" ></td>
              </tr>
            </table>
          </fieldset></td>
          <td width="38" >&nbsp;</td>
          <td width="186" ><fieldset style=" padding:10px">
            <legend>Utilidad  Precio venta </legend>
            <table width="135" height="80" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="39%" height="15" ><span class="Estilo122">U.P.V. 1 </span></td>
                <td width="61%"><input name="pvu1" type="text" id="pvu1" style="text-align:right" onKeyPress="numerodesc()" value="0.00" size="11" maxlength="11" readonly ></td>
              </tr>
              <tr>
                <td height="15" ><span class="Estilo122">U.P.V. 2 </span></td>
                <td><input name="pvu2" type="text" id="pvu2" style="text-align:right" onKeyPress="numerodesc()" value="0.00" size="11" maxlength="11" readonly></td>
              </tr>
              <tr >
                <td height="16"><span class="Estilo122">U.P.V. 3 </span></td>
                <td><input name="pvu3" type="text" id="pvu3" style="text-align:right" onKeyPress="numerodesc()" value="0.00" size="11" maxlength="11" readonly></td>
              </tr>
              <tr>
                <td height="17" ><span class="Estilo122">U.P.V. 4</span></td>
                <td><input name="pvu4" type="text" id="pvu4" style="text-align:right" onKeyPress="numerodesc()" value="0.00" size="11" maxlength="11" readonly></td>
              </tr>
              <tr>
                <td height="17" ><span class="Estilo122">U.P.V. 5 </span></td>
                <td><input name="pvu5" type="text" id="pvu5" style="text-align:right" onKeyPress="numerodesc()" value="0.00" size="11" maxlength="11" readonly></td>
              </tr>
            </table>
          </fieldset></td>
        </tr>
      </table></td>
      <td width="62">&nbsp;</td>
      <td width="97"><input name="saldo" type="hidden" size="10" maxlength="10">
      <input name="prueba" type="hidden" size="10" maxlength="10" ></td>
      <td width="63" colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr style="background:url(../imagenes/white-top-bottom.gif)">
       <td height="27" colspan="13" style="border:#999999"><span class="Estilo34">Lista  de Modelos  ::</span></td>
    </tr>
    <tr>
      <td colspan="8"><table width="784" border="0" cellpadding="0" cellspacing="1">
        <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
          <td   style=" border:#CCCCCC solid 1px" width="72" height="21" align="center" ><span class="texto2 Estilo115 Estilo112"><strong>Num.</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="461" align="center"><span class="texto2 Estilo115 Estilo112 Estilo112"><strong>Modelo </strong></span></td>
          <td width="82" align="center"  style=" border:#CCCCCC solid 1px" ><span class="Estilo112"><strong>Codigo</strong></span></td>
          <td width="105" align="center"  style=" border:#CCCCCC solid 1px" ><span class="Estilo112"><strong>Estado</strong></span></td>
          <td width="76" align="center"  style=" border:#CCCCCC solid 1px" ><span class="Estilo112"><strong>Tipo Imp. </strong></span></td>
        </tr>
        <tr>
          <td colspan="6"><div id="detalle3" style="width:780px; height:150px;" ><span class="Estilo114">
              <input name="almcod" type="hidden" disabled id="almcod"  style="height:20; border-color:#CCCCCC" size="8">
          </span></div></td>
        </tr>
      </table></td>
    </tr>
  </table>
   
  <div id="productos" style="position:absolute; left:62px; top:130px; width:300px; height:180px; z-index:1; visibility:hidden"> </div>
  
   <div id="auxiliares" style="position:absolute; left:103px; top:92px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>
   <div id="new_aux" style="position:absolute; left:274px; top:139px; width:300px; height:180px; z-index:2; visibility:hidden"></div>
   <div id="choferes" style="position:absolute; left:274px; top:139px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>
 
 
 <div id="cambiarDirec" style="border:#238CE2 solid 1px; background:#E2FAFE; position:absolute; left:274px; top:139px; width:300px; height:180px; z-index:2; visibility:hidden; background-color: #F1FBFE;"></div>
 	

</form>

 <div id="capaCopiarDoc" style="border:#238CE2 solid 1px; background:#E2FAFE; position:absolute; left:238px; top:15px; z-index:2; visibility:hidden; background-color: #F1FBFE; width: 340px;"></div>
 
</body>

<script>



function calcular_cant(){
//alert(43);
var punit=parseFloat(document.formulario.punit.value);
var precio=parseFloat(document.formulario.precio.value);
var total=Math.round((precio/punit)*1000)/1000;
//alert(total);
	if(total>0){
		document.formulario.cantidad.value=total;
	}else{
		document.formulario.cantidad.value="";
	}
		
	
	
}

function activar(e){
//alert(45);
	if(e.keyCode == 13){
	document.formulario.ter.value=0;
	document.formulario.cantidad.focus();
	}else{
	document.formulario.ter.value=1;
	}

}

function imprimiendo(){
alert(47);
	if(document.formulario.ruc2.value=="1"){
	}
	
}

function enviar(){
//alert(50);
	var punit='';
	if(document.formulario.codprod.value==''){
	punit=parseFloat(document.formulario.termino.value);
	}else{
	punit=parseFloat(document.formulario.punit.value);
	}
	
	var permiso4=find_prm(tab4,tab_cod);
	var notas=document.formulario.notas.value;
	var presentacion=document.formulario.presentacion.value;
	var permiso10=find_prm(tab10,tab_cod);
	
	var kardex_prod=document.formulario.kardex_prod.value;
	var prms_doc_stock=find_prm(tab1,tab_cod);
	//alert(kardex_prod+'/'+prms_doc_stock);
			
	if(document.formulario.serie_ing.value=="" && document.formulario.series.value=='S' && permiso10=='S' && prms_doc_stock=='S'){ //Rk Maneja stock las sere
		
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
	
	/*if(punit<document.formulario.precosto.value && document.formulario.tipomov.value==2 ){
	alert('El precio no puede ser menor a el precio de costo');
	document.formulario.punit.focus();
	document.formulario.punit.select();
	return false;
	}*/
	
	var esserie=document.formulario.series.value;
	var precosto=document.formulario.precosto.value;
	var impto=document.formulario.impto.value
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
	doAjax('detalle_docModelo.php','&incluidoigv='+document.formulario.incluidoigv.value+'&punitario='+punit+'&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&notas='+notas+'&presentacion='+presentacion+'&esserie='+esserie+'&permiso10='+permiso10+'&cargar_ref=noref&precosto='+precosto+'&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov+'&codAnexProd='+codAnexProd,'mostrar','get','0','1','','');
}

function elegir(cod,des){
//alert(53);
document.formulario.codprod.value=cod;
document.formulario.termino.value=removeTags(des);

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

function elegir2(cod,des){
//alert(54);
des=des.replace('amps','&');

document.formulario.auxiliar.value=removeTags(des);
document.formulario.auxiliar2.value=cod;
document.getElementById('auxiliares').style.visibility='hidden';
mostrar_cbos();

			var serie=document.formulario.num_serie.value;
			var numero=document.formulario.num_correlativo.value;
			var doc='';//document.formulario.doc.value;
			var sucursal=document.formulario.sucursal.value;
			var tipomov=document.formulario.tipomov.value;
			
	if(tipomov==1){
	
	doAjax('peticion_datos.php','&serie='+serie+'&numero='+numero+'&doc='+doc+'&sucursal='+sucursal+'&auxiliar='+cod+'&peticion=buscar_prov2&tipomov='+tipomov,'rpta_con_datos2','get','0','1','','');
	}else{
			var CodVen=<?=$_SESSION['codvendedor'];?>;
			var usetrans=document.formulario.usetrans.value;
			//alert(usetrans);	
			if (CodVen!=1){
				if (usetrans=='N'){
				//document.formulario.responsable.disabled='disabled';
				//document.formulario.codprod.focus();
				document.formulario.condicion.focus();				
				}else{
				document.formulario.responsable.disabled='disabled';
				document.formulario.btn_transp.focus(); //condicion
				}
			}else{
				document.formulario.responsable.disabled='';
				document.formulario.responsable.focus();	
			}
	}
}
function elegir3(cod,des){
des=des.replace('amps','&');
document.formulario.auxiliar.value=removeTags(des);
document.formulario.auxiliar2.value=cod;

document.getElementById('productos').style.visibility='hidden';

var uni_p=document.formulario.uni_p.value;
var factor_p=document.formulario.factor_p.value;
var precio_p=document.formulario.precio_p.value;
doAjax('../modelo_trasformacion/carga_cbo_uni.php','&producto='+cod+'&uni_p='+uni_p+'&factor_p='+factor_p+'&precio_p='+precio_p+'&id=fac_modelo','view_cbo_uni2','get','0','1','','');
//Factor_uniM
}
function view_cbo_uni2(texto){
	document.getElementById('Factor_uniM').innerHTML=texto;
	document.formulario.factor.focus();	
}
function view_cbo_uni(texto){
//alert(544);
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
		/*document.formulario.precio.focus();
		document.formulario.precio.select();*/	
		document.formulario.cantidad.focus();
		document.formulario.cantidad.select();		
		}
		
	}
}



		function deshabilitar(){
		alert(57);
		document.formulario.sucursal.disabled=true;
		document.formulario.almacen.disabled=true;
		//document.formulario.doc.disabled=true;
		document.formulario.num_serie.disabled=true;
		document.formulario.num_correlativo.disabled=true;
		document.formulario.auxiliar.disabled=true;
		document.formulario.responsable.disabled=true;
		document.formulario.femi.disabled=true;
		document.formulario.fven.disabled=true;
	
		}
		
		function habilitar(){
		alert(58);
		document.formulario.sucursal.disabled=false;
		document.formulario.almacen.disabled=false;
		//document.formulario.doc.disabled=false;
		document.formulario.num_serie.disabled=false;
		document.formulario.num_correlativo.disabled=false;
		document.formulario.auxiliar.disabled=false;
		document.formulario.responsable.disabled=false;
		document.formulario.femi.disabled=false;
		document.formulario.fven.disabled=false;
		
		}
		
		

var temp_busqueda="<?php echo $_SESSION['filtro_busqueda']?>";

var temp_busqueda2="";

var campoX="";
function validartecla(e,valor,temp){
//alert(59);
campoX=valor.name;
	if(valor.value.length<3){
	return false;
	}

	if(document.formulario.correlativo_ref.value!='' && document.formulario.serie_ref!=''){
	alert('no esta permitido ingresar mas items');
	return false;
	}
	
	document.formulario.cantidad.value="";		
	document.formulario.punit.value="";		
	

	var tipomov=document.formulario.tipomov.value;
	document.formulario.tempauxprod.value=temp;
	
	if(document.getElementById('productos').style.visibility=='visible'){
	temp_busqueda=document.formulario.busqueda.value;
	}else{
		if(document.getElementById('auxiliares').style.visibility=='visible'){
		temp_busqueda2=document.formulario.busqueda2.value;
		}
	
	}
	
	if ( ( (e.keyCode>=96) && (e.keyCode<=105) || (e.keyCode>=48) && (e.keyCode<=57) )  || ((e.keyCode>=65) && (e.keyCode<=90)) || e.keyCode==8 || e.keyCode==32 ) {

		if(document.getElementById(temp).style.visibility!='visible' ){
			//alert(temp+'//'+tipomov);
			doAjax('lista_aux.php','&temp='+temp+'&tipomov='+tipomov+'&modulo=tranf','listaprod','get','0','1','','');
		}else{
		
			var valor="";
			var temp_criterio=temp_busqueda;
			if(document.formulario.tempauxprod.value=='auxiliares'){
			valor=document.formulario.auxiliar.value;
			temp_criterio=temp_busqueda2;
			}
			if(document.formulario.tempauxprod.value=='productos'){
				valor=document.formulario.codprod.value;
				if (campoX=='auxiliar'){				  
				  valor=document.formulario.auxiliar.value;
				}			
			temp_criterio=temp_busqueda;
			}
		
			var temp=document.formulario.tempauxprod.value;
			var tipomov=document.formulario.tipomov.value;
			var tienda=document.formulario.almacen.value;			
			var moneda_doc=document.formulario.tmoneda.value;
		doAjax('det_aux.php','&ptovta34&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc='+document.formulario.prov_asoc.value+'&moneda_doc='+moneda_doc+'&esmodel','detalle_prod','get','0','1','','');

		}
		
		
}

}



function validartecla2(e,valor,temp){
//alert(59);
campoX=valor.name;
	if(valor.value.length<3){
	return false;
	}

	if(document.formulario.correlativo_ref.value!='' && document.formulario.serie_ref!=''){
	alert('no esta permitido ingresar mas items');
	return false;
	}
	
	document.formulario.cantidad.value="";		
	document.formulario.punit.value="";		
	

	var tipomov=document.formulario.tipomov.value;
	document.formulario.tempauxprod.value=temp;
	
	if(document.getElementById('productos').style.visibility=='visible'){
	temp_busqueda=document.formulario.busqueda.value;
	}else{
		if(document.getElementById('auxiliares').style.visibility=='visible'){
		temp_busqueda2=document.formulario.busqueda2.value;
		}
	
	}
	
	if ( ( (e.keyCode>=96) && (e.keyCode<=105) || (e.keyCode>=48) && (e.keyCode<=57) )  || ((e.keyCode>=65) && (e.keyCode<=90)) || e.keyCode==8 || e.keyCode==32 ) {

		if(document.getElementById(temp).style.visibility!='visible' ){
			//alert(temp+'//'+tipomov);
			doAjax('lista_aux.php','&temp='+temp+'&tipomov='+tipomov+'&modulo=tranf','listaprod','get','0','1','','');
		}else{
		
			var valor="";
			var temp_criterio=temp_busqueda;
			if(document.formulario.tempauxprod.value=='auxiliares'){
			valor=document.formulario.auxiliar.value;
			temp_criterio=temp_busqueda2;
			}
			if(document.formulario.tempauxprod.value=='productos'){
				valor=document.formulario.codprod.value;
				if (campoX=='auxiliar'){				  
				  valor=document.formulario.auxiliar.value;
				}			
			temp_criterio=temp_busqueda;
			}
		
			var temp=document.formulario.tempauxprod.value;
			var tipomov=document.formulario.tipomov.value;
			var tienda=document.formulario.almacen.value;			
			var moneda_doc=document.formulario.tmoneda.value;
		doAjax('det_aux.php','&ptovta34&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc='+document.formulario.prov_asoc.value+'&moneda_doc='+moneda_doc,'detalle_prod','get','0','1','','');

		}
		
		
}

}


function cambiar_foco(e){
//alert(60);		
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
		
	}

	document.formulario.punit.select();
	document.formulario.punit.focus();
	event.keyCode=0;
	event.returnValue=false;
	}

}

function calcular_ptotal(){
//alert(61);
	var totalitem=document.formulario.punit.value*document.formulario.cantidad.value;
	document.formulario.precio.value=(Math.round((totalitem)*1000)/1000).toFixed(4);	
}


function eliminar(codigo,prod){
//alert(62);
	if(!document.formulario.codprod.disabled){	
	var permiso4=find_prm(tab4,tab_cod);
	var notas=document.formulario.notas.value; 
	var tienda=document.formulario.almacen.value;
	var permiso10=find_prm(tab10,tab_cod);
	 var impto=document.formulario.impto.value;
	var tipomov=document.formulario.tipomov.value;
		 
	doAjax('detalle_docModelo.php','&incluidoigv='+document.formulario.incluidoigv.value+'&cod_delete='+codigo+'&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&tienda='+tienda+'&permiso10='+permiso10+'&cargar_ref&impto='+impto+'&tipomov='+tipomov+'&codSerie='+prod,'mostrar','get','0','1',codigo,'eliminar');
	}
}


	function espec_prod(objeto){
	//alert(67);
	/*selecionarItem(objeto.parentNode.parentNode.parentNode.rowIndex);
	var codigo=objeto.innerHTML;
	var moneda=document.formulario.tmoneda.value;
	var sucursal=document.formulario.sucursal.value;*/
	//window.open('espec_prod.php?codigo='+codigo+'&moneda='+moneda+'&sucursal='+sucursal,'','width=650,height=420,top=300,left=300,scroolbars=yes,directories=no,location=no,menubar=no,titlebar=no,toolbar=no,status=yes');	
	
	}
	


	function selec_busq(){
	//alert(69);
	 var valor1=temp_busqueda;
 	 var obj=document.formulario.busqueda;
	 if(isset(obj)){ 
		 var i;
		 for (i=0;i<document.formulario.busqueda.options.length;i++){			
				if (document.formulario.busqueda.options[i].value==valor1) {
				   document.formulario.busqueda.options[i].selected=true;
				   }			
			}
	 }	
	 
	}
	
	function selec_busq2(){
	//alert(70);
	 var valor1=temp_busqueda;
	
     var i;
		 for (i=0;i<document.formulario.busqueda2.options.length;i++)
			{		
				if (document.formulario.busqueda2.options[i].value==valor1) {
				   document.formulario.busqueda2.options[i].selected=true;
				   }        
			}
	}
	
	
	function mostrar_detalle(){
	alert(74);
	//alert(<?=count($_SESSION['productos3'][0]);?>);
	//alert(document.getElementById('nitems').childNodes[0].innerHTML);
	if (<?=count($_SESSION['productos3'][0]);?>=='0'){
	return false;
	}
	
	
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
	doAjax('detalle_docModelo.php','&incluidoigv='+document.formulario.incluidoigv.value+'&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&permiso10='+permiso10+'&accion=mostrarprod&cargar_ref&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov+'&copiarDoc='+document.formulario.tempCopiar.value,'mostrar','get','0','1','','');

		document.formulario.codprod.focus();
		
	}
			
	
function cargar_cbo_doc(){
alert(79);
	var tipomov=document.formulario.tipomov.value;
	if(document.getElementById("capaCopiarDoc").style.visibility=="visible"){
	var empresa=document.frmCopiarDoc.sucursal.value;
	}else{	
	var empresa=document.formulario.sucursal.value;
	}
	doAjax('../carga_cbo_doc.php','&tipomov='+tipomov+'&empresa='+empresa,'res_cargar_cbo_doc','get','0','1','','');
	
}
	
	function res_cargar_cbo_doc(texto){
	alert(80);
	var temp=texto.split("?");
	
	/*if(document.getElementById("capaCopiarDoc").style.visibility=="visible"){
	//alert(temp[0]);
	document.getElementById('div3').innerHTML=temp[0];
	}else{
	
	document.getElementById('cbo_doc').innerHTML=temp[0];
	document.formulario.doc.disabled='';
	//alert(document.getElementById('cbo_doc').innerHTML);
	selec_doc();
	}*/
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
		//	 alert(tab16);			
			//alert(temp[21]+" "+temp[22]);
		//numero de documento no autorizado ...
		//Yedem
		document.formulario.doc.style.visibility='hidden';
		iniciar();
		//selecciona el tipo de moneda 
		 temp_mon=find_prm(tab_moneda,tab_cod);
			document.formulario.tmoneda.value=temp_mon;
			if(temp_mon=='02'){
			document.getElementById('moneda').innerHTML='(US$.)';
			}else{
			document.getElementById('moneda').innerHTML='(S/.)';
			}

	}
	
	
	function filtros(){
	alert(81);
			var valor="";
			if(document.formulario.tempauxprod.value=='auxiliares'){
			valor=document.formulario.auxiliar.value;
			
			//selec_busq2();
			}
			if(document.formulario.tempauxprod.value=='productos'){
			valor=document.formulario.codprod.value;
			
			//selec_busq();
			}
		
			var temp=document.formulario.tempauxprod.value;
			var tipomov=document.formulario.tipomov.value;
			var tienda=document.formulario.almacen.value;
			
			var temp_criterio=temp_busqueda;
			
			var comboclasificacion=document.formulario.comboclasificacion.value;
			var categoria=document.formulario.combocategoria.value;
			var subcategoria=document.formulario.combosubcategoria.value;
			var moneda_doc=document.formulario.tmoneda.value; 
			
		
		doAjax('det_aux.php','&ptovta34&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc='+document.formulario.prov_asoc.value+'&comboclasificacion='+comboclasificacion+'&categoria='+categoria+'&subcategoria='+subcategoria+'&moneda_doc='+moneda_doc+'&esmodel','detalle_prod','get','0','1','','');
	
	
	}

function calc_pre_total(){
	alert(82);
	var totalitem=document.formulario.punit.value*document.formulario.cantidad.value;
	document.formulario.precio.value=(Math.round((totalitem)*1000)/1000).toFixed(4);
	calculos_pretot();	
}	

function calculos_pretot(){
//alert(83);
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
				document.formulario.precio.value=parseFloat((total_precio*document.formulario.cantidad.value)).toFixed(2);
				}	
			}
			document.formulario.punit.value=parseFloat(total_precio).toFixed(4);
			//alert(document.formulario.punit.value);

//Yedem sub unidad
var cant=document.formulario.cantidad.value;
var saldo=document.formulario.saldo.value;

doAjax('sub_unidad.php','&codp='+document.formulario.codprod.value+'&facp='+document.formulario.factor_p.value+'&fac1='+document.formulario.presentacion.value+'&saldo='+saldo+'&cant='+cant,'CountSubUnidad','get','0','1','','');

	}
		
				
function ocultar_cbos(){
	//alert(84);
	document.getElementById('presentacion').style.visibility='hidden';	
	document.getElementById('responsable').style.visibility='hidden';	
	}
	function mostrar_cbos(){
	document.getElementById('presentacion').style.visibility='visible';
	document.getElementById('responsable').style.visibility='visible';
	}	
	
	function llenar_fvenc(control){
	alert(88);	
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
	alert(88);
	document.getElementById("cambiar_fecha").style.display="block";
	
	}
	

	var temp2="";
	
	function entrada(objeto){
	//alert(91);
			try{		
		//alert();
		objeto.cells[0].childNodes[0].checked=true;
		document.form_clientes.cod_aux_sel.value=objeto.cells[1].childNodes[0].innerHTML;
		document.form_clientes.nom_aux_sel.value=objeto.cells[2].childNodes[0].innerHTML;
		document.form_clientes.ruc_aux_sel.value=objeto.cells[3].childNodes[0].innerHTML;
		document.form_clientes.dir_aux_sel.value=objeto.cells[1].childNodes[0].innerHTML;
		
		if(tempColor==""){
		tempColor=document.getElementById('tblproductos').rows[0];
		}
		
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
	alert(92);
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
	

	function enfocar_codprod(){
	//alert(100);
	var pagina = self.location.href.match( /\/([^/]+)$/ )[1];
		if(pagina=='transferencia.php'){
		//document.form1.codprod.focus();
		document.form1.codprod.select();
		}else{
		//document.formulario.codprod.focus();
		document.formulario.codprod.select();
		}
	}
	
		function cambiar_moneda_ini(){		
		//document.formulario.alias.focus();
	document.formulario.auxiliar.focus();
		
		var almacen="";//document.form1.almacen.value;
		var cliente="";//document.form1.cliente.value;
		var ruc="";//document.form1.ruc.value;
		//var ckbven=document.form1.ckbven.checked;
		var ckbven="";
		var Estado="";
		var fec1="01-01-2000";
		var f = new Date();
		var fec2=f.getDate() + "-" + parseFloat(f.getMonth()+1) + "-" + f.getFullYear();
		
		//var Estado=document.form1.Estado.value;
		//var fec1=document.form1.fec1.value;
		//var fec2=document.form1.fec2.value;
		var pagina="";
		var vendedor="";
		var docref="";
		var mosdocAnu="";
		var criterio="";
		var valor="";
		var mosdocFac="";
		
		doAjax('../modelo_trasformacion/lista_genDocModelo2.php','&almacen='+almacen+'&cliente='+cliente+'&pagina='+pagina+'&ruc='+ruc+'&vendedor='+vendedor+'&docref='+docref+'&mosdocFac='+mosdocFac+'&mosdocAnu='+mosdocAnu+'&Estado='+Estado+'&fec1='+fec1+'&fec2='+fec2+'&criterio='+criterio+'&valor='+valor,'mostrar_filtro','get','0','1','','');
		
		
		//---------------------------------------------------------------------------------
		return false;
		//alert(101);	
			if(document.getElementById('moneda').innerHTML=='(S/.)'){
			document.getElementById('moneda').innerHTML='(US$.)';
			document.formulario.tmoneda.value="02";
			document.formulario.precosto.value=document.formulario.precosto.value/tc_doc;
			}else{
			document.getElementById('moneda').innerHTML='(S/.)';
			document.formulario.tmoneda.value="01";
			document.formulario.precosto.value=document.formulario.precosto.value*tc_doc;			
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
		
			doAjax('detalle_docModelo.php','&incluidoigv='+document.formulario.incluidoigv.value+'&accion=cambiar_dolar&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&permiso10='+permiso10+'&cargar_ref&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov,'mostrar','get','0','1','','');
			}else{
				if(document.getElementById('moneda').innerHTML=='(S/.)'){
				temp_mon="01";
				}else{
				temp_mon="02";
				}
			}
		
		}



	function mostrar_filtro(texto){
	//alert();
	document.getElementById('detalle3').innerHTML=texto;
	//cargar();
	//document.form1.carga.value='N';
	}

function doc_det(valor){
//alert(valor);
var format='';
if(valor==''){
valor=document.formulario.cod_cab_ref2.value;
}
window.open("../modelo_trasformacion/doc_det2.php?referencia="+valor,"","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=620, height=420,left=300 top=250");

}
function canbiar_uni(it){
//alert(103);
try
  {
  for (i=0;i<document.formulario.unidad_det[it].options.length;i++){		
         if (document.formulario.unidad_det[it].options[i].value==document.formulario.unidad_det[it].value){
			   var des_pres=document.formulario.unidad_det[it].options[i].text;
			  var precio=parseFloat(des_pres.substring(10)).toFixed(2);
           }
      }
	document.formulario.punit_det[it].value=precio;
  }
catch(err)
  {
  for (i=0;i<document.formulario.unidad_det.options.length;i++){		
         if (document.formulario.unidad_det.options[i].value==document.formulario.unidad_det.value){
			   var des_pres=document.formulario.unidad_det.options[i].text;
			  var precio=parseFloat(des_pres.substring(10)).toFixed(2);
           }
      }
	document.formulario.punit_det.value=precio;
  }
  
}
function recalcular_precios(control,producto,e,precosto,mon_prod,pre_actual,it){
//alert(104);
	if(e.keyCode==13){
	var tc_doc=document.formulario.tcambio.value;
	//alert(precio_nuevo+" "+producto);
	if(mon_prod==1 && document.getElementById('moneda').innerHTML=='(US$.)'){
			precosto=parseFloat(precosto/tc_doc).toFixed(4);
			}else{
				if(mon_prod==2 && document.getElementById('moneda').innerHTML=='(S/.)'){
				precosto=parseFloat(precosto*tc_doc).toFixed(4);
				}
			
	}

//-----------------actualizar datos 
try
  {
cantidad_det=document.formulario.cant_det[it].value;
	unidad_det=document.formulario.unidad_det[it].value;
	precio_nuevo=document.formulario.punit_det[it].value;
  }
catch(err)
  {
cantidad_det=document.formulario.cant_det.value;
	unidad_det=document.formulario.unidad_det.value;
	precio_nuevo=document.formulario.punit_det.value;
  }
//-----------------fin de actualizar	

	//alert(mon_prod+" "+precosto);
	/* Precio Menor al costo en el detalle*/
	
	if(precio_nuevo<precosto){
	alert('El precio no puede ser menor a el precio de costo');
	control.value=pre_actual;
	control.focus();
	control.select();
	return false;
	}
	
		
	
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
		
		//alert(cantidad_det+'//'+unidad_det);
		
	doAjax('detalle_docModelo.php','&incluidoigv='+document.formulario.incluidoigv.value+'&accion=cambiar_dolar&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&permiso10='+permiso10+'&precio_nuevo='+precio_nuevo+'&producto='+producto+'&cambiar_precio&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov+'&cantidad_det='+cantidad_det+'&unidad_det='+unidad_det,'mostrar','get','0','1','','');
	
	// }
	}
}
function validar_fecha_doc(objeto){
alert(105);
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
						document.formulario.femi.disabled=true;
						
						var texto=document.formulario.condicion.options[document.formulario.condicion.selectedIndex].text;
						var temp=texto.split(" ");
						if(isNaN(parseInt(temp[1]))){
						document.formulario.fven.value=document.formulario.femi.value;
						}
						//codprod ->fven
						//document.formulario.codprod.select();
						document.formulario.btn_transp.focus();
					}else{
												
						var myDate1 = new Date(objeto.value);
						var myDate2 = new Date(document.formulario.femi.value);
						//alert(myDate1 +" "+ myDate2);
						if(compare_dates(objeto.value,document.formulario.femi.value)){
												
				//			if(objeto.value >= document.formulario.femi.value){
							document.formulario.codprod.disabled=false;
							document.formulario.codprod.focus();
							document.formulario.fven.disabled=true;
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
alert(106);
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


			
function copiarDoc(){
alert(122);
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
		
		
		document.getElementById('estado').innerHTML="INGRESO";					
		//document,formulario.condicion.focus();
		document.formulario.codprod.disabled=false;
		
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
return false;
alert(1233);
	var texto=control.options[control.selectedIndex].text;
	alert('---');
	var temp=texto.split(" ");
	var fechaEmi=document.formulario.femi.value;
	addToDate(fechaEmi, parseInt(temp[1]));
	document.formulario.fven.value=addToDate(fechaEmi, parseInt(temp[1]));
}


var tecla_guardar_aux="";
var cod="";


function validarNumero(control,e){
//alert(140);
	if(e.keyCode == 13){
		temp=control.value.split(".");
		if(temp[2]!=undefined){
			alert('Numero decimal inválido');
			control.value="";
		}
		if(temp[1]!=undefined){
			if(isNaN(temp[0])){
				alert('ingrese cantidad Valida');
				control.value="";
			}
			if(isNaN(temp[1])){
				alert('ingrese cantidad Valida');
				control.value="";
			}
		}else{
			if(isNaN(control.value)){
				alert('ingrese cantidad Valida');
				control.value="";
			}
		}
			
		if(control.value==""){
			control.focus();
			control.select();
		}
		if(control.value!=""){
		//alert(document.formulario.punit.value);
		if(control.name=='punit'){			
			doAjax('buscar_item.php','','buscar_item2','get','0','1','','');			
		}else{
		calc_pre_total();
		document.formulario.punit.focus();
		document.formulario.punit.select();	
		}
		}	
	}
}
function vaciar_sesiones2(){
		var sucursal=document.formulario.sucursal.value;
		var tienda=document.formulario.almacen.value;
		doAjax('vaciar_sesiones.php','&sucursal='+sucursal+'&tienda='+tienda,'','get','0','1','','');
		window.parent.opener.cargardatos('');
}
function buscar_item2(texto){	
//alert(28);
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
function FechaBaja(){
	if (document.formulario.ckbFecha.checked  ){
		V='';
		Fecha= hoy();	
	}else{
		V='disabled';
		Fecha='';
	}
	document.formulario.fven.disabled=V;
	document.formulario.f_trigger_b1.disabled=V;
	document.formulario.fven.value=Fecha;
}
function hoy(){
    var fechaActual = new Date();
 
    dia = fechaActual.getDate();
    mes = fechaActual.getMonth() +1;
    anno = fechaActual.getYear();
   
 
    if (dia <10) dia = "0" + dia;
    if (mes <10) mes = "0" + mes;  
 
    fechaHoy = dia + "-" + mes + "-" + anno;
   
    return fechaHoy;
}
function numero(){
var key=window.event.keyCode;
	if (key < 48 || key > 57){
	window.event.keyCode=0;
	}
}
function numerodesc(){
var key=window.event.keyCode;
	if (key < 48 || key > 57  ){
		if (key == 46){
			return false;
		}
	window.event.keyCode=0;
	}
}
function msg(texto){
	alert(texto);
}

function nuevoItem(){

window.open('../editar_producto.php?accion=grabar','','width=800,height=700,top=250,left=350,scroolbars=no,directories=no,location=no,menubar =no,titlebar=no,toolbar=no,status=yes');


}

function save_tipoImp(control,evento,id_modelo){

	if(evento.keyCode==13){
	
	 doAjax('../modelo_trasformacion/peticion_datos.php','&peticion=save_tipoImp&valor='+control.value+'&id_modelo='+id_modelo,'rpta_save_tipoImp','get','0','1','',''); 
		
	}

}

function rpta_save_tipoImp(data){
alert('guardado');
}

function removeTags(string){
  return string.replace(/(?:<(?:script|style)[^>]*>[\s\S]*?<\/(?:script|style)>|<[!\/]?[a-z]\w*(?:\s*[a-z][\w\-]*=?[^>]*)*>|<!--[\s\S]*?-->|<\?[\s\S]*?\?>)[\r\n]*/gi, '');
}


</script>
</html>
