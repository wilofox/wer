<?php  include('../conex_inicial.php');
?>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
.Estilo2 {font-family: Arial, Helvetica, sans-serif}
.Estilo3 {font-size: 12px}
-->
</style>

 <table width="750" border="0" cellspacing="1" cellpadding="1" style="border:dotted 1px">
    <tr bgcolor="#0066CC">
      <td width="62"><span class="Estilo3 Estilo2 Estilo1 Estilo10"><strong>Codigo
        
      </strong></span></td>
      <td width="76"><span class="Estilo3 Estilo2 Estilo1 Estilo10"><strong>
        <?php 
		$t_persona=$_REQUEST['tipocliente'];
		//echo $t_persona;
				//AKIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII
				if($t_persona=='N'){
				echo "DNI";
					}else{ 
					echo "RUC"; 
				    }
			
			 ?>
      </strong></span></td>
 <?php if($t_persona=='J'){ ?><td width="95"><span class="Estilo3 Estilo2 Estilo1 Estilo10"><strong>Razons Social</strong></span></td> 
 <?php }?>
  <?php if($t_persona=='N'){ ?><td width="79"><span class="Estilo3 Estilo2 Estilo1 Estilo10"><strong>Nombres</strong></span></td>
  <?php }?>
  <?php if($t_persona=='N'){ ?><td width="52"><span class="Estilo3 Estilo2 Estilo1 Estilo10"><strong>Apellidos</strong></span></td>
  <?php } ?>
   <?php if($t_persona=='J'){?><td width="51"><span class="Estilo3 Estilo2 Estilo1 Estilo10"><strong>Contacto</strong></span></td>
   <? }?>
    <?php if($t_persona=='J'){?><td width="44"><span class="Estilo3 Estilo2 Estilo1 Estilo10"><strong>Cargo</strong></span></td>
    <? } ?>
      <td width="55"><span class="Estilo3 Estilo2 Estilo1 Estilo10"><strong>Direccion</strong></span></td>
      <td width="56"><span class="Estilo3 Estilo2 Estilo1 Estilo10"><strong>Telefono</strong></span></td>
    </tr>
    <?php
	//echo $t_persona."<br>";
		  //$t_persona=$_REQUEST['tipocliente'];
		  //$cbovendedor=$_REQUEST['vendedor'];
		  //if($t_persona!="0"){
		  if($t_persona=='J'){
		  $filtro1=",ruc  as  'doc', razonsocial, contacto, cargo,";
		  $condicion='juridico';
		  $condicion2=" and trim(ruc)!=''";
		  //$orden=" ruc";
		  }else{
		  $filtro1=",doc_iden  as 'doc',razonsocial,nombres, apellidos,";
  		  $condicion='natural';
		   $condicion2=" and trim(doc_iden)!=''";
		   //$orden=" doc_iden";
		  }
		  		  
		  $sql="SELECT codcliente".$filtro1." direccion, telefono
          FROM cliente
          WHERE t_persona = '".$condicion."'".$condicion2. " order by  codcliente asc";
		  //echo $sql;
		  $resultado=mysql_query($sql,$cn);
		  while($row=mysql_fetch_array($resultado)){
		    ?>
    <tr style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#000000; background-color:#f0ecf0;">
	   <td><?php echo $row['codcliente'] ?></td>
      <td><?php echo $row['doc'] ?></td>
     <?php if($t_persona=='J'){ ?> <td><?php echo $row['razonsocial'] ?></td><?php }?>
	 
   <?php if($t_persona=='N'){ ?><td><?php if($row['nombres']==''){
    echo $row['razonsocial'];
	}else{
	echo $row['nombres'];
	}?></td><?php  }?>
   <?php if($t_persona=='N'){ ?><td><?php
   if($row['apellidos']==''){
    echo "--";
	}else{
	echo $row['apellidos'];
	}
   ?></td><?php }?>
	  
   <?php if($t_persona=='J'){ ?><td><?php echo $row['contacto'] ?></td><?php }?>
   
    <?php if($t_persona=='J'){ ?><td><?php echo $row['cargo'] ?></td><?php }?>
	
      <td><?php echo $row['direccion'] ?></td>
      <td><?php echo $row['telefono'] ?></td>
    </tr>
    <?php
		}
		
		  if($t_persona=='0'){
		  ?>
	<tr bgcolor="#f0ecf0">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
	   <td>&nbsp;</td>
	    <td>&nbsp;</td>
    </tr>
	<?php }?>
  </table>
