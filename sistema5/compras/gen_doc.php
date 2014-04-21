<?php 
	session_start();
	include('../conex_inicial.php');
	$_SESSION['registro']=rand(100000,999999);

	if($_REQUEST['tipomov']==1){
		$aux="Proveedor";
		$titulo="Logística :: Compras - Ingresos";
	}else{
		$aux="Cliente";
		$titulo="Ventas :: Ventas - Salidas";
	}
	
	
	//---------------------------------------------------------------------------



$fecha1=date("Y-m-d");
$fecha2=date("Y-m-d");

//$fecha1="2012-03-01";
//$fecha2="2012-03-01";

$responsable=$_SESSION['codvendedor'];

	//$rowd=mysql_fetch_array(mysql_query("select meta from usuarios where codigo='".$responsable."' ",$cn));
	//$meta=$rowd['meta'];
	/*
	$rowd2=mysql_fetch_array(mysql_query("select * from utilxvendedor where usuario='".$responsable."' ",$cn));
	 $meta=$rowd2['meta'];
*/
	$strSQL="select * from cab_mov c,det_mov d where d.cod_cab=c.cod_cab and substring(c.fecha,1,10) between '$fecha1' and '$fecha2' and flag!='A' and cod_vendedor='".$responsable."' and c.tipo='2' and c.cod_ope in('TF','TB','NV','FA','BV','OP') ";
	//echo $strSQL;
	$resultado=mysql_query($strSQL,$cn);
	while($row=mysql_fetch_array($resultado)){
	//echo $row['cod_ope']." ".$row['serie']." ".$row['numero']."<br>";
	
	//**************series ***********************
	/*
	$strSQL2="select * from series where salida='".$row['cod_cab']."' and producto='".$row['cod_prod']."' and tienda='".$row['tienda']."'";
	$resultado2=mysql_query($strSQL2,$cn);
	$row2=mysql_fetch_array($resultado2);
	$conReg=mysql_num_rows($resultado2);
	//echo $strSQL2."<br>";
	
 	    //if($row['incluidoigv']=='N'){
		//$tempCosto=$row2['costo']*1.18;
		//}else{
		$tempCosto=$row2['costo'];
		//}
		
		if($conReg>0){
		$pcosto=$tempCosto*$row['cantidad'];
		$utilidadTotal=$utilidadTotal+($row['precio']*$row['cantidad']-$pcosto);
		}else{
		
			if($row['descargo']=='N'){
				$utilidadTotal=$utilidadTotal+($row['precio']*$row['cantidad']);
							
			}
		
		}
		
	*/	
	//******************************************
	
	$strSQL2="select * from lotes where cod_cab='".$row['cod_cab']."' and producto='".$row['cod_prod']."' ";
	$resultado2=mysql_query($strSQL2,$cn);
	while($row2=mysql_fetch_array($resultado2)){
		
		$tempCosto=$row2['costo'];
		$pcosto=$tempCosto*$row2['cant'];
		$utilidadTotal=$utilidadTotal+($row['precio']*$row2['cant']-$pcosto);
	}
	
		
	$totalVentas=$totalVentas+$row['precio']*$row['cantidad'];
	}
//--------------------------------------------------------------------------
	
	
?>
<script>


//alert(window.parent.form1.tempCodVend.value);
//001 19820 NV  ven 010  cliente:
var temp="<?php echo $_REQUEST['caducado']?>";
var tempNivelUser="<?php echo $_SESSION['nivel_usu'] ?>";
var permiso_vcredio="<?php echo  $_SESSION['vcredito']; ?>";
var perUsu_moneda="<?php echo  $_SESSION['perUsu_moneda']; ?>";
var perUsu_impuesto="<?php echo  $_SESSION['perUsu_impuesto']; ?>";
var etiqPrecio5="<?php echo $PrecNomEti5; ?>";


//alert(tempNivelUser);
if(temp=="s"){
window.parent.location.href="index.php";
}
var tc_doc="<?php echo $tcambio; ?>";
</script>

<script language="JavaScript"> 
//(c) 1999-2001 Zone Web 
//function click() { 
	//if (evt.button==2){ 
	//alert ('Derechos Reservados a Prolyam Software.') 
	//}		 
//}
//document.onmousedown=click ;

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
	font-size: 10px;
	color:#003366;
	font-weight: bold;
}
.Estilo112 {color: #000000}
-->
.Estilo_det{font:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#333333}

.Estilo118 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color: #FF0000; }


.alphacube_w {
    background: url("../images/borders/left.gif") repeat scroll 0 0 transparent;
    width: 6px;
}
.alphacube_e {
    background: url("../images/borders/right.gif") repeat-y scroll center top transparent;
    width: 6px;
}
.alphacube_sw {
    background: url("../images/borders/bottom_l.gif") no-repeat scroll 0 0 transparent;
    height: 7px;
    width: 6px;
}
.alphacube_s {
    background: url("../images/borders/bottom_m.gif") repeat-x scroll 0 0 transparent;
    height: 7px;
}
.alphacube_se, .alphacube_sizer {
    background: url("../images/borders/bottom_r.gif") no-repeat scroll 0 0 transparent;
    height: 7px;
    width: 7px;
}
.Estilo125 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 24px;
	color: #000000;
}
.Estilo127 {
	font-family: Arial, Helvetica, sans-serif;
	color: #000000;
}
.Estilo130 {font-size: 10px}
.Estilo132 {color: #0033FF}
</style>
</head>

<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../javascript/mover_div.js"></script>

<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>
<SCRIPT src="../javascript/popup.js" type=text/javascript></SCRIPT>

<script language="javascript" src="../miAJAXlib.js"></script>
<!--<script language="javascript" src="jquery[1].hotkeys-0.7.7-packed.js"></script>-->

    <script src="../jquery-1.2.6.js"></script>
    <script src="../jquery.hotkeys.js"></script>
	<!--<script src="../mootools-comprimido-1.11.js"></script>-->
	<!--<script src="../modal.js"></script>-->
	<!--<script language="javascript" src="miAJAXlib2.js"></script>-->
	<script type="text/javascript" src="../modalbox/lib/prototype.js"></script>
	<script type="text/javascript" src="../modalbox/lib/scriptaculous.js?load=effects"></script>
	
	<script type="text/javascript" src="../modalbox/modalbox.js"></script>
	<link rel="stylesheet" href="../modalbox/modalbox.css" type="text/css" />
	

	
<?php 
$fecha=date("d-m-Y");
?>

<script>
jQuery(document).ready(function(){
});



var scrollDivs = new Array();
scrollDivs[0] = "choferes";
//scrollDivs[1] = "capaCopiarDoc";
//scrollDivs[2] = "cajaFact";



var temporal_teclas = "";
var temp_mon = "01";
var array_percepsuc = new Array();
var array_idsuc = new Array();

 jQuery(document).bind('keydown', 'Ctrl+e',function (evt){jQuery('#_up').addClass('dirty');
//	alert('f5');
	evt.keyCode=0;
	evt.returnValue=false;
	
	eliminar_doc();
	
return false; });

 jQuery(document).bind('keydown', 'f4',function (evt){jQuery('#_up').addClass('dirty');
//	alert('f5');
	evt.keyCode=0;
	evt.returnValue=false;
	
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
		//ocultarCbos();
		document.getElementById("capaCopiarDoc").style.visibility="visible";
		
		//return false;
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
		
		if( (user_tienda.length==3 || user_sucursal!="0") && user_tienda!=0 ){
//alert();
			seleccionar_cbo2('sucursal',user_sucursal);
			
			//buscar_valor(document.formulario.sucursal);
			doAjax('../carga_cbo_tienda.php','&codsuc='+document.frmCopiarDoc.sucursal.value,'cargar_cbo4','get','0','1','','')
		}		
	
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
	document.formulario.tpago.style.visibility="hidden";
	

}

function mostrarCbos2(){

    document.formulario.sucursal.style.visibility="visible";
	document.formulario.almacen.style.visibility="visible";
	document.formulario.doc.style.visibility="visible";
	document.formulario.responsable.style.visibility="visible";
	document.formulario.condicion.style.visibility="visible";
	document.formulario.presentacion.style.visibility="visible";
}



function eliminar_doc(){

var feli="<?php echo date("d-m-Y")?>";

if(feli!=document.formulario.femi.value && (tempNivelUser==7 ||tempNivelUser==1 || tempNivelUser==2 || tempNivelUser==6 || tempNivelUser==9 || tempNivelUser==8)){
alert("Solo puede eliminar documentos de la fecha actual ");
return false;
}

if(((tempNivelUser==1 || tempNivelUser==2 || tempNivelUser==3 || tempNivelUser==6 || tempNivelUser==7 || tempNivelUser==8 || tempNivelUser==9 ) && feli==document.formulario.femi.value) || (tempNivelUser!=1 && tempNivelUser!=2 && tempNivelUser!=6 && tempNivelUser!=7 && tempNivelUser!=8 && tempNivelUser!=9)){
	
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
	alert('El usuario con este Nivel no tiene autorizado la Eliminacion de Doc. Fechas Anteriores');
}
}

function anular_doc(){
var feli="<?php echo date("d-m-Y")?>";
//alert(feli+"=="+document.formulario.femi.value);
if(feli!=document.formulario.femi.value && (tempNivelUser==1 || tempNivelUser==2 || tempNivelUser==6 || tempNivelUser==7 || tempNivelUser==9)){
alert("Solo puede anular documentos de la fecha actual ");
return false;
}

if(((tempNivelUser==1 || tempNivelUser==7 || tempNivelUser==9 ) && feli==document.formulario.femi.value) || (tempNivelUser!=1 && tempNivelUser!=7 && tempNivelUser!=9) ){
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
			if(texto=='GenxTran'){
			alert('No se puede eliminar Documentos hechos desde el generador de GUIAS x TRANSFERENCIAS');	
			}else{
			alert('Una de las series de este documento ya tiene salida. ');
			}
			
		}
	}
}



jQuery(document).bind('keydown', 'f2',function (evt){jQuery('#_up').addClass('dirty');

antes_grabar();
 	
return false; });

function antes_grabar(){

	if (temporal_teclas=="") {
		var total_doc=document.formulario.total_doc.value;
		if(total_doc!=0){
			temporal_teclas='grabar';
			var permiso25=find_prm(tab_cajaFact,tab_cod);
			var mnjDeuda=deudaCondx();
		  // && mnjDeuda=='S'
			if(permiso25=='S'){
				generateCoverDiv("capa_fondo","#000000",10);
				ocultarCbos();
				document.getElementById("cajaFact").style.visibility='visible';
				if(document.getElementById('totalpagar')=='undefined'){
					document.getElementById("montoCajaF").innerHTML=document.formulario.total_doc.value;
					document.formulario.importe2.value=document.formulario.total_doc.value;
				}else{
				//var tempTot=
				//alert(parseFloat(document.formulario.totalpagar.value).toFixed(2));
					document.getElementById("montoCajaF").innerHTML=(document.formulario.totalpagar2.value);
					document.formulario.importe2.value=document.formulario.totalpagar.value;
				}
				document.formulario.fechaPago.value=document.formulario.femi.value;
					
				if(document.formulario.tmoneda.value=='01'){
					tempMonP=" S/. ";
					/*if(document.getElementById('totalpagar')=='undefined'){
						document.formulario.pendiente_s.value=parseFloat(document.formulario.total_doc.value);
					}*/
					document.formulario.pendiente_s.value=document.formulario.importe2.value;
					document.formulario.pendiente_d.value=parseFloat(document.formulario.importe2.value/document.formulario.tcPago.value).toFixed(2);
					document.formulario.total_s.value=document.formulario.importe2.value;
					document.formulario.total_d.value=parseFloat(document.formulario.importe2.value/document.formulario.tcPago.value).toFixed(2);
					document.formulario.soles.focus();		 
					 
				}else{
					tempMonP=" US$. ";
				    document.formulario.pendiente_s.value=parseFloat(document.formulario.importe2.value*document.formulario.tcPago.value).toFixed(2);
					document.formulario.pendiente_d.value=document.formulario.importe2.value;
					document.formulario.total_s.value=parseFloat(document.formulario.importe2.value*document.formulario.tcPago.value).toFixed(2);
					document.formulario.total_d.value=document.formulario.importe2.value; 
					document.formulario.dolares.focus();
				}
					 
				document.getElementById("etiqMonCaja").innerHTML=tempMonP;
				
				if(document.getElementById('total_doc').value!=document.formulario.importe2.value){
					var percx=parseFloat(document.formulario.percepcion.value.replace(',',''));
				}else{
					var percx="0";
				}
				
				if(document.formulario.tmoneda.value=='01'){
				var soles=parseFloat(document.formulario.importe2.value);
				}else{
				var dolares=parseFloat(document.formulario.importe2.value);
				}
				
				var tpago=document.formulario.tpago.value;
				var numero="";
								
				var moneda_v=document.formulario.vueltoen.value;
				var tope=document.formulario.tope.value;
				var fecha_det_pago=document.formulario.femi.value;
				var tcambio_det_pago=document.formulario.tcPago.value;;
				var moneda_doc=document.formulario.tmoneda.value;
				var acuenta=document.formulario.acuenta.value;
				var condicion=document.formulario.condicion.value;
				var doc=document.formulario.doc.value;
				var moneda_doc=document.formulario.tmoneda.value;
				var total_doc=document.formulario.importe2.value;
				
				//alert(acuenta);
							//alert('pagos_det.php?tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares);
			doAjax('../pagos_det2.php','&tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares+'&moneda_v='+moneda_v+'&tope='+tope+'&fecha_det_pago='+fecha_det_pago+'&tcambio_det_pago='+tcambio_det_pago+'&moneda_doc='+moneda_doc+'&acuenta='+acuenta+'&percx='+percx+'&condicion='+condicion+'&doc='+doc+'&moneda_doc='+moneda_doc+'&total_doc='+total_doc,'lista_pago','get','0','1','','');
				
				return false;
			}else{
				grabar_doc();
			}
		}else{
		    //var permiso16=find_prm(tab16,tab_cod);
		    //if(permiso16=='S'){
			grabar_doc();
			//}else{
			//alert('No se puede guardar un documento sin valor');			
			//}
		}	
	}else{
		event.keyCode=0;
		event.returnValue=false;
	}
}

function grabar_doc(){
	var permiso16=find_prm(tab16,tab_cod);
	var total_doc=document.formulario.total_doc.value;
	var items=document.getElementById("nitems").innerHTML;
	//if(total_doc!=0 || permiso16=='S'){
	if(items!=0){
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
		var obs2=document.formulario.obs2.value;
		var obs3=document.formulario.obs3.value;
		var obs4=document.formulario.obs4.value;
		var obs5=document.formulario.obs5.value;
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
			vuelto=document.formulario.vuelto.value;
			moneda_v=document.formulario.vueltoen.value;
			var tipoDescuento=find_prm(tab_tipoDesc,tab_cod);
			// alert(serie+'//'+numero+'//'+doc);
			//alert(temp_doc);
			// return false;
			doAjax('peticion_datos.php','&temp_doc='+temp_doc+'&responsable='+responsable+'&tipomov='+tipomov+'&tienda='+tienda+'&condicion='+condicion+'&femision='+femision+'&fvencimiento='+fvencimiento+'&monto='+monto+'&impuesto1='+impuesto1+'&total_doc='+total_doc+'&incluidoigv='+incluidoigv+'&auxiliar='+auxiliar+'&tmoneda='+tmoneda+'&tcambio='+tcambio+'&peticion=save_doc'+'&sucursal='+sucursal+'&correlativo_ref='+correlativo_ref+'&serie_ref='+serie_ref+'&obs1='+obs1+'&obs2='+obs2+'&obs3='+obs3+'&obs4='+obs4+'&obs5='+obs5+'&cod_cab_ref='+cod_cab_ref+'&kardex_doc='+kardex_doc+'&act_kardex_doc='+act_kardex_doc+'&doc='+doc+'&serie='+serie+'&numero='+numero+'&auxiliar='+auxiliar+'&impto='+impto+'&transportista='+transportista+'&chofer='+chofer+'&nom_chofer='+nom_chofer+'&percepcion='+percepcion+'&porcen_percep='+porcen_percep+'&dirPartida='+dirPartida+'&dirDestino='+dirDestino+'&fecharegis='+fecharegis+'&serieOT='+serieOT+'&numeroOT='+numeroOT+'&vuelto='+vuelto+'&moneda_v='+moneda_v+'&tipoDescuento='+tipoDescuento,'mostrar_grabacion','get','0','1','','');
		}
	}else{
		alert('No se puede guardar el documento sin detalle');						
	}	
}

//SELECT cod_cab,tipo,cod_ope,serie,Num_doc,tienda,sucursal,cliente,moneda,total FROM `cab_mov` WHERE tienda=''

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
	
	if(texto=='error_'){
		alert('Documento no grabó.....Verifique su conexión de red.');
		document.formulario.submit();
		return false;
	}
	
	if(texto=='DifTotal'){
		alert('Verifique cantidad de producto.');//No coincide los totales.
		return false;
	}
		
	if(texto=='vcredito'){
		alert("Usuario no autorizado para vender al crédito");
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
		
	//	setTimeout("document.formulario.submit();",2000);		
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
			if((document.getElementById('tblproductos').rows[i].style.background=='#fff1bb' || document.getElementById('tblproductos').rows[i].style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || document.getElementById('tblproductos').rows[i].style.background=='rgb(255, 241, 187)') && (i!=0) ){
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
			if((document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' || document.getElementById('tblproductos1').rows[i].style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || document.getElementById('tblproductos1').rows[i].style.background=='rgb(255, 241, 187)') && (i!=0) ){
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
  		var obs1=document.formulario.obs1.value;
		var obs2=document.formulario.obs2.value;
		var obs3=document.formulario.obs3.value;
		var obs4=document.formulario.obs4.value;
		var obs5=document.formulario.obs5.value;	
	
		window.open('observaciones.php?doc='+document.formulario.doc.value+'&obs1='+obs1+'&obs2='+obs2+'&obs3='+obs3+'&obs4='+obs4+'&obs5='+obs5,'','width=350,height=300,top=250,left=350,scroolbars=no,directories=no,location=no,menubar =no,titlebar=no,toolbar=no,status=yes');
	
	return false; });

	//alert();
	jQuery(document).bind('keyup', 'down',function (evt){jQuery('#_down').addClass('dirty');
		if(document.getElementById('productos').style.visibility=='visible'){
 //alert('entro');
	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
			
		//	alert(document.getElementById('tblproductos').rows.length);
			if((document.getElementById('tblproductos').rows[i].style.background=='#fff1bb' || document.getElementById('tblproductos').rows[i].style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || document.getElementById('tblproductos').rows[i].style.background=='rgb(255, 241, 187)') && (i!=document.getElementById('tblproductos').rows.length-1)){
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
			if((document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' || document.getElementById('tblproductos1').rows[i].style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || document.getElementById('tblproductos1').rows[i].style.background=='rgb(255, 241, 187)') && (i!=document.getElementById('tblproductos1').rows.length-1)){
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
		//alert(document.activeElement.typeof);
		if(document.activeElement.name=="desc1Det"){
		return false;
		
		}
		//alert(document.activeElement.name)
		if(document.activeElement.name==undefined){
		return false;
		}
		if(document.getElementById('divLotes').style.visibility=="visible"){
		//alert();
		return false;
		}
		//alert();
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
			
			if(document.activeElement.name=='tpago'){
				document.formulario.numero_tarjeta.focus();
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

	
	//alert("");
	
			
	if(document.getElementById('productos').style.visibility=='visible'){
		
		for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
			
			if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb' || document.getElementById('tblproductos').rows[i].style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || document.getElementById('tblproductos').rows[i].style.background=='rgb(255, 241, 187)'){
			
				if(navigator.appName!='Microsoft Internet Explorer'){
				 
				var temp=document.getElementById('tblproductos').rows[i].cells[0].childNodes[1].childNodes[1].innerHTML;
				var temp1=document.getElementById('tblproductos').rows[i].cells[1].childNodes[1].innerHTML;
				}else{
				var temp=document.getElementById('tblproductos').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
				var temp1=document.getElementById('tblproductos').rows[i].cells[1].childNodes[0].innerHTML;
				}
		
		//alert(temp+"|"+temp1);
				
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
	   document.formulario.ccajas.value=unidad[18];
	   document.formulario.esmodelo.value=unidad[20];
	   document.formulario.cantModelo.value=unidad[21];
	   document.formulario.lotes.value=unidad[23];
	   
	   //document.formulario.esmodelo.value=unidad[20];
	   
	   if(unidad[18]=='S'){
	    document.getElementById("tblCampos").style.width=766;
	   	document.getElementById("tdcajas1").style.display="block";
		document.getElementById("tdcajas2").style.display="block";
	   }else{
	    document.getElementById("tblCampos").style.width=720;
	   	document.getElementById("tdcajas1").style.display="none";
		document.getElementById("tdcajas2").style.display="none";
	   }
	   
	   var prod_moneda=unidad[3];
		if(document.formulario.tipomov.value==2){
				
			//var precosto=unidad[6];
			var precosto=unidad[7];
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
		
			if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb'  || document.getElementById('tblproductos1').rows[i].style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || document.getElementById('tblproductos1').rows[i].style.background=='rgb(255, 241, 187)' ){
			   if(navigator.appName!='Microsoft Internet Explorer'){
	    var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[1].childNodes[1].innerHTML;
		var temp1=document.getElementById('tblproductos1').rows[i].cells[1].childNodes[1].innerHTML;
		//var ruc=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[1].childNodes[1].childNodes[1].childNodes[1].innerHTML;
		var ruc=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[1].childNodes[1].childNodes[0].childNodes[1].childNodes[1].innerHTML;
		//alert(temp+" | "+temp1+" | "+ruc);
		        }else{
								
		var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
		var temp1=document.getElementById('tblproductos1').rows[i].cells[1].childNodes[0].innerHTML;
		var ruc=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].innerHTML;
		//alert(temp+" | "+temp1+" | "+ruc);
				}
				
		
				
		var temp4=document.getElementById('tblproductos1').rows[i].cells[4].innerHTML.split("-");
		//alert(temp4);
		document.formulario.est_percep_clie.value=temp4[8];
		document.formulario.por_percep_clie.value=temp4[9];
		document.formulario.dirDestino.value=temp4[10].replace(/[|]/gi,'-');//replace("|","-");
		document.formulario.dirDestino2.value=temp4[10].replace(/[|]/gi,'-');//replace("|","-");
		
		var condClie=temp4[19];
		var t_personaClie=temp4[22];
		
		var tipoprov=temp4[16];
		
		var doc=document.formulario.doc.value;
		
		//alert(ruc+" - "+tipoprov);
			 //if( (doc=='FA' || doc=='F1') && ruc=="" && tipoprov=='1' ){
			 
			 
			 if( document.formulario.tipomov.value==2){	
			 
			 	 if((doc.substring(0,1)=='F' || doc=='NC') && t_personaClie!='juridica' ){
				 alert(" Cliente seleccionado no es persona Jurídica ");
				 return false;
				 }
			 
				  if(doc.substring(0,1)=='B' && t_personaClie!='natural'){					  
				  		  			  
				   alert(" Auxiliar seleccionado no es persona Natural ");
				  return false;
				  				  				  
				  }else{
					temp1=temp1.replace('&amp;','&');
					elegir2(temp,temp1);
					document.formulario.condClie.value=condClie;
				  }	
			 }else{
			 
			 	  var permiso_sunat=find_prm(tab_sunat,tab_cod);
		 
				  if(permiso_sunat!='' && t_personaClie=='natural'){					  
				  		  			  
				   alert(" Auxiliar seleccionado no es persona Jurídica ");
				  return false;
				  				  				  
				  }else{
					temp1=temp1.replace('&amp;','&');
					elegir2(temp,temp1);
					document.formulario.condClie.value=condClie;
				  }	
			 
			 
			 
			 } 
					 
				  

			}
		 }
	   }	   
	   
	   //alert();
	   
	   if(document.formulario.cantidad.value==0 && document.formulario.punit.value!="" && document.formulario.precio_p.value!='1'){	   
	   document.formulario.precio.focus();
	   document.formulario.precio.select();	   	   
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
					
					var esmodelo=document.formulario.esmodelo.value;
										
						if( parseFloat(saldo) >= parseFloat(cant) || prms_doc_stock=='N' || kardex_prod=='N' || esmodelo=='S' ){
						
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
						 // 
						 // alert(permiso16);
						  if(permiso16=='N'){
						//	if((document.formulario.precio.value==0 || document.formulario.precio.value=='' ) && document.formulario.doc.value!='GR'){
							if((document.formulario.precio.value==0 || document.formulario.precio.value=='' ) && document.formulario.doc.value!='GR'){
								//alert(document.formulario.doc.value);
								/*
								if(permiso_modifPrecio=='N'){
								document.formulario.punit.focus();
								document.formulario.punit.select();							
								return false;
								}else{
								enviar();
								}
								*/
							
							}
							
							if(document.activeElement.name=='cantidad'){
							   // alert();
								if(document.formulario.ccajas.value=='S'){
								document.formulario.pcajas.focus();
								document.formulario.pcajas.select();
								}else{
								//alert(permiso_modifPrecio);
									if(permiso_modifPrecio=='N'){
									document.formulario.punit.focus();
									document.formulario.punit.select();									
									}else{	
									//alert('sss');								
									enviar();
									}
								}
								return false;
							}
							//alert();
							if(document.activeElement.name=='pcajas'){
							
								document.formulario.punit.focus();
								document.formulario.punit.select();									
							//alert();
								return false;
							}
							
							
							
							
							
							
						  }	
						// alert();
							doAjax('buscar_item.php','','buscar_item2','get','0','1','','');
												
						}else{
						
						//soundPlay();						
						alert("Producto sin Stock ... \n Stock Disponible: "+saldo);	
						document.formulario.cantidad.value="";
						document.formulario.codprod.value="";
						document.formulario.termino.value="";
						document.formulario.precio.value="";
						document.formulario.punit.value="";
						document.formulario.codprod.select();
																
						}
						
					}else{// tipomov 
					//alert();
						var permiso16=find_prm(tab16,tab_cod);
					//	alert(permiso16);
						if(permiso16=='N'){
							if(document.formulario.punit.value==0 || document.formulario.punit.value=='' ){
							//alert();
							//document.formulario.punit.focus();
							//document.formulario.punit.select();
							if(document.formulario.punit.value==0 && document.formulario.ccajas.value=='N'){
							//alert();
							document.formulario.precio.focus();
							document.formulario.precio.select();
							}else{
							document.formulario.punit.focus();
							document.formulario.punit.select();
							}
							
							return false;
							}
						}
						
						/*if(document.activeElement.name=='pcajas'){
							
							document.formulario.punit.focus();
							document.formulario.punit.select();									
							return false;
						}*/	
										
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
					//alert();
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

ant_imprimir('I');
	
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
  jQuery(document).bind('keydown', 'f10',function (evt){jQuery('#_f10').addClass('dirty');
	//alert("");
	evt.returnValue=false;
	evt.keyCode=0;
	/*
	  if(document.getElementById('auxiliares').style.visibility=='visible'){
	  editCliente();
	  }
	 */ 
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
	
	
	if(perUsu_moneda!='S' && document.formulario.tipomov.value=='2'){
	alert("Este usuario no tiene permiso para cambiar de moneda");
	return false;
	}
	
	var permiso21=find_prm(tab_descuento,tab_cod);
	
	if(permiso21=='S'){
	
	//alert("No es posible cambiar de moneda cuando se aplica descuentos");
	//return false;
	}	


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
 	if(perUsu_impuesto!='S' && document.formulario.tipomov.value=='2'){
	alert("Este usuario no tiene permiso para cambiar de impuesto");
	return false;
	}

	var permiso21=find_prm(tab_descuento,tab_cod);
	if(permiso21=='S'){
		//alert("No es posible cambiar de impuesto cuando se aplica descuentos");
		//return false;
	}
		
	
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
		
		
		if(document.getElementById("cajaFact").style.visibility=='visible'){
		
		cerrarCaja();
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
		//mostrarCbos();
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
//alert();
	seleccionar_cbo('sucursal',user_sucursal);
	
	buscar_valor(document.formulario.sucursal);
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
//document.formulario.notas.disabled=true;
document.formulario.notas.disabled=false;
//document.formulario.termino.disabled=true;

document.formulario.precio.readOnly=true;
document.formulario.punit.disabled=true;
document.formulario.precio.disabled=true;
document.formulario.pro.value=1;

}

function mostrar(texto) {

temp_envio_det=0;

var filas=document.getElementById('detalle_doc_gen').rows.length;

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
document.formulario.pcajas.value="";
document.formulario.ccajas.value="";
document.formulario.esmodelo.value="";
document.formulario.cantModelo.value="";

document.formulario.lotes.value="";
document.formulario.des_lote.value="";
document.formulario.tempLotesVenta.value="";

	document.getElementById("tblCampos").style.width=720;
	document.getElementById("tdcajas1").style.display="none";
	document.getElementById("tdcajas2").style.display="none";

	if(!document.formulario.codprod.disabled){
	//alert("");
		if(tempNameDesc==""){
		location.href="#anclax"+(filas-1);
		
		}
			
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
	
	   if(tempNameDesc!=""){
		location.href="#anclax"+tempNameDesc;
		tempNameDesc="";
		//return false;
		}
	
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
				if(tempValor.length<2){
				return false;
				}	
	}
	//-------------------------------------------------------------------------
	
	
	
	//alert(tienda);
	var codcliente=document.formulario.auxiliar2.value;	
	var cambiarPrecio=document.formulario.cambiarPrecio.value;
	
	doAjax('det_aux.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc='+document.formulario.prov_asoc.value+'&moneda_doc='+moneda_doc+'&tipoBus='+tipoBus+'&codcliente='+codcliente+'&cambiarPrecio='+cambiarPrecio,'detalle_prod','get','0','1','','');
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
	temp2=document.getElementById('tblproductos').rows[0];	
	}
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
	 
	 var tempCodVend=window.parent.document.form1.tempCodVend.value;
	 
	 //alert(tempCodVend);
	// var tempCodVend=jQuery("#tempCodVend").attr('value');
		
		doAjax('../carga_cbo_doc.php','&tipomov='+tipomov+'&empresa='+empresa+'&tempCodVend='+tempCodVend,'res_cargar_cbo_doc3','get','0','1','','');
}

function cargar_cbo4(r){

    document.getElementById('div2').innerHTML=r;
	//document.frmCopiarDoc.almacen.focus();
		
	if(user_tienda.length==3){
		seleccionar_cbo2('almacen',user_tienda);
				
	}
	
	 var tipomov=document.formulario.tipomov.value;
	 var empresa=document.formulario.sucursal.value;
	 
	var tempCodVend=window.parent.document.form1.tempCodVend.value;
	doAjax('../carga_cbo_doc.php','&tipomov='+tipomov+'&empresa='+empresa+'&tempCodVend='+tempCodVend,'res_cargar_cbo_doc','get','0','1','','');
	
}

<?php
 if($_SESSION['verificadorruc']=="S"){
 ?>
function VerificadorRuc(){
	doc=document.formulario.doc.value;
	//alert(doc.substring(0,1));
	if(doc.substring(0,1)=='B' && document.formulario.tipomov.value=='2'){
		alert("Esta opcion solo funciona con Documentos que exigen ruc ");
		return false;
	}
	var ruc=document.formulario.aux_ruc.value;
	if(ruc.length==11){
		if(ruc.substring(0,2)>=10 && ruc.substring(0,2)<=20){
			doAjax('peticionxcli.php','&opera=existe&ruc='+ruc,'rpta_validaruc','GET','0','0','','');
		}else{
			alert("Ruc Invalido");
		}
	}else{
		alert('Ruc invalido debe tener 11 digitos');
	}
}

function rpta_validaruc(texto){
//alert(texto);
	if(texto.substring(0,6)!="<br />"){
		var tempx=texto.split("//");
		
		if(tempx[0].substring(0,6)=="<br />"){
			var res=confirm("Servidor ocupado en estos momentos desea reintentar?");
			var ruc=document.getElementById('aux_ruc').value;
			doAjax('peticionxcli.php','&opera=existe&ruc='+ruc,'rpta_validaruc','GET','0','0','','');
		}else{
			var temp=tempx[1].split("|");
			if(temp[2]=="A"){
				document.formulario.aux_ruc.value=temp[0];
				document.formulario.aux_razon.value=temp[1].replace("&amp;","&");
				document.formulario.aux_telef.value=temp[4];
				document.formulario.aux_direccion.value=temp[3];
				if(tempx[0]=="S"){
					if(confirm("Cliente con Ruc Registrado desea actualizar los datos?")){
						doAjax('peticionxcli.php','&opera=actualiza&ruc='+temp[0]+'&razon='+temp[1].replace("&amp;","amp")+'&telefono='+temp[4]+'&direccion='+temp[3],'rpta_act_val','GET','0','0','','');
					}
				}
			}else{
				if(temp[0]=="/small><br/"){
					alert('Ruc no Existe');
				}else{
					if(temp[0].substring(0,6)=="<br />"){
						var res=confirm("Servidor ocupado en estos momentos desea reintentar?");
						var ruc=document.formulario.aux_ruc.value;
						doAjax('peticionxcli.php','&opera=existe&ruc='+ruc,'rpta_validaruc','GET','0','0','','');
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
	temp=texto.split("|");
	elegir2(temp[0],temp[1].replace("&amp;","&"));
	document.getElementById('new_aux').style.visibility='hidden';		

	document.formulario.aux_ruc.value="";
	document.formulario.aux_dni.value="";
	document.formulario.aux_razon.value="";
	document.formulario.aux_direccion.value="";
	document.formulario.accionAux.value="";
	document.formulario.codClie.value="";
	document.formulario.aux_telef.value="";
}
<?php } ?>
function res_cargar_cbo_doc3(texto){
var temp=texto.split("?");

//alert(texto);
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
			 tab_predefecto = temp[30].split(",");
			 
			 tab25 = temp[33].split(",");
			 tab_mostrarOT=temp[36].split(",");
			 
			 document.formulario.doc.disabled=false;
			 document.formulario.doc.focus();
			 document.formulario.sucursal.disabled=true;
			 document.formulario.almacen.disabled=true;
			 
			 //tab19=temp[31].split(",");
			 //tab20=temp[32].split(",");
			 tab_cola1=temp[31].split(",");
			 tab_cola2=temp[32].split(",");
			 tab_numauto=temp[34].split(",");
			 tab_descuento=temp[35].split(",");
			 tab_cajaFact=temp[37].split(",");
			 tab_modifdesc=temp[38].split(",");
			 tab_puntos=temp[39].split(",");
			 tab_envases=temp[40].split(",");
			 tab_tipoDesc=temp[41].split(",");
			 tab_accionDoc=temp[44].split(",");
			 tab_modifPrecio=temp[45].split(",");
			 tab_sunat=temp[46].split(",");
			 
			// alert(tab_accionDoc);
			 //alert(tab_puntos);
			// alert(tab19);
			 
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
.Estilo115 {
	color: #FF0000;
	font-weight: bold;
}
.Estilo116 {font-size: 11px}
.Estilo119 {
	font-family: Arial, Helvetica, sans-serif;
	color: #FFFFFF;
	font-weight: bold;
	font-size: 12px;
}
.Estilo126 {color: #0066FF}
.Estilo129 {color: #0066FF; font-weight: bold; }
.Estilo131 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>


<script>
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
iniciar();
//alert(texto);
}

function buscar_item2(texto){

//alert(texto);
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
<body  onload="cargarControlJquery();vaciar_sesiones();cambiar_moneda_ini();carga_div()"   onUnload="vaciar_sesiones()" >

<form id="formulario" name="formulario" method="post" action="">
  <table width="906" border="0" cellpadding="0" cellspacing="0">
   
     <tr style="background:url(../imagenes/white-top-bottom.gif)">
       <td height="10" colspan="3" style="border:#999999">&nbsp;<span class="Estilo34"> <span class="Estilo34 Estilo38">
         <span class="Estilo34 Estilo34"><?php echo $titulo?></span>
         <input name="tempauxprod"  type="hidden" value=""  size="5" />
            <input name="tipomov"  type="hidden" value="<?php echo $_REQUEST['tipomov']?>" size="5" />
            <input name="temp_doc" type="hidden" size="5">
			<input name="accion" type="hidden" size="5" maxlength="10">
            <input name="incluidoigv" type="hidden" size="5" maxlength="10" value="S">
            <input name="tmoneda" type="hidden" size="5" maxlength="10" value="02">
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
            <input name="correlativo" type="hidden" value='' size="5">
			<input name="serie_ing" type="hidden" id="serie_ing" value="" size="3" maxlength="3">
          
			
			<script>
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

			</script>
            
            <input name="precosto" type="hidden" id="precosto" value="" size="5" maxlength="6">
            <input name="impto" id="impto" type="hidden" size="6" maxlength="6" value="">
            <input name="percep_suc" id="percep_suc" type="hidden" size="6" maxlength="6" value="">
            <input name="percep_doc" id="percep_doc" type="hidden" size="6" maxlength="6" value="" >
            <input name="min_percep_doc" id="min_percep_doc" type="hidden" size="6" maxlength="6" value="">
            <input name="est_percep_clie" id="est_percep_clie" type="hidden" size="6" maxlength="6" value="">
            <input name="por_percep_clie" id="por_percep_clie" type="hidden" size="6" maxlength="6" value="">
            <input name="tempCopiar" id="tempCopiar" type="hidden" size="6" maxlength="6" value="">
            <input name="kardex_prod" id="kardex_prod" type="hidden" size="6" maxlength="6" value="">
			<input name="cantSubUnidad" id="cantSubUnidad" type="hidden" value="">
            <input name="codBarraEnc" id="codBarraEnc" type="hidden" value="">
            <input name="codAnexProd" id="codAnexProd" type="hidden" value="">
			<input name="tserie" id="tserie" type="hidden" value="">
            <input name="tempSave" id="tempSave" type="hidden" value="">
			<input name="ccajas" id="ccajas" type="hidden" value="">
			<input name="condClie" id="condClie" type="hidden" value="">
			<input name="cambiarPrecio" id="cambiarPrecio" type="hidden" value="">			
		
               </span>
	       </span>     
	       <input name="aud_fecha" id="aud_fecha" type="hidden" value="">
	    
	       <input name="aud_pc" id="aud_pc" type="hidden" value="">
	       
	       <input name="aud_usuario" id="aud_usuario" type="hidden" value="">	
		   <input name="esmodelo" id="esmodelo" type="hidden" value="">
		   <input name="cantModelo" id="cantModelo" type="hidden" value="">
		   <input name="tempImp" id="tempImp" type="hidden" value="">
			
			<input name="lotes" id="lotes" type="hidden" value="">       
       		<input name="tempLotesVenta" id="tempLotesVenta" type="hidden" value="">
	   	
			<script>
			function preloadMedia() {
			  for(var i = 0; i < testQuestions.length; i++)  {
			  var soundEmbed = document.createElement("embed");
			  soundEmbed.setAttribute("src", "/media/sounds/" + testQuestions[i].mediaFile);
			  soundEmbed.setAttribute("hidden", true);
			  soundEmbed.setAttribute("id", testQuestions[i].id);
			  soundEmbed.setAttribute("autostart", false);
			  soundEmbed.setAttribute("width", 0);
			  soundEmbed.setAttribute("height", 0);
			  soundEmbed.setAttribute("enablejavascript", true);
			  document.body.appendChild((soundEmbed));
			}}
			/*
			function soundPlay() {
			  var sounder = document.getElementById("sound2");
			  sounder.Play();
			}
			*/
			</script>	   </td>
				
       <td height="27" colspan="10" align="right" style="border:#999999"><table width="325" border="1" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
         <tr>
           <td height="25" align="center"><span class="Estilo34">Venta Dia S/.<?php echo number_format($totalVentas,2);?> &nbsp;&nbsp;&nbsp;Utilidad: S/.<?php echo  number_format($utilidadTotal,2)?>
                 <input type="button" name="Submit22" value="?" onClick="ventasMesVend()">
                 <input type="button" name="Submit222" value="?" onClick="ventasDetallado()">
           </span></td>
         </tr>
       </table></td>
     </tr>
	
    <tr style="background:url(../imagenes/botones.gif)" >
      <td width="6" height="28">&nbsp;</td>
      <td width="6">&nbsp;</td>
      <td colspan="7"><table width="98%" height="21" border="0" cellpadding="0" cellspacing="0" style="border-bottom:#CCCCCC solid 1px">
     <tr>
		
          <td width="93" >
		  
		  <script>
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
                <tr onClick="javascript:antes_grabar()" onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer;">
                  <td width="3" ></td>
                  <td width="20" ><span class="Estilo112"><img src="../imgenes/revert.png" width="14" height="16"></span></td>
                  <td width="54" ><span class="Estilo112">Grabar<span class="Estilo113">[F2]</span></span></td>
                  <td width="3" style="border:#666666 solid 1px" ></td>
                </tr>
            </table>			</td>
          <td width="81" >
		  
		  <table  title="Salir [Esc]"width="72" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="salir()">
                <td width="3" ></td>
                <td width="20" ><img src="../imagenes/salir.JPG"  width="16" height="16" border="0"></td>
                <td width="46" ><span class="Estilo112">Salir<span class="Estilo113">[Esc]</span></span></td>
                <td width="3" ></td>
              </tr>
          </table>		  </td>
          <td width="138">
		  
		  <table title="Eliminar Doc [Ctrl+E]" onClick="eliminar_doc()" width="130" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer">
                <td width="3" ></td>
                <td width="20" ><span class="Estilo112"><img src="../imgenes/eliminar.png" width="16" height="16"></span></td>
                <td width="99" ><span class="Estilo112">Eliminar<span class="Estilo113">[Ctrl+E]</span></span></td>
                <td width="8" ></td>
              </tr>
          </table></td>
          <td width="96">
		  
		  <table title="Anular Doc.[F5]" width="76" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="anular_doc()">
                <td width="3" ></td>
                <td width="20" ><span class="Estilo112"><img src="../imgenes/debaja.png" width="16" height="16"></span></td>
                <td width="50" > <span class="Estilo112">Anular<span class="Estilo113">[F5]</span></span></td>
                <td width="3" ></td>
              </tr>
          </table>		  </td>
          <td width="93"><table title="Cambiar Moneda [F8]" width="80" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="func_f8()">
                <td width="3" ></td>
                <td width="16" ><span class="Estilo112"><img src="../imagenes/dolar.gif" width="15" height="15"></span></td>
                <td width="58" ><span class="Estilo112">Moneda<span class="Estilo113">[F8]</span> </span></td>
                <td width="3" ></td>
              </tr>
          </table></td>
          <td width="81"><table title="Incl./no Incl.[F9]" width="70" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="cambiar_impuesto()">
              <td width="3" ></td>
              <td width="24" ><span class="Estilo112"><img src="../imagenes/igv.gif" width="20" height="16"></span></td>
              <td width="45" ><span class="Estilo112">&nbsp;Imp<span class="Estilo113">[F9]</span> </span></td>
              <td width="3" ></td>
            </tr>
          </table></td>
          <td width="97">
		  <table title="Nuevo[F7]" width="85" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="ant_imprimir('I')">
              <td width="3" ></td>
              <td width="20" align="center" ><img src="../imgenes/fileprint.png" width="16" height="16"></td>
              <td width="59" ><span class="Estilo112">Imprimir<span class="Estilo113">[F7]</span> </span></td>
              <td width="3" ></td>
            </tr>
          </table>		  </td>
          <td width="93"><table title="Copiar Documento[F4]" width="83" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="verCopiarDoc()">
              <td width="3" ></td>
              <td width="20" align="center" ><img src="../imagenes/iconocopiar.gif" width="19" height="16"></td>
              <td width="59" ><span class="Estilo112">Copiar<span class="Estilo113">[F4]</span> </span></td>
              <td width="1" ></td>
            </tr>
          </table></td>
          <td width="7"></td>
          <td width="97"><table title="Enviar PDF" width="82" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="ant_imprimir('pdf')">
              <td width="3" ></td>
              <td width="20" align="center" ><img src="../imagenes/pdfico.jpg" width="19" height="16"></td>
              <td width="55" ><span class="Estilo112">Enviar PDF</span></td>
              <td width="3" ></td>
            </tr>
          </table></td>
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
      <td height="28">&nbsp;</td>
      <td colspan="7" rowspan="2" align="left" valign="top"><table width="760" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="82" height="26"><span class="Estilo14">Empresa</span></td>
          <td width="182">
		  
		  <script>
		  
		  function cambiar_enfoque(control){
		 
		
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
						//alert();		
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
			//alert();
								
			
			
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
					//document.getElementById('row_transp').style.display="block";
					//$("#row_transp").show();
					jQuery("#row_transp").show();
				}else{
					//document.getElementById('row_transp').style.display="none";
					jQuery("#row_transp").hide();
				}
				
				if(permiso19=='S' && document.formulario.tipomov.value=='1'){
					//document.getElementById('row_transp2').style.display="block";
					jQuery("#row_transp2").show();
				}else{
					//document.getElementById('row_transp2').style.display="none";
					jQuery("#row_transp2").hide();
				}
				//alert(permiso19);
				
				if(mostrarOT=='S'){
				
					//ocument.getElementById('row_transp3').style.display="block";
					jQuery("#row_transp3").show();
				}else{
					//document.getElementById('row_transp3').style.display="none";
					jQuery("#row_transp3").hide();
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
			
				if((tempNivelUser=='1' || tempNivelUser=='6' || tempNivelUser=='9')  &&  tipomov=='2'){
					
					document.formulario.codprod.disabled=false;
				
					if(deudaCondx()=='S'){
					document.formulario.fven.disabled=false;
					
					document.formulario.fven.select();
					document.formulario.fven.focus();
					document.getElementById("f_trigger_b1").disabled=false;
					document.formulario.condicion.disabled=true;
					return false;
					}else{
							document.formulario.codprod.disabled=false;
							
							
							permiso_modifPrecio=find_prm(tab_modifPrecio,tab_cod);
							if(permiso_modifPrecio=='N'){
							document.formulario.punit.disabled=false;
							document.formulario.precio.disabled=false;
							}
							document.formulario.cantidad.disabled=false;
							document.formulario.notas.disabled=false;
							document.formulario.termino.disabled=false;
				 	document.formulario.codprod.focus();
					document.formulario.codprod.select();
					}
					//return false;
					//alert();
				}else{				
					document.formulario.femi.disabled=false;
					document.getElementById("f_trigger_b2").disabled=false;
					document.formulario.femi.focus();
					document.formulario.femi.select();
				}			
			
			
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
		//alert(obj.length);
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
				valor=serie;
				}else{
				valor2=serie;	
				valor=numero;
				}
				
				
				valor = parseFloat(valor);
				if(control=='correlativo'){
				valor2 = parseFloat(valor2);
				}
				//alert(valor);
				if(isNaN(valor)){
				alert('Por favor digite un número válido');
				return false;
				}else{
				
				valor=valor.toString();
				if(control=='correlativo'){
					valor2=valor2.toString();
				}
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
					document.formulario.num_serie.value=ponerCeros(valor2,'3');
					
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
					//alert('f');
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
		  
		  //alert(texto.length);
		  
		  document.formulario.num_serie.value=ponerCeros(document.formulario.num_serie.value,3);
		  document.formulario.num_correlativo.disabled=false;
		 // alert(ponerCeros(texto,7));
		  
		  document.formulario.num_correlativo.value=ponerCeros(texto,7);		  
		  document.formulario.num_correlativo.focus();
	      document.formulario.num_correlativo.select();
		  
		 // cbo_cond();
		  
		  }
		  		  
		  </script>
		  
            <select style="width:160"  name="sucursal" onChange="doAjax('../carga_cbo_tienda.php','&codsuc='+document.formulario.sucursal.value,'cargar_cbo','get','0','1','',''); cambiar_enfoque(this);buscar_valor(this)" onFocus="enfocar_cbo(this);limpiar_enfoque(this)" >
			
			 <option value="0"></option>
			
              <?php 
		
  $resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn); 
  $k=0;
while($row1=mysql_fetch_array($resultados1))
{
echo "<script> array_idsuc[$k]='".$row1['cod_suc']."'; array_percepsuc[$k]='".$row1['percepcion']."'; </script>";
		?>
              <option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
              <?php 
			  
$k++;
}?>
            </select>

           <input name="sucursal2" type="hidden" size="3" value="0" />         </td>
          <td width="54" class="Estilo14">N&uacute;mero</td>
          <td width="159"><input name="num_serie" type="text" size="5" maxlength="3" onKeyUp="generar_ceros(event,3,'serie')" onFocus="limpiar_enfoque(this);">
            <input  name="num_correlativo" type="text" size="10" maxlength="7" onKeyUp="generar_ceros(event,7,'correlativo')" onFocus="llenar_dir(document.formulario.almacen.value);"  ></td>
          <td width="80" class="Estilo14" >Condici&oacute;n</td>
          <td width="148"><span class="Estilo15">
            <div id="cbo_cond">		
			<select name="condicion" id="condicion" style="width:120" onChange=""  onFocus="enfocar_cbo(this);limpiar_enfoque(this);cbo_cond()">
		  <?php 
			$marcar="";
		    $resultados11 = mysql_query("select * from condicion order by codigo ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){					
		  ?>           
              <option <?php echo $marcar?> value="<?php echo $row11['codigo']?>"><?php echo $row11['nombre'];?></option>
			  <?php 
			  }
			  ?>
            </select>
			</div>
            </span></td>
          <td width="19"><span class="Estilo15">
            <input name="condicion2" type="hidden" size="3"  value="0"/>
          </span></td>
        </tr>
        <tr>
          <td ><span class="Estilo14">Tienda</span>
            <input name="almacen2" type="hidden" size="3"  value="0"/>          </td>
          <td><span class="Estilo15">
		   <div id="cbo_tienda">
		     <select  style="width:160" name="almacen"  onBlur="">
               <option value="0"></option>
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
          <td>
		  
		  <input name="femi" id="femi" type="text" size="15" maxlength="10" value="<?php echo date('d-m-Y')?>"  onKeydown="generar_ceros(event,'0',this)"  onChange="enfocar_fecha(this)" onBlur="sumarFechaVen(document.formulario.condicion)" >
		  		  				  
		  <button disabled="disabled" type="reset" id="f_trigger_b2"  style="height:18" >...</button>
              <script type="text/javascript">
    Calendar.setup({
        inputField     :    "femi",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b2",   
        singleClick    :    true,           
        step           :    1                
    });
            </script>			</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="30">
		  <span class="Estilo14">Doc<span class="Estilo15">
            <input name="doc2" type="hidden" size="3"  value="0"/>
          </span></span></td>
          <td>
		  
		  <div id="cbo_doc">
		    <select  style="width:160" name="doc"  onBlur="">
              <option value="0"></option>
            </select>
		  </div>		  </td>
          <td class="Estilo14">
		  
		  
		  <?php
		  
		  if($_REQUEST['tipomov']==1){
		  echo "Responsable";
		  }else{
		  echo "Vendedor";
		  }
		  
		  ?>		  </td>
          <td><span class="Estilo15">
		  
		   <select name="responsable" style="width:120" onChange=""  onFocus="enfocar_cbo(this);limpiar_enfoque(this);cbo_cond()">
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
          </span></td>
          <td class="Estilo14">F.Vencimiento</td>
          <td><input name="fven" type="text" size="15" maxlength="10"  value="<?php echo date('d-m-Y')?>"  onKeydown="generar_ceros(event,'0',this)" onChange="enfocar_fecha(this)">
		  <button type="reset" id="f_trigger_b1" style="height:18; vertical-align:top" disabled="disabled" >...</button>
		  
		  
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
			var tab_predefecto;
			
			var tab_cajaFact;
			var tab_modifdesc;
			var tab_puntos;
			var tab_envases;
			var tab_tipoDesc;
			var tab_accionDoc;
			var tab_modifPrecio;
			var tab_sunat;
						
			</script>			</td>
			
			<td>&nbsp;</td>
        </tr>
        <tr style="display:none" id="row_transp">
          <td height="25"><span class="Estilo14">Transportista</span></td>
          <td><input disabled="disabled" name="nom_transp" id="nom_transp" type="text" size="22" maxlength="100" value="<?php echo $chofer ?>">
		<input name="transportista" id="transportista" type="hidden" size="8" maxlength="100" value="<?php echo $idchofer ?>">
		
		<button  id="btn_transp" type="button" title="Cambiar transportista" style="height:18; vertical-align:top" onClick="cambiar_chofer('T')" >...</button>		</td>
          <td class="Estilo14">Chofer</td>
          <td>
		  <input disabled="disabled" name="nom_chofer" id="nom_chofer" type="text" size="18" maxlength="100" value="<?php echo $chofer ?>"> 
		   <input name="id_chofer" id="id_chofer" type="hidden" size="8" maxlength="100" value="<?php echo $idchofer ?>"> 
		  <button  id="btn_chofer" type="button" title="Cambiar Chofer" style="height:18; vertical-align:top" onClick="cambiar_chofer('C')" >...</button>		  </td>
          <td class="Estilo14">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr style="display:none" id="row_transp2">
          <td height="25" colspan="2"><span class="Estilo118">Fecha de Registro &nbsp;&nbsp;</span>
            <input name="fecharegis" type="text" size="15" maxlength="10" value="<?php echo date('d-m-Y')?>"  onKeyUp="generar_ceros(event,'0',this)"  onChange="enfocar_fecha(this)" >
            <button  type="reset" id="f_trigger_b3"  style="height:18" >...</button>            <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecharegis",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b3",   
        singleClick    :    true,           
        step           :    1                
    });
            </script></td>
          <td class="Estilo14">&nbsp;</td>
          <td>&nbsp;</td>
          <td class="Estilo14">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr style="display:none" id="row_transp3">
          <td height="25"><span class="Estilo118">N&uacute;mero O.T.   
               
		   
          </span></td>
          <td height="25"><span class="Estilo118">
            <input type="text" name="serieOT" id="serieOT" size="5" maxlength="3" onBlur="javascript:this.value=ponerCeros(this.value,3)" onKeyUp="generar_cerosOT(event,3,this)">
            <input type="text" name="numeroOT" id="numeroOT" size="10" maxlength="7" onBlur="javascript:this.value=ponerCeros(this.value,7)" onKeyUp="generar_cerosOT(event,7,this)">
          </span></td>
          <td class="Estilo14">&nbsp;</td>
          <td>&nbsp;</td>
          <td class="Estilo14">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="41">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>	 </td>
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
      <td colspan="7"><table width="775" id="tblCampos" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="71"><span class="Estilo14">Producto:
            
          </span></td>
          <td width="172" align="left" valign="middle">
		  
		  <div id="capaPase" style="visibility:hidden">
		  <span class="Estilo14"><span class="Estilo115">Pase</span>
              <input type="checkbox" name="chkpase" id="chkpase" value="checkbox" style="background:none; border:none">
&nbsp;&nbsp; </span>			</div>			</td>
          <td width="140"><span class="Estilo14">Presentaci&oacute;n:</span></td>
          <td width="7">&nbsp;</td>
          <td width="75"><span class="Estilo14">Cant.:</span></td>
          <td>&nbsp;</td>
          <td id="tdcajas1" style="display:none"><span class="Estilo14">Cajas</span></td>
          <td>&nbsp;</td>
          <td width="76"><span class="Estilo14">P.Unit:</span></td>
          <td width="10">&nbsp;</td>
          <td width="52"><span class="Estilo14">&nbsp;</span><span class="Estilo14">Total:</span></td>
          <td width="102"><span class="Estilo14">Notas</span></td>
        </tr>
        <tr>
          <td><span class="Estilo14">Buscar:</span>
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
            </span></td>
          <td><input autocomplete="off"  name="codprod" id="codprod"  type="text" size="25"  onKeyUp="validartecla(event,this,'productos')" onFocus="activar2;"/></td>
          <td rowspan="2"><span class="Estilo14"><span class="Estilo15">
           <div id="cbo_uni">
		    <select name="presentacion" style="width:140px"  id="presentacion">
			</select>
			</div>
			
          </span></span></td>
          <td rowspan="2">&nbsp;</td>
          <td rowspan="2"><span class="Estilo14"><span class="Estilo15">
            <input name="ter" type="hidden" size="3"  value="0"/>
          </span></span><span class="Estilo14">
          <?php if($_REQUEST['tipomov']==2){?>
          <input style="text-align:right" name="cantidad" id="cantidad"  type="text" size="8" onKeyUp="calc_pre_total()" onKeyDown="prev_validarNumero(this,event)" />
		  <!--doAjax('../calcular_precio.php','','mostrar_precio','get','0','1','','');-->
          <?php }else{?>
          <input style=" text-align:right" name="cantidad" id="cantidad"  type="text" size="8" onKeyUp="cambiar_foco(event);calcular_ptotal()" onKeyDown="prev_validarNumero(this,event)" />
          <?php } ?>
          </span></td>
          <td width="10" rowspan="2">&nbsp;</td>
          <td width="50" rowspan="2" align="center" id="tdcajas2" style="display:none"><span class="Estilo14">
            <input  name="pcajas" id="pcajas" type="text" size="8" style=" text-align:right " />
          </span></td>
          <td width="10" rowspan="2">&nbsp;</td>
          <td rowspan="2"><span class="Estilo14">
            <input  name="punit" type="text" size="8" style=" text-align:right " onKeyUp="calcular_ptotal()" />
          </span></td>
          <td rowspan="2">&nbsp;</td>
          <td rowspan="2"><input style="font:bold; text-align:right" name="precio" type="text" size="8"   onKeyUp="calcular_cant()" /></td>
          <td rowspan="2" align="center"><input  name="precio2" type="hidden" size="3"/>
            <textarea name="notas" cols="15"></textarea></td>
        </tr>
        <tr>
          <td><span class="Estilo14">
            Descripci&oacute;n: 
            
          </span></td>
          <td><span class="Estilo14">
            <input name="termino" type="text" size="25" onFocus="activar(event);" onKeyUp="activar(event)">
          </span></td>
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
	    <table id="detalle_doc_gen" width="711" border="0" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
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
            <td align="right">&nbsp;</td>
            <td bgcolor="#FFFFFF"></td>
            <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#FFFFFF"></td>
            <td colspan="2" align="center" bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
            <td align="left" bgcolor="#FFFFFF"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">Items</span></td>
            <td bgcolor="#FFFFFF"><strong id="nitems">0</strong></td>
            <td align="right" bgcolor="#FFFFFF"><input name="estado" id="estado" type="hidden" value="" size="5"></td>
            <td colspan="2" bgcolor="#FFFFFF">SubTotal</td>
            <td align="right"><strong>
              <input name="monto" type="text" size="10" style="text-align:right"  value="<?php echo number_format($total,2);?>"/>
            </strong></td>
            <td colspan="2" align="center" bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
            <td align="left" bgcolor="#FFFFFF"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">Moneda</span></td>
            <td bgcolor="#FFFFFF"><label style="color:#FF0000" id="moneda"><?php echo "(S/.)" ?></label></td>
            <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
            <td colspan="2" bgcolor="#FFFFFF"><table width="115" border="0" cellpadding="0" cellspacing="0">
              <tr>
                 <td width="59" height="18" bgcolor="#FFFFFF">Impuesto1 (</td>
            <td width="15" bgcolor="#FFFFFF"><div id="impto1">18</div></td>
            <td width="41" bgcolor="#FFFFFF">)%</td>
              </tr>
            </table></td>
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
      <td width="527">

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
	  <table width="527" border="0" align="left" cellpadding="0" cellspacing="0">
        <tr>
          <td width="71" align="left"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">Referencia</span>
		  <img style="cursor:pointer" alt="" onClick="doc_det(document.formulario.cod_cab_ref.value)" src="../imagenes/ico_lupa.png" width="12" height="12">		  </td>
          <td width="146" align="left">
		  <input readonly  style="text-align:right" name="serie_ref" id="serie_ref" type="text" size="5" maxlength="3" />
            <input readonly style="text-align:right" name="correlativo_ref" id="correlativo_ref" type="text" size="10" maxlength="7" /></td>
          <td width="271" align="left"><button title="[Alt+r]" disabled="disabled" onClick="vent_ref()" type="button" id="doc_ref"  style="height:18px"><span style=" font-family:Arial, Helvetica, sans-serif;font-size:9px">Referencia</span></button>
            <button title="[Alt+r]" disabled="disabled" onClick="vent_referenciado()" type="button" id="doc_ref2"  style="height:18px"><span style=" font-family:Arial, Helvetica, sans-serif;font-size:9px">Referenciado</span></button>
			
			 <button title="" disabled="disabled" onClick="cboOtrasDirec()" type="button" id="btnCambiarDir"  style="height:18px"><span style=" font-family:Arial, Helvetica, sans-serif;font-size:9px">Cambiar Direcci&oacute;n</span></button>			</td>
          </tr>
      </table></td>
      <td width="83">&nbsp;</td>
      <td width="97"><input name="saldo" type="hidden" size="10" maxlength="10">
      <input name="prueba" type="hidden" size="10" maxlength="10" ></td>
      <td width="187" colspan="3">&nbsp;</td>
    </tr>
  </table>   
  <br>
  <div id="new_aux" style="position:absolute; left:274px; top:139px; width:300px; height:180px; z-index:2; visibility:hidden">
  
  <table width="392" height="72" border="1" cellpadding="0" cellspacing="0" bgcolor="#FEF5E2"><!--FFD3B7-->
  <tr>
    <td>
	<table width="413" border="0" cellpadding="0" cellspacing="0">
      <tr>
	      <td colspan="5" align="right"></td>
      </tr>
      <tr style="background:url(../imagenes/bg_contentbase2.gif) 100% 70%">
        <td width="20" height="23">&nbsp;</td>
        <td colspan="2"><span class="text5 Estilo116"><font face="Verdana, Arial, Helvetica, sans-serif" color="#FFFFFF"><strong>Nuevo Auxiliar </strong></font></span></td>
        <td width="206" colspan="2">&nbsp;</td>
      </tr>
      
      <tr>
        <td colspan="5" height="10"></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td width="62" align="left"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">T. pers.</span>: </td>
        <td colspan="3"><input name="persona" type="radio" value="J" style="border:none; background:none" onClick="validarNewClie(this)" />
          <span style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold; color:#0066FF">Jur&iacute;dica / Natural con RUC </span>
          <input style="border:none; background:none" checked="checked" name="persona" type="radio" value="N" onClick="validarNewClie(this)" />
  <span style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold; color:#0066FF">Natural.</span>  <input name="accionAux" type="hidden" id="accionAux" size="5" maxlength="5"></td>
        </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td align="left"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Cod.Cliente</span></td>
        <td><?php 
		  if($_REQUEST['tipomov']==2)$tipo_aux="C";
		  if($_REQUEST['tipomov']==1)$tipo_aux="P";
		  
		  list($codcliente)=mysql_fetch_row(mysql_query("select max(codcliente) as codigo from cliente where tipo_aux='".$tipo_aux."'"));
 			?>
          <input readonly style="color:#999999" name="codClie" type="text" id="codClie" size="6" maxlength="5" value="<?php echo str_pad($codcliente,6,"0",STR_PAD_LEFT) ?>"></td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td height="20">&nbsp;&nbsp;</td>
        <td align="left"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Ruc</span></td>
        <td width="125"><input name="aux_ruc" id="aux_ruc" type="text" size="17" maxlength="11"  disabled="disabled" style="width:100px" onKeyUp="keyValidarRuc(event)" /><?php if($_SESSION['verificadorruc']=="S"){?><input type="button" value="..." style="height:15px;width:15px;" onClick="VerificadorRuc()" title="Buscador Ruc"><?php }?></td>
        <td colspan="2"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Dni/CE</span>
          <input name="aux_dni" type="text" size="15" maxlength="8" onKeyUp="saltarCampo(event,this)" />
		  <script>
		  
		  function keyValidarRuc(e){
		  
			  if(e.keyCode==13){
			// VerificadorRuc();

			document.formulario.aux_razon.focus();
			document.formulario.aux_razon.select();
			  }
		  }
		  
		   function saltarCampo(e,control){
		  
			  if(e.keyCode==13){
			//  VerificadorRuc();
			if(control.name=='aux_razon'){
			document.formulario.aux_direccion.focus();
			document.formulario.aux_direccion.select();
			}
			
			if(control.name=='aux_direccion'){
			document.formulario.SubmitGC.focus();
			}
			
			if(control.name=='aux_dni'){
			document.formulario.aux_razon.focus();
			document.formulario.aux_razon.select();
			}
			
			
			  }
		  }
		  
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
		  
		  </script>		  </td>
      </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td align="left" style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Cli./Razon</td>
        <td colspan="3"><input name="aux_razon" id="aux_razon" type="text" size="42" maxlength="100" onKeyUp="saltarCampo(event,this)"   /></td>
        </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td align="left"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">Contacto</span></td>
        <td colspan="3"><input name="aux_contacto" type="text" size="42" maxlength="100" /></td>
        </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td align="left"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Cargo</span></td>
        <td colspan="3"><input type="text" name="aux_cargo" />
          <span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Telefono:
          <input name="aux_telef" type="text" size="15" maxlength="20" />
          </span></td>
        </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td align="left"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Email</span></td>
        <td colspan="3"><input type="text" name="aux_email" /></td>
      </tr>
      <tr>
        <td height="29">&nbsp;</td>
        <td align="left" valign="middle"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Lider</span></td>
        <td colspan="3" valign="middle">
		<input type="checkbox" name="chklider" value="checkbox" style="background:none; border:none" onClick="activarLider(this)"> 
          <span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Lideres
          <select name="selectLider" id="selectLider" style="width:160px">
            <option value=""></option>
            <?php 
		  $strSql="select * from cliente where lider='S' ";
		  $resultado=mysql_query($strSql,$cn);
		  while($row=mysql_fetch_array($resultado)){		  		  
		  
			  if($row['codcliente']==$codlider){
			   ?>
            <option selected="selected" value="<?php echo $row['codcliente'] ?>"><?php echo $row['razonsocial'] ?></option>
            <?php 
			  }else{
			    ?>
            <option value="<?php echo $row['codcliente'] ?>"><?php echo $row['razonsocial'] ?></option>
            <?php 
		  	 }
			 
		  } ?>
          </select>
</span></td>
        </tr>
		<?php 
		if($_REQUEST['tipomov']=='1'){
		?>
      <tr>
        <td height="29">&nbsp;</td>
        <td align="left" valign="middle"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Tipo Prov. </span></td>
        <td colspan="3" valign="middle"><select name="tipoprov">
          <option value="1" selected>Prov. Local</option>
          <option value="2">Prov. Importaci&oacute;n</option>
        </select>        </td>
      </tr>
	  <?php 
	  }else{?>
      <tr>
        <td height="29">&nbsp;</td>
        <td align="left" valign="middle"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Condici&oacute;n</span></td>
        <td valign="middle"><span class="Estilo15">
		
		<div id="cbo_cond2" style="width:120px">	
          <select name="aux_condicion" style="width:120" >
            <?php 
		    $resultados11 = mysql_query("select * from condicion order by nombre ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
		  ?>
            <option value="<?php echo $row11['codigo']?>"><?php echo $row11['nombre'];?></option>
            <?php }?>
          </select></div></span></td>
        <td colspan="2" valign="middle"><span class="Estilo15"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Responsable:
              <select name="aux_responsable" style="width:120px" >
                <?php 
		    $resultados11 = mysql_query("select * from usuarios order by usuario ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
		  ?>
                <option value="<?php echo $row11['codigo']?>"><?php echo $row11['usuario'];?></option>
                <?php }?>
              </select>
        </span></span></td>
        </tr>
	  <?php }?>
      <tr>
        <td height="30">&nbsp;</td>
        <td align="left"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Direcci&oacute;n</span></td>
        <td colspan="3"><textarea name="aux_direccion" cols="42" rows="3" onKeyUp="saltarCampo(event,this)"></textarea></td>
        </tr>
      <tr>
        <td height="29">&nbsp;</td>
        <td colspan="4" align="left"><input type="button" name="SubmitGC" value="Guardar" onClick="guardar_aux();" />
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
   
  <div id="productos" style="position:absolute; left:22px; top:205px; width:300px; height:180px; z-index:1; visibility:hidden"> </div>
  
   <div id="auxiliares" style="position:absolute; left:154px; top:138px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>

 <div id="choferes" style="position:absolute; left:274px; top:139px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>
 
 
 <div id="cambiarDirec" style="border:#238CE2 solid 1px; background:#E2FAFE; position:absolute; left:274px; top:139px; width:300px; height:180px; z-index:2; visibility:hidden; background-color: #F1FBFE;">
 
 <table width="298" height="187" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="26" style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px; color:#FFFFFF">&nbsp;</td>
    <td height="26" colspan="2" style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px; color:#FFFFFF"><strong>Cambiar Direcci&oacute;n </strong></td>
    <td height="26" align="center" style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px; color:#FFFFFF; text-decoration:underline; cursor:pointer" onClick="salir();"><strong>x</strong></td>
  </tr>
  <tr>
    <td height="9" colspan="4"></td>
  </tr>
  <tr>
    <td width="8">&nbsp;</td>
    <td width="95" height="23"><span class="Estilo112">Direcci&oacute;n Partida </span></td>
    <td width="169"><input type="text" name="dirPartida" id="dirPartida"></td>
    <td width="26" rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="8">&nbsp;</td>
    <td width="95" height="32"><span class="Estilo112">Direcci&oacute;n Destino </span></td>
    <td><input type="text" name="dirDestino" id="dirDestino">
      <input type="hidden" name="dirDestino2" id="dirDestino2"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="19" colspan="3"><span class="Estilo132">Otras direcciones </span></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="32" colspan="3">
	
	<div id="otrasDirec">	</div>	</td>
    </tr>
  <tr>
    <td height="46" colspan="4" align="center"><input onClick="salir();" type="button" name="Submit3" value="Aceptar">
      <input type="button" name="Submit4" value="Cancelar" onClick="salir();"></td>
    </tr>
</table>

 
</div>


 <div id="detTotales" style="background:#E2FAFE; position:absolute; left:152px; top:55px; z-index:2; visibility:hidden; background-color: #F1FBFE; width: 517px; height: 217px;">
 <!--<form id="frm_cajaFact" name="frm_cajaFact">-->
 <table width="516" height="215" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td height="23" colspan="3" ><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="54" style="background:url(../imagenes/img_panelbox/top_logo.gif) repeat-x scroll 0 0 transparent">&nbsp;</td>
        <td width="456" style="background:url(../imagenes/img_panelbox/top_m.gif) repeat-x scroll 0 0 transparent; "><table width="455" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="435"><span class="Estilo119">Detalle del Documento  </span>
              <input name="tope" type="hidden" value="A" ></td>
            <td width="20" align="center" style="cursor:pointer" onClick="cerrarTotales()"><span class="Estilo131">x</span></td>
          </tr>
        </table></td>
        <td width="6" style="background:url(../imagenes/img_panelbox/top_r.gif) repeat-x scroll 0 0 transparent"></td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td width="6" height="185" style="background:url(../imagenes/img_panelbox/left.gif) repeat scroll 0 0 transparent"></td>
    <td width="358" valign="top"><table width="498" height="183" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="223" height="19" align="center">&nbsp;</td>
        <td width="275" align="center" >&nbsp;</td>
        </tr>
      
      <tr>
        <td height="144" colspan="2" align="center"><table width="465" height="132" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="175" align="center"><span class="Estilo112">Valor de Venta </span></td>
            <td width="169" align="center"><span class="Estilo112">Desc</span></td>
            <td width="115" align="center"><span class="Estilo112">Flete</span></td>
            <td width="24">&nbsp;</td>
          </tr>
          <tr>
            <td height="26" align="center" valign="top"><input type="text" name="capa_valorVenta" id="capa_valorVenta" value="" style="width:80px"></td>
            <td align="center" valign="top"><input type="text" name="capa_valorVenta2" id="capa_valorVenta2" value="" style="width:80px"></td>
            <td align="center" valign="top"><input type="text" name="capa_valorVenta3" id="capa_valorVenta3" value="" style="width:80px"></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><span class="Estilo112">Subtotal</span></td>
            <td align="center"><span class="Estilo112">Impuesto(18%)</span></td>
            <td align="center"><span class="Estilo112">Total Doc. </span></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="26" align="center" valign="top"><span class="Estilo112">
              <input type="text" name="capa_valorVenta4" id="capa_valorVenta4" value="" style="width:80px">
            </span></td>
            <td align="center" valign="top"><span class="Estilo112">
              <input type="text" name="capa_valorVenta5" id="capa_valorVenta5" value="" style="width:80px">
            </span></td>
            <td align="center" valign="top"><span class="Estilo112">
              <input type="text" name="capa_valorVenta6" id="capa_valorVenta6" value="" style="width:80px">
            </span></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><span class="Estilo112">Percepcion</span></td>
            <td align="center" bgcolor="#FFDD55"><span class="Estilo112">TOTAL A PAGAR </span></td>
            <td align="center"><span class="Estilo112"></span></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="23" align="center"><input type="text" name="capa_valorVenta7" id="capa_valorVenta7" value="" style="width:80px"></td>
            <td align="center" bgcolor="#FFDD55"><input type="text" name="capa_valorVenta8" id="capa_valorVenta8" value="" style="width:80px"></td>
            <td align="center">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="19" align="center">&nbsp;</td>
        <td height="19" align="center">&nbsp;</td>
        </tr>
    </table></td>
    <td width="6" style=" background:url(../imagenes/img_panelbox/right.gif) repeat scroll 0 0 transparent"></td>
  </tr>
  
  <tr>
    <td height="7" align="center" style="background:url(../imagenes/img_panelbox/bottom_l.gif) repeat scroll 0 0 transparent"></td>
    <td height="7" align="center" style="background:url(../imagenes/img_panelbox/bottom_m.gif) repeat scroll 0 0 transparent"></td>
    <td width="6" style="background:url(../imagenes/img_panelbox/bottom_r.gif) repeat scroll 0 0 transparent"></td>
  </tr>
</table>
<!--</form>-->
</div>

<div id="cajaFact" style="background:#E2FAFE; position:absolute; left:152px; top:55px; z-index:2; visibility:hidden; background-color: #F1FBFE; width: 517px; height: 339px;">
 <!--<form id="frm_cajaFact" name="frm_cajaFact">-->
 <table width="516" height="338" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td height="23" colspan="3" ><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="54" style="background:url(../imagenes/img_panelbox/top_logo.gif) repeat-x scroll 0 0 transparent">&nbsp;</td>
        <td width="456" style="background:url(../imagenes/img_panelbox/top_m.gif) repeat-x scroll 0 0 transparent; "><table width="455" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="435"><span class="Estilo119">Caja Facturaci&oacute;n </span>
              <input name="tope" type="hidden" value="A" ></td>
            <td width="20" align="center" style="cursor:pointer" onClick="cerrarCaja()"><span class="Estilo131">x</span></td>
          </tr>
        </table></td>
        <td width="6" style="background:url(../imagenes/img_panelbox/top_r.gif) repeat-x scroll 0 0 transparent"></td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td width="6" height="308" style="background:url(../imagenes/img_panelbox/left.gif) repeat scroll 0 0 transparent"></td>
    <td width="358" valign="top"><table width="498" height="299" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="283" height="154" rowspan="2" align="center"><table width="100%" height="100%" border="0">
          <tr>
            <td>
			<fieldset><legend>Pagos</legend>
          <table width="270" height="143" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="31" colspan="3"><span class="Estilo127">Tipo Pago :</span>
                  <select  id="tpago" name="tpago" onChange="colocar();" style="width:160px" >
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
$strSQL="select * from t_pago order by id ";		  
$resultado=mysql_query($strSQL,$cn);	
while($row=mysql_fetch_array($resultado)){
	echo "<option value=".$row['id'].">".$row['descripcion']."</option>"	;
}
  ?>
                </select></td>
            </tr>
            <tr>
              <td height="24" colspan="3"><span class="Estilo127">Fecha :</span>
                <input  style="text-align:right; font:bold ; font-size:12px" name="fechaPago" id="fechaPago" type="text" size="10" readonly value="<?php  ?>" disabled="disabled" />                
                &nbsp;<span class="Estilo127">&nbsp;Tipo Cambio: </span>
                <input  style="text-align:right; font:bold ; font-size:12px" name="tcPago" id="tcPago" type="text" size="5" readonly value="<?php echo $_SESSION['tc_promedio']; ?>"  disabled="disabled"/></td>
            </tr>
            <tr>
              <td height="32" colspan="3"><span class="Estilo127">N&uacute;mero:</span>
                  <input type="text" name="numero_tarjeta" onKeyUp="pasarCampoCaja(event,this)"></td>
            </tr>
            <tr>
              <td width="90" height="14" align="center"><span class="Estilo129 Estilo130">SOLES</span></td>
              <td align="center"><span class="Estilo129 Estilo130">D&Oacute;LARES</span></td>
              <td width="73" rowspan="2" align="center"><input onMouseOver="cambiar_fondo2(this,'e')" onMouseOut="cambiar_fondo2(this,'s')" style="border:none; height:35px; width:80px; vertical-align:top;background-image:url(../imagenes/boton_aplicar3.gif) ; cursor:pointer; font:bold; font-size:10px; text-align:center" type="button" name="Submit5" value=" Insertar&#10;Pago" onClick="insertPagoC()" ></td>
            </tr>
            <tr>
              <td height="21" align="center"><input  style="text-align:right; font:bold ; font-size:12px" name="soles" type="text" size="8"  value="<?php  ?>"  onKeyPress="c_soles(event,this)"/></td>
              <td width="107" align="center"><input  style="text-align:right; font:bold ; font-size:12px" name="dolares" type="text" size="8"  value="<?php  ?>"  onKeyPress="c_dolares(event,this)" /></td>
              </tr>
            <tr>
              <td height="10" colspan="3" align="center"></td>
              </tr>
          </table>
        </fieldset>			</td>
          </tr>
        </table>		</td>
        <td width="53" height="31" align="center" ><span class="Estilo126">Importe:</span></td>
        <td width="162" align="center" ><span class="Estilo125"><label id="etiqMonCaja"></label> <label id="montoCajaF"></label> 
		
          <input  name="importe2" type="hidden" id="importe2" size="10"  />
        </span></td>
      </tr>
      <tr>
        <td height="54" colspan="2" align="right"><table width="213" border="1" cellpadding="0" cellspacing="0">
          <tr>
            <td width="149" bgcolor="#FFFF99"><span class="Estilo14"><strong>Total (S/.)</strong></span></td>
            <td width="91" align="right" bgcolor="#FFFF99"><input  style="text-align:right; font:bold ; font-size:12px" name="total_s" type="text" size="10" readonly value="0" /></td>
          </tr>
          <tr>
            <td bgcolor="#FFFF99" class="Estilo14"><strong>Total (US$)</strong></td>
            <td align="right" bgcolor="#FFFF99"><input style="text-align:right; font:bold ; font-size:12px" name="total_d" type="text" size="10" readonly value="0" /></td>
          </tr>
          <tr>
            <td class="Estilo31" style="background-color:#1789DD">A cuenta</td>
            <td align="right" style="background-color:#1789DD"><input style="text-align:right; font:bold ; font-size:12px" name="acuenta" type="text" size="10" readonly value="0.00"></td>
          </tr>
          <tr>
            <td bgcolor="#FFFF99" class="Estilo118"><strong>Saldo S/.</strong></td>
            <td align="right" bgcolor="#FFFF99"><input readonly style="text-align:right; font:bold ; font-size:12px" name="pendiente_s" id="pendiente_s" type="text" size="10" value="0"></td>
          </tr>
          <tr>
            <td bgcolor="#FFFF99" class="Estilo118"><strong>Saldo US$.</strong></td>
            <td align="right" bgcolor="#FFFF99"><input readonly style="text-align:right; font:bold ; font-size:12px" name="pendiente_d" id="pendiente_d" type="text" size="10" value="0"></td>
          </tr>
          
        </table></td>
      </tr>
      <tr>
        <td height="76" colspan="3" align="center">
		
		<div id="pagos_d" style="height:100px; width:480px; overflow-y:scroll">
            <table width="446" align="center" border="0" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF" >
              <tr   style="background-color:#1789DD">
                <td width="40" align="center" ><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">Tipo</font></strong></td>
                <td width="127" align="center"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">T.pago</font></strong></td>
                <td align="center" width="61"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">N&uacute;mero</font></strong></td>
                <td align="center" width="81"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">Soles</font></strong></td>
                <td align="center" width="38"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">T.c</font></strong></td>
                <td align="center" width="74"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">D&oacute;lares</font></strong></td>
                <td align="center" width="31"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">E</font></strong></td>
              </tr>
             
              <tr>
                <td width="40" align="center" bgcolor="#F4F4F4">&nbsp;</td>
                <td width="127" align="center" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px">
                  
                </font></td>
                <td width="61" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px"></font></td>
                <td width="81" align="right" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px">
                 
                </font></td>
                <td width="38" align="center" bgcolor="#F4F4F4">&nbsp;</td>
                <td width="74" align="right" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px">
                
                </font></td>
                <td width="31" align="center" bgcolor="#F4F4F4"></td>
              </tr>
            </table>
          </div>		</td>
      </tr>
      <tr>
        <td height="59" align="center">
		<table width="10" border="0">
  <tr>
    <td><fieldset>
          <table width="264" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="137"><span class="Estilo115">Vuelto</span></td>
              <td width="111" rowspan="2" align="center"><input name="vuelto" type="text" style="text-align:right; vertical-align:middle; font:bold; font-size:22px; height:40px" size="6" readonly></td>
            </tr>
            <tr>
              <td><select name="vueltoen" onChange="cambiar_vuelto()">
                  <option value="01">SOLES  (S/.)</option>
                  <option value="02">D&Oacute;LARES (US$)</option>
              </select></td>
            </tr>
          </table>
        </fieldset></td>
  </tr>
</table>

		
		</td>
        <td height="59" colspan="2" align="center"><input onClick="guardarCaja()" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(../imagenes/boton_aplicar.gif) ; cursor:pointer; font:bold; font-size:10px;" type="button" name="Submit52" value=" Guardar " ></td>
        </tr>
    </table></td>
    <td width="6" style=" background:url(../imagenes/img_panelbox/right.gif) repeat scroll 0 0 transparent"></td>
  </tr>
  
  <tr>
    <td height="7" align="center" style="background:url(../imagenes/img_panelbox/bottom_l.gif) repeat scroll 0 0 transparent"></td>
    <td height="7" align="center" style="background:url(../imagenes/img_panelbox/bottom_m.gif) repeat scroll 0 0 transparent"></td>
    <td width="6" style="background:url(../imagenes/img_panelbox/bottom_r.gif) repeat scroll 0 0 transparent"></td>
  </tr>
</table>
<!--</form>-->
</div>

<div id="divLotes" style="background:#E2FAFE; position:absolute; left:150px; top:141px; z-index:2; visibility:hidden; background-color: #F1FBFE; width: 517px; height: 149px;">
 <!--<form id="frm_cajaFact" name="frm_cajaFact">-->
 <table width="516" height="146" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td height="23" colspan="3" ><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="54" style="background:url(../imagenes/img_panelbox/top_logo.gif) repeat-x scroll 0 0 transparent">&nbsp;</td>
        <td width="456" style="background:url(../imagenes/img_panelbox/top_m.gif) repeat-x scroll 0 0 transparent; "><table width="455" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="435"><span class="Estilo119">INGRESO DE LOTES</span></td>
            <td width="20" align="center" style="cursor:pointer" onClick="cerrarDivLote()"><span class="Estilo131">x</span></td>
          </tr>
        </table></td>
        <td width="6" style="background:url(../imagenes/img_panelbox/top_r.gif) repeat-x scroll 0 0 transparent"></td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td width="6" height="116" style="background:url(../imagenes/img_panelbox/left.gif) repeat scroll 0 0 transparent"></td>
    <td width="358" valign="top"><table width="498" height="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="41" height="24" align="left">&nbsp;</td>
        <td width="457" align="left">Producto seleccionado requiere el ingreso de Lotes:</td>
      </tr>
      <tr>
        <td height="71" colspan="2" align="center"><table width="418" height="77" border="0">
          <tr>
            <td width="98" style="font-weight:bold; font-size:10px">LOTE NRO :</td>
            <td width="304">
              <input name="des_lote" type="text" id="des_lote" size="30" maxlength="50"  disabled="disabled" ></td>
          </tr>
          <tr>
            <td style="font-weight:bold; font-size:10px">Fecha de Venc.</td>
            <td><input name="venc_lote" type="text" id="venc_lote" size="15" maxlength="10" value=""  >
              <button disabled="disabled" type="reset" id="f_trigger_b4"  style="height:18; visibility:hidden" >...</button>
              <script type="text/javascript">
    Calendar.setup({
        inputField     :    "venc_lote",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b4",   
        singleClick    :    true,           
        step           :    1                
    });
              </script></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input type="button" name="buttonAcpL" id="buttonAcpL" value="Aceptar" onClick="aceptarLote()">
              <input type="button" name="button3" id="button2" value="Cancelar" onClick="cerrarDivLote()"></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td height="19" colspan="2" align="center">&nbsp;</td>
        </tr>
    </table></td>
    <td width="6" style=" background:url(../imagenes/img_panelbox/right.gif) repeat scroll 0 0 transparent"></td>
  </tr>
  
  <tr>
    <td height="7" align="center" style="background:url(../imagenes/img_panelbox/bottom_l.gif) repeat scroll 0 0 transparent"></td>
    <td height="7" align="center" style="background:url(../imagenes/img_panelbox/bottom_m.gif) repeat scroll 0 0 transparent"></td>
    <td width="6" style="background:url(../imagenes/img_panelbox/bottom_r.gif) repeat scroll 0 0 transparent"></td>
  </tr>
</table>
<!--</form>-->
</div>

<div id="divLotesVenta" style="background:#E2FAFE; position:absolute; left:156px; top:91px; z-index:2; visibility:hidden; background-color: #F1FBFE; width: 517px; height: 149px;">
 <!--<form id="frm_cajaFact" name="frm_cajaFact">-->
 <table width="516" height="146" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td height="23" colspan="3" ><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="54" style="background:url(../imagenes/img_panelbox/top_logo.gif) repeat-x scroll 0 0 transparent">&nbsp;</td>
        <td width="456" style="background:url(../imagenes/img_panelbox/top_m.gif) repeat-x scroll 0 0 transparent; "><table width="455" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="435"><span class="Estilo119">SALIDA DE LOTES</span></td>
            <td width="20" align="center" style="cursor:pointer" onClick="cerrarDivLote()"><span class="Estilo131">x</span></td>
          </tr>
        </table></td>
        <td width="6" style="background:url(../imagenes/img_panelbox/top_r.gif) repeat-x scroll 0 0 transparent"></td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td width="6" height="116" style="background:url(../imagenes/img_panelbox/left.gif) repeat scroll 0 0 transparent"></td>
    <td width="358" valign="top"><table width="498" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#F1FBFE">
      <tr>
        <td width="24" height="62" align="left">&nbsp;</td>
        <td width="311" align="left">Producto : 
        <label id="lblProdLote" style="color:#06F">
                
        </label>
        </td>
        <td width="163" align="left"><table width="200" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="98" rowspan="2" align="center" ><fieldset>
              <strong> <span style="font:Arial, Helvetica, sans-serif; font-size:10px; color:#000000" >Cantidad Requerida:</span></strong><br>
              <input name="cant_req_lotes" id="cant_req_lotes" type="text" value="0" size="3" style="border:none; background:none; color:#06F; font-weight:bold; text-align:center" />
            </fieldset></td>
            <td width="25" rowspan="2" align="center" ></td>
            <td width="77" rowspan="2" align="center" ><fieldset>
              <strong> <span style="font:Arial, Helvetica, sans-serif; font-size:10px; color:#000000" >Cantidad
                Seleccionada</span></strong><br>
                <input name="cant_selec_lotes" id="cant_selec_lotes" type="text" value="0" size="3" style="border:none; background:none; color:#06F; font-weight:bold; text-align:center" />
            </fieldset></td>
          </tr>
          <tr></tr>
          </table></td>
      </tr>
      <tr>
        <td height="71" align="center">&nbsp;</td>
        <td height="71" colspan="2" align="center"><table width="460" height="41" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="53" align="center" bgcolor="#CCCCCC"><span style="color:#000; font-weight:bold">Selec.</span></td>
            <td width="121" height="19" align="center" bgcolor="#CCCCCC"><span style="color:#000; font-weight:bold">Lote Nro.</span></td>
            <td width="108" align="center" bgcolor="#CCCCCC"><span style="color:#000; font-weight:bold">fecha Venc</span></td>
            <td width="89" align="center" bgcolor="#CCCCCC"><span style="color:#000; font-weight:bold">Stock</span></td>
            <td width="78" align="center" bgcolor="#CCCCCC"><span style="color:#000; font-weight:bold">Costo</span></td>
            <td width="11" align="center" bgcolor="#CCCCCC"><span style="color:#000; font-weight:bold">&nbsp;</span></td>
          </tr>
          <tr>
            <td height="22" colspan="6" align="left">
            
            <div id="divLotesDisponible" style="overflow-y:scroll; height:150px" >            </div>            </td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td height="19" colspan="3" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td height="19" colspan="3" align="center">
        
        <input onClick="aeptarDivLoteV()" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(../imagenes/boton_aplicar.gif) ; cursor:pointer" type="button" name="Submit" value="Aceptar" />
        </td>
        </tr>
      <tr>
        <td height="19" colspan="3" align="center">&nbsp;</td>
      </tr>
    </table></td>
    <td width="6" style=" background:url(../imagenes/img_panelbox/right.gif) repeat scroll 0 0 transparent"></td>
  </tr>
  
  <tr>
    <td height="7" align="center" style="background:url(../imagenes/img_panelbox/bottom_l.gif) repeat scroll 0 0 transparent"></td>
    <td height="7" align="center" style="background:url(../imagenes/img_panelbox/bottom_m.gif) repeat scroll 0 0 transparent"></td>
    <td width="6" style="background:url(../imagenes/img_panelbox/bottom_r.gif) repeat scroll 0 0 transparent"></td>
  </tr>
</table>
<!--</form>-->
</div>

</form>

<div id="capaCopiarDoc" style="border:#238CE2 solid 1px; background:#E2FAFE; position:absolute; left:238px; top:15px; z-index:100; visibility:hidden; background-color: #F1FBFE; width: 372px;">
 <form id="frmCopiarDoc" name="frmCopiarDoc">
 <table width="372" height="363" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="26" style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px; color:#FFFFFF">&nbsp;</td>
    <td width="346" height="26" style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px; color:#FFFFFF"><strong>Copiar Documento </strong></td>
    <td height="26" align="center" style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px; color:#FFFFFF; text-decoration:underline; cursor:pointer" onClick="salir();"><strong>x</strong></td>
  </tr>
  <tr>
    <td height="9" colspan="3"></td>
  </tr>
  <tr>
    <td height="25"></td>
    <td height="25"><fieldset><legend>Origen</legend>
      <table width="341" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="159">Documento</td>
          <td width="28">&nbsp;</td>
          <td width="154">N&uacute;mero</td>
        </tr>
        <tr>
          <td><input type="text" name="docOrigen" disabled="disabled"></td>
          <td>&nbsp;</td>
          <td><input name="serieOrigen" type="text" size="3" disabled="disabled">
            <input name="numeroOrigen" type="text" size="10" disabled="disabled">
            <input name="cod_cabaCopiar" type="hidden" size="5"></td>
        </tr>
      </table>
    </fieldset></td>
    <td height="25"></td>
  </tr>
  <tr>
    <td height="9" colspan="3"></td>
  </tr>
  <tr>
    <td height="9" colspan="3"></td>
  </tr>
  <tr>
    <td width="9">&nbsp;</td>
    <td height="23"><fieldset><legend>Destino</legend>
      <table width="335" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="2">Empresa</td>
          <td colspan="2">Almac&eacute;n</td>
          </tr>
        <tr>
          <td colspan="2"><select style="width:160"  name="sucursal"  onChange="doAjax('../carga_cbo_tienda.php','&codsuc='+document.frmCopiarDoc.sucursal.value,'cargar_cbo','get','0','1','','');cambiar_enfoque(this);" >
            <option value="0"></option>
            <?php 
		
  $resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn); 
  $k=0;
while($row1=mysql_fetch_array($resultados1))
{
echo "<script> array_idsuc[$k]='".$row1['cod_suc']."'; array_percepsuc[$k]='".$row1['percepcion']."'; </script>";
		?>
            <option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
            <?php 
			  
$k++;
}?>
          </select></td>
          <td colspan="2"><div id="div2">
            <select  style="width:160" name="almacen"  onBlur="">
              <option value="0"></option>
            </select>
          </div></td>
          </tr>
        <tr>
          <td colspan="2">Documento</td>
          <td width="118">N&uacute;mero</td>
          <td width="47">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><div id="div3">
            <select  style="width:160" name="doc"  onBlur="">
              <option value="0"></option>
            </select>
          </div></td>
          <td colspan="2"><input  name="serie" type="text" size="3" onKeyUp="genNumCopiar(event,this)">
            <input name="numero"  type="text" size="10" onKeyUp="validarNumCopiar(event,this)">
			
			 <input name="temp_doc" type="hidden" size="5">
			</td>
          </tr>
        <tr>
          <td width="88">&nbsp;</td>
          <td width="82">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </fieldset> 
    
	
			<input name="impto" id="impto" type="hidden" size="6" maxlength="6" value="">
            <input name="percep_suc" id="percep_suc" type="hidden" size="6" maxlength="6" value="">
            <input name="percep_doc" id="percep_doc" type="hidden" size="6" maxlength="6" value="">
            <input name="min_percep_doc" id="min_percep_doc" type="hidden" size="6" maxlength="6" value="">
            <input name="est_percep_clie" id="est_percep_clie" type="hidden" size="6" maxlength="6" value="">
            <input name="por_percep_clie" id="por_percep_clie" type="hidden" size="6" maxlength="6" value="">
	
	</td>
    <td width="17" rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="9">&nbsp;</td>
    <td height="73"><label></label>
      <table width="342" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="170">Auxiliar &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a style="cursor:pointer" onClick="cambiar_chofer('A')">Editar</a></td>
          <td width="165"><label></label>
Responsable </td>
        </tr>
        <tr>
          <td>
		    <input name="auxOrigen" type="text" disabled="disabled" size="25" >
            <input type="hidden" name="auxOrigen2">
			<input type="hidden" name="dirauxOrigen">
									
			</td>
          <td>
		  
		  <select name="responsable" style="width:160" onChange=""  >
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
            </select>		  </td>
        </tr>
        <tr>
          <td height="20">Fecha de Emisi&oacute;n            </td>
          <td>Fecha de Vencimiento</td>
        </tr>
        <tr>
          <td height="20"><input name="femi" type="text" size="12" value="<?php echo date("d-m-Y")?>"></td>
          <td><input name="fven" type="text" size="12" value="<?php echo date("d-m-Y")?>"></td>
        </tr>
      </table></td>
    </tr>
  <tr style="visibility:hidden" >
    <td>&nbsp;</td>
    <td height="19"><label>
    <input type="checkbox" name="checkbox2" value="checkbox">
    Trasladar Series 
    
    </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="46" colspan="3" align="center"><input disabled="disabled" onClick="controlStock();" type="button" name="btncopiar" value="Copiar">
      <input type="button" name="Submit4" value="Cancelar" onClick="salir();"></td>
    </tr>
</table>

 </form>
</div>


	<div id="divOrder" style="position:absolute; left: 447px; top: 278px; height: 48px; width: 95px; display:none; z-index:9999">
		  
			
            <td width="94" colspan="2" align="center" ><font face="Verdana, Arial, Helvetica, sans-serif" color="#333333" style="font-size:10px"><strong <?php echo $ocultar?> ></strong></font></td>
			</tr>	  
        </table></td>
        <td width="4">&nbsp;</td>
        <td width="4">&nbsp;</td>
      </tr>
	    <table width="75" height="48" border="1"  bgcolor="#1DC0BC">
              <tr>
                <td><table width="92" border="0" cellpadding="0" cellspacing="0">
                  <tr  onMouseOver="entradaOrder(this)" onMouseOut="entradaOrder(this)" style="cursor:pointer" onClick="cambiarPrecio('')">
                    <td height="18" class="Estilo118 Estilo119 Estilo121" style="font:bold; color:#FFFFFF; font-size:11px">&nbsp;Precio 1</td>
                  </tr>
                  <tr onMouseOver="entradaOrder(this)" onMouseOut="entradaOrder(this)" style="cursor:pointer" onClick="cambiarPrecio('2')" >
                    <td height="18" class="Estilo118 Estilo119 Estilo121" style="font:bold; color:#FFFFFF; font-size:11px">&nbsp;Precio 2</td>
                  </tr>
				   <tr onMouseOver="entradaOrder(this)" onMouseOut="entradaOrder(this)" style="cursor:pointer" onClick="cambiarPrecio('3')" >
                    <td height="18" class="Estilo118 Estilo119 Estilo121" style="font:bold; color:#FFFFFF; font-size:11px">&nbsp;Precio 3</td>
                  </tr>
				   <tr onMouseOver="entradaOrder(this)" onMouseOut="entradaOrder(this)" style="cursor:pointer" onClick="cambiarPrecio('4')" >
                    <td height="18" class="Estilo118 Estilo119 Estilo121" style="font:bold; color:#FFFFFF; font-size:11px">&nbsp;Precio 4</td>
                  </tr>
				   <tr onMouseOver="entradaOrder(this)" onMouseOut="entradaOrder(this)" style="cursor:pointer" onClick="cambiarPrecio('5')" >
                    <td height="18" class="Estilo118 Estilo119 Estilo121" style="font:bold; color:#FFFFFF; font-size:11px">&nbsp;Precio 5</td>
                  </tr>
                </table></td>
              </tr>
      </table></div></body>

<script>
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


	if(document.formulario.tipomov.value==1){
	 document.formulario.punit.value=(parseFloat(document.formulario.precio.value)/parseFloat(document.formulario.cantidad.value)).toFixed(4);
	 
	}else{
		
		var total=(precio/punit).toFixed(4);
		if(total>0){
			document.formulario.cantidad.value=total;
		}else{
			document.formulario.cantidad.value="";
		}
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
var temp_envio_det=0;

function mostrar_BucarCorrLote(data){

document.formulario.des_lote.value=document.formulario.termino.value.substring(0,3).toUpperCase()+data;

}


function enviar(){
	//if(document.formulario.codprod.value==''){
	//punit=document.formulario.termino.value; //parseFloat(document.formulario.termino.value);
	//}else{
	//alert();
	
	if(document.formulario.lotes.value=='S' && document.formulario.des_lote.value=='' && document.formulario.tipomov.value==1){
		generateCoverDiv("capa_fondo","#000000",10);
		document.getElementById('divLotes').style.visibility="visible";
		document.formulario.des_lote.focus();
		//document.formulario.des_lote.disabled=false;
		document.formulario.venc_lote.disabled=true;
		document.formulario.buttonAcpL.disabled=false;
		var producto=document.formulario.codprod.value;	
		
		document.formulario.venc_lote.value=document.formulario.femi.value;
		
		document.formulario.buttonAcpL.focus();
		
		document.formulario.des_lote.value=document.formulario.termino.value.substring(0,1).toUpperCase()+document.formulario.termino.value.substring(1,2).toUpperCase()+parseInt(Math.random()*9999);
		//doAjax('peticion_datos.php','&peticion=BucarCorrLote&producto='+producto,'mostrar_BucarCorrLote','get','0','1','','');		
		
		return false;
	}
	
	
	if(document.formulario.lotes.value=='S' && document.formulario.tipomov.value==2 && document.formulario.tempLotesVenta.value==''){
		generateCoverDiv("capa_fondo","#000000",10);
		document.getElementById('divLotesVenta').style.visibility="visible";
		
		document.getElementById("lblProdLote").innerHTML=document.formulario.termino.value;
		var tienda=document.formulario.almacen.value;
		var producto=document.formulario.codprod.value;	
		document.formulario.cant_req_lotes.value=document.formulario.cantidad.value;
		
		doAjax('peticion_datos.php','&peticion=Lotes_Salida_dispo&tienda='+tienda+'&producto='+producto,'mostrar_lotesDisp','get','0','1','','');		
		
		return false;
	}
	
	
	
	var termino=document.formulario.termino.value;
	var punit=parseFloat(document.formulario.punit.value);
	//}
	
	if(document.formulario.factor_p.value>1 && document.formulario.esmodelo.value=='S'){
	
		var residuo=parseFloat(document.formulario.cantidad.value)%parseFloat(document.formulario.cantModelo.value);
		
		if(residuo!=0 && document.formulario.saldo.value <= 0){
		alert("cantidad ingresada debe ser multiplo mayor del producto modelo a generar");
		document.form1.cantidad.focus();
		document.form1.cantidad.select();
		return false;
		}
		
	}
	
	
	 var permiso16=find_prm(tab16,tab_cod);
						 // 
						 // alert(permiso16);
		  if(permiso16=='N' && document.formulario.codprod.value!=''){
		//	if((document.formulario.precio.value==0 || document.formulario.precio.value=='' ) && document.formulario.doc.value!='GR'){
			if( (document.formulario.punit.value==0 || document.formulario.punit.value=='' ) ){
				//alert(document.formulario.doc.value);
				/*
				if(permiso_modifPrecio=='N'){
				document.formulario.punit.focus();
				document.formulario.punit.select();							
				return false;
				}else{
				enviar();
				}
				*/
				alert("El producto seleccionado no tiene precio asignado");	
				
				if(permiso_modifPrecio=='N'){
				document.formulario.punit.focus();
				document.formulario.punit.select();	
				}else{
				document.formulario.cantidad.focus();
				document.formulario.cantidad.select();
				}
				
				return false;
			}
	
	}
	
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
	
	
	//alert();
	if(document.formulario.tmoneda.value==02 && document.formulario.prod_moneda.value==01){
	var punit2=parseFloat(punit/tc_doc).toFixed(4);
	var pcst=parseFloat(document.formulario.precosto.value/tc_doc).toFixed(4);
	}else{
		if(document.formulario.tmoneda.value==01 && document.formulario.prod_moneda.value==02){
			var punit2=parseFloat(punit*tc_doc).toFixed(4);
			var pcst=parseFloat(document.formulario.precosto.value*tc_doc).toFixed(4);
		}else{
			var punit2=punit;
			var pcst=parseFloat(document.formulario.precosto.value);
		}
	}
		
	
	/* Si funciona Precio menor al costo*/
	//punit
	
	//alert(punit+" - "+pcst);
	var permiso16=find_prm(tab16,tab_cod);
	
	
	if(punit<pcst && parseFloat(document.formulario.tipomov.value)==2 && permiso16=='N'){
	alert('El precio no puede ser menor al ' + etiqPrecio5 );
	document.formulario.punit.focus();
	document.formulario.punit.select();
	return false;
	}
	
//Fin del verificador precios	
	
	
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
	var fechaEmi=document.formulario.femi.value;
	var condicion=document.formulario.condicion.value;
	var tienda=document.formulario.almacen.value;
	var permiso21=find_prm(tab_descuento,tab_cod);//mostrar descuento
	var permiso27=find_prm(tab_puntos,tab_cod);
	var permiso28=find_prm(tab_envases,tab_cod);
	var tipoDescuento=find_prm(tab_tipoDesc,tab_cod);
	var pcajas=document.formulario.pcajas.value;
	var stockProd=document.formulario.saldo.value;
	
	permiso_modifPrecio=find_prm(tab_modifPrecio,tab_cod);
	
	
	var des_lote=document.formulario.des_lote.value;
	var venc_lote=document.formulario.venc_lote.value;
	
//	alert(document.formulario.tmoneda.value+" - "+temp_mon);


	if(temp_envio_det==0){
	
	temp_envio_det=1;
	//alert(notas);
	
	
	
	doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&punitario='+punit+'&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&notas='+notas+'&presentacion='+presentacion+'&esserie='+esserie+'&permiso10='+permiso10+'&cargar_ref=noref&precosto='+pcst+'&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov+'&codAnexProd='+codAnexProd+'&termino='+termino+'&pase='+pase+'&fechaEmi='+fechaEmi+'&condicion='+condicion+'&tienda='+tienda+'&permiso21='+permiso21+'&permiso27='+permiso27+'&permiso28='+permiso28+'&tipoDescuento='+tipoDescuento+'&pcajas='+pcajas+'&permiso_modifPrecio='+permiso_modifPrecio+'&stockProd='+stockProd+'&des_lote='+des_lote+'&venc_lote='+venc_lote,'mostrar','get','0','1','','');
	
	}else{
	
	
	
	}
	
	document.formulario.chkpase.checked=false;	
}

function pintar(enl){
//alert(enl);
//document.getElementById('pro').style.borderColor='#FF0000';
//document.formulario.codprod.style.background = "#FFDDCC";
//document.formulario.codprod.style. = "#FFDDCC";
}


function cerrar_div(){
document.getElementById('productos').style.visibility='hidden';
}

function elegir(cod,des){
document.formulario.codprod.value=cod;
document.formulario.termino.value=removeTags(des);

document.getElementById('productos').style.visibility='hidden';
document.formulario.ter.value=0;
//document.formulario.cantidad.value=1;

document.formulario.cantidad.disabled=false;
document.formulario.precio.readOnly=false;

permiso_modifPrecio=find_prm(tab_modifPrecio,tab_cod);
//alert(permiso_modifPrecio);
if(permiso_modifPrecio=='N'){
document.formulario.punit.disabled=false;
document.formulario.precio.disabled=false;
}

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
		var permiso28=find_prm(tab_envases,tab_cod);
		
		if(document.formulario.factor_p.value==1 || permiso28=='S'){
		document.formulario.cantidad.focus();
		}else{
		calc_pre_total();
		
		/*
			if(document.formulario.punit.value!=0){
		//alert();
				document.formulario.precio.focus();
				document.formulario.precio.select();
			}else{
				document.formulario.cantidad.focus();
			}	
		*/
			
			document.formulario.cantidad.focus();
		}
		
	}
}

function trim(valor){

return valor.replace(/^\s+/g,'').replace(/\s+$/g,'');

}

function elegir2(cod,des){
//razon.replace('&','amps')
des=des.replace('amps','&');
//alert("-->"+des+"<--");
document.formulario.auxiliar.value=removeTags(trim(des));
document.formulario.auxiliar2.value=cod;
document.getElementById('auxiliares').style.visibility='hidden';

//seleccionar_cbo('condicion',condClie);
mostrar_cbos();

			var serie=document.formulario.num_serie.value;
			var numero=document.formulario.num_correlativo.value;
			var doc=document.formulario.doc.value;
			var sucursal=document.formulario.sucursal.value;
			var tipomov=document.formulario.tipomov.value;
			
	if(tipomov==1){
	//alert();
	doAjax('peticion_datos.php','&serie='+serie+'&numero='+numero+'&doc='+doc+'&sucursal='+sucursal+'&auxiliar='+cod+'&peticion=buscar_prov2&tipomov='+tipomov,'rpta_con_datos2','get','0','1','','');
	}else{

				if(tempNivelUser!='1' && tempNivelUser!='7'){
				document.formulario.responsable.disabled=false;
				document.formulario.responsable.focus();
				}else{
				document.formulario.responsable.disabled=false;
				document.formulario.responsable.focus();
				//cbo_cond();
				}
				document.formulario.codprod.disabled=false;
				document.formulario.codprod.focus();
				
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
			
			document.formulario.codprod.disabled=false;
			document.formulario.codprod.focus();
			
		}else{
			 
			 habilitar();
			 
			 seleccionar_cbo('almacen',temp[2]);
			 seleccionar_cbo('responsable',temp[3]);	
			 seleccionar_cbo('condicion',temp[4]);	
			 document.formulario.femi.value=temp[5].substring(0,10);
			 document.formulario.fven.value=temp[6].substring(0,10);
			 document.formulario.temp_doc.value=temp[0];
			 //alert();
			 //document.formulario.almacen.disabled=false;
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
			 var fechaEmi=document.formulario.femi.value;
	         var condicion=document.formulario.condicion.value;
	         var tienda=document.formulario.almacen.value;
			 var permiso21=find_prm(tab_descuento,tab_cod);//mostrar descuento
			 var permiso27=find_prm(tab_puntos,tab_cod);
			 var permiso28=find_prm(tab_envases,tab_cod);
			 var tipoDescuento=find_prm(tab_tipoDesc,tab_cod);
			var stockProd=document.formulario.saldo.value;
			
							 			 
			 doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&punitario='+document.formulario.punit.value+'&accion=mostrarprod&permiso4='+permiso4+'&permiso10='+permiso10+'&tmoneda2='+tmoneda2+'&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov+'&fechaEmi='+fechaEmi+'&condicion='+condicion+'&tienda='+tienda+'&permiso21='+permiso21+'&permiso27='+permiso27+'&permiso28='+permiso28+'&tipoDescuento='+tipoDescuento+'&stockProd='+stockProd,'mostrar','get','0','1','','');				
		
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
			 document.formulario.obs1.value=temp[25];
			 document.formulario.obs2.value=temp[26];
			 document.formulario.obs3.value=temp[27];
			 document.formulario.obs4.value=temp[28];
			 document.formulario.obs5.value=temp[29];
			 
			 document.formulario.aud_fecha.value=temp[30];
			 document.formulario.aud_pc.value=temp[31];
			 document.formulario.aud_usuario.value=temp[32];
			 
			 
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
			 
			 //alert(document.formulario.estado.value);
			 
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
			 var fechaEmi=document.formulario.femi.value;
	         var condicion=document.formulario.condicion.value;
			 var tienda=document.formulario.almacen.value;
			// alert(document.getElementById("estado").innerHTML);
			 var permiso21=find_prm(tab_descuento,tab_cod);//mostrar descuento
			 var permiso27=find_prm(tab_puntos,tab_cod);
			 var permiso28=find_prm(tab_envases,tab_cod);
			 var tipoDescuento=find_prm(tab_tipoDesc,tab_cod);
			 var stockProd=document.formulario.saldo.value;
			
			 
	doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&punitario='+document.formulario.punit.value+'&accion=mostrarprod&estado='+estado+'&permiso4='+permiso4+'&tmoneda2='+tmoneda+'&permiso10='+permiso10+'&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&percep_recp='+percep_recp+'&tipomov='+tipomov+'&fechaEmi='+fechaEmi+'&condicion='+condicion+'&tienda='+tienda+'&permiso21='+permiso21+'&permiso27='+permiso27+'&permiso28='+permiso28+'&tipoDescuento='+tipoDescuento+'&aud_fecha='+document.formulario.aud_fecha.value+'&aud_pc='+document.formulario.aud_pc.value+'&aud_usuario='+document.formulario.aud_usuario.value+'&stockProd='+stockProd,'mostrar','get','0','1','','');
					
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
				if(tempValor.length<1){
				return false;
				}	
	}
	
	/*
	if(document.formulario.correlativo_ref.value!='' && document.formulario.serie_ref!='' && temp=='productos'){
	alert('no esta permitido ingresar mas items');
	return false;
	}
	*/
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
		
			var cambiarPrecio=document.formulario.cambiarPrecio.value;
			var doc=document.formulario.doc.value;
			
//alert(doc);
			doAjax('lista_aux.php','&temp='+temp+'&tipomov='+tipomov+'&modulo=tranf&tipoBus='+tipoBus+'&cambiarPrecio='+cambiarPrecio+'&doc='+doc,'listaprod','get','0','1','','');
						
			
		}else{		
		
			var valor="";
			var temp_criterio=temp_busqueda;
			if(document.formulario.tempauxprod.value=='auxiliares'){
			valor=document.formulario.auxiliar.value;
			temp_criterio=temp_busqueda2;
			//selec_busq2();
			
			var comboclasificacion="";
			var categoria="";
			var subcategoria="";
			
			}
			if(document.formulario.tempauxprod.value=='productos'){
			valor=document.formulario.codprod.value;
			temp_criterio=temp_busqueda;
			//selec_busq();
			
			var comboclasificacion=document.formulario.comboclasificacion.value;
			var categoria=document.formulario.combocategoria.value;
			var subcategoria=document.formulario.combosubcategoria.value;
			
			}
		
			var temp=document.formulario.tempauxprod.value;
			var tipomov=document.formulario.tipomov.value;
			var tienda=document.formulario.almacen.value;
			
			var moneda_doc=document.formulario.tmoneda.value;
			
			//alert(tab_predefecto);
		    var tempPreDefecto=find_prm(tab_predefecto,tab_cod);
		//alert(tipoBus);
		var codcliente=document.formulario.auxiliar2.value;
 		var cambiarPrecio=document.formulario.cambiarPrecio.value;
		
			
		
		doAjax('det_aux.php','&clasificacion=1&nomb_det='+tempValor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc='+document.formulario.prov_asoc.value+'&moneda_doc='+moneda_doc+'&tipoBus='+tipoBus+'&predefecto='+tempPreDefecto+'&codcliente='+codcliente+'&cambiarPrecio='+cambiarPrecio+'&comboclasificacion='+comboclasificacion+'&categoria='+categoria+'&subcategoria='+subcategoria,'detalle_prod','get','0','1','','');
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
	if(document.formulario.ccajas.value=='S'){
	document.formulario.pcajas.select();
	document.formulario.pcajas.focus();
	}else{
	document.formulario.punit.select();
	document.formulario.punit.focus();
	}
	
	
	event.keyCode=0;
	event.returnValue=false;
	}

}


function prev_validarNumero(control,e){
	//alert(validarNumero1(control,e));
	
	if(document.formulario.factor_p.value!=1000){
	var ok=validarNumero1(control,e)// solo enteros
	}else{
	var ok=validarNumero2(control,e)// con decimales
	}
	//alert();
}

function prev_validarNumero2(control,e,unidad){
	//alert(validarNumero1(control,e));
	if(unidad=='07'){
	var ok=validarNumero1(control,e)// solo enteros
	}else{
	var ok=validarNumero2(control,e)// con decimales
	}
	//alert();
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
	var fechaEmi=document.formulario.femi.value;
    var condicion=document.formulario.condicion.value;
	var permiso21=find_prm(tab_descuento,tab_cod);//mostrar descuento
	var permiso27=find_prm(tab_puntos,tab_cod);
	var permiso28=find_prm(tab_envases,tab_cod);
	var tipoDescuento=find_prm(tab_tipoDesc,tab_cod);
	
	 
	var percep_suc=document.formulario.percep_suc.value;
	var percep_doc=document.formulario.percep_doc.value;
	var min_percep_doc=document.formulario.min_percep_doc.value;
	
	var permiso_modifPrecio=find_prm(tab_modifPrecio,tab_cod);
	var stockProd=document.formulario.saldo.value;
			 
	doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&cod_delete='+codigo+'&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&tienda='+tienda+'&permiso10='+permiso10+'&cargar_ref&impto='+impto+'&tipomov='+tipomov+'&codSerie='+prod+'&fechaEmi='+fechaEmi+'&condicion='+condicion+'&permiso21='+permiso21+'&permiso27='+permiso27+'&permiso28='+permiso28+'&tipoDescuento='+tipoDescuento+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&permiso_modifPrecio='+permiso_modifPrecio+'&stockProd='+stockProd,'mostrar','get','0','1',codigo,'eliminar');
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
	
	function seleccionar_cbo2(control,valor){
		
		 var valor1=valor;
         var i;
		// alert(valor1+" "+control);
	     for (i=0;i< eval("document.frmCopiarDoc."+control+".options.length");i++)
        {
		//alert(eval("document.formulario."+control+".options[i].value")+" "+valor1);
         if (eval("document.frmCopiarDoc."+control+".options[i].value=='"+valor1+"'"))
            {
		//	alert("entro");
			   eval("document.frmCopiarDoc."+control+".options[i].selected=true");
            }
        
        }
		
	}
	
	
	
function ver_new_aux(){
				
				
				document.formulario.aux_razon.value='';
				document.formulario.aux_ruc.value='';
				
				if(document.formulario.busqueda2.value=='ruc'){
				//alert(document.formulario.auxiliar.value);
				document.formulario.aux_ruc.value=document.formulario.auxiliar.value;
				
				}
				
				if(document.formulario.busqueda2.value=='razonsocial'){
				
				document.formulario.aux_razon.value=document.formulario.auxiliar.value;		
				//alert(document.formulario.aux_razon.value)	;
				}
				
			
			
			document.formulario.aux_direccion.value="";
			document.formulario.accionAux.value="";
			//document.formulario.codClie.value="";
			document.formulario.aux_telef.value="";
			
			document.formulario.chklider.disabled=false;
			document.formulario.selectLider.disabled=false;
			
			document.formulario.chklider.checked=false;
						
			if(document.getElementById('auxiliares').style.visibility=='visible'){
			document.getElementById('auxiliares').style.visibility='hidden';
		//	mostrar_cbos()
			document.getElementById('new_aux').style.visibility='visible';
			
			var doc=document.formulario.doc.value;
			var tipomov=document.formulario.tipomov.value;
			
			if(tipomov==2){
				if(doc.substring(0,1)=='B'){
				document.formulario.persona[1].checked=true;
				document.formulario.persona[0].checked=false;
				document.formulario.aux_ruc.disabled=true;
				document.formulario.aux_dni.disabled=false;
				document.formulario.aux_dni.focus();
				}else{
				document.formulario.persona[0].checked=true;
				document.formulario.persona[1].checked=false;
				document.formulario.aux_ruc.disabled=false;
				document.formulario.aux_dni.disabled=true;
				
				if(document.formulario.busqueda2.value=='ruc')document.formulario.aux_razon.focus();	
				
				if(document.formulario.busqueda2.value=='razonsocial')document.formulario.aux_ruc.focus();	
								
				}
			
			}else{
			
				if(doc.substring(0,1)=='B'){
				document.formulario.persona[1].checked=false;
				document.formulario.persona[0].checked=true;
				document.formulario.aux_ruc.disabled=false;
				document.formulario.aux_dni.disabled=true;
				document.formulario.aux_ruc.focus();
				}			
			
			}
		
			
			
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
	var telefono=document.formulario.aux_telef.value;
	var email=document.formulario.aux_email.value;
	
	
	
	var tempdesAux=razon.split("&");
	
	if(tempdesAux.length>2){
	alert("No es posible crear este cliente con esa descripcion desde este modulo");
	return false;
	}
	
	if(tipo_mov==1){
	var tipoprov=document.formulario.tipoprov.value;
	}else{
	var condicion=document.formulario.aux_condicion.value;
	var responsable=document.formulario.aux_responsable.value;
	}
	
	if(document.formulario.chklider.checked){
	var chklider="S";
	}else{
	var chklider="N";
	}
	var codlider=document.formulario.selectLider.value;
		
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
		doc=document.formulario.doc.value;
		//alert(ruc.length);
		if(tipo_mov==2){
			if(doc.substring(0,1)=='B' && persona!='natural' ){
				alert("El Auxiliar seleccionado no es persona Natural ");
				return false;
			}
		}else{
			 var permiso_sunat=find_prm(tab_sunat,tab_cod);
		 
	 	 // if(doc.substring(0,1)=='B' && permiso_sunat!=''){
		 	 if(permiso_sunat!='' && persona=='natural'){
				alert("El Auxiliar seleccionado no es persona Jurídica ");
				return false;
			 }
		
		}
		if(persona=='juridica'){
		/*
			if(ruc.substring(0,2)<'10' &&  ruc.substring(0,2)>'20'){
				//&&  ruc.substring(0,2)!='15'
			alert('Ingrese un número de ruc válido');
			document.formulario.aux_ruc.select();
			document.formulario.aux_ruc.focus();
			return false;
			}
		*/	
			if(razon=='' || ruc==""){
			alert("Los datos de razón social y ruc no pueden estar en blanco");
			return false;
			}
			
		
			//if(tipoprov=='1'){		
				if(!(ruc.substring(0,2)>=10 &&  ruc.substring(0,2)<=20)){
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
			//}
			
					
		}else{
		
			if(razon==''){
				alert("La razón social no puede estar en blanco");
				document.formulario.aux_razon.focus();
				return false;
			}	
			
		}
		//return false;
		if( (doc=="F1" || doc=="FA") && (ruc=="" || ruc.length!=11) && tipoprov=='1'){
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
		doAjax('peticion_datos.php','&ruc='+ruc+'&dni='+dni+'&razon='+razon+'&contacto='+contacto+'&cargo='+cargo+'&direccion='+direccion+'&persona='+persona+'&tipo_aux='+tipo_aux+'&telefono='+telefono+'&peticion=save_aux&accionAux='+accionAux+'&codClie='+codClie+'&chklider='+chklider+'&codlider='+codlider+'&tipoprov='+tipoprov+'&email='+email+'&condicion='+condicion+'&responsable='+responsable,'rspta_aux','get','0','1','','');
		
		}
			
	}
	
	function rspta_aux(texto){
	
	
	var ruc=document.formulario.aux_ruc.value;
	var dni=document.formulario.aux_dni.value;
	
	//alert(texto);
	var temp=texto.split('?');
	//alert(temp[2]);
	//alert(temp[3]);
	if(temp[2]>0){
	  if(ruc!=''){
	  //verificacion de ruc - activacion
	  		var alt='';
	  	   if (temp[4]=='S'){ var alt=' desea darle de alta'; }
		  
		  alert('El ruc ingresado ya existe.');
		  return false;
		  /* 
		   if (!confirm('¿El ruc ingresado ya existe '+ alt +'?')){
			return false;
		   }else{/// Lo que sea
 	doAjax('peticion_datos.php','&ruc='+ruc+'&peticion=filtro_aux','','get','0','1','','');
	//return false;
		   } 
		  */
		   
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
	document.formulario.condClie.value=temp[5];

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
			document.formulario.aux_telef.value="";
			
	}
	
	function espec_prod(objeto){
	
	//alert(objeto.parentNode.parentNode.parentNode.rowIndex);
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
	
	var permiso12=find_prm(tab12,tab_cod);
	//alert(permiso12);

	var sucursal=document.formulario.sucursal.value;
	var tipomov=document.formulario.tipomov.value;
	var doc=document.formulario.doc.value;
	var codcliente=document.formulario.auxiliar2.value;
	var prm_copiar_datos=permiso12;
	
	window.open('../add_refer.php?sucursal='+sucursal+'&tipomov='+tipomov+'&doc='+doc+'&codcliente='+codcliente+'&prm_copiar_datos='+prm_copiar_datos,'ventana','width=600,height=500,top=100,left=300,scroolbars=no,directories=no,location=no,menubar=no,titlebar=no,toolbar=no,status=yes');				
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
	
		
	function cargar_ref(serie,numero,cod_cli_ref,des_cli_ref,cod_cab_ref,mon_doc_ref,impto,obs1,obs2,obs3,obs4,obs5,tienda){
	
	var permiso4=find_prm(tab4,tab_cod);
	var permiso10=find_prm(tab10,tab_cod);
	var tipomov=document.formulario.tipomov.value;
	
	document.formulario.tmoneda.value=mon_doc_ref;
	document.formulario.obs1.value=obs1;
	document.formulario.obs2.value=obs2;
	document.formulario.obs3.value=obs3;
	document.formulario.obs4.value=obs4;
	document.formulario.obs5.value=obs5;
	document.formulario.almacen.value=tienda;
	seleccionar_cbo('almacen',tienda);
	document.formulario.almacen.disabled=true;
	
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
			 var fechaEmi=document.formulario.femi.value;
            var condicion=document.formulario.condicion.value;
			var tienda=document.formulario.almacen.value;
			var permiso21=find_prm(tab_descuento,tab_cod);//mostrar descuento
			var permiso27=find_prm(tab_puntos,tab_cod);
			var permiso28=find_prm(tab_envases,tab_cod);
			var tipoDescuento=find_prm(tab_tipoDesc,tab_cod);
			var permiso_modifPrecio=find_prm(tab_modifPrecio,tab_cod);
			var stockProd=document.formulario.saldo.value;
				
	doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&permiso10='+permiso10+'&cargar_ref=ref'+'&accion=mostrarprod&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov+'&fechaEmi='+fechaEmi+'&condicion='+condicion+'&tienda='+tienda+'&permiso21='+permiso21+'&permiso27='+permiso27+'&permiso28='+permiso28+'&tipoDescuento='+tipoDescuento+'&permiso_modifPrecio='+permiso_modifPrecio+'&stockProd='+stockProd ,'mostrar','get','0','1','','');
	
	document.formulario.serie_ref.value=serie;
	document.formulario.correlativo_ref.value=numero;
	document.formulario.auxiliar2.value=cod_cli_ref;
	document.formulario.auxiliar.value=des_cli_ref;
	document.formulario.cod_cab_ref.value=cod_cab_ref;
	
	document.formulario.responsable.disabled=false;
	
	document.formulario.condicion.disabled=false;
	document.formulario.almacen.disabled=false;
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
			 var fechaEmi=document.formulario.femi.value;
            var condicion=document.formulario.condicion.value;
			var tienda=document.formulario.almacen.value;
			var permiso21=find_prm(tab_descuento,tab_cod);//mostrar descuento
			var permiso27=find_prm(tab_puntos,tab_cod);
			var permiso28=find_prm(tab_envases,tab_cod);
			var tipoDescuento=find_prm(tab_tipoDesc,tab_cod);
			var permiso_modifPrecio=find_prm(tab_modifPrecio,tab_cod);
			var stockProd=document.formulario.saldo.value;
			
		//alert(document.formulario.tmoneda.value+" - "+temp_mon);		
		
	doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&permiso10='+permiso10+'&accion=mostrarprod&cargar_ref&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov+'&copiarDoc='+document.formulario.tempCopiar.value+'&fechaEmi='+fechaEmi+'&condicion='+condicion+'&tienda='+tienda+'&permiso21='+permiso21+'&permiso27='+permiso27+'&permiso28='+permiso28+'&tipoDescuento='+tipoDescuento+'&permiso_modifPrecio='+permiso_modifPrecio+'&stockProd='+stockProd ,'mostrar','get','0','1','','');

		document.formulario.codprod.focus();		
	}
			
	function cbo_cond(){
	var doc=document.formulario.doc.value;
	//alert(doc);
	doAjax('peticion_datos.php','&doc='+doc+'&peticion=cargar_cond','cargar_cbo_cond','get','0','1','','');
	}
	
	function cbo_cond2(){
	var doc=document.formulario.doc.value;
	doAjax('peticion_datos.php','&doc='+doc+'&peticion=cargar_cond2','cargar_cbo_cond2','get','0','1','','');
	}
	function cargar_cbo_cond2(texto){
	document.getElementById('cbo_cond2').innerHTML=texto;	
	}
	
	
	function cargar_cbo_cond(texto){
		//alert(texto);
	document.getElementById('cbo_cond').innerHTML=texto;
	
	cargarControlJquery();
		if(document.formulario.tempCopiar.value=='S'){
			if(document.formulario.impto.value!=document.frmCopiarDoc.impto.value){
			document.formulario.impto.value=document.frmCopiarDoc.impto.value;
			
			}else{
			document.formulario.impto.value=document.frmCopiarDoc.impto.value;
			}
			mostrar_detalle();
		}else{
		//alert(tempNivelUser);
			if(tempNivelUser=='1' && tempNivelUser=='7'){
		    document.formulario.condicion.disabled=false;
			document.formulario.condicion.focus();		
			}
		}	
	seleccionar_cbo('condicion',document.formulario.condClie.value);
	
				
	}
		
	function ant_imprimir(param){	
	document.formulario.tempImp.value=param;	
		
	if(document.getElementById('estado').innerHTML=="ANULADO"){
			alert('No esta permitido imprimir documentos anulados')	;
			return false;
	}
	
		
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
			
			var permiso25=find_prm(tab_cajaFact,tab_cod);
			var mnjDeuda=deudaCondx();
		  // && mnjDeuda=='S'
			if(permiso25=='S'){
		/*
					generateCoverDiv("capa_fondo","#000000",10);
					ocultarCbos();
					document.getElementById("cajaFact").style.visibility='visible';
					if(document.getElementById('totalpagar')=='undefined'){
						document.getElementById("montoCajaF").innerHTML=document.formulario.total_doc.value;
						document.formulario.importe2.value=document.formulario.total_doc.value;
						//alert(document.formulario.importe2.value);
					}else{
						document.getElementById("montoCajaF").innerHTML=document.formulario.totalpagar.value;
						document.formulario.importe2.value=document.formulario.totalpagar.value;
					}
					document.formulario.fechaPago.value=document.formulario.femi.value;
										
					if(document.formulario.tmoneda.value=='01'){
						tempMonP=" S/. ";
						document.formulario.pendiente_s.value=parseFloat(document.formulario.importe2.value).toFixed(2);
						document.formulario.pendiente_d.value=parseFloat(document.formulario.importe2.value/document.formulario.tcPago.value).toFixed(2);
						document.formulario.total_s.value=parseFloat(document.formulario.importe2.value).toFixed(2);
						document.formulario.total_d.value=parseFloat(document.formulario.importe2.value/document.formulario.tcPago.value).toFixed(2);
						document.formulario.soles.focus();		 
					 
					}else{
						tempMonP=" US$. ";
				    	document.formulario.pendiente_s.value=parseFloat(document.formulario.importe2.value*document.formulario.tcPago.value).toFixed(2);
						document.formulario.pendiente_d.value=parseFloat(document.formulario.total_doc.value).toFixed(2);
						document.formulario.total_s.value=parseFloat(document.formulario.importe2.value*document.formulario.tcPago.value).toFixed(2);
						document.formulario.total_d.value=parseFloat(document.formulario.total_doc.value).toFixed(2); 
						document.formulario.dolares.focus();
					 
					}
					document.getElementById("etiqMonCaja").innerHTML=tempMonP;
					return false;
			*/		
					//*******************************************
					
					
				generateCoverDiv("capa_fondo","#000000",10);
				ocultarCbos();
				document.getElementById("cajaFact").style.visibility='visible';
				if(document.getElementById('totalpagar')=='undefined'){
					document.getElementById("montoCajaF").innerHTML=document.formulario.total_doc.value;
					document.formulario.importe2.value=document.formulario.total_doc.value;
				}else{
					document.getElementById("montoCajaF").innerHTML=document.formulario.totalpagar2.value;
					document.formulario.importe2.value=document.formulario.totalpagar.value;
				}
				document.formulario.fechaPago.value=document.formulario.femi.value;
					
				if(document.formulario.tmoneda.value=='01'){
					tempMonP=" S/. ";
					/*if(document.getElementById('totalpagar')=='undefined'){
						document.formulario.pendiente_s.value=parseFloat(document.formulario.total_doc.value);
					}*/
					document.formulario.pendiente_s.value=document.formulario.importe2.value;
					document.formulario.pendiente_d.value=parseFloat(document.formulario.importe2.value/document.formulario.tcPago.value).toFixed(2);
					document.formulario.total_s.value=document.formulario.importe2.value;
					document.formulario.total_d.value=parseFloat(document.formulario.importe2.value/document.formulario.tcPago.value).toFixed(2);
					document.formulario.soles.focus();		 
					 
				}else{
					tempMonP=" US$. ";
				    document.formulario.pendiente_s.value=parseFloat(document.formulario.importe2.value*document.formulario.tcPago.value).toFixed(2);
					document.formulario.pendiente_d.value=document.formulario.importe2.value;
					document.formulario.total_s.value=parseFloat(document.formulario.importe2.value*document.formulario.tcPago.value).toFixed(2);
					document.formulario.total_d.value=document.formulario.importe2.value; 
					document.formulario.dolares.focus();
				}
					 
				document.getElementById("etiqMonCaja").innerHTML=tempMonP;
				
				if(document.getElementById('total_doc').value!=document.formulario.importe2.value){
					var percx=parseFloat(document.formulario.percepcion.value.replace(',',''));
				}else{
					var percx="0";
				}
				
				if(document.formulario.tmoneda.value=='01'){
				var soles=parseFloat(document.formulario.importe2.value);
				}else{
				var dolares=parseFloat(document.formulario.importe2.value);
				}
				
				var tpago=document.formulario.tpago.value;
				var numero="";
								
				var moneda_v=document.formulario.vueltoen.value;
				var tope=document.formulario.tope.value;
				var fecha_det_pago=document.formulario.femi.value;
				var tcambio_det_pago=document.formulario.tcPago.value;;
				var moneda_doc=document.formulario.tmoneda.value;
				var acuenta=document.formulario.acuenta.value;
				var condicion=document.formulario.condicion.value;
				var doc=document.formulario.doc.value;
				var moneda_doc=document.formulario.tmoneda.value;
				var total_doc=document.formulario.importe2.value;
				
				//alert(soles);
							//alert('pagos_det.php?tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares);
			doAjax('../pagos_det2.php','&tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares+'&moneda_v='+moneda_v+'&tope='+tope+'&fecha_det_pago='+fecha_det_pago+'&tcambio_det_pago='+tcambio_det_pago+'&moneda_doc='+moneda_doc+'&acuenta='+acuenta+'&percx='+percx+'&condicion='+condicion+'&doc='+doc+'&moneda_doc='+moneda_doc+'&total_doc='+total_doc,'lista_pago','get','0','1','','');
				
				return false;
			
					
					//********************************************
					
					
				}else{
			
			document.formulario.temp_imp.value='S';
			grabar_doc();
			
			}
	
	
	
			
			
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
	var cola_imp2=find_prm(tab_cola2,tab_cod);
	
	//alert(cola_imp+ ""  +cola_imp2);

	var imp_Email=find_prm(tab_accionDoc,tab_cod);
	//alert(imp_Email);
	
	var permiso16=find_prm(tab16,tab_cod);
	//var url='../formatos/'+formato;
	/*
	if(imp_Email=='E'){
		formato="formatopdf1.php";
	}
	*/
	var tempImp=document.formulario.tempImp.value;
	
	if(tempImp=='pdf'){
	
		if(sucursal=='1')formato=cola_imp;
		if(sucursal=='2')formato=cola_imp2;
		
	}	
	
	//alert(formato);
	
//return false;
	
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
	//var tempCodVend=window.parent.form1.tempCodVend.value;
	var tempCodVend=window.parent.document.form1.tempCodVend.value;
	doAjax('../carga_cbo_doc.php','&tipomov='+tipomov+'&empresa='+empresa+'&tempCodVend='+tempCodVend,'res_cargar_cbo_doc','get','0','1','','');
	
}
	
	function res_cargar_cbo_doc(texto){
	
	var temp=texto.split("?");
	//alert(texto);
	if(document.getElementById("capaCopiarDoc").style.visibility=="visible"){
	//alert(temp[0]);
	document.getElementById('div3').innerHTML=temp[0];
	
		if(user_tienda.length==3){
		document.frmCopiarDoc.doc.disabled=false;
		document.frmCopiarDoc.doc.focus();
		}
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
			 tab_predefecto = temp[30].split(",");
			 
			 tab_cola1=temp[31].split(",");
			 tab_cola2=temp[32].split(",");
			 tab_numauto = temp[34].split(",");
			 tab_descuento = temp[35].split(",");
			 tab_mostrarOT=temp[36].split(",");
			 tab_cajaFact=temp[37].split(",");
			 tab_modifdesc=temp[38].split(",");
			 tab_puntos=temp[39].split(",");
			 
			 tab_envases=temp[40].split(",");
			 tab_tipoDesc=temp[41].split(",");
			 tab_accionDoc=temp[44].split(",");
			 tab_modifPrecio=temp[45].split(",");
			 tab_sunat=temp[46].split(",");
			 
			//alert(tab_puntos);
		    //alert(tab16);			
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
			var codcliente=document.formulario.auxiliar2.value;
			var cambiarPrecio=document.formulario.cambiarPrecio.value;
						
		doAjax('det_aux.php','&clasificacion=1&nomb_det='+tempValor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc='+document.formulario.prov_asoc.value+'&comboclasificacion='+comboclasificacion+'&categoria='+categoria+'&subcategoria='+subcategoria+'&moneda_doc='+moneda_doc+'&tipoBus='+tipoBus+'&codcliente='+codcliente+'&cambiarPrecio='+cambiarPrecio,'detalle_prod','get','0','1','','');
	
	
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
		var precio=parseFloat(des_pres.substring(11));
		//alert(precio);
		if(tempNivelUser==2){
		precio=0.00;
		}
		//alert(precio);
		
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
			//alert(total_precio);
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
	
	
	function cambiar_fondo2(control,evento){
	
	if(evento=='e')
	control.style.backgroundImage='url(../imagenes/boton_aplicar4.gif)';
	else
	control.style.backgroundImage='url(../imagenes/boton_aplicar3.gif)';
	
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
				txserie=document.form_series.nroserie[i].value;
				txserie=txserie.replace("'","||");
				//series=series+"_"+document.form_series.nroserie[i].value;
				series=series+"_"+txserie;
				}
			}
			
			document.formulario.cantidad.value=tempSer;
			
		}else{
				if(document.form_series.nroserie.value==""){
				alert("Las series no pueden quedar en blanco");
				return false;
				}
				txserie=document.form_series.nroserie.value;
				txserie=txserie.replace("'","||");
				//series=series+"_"+document.form_series.nroserie.value;
				series=series+"_"+txserie;
				
		}		
			
		
		
		
		var fvenc=document.form_series.temp_fvenserie.value;
		var producto=document.form_series.codprod2.value;
		var accion=document.form_series.accion_serie.value;
		var estado_doc=document.getElementById('estado').innerHTML;
		var temp_doc=document.formulario.temp_doc.value;
		var tienda=document.formulario.almacen.value;
		var tipomov=document.formulario.tipomov.value;
		
		//alert('peticion_datos.php?peticion=ing_series&series='+series+'&fvenc='+fvenc+'&producto='+producto+'&accion='+accion+'&estado_doc='+estado_doc+'&temp_doc='+temp_doc+'&tienda='+tienda+'&tipomov='+tipomov);
	doAjax("peticion_datos.php","&peticion=ing_series&series="+series+"&fvenc="+fvenc+"&producto="+producto+"&accion="+accion+"&estado_doc="+estado_doc+"&temp_doc="+temp_doc+"&tienda="+tienda+"&tipomov="+tipomov,"rspta_aceptar_serie","get","0","1","","");
	
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
			objeto.style.background='#fff1bb';//
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
		//alert(objeto);
		if(document.activeElement.type=='text' || document.activeElement.type=='checkbox' ){
		//alert("");
			if(navigator.appName!='Microsoft Internet Explorer'){
			objeto.cells[0].childNodes[1].checked=false;
			}else{
			objeto.cells[0].childNodes[0].checked=false;
			}
		}
		//alert(objeto.innerHTML);
			if(objeto.style.background=='#fff1bb'  || objeto.style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || objeto.style.background=='rgb(255, 241, 187)'){
			//alert(objeto.bgColor);
			objeto.style.background='#ffffff';
				if(navigator.appName!='Microsoft Internet Explorer'){
				objeto.cells[0].childNodes[1].checked=false;
				}else{
				objeto.cells[0].childNodes[0].checked=false;
				}
				
			document.getElementById("label_cant_selec").innerHTML=contorl_item_selec();
			document.form_series.cant_selec.value=contorl_item_selec();
			}else{
			  //alert(contorl_item_selec() +" "+ document.form_series.cant_req.value);
				if( (contorl_item_selec()==document.form_series.cant_req.value ) && document.formulario.cod_cab_ref.value=='' ){
					
					if(document.form_series.accion_series.value=='editar'){
					alert('Solo puede cambiar el número de serie');
					return false;
					}
					//alert("");				
					if(confirm('Cantidad de item ya ha sido completada..... desea seguir agregando mas items?')){
					}else{
					return false;
					}
				}else{
				
				
				}
			
			objeto.style.background='#FFF1BB';
			if(navigator.appName!='Microsoft Internet Explorer'){
			objeto.cells[0].childNodes[1].checked=true;
			}else{
			objeto.cells[0].childNodes[0].checked=true;
			}
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
					
					if(navigator.appName!='Microsoft Internet Explorer'){
					var tempSD=document.getElementById('tbl_series').rows[i].cells[1].childNodes[1].childNodes[1].value.toUpperCase();
					}else{
					var tempSD=document.getElementById('tbl_series').rows[i].cells[1].childNodes[0].childNodes[0].value.toUpperCase();
					}
					
					if(tempSD==serie.value.toUpperCase()){
					
							document.getElementById('tbl_series').rows[i].style.background='#fff1bb';
							if(navigator.appName!='Microsoft Internet Explorer'){
							document.getElementById('tbl_series').rows[i].cells[0].childNodes[1].checked=true;
							}else{
							document.getElementById('tbl_series').rows[i].cells[0].childNodes[0].checked=true;
							}
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
		   
		   if(navigator.appName!='Microsoft Internet Explorer'){
			 if(document.getElementById('tbl_series').rows[i].cells[0].childNodes[1].checked){
				contador++;
			 }
		  }else{
		     if(document.getElementById('tbl_series').rows[i].cells[0].childNodes[0].checked){
				contador++;
			 }
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
			 			 
			  if(navigator.appName!='Microsoft Internet Explorer'){	
			        //alert(document.getElementById('tbl_series').rows[i].cells[0].childNodes[0].checked);
					if(document.getElementById('tbl_series').rows[i].cells[0].childNodes[1].checked){
					//alert(document.getElementById('tbl_series').rows[i].cells[1].childNodes[1].childNodes[1].value);
					series=series+"_"+document.getElementById('tbl_series').rows[i].cells[1].childNodes[1].childNodes[1].value;
					}
			  }else{
					if(document.getElementById('tbl_series').rows[i].cells[0].childNodes[0].checked){
					series=series+"_"+document.getElementById('tbl_series').rows[i].cells[1].childNodes[0].childNodes[0].value;
					}
			  
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
			var fechaEmi=document.formulario.femi.value;
            var condicion=document.formulario.condicion.value;
			var tienda=document.formulario.almacen.value;
			var permiso21=find_prm(tab_descuento,tab_cod);//mostrar descuento
			var permiso27=find_prm(tab_puntos,tab_cod);
			var permiso28=find_prm(tab_envases,tab_cod);
			var tipoDescuento=find_prm(tab_tipoDesc,tab_cod);
			var permiso_modifPrecio=find_prm(tab_modifPrecio,tab_cod);
			var stockProd=document.formulario.saldo.value;
						
				doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&permiso10='+permiso10+'&cargar_ref=ref&accion=mostrarprod&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov+'&fechaEmi='+fechaEmi+'&condicion='+condicion+'&tienda='+tienda+'&permiso21='+permiso21+'&permiso27='+permiso27+'&permiso28='+permiso28+'&tipoDescuento='+tipoDescuento+'&permiso_modifPrecio='+permiso_modifPrecio+'&stockProd='+stockProd,'mostrar','get','0','1','','');
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
			//document.formulario.precosto.value=parseFloat(document.formulario.precosto.value).toFixed(2)/tc_doc;
			}else{
			document.getElementById('moneda').innerHTML='(S/.)';
			document.formulario.tmoneda.value="01";
			//document.formulario.precosto.value=parseFloat(document.formulario.precosto.value).toFixed(2)*tc_doc;
			
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
		     var fechaEmi=document.formulario.femi.value;
           var condicion=document.formulario.condicion.value;
			var tienda=document.formulario.almacen.value;
			var permiso21=find_prm(tab_descuento,tab_cod);//mostrar descuento
			var permiso27=find_prm(tab_puntos,tab_cod);
			var permiso28=find_prm(tab_envases,tab_cod);
			var tipoDescuento=find_prm(tab_tipoDesc,tab_cod);
			var permiso_modifPrecio=find_prm(tab_modifPrecio,tab_cod);
			var stockProd=document.formulario.saldo.value;
			
			
			doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&accion=cambiar_dolar&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&permiso10='+permiso10+'&cargar_ref&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov+'&fechaEmi='+fechaEmi+'&condicion='+condicion+'&tienda='+tienda+'&permiso21='+permiso21+'&permiso27='+permiso27+'&permiso28='+permiso28+'&tipoDescuento='+tipoDescuento+'&permiso_modifPrecio='+permiso_modifPrecio+'&stockProd='+stockProd,'mostrar','get','0','1','','');
			
			}else{
				if(document.getElementById('moneda').innerHTML=='(S/.)'){
				temp_mon="01";
				}else{
				temp_mon="02";
				}
				if(parseFloat(document.formulario.cantidad.value)>0){
					calcular_ptotal();
				}
			}
		
		}


function doc_det(valor){

if(valor==''){
valor=document.formulario.cod_cab_ref2.value;
}
window.open("../doc_det2.php?referencia="+valor,"","toolbar=no,status=no, menubar=no, scrollbars=yes, width=520, height=320,left=300 top=250");

}

function recalcular_precios(control,producto,e,precosto,mon_prod,pre_actual,cantidad,pos){
		
		
		
	if(e.keyCode==13){
	
	if(control.id=='ptotal_det'){		
		var precio_nuevo=(parseFloat(control.value)/cantidad).toFixed(4);		
	}else{
		var precio_nuevo=parseFloat(control.value);
	
	}
	
		
	var tc_doc=document.formulario.tcambio.value;
	//alert(precio_nuevo+" "+producto);
	if(mon_prod==1 && document.getElementById('moneda').innerHTML=='(US$.)'){
			precosto=parseFloat(precosto/tc_doc).toFixed(2);
			}else{
				if(mon_prod==2 && document.getElementById('moneda').innerHTML=='(S/.)'){
				precosto=parseFloat(precosto*tc_doc).toFixed(2);
				}
			
	}
	
	//alert(mon_prod+" "+precosto);
	/* Precio Menor al costo en el detalle*/
	//alert(precio_nuevo+"-"+precosto);
	
	var permiso16=find_prm(tab16,tab_cod);
	
	if(precio_nuevo<precosto && parseFloat(document.formulario.tipomov.value)==2 && permiso16=='N'){
	alert('El precio no puede ser menor al ' + etiqPrecio5 );
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
		var fechaEmi=document.formulario.femi.value;
        var condicion=document.formulario.condicion.value;
		var tienda=document.formulario.almacen.value;
		var permiso21=find_prm(tab_descuento,tab_cod);//mostrar descuento
		var permiso27=find_prm(tab_puntos,tab_cod);
		var permiso28=find_prm(tab_envases,tab_cod);
		var tipoDescuento=find_prm(tab_tipoDesc,tab_cod);
		var permiso_modifPrecio=find_prm(tab_modifPrecio,tab_cod);
		var stockProd=document.formulario.saldo.value;
			
		//alert(producto);
		
	doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&accion=cambiar_dolar&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&permiso10='+permiso10+'&precio_nuevo='+precio_nuevo+'&producto='+producto+'&cambiar_precio&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov+'&fechaEmi='+fechaEmi+'&condicion='+condicion+'&tienda='+tienda+'&permiso21='+permiso21+'&permiso27='+permiso27+'&permiso28='+permiso28+'&tipoDescuento='+tipoDescuento+'&pos='+pos+'&permiso_modifPrecio='+permiso_modifPrecio+'&stockProd='+stockProd,'mostrar','get','0','1','','');
	
	}

}

function recalcular_cant(control,producto,e,precosto,mon_prod,cant_actual,pos){


	if(e.keyCode==13){
	
					var prms_doc_stock=find_prm(tab1,tab_cod);
					var kardex_prod=document.formulario.kardex_prod.value;
					
					var saldo=control.parentNode.childNodes[2].value;
					
					if( parseFloat(saldo) >= parseFloat(control.value) || prms_doc_stock=='N' || kardex_prod=='N' ){
										
					
					}else{
					//soundPlay();					
					alert("Producto sin Stock ... \n Stock Disponible: "+saldo);
					
					control.focus();
					control.select();
						
					return false;
					}
					

	
	var cant_nuevo=parseFloat(control.value);
	var tc_doc=document.formulario.tcambio.value;
	//alert(precio_nuevo+" "+producto);
	
	
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
		var fechaEmi=document.formulario.femi.value;
        var condicion=document.formulario.condicion.value;
		var tienda=document.formulario.almacen.value;
		var permiso21=find_prm(tab_descuento,tab_cod);//mostrar descuento
		var permiso27=find_prm(tab_puntos,tab_cod);
		var permiso28=find_prm(tab_envases,tab_cod);
		var tipoDescuento=find_prm(tab_tipoDesc,tab_cod);
		var permiso_modifPrecio=find_prm(tab_modifPrecio,tab_cod);
		var stockProd=document.formulario.saldo.value;
			
		//alert(producto);
		
	doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&accion=cambiar_dolar&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&permiso10='+permiso10+'&cant_nuevo='+cant_nuevo+'&producto='+producto+'&cambiar_cant&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov+'&fechaEmi='+fechaEmi+'&condicion='+condicion+'&tienda='+tienda+'&permiso21='+permiso21+'&permiso27='+permiso27+'&permiso28='+permiso28+'&tipoDescuento='+tipoDescuento+'&pos='+pos+'&permiso_modifPrecio='+permiso_modifPrecio+'&stockProd='+stockProd,'mostrar','get','0','1','','');
	
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
							permiso_modifPrecio=find_prm(tab_modifPrecio,tab_cod);
							if(permiso_modifPrecio=='N'){
							document.formulario.punit.disabled=false;
							document.formulario.punit.precio=false;
							}
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

function sel_chofer(codigo,nombre,tempcam){
	
	if(document.formulario.transpChofer.value=='A'){
		document.frmCopiarDoc.auxOrigen2.value=codigo;
		document.frmCopiarDoc.auxOrigen.value=nombre;
		document.frmCopiarDoc.dirauxOrigen.value=tempcam;
		
		
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
//alert();
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
//alert();
document.getElementById('cbo_uni').style.visibility='hidden';
document.formulario.dirPartida.focus();
document.formulario.dirPartida.select();
}

function cboOtrasDirec(){
valor=document.formulario.auxiliar2.value;
//alert();
doAjax('../peticion_ajax5.php','&peticion=cboDirec&codcliente='+valor,'mostrar_cboOtrasDirec','get','0','1','','');

}

function mostrar_cboOtrasDirec(data){
document.getElementById('otrasDirec').innerHTML=data;
cambiar_dir();
}


function llenar_dir(tienda){
//alert(tienda);
var dir_tienda=document.formulario.dir_tienda.value.split("~");
var cod_tienda=document.formulario.cod_tienda.value.split("~");
//alert(cod_tienda);

//alert(dir_tienda);

	for(var i=0;i<dir_tienda.length;i++){
	//alert(cod_tienda[i] +" "+tienda);
		if(cod_tienda[i]==tienda){
		   document.formulario.dirPartida.value=dir_tienda[i];
		}
			
	}
	
	document.formulario.cambiarPrecio.value=find_prm(tab_predefecto,tab_cod);
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

		var serie=ponerCeros(document.frmCopiarDoc.serie.value,3);
		var numero=ponerCeros(document.frmCopiarDoc.numero.value,7);
		var doc=document.frmCopiarDoc.doc.value;
		var sucursal=document.frmCopiarDoc.sucursal.value;
		var tipomov=document.formulario.tipomov.value;
		
		
	   if(e.keyCode==13){
	    document.frmCopiarDoc.numero.value=numero;
		document.frmCopiarDoc.serie.value=serie;
		  if(tipomov==1){
		 
			doAjax('peticion_datos.php','&serie='+serie+'&numero='+numero+'&doc='+doc+'&sucursal='+sucursal+'&peticion=buscar_prov2&tipomov='+document.formulario.tipomov.value,'rpta_bus_numero','get','0','1','','');
		  }else{
		  
		  //alert(find_prm(tab10,doc));
		 
		  
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
		
function controlStock(){
		
//		copiarDoc()
		  prm=tab10;
		  prm2=tab1;
		  for (var i=0;i<prm.length;i++){
		  	
			if(tab_cod[i]==document.frmCopiarDoc.doc.value){
			var tempC=prm[i];
			var tempC2=prm2[i];
			}
		  } 
		//  alert(tempC2);
		  //alert(tempC);
		  if(tempC=='S' && document.formulario.tipomov.value==2 && tempC2=='S'){
	//alert(document.frmCopiarDoc.cod_cabaCopiar.value);	  
	doAjax('peticion_datos.php','&peticion=verificarStock2&codcab='+document.frmCopiarDoc.cod_cabaCopiar.value+'&tienda='+document.frmCopiarDoc.almacen.value,'rpta_verificarStock','get','0','1','','');
		  }else{
		  copiarDoc();
		  }
		  
}

function rpta_verificarStock(texto){
var xtemp=texto.split("|");

	if(xtemp[0]!=""){
	//soundPlay();
	alert("El producto :  "+xtemp[0]+" "+xtemp[2]+" no tiene stock disponible... \n ** Stock Disponible: "+xtemp[1])
	}else{
	copiarDoc();
	}


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
		document.formulario.dirDestino.value=document.frmCopiarDoc.dirauxOrigen.value;
				
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
		//mostrarCbos();
		
		document.formulario.tempCopiar.value="S";
		cbo_cond();
										
}

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
//alert(indice);
//if(document.getElementById('productos').style.visibility=='visible'){
		//for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
		//	if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb'){
			
			
			if(navigator.appName!='Microsoft Internet Explorer'){
				 
				var temp=document.getElementById('tblproductos').rows[indice].cells[0].childNodes[1].childNodes[1].innerHTML;
				var temp1=document.getElementById('tblproductos').rows[indice].cells[1].childNodes[1].innerHTML;
				}else{
		
				var temp=document.getElementById('tblproductos').rows[indice].cells[0].childNodes[0].childNodes[0].innerHTML;
				var temp1=document.getElementById('tblproductos').rows[indice].cells[1].childNodes[0].innerHTML;
		
		
			}
			//alert(temp+" | "+temp1);
		
		
		var temp3=document.getElementById('tblproductos').rows[indice].cells[3].innerHTML;
		var temp4=document.getElementById('tblproductos').rows[indice].cells[4].innerHTML;
		 //alert(temp4);
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
	   document.formulario.esmodelo.value=unidad[20];
	   document.formulario.cantModelo.value=unidad[21];
	   document.formulario.lotes.value=unidad[23];
	  // document.formulario.precosto.value=unidad[6];
	  // alert(unidad);
	  
		
	   
	   var prod_moneda=unidad[3];
		if(document.formulario.tipomov.value==2){
				
			var precosto=unidad[7];
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
			//document.formulario.punit.value=precosto;
			
			document.formulario.punit.value=unidad[2];
		
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
 //alert("");
	if(document.getElementById('auxiliares').style.visibility=='visible'){

		for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
			//alert(document.getElementById('tblproductos1').rows[i].style.background);
		if((document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' || document.getElementById('tblproductos1').rows[i].style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || document.getElementById('tblproductos1').rows[i].style.background=='rgb(255, 241, 187)') ){
		
			//if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb'){
		//var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
			 if(navigator.appName!='Microsoft Internet Explorer'){
	      var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[1].childNodes[1].innerHTML;
		        }else{
		  var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
				}
			
				//var temp2=document.getElementById('tblproductos1').rows[i].cells[1].childNodes[0].innerHTML;
				//var temp3=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[0].childNodes[0].childNodes[0].innerHTML;
				
			//alert(temp);
			buscarCliente(temp);		   			
			
			}
		}
	}
		
 }
 
  function buscarCliente(codigo){
 // alert();
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
  var telefono=temp[7];
  var lider=temp[8];
  var codlider=temp[9];
  var tipoprov=temp[10];
  var email=temp[11];
  var responsable=temp[12];
  var condicion=temp[13];
  var contacto=temp[14];
  var cargo=temp[15];
 // razon=razon.replace("ó","\u00f3");
 	//alert(razon);
  document.getElementById('new_aux').style.visibility='visible';  
  document.formulario.aux_razon.value=razon;
  document.formulario.aux_dni.value=dni;
  document.formulario.aux_ruc.value=ruc;
  document.formulario.aux_direccion.value=direccion;
  document.formulario.aux_telef.value=telefono; 
  document.formulario.aux_email.value=email;
  document.formulario.aux_contacto.value=contacto;
  document.formulario.aux_cargo.value=cargo;
 
//  alert(tipo+" "+ document.formulario.persona[1].value);
	
	if(lider=='S'){
	document.formulario.chklider.checked=true;
	}else{
	document.formulario.chklider.checked=false;
	}
	
	seleccionar_cbo('selectLider',codlider);
	
	if(document.formulario.tipomov.value==2){	
		seleccionar_cbo('aux_responsable',responsable);
		seleccionar_cbo('aux_condicion',condicion);
	}else{
		
	
	}
	
	
	try{
	seleccionar_cbo('tipoprov',tipoprov);	
	 }catch(e){
	 }
	 
	 
	document.formulario.chklider.disabled=true;
	document.formulario.selectLider.disabled=true;
	
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
  
  cbo_cond2();
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
		
		var serieOT=document.formulario.serieOT.value;
		var numeroOT=document.formulario.numeroOT.value;
		var sucursal=document.formulario.sucursal.value;
		
		if(control.name=='serieOT'){
		document.formulario.numeroOT.focus();
		document.formulario.numeroOT.select();
		}else{
		
		doAjax('peticion_datos.php','&peticion=controlOT&sucursal='+sucursal+'&serieOT='+serieOT+'&numeroOT='+numeroOT,'rspta_controlOT','get','0','1','','');
		
		//document.formulario.codprod.focus();
		//document.formulario.codprod.select();
		}
		
	}

}


function rspta_controlOT(texto){
//alert(texto);
	if(texto == 0){
	alert("El número de OT no existe");
	document.formulario.numeroOT.focus();
	document.formulario.numeroOT.select();
	}else{
	document.formulario.codprod.focus();
	document.formulario.codprod.select();
	document.formulario.serieOT.disabled=true;
	document.formulario.numeroOT.disabled=true;
	}

}
  
function selec_cli(objeto){
	selecionarCli(objeto.parentNode.parentNode.parentNode.rowIndex);
}
	
function selecionarCli(indice){

  if(navigator.appName!='Microsoft Internet Explorer'){
	      var temp=document.getElementById('tblproductos1').rows[indice].cells[0].childNodes[1].childNodes[1].innerHTML;
		  var temp1=document.getElementById('tblproductos1').rows[indice].cells[1].childNodes[1].innerHTML;
		//var ruc=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[1].childNodes[1].childNodes[1].childNodes[1].innerHTML;
		   var ruc=document.getElementById('tblproductos1').rows[indice].cells[2].childNodes[1].childNodes[1].childNodes[0].childNodes[1].childNodes[1].innerHTML;
		//alert(temp+" | "+temp1+" | "+ruc);
		        }else{
			var temp=document.getElementById('tblproductos1').rows[indice].cells[0].childNodes[0].childNodes[0].innerHTML;
			var temp1=document.getElementById('tblproductos1').rows[indice].cells[1].childNodes[0].innerHTML;
			var ruc=document.getElementById('tblproductos1').rows[indice].cells[2].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].innerHTML;								
		
		//alert(temp+" | "+temp1+" | "+ruc);
				}



	var doc=document.formulario.doc.value;
	var temp4=document.getElementById('tblproductos1').rows[indice].cells[4].innerHTML.split("-");
	//alert(temp4);
	document.formulario.est_percep_clie.value=temp4[8];
	document.formulario.por_percep_clie.value=temp4[9];
	document.formulario.dirDestino.value=temp4[10];
	document.formulario.dirDestino2.value=temp4[10];
	var condClie=temp4[19];
	var t_personaClie=temp4[22];

	//if( (doc=='FA' || doc=='F1' ) && ruc==""  &&  t_personaClie=='juridica'){
		
	if(document.formulario.tipomov.value==2){
	
		if( (doc.substring(0,1)=='F' || doc=='NC' )   &&  t_personaClie!='juridica'){
		 //alert(" Cliente no tiene Ruc y/o no es persona jurídica");
		 alert(" Auxiliar seleccionado no es persona Jurídica");
		 return false;
		}	
		//if(doc.substring(0,1)=='B' && ruc!=''){
		 if(doc.substring(0,1)=='B' && t_personaClie!='natural'){
				  
					  alert(" El Auxiliar seleccionado no es persona Natural ");
					  return false;				  				  
		  }else{
			temp1=temp1.replace('&amp;','&');
			//alert(temp1);
			elegir2(temp,temp1);
			document.formulario.condClie.value=condClie;
		  }	
	 }else{
		 var permiso_sunat=find_prm(tab_sunat,tab_cod);
		 
	 	 // if(doc.substring(0,1)=='B' && permiso_sunat!=''){
		  if(permiso_sunat!='' && t_personaClie=='natural'){
				  
					  alert(" El Auxiliar seleccionado no es persona Jurídica ");
					  return false;				  				  
		  }else{
			temp1=temp1.replace('&amp;','&');
			//alert(temp1);
			elegir2(temp,temp1);
			document.formulario.condClie.value=condClie;
		  }	
	 
	 
	 } 
	  
	  
		
	
	/*document.formulario.auxiliar2.value=temp;
	document.formulario.auxiliar.value=temp1;
	document.getElementById('auxiliares').style.visibility='hidden';
	mostrar_cbos();
	document.formulario.auxiliar.focus();
	document.formulario.auxiliar.select();*/
	//document.formulario.codprod.select();
}

function c_soles(e,control){
//document.form1.dolares.disabled=true;
control_focus=control;
document.formulario.dolares.value=0;
	
	if(e.keyCode == 13){
	
	if(control.value==0 || control.value==''){
	alert("Ingresar un monto");
	control.focus();
	document.formulario.dolares.disabled=false;	
	return false;
	}
	
	if(document.formulario.pendiente_s.value==0 ||  document.formulario.pendiente_d.value==0){
	alert("Ya no existe saldo para cancelar. :-D");
	return false;
	}
	
	
	if(document.getElementById('total_doc').value!=document.formulario.importe2.value){
		var percx=document.formulario.percepcion.value;
	}else{
		var percx="0";
	}
	var tpago=document.formulario.tpago.value;
	var numero=document.formulario.numero_tarjeta.value;
	var soles=document.formulario.soles.value;
	var dolares=document.formulario.dolares.value;
	var moneda_v=document.formulario.vueltoen.value;
	var tope=document.formulario.tope.value;
	var fecha_det_pago=document.formulario.femi.value;
	//var tcambio_det_pago=tc_doc;
	var tcambio_det_pago=document.formulario.tcPago.value;
	
	var moneda_doc=document.formulario.tmoneda.value;
	var acuenta=document.formulario.acuenta.value;
	
	var moneda_doc=document.formulario.tmoneda.value;
	var total_doc=document.formulario.importe2.value;
	
	//var importe2=
	
	//alert(tpago);
	//alert('pagos_det.php?tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares);
doAjax('../pagos_det2.php','&tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares+'&moneda_v='+moneda_v+'&tope='+tope+'&fecha_det_pago='+fecha_det_pago+'&tcambio_det_pago='+tcambio_det_pago+'&moneda_doc='+moneda_doc+'&acuenta='+acuenta+'&moneda_doc='+moneda_doc+'&total_doc='+total_doc,'lista_pago','get','0','1','','');

//doAjax('calcular.php','accion=acuenta','calcular_acuenta','get','0','1','','');

	}

}

function lista_pago(texto){

var r = texto.split("?");
document.getElementById('pagos_d').innerHTML=r[0];
//document.getElementById('pagos_d').style.visibility='visible';
document.formulario.soles.value=0;
document.formulario.soles.disabled=false;
document.formulario.dolares.value=0;
document.formulario.dolares.disabled=false;
document.formulario.numero_tarjeta.value="";
//document.formulario.tpago.focus();
var moneda_doc=document.formulario.tmoneda.value;
//alert();
//var tc_doc=tc_doc;
//alert(r[1]);
document.formulario.acuenta.value=parseFloat(r[1].replace(',','')).toFixed(2);
//alert(r[1]);

//alert(document.formulario.tmoneda.value);
if(document.formulario.tmoneda.value==02){

	var temp=parseFloat(document.formulario.total_s.value.replace(',',''))-(parseFloat(r[1].replace(',',''))*tc_doc).toFixed(2);

	var temp2=parseFloat(document.formulario.total_d.value.replace(',','')) - parseFloat(r[1].replace(',',''));
	//alert(r[1]);
	//alert(parseFloat(document.formulario.total_s.value.replace(',','')) );
	var pendiente_s=parseFloat(temp).toFixed(2);
	var pendiente_d=parseFloat(temp2).toFixed(2);
	//alert(pendiente_s);
	
		if(pendiente_s < 0 || pendiente_d < 0){
		
		document.formulario.pendiente_s.value="0.00";
		document.formulario.pendiente_d.value="0.00";
		//alert();
		
			calcular_vuelto();
		
		}else{
		//alert(pendiente_s);
		document.formulario.pendiente_s.value=parseFloat(pendiente_s).toFixed(2);
		document.formulario.pendiente_d.value=parseFloat(pendiente_d).toFixed(2);
		
		document.formulario.vuelto.value="0.00";
		}
}else{
		
		//alert(r[1].replace(',',''));
 		var pendiente_s=parseFloat(document.formulario.total_s.value)-parseFloat(r[1].replace(',',''));
		var pendiente_d=parseFloat(document.formulario.total_d.value)-(parseFloat(r[1].replace(',','')).toFixed(2)/tc_doc).toFixed(2);
	//	alert(pendiente_s+" - "+pendiente_d+" - "+tc_doc);
		if(pendiente_s < 0 || pendiente_d < 0){
		document.formulario.pendiente_s.value="0.00";
		document.formulario.pendiente_d.value="0.00";
		//alert();
		//alert(document.getElementById('tbl_pagos').rows.length);
	//	document.formulario.vuelto.value=;
		//calcular_vuelto();
		}else{
		//alert(pendiente_s.toFixed(2));
		document.formulario.pendiente_s.value=pendiente_s.toFixed(2);
		document.formulario.pendiente_d.value=pendiente_d.toFixed(2);	
		document.formulario.vuelto.value="0.00";	
		
		}
	calcular_vuelto();
	
		document.formulario.Submit52.focus();
	
}
//document.form1.pendiente_s.value=


//doAjax('calcular.php','accion=acuenta','calcular_acuenta','get','0','1','','');
//doAjax('calcular.php','accion=vuelto&importe='+document.form1.importe.value,'calcular_vuelto','get','0','1','','');
//alert();
control_focus.select();
control_focus.focus();

}


function calcular_vuelto(){
//alert();
var filas=document.getElementById('tbl_pagos').rows.length;
var moneda_doc=document.formulario.tmoneda.value;
var monto_total=0;
//var tc_doc=tc_doc;

			for(var i=1;i<filas;i++){

				if(document.getElementById('tbl_pagos').rows[i].cells[3].childNodes[0].innerHTML.replace(',','') > 0){
					var temp_monto=document.getElementById('tbl_pagos').rows[i].cells[3].childNodes[0].innerHTML.replace(',','');
					var temp_mon=01;
					//alert(temp_monto);
				}else{
					var temp_monto=document.getElementById('tbl_pagos').rows[i].cells[5].childNodes[0].innerHTML.replace(',','');
					var temp_mon=02;
					
				}
				var temp_tc=document.getElementById('tbl_pagos').rows[i].cells[4].childNodes[0].innerHTML;
				
				if(document.getElementById('tbl_pagos').rows[i].cells[0].childNodes[0].innerHTML=='A'){
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
				
			}
		//	alert(monto_total+" - "+parseFloat(document.formulario.importe2.value));
			var vuelto=monto_total-parseFloat(document.formulario.importe2.value);
	
			var mon_vuelto=document.formulario.vueltoen.value;
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
		
		if(vuelto_total<0){
		document.formulario.vuelto.value='0.00';
		}else{
		document.formulario.vuelto.value=vuelto_total.toFixed(2);
		}
		

}

function eliminar_pagos(codigo,tipo){
	if(tipo=='C'){
		alert('Movimiento no se puede eliminar...');
	}else{
		var respuesta=confirm("confirma que desea eliminar este dato?")
		var acuenta=document.formulario.acuenta.value;
		var moneda_doc=document.formulario.tmoneda.value;
		var total_doc=document.formulario.importe2.value;
	
		if(respuesta)
		{
		doAjax('../pagos_det2.php','&accion=eliminar&cod_pago='+codigo+'&acuenta='+acuenta+'&moneda_doc='+moneda_doc+'&total_doc='+total_doc,'lista_pago','get','0','1','','');
	//	alert("eliminando Codigo numero: "+codigo);
		}
		else
		{
			//alert("no se pudo eliminar..");
		}
	}
}


function c_dolares(e,control){
//document.form1.soles.disabled=true;
control_focus=control;
document.formulario.soles.value=0;

	if(e.keyCode == 13){
	
	if(control.value==0 || control.value==''){
	alert("Ingresar un monto");
	//alert(control.name);
	control.select();
	control.focus();
		
	document.formulario.soles.disabled=false;
	return false;
	}
	
	if(document.formulario.pendiente_s.value==0 ||  document.formulario.pendiente_d.value==0){
	alert("Ya no existe saldo para cancelar. :-D");
	return false;
	}	

	var tpago=document.formulario.tpago.value;
	var numero=document.formulario.numero_tarjeta.value;
	var soles=document.formulario.soles.value;
	var dolares=document.formulario.dolares.value;
	var moneda_v=document.formulario.vueltoen.value;
	var tope=document.formulario.tope.value;
	var fecha_det_pago=document.formulario.femi.value;
	var tcambio_det_pago=document.formulario.tcPago.value;;
	var moneda_doc=document.formulario.tmoneda.value;
	var acuenta=document.formulario.acuenta.value;
	
	var moneda_doc=document.formulario.tmoneda.value;
	var total_doc=document.formulario.importe2.value;
	
	
	//alert('pagos_det.php?tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares);
doAjax('../pagos_det2.php','&tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares+'&moneda_v='+moneda_v+'&tope='+tope+'&fecha_det_pago='+fecha_det_pago+'&tcambio_det_pago='+tcambio_det_pago+'&moneda_doc='+moneda_doc+'&acuenta='+acuenta+'&moneda_doc='+moneda_doc+'&total_doc='+total_doc,'lista_pago','get','0','1','','');
		
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


function guardarCaja(){

    var mnjDeuda=deudaCondx();
	if(mnjDeuda=='N'){
		if(document.formulario.pendiente_s.value==0){
		grabar_doc();
		}else{
		alert("Existe un saldo pendiente");
		}
	}else{
		grabar_doc();
	}

 
}

function deudaCondx(){

var tempCond=document.formulario.deudaCond.value.split("|");

var tempcodCond1=tempCond[0].split("-");
var tempcodCond2=tempCond[1].split("-");
//alert(tempcodCond1.length);
	for(var i=1;i<tempcodCond1.length;i++){
		//tempcodCond1
		if(tempcodCond1[i]==document.formulario.condicion.value){
		var manejaDeuda=tempcodCond2[i];
		}
	}

return manejaDeuda;
}


function cerrarCaja(){

document.getElementById("cajaFact").style.visibility='hidden';
elemento=document.getElementById('capa_fondo');
elemento.parentNode.removeChild(elemento);
temporal_teclas="";
mostrarCbos2();
document.formulario.acuenta.value=0;
doAjax('../pagos_det2.php','&accion=cerrar','','get','0','1','','');

}


function cerrarTotales(){

document.getElementById("detTotales").style.visibility='hidden';
elemento=document.getElementById('capa_fondo');
elemento.parentNode.removeChild(elemento);
//temporal_teclas="";
mostrarCbos2();

}

function insertPagoC(){

	if(document.formulario.soles.value>0){
	event.keyCode=13;
	c_soles(event,document.formulario.soles);
	return false;
	}
	
	if(document.formulario.dolares.value>0){
	event.keyCode=13;
	c_dolares(event,document.formulario.dolares);
	
	}

}

function pasarCampoCaja(e,obj){

	if(e.keyCode==13){
	
	document.formulario.soles.focus();
	document.formulario.soles.select();
		
	}

}

var tempNameDesc="";
function recalcular_desc(control,producto,e,precosto,mon_prod,pre_actual,descx,precioUnit,cantprod,fila){

    tempNameDesc=fila;
	
	if(e.keyCode==13){
	var desc_nuevo=parseFloat(control.value);
	var tc_doc=document.formulario.tcambio.value;
	
	var tipoDesc=control.id;
	
	if(tipoDesc=='desc1Det'){
	tempTotal1=precioUnit*cantprod;
	tempTotal1=tempTotal1-(tempTotal1*parseFloat(control.value)/100);
	tempTotal1=tempTotal1-(tempTotal1*parseFloat(descx)/100);
	}
	
	if(tipoDesc=='desc2Det'){
	tempTotal1=precioUnit*cantprod;
	tempTotal1=tempTotal1-(tempTotal1*parseFloat(descx)/100);
	tempTotal1=tempTotal1-(tempTotal1*parseFloat(control.value)/100);
	}
	
		
	var preConDesc=(tempTotal1/cantprod).toFixed(2);
		
		if(mon_prod==1 && document.getElementById('moneda').innerHTML=='(US$.)'){
				precosto=parseFloat(precosto/tc_doc).toFixed(2);
				}else{
					if(mon_prod==2 && document.getElementById('moneda').innerHTML=='(S/.)'){
					precosto=parseFloat(precosto*tc_doc).toFixed(2);
					}
	    }
		
		//alert(mon_prod+" "+precosto);
	/* Precio Menor al costo en el detalle*/
	//alert(precio_nuevo+"-"+precosto);
	var permiso16=find_prm(tab16,tab_cod);
	
	if(preConDesc<precosto){
	alert('El descuento aplicado hace que el precio de venta sea menor al ' + etiqPrecio5);
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
		var fechaEmi=document.formulario.femi.value;
        var condicion=document.formulario.condicion.value;
		var tienda=document.formulario.almacen.value;
		var permiso21=find_prm(tab_descuento,tab_cod);//mostrar descuento
		var permiso27=find_prm(tab_puntos,tab_cod);
		var permiso28=find_prm(tab_envases,tab_cod);
		var tipoDescuento=find_prm(tab_tipoDesc,tab_cod);
		//alert(producto);
		var permiso_modifPrecio=find_prm(tab_modifPrecio,tab_cod);
		var stockProd=document.formulario.saldo.value;
			
		
	doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&accion=cambiar_dolar&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&permiso10='+permiso10+'&desc_nuevo='+desc_nuevo+'&producto='+producto+'&cambiar_desc&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov+'&fechaEmi='+fechaEmi+'&condicion='+condicion+'&tienda='+tienda+'&permiso21='+permiso21+'&permiso27='+permiso27+'&tipoDesc='+tipoDesc+'&permiso28='+permiso28+'&tipoDescuento='+tipoDescuento+'&permiso_modifPrecio='+permiso_modifPrecio+'&stockProd='+stockProd,'mostrar','get','0','1','','');
	
	}

}


function validarNumero1(control,e){
//alert(e.keyCode);
	try{
		if((e.keyCode>=96 && e.keyCode<=105) || (e.keyCode>46 && e.keyCode<58) || e.keyCode==8  || e.keyCode==37 || e.keyCode==39 ){
			temp=control.value.split(".");
			if(e.keyCode==190 || e.keyCode==110){
				if(temp[1]!=undefined){	
					e.keyCode=0;
					event.returnValue=false;
					return false;
				}
			}
		}else{
			if(e.keyCode==13){
				
				
			}else{
				e.keyCode=0;
				event.returnValue=false;
				return false;
			}
		}
	}catch(e){
	
	}	

}

function validarNumero2(control,e){
//alert(e.keyCode);
	try{
	//alert(e.keyCode);
		if((e.keyCode>=96 && e.keyCode<=105) || (e.keyCode>46 && e.keyCode<58) || e.keyCode==8 || e.keyCode==190 || e.keyCode==37 || e.keyCode==39 || e.keyCode==110){
			temp=control.value.split(".");
			if(e.keyCode==190 || e.keyCode==110){
				if(temp[1]!=undefined){	
					e.keyCode=0;
					event.returnValue=false;
					return false;
				}
			}
		}else{
			if(e.keyCode==13){
				
				
			}else{
				e.keyCode=0;
				event.returnValue=false;
				return false;
			}
		}
	}catch(e){
	
	}	

}

function verDetTotales(){

			generateCoverDiv("capa_fondo","#000000",10);
			ocultarCbos();
			document.getElementById("detTotales").style.visibility='visible';
			
}

function ingFlete(e){

if(e.keyCode==13){
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
		     var fechaEmi=document.formulario.femi.value;
             var condicion=document.formulario.condicion.value;
			 var tienda=document.formulario.almacen.value;
			 var permiso21=find_prm(tab_descuento,tab_cod);//mostrar descuento
			 var flete=document.formulario.flete.value;
			 var permiso27=find_prm(tab_puntos,tab_cod);
			 var permiso28=find_prm(tab_envases,tab_cod);
			var tipoDescuento=find_prm(tab_tipoDesc,tab_cod);
			var stockProd=document.formulario.saldo.value;
			
			 			
			doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&permiso10='+permiso10+'&cargar_ref&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov+'&fechaEmi='+fechaEmi+'&condicion='+condicion+'&tienda='+tienda+'&permiso21='+permiso21+'&permiso27='+permiso27+'&flete='+flete+'&accion=mostrarprod&permiso28='+permiso28+'&tipoDesc='+tipoDesc+'&stockProd='+stockProd,'mostrar','get','0','1','','');
			}

}
			
function activarLider(obj){

	if(obj.checked){
	document.formulario.selectLider.options[0].selected=true;
	document.formulario.selectLider.disabled=true;		
	}else{
	document.formulario.selectLider.disabled=false;
	}
	
	
}


function ingEnvases(control,producto,e){

   
	
	if(e.keyCode==13){
	
	    var tc_doc=document.formulario.tcambio.value;
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
		var fechaEmi=document.formulario.femi.value;
        var condicion=document.formulario.condicion.value;
		var tienda=document.formulario.almacen.value;
		var permiso21=find_prm(tab_descuento,tab_cod);//mostrar descuento
		var permiso27=find_prm(tab_puntos,tab_cod);
		var permiso28=find_prm(tab_envases,tab_cod);
		var tipoDescuento=find_prm(tab_tipoDesc,tab_cod);
		//alert(producto);
		var cantEnvases=control.value;
		var permiso_modifPrecio=find_prm(tab_modifPrecio,tab_cod);
		var stockProd=document.formulario.saldo.value;
			
		
		doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&accion=cambiar_dolar&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&permiso10='+permiso10+'&producto='+producto+'&ingEnvases&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov+'&fechaEmi='+fechaEmi+'&condicion='+condicion+'&tienda='+tienda+'&permiso21='+permiso21+'&permiso27='+permiso27+'&permiso28='+permiso28+'&tipoDescuento='+tipoDescuento+'&cantEnvases='+cantEnvases+'&permiso_modifPrecio='+permiso_modifPrecio+'&stockProd='+stockProd,'mostrar','get','0','1','','');
	
	  }else{
	  
	  control.style.background='#B0FFCC';
	  }
	   

}

var temp2="";
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
function verOrder(){
	document.getElementById("divOrder").style.display="block";
}	

function cambiarPrecio(nro){

document.formulario.cambiarPrecio.value=nro;
if(nro=='')nro=1;
document.getElementById("etiq_precio").innerHTML=nro;

filtros();
document.getElementById("divOrder").style.display="none";

}

function cambiarOtraDirec(control){
//alert(document.formulario.cboOtrasDirec.selectedIndex);

document.formulario.dirDestino.value=document.formulario.cboOtrasDirec.options[document.formulario.cboOtrasDirec.selectedIndex].text;

if(control.value==0){
document.formulario.dirDestino.value=document.formulario.dirDestino2.value;
}


}

function removeTags(string){
  return string.replace(/(?:<(?:script|style)[^>]*>[\s\S]*?<\/(?:script|style)>|<[!\/]?[a-z]\w*(?:\s*[a-z][\w\-]*=?[^>]*)*>|<!--[\s\S]*?-->|<\?[\s\S]*?\?>)[\r\n]*/gi, '');
}

function cambiar_vuelto(){

var moneda_v=document.formulario.vueltoen.value;


				
				
				if(document.formulario.tmoneda.value=='01'){
				var soles=parseFloat(document.formulario.importe2.value);
				}else{
				var dolares=parseFloat(document.formulario.importe2.value);
				}
				
				var tpago=document.formulario.tpago.value;
				var numero="";
				var tope=document.formulario.tope.value;
				var fecha_det_pago=document.formulario.femi.value;
				var tcambio_det_pago=document.formulario.tcPago.value;;
				var moneda_doc=document.formulario.tmoneda.value;
				var acuenta=document.formulario.acuenta.value;
				var condicion=document.formulario.condicion.value;
				var doc=document.formulario.doc.value;
				var moneda_doc=document.formulario.tmoneda.value;
				var total_doc=document.formulario.importe2.value;
				
				//alert(soles);
							//alert('pagos_det.php?tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares);
			doAjax('../pagos_det2.php','&tpago='+tpago+'&numero='+numero+'&soles='+soles+'&dolares='+dolares+'&moneda_v='+moneda_v+'&tope='+tope+'&fecha_det_pago='+fecha_det_pago+'&tcambio_det_pago='+tcambio_det_pago+'&moneda_doc='+moneda_doc+'&acuenta='+acuenta+'&condicion='+condicion+'&doc='+doc+'&total_doc='+total_doc+'&accion=cambiar_vuelto','lista_pago','get','0','1','','');

}


function separarMiles(Elemento){
    //0123456789
    //deve de quedar $123,456,789.00
    //del elemento obtenemos su valor
    var valor=Elemento.value;
    var valorDecimal;
    var agregar00=true;
    if(valor.indexOf("$")!=-1){
    }else{
        //se compara para ver si tiene decimales
        if(valor.indexOf(".")!=-1){
            //si tiene decimales no se la gregara el .00
            agregar00=false;
            //se separa el valor decimal del valor entero
            valorDecimal=valor.substring(valor.indexOf("."), largo);
            valor=valor.substring(0, valor.indexOf("."));
        }
        //se toma el valor del entero
        var largo=valor.length;
        if(largo>9){
            valor=valor.substring(largo-12,largo-9)+","+valor.substring(largo-9,largo-6)+","+valor.substring(largo-6,largo-3)+","+valor.substring(largo-3, largo);
        }else
        if(largo>6){
            valor=valor.substring(largo-9,largo-6)+","+valor.substring(largo-6,largo-3)+","+valor.substring(largo-3, largo);
        }else
        if(largo>3){
            valor=valor.substring(largo-6,largo-3)+","+valor.substring(largo-3, largo);
        }
        valor="$"+valor;
        if(agregar00==true){
            valor=valor+".00"
        }else{
            valor=valor+valorDecimal;
        }
        Elemento.value=valor;
    }
}
			


function cargarControlJquery(){
	
if(navigator.appName != 'Microsoft Internet Explorer'){

	jQuery("#condicion").keydown(function(){
	//alert();
		document.formulario.femi.disabled=false;
		document.formulario.femi.focus();
		document.formulario.femi.select();
		/*
		event.keyCode=0;
		event.returnValue=false;
		return false;
		*/
	});
	
	/*
	jQuery("#condicion").find("#almacen").keydown(function(){
		//alert();
		if(document.frmCopiarDoc.almacen.value=='0'){
			document.frmCopiarDoc.almacen.focus();
		}else{
			document.frmCopiarDoc.doc.focus();
		}			  
	});
	
	jQuery("#capaCopiarDoc").find("#doc").keydown(function(){		
		if(document.frmCopiarDoc.doc.value=='0'){
			document.frmCopiarDoc.doc.focus();
		}else{
			document.frmCopiarDoc.serie.focus();
		}
					  
	});	
*/
}	
	
}

function cerrarDivLote(){
document.getElementById("divLotes").style.visibility='hidden';
document.getElementById("divLotesVenta").style.visibility='hidden';

elemento=document.getElementById('capa_fondo');
elemento.parentNode.removeChild(elemento);
temporal_teclas="";	
document.formulario.des_lote.value="";
//document.formulario.venc_lote.value="";	
document.formulario.cantidad.focus();


}

function aceptarLote(){	
	
document.getElementById("divLotes").style.visibility='hidden';
elemento=document.getElementById('capa_fondo');
elemento.parentNode.removeChild(elemento);
temporal_teclas="";
	
	enviar();
				
}

function mostrar_lotesDisp(data){	
	
	document.getElementById("divLotesDisponible").innerHTML=data;
	
}

function editar_lote(des_lote,fecha){
	
		//alert(des_lote+" "+fecha);
		generateCoverDiv("capa_fondo","#000000",10);
		document.getElementById('divLotes').style.visibility="visible";
		document.formulario.des_lote.value=des_lote;
		document.formulario.venc_lote.value=fecha;
		
		document.formulario.des_lote.disabled=true;
		document.formulario.venc_lote.disabled=true;
		document.formulario.buttonAcpL.disabled=true;
		
		
		return false;
		
}

function aeptarDivLoteV(){

var valor1="";
var valor2="";

		try{
			
		   if(document.getElementById("divLotesVenta").style.visibility=="visible"){
				
				
					  for(var i=0;i<document.formulario.checkboxLoteV.length;i++){
						  
							if (document.formulario.checkboxLoteV[i].checked){
								
								var tempLot=document.formulario.checkboxLoteV[i].value.split("|");
								valor1=valor1+"|"+tempLot[0];
								valor2=valor2+"|"+tempLot[1];
							}
					  }
				
			}
		}catch(e){			
			//var valor=document.formulario.checkboxLoteV.value;
		}
			
		var producto=document.formulario.codprod.value;
		var codLote=valor1;
		var cantxLote=valor2;
				
				//alert("---->"+cantxLote+"<--- --->"+codLote+"<---");
			
		doAjax('peticion_datos.php','&producto='+producto+'&codLote='+codLote+'&cantxLote='+cantxLote+'&peticion=arrayLotesVentas','rpta_arraylotes','get','0','1','','');	
			
	//alert(valor1+"--->"+valor2);

document.getElementById("divLotesVenta").style.visibility='hidden';
}


function rpta_arraylotes(data){

elemento=document.getElementById('capa_fondo');
elemento.parentNode.removeChild(elemento);
document.formulario.tempLotesVenta.value='S';
enviar();
	
}


	function entradae2(objeto){
	
			if(objeto.style.background=='#fff1bb'  || objeto.style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || objeto.style.background=='rgb(255, 241, 187)'){
			//alert(objeto.bgColor);
			objeto.style.background='#ffffff';
				
				objeto.cells[0].childNodes[0].checked=false;
				
				document.formulario.cant_selec_lotes.value=parseFloat(document.formulario.cant_selec_lotes.value)-1;
						
			}else{
				
				
			  //alert(contorl_item_selec() +" "+ document.form_series.cant_req.value);
						
			objeto.style.background='#FFF1BB';
			
			objeto.cells[0].childNodes[0].checked=true;
			
			//document.getElementById("label_cant_selec").innerHTML=contorl_item_selec();
			//document.form_series.cant_selec.value=contorl_item_selec();
			
				document.formulario.cant_selec_lotes.value=parseFloat(document.formulario.cant_selec_lotes.value)+1;
				
			}
		
	}
	
	
function ventasMesVend(){

window.open('../ventasMesVend.php','ventven','width=450,height=400,top=200,left=200,status=yes,scrollbars=yes');

}

function ventasDetallado(){

window.open('../ventasDetallado.php','ventven','width=850,height=600,top=200,left=200,status=yes,scrollbars=yes');

}	

</script>
<!--<embed style="visibility:hidden" src="alerrta1.mp3" id="sound2" width="0" heigh="0" autostart="false" enablejavascript="true"/>-->
</html>
