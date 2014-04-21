<?php 
include("../conex_inicial.php");
	
if($_REQUEST['excel']=="S"){

//header("Content-type: application/vnd.ms-excel");
//header("Content-Disposition: attachment; filename=excel.xls");
//header("Content-type: application/vnd.ms-excel");
header("Content-type: application/x-msexcel"); 
header("Content-Disposition: attachment; filename=excel.xls");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Relacion de Clientes</title>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.Estilo10 {font-family: Arial, Helvetica, sans-serif; color: #FFFFFF; font-size: 12px; font-weight: bold; }
.Estilo13 {font-size: 12px}
-->
</style>
</head>

<body >
<table width="850" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center"><table width="820" border="0" cellspacing="0" cellpadding="0">
      <form name="form1" id="form1" >
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><span class="Estilo1">Listado de Clintes 
		  <?php
		  $t_persona=$_REQUEST['tipocliente'];
		  if($t_persona!='0'){
			
			
				if($t_persona=='N'){
				echo  "de tipo Natural";
					}else{ 
					echo " de tipo Juridico"; 
				    }
			  
		   ?></span> </td>
        </tr>
        <tr>
          <td align="center"><table width="750" border="0" cellspacing="0" cellpadding="0">
            <tr height="20">
              <td colspan="7">&nbsp;</td>
            </tr>
            <tr height="30">
              <td width="23" align="left" class="Estilo1">&nbsp;</td>
              <td width="85" align="left" class="Estilo1">&nbsp;</td>
              <td width="166" align="left">&nbsp;</td>
              <td width="24">&nbsp;</td>
              <td width="67">&nbsp;</td>
              <td width="148">&nbsp;</td>
              <td width="87">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
    <td colspan="7" align="center"> <table width="750" border="0" cellspacing="1" cellpadding="1" style="border:dotted 1px">
    <tr bgcolor="#0066CC">
      <td width="62"><span class="Estilo3 Estilo2 Estilo1 Estilo10"><strong>Codigo
        
      </strong></span></td>
      <td width="76"><span class="Estilo3 Estilo2 Estilo1 Estilo10"><strong>
        <?php 
	
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
		 // echo $sql;
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
	<?php }
	?>
  </table></td>
  </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
      </form>
    </table></td>
  </tr>
</table>
</body>
</html>
