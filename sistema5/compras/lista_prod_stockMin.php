<?php //session_start();
include('../conex_inicial.php');
if($_REQUEST['formato']=="excel"){
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=excel.xls");
}
			
			$valor=$_REQUEST['valor'];
			$tienda=$_REQUEST['tienda'];
			$sucursal=$_REQUEST['sucursal'];
			$mostrarStock=$_REQUEST['mostrarStock'];
			
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
			
			$strSQL27="select * from tienda where cod_tienda='".$tienda."' ";
			$resultado27=mysql_query($strSQL27,$cn);
			while($row27=mysql_fetch_array($resultado27)){
			 $des_tienda=$row27['des_tienda'];
			 
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
		
	$strSQL="select des_clas,des_cat,des_subcateg ,idproducto,nombre, p.* from producto p ,clasificacion ,categoria ,subcategoria where p.clasificacion=idclasificacion and p.categoria=idcategoria and p.subcategoria=idsubcategoria and $sumsaldos >=0 and (nombre like '%$valor%' or idproducto like '%$valor%' ) and p.baja='N'  group by nombre,idproducto order by idproducto,nombre   ";
			//echo $strSQL;
			$j=0;
			$resultado=mysql_query($strSQL,$cn);
			//echo mysql_num_rows($resultado);
			?>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.Estilo2 {font-family: Arial, Helvetica, sans-serif}
.Estilo5 {font-size: 11px}
-->
</style>

			<table id="lista_productos" width="661" height="20" border="0" cellpadding="0" cellspacing="0" >
			<?php 
			if($_REQUEST['formato']=="excel"){
			?>
			  <tr>
			    <td colspan="7" align="center"><span class="Estilo1">REPOSICI&Oacute;N DE STOCK</span></td>
		      </tr>
			  <tr>
			    <td colspan="3" align="left">Tienda:<?php echo $des_tienda?></td>
		        <td colspan="4" align="right">Fecha:<?php echo date('d-m-Y')?></td>
	          </tr>
			  <tr>
                
				  
			    <td align="center"><span class="texto2 Estilo2 Estilo5"><strong>Cod.</strong></span></td>
			    <td ><span class="texto2 Estilo2 Estilo5"><strong>Descripci&oacute;n</strong></span></td>
			    <td align="center" ><span class="texto2 Estilo2 Estilo5"><strong>Costo</strong></span></td>
			    <td align="center"><span class="texto2 Estilo2 Estilo5"><strong>S.Actual</strong></span></td>
			    <td align="center" ><span class="texto2 Estilo2 Estilo5"><strong>S. Min. </strong></span></td>
			    <td align="center" ><span class="texto2 Estilo2 Estilo5"><strong>S. Rep. </strong></span></td>
			    <td align="center" ><span class="texto2 Estilo2 Estilo5"><strong>S. Exc. </strong></span></td>
		      </tr>
			
			<?php 
			}
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
			 
			 if($mostrarStock==1){
			 	if($row['stockmin']-$tot_saldo>0){
				}else{
				continue;
				}
			 }elseif($mostrarStock==2){
			 	if($tot_saldo-$row['stockmin']>0){
				}else{
				continue;
				}
				 
			 }
			
			?>
			

          
            <tr bgcolor="<?php echo $color_row?>" onclick="entrada(this)" onDblClick="detalle_prod('<?php echo $row['idproducto']?>')">
  
 <?php 
 if($_REQUEST['formato']!="excel"){
 ?>
    <td class="bordeCelda" width="44" align="center" valign="top"><input style="border: 0px; background:none;  " type="radio" name="xproducto" value="<?php echo $row['idproducto']?>" /></td>
<?php } ?>	
	
    <td class="bordeCelda texto1" width="42" align="left" valign="top" ><?php echo $row['idproducto']?></td>
    <td class="bordeCelda texto1" width="289" align="left" valign="top" ><?php echo substr($row['nombre'],0,38)?></td>
    <td class="bordeCelda texto1" width="54" align="right" valign="top"  ><?php 
	if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	echo number_format($row['costoigv1'],4);
	}	
	?></td>
    <td class="bordeCelda texto1" width="64" align="center" valign="top" ><?php 
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
			$Unidad =$row['factor']-(10-$Valor[1]);
			if ($Valor[1]>0){
				echo ' / '.$Unidad ;				
			}			
			
		}else{		
			echo $tot_saldo;	
		}		
	}
	
	
	 ?></td>
    <td class="bordeCelda texto1" width="56" align="center" valign="top">
	
	<?php 
	
	//echo $row['stockmin']
	if($tienda=='0'){
	$filtroTienda=" ";
	}else{
	$filtroTienda=" and tienda='".$tienda."' ";
	}
	
	$stockminimo=0; 
	$strSQL00="select * from stockmintienda where producto='".$row['idproducto']."'".$filtroTienda;
	$resultado00=mysql_query($strSQL00,$cn);
	while($row00=mysql_fetch_array($resultado00)){
	$stockminimo=$stockminimo+$row00['stockmin'];
	}
		
	
	echo $stockminimo;
	?>
	
	</td>
    <td class="bordeCelda texto1" width="55" align="center" valign="top" ><?php 
	if($stockminimo-$tot_saldo>0){
	echo $stockminimo-$tot_saldo;
	}else{
	echo "0";
	}
	?></td>
    <td class="bordeCelda texto1" width="57" align="center" valign="top" >
	
	<?php 
	if($tot_saldo-$stockminimo>0){
	echo $tot_saldo-$stockminimo;
	}else{
	echo "0";
	}
	?></td>
  </tr>
  <?php }?>
</table>
