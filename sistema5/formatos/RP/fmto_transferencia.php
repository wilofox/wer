<?php
session_start();
include('../../conex_inicial.php');
include("../../funciones/funciones.php");

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

$strSQL3= "select * from tienda where cod_tienda= '".$tienda2."' " ;
$resultado3 = mysql_query ($strSQL3,$cn);
$row3 = mysql_fetch_array ($resultado3);
$des_tienda2=$row3['des_tienda'];

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
</style></head>

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

<table width="797" height="288" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10" height="137">&nbsp;</td>
    <td width="754"><table width="747" border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" colspan="2" align="center">TRANSFERENCIA DE STOCKS </td>
        </tr>
      <tr>
        <td height="23" colspan="2" align="center">TS <?php echo $serie."-".$numero ?></td>
      </tr>
      <tr>
        <td width="357">Origen :<?php echo $des_tienda1?></td>
        <td width="374">Destino :<?php echo $des_tienda2?></td>
      </tr>
      <tr>
        <td>Sucursal : <?php echo $des_sucursal1 ?></td>
        <td>Sucursal : <?php echo $des_sucursal2 ?></td>
      </tr>
      <tr>
        <td>Fecha :<?php echo $fecha_doc ?></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td width="11">&nbsp;</td>
  </tr>
  <tr>
    <td height="86">&nbsp;</td>
    <td><table width="748" border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td width="42" align="center">Item</td>
        <td width="95" align="center">Cantidad</td>
        <td width="84" align="center">Codigo</td>
        <td width="504">Producto</td>
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
        <td align="center" valign="top"><?php echo $i?></td>
        <td align="center" valign="top"><?php echo $row3['cantidad']; ?></td>
        <td align="center" valign="top"><?php echo $row3['cod_prod'];?></td>
        <td><?php echo $row3['nom_prod'];?><br><?php echo $series?></td>
      </tr>
	  
	  <?php 
	  }
	  ?>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table width="750" border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td width="100">Vsito Bueno </td>
        <td colspan="2">.........................................................................</td>
      </tr>
      <tr>
        <td>Responsable</td>
        <td width="292"><?php echo $responsable?></td>
        <td width="336">Recibido:.................................................................</td>
      </tr>
      <tr>
        <td>Fecha </td>
        <td colspan="2"><?php echo date('d-m-Y H:i:s'); ?></td>
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
