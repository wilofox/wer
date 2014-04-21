<?php 
session_start();
include('../conex_inicial.php');
include('../funciones/funciones.php');
$cod_prod=$_REQUEST['prod'];
$cantidad=$_REQUEST['cant'];
$accion=$_REQUEST['accion'];
$punitario=$_REQUEST['punitario'];
//$cod=$_REQUEST['cod'];
$notas=$_REQUEST['notas'];
$total=0;
$fechad=date('d/m/Y H:i:s');
$incluidoigv=$_REQUEST['incluidoigv'];
$tmoneda=$_REQUEST['tmoneda'];
$estado=$_REQUEST['estado'];
$mon_ini=$_REQUEST['mon_ini'];
$permiso4=$_REQUEST['permiso4'];
$permiso10=$_REQUEST['permiso10'];
$presentacion=$_REQUEST['presentacion'];
$tienda=$_REQUEST['tienda'];
$precosto=$_REQUEST['precosto'];
$impto=$_REQUEST['impto'];
$valor_impto=$impto+1;
$num_impto=$impto*100;
$desabilitar="";
$total_doc=$_REQUEST['total_doc'];
$tipomov=$_REQUEST['tipomov'];


$percep_suc=$_REQUEST['percep_suc'];
$percep_doc=$_REQUEST['percep_doc'];
$min_percep_doc=$_REQUEST['min_percep_doc'];
$est_percep_clie=$_REQUEST['est_percep_clie'];
$por_percep_clie=$_REQUEST['por_percep_clie'];

$ancho=$_REQUEST['ancho'];
$largo=$_REQUEST['largo'];
$mt2=$_REQUEST['mt2'];
$factorOT=$_REQUEST['factorOT'];
$descOT=$_REQUEST['descOT'];

//echo $percep_suc."-".$percep_doc."-".$min_percep_doc."-".$est_percep_clie."-".$por_percep_clie."-";

if($tmoneda==02){
$total_doc=$total_doc*$tc;
}

 if(isset($_REQUEST['trans'])){
  $visible=" style='display:none' ";
  $ruta_imagen='imgenes/eliminar.gif';
  $ruta_titu=" style='background:url(imagenes/bg_contentbase2.gif); background-position:100px 45px' ";
  $desabilitar=" readonly='readonly' ";
  }else{
	  if(isset($_REQUEST['ptoventa'])){
	  $ruta_imagen='imgenes/eliminar.gif';
	  $ruta_titu=" style='background:url(imagenes/bg_contentbase2.gif); background-position:100px 45px' ";
	  //echo "sg";
	  }else{
	  $visible=" ";  
	  $ruta_imagen='../imgenes/eliminar.gif';
	  $ruta_titu=" style='background:url(../imagenes/bg_contentbase2.gif); background-position:100px 45px' ";
	  }
	  
	  
  }  
  
$tc=$_SESSION['tc'];

	
?>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo111 {color: #006699}
-->
</style>
<table width="735" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td   height="54" colspan="6">
	
	<div style="height:110px; width:735px; overflow-y:scroll; overflow-x:hidden; border:#CCCCCC solid 1xp" >
      <table id="detalle_doc_gen" width="715" border="0" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#F2F2F2">
        <tr <?php echo $ruta_titu?> >
          <td width="45" align="center"><span class="Estilo31">C&oacute;digo</span></td>
          <td width="250"><span class="Estilo31">Descripci&oacute;n</span></td>
          <td width="45" align="center"><span class="Estilo31">UND</span></td>
          <td width="40" align="center"><span class="Estilo31">Cant.</span></td>
          <td width="50" height="18" align="center"><span class="Estilo31">P. Unit.</span></td>
          <td width="45" align="center"><span class="Estilo31">Total</span></td>
          <td width="50" align="center"><span class="Estilo31">Notas</span></td>
          <td width="35" align="center"><span class="Estilo31">E</span></td>
        </tr>
        <?php 
  if(isset($_REQUEST['cod_delete'])){

	$cod=$_REQUEST['cod'];
	
	
			foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
				 
				if($subvalue==$cod || $_SESSION['productos'][2][$subkey]==$cod){
				unset($_SESSION['productos'][0][$subkey]);
				unset($_SESSION['productos'][1][$subkey]); 
				unset($_SESSION['productos'][2][$subkey]); 
				unset($_SESSION['productos'][3][$subkey]); 
				unset($_SESSION['productos'][4][$subkey]);
				unset($_SESSION['productos'][5][$subkey]); 
				unset($_SESSION['productos'][6][$subkey]);
				unset($_SESSION['productos'][7][$subkey]);
				unset($_SESSION['productos'][8][$subkey]);
				unset($_SESSION['productos'][9][$subkey]);
				unset($_SESSION['productos'][10][$subkey]);
				unset($_SESSION['productos'][11][$subkey]);
							 
				
				unset($_SESSION['productos2'][0][$subkey]);
				unset($_SESSION['productos2'][1][$subkey]); 
				unset($_SESSION['productos2'][2][$subkey]); 
				unset($_SESSION['productos2'][4][$subkey]); 
				unset($_SESSION['productos2'][5][$subkey]); 
				unset($_SESSION['productos2'][6][$subkey]); 
				unset($_SESSION['productos2'][7][$subkey]); 
				unset($_SESSION['productos2'][8][$subkey]); 
				unset($_SESSION['productos2'][9][$subkey]); 
				unset($_SESSION['productos2'][10][$subkey]); 
				unset($_SESSION['productos2'][11][$subkey]); 
				
				}
			}
			
			//--------------------------------eliminar series*--------------------------
			
		 if(isset($_SESSION['seriesprod'][2])){
				foreach ($_SESSION['seriesprod'][2] as $subkey=> $subvalue) {
					 
					if($subvalue==$cod){
							
					
					$strSQL="update series set estado='F' where tienda='".$tienda."' and salida='' and producto='".$cod."' and serie='".$_SESSION['seriesprod'][0][$subkey]."' ";
			mysql_query($strSQL,$cn);
			
					unset($_SESSION['seriesprod'][0][$subkey]);
					unset($_SESSION['seriesprod'][1][$subkey]); 
					unset($_SESSION['seriesprod'][2][$subkey]); 
					
					}
				}
		 }	
		 
			 
			//----------------------------------------------------------------------------
		//	print_r($_SESSION['seriesprod'][0]);echo "<br>";
		//	print_r($_SESSION['seriesprod'][1]);echo "<br>";
		//	print_r($_SESSION['seriesprod'][2]);echo "<br>";
			
		
	if($tmoneda!=$mon_ini){	
	 $temp_array=1;	
	}else{
	 $temp_array=0;	
	}		
	
		
		
}else{



		
		
		if(isset($_REQUEST['cambiar_precio'])){
		
		
		
		//$moneda_doc=$_REQUEST['moneda'];
		//$mon_ini=$_REQUEST['mon_ini'];
		$precio_nuevo=$_REQUEST['precio_nuevo'];
		$producto=str_pad($_REQUEST['producto'],6, "0", STR_PAD_LEFT);
		
		//echo $producto;
		//echo $mon_ini." ".$tmoneda." ".$precio_nuevo."    ";
		//echo $precio_nuevo;
		
			if($mon_ini==$tmoneda){
			
				foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
							
							if($subvalue==$producto){
							
							$_SESSION['productos'][2][$subkey]= $precio_nuevo;
							}
				  if($tmoneda=='02'){
				  $_SESSION['productos'][6][$subkey]=$_SESSION['productos'][6][$subkey]*$tc; 
				  }else{
				  $_SESSION['productos'][6][$subkey]=$_SESSION['productos'][6][$subkey]; 
				  }		
				}
				
			//	 echo $producto;
				
			}else{
			
		
				foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
							if($subvalue==$producto){
							$_SESSION['productos2'][2][$subkey] = $precio_nuevo;
							
							//echo $tmoneda." ".$tc;
							if($tmoneda==02){
							$_SESSION['productos'][2][$subkey]=number_format(($precio_nuevo*$tc),4); 	
							//$_SESSION['productos'][6][$subkey]=	number_format(($_SESSION['productos'][6][$subkey]*$tc),4); 					
							}else{
							$_SESSION['productos'][2][$subkey]=number_format(($precio_nuevo/$tc),4); 
							//$_SESSION['productos'][6][$subkey]=	number_format(($_SESSION['productos'][6][$subkey]/$tc),4); 												
							}
						}								
				}
				
				
		   }
			
			
			
		
		}
		
		  			
	if($tmoneda!=$mon_ini){	
	 $temp_array=1;	
	}else{
	 $temp_array=0;	
	}	
			
			
		 if(isset($_SESSION['temp_series'][0])){
		  
			  foreach ($_SESSION['temp_series'][0] as $subkey=> $subvalue) {
			  			  
			  $_SESSION['seriesprod'][0][]=$_SESSION['temp_series'][0][$subkey];
			  $_SESSION['seriesprod'][1][]=$_SESSION['temp_series'][1][$subkey];
			  $_SESSION['seriesprod'][2][]=$_SESSION['temp_series'][2][$subkey];
			  }
						  			  		  
			  unset($_SESSION['temp_series'][0]);
			  unset($_SESSION['temp_series'][1]);
			  unset($_SESSION['temp_series'][2]);
		  }

         
		//	print_r($_SESSION['temp_series'][0]);echo "<br>";
		//	print_r($_SESSION['temp_series'][1]);echo "<br>";
		//	print_r($_SESSION['temp_series'][2]);echo "<br>";
			
			
  		 	//	 echo $temp_array."<br>";	
			//	 print_r($_SESSION['productos'][2]);
			//	 print_r($_SESSION['productos2'][2]);
				 
 			if($accion=="mostrarprod"){
				 	
					//$desabilitar="";
					if($estado=="A"){
						$verestado="ANULADO";
						$desabilitar=" readonly='readonly' ";
					}else{
							if(isset($_REQUEST['cargar_ref'])){
							$verestado="INGRESO";
					 	        if($_REQUEST['copiarDoc']=='S'){
								$desabilitar="  ";
								}
								
							}else{	
													  
								$verestado="CONSULTA";
								$desabilitar=" readonly='readonly' ";
								
							
							}
					 }
				 
				 
				// $_SESSION['productos3'][0]=$_SESSION['productos2'][0];
//				 $_SESSION['productos3'][1]=$_SESSION['productos2'][1];
//				 $_SESSION['productos3'][2]=$_SESSION['productos2'][2];
//				 $_SESSION['productos3'][3]=$_SESSION['productos2'][3];
//				 $_SESSION['productos3'][4]=$_SESSION['productos2'][4];
//				
//					 
//				 $_SESSION['productos3'][0]=$_SESSION['productos'][0];
//				 $_SESSION['productos3'][1]=$_SESSION['productos'][1];
//				 $_SESSION['productos3'][2]=$_SESSION['productos'][2];
//				 $_SESSION['productos3'][3]=$_SESSION['productos'][3];
//				 $_SESSION['productos3'][4]=$_SESSION['productos'][4];
			
			
			}else{
				//echo "dsg";
				if($accion=="cambiar_dolar"){
							
					unset($_SESSION['productos2'][0]);
				    unset($_SESSION['productos2'][1]); 
				    unset($_SESSION['productos2'][2]); 
					unset($_SESSION['productos2'][3]); 
					unset($_SESSION['productos2'][4]);
					unset($_SESSION['productos2'][5]);
					unset($_SESSION['productos2'][6]);
					unset($_SESSION['productos2'][7]);
					unset($_SESSION['productos2'][8]);
					unset($_SESSION['productos2'][9]);
					unset($_SESSION['productos2'][10]);
					unset($_SESSION['productos2'][11]);
					  
				
					  foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
						$_SESSION['productos2'][0][$subkey] = $subvalue;
						$_SESSION['productos2'][1][$subkey] = $_SESSION['productos'][1][$subkey];	
						$_SESSION['productos2'][3][$subkey]=  $_SESSION['productos'][3][$subkey];
						$_SESSION['productos2'][4][$subkey]=  $_SESSION['productos'][4][$subkey];
						$_SESSION['productos2'][5][$subkey]=  $_SESSION['productos'][5][$subkey];
						$_SESSION['productos2'][6][$subkey]=  $_SESSION['productos'][6][$subkey];
						$_SESSION['productos2'][7][$subkey] = $_SESSION['productos'][7][$subkey];
						$_SESSION['productos2'][8][$subkey] = $_SESSION['productos'][8][$subkey];
						$_SESSION['productos2'][9][$subkey] = $_SESSION['productos'][9][$subkey];
						$_SESSION['productos2'][10][$subkey] = $_SESSION['productos'][10][$subkey];	
						$_SESSION['productos2'][11][$subkey] = $_SESSION['productos'][11][$subkey];	
						 
						 if($subvalue!=""){	
							
												
							 if($tmoneda!=$mon_ini){						
							
								if($tmoneda=='02'){
								$_SESSION['productos2'][2][$subkey] = number_format(($_SESSION['productos'][2][$subkey]/$tc),4,'.','');		
								}else{
								$_SESSION['productos2'][2][$subkey] = number_format(($_SESSION['productos'][2][$subkey]*$tc),4,'.','');					
								}
							}else{
							$_SESSION['productos2'][2][$subkey] = number_format($_SESSION['productos'][2][$subkey],4,'.','');				
							
							}
						}else{
						$_SESSION['productos2'][2][$subkey] = $_SESSION['productos'][2][$subkey];
						}
						
					  }
				 $temp_array=1;	
													
				}else{
					$repet_item='N';
									
					if($_REQUEST['esserie']=='S' && isset($_SESSION['productos'][0]) ){
						
						foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
					    	if($subvalue==$cod_prod){
							$_SESSION['productos'][1][$subkey] = $_SESSION['productos'][1][$subkey] + $cantidad;
							$repet_item='S';
							}
						}
											
					}
					
					  if($tmoneda!=$mon_ini){	
						if($repet_item=='N'){
						
						$_SESSION['productos2'][0][] = $cod_prod;
						$_SESSION['productos2'][1][] = $cantidad;	
						$_SESSION['productos2'][2][] = $punitario;	
						$_SESSION['productos2'][3][] = $notas;
						$_SESSION['productos2'][4][] = $presentacion;
						$_SESSION['productos2'][5][] = $presentacion;
						
						$_SESSION['productos2'][6][] = $precosto;
						
						$_SESSION['productos2'][7][] = $ancho;
						$_SESSION['productos2'][8][] = $largo;
						$_SESSION['productos2'][9][] = $mt2;
						$_SESSION['productos2'][10][] = $factorOT;
						$_SESSION['productos2'][11][] = $descOT;
											
						
						if($tmoneda=='02'){
							$_SESSION['productos'][2][] = number_format(($punitario*$tc),4,'.','');		
						}else{
							$_SESSION['productos'][2][] = number_format(($punitario/$tc),4,'.','');					
						}
						
						$_SESSION['productos'][0][] = $cod_prod;
						$_SESSION['productos'][1][] = $cantidad;	
						//$_SESSION['productos'][2][] = $punitario;	
						$_SESSION['productos'][3][] = $notas;
						$_SESSION['productos'][4][] = $presentacion;
						$_SESSION['productos'][5][] = $presentacion;
						$_SESSION['productos'][6][] = $precosto;
						$_SESSION['productos'][7][] = $ancho;
						$_SESSION['productos'][8][] = $largo;
						$_SESSION['productos'][9][] = $mt2;
						$_SESSION['productos'][10][] = $factorOT;
						$_SESSION['productos'][11][] = $descOT;
											
						}
						$temp_array=1;
					}else{
						$_SESSION['productos'][0][] = $cod_prod;
						$_SESSION['productos'][1][] = $cantidad;	
						$_SESSION['productos'][2][] = $punitario;	
						$_SESSION['productos'][3][] = $notas;
						$_SESSION['productos'][4][] = $presentacion;
						$_SESSION['productos'][5][] = $presentacion;
						$_SESSION['productos'][6][] = $precosto;
						$_SESSION['productos'][7][] = $ancho;
						$_SESSION['productos'][8][] = $largo;
						$_SESSION['productos'][9][] = $mt2;
						$_SESSION['productos'][10][] = $factorOT;
						$_SESSION['productos'][11][] = $descOT;
						
						$temp_array=0;
					}	
							
				}
				
		   }
			
 	}	
	
	
 
 
 //print_r($_SESSION['productos'][0]) ;echo "  ".$tmoneda." ".$mon_ini;

  
	 
	 /*
	  if($accion=='eliminar'){
	 
	  }else{
	  $cont=0; 	
	  $strSQL1="select * from producto where cod_prod='$cod_prod'";
	  $resultado1=mysql_query($strSQL1,$cn);
	  $cont=mysql_num_rows($resultado1);
		  while($row1=mysql_fetch_array($resultado1)){
		   $nom_prod=$row1['nombre'];
		   $precio=$row1['precio'];
		   $unidad=$row1['nom_unid'];
		  }
		
	  mysql_free_result($resultado1);
	 	 	  
	  }
	  
	  */
 
// 	if(!isset($_REQUEST['cargar_ref'])){
/*
print_r($_SESSION['productos'][9]);
echo "<br>";
print_r($_SESSION['productos'][10]);
//echo "<br>--$tmoneda  $mon_ini---$temp_array--<br>";
echo "<br>";
print_r($_SESSION['productos2'][9]);
echo "<br>";
print_r($_SESSION['productos2'][10]);
echo "<br>";
//print_r($_SESSION['seriesprod'][0])."  ". print_r($_SESSION['seriesprod'][2]);
*/
 
 
		 if($temp_array==1){
		
		 $_SESSION['productos3'][0]=$_SESSION['productos2'][0];
		 $_SESSION['productos3'][1]=$_SESSION['productos2'][1];
		 $_SESSION['productos3'][2]=$_SESSION['productos2'][2];
		 $_SESSION['productos3'][3]=$_SESSION['productos2'][3];
         $_SESSION['productos3'][4]=$_SESSION['productos2'][4];
         $_SESSION['productos3'][5]=$_SESSION['productos2'][5];
		 $_SESSION['productos3'][6]=$_SESSION['productos2'][6];
		 $_SESSION['productos3'][7]=$_SESSION['productos2'][7];
		 $_SESSION['productos3'][8]=$_SESSION['productos2'][8];
		 $_SESSION['productos3'][9]=$_SESSION['productos2'][9];
		 $_SESSION['productos3'][10]=$_SESSION['productos2'][10];
		 $_SESSION['productos3'][11]=$_SESSION['productos2'][11];
		 
		
		 }else{
		 
		 
		 $_SESSION['productos3'][0]=$_SESSION['productos'][0];
		 $_SESSION['productos3'][1]=$_SESSION['productos'][1];
		 $_SESSION['productos3'][2]=$_SESSION['productos'][2];
         $_SESSION['productos3'][3]=$_SESSION['productos'][3];
		 $_SESSION['productos3'][4]=$_SESSION['productos'][4];
 		 $_SESSION['productos3'][5]=$_SESSION['productos'][5];
		 $_SESSION['productos3'][6]=$_SESSION['productos'][6];
		 $_SESSION['productos3'][7]=$_SESSION['productos'][7];
		 $_SESSION['productos3'][8]=$_SESSION['productos'][8];
		 $_SESSION['productos3'][9]=$_SESSION['productos'][9];
		 $_SESSION['productos3'][10]=$_SESSION['productos'][10];
		 $_SESSION['productos3'][11]=$_SESSION['productos'][11];
		 
		 
		 }
	 
//	} 

 $items=0;
 $total_inafecto=0;

   // print_r($_SESSION['productos3'][10]);
	
foreach ($_SESSION['productos3'][0] as $subkey=> $subvalue) {

   if($subvalue!=""){
 
	 $strSQL4="select * from producto where idproducto='".$subvalue."' ";
	 $resultado4=mysql_query($strSQL4,$cn);
	 //echo $strSQL4;
	  
	  while($row4=mysql_fetch_array($resultado4)){
	  $items++;
	  $manejaserie=$row4['series'];
	  $percepcion=$row4['agente_percep'];
	  $valor_percep=$row4['valor_percep'];
	  $maneja_factorOT=$row4['factorOT'];
	  	  	  	  
	  
?>
        <tr>
          <td align="center" bgcolor="#FFFFFF" class="Estilo_det" ><a  style='cursor=pointer; text-decoration:underline' onclick='espec_prod(this)'><?php echo $row4['idproducto']?></a></td>
          <td bgcolor="#FFFFFF" class="Estilo_det" ><?php echo caracteres($row4['nombre']);?></td>
          <td align="center" bgcolor="#FFFFFF" class="Estilo_det" ><?php 
		  $strSQL_subuni="select * from unidades where id='".$_SESSION['productos3'][4][$subkey]."'";
		 // echo $strSQL_subuni;
		  $resultado=mysql_query($strSQL_subuni,$cn); 
		  $row=mysql_fetch_array($resultado);
		  echo $row['nombre'];
		  
		  ?>		  </td>
		  <td align="center" bgcolor="#FFFFFF" class="Estilo_det" >
		  
		  
		  <?php 
		  
		 // echo $permiso;
		// echo $_REQUEST['cargar_ref'];
		//  if($_SESSION['productos3'][5][$subkey]!='ref'){
		  
			  if($manejaserie=='S' && $permiso10=='S' ){
			  echo "<a title='mostrar series' style='cursor=pointer; text-decoration:underline' onclick=editar_serie('".$row4['idproducto']."',this)>".$_SESSION['productos3'][1][$subkey]."</a>" ; 
			  }else{
			  echo $_SESSION['productos3'][1][$subkey] ; 
			  }
			  
		 // }else{
		  //echo $_SESSION['productos3'][1][$subkey] ; 
		  //}	  
		  
		 /*
			  if($tmoneda=='02'){
			  $punit_conv=$_SESSION['productos3'][6][$subkey]/$tc;
			  }else{
			  $punit_conv=$_SESSION['productos3'][6][$subkey];
			  }
		*/	  
			  
			// print_r($_SESSION['productos3'][0][$subkey]); 			  			  
		  ?>		  </td>
          <td width="50px" align="right" bgcolor="#FFFFFF" class="Estilo_det" >
		    <input name="precosto_det" type="hidden" id="precosto_det" value="<?php echo $punit_conv; ?>" size="8" maxlength="10" />
			<?php $desabilitar="readonly"; //if(isset($_REQUEST['copiar'])) $desabilitar=""; ?>
			
			
		    <input <?php echo $desabilitar; ?> style="text-align:right" name="punit_det[]" type="text" id="punit_det" value="<?php echo $_SESSION['productos3'][2][$subkey] ; ?>" size="8" maxlength="10" onkeyup="recalcular_precios(this,'<?php echo $_SESSION['productos3'][0][$subkey] ?>',event,<?php echo $row4['precio5'] ?>,<?php echo $row4['moneda'] ?>,<?php echo $_SESSION['productos3'][2][$subkey]?>)" /></td>
          <td align="right" bgcolor="#FFFFFF" class="Estilo_det" ><?php		
		
		if($row4['igv']=='N'){
		 	if($maneja_factorOT=='S'){
				$total_inafecto=$total_inafecto+$_SESSION['productos3'][9][$subkey] * $_SESSION['productos3'][10][$subkey] * $_SESSION['productos3'][2][$subkey]-$_SESSION['productos3'][11][$subkey] ;
				
				
		 		//echo number_format($total_inafecto,2)." &nbsp;";	
				echo $total_inafecto=round($total_inafecto,0)." &nbsp;";
			}else{
				$total_inafecto=$total_inafecto+$_SESSION['productos3'][1][$subkey] * $_SESSION['productos3'][2][$subkey]-$_SESSION['productos3'][11][$subkey] ;
				
				echo $total_inafecto=round($total_inafecto,0)." &nbsp;";
				//echo number_format($total_inafecto,2)." &nbsp;";
			}
		
			if($percep_suc=='S'){
				if($percep_doc=='S'){
			//echo "dg";
					if($est_percep_clie!=0){
					$valor_percep=$por_percep_clie;
					}
						if($percepcion=='S'){
						$total_percepcion=$total_percepcion + ($total_inafecto*$valor_percep/100);			
						}
										
				}			
			}
		
			
		}else{
		
		 if($maneja_factorOT=='S'){
		 $totalitem=$_SESSION['productos3'][9][$subkey]*$_SESSION['productos3'][10][$subkey]* $_SESSION['productos3'][2][$subkey] ;
		 }else{
		 $totalitem=$_SESSION['productos3'][1][$subkey] * $_SESSION['productos3'][2][$subkey] ;
		 }
		 
		 $total=$total + $totalitem-$_SESSION['productos3'][11][$subkey];
		 $total=round($total,0);
		 
		 if($maneja_factorOT=='S'){
		 $totalitem2=$_SESSION['productos'][10][$subkey]*$_SESSION['productos'][9][$subkey]* $_SESSION['productos'][2][$subkey] ;
		 }else{
		 $totalitem2=$_SESSION['productos'][1][$subkey] * $_SESSION['productos'][2][$subkey] ;
		 }
		 $total2=$total2 + $totalitem2-$_SESSION['productos3'][11][$subkey];
		 $total2=round($total2,0);
		 
		 echo $totalitem=round($totalitem-$_SESSION['productos3'][11][$subkey],0)." &nbsp;";
		 	
			   if($percep_suc=='S'){
					if($percep_doc=='S'){
				//echo "dg $totalitem $valor_percep";
						if($est_percep_clie!=0){
						$valor_percep=$por_percep_clie;
						}
							if($percepcion=='S'){
							$total_percepcion=$total_percepcion + ($totalitem*$valor_percep/100);			
							}
											
					}			
				}
				
				
 
		}
		 	
		
		 
		 ?>		 </td>
          <td align="left" bgcolor="#FFFFFF" style="cursor:pointer" class="Estilo_det" title="<?php echo $_SESSION['productos3'][3][$subkey] ; ?>" ><?php 
		  if($_SESSION['productos3'][3][$subkey]!=""){
		  echo  substr($_SESSION['productos3'][3][$subkey],0,6)."<span style='color:#0033FF'>...</span>" ; 
		  }
		  ?></td>
          <td align="center" bgcolor="#FFFFFF"><a href="javascript:verDatosOT('<?php echo $row4['idproducto']?>')"><img src="../imagenes/ico_lupa.jpg" width="15" height="14" border="0" alt="Ver datos del Item(factores)" /></a>&nbsp;<a href="javascript:eliminar('<?php echo $row4['idproducto']?>')"><img src="<?php echo $ruta_imagen;?>" width="14" height="14" border="0" /></a></td>
        </tr>
        <?php 
	     }
    
    }else{
	
	
	?>
        <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
          <td align="center" bgcolor="#FFFFFF" >&nbsp;</td>
          <td bgcolor="#FFFFFF" ><?php echo $_SESSION['productos3'][2][$subkey]; ?></td>
          <td align="right" bgcolor="#FFFFFF" >&nbsp;</td>
          <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
          <td align="right" bgcolor="#FFFFFF" >&nbsp;</td>
          <td colspan="2" align="right" bgcolor="#FFFFFF" >&nbsp;</td>
          <td align="center" bgcolor="#FFFFFF"><a href="javascript:eliminar('<?php echo $_SESSION['productos3'][2][$subkey]; ?>')"><img src="<?php echo $ruta_imagen;?>" width="14" height="14" border="0" /></a></td>
        </tr>
        <?php 
	
	
	}
	  
}
  
  if($tmoneda==02){
  $total_percepcion_temp=$total_percepcion*$tc;
  }else{
  $total_percepcion_temp=$total_percepcion;
  }
 // echo $total_percepcion_temp ." ". $min_percep_doc ;
  if($total_percepcion_temp < $min_percep_doc){
  $total_percepcion=0;
  }
  
  if(isset($_REQUEST['percep_recp'])){
  $total_percepcion=$_REQUEST['percep_recp'];
  }
 
  
 if($incluidoigv=='S'){ 
 //echo "(  Incl.Impstos )";
  $monto=$total/$valor_impto+$total_inafecto;
  $impuesto=($total+$total_inafecto)-$monto;
  $total=$monto+$impuesto;
//  $total=$monto+$impuesto+$total_percepcion;
 //echo "$total/$valor_impto+$total_inafecto";
  $monto2=$total2/$valor_impto+$total_inafecto;
  $impuesto2=($total2+$total_inafecto)-$monto2;
  //$total2=$monto2+$impuesto2+$total_percepcion;
  $total2=$monto2+$impuesto2;
    
 }else{
 //echo "(  NO Incl.Impstos )"; 
  $monto=$total+$total_inafecto;
  $impuesto=$impto*($total);
  //$total=$monto+$impuesto+$total_percepcion;
  $total=$monto+$impuesto;
  
  $monto2=$total2+$total_inafecto;
  $impuesto2=$impto*($total2);
  //$total2=$monto2+$impuesto2+$total_percepcion;
  $total2=$monto2+$impuesto2;
   
 }
 
  if($permiso4=='S'){
  $doc_infecto=" style='visibility:hidden' ";
  $incluidoigv='N';
  
  $monto=$total;
  $impuesto=0.00;
  $total=$monto+$impuesto;
  
  $monto2=$total2;
  $impuesto2=0.00;
  $total2=$monto2+$impuesto2;
    
  }
     
//echo "moneda ".$tmoneda." ".$_REQUEST['tmoneda2']; 
if($tmoneda=="02" || $_REQUEST['tmoneda2']=="02"){
$simb_moneda="(US$.)";
}else{
$simb_moneda="(S/.)";
}


if($accion=="mostrarprod")
{
	
	if($estado=="A"){
		$verestado="ANULADO";
		}else{
			if(isset($_REQUEST['cargar_ref'])){
			$verestado="INGRESO";
			
			}else{		
		    $verestado="CONSULTA";
			
			
			
		    }
		}
}else{
	
	$verestado="INGRESO";
	
}



  
  ?>
      </table>
    </div></td>
  </tr>
  <tr>
    <td colspan="6" height="5"></td>
  </tr>
  <tr <?php echo $visible?> >
    <td align="left"  style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Nro. Items</td>
    <td align="left"  style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#0066CC"><strong id="nitems"><?php echo $items?></strong></td>
    <td align="center"  style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">&nbsp;</td >
    <td align="right" style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333"><span <?php echo $doc_infecto?> >SubTotal </span></td>
    <td align="center" <?php echo $doc_infecto?>><strong>
      <input readonly="readonly" name="monto2" type="text" size="10" style="text-align:right"  value="<?php echo number_format($monto,2);?>"/>
    </strong></td>
    <td><strong>
      <input name="monto" type="hidden" size="10" style="text-align:right"  value="<?php echo number_format($monto,2,'.','');?>"/>
    </strong></td>
  </tr>
  <tr <?php echo $visible?> >
    <td width="72" align="left"  style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333"><strong>Importe&nbsp;</strong> </td>
    <td width="188" align="left"  style="font:Arial, Helvetica, sans-serif; font-size:11px"><label style="color:#0066CC" id="incluyeimp">
      <?php
	  if($permiso4=='N'){
		   if($incluidoigv=='S'){ 
		   echo "(  Incl.Impstos )";
		   }else{ 
		   echo "(  NO Incl.Impstos )";
		   }
	  }else{
	  	   echo "<strong> INAFECTO </strong>";	
	  }
	   ?>
    </label></td>
    <td width="113" align="center"  style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333"><strong>Estado </strong></td >
        <td align="right" style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333"><span <?php echo $doc_infecto?>>Impuesto1(<?php echo $num_impto?>%) </span></td>
    <td align="center" <?php echo $doc_infecto?>><strong>
      <input readonly="readonly" name="impuesto2" type="text" size="10" style="text-align:right"  value="<?php echo number_format($impuesto,2) ;?>"/>
    </strong></td>
    <td><strong>
      <input name="impuesto1" type="hidden" size="10" style="text-align:right"  value="<?php echo number_format($impuesto,2,'.','') ;?>"/>
    </strong></td>
  </tr>
  <tr <?php echo $visible?> >
    <td align="left"  style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">Moneda<strong>&nbsp;</strong></td>
    <td align="left"  style="font:Arial, Helvetica, sans-serif; font-size:11px; "><label style="color:#FF0000" id="moneda"><?php echo $simb_moneda; ?></label></td>
    <td align="center"  style="font:Arial, Helvetica, sans-serif; font-size:11px; "><span style="font:Arial, Helvetica, sans-serif; font-size:11px;"><strong> (
      <label id="estado" style="color:#FF0000"><?php echo $verestado?></label>
      )
      <!-- <input name="estado" type="text" size="10" maxlength="20" value="" readonly="readonly"/>-->
    </strong></span></td>
    <td  align="right"  style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333"><span class="Estilo111" style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold">TOTAL DOC </span></td>
    <td  align="center"  ><strong>
      <input readonly="readonly" name="total_doc2" type="text" size="10" style="text-align:right"  value="<?php echo number_format($total,2);?>"/>
    </strong></td>
    <td><strong>
      <input name="total_doc" type="hidden" size="10" style="text-align:right"  value="<?php echo number_format($total,2,'.','');?>"/>
    </strong></td>
  </tr>
  <tr  <?php echo $visible?> >
    <td align="left"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">Tipo Cambio </span>&nbsp;</td>
    <td colspan="2" align="left"><input  readonly="readonly" name="text" type="text" id="tcambio" style="text-align:right; color:#FF0000"  value="<?php echo $_SESSION['tc']  ;?>" size="5" maxlength="10"/></td>
    <td <?php if($tipomov==2) echo "style='visibility:hidden' "; ?> width="185" align="right"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Percepci&oacute;n</span></td>
    <td <?php if($tipomov==2) echo "style='visibility:hidden' "; ?> width="72" align="center"><strong>
      <input readonly="readonly" name="percepcion" id="percepcion" type="text" size="10" style="text-align:right"  value="<?php echo number_format($total_percepcion,2) ;?>"/>
    </strong></td>
    <td width="105">&nbsp;</td>
  </tr>
  <tr  <?php echo $visible?> >
    <td align="left">&nbsp;</td>
    <td colspan="2" align="left">&nbsp;</td>
    <td <?php if($tipomov==1) echo "style='visibility:hidden' "; ?> align="right"><span class="Estilo111" style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold">TOTAL A PAGAR </span></td>
    <td <?php if($tipomov==1) echo "style='visibility:hidden' "; ?> align="center"><strong>
      <input readonly="readonly" name="totalpagar" id="totalpagar" type="text" size="10" style="text-align:right"  value="<?php echo number_format(($total_percepcion+$total),2) ;?>"/>
    </strong></td>
    <td>&nbsp;</td>
  </tr>
</table>
