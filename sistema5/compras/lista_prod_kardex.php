<table id="lista_productos" width="729" height="24" border="0" cellpadding="0" cellspacing="1">
  <?php 
			include('../conex_inicial.php');
			include('../funciones/funciones.php');
			
			$valor=$_REQUEST['valor'];
			$criterio=$_REQUEST['criterio'];
			
			if($criterio=='cod_prod' ){ //|| $criterio=='idproducto'
				$strSQL="select *  from producto where kardex='S' and ($criterio like '%$valor%' or codanex2 like '%$valor%' or codanex3 like '%$valor%' ) order by nombre";
			}else if($criterio=='idproducto'){
			$valor=str_pad($valor,6,"0",STR_PAD_LEFT);
				$strSQL="select *  from producto where kardex='S' and $criterio='$valor' order by nombre";			
			}else{
				$strSQL="select *  from producto where kardex='S' and nombre like '%$valor%' or idproducto like '%$valor%' order by nombre";
			}
			$strSQL;
			
			$resultado=mysql_query($strSQL,$cn);
			while($row=mysql_fetch_array($resultado)){
 ?>
 
  <tr  onClick="entrada(this)" bgcolor="#FFFFFF" onDblClick="mostrar_kardex()">
    <td width="53" align="center">
	<input style=" border:none; background:none; " type="radio" name="xproducto" value="<?php echo $row['idproducto']?>" />	</td>
    <td width="77" align="center"><?php echo $row['idproducto']?></td>
    <td width="85" align="center" style=" color:#333333"><?php echo $row['cod_prod']?></td>
    <td width="360" style=" color:#333333"><?php echo caracteres($row['nombre'])?></td>
    <td width="148">
		<?php
			$strSQL23="select * from unidades where id='".$row['und']."' ";
			$resultado23=mysql_query($strSQL23,$cn);
			$row23=mysql_fetch_array($resultado23);
			echo $row23['descripcion'];
		?>
	</td>
  </tr>
  <?php }?>
</table>

<input style="border: 0px; background-color:#F9F9F9; visibility:hidden " type="radio" name="xproducto" value="" />

	<!--<input style="border: 0px; background-color:#F9F9F9; " type="checkbox" name="chk[]" value="<?php // echo $row['idProducto']?>" />-->