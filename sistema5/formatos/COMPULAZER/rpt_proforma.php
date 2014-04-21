<?php 
include ('../../conex_inicial.php'); 
include('../../numero_letras.php');


//$empresa =  $_REQUEST['empresa'];
//$doc=  $_REQUEST['doc'];
//$serie =  $_REQUEST['serie'];
//$numero =  $_REQUEST['numero'];

$empresa =  "1";
$doc=  "BV";
$serie =  "003";
$numero =  "0000002";


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
$incluido = $row ['incluidoigv']; 

$fecha_emision1 = substr ($row ['fecha'],0,10); 
$f = explode("-",$fecha_emision1) ;
$dia_fech = $f[2];
$mes_fech = $f[1];
$año_fech = $f[0];



$nom_aux3 = $row ['cod_vendedor']; 
$nom_aux4 = $row ['condicion']; 

$m_bruto  = number_format ($row ['b_imp'],2); 
$igv = number_format ($row ['igv'],2); 
$serie = $row ['serie']; 
$corr = $row ['Num_doc'];

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

//incluido igv

if ($incluido = "S")
($inclu_igv = "INCLUYEN EL IGV" );

else
($inclu_igv = "NO INCLUYEN EL IGV");


$p_tot = number_format ($cant * $p_unit,2);

$val_fact = number_format($m_bruto - $val_descu,2);

$m_total = number_format($val_fact + $igv,2) ;

 $variable=2;
 
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
.Estilo1 {font-size: 9px}
.Estilo12 {font-size: 11px; font-weight: bold; }
.Estilo15 {font-size: 14px; font: Arial, Helvetica, sans-serif; font-weight: bold; }
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


<body   >



<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>

<table width="763" height="1071" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td style="padding-right:150px" height="132" colspan="4" align="center" valign="middle"><p>&nbsp;</p>      <p><img src="../../imagenes/compulaser.png" width="200" height="94"></p></td>
    <td colspan="4" valign="bottom"><table style="display:none" width="94%" height="82" border="0" align="center" cellpadding="0" cellspacing="0">
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
    <td height="207" colspan="8" align="left"><table width="899" height="202" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="3" >&nbsp;</td>
        <td align="center" >PROFORMA DE VENTA </td>
        <td width="120" align="center" valign="bottom" >&nbsp;</td>
        <td width="30" valign="bottom" >&nbsp;</td>
        <td width="37" valign="bottom" >&nbsp;</td>
        <td width="95" valign="bottom" >&nbsp;</td>
      </tr>
      <tr>
        <td >&nbsp;</td>
        <td height="27" >&nbsp;</td> 	 
        <td>&nbsp;</td>
        <td align="center" ><span class="Estilo7"><?php echo $serie ?>-</span><span class="Estilo7"><?php echo $corr ?></span></td>
        <td align="center" valign="bottom" >&nbsp;</td>
        <td valign="bottom" >&nbsp;</td>
        <td valign="bottom" >&nbsp;</td>
        <td valign="bottom" >&nbsp;</td>
      </tr>
      <tr>
        <td width="55" >&nbsp;</td>
        <td width="147" >&nbsp;</td>
        <td width="146">&nbsp;</td>
        <td width="269" align="center" >&nbsp;</td>
        <td align="left" valign="bottom" ><span class="Estilo7">Lima, <?php echo $dia_fech ?> de <?php echo $mes_letra?></span></td>
        <td valign="bottom" ><span class="Estilo7"> del </span></td>
        <td valign="bottom" ><span class="Estilo7"><?php echo $año_fech ?></span></td>
        <td valign="bottom" >&nbsp;</td>
      </tr>
      <tr>
        <td align="center" class="Estilo8">&nbsp;</td>
        <td height="18" style="padding-right:25px" align="center" class="Estilo12">SR.(S): </td>
        <td colspan="6"><span class="Estilo7"><?php echo strtoupper($nom_aux) ?></span></td>
      </tr>
      <tr>
        <td align="center" class="Estilo8">&nbsp;</td>
        <td style="padding-right:5px" height="18" align="center" class="Estilo12">&nbsp;ATENCION:</td>
        <td colspan="6">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" class="Estilo8"span>&nbsp;</td>
        <td height="18"  style="padding-left:3" align="center" class="Estilo8"span><span  class="Estilo8">&nbsp;<strong>&nbsp;DIRECCION :</strong></span></td>
        <td colspan="6"><span style="visibility:hidden" class="Estilo8"><span class="Estilo8" style="visibility:hidden"></span></span><span class="Estilo7"><?php echo strtoupper($direc_aux) ?></span></td>
        </tr>
      <tr>
        <td align="center" class="Estilo8">&nbsp;</td>
        <td height="18" align="center" class="Estilo8">&nbsp;<strong>VENDEDOR:</span></strong></td>
        <td colspan="6"><span class="Estilo8"><span  class="Estilo7"><?php echo strtoupper($responsable) ?></span></span></td>
        </tr>
      <tr>
        <td align="center" class="Estilo8">&nbsp;</td>
        <td height="18" align="center"   class="Estilo8"><strong>RUC:&nbsp;&nbsp;</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td colspan="6"><span class="Estilo8"><span class="Estilo7"><?php echo $ruc_aux?></span></span></td>
        </tr>
      <tr>
        <td style="padding-right:235px" height="19" colspan="4" align="right" valign="middle" class="Estilo7">Por la Presente, nos es grato cotizarle lo siguiente: </td>
        <td colspan="4" class="Estilo8"  style="visibility:hidden" >&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="522" colspan="8" valign="top" align="center"><table width="744"  border="0" cellpadding="0" cellspacing="0">
      <tr  >
        <td style= "border-top:#000000 solid 1px; border-bottom:#000000 solid 1px" width="73"  height="19" align="center" class="Estilo1"><span style="padding-left:10px" class="Estilo12">C&Oacute;DIGO</span></td>
        <td style= "border-top:#000000 solid 1px; border-bottom:#000000 solid 1px" width="56" align="center" class="Estilo1" ><span  class="Estilo12">CANT.</span></td>
        <td  style= "border-top:#000000 solid 1px; border-bottom:#000000 solid 1px" width="56" class="Estilo1" ><span  class="Estilo12">UNIDAD</span></td>
        <td style= "border-top:#000000 solid 1px; border-bottom:#000000 solid 1px" width="332" align="left" class="Estilo1"><span  class="Estilo12">DESCRIPCI&Oacute;N</span></td>
        <td style= "border-top:#000000 solid 1px; border-bottom:#000000 solid 1px"  width="79" class="Estilo1" ><span class="Estilo12"> SERIE </span></td>
        <td style= "border-top:#000000 solid 1px; border-bottom:#000000 solid 1px" width="44" align="right" class="Estilo1"><span class="Estilo12" >VALOR</span></td>
        <td style= "border-top:#000000 solid 1px; border-bottom:#000000 solid 1px" width="104" align="center" class="Estilo1" ><span class="Estilo12"> TOTAL </span></td>
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
        <td align="center"><span style="padding-left:5px" class="Estilo7"><?php echo $cod_producto?></span></td>
        <td align="center"><span class="Estilo7"><?php echo $cant ?></span></td>
        <td align="center"><span class="Estilo7"><?php echo $unid ?></span></td>
        <td align="left"><span class="Estilo7"><?php echo substr($descripcion,0,32) ?></span></td>
        <td align="left"><span class="Estilo3"><?php echo substr($nota,0,8) ?></span></td>
        <td align="right"><span class="Estilo7">&nbsp;<?php echo $p_unit ?></span></td>
        <td align="center"><span class="Estilo7">&nbsp;<?php echo $p_tot ?></span></td>
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
     <td height="20" align="center" class="Estilo7" style="padding-left:60px">&nbsp;</td>
     <td align="center" valign="middle" class="Estilo8" style="padding-left:60px; border-top: #000000 solid 1px">&nbsp;</td>
     <td height="20" colspan="2" align="left" class="Estilo8" style="padding-left:60px; border-top: #000000 solid 1px">&nbsp;</td>
     <td height="20" class="Estilo8" style="padding-left:60px;border-top: #000000 solid 1px">&nbsp;</td>
     <tdheight="20" align="left" class="Estilo8" style="padding-left:60px; border-top: #000000 solid 1px">&nbsp;</td>
     <td align="center" valign="middle" class="Estilo8" style="border-top: #000000 solid 1px">&nbsp;</td>
     <tdheight="20" class="Estilo7" style="padding-left:60px">&nbsp;</td>
   </tr>
   <tr>
     <td width="89"height="20" align="center" class="Estilo7" style="padding-left:60px">&nbsp;</td>
     <td  width="189" align="center" valign="middle" class="Estilo8" style="padding-left:60px; border-top: #000000 solid 1px">IMPUESTO :</td>
     <td height="20" colspan="2" align="left" class="Estilo8" style="padding-left:60px; border-top: #000000 solid 1px"><?php echo $inclu_igv ?></td>
     <td width="119"height="20" class="Estilo8" style="padding-left:60px"><strong>SUBTOTAL:</strong></td>
     <td width="120"height="20" align="left" class="Estilo8" style="padding-left:60px"><span class="Estilo8" style="padding-left:60px"><?php echo $moneda ?></span></td>
     <td width="84" align="center" valign="middle" class="Estilo8" ><?php echo $m_bruto ?></td>
     <td width="76"height="20" class="Estilo7" style="padding-left:60px">&nbsp;</td>
   </tr>
   <tr>
     <td height="20" align="center" class="Estilo8" style="padding-left:60px">&nbsp;</td>
     <td height="20" align="center" valign="middle" class="Estilo8" style="padding-left:50px">MONEDA:</td>
     <td height="20" colspan="2" align="left" valign="middle" class="Estilo8" style="padding-left:60px">&nbsp;</td>
     <td style="padding-left:60px"height="20" class="Estilo8"><strong>IGV:</strong></td>
     <td height="20" class="Estilo8" style="padding-left:60px"><?php echo $moneda ?></td>
     <td height="20" align="center" valign="middle" class="Estilo8" ><?php echo $igv ?></td>
     <td style="padding-left:60px"height="20" class="Estilo7">&nbsp;</td>
   </tr>
   <tr>
     <td height="20" align="center" class="Estilo7" style="padding-left:60px">&nbsp;</td>
     <td height="20" align="right" valign="middle" class="Estilo8" style="padding-right:1px">FORMA DE PAGO: </td>
     <td height="20" colspan="2" align="left" valign="middle" class="Estilo8" style="padding-left:60px"><?php echo strtoupper($condicion) ?></td>
     <td style="padding-left:60px"height="20" class="Estilo8"><strong>TOTAL:</strong></td>
     <td height="20" class="Estilo8" style="padding-left:60px"><span class="Estilo8" style="padding-left:60px"><?php echo $moneda ?></span></td>
     <td height="20" align="center" valign="middle" class="Estilo8" ><span class="Estilo8"><span class="Estilo8"><?php echo $m_total ?></span></span></td>
     <td style="padding-left:60px"height="20" class="Estilo7">&nbsp;</td>
   </tr>
   <tr>
     <td height="19" align="center" class="Estilo7" style="padding-left:60px">&nbsp;</td>
     <td height="19" align="center" valign="middle" class="Estilo8" style="padding-left:60px">GARANTIA:</td>
     <td width="161" height="19" align="left" valign="middle" class="Estilo8" style="padding-left:60px"><span class="Estilo8" style="padding-left:60px; border-top: #000000 solid 1px"><?php echo "&nbsp;".$obs1 ?></span></td>
     <td width="61" class="Estilo7" style="padding-left:60px">&nbsp;</td>
     <td style="padding-left:60px"height="20" class="Estilo8">&nbsp;</td>
     <td height="20" class="Estilo8" style="padding-left:60px">&nbsp;</td>
     <td height="20" align="center" valign="middle" class="Estilo8" >&nbsp;</td>
     <td style="padding-left:60px"height="19" class="Estilo7">&nbsp;</td>
   </tr>
   <tr>
     <td  height="20" colspan="8">&nbsp;</td>
   </tr>
  
  
  
  <tr>
    <td  height="90" colspan="8" align="left" valign="top"><table width="789" height="59" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="173" height="59" class="Estilo8">&nbsp;</td>
          <td width="125" align="center" class="Estilo8"><span class="Estilo7">&nbsp;&nbsp;</span></td>
          <td width="117" align="center" class="Estilo8">&nbsp;</td>
          <td width="126" align="center" class="Estilo8"><span class="Estilo7"><span class="Estilo7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></td>
          <td width="150" align="right" class="Estilo8">&nbsp;</td>
          <td width="33" align="right" class="Estilo8">&nbsp;</td>
          <td width="65" align="right" class="Estilo8">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
