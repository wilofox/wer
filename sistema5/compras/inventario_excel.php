<?php 
//include('../seguridad.php');
include('../conex_inicial.php');
include('../funciones/funciones.php');
include('../funciones/Recalculo.php');
if($_REQUEST['formato']=="excel"){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=excel.xls");
}
$temopCONT=0;

			$tienda=$_REQUEST['tienda'];
			$sucursal=$_REQUEST['sucursal'];
			$precios=$_REQUEST['precio'];
			$incluir=$_REQUEST['incluir'];
			$fecha=formatofecha($_REQUEST['fecha']);
			$columna=$_REQUEST['columna'];
			$filtro_ordenar=$_REQUEST['ordenar'];
			
			//echo $fecha;
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
			if($sucursal==0){
				$filtrod="";
			}else{
				$filtrod=" and d.sucursal='$sucursal' ";
			}
			if($tienda==0){			
				$sumsaldos="( ";
				for($i=0;$i<count($saldos);$i++){
				$sumsaldos=$sumsaldos." + ".$saldos[$i];
				}
				$sumsaldos.=" )";
			}else{
			$sumsaldos="saldo".$tienda;
			$filtrod.=" and d.tienda='$tienda' ";
			}
			//echo $sumsaldos;
			
			if($incluir==1){
			//$filtro_incluir=" and $sumsaldos >0 ";
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
		
		
  //--------------------------------------------------------------------------------------------------
		
		if($_REQUEST['formato']!="excel"){
		
		//$strSQL2="select idproducto,p.* from producto p ,clasificacion ,categoria ,subcategoria where kardex='S' and p.clasificacion=idclasificacion and p.categoria=idcategoria and p.subcategoria=idsubcategoria   group by nombre,idproducto order by idproducto,nombre ";
		$strSQL2="select idproducto,p.* from producto p where kardex='S'  order by p.idproducto";
		
			//echo $strSQL;
			$j=0;
			$resultado22=mysql_query($strSQL2,$cn);
			$con_in=0;
			$prod2="";
			while($row2=mysql_fetch_array($resultado22)){
			
			/*
				$sql_det=mysql_query("Select saldo_actual from det_mov d where d.cod_prod='".$row2['idproducto']."' and substring(d.fechad,1,10)<='$fecha' $filtrod  order by d.fechad desc limit 1 ",$cn);
				$row_det=mysql_fetch_array($sql_det);
				
				//$con_det=mysql_num_rows($sql_det);
				$tot_saldo=$row_det['saldo_actual'];
			*/	
					//echo "Select * from det_mov where cod_prod='".$row2['idproducto']."' and substring(fechad,1,10)<='$fecha' $filtrod  order by fechad desc limit 1 <br>";			
				$resp=explode("?",recalculo2($row2['idproducto'],$fecha,$filtrod,"4",""));				
				$tot_saldo=$resp[0];
				
				//$tot_saldo=0;
				//echo $tot_saldo."<br>";
				$res_saldo=0;
				switch($_REQUEST['incluir']){
					case "0": $res_saldo=1;break;//if($tot_saldo!=0){$res_saldo=1;}break;
					case "1": if($tot_saldo>0){$res_saldo=1;}break;
					case "2": if($tot_saldo<0){$res_saldo=1;}break;
					case "3": if($tot_saldo==0){$res_saldo=1;}break;
				}
//echo "$con_det>0";

			//	if($con_det>0 || $res_saldo==1){}
				if($res_saldo==1){
					if($con_in==0){
						$prod2=$row2['idproducto'];
					}else{
						$prod2=$row2['idproducto']."','".$prod2;
					}
					$con_in++;
				}
			}
		//echo $con_in;
		
		}
		
		//echo $prod2;
		
		//die();
		//----------------------------------------------------------------------------------------	

		$registros = 100; 
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
<div id="seleccion" style="height:600px; width:730px; overflow:auto" >

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

<table width="725" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" style="border:#999999 solid 0px" >
  <tr>
    <td colspan="9">
	
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:#999999 solid 0px">
      <tr>
        <td width="159" class="Estilo19" >P&aacute;gina <?php echo $pagina; ?></td>
        <td width="406" colspan="2">&nbsp;</td>
        <td width="140" align="right" colspan="3" ><span class="Estilo13">Fecha: <?php echo date('d-m-Y');?></span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center" colspan="2"><span class="Estilo15">Reporte de Stock Valorizado</span></td>
        <td align="right" colspan="3"><span class="Estilo13">Hora : <?php echo date('H:i:s')?></span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center" valign="top" colspan="2"><span class="Estilo17">Al: <?php echo $_REQUEST['fecha'];/*date('d-m-Y')*/?></span></td>
        <td colspan="3"><?php echo "<b>Tipo de cambio: ".$tcambio."</b>"; ?></td>
      </tr>
      <tr>
        <td colspan="3"><span class="Estilo19">Empresa: 
            <?php
		
			$strSQL_suc="select * from sucursal where cod_suc='$sucursal'";
			$resultado_suc=mysql_query($strSQL_suc,$cn);
			$row_suc=mysql_fetch_array($resultado_suc);
			
			echo $row_suc['des_suc'];
		 
		 
		 ?><br>
Almac&eacute;n: <?php 

			$strSQL_suc="select * from tienda where cod_tienda='$tienda'";
			$resultado_suc=mysql_query($strSQL_suc,$cn);
			$row_suc=mysql_fetch_array($resultado_suc);
			
			if($tienda==0){
			echo "Todas las tiendas";
			}else{
			echo $row_suc['des_tienda'];
			}
			
			
?></span></td>
        <td colspan="3">&nbsp;</td>
      </tr>
    </table>	</td>
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
		//$filtro_ordenar=$_REQUEST['ordenar'];
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
		//echo '5555';	
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
		//echo "--->";
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
	
	if($_REQUEST['formato']!="excel"){
		$filtroTemp=" and p.idproducto in('".trim($prod2)."') ";
	}
	
	/*$strSQL="select ".$filtro2.",idproducto,nombre, p.* from producto p ,clasificacion ,categoria ,subcategoria where ".$filtro3." ".$filtro1." ".$filtro_incluir.$filtro4." $filtroTemp group by nombre,idproducto order by  ".$filtro_ordenar." ";*/	

///---------------------------------------------------------------------------	
if ($agr_cla=='S'){
	//$filtro_gruop1='clasificacion,';
	$filtro_gruop1='des_clas,';	
}
if ($agr_cat=='S'){
	//$filtro_gruop2='categoria,';
	$filtro_gruop2='des_cat,';
}
if ($agr_sub=='S'){
	//$filtro_gruop3='subcategoria,';
	$filtro_gruop3='des_subcateg ,';
}
$filtro_gruop=$filtro_gruop1.''.$filtro_gruop2.''.$filtro_gruop3;
$filtro_ordenar=$filtro_gruop.''.$filtro_ordenar;

///---------------------------------------------------------------------------	
		
 $strSQL="select ".$filtro2.",idproducto,nombre, p.* from producto p ,clasificacion ,categoria ,subcategoria where  kardex='S' and ".$filtro3." ".$filtro1." ".$filtro_incluir.$filtro4." $filtroTemp group by nombre,idproducto order by  ".$filtro_ordenar." ";	
			
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
		
		list($moneda)=mysql_fetch_array(mysql_query("select simbolo from moneda where id='".$mon."' "));
		?>
		  <tr>
    <td height="19">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
  <? if ($columna=='0'){ ?>
    <td width="7%" height="29"><span class="Estilo13">C&oacute;digo</span></td>
    <td width="12%"><span class="Estilo13">Cod Anexo </span></td>
  <? }else if ($columna=='1') { ?>	
	<td height="29" colspan="2"><span class="Estilo13">C&oacute;digo</span></td>
  <? }else { ?>		
	<td height="29" colspan="2"><span class="Estilo13">Cod Anexo </span></td>
  <? } ?>		
    <td width="45%" ><span class="Estilo13">Nombre de Art&iacute;culo </span></td>
    <td width="6%" align="center"><span class="Estilo13">Stock </span></td>
    <td width="4%"><span class="Estilo13">Mon</span></td>
    <td width="6%" align="right"><span class="Estilo13">Precio</span></td>
    <td width="7%" align="right"><span class="Estilo13"><?php echo  "Val ".$moneda; ?>  </span></td>
    <td width="12%" align="right"><span class="Estilo13"></span></td>
  </tr>
  <?php
  $totalgeneral=$_REQUEST['totalgeneral'];
		$ax=0;
		while($row=mysql_fetch_array($resultado)){
			
			list($unidad)=mysql_fetch_array(mysql_query("select descripcion from unidades where id='".$row['und']."' "));
					
									
				if($tienda==0 || $tienda==""){
					$tot_saldo=0;
					for($i=0;$i<count($saldos);$i++)
						$tot_saldo=$tot_saldo+$row[$saldos[$i]];
				}else{
				   $campo="saldo".$tienda;
				   $tot_saldo=$row[$campo];
				}
				
			 $cos_saldo=number_format($row[$campo_suc],4);
			 
			 $resp=explode("?",recalculo2($row['idproducto'],$fecha,$filtrod,"4",""));
			 
//echo "<br>------------------------------------------------------------------------------------$sucursal<br>";

			// $resp2=explode("?",recalculo2($row['idproducto'],$fecha,$filtrod,"1",$sucursal));
			
			//echo "-->".$resp2[1];
						
			// if($resp[0]!='hoy'){
			
				
				//  print_r($resp);
		  			//echo $fecha;li
						
				 $tot_saldo=$resp[0];
				 if($resp[1]!=''){
				 $cos_saldo=number_format($resp[1],4,'.','');
				 }
				 $res_saldo=0;
				 
			 if($_REQUEST['formato']=="excel"){
			 
				  switch($_REQUEST['incluir']){
					case "0": $res_saldo=0;break;//if($tot_saldo!=0){$res_saldo=1;}break;
					case "1": if($tot_saldo>0){ }else{ $res_saldo=1;} break;
					case "2": if($tot_saldo<0){ }else{ $res_saldo=1;} break;
					case "3": if($tot_saldo==0){ }else{ $res_saldo=1; } break;
				 }
				 
			 }	 
			 
			 if($res_saldo==1){
			 continue;
			 }
				 
				/*
					if($incluir==1){
					//$filtro_incluir=" and $sumsaldos >0 ";
					  if($tot_saldo<=0)continue;
					}
					if($incluir==2){
					  if($tot_saldo>=0)continue;
					}
					if($incluir==3){
					  if($tot_saldo!=0)continue;
					}
				*/
									
		if($clas!=$row['des_clas']){
		$clas=$row['des_clas'];
		echo " <tr>
    <td  colspan='8' style='color:#006666 ;' class='Estilo10'><strong>".$clas."</strong></td>
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
    <td  colspan='8' style='color:#003399; ' class='Estilo10'>&nbsp;&nbsp;<strong>".$cat."</strong></td>
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
    <td style='color:#FF0000 ' colspan='8' class='Estilo10'>&nbsp;&nbsp;&nbsp;&nbsp;<strong>".$subcat."</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
		";
		
		}
			
?>
  
  <tr height="5px">
  
  

<!--funtar columnas -->
	<? if ($columna=='0'){ ?>
    <td height="5px"><span class="Estilo10"><?php echo $unidad;?></span></td>
    <td><span class="Estilo10"><?php echo "'".$row['cod_prod'];?></span></td>
  <? }else if ($columna=='1') { ?>	
	<td height="5px" colspan="2"><span class="Estilo10"><?php echo  $unidad;?></span></td>
    <? }else { ?>		
	<td height="5px" colspan="2"><span class="Estilo10"><?php echo  "'".$row['cod_prod'];?></span></td>
  <? } ?>
	
	
    <td><span class="Estilo10"><?php echo substr($row['nombre'],0,68);?></span></td>
    <td align="center" ><span class="Estilo10"><?php if($tot_saldo!=''){ echo number_format($tot_saldo,4); };?></span></td>
    <td align="center"><span class="Estilo10"><?php echo $moneda ?></span></td>
    <td align="right"><span class="Estilo10"><?php 

$temopCONT++;
if($precios=='costo_inven'){
	/*
	if($mon=="01"){
	$cprecio=$cos_saldo;
	}else{
	$cprecio=$cos_saldo/$tcambio;
	}
	*/
	if($row['moneda']!=$mon){
	
		if($mon=="01"){		
		$cprecio=$cos_saldo*$tcambio;		
		}else{
		$cprecio=$cos_saldo/$tcambio;
		}
	
	}else{	
	$cprecio=$cos_saldo;
	}//$mon."/".
	
}else{
	
	$cprecio=$row[$precios];
	
	
	
}


$subtotal=$tot_saldo*$cprecio;
		$total+=$subtotal;	
	
	//if ($_SESSION['nivel_usu']==2){
	if ($_REQUEST['tpuser']==2){
	echo '***';
	}else{
	echo number_format($cprecio,2,'.',''); 
	}
	
	
	$sumTotalInv=$sumTotalInv+($cprecio*$tot_saldo);	
	?></span></td>
    <td align="right"><span class="Estilo10"><?php 
	//if ($_SESSION['nivel_usu']==2){
	if ($_REQUEST['tpuser']==2){
	echo '***';
	}else{
	echo number_format($subtotal,2,'.','');
	}	
	?></span></td>
    <td></td>
  </tr>
  
  <?php
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
  ?>
  
  
  <tr>
    <td height="20" colspan="4"><span class="Estilo10">&nbsp;</span></td>
    <td ><span class="Estilo11">&nbsp;</span></td>
    <td><span class="Estilo11">&nbsp;</span></td>
    <td><span class="Estilo11">&nbsp;</span></td>

    <td>&nbsp;</td>
  </tr>
  <?php if($_REQUEST['formato']!="excel"){?>
  <tr>
    <td height="20" colspan="7" align="right"><span class="Estilo13">**** Total Parcial **** </span></td>
    <td align="right"><span class="Estilo10"><?php echo number_format($total,2)?></span></td>
    <td width="1%">&nbsp;</td>
  </tr>
  <?php } ?>

      <?php 
	if($total_paginas==$pagina || $_REQUEST['formato']=="excel"){
	?>
	  <tr>
    <td height="20" colspan="6" align="right"><span class="Estilo13">
	<?php
	if($tienda!=0){
	$where=" where cod_tienda='$tienda'";
	}else{
	$where="";
	}
	$col=" ";
	$z=0;
		$strSQL_suc="select * from tienda ".$where." order by cod_tienda";
			$resultado_suc=mysql_query($strSQL_suc,$cn);
			while($row_suc=mysql_fetch_array($resultado_suc)){
			$z++;

			if($z!=1){
			$col.="+";
			}
			$col.="saldo".$row_suc['cod_tienda'];
						}

			/*echo $strSQLx="select ".$filtro2.",idproducto,nombre,precio,costo_inven1,p.moneda,($col)as total from producto p ,clasificacion ,categoria ,subcategoria where ".$filtro3." ".$filtro1." ".$filtro_incluir."  group by nombre,idproducto order by des_clas asc,des_cat asc,des_subcateg asc, ".$filtro_ordenar." ";*/
			$strSQLx="select ".$filtro2.",idproducto,nombre,precio,costo_inven1,p.moneda,($col)as total from producto p ,clasificacion ,categoria ,subcategoria where kardex='S' and ".$filtro3." ".$filtro1." ".$filtro_incluir."  group by nombre,idproducto order by des_clas asc,des_cat asc,des_subcateg asc "; //, ".$filtro_ordenar."	
	
	//echo $strSQLx;
	$q_dat=mysql_query($strSQLx,$cn);
	//$temp_$q_dat=mysql_num_rows($q_dat);
	
	$x=0;
	$totalgeneral=0;
	
	while($dat_total=mysql_fetch_array($q_dat)){

		if($dat_total['moneda']!=$mon){		
			if($mon=="01"){
				$cpreciox[$x]=$dat_total[$campo_precio]*$tcambio;
			}else{
				$cpreciox[$x]=$dat_total[$campo_precio]/$tcambio;
			}		
		}else{
			$cpreciox[$x]=$dat_total[$campo_precio];		
		}
$stotal=$cpreciox[$x]*$dat_total['total'];
$totalgeneral+=$stotal;
//echo $dat_total['idproducto']."-".number_format($stotal,2)."<br/>";
		$x++;
	}
		
		/*$strSQL_tot="select sum($sumsaldos*$campo_precio) as total from producto p ,clasificacion ,categoria ,subcategoria where ".$filtro3." ".$filtro1." ".$filtro_incluir." ";
			echo $strSQL_tot;
		$resultado_tot=mysql_query($strSQL_tot,$cn)	;
		$row_tot=mysql_fetch_array($resultado_tot);
		
	//$row_tot['total']*/
	echo "TOTAL GENERAL ";
	
	?>
    </span></td>
    <td align="right"><span class="Estilo10"><?php echo number_format($sumTotalInv,2)?></span></td>
    <td>&nbsp;</td>
  </tr>
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
		
		
	
			  
			  if(($pagina - 1) > 0) { 
echo "<a href='inventario_excel.php?sucursal=$sucursal&tienda=$tienda&precio=$precios&incluir=$incluir&filtro_cla=$filtro_cla&filtro_cat=$filtro_cat&filtro_sub=$filtro_sub&agr_cla=$agr_cla&agr_cat=$agr_cat&agr_sub=$agr_sub&ordenar=$filtro_ordenar&columna=$columna&mon=$mon&fecha=".$_REQUEST['fecha']."&pagina=".($pagina-1)."'>< Anterior </a> "; 
} 

for ($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
	echo "<b>".$pagina."</b> "; 
	} else { 
	echo "<a href='inventario_excel.php?sucursal=$sucursal&tienda=$tienda&precio=$precios&incluir=$incluir&filtro_cla=$filtro_cla&filtro_cat=$filtro_cat&filtro_sub=$filtro_sub&agr_cla=$agr_cla&agr_cat=$agr_cat&agr_sub=$agr_sub&ordenar=$filtro_ordenar&columna=$columna&mon=$mon&fecha=".$_REQUEST['fecha']."&pagina=$i'>$i</a> "; 
	}
}

if(($pagina + 1)<=$total_paginas) { 
echo " <a href='inventario_excel.php?sucursal=$sucursal&tienda=$tienda&precio=$precios&incluir=$incluir&filtro_cla=$filtro_cla&filtro_cat=$filtro_cat&filtro_sub=$filtro_sub&agr_cla=$agr_cla&agr_cat=$agr_cat&agr_sub=$agr_sub&ordenar=$filtro_ordenar&columna=$columna&mon=$mon&fecha=".$_REQUEST['fecha']."&pagina=".($pagina+1)."'>Siguiente></a>"; 
} 

			  ?></span></td>
  </tr>
  <tr>
    <td align="left" bgcolor="#F2F2F2"><a href="#" onClick="javascript:imprSelec()"><img src="../imgenes/fileprint.png" width="25" height="25" border="0"> <span class="Estilo19">Imprimir P&aacute;g.</span> </a></td>
  </tr>
</table>
<?php } 

?>

</body>
</html>
<?php
?>

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

