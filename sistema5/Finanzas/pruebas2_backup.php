<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script language="javascript" src="miAJAXlib3.js"></script>
<script language="javascript">
function CargarCuentas(cod){
	alert(cod);
}
function CargarCliente(pag){
	var tipo="<?php echo $_REQUEST['tipo'];?>";
	//var sucursal=document.getElementById('sucursal').value;
	var sucursal="1";
	//var estado=document.getElementById('estado').value;
	var estado="0";
	//var cmbmoneda=document.getElementById('cmbmoneda').value;
	var cmbmoneda="01";
	//var fecha1=document.getElementById('fec1').value;
	var fec1="15-06-2013";
	//var dias=document.getElementById('dias').value;
	var dias="7";
	doAjax('Consultas_reporte.php','&tipo='+tipo+'&sucursal='+sucursal+'&estado='+estado+'&moneda='+cmbmoneda+'&pagina='+pag+'&fec1='+fec1+'&dias='+dias+'&modulo=rptletvenc&operacion=ListarClientes','Rpta_datos','get','0','1','clientes1','');
}
function Rpta_datos(texto){
	//alert(texto);
	var datos=texto.split("|");
	//alert(datos[1]);
	//alert(datos[2]);
	//alert(datos[3]);
	document.getElementById('clientes1').innerHTML=datos[2];
	document.getElementById('clientes2').innerHTML=datos[3];
	document.getElementById('progra').innerHTML=datos[1];
	/*var x=document.getElementById('codig').value;
	var tipo="<?php //echo $_REQUEST['tipo'];?>";
	var sucursal="1";
	var estado="0";
	var cmbmoneda="01";
	var fec1="15-06-2013";
	var dias="15";
	doAjax('Consultas_reporte.php','&tipo='+tipo+'&sucursal='+sucursal+'&estado='+estado+'&moneda='+cmbmoneda+'&fec1='+fec1+'&dias='+dias+'&modulo=rptletvenc&operacion=ConsultaPendiente&codigo='+x+'&pos=0','Rpta_datos2','get','0','1','','');*/
}
/*function Rpta_datos2(texto){
	alert(texto);
	var datos=texto.split("|");
	//alert(datos[0]);
	document.getElementById(datos[0]).innerHTML=datos[1];
	var x=document.getElementById('codig').value;
	var tipo="<?php //echo $_REQUEST['tipo'];?>";
	var sucursal="1";
	var estado="0";
	var cmbmoneda="01";
	var fec1="15-06-2013";
	var dias="7";
	alert(datos[2]+"-"+datos[3]);
	if(datos[2]<datos[3]){
		var control="progra"+datos[2];
		doAjax('Consultas_reporte.php','&tipo='+tipo+'&sucursal='+sucursal+'&estado='+estado+'&moneda='+cmbmoneda+'&fec1='+fec1+'&dias='+dias+'&modulo=rptletvenc&operacion=ConsultaPendiente&codigo='+x+'&pos='+datos[2],'Rpta_datos2','get','0','1',control,'');
	}
}*/
function view_doc(trep,cliente,fecha){
	var tipo="<?php echo $_REQUEST['tipo'];?>";
	var sucursal="1";
	var estado="0";
	var cmbmoneda="01";
	window.open('view_deuda.php?tipo='+tipo+'&cliente='+cliente+'&trep='+trep+'&fecha='+fecha+'&sucursal='+sucursal+'&estado='+estado+'&cmbmoneda='+cmbmoneda,'deuda','toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=790, height=500, left=200, top=100');
	//var fec1=fecha;
	//var dias="7";
	//alert(datos[2]+"-"+datos[3]);
}
</script>
</head>

<body onload="CargarCliente('0')">
<table border="1">
<tr style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
	<td>&nbsp;</td>
    <td align="center">Dias</td>
</tr>
<tr style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
	<td align="center">Cliente</td>
    <td align="center"><div id='progra'></div></td>
</tr>
<tr>
	<td><div id='clientes1'></div></td>
    <td><div id='clientes2'></div></td>
</tr>

</table>
</body>
</html>