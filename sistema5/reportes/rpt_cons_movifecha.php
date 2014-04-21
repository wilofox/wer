<?php 
session_start();
?>
<?php 
include('../conex_inicial.php');
include('../funciones/funciones.php');
//PAGINACION 1	
		 $registros = 30; 
		 $pagina = $_REQUEST['pagina']; 
			   
		//echo $pagina;

		if ($pagina=='') { 
		$inicio = 0; 
		$pagina = 1; 
		} 
		else { 
		$inicio = ($pagina - 1) * $registros; 
		} 
//------------------------------------------

if($_REQUEST['excel']=="S"){
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=excel.xls");
}


?>
<?php
//declarando variables
$formato=$_GET['cmbformato'];
$presentacion=$_GET['cmbPres'];
$ordenar=$_GET['cmbordenar'];
$valorizar=$_GET['cmbValor'];
$fecha1=formatofecha($_GET['fecha1']);
$fecha2=formatofecha($_GET['fecha2']);
$chk_tiendas=$_GET['chk_tiendas'];	
$chkIngresos=$_GET['chkIngresos'];
$chkSalidas=$_GET['chkSalidas'];
$radiobutton=$_GET['radiobutton'];

$doc_i=explode("|",$chkIngresos);
$doc_s=explode("|",$chkSalidas);
$filtrodocs="";
$j=0;
for($i=0;$i<count($doc_i);$i++){
	if($doc_i[$i]!=""){
		if($j==0){
			$filtrodocs=$doc_i[$i];
		}else{
			$filtrodocs=$filtrodocs."','".$doc_i[$i];
		}
		$j++;
	}
}
$j=0;
for($i=0;$i<count($doc_s);$i++){
	if($doc_s[$i]!=""){
		if($j==0 && $filtrodocs==""){
			$filtrodocs=$doc_s[$i];
		}else{
			$filtrodocs=$filtrodocs."','".$doc_s[$i];
		}
		$j++;
	}
}
//echo $filtrodocs;
//$tienda=$_GET['tienda'];


/*	$mov=$_GET['cmbmov'];  
	$cmbclasificacion=$_GET['cboclasifica'];
	$cmbcategoria=$_GET['cbocateg'];
	$cmbsub_categoria=$_GET['cbosubcateg'];
	$chkAgruparClas=$_GET['chkAgruparClas'];
	$chkAgruparCat=$_GET['chkAgruparCat'];
	$chkAgruparSub=$_GET['chkAgruparSub'];
	$sucursal=$_GET['sucursal'];

	$agr_cla=$_GET['agr_cla'];
	$agr_cat=$_GET['agr_cat'];
	$agr_sub=$_GET['agr_sub'];
*/
	$agr_cla=$_REQUEST['agr_cla'];
	$agr_cat=$_REQUEST['agr_cat']; 
	$agr_sub=$_REQUEST['agr_sub']; 
	$mov=$_REQUEST['cmbmov'];
	$sucursal=$_REQUEST['sucursal'];
	
	$cmbclasificacion=$_REQUEST['cboclasifica'];
	$cmbcategoria=$_REQUEST['cbocateg'];
	$cmbsub_categoria=$_REQUEST['cbosubcateg'];
	$chkAgruparClas=$_REQUEST['chkAgruparClas'];
	$chkAgruparCat=$_REQUEST['chkAgruparCat'];
	$chkAgruparSub=$_REQUEST['chkAgruparSub'];

?>
<html>

<link href="css/webuserestilo.css" rel="stylesheet" type="text/css">
<!-- -->
<link href="../styles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />


<style type="text/css">

<!--
.Estilo16 {color: #FFFFFF; font-weight: bold; font-size: 11px; font-family: Arial, Helvetica, sans-serif; }
.Estilo27 {color: #000000}
.Estilo28 {color: #000000; font-weight: bold; font-size: 11px; font-family: Arial, Helvetica, sans-serif; }
.Estilo30 {color: #000000; font-weight: bold; }
.Estilo31 {color: #FFFFFF}
-->
</style>
<body>
    <form id="form1" name="form1" method="post" action="" >
<input type="hidden"  id="formato" value="<?=$formato;?>">
<input type="hidden"  id="cmbPres" value="<?=$presentacion;?>">
<input type="hidden"  id="cmbordenar" value="<?=$ordenar;?>">
<input type="hidden"  id="cmbValor" value="<?=$valorizar;?>">
<input type="hidden"  id="fecha1" value="<?=formatofecha($fecha1);?>">
<input type="hidden"  id="fecha2" value="<?=formatofecha($fecha2);?>">
<input type="hidden"  id="chk_tiendas" value="<?=$chk_tiendas;?>">
<input type="hidden"  id="chkIngresos" value="<?=$chkIngresos;?>">
<input type="hidden"  id="chkSalidas" value="<?=$chkSalidas;?>">
<input type="hidden"  id="radiobutton" value="<?=$radiobutton;?>">
<input type="hidden"  id="cmbmov" value="<?=$mov;?>">

<input type="hidden"  id="sucursal" value="<?=$sucursal;?>">
<input type="hidden"  id="cboclasifica" value="<?=$cmbclasificacion;?>">
<input type="hidden"  id="cbocateg" value="<?=$cmbcategoria;?>">
<input type="hidden"  id="cbosubcateg" value="<?=$cmbsub_categoria;?>">
<input type="hidden"  id="chkAgruparClas" value="<?=$chkAgruparClas;?>">
<input type="hidden"  id="chkAgruparCat" value="<?=$chkAgruparCat;?>">
<input type="hidden"  id="chkAgruparSub" value="<?=$chkAgruparSub;?>">
<input type="hidden"  id="agr_cla" value="<?=$agr_cla;?>">
<input type="hidden"  id="agr_cat" value="<?=$agr_cat;?>">
<input type="hidden"  id="agr_sub" value="<?=$agr_sub;?>">
<table border="0" width="666" align="center" cellpadding="0" cellspacing="0">
  <tr width="50px">
  <td align="left">&nbsp;</td>
  <!--<table width="120px" border="0" cellspacing="0" cellpadding="0">-->
      <!--<tr>
        <td width="41" align="right" valign="top">-->
    <td colspan="7" align="right"><span class="Estilo27">Fecha</span>:</td>
        <td width="82"><?php echo date('d-m-Y')?></td>
  </tr>
  <tr width="70px">
  		<td align="left">&nbsp;</td>
        <td colspan="7" align="right"><span class="Estilo27">Hora:</span></td>
        <td><?php echo date('H:i:s A')?></td>
      <!--</tr>
    </table></td>-->
  </tr>
  
  <tr>
  	<td width="7" align="left">&nbsp;</td>
    <td colspan="7" align="left">&nbsp;</td>
  </tr>
  <tr>
  	<td align="left">&nbsp;</td>
    <td colspan="7" align="center"><p class="Estilo4"><span class="Estilo30">MOVIMIENTO DE PRODUCTOS POR FECHAS </span></p></td>
  </tr>
  <tr width="269">
  	<td align="left">&nbsp;</td>
    <td colspan="7" align="center"><span class="Estilo27">
          <?php if($formato=='D'){
	echo"Detallado";
	}else{
	echo "Consolidado";
	} ?></span></td>
  </tr>
  <tr width="269">
  	<td align="left">&nbsp;</td>
  	<td width="55" align="right">&nbsp;</td>
  	<td width="171" align="right"><span class="Estilo27">De:</span></td>
    <td width="87"><?php echo formatofecha($fecha1);?></td>
    <td width="22" align="right"><span class="Estilo27">Al:</span></td>
    <td width="162"><?php echo formatofecha($fecha2);?></td>
    <td colspan="2">&nbsp;</td>
    <!--</tr>
    </table></td>-->
  </tr>
  <tr>
  	<td align="left">&nbsp;</td>
    <td colspan="7" align="left">&nbsp;</td>
  </tr>
  <tr>
  	<td align="left">&nbsp;</td>
    <td colspan="4" align="left"><span class="Estilo27"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sucursal:<span class="Estilo4"><?php 	
	$sucursales=mysql_fetch_array(mysql_query("Select * from sucursal where cod_suc='$sucursal'"    ));
	echo $sucursales['des_suc'] ?></span></span></td>
    <td colspan="3" align="right"><span class="Estilo27">Formato:  
      <?php 
	  if($presentacion=='F'){
	  echo "Fisico";
	  }else{
	  	if($valorizar=='Soles'){
	  	$val="Soles(S/.)";
	  	}else{
	  	$val="Dolares(U$/.)";
	  	}
	  echo "Valorizado en.$val";
	  }
	  ?>
      &nbsp;&nbsp;&nbsp;&nbsp;</span></td>
  </tr>
  <tr>
  	<td align="left">&nbsp;</td>
    <td colspan="7" align="left"><span class="Estilo27">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tiendas&nbsp; <?php 
//	echo "SELECT * FROM tienda WHERE cod_suc ='$sucursal' AND  cod_tienda in(".$filtro1.")";
$filtroTiendas="''";
//--rk
$chk_tiendas=explode("|",$chk_tiendas);
for($i=0;$i<count($chk_tiendas);$i++){
//echo $chk_tiendas[$i];
$filtroTiendas=$filtroTiendas.",'".$chk_tiendas[$i]."'";
}
//--fin rk
/* $chk_tiendas=$_REQUEST['chkTiendas'];
	//echo count($chk_tiendas);
	for($i=0;$i<count($chk_tiendas);$i++){
		$filtroTiendas=$filtroTiendas.",'".$chk_tiendas[$i]."'";
	}*/
$resultado=mysql_query("SELECT * FROM tienda WHERE cod_suc ='$sucursal' AND  cod_tienda in(". $filtroTiendas.")",$cn);
//echo  mysql_num_rows($resultado);

       while($tiendas=mysql_fetch_array($resultado)){
	
	 echo "".$tiendas['cod_tienda']. "-".$tiendas['des_tienda']." <|> " ;
	}
	?></span></td>
    </tr>
  <tr>
  	<td align="left">&nbsp;</td>
    <td colspan="7" align="left">&nbsp;</td>
  </tr>
  	<tr>
		<td align="left">&nbsp;</td>
		<td colspan="6" height="18" bgcolor="#006699" class="Estilo28 Estilo31">
	  <!--
	<table width="721" border="0" cellpadding="0" cellspacing="2" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <tr>
       <td height="18" colspan="2" bgcolor="#006699" class="Estilo28 Estilo31">--> Producto</td>
       <?php if($mov=="A"){ 
	   $col="colspan='2'";
	   }else{
		$col="";
	   }?>
		<td <?php echo $col;?> bgcolor="#006699" class="Estilo16">Movimientos</td>
		<?php
		if($presentacion=='V'){
		echo" <td colspan='2' bgcolor='#006699' class='Estilo28 Estilo31'>Valorizado</td>";
		}
		?>
	</tr>
	<tr>
    	<td align="left">&nbsp;</td>
		<td width="55" height="18" bgcolor="#F0B442" class="Estilo16"><span class="Estilo8 Estilo27">Codigo</span></td>
        <td colspan="5" align="left" bgcolor="#F0B442" class="Estilo16"><span class="Estilo8 Estilo27">Nombre de Producto</span> </td>
		<?php if($mov=="I" || $mov=="A"){ ?>
		<td width="74" bgcolor="#F0B442" class="Estilo16"><span class="Estilo8 Estilo27">Ingresos</span></td>
		<?php }
		if($mov=="S" || $mov=="A"){?>
		<td width="82" bgcolor="#F0B442" class="Estilo16"><span class="Estilo8 Estilo27">Salida</span></td>
        <td width="5">&nbsp;</td>
		<?php }
		if($presentacion=='V'){
			if($formato=='C'){
				echo " <td width='109' bgcolor='#FFFFFF' class='Estilo16'><span class='Estilo8 Estilo27'>Ingresos</span></td>";
				echo " <td width='109' bgcolor='#FFFFFF' class='Estilo16'><span class='Estilo8 Estilo27'>Salidas</span></td>";
			}
		}
		?>
	</tr>
	<?php //realizando consulta

	//
	$cod_doc_i=$_REQUEST['chkIngresos'];
    $cod_doc_s=$_REQUEST['chkSalidas'];
	//ORDENAR
	
	if($ordenar=='1'){
	$filtro_ordenar='idproducto';
	}elseif($ordenar=='2'){
	$filtro_ordenar='cod_prod';
	}elseif($ordenar=='3'){
	$filtro_ordenar='nombre';
	}
	//MOVIMIENTO
	if($mov!="-1"){
		if($mov=="I"){
		$filtroMov="1";
		}
		if($mov=="S"){
		$filtroMov="2";
		}
		if($mov=="A"){
		$filtroMov="'1','2'";
		}
	}
	//echo $filtroMov;
		
	//DOCUMENTOS
	
//	implode

//if ($filtroMov=="1"){////////////////////////////Inicio
//$filtrodocs="''";
//echo count($cod_doc_i);
//--rk
//$cod_doc_i=explode("|",$chkIngresos);
//for($i=0;$i<count($cod_doc_i);$i++){
////echo $cod_doc_i[$i];
//  $filtrodocs=$filtrodocs.",'".$cod_doc_i[$i]."'";
//}
////--fin rk
///*	for($i=0;$i<count($cod_doc_i);$i++){
//	$filtrodocs=$filtrodocs.",'".$cod_doc_i[$i]."'";	
//	}*/
//	//echo $filtrodocs;
//}elseif($filtroMov=="2"){
//	$filtrodocs="''";
//	//	echo count($cod_doc_s);
//		//--rk
//$cod_doc_s=explode("|",$chkSalidas);
//for($i=0;$i<count($cod_doc_s);$i++){
////echo $cod_doc_s[$i];
//$filtrodocs=$filtrodocs.",'".$cod_doc_s[$i]."'";
//}
////--fin rk
//			/*for($i=0;$i<count($cod_doc_s);$i++){
//			$filtrodocs=$filtrodocs.",'".$cod_doc_s[$i]."'";
//			}*/
//			//echo $filtrodocs;
//		}elseif($filtroMov=="'1','2'"){
//			  $filtrodocs="''";
//			  $union=array_merge($cod_doc_i,$cod_doc_s);
//              for($i=0;$i<count($union);$i++){
//			  $filtrodocs=$filtrodocs.",'".$union[$i]."'";
//			  }	
//			$filtrodocs=str_replace("|","','",$filtrodocs);
//		}////////////fin

	if($cmbclasificacion!="-1" || $cmbcategoria!="-1" || $cmbsub_categoria!="-1"){
		if($cmbclasificacion!="-1"){
	    $filtro1=" and p.clasificacion='$cmbclasificacion' ";
		}
		if($cmbcategoria!="-1"){
		$filtro1=$filtro1. " and p.categoria='$cmbcategoria' ";
		}
		if($cmbsub_categoria!="-1"){
		$filtro1=$filtro1. " and p.subcategoria='$cmbsub_categoria' ";
		}

	}
	//echo $agr_cla." - ".$agr_cat." - ".$agr_sub;
	if($agr_cla!='N' || $agr_cat!='N' || $agr_sub!='N'){
	
		if($agr_cla=='S' and $agr_cat=='S' and $agr_sub=='S'){
		$clas="999";
		$cat="999";
		$subcat="999";
		$filtro2=" des_clas,des_cat,des_subcateg, ";
		$filtro3=" p.clasificacion=idclasificacion and p.categoria=idcategoria and        
		p.subcategoria=idsubcategoria  ";
		}else{
			if($agr_cla=='S' and $agr_cat=='S'){
			$clas="999";
			$cat="999";
			$subcat="";
			$filtro2=" des_clas,des_cat, ";
			$filtro3="  p.clasificacion=idclasificacion and p.categoria=idcategoria and p.subcategoria=idsubcategoria  and p.subcategoria!='000'  ";
			}else{
				if($agr_cla=='S' and $agr_sub=='S'){
				$clas="999";
				$cat="";
				$subcat="999";
				$filtro2=" des_clas,des_subcateg, ";
				$filtro3=" p.categoria!='000' p.clasificacion=idclasificacion and p.categoria=idcategoria and  p.subcategoria=idsubcategoria  ";
				}else{
					if($agr_cat=='S' and $agr_sub=='S'){
					$clas="";
					$cat="999";
					$subcat="999";
					$filtro2=" des_cat,des_subcateg, ";
					$filtro3=" p.clasificacion!='000' and p.clasificacion=idclasificacion and p.categoria=idcategoria and p.subcategoria=idsubcategoria ";
					}else{
						if($agr_cla=='S'){
						$clas="999";
						$cat="";
						$subcat="";
						$filtro2=" des_clas, ";
						$filtro3="   p.clasificacion=idclasificacion and p.categoria=idcategoria and p.subcategoria=idsubcategoria and p.categoria!='000' and p.subcategoria!='000'  ";
						}else{
							if($agr_cat=='S'){
							$clas="";
							$cat="999";
							$subcat="";
							$filtro2=" des_cat, ";
							$filtro3=" p.clasificacion!='000' and  p.clasificacion=idclasificacion and p.categoria=idcategoria and p.subcategoria=idsubcategoria and p.subcategoria!='000'";
							}else{
								if($agr_sub=='S'){
								$clas="";
								$cat="";
								$subcat="999";
								$filtro2=" des_subcateg, ";
								$filtro3=" p.clasificacion!='000' and p.categoria!='000' and p.clasificacion=idclasificacion and p.categoria=idcategoria and p.subcategoria=idsubcategoria   ";
								}else{
									$clas="";
									$cat="";
									$subcat="";
									$filtro2="  ";
									$filtro3=" p.clasificacion!='000' and p.categoria!='000' and                                    p.subcategoria!='000'  ";
									
									}
		                        }
		                   }
		              }
		         }
		    }
		}
	}else{
	$filtro2=" ";
	$filtro3=' p.clasificacion=idclasificacion and p.categoria=idcategoria and 
	p.subcategoria=idsubcategoria   ';
	}
	
	//	".$filtro2.",dt.cod_prod, nombre ".$filtrotipo."".$filtrocosto."".$conversion."
    $strSQL="select ".$filtro2." dt.tipo,dt.cod_ope,dt.sucursal,dt.tienda,dt.fechad,sum(dt.cantidad) as cantidad, sum(if(dt.flag_kardex='1',dt.cantidad,0)) AS cantidad_i ,sum(if(dt.flag_kardex='2',ROUND(dt.cantidad,4),0)) AS cantidad_s,dt.cod_prod,nombre 
	from det_mov dt, cab_mov cm, cliente c, operacion o,
    producto p ,clasificacion cl,  
	categoria ct,subcategoria sc where dt.cod_ope = o.codigo
    AND cm.cliente = c.codcliente
    AND p.idproducto = dt.cod_prod
    AND dt.cod_cab = cm.cod_cab and 
     ".$filtro3."   ".$filtro1." and dt.cantidad>0 and dt.tipo in(".$filtroMov.") AND cm.tipo = o.tipo
 and dt.cod_ope in('".$filtrodocs."') and dt.sucursal='".$sucursal."' and dt.tienda in(".   
	 $filtroTiendas.")
	 and substring(dt.fechad,1,10) between '".$fecha1."' and  '".$fecha2."'	
	 and flag_r<>'RA' and flag<>'A'
	 group by des_clas, des_cat, des_subcateg, dt.cod_prod, nombre
	 order by des_clas asc,des_cat asc,des_subcateg asc, ".$filtro_ordenar." ";	 
	 
	// echo $strSQL;

/*


*/
//------------	 
	$resultados = mysql_query($strSQL ,$cn);
	$total_registros = mysql_num_rows($resultados); 
	if($_REQUEST['excel']!="S"){ 
	  $strSQL=$strSQL."LIMIT $inicio, $registros";
	}
	 $resultadoreporte = mysql_query($strSQL,$cn); 
		
	$resultados2 =mysql_num_rows($resultadoreporte); 
	$total_paginas = ceil($total_registros / $registros); 
//-----------------	  


	while($rowreporte=mysql_fetch_array($resultadoreporte)){ 
	/* $resultadoreporte = mysql_query($strSQL,$cn); 
	$cont=0;
		 
	 while($rowreporte=mysql_fetch_array($resultadoreporte)){*/ 	 
		/////SUMANDO LAS SUBCATEGORIAS,CATEGORIAS,CLASIFICACIONES
		if($cont==0){
		         $subcat2=$rowreporte['des_subcateg'];
				 $cat2=$rowreporte['des_cat'];
				 $clas2=$rowreporte['des_clas'];
				// echo $subcat2;
				 //echo $cat2;
				// echo $clas2;
				 }
				 
	   if($subcat2!=$rowreporte['des_subcateg']){
				//echo "si diferente";
				$subtotrep="<tr style='color:#FF0000 ; font:bold ; font:Arial, Helvetica, sans-serif;                  font-size:12px' class='Estilo28'><td>&nbsp;</td><td colspan='6' align='right' style='color:#FF0000 ; font:bold ; font:Arial, Helvetica, sans-serif; font-size:10px' >Total ".$subcat2."</td>";
				 if($mov=="I" || $mov=="A"){ 
				 $subtotrep.="<td  align='right' style='color:#FF0000 ; font:bold ; font:Arial, Helvetica, sans-serif; font-size:10px'>&nbsp;&nbsp;".$totalessub." </td>";
				 }
				if($mov=="S" || $mov=="A"){ 
				 $subtotrep.="<td align='right' style='color:#FF0000 ; font:bold ; font:Arial, Helvetica, sans-serif; font-size:10px'>&nbsp;&nbsp;&nbsp;&nbsp;".$totales2sub."</td>";
				}	
				echo $subtotrep;
				 if($presentacion=='V'){				 
				 echo" <td align='left' style='color:#FF0000 ; font:bold ; font:Arial, Helvetica, sans-serif; font-size:12px' colspan='2' >".$totalescostosub."</td>
				 <td align='left' style='color:#FF0000 ; font:bold ; font:Arial, Helvetica, sans-serif; font-size:12px' colspan='2' >".number_format($sub_valorizado,2)."
				 </td>";
				 }
				 "</tr>";
				
				   $totalessub=0;
				   $totales2sub=0;
				   $totalescostosub=0;
			       $sub_valorizado=0;
			 	  $subcat2=$rowreporte['des_subcateg'];
//echo $subcat2;
	 }	
	 
		 if($cat2!=$rowreporte['des_cat']){		 
		
			  	 $subtotrep="<tr><td>&nbsp;</td><td colspan='6' align='right' style='color:#003399; font:bold; font:Arial, Helvetica, sans-serif; font-size:10px'>Total ".$cat2."</td>";
				 if($mov=="I" || $mov=="A"){ 
				 $subtotrep.="<td align='right' style='color:#003399; font:bold; font:Arial, Helvetica, sans-serif; font-size:10px' >&nbsp;&nbsp;".$totalescat."</td>";
				 }
				 if($mov=="S" || $mov=="A"){ 
				 $subtotrep.="<td  align='right' style='color:#003399; font:bold; font:Arial, Helvetica, sans-serif; font-size:10px'>&nbsp;&nbsp;&nbsp;&nbsp;".$totales2cat."</td>";
				 }
				 echo $subtotrep;
				 ///
				 if($presentacion=='V'){
				 echo " <td align='left' style='color:#003399; font:bold; font:Arial, Helvetica, sans-serif; font-size:12px'>"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$totalescostocat."</td>
				 <td style='color:#003399; font:bold; font:Arial, Helvetica, sans-serif; font-size:12px'>".number_format($cat_valorizado,2)."</td>";
				 }
				 "</tr>";
				 ///
				 $cat2=$rowreporte['des_cat'];
				   $totalescat=0;
				   $totales2cat=0;
				     $totalescostocat=0;
				   $cat_valorizado=0;
			  }
			  
	  	  		
 if($clas2!=$rowreporte['des_clas']){		
	
			   $subtotrep="<tr style='color:#006666 ; font:bold ; font:Arial, Helvetica, sans-serif;               font-size:12px' class='Estilo28'>
			   <td>&nbsp;</td><td colspan='6' align='right' style='color:#006666 ; font:bold ; font:Arial, Helvetica, sans-serif;    
	font-size:10px' >Total ".$clas2."</td>";
				 if($mov=="I" || $mov=="A"){ 
				 $subtotrep.="<td align='right' style='color:#006666 ; font:bold ; font:Arial, Helvetica, sans-serif;    
	font-size:10px' >"."&nbsp;&nbsp;".$totalesclas."</td>";
				 }
				  if($mov=="S" || $mov=="A"){ 
				 $subtotrep.="<td align='right' style='color:#006666 ; font:bold ; font:Arial, Helvetica, sans-serif;    
	font-size:10px' >&nbsp;&nbsp;&nbsp;&nbsp;".$totales2clas."</td>";
				  }
					
					echo $subtotrep;
 
			   ///
			  if($presentacion=='V') {
			  echo"<td  style='color:#006666 ; font:bold ; font:Arial, Helvetica, sans-serif;    
	font-size:12px' align='left'>"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$totalescostoclas."</td>
			  <td style='color:#006666 ; font:bold ; font:Arial, Helvetica, sans-serif;    
	font-size:12px'>".number_format($clas_valorizado,2)."</td>";
			  }
			  ///
			   " </tr>";
			     $clas2=$rowreporte['des_clas'];
						   $totalesclas=0;
				   $totales2clas=0;
				     $totalescostoclas=0;
				   $clas_valorizado=0;
			  }

			 if($clas!=$rowreporte['des_clas']){
		$clas=$rowreporte['des_clas'];
		echo " <tr>
		<td>&nbsp;</td>
    <td  colspan='2' style='color:#006666 ; font:bold ; font:Arial, Helvetica, sans-serif;    
	font-size:12px'>".$clas."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
 
    </tr>
		";
		}
		
		if($cat!=$rowreporte['des_cat']){
		$cat=$rowreporte['des_cat'];
		
		echo " <tr>
		<td>&nbsp;</td>
    <td  colspan='2' style='color:#003399; font:bold; font:Arial, Helvetica, sans-serif; font-size:12px'>&nbsp;&nbsp;".$cat."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>


  </tr>
		";
		
		}
		 if($subcat!=$rowreporte['des_subcateg']){
		$subcat=$rowreporte['des_subcateg'];
		
		echo " <tr>
		<td>&nbsp;</td>
    <td style='color:#FF0000 ; font:bold ; font:Arial, Helvetica, sans-serif; font-size:12px' colspan='2'>&nbsp;&nbsp;&nbsp;&nbsp;".$subcat."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>


  </tr>
		";
		
		}	
		if($presentacion=='V'){
		 $totalValor=($rowreporte['VentaSoles']+$rowreporte['VentaDolares']);
		 $costoSub=$rowreporte['Costo'];
		 $costoclas=$rowreporte['Costo'];
		 $clas_valor=($rowreporte['VentaSoles']+$rowreporte['VentaDolares']);
		 $costocat=$rowreporte['Costo'];
	     $cat_valor=($rowreporte['VentaSoles']+$rowreporte['VentaDolares']);
		}	 

?>
	<tr>
    	<td align="left">&nbsp;</td>
		<td bgcolor="#FFFFFF" class="Estilo28"><?php echo $rowreporte['cod_prod']?></td>
		<td bgcolor="#FFFFFF" colspan="5"  class="Estilo28"><?php echo $rowreporte['nombre']?></td>   
		<?php if($mov=='I' || $mov=='A' ){?>
		<td bgcolor="#FFFFFF" class="Estilo28" align="right"><?php
		 		 
	/*$sqlF=" SELECT sum(det_mov.cantidad) AS cantidad ,det_mov.cod_prod
FROM det_mov, cab_mov, cliente, operacion
WHERE cab_mov.cod_ope = operacion.codigo
AND cab_mov.cliente = cliente.codcliente
AND cab_mov.tipo = operacion.tipo
AND det_mov.cod_cab = cab_mov.cod_cab
AND det_mov.cod_prod = '".$rowreporte['cod_prod']."'
AND substring( det_mov.fechad, 1, 10 )
between '".$fecha1."' and  '".$fecha2."'	
AND flag_r <> 'RA' AND flag <> 'A'

and det_mov.cod_ope in(".$filtrodocs.")
and det_mov.tienda in(".$filtroTiendas.")  
AND det_mov.cantidad >0
AND det_mov.tipo = '1'
group by det_mov.cod_prod  " ;
		$resultadosF = mysql_query($sqlF);
		$rowF=mysql_fetch_array($resultadosF); 
		*/
		if ($rowreporte['cantidad_i']==''){ $cantRk='0'; }else{ $cantRk=$rowreporte['cantidad_i'];  }
		$cantidad=$cantRk;	
		$clasif=$cantRk;
		$categ=$cantRk;
		echo "&nbsp;&nbsp;".$cantRk;
		// echo "&nbsp;&nbsp;".$rowreporte['ingresos']?></td>
		<?php }
		if($mov=='S'  || $mov=='A'){?>
		<td bgcolor="#FFFFFF" class="Estilo28" align="right"><?php 
		  /*$sqlF=" SELECT sum(det_mov.cantidad) AS cantidad ,det_mov.cod_prod
FROM det_mov, cab_mov, cliente, operacion
WHERE cab_mov.cod_ope = operacion.codigo
AND cab_mov.cliente = cliente.codcliente
AND cab_mov.tipo = operacion.tipo
AND det_mov.cod_cab = cab_mov.cod_cab
AND det_mov.cod_prod = '".$rowreporte['cod_prod']."'
AND substring( det_mov.fechad, 1, 10 )
between '".$fecha1."' and  '".$fecha2."'	
AND flag_r <> 'RA' AND flag <> 'A'

and det_mov.cod_ope in(".$filtrodocs.")
and det_mov.tienda in(".$filtroTiendas.")  

AND det_mov.cantidad >0
AND det_mov.tipo = '2'
group by det_mov.cod_prod  " ;
		$resultadosF = mysql_query($sqlF);
		$rowF=mysql_fetch_array($resultadosF); */
		
		if ($rowreporte['cantidad_s']==''){ $cantRk='0'; }else{ $cantRk=$rowreporte['cantidad_s'];  }
		$cantidad2=$cantRk;	
		$clasif2=$cantRk;
		$categ2=$cantRk;	 
		echo "&nbsp;&nbsp;".$cantRk;
		//echo "&nbsp;&nbsp;&nbsp;&nbsp;".$rowreporte['salidas']?></td>
		<?php }
		if($presentacion=='V'){
			if($formato=='C'){
				echo "  <td bgcolor='#FFFFFF' class='Estilo28' >".$rowreporte['Costo']."</td>";
				echo "  <td bgcolor='#FFFFFF' class='Estilo28' >".number_format($totalValor,2)."</td>";
			}
		}
		?>
        <td>&nbsp;</td>
	</tr>
	<?php
	$totalessub=$totalessub+$cantidad;
	$totales2sub=$totales2sub+$cantidad2;	
	$totalescostosub=$totalescostosub+$costoSub;
	$sub_valorizado= $sub_valorizado+$totalValor;
	///
	   
	$totalesclas=$totalesclas+$clasif;
	$totales2clas=$totales2clas+$clasif2;	
	$totalescostoclas=$totalescostoclas+$costoclas;
	$clas_valorizado= $clas_valorizado+$clas_valor;
	//	
	   
	$totalescat=$totalescat+$categ;
	$totales2cat=$totales2cat+$categ2;	
	$totalescostocat=$totalescostocat+$costocat;
	$cat_valorizado= $cat_valorizado+$cat_valor;
	?>
	<?php 
	$cont++;
}
	  // PIE DE PAGINA //
 if($agr_sub=='S'){
	   if($subcat2!='999'){
				//echo "si diferente";
			   	 echo "<tr style='color:#FF0000 ; font:bold ; font:Arial, Helvetica, sans-serif;                  font-size:12px' class='Estilo28'>				 
				 <td>&nbsp;</td><td colspan='6' align='right' style='color:#FF0000 ; font:bold ; font:Arial, Helvetica, sans-serif; font-size:10px' >Total ".$subcat2."</td>";
				 if($mov=="I" || $mov=="A"){ 
				 echo "<td  align='right' style='color:#FF0000 ; font:bold ; font:Arial, Helvetica, sans-serif; font-size:10px'>&nbsp;&nbsp;".$totalessub." </td>";
				 }
				 if($mov=="S" || $mov=="A"){   				 
				 echo "<td align='right' style='color:#FF0000 ; font:bold ; font:Arial, Helvetica, sans-serif; font-size:10px'>&nbsp;&nbsp;&nbsp;&nbsp;".$totales2sub."</td>";
				 }
				 
					 if($presentacion=='V'){				 
					 echo" <td align='left' style='color:#FF0000 ; font:bold ; font:Arial, Helvetica, sans-serif; font-size:10px' >"."".$totalescostosub."</td>
					 <td style='color:#FF0000 ; font:bold ; font:Arial, Helvetica, sans-serif; font-size:10px' > ".number_format($sub_valorizado,2)."
					 </td>";
					 }
				 "</tr>";
				
				   $totalessub=0;
				   $totales2sub=0;
				   $totalescostosub=0;
			       $sub_valorizado=0;
			 	  $subcat2=$rowreporte['des_subcateg'];
	 }		 
}	  

if($agr_cat=='S'){
     if($cat2!='999'){		 
		
			  	 echo"<tr>
				 <td>&nbsp;</td><td colspan='6' align='right' style='color:#003399; font:bold; font:Arial, Helvetica, sans-serif; font-size:10px'>Total ".$cat2."</td>";
				 if($mov=="I" || $mov=="A"){ 
				 echo "<td align='right' style='color:#003399; font:bold; font:Arial, Helvetica, sans-serif; font-size:10px' >&nbsp;&nbsp;".$totalescat."</td>";
				 }
				 if($mov=="S" || $mov=="A"){ 
				 echo "<td  align='right' style='color:#003399; font:bold; font:Arial, Helvetica, sans-serif; font-size:10px'>&nbsp;&nbsp;&nbsp;&nbsp;".$totales2cat."</td>";
				 }
				 ///
				 if($presentacion=='V'){
				 echo " <td align='left' style='color:#003399; font:bold; font:Arial, Helvetica, sans-serif; font-size:10px'>"."".$totalescostocat."</td>
				 <td style='color:#003399; font:bold; font:Arial, Helvetica, sans-serif; font-size:10px'>".number_format($cat_valorizado,2)."</td>";
				 }
				 "</tr>";
				 ///
				 $cat2=$rowreporte['des_cat'];
				   $totalescat=0;
				   $totales2cat=0;
				     $totalescostocat=0;
				   $cat_valorizado=0;
	  }			  
} 	  
 if($agr_cla=='S'){
	 if($clas2!='999'){		
		
			   echo "<tr style='color:#006666 ; font:bold ; font:Arial, Helvetica, sans-serif;               font-size:12px' class='Estilo28'>
			   <td>&nbsp;</td><td colspan='6' align='right' style='color:#006666 ; font:bold ; font:Arial, Helvetica, sans-serif;    
	font-size:10px' >Total ".$clas2."</td>";
			if($mov=="I" || $mov=="A"){ 
				echo "<td align='right' style='color:#006666 ; font:bold ; font:Arial, Helvetica, sans-serif;    
	font-size:10px' >"."&nbsp;&nbsp;".$totalesclas."</td>";
			}
			if($mov=="S" || $mov=="A"){ 
			   echo "<td align='right' style='color:#006666 ; font:bold ; font:Arial, Helvetica, sans-serif;    
	font-size:10px' >&nbsp;&nbsp;&nbsp;&nbsp;".$totales2clas."</td>";
			}
			   ///
			  if($presentacion=='V') {
			  echo"<td  align='left' style='color:#006666 ; font:bold ; font:Arial, Helvetica, sans-serif;    
	font-size:10px' >"."".$totalescostoclas."</td>
			  <td style='color:#006666 ; font:bold ; font:Arial, Helvetica, sans-serif;    
	font-size:10px'>".number_format($clas_valorizado,2)."</td>";
			  }
			  ///
			   " </tr>";
			     $clas2=$rowreporte['des_clas'];
				 $totalesclas=0;
				 $totales2clas=0;
				 $totalescostoclas=0;
				 $clas_valorizado=0;
       }
}	
	  	  		
 
 ?>
<!--    </table></td>
  </tr>-->  
  <tr>
  	<td align="left">&nbsp;</td>
    <td colspan="8" valign="top">

	<? if($_REQUEST['excel']!="S"){ ?>
	<table width="" height="31" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="223" height="31" align="left" valign="bottom" style="color:#999999"><span class="Estilo29">Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (de <strong><?php echo $total_registros?></strong> productos)</span>.</td>
        <td width="540" align="right" valign="bottom" style="color:#999999"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:13px">
        
          <?php 
			  
 if(($pagina - 1) > 0) { 
echo "<a style='cursor:pointer' onclick='cargardatos($pagina-1)'>< Anterior </a> "; 
} 

for ($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
	echo "<b style='color:#000000'>".$pagina."</b> "; 
	} else { 
	echo "<a style='cursor:pointer' href='#' onclick='cargardatos($i)'>$i</a> "; 
	}
}
if(($pagina + 1)<=$total_paginas) { 
echo " <a style='cursor:pointer' onclick='cargardatos($pagina+1)'>Siguiente ></a>"; 
} 
    ?>
          &nbsp;&nbsp;</font>
            <input type="hidden" name="pag" id="pag" value="<?php echo $pagina?>" />
			
			<input type="hidden" name="docsNoAnu" id="docsNoAnu" value="<?php echo $_SESSION['docConSerie3']?>">
			<input type="hidden" name="docsNoDesAnu" id="docsNoDesAnu" value="<?php echo $_SESSION['docConSerie4']?>">
			
        </td>
      </tr>
    </table>
	<? } ?>
</td>
  </tr>
  <tr>
  	<td align="left">&nbsp;</td>
    <td colspan="7" valign="top"></td>
  </tr>
  <tr>
  	<td align="left">&nbsp;</td>
    <td colspan="7" valign="top">&nbsp;</td>
  </tr>
</table>
  </form>
<script>
function cargardatos(pagina){
var formato=document.form1.formato.value;
var presentacion=document.form1.cmbPres.value;
var ordenar=document.form1.cmbordenar.value;
var valorizar=document.form1.cmbValor.value;		
var fecha1=document.form1.fecha1.value;
var fecha2=document.form1.fecha2.value;
var chk_tiendas=document.form1.chk_tiendas.value;;
var chkIngresos=document.form1.chkIngresos.value;;
var chkSalidas=document.form1.chkSalidas.value;;
var radiobutton=document.form1.radiobutton.value;
var movimiento=document.form1.cmbmov.value;

var sucursal=document.form1.sucursal.value;
var cboclasifica=document.form1.cboclasifica.value;
var cbocateg=document.form1.cbocateg.value;
var cbosubcateg=document.form1.cbosubcateg.value;
var chkAgruparClas=document.form1.chkAgruparClas.value;
var chkAgruparCat=document.form1.chkAgruparCat.value;
var chkAgruparSub=document.form1.chkAgruparSub.value;
var agr_cla=document.form1.agr_cla.value;
var agr_cat=document.form1.agr_cat.value;
var agr_sub=document.form1.agr_sub.value;


htmlreporte="?chk_tiendas="+chk_tiendas+"&chkIngresos="+chkIngresos+"&chkSalidas="+chkSalidas+"&radiobutton="+radiobutton+"&fecha1="+fecha1+"&fecha2="+fecha2+"&cmbformato="+formato+"&cmbPres="+presentacion+"&cmbordenar="+ordenar+"&cmbValor="+valorizar+"&cmbmov="+movimiento+"&sucursal="+sucursal+"&cboclasifica="+cboclasifica+"&cbocateg="+cbocateg+"&cbosubcateg="+cbosubcateg+"&chkAgruparClas="+chkAgruparClas+"&chkAgruparCat="+chkAgruparCat+"&chkAgruparSub="+chkAgruparSub+"&agr_cla="+agr_cla+"&agr_cat="+agr_cat+"&agr_sub="+agr_sub+'&pagina='+pagina;
	 //alert(htmlreporte);
	document.form1.action="rpt_cons_movifecha.php"+htmlreporte;
	document.form1.submit();	

}
</script>
</body>
</html>
