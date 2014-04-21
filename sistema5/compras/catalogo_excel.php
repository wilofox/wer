<?php 
//session_start();
include('../conex_inicial.php');

if($_REQUEST['formato']=="excel"){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=excel.xls");
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

//--------------------------------------
		
		$filtro_ordenar=$_REQUEST['ordenar'];
		$columna=$_REQUEST['columna'];
		$agr_cant1=$_REQUEST['agr_cant'];
		$agr_cla=$_REQUEST['agr_cla'];
		$agr_cat=$_REQUEST['agr_cat'];
		$agr_sub=$_REQUEST['agr_sub'];
		$filtro_cla=$_REQUEST['filtro_cla'];
		$filtro_cat=$_REQUEST['filtro_cat'];
		$filtro_sub=$_REQUEST['filtro_sub'];
		
		$precio1=$_REQUEST['precio1'];
		$precio2=$_REQUEST['precio2'];
		$precio3=$_REQUEST['precio3'];
		$precio4=$_REQUEST['precio4'];
		$precio5=$_REQUEST['precio5'];
		$precio6=$_REQUEST['precio6'];
		///---------		
		$stock=$_REQUEST['stock']; //agr_stck
		$almacen=$_REQUEST['almacen'];			
		$moneda=$_REQUEST['moneda'];
		$tp=$_REQUEST['tp'];
		
		$valor=$_REQUEST['valor'];
		$tienda=$_REQUEST['tienda'];
		$sucursal=$_REQUEST['sucursal'];
		
		if($sucursal==0){
		$filtro="";
		$campo_suc='costo_inven1';
		}else{
		$filtro=" where cod_suc='$sucursal' ";
		$campo_suc='costo_inven'.$sucursal;
		}
		
		$strSQL22="select * from tienda ".$filtro." order by cod_tienda";
		$resultado22=mysql_query($strSQL22,$cn);
		while($row22=mysql_fetch_array($resultado22)){
		$saldos[]="saldo".$row22['cod_tienda'];
		}
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

<div id="seleccion" style="height:600px; width:670px; overflow:auto" >


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
<table width="636" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" style="border:#999999 solid 1px" >
  <tr>
    <td colspan="10"><table width="100%" border="0" cellpadding="0" cellspacing="0" >
      <tr>
        <td colspan="8" class="Estilo19" >P&aacute;gina <?php echo $pagina; ?></td>
        <td align="right" colspan='2'><span class="Estilo13">Fecha: <?php echo date('d-m-Y');?></span></td>
      </tr>
      <tr>
        <td width="23">&nbsp;</td>
        <td align="center" colspan='7'><span class="Estilo15">Reporte de Cat&aacute;logo de Productos</span></td>
        <td align="right" colspan="2"><span class="Estilo13">Hora : <?php echo date('H:i:s',time()-3600)?></span></td>
      </tr>
      <tr>
        <td colspan="10" align="center"><span class="Estilo17">Al: <?php echo date('d-m-Y')?></span></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td width="7%" height="29"><span class="Estilo13">
	<? if ($columna==1){ echo 'C&oacute;digo'; }else { echo 'Anexo'; }?>
	</span></td>
    <td width="21%"><span class="Estilo13">Nombre de Art&iacute;culo </span></td>
    <td width="11%"><span class="Estilo13">Uni. </span></td>
    
    <?php if($agr_cant1=='S'){?><td  width="6%"><span class="Estilo13" >Cant.</span></td><?php } ?>
    
    <td width="6%"><span class="Estilo13">Mon.</span></td>
  <?php if($precio1=='true'){ ?>  <td width="8%" align="right" ><span class="Estilo13">Precio1</span></td><?php } ?>
   <?php if($precio2=='true'){ ?>  <td width="8%" align="right" ><span class="Estilo13">Precio2</span></td><?php } ?>
    <?php if($precio3=='true'){ ?> <td width="8%" align="right" ><span class="Estilo13">Precio3</span></td><?php } ?>
    <?php if($precio4=='true'){ ?> <td width="8%" align="right" ><span class="Estilo13">Precio4</span></td><?php } ?>
    <?php if($precio5=='true'){ ?> <td width="8%" align="right" ><span class="Estilo13">Precio5</span></td><?php } ?>
    <?php if($precio6=='true'){ ?> <td width="9%" align="right" ><span class="Estilo13">Prec.Ref.</span></td><?php } ?>
  </tr>
  <?php 

		
	if($moneda=='01'){
	 	$SqlMonRk=",REPLACE( moneda, '02', '01' ) as monedaSD";
	}elseif($moneda=='02'){
	 	$SqlMonRk=",REPLACE( moneda, '01', '02' ) as monedaSD";	
	}else{
	 	$SqlMonRk="";	
	}
	
	//Consulta 
	if($_REQUEST['valor']!=""){
	$valor=$_REQUEST['valor'];
	$criterio=$_REQUEST['criterio'];
	$filtro=" and  $criterio like'%$valor%' ";
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
	
/*if($stock == 'true'){ 
$fil01= ' and saldo101 +saldo102 +saldo103 + saldo201 + saldo202  +saldo301  +saldo302 + saldo401 + saldo402  +saldo501  +saldo502 + saldo601 + saldo602 + saldo701 + saldo702  +saldo801  +saldo802 + saldo901  +saldo902 >0 ';  	
	}
if(!empty($almacen)){ 
	   if($almacen==103)
	   $fil02= ' and saldo103 > 0 ';
	   
	   if($almacen==104)
	   $fil02= ' and saldo104 > 0 ';
	   
	   if($almacen==201)
	   $fil02= ' and saldo201 > 0 ';
	   
	   if($almacen==101)
	   $fil02= ' and saldo101 > 0 ';
	   
	   if($almacen==102)
	   $fil02= ' and saldo102 > 0 ';
}*/
///---------------------------------------------------------------------------
if($stock == 'true'){	
	//if($stock=="S") {$mstck=" > 0 ";}else{ $mstck=" >= 0 ";}
	$mstck=" > 0 ";
	if($almacen=="0"){
			$strSQL22="select * from tienda  order by cod_tienda";
			$resultado22=mysql_query($strSQL22,$cn);
			while($row22=mysql_fetch_array($resultado22)){
			 $saldos[]="saldo".$row22['cod_tienda'];
			}						
				$fil02=" and ( ";
				for($i=0;$i<count($saldos);$i++){
				$fil02=$fil02." + ".$saldos[$i];
				}
				$fil02.=" ) ".$mstck;
	}else{
		$fil02=" and saldo$almacen ".$mstck;
	}
}
///---------------------------------------------------------------------------	
if ($agr_cla=='S'){
	$filtro_gruop1='clasificacion,';
}
if ($agr_cat=='S'){
	$filtro_gruop2='categoria,';
}
if ($agr_sub=='S'){
	$filtro_gruop3='subcategoria,';
}
$filtro_gruop=$filtro_gruop1.''.$filtro_gruop2.''.$filtro_gruop3;
$filtro_ordenar=$filtro_gruop.''.$filtro_ordenar;

///---------------------------------------------------------------------------	
	//echo $filtro3;
	//$SqlConWerRK="and  nombre like '%$valor%' or idproducto like '%$valor%' ";
	$SqlConWerRK=  " $filtro $filtro3   $fil01 $fil02" ;
	//echo $SqlConWerRK;
$resultados = mysql_query("select * $SqlMonRk from producto where  kardex<>'' and concepto!='S' $SqlConWerRK order by nombre" ,$cn);
$total_registros = mysql_num_rows($resultados); 

if($_REQUEST['formato']!="excel"){
	$limite="LIMIT $inicio, $registros ";
}			
 	$strSQL="select * $SqlMonRk from producto where kardex<>'' and concepto!='S' $SqlConWerRK 
 order by $filtro_ordenar $limite ";
 
/* $strSQL2="select * from producto where kardex<>'' and concepto!='S' $SqlConWerRK 
 group by $filtro_gruop subcategoria 
 order by $filtro_ordenar LIMIT $inicio, $registros";*/
 				  
	//echo $agr_sub;
	//echo $strSQL;
						
			$j=0;
			$resultado=mysql_query($strSQL,$cn);

	$resultados2 =mysql_num_rows($resultado); 
	$total_paginas = ceil($total_registros / $registros); 


			
			while($row=mysql_fetch_array($resultado)){
				
				 if($almacen==0 || $almacen==""){
					$tot_saldo=0;
					for($i=0;$i<count($saldos);$i++)
						$tot_saldo=$tot_saldo+$row[$saldos[$i]];
				 }else{
				   $campo="saldo".$almacen;
				   $tot_saldo=$row[$campo];				   
				 }				 
?>

<?
//--------------------------------------------------------------------------
//$cat='048';
if($clas!=$row['clasificacion'] && $agr_cla=='S'){
	$clas=$row['clasificacion'];
	
	$strSQLD="select * from clasificacion where idclasificacion='".$clas."' ";
	$resultadoD=mysql_query($strSQLD,$cn);
	$rowD=mysql_fetch_array($resultadoD);
	$clasT= $rowD['des_clas'];
	
		echo "
		<tr>
   <td width='7%'  colspan='2' height='29' style='color:#006666 ;' class='Estilo10'><strong>".$clasT."</strong></td>
    <td width='11%'>&nbsp;</td>
";  if($agr_cant1=='S'){ echo "<td  width='6%'>&nbsp;</td>"; } echo "
	<td width='6%'>&nbsp;</td>
"; if($precio1=='true'){ echo "  <td width='8%' align='right' >&nbsp;</td>"; } echo "
"; if($precio2=='true'){ echo " <td width='8%' align='right' >&nbsp;</td>"; } echo "
"; if($precio3=='true'){ echo " <td width='8%' align='right' >&nbsp;</td>"; } echo "
"; if($precio4=='true'){ echo " <td width='8%' align='right' >&nbsp;</td>"; } echo "
"; if($precio5=='true'){ echo " <td width='8%' align='right' >&nbsp;</td>"; } echo "
"; if($precio6=='true'){ echo " <td width='9%' align='right' >&nbsp;</td>"; } echo "
 </tr>
		";		
}
//--------------------------------------------------------------------------
//$cat='048';
if($cat!=$row['categoria'] && $agr_cat=='S'){
	$cat=$row['categoria'];
	$subcat='';
	$strSQLD="select * from categoria where idCategoria='".$cat."' ";
	$resultadoD=mysql_query($strSQLD,$cn);
	$rowD=mysql_fetch_array($resultadoD);
	$catT= $rowD['des_cat'];
	
		echo "
		<tr>
   <td width='7%' colspan='2' height='29' style='color:#003399; ' class='Estilo10'>&nbsp;&nbsp;<strong>".$catT."</strong></td>
    <td width='11%'>&nbsp;</td>
";  if($agr_cant1=='S'){ echo "<td  width='6%'>&nbsp;</td>"; } echo "
	<td width='6%'>&nbsp;</td>
"; if($precio1=='true'){ echo "  <td width='8%' align='right' >&nbsp;</td>"; } echo "
"; if($precio2=='true'){ echo " <td width='8%' align='right' >&nbsp;</td>"; } echo "
"; if($precio3=='true'){ echo " <td width='8%' align='right' >&nbsp;</td>"; } echo "
"; if($precio4=='true'){ echo " <td width='8%' align='right' >&nbsp;</td>"; } echo "
"; if($precio5=='true'){ echo " <td width='8%' align='right' >&nbsp;</td>"; } echo "
"; if($precio6=='true'){ echo " <td width='9%' align='right' >&nbsp;</td>"; } echo "
 </tr>
		";		
}
//--------------------------------------------------------------------------
//$subcat='048';
if($subcat!=$row['subcategoria'] && $agr_sub=='S' ){
	$subcat=$row['subcategoria'];
	
	$strSQLD="select * from subcategoria where idsubcategoria='".$subcat."' ";
	$resultadoD=mysql_query($strSQLD,$cn);
	$rowD=mysql_fetch_array($resultadoD);
	$subcatT= $rowD['des_subcateg'];

		echo "
		<tr>
   <td width='7%' colspan='2' height='29' style='color:#FF0000' class='Estilo10'>&nbsp;&nbsp;&nbsp;&nbsp;<strong>".$subcatT."</strong></td>

    <td width='11%'>&nbsp;</td>
";  if($agr_cant1=='S'){ echo "<td  width='6%'>&nbsp;</td>"; } echo "
	<td width='6%'>&nbsp;</td>
"; if($precio1=='true'){ echo "  <td width='8%' align='right' >&nbsp;</td>"; } echo "
"; if($precio2=='true'){ echo " <td width='8%' align='right' >&nbsp;</td>"; } echo "
"; if($precio3=='true'){ echo " <td width='8%' align='right' >&nbsp;</td>"; } echo "
"; if($precio4=='true'){ echo " <td width='8%' align='right' >&nbsp;</td>"; } echo "
"; if($precio5=='true'){ echo " <td width='8%' align='right' >&nbsp;</td>"; } echo "
"; if($precio6=='true'){ echo " <td width='9%' align='right' >&nbsp;</td>"; } echo "
 </tr>
		";		
}



?> 
  <tr>
    <td valign="top"><span class="Estilo10">'<? if ($columna==1){ echo $row['idproducto']; }else { echo $row['cod_prod']; }?></span></td>
    <td><span class="Estilo10"><!--<?=$row['clasificacion'].'//'.$row['categoria'].'//'.$row['subcategoria'];?>--> <?php echo $row['nombre'];?></span></td>
    <td align="center" ><span class="Estilo10">
      <?php 
			  
			$strSQL23="select * from unidades where id='".$row['und']."' ";
			$resultado23=mysql_query($strSQL23,$cn);
			$row23=mysql_fetch_array($resultado23);
			echo $row23['nombre'];
			  
			   ?>
    </span></td>
    <?php if($agr_cant1=='S'){?><td ><span class='Estilo10' ><?php  echo $tot_saldo ?></span></td><?php }?>
    <td align="center"><span class="Estilo10">
      <?  
			  if($moneda==''){
			  if ($row['moneda']=='02'){echo 'US$.';}else{echo 'S/.';}
			  }else{
			  if ($row['monedaSD']=='02'){echo 'US$.';}else{echo 'S/.';}
			  }
			   ?>
    </span></td>
   <?php if($precio1=='true'){?> <td align="right" ><span class="Estilo10">
      <?php 
			  if ($row['moneda']==$moneda ||  $moneda == ''){
					echo  number_format($row['precio'],4);	
			  }else{
				   if ($row['moneda']=='02'){
					echo  number_format($row['precio'] * $tp,4);					
					}
			 		if ($row['moneda']=='01'){
					echo  number_format($row['precio'] / $tp,4);	
					}				
			  }?>
    </span></td><?php } ?>
	
	<?php if($precio2=='true'){?>
    <td align="right" ><span class="Estilo10">
      <?php 
			  if ($row['moneda']==$moneda ||  $moneda == ''){
					echo  number_format($row['precio2'],4);	
			  }else{
				   if ($row['moneda']=='02'){
					echo  number_format($row['precio2'] * $tp,4);					
					}
			 		if ($row['moneda']=='01'){
					echo  number_format($row['precio2'] / $tp,4);	
					}				
			  }?>
    </span></td><?php } ?>
    <?php if($precio3=='true'){?>
	<td align="right" ><span class="Estilo10">
      <?php 
			  if ($row['moneda']==$moneda ||  $moneda == ''){
					echo  number_format($row['precio3'],4);	
			  }else{
				   if ($row['moneda']=='02'){
					echo  number_format($row['precio3'] * $tp,4);					
					}
			 		if ($row['moneda']=='01'){
					echo  number_format($row['precio3'] / $tp,4);	
					}				
			  }?>
    </span></td><?php } ?>
	<?php if($precio4=='true'){?>
    <td align="right" style="display:<?php if($precio4=='false'){echo "none";}?>"><span class="Estilo10">
      <?php 
			  if ($row['moneda']==$moneda ||  $moneda == ''){
					echo  number_format($row['precio4'],4);	
			  }else{
				   if ($row['moneda']=='02'){
					echo  number_format($row['precio4'] * $tp,4);					
					}
			 		if ($row['moneda']=='01'){
					echo  number_format($row['precio4'] / $tp,4);	
					}				
			  }?>
    </span></td><?php } ?>
	<?php if($precio5=='true'){?>
    <td align="right" style="display:<?php if($precio5=='false'){echo "none";}?>"><span class="Estilo10">
      <?php 
			  if ($row['moneda']==$moneda ||  $moneda == ''){
					echo  number_format($row['precio5'],4);	
			  }else{
				   if ($row['moneda']=='02'){
					echo  number_format($row['precio5'] * $tp,4);					
					}
			 		if ($row['moneda']=='01'){
					echo  number_format($row['precio5'] / $tp,4);	
					}				
			  }?>
    </span></td><?php } ?>
	<?php if($precio6=='true'){?>
    <td align="right" style="display:<?php if($precio6=='false'){echo "none";}?>"><span class="Estilo10">
      <?php 
			  if ($row['moneda']==$moneda ||  $moneda == ''){
					echo  number_format($row['pre_ref'],4);	
			  }else{
				   if ($row['moneda']=='02'){
					echo  number_format($row['pre_ref'] * $tp,4);					
					}
			 		if ($row['moneda']=='01'){
					echo  number_format($row['pre_ref'] / $tp,4);	
					}				
			  }?>
    </span></td><?php } ?>
  </tr>
  <?php 
  }
  ?>
</table>
</div>
<?php

if($_REQUEST['formato']!="excel"){?>
<br>
<table width="644" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="284" bgcolor="#F2F2F2"><span class="Estilo19" style="color:#999999"><span class="Estilo33">Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (de <strong><?php echo $total_registros?></strong> productos)</span>.</span></td>
    <td width="10" rowspan="2" bgcolor="#F2F2F2">&nbsp;</td>
    <td width="361" rowspan="2" bgcolor="#F2F2F2"><span class="Estilo10"><?php 
			  
			  if(($pagina - 1) > 0) { 


/*


catalogo_excel.php?agr_cla="+agr_cla+"&agr_cat="+agr_cat+"&agr_sub="+agr_sub+"&agr_stck="+agr_stck+"&agr_cant="+agr_cant+"&valor="+valor+"&criterio="+criterio+"&clasificacion="+clasificacion+"&categoria="+categoria+"&subcategoria="+subcategoria+"&moneda="+moneda+"&tp="+tp+"&stock="+stock+"&almacen="+almacen+"&precio1="+precio1+"&precio2="+precio2+"&precio3="+precio3+"&precio4="+precio4+"&precio5="+precio5+"&precio6="+precio6+"&ordenar="+ordenar+"&columna="+columna

catalogo_excel.php?agr_cla=$agr_cla&agr_cat=$agr_cat&agr_sub=$agr_sub&agr_stck=$stock&agr_cant=$agr_cant1&valor=$valor&criterio=$criterio&clasificacion=$clasificacion&categoria=$categoria&subcategoria=$subcategoria&moneda=$moneda&tp=$tp&stock=$stock&almacen=$almacen&pagina=$i&precio1=$precio1&precio2=$precio2&precio3=$precio3&precio4=$precio4&precio5=$precio5&precio6=$precio6&ordenar=$ordenar&columna=$columna&ordenar=$filtro_ordenar&formato=vista&filtro_cla=$filtro_cla&filtro_cat=$filtro_cat&filtro_sub=$filtro_sub



*/
echo "<a href='catalogo_excel.php?agr_cla=$agr_cla&agr_cat=$agr_cat&agr_sub=$agr_sub&agr_stck=$stock&agr_cant=$agr_cant1&valor=$valor&criterio=$criterio&clasificacion=$clasificacion&categoria=$categoria&subcategoria=$subcategoria&moneda=$moneda&tp=$tp&stock=$stock&almacen=$almacen&pagina=".($pagina-1)."&precio1=$precio1&precio2=$precio2&precio3=$precio3&precio4=$precio4&precio5=$precio5&precio6=$precio6&ordenar=$ordenar&columna=$columna&ordenar=$filtro_ordenar&formato=vista&filtro_cla=$filtro_cla&filtro_cat=$filtro_cat&filtro_sub=$filtro_sub'>< Anterior </a> "; 
} 

for ($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
	echo "<b>".$pagina."</b> "; 
	} else { 
	echo "<a href='catalogo_excel.php?agr_cla=$agr_cla&agr_cat=$agr_cat&agr_sub=$agr_sub&agr_stck=$stock&agr_cant=$agr_cant1&valor=$valor&criterio=$criterio&clasificacion=$clasificacion&categoria=$categoria&subcategoria=$subcategoria&moneda=$moneda&tp=$tp&stock=$stock&almacen=$almacen&pagina=$i&precio1=$precio1&precio2=$precio2&precio3=$precio3&precio4=$precio4&precio5=$precio5&precio6=$precio6&ordenar=$ordenar&columna=$columna&ordenar=$filtro_ordenar&formato=vista&filtro_cla=$filtro_cla&filtro_cat=$filtro_cat&filtro_sub=$filtro_sub'>$i</a> "; 
	}
}

if(($pagina + 1)<=$total_paginas) { 
echo " <a href='catalogo_excel.php?agr_cla=$agr_cla&agr_cat=$agr_cat&agr_sub=$agr_sub&agr_stck=$stock&agr_cant=$agr_cant1&valor=$valor&criterio=$criterio&clasificacion=$clasificacion&categoria=$categoria&subcategoria=$subcategoria&moneda=$moneda&tp=$tp&stock=$stock&almacen=$almacen&pagina=".($pagina+1)."&precio1=$precio1&precio2=$precio2&precio3=$precio3&precio4=$precio4&precio5=$precio5&precio6=$precio6&ordenar=$ordenar&columna=$columna&ordenar=$filtro_ordenar&formato=vista&filtro_cla=$filtro_cla&filtro_cat=$filtro_cat&filtro_sub=$filtro_sub'>Siguiente></a>"; 
} 

			  ?></span></td>
  </tr>
  <tr>
    <td align="left" bgcolor="#F2F2F2"><a href="#" onClick="javascript:imprSelec()"><img src="../imgenes/fileprint.png" width="25" height="25" border="0"> <span class="Estilo19">Imprimir Pag.</span> </a></td>
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

