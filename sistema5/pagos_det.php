<?php
session_start();
include('conex_inicial.php');

$accion=$_REQUEST['accion'];

$t_pago=$_REQUEST['tpago'];
$numero=$_REQUEST['numero'];
$soles=$_REQUEST['soles'];
$dolares=$_REQUEST['dolares'];
$moneda_v=$_REQUEST['moneda_v'];
$referencia=$_SESSION['registro'];
$tope=$_REQUEST['tope'];
$fecha_det_pago=$_REQUEST['fecha_det_pago'];
$tcambio_det_pago=$_REQUEST['tcambio_det_pago'];
$moneda_doc=$_REQUEST['moneda_doc'];
$acuenta=$_REQUEST['acuenta'];
$obsp=$_REQUEST['obsp'];

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
  $soles="";
  $dolares="";
  			foreach ($_SESSION['pagos'][0] as $subkey=> $subvalue) {
					 
					if($subvalue==$cod){
					
						if($_SESSION['pagos'][4][$subkey]!='' && $_SESSION['pagos'][4][$subkey]!='0'){
						$soles=$_SESSION['pagos'][4][$subkey];
						}else{
						$dolares=$_SESSION['pagos'][6][$subkey];
						}
						//echo $soles." - ".$dolares." - ".$moneda_doc;
						 if($moneda_doc==02 && ($soles!=0 && $soles!='')){
							$nuevo_acuenta=$soles/$_SESSION['pagos'][5][$subkey];
						 
						 }else{
							if($moneda_doc==01 && ($dolares!=0 && $dolares!='')){
							$nuevo_acuenta=$dolares*$_SESSION['pagos'][5][$subkey];
							}else{
							$nuevo_acuenta=$dolares+$soles; 
							}
						 }
							
							/*echo $nuevo_acuenta;
							echo $acuenta;*/
							//echo $t_pago;
						 /// caso de flete
						  if ($t_pago==7){
						  $nuevo_acuenta=$nuevo_acuenta+$acuenta;
						  }else{
						  $nuevo_acuenta=$acuenta-$nuevo_acuenta;
						  }					
					//$nuevo_acuenta=$acuenta-$nuevo_acuenta;
						
					
					unset($_SESSION['pagos'][0][$subkey]);
					unset($_SESSION['pagos'][1][$subkey]); 
					unset($_SESSION['pagos'][2][$subkey]); 
					unset($_SESSION['pagos'][3][$subkey]); 
					unset($_SESSION['pagos'][4][$subkey]); 
					unset($_SESSION['pagos'][5][$subkey]); 
					unset($_SESSION['pagos'][6][$subkey]); 
					unset($_SESSION['pagos'][7][$subkey]); 
					unset($_SESSION['pagos'][8][$subkey]); 
					
					}
  			}
			
	/*
	$cod=$_REQUEST['cod_pago'];
  	$strSQL0="delete from pagos where id='$cod'";
  	mysql_query($strSQL0,$cn);
  */
  }else{
  
  $id=count($_SESSION['pagos'][0])+1;
  
  $strSQL45="select * from t_pago where id='".$t_pago."'";
  $resultado45=mysql_query($strSQL45,$cn);
  $row45=mysql_fetch_array($resultado45);	
  //$row41['descripcion'];
  
  $_SESSION['pagos'][0][]=$id;
  $_SESSION['pagos'][1][]=$tope;
  $_SESSION['pagos'][2][]=$t_pago;
  $_SESSION['pagos'][3][]=$numero;
  $_SESSION['pagos'][4][]=$soles;
  $_SESSION['pagos'][5][]=$tcambio_det_pago;
  $_SESSION['pagos'][6][]=$dolares;
  $_SESSION['pagos'][7][]=$fecha_det_pago;
  $_SESSION['pagos'][8][]=$obsp." : ".$row45['descripcion'];

/*
$resultado=mysql_query("select max(id) as cod from pagos",$cn);
$row=mysql_fetch_array($resultado);
  $var=$row['cod']+1;
  $id=str_pad($var, 6, "0", STR_PAD_LEFT);

$strSQL2= "insert into pagos(id,t_pago,numero,monto,moneda,referencia) values ('".$id."','".$t_pago."','".$numero."','".$monto."','".$moneda."','".$referencia."')";
mysql_query($strSQL2);
  */
  
  
// echo $moneda_doc." - ".$dolares." - ".$soles;
		 if($moneda_doc==02 && ($soles!=0 && $soles!='')){
			$nuevo_acuenta=$soles/$tcambio_det_pago;
		 //echo "dsgh";
		 }else{
		 
			if($moneda_doc==01 && ($dolares!=0 && $dolares!='')){
			$nuevo_acuenta=$dolares*$tcambio_det_pago;
			}else{
			$nuevo_acuenta=$dolares+$soles; 
			}
		 }
		 	/// caso de flete
		  if ($t_pago==7){
		  $nuevo_acuenta=$acuenta-$nuevo_acuenta;
		  }else{
		  $nuevo_acuenta=$nuevo_acuenta+$acuenta;
		  }
  	//$nuevo_acuenta=$nuevo_acuenta+$acuenta;
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
</style><table id="tbl_pagos" width="500" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#EFEFEF" bgcolor="#E9E9E9">
  <tr  style="background-color:#1789DD">
    <td width="20" ><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tipo</font></strong></td>
    <td width="70" align="center"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">T.pago</font></strong></td>
    <td align="center" width="80"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">Numero</font></strong></td>
    <td align="center" width="80"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">Soles</font></strong></td>
    <td align="center" width="80"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">T.c</font></strong></td>
    <td align="center" width="80"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">Dolares</font></strong></td>
    <td align="center" width="130"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">Fecha</font></strong></td>
    <td align="center" width="130"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">Obs</font></strong></td>
    <td align="center" width="20"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">E</font></strong></td>
  </tr>
  <?php 
  

  
  //$strSQL4="select * from pagos where referencia='".$_SESSION['registro']."' order by id";
  //$resultado4=mysql_query($strSQL4,$cn);
  //while($row4=mysql_fetch_array($resultado4)){
  foreach ( $_SESSION['pagos'][0] as $subkey=> $subvalue) {
  
  ?>
  
  <tr>
    <td width="112" align="center" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px; color:#333333"><?php echo $_SESSION['pagos'][1][$subkey] ?></font></td>
    <td width="112" align="center" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px;color:#333333">	
	<?php
	$strSQL41="select * from t_pago where id='".$_SESSION['pagos'][2][$subkey]."'";
  $resultado41=mysql_query($strSQL41,$cn);
  $row41=mysql_fetch_array($resultado41);	
  echo $row41['descripcion'];	
	 ?>	 
	 </font><input name="t_pagoT" type="hidden" id="t_pagoT" value="<?php echo $_SESSION['pagos'][2][$subkey]; ?>" size="8" maxlength="10" /></td>
    <td width="112" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px"><?php echo $_SESSION['pagos'][3][$subkey]?></font></td>
    <td width="112" align="right" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px;color:#0A64A7">
      <?php 
	if($_SESSION['pagos'][4][$subkey]!=''){
	echo number_format($_SESSION['pagos'][4][$subkey],2);
	}
	
	?>
    </font></td>
    <td width="63" align="center" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px;color:#333333"><?php echo $_SESSION['pagos'][5][$subkey] ?></font></td>
    <td width="79" align="right" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px;color:#0A64A7">
      <?php 
	if($_SESSION['pagos'][6][$subkey]!=''){
	echo number_format($_SESSION['pagos'][6][$subkey],2);
	}
	
	?>
    </font></td>
    <td width="80" align="right" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px;color:#333333"><?php echo $_SESSION['pagos'][7][$subkey]?></font> </td>
    <td width="80" align="right" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px;color:#333333"><?php echo $_SESSION['pagos'][8][$subkey]?></font></td>
    <td width="63" align="center" bgcolor="#F4F4F4">
	<a style="cursor:pointer" onclick="javascript:eliminar_pagos('<?php echo $_SESSION['pagos'][0][$subkey] ?>','<?php echo $_SESSION['pagos'][2][$subkey]; ?>','<?php echo $_SESSION['pagos'][7][$subkey]; ?>')"><img src="imgenes/eliminar.gif" width="14" height="14" border="0" /></a>	</td>
  </tr>
  <?php 
  }
  //mysql_free_result($resultado4);
  ?>
</table>

<?php 
//echo  count($_SESSION['pagos'][0]);;
echo "?".number_format($nuevo_acuenta,2);
//echo "?".
mysql_close($cn);
?>

