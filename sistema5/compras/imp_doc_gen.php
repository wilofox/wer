<?php 
session_start();
include('../conex_inicial.php');

$numero=$_REQUEST['numero'];
$serie=$_REQUEST['serie'];
$doc=$_REQUEST['doc'];
$sucursal=$_REQUEST['sucursal'];
$almacen=$_REQUEST['almacen'];
$auxiliar=$_REQUEST['auxiliar'];

$strSQL="select * from cab_mov where Num_doc='$numero' and serie='$serie' and cod_ope='$doc' and sucursal='$sucursal' and tienda='$almacen' and cliente='$auxiliar' ";
//echo $strSQL;
$resultado=mysql_query($strSQL,$cn);
$row=mysql_fetch_array($resultado);


$fecha=$row['fecha'];
$id=$row['cod_cab'];
$incluidoigv=$row['incluidoigv'];


$strSQL2="select * from cliente where codcliente='$auxiliar' ";
$resultado2=mysql_query($strSQL2,$cn);
$row2=mysql_fetch_array($resultado2);
$razonsocial=$row2['razonsocial'];
$ruc=$row2['ruc'];
$direccion=$row2['direccion'];

//echo $incluidoigv;
$condicion="Contado";
$vendedor=$_REQUEST['responsable'];


?>

<script LANGUAGE="JavaScript"> 
function printer() 
{ 
vbPrintPage() 
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

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>
</head>
<!-- onLoad="printer();" -->
<body onLoad="printer();">

<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT> 


<table width="840" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="16" height="37">&nbsp;</td>
    <td width="773">&nbsp;</td>
    <td width="29">&nbsp;</td>
  </tr>
  <tr>
    <td height="82">&nbsp;</td>
    <td><table width="791" height="275" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="791" height="80"><table width="538" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="143">&nbsp;</td>
            <td colspan="3" class="Estilo1"><?php echo $fecha;?></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="3" class="Estilo1"><?php echo $razonsocial?></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="3" class="Estilo1"><?php echo $direccion?></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td width="181" class="Estilo1"><?php echo $ruc ?></td>
            <td width="62" class="Estilo1">&nbsp;</td>
            <td width="152" class="Estilo1"><span class="Estilo1"></span></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="42">&nbsp;</td>
      </tr>
      <tr>
        <td height="134" valign="top">
		
		<table width="768" border="0" cellpadding="0" cellspacing="0">
         <?php 
		 
		 $strSQL3="select * from det_mov where cod_cab='$id' ";
		$resultado3=mysql_query($strSQL3,$cn);
		while($row3=mysql_fetch_array($resultado3)){;
		
		
		if($incluidoigv=='S'){
		$punitario=$row3['precio']/1.19;
		$cantidad=$row3['cantidad'];
		$valor_venta=$punitario * $cantidad;
		
		$igv= ($row3['precio']*$cantidad)-$valor_venta;
		$total_item=$valor_venta+$igv;		
		
		}else{
		
		}
	     
		 $tot_punitario=$tot_punitario+$punitario;
		 $tot_valor_venta=$tot_valor_venta+$valor_venta;
		 $tot_igv=$tot_igv+$igv;
		 $tot_total_item=$tot_total_item+$total_item;
		 	     
		 ?>
		 
		  <tr>
            <td width="68" align="center" class="Estilo1"><?php echo $row3['cod_prod']?></td>
		<td width="60" align="center" class="Estilo1"><?php echo $cantidad ; ?></td>
            <td width="70" class="Estilo1">&nbsp;</td>
            <td width="343" class="Estilo1"><?php echo $row3['nom_prod']?> </td>
            <td width="63" align="right" class="Estilo1"><?php echo number_format($punitario,2)?></td>
            <td width="60" align="right" class="Estilo1"><?php echo number_format($valor_venta,2)?></td>
            <td width="59" align="right" class="Estilo1"><?php echo number_format($igv,2)?></td>
            <td width="63" align="right" class="Estilo1"><?php echo number_format($total_item,2)?></td>
          </tr>
		  <?php 
		  
		  }
		  
		  ?>
        </table></td>
      </tr>
      <tr>
        <td height="19"  valign="top"><table width="769" border="0" cellpadding="0" cellspacing="0">
         
          <tr>
            <td width="68" align="center">&nbsp;</td>
            <td width="60" align="center">&nbsp;</td>
            <td width="70">&nbsp;</td>
            <td width="343">&nbsp;</td>
            <td width="63" align="right" class="Estilo1"><?php echo number_format($tot_punitario,2)?></td>
            <td width="60" align="right" class="Estilo1"><?php echo number_format($tot_valor_venta,2)?></td>
            <td width="59" align="right" class="Estilo1"><?php echo number_format($tot_igv,2)?></td>
            <td width="63" align="right" class="Estilo1"><?php echo number_format($tot_total_item,2)?></td>
          </tr>
        
        </table></td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
