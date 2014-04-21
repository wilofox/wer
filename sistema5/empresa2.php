<?php 
session_start();
include("conex_inicial.php");

unset($_SESSION['pagos'][0]);
unset($_SESSION['pagos'][1]); 
unset($_SESSION['pagos'][2]); 
unset($_SESSION['pagos'][3]); 
unset($_SESSION['pagos'][4]); 
unset($_SESSION['pagos'][5]); 
unset($_SESSION['pagos'][6]); 
unset($_SESSION['pagos'][7]); 

$strSQl = "select * from operacion where codigo='F0' or codigo='B0' ";
$resultado = mysql_query($strSQl,$cn);
	while($row = mysql_fetch_array($resultado)){
		$cod_doc[] = $row['codigo'];
		$des_cod_doc[] = $row['descripcion'];
		$formato_imp[] = $row['formato'];
		$cola_imp[] = $row['cola'];
		$p14[]=substr($row['p1'],13,1);
		$monto_min_precep[]=$row['min_percep'];
		
	}

mysql_free_result($resultado);

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
	
			
	
	
	$total_doc=$_REQUEST['total_doc'];
	$moneda_doc=$_REQUEST['moneda_doc'];
	$tcambio_doc=$_REQUEST['tcambio_doc'];
	$percepcion=str_replace(",","",$_REQUEST['percepcion']);
	
	//echo $percepcion;
	//$total_doc=$total_doc+$percepcion;
	if($moneda_doc==01){
		$simb_mon_doc="S/.";
		$total_sol=$total_doc;
		$total_dol=number_format($total_doc/$tcambio_doc,2);
	}else{
		$simb_mon_doc="US$.";
		$total_sol=number_format($total_doc*$tcambio_doc,2);
		$total_dol=$total_doc;
	}
	
	
?>

<script>

			var cod_doc="<?php echo $js1 ?>";
			var des_cod_doc="<?php echo $js2 ?>";
			var formato_imp="<?php echo $js3 ?>";
			var cola_imp="<?php echo $js4 ?>";
						
			var cod_doc=cod_doc.split(",");
			var des_cod_doc=des_cod_doc.split(",");
			var formato_imp=formato_imp.split(",");
			var cola_imp=cola_imp.split(",");
var tecla_guardar_aux="";			
			
//var temporal1="<?php //echo $_SESSION['caja_serie']?>";
var temporal2="<?php echo $_SESSION['user']?>";
var temporal3="<?php echo $_SESSION['terminal']?>";
var temporal4="<?php echo $_SESSION['codvendedor']?>";
var temporal5="<?php echo $_SESSION['logeado']?>";
var temporal6="<?php echo $_SESSION['nivel_usu']?>";

var control_focus="";
//alert(temporal1+" - "+temporal2+" - "+temporal3+" - "+temporal4+" - "+temporal5+" - "+temporal6);
if(temporal2=="" || temporal3=="" || temporal4=="" || temporal5=="" || temporal6==""){
close();
window.open('pedido.php?caducado=s','principal');
}

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
	font-size: 18px;
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

var version = navigator.appVersion;

function showKeyCode(e) {
	var keycode = (window.event) ? event.keyCode : e.keyCode;

	if ((version.indexOf('MSIE') != -1)) {
		if (keycode == 116) {
			event.keyCode = 0;
			event.returnValue = false;
			return false;
		}
	}
	else {
		if (keycode == 116) {
			return false;
		}
	}
}

jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_esc').addClass('dirty'); 
close()
return false; });

jQuery(document).bind('keydown', 'f3',function (evt){jQuery('#_f3').addClass('dirty'); 
	event.keyCode=0;
	event.returnValue=false;
	javascript:nuevo_auxiliar('e');
	
return false; });

jQuery(document).bind('keydown', 'f5',function (evt){jQuery('#_up').addClass('dirty');
	return false; 
});

jQuery(document).bind('keydown', 'f6',function (evt){jQuery('#_f3').addClass('dirty'); 
	//javascript:nuevo_auxiliar('e');
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



jQuery(document).bind('keydown', 'up',function (evt){jQuery('#_up').addClass('dirty');
 //alert('ee');
	//document.getElementById('TablaDatos').rows[0].style.background='#FFCC00';
	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
//	alert(document.getElementById('tblproductos').rows.length);
		if(document.getElementById('tblproductos').rows[i].style.background=='#fcf7e4' && (i!=0) ){
		document.getElementById('tblproductos').rows[i].style.background='#FFD3B7';
		document.getElementById('tblproductos').rows[i-1].style.background='#FCF7E4';
		
		if(i%6==0 && i!=0){
		capa_desplazar = $('detalle');
		capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y - 80);
		}
		
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
		
		if(i%6==0 && i!=0){
		capa_desplazar = $('detalle');
		capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y + 80);
		}
		
		
		break;
		}
		
	}
 return false; });


jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_esc').addClass('dirty'); 
/*
	if(document.getElementById('nuevo_cliente').style.visibility=='hidden'){
	document.getElementById('clientes').style.visibility='hidden';
	document.getElementById('condicion').style.visibility='visible';
	document.getElementById('tpago').style.visibility='visible';
	document.getElementById('vueltoen').style.visibility='visible';
	document.form1.ruc3.focus();
	//alert("escape");
	}
	if(document.getElementById('nuevo_cliente').style.visibility=='visible'){
	document.getElementById('nuevo_cliente').style.visibility='hidden'
	}
	*/
return false; });

 jQuery(document).bind('keydown', 'f8',function (evt){jQuery('#_f8').addClass('dirty');
 
/* if(document.form1.ruc4.value==1){
	 doAjax('lista_clientes.php','','listaprod','get','0','1','','');
	 document.getElementById('condicion').style.visibility='hidden';
	 document.getElementById('tpago').style.visibility='hidden';
	 document.getElementById('vueltoen').style.visibility='hidden';
	 }*/
	// document.formulario.pro.value=0;
//	 document.getElementById('productos').style.visibility='visible';
		 return false; }); 
/*
jQuery(document).bind('keydown', 'f7',function (evt){jQuery('#_f7').addClass('dirty');

if(document.form1.pendiente_s.value==0){

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
//	window.open('imprimir_doc.php?ruc='+ruc+'&cliente='+cliente+'&serie='+serie+'&numero='+numero+'&condicion='+condicion+'&fecha='+fecha+'&tc='+tc+'&importe='+importe+'&operacion='+operacion+'&idsesion='+idsesion+'&vuelto='+vuelto+'&moneda_v='+moneda_v+'&direccion='+direccion+'&mesa='+mesa,'ventana2','menubar=1,resizable=1,width=200, height=200');
window.open('imprimir_doc.php?ruc='+ruc+'&cliente='+cliente+'&serie='+serie+'&numero='+numero+'&condicion='+condicion+'&fecha='+fecha+'&tc='+tc+'&importe='+importe+'&operacion='+operacion+'&idsesion='+idsesion+'&vuelto='+vuelto+'&moneda_v='+moneda_v+'&direccion='+direccion+'&mesa='+mesa,"","toolbar=yes,status=no, menubar=no, scrollbars=no, width=330, height=90,left=300 top=250");
//focus();
	
	window.close();
}else{
alert('Esta pendiente un monto de: S/. '+document.form1.pendiente_s.value);
}
	
return false; }); 
	*/
	 
jQuery(document).bind('keydown', 'f7',function (evt){jQuery('#_f7').addClass('dirty');

insertar();

 return false; }); 	 
//yedem	 
function insertar(){
	
	if (document.form1.op.value==""){
	return false;
	}
	
	if(document.form1.tpersonaClie2.value!='juridica' && document.form1.op.value=='F0'){
			alert(" El cliente seleccionado no es persona Jurídica ");
			document.form1.ruc3.focus();
			return false;
	}
	
	if(document.form1.op.value.substring(0,1)=='B' && document.form1.tpersonaClie2.value!='natural' ){
			//alert(" El cliente seleccionado no es persona Natural ");
			/*
			if(confirm(" El cliente seleccionado no es persona Natural ")){
			
			}else{
			return false;
			document.form1.ruc3.focus();
			}
			*/
			//
			//				  				  
	}
		
	//alert(document.form1.ruc3.value.length);
	if(document.form1.ruc3.value!='' && document.form1.op.value=='F0'){
		
		if( (isNaN(document.form1.ruc3.value)) ||   document.form1.ruc3.value.length!=11){
		alert("El ruc ingresado no es correcto..");
		document.form1.ruc3.focus();
		return false;
		}
	}
	
	
	//alert();
	//return false;
	
	var fecha=document.form1.fecha.value;
	
	var array_fecha=fecha.split("-");
	//alert(array_fecha.length);
	
	if(array_fecha.length==3){
		  if( !isNaN(array_fecha[0]) && !isNaN(array_fecha[1]) && !isNaN(array_fecha[2]) && array_fecha[0].length==2 && array_fecha[1].length==2 && array_fecha[2].length==4 ){
				
				if( (array_fecha[0]>0 && array_fecha[0]<32) &&  (array_fecha[1]>0 && array_fecha[1]<13) && (array_fecha[2]>2000 && array_fecha[2]<2100) ){
	
				}else{
				alert("La fecha ingresada es incorrecta....formato correcto: dd-mm-aaaa");
				document.form1.fecha.focus();document.form1.fecha.select();
				return false();
				}
		  }else{
		  alert("La fecha ingresada es incorrecta....formato correcto: dd-mm-aaaa");
		  document.form1.fecha.focus();document.form1.fecha.select();
		  return false();
		  }
	}else{
	alert("La fecha ingresada es incorrecta....formato correcto: dd-mm-aaaa");
	document.form1.fecha.focus();document.form1.fecha.select();
	return false();
	}

	if (temporal_teclas=="") {
	var total_doc=document.form1.importe.value;
		if(total_doc!=0){
			temporal_teclas='grabar';
			grabar_doc();
			//alert('grabo');
		}else{
			alert('No se puede guardar este documento');			
		}	
	}else{
		event.keyCode=0;
		event.returnValue=false;
	}
}

function grabar_doc(){
				
		
			//var total_doc=document.form1.importe.value;
			var total_doc="<?php echo $total_doc?>";
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
			
			var percepcion=document.form1.percepcion.value;
			
			
			var correlativo_ref="";
			var serie_ref="";
			var cod_cab_ref="";
			var doc=document.form1.op.value;
			var serie="";
			var numero="";
			//var auxiliar="";
			
			//alert(serie_ref);
			var obs1="";
			var obs2="";
			var obs3="";
			var obs4="";
			var obs5="";
			
			var kardex_doc="S";			
			var act_kardex_doc="N";						
			//document.form1.accion2.value="grabar";
			
			//alert(document.getElementById('estado').innerHTML);
			  
//mostrar_grabacion("");
	var codcabOE=document.form1.codcabOE.value;
	
	
	//alert(condicion);
	//return false;
	
	doAjax('compras/peticion_datos.php','&temp_doc='+temp_doc+'&responsable='+responsable+'&tipomov='+tipomov+'&tienda='+tienda+'&condicion='+condicion+'&femision='+femision+'&fvencimiento='+fvencimiento+'&monto='+monto+'&impuesto1='+impuesto1+'&total_doc='+total_doc+'&incluidoigv='+incluidoigv+'&auxiliar='+auxiliar+'&tmoneda='+tmoneda+'&tcambio='+tcambio+'&peticion=save_ptoventa'+'&sucursal='+sucursal+'&correlativo_ref='+correlativo_ref+'&serie_ref='+serie_ref+'&obs1='+obs1+'&obs2='+obs2+'&obs3='+obs3+'&obs4='+obs4+'&obs5='+obs5+'&cod_cab_ref='+cod_cab_ref+'&kardex_doc='+kardex_doc+'&act_kardex_doc='+act_kardex_doc+'&doc='+doc+'&serie='+serie+'&numero='+numero+'&auxiliar='+auxiliar+'&impto='+impto+'&vuelto='+vuelto+'&moneda_v='+moneda_v+'&codcabOE='+codcabOE+'&percepcion='+percepcion,'mostrar_grabacion','get','0','1','','');
								
			}else{
			alert('No se puede guardar el documento sin  detalle');						
			}
	
}


function mostrar_grabacion(texto){
		
		//alert(texto);
		
		if(texto=='error_imp'){
		alert('Usuario no Autorizado....');
		window.close();
		return false;
		}
		
		
		if(texto=='error'){
		
			alert('Documento no grabó.....Verifique su conexión de red.');
			
			window.close();
			window.parent.opener.recargar();
			return false;
			
		}
		
		var xtemp=texto.split(":");
				
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
		
			//if(document.formulario.temp_imp.value=='S'){
			//imprimir();
			//}
			
			
			//alert("imprimiendo...");
			var cola_imp=document.form1.cola_imp.value;
			var formato=document.form1.formato_imp.value;
			var vuelto=document.form1.vuelto.value;
			
			//window.open("colaImp.php?cod_cab="+xtemp[1]+"&formato="+formato+"&cola_imp="+cola_imp,"","width=10,height=10,top=0,left=0,scroolbars=no,directories=no,location=no,menubar =no,titlebar=no,toolbar=no");

			var win00=window.open('formatos/'+formato+'?codcab='+xtemp[1]+'&vuelto='+vuelto,'ventana2','width=650,height=500,top=100,left=100,scroolbars=yes,status=yes');
			//window.returnValue=true
			window.close();
			window.parent.opener.recargar();
			
	   }

//document.formulario.pruebas.value=texto;

}


	 
function imprimir(sucursal,doc,serie,numero){
	
	//var formato=find_prm(tab_formato,tab_cod);
	//var impresion=find_prm(tab_impresion,tab_cod);
	
/*	var cola_imp=document.form1.cola_imp.value;
	var formato=document.form1.formato_imp.value;
	
	
	if(serie!='' && formato!=''){ 
	var win00=window.open('formatos/'+formato+'?empresa='+sucursal+'&doc='+doc+'&serie='+serie+'&numero='+numero+'&impresion='+impresion+'&cola_imp='+cola_imp ,'ventana2','width=850,height=1000,top=100,left=100,scroolbars=yes,status=yes');	
	
	win00.focus();
	
	}else{
	alert('No es posible imprimir');
	}
	*/
	
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



jQuery(document).bind('keydown', 'f9',function (evt){jQuery('#_f9').addClass('dirty');

	if(document.form1.op.value==cod_doc[0]){
		/*
		if(document.form1.cliente.value!='' &&  document.form1.ruc3.value=='' ){
		alert("El cliente seleccionado no tiene ruc...");
		return false;
		}
		*/	
		
		document.form1.op.value=cod_doc[1];
		document.form1.formato_imp.value=formato_imp[1];
		document.form1.cola_imp.value=cola_imp[1];		
		document.getElementById('boleta').childNodes[0].innerHTML=des_cod_doc[1];
	//	document.form1.ruc3.value="";
		document.form1.ruc3.disabled=false;
		document.form1.ruc3.focus();
		document.form1.ruc3.select();
		
		var	p14="<?php echo $p14[1] ?>";
	    var	monto_min_precep="<?php echo $monto_min_precep[1] ?>";
		var total_doc="<?php echo $total_doc ?>";
		//$monto_min_precep[]=$row['min_percep'];
		var percepcion=parseFloat("<?php echo $percepcion ?>");
		var totalProdPercep="<?php echo $_REQUEST['totalProdPercep'] ?>";		
		
		if(p14=='S' && monto_min_precep <= totalProdPercep ){		
		document.form1.importe.value=(parseFloat(total_doc)+parseFloat(percepcion)).toFixed(2);
		document.form1.percepcion.value=parseFloat(percepcion).toFixed(2);
		}else{
		document.form1.importe.value=parseFloat(total_doc).toFixed(2);
		document.form1.percepcion.value=0;
		
		}	
		
	}else{
		if(document.form1.op.value==cod_doc[1]){
/*		document.form1.op.value=cod_doc[2];
		document.form1.formato_imp.value=formato_imp[2];
		document.form1.cola_imp.value=cola_imp[2];
		document.getElementById('boleta').childNodes[0].innerHTML=des_cod_doc[2];
	//	document.form1.ruc3.value="";
		document.form1.ruc3.disabled=true;
	///	document.form1.direc.value="";	
	//	document.form1.direc2.value="";	
	//	document.form1.cliente.value="000001";
	//	document.form1.cliente2.value="varios";	
	//	document.form1.soles.focus();
	//	document.form1.soles.select();
		//enfocar_montos();
		}else{*/
				document.form1.op.value=cod_doc[0];
				document.form1.formato_imp.value=formato_imp[0];
				document.form1.cola_imp.value=cola_imp[0];
				document.getElementById('boleta').childNodes[0].innerHTML=des_cod_doc[0];	
		//		document.form1.ruc3.value="";
				document.form1.ruc3.disabled=true;	
		//		document.form1.direc.value="";	
		//		document.form1.direc2.value="";	
		//		document.form1.cliente.value="000001";
		//		document.form1.cliente2.value="varios";	

				//document.form1.soles.focus();
				//document.form1.soles.select();
			//	enfocar_montos();
			
			var	p14="<?php echo $p14[0] ?>";
			var	monto_min_precep="<?php echo $monto_min_precep[0] ?>";
			var total_doc="<?php echo $total_doc ?>";
			//$monto_min_precep[]=$row['min_percep'];
			var percepcion=parseFloat("<?php echo $percepcion ?>");
			
			var totalProdPercep="<?php echo $_REQUEST['totalProdPercep'] ?>";
			
			if(p14=='S' && monto_min_precep <= totalProdPercep ){		
			document.form1.importe.value=(parseFloat(total_doc)+parseFloat(percepcion)).toFixed(2);
			document.form1.percepcion.value=parseFloat(percepcion).toFixed(2);
			}else{
			document.form1.importe.value=parseFloat(total_doc).toFixed(2);
			document.form1.percepcion.value=0;
			
			}
			
				
		}
			
	}
	
	
	var operacion=document.form1.op.value;
	doAjax('generarnumero.php','operacion='+operacion+'&sucursal='+	document.form1.sucursal.value,'gen_numero','get','0','1','','');
	
	
return false; }); 


jQuery(document).bind('keydown', 'f10',function (evt){jQuery('#_f10').addClass('dirty');
 
 ver_clientes();
return false; }); 


</script>

<script>

function enfocar_montos(){

/*	if(document.form1.soles.value=='' || document.form1.soles.value==0){
	document.form1.dolares.disabled=false;
	document.form1.dolares.select();
	document.form1.dolares.focus();
	}else{
	document.form1.soles.disabled=false;
	document.form1.soles.select();
	document.form1.soles.focus();
	}*/

}


function enfocar(){
//alert("entro");
  //document.form1.ruc3.focus();
    
//window.opener.recargar();
//window.opener.refresh();
//window.opener.document.forms['formulario'].reset();
	
	var operacion="<?php echo $cod_doc[0]?>";
	
			var	p14="<?php echo $p14[0] ?>";
			var	monto_min_precep="<?php echo $monto_min_precep[0] ?>";
			var total_doc="<?php echo $total_doc ?>";
			//$monto_min_precep[]=$row['min_percep'];
			var percepcion=parseFloat("<?php echo $percepcion ?>");
			
			var totalProdPercep=parseFloat("<?php echo $_REQUEST['totalProdPercep'] ?>");
			//alert(monto_min_precep+"<---->"+totalProdPercep);								
			if(p14=='S' && monto_min_precep <= totalProdPercep ){
			document.form1.importe.value=(parseFloat(total_doc)+parseFloat(percepcion)).toFixed(2);
			document.form1.percepcion.value=parseFloat(percepcion).toFixed(2);
			}else{
			document.form1.importe.value=parseFloat(total_doc).toFixed(2);
			document.form1.percepcion.value=0;			
			}			
	
	doAjax('generarnumero.php','operacion='+operacion+'&sucursal='+	document.form1.sucursal.value,'gen_numero','get','0','1','','');
	document.form1.op.value=operacion;
	document.getElementById('boleta').childNodes[0].innerHTML=des_cod_doc[0];
	
	
	if(document.form1.moneda_doc.value==01){
	document.form1.soles.value=document.form1.importe.value;
	document.form1.soles.select();
	}else{
	document.form1.dolares.value=document.form1.importe.value;
	document.form1.dolares.select();
	}
	
	//document.form1.ruc3.focus();

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
//alert();
var tc_doc=document.form1.tc.value;

document.form1.acuenta.value=parseFloat(r[1].replace(',','')).toFixed(2);
//alert(r[1]);

//alert();
if(document.form1.moneda_doc.value==02){

	var temp=parseFloat(document.form1.total_s.value.replace(',',''))-(parseFloat(r[1].replace(',',''))*tc_doc).toFixed(2);

	var temp2=parseFloat(document.form1.total_d.value.replace(',','')) - parseFloat(r[1].replace(',',''));
	//alert(r[1]);
	//alert(parseFloat(document.form1.total_s.value.replace(',','')) );
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
		
 		var pendiente_s=parseFloat(document.form1.total_s.value)-r[1];
		var pendiente_d=parseFloat(document.form1.total_d.value)-(parseFloat(r[1]).toFixed(2)/tc_doc).toFixed(2);
		if(pendiente_s < 0 || pendiente_d < 0){
		document.form1.pendiente_s.value=0;
		document.form1.pendiente_d.value=0;
		//alert();
		//alert(document.getElementById('tbl_pagos').rows.length);
	//	document.form1.vuelto.value=;
		calcular_vuelto();
		}else{
		//alert();
		document.form1.pendiente_s.value=pendiente_s.toFixed(2);
		document.form1.pendiente_d.value=pendiente_d.toFixed(2);	
		document.form1.vuelto.value="0.00";	
		}
	
}
//document.form1.pendiente_s.value=


//doAjax('calcular.php','accion=acuenta','calcular_acuenta','get','0','1','','');
//doAjax('calcular.php','accion=vuelto&importe='+document.form1.importe.value,'calcular_vuelto','get','0','1','','');
//alert();
control_focus.select();
control_focus.focus();

}

function calcular_acuenta(texto){
//alert(texto);
var r = texto;
document.form1.acuenta.value=r;
}

function calcular_vuelto(){

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
			//alert(vuelto);
			
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
		
		document.form1.vuelto.value=vuelto_total.toFixed(2);

}

function gen_numero(texto){

var cadena=texto.split('-');
document.form1.numero.value=cadena[0];
document.form1.serie.value=cadena[1];

cbo_cond();
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
	/*
		if(document.getElementById('clientes').style.visibility=='hidden'){
		doAjax('lista_clientes.php','','listaprod','get','0','1','','');
		document.getElementById('condicion').style.visibility='hidden';
		document.getElementById('tpago').style.visibility='hidden';
		document.getElementById('vueltoen').style.visibility='hidden';
		}
	 	
		doAjax('detalle_clie.php','&nomb_det='+control.value,'detalle_prod','get','0','1','',''); 
	*/
	//alert(control.value);
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
	document.form1.tpersonaClie2.value=valor[4];
	document.form1.ruc3.disabled=true;
	
/*		if(document.form1.moneda_doc.value=='02'){
			document.form1.dolares.select();
			document.form1.dolares.focus();
			}else{
			document.form1.soles.select();
			document.form1.soles.focus();
		}*/
	
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
doAjax('generarnumero.php','operacion=F0&servicio='+document.form1.servicio.value+'&sucursal='+	document.form1.sucursal.value,'gen_numero','get','0','1','','');
document.form1.op.value='F0';
//alert(texto);
}


</script>

<?php 
$total=0;
//$tc=3.040;
$fecha=date('d-m-Y',time()-3600);
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
if ($_REQUEST['codcliente']<>''){
	$sqlCli="select * from cliente where codcliente='".$_REQUEST['codcliente']."'  ";
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
window.parent.opener.formulario.ruc2.value="0";
window.parent.opener.datos="";
}


</script>
<body  onLoad="enfocar();" onBlur="cambiar()" onUnload="cerrar()" onkeydown="return showKeyCode(event)">
<table width="584" height="236" border="0" bgcolor="#FFFFFF">
  <tr>
    <td width="574" height="232" colspan="5" valign="top">
	
	<form id="form1" name="form1" method="post" action="" >
      <table width="574" height="215" border="0" cellpadding="0" cellspacing="0">
        <tr bgcolor="#6699CC">
          <td height="39" bgcolor="#004993">&nbsp;</td>
          <td colspan="2" bgcolor="#004993"><table width="286" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td colspan="4" height="5"></td>
              </tr>
            <tr>
              <td width="22"><span class="Estilo48">F7 = </span></td>
              <td width="117"><span class="Estilo49">Guadar</span></td>
              <td width="110">&nbsp;</td>
              <td width="37">&nbsp;</td>
            </tr>
            <tr>
              <td><span class="Estilo48">F9 = </span></td>
              <td><span class="Estilo49">Cambiar Documento </span></td>
              <td><span class="Estilo48">F10=</span> <span class="Estilo49">Ver Clientes </span></td>
              <td>&nbsp;</td>
            </tr>
          </table>            
            <label for="textfield"></label></td>
          <td align="right" bgcolor="#004993"><span class="Estilo25">Importe(<?php echo $simb_mon_doc ?>)</span>
            <input  style="text-align:right; font:bold ; font-size:12px" readonly="readonly"  name="importe" type="text" id="importe" size="10" value="<?php echo $total_doc?>" />
            <input  name="importe2" type="hidden" id="importe2" size="10" value="<?php echo $total;?>" />
            <span class="Estilo15">
            <input  name="op" type="hidden" id="op" size="10" value="" />
			
			<input  name="percepcion" type="hidden" id="percepcion" size="10" value="<?php echo $_REQUEST['percepcion']?>" />
            </span></td>
          </tr>
        <tr>
          <td width="20" height="34" >&nbsp;</td>
          <td width="85"><span class="Estilo15">Ruc:
            <input name="mesa" type="hidden" id="mesa" size="10" maxlength="10" value="<?php echo $_REQUEST['mesa']?>">
            <input name="registro" type="hidden" size="10" maxlength="10" value="<?php echo $_REQUEST['registro']?>">
          </span></td>
          <td width="269"><label for="textfield"></label>
            <input name="ruc3" type="text"  id="ruc3"  onFocus="cambiardoc4()"  onBlur="cambiardoc3()" onChange="cambiardoc2()" onKeyUp="validartecla(event,this)" value="<?=$ruccli;?>" size="10" maxlength="11"/>
            <input id="ruc4" type="hidden" name="ruc4" value="1" >
            <input name="moneda_doc" id="moneda_doc" type="hidden" size="3" maxlength="5" value="<?php echo $moneda_doc?>">
            <input name="sucursal" id="sucursal" type="hidden" size="3" maxlength="5" value="<?php echo $_REQUEST['sucursal']?>">
            <input name="tienda" id="tienda" type="hidden" size="3" maxlength="5" value="<?php echo $_REQUEST['tienda']?>">
            <input name="responsable" id="responsable" type="hidden" size="3" maxlength="5" value="<?php echo $_REQUEST['responsable']?>">
            <input name="incluidoigv" id="incluidoigv" type="hidden" size="3" maxlength="5" value="<?php echo $_REQUEST['incluidoigv']?>">
            <input name="impto" id="impto" type="hidden" size="3" maxlength="5" value="<?php echo $_REQUEST['impto'] ?>">
            <input name="impuesto1" id="impuesto1" type="hidden" size="3" maxlength="5" value="<?php echo $_REQUEST['impuesto1'] ?>">
            <input name="baseimp" id="baseimp" type="hidden" size="3" maxlength="5" value="<?php echo $_REQUEST['baseimp'] ?>">
            <input name="cola_imp" id="cola_imp" type="hidden" size="3" maxlength="5" value="<?php echo $cola_imp[0]?>">
            <input type="hidden" name="codcabOE" id="codcabOE" value="<?php echo $_REQUEST['codcabOE']?>">
			<input type="hidden" name="tpersonaClie2" id="tpersonaClie2" value="natural">
			
			</td>
          <td align="center" valign="middle"><div id="boleta" style="display:block;"><span class="Estilo54 Estilo58"><span class="Estilo61"> </span></span></div>
		    <!-- <div style="display:none" id="factura"><span class="Estilo1">FACTURA </span></div>--></td>
          </tr>
        <tr>
          <td height="22">&nbsp;</td>
          <td><span class="Estilo15">Cliente</span></td>
          <td><input name="cliente"  type="hidden" id="cliente" size="5" maxlength="5" value="<?=$codcli;?>" />
            <input name="cliente2" disabled="disabled"  type="text" id="cliente2" size="30" maxlength="200" value="<?=$razcli;?>" />
            <input name="tope" type="hidden" value="A" >
            <img style="cursor:pointer" onClick="ver_clientes()" src="imagenes/ico_lupa.jpg" width="15" height="15"></td>
		  <td><input name="formato_imp" id="formato_imp" type="hidden" size="3" maxlength="5" value="<?php echo $formato_imp[0]?>">
            <input name="vuelto" type="hidden" style="text-align:right; vertical-align:middle; font:bold; font-size:22px; height:40px" size="6" readonly="readonly">
            <input   style="text-align:right; font:bold ; font-size:12px" name="total_s" type="hidden" size="10" readonly="readonly" value="<?php echo $total_sol; ?>" />
            <input style="text-align:right; font:bold ; font-size:12px" name="total_d" type="hidden" size="10" readonly="readonly" value="<?php echo $total_dol; ?>" />
            <input style="text-align:right; font:bold ; font-size:12px" name="acuenta" type="hidden" size="10" readonly="readonly" value="0.00">
            <input readonly="readonly" style="text-align:right; font:bold ; font-size:12px" name="pendiente_s" id="pendiente_s" type="hidden" size="10" value="<?php echo $total_sol;?>">
            <input readonly="readonly" style="text-align:right; font:bold ; font-size:12px" name="pendiente_d" id="pendiente_d" type="hidden" size="10" value="<?php echo $total_dol ?>">
            <span class="Estilo15">
            <input name="servicio" type="hidden" size="5" maxlength="5" value="<?php echo $servicio?>">
            </span></td>
          </tr>
		<tr>
          <td height="22">&nbsp;</td>
          <td><span class="Estilo15">Direcci&oacute;n</span></td>
          <td><input  name="direc" type="hidden" id="direc" size="20" value="" />
            <input name="direc2" disabled="disabled"  type="text" id="cliente3" size="30" maxlength="200" value="<?=$dircli;?>" />
            <input type="hidden" name="tpago2" value="0"></td>
          <td width="200"><div style="visibility:hidden">
            <select  style=" visibility:hidden" name="vueltoen" onChange="calcular_vuelto()">
              <option value="01">SOLES  (S/.)</option>
              <option value="02">DOLARES (US$)</option>
            </select>
			</div></td>
          </tr>
        <tr>
          <td height="22">&nbsp;</td>
          <td><span class="Estilo15">N&uacute;mero</span></td>
          <td><input name="serie" readonly="readolny"  type="text" id="serie" size="5" maxlength="11" value=""/>
            <input name="numero" readonly="readonly"  type="text" id="numero" size="10" maxlength="11"  value=""/></td>
          <td align="center" ><span style="padding-left:45px">
            <input onClick="insertar()" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(imagenes/boton_aplicar.gif) ; cursor:pointer; font:bold; font-size:11px" type="button" name="Submit" value="Guardar" >
          </span></td>
          </tr>
        <tr>
          <td height="22">&nbsp;</td>
          <td><span class="Estilo15">Condici&oacute;n</span></td>
          <td><table width="269" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="141">
			<?
			$condicionRk=$_REQUEST['condicionRk'];
			if ($condicionRk=='RA'){
				echo "<select name='condicion' style='width:120' >
						<option value='1'>contado</option>
					  </select>";
			}else{
				echo '<div id="cbo_cond" style="width:">
				           
					  </div>';
			}
			?>           </td>
              <td width="97"> <span class="Estilo15">T.C.</span>
            <input name="tc"  style="color:#990000; font:bold ; text-align:right"type="text" id="tc" size="5" maxlength="6" value="<?php echo $tc?>" /></td>
            </tr>
          </table>		 </td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td height="22">&nbsp;</td>
          <td><span class="Estilo15">Fecha Doc. </span></td>
          <td><input readonly="readonly" name="fecha" type="text" id="fecha" size="9" maxlength="10" value="<?php echo $fecha?>" />
            <span class="Estilo15">&nbsp;&nbsp;Fecha Venc. &nbsp;
            <input readonly="readonly" name="fecha2" type="text" id="fecha2" size="9" maxlength="10" value="<?php echo $fecha?>" />
            </span></td>
          <td>&nbsp;</td>
          </tr>
        
        <tr>
          <td height="2" colspan="4"></td>
          </tr>
        <tr>
          <td colspan="4" height="2"></td>
          </tr>
        <tr>
          <td height="2" colspan="4" align="center">
		  
		  <table style="display:none" width="511" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td width="507" align="right" bgcolor="#E5E5E5"><label></label>
              <table  width="561" height="51" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="142"><span class="Estilo27">T. Pago </span></td>
                  <td width="63"><span class="Estilo27">Numero</span></td>
                  <td width="62"><span class="Estilo27">Soles</span></td>
                  <td width="68"><span class="Estilo27">Dolares</span></td>
                  <td width="84"><span class="Estilo27">Fecha</span></td>
                  <td width="66"><span class="Estilo27">T.Cambio</span></td>
                </tr>
                <tr>
                  <td height="35">
<select  id="tpago" name="tpago" onChange="colocar();" >
 <?
 /*<select  id="tpago" name="tpago" onChange="colocar();" onFocus="enfocar_tpago()">
                      <option value="1">Efectivo</option>
                      <option value="2">Visa</option>
                      <option value="3">Visa Electron</option>
		              <option value="4">Mastercard</option>
		              <option value="5">American Express</option>
					  <option value="6">Ripley</option>
                    </select> */
 //onFocus="enfocar_tpago()"
$strSQL="select * from t_pago where id<7 order by id ";		  
$resultado=mysql_query($strSQL,$cn);	
while($row=mysql_fetch_array($resultado)){
	echo "<option value=".$row['id'].">".$row['descripcion']."</option>"	;
}
  ?>
</select>					                 </td>
                  <td><input name="numero_tarjeta" type="text" size="8" maxlength="15"></td>
    <td>
	<input name="soles" type="text" size="8" maxlength="15" value="0"  onFocus="cargar_monto(this)" onKeyPress="c_soles(event,this)">	</td>
                  <td>
				  <input name="dolares" type="text" size="8" maxlength="15" value="0" onKeyPress="c_dolares(event,this)">				  </td>
				  <td><input readonly="readonly" name="fecha_det_pago" id="fecha_det_pago" type="text" size="8" maxlength="15" value="<?php echo $fecha?>" >
			
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
				  <td><input readonly="readonly" name="tcambio_det_pago" id="tcambio_det_pago" type="text" size="8" maxlength="15" value="<?php echo $tc?>" ></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td colspan="4" height="5"></td>
          </tr>
        <tr>
          <td height="2" colspan="4" valign="top"><div id="pagos_d" style="display:none">
            <table width="480" align="center" border="0" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF" >
              <tr   style="background-color:#1789DD">
                <td width="20" ><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tipo</font></strong></td>
                <td width="70" align="center"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">T.pago</font></strong></td>
                <td align="center" width="80"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">Numero</font></strong></td>
                <td align="center" width="80"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">Soles</font></strong></td>
                <td align="center" width="80"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">T.c</font></strong></td>
                <td align="center" width="80"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">Dolares</font></strong></td>
                <td align="center" width="110"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">Fecha</font></strong></td>
                <td align="center" width="20"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">E</font></strong></td>
              </tr>
             
              <tr>
                <td width="112" align="center" bgcolor="#F4F4F4">&nbsp;</td>
                <td width="112" align="center" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px">
                  
                </font></td>
                <td width="112" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px"></font></td>
                <td width="112" align="right" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px">
                 
                </font></td>
                <td width="63" align="center" bgcolor="#F4F4F4">&nbsp;</td>
                <td width="79" align="right" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px">
                
                </font></td>
                <td width="80" align="center" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px"></font> </td>
                <td width="63" align="center" bgcolor="#F4F4F4"></td>
              </tr>
            </table>
          </div></td>
          </tr>
        
        
        <tr>
          <td height="2" colspan="4"></td>
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

	if(document.form1.tpago.value!=1){
		document.form1.soles.value=document.form1.importe2.value;
			document.form1.tpago2.value=1;
	}
	
}

function enfocar_tpago(){
document.form1.tpago2.value=1;
	if(document.form1.ruc3.value==""){
	document.form1.op.value='B0';
	}else{
	document.form1.op.value='F0';
	}

	doAjax('generarnumero.php','operacion='+document.form1.op.value+'&servicio='+document.form1.servicio.value+'&sucursal='+	document.form1.sucursal.value,'gen_numero','get','0','1','','');
	
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
	//alert('pagos_det.php?tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares);
doAjax('pagos_det.php','tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares+'&moneda_v='+moneda_v+'&tope='+tope+'&fecha_det_pago='+fecha_det_pago+'&tcambio_det_pago='+tcambio_det_pago+'&moneda_doc='+moneda_doc+'&acuenta='+acuenta,'lista_pago','get','0','1','','');

//doAjax('calcular.php','accion=acuenta','calcular_acuenta','get','0','1','','');

	}

}

function c_dolares(e,control){
//document.form1.soles.disabled=true;
control_focus=control;
document.form1.soles.value=0;

	if(e.keyCode == 13){
	
	if(control.value==0 || control.value==''){
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
	//alert('pagos_det.php?tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares);
doAjax('pagos_det.php','tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares+'&moneda_v='+moneda_v+'&tope='+tope+'&fecha_det_pago='+fecha_det_pago+'&tcambio_det_pago='+tcambio_det_pago+'&moneda_doc='+moneda_doc+'&acuenta='+acuenta,'lista_pago','get','0','1','','');
	
	
	
	/*
	var tpago=document.form1.tpago.value;
	var numero=document.form1.numero_tarjeta.value;
	var soles=document.form1.soles.value;
	var dolares=document.form1.dolares.value;
	var moneda_v=document.form1.vueltoen.value;
	var tope=document.form1.tope.value;
	var fecha_det_pago=document.form1.fecha_det_pago.value;
	var tcambio_det_pago=document.form1.tcambio_det_pago.value;
	var moneda_doc=document.form1.moneda_doc.value;
	//alert('pagos_det.php?tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares);
doAjax('pagos_det.php','tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares+'&moneda_v='+moneda_v+'&moneda_doc='+moneda_doc,'lista_pago','get','0','1','','');
*/

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
	doAjax('generarnumero.php','operacion=F0&servicio='+document.form1.servicio.value+'&sucursal='+	document.form1.sucursal.value,'gen_numero','get','0','1','','');
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
//document.getElementById('condicion').style.visibility='visible';
//document.getElementById('tpago').style.visibility='visible';
//document.getElementById('vueltoen').style.visibility='visible';
//document.form1.soles.select();
//document.form1.soles.focus();
	
	
	
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

function eliminar_pagos(codigo){
	var respuesta=confirm("confirma que desea eliminar este dato?")
	var acuenta=document.form1.acuenta.value;
	var moneda_doc=document.form1.moneda_doc.value;
		if(respuesta)
		{
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
var temp2="";
var temp;
function entrada(objeto){

	objeto.cells[0].childNodes[0].checked=true;
	document.form_clientes.cod_aux_sel.value=objeto.cells[1].childNodes[0].innerHTML;
	document.form_clientes.nom_aux_sel.value=objeto.cells[2].childNodes[0].innerHTML;
	document.form_clientes.ruc_aux_sel.value=objeto.cells[3].childNodes[0].innerHTML;
	document.form_clientes.dir_aux_sel.value=objeto.cells[1].childNodes[0].innerHTML;
	document.form_clientes.dir_aux_sel2.value=objeto.cells[5].childNodes[0].innerHTML;
	document.form_clientes.tpersonaClie.value=objeto.cells[6].childNodes[0].innerHTML;

	temp=objeto;
	if(objeto.style.background=='url(sky_blue_sel.png)'){
		//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='url(sky_blue_sel.png)';
		if(temp2!=''){
		/*alert(temp.style.background);
		alert(objeto.bgColor);*/
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
		 document.form1.condicion.disabled=false;
		 
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
	
	//var t_personaClie=temp4[22];
	
	
		//if(document.form1.op.value=='F0' && document.form_clientes.ruc_aux_sel.value==''){
		if(document.form1.op.value=='F0' && document.form_clientes.tpersonaClie.value!='juridica'){
			alert(" Cliente seleccionado no es persona Jurídica");
			return false;	
		}
		if(document.form1.op.value.substring(0,1)=='B' && document.form_clientes.tpersonaClie.value!='natural'){
		
			if(confirm(" El cliente seleccionado no es persona Natural ")){
			
			}else{
			return false;
			//document.form1.ruc3.focus();
			}
			
		 }
		
		document.form1.cliente.value=document.form_clientes.cod_aux_sel.value;
		document.form1.cliente2.value=document.form_clientes.nom_aux_sel.value;
		document.form1.cliente3.value=document.form_clientes.dir_aux_sel2.value;
		document.form1.ruc3.value=document.form_clientes.ruc_aux_sel.value;
		
		document.form1.tpersonaClie2.value=document.form_clientes.tpersonaClie.value;
		
		document.form1.ruc3.disabled=true;
		
			/*if(document.form1.moneda_doc.value=='02'){
			document.form1.dolares.select();
			document.form1.dolares.focus();
			}else{
			document.form1.soles.select();
			document.form1.soles.focus();
			}*/
		Modalbox.hide(); return false;
	}
	
	function enfocar_cbo(){ }
	function limpiar_enfoque(){ }
	var cod="";
	function nuevo_auxiliar(ts){
	//Modalbox.hide();
	//alert();
	//alert(t);
	var ope=document.form1.op.value;
		if(cod=="" && ts=="e"){
	
			//alert(document.form_clientes.cod_aux_sel.value);
		
			cod=document.form_clientes.cod_aux_sel.value;
		}
		var randomnumber=Math.floor(Math.random()*99996);
		
		Modalbox.show('nuevo_auxiliar.php?ptovta34&cod='+cod+'&tip='+ts+'&ran='+randomnumber+'&ope='+ope, {title: 'Nuevo Auxiliar( CLIENTES )', width: 500});return false; 
	}
	
	function  guardar_aux(rta){
	
	//alert(rta);
	//return false;
	
	if(tecla_guardar_aux==""){
	tecla_guardar_aux="S";
	//alert(rta);
	//alert(cod);
	//var cod=temp.childNodes[1].childNodes[0].innerHTML;
	var ruc=document.form_clientes.ruc_aux.value;
	var dni=document.form_clientes.dni_aux.value;
	var razon=document.form_clientes.razonsocial_aux.value;
	var contacto=document.form_clientes.contacto_aux.value;
	var direccion=document.form_clientes.direccion_aux.value;
				
	var persona=document.form_clientes.persona_aux.value;
	document.form1.tpersonaClie2.value=persona;
	
	if(razon==""){
	alert("Debe Ingresar el nombre del cliente o la razon social");
	return false;
	}
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
	if(persona=="juridico" && ruc==""){
	alert("Debe Ingresar el número de ruc");
		return false;
	}
	/*if(persona=="natural" && (ruc=="" && dni=="") ){
	alert("Debe Ingresar el número un número de documento");
	return false;
	}*/
	
	
	
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
	
	razon=razon.replace('&','amps');
	
		doAjax('compras/peticion_datos.php','&codClie='+cod+'&accionAux='+rta+'&ruc='+ruc+'&dni='+dni+'&razon='+razon+'&contacto='+contacto+'&direccion='+direccion+'&persona='+persona+'&tipo_aux='+tipo_aux+'&peticion=save_aux','rspta_aux','get','0','1','','');
	//doAjax('compras/peticion_datos.php','&ruc='+ruc+'&dni='+dni+'&razon='+razon+'&contacto='+contacto+'&direccion='+direccion+'&persona='+persona+'&tipo_aux='+tipo_aux+'&peticion=save_aux','rspta_aux','get','0','1','','');
		//}
	}else{ 
	}
	
	}
	function rspta_aux(texto) {
	//alert();
	var temp=texto.split("?");
	
	if(temp[2]>=1){
	alert(" El ruc digitado ya existe con:  " + temp[1]);
	return false;
	}	
	document.form1.cliente.value=document.form_clientes.codigo_aux.value;
	document.form1.cliente2.value=document.form_clientes.razonsocial_aux.value;
	document.form1.ruc3.value=document.form_clientes.ruc_aux.value;
	document.form1.direc2.value=document.form_clientes.direccion_aux.value;
	document.form1.ruc3.disabled=true;
	
	Modalbox.hide();return false;
		
	}

	function sumarFechaVen(){
		//alert();
	}
	
	function keyValidarRuc(e){
		  
	  if(e.keyCode==13){
	  VerificadorRuc();
	  }
	}


//----------------------------------------------------------------------------


function sumarFechaVen(control){
//alert();
	
	//permiso_vcredio
	//control.options[control.selectedIndex];
	
	/*
	var tempPerm1=document.formulario.deudaCond.value.split("|");
	var tempPerm2=tempPerm1[1].split("-");
	if(tempPerm2[control.selectedIndex]=='S' && permiso_vcredio=='N'){
	alert("Usuario no autorizado para ventas al crédito");
	return false;
	}
*/
	var texto=control.options[control.selectedIndex].text;
		
	var temp=texto.split(" ");
	//alert(temp[1]);
	var fechaEmi=document.form1.fecha.value;
	addToDate(fechaEmi, parseInt(temp[1]));
//	alert(fechaEmi+" "+parseInt(temp[1]));
//	alert(addToDate(fechaEmi, parseInt(temp[1])));
document.form1.fecha2.value=addToDate(fechaEmi, parseInt(temp[1]));
}

//-----------------sumar fechas 7----------------------------------

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



//---------------------------------------------------------------------------


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

</script>

<?php mysql_close($cn);?>