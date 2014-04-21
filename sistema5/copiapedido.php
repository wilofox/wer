<?php session_start();
//echo "pedido";
include('conex_inicial.php');
 $_SESSION['registro']=rand(100000,999999);
  	unset($_SESSION['productos']);
	unset($_SESSION['productos2']);
	unset($_SESSION['productos3']);
 // print_r($_SESSION['productos']);
// echo $_SESSION['registro'];

$strSQL="select * from operacion where codigo='FA'";
$resultado=mysql_query($strSQL,$cn);
$row=mysql_fetch_array($resultado);
$impto_venta=$row['imp1']/100;
$p1=substr($row['p1'],0,1);

$strSQL="select * from operacion where codigo='PF'";
$resultado=mysql_query($strSQL,$cn);
$row=mysql_fetch_array($resultado);
$impto_prof=$row['imp1']/100;

//$p1="N";
$tmoneda='01';
$inciar_imp='incluido';

$strSQLC="select * from cierre where substring(fecha,1,10)='".date('Y-m-d')."' and caja='".$_SESSION['cod_caja']."' ";
$resultadoC=mysql_query($strSQLC,$cn);
$rowCierre=mysql_num_rows($resultadoC);

?>

<script>
var p1="<?php echo $p1?>";
var temp="<?php echo $_REQUEST['caducado']?>";
var temp_mon="02";
var temp2="";
var impto_venta="<?php echo $impto_venta?>";
var impto_prof="<?php echo $impto_prof?>";

var tempSucursal="<?php echo $_SESSION['user_sucursal']?>";
var tempTienda="<?php echo $_SESSION['user_tienda']?>";
var datos="";

if(temp=="s"){
window.parent.location.href="index.php";
}

var tc_doc="<?php echo $tcambio; ?>";
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
.Estilo14 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.Estilo15 {
	font-family:Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	color:#990000;
}
.Estilo31 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FFFFFF; }
.Estilo32 {color: #FFFFFF}
.Estilo34 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #000000; }
.Estilo44 {color: #EB1F01}
.Estilo45 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
.Estilo47 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #333333; }
.Estilo48 {font-size: 10px}
.Estilo112 {color: #000000}
.Estilo_det{font:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#333333}
-->
</style>
</head>
<script language="javascript" src="miAJAXlib.js"></script>
<!--<script language="javascript" src="jquery[1].hotkeys-0.7.7-packed.js"></script>-->

    <script src="jquery-1.2.6.js"></script>
    <script src="jquery.hotkeys.js"></script>
<!--	<script src="mootools-comprimido-1.11.js"></script> -->
<!--	<script src="modal.js"></script> -->

	<script type="text/javascript" src="modalbox/lib/prototype.js"></script>
	<script type="text/javascript" src="modalbox/lib/scriptaculous.js?load=effects"></script>
	
	<script type="text/javascript" src="modalbox/modalbox.js"></script>
	<link rel="stylesheet" href="modalbox/modalbox.css" type="text/css" />
	
<?php 
$fecha=date("d-m-Y");

?>

<script>
 jQuery(document).bind('keydown', 'f5',function (evt){jQuery('#_up').addClass('dirty');
//	alert('f5');
	var tecla=window.event.keyCode;
  if (tecla==116) {//alert("F5 deshabilitado!")
  event.keyCode=0;
event.returnValue=false;}
return false; });

/*
jQuery(document).bind('keydown', 'f2',function (evt){jQuery('#_up').addClass('dirty');
return false; });
*/
var tempColor="";

jQuery(document).bind('keydown', 'up',function (evt){jQuery('#_up').addClass('dirty');
 //alert('ee');
	//document.getElementById('TablaDatos').rows[0].style.background='#FFCC00';
	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
//	alert(document.getElementById('tblproductos').rows.length);
		if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb' && (i!=0) ){
		document.getElementById('tblproductos').rows[i].style.background=document.getElementById('tblproductos').rows[i].bgColor;
		document.getElementById('tblproductos').rows[i-1].style.background='#fff1bb';
		
		tempColor=document.getElementById('tblproductos').rows[i-1];
		
		location.href="#ancla"+(i-1);
		document.formulario.codprod.focus();
		
		if(i%3==0 && i!=0){
		//capa_desplazar = $('detalle');
		//capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y - 50);
		}
		break;
		}
	}
 return false; });


jQuery(document).bind('keydown', 'f8',function (evt){jQuery('#_f8').addClass('dirty');

 //alert();
	func_f8();	

	 return false; });

   jQuery('#platform-details').html('<code>' + navigator.userAgent + '</code>');
function domo(){


jQuery(document).bind('keyup', 'down',function (evt){jQuery('#_down').addClass('dirty');
 
// alert('entro');
//if(document.getElementById('productos').style.visibility=='visible'){

	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
		
	//	alert(document.getElementById('tblproductos').rows.length);
		if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb' && (i!=document.getElementById('tblproductos').rows.length-1)){
		//alert(document.getElementById('TablaDatos').rows[i].style.background);
		document.getElementById('tblproductos').rows[i].style.background=document.getElementById('tblproductos').rows[i].bgColor;
		document.getElementById('tblproductos').rows[i+1].style.background='#fff1bb';
		tempColor=document.getElementById('tblproductos').rows[i+1];
		
		if(i%4==0 && i!=0){
		
			location.href="#ancla"+i;
			document.formulario.codprod.focus();
		//capa_desplazar = $('detalle');
		//capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y + 50);
		}
		
		break;
			
		}
		
		
		
	}
	
//}	
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

	if(document.getElementById('productos').style.visibility=='visible'){
		for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
			if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb'){
			
				var temp=document.getElementById('tblproductos').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
				var cadena=document.getElementById('tblproductos').rows[i].cells[3].innerHTML;
		
		//elegir(temp);
		
				var temp1=document.getElementById('tblproductos').rows[i].cells[1].childNodes[0].innerHTML;
		
				var temp_prod=document.getElementById('tblproductos').rows[i].cells[4].innerHTML.split("-");
				var temp4=document.getElementById('tblproductos').rows[i].cells[4].innerHTML;
        		var unidad=temp4.split("-");
		
				document.formulario.series.value=unidad[4];
  		
				var total_precio="";	
				var precio=parseFloat(temp_prod[2]);
				var prod_moneda=parseFloat(temp_prod[3]);
			
				total_precio=precio;
			//alert(total_precio);
				if(prod_moneda==01 && document.getElementById('moneda').innerHTML=='(US$.)'){
			
					total_precio=parseFloat(total_precio/tc_doc).toFixed(4);
				}else{
			//alert();
					if(prod_moneda==02 && document.getElementById('moneda').innerHTML=='(S/.)'){
				//alert();
						total_precio=parseFloat(total_precio*tc_doc).toFixed(4);
					}
			
				}


	   			document.formulario.uni_p.value=unidad[0];
	   			document.formulario.factor_p.value=unidad[1];
	   			document.formulario.precio_p.value=unidad[2];
				document.formulario.serie_ing.value="";	
		//alert(temp_prod[3]);			
				document.formulario.punit.value=total_precio;
				document.formulario.prod_moneda.value=temp_prod[3];
				document.formulario.unidad.value=temp_prod[2];
				document.formulario.precio_prod.value=precio;
				document.formulario.saldo.value=cadena;
		
				document.formulario.codBarraEnc.value=temp_prod[13];
	   			var tempDes=temp1.split("|");
	   			elegir(temp,tempDes[1].substring(8,tempDes[1].length));
		//elegir(temp);
		
			}
		}
		
	}else{

//alert();

		if(document.formulario.suc.value==1){

			document.formulario.almacen.focus();
			document.formulario.alm.value=1;
			document.formulario.suc.value=0;
		}else{

			if(document.formulario.alm.value==1){
				document.formulario.responsable.focus();
				document.formulario.res.value=1;
				document.formulario.alm.value=0;
			}else{
	
				if(document.formulario.res.value==1){
					document.formulario.codprod.focus();
					document.formulario.pro.value=1
					document.formulario.res.value=0;
				}else{
		
					if(document.formulario.pro.value==1){
			//alert(1);
						document.formulario.cantidad.focus();
						document.formulario.pro.value=0;
			//document.formulario.termino.select();
			//document.formulario.ter.value=1
			//document.formulario.pro.value=0;
			//}else{
				/*if(document.formulario.ter.value==1){
				document.formulario.cantidad.focus();
				document.formulario.ter.value=0;			*/
					}else{
				
				
				
						if(document.formulario.cantidad.value!="" && document.formulario.codprod.value!=""){
					
							var cant=document.formulario.cantidad.value;
							var saldo=document.formulario.saldo.value;
							var tipo_venta=document.formulario.tipodoc.value;
							
					//Cantidad de sub unidad
							if (document.formulario.cantSubUnidad.value>0){
								saldo=document.formulario.cantSubUnidad.value;
							}
									
							if(parseFloat(saldo) >= parseFloat(cant) || p1=='N' ){
								var cant=document.formulario.cantidad.value;
								var randomnumber=Math.floor(Math.random()*99999);
								var producto=document.formulario.codprod.value;
								var tienda=document.formulario.almacen.value;
								var series=document.formulario.series.value;
								
								if(tipo_venta=='V' && series=='S' && document.formulario.serie_ing.value==""){
															
									Modalbox.show('compras/sal_series.php?cant='+cant+'&ran='+randomnumber+'&producto='+producto+'&tienda='+tienda+'&ptoventa', {title: 'Serie de productos ( SALIDAS )', width: 500});return false;
								}
						
								enviar(event);
							}else{
						
								alert("Producto sin Stock ... \n Stock Disponible: "+saldo);	
								document.formulario.cantidad.value="";
								document.formulario.codprod.value="";
								document.formulario.precio.value="";
								document.formulario.codprod.select();
																
							}
						}else{
							if((document.formulario.termino.value!="" || document.formulario.termino.value==" ") && document.formulario.codprod.value==""){
							//alert("texto");
							enviar(event);
							}else{
							alert("ingrese una cantidad valida");
							}
							
						}
						
					}
				}
			}
		}
	}
return false; });




jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_esc').addClass('dirty'); 

salir();
return false; });

jQuery(document).bind('keydown', 'f2',function (evt){jQuery('#_f7').addClass('dirty');
	GuardarT();
 return false; }); 

function GuardarT(){
	 var codigo='<?php echo $_SESSION['registro']?>';
		if(document.formulario.tipodoc.value=='P'){
			var randomnumber=Math.floor(Math.random()*99999);
			Modalbox.show('lista_auxiliar.php?ran='+randomnumber+'&buton=grabar_doc', {title: 'Lista de Auxiliares( CLIENTES )', width: 500});	
			
		}else{
		
		//if(document.formulario.temp_tot_det.value!=0){
		
		var total_doc=document.formulario.total_doc.value;
		var tmoneda=document.formulario.tmoneda.value;
		var tcambio=document.formulario.tcambio_ptoventa.value;
		var sucursal=document.formulario.sucursal.value;
		var tienda=document.formulario.almacen.value;
		var responsable=document.formulario.responsable.value;
		var incluidoigv=document.formulario.incluidoigv.value;
		var impto=document.formulario.impto.value;
		var impuesto1=document.formulario.impuesto1.value;
		var baseimp=document.formulario.monto.value;
		
//		var datos = window.open("empresa.php?total_doc="+total_doc+'&moneda_doc='+tmoneda+'&tcambio_doc='+tcambio+'&sucursal='+sucursal+'&tienda='+tienda+'&responsable='+responsable+'&incluidoigv='+incluidoigv+'&impto='+impto+'&impuesto1='+impuesto1+'&baseimp='+baseimp,"","dialogWidth:600px;dialogHeight:530px,top=180,left=200,status=yes,scrollbars=yes");
	
		if(!isset(datos)){		
		datos = window.open("empresa2.php?total_doc="+total_doc+'&moneda_doc='+tmoneda+'&tcambio_doc='+tcambio+'&sucursal='+sucursal+'&tienda='+tienda+'&responsable='+responsable+'&incluidoigv='+incluidoigv+'&impto='+impto+'&impuesto1='+impuesto1+'&baseimp='+baseimp,"ventana","width=600px height=400px,top=180,left=200,status=yes,scrollbars=yes");
		
		//heigth 530px
		}else{
		datos.focus();
		}
		
}
}	 
	 
	 function isset(variable_name) {
			try {
			//alert(variable_name);
				 if (typeof(eval(variable_name)) != 'Object')
				 if (eval(variable_name) != null)
				 return true;
			 } catch(e) { }
			return false;
	}
	 
/* jQuery(document).bind('keydown', 'f8',function (evt){jQuery('#_f8').addClass('dirty');

 
	if(!document.formulario.codprod.disabled && document.getElementById('productos').style.visibility!='visible' ){
			
	   			
		cambiar_moneda_ini();
		
		
	}else{
		if(document.getElementById('productos').style.visibility=='visible'){
		
		   for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
			  if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb'){
			
				var temp=document.getElementById('tblproductos').rows[i].cells[0].childNodes[0].childNodes[0]
		
				//espec_prod(temp);
		//var temp3=document.getElementById('tblproductos').rows[i].cells[3].innerHTML;
				
	   
				}
			 }
		
		
		}
	
	
	 }	

return false; }); */
	 	


}


jQuery(document).bind('keydown', 'f10',function (evt){jQuery('#_esc').addClass('dirty'); 

    event.keyCode=0;
    event.returnValue=false;
	/*
	var filas=document.getElementById('detalle_doc_gen').rows.length;
	//alert(filas);
	if(filas==1){	
		if(document.formulario.tipodoc.value=='P'){
		document.getElementById('tipodoc2').innerHTML="<span class='Estilo1 Estilo35'> VENTA </span>";
		document.formulario.tipodoc.value='V';
		document.formulario.impto.value=impto_venta;
		p1="S";
		}else{
		document.getElementById('tipodoc2').innerHTML="<span class='Estilo1 Estilo35'> PROFORMA </span>";
		document.formulario.tipodoc.value='P';
		document.formulario.impto.value=impto_prof;
		p1="N";
		}
	}else{
	alert('No es posible cambiar tipo de documento \n porque tiene 1 o más items agregados');
	}
//alert();

*/
return false; });

jQuery(document).bind('keydown', 'f9',function (evt){jQuery('#_f9').addClass('dirty');
	 
	// alert(document.getElementById('incluyeimp').innerHTML);

	cambiar_impuesto();
	
 return false; }); 



//function ver(){alert("tecla f7");}
jQuery(document).ready(domo);


function cambiar_impuesto(){
	
//	var permiso4=find_prm(tab4,tab_cod);
	var permiso4='N';
	
	 if(permiso4=='N'){
	
		   if(document.formulario.incluidoigv.value=="S"){
			document.formulario.incluidoigv.value="N";
						
			}else{
			document.formulario.incluidoigv.value="S";
		
			}
			
		mostrar_detalle();	
	}	
}

function mostrar_detalle(){
	
	var permiso4="N";
	var permiso10=permisos();
	//alert(temp_mon);
		//alert();
		var impto=document.formulario.impto.value;
	doAjax('compras/detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&permiso10='+permiso10+'&accion=mostrarprod&cargar_ref&ptoventa&impto='+impto,'mostrar','get','0','1','','');
	
	document.formulario.codprod.focus();
	
}

function iniciar(){
document.formulario.sucursal.focus();
document.formulario.codprod.focus();
//document.formulario.precio.readOnly=true;
//document.formulario.punit.disabled=true;
document.formulario.pro.value=1;

selecComboSuc()
//doAjax('carga_cbo_tienda.php','&codsuc='+document.formulario.sucursal.value,'cargar_cbo','get','0','1','','')
validarCierre();
}
function validarCierre(){

var tempCierre="<?php echo $rowCierre ?>";

	if(tempCierre==1){
	document.getElementById('capa_ocu_percep').style.display='block';
	document.getElementById('alerta').style.display='block';
	document.getElementById("presentacion").style.visibility='hidden';
	window.focus();
	}
}


function mostrar(texto) {
var r = texto;
//alert(r);
document.getElementById('resultado').innerHTML=texto;

document.getElementById('resultado').style.display="block";

document.formulario.precio2.value="<?php echo $_SESSION['registro']?>";
document.formulario.codprod.value="";
document.formulario.cantidad.value="";
document.formulario.precio.value="";
document.formulario.termino.value="";
document.formulario.punit.value="";

	if(!document.formulario.codprod.disabled){
		document.formulario.codprod.focus();
		document.formulario.pro.value=1;
		borrar();
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

//alert(texto);
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
	
	
	//-------------------------control busqueda-------------------------
			var controltipoBus=controlBusqueda(valor).split("|");
			if(controltipoBus[0]=='false'){
			return false;
			}
			valor=controltipoBus[2];
	//-----------------------------------------------------------------
	
	//alert(temp_criterio);
	doAjax('compras/det_aux.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&moneda_doc='+moneda_doc+'&tipoBus='+controltipoBus[1],'detalle_prod','get','0','1','','');


}

function detalle_prod(texto){
var r = texto;

document.getElementById('detalle').innerHTML=r;
document.getElementById('tblproductos').rows[0].style.background='#fff1bb';
document.formulario.ptoventa.value='N';
//document.getElementById('productos').style.visibility='visible';
//alert('entro');
//document.formulario.txtnombre.focus();
}

function recargar(){
//alert('entro');
document.formulario.submit();
}

function recargar2(){
alert('pedido');
}

function cargar_cbo(texto){
var r = texto;
document.getElementById('cbo_tienda').innerHTML=r;
seleccionar_combo();
}

function seleccionar_combo(){

 	 var valor1=tempTienda;
     var i;
	 for (i=0;i<document.formulario.almacen.options.length;i++)
        {
		
            if (document.formulario.almacen.options[i].value==valor1)
               {
			   
               document.formulario.almacen.options[i].selected=true;
               }
        
        }

document.formulario.sucursal.disabled=true;
document.formulario.almacen.disabled=true;
document.formulario.tcambio_ptoventa.disabled=true;
document.formulario.responsable.disabled=true;
				
}
function selecComboSuc(){
 	 var valor1=tempSucursal;
     var i;
	 for (i=0;i<document.formulario.sucursal.options.length;i++)
        {
		
            if (document.formulario.sucursal.options[i].value==valor1)
               {
			   
               document.formulario.sucursal.options[i].selected=true;
               }
        
        }
				
}


function vaciar_sesiones(){
	try{
datos.close();

//doAjax('compras/det_aux.php','','detalle_prod','get','0','1','','');
	}catch(e){
	}
	//alert();
	doAjax('compras/vaciar_sesiones.php','','limpieza','get','0','1','','');
}


function limpieza(texto){
//alert(texto);
}

function salir(){
	
	if(document.getElementById('productos').style.visibility!='hidden') {
	
	document.getElementById('productos').style.visibility='hidden';
	document.formulario.codprod.focus();
	}else{
	
		if(confirm("Esta seguro que desea salir...")){
		document.formulario.submit();
		}else{
		}
	
	}
//alert("escape");

}

</script>


<link href="styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-image: url(imagenes/bg3.jpg);
}
.Estilo35 {
	font-size: 17px;
	color: #EB1F01;
}
.Estilo50 {color: #333333}
.Estilo51 {color: #FF3300}

-->
</style>

<body  onload="iniciar();" onUnload="vaciar_sesiones()">
<form id="formulario" name="formulario" method="post" action="">
<div id="capa_ocu_percep"  style="background:#F2F2F2; height:100%; width:100%; position:absolute; filter:alpha(opacity=60); display:none; text-align:center; vertical-align:middle">

</div>

<div id="alerta" style="z-index:999; position:absolute; left: 267px; top: 149px; width: 332px; display:none">
  <table width="318" height="74" border="1" bgcolor="#FEDE70">
    <tr>
      <td width="349" valign="top"><table width="310" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="15" height="24" bgcolor="#0066CC">&nbsp;</td>
          <td width="280" bgcolor="#0066CC"><span class="Estilo32"><strong>Aviso</strong></span></td>
          <td width="15" bgcolor="#0066CC">&nbsp;</td>
        </tr>
        <tr>
          <td height="29">&nbsp;</td>
          <td align="center"><span class="Estilo112">No es posible hacer ventas...esta caja ya a sido cerrada. </span></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    </tr>
  </table>
  
  </div>
  <table width="800" border="0" cellpadding="0" cellspacing="0">
    <tr style="background:url(imagenes/white-top-bottom.gif)">
      <td style="border:#999999" height="25" colspan="11">
       
	    <table  width="668" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="136"><span style="border:#999999"><span class="Estilo45"><span class="Estilo48">PUNTO DE VENTA   </span>:::</span></span></td>
            <td width="80"><table title="Cambiar Moneda [F8]" width="80" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="cambiar_moneda_ini()">
                <td width="3" ></td>
                <td width="16" ><span class="Estilo112"><img src="imagenes/dolar.gif" width="15" height="15"></span></td>
                <td width="58" ><span class="Estilo50">Moneda</span><span class="Estilo51">[F8]</span> </td>
                <td width="3" ></td>
              </tr>
            </table></td>
            <td width="7" align="center"><span class="text5">|</span></td>
            <td width="74"><table title="Incl./no Incl.[F9]" width="70" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="cambiar_impuesto()">
                <td width="3" ></td>
                <td width="24" ><span class="Estilo112"><img src="imagenes/igv.gif" width="20" height="16"></span></td>
                <td width="45" ><span class="Estilo50">&nbsp;Imp<span class="Estilo51">[F9]</span> </span></td>
                <td width="3" ></td>
              </tr>
            </table></td>
            <td width="7"><span class="text5">|</span></td>
            <td width="87"><table title="Guardar[F2]" width="85" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="GuardarT()">
                <td width="3" ></td>
                <td width="20" align="center" ><img src="imgenes/fileprint.png" width="16" height="16"></td>
                <td width="59" ><span class="Estilo50">Guardar<span class="Estilo51">[F2]</span> </span></td>
                <td width="3" ></td>
              </tr>
            </table></td>
            <td width="7" ><span class="text5">|</span></td>
            <td width="75"><table  title="Salir [Esc]"width="72" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="salir()">
                <td width="3" ></td>
                <td width="20" ><img src="imagenes/salir.gif"  width="16" height="16" border="0"></td>
                <td width="46" ><span class="Estilo50">Salir<span class="Estilo51">[Esc]</span></span></td>
                <td width="3" ></td>
              </tr>
            </table></td>
            <td width="195"><span class="Estilo45">
              <input name="tipodoc" id="tipodoc" type="hidden" size="5" maxlength="5" value="V">
              <input name="tmoneda" id="tmoneda" type="hidden" size="5" maxlength="5" value="<?php echo $tmoneda?>">
              <input name="incluidoigv" id="incluidoigv" type="hidden" size="5" maxlength="5" value="S">
			  <input name="tempauxprod"  type="hidden" value="" size="15" />
			  <input name="precio_prod"  type="hidden" value="" size="15" />
			  <input name="accion2"  id="accion2" type="hidden" value="" size="15" />
			  <input name="impto" id="impto" type="hidden" size="6" maxlength="6" value="<?php echo $impto_prof ?>">
			  <input name="cantSubUnidad" id="cantSubUnidad" type="hidden" value="">
			  <input name="codBarraEnc" id="codBarraEnc" type="hidden" value="">
			  
            </span></td>
          </tr>
        </table></td>
    </tr>
	
	<tr>
	<td colspan="11" style="background-color:#FFFFFF" height="2" ></td>
	</tr>
	
    <tr>
      <td width="15">&nbsp;</td>
      <td width="15" height="22">&nbsp;</td>
      <td colspan="2" align="left"><input name="series" type="hidden" size="3" value="" />
          <input name="tipomov" id="tipomov" type="hidden" size="8"  value="2"/>
          <input type="hidden" name="prod_moneda" id="prod_moneda" size="3">
          <input type="hidden" name="unidad" id="unidad">
          <input  name="saldo" type="hidden" size="5" maxlength="10"></td>
      <td width="16">&nbsp;</td>
      <td width="56">&nbsp;</td>
      <td colspan="4"><input name="ruc2" type="hidden" size="10"/>
      <input id="ptoventa" name="ptoventa" type="hidden" size="10" value="N"/>
      <span class="Estilo15">
      <input name="suc" type="hidden" size="3" value="0" />
      <input name="alm" type="hidden" size="3"  value="0"/>
	  <input name="cod_cab_ref" type="hidden" size="3"  value=""/>
	  <input name="serie_ing" type="hidden" id="serie_ing" value="" size="3" maxlength="3">
	  <input name="pruebas" type="hidden" value='' size="5">
	  
	  <input type="hidden" name="uni_p" id="uni_p" value="" size="5">
	  <input name="factor_p" type="hidden" id="factor_p" value="" size="5">
      <input type="hidden" name="precio_p" id="precio_p" value="" size="5">
      </span></td>
      <td width="30">&nbsp;</td>
    </tr>
    <tr>
      <td rowspan="2">&nbsp;</td>
      <td rowspan="2">&nbsp;</td>
      <td colspan="2" rowspan="2" align="center" valign="top"><table width="159" height="44" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="150" align="center">
			  <fieldset>
        <span class="Estilo34">Tipo Documento:</span><br>&nbsp;
  
        <div id="tipodoc2" style="display:block"><span class="Estilo1 Estilo35"><span class="Estilo44"> VENTA </span></span> </div>
      </fieldset>			</td>
          </tr>
        </table></td>
      <td height="28">&nbsp;</td>
      <td><span class="Estilo47">Sucursal:</span></td>
      <td colspan="2"><span class="Estilo15">
	  
        <select name="sucursal" onChange="doAjax('carga_cbo_tienda.php','&codsuc='+document.formulario.sucursal.value,'cargar_cbo','get','0','1','','');" onFocus="gene()"  style="width:160px" >
			<?php 
		
  $resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn); 
				while($row1=mysql_fetch_array($resultados1))
				{
		?>
			<option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>

		    <?php }?>
        </select>
      </span></td>
      <td width="81" class="Estilo47">T.Cambio:</td>
      <td width="233"><input type="text" name="tcambio_ptoventa" size="7" value="<?php echo $tcambio;?>" style="text-align:right" >
      <span class="Estilo47">&nbsp;&nbsp;Fecha:<span class="Estilo15">&nbsp;&nbsp;<?php echo $fecha?><span class="Estilo45">
      <input name="femi" id="femi"  type="hidden" value="<?php echo date('d-m-Y')?>" size="15" />
      <input name="fven" id="fven"  type="hidden" value="<?php echo date('d-m-Y')?>" size="15" />
      </span></span></span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td><span class="Estilo47">Tienda:</span></td>
      <td colspan="2"><span class="Estilo15">
       <div id="cbo_tienda">	   </div>
        </span></td>
      <td><span class="Estilo47">Responsable:</span></td>
      <td><span class="Estilo15">
       
	    <select name="responsable" style="width:160" onChange=""  onFocus="enfocar_cbo(this);limpiar_enfoque(this);cbo_cond()">
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
	     
	   
        <span class="Estilo45">
        <input name="res" id="res"  type="hidden" value="" size="15" />
      </span></span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="15" colspan="11"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td height="28">&nbsp;</td>
      <td colspan="8"><fieldset>
        <table width="644" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td>&nbsp;</td>
            <td colspan="2"><span class="Estilo47">Producto:</span></td>
            <td>&nbsp;</td>
            <td><span class="Estilo47">Presentación:</span></td>
            <td><span class="Estilo47">Cant.:</span></td>
            <td><span class="Estilo14"></span><span class="Estilo47">P.Unit:</span></td>
            <td><span class="Estilo47">Precio:</span></td>
          </tr>
          <tr>
            <td width="6">&nbsp;</td>
            <td colspan="2">
			
			<input autocomplete="off"  name="codprod"  type="text" size="8"  onKeyUp="validartecla(event,this,'productos')"  onFocus="activar2;" />
                      <script>
					  //onBlur="verfactor()"
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
                      <input type="hidden" name="Submit" value="f8" />
                      <span class="Estilo15">
                      <input name="pro" type="hidden" size="3"  value="0"/>
                  </span>			</td>
            <td width="181"><input name="termino" type="text" onFocus="activar(event);" onBlur="javascript:imprimiendo();"/ onKeyUp="activar(event)" size="25" maxlength="250" ><input name="ter" type="hidden" size="3"  value="0"/></td>
            <td width="160"><div id="cbo_uni">
		    <select name="presentacion" style="width:140px"  id="presentacion">
			</select>
			</div></td>
            <td width="75">
			<input name="cantidad"  type="text" size="7" onBlur=""   onKeyUp="calc_pre_total()" />
            <script>
			
			function calcular_precio(e){
			
			if(e.keyCode != 13){
			doAjax('calcular_precio.php','','mostrar_precio','get','0','1','','');
			}
			
			}
			    </script></td>
            <td width="71"><input id="punit"  name="punit" type="text" size="7" onKeyUp="calcular_ptotal()"/></td>			
            <td width="79">
			<!--
			<input name="precio" type="text" size="7" onKeyUp="calcular_cant()" />
			-->
            <input  name="precio" type="text" size="7" onKeyUp="calcular_cant()"/>
			<input  name="precio2" type="hidden" size="3" />
			
			</td>
          </tr>
        </table>
      </fieldset></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="71">&nbsp;</td>
      <td width="100">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="101">&nbsp;</td>
      <td width="82">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="8">
	  <div id="resultado" style="height:200px; background:#FFFFFF;">
	    <table id="detalle_doc_gen" width="737" border="0" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
          <tr style="background:url(imagenes/bg_contentbase2.gif); background-position:100px 45px">
            <td width="60" height="19"><span class="Estilo31">Cantidad</span></td>
            <td width="326"><span class="Estilo31">Descripci&oacute;n</span></td>
            <td width="75" align="center"><span class="Estilo31">UND</span></td>
            <td width="66"><span class="Estilo31">P. Unit. </span></td>
            <td width="40"><span class="Estilo32"><span class="Estilo31">Precio</span></span></td>
            <td width="84"><span class="Estilo31">Notas</span></td>
            <td width="64" align="center"><span class="Estilo31">E</span></td>
          </tr>
 </table>
  <table  width="737" border="0" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
          <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
            <td width="56" align="center" bgcolor="#F5F5F5">&nbsp;</td>
            <td width="231" bgcolor="#F5F5F5">&nbsp;</td>
            <td width="148" align="right" bgcolor="#F5F5F5">&nbsp;</td>
            <td width="44" bgcolor="#F5F5F5"></td>
            <td width="96" align="right" bgcolor="#F5F5F5">&nbsp;</td>
            <td width="91" bgcolor="#F5F5F5">&nbsp;</td>
            <td width="49" align="center" bgcolor="#F5F5F5"></td>
          </tr>
   
          <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
            <td align="left" bgcolor="#FFFFFF"><span class="Estilo50">Items</span></td>
            <td bgcolor="#FFFFFF"><strong>0</strong></td>
            <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#FFFFFF"></td>
            <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#FFFFFF"></td>
            <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
            <td align="left" bgcolor="#FFFFFF"><span class="Estilo50">moneda</span></td>
            <td bgcolor="#FFFFFF" style="color:#FF0000"><label style="color:#FF0000" id="moneda"><?php echo "(S/.)" ?></label></td>
            <td align="right" bgcolor="#FFFFFF"><strong>Total</strong></td>
            <td bgcolor="#FFFFFF"></td>
            <td align="right" bgcolor="#FFFFFF"><strong>
			 <input name="total_doc" type="text" size="10" style="text-align:right"  value="<?php echo number_format($total+$total*0.19,2);?>"/></strong></td>
            <td bgcolor="#FFFFFF"><input type="hidden" name="temp_tot_det" value="<?php echo number_format($total,2);?>" /></td>
            <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
        </table>
	  </div>	  </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr> 
  </table>
  
  <div id="productos" style="position:absolute; left:76px; top:147px; width:300px; height:180px; z-index:1; visibility:hidden"> </div>

</form>
</body>

<script>

function calcular_cant(){
//alert();
/*
var punit=document.formulario.punit.value;
var precio=document.formulario.precio.value;
var total=Math.round((precio/punit)*1000)/1000;

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
var total=Math.round((precio/punit)*1000)/1000;
//alert(total);
	if(total>0){
		document.formulario.cantidad.value=total;
	}else{
		document.formulario.cantidad.value="";
	}
}


function gene(){
//document.formulario.suc.value='1';
doAjax('carga_cbo_tienda.php','&codsuc='+document.formulario.sucursal.value,'cargar_cbo','get','0','1','','');
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

function enviar(e){
	//alert();
	if(e.keyCode == 13){

	//doAjax('pedido_det.php','&precio='+document.formulario.punit.value,'mostrar','get','0','1','','');
	
	var punit=document.formulario.punit.value;
	var permiso4='N';
	var notas='';
	var presentacion=document.formulario.presentacion.value;//'07';
	var esserie='';
	var tipo_venta=document.formulario.tipodoc.value;
	var termino=document.formulario.termino.value; 
	
	if(document.formulario.codprod.value!=''){
		if(presentacion=='' || presentacion=='0' || presentacion=='undefined'){
		document.formulario.cantidad.focus();
		return false;
		}
	}
		
	if(tipo_venta=='P'){
	var permiso10='N';
	}else{
	var permiso10='S';
	}
	var precosto='';
	
	var impto=document.formulario.impto.value;
		if(document.formulario.cantidad.value==0 && document.formulario.codprod.value!=""){
			alert('ingrese cantidad valida');
			document.formulario.cantidad.focus();
			document.formulario.cantidad.select();
		}else{
			doAjax('compras/detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&punitario='+punit+'&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&notas='+notas+'&presentacion='+presentacion+'&esserie='+esserie+'&permiso10='+permiso10+'&cargar_ref=noref&precosto='+precosto+'&ptoventa&impto='+impto+'&termino='+termino,'mostrar','get','0','1','','');
		}
	//alert('entro');
	}
	
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
document.getElementById('productos').style.visibility='hidden';
document.formulario.ter.value=0;
document.formulario.pro.value=0;
document.formulario.cantidad.value=1;
document.formulario.termino.value=des;

document.formulario.cantidad.select();
//alert('entro');
//document.formulario.ter.value=1;
var uni_p=document.formulario.uni_p.value;
var factor_p=document.formulario.factor_p.value;
var precio_p=document.formulario.precio_p.value;

doAjax('carga_cbo_uni.php','&producto='+cod+'&uni_p='+uni_p+'&factor_p='+factor_p+'&precio_p='+precio_p,'view_cbo_uni','get','0','1','','');
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
	document.formulario.cantidad.focus();
	calculos_pretot();
	//document.formulario.precio.focus();
	//document.formulario.precio.select();
	}
}

temp_busqueda="<?php echo $_SESSION['filtro_busqueda']?>";

function controlBusqueda(valor){

			var tipoBus="";
			var tempValor=valor;
			var estado=true;
			//cancel_peticion()
			//alert(valor.value.substring(0,1));
			if(tempValor.substring(0,1)=='*' || tempValor.substring(0,2)=='**'){
				if(tempValor.length<5){
				estado=false;
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
				estado=false;
				}	
			}
			//alert(estado+"|"+tipoBus+"|"+tempValor);
			return estado+"|"+tipoBus+"|"+tempValor;
			
}

function validartecla(e,valor,temp){
	
	var tempValor=valor.value;
	var controltipoBus=controlBusqueda(tempValor).split("|");
	if(controltipoBus[0]=='false'){
	return false;
	}
	tempValor=controltipoBus[2];
	
	
	if(document.getElementById('productos').style.visibility=='visible'){
	temp_busqueda=document.formulario.busqueda.value;
	}
//alert(e.keyCode);
//((e.keyCode>=97) && (e.keyCode<=105)) || 
if ( ((e.keyCode>=65) && (e.keyCode<=90)) || e.keyCode==8 || e.keyCode==32 || ( (e.keyCode>=97) && (e.keyCode<=105) || (e.keyCode>=48) && (e.keyCode<=57) ) ) {

//cancel_peticion();
/*
 doAjax('lista_productos.php','','listaprod','get','0','1','','');
 */
 	var tipomov=document.formulario.tipomov.value;
	document.formulario.tempauxprod.value=temp;
	
	if(document.getElementById('productos').style.visibility=='visible'){
	temp_busqueda=document.formulario.busqueda.value;
	}else{
		//if(document.getElementById('auxiliares').style.visibility=='visible'){
		//temp_busqueda2=document.formulario.busqueda2.value;
		//alert(temp_busqueda);
		//}
	
	}
	
	
 	if(document.getElementById(temp).style.visibility!='visible' ){
  
		doAjax('compras/lista_aux.php','&temp='+temp+'&tipomov='+tipomov+'&modulo=tranf&pto_venta','listaprod','get','0','1','','');
		
	}else{

			
			//if(document.formulario.tempauxprod.value=='productos'){
			//valor=document.formulario.codprod.value;
			temp_criterio=temp_busqueda;
			//alert();
			selec_busq();
			//}
		
			//var temp=document.formulario.tempauxprod.value;
			var temp="productos";
			var tipomov=document.formulario.tipomov.value;
			var tienda=document.formulario.almacen.value;
			
			var moneda_doc=document.formulario.tmoneda.value;
			

		doAjax('compras/det_aux.php','&clasificacion=1&nomb_det='+tempValor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&moneda_doc='+moneda_doc+'&tipoBus='+controltipoBus[1],'detalle_prod','get','0','1','','');
		
		
}
 
//doAjax('detalle.php','&clasificacion=1&nomb_det='+window.document.formulario.codprod.value,'detalle_prod','get','0','1','',''); //alert('entro');
//alert('entro');
document.formulario.ptoventa.value='S';

}
//alert(e.keyCode);
/*
if( (e.keyCode>=97) && (e.keyCode<=105) || (e.keyCode>=48) && (e.keyCode<=57) ){

document.getElementById('productos').style.visibility='hidden';
document.formulario.codprod.focus();
}
*/

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


	function espec_prod(objeto){
	
	/*var codigo=objeto.innerHTML;
	//alert(codigo);
	window.open('compras/espec_prod.php?codigo='+codigo,'','width=680,height=400,top=150,left=150,scroolbars=no,directories=no,location=no,menubar=no,titlebar=no,toolbar=no');	
	*/
	
	selecionarItem(objeto.parentNode.parentNode.parentNode.rowIndex);
	}


function enfocar_cbo(control){
}

function limpiar_enfoque(control){
}

function entradae(objeto){
	
	//alert();
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
			
				if( (contorl_item_selec()==document.form_series.cant_req.value ) ){
					
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

/*
function entrada(objeto){

	objeto.cells[0].childNodes[0].checked=true;
	document.form_clientes.cod_aux_sel.value=objeto.cells[1].childNodes[0].innerHTML;
	document.form_clientes.nom_aux_sel.value=objeto.cells[2].childNodes[0].innerHTML;
	document.form_clientes.ruc_aux_sel.value=objeto.cells[3].childNodes[0].innerHTML;
	document.form_clientes.dir_aux_sel.value=objeto.cells[1].childNodes[0].innerHTML;
		
//	temp=objeto;
	if(objeto.style.background=='url(imagenes/sky_blue_sel.png)'){
//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='url(imagenes/sky_blue_sel.png)';
		if(temp2!=''){
		//alert(temp.style.background);
		//alert(objeto.bgColor);
		temp2.style.background=temp2.bgColor;
		}
		temp2=objeto;
	}
	
}*/

var temp2="";
	function entrada(objeto){
	//objeto.cells[0].childNodes[0].checked=true;
	//temp=objeto;
	
	if(tempColor==""){
	tempColor=document.getElementById('tblproductos').rows[0];
	}
	
	    tempColor.style.background='#ffffff';
		if(objeto.style.background=='#fff1bb'){
	//objeto.style.background=objeto.bgColor;
		}else{
		objeto.style.background='#fff1bb';
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
			temp2=document.getElementById('lista_aux').rows[0];	 
			document.getElementById('lista_aux').rows[0].style.background='url(imagenes/sky_blue_sel.png)';
			
			document.getElementById('lista_aux').rows[0].cells[0].childNodes[0].checked=true;
			document.form_clientes.cod_aux_sel.value=document.getElementById('lista_aux').rows[0].cells[1].childNodes[0].innerHTML;
		 } catch(e) { }
		 
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

	function cambiar_fondo(control,evento){
		
		
		if(evento=='e')
		control.style.backgroundImage='url(imagenes/boton_aplicar2.gif)';
		else
		control.style.backgroundImage='url(imagenes/boton_aplicar.gif)';
		
	
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

function eliminar(codigo,prod){

	if(!document.formulario.codprod.disabled){	
	var permiso4="N";
	//var notas=document.formulario.notas.value; 
	var tienda=document.formulario.almacen.value;
	var permiso10=permisos();
	 var impto=document.formulario.impto.value;
	 	 
	doAjax('compras/detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&cod_delete='+codigo+'&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&tienda='+tienda+'&permiso10='+permiso10+'&cargar_ref&ptoventa&impto='+impto+'&codSerie='+prod,'mostrar','get','0','1',codigo,'eliminar');
	}
}

function permisos(){

	var tipodoc=document.formulario.tipodoc.value;
		if(tipodoc=='P'){
		var permiso10="N";
		}else{
		var permiso10="S";
		}
	return permiso10;
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
				
				return;
		
		
			}else{
				document.formulario.cantidad.value=document.form_series.cant_selec.value;
				calculos_pretot();
				//alert();
				
				//document.formulario.punit.focus();
				//document.formulario.punit.select();
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
//alert();
		doAjax('compras/peticion_datos.php','&peticion=sal_series&series='+series+'&producto='+producto+'&accion='+accion+'&tienda='+tienda,'rspta_aceptar_sal_serie','get','0','1','','');
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
		//event.keyCode=13;
		//enviar();
		document.formulario.punit.focus();
		document.formulario.punit.select();
		}
	document.formulario.pruebas.value="";
    		
	}

function calcular_ptotal(){
	var totalitem=document.formulario.punit.value*document.formulario.cantidad.value;
	document.formulario.precio.value=(Math.round((totalitem)*1000)/1000).toFixed(2);
}

function calc_pre_total(){
	//document.form1.precio.value=document.form1.cantidad.value*document.form1.punit.value;
	if(isNaN(document.formulario.cantidad.value)){
		document.formulario.cantidad.value="0";
		document.formulario.cantidad.focus();
		document.formulario.cantidad.select();
	}
	var totalitem=document.formulario.punit.value*document.formulario.cantidad.value;
	document.formulario.precio.value=(Math.round((totalitem)*1000)/1000).toFixed(4);
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
		//moneda
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
		//total_precio=parseFloat(precio);
		document.formulario.punit.value=parseFloat(total_precio).toFixed(4);
//Yedem sub unidad
var cant=document.formulario.cantidad.value;
var saldo=document.formulario.saldo.value;

//doAjax('compras/sub_unidad.php','&codp='+document.formulario.codprod.value+'&facp='+document.formulario.factor_p.value+'&fac1='+document.formulario.presentacion.value+'&saldo='+saldo+'&cant='+cant,'CountSubUnidad','get','0','1','','');

	}catch(e){}		
		
	}
	
function CountSubUnidad(texto){
//	alert(texto);
	document.formulario.cantSubUnidad.value=texto;
}	

function cambiar_moneda_ini(){

			if(document.getElementById('moneda').innerHTML=='(S/.)'){
			document.getElementById('moneda').innerHTML='(US$.)';
			document.formulario.tmoneda.value="02";
			}else{
			document.getElementById('moneda').innerHTML='(S/.)';
			document.formulario.tmoneda.value="01";
			}
			
			if(document.formulario.total_doc.value!=0.00){
			
			var permiso4="N";
			var permiso10=permisos();
			//alert();
			//alert(temp_mon+" "+document.formulario.tmoneda.value);
			var impto=document.formulario.impto.value;
			
		doAjax('compras/detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&accion=cambiar_dolar&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&permiso10='+permiso10+'&cargar_ref&ptoventa&impto='+impto,'mostrar','get','0','1','','');
			
			}else{
				if(document.getElementById('moneda').innerHTML=='(S/.)'){
				temp_mon="01";
				}else{
				temp_mon="02";
				}
			
			
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
			
			//-------------------------control busqueda-------------------------
			var controltipoBus=controlBusqueda(valor).split("|");
			if(controltipoBus[0]=='false'){
			return false;
			}
			valor=controltipoBus[2];
			//-----------------------------------------------------------------
		
			var temp=document.formulario.tempauxprod.value;
			var tipomov=document.formulario.tipomov.value;
			var tienda=document.formulario.almacen.value;
			
			var temp_criterio=temp_busqueda;
			
			var comboclasificacion=document.formulario.comboclasificacion.value;
			var categoria=document.formulario.combocategoria.value;
			var subcategoria=document.formulario.combosubcategoria.value;
			var moneda_doc=document.formulario.tmoneda.value; 
			
		
		doAjax('compras/det_aux.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&comboclasificacion='+comboclasificacion+'&categoria='+categoria+'&subcategoria='+subcategoria+'&moneda_doc='+moneda_doc+'&tipoBus='+controltipoBus[1],'detalle_prod','get','0','1','','');
	
}

function recalcular_precios(control,producto,e,precosto,mon_prod,pre_actual){


	if(e.keyCode==13){
	var precio_nuevo=control.value;
	var tc_doc=document.formulario.tcambio.value;
	//alert(precio_nuevo+" "+producto);
	if(mon_prod==1 && document.getElementById('moneda').innerHTML=='(US$.)'){
			precosto=parseFloat(precosto/tc_doc).toFixed(4);
			}else{
				if(mon_prod==2 && document.getElementById('moneda').innerHTML=='(S/.)'){
				precosto=parseFloat(precosto*tc_doc).toFixed(4);
				}
			
	}
	
	//	var permiso4=find_prm(tab4,tab_cod);
	//	var permiso10=find_prm(tab10,tab_cod);
			var permiso4="N";
			var permiso10=permisos();
	//alert(precio_nuevo);		
	//alert(producto);
	var impto=document.formulario.impto.value;
	doAjax('compras/detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&accion=cambiar_dolar&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&permiso10='+permiso10+'&precio_nuevo='+precio_nuevo+'&producto='+producto+'&cambiar_precio&cargar_ref&ptoventa+&impto='+impto,'mostrar','get','0','1','','');
	
	}

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

function grabar_doc(){
		
			var total_doc=document.formulario.total_doc.value;
			if(total_doc!=0){
			
			var temp_doc="";
			var responsable=document.formulario.responsable.value;
			var tipomov=document.formulario.tipomov.value;
			var tienda=document.formulario.almacen.value;
			var condicion="1";
			var femision=document.formulario.femi.value;
			var fvencimiento=document.formulario.fven.value;
			var monto=document.formulario.monto.value;
			var impuesto1=document.formulario.impuesto1.value;
			var impto=document.formulario.impto.value;
			
			var incluidoigv=document.formulario.incluidoigv.value;
			var auxiliar=document.form_clientes.cod_aux_sel.value;
			var tmoneda=document.formulario.tmoneda.value;
			var tcambio=document.formulario.tcambio_ptoventa.value;
			var sucursal=document.formulario.sucursal.value;
			var correlativo_ref="";
			var serie_ref="";
			var cod_cab_ref="";
			var doc="PF";
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
			document.formulario.accion2.value="grabar";
			
			//alert(document.getElementById('estado').innerHTML);
			
	doAjax('compras/peticion_datos.php','&temp_doc='+temp_doc+'&responsable='+responsable+'&tipomov='+tipomov+'&tienda='+tienda+'&condicion='+condicion+'&femision='+femision+'&fvencimiento='+fvencimiento+'&monto='+monto+'&impto='+impto+'&total_doc='+total_doc+'&incluidoigv='+incluidoigv+'&auxiliar='+auxiliar+'&tmoneda='+tmoneda+'&tcambio='+tcambio+'&peticion=save_ptoventa'+'&sucursal='+sucursal+'&correlativo_ref='+correlativo_ref+'&serie_ref='+serie_ref+'&obs1='+obs1+'&obs2='+obs2+'&obs3='+obs3+'&obs4='+obs4+'&obs5='+obs5+'&cod_cab_ref='+cod_cab_ref+'&kardex_doc='+kardex_doc+'&act_kardex_doc='+act_kardex_doc+'&doc='+doc+'&serie='+serie+'&numero='+numero,'mostrar_grabacion','get','0','1','','');
						
			}else{
			alert('No se puede guardar el documento sin  detalle');						
			}
	
}


function mostrar_grabacion(texto){

//alert(texto);
		if(texto=='error'){
		
			alert('Documento no grabó.....Verifique su conexión de red.');
			document.formulario.submit();
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
			
			//window.open("colaImp.php?cod_cab="+xtemp[1],"","width=0,height=0,top=0,left=0,scroolbars=no,directories=no,location=no,menubar =no,titlebar=no,toolbar=no");
			
			document.formulario.submit();
			
	   }

//document.formulario.pruebas.value=texto;

}

function editar_serie(codprod,control){
	
	var tipomov=document.formulario.tipomov.value;
	var randomnumber=Math.floor(Math.random()*99999);
	var cantidad=control.innerHTML;
	var estado_doc=document.getElementById('estado').innerHTML;
	//var temp_doc=document.formulario.temp_doc.value;
	var temp_doc="";
	var tienda=document.formulario.almacen.value;
	//var cod_cab_ref=document.formulario.cod_cab_ref.value; 
	//var cab_doc=document.formulario.temp_doc.value;
	var cod_cab_ref=""; 
	var cab_doc="";
		
	var tipo_mov=document.formulario.tipomov.value;
	var kardex_doc="S";
		
		
	
		Modalbox.show('compras/sal_series.php?accion=editar&ran='+randomnumber+'&producto='+codprod+'&cant='+cantidad+'&estado_doc='+estado_doc+'&temp_doc='+temp_doc+'&tienda='+tienda+'&cod_cab_ref='+cod_cab_ref+'&cab_doc='+cab_doc+'&tipo_mov='+tipo_mov+'&kardex_doc='+kardex_doc+'&ptoventa', {title: 'Serie de productos ( Salidas )', width: 500}); 
			
	
	}
	
function selecionarItem(indice){

//if(document.getElementById('productos').style.visibility=='visible'){
	//	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
		//	if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb'){
			
		var temp=document.getElementById('tblproductos').rows[indice].cells[0].childNodes[0].childNodes[0].innerHTML;
		var cadena=document.getElementById('tblproductos').rows[indice].cells[3].innerHTML;
		
		//elegir(temp);
		
		var temp1=document.getElementById('tblproductos').rows[indice].cells[1].childNodes[0].innerHTML;
		
		var temp_prod=document.getElementById('tblproductos').rows[indice].cells[4].innerHTML.split("-");
		var temp4=document.getElementById('tblproductos').rows[indice].cells[4].innerHTML;
        var unidad=temp4.split("-");
		
		document.formulario.series.value=unidad[4];
  		
		var total_precio="";	
		var precio=parseFloat(temp_prod[2]);
		var prod_moneda=parseFloat(temp_prod[3]);
			
			total_precio=precio;
			//alert(total_precio);
			if(prod_moneda==01 && document.getElementById('moneda').innerHTML=='(US$.)'){
			
			total_precio=parseFloat(total_precio/tc_doc).toFixed(4);
			}else{
			//alert();
				if(prod_moneda==02 && document.getElementById('moneda').innerHTML=='(S/.)'){
				//alert();
				total_precio=parseFloat(total_precio*tc_doc).toFixed(4);
				}
			
			}


	   document.formulario.uni_p.value=unidad[0];
	   document.formulario.factor_p.value=unidad[1];
	   document.formulario.precio_p.value=unidad[2];
		document.formulario.serie_ing.value="";	
		//alert(temp_prod[3]);			
		document.formulario.punit.value=total_precio;
		document.formulario.prod_moneda.value=temp_prod[3];
		document.formulario.unidad.value=temp_prod[2];
		document.formulario.precio_prod.value=precio;
		document.formulario.saldo.value=cadena;
		
		document.formulario.codBarraEnc.value=temp_prod[13];
		  var tempDes=temp1.split("|");
	   elegir(temp,tempDes[1].substring(8,tempDes[1].length));
		//elegir(temp);
		
			//}
		//}
		
	//} 


}
	
function func_f8(){
	if(!document.formulario.codprod.disabled && document.getElementById('productos').style.visibility!='visible' ){
		//alert('entra');
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
				
					window.open('compras/espec_prod.php?codigo='+codigo+'&moneda='+moneda+'&sucursal='+sucursal,'','width=650,height=420,top=300,left=300,scroolbars=yes,directories=no,location=no,menubar=no,titlebar=no,toolbar=no,status=yes');	
		   
				}
			}
		}
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
							//alert("dfghdfx");
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

</script>

</html>
