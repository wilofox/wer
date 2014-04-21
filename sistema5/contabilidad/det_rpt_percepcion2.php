<?php 
session_start();
?>
<?php 
include('../conex_inicial.php');
include('../funciones/funciones.php');

//PAGINACION 1	
		 $registros = 100; 
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
    <td align="center">&nbsp;</td>
  </tr>
  
  
  
  <tr>
    <td align="center">
    <table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <tr>
        <td colspan="6"  align="left" valign="baseline" class="Estilo16">
		
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
        <td width="11%"   align="center" valign="middle" bgcolor="#03B1E4" class="Estilo16">Cant.</td>
        <td width="11%"   align="center" valign="middle" bgcolor="#03B1E4" class="Estilo16">TD</td>
        <td width="30%"   align="center" valign="middle" bgcolor="#03B1E4" class="Estilo16">Documento</td>
        <td width="7%"   align="center" valign="middle" bgcolor="#03B1E4" class="Estilo16">Mon.</td>
        <td width="16%"   align="center" valign="middle" bgcolor="#03B1E4" class="Estilo16">Percepci&oacute;n</td>
        <td width="25%"   align="center" valign="middle" bgcolor="#03B1E4" class="Estilo16">Total</td>
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
	 $filtro_orden=" cod_ope asc ";
	 //$separador="cod_ope";
	 
	 } 
	 if($formato=='2'){
	 $filtro_orden=" cm.fecha desc ";
	
	 } 
	 if($formato=='3'){
	  $filtro_orden=" c.razonsocial asc ";
	} 

	 $strSQL="select COUNT(total) as cant, SUM(total) as total , SUM(percepcion) as percepcion,cod_ope,descripcion from cab_mov cm, cliente c, operacion o,
      condicion co  where cm.cod_ope = o.codigo
	AND cm.condicion=co.codigo 
    AND cm.cliente = c.codcliente     
	and co.codigo in ('".$filtrodocs2."')
     and cm.tipo in('2') and cm.cod_ope in('".$filtrodocs."') and cm.sucursal='".$sucursal."' and cm.tienda in(".$filtroTiendas.")  
	 and  substring(cm.fecha,1,10) between '".$fecha1."' and '".$fecha2."'  
	 and flag_r<>'RA' and flag<>'A' and cm.percepcion > 0 group by cod_ope ";	

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
					
			;			
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
        <td  align="center" bgcolor="#FFFFFF" style="background:<?php echo $colorTD?>"><span class="Estilo54"><?php echo $rowreporte['cant']; ?></span></td>
        <td height="19"  align="center" bgcolor="#FFFFFF" style="background:<?php echo $colorTD?>"><span class="Estilo54"><?php echo $rowreporte['cod_ope']; ?></span></td>
        <td align="left" bgcolor="#FFFFFF"  style="background:<?php echo $colorTD?>"><span class="Estilo54"><?php echo $rowreporte['descripcion']; ?></span></td>
        <td align="center" bgcolor="#FFFFFF" class="Estilo54"  style="background:<?php echo $colorTD?>">S/.</td>
        <td  style="background:<?php echo $colorTD?>" align="right" bgcolor="#FFFFFF"><span class="Estilo54"><?php
		
		 echo number_format($rowreporte['percepcion'],2); 
		 
		 $totalPerp=$totalPerp+$rowreporte['percepcion'];
		 ?></span></td>
        <td  style="background:<?php echo $colorTD?>" align="right" bgcolor="#FFFFFF"><span class="Estilo54"><?php 
		
		echo number_format($rowreporte['total'],2); 
		$totalGen=$totalGen+$rowreporte['total'];
		
		?></span></td>
        </tr>
  
      
      <?php 
  
 }
 
  ?>
  
      <tr >
        <td height="45" colspan="4"  align="center" bgcolor="#FFFFFF" class="Estilo54" style="background:<?php echo $colorTD?>"><strong>TOTALES</strong></td>
        <td  style="background:<?php echo $colorTD?>" align="right" bgcolor="#FFFFFF"><strong><span class="Estilo54">
          <?php
		
		 echo   number_format($totalPerp,2);
		 ?>
        </span></strong></td>
        <td  style="background:<?php echo $colorTD?>" align="right" bgcolor="#FFFFFF"><strong><span class="Estilo54">
          <?php 
		
		echo number_format($totalGen,2);
		
		?>
        </span></strong></td>
      </tr>
  
  
 <?php 
 

//PIE DE PAGINA
	  


 ?>
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
