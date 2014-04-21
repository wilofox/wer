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

//-----------------------------------RM---------------------------------------------------
$serieRM='001';
list($numeroRM)=mysql_fetch_row(mysql_query("select max(Num_doc) from cab_mov where cod_ope='RM' and serie='".$serieRM."' and sucursal='".$codsucursal."' "));

$numeroRM=str_pad($numeroRM+1,7,"0",STR_PAD_LEFT);

//----------------------------------------------------------------------------------------




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
.Estilo7 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.Estilo12 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo21 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #FF0000; }
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
.Estilo45 {color: #FFFFFF}
.Estilo47 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #333333; }
-->
</style>
</head>

<body>

<form id="form1" name="form1" method="post" action="" >

<table width="100%" height="267" border="0" cellpadding="0" cellspacing="0">
  <tr>
  <td height="39" colspan="3" align="center" bgcolor="#003366"><span class="Estilo1">DOCUMENTOS RELACIONADOS <br>
  ORDEN TRABAJO </span></td>
  
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
        <td width="395"><span class="Estilo12"><span class="Estilo7">TD</span></span>: <span class="Estilo12 Estilo42"><?php echo $cod_ope." : ".$serie."-".$numero ?></strong></span></td>
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
        <td colspan="2">&nbsp;</td>
      </tr>
    </table>
    </fieldset>
	
	</td>
    <td width="9">&nbsp;</td>
  </tr>
  <tr>
    <td height="55">&nbsp;</td>
    <td>
	<br>
	<fieldset><legend class="Estilo44">Documentos</legend>
        <table width="100%" height="66" border="0" cellpadding="1" cellspacing="1">
          <tr style="background:url(../imagenes/bg_contentbase4.gif); background-position:80px 60px">
            <td>&nbsp;</td>
            <td><span class="Estilo12 Estilo45"><strong>Fecha</strong></span></td>
            <td colspan="2"><span class="Estilo12 Estilo45"><strong>Nro Documento </strong></span></td>
            <td><span class="Estilo12 Estilo45"><strong>Cliente</strong></span></td>
            <td><span class="Estilo12 Estilo45"><strong>Responsable</strong></span></td>
            <td><span class="Estilo12 Estilo45"><strong>Tienda</strong></span></td>
          </tr>
	
		  <?php  
		
		for($j=0;$j<=2;$j++){
	
			if($j==0) {$t_doc='SM';$des_doc='SALIDA DE MATERIALES';}
			if($j==1) {$t_doc='RM';$des_doc='RETORNO DE MATERIALES';}
			if($j==2) {$t_doc='F1';$des_doc='FACTURA DE COMPRA';}
			//if($j==2) $t_doc='TN';
			  
		  echo "<tr><td colspan='6'><span class='Estilo7'>".$des_doc." (".$t_doc.") </span></td></tr>";
		  
		   $strSQLRef="select referencia.*,cab_mov.* from referencia,cab_mov where cab_mov.cod_cab=referencia.cod_cab and referencia.cod_cab_ref='".$referencia."' and cod_ope='".$t_doc."'";
		 
		 $resultadoRef=mysql_query($strSQLRef,$cn);
		 while($rowRef=mysql_fetch_array($resultadoRef)){
		  
		  ?>
		  
          <tr>
            <td width="22" bgcolor="#F4F4F4"><img onClick="doc_det('<?php echo $rowRef['cod_cab'] ?>')" src="../imagenes/ico_lupa.png"  width="16" height="16" border="0" style="cursor:pointer"></td>
            <td width="114" height="24" bgcolor="#F4F4F4"><span class="Estilo47"><?php echo $rowRef['fecha'] ?></span></td>
            <td width="44" bgcolor="#F4F4F4"><span class="Estilo47"><?php echo $rowRef['serie'] ?></span></td>
            <td width="50" bgcolor="#F4F4F4"><span class="Estilo47"><?php echo $rowRef['Num_doc'] ?></span></td>
            <td width="297" bgcolor="#F4F4F4"><span class="Estilo47"><?php
			list($nombreClie)=mysql_fetch_row(mysql_query("SELECT razonsocial FROM cliente WHERE codcliente = '".$rowRef['cliente']."'"));
			 echo $nombreClie;
			 ?></span></td>
            <td width="147" bgcolor="#F4F4F4"><span class="Estilo47"><?php
			list($nombreUsu)=mysql_fetch_row(mysql_query("SELECT usuario FROM usuarios WHERE codigo = '".$rowRef['cod_vendedor']."'"));
			 			echo $nombreUsu; 
			 ?></span></td>
            <td width="123" bgcolor="#F4F4F4"><span class="Estilo47"><?php echo $rowRef['tienda'] ?></span></td>
          </tr>
		  
		  <?php } }?>
		  
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <br>
    
	
	
    </fieldset></td>
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

var Datos2=window.open("../doc_det.php?referencia="+codigo,"PO","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=720, height=520,left=200 top=150");
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
				
				
			}else{
				e.keyCode=0;
				event.returnValue=false;
				return false;
			}
		}
	}catch(e){
	
	}	

}

function doc_det(valor){

window.open("../doc_det2.php?referencia="+valor,"","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=320,left=300 top=250");

}

</script>