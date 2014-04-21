<?php 
//session_start();
include('../conex_inicial.php');
include('../funciones/funciones.php');
if($_REQUEST['excel']=="S"){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=excel.xls");
}		
?>
<?php
$registros = 30; 
// $pagina = $_REQUEST['pagina'];
$pagina='';
		    
if ($pagina=='') { 
	$inicio = 0; 
	$pagina = 1; 
} else {
	$inicio = ($pagina - 1) * $registros; 
} 
$mostrar=$_POST['mostrar'];
if($mostrar=='SUCURSALES'){
	$check=$_POST['checkbox'];
	$condiciom='dt.sucursal';
}
if($mostrar=='LOCALES POR SUCURSAL'){
	$check=$_POST['chk_tiendas'];
	$condiciom='dt.tienda';
}
if($mostrar=='TODOS LOS LOCALES'){ //ALMACENES
	$check=$_POST['chktds_alma'];
	//echo ($check[0].$check[1].$check[2]);
	$condiciom='dt.tienda';
}

//$sucursal=$_POST['mostrar'];
if($mostrar=='SUCURSALES'){
	$sucursal=$_POST['checkbox'];
	$sucursales=mysql_fetch_array(mysql_query("Select * from sucursal where cod_suc='$sucursal'" ));
//echo $sucursales;
}
?>
<?php
$tienda=$_POST['tienda'];
$fecha1=$_POST['fecha1'];
$fecha2=$_POST['fecha2'];
$formato=$_POST['cboformato'];
$presentacion=$_POST['cmbPres'];
$valorizar=$_POST['cmbValor'];
$ordenar=$_REQUEST['txtorden'];
/*$_POST['cmboordenar'];*/

$cmbclas=$_POST['cmbclas'];
$cmbcat=$_POST['cmbcat'];
$cmbsub=$_POST['cmbsub'];
$chkclas=$_POST['chkclas'];
$chkcat=$_POST['chkcat'];
$chksub=$_POST['chksub'];
$cbosucursal=$_POST['cbosucursal'];

//---------------------
$agr_cla=$_POST['agr_cla'];
$agr_cat=$_POST['agr_cat'];
$agr_sub=$_POST['agr_sub'];
$cod_doc_i=$_REQUEST['chkIngresos'];
$cod_doc_s=$_REQUEST['chksalidas'];
//$check=$_POST['chk_tiendas'];
//echo $agr_cla."<b>";
//echo $agr_cat."<br>";
//echo $agr_sub."<br>";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>
<link href="css/webuserestilo.css" rel="stylesheet" type="text/css">
<link href="../styles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script language="javascript" src="miAJAXlib2.js"></script>

<style type="text/css">
<!--
.Estilo16 {color: #FFFFFF; font-weight: bold; font-size: 11px; font-family: Arial, Helvetica, sans-serif; }
.Estilo27 {color: #000000}
-->
</style>
<body onkeydown="GetChar (event);" >
<form name="form1" id="form1" method="">
<table width="896" height="429"  align="center">
<tr>
	<td colspan="2">
	<input type="hidden" name="mostrar2" value="<?php echo $mostrar;?>" id="mostrar2"/>
	<input type="hidden" name="checkbox" value="<?php $sucursal=$_POST['checkbox'];
	//$temp_suc='';
	for($i=0;$i<count($sucursal);$i++){
		$temp_suc=$temp_suc.$sucursal[$i].'-';
	}
	echo $temp_suc=substr($temp_suc,0,strlen($temp_suc)-1); ?>" id="checkbox"/>
	<input type="hidden" name="chk_tiendas" value="<?php  $tiendas=$_POST['chk_tiendas'];
	//$temp_tiendas='';
	for($i=0;$i<count($tiendas);$i++){
		$temp_tiendas=$temp_tiendas.$tiendas[$i].'-';
	}
	echo $temp_tiendas=substr($temp_tiendas,0,strlen($temp_tiendas)-1); ?>" id="chk_tiendas"/>
	<input type="hidden" name="chktds_alma" value="<?php  $tds_alma=$_POST['chktds_alma'];
	//$temp_tds_almas='';
	for($i=0;$i<count($tds_alma);$i++){
		$temp_tds_almas=$temp_tds_almas.$tds_alma[$i].'-';
	}
	echo $temp_tds_almas=substr($temp_tds_almas,0,strlen($temp_tds_alma)-1); ?>" id="chktds_alma"/>
	<input type="hidden" name="fecha1" value="<?php echo $fecha1?>" id="fecha1"/>
	<input type="hidden" name="fecha2" value="<?php echo $fecha2?>" id="fecha2"/>
	<input type="hidden" name="cboformato" value="<?php echo $formato?>" id="cboformato"/>
	<input type="hidden" name="cmbPres" value="<?php echo $presentacion?>" id="cmbPres"/>
	<input type="hidden" name="cmbValor" value="<?php echo $valorizar ?>" id="cmbValor"/>
	<input type="hidden" name="txtorden" value="<?php echo $ordenar;?>" id="txtorden"/>
	<input type="hidden" name="cmbclas" value="<?php echo $cmbclas ?>" id="cmbclas"/>
	<input type="hidden" name="cmbcat" value="<?php echo $cmbcat ?>" id="cmbcat"/>
	<input type="hidden" name="cmbsub" value="<?php echo $cmbsub?>" id="cmbsub"/>
	<input type="hidden" name="chkclas" value="<?php echo $chkclas ?>" id="chkclas"/>
	<input type="hidden" name="chkcat" value="<?php echo $chkcat ?>" id="chkcat"/>
	<input type="hidden" name="chksub" value="<?php echo $chksub?>" id="chksub"/>
	<input type="hidden" name="cbosucursal" value="<?php echo $cbosucursal?>" id="cbosucursal"/>
	<input type="hidden" name="agr_cla" value="<?php echo $agr_cla?>" id="agr_cla"/>
	<input type="hidden" name="Sistema" value="<?php echo $_POST["Sistema"]; ?>" id="Sistema">
	<input type="hidden" name="agr_cat" value="<?php echo $agr_cat?>" id="agr_cat"/>
	<input type="hidden" name="agr_sub" value="<?php echo $agr_sub?>" id="agr_sub"/>
	<input type="hidden" name="chkIngresos" value="<?php //$temp_cod_doc_i='';
	for($i=0;$i<count($cod_doc_i);$i++){
		$temp_cod_doc_i=$temp_cod_doc_i.$cod_doc_i[$i].'-';
	}
	echo $temp_cod_doc_i=substr($temp_cod_doc_i,0,strlen($temp_cod_doc_i)-1); ?>" id="chkIngresos"/>
	<input type="hidden" name="chkSalidas" value="<?php //$temp_cod_doc_s='';
	for($i=0;$i<count($cod_doc_s);$i++){
		$temp_cod_doc_s=$temp_cod_doc_s.$cod_doc_s[$i].'-';
	}
	echo $temp_cod_doc_s=substr($temp_cod_doc_s,0,strlen($temp_cod_doc_s)-1); ?>" id="chkSalidas"/>
	<table border="0" width="800px" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">&nbsp;</td>
		<td align="left">&nbsp;</td>
		<td align="right"><table width="120px" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="41" align="right" valign="top"><span class="Estilo27">Fecha</span>:</td>
			<td width="79"><?php echo date('d-m-Y')?></td>
		</tr>
		<tr>
			<td align="right"><span class="Estilo27">Hora:</span></td>
			<td><?php echo date('H:i:s A')?> </td>
		</tr>
		</table></td>
	</tr>
	<tr>
		<td colspan="4" align="center"><span class="Estilo27">
		<strong>COMPARATIVO DE PRODUCTOS ENTRE LOCALES</strong></span></td>
	</tr>
	<tr>
		<td colspan="4" align="center"><?
		if ($formato ==3){
			echo '<span class="Estilo27"> Stock entre Almacenes </span>';			
		}else{
			echo 'Del </span> '.$fecha1.'<span class="Estilo27"> al </span>'.$fecha2.'';
		}
		?></td>
	</tr>
	<tr>
		<td colspan="4" align="left" class="Estilo27"><br>COMPARATIVO ENTRE <span class="Estilo4"><?php echo $mostrar."&nbsp;&nbsp;"?>
		<?php 
		$filtrosuc="''";
		if($mostrar=='SUCURSALES'){
			$sucursal=$_POST['checkbox'];
			for($i=0;$i<count($sucursal);$i++){
				$filtrosuc=$filtrosuc.",'".$sucursal[$i]."'";
			}
			$query="Select * from sucursal where cod_suc in (".$filtrosuc.")";
			$res=mysql_query($query,$cn);
			while($row=mysql_fetch_array($res)){
				$des_sucu=$row['cod_suc'].' - '.$row['des_suc'];
				echo $des_sucu."&nbsp;&nbsp;";
			}
		}else{
			if ($cbosucursal!="-1") {
				$sql="SELECT * FROM sucursal where cod_suc='".$cbosucursal."'";
				$rs=mysql_query($sql,$cn);
				while ($reg=mysql_fetch_array($rs)){
					$des_sucu="(".$reg["des_suc"].")";
				}
			}else{
				$des_sucu='';
			}
			echo $des_sucu."&nbsp;&nbsp;";
		}?>
		</span></td>
	</tr>
	<tr>
		<td colspan="4" align="left"><span class="Estilo27">
		<?php 
		//if(count($check)>0){
		$filtroTiendas="''";
		for($i=0;$i<count($check);$i++){
			$filtroTiendas=$filtroTiendas.",'".$check[$i]."'";
		}
		//}
		/*$filtroTiendas="''";
		$chk_tiendas=explode("|",$chk_tiendas);
		echo $chk_tiendas[0];
		for($i=0;$i<count($chk_tiendas);$i++){
			$filtroTiendas=$filtroTiendas.",'".$chk_tiendas[$i]."'";
		}*/
		//cod_suc ='$sucursal' AND 
		$SQLF="SELECT * FROM tienda WHERE  cod_tienda in(". $filtroTiendas.") ";
		$resultado=mysql_query($SQLF,$cn);
		//$resTotal=mysql_fetch_row($resultado);
		$resTotal=mysql_num_rows($resultado);
		//echo '('.$resTotal.')';

		if ($resTotal<>''){
			echo '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tiendas&nbsp; ';
		}
		while($tiendas=mysql_fetch_array($resultado)){
			echo "".$tiendas['cod_tienda']. "-".$tiendas['des_tienda']." <|> " ;
		}
		?></span></td>
	</tr> 
	<tr>
		<td width="197" align="left"><span class="Estilo27"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
		<td width="296" align="left">&nbsp;</td>
		<td width="67" align="left">&nbsp;</td>
		<td width="240" align="right"><table width="120px" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="69" align="right"><span class="Estilo27">Movimiento :</span></td>
			<td width="51"><span class="Estilo27"><span class="Estilo4">
			<?php 
			if($formato==3)
				echo "STOCK";//"SALDOS";
			if($formato==1)
				echo "INGRESOS";
			if($formato==2)
				echo "SALIDAS";
			?></span></span></td>
		</tr>
		</table></td>
	</tr>
	<tr>
		<td colspan="4" align="center">
		<div id="detalle"><table width="781" height="61" border="0" cellpadding="1" cellspacing="1">
		<tr>
			<td width="58" rowspan="2" align="center" bgcolor="#0066CC"><b style="color:#FFFFFF"><?php echo $_POST["Sistema"]; ?></b></td>
			<td width="149" rowspan="2" align="center" bgcolor="#0066CC"><b style="color:#FFFFFF">Nombre</b></td>
			<td width="31" rowspan="2" bgcolor="#0066CC" ><b style="color:#FFFFFF">Und.</b></td>
			<?php	
			/*if($mostrar=='SUCURSALES'){
				$titn='Sucursales';
			}else{
				$titn='Tiendas';				
			}*/
			if(count($check)>0){
				echo "<td colspan=".count($check)." align=center bgcolor=#0066CC> <b style=color:#FFFFFF>Tiendas</b></td>";
			}
			?>			
			<td width="50" rowspan="2" bgcolor="#0066CC" align="center" ><b style="color:#FFFFFF">Total</b></td>
		</tr>
		<tr>
			<?php			
			if(count($check)>0){
				for($i=0;$i<count($check);$i++){
					echo "<td bgcolor=#0066CC align=center><b style=color:#FFFFFF>".$check[$i]."&nbsp;</b></td>";
				}
			}		
			?>
		</tr>
		<?php
		if($cmbclas!="-1" || $cmbcat!="-1" || $cmbsub!="-1"){
			if($cmbclas!="-1"){
				$filtro1=" and p.clasificacion='$cmbclas' ";
			}
			if($cmbcat!="-1"){
				$filtro1=$filtro1. " and p.categoria='$cmbcat' ";
			}
			if($cmbsub!="-1"){
				$filtro1=$filtro1. " and p.subcategoria='$cmbsub' ";
			}
		}
		///////////////////////////////////////////////////////////////////////////////
		$agr_cla='N';
		$agr_cat='N';
		$agr_sub='N';
		if($agr_cla!='N' || $agr_cat!='N' || $agr_sub!='N'){
			if($agr_cla=='S' and $agr_cat=='S' and $agr_sub=='S'){
				$clas="999";
				//$clas2="999";
				$cat="999";
				//$cat2="999";
				$subcat="999";
		//$subcat2="999";
		$filtro2=" des_clas,des_cat,des_subcateg,";
		$filtro3=" and  p.clasificacion=cl.idclasificacion and p.categoria=ct.idcategoria and p.subcategoria=sc.idsubcategoria  ";
		$tablas=",clasificacion cl, categoria ct, subcategoria sc";
		$agrupar=" des_clas,des_cat,des_subcateg,";
		}else{
			if($agr_cla=='S' and $agr_cat=='S'){
				$clas="999";
				//$clas2="999";
				$cat="999";
				//$cat2="999";
				$subcat="";
				//$subcat2="999";
				$filtro2=" des_clas,des_cat, ";
				$filtro3=" and p.clasificacion=cl.idclasificacion and p.categoria=ct.idcategoria and	p.subcategoria!='000'  ";
				$tablas=",clasificacion cl, categoria ct ";
				$agrupar=" des_clas,des_cat,";
			}else{
				if($agr_cla=='S' and $agr_sub=='S'){
					$clas="999";
					//$clas2="999";
					$cat="";
					//$cat2="";
					$subcat="999";
					//$subcat2="999";
					$filtro2=" des_clas,des_subcateg, ";
					$filtro3=" and p.clasificacion=cl.idclasificacion and p.categoria!='000' and p.subcategoria=sc.idsubcategoria";
					$tablas=",clasificacion cl, subcategoria sc";
					$agrupar=" des_clas,des_subcateg,";
				}else{
					if($agr_cat=='S' and $agr_sub=='S'){
						$clas="";
						//$clas2="";
						$cat="999";
						//$cat2="999";
						$subcat="999";
						//$subcat2="999";
						$filtro2=" des_cat,des_subcateg, ";
						$filtro3=" and p.clasificacion!='000' and p.categoria=ct.idcategoria and	p.subcategoria=sc.idsubcategoria  ";
						$tablas=",categoria ct, subcategoria sc";
						$agrupar=" des_cat,des_subcateg,";
					}else{
						if($agr_cla=='S'){
							$clas="999";
							//$clas2="999";
							$cat="";
							//$cat2="";
							$subcat="";
							//$subcat2="";
							$filtro2=" des_clas, ";
							$filtro3=" and  p.clasificacion=cl.idclasificacion and p.categoria!='000' and p.subcategoria!='000'";
							$tablas=",clasificacion cl";
							$agrupar=" des_clas,";
						}else{
							if($agr_cat=='S'){
								$clas="";
								//$clas2="";
								$cat="999";
								//$cat2="999";
								$subcat="";
								//$subcat2="";
								$filtro2=" des_cat, ";
								$filtro3="and p.clasificacion!='000' and p.categoria=ct.idcategoria and p.subcategoria!='000'";
								$tablas=",categoria ct";
								$agrupar=" des_cat,";
							}else{
								if($agr_sub=='S'){
									$clas="";
									//$clas2="";
									$cat="";
									//$cat2="";
									$subcat="999";
									//$subcat2="999";
									$filtro2=" des_subcateg, ";
									$filtro3=" and p.clasificacion!='000' and p.categoria!='000' and p.subcategoria=sc.idsubcategoria";
									$tablas=",subcategoria asc";
									$agrupar=" des_subcateg,";
								}else{
									$clas="";
									//$clas2="";
									$cat="";
									//$cat2="";
									$subcat="";
									//$subcat2="";
									$filtro2=" dt.cod_prod, ";
									$filtro3=" and p.clasificacion!='000' and p.categoria!='000' and   p.subcategoria!='000'  ";
									$tablas=" ";
									$agrupar=" ";
								}
							}
						}
					}
				}
			}
		}
	}else{
		$filtro2=" p.cod_prod,";
		$tablas=" ,clasificacion cl,categoria ct,subcategoria sc ";
		$filtro3=' and p.clasificacion=cl.idclasificacion and p.categoria=ct.idcategoria and p.subcategoria=sc.idsubcategoria   ';
	}	
	//echo $filtro2."<br>";
	//echo $filtro3;
	?> 
	<?php
	$fecha1_c=formatofecha($fecha1);
	$fecha2_c=formatofecha($fecha2);
	//////////
	if ($formato=="1"){
		$filtrodocs="''";
		//echo count($cod_doc_i);
		for($i=0;$i<count($cod_doc_i);$i++){
			$filtrodocs=$filtrodocs.",'".$cod_doc_i[$i]."'";
		}
	}
	if($formato=='2'){
		$filtrodocs="''";
		for($i=0;$i<count($cod_doc_s);$i++){
			$filtrodocs=$filtrodocs.",'".$cod_doc_s[$i]."'";
		}
	}
	/*	/////--->2013

	if($formato=='3'){
		$filtrodocs="''";
		$union=array_merge($cod_doc_i,$cod_doc_s);
		for($i=0;$i<count($union);$i++){
			$filtrodocs=$filtrodocs.",'".$union[$i]."'";
		}	
	}*/
	$filtromostrar='';
	if($formato!='3'){  
		//echo $mostrar;
		//	  echo count($check);
		if(count($check)>0){	
			for($i=0;$i<count($check);$i++){
				// $tienda = $check[$i];
				/* $strSQL2="select det_mov.cod_prod, nom_prod, unidades.nombre, sum( if( tipo ='".$formato."', cantidad, 0 ) ) as cant from det_mov,producto,unidades where unidades.id=producto.und and idproducto=det_mov.cod_prod and  tienda in ('".$tienda."') group by det_mov.cod_prod " ;*/ 
				//echo count($check)."<br>";
				$filtromostrar=$filtromostrar.",(sum( if( dt.flag_kardex = '".$formato."' AND  ".$condiciom." ='".$check[$i]."'";
				$filtromostrar=$filtromostrar." and if(cm.flag_r='RA' and (SELECT kardex from cab_mov where";
				$filtromostrar=$filtromostrar." cod_cab=(SELECT cod_cab_ref FROM referencia r";
				$filtromostrar=$filtromostrar."WHERE r.cod_cab = cm.cod_cab))='S',false,true) ,";
				$filtromostrar=$filtromostrar." if(p.subunidad='S' and dt.unidad!=p.und,";
				$filtromostrar=$filtromostrar."cantidad*(select factor from unixprod where producto=dt.cod_prod";
				$filtromostrar=$filtromostrar." and unidad=dt.unidad ), cantidad) , 0 ) ) AS '".$check[$i]."')";
			// echo $filtrotiendas;
			}
		}
	}else{
	//SALDOS//
		if(count($check)>0){	
			for($i=0;$i<count($check);$i++){
				// $tienda = $check[$i];
				/* $strSQL2="select det_mov.cod_prod, nom_prod, unidades.nombre, sum( if( tipo ='".$formato."', cantidad, 0 ) ) as cant from det_mov,producto,unidades where unidades.id=producto.und and idproducto=det_mov.cod_prod and  tienda in ('".$tienda."') group by det_mov.cod_prod " ;*/ 
				//echo count($check)."<br>";
				$filtromostrar=$filtromostrar.",(sum( if( dt.flag_kardex = '1' AND ".$condiciom." ='".$check[$i]."'";
				$filtromostrar=$filtromostrar.", cantidad, 0 ) ) AS '".$check[$i]."In')";
				$filtromostrar=$filtromostrar.",(sum( if( dt.flag_kardex = '2'  AND ".$condiciom." ='".$check[$i]."'";
				$filtromostrar=$filtromostrar.", cantidad, 0 ) ) AS '".$check[$i]."Sal')";
				// echo $filtromostrar;
			}
		}
	}	

	//	 echo $filtromostrar."h";
	if($ordenar=='2'){
		$orden="order by dt.nom_prod";
	}
	if($ordenar=='1'){
		$orden="order by codprod";
	}
	if($ordenar=='3'){
		$orden="order by dt.nom_prod";
	}
	//between '".$fecha1_c."' and '".$fecha2_c."' 	
	if ($formato ==3){
		$fecRango=" between '1999-01-01' and '".$fecha2_c."' ";
		$docRengo='';
	}else{
		$fecRango=" between '".$fecha1_c."' and '".$fecha2_c."' ";
		$docRengo=" AND dt.cod_ope in(".$filtrodocs.") ";
	}
	
	$strSQL2="SELECT ".$filtro2." dt.cod_prod as 'codprod', dt.nom_prod, unidades.nombre as und ".$filtromostrar." FROM det_mov dt,cab_mov cm,producto p,operacion o, unidades".$tablas." WHERE unidades.id = p.und AND p.idproducto = dt.cod_prod ".$filtro3."  AND dt.cod_cab = cm.cod_cab AND cm.cod_ope = o.codigo AND dt.cod_ope=o.codigo AND dt.tipo=o.tipo $docRengo AND substring(dt.fechad,1,10) $fecRango AND (cm.deuda='S' or cm.kardex='S') $filtro1 GROUP BY ".$agrupar."dt.cod_prod,p.nombre ".$orden;
	$resultado2=mysql_query($strSQL2,$cn);
	$total_registros = mysql_num_rows($resultado2); 
	$resultados = mysql_query($strSQL2." LIMIT $inicio, $registros " ,$cn);
	if($_REQUEST['excel']=="S"){
		$resultados = mysql_query($strSQL2 ,$cn);
	}else{
		$resultados = mysql_query($strSQL2." LIMIT $inicio, $registros " ,$cn);
	}
	$resultados2 =mysql_num_rows($resultados);
	$total_paginas = ceil($total_registros / $registros);  
	$cont=0;
	//$o=999;
	while($row2=mysql_fetch_array($resultados)){
		/*$codigo=$row2['cod_prod'];
		$nom_prod = $row2['nom_prod'];
		$und=$row2['nombre'];
		$arr_codigo[]=$row2['cod_prod'];
		$arr_prod[]=$row2['nom_prod'];
		$arr_und[]=$row2['nombre'];
		$arr_saldo[$i][]=$row2['cant'];
		}	//fin while */	 
		//}//fin for
		//	} //fin if
		//print_r($arr_saldo); 
		// for($i=0;$i<count($arr_codigo);$i++){		 
	?>        
		<!---Esto es Nuevo  -->
	<?php
	//totales
		if($cont==0){
			$subcat2=$row2['des_subcateg'];
			$cat2=$row2['des_cat'];
			$clas2=$row2['des_clas'];
		}
		if($subcat2!=$row2['des_subcateg']){
			echo "<tr style='font:bold ; font:Arial, Helvetica, sans-serif; font-size:12px' >
				<td colspan='2'  style='color:#FF0000' align='right'>TOTAL ".$subcat2.":</td>
				<td align='left'>&nbsp;&nbsp;</td>";
			for($o=0;$o<count($check);$o++){
				echo "<td  colspan='2' style='color:#FF0000' align='left'>".$tot[$o]."</td>";
				$totalsub=$totalsub+$tot[$o];
			}
			// echo "<td style='color:#FF0000' align='left'>&nbsp;</td>";
			echo "<td style='color:#FF0000' align='center'>".$totalsub."</td>";
			$totalsub=0;	
			echo "</tr>";	
			for($i=0;$i<count($check);$i++){
				$tot[$i]=0;
			}		
			$subcat2=$row2['des_subcateg'];		 
		}	
		if($cat2!=$row2['des_cat']){
			echo"<tr style='font:bold; font:Arial, Helvetica, sans-serif; font-size:12px'>
				<td colspan='2' style='color:#003399' align='right'>TOTAL".$cat2."</td>
				<td  align='left'>&nbsp;&nbsp;</td>";
			for($b=0;$b<count($check);$b++){
				echo  "<td colspan='2' style='color:#003399' align='left'>".$tot2[$b]."</td>";
				$totalcat=$totalcat+$tot2[$b];
			}
			echo "<td style='color:#003399'align='center'>".$totalcat."</td>";
			$totalcat=0;
			echo "</tr>";
			for($i=0;$i<count($check);$i++){
				$tot2[$i]=0;
			}
			$cat2=$row2['des_cat'];
		}
		if($clas2!=$row2['des_clas']){
			echo "<tr style=' font:bold ; font:Arial, Helvetica, sans-serif; font-size:12px' >
				<td colspan='2' style='color:#006666' align='right'>TOTAL ".$clas2."</td>
				<td  align='left'>&nbsp;&nbsp;</td>";
			for($c=0;$c<count($check);$c++){
				echo "<td  style='color:#006666' colspan='2' align='left'>".$tot3[$c]."</td>";
				$totalclas=$totalclas+$tot3[$c];
			}
			echo "<td style='color:#006666' align='center'>".$totalclas."</td>";
			$totalclas=0;
			echo " </tr>";
			for($i=0;$i<count($check);$i++){
				$tot3[$i]=0;
			}
			$clas2=$row2['des_clas'];
		}
		//titulos
		if($clas!=$row2['des_clas']){
			$clas=$row2['des_clas'];
			echo " <tr>
				<td align='left' colspan='2' style='color:#006666 ; font:bold ; font:Arial, Helvetica, sans-serif;font-size:12px'>".$clas."</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>";
		}
		if($cat!=$row2['des_cat']){
			$cat=$row2['des_cat'];
			echo " <tr>
				<td  align='left' colspan='2' style='color:#003399; font:bold; font:Arial, Helvetica, sans-serif; font-size:12px'>&nbsp;&nbsp;".$cat."</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>";
		}
		if($subcat!=$row2['des_subcateg']){
			$subcat=$row2['des_subcateg'];
			echo " <tr>
				<td  align='left' style='color:#FF0000 ; font:bold ; font:Arial, Helvetica, sans-serif; font-size:12px' colspan='2'>&nbsp;&nbsp;&nbsp;&nbsp;".$subcat."</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>";
		}
		//totales
		?>
		<!---Esto es el Fin de lo Nuevo -->                 
	<tr>
        <td style="color:#000000" align="left">'<?php 
		//echo $arr_codigo[$i]
		if ($_POST["Sistema"]=='Cod. Sistema'){
			echo $row2['codprod'];
		}else{
			echo $row2['cod_prod'];
		}
		
		?></td>
        <td style="color:#000000" align="left"><?php 
		//echo $arr_prod[$i]
		echo $row2['nom_prod']?></td>
        <td style="color:#000000" align="center"><?php 
		//echo  $arr_und[$i]
		echo $row2['und']?></td>   
		<?php 
		if($formato!='3'){
				for($j=0;$j<count($check);$j++){			
					$tienda=$check[$j];
				  echo "<td style='color:#000000' align='right' >".$row2[$tienda]."</td>";
				  $sum=$row2[$tienda];
				  $total=$total+$sum;	
				  $tot[$j]=$tot[$j]+$row2[$tienda];
				  $tot2[$j]=$tot2[$j]+$row2[$tienda];
				  $tot3[$j]=$tot3[$j]+$row2[$tienda];				 
				}
		}else{
				/* for($j=0;$j<count($check);$j++){			
						$tiendaI=$check[$j]."In";
						$tiendaS=$check[$j]."Sal";
						$saldo=$row2[$tiendaI]-$row2[$tiendaS];
						//colspan=2				
					   echo "<td style='color:#000000' align='right' >".$saldo."</td>";
						  $sum=$saldo;
						  $total=$total+$sum;	
						 $tot[$j]=$tot[$j]+$saldo;
						 $tot2[$j]=$tot2[$j]+$saldo;
						 $tot3[$j]=$tot3[$j]+$saldo;				 
				}	*/	
			if(count($check)>0){
				for($i=0;$i<count($check);$i++){
					//echo "<td style='color:#000000' align='right' >".$check[$i].'//'.$row2['codprod']."</td>";
					$strP="select * from producto where idproducto='".$row2['codprod']."'  ";
					$resulP=mysql_query($strP,$cn);
					$rowP=mysql_fetch_array($resulP);
					$saldo=$rowP['saldo'.$check[$i]];
					echo "<td style='color:#000000' align='right' >".$saldo."</td>";
					$sum=$saldo;
					$total=$total+$sum;
					
				}
			}
				
				
		}
		 ?>
		 <td  style="color:#000000" align='center'><?php echo $total?></td> 
     </tr>
     
     
      <?php 
	  $total=0;
	  $cont++;
	  }

				   //$totalsub=0;
	  //pie de pagina
	  if($agr_sub=='S'){
	   if($subcat2!='999'){
				//echo "si diferente";
			   	 echo "<tr style='font:bold ; font:Arial, Helvetica, sans-serif;font-size:12px' class='Estilo28'>
				 <td colspan='2 'style='color:#FF0000' align='right'>TOTAL ".$subcat2.":</td>";
				 echo "<td align='left'>&nbsp;&nbsp;</td>";
				 for($a=0;$a<count($check);$a++){
				     echo "  <td colspan='2' style='color:#FF0000' align='left'>".$tot[$a]."</td>";
					 $sumsub=$sumsub+$tot[$a];
				 }
				 
			 echo "<td style='color:#006666' align='center'>".$sumsub."</td>";
			 echo "</tr>";
			 	  $subcat2=$row2['des_subcateg'];
	 }		 
}	  

if($agr_cat=='S'){
     if($cat2!='999'){		 
		
			  	 echo"<tr style='font:bold; font:Arial, Helvetica, sans-serif; font-size:12px' class='Estilo28'>
				 <td colspan='2' style='color:#003399' align='right'>TOTAL ".$cat2."</td>";
				 echo "<td  align='left'>&nbsp;&nbsp;</td>";
				 for($b=0;$b<count($check);$b++){
				 echo "<td colspan='2' style='color:#003399' align='left'>".$tot2[$b]."</td>";
				 $sumcat=$sumcat+$tot2[$b];
				 }
				 echo "<td  style='color:#003399' align='center'>".$sumcat."</td>";
				 "</tr>";
				 ///
				 $cat2=$row2['des_cat'];

	  }			  
} 	  
 if($agr_cla=='S'){
	 if($clas2!='999'){		
		
			   echo "<tr style=' font:bold ; font:Arial, Helvetica, sans-serif;               font-size:12px' class='Estilo28'>
			   <td colspan='2' style='color:#006666' align='right'>TOTAL ".$clas2."</td>";
			  echo "<td align='left'>&nbsp;&nbsp;</td>";
			  for($c=0;$c<count($check);$c++){
			   echo "<td colspan='2' style='color:#006666' align='left'>".$tot3[$c]."</td>";
			   $sumclas=$sumclas+$tot3[$c];
			  }
			  echo "<td  style='color:#006666' align='center'>".$sumclas."</td>";
			  echo " </tr>";
			     $clas2=$row2['des_clas'];
	
       }
} 
	  ?>
    </table> </div>   </td>	
  </tr>
  
  
  
  <tr>
    <td colspan="4" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" valign="top">&nbsp;</td>
  </tr>
</table>
    </td>
  </tr>
  <tr>
    <td width="888" height="25">&nbsp;</td>
  </tr>
  <tr>
    <td height="43"> <div id="paginacion" style="width:800px; height:20px;">
<?
if($_REQUEST['excel']=="N"){
?>	
	<table width="884">
      <tr>
        <td width="617" height="26">Viendo del <?php echo $inicio+1?> al <?php echo $inicio+$resultados2 ?> (de <?php echo $total_registros?> documentos) </td>
        <td width="251">
		      <?php 
			  
 if(($pagina - 1) > 0) { 
echo "<a style='cursor:pointer' onclick='cargar_detalle($pagina-1)'>< Anterior </a> "; 
} 

for ($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
	echo "<b style='color:#000000'>".$pagina."</b> "; 
	} else { 
	echo "<a style='cursor:pointer' href='#' onclick='cargar_detalle($i)'>$i</a> "; 
	}
}

if(($pagina + 1)<=$total_paginas) { 
echo " <a style='cursor:pointer' onclick='cargar_detalle($pagina+1)'>Siguiente ></a>"; 
} 

			  ?>
		 <input type="hidden" name="pag" value="<?php echo $pagina?>" />      </tr>
    </table>
<?
}
?>	
    </div></td>
  </tr>
  
</table>
</form>
</body>
</html>
<script language="javascript">
function cargar_detalle(pagina){
	var mostrar2=document.form1.mostrar2.value;
	var checkbox=document.form1.checkbox.value;
	var chk_tiendas=document.form1.chk_tiendas.value;
	var chktds_alma=document.form1.chktds_alma.value;
	var fecha1=document.form1.fecha1.value;
	var fecha2=document.form1.fecha2.value;
	var cboformato=document.form1.cboformato.value;
	var cmbPres=document.form1.cmbPres.value;
	var cmbValor=document.form1.cmbValor.value;
	var txtorden=document.form1.txtorden.value;
	var cmbclas=document.form1.cmbclas.value;
	var cmbcat=document.form1.cmbcat.value;
	var cmbsub=document.form1.cmbsub.value;
	var chkclas=document.form1.chkclas.value;
	var chksub=document.form1.chksub.value;
	var chkcat=document.form1.chkcat.value;
	var cbosucursal=document.form1.cbosucursal.value;
	var agr_cla=document.form1.agr_cla.value;
	var agr_cat=document.form1.agr_cat.value;
	var agr_sub=document.form1.agr_sub.value;
	var chkIngresos=document.form1.chkIngresos.value;
	var chkSalidas=document.form1.chkSalidas.value;
	var Sistema=document.form1.Sistema.value;
//rpt_comp_stock_paginacion.php
	doAjax('rpt_comp_stock_paginacion.php','fecha1='+fecha1+'&fecha2='+fecha2+'&mostrar2='+mostrar2+'&checkbox='+checkbox+'&chk_tiendas='+chk_tiendas+'&chktds_alma='+chktds_alma+'&cboformato='+cboformato+'&cmbPres='+cmbPres+'&cmbValor='+cmbValor+'&txtorden='+txtorden+'&cmbclas='+cmbclas+'&cmbcat='+cmbcat+'&cmbsub='+cmbsub+'&chkclas='+chkclas+'&chksub='+chksub+'&chkcat='+chkcat+'&cbosucursal='+cbosucursal+'&agr_cla='+agr_cla+'&agr_cat='+agr_cat+'&agr_sub='+agr_sub+'&chkIngresos='+chkIngresos+'&chkSalidas='+chkSalidas+'&Sistema='+Sistema+'&pagina='+pagina,'view_det','post','0','1','','');
	
}
function view_det(texto){
//alert(texto);
var r = texto.split('?');
document.getElementById('detalle').innerHTML=r[0];
//document.form1.carga.value='N';
document.getElementById('paginacion').innerHTML=r[1];

}

function GetChar (event){
        var keyCode = ('which' in event) ? event.which : event.keyCode;
        //alert ("The Unicode key code is: " + keyCode);
		if (keyCode=='8'){	
			location.href = "comp_stock_alma.php";
			event.keyCode=0;
			event.returnValue=false;
		}	
}

</script>
 
