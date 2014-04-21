<?php 
session_start();
include('conex_inicial.php');
include("funciones/funciones.php");

$tipo=$_REQUEST['tipo'];
$peticion=$_REQUEST['peticion'];
$tit="Condiciones";
$tit2="Deuda";
$ruta_imagen='imgenes/eliminar.gif';
$del_tabla="delete from detope";
$ins_tabla="insert into detope(documento,condicion,descondi,deuda)";
if(isset($_REQUEST['peticion'])){
	switch($peticion){
		case 'doc':$tit2="";$del_tabla="delete from refope";$ins_tabla="insert into refope(documento,tipo,codigo,descripcion,deuda)";$tit="Documentos";
	}
}
			if(isset($_REQUEST['save'])){	
	
				$codigo=$_REQUEST['cod_docu'];
				//$strSQL_del="delete from detope where documento='".$codigo."'";
				$strSQL_del=$del_tabla." where documento='".$codigo."'";
				mysql_query($strSQL_del,$cn);
			
				$array_deuda=$_REQUEST['deuda'];
			
				$array_deuda="-".substr($_REQUEST['deuda'],0,strlen($_REQUEST['deuda'])-1);
				
				$_SESSION['array_des'][2]=explode("-",$array_deuda);
				
				/*print_r($_SESSION['array_des'][0]);
				print_r($_SESSION['array_des'][2]);*/
				
				foreach ($_SESSION['array_des'][0] as $subkey=> $subvalue) {
			
					if($_SESSION['array_des'][1][$subkey]!=''){
						$strSQl=$ins_tabla;
						if($peticion=='doc'){
							$strSQl.="values('".$codigo."','".$tipo."','".$_SESSION['array_des'][0][$subkey]."','".$_SESSION['array_des'][1][$subkey]."','') ";
						}else{
							$strSQl.="values('".$codigo."','".$_SESSION['array_des'][0][$subkey]."','".$_SESSION['array_des'][1][$subkey]."','".$_SESSION['array_des'][2][$subkey]."') ";
						}
				
						//echo $strSQl."<br>";
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
		if($peticion=='doc'){
			$condicion=$_REQUEST['condicion'];
			$descondi=$_REQUEST['descondi'];
		
			$_SESSION['array_des'][0][] = $condicion;
			$_SESSION['array_des'][1][] = $descondi;
		}else{
			$condicion=$_REQUEST['condicion'];
			$descondi=$_REQUEST['descondi'];
			$deuda=$_REQUEST['deuda'];
		
			$_SESSION['array_des'][0][] = $condicion;
			$_SESSION['array_des'][1][] = $descondi;
			$_SESSION['array_des'][2][] = $deuda;
		}
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
-->
</style>
		 
			 <table id="lista_condi" width="270" border="0" cellpadding="1" cellspacing="1">
			<tr>
		      <td width="22" height="10" bgcolor="#1FAF9D">&nbsp;</td>
              <td width="192" height="12" bgcolor="#1FAF9D"><span class="Estilo20"><?php echo $tit; ?></span></td>
			  <td width="31" bgcolor="#1FAF9D"><span class="Estilo20"><?php echo $tit2; ?></span></td>
			  </tr>
			
			<?php 
			
			foreach ($_SESSION['array_des'][1] as $subkey=> $subvalue) {
				if($_SESSION['array_des'][1][$subkey]!=''){
				
					if($_SESSION['array_des'][2][$subkey]=='S'){
					$marcar=" checked='checked' ";				
					}else{
					$marcar=" ";
					}
							
			?>
			<tr onClick="entrada(this)" bgcolor="#FFFFFF">
		     <td >			 
			 <input  name="radiobutton"  type="radio" value="<?php echo $_SESSION['array_des'][0][$subkey]?>" style="border:#FFFFFF solid 1px">			 </td>
			  <td  class="EstiloL1"><?php echo caracteres($_SESSION['array_des'][1][$subkey]) ?></td>
			  <td ><?php if($tit2!=""){ ?><input <?php echo $marcar ?> type="checkbox" name="deuda[]" id="deuda" value="checkbox" style="border:#FFFFFF solid 1px"><?php } ?></td>
			  </tr>
			<?php 
				}
			}
			?>
</table>
		 
		 <?php 
		 		 		 
		 
				
		}else{
		
		
		
			if(isset($_REQUEST['det_ref'])){
			
			
				if($_REQUEST['accion']=='quitar'){
				
						$cod=$_REQUEST['cod'];
						$codigo=$_REQUEST['cod_ref'];
						$cod_clie_ref=$_REQUEST['codcliente_ref'];
						$des_clie_ref=$_REQUEST['descliente_ref'];
					//echo "d ".$cod_clie_ref;
						
												
						foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
						 
							if($subvalue==$cod || $_SESSION['productos'][2][$subkey]==$cod){
							unset($_SESSION['productos'][0][$subkey]);
							unset($_SESSION['productos'][1][$subkey]); 
							unset($_SESSION['productos'][2][$subkey]); 
							unset($_SESSION['productos'][4][$subkey]);
							unset($_SESSION['productos'][5][$subkey]); 
							unset($_SESSION['productos'][6][$subkey]); 
							unset($_SESSION['productos'][7][$subkey]);
							unset($_SESSION['productos'][20][$subkey]); 
							unset($_SESSION['productos'][21][$subkey]); 
							unset($_SESSION['productos'][22][$subkey]); 
												
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
					$prm_copiar_datos=$_REQUEST['prm_copiar_datos'];
					$docGen=$_REQUEST['docGen'];
					$cliente=$_REQUEST['cliente'];
					
					$temp='';			
					
								
					$strSQL="select * from cab_mov where sucursal='$sucursal' and cod_ope='$doc' and serie='$serie' and Num_doc='$numero' and cliente='".$cliente."' ";
					$resultado=mysql_query($strSQL,$cn);
					$row=mysql_fetch_array($resultado);
					$codigo=$row['cod_cab'];
					$cod_clie_ref=$row['cliente'];
					$moneda_doc=$row['moneda'];
					$impto=$row['impto1'];
					$obs1=$row['obs1'];
					$obs2=$row['obs2'];
					$obs3=$row['obs3'];
					$obs4=$row['obs4'];
					$obs5=$row['obs5'];
					$tienda=$row['tienda'];
					
					
					
					$resultadoRef=mysql_query("select cod_cab from referencia where cod_cab_ref='".$row['cod_cab']."'",$cn);				
					$contRef=mysql_num_rows($resultadoRef);
					$rowRef=mysql_fetch_array($resultadoRef);		
					//echo $contRef;
				
					if($contRef > 0){
					
					list($cod_cabRef)=mysql_fetch_array(mysql_query("select cod_ope from cab_mov where cod_cab='".$rowRef['cod_cab']."'"));
					
						//echo $cod_cabRef." ---> ".$docGen;
						if($cod_cabRef==$docGen){
						$temp='R';
						}
						
						
					}	
					
					
					/*
					$contRef=	mysql_num_rows(mysql_query("select cod_cab_ref from referencia where cod_cab_ref='".$row['cod_cab']."'"));		
								
					if($contRef > 0){
						//continue;
						$temp='R';
					}*/
					
						
					//echo "temp=".$temp."-->".$prm_copiar_datos; 
					
						$strSQL2="select * from cliente where codcliente='$cod_clie_ref' ";
						$resultado2=mysql_query($strSQL2,$cn);
						$row2=mysql_fetch_array($resultado2);
						$des_clie_ref=$row2['razonsocial'];
						
					if($temp=='' && $prm_copiar_datos=='S'){
					
						$_SESSION['montoFlete']=$row['flete'];
																								
						$strSQL3="select * from det_mov where cod_cab='$codigo' order by cod_det ";
						$resultado3=mysql_query($strSQL3,$cn);
						while($row3=mysql_fetch_array($resultado3)){
							
							if($row3['cod_prod']!='TEXTO'){
							$_SESSION['productos'][0][] = $row3['cod_prod'];
							$_SESSION['productos'][1][] = $row3['cantidad'];	
							
								if($_SESSION['stickcom']=='S'){
								$precioUnit=$row3['imp_item']/$row3['cantidad'];
								}else{
								$precioUnit=$row3['precio'];
								}
							$_SESSION['productos'][2][] = $precioUnit;
							
							$_SESSION['productos'][3][] = $row3['notas'];
							
							$_SESSION['productos'][4][] = $row3['unidad'];	
							$_SESSION['productos'][5][] = "ref";
							$_SESSION['productos'][6][] = $row3['nom_prod'];
							$_SESSION['productos'][7][] = $row3['unidad'];	
							$_SESSION['productos'][20][] = count($_SESSION['productos'][20])+1;
							$_SESSION['productos'][21][]= $row3['desc1'];	
							$_SESSION['productos'][22][]= $row3['desc2'];	
							
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
							$_SESSION['productos'][20][] = count($_SESSION['productos2'][20])+1;
							$_SESSION['productos'][21][]= $row3['desc1'];	
							$_SESSION['productos'][22][]= $row3['desc2'];			
							}
							
						}	
						
						if($codigo==''){
						$_SESSION['productos'][0][] = "";
						$_SESSION['productos'][1][] = "";
						$_SESSION['productos'][2][] = "";	
						$_SESSION['productos'][20][] = count($_SESSION['productos2'][20])+1;
						$temp='N';
						}	
					
					}
					
										
				}	
										
			echo $temp.'?'.$codigo.'?'.$cod_clie_ref.'?'.caracteres($des_clie_ref).'?'.$moneda_doc.'?'.$impto.'?'.$obs1.'?'.$obs2.'?'.$obs3.'?'.$obs4.'?'.$obs5.'?'.$tienda.'?';				
				
			//	echo "ddd ".$_REQUEST['cod_clie_ref'];
				?>
					
					<table width="580" border="0" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
        <tr  style="background:url(imagenes/bg_contentbase4.gif); background-position:100% 60%">
          <td width="22" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>Cod</strong></span></td>
          <td width="200"><span class="Estilo2 Estilo1 Estilo11"><strong>Descripci&oacute;n</strong></span></td>
          <td width="20" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>Uni.</strong></span></td>
          <td width="44" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>Cant.</strong></span></td>
          <td width="44" height="18" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>PUnit.</strong></span></td>
          <td width="44" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>Desc1 %</strong></span></td>
          <td width="41" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>Desc2 %</strong></span></td>
          <td width="55" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>Total</strong></span></td>
          <td width="38">&nbsp;</td>
        </tr>
        <?php 

// print_r($_SESSION['productos'][0]);
if(isset($_SESSION['productos'][0])){ 

foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {

   if($subvalue!=""){
 
	 $strSQL4="select * from producto where idproducto='".$subvalue."' ";
	 $resultado4=mysql_query($strSQL4,$cn);
	 //echo $strSQL4;
	 while($row4=mysql_fetch_array($resultado4)){
	  
	 ?>
        <tr>
          <td align="center" bgcolor="#FFFFFF" class="Estilo_det" ><?php echo $row4['idproducto']?></td>
          <td bgcolor="#FFFFFF" class="Estilo_det" ><?php echo caracteres($row4['nombre']);?></td>
          <td align="center" bgcolor="#FFFFFF" class="Estilo_det" ><?php 
		   $resultados11 = mysql_query("select * from unidades where id='".$_SESSION['productos'][7][$subkey]."' ",$cn); 			  
		   $rowSM=mysql_fetch_array($resultados11);
			 echo $rowSM['nombre'];
		   ?></td>
          <td align="center" bgcolor="#FFFFFF" class="Estilo_det" ><?php echo $_SESSION['productos'][1][$subkey] ; ?></td>
          <td align="right" bgcolor="#FFFFFF" class="Estilo_det" ><?php echo $_SESSION['productos'][2][$subkey] ; ?></td>
          <td align="right" bgcolor="#FFFFFF" class="Estilo_det" ><?php echo $_SESSION['productos'][21][$subkey] ; ?></td>
          <td align="right" bgcolor="#FFFFFF" class="Estilo_det" ><?php echo $_SESSION['productos'][22][$subkey] ; ?></td>
          <td align="right" bgcolor="#FFFFFF" class="Estilo_det" ><?php
		
		 $totalitem=($_SESSION['productos'][1][$subkey] * $_SESSION['productos'][2][$subkey]) ;
		 $totalitem=$totalitem-($totalitem*($_SESSION['productos'][21][$subkey]/100));
	     $totalitem=$totalitem-($totalitem*($_SESSION['productos'][22][$subkey]/100));
		 
		 $total=$total + $totalitem;
		 //$totalitem=$totalitem-($totalitem*($_SESSION['productos'][21][$subkey]/100));
	
		 $totalitem2=$_SESSION['productos'][1][$subkey] * $_SESSION['productos'][2][$subkey] ;
		 $totalitem2=$totalitem2-($totalitem2*($_SESSION['productos'][21][$subkey]/100));
		 $totalitem2=$totalitem2-($totalitem2*($_SESSION['productos'][22][$subkey]/100));
		 
		 $total2=$total2 + $totalitem2;
	
		 echo number_format($totalitem,2);
		 
		 ?>          </td>
          <td align="center" bgcolor="#FFFFFF"><a href="javascript:quitar_items('<?php echo $row4['idproducto']?>')"><img src="<?php echo $ruta_imagen;?>" width="14" height="14" border="0" /></a></td>
        </tr>
        <?php 
	     }
    
    }else{
	
	
	?>
        <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
          <td align="center" bgcolor="#FFFFFF" >&nbsp;</td>
          <td bgcolor="#FFFFFF" ><?php echo $_SESSION['productos'][2][$subkey]; ?></td>
          <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
          <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
          <td align="right" bgcolor="#FFFFFF" >&nbsp;</td>
          <td align="right" bgcolor="#FFFFFF" >&nbsp;</td>
          <td align="right" bgcolor="#FFFFFF" >&nbsp;</td>
          <td align="right" bgcolor="#FFFFFF" >&nbsp;</td>
          <td align="center" bgcolor="#FFFFFF"><a href="javascript:quitar_items('<?php echo $_SESSION['productos'][2][$subkey]; ?>')"><img src="<?php echo $ruta_imagen;?>" width="14" height="14" border="0" /></a></td>
        </tr>
        <?php 
	
	
	}
	 
	} 
	  
}
  
   
 
 

  ?>
      </table>
					
					
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
		
		echo $row['codigo']."~". strtoupper($row['descripcion'])."~".$row['imp1']."~".$row['imp2']."~".$row['kardex']."~".substr($row['p1'],0,1)."~".substr($row['p1'],1,1)."~".substr($row['p1'],2,1)."~".substr($row['p1'],3,1)."~".substr($row['p1'],4,1)."~".substr($row['p1'],5,1)."~".substr($row['p1'],6,1)."~".substr($row['p1'],7,1)."~".substr($row['p1'],8,1)."~".substr($row['p1'],9,1)."~".substr($row['p1'],10,1)."~".substr($row['p1'],11,1)."~".substr($row['p1'],12,1)."~".substr($row['p1'],13,1)."~".substr($row['p1'],14,1)."~".substr($row['p1'],15,1)."~".substr($row['p1'],16,1)."~".substr($row['p1'],17,1)."~".substr($row['p1'],18,1)."~".substr($row['p1'],19,1)."~".substr($row['p1'],20,1)."~".substr($row['p1'],21,1)."~".substr($row['p1'],22,1)."~".substr($row['p1'],23,1)."~".substr($row['p1'],24,1)."~".substr($row['p1'],25,1)."~".substr($row['p1'],26,1)."~".substr($row['p1'],27,1)."~".substr($row['p1'],28,1)."~".substr($row['p1'],29,1)."~".substr($row['p1'],30,1)."~".substr($row['p1'],31,1)."~".$row['sunat']."~".$row['comentario1']."~".$row['comentario2']."~".$row['obs1']."~".$row['obs2']."~".$row['obs3']."~".$row['obs4']."~".$row['obs5']."~".$row['formato']."~".$row['nitems']."~".$row['cola']."~".$row['min_percep']."~".$row['moneda']."~".$row['predefecto']."~".$row['cola2']."~".$row['tipoDesc']."~".$row['elemProd'];
		}
		
		}
		}
		
		}
		
	     		
	   	
?>