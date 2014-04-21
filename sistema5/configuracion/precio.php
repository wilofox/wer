<?php 
include('../conex_inicial.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>

<script language="javascript" src="../miAJAXlib2.js"></script>

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
.Estilo14 {
	font-size: 10px;
	font-family: tahoma, verdana, sans-serif;
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
.Estilo7 {color: #747374; font-size: 10px; font-weight: bold; }
.Estilo13 {color: #0767C7}
.Estilo19 {font-family: tahoma, verdana, sans-serif}
.Estilo20 {font-size: 10px}

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

//	objeto.style.background='url(imagenes/sky_blue_sel.png)';
	
	objeto.cells[0].childNodes[0].checked=true;
	
//	temp=objeto;
	if(objeto.style.background=='url(imagenes/sky_blue_sel.png)'){
	//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='url(imagenes/sky_blue_sel.png)';
	
	temp.style.background=temp.bgColor;;
	//'#E9F3FE';
	temp=objeto;
	}

}

function cargar(){
	try {
	/*
		var nombreVariable=document.getElementById('lista_productos').rows[0];
		alert(isset(nombreVariable));
		if(isset(nombreVariable)){
		return false;
		}
	*/
document.getElementById('lista_productos').rows[0].style.background='url(sky_blue_sel.png)';
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


function CargarNomEti(Valor){
//alert(Valor);
/*var prec1=document.form1.prec1.value;
var prec2=document.form1.prec2.value;
var prec3=document.form1.prec3.value;
var prec4=document.form1.prec4.value;
var prec5=document.form1.prec5.value;*/
//var FromEst=document.form1.FromEst.value;
//document.form1.FromEst.value='';
location.href = 'precio.php'; //?frmval='+FromEst+'&prec1='+prec1
}
</script>

<?
//Actualiza todas la etiquetas de los precios

$Precio1 = $_POST['prec1'];
$Precio2 = $_POST['prec2'];
$Precio3 = $_POST['prec3'];
$Precio4 = $_POST['prec4'];
$Precio5 = $_POST['prec5'];

//echo strlen(trim($_POST['prec1']));
if (strlen(trim($_POST['prec1']))==0){
$Precio1 =  'precio 1';
}
if (strlen(trim($_POST['prec2']))==0){
$Precio2 =  'precio 2';
}
if (strlen(trim($_POST['prec3']))==0){
$Precio3 =  'precio 3';
}
if (strlen(trim($_POST['prec4']))==0){
$Precio4 =  'precio 4';
}
if (strlen(trim($_POST['prec5']))==0){
$Precio5 =  'precio 5';
}


//$NomEtiq=$_POST['prec1'].','.$_POST['prec2'].','.$_POST['prec3'].','.$_POST['prec4'].','.$_POST['prec5'];
$NomEtiq=$Precio1.','.$Precio2.','.$Precio3.','.$Precio4.','.$Precio5;

if(isset($_POST['Submit'])){
	if ($NomEtiq<>',,,,'){
	  mysql_query("update config set nom_precio='$NomEtiq' where cod_config='NomEtiPre' ");
	//  echo "update config set nom_precio='$NomEtiq' where cod_config= '".$_REQUEST['NomEtiPre']."'";
	}
 }
//Consulta todos los datos
		$sql=" select * from config  where cod_config='NomEtiPre' ";
		$resultadoX=mysql_query($sql,$cn);
		while($rowX=mysql_fetch_array($resultadoX)){
		//echo $rowX['nom_precio']; 	
		$docuser=$rowX['nom_precio'];
		}	  

 	$ValorEti = explode(',',$docuser);
	//echo $ValorEti[0];



?>
<body onLoad="document.form1.prec1.focus();">

<form id="form1" name="form1" method="post" action="">
  <table width="810" height="404" border="0" cellpadding="0" cellspacing="0">
    
    <tr style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="5" height="23">&nbsp;</td>
      
	   <td width="760" height="25" colspan="11" style="border:#999999">
	  <span class="Estilo100">Administraci&oacute;n :: Configuraci&oacute;n :: Etiqueta de Precio </span>	  <input type="hidden" name="carga" id="carga" value="N">
<input type="hidden" name="carga" id="FromEst" value="NomEtiPre">
	  </td>	  
    </tr>
    <tr>
      <td height="26">&nbsp;</td>
      <td>
	  
	    <table width="99%" height="21" border="0" cellpadding="0" cellspacing="0" style="border-bottom:#CCCCCC solid 1px">
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
	    <table width="553" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        
		
		  <tr>
            <td width="21">&nbsp;</td>
            <td width="71"><strong>Precio 1 : </strong></td>
            <td width="461"><input name="prec1" type="text" id="prec1"  style="height:20; border-color:#CCCCCC" value="<?=$ValorEti[0];?>" size="25" autocomplete="off"></td>
          </tr>
		  
		  
          <tr>
            <td>&nbsp;</td>
            <td><strong>Precio 2 : </strong></td>
            <td><input name="prec2" type="text" id="prec2"  style="height:20; border-color:#CCCCCC" value="<?=$ValorEti[1];?>" size="25" autocomplete="off"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><strong>Precio 3 : </strong></td>
            <td><input name="prec3" type="text" id="prec3"  style="height:20; border-color:#CCCCCC" value="<?=$ValorEti[2];?>" size="25" autocomplete="off"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><strong>Precio 4 : </strong></td>
            <td><input name="prec4" type="text" id="prec4"  style="height:20; border-color:#CCCCCC" value="<?=$ValorEti[3];?>" size="25" autocomplete="off"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><strong>Precio 5 : </strong></td>
            <td><input name="prec5" type="text" id="prec5"  style="height:20; border-color:#CCCCCC" value="<?=$ValorEti[4];?>" size="25" autocomplete="off">
              <label>
              <input type="submit" name="Submit" value="Guardar" onClick="CargarNomEti('EtiPreUpd')">
            </label></td>
          </tr>
      </table>
	  
	  
      </td>
    </tr>
    <tr>
      <td height="211">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="15">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>

<script>

function mostrar_filtro(texto){
document.getElementById('detalle').innerHTML=texto;
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

</script>