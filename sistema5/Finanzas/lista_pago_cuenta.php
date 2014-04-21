<?php
session_start();
include('../conex_inicial.php');
include('../funciones/funciones.php');

$accion=$_REQUEST['accion'];
$fechap=date('d/m/Y H:i:s');
$fecha=$_REQUEST['fecha'];
$tipo=$_REQUEST['tipo'];
$tc=$_REQUEST['tc'];
$t_pago=$_REQUEST['tpago'];
$numero=$_REQUEST['numero'];
$soles=$_REQUEST['soles'];
$dolares=$_REQUEST['dolares'];
$moneda_v=$_REQUEST['moneda_v'];
$referencia=$_REQUEST['referencia'];
$obs=$_REQUEST['obs'];
$pc=$_SESSION['pc_ingreso'];
$cod_user=$_SESSION['cod_vendedor'];

if($_REQUEST['Modulo']=="CancelaLetra"){
	$campo="refer_letra";
}else{
	$campo="referencia";
}

if($soles!="" && $soles != 0){
$monto=$soles;
//$moneda='soles';
$moneda='01';
}
else{
	if($dolares!="" && $dolares != 0){
	$monto=$dolares;
	//$moneda='dolares';
	$moneda='02';
	}
}

  
  if($accion=='eliminar'){
	
	$cod=$_REQUEST['cod_pago'];
  	$strSQL0="delete from pagos where id='$cod'";
  	mysql_query($strSQL0,$cn);
  
  }
if($accion=='insertar'){

$resultado=mysql_query("select max(id) as cod from pagos",$cn);
$row=mysql_fetch_array($resultado);
  $var=$row['cod']+1;
  $id=str_pad($var, 6, "0", STR_PAD_LEFT);
	   
$strSQL2= "insert into pagos(id,tipo,fecha,tcambio,t_pago,numero,monto,moneda,fechap,$campo,obs,pc,cod_user) values ('".$id."','".$tipo."','".formatofecharay($fecha)."','".$tc."','".$t_pago."','".$numero."','".$monto."','".$moneda."','".$fechap."','".$referencia."','".$obs."','$pc','$cod_user')";
mysql_query($strSQL2);
    
  }
  
  
  
?>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}

-->
</style><table width="670" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#EFEFEF" bgcolor="#E9E9E9">
  <tr>
    <td width="38" bgcolor="#004993"><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="2px">Tipo</font></td>
    <td width="146" align="center" bgcolor="#004993"><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="2px">Tipo de pago</font></td>
    <td width="80" align="center" bgcolor="#004993"><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="2px">N&uacute;mero</font></td>
    <td width="60" align="center" bgcolor="#004993"><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="2px">Soles</font></td>
    <td width="50" align="center" bgcolor="#004993"><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="2px">TC.</font></td>
    <td width="60" align="center" bgcolor="#004993"><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="2px">D&oacute;lares</font></td>
    <td width="62" align="center" bgcolor="#004993"><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="2px">F.Pago</font></td>
    <td width="130" align="center" bgcolor="#004993"><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="2px">Observaci&oacute;n</font></td>
    <td width="24" align="center" bgcolor="#004993"><font color="#FFFFFF" size="2px" face="Verdana, Arial, Helvetica, sans-serif">E</font></td>
    <td width="24" align="center" bgcolor="#004993"><font color="#FFFFFF" size="2px" face="Verdana, Arial, Helvetica, sans-serif">I</font></td>
  </tr>
  <?php 
  

  
  $strSQL4="select * from pagos where $campo='".$referencia."' order by id";
  //echo $strSQL4;
  $resultado4=mysql_query($strSQL4,$cn);
  while($row4=mysql_fetch_array($resultado4)){
  
  
  ?>
  
  <tr>
    <td>&nbsp;<?php
  echo $row4['tipo'];
  
 	  $deshab=" disabled ";
  	  if($_REQUEST['deuda']=='N'  &&  formatofecha($row4['fecha'])==gmdate('d-m-Y') && $row4['t_pago']!='15' &&  ($_SESSION['nivel_usu']=='10' || $_SESSION['nivel_usu']=='4' || $_SESSION['nivel_usu']=='5'  )){
	  $deshab="  ";
	  }
	  
	  
	  
	 ?>    </td>
    <td>&nbsp;
	<select name="tipo_pago_det" style="width:120px" <?php echo  $deshab; ?> onchange="cambiar_tpago(this,'<?php echo $row4['id']?>','1')">
	<?php
	  $strSQL41="select * from t_pago ";
	  $resultado41=mysql_query($strSQL41,$cn);
	  while($row41=mysql_fetch_array($resultado41)){
	  //echo ""; $row4['t_pago']
	  $marcar=" ";
	  if($row41['id']==$row4['t_pago']){ 
	  $marcar="selected";
	  }
	  
	  
	  ?>
	  <option <?php echo $marcar; ?> value="<?php echo $row41['id'] ?>"><?php echo caracteres($row41['descripcion']); ?></option>
	  <?php 
	  }		
	 // echo $row41['descripcion'];
	  
	  	
	 ?>
	 	   
      </select>
	 </td>
    <td>
    <input <?php echo  $deshab; ?> name="numerop" type="text" id="numerop" size="10" value="<?php echo $row4['numero']?>"  onchange="cambiar_tpago(this,'<?php echo $row4['id']?>','2')" /></td>
    <td align="right">&nbsp;
      <?php 
	if($row4['moneda']=='soles' || $row4['moneda']=='01'){
	echo number_format($row4['monto'],2);
	//-$row4['vuelto']
	}
	
	?></td>
    <td align="right">&nbsp;<? echo $row4['tcambio'] ?></td>
    <td align="right">&nbsp;
      <?php 
	if($row4['moneda']=='dolares' || $row4['moneda']=='02'){
	echo number_format($row4['monto'],2);
	//-$row4['vuelto']
	}
	
	?></td>
    <td align="center">
	<?php 
	echo formatofecha($row4['fecha']);
	?>
	</td>
    <td align="center">
      <input <?php echo  $deshab; ?> name="obsp" type="text" id="obsp" size="15" value="<?php echo $row4['obs']?>" onchange="cambiar_tpago(this,'<?php echo $row4['id']?>','3')" />
     </td>
    <td align="center"><a style="cursor:pointer" onclick="eliminar_pago('<?php echo $row4['id'] ?>','<?php echo $row4['tipo'] ?>','<?php echo $row4['monto'] ?>','<?php echo $row4['moneda'] ?>','<?php echo $row4['tcambio'] ?>','<?php echo formatofecha($row4['fecha']) ?>','<?php echo $row4['t_pago']?>')"><img src="imgenes/eliminar.gif" width="14" height="14" border="0" /></a>	</td>
    <td align="center"><a href="javascript:imprimir_pago('<?php echo $row4['id'] ?>')"><img src="imgenes/fileprint.gif" width="14" height="14" border="0" /></a>	</td>
  </tr>
  <?php 
  }
  mysql_free_result($resultado4);
  ?>
</table>
<?php
if($accion=='guardar_saldo'){
	$ref=$_REQUEST['referencia'];
	$saldof=$_REQUEST['saldo'];
	$sql="Update cab_mov set saldo=".$saldof.",condicion='".$_REQUEST['cond']."' where cod_cab='".$ref."'";
	echo $sql; 
	mysql_query($sql,$cn);
}
?>