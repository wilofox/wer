<?php 
include ('../../conex_inicial.php'); 
include('../../numero_letras.php');


$empresa =  $_REQUEST['empresa'];
$doc=  $_REQUEST['doc'];
$serie =  $_REQUEST['serie'];
$numero =  $_REQUEST['numero'];



$strSQL= "select * from cab_mov where sucursal='$empresa ' and cod_ope='$doc'  and serie='$serie' and Num_doc='$numero' " ;


//echo $strSQL;

$resultado = mysql_query ($strSQL,$cn);
$row = mysql_fetch_array ($resultado);

$codigo= $row['cod_cab'];
$nom_aux1 = $row ['cliente']; 
$moneda1 =  $row ['moneda']; 
$obs1 = $row ['obs1']; 
$obs2 = $row ['obs2']; 
$obs3 = $row ['obs3']; 
$obs4 = $row ['obs4']; 
$obs5 = $row ['obs5']; 

$fecha_emision1 = substr ($row ['fecha'],0,10); 
$f = explode("-",$fecha_emision1) ;
$f1 = $f[2]."-".$f[1]."-".$f[0];
$fecha_emision = $f1;

$nom_aux3 = $row ['cod_vendedor']; 
$nom_aux4 = $row ['condicion']; 

$m_bruto  = number_format ($row ['b_imp'],2); 
$igv = number_format ($row ['igv'],2); 
 

$strSQL1= "select * from cliente where codcliente = '".$nom_aux1."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$nom_aux = $row ['razonsocial']; 
$direc_aux =  $row ['direccion']; 
$dni_aux = $row ['doc_iden']; 
$ruc_aux = $row ['ruc']; 



$strSQL1= "select * from usuarios where codigo= '".$nom_aux3."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$responsable = $row ['usuario']; 

$strSQL1= "select * from condicion where codigo= '".$nom_aux4."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$condicion = $row ['nombre']; 

$strSQL1= "select * from det_mov where cod_cab= '".$codigo."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$cant= $row ['cantidad']; 
$P =  $row ['cod_prod'];
$descripcion =  $row ['nom_prod'];
$p_unit = number_format ($row ['precio'],2);
$nota = substr($row ['notas'],0,15);

$strSQL1= "select * from producto where idproducto= '".$P."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$u = $row ['und']; 

$strSQL2= "select * from unidades where id = '".$u."' " ;
$resultado1 = mysql_query ($strSQL2,$cn);
$row = mysql_fetch_array ($resultado1);
$unid= $row ['nombre'];

if ($moneda1 = "01")
($moneda = "S/" );

else
($moneda = "US$");

$p_tot = number_format ($cant * $p_unit,2);

$val_fact = number_format($m_bruto - $val_descu,2);

$m_total = number_format($val_fact + $igv,2) ;
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
.Estilo1 {font-size: 9px}
-->
</style></head>


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


<body onLoad="printer()"> 



<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>

<table width="750" height="911" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="652" height="35">&nbsp;</td>
    <td width="97" colspan="3" valign="bottom"><table style="display:none" width="94%" height="82" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2"><div style="visibility:hidden"  align="left">R.U.C. N&ordf; 20528334181 </div></td>
      </tr>
      <tr>
        <td colspan="2"><div style="visibility:hidden"  align="left">BOLETA DE VENTA </div></td>
      </tr>
      <tr>
        <td width="31%"><div style="visibility:hidden"  align="left">N&quot; 001 - </div></td>
        <td width="69%"><div style="visibility:hidden"  align="left"></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="95" colspan="4" align="left"><table width="750" height="73" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="107" ><span class="Estilo7" style="visibility:hidden">FECHA :</span></td>
        <td width="271" ><span class="Estilo7" style="visibility:hidden">s&ordm;</span></td>
        <td colspan="5">&nbsp;</td>
        </tr>
      <tr>
        <td height="18" colspan="2" align="center"><span style="visibility:hidden" class="Estilo8">punto de partida   : </span><span class="Estilo7">&nbsp;</span></td>
        <td colspan="5"><span class="Estilo8" style="visibility:hidden"><span style="visibility:hidden" class="Estilo8">IRECCION :</span><span class="Estilo7"><?php echo strtoupper($direc_aux) ?></span></span></td>
      </tr>
      <tr>
        <td height="18" colspan="2" align="center" class="Estilo8" style="visibility:hidden" span>&nbsp;</td>
        <td colspan="5"><span style="visibility:hidden" class="Estilo8"> :<span class="Estilo7">nombre destinatario  <?php echo strtoupper($nom_aux) ?></span></span></td>
        </tr>
      <tr>
        <td height="18" colspan="2" align="center" class="Estilo8"><span style="visibility:hidden">ENDEDOR:</span><span  class="Estilo7"><?php echo strtoupper($responsable) ?></span></td>
        <td colspan="5">&nbsp;</td>
        </tr>
      <tr>
        <td height="18" colspan="2" align="center" class="Estilo8">&nbsp;</td>
        <td colspan="5"><span class="Estilo8"><span class="Estilo7">ruc o dni   <?php echo $ruc_aux?></span></span></td>
        </tr>
      <tr>
        <td height="18" colspan="2" align="center" class="Estilo8" ><span style="visibility:hidden">RECIBO N&ordm;: </span><span class="Estilo7"><?php echo $obs1 ?></span></td>
        <td width="47" class="Estilo8">&nbsp;</td>
        <td width="106" span style="visibility:hidden" class="Estilo8" >TRANSPORTISTA:</td>
        <td width="46" align="right" class="Estilo8" ><span class="Estilo1"><?php echo $nom_trans ?></span></td>
        <td width="69" align="left" valign="bottom"  style="visibility:hidden" class="Estilo8">RUC:</td>
        <td width="104" align="left" valign="bottom" class="Estilo8"><span class="Estilo1"><?php echo $ruc_trans ?></span></td>
      </tr>
      <tr>
        <td height="18" colspan="2"><span style="visibility:hidden" class="Estilo8" >FORMA Y CONDICIONES DE PAGO : </span></td>
        <td class="Estilo8"><span class="Estilo7"><?php echo strtoupper($condicion) ?></span></td>
        <td  style="visibility:hidden" class="Estilo8" >DOMICILIO:</td>
        <td align="right" class="Estilo8" ><span class="Estilo1"><?php echo $direc_trans ?></span></td>
        <td align="left" valign="bottom" style="visibility:hidden"  class="Estilo8">PLACA:</td>
        <td align="left" valign="bottom" class="Estilo8"><span class="Estilo1"><?php echo $placa_trans ?></span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="611" colspan="4" valign="top"><table width="750"  border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td width="72"  height="19"><div style="visibility:hidden" align="center"><span class="Estilo8">C&Oacute;DIGO</span></div></td>
        <td width="56" ><span style="visibility:hidden" class="Estilo8">CANT.</span></td>
        <td width="56" ><span style="visibility:hidden" class="Estilo8">UNIDAD</span></td>
        <td width="336" align="center"><span style="visibility:hidden" class="Estilo3">DESCRIPCI&Oacute;N</span></td>
        <td width="75" ><span style="visibility:hidden" class="Estilo8"> SERIE </span></td>
        <td width="75" align="center"><span class="Estilo8" style="visibility:hidden">VALOR</span></td>
        <td width="80" ><span style="visibility:hidden" class="Estilo8"> TOTAL </span></td>
      </tr>
	  
	  <?php 	  
$strSQL= "select * from det_mov where cod_cab= '".$codigo."' " ;
$resultado = mysql_query ($strSQL,$cn);

while ($row = mysql_fetch_array ($resultado)) {

$cant= $row ['cantidad']; 
$P =  $row ['cod_prod'];
$descripcion =  $row ['nom_prod'];
$p_unit = number_format ($row ['precio'],2);
	  
$strSQL1= "select * from producto where idproducto= '".$P."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row1 = mysql_fetch_array ($resultado1);
$u = $row1 ['und']; 
$cod_producto=$row1 ['idproducto']; 

$strSQL2= "select * from unidades where id = '".$u."' " ;
$resultado2 = mysql_query ($strSQL2,$cn);
$row2 = mysql_fetch_array ($resultado2);
$unid= $row2 ['nombre'];

$p_tot = number_format ($cant * $p_unit,2);
	  ?>
      <tr>
        <td align="center"><span class="Estilo7"><?php echo $cod_producto?></span></td>
        <td align="center"><span class="Estilo7"><?php echo $cant ?></span></td>
        <td align="center"><span class="Estilo7"><?php echo $unid ?></span></td>
        <td align="left"><span class="Estilo7"><?php echo $descripcion ?></span></td>
        <td align="left"><span class="Estilo3"><?php echo $nota ?></span></td>
        <td align="right"><span class="Estilo7">&nbsp;<?php echo $p_unit ?></span></td>
        <td align="right"><span class="Estilo7">&nbsp;<?php echo $p_tot ?></span></td>
      </tr>
<?php 

}

?>	  
	  
      <tr>
        <td height="19" colspan="7"><div align="left"></div></td>
        </tr>
    </table></td>
  </tr>
  
   <tr>
    <td  height="20" colspan="4">SON :<?php echo  strtoupper(num2letras($m_total)." Nuevos Soles") ?> </td>
  </tr>
   <tr>
     <td  height="20" colspan="4">&nbsp;</td>
   </tr>
  
  
  
  <tr>
    <td  height="90" colspan="4"><table width="750" height="80" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="172" height="80" class="Estilo8">&nbsp;</td>
          <td width="125" align="center" class="Estilo8"><span class="Estilo7"><span class="Estilo7"><?php echo $moneda ?></span>&nbsp;&nbsp;&nbsp;<?php echo $m_bruto ?></span></td>
          <td width="117" align="center" class="Estilo8"><span class="Estilo7"><span class="Estilo7"><?php echo $moneda ?></span>&nbsp;&nbsp;&nbsp;<?php echo number_format($val_descu,2) ?></span></td>
          <td width="126" align="center" class="Estilo8"><span class="Estilo7"><span class="Estilo7"><?php echo $moneda ?></span>&nbsp;&nbsp;&nbsp;<?php echo $val_fact ?></span></td>
          <td width="122" align="center" class="Estilo8"><span class="Estilo7"><span class="Estilo7"><?php echo $moneda ?></span>&nbsp;&nbsp;&nbsp;<?php echo $igv ?></span></td>
          <td width="54" align="right" class="Estilo8"><span class="Estilo7"><span class="Estilo7"><?php echo $moneda ?></span></span></td>
          <td width="34" align="right" class="Estilo8"><span class="Estilo7"><?php echo $m_total ?></span></td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
