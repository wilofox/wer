<div id="detalle" style="width:805px; height:250px; overflow:auto; padding-left:5px;"  >
<table id="lista_aux" width="783" border="0" cellpadding="0" cellspacing="1">
	  
	   <?php  
	
	
	//-------------------------------------------
	
  $resultados = mysql_query("select * from cliente where tipo_aux='$tipo_aux' or tipo_aux='A'  order by codcliente limit 50 ",$cn);
			 // echo "resultado".$resultado;
	  
while($row=mysql_fetch_array($resultados))
{

	$j++;
				if($j%2==0){
				$color_row='#E9F3FE';
				}else{
				$color_row='#FFFFFF';
				}
				
 ?>
  
         
	  <tr bgcolor="<?php echo $color_row?>" onClick="entrada(this)">
	   
	    <td width="27" align="center"><input style="border: 0px; background:none; " type="radio" name="xaux" value="<?php  echo $row['codcliente']?>" /></td>
		  
          <td width="47"><span class="Estilo12"><?php echo $row['codcliente'];?></span></td>
          <td width="200"><span class="Estilo12"><?php echo substr($row['razonsocial'], 0, 25) ?></span></td>
          <td width="35"><span class="Estilo12"><?php if ($row['t_persona']==1){ echo 'JUR.'; }else{echo 'NAT.';} ?></span></td>
          <td width="75" ><span class="Estilo12"><?php echo $row['ruc'];?></span></td>
          <td width="64"><span class="Estilo12"><?php echo $row['doc_iden'];?></span></td>
          <td width="200"><span class="Estilo12"><?php echo substr($row['direccion'], 0, 25) ?></span></td>
          <td width="84"><span class="Estilo12"><?php echo $row['telefono'];?></span></td>
          <td width="51"><div align="center"><span class="Estilo12"><?php echo $row['baja'];?></span></div></td>
    </tr>
		
		<?php  
  
  }
  mysql_free_result($resultados);
  
  ?>
</table>
</div>