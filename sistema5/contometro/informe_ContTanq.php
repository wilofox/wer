<?php 
session_start();
include('miclase.php');
$clase= new miclase('');

if(isset($_REQUEST['accion'])){

 $accion=$_REQUEST['accion'];
				$id=$_REQUEST['codigo'];
				$fec1=$_REQUEST['fec1'];
				$hora=$_REQUEST['hora'];
				$c_usuario=$_REQUEST['c_usuario'];				
				$pc=$_REQUEST['pc'];
				$c_manguera=$_REQUEST['c_manguera'];
				$turno=$_REQUEST['turno'];
				$contometro=$_REQUEST['contometro'];
				$varillaje=$_REQUEST['varillaje'];							
				$fecha=formatofecha($fec1).' '.$hora ;
				
	 if($accion=='n'){
		$clase->new_hiscontometro($id,$fecha,$c_usuario,$pc,$c_manguera,$turno,$contometro,$varillaje);
	}
	if($accion=='e'){
		$clase->act_hiscontometro($id,$fecha,$c_manguera,$turno,$contometro,$varillaje);
	}
	if($accion=='el' && isset($_REQUEST['codigo'])){
		$clase->elim_hiscontometro($_REQUEST['codigo']);
	}
	
}
?>

<script language="javascript" src="../miAJAXlib2.js"></script>
<script type="text/javascript" src="javascript/mover_div.js"></script>

<script language="javascript">
function numero(){
var key=window.event.keyCode;
if (key < 48 || key > 57){
window.event.keyCode=0;
}
}
</script>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>administradores</title>

<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>


<link href="../styles.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="javascript/mover_div.js"></script>
    <script src="../jquery-1.2.6.js"></script>
	  <script src="../jquery.hotkeys.js"></script>
<script>
var temp_busqueda2="";
var scrollDivs=new Array();
scrollDivs[0]="sucursal";
//scrollDivs[1]="div2";


function entrada(objeto){
//document.getElementById('prueba').value=objeto.style.background;
//alert(objeto.style.background);
objeto.style.background='#FFF1BB';
//document.getElementById('prueba').value=objeto.style.background;
//est=0;
}

function salida(objeto){
//document.getElementById('prueba').value=objeto.style.background;
//alert(objeto.style.background);
objeto.style.background='#EEEEEE';
//document.getElementById('prueba').value=objeto.style.background;
//est=0;
}

function recargar(){
document.form1.submit();
}

function nuevo_suc(texto){
var r = texto;
document.getElementById('sucursal').innerHTML=r;
document.getElementById('sucursal').style.visibility='visible';
//alert('entro');
//document.form1.txtnombre.focus();
document.getElementById('btn2').disabled="";
Marcaje_Anterior();
}

function ocultar(){
document.getElementById('sucursal').style.visibility='hidden';
document.getElementById('btn2').disabled="disabled";
}


	
	function val_letras(e) { // 1
	//alert(e);
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-z\s]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
	}
	function val_numeros(e){
	    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[0-9.]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
	}

function detalle_prod(texto){
//alert(texto);
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
function salir(){

	document.getElementById('auxiliares').style.visibility='hidden';
	
}
function graba(){
if(($('#sucursal').css('visibility'))!='hidden'){
 if(validar()!=false){
 document.form1.submit();
}
}
}


jQuery(document).bind('keydown', 'f7',function (evt){
 event.keyCode=0;
	event.returnValue=false;
//graba();
 printSelection(document.getElementById('resultado'));return false
 
  return false; });
  
jQuery(document).bind('keydown', 'f8',function (evt){
event.keyCode=0;
	event.returnValue=false;
 //doAjax('new_hiscont.php','accion=n','nuevo_suc','get','0','1','','');
write_to_excel(document.getElementById('resultado'));return false
		
return false; });
jQuery(document).bind('keydown', 'esc',function (evt){

//jQuery('#_esc').addClass('dirty'); 
ocultar();
event.keyCode=0;
	event.returnValue=false;		
return false; });


jQuery(document).bind('keyup', 'up',function (evt){jQuery('#_up').addClass('dirty');

   if(document.getElementById('auxiliares').style.visibility=='visible'){

	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
	//alert(document.getElementById('tblproductos1').rows[i].style.background);
		if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb' && (i!=0) ){
		document.getElementById('tblproductos').rows[i].style.background=document.getElementById('tblproductos').rows[i].bgColor;
		document.getElementById('tblproductos').rows[i-1].style.background='#FFF1BB';
		
			
			location.href="#ancla"+(i-1);
			
			document.form1.producto.focus();
			
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
 //alert(document.getElementById('tblproductos').rows.length);
	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
			
		//	alert(document.getElementById('tblproductos').rows.length);
			if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb' && (i!=document.getElementById('tblproductos').rows.length-1)){
			//alert(document.getElementById('TablaDatos').rows[i].style.background);
			document.getElementById('tblproductos').rows[i].style.background=document.getElementById('tblproductos').rows[i].bgColor;
			document.getElementById('tblproductos').rows[i+1].style.background='#FFF1BB';
			
			if(i%4==0 && i!=0){
			
			location.href="#ancla"+i;
			document.form1.producto.focus();
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

		for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
			if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb'){
		  // alert(document.getElementById('tblproductos').rows[i].cells[0].childNodes[0].innerHTML);
		var temp=document.getElementById('tblproductos').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
		var temp1=document.getElementById('tblproductos').rows[i].cells[1].childNodes[0].innerHTML;
		
		//var doc=document.formulario.doc.value;
		//var ruc=document.getElementById('tblproductos').rows[i].cells[2].childNodes[0].childNodes[0].childNodes[0].childNodes[0].innerHTML;
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
//alert(cod);
//razon.replace('&','amps')
des=des.replace('amps','&');

document.form1.producto.value=des;
document.form1.auxiliar2.value=cod;
document.getElementById('auxiliares').style.visibility='hidden';

}
jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_esc').addClass('dirty'); 

//document.formulario.codprod.focus();
//alert("escape");
salir();
		
return false; });

</script>

<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #990000;
	font-weight: bold;
}
.Estilo12 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo13 {font-size: 11px}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #F3F3F3;
	color:#000000;
}
.Estilo15 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #FFFFFF; }
.Estilo16 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
#paginacion,.paginacion {
    border: 0 solid;
    margin: 2px;
	font-size:14px;
	}
a.paginacion {
text-decoration:none;
	}
.Estilo112 {color: #000000}
.Estilo113 {color: #CC3300;
	font-weight: bold;
	font-size: 10px;
	font-family: Arial, Helvetica, sans-serif;
}

.Estilo34 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
.EstiloTexto1{
 font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#000000; font:bold;
}
.Estilo38 {	color: #0066CC;
	font-weight: bold;
}

-->
</style>
</head>


<body onLoad="cargar_datos(0)">
  <table width="130%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC" >
       <tr style="background:url(../imagenes/white-top-bottom.gif)">
       <td height="27" colspan="13" style="border:#999999"><span class="Estilo34">Grifo :: <span class="Estilo14 Estilo38">Informe de Contómetro y Tanques</span></span></td>
    </tr>
    <tr>
      <td colspan="7"><table width="99%" height="21" border="0" cellpadding="0" cellspacing="0" style="border-bottom:#CCCCCC solid 1px">
        <tr>
          <td width="83" ><script>
		  function entrar_btn(obj){
		  obj.cells[0].style.backgroundImage="url(../imagenes/bordes_boton1.gif)";
		  obj.cells[1].style.backgroundImage="url(../imagenes/bordes_boton2.gif)";
		  obj.cells[2].style.backgroundImage="url(../imagenes/bordes_boton2.gif)";
		  //obj.cells[3].style.backgroundImage="url(../imagenes/bordes_boton3.gif)";
		  
		  }
		  function salir_btn(obj){
		  obj.cells[0].style.backgroundImage="";
		  obj.cells[1].style.backgroundImage="";
		  obj.cells[2].style.backgroundImage="";
		  //obj.cells[3].style.backgroundImage="";
		  
		  }
		  
		  
		  
		    </script>
		      <table title="Imprimir[F7]" width="85" height="21" border="0" cellpadding="0" cellspacing="0">
                <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="printSelection(document.getElementById('resultado'));return false">
                  <td width="3" ></td>
                  <td width="20" align="center" ><img src="../imgenes/fileprint.png" width="16" height="16"></td>
                  <td width="59" ><span class="Estilo112">Imprimir<span class="Estilo113">[F7]</span> </span></td>
                  <td width="3" ></td>
                </tr>
              </table></td>
          <td width="91" ><table title="Exportar Excel[F8]" width="80" height="24" border="0" cellpadding="0" cellspacing="0" >
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="write_to_excel(document.getElementById('resultado'));return false" >
                <td width="1" height="24" ></td>
                <td width="26" align="center" ><span class="Estilo112"><img src="../imagenes/ico-excel.gif" width="16" height="16"></span></td>
                <td width="53" ><span class="Estilo112">Excel<span class="Estilo113">[F8]</span> </span></td>
              </tr>
            </table></td>
          <td width="180"><table  title="Salir [Esc]"width="96" height="21" border="0" cellpadding="0" cellspacing="0" disabled id="btn2"  style="visibility:hidden">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="ocultar()" >
              <td width="1" ></td>
              <td width="16" ><img src="../imagenes/salir.JPG"  width="16" height="16" border="0"></td>
              <td width="69" ><span class="Estilo112">Salir<span class="Estilo113">[Esc]</span></span></td>
              <td width="10" ></td>
            </tr>
          </table></td>
          <td width="86"><table title="Grabar [F2]" width="86" height="21" border="0" cellpadding="0" cellspacing="0" style="visibility:hidden">
            <tr  onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer;" onClick="graba()">
              <td width="1" ></td>
              <td width="15" ><span class="Estilo112"><img src="../imgenes/revert.png" width="14" height="16"></span></td>
              <td width="70" ><span class="Estilo112">Grabar<span class="Estilo113">[F2]</span></span></td>
            </tr>
          </table></td>
          <td width="72">&nbsp;</td>
          <td width="64">&nbsp;</td>
          <td width="66">&nbsp;</td>
          <td width="188">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td colspan="4" ><span class="Estilo1"></span></td>
      <td ><span class="Estilo16" >
	  <a href="javascript: doAjax('new_transportista.php','accion=n','nuevo_suc','get','0','1','','');"></a></span></td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td colspan="7"><form name="formbuscar" method="post" action="?" onSubmit="return false"><table width="465" border="0" align="center">
          <tr>
            <td width="36">Buscar:</td>
            <td width="91"><label>
            <select name="tipo" id="tipo" style="width:100px;">
             <option value="des_tienda" >Local</option>
              <option value="des_suc" selected>Empresa</option>
              </select>
            </label></td>
            <td width="146"><label>
              <input name="texto" type="text" id="texto" onKeyUp="cargar_datos()" >
            </label></td>
            <td width="174"><input type="submit" name="Submit" value="Buscar" onClick="cargar_datos()"></td>
          </tr>
          <tr>
            <td height="27"><div align="right">Fecha  : </div></td>
            <td colspan="3"> de
              <input name="fec1" type="text" size="10" maxlength="50" value="<?php echo date("d-m-Y", strtotime(date('d-m-Y')." -30 day")); ?>"  >
                <button type="reset" id="f_trigger_b2"  style="height:18" >...</button>
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
              <input name="fec2" type="text" size="10" maxlength="50"  value="<?php echo date('d-m-Y')?>" >
              <button type="reset" id="f_trigger_b1" style="height:18; vertical-align:top" >...</button>
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
          </tr>
        </table>
          <input name="tempauxprod" type="hidden" id="tempauxprod" value="productos">
		   <input name="error" type="hidden" id="error">
      </form></td>
    </tr>
    <tr><td colspan="8"><div id="resultado"></div><div id="paginacion"></div></td></tr>
</table>
   <div id="sucursal" style="position:absolute; left:198px; top:100px; width:350px; height:180px; z-index:1; visibility:hidden"> </div>
       <div id="auxiliares" style="position:absolute; left:274px; top:215px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>

  

</body>
<script>

function editar(cod){
//alert(cod);
	//if(confirm('Esta seguro que desea editar esta unidad puede tener productos relacionados')){
doAjax('new_hiscont.php','accion=e&cod='+cod,'nuevo_suc','get','0','1','','');
//}
}
function eliminar(cod){

	if(confirm('Esta seguro que desea eliminar ?')){
	location.href='hist_contometro.php?accion=el&codigo='+cod;
	//this.form1.submit();
	}
//window.open('editar_producto.php?cod='+cod,'ventana','height=470 width=500');
}


function listaprod(texto){

	var r = texto;
	var valor="";
	var temp_criterio='';
	//alert(document.getElementById('auxiliares').innerHTML);
	
	//if(document.form1.tempauxprod.value=='auxiliares'){
	document.getElementById('auxiliares').innerHTML=r;

	

	document.getElementById('auxiliares').style.visibility='visible';
	//document.getElementById('auxiliares').focus();
		//alert(texto);
	valor=document.form1.producto.value; 
	  
	  // alert(temp_busqueda2);
	temp_criterio=temp_busqueda2;
	//selec_busq2();
	//}
	
	
	var temp=document.formbuscar.tempauxprod.value;
	var tipomov;//=document.form1.tipomov.value;
	var tienda;//=document.forms[0].almacen.value;
	var moneda_doc;//=document.forms[0].tmoneda.value;
	//document.formulario.prov_asoc.value
	//alert(temp_criterio);
	
	doAjax('det_aux_prod.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc=&moneda_doc='+moneda_doc,'detalle_prod','get','0','1','','');
				//doAjax('det_aux.php','&clasificacion=1&temp=auxiliares&tipomov='+document.formulario.tipomov.value+'&prov_asoc='+texto,'detalle_prod','get','0','1','','');
	
}	


function validartecla(e,valor,temp){


	//var tipomov=document.form1.tipomov.value;
	//document.form1.tempauxprod.value=temp;
	
		if(document.getElementById('auxiliares').style.visibility=='visible'){
		//temp_busqueda2=document.formauxiliar.busqueda2.value;
		//alert('ac');
	//document.getElementById('auxiliares').focus();
		}
	
	var lentexto=document.form1.producto.value.length;
	if(lentexto>=1){
	
	if ( ( (e.keyCode>=96) && (e.keyCode<=105) || (e.keyCode>=48) && (e.keyCode<=57) )  || ((e.keyCode>=65) && (e.keyCode<=90)) || e.keyCode==8 || e.keyCode==32 ) {
	

		
		
		if(document.getElementById(temp).style.visibility!='visible' ){
	
			doAjax('lista_aux_prod.php','&temp=productos','listaprod','get','0','1','','');
		
		}else{
			var valor="";
			var temp_criterio;
					
			if(document.formbuscar.tempauxprod.value=='productos'){
			
			valor=document.form1.producto.value;

			temp_criterio=temp_busqueda2;
		
			}
	
			var temp=document.formbuscar.tempauxprod.value;
			var tipomov;//=document.form1.tipomov.value;
	
			//alert(temp);
			
		doAjax('det_aux_prod.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&criterio='+temp_criterio,'detalle_prod','get','0','1','','');
		
	//	doAjax('det_aux_3.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc='+document.formulario.prov_asoc.value+'&moneda_doc='+moneda_doc,'detalle_prod','get','0','1','','');
		 //alert('entro');
		}
		
		
	}
}else{
salir();
}
}

var error;
function validar_dato(texto){
	error=texto;
	if (texto!=''){
	 	//alert(texto);
	}


}
function Marcaje_Anterior(){
	cond=document.form1.elements[1].value;
	fecha=document.form1.elements[2].value;
	manuera=document.form1.elements[7].value;
	turno=document.form1.elements[8].value;
	contometraje=document.form1.elements[10].value;		
	pc=document.form1.elements[6].value;
	
	doAjax('lista_hiscont.php','ventana=vma&condicion='+cond+'&fecha='+fecha+'&manuera='+manuera+'&turno='+turno+'&contometraje='+contometraje,'marcaje_dato','get','0','1','','');
	
}
function marcaje_dato(texto){
//alert(texto);
var r = texto.split('|');
//alert(r[0]);
document.getElementById('mancaje').innerHTML=r[0];

}
function validar(){
	cond=document.form1.elements[1].value;
	fecha=document.form1.elements[2].value;
	manuera=document.form1.elements[7].value;
	turno=document.form1.elements[8].value;
	contometraje=document.form1.elements[10].value;		
	pc=document.form1.elements[6].value;

	if(pc==""){
		alert("Falta registrar a usiario...");
		return false;
	}
	if(contometraje==""){
		alert("Ingrese valor de contometro...");
		document.form1.elements[10].focus();
		return false;
	}
	
	doAjax('lista_hiscont.php','ventana=vhc&condicion='+cond+'&fecha='+fecha+'&manuera='+manuera+'&turno='+turno+'&contometraje='+contometraje,'validar_dato','get','0','1','','');
	
if(confirm('Desea Guardar información')){
	
}else{
	return false;
}

if (error!=''){
alert(error);
return false;
}

//----- guardando

	if(document.getElementById('auxiliares').style.visibility!='visible'){
		var total=document.form1.elements.length;
		var nomcampo="";

		for (a=0;a<total;a++){
		//alert(a+"--"+document.form1.elements[a].value+"--"+document.form1.elements[a].id);
		try {
				var elem=document.getElementById(document.form1.elements[a].id);
				elem.style.backgroundColor='';
		
					if(document.form1.elements[a].value==""  ){	
						nomcampo=document.form1.elements[a].id;
						break;
					}
			} catch(e) { }
		}
		
		/*
		if(nomcampo!=""){
			alert("El campo "+nomcampo+" falta ingresar o no cumple con los requisitos");
			var elem=document.getElementById(nomcampo);
			elem.style.backgroundColor='#FFFF00';
			elem.focus();
			return false;
		}*/
	//--------Alertas de mensaje
	
	}else{
		return false;
	}

}

function cargar_datos(pag){

var cond=document.formbuscar.tipo.value;
var texto=document.formbuscar.texto.value;
var fec1=document.formbuscar.fec1.value;
var fec2=document.formbuscar.fec2.value;

doAjax('lista_hiscont.php','ventana=ict&condicion='+cond+'&texto='+texto+'&fec1='+fec1+'&fec2='+fec2+'&pag='+pag,'view_det','get','0','1','','');

}
function view_det(texto){
//alert(texto);
var r = texto.split('|');
//alert(r[0]);
document.getElementById('resultado').innerHTML=r[0];
//document.form1.carga.value='N';
document.getElementById('paginacion').innerHTML=r[1];

}
function mangueraSelec(texto){
cond=texto.value;
//alert(cond);
doAjax('lista_hiscont.php','ventana=mg&condicion='+cond,'view_mg','get','0','1','','');
}
function view_mg(texto){
//alert(texto);
var r = texto.split('|');
document.getElementById('manguera_det').innerHTML=r[0];
//document.getElementById('paginacion').innerHTML=r[1];
Marcaje_Anterior();
}

</script>

<script type="text/javascript">

function printSelection(node){
  var fec1=document.formbuscar.fec1.value;
  var fec2=document.formbuscar.fec2.value;	
  var content=node.innerHTML
  var pwin=window.open('','print_content','left=1,top=1,width=870,height=500');  
  pwin.document.open();
  //pwin.document.write('<html><body onload="window.print()">'+content+'</body></html>');
  pwin.document.write('<html><body onload="window.print()">');
  pwin.document.write('<table  border="0" align="center" cellpadding="0" cellspacing="0" ><tr><td  align="center"></td><td colspan="9" align="center"><h2><b>Informe de Contómetro y Tanques</b></h2></td></tr><tr><td  align="center"></td><td colspan="9"><strong>Fecha: De '+ fec1 +' al '+ fec2 +'</strong></td></tr></table>');  
  pwin.document.write(content);  
  pwin.document.write('</body></html>');  
  pwin.document.close(); 
  //setTimeout(function(){pwin.close();},100);

}
function write_to_excel(node){
  var fec1=document.formbuscar.fec1.value;
  var fec2=document.formbuscar.fec2.value;	
  var cond=document.formbuscar.tipo.value;
  var texto=document.formbuscar.texto.value;
	 //var content=node.innerHTML
	 //var html=document.getElementById("resultado").innerHTML;   
	 //var html=content;
	  var html='1';
	 //location.href="excel.php?excel="+html; 
	 location.href="excel.php?excel="+html+"&fec1="+fec1+"&fec2="+fec2+"&cond="+cond+"&texto="+texto; 
}

function export_excel(texto){
alert(texto);
var r = texto;
document.getElementById('sucursal').innerHTML=r;
document.getElementById('sucursal').style.visibility='visible';
//alert('entro');
}


</script>

</html>
