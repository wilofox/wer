<?php 
session_start();
include ('../../conex_inicial.php'); 
include('../../numero_letras.php');


$empresa =  $_REQUEST['empresa'];
$doc=  $_REQUEST['doc'];
$serie =  $_REQUEST['serie'];
$numero =  $_REQUEST['numero'];


$strSQL= "select * from cab_mov where sucursal='$empresa ' and cod_ope='$doc'  and serie='$serie' and Num_doc='$numero' " ;



if(isset($_REQUEST['codcab'])){
	$strcab		= 	"select * from cab_mov where cod_cab='".$_REQUEST['codcab']."' " ;
	$resultado	=   mysql_query($strcab,$cn);
	$row		=   mysql_fetch_array($resultado);
	$empresa 	=  	$row['sucursal'];
	$doc	 	=  	$row['cod_ope'];
	$serie 	 	=  	$row['serie'];
	$numero  	=  	$row['Num_doc'];
	}

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
$m_total =$row ['total']; 
 
$m_bruto  = $row ['b_imp']; 
$igv = $row ['igv']; 

$fecha_emision1 = substr ($row ['fecha'],0,10); 
$f = explode("-",$fecha_emision1) ;

$dia_fech = $f[2];
$mes_fech = $f[1];
$a�o_fech = substr ($f[0],2,4);


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
*{
margin:0mm;
/*border:1mm;*/
padding:0mm 0mm;
font-size: 12px; 
font:Arial, Helvetica, sans-serif;
height:auto;

}
#contenedor{
position:relative;
top:0mm;
left:0mm;
width:168mm;
height:118mm;
border:0px solid;
}
#sec1{
position:relative;
height:55mm;
border:0px solid;
}
#serie{
	position:absolute;
	top:5.027mm;
	left:188.648mm;
	border:0px solid;
	width: 104px;
}

#cliente{
position:absolute;
top:26.458mm;
left:21.96mm;
width:75mm;

border:0px solid;
}
#direccion{
position:absolute;
top:37.042mm;
left:21.431mm;
width:75mm;
border:0px solid;
}

#ruc{
position:absolute;
top:47.36mm;
left:21.696mm;
border:0px solid;
}
#referencia{
position:absolute;
top:37.835mm;
left:155.31mm;
border:0px solid;
}
#fecha2{
position:absolute;
top:37.571mm;
left:117.74mm;
border:0px solid;
}
#sec2{
position:relative;
height:90mm;
border:0px solid;
}
#detalle{
	position:absolute;
	top:35.454mm;
	left:6.35mm;
	border:0px solid;
	width: 757px;
}
#sec3{
position:relative;
height:30mm;
border:0px solid;
}
#moneda_letras{
position:absolute;
top:-6.35mm;
left:24.606mm;
border:0px solid; height:30px; vertical-align:baseline;
}
#fecha{
	position:absolute;
	top:-128.058mm;
	left:136.79mm;
	border:0px solid;
	width: 285px;
}
#subtotal{
	position:absolute;
	top:21.696mm;
	left:142.61mm;
	border:0px solid;
	width: 20mm;
	text-align:right;
}
#imp{
	position:absolute;
	top:21.696mm;
	left:173.037mm;
	border:0px solid;
	width: 20mm;
	text-align:right;
}
#total{
	position:absolute;
	top:21.696mm;
	left:204.258mm;
	border:0px solid;
	width: 20mm;
	text-align:right;
}
</style>
<style media="print">
.noprint     { display: none }
</style>

<style type="text/css">
<!--
.Estilo11 {font-size: 11px}
.Estilo7 {font-size: 14px; font:Arial, Helvetica, sans-serif}
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

	//if(pc=="localhost"){
	//viewinit1();
	//Print(false, top);
	//}else{
	printer();
	//}
	
}


</script>


<body onLoad="defrente()" >
<?php //echo  num2letras(36.00) ?>
<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>




<div id="installFailure" >
	
</div>

<div id="contenedor">
<div id="sec1">
<div id="serie"><?php echo $doc ?> / <?php echo $serie ?>-<?php echo $numero ?></div>

<div id="cliente"><?php echo strtoupper($nom_aux); ?></div>
<div id="direccion"><?php echo $direc_aux?></div>
<div id="ruc"> 
<?php echo $ruc_aux; ?></td>
</div>
<div id="referencia"><?php //echo $tip_docu_ref."/".$num_ref_ser."-".$num_ref_corr?></div>
</div>
<div id="fecha2">
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="30" align="center" valign="middle"><?php echo $dia_fech;?></td>
      <td width="30" align="center" valign="middle"><?php echo $mes_letra;?></td>
      <td width="40" align="center" valign="middle"><?php echo $a�o_fech;?></td>
    </tr>
  </table>
</div>
<div id="sec2">
<div id="detalle">
  <table width="738"   border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="73"  height="10">&nbsp;</td>
      <td width="521" align="center">&nbsp;</td>
      <td width="72" align="center">&nbsp;</td>
      <td  width="72">&nbsp;</td>
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
//echo $strSQL3;
$resultado3 = mysql_query ($strSQL3,$cn);
$row3 = mysql_fetch_array ($resultado3);
$tienda= $row3 ['cod_tienda'];
*/

$strSQL4="select * from series where producto='".$P."' and tienda='".$tienda."' and salida='".$codigo."'";
$resultado4 = mysql_query ($strSQL4,$cn);

//echo $strSQL4;
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
      <td align="left" valign="top"><p class="Estilo7"><?php echo $cant ?></p></td>
      <td align="left" valign="top"><p class="Estilo7"><?php echo $descripcion;
		 if ($simanejaser == "S" )
				 {
		  		?> <br>
              <?php 
		$acumulador="";
		
		while($row4=mysql_fetch_array($resultado4)){
		$acumulador=$acumulador.$row4 ['serie'].", ";
		}
		$acumulador=substr($acumulador,0,strlen($acumulador)-2);
		
		//echo $acumulador;

		
	echo "S/N:".$acumulador;
	 }
	 
	 ?>
      </p></td>
      <td align="center" valign="top"><span class="Estilo7">&nbsp;<?php echo number_format($p_unit,2) ?></span></td>
      <td align="center" valign="top"  class="Estilo7" >&nbsp;<?php echo number_format($p_tot,2)?></td>
    </tr>
    <?php 

}

?>
    <tr>
      <td height="19" colspan="6"><div align="left"></div></td>
    </tr>
  </table>
</div>
</div>
<div id="sec3">
<div id="moneda_letras"><?php echo  strtoupper(num2letras($m_total)." ".$monedalet); ?></div>
<div id="fecha">
  <table width="283" height="19" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="74" align="center" valign="middle"><?php echo $dia_fech;?></td>
      <td width="148" align="center" valign="middle"><?php echo $mes_letra;?></td>
      <td width="52" align="center" valign="middle"><?php echo $a�o_fech;?></td>
    </tr>
  </table>
</div>
<div id="subtotal"><?php echo $moneda.number_format($m_bruto,2) ?></div>
<div id="imp"><?php echo $p_igv." ".$moneda. number_format( $igv,2) ?></div>
<div id="total"><?php echo $moneda.number_format($m_total,2) ?></div>
</div>
</div>
</body>
</body>
</html>
