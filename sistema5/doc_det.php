<?php 
session_start();
include('conex_inicial.php');

$referencia=$_REQUEST['referencia'];
//echo $referencia;

$strsql="select * from cab_mov where cod_cab='$referencia'";
$resultado=mysql_query($strsql,$cn);
$cont=mysql_num_rows($resultado);
$row=mysql_fetch_array($resultado);
//echo $cont;

$noperacion=$row['noperacion'];
$numero=$row['Num_doc'];
$serie=$row['serie'];
$flag=$row['flag'];

//echo $numero;
$ruc=$row['ruc'];
$cliente=$row['cliente'];
$fecha=$row['fecha'];
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
$b_imp=$row['b_imp'];
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
	
//	echo $strSQL_clie;
	
	$strSQL_ope="select *  from operacion where codigo='".$cod_ope."'";
	$resultado_ope=mysql_query($strSQL_ope,$cn);
	$row_ope=mysql_fetch_array($resultado_ope);
	$ticket=$row_ope['descripcion'];
	
	
	$strSQL_emp="select des_suc from sucursal where cod_suc='".$codsucursal."'";
	$resultado_emp=mysql_query($strSQL_emp,$cn);
	$row_emp=mysql_fetch_array($resultado_emp);
	$dessuc=$row_emp['des_suc'];
	
	
	
	$strSQL_tien="select des_tienda from tienda where cod_tienda='".$codtienda."'";
	$resultado_tien=mysql_query($strSQL_tien,$cn);
	$row_tien=mysql_fetch_array($resultado_tien);
	$destienda=$row_tien['des_tienda'];
	
	$empresa=$dessuc." / ".$destienda;
	
	$strSQL_vend="select usuario from usuarios where codigo='".$cod_vendedor."'";
	$resultado_vend=mysql_query($strSQL_vend,$cn);
	$row_vend=mysql_fetch_array($resultado_vend);
	
	$responsable=$row_vend['usuario'];
	
	$afecha=explode('-',trim(substr($fecha,0,10)));
	$fecha=$afecha[2]."-".$afecha[1]."-".$afecha[0]." ".substr($fecha,11,18);



$strSQLCope="select * from costopexpresu where codpresup='".$referencia."'";
$resultadoCope=mysql_query($strSQLCope, $cn);
while($rowCope=mysql_fetch_array($resultadoCope)){

	$totalCostos=$totalCostos+$rowCope['costoparcial'];
	/*
	if($moneda==$rowCope['moneda']){
	$totalCostos=$totalCostos+$rowCope['costoparcial'];
	}else{
		if($rowCope['moneda']=='01'){
		$totalCostos=$totalCostos+($rowCope['costoparcial']/$tipo_cambio);
		}else{
		$totalCostos=$totalCostos+($rowCope['costoparcial']*$tipo_cambio);
		}
	
	}
	*/
	
}

$strSQLCope="select * from activxpresu where codpresup='".$referencia."'";
$resultadoCope=mysql_query($strSQLCope, $cn);
while($rowCope=mysql_fetch_array($resultadoCope)){

		$totalActxObra=$totalActxObra+$rowCope['costoparcial'];
	/*
	if($moneda==$rowCope['moneda']){
	$totalActxObra=$totalActxObra+$rowCope['costoparcial'];
	}else{
		if($rowCope['moneda']=='01'){
		$totalActxObra=$totalActxObra+($rowCope['costoparcial']/$tipo_cambio);
		}else{
		$totalActxObra=$totalActxObra+($rowCope['costoparcial']*$tipo_cambio);
		}
	
	}
	
	*/
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
	  $cargoDes=$rowActvPres['cargodes'];
	  $tipoCargoDes=$rowActvPres['tipoCargoDes'];
	  
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
<script src="jquery-1.2.6.js"></script>
<script src="jquery.hotkeys.js"></script>
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
.Estilo39 {color: #000000}
-->
</style>
</head>

<body>
<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>
<table width="100%" height="516" border="0" cellpadding="0" cellspacing="0">
  <tr>
  <td height="32" colspan="3" align="center" bgcolor="#003366"><span class="Estilo1"><?php echo strtoupper($ticket); ?> </span></td>
  
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
        <td height="19">&nbsp;</td>
        <td colspan="2"><span class="Estilo7">Empresa/ Tienda: </span><span class="Estilo12"><?php echo $empresa; ?></span></td>
      </tr>
      <tr>
        <td width="20" height="19">&nbsp;</td>
        <td width="268"><span class="Estilo12"><span class="Estilo7">TD</span>: <?php echo $cod_ope." : ".$serie."-".$numero ?></strong></span></td>
        <td width="191">
		<!--
		<span class="Estilo12"><?php //echo "Nro.Operaci&oacute;n: ".str_pad($noperacion, 10, "0", STR_PAD_LEFT)?></span>-->
		
		
		<span class="Estilo7">Fecha: </span><span class="Estilo12"><?php echo $fecha?></span></td>
      </tr>
      <tr>
        <td height="19">&nbsp;</td>
        <td><span class="Estilo7">Se&ntilde;ores:</span><span class="Estilo12"> <?php echo $razonsocial; ?></span></td>
        <td><span class="Estilo7">Ruc:</span><span class="Estilo12"><?php echo $ruc; ?></span></td>
      </tr>
      <tr>
        <td height="19">&nbsp;</td>
        <td><span class="Estilo7">Direcci&oacute;n</span>:<span class="Estilo12"><?php echo $direccion; ?></span></td>
        <td><span class="Estilo7">Tc.</span><span class="Estilo12"><?php echo $tipo_cambio; ?></span> <span class="Estilo7">&nbsp;&nbsp;&nbsp;Moneda: </span><span class="Estilo7 Estilo31"><?php echo $des_mon; ?></span></td>
      </tr>
      <tr>
        <td height="19">&nbsp;</td>
        <td><span class="Estilo7">Responsable: </span><span class="Estilo12"><?php echo $responsable?></span></td>
        <td><span class="Estilo7">Impuesto:</span> <span class="Estilo25"><?php echo $texto_incl_igv; ?></span></td>
      </tr>
    </table>
    </fieldset>
	</td>
    <td width="9">&nbsp;</td>
  </tr>
  <tr>
    <td height="278">&nbsp;</td>
    <td><table width="100%" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td height="25" colspan="7"><span class="Estilo3">Detalle : </span></td>
        </tr>
      <tr style="background:url(imagenes/bg_contentbase2.gif);  background-position:100% 40%;">
        <td width="60" height="18" align="center" ><span class="Estilo24">Cod. </span></td>
        <td width="500" ><span class="Estilo24">Producto</span></td>
        <td width="31" align="center" ><span class="Estilo24">Und.</span></td>
        <td width="37" align="center" ><span class="Estilo24">Factor Conv. </span></td>
        <td width="60" align="center" ><span class="Estilo24">Cant.</span></td>
        <td width="60" align="right" ><span class="Estilo24">P.Unit</span></td>
        <td width="59" align="right" ><span class="Estilo24">Total</span></td>
      </tr>
	  <?php 
	  
	  $strSQL4="select cantidad,idproducto,nom_prod,det_mov.precio as precioU,unidad,agrupado,des_clas  from det_mov,producto,clasificacion where det_mov.cod_prod=idproducto and clasificacion=idclasificacion and cod_cab='".$referencia."' order by agrupado";

 $resultado4=mysql_query($strSQL4,$cn);
 //echo $strSQL4;
  
$nitems=0;
$Agr="";
$j=0;
$k=0;
 while($row4=mysql_fetch_array($resultado4)){
 
 $nitems=$nitems+1;
	 if($row4['agrupado']!=$Agr){
	 	if($row4['agrupado']=='1')$grupo='Materiales';
		if($row4['agrupado']=='2')$grupo='Equipos';
		if($row4['agrupado']=='3')$grupo='Herramientas';
		
		if($j>0){
		
			
			//if($k==1)$tempUtilDoc=$factUtilMat;
			//if($k==2)$tempUtilDoc=$factUtilHerra;
			
		echo "<tr><td colspan='5'></td><td align='right' valign='top'><span class='Estilo7' >SubTotal</td><td align='right' valign='top'><span class='Estilo7' >".number_format($tempTotal,2)."</td></tr>";
		
		
			if($grupo=='Equipos'){
			$tempUtilDoc=$factUtilEquipo;
			$tempUtilDoc2=($tempUtilDoc/100)*$tempTotal;
			$totalAgrp= $totalAgrp+($tempUtilDoc2+$tempTotal);
			echo "<tr><td colspan='5'></td><td align='right' valign='top'><span class='Estilo7' >Utilidad(".$tempUtilDoc."%)</td><td align='right' valign='top'><span class='Estilo7' >".number_format($tempUtilDoc2,2)."</td></tr>";
			echo "<tr><td colspan='4'></td><td colspan='2' align='right' valign='top'><span class='Estilo7 Estilo31' >Total Equipos </td><td align='right' valign='top'><span class='Estilo7 Estilo31' >".number_format($tempUtilDoc2+$tempTotal,2)."</td></tr>";
			}
			if($grupo=='Materiales'){
			$tempUtilDoc=$factUtilMat;
			$tempUtilDoc2=($tempUtilDoc/100)*$tempTotal;
			$totalAgrp= $totalAgrp+($tempUtilDoc2+$tempTotal);
			echo "<tr><td colspan='5'></td><td align='right' valign='top'><span class='Estilo7' >Utilidad(".$tempUtilDoc."%)</td><td align='right' valign='top'><span class='Estilo7 ' >".number_format($tempUtilDoc2,2)."</td></tr>";
			echo "<tr><td colspan='4'></td><td colspan='2' align='right' valign='top'><span class='Estilo7 Estilo31' >Total Materiales </td><td align='right' valign='top'><span class='Estilo7 Estilo31' >".number_format($tempUtilDoc2+$tempTotal,2)."</td></tr>";
			}
			
			if($grupo=='Herramientas'){
			$tempUtilDoc=$factUtilHerra;
			$tempUtilDoc2=($tempUtilDoc/100)*$tempTotal;
			$totalAgrp= $totalAgrp+($tempUtilDoc2+$tempTotal);
			echo "<tr><td colspan='5'></td><td align='right' valign='top'><span class='Estilo7' >Utilidad(".$tempUtilDoc."%)</td><td align='right' valign='top'><span class='Estilo7 ' >".number_format($tempUtilDoc2,2)."</td></tr>";
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
        <td valign="top"   bgcolor="#EFEFEF" class="Estilo12" ><?php echo substr($row4['idproducto'],0,50);?></td>
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
        <td valign="top"  align="center" bgcolor="#EFEFEF"><span class="Estilo12"><?php 
		$strUND="select * from unidades  where id='".$row4['unidad']."'";
		$resultadoUND=mysql_query($strUND,$cn);
		$rowUND=mysql_fetch_array($resultadoUND);
		 echo $rowUND['nombre'];

			
		?></span></td>
        <td valign="top"  align="center" bgcolor="#EFEFEF"><span class="Estilo12">
        
		<?php 
		$strUND="select * from unixprod  where unidad='".$row4['unidad']."' and producto='".$row4['cod_prod']."'";
		$resultadoUND=mysql_query($strUND,$cn);
		$rowUND=mysql_fetch_array($resultadoUND);
		 echo $rowUND['factor'];

			
		?>
        </span></td>
        <td align="center" bgcolor="#EFEFEF" valign="top" ><span class="Estilo12"><?php echo $row4['cantidad'];?></span></td>
        <td align="right" bgcolor="#EFEFEF" valign="top" ><span class="Estilo12"><?php 
	
	$strSQL40="select * from producto where idproducto='".$row4['cod_prod']."'";
 $resultado40=mysql_query($strSQL40,$cn);
	$row40=mysql_fetch_array($resultado40);
	
	$total=$row4['precioU']*$row4['cantidad'];
	$tempTotal=$tempTotal+$total;
//	$importe=$importe+$total;
	
	if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	echo number_format($row4['precioU'],2);
	}
	?></span></td>
        <td align="right" valign="top"  bgcolor="#EFEFEF"><span class="Estilo12" ><?php 
		if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	echo number_format($total,2);
	}
		 ?></span></td>
      </tr>
	  <?php 
	  
	 $j++; 
	  }
	  /*
	  echo "<tr><td colspan='5'></td><td align='right' valign='top'><span class='Estilo7' >SubTotal</td><td align='right' valign='top'><span class='Estilo7' >".number_format($tempTotal,2)."</td></tr>";
	  $tempUtilDoc2=($factUtilHerra/100)*$tempTotal;
	  echo "<tr><td colspan='5'></td><td align='right' valign='top'><span class='Estilo7' >Utilidad(".$factUtilHerra."%)</td><td align='right' valign='top'><span class='Estilo7' >".number_format($tempUtilDoc2,2)."</td></tr>";
	
	  echo "<tr><td colspan='4'></td><td colspan='2' align='right' valign='top'><span class='Estilo7 Estilo31' >Total ".$grupo." </td><td align='right' valign='top'><span class='Estilo7 Estilo31' >".number_format($tempUtilDoc2+$tempTotal,2)."</td></tr>";
	  $totalAgrp= $totalAgrp+($tempUtilDoc2+$tempTotal);
	  */
	  
	 echo "<tr><td colspan='5'></td><td align='right' valign='top'><span class='Estilo7' >SubTotal</td><td align='right' valign='top'><span class='Estilo7' >".number_format($tempTotal,2)."</td></tr>";
		
		
			if($grupo=='Equipos'){
			$tempUtilDoc=$factUtilEquipo;
			$tempUtilDoc2=($tempUtilDoc/100)*$tempTotal;
			$totalAgrp= $totalAgrp+($tempUtilDoc2+$tempTotal);
			echo "<tr><td colspan='5'></td><td align='right' valign='top'><span class='Estilo7' >Utilidad(".$tempUtilDoc."%)</td><td align='right' valign='top'><span class='Estilo7' >".number_format($tempUtilDoc2,2)."</td></tr>";
			echo "<tr><td colspan='4'></td><td colspan='2' align='right' valign='top'><span class='Estilo7 Estilo31' >Total Equipos </td><td align='right' valign='top'><span class='Estilo7 Estilo31' >".number_format($tempUtilDoc2+$tempTotal,2)."</td></tr>";
			}
			if($grupo=='Materiales'){
			$tempUtilDoc=$factUtilMat;
			$tempUtilDoc2=($tempUtilDoc/100)*$tempTotal;
			$totalAgrp= $totalAgrp+($tempUtilDoc2+$tempTotal);
			echo "<tr><td colspan='5'></td><td align='right' valign='top'><span class='Estilo7' >Utilidad(".$tempUtilDoc."%)</td><td align='right' valign='top'><span class='Estilo7 ' >".number_format($tempUtilDoc2,2)."</td></tr>";
			echo "<tr><td colspan='4'></td><td colspan='2' align='right' valign='top'><span class='Estilo7 Estilo31' >Total Materiales </td><td align='right' valign='top'><span class='Estilo7 Estilo31' >".number_format($tempUtilDoc2+$tempTotal,2)."</td></tr>";
			}
			
			if($grupo=='Herramientas'){
			$tempUtilDoc=$factUtilHerra;
			$tempUtilDoc2=($tempUtilDoc/100)*$tempTotal;
			$totalAgrp= $totalAgrp+($tempUtilDoc2+$tempTotal);
			echo "<tr><td colspan='5'></td><td align='right' valign='top'><span class='Estilo7' >Utilidad(".$tempUtilDoc."%)</td><td align='right' valign='top'><span class='Estilo7 ' >".number_format($tempUtilDoc2,2)."</td></tr>";
			echo "<tr><td colspan='4'></td><td colspan='2' align='right' valign='top'><span class='Estilo7 Estilo31' >Total Materiales </td><td align='right' valign='top'><span class='Estilo7 Estilo31' >".number_format($tempUtilDoc2+$tempTotal,2)."</td></tr>";
			}
	  
	  //-----------------------------------------------------Subtotal presupuesto------------------------
	  
	   echo "<tr><td colspan='4'></td><td colspan='3' align='right' valign='top'><span class='Estilo7 ' >-------------------------------------------------------------</td></tr>";
	   
	   echo "<tr><td colspan='4'></td><td bgcolor='#F9DB64' colspan='2' align='right' valign='top'><span class='Estilo7 Estilo31' >SUBTOTAL PRESUPUESTO </td><td bgcolor='#F9DB64' align='right' valign='top'><span class='Estilo7 Estilo31' >".number_format($totalAgrp,2)."</td></tr>";
	  
	  
	  //----------------------------------------------------------------------------------------------------
	  
	  
	  if($inafecto=='N'){
	  ?>
	  	  
      <tr style="display:none">
        <td height="21">&nbsp;</td>
        <td colspan="5" align="right"><span class="Estilo7">Base Imponible </span></td>
        <td align="right"><span class="Estilo2"><?php 
		if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	echo $b_imp;
	}
		?></span></td>
      </tr>
      <tr style="display:none">
        <td height="21">&nbsp;</td>
        <td colspan="5" align="right"><span class="Estilo7">Impuesto (<?php echo $impto?> %)</span></td>
        <td align="right"><span class="Estilo2"><?php 
		if ($_SESSION['nivel_usu']==2){
		echo '***';
		}else{
		echo $igv;
		}
		?></span></td>
      </tr>
	  <?php  }?>
	  
      <tr style="display:none">
        <td height="21">&nbsp;</td>
        <td colspan="5" align="right"><span class="Estilo7">SubTotal</span></td>
        <td align="right"><span class="Estilo2"><span class="Estilo7"><?php //echo $simbolo;?></span>
          <?php 
		if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	echo number_format($importe,2);
	}	
		?></span></td>
      </tr>
      <tr style="display:none">
        <td height="21">&nbsp;</td>
        <td colspan="5" align="right"><span class="Estilo7">Utilidad (<?php echo $factUtilMat."% "?>)</span></td>
        <td align="right"><span class="Estilo2">
		
		<?php 
		
		echo number_format(($importe*$factUtilMat/100),2)
		
		?>
		
		</span></td>
      </tr>
      <tr style="display:none">
        <td height="21">&nbsp;</td>
        <td colspan="5" align="right"><span class="Estilo7 Estilo31">TOTAL</span></td>
        <td align="right"><span class="Estilo12"><strong>
		<?php echo $simbolo;?>
          <?php 
		echo number_format($importe+($importe*$factUtilMat/100),2)
		
		?></strong>
        </span></td>
      </tr>
      <tr>
        <td height="21">&nbsp;</td>
        <td colspan="5" align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr>
        <td height="21" colspan="7">
		<?php if($cod_ope=='PO'){?>
		
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="2"><span class="Estilo26"><span class="Estilo7"></span></span><span class="Estilo7"> &nbsp;<span class="Estilo26">Costos Actividades por Obra &nbsp;</span></span></td>
            <td width="120" align="right">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3">
			
			<table id="tblCostos" width="100%" border="0" cellpadding="0" cellspacing="1">
          <tr style="background:url(imagenes/bg_contentbase4.gif) 100%">
            <td width="64" height="21"><span class="Estilo29">Area Costo</span></td>
            <td width="520"><span class="Estilo29">Proceso</span></td>
            <td width="73" align="center"><span class="Estilo29">costo</span></td>
            <td width="79" align="center"><span class="Estilo29">cantidad</span></td>
            <td width="123" align="center"><span class="Estilo29">costo parcial</span></td>
            </tr>
          <?php
	  
	  $SQLActvPres="select * from activxpresu where codpresup='".$referencia."' order by areacosto " ;
	  $resultadoActvPres=mysql_query($SQLActvPres,$cn);
	  while($rowActvPres=mysql_fetch_array($resultadoActvPres)){
	  ?>
          <tr>
            <td height="26" bgcolor="#F5F5F5"><span class="Estilo12"><?php 
			  $SQLCC="select * from areacosto where id='".$rowActvPres['areacosto']."' " ;
			  $resultadoCC=mysql_query($SQLCC,$cn);
			  $rowCC=mysql_fetch_array($resultadoCC);
			  	
				echo $rowCC['nombre'];
			
			?></span></td>
            <td bgcolor="#F5F5F5"><span class="Estilo12"><?php
			
			 $SQLCC="select * from procesos where id='".$rowActvPres['procesos']."' " ;
			  $resultadoCC=mysql_query($SQLCC,$cn);
			  $rowCC=mysql_fetch_array($resultadoCC);
			  	
				echo $rowCC['nombre'];
			 //echo 
			 
			 ?></span></td>
            <td align="right" bgcolor="#F5F5F5" class="Estilo12">
			<?php echo $rowActvPres['costo']?>            </td>
            <td align="right" bgcolor="#F5F5F5" class="Estilo12"><?php echo $rowActvPres['cantidad']?></td>
            <td align="right" bgcolor="#F5F5F5" class="Estilo12"><?php echo $rowActvPres['costoparcial']?>       </td>
            </tr>
          <?php }?>
      </table>			</td>
            </tr>
          <tr>
            <td colspan="2" align="right"><span class="Estilo7">SubTotal</span></td>
            <td align="right"><span class="Estilo2"><span class="Estilo7"><?php //echo $simbolo;?></span>
                  <?php 
		if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	echo number_format($totalActxObra,2);
	}	
		?>
            </span></td>
          </tr>
          <tr>
            <td colspan="2" align="right"><span class="Estilo7">Utilidad (<?php echo $factUtilAct."% "?>)</span></td>
            <td align="right"><span class="Estilo2">
              <?php 
		
		echo number_format(($totalActxObra*$factUtilAct/100),2)
		
		?>
            </span></td>
          </tr>
          <tr>
            <td colspan="2" align="right"><span class="Estilo7 Estilo31">TOTAL</span></td>
            <td align="right"><span class="Estilo12"><strong> <?php //echo $simbolo;?>
                    <?php 
		echo number_format($totalActxObra+($totalActxObra*$factUtilAct/100),2);
		$subCostosAct=$totalActxObra+($totalActxObra*$factUtilAct/100);
		?>
            </strong> </span></td>
          </tr>
          <tr>
            <td colspan="2"><span class="Estilo26">Costos Operativos</span></td>
            <td align="right">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3"><table id="tblCostos" width="100%" border="0" cellpadding="0" cellspacing="1">
              <tr style="background:url(imagenes/bg_contentbase4.gif) 100%">
                <td width="45">&nbsp;</td>
                <td width="539" height="24"><span class="Estilo29">Descripci&oacute;n</span></td>
                <td width="72" align="center"><span class="Estilo29">costo</span></td>
                <td width="84" align="center"><span class="Estilo29">cantidad</span></td>
                <td width="119" align="center"><span class="Estilo29">costo parcial</span></td>
                </tr>
              <?php
	  
	  $SQLActvPres="select * from costopexpresu where codpresup='".$referencia."' order by costoope " ;
	  $resultadoActvPres=mysql_query($SQLActvPres,$cn);
	  while($rowActvPres=mysql_fetch_array($resultadoActvPres)){
	  ?>
              <tr>
                <td bgcolor="#F5F5F5">&nbsp;</td>
                <td height="26" bgcolor="#F5F5F5"><span class="Estilo12">
                  <?php
			
			 $SQLCC="select * from costoperativo where id='".$rowActvPres['costoope']."' " ;
			  $resultadoCC=mysql_query($SQLCC,$cn);
			  $rowCC=mysql_fetch_array($resultadoCC);
			  	
				echo $rowCC['nombre'];
			 //echo 
			 
			 ?>
                </span></td>
                <td align="right" bgcolor="#F5F5F5" class="Estilo12"><?php echo $rowActvPres['costo']?>            </td>
                <td align="right" bgcolor="#F5F5F5" class="Estilo12"><?php echo $rowActvPres['cantidad']?>          </td>
                <td align="right" bgcolor="#F5F5F5" class="Estilo12"><?php echo $rowActvPres['costoparcial']?> </td>
                </tr>
              <?php }?>
            </table></td>
            </tr>
          <tr>
            <td colspan="2" align="right"><span class="Estilo7">SubTotal</span></td>
            <td align="right"><span class="Estilo2"><span class="Estilo7"><?php //echo $simbolo;?></span>
                  <?php 
		if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	echo number_format($totalCostos,2);
	}	
		?>
            </span></td>
          </tr>
          <tr>
            <td colspan="2" align="right"><span class="Estilo7">Utilidad (<?php echo $factUtilCO."% "?>)</span></td>
            <td align="right"><span class="Estilo2">
              <?php 
		
		echo number_format(($totalCostos*$factUtilCO/100),2)
		
		?>
            </span></td>
          </tr>
          <tr>
            <td colspan="2" align="right"><span class="Estilo7 Estilo31">TOTAL</span></td>
            <td align="right"><span class="Estilo12"><strong> <?php //echo $simbolo;?>
                    <?php 
		echo number_format($totalCostos+($totalCostos*$factUtilCO/100),2);
		$subCostosOpe=$totalCostos+($totalCostos*$factUtilCO/100);
		
		
		?>
            </strong> </span></td>
          </tr>
          <tr>
            <td width="502">&nbsp;</td>
            <td width="236" align="right">&nbsp;</td>
            <td align="right">&nbsp;</td>
          </tr>
          <tr>
            <td height="40" rowspan="4" align="right" >&nbsp;</td>
            <td height="20" align="right" bgcolor='#F9DB64' ><span class="Estilo7 Estilo39">Descuentos / Cargos </span></td>
            <td align="right" bgcolor="#F5D976"><span class="Estilo38"><?php 
			
			if($tipoCargoDes=='1'){
				$montoCargoDes=($subCostosAct+$subCostosOpe+$totalAgrp)*($cargoDes/100);	
			}else{
			    $montoCargoDes=$cargoDes;	
			}
			
			echo number_format($montoCargoDes,2);
			
			?></span></td>
          </tr>
          <tr>
            <td height="20" align="right" bgcolor='#F9DB64' ><span class="Estilo7 Estilo39">Neto con Descuentos / Cargos </span></td>
            <td align="right" bgcolor="#F5D976"><span class="Estilo38"><?php 
			
			$netoConDesc=($subCostosAct+$subCostosOpe+$totalAgrp)-$montoCargoDes;
			echo number_format(($subCostosAct+$subCostosOpe+$totalAgrp)-$montoCargoDes,2);
						
			?></span></td>
          </tr>
          <tr>
            <td height="20" align="right" bgcolor='#F9DB64' ><span class="Estilo31 Estilo7">IGV (18%) </span></td>
            <td align="right" bgcolor="#F5D976"><span class="Estilo38"><?php echo number_format(($netoConDesc)*0.18,2);?></span></td>
          </tr>
          <tr>
            <td height="20" align="right" bgcolor='#F9DB64' ><span class="Estilo31 Estilo7">TOTAL GENERAL PRESUPUESTO </span></td>
            <td align="right" bgcolor="#F5D976"><span class="Estilo38"><?php echo $simbolo;?> <?php echo number_format($netoConDesc+($netoConDesc*0.18),2);?></span></td>
          </tr>
        </table>
		
		<?php }?>		</td>
        </tr>
      <tr>
        <td height="22">&nbsp;</td>
        <td colspan="5" align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="19">&nbsp;</td>
    <td><fieldset><legend><span class="Estilo12">Auditoria</span></legend>
        <table  width="537" border="0" cellpadding="0" cellspacing="0">
          
          <tr>
            <td  width="240"><span class="Estilo7">Fecha de Creaci&oacute;n : </span><span class="Estilo12"><?php echo $fecha_aud?></span></td>
            <td colspan="4"><span class="Estilo7">Nombre PC: </span><span class="Estilo12"><?php echo $nom_pc?></span></td>

		              <td width="128" colspan="4"><center><a href="#" onClick="javascript:printer()" ><img src="imgenes/imprimir.gif" width="42" height="42" border="0" class="no_print"></a></center></td>
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
