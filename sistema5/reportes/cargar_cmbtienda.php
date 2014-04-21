<?php /*?><?php 
include('conex_inicial.php');

$codsuc=$_REQUEST['codsuc'];
?>
 
 <select name="almacen" onfocus="javascript:document.formulario.alm.value='1'">
         <?php 
		
  $resultados1 = mysql_query("select * from tienda where cod_suc='$codsuc' order by des_tienda ",$cn); 
  echo "select * from tienda where cod_suc='$codsuc' order by des_tienda ";
while($row1=mysql_fetch_array($resultados1))
{
		?>
		 
		  <option value="<?php echo $row1['cod_tienda'] ?>"> <?php echo $row1['des_tienda'] ?></option>
         
		     <?php }?>
		  </select><?php */?>
		  
		  
		  <?php 
include('../conex_inicial.php');

$codsuc=$_REQUEST['codsuc'];


//echo "select * from tienda where cod_suc='$codsuc' order by des_tienda";
?>

 <select  style="width:100" name="almacen" onfocus="enfocar_cbo(this);limpiar_enfoque(this)" onChange="cambiar_enfoque(this);">
  <option value="0">Todas</option>
         <?php 
		
  $resultados1 = mysql_query("select * from tienda where cod_suc='$codsuc' order by des_tienda ",$cn); 
 // echo "select * from t0ienda where cod_suc='$codsuc' order by des_tienda";
while($row1=mysql_fetch_array($resultados1))
{
		?>
				 
		  <option value="<?php echo $row1['cod_tienda'] ?>"> <?php echo $row1['des_tienda'] ?></option>
         
		<?php }?>
</select>
	  			  