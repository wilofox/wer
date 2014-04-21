<?php 
//session_start();
include('../conex_inicial.php');
include('../funciones/funciones.php');

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
			

		$registros = 70; 
		$pagina = $_REQUEST["pagina"]; 
		
		if (!$pagina) { 
		$inicio = 0; 
		$pagina = 1; 
		} 
		else { 
		$inicio = ($pagina - 1) * $registros; 
		}


 //$antpag=$pagina;

  //if($pagina>1){
  //$antpag2=$_REQUEST['antpag'];
 
  //}else{
  //$antpag=$pagina;
  //}
  //echo $antpag;


?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<script>
function cerrar(){
//alert();
//window.close();
}

</script>

<body >
<div id="seleccion" style="height:600px; width:850px; overflow:auto" >

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

<table width="837" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" style="border:#999999 solid 1px" >
  <tr>

        <td colspan="5" class="Estilo19" >P&aacute;gina <?php echo $pagina; ?></td>
        <td width="386" align="right" ><span class="Estilo13">Fecha: <?php echo date('d-m-Y');?></span></td>
        <td width="56" align="right" >&nbsp;</td>
  </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center" colspan='4'><span class="Estilo15">Reporte de Inventario F&iacute;sico con Serie </span></td>
        <td align="right"><span class="Estilo13">Hora : <?php echo date('H:i:s',time()-3600)?></span></td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center" valign="top" colspan='4'><span class="Estilo17">Al: <?php echo date('d-m-Y')?></span></td>
        <td colspan='2'>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="6"><span class="Estilo19">Sucursal:
          <?php
		
			$strSQL_suc="select * from sucursal where cod_suc='$sucursal'";
			$resultado_suc=mysql_query($strSQL_suc,$cn);
			$row_suc=mysql_fetch_array($resultado_suc);
			
			echo $row_suc['des_suc'];
		 
		 
		 ?>
              <br>
          Almac&eacute;n:
          <?php 

			$strSQL_suc="select * from tienda where cod_tienda='$tienda'";
			$resultado_suc=mysql_query($strSQL_suc,$cn);
			$row_suc=mysql_fetch_array($resultado_suc);
			
			if($tienda==0){
			echo "Todas las tiendas";
			}else{
			echo $row_suc['des_tienda'];
			}
			
			
?>
        </span></td>
  </tr>
  

<?php 

		
		

		
		$filtro_cla=$_REQUEST['filtro_cla'];
		$filtro_cat=$_REQUEST['filtro_cat'];
		$filtro_sub=$_REQUEST['filtro_sub'];
		
		$agr_cla=$_REQUEST['agr_cla'];
		$agr_cat=$_REQUEST['agr_cat'];
		$agr_sub=$_REQUEST['agr_sub'];		
		$mon=$_REQUEST['mon'];	
	//	echo  $mon;
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
	
	
	if($_REQUEST['valor']!=''){
	$filtro4=" and (nombre like '%$valor%' or idproducto like '%$valor%') ";
	}

 	$strSQL="select ".$filtro2.",idproducto,nombre, p.* from producto p ,clasificacion ,categoria ,subcategoria where ".$filtro3." ".$filtro1." ".$filtro_incluir.$filtro4." and p.series='S' and  p.kardex='S'  group by ".$filtro_ordenar." ";	
			
			//echo $strSQL;
		$resultado = mysql_query($strSQL); 
		$total_registros = mysql_num_rows($resultado); 
		if($_REQUEST['formato']=="excel"){
				$resultado = mysql_query($strSQL); 
		}else{
		$resultado = mysql_query($strSQL." LIMIT $inicio, $registros"); 
			}
		$resultados2 =mysql_num_rows($resultado); 
		$total_paginas = ceil($total_registros / $registros);   
		//echo $strSQL." LIMIT $inicio, $registros";
		list($moneda)=mysql_fetch_array(mysql_query("select simbolo from moneda where id='".$mon."' "));
		?>
		  <tr>
    <td height="19">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td width="45" height="29"><span class="Estilo13">C&oacute;digo</span></td>
    <td width="248"><span class="Estilo13">Nombre de Art&iacute;culo </span></td>
	<td width="36" align="center"><span class="Estilo13">Stock</span></td>
    <td colspan='3' align="center"><table width="100%" border="0">
      <tr>
        <td width="21%" align="center"><span class="Estilo13">Serie </span></td>
        <td width="16%" align="center"><span class="Estilo13">Fecha</span></td>
        <td width="30%" align="center"><span class="Estilo13">Proveedor</span></td>
        <td width="16%" align="center"><span class="Estilo13">D. ing</span></td>
      </tr>
    </table></td>
  </tr>
  <?php
  $totalgeneral=$_REQUEST['totalgeneral'];
		$ax=0;
		//$tot_saldo=1;
		while($row=mysql_fetch_array($resultado)){
		
		//echo "asg";
				 if($tienda==0 || $tienda==""){
					$tot_saldo=0;
					//echo count($saldos);
					for($i=0;$i<count($saldos);$i++){
					//mysql_query("select ")
					$tot_saldo=$tot_saldo+$row[$saldos[$i]];
					}
						
				 }else{
				   $campo="saldo".$tienda;
				   $tot_saldo=$row[$campo];
				   
				 }
								
		if($clas!=$row['des_clas']){
		$clas=$row['des_clas'];
		echo " <tr>
    <td  colspan='4' style='color:#006666 ; font:bold ; font:Arial, Helvetica, sans-serif; font-size:12px'>".$clas."</td>

 
  </tr>
		";
		
		}
		
//$tot_saldo=1;
if($tot_saldo>0){ 	// stop mayor a cero incio

		if($cat!=$row['des_cat']){
		$cat=$row['des_cat'];
		
		echo " <tr>
    <td  colspan='6' style='color:#003399; font:bold; font:Arial, Helvetica, sans-serif; font-size:12px'>&nbsp;&nbsp;".$cat."</td>


  </tr>
		";
		
		}
		
		if($subcat!=$row['des_subcateg']){
		$subcat=$row['des_subcateg'];
		
		echo " <tr>
    <td style='color:#FF0000 ; font:bold ; font:Arial, Helvetica, sans-serif; font-size:12px' colspan='6'>&nbsp;&nbsp;&nbsp;&nbsp;".$subcat."</td>
 

  </tr>
		";
		
		}

?>
  
  <tr >
    <td  valign="top"><span class="Estilo10"><?php echo $row['idproducto'];?></span></td>
    <td width="248" valign="top"><span class="Estilo10"><?php echo substr($row['nombre'],0,68);?></span></td>
	   <td align="center" valign="top"><span class="Estilo10"><?php echo $tot_saldo;?></span></td>
    <td   valign="top" colspan='3'><?php
	$strSQL23="select fing,s.serie,razonsocial,cm.cod_ope,cm.Num_doc from series s 
inner join cab_mov cm on s.ingreso=cm.cod_cab
inner join cliente c on cm.cliente=c.codcliente			
			where producto=".$row['idproducto']." and salida='0' and cm.tienda='".$_REQUEST['tienda']."' order by fing";
		//	echo $strSQL23;
			$resultado23=mysql_query($strSQL23,$cn);
			$x=0;
			echo '<table border="0" width="100%" class="Estilo10" >';
			while($row23=mysql_fetch_array($resultado23)){
			$x++;
	echo '<tr>';
	echo '<td width="21%" align="left">'.$row23['serie'].'</td>
	<td width="18%" align="left">'.formatofecha($row23['fing']).'</td>
    <td width="31%" align="left">'.$row23['razonsocial'].'</td>
	<td width="16%" align="left">'.$row23['cod_ope']."-".$row23['Num_doc'].'</td>';			
			
			 	 echo '</tr>';
			}
			echo '</table>';
			
				/*$strSQL23="select * from series where producto=".$row['idproducto']." and salida='0' order by serie";
			$resultado23=mysql_query($strSQL23,$cn);
			$x=0;
			echo '<table border="0">';
			while($row23=mysql_fetch_array($resultado23)){
			$x++;
			if($x==1) echo '<tr>';
			if($x<=3){
			 echo '<td width="60" align="left">*'.$row23['serie'].'</td>';
			 }
			 if($x==3){
			 	 echo '</tr>';
				 $x=0;			 
			}
			}
			echo '</table>';*/
	?></td>
  </tr>
  
  <?php  } 	// stop mayor a cero fin
 // $ax++ ;
  }
  /*
  $antpag=$_REQUEST['antpag'];
   echo $antpag.">".$pagina;
 if($antpag>$pagina){
  echo "bajar";
   $totalgeneral-=$_REQUEST['anttot'];
  }else{
  echo "subir";
   $totalgeneral+=$total;
  }
 
   //if($antpag!=$pagina){
  $antpag=$pagina;
 // }
echo "-".$antpag;*/
 // $totalgeneral+=$total;
 // $_SESSION['totgr']+=$total;
$query= mysql_query($strSQL="select ".$filtro2.",idproducto,nombre, p.* from producto p ,clasificacion ,categoria ,subcategoria where ".$filtro3." ".$filtro1." ".$filtro_incluir.$filtro4." and p.series='S' and  p.kardex='S'  group by ".$filtro_ordenar." ");
	while($row=mysql_fetch_array($query)){
		
		//echo "asg";
				 if($tienda==0 || $tienda==""){
					$tot_saldo=0;
					//echo count($saldos);
					for($i=0;$i<count($saldos);$i++){
					//mysql_query("select ")
					$tot_general=$tot_general+$row[$saldos[$i]];
					}
						
				 }else{
				   $campo="saldo".$tienda;
				   $tot_general=$row[$campo];
				   
				 }
				 }
  ?>
  
 <?php  if($total_paginas==$pagina || $_REQUEST['formato']=="excel"){?>
  <tr>
    <td height="20"><span class="Estilo10">&nbsp;</span><span class="Estilo11"></span></td>
    <td height="20" align="right"><strong>Total Stock</strong>:</td>
    <td height="20" align="center"><?php echo $tot_general?></td>
    <td height="20">&nbsp;</td>
    <td height="20">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <?php 
  }
  if($_REQUEST['formato']!="excel"){?>
  <?php } ?>

      <?php 
	if($total_paginas==$pagina || $_REQUEST['formato']=="excel"){
	?>
  <?php }?>
</table>
</div>
<br>
<?php
if($_REQUEST['formato']!="excel"){ ?>

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
echo "<a href='inventario_excel2.php?sucursal=$sucursal&tienda=$tienda&precios=$precios&incluir=$incluir&filtro_cla=$filtro_cla&filtro_cat=$filtro_cat&filtro_sub=$filtro_sub&agr_cla=$agr_cla&agr_cat=$agr_cat&agr_sub=$agr_sub&ordenar=$filtro_ordenar&mon=$mon&pagina=".($pagina-1)."'>< Anterior </a> "; 
} 

for ($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
	echo "<b>".$pagina."</b> "; 
	} else { 
	echo "<a href='inventario_excel2.php?sucursal=$sucursal&tienda=$tienda&precios=$precios&incluir=$incluir&filtro_cla=$filtro_cla&filtro_cat=$filtro_cat&filtro_sub=$filtro_sub&agr_cla=$agr_cla&agr_cat=$agr_cat&agr_sub=$agr_sub&ordenar=$filtro_ordenar&mon=$mon&pagina=$i'>$i</a> "; 
	}
}

if(($pagina + 1)<=$total_paginas) { 
echo " <a href='inventario_excel2.php?sucursal=$sucursal&tienda=$tienda&precios=$precios&incluir=$incluir&filtro_cla=$filtro_cla&filtro_cat=$filtro_cat&filtro_sub=$filtro_sub&agr_cla=$agr_cla&agr_cat=$agr_cat&agr_sub=$agr_sub&ordenar=$filtro_ordenar&mon=$mon&pagina=".($pagina+1)."'>Siguiente></a>"; 
} 

			  ?></span></td>
  </tr>
  <tr>
    <td align="left" bgcolor="#F2F2F2"><a href="#" onClick="javascript:imprSelec()"><img src="../imgenes/fileprint.png" width="25" height="25" border="0"> <span class="Estilo19">Imprimir P&aacute;g.</span> </a></td>
  </tr>
</table>
<?php } ?>
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

