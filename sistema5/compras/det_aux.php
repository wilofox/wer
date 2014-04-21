<?php  session_start();
include('../conex_inicial.php');
include("../funciones/funciones.php");
		$estSP=$_REQUEST['estSP'];
 		if($_REQUEST['temp']=='auxiliares'){
		$tabla="tblproductos1";
		$titulo="Ruc";
		$anchoW="570";
		}else{
		$tabla="tblproductos";
		$titulo="Precio";
		$anchoW="670";
		}
//*******Agregar Servicio Tecnico*******//
$filtroserv="";
if(isset($_REQUEST['servtg'])){
	$filtroserv=" and upper(substr(nombre,1,8))!='SERVICIO'";
}
//////////////////////////////////////////
//echo $_REQUEST['tienda'];
$tienda=$_REQUEST['tienda'];
$campo="saldo".$tienda;
$empresa="costo_inven".substr($tienda,0,1);
$tipoBus=$_REQUEST['tipoBus'];
$moneda_doc=$_REQUEST['moneda_doc'];
$ventana=$_REQUEST['ventana'];
$codcliente=$_REQUEST['codcliente'];

 $serie=$_REQUEST['serie'];
if ($serie=='N'){ $serie=" and series <>'S' "; }

if($_REQUEST['tipomov']=='1'){
$listaProd=" and (lista='3' || lista='1') ";
}else{
$listaProd=" and (lista='3' || lista='2') ";
}

//echo "asha".$_REQUEST['prov_asoc'];
if(isset($_REQUEST['prodOferta'])){
$filtroOferta=" and oferta='S' ";
}
//echo $filtroOferta;
?>

<table id="fila" width="100%" border="0" cellpadding="0" cellspacing="0" >
 
  <tr>
    <td colspan="3" >
	
	<table width="100%<?php //echo $anchoW; ?>" height="26%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" id="<?php echo $tabla?>">
	
	 <?php 
		    $nombre=$_REQUEST['nomb_det'];
			$criterio=$_REQUEST['criterio'];
			
			$clasificacion=$_REQUEST['comboclasificacion'];
			$categoria=$_REQUEST['categoria'];
			$subcategoria=$_REQUEST['subcategoria'];
			
			
			$filtro3="";
			if($clasificacion!='999' && $clasificacion!=''){
			$filtro3=" and  clasificacion='$clasificacion' ";
			}
			if($categoria!='999' && $categoria!=''){
			$filtro3.=" and  categoria='$categoria' ";
			}
			if($subcategoria!='999' && $subcategoria!=''){
			$filtro3.=" and  subcategoria='$subcategoria' ";
			}		
			
			
			//echo $criterio;
			if($criterio==''){
			$criterio='razonsocial';
			}
				 if($tipoBus=="aprox"){
				 $filtroBus=" $criterio like '%$nombre%' ";
				 }else{
				 $filtroBus=" $criterio like '$nombre%' ";
				 }
				 
				 
				 
			if($_REQUEST['tipomov']==1 && $_REQUEST['temp']=='auxiliares'){
			
				
			 
				 if( (isset($_REQUEST['prov_asoc'])) && $_REQUEST['prov_asoc']!='' ){
				 $cadena_prov=explode("-",$_REQUEST['prov_asoc']);
				  
				  $filtro=" and ( codcliente='' ";
				  foreach ($cadena_prov as $subkey=> $subvalue) {
				  $filtro=$filtro." || codcliente='".$subvalue."'" ;
				  }
				 
				 $strSQL1="select * from cliente where baja='N' and (tipo_aux='P' or tipo_aux='A') ".$filtro. " )";
				 				 
				 }else{
					
				 
				 $strSQL1="select * from cliente where baja='N' and (tipo_aux='P' or tipo_aux='A')  and ".$filtroBus." order by $criterio limit 50";
				 }
				 
				 
			}else{
			
			}
			//echo $_REQUEST['tipomov']."-".$_REQUEST['temp'];
			if($_REQUEST['tipomov']==2 && $_REQUEST['temp']=='auxiliares'){
			
				if(isset($_REQUEST['flujoc'])){
				
				 $strSQL1="select * from cliente  where baja='N' and  ".$filtroBus."   order by $criterio limit 50";
				
				}else{
			 $strSQL1="select * from cliente  where baja='N' and  ( tipo_aux='C' or tipo_aux='A')   and ".$filtroBus."   order by $criterio limit 50";
			    }
			 
			}else{
			
			}
			if($_REQUEST['temp']=='productos'){
			
			list($clas_clie)=mysql_fetch_row(mysql_query("select clas_clie from cliente where codcliente='".$codcliente."'"));
			 list($preClaClie)=mysql_fetch_row(mysql_query("select precio from clas_clie where codigo='".$clas_clie."'"));//precio de clasificacion de clientes
			
			
			$codigosistema=str_pad($nombre, 6, "0", STR_PAD_LEFT);  
			
				if($criterio=="cod_prod"){
				$strSQL1="select * from producto where (upper(cod_prod) like '%".strtoupper($nombre)."%' or upper(codanex2) like '%".strtoupper($nombre)."%' or upper(codanex3) like '%".strtoupper($nombre)."%' ) ".$filtro3.$listaProd.$serie.$filtroOferta.$filtroserv." and baja='N' limit 100 ";
					
				}else{
					
				 if($criterio=="idproducto"){
				 $strSQL1="select * from producto where idproducto='$codigosistema' ".$filtro3.$listaProd.$serie.$filtroOferta.$filtroserv." and baja='N' limit 100 ";
				   }else{
						if($criterio=="serie"){
						if ($estSP=='V'){
						 	$filtroEst=" and estado='$estSP' ";
						}else{
						 	$filtroEst=" and estado='F' ";
						}
						$strSQL1="select * from series,producto where tienda='".$tienda."' and idproducto=producto and upper(serie)='".strtoupper($nombre)."' ".$filtroEst." ".$filtro3.$serie." and baja='N' limit 100 ";
						}else{
							 if($tipoBus=="aprox"){
							 $tempAprox=explode("**",$nombre);
							// echo count($tempAprox);
								 if(count($tempAprox)==3 || count($tempAprox)==2){
								 $filtroBus=" nombre like '%".$tempAprox[0]."%".$tempAprox[1]."%".$tempAprox[2]."%' ";
								 }else{			 
								 $filtroBus=" nombre like '%$nombre%' ";
								 }
								 
							 }else{
							 $filtroBus=" nombre like '$nombre%' ";
							 }
						$strSQL1="select * from producto where ".$filtroBus." ".$filtro3. $listaProd.$serie.$filtroOferta.$filtroserv. " and baja='N' order by nombre limit 100 ";
						}
				   }
				
			    }
				
				
							
												
			}else{
			
			}
			
		  		  			   
	//	echo $tipoBus."<br>".$strSQL1;
  $resultado1=mysql_query($strSQL1,$cn);
  $contador=mysql_num_rows($resultado1);
if($contador==0){
echo " <font face='Arial, Helvetica, sans-serif' style='font:bold;font-size:12px'> No existen coincidencias para esta busqueda..... </font>";
 //echo $tipoBus."<br>".$strSQL1;
}
//  echo $contador;
if($contador>0){
$i=0;
  while($row1=mysql_fetch_array($resultado1)){
		  		
				if($row1['factorOT']=='S'){
				$strSQL101="select * from factorot where item='".$row1['idproducto']."'";
				$resultado101=mysql_query($strSQL101,$cn);
				$row101=mysql_fetch_array($resultado101);
				$precioMin=$row101['pre_min'];
				}
				
				
						
			  if($_REQUEST['temp']=='auxiliares'){
				$codigo=$row1['codcliente'];
				$descripcion=caracteres($row1['razonsocial']);
				$otros=$row1['ruc'];
				$estado_percep=$row1['estado_percep'];
				$por_percep=$row1['por_percep'];
				$dir_clie=$row1['direccion'];
				$tipoprov=$row1['tipoprov'];
				$cfila="#FFFFFF";
				$condClie=$row1['condicion'];
				$tpersona=$row1['t_persona'];
				$cfila="#000000";
						
			  }else{
				$codigo=$row1['idproducto'];
				$ccajas=$row1['ccajas'];
				$clasificacion=$row1['clasificacion'];
				$descripcion=caracteres($row1['nombre']);
				$lotes=$row1['lotes'];
				//echo $criterio;
					if($criterio=="cod_prod"){
						if($row1['cod_prod']==strtoupper($nombre)){
						$codbarraEnc="1";
						}
						if($row1['codanex2']==strtoupper($nombre)){
						$codbarraEnc="2";
						}
					
						$cadena1=$row1['cod_prod'];
						$cadena2=$row1['codanex2'];
						$cadena3=$row1['codanex3']; 
						$palabra=$nombre; //Palabra a buscar 
						
						//echo "d=".$palabra;
						
						if($palabra!=""){
							if(eregi($palabra,$cadena1)) { 
							$codAnexProd=$cadena1;
							}else { 
								if(eregi($palabra,$cadena2)){ 
								$codAnexProd=$cadena2;
								}else{
									if(eregi($palabra,$cadena3)){
									$codAnexProd=$cadena3;
									}							
								}
							}  
						}
						
					}
				//$precioxDefecto=$_REQUEST['predefecto'];
				
			if($_SESSION['nivel_usu']!=2){
				if(isset($_REQUEST['cambiarPrecio'])){
				
				if($_REQUEST['cambiarPrecio']=='1'){
				$precioxDefecto='precio';
				}else{				
				
				$precioxDefecto='precio'.$_REQUEST['cambiarPrecio'];
				}
				
				}else{
					 if($preClaClie!=''){
						if($preClaClie=='precio1')$temp_preClaClie="";
						if($preClaClie=='precio2')$temp_preClaClie=2;
						if($preClaClie=='precio3')$temp_preClaClie=3;
						if($preClaClie=='precio4')$temp_preClaClie=4;
						if($preClaClie=='precio5')$temp_preClaClie=5;
						
					 $precioxDefecto='precio'.$temp_preClaClie;
					
					 }else{
					  
						if(isset($_REQUEST['predefecto']) && $_REQUEST['predefecto']!='' && $_REQUEST['predefecto']!='1'){
						//$precioxDefecto='precio'.$_REQUEST['predefecto'];
						   if($_REQUEST['predefecto']=='7'){
							$precioxDefecto='costo_inven1';
							}else{
							
								if($_REQUEST['predefecto']=='6'){
								$precioxDefecto='pre_ref';
								}else{
								$precioxDefecto='precio'.$_REQUEST['predefecto'];
								}
							}
						}else{
						$precioxDefecto='precio';
						}
					 
					 }
				}
				
				
				if($row1['moneda']=='01' && $moneda_doc=='02' ){
				$otros=number_format($row1[$precioxDefecto]/$tcambio,4);
				$moneda='US$.';
				}else{
					
					
					//echo $precioxDefecto;
					//echo 
					if($row1['moneda']=='02' && $moneda_doc=='01' ){
					//echo ""
					$otros=number_format($row1[$precioxDefecto]*$tcambio,4);
					$moneda='S/.';
					}else{
						$otros=number_format($row1[$precioxDefecto],4);
						//echo $otros;
						if($moneda_doc=='01')$moneda='S/.'; else $moneda='US$.';
					}
				
				}
							
			}else{
				$otros='0.00';
				$moneda='';		
			}
			
			
					if($row1['igv']=='N' && $row1['kardex']=='N'){
						$cfila="#CFECF1";
						}else{
						
							if($row1['igv']=='N'){
								$cfila="#05A348";
							 }else{
								if($row1['kardex']=='N' ||  $row1[$campo]<=0){
								$cfila="#FF0404";								
								}else{
								$cfila="#000000";
								
								}
						   }
						}			
			
			
			
			
							$strSQL4x="select md.*,m.cantidad as cantGen  from modelo m,modelo_det md where m.cod_mod=md.cod_mod and  m.cod_prod='".$codigo."' order by md.cod_mdet ";
					
							//echo $strSQL4x;
							$resultado4x=mysql_query($strSQL4x,$cn);
							$contModel=mysql_num_rows($resultado4x);
							
							$rowModel=mysql_fetch_array($resultado4x);
							$cantModelo=$rowModel['cantGen'];
							
								if($contModel>0){								
								$esmodelo='S';
								}else{
								$esmodelo='N';
								}
						
			  }
			  
			  
			  	 /* href="javascript:elegir('<?php echo $codigo ?>','<?php echo $descripcion ?>')"
				 bgcolor="<?php echo $cfila?>"
				 */
		  ?>
        <tr  bgcolor="#FFFFFF" onmouseover='entrada(this)'  >
          <td width="7%" align="center" height="20px" style=" border-bottom:#CCCCCC solid 1px">
		  <font face="Arial, Helvetica, sans-serif" size="1px" style="font:bold; color:#05A348 " >
		  <?php 
		  if($_REQUEST['temp']=='auxiliares'){
		  	//if(isset($_REQUEST['ptovta34'])){
				echo "<a style='cursor:pointer' onclick='selec_cli(this)'  >".$codigo."</a>";
			//}else{
		   		//echo "<a>".$codigo."</a>";
			//}
		  }else{
		  echo "<a style='cursor:pointer' onclick='espec_prod(this)'  >".$codigo."</a>";
		  } ?>
		  </font>		  </td>
         
		  <td width="65%" style=" border-bottom:#CCCCCC solid 1px">
		  <font  face="Verdana, Arial, Helvetica, sans-serif"  style="font-size:10px; font:bold; color:<?php echo $cfila?>">
		  <?php
			if($_REQUEST['temp']=='productos' ){
		  	 echo "<label style='width:50px; font-size:9px'>".str_pad($row1['cod_prod'],10," ",STR_PAD_RIGHT)."</label>";
		  ?>&nbsp; &nbsp; | &nbsp; 
		  
		  <?php
			}
		   echo "<label style='width:400px;'>".$descripcion."</label>";?></font>		   </td>		  
          <td width="7%"  style=" border-bottom:#CCCCCC solid 1px" >
		  <table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
           <tr>
		   <?php if($_REQUEST['temp']=='productos'){?>
             <td width="29" align="left">
			 <font color="#000000"  face="Verdana, Arial, Helvetica, sans-serif" size="1px"><?php if($ventana=='transf') echo "  "; else echo $moneda; ?></font></td>
			 <?php }?>
             <td width="27" align="right">
			 <font color="#000000"  face="Verdana, Arial, Helvetica, sans-serif" size="1px"><?php 
			 if($ventana=='transf') echo "  "; else echo $otros;		 
			 ?></font></td>
           </tr>
         </table>
		 
		 <?php if($row1[$empresa]<0){
		 $preCostoprod=0;
		 }else{
		 $preCostoprod=$row1[$empresa];
		 }
		 ?>		 </td>
         <td width="5%" align="center" style="display:block; border-bottom:#CCCCCC solid 1px"><?php echo $row1[$campo];?></td>
         <td width="5%" align="center" style="display:none; "><?php echo $row1['und']."-".$row1['factor']."-".$row1[$precioxDefecto]."-".$row1['moneda']."-".$row1['series']."-".$row1['serie']."-".$preCostoprod."-".$row1['precio5']."-".$estado_percep."-".$por_percep."-".str_replace("-","|",$dir_clie)."-".$row1['kardex']."-".$row1['factorOT']."-".$codbarraEnc."-".$precioMin."-".$codAnexProd."-".$tipoprov."-".$tel_cli."-".$ccajas."-".$condClie."-".$esmodelo."-".$cantModelo."-".$tpersona."-".$lotes."-" ?><a name="ancla<?php echo $i;?>" id="ancla"></a></td>
         <td width="11%" align="center" ><?php
		 
		 list($nombClas)=mysql_fetch_row(mysql_query("select des_clas from clasificacion where idclasificacion='".$clasificacion."'"));
		  echo substr($nombClas,0,10);
		  
		  ?></td>
        </tr>
		
	<?php 
   	$i++;
  } 
  
  mysql_free_result($resultado1);
  
}
    if($contador==0){
  ?>
    <tr>
          <td width="7%"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"></font></td>
          <td>&nbsp;</td>
          <td width="7%"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"></font></td>
          <td width="5%" align="center">&nbsp;</td>
          <td width="5%" align="center" style="display:none">&nbsp;</td>
          <td width="11%" align="center" style="display:none">&nbsp;</td>
    </tr>
  
  <?php 
  }
  ?>
      </table>   </td>
  </tr>
 
  <tr>
    <td width="93">&nbsp;</td>
    <td width="221">&nbsp;</td>
    <td width="42">&nbsp;</td>
  </tr>
</table>

<?php mysql_close($cn);?>