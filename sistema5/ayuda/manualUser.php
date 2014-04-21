<?php
session_start();
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Temas de Ayuda</title>
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
	font-size: 12px;
}
.Estilo2 {font-size: 11px}
.Estilo3 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo4 {color: #000000}
-->
</style></head>

	<script src="../jquery-1.2.6.js"></script>
	<script src="../jquery.hotkeys.js"></script>	
	  
	<link  href="../treeview/jquery.treeview.css" rel="stylesheet"/>
	<script src="../treeview/jquery.cookie.js" type="text/javascript"></script>
	<script src="../treeview/jquery.treeview.js" type="text/javascript"></script>
	<script src="../treeview/demo.js" type="text/javascript"></script>

	<script language="javascript" src="../miAJAXlib2.js"></script>
	
<script>
$(document).ready(function(){
		
	// first example
	$("#navigation").treeview({
		collapsed: true,
		unique: true,
		persist: "location"
	});

	
	// second example
	$("#browser").treeview({
		animated:"normal",
		persist: "cookie"
	});

	$("#samplebutton").click(function(){
		var branches = $("<li><span class='folder'>New Sublist</span><ul>" + 
			"<li><span class='file'>Item1</span></li>" + 
			"<li><span class='file'>Item2</span></li></ul></li>").appendTo("#browser");
		$("#browser").treeview({
			add: branches
		});
	});


	// third example
	$("#red").treeview({
		animated: "fast",
		collapsed: true,
		control: "#treecontrol"
	});


});


</script>


<script type="text/javascript" language="javascript">
var tempObj="";
function cargarImg(valor,obj){

try{
tempObj.style.color="#000000";
tempObj.style.fontWeight="";

}catch(e){

}
tempObj=obj;
obj.style.color="#0066FF";
obj.style.fontWeight="bold";
doAjax('peticionajax.php','&valor='+valor+'&peticion=imgAyuda','rpt_cargarImg','get','0','1','','');
}

function rpt_cargarImg(texto){
document.getElementById('panelimg').innerHTML=texto;
}

</script>

<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="274" valign="top">
	
	
	<div style="">
	<table width="300px" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#F9F9F9">
      <tr>
        <td width="273" height="25" align="center" bgcolor="#FCD85C"><span class="Estilo1 Estilo2 Estilo4">Manual  Prolyam </span></td>
      </tr>
      <tr>
        <td height="44" >
		
		<ul id="browser" class="filetree"  >
			<li><span class="folder Estilo_titu_icoC Estilo1 Estilo2">Preguntas Frecuentes </span>
			<ul style="background:#F9F9F9">
			<?php if($_SESSION['nivel_usu']=='1' || $_SESSION['nivel_usu']=='4' || $_SESSION['nivel_usu']=='5'){s ?>
			<li><span  class="file Estilo3" ><a onClick="cargarImg('1', this);" >¿C&oacute;mo registrar una venta?</a></span></li>
			<li><span class="file Estilo3"><a onClick="cargarImg('2', this);" >¿C&oacute;mo registrar nuevos clientes - vendedor?</a></span></li>
			<li><span class="file Estilo3"><a onClick="cargarImg('3', this);" >¿C&oacute;mo agregar descuentos en una venta?</a></span></li>
			<li><span class="file Estilo3"><a onClick="cargarImg('4', this);" >¿C&oacute;mo anular una venta?</a></span></li>
			<li><span class="file Estilo3"><a onClick="cargarImg('5', this);" >¿C&oacute;mo eliminar una venta?</a></span></li>
			<li><span class="file Estilo3"><a onClick="cargarImg('6', this);" >¿C&oacute;mo generar una orden de garant&iacute;a?</a></span></li>
			<li><span class="file Estilo3"><a onClick="cargarImg('7', this);" >¿C&oacute;mo generar una orden de servicio t&eacute;cnico?</a></span></li>
			<li><span class="file Estilo3"><a onClick="cargarImg('8', this);" >¿C&oacute;mo obtener el reporte de ventas de un periodo?</a></span></li>
			<li><span class="file Estilo3"><a onClick="cargarImg('9', this);" >¿C&oacute;mo realizar una transferencia de productos a una tienda?</a></span></li>
			<li><span class="file Estilo3"><a onClick="cargarImg('10', this);" >¿Cómo obtener el reporte de ventas de un cliente?</a></span></li>
			<li><span class="file Estilo3"><a onClick="cargarImg('11', this);" >¿Cómo generar una guia con referencia a una factura?</a></span></li>
			<li><span class="file Estilo3"><a onClick="cargarImg('12', this);" >¿Cómo eliminar una transferencia de productos?</a></span></li>
			<li><span class="file Estilo3"><a onClick="cargarImg('13', this);" >¿Cómo anular una transferencia de productos?</a></span></li>
			<?php }?>
			
			<?php if($_SESSION['nivel_usu']=='2' || $_SESSION['nivel_usu']=='3' || $_SESSION['nivel_usu']=='4' || $_SESSION['nivel_usu']=='5'){?>
			<li><span class="file Estilo3"><a onClick="cargarImg('14', this);" >¿Cómo ingresar productos nuevos?</a></span></li>
			<li><span class="file Estilo3"><a onClick="cargarImg('15', this);" >¿Cómo obtener el reporte de compras de un periodo?</a></span></li>
			<li><span class="file Estilo3"><a onClick="cargarImg('16', this);" >¿Cómo registrar una compra?</a></span></li>
			<li><span class="file Estilo3"><a onClick="cargarImg('17', this);" >¿Cómo registrar nuevos proveedores-almacen?</a></span></li>
			<li><span class="file Estilo3"><a onClick="cargarImg('18', this);" >¿Cómo consultar los movimientos de ingreso y salida de un producto?</a></span></li>
			<li><span class="file Estilo3"><a onClick="cargarImg('19', this);" >¿Cómo consultar los stocks de un producto?</a></span></li>
			<li><span class="file Estilo3"><a onClick="cargarImg('20', this);" >¿Cómo eliminar una compra?</a></span></li>
			<li><span class="file Estilo3"><a onClick="cargarImg('21', this);" >¿Cómo obtener un reporte de inventario valorizado a una fecha?</a></span></li>
			<li><span class="file Estilo3"><a onClick="cargarImg('22', this);" >¿Cómo realizar la transferencia de productos a una tienda?</a></span></li>
			<li><span class="file Estilo3"><a onClick="cargarImg('23', this);" >¿Cómo eliminar una transferencia de productos?</a></span></li>
			<li><span class="file Estilo3"><a onClick="cargarImg('24', this);" >¿Cómo anular una transferencia de productos?</a></span></li>
			
			<li><span class="file Estilo3"><a onClick="cargarImg('25', this);" >¿Cómo registrar nuevos proveedores?</a></span></li>
			<li><span class="file Estilo3"><a onClick="cargarImg('26', this);" >¿Cómo registrar nuevos clientes?</a></span></li>
			<?php } ?>
			
		    </ul>
		
		</li>
		</ul>
		</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
	
	</div>
	
	</td>
    <td width="602" valign="top">
	
	<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="100%" height="397">
		<div id="panelimg" >
				
				
		</div>
		</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

