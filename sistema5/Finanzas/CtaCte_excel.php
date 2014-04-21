<?php 
//session_start();
include('../conex_inicial.php');

if($_REQUEST['formato']=="excel"){

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=excel.xls");
}


			$tienda=$_REQUEST['tienda'];
			$sucursal=$_REQUEST['sucursal'];
			$precios=$_REQUEST['precios'];
			$incluir=$_REQUEST['incluir'];
			
			//echo  $incluir;
					
			if($precios=='costo_inven'){
			$campo_precio=$precios.$sucursal;
			}else{
			$campo_precio=$precios;
			}
												
			$strSQL22="select * from tienda order by cod_tienda";
			$resultado22=mysql_query($strSQL22,$cn);
			while($row22=mysql_fetch_array($resultado22)){
			$saldos[]="saldo".$row22['cod_tienda'];
			}
	
			if($tienda==0){			
				$sumsaldos="( ";
				for($i=0;$i<count($saldos);$i++){
				$sumsaldos=$sumsaldos." + ".$saldos[$i];
				}
				$sumsaldos.=" )";
			}else{
			$sumsaldos="saldo".$tienda;
			}
			
			if($incluir==1){
			$filtro_incluir=" and $sumsaldos >0 ";
			}else{
				if($incluir==2){
				$filtro_incluir=" and $sumsaldos <0 ";
				}else{
					if($incluir==3){
					$filtro_incluir=" and $sumsaldos=0 ";
					}else{
						$filtro_incluir=" ";				
					}				
				}
			}
			

		$registros = 40; 
		$pagina = $_REQUEST["pagina"]; 
		
		if (!$pagina) { 
		$inicio = 0; 
		$pagina = 1; 
		} 
		else { 
		$inicio = ($pagina - 1) * $registros; 
		}




?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo10 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo11 {font-family: Arial, Helvetica, sans-serif}
.Estilo13 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.Estilo15 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	font-weight: bold;
}
.Estilo17 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.Estilo19 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
body {
	margin-left: 20px;
	margin-top: 5px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo33 {color: #000000}
-->
</style>
</head>

<script>
function cerrar(){
//alert();
//window.close();
}

</script>

<body >
<div id="seleccion" style="height:600px; width:670px; overflow:auto" >
<table width="636" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" style="border:#999999 solid 1px" >
  <tr>
    <td colspan="7">
	
	<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:#999999 solid 1px">
      <tr>
        <td width="143" class="Estilo19" >Pagina <?php echo $pagina; ?></td>
        <td width="364" >&nbsp;</td>
        <td width="125" align="right" ><span class="Estilo13">Fecha: <?php echo date('d-m-Y');?></span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center"><span class="Estilo15">Reporte de Stock Valorizado </span></td>
        <td align="right"><span class="Estilo13">Hora : <?php echo date('H:i:s',time()-3600)?></span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center" valign="top"><span class="Estilo17">Al: <?php echo date('d-m-Y')?></span></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><span class="Estilo19">Sucursal: <?php
		
			$strSQL_suc="select * from sucursal where cod_suc='$sucursal'";
			$resultado_suc=mysql_query($strSQL_suc,$cn);
			$row_suc=mysql_fetch_array($resultado_suc);
			
			//echo $row_suc['des_suc'];
		 
		 
		 ?><br>
Almacen: <?php 

			$strSQL_suc="select * from tienda where cod_tienda='$tienda'";
			$resultado_suc=mysql_query($strSQL_suc,$cn);
			$row_suc=mysql_fetch_array($resultado_suc);
			
			if($tienda==0){
			echo "Todas las tiendas";
			}else{
			echo $row_suc['des_tienda'];
			}
			
			
?></span></td>
        <td>&nbsp;</td>
      </tr>
    </table>	</td>
  </tr>
  
  <tr>
    <td height="29">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="10%" height="29"><span class="Estilo13">Codigo</span></td>
    <td width="53%"><span class="Estilo13">Nombre de Articulo </span></td>
    <td width="7%"><span class="Estilo13">Stock </span></td>
    <td width="6%"><span class="Estilo13">Mon</span></td>
    <td width="7%" align="right"><span class="Estilo13">Precio</span></td>
    <td width="8%" align="right"><span class="Estilo13">Val S/. </span></td>
    <td width="9%" align="right"><span class="Estilo13">Val US$ </span></td>
  </tr>
<?php 

		
		

		
		$filtro_cla=$_REQUEST['filtro_cla'];
		$filtro_cat=$_REQUEST['filtro_cat'];
		$filtro_sub=$_REQUEST['filtro_sub'];
		
		$agr_cla=$_REQUEST['agr_cla'];
		$agr_cat=$_REQUEST['agr_cat'];
		$agr_sub=$_REQUEST['agr_sub'];		
		
		$filtro_ordenar=$_REQUEST['ordenar'];
		$filtro_precio="";
		
		
		//echo $filtro_cat;
		
	if($filtro_cla!="" || $filtro_cat!="" || $filtro_sub!=""){	
	 
	    if($filtro_cla!=""){
		$filtro1=" and p.clasificacion='$filtro_cla' ";
		}		
		if($filtro_cat!=""){
		$filtro1=$filtro1." and p.categoria='$filtro_cat' ";
		}
		if($filtro_sub!=""){
		$filtro1=$filtro1." and p.subcategoria='$filtro_sub' ";
		}			
	}
	
	if($agr_cla!='N' || $agr_cat!='N' || $agr_sub!='N'){
	
		if($agr_cla=='S' and $agr_cat=='S' and $agr_sub=='S'){
		$clas="999";
		$cat="999";
		$subcat="999";
		$filtro2=" des_clas,des_cat,des_subcateg ";
		$filtro3=" p.clasificacion=idclasificacion and p.categoria=idcategoria and p.subcategoria=idsubcategoria  ";
		}else{
		if($agr_cla=='S' and $agr_cat=='S'){
		$clas="999";
		$cat="999";
		$subcat="";
		$filtro2=" des_clas,des_cat ";
		$filtro3=" p.clasificacion=idclasificacion and p.categoria=idcategoria and p.subcategoria!='000'  ";
		}else{
		if($agr_cla=='S' and $agr_sub=='S'){
		$clas="999";
		$cat="";
		$subcat="999";
		$filtro2=" des_clas,des_subcateg ";
		$filtro3=" p.clasificacion=idclasificacion and p.categoria!='000' and p.subcategoria=idsubcategoria  ";
		}else{
		if($agr_cat=='S' and $agr_sub=='S'){
		$clas="";
		$cat="999";
		$subcat="999";
		$filtro2=" des_cat,des_subcateg ";
		$filtro3=" p.clasificacion!='000' and p.categoria=idcategoria and p.subcategoria=idsubcategoria  ";
		}else{
		if($agr_cla=='S'){
		$clas="999";
		$cat="";
		$subcat="";
		$filtro2=" des_clas ";
		$filtro3=" p.clasificacion=idclasificacion and p.categoria!='000' and p.subcategoria!='000'  ";
		}else{
		if($agr_cat=='S'){
		$clas="";
		$cat="999";
		$subcat="";
		$filtro2=" des_cat ";
		$filtro3=" p.clasificacion!='000' and p.categoria=idcategoria and p.subcategoria!='000'  ";
		}else{
		if($agr_sub=='S'){
		$clas="";
		$cat="";
		$subcat="999";
		$filtro2=" des_subcateg ";
		$filtro3=" p.clasificacion!='000' and p.categoria!='000' and p.subcategoria=idsubcategoria  ";
		}else{
		$clas="";
		$cat="";
		$subcat="";
		$filtro2=" cod_prod ";
		$filtro3=" p.clasificacion!='000' and p.categoria!='000' and p.subcategoria!='000'  ";
		
		}
		}
		}
		}
		}
		}
		}
	}else{
	$filtro2=" cod_prod ";
	$filtro3=' p.clasificacion=idclasificacion and p.categoria=idcategoria and p.subcategoria=idsubcategoria   ';
	}	
	
		$strSQL="select ".$filtro2.",idproducto,nombre, p.* from producto p ,clasificacion ,categoria ,subcategoria where ".$filtro3." ".$filtro1." ".$filtro_incluir."  group by nombre,idproducto order by des_clas asc,des_cat asc,des_subcateg asc, ".$filtro_ordenar." ";	
		
	//	echo $strSQL;
		
		$resultado = mysql_query($strSQL); 
		$total_registros = mysql_num_rows($resultado); 
		$resultado = mysql_query($strSQL." LIMIT $inicio, $registros"); 
			
		$resultados2 =mysql_num_rows($resultado); 
		$total_paginas = ceil($total_registros / $registros);   
		
		
		
		
		while($row=mysql_fetch_array($resultado)){
		
				 if($tienda==0 || $tienda==""){
					$tot_saldo=0;
					for($i=0;$i<count($saldos);$i++)
						$tot_saldo=$tot_saldo+$row[$saldos[$i]];
				 }else{
				   $campo="saldo".$tienda;
				   $tot_saldo=$row[$campo];
				   
				 }
				 

		
		
		$total=$total+($tot_saldo*$row[$campo_precio]);
		
							
		if($clas!=$row['des_clas']){
		$clas=$row['des_clas'];
		echo " <tr>
    <td  colspan='2' style='color:#006666 ; font:bold ; font:Arial, Helvetica, sans-serif; font-size:12px'>".$clas."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
 
  </tr>
		";
		
		}
		
		if($cat!=$row['des_cat']){
		$cat=$row['des_cat'];
		
		echo " <tr>
    <td  colspan='2' style='color:#003399; font:bold; font:Arial, Helvetica, sans-serif; font-size:12px'>&nbsp;&nbsp;".$cat."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>

  </tr>
		";
		
		}
		
		if($subcat!=$row['des_subcateg']){
		$subcat=$row['des_subcateg'];
		
		echo " <tr>
    <td style='color:#FF0000 ; font:bold ; font:Arial, Helvetica, sans-serif; font-size:12px' colspan='2'>&nbsp;&nbsp;&nbsp;&nbsp;".$subcat."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>

  </tr>
		";
		
		}
			
?>
  
  <tr>
    <td><span class="Estilo10"><?php echo $row['idproducto'];?></span></td>
    <td><span class="Estilo10"><?php echo $row['nombre'];?></span></td>
    <td align="center" ><span class="Estilo10"><?php echo $tot_saldo;?></span></td>
    <td align="center"><span class="Estilo10">S/.</span></td>
    <td align="right"><span class="Estilo10"><?php echo $row[$campo_precio]; ?></span></td>
    <td align="right"><span class="Estilo10"><?php echo number_format($tot_saldo*$row[$campo_precio],2)?></span></td>
    <td>&nbsp;</td>
  </tr>
  
  <?php 
  }
  ?>
  
  
  <tr>
    <td height="20" colspan="2"><span class="Estilo10">&nbsp;</span></td>
    <td ><span class="Estilo11">&nbsp;</span></td>
    <td><span class="Estilo11">&nbsp;</span></td>
    <td><span class="Estilo11">&nbsp;</span></td>
    <td><span class="Estilo11">&nbsp;</span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="20" colspan="5" align="right"><span class="Estilo13">**** Total Parcial **** </span></td>
    <td align="right"><span class="Estilo10"><?php echo number_format($total,2)?></span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="20" colspan="5" align="right"><span class="Estilo13">
	<?php 
	if($total_paginas==$pagina){
			
		$strSQL_tot="select sum($sumsaldos*$campo_precio) as total from producto p ,clasificacion ,categoria ,subcategoria where ".$filtro3." ".$filtro1." ".$filtro_incluir." ";
			
		$resultado_tot=mysql_query($strSQL_tot,$cn)	;
		$row_tot=mysql_fetch_array($resultado_tot);
		
	
	echo "TOTAL GENERAL ";
	
	}?>
	</span></td>
    <td align="right"><span class="Estilo10"><?php echo number_format($row_tot['total'],2)?></span></td>
    <td>&nbsp;</td>
  </tr>

</table>

</div>
<br>
<table width="644" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="284" bgcolor="#F2F2F2"><span class="Estilo19" style="color:#999999"><span class="Estilo33">Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (de <strong><?php echo $total_registros?></strong> productos)</span>.</span></td>
    <td width="10" rowspan="2" bgcolor="#F2F2F2">&nbsp;</td>
    <td width="361" rowspan="2" bgcolor="#F2F2F2"><span class="Estilo10"><?php 
	
		$filtro_cla=$_REQUEST['filtro_cla'];
		$filtro_cat=$_REQUEST['filtro_cat'];
		$filtro_sub=$_REQUEST['filtro_sub'];
		
		$agr_cla=$_REQUEST['agr_cla'];
		$agr_cat=$_REQUEST['agr_cat'];
		$agr_sub=$_REQUEST['agr_sub'];		
		
		$filtro_ordenar=$_REQUEST['ordenar'];
	
			  
			  if(($pagina - 1) > 0) { 
echo "<a href='inventario_excel.php?sucursal=$sucursal&tienda=$tienda&precios=$precios&incluir=$incluir&filtro_cla=$filtro_cla&filtro_cat=$filtro_cat&filtro_sub=$filtro_sub&agr_cla=$agr_cla&agr_cat=$agr_cat&agr_sub=$agr_sub&ordenar=$filtro_ordenar&pagina=".($pagina-1)."'>< Anterior </a> "; 
} 

for ($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
	echo "<b>".$pagina."</b> "; 
	} else { 
	echo "<a href='inventario_excel.php?sucursal=$sucursal&tienda=$tienda&precios=$precios&incluir=$incluir&filtro_cla=$filtro_cla&filtro_cat=$filtro_cat&filtro_sub=$filtro_sub&agr_cla=$agr_cla&agr_cat=$agr_cat&agr_sub=$agr_sub&ordenar=$filtro_ordenar&pagina=$i'>$i</a> "; 
	}
}

if(($pagina + 1)<=$total_paginas) { 
echo " <a href='inventario_excel.php?sucursal=$sucursal&tienda=$tienda&precios=$precios&incluir=$incluir&filtro_cla=$filtro_cla&filtro_cat=$filtro_cat&filtro_sub=$filtro_sub&agr_cla=$agr_cla&agr_cat=$agr_cat&agr_sub=$agr_sub&ordenar=$filtro_ordenar&pagina=".($pagina+1)."'>Siguiente></a>"; 
} 

			  ?></span></td>
  </tr>
  <tr>
    <td align="left" bgcolor="#F2F2F2"><a href="#" onClick="javascript:imprSelec()"><img src="../imgenes/fileprint.png" width="25" height="25" border="0"> <span class="Estilo19">Imprimir Pag.</span> </a></td>
  </tr>
</table>
</body>
</html>


<script language="Javascript">
function imprSelec()
{
  var ficha = document.getElementById('seleccion');
  var ventimp = window.open(' ', 'popimpr');
  ventimp.document.write( ficha.innerHTML );
  ventimp.document.close();
  ventimp.print();
  ventimp.close();
}

 
</script> 

