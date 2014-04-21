<?php session_start();
include('../conex_inicial.php');
?>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo3 {font-size: 11px; font-family: Arial, Helvetica, sans-serif;}
-->
</style>
<?php 
$titu=" style='background:url(../imagenes/aqua-hd-bg.gif)' ";
$titu2=" style='background-image:url(../imagenes/grid3-hrow-over.gif)' ";

$texto=$_POST['data'];

function listar_clasificacion($texto){
$tipo=$_POST['tipo'];
/*	switch($tipo){
		case "clasificacion":
			if($texto!=""){
				$where=" where des_clas like '".$texto."%'";
			}
			$table="clasificacion";
				$order="order by idclasificacion";
		break;
		case "categoria":
			if($texto!=""){
				$where=" where des_cat like '".$texto."%'";
			}
			$table="categoria";
			$order="order by idCategoria";
		break;
		case "subcategoria":
			if($texto!=""){
				$where=" where des_subcateg like '".$texto."%'";
			}
			$table="subcategoria";
			$order="order by idsubcategoria";
		break;
	}*/
$sql="select * from producto where  nombre like '".$texto."%' and concepto='S' and lista='1'";
//echo $sql;
$query=mysql_query($sql);

						 
echo "<table width='100%' id='tblresultado' name='".$tipo."'>";
while($data=mysql_fetch_array($query)){

//if($a%2 != 0){
//$cfila="#7CF385";
//}else{
$cfila="#ffffff";
//}
echo"<tr  bgcolor='".$cfila."' style='background:#ffffff;cursor=pointer' onclick='asignar(\"".$tipo."\",\"".$data['idproducto']."\",\"".$data['nombre']."\")'><td width='60'>".$data['idproducto']."</td><td>".$data['nombre']."</td><td><a href='#' name='ancla".$a."'></a></td></tr>";
$a++;
}
echo "<table>";
}
?>

<table  width="303" height="72" border="1" cellpadding="0" cellspacing="0" bgcolor="#FCE1C5"><!--FFD3B7-->
  <tr>
    <td width="299">
	
	<table width="299" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="4" align="right"></td>
      </tr>
      <tr <?php echo $titu ?> >
        <td width="8" height="23">&nbsp;</td>
        <td width="301" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#333333"><strong>Buscar:</strong></font></td>
        <td colspan="2" onclick="salir()"><font face="Arial, Helvetica, sans-serif" style="text-decoration:underline; font-size:11px; cursor:pointer" color="#0033FF"><strong>x</strong></font></td>
        </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td colspan="3" align="center"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
			
			<!--  
			style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px"
			-->
			
          <tr <?php echo $titu2; ?>>
            <td width="81" height="18" align="center" ><font face="Verdana, Arial, Helvetica, sans-serif" color="#333333" style="font-size:10px" ><strong>C&oacute;digo</strong></font></td>
            <td width="551" ><font face="Verdana, Arial, Helvetica, sans-serif" color="#333333" style="font-size:10px"><strong>Descripci&oacute;n</strong></font></td>
			</tr>
		  
		  
        </table></td>
        </tr>
      <tr>
        <td height="150">&nbsp;&nbsp;</td>
        <td colspan="3" align="left" valign="top"><div id="detalle" style=" height:150px; overflow-y:scroll" ><?php listar_clasificacion($texto) ?></div></td>
        </tr>
      <tr>
        <td colspan="4" height="2"></td>
        </tr>
      
	     <tr>
        <td height="10"></td>
        <td></td>
        <td width="6"></td>
      </tr>
    </table>
    </td>
  </tr>
</table>
