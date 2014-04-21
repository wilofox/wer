<?php
session_start();
include('../conex_inicial.php');
include("../funciones/funciones.php");

$serie=$_REQUEST['serie'];
$numero=$_REQUEST['numero'];
$doc=$_REQUEST['doc'];
$tienda=$_REQUEST['tienda'];
$tienda2=$_REQUEST['tienda2'];

$strSQL1="select * from cab_mov where serie='".$serie."' and Num_doc='".$numero."' and cod_ope='".$doc."' order by tipo ";
$resultado1=mysql_query($strSQL1,$cn);
while($row1=mysql_fetch_array($resultado1)){

	if($row1['tipo']==1){
	$cod_cab_destino=$row1['cod_cab'];
	$sucursal2=$row1['sucursal'];
	}else{
	$cod_cab_origen=$row1['cod_cab'];
	$sucursal1=$row1['sucursal'];
	}
	
	$cod_responsable=$row1['cod_vendedor'];
	$fecha_doc=$row1['fecha'];
}



$strSQL2= "select * from usuarios where codigo= '".$cod_responsable."' " ;
$resultado2 = mysql_query ($strSQL2,$cn);
$row2 = mysql_fetch_array ($resultado2);
$responsable = $row2['usuario']; 

$strSQL3= "select * from tienda where cod_tienda= '".$tienda."' " ;
$resultado3 = mysql_query ($strSQL3,$cn);
$row3 = mysql_fetch_array ($resultado3);
$des_tienda1=$row3['des_tienda'];
$dir_tienda1=$row3['direccion'];

$strSQL3= "select * from tienda where cod_tienda= '".$tienda2."' " ;
$resultado3 = mysql_query ($strSQL3,$cn);
$row3 = mysql_fetch_array ($resultado3);
$des_tienda2=$row3['des_tienda'];
$dir_tienda2=$row3['direccion'];

$strSQL3= "select * from sucursal where cod_suc= '".$sucursal1."' " ;
$resultado3 = mysql_query ($strSQL3,$cn);
$row3 = mysql_fetch_array ($resultado3);
$des_sucursal1=$row3['des_suc'];

$strSQL3= "select * from sucursal where cod_suc= '".$sucursal2."' " ;
$resultado3 = mysql_query ($strSQL3,$cn);
$row3 = mysql_fetch_array ($resultado3);
$des_sucursal2=$row3['des_suc'];



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
-->
</style>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>
<style type="text/css">
<!--
.Estilo2 {font-size: 14px}
-->
</style>
<style type="text/css">
<!--
.Estilo3 {font-size: 16px}
-->
</style>
<style type="text/css">
<!--
.Estilo4 {font-size: 16}
-->
</style>
<style type="text/css">
<!--
.Estilo5 {font-size: 12px}
-->
</style>
<style type="text/css">
<!--
.Estilo6 {font-size: 13px}
-->
</style>
</head>

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

<script type="text/javascript" src="javascript/colaimp.js"></script>

<script language="javascript">

var pc="<?php echo $_SESSION['pc_ingreso'] ?>";
var cola="<?php echo $cola?>";

function printer() 
{ 
//alert();
vbPrintPage(); 
return false; 
} 

function defrente(){
//window.focus();

	if(pc=="localhoste"){
	viewinit1();
	Print(false, top);
	}else{
	printer();
	}
	
}


</script>

<body onLoad="defrente()">

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

<table width="823" height="345" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="8" height="192">&nbsp;</td>
    <td width="811" align="center"><p>&nbsp;</p>
      <p><br>
        </p>
      <table width="772" height="195" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="30" colspan="2" align="center">TRANSFERENCIA </td>
		  <td height="30" colspan="2" align="center">TRANSFERENCIA </td>
        </tr>
        <tr>
          <td height="23" colspan="2" align="center">TS <?php echo $serie."-".$numero ?></td>
		  <td height="23" colspan="2" align="center">TS <?php echo $serie."-".$numero ?>        </tr>
        <tr>
          <td height="23" colspan="2" align="center">Fecha: <?php echo date('d-m-Y H:i:s'); ?></td>
		  <td height="23" colspan="2" align="center">Fecha: <?php echo date('d-m-Y H:i:s'); ?>        </tr>
        <tr>
          <td height="23" colspan="2" align="center"><strong>ORIGEN</strong></td>
		  <td height="23" colspan="2" align="center"><strong>DESTINO</strong></td>
        </tr>
        <tr>
          <td width="115">SUCURSAL</td>
          <td width="253"><?php echo strtoupper($des_sucursal1) ?></td>
		  <td width="140">SUCURSAL</td>
          <td width="264"><?php echo strtoupper($des_sucursal1) ?></td>
        </tr>
        <tr>
          <td>Alm. Origen </td>
          <td><?php echo $des_tienda1?></td>
		  <td>Alm. Destino </td>
          <td><?php echo $des_tienda2?></td>
        </tr>
        <tr>
          <td>Alm. Destino </td>
          <td><?php echo $des_tienda2?></td>
		  <td>Alm. Origen </td>
          <td><?php echo $des_tienda1?></td>
        </tr>
        <tr>
          <td>Direccion</td>
          <td><?php echo $dir_tienda1?></td>
          <td>Direccion</td>
          <td><?php echo $dir_tienda2?></td>
          </tr>
        <tr>
          <td>Responsable</td>
          <td><?php echo $responsable?></td>
          <td>Responsable</td>
          <td><?php echo $responsable?></td>
          </tr>
      </table></td>
    <td width="10">&nbsp;</td>
  </tr>
  <tr>
    <td height="88">&nbsp;</td>
    <td align="center"><table width="769" height="56" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" valign="bottom" style= "border-top:#000000 solid 1px; border-bottom:#000000 solid 1px"><span class="Estilo1 Estilo2 Estilo3 Estilo4 Estilo2 Estilo2 Estilo2 Estilo2 Estilo2 Estilo2 Estilo5 Estilo5 Estilo5 Estilo6 Estilo6">It</span></td>
        <td style= "border-top:#000000 solid 1px; border-bottom:#000000 solid 1px" valign="bottom"><span class="Estilo1 Estilo6 Estilo6">Cant.</span></td>
        <td  style= "border-top:#000000 solid 1px; border-bottom:#000000 solid 1px" valign="bottom"><span class="Estilo1 Estilo6 Estilo6">Producto</span></td>
		<td width="59" align="center" valign="bottom" style= "border-left:#000000 solid 1px; border-top:#000000 solid 1px; border-bottom:#000000 solid 1px"><span class="Estilo1 Estilo6 Estilo6">It.</span></td>
        <td width="44" style= "border-top:#000000 solid 1px; border-bottom:#000000 solid 1px" valign="bottom"><span class="Estilo1 Estilo6 Estilo6">Cant.</span></td>
        <td width="278" style= "border-top:#000000 solid 1px; border-bottom:#000000 solid 1px"valign="bottom"><span class="Estilo1 Estilo6 Estilo6">Producto</span></td>
      </tr>
	  <?php 
	  $i=0;
	  $strSQL3= "select * from det_mov where cod_cab= '".$cod_cab_destino."' " ;
	  $resultado3 = mysql_query ($strSQL3,$cn);
	  while($row3 = mysql_fetch_array ($resultado3)){
	    $i++;
		
		  $strSQL4= "select * from series where ingreso='".$cod_cab_destino."' and producto='".$row3['cod_prod']."' " ;
		  $resultado4 = mysql_query ($strSQL4,$cn);
		  //echo $strSQL4;
		  $series="";
		  while($row4 = mysql_fetch_array ($resultado4)){
		  $series=$series.$row4['serie'].", ";
		  }
	  ?>
      <tr>
        <td width="34" align="center" valign="top"><?php echo $i?></td>
        <td width="48" align="center" valign="top"><?php echo $row3['cantidad']; ?></td>
        <td width="268"><?php echo $row3['nom_prod'];?><br><?php echo $series?></td>
		<td width="59" align="center" valign="top"><?php echo $i?></td>
        <td width="44" align="center" valign="top"><?php echo $row3['cantidad']; ?></td>
        <td width="278"><?php echo $row3['nom_prod'];?><br>
          <?php echo $series?></td>
      </tr>
	  
	  <?php 
	  }
	  ?>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table width="811" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="388" height="75" align="center"><br><br><br>
          <strong>.....................................................</strong></td>
        <td width="423" align="center"><br><br><br>
          <strong>.....................................................</strong></td>
      </tr>
      <tr>
        <td align="center">CONFORME SALIDA </td>
        <td align="center">CONFORME INGRESO</td>
        </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
</table>

	<div id=idControls class="noprint">
		 <div id="idBtn">
		 </div>
  </div>
	
	
</div>

</body>
</html>
