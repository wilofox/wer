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
include('conex_inicial.php');
include('funciones/funciones.php');

$codsuc=$_REQUEST['codsuc'];
if($_REQUEST['kardex']=='s'){
$todas="Todas";
}

//echo $codsuc;
//echo $_POST['sucursal'];
//echo $_GET['sucursal'];

//echo "select * from tienda where cod_suc='$codsuc' order by des_tienda";
?>
 <select  style="width:160" name="almacen2" onfocus="enfocar_cbo(this);limpiar_enfoque(this)" onChange="cambiar_enfoque(this);">
<!-- <option value="0"><?php //echo $todas;?></option>-->

<?php 
    $resultados1 = mysql_query("select * from tienda where cod_suc='$codsuc' order by des_tienda ",$cn);  // echo "select * from t0ienda where cod_suc='$codsuc' order by des_tienda";
while($row1=mysql_fetch_array($resultados1))
{
	$dir_tienda=$dir_tienda.$row1['direccion']."~";
	$cod_tienda=$cod_tienda.$row1['cod_tienda']."~";
?>			 
<option value="<?php echo $row1['cod_tienda'] ?>"> <?php echo $row1['des_tienda'] ?></option>
<?php 
}
?>

</select>

	  			  <input type="hidden" name="dir_tienda2" value="<?php echo htmlspecialchars($dir_tienda) ?>" />
				  <input type="hidden" name="cod_tienda2" value="<?php echo $cod_tienda ?>" />
		  
		  
		  