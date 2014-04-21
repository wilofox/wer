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
$b_impX2=$row['saldo'];
$b_impX3=$row['total'];

	

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

	
	if($moneda==$rowCope['moneda']){
	$totalCostos=$totalCostos+$rowCope['costoparcial'];
	}else{
		if($rowCope['moneda']=='01'){
		$totalCostos=$totalCostos+($rowCope['costoparcial']/$tipo_cambio);
		}else{
		$totalCostos=$totalCostos+($rowCope['costoparcial']*$tipo_cambio);
		}
	
	}
	
	
}

$strSQLCope="select * from activxpresu where codpresup='".$referencia."'";
$resultadoCope=mysql_query($strSQLCope, $cn);
while($rowCope=mysql_fetch_array($resultadoCope)){

	
	if($moneda==$rowCope['moneda']){
	$totalActxObra=$totalActxObra+$rowCope['costoparcial'];
	}else{
		if($rowCope['moneda']=='01'){
		$totalActxObra=$totalActxObra+($rowCope['costoparcial']/$tipo_cambio);
		}else{
		$totalActxObra=$totalActxObra+($rowCope['costoparcial']*$tipo_cambio);
		}
	
	}
	
	
}

 	  $SQLActvPres="select * from factutilxmov where cod_cab='".$referencia."' order by id " ;
	  $resultadoActvPres=mysql_query($SQLActvPres,$cn);
	  while($rowActvPres=mysql_fetch_array($resultadoActvPres)){
	  	  
	  $factorpred=$rowActvPres['factorpred'];
	 // echo $factorpred;
      if($rowActvPres['codconcepto']=='1') $factUtilMat=$rowActvPres['factor'.$factorpred];
	  if($rowActvPres['codconcepto']=='2') $factUtilAct=$rowActvPres['factor'.$factorpred];
	  if($rowActvPres['codconcepto']=='3') $factUtilCO=$rowActvPres['factor'.$factorpred];
	  
	 // $factUtilAct=$rowActvPres;
	 // $factUtilCO=$rowActvPres;
	  
	  }


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
.Estilo27 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
.Estilo31 {color: #FF0000}
-->
</style>
</head>

<body>
<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>
<table width="100%" height="377" border="0" cellpadding="0" cellspacing="0">
  <tr>
  <td height="32" colspan="3" align="center" bgcolor="#003366"><span class="Estilo1">HISTORIAL DE PAGOS<?php //echo strtoupper($ticket); ?> </span></td>
  
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
        <td><span class="Estilo7">Tc.</span><span class="Estilo12"><?php echo $tipo_cambio; ?></span> <span class="Estilo7">&nbsp;&nbsp;&nbsp;Moneda:</span><span class="Estilo12"><?php echo $des_mon; ?></span></td>
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
    <td height="139">&nbsp;</td>
    <td valign="top" style="padding-top:10px;"><table width="100%" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td height="25" colspan="7"><span class="Estilo3">Pagos realizados : </span></td>
        </tr>
      <tr style="background:url(imagenes/bg_contentbase2.gif);  background-position:100% 40%;">
        <td width="125" height="18" align="center" ><span class="Estilo24">Fecha</span></td>
        <td width="102" ><span class="Estilo24">Tipo</span></td>
        <td width="147" align="center" ><span class="Estilo24">T.PAgo</span></td>
        <td width="106" align="center" ><span class="Estilo24">N&uacute;mero</span></td>
        <td width="95" align="center" ><span class="Estilo24">Moneda</span></td>
        <td width="79" align="right" ><span class="Estilo24">T.C.</span></td>
        <td width="147" align="right" ><span class="Estilo24">Monto</span></td>
      </tr>
	  <?php 
	  
	  //$strSQL4="select cantidad,cod_prod,nom_prod,precio,unidad  from det_mov where cod_cab='".$referencia."' order by cod_det";
	  $strSQL4="select * from pagos where referencia='".$referencia."' order by fecha ";
	  
 $resultado4=mysql_query($strSQL4,$cn);
// echo $strSQL4;
$nitems=0;
 while($row4=mysql_fetch_array($resultado4)){
 $nitems=$nitems+1;
	  ?>
	  
      <tr>
        <td valign="top" bgcolor="#EFEFEF" class="Estilo7" ><?php 
	echo $row4['fechap'];
		 ?></td>
        <td bgcolor="#EFEFEF"><span class="Estilo7"><?php echo substr($row4['tipo'],0,50);?></span>
          </p></td>
        <td valign="top"  align="center" bgcolor="#EFEFEF"><span class="Estilo7">
          <?php 
		$SQLCC="select * from t_pago where id='".$row4['t_pago']."' " ;
			  $resultadoCC=mysql_query($SQLCC,$cn);
			  $rowCC=mysql_fetch_array($resultadoCC);
			  	
				echo $rowCC['descripcion'];
		
		//echo substr($row4['t_pago'],0,50);
		
		?>
        </span></td>
        <td valign="top"  align="center" bgcolor="#EFEFEF"><span class="Estilo7">
          <?php 
		 echo $rowUND['numero'];			
		?>
        </span></td>
        <td align="center" bgcolor="#EFEFEF" valign="top" ><span class="Estilo7">
          <?php 
		  if ($row4['moneda']=='01'){
			echo 'S/.';
		  }else{
		    echo 'US$.';
		  }
//echo $row4['moneda'];
			
		?>
        </span></td>
        <td align="right" bgcolor="#EFEFEF" valign="top" ><span class="Estilo7"><?php echo $row4['tcambio'];?></span></td>
        <td align="right" valign="top"  bgcolor="#EFEFEF"><span class="Estilo7" >
          <?php 
		  $b_impX=$b_impX+ $row4['monto'];
echo $row4['monto'];
	?></span></td>
      </tr>
	  <?php }
	  
	  if($inafecto=='N'){
	  ?>
	  	  
      <tr style="display:none">
        <td height="21">&nbsp;</td>
        <td colspan="5" align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
	  <?php  }?>
      <tr>
        <td height="21">&nbsp;</td>
        <td colspan="5" align="right"><span class="Estilo7">Total</span></td>
        <td align="right"><span class="Estilo12">
          <?php 
		if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	echo $b_impX;
	}
		?>
        </span></td>
      </tr>
      <tr>
        <td height="21">&nbsp;</td>
        <td colspan="5" align="right"><span class="Estilo7">Total Pendiente </span></td>
        <td align="right"><span class="Estilo12">
          <?php 
		if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	echo $b_impX2;
	}
		?>
        </span></td>
      </tr>
      <tr>
        <td height="21">&nbsp;</td>
        <td colspan="5" align="right"><span class="Estilo7">Total de Venta </span></td>
        <td align="right"><span class="Estilo12">
          <?php 
		if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	echo $b_impX3;
	}
		?>
        </span></td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="19">&nbsp;</td>
    <td><fieldset><legend><span class="Estilo12">Auditoria</span></legend>
        <table  width="537" border="0" cellpadding="0" cellspacing="0">
          
          <tr>
            <td width="240"><span class="Estilo7">Fecha de Creaci&oacute;n : </span><span class="Estilo12"><?php echo $fecha_aud?></span></td>
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
