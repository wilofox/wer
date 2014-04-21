<?php  session_start();
include('../conex_inicial.php');
include("../funciones/funciones.php");
		$estSP=$_REQUEST['estSP'];
 		if($_REQUEST['temp']=='auxiliares'){
		$tabla="tblproductos1";
		$titulo="Ruc";
		}else{
		$tabla="tblproductos";
		$titulo="Precio";
		}


$tienda=$_REQUEST['tienda'];
$campo="saldo".$tienda;
$empresa="costo_inven".substr($tienda,0,1);
$tipoBus=$_REQUEST['tipoBus'];
$moneda_doc=$_REQUEST['moneda_doc'];

 $serie=$_REQUEST['serie'];
if ($serie=='N'){ $serie=" and series <>'S' "; }

if($_REQUEST['tipomov']=='1'){
$listaProd=" and (lista='3' || lista='1') ";
}else{
$listaProd=" and (lista='3' || lista='2') ";
}

//echo "asha".$_REQUEST['prov_asoc'];
?>

<table id="fila" width="356" border="0" cellpadding="0" cellspacing="0" >
 
  <tr>
    <td colspan="3" >
	
	<table width="570" height="26%" border="0" cellpadding="0" cellspacing="1" bordercolor="#FFFFFF" id="<?php echo $tabla?>">
	
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
			 $strSQL1="select * from cliente  where baja='N' and  ( tipo_aux='C' or tipo_aux='A')   and ".$filtroBus."   order by $criterio limit 50";
			}else{
			
			}
			if($_REQUEST['temp']=='productos'){
			
			$codigosistema=str_pad($nombre, 6, "0", STR_PAD_LEFT);  
			
				if($criterio=="cod_prod"){
				$strSQL1="select * from producto where (upper(cod_prod) like '%".strtoupper($nombre)."%' or upper(codanex2) like '%".strtoupper($nombre)."%' or upper(codanex3) like '%".strtoupper($nombre)."%' ) ".$filtro3.$listaProd.$serie." limit 100 ";
					
				}else{
					
				 if($criterio=="idproducto"){
				 $strSQL1="select * from producto where idproducto='$codigosistema' ".$filtro3.$listaProd.$serie." limit 100 ";
				   }else{
						if($criterio=="serie"){
						if ($estSP=='V'){
						 	$filtroEst=" and estado='$estSP' ";
						}else{
						 	$filtroEst=" and estado='F' ";
						}
						$strSQL1="select * from series,producto where tienda='".$tienda."' and idproducto=producto and upper(serie)='".strtoupper($nombre)."' ".$filtroEst." ".$filtro3.$serie." limit 100 ";
						}else{
							 if($tipoBus=="aprox"){
							 $filtroBus=" nombre like '%$nombre%' ";
							 }else{
							 $filtroBus=" nombre like '$nombre%' ";
							 }
						$strSQL1="select * from producto where ".$filtroBus." ".$filtro3. $listaProd.$serie. " order by nombre limit 100 ";
						}
				   }
				
			    }								
			}else{
			
			}
			
		  		  			   
		// echo $tipoBus."<br>".$strSQL1;
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
				$cfila="#FFFFFF";
			  }else{
				$codigo=$row1['idproducto'];
				$descripcion=caracteres($row1['nombre']);
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
				if(isset($_REQUEST['predefecto']) && $_REQUEST['predefecto']!='' && $_REQUEST['predefecto']!='1'){
				$precioxDefecto='precio'.$_REQUEST['predefecto'];
				}else{
				$precioxDefecto='precio';
				}
				
				if($row1['moneda']=='01' && $moneda_doc=='02' ){
				$otros=number_format($row1[$precioxDefecto]/$tcambio,2);
				$moneda='US$.';
				}else{
					if($row1['moneda']=='02' && $moneda_doc=='01' ){
					$otros=number_format($row1[$precioxDefecto]*$tcambio,2);
					$moneda='S/.';
					}else{
						$otros=number_format($row1[$precioxDefecto],2);
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
								$cfila="#7CF385";
							 }else{
								if($row1['kardex']=='N'){
								$cfila="#FF7171";
								
								}else{
								$cfila="#FFFFFF";
								
								}
						   }
						}			
						
			  }
			  
			  
			  	 /* href="javascript:elegir('<?php echo $codigo ?>','<?php echo $descripcion ?>')"*/
		  ?>
        <tr bgcolor="<?php echo $cfila?>" onmouseover='entrada(this)' >
          <td width="9%" align="center">
		  <font face="Arial, Helvetica, sans-serif" size="1px" style="font:bold">
		  <?php 
		  if($_REQUEST['temp']=='auxiliares'){
		  	//if(isset($_REQUEST['ptovta34'])){
				echo "<a style='cursor=pointer' onclick='selec_cli(this)'  >".$codigo."</a>";
			//}else{
		   		//echo "<a>".$codigo."</a>";
			//}
		  }else{
		  echo "<a style='cursor=pointer' onclick='espec_prod(this)'  >".$codigo."</a>";
		  } ?>
		  </font>		  </td>
         
		  <td width="59%"><font color="#000000" face="Verdana, Arial, Helvetica, sans-serif"  style="font-size:10px; font:bold">
		  
		  
            <?php
			if($_REQUEST['temp']=='productos' ){
		  	 echo str_pad($row1['cod_prod'],15," ",STR_PAD_RIGHT);
			 
		   ?>
		   
&nbsp;&nbsp; | &nbsp;
            <?php
			
			}
		   //$descripcion=$descripcion;
		   echo $descripcion;
		   ?>
          
		  
		  </font></td>
		  
          <td width="11%">
		 
		 <table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
           <tr>
		   <?php if($_REQUEST['temp']=='productos'){?>
             <td width="29" align="left"><font color="#000000"  face="Verdana, Arial, Helvetica, sans-serif" size="1px"><?php echo $moneda ?></font></td>
			 <?php }?>
             <td width="27" align="right"><font color="#000000"  face="Verdana, Arial, Helvetica, sans-serif" size="1px"><?php echo $otros;?></font></td>
           </tr>
         </table>
		 
		 <?php if($row1[$empresa]<0){
		 $preCostoprod=0;
		 }else{
		 $preCostoprod=$row1[$empresa];
		 }
		 ?>		 </td>
         <td width="8%" align="center" style="display:block"><?php echo $row1[$campo];?></td>
         <td width="13%" align="center" style="display:none"><?php echo $row1['und']."-".$row1['factor']."-".$row1[$precioxDefecto]."-".$row1['moneda']."-".$row1['series']."-".$row1['serie']."-".$preCostoprod."-".$row1['precio5']."-".$estado_percep."-".$por_percep."-".$dir_clie."-".$row1['kardex']."-".$row1['factorOT']."-".$codbarraEnc."-".$precioMin."-".$codAnexProd."-" ?><a name="ancla<?php echo $i;?>" id="ancla"></a></td>
        </tr>
		
	<?php 
   	$i++;
  } 
}
    if($contador==0){
  ?>
    <tr>
          <td width="9%"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"></font></td>
          <td>&nbsp;</td>
          <td width="11%"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"></font></td>
          <td width="8%" align="center">&nbsp;</td>
          <td width="13%" align="center" style="display:none">&nbsp;</td>
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
<!-- MMDW:success -->