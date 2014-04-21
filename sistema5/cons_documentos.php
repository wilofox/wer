<?php 
include('conex_inicial.php');
include('funciones/funciones.php');
$valor=$_REQUEST['valor'];

?>

<style type="text/css">
<!--
.Estilo11 {font-family: Arial, Helvetica, sans-serif; color: #FFFFFF; font-weight: bold; font-size: 11px; }
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}

-->
</style>
<table id="lista_docs" width="270" border="0" cellpadding="0" cellspacing="1" style="border:#999999 solid 1px">
  <tr style="background:url(imagenes/bg_contentbase2.gif); background-position:100px 60px">
    <td width="50" height="23" align="center"><span class="Estilo11">ID</span></td>
    <td width="218" align="left"><span class="Estilo11">Documento</span></td>
  </tr>
  
  <?php 
  
		$resultados = mysql_query("select * from operacion where tipo='".$valor."' order by descripcion ",$cn);
		while($row=mysql_fetch_array($resultados))
		{
  
  ?>
  <tr bgcolor="#FFFFFF" onclick="carga_permisos(this.cells[0].innerHTML); entrada(this)" style="cursor:pointer" >
    <td  height="19" align="center" class="texto1" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; font:bold; color:#0033FF;" ><?php echo $row['codigo']; ?></td>
    <td ><span class="texto1"><?php echo caracteres($row['descripcion']); ?></span></td>
  </tr>
  <?php 
  
  }
  ?>
</table>

