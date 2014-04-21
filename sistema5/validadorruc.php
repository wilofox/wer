<?php 
$config="No";
//Si = muestra boton 'buscar' (funcion desde buscar);
//No = Funcion con Enter (text);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Validador RUC Prolyam</title>
<script src="miAJAXlib2.js" language="javascript"></script>
<script language="javascript">
function buscar(e){
	if(e.keyCode==13){
	var dato=document.getElementById('txtruc').value;
	document.getElementById('txtraz').value="";
	document.getElementById('txtdir').value="";
		if(dato.length==11){
			if(dato.substring(0,2)>=10 && dato.substring(0,2)<=20){
				doAjax('compras/peticionxcli.php','&opera=buscar&ruc='+dato,'rpta','GET','0','0','','');
			}else{
				alert("Ruc Invalido");
			}
		}else{
			alert('Ruc invalido debe tener 11 digitos');
		}
	}
}
function rpta(texto){
	alert(texto);
	var temp=texto.split("|");
	if(temp[2]=="A"){
		document.getElementById('txtruc').value=temp[0];
		document.getElementById('txtraz').value=temp[1];
		document.getElementById('txtdir').value=temp[3];
		document.getElementById('txttel').value=temp[4];
	}else{
		if(temp[0]=="/small><br/"){
			alert('Ruc no Existe');
		}else{
			if(temp[0].substring(0,6)=="<br />"){
				var res=confirm("Servidor ocupado en estos momentos desea reintentar?");
				var dato=document.getElementById('txtruc').value;
				doAjax('compras/peticionxcli.php','&opera=buscar&ruc='+dato,'rpta','GET','0','0','','');
			}else{
				alert('Ruc en Baja');
			}
		}
	}
}
</script>
</head>

<body onload="document.form1.txtruc.focus();document.form1.txtruc.select();">
<h1> Validador Ruc Prolyam </h1>
<form name="form1" id="form1" method="post">
<table>
<tr>
	<td>Ruc</td>
    <td><input type="text" name="txtruc" id="txtruc" <?php if($config=="No"){ ?> onkeyup="buscar(event)" <?php } ?> />&nbsp;&nbsp;<?php if($config=="Si"){ ?><input type="button" name="btnbuscar" id="btnbuscar" value="buscar" onclick="buscar()" /> <?php } ?></td>
</tr>
<tr>
	<td>Razon Social: </td>
    <td><input type="text" name="txtraz" id="txtraz" /></td>
</tr>
<tr>
	<td>Direccion: </td>
    <td><input type="text" name="txtdir" id="txtdir" /></td>
</tr>
<tr>
	<td>Telefono(s): </td>
    <td><input type="text" name="txttel" id="txttel" /></td>
</tr>
<tr>
	<td colspan="2"><div id="resultado"></div></td>
</tr>
</table>
</form>
</body>
</html>