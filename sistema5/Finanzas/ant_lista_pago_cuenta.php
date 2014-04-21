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

$strSQL2= "insert into pagos(id,tipo,fecha,tcambio,t_pago,numero,monto,moneda,fechap,referencia,obs,pc,cod_user) values ('".$id."','".$tipo."','".formatofecharay($fecha)."','".$tc."','".$t_pago."','".$numero."','".$monto."','".$moneda."','".formatofecharay($fechap)."','".$referencia."','".$obs."','$pc','$cod_user')";
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
    <td width="146" bgcolor="#004993"><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="2px">T.pago</font></td>
    <td width="80" align="center" bgcolor="#004993"><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="2px">Numero</font></td>
    <td width="60" align="center" bgcolor="#004993"><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="2px">Soles</font></td>
    <td width="50" align="center" bgcolor="#004993"><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="2px">TC.</font></td>
    <td width="60" align="center" bgcolor="#004993"><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="2px">Dolares</font></td>
    <td width="62" align="center" bgcolor="#004993"><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="2px">F.Pago</font></td>
    <td width="130" align="center" bgcolor="#004993"><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="2px">Obs</font></td>
    <td width="24" align="center" bgcolor="#004993"><font color="#FFFFFF" size="2px" face="Verdana, Arial, Helvetica, sans-serif">E</font></td>
  </tr>
  <?php 
  

  
  $strSQL4="select * from pagos where referencia='".$referencia."' order by id";
 // echo $strSQL4;
  $resultado4=mysql_query($strSQL4,$cn);
  while($row4=mysql_fetch_array($resultado4)){
  
  
  ?>
  
  <tr>
    <td>&nbsp;<?php
  echo $row4['tipo'];
	 ?>    </td>
    <td>&nbsp;<?php
	$strSQL41="select * from t_pago where id='".$row4['t_pago']."'";
  $resultado41=mysql_query($strSQL41,$cn);
  $row41=mysql_fetch_array($resultado41);
	
  echo $row41['descripcion'];
	
	 ?>    </td>
    <td>&nbsp;<?php echo $row4['numero']?></td>
    <td align="right">&nbsp;
      <?php 
	if($row4['moneda']=='soles' || $row4['moneda']=='01'){
	echo number_format($row4['monto']-$row4['vuelto'],2);
	}
	
	?></td>
    <td align="right">&nbsp;<? echo $row4['tcambio'] ?></td>
    <td align="right">&nbsp;
      <?php 
	if($row4['moneda']=='dolares' || $row4['moneda']=='02'){
	echo number_format($row4['monto']-$row4['vuelto'],2);
	}
	
	?></td>
    <td align="center">
	<?php 
	echo $row4['fecha'];
	?>
	</td>
    <td align="center">
      <?php 
	echo $row4['obs'];
	?></td>
    <td align="center"><a href="javascript:eliminar_pago('<?php echo $row4['id'] ?>','<?php echo $row4['tipo'] ?>','<?php echo $row4['monto'] ?>','<?php echo $row4['moneda'] ?>','<?php echo $row4['tcambio'] ?>')"><img src="imgenes/eliminar.gif" width="14" height="14" border="0" /></a>	</td>
  </tr>
  <?php 
  }
  mysql_free_result($resultado4);
  ?>
</table>
<?php
/*
//if($accion=='guardar_saldo'){
	$ref=$_REQUEST['referencia'];
	$saldof=$_REQUEST['saldo'];
	$sql="Update cab_mov set saldo=".$saldof." where cod_cab='".$ref."'";
	echo $sql; 
	mysql_query($sql,$cn);
//
}
*/
?>