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
$tienda=$row ['tienda']; 
$igv=$row ['igv'];
$impto=$row['impto1'];




$nom_aux3 = $row ['cod_vendedor']; 
$nom_aux4 = $row ['condicion']; 
$m_total = $row ['total']; 
 
$m_bruto  = $row ['b_imp']; 
$igv = $row ['igv']; 

$fecha_emision1 = substr ($row ['fecha'],0,10); 
$f = explode("-",$fecha_emision1) ;

$dia_fech = $f[2];
$mes_fech = $f[1];
$año_fech = substr ($f[0],2,4);


$strSQL1= "select * from referencia where cod_cab = '".$codigo."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$num_ref_ser = $row ['serie']; 
$num_ref_corr = $row ['correlativo']; 
$cod_cab_ref1 = $row ['cod_cab_ref']; 

$strSQL3= "select * from cab_mov where cod_cab= '".$cod_cab_ref1."' " ;

$resultado3 = mysql_query ($strSQL3,$cn);
$row = mysql_fetch_array ($resultado3);
$tip_docu_ref = $row ['cod_ope']; 

$strSQL1= "select * from cliente where codcliente = '".$nom_aux1."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$nom_aux = $row ['razonsocial']; 
$direc_aux =  $row ['direccion']; 
$dni_aux = $row ['doc_iden']; 
$ruc_aux = $row ['ruc']; 




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

//if ($moneda1 = "01")
//($moneda = "S/" );

//else
//($moneda = "US$");

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
.Estilo3 {font-size: 12px; font:Arial, Helvetica, sans-serif}
.Estilo7 {font-size: 12px; font:Arial, Helvetica, sans-serif}
.Estilo8 {font-size: 12px}
.Estilo10 {font-size: 12px}
-->
</style>

<style media="print">
.noprint     { display: none }
</style>

<style type="text/css">
<!--
.Estilo11 {font-size: 11px}
-->
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
//window.focus();

	if(pc=="localhost"){
	viewinit1();
	Print(false, top);
	}else{
	printer();
	}
	
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

<table width="771" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="153" align="right" valign="bottom">
	   
   
      <table width="265" height="61" border="0" cellpadding="0" cellspacing="0" >
        <tr>
          <td width="120" height="19" align="center">&nbsp;</td>
          <td width="62">&nbsp;</td>
        </tr>
        <tr>
          <td height="32" align="right" valign="top"><span style="font-size:14px"><?php echo $doc ?>/ <?php echo $serie ?>-<?php echo $numero ?></span></td>
          <td>&nbsp;</td>
        </tr>
      </table>
	  
	  
	  </td>
    </tr>
  <tr>
    <td height="56" align="left" valign="top">
	
	<table width="772" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="110" ><span style="visibility:hidden" class="Estilo8">NOMBRE : </span></td>
        <td colspan="2"><span class="Estilo8"><?php echo strtoupper($nom_aux) ?></span></td>
        <td width="77">&nbsp;</td>
        <td width="94" align="center">&nbsp;</td>
        <td width="75" class="Estilo8" align="center">&nbsp;</td>
        </tr>
      <tr>
        <td   height="19" class="Estilo8" style="visibility:hidden">RUC : </td>
        <td width="288"  style="font:Arial, Helvetica, sans-serif; font-size:14px"><?php echo $ruc_aux?></td>
        <td width="128">&nbsp;</td>
        <td align="left"><span class="Estilo8"><?php echo $dia_fech ?></span></td>
        <td align="center" class="Estilo6"><?php echo $mes_letra?></td>
        <td class="Estilo7" align="right"><?php echo $año_fech ?>&nbsp;&nbsp;&nbsp;</td>
      </tr>
      <tr>
        <td height="18"><span style="visibility:hidden" class="Estilo8">DIRECCION:</span></td>
        <td colspan="2"><span class="Estilo8"><?php echo strtoupper($direc_aux) ?></span><span class="Estilo8"><span class="Estilo8">&nbsp;&nbsp;<?php //echo $tip_docu_ref ?></span>&nbsp; <span class="Estilo8"><?php //echo $num_ref_ser ?><?php //echo $num_ref_corr?></span></span></td>
        <td colspan="3" align="left">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="438" align="left" valign="top"><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="105"  height="39"><span style="visibility:hidden" align ="center"><span class="Estilo8">CANT</span></span></td>
       
        <td colspan="2" align="center"><span class="Estilo3 Estilo11" style="visibility:hidden">DESCRIPCI&Oacute;N</span></td>
        <td width="69" align="center"><span class="Estilo8" style="visibility:hidden">VALOR</span></td>
        <td  width="121"><span style="visibility:hidden" class="Estilo8"> TOTAL </span></td>
      </tr>
	  
	  <?php 	  
$strSQL= "select * from det_mov where cod_cab= '".$codigo."' " ;
$resultado = mysql_query ($strSQL,$cn);

while ($row = mysql_fetch_array ($resultado)) {

$cant= $row ['cantidad']; 
$P =  $row ['cod_prod'];
$descripcion =  $row ['nom_prod'];
$p_unit = $row ['precio'];
$p_tot = $cant * $p_unit;
	  
$strSQL1= "select * from producto where idproducto= '".$P."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row1 = mysql_fetch_array ($resultado1);
$u = $row1 ['und']; 
$cod_producto=$row1 ['idproducto']; 
$simanejaser = $row1 ['series']; 

$strSQL2= "select * from unidades where id = '".$u."' " ;
$resultado2 = mysql_query ($strSQL2,$cn);
$row2 = mysql_fetch_array ($resultado2);
$unid= $row2 ['nombre'];
/*
$strSQL3= "select * from tienda where cod_suc = '".$empresa."' " ;
$resultado3 = mysql_query ($strSQL3,$cn);
$row3 = mysql_fetch_array ($resultado3);
$tienda= $row3 ['cod_tienda'];
*/
$strSQL4="select * from series where producto='".$P."' and tienda='".$tienda."' and salida='".$codigo."'";
$resultado4 = mysql_query ($strSQL4,$cn);


//$row4 = mysql_fetch_array ($resultado4);
//$acumulador = $row4 ['serie'];

//

//$acumulador = $row4 ['serie'].",";
//*********************************
//while($row=mysql_fetch_array($resultado4)){
//$acumulador=$acumulador.$row['serie'].",";
//}
//$acumulador=substr($acumulador,0,strlen($acumulador)-1);

//echo $acumulador;

	  ?>
	
      <tr>
        <td align="center" valign="top"><span class="Estilo8"><?php echo $cant ?></span></td>
        <td width="422" align="left" valign="top" class="Estilo8"><?php echo $descripcion;
		 if ($simanejaser == "S" )
				 {
		  		?>
				<br>
          <?php 
		$acumulador="";
		
		while($row4=mysql_fetch_array($resultado4)){
		$acumulador=$acumulador.$row4 ['serie'].", ";
		}
		$acumulador=substr($acumulador,0,strlen($acumulador)-2);
		
		//echo $acumulador;

		
	echo "S/N:".$acumulador;
	 }?>
         
        </td>
        <td width="59" align="left" valign="top">&nbsp;</td>
        <td align="center" valign="top"><span style="font-size:14px">&nbsp;<?php echo number_format($p_unit,2) ?></span></td>
        <td align="center" valign="top"  style="font-size:14px" >&nbsp;<?php echo number_format($p_tot,2)?></td>
      </tr>
<?php 

}

?>	  
	  
      <tr>
        <td height="19" colspan="7">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  

   
  
  
  <tr>
    <td  height="20"><table width="684" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="98">&nbsp;</td>
          <td width="472"><span class="Estilo10"><?php echo  strtoupper(num2letras($m_total)." ".$monedalet); ?></span></td>
        </tr>
      </table>
      <table width="776"  border="0" cellpadding="0" cellspacing="0">
        
        <tr>
          <td width="118" rowspan="3">&nbsp;</td>
          <td width="396" valign="middle">&nbsp;</td>
          <td  align="right" valign="middle">&nbsp;</td>
          <td width="117" align="center" valign="middle"><span style="font-size:14px"><?php echo $moneda ?>&nbsp;&nbsp;<?php echo number_format($m_bruto,2) ?></span></td>
        </tr>
        <tr>
          <td rowspan="2" valign="middle">&nbsp;</td>
          <td width="145" align="right" valign="middle"><table width="64" height="19" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="43" align="right"><span class="Estilo10"><?php echo $impto ?></span></td>
              <td width="21">&nbsp;</td>
            </tr>
          </table></td>
          <td width="117" align="center" valign="middle"><span style="font-size:14px"><?php echo $moneda ?></span>&nbsp;&nbsp;<span style="font-size:14px"><?php echo $igv?></span></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td width="117" align="center"><span style="font-size:14px"><?php echo $moneda ?></span>&nbsp;&nbsp;&nbsp;<span style="font-size:14px"><?php echo number_format($m_total,2)?></span></td>
        </tr>
      </table>
      </td>
  </tr>
</table>

	<div id=idControls class="noprint">
	 <div id="idBtn">
     </div>
	</div>


</div>

</body>
</html>
