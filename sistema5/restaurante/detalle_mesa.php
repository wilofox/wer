<?php include('conex_inicial.php');


if(isset($_REQUEST['codigo'])){
$codigo=$_REQUEST['codigo'];

$strSQL9="delete from comanda where cod_det='$codigo'";
mysql_query($strSQL9);
}
?>
<style type="text/css">
<!--
.Estilo9 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.Estilo12 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }
.Estilo13 {font-size: 10px}
-->
</style>

<table width="432" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
  <tr>
    <td width="216" height="23" align="left" bgcolor="#CFCFCF"><span class="Estilo9">DESCRIPCION</span></td>
    <td width="50" align="left" bgcolor="#CFCFCF"><span class="Estilo9">PRECIO</span></td>
    <td width="67" align="center" bgcolor="#CFCFCF"><span class="Estilo9">CANT.</span></td>
    <td width="39" align="left" bgcolor="#CFCFCF"><span class="Estilo9">TOTAL</span></td>
    <td width="60" align="center" bgcolor="#CFCFCF"><span class="Estilo9">ACCIONES</span></td>
  </tr>
  <?php 
  
  $mesa=$_REQUEST['mesa'];
  
  $strSQL="select * from comanda where mesa= $mesa and estado='g'";
  $resultado=mysql_query($strSQL,$cn);
  while($row=mysql_fetch_array($resultado)){
  
  $totgen=$totgen+($row['precio']*$row['cantidad']);
    
  ?>
  
  <tr bgcolor="#FCFADC">
    <td height="19" bgcolor="#FDFCE8"><span class="Estilo12"><?php echo $row['nom_prod']?></span></td>
    <td align="right" bgcolor="#FDFCE8"><span class="Estilo12"><?php echo number_format($row['precio'],2)?></span></td>
    <td align="center" bgcolor="#FDFCE8"><span class="Estilo12"><?php echo $row['cantidad']?></span></td>
    <td align="right" bgcolor="#FDFCE8"><span class="Estilo12"><?php  echo number_format(($row['precio']*$row['cantidad']),2)?></span></td>
    <td align="center" bgcolor="#FDFCE8"><span class="Estilo13"><a href="javascript:eliminar('<?php echo $row['cod_det']?>')"><img src="../imgenes/eliminar.gif" width="14" height="14" border="0" /></a></span></td>
  </tr>
  
  <?php 
  }
  
  ?>
  <tr>
    <td bgcolor="#CFCFCF" height="20"></td>
    <td height="20" colspan="2" bgcolor="#CFCFCF"><span class="Estilo9">TOTAL GENERAL </span></td>
    <td height="20" align="right" bgcolor="#CFCFCF"><span class="Estilo12"><?php echo number_format($totgen,2)?></span></td>
    <td bgcolor="#CFCFCF" height="20"></td>
  </tr>
</table>
