<table id="lista_productos" width="732" height="24" border="0" cellpadding="0" cellspacing="0">
  <?php 
			include('../conex_inicial.php');
			
			$valor=$_REQUEST['valor'];
			$criterio=$_REQUEST['criterio'];
			$tip=$_REQUEST['tipo'];			
			if($tip==1){
				$tipo="P";
			}else{
				$tipo="C";
			}
			
			if($criterio=='codcliente'){
			
			$valor=str_pad($valor,6,"0",STR_PAD_LEFT);
			$strSQL="select * from cliente where (tipo_aux='".$tipo."' or tipo_aux='A') and $criterio='$valor' order by razonsocial";
			
			}else{
				$strSQL="select * from cliente where (tipo_aux='".$tipo."' or tipo_aux='A') and $criterio like '%$valor%' order by razonsocial";
			}
			//echo $strSQL;
			$resultado=mysql_query($strSQL,$cn);
			while($row=mysql_fetch_array($resultado)){
 ?>
 
  <tr bgcolor="#E9F3FE" onClick="entrada(this)">
    <td width="55" align="center">
	<input style=" border:none; background:none; " type="checkbox" name="xproducto" value="<?php echo $row['codcliente']?>" /></td>
    <td width="150" align="center"><?php echo $row['codcliente']?></td>
    <td width="251" style=" color:#333333"><?php echo $row['razonsocial']?></td>
    <td width="272"><?php echo $row['ruc'] ?></td>
  </tr>
  <?php }?>
</table>

<input style="border: 0px; background-color:#F9F9F9; visibility:hidden " type="checkbox" name="xproducto" value="" />

	<!--<input style="border: 0px; background-color:#F9F9F9; " type="checkbox" name="chk[]" value="<?php // echo $row['idProducto']?>" />-->