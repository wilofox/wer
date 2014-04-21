<?php include('conex_inicial.php');
include('funciones.php');
?>

<select name="subcategoria">
  <?php 
  
	  $clas=$_REQUEST['clas'];
	    $resultados0 = mysql_query("select * from subcategoria where categoria='$clas' order by des_subcateg ",$cn);
			//  echo "select * from categoria where clasificacion='$clas' order by des_cat ";
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
  <option value="<?php echo $row0['idsubcategoria']?>"><?php echo caracteres($row0['des_subcateg'])?></option>
  <?php 
	 }
	 
	  ?>
  <script>
  /*
	   var valor1="<?php //echo $clasificacion?>";
     var i;
	 for (i=0;i<document.form1.clasificacion.options.length;i++)
        {
		
            if (document.form1.clasificacion.options[i].value==valor1)
               {
			   
               document.form1.clasificacion.options[i].selected=true;
               }
        
        }*/
	      </script>
</select>
