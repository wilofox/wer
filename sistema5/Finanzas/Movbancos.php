<?php
session_start();
include_once('mcc/MBancos.php');
include_once('mcc/MCuentas.php');
$mba=new MBancos();
$mcu=new MCuentas();
$fechai=date('01/m/Y');
$fechaf=date('30/m/Y');
?>
<!--<link href="../styles.css" rel="stylesheet" type="text/css"> -->

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
<!--
body {
	background-color:#F3F3F3;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 00px;
	margin-bottom: 0px;
}
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 11px;
}
.Estilo8 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #FFFFFF; font-weight: bold; }
.Estilo10 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
	color: #0066CC;
}
.Estilo14 {font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color:#333333 }
.Estilo15 {font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo25 {font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #FFFFFF; }
.Estilo27 {font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #003366; }
.Estilo28 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 10px;
}
.Estilo30 {font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #990000; }

.Estilo14 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo17 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color:#FFFFFF }
.Estilo34 {font-size: 10}
.Estilo43 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
	color: #990000;
}
.Estilo46 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.Estilo47 {font-size: 10px}
.Estilo23 {font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
-->
</style>
<script language="javascript" src="miAJAXlib3.js"></script>
<script src="../jquery-1.2.6.js"></script>
<script src="../jquery.hotkeys.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<link href="../styles.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>

<script>
var tempColor="";
var temp_busqueda="";
var temp_busqueda2="";
var user_alm="<?php echo $_SESSION['user_tienda']?>";
var nivel="<?php echo $_SESSION['nivel_usu']?>";

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
function generarflujo(e){

	if(e.keyCode == 13){
		doAjax('gen_flujo.php','fecha='+document.formulario.fecha.value+'&tienda='+document.formulario.tienda.value,'gen_flujo','get','0','1','','');
	}

}

function gen_flujo(texto){
	
document.getElementById('flujo').innerHTML=texto;

doAjax('calcular_saldos.php','fecha='+document.formulario.fecha.value+'&tienda='+document.formulario.tienda.value,'calcular_saldos','get','0','1','','');

}

function calcular_saldos(texto){

var saldos=texto.split('?');
document.formulario.egreso_soles.value=saldos[0];
document.formulario.ingreso_soles.value=saldos[1];
document.formulario.saldo_final_soles.value=saldos[2];

document.formulario.egreso_dolar.value=saldos[3];
document.formulario.ingreso_dolar.value=saldos[4];
document.formulario.saldo_final_dolar.value=saldos[5];

document.formulario.saldo_inicial_soles.value=saldos[6];
document.formulario.saldo_inicial_dolares.value=saldos[7];
deshabilitar('0');
}

//function colocar(){

//	if(document.formulario.tpago.value!=1){
//		document.formulario.soles.value=document.formulario.importe2.value;
//			document.formulario.tpago2.value=1;
//	}
	
//}

function cargar_docs(auxiliar){
	var texto=auxiliar.split(',');
	var aux=texto[0];
	var tipo=texto[1];
	var fila=texto[2];

var monto=document.getElementById(fila).childNodes[6].childNodes[0].innerHTML;
var moneda=document.getElementById(fila).childNodes[4].childNodes[0].innerHTML;
var tipomov="";

alert(tipo);
if(tipo=="E"){
	tipomov='1';
}else{
	if(tipo=="I"){
		tipomov='2';
	}
}

var suc=document.formulario.tienda.value;
	
	window.open('add_docs_deuda.php?auxiliar='+aux+'&tipomov='+tipomov+'&moneda='+moneda+'&monto='+monto+'&sucursal='+suc,'ventana','width=600,height=300,top=300,left=300,scroolbars=no,directories=no,location=no,menubar=no,titlebar=no,toolbar=no,status=yes');		
		
}
var fec="";
function validarFormatoFecha(e,dato){
	if(e.keyCode == 13){
		patron = /^\d{2}\/\d{2}\/\d{4}$/
		if (!patron.test(dato.value)) {
			patron2 = /^\d{2}\-\d{2}\-\d{4}$/
			if (!patron.test(dato.value)) {
				alert('Intoduce la fecha bien:aaaa-mm-dd');
				dato.focus();
				dato.select();
				return (false);
			}else{
				alert('Intoduce la fecha tipo:aaaa-mm-dd');
			}
		}else{
			//generarflujo(e);
			///////Validacion>>>>>>>>>>>>
			fec="<?php echo gmdate('Y-m-d',time()-18000);?>";
			//alert(nivel);
			if(nivel!='5' && nivel!='4' && (dato.value!=fec)){
				alert('Caja Cerrada!!!');
			}
			cambiar_foco(2,e);
		}
	}
}

function insertar_flujo(){
var validar=true

	if(document.formulario.fecha.value==""){
		validar=false
		alert('ingrese una fecha vlida');
	}
	
	var fecha=document.formulario.fecha.value;
	var tipo=document.formulario.tipo.value;
	var auxiliar=document.formulario.auxiliar.value;
	var tcambio=document.formulario.tcambio.value;
	var numero=document.formulario.numero.value;
	var moneda=document.formulario.moneda.value;
	var tienda=document.formulario.tienda.value;
	var tpago=document.formulario.tpago.value;
	var monto=document.formulario.monto.value;
	var obs=document.formulario.obs.value;
	limpiar();
	cambiar_foco(2,event);
	if(validar){
		doAjax('gen_flujo.php','fecha='+fecha+'&tipo='+tipo+'&tcambio='+tcambio+'&numero='+numero+'&auxiliar='+auxiliar+'&moneda='+moneda+'&tienda='+tienda+'&monto='+monto+'&tpago='+tpago+'&obs='+obs+'&accion=grabar','gen_flujo','get','0','1','','');
		
	}

}

function recaudacion(mon){
	doAjax('calcular_saldos.php','fecha='+document.formulario.fecha.value+'&tienda='+document.formulario.tienda.value+'&moneda='+mon+'&recaudacion','insertar_rec','get','0','1','','');
}

function insertar_rec(texto){
	var fecha=document.formulario.fecha.value;
	var tipo="I";
	var auxiliar="VARIOS";
	var tcambio=document.formulario.tcambio.value;
	var numero="";
	var tienda=document.formulario.tienda.value;
	var obs="Recaudacion dia:"+fecha;
	var tpago=1;
	dato=texto.split("?");
	var moneda=dato[0];
	var monto=dato[1];
	//alert(texto);
	if(monto==undefined){
		if(moneda=='disabled'){
			alert("Ya ingreso este Movimiento de Cobranzas");
			return false;
		}
		alert("No hay Movimientos de Cobranzas en "+moneda);
	}else{
		doAjax('gen_flujo.php','fecha='+fecha+'&tipo='+tipo+'&tcambio='+tcambio+'&numero='+numero+'&auxiliar='+auxiliar+'&moneda='+moneda+'&tienda='+tienda+'&monto='+monto+'&tpago='+tpago+'&obs='+obs+'&accion=grabar','gen_flujo','get','0','1','','');
	}
	//doAjax('gen_flujo.php','fecha='+fecha+'&tipo='+tipo+'&tcambio='+tcambio+'&numero='+numero+'&auxiliar='+auxiliar+'&moneda='+moneda+'&tienda='+tienda+'&monto='+monto+'&tpago='+tpago+'&obs='+obs+'&accion=grabar','gen_flujo','get','0','1','','');
}

function eliminar(cod,tienda){
	if(nivel=='5' || nivel=='4' || fec==document.formulario.fecha.value){
		doAjax('gen_flujo.php','id='+cod+'&accion=eliminar&fecha='+document.formulario.fecha.value+'&tienda='+tienda,'gen_flujo','get','0','1','','');
	}else{
		alert("No se permite eliminar en Caja Cerrada");
	}
}

function cambiar_foco(item,e){
if (e.keyCode != 13){
	if(item==1){
		if(document.formulario.tienda.value=='-1'){
			alert('debe seleccionar un almacen');
			document.formulario.tienda.focus();
			document.formulario.tienda.select();
		}else{
			//alert(document.formulario.tienda.displayValue);
			var x=document.getElementById("tienda").selectedIndex;
			var y=document.getElementById("tienda").options;
			//alert((y[x].text).substr(15,25));
			document.getElementById('descue').value=(y[x].text).substr(15,25); //document.formulario.tienda.displayValue;
			document.formulario.fecha.focus();
			document.formulario.fecha.select();
		}
	}
	if(item==3){
		document.formulario.tcambio.focus();
		document.formulario.tcambio.select();
		if(document.formulario.tipo.value=='E'){
			document.formulario.tipomov.value='1';
		}else{
			document.formulario.tipomov.value='2';
		}
		habilitar_det('2');
	}
	if(item==8){
		deshabilitar('4');
		document.formulario.monto.focus();
		document.formulario.monto.select();
	}
	if(item==5){
		deshabilitar('3');
		document.formulario.numero.focus();
		document.formulario.numero.select();
	}}else{
		if(item==2){
			//alert(
			if(document.formulario.tienda.value=='-1'){
				alert('debe seleccionar un almacen');
				//habilitar_det('error');		
				document.formulario.tienda.focus();
				//document.formulario.tienda.select();
			}else{
				if(nivel=='5' || fec==document.formulario.fecha.value){
					habilitar_det('1');
					document.formulario.tipo.focus();
				}
				generarflujo(e);
				//document.formulario.tipo.select();
			}
			//habilitar_det('error2');
		}
		if(item==4){
			document.formulario.tpago.focus();
		}
		if(item==6){
			document.formulario.auxiliar.focus();
			document.formulario.auxiliar.select();
		}
		if(item==7){
			document.formulario.moneda.focus();
		}
		if(item==9){
			insertar_flujo();
		}
	}
}

function habilitar_det(te){
	//alert(te);
	switch(te){
		case '0':
		document.getElementById('det_cab').style.display='none';
		document.getElementById('det').style.display='none';break;
		case '1':
		document.getElementById('det_cab').style.display='block';
		document.getElementById('det').style.display='block';break;
		case '2':deshabilitar(te);break;
	}
}

function iniciar(){
	limpiar();
	//alert(user_alm);
	//if(user_alm=="0"){
		document.formulario.tienda.disabled=false;
		document.formulario.tienda.focus();
	/*}else{
		document.formulario.tienda.disabled=true;
		document.formulario.fecha.focus();
		document.formulario.fecha.select();
	}*/
	document.formulario.fecha.disabled=false;
	//deshabilitar('1');
	habilitar_det('0');
}
	
function limpiar(){
	document.formulario.tipo.value="-1";
	document.formulario.tpago.value="-1";
	document.formulario.moneda.value="-1";
	document.formulario.numero.value='';
	document.formulario.auxiliar.value='';
	document.formulario.monto.value='';
	document.formulario.obs.value='';
	deshabilitar('1');
}
	
function deshabilitar(fp){
	//alert(fp);
	switch(fp){
		case '0':
		document.formulario.tienda.disabled=true;
		document.formulario.fecha.disabled=true;break;
		case '1':
		document.formulario.tpago.disabled=true;
		document.formulario.moneda.disabled=true;
		document.formulario.numero.disabled=true;
		document.formulario.auxiliar.disabled=true;
		document.formulario.monto.disabled=true;
		document.formulario.obs.disabled=true;break;
		case '2':
		document.formulario.tpago.disabled=false;break;
		case '3':
		document.formulario.moneda.disabled=false;
		document.formulario.numero.disabled=false;
		document.formulario.auxiliar.disabled=false;
		document.formulario.obs.disabled=false;break;
		case '4':
		document.formulario.monto.disabled=false;break;
	}
/*	document.formulario.tienda.disabled=true;
	document.formulario.fecha.disabled=true;*/
}
function salir(){
	if(confirm("Esta seguro que desea salir...")){
		document.formulario.submit();					
	}else{
	
	}
}

function insertar_recaudacion(){
	document.formulario.tipo.value="I";
	document.formulario.tpago.value="1";
	document.formulario.numero.value="";
	document.formulario.auxiliar.value="";
	document.formulario.moneda.value="01";
}

function amarrar_docs(c,cib){
	var texto=c.split(',');
	for(var j=0;j<cib;j++){
		var aux='texto['+j+']';
	}
		var tipo=texto[1];
}


jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_esc').addClass('dirty'); 
if(document.getElementById('auxiliares').style.visibility!='visible'){
	salir();
}else{
	document.getElementById('auxiliares').style.visibility='hidden';
}
return false; });


function validartecla(e,valor,temp){
	if(valor.value.length<3){
		return false;
	}
	var tipomov=document.formulario.tipomov.value;
	/*if(document.formulario.tipo.value=="I"){
		tipomov='2'
	}else{
		tipomov='1'
	}*/
	
	document.formulario.tempauxprod.value=temp;
	
		if(document.getElementById('auxiliares').style.visibility=='visible'){
		temp_busqueda2=document.formulario.busqueda2.value;
		}
	
	if ( ( (e.keyCode>=96) && (e.keyCode<=105) || (e.keyCode>=48) && (e.keyCode<=57) )  || ((e.keyCode>=65) && (e.keyCode<=90)) || e.keyCode==8 || e.keyCode==32 ) {
		if(document.getElementById(temp).style.visibility!='visible' ){
			doAjax('../compras/lista_aux.php','&temp='+temp+'&tipomov='+tipomov+'&modulo=cajach','listaprod','get','0','1','','');
		}else{
			var valor="";
			var temp_criterio=temp_busqueda;
			if(document.formulario.tempauxprod.value=='auxiliares'){
			valor=document.formulario.auxiliar.value;
			temp_criterio=temp_busqueda2;
			}
		
			var temp=document.formulario.tempauxprod.value;
			var tipomov=document.formulario.tipomov.value;
			var tienda=document.formulario.tienda.value;
			
		var estSP='V';
	doAjax('../compras/det_aux.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc='+document.formulario.prov_asoc.value+'&moneda_doc='+'1','detalle_prod','get','0','1','','');
		}	
	}
}


function listaprod(texto){
	var r = texto;
	var valor="";
	var temp_criterio='';
	
	if(document.formulario.tempauxprod.value=='auxiliares'){
	document.getElementById('auxiliares').innerHTML=r;
	document.getElementById('auxiliares').style.visibility='visible';
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
	var tienda=document.formulario.tienda.value;
	
	var estSP='V';
	doAjax('../compras/det_aux.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc='+document.formulario.prov_asoc.value+'&moneda_doc='+'1','detalle_prod','get','0','1','','');	
}		

//function entrada(objeto){
/*	//objeto.cells[0].childNodes[0].checked=true;
	//temp=objeto;
		if(objeto.style.background=='url(../imagenes/sky_blue_sel.png)'){
	//objeto.style.background=objeto.bgColor;
		}else{
		objeto.style.background='url(../imagenes/sky_blue_sel.png)';
			if(temp2!=''){
			//alert(temp.style.background);
			//alert(objeto.bgColor);
			temp2.style.background=temp2.bgColor;
			}
			temp2=objeto;
		}*/
	/*if(tempColor=="" && document.getElementById('auxiliares').style.visibility=='visible'){
	tempColor=document.getElementById('tblproductos1').rows[0];
	document.getElementById('tblproductos1').rows[0].style.background='';
	}
	if(tempColor==""){
	tempColor=document.getElementById('tblproductos').rows[0];
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
	
}*/

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
}


function selec_busq(){
	
	 var valor1=temp_busqueda;
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
 
     var i;
	 for (i=0;i<document.formulario.busqueda2.options.length;i++)
        {
		
            if (document.formulario.busqueda2.options[i].value==valor1)
               {
			   document.formulario.busqueda2.options[i].selected=true;
               }
        
        }
	
	}


jQuery(document).bind('keyup', 'up',function (evt){jQuery('#_up').addClass('dirty');
	if(document.getElementById('productos').style.visibility=='visible'){
	
	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
		if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb' && (i!=0) ){
		document.getElementById('tblproductos').rows[i].style.background=document.getElementById('tblproductos').rows[i].bgColor;
		document.getElementById('tblproductos').rows[i-1].style.background='#FFF1BB';
			
			tempColor=document.getElementById('tblproductos').rows[i-1];
			
			location.href="#ancla"+(i-1);
			document.formulario.codprod.focus();
			
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


jQuery(document).bind('keyup', 'return',function (evt){jQuery('#_return').addClass('dirty'); 
		
			var nombreVariable=document.getElementById('MB_frame');
			try {
				 if (typeof(eval(nombreVariable)) != 'undefined' ){
					 if (eval(nombreVariable) != null){
					return false();
					}
				}
			 } catch(e) { }
			
	   if(document.getElementById('auxiliares').style.visibility=='visible'){

		for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
			if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb'){
			
				var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
				var temp1=document.getElementById('tblproductos1').rows[i].cells[1].childNodes[0].innerHTML;
				var ruc=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[0].innerHTML;

			}
		}
		elegir2(temp,temp1);
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
			document.formulario.codprod.focus();
			}
			
			break;
				
			}
		}
 	}
	
	if(document.getElementById('auxiliares').style.visibility=='visible'){
	for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
			
			if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' && (i!=document.getElementById('tblproductos1').rows.length-1)){
			document.getElementById('tblproductos1').rows[i].style.background=document.getElementById('tblproductos1').rows[i].bgColor;
			document.getElementById('tblproductos1').rows[i+1].style.background='#FFF1BB';
			
			tempColor=document.getElementById('tblproductos1').rows[i+1];
			
			if(i%4==0 && i!=0){
			
			location.href="#ancla"+i;
			document.formulario.auxiliar.focus();
			}
			
			break;
				
			}
		}
 	}
	
	
 return false; });


function elegir2(cod,des){
	document.formulario.auxiliar.value=cod; //des;
	document.formulario.auxiliar2.value=cod;
	document.getElementById('auxiliares').style.visibility='hidden';
	cambiar_foco(7,'return');
}
function ver_new_aux(){
	
	if(document.getElementById('auxiliares').style.visibility=='visible'){
		document.getElementById('auxiliares').style.visibility='hidden';
	//	mostrar_cbos()
		document.getElementById('new_aux').style.visibility='visible';
		document.formulario.aux_dni.focus();
	}
}
function cancel_nuevo_aux(){
	document.getElementById('auxiliares').style.visibility='visible';
	//mostrar_cbos();
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

	var correo=document.formulario.correo_auxi.value;
	var telefono=document.formulario.tel_auxi.value;
	
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
		
	if(persona=='juridica'){
		if(ruc.substring(0,2)!='10' &&  ruc.substring(0,2)!='20'){
			alert('Ingrese un numero de ruc vlido');
			document.formulario.aux_ruc.select();
			document.formulario.aux_ruc.focus();
			return false;
		}
		if(ruc=="" || ruc.length!=11){
			alert('Ingrese un numero de ruc vlido');
			document.formulario.aux_ruc.select();
			document.formulario.aux_ruc.focus();
			return false;
		}		
	}

	if( (doc=="F1" || doc=="FA") && (ruc=="" || ruc.length!=11) ){
		alert('Ingrese un numero de ruc vlido');
		document.formulario.aux_ruc.focus();
		return false;
	}else{
		razon=razon.replace('&','amps');//)('&','/&#38;/')
	
		doAjax('pedir_dato.php','&ruc='+ruc+'&dni='+dni+'&razon='+razon+'&contacto='+contacto+'&cargo='+cargo+'&direccion='+direccion+'&persona='+persona+'&tipo_aux='+tipo_aux+'&telefono='+telefono+'&correo='+correo+'&peticion=save_aux','rspta_aux','get','0','1','','');
	}
}
function rspta_aux(texto){
	var ruc=document.formulario.aux_ruc.value;
	var dni=document.formulario.aux_dni.value;
	
	var temp=texto.split('?');
	if(temp[2]>0){
		if(ruc!=''){
			alert("El ruc ingresado ya existe");
			document.formulario.aux_ruc.select();
			document.formulario.aux_ruc.focus();
	  	}else{
			alert("El dni ingresado ya existe");
			document.formulario.aux_dni.select();
			document.formulario.aux_dni.focus();
		}
		return false;
	}
	elegir2(temp[0],temp[1])
	document.getElementById('new_aux').style.visibility='hidden';			
}
</script>
</head>
<body onLoad="iniciar()">
<form id="formulario" name="formulario" method="post" action="">
<input name="tempauxprod"  type="hidden" value="auxiliares" size="15" />
<input name="codprod"  type="hidden" value="" size="15" />
<input name="termino"  type="hidden" value="" size="15" />
<input name="cantidad"  type="hidden" value="" size="15" />
<input name="sucursal"  type="hidden" value="" size="15" />
<input name="prov_asoc"  type="hidden" value="" size="15" />
<input name="auxiliar2"  type="hidden" value="" size="15" />
<input name="tipomov"  type="hidden" value="" size="15" />
  <table width="" height="" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="" height="19">&nbsp;</td>
      <td width=""></td>
      <td width="" rowspan="3" valign="top">&nbsp;</td>
      <td width="">&nbsp;</td>
    </tr>
    <tr>
      <td height="203">&nbsp;</td>
      <td valign="top"><table width="771" height="444" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="11"><table border="0">
            <tr>
              <td colspan="2"><span class="Estilo43">MOVIMIENTO DE BANCOS</span></td>
              <td width="377" rowspan="8">	  <table width="377" height="213" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" align="left">
                <tr>
                  <td width="373"><table width="309" height="193" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="41" colspan="3"><span class="Estilo43">SALDO DISPONIBLE </span></td>
                      </tr>
                    <tr bgcolor="#CCCCCC">
                      <td height="26" colspan="3" align="center"><span class="Estilo46">Dinero en Efectivo </span></td>
                      </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="center"><span class="Estilo46">Soles</span></td>
                      <td align="center"><span class="Estilo46">Dolares</span></td>
                      </tr>
                    <tr>
                      <td width="31%"><span class="Estilo14">Saldo Inicial </span></td>
                      <td width="32%" align="center"><input style="text-align:right" name="saldo_inicial_soles" type="text" size="8" maxlength="10" value="0.00" /></td>
                      <td width="37%" align="center"><input style="text-align:right" name="saldo_inicial_dolares" type="text" size="8" maxlength="10" value="0.00" /></td>
                      </tr>
                    <tr>
                      <td><span class="Estilo14">Ingresos </span></td>
                      <td align="center"><input style="text-align:right" name="ingreso_soles" type="text" size="8" maxlength="10" /></td>
                      <td align="center"><input style="text-align:right" name="ingreso_dolar" type="text" size="8" maxlength="10" /></td>
                      </tr>
                    <tr>
                      <td><span class="Estilo14">Egresos</span></td>
                      <td align="center"><input style="text-align:right" name="egreso_soles" type="text" size="8" maxlength="10" /></td>
                      <td align="center"><input style="text-align:right" name="egreso_dolar" type="text" size="8" maxlength="10" /></td>
                      </tr>
                    <tr>
                      <td><span class="Estilo14">Saldo Final </span></td>
                      <td align="center"><input style="text-align:right" name="saldo_final_soles" type="text" size="8" maxlength="10" /></td>
                      <td align="center"><input style="text-align:right" name="saldo_final_dolar" type="text" size="8" maxlength="10" /></td>
                      </tr>
                    <tr>
                      <td><span class="Estilo34"></span></td>
                      <td><span class="Estilo34"></span></td>
                      <td><span class="Estilo34"></span></td>
                      </tr>
                    </table></td>
                  </tr>
                </table>                
                <br><br><br><br><br><br><br></tr>
        <tr>
          <td width="73" height="2" valign="middle">&nbsp;</td>
          <td width="307">&nbsp;</td>
        </tr>
        <tr>
          <td width="73" height="7" valign="middle">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="73" height="15" valign="middle"><span class="Estilo46">Banco</span></td>
          <td><select name="tienda" style="font:Verdana, Arial, Helvetica, sans-serif; font-size:10px; width:100px" onChange="cambiar_foco(1,event)">
            <option value="-1">Seleccione el Banco</option>
            <?php 
			$mcu->sucursal="s";
			$mcu->banco="s";
			$lista=$mcu->Listarcue();
		    for($i=0;$i<count($lista);$i++){
				?>
            <option value="<?php echo $lista[$i]['cta_id'];?>"><?php echo str_pad($lista[$i]['banco'],15," ",STR_PAD_RIGHT).str_pad($lista[$i]['ctabco'],25," ",STR_PAD_RIGHT).str_pad($lista[$i]['moneda'],5," ",STR_PAD_RIGHT);?></option>
            <?php }?>
          </select><input type="text" name="descue" id="descue" value="" disabled></td>
        </tr>
        <tr>
          <td width="73" height="21" valign="middle">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="28" valign="middle"><span class="Estilo46">Fecha</span></td>
          <td><span class="Estilo15">
            <input style="background: #FFE9D2" name="fecha" type="text" size="10" maxlength="10" onKeyPress="validarFormatoFecha(event,this)" value="<?php echo $fechai; ?>" >
            <button type="reset" id="f_trigger_b1" style="height:18; vertical-align:bottom" >...</button>
				<script type="text/javascript">
					Calendar.setup({
        			inputField     :    "fecha",      
        			ifFormat       :    "%d/%m/%Y",      
        			showsTime      :    false,            
        			button         :    "f_trigger_b1",   
        			singleClick    :    true,           
        			step           :    1                
    				});
            	</script>
				<span class="Estilo47">(dd-mm-aaaa)</span></span>
            <input style="background: #FFE9D2" name="fechaf" type="text" size="10" maxlength="10" onKeyPress="validarFormatoFecha(event,this)" value="<?php echo $fechaf; ?>" >
            <button type="reset" id="f_trigger_b2" style="height:18; vertical-align:bottom" >...</button>
				<script type="text/javascript">
					Calendar.setup({
        			inputField     :    "fechaf",      
        			ifFormat       :    "%d/%m/%Y",      
        			showsTime      :    false,            
        			button         :    "f_trigger_b2",   
        			singleClick    :    true,           
        			step           :    1                
    				});
            	</script>
				<span class="Estilo47">(dd-mm-aaaa)</span></span></td>
        </tr>
        <tr>
          <td valign="middle">&nbsp;</td>
          <td>&nbsp;</td>
          </tr>
            </table>
        <tr id="det_cab" bgcolor="#004993">
        <td width="2"></td>
          <td width="47" align="center" bgcolor="#D8D8D8"><span class="Estilo14">Tipo</span></td>
          <td align="center" bgcolor="#D8D8D8"><span class="Estilo14">T.C.</span></td>
          <td align="center" bgcolor="#D8D8D8"><span class="Estilo14">Forma de Pago</span></td>
          <td align="center" bgcolor="#D8D8D8"><span class="Estilo14">Numero</span></td>
          <td width="155" align="center" bgcolor="#D8D8D8"><span class="Estilo14">Cliente/Prov.</span></td>
          <td align="center" bgcolor="#D8D8D8"><span class="Estilo14">Moneda</span></td>
          <td align="center" bgcolor="#D8D8D8"><span class="Estilo14">Monto</span></td>
          <td bgcolor="#D8D8D8"><span class="Estilo14">Obs:</span></td>
          <td colspan="2">&nbsp;</td>
          </tr>
        <tr id="det" bgcolor="#004993">
        <td></td>
          <td align="center"><span class="Estilo23">
            <select name="tipo" title="I - Ingreso      E - Egreso" onChange="cambiar_foco(3,event)" style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px" onFocus="deshabilitar('0')">
              <option value="-1">-</option>
              <option value="I">I</option>
              <option value="E">E</option>
            </select>
          </span></td>
          <td width="44" align="center"><span class="Estilo23">
		  <input name="tcambio" id="tcambio" type="text" style="font-size:12px" size="6" maxlength="6" value='<?php echo number_format($tc,3)?>' onKeyUp="cambiar_foco(4,event)"></span>
          </td>
          <td width="132" align="center"><select name="tpago" style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px;" onChange="cambiar_foco(5,event)">
          <option value="-1">---------------</option>
            <? 
			// onFocus="enfocar_tpago()"  onChange="colocar();"
		    $resultados12 = mysql_query("SELECT * FROM t_pago order by id ",$cn); 
			while($row12=mysql_fetch_array($resultados12)){
		  ?>
            <option value="<? echo $row12['id'];?>"><? echo $row12['descripcion'];?></option>
              <? }?>
            </select></td>
          <td width="80" align="center"><input name="numero" style="font-size:12px" type="text" size="10" maxlength="10" onKeyUp="cambiar_foco(6,event)" /></td>
          <td align="center"><span class="Estilo15">
            <input autocomplete="off" name="auxiliar" type="text" style="font-size:12px" size="18" maxlength="50" onKeyUp="validartecla(event,this,'auxiliares')">
			<?php //validartecla(event,this,'auxiliares') ?>
           </span></td>
          <td width="124" align="center"><span class="Estilo14">
            <select name="moneda" style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px" onChange="cambiar_foco(8,event)">
              <option value="-1">--Seleccione--</option>
              <option value="01">Soles(S/.)</option>
              <option value="02">Dolares(US$.)</option>
            </select>
          </span></td>
          <td width="86" align="center"><span class="Estilo14">
            <input name="monto" type="text" size="10" maxlength="10" style="font-size:12px; vertical-align:top" onKeyUp="cambiar_foco(9,event)" />
          </span></td>
          <td width="97" align="center"><textarea name="obs" id="obs" style="font-size:11px" cols="16"></textarea></td>
          <td colspan="2">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td colspan="2"><div id="new_aux" style="position:absolute; left:65px; top:128px; width:300px; height:180px; z-index:2; visibility:hidden">
<!--  ; visibility:hidden-->
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
        <td colspan="2">&nbsp;</td>
      </tr>
      
      <tr>
        <td colspan="5" height="10"></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td width="62" align="center"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">T. pers.</span>: </td>
        <td colspan="2"><input name="persona" type="radio" value="J" style="border:none; background:none" onClick="validarNewClie(this)" />
          <span style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold; color:#0066FF">Juridica.</span>
          <input style="border:none; background:none" checked="checked" name="persona" type="radio" value="N" onClick="validarNewClie(this)" />
  <span style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold; color:#0066FF">Natural.</span></td>
        <td width="127">&nbsp;</td>
      </tr>
      <tr>
        <td height="20">&nbsp;&nbsp;</td>
        <td align="center"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Ruc</span></td>
        <td width="159"><input name="aux_ruc" type="text" size="17" maxlength="11"  disabled="disabled" /></td>
        <td colspan="2"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Dni/CE</span>
          <input name="aux_dni" type="text" size="15" maxlength="8" />
		  <script>
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
        <td align="center" style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Cli./Razon</td>
        <td colspan="3"><input name="aux_razon" type="text" size="42" maxlength="100" /></td>
        </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td align="center"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">Contacto</span></td>
        <td><input name="aux_contacto" type="text" size="25" maxlength="100" /></td>
        <td width="45"><span style="font-size: 10px; color: #333333">Telefono</span></td>
        <td><input type="text" name="tel_auxi" id="tel_auxi" value=""></td>
        </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td align="center"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Cargo</span></td>
        <td><input type="text" name="aux_cargo" /></td>
        <td><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Correo</span></td>
        <td><input type="text" name="correo_auxi" id="correo_auxi" value=""></td>
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

  </div></td>
          <td align="right">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2"><span class="Estilo14">
            <input type="button" name="r_soles" onClick="recaudacion(1)" value="Recaudacion Soles">
          </span></td>
          <td colspan="2">&nbsp;</td>
          <td colspan="2"><input type="hidden" name="Submit" value="Aceptar" onClick="insertar_flujo()" />
            <input type="button" name="r_dolar" onClick="recaudacion(2)" value="Recaudacion Dolares"></td>
          <td width="4" align="right">&nbsp;</td>
        </tr>
        <tr>
          <td height="106" colspan="10"><div  id="flujo"></div></td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
      <td valign="top" align="center">
	  
</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <div id="auxiliares" style="position:absolute; left:319px; top:289px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>
  <div id="productos" style="position:absolute; left:274px; top:139px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>
</form>
</body>
</html>
