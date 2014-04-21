<?php  include('conex_inicial.php');
include('funciones.php');
?>

<select name="categoria" onchange="cargarsubcat()">
   <?php 
 
	  $clas=$_REQUEST['clas'];
	  
	    $resultados0 = mysql_query("select * from categoria where clasificacion='$clas' order by des_cat ",$cn);
			 //echo "select * from categoria where clasificacion='$clas' order by des_cat ";
			  //echo $marcar;
			  
			  $temp=mysql_num_rows($resultados0);
		
		if($temp>0){
		?>
		<option value="seleccionar">---seleccionar---</option>
		<?php 		
		}else{
		?>	
		<option value="000"></option>

<?php 			  
		}	  
			  
while($row0=mysql_fetch_array($resultados0))
{
		
	  ?>
  <option value="<?php echo $row0['idCategoria']?>"><?php echo caracteres($row0['des_cat'])?></option>
  <?php 
	 }
	  ?>
	  
	
		  
		  
</select>
