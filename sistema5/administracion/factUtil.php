<?php 
session_start();
include('miclase.php');
include('../conex_inicial.php');
$clase= new miclase('');

if(isset($_REQUEST['accion'])){
//echo "entro";
 $accion=$_REQUEST['accion'];

				$id=$_REQUEST['codigo'];
				$descripcion=$_REQUEST['descripcion'];
				$factor1=$_REQUEST['factor1'];
				$factor2=$_REQUEST['factor2'];
				$factor3=$_REQUEST['factor3'];
				$factor4=$_REQUEST['factor4'];
				
				
				
				
	 if($accion=='n'){
		$clase->save_factUtil($id,$descripcion,$factor1,$factor2,$factor3,$factor4);
	}

	if($accion=='e'){
	//echo  $_REQUEST['codigo'];
		$clase->update_factUtil($id,$descripcion,$factor1,$factor2,$factor3,$factor4);
	}


}

?>
<script language="javascript" src="../miAJAXlib2.js"></script>
<script type="text/javascript" src="javascript/mover_div.js"></script>
<link href="../styles.css" rel="stylesheet" type="text/css">

<html xmlns="http://www.w3.org/1999/xhtml">
<style type="text/css">
<!--
.Estilo34 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
-->
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>administradores</title>

<script src="../jquery-1.2.6.js"></script>
<script src="../jquery.hotkeys.js"></script>
	
	 <link rel="stylesheet" type="text/css" href="estilos.css" media="all" />
	
	<script language="javascript" type="text/javascript" src="csspopup2.js"></script>

<script>
var temp_busqueda2="";
var scrollDivs=new Array();
scrollDivs[0]="sucursal";
//scrollDivs[1]="div2";

/*
function entrada(objeto){
//document.getElementById('prueba').value=objeto.style.background;
//alert(objeto.style.background);
objeto.style.background='#FFF1BB';
//document.getElementById('prueba').value=objeto.style.background;
//est=0;
}
*/
var temp="";
function entrada(objeto){

	objeto.cells[0].childNodes[0].checked=true;
	//document.formbuscar.codArea.value=objeto.cells[1].childNodes[0].innerHTML;
	//document.getElementById("desArea").innerHTML=objeto.cells[2].childNodes[0].innerHTML;
//	temp=objeto;
	if(objeto.style.background=='url(../imagenes/sky_blue_sel.png)'){
//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='url(../imagenes/sky_blue_sel.png)';
		if(temp!=''){
		//alert(temp.style.background);
		temp.style.background="#FFFFFF";
		}
		temp=objeto;
	}
	
}
var temp2="";
function entrada2(objeto){

	//objeto.cells[0].childNodes[0].checked=true;
	//document.formbuscar.codArea.value=objeto.cells[1].childNodes[0].innerHTML;
	//document.getElementById("desArea").innerHTML=objeto.cells[2].childNodes[0].innerHTML;
//	temp=objeto;
	if(objeto.style.background=='url(../imagenes/sky_blue_sel.png)'){
//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='url(../imagenes/sky_blue_sel.png)';
		if(temp2!=''){
		//alert(temp.style.background);
		temp2.style.background="#FFFFFF";
		}
		temp2=objeto;
	}
	
}


function salida(objeto){
objeto.style.background='#EEEEEE';
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
}

function ocultar(){
document.getElementById('sucursal').style.visibility='hidden';
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


jQuery(document).bind('keydown', 'f2',function (evt){
 event.keyCode=0;
	event.returnValue=false;
graba();
 
  return false; });
  
jQuery(document).bind('keydown', 'f3',function (evt){//jQuery('#_esc').addClass('dirty'); 
event.keyCode=0;
	event.returnValue=false;
//	alert("m");
 doAjax('new_area_costo.php','accion=n','nuevo_suc','get','0','1','','');
		
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
body {
background-color:#F7F7F7;   
}
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #990000;
	font-weight: bold;
}
.Estilo12 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color:#333333 }
.Estilo13 {font-size: 11px}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
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
.EstiloTexto1{
 font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#000000; font:bold;
}
.EstiloTexto2{
 font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#FF3300; font:bold;;
}
.Estilo38 {
	color: #0066CC;
	font-weight: bold;
}
-->
</style>
</head>


<body bgcolor="#FFFFFF" onLoad="cargar_datos(0)">
<form name="formVenProcesos" method="post" action="?" >
 <div id="capaPopUp" style="z-index:1;filter:alpha(opacity=40);-moz-opacity:.60;opacity:.60"></div>
     <div id="popUpDiv" ><!--id="popUpDiv"-->
        <div id="capaContent">

<table width="400" height="200" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
	
	<table width="398">
      <tr style="background-image:url(../imagenes/title.png); background-position:100% 40%;">
        <td height="23" colspan="3" style="font:Arial, Helvetica, sans-serif; color:#CC6600; font-size:12px"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="310"><span class="Estilo38">&nbsp;PROCESOS</span></td>
            <td width="78" align="right"><table width="29" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td  align="right"><img id="cerrar2" onClick="javascript:void(0)" style="cursor:pointer" src="../imagenes/cerrar.jpg" width="23" height="21"></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td width="11" height="133">&nbsp;</td>
        <td width="354" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#003366" valign="top">
		
		<div style="height:250px; overflow-y:scroll">
		  <table width="354" border="0" cellpadding="1" cellspacing="1">
            <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
              <td width="31" align="center" class="EstiloTexto1">&nbsp;</td>
              <td width="53" align="center" class="EstiloTexto1">id</td>
              <td width="108" align="center" class="EstiloTexto1">Nombre</td>
              <td width="149" align="center" class="EstiloTexto1">descripcion</td>
            </tr>
            <?php 
		  $strSQLProc="select * from procesos order by id";
		  $resultadoProc=mysql_query($strSQLProc,$cn);
		  while($rowProc=mysql_fetch_array($resultadoProc)){
		  ?>
            <tr>
              <td align="center" bgcolor="#F8F8F8"><input id="chkProcesos" style="border:none; background:none" type="checkbox" name="chkProcesos[]" value="<?php echo $rowProc['id']?>"></td>
              <td align="center" bgcolor="#F8F8F8" class="Estilo12"><?php echo $rowProc['id']?></td>
              <td bgcolor="#F8F8F8" class="Estilo12"><?php echo $rowProc['nombre']?></td>
              <td bgcolor="#F8F8F8" class="Estilo12"><?php echo $rowProc['descripcion']?></td>
            </tr>
            <?php }?>
          </table>
		</div>
		
		</td>
        <td width="17">&nbsp;</td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center"><input onClick="javascript:void(0);" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(../imagenes/boton_aplicar.gif) ; cursor:pointer" type="button" name="aplicarform" value="Aplicar"  id="anular" >
		
		&nbsp;&nbsp;&nbsp;
		
		<input onClick="javascript:void(0);" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(../imagenes/boton_aplicar.gif) ; cursor:pointer" type="button" name="cerrarform" value="Cancelar"  id="cerrar" >	</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>


</div>
</div>
</div>
</form>

  <table width="792" height="169" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" >
    <tr style="background:url(../imagenes/white-top-bottom.gif)">
       <td height="27" colspan="13" style="border:#999999">&nbsp;<span class="Estilo34">Mantenimientos :: <span class="Estilo14 Estilo38">Factores de Utilidad </span></span></td>
    </tr>
    <tr>
      <td width="792" colspan="7"><table width="98%" height="21" border="0" cellpadding="0" cellspacing="0" style="border-bottom:#CCCCCC solid 1px">
        <tr>
          <td width="120" ><script>
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
              <table title="Grabar [F2]" width="96" height="21" border="0" cellpadding="0" cellspacing="0">
                <tr  onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer;" onClick="graba()">
                  <td width="1" ></td>
                  <td width="15" ><span class="Estilo112"><img src="../imgenes/revert.png" width="14" height="16"></span></td>
                  <td width="80" ><span class="Estilo112">Grabar<span class="Estilo113">[F2]</span></span></td>
                </tr>
          </table></td>
          <td width="106" ><table disabled title="Nuevo[F3]" width="85" height="21" border="0" cellpadding="0" cellspacing="0">
		  <!--onClick="javascript: doAjax('new_area_costo.php','accion=n','nuevo_suc','get','0','1','','');"-->
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer"  >
                <td width="1" ></td>
                <td width="15" align="center" ><span class="Estilo112"><img src="../imagenes/nuevo.gif" width="14" height="16"></span></td>
                <td width="68" ><span class="Estilo112">Nuevo<span class="Estilo113">[F3]</span> </span></td>
              </tr>
          </table></td>
          <td width="120"><table  title="Salir [Esc]"width="96" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="ocultar()" >
                <td width="1" ></td>
                <td width="16" ><img   src="../imagenes/salir.JPG"  width="16" height="16" border="0"></td>
                <td width="69" ><span class="Estilo112">Salir<span class="Estilo113">[Esc]</span></span></td>
                <td width="10" ></td>
              </tr>
          </table></td>
          <td width="70">&nbsp;</td>
          <td width="71">&nbsp;</td>
          <td width="63">&nbsp;</td>
          <td width="65">&nbsp;</td>
          <td width="166">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    
    <tr>
      <td height="23" colspan="7" align="center">
	   <form name="formbuscar" method="post" action="?" onSubmit="return false">
        <table width="605" border="0" height="20px">
          <tr>
            <td width="45" >Buscar:</td>
            <td width="70"><label>
              <select name="tipo" id="tipo" style="visibility:visible">
                <option value="id">id</option>
                <option value="conceptos" selected>Descripci&oacute;n</option>
              </select>
            </label></td>
            <td width="144"><label>
              <input name="texto" type="text" id="texto" onKeyUp="cargar_datos()" >
            </label></td>
            <td width="328"><input type="submit" name="Submit" value="Buscar" onClick="cargar_datos()">
            <input name="tempauxprod" type="hidden" id="tempauxprod" value="productos" >
            <input  type="hidden" name="codArea" id="codArea"></td>
          </tr>
        </table>
      </form>	  </td>
    </tr>
    <tr><td height="23"  colspan="8"><div id="resultado"></div><div id="paginacion"></div></td></tr>
    <tr >
      <td height="25" colspan="8" align="center" class="EstiloTexto1">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="8">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="8">&nbsp;</td>
    </tr>
</table>
   <div id="sucursal" style="position:absolute; left:198px; top:100px; width:350px; height:180px; z-index:1; visibility:hidden"> </div>
       <div id="auxiliares" style="position:absolute; left:274px; top:215px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>

  

</body>
<script>

function editar(cod){
//alert(cod);
	//if(confirm('Esta seguro que desea editar esta unidad puede tener productos relacionados')){
doAjax('new_factUtil.php','accion=e&cod='+cod,'nuevo_suc','get','0','1','','');
//}
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
function validar(){
if(document.getElementById('auxiliares').style.visibility!='visible'){
var total=document.form1.elements.length;
//alert(total);
var nomcampo="";
for (a=0;a<total;a++){
//alert(a+"--"+document.form1.elements[a].value+"--"+document.form1.elements[a].id);
var elem=document.getElementById(document.form1.elements[a].id);
elem.style.backgroundColor='';

	if(document.form1.elements[a].value==""  ){
	
		nomcampo=document.form1.elements[a].id;
		break;
	}
}
if(nomcampo!=""){

alert("El campo "+nomcampo+" falta ingresar o no cumple con los requisitos");
var elem=document.getElementById(nomcampo);
elem.style.backgroundColor='#FFFF00';
elem.focus();
return false;
}
}else{
return false;
}
}

function cargar_datos(pag){
var cond=document.formbuscar.tipo.value;
var texto=document.formbuscar.texto.value;
//alert(texto);
doAjax('callmetodos.php','condicion='+cond+'&texto='+texto+'&pag='+pag+'&peticion=tblFactUtil','view_det','get','0','1','','');
}

function cargar_datos2(pag){
var cond=document.formbuscar.tipo.value;
var texto=document.formbuscar.texto.value;
var codArea=document.formbuscar.codArea.value;
doAjax('callmetodos.php','condicion='+cond+'&texto='+texto+'&pag='+pag+'&peticion=lisProxArea&codArea='+codArea,'view_det2','get','0','1','','');
}



function view_det(texto){
var r = texto.split('|');
document.getElementById('resultado').innerHTML=r[0];
document.getElementById('paginacion').innerHTML=r[1];

}

function view_det2(texto){
var r = texto.split('|');
document.getElementById('resultado2').innerHTML=r[0];
document.getElementById('paginacion2').innerHTML=r[1];
}
function mostrar_combos(){
	document.getElementById('tipo').style.visibility='visible';
}
	
	
function ocultar_combos(){
	document.getElementById('tipo').style.visibility='hidden';
	
}



function cambiar_fondo(control,evento){

	if(evento=='e')
	control.style.backgroundImage='url(../imagenes/boton_aplicar2.gif)';
	else
	control.style.backgroundImage='url(../imagenes/boton_aplicar.gif)';

}


function cerrar_capa(){
	var arrayCodProc;
	
	//alert(document.formVenProcesos.chkProcesos.length);
	
	for(var i=0;i<document.formVenProcesos.chkProcesos.length;i++){
		if(document.formVenProcesos.chkProcesos[i].checked){
		arrayCodProc=arrayCodProc+"|"+document.formVenProcesos.chkProcesos[i].value;
		}
		
	}
	var pag;
	var cond=document.formbuscar.tipo.value;
	var texto=document.formbuscar.texto.value;
	var codArea=document.formbuscar.codArea.value;
	doAjax('callmetodos.php','condicion='+cond+'&texto='+texto+'&pag='+pag+'&peticion=lisProxArea&codArea='+codArea+'&arrayCodProc='+arrayCodProc+'&accion=addProc','view_det2','get','0','1','','');
	
	
}

function editarText(obj){
}


function editarRow(idProcxArea,obj){

obj.parentNode.parentNode.cells[0].childNodes[0].readOnly=false;
obj.parentNode.parentNode.cells[0].childNodes[0].style.background="#FFFFFF";
obj.parentNode.parentNode.cells[0].childNodes[0].style.border=" solid 1px";

obj.parentNode.parentNode.cells[3].childNodes[0].readOnly=false;
obj.parentNode.parentNode.cells[3].childNodes[0].style.background="#FFFFFF";
obj.parentNode.parentNode.cells[3].childNodes[0].style.border=" solid 1px";

obj.parentNode.parentNode.cells[4].childNodes[0].readOnly=false;
obj.parentNode.parentNode.cells[4].childNodes[0].style.background="#FFFFFF";
obj.parentNode.parentNode.cells[4].childNodes[0].style.border=" solid 1px";

obj.parentNode.parentNode.cells[5].childNodes[0].disabled=false;
obj.parentNode.parentNode.cells[6].style.display="none";
obj.parentNode.parentNode.cells[7].style.display="block";

//obj.parentNode.parentNode.cells[5].childNodes[0].disabled=false;

//alert(obj.parentNode.parentNode.cells[6].childNodes[0].innerHTML);

}

function saveRow(idProcxArea,obj){

	obj.parentNode.parentNode.cells[0].childNodes[0].readOnly=true;
	obj.parentNode.parentNode.cells[0].childNodes[0].style.background="none";
	obj.parentNode.parentNode.cells[0].childNodes[0].style.border="none";
	
	obj.parentNode.parentNode.cells[3].childNodes[0].readOnly=true;
	obj.parentNode.parentNode.cells[3].childNodes[0].style.background="none";
	obj.parentNode.parentNode.cells[3].childNodes[0].style.border="none";
	
	obj.parentNode.parentNode.cells[4].childNodes[0].readOnly=true;
	obj.parentNode.parentNode.cells[4].childNodes[0].style.background="none";
	obj.parentNode.parentNode.cells[4].childNodes[0].style.border="none";
	
	obj.parentNode.parentNode.cells[5].childNodes[0].disabled=true;
	obj.parentNode.parentNode.cells[6].style.display="block";
	obj.parentNode.parentNode.cells[7].style.display="none";
	
    var orden=obj.parentNode.parentNode.cells[0].childNodes[0].value;
	var costo1=obj.parentNode.parentNode.cells[3].childNodes[0].value;
	var costo2=obj.parentNode.parentNode.cells[4].childNodes[0].value;
	var cCosto=obj.parentNode.parentNode.cells[5].childNodes[0].value;
	
	var pag;
	var cond=document.formbuscar.tipo.value;
	var texto=document.formbuscar.texto.value;
	var codArea=document.formbuscar.codArea.value;
	
	var arrayCodProc=idProcxArea+"|"+costo1+"|"+costo2+"|"+cCosto+"|"+orden;
	
	doAjax('callmetodos.php','condicion='+cond+'&texto='+texto+'&pag='+pag+'&peticion=lisProxArea&codArea='+codArea+'&arrayCodProc='+arrayCodProc+'&accion=editProc','view_det2','get','0','1','','');
	
	
}
function deleteRow(idProcxArea,obj){

	var pag;
	var cond=document.formbuscar.tipo.value;
	var texto=document.formbuscar.texto.value;
	var codArea=document.formbuscar.codArea.value;
	doAjax('callmetodos.php','condicion='+cond+'&texto='+texto+'&pag='+pag+'&peticion=lisProxArea&codArea='+codArea+'&arrayCodProc='+idProcxArea+'&accion=deleteProc','view_det2','get','0','1','','');
	
	
}


</script>
</html>
