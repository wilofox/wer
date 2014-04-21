<?php 
include('../conex_inicial.php');


$peticion=$_REQUEST['peticion'];
$tipomov=$_REQUEST['tipomov'];

switch($peticion){
	case "carga_doc":
	
	 ?>
<style type="text/css">
<!--
.Estilo20 {color: #FFFFFF; font-weight: bold; }
-->
</style>

	
			 <select style="width:140" name="doc"  onChange="cambiar_enfoque(this);">
              <option value="0"></option>
              <?php 
		   $resultados10 = mysql_query("select * from operacion where  codigo!='TS'  and tipo='".$tipomov."' order by descripcion ",$cn); 
			while($row10=mysql_fetch_array($resultados10))
			{
					
		  ?>
              <option value="<?php echo $row10['codigo']?>"><?php echo $row10['codigo']."-".$row10['descripcion']?></option>
              <?php }?>
            </select>
	

	<?php
	break;
	
	case "detalle_doc":
	
	?>
	<table width="752" border="0" align="center" cellpadding="1" cellspacing="1">
      <tr height="21" style="background:url(../imagenes/bg_contentbase2.gif) ; background-position:100% 60%; ">
        <td width="35" >&nbsp;</td>
        <td width="198"><span class="Estilo20">Documento</span></td>
        <td width="72"><span class="Estilo20">Serie</span></td>
        <td width="78"><span class="Estilo20">Apartir de </span></td>
        <td width="72"><span class="Estilo20">Hasta</span></td>
        <td width="172"><span class="Estilo20">Empresa</span></td>
        <td width="172"><span class="Estilo20">PC</span></td>
        <td width="172"><span class="Estilo20">T. Cola</span></td>
        <td width="172"><span class="Estilo20">Cola Imp </span></td>
        <td width="65" align="center"><span class="Estilo20">Impresi&oacute;n</span></td>
        <td width="35" align="center"><span class="Estilo20">E</span></td>
      </tr>
      <?php 
	  
	
	  $usuario=$_REQUEST['usuario'];
	  $serie=$_REQUEST['serie'];
	  $numero_ini=$_REQUEST['numero_ini'];
	  $numero_fin=$_REQUEST['numero_fin'];
	  $accion=$_REQUEST['accion'];
	  $empresa=$_REQUEST['empresa'];
	  $doc=$_REQUEST['doc'];
	  $desdoc=$_REQUEST['desdoc'];
	  
	  $pc=$_REQUEST['pc'];
	  $cola=$_REQUEST['cola'];	   
	  $ac=$_REQUEST['ac'];
	  
	  $tcola=$_REQUEST['tcola'];
	  
	  
	if($ac=='insertar'){
	
		  $strSQL="select max(id) as id from docuser";
		  $resultado=mysql_query($strSQL,$cn);
		  $row=mysql_fetch_array($resultado);
		  $id=$row['id']+1;	  	  	  
		
		$strSQL_save="insert into docuser(id,usuario,tipomov,doc,desdoc,impresion,serie,numero_ini,numero_fin,empresa,pc,cola,tcola) values('".$id."','".$usuario."','".$tipomov."','".$doc."','".$desdoc."','".$accion."','".$serie."','".$numero_ini."','".$numero_fin."','".$empresa."','".$pc."','".$cola."','".$tcola."')";
		
		//echo $strSQL_save;
							
		mysql_query($strSQL_save,$cn);	
		
		
	}
	
	if($ac=='eliminar'){
		$cod=$_REQUEST['cod'];
		$strSQL_del="delete from docuser where id='".$cod."' ";
		mysql_query($strSQL_del,$cn);	
	}
	
	
	  
	  	//echo   $strSQL_save;	  
	  
	  $strSQL="select * from docuser where tipomov='$tipomov' and usuario='$usuario' ";
	  //echo $strSQL;
	  $resultado=mysql_query($strSQL,$cn);
	  while($row=mysql_fetch_array($resultado)){
	  ?>
      <tr style="background:#F4F4F4;">
        <td align="center"><?php echo $row['doc']?></td>
        <td ><?php echo $row['desdoc']?></td>
        <td><?php echo $row['serie']?></td>
        <td><?php echo $row['numero_ini']?></td>
        <td><?php echo $row['numero_fin']?></td>
        <td><?php 
		
		$strSQL_suc="select * from sucursal where cod_suc='".$row['empresa']."'";
		$resultado_suc=mysql_query($strSQL_suc,$cn);
		$row_suc=mysql_fetch_array($resultado_suc);
		echo $row_suc['des_suc']; 
		
		?></td>
        <td><?php echo $row['pc']?></td>
        <td><?php echo $row['tcola']?></td>
        <td><?php echo $row['cola']?></td>
        <td align="center"><?php echo $row['impresion']?></td>
        <td align="center"><a href="javascript:insertar('eliminar','<?php echo $row['id']?>')"><img src="../imgenes/eliminar.gif" width="14" height="14" border="0" /></a></td>
      </tr>
      <?php }?>
    </table>
	
	
	<?php 
	
	break;
	
	case "cargar_sucursal":
	$usuario=$_REQUEST['coduser'];	
	$strSQL="select * from usuarios where codigo='".$usuario."'";
	$resultado=mysql_query($strSQL,$cn);
	$row=mysql_fetch_array($resultado);
	$sucursal=$row['sucursal'];
	//echo $strSQL;
	?>
	 <select style="width:160"  name="sucursal" onChange="doAjax('../carga_cbo_tienda.php','&codsuc='+document.form1.sucursal.value,'cargar_cbo','get','0','1','','');"  >
                      <option value="0"></option>
                      <?php 
		
			
			$resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn); 
			while($row1=mysql_fetch_array($resultados1))
			{
				$marcar="";
				if($sucursal==$row1['cod_suc']){
				$marcar=" selected='selected' ";
				}
			?>
                      <option <?php echo $marcar?>  value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
            <?php  }?>
			
             </select>
	<?php
	break;
	
	case "cargar_tienda":
	$usuario=$_REQUEST['coduser'];	
	$sucursal=$_REQUEST['sucursal'];
		
	$strSQL="select * from usuarios where codigo='".$usuario."'";
	$resultado=mysql_query($strSQL,$cn);
	$row=mysql_fetch_array($resultado);
	$tienda=$row['tienda'];
	$busaux=$row['busaux'];
	$permis=$row['permiso'];
	//echo $sucursal;
	?>
	 <select style="width:160px"  name="almacen" >
                      <option value="0"></option>
                      <?php 
		
			
			$resultados1 = mysql_query("select * from tienda where cod_suc='".$sucursal."' order by des_tienda ",$cn); 
			while($row1=mysql_fetch_array($resultados1))
			{
				$marcar="";
				if($tienda==$row1['cod_tienda']){
				$marcar=" selected='selected' ";
				}
			?>
                      <option <?php echo $marcar?>  value="<?php echo $row1['cod_tienda'] ?>"><?php echo $row1['des_tienda'] ?></option>
            <?php  }?>
			
             </select>|<?php echo $busaux."|".$permis;break;
	

}
?>