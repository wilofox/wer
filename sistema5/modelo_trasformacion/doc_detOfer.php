<?php 
session_start();
if ($_REQUEST['formato']=='excel'){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=excel.xls");
}
include('../conex_inicial.php');
include('../funciones/funciones.php');

$referencia=$_REQUEST['referencia'];
//echo $referencia;

$strsql="select * from oferta where cod_ofe='$referencia'";
$resultado=mysql_query($strsql,$cn);
$cont=mysql_num_rows($resultado);
$row=mysql_fetch_array($resultado);
//echo $cont;

$noperacion=$row['noperacion'];
$numero=$row['cod_anexo'];
$serie=$row['cod_ofe'];
$flag=$row['flag'];

//echo $numero;
$condicion=$row['condicion'];
$alias=$row['nom_oferta'];
$unidad=$row['unidad'];
$ruc=$row['ruc'];
$cliente=$row['cliente'];
$fecha=$row['fecha_ini'];
$fecha2=$row['fecha_fin'];
$f_venc=$row['f_venc'];
$cod_ope=$row['cod_ope'];
$codsucursal=$row['sucursal'];
$codtienda=$row['tienda'];
$cod_vendedor=$row['cod_vendedor'];
$tipo_cambio=$row['tc'];
$moneda=$row['moneda'];
$fecha_aud=$row['fecha_aud'];
$nom_pc=$row['pc'];
$inafecto=$row['inafecto'];
$incluidoigv=$row['incluidoigv'];
$cantidad=$row['cantidad'];
$igv=$row['igv'];
$impto=$row['impto1'];


if($inafecto=='S'){
	$texto_incl_igv=" DOC. INAFECTO ";
}else{

	if($incluidoigv=='S'){
	$texto_incl_igv=" INCLUIDO IGV";
	}else{
	$texto_incl_igv=" NO INCLUIDO IGV";
	}
}






if($moneda=='01'){
$des_mon="SOLES S/.";
$simbolo="S/.";
}else{
$des_mon="DOLARES US$.";
$simbolo="US$.";
}



$importe=$row['total'];

	$strSQL_clie="select *  from cliente where codcliente='".$cliente."'";
	$resultado_clie=mysql_query($strSQL_clie,$cn);
	$row_clie=mysql_fetch_array($resultado_clie);
	$razonsocial=$row_clie['razonsocial'];
	$ruc=$row_clie['ruc'];
	$direccion=$row_clie['direccion'];
	
	$strUnidad="select * from unidades  where id='".$unidad."'";
	$resultadoUnidad=mysql_query($strUnidad,$cn);
	$rowUnidad=mysql_fetch_array($resultadoUnidad);
	$unidad= $rowUnidad['descripcion'];

	
//	echo $strSQL_clie;
	
	$strSQL_ope="select *  from condicion where codigo='".$condicion."'";
	$resultado_ope=mysql_query($strSQL_ope,$cn);
	$row_ope=mysql_fetch_array($resultado_ope);
	$rowcount = mysql_num_rows($resultado_ope);
	if ($rowcount>1){
		$condnombre=$row_ope['nombre'];	
	}else{
		$condnombre="TODOS";
	}
	
	
	
	$strSQL_emp="select des_suc from sucursal where cod_suc='".$codsucursal."'";
	$resultado_emp=mysql_query($strSQL_emp,$cn);
	$row_emp=mysql_fetch_array($resultado_emp);
	$dessuc=$row_emp['des_suc'];
	

	$strSQL_vend="select usuario from usuarios where codigo='".$cod_vendedor."'";
	$resultado_vend=mysql_query($strSQL_vend,$cn);
	$row_vend=mysql_fetch_array($resultado_vend);
	
	$responsable=$row_vend['usuario'];
	
	$afecha=explode('-',trim(substr($fecha,0,10)));
	$fecha=$afecha[2]."-".$afecha[1]."-".$afecha[0];//." ".substr($fecha,11,18);
	
	$afecha=explode('-',trim(substr($fecha2,0,10)));
	$fecha2=$afecha[2]."-".$afecha[1]."-".$afecha[0];//." ".substr($fecha,11,18);
	
	$afecha=explode('-',trim(substr($f_venc,0,10)));
	$f_venc=$afecha[2]."-".$afecha[1]."-".$afecha[0];//." ".substr($f_venc,11,18);
	


$strSQLCope="select * from costopexpresu where codpresup='".$referencia."'";
$resultadoCope=mysql_query($strSQLCope, $cn);
while($rowCope=mysql_fetch_array($resultadoCope)){

	$totalCostos=$totalCostos+$rowCope['costoparcial'];

}

$strSQLCope="select * from activxpresu where codpresup='".$referencia."'";
$resultadoCope=mysql_query($strSQLCope, $cn);
while($rowCope=mysql_fetch_array($resultadoCope)){

		$totalActxObra=$totalActxObra+$rowCope['costoparcial'];

}

 	  $SQLActvPres="select * from factutilxmov where cod_cab='".$referencia."' order by id " ;
	  $resultadoActvPres=mysql_query($SQLActvPres,$cn); 
	 // echo $SQLActvPres;
	  while($rowActvPres=mysql_fetch_array($resultadoActvPres)){
	 	  
	  $factorpred=$rowActvPres['factorpred'];
	 // echo $factorpred;
      //if($rowActvPres['codconcepto']=='1') $factUtilMat=$rowActvPres['factor'.$factorpred];
	  if($rowActvPres['codconcepto']=='1') $factUtilEquipo=$rowActvPres['factor'.$factorpred];
	  if($rowActvPres['codconcepto']=='2') $factUtilMat=$rowActvPres['factor'.$factorpred];
	  if($rowActvPres['codconcepto']=='3') $factUtilHerra=$rowActvPres['factor'.$factorpred];	  
	  if($rowActvPres['codconcepto']=='4') $factUtilAct=$rowActvPres['factor'.$factorpred];
	  if($rowActvPres['codconcepto']=='5') $factUtilCO=$rowActvPres['factor'.$factorpred];
	  
	 // $factUtilAct=$rowActvPres;
	 // $factUtilCO=$rowActvPres;
	  
	  }
		
//echo $factUtilMat;
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Detalle</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {
	color: #FFFFFF;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo3 {
	color: #003366;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo7 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.Estilo12 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo21 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #FF0000; }
.Estilo24 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #FFFFFF; }
.Estilo25 {
	color: #FF0000;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo29 {color: #FFFFFF; font-weight: bold; font-family: Tahoma, Arial; font-size: 11px; }

-->
</style>
<style media="print" type="text/css">
.no_print{
display:none;
}
</style>
<script src="../jquery-1.2.6.js"></script>
<script src="../jquery.hotkeys.js"></script>
<script language="JavaScript">
jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_esc').addClass('dirty'); 
close()
return false; });
function printer() 
{ 
vbPrintPage(); 
return false; 
} 
</script>
<SCRIPT LANGUAGE="VBScript"> 
Sub window_onunload 
On Error Resume Next 
Set WB = nothing 
End Sub 
Sub vbPrintPage 
OLECMDID_PRINT = 6 
OLECMDEXECOPT_DONTPROMPTUSER = 2 
OLECMDEXECOPT_PROMPTUSER = 1 
On Error Resume Next 
WB.ExecWB OLECMDID_PRINT, OLECMDEXECOPT_DONTPROMPTUSER, OLECMDEXECOPT_PROMPTUSER 
End Sub 
</SCRIPT> 
<style type="text/css">
<!--
.Estilo26 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 11px;
	color: #0066CC;
}
.Estilo31 {color: #FF0000}
.Estilo38 {font-family: Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold; }
-->
</style>
</head>

<body>
<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FF0000">
  <tr>
  <td height="32" colspan="3" align="center" bgcolor="#003366"><span class="Estilo1"><?php echo strtoupper('combo y oferta'); ?> </span></td>
  
  <?php if($flag=='A'){?>
  </tr>
  <tr>
    <td height="21" colspan="3" align="center" ><span class="Estilo21">( Anulado )</span></td>
  </tr> 
  
  <?php }?>
  <tr>
  
    <td width="8" height="86">&nbsp;</td>
    <td width="100%" style="padding-top:10px">
	<fieldset>
    <table width="100%" height="95" border="0" cellpadding="0" cellspacing="0">
       <tr>
        <td width="30" height="19">&nbsp;</td>
        <td width="403"><span class="Estilo12"><span class="Estilo7">Combo</span>: <?php echo $alias ?></strong>  </span></td>
        <td width="293"><span class="Estilo7">Fecha Ini.: </span><span class="Estilo12"><?php echo $fecha?></span></td>
      </tr>
      <tr>
        <td height="19">&nbsp;</td>
        <td ><span class="Estilo7">Unidad:</span><span class="Estilo12"><?php echo $unidad; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="Estilo7">Cantidad:&nbsp;&nbsp;</span><span class="Estilo12">
          <?=$cantidad;?>
        </span></td>
		<td height="19"><span class="Estilo7">Fecha Fin.: </span><span class="Estilo12"><?php echo $fecha2; ?></span></td>
        </tr>
      <tr>
        <td height="19">&nbsp;</td>
        <td><span class="Estilo12"><span class="Estilo7">Cond. pago: </span><?php echo $condnombre; ?></span></td>
        <td  style="color:#FF0000"><span class="Estilo7">Fec.Baja: </span><span class="Estilo12"><?php echo $f_venc; ?></span></td>
      </tr>
      <tr>
        <td height="19">&nbsp;</td>
        <td><span class="Estilo7">Responsable: </span><span class="Estilo12"><?php echo $responsable?></span></td>
        <td>
		<!--<span class="Estilo7">Impuesto:</span> <span class="Estilo25"><?php echo $texto_incl_igv; ?></span>
		
		<span class="Estilo7">Tc.</span><span class="Estilo12"><?php echo $tipo_cambio; ?></span> <span class="Estilo7">&nbsp;&nbsp;&nbsp;Moneda: </span><span class="Estilo7 Estilo31"><?php echo $des_mon; ?></span>-->		</td>
      </tr>
    </table>
	</fieldset>    
	</td>
    <td width="9">&nbsp;</td>
  </tr>
  <tr>
    <td >&nbsp;</td>
    <td valign="top"><table width="100%" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td height="25" colspan="7"><span class="Estilo3">Detalle : </span></td>
        </tr>
      <tr style="background:url(../imagenes/bg_contentbase2.gif); background-color:#999999;  background-position:100% 40%;">
        <td width="51" height="18" align="center" ><span class="Estilo24">Cod.</span></td>
        <td width="107" ><span class="Estilo24">CodAnex</span></td>
        <td width="564" ><span class="Estilo24">Articulo</span></td>
        <td width="105" align="center" ><span class="Estilo24">Und.</span></td>
        <td colspan="2" align="center" ><span class="Estilo24">Cant.</span></td>
        </tr>
	  <?php 
	  
	  $strSQL4=" select * from oferta M inner join oferta_det MD on M.cod_ofe=MD.cod_ofe 
	  where 
	  M.cod_ofe='".$referencia."' order by MD.cod_mofe";
 $resultado4=mysql_query($strSQL4,$cn);
 //echo $strSQL4;
  
$nitems=0;
$Agr="";
$j=0;
$k=0;
 while($row4=mysql_fetch_array($resultado4)){
 
 $nitems=$nitems+1;
	 if($row4['agrupado']!=$Agr){
	 	if($row4['agrupado']=='1')$grupo='Equipos';
		if($row4['agrupado']=='2')$grupo='Materiales';
		if($row4['agrupado']=='3')$grupo='Herramientas';
		
		if($j>0){
		
			
			//if($k==1)$tempUtilDoc=$factUtilMat;
			//if($k==2)$tempUtilDoc=$factUtilHerra;
			
		echo "<tr><td colspan='4'></td><td align='right' valign='top'><span class='Estilo7' >SubTotal2</td><td align='right' valign='top'><span class='Estilo7' >".number_format($tempTotal,2)."</td></tr>";
		
		
			if($grupo=='Equipos'){
			$tempUtilDoc=$factUtilEquipo;
			$tempUtilDoc2=($tempUtilDoc/100)*$tempTotal;
			$totalAgrp= $totalAgrp+($tempUtilDoc2+$tempTotal);
			echo "<tr><td colspan='4'></td><td align='right' valign='top'><span class='Estilo7' >Utilidad(".$tempUtilDoc."%)</td><td align='right' valign='top'><span class='Estilo7' >".number_format($tempUtilDoc2,2)."</td></tr>";
			echo "<tr><td colspan='4'></td><td colspan='2' align='right' valign='top'><span class='Estilo7 Estilo31' >Total Equipos </td><td align='right' valign='top'><span class='Estilo7 Estilo31' >".number_format($tempUtilDoc2+$tempTotal,2)."</td></tr>";
			}
			if($grupo=='Materiales'){
			$tempUtilDoc=$factUtilMat;
			$tempUtilDoc2=($tempUtilDoc/100)*$tempTotal;
			$totalAgrp= $totalAgrp+($tempUtilDoc2+$tempTotal);
			echo "<tr><td colspan='4'></td><td align='right' valign='top'><span class='Estilo7' >Utilidad(".$tempUtilDoc."%)</td><td align='right' valign='top'><span class='Estilo7 ' >".number_format($tempUtilDoc2,2)."</td></tr>";
			echo "<tr><td colspan='4'></td><td colspan='2' align='right' valign='top'><span class='Estilo7 Estilo31' >Total Materiales </td><td align='right' valign='top'><span class='Estilo7 Estilo31' >".number_format($tempUtilDoc2+$tempTotal,2)."</td></tr>";
			}
			
			if($grupo=='Herramientas'){
			$tempUtilDoc=$factUtilHerra;
			$tempUtilDoc2=($tempUtilDoc/100)*$tempTotal;
			$totalAgrp= $totalAgrp+($tempUtilDoc2+$tempTotal);
			echo "<tr><td colspan='4'></td><td align='right' valign='top'><span class='Estilo7' >Utilidad(".$tempUtilDoc."%)</td><td align='right' valign='top'><span class='Estilo7 ' >".number_format($tempUtilDoc2,2)."</td></tr>";
			echo "<tr><td colspan='4'></td><td colspan='2' align='right' valign='top'><span class='Estilo7 Estilo31' >Total Materiales </td><td align='right' valign='top'><span class='Estilo7 Estilo31' >".number_format($tempUtilDoc2+$tempTotal,2)."</td></tr>";
			}
			
			
		
			$k++;
			$tempTotal=0;
		}
				
		echo "<tr><td colspan='7' class='Estilo7' style='color:#EB6105'>".$grupo."</td></tr>";	 
		
	 }
	 
	 
 $Agr=$row4['agrupado'];
	  ?>
	  
      <tr>
        <td valign="top"   bgcolor="#EFEFEF" class="Estilo12" >
		<?php 
		
		$sqlx="SELECT * from producto where idproducto='".$row4['cod_prod']."' ";
		$resultadox=mysql_query($sqlx,$cn);
		$rowx=mysql_fetch_array($resultadox);
		echo $rowx['idproducto'];		
		?></td>
        <td bgcolor="#EFEFEF" valign="top"><span class="Estilo12"><?=$rowx['cod_prod'];?></span></td>
        <td bgcolor="#EFEFEF"><span class="Estilo12"><?php echo substr($row4['nom_prod'],0,50);?></span><span class="Estilo12" ><br>
		<?php
	  $sqlx="SELECT serie from series where producto='".$row4['idproducto']."' and tienda='".$codtienda."' and (ingreso ='".$referencia."' or salida='".$referencia."')";
	//echo $sqlx;
	$seriesx="";
	  $resultadox=mysql_query($sqlx,$cn);
	  if(mysql_num_rows($resultadox)){
	  $c=0;
		  while($rowx=mysql_fetch_array($resultadox)){
		  $d=1;
		  //$f=4*$d;
			  if($c%4==0){
			  $seriesx=$seriesx."<br>"; 
			  $d++;
			  }
			  $seriesx=$seriesx.$rowx['serie'].",&nbsp;&nbsp;";	
			  $c++;  
		  }
	  ?>
	   <?php echo "Series::".$seriesx; } ?>
	   
	   </span></p></td>
        <td align="center" bgcolor="#EFEFEF" valign="top" ><span class="Estilo12">
          <?php 
		$strUND="select * from unidades  where id='".$row4['unidad']."'";
		$resultadoUND=mysql_query($strUND,$cn);
		$rowUND=mysql_fetch_array($resultadoUND);
		 echo $rowUND['nombre'];

			
		?>
        </span></td>
        <td colspan="2" align="center" valign="top" bgcolor="#EFEFEF" ><span class="Estilo12"><?php echo $row4['cantidad'];?></span></td>
        </tr>
	 
	  	  
      <tr style="display:none">
        <td height="21">&nbsp;</td>
        <td colspan="4" align="right">&nbsp;</td>
        <td width="43" align="right">&nbsp;</td>
      </tr>
      <tr style="display:none">
        <td height="21">&nbsp;</td>
        <td colspan="4" align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
	  <?php  }?>
	  
      <tr style="display:none">
        <td height="21">&nbsp;</td>
        <td colspan="4" align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr style="display:none">
        <td height="21">&nbsp;</td>
        <td colspan="4" align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr style="display:none">
        <td height="21">&nbsp;</td>
        <td colspan="4" align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr>
        <td height="21">&nbsp;</td>
        <td colspan="5" align="right">&nbsp;</td>
        <td width="5" align="right">&nbsp;</td>
      </tr>
      <tr>
        <td height="22">&nbsp;</td>
        <td colspan="5" align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
    </table>
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr <?  if ($_REQUEST['formato']=='excel'){  echo 'style="display:none"'; }?>  >
    <td height="19">&nbsp;</td>
    <td valign="top">
	
	<fieldset><legend><span class="Estilo12">Controles</span></legend>
        <table  width="537" border="0" cellpadding="0" cellspacing="0">
          
          <tr>
            <td  width="240">&nbsp;</td>
            <td colspan="4">&nbsp;</td>

		              <td width="128" colspan="4"><center>
		                <a href="#" onClick="javascript:printer()" ><img src="../imgenes/imprimir.gif" alt="Imprimir" width="33" height="33" border="0" class="no_print"></a>
						<a href="#" onClick="javascript:document.location.href='doc_detOfer.php?referencia=<?=$referencia;?>&formato=excel'" ><img src="../imagenes/ico-excel.gif" alt="Exportar Excel" width="33" height="33" border="0" class="no_print"></a>
		              </center></td>
          </tr>
        </table>

    </fieldset>
	
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="19">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
