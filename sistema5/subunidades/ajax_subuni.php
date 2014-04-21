<?php 
include('../conex_inicial.php');

$peticion=$_REQUEST['peticion'];

switch($peticion){
	
	case "detalle":
	
	?>
	<table width="447" border="0" align="center" cellpadding="1" cellspacing="1">
      <tr style="background:url(../imagenes/bg_contentbase2.gif) ; background-position:100% 40%; ">
            <td width="33" height="21">&nbsp;</td>
            <td width="242"><span class="Estilo10">Unidad</span></td>
            <td width="63" align="center"><span class="Estilo10">Factor</span></td>
            <td width="78" align="center"><span class="Estilo10">Precio</span></td>
            <td colspan="2" align="center"><span class="Estilo10">A</span></td>
      </tr>
      <?php 
	  
	
	  $producto=$_REQUEST['codigo'];
	  $unidad=$_REQUEST['cod_uni'];
	  $des_uni=$_REQUEST['des_uni'];
	  $factor=$_REQUEST['factor'];
	  $precio=$_REQUEST['precio'];
	  $mconv=$_REQUEST['mconv'];
	  $ac=$_REQUEST['ac'];

	  
	if($ac=='insertar'){
	
		  $strSQL="select max(id) as id from unixprod";
		  $resultado=mysql_query($strSQL,$cn);
		  $row=mysql_fetch_array($resultado);
		  $id=$row['id']+1;	  	  	  
		
	$strSQL_save="insert into unixprod(id,producto,unidad,des_uni,factor,precio,mconv) values('".$id."','".$producto."','".$unidad."','".$des_uni."','".$factor."','".$precio."','".$mconv."')";	
		
		mysql_query($strSQL_save,$cn);
		
		$strSQL="update producto set subunidad='S' where idproducto='$producto' ";
		mysql_query($strSQL,$cn);
		
		//echo $strSQL;
		
	}
	
	if($ac=='eliminar'){
	
		// yedem Verificando que no tenga movimiento	
		$rsuni	=	mysql_query("select * from unixprod where id ='$cod' ",$cn);
        $rowuni =   mysql_fetch_array($rsuni);
	    $unipro =  $rowuni['unidad'];
	
	    $rsdet=mysql_query("select unidad from det_mov where cod_prod='$producto' and unidad='$unipro' ",$cn);
       if( mysql_num_rows($rsdet) >0 ){
	  	 echo '<span style="color: #FF0000">Este Sub Unidad tiene movimientos y no puede ser elimindo ?</span>';
		}else{
					//Eliminar Sub Unididad
					$cod=$_REQUEST['cod'];
					$strSQL_del="delete from unixprod where id='".$cod."' ";
					mysql_query($strSQL_del,$cn);
					
					 $strSQL2="select * from unixprod where producto='$producto' ";
					 $resultado2=mysql_query($strSQL2,$cn);
					 $cont=mysql_num_rows($resultado2);
					
					if($cont==0){
					$strSQL3="update producto set subunidad='N' where idproducto='$producto' ";
					mysql_query($strSQL3,$cn);
					}
		}
						
	}
	
	if($ac=='actualizar'){
	
		$strSQL_update="update unixprod set factor='".$factor."',precio='".$precio."' where id='".$_REQUEST['idUnixProd']."'";			
		mysql_query($strSQL_update,$cn);
		
	
	}
	

	  $strSQL="select * from unixprod where producto='$producto' ";
	  $resultado=mysql_query($strSQL,$cn);
	  while($row=mysql_fetch_array($resultado)){
	  ?>
      <tr style="background:<? if ($row['mconv']==""){echo '#F4F4F4';}else{echo '#FFCC00';}?>;">
        <td align="center"><input checked="checked" style="background: none; border:none" type="checkbox" name="checkbox" value="checkbox" disabled="disabled" /></td>
        <td style="color:#333333" ><?php echo $row['des_uni']?></td>
        <td align="right" style="color:#333333"><?php echo $row['factor']?></td>
        <td align="right" style="color:#333333"><?php echo number_format($row['precio'],4)?></td>
        <td width="25" align="center"><a href="javascript:transSQL('eliminar','<?php echo $row['id']?>')"><img src="../imgenes/eliminar.gif" width="14" height="14" border="0" /></a></td>
        <td width="25" align="center"><a href="javascript:transSQL('editar','<?php echo $row['id']."|".$row['unidad']."|".$row['factor']."|".$row['precio'] ?>')"><img src="../imgenes/ico_edit.gif" width="14" height="14" border="0" /></a></td>
      </tr>
      <?php }?>
    </table>
	
	
	<?php 
	
	break;
	

}
?>