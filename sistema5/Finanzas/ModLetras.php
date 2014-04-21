<?php 
session_start();
include("../conex_inicial.php");
include("../funciones/funciones.php");

$carga="0";
if(isset($_REQUEST['referencia'])){
	$ref=$_REQUEST['referencia'];
	$sql="Select * from multicj where multi_id='".$ref."'";
	$res=mysql_query($sql,$cn);
	$rw=mysql_fetch_array($res);
	$empresax=$rw['cod_suc'];
	$numerox=$rw['numcje'];
	$carga="1";
}
if(isset($_REQUEST['referencia2'])){
	$ref=$_REQUEST['referencia2'];
	$sql="Select mc.* from multicj mc inner join multi_det md on md.multi_id=mc.multi_id where det_id='".$ref."'";
	$res=mysql_query($sql,$cn);
	$rw=mysql_fetch_array($res);
	$empresax=$rw['cod_suc'];
	$numerox=$rw['numcje'];
	$carga="1";
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Canje de Letras</title>
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
.Estilo353 {
	font-size: 12px;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color:#F00;
}
.Estilo354 {
	font-size: 10px;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color:#00F;
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

jQuery(document).bind('keydown', 'f5',function (evt){jQuery('#_up').addClass('dirty');
//	alert('f5');
	var tecla=window.event.keyCode;
  if (tecla==116) {//alert("F5 deshabilitado!")
  event.keyCode=0;
event.returnValue=false;}
return false; });

jQuery(document).bind('keypress', 'return',function (evt){jQuery('#_return').addClass('dirty'); 
	if(document.getElementById('auxiliares').style.visibility=='visible'){
		for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
			if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb'  || document.getElementById('tblproductos1').rows[i].style.background == 'none repeat scroll 0% 0% rgb(255, 241, 187)' || document.getElementById('tblproductos1').rows[i].style.background=='rgb(255, 241, 187)' ){
				if(navigator.appName!='Microsoft Internet Explorer'){
					var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[1].childNodes[1].innerHTML;
					var temp1=document.getElementById('tblproductos1').rows[i].cells[1].childNodes[0].innerHTML;
					var doc=document.form1.doc.value;
					var ruc=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[0].childNodes[1].childNodes[0].childNodes[3].childNodes[0].innerHTML;
				}else{
					//IE 10
					if(document.getElementById('tblproductos1').rows[i].cells[0].childNodes[0].innerHTML==undefined){
						var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[1].childNodes[1].innerHTML;
						var temp1=document.getElementById('tblproductos1').rows[i].cells[1].childNodes[0].innerHTML;
						var doc=document.form1.doc.value;
						var ruc=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[0].childNodes[1].childNodes[0].cells[1].childNodes[0].innerHTML;
					}else{
						//IE 6-9
						var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
						var temp1=document.getElementById('tblproductos1').rows[i].cells[1].childNodes[0].innerHTML;
						var doc=document.form1.doc.value;
						var ruc=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[0].childNodes[0].childNodes[0].childNodes[1].childNodes[0].innerHTML;
					}
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

jQuery(document).bind('keyup', 'up',function (evt){jQuery('#_up').addClass('dirty');
	//document.getElementById('TablaDatos').rows[0].style.background='#FFCC00';   
   if(document.getElementById('auxiliares').style.visibility=='visible'){
	
	for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
//	alert(document.getElementById('tblproductos').rows.length);
		if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' || document.getElementById('tblproductos1').rows[i].style.background=='rgb(255, 241, 187)' || document.getElementById('tblproductos1').rows[i].style.background == 'none repeat scroll 0% 0% rgb(255, 241, 187)' && (i!=0) ){
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

jQuery(document).bind('keyup', 'down',function (evt){jQuery('#_down').addClass('dirty');

	if(document.getElementById('auxiliares').style.visibility=='visible'){
 //alert('entro');
	for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
			
		//	alert(document.getElementById('tblproductos').rows.length);
			if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' || document.getElementById('tblproductos1').rows[i].style.background=='rgb(255, 241, 187)' || document.getElementById('tblproductos1').rows[i].style.background == 'none repeat scroll 0% 0% rgb(255, 241, 187)' && (i!=document.getElementById('tblproductos1').rows.length-1)){
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
	
	if(document.form1.cliente2.value!=""){
		Cerrar();
	}
	if(document.getElementById('nuevo_cliente').style.visibility=='hidden'){
	document.getElementById('auxiliares').style.visibility='hidden';
	document.getElementById('condicion').style.visibility='visible';
	//document.getElementById('tpago').style.visibility='visible';
	document.form1.cliente.focus();
	//alert("escape");
	}
	if(document.getElementById('nuevo_cliente').style.visibility=='visible'){
	document.getElementById('nuevo_cliente').style.visibility='hidden'
	}
	
return false; });

jQuery(document).bind('keydown', 'shift+f3',function (evt){jQuery('#_esc').addClass('dirty'); 
	
	if(document.form1.cliente2.value!=""){
		cargar_docs();
	}
	
return false; });

jQuery(document).bind('keydown', 'f4',function (evt){jQuery('#_esc').addClass('dirty'); 
	event.keyCode=0;
	event.returnValue=false;
	if(document.form1.cliente2.value!="" && document.form1.genlet!=undefined){
		if(document.form1.genlet.disabled==false){
			GeneradorLetras();
		}else{
			alert('Ya no se pueden generar mas Letras');
		}
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
 
	 doAjax('lista_aux.php','&temp=auxiliares&tipomov='+document.form1.tipo.value+'&modulo=tranf','listaprod','get','0','1','','');
	 document.getElementById('condicion').style.visibility='hidden';
	 //document.getElementById('tpago').style.visibility='hidden';
	// document.formulario.pro.value=0;
//	 document.getElementById('productos').style.visibility='visible';
		 return false; }); 
 
 jQuery(document).bind('keydown', 'f2',function (evt){jQuery('#_f8').addClass('dirty');
 
		if(confirm("Desea Actualizar el saldo en el Documento")){
			guardar();
		}//else{
		//	alert("Cambios Guardados Temporalmente");
		//}
		return false; }); 

jQuery(document).bind('keydown', 'f7',function (evt){jQuery('#_f7').addClass('dirty');
	 var codigo='<?php if(isset($_SESSION['registro'])){echo $_SESSION['registro'];}?>';
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

function salir(){
	if(document.getElementById('nuevo_cliente').style.visibility=='hidden'){
		document.getElementById('auxiliares').style.visibility='hidden';
		document.getElementById('condicion').style.visibility='visible';
	}
}

function ponerCeros(obj,i) {
  while (obj.length<i){
    obj = '0'+obj;
	}
//	alert(obj);
	return obj;
}

function asignarresp(dato){
	document.form1.txtresp.value=dato;
}

function asignarsuc(dato){
var suc=dato;
document.form1.suc4.value=dato;
var cargax="<?php echo $carga; ?>";
var tipo="<?php echo $_REQUEST['tipo']; ?>";
//alert(cargax);
if(cargax!="1" && cargax!="2"){
doAjax('generarnumero.php','&accion=numcanje&sucu='+dato+'&tipo='+tipo,'mostrar_numero','get','0','1','','');
}
}

function mostrar_numero(texto){
	//alert(texto);
	var cadena=texto.split('-');
	document.form1.numero.value=ponerCeros(cadena[0],11);
	document.form1.numero.focus();
	document.form1.numero.select();
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
//alert(textos);
}

</script>
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
	var num=document.form1.numero.value;
	numero=ponerCeros(num,11);
	//alert('num='+numero+'&sucu='+suc+'&tipo='+document.form1.tipo.value);
	if(e == 13){
		//alert('num='+numero+'&sucu='+suc+'&tipo='+document.form1.tipo.value);
		var numero=ponerCeros(num,11);
		document.form1.numero.value=numero;
		doAjax('operaciones.php','&accion=buscarcanje&num='+numero+'&sucu='+suc+'&tipo='+document.form1.tipo.value,'busca_let','get','0','1','','');
	}
}

function cargar_pagos(){
	var mone=document.form1.condicion2.value;
	var tcam=document.form1.tcact.value;
	doAjax('operaciones.php','&accion=mostrardoc&moneda='+mone+'&tcam='+tcam,'mostrar_pagos','get','0','1','','');
}

function mostrar_pagos2(texto){
	datos=texto.split("|");
	document.getElementById('det_doc').innerHTML=datos[0];
	document.getElementById('dvcancelar').innerHTML=datos[1];
	document.getElementById('dvpagoslet').innerHTML=datos[2];
	document.form1.mone_doc.value=document.form1.condicion2.value;
	document.form1.importe.value=datos[3];
	document.form1.saldo.value=datos[3];
	if(parseFloat(document.form1.saldo.value)>0){
		document.form1.genlet.disabled=false;
	}
	doAjax('operaciones.php','&accion=recuperar&total_mon='+document.form1.total_gen_doc.value,'MostrarLetra2','get','0','1','','');
}

function mostrar_pagos(texto){
	datos=texto.split("|");
	//alert(datos[3]);
	document.getElementById('det_doc').innerHTML=datos[0];
	document.getElementById('dvcancelar').innerHTML=datos[1];
	document.getElementById('dvpagoslet').innerHTML=datos[2];
	document.form1.mone_doc.value=document.form1.condicion2.value;
	document.form1.importe.value=datos[3];
	document.form1.saldo.value=datos[3];
	if(parseFloat(document.form1.saldo.value)>0){
		document.form1.genlet.disabled=false;
	}
}

function GeneradorLetras(){
	//alert(document.form1.saldo.value);
	doAjax('motivo.php','&generarletra&mone='+document.form1.condicion2.value+'&total='+document.form1.saldo.value,'motivo','get','0','1','','');
}

function calcularcuotas(cuo,docu){
	doAjax('operaciones.php','&accion=calcularcuotas&cuo='+cuo+'&mon='+document.form1.condicion2.value+'&total='+document.form1.saldo.value+'&docu='+docu,'MostrarCuota','get','0','1','','');
}

function MostrarCuota(texto){
	document.getElementById('rescuota').innerHTML=texto;
}

function validarNumero(control,e){
//alert(e.keyCode);
	try{
	//alert(e.keyCode);
		if((e.keyCode>=96 && e.keyCode<=105) || (e.keyCode>46 && e.keyCode<58) || e.keyCode==8 || e.keyCode==190 || e.keyCode==37 || e.keyCode==39 || e.keyCode==110){
			//temp=control.value.split("-");
			//temp2=control.value.split(".");
			if(e.keyCode==190 || e.keyCode==110){
				//if(temp[1]!=undefined || temp2[1]!=undefined){	*/
					e.keyCode=0;
					event.returnValue=false;
					return false;
				///}
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

function GenerarLetras(cuo,docu){
	var fec=document.form1.fecha.value;
	var venc=document.form1.venc.value;
	var canje=document.form1.numero.value;
	var tipo="<?php echo $_REQUEST['tipo'];?>";
	//alert(tipo);
	doAjax('operaciones.php','&accion=mostrarletras&cuo='+cuo+'&mon='+document.form1.condicion2.value+'&tipo='+tipo+'&total='+document.form1.saldo.value+'&docu='+docu+'&fecha='+fec+'&dvenc='+venc+'&canje='+canje,'MostrarLetra','get','0','1','','');
}

function MostrarLetra(texto){
	datos=texto.split("|");

	document.getElementById('letrasdet').innerHTML=datos[0];
	document.getElementById('abonosc').innerHTML=datos[1];
	document.getElementById('saldoc').innerHTML=datos[2];
	document.getElementById('motivo').style.visibility='hidden';
}

function MostrarLetra2(texto){
	datos=texto.split("|");
	document.getElementById('letrasdet').innerHTML=datos[0];
	document.getElementById('abonosc').innerHTML=datos[1];
	document.getElementById('saldoc').innerHTML=datos[2];
	document.form1.genlet.disabled=true;
}

function busca_let(texto){
	//alert(texto);
	var ex=texto.split("|");
	document.form1.suc.disabled=true;
	if(ex[0]=="existe"){
		//alert();
		buscar_canje();
	}else{
		limpiar('');
	}
}

function limpiar(texto){
	CerrarPla();
	document.getElementById('det_doc').innerHTML="";
	document.getElementById('dvcancelar').innerHTML="";
	document.getElementById('dvpagoslet').innerHTML="";
	if(texto==""){
		document.form1.numero.readOnly=true;
		document.form1.cliente.disabled=false;
		document.form1.cliente.value="";
		document.form1.cliente.focus();
		document.form1.cliente.select();
	}else{
		document.form1.numero.readOnly=false;
		document.form1.cliente.disabled=false;
		document.form1.cliente.value="";
		document.form1.numero.focus();
		document.form1.numero.select();
	}
	document.form1.fecha.value="<?php echo date('d/m/Y');?>";
	document.form1.fecha.readOnly=true;
	document.form1.cliente2.value="";
	document.form1.condicion2.disabled=false;
	document.form1.condicion.disabled=false;
	document.form1.txtrespon.disabled=false;
	document.form1.tcact.value=<?php echo $tcambio ?>;
	document.form1.tcact.readOnly=true;
	document.form1.f_trigger_b3.disabled=false;
	//document.getElementById('totalc').innerHTML=datos[6];
	//alert();
	document.form1.total_gen_doc.value="0.00";
}

function buscar_canje(){
	var tipo=document.form1.tipo.value;
	var sucu=document.form1.suc4.value;
	var num=document.form1.numero.value;
	doAjax('operaciones.php','&referencia&accion=recuperarmulti&sucu='+sucu+'&tipo='+tipo+'&num='+num,'cargar_canje','get','0','1','','');
}
function seleccionar_cbo(control,valor){
	var valor1=valor;
	var i;
	for (i=0;i< eval("document.form1."+control+".options.length");i++){
		if (eval("document.form1."+control+".options[i].value=='"+valor1+"'")){
			eval("document.form1."+control+".options[i].selected=true");
		}
	}
	eval("document.form1."+control+".disabled=true");
}

function cargar_canje(texto){
	//alert(texto);
	datos=texto.split("|");
	document.form1.fecha.value=datos[0];
	document.form1.fecha.readOnly=true;
	document.form1.cliente2.value=datos[1];
	document.form1.cliente.value=datos[2];
	document.form1.cliente.disabled=true;
	seleccionar_cbo("condicion2",datos[3]);
	seleccionar_cbo("condicion",datos[7]);
	seleccionar_cbo("txtrespon",datos[4]);
	document.form1.tcact.value=datos[5];
	document.form1.tcact.readOnly=true;
	document.form1.f_trigger_b3.disabled=true;
	//document.getElementById('totalc').innerHTML=datos[6];
	//alert();
	document.form1.total_gen_doc.value=datos[11];
	//var monto=datos[6];
	//alert(datos[7]);
	document.getElementById('auditoria').innerHTML="Valor Total: "+datos[6]+"<br>"+datos[10];
	switch(datos[7]){
		case 'A':alert("Anulado");break;
		case 'C':alert("Con Pagos");break;
		case 'B':alert("En Banco");break;
		case '1':alert("CONSULTA");break;
	}
	doAjax('operaciones.php','&referencia&accion=mostrardoc&moneda='+datos[3]+'&tcam='+datos[5],'mostrar_pagos2','get','0','1','','');
}

function colocar(){
	if(document.form1.tpago.value!=1){
		document.form1.soles.value=document.form1.importe2.value;
	}
}

function elegir(cod,razon,direccion,ruc){
	//alert();
document.form1.cliente2.value=cod;	
document.form1.cliente.value=razon;
document.form1.ruc3.value=ruc;
document.form1.direc.value=direccion;
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

document.getElementById('auxiliares').style.visibility='hidden';
document.getElementById('condicion').style.visibility='visible';
doAjax('operaciones.php','&accion=buscarpendiente&aux='+cod+'&sucu='+suc+'&tipo='+document.form1.tipo.value,'b_pendiente','get','0','1','','');
}

function b_pendiente(texto){
	if(texto!="ex"){
		alert(texto);
		document.form1.cliente.focus();
		document.form1.cliente.select();
	}else{
		document.form1.cancelar.disabled=false;
		document.form1.cliente.readOnly=true;
		document.form1.fecha.readOnly=true;
		document.form1.fecha.focus();
		document.form1.fecha.select();
	}
}

function motivo(texto){
document.getElementById('motivo').innerHTML=texto;
document.getElementById('motivo').style.visibility='visible';

}

function EliminarDoc(cod){
	//alert(cod);
	mone=document.form1.condicion2.value;
	tcam=document.form1.tcact.value;
	doAjax('operaciones.php','&accion=eliminardoc&moneda='+mone+'&tcam='+tcam+'&doc='+cod,'mostrar_pagos','get','0','1','','');
}

function Cerrar(){
	//alert(cod);
	doAjax('operaciones.php','&accion=selectdoc&salir','','get','0','1','','');
	//document.form1.submit();
	this.close();
}

function RecalcularSaldo(){
	if(document.getElementById('saldoc')!=undefined && document.getElementById('abonosc')!=undefined && document.getElementById('totalc')!=undefined){
	if(document.form1.condicion2.value=="02" && document.form1.mone_doc.value=="01"){
		nue=document.form1.importe.value/document.form1.tcact.value;
		document.form1.saldo.value=parseFloat(nue).toFixed(2);
		document.getElementById('saldoc').innerHTML=parseFloat(nue).toFixed(2);
		document.getElementById('abonosc').innerHTML=0.00;
		document.getElementById('totalc').innerHTML=parseFloat(nue).toFixed(2);
	}else{
		if(document.form1.condicion2.value=="01" && document.form1.mone_doc.value=="02"){
			nue=document.form1.importe.value*document.form1.tcact.value;
			document.form1.saldo.value=parseFloat(nue).toFixed(2);
			document.getElementById('saldoc').innerHTML=parseFloat(nue).toFixed(2);
			document.getElementById('abonosc').innerHTML=0.00;
			document.getElementById('totalc').innerHTML=parseFloat(nue).toFixed(2);
		}else{
			nue=document.form1.importe.value;
			document.form1.saldo.value=parseFloat(nue).toFixed(2);
			document.getElementById('saldoc').innerHTML=parseFloat(nue).toFixed(2);
			document.getElementById('abonosc').innerHTML=0.00;
			document.getElementById('totalc').innerHTML=parseFloat(nue).toFixed(2);
		}
	}
	document.getElementById('letrasdet').innerHTML="&nbsp;";
	}
}
function RecalcularLetra(d,e,l){
	if(e.keyCode==13){
		//alert(d.id);
		cont=(d.id).split("[");
		tipo=cont[0];
		fechac=document.form1.fecha.value;
		tipox=document.form1.tipo.value;
		//alert(tipo+" - "+l+" - "+d.value);
		doAjax('operaciones.php','&accion=modificarletra&num='+l+'&tip='+tipo+'&tipo='+tipox+'&dato='+d.value+'&fechac='+fechac,'ActualizarPago','get','0','1','','');
		;
	}
}

function ActualizarPago(texto){
	//alert(texto);
//	document.getElementById('saldoc').innerHTML=parseFloat(parseFloat(document.getElementById('totalc').innerHTML)-parseFloat(texto)).toFixed(2);
//	document.getElementById('abonosc').innerHTML=texto;
	tipo=document.form1.tipo.value;
	doAjax('operaciones.php','&accion=MostrarLetra2&total='+document.form1.saldo.value+'&tipo='+tipo,'MostrarLetra','get','0','1','','');
}

function guardar(){
	if(document.getElementById('saldoc').innerHTML=="0.00" && (document.form1.total_gen_doc.value=='' || document.form1.total_gen_doc.value=='0.00')){
		nume=document.form1.numero.value;
		tipo=document.form1.tipo.value;
		clie=document.form1.cliente2.value;
		sucu=document.form1.suc4.value;
		fech=document.form1.fecha.value;
		tcam=document.form1.tcact.value;
		resp=document.form1.txtresp.value;
		cond=document.form1.condicion.value;
		mone=document.form1.condicion2.value;
		tota=parseFloat(document.getElementById('totalc').innerHTML).toFixed(2);
		doAjax('operaciones.php','&accion=guardarmultic&num='+nume+'&tip='+tipo+'&clie='+clie+'&sucu='+sucu+'&fech='+fech+'&tcam='+tcam+'&resp='+resp+'&cond='+cond+'&mone='+mone+'&tota='+tota,'MostrarSave','get','0','1','','');
	}else{
		if(document.getElementById('saldoc').innerHTML!="0.00"){
			alert("Aun queda un Saldo pendiente");
		}else{
			alert("Documento en Consulta");
		}
	}
}
function MostrarSave(texto){
	resp=texto.split("|");
	if(resp[0]=="error"){
		alert(resp[1]);
	}else{
		//alert(texto);
		//Cerrar();
		limpiar('N');
	}
}
function ImprimirLet(cod){
	if(document.form1.total_gen_doc.value!='' && document.form1.total_gen_doc.value!='0.00'){
	var vent=window.open('../formatos/standard/ffinanzas.php?tabla=letra&codigo='+cod,'');
	}else{
		alert("Antes de imprimir debe guardar los cambios con 'F2'");
	}
}
function CerrarPla(){
doAjax('operaciones.php','&Modulo=SalirLetra','','get','0','1','','');
//alert('Cerrado');
}
</script>
<script>

function enfocar(){

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
	
	//alert(temp);+'&criterio='+temp_criterio +'&moneda_doc='+moneda_doc
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
	//alert();
document.form1.tcact.value=texto;
//document.form1.txtrespon.focus();
	//alert();
//document.form1.tcact2.value=texto;
//calcular_vuelto(document.form1.pendiente_s.value);
}

function OrigenDoc(valor){
	window.open("../doc_det2.php?referencia="+valor,"","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=320,left=300 top=250");
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
}

function cargar_docs(){
	var aux=document.form1.cliente2.value;
	var tipo=document.form1.tipo.value;

var suc=document.form1.suc4.value;
	
	window.open('add_docs_deuda.php?auxiliar='+aux+'&tipomov='+tipo+'&sucursal='+suc+'&ModLetras','ventana','width=610,height=450,top=100,left=300,scroolbars=no,directories=no,location=no,menubar=no,titlebar=no,toolbar=no,status=yes');		
		
}
</script>

<?php 
	$tip=$_REQUEST['tipo'];
	if($tip=='1'){
		$aux="Proveedor";
	}else{
		$aux="Cliente";
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

/*function cerrar(){
window.parent.opener.form1.ruc2.value="0";
}*/

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
<body onLoad="enfocar();" onUnload="CerrarPla();"> <?php /*?>//onBlur="cambiar();"<?php */?>
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
	
	<select name="motivo2">
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

<table width="712" height="425" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="277" colspan="5" valign="top">
	
	<form id="form1" name="form1" method="post" action="" >
	  <table width="710" height="435" border="0" cellpadding="0" cellspacing="0">
	    <tr bgcolor="#6699CC">
	      <td rowspan="3" bgcolor="#FFFFFF">&nbsp;</td>
	      <td height="67" rowspan="3" bgcolor="#004993">&nbsp;</td>
	      <td height="39" bgcolor="#004993"><span class="Estilo25">Sucursal</span></td>
	      <td colspan="4" valign="middle" bgcolor="#004993"><?php 
		  $se="";
		  $di="";
				  $SQL34="Select * from sucursal";
				  $consult1=mysql_query($SQL34,$cn);
				  while($row34=mysql_fetch_array($consult1)){
					if(($row34['cod_suc']==$_SESSION['user_sucursal'])|| isset($empresax)){
        		        $se="selected";
						$di="disabled='true'";
					}	
				  }
			?>
	        <input type="hidden" name="suc4" id="suc4" value="0">
	        <select <?php echo $di?> name="suc" id="suc" style="font:Verdana, Arial, Helvetica, sans-serif; font-size:10px" onChange="asignarsuc(this.value)">
	          <option value="0"> Seleccione Sucursal</option>
	          <?php 
				$SQL34="Select * from sucursal";
				$consult1=mysql_query($SQL34,$cn);
				while($row34=mysql_fetch_array($consult1)){
					if(isset($empresax)){
						echo "<script>asignarsuc(".$empresax.")</script>";
					}else{
						if($row34['cod_suc']==$_SESSION['user_sucursal']){
							echo "<script>asignarsuc(".$_SESSION['user_sucursal'].")</script>";
						}
					}
			  ?>
	          <option <?php
			  		if(isset($empresax)){
						if($row34['cod_suc']==$empresax){
							echo $se;
							$sud=$empresax;
						}
					}else{
						if($row34['cod_suc']==$_SESSION['user_sucursal']){
							echo $se;
							$sud=$row34['cod_suc'];
						}
					}
			?>
             value="<?php echo $row34['cod_suc']; ?>"> <?php echo $row34['des_suc']; }?></option>
	          </select>
              </td>
              <td bgcolor="#004993">
	        <input  name="importe" type="hidden" id="importe" size="10" value="<?php if(isset($total)){ echo number_format($total,2);}?>" />
	        <input type="hidden" name="mone_doc" id="mone_doc" value="">
	        <input  name="direc" type="hidden" id="direc" size="10" value="" />
	        <input type="hidden" name="cliente2" value="">
	        <input name="saldo" id="saldo" type="hidden" size="15" readonly="readonly" value="<?php 
			if(isset($mon)){
			echo $mon;
			if($mon=='01'){
		  	$tx=number_format($total,2,'.','')*number_format($tc,3,'.','');
		  }else{
			  $tx=number_format($total,2,'.','')/number_format($tc,3,'.','');
		  }		
		  echo number_format($tx,2,'.','');  
			}
		  ?>" />
	        <span class="Estilo25">
	          <input name="serie"  type="hidden" id="serie" size="5" maxlength="11" value="" onKeyUp="enfocar_numero(event)" onBlur="ceros_serie()"/>
	          </span>
	        <input name="mesa2" type="hidden" id="mesa2" size="10" maxlength="10" value="<?php if(isset($_REQUEST['mesa'])){echo $_REQUEST['mesa'];}?>">
	        <input name="registro2" type="hidden" size="10" maxlength="10" value="<?php if(isset($_REQUEST['registro'])){echo $_REQUEST['registro'];}?>">
	        <input name="servicio2" type="hidden" size="5" maxlength="5" value="<?php if(isset($servicio)){echo $servicio;}?>">
	        <input type="hidden" value="" name="auxiliar2" id="auxiliar2" size="6">
	        <input name="nivel" type="hidden" id="nivel" value="<? echo $_SESSION['nivel_usu']?>" size="5" maxlength="5">
	        <span class="Estilo25">
	          <input name="tempauxprod" type="hidden" value="auxiliares" size="15" />
	          <input name="prov_asoc" type="hidden" value="" size="40" />
	          <input name="tipo" id="tipo" type="hidden" value="<?php echo $_REQUEST['tipo']?>" size="5" />
	          <input name="moneorigen" id="moneorigen" type="hidden" value="<?php echo $_REQUEST['tipo']?>" size="5" />
	          <?php if($se!=""){echo "<script>asignarsuc('$sud')</script>";}?>
	          <input name="referencia" type="hidden" size="5" maxlength="5" >
	          </span></td>
	      </tr>
	    <tr bgcolor="#6699CC">
	      <td height="24" bgcolor="#004993"><span class="Estilo25">Num. Canje</span></td>
	      <td colspan="3" valign="middle" bgcolor="#004993"><input name="numero" type="text" id="numero" size="10" maxlength="11" onKeyPress="cargar_cuenta(event.keyCode)" onKeyDown="validarNumero(this,event)" value="<?php if($carga=="1"){echo $numerox;}?>"/>
		  <?php  if($carga=="1"){echo "<script>cargar_cuenta(13)</script>";} ?>
	        <input name="suc3" type="hidden" id="suc3" value="<? echo $_SESSION['user_sucursal']?>" size="5" maxlength="5">
	        <span class="Estilo25">
	          <input type="hidden" name="doc" id="doc" value="">
	          <input name="servicio" type="hidden" size="5" maxlength="5" value="<?php if(isset($servicio)){echo $servicio;}?>">
	          <input name="registro" type="hidden" size="10" maxlength="10" value="<?php if(isset($_REQUEST['registro'])){echo $_REQUEST['registro'];}?>">
	          <input name="mesa" type="hidden" id="mesa" size="10" maxlength="10" value="<?php if(isset($_REQUEST['mesa'])){echo $_REQUEST['mesa'];}?>">
	          </span></td>
	      <td colspan="2" align="left" bgcolor="#FFFF99"><span class="Estilo15">Documentos a Pagar.</span> &nbsp;&nbsp;
	        <input style="height:17px" type="button" id="cancelar" name="cancelar" onClick="cargar_docs()" disabled value="Agregar Doc." /></td>
	      </tr>
	    <tr bgcolor="#6699CC">
	      <td height="26" bgcolor="#004993"><span class="Estilo25"><span class="Estilo15"><?php echo $aux; ?></span></span></td>
	      <td colspan="3" bgcolor="#004993"><script>
			function enfocar_numero(e){
			
			if(e.keyCode==13){
			ceros_serie();
			document.form1.numero.select();
			}
			
			}
			
			</script>
	        <input name="cliente"  type="text" id="cliente" size="35" maxlength="75" onKeyUp="validartecla(event)" value="" /></td>
	      <td colspan="3" rowspan="5" valign="top" bgcolor="#FFFF99"><table border="2"  style="border-color:#09C">
	        <tr class="Estilo30">
	        <td width="20" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3">Td.</font>
	        <td width="54" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3">Numero</font>
            <td width="46" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3">Fecha</font>
            <td width="59" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3">Saldo</font>
            <td width="49" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3">Monto</font>
            <td width="8" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3"><?php if(isset($_REQUEST['referencia'])){echo "O";}else{echo "E";}?></font>
            <td width="0"></td>
                  </tr>
	        <tr>
	          <td height="113" colspan="7" rowspan="4" valign="top"><div id="det_doc"></div></td>
	          </tr>
	        </table></td>
	      </tr>
	    <tr>
	      <td>&nbsp;</td>
	      <td height="25">&nbsp;</td>
	      <td><span class="Estilo15">Fec. Ope.</span></td>
	      <td width="134"><span class="Estilo15">
	        <input name="fecha" type="text" id="fecha" value="<?php echo $fecha?>" size="10" maxlength="10" readonly="readonly" onChange="obtener_tc(this.value)" /> <button type="reset" id="f_trigger_b3" style="height:18; vertical-align:top" >...</button>
	                <script type="text/javascript">
					Calendar.setup({
        			inputField     :    "fecha",      
        			ifFormat       :    "%d/%m/%Y",      
        			showsTime      :    false,            
        			button         :    "f_trigger_b3",   
        			singleClick    :    true,           
        			step           :    1                
    				});
            	</script>
	        </span>
	        <input readonly="readonly" name="ruc3" type="hidden" id="ruc3" size="10" maxlength="11" /></td>
	      <td width="40"><span class="Estilo15"> T.C.</span></td>
	      <td><input name="tcact" type="text" id="tcact" value="<?php echo $_SESSION['tc'];?>" size="10" maxlength="10"></td>
	      </tr>
	    <tr>
	      <td width="5">&nbsp;</td>
	      <td width="5" height="34">&nbsp;</td>
	      <td width="102"><span class="Estilo15">Respon.</span></td>
	      <td colspan="3"><label for="textfield"></label>
	        <!--       <input readonly="readonly" name="ruc3" type="text" id="ruc3" size="10" maxlength="11" onChange="cambiardoc2()" onKeyPress="cambiardoc();" onBlur="cambiardoc3()"  onFocus="cambiardoc4()"/>-->
	        <input type="hidden" name="txtresp" id="txtresp" value="">
	        <select name="txtrespon" id="txtrespon" style="font:Verdana, Arial, Helvetica, sans-serif; font-size:10px" onChange="asignarresp(this.value)">
	          <option value="0"> Seleccione Responsable</option>
	          <?php 
				  $SQL34="Select * from usuarios";
				  $consult1=mysql_query($SQL34,$cn);
				  while($row34=mysql_fetch_array($consult1)){
			  ?>
	          <option <?php
			  $resp="";
			  if($_SESSION['nivel_usu']!="5"){
				if($row34['codigo']==$_SESSION['codvendedor']){
					echo "selected";
					$resp=$row34['codigo'];
				}
			  }
			?>
             value="<?php echo $row34['codigo']; ?>"> <?php echo $row34['usuario'];?></option>
             <?php } ?>
	          </select>
	        <?php
				if($resp!=""){
					echo "<script>document.form1.txtresponsable.disabled=true;asignarresp('".$_SESSION['codvendedor']."');</script>";
				}?></td>
	      </tr>
	    <tr>
	      <td height="27">&nbsp;</td>
	      <td>&nbsp;</td>
	      <td ><span class="Estilo15">Condici&oacute;n</span></td>
	      <td colspan="2"><select style="width:130" name="condicion" id="condicion">
	        <?php
				$StrCondi="Select * from condicion";
				$conCondi=mysql_query($StrCondi,$cn);
				while($rowcondi=mysql_fetch_array($conCondi)){
			?>
	        <option value="<?php echo $rowcondi['codigo']; ?>"><?php echo $rowcondi['nombre']; } ?></option>
	        </select></td>
	      <td><span class="Estilo15">&nbsp;</span></td>
	      </tr>
	    <tr>
	      <td>&nbsp;</td>
	      <td height="30">&nbsp;</td>
	      <td><span class="Estilo15">Conv. Saldo a:</span></td>
	      <td colspan="3"><select style="width:130" name="condicion2" id="condicion2" onChange="RecalcularSaldo()">
	        <?php
				$StrMoneda="Select * from moneda";
				$conMoneda=mysql_query($StrMoneda,$cn);
				while($rowmone=mysql_fetch_array($conMoneda)){
			?>
	        <option value="<?php echo $rowmone['id']; ?>"><?php echo strtoupper($rowmone['descripcion']."(".$rowmone['simbolo'].")"); } ?></option>
	        </select></td>
	      </tr>
	    <tr>
	      <td>&nbsp;</td>
	      <td height="19">&nbsp;</td>
	      <td align="center">&nbsp;</td>
	      <td colspan="2">&nbsp;</td>
	      <td width="135">&nbsp;</td>
	      <td colspan="2">&nbsp;</td>
	      </tr>
	    <tr>
	      <td height="58">&nbsp;</td>
	      <td>&nbsp;</td>
	      <td colspan="4" rowspan="6" valign="top"><div id="dvpagoslet" align="left"></div></td>
	      <td width="12" rowspan="3" valign="top">&nbsp;</td>
	      <td width="277" rowspan="3" valign="top"><div id="dvcancelar" align="left"></div></td>
	      </tr>
	    <tr>
	      <td height="19">&nbsp;</td>
	      <td>&nbsp;</td>
	      </tr>
	    <tr>
	      <td height="17" align="center">&nbsp;</td>
	      </tr>
	    <tr>
	      <td height="19">&nbsp;</td>
	      <td>&nbsp;</td>
	      <td colspan="2">&nbsp;</td>
	      </tr>
	    <tr>
	      <td height="19"><div id="pagos_d"></div></td>
	      <td height="19">&nbsp;</td>
	      <td height="19">&nbsp;</td>
	      <td height="19"><div id="auditoria" style="font-style:!important">&nbsp;</div></td>
	      </tr>
	    <tr>
	      <td>&nbsp;</td>
	      <td>&nbsp;</td>
	      <td colspan="2" align="left"><span class="Estilo27">&nbsp;&nbsp;&nbsp;&nbsp;</span>
	        <input style="text-align:right; font:bold" name="vuelto" type="hidden" size="7" readonly="readonly">
            <input type="hidden" name="total_gen_doc" id="total_gen_doc" value=""></td>
	      </tr>
	    <tr>
	      <td>&nbsp;</td>
	      <td>&nbsp;</td>
	      <td colspan="4" class="Estilo28"></td>
	      <td colspan="2" rowspan="3">&nbsp;</td>
	      </tr>
	    <tr>
	      <td>&nbsp;</td>
	      <td>&nbsp;</td>
	      <td>&nbsp;</td>
	      <td colspan="3">&nbsp;</td>
	      </tr>
	    <tr>
	      <td>&nbsp;</td>
	      <td>&nbsp;</td>
	      <td>&nbsp;</td>
	      <td colspan="3">&nbsp;</td>
	      </tr>
	    </table>
	  <div id="auxiliares" style="position:absolute; left:130px; top:114px; width:300px; height:180px; z-index:1; visibility:hidden; z-index:1"> </div>
	  
	    <div id="nuevo_cliente" style="position:absolute; left:110px; top:110px; width:400px; height:280px; z-index:1; visibility:hidden; z-index:1"> </div>
		
		    <div id="motivo" style="position:absolute; left:110px; top:110px; width:400px; height:280px; z-index:1; visibility:hidden; z-index:1"> </div>	
      </form>    </td>
    <td width="2" valign="top"><table width="158" height="151" border="0" cellpadding="0" cellspacing="0"  style="vertical-align:top; display:none">
      <tr valign="top">
        <td width="158" height="34" align="center" valign="top">&nbsp;</td>
      </tr>
      <!--<tr>
        <td align="center" valign="top"><input type="hidden" name="guardar" value="<a style=cursor:pointer id=abrirPop href=javascript:void(0);><img src=imgenes/anular.gif width=50 height=51 border=0></a><br>
          <span class=Estilo28>ANULAR DOCUMENTO </span>"></td>
      </tr>-->
      <tr>
        <td align="center" valign="top">&nbsp;</td>
      </tr>
      <!--<tr>
        <td align="center" valign="top"><a onClick="editar_tpago()" style="cursor:pointer"><img src="imgenes/editar_tpago.gif" width="50" height="44"></a><br>
          <span class="Estilo28">AGREGAR PAGOS [Insert]</span></td>
      </tr>-->
      <tr>
        <td align="center" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top">
		
		<a onClick="guardar()" style="cursor:pointer"><img src="imgenes/revert.png" width="35" height="35"></a>
		
		</td>
      </tr>
      <tr>
        <td align="center" valign="top"><span class="Estilo28">GUARDAR CAMBIOS [F2]<BR></span></td>
      </tr>
    </table></td>
  </tr>
</table>


</div>