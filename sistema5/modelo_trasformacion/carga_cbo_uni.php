<?php 
session_start();
include('../conex_inicial.php');

		$producto=$_REQUEST['producto'];
		$unidad_p=$_REQUEST['uni_p'];
		$factor_p=$_REQUEST['factor_p'];
		$precio_p=$_REQUEST['precio_p'];
		$tipo=$_REQUEST['tipo'];
		$id=$_REQUEST['id'];
		
		 $resultados1 = mysql_query("select * from unidades where id='$unidad_p' ",$cn); 
		 $row1=mysql_fetch_array($resultados1);
		 $des_uni_p=$row1['descripcion'];
		 //echo $des_uni_p;	
?>


<select  name="<?=$id;?>" id="<?=$id;?>" style="width:140px" 
<? if ($tipo=='modelo'){?>

<? }else {?>
onchange="javascript:calculos_pretot();document.formulario.cantidad.select();document.formulario.cantidad.focus();" >
<? } ?>
			<option style="background:#CCCCCC"  value="<?php echo $unidad_p ?>"><?php echo substr($des_uni_p,0,10)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".number_format($precio_p,3,'.','') ?></option>
			
		       <?php 
		
 			 $resultados1 = mysql_query("select * from unixprod where producto='$producto' order by id ",$cn); 
			while($row1=mysql_fetch_array($resultados1))
			{
			  ?>
              <option value="<?php echo $row1['unidad'] ?>"><?php echo substr($row1['des_uni'],0,10)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".number_format($row1['precio'],2,'.','') ?></option>
            
			<?php }?>
			  
			  
 </select>
<?
					/*$strSQLUniRK="select * from unixprod where producto='$producto' and unidad='04'";
					$resul_unid=mysql_query($strSQLUniRK,$cn);
					$rowUnid=mysql_fetch_array($resul_unid);
					echo $factorsubund=$rowUnid['factor'];*/
?>