<?php 
//echo "+".$_GET['valor']."+";
	include('../conex_inicial.php');
	
	$sucursal=$_REQUEST['valor']; 
	
?>
			  
<style type="text/css">
<!--
.Estilo16 {color: #FFFFFF; font-weight: bold; font-size: 11px; font-family: Arial, Helvetica, sans-serif; }
-->
</style>
<table width="250px" border="0" cellpadding="1" cellspacing="1">
  <tr style=" color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:10px">
    <td width="20" align="center" bgcolor="#0066CC"><span class="Estilo16">ok</span></td>
    <td width="46" align="center" bgcolor="#0066CC"><span class="Estilo16">codigo</span></td>
    <td width="174" bgcolor="#0066CC"><span class="Estilo16">Descripci&oacute;n</span></td>
  </tr>
  
  <?php 
    	$sql="SELECT * FROM tienda where cod_suc='$sucursal'  order by cod_tienda asc";
 	$rs=mysql_query($sql,$cn);
	$cont=mysql_num_rows($rs);
	while ($row=mysql_fetch_array($rs)){
  
  ?>
  
  <tr style=" color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:11px">
    <td align="center" bgcolor="#F5F5F5"><input style="background:none; border:none" type="checkbox" name="chk_tiendas[]" id="chk_tiendas" value="<?php echo $row['cod_tienda']; ?>" /></td>
    <td align="center" bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row['cod_tienda']?></span></td>
    <td bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row['des_tienda']?></span></td>
  </tr>

  <?php } 
  
  if($cont==0){
  
  ?>
  
    <tr>
      <td bgcolor="#F5F5F5">&nbsp;</td>
      <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
  </tr>
  <?php 
  }
  ?>
</table> 

