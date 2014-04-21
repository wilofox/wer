<table id="lista_productos"  width='810' border="0" cellpadding="0" cellspacing="0">
  <?php 
			include('../conex_inicial.php');
			include('../funciones/funciones.php');

			$valor=$_REQUEST['valor'];
			$tienda=$_REQUEST['tienda'];
			$sucursal=$_REQUEST['sucursal'];
			
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
			 $tiendas[]=$row22['cod_tienda'];
			}
			//echo $sucursal."<br>";
			//echo $tienda."<br>";
			//print_r($saldos);
			//print_r($tiendas);
 // $strSQL="select *  from producto where kardex='S' and series='S' and  (nombre like '%$valor%' or idproducto like '%$valor%') order by nombre limit 100";
	
	 $strSQL="select des_clas,des_cat,des_subcateg ,idproducto,nombre, p.* from producto p ,clasificacion ,categoria ,subcategoria where p.clasificacion=idclasificacion and p.categoria=idcategoria and p.subcategoria=idsubcategoria and (nombre like '%$valor%' or idproducto like '%$valor%' ) and p.series='S' and p.kardex='S' order by des_clas asc,des_cat asc,des_subcateg asc, nombre ";
			//group by nombre,idproducto  echo $strSQL;
			$j=0;
			$resultado=mysql_query($strSQL,$cn);
			//echo mysql_num_rows($resultado);
			while($row=mysql_fetch_array($resultado)){
			
			if($tienda==0 || $tienda==""){
					$tot_saldo=0;$tot_tiendas="";
					for($i=0;$i<count($saldos);$i++){
						//echo $saldos[$i].'-'.$row[$saldos[$i]].'<br>';	
						$tot_saldo=$tot_saldo+$row[$saldos[$i]];
					}
					for($k=0;$k<count($tiendas);$k++){
						//echo $saldos[$i].'-'.$row[$saldos[$i]].'<br>';	
						if($k==count($tiendas)-1){
							$tot_tiendas=$tot_tiendas.$tiendas[$k];
						}else{
							$tot_tiendas=$tiendas[$k]."','".$tot_tiendas;											
						}
					}
			}else{
				   $campo="saldo".$tienda;
				  $tot_saldo=$row[$campo];
				  $tot_tiendas=$tienda;				   
			 }	
			//echo $tot_saldo."<br/>";
			 if($tot_saldo>0){ 
		 
			 	$j++;
	
				if($j%2==0){
				$color_row='#E9F3FE';
				}else{
				$color_row='#FFFFFF';
				}
	 
			
			?>
  <tr bgcolor="<?php echo $color_row?>" onclick="entrada(this)" onDblClick="detalle_prod('<?php echo $row['idproducto']?>')">
    <td width="31" align="center" valign="top"><input style="border: 0px; background:none;  " type="radio" name="xproducto" value="<?php echo $row['idproducto']?>" /></td>
    <td width="60" align="left" valign="top" class="texto1"><?php echo $row['idproducto']?></td>
    <td width="260" align="left" valign="top" class="texto1"><?php echo substr($row['nombre'],0,50)?></td>
	    <td width="44" align="left" valign="top" class="texto1"><?php echo $tot_saldo ?></td>
    <td  width="380" align="left" valign="top" class="texto1" >
<?php 
			//$strSQL23="select * from series where producto=".$row['idproducto']." and salida='0' order by serie";
			$strSQL23="select fing,s.serie,razonsocial,cm.cod_ope,cm.Num_doc from series s 
inner join cab_mov cm on s.ingreso=cm.cod_cab
inner join cliente c on cm.cliente=c.codcliente			
			where producto=".$row['idproducto']." and salida='0' and s.tienda in('$tot_tiendas') order by fing";
			//echo $strSQL23;
			$resultado23=mysql_query($strSQL23,$cn);
			$x=0;
			echo '<table border="0"  >';
			while($row23=mysql_fetch_array($resultado23)){
			$x++;
			//if($x==1) 
			echo '<tr>';
			//if($x<=3){
			 
	echo '<td width="21%">'.$row23['serie'].'</td>
	<td width="16%">'.formatofecha($row23['fing']).'</td>
    <td width="30%">'.$row23['razonsocial'].'</td>
	<td width="16%">'.$row23['cod_ope']."-".$row23['Num_doc'].'</td>';			 
			// }
			// if($x==3){
			 	 echo '</tr>';
			//	 $x=0;			 
			//}
			}
			echo '</table>';		
		 ?> </td>

  </tr>
  <?php }}?>
</table>
