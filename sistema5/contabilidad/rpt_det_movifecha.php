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
	
//	$cod_doc_i=$_REQUEST['chkIngresos'];
//    $cod_doc_s=$_REQUEST['chkSalidas'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo////</title>
<style type="text/css">
<!--
.Estilo16 {color: #FFFFFF; font-weight: bold; font-size: 11px; font-family: Arial, Helvetica, sans-serif; }
.Estilo27 {color: #000000}
.Estilo28 {color: #000000; font-weight: bold; font-size: 11px; font-family: Arial, Helvetica, sans-serif; }
.Estilo34 {color: #FFFFFF}
.Estilo43 {color: #000000; font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo44 {font-size: 12px}
.Estilo45 {color: #666666}
-->
</style>
</head>

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

<table border="0" width="700px" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4" align="right"><table width="120px" border="0" cellspacing="0" cellpadding="0">

	  <tr>
        <td width="41" align="right" valign="top" class="Estilo28"><span class="Estilo27">Fecha</span>:</td>
        <td width="79" class="Estilo28"><?php echo date('d-m-Y')?> </td>
      </tr>
      <tr>
        <td align="right" class="Estilo28"><span class="Estilo27">Hora:</span></td>
        <td class="Estilo28"><?php echo date('H:i:s A')?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="4" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="left"><div align="center">
      <p class="Estilo28">MOVIMIENTO DE PRODUCTOS POR FECHAS </p>
    </div></td>
  </tr>
  <tr>
    <td colspan="4" align="center">
        <table width="269" height="38" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="4" align="center"><b><span class="Estilo27">
              <?php if($formato=='D'){
	echo"Detallado";
	}else{
	echo "Consolidado";
	} ?>
            </span></b></td>
          </tr>
          <tr>
            <td width="24" align="right" class="Estilo28"><span class="Estilo27">De:</span></td>
            <td width="115" class="Estilo28"><?php echo $fecha1;?></td>
            <td width="20" align="right" class="Estilo28"><span class="Estilo27">Al:</span></td>
            <td width="110" class="Estilo28"><?php echo $fecha2;?></td>
          </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="4" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="Estilo28"><span class="Estilo27"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sucursal:<span class="Estilo4">
      <?php 
	
	$sql="Select * from sucursal where cod_suc='$sucursal'";
	//echo $sql;
	$query=mysql_query($sql,$cn);
	
	
	while($row=$resultado=mysql_fetch_array($query)){
	echo $row['des_suc'];
	}
	?>
    </span></span></td>
    <td align="left" class="Estilo28">&nbsp;</td>
    <td align="left" class="Estilo28">&nbsp;</td>
    <td align="right" class="Estilo28"><span class="Estilo27">Formato:
      <?php 
	  if($presentacion=='F'){
	  echo "Fisico";
	  }else{
	  	if($valorizar=='Soles'){
	  	$val=" Soles(S/.)";
	  	}elseif($valorizar=='Dolares'){
	  	$val=" Dolares(U$/.)";
	  	}elseif($valorizar=='Origen'){
		$val=" Moneda de Origen";
		}
	  echo "Valorizado en $val";
	  }
	  ?>
      &nbsp;&nbsp;&nbsp;&nbsp;</span></td>
  </tr>
  <tr>
    <td align="left" class="Estilo28"><span class="Estilo27">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tiendas&nbsp;
          <?php 
//	echo "SELECT * FROM tienda WHERE cod_suc ='$sucursal' AND  cod_tienda in(".$filtro1.")";
$filtroTiendas="''";
$ct=0;
//--rk
$chk_tiendas=explode("|",$chk_tiendas);
for($i=0;$i<count($chk_tiendas);$i++){
//echo $chk_tiendas[$i];
if($ct==0){
	$filtroTiendas="'".$chk_tiendas[$i]."'";
}else{
	$filtroTiendas=$filtroTiendas.",'".$chk_tiendas[$i]."'";
}
$ct++;
}
//--fin rk
/*$chk_tiendas=$_REQUEST['chkTiendas'];
for($i=0;$i<count($chk_tiendas);$i++){
	$filtroTiendas=$filtroTiendas.",'".$chk_tiendas[$i]."'";
}*/
$resultado=mysql_query("SELECT * FROM tienda WHERE cod_suc ='$sucursal' AND  cod_tienda in(". $filtroTiendas.")",$cn);
//echo  mysql_num_rows($resultado);
       while($tiendas=mysql_fetch_array($resultado)){
	 echo "".$tiendas['cod_tienda']. "-".$tiendas['des_tienda']." <|> " ;
//	 echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$tiendas['des_tienda'] ;
	}
	?>
    </span></td>
    <td align="left" class="Estilo28">&nbsp;</td>
    <td align="left" class="Estilo28">&nbsp;</td>
    <td align="right" class="Estilo28">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center">
    <table width="700px" border="0" cellpadding="0" cellspacing="2" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <tr>
        <td colspan="4"  align="left" class="Estilo16" valign="baseline"><table width="700px" border="0" cellspacing="1" cellpadding="1">
          <tr>
            <td width="40" height="16"    align="left" bgcolor="#006699" class="Estilo16"><span class="Estilo8 Estilo34">Codigo </span></td>
               
            <td width="240"  align="left" bgcolor="#006699" class="Estilo16"> Producto</td>
            <td width="85"  align="left" bgcolor="#006699" class="Estilo16">Unidad</td>
            <td width="165"  align="left" bgcolor="#006699" class="Estilo16">Movimientos</td>
            <?php
		if($presentacion=='V'){
		echo" <td width='140' align='left' bgcolor='#006699'class='Estilo16'>Valorizado</td>";
		}
		?>
          </tr>
        </table>		</td>
         </tr>
      <tr>
        <td colspan="4"  align="left" bgcolor="#FFFFFF" class="Estilo16" valign="top">
		
		<table width="700" border="0" cellpadding="1" cellspacing="1"  style="vertical-align:top">
            <tr>
              <td width="37" bgcolor="#F0B442"><span class="Estilo27">Tienda</span></td>
              <td width="59" bgcolor="#F0B442"><span class="Estilo27">Fecha </span></td>
              <td width="90" bgcolor="#F0B442"><span class="Estilo27">Documento</span></td>
              <td width="78" bgcolor="#F0B442"><span class="Estilo27">Referencia</span></td>
              <td width="105" bgcolor="#F0B442"><span class="Estilo27">Referenciado</span></td>
              <td width="26" bgcolor="#F0B442"><span class="Estilo27">Und.</span></td>
              <td width="143" bgcolor="#F0B442"><span class="Estilo27">Auxiliar</span></td>
              <td width="68" bgcolor="#F0B442" style="color:#000000"><span class="Estilo27">Ingresos </span></td>
              <td width="66" bgcolor="#F0B442"><span class="Estilo27">Salidas</span></td>
              <?php
//			 echo $presentacion;

			if($formato=='D' && $valorizar=='Origen'){
		
		     echo "<td width='80' bgcolor='#F0B442'><span class='Estilo27'>Moneda</span></td>";
				 
			 }


		 if($presentacion=='V'){
		 		 
			 if($formato=='D'){
			 echo " <td width='80' bgcolor='#F0B442'><span class='Estilo27'>Ingresos</span></td>";
			 echo " <td width='91' bgcolor='#F0B442'><span class='Estilo27'> Salidas</span></td>";
			 }
			 
			    
		 }
		 ?>
            </tr>
        </table></td>
      </tr>
      <?php //realizando consulta

	//ORDENAR
	
	if($ordenar=='1'){
	$filtro_ordenar=', p.idproducto asc';
	}elseif($ordenar=='2'){
	
	$filtro_ordenar=', nombre asc';
	}elseif($ordenar=='3'){
	$filtro_ordenar=', cod_prod asc';
	}
	//MOVIMIENTO
	$filtrocab=" ";
	if($mov!="-1"){
		if($mov=="I"){
		$filtroMov="1";
		$filtrocab=" and cab_mov.tipo='1' ";
		}
		if($mov=="S"){
		$filtroMov="2";
		$filtrocab=" and cab_mov.tipo='2' ";
		}
		if($mov=="A"){
		$filtroMov="1,2";
		}
	}


if ($filtroMov=="1"){
$filtrodocs="''";
//echo count($cod_doc_i);

	//--rk
$cod_doc_i=explode("|",$chkIngresos);
for($i=0;$i<count($cod_doc_i);$i++){
//echo $cod_doc_i[$i];
	if($i==0){
		$filtrodocs=$cod_doc_i[$i];
	}else{
	  	$filtrodocs=$filtrodocs."','".$cod_doc_i[$i];
	}
  //$filtrodocs=$filtrodocs.",'".$cod_doc_i[$i]."'";
}
//--fin rk
	/*for($i=0;$i<count($cod_doc_i);$i++){
	echo $filtrodocs=$filtrodocs.",'".$cod_doc_i[$i]."'";	
	}*/
	//echo $filtrodocs;
}elseif($filtroMov=="2"){
	$filtrodocs="''";
	//	echo count($cod_doc_s);	
	//--rk
$cod_doc_s=explode("|",$chkSalidas);
for($i=0;$i<count($cod_doc_s);$i++){
//echo $cod_doc_s[$i];
	if($i==0){
		$filtrodocs=$cod_doc_s[$i];
	}else{
	  	$filtrodocs=$filtrodocs."','".$cod_doc_s[$i];
	}
 //$filtrodocs=$filtrodocs.",'".$cod_doc_s[$i]."'";
}

//--fin rk
			/*for($i=0;$i<count($cod_doc_s);$i++){
			echo $filtrodocs=$filtrodocs.",'".$cod_doc_s[$i]."'";
			}*/
			//echo $filtrodocs;
		}elseif($filtroMov=="1,2"){
			  $filtrodocs="";
			  $cod_doc_s=explode("|",$chkSalidas);
			  for($i=0;$i<count($cod_doc_s);$i++){
			  	if($cod_doc_s[$i]!=""){
					if($i==0){
						$filtrodocs=$cod_doc_s[$i];
					}else{
					  	$filtrodocs=$filtrodocs."','".$cod_doc_s[$i];
					}
				}
			  }
			  $cod_doc_i=explode("|",$chkIngresos);
			  for($i=0;$i<count($cod_doc_i);$i++){
			  	if($cod_doc_i[$i]!=""){
			  		if($i==0){
						$filtrodocs.="','".$cod_doc_i[$i];
					}else{
			  			$filtrodocs=$filtrodocs."','".$cod_doc_i[$i];
					}
			  	}
			  }
			  //print_r($cod_doc_s);
			   //$union=array_merge($cod_doc_i,$cod_doc_s);
			   /*$union=array_merge($chkIngresos,$chkSalidas);
              for($i=0;$i<count($union);$i++){
			 	  $filtrodocs=$filtrodocs.",'".$union[$i]."'";
			  }	
			  $filtrodocs=str_replace("|","','",$filtrodocs);*/
		}

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
	
	if($agr_cla!='N' || $agr_cat!='N' || $agr_sub!='N'){
	
		if($agr_cla=='S' and $agr_cat=='S' and $agr_sub=='S'){
		$clas="999";
		$clas2="999";
		$cat="999";
		$cat2="999";
		$subcat="999";
		$subcat2="999";
		$filtro2=" des_clas,des_cat,des_subcateg ";
		$filtro3=" p.clasificacion=idclasificacion and p.categoria=idcategoria and        
		p.subcategoria=idsubcategoria  ";
		}else{
			if($agr_cla=='S' and $agr_cat=='S'){
			$clas="999";
			$clas2="999";
			$cat="999";
			$cat2="999";
			$subcat="";
			$subcat2="999";
			$filtro2=" des_clas,des_cat ";
			$filtro3=" p.clasificacion=idclasificacion and p.categoria=idcategoria and 
			p.subcategoria!='000'  ";
			}else{
				if($agr_cla=='S' and $agr_sub=='S'){
				$clas="999";
				$clas2="999";
				$cat="";
				$cat2="";
				$subcat="999";
				$subcat2="999";
				$filtro2=" des_clas,des_subcateg ";
				$filtro3=" p.clasificacion=idclasificacion and p.categoria!='000' and 
				p.subcategoria=idsubcategoria  ";
				}else{
					if($agr_cat=='S' and $agr_sub=='S'){
					$clas="";
					$clas2="";
					$cat="999";
					$cat2="999";
					$subcat="999";
					$subcat2="999";
					$filtro2=" des_cat,des_subcateg ";
					$filtro3=" p.clasificacion!='000' and p.categoria=idcategoria and 
					p.subcategoria=idsubcategoria  ";
					}else{
						if($agr_cla=='S'){
						$clas="999";
						$clas2="999";
						$cat="";
						$cat2="";
						$subcat="";
						$subcat2="";
						$filtro2=" des_clas ";
						$filtro3=" p.clasificacion=idclasificacion and p.categoria!='000' and 
						p.subcategoria!='000'  ";
						}else{
							if($agr_cat=='S'){
							$clas="";
							$clas2="";
							$cat="999";
							$cat2="999";
							$subcat="";
							$subcat2="";
							$filtro2=" des_cat ";
							$filtro3=" p.clasificacion!='000' and p.categoria=idcategoria and                            p.subcategoria!='000'  
							";
							}else{
								if($agr_sub=='S'){
								$clas="";
								$clas2="";
								$cat="";
								$cat2="";
								$subcat="999";
								$subcat2="999";
								$filtro2=" des_subcateg ";
								$filtro3=" p.clasificacion!='000' and p.categoria!='000' and 
								p.subcategoria=idsubcategoria  ";
								}else{
									$clas="";
									$clas2="";
									$cat="";
									$cat2="";
									$subcat="";
									$subcat2="";
									$filtro2=" cod_prod ";
									$filtro3=" p.clasificacion!='000' and p.categoria!='000' and                                    p.subcategoria!='000'  ";
									
									}
		                        }
		                   }
		              }
		         }
		    }
		}
	}else{
	$filtro2=" dt.cod_prod ";
	$filtro3=' p.clasificacion=idclasificacion and p.categoria=idcategoria and 
	p.subcategoria=idsubcategoria   ';
	}	

	 $strSQL="select ".$filtro2.",dt.tienda as 'tienda',dt.cod_prod, p.nombre,p.und,u.nombre as 'unidad'
	 from det_mov dt, cab_mov cm, cliente c, operacion o,
     producto p ,clasificacion cl, unidades u,  
	 categoria ct,subcategoria sc where dt.cod_ope = o.codigo
    AND cm.cliente = c.codcliente
    AND p.idproducto = dt.cod_prod
	AND p.und=u.id
    AND dt.cod_cab = cm.cod_cab and 
     ".$filtro3."   ".$filtro1." and dt.tipo in(".$filtroMov .") and dt.cod_ope in('".$filtrodocs."') and dt.sucursal='".$sucursal."' and dt.tienda in(".$filtroTiendas.")  
	 and  substring(dt.fechad,1,10) between '".$fecha1."' and '".$fecha2."'  
	 and flag_r<>'RA' and flag<>'A'
	 group by des_clas, des_cat, des_subcateg, dt.cod_prod, nombre
	 order by des_clas asc,des_cat asc,des_subcateg asc ".$filtro_ordenar." ";	

//

//------------	 
 	//echo $strSQL."<br>";
	$resultados = mysql_query($strSQL ,$cn);
	$total_registros = mysql_num_rows($resultados); 
	if($_REQUEST['excel']!="S"){ 
	  $strSQL=$strSQL."LIMIT $inicio, $registros";
	}
	 $resultadoreporte = mysql_query($strSQL,$cn); 
		
	$resultados2 =mysql_num_rows($resultadoreporte); 
	$total_paginas = ceil($total_registros / $registros); 
//-----------------	  
	  //echo $strSQL;
	//echo $filtroMov;
	 //$resultadoreporte = mysql_query($strSQL,$cn);  
	 $cont=0;
	 $totales2sub=0;
     $totalessub=0;
	 $totalescat=0;
	 $totalescat2=0;	 
	 $totalesclas=0;
	 $totalesclas2=0;	 
	 $totalescostosub=0;
	 $sub_valorizado=0;
	 $totalescostocat=0;
	  $cat_valorizado=0;
	 $totalescostoclas=0;
	  $clas_valorizado=0;
	 
    //while($rowreporte=mysql_fetch_array($strSQL)){
	while($rowreporte=mysql_fetch_array($resultadoreporte)){ 
				if($cont==0){
				 $subcat2=$rowreporte['des_subcateg'];
				 $cat2=$rowreporte['des_cat'];
				 $clas2=$rowreporte['des_clas'];
				 }
					
				  if($subcat2!=$rowreporte['des_subcateg']){
				
			   	 echo "<tr style='color:#FF0000 ; font:bold ; font:Arial, Helvetica, sans-serif; font-size:12px' class='Estilo28'>
				 
				 <td colspan='2' align='right' width='50'> DTotal ".$subcat2."</td>				 
				 <td  align='left' width='50' >";
				 if($filtroMov=="1" || $filtroMov=="1,2"){ 
				 echo $totalessub; }  else { echo "              " ; } 
				 echo "</td>";
				 echo "<td align='left' width='60'> ";
				  if($filtroMov=="2" || $filtroMov=="1,2"){ 
				  echo $totales2sub; }
				  echo "</td>";
				 $totalessub=0;
				$totales2sub=0;
				
				 if($presentacion=='V' && $valorizar!='Origen'){				 
				 echo" <td align='left'> ";
				  if($filtroMov=="1" || $filtroMov=="1,2"){ 
				  echo $totalescostosub;
				  }
				  echo "</td>";
				echo " <td align='left'>";
				 if($filtroMov=="2" || $filtroMov=="1,2"){ 
				 echo number_format($sub_valorizado,2);
				 }
				 echo "</td>";
				 }
				 "</tr>";
				
				
				$totalescostosub=0;
			    $sub_valorizado=0;
				
				$subcat2=$rowreporte['des_subcateg'];
				
				   			 
			   }	
			    if($cat2!=$rowreporte['des_cat']){
			 
			  // echo "entro al 2do if";
			  	 echo"<tr style='color:#003399; font:bold; font:Arial, Helvetica, sans-serif; font-size:12px' class='Estilo28'>
				 <td colspan='2' align='right'> Total  ".$cat2."</td>
				 <td align='left'> ";
				  if($filtroMov=="1" || $filtroMov=="1,2"){ 
				  echo $totalescat;
				  }
				  echo "</td>";
				 echo "<td align='left'> ";
				  if($filtroMov=="2" || $filtroMov=="1,2"){  
				  echo $totales2cat;
				  }
				  echo "</td>";
				  $totalescat=0;
				 $totales2cat=0;
				 if($presentacion=='V' && $valorizar!='Origen'){
				 
				 echo " <td align='left'> ";
				  if($filtroMov=="1" || $filtroMov=="1,2"){  
				  echo $totalescostocat;
				  }
				  echo "</td>";
				 echo "<td align='left'>";
				  if($filtroMov=="2" || $filtroMov=="1,2"){ 
				  echo number_format($cat_valorizado,2);
				  }
				  echo "</td>";
				 }
				 "</tr>";
				 
				 
				 $cat2=$rowreporte['des_cat'];
				 $totalescostocat=0;
				 $cat_valorizado=0;
				 $cat_valor=0;
			  }
			  
	  	  		
				  if($clas2!=$rowreporte['des_clas']){
			
			  //echo "entro al primeri if";
			   echo "<tr style='color:#006666 ; font:bold ; font:Arial, Helvetica, sans-serif; font-size:12px' class='Estilo28'>
			   <td colspan='2' align='right'> Total  ".$clas2."</td>
			   <td  align='left'>";
			    if($filtroMov=="1" || $filtroMov=="1,2"){ 
				echo $totalesclas;
				}
				echo "</td>";
			   echo "<td align='left'> ";
			    if($filtroMov=="2" || $filtroMov=="1,2"){  
				echo $totales2clas;
				}
				echo "</td>";
			    $totalesclas=0;
				 $totales2clas=0;
			  if($presentacion=='V' && $valorizar!='Origen') {
			  echo"<td  align='left'>   ";
			   if($filtroMov=="1" || $filtroMov=="1,2"){ 
			   echo $totalescostoclas;
			   }
			   echo "</td>";
			  echo "<td align='left'> ";
			   if($filtroMov=="2" || $filtroMov=="1,2"){
			   echo  number_format($clas_valorizado,2);
			   }
			   echo "</td>";
			  }
			   " </tr>";
			   
			     $clas2=$rowreporte['des_clas'];
				 $totalescostoclas=0;
				 $clas_valorizado=0;
				 $clas_Valor=0;			  
			  }
		 if($clas!=$rowreporte['des_clas']){
		$clas=$rowreporte['des_clas'];
		echo " <tr>
    <td align='left' colspan='2' style='color:#006666 ; font:bold ; font:Arial, Helvetica, sans-serif;    
	font-size:12px'>".strtoupper($clas)."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
 
    </tr>
		";
		
		}
		//
		if($cat!=$rowreporte['des_cat']){
		$cat=$rowreporte['des_cat'];
		
		echo " <tr>
    <td  align='left' colspan='2' style='color:#003399; font:bold; font:Arial, Helvetica, sans-serif; font-size:12px'> ".strtoupper($cat)."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>


  </tr>
		";
		
		}
		 if($subcat!=$rowreporte['des_subcateg']){
		$subcat=$rowreporte['des_subcateg'];
	
		echo " <tr>
    <td  align='left' style='color:#FF0000 ; font:bold ; font:Arial, Helvetica, sans-serif; font-size:12px' colspan='2'> ".strtoupper($subcat)."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>


  </tr>
		";	 
			 
		}
	
	 ?>
      <tr>
        <td width="58" height="29"  align="left" bgcolor="#FFFFFF" class="Estilo28"><span class="Estilo43"><?php echo $rowreporte['cod_prod']?></span></td>
        <td width="311" align="left" bgcolor="#FFFFFF" class="Estilo28"><span class="Estilo43"><?php echo $rowreporte['nombre']?></span></td>
        <td width="327" align="left" bgcolor="#FFFFFF" class="Estilo28"><span class="Estilo28"><span class="Estilo44"><?php echo $rowreporte['unidad'] ?></span></span></td>
      </tr>
      <tr>
        <td height="29" colspan="4"  align="left" bgcolor="#FFFFFF">
		
		<table  width="700" height="20" border="0" cellpadding="0" cellspacing="0">
          <?php
	if($presentacion=='V'){
		if($valorizar=='Soles'){
		$conversion=",if( det_mov.flag_kardex =2 &&        
		 det_mov.moneda=01,det_mov.imp_item, 0 )  AS 'VentaSoles', if( det_mov.flag_kardex =2 && 
		 det_mov.moneda=02,det_mov.imp_item*det_mov.tcambio, 0 )  AS 'VentaDolares' ";
		 }
		 if($valorizar=='Dolares'){
		 $conversion=",if( det_mov.flag_kardex =2 &&        
		 det_mov.moneda=01,det_mov.imp_item/det_mov.tcambio, 0 ) AS 'VentaSoles',if( det_mov.flag_kardex =2         && det_mov.moneda=02,det_mov.imp_item, 0 ) AS 'VentaDolares' ";
		 }
		 if($formato=='D' && $valorizar=='Origen'){
		 $campo=" ,moneda.simbolo ";
		 $tabla=", moneda";
		 $conversion=", if(det_mov.flag_kardex='2',det_mov.imp_item,'0') as 'venta' ";
		 $enlace=" and det_mov.moneda=moneda.id";
		 }
	}else{
	$conversion=" ";
	$campo=" ";
	$tabla=" ";
	$enlace=" ";
	}	 
	
	
			  
$sql="SELECT det_mov.cod_cab,det_mov.tipo, det_mov.fechad, cab_mov.cod_ope, cab_mov.tienda, cab_mov.Num_doc, cab_mov.serie, cab_mov.fecha, cliente.razonsocial, det_mov.precio, det_mov.cantidad as cantidad,det_mov.unidad, if( det_mov.flag_kardex ='1', det_mov.precosto*det_mov.cantidad, 0 ) AS 'Costo'" .$conversion ."".$campo."
 FROM det_mov, cab_mov, cliente, operacion".$tabla."
WHERE cab_mov.sucursal = '$sucursal'
".$filtrocab."
AND cab_mov.cod_ope = operacion.codigo".$enlace."
AND cab_mov.cliente = cliente.codcliente
and cab_mov.tipo=operacion.tipo 
AND det_mov.cod_cab = cab_mov.cod_cab
AND det_mov.cod_prod = '".$rowreporte['cod_prod']."'  
AND substring(det_mov.fechad,1,10) between '".$fecha1."' and '".$fecha2."'  
and flag_r<>'RA' and flag<>'A'
and det_mov.cod_ope in('".$filtrodocs."')
and det_mov.tienda in(".$filtroTiendas.")  
and det_mov.cantidad>0
ORDER BY cod_prod ASC ";
 $resultadodetalle = mysql_query($sql,$cn);  
//and det_mov.cantidad >0

//echo $sql;

$totales=0;
$totales2=0;

	while($rowdetalle=mysql_fetch_array($resultadodetalle)){ 

	 if($presentacion=='V' && $valorizar !='Origen'){	 
	 $total_valor=($rowdetalle['VentaSoles']+$rowdetalle['VentaDolares']);	 
	 $sub_valor=($rowdetalle['VentaSoles']+$rowdetalle['VentaDolares']);
	 $costosub=$rowdetalle['Costo'];
	 $costoclas=$rowdetalle['Costo'];
	 $clas_valor=($rowdetalle['VentaSoles']+$rowdetalle['VentaDolares']);
	 $costocat=$rowdetalle['Costo'];
	 $cat_valor=($rowdetalle['VentaSoles']+$rowdetalle['VentaDolares']);	 
	 }
	 $cantidad=" ";
	 $cantidad2=" ";
	 	//echo  $rowreporte['und']."-".$rowdetalle['unidad'];
	  if($rowdetalle['tipo']=='1'){
	  
	  if ($rowreporte['und']!=$rowdetalle['unidad']){			
			$strSQL_unid="select * from unixprod where producto='".$rowreporte['cod_prod']."' and unidad='".$rowdetalle['unidad']."'";
			//echo $strSQL_unid;
			$resultado_unid=mysql_query($strSQL_unid,$cn);
			$row_unid=mysql_fetch_array($resultado_unid);
			//echo "fact".$rowdetalle['cantidad']."-".$row_unid['factor'];
				$cantidad=$rowdetalle['cantidad'] * $row_unid['factor'];
				//$factorSub=$row_unid['factor'];
			}else{
				$cantidad=$rowdetalle['cantidad'] ;
			}
			 
	  
	  
	 //$cantidad=$rowdetalle['cantidad'] ;
	 $totales=$totales+$cantidad;
	 
	 $sub1=$rowdetalle['cantidad'];
	 $totalessub=$totalessub+$sub1;
	 
	 $clasif=$rowdetalle['cantidad'];
	  $totalesclas=$totalesclas+$clasif;
	  
	 $categ=$rowdetalle['cantidad'];
	 $totalescat=$totalescat+$categ;
	 
	 }else{
	 
	 $cantidad2=$rowdetalle['cantidad'] ;
	  $totales2=$totales2+$cantidad2;
	  
	 $sub2=	$rowdetalle['cantidad'];
	 $totales2sub=$totales2sub+$sub2;
	 
	 $clasif2=$rowdetalle['cantidad'];
	  $totales2clas=$totales2clas+$clasif2; 
	 
	 $categ2=$rowdetalle['cantidad'];
	  $totales2cat=$totales2cat+$categ2;
	 $sub1=0;	
	 $categ=0;
	 $clasif=0;
	 	 }	 
		 
 ?>
          <tr>
            <td width="42" align="left" class="Estilo28"><span class="Estilo45"><?php echo $rowdetalle['tienda'] ?></span></td>
            <td width="61" align="left" class="Estilo28"><span class="Estilo45"><?php echo formatofecha(substr($rowdetalle['fechad'],0,10)) ?></span></td>
            <td width="96" align="left" class="Estilo28"><span class="Estilo45"><?php echo $rowdetalle['cod_ope']."   ".$rowdetalle['serie']." ".$rowdetalle['Num_doc']?></span></td>
            <td width="82" align="left" class="Estilo28">
			
			<?php 
			
			list($cod_cabRef)	=	mysql_fetch_array(mysql_query("select cod_cab_ref from referencia where cod_cab='".$rowdetalle['cod_cab']."'"));
		
		
		list($cod_cabRef,$serieRef,$numeroRef)	=	mysql_fetch_array(mysql_query("select cod_ope,serie,Num_doc from cab_mov where cod_cab='".$cod_cabRef."'"));
		
		echo $cod_cabRef." ".$serieRef." ".$numeroRef;
			
			?>			</td>
            <td width="104" align="left" class="Estilo28">
			
			<?php 
			
			list($cod_cabRef)	=	mysql_fetch_array(mysql_query("select cod_cab from referencia where cod_cab_ref='".$rowdetalle['cod_cab']."'"));
		
		
			list($cod_cabRef,$serieRef,$numeroRef)	=	mysql_fetch_array(mysql_query("select cod_ope,serie,Num_doc from cab_mov where cod_cab='".$cod_cabRef."'"));
			
			echo $cod_cabRef." ".$serieRef." ".$numeroRef;
			
			?>			</td>
            <td width="30" align="left" class="Estilo28"><span class="Estilo45"><?php 
			$resultados11 = mysql_query("select * from unidades where id='".$rowdetalle['unidad']."' ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			echo $row11['nombre'];			
			}
			
			//echo $rowdetalle['unidad'] ?></span></td>
            <td width="156" align="left" class="Estilo28"><span class="Estilo45"><?php echo $rowdetalle['razonsocial'] ?></span></td>
			
            <td width="64" align="left"  class="Estilo28"><span class="Estilo45"><?php
			if ($cantidad==''){ $cantidad='0'; }
					if($filtroMov=="1"){ echo $cantidad; }elseif($filtroMov=="1,2"){echo $cantidad; }?></span></td>
            <td width="65" align="left" class="Estilo28"><span class="Estilo45">
              <?php 
			  if ($cantidad2==''){ $cantidad2='0'; }
			        if($filtroMov=="2"){ echo $cantidad2; } elseif($filtroMov=="1,2"){ echo $cantidad2 ; } ?>
            </span></td>
            <?php
					 //echo $presentacion;
		 if($presentacion=='V'){
			 if($formato=='D' && $valorizar!='Origen'){
			 echo "  <td bgcolor='#FFFFFF' class='Estilo28'>";
          if($filtroMov=="1" || $filtroMov=="1,2"){
		  echo $rowdetalle['Costo'] ;
		  }
		  echo "</td>";
					 
			 echo "<td bgcolor='#FFFFFF' class='Estilo28'>";
			  if($filtroMov=="2" || $filtroMov=="1,2"){
			  echo number_format($total_valor,2)  ;
			  } 
			  echo "</td>";
			  
			  }
			  if($formato=='D' && $valorizar=='Origen'){
			  
			 echo "  <td  style='border=' bgcolor='#FFFFFF' width='80px' class='Estilo28'>".$rowdetalle['simbolo']." </td>";
			 
			 echo "  <td bgcolor='#FFFFFF' width='60px' class='Estilo28'>";
			  if($filtroMov=="1" || $filtroMov=="1,2"){
			  echo $rowdetalle['Costo'] ;
			  } 
			  echo "</td>";
					 
			 echo "  <td bgcolor='#FFFFFF'width='60px'  class='Estilo28'>";
			  if($filtroMov=="2" || $filtroMov=="1,2"){
			  echo $rowdetalle['venta'] ; 
			  } 
			  echo " </td>";
			 
			  }
		 }else{
		 }
           
			  ?>
          </tr>
          <?php		
	   ///SUMANDO CONVERSIONES
	   if($presentacion=='V' && $valorizar!='Origen'){
	    //total del costo valorizado--ingresos
		$totalescostosub=$totalescostosub+$costoSub;
	   //total del importe valorizado---salidas
	   $sub_valorizado= $sub_valorizado+$sub_valor;
	   
	   $totalescostoclas=$totalescostoclas+$costoclas; //total del costo valorizado--ingresos
	   $clas_valorizado= $clas_valorizado+$clas_valor; //total del imp valorizado---salidas
	   
	   $totalescostocat=$totalescostocat+$costocat;
	   $cat_valorizado= $cat_valorizado+$cat_valor;
	    ///////////

	   
			}
			////
				  }
			   echo "
    <tr class='Estilo28' style='padding-top:5px;'>
      <td ></td>
      <td ></td>
      <td ></td>
	  <td ></td>
      <td  align='right' style='padding-right:10px' >Totales:</td>
      <td align='left'>";
        if($filtroMov==1 || $filtroMov=="1,2"){ 
        echo $totales."</td>
      "; 				
      }
      echo "
        <td  align='left'>";
          
          if($filtroMov==2 || $filtroMov=="1,2"){
          echo $totales2; 
          } 
          echo "</td></tr>";
				 
				 $totales=0;
				 $totales2=0;
				 $total_valor=0;
				 ///////////////////////////////////////////
				 
				 //echo 
				
		
			 
 ?>
        </table></td>
      </tr>
      <tr>
        <td colspan="5" bgcolor="#FFFFFF"></td>
      </tr>
      <?php 
  $cont++;
 }
//PIE DE PAGINA
 if($agr_sub=='S'){
	   if($subcat2!='999'){
				//echo "si diferente";
			   	 echo "<tr style='color:#FF0000 ; font:bold ; font:Arial, Helvetica, sans-serif;font-size:12px' class='Estilo28'>
				 <td colspan='2' align='right' width='280' > Total ".$subcat2.":</td>
				 <td align='left' width='20'>  ";
				 if($filtroMov=="1" || $filtroMov=="1,2"){
				 echo $totalessub;
				 } else { echo "       " ; }     
				 echo "</td>";
	             echo "<td align='left' width='60'> ";
				 if($filtroMov=="2" || $filtroMov=="1,2"){
				 echo $totales2sub;
				 }
				 echo "</td>";
				 
					 if($presentacion=='V' && $valorizar!='Origen'){				 
					 echo" <td align='left' width='50'>  ";
					 if($filtroMov=="1" || $filtroMov=="1,2"){ 
					 echo $totalescostosub;
					 }
					 echo "</td>";
					 echo "<td align='left' width='60'>  ";
					 if($filtroMov=="2" || $filtroMov=="1,2"){
					 echo number_format($sub_valorizado,2);
					 }
					 echo "</td>";
				
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
		
			  	 echo"<tr style='color:#003399; font:bold; font:Arial, Helvetica, sans-serif; font-size:12px' class='Estilo28'>
				 <td colspan='2' align='right' width='280'> Total ".$cat2."</td>
				 <td  align='left'>  ";
				  if($filtroMov=="1" || $filtroMov=="1,2"){
				  echo $totalescat."</td>";
				  }
				 echo "<td align='left'> ";
				  if($filtroMov=="2" || $filtroMov=="1,2"){
				 echo  $totales2cat."</td>";
				 }
				 ///
				 if($presentacion=='V' && $valorizar!='Origen'){
				 echo " <td align='left'> " ;
				  if($filtroMov=="1" || $filtroMov=="1,2"){
				  echo $totalescostocat."</td>";
				  }
				 echo "<td align='left'> ";
				  if($filtroMov=="2" || $filtroMov=="1,2"){
				  echo number_format($cat_valorizado,2)."</td>";
				   }
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
			   <td colspan='2' align='right'> Total ".$clas2."</td>
			   <td align='left'>" ;
			    if($filtroMov=="1" || $filtroMov=="1,2"){
				echo $totalesclas;
				}
				echo "</td>";
			   echo "<td align='left'> ";
			    if($filtroMov=="2" || $filtroMov=="1,2"){
				echo $totales2clas;			   ///
			   }
			   echo "</td>";
			  if($presentacion=='V' && $valorizar!='Origen') {
			  echo"<td  align='left'> ";
			   if($filtroMov=="1" || $filtroMov=="1,2"){
			   echo $totalescostoclas."</td>";
			   }
			  echo "<td align='left'> ";
			   if($filtroMov=="2" || $filtroMov=="1,2"){
			   echo number_format($clas_valorizado,2)."</td>";
			   }
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
    </table></td>
  </tr>
  <tr>
    <td colspan="4" valign="top"></td>
  </tr>
  <tr>
    <td colspan="4" valign="top"></td>
  </tr>
  <tr>
    <td colspan="4" valign="top">
	
	<? if($_REQUEST['excel']!="S"){ ?>
	<table width="100%" height="21" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="311" height="21" align="left" valign="bottom" style="color:#999999"><span class="Estilo29">Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (de <strong><?php echo $total_registros?></strong> productos)</span>.</td>
        <td width="526" align="right" valign="bottom" style="color:#999999"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:13px">
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
var chk_tiendas=document.form1.chk_tiendas.value;
var chkIngresos=document.form1.chkIngresos.value;
var chkSalidas=document.form1.chkSalidas.value;
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
	document.form1.action="rpt_det_movifecha.php"+htmlreporte;
	document.form1.submit();	

}
</script>

</body>
</html>
