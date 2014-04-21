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
$tienda=$row ['tienda']; 
$igv=$row ['igv'];
$impto=$row['impto1'];

$transportista=$row ['transportista']; 
$chofer=$row ['chofer']; 
 
$dat_trans=mysql_fetch_array(mysql_query("select * from transportista where id=".$transportista));
$marca=$dat_trans['marca'];
$placa=$dat_trans['placa'];
$lic=$dat_trans['lic_mtc'];
$nom_transp=$dat_trans['nombre'];

$dat_chofer=mysql_fetch_array(mysql_query("select * from chofer where cod=".$chofer));
$nom_chofer=$dat_chofer['nombre'];

$nom_aux3 = $row ['cod_vendedor']; 
$nom_aux4 = $row ['condicion']; 
$m_total =$row ['total']; 
 
$m_bruto  = $row ['b_imp']; 
$igv = $row ['igv']; 

$fecha_emision1 = substr ($row ['fecha'],0,10); 
$f = explode("-",$fecha_emision1) ;

$dia_fech = $f[2];
$mes_fech = $f[1];
$año_fech = substr ($f[0],0,4);


$strSQL1= "select * from referencia where cod_cab = '".$codigo."' " ;
//echo $strSQL1;
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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<style type="text/css">
*{

/*border:1mm;*/
margin:0px;
padding:0mm 0mm;
font-size: 19px;
/*font:Arial, Helvetica, sans-serif;*/
font:Arial, Helvetica, sans-serif;

}
#contenedor{
position:relative;
top:0mm;
left:0mm;
width:200mm;
height:218mm;
border:0px solid;
}
#sec1{
position:relative;
height:70mm;
border:0px solid;
}
#serie{
	position:absolute;
	top:41.54mm;
	left:193.94mm;
	border:0px solid;
	width: 159px;
	visibility: visible;
	height: 19px;
}

#cliente{
	position:absolute;
	top:65.881mm;
	left:44.979mm;
	height:18px;
	width:123.825mm;
	border:0px solid;
	visibility: visible;
}
#direccion{
	position:absolute;
	top:84.402mm;
	left:44.715mm;
	height:17px;
	width:101.6mm;
	border:0px solid;
	visibility: visible;
}

#ruc{
	position:absolute;
	top:74.877mm;
	left:44.979mm;
	height:17px;
	border:0px solid;
	visibility: visible;
	width: 120px;
}
#referencia{
	position:absolute;
	top:76.729mm;
	left:166.952mm;
	border:0px solid;
	height:20px;
	visibility: visible;
	width: 156px;
}
#layer2{
	position:absolute;
	top:76.729mm;
	left:209.815mm;
	border:0px solid;
	height:20px;
	visibility: visible;
	width: 192px;
}

#fecha2{
position:absolute;
top:28.31mm;
left:91.017mm;
border:0px solid;
}
#sec2{
position:relative;
height:145mm;
border:0px solid;
}
#detalle{
	position:absolute;
	top:101.865mm;
	left:18.256mm;
	border:0px solid;
	width: 895px;
	visibility: visible;
	height: 79px;
}
#sec3{
position:relative;
height:40mm;
border:0px solid;
}
#moneda_letras{
	position:absolute;
	top:230.452mm;
	left:32.808mm;
	border:0px solid;
	height:22px;
	vertical-align:baseline;
	visibility: visible;
	width: 593px;
}
#fecha{
	position:absolute;
	top:84.931mm;
	left:179.387mm;
	border:0px solid;
	width: 315px;
	visibility: visible;
	height: 22px;
}
#subtotal{
	position:absolute;
	top:239.712mm;
	left:232.04mm;
	border:0px solid;
	width: 20mm;
	text-align:right;
	visibility: visible;
}
#imp{
	position:absolute;
	top:246.856mm;
	left:232.304mm;
	border:0px solid;
	width: 20mm;
	text-align:right;
	visibility: visible;
}
#total{
	position:absolute;
	top:254.265mm;
	left:232.833mm;
	border:0px solid;
	width: 20mm;
	text-align:right;
	visibility: visible;
	height: 20px;
}
#fechaUdt{
	position:absolute;
	top:1.058mm;
	left:3.969mm;
	border:0px solid;
	width: 66.146mm;
	text-align:left;
	visibility: visible;
	height: 20px;
}
</style>
<style media="print">
.noprint     { display: none }
</style>

<style type="text/css">
<!--
.Estilo11 {font-size: 16px}
.Estilo7 {font-size: 16px; font:Arial, Helvetica, sans-serif}
-->
</style>



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

</head>
<!--"-->
<body onLoad="defrente()">
<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>
<div id="contenedor">

<div id="serie"><?php echo $doc ?> / <?php echo $serie ?>-<?php echo $numero ?></div>

<div id="cliente"><?php echo utf8_encode(strtoupper($nom_aux)); ?></div>
<div id="direccion"><?php echo utf8_encode($direc_aux)?></div>
<div id="ruc"> 
<?php echo $ruc_aux; ?></div>
<div id="referencia"><?php 
if(!empty($tip_docu_ref) && !empty($num_ref_ser) && !empty($num_ref_corr)){
echo $tip_docu_ref."/".$num_ref_ser."-".$num_ref_corr ;
}else{
echo $obs1;
}?></div>
<div id="layer2">
  <?php echo $condicion ?></div>


<div id="detalle" style="vertical-align:top">
  <table width="883" height="70"  border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td  height="10" colspan="2">&nbsp;</td>
      <td width="620" align="center">&nbsp;</td>
      <td width="68" align="center">&nbsp;</td>
      <td  width="90">&nbsp;</td>
    </tr>
    <?php 	  
$strSQL= "select * from det_mov where cod_cab= '".$codigo."' " ;
$resultado = mysql_query ($strSQL,$cn);
$z=1;
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
      <td width="85" align="left" valign="top"><p class="Estilo7"><?php echo $cant ?></p></td>
      <td width="20" align="left" valign="top"><span class="Estilo7"></span></td>
      <td align="left" valign="top"><?php echo utf8_encode($descripcion);
		 if ($simanejaser == "S" )
				 {
		  		?> <br>
              <?php 
			  //echo "sgh";
		$acumulador="";
		
		while($row4=mysql_fetch_array($resultado4)){
		$acumulador=$acumulador.$row4 ['serie'].", ";
		}
		$acumulador=substr($acumulador,0,strlen($acumulador)-2);
		
		//echo $acumulador;

		
	echo "S/N:".$acumulador;
	 }
	 
	 ?>      </td>
      <td align="center" valign="top"><span class="Estilo7">&nbsp;<?php echo number_format($p_unit,2) ?></span></td>
      <td align="right" valign="top"  class="Estilo7" >&nbsp;<?php echo number_format($p_tot,2)?></td>
    </tr>
    <?php 

}

?>
    <tr>
      <td height="19" colspan="7"><div align="left"></div></td>
    </tr>
  </table>
</div>

<div id="moneda_letras"><?php echo  strtoupper(num2letras($m_total)." ".$monedalet); ?></div>
<div id="fecha">

<table width="308" height="21" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="36" align="center" valign="middle"><?php echo $dia_fech;?></td>
      <td width="203" align="center" valign="middle"><?php echo $mes_fech;?></td>
      <td width="69" align="center" valign="middle">20<?php echo substr($año_fech,2,2);?></td>
    </tr>
  </table>

</div>
<div id="subtotal"><?php echo $moneda.number_format($m_bruto,2) ?></div>
<div id="imp"><?php echo $p_igv." ".$moneda. number_format( $igv,2) ?></div>
<div id="total"><?php echo $moneda.number_format($m_total,2) ?></div>

</div>
<div id="fechaUdt"><?php echo gmdate('d-m-Y H:i:s',time()-18000) ?></div>
</body>
</html>
