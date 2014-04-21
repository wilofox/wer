<?php  include('conex_inicial.php');
include("funciones/funciones.php");
?>

<table width="482" border="0" cellpadding="0" cellspacing="0" bgcolor="#F2F2F2" id="fila">

 
  <tr>
    <td colspan="4" >
	
	<table width="100%" height="26%" border="0" cellpadding="1" cellspacing="1" id="tblproductos">
	
	 <?php 
		  
		//  if(isset($_REQUEST['nomb_det'])){
		  $nombre=$_REQUEST['nomb_det'];
		  $clasificacion=$_REQUEST['clasificacion'];
		  $tienda=$_REQUEST['tienda'];
		  $campo='saldo'.$tienda;
		  $criterio=$_REQUEST['criterio'];
		  
		//  echo "criterio".$criterio;
		  if($criterio=='idproducto'){
		  
		  $strSQL1="select * from producto where idproducto='".str_pad($nombre, 6, "0", STR_PAD_LEFT)."' limit 20";
		  
		  }else{
		  
		     if($criterio=='cod_prod'){
		  
       		  $strSQL1="select * from producto where cod_prod='$nombre' limit 20";
		  	  
		  	 }else{
		      $strSQL1="select * from producto where nombre like '%$nombre%' order by nombre limit 20";
		   
		    }
		   
		}
		  // echo $strSQL1;
		//  }else{
		//   $strSQL1="select * from producto";
		 //// }
		  		  	  	   
		//  echo $strSQL1;
  $resultado1=mysql_query($strSQL1,$cn);
  $contador=mysql_num_rows($resultado1);
//  echo $contador;
$i=0;
  while($row1=mysql_fetch_array($resultado1)){
		  	  
			  if($row1['moneda']=='01')$moneda='S/.'; else $moneda='US$.';
			  
		  ?>
        <tr bgcolor="#FFFFFF" >
          <td width="10%"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><a href="javascript:elegir('<?php echo $row1['idproducto']?>')"><?php echo $row1['idproducto'];?></a></font></td>
          <td width="8%" align="center"  style="display:block"><?php echo $row1[$campo];?></td>
          <td width="53%"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" style="color:#000000"><?php echo caracteres($row1['nombre']);?></font></td>
          <td width="10%" align="right" >
		  
		  <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="53%" align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><?php echo $moneda; ?></font></td>
              <td width="47%" align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><?php echo number_format($row1['precio'],2);?></font></td>
            </tr>
          </table>		  </td>
          <td  align="right"   style="display:none"><?php echo number_format($row1['precio'],2)."-".$row1['moneda']."-".$row1['und']?><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><a name="ancla<?php echo $i;?>" id="ancla"><?php echo $i?></a></font></td>
        </tr>
	    <?php 
    $i++; 
  } 
  
    if($contador==0){
  ?>
    <tr>
          <td colspan="2"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"></font></td>
          <td width="53%"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"></font></td>
          <td width="10%"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"></font></td>
          <td width="19%">&nbsp;</td>
    </tr>
  
  <?php
 
  }
  ?>
      </table>    </td>
  </tr>
 
  <tr>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>


