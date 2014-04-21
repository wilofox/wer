<?php 
session_start();
include('../conex_inicial.php');

$referencia=$_REQUEST['referencia'];
//echo $referencia;
$strsql="select * from cab_mov where cod_cab='$referencia'";
$resultado=mysql_query($strsql,$cn);
$cont=mysql_num_rows($resultado);
$row=mysql_fetch_array($resultado);

// $strSQLRef="select referencia.* from referencia,cab_mov where cab_mov.cod_cab=referencia.cod_cab_ref and referencia.cod_cab='".$referencia."' and cod_ope='SM'";


list($seriePO,$numeroPO,$codcabPO)=mysql_fetch_row(mysql_query("SELECT serie,correlativo,cod_cab_ref FROM referencia WHERE cod_cab = '".$referencia."'"));


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
	  
	  }
//----------------------------------documentos de salidas--------------------------------

list($totalDocSal)=mysql_fetch_row(mysql_query("SELECT sum(b_imp) FROM cab_mov  WHERE  numeroOT = '$serie-$numero' and tipo='2' and cod_ope='FA' and flag!='A' "));

//echo "SELECT sum(b_imp) FROM cab_mov  WHERE  numeroOT = '$serie-$numero' and tipo='2' and cod_ope='FA' and flag!='A' ";

//----------------------------------------------------------------------------------------		
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
img { behavior: url(../ventas/iepngfix.htc); }
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
//vbPrintPage(); 
//return false; 
print();
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
.Estilo31 {color: #FF0000}
.Estilo39 {font-family: Geneva, Arial, Helvetica, sans-serif}
.Estilo40 {
	color: #0066FF;
	font-weight: bold;
	font-size: 11px;
}
.Estilo41 {font-size: 11px}
.Estilo42 {
	color: #0066FF;
	font-weight: bold;
}
.Estilo43 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-style: italic;
	font-weight: bold;
}
.Estilo29 {color: #FFFFFF; font-weight: bold; font-family: Tahoma, Arial; font-size: 11px; }
.Estilo44 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #0033FF;
	font-size: 18px;
}
.Estilo45 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.Estilo46 {font-size: 12}
-->
</style>
</head>

<body>
<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>
<table width="100%" height="523" border="0" cellpadding="0" cellspacing="0">
  <tr>
  <td height="39" colspan="3" align="center" bgcolor="#003366"><span class="Estilo1"><?php echo strtoupper($ticket); ?> <br>
    ( LIQUIDACI&Oacute;N GENERAL ) </span></td>
  
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
        <td colspan="3"><span class="Estilo7">Empresa/ Tienda: </span><span class="Estilo12"><?php echo $empresa; ?></span></td>
      </tr>
      <tr>
        <td width="34" height="19">&nbsp;</td>
        <td width="395"><span class="Estilo12"><span class="Estilo7">TD</span>: <?php echo $cod_ope." : ".$serie."-".$numero ?></strong></span></td>
        <td width="213">
		<!--
		<span class="Estilo12"><?php //echo "Nro.Operaci&oacute;n: ".str_pad($noperacion, 10, "0", STR_PAD_LEFT)?></span>-->
		
		
		<span class="Estilo7">Fecha: </span><span class="Estilo12"><?php echo $fecha?></span></td>
        <td width="190" align="center"><span class="Estilo43 no_print" >Imprimir</span></td>
      </tr>
      <tr>
        <td height="19">&nbsp;</td>
        <td><span class="Estilo7">Se&ntilde;ores:</span><span class="Estilo12"> <?php echo $razonsocial; ?></span></td>
        <td><span class="Estilo7">Ruc:</span><span class="Estilo12"><?php echo $ruc; ?></span></td>
        <td width="190" rowspan="2" align="center"><a href="#" onClick="javascript:printer()" ><img src="../imgenes/imprimir.gif" width="35" height="35" border="0" class="no_print"></a></td>
      </tr>
      <tr>
        <td height="19">&nbsp;</td>
        <td><span class="Estilo7">Direcci&oacute;n</span>:<span class="Estilo12"><?php echo $direccion; ?></span></td>
        <td><span class="Estilo7 Estilo31">PRESUPUESTO:&nbsp; </span><span class="Estilo12 Estilo42"> <?php echo $seriePO."-".$numeroPO; ?>&nbsp;&nbsp; </span><img onClick="origenPO('<?php echo $codcabPO ?>')" src="../imagenes/ico_lupa.png"  width="16" height="16" border="0" style="cursor:pointer"></td>
        </tr>
      <tr>
        <td height="19">&nbsp;</td>
        <td><span class="Estilo7">Responsable: </span><span class="Estilo12"><?php echo $responsable?></span></td>
        <td colspan="2"><span class="Estilo7">Moneda: <?php 
		if($moneda=='01')
		echo " SOLES (S/.)";
		else
		echo " DOLARES (US$.)";
		
		?></span></td>
      </tr>
    </table>
    </fieldset>	</td>
    <td width="9">&nbsp;</td>
  </tr>
  <tr>
    <td height="278">&nbsp;</td>
    <td><table width="100%" cellpadding="1" cellspacing="1" >
      <tr>
        <td height="29" colspan="10" align="center" valign="bottom"><table width="347" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="207"><span class="Estilo44">MONTO FACTURADO: </span></td>
            <td width="140" align="center" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px"><span class="Estilo45">
              <?php 
		
		if($moneda=='01')
		echo "  S/.";
		else
		echo "  US$.";
		?>
              <?php echo number_format($totalDocSal,2) ?></span></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td height="16" colspan="10"><span class="Estilo3">Detalle : </span></td>
      </tr>
      <tr style="background:url(../imagenes/bg_contentbase2.gif);  background-position:100% 50%;">
        <td width="54" height="18" align="center" ><span class="Estilo24">Cod. </span></td>
        <td width="287" ><span class="Estilo24">Producto</span></td>
        <td width="88" align="center" ><span class="Estilo24 Estilo39">Presupuestado</span></td>
        <td width="79" align="center" ><span class="Estilo24">Entregado (SM ref. GR) </span></td>
        <td width="69" align="center" ><span class="Estilo24">Entregado (GR) </span></td>
        <td width="69" align="center" ><span class="Estilo24">Devuelto (RM) </span></td>
        <td width="69" align="center" ><span class="Estilo24">Devuelto (Otros)</span></td>
        <td width="69" align="center" ><span class="Estilo24">Por Entregar</span></td>
        <!--
        <td width="67" align="center" ><span class="Estilo24">Stock</span></td>
        <td width="84" align="center" ><span class="Estilo24">Por Comprar </span></td>
		-->
      </tr>
      <?php 
	  $campoSaldo="saldo".$codtienda; 
	  $strSQL4="select cantidad,imp_item,idproducto,nom_prod,det_mov.precio as precioU,unidad,agrupado,".$campoSaldo." from det_mov,producto,clasificacion where det_mov.cod_prod=idproducto and clasificacion=idclasificacion and cod_cab='".$referencia."' order by agrupado,cod_det";
 $resultado4=mysql_query($strSQL4,$cn);
 //echo $strSQL4;
  
$nitems=0;
$Agr="";
$j=0;
$k=0;
 while($row4=mysql_fetch_array($resultado4)){
 
 $stockProd=$row4[$campoSaldo];
 
 $nitems=$nitems+1;
	 if($row4['agrupado']!=$Agr){
	 	if($row4['agrupado']=='1'){$grupo='Materiales';$idgrupo=$row4['agrupado']; }
		if($row4['agrupado']=='2'){
		
		$flag1='';
			
		 $strSQLRef="select referencia.* from referencia,cab_mov where cab_mov.cod_cab=referencia.cod_cab and referencia.cod_cab_ref='".$referencia."' and cod_ope='SM'";
		 
		 $docsSM="";
		 $resultadoRef=mysql_query($strSQLRef,$cn);
		 while($rowRef=mysql_fetch_array($resultadoRef)){
		 $docsSM=$docsSM."'".$rowRef['cod_cab']."',";
		 }
		 if(strlen($docsSM)>0){
		 $docsSM=substr($docsSM,0,strlen($docsSM)-1);
		 }else{
		 $docsSM="''";
		 }
		// echo $docsSM;
			 $strSQLDetx="select d.*,p.*,c.*,sum(d.imp_item) as cantSM from det_mov d,producto p,clasificacion c where d.cod_cab in ($docsSM) and d.cod_prod not in(select cod_prod from det_mov where cod_cab='".$referencia."') and d.cod_ope='SM' and p.idproducto=d.cod_prod and p.clasificacion=c.idclasificacion and c.agrupado='".$idgrupo."' group by p.idproducto,d.cod_ope ";
			 $resultadoDetx=mysql_query($strSQLDetx,$cn);
			 // $entregado=$rowDet['cantidad'];
			// echo $strSQLDetx;
			
			 if(mysql_num_rows($resultadoDetx)>0 && $flag1==''){
			 	echo "<tr><td colspan='7' style='color:000000 ;font-size:10px;font-family: Verdana, Helvetica, sans-serif'><strong>&nbsp;&nbsp;&nbsp;ITEMS NO PRESUPUESTADOS</strong></td></tr>";	 
				$flag1='S';				
			  }
			  while($rowDetx=mysql_fetch_array($resultadoDetx)){
			  $campoProdSM="saldo".$rowDetx['tienda'];
			  
			  
			  		                                											            																																																																																																			          //-------------------------------------RM-----------------------------------------------------------
		 
		// $strSQLDet="select * from det_mov where cod_cab='".$rowRef['cod_cab_ref']."' and cod_prod='".$rowDetx['idproducto']."' and cod_ope='RM'";
		  $strSQLDet="select sum(imp_item) as cantRetor from referencia,det_mov where referencia.cod_cab_ref='".$referencia."' and det_mov.cod_cab=referencia.cod_cab and cod_ope='RM' and cod_prod='".$rowDetx['idproducto']."'";
		 $resultadoDet=mysql_query($strSQLDet,$cn);
		 $rowDet=mysql_fetch_array($resultadoDet);
		 $retornado=$rowDet['cantRetor'];
		 //echo $strSQLDet;
		 //-------------------------------------------------------------------------------------------------
			  //echo $stockProd2;
				  $totalEntregado=$totalEntregado+$rowDetx['cantSM'];
				  $totalRetornado=$totalRetornado+$retornado;
			 ?>
      <tr bgcolor="#EFEFEF" >
        <td height="20" align="center"    class="Estilo12 Estilo41" ><?php echo $rowDetx['idproducto'];?></td>
        <td ><span class="Estilo12 Estilo41"><?php echo substr($rowDetx['nom_prod'],0,50);?></span></td>
        <td  align="center" valign="top" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px"><span class="Estilo12 Estilo40"><?php echo "0.00"?></span></td>
        <td  align="center" valign="top" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($rowDetx['cantSM'],2)?></td>
        <td  align="center" valign="top" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40">&nbsp;</td>
        <td valign="top"  align="center" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($retornado,2)?></td>
        <td valign="top"  align="center" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40">&nbsp;</td>
        <td align="center" bgcolor="#FDF19D" valign="top" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($porEntregar,2)?></td>
        <!--
        <td align="center" bgcolor="#FDF19D" valign="top" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php //echo number_format($rowDetx[$campoProdSM],2)?></td>
        <td align="center" valign="top"  bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><span class="Estilo12 Estilo40" ><?php //echo "0" ?></span></td>
      </tr>
 --->
        <?php 	
		  
		 			  
			//echo  $rowDetx['idproducto']."-".$rowDetx['nom_prod']."<br>";
		 }
		 
		$grupo='Equipos';$idgrupo=$row4['agrupado'];
		}
		if($row4['agrupado']=='3'){
		
		  $flag1='';
			
		 $strSQLRef="select referencia.* from referencia,cab_mov where cab_mov.cod_cab=referencia.cod_cab and referencia.cod_cab_ref='".$referencia."' and cod_ope='SM'";
		 
		 $docsSM="";
			 
		 $resultadoRef=mysql_query($strSQLRef,$cn);
		 while($rowRef=mysql_fetch_array($resultadoRef)){
		 $docsSM=$docsSM."'".$rowRef['cod_cab']."',";
		 }
		 if(strlen($docsSM)>0){
		 $docsSM=substr($docsSM,0,strlen($docsSM)-1);
		 }else{
		 $docsSM="''";
		 }
		// echo $docsSM;
			 $strSQLDetx="select d.*,p.*,c.*,sum(d.imp_item) as cantSM from det_mov d,producto p,clasificacion c where d.cod_cab in ($docsSM) and d.cod_prod not in(select cod_prod from det_mov where cod_cab='".$referencia."') and d.cod_ope='SM' and p.idproducto=d.cod_prod and p.clasificacion=c.idclasificacion and c.agrupado='".$idgrupo."' group by p.idproducto,d.cod_ope ";
			 $resultadoDetx=mysql_query($strSQLDetx,$cn);
			 // $entregado=$rowDet['cantidad'];
			 //echo $strSQLDetx;
			
			 if(mysql_num_rows($resultadoDetx)>0 && $flag1==''){
			 	echo "<tr><td colspan='7' style='color:000000 ;font-size:10px;font-family: Verdana, Helvetica, sans-serif'><strong>&nbsp;&nbsp;&nbsp;ITEMS NO PRESUPUESTADOS</strong></td></tr>";	 
				$flag1='S';				
			  }
			  while($rowDetx=mysql_fetch_array($resultadoDetx)){
			  $campoProdSM="saldo".$rowDetx['tienda'];
			  
			  
			   																																																																																																																											                                                                                                        																																         //-------------------------------------RM-----------------------------------------------------------
		 
		// $strSQLDet="select * from det_mov where cod_cab='".$rowRef['cod_cab_ref']."' and cod_prod='".$rowDetx['idproducto']."' and cod_ope='RM'";
		  $strSQLDet="select sum(imp_item) as cantRetor from referencia,det_mov where referencia.cod_cab_ref='".$referencia."' and det_mov.cod_cab=referencia.cod_cab and cod_ope='RM' and cod_prod='".$rowDetx['idproducto']."'";
		 $resultadoDet=mysql_query($strSQLDet,$cn);
		 $rowDet=mysql_fetch_array($resultadoDet);
		 $retornado=$rowDet['cantRetor'];
		 //echo $strSQLDet;
		 //-------------------------------------------------------------------------------------------------
			  
			  //echo $stockProd2;
			  $totalEntregado=$totalEntregado+$rowDetx['cantSM'];
			  $totalRetornado=$totalRetornado+$retornado;
			 ?>
      <tr bgcolor="#EFEFEF">
        <td height="22" align="center"  class="Estilo12 Estilo41" ><?php echo substr($rowDetx['idproducto'],0,50);?></td>
        <td ><span class="Estilo12 Estilo41"><?php echo substr($rowDetx['nom_prod'],0,50);?></span></td>
        <td  align="center" valign="top" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px"><span class="Estilo12 Estilo40"><?php echo "0.00"?></span></td>
        <td  align="center" valign="top" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($rowDetx['cantSM'],2)?></td>
        <td  align="center" valign="top" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40">&nbsp;</td>
        <td valign="top"  align="center" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($retornado,2)?></td>
        <td valign="top"  align="center" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40">&nbsp;</td>
        <td align="center" bgcolor="#FDF19D" valign="top" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($porEntregar,2)?></td>
        <!--
        <td align="center" bgcolor="#FDF19D" valign="top" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php //echo number_format($rowDetx[$campoProdSM],2)?></td>
        <td align="center" valign="top"  bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><span class="Estilo12 Estilo40" ><?php //echo "0"?></span></td>
      </tr>
	  -->
        <?php 	
		
		 			  
			//echo  $rowDetx['idproducto']."-".$rowDetx['nom_prod']."<br>";
		 }
		$grupo='Herramientas';$idgrupo=$row4['agrupado'];
		
		}
		/*
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
	
	 */			
		echo "<tr><td colspan='8' style='color:#EB6105;font-size:10px;font-family: Verdana, Helvetica, sans-serif'><strong>".strtoupper($grupo)."</strong></td></tr>";	 
		
	 }
	 
 $Agr=$row4['agrupado'];
 
$entregado=0;
$retornado=0;
$porEntregar=0;
$stock=0;
$porComprar=0;

	 $strSQLRef="select * from referencia where cod_cab_ref='".$referencia."'";
	 $resultadoRef=mysql_query($strSQLRef,$cn);
	 while($rowRef=mysql_fetch_array($resultadoRef)){
		 //-------------------------------------SM----------------------------------------------------------
		 $strSQLDet="select * from det_mov where cod_cab='".$rowRef['cod_cab']."' and cod_prod='".$row4['idproducto']."' and cod_ope='SM'";
		 //echo $strSQLDet."<br>";
		 $resultadoDet=mysql_query($strSQLDet,$cn);
		 $rowDet=mysql_fetch_array($resultadoDet);
		 $entregado=$entregado+$rowDet['imp_item'];
		 
		// echo $strSQLDet."<br>";
		 //-------------------------------------------------------------------------------------------------
		 		 																																			        //-------------------------------------RM-----------------------------------------------------------
		 
		 $strSQLDet="select * from det_mov where cod_cab='".$rowRef['cod_cab']."' and cod_prod='".$row4['idproducto']."' and cod_ope='RM'";
		 $resultadoDet=mysql_query($strSQLDet,$cn);
		 $rowDet=mysql_fetch_array($resultadoDet);
		 $retornado=$retornado+$rowDet['imp_item'];
		 
		 
		 //-------------------------------------------------------------------------------------------------
		 
	 }
	 	//*--------------------entregado por GR------------------------------------------------
		
	 $entregadoGR=0;
	 $strSQLDet0="select sum(imp_item) as totalGR from cab_mov c,det_mov d where c.numeroOT='$serie-$numero' and d.cod_prod='".$row4['idproducto']."' and d.cod_ope='GR' and c.cod_cab=d.cod_cab and d.tipo='2' and flag!='A' ";
	    
		 //echo $strSQLDet0."<br>";
		 $resultadoDet0=mysql_query($strSQLDet0,$cn);
		 $rowDet0=mysql_fetch_array($resultadoDet0);
		 $entregadoGR=$entregadoGR+$rowDet0['totalGR'];	
		 
		//-------------------------------------------------------------------------------------
		
		
		//*--------------------Retornado con otros documentos(generador normal)-----------------
		
	 $$retornadoOtros=0;
	 $strSQLDet2="select sum(imp_item) as totalGR from cab_mov c,det_mov d where c.numeroOT='$serie-$numero' and d.cod_prod='".$row4['idproducto']."' and  c.cod_cab=d.cod_cab and d.tipo='2' and flag_kardex='1' and flag!='A' ";
	    
		 //echo $strSQLDet0."<br>";
		 $resultadoDet2=mysql_query($strSQLDet2,$cn);
		 $rowDet2=mysql_fetch_array($resultadoDet2);
		 $retornadoOtros=$retornadoOtros+$rowDet2['totalGR'];	
		 
		//-------------------------------------------------------------------------------------
		
		$totalPresup=$totalPresup+$row4['imp_item'];
		$porEntregar=$row4['imp_item']-$entregado+$retornado;
		$totalEntregado=$totalEntregado+$entregado;
		
		$totalRetornado=$totalRetornado+$retornado;
		
				
	  ?>
      <tr bgcolor="#EFEFEF">
        <td height="22" align="center"   class="Estilo12 Estilo41" ><?php echo substr($row4['idproducto'],0,50);?></td>
        <td ><span class="Estilo12 Estilo41"><?php echo substr($row4['nom_prod'],0,50);?></span></td>
        <td  align="center" valign="top" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px"><span class="Estilo12 Estilo40"><?php echo number_format($row4['imp_item'],2);?></span></td>
        <td  align="center" valign="top" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($entregado,2)?></td>
        <td  align="center" valign="top" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><span class="Estilo12 Estilo40" ><?php echo number_format($entregadoGR,2)?></span></td>
        <td valign="top"  align="center" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($retornado,2)?></td>
        <td valign="top"  align="center" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><span class="Estilo12 Estilo40" ><?php echo number_format($retornadoOtros,2)?></span></td>
        <td align="center" bgcolor="#FDF19D" valign="top" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($porEntregar,2)?></td>
        <!-- 
	    <td align="center" bgcolor="#FDF19D" valign="top" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php //echo number_format($stockProd,2)?></td>
        <td align="center" valign="top"  bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><span class="Estilo12 Estilo40" ><?php //echo "0" ?></span></td>
      </tr>
	  -->
        <?php 
	  $porEntregar=0;
	 $j++; 
	  }
	
	//----------------------------------------NO PRESUPUESDTADOS-------------------------------------------
	
	$flag1='';
			
		 $strSQLRef="select referencia.* from referencia,cab_mov where cab_mov.cod_cab=referencia.cod_cab and referencia.cod_cab_ref='".$referencia."' and cod_ope='SM'";
		 
		 $docsSM="";
		 $resultadoRef=mysql_query($strSQLRef,$cn);
		 while($rowRef=mysql_fetch_array($resultadoRef)){
		 $docsSM=$docsSM."'".$rowRef['cod_cab']."',";
		 }
		 if(strlen($docsSM)>0){
		 $docsSM=substr($docsSM,0,strlen($docsSM)-1);
		 }else{
		 $docsSM="''";
		 }
		// echo $docsSM;
			 $strSQLDetx="select d.*,p.*,c.*,sum(d.imp_item) as cantSM from det_mov d,producto p,clasificacion c where d.cod_cab in ($docsSM) and d.cod_prod not in(select cod_prod from det_mov where cod_cab='".$referencia."') and d.cod_ope='SM' and p.idproducto=d.cod_prod and p.clasificacion=c.idclasificacion and c.agrupado='".$idgrupo."' group by p.idproducto,d.cod_ope ";
			 $resultadoDetx=mysql_query($strSQLDetx,$cn);
			 // $entregado=$rowDet['cantidad'];
			// echo $strSQLDetx;
			
			 if(mysql_num_rows($resultadoDetx)>0 && $flag1==''){
			 	echo "<tr><td colspan='7' style='color:000000 ;font-size:10px;font-family: Verdana, Helvetica, sans-serif'><strong>&nbsp;&nbsp;&nbsp;ITEMS NO PRESUPUESTADOS</strong></td></tr>";	 
				$flag1='S';				
			  }
			  while($rowDetx=mysql_fetch_array($resultadoDetx)){
			  $campoProdSM="saldo".$rowDetx['tienda'];
			  
			   				                                        			            																																									        //-------------------------------------RM-----------------------------------------------------------
		 
		// $strSQLDet="select * from det_mov where cod_cab='".$rowRef['cod_cab_ref']."' and cod_prod='".$rowDetx['idproducto']."' and cod_ope='RM'";
		  $strSQLDet="select sum(imp_item) as cantRetor from referencia,det_mov where referencia.cod_cab_ref='".$referencia."' and det_mov.cod_cab=referencia.cod_cab and cod_ope='RM' and cod_prod='".$rowDetx['idproducto']."'";
		 $resultadoDet=mysql_query($strSQLDet,$cn);
		 $rowDet=mysql_fetch_array($resultadoDet);
		 $retornado=$rowDet['cantRetor'];
		// echo $strSQLDet;
		 //-------------------------------------------------------------------------------------------------
		 
			  //echo $stockProd2;
			  $totalEntregado=$totalEntregado+$rowDetx['cantSM'];
			  $totalRetornado=$totalRetornado+$retornado;
			 ?>
      <tr bgcolor="#EFEFEF">
        <td height="22" align="center"  class="Estilo12 Estilo41" ><?php echo substr($rowDetx['idproducto'],0,50);?></td>
        <td ><span class="Estilo12 Estilo41"><?php echo substr($rowDetx['nom_prod'],0,50);?></span></td>
        <td  align="center" valign="top" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px"><span class="Estilo12 Estilo40"><?php echo "0.00"?></span></td>
        <td  align="center" valign="top" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($rowDetx['cantSM'],2)?></td>
        <td  align="center" valign="top" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40">&nbsp;</td>
        <td valign="top"  align="center" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($retornado,2)?></td>
        <td valign="top"  align="center" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40">&nbsp;</td>
        <td align="center" bgcolor="#FDF19D" valign="top" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($porEntregar,2)?></td>
        <!--
	    <td align="center" bgcolor="#FDF19D" valign="top" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php //echo number_format($rowDetx[$campoProdSM],2)?></td>
        <td align="center" valign="top"  bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><span class="Estilo12 Estilo40" ><?php //echo "0" ?></span></td>
      </tr>
	  -->
        <?php 	
		   }
		 			  
			//echo  $rowDetx['idproducto']."-".$rowDetx['nom_prod']."<br>";
		 
	
	//------------------------------------------------------------------------------------------------------
	
	  /*
	  echo "<tr><td colspan='5'></td><td align='right' valign='top'><span class='Estilo7' >SubTotal</td><td align='right' valign='top'><span class='Estilo7' >".number_format($tempTotal,2)."</td></tr>";
	  $tempUtilDoc2=($factUtilHerra/100)*$tempTotal;
	  echo "<tr><td colspan='5'></td><td align='right' valign='top'><span class='Estilo7' >Utilidad(".$factUtilHerra."%)</td><td align='right' valign='top'><span class='Estilo7' >".number_format($tempUtilDoc2,2)."</td></tr>";
	
	  echo "<tr><td colspan='4'></td><td colspan='2' align='right' valign='top'><span class='Estilo7 Estilo31' >Total ".$grupo." </td><td align='right' valign='top'><span class='Estilo7 Estilo31' >".number_format($tempUtilDoc2+$tempTotal,2)."</td></tr>";
	  $totalAgrp= $totalAgrp+($tempUtilDoc2+$tempTotal);
	  */
	/*  
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
	  */
	  
	
	  ?>
      <tr bgcolor="#EFEFEF">
        <td height="22" align="center" bgcolor="#FFFFFF"  class="Estilo12 Estilo41" >&nbsp;</td>
        <td align="right" bgcolor="#FFFFFF" class="Estilo3" >SubTotal&nbsp;&nbsp; </td>
        <td  align="center" valign="center" bgcolor="#FFFFFF" style="border:#CCCCCC solid 1px"><span class="Estilo7"><?php echo number_format($totalPresup,2)?></span></td>
        <td  align="center" valign="top" bgcolor="#FFFFFF" style="border:#CCCCCC solid 1px"><span class="Estilo7"><?php echo number_format($totalEntregado,2)?></span></td>
        <td  align="center" valign="top" bgcolor="#FFFFFF" style="border:#CCCCCC solid 1px">&nbsp;</td>
        <td valign="top"  align="center" bgcolor="#FFFFFF" style="border:#CCCCCC solid 1px" class="Estilo7"><?php echo number_format($totalRetornado,2)?></td>
        <td valign="top"  align="center" bgcolor="#FFFFFF" style="border:#CCCCCC solid 1px" class="Estilo7">&nbsp;</td>
        <td align="center" bgcolor="#FFFFFF" valign="top" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40">&nbsp;</td>
      <tr >
        <td height="21">&nbsp;</td>
        <td align="right"><span class="Estilo3">Total Neto&nbsp; </span></td>
        <td align="right">&nbsp;</td>
        <td colspan="4" align="center" style="border:#CCCCCC solid 1px"><span class="Estilo7"><?php echo number_format($totalEntregado-$totalRetornado,2)?></span></td>
        <td align="right">&nbsp;</td>
        <td width="2" align="right">&nbsp;</td>
        <td width="55" align="right">&nbsp;</td>
      </tr>
      <tr >
        <td height="21">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr>
        <td height="21" colspan="9"><span class="Estilo3">COSTOS OPERATIVOS  : </span></td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr >
        <td height="21" colspan="10"><table width="99%" height="132" border="0" cellpadding="0" cellspacing="1" id="tblCostos">
            <tr style="background:url(../imagenes/bg_contentbase4.gif) 100%">
              <td width="540" height="19"><span class="Estilo29">Descripci&oacute;n</span></td>
              <td width="101" align="center"><span class="Estilo29">Costo Presupuestado </span></td>
              <td width="107" align="center"><span class="Estilo29">Costo Utilizado </span></td>
              <td width="107" align="center">&nbsp;</td>
            </tr>
            <?php
	  
	  $SQLActvPres="select * from costopexpresu where codpresup='".$codcabPO."' order by costoope " ;
	  $resultadoActvPres=mysql_query($SQLActvPres,$cn);
	  while($rowActvPres=mysql_fetch_array($resultadoActvPres)){
	  ?>
            <tr>
              <td height="19" bgcolor="#F5F5F5"><span class="Estilo12 Estilo41">
                <?php
			
			 $SQLCC="select * from costoperativo where id='".$rowActvPres['costoope']."' " ;
			  $resultadoCC=mysql_query($SQLCC,$cn);
			  $rowCC=mysql_fetch_array($resultadoCC);
			  	
				echo $rowCC['nombre'];
			 //echo 
			 $totalCostoPresup=$totalCostoPresup+$rowActvPres['costoparcial'];
			 ?>
              </span></td>
              <td align="right" bgcolor="#F5F5F5" class="Estilo12 Estilo41"><?php echo number_format($rowActvPres['costoparcial'],2)?></td>
              <td align="right" bgcolor="#F5F5F5" class="Estilo12 Estilo41"><?php 
			
			$strSQLCostosOpe="select * from referencia r,det_mov d,cab_mov c where r.cod_cab=d.cod_cab and d.cod_cab=c.cod_cab  and cod_cab_ref='".$referencia."' and codanex='".$rowActvPres['costoope']."' ";
			$resultadoCostoOpe=mysql_query($strSQLCostosOpe,$cn);
			$rowCostoOpe=mysql_fetch_array($resultadoCostoOpe);
			
			if($rowCostoOpe['inafecto']=='S'){
			$monInafectoCOper=$monInafectoCOper+$rowCostoOpe['total'];
			}else{
			$monAfectoCOper=$monAfectoCOper+$rowCostoOpe['b_imp'];
			$igvCOper=$igvCOper+$rowCostoOpe['igv'];
			}
			
			
			echo number_format($rowCostoOpe['total'],2);
			$totalCostoUtil=$totalCostoUtil+$rowCostoOpe['total'];
			?>              </td>
              <td align="right" bgcolor="#F5F5F5" class="Estilo12 Estilo41">&nbsp;</td>
            </tr>
            <?php }?>
            <tr>
              <td height="21" align="right" bgcolor="#FFFFFF"><span class="Estilo3">Base Imponible </span></td>
              <td align="right" bgcolor="#FFFFFF" class="Estilo41 Estilo12" style="border:#CCCCCC solid 1px">&nbsp;</td>
              <td align="right" bgcolor="#FFFFFF" class="Estilo12 Estilo41" style="border:#CCCCCC solid 1px"><strong><?php echo number_format($monAfectoCOper,2) ?></strong></td>
              <td align="right" bgcolor="#FFFFFF" class="Estilo12 Estilo41">&nbsp;</td>
            </tr>
            <tr>
              <td height="21" align="right" bgcolor="#FFFFFF"><span class="Estilo3">Monto Inafecto </span></td>
              <td align="right" bgcolor="#FFFFFF" class="Estilo41 Estilo12" style="border:#CCCCCC solid 1px">&nbsp;</td>
              <td align="right" bgcolor="#FFFFFF" class="Estilo12 Estilo41" style="border:#CCCCCC solid 1px"><strong><?php echo number_format($monInafectoCOper,2) ?></strong></td>
              <td align="right" bgcolor="#FFFFFF" class="Estilo12 Estilo41">&nbsp;</td>
            </tr>
            <tr>
              <td height="21" align="right" bgcolor="#FFFFFF"><span class="Estilo3">IGV</span></td>
              <td align="right" bgcolor="#FFFFFF" class="Estilo41 Estilo12" style="border:#CCCCCC solid 1px">&nbsp;</td>
              <td align="right" bgcolor="#FFFFFF" class="Estilo12 Estilo41" style="border:#CCCCCC solid 1px"><strong><?php echo number_format($igvCOper,2) ?></strong></td>
              <td align="right" bgcolor="#FFFFFF" class="Estilo12 Estilo41">&nbsp;</td>
            </tr>
            <tr>
              <td height="24" align="right" bgcolor="#FFFFFF"><span class="Estilo3">Totales Costos Ope. </span></td>
              <td align="right" bgcolor="#FFFFFF" class="Estilo41 Estilo12" style="border:#CCCCCC solid 1px"><strong><?php echo number_format($totalCostoPresup,2) ?></strong></td>
              <td align="right" bgcolor="#FFFFFF" class="Estilo12 Estilo41" style="border:#CCCCCC solid 1px"><strong><?php echo number_format($totalCostoUtil,2) ?></strong></td>
              <td align="right" bgcolor="#FFFFFF" class="Estilo12 Estilo41">&nbsp;</td>
            </tr>
        </table></td>
      </tr>
      <tr style="display:none">
        <td height="21">&nbsp;</td>
        <td colspan="8" align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr >
        <td height="21" colspan="9"><span class="Estilo3">MANO DE OBRA : </span></td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr >
        <td height="21" colspan="10"><table id="tblCostos" width="100%" border="0" cellpadding="0" cellspacing="1">
            <tr style="background:url(../imagenes/bg_contentbase4.gif) 100%">
              <td width="545" height="21"><span class="Estilo29">Descripci&oacute;n</span></td>
              <td width="105" align="center"><span class="Estilo29"> Presupuestado</span></td>
              <td width="100" align="center"><span class="Estilo29"> Utilizado </span></td>
              <td width="114" align="center">&nbsp;</td>
            </tr>
            <?php
	  
	  $SQLActvPres="select * from activxpresu where codpresup='".$codcabPO."' order by areacosto " ;
	  $resultadoActvPres=mysql_query($SQLActvPres,$cn);
	  while($rowActvPres=mysql_fetch_array($resultadoActvPres)){
	  ?>
            <tr>
              <td height="26" bgcolor="#F5F5F5"><span class="Estilo12">
                <?php
			
			 $SQLCC="select * from procesos where id='".$rowActvPres['procesos']."' " ;
			  $resultadoCC=mysql_query($SQLCC,$cn);
			  $rowCC=mysql_fetch_array($resultadoCC);
			  	
				echo $rowCC['nombre'];
			 //echo 
			 $totalPresupMObra=$totalPresupMObra+$rowActvPres['costoparcial'];
			 ?>
              </span></td>
              <td align="right" bgcolor="#F5F5F5" class="Estilo12"><?php echo number_format($rowActvPres['costoparcial'],2)?></td>
              <td align="right" bgcolor="#F5F5F5" class="Estilo12"><?php 
			$strSQLManoObra="select sum(cantidad) as cantidad from activxordent where cod_cab='".$referencia."' and actividad='".$rowActvPres['procesos']."'";
			$resultadoManoObra=mysql_query($strSQLManoObra,$cn);
			$rowManoObra=mysql_fetch_array($resultadoManoObra);
			echo number_format($rowManoObra['cantidad']*$rowActvPres['costo']);
			
			$totalUtilMObra=$totalUtilMObra+($rowManoObra['cantidad']*$rowActvPres['costo']);
			?>              </td>
              <td align="right" bgcolor="#F5F5F5" class="Estilo12">&nbsp;</td>
            </tr>
            <?php }?>
            <tr>
              <td height="26" align="right" bgcolor="#FFFFFF"><span class="Estilo3">Totales Mano de Obra. </span></td>
              <td align="right" bgcolor="#FFFFFF" class="Estilo41 Estilo12" style="border:#CCCCCC solid 1px"><strong><?php echo number_format($totalPresupMObra,2) ?></strong></td>
              <td align="right" bgcolor="#FFFFFF" class="Estilo41 Estilo12" style="border:#CCCCCC solid 1px"><strong><?php echo number_format($totalUtilMObra,2) ?></strong></td>
              <td align="right" bgcolor="#FFFFFF" >&nbsp;</td>
            </tr>
        </table></td>
      </tr>
      <tr >
        <td height="21">&nbsp;</td>
        <td colspan="8" align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr >
        <td height="21" colspan="10"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="24%">&nbsp;</td>
            <td width="36%">
			<fieldset><legend><span class="Estilo12"><strong>Cuadro Resumen</strong></span></legend><table width="507" height="111" border="0" align="center" cellpadding="2" cellspacing="1">
            <tr>
              <td height="24" align="center" bgcolor="#F4F4F4">&nbsp;</td>
              <td height="24" colspan="2" align="center" bgcolor="#F4F4F4"><span class="Estilo7">Presupuestado</span></td>
              <td colspan="2" align="center" bgcolor="#F4F4F4"><span class="Estilo46"></span><span class="Estilo7">Utilizado</span></td>
              </tr>
            <tr>
              <td width="141" bgcolor="#F4F4F4" class="Estilo7">Facturado</td>
              <td width="127" align="right" bgcolor="#F4F4F4" class="Estilo44"><?php echo number_format($totalDocSal,2)?></td>
              <td width="34" align="center" bgcolor="#F4F4F4" class="Estilo44">&nbsp;</td>
              <td width="127" align="right" bgcolor="#F4F4F4" class="Estilo44"><?php echo number_format($totalDocSal,2)?></td>
              <td width="53" align="center" bgcolor="#F4F4F4" class="Estilo44">&nbsp;</td>
            </tr>
            <tr>
              <td bgcolor="#F4F4F4" class="Estilo7">Total  </td>
              <td align="right" bgcolor="#F4F4F4" class="Estilo44"><?php echo number_format($totalPresup+$totalCostoPresup+$totalPresupMObra,2)?></td>
              <td align="center" bgcolor="#F4F4F4" class="Estilo44">&nbsp;</td>
              <td align="right" bgcolor="#F4F4F4" class="Estilo44"><?php echo number_format(($totalEntregado-$totalRetornado)+$monAfectoCOper+$monInafectoCOper+$totalUtilMObra,2)?></td>
              <td align="center" bgcolor="#F4F4F4" class="Estilo44">&nbsp;</td>
            </tr>
            <tr bgcolor="#FDF19D">
              <td bgcolor="#F4F4F4" class="Estilo7">Utilidad Neto</td>
              <td align="right" bgcolor="#FDF19D"><span class="Estilo44"><?php echo number_format($totalDocSal-($totalPresup+$totalCostoPresup+$totalPresupMObra),2)?></span></td>
              <td align="center" bgcolor="#FDF19D">&nbsp;</td>
              <td align="right" bgcolor="#FDF19D"><span class="Estilo44"><?php echo number_format($totalDocSal-(($totalEntregado-$totalRetornado)+$monAfectoCOper+$monInafectoCOper+$totalUtilMObra),2)?></span></td>
              <td align="center" bgcolor="#FDF19D">&nbsp;</td>
            </tr>
          </table></fieldset></td>
            <td width="17%">&nbsp;</td>
          </tr>
        </table>		</td>
        </tr>
      <tr style="display:none">
        <td height="21">&nbsp;</td>
        <td colspan="8" align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr style="display:none">
        <td height="21">&nbsp;</td>
        <td colspan="8" align="right"><span class="Estilo7">Base Imponible </span></td>
        <td align="right"><span class="Estilo12">
          <?php 
		  
		   if($inafecto=='N'){
		if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	echo $b_imp;
	}
		?>
        </span></td>
      </tr>
      <tr style="display:none">
        <td height="21">&nbsp;</td>
        <td colspan="8" align="right"><span class="Estilo7">Impuesto (<?php echo $impto?> %)</span></td>
        <td align="right"><span class="Estilo12">
          <?php 
		if ($_SESSION['nivel_usu']==2){
		echo '***';
		}else{
		echo $igv;
		}
		?>
        </span></td>
      </tr>
      <?php  }?>
      <tr style="display:none">
        <td height="21">&nbsp;</td>
        <td colspan="8" align="right"><span class="Estilo7">SubTotal</span></td>
        <td align="right"><span class="Estilo12"><span class="Estilo7">
          <?php //echo $simbolo;?>
          </span>
              <?php 
		if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	echo number_format($importe,2);
	}	
		?>
        </span></td>
      </tr>
      <tr style="display:none">
        <td height="21">&nbsp;</td>
        <td colspan="8" align="right"><span class="Estilo7">Utilidad (<?php echo $factUtilMat."% "?>)</span></td>
        <td align="right"><span class="Estilo12">
          <?php 
		
		echo number_format(($importe*$factUtilMat/100),2)
		
		?>
        </span></td>
      </tr>
      <tr style="display:none">
        <td height="21">&nbsp;</td>
        <td colspan="8" align="right"><span class="Estilo7 Estilo31">TOTAL</span></td>
        <td align="right"><span class="Estilo12"><strong> <?php echo $simbolo;?>
                <?php 
		echo number_format($importe+($importe*$factUtilMat/100),2)
		
		?>
        </strong> </span></td>
      </tr>
      <tr>
        <td height="21">&nbsp;</td>
        <td colspan="8" align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr>
        <td height="21" colspan="10"><?php if($cod_ope=='PO'){?>
            <?php }?></td>
      </tr>
      <tr>
        <td height="22">&nbsp;</td>
        <td colspan="8" align="center">&nbsp;</td>
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

		              <td width="128" colspan="4"><center>
		                
		              </center></td>
          </tr>
        </table>

    </fieldset>    </td>
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
<script>
function origenPO(codigo){

var Datos2=window.open("../doc_det.php?referencia="+codigo,"PO","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=720, height=520,left=200 top=150");
Datos2.focus();
}

</script>