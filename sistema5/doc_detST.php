<?php 
session_start();
include('conex_inicial.php');
include('funciones/funciones.php');

$referencia=$_REQUEST['referencia'];
//echo $referencia;

$strsql="select * from cab_mov where cod_cab='$referencia'";
$resultado=mysql_query($strsql,$cn);
$cont=mysql_num_rows($resultado);
$row=mysql_fetch_array($resultado);
//echo $cont;

$sql="Select cm.obs1 from cab_mov cm inner join referencia ref on ref.cod_cab=cm.cod_cab where ref.cod_cab_ref='$referencia'";
$con=mysql_query($sql,$cn);
$row2=mysql_fetch_array($con);

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
$dirDestino=$row['dirDestino'];
$condicion=$row['condicion'];
$transportista=$row['transportista'];
$chofer=$row['chofer'];
////////////////////Solo garantias
$obser=$row['obs1'];
$tarea=$row['obs2'];
$flete=$row['flete'];
$acciones=$row2['obs1'];
//documento Cod_pro por Cos_anexo
$Tip=$_REQUEST['Tip'];
////////////////////

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
.Estilo30 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #464646; }
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
  
    <td width="4" height="86">&nbsp;</td>
    <td width="866" style="padding-top:10px">
	<fieldset>
    <table width="100%" height="114" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="19">&nbsp;</td>
        <td><span class="Estilo7">Empresa/ Tienda: </span><span class="Estilo12"><?php echo $empresa; ?></span></td>
        <td><span class="Estilo7">Fecha: </span><span class="Estilo12"><?php echo $fecha?></span></td>
      </tr>
      <tr>
        <td width="32" height="19">&nbsp;</td>
        <td width="429"><span class="Estilo12"><span class="Estilo7">TD</span>: <?php echo $cod_ope." : ".$serie."-".$numero ?></strong></span></td>
        <td width="403">
		<!--
		<span class="Estilo12"><?php //echo "Nro.Operaci&oacute;n: ".str_pad($noperacion, 10, "0", STR_PAD_LEFT)?></span>-->
		<span class="Estilo7">Condicion</span><span class="Estilo12">&nbsp;&nbsp;
		<?php 
		list($nombreCondi)	=	mysql_fetch_array(mysql_query("select nombre from condicion where codigo='".$condicion."'"));
		echo $nombreCondi; ?>
		
		</span></td>
      </tr>
      <tr>
        <td height="19">&nbsp;</td>
        <td><span class="Estilo7">Se&ntilde;ores:</span><span class="Estilo12"> <?php echo $razonsocial; ?></span></td>
        <td><span class="Estilo7">Ruc:</span><span class="Estilo12"><?php echo $ruc; ?></span></td>
      </tr>
      <tr>
        <td height="19">&nbsp;</td>
        <td><span class="Estilo7">Direcci&oacute;n</span>:<span class="Estilo12"><?php echo caracteres($dirDestino); ?></span></td>
        <td><span class="Estilo7">Tc.</span><span class="Estilo12"><?php echo $tipo_cambio; ?></span> <span class="Estilo7">&nbsp;&nbsp;&nbsp;Moneda:</span><span class="Estilo12"><?php echo $des_mon; ?><span class="Estilo7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Impuesto:</span> <span class="Estilo25"><?php echo $texto_incl_igv; ?></span></span></td>
      </tr>
      <tr>
        <td height="19">&nbsp;</td>
        <td><span class="Estilo7">Responsable: </span><span class="Estilo12"><?php echo $responsable?></span></td>
        <td><span class="Estilo7">Doc.Ref: </span></td>
      </tr>
      <tr>
        <td height="19">&nbsp;</td>
        <td><span class="Estilo7">Transportista :</span>
		<span class="Estilo12">
		<?php 
		list($nombretransp)	=	mysql_fetch_array(mysql_query("select nombre from transportista where id='".$transportista."'"));
		echo $nombretransp;
		?>
		</span>
		</td>
        <td><span class="Estilo7">Chofer :</span>
		<span class="Estilo12">
		<?php 
		list($nombrechofer)	=	mysql_fetch_array(mysql_query("select nombre from chofer where cod='".$chofer."'"));
		echo $nombrechofer;
		?>
		</span>
		</td>
      </tr>
    </table>
    </fieldset>	</td>
    <td width="93">&nbsp;</td>
  </tr>
  <tr>
    <td height="278">&nbsp;</td>
    <td><table width="100%" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td height="25" colspan="6"><span class="Estilo3">Detalle : </span></td>
      </tr>
      <tr style="background:url(imagenes/bg_contentbase2.gif);  background-position:100% 40%;">
        <td width="129" height="18" align="center" ><span class="Estilo24">Cod. Anex. </span></td>
        <td width="415" ><span class="Estilo24">Producto</span></td>
        <td width="58" align="center" ><span class="Estilo24">Und.</span></td>
        <td width="70" align="center" ><span class="Estilo24">Cant.</span></td>
        <td width="77" align="right" ><span class="Estilo24">P.Unit</span></td>
        <td colspan="2" align="right" ><span class="Estilo24">Total</span></td>
        </tr>
      <?php 
	  $strSQL4="select cantidad,cod_prod,nom_prod,precio,unidad,codanex, desc1, desc2, imp_item  from det_mov where cod_cab='".$referencia."' order by cod_det";
 $resultado4=mysql_query($strSQL4,$cn);
// echo $strSQL4;
$nitems=0;
 while($row4=mysql_fetch_array($resultado4)){
 $nitems=$nitems+1;
	  ?>
      <tr>
        <td valign="top" bgcolor="#EFEFEF" class="Estilo7" ><?php 
		if ($Tip==2){
			echo substr($row4['codanex'],0,50);
		}else{
			echo substr($row4['cod_prod'],0,50);
		}
		?></td>
        <td bgcolor="#EFEFEF"><span class="Estilo7"><?php echo substr($row4['nom_prod'],0,100);?></span><span class="Estilo7" style="color:#0066FF; font-family:Arial, Helvetica, sans-serif; font-size:9px"><br>
              <?php
	  $sqlx="SELECT serie from series WHERE producto='".$row4['cod_prod']."' and tienda='".$codtienda."' and (ingreso ='".$referencia."' or salida='".$referencia."')";
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
              <?php echo "Series::".$seriesx; } ?></span>
            <p></p></td>
        <td  align="center" valign="top" bgcolor="#EFEFEF"><span class="Estilo7">
          <?php 
		$strUND="select * from unidades  where id='".$row4['unidad']."'";
		$resultadoUND=mysql_query($strUND,$cn);
		$rowUND=mysql_fetch_array($resultadoUND);
		 echo $rowUND['nombre'];

			
		?>
        </span></td>
        <td align="center" bgcolor="#EFEFEF" valign="top" ><span class="Estilo7"><?php echo $row4['cantidad'];?></span></td>
        <td align="right" bgcolor="#EFEFEF" valign="top" ><span class="Estilo7">
          <?php 
	
	$strSQL40="select * from producto where idproducto='".$row4['cod_prod']."'";
 $resultado40=mysql_query($strSQL40,$cn);
	$row40=mysql_fetch_array($resultado40);
	
	$total=$row4['precio']*$row4['cantidad'];
//	$importe=$importe+$total;
	
	if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	echo number_format($row4['precio'],2);
	}
	
	    $valventa=$valventa+($row4['cantidad']*$row4['precio']);
	
		$totalitem=$row4['cantidad'] * $row4['precio'] ;
		
		$tempDesc1=$totalitem*($row4['desc1']/100);
		$tempDesc2=($totalitem-$tempDesc1)*($row4['desc2']/100);
		
		$descTotal=$descTotal+($tempDesc1+$tempDesc2);
	
	
	?>
        </span></td>
        <td colspan="2"  align="right" valign="top" bgcolor="#EFEFEF"><span class="Estilo7">
          <?php 
		if ($_SESSION['nivel_usu']==2){
			echo '***';
		}else{
			echo number_format($row4['imp_item'],2);
		}
		 ?>
        </span></td>
        </tr>
      <?php }
	  
	  if($inafecto=='N'){
	  ?>
      <tr>
        <td height="21">&nbsp;</td>
        <td colspan="5" align="right"><span class="Estilo7">Base Imponible </span></td>
        <td width="94" align="right"><span class="Estilo12">
          <?php 
		if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	echo $b_imp;
	}
		?>
        </span></td>
        </tr>
      <tr>
        <td height="21">&nbsp;</td>
        <td colspan="5" align="right"><span class="Estilo7">Impuesto (<?php echo $impto?> %)</span></td>
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
      <tr>
        <td height="21">&nbsp;</td>
        <td colspan="5" align="right"><span class="Estilo7">Total Documento <?php echo $simbolo;?> </span></td>
        <td align="right"><span class="Estilo12">
          <?php 
		if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	echo number_format($importe,2);
	}	
		?>
        </span></td>
        </tr>
      <?php //if(substr($cod_ope,0,1)=="R" || substr($cod_ope,0,1)=="S"){?>
      <tr>
        <td height="22"><span class="Estilo7">Descripcion&nbsp;</span></td>
        <td colspan="4" align="left"><span class="Estilo12"><?php echo $tarea?></span></td>
        <td width="1" align="right">&nbsp;</td>
      </tr>
      <tr>
        <td height="22"><span class="Estilo7">Obs.&nbsp;</span></td>
        <td colspan="4" align="left"><span class="Estilo12"><?php echo $obser?></span></td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr>
        <td height="22"><span class="Estilo7">Acciones</span></td>
        <td colspan="4" align="left"><span class="Estilo12"><?php echo $acciones?></span></td>
        <td align="right">&nbsp;</td>
      </tr>
      <?php /*}else{?>
      <tr>
        <td height="21" colspan="7">&nbsp;</td>
        </tr>
        <?php }*/?>
      <tr>
        <td height="22">&nbsp;</td>
        <td colspan="4" align="right">&nbsp;</td>
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
            <td width="240"><span class="Estilo7">Fecha de Creaci&oacute;n : </span><span class="Estilo12"><?php echo $fecha_aud?></span></td>
            <td colspan="4"><span class="Estilo7">Nombre PC: </span><span class="Estilo12"><?php echo $nom_pc?></span></td>

		              <td width="128" colspan="4"><center><a href="#" onClick="javascript:printer()" ><img src="imgenes/imprimir.gif" width="42" height="42" border="0" class="no_print"></a></center></td>
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
