<?
$codigo = $_REQUEST['CodDoc'];
$Valor = $_REQUEST['Fun'];
session_start();
include("../conex_inicial.php");
include('../funciones/funciones.php');
		
	$fec1=$_REQUEST['fec1'];
	$txtMoti=$_REQUEST['txtMoti'];
	$txtObsr=$_REQUEST['txtObsr'];
	$ventana=$_REQUEST['ventana'];
	

if($_REQUEST['accion']=='O'){
		$strSQL02=" UPDATE  modelo SET obs='".$txtObsr."' WHERE cod_mod='".$codigo."'  ";
	mysql_query($strSQL02,$cn);
}
if($_REQUEST['accion']=='OF'){
	$strSQL02=" UPDATE  oferta SET obs='".$txtObsr."' WHERE cod_ofe ='".$codigo."'  ";
	mysql_query($strSQL02,$cn);
}
if($_REQUEST['accion']=='A'){
	
// obtenemos los datos del archivo 
	$tamano = $_FILES["archivo"]['size'];
	$tipo = $_FILES["archivo"]['type'];
	$archivo = $_FILES["archivo"]['name'];
	$prefijo = substr(md5(uniqid(rand())),0,6);
	
	if ($archivo != "") {
		// guardamos el archivo a la carpeta files
		$destino =  "files/".$prefijo."_".$archivo;
		if (copy($_FILES['archivo']['tmp_name'],$destino)) {
			$status = "Archivo subido: <b>".$archivo."</b>";
		//Actualizar data
		$strSQL02=" UPDATE  modelo SET archivo='".$destino."' WHERE cod_mod='".$codigo."'  ";
		
		mysql_query($strSQL02,$cn);
		} else {
			$status = "Error al subir el archivo";
		}
	} else {
		$status = "Error al subir archivo";
	}

}
	// cargara datos 
	if ($ventana=='oferta'){
		$atc='F';
		$SQL="select * from oferta where cod_ofe='".$codigo."' ";
	}else{		
		$SQL="select * from modelo where cod_mod='".$codigo."' ";
	}
	
	$Resul=mysql_query($SQL,$cn);
	$rowC=mysql_fetch_array($Resul);
	//echo $rowC['obs1'];	
	
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>
<title>:::PROLYAMRP::::</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 11px;
}
.Estilo10 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
	color: #0066CC;
}
.Estilo11 {color: #FFFFFF}
-->
</style></head>

<script type="text/javascript" src="../javascript/mover_div.js"></script>
<script language="javascript" src="../miAJAXlib2.js"></script>

<link href="../styles.css" rel="stylesheet" type="text/css">
<script>
function guardar(Valor){
	document.formulario.accion.value=Valor;
	document.formulario.submit();
}
function Cerrar(){
	//window.opener.location=window.opener.location;
	window.parent.opener.cargardatos('');
	self.close();
	return false
}

var scrollDivs=new Array();
scrollDivs[0]="productos";

function marcar(){
	if(document.formulario.ckb.checked){
		for(var i=0;i<document.formulario.Ingresos.length;i++){
		document.formulario.Ingresos[i].checked=true;
		}	
	}else{
			for(var i=0;i<document.formulario.Ingresos.length;i++){
			document.formulario.Ingresos[i].checked=false;
			}		
	}

}
function Estado(){

	Valor='';
	if(document.formulario.ckb.checked){
	Valor=document.formulario.ckb.value;
	}else{
		for(var i=0;i<document.formulario.Ingresos.length;i++){
			if (document.formulario.Ingresos[i].checked){
			Valor=Valor+''+document.formulario.Ingresos[i].value;
			}
		}	
	}
	if (window.opener && !window.opener.closed)
    window.opener.document.form1.Estado.value = Valor;
 	window.parent.opener.cargardatos('');
	window.close();
}

</script>
<body onLoad="carga_div()" onUnload="vaciar_sesiones()">
<br>
<form name="formulario" method="post" action="" enctype="multipart/form-data">
<input name="accion" type="hidden" id="accion" value="" size="5">
  <?	  
	if ($Valor=='OBS'){
?>	 
     <table width="500" border="0">
       <tr>
         <td width="10">&nbsp;</td>
         <td align="center" bgcolor="#F5F5F5"><span class="Estilo10">
		 <? 
		 
		 if ($ventana=='tg' || $ventana='SegCaja'){ 
		 echo 'OBSERVADO';
		 } else { 
		 echo 'ORDEN DE TRABAJO OBSERVADO'; }
		 
		 ?>
		 
		 </td>
         <td width="19">&nbsp;</td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td><table width="343" border="0" align="center">
             <tr>
               <td width="94" valign="top"><span class="Estilo1">Observado : </span></td>
               <td width="239"><label>
                 <textarea name="txtObsr" cols="25" rows="5" id="txtObsr"><?=$rowC['obs'];?></textarea>
               </label></td>
             </tr>
         </table></td>
         <td>&nbsp;</td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td align="center"><input type="button" name="Submit2" value="     Guardar    " onClick="guardar('O<?=$atc;?>')">
      <input type="button" name="Submit22" value="     Cancelar   " onClick="Cerrar()"></td>
         <td>&nbsp;</td>
       </tr>
     </table>
  <?
   }elseif ($Valor=='ADJ'){
  ?>
     <table width="500" border="0">
       <tr>
         <td width="10">&nbsp;</td>
         <td align="center" bgcolor="#F5F5F5"><span class="Estilo10"><? if ($ventana=='tg'){ 
		 echo 'ADJUNTAR DOCUMENTO';
		 } else { 
		 echo 'ADJUNTAR DOCUMENTO A ORDEN DE TRABAJO'; }?></td>
         <td width="19">&nbsp;</td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td><table width="360" border="0" align="center">
             <tr>
               <td width="99"><span class="Estilo1">Adjuntar archivo  : </span></td>
               <td width="251">
			   <input name="archivo" type="file" id="archivo" /></td>
             </tr>
         </table></td>
         <td>&nbsp;</td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td align="center" style="color:#FF0000"><?php echo $status;?></td>
         <td>&nbsp;</td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td align="center">
		 <input type="button" name="Submit2" value="     Guardar    " onClick="guardar('A')">
      <input type="button" name="Submit22" value="     Cancelar   " onClick="Cerrar()"></td>
         <td>&nbsp;</td>
       </tr>
     </table>
<?
   	  }
   ?>
     <div id="productos" style="position:absolute; left:114px; top:139px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>
</form>
</body>


</html>

<script>
function cambiar_chofer(param){

	doAjax('../peticion_ajax2.php','&peticion=mostrar_chofer&tabla='+param,'listaProd','get','0','1','','');
	
}

function listaProd(texto){
//alert(texto);
//document.getElementById('productos').style.zIndex='100';
document.getElementById('productos').innerHTML=texto;
document.getElementById('productos').style.visibility="visible";
}

function sel_chofer(codigo,nombre){
	
		document.formulario.codprod.value=codigo;
		document.formulario.desprod.value=nombre;
	
salir();
}

function salir(){
document.getElementById('productos').style.visibility="hidden";
document.formulario.cantidad.focus();

}

var temp2="";
	function entrada(objeto){
	//objeto.cells[0].childNodes[0].checked=true;
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
		}
	
}

function busqueda_chofer(pag){

var tabla="P";
var valor=document.formulario.valor_chofer.value;

doAjax('../peticion_ajax2.php','&peticion=buscar_chofer&valor='+valor+'&tabla='+tabla+'&pag='+pag,'mostrar_bus_chofer','get','0','1','','');
}

function cargar_datos(pag){
busqueda_chofer(pag);
}

function mostrar_bus_chofer(texto){
temp=texto.split("~");
document.getElementById('detalle_chofer').innerHTML=temp[0];
document.getElementById('divpagina').innerHTML=temp[1];

}


function insertMat(){

var codprod=document.formulario.codprod.value;
var desprod=document.formulario.desprod.value;
var cantidad=document.formulario.cantidad.value;

doAjax('../peticion_ajax2.php','&peticion=detSalMat&codprod='+codprod+'&desprod='+desprod+'&cantidad='+cantidad,'rspta_detSalMat','get','0','1','','');

}
function rspta_detSalMat(texto){
document.getElementById('detSalMat').innerHTML=texto;
document.formulario.codprod.value="";
document.formulario.desprod.value="";
document.formulario.cantidad.value="";
document.formulario.desprod.focus();

}

function vaciar_sesiones(){

doAjax('../peticion_ajax2.php','&peticion=detSalMat&accion=salir','','get','0','1','','');
}

function eliminar(item){
doAjax('../peticion_ajax2.php','&peticion=detSalMat&accion=eliminar&item='+item,'rspta_detSalMat','get','0','1','','');
}

</script>
