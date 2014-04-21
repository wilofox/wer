<?php session_start();
include('../conex_inicial.php');

//$Utienda= $_SESSION['user_tienda'] ;
$Usucursal= $_SESSION['user_sucursal'] ;
//$Ucodvendedor=  $_SESSION['codvendedor'];
$Univel= $_SESSION['nivel_usu'];
$tip=$_REQUEST['tipo'];
//echo $tip;
switch($tip){
	case '1':$title="Proveedores";break;
	case '2':$title="Clientes";break;
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<script src="../jquery-1.2.6.js"></script>
<script src="../jquery.hotkeys.js"></script>

<script language="JavaScript">
/////////////////////////////////////////////////////////////////////////////////////////////////////////
jQuery(document).bind('keyup', 'up',function (evt){jQuery('#_up').addClass('dirty');

   if(document.getElementById('auxiliares').style.visibility=='visible'){

	for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
	//alert(document.getElementById('tblproductos1').rows[i].style.background);
		if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' && (i!=0) ){
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
			if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' && (i!=document.getElementById('tblproductos1').rows.length-1)){
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
 
 jQuery(document).bind('keyup', 'return',function (evt){jQuery('#_return').addClass('dirty'); 

	   if(document.getElementById('auxiliares').style.visibility=='visible'){

		for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
			if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb'){
			
		var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
		var temp1=document.getElementById('tblproductos1').rows[i].cells[1].childNodes[0].innerHTML;
		
		//var doc=document.formulario.doc.value;
		var ruc=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[0].childNodes[0].childNodes[0].childNodes[0].innerHTML;
		//alert(ruc);
			// if( (doc=='FA' || doc=='F1') && ruc==""  ){
			 //alert(" Cliente no tiene Ruc ");
			 //return false;
			 //}else{
			 
			 
			 
			 temp1=temp1.replace('&amp;','&');
			
			 elegir2(temp,temp1);
			 //}		  

			}
		 }
	   }
	   
	   
	
			
return false; });
function elegir2(cod,des){
//razon.replace('&','amps')
des=des.replace('amps','&');

document.form1.cliente.value=des;
document.form1.cliente2.value=cod;
document.getElementById('auxiliares').style.visibility='hidden';

}
jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_esc').addClass('dirty'); 

//document.formulario.codprod.focus();
//alert("escape");
salir();
		
return false; });
//////////////////////////////////////////////////////////////XXXXXXXXXXXXXXXXXXXXXXXXXXXXX
jQuery(document).bind('keydown', 'f4',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		if (document.getElementById('btn1').disabled==false){
			//Cancelar(this);
		}
 return false; }); 
jQuery(document).bind('keydown', 'f12',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		if (document.getElementById('btn5').disabled==false){
			Cancelar(this);
		}
 return false; }); 
 
jQuery(document).bind('keydown', 'f3',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		Nuevo();
 return false; }); 
 
 jQuery(document).bind('keydown', 'f10',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;		
		//if (document.getElementById('btn4').disabled==false){
			//FuncionOT(this,'CON','<?php //$_SESSION['nivel_usu'];?>');
			Anular('E');
		//}
 return false; }); 
 
 jQuery(document).bind('keydown', 'f6',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;		
		if (document.getElementById('btn6').disabled==false){
			FuncionOT(this,'OBS',this);
		}
		
 return false; }); 
 
 jQuery(document).bind('keydown', 'f4',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;		
		if (document.getElementById('btn6').disabled==false){
			FuncionOT(this,'LET','<?=$_SESSION['nivel_usu'];?>');
		}
		
 return false; }); 
 jQuery(document).bind('keydown', 'f9',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;		
		if (document.getElementById('btn7').disabled==false){
			FuncionOT(this,'ADJ',this);
		}
		
 return false; }); 
jQuery(document).bind('keydown', 'f5',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		if (document.getElementById('btn2').disabled==true){
			if (document.getElementById('btn3').disabled==false){
				Anular('');
			}
		}else{
			if (document.getElementById('btn2').disabled==false){
				Anular('A');
			}
		}
 return false; }); 
 jQuery(document).bind('keydown', 'f8',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		//doc_det(document.form1.XDato.value);
		doc_det(this);
		
 return false; }); 
  jQuery(document).bind('keydown', 'f7',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		//doc_det(document.form1.XDato.value);
mostrar_print(this);
		
 return false; }); 
</script>

<script language="javascript">
function recargar(){
document.getElementById('btn1').disabled="disabled";	
document.getElementById('btn2').disabled="disabled";
document.getElementById('btn4').disabled="disabled";

var tipo="<?php echo $tip; ?>"
var almacen=document.form1.almacen.value;
var cliente=document.form1.cliente2.value;
var ruc=document.form1.ruc.value;
var ckbven=document.form1.ckbven.checked;
var vendedor='';
	if (ckbven){
		var vendedor=document.form1.vendedor.value;
	}
var docref=document.form1.docref.value;
var fec1=document.form1.fec1.value;
var fec2=document.form1.fec2.value;
var mosdocFac='';
var mosdocAnu='';
if (document.form1.ckbDoc[0].checked){ var mosdocFac=''; var mosdocAnu=''; }
if (document.form1.ckbDoc[1].checked){ var mosdocFac='B'; }
if (document.form1.ckbDoc[2].checked){ var mosdocAnu='A'; }

var pagina=document.form1.pag.value;

	var variable_post=$actual;
	$("#detalle2").fadeOut(function() {
		lista_GenDocRef.php	
		$.post('lista_MultiCanje.php?tipo='+tipo+'&almacen='+almacen+'&cliente='+cliente+'&ruc='+ruc+'&vendedor='+vendedor+'&docref='+docref+'&fec1='+fec1+'&fec2='+fec2+'&mosdocFac='+mosdocFac+'&mosdocAnu='+mosdocAnu+'&pagina='+pagina, { variable: variable_post }, function(data){	
		$("#detalle2").html(data).fadeIn();
		});			
	});
}

$actual=0;
//timer = setInterval("recargar()", 20000);
</script>

<script language="javascript" src="miAJAXlib3.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo9 {
	font-size: 10px;
	font-weight: bold;
}
.Estilo112 {color: #000000}
.Estilo113 {	color: #CC3300;
	font-weight: bold;
	font-size: 10px;
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style></head>


<link href="../styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
background-color:#F3F3F3;   
}
.Estilo13 {color: #0767C7}

.Estilo100 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
.texto1{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #000000;
}
.texto2{
	font-family: Verdana,Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #000000;
}
</style>

<script>
function cargar_cbo(texto){
//alert(texto);
var r = texto;
document.getElementById('cbo_tienda').innerHTML=r;
document.form1.almacen.focus();
}

var temp="";
function entrada(objeto){

//	objeto.style.background='url(../imagenes/sky_blue_sel.png)';
	objeto.cells[0].childNodes[0].checked=true;
//	temp=objeto;
	if(objeto.style.background=='url(../imagenes/sky_blue_sel.png)'){
	//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='url(../imagenes/sky_blue_sel.png)';
	temp.style.background=temp.bgColor;
	temp=objeto;
	}
	
	// enfocar lo check con un ncolor rk
	for(var i=0;i<document.form1.xcodigo.length;i++){
		if (document.form1.xcodigo[i].checked){
			 document.getElementById('lista_productos').rows[i].style.backgroundColor = '#999999';
		}
	}


}

function cargar(){
	try {

document.getElementById('lista_productos').rows[0].style.background='url(../imagenes/sky_blue_sel.png)';
temp=document.getElementById('lista_productos').rows[0];
document.getElementById('lista_productos').rows[0].cells[0].childNodes[0].checked=true;

	 } catch(e) { }

}

  function isset(variable_name) {
			try {
				 if (typeof(eval(variable_name)) != 'undefined')
				 if (eval(variable_name) != null)
				 return true;
			 } catch(e) { }
			return false;
	}
function CarCodT(){
document.form1.succod.value=document.form1.Sucursal.value;
}	
function verOrder(){
	document.getElementById("divOrder").style.visibility="visible";
}
///////////Agregado Cliente /Proveedor
var temp_busqueda2="razonsocial";
function validartecla(e,valor,temp){

	
	//var tipomov=document.form1.tipomov.value;
	document.form1.tempauxprod.value=temp;
	
	if(document.getElementById('auxiliares').style.visibility=='visible'){
		temp_busqueda2=document.formauxiliar.busqueda2.value;
	
		}
		
	var lentexto=document.form1.cliente.value.length;


	if(lentexto>=1){
	
	if ( ( (e.keyCode>=96) && (e.keyCode<=105) || (e.keyCode>=48) && (e.keyCode<=57) )  || ((e.keyCode>=65) && (e.keyCode<=90)) || e.keyCode==8 || e.keyCode==32 ) {
	

		
		
		if(document.getElementById(temp).style.visibility!='visible' ){
		var tipomov=document.form1.tipo.value;
		doAjax('lista_aux_cliente.php','&temp='+temp+'&tipomov='+tipomov+'&modulo=tranf','listaprod','get','0','1','','');
		
		}else{
			var valor="";
			var temp_criterio;
			if(document.form1.tempauxprod.value=='auxiliares'){
			valor=document.form1.cliente.value;
			temp_criterio=temp_busqueda2;
		
			}
	
			var temp=document.form1.tempauxprod.value;
			//var tipomov= 2;//
			var tipomov=document.form1.tipo.value;
	
			
			
		doAjax('det_aux_cliente.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&criterio='+temp_criterio,'detalle_prod','get','0','1','','');
		
	//	doAjax('det_aux_3.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc='+document.formulario.prov_asoc.value+'&moneda_doc='+moneda_doc,'detalle_prod','get','0','1','','');
		 //alert('entro');
		}
		
		
	}
}else{
salir();
}
}
function listaprod(texto){

	var r = texto;
	var valor="";
	var temp_criterio='';
	
	if(document.form1.tempauxprod.value=='auxiliares'){
	
	document.getElementById('auxiliares').innerHTML=r;
	document.getElementById('auxiliares').style.visibility='visible';

	
	valor=document.form1.cliente.value; 
	  // alert(temp_busqueda2);
	temp_criterio=temp_busqueda2;
	selec_busq2();
	}
	
	
	var temp=document.form1.tempauxprod.value;
	//var tipomov=2;//
	var tipomov=document.form1.tipo.value;
	var tienda;//=document.forms[0].almacen.value;
	var moneda_doc;//=document.forms[0].tmoneda.value;
	//document.formulario.prov_asoc.value
	//alert(temp_criterio);
	doAjax('det_aux_cliente.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc=&moneda_doc='+moneda_doc,'detalle_prod','get','0','1','','');
				//doAjax('det_aux.php','&clasificacion=1&temp=auxiliares&tipomov='+document.formulario.tipomov.value+'&prov_asoc='+texto,'detalle_prod','get','0','1','','');
	
}	
function detalle_prod(texto){

	var r = texto;
	if(document.forms[0].tempauxprod.value=='auxiliares'){
	document.getElementById('detalle1').innerHTML=r;
	document.getElementById('tblproductos1').rows[0].style.background='#fff1bb';
	}
	if(document.forms[0].tempauxprod.value=='productos'){
	document.getElementById('detalle').innerHTML=r;
	document.getElementById('tblproductos').rows[0].style.background='#fff1bb';
	}

}
function selec_busq2(){
	
	 var valor1=temp_busqueda2;

 
     var i;

	for (i=0;i<document.formauxiliar.busqueda2.options.length;i++)

        {
			
            if (document.formauxiliar.busqueda2.options[i].value==valor1)
               {
			   document.formauxiliar.busqueda2.options[i].selected=true;
               }
        
        }
	
	}
	
function salir(){

	document.getElementById('auxiliares').style.visibility='hidden';
	
}	
///////////////////////////////////////
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
function entradaOrderY(objeto){
	if(objeto.style.background=='url(../imagenes/sky_blue_sel.png)'){
	objeto.style.background='url(../imagenes/sky_blue_grid.gif)';
	}else{
	objeto.style.background='url(../imagenes/sky_blue_sel.png)';
	}
}
function ordenar(campoOrder,formaOrder){
document.form1.tpcampo.value=campoOrder;
document.form1.tporden.value=formaOrder;
cargardatos('');
document.getElementById("divOrder").style.visibility="hidden";
}
function ordenamiento(Campo){
var ordenar=Campo;
var orden=document.form1.orden.value;
document.form1.ordenar.value=Campo;
var pagina='';

cargardatos('');

	if(orden=='asc'){
		document.form1.orden.value="desc";
	}else{
		document.form1.orden.value="asc";
	}	
		
}
function mostrar_vent(){
//alert(pagina);

document.getElementById('btn1').disabled="disabled";	
document.getElementById('btn2').disabled="disabled";
document.getElementById('btn4').disabled="disabled";

var almacen=document.form1.almacen.value;
var cliente=document.form1.cliente.value;
var ruc=document.form1.ruc.value;
var ckbven=document.form1.ckbven.checked;
var Estado=document.form1.Estado.value;
var cmbmoneda=document.form1.cmbmoneda.value;
var campoOrder=document.form1.tpcampo.value;
var formaOrder=document.form1.tporden.value;

var vendedor='';
	if (ckbven){
		var vendedor=document.form1.vendedor.value;
	}
var docref=document.form1.docref.value;
var fec1=document.form1.fec1.value;
var fec2=document.form1.fec2.value;
var mosdocFac='';
var mosdocAnu='';
if (document.form1.ckbDoc[0].checked){ var mosdocFac=''; var mosdocAnu=''; }
if (document.form1.ckbDoc[1].checked){ var mosdocFac='B'; }
if (document.form1.ckbDoc[2].checked){ var mosdocAnu='A'; }
//alert(mosdocFac+'//'+mosdocAnu);
//var pagina=document.form1.pag.value;

//lista_GenDocRef.php
window.open('lista_milifactura_imp.php?almacen='+almacen+'&cliente='+cliente+'&ruc='+ruc+'&vendedor='+vendedor+'&docref='+docref+'&fec1='+fec1+'&fec2='+fec2+'&mosdocFac='+mosdocFac+'&mosdocAnu='+mosdocAnu+'&Estado='+Estado+'&cmbmoneda='+cmbmoneda+'&campoOrder='+campoOrder+'&formaOrder='+formaOrder);

//setInterval("cargardatos('')", 20000);
}

function Marcar(opc){
	switch(opc){
		case 'Suc':if(document.form1.chkTodosS.checked){document.form1.Sucursal.disabled=true; document.form1.succod.value="T";}else{document.form1.Sucursal.disabled=false; document.form1.succod.value=document.form1.Sucursal.value;}break;
		case 'Cli':if(document.form1.chkTodosC.checked){document.form1.cliente.disabled=true; document.form1.cliente2.value="T";}else{document.form1.cliente.disabled=false; document.form1.cliente.value=""; document.form1.cliente2.value="";}break;
	}
}

</script>


<body onLoad="document.form1.Sucursal.focus(); cargardatos('');CarCodT();">

<form id="form1" name="form1" method="post" action="">
  <table width="810" height="417" border="0" cellpadding="0" cellspacing="0">
    
    <tr style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="5" height="23">&nbsp;</td>
      
	   <td width="760" height="25" colspan="11" style="border:#999999">
	  <span class="Estilo100">Finanzas :: Cr&eacute;ditos y Cobranzas :: Canje Letras <?php echo $title;?> :: Planilla de Letras </span>	  
      <input type="hidden" name="carga" id="carga" value="N">
      <input name="tempauxprod"  type="hidden" value="auxiliares" size="15" />
	  <input name="orden" type="hidden" size="5" value="asc">
	  <input name="ordenar" type="hidden" size="5" value=""> 	  
	  </td>	  
    </tr>
    <tr>
      <td height="84">&nbsp;</td>
      <td>
	  
	    <table width="99%" height="21" border="0" cellpadding="0" cellspacing="0" style="border-bottom:#CCCCCC solid 1px ;display:none">
          <tr>
            <td width="80" >
                <table title="Grabar [F2]" width="80" height="21" border="0" cellpadding="0" cellspacing="0">
                  <tr onClick="javascript:grabar_doc()" onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer;">
                    <td width="3" ></td>
                    <td width="20" ><span class="Estilo112"><img src="../imgenes/revert.png" width="14" height="16"></span></td>
                    <td width="54" ><span class="Estilo112">Grabar<span class="Estilo113">[F2]</span></span></td>
                    <td width="3" style="border:#666666 solid 1px" ></td>
                  </tr>
              </table></td>
            <td width="72" ><table  title="Salir [Esc]"width="72" height="21" border="0" cellpadding="0" cellspacing="0">
                <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="salir()">
                  <td width="3" ></td>
                  <td width="20" ><img src="../imagenes/salir.JPG"  width="16" height="16" border="0"></td>
                  <td width="46" ><span class="Estilo112">Salir<span class="Estilo113">[Esc]</span></span></td>
                  <td width="3" ></td>
                </tr>
            </table></td>
            <td width="82">&nbsp;</td>
            <td width="76">&nbsp;</td>
            <td width="80">&nbsp;</td>
            <td width="70">&nbsp;</td>
            <td width="71">&nbsp;</td>
            <td width="192">&nbsp;</td>
          </tr>
        </table>
		 <table width="99%" height="21" border="0" cellpadding="0" cellspacing="0" style="border-bottom:#CCCCCC solid 1px">
        <tr>
		  <td width="88" >
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
		  <table  title="Ver Documento Origen  [F8]"width="72" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="doc_det(this)">
                <td width="3" ></td>
                <td width="20" ><img src="../imagenes/ico_lupa.png"  width="16" height="16" border="0"></td>
                <td width="46" ><span class="Estilo112">Doc.<span class="Estilo113">[F8]</span></span></td>
                <td width="3" ></td>
              </tr>
          </table>
		  </td>
          <td width="94" ><table  title="Imprimir [F7]"width="87%" height="20" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="mostrar_print(this)">
              <td width="1" ></td>
              <td width="23" ><img src="../imgenes/fileprint.gif"  width="16" height="16" border="0"></td>
              <td width="62" ><span class="Estilo112"> Imprimir<span class="Estilo113">[F7]</span></span></td>
              <td width="3" ></td>
            </tr>
          </table></td>
          <td width="79">&nbsp;</td>
          <td width="79">&nbsp;</td>
          <td width="88">&nbsp;</td>
          <td width="77">&nbsp;</td>
          <td width="78">&nbsp;</td>
          <td width="214">&nbsp;</td>
        </tr>
      </table>
		
	    <table width="795" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="69" height="32"><div align="right"><span class="Estilo114">Empresa : </span></div></td>
            <td colspan="3"><span class="Estilo114">
              <input name="succod" type="text" disabled id="succod"  style="height:20; border-color:#CCCCCC" size="5">
              </span>
              <select  name="Sucursal" id="Sucursal" style="width:200" onChange="CarCodT()">
                <?php 		
  $resultados1 = mysql_query("select * from sucursal order by cod_suc ",$cn); 
  $k=0;
while($row1=mysql_fetch_array($resultados1))
{

	if ($Usucursal==$row1['cod_suc'] and $Univel<>5){
	?>
	<option value="<?php echo $row1['cod_suc'] ?>" selected><?php echo $row1['des_suc'] ?></option>
	<?
	}else{
	?>
	<option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
	<?
	}
	 
	$k++;
		}?>
              </select>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="chkTodosS" id="chkTodosS" value="T" onClick="Marcar('Suc')">Todos
              <input name="Estado" type="hidden" id="Estado" value="" >
              <input name="tpcampo" type="hidden" id="tpcampo"  >&nbsp;</td>
            <td width="64"><div align="right">Fecha  : </div></td>
            <td colspan="3"><?
			//echo $Univel;
			if ($Univel==1 ){ // || $Univel==6
			 $ActUsr ='style="height:18; visibility:hidden"';
			 $DisUsr='disabled';
			}else{
			$ActUsr ='style="height:18"';
			$DisUsr='';
			}
			?>
              <input name="fec1" type="text" size="10" maxlength="50" value="<?php echo "01-".date('m-Y')?>"  <?=$DisUsr;?>  >
              <button type="reset" id="f_trigger_b2"  <?=$ActUsr;?> >...</button>
              <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fec1",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b2",   
        singleClick    :    true,           
        step           :    1                
    });
              </script>
              Hasta
  <input name="fec2" type="text" size="10" maxlength="50"  value="<?php echo "30-".date('m-Y')?>" <?=$DisUsr;?> >
  <button type="reset" id="f_trigger_b1" <?=$ActUsr;?>  >...</button>
  <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fec2",      
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
			
			  </script></td>
            <td width="67" colspan="2" rowspan="2" align="center" valign="middle" class="Estilo114" ><table onClick="cargardatos('')"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="86%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="center"><img  src="../imagenes/ico_lupa.png" width="22" height="22"></td>
                </tr>
              <tr>
                <td height="24" align="center"><span class="Estilo9 Estilo13"><input type="hidden" name="tipo" id="tipo" value="<?php echo $_REQUEST['tipo'];?>">Procesar</span></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td height="24"><div align="right"><span class="Estilo114">Moneda : </span></div></td>
            <td colspan="3"><select name="cbomoneda" id="cbomoneda" onChange="cargardatos('')">
            <option value='T'>Todos</option>
			<?php $sql_mon=mysql_query("Select * from moneda",$cn); 
			while($rw_mon=mysql_fetch_array($sql_mon)){ 
				echo "<option value='".$rw_mon['id']."'>".strtoupper($rw_mon['descripcion'])." (".$rw_mon['simbolo'].")</option>";
			} ?></select>&nbsp;</td>
            <td width="64"><div align="right"><span class="Estilo114">Estado : </span></div></td>
            <td colspan="3"><select name="cboestado" id="cboestado" onChange="cargardatos('')">
				<option value='A'>Anulados</option>
                <option value='B'>En Banco</option>
                <option value='P'>Con Pagos</option>
                <option value='T' selected>Todos</option>
			</select>&nbsp;
			<input name="tporden" type="hidden" id="tporden" ></td>
          </tr>
          <tr>
            <td height="24"><div align="right"><span class="Estilo114"><?php if($tipo==2){echo "Cliente:";}else{echo "Proveedor:";}?></span></div></td>
            <td colspan="3"><input autocomplete="off" name="cliente" disabled id="cliente" type="text" size="40" maxlength="50" onKeyUp="validartecla(event,this,'auxiliares')">&nbsp;&nbsp;&nbsp;<input type="checkbox" name="chkTodosC" checked id="chkTodosC" value="T" onClick="Marcar('Cli')">Todos
            <input name="cliente2" type="hidden" size="3"  value="T"/></td>
            <td>&nbsp;</td>
            <td colspan="3">&nbsp;</td>
            <td colspan="2" align="center" valign="middle" class="Estilo114" >&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td height="227">&nbsp;</td>
	  
      <td valign="top">
	  
	  <table width="800" border="0" cellpadding="0" cellspacing="1">
        <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
          <td   style=" border:#CCCCCC solid 1px" width="29" height="21" align="center" ><span class="texto2"><strong>OK</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="22" align="center"><span class="texto1">
            <input style="border: 0px; background:none; " type="checkbox" name="Cod" onClick="marcar()"   />
          </span></td>
          <td width="70" align="center" onMouseOver="entradaOrderY(this)" onMouseOut="entradaOrderY(this)" onClick="ordenamiento('fecha')" style=" border:#CCCCCC solid 1px;cursor:pointer; text-decoration:underline"><span class="texto2"><strong>Fec. Ope. </strong></span></td>
		    <td  style=" border:#CCCCCC solid 1px" width="83" ><span class="texto2"><strong>PC</strong></span></td>
		    <td  onMouseOver="entradaOrderY(this)" onMouseOut="entradaOrderY(this)" onClick="ordenamiento('Num_doc')" style=" border:#CCCCCC solid 1px;cursor:pointer; text-decoration:underline;" width="73" ><span class="texto2"><strong>N&uacute;mero</strong></span></td>
		  
            <td  onMouseOver="entradaOrderY(this)" onMouseOut="entradaOrderY(this)" onClick="ordenamiento('cliente')" style=" border:#CCCCCC solid 1px;cursor:pointer; text-decoration:underline" width="125" ><span class="texto2"><strong>Cliente</strong></span>
			
			 &nbsp;
		  <div id="divOrder" style="position:absolute; left: 380px; top: 153px; height: 48px; width: 95px; visibility:hidden">
		    <table width="75" height="48" border="1"  bgcolor="#1DC0BC">
              <tr>
                <td><table width="92" border="0" cellpadding="0" cellspacing="0">
                  <tr  onMouseOver="entradaOrder(this)" onMouseOut="entradaOrder(this)" style="cursor:pointer" onClick="ordenar('C.razonsocial','asc')">
                    <td height="18" class="Estilo118 Estilo119 Estilo121" style="font:bold; color:#FFFFFF">&nbsp;Ascendente</td>
                  </tr>
                  <tr onMouseOver="entradaOrder(this)" onMouseOut="entradaOrder(this)" style="cursor:pointer" onClick="ordenar('C.razonsocial','desc')" >
                    <td height="18" class="Estilo118 Estilo119 Estilo121" style="font:bold; color:#FFFFFF">&nbsp;Descendente</td>
                  </tr>
                </table></td>
              </tr>
            </table>
		  </div>
		  </td>
          <td  style=" border:#CCCCCC solid 1px" width="31" ><span class="texto2"><strong>Mon</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="70" ><span class="texto2"><strong>Importe</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="89" ><span class="texto2"><strong>Responsable</strong></span></td>
          <td width="104" onMouseOver="entradaOrderY(this)" onMouseOut="entradaOrderY(this)" onClick="ordenamiento('cod_cab')" style=" border:#CCCCCC solid 1px;cursor:pointer; text-decoration:underline" ><span class="texto2"><strong>Cantidad Letras </strong></span></td>
          <td width="94" onMouseOver="entradaOrderY(this)" onMouseOut="entradaOrderY(this)" onClick="ordenamiento('cod_cab')" style=" border:#CCCCCC solid 1px;cursor:pointer; text-decoration:underline" ><span class="texto2"><strong>Banco </strong></span></td>
          <td width="14" onMouseOver="entradaOrderY(this)" onMouseOut="entradaOrderY(this)" style=" border:#CCCCCC solid 1px;" ><span class="texto2"><strong>A </strong></span></td>
          </tr>
        <tr>          
		  <td colspan="12" >
		  <div id="detalle2" style="width:800px; height:180px;" ></div>		  </td>
          </tr>
     </table>
	 <div style="display:none">
      <span class="Estilo114"><b>Mostrar Documento:</b></span>
      <input name="ckbDoc"  type="checkbox" id="ckbDoc" style="border: 0px; background-color:#F9F9F9; " checked   onClick="activar('mosdoc1');cargardatos('')" > 
      Todos
	  <input name="ckbDoc" type="hidden" id="ckbDoc" style="border: 0px; background-color:#F9F9F9; " onClick="activar('mosdoc2');cargardatos('')" title="Solo Facturados" > 
	  <input name="ckbDoc" type="checkbox" id="ckbDoc" style="border: 0px; background-color:#F9F9F9; " onClick="activar('mosdoc3');cargardatos('')" > 
	  Solo Anulados
	  </div>
	  </td>
    </tr>
    <tr>
      <td height="15">&nbsp;</td>
      <td><table width="799" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="119">
		  
		  <table width="53%" height="27" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="51%"><table width="114" height="36" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td bgcolor="#FF0000"><div align="center" class="text9">ANULADO</div></td>
                </tr>
                <tr>
                  <td bgcolor="#0066FF"><div align="center" class="text9" >FACTURADO</div></td>
                </tr>
              </table></td>
              <td width="49%">&nbsp;</td>
            </tr>
          </table>          </td>
          <td width="60">&nbsp;</td>
          <td width="73" align="center" valign="middle"><table onClick="Nuevo()"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="65" border="0" cellpadding="0" cellspacing="0" id="btn22">
            <tr>
              <td width="65" align="center"><img  src="../imagenes/iconohoja.gif" width="16" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" ><span style="color:#FF3300">[F3]</span>Nueva Plantilla</span></td>
            </tr>
          </table></td>
          <td width="90" align="center" valign="middle"><table onClick="FuncionOT(this,'LET','<?=$_SESSION['nivel_usu'];?>')" style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="81" border="0" cellpadding="0" cellspacing="0" disabled id="btn1">
            <tr>
              <td width="81" align="center"><img  src="../imagenes/moneda.gif" width="22" height="25"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" ><span style="color:#FF3300">[F4]</span><br>Letras en Banco</span></td>
            </tr>
          </table></td>
          <td width="84" align="center" valign="middle"><table onClick="Anular('')"  style="cursor:pointer; display:none" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="95%" border="0" cellpadding="0" cellspacing="0"  id="btn3" >
            <tr>
              <td align="center"><img  src="../imagenes/cerrar.jpg" width="22" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" style="font-size:9px"><span style="color:#FF3300;">[F5]</span> Desanular</span></td>
            </tr>
          </table>
           <table onClick="Anular('A')"  style="cursor:pointer;" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="74" border="0" cellpadding="0" cellspacing="0"  id="btn2" disabled="disabled" >
              <tr>
                <td width="74" align="center"><img  src="../imagenes/cerrar.jpg" width="22" height="22"></td>
              </tr>
              <tr>
                <td height="24" align="center"><span class="Estilo100"><span style="color:#FF3300">[F5]</span><br>Anular</span></td>
              </tr>
            </table></td>
            <td width="84" align="center"><table onClick="FuncionOT(this,'OBS','<?=$_SESSION['nivel_usu'];?>')"  style="cursor:pointer;" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="75" border="0" cellpadding="0" cellspacing="0" disabled id="btn6">
              <tr>
                <td width="75" align="center"><img  src="../imagenes/icoDocs.png" width="30" height="26"></td>
              </tr>
              <tr>
                <td height="24" align="center"><p class="Estilo100"><span style="color:#FF3300">[F6]</span><br>
                  Observ </p></td>
              </tr>
            </table></td>
          <td width="90" height="75" align="center"><table onClick="FuncionOT(this,'ADJ','<?=$_SESSION['nivel_usu'];?>')"  style="cursor:pointer;" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="82" border="0" cellpadding="0" cellspacing="0" disabled id="btn7">
            <tr>
              <td width="82" align="center"><img  src="../imagenes/archivo.png" width="30" height="26"></td>
            </tr>
            <tr>
              <td width="82" height="24" align="center"><p class="Estilo100"><span style="color:#FF3300">[F9]</span><br>
                Adj. Archivo</p></td>
            </tr>
          </table></td>
          <td width="83" height="75" align="center"><table onClick="Anular('E')"  style="cursor:pointer;" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="75" border="0" cellpadding="0" cellspacing="0" disabled id="btn4">
            <tr>
              <td width="75" align="center"><img  src="../imgenes/eliminar.gif" width="25" height="25"></td>
            </tr>
            <tr>
              <td width="75" height="24" align="center"><p class="Estilo100"><span style="color:#FF3300">[F10]</span><br>
              Eliminar </p></td>
            </tr>
          </table></td>
          <td width="93" align="center"><table onClick="Cancelar(this)" style="cursor:pointer;" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="75" border="0" cellpadding="0" cellspacing="0" disabled id="btn5">
            <tr>
              <td width="81" align="center"><img  src="../imagenes/iconSist2.gif" width="30" height="26"></td>
            </tr>
            <tr>
              <td height="24" align="center"><p class="Estilo100"><span style="color:#FF3300">[F12</span><span style="color:#FF3300">]</span><br>
                  Cancelaci&oacute;n de Letras</p></td>
            </tr>
          </table></td>
          <td width="23">&nbsp;</td>
        </tr>
      </table>
	 </td>
    </tr>
  </table>
</form>
 <div id="auxiliares" style="position:absolute; left:274px; top:90px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>
  <div id="productos" style="position:absolute; left:22px; top:192px; width:300px; height:180px; z-index:1; visibility:hidden"> </div>
 <div id="AnularRk" style="position:absolute; visibility:hidden; left: 266px; top: 190px; width: 240px; height: 38px;"></div>
  <div id="FactuaRk" style="position:absolute; left:208px; top:114px; width:300px; height:180px; z-index:1; visibility:hidden">  </div>
  
  

</body>
</html>

<script>

function cargardatos(pagina){
//alert(pagina);
document.getElementById('btn1').disabled="disabled";	
document.getElementById('btn2').disabled="disabled";
document.getElementById('btn4').disabled="disabled";
document.getElementById('btn6').disabled="disabled";
document.getElementById('btn5').disabled="disabled";
document.getElementById('btn7').disabled="disabled";

//var almacen=document.form1.almacen.value;
//var sucursal=document.form1.Sucursal.value;
var sucursal=document.form1.succod.value;
var tipo="<?php echo $tip; ?>";
/*var cliente=document.form1.cliente.value;
var ruc=document.form1.ruc.value;
var ckbven=document.form1.ckbven.checked;*/
var Estado=document.form1.cboestado.value;
var cmbmoneda=document.form1.cbomoneda.value;
var campoOrder=document.form1.tpcampo.value;
var formaOrder=document.form1.tporden.value;
/*var vendedor='';
	if (ckbven){
		var vendedor=document.form1.vendedor.value;
	}
var docref=document.form1.docref.value;*/
var fec1=document.form1.fec1.value;
var fec2=document.form1.fec2.value;
var ordenar=document.form1.ordenar.value;
var orden=document.form1.orden.value;
var mosdocFac='';
var mosdocAnu='';
var aux=document.form1.cliente2.value;
if (document.form1.ckbDoc[0].checked){ var mosdocFac=''; var mosdocAnu=''; }
if (document.form1.ckbDoc[1].checked){ var mosdocFac='B'; }
if (document.form1.ckbDoc[2].checked){ var mosdocAnu='A'; }
//alert(mosdocFac+'//'+mosdocAnu);
//var pagina=document.form1.pag.value;

//lista_GenDocRef.php
doAjax('lista_MultiCanje.php','&tipo='+tipo+'&sucursal='+sucursal+'&estado='+Estado+'&moneda='+cmbmoneda+'&pagina='+pagina+'&fec1='+fec1+'&fec2='+fec2+'&campoOrder='+campoOrder+'&cliente='+aux+'&formaOrder='+formaOrder+'&ordenar='+ordenar+'&orden='+orden,'mostrar_filtro2','get','0','1','','');

//setInterval("cargardatos('')", 20000);
}

function mostrar_filtro2(texto){
document.getElementById('detalle2').innerHTML=texto;
cargar();
document.form1.carga.value='N';
}

function cambiar_color1(obj){
obj.style.background='#FFF1BB';
obj.style.border='#C0C0C0 solid 1px';
}

function cambiar_color2(obj){
obj.style.background='#F3F3F3';
obj.style.border=' ';
}

function procesar(){

}
function enfocar_cbo(e){}
function limpiar_enfoque(e){}
function cambiar_enfoque(e){}
function activar(tipo){
	if(tipo=='ven'){
		if(document.form1.ckbven.checked==true){
		document.form1.vendedor.disabled=false;
		}else{
		document.form1.vendedor.disabled=true;
		}
	}
	if(tipo=='mosdoc1'){	
		document.form1.ckbDoc[1].checked=false;
		document.form1.ckbDoc[2].checked=false;
	}	
	if(tipo=='mosdoc2'){
		document.form1.ckbDoc[0].checked=false;
	}
	if(tipo=='mosdoc3'){
		document.form1.ckbDoc[0].checked=false;
	}
}
function AnularDoc(valor,condicion){
	document.getElementById('AnularRk').style.visibility='hidden';
	document.getElementById('AnularRk').style.visibility='visible';
	document.form1.carga.value='S';
	valor=valor.substr(6,15);
	//alert(valor);
	doAjax('anular.php','&CodDoc='+valor+'&Condicion='+condicion,'UpdateAnulado','get','0','1','','');
}
function UpdateAnulado(texto){
alert(texto);
var r = texto;
if(r!=""){
	alert("No se puede Anular. Contiene Letras "+r);
}
	var valor="";
	var temp_criterio='';
	
cargardatos('');

//	document.getElementById('AnularRk').innerHTML=r;
//	document.getElementById('AnularRk').style.visibility='visible';
}

function Anular(objeto){
	switch(objeto){
		case 'A':
			if(confirm("Esta seguro de ANULAR los documentos seleccionados")){
			}else{
				return false;
			}
			break;
		case 'E':
			if(confirm("Esta seguro de ELIMINAR los documentos seleccionados")){
			}else{
				return false;
			}
			break;
		case '':
			if(confirm("DESANULAR documentos seleccionados")){
			}else{
				return false;
			}
	}
  
	//alert(objeto);
	document.getElementById('btn1').disabled="disabled";	
	document.getElementById('btn2').disabled="disabled";
	//document.getElementById('btn4').disabled="disabled";
	document.getElementById('btn5').disabled="disabled";
	//document.getElementById('btn7').disabled="disabled";

	document.getElementById('btn3').style.display='none';
	document.getElementById('btn2').style.display='block';
	//alert(document.getElementById('btn2').style.display);
	if (document.form1.xcodigo.length==undefined){
		if (document.form1.xcodigo.checked  ){
			if (objeto=='S'){
				document.getElementById('btn1').disabled="";
				document.getElementById('btn2').disabled="";
				document.getElementById('btn4').disabled="";
				document.getElementById('btn6').disabled="";
				document.getElementById('btn5').disabled="";
				document.getElementById('btn7').disabled="";
				//document.getElementById('btn3').style.display='block';
				document.getElementById('btn2').style.display='block';	
			}else{
				document.getElementById('btn3').disabled="";
				//document.getElementById('btn5').disabled="";
				document.getElementById('btn2').style.display='block';
				//document.getElementById('btn3').style.display='block';
			}
			if (objeto=='A' || objeto=='' || objeto=='E'){ 
				AnularDoc(document.form1.xcodigo.value,objeto);
				//alert(document.form1.xcodigo[i].value);	
			}
		}	
	}else{
		for(var i=0;i<document.form1.xcodigo.length;i++){
			if (document.form1.xcodigo[i].checked ){
				if (objeto=='S'){
					document.getElementById('btn1').disabled="";
					document.getElementById('btn2').disabled="";
					document.getElementById('btn4').disabled="";
					document.getElementById('btn6').disabled="";
					document.getElementById('btn7').disabled="";
					document.getElementById('btn5').disabled="";
					//document.getElementById('btn3').style.display='block';
					document.getElementById('btn2').style.display='block';	
				}else{
					document.getElementById('btn3').disabled="";
					document.getElementById('btn2').style.display='block';
					//document.getElementById('btn3').style.display='block';
				}
				if (objeto=='A' || objeto=='' || objeto=='E' ){ 
					AnularDoc(document.form1.xcodigo[i].value,objeto);
					//alert(document.form1.xcodigo[i].value);	
				}
			}		
		}	
	}
}
function marcar(){
	if(document.form1.Cod.checked){
		for(var i=0;i<document.form1.xcodigo.length;i++){
		    if (document.form1.xcodigo[i].disabled){			
			}else{
			document.form1.xcodigo[i].checked=true;
			}			
		document.getElementById('btn1').disabled="";
		document.getElementById('btn2').disabled="";
		document.getElementById('btn4').disabled="";
		document.getElementById('btn6').disabled="";
		document.getElementById('btn7').disabled="";
		}		
	}else{
		for(var i=0;i<document.form1.xcodigo.length;i++){
			document.form1.xcodigo[i].checked=false;
			document.getElementById('btn1').disabled="disabled";	
			document.getElementById('btn2').disabled="disabled";
			document.getElementById('btn4').disabled="disabled";
			document.getElementById('btn4').disabled="disabled";
			document.getElementById('btn7').disabled="disabled";
			document.getElementById('btn5').disabled="disabled";
			}	
	}
	
}
function doc_det(valor){
	if (document.form1.XDato.length==undefined){
		var valor=document.form1.XDato.value;
	}else{
		for(var i=0;i<document.form1.XDato.length;i++){
				if (document.form1.XDato[i].checked){
					var valor=document.form1.XDato[i].value;
				}
		}
	}
//open  showModalDialog
//window.open("../doc_det2.php?referencia="+valor,valor,"toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=320,left=300 top=250");
window.open("ModLetras.php?tipo="+<?php echo $tip;?>+"&referencia="+valor,valor,"toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=790, height=500, left=200, top=100");

}
function mostrar_print(valor){
	if (document.form1.XDato.length==undefined){
		var valor=document.form1.XDato.value;
	}else{
		for(var i=0;i<document.form1.XDato.length;i++){
			if (document.form1.XDato[i].checked){
				var valor=document.form1.XDato[i].value;
			}
		}
	}
	window.open("canjevoucher.php?&codigo="+valor,valor,"toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=790, height=500, left=200, top=100");
}
function Cancelar(objeto){
	if (document.form1.xcodigo.length==undefined){
		if (document.form1.xcodigo.checked  ){		
			//Comprobante(document.form1.xcodigo.value,objeto);
			NumDc=0;
			codigoCli = document.form1.xcodigo.value.substr(0,6) ;	
			codigoRk1 = document.form1.xcodigo.value.substr(6,15) ;	
			//alert (codigoRk1);
			//alert (NumDc + '//' +codigoCli + '//' + codigoRk1);
			document.form1.carga.value='S';			
			//doAjax('../compras/peticion_datos.php','&peticion=save_SesionMilFac&NumDc=0&codigo='+codigoRk1+'&codigoCli='+codigoCli,'mostrar_SesionMilFac','get','0','1','','');

			//alert("Procesando información \n clic en Aceptar... ");
			
		 //doAjax('../compras/peticion_datos.php','&peticion=save_SesionMilFac&insert=multifac','mostrar_SesionMilFac','get','0','1','','');
		 
		}
	}else{
		var NumDc=-1;
		var codigoCli='';
		var CodigoVal='';
		var codCliVal='';
		
		var myCars=new Array();
	   
		 for(var i=0;i<document.form1.xcodigo.length;i++){
			if (document.form1.xcodigo[i].checked && NumDc==-1){					
				codigoCli = document.form1.xcodigo[i].value.substr(0,6) ;	
				codigoRk1 = document.form1.xcodigo[i].value.substr(6,15) ;	
				// asignar array
				NumDc++; 
				myCars[NumDc]=codigoCli;
				// Aguardando datos 
				//alert (NumDc + '//' +codigoCli + '//' + codigoRk1)
				document.form1.carga.value='S';
				//doAjax('../compras/peticion_datos.php','&peticion=save_SesionMilFac&NumDc='+NumDc+'&codigo='+codigoRk1+'&codigoCli='+codigoCli,'mostrar_SesionMilFac','get','0','1','','');
			//temporal
			CodigoVal +=codigoRk1+',';
			}
		}		 
		//alert("Procesando información \n  clic en Aceptar... ... ");
		// doAjax('../compras/peticion_datos.php','&peticion=save_SesionMilFac&insert=multifac','mostrar_SesionMilFac','get','0','1','','');
	}
		//alert (codigoRk1);
	//window.showModalDialog('letras_det.php?mcanje='+codigoRk1,'Cancelacion de Letras',"dialogWidth:730px;dialogHeight:540px,top=100,left=200,status=no,scrollbars=yes");
	window.open('letras_det.php?mcanje='+codigoRk1,'','width:730px;height:540px,top=100,left=200,status=yes,scrollbars=yes','');
	//dialogWidth:730px;dialogHeight:540px,top=100,left=200,status=no,scrollbars=yes
}
function mostrar_SesionMilFac(texto){
//alert(texto);
//return false
	if (texto!=''){
		for(var z=0;z<texto;z++){
			Comprobante(z);
			//Comprobante(myCars[z]);
			//Comprobante(CodigoVal);
		}
		cargardatos('');	
	}

}						
function countValues(aVals){
var aRes = new Array();
var nPrev = aVals[0];
var nCount = 0;
for (var i = 0; i < aVals.length; i++){
 if (aVals[i] != nPrev){
  if (nPrev != -1)
   //aRes.push(new Array(nPrev, nCount));
    aRes.push(new Array(nPrev));
  nCount = 1;
  nPrev = aVals[i];
 } else nCount++;
}
//aRes.push(new Array(nPrev, nCount));
aRes.push(new Array(nPrev));
return aRes;
}	
function Comprobante(valor){
//alert(valor);
//showModalDialog
window.showModalDialog("../empresaMultifactura.php?codigo="+valor+"&condicionRk=RA" ,"","dialogWidth:610px;dialogHeight:540px,top=100,left=200,status=yes,scrollbars=yes");



}

function cambiarEstado(obj){
document.form1.Estado.value=obj.value;
cargardatos('');
}
function FuncionOT(Codigo,Valor,Nivel){

if (Valor=='TER' ){
	if (Nivel==5 || Nivel== 4){

	}else{
		alert('Usuario no Autorizado');
		return false
	}
}

	
	if (document.form1.xcodigo.length==undefined){
		if (document.form1.xcodigo.checked  ){
			//AnularDoc(document.form1.xcodigo.value,objeto);
			codigo=document.form1.xcodigo.value;
			codigo=codigo.substr(6,15)+',';
			//window.open("funcionOT.php?CodDoc="+codigo+"&Fun="+Valor+"&ventana=ts", "ventana1" , "width=550,height=250,scrollbars=NO,top=100,left=200") 	
		}	
	}else{
XcodM='';
		for(var i=0;i<document.form1.xcodigo.length;i++){
				if (document.form1.xcodigo[i].checked ){
					codigo=document.form1.xcodigo[i].value;
					codigo=codigo.substr(6,15);
					XcodM+=codigo+',';					
//window.open("funcionOT.php?CodDoc="+codigo+"&Fun="+Valor+"&ventana=ts",codigo,"toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=320,left=300 top=250");
				}		
			}	
			codigo=XcodM;
	}	
//alert(codigo);
//alert(myAgupar);	
//window.showModalDialog("funcionFN.php?CodDoc="+codigo+"&Fun="+Valor+"&ventana=ts",Valor,"toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=320,left=300 top=250");
if(Valor=="ADJ" || Valor=="OBS"){
	window.open("funcionFN.php?CodDoc="+codigo+"&Fun="+Valor+"&ventana=ts",Valor,"toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=200,left=300 top=200");
}else{
	window.open("funcionFN.php?CodDoc="+codigo+"&Fun="+Valor+"&ventana=ts",Valor,"toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=500,left=300 top=200");
}
		
}
function Nuevo(){
	var tipo="<?php echo $tip;?>";
	//window.open('ModLetras.php?tipo='+tipo);
	window.showModalDialog('ModLetras.php?tipo='+tipo,'Planilla de Letras',"dialogWidth:790px;dialogHeight:500px,top=100,left=200,status=no,scrollbars=yes");
	
}
</script>
