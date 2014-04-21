<?php 
session_start();
include('../conex_inicial.php');
include('../funciones/funciones.php');
$peticion=$_REQUEST['peticion'];
$codigo=$_REQUEST['codigo'];
$condicion=$_REQUEST['condicion'];
$fecha_aud=gmdate('Y-m-d H:i:s',time()-18000);
$accion=$_REQUEST['accion'];
$text=$_REQUEST['text'];

$moneda=$_REQUEST['tmoneda'];
$monto=$_REQUEST['monto'];
$impuesto1=$_REQUEST['impuesto1'];
$total_doc=$_REQUEST['total_doc'];
$total_doc2=$_REQUEST['total_doc2'];
$transportista=$_REQUEST['transportista'];
$chofer=$_REQUEST['chofer'];

		$temp_doc=$_REQUEST['temp_doc'];
		$responsable=$_REQUEST['responsable'];
		$femision=cambiarfecha($_REQUEST['femision']);
		$femf=cambiarfecha($_REQUEST['femf']);		
		if($_REQUEST['fvencimiento']==''){
			$fvencimiento='';
		}else{
			$fvencimiento=cambiarfecha($_REQUEST['fvencimiento']);
		}
		$auxiliar=$_REQUEST['auxiliar'];
		$auxiliar2=$_REQUEST['auxiliar2'];		
		$fac_modelo=$_REQUEST['fac_modelo'];
		$factor=$_REQUEST['factor'];
		$factor2=$_REQUEST['factor2'];
		$alias=$_REQUEST['alias'];		
		$incluidoigv=$_REQUEST['incluidoigv'];
		$tmoneda=$_REQUEST['tmoneda'];
		$tcambio=$_REQUEST['tcambio'];
		$total_doc=$_REQUEST['total_doc'];
		$items=count($_SESSION['productos'][0]);		
		$obs1=$_REQUEST['obs1'];

switch($peticion){
	case "save_oferta":
	
		$condicion=$_REQUEST['condicion'];
		$radioB=$_REQUEST['radioB'];	
		
		$strSQL="select  max(cod_ofe) as cod_ofe from oferta";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$codigo=$row['cod_ofe']+1;
		
		$strSQL3="insert into oferta(cod_ofe,cod_vendedor,cod_prod,nom_oferta,unidad,cantidad,fecha_ini,fecha_fin,f_venc,condicion,items,obs,monto,cant_monto) values (".$codigo.",'".$responsable." ','".$auxiliar."','".$auxiliar2."','".$fac_modelo."','".$factor."','".$femision."','".$femf."','".$fvencimiento."','".$condicion."','".$items."','".$obs1."','".$factor2."','".$radioB."') ";
		mysql_query($strSQL3,$cn);
		
		foreach ($_SESSION['productos3'][0] as $subkey=> $subvalue) {					
			$strSQL4="select * from producto where idproducto='".$subvalue."' ";
			$resultado4=mysql_query($strSQL4); 
			$rowX=mysql_num_rows($resultado4);
			$row4=mysql_fetch_array($resultado4);
	
			$strSQL444="insert into oferta_det(cod_ofe,cod_prod,nom_prod,unidad,cantidad)
			 values ('".$codigo."','".$row4['idproducto']."','".$row4['nombre']."',
			 '".$_SESSION['productos3'][4][$subkey]."','".$_SESSION['productos3'][1][$subkey]."') "; 		  	  
		   	mysql_query($strSQL444,$cn);
		}
		
	break;
	case "save_doc":
		
		$codanexo=$_REQUEST['codanexo'];
		$pvp1=$_REQUEST['pvp1'];
		$pvp2=$_REQUEST['pvp2'];
		$pvp3=$_REQUEST['pvp3'];
		$pvp4=$_REQUEST['pvp4'];
		$pvp5=$_REQUEST['pvp5'];
		
		$modo_imp=$_REQUEST['modo_imp'];
		
				
		$strSQL="select  max(cod_mod) as cod_mod from modelo";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$codigo=$row['cod_mod']+1;
		$strSQL3="insert into modelo(cod_mod,cod_anexo 	,cod_vendedor,cod_prod,nom_prodmodelo,unidad,cantidad,alias,fecha,f_venc,moneda,tc,total,items,obs,pc,fecha_aud,pv1,pv2,pv3,pv4,pv5,modo_imp) values (".$codigo.",'".$codanexo."','".$responsable." ','".$auxiliar."','".$auxiliar2."','".$fac_modelo."','".$factor."','".$alias."','".$femision."','".$fvencimiento."','".$tmoneda."','".$tcambio."','".$total_doc."','".$items."','".$obs1."','".$_SESSION['pc_ingreso']."','".$fecha_aud."','".$pvp1."','".$pvp2."','".$pvp3."','".$pvp4."','".$pvp5."','".$modo_imp."') ";
		mysql_query($strSQL3,$cn);
						
		foreach ($_SESSION['productos3'][0] as $subkey=> $subvalue) {					
			$strSQL4="select * from producto where idproducto='".$subvalue."' ";
			$resultado4=mysql_query($strSQL4); 
			$rowX=mysql_num_rows($resultado4);
			$row4=mysql_fetch_array($resultado4);
	
			$strSQL444="insert into modelo_det(cod_mod,cod_prod,nom_prod,unidad,tcambio,moneda,precio,cantidad)
			 values ('".$codigo."','".$row4['idproducto']."','".$row4['nombre']."','".$_SESSION['productos3'][4][$subkey]."'
			 ,'".$tcambio."','".$tmoneda."','".$_SESSION['productos3'][2][$subkey]."','".$_SESSION['productos3'][1][$subkey]."') "; 		  	  
		   	mysql_query($strSQL444,$cn);
		}
	break;
	
	case "eliminar_doc":	
		$strSQL444="DELETE  FROM modelo where cod_mod=$codigo  and estado<>'A' "; 		  	  
		   	mysql_query($strSQL444,$cn);
		$strSQL444="DELETE  FROM modelo_det where cod_mod=$codigo and estado<>'A' ";		  	  
		   	mysql_query($strSQL444,$cn);				
	break;	
	case "eliminar_docOf":	
		$strSQL444="DELETE  FROM oferta where cod_ofe=$codigo  and flag<>'A' "; 		  	  
		   	mysql_query($strSQL444,$cn);
		$strSQL444="DELETE  FROM oferta_det where cod_ofe=$codigo and flag<>'A' ";		  	  
		   	mysql_query($strSQL444,$cn);				
	break;	
	case "anular_doc":
		$strSQL444="update modelo set flag='$condicion',f_venc='$fecha_aud' where cod_mod=$codigo ";
		mysql_query($strSQL444,$cn);				
	break;
	
	case "anular_docOf":
		$strSQL444="update oferta set flag='$condicion',fecha_fin ='$fecha_aud' where cod_ofe 	=$codigo "; 
		mysql_query($strSQL444,$cn);				
	break;
	
	case "TER":	
	$strSQL444="update modelo set estado='A' where cod_mod=$codigo "; 		  	  
	mysql_query($strSQL444,$cn);			
	break;
	
	case "OBS":
	$SQL="select * from modelo where cod_mod='$codigo' ";	
	$resultados = mysql_query($SQL,$cn); 
	$row=mysql_fetch_array($resultados);
	echo '
	<table width="298" height="148" border="0" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF">
  <tr>
    <td height="26" style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px; color:#FFFFFF">&nbsp;</td>
    <td height="26" colspan="2" style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px; color:#FFFFFF"><strong>Observaci&oacute;n  (ALIAS: '.$row['alias'].')</strong></td>
    <td height="26" align="center" style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px; color:#FFFFFF; text-decoration:underline; cursor:pointer" onClick="salir();"><strong>x</strong></td>
  </tr>
  <tr>
    <td height="9" colspan="4"></td>
  </tr>
  <tr>
    <td width="8">&nbsp;</td>
    <td width="95" height="23"><span class="Estilo1">Observado : </span></td>
    <td width="169" rowspan="2" valign="top"><textarea name="txtObsr" cols="25" rows="5" id="txtObsr">'.$row['obs'].'</textarea></td>
    <td width="26" rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="8">&nbsp;</td>
    <td width="95" height="32">&nbsp;</td>
  </tr>
  <tr>
    <td height="46" colspan="4" align="center"><input onClick="Doc_valor('.$codigo.',\'OBS\',\'G\');" type="button" name="Submit3" value="Aceptar">
      <input type="button" name="Submit4" value="Cancelar" onClick="salir();"></td>
  </tr>
</table>
	';
	if ($accion=='G'){
		$strSQL444="update modelo set obs='$text' where cod_mod=$codigo "; 		  	  
		mysql_query($strSQL444,$cn);			
	}
	break;	
	
	case "ADJ":	
		$SQL="select * from modelo where cod_mod='$codigo' ";	
	$resultados = mysql_query($SQL,$cn); 
	$row=mysql_fetch_array($resultados);
	echo '
	<table width="298" height="106" border="0" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" bordercolor="#000000">
  <tr>
    <td height="26" style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px; color:#FFFFFF">&nbsp;</td>
    <td height="26" colspan="2" style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px; color:#FFFFFF"><strong>Adj. Documento  (ALIAS: '.$row['alias'].')</strong></td>
    <td height="26" align="center" style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px; color:#FFFFFF; text-decoration:underline; cursor:pointer" onClick="salir();"><strong>x</strong></td>
  </tr>
  <tr>
    <td height="9" colspan="4"></td>
  </tr>
  <tr>
    <td width="8" height="25">&nbsp;</td>
    <td width="95"><span class="Estilo1">Adjuntar </span></td>
    <td width="169" valign="top"> <input name="archivo" type="file" id="archivo" /></td>
    <td width="26">&nbsp;</td>
  </tr>
  
  <tr>
    <td height="46" colspan="4" align="center"><input onClick="Doc_valor('.$codigo.',\'ADJ\',\'G\');" type="button" name="Submit3" value="Aceptar">
      <input type="button" name="Submit4" value="Cancelar" onClick="salir();"></td>
  </tr>
</table>
	';
	if ($accion=='G' && $text<>''){
		$strSQL444="update modelo set archivo='$text' where cod_mod=$codigo "; 		  	  
		mysql_query($strSQL444,$cn);			
	}			
	break;		
	
	case "cmbsucursal":
	 $codsuc=$_REQUEST['codsuc'];
	 $sql="select * from tienda where cod_suc='$codsuc' order by des_tienda ";	
	 $resultados1 = mysql_query($sql,$cn); 
		echo '<select name="tienda" style="width:180" onChange="change_tienda()">';
		while($row1=mysql_fetch_array($resultados1)){
			echo '<option value="'.$row1['cod_tienda'].'">'.$row1['des_tienda'].'</option>';
		}
		echo '</select>';
	break;
	
	case "cmbsucursal2":
	 $codsuc=$_REQUEST['codsuc'];
	 $codtien=$_REQUEST['codtien'];
	 //and cod_tienda<>'$codtien'
	 $sql="select * from tienda where cod_suc='$codsuc'  order by des_tienda ";	
	 $resultados1 = mysql_query($sql,$cn); 
		echo '<select name="tienda2" style="width:180" >';
		while($row1=mysql_fetch_array($resultados1)){
			echo '<option value="'.$row1['cod_tienda'].'">'.$row1['des_tienda'].'</option>';
		}
		echo '</select>';
	break;
	case "buscar_oferta":

	 $strSQL="select * from oferta where cod_ofe='$numero' ";
	 $resultado=mysql_query($strSQL,$cn);
     $row=mysql_fetch_array($resultado);
	 $cont=mysql_num_rows($resultado);
	 
	 if($cont==1){
	 
	  $strSQL2="select * from oferta where cod_ofe='$numero' ";
	 $resultado2=mysql_query($strSQL2,$cn);
     $row2=mysql_fetch_array($resultado2);
	 
	 $cadena=$row['cod_ofe'];
	 $vendedor =$row['cod_vendedor'];
	 $producto=$row['cod_prod'];	 
	 $nom_oferta=$row2['nom_oferta'];
	 $unidad=$row['unidad'];
	 $cantidad=$row['cantidad'];
	 $fecha_ini=$row['fecha_ini'];
	 $fecha_fin=$row['fecha_fin'];
	 $f_venc=$row['f_venc'];
	 $condicion=$row['condicion'];
	 $obser=$row['obs'];
	 
				$strSQL3="select * from oferta_det where cod_ofe='$cadena'";
				$resultado3=mysql_query($strSQL3,$cn);
				while($row3=mysql_fetch_array($resultado3)){					
					$_SESSION['productos'][0][] = $row3['cod_prod'];
					$_SESSION['productos'][1][] = $row3['cantidad'];	
					$_SESSION['productos'][2][] = $row3['precio'];	
					$_SESSION['productos'][4][] = $row3['unidad'];	
			    }
						
 
		   echo $vendedor."?".$producto."?".$nom_oferta."?".$unidad."?".$cantidad."?".$fecha_ini."?".$fecha_fin."?".$f_venc."?".$condicion."?".$obser."?";
		 }else{
		  echo $vendedor."?".$producto."?".$nom_oferta."?".$unidad."?".$cantidad."?".$fecha_ini."?".$fecha_fin."?".$f_venc."?".$condicion."?".$obser."?";
		 }
	
	
	break;
	case "buscar_transf":
	 	 
	 $strSQL="select * from cab_mov where Num_doc='$numero' and sucursal='$sucursal' and cod_ope='OR' and serie='$serie' and tipo=2";
	 $resultado=mysql_query($strSQL,$cn);
     $row=mysql_fetch_array($resultado);
	 $cont=mysql_num_rows($resultado);
	 
	 if($cont==1){
	 
	  $strSQL2="select * from cab_mov where Num_doc='$numero' and cod_ope='OR' and serie='$serie' and tipo=1";
	 $resultado2=mysql_query($strSQL2,$cn);
     $row2=mysql_fetch_array($resultado2);
	 
	 $cadena=$row['cod_cab'];
	 $sucursal=$row['sucursal'];
	 $tienda=$row['tienda'];
	 $responsable=$row['cod_vendedor'];
	 $fecha1=$row['fecha'];
	 $condicion=$row['condicion'];
	 $transportista=$row['fecha'];
	 
	 $sucursal2=$row2['sucursal'];
	 $tienda2=$row2['tienda'];
	 $cadena2=$row2['cod_cab'];	 
	
	 
				$strSQL3="select * from det_mov where cod_cab='$cadena'";
				$resultado3=mysql_query($strSQL3,$cn);
				while($row3=mysql_fetch_array($resultado3)){					
					$_SESSION['productos'][0][] = $row3['cod_prod'];
					$_SESSION['productos'][1][] = $row3['cantidad'];	
					$_SESSION['productos'][2][] = $row3['precio'];	
					$_SESSION['productos'][4][] = $row3['unidad'];	
			    }
				//producto fimal				 
				$cadena2=$row2['cod_cab'];
	 
				$strSQL3="select * from det_mov where cod_cab='$cadena2'";
				$resultado3=mysql_query($strSQL3,$cn);
				while($row3=mysql_fetch_array($resultado3)){					
					$_SESSION['2productos'][0][] = $row3['cod_prod'];
					$_SESSION['2productos'][1][] = $row3['cantidad'];	
					$_SESSION['2productos'][2][] = $row3['precio'];	
					$_SESSION['2productos'][4][] = $row3['unidad'];	
			    }
				
 
		   echo $sucursal."?".$tienda."?".$responsable."?".$fecha1."?".$condicion."?".$transportista."?".$sucursal2."?".$tienda2."?".$cadena."?".$cadena2."?";
		 }else{
		 
		  echo $sucursal."?".$tienda."?".$responsable."?".$fecha1."?".$condicion."?".$transportista."?".$sucursal2."?".$tienda2."?".$cadena."?";
		 }
		  
	 break;
	case "generar_numero_transf":
	      //$strSQL="select max(Num_doc) as Num_doc from cab_mov where sucursal='$sucursal' and cod_ope='$doc' and serie='$serie'";
		   $strSQL222="select * from tienda where cod_tienda='$tienda'";
		   $resultado222=mysql_query($strSQL222,$cn);
		   $row222=mysql_fetch_array($resultado222);
		   if(trim($row222['usuario'])==trim($_SESSION['user'])){
			   mysql_query("update tienda set estado='N',reserva='',usuario='' where cod_tienda='$tienda' or usuario='".$_SESSION['user']."'",$cn);
		   }
		   $strSQL222="select * from tienda where cod_tienda='$tienda'";
		   $resultado222=mysql_query($strSQL222,$cn);
		   $row222=mysql_fetch_array($resultado222);
		   $strSQL223="select * from tienda where reserva='$serie'";
		   $resultado223=mysql_query($strSQL223,$cn);
		   $row223=mysql_fetch_array($resultado223);
		   
		 if($row223['estado']!=""){
			 if($row223['estado']=="N"){
			 $filtro=true;
			 }else{
				 $filtro=false;
			 }
		 }else{
			 $filtro=true;
		 }
		 //$row222['estado']=='N' && 
		 if($row222['estado']=='N' && $filtro){			  
		  	
			mysql_query("update tienda set estado='S',reserva='".$serie."',usuario='".$_SESSION['user']."' where cod_tienda='".$tienda."'",$cn);
			 $strSQL="select max(Num_doc) as numero from cab_mov where sucursal='$sucursal' and cod_ope='OR' and serie='$serie'";
			  //echo $strSQL;
			$resultado=mysql_query($strSQL,$cn);
			$row=mysql_fetch_array($resultado);
			$cadena=$row['numero']+1;
			echo $cadena;

			
		}else{
			if($filtro==true){
				echo "ocupado?".$row222['usuario']."?";
			}else{
				echo "ocupado?".$row223['usuario']."?";
			}
		}

	
	   break;	
	   
	 case "gen_transf":	 
	 
	 	$tienda2=$_REQUEST['tienda2'];		
		$strSQL100="select *  from cab_mov where serie='".$serie."'  and Num_doc='".$numero."' and cod_ope='OR' ";
		$resultado100=mysql_query($strSQL100,$cn);
		$registros100=mysql_num_rows($resultado100);

		if($registros100 > 1){
			echo "error";
			break;
		}		
		
		$flag_series='S';
		
				/*	foreach($_SESSION['productos3'][0] as $subkey=> $subvalue) {
				
					$cant_prod=$_SESSION['productos3'][1][$subkey];
					//kardex,nombre,series
					$strSQL_prod="select * from producto where idproducto='".$subvalue."' ";
					$resultado_prod=mysql_query($strSQL_prod,$cn);
					$row_prod=mysql_fetch_array($resultado_prod);
						
					//	echo $strSQL_prod."<br>";
						
							if($row_prod['kardex']=='S'){
								  $cant_series=0;
								  if(isset($_SESSION['seriesprod'][2]) && $row_prod['series']=='S' ){
									  foreach($_SESSION['seriesprod'][2] as $subkey2=> $subvalue2){	
															
										 if($subvalue2==$subvalue){
										 
											$temp_serie=buscar_series($subvalue,$_SESSION['seriesprod'][0][$subkey2],$tienda2);
											
												if($temp_serie > 0){
												$flag_series='N';
												$prod_no_coincide="serie ingresada:".$_SESSION['seriesprod'][0][$subkey2].":".$row_prod['nombre'];
												break;
												}
											
											$cant_series++;
												
										}
									  }
								  }else{ 
								  		
									  	
										
									  if($row_prod['series']=='S') {
									  $flag_series='N';
									  $prod_no_coincide=$row_prod['nombre'];
									  }
								  
								  break;				
								  }
								  
								  if($flag_series=='N'){
								  break;
								  }
								  //echo $cant_prod." = ".$cant_series."<br>";
								  if($cant_prod!=$cant_series){
								  $flag_series='N';
								  $prod_no_coincide=$row_prod['nombre'];
								  break;				
								  }
							}
					
							
					}//fin for each     */
	 
if($flag_series=='S') {
	 
	 $strSQL="select  max(cod_cab) as cod_cab from cab_mov";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$codigo=$row['cod_cab']+1;
		$codigo2=$codigo+1;
	
		$tienda=$_REQUEST['tienda'];
		$sucursal=substr($tienda,0,1);
		$doc="OR";
		
			
		$auxiliar="000000";
		$tipomov="2";
		$incluidoigv='S';
		$items=count($_SESSION['productos'][0]);
		
		$inafecto="S";
		$kardex="S";
		$deuda="N";
		
		$numero=str_pad($numero, 7, "0", STR_PAD_LEFT);
		$strSQL3="insert into cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,caja,cliente,ruc,fecha,f_venc,moneda,tc,b_imp,igv,servicio,total,saldo,tienda,sucursal,flag,motivo,noperacion,items,condicion,incluidoigv,fecha_aud,pc,inafecto,kardex,deuda,transportista)values('".$codigo."','".$tipomov."','".$doc."','".$numero."','".$serie."','".$responsable."','".$caja."','".$auxiliar."','".$ruc."','".cambiarfecha($femision)."','".cambiarfecha($fvencimiento)."','".$moneda."','".$tc."','".$monto."','".$impuesto1."','".$servicio."','".$total_doc."','".$saldo."','".$tienda."','".$sucursal."','".$flag."','".$motivo."','".$noperacion."','".$items."','".$condicion."','".$incluidoigv."','".$fecha_aud."','".$_SESSION['pc_ingreso']."','".$inafecto."','".$kardex."','".$deuda."','".$transportista."')"; 
		
		mysql_query($strSQL3,$cn);
	 
	    
	  $tienda2=$_REQUEST['tienda2'];
	  $sucursal2=substr($tienda2,0,1);
	  $tipomov="1";
	  $items=count($_SESSION['2productos'][0]);

	  $strSQL2="insert into cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,caja,cliente,ruc,fecha,f_venc,moneda,tc,b_imp,igv,servicio,total,saldo,tienda,sucursal,flag,motivo,noperacion,items,condicion,incluidoigv,fecha_aud,pc,inafecto,kardex,deuda,transportista)values('".$codigo2."','".$tipomov."','".$doc."','".$numero."','".$serie."','".$responsable."','".$caja."','".$auxiliar."','".$ruc."','".cambiarfecha($femision)."','".cambiarfecha($fvencimiento)."','".$moneda."','".$tc."','".$monto."','".$impuesto1."','".$servicio."','".$total_doc2."','".$saldo."','".$tienda2."','".$sucursal2."','".$flag."','".$motivo."','".$noperacion."','".$items."','".$condicion."','".$incluidoigv."','".$fecha_aud."','".$_SESSION['pc_ingreso']."','".$inafecto."','".$kardex."','".$deuda."','".$transportista."')"; 
		
		mysql_query($strSQL2,$cn);
	

		//------------------------------------------------------------------
//remplazar	  //$temp_subunidad    por --> 	  $_SESSION['productos3'][1][$subkey]
	  	 
	 foreach ($_SESSION['productos3'][0] as $subkey=> $subvalue) {
	 	  
	      $strSQL4="select * from producto where idproducto='".$subvalue."' ";
		  $resultado4=mysql_query($strSQL4,$cn);
		  while($row4=mysql_fetch_array($resultado4)){
		  $descargo=$row4['kardex'];
		  
		    $und_pr=$row4['und'];
//	  $factor_pr=$row4['factor']; 
	  //----------------subunidadesssss---------------------------	
				if($und_pr != $_SESSION['productos3'][4][$subkey]){
				
					$strSQL_unid="select * from unixprod where producto='".$subvalue."' and unidad='".$_SESSION['productos3'][4][$subkey]."'";
					$resultado_unid=mysql_query($strSQL_unid,$cn);
					$row_unid=mysql_fetch_array($resultado_unid);
					$factor_subund=$row_unid['factor'];
																
					$temp_subunidad=$_SESSION['productos3'][1][$subkey];
					
					if ($row_unid['mconv']=='P'){
						$temp_subunidad=$temp_subunidad*$factor_subund;
					}else{
							$FacSbU = explode('.',$factor_subund);
							$SuT1=$temp_subunidad*$FacSbU[0];	//5*1 - 5 
							$SuT2=$temp_subunidad*$FacSbU[1];	//5*3 -	15
				$CatSu = explode('.',number_format($SuT2/$row4['factor'],3,'.','.'));
							$SuT1=$SuT1+$CatSu[0]; //5+1 - 6
							$SuT2=($CatSu[1]*$row4['factor'])/100; // (25*12)/100 - 3
							$SuT2= number_format($SuT2,0,'','');	 //agrege para redondeo
							$temp_subunidad=$SuT1.'.'.$SuT2 ; //6.3
					}
																													
				}else{
				 $temp_subunidad=$_SESSION['productos3'][1][$subkey];
				}
				 
		  
		  $strSQL4="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,tcambio,moneda,precio,cantidad,imp_item,fechad,costo_inven,saldo_actual,unidad,descargo) values('".$codigo."','2','".$doc."','".$serie."','".$numero."','".$auxiliar."','".$tienda."','".$sucursal."','".$row4['idproducto']."','".addslashes($row4['nombre'])."','".$tc."','".$moneda."','".$_SESSION['productos3'][2][$subkey]."','".$temp_subunidad."','".$imp_item."','".cambiarfecha($femision)."','".number_format($costo_inven1,2)."','".$saldo_actual."','".$und_pr."','".$descargo."')"; 
		 mysql_query($strSQL4,$cn);	
		 
		 $campo="saldo".$tienda;
		 		 		 	 		 
		 $strSQL6="update producto set $campo=$campo-".$temp_subunidad." where idproducto='".$subvalue."'";
		 mysql_query($strSQL6,$cn);		 
		 
		   //-----------------------------------------------------series----------------------------------
		 		$salida=$codigo;				
				if(isset($_SESSION['seriesprod'][2])){
					foreach ($_SESSION['seriesprod'][2] as $subkey2=> $subvalue2) {
										 
						if($subvalue2==$row4['idproducto']){
											
						$strSQL_series="update series set salida='".$salida."' where producto='".$row4['idproducto']."' and serie='".$_SESSION['seriesprod'][0][$subkey2]."' and salida='' and tienda='".$tienda."' ";
											
						mysql_query($strSQL_series,$cn);
											
						}
					}
				}			  //---------------------------------------------------------------------------------------------
		  
		 }
	 }
	 
	  foreach ($_SESSION['2productos3'][0] as $subkey=> $subvalue) {	  
	  	  $strSQL4="select * from producto where idproducto='".$subvalue."' ";
		  $resultado4=mysql_query($strSQL4,$cn);
		  while($row4=mysql_fetch_array($resultado4)){
		 
		  $descargo=$row4['kardex'];
		 $costo_suc_origen=$row4['costo_inven'.$sucursal]*$temp_subunidad;
		  
			  if($sucursal!=$sucursal2){
							
			   $costo_inven1=calc_costo_inv($subvalue,$fecha_aud,$costo_suc_origen,$temp_subunidad,'saldo'.$tienda2,'costo_inven'.$sucursal2);
			   
						$upd_costo_suc=",costo_inven".$sucursal2."='$costo_inven1'";
			  }else{
					$upd_costo_suc=" ";
			  }				 		
				 $und_pr=$row4['und'];
				if($und_pr != $_SESSION['2productos3'][4][$subkey]){
				
					$strSQL_unid="select * from unixprod where producto='".$subvalue."' and unidad='".$_SESSION['2productos3'][4][$subkey]."'";
					$resultado_unid=mysql_query($strSQL_unid,$cn);
					$row_unid=mysql_fetch_array($resultado_unid);
					$factor_subund=$row_unid['factor'];
																
					$temp_subunidad=$_SESSION['2productos3'][1][$subkey];
					
					if ($row_unid['mconv']=='P'){
							$temp_subunidad=$temp_subunidad*$factor_subund;
					}else{
							$FacSbU = explode('.',$factor_subund);
							$SuT1=$temp_subunidad*$FacSbU[0];	//5*1 - 5 
							$SuT2=$temp_subunidad*$FacSbU[1];	//5*3 -	15
				$CatSu = explode('.',number_format($SuT2/$row4['factor'],3,'.','.'));
							$SuT1=$SuT1+$CatSu[0]; //5+1 - 6
							$SuT2=($CatSu[1]*$row4['factor'])/100; // (25*12)/100 - 3
							$SuT2= number_format($SuT2,0,'','');	 //agrege para redondeo
							$temp_subunidad=$SuT1.'.'.$SuT2 ; //6.3
					}
																													
				}else{
				 $temp_subunidad=$_SESSION['2productos3'][1][$subkey];
				}
				 
		  $strSQL5="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,tcambio,moneda,precio,cantidad,imp_item,fechad,costo_inven,saldo_actual,unidad,descargo) values('".$codigo2."','1','".$doc."','".$serie."','".$numero."','".$auxiliar."','".$tienda2."','".$sucursal2."','".$row4['idproducto']."','".addslashes($row4['nombre'])."','".$tc."','".$moneda."','".$_SESSION['2productos3'][2][$subkey]."','".$temp_subunidad."','".$imp_item."','".cambiarfecha($femision)."','".$costo_inven1."','".$saldo_actual."','".$und_pr."','".$descargo."')"; 
		  mysql_query($strSQL5,$cn);
		 		  
		   		  
		  $campo="saldo".$tienda2;		  
		  $strSQL6="update producto set $campo=$campo+".$temp_subunidad.$upd_costo_suc." where idproducto='".$subvalue."'";
		  mysql_query($strSQL6,$cn);
		  
		  //-----------------------------------------------------series-----------------------				
				
				$ingreso=$codigo2;
				$salida="";
				$costo_inventario_origen='costo_inven'.$sucursal;
				
				if(isset($_SESSION['seriesprod'][2])){
				
					foreach ($_SESSION['seriesprod'][2] as $subkey2=> $subvalue2) {
										 
						if($subvalue2==$row4['idproducto']){
							
							$strSQL00="select fvenc from series  where producto='".$row4['idproducto']."' and serie='".$_SESSION['seriesprod'][0][$subkey2]."' and salida='".$codigo."' and tienda='".$tienda."' ";
							$resultado00=mysql_query($strSQL00,$cn);
							$row00=mysql_fetch_array($resultado00);
										
							$strSQL_series="insert into series(producto,serie,ingreso,salida,costo,fvenc,tienda) values ('".$row4['idproducto']."','".strtoupper($_SESSION['seriesprod'][0][$subkey2])."','".$ingreso."','".$salida."','".$row4[$costo_inventario_origen]."','".$row00['fvenc']."','".$tienda2."')";
										
							mysql_query($strSQL_series,$cn);
										
						}
					}
				}
		  //------------------------------------------------------------------------------------------
		  		  		  
		 }
		  
	  }
	  
	       /*$strSQL0="update tienda set estado='N' where cod_tienda='$tienda'";
			mysql_query($strSQL0,$cn);	  
	  
			unset($_SESSION['seriesprod'][0]);
			unset($_SESSION['seriesprod'][1]);
			unset($_SESSION['seriesprod'][2]);
			
			unset($_SESSION['temp_series'][0]);
			unset($_SESSION['temp_series'][1]);
			unset($_SESSION['temp_series'][2]);*/
	  
}else{
	echo $prod_no_coincide;
}	
	  
	 break;
	 
	  case "salir_transf":
			unset($_SESSION['productos']);
			unset($_SESSION['productos2']);
			unset($_SESSION['productos3']);
			
			unset($_SESSION['2productos']);
			unset($_SESSION['2productos2']);
			unset($_SESSION['2productos3']);

			$strSQL0="update tienda set estado='N',usuario='',reserva='' where cod_tienda='$tienda'";
			mysql_query($strSQL0,$cn);	
			
			
	if(isset($_SESSION['seriesprod'])){
				foreach ($_SESSION['seriesprod'][2] as $subkey=> $subvalue) {
				$strSQL="update series set estado='F' where tienda='".$tienda."' and producto='".$_SESSION['seriesprod'][2][$subkey]."' and serie='".$_SESSION['seriesprod'][0][$subkey]."' and salida='' ";
				mysql_query($strSQL,$cn);
				}
				unset($_SESSION['seriesprod'][0]);
				unset($_SESSION['seriesprod'][1]);
				unset($_SESSION['seriesprod'][2]);				
				unset($_SESSION['temp_series'][0]);
				unset($_SESSION['temp_series'][1]);
				unset($_SESSION['temp_series'][2]);			
			}
			if(isset($_SESSION['2seriesprod'])){
				foreach ($_SESSION['2seriesprod'][2] as $subkey=> $subvalue) {
				$strSQL="update series set estado='F' where tienda='".$tienda."' and producto='".$_SESSION['2seriesprod'][2][$subkey]."' and serie='".$_SESSION['2seriesprod'][0][$subkey]."' and salida='' ";
				mysql_query($strSQL,$cn);
				}
				unset($_SESSION['2seriesprod'][0]);
				unset($_SESSION['2seriesprod'][1]);
				unset($_SESSION['2seriesprod'][2]);				
				unset($_SESSION['2temp_series'][0]);
				unset($_SESSION['2temp_series'][1]);
				unset($_SESSION['2temp_series'][2]);
		
										
	}	
		
	 break;
	 
	   case "save_tipoImp":
	   
	   $valor=$_REQUEST['valor'];
	   $id_modelo=$_REQUEST['id_modelo'];
	   
	   $strSQL="update modelo set modo_imp='".$valor."' where cod_mod='".$id_modelo."' ";
	   mysql_query($strSQL,$cn);
	   
	   
	   break;
				
} 	







		
function calc_costo_inv($codigo_producto,$fecha_emi,$importe_sin_igv,$cantidad,$campo_tie,$campo_suc){

				include('../conex_inicial.php');
				
				 $strSQL_sal="select saldo_actual,costo_inven from det_mov where cod_prod='".$codigo_producto."' and costo_inven!=0  and  date(fechad) <= date('".$fecha_emi."') order by fechad desc, cod_det desc limit 1";
				 $resultado_sal=mysql_query($strSQL_sal,$cn);
				 $row_sal=mysql_fetch_array($resultado_sal);		 
				 $cont=mysql_num_rows($resultado_sal);
				
				 if($cont==0){
				 $costo_inv_ant=0; 
				 $saldo_ant=0;
				 }
				 
 				 $strSQL_sal2="select $campo_tie,$campo_suc from producto where idproducto='".$codigo_producto."'";
				 $resultado_sal2=mysql_query($strSQL_sal2,$cn);
				 $row_sal2=mysql_fetch_array($resultado_sal2);
				 $saldo_ant=$row_sal2[$campo_tie];
				 $costo_inv_ant=$row_sal2[$campo_suc]; 
						
				 if($saldo_ant >= 0 && $cantidad > 0){
				 $costo_inv=(($saldo_ant*$costo_inv_ant)+($importe_sin_igv))/($saldo_ant + $cantidad);
				 }
				return number_format($costo_inv,4,'.','');
	}

?>