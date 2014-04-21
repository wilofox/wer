<?php 
session_start();
include ('../conex_inicial.php'); 
include('../numero_letras.php');


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
$m_total = $row ['total']; 
 

$strSQL1= "select * from cliente where codcliente = '".$nom_aux1."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$nom_aux = $row ['razonsocial']; 
$direc_aux =  $row ['direccion']; 
$dni_aux = $row ['doc_iden']; 
 

$strSQL1= "select * from cliente where codcliente = '".$nom_aux1."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$nom_aux = $row ['razonsocial']; 
$direc_aux =  $row ['direccion']; 
$dni_aux = $row ['doc_iden']; 



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
$p_unit = $row ['precio'];
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

$p_tot = $cant * $p_unit;


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
#contenedor{
position:relative;
top:-10mm;

}
#serie{
position:absolute;
top:17mm;
left:77mm;

}
#detalle{
position:relative;
left:0mm;

}

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
	//viewinit1();
	//Print(false, top);
	printer();
	}else{
	printer();
	}
	
}


</script>


<body onLoad="defrente()" >

<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>


<div id="contenedor">
<div id="serie"><?php echo $doc ?> / <?php echo $serie ?> - <?php echo $numero ?></div>
<table width="583" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="511" height="35">&nbsp;</td>
    <td width="72" colspan="3" valign="bottom"><table style="display:none" width="94%" height="82" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2"><div style="visibility:hidden"  align="left">R.U.C. N&ordf; 20528334181 </div></td>
      </tr>
      <tr>
        <td colspan="2"><div style="visibility:hidden"  align="left">BOLETA DE VENTA  </div></td>
      </tr>
      <tr>
        <td width="31%"><div style="visibility:hidden"  align="left">N&quot; 001 - </div></td>
        <td width="69%"><div style="visibility:hidden"  align="left"></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="76" colspan="4" align="left" valign="top"><table width="613" height="70" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="87" height="31" ><span style="visibility:hidden" class="Estilo8">CLIENTE : </span></td>
        <td width="93">&nbsp;</td>
        <td width="202" align="right" ><span style="visibility:hidden" class="Estilo3">FECHA :&nbsp;<span class="Estilo7" style="visibility:hidden"> </span></span></td>
        <td width="62" >&nbsp;</td>
        <td >&nbsp;</td>
        <td >&nbsp;</td>
      </tr>
      <tr>
        <td height="18"><span style="visibility:hidden" class="Estilo8">NOMBRE : </span></td>
        <td colspan="4"><span class="Estilo3"><?php echo strtoupper($nom_aux) ?></span></td>
        <td width="74" valign="middle">&nbsp;</td>
      </tr>
      <tr>
        <td height="20"><span style="visibility:hidden" class="Estilo8">DIRECCION :</span></td>
        <td colspan="3"><span class="Estilo3"><?php echo strtoupper($direc_aux) ?></span></td>
        <td width="95" ><span style="visibility:hidden" class="Estilo8">FECHA</span></td>
        <td width="74" align="left" valign="top"><span class="Estilo7" style="position:relative;top:1mm;"><?php echo $fecha_emision ?></span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="202" colspan="4" valign="top"><div id="detalle"><table width="588"  border="0" align="left" cellpadding="0" cellspacing="0">
	  
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


	  ?>
      <tr>
        <td width="61" align="center"><span class="Estilo7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $cant ?></span></td>
        <td width="368" align="left"><span class="Estilo7"><?php echo substr($descripcion,0,32) ?></span></td>
        <td width="68" align="right"><span class="Estilo7">&nbsp;<?php echo number_format($p_unit,2) ?></span></td>
        <td width="91" align="center"><span class="Estilo7">&nbsp;&nbsp;<?php echo number_format($p_tot,2)?></span></td>
      </tr>
<?php 

}

?>	  
	  
      <tr>
        <td height="19" colspan="6"><div align="left"></div></td>
        </tr>
    </table></div></td>
  </tr>
  
   <tr>
    <td  height="20" colspan="4" valign="bottom">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SON : <?php echo  strtoupper(num2letras($m_total)." Nuevos Soles") ?></td>
  </tr>
   
  
  
  
  <tr>
    <td  height="20" colspan="4" valign="top"><table width="568" height="23" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="455">&nbsp;</td>
          <td width="58" align="right"><span class="Estilo7"><?php echo $moneda ?></span></td>
          <td width="84" align="center"><span class="Estilo7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($m_total,2) ?></span></td>
        </tr>
      </table></td>
  </tr>
</table>
</div>
</body>
</html>
