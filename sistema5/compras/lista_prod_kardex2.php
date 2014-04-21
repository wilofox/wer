<table id="lista_productos" width="720" height="24" border="0" cellpadding="0" cellspacing="0">
  <?php 
			include('../conex_inicial.php');
			
			$valor=$_REQUEST['valor'];
			$tienda=$_REQUEST['tienda'];
			$sucursal=$_REQUEST['sucursal'];
			$stock=$_REQUEST['stock'];
			
			if($sucursal==0){
			$filtro="";
			$campo_suc='costo_inven1';
			}else{
			$filtro=" where cod_suc='$sucursal' ";
			$campo_suc='costo_inven'.$sucursal;
			}
			
			
			
			$strSQL22="select * from tienda ".$filtro." order by cod_tienda";
			$resultado22=mysql_query($strSQL22,$cn);
			while($row22=mysql_fetch_array($resultado22)){
			$saldos[]="saldo".$row22['cod_tienda'];
			}
			//echo $sucursal."<br>";
			//print_r($saldos);
			
			if($stock == 'true')
			
		$strSQL="select *  from producto where kardex='S' and  nombre like '%$valor%' or idproducto like '%$valor%' order by nombre";
			
			//echo $strSQL;
			$resultado=mysql_query($strSQL,$cn);
			while($row=mysql_fetch_array($resultado)){
			
			if($tienda==0 || $tienda==""){
					$tot_saldo=0;
					for($i=0;$i<count($saldos);$i++)
						$tot_saldo=$tot_saldo+$row[$saldos[$i]];
			}else{
				   $campo="saldo".$tienda;
				   $tot_saldo=$row[$campo];
				   
			 }	
			
			?>
  <tr bgcolor="#E9F3FE" onclick="entrada(this)">
    <td width="35" align="center"><input style="border: 0px; background-color:#F9F9F9; " type="radio" name="xproducto" value="<?php echo $row['idproducto']?>" /></td>
    <td width="79" align="center"><?php echo $row['idproducto']?></td>
    <td width="232"><?php echo $row['nombre']?></td>
    <td width="65"><?php echo "unidades" ?></td>
    <td width="68"><?php echo $tot_saldo ?></td>
    <td width="65"><?php echo $row[$campo_suc] ?></td>
    <td width="90"><?php echo $tot_saldo*$row[$campo_suc] ?></td>
  </tr>
  <?php }?>
</table>
