<?php 
include('../conex_inicial.php');
include('../funciones/funciones.php');
include('../funciones/Recalculo.php');
if($_REQUEST['formato']=="excel"){
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=excel.xls");
}


			$tienda=$_REQUEST['tienda'];
			$sucursal=$_REQUEST['sucursal'];
			$precios=$_REQUEST['precios'];
			$incluir=$_REQUEST['incluir'];
			$fecha=formatofecha($_REQUEST['fecha']);
			$fecha2=formatofecha($_REQUEST['fecha2']);
			//$filtro
			
			//echo  $incluir;
					
			if($precios=='costo_inven'){
			$campo_precio=$precios.$sucursal;
			}else{
			$campo_precio=$precios;
			}
			
			if($sucursal==0){
			$filtro="";
			$campo_suc='costo_inven1';
			}else{
			$filtro=" where cod_suc='$sucursal' ";
			$filtrod=" and d.sucursal='$sucursal' ";
			$campo_suc='costo_inven'.$sucursal;
			}				
				
			if($tienda==0){			
			}else{
				$filtrod.=" and d.tienda='$tienda' ";
			}
			//echo $sumsaldos;
			if($_REQUEST['filtro']!="-"){
				$p_campo=$_REQUEST['filtro'];
			}else{
				$p_campo="idproducto";
			}
			if($_REQUEST['valor']!=""){
				$cat=explode("|",$_REQUEST['valor']);
				for($i=0;$i<count($cat);$i++){
					if($i==0){
						$filtroct=$cat[$i];
					}else{
						$filtroct=$cat[$i]."','".$filtroct;
					}
				}
			}else{
				$filtroct="0";
			}
			$filtroclasi="";
			if($_REQUEST['clasificacion']!="" && $_REQUEST['clasificacion']!="0"){
				$filtroclasi=" and p.clasificacion='".$_REQUEST['clasificacion']."'";
			}
			if($_REQUEST['categoria']!="" && $_REQUEST['categoria']!="0"){
				$filtroclasi.=" and p.categoria='".$_REQUEST['categoria']."'";
			}

			$strSQL2="select idproducto,p.* from producto p ,clasificacion ,categoria ,subcategoria where p.clasificacion=idclasificacion and p.categoria=idcategoria and p.subcategoria=idsubcategoria  and p.".$p_campo." in('".trim($filtroct)."') $filtroclasi group by nombre,idproducto order by idproducto,nombre   ";
			//echo $strSQL;
			$j=0;
			$resultado22=mysql_query($strSQL2,$cn);
			$con_in=0;
			$prod2="";
			while($row2=mysql_fetch_array($resultado22)){
		
				//$sql_det=mysql_query("Select * from det_mov where cod_prod='".$row2['idproducto']."' and fechad between '$fecha' and '$fecha2' ",$cn);
				//$con_det=mysql_num_rows($sql_det);
				$resp=explode("?",recalculo2($row2['idproducto'],$fecha,$filtrod,"4",""));
				$tot_saldo=$resp[0];
				$res_saldo=0;
				switch($_REQUEST['incluir']){
					case "0": $res_saldo=1;break;//if($tot_saldo!=0){$res_saldo=1;}break;
					case "1": if($tot_saldo>0){$res_saldo=1;}break;
					case "2": if($tot_saldo<0){$res_saldo=1;}break;
				}
//echo "$con_det>0";

			//	if($con_det>0 || $res_saldo==1){
				if($res_saldo==1){
					if($con_in==0){
						$prod2=$row2['idproducto'];
					}else{
						$prod2=$row2['idproducto']."','".$prod2;
					}
					$con_in++;
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

<table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" style="border:#999999 solid 0px" >
  <tr>
    <td colspan="12">
	
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:#999999 solid 0px">
      <tr>
        <td width="159" class="Estilo19" >P&aacute;gina <?php echo $pagina; ?></td>
        <td width="406" colspan="2">&nbsp;</td>
        <td width="140" align="right" colspan="3" ><span class="Estilo13">Fecha: <?php echo date('d-m-Y');?></span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center" colspan="2"><span class="Estilo15">Reporte de Stock Valorizado </span></td>
        <td align="right" colspan="3"><span class="Estilo13">Hora : <?php echo date('H:i:s',time()-3600)?></span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center" valign="top" colspan="2"><span class="Estilo17">Del :<?php echo $_REQUEST['fecha']; ?> Al: <?php echo $_REQUEST['fecha2'];/*date('d-m-Y')*/?></span></td>
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
Local / Tienda: 
<?php 

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
		
		switch($_REQUEST['filtro']){
			case "clasificacion": if($_REQUEST['agrupar2']!="")$agr_cat="S";if($_REQUEST['agrupar1']!="")$agr_cla="S";break;
			case "categoria": if($_REQUEST['agrupar2']!="")$agr_sub="S";if($_REQUEST['agrupar1']!="")$agr_cat="S";break;
			case "subcategoria": if($_REQUEST['agrupar2']!="")$agr_cat="S";if($_REQUEST['agrupar1']!="")$agr_sub="S";break;
		}
		/*$agr_cla=$_REQUEST['agr_cla'];
		$agr_cat=$_REQUEST['agr_cat'];
		$agr_sub=$_REQUEST['agr_sub'];*/
		//echo $agr_cla."-".$agr_cat."-".$agr_sub;
		$mon=$_REQUEST['moneda'];	
	//	echo  $mon;
		$filtro_ordenar=$_REQUEST['ordenar'];
		$filtro_precio="";
		
		
		//echo $filtro_cat;
		
	/*if($filtro_cla!="" || $filtro_cat!="" || $filtro_sub!=""){	
	 
	    if($filtro_cla!=""){
		$filtro1=" and p.clasificacion='$filtro_cla' ";
		}		
		if($filtro_cat!=""){
		$filtro1=$filtro1." and p.categoria='$filtro_cat' ";
		}
		if($filtro_sub!=""){
		$filtro1=$filtro1." and p.subcategoria='$filtro_sub' ";
		}			
	}*/
	
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
	if($agr_cla=='S'){
		$filtro_ordenar=" p.clasificacion, ".$filtro_ordenar;
	}
	if($agr_cat=='S'){
		$filtro_ordenar=" p.categoria, ".$filtro_ordenar;
	}
	if($agr_sub=='S'){
		$filtro_ordenar=" p.subcategoria, ".$filtro_ordenar;
	}
	
	/*if($_REQUEST['valor']!=''){
	$filtro4=" and (nombre like '%$valor%' or idproducto like '%$valor%') ";
	
	}*/
//	echo $strSQL="select ".$filtro2.",idproducto,nombre, p.* from producto p ,clasificacion ,categoria ,subcategoria where ".$filtro3." ".$filtro1." ".$filtro_incluir.$filtro4." group by nombre,idproducto order by  ".$filtro_ordenar." ";	
	
	 $strSQL="select ".$filtro2.",idproducto,nombre, p.* from producto p ,clasificacion ,categoria ,subcategoria where idproducto in('".trim($prod2)."') and $filtro3 group by nombre,idproducto order by  ".$filtro_ordenar." ";
	
	//echo $strSQL;
		/*

			$strSQL="select des_clas,des_cat,des_subcateg ,idproducto,nombre, p.* from producto p ,clasificacion ,categoria ,subcategoria where p.clasificacion=idclasificacion and p.categoria=idcategoria and p.subcategoria=idsubcategoria and $sumsaldos >=0 and (nombre like '%$valor%' or idproducto like '%$valor%' ) group by nombre,idproducto order by idproducto,nombre   ";*/
			
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
    <td colspan="5">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="5%" height="29"><span class="Estilo13">C&oacute;digo</span></td>
    <td width="12%"><span class="Estilo13">Cod Anexo </span></td>
    <td width="33%" ><span class="Estilo13">Nombre de Art&iacute;culo </span></td>
    <td width="7%" align="center"><span class="Estilo13">Stock Ini. </span></td>
    <td width="7%" align="center"><span class="Estilo13">Total Ingresos</span></td>
    <td width="7%" align="center"><span class="Estilo13">Total Salidas</span></td>
    <td width="8%" align="center"><span class="Estilo13">Saldo Act. </span></td>
    <td width="4%"><span class="Estilo13">Mon</span></td>
    <td width="5%" align="right"><span class="Estilo13">Precio</span></td>
    <td width="7%" align="right"><span class="Estilo13"><?php echo  "Val ".$moneda; ?>  </span></td>
    <td width="4%" align="right"><span class="Estilo13"></span></td>
  </tr>
  <?php
  $totalgeneral=$_REQUEST['totalgeneral'];
		$ax=0;
		while($row=mysql_fetch_array($resultado)){
								
			 $resp=explode("?",recalculo2($row['idproducto'],$fecha,$filtrod,"3",""));
			 $resp2=explode("?",recalculo2($row['idproducto'],$fecha2,$filtrod,"2",$sucursal));
			 $resp3=explode("?",recalculo3($row['idproducto'],$fecha,$fecha2,$filtrod." and d.tipo=1","",""));
			 $resp4=explode("?",recalculo3($row['idproducto'],$fecha,$fecha2,$filtrod." and d.tipo=2","",""));
			
			// if($resp[0]!='hoy'){
				 $tot_saldo=$resp[0];
				 if($resp2[1]!=''){
				 $cos_saldo=number_format($resp2[1],4);
				 }else{
				 $cos_saldo=0;
				 }
				
											
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
  
  <tr height="5px">
    <td height="5px"><span class="Estilo10"><?php echo $row['idproducto'];?></span></td>
    <td><span class="Estilo10"><?php echo $row['cod_prod'];?></span></td>
    <td><span class="Estilo10"><?php echo substr($row['nombre'],0,68);?></span></td>
    <td align="center" ><span class="Estilo10"><?php echo $tot_saldo;?></span></td>
    <td align="center" ><span class="Estilo10"><?php echo $resp3[0];?></span></td>
    <td align="center" ><span class="Estilo10"><?php echo abs($resp4[0]);?></span></td>
    <td align="center" ><span class="Estilo10"><?php echo $saldo_final=$tot_saldo+$resp3[0]+$resp4[0];?></span></td>
    <td align="center"><span class="Estilo10"><?php echo $moneda ?></span></td>
    <td align="right"><span class="Estilo10"><?php 


if($precios=='costo_inven'){
	
	if($mon=="01"){
	$cprecio=$cos_saldo;
	}else{
	$cprecio=$cos_saldo/$tcambio;
	}
	
}else{

	
	if($row['moneda']!=$mon){
	
		if($mon=="01"){
		
		$cprecio=$cos_saldo*$tcambio;
		
		}else{
		$cprecio=$cos_saldo/$tcambio;
		}
	
	}else{
	
	$cprecio=$cos_saldo;
	}//$mon."/".
}


$subtotal=$saldo_final*$cprecio;
		$total+=$subtotal;	
	
	//if ($_SESSION['nivel_usu']==2){
	if ($_REQUEST['tpuser']==2){
	echo '***';
	}else{
	echo number_format($cprecio,2); 
	}	
	?></span></td>
    <td align="right"><span class="Estilo10"><?php 
	//if ($_SESSION['nivel_usu']==2){
	if ($_REQUEST['tpuser']==2){
	echo '***';
	}else{
	echo number_format($subtotal,2);
	
	}
	
	$tempTotGen+=$subtotal;	
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
 //////////////////////////////////////////////////////////////////////////////////////
 ?>
  
  
  <tr>
    <td height="20" colspan="7"><span class="Estilo10">&nbsp;</span></td>
    <td ><span class="Estilo11">&nbsp;</span></td>
    <td><span class="Estilo11">&nbsp;</span></td>
    <td><span class="Estilo11">&nbsp;</span></td>

    <td>&nbsp;</td>
  </tr>
  <?php if($_REQUEST['formato']!="excel"){?>
  <tr>
    <td height="20" colspan="10" align="right"><span class="Estilo13">**** Total Parcial **** </span>&nbsp;&nbsp;<span class="Estilo10"><?php echo number_format($total,2)?></span> </td>
    <td align="right">&nbsp;</td>
    <td width="1%">&nbsp;</td>
  </tr>
  <?php } ?>

      <?php 
	if($total_paginas==$pagina || $_REQUEST['formato']=="excel"){
	?>
	  <tr>
    <td height="20" colspan="9" align="right"><span class="Estilo13">
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

	
	//$strSQLx ="select idproducto,nombre,precio,costo_inven1,moneda,($col)as total  from producto p ,clasificacion ,categoria ,subcategoria where ".$filtro3." ".$filtro1." ".$filtro_incluir." ";
			$strSQLx="select ".$filtro2.",idproducto,nombre,precio,costo_inven1,moneda,($col)as total from producto p ,clasificacion ,categoria ,subcategoria where idproducto in('".trim($prod2)."') group by nombre,idproducto order by des_clas asc,des_cat asc,des_subcateg asc, ".$filtro_ordenar." ";	
	
	//cho $strSQLx;
	$q_dat=mysql_query($strSQLx);
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
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	echo "TOTAL GENERAL ";
	
	?>
    </span></td>
    <td align="right"><span class="Estilo10"><?php echo number_format($tempTotGen,2)?></span></td>
    <td>&nbsp;</td>
  </tr>
  <?php }?>
</table>

</div>
<?php
if($_REQUEST['formato']!="excel"){ ?>

<table width="851" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="275" bgcolor="#F2F2F2"><span class="Estilo19" style="color:#999999"><span class="Estilo33">Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (de <strong><?php echo $total_registros?></strong> productos)</span>.</span></td>
    <td width="9" rowspan="2" bgcolor="#F2F2F2">&nbsp;</td>
    <td width="557" rowspan="2" bgcolor="#F2F2F2"><span class="Estilo10"><?php 
	
		$filtro_cla=$_REQUEST['filtro_cla'];
		$filtro_cat=$_REQUEST['filtro_cat'];
		$filtro_sub=$_REQUEST['filtro_sub'];
		
		$agr_cla=$_REQUEST['agr_cla'];
		$agr_cat=$_REQUEST['agr_cat'];
		$agr_sub=$_REQUEST['agr_sub'];		
		
		$filtro_ordenar=$_REQUEST['ordenar'];
	
			  
			  if(($pagina - 1) > 0) { 
echo "<a href='inventario_excel.php?sucursal=$sucursal&tienda=$tienda&precios=$precios&incluir=$incluir&filtro_cla=$filtro_cla&filtro_cat=$filtro_cat&filtro_sub=$filtro_sub&agr_cla=$agr_cla&agr_cat=$agr_cat&agr_sub=$agr_sub&ordenar=$filtro_ordenar&mon=$mon&fecha=".$_REQUEST['fecha']."&pagina=".($pagina-1)."'>< Anterior </a> "; 
} 

for ($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
	echo "<b>".$pagina."</b> "; 
	} else { 
	echo "<a href='inventario_excel.php?sucursal=$sucursal&tienda=$tienda&precios=$precios&incluir=$incluir&filtro_cla=$filtro_cla&filtro_cat=$filtro_cat&filtro_sub=$filtro_sub&agr_cla=$agr_cla&agr_cat=$agr_cat&agr_sub=$agr_sub&ordenar=$filtro_ordenar&mon=$mon&fecha=".$_REQUEST['fecha']."&pagina=$i'>$i</a> "; 
	}
}

if(($pagina + 1)<=$total_paginas) { 
echo " <a href='inventario_excel.php?sucursal=$sucursal&tienda=$tienda&precios=$precios&incluir=$incluir&filtro_cla=$filtro_cla&filtro_cat=$filtro_cat&filtro_sub=$filtro_sub&agr_cla=$agr_cla&agr_cat=$agr_cat&agr_sub=$agr_sub&ordenar=$filtro_ordenar&mon=$mon&fecha=".$_REQUEST['fecha']."&pagina=".($pagina+1)."'>Siguiente></a>"; 
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

