<?php 
	include('../conex_inicial.php');
	$sucursal=$_REQUEST['valor']; 
?>
	 <script src="../jquery-1.2.6.js"></script>
    <script src="../jquery.hotkeys.js"></script>
	<script src="../mootools-comprimido-1.11.js"></script>
			  
<!--<style type="text/css">
.Estilo16 {color: #FFFFFF; font-weight: bold; font-size: 11px; font-family: Arial, Helvetica, sans-serif; }
</style>
<link href="../styles.css" rel="stylesheet" type="text/css" />-->

	<table width="250px" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="20" align="center" bgcolor="#0066CC"><span class="Estilo16">ok</span></td>
    <td width="46" align="center" bgcolor="#0066CC"><span class="Estilo16">codigo</span></td>
    <td width="174" bgcolor="#0066CC"><span class="Estilo16">Descripci&oacute;n</span></td>
  </tr>
  
  <?php 
  
  	$sql="SELECT * FROM sucursal  order by cod_suc asc";
 	$rs=mysql_query($sql,$cn);
	$cont=mysql_num_rows($rs);
	while ($row=mysql_fetch_array($rs)){
  
  ?>
  
  <tr>
    <td align="center" bgcolor="#F5F5F5"><input style="background:none; border:none" type="checkbox" name="checkbox[]" id="checkbox" value="<?php echo $row['cod_suc']; ?>" /> </td>
    <td align="center" bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row['cod_suc'];?></span></td>
    <td bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row['des_suc'];?></span></td>	
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

