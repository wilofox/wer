<?php 
include('../conex_inicial.php');

$codsuc=$_REQUEST['codsuc'];
if($_REQUEST['kardex']=='s'){
$todas="Todas";
}
?>
 <select  style="width:160" name="almacen" onfocus="enfocar_cbo(this);limpiar_enfoque(this)" onKeyUp="cargar_detalle('')" >
  <option value="0"><?php echo $todas;?></option>
         <?php 
		  $resultados1 = mysql_query("select * from tienda where cod_suc='$codsuc' order by des_tienda ",$cn);  // echo "select * from t0ienda where cod_suc='$codsuc' order by des_tienda";
while($row1=mysql_fetch_array($resultados1))
{
		?>			 
<option value="<?php echo $row1['cod_tienda'] ?>"> <?php echo $row1['des_tienda'] ?></option>
         <?php }?>
</select>
	  			  