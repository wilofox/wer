<?php 
session_start();
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

$val_descu = "5.00";
echo $val_descu ;

$p_tot = number_format ($cant * $p_unit,2);

$val_fact = number_format($m_bruto - $val_descu,2);

$m_total = number_format($val_fact + $igv,2) ;





$strSQL_doc= "select * from operacion where codigo = '".$doc."' " ;
$resultado_doc = mysql_query ($strSQL_doc,$cn);
$row_doc = mysql_fetch_array ($resultado_doc);
$cola=$row_doc['cola'];


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


<script src="../../javascript/colaimp.js"></script>

<script>

var pc="<?php echo $_SESSION['pc_ingreso'] ?>";
var cola="<?php echo $cola?>";

function printer() 
{ 
vbPrintPage() 
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

</script>




<body onLoad="defrente()"> 



<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>

<?php if($_SESSION['pc_ingreso']=='localhost'){ ?>

<object id="secmgr" style="display:none" viewastext classid="clsid:5445BE81-B796-11D2-B931-002018654E2E" codebase="http://www.prolyam.com/restaurante/javascript/smsx.cab#Version=6.5.439.37">
<param name="GUID" value="{0ADB2135-6917-470B-B615-330DB4AE3701}">
<param name="Path" value="http://www.meadroid.com/scriptx/sxlic.mlf">
<param name="Revision" value="0">
<param name="PerUser" value="true">
</object>

<object id="factory" style="display:none" viewastext classid="clsid:1663ED61-23EB-11D2-B92F-008048FDD814" codebase="http://codestore.meadroid.com/products/scriptx/binary.ashx?version=6,5,439,50&filename=smsx.cab&x2ref=http://www.meadroid.com/scriptx/docs/samples/basic.asp#Version=6,5,439,50">
</object>
<?php }?>

<div id="installFailure" >
	
</div>


<div id="installOK">




<table width="793" height="1065" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="653" height="118">&nbsp;</td>
    <td width="140" colspan="3" valign="bottom"><table style="display:none" width="94%" height="82" border="0" align="center" cellpadding="0" cellspacing="0">
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
    <td height="95" colspan="4" align="left"><table width="750" height="146" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="121" ><span style="visibility:hidden" class="Estilo8">CLIENTE : </span></td>
        <td width="170">&nbsp;</td>
        <td width="98" align="center" ><span style="visibility:hidden" class="Estilo3">FECHA :</span></td>
        <td colspan="5" valign="bottom" ><span class="Estilo7"><?php echo $fecha_emision ?></span></td>
        </tr>
      <tr>
        <td height="18" align="center"><span style="visibility:hidden" class="Estilo8">NOMBRE : </span><span class="Estilo7">&nbsp;</span></td>
        <td colspan="7"><span class="Estilo7"><?php echo strtoupper($nom_aux) ?></span></td>
      </tr>
      <tr>
        <td height="18" align="center" class="Estilo8" style="visibility:hidden" span><span style="visibility:hidden" class="Estilo8">IRECCION :</span></td>
        <td colspan="7"><span style="visibility:hidden" class="Estilo8"><span class="Estilo8" style="visibility:hidden"></span></span><span class="Estilo7"><?php echo strtoupper($direc_aux) ?></span></td>
        </tr>
      <tr>
        <td height="18" align="center" class="Estilo8"><span style="visibility:hidden">ENDEDOR:</span></td>
        <td colspan="7"><span class="Estilo8"><span  class="Estilo7"><?php echo strtoupper($responsable) ?></span></span></td>
        </tr>
      <tr>
        <td height="18" align="center" class="Estilo8"><span style="visibility:hidden">RUC:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
        <td colspan="7"><span class="Estilo8"><span class="Estilo7"><?php echo $ruc_aux?></span></span></td>
        </tr>
      <tr>
        <td height="18" align="center" class="Estilo8" ><span style="visibility:hidden">RECIBO N&ordm;: </span></td>
        <td colspan="3" class="Estilo8"><span class="Estilo7"><?php echo $obs1 ?></span></td>
        <td width="106" span style="visibility:hidden" class="Estilo8" >TRANSPORTISTA:</td>
        <td width="46" align="right" class="Estilo8" ><span class="Estilo1"><?php echo $nom_trans ?></span></td>
        <td width="69" align="left" valign="bottom"  style="visibility:hidden" class="Estilo8">RUC:</td>
        <td width="104" align="left" valign="bottom" class="Estilo8"><span class="Estilo1"><?php echo $ruc_trans ?></span></td>
      </tr>
      <tr>
        <td height="40" colspan="4" valign="top"><span style="visibility:hidden" class="Estilo8" >FORMA Y CONDICIONES DE PAGO :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span class="Estilo7"><?php echo strtoupper($condicion) ?></span></td>
        <td  style="visibility:hidden" class="Estilo8" >DOMICILIO:</td>
        <td align="right" class="Estilo8" ><span class="Estilo1"><?php echo $direc_trans ?></span></td>
        <td align="left" valign="bottom" style="visibility:hidden"  class="Estilo8">PLACA:</td>
        <td align="left" valign="bottom" class="Estilo8"><span class="Estilo1"><?php echo $placa_trans ?></span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="668" colspan="4" valign="top" align="right"><table width="774"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="73"  height="19"><div style="visibility:hidden" align="center"><span class="Estilo8">C&Oacute;DIGO</span></div></td>
        <td width="56" ><span style="visibility:hidden" class="Estilo8">CANT.</span></td>
        <td width="56" ><span style="visibility:hidden" class="Estilo8">UNIDAD</span></td>
        <td width="350" align="center"><span style="visibility:hidden" class="Estilo3">DESCRIPCI&Oacute;N</span></td>
        <td width="94" ><span style="visibility:hidden" class="Estilo8"> SERIE </span></td>
        <td width="75" align="center"><span class="Estilo8" style="visibility:hidden">VALOR</span></td>
        <td width="70" ><span style="visibility:hidden" class="Estilo8"> TOTAL </span></td>
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
        <td align="left"><span class="Estilo7"><?php echo substr($descripcion,0,32) ?></span></td>
        <td align="left"><span class="Estilo3"><?php echo substr($nota,0,8) ?></span></td>
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
    <td  height="20" colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SON :<?php echo  strtoupper(num2letras($m_total)." Nuevos Soles") ?> </td>
  </tr>
   <tr>
     <td  height="20" colspan="4">&nbsp;</td>
   </tr>
  
  
  
  <tr>
    <td  height="90" colspan="4" valign="top"><table width="791" height="59" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="173" height="59" class="Estilo8">&nbsp;</td>
          <td width="125" align="center" class="Estilo8"><span class="Estilo7"><span class="Estilo7"><?php echo $moneda ?></span>&nbsp;&nbsp;&nbsp;<?php echo $m_bruto ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
          <td width="117" align="center" class="Estilo8"><span class="Estilo7"><span class="Estilo7"><?php echo $moneda ?></span>&nbsp;&nbsp;&nbsp;<?php echo number_format($val_descu,2) ?></span></td>
          <td width="126" align="center" class="Estilo8"><span class="Estilo7"><span class="Estilo7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $moneda ?></span>&nbsp;&nbsp;&nbsp;<?php echo $val_fact ?></span></td>
          <td width="122" align="right" class="Estilo8"><span class="Estilo7"><span class="Estilo7">&nbsp;&nbsp;&nbsp;<?php echo $moneda ?></span>&nbsp;&nbsp;&nbsp;<?php echo $igv ?></span></td>
          <td width="72" align="right" class="Estilo8"><span class="Estilo7"><span class="Estilo7"><?php echo $moneda ?></span></span></td>
          <td width="56" align="right" class="Estilo8"><span class="Estilo7"><?php echo $m_total ?></span></td>
        </tr>
    </table></td>
  </tr>
</table>

<div id=idControls class="noprint">
	 <div id="idBtn">
     </div>
  </div>


</div>




</body>
</html>
