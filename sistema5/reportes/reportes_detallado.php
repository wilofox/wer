<?php 
session_start();
?>
<?php 
$hostname_conexion = "localhost";
$database_conexion = "panaderia3";
$username_conexion = "root";
$password_conexion = "1";

$cn = mysql_connect($hostname_conexion, $username_conexion, $password_conexion) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database_conexion,$cn);
$sucursal=$_POST['sucursal'];
$sucursales=mysql_fetch_array(mysql_query("Select * from sucursal where cod_suc='$sucursal'"));
?>
<link href="css/webuserestilo.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo3 {
	font-size: 25px;
	color: #0000FF;
}
.Estilo4 {
	font-size: 12px;
	font-weight: bold;
}
-->
</style>

<table border="0" width="100%" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center">Reporte </td>
  </tr>
  <tr>
    <td align="left"><span class="Estilo3">&nbsp;SUCURSAL:<?php echo $sucursales['des_suc'] ?></span></td>
  </tr>
  <tr>
    <td><table width="85%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="11%"><strong>Codigo</strong></td>
        <td width="26%"><strong> Fecha </strong></td>
        <td width="22%"><strong>Documento</strong></td>
        <td width="29%"><strong>Cliente/Proveedor</strong></td>
        <td width="12%"><span class="Estilo4">Ingresos /Egresos </span></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><?php 
	
	?>
	<?php

$tienda=$_POST['tienda'];
$fecha1=$_POST['fecha1'];
$fecha2=$_POST['fecha2'];
$clasificacion=$_POST['cboclasifica'];
$categoria=$_POST['cbocateg'];
$sub_categoria=$_POST['cbosubcateg'];
$chkclasifica=$_POST['chkFiltClasi'];
$chkcategoria=$_POST['chkFiltCate'];
$chksub_categoria=$_POST['chkFiltsubcate'];
if($chkclasifica=="checkbox"){
$query="Select producto.idproducto,producto.cod_prod,producto.nombre,clasificacion.des_clas FROM  producto,clasificacion where productos.clasificacion=clasificacion.idclasificacion  and productos.clasificacion='$clasificacion' order by  idproducto asc ";
}else{
$query="Select  clasifica.des_clas,producto.idproducto,producto.cod_prod,producto.nombre FROM  PRODUCTO  order by  idproducto asc ";
}
 
if($chkcategoria=="checkbox"){
$query="Select  producto.idproducto,producto.cod_prod,producto.nombre,categoria.des_cat  FROM  producto,categoria where productos.categoria=categoria.idCategoria and productos.categoria='$categoria'  order by  idproducto asc ";
}else{
$query="Select producto.idproducto,producto.cod_prod,producto.nombre  FROM  PRODUCTO  order by  idproducto asc ";
} 

if($chksub_categoria=="checkbox"){
$query="Select   producto.idproducto,producto.cod_prod,producto.nombre,subcategoria.des_subcateg  FROM  producto,subcategoria where productos.subcategoria=subcategoria .idsubcategoria and productos.subcategoria='$sub_categoria' order by  idproducto asc ";
}else{
$query="Select   producto.idproducto,producto.cod_prod,producto.nombre,clasificacion.des_clas  FROM  PRODUCTO  order by  idproducto asc ";
}
//
if($chkclasifica=="checkbox" and  $chkcategoria=="checkbox"){
$query="Select   producto.idproducto,producto.cod_prod,producto.nombre,categoria.des_cat,clasificacion.des_clas FROM  producto,clasificacion,categoria where productos.clasificacion=clasificacion.idclasificacion  and productos.categoria=categoria .idcategoria and productos.clasificacion='$clasificacion' and  productos.categoria='$categoria' order by  idproducto asc ";
}else{
$query="Select  * FROM  PRODUCTO  order by  idproducto asc ";
}

if($chkclasifica=="checkbox" and $chkcategoria=="checkbox" and  $chksub_categoria=="checkbox"){
$query="Select   producto.idproducto,producto.cod_prod,producto.nombre,clasificacion.des_clas,categoria.des_cat,subcategoria.des_subcateg  FROM  producto,clasificacion,categoria,subcategoria where productos.clasificacion=clasificacion.idclasificacion and productos.categoria=categoria and productos.subcategoria=subcategoria.idsubcategoria  and productos.clasificacion='$clasificacion' and  productos.categoria='$categoria' and productos.subcategoria='$sub_categoria' order by  idproducto asc ";
}else{
$query="Select  * FROM  PRODUCTO  order by  idproducto asc limit 10";
}

//echo $query;

$exe = mysql_query($query,$cn)or die(mysql_error()); 
while($row_parent = mysql_fetch_array($exe)){ 
$id=$row_parent['idproducto'];

$query2 ="Select det_mov.tipo,det_mov.fechad,cab_mov.cod_ope  ,cab_mov.tienda,cab_mov.Num_doc,cab_mov.serie,cab_mov.fecha,cliente.razonsocial,det_mov.precio,det_mov.cantidad from det_mov,cab_mov,cliente,operacion where (substring(cab_mov.fecha,1,10) between '$fecha1' and '$fecha2') and cab_mov.sucursal='$sucursal' and cab_mov.cod_ope=operacion.codigo and  cab_mov.cliente=cliente.codcliente and  det_mov.cod_cab=cab_mov.cod_cab and det_mov.cod_prod='$id' order by cod_prod asc ";  


//echo $query2."<br>";
$exe2 = mysql_query($query2); 
$reg=mysql_num_rows($exe2);
if ($reg>0){
echo "<table  border='0' cellpadding='0' cellspacing='0'>";
if (!empty($row_parent['clasificacion'])){
 echo "<tr>";
echo "<td>".$row_parent['clasificacion']."</td>"; 
echo "</tr>"; 
}

if (!empty($row_parent['categoria'])){
 echo "<tr>";
echo "<td>"."       ".$row_parent['categoria']."</td>"; 
echo "</tr>"; 
}
if (!empty($row_parent['subcategoria'])){
 echo "<tr>";
echo "<td>"."       ".$row_parent['subcategoria']."</td>"; 
echo "</tr>"; 
}

echo "  <tr>";
echo "<td>".$row_parent['cod_prod']."       ".$row_parent['nombre']."</td>"; 
echo "</tr>";
echo "</br>";
echo "</table>";

echo "<table width='80%' height='14' border='1' cellpadding='0' cellspacing='0' bordercolor='#030303'>";
/*
echo "  <tr>";
 echo "  <th align='center' bordercolor='#F7F7F7' bgcolor='#F7F7F7' class='txtsmall' scope='col'>Almacen</th>";
echo " <th  align='center' bordercolor='#F7F7F7' bgcolor='#F7F7F7' class='txtsmall' scope='col'>Fecha</th>";
echo "  <th align='left' bordercolor='#F7F7F7' bgcolor='#F7F7F7' class='txtsmall' scope='col'>Comprobante</th>";
echo "  <th align='center' bordercolor='#F7F7F7' bgcolor='#F7F7F7' class='txtsmall' scope='col'>Nº Comprobante</th>";
echo "  <th align='center' bordercolor='#F7F7F7' bgcolor='#F7F7F7' class='txtsmall' scope='col'>Auxiliar</th>";
echo "  <th align='center' bordercolor='#F7F7F7' bgcolor='#F7F7F7' class='txtsmall' scope='col'>Cantidad</th>";
echo "  <th align='center' bordercolor='#F7F7F7' bgcolor='#F7F7F7' class='txtsmall' scope='col'>Costo</th>";

 echo " </tr>";
 */ 
while($row_child = mysql_fetch_array($exe2)){ 
	echo "<td align='center' >".$row_child['tienda']."</span>"."</td>";
	echo "<td align='center' valign='middle'>".$row_child['fecha']."</td>";
	echo "<td align='center' >".$row_child['cod_ope']."</span>"."</td>";
	echo "<td align='center' >".$row_child['serie']."-".$row_child['Num_doc']."</span>"."</td>";
	echo "<td align='left' valign='middle'>".$row_child['razonsocial']."</td>";

if ($row_child['tipo']=="1"){
echo "<td align='center' valign='middle'>".$row_child['cantidad']."</td>";
echo "<td align='center' valign='middle'>"."0"."</td>";
}
	
if ($row_child['tipo']=="2"){
echo "<td align='center' valign='middle'>"."0"."</td>";
echo "<td align='center' valign='middle'>".$row_child['cantidad']."</td>";
}	

echo "</tr>";
//	echo "<td align='center' valign='middle'>".$row_child['tipo']."</td>";
//	echo "<td align='center' valign='middle'>".$row_child['cantidad']."</td>"."</tr>";	
}


echo "</table>";
}
}
?>    </td>
  </tr>
</table>

