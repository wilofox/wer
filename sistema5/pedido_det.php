<?php 
session_start();
include('conex_inicial.php');
include("funciones/funciones.php");
$cod_prod=$_REQUEST['prod'];
$cantidad=$_REQUEST['cant'];
$punitario=$_REQUEST['precio'];
$accion=$_REQUEST['accion'];
$cod=$_REQUEST['cod'];
$notas=$_REQUEST['notas'];
$total=0;
$fechad=date('d/m/Y H:i:s');

//echo $producto." ".$cantidad;

?><table width="671" border="0" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
  <tr style="background:url(imagenes/bg_contentbase2.gif); background-position:100px 80px">
    <td width="55" height="21" align="center"><span class="Estilo31">Cant.</span></td>
    <td width="306"><span class="Estilo31">Descripci&oacute;n</span></td>
    <td width="70" align="center"><span class="Estilo31">UND</span></td>
    <td width="62"><span class="Estilo31">P. Unit.</span></td>
    <td width="39"><span class="Estilo32"><span class="Estilo31">Precio</span></span></td>
    <td width="54"><span class="Estilo31">Notas</span></td>
    <td width="63"><span class="Estilo31">Eliminar</span></td>
  </tr>
  
  <?php 
  
 
   
  if($accion=='eliminar'){
 
	foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
					  
		if($subvalue==$cod){
		unset($_SESSION['productos'][0][$subkey]);
		unset($_SESSION['productos'][1][$subkey]); 
		unset($_SESSION['productos'][2][$subkey]); 
		
		//echo "ingreso";
		}
	 }
  
  }else{
  
  $_SESSION['productos'][0][] = $cod_prod;
  $_SESSION['productos'][1][] = $cantidad;	
  $_SESSION['productos'][2][] = $punitario;
  
 
  }
  
  
  foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
 
 $strSQL4="select * from producto where idproducto='".$subvalue."' ";
 $resultado4=mysql_query($strSQL4,$cn);
 while($row4=mysql_fetch_array($resultado4)){
  
  
  ?>
  <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
    <td align="center" bgcolor="#F5F5F5" style="color:#333333"><?php echo $_SESSION['productos'][1][$subkey] ; ?></td>
    <td bgcolor="#F5F5F5"><a title="<?php echo $row4['idproducto']?>" onclick="espec_prod('<?php echo $row4['idproducto']?>')" style="cursor:pointer; color:#003399; text-decoration:underline; font:Verdana, Arial, Helvetica, sans-serif; font-size:11px" ><?php echo caracteres($row4['nombre']);?></a></td>
    <td align="right" bgcolor="#F5F5F5"><?php echo $unidad?></td>
    <td align="right" bgcolor="#F5F5F5" style="color:#333333"><?php echo $_SESSION['productos'][2][$subkey] ; ?></td>
    <td align="right" bgcolor="#F5F5F5"  style="color:#333333"><?php
	
	 echo number_format($_SESSION['productos'][1][$subkey] * $_SESSION['productos'][2][$subkey],2);
	 $total=$total + ($_SESSION['productos'][1][$subkey] * $_SESSION['productos'][2][$subkey]);
	 
	 ?>    </td>
    <td bgcolor="#F5F5F5"><?php echo $row4['notas']?></td>
    <td align="center" bgcolor="#F5F5F5"><a href="javascript:eliminar('<?php echo $row4['idproducto']?>')"><img src="imgenes/eliminar.gif" width="14" height="14" border="0" /></a></td>
  </tr>
    <?php 
  }
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
    <td height="21" align="center" bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF"><strong>Total</strong></td>
    <td bgcolor="#FFFFFF"></td>
    <td align="right" bgcolor="#FFFFFF"><strong><?php echo number_format($total,2);?></strong></td>
    <td bgcolor="#FFFFFF"><input type="hidden" name="temp_tot_det" value="<?php echo number_format($total,2);?>" /></td>
    <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>

  </table>
