<?php
include("../conex_inicial.php");
?>
	<script language="javascript" src="miAJAXlib2.js"></script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
}
-->
</style>
</head>
<body onload="cargar_detalle('')">
<form name="form1" id="form1">
<table width="950">
  <tr>
    <td align="center"><table width="850">
      <tr>
        <td width="157" align="right"><input type="hidden" name="fecha1" value="<?php echo $_REQUEST['fecha1'] ?>" id="fecha1" />
		<input type="hidden" name="fecha2" value="<?php echo $_REQUEST['fecha2']?>" id="fecha2" />
		<input type="hidden" name="sucursal" value="<?php echo $_REQUEST['sucursal']?>" id="sucursal" />
			<input type="hidden" name="auxiliar" value="<?php echo $_REQUEST['cliente']?>" id="auxiliar" />
		<input type="hidden" name="almacen" value="<?php echo $_REQUEST['almacen'] ?>" id="almacen" />
		<input type="hidden" name="todosaux" value="<?php echo $_REQUEST['todosaux']?>" id="todosaux" />
		<input type="hidden" name="agruparc" value="<?php echo $_REQUEST['agruparc']?>" id="agruparc" />
			<input type="hidden" name="agruparf" value="<?php echo $_REQUEST['agruparf']?>" id="agruparf" />		</td>
        <td width="681" align="right"><table width="120px" border="0" cellspacing="0" cellpadding="0">
          <tr style="font-family:Arial, Helvetica, sans-serif; font-size:10px">
            <td width="41" align="right" valign="top"><span class="Estilo1">Fecha</span><span class="Estilo1">:</span></td>
            <td width="79"><?php echo date('d-m-Y')?> </td>
          </tr>
          <tr style="font-family:Arial, Helvetica, sans-serif; font-size:10px">
            <td align="right"><span class="Estilo1">Hora</span><span class="Estilo27">:</span></td>
            <td><?php echo date('H:i:s A')?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="3" align="center"><table width="269" height="38" border="0" cellpadding="0" cellspacing="0">
            <tr style="font-family:Arial, Helvetica, sans-serif; font-size:12px">
              <td align="center"><span class="Estilo27"> <strong>DETALLE DE VENTAS POR CLIENTE </strong></span> </td>
            </tr>
            <tr style="font-family:Arial, Helvetica, sans-serif; font-size:10px">
              <td align="center"><?php 
			  $sucursal=$_REQUEST['sucursal'];
			  if($sucursal=='0'){
			  $sql="select * from sucursal";
			  }else{
			  $sql="select * from sucursal where cod_suc='".$sucursal."'";
			  }
			  
			  $resultado=mysql_query($sql,$cn);
			 while($row=mysql_fetch_array($resultado)){
			 $sucursales=$sucursales.$row['des_suc'].",";
			 }
			  //echo $row['des_suc'];
			  echo $sucursales2=substr($sucursales,0,strlen($sucursales)-1);
			  ?></td>
            </tr>
            <tr style="font-family:Arial, Helvetica, sans-serif; font-size:10px">
              <td align="center"><?php 
			  if($sucursal=='0'){
			  $sql="select * from tienda";
			  }else{
			  $sql="select * from tienda where cod_suc='".$sucursal."'";
			  }
			  $resultado=mysql_query($sql,$cn);
			  while($row=mysql_fetch_array($resultado)){
			  $tiendas=$tiendas.$row['des_tienda'].",";
			  }
			  echo $tiendas2=substr($tiendas,0,strlen($tiendas)-1);
			  ?></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="3" align="center"><table width="300">
            <tr style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">
              <td width="41" class="Estilo1">Desde</td>
              <td width="86" class="Estilo1"><?php echo $_REQUEST['fecha1'] ?></td>
              <td width="38" class="Estilo1">Hasta:</td>
              <td width="115" class="Estilo1"><?php echo $_REQUEST['fecha2']?></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="3" align="center"><div style="width:760px; height:300px;" id="detalle"><!--<br />-->
        </div></td>
      </tr>
      <tr>
        <td colspan="3" align="center"> <div id="paginacion" style="width:760px; height:20px;">
		 	     
		  </div>
</td>
      </tr>
      <tr>
        <td colspan="3" align="center"></td>
      </tr>
      <tr>
        <td colspan="2" align="center"></td>
      </tr>
      <tr>
        <td colspan="2" align="center"></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
</body>
</html>
<script language="javascript">
function cargar_detalle(pagina){

	var todosaux=document.form1.todosaux.value
	var agruparc=document.form1.agruparc.value
	var agruparf=document.form1.agruparf.value;
	var sucursal=document.form1.sucursal.value;
	var almacen=document.form1.almacen.value;
	var fecha1=document.form1.fecha1.value;
	var fecha2=document.form1.fecha2.value;
	var auxiliar=document.form1.auxiliar.value;
	alert(sucursal);
	alert(almacen);

	doAjax('det_ventasxcliente.php','fecha1='+fecha1+'&fecha2='+fecha2+'&sucursal='+sucursal+'&almacen='+almacen+'&auxiliar='+auxiliar+'&todosaux='+todosaux+'&agruparc='+agruparc+'&agruparf='+agruparf+'&pagina='+pagina,'view_det','get','0','1','','');
}
	function view_det(texto){

var r = texto.split('?');
document.getElementById('detalle').innerHTML=r[0];
document.form1.carga.value='N';
document.getElementById('paginacion').innerHTML=r[1];

}
</script>