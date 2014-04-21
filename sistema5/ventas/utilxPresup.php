<?php session_start();
		include('../conex_inicial.php');
		include('../funciones/funciones.php');
		

$id=$_REQUEST['id'];
$tipocosto=$_REQUEST['tipocosto'];
$moneda=$_REQUEST['moneda'];
$costo=$_REQUEST['costo'];
$cantidad=$_REQUEST['cantidad'];
$costoparcial=$_REQUEST['costoparcial'];

$factor1=$_REQUEST['factor1'];
$factor2=$_REQUEST['factor2'];
$factor3=$_REQUEST['factor3'];
$factor4=$_REQUEST['factor4'];
$factorDefecto=$_REQUEST['factorDefecto'];
$descuento=$_REQUEST['descuento'];
$tipoDesc=$_REQUEST['selectDesc'];
//echo $descuento;
	/*	
		if($_REQUEST['accion']=='delete'){
		$strSQLDEL="delete from activxpresu where id='".$_REQUEST['idActxpre']."' ";
		mysql_query($strSQLDEL);
		}
	*/	
	
		if($_REQUEST['accion']=='save'){
			
			for($i=0; $i<count($id);$i++){
			
				$strSQL="update factutilxmov set factor1='".$factor1[$i]."',factor2='".$factor2[$i]."',factor3='".$factor3[$i]."',factor4='".$factor4[$i]."',factorpred='".$factorDefecto."',cargodes='".$descuento."',tipoCargoDes='".$tipoDesc."' where id='".$id[$i]."' ";
				mysql_query($strSQL,$cn);
					
				//echo 	$strSQL."<br>";	
			}
			
		}
		
		
		
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Factores de Utilidad</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
	color: #0066FF;
}
.Estilo2 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 11px;
}
.Estilo12 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #464646; }
-->
</style>

<link href="../styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo13 {
	color: #333333;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.Estilo14 {
	font-size: 11px;
	color: #333333;
}
.Estilo17 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #333333;
}
.Estilo29 {color: #FFFFFF; font-weight: bold; font-family: Tahoma, Arial; font-size: 11px; }
.Estilo30 {color: #000000}
.Estilo31 {color: #FF0000}
.Estilo32 {
	font-size: 10px;
	font-weight: bold;
}
.Estilo33 {font-family: Arial, Helvetica, sans-serif}
-->
</style>
<style type="text/css" media="print" >
.noprint{
visibility:hidden;
}
.noprint2{
background: transparent; 
border:0px
}
</style>
<script language="javascript">
<!--
function printer() 
{ 
vbPrintPage(); 
return false; 
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
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
.Estilo34 {
	color: #0066FF;
	font-weight: bold;
}
.Estilo35 {
	color: #0066FF;
	font-family: Tahoma, Arial;
}
.Estilo36 {font-family: Tahoma, Arial}
.Estilo37 {color: #333333}
-->
</style>
</head>

<?php 


$referencia=$_REQUEST['CodDoc'];
$strsql="select * from cab_mov where cod_cab='$referencia'";
$resultado=mysql_query($strsql,$cn);
$cont=mysql_num_rows($resultado);
$row=mysql_fetch_array($resultado);
//echo $strsql;

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
$totalDoc=$row['total'];


//----------------------------------------------------------------------------------------------
$strsql="select agrupado,imp_item  from det_mov,producto,clasificacion where cod_cab='$referencia' and det_mov.cod_prod=idproducto and clasificacion=idclasificacion ";
//echo $strsql;
$resultado=mysql_query($strsql,$cn);

while($row=mysql_fetch_array($resultado)){

	if($row['agrupado']=='1'){
	$materiales=$materiales+$row['imp_item'];
	}
	if($row['agrupado']=='2'){
	$equipos=$equipos+$row['imp_item'];
	}
	if($row['agrupado']=='3'){
	$herramientas=$herramientas+$row['imp_item'];
	}
	
}



//----------------------------------------------------------------------------------------------

$totalActObra=0;
	 $SQLActvPres="select * from activxpresu where codpresup='".$referencia."' order by areacosto " ;
	  $resultadoActvPres=mysql_query($SQLActvPres,$cn);
	  while($rowActvPres=mysql_fetch_array($resultadoActvPres)){
	 
	$monedaPO=$rowActvPres['moneda'];
	$cparcial=$rowActvPres['costoparcial'];
	$totalActObra=$totalActObra + $cparcial;	
	  /*
		if($moneda==$monedaPO){
			$totalActObra=$totalActObra + $cparcial;	
		}else{
		
			if($monedaPO=='01'){
			$totalActObra=$totalActObra + $cparcial/$tipo_cambio;
			}else{
			$totalActObra=$totalActObra + $cparcial*$tipo_cambio;
			}
				
		}
	  */
	}

$totalCostosOpe=0;
	 $SQLActvPres="select * from costopexpresu  where codpresup='".$referencia."'" ;
	  $resultadoActvPres=mysql_query($SQLActvPres,$cn);
	  while($rowActvPres=mysql_fetch_array($resultadoActvPres)){
	 
	$monedaPO=$rowActvPres['moneda'];
	$cparcial=$rowActvPres['costoparcial'];
	
	
	$totalCostosOpe=$totalCostosOpe + $cparcial;
	
	 /*
		if($moneda==$monedaPO){
			$totalCostosOpe=$totalCostosOpe + $cparcial;	
		}else{
		
			if($monedaPO=='01'){
			$totalCostosOpe=$totalCostosOpe + $cparcial/$tipo_cambio;
			}else{
			$totalCostosOpe=$totalCostosOpe + $cparcial*$tipo_cambio;
			}
				
		}
	*/	
	}

?>

<body style="vertical-align:top" onLoad="calTotFactor();calcularCarDesc(document.form1.descuento)">
<form name="form1" method="post" action="">
  <table width="773" height="444" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="12" height="31" bgcolor="#E6E6E6">&nbsp;</td>
      <td width="734" align="center" bgcolor="#E6E6E6"><span class="Estilo1">Factores de Utilidad </span></td>
      <td width="10" bgcolor="#E6E6E6">&nbsp;</td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="83">&nbsp;</td>
      <td><fieldset>
        <table width="536" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="82" ><span class="Estilo13">Presup. Nº : </span></td>
            <td width="246" ><span class="Estilo17"><?php echo $serie."-".$numero ?></span></td>
            <td width="208" class="Estilo13">Moneda:
              <?php 
			if($moneda=='01')echo $simMon="S/."; else echo $simMon="US$.";
			
			 ?>
                <input name="monedadoc" type="hidden" size="3" maxlength="5" value="<?php echo $moneda?>"></td>
          </tr>
          <tr>
            <td ><span class="text7 Estilo14">Cliente:</span></td>
            <td  class="Estilo17"><?php
			
			  $SQLClie="select * from cliente where codcliente='".$cliente."' " ;
			  $resultadoClie=mysql_query($SQLClie,$cn);
			  $rowClie=mysql_fetch_array($resultadoClie);
			  
			echo  $rowClie['razonsocial'];
			
			?></td>
            <td><span class="Estilo13">Tipo de Cambio</span>
            <input name="tcdoc" type="text" size="8" maxlength="8"  value="<?php echo $tipo_cambio?>" class="noprint2"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input name="accion" type="hidden" size="5" maxlength="5" value=""></td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </fieldset> <fieldset>
      <table width="721" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="13" height="26">&nbsp;</td>
          <td width="173"><span class="Estilo33 Estilo35"><strong>Equipos </strong></span></td>
          <td width="87"><input readonly="" style="text-align:right" name="tequipos" type="text" id="tequipos" value="<?php echo number_format($equipos,2,'.','') ?>" size="10"></td>
          <td width="123"><span class="Estilo33 Estilo35"><strong>Materiales </strong></span></td>
          <td width="101"><input readonly="" style="text-align:right" name="tmateriales" type="text" id="tmateriales" value="<?php echo number_format($materiales,2,'.','') ?>" size="10"></td>
          <td width="114"><span class="Estilo33 Estilo35"><strong>Herramientas </strong></span></td>
          <td width="85"><input readonly="" style="text-align:right" name="therramientas" type="text" id="therramientas" value="<?php echo number_format($herramientas,2,'.','') ?>" size="10"></td>
          <td width="25">&nbsp;</td>
        </tr>
        <tr>
          <td height="26">&nbsp;</td>
          <td><span class="Estilo34">Mano de Obra / Actividades</span> </td>
          <td><input style="text-align:right" name="tmanoObra" type="text" id="tmanoObra"  size="10" value="<?php  echo number_format($totalActObra,2,'.',''); ?>">          </td>
          <td><span class="Estilo34 Estilo36">Costos Operativos </span></td>
          <td><input style="text-align:right" name="tcostosOpe" type="text" id="tcostosOpe" value="<?php echo number_format($totalCostosOpe,2,'.','')?>" size="10"></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      </fieldset></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="35">&nbsp;</td>
      <td height="35"><span class="Estilo2"><span class="Estilo30">Factor por defecto </span> 
                        <?php 
						
						 $SQLActvPres="select * from factutilxmov where cod_cab='".$referencia."' order by id " ;
	  					$resultadoActvPres=mysql_query($SQLActvPres,$cn);
	  					$rowActvPres=mysql_fetch_array($resultadoActvPres);
	   					$descuento=$rowActvPres['cargodes'];
	  					$tipoDesc=$rowActvPres['tipoCargoDes'];
						
						if($tipoDesc=='1'){
						  $porcentual1=" selected ";
						}
						if($tipoDesc=='2'){
						  $porcentual2=" selected ";
						}
						
						$factorDefecto=$rowActvPres['factorpred'];
						
						?>
						
			<input name="idActxpre" type="hidden" size="5" maxlength="5" value="" >
          <select name="factorDefecto" id="factorDefecto" onChange="cambiarFactorDef()">
            <option value="1">15 Dias</option>
            <option value="2" selected>30 Dias</option>
            <option value="3">45 Dias</option>
            <option value="4">60 Dias</option>
          </select>
		  
		  
                        <script>
	   var valor1="<?php echo $factorDefecto?>";
     var i;
	 for (i=0;i<document.form1.factorDefecto.options.length;i++)
        {
		
            if (document.form1.factorDefecto.options[i].value==valor1)
               {
			   
               document.form1.factorDefecto.options[i].selected=true;
               }
        
        }
	                  </script>
		  
		  
                        <span class="Estilo30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Descuento / Cargo :
						
						
						
                        <select name="selectDesc" onChange="calcularCarDesc(document.form1.descuento)">
                          <option value="1" <?php echo $porcentual1 ?>>Porcentual</option>
                          <option value="2" <?php echo $porcentual2 ?>>Monto</option>
                        </select> 
                        <input name="descuento" id="descuento" type="text" size="10" style="text-align:right" value="<?php echo $descuento?>" onKeyUp="calcularCarDesc(this)">
                        </span></span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="45">&nbsp;</td>
      <td><table id="tblCostos" width="748" border="0" cellpadding="0" cellspacing="1">
          <tr style="background:url(../imagenes/bg_contentbase4.gif) 100%">
            <td width="171" height="25" ><span class="Estilo29">Descripci&oacute;n</span></td>
            <td colspan="2" align="center" id="dias1"><span class="Estilo29">15 Dias  /importe</span></td>
            <td colspan="2" align="center" id="dias2"><span class="Estilo29">30 Dias  /importe</span></td>
            <td colspan="2" align="center" id="dias3"><span class="Estilo29">45 Dias  /importe</span></td>
            <td colspan="2" align="center" id="dias4"><span class="Estilo29">60 Dias  /importe</span></td>
            <td width="62" align="center" id="dias5"><span class="Estilo29">Accion</span></td>
          </tr>
          <?php
	  
	  
      $SQLActvPres="select * from factutilxmov where cod_cab='".$referencia."' order by id " ;
	  $resultadoActvPres=mysql_query($SQLActvPres,$cn);
	  $cont=mysql_num_rows($resultadoActvPres);
	  //echo $SQLActvPres;
	  if($cont==0){
		  $SQLActvPres="select * from factorutilidad " ;
		  $resultadoActvPres=mysql_query($SQLActvPres,$cn);
		  while($rowActvPres=mysql_fetch_array($resultadoActvPres)){
		  $strInsert="insert into factutilxmov(cod_cab,codconcepto,concepto,factor1,factor2,factor3,factor4) values ('".$referencia."','".$rowActvPres['id']."','".$rowActvPres['conceptos']."','".$rowActvPres['factor1']."','".$rowActvPres['factor2']."','".$rowActvPres['factor3']."','".$rowActvPres['factor4']."')" ;
		  mysql_query($strInsert,$cn);
		  //echo $strInsert."<br>";
		  }	  
	  
	  
	  }
	  	  
	  
	  $SQLActvPres="select * from factutilxmov where cod_cab='".$referencia."' order by id " ;
	  $resultadoActvPres=mysql_query($SQLActvPres,$cn);
	  while($rowActvPres=mysql_fetch_array($resultadoActvPres)){
	  
	  $tempTotales=0;
	  //if($rowActvPres['codconcepto']==1)$tempTotales=$totalDoc;
	  if($rowActvPres['codconcepto']==1)$tempTotales=$equipos;
	  if($rowActvPres['codconcepto']==2)$tempTotales=$materiales;
	  if($rowActvPres['codconcepto']==3)$tempTotales=$herramientas;
	  
	  if($rowActvPres['codconcepto']==4)$tempTotales=$totalActObra;
	  if($rowActvPres['codconcepto']==5)$tempTotales=$totalCostosOpe;
	  
	  $descuento=$rowActvPres['cargodes'];
	  $tipoDesc=$rowActvPres['tipoCargoDes'];
	  
	  ?>
          <tr>
            <td height="26" bgcolor="#F5F5F5"><span class="Estilo12"><?php 
			  			  	
				echo $rowActvPres['concepto'];
			
			?></span></td>
            <td width="66" align="center" bgcolor="#F5F5F5"><input onKeyUp="calImporte(this)" style="text-align:right" name="factor1[]" id="factor1" type="text" size="3" value="<?php echo $rowActvPres['factor1']; ?>">
            <span class="Estilo32">%</span></td>
            <td width="60" align="center" bgcolor="#F5F5F5">
			<input style="text-align:right; font:bold" disabled="disabled" name="importe1[]" id="importe1" type="text" size="8" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor1']),2,'.','') ?>">			</td>
            <td width="66" align="center" bgcolor="#F5F5F5"><input onKeyUp="calImporte(this)" style="text-align:right" name="factor2[]" id="factor2" type="text" size="3" value="<?php echo $rowActvPres['factor2']; ?>">
            <span class="Estilo32">%</span></td>
            <td width="60" align="center" bgcolor="#F5F5F5"><input style="text-align:right; font:bold" disabled="disabled" name="textfield22" type="text" size="8" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor2']),2,'.','') ?>"></td>
            <td width="64" align="center" bgcolor="#F5F5F5"><input onKeyUp="calImporte(this)" style="text-align:right" name="factor3[]" id="factor3" type="text" size="3" value="<?php echo $rowActvPres['factor3']; ?>">
            <span class="Estilo32">%</span></td>
            <td width="62" align="center" bgcolor="#F5F5F5"><input style="text-align:right; font:bold" disabled="disabled" name="textfield23" type="text" size="8" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor3']),2,'.','') ?>"></td>
            <td width="64" align="center" bgcolor="#F5F5F5"><input onKeyUp="calImporte(this)" style="text-align:right" name="factor4[]" id="factor4" type="text" size="3" value="<?php echo $rowActvPres['factor4']; ?>">
            <span class="Estilo32">%</span></td>
            <td width="62" align="center" bgcolor="#F5F5F5"><input style="text-align:right; font:bold" disabled="disabled" name="textfield24" type="text" size="8" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor4']),2,'.','') ?>"></td>
            <td align="center" bgcolor="#F5F5F5"><!--<img onClick="eliminar('<?php // echo $rowActvPres['id'] ?>')" style="cursor:pointer"  src="../imgenes/eliminar.gif" width="14" height="14" border="0" />
            <input name="id[]" id="id" type="hidden" size="5" maxlength="5" value="<?php // echo $rowActvPres['id'] ?>">-->
            <input name="id[]" id="id" type="hidden" size="5" maxlength="5" value="<?php echo $rowActvPres['id'] ?>"></td>
          </tr>
          <?php }?>
      </table></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="162">&nbsp;</td>
      <td align="right"><table width="732" border="0">
          <tr>
            <td align="right"><span class="Estilo37">SubTotal Factor </span></td>
            <td align="right"><input style="text-align:right; font:bold; border:none" disabled="disabled" name="subTotFac1" type="text" size="12" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor1']),2) ?>"></td>
            <td align="right"><input style="text-align:right; font:bold; border:none" disabled="disabled" name="subTotFac2" type="text" size="12" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor1']),2) ?>"></td>
            <td align="right"><input style="text-align:right; font:bold; border:none; border:none" disabled="disabled" name="subTotFac3" type="text" size="12" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor1']),2) ?>"></td>
            <td align="right"><input style="text-align:right; font:bold; border:none" disabled="disabled" name="subTotFac4" type="text" size="12" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor1']),2) ?>"></td>
            <td align="right">&nbsp;</td>
          </tr>
          <tr>
            <td align="right"><span class="Estilo37">Costo Presupuesto </span></td>
            <td align="right"><input style="text-align:right; font:bold; border:none" disabled="disabled" name="costoPre1" type="text" size="12" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor1']),2) ?>"></td>
            <td align="right"><input style="text-align:right; font:bold; border:none" disabled="disabled" name="costoPre2" type="text" size="12" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor1']),2) ?>"></td>
            <td align="right"><input style="text-align:right; font:bold; border:none" disabled="disabled" name="costoPre3" type="text" size="12" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor1']),2) ?>"></td>
            <td align="right"><input style="text-align:right; font:bold; border:none" disabled="disabled" name="costoPre4" type="text" size="12" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor1']),2) ?>"></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="22" align="right" bgcolor="#F3F3F3"><span class="Estilo37">Neto Presupuesto </span></td>
            <td align="right" bgcolor="#F3F3F3"><input style="text-align:right; font:bold; border:none; background:none" disabled="disabled" name="metoPre1" type="text" size="12" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor1']),2) ?>"></td>
            <td align="right" bgcolor="#F3F3F3"><input style="text-align:right; font:bold; border:none; background:none" disabled="disabled" name="metoPre2" type="text" size="12" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor1']),2) ?>"></td>
            <td align="right" bgcolor="#F3F3F3"><input style="text-align:right; font:bold; border:none; background:none" disabled="disabled" name="metoPre3" type="text" size="12" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor1']),2) ?>"></td>
            <td align="right" bgcolor="#F3F3F3"><input style="text-align:right; font:bold; border:none; background:none" disabled="disabled" name="metoPre4" type="text" size="12" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor1']),2) ?>"></td>
            <td bgcolor="#F3F3F3">&nbsp;</td>
          </tr>
          <tr>
            <td height="22" align="right"><span class="Estilo37">Descuento/Cargo</span></td>
            <td align="right"><input style="text-align:right; font:bold; border:none" disabled="disabled" name="desCargo1" type="text" size="12" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor1']),2) ?>"></td>
            <td align="right"><input style="text-align:right; font:bold; border:none" disabled="disabled" name="desCargo2" type="text" size="12" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor1']),2) ?>"></td>
            <td align="right"><input style="text-align:right; font:bold; border:none" disabled="disabled" name="desCargo3" type="text" size="12" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor1']),2) ?>"></td>
            <td align="right"><input style="text-align:right; font:bold; border:none" disabled="disabled" name="desCargo4" type="text" size="12" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor1']),2) ?>"></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="22" align="right"><span class="Estilo37">Neto con Descuentos/Cargos </span></td>
            <td align="right"><input style="text-align:right; font:bold; border:none" disabled="disabled" name="totalCDesc1" type="text" size="12" value="<?php  ?>"></td>
            <td align="right"><input style="text-align:right; font:bold; border:none" disabled="disabled" name="totalCDesc2" type="text" size="12" value="<?php  ?>"></td>
            <td align="right"><input style="text-align:right; font:bold; border:none" disabled="disabled" name="totalCDesc3" type="text" size="12" value="<?php  ?>"></td>
            <td align="right"><input style="text-align:right; font:bold; border:none" disabled="disabled" name="totalCDesc4" type="text" size="12" value="<?php  ?>"></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right"><span class="Estilo37">IGV ( 18% )</span></td>
            <td align="right"><input style="text-align:right; font:bold; border:none" disabled="disabled" name="igv1" type="text" size="12" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor1']),2) ?>" ></td>
            <td align="right"><input style="text-align:right; font:bold; border:none" disabled="disabled" name="igv2" type="text" size="12" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor1']),2) ?>"></td>
            <td align="right"><input style="text-align:right; font:bold; border:none" disabled="disabled" name="igv3" type="text" size="12" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor1']),2) ?>"></td>
            <td align="right"><input style="text-align:right; font:bold; border:none" disabled="disabled" name="igv4" type="text" size="12" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor1']),2) ?>"></td>
            <td>&nbsp;</td>
          </tr>
          <tr >
            <td height="29" align="right" bgcolor="#FDEF8A"><span class="Estilo31"><strong>TOTAL PRESUPUESTO 
			    
			</strong></span></td>
            <td align="right" bgcolor="#FDEF8A"><input style="text-align:right; font:bold; border:none; background:none" readonly name="totGenPre1" type="text" size="12" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor1']),2) ?>"></td>
            <td align="right" bgcolor="#FDEF8A"><input style="text-align:right; font:bold; border:none; background:none" readonly name="totGenPre2" type="text" size="12" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor1']),2) ?>"></td>
            <td align="right" bgcolor="#FDEF8A"><input style="text-align:right; font:bold; border:none; background:none" readonly name="totGenPre3" type="text" size="12" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor1']),2) ?>"></td>
            <td align="right" bgcolor="#FDEF8A"><input style="text-align:right; font:bold; border:none; background:none" readonly name="totGenPre4" type="text" size="12" value="<?php echo number_format(($tempTotales/100 * $rowActvPres['factor1']),2) ?>"></td>
            <td >&nbsp;</td>
          </tr>
          <tr>
            <td width="160" align="right">&nbsp;</td>
            <td width="119" align="right">&nbsp;</td>
            <td width="122" align="right">&nbsp;</td>
            <td width="122" align="right">&nbsp;</td>
            <td width="126" align="right"><span class="Estilo30">
              <span class="Estilo2">
              <?php  //echo $simMon; ?>
              </span>
              <!--<input style="text-align:right"  name="totalCostos" type="text" size="10" maxlength="10" class="noprint2">-->
            </span></td>
            <td width="57" align="right">&nbsp;</td>
          </tr>
      </table></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
      <td align="center"><input type="button" name="Submit" value="      Guardar      " onClick="guardar()" class="noprint">
     <!-- <input type="submit" name="Submit2" value="Imprimir" onClick="printer()" class="noprint">--></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>
</body>
</html>

<script>

function calularParcial(obj){

var moneda=obj.parentNode.parentNode.cells[3].childNodes[0].value;
var costo=obj.parentNode.parentNode.cells[4].childNodes[0].value;
var cantidad=obj.parentNode.parentNode.cells[5].childNodes[0].value;
//alert(moneda);
obj.parentNode.parentNode.cells[6].childNodes[0].value=parseFloat(cantidad)*(costo);
calcularMonTotal();

}

function calcularMonTotal(){

var monedaDoc=document.form1.monedadoc.value;
var tcDoc=parseFloat(document.form1.tcdoc.value);
var moneda;
var totalGeneral=0;

	for (var i=1;i<document.getElementById('tblCostos').rows.length;i++) {
	
	moneda=document.getElementById('tblCostos').rows[i].cells[3].childNodes[0].value;
	cparcial=parseFloat(document.getElementById('tblCostos').rows[i].cells[6].childNodes[0].value);
	
		if(monedaDoc==moneda){
			totalGeneral=parseFloat(totalGeneral) + parseFloat(cparcial);	
		}else{
		
			if(moneda=='01'){
			totalGeneral=parseFloat(totalGeneral) + parseFloat(cparcial/tcDoc);
			}else{
			totalGeneral=parseFloat(totalGeneral) + parseFloat(cparcial*tcDoc);
			}
				
		}
		//alert(totalGeneral);
	}
	document.form1.totalCostos.value=totalGeneral.toFixed(2);



}

function ltrim(str, filter){
  filter || ( filter = '\\s|\\&nbsp;' );
  var pattern = new RegExp('^(' + filter + ')*', 'g');
  return str.replace(pattern, "");
}
function rtrim(str, filter){
  filter || ( filter = '\\s|\\&nbsp;' );
  var pattern = new RegExp('(' + filter + ')*$', 'g');
  return str.replace(pattern, "");
}
function trim(str, filter){
  filter || ( filter = '\\s|\\&nbsp;' );
  return ltrim(rtrim(str, filter), filter);
}


function eliminar(cod){
	document.form1.accion.value='delete';
	document.form1.idActxpre.value=cod;
	
	document.form1.submit();
}
function guardar(){
	document.form1.accion.value='save';
	document.form1.submit();
}

function calImporte(obj){

var factor=parseFloat(obj.parentNode.childNodes[0].value);

if(isNaN(factor))factor=0;

var row=obj.parentNode.parentNode.rowIndex;
	if(row==1)var tempTotal=parseFloat(document.form1.tequipos.value);
	if(row==2)var tempTotal=parseFloat(document.form1.tmateriales.value);	
	if(row==3)var tempTotal=parseFloat(document.form1.therramientas.value);
	if(row==4)var tempTotal=parseFloat(document.form1.tmanoObra.value);	
	if(row==5)var tempTotal=parseFloat(document.form1.tcostosOpe.value);	
	
obj.parentNode.nextSibling.childNodes[0].value=(tempTotal*factor/100).toFixed(2);
calTotFactor();
}

function calTotFactor(){

	var totFactor1=0;
	var totFactor2=0;
	var totFactor3=0;
	var totFactor4=0;
	
	for (var i=1;i<document.getElementById('tblCostos').rows.length;i++) {
	
	//moneda=document.getElementById('tblCostos').rows[i].cells[3].childNodes[0].value;
	//cparcial=parseFloat(document.getElementById('tblCostos').rows[i].cells[6].childNodes[0].value);
	 totFactor1=totFactor1+parseFloat(format(document.getElementById('tblCostos').rows[i].cells[2].childNodes[0].value));	 
	 //alert(totFactor1);
	 totFactor2=totFactor2+parseFloat(document.getElementById('tblCostos').rows[i].cells[4].childNodes[0].value);
	 totFactor3=totFactor3+parseFloat(document.getElementById('tblCostos').rows[i].cells[6].childNodes[0].value);
	 totFactor4=totFactor4+parseFloat(document.getElementById('tblCostos').rows[i].cells[8].childNodes[0].value);
	 }
	 
	 
	 document.form1.subTotFac1.value=(totFactor1).toFixed(2);
	 document.form1.subTotFac2.value=(totFactor2).toFixed(2);
	 document.form1.subTotFac3.value=(totFactor3).toFixed(2);
	 document.form1.subTotFac4.value=(totFactor4).toFixed(2);
	 
	 var costoPreTotal=parseFloat(document.form1.tequipos.value)+parseFloat(document.form1.tmateriales.value)+parseFloat(document.form1.therramientas.value)+parseFloat(document.form1.tmanoObra.value)+parseFloat(document.form1.tcostosOpe.value);
	 	 
	 	document.form1.costoPre1.value=(costoPreTotal).toFixed(2);
		document.form1.costoPre2.value=(costoPreTotal).toFixed(2);
		document.form1.costoPre3.value=(costoPreTotal).toFixed(2);
		document.form1.costoPre4.value=(costoPreTotal).toFixed(2);
					
		
		
		document.form1.metoPre1.value=(parseFloat(document.form1.subTotFac1.value) + parseFloat(document.form1.costoPre1.value)).toFixed(2);
		document.form1.metoPre2.value=(parseFloat(document.form1.subTotFac2.value) + parseFloat(document.form1.costoPre2.value)).toFixed(2);
		document.form1.metoPre3.value=(parseFloat(document.form1.subTotFac3.value) + parseFloat(document.form1.costoPre3.value)).toFixed(2);
		document.form1.metoPre4.value=(parseFloat(document.form1.subTotFac4.value) + parseFloat(document.form1.costoPre4.value)).toFixed(2);
			
		
		document.form1.totalCDesc1.value=(parseFloat(document.form1.metoPre1.value)-parseFloat(document.form1.desCargo1.value)).toFixed(2);
		document.form1.totalCDesc2.value=parseFloat(document.form1.metoPre2.value).toFixed(2);
		document.form1.totalCDesc3.value=(parseFloat(document.form1.desCargo3.value)+parseFloat(document.form1.metoPre3.value)).toFixed(2);
		document.form1.totalCDesc4.value=(parseFloat(document.form1.desCargo4.value)+parseFloat(document.form1.metoPre4.value)).toFixed(2);
		
		document.form1.igv1.value=(parseFloat(document.form1.totalCDesc1.value)*0.18).toFixed(2);
		document.form1.igv2.value=(parseFloat(document.form1.totalCDesc2.value)*0.18).toFixed(2);
		document.form1.igv3.value=(parseFloat(document.form1.totalCDesc3.value)*0.18).toFixed(2);
		document.form1.igv4.value=(parseFloat(document.form1.totalCDesc4.value)*0.18).toFixed(2);
						
		document.form1.totGenPre1.value=(parseFloat(document.form1.igv1.value)+parseFloat(document.form1.totalCDesc1.value)).toFixed(2);
		document.form1.totGenPre2.value=(parseFloat(document.form1.igv2.value)+parseFloat(document.form1.totalCDesc2.value)).toFixed(2);
		document.form1.totGenPre3.value=(parseFloat(document.form1.igv3.value)+parseFloat(document.form1.totalCDesc3.value)).toFixed(2);
		document.form1.totGenPre4.value=(parseFloat(document.form1.igv4.value)+parseFloat(document.form1.totalCDesc4.value)).toFixed(2);
				
}


function format(valor)
{
//var num = valor.replace(/\./g,'');
	var num = valor.replace(/\,/g,"");
	if(!isNaN(num)){
	//num = num.toString().split("").reverse().join("").replace(/(?=\d*\.?)(\d{3})/g,"$1.");
	//num = num.split("").reverse().join("").replace(/^[\.]/,"");
	//input.value = num;
	}else{
	//input.value = input.value.replace(/[^\d\.]*/g,"");
	}
	//alert(num);
	return num;
}

function calcularCarDesc(obj){
	
	if(obj.value==""){
	obj.value=0;
	}
	
	document.form1.desCargo1.value="0.00";
	document.form1.desCargo3.value="0.00";
	document.form1.desCargo4.value="0.00";
	
	if(document.form1.selectDesc.value=='1'){
		if(document.form1.factorDefecto.value==1)
		document.form1.desCargo1.value=(parseFloat(document.form1.metoPre1.value)*parseFloat(obj.value)/100).toFixed(2);
		if(document.form1.factorDefecto.value==3)
		document.form1.desCargo3.value=(parseFloat(document.form1.metoPre3.value)*parseFloat(obj.value)/100).toFixed(2);
		if(document.form1.factorDefecto.value==4)
		document.form1.desCargo4.value=(parseFloat(document.form1.metoPre4.value)*parseFloat(obj.value)/100).toFixed(2);
	
	}else{
	
	document.form1.desCargo1.value=(parseFloat(obj.value));
	document.form1.desCargo3.value=(parseFloat(obj.value));
	document.form1.desCargo4.value=(parseFloat(obj.value));
	
	}
	
	
	cambiarFactorDef()
	
	calTotFactor();
}

function cambiarFactorDef(){
	  
	  document.getElementById('dias1').style.background="url(../imagenes/bg_contentbase4.gif) 100%";
	  document.getElementById('dias2').style.background="url(../imagenes/bg_contentbase4.gif) 100%";
	  document.getElementById('dias3').style.background="url(../imagenes/bg_contentbase4.gif) 100%";
	  document.getElementById('dias4').style.background="url(../imagenes/bg_contentbase4.gif) 100%";
	  
	  
	  if(document.form1.factorDefecto.value=='1')
	  document.getElementById('dias1').style.background="url(../imagenes/bg_contentbase3.jpg)";
	  if(document.form1.factorDefecto.value=='2')
	  document.getElementById('dias2').style.background="url(../imagenes/bg_contentbase3.jpg)";
	  if(document.form1.factorDefecto.value=='3')
	  document.getElementById('dias3').style.background="url(../imagenes/bg_contentbase3.jpg)";
	  if(document.form1.factorDefecto.value=='4')
	  document.getElementById('dias4').style.background="url(../imagenes/bg_contentbase3.jpg)";
	  
	 
	document.form1.desCargo1.value="0.00";
	document.form1.desCargo3.value="0.00";
	document.form1.desCargo4.value="0.00";
	
	if(document.form1.selectDesc.value=='1'){
		if(document.form1.factorDefecto.value==1)
		document.form1.desCargo1.value=(parseFloat(document.form1.metoPre1.value)*parseFloat(document.form1.descuento.value)/100).toFixed(2);
		if(document.form1.factorDefecto.value==3)
		document.form1.desCargo3.value=(parseFloat(document.form1.metoPre3.value)*parseFloat(document.form1.descuento.value)/100).toFixed(2);
		if(document.form1.factorDefecto.value==4)
		document.form1.desCargo4.value=(parseFloat(document.form1.metoPre4.value)*parseFloat(document.form1.descuento.value)/100).toFixed(2);
	
	}else{
	
	document.form1.desCargo1.value=(parseFloat(document.form1.descuento.value));
	document.form1.desCargo3.value=(parseFloat(document.form1.descuento.value));
	document.form1.desCargo4.value=(parseFloat(document.form1.descuento.value));
	
	}
	 
	 calTotFactor();
}


</script>
