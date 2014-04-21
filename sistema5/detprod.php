<?php 
if($_REQUEST['formato']=="excel"){
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=excel.xls");
}


?>
<style type="text/css">
<!--
.Estilo12 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
.linetopbut {border-bottom:#000000 solid 1px; border-top:#000000 solid 1px;border-right:#999999 solid 1px;}
.Estilo29 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000000;
}
.Estilo31 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>
<table id="tbl_prod" width="100%" border="1" cellspacing="1" >
<tr style="background:url(imagenes/bg_contentbase2.gif); background-position:100px 55px"  >
             
			 <?php 
			 
			 if($_REQUEST['formato']!="excel"){
			 ?>
			 
			  <td width="2%" height="28" align="center" class="Estilo31">A</td>			  
			  
             <?php } ?>
			 
			 

              <td onClick="ordenamiento()" style="border:#CCCCCC solid 1px; cursor:pointer; text-decoration:underline" width="6%" align="center"  class="Estilo31">Codigo</td>
			  <td onClick="ordenamiento()"  width="7%" align="center"  class="Estilo31"><span class="Estilo31"  >Codigo Anexo</span></td>
              <td  width="51%" align="center"  class="Estilo31"><span class="Estilo31" style="border:#CCCCCC solid 1px; cursor:pointer; text-decoration:underline">Descripcion de Producto </span></td>
    <td  width="7%" align="center"  class="Estilo31"><p><span class="Estilo31" style="border:#CCCCCC solid 1px; cursor:pointer; text-decoration:underline">Marca</span></p></td>
			  <td  width="4%" align="center"  class="Estilo31">UND</td>
              <td  width="5%" align="center"  class="Estilo31">Stock Vilca </td>
              <td  width="5%" align="center"  class="Estilo31">Stock Vram </td>
              <td  width="6%" align="center"  class="Estilo31">P4. Costo </td>
			  <td  width="3%" align="center"  class="Estilo31">Stock Min. </td>
			  <td  width="4%" align="center"  class="Estilo31">Img </td>
			  <?php  
	
	//----------eliminando------------------------
	include('conex_inicial.php');
	include ('funciones/funciones.php');
	//-------------------------------------------
	
	
	 		   $registros = 250; 
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
	$filtro2=" order by idProducto desc "; 	
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
	
	if($_REQUEST['estado']=='0')
	$filtroEstado=" ";
	else
	$filtroEstado=" and baja='".$_REQUEST['estado']."'";
	
	//echo "estado='".$_REQUEST['estado'].$filtroEstado."'";
	//echo "select * from producto where 1 ".$filtro.$filtro3.$filtro2." " ;
  $resultados = mysql_query("select * from producto where 1 ".$filtro.$filtro3.$filtroEstado.$filtro2." " ,$cn);
  $total_registros = mysql_num_rows($resultados); 
  
  if($_REQUEST['formato']=="excel"){
  $resultados = mysql_query("select * from producto where 1 ".$filtro.$filtro3.$filtroEstado.$filtro2." " ,$cn);
 //$resultados = mysql_query("select * from producto where 1 ".$filtro.$filtro3.$filtroEstado.$filtro2." LIMIT $inicio, $registros " ,$cn);  
  }else{  
  $resultados = mysql_query("select * from producto where 1 ".$filtro.$filtro3.$filtroEstado.$filtro2." LIMIT $inicio, $registros " ,$cn);  
  }
  
  
  
			// echo "select * from producto where 1 ".$filtro.$filtro3.$filtroEstado.$filtro2." " ;
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
$codanex2=$row['codanex2'];
$codanex3=$row['codanex3'];
$precio=$row['precio'];
$precio=$row['precio'];
$precio3=$row['precio4'];

$clasificacion=$row['clasificacion'];
$categoria=$row['categoria'];
$subcategoria=$row['subcategoria'];
$und=$row['und'];
$factor=$row['factor'];
$imagen1=$row['imagen'];
$manejaseries=$row['series'];
$garantia=$row['garantia'];
$precio1=$row['precio'];
if($row['moneda']=='01'){
$moneda="S/.";
}else{
$moneda="US$.";
}

$stock=$row['saldo101']+$row['saldo102']+$row['saldo103']+$row['saldo104'];
$stock2=$row['saldo201']+$row['saldo202']+$row['saldo203']+$row['saldo204'];

			/*$sumsaldos=0;
			$strSQL22="select * from tienda order by cod_tienda";
			$resultado22=mysql_query($strSQL22,$cn);
			while($row22=mysql_fetch_array($resultado22)){
			$campo="saldo".$row22['cod_tienda'];
			$sumsaldos=$sumsaldos+$row[$campo];;
			}*/
			
			/*
			for($i=0;$i<count($saldos);$i++){
				$sumsaldos=$sumsaldos." + ".$saldos[$i];
			}
			*/

$totalStockMin=0;


if($_REQUEST['estado']=='0' && $row['baja']=='S'){


	$cfila="#CCCCCC";

}

 ?>
  </tr>
  <tr ondblclick="editar('actualizar')"  bgcolor="<?php echo $cfila?>" id="<?php echo $color; ?>" style="height:18px" onClick="entrada(this)" >
    
	 <?php 			 
		 if($_REQUEST['formato']!="excel"){
	 ?>
	<td style="border-left:#999999 solid 1px">
      <input  style="border:#CCCCCC; background:<?php echo $cfila?>" name="xaux" type="radio"  value="<?php echo $codigo;?>" />   </td>
	<?php } ?>  
	  
    <td align="left"><span class="Estilo12" title="<?php echo  $AnexNomEti1." : ".$codprod." \n ".$AnexNomEti2." : ".$codanex2." \n ".$AnexNomEti3." : ".$codanex3." \n $PrecNomEti1: ".number_format($precio1,2)." \n $PrecNomEti3: ".number_format($precio1,2);  ?>">&nbsp;<?php echo $codigo;?></span></td>
	<td align="left"><span class="Estilo12"><?php echo $codprod;?></span></td>
	<td align="left" title="<?php echo  $AnexNomEti1." : ".$codprod." \n ".$AnexNomEti2." : ".$codanex2." \n ".$AnexNomEti3." : ".$codanex3." \n $PrecNomEti1: ".number_format($precio1,2)." \n $PrecNomEti3: ".number_format($precio1,2);  ?>"><span class="Estilo12">
	  <?php 
	
	if(strlen($nombre)>34){
	echo caracteres($nombre);
	}else{
	echo caracteres($nombre);
	}
	
	
	?>
	</span></td>
	<td align="center" title="<?php echo  $AnexNomEti1." : ".$codprod." \n ".$AnexNomEti2." : ".$codanex2." \n ".$AnexNomEti3." : ".$codanex3." \n $PrecNomEti1: ".number_format($precio1,2)." \n $PrecNomEti3: ".number_format($precio1,2);  ?>"><span class="Estilo12">    
	<?php 
		$strCLA="select * from clasificacion  where idclasificacion='".$clasificacion."'";
		$resultadoCLA=mysql_query($strCLA,$cn);
		$rowCLA=mysql_fetch_array($resultadoCLA);
		 echo $rowCLA['des_clas'];

			
		?>   </span></td>
	    <td align="center"><span class="Estilo12"><?php 
	$strSQLund="select * from unidades where id='".$und."'";
	$resultadoUnd=mysql_query($strSQLund);
	$rowUnd=mysql_fetch_array($resultadoUnd);
	echo $rowUnd['nombre'];
	
	;?></span></td>
	    <td align="center" style="color:#0099CC; font-size:12px"><strong>
	      <?php 
	
	echo $stock;
	?>
	    </strong></td>
      <td align="center" style="color:#0099CC; font-size:12px"><?php echo $stock2?></td>
	    <td align="right"><span class="Estilo12"><?php echo $precio3;?></span></td>
        <td align="center" bgcolor="<?php echo $cfila?>"><span class="Estilo12"><?php 
		
		$totalStockMin=0;	
		$strSQLStockMin="select * from stockmintienda where producto='".$codigo."'";
		$resultadoStockMin=mysql_query($strSQLStockMin,$cn);
		while($rowStockMin=mysql_fetch_array($resultadoStockMin)){
		$totalStockMin=$totalStockMin+$rowStockMin['stockmin'];
		}
		if($totalStockMin>0){
		echo " <img src='imgenes/check.png' width='17' height='15' />";
		}else{
		echo " &nbsp;";
		}
		
		?>
       </span></td>
        <td align="center" bgcolor="<?php echo $cfila?>"><span class="Estilo12">
          <?php 
		
		
		if($imagen1!=''){
		echo " <img src='imgenes/check.png' width='17' height='15' />";
		}else{
		echo " &nbsp;";
		}
		
		?>
        </span></td>
  </tr>
  <?php  
  
  }
  mysql_free_result($resultados);
  
  ?>
</table>

 <?php 
			 
			 if($_REQUEST['formato']!="excel"){
			 ?>

?
<table width="100%" height="21" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="462" height="21" align="left" valign="top" style="color:#000000; font-size:11px"><span >Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (de <strong><?php echo $total_registros?></strong> productos)</span>.</td>
    <td width="559" align="right" valign="bottom" style="color:#999999"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
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

<?php } ?>
