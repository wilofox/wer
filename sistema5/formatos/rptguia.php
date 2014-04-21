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
//$tienda=$row ['tienda']; 

$fecha_emision1 = substr ($row ['fecha'],0,10); 
$f = explode("-",$fecha_emision1) ;
$dia_fech = $f[2];
$mes_fech = $f[1];
$año_fech = $f[0];

$f1 = $f[2]."-".$f[1]."-".$f[0];
$fecha_emision = $f1;


$nom_aux3 = $row ['cod_vendedor']; 
$nom_aux4 = $row ['condicion']; 
$cod_tienda = $row ['tienda']; 


$m_bruto  = number_format ($row ['b_imp'],2); 
$igv = number_format ($row ['igv'],2); 

$strSQL1= "select * from cliente where codcliente = '".$nom_aux1."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$nom_aux = $row ['razonsocial']; 
$direc_aux =  $row ['direccion']; 
$dni_aux = $row ['doc_iden']; 
$ruc_aux = $row ['ruc']; 
$t_persona =$row ['t_persona']; 

$strSQL1= "select * from usuarios where codigo= '".$nom_aux3."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$responsable = $row ['usuario']; 

$strSQL1= "select * from tienda where cod_tienda= '".$cod_tienda."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$direc_alma = $row ['direccion'];
$nombre_tienda= $row ['des_tienda'];

 


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


$strSQL1= "select * from referencia where cod_cab = '".$codigo."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$num_ref_ser = $row ['serie']; 
$num_ref_corr = $row ['correlativo']; 
$cod_cab_ref = $row ['cod_cab_ref']; 



$strSQL3= "select * from cab_mov where cod_cab= '".$cod_cab_ref."' " ;



$resultado3 = mysql_query ($strSQL3,$cn);
$row = mysql_fetch_array ($resultado3);
$tip_docu_ref = $row ['cod_ope']; 



if ($moneda1 == "01")
($moneda = "S/" );

else
($moneda = "US$");

if ($t_persona == "natural")
($ruc_aux = $dni_aux);

else
($ruc_aux = $ruc_aux);


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



<table width="766" height="953" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="653" height="145">&nbsp;</td>
    <td width="113" colspan="3" valign="bottom"><table style="display:none" width="94%" height="82" border="0" align="center" cellpadding="0" cellspacing="0">
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
    <td height="201" colspan="4" align="left"><table width="775" height="169" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="8" class="Estilo8" style="visibility:hidden"  ></td>
        <td width="36" rowspan="2" align="right" valign="top" class="Estilo8"   >&nbsp;</td>
        <td width="78" rowspan="2" align="right" valign="top" class="Estilo8"   >&nbsp;</td>
        <td width="154" rowspan="2" align="center" valign="top" class="Estilo8"   >&nbsp;</td>
        <td width="42" rowspan="2" class="Estilo8" style="visibility:hidden"  ><span class="Estilo7"><?php echo $dia_fech ?></span></td>
        <td width="42" rowspan="2" class="Estilo8" style="visibility:hidden"  ><span class="Estilo7"><?php echo $mes_fech ?></span></td>
        <td width="275" rowspan="2" class="Estilo8" style="visibility:hidden"  ><span class="Estilo7"><?php echo $año_fech ?></span></td>
      </tr>
      <tr>
        <td width="148" height="23" class="Estilo8" style="visibility:hidden"  >FECHA DE EMISION </td>
        </tr>
      <tr>
        <td height="18" align="center" class="Estilo8" style="visibility:hidden" >PUNTO DE PARTIDA </td>
        <td height="18" colspan="3" align="left"><span class="Estilo7"><?php echo $nombre_tienda ?></span></td>
        <td colspan="3" align="left" class="Estilo8"> <span align="left" style= "visibility: hidden" > PUNTO DE LLEGADA :</span> <span class="Estilo8"><?php echo strtoupper($direc_aux) ?></span></td>
        </tr>
      <tr>
        <td height="17" colspan="3" align="center" class="Estilo8" style="visibility:hidden" span>FECHA DE INICIO DE TRANSLADO </td>
        <td rowspan="2" align="left" valign="middle" class="Estilo8" span>&nbsp;</td>
        <td colspan="3"><span style="visibility:hidden" class="Estilo8">NOMBRE O RAZON SOCIAL DEL DESTINATARIO <span class="Estilo7">:</span></span></td>
        </tr>
      <tr>
        <td height="18" align="center" class="Estilo8">&nbsp;</td>
        <td height="18" align="center" class="Estilo8">&nbsp;</td>
        <td height="18" align="center" class="Estilo8">&nbsp;</td>
        <td colspan="3" valign="top">&nbsp;</td>
        </tr>
      
      <tr>
        <td colspan="4" rowspan="3" align="center" class="Estilo8" ><table width="100%" height="84" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="2" class="Estilo8" style="visibility:hidden" >UNIDAD DE TRANSPORTE Y CONDUCTOR </td>
            </tr>
          <tr>
            <td width="27%" height="29" class="Estilo1" style="visibility:hidden" >MARCA Y N&quot; DE PLACA </td>
            <td width="73%" valign="middle" class="Estilo8"><span class="Estilo1"><?php echo $nom_aux?></span></td>
          </tr>
          <tr>
            <td height="31" colspan="2" class="Estilo1" style="visibility:hidden" >&nbsp;</td>
            </tr>
          
        </table></td>
        <td height="18" colspan="3" align="center" class="Estilo8" style="visibility:hidden" >EMPRESA DE TRANSPORTES </td>
        </tr>
      <tr>
        <td height="18" colspan="2" class="Estilo8" style="visibility:hidden" >NOMBRE O RAZ. SOCIAL </td>
        <td align="left" class="Estilo8" >&nbsp;</td>
        </tr>
      <tr>
        <td height="36" colspan="3" class="Estilo8">&nbsp;</td>
        </tr>
      
    </table></td>
  </tr>
  <tr>
    <td height="497" colspan="4" valign="top"><table width="777"  border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td width="94"  height="28"><div style="visibility:hidden" align="center"><span class="Estilo8">C&Oacute;DIGO</span></div></td>
        <td width="59" ><span style="visibility:hidden" class="Estilo8">CANT.</span></td>
        <td width="378" align="center"><span style="visibility:hidden" class="Estilo3">DESCRIPCI&Oacute;N</span></td>
        <td width="75" ><span style="visibility:hidden" class="Estilo8"> SERIE </span></td>
        <td width="88" align="center"><span class="Estilo8" style="visibility:hidden">VALOR</span></td>
        <td width="83" ><span style="visibility:hidden" class="Estilo8"> TOTAL </span></td>
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
        <td align="right"><span class="Estilo7"><?php echo $cod_producto?></span></td>
        <td align="center"><span class="Estilo7"><?php echo $cant ?></span></td>
        <td colspan="4" align="left"><span class="Estilo7"><?php echo $descripcion ?></span><span class="Estilo7">&nbsp;</span><span class="Estilo7">&nbsp;</span></td>
        </tr>
<?php 

}

?>	  
	  
      <tr>
        <td height="19" colspan="6"><div align="left"></div></td>
        </tr>
    </table></td>
  </tr>
  
   <tr>
    <td  height="20" colspan="4" class="Estilo8"  ><span class= "Estilo8" style="visibility:hidden" > TIPO Y NU mmmmMERO DE COMPROBANTE DE PAGO:</span><span class="Estilo7"><?php echo $tip_docu_ref ?> /</span>&nbsp; <span class="Estilo7"><?php echo $num_ref_ser ?>-<?php echo $num_ref_corr?></span></td>
  </tr>
   
  
  
  
  <tr>
    <td  height="90" colspan="4">&nbsp;</td>
  </tr>
</table>

<div id=idControls class="noprint">
	 <div id="idBtn">
     </div>
  </div>


</div>



</body>
</html>
