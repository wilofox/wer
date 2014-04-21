<?php 
session_start();
include('miclase.php');
$clase= new miclase('');

if(isset($_POST['accion'])){
//echo "entro";
 $accion=$_POST['accion'];

				$codigo=$_REQUEST['codigo'];
				$nom=$_REQUEST['nombre'];
				$dir=$_REQUEST['direccion'];
				$ruc=$_REQUEST['ruc'];
				$tel=$_REQUEST['telefono'];
				$web=$_REQUEST['web'];
				$lic=$_REQUEST['licencia'];
				$veh=$_REQUEST['vehiculo'];
				$mar=$_REQUEST['marca'];
				$pla=$_REQUEST['placa'];
				$cho=$_REQUEST['schofer'];

				
	 if($accion=='n'){
$clase->new_tra($nom,$dir,$ruc,$tel,$web,$lic,$veh,$mar,$pla,$cho);
	}

	if($accion=='e'){
	
$clase->act_tra($codigo,$nom,$dir,$ruc,$tel,$web,$lic,$veh,$mar,$pla,$cho);
}

}

?>
<script language="javascript" src="../miAJAXlib2.js"></script>
<script type="text/javascript" src="javascript/mover_div.js"></script>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>administradores</title>
<link href="../styles.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="javascript/mover_div.js"></script>
    <script src="../jquery-1.2.6.js"></script>
	  <script src="../jquery.hotkeys.js"></script>
<script>

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
}

function ocultar(){
document.getElementById('sucursal').style.visibility='hidden';
}


	
	function val_letras(e) { // 1
	//alert(e);
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-zñÑ\s]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
	} 
	function val_numeros(e){
	    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[0-9]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
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
 evt.keyCode=0;
	evt.returnValue=false;
graba();
 
  return false; });
  
jQuery(document).bind('keydown', 'f3',function (evt){//jQuery('#_esc').addClass('dirty'); 
evt.keyCode=0;
	evt.returnValue=false;
//	alert("m");
 doAjax('new_transportista.php','accion=n','nuevo_suc','get','0','1','','');
		
return false; });
jQuery(document).bind('keydown', 'esc',function (evt){

//jQuery('#_esc').addClass('dirty'); 
ocultar();
evt.keyCode=0;
	evt.returnValue=false;		
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
-->
</style>
</head>


<body onLoad="cargar_datos(0)">
<?php
	if(isset($_REQUEST['cod'])){
	//echo $_REQUEST['cod'];
	$clase->elim_tra($_REQUEST['cod']);
	}
	?>
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC" >
                         <tr style="background:url(../imagenes/white-top-bottom.gif)">
       <td height="27" colspan="13" style="border:#999999">&nbsp;<span class="Estilo34">Administraci&oacute;n :: Auxiliares :: <span class="Estilo14 Estilo38">Transportista

       </span></span></td>
    </tr>
	<tr>
      <td colspan="7"><table width="99%" height="21" border="0" cellpadding="0" cellspacing="0" style="border-bottom:#CCCCCC solid 1px">
        <tr>
          <td width="88" ><script>
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
              <table title="Grabar [F2]" width="88" height="21" border="0" cellpadding="0" cellspacing="0">

			    <tr  onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer;" onClick="graba()">
                  <td width="1" ></td>
                  <td width="15" ><span class="Estilo112"><img src="../imgenes/revert.png" width="14" height="16"></span></td>
                  <td width="67" ><span class="Estilo112">Grabar<span class="Estilo113">[F2]</span></span></td>
                </tr>
            </table></td>
          <td width="76" ><table title="Nuevo[F3]" width="85" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="javascript: doAjax('new_transportista.php','accion=n','nuevo_suc','get','0','1','','');" >
                <td width="1" ></td>
                <td width="15" align="center" ><span class="Estilo112"><img src="../imagenes/nuevo.gif" width="14" height="16"></span></td>
                <td width="68" ><span class="Estilo112">Nuevo<span class="Estilo113">[F3]</span> </span></td>
              </tr>
          </table></td>
          <td width="79"><table  title="Salir [Esc]"width="82" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="ocultar()" >
                <td width="1" ></td>
                <td width="16" ><img src="../imagenes/salir.JPG"  width="16" height="16" border="0"></td>
                <td width="60" ><span class="Estilo112">Salir<span class="Estilo113">[Esc]</span></span></td>
                <td width="1" ></td>
              </tr>
          </table></td>
          <td width="56">&nbsp;</td>
          <td width="57">&nbsp;</td>
          <td width="51">&nbsp;</td>
          <td width="52">&nbsp;</td>
          <td width="141">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td colspan="4" ><span class="Estilo1"></span></td>
      <td ><span class="Estilo16" >
	  </span></td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td colspan="7"><form name="formbuscar" method="post" action="?" onSubmit="return false"><table width="329" border="0" align="center">
          <tr>
            <td width="51">Buscar:</td>
            <td width="84"><label>
            <select name="tipo" id="tipo">
              <option value="id">C&oacute;digo</option>
              <option value="nombre">Nombre</option>
              <option value="ruc">RUC</option>
              </select>
            </label></td>
            <td width="18"><label>
              <input name="texto" type="text" id="texto">
            </label></td>
            <td width="19"><input type="submit" name="Submit" value="Buscar" onClick="cargar_datos()"></td>
          </tr>
        </table></form></td>
    </tr>
    <tr><td colspan="8"><div id="resultado"></div><div id="paginacion"></div></td></tr>
</table>
   <div id="sucursal" style="position:absolute; left:198px; top:100px; width:350px; height:180px; z-index:1; visibility:hidden"> </div>
       <div id="auxiliares" style="position:absolute; left:274px; top:90px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>

  

</body>
<script>

function editar(cod){
//alert(cod);
doAjax('new_transportista.php','accion=e&cod='+cod,'nuevo_suc','get','0','1','','');
}

function eliminar(cod){

	if(confirm('Esta seguro que desea eliminar este transportista?')){
	location.href='transportista.php?accion=el&cod='+cod;
	//this.form1.submit();
	}
//window.open('editar_producto.php?cod='+cod,'ventana','height=470 width=500');
}

function listaprod(texto){

	var r = texto;
	var valor="";
	var temp_criterio='';
	alert(document.getElementById('auxiliares').innerHTML);
	
	//if(document.form1.tempauxprod.value=='auxiliares'){
	document.getElementById('auxiliares').innerHTML=r;

	
/*	
	document.getElementById('auxiliares').style.visibility='visible';

		alert(texto);
	valor=document.form1.chofer.value; 
	  // alert(temp_busqueda2);
	temp_criterio=temp_busqueda2;
	selec_busq2();
	//}
	
	
	var temp=document.form1.tempauxprod.value;
	var tipomov=document.form1.tipomov.value;
	var tienda;//=document.forms[0].almacen.value;
	var moneda_doc;//=document.forms[0].tmoneda.value;
	//document.formulario.prov_asoc.value
	//alert(temp_criterio);
	doAjax('det_aux_3.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc=&moneda_doc='+moneda_doc,'detalle_prod','get','0','1','','');
				//doAjax('det_aux.php','&clasificacion=1&temp=auxiliares&tipomov='+document.formulario.tipomov.value+'&prov_asoc='+texto,'detalle_prod','get','0','1','','');*/
	
}	


function validartecla(e,valor,temp){


	//var tipomov=document.form1.tipomov.value;
	//document.form1.tempauxprod.value=temp;
	
		if(document.getElementById('auxiliares').style.visibility=='visible'){
		temp_busqueda2=document.formauxiliar.busqueda2.value;
	
		}
	
	var lentexto=document.form1.chofer.value.length;

	if(lentexto>=1){
	
	if ( ( (e.keyCode>=96) && (e.keyCode<=105) || (e.keyCode>=48) && (e.keyCode<=57) )  || ((e.keyCode>=65) && (e.keyCode<=90)) || e.keyCode==8 || e.keyCode==32 ) {
	

		
		
		if(document.getElementById(temp).style.visibility!='visible' ){
	
			doAjax('lista_aux_cho.php','','listaprod','get','0','1','','');
		
		}else{
			var valor="";
			var temp_criterio;
			if(document.form1.tempauxprod.value=='auxiliares'){
			valor=document.form1.cliente.value;
			temp_criterio=temp_busqueda2;
		
			}
	
			var temp=document.form1.tempauxprod.value;
			var tipomov=document.form1.tipomov.value;
	
			
			
		doAjax('det_aux_3.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&criterio='+temp_criterio,'detalle_prod','get','0','1','','');
		
	//	doAjax('det_aux_3.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc='+document.formulario.prov_asoc.value+'&moneda_doc='+moneda_doc,'detalle_prod','get','0','1','','');
		 //alert('entro');
		}
		
		
	}
}else{
salir();
}
}
function validar(){
var total=document.form1.elements.length;

var nomcampo="";
for (a=0;a<total;a++){
//alert(a+"--"+document.form1.elements[a].value+"--"+document.form1.elements[a].id);
var elem=document.getElementById(document.form1.elements[a].id);
elem.style.backgroundColor='';
if(document.form1.elements[a].value=="" && document.form1.elements[a].id!="telefono" && document.form1.elements[a].id!="web"){

nomcampo=document.form1.elements[a].id;
break;
}
}
if(nomcampo!=""){

alert("El campo "+nomcampo+" falta ingresar");
var elem=document.getElementById(nomcampo);
elem.style.backgroundColor='#FFFF00';
elem.focus();
return false;
}
}
function cargar_datos(pag){

var cond=document.formbuscar.tipo.value;
var texto=document.formbuscar.texto.value;
//alert(texto);

doAjax('listtrans.php','condicion='+cond+'&texto='+texto+'&pag='+pag,'view_det','get','0','1','','');

}
function view_det(texto){
//alert(texto);
var r = texto.split('|');
//alert(r[0]);

document.getElementById('resultado').innerHTML=r[0];
//document.form1.carga.value='N';
document.getElementById('paginacion').innerHTML=r[1];

}
</script>
</html>
