<?php 
session_start();
include('conex_inicial.php');
include("funciones/funciones.php");

$ruta_imagen='imgenes/eliminar.gif';
		
	if(isset($_REQUEST['save'])){	
	
			$codigo=$_REQUEST['cod_docu'];
			$strSQL_del="delete from detope where documento='".$codigo."'";
			mysql_query($strSQL_del,$cn);
			
			$array_deuda=$_REQUEST['deuda'];
			
			$_SESSION['array_des'][2][]=explode("-",$array_deuda);
			
			echo $array_deuda;
			
			foreach ($_SESSION['array_des'][0] as $subkey=> $subvalue) {
			
				if($_SESSION['array_des'][1][$subkey]!=''){
				$strSQl="insert into detope(documento,condicion,descondi)values('".$codigo."','".$_SESSION['array_des'][0][$subkey]."','".$_SESSION['array_des'][1][$subkey]."') ";
				
				mysql_query($strSQl,$cn);
																
				}

 			 }
	
	//echo $strSQL_del;
		
	}else{
				
				
	if(isset($_REQUEST['add'])){
	
	
		if(isset($_REQUEST['delete'])){

			$condicion=$_REQUEST['condicion'];
	
				foreach ($_SESSION['array_des'][0] as $subkey=> $subvalue) {
					 
					if($subvalue==$cod || $_SESSION['array_des'][0][$subkey]==$condicion){
					unset($_SESSION['array_des'][0][$subkey]);
					unset($_SESSION['array_des'][1][$subkey]); 
					unset($_SESSION['array_des'][2][$subkey]); 
			
					}
							
				}
		
	     }else{
		
		$condicion=$_REQUEST['condicion'];
		$descondi=$_REQUEST['descondi'];
		$deuda=$_REQUEST['deuda'];
		
		 $_SESSION['array_des'][0][] = $condicion;
		 $_SESSION['array_des'][1][] = $descondi;
		 $_SESSION['array_des'][2][] = $deuda;
     		 
	//	 print_r($_SESSION['array_des'][1]);
	//	 echo "<br>";	 
	//	 print_r($_SESSION['array_des'][2]);
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
.Estilo1 {font-family: Arial, Helvetica, sans-serif}
.Estilo2 {font-size: 11px}
.Estilo11 {color: #000000}
.texto1 {	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #000000;
}
.Estilo13 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #000000; }
-->
</style>
		 
			
		 
		 <?php 
		 		
		}else{
		
			if(isset($_REQUEST['det_ref'])){
			
				if($_REQUEST['accion']=='quitar'){
				
						$cod=$_REQUEST['cod'];
						$codigo=$_REQUEST['cod_ref'];
						$cod_clie_ref=$_REQUEST['codcliente_ref'];
						$des_clie_ref=$_REQUEST['descliente_ref'];
			
												
						foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
						 
							if($subvalue==$cod || $_SESSION['productos'][2][$subkey]==$cod){
							unset($_SESSION['productos'][0][$subkey]);
							unset($_SESSION['productos'][1][$subkey]); 
							unset($_SESSION['productos'][2][$subkey]); 
												
							}
								
				    	}
                					
				}elseif($_REQUEST['accion']=='update'){				 
						$cod=$_REQUEST['cod'];
						$codigo=$_REQUEST['cod_ref'];
						$cod_clie_ref=$_REQUEST['codcliente_ref'];
						$des_clie_ref=$_REQUEST['descliente_ref'];
						$cant_prod=$_REQUEST['cant_prod'];
						$ckbNC=$_REQUEST['ckbNC'];
						$ver = explode(',',$ckbNC);									

						foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {							
							
							if ($ver[$subkey+1]=='true'){
								$_SESSION['productos'][6][$subkey]="checked";	
							}else{
								$_SESSION['productos'][6][$subkey]="";	
							}
							
							if (count($_SESSION['productos'][0])==1){
								$_SESSION['productos'][6][0]="checked";	
							}
							
							if($subvalue==$cod || $_SESSION['productos'][2][$subkey]==$cod){						
								$_SESSION['productos'][1][$subkey]=$cant_prod;	
							}
								
				    	}
                					
				}else{
					
					unset($_SESSION['productos'][0]);
				    unset($_SESSION['productos'][1]); 
				    unset($_SESSION['productos'][2]); 
					
					$sucursal=$_REQUEST['sucursal'];
					$doc=$_REQUEST['doc'];
					$serie=$_REQUEST['serie'];
					$numero=$_REQUEST['numero'];
								
					$strSQL="select * from cab_mov where sucursal='$sucursal' and cod_ope='$doc' and serie='$serie' and Num_doc='$numero' ";
					$resultado=mysql_query($strSQL,$cn);
					$row=mysql_fetch_array($resultado);
					$codigo=$row['cod_cab'];
					$cod_clie_ref=$row['cliente'];
					$moneda_doc=$row['moneda'];
					$impto=$row['impto1'];
					
					$strSQL2="select * from cliente where codcliente='$cod_clie_ref' ";
					$resultado2=mysql_query($strSQL2,$cn);
					$row2=mysql_fetch_array($resultado2);
					$des_clie_ref=$row2['razonsocial'];
									
					
					
									
					$strSQL3="select * from det_mov where cod_cab='$codigo' ";
					$resultado3=mysql_query($strSQL3,$cn);
					while($row3=mysql_fetch_array($resultado3)){
					  	
						//*-*-**-*Verificar que no tenga NT referenciados-*--*-*
		  			$strSQLCP="select * from det_mov where 
					cod_cab in ( select cod_cab from referencia where cod_cab_ref='$codigo' )
				 	and cod_prod='".$row3['cod_prod']."' ";
					$resultadoCP=mysql_query($strSQLCP,$cn);
					while($rowCP=mysql_fetch_array($resultadoCP)){
			  			$catPR=$catPR+$rowCP['cantidad'];
					}
			  			//*-*-*-*--*--*-*-						
						
					  	if($row3['cod_prod']!='TEXTO'){
							if ($row3['cantidad']<>$catPR){						
								$_SESSION['productos'][0][] = $row3['cod_prod'];
								$_SESSION['productos'][1][] = $row3['cantidad']-$catPR;	
								$_SESSION['productos'][2][] = $row3['precio'];
								$_SESSION['productos'][4][] = $row3['unidad'];	
								$_SESSION['productos'][5][] = $row3['nom_prod'];
								$_SESSION['productos'][6][] = $row3['ckb'];
								$_SESSION['productos'][7][] = $row3['cantidad']-$catPR;							
							}
						$catPR=0;
						
						$strSQL_series="select * from series where producto='".$row3['cod_prod']."' and salida='".$codigo."' ";
							$resultado_series=mysql_query($strSQL_series,$cn);
							while($row_series=mysql_fetch_array($resultado_series)){
							
							 $_SESSION['seriesprod'][0][]=$row_series['serie'];
							 $_SESSION['seriesprod'][1][]="";
							 $_SESSION['seriesprod'][2][]=$row_series['producto'];
							
							}
							
						
					 	}else{
						$_SESSION['productos'][0][] = "";
						$_SESSION['productos'][1][] = "";
						$_SESSION['productos'][2][] = $row3['nom_prod'];
						$_SESSION['productos'][5][] = "ref";		
						}
						
					}	
					
				    if($codigo==''){
					$_SESSION['productos'][0][] = "";
					$_SESSION['productos'][1][] = "";
					$_SESSION['productos'][2][] = "";	
					$temp='N';
				    }						
				}	
										
			echo $temp.'?'.$codigo.'?'.$cod_clie_ref.'?'.caracteres($des_clie_ref).'?'.$moneda_doc.'?'.$impto.'?';				
				
			//	echo "ddd ".$_REQUEST['cod_clie_ref'];
				?>
					
					<table width="474" border="0" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF" id="lista_prodNC">
        <?php 
		$total_doc=0;
if (count($_SESSION['productos'][0])<>0){ // si no hay registros* 	
foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
   if($subvalue!=""){ 

 	 $strSQL4="select * from producto where idproducto='".$subvalue."' ";
	 $resultado4=mysql_query($strSQL4,$cn);	 
	 while($row4=mysql_fetch_array($resultado4)){	
	
	 ?>
        <tr bgcolor="" onClick="enfocar_prod(this);" <? if ($_SESSION['productos'][6][$subkey]!=''){ echo 'style="background-color:#999999"';}?> >
          <td width="32" align="center" class="Estilo_det"   ><span class="texto1">
            <input name="codigoNT" type="checkbox" id="codigoNT" style="border: 0px; background:none; " onclick="marcar_NC('U')" value="<?php echo $row4['idproducto']?>" <?=$_SESSION['productos'][6][$subkey];?> 
			  onchange="Modificar_Precio2(event,this,'<?php echo $subkey ?>');"  />			
          </span></td>
          <td width="32" align="center" class="Estilo_det" ><?php echo $row4['idproducto']?></td>
          <td width="281" class="Estilo_det" ><?php echo caracteres($row4['nombre']);?></td>
          <td width="36" align="center" class="Estilo_det" ><?php 
$resultados11 = mysql_query("select * from unidades where id='".$_SESSION['productos'][4][$subkey]."' ",$cn); 					   			$rowSM=mysql_fetch_array($resultados11);
			echo $rowSM['nombre'];
		   ?></td>
          <td width="36" align="center" class="Estilo_det" >		  	  
		  <input name="cantX" type="hidden" id="cantX"  value="<?php echo $_SESSION['productos'][7][$subkey] ?>" size="4" style="text-align:center" />
		  <input name="cant_det" type="text" id="cant_det" onkeyup="Modificar_Precio(event,this,'<?php echo $subkey ?>')" value="<?php echo $_SESSION['productos'][1][$subkey] ?>" size="4" style="text-align:center"  <? if ($_SESSION['productos'][6][$subkey]==''){ echo 'disabled';}?> /></td>
          <td width="40" align="right" class="Estilo_det" ><?php echo $_SESSION['productos'][2][$subkey] ; ?>          </td>
          <td width="45" align="right" class="Estilo_det" ><?php		
		 $totalitem=$_SESSION['productos'][1][$subkey] * $_SESSION['productos'][2][$subkey] ;
		 $total=$total + $totalitem;	
		 echo number_format($totalitem,2);	
		 
		// echo $_SESSION['productos'][6][$subkey];
		
		 if ($_SESSION['productos'][6][$subkey]=='checked'){
		 $total_doc+=$totalitem;
		 }
		 
		 ?></td>
          </tr>
        <?php 
	     }

    }else{	
	?>
        <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
          <td align="center" bgcolor="#FFFFFF" >&nbsp;</td>
          <td align="center" bgcolor="#FFFFFF" >&nbsp;</td>
          <td bgcolor="#FFFFFF" ><?php echo $_SESSION['productos'][2][$subkey]; ?></td>
          <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
          <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
          <td align="right" bgcolor="#FFFFFF" >&nbsp;</td>
          <td align="right" bgcolor="#FFFFFF" >&nbsp;</td>
          </tr>
        <?php 
	
	
	}
} // si no hay registros* 
}
  
  
  ?>
      </table>
					
	                <span class="Estilo_det">
<input name="total_doc" type="hidden" id="total_doc"  value="<?=$total_doc;?>" size="4" style="text-align:center" />
<input name="monto" type="hidden" id="monto"  value="<?		
		$impMonto=$total_doc/$_REQUEST['impuesto'];
		if ($impMonto<>$total_doc){
		echo number_format($total_doc/$_REQUEST['impuesto'],2);	
		}else{
		echo '0';
		}
?>" size="4" style="text-align:center" />
<input name="impuesto1" type="hidden" id="impuesto1"  value="<?=number_format($total_doc-$impMonto,2);?>" size="4" style="text-align:center" />

	                </span>
	                <?php 
//--------------------------------------------------------------------------------------------------------------								
			}else{			
			
			if( isset($_REQUEST['codDoc']) && $_REQUEST['codDoc']!=""){
			
			$codDoc=$_REQUEST['codDoc'];
			$desDoc=$_REQUEST['desDoc'];
			$tipoDoc=$_REQUEST['tipoDoc'];			
			
			$strSQL="insert into operacion(codigo,tipo,descripcion) values('".$codDoc."','".$tipoDoc."','".$desDoc."')";
			//echo $strSQL;
			mysql_query($strSQL,$cn);			
			}else{			
		
		$valor=$_REQUEST['valor'];
		$aplicacion=$_REQUEST['aplicacion'];
		
		$strSQL="select * from operacion where codigo='".$valor."' and tipo='$aplicacion' order by descripcion ";
		$resultados = mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultados);
		
		echo $row['codigo']."#". strtoupper($row['descripcion'])."#".$row['imp1']."#".$row['imp2']."#".$row['kardex']."#".substr($row['p1'],0,1)."#".substr($row['p1'],1,1)."#".substr($row['p1'],2,1)."#".substr($row['p1'],3,1)."#".substr($row['p1'],4,1)."#".substr($row['p1'],5,1)."#".substr($row['p1'],6,1)."#".substr($row['p1'],7,1)."#".substr($row['p1'],8,1)."#".substr($row['p1'],9,1)."#".substr($row['p1'],10,1)."#".substr($row['p1'],11,1)."#".substr($row['p1'],12,1)."#".substr($row['p1'],13,1)."#".substr($row['p1'],14,1)."#".substr($row['p1'],15,1)."#".substr($row['p1'],16,1)."#".substr($row['p1'],17,1)."#".substr($row['p1'],18,1)."#".$row['sunat']."#".$row['comentario1']."#".$row['comentario2']."#".$row['obs1']."#".$row['obs2']."#".$row['obs3']."#".$row['obs4']."#".$row['obs5']."#".$row['formato']."#".$row['nitems']."#".$row['cola']."#".$row['min_percep']."#".$row['moneda']."#";
		}
		
		}
		}
		
		}
	   	
?>
					