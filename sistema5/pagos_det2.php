<?php
session_start();
include('conex_inicial.php');
include('funciones/funciones.php');

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
//echo $acuenta;
$condicion=$_REQUEST['condicion'];
$doc=$_REQUEST['doc'];
$total_doc=$_REQUEST['total_doc'];
$moneda_doc=$_REQUEST['moneda_doc'];


	$strSQLDetope="select * from detope where condicion='".$condicion."' and documento='".$doc."'";
	$resultadoDetope=mysql_query($strSQLDetope,$cn);
	$rowDetope=mysql_fetch_array($resultadoDetope);
	$condicionDeuda=$rowDetope['deuda'];


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


  if($accion=='cerrar'){
  
			unset($_SESSION['pagos'][0]);
			unset($_SESSION['pagos'][1]); 
			unset($_SESSION['pagos'][2]); 
			unset($_SESSION['pagos'][3]); 
			unset($_SESSION['pagos'][4]); 
			unset($_SESSION['pagos'][5]); 
			unset($_SESSION['pagos'][6]); 
			unset($_SESSION['pagos'][7]); 
  
  die();  
  }
  

  
  if($accion=='eliminar'){
  $cod=$_REQUEST['cod_pago'];
  $soles="";
  $dolares="";
  
  
 
  
 
				
	//*************************************************************************			
  
  
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
						 /*
						  if ($t_pago==7){
						  $nuevo_acuenta=$nuevo_acuenta+$acuenta;
						  }else{
						  $nuevo_acuenta=$acuenta-$nuevo_acuenta;
						  }
						  */					
					//$nuevo_acuenta=$acuenta-$nuevo_acuenta;
						$nuevo_acuenta=$acuenta-$nuevo_acuenta;
					
					unset($_SESSION['pagos'][0][$subkey]);
					unset($_SESSION['pagos'][1][$subkey]); 
					unset($_SESSION['pagos'][2][$subkey]); 
					unset($_SESSION['pagos'][3][$subkey]); 
					unset($_SESSION['pagos'][4][$subkey]); 
					unset($_SESSION['pagos'][5][$subkey]); 
					unset($_SESSION['pagos'][6][$subkey]); 
					unset($_SESSION['pagos'][7][$subkey]); 
					
					}
  			}
			
	/*
	$cod=$_REQUEST['cod_pago'];
  	$strSQL0="delete from pagos where id='$cod'";
  	mysql_query($strSQL0,$cn);
  */
   //************************** eliminar vuelto *******************************************
   
   foreach ( $_SESSION['pagos'][0] as $subkey=> $subvalue) {
			  
				  if($_SESSION['pagos'][2][$subkey]!='15'){			  				
					
					  if($_SESSION['pagos'][1][$subkey]=='A'){
					  $total_soles=$total_soles+$_SESSION['pagos'][4][$subkey];			  
					  $total_dolares=$total_dolares+$_SESSION['pagos'][6][$subkey];				  
					  }
					  /*
					  if($_SESSION['pagos'][1][$subkey]=='C'){
					  $total_soles=$total_soles-$_SESSION['pagos'][4][$subkey];			  
					  $total_dolares=$total_dolares-$_SESSION['pagos'][6][$subkey];				  
					  }
					  */
				  }  		  
			  
			  }
				if($moneda_doc=='01'){		
					$total_pagos=$total_soles+number_format(($total_dolares*$tcambio_det_pago),2,'.','');			
				}else{		
					$total_pagos=$total_dolares+number_format(($total_soles/$tcambio_det_pago),2,'.','');			
				} 
			//	echo 	$total_doc." - ".$total_pagos;	
				$vuelto=($total_doc-$total_pagos);
		   
  //echo $vuelto;
    if($vuelto>=0){
	//echo "--->";
  			foreach ( $_SESSION['pagos'][0] as $subkey=> $subvalue) {
			 			  
				  if($_SESSION['pagos'][2][$subkey]!='15' && $_SESSION['pagos'][1][$subkey]=='C'){			  													  		
							unset($_SESSION['pagos'][0][$subkey]);
							unset($_SESSION['pagos'][1][$subkey]); 
							unset($_SESSION['pagos'][2][$subkey]); 
							unset($_SESSION['pagos'][3][$subkey]); 
							unset($_SESSION['pagos'][4][$subkey]); 
							unset($_SESSION['pagos'][5][$subkey]); 
							unset($_SESSION['pagos'][6][$subkey]); 
							unset($_SESSION['pagos'][7][$subkey]); 		  

					
				  }  		  
			  
			  }
  	}
  //*************************************************************
  }else{
  
  if($accion=='cambiar_vuelto'){
  
 		   foreach ( $_SESSION['pagos'][0] as $subkey=> $subvalue) {
			 			  
				  if($_SESSION['pagos'][2][$subkey]!='15' && $_SESSION['pagos'][1][$subkey]=='C'){			  													  		
						
						if($_SESSION['pagos'][4][$subkey]!='' && $_SESSION['pagos'][4][$subkey]>0){
						
						$_SESSION['pagos'][6][$subkey]=number_format($_SESSION['pagos'][4][$subkey]/$tcambio_det_pago,2,'.','');
						$_SESSION['pagos'][4][$subkey]="0.00";
						}else{
						$_SESSION['pagos'][4][$subkey]=number_format($_SESSION['pagos'][6][$subkey]*$tcambio_det_pago,2,'.','');
						$_SESSION['pagos'][6][$subkey]="0.00";	
						
						} 		  

					
				  }  		  
			  
			  }
			  
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
			  
  
  }else{
  
  
  if(isset($_REQUEST['percx']) && $_REQUEST['percx']!="0"){
  $id=count($_SESSION['pagos'][0])+1;
  
  $_SESSION['pagos'][0][]=$id;
  $_SESSION['pagos'][1][]="C";
  $_SESSION['pagos'][2][]="15";
  $_SESSION['pagos'][3][]="";
  $_SESSION['pagos'][4][]=number_format($_REQUEST['percx'],2,'.','');
  $_SESSION['pagos'][5][]=$tcambio_det_pago;
  $_SESSION['pagos'][6][]="0";
  $_SESSION['pagos'][7][]=$fecha_det_pago;
  
  
	  if($condicionDeuda=='N'){
	  
	  $id=count($_SESSION['pagos'][0])+1;
	  
	  $_SESSION['pagos'][0][]=$id;
	  $_SESSION['pagos'][1][]="A";
	  $_SESSION['pagos'][2][]="1";
	  $_SESSION['pagos'][3][]=$numero;
	  $_SESSION['pagos'][4][]=number_format($soles,'2','.','');
	  $_SESSION['pagos'][5][]=$tcambio_det_pago;
	  $_SESSION['pagos'][6][]=number_format($dolares,'2','.','');
	  $_SESSION['pagos'][7][]=$fecha_det_pago;
	  
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
			$nuevo_acuenta=$nuevo_acuenta+$acuenta;
	  }else{
	  $nuevo_acuenta=0;
	  
	  
	  }
  
  }else{
  
  $id=count($_SESSION['pagos'][0])+1;
  
  $_SESSION['pagos'][0][]=$id;
  $_SESSION['pagos'][1][]="A";
  $_SESSION['pagos'][2][]=$t_pago;
  $_SESSION['pagos'][3][]=$numero;
  $_SESSION['pagos'][4][]=number_format($soles,'2','.','');
  $_SESSION['pagos'][5][]=$tcambio_det_pago;
  $_SESSION['pagos'][6][]=number_format($dolares,'2','.','');
  $_SESSION['pagos'][7][]=$fecha_det_pago;
  
  //------ creando el cargo de vuelto ----------
	  foreach ( $_SESSION['pagos'][0] as $subkey=> $subvalue) {
	  
		  if($_SESSION['pagos'][2][$subkey]!='15'){			  				
		  	
			  if($_SESSION['pagos'][1][$subkey]=='A'){
			  $total_soles=$total_soles+$_SESSION['pagos'][4][$subkey];			  
			  $total_dolares=$total_dolares+$_SESSION['pagos'][6][$subkey];				  
			  }
			  /*
			  if($_SESSION['pagos'][1][$subkey]=='C'){
			  $total_soles=$total_soles-$_SESSION['pagos'][4][$subkey];			  
			  $total_dolares=$total_dolares-$_SESSION['pagos'][6][$subkey];				  
			  }
			  */
		  }  		  
	  
	  }
	 	if($moneda_doc=='01'){		
			$total_pagos=$total_soles+number_format(($total_dolares*$tcambio_det_pago),2,'.','');			
		}else{		
			$total_pagos=$total_dolares+number_format(($total_soles/$tcambio_det_pago),2,'.','');			
		} 
		 		
		$vuelto=($total_doc-$total_pagos);
		//echo $vuelto;
		if($vuelto<0){
		
		$vuelto=abs($vuelto);
			if($moneda_doc!=$moneda_v){
			
				if($moneda_v=='01'){
				$total_vuelto_s=$vuelto*$tcambio_det_pago;
				}else{
				$total_vuelto_d=$vuelto/$tcambio_det_pago;
				}
			
			}else{
				if($moneda_v=='01'){
				$total_vuelto_s=$vuelto;
				}else{
				$total_vuelto_d=$vuelto;
				}
			
			}
		
		
			  $id=count($_SESSION['pagos'][0])+1;  
			  $_SESSION['pagos'][0][]=$id;
			  $_SESSION['pagos'][1][]="C";
			  $_SESSION['pagos'][2][]="1";
			  $_SESSION['pagos'][3][]="vuelto";
			  $_SESSION['pagos'][4][]=number_format($total_vuelto_s,'2','.','');
			  $_SESSION['pagos'][5][]=$tcambio_det_pago;
			  $_SESSION['pagos'][6][]=number_format($total_vuelto_d,'2','.','');
			  $_SESSION['pagos'][7][]=$fecha_det_pago;
		
		} 
		
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
			$nuevo_acuenta=$nuevo_acuenta+$acuenta;
      
  }

/*
$resultado=mysql_query("select max(id) as cod from pagos",$cn);
$row=mysql_fetch_array($resultado);
  $var=$row['cod']+1;
  $id=str_pad($var, 6, "0", STR_PAD_LEFT);

$strSQL2= "insert into pagos(id,t_pago,numero,monto,moneda,referencia) values ('".$id."','".$t_pago."','".$numero."','".$monto."','".$moneda."','".$referencia."')";
mysql_query($strSQL2);
  */
  
  
// echo $moneda_doc." - ".$dolares." - ".$soles;
		 
		    /* if ($t_pago==7){
		  $nuevo_acuenta=$acuenta-$nuevo_acuenta;
		  }else{
		  $nuevo_acuenta=$nuevo_acuenta+$acuenta;
		  }*/
		  
	
	
	}
	
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
</style>

<table id="tbl_pagos" width="477" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#EFEFEF" bgcolor="#E9E9E9">
  <tr  style="background-color:#1789DD">
    <td width="83" ><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tipo</font></strong></td>
    <td width="52" align="center"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">T.pago</font></strong></td>
    <td align="center" width="80"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">N&uacute;mero</font></strong></td>
    <td align="center" width="80"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">Soles</font></strong></td>
    <td align="center" width="80"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">T.c</font></strong></td>
    <td align="center" width="80"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">D&oacute;lares</font></strong></td>
    <td align="center" width="29"><strong><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" style="font-size:11px">E</font></strong></td>
  </tr>
  <?php 
  

  
  //$strSQL4="select * from pagos where referencia='".$_SESSION['registro']."' order by id";
  //$resultado4=mysql_query($strSQL4,$cn);
  //while($row4=mysql_fetch_array($resultado4)){
  //print_r($_SESSION['pagos'][4]);
  foreach ( $_SESSION['pagos'][0] as $subkey=> $subvalue) {
  
  ?>
  
  <tr>
    <td width="83" align="center" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px; color:#333333"><?php echo $_SESSION['pagos'][1][$subkey] ?></font></td>
    <td width="52" align="center" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px;color:#333333">	
	<?php
	$strSQL41="select * from t_pago where id='".$_SESSION['pagos'][2][$subkey]."'";
//	echo $strSQL41;
  $resultado41=mysql_query($strSQL41,$cn);
  $row41=mysql_fetch_array($resultado41);	
 echo caracteres($row41['descripcion']);	
	 ?>	 
	 </font><input name="t_pagoT" type="hidden" id="t_pagoT" value="<?php echo $_SESSION['pagos'][2][$subkey]; ?>" size="8" maxlength="10" /></td>
    <td width="80" align="center" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px"><?php echo $_SESSION['pagos'][3][$subkey]?></font></td>
    <td width="80" align="right" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px;color:#0A64A7">
      <?php 
	if($_SESSION['pagos'][4][$subkey]!=''){
	echo number_format($_SESSION['pagos'][4][$subkey],2);
	}
	
	?>
    </font></td>
    <td width="80" align="center" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px;color:#333333"><?php echo $_SESSION['pagos'][5][$subkey] ?></font></td>
    <td width="80" align="right" bgcolor="#F4F4F4"><font face="Arial, Helvetica, sans-serif"; style="font-size:11px;color:#0A64A7">
      <?php 
	if($_SESSION['pagos'][6][$subkey]!=''){
	echo number_format($_SESSION['pagos'][6][$subkey],2);
	}
	
	?>
    </font></td>
    <td width="29" align="center" bgcolor="#F4F4F4">
	<a style="cursor:pointer" onclick="javascript:eliminar_pagos('<?php echo $_SESSION['pagos'][0][$subkey] ?>','<?php echo $_SESSION['pagos'][1][$subkey]; ?>')"><img src="../imgenes/eliminar.gif" width="14" height="14" border="0" /></a>	</td>
  </tr>
  <?php 
  }
  //mysql_free_result($resultado4);
  //,'echo $_SESSION['pagos'][2][$subkey]; '
  ?>
</table>

<?php 
//echo  count($_SESSION['pagos'][0]);;
echo "?".number_format($nuevo_acuenta,2);
//echo "?".
?>

