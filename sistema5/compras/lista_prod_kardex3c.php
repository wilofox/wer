<?php session_start();
include('../conex_inicial.php');
			
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
			}
				
				
			if($tienda==0){			
				$sumsaldos="( ";
				for($i=0;$i<count($saldos);$i++){
				$sumsaldos=$sumsaldos." + ".$saldos[$i];
				}
				$sumsaldos.=" )";
			}else{
			$sumsaldos="saldo".$tienda;
			}
			//echo $sucursal."<br>";
			//print_r($saldos);
			
		//echo $strSQL="select *  from producto where kardex='S' and  nombre like '%$valor%' or idproducto like '%$valor%' order by nombre limit 100";
		
	$strSQL="select des_clas,des_cat,des_subcateg ,idproducto,nombre, p.* from producto p ,clasificacion ,categoria ,subcategoria where p.clasificacion=idclasificacion and p.categoria=idcategoria and p.subcategoria=idsubcategoria  and (nombre like '%$valor%' or idproducto like '%$valor%' ) group by nombre,idproducto order by idproducto,nombre   ";
			//echo $strSQL;
			$j=0;
			$resultado=mysql_query($strSQL,$cn);
			//echo mysql_num_rows($resultado);
			while($row=mysql_fetch_array($resultado)){
			
			if($tienda==0 || $tienda==""){
					$tot_saldo=0;
					for($i=0;$i<count($saldos);$i++)
						//echo $saldos[$i].'-'.$row[$saldos[$i]].'<br>';	
						$tot_saldo=$tot_saldo+$row[$saldos[$i]];										
			}else{
				   $campo="saldo".$tienda;
				   $tot_saldo=$row[$campo];				   
			 }	
			 
		 
			 	$j++;
				if($j%2==0){
				$color_row='#E9F3FE';
				}else{
				$color_row='#FFFFFF';
				}
			 
			
			?>
			
<table id="lista_productos" width="720" height="20" border="0" cellpadding="0" cellspacing="0" >
  <tr bgcolor="<?php echo $color_row?>" onclick="entrada(this)" onDblClick="detalle_prod('<?php echo $row['idproducto']?>')">
    <td class="bordeCelda" width="46" align="center" valign="top"><input style="border: 0px; background:none;  " type="radio" name="xproducto" value="<?php echo $row['idproducto']?>" /></td>
    <td class="bordeCelda texto1" width="75" align="left" valign="top" ><?php echo $row['idproducto']?></td>
    <td class="bordeCelda texto1" width="282" align="left" valign="top" ><?php echo substr($row['nombre'],0,38)?></td>
    <td class="bordeCelda texto1" width="73" align="left" valign="top"  ><?php 
			$strSQL23="select * from unidades where id='".$row['und']."'";
			$resultado23=mysql_query($strSQL23,$cn);
			$row23=mysql_fetch_array($resultado23);
			echo $row23['nombre'];
			
		 ?></td>
    <td class="bordeCelda texto1" width="71" align="left" valign="top" ><?php 
	$strUni="select * from unixprod where producto='".$row['idproducto']."' ";
	//and unidad='".$row['factor']."'";		
	$resulUni=mysql_query($strUni,$cn);
	$rowUni=mysql_fetch_array($resulUni);
	//echo $tot_saldo;	
	
	if ($rowUni['id']==""){		 
		echo $tot_saldo;		
	}else{
		if ($rowUni['mconv']==""){		 
			$Valor = explode('.',$tot_saldo);
			echo $Valor[0];    //bien 
			//echo $Valor[1];
			//$Unidad =$row['factor']-(10-$Valor[1]);
			$Unidad =$row['factor']*$Valor[1]*$rowUni['factor'];			
			if ($Valor[1]>0){
				echo ' / '.$Unidad ;				
			}			
			
		}else{		
			echo $tot_saldo;	
		}		
	}
	
	
	 ?></td>
    <td class="bordeCelda texto1" width="71" align="left" valign="top"><?php 
	if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	echo number_format($row[$campo_suc],4);
	}	
	?></td>
    <td class="bordeCelda texto1" width="102" align="left" valign="top" ><?php 
	if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	echo number_format($tot_saldo*$row[$campo_suc],2);
	}	
	 ?></td>
  </tr>
  <?php }?>
</table>
