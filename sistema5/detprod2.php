<style type="text/css">
<!--
.Estilo12 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo13 {font-size: 11px}
.Estilo18 {font-family: Arial, Helvetica, sans-serif}
.Estilo21 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo22 {font-size: 12px; color: #FFFFFF; font-family: Verdana, Arial, Helvetica, sans-serif;}
.linetopbut {border-bottom:#000000 solid 1px; border-top:#000000 solid 1px;border-right:#999999 solid 1px;}
.Estilo29 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000000;
}
-->
</style>
<table id="tbl_prod" width="100%" border="0" cellspacing="1">
<tr style="background:url(imagenes/bg_contentbase2.gif); background-position:100px 55px"  >
              <td width="3%" height="20" align="center" class="Estilo31">A</td>
              


              <td onClick="ordenamiento()" style="border:#CCCCCC solid 1px; cursor:pointer; text-decoration:underline" width="38%" align="center"  class="Estilo31">Producto</td>
			  <td  width="12%" align="center"  class="Estilo31">Cod.Anx</td>
			  <td  width="7%"  class="Estilo31">UND</td>
              <td  width="5%"  class="Estilo31">Factor</td>
			  <td  width="6%" align="center"  class="Estilo31">Clas</td>
              <td  width="7%" align="center"  class="Estilo31">Cat</td>
              <td  width="7%" align="center"  class="Estilo31">Scat</td>
              <td  width="4%"  class="Estilo31">Img</td>

			  <td  width="11%" align="center" class="Estilo31">Codigo</td>
    <?php  
	
	//----------eliminando------------------------
	include('conex_inicial.php');
	include ('funciones/funciones.php');
	//-------------------------------------------
	
	
	 		   $registros = 100; 
			   $pagina = $_REQUEST['pagina']; 
			   
		//echo $pagina;

		if ($pagina=='') { 
		$inicio = 0; 
		$pagina = 1; 
		} 
		else { 
		$inicio = ($pagina - 1) * $registros; 
		} 
			
	
	//---------------------------------------------
	
	if($_REQUEST['valor']!=""){
	$valor=$_REQUEST['valor'];
	$criterio=$_REQUEST['criterio'];
	$filtro=" and  $criterio like'%$valor%'";
	}
	
	if($_REQUEST['ordenar']!=""){
	$filtro2=" order by ".$_REQUEST['ordenar']. " ".$_REQUEST['orden']; 	
	}else{
	$filtro2=" order by idProducto "; 	
	}
	
	$clasificacion=$_REQUEST['clasificacion'];
	$categoria=$_REQUEST['categoria'];
	$subcategoria=$_REQUEST['subcategoria'];
	
	$filtro3="";
	if($clasificacion!='999'){
	$filtro3=" and  clasificacion='$clasificacion' ";
	}
	if($categoria!='999'){
	$filtro3.=" and  categoria='$categoria' ";
	}
	if($subcategoria!='999'){
	$filtro3.=" and  subcategoria='$subcategoria' ";
	}
	
	
	//echo "select * from producto where 1 ".$filtro.$filtro3.$filtro2." " ;
  $resultados = mysql_query("select * from producto where concepto='S' ".$filtro.$filtro3.$filtro2." " ,$cn);
  $total_registros = mysql_num_rows($resultados); 
  $resultados = mysql_query("select * from producto where concepto='S' ".$filtro.$filtro3.$filtro2." LIMIT $inicio, $registros " ,$cn);
			// echo "select * from producto where 1 ".$filtro.$filtro3.$filtro2." " ;
	$i=2;		
	
	$resultados2 =mysql_num_rows($resultados); 
	$total_paginas = ceil($total_registros / $registros);  
	
	  
while($row=mysql_fetch_array($resultados))
{
	
	if($row['igv']=='N' && $row['kardex']=='N'){
	$cfila="#CFECF1";
	}else{
		if($row['igv']=='N'){
			$cfila="#7CF385";
		 }else{
			if($row['kardex']=='N'){
			$cfila="#FF7171";
			
			}else{
			$cfila="#FFFFFF";
			
			}
	    }
	}
	

$codigo=$row['idproducto'];
$nombre=$row['nombre'];
$codprod=$row['cod_prod'];
$precio=$row['precio'];
$clasificacion=$row['clasificacion'];
$categoria=$row['categoria'];
$subcategoria=$row['subcategoria'];
$und=$row['und'];
$factor=$row['factor'];
$imagen1=$row['imagen'];

 ?>
  </tr>
  <tr ondblclick="editar('actualizar')"  bgcolor="<?php echo $cfila?>" id="<?php echo $color; ?>" style="height:18px" onClick="entrada(this)" >
    <td style="border-left:#999999 solid 1px">
      <input  style="border:#CCCCCC; background:<?php echo $cfila?>" name="xaux" type="radio"  value="<?php echo $codigo;?>" />
   </td>
    <td align="left"><span class="Estilo12"><?php 
	
	if(strlen($nombre)>34){
	echo substr(caracteres($nombre),0,34)."...";
	}else{
	echo caracteres($nombre);
	}
	
	
	?></span><span class="Estilo12">&nbsp;</span></td>
	<td align="center"><span class="Estilo12"><?php echo $codprod;?></span></td>
	    <td align="center"><span class="Estilo12"><?php 
	$strSQLund="select * from unidades where id='".$und."'";
	$resultadoUnd=mysql_query($strSQLund);
	$rowUnd=mysql_fetch_array($resultadoUnd);
	echo $rowUnd['nombre'];
	
	;?></span></td>
	    <td align="center"><span class="Estilo12"><?php echo $factor;?></span></td>
    <td align="center" ><span class="Estilo12"><?php echo $clasificacion;?></span></td>
    <td align="center"><span class="Estilo12"><?php echo $categoria;?></span></td>
    <td align="center"><span class="Estilo12"><?php echo $subcategoria;?></span></td>


    <td align="right"><span class="Estilo12">
	<?php 
	
	if($imagen1==''){
	echo "";			
	}else{
	echo "<img src='imgenes/icon5.gif'>";
	}
	
	 ?>
	</span></td>


	<td align="center"><span class="Estilo12"><?php echo $codigo;?></span></td>
  </tr>
  <?php  
  
  }
  mysql_free_result($resultados);
  
  ?>
</table>

?

<table width="100%" height="21" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="311" height="21" align="left" valign="bottom" style="color:#999999"><span class="Estilo29">Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (de <strong><?php echo $total_registros?></strong> productos)</span>.</td>
    <td width="526" align="right" valign="bottom" style="color:#999999"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:13px">
      <?php 
			  
 if(($pagina - 1) > 0) { 
echo "<a style='cursor:pointer' onclick='cargarproducto($pagina-1)'>< Anterior </a> "; 
} 

for ($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
	echo "<b style='color:#000000'>".$pagina."</b> "; 
	} else { 
	echo "<a style='cursor:pointer' href='#' onclick='cargarproducto($i)'>$i</a> "; 
	}
}

if(($pagina + 1)<=$total_paginas) { 
echo " <a style='cursor:pointer' onclick='cargarproducto($pagina+1)'>Siguiente ></a>"; 
} 

		?>
      <input type="hidden" name="pag" value="<?php echo $pagina?>" />
    &nbsp;&nbsp;    </font> </td>
  </tr>
</table>
