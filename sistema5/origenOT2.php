<?php 
session_start();
include('conex_inicial.php');

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

//-----------------------------------RM---------------------------------------------------
$serieRM='001';
list($numeroRM)=mysql_fetch_row(mysql_query("select max(Num_doc) from cab_mov where cod_ope='RM' and serie='".$serieRM."' and sucursal='".$codsucursal."' "));

$numeroRM=str_pad($numeroRM+1,7,"0",STR_PAD_LEFT);

//----------------------------------------------------------------------------------------

//---------------------------------SAVE RM-------------------------------------------------

if(isset($_REQUEST['Submit'])){
//echo $_REQUEST['Submit'];
//echo "adsf";

				$strSQL10="select * from operacion where codigo='RM' ";
				$resultado10=mysql_query($strSQL10,$cn);
				$row10=mysql_fetch_array($resultado10);
			
				$kardexDoc=substr($row10['p1'],9,1);
				$impto1=$row10['imp1'];
				$incluidoIGV="S";
				$condicion="1";
				$inafecto=substr($row10['p1'],3,1);
				$deuda=substr($row10['p1'],4,1);
				$fecha_aud=gmdate('Y-m-d H:i:s',time()-18000);
				$pcIngreso=$_SESSION['pc_ingreso'];
				$predefecto=$row10['predefecto'];
				
				$strSQL03="select  max(id) as id from tempdoc";
				$resultado03=mysql_query($strSQL03,$cn);
				$row03=mysql_fetch_array($resultado03);
				$id=$row03['id']+1;
				
							
				$strSQL04="select  max(cod_cab) as cod_cab from cab_mov";
				$resultado04=mysql_query($strSQL04,$cn);
				$row04=mysql_fetch_array($resultado04);
				$cod_cab=$row04['cod_cab']+1;
				
	
			   $strSQL02="insert into tempdoc(id,sucursal,tipodoc,doc,serie,numero,estado,usuario)values('".$id."','".$codsucursal."','2','RM','".$serieRM."','".$numeroRM."','G','".$_SESSION['codvendedor']."')";
			mysql_query($strSQL02,$cn);
						
			//echo $strSQL02;
							
			$strSQL05="insert into cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,cliente,fecha,tienda,sucursal,flag_r,kardex,moneda,impto1,incluidoigv,condicion,inafecto,deuda,fecha_aud,pc) values('".$cod_cab."','1','RM','".$numeroRM."','".$serieRM."','".$_SESSION['codvendedor']."','".$cliente."','".$fecha_aud."','".$codtienda."','".$codsucursal."','RA','".$kardexDoc."','".$moneda."','".$impto1."','".$incluidoIGV."','".$condicion."','".$inafecto."','".$deuda."','".$fecha_aud."','".$pcIngreso."')";
			mysql_query($strSQL05,$cn);
			
			//echo $strSQL05;
			
			foreach ($_REQUEST['checkbox'] as $subkey=> $subvalue) {
			
			$strSQLProd="select * from producto where idproducto='".$_REQUEST['checkbox'][$subkey]."'";
			$resultadoProd=mysql_query($strSQLProd,$cn);
			$rowProd=mysql_fetch_array($resultadoProd);
			$unidad=$rowProd['und'];
			$nombreprod=$rowProd['nombre'];
			$descargo=$rowProd['kardex'];
			$afectoigv=$rowProd['igv'];
			//$campoCosto="costo_inven1";	
			//$costoProm=$rowProd[$campoCosto];
			
			$strSQLProd2="select * from det_mov where cod_prod='".$rowProd['idproducto']."' and cod_cab='".$referencia."'";
			$resultadoProd2=mysql_query($strSQLProd2,$cn);
			if(mysql_num_rows($resultadoProd2)>0){
			$rowProd2=mysql_fetch_array($resultadoProd2);
			$precioProd=$rowProd2['precio'];
			}else{
				if($predefecto<6){
				$precioProd=$rowProd['precio'.$predefecto];
				}else{
				 if($predefecto==6)$campoPre='pre_ref';
				 if($predefecto==7)$campoPre='costo_inven1';
				$precioProd=$rowProd[$campoPre];
				}
			
			}
			$imp_item=$precioProd*$_REQUEST['cant'][$subkey];
			
			
			
					
				if($rowProd['kardex']=='S'){
				
					
					$updateProd="update producto set saldo".$codtienda."=saldo".$codtienda."+'".$_REQUEST['cant'][$subkey]."' where idproducto='".$_REQUEST['checkbox'][$subkey]."'";		
					
				
				mysql_query($updateProd,$cn);
				//echo $updateProd."<br>";
				}
					
					
			$strSQL06="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,unidad,cantidad,fechad,descargo,afectoigv,precio,flag_kardex,imp_item) values('".$cod_cab."','2','RM','".$serieRM."','".$numeroRM."','".$cliente."','".$codtienda."','".$codsucursal."','".$_REQUEST['checkbox'][$subkey]."','".$nombreprod."','".$unidad."','".$_REQUEST['cant'][$subkey]."','".$fecha_aud."','".$descargo."','".$afectoigv."','".$precioProd."','1','".$imp_item."')";
								
			//echo $strSQL06."<br>";
			mysql_query($strSQL06,$cn);
			}
			
			///--------------------refrencia de la SM con la OT------------
			
			$strSQL08="insert into referencia(cod_cab,serie,correlativo,cod_cab_ref)values('".$cod_cab."','".$serie."','".$numero."','".$referencia."')";
			mysql_query($strSQL08,$cn);
			
			  $strSQL09="update cab_mov set flag_r=CONCAT(flag_r,'RO') where cod_cab='".$referencia."'";
			mysql_query($strSQL09,$cn);
			//-------------------------------------------------------
			//	echo $strSQL08;
			
		//	header("location: origenOT2.php?referencia=".$referencia);
}

//------------------------------------FIN SAVE RM-----------------------------------------

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
		
//echo $factUtilMat;

//print_r($_REQUEST['checkbox']);echo "<br>";
//print_r($_REQUEST['cant']);

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
img { behavior: url(ventas/iepngfix.htc); }
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
.Estilo44 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>
</head>

<body>

<form id="form1" name="form1" method="post" action="" >

<table width="100%" height="523" border="0" cellpadding="0" cellspacing="0">
  <tr>
  <td height="39" colspan="3" align="center" bgcolor="#003366"><span class="Estilo1">RETORNO DE MATERIALES ( RM ) <br> 
  Nro. <?php echo $serieRM." - ".$numeroRM; ?> </span></td>
  
  <?php if($flag=='A'){?>
  </tr>
  <tr>
    <td height="21" colspan="3" align="center" ><span class="Estilo21">( Anulado )</span></td>
  </tr> 
  
  <?php }?>
  <tr>
  
    <td width="8" height="86">&nbsp;</td>
    <td width="100%" style="padding-top:10px">
	<fieldset><legend><span class="Estilo44">Datos Orden de Trabajo</span></legend>
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
        <td width="190" align="center"><span class="Estilo43">Imprimir</span></td>
      </tr>
      <tr>
        <td height="19">&nbsp;</td>
        <td><span class="Estilo7">Se&ntilde;ores:</span><span class="Estilo12"> <?php echo $razonsocial; ?></span></td>
        <td><span class="Estilo7">Ruc:</span><span class="Estilo12"><?php echo $ruc; ?></span></td>
        <td width="190" rowspan="2" align="center"><a href="#" onClick="javascript:printer()" ><img src="imgenes/imprimir.gif" width="35" height="35" border="0" class="no_print"></a></td>
      </tr>
      <tr>
        <td height="19">&nbsp;</td>
        <td><span class="Estilo7">Direcci&oacute;n</span>:<span class="Estilo12"><?php echo $direccion; ?></span></td>
        <td><span class="Estilo7 Estilo31">PRESUPUESTO:&nbsp; </span><span class="Estilo12 Estilo42"> <?php echo $seriePO."-".$numeroPO; ?>&nbsp;&nbsp; </span><img onClick="origenPO('<?php echo $codcabPO ?>')" src="imagenes/ico_lupa.png"  width="16" height="16" border="0" style="cursor:pointer"></td>
        </tr>
      <tr>
        <td height="19">&nbsp;</td>
        <td><span class="Estilo7">Responsable: </span><span class="Estilo12"><?php echo $responsable?></span></td>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table></fieldset>	</td>
    <td width="9">&nbsp;</td>
  </tr>
  <tr>
    <td >&nbsp;</td>
    <td valign="top">
	<table width="100%" cellpadding="1" cellspacing="1" >
      
	  <tr>
        <td height="25" colspan="9"><span class="Estilo3">Detalle : </span></td>
        </tr>
      <tr style="background:url(imagenes/bg_contentbase2.gif);  background-position:100% 50%;">
        <td width="45" align="center" >&nbsp;</td>
        <td width="47" height="18" align="center" ><span class="Estilo24">Cod. </span></td>
        <td width="250" ><span class="Estilo24">Producto</span></td>
        <td width="85" align="center" ><span class="Estilo24 Estilo39">Presupuestado</span></td>
        <td width="75" align="center" ><span class="Estilo24">Entregado</span></td>
        <td width="73" align="center" ><span class="Estilo24">Devuelto</span></td>
        <td width="72" align="center" ><span class="Estilo24">Por Entregar</span></td>
        <td width="67" align="center" ><span class="Estilo24">Stock</span></td>
        <td width="84" align="center" ><span class="Estilo24">Cant. a Devolver </span></td>
      </tr>
	  <?php 
	  $campoSaldo="saldo".$codtienda; 
	  $strSQL4="select cantidad,idproducto,nom_prod,det_mov.precio as precioU,unidad,agrupado,".$campoSaldo." from det_mov,producto,clasificacion where det_mov.cod_prod=idproducto and clasificacion=idclasificacion and cod_cab='".$referencia."' order by agrupado,cod_det";
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
		 }
		// echo $docsSM;
			 $strSQLDetx="select d.*,p.*,c.*,sum(d.cantidad) as cantSM from det_mov d,producto p,clasificacion c where d.cod_cab in ($docsSM) and d.cod_prod not in(select cod_prod from det_mov where cod_cab='".$referencia."') and d.cod_ope='SM' and p.idproducto=d.cod_prod and p.clasificacion=c.idclasificacion and c.agrupado='".$idgrupo."' group by p.idproducto,d.cod_ope ";
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
		  $strSQLDet="select sum(cantidad) as cantRetor from referencia,det_mov where referencia.cod_cab_ref='".$referencia."' and det_mov.cod_cab=referencia.cod_cab and cod_ope='RM' and cod_prod='".$rowDetx['idproducto']."'";
		 $resultadoDet=mysql_query($strSQLDet,$cn);
		 $rowDet=mysql_fetch_array($resultadoDet);
		 $retornado=$rowDet['cantRetor'];
		 //echo $strSQLDet;
		 //-------------------------------------------------------------------------------------------------
			  //echo $stockProd2;
				  
			 ?>
			   <tr bgcolor="#EFEFEF" >
			     <td align="center" valign="top"   class="Estilo12 Estilo41" ><input type="checkbox" name="checkbox[]" id="checkbox" value="<?php echo $rowDetx['idproducto'] ?>" onClick="marcarChk(this)"></td>
        <td height="20" align="center"    class="Estilo12 Estilo41" ><?php echo $rowDetx['idproducto'];?></td>
        <td ><span class="Estilo12 Estilo41"><?php echo substr($rowDetx['nom_prod'],0,50);?></span></td>
        <td  align="center" valign="top" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px"><span class="Estilo12 Estilo40"><?php echo "0.00"?></span></td>
        <td  align="center" valign="top" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($rowDetx['cantSM'],2)?></td>
        <td valign="top"  align="center" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($retornado,2)?></td>
        <td align="center" bgcolor="#FDF19D" valign="top" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($porEntregar,2)?></td>
        <td align="center" bgcolor="#FDF19D" valign="top" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($rowDetx[$campoProdSM],2)?></td>
        <td align="center" valign="top"  bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><span class="Estilo12 Estilo40" ><input autocomplete="off" name="cant[]" type="text" size="6" maxlength="8" disabled="disabled" value="0" style="text-align:right; height:18px" onKeyUp="controlCant(this)" onKeyDown="validarNumero(this,event)" ></span></td>
      		</tr>
		
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
		 }
		// echo $docsSM;
			 $strSQLDetx="select d.*,p.*,c.*,sum(d.cantidad) as cantSM from det_mov d,producto p,clasificacion c where d.cod_cab in ($docsSM) and d.cod_prod not in(select cod_prod from det_mov where cod_cab='".$referencia."') and d.cod_ope='SM' and p.idproducto=d.cod_prod and p.clasificacion=c.idclasificacion and c.agrupado='".$idgrupo."' group by p.idproducto,d.cod_ope ";
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
		  $strSQLDet="select sum(cantidad) as cantRetor from referencia,det_mov where referencia.cod_cab_ref='".$referencia."' and det_mov.cod_cab=referencia.cod_cab and cod_ope='RM' and cod_prod='".$rowDetx['idproducto']."'";
		 $resultadoDet=mysql_query($strSQLDet,$cn);
		 $rowDet=mysql_fetch_array($resultadoDet);
		 $retornado=$rowDet['cantRetor'];
		 //echo $strSQLDet;
		 //-------------------------------------------------------------------------------------------------
			  
			  //echo $stockProd2;
			 ?>
			   <tr bgcolor="#EFEFEF">
			     <td align="center" valign="top"    class="Estilo12 Estilo41" ><input type="checkbox" name="checkbox[]" value="<?php echo $rowDetx['idproducto'] ?>" onClick="marcarChk(this)" id="checkbox"></td>
        <td height="22" align="center"  class="Estilo12 Estilo41" ><?php echo substr($rowDetx['idproducto'],0,50);?></td>
        <td ><span class="Estilo12 Estilo41"><?php echo substr($rowDetx['nom_prod'],0,50);?></span></td>
        <td  align="center" valign="top" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px"><span class="Estilo12 Estilo40"><?php echo "0.00"?></span></td>
        <td  align="center" valign="top" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($rowDetx['cantSM'],2)?></td>
        <td valign="top"  align="center" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($retornado,2)?></td>
        <td align="center" bgcolor="#FDF19D" valign="top" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($porEntregar,2)?></td>
        <td align="center" bgcolor="#FDF19D" valign="top" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($rowDetx[$campoProdSM],2)?></td>
        <td align="center" valign="top"  bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><span class="Estilo12 Estilo40" >
          <input name="cant[]" type="text" size="6" maxlength="8" disabled="disabled" value="0" style="text-align:right; height:18px" onKeyUp="controlCant(this)" onKeyDown="validarNumero(this,event)" autocomplete="off">
        </span></td>
      		</tr>
		
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
		 $resultadoDet=mysql_query($strSQLDet,$cn);
		 $rowDet=mysql_fetch_array($resultadoDet);
		 $entregado=$entregado+$rowDet['cantidad'];
		 
		// echo $strSQLDet."<br>";
		 //-------------------------------------------------------------------------------------------------
		 		 																																			        //-------------------------------------RM-----------------------------------------------------------
		 
		 $strSQLDet="select * from det_mov where cod_cab='".$rowRef['cod_cab']."' and cod_prod='".$row4['idproducto']."' and cod_ope='RM'";
		 $resultadoDet=mysql_query($strSQLDet,$cn);
		 $rowDet=mysql_fetch_array($resultadoDet);
		 $retornado=$retornado+$rowDet['cantidad'];
		 
		 //-------------------------------------------------------------------------------------------------
		 
	 }
	 	
		
		$porEntregar=$row4['cantidad']-$entregado+$retornado;
	  ?>
	  
      <tr bgcolor="#EFEFEF">
        <td align="center" valign="top"    class="Estilo12 Estilo41" ><input type="checkbox" name="checkbox[]" value="<?php echo $row4['idproducto'] ?>" onClick="marcarChk(this)" id="checkbox"></td>
        <td height="22" align="center"   class="Estilo12 Estilo41" ><?php echo substr($row4['idproducto'],0,50);?></td>
        <td ><span class="Estilo12 Estilo41"><?php echo substr($row4['nom_prod'],0,50);?></span></td>
        <td  align="center" valign="top" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px"><span class="Estilo12 Estilo40"><?php echo number_format($row4['cantidad'],2);?></span></td>
        <td  align="center" valign="top" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($entregado,2)?></td>
        <td valign="top"  align="center" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($retornado,2)?></td>
        <td align="center" bgcolor="#FDF19D" valign="top" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($porEntregar,2)?></td>
        <td align="center" bgcolor="#FDF19D" valign="top" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($stockProd,2)?></td>
        <td align="center" valign="top"  bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><span class="Estilo12 Estilo40" >
          <input name="cant[]" type="text" size="6" maxlength="8" disabled="disabled" value="0" style="text-align:right; height:18px" onKeyUp="controlCant(this)" onKeyDown="validarNumero(this,event)" autocomplete="off">
        </span></td>
      </tr>
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
		 }
		// echo $docsSM;
			 $strSQLDetx="select d.*,p.*,c.*,sum(d.cantidad) as cantSM from det_mov d,producto p,clasificacion c where d.cod_cab in ($docsSM) and d.cod_prod not in(select cod_prod from det_mov where cod_cab='".$referencia."') and d.cod_ope='SM' and p.idproducto=d.cod_prod and p.clasificacion=c.idclasificacion and c.agrupado='".$idgrupo."' group by p.idproducto,d.cod_ope ";
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
		  $strSQLDet="select sum(cantidad) as cantRetor from referencia,det_mov where referencia.cod_cab_ref='".$referencia."' and det_mov.cod_cab=referencia.cod_cab and cod_ope='RM' and cod_prod='".$rowDetx['idproducto']."'";
		 $resultadoDet=mysql_query($strSQLDet,$cn);
		 $rowDet=mysql_fetch_array($resultadoDet);
		 $retornado=$rowDet['cantRetor'];
		// echo $strSQLDet;
		 //-------------------------------------------------------------------------------------------------
		 
			  //echo $stockProd2;
			 ?>
			   <tr bgcolor="#EFEFEF">
			     <td align="center" valign="top"    class="Estilo12 Estilo41" ><input type="checkbox" name="checkbox[]" value="<?php echo $rowDetx['idproducto'] ?>" onClick="marcarChk(this)" id="checkbox"></td>
        <td height="22" align="center"  class="Estilo12 Estilo41" ><?php echo substr($rowDetx['idproducto'],0,50);?></td>
        <td ><span class="Estilo12 Estilo41"><?php echo substr($rowDetx['nom_prod'],0,50);?></span></td>
        <td  align="center" valign="top" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px"><span class="Estilo12 Estilo40"><?php echo "0.00"?></span></td>
        <td  align="center" valign="top" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($rowDetx['cantSM'],2)?></td>
        <td valign="top"  align="center" bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($retornado,2)?></td>
        <td align="center" bgcolor="#FDF19D" valign="top" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($porEntregar,2)?></td>
        <td align="center" bgcolor="#FDF19D" valign="top" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><?php echo number_format($rowDetx[$campoProdSM],2)?></td>
        <td align="center" valign="top"  bgcolor="#FDF19D" style="border:#CCCCCC solid 1px" class="Estilo12 Estilo40"><span class="Estilo12 Estilo40" >
          <input name="cant[]" type="text" size="6" maxlength="8" disabled="disabled" value="0" style="text-align:right; height:18px" onKeyUp="controlCant(this)" onKeyDown="validarNumero(this,event)" autocomplete="off">
        </span></td>
      		</tr>
		
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
	  
	  if($inafecto=='N'){
	  ?>
	  	  
      <tr style="display:none">
        <td>&nbsp;</td>
        <td height="21">&nbsp;</td>
        <td colspan="6" align="right"><span class="Estilo7">Base Imponible </span></td>
        <td align="right"><span class="Estilo2"><?php 
		if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	echo $b_imp;
	}
		?></span></td>
      </tr>
      <tr style="display:none">
        <td>&nbsp;</td>
        <td height="21">&nbsp;</td>
        <td colspan="6" align="right"><span class="Estilo7">Impuesto (<?php echo $impto?> %)</span></td>
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
        <td>&nbsp;</td>
        <td height="21">&nbsp;</td>
        <td colspan="6" align="right"><span class="Estilo7">SubTotal</span></td>
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
        <td>&nbsp;</td>
        <td height="21">&nbsp;</td>
        <td colspan="6" align="right"><span class="Estilo7">Utilidad (<?php echo $factUtilMat."% "?>)</span></td>
        <td align="right"><span class="Estilo2">
		
		<?php 
		
		echo number_format(($importe*$factUtilMat/100),2)
		
		?>
		
		</span></td>
      </tr>
      <tr style="display:none">
        <td>&nbsp;</td>
        <td height="21">&nbsp;</td>
        <td colspan="6" align="right"><span class="Estilo7 Estilo31">TOTAL</span></td>
        <td align="right"><span class="Estilo12"><strong>
		<?php echo $simbolo;?>
          <?php 
		echo number_format($importe+($importe*$factUtilMat/100),2)
		
		?></strong>
        </span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="21">&nbsp;</td>
        <td colspan="6" align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr>
        <td height="21" colspan="9">
		<?php if($cod_ope=='PO'){?>
		<?php }?></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="22">&nbsp;</td>
        <td colspan="6" align="center"><input type="submit" name="Submit" value="Guardar Datos" ></td>
        <td align="right">&nbsp;</td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td height="19">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</form>
<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>
</body>
</html>
<script>
function origenPO(codigo){

var Datos2=window.open("doc_det.php?referencia="+codigo,"PO","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=720, height=520,left=200 top=150");
Datos2.focus();
}


function marcarChk(obj){

	if(obj.checked){
	
		if((parseFloat(obj.parentNode.parentNode.childNodes[4].innerHTML)-parseFloat(obj.parentNode.parentNode.childNodes[5].innerHTML))<=0){
		alert("No tiene cantidad disponible para devolver");
		obj.checked=false;
		return false;
		}
		obj.parentNode.parentNode.parentNode.rows[obj.parentNode.parentNode.rowIndex].style.background='#93FF93';
//		alert(obj.parentNode.parentNode.rowIndex);
		obj.parentNode.parentNode.childNodes[8].childNodes[0].childNodes[0].disabled=false;
		obj.parentNode.parentNode.childNodes[8].childNodes[0].childNodes[0].value="";
		obj.parentNode.parentNode.childNodes[8].childNodes[0].childNodes[0].focus();
		obj.parentNode.parentNode.childNodes[8].childNodes[0].childNodes[0].select();
	
	}else{
	obj.parentNode.parentNode.childNodes[8].childNodes[0].childNodes[0].value="0";
	obj.parentNode.parentNode.childNodes[8].childNodes[0].childNodes[0].disabled=true;
	obj.parentNode.parentNode.parentNode.rows[obj.parentNode.parentNode.rowIndex].style.background='#EFEFEF';
	
	
	}

}

function controlCant(obj){
	//alert(obj.parentNode.parentNode.parentNode.childNodes[4].innerHTML);
	if(obj.value >(parseFloat(obj.parentNode.parentNode.parentNode.childNodes[4].innerHTML)-parseFloat(obj.parentNode.parentNode.parentNode.childNodes[5].innerHTML))){
	obj.value='0';
	obj.focus();
	obj.select();
	alert("la cantidad ingresada no esta disponible");
	}
	
}

function validarNumero(control,e){
//alert(e.keyCode);
	try{
		if((e.keyCode>=96 && e.keyCode<=105) || (e.keyCode>46 && e.keyCode<58) || e.keyCode==8 || e.keyCode==190 || e.keyCode==37 || e.keyCode==39 || e.keyCode==110){
			temp=control.value.split(".");
			if(e.keyCode==190 || e.keyCode==110){
				if(temp[1]!=undefined){	
					e.keyCode=0;
					event.returnValue=false;
					return false;
				}
			}
		}else{
			if(e.keyCode==13){
				
				e.keyCode=0;
				event.returnValue=false;
				return false;
			}else{
				e.keyCode=0;
				event.returnValue=false;
				return false;
			}
		}
	}catch(e){
	
	}	

}

function guardar(){
//document.form1.submit();
}

</script>