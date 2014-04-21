<?php  include_once('../conex_inicial.php');
include("../funciones/funciones.php");

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


$moneda_doc=$_REQUEST['moneda_doc'];
$strSQL1="";
?>

<table id="fila" width="356" border="0" cellpadding="0" cellspacing="0" >
 
  <tr>
    <td colspan="3" >
	
	<table width="446" height="26%" border="0" cellpadding="0" cellspacing="1" bordercolor="#FFFFFF" id="<?php echo $tabla?>">
	
	 <?php 
	 
		    $nombre=$_REQUEST['nomb_det'];
			$criterio=$_REQUEST['criterio'];
			//echo $nombre;
		/*	$clasificacion=$_REQUEST['comboclasificacion'];
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
			
			*/
			//echo $criterio;
			if($criterio==''){
			$criterio='razonsocial';
			}
			
			
			if($_REQUEST['tipomov']==1 && $_REQUEST['temp']=='auxiliares'){
			 		
				 if( (isset($_REQUEST['prov_asoc'])) && $_REQUEST['prov_asoc']!='' ){
				 $cadena_prov=explode("-",$_REQUEST['prov_asoc']);
				  
				  $filtro=" and ( codcliente='' ";
				  foreach ($cadena_prov as $subkey=> $subvalue) {
				  $filtro=$filtro." || codcliente='".$subvalue."'" ;
				  }
				 
				 $strSQL1="select * from cliente where baja='N' and (tipo_aux='P' || tipo_aux='A') ".$filtro. " )";
				 				 
				 }else{
				 $strSQL1="select * from cliente where baja='N' and (tipo_aux='P' || tipo_aux='A') and $criterio like '%$nombre%' limit 20";
				 }
			}
			if($_REQUEST['tipomov']==2 && $_REQUEST['temp']=='auxiliares'){
			 $strSQL1="select * from cliente  where baja='N' and (tipo_aux='C' || tipo_aux='A') and $criterio like '%$nombre%'  limit 20";
			 
			 //echo $strSQL1;
			}
			
			//echo $strSQL1;
			/*if($_REQUEST['temp']=='productos'){
			
			$codigosistema=str_pad($nombre, 6, "0", STR_PAD_LEFT);  
			
				if($criterio=="cod_prod"){
				$strSQL1="select * from producto where cod_prod='$nombre' ".$filtro3." limit 20 ";
				}else{
				 if($criterio=="idproducto"){
				 $strSQL1="select * from producto where idproducto='$codigosistema' ".$filtro3." limit 20 ";
				   }else{
						if($criterio=="serie"){
						$strSQL1="select * from series,producto where tienda='".$tienda."' and idproducto=producto and serie='$nombre' and estado='F' ".$filtro3." limit 20 ";
						}else{
						$strSQL1="select * from producto where nombre like '%$nombre%' ".$filtro3." limit 20 ";
						}
				   }
				}
												
			}else{
			
			}
			*/
		  		  			   
		// echo $strSQL1;
  $resultado1=mysql_query($strSQL1,$cn);
  $contador=mysql_num_rows($resultado1);
//  echo $contador;
$i=0;
  while($row1=mysql_fetch_array($resultado1)){
		  	  						
					
			  if($_REQUEST['temp']=='auxiliares'){
				$codigo=$row1['codcliente'];
				$descripcion=caracteres($row1['razonsocial']);
				$otros=$row1['ruc'];	
			
			  }else{
				$codigo=$row1['idproducto'];
				$descripcion=caracteres($row1['nombre']);
				
			//	echo $row1['moneda']." ".$moneda_doc;
				if($row1['moneda']=='01' && $moneda_doc=='02' ){
				$otros=number_format($row1['precio']/$tcambio,2);
				$moneda='US$.';
				}else{
					if($row1['moneda']=='02' && $moneda_doc=='01' ){
					$otros=number_format($row1['precio']*$tcambio,2);
					$moneda='S/.';
					}else{
						$otros=number_format($row1['precio'],2);
						if($moneda_doc=='01')$moneda='S/.'; else $moneda='US$.';
					}
				
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
        <tr bgcolor="<?php echo $cfila?>">
          <td width="9%">
		  <font face="Arial, Helvetica, sans-serif" size="1px" style="font:bold">
		  <?php 
		  if($_REQUEST['temp']=='auxiliares'){
		  
		  ?>
		  <a style="cursor=pointer" onclick="selecCliente('<?php echo $codigo?>','<?php echo $descripcion?>')"><?php echo $codigo?></a>
		  <?php 
		 //  echo "<a style='cursor=pointer' onclick='selecCliente($descripcion)'>".$codigo."</a>";
		   
		  }else{
		  echo "<a style='cursor=pointer' onclick='espec_prod(this)'>".$codigo."</a>";
		  } ?>
		  </font>		  </td>
          <td width="55%"><font color="#000000" face="Verdana, Arial, Helvetica, sans-serif"  style="font-size:10px; font:bold"><?php
		   //$descripcion=$descripcion;
		   echo $descripcion;
		   ?></font></td>
         <td width="13%">
		 
		 <table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
           <tr>
		   <?php if($_REQUEST['temp']=='productos'){?>
             <td width="29" align="left"><font color="#000000"  face="Verdana, Arial, Helvetica, sans-serif" size="1px"><?php echo $moneda ?></font></td>
			 <?php }?>
             <td width="27" align="right"><font color="#000000"  face="Verdana, Arial, Helvetica, sans-serif" size="1px"><?php echo $otros;?></font></td>
           </tr>
         </table>
		 
		 </td>
         <td width="10%" align="center" style="display:block"><?php echo $row1[$campo];?></td>
         <td width="13%" align="center" style="display:none"><?php echo $row1['und']."-".$row1['factor']."-".$row1['precio']."-".$row1['moneda']."-".$row1['series']."-".$row1['serie']."-".$row1[$empresa]."-".$row1['pre_ref']."-" ?><a name="ancla<?php echo $i;?>" id="ancla"></a></td>
        </tr>
	

	
	<?php 
   	$i++;
  } 
  
    if($contador==0){
  ?>
    <tr>
          <td width="9%"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"></font></td>
          <td width="55%">&nbsp;</td>
          <td width="13%"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"></font></td>
          <td width="10%" align="center">&nbsp;</td>
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
