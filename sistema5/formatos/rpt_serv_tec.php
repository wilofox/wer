<?php 
session_start();
include ('../conex_inicial.php'); 
include('../numero_letras.php');


$codigo=$_REQUEST['cod'];



$strSQL= "select * from cab_mov where cod_cab='".$codigo."' " ;

$resultado = mysql_query ($strSQL,$cn);
$row = mysql_fetch_array ($resultado);

$empresa =  $row['sucursal'];
$doc=  $row['cod_ope'];
$serie =  $row['serie'];
$numero =  $row['Num_doc'];
$observacion=	$row['obs1'];
$descrip=	$row['obs2'];


//$codigo= $row['cod_cab'];
$nom_aux1 = $row['cliente']; 
$moneda1 =  $row['moneda']; 
$obs1 = $row['obs1']; 
$obs2 = $row['obs2']; 
$obs3 = $row['obs3']; 
$obs4 = $row['obs4']; 
$obs5 = $row['obs5']; 
$tienda=$row['tienda']; 

$fecha_emision1 = substr ($row['fecha'],0,10); 
$f = explode("-",$fecha_emision1) ;

$dia_fech = $f[2];
$mes_fech = $f[1];
$año_fech = substr ($f[0],2,4);


$nom_aux3 = $row['cod_vendedor']; 
$nom_aux4 = $row['condicion']; 
$m_total = $row['total']; 
 
$m_bruto  = $row['b_imp']; 
$igv = $row['igv']; 

$strSQL1= "select * from referencia where cod_cab = '".$codigo."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$num_ref_ser = $row['serie']; 
$num_ref_corr = $row['correlativo']; 
$cod_cab_ref1 = $row['cod_cab_ref']; 

$strSQL3= "select * from cab_mov where cod_cab= '".$cod_cab_ref1."' " ;

$resultado3 = mysql_query ($strSQL3,$cn);
$row = mysql_fetch_array ($resultado3);
$tip_docu_ref = $row['cod_ope']; 

$strSQL1= "select * from cliente where codcliente = '".$nom_aux1."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$nom_aux = $row['razonsocial']; 
$direc_aux =  $row['direccion']; 
$dni_aux = $row['doc_iden']; 
$ruc_aux = $row['ruc']; 
$mail_aux = $row['email'];
$tel_aux = $row['telefono'];

$strSQL1= "select * from sucursal where cod_suc= '".$empresa."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$emp_nom = $row['des_suc']; 
$emp_ruc = $row['ruc']; 

$strSQL1= "select * from usuarios where codigo= '".$nom_aux3."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$responsable = $row['usuario']; 

$strSQL1= "select * from condicion where codigo= '".$nom_aux4."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$condicion = $row['nombre']; 

$strSQL1= "select * from det_mov where cod_cab= '".$codigo."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$cant= $row['cantidad']; 
$P =  $row['cod_prod'];
$descripcion =  $row['nom_prod'];
$p_unit = $row['precio'];
$nota = substr($row['notas'],0,15);

$strSQL1= "select * from producto where idproducto= '".$P."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$u = $row['und']; 

$strSQL2= "select * from unidades where id = '".$u."' " ;
$resultado1 = mysql_query ($strSQL2,$cn);
$row = mysql_fetch_array ($resultado1);
$unid= $row['nombre'];

//if ($moneda1 = '01')
///($moneda = 'S/' );
//else	
//($moneda = 'US$');	

switch($moneda1)
{
case "01":
$moneda = "S/.";
break;

case "02":
$moneda = "US$";
break;
}
switch($moneda1)
{
case "01":
$monedalet = "NUEVOS SOLES";
break;

case "02":
$monedalet = "DOLARES AMERICANOS";
break;
}



switch($mes_fech)
 {
 
  	case "01":
    $mes_letra = "Enero";
	break;
	
	case "02":
    $mes_letra = "Febrero";
	break;
	
	case "03":
    $mes_letra = "Marzo";
	break;
	
	case "04":
    $mes_letra = "Abril";
	break;
	
	case "05":
    $mes_letra = "Mayo";
	break;
	
	case "06":
    $mes_letra = "Junio";
	break;
	
	case "07":
    $mes_letra = "Julio";
	break;
	
	case "08":
    $mes_letra = "Agosto";
	break;
	
	case "09":
    $mes_letra = "Setiembre";
	break;
	
	case "10":
    $mes_letra = "Octubre";
	break;
	
	case "11":
    $mes_letra = "Noviembre";
	break;
	
	case "12":
	$mes_letra = "Diciembre";
	break;
}
$des_serie="Select * from det_mov where cod_cab='".$codigo."' and substr(nom_prod,1,3)='S/N'";
switch($doc){
	case "R1":$des_doc="Guia de ingreso - ";$des_serie="Select * from series where ingreso='".$codigo."'";break;
	case "R2":$des_doc="Guia de salida - ";$des_serie="Select * from series where salida='".$codigo."'";break;
	case "S1":$des_doc="Guia de ingreso - ";break;
	case "S2":$des_doc="Guia de salida - ";break;
}

$strSQL_doc= "select * from operacion where codigo = '".$doc."' " ;
$resultado_doc = mysql_query ($strSQL_doc,$cn);
$row_doc = mysql_fetch_array ($resultado_doc);
$cola=$row_doc['cola'];
$des_doc.=$row_doc['descripcion'];

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo3 {font-size: 14px; font:Arial, Helvetica, sans-serif}
.Estilo7 {font-size: 14px; font:Arial, Helvetica, sans-serif}
.Estilo8 {font-size: 11px}
.Estilo9 {font: Arial, Helvetica, sans-serif}
.Estilo210{font-size:18px; font:bold}
.Estilo211{font-size:14px; font:bold}
-->
</style>

<style media="print">
.noprint     { display: none }
</style>

</head>


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

<script type="text/javascript" src="../javascript/colaimp.js"></script>

<script language="javascript">

timer=setInterval("terminar()",3000);

var pc="<?php echo $_SESSION['pc_ingreso'] ?>";
var cola="<?php echo $cola?>";

function printer() 
{ 
vbPrintPage(); 
return false; 
} 

function defrente(){
window.focus();

	if(pc=="localhost"){
	viewinit1();
	Print(false, top);
	}else{
	printer();
	}
	
}

function terminar(){
	window.parent.opener.Cerrar();
	self.close();
}

</script>


<body onLoad="defrente()" >

<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>


<?php if($_SESSION['pc_ingreso']=='localhost'){ ?>

<object id= "secmgr" style= "display:none" viewastext classid="clsid:5445BE81-B796-11D2-B931-002018654E2E" codebase="http://www.prolyam.com/restaurante/javascript/smsx.cab#Version=6.5.439.37">
<param name="GUID" value="{0ADB2135-6917-470B-B615-330DB4AE3701}">
<param name="Path" value="http://www.meadroid.com/scriptx/sxlic.mlf">
<param name="Revision" value="0">
<param name="PerUser" value="true">
</object>

<object id= "factory" style= "display:none" viewastext classid="clsid:1663ED61-23EB-11D2-B92F-008048FDD814" codebase="http://codestore.meadroid.com/products/scriptx/binary.ashx?version=6,5,439,50&filename=smsx.cab&x2ref=http://www.meadroid.com/scriptx/docs/samples/basic.asp#Version=6,5,439,50">
</object>
<?php }?>

<div id="installFailure" >
	
</div>

<div id="installOK">

<table width="777" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td height="20" align="left" valign="center" class="Estilo210">&nbsp;</td>
    <td colspan="3" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td width="603" height="55" align="center" valign="middle" class="Estilo210"><span class="Estilo3">FECHA :&nbsp;<span class="Estilo7"><?php echo $dia_fech ?>/<?php echo $mes_fech?>/20<?php echo $año_fech ?></span></span><br><?php echo $des_doc ?></td>
    <td width="175" colspan="3" align="center" valign="middle"><table style="display:none" width="94%" height ="82" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2"><div align="left">R.U.C. N&ordf; <?php echo $emp_ruc;?> </div></td>
      </tr>
      <tr>
        <td colspan="2"><div align="left"><?php echo $des_doc; ?></div></td>
      </tr>
    </table>
      <span class="Estilo7"><?php echo $doc ?> / <?php echo $serie ?>-</span><span class="Estilo7"><?php echo $numero ?></span></td>
  </tr>
  <tr>
    <td height="75" colspan="4" align="left" valign="top"><table width="773" height="79" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="21" colspan="3" ><span class="Estilo210">DATOS DEL CLIENTE : </span></td>
        <td width="94" align="right" ><span class="Estilo3"><span class="Estilo7"> </span></span></td>
        <td width="121" >&nbsp;</td>
        <td colspan="2" >&nbsp;</td>
        <td >&nbsp;</td>
      </tr>
      <tr>
        <td width="118" height="18"><span class="Estilo211">NOMBRE : </span></td>
        <td width="139"><span class="Estilo7"><?php echo strtoupper($nom_aux) ?></span></td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
        <td><span class="Estilo211">E-MAIL :</span></td>
        <td><span class="Estilo7"><?php echo $mail_aux ?></span></td>
        <td height="18">&nbsp;</td>
        <td colspan="5">&nbsp;</td>
        <td width="36" valign="middle">&nbsp;</td>
      </tr>
      <tr style="display:none">
        <td height="20"><span style="visibility:hidden" class="Estilo211">DNI :</span></td>
        <td height="20"><span style="visibility:hidden" class="Estilo7"><?php echo $dni_aux ?></span></td>
        <td colspan="2">&nbsp;</td>
        <td><span class="Estilo8"><span style="visibility:hidden" class="Estilo7"><?php echo $tip_docu_ref ?>/</span>&nbsp; <span style="visibility:hidden" class="Estilo7"><?php echo $num_ref_ser ?>-<?php echo $num_ref_corr?></span></span></td>
        <td width="84" >&nbsp;</td>
        <td width="100" >&nbsp;</td>
        <td width="63" valign="middle">&nbsp;</td>
      </tr>
      <tr>
        <td height="19" align="left" class="Estilo211">DIRECCI&Oacute;N:</td>
        <td height="19" align="left"><span class="Estilo7"><?php echo strtoupper($direc_aux) ?></span></td>
        <td height="19" colspan="3" align="left"><span class="Estilo211">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
        <td ><span class="Estilo211">TEL&Eacute;FONO :</span></td>
        <td ><span class="Estilo7"><?php echo $tel_aux?>&nbsp;</span></td>
        <td valign="middle">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
  	<?php 
		$sql_det="Select * from det_mov where cod_cab='".$codigo."' order by cod_det";
		$rs_det=mysql_query($sql_det,$cn);
		$row_det=mysql_fetch_array($rs_det);
		
		$sql_dprod="Select * from producto where idproducto='".$row_det['cod_prod']."'";
		$rs_dprod=mysql_query($sql_dprod,$cn);
		$row_dprod=mysql_fetch_array($rs_dprod);
		
	?>
    <td height="244" colspan="4" align="left" valign="top"><table width="761"  border="0" align="center" cellpadding="0" cellspacing="0"><?php /////////Test
	//echo $sql_det;?>
    <tr>
      <td height="41" colspan="8" valign="bottom" ><span class="Estilo210">DATOS DEL PRODUCTO : </span><span class="Estilo3"><span class="Estilo7"> &nbsp;</span></span><span class="Estilo3"><span class="Estilo7">&nbsp; </span></span><span class="Estilo3">&nbsp;<span class="Estilo7"> </span></span><span class="Estilo3"><span class="Estilo7"> </span></span></td>
    </tr>
      <tr>
        <td width="128" height="18"><span class="Estilo211">PRODUCTO : </span></td>
        <td width="400"><span class="Estilo7"><?php echo strtoupper($row_dprod['nombre']) ?></span></td>
        <td colspan="2">&nbsp;</td>
        <td width="66">&nbsp;</td>
        <td><span class="Estilo211"></span></td>
        <td><span class="Estilo7"></span></td>
        <td height="18">&nbsp;</td>
        <td colspan="5">&nbsp;</td>
        <td width="36" valign="middle">&nbsp;</td>
      </tr>
      <tr style="display:none">
        <td height="20"><span style="visibility:hidden" class="Estilo211">DNI :</span></td>
        <td height="20"><span style="visibility:hidden" class="Estilo7"><?php echo $dni_aux ?></span></td>
        <td colspan="2">&nbsp;</td>
        <td><span class="Estilo8"><span style="visibility:hidden" class="Estilo7"><?php echo $tip_docu_ref ?>/</span>&nbsp; <span style="visibility:hidden" class="Estilo7"><?php echo $num_ref_ser ?>-<?php echo $num_ref_corr?></span></span></td>
        <td width="84" >&nbsp;</td>
        <td width="100" >&nbsp;</td>
        <td width="63" valign="middle">&nbsp;</td>
      </tr>
      <tr>
        <td height="19" align="left" class="Estilo211">SERIE N°:</td>
        <?php 
		//echo $des_serie;
		$det_serie=mysql_query($des_serie,$cn);
		$row_det_serie=mysql_fetch_array($det_serie);
		if($row_det_serie['id']==""){
			$des_serie="Select * from det_mov where cod_cab='".$codigo."' and substr(nom_prod,1,3)='S/N'";
			$det_serie=mysql_query($des_serie,$cn);
			$row_det_serie=mysql_fetch_array($det_serie);
		?>
        <td height="19" align="left"><span class="Estilo7"><?php echo strtoupper(substr($row_det_serie['nom_prod'],3)) ?></span></td>
        <?php 
		}else{
		?>
        <td width="104" height="19" align="left"><span class="Estilo7"><?php echo strtoupper($row_det_serie['serie']) ?></span></td>
        <?php 
		}
		?>
      </tr>
      <tr>
        <td height="64" align="left" class="Estilo211">DESCRIPCI&Oacute;N:</td>
        <td height="64" align="left"><span class="Estilo7"><?php echo strtoupper($descrip) ?></span></td>
      </tr>
      <tr>
        <td height="55" align="left" class="Estilo211">OBSERVACIONES:</td>
        <td height="55" align="left"><span class="Estilo7"><?php echo strtoupper($observacion) ?></span></td>
      </tr>
      <tr>
        <td  height="19" colspan="5" align="center">&nbsp;</td>
        </tr>
	  <tr>
        <td height="19" colspan="7">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  
   <tr>
    <td  height="16" colspan="4" valign="bottom" class="Estilo7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
   
  
  
  
  <tr>
    <td  height="20" colspan="4"><table width="778" height="67" border="0" cellpadding="0" cellspacing="0">
    <?php 
	if(number_format($m_total,2)==0.00){
	?>
    	<tr>
          <td width="125">&nbsp;</td>
          <td width="29">&nbsp;</td>
          <td width="139">&nbsp;</td>
          <td width="94" rowspan="4">&nbsp;</td>
          <td width="332" rowspan="4" align="right" valign="middle">&nbsp;</td>
          <td width="63" rowspan="4" align="center" valign="middle">&nbsp;</td>
        </tr>
        <tr>
          <td width="125">&nbsp;</td>
          <td width="29">&nbsp;</td>
          <td width="139">&nbsp;</td>
          <td width="29">&nbsp;</td>
          <td width="139">&nbsp;</td>
        </tr>
        <tr>
          <td width="125">&nbsp;</td>
          <td width="29">&nbsp;</td>
          <td width="139">&nbsp;</td>
          <td width="29">&nbsp;</td>
          <td width="139">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="29">&nbsp;</td>
          <td width="139">&nbsp;</td>
        </tr>
    <?php
	}else{
	?>
        <tr>
          <td width="125"><span class="Estilo211">Costo Total:</span></td>
          <td width="29"><span class="Estilo7"><?php echo $moneda; ?></span></td>
          <td width="139"><span class="Estilo7"><?php echo number_format($m_total,2) ?></span></td>
          <td width="94" rowspan="4">&nbsp;</td>
          <td width="332" rowspan="4" align="right" valign="middle">&nbsp;</td>
          <td width="63" rowspan="4" align="center" valign="middle">&nbsp;</td>
        </tr>
        <?php
		$sql_pa="Select * from pagos where tipo='A' and referencia=$codigo";
		$rs_pa=mysql_query($sql_pa,$cn);
		$rs_pa2=mysql_query($sql_pa,$cn);
		$row_pa=mysql_fetch_array($rs_pa);
		if($row_pa['vuelto']>0){
			$pago=number_format($m_total,2);
			$saldo=number_format("0",2);
		}else{
			$pago=0;
			while($row_cta=mysql_fetch_array($rs_pa2)){
				$monto=number_format($row_cta['monto'],2);
				if($moneda=="US$" && $row_cta['01']){
					$monto=number_format($row_cta['monto']/$row_cta['tcambio'],2);
				}
				if($moneda=="S/." && $row_cta['02']){
					$monto=number_format($row_cta['monto']*$row_cta['tcambio'],2);
				}
				$pago=$monto+$pago;
			}
			$saldo=number_format($m_total-$pago,2);
		}
		?>
        <tr>
          <td width="125"><span class="Estilo211">Pago a Cuenta:</span></td>
          <td width="29"><span class="Estilo7"><?php echo $moneda; ?></span></td>
          <td width="139"><span class="Estilo7"><?php echo number_format($pago,2); ?></span></td>
          <td width="29">&nbsp;</td>
          <td width="139">&nbsp;</td>
        </tr>
        <tr>
          <td width="125"><span class="Estilo211">Saldo:</span></td>
          <td width="29"><span class="Estilo7"><?php echo $moneda; ?></span></td>
          <td width="139"><span class="Estilo7"><?php echo $saldo ?></span></td>
          <td width="29">&nbsp;</td>
          <td width="139">&nbsp;</td>
        </tr>
        <?php 
	}
	?>
        <tr>
          <td>&nbsp;</td>
          <td width="29">&nbsp;</td>
          <td width="139">&nbsp;</td>
        </tr>
        
      <tr>
        <td height="19"><span class="Estilo211">Atendido por:</span></td>
        <td height="19" colspan="2"><span class="Estilo211"><span class="Estilo7"><?php echo strtoupper($responsable) ?></span></span></td>
        <td height="19"><span class="Estilo211">V B  Cliente:</span></td>
        <td height="19">&nbsp;</td>
        <td height="19">&nbsp;</td>
        <td width="4" height="19">&nbsp;</td>
        <td width="4" height="19">&nbsp;</td>
        <td width="4" height="19">&nbsp;</td>
        <td width="4" height="19">&nbsp;</td>
      </tr></table></td>
  </tr>
</table>

	<div id=idControls class="noprint">
	 <div id="idBtn">
     </div>
	</div>


</div>

</body>
</html>
