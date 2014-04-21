<?php
session_start();
include('conex_inicial.php');


$accion=$_REQUEST['accion'];
$fechap=date('d/m/Y H:i:s');
$t_pago=$_REQUEST['tpago'];
$numero=$_REQUEST['numero'];
$soles=$_REQUEST['soles'];
$dolares=$_REQUEST['dolares'];
$moneda_v=$_REQUEST['moneda_v'];
$referencia=$_REQUEST['referencia'];


if($soles!="" && $soles != 0){
$monto=$soles;
$moneda='soles';
}
else{
	if($dolares!="" && $dolares != 0){
	$monto=$dolares;
	$moneda='dolares';
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

$strSQL2= "insert into pagos(id,t_pago,numero,monto,moneda,fechap,referencia) values ('".$id."','".$t_pago."','".$numero."','".$monto."','".$moneda."','".$fechap."','".$referencia."')";
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
</style><table width="409" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#EFEFEF" bgcolor="#E9E9E9">
  <tr>
    <td width="112" bgcolor="#004993"><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="2px">T.pago</font></td>
    <td width="63" align="center" bgcolor="#004993"><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="2px">Numero</font></td>
    <td width="79" align="center" bgcolor="#004993"><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="2px">Soles</font></td>
    <td width="73" align="center" bgcolor="#004993"><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="2px">Dolares</font></td>
    <td width="70" align="center" bgcolor="#004993"><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="2px">Vuelto</font></td>
    <td width="70" align="center" bgcolor="#004993"><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="2px">A</font></td>
  </tr>
  <?php 
  

  
  $strSQL4="select * from pagos where referencia='".$referencia."' order by id";
 // echo $strSQL4;
  $resultado4=mysql_query($strSQL4,$cn);
  while($row4=mysql_fetch_array($resultado4)){
  
  
  ?>
  
  <tr>
    <td>&nbsp;<?php
	$strSQL41="select * from t_pago where id='".$row4['t_pago']."'";
  $resultado41=mysql_query($strSQL41,$cn);
  $row41=mysql_fetch_array($resultado41);
	
  echo $row41['descripcion'];
	
	 ?>    </td>
    <td>&nbsp;<?php echo $row4['numero']?></td>
    <td align="right"><font face="Verdana, Arial, Helvetica, sans-serif"; size="2px" >&nbsp;
      <?php 
	if($row4['moneda']=='soles'){
	echo number_format($row4['monto'],2);
	}
	
	?>
    </font></td>
    <td align="right"><font face="Verdana, Arial, Helvetica, sans-serif"; size="2px" >&nbsp;
      <?php 
	if($row4['moneda']=='dolares'){
	echo number_format($row4['monto'],2);
	}
	
	?>
  </font> </td>
    <td align="center"><font face="Verdana, Arial, Helvetica, sans-serif"; size="2px" >
	<?php 
	echo number_format($row4['vuelto'],2);
	?>
	</font></td>
    <td align="center"><a href="javascript:eliminar_pago('<?php echo $row4['id'] ?>')"><img src="imgenes/eliminar.gif" width="14" height="14" border="0" /></a>
	</td>
  </tr>
  <?php 
  }
  mysql_free_result($resultado4);
  ?>
</table>


