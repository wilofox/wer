<?php 
session_start();
include('conex_inicial.php');
$cod_prod=$_REQUEST['prod'];
$cantidad=$_REQUEST['cant'];
$accion=$_REQUEST['accion'];
$cod=$_REQUEST['cod'];
$notas=$_REQUEST['notas'];
$mesa=$_REQUEST['mesa'];
$total=0;

//echo $producto." ".$cantidad;

?><table width="632" border="0" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
  <tr>
    <td width="55" height="15" bgcolor="#3366CC"><span class="Estilo31">Cantidad</span></td>
    <td width="259" bgcolor="#3366CC"><span class="Estilo31">Descripci&oacute;n</span></td>
    <td width="78" bgcolor="#3366CC"><span class="Estilo31">Precio Unit. </span></td>
    <td width="35" bgcolor="#3366CC"><span class="Estilo31">Desc</span></td>
    <td width="39" bgcolor="#3366CC"><span class="Estilo32"><span class="Estilo31">Precio</span></span></td>
    <td width="44" bgcolor="#3366CC"><span class="Estilo31">Notas</span></td>
    <td width="100" bgcolor="#3366CC"><span class="Estilo31">Eliminar</span></td>
  </tr>
  
  <?php 
  
 
   
  if($accion=='eliminar'){
 
  $strSQL0="delete from comanda where cod_det='$cod'";
  mysql_query($strSQL0,$cn);
  
  }else{
  $cont=0; 	
  $strSQL1="select * from producto where idproducto='$cod_prod'";
  $resultado1=mysql_query($strSQL1,$cn);
  $cont=mysql_num_rows($resultado1);
  while($row1=mysql_fetch_array($resultado1)){
  
   $nom_prod=$row1['nombre'];
   $precio=$row1['precio'];
  }
  mysql_free_result($resultado1);
 
  //------------------------------------------
 
  $strSQL5="select max(cod_det) as codigo from comanda";
  $resultado5=mysql_query($strSQL5,$cn);
  $row5=mysql_fetch_array($resultado5);
  $var=$row5['codigo']+1;
  $cod_det=str_pad($var, 6, "0", STR_PAD_LEFT);
  
  mysql_free_result($resultado5);
 //-----------------------------------------------
 
 if($cod_prod!='' &&  $cantidad!='' && $cont!=0 ){
  $strSQL2= "insert into comanda(cod_det,cod_cab,cod_prod,nom_prod,precio,cantidad,notas,mesa) values ('".$cod_det."','".$_SESSION['registro']."','".$cod_prod."','".$nom_prod."','".$precio."','".$cantidad."','".$notas."','".$mesa."')";
  mysql_query($strSQL2);

  }else{
  
//  $_SESSION['registro']='';
  
  }
  
  //-----------------------------------------------
  }
  $strSQL4="select * from comanda where cod_cab='".$_SESSION['registro']."' order by cod_det";
  $resultado4=mysql_query($strSQL4,$cn);
  while($row4=mysql_fetch_array($resultado4)){
  
  ?>
  <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
    <td align="center" bgcolor="#F5F5F5"><?php echo $row4['cantidad']?></td>
    <td bgcolor="#F5F5F5"><?php echo $row4['nom_prod']?></td>
    <td align="right" bgcolor="#F5F5F5"><?php echo number_format($row4['precio'],2)?></td>
    <td bgcolor="#F5F5F5"></td>
    <td align="right" bgcolor="#F5F5F5"><?php
	
	 echo number_format($row4['precio']*$row4['cantidad'],2);
	 $total=$total + ($row4['precio']*$row4['cantidad']);
	 
	 ?>    </td>
    <td bgcolor="#F5F5F5"><?php echo $row4['notas']?></td>
    <td align="center" bgcolor="#F5F5F5"><a href="javascript:eliminar('<?php echo $row4['cod_det']?>')"><img src="../imgenes/eliminar.gif" width="14" height="14" border="0" /></a></td>
  </tr>
    <?php 
  }
  
  ?>
  
  <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
    <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF"></td>
    <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF"></td>
    <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
    <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF"><strong>Total</strong></td>
    <td bgcolor="#FFFFFF"></td>
    <td align="right" bgcolor="#FFFFFF"><?php echo number_format($total,2);?></td>
    <td bgcolor="#FFFFFF"></td>
    <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>

  </table>
