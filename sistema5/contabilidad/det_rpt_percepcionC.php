<?php 
//session_start();
?>
<?php 
include('../conex_inicial.php');
include('../funciones/funciones.php');

//PAGINACION 1	
		 $registros = 50; 
		 $pagina = $_REQUEST['pagina']; 
			   
		//echo $pagina;

		if ($pagina==''){ 
		$inicio = 0; 
		$pagina = 1; 
		} 
		else { 
		$inicio = ($pagina - 1) * $registros; 
		} 
		//------------------------------------------
function extraefecha_tc($valor){
	$afecha=explode('-',trim($valor));
	$afecha2=explode(' ',trim($afecha[2]));
	$nfecha=$afecha2[0]."/".$afecha[1]."/".$afecha[0];
	return $nfecha;
}

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
//echo $chk_tiendas;
$chkIngresos=$_GET['chkIngresos'];
$chkSalidas=$_GET['chkSalidas'];
$radiobutton=$_GET['radiobutton'];

	$agr_cla=$_REQUEST['agr_cla'];
	$agr_cat=$_REQUEST['agr_cat']; 
	$agr_sub=$_REQUEST['agr_sub']; 
	$mov=$_REQUEST['cmbmov'];
	
	$moneda=$_REQUEST['moneda'];
	
	$sucursal=$_REQUEST['sucursal'];
	
	$cmbclasificacion=$_REQUEST['cboclasifica'];
	$cmbcategoria=$_REQUEST['cbocateg'];
	$cmbsub_categoria=$_REQUEST['cbosubcateg'];
	$chkAgruparClas=$_REQUEST['chkAgruparClas'];
	$chkAgruparCat=$_REQUEST['chkAgruparCat'];
	$chkAgruparSub=$_REQUEST['chkAgruparSub'];
	
	$aplicacion=$_REQUEST['aplicacion'];
	
	//echo $aplicacion;
	
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
.Estilo46 {font-size: 16px}
.Estilo47 {
	font-family: Arial, Helvetica, sans-serif;
	color: #666666;
	font-size: 11px;
}
.Estilo48 {
	color: #666666;
	font-size: 11px;
}
.Estilo54 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo55 {font-size: 11px}
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

<table border="0" width="100%" align="center" cellpadding="0" cellspacing="0">
  
  <tr>
    <td align="right"><span class="Estilo28"><span class="Estilo27">Fecha</span>:<?php echo date('d-m-Y')?></span></td>
    </tr>
  <tr>
    <td align="right"><span class="Estilo28"><span class="Estilo27">Hora:<?php echo date('H:i:s A')?></span></span></td>
    </tr>
  <tr>
    <td align="left"><div align="center" style='color:#000000;font-size:14px;font-family:Arial, Helvetica, sans-serif'>
      <span ><b>REGISTRO DE PERCEPCIONES</b> </span>
    </div></td>
  </tr>
  <tr>
    <td align="center"><span class="Estilo28"><span class="Estilo27"><span class="Estilo4">
      <?php 
	
	$sql="Select * from sucursal where cod_suc='$sucursal'";
	//echo $sql;
	$query=mysql_query($sql,$cn);
	
	
	while($row=$resultado=mysql_fetch_array($query)){
	echo $row['des_suc']." / ".$row['ruc'];	
	
	}
	?>
    </span></span></span></td>
  </tr>
  <tr>
    <td align="center"><span class="Estilo28"><span class="Estilo27">De:&nbsp;</span><?php echo $fecha1;?><span class="Estilo27">&nbsp;&nbsp;&nbsp;&nbsp;Al:&nbsp;</span><?php echo $fecha2;?></span></td>
  </tr>
  <tr>
    <td align="center"><span class="Estilo28"><span class="Estilo27">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Formato:
          <?php 
	  if($formato=='1') echo "Tipo de Documento";
	  if($formato=='2') echo "Fecha de Documento";
	  if($formato=='3') echo "Razon social";
	  ?>
&nbsp;&nbsp;&nbsp;&nbsp;</span></span></td>
  </tr>
  
  
  
  <tr>
    <td align="center">
    <table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <tr>
        <td colspan="14"  align="left" valign="baseline" class="Estilo16">
		
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
// echo "".$tiendas['cod_tienda']. "-".$tiendas['des_tienda']." <|> " ;
//	 echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$tiendas['des_tienda'] ;
	}
	?>		</td>
                 </tr>
      <tr>
        <td width="3%"   align="left" valign="top" bgcolor="#03B1E4" class="Estilo16">&nbsp;</td>
        <td width="4%"   align="center" valign="middle" bgcolor="#03B1E4" class="Estilo16">TD</td>
        <td width="7%"   align="center" valign="middle" bgcolor="#03B1E4" class="Estilo16">Doc.</td>
        <td width="8%"   align="center" valign="middle" bgcolor="#03B1E4" class="Estilo16">Emisi&oacute;n</td>
        <td width="8%"   align="center" valign="middle" bgcolor="#03B1E4" class="Estilo16">Cond.</td>
        <td width="12%"   align="center" valign="middle" bgcolor="#03B1E4" class="Estilo16">Cliente</td>
        <td width="6%"   align="center" valign="middle" bgcolor="#03B1E4" class="Estilo16">Ruc/DNI</td>
        <td width="18%"   align="center" valign="middle" bgcolor="#03B1E4" class="Estilo16">Bienes</td>
        <td width="5%"   align="center" valign="middle" bgcolor="#03B1E4" class="Estilo16">Comp. Percep </td>
        <td width="7%"   align="center" valign="middle" bgcolor="#03B1E4" class="Estilo16">Monto Transac. </td>
        <td width="3%"   align="center" valign="middle" bgcolor="#03B1E4" class="Estilo16">%</td>
        <td width="6%"   align="center" valign="middle" bgcolor="#03B1E4" class="Estilo16">Percepci&oacute;n</td>
        <td width="6%"   align="center" valign="middle" bgcolor="#03B1E4" class="Estilo16">Total</td>
        <td width="7%"   align="center" valign="middle" bgcolor="#03B1E4" class="Estilo16">Observaciones</td>
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

		
		$filtrodocs2="''";
	//	echo count($cod_doc_s);	
	//--rk
		$cod_doc_s=explode("|",$chkSalidas);
		for($i=0;$i<count($cod_doc_s);$i++){
		//echo $cod_doc_s[$i];
			if($i==0){
				$filtrodocs2=$cod_doc_s[$i];
			}else{
				$filtrodocs2=$filtrodocs2."','".$cod_doc_s[$i];
			}
		 //$filtrodocs=$filtrodocs.",'".$cod_doc_s[$i]."'";
		}
	
	//echo $filtrodocs2;
	
	 if($formato=='1'){
	 $filtro_orden=" cod_ope asc,cm.fecha asc ";
	 //$separador="cod_ope";
	 
	 } 
	 if($formato=='2'){
	 $filtro_orden=" cm.fecha asc ";
	
	 } 
	 if($formato=='3'){
	  $filtro_orden=" c.razonsocial asc ";
	} 

	 $strSQL="select cm.*,co.nombre as nomcondi,c.razonsocial as razon,c.ruc as nruc,c.doc_iden as ndni, o.descripcion as desDoc,cm.fecha as fechaDoc, c.codcliente as codcliente from cab_mov cm, cliente c, operacion o,condicion co , det_mov dm
	 where cm.cod_ope = o.codigo
	AND cm.cod_cab=dm.cod_cab  
	AND cm.condicion=co.codigo 
    AND cm.cliente = c.codcliente     
	and co.codigo in ('".$filtrodocs2."')
     and cm.tipo in('".$aplicacion."') and cm.cod_ope in('".$filtrodocs."') and cm.sucursal='".$sucursal."' and cm.tienda in(".$filtroTiendas.")  
	 and  substring(cm.fecha,1,10) between '".$fecha1."' and '".$fecha2."'  
	 and  flag<>'A' and dm.nom_prod like '%PERCEPCION COMPRA%'  order by $filtro_orden ";	

		
	
//---------------------------------------------------------------------------------------	 
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
	$j=0;
	$codDocTemp="";
	while($rowreporte=mysql_fetch_array($resultadoreporte)){ 
			if($j%2==0){
			
			$colorTD="#F4F4F4";
			}else{
			$colorTD="#FFFFFF";
			}
			
			if($formato=='1'){
				if($codDocTemp!=$rowreporte['cod_ope']){			
				echo "<tr><td colspan='10' align='left' style='color:#FF0000'><span class='Estilo54'>".$rowreporte['cod_ope']."  ".$rowreporte['desDoc']."</span></td></tr>";																							
				}				
			$codDocTemp=$rowreporte['cod_ope'];			
			}
			if($formato=='2'){
				if($codDocTemp!=substr($rowreporte['fechaDoc'],0,10)){			
				echo "<tr><td colspan='10' align='left' style='color:#FF0000'><span class='Estilo54'>".substr($rowreporte['fechaDoc'],0,10)."</span></td></tr>";																							
				}
			$codDocTemp=substr($rowreporte['fechaDoc'],0,10);			
			}
			if($formato=='3'){
				if($codDocTemp!=$rowreporte['codcliente']){			
				echo "<tr><td colspan='10' align='left' style='color:#FF0000'><span class='Estilo54'>".$rowreporte['razon']."</span></td></tr>";																							
				}
			$codDocTemp=$rowreporte['codcliente'];			
			}
			
		
			
	  $j++;	
	 ?>
      <tr >
        <td  style="background:<?php echo $colorTD?>" height="19"  align="center" bgcolor="#FFFFFF"><span class="Estilo55">
		<img style="cursor:pointer" alt="" onClick="doc_det('<?php echo $rowreporte['cod_cab'];?>')" src="../imagenes/ico_lupa.png" width="15" height="15">
		</span></td>
        <td style="background:<?php echo $colorTD?>"  align="center" bgcolor="#FFFFFF"><span class="Estilo54"><?php echo $rowreporte['cod_ope']; ?></span></td>
        <td  style="background:<?php echo $colorTD?>" align="center" bgcolor="#FFFFFF"><span class="Estilo54"><?php echo $rowreporte['serie']."-".$rowreporte['Num_doc']; ?></span></td>
        <td style="background:<?php echo $colorTD?>"  align="center" bgcolor="#FFFFFF"><span class="Estilo54"><?php echo formatofecha(substr($rowreporte['fecha'],0,10)); ?></span></td>
        <td  style="background:<?php echo $colorTD?>" align="center" bgcolor="#FFFFFF"><span class="Estilo54"><?php echo $rowreporte['nomcondi']; ?></span></td>
        <td  style="background:<?php echo $colorTD?>" align="left" bgcolor="#FFFFFF"><span class="Estilo54"><?php echo $rowreporte['razon']; ?></span></td>
        <td style="background:<?php echo $colorTD?>"  align="left" bgcolor="#FFFFFF"><span class="Estilo54"><?php 
		
		if($rowreporte['nruc']!=''){
			echo $rowreporte['nruc'];
		}else{
			echo $rowreporte['ndni'];
		}
		
		?></span></td>
        <td  style="background:<?php echo $colorTD?>" align="left" bgcolor="#FFFFFF"><span class="Estilo54"><?php 
				
				$i=0;
				$montoTrans=0;
				
				//echo $rowreporte['moneda'];
				$totalPerc=0;
				
				$strSQL4="select * from producto p,det_mov d where d.cod_prod=p.idproducto and d.cod_cab='".$rowreporte['cod_cab']."' and p.nombre like '%PERCEPCION COMPRA%' ";
				$resultado4=mysql_query($strSQL4,$cn); 
				while($rowX=mysql_fetch_array($resultado4)){
				
				//echo 
				
					if($rowreporte['moneda']=='02'){
			
						$strSQLTC="select * from tcambio where fecha='".extraefecha_tc($rowreporte['fecha'])."'"; 
						
						//echo $strSQLTC;
						$resultadoTC=mysql_query($strSQLTC,$cn);
						$rowTC=mysql_fetch_array($resultadoTC);
						
						$imp_percepcion=$rowreporte['percepcion']*$rowTC['compra'];
						$imp_item=$rowX['imp_item']*$rowTC['compra'];
						
					}else{
						$imp_percepcion=$rowreporte['percepcion'];
						$imp_item=$rowX['imp_item'];
						
					}	
					
		
					if($i==0){
					echo substr($rowX['nom_prod'],0,20);
					$porcen_percep= $rowX['porcen_percep'];
					}else{
					echo "<br>".substr($rowX['nom_prod'],0,20);
					}
					
					$montoTrans=$montoTrans+$imp_item;
					
					$i++;
				
					//if(substr($rowX['nom_prod'],0,17)=='PERCEPCION COMPRA'){
					$totalPerc+=$rowX['imp_item'];
					//}
				
				}
				
				
				if($rowreporte['flag_r']=='RA'){
						
					$strSQL_ref="select * from referencia where cod_cab='".$rowreporte['cod_cab']."'";
					$resultado_ref=mysql_query($strSQL_ref,$cn);
					$row_ref=mysql_fetch_array($resultado_ref);
										
					$cod_cab_ref=$row_ref['cod_cab_ref'];					
					
					$strSQL_ref2="select * from cab_mov where cod_cab='".$cod_cab_ref."'";
					$resultado_ref2=mysql_query($strSQL_ref2,$cn);
					$row_ref2=mysql_fetch_array($resultado_ref2);							
					$montoTrans=$row_ref2['total'];	
					$cod_ope_ref=$row_ref2['cod_ope'];					
					$serie_ref=$row_ref2['serie'];					
					$numero_ref=$row_ref2['Num_doc'];
				
				}else{				
				$montoTrans=$rowreporte['total']-$totalPerc;				
				}
					
					
		$montoPercT+=$totalPerc;					
		//echo $rowreporte['nom_prod']; 
		
		?></span></td>
        <td  style="background:<?php echo $colorTD?>" align="left" bgcolor="#FFFFFF"><span class="Estilo54"><?php echo $cod_ope_ref." ".$serie_ref."-".$numero_ref?></span></td>
        <td  style="background:<?php echo $colorTD?>" align="right" bgcolor="#FFFFFF"><span class="Estilo54"><?php echo number_format($montoTrans,2); ?></span></td>
        <td  style="background:<?php echo $colorTD?>" align="center" bgcolor="#FFFFFF"><span class="Estilo54"><?php echo "2 %"; ?></span></td>
        <td  style="background:<?php echo $colorTD?>" align="right" bgcolor="#FFFFFF"><span class="Estilo54"><?php echo number_format($totalPerc,2); ?></span></td>
        <td  style="background:<?php echo $colorTD?>" align="right" bgcolor="#FFFFFF"><span class="Estilo54"><?php echo number_format($montoTrans+$totalPerc,2); ?></span></td>
        <td  style="background:<?php echo $colorTD?>" align="left" bgcolor="#FFFFFF"><span class="Estilo54"><?php echo $rowreporte['obs1']; ?></span></td>
      </tr>
     
      
      <?php 
  
 }
//PIE DE PAGINA
	  
	  
	  
 ?>
	  
	  <?php /*?>

if($total_paginas==$pagina || $_REQUEST['excel']=="S"){


 $strSQL="select cm.*,co.nombre as nomcondi,c.razonsocial as razon,c.ruc as nruc, o.descripcion as desDoc,cm.fecha as fechaDoc, c.codcliente as codcliente from cab_mov cm, cliente c, operacion o,condicion co, det_mov dm   where cm.cod_ope = o.codigo
	 AND cm.cod_cab=dm.cod_cab  
	 AND cm.condicion=co.codigo 
     AND cm.cliente = c.codcliente     
	 and co.codigo in ('".$filtrodocs2."')
     and cm.tipo in('1') and cm.cod_ope in('".$filtrodocs."') and cm.sucursal='".$sucursal."' and cm.tienda in(".$filtroTiendas.")  
	 and  substring(cm.fecha,1,10) between '".$fecha1."' and '".$fecha2."'  
	 and dm.nom_prod like '%PERCEPCION COMPRA%' and flag<>'A' order by $filtro_orden  ";	

//---------------------------------------------------------------------------------------	 
 	//echo $strSQL."<br>";
	$resultados = mysql_query($strSQL ,$cn);
	while($rowreporte=mysql_fetch_array($resultados)){ 
	
	
				$i=0;
				$montoTrans=0;
				$strSQL4="select * from producto p,det_mov d where p.agente_percep='S' and d.cod_prod=p.idproducto and d.cod_cab='".$rowreporte['cod_cab']."' ";
				$resultado4=mysql_query($strSQL4,$cn); 
				while($rowX=mysql_fetch_array($resultado4)){
				
					if($i==0){
					//echo substr($rowX['nom_prod'],0,20);
					$porcen_percep= $rowX['porcen_percep'];
					}else{
					//echo "<br>".substr($rowX['nom_prod'],0,20);
					}
					
					$montoTrans=$montoTrans+$rowX['imp_item'];
					
				$i++;
				}
				
				
				$montoPercT=$montoPercT+$rowreporte['percepcion'];
				$montoTransT=$montoTransT+$montoTrans;			
				$totalGeneral=$totalGeneral+($montoTrans+$rowreporte['percepcion']);												
				
	}	
	
	//echo "<tr><td colspan='14' align='right' style='color:#000000;font-size:14px;font-family:Arial, Helvetica, sans-serif'><strong><br><br>TOTAL GENERAL: ".number_format($totalGeneral,2)."</strong></td></tr>";	
	
	//echo $totalGeneral;
	


  <?php } ?>
 <?php */?>
  <tr style='color:#000000;font-size:12px;font-family:Arial, Helvetica, sans-serif'>
        <td height="19" colspan="9"  align="center" bgcolor="#DDDDDD"  style="background:<?php echo $colorTD?> font-weight: bold; font-weight: bold;">TOTAL GENERAL</td>
        <td  style="font-weight: bold" align="right" bgcolor="#DDDDDD">&nbsp;</td>
        <td  style="font-weight: bold" align="center" bgcolor="#DDDDDD">&nbsp;</td>
        <td  style="font-weight: bold" align="right" bgcolor="#DDDDDD"><?php echo number_format($montoPercT,2)?></td>
        <td  style="font-weight: bold" align="right" bgcolor="#DDDDDD">&nbsp;</td>
        <td  style="background:<?php echo $colorTD?>" align="left" bgcolor="#DDDDDD">&nbsp;</td>
      </tr>
 

 
 
    </table></td>
  </tr>
  <tr>
    <td valign="top"  style="font-family:Arial, Helvetica, sans-serif" ></td>
  </tr>
  <tr>
    <td valign="top"></td>
  </tr>
  <tr>
    <td valign="top">
	
	<? if($_REQUEST['excel']!="S"){ ?>
	<table width="100%" height="21" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="311" height="21" align="left" valign="bottom" style="color:#999999"><span class="Estilo29 Estilo47">Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (de <strong><?php echo $total_registros?></strong> productos)</span><span class="Estilo47">.</span></td>
        <td width="526" align="right" valign="bottom" style="color:#999999"><span class="Estilo48" style="font-family: Arial, Helvetica, sans-serif"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:13px">
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
			</span></td>
      </tr>
    </table>
	<? } ?>	</td>
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
	document.form1.action="det_rpt_percepcion.php"+htmlreporte;
	document.form1.submit();	

}


function doc_det(valor){

window.open("../doc_det2.php?referencia="+valor,"","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=320,left=300 top=250");

}


</script>

</body>
</html>
