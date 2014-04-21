<?php 
include("miclase.php");
$clase= new miclase;
//echo date("h:i:s A");
if(isset($_POST['btnexp'])){
$clase->crear_backup();
}
if(isset($_POST['btnimp'])){

$clase->restaurar_backup();
}
if(isset($_POST['btnimptab'])){
if($_POST['cbotabla']!=""){
$clase->restaurar_backup_tab($_POST['cbotabla']);
}else{
	echo "<script>alert('Se debe seleccionar una tabla');location.href='backup.php';</script>";
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
body {
	background-color: #F3F3F3;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
	color:#003366;
	font-weight: bold;
}
.Estilo2 {
	color: #003366;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style>
<script language="javascript" type="text/javascript">
function activar(valor){

if(valor=="exp") {
	document.getElementById('btnexp').disabled=false;
	document.getElementById('rbimptip1').disabled=true;
	document.getElementById('rbimptip2').disabled=true;
	document.getElementById('txtfile').disabled=true;
	document.getElementById('btnimp').disabled=true;
	document.getElementById('txtfiletab').disabled=true;
	document.getElementById('btnimptab').disabled=true;

	
	//document.getElementById('cbotabla').disabled=true;
}//
if(valor=="imp"){
	document.getElementById('btnexp').disabled=true;
	document.getElementById('rbimptip1').disabled=false;
	document.getElementById('rbimptip2').disabled=false;
	if(document.getElementById('rbimptip1').checked){
	document.getElementById('txtfile').disabled=false;
	document.getElementById('btnimp').disabled=false;
	document.getElementById('cbotabla').disabled=true;
	document.getElementById('txtfiletab').disabled=true;
	document.getElementById('btnimptab').disabled=true;
	}
	if(document.getElementById('rbimptip2').checked){
	document.getElementById('txtfile').disabled=true;
	document.getElementById('btnimp').disabled=true;
	document.getElementById('cbotabla').disabled=false;
	document.getElementById('txtfiletab').disabled=false;
	document.getElementById('btnimptab').disabled=false;
	}
	
}
if(valor=="impcomp"){

	document.getElementById('txtfile').disabled=false;
	document.getElementById('btnimp').disabled=false;
	document.getElementById('cbotabla').disabled=true;
	document.getElementById('txtfiletab').disabled=true;
	document.getElementById('btnimptab').disabled=true;
}
if(valor=="imptab"){
	document.getElementById('txtfile').disabled=true;
	document.getElementById('btnimp').disabled=true;
	document.getElementById('cbotabla').disabled=false;
	document.getElementById('txtfiletab').disabled=false;
	document.getElementById('btnimptab').disabled=false;
}
}
</script>
</head>

<body>
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <label></label>
  <table width="484" border="0" align="center" style="font-size:13px;">
      <tr style="background:url(../imagenes/white-top-bottom.gif)">
          <td width="810" height="25" colspan="16" style="border:#999999"><span class="Estilo2">Administraci&oacute;n :: Backup 
              <input type="hidden" name="carga" id="carga" value="N">
        </span></td>
    </tr>
    <tr>
      <td width="20"><label>
        <input name="rbbackup" type="radio" value="exp" checked="checked" onclick="activar(this.value)" />
      </label></td>
      <td width="75"><b>Exportar:</b></td>
      <td>Base de datos completa </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2" align="center"><input name="btnexp" type="submit" id="btnexp" value="Exportar" /></td>
    </tr>
    <tr>
      <td height="31"><label></label></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>

    <tr>
      <td height="31"><input name="rbbackup" type="radio" value="imp" onclick="activar(this.value)"/></td>
      <td><b>Importar</b></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td rowspan="2">&nbsp;</td>
      <td colspan="2"><label>
        <input name="rbimptip" type="radio" id="rbimptip1" value="impcomp" checked="checked"  onclick="activar(this.value)" disabled="disabled"/>
      </label>
      Base de datos completa
      <label></label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="txtfile" type="file" id="txtfile" disabled="disabled" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2" align="center"><input name="btnimp" type="submit" id="btnimp" value="Importar" disabled="disabled"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
	    <tr>
      <td>&nbsp;</td>
      <td colspan="2"><b>
        <label>
        <input id="rbimptip2" name="rbimptip" type="radio" value="imptab"  onclick="activar(this.value)" disabled="disabled"/>
        </label>
        Por tabla:</b> </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label></label>
        Tabla:</td>
      <td><?php $clase->mostrar_tablas() ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left"><input name="txtfiletab" type="file" id="txtfiletab" disabled="disabled" />
      (solo archivos *.csv)</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2" align="center"><input name="btnimptab" type="submit" id="btnimptab" value="Importar" disabled="disabled"/></td>
    </tr>
  </table>
  <label></label>
</form>
</body>
</html>
