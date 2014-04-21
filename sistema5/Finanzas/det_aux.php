<?php  include('../conex_inicial.php');
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

?>

<table id="fila" width="356" border="0" cellpadding="0" cellspacing="0" >
 
  <tr>
    <td colspan="3" >
	
	<table width="446" height="26%" border="0" cellpadding="0" cellspacing="1" bordercolor="#FFFFFF" id="<?php echo $tabla?>">
	
	 <?php 
		    $nombre=$_REQUEST['nomb_det'];
			if(isset($_REQUEST['criterio'])){
			$criterio=$_REQUEST['criterio'];
			}else{
				$criterio="";
			}
			
			if(isset($_REQUEST['comboclasificacion'])){
			$clasificacion=$_REQUEST['comboclasificacion'];
			}else{
				$clasificacion="";
			}
			if(isset($_REQUEST['categoria'])){
			$categoria=$_REQUEST['categoria'];
			}else{
				$categoria="";
			}
			if(isset($_REQUEST['subcategoria'])){
			$subcategoria=$_REQUEST['subcategoria'];
			}else{
				$subcategoria="";
			}
			
			
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
			
			if($_REQUEST['tipomov']==1 && $_REQUEST['temp']=='auxiliares'){
			 
				 if( (isset($_REQUEST['prov_asoc'])) && $_REQUEST['prov_asoc']!='' ){
				 $cadena_prov=explode("-",$_REQUEST['prov_asoc']);
				  
				  $filtro=" and ( codcliente='' ";
				  foreach ($cadena_prov as $subkey=> $subvalue) {
				  $filtro=$filtro." || codcliente='".$subvalue."'" ;
				  }
				 
				 $strSQL1="select * from cliente where baja='N' and (tipo_aux='P' or tipo_aux='A') ".$filtro. " )";
				 				 
				 }else{
				 $strSQL1="select * from cliente where baja='N' and (tipo_aux='P' or tipo_aux='A') and $criterio like '%$nombre%' limit 20";
				 }
			}else{
			
			}
			
			if($_REQUEST['tipomov']==2 && $_REQUEST['temp']=='auxiliares'){
			 $strSQL1="select * from cliente  where baja='N' and (tipo_aux='C' or tipo_aux='A') and $criterio like '%$nombre%'  limit 20";
			}else{
			
			}
			if($_REQUEST['temp']=='productos'){
			
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
				if($row1['moneda']=='01')$moneda='S/.'; else $moneda='US$.';
				
				$otros=number_format($row1['precio'],2);	
			
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
        <tr bgcolor="<?php if(isset($cfila)){echo $cfila;}?>">
          <td width="9%">
		  <font face="Verdana, Arial, Helvetica, sans-serif" size="1px">
		  <?php 
		  if($_REQUEST['temp']=='auxiliares'){
		   echo "<a>".$codigo."</a>";
		  }else{
		  echo "<a style='cursor=pointer' onclick='espec_prod(this)'>".$codigo."</a>";
		  } ?>
		  </font>		  </td>
          <td width="55%"><font color="#333333" face="Verdana, Arial, Helvetica, sans-serif" size="1px"><?php echo $descripcion;?></font></td>
         <td width="13%"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
           <tr>
             <td width="29" align="left"><font color="#000000"  face="Verdana, Arial, Helvetica, sans-serif" size="1px"><?php if(isset($moneda)){echo $moneda;} ?></font></td>
             <td width="27" align="right"><font color="#000000"  face="Verdana, Arial, Helvetica, sans-serif" size="1px"><?php echo $otros;?></font></td>
           </tr>
         </table>
		 
		 </td>
         <td width="10%" align="center" style="display:block"><?php if(isset($row1[$campo])){ echo $row1[$campo];}?></td>
         <td width="13%" align="center" style="display:none"><?php echo $row1['und']."-".$row1['factor']."-".$row1['precio']."-".$row1['moneda']."-".$row1['series']."-".$row1['serie']."-".$row1[$empresa]."-" ?><a name="ancla<?php echo $i;?>" id="ancla"></a></td>
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
