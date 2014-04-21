<?php 
session_start();
include ('../../conex_inicial.php'); 
include('../../numero_letras.php');


$empresa =  $_REQUEST['empresa'];
$doc=  $_REQUEST['doc'];
$serie =  $_REQUEST['serie'];
$numero =  $_REQUEST['numero'];


//echo $empresa." ".$doc." ".$serie." ".$numero;
$strSQL= "select * from cab_mov where sucursal='$empresa' and cod_ope='$doc' and serie='$serie' and Num_doc='$numero' " ;


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

$fecha_emision1 = substr ($row ['fecha'],0,10); 
$f = explode("-",$fecha_emision1) ;
$f1 = $f[2]."-".$f[1]."-".$f[0];
$fecha_emision = $f1;



$nom_aux3 = $row ['cod_vendedor']; 
$nom_aux4 = $row ['condicion']; 
$m_total = $row ['total']; 
 
$m_bruto  = $row ['b_imp']; 
$igv = $row ['igv']; 





$strSQL1= "select * from referencia where cod_cab = '".$codigo."' " ;

$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$num_ref_ser = $row ['serie']; 
$num_ref_corr = $row ['correlativo']; 
$cod_cab_ref1 = $row ['cod_cab_ref']; 


$strSQL3= "select * from cab_mov where cod_cab= '".$cod_cab_ref1."' " ;

$resultado3 = mysql_query ($strSQL3,$cn);
$row = mysql_fetch_array ($resultado3);
$codigo_doc_ref = $row ['cod_ope']; 
$fecha_ref = $row ['fecha']; 

$fecha_ref = substr ($row ['fecha'],0,10); 
$fe1 = explode("-",$fecha_ref) ;
$fe2 = $fe1[2]."-".$fe1[1]."-".$fe1[0];
$fecha_ref = $fe2;

$strSQL3= "select * from operacion where codigo= '".$codigo_doc_ref."' " ;

$resultado3 = mysql_query ($strSQL3,$cn);
$row = mysql_fetch_array ($resultado3);
$descrip_docu_ref = $row ['descripcion']; 


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

//switch($mes_fech)
// {
 
 // 	case "01":
 //   $mes_letra = "Enero";
//	break;
	
//	case "02":
//   $mes_letra = "Febrero";
//	break;
	
	//case "03":
 //   $mes_letra = "Marzo";
//	break;
	
	//case "04":
  //  $mes_letra = "Abril";
//	break;
	
	//case "05":
   // $mes_letra = "Mayo";
//	break;
	
//	case "06":
  //  $mes_letra = "Junio";
//	break;
	
	//case "07":
 //   $mes_letra = "Julio";
//	break;
	
//	case "08":
//    $mes_letra = "Agosto";
	//break;
	
	//case "09":
   // $mes_letra = "Setiembre";
	//break;
	
	//case "10":
   // $mes_letra = "Octubre";
	//break;

//	case "11":
  //  $mes_letra = "Noviembre";
	//break;
	
	//case "12":
//	$mes_letra = "Diciembre";
//	break;
//}

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
-->
</style>

<style media="print">
.noprint     { display: none }
</style>
<style type="text/css">
*{
margin:0mm;
/*border:1mm;*/
padding:0mm 0mm;
font-size: 12px; 
font:Arial, Helvetica, sans-serif;

}
#contenedor{
position:relative;
top:0mm;
left:0mm;
width:168mm;
border:0px solid;
}
#sec1{
position:relative;
height:60mm;
border:0px solid;
}
#serie{
position:absolute;
top:18mm;
left:100mm;
border:0px solid;
}

#nombre{
position:absolute;
top:46.831mm;
left:29.104mm;
width:75mm;
border:0px solid;
}
#doc{
position:absolute;
top:50.8mm;
left:132.556mm;
width:38.629mm;
border:0px solid;
}

#ruc{
	position:absolute;
	top:51.858mm;
	left:21.96mm;
	border:0px solid;
	height: 20px;
}
#num_doc{
	position:absolute;
	top:56.356mm;
	left:126.206mm;
	border:0px solid;
	height: 20px;
}
#fecha{
	position:absolute;
	top:56.356mm;
	left:39.952mm;
	border:0px solid;
	height: 20px;
}
#sec2{
position:relative;
height:60mm;
border:0px solid;
}
#detalle{
position:absolute;
top:11.112mm;
left:12.435mm;
border:0px solid;
}
#sec3{
position:relative;
height:20mm;
border:0px solid;
}
#subtotal{
position:absolute;
top:6.879mm;
left:108.744mm;

border:0px solid;
}
#imp{
	position:absolute;
	top:10.583mm;
	left:174.625mm;
	border:0px solid;
	width: 100px;
	text-align: right;
	height: 20px;
}
#total{
	position:absolute;
	top:23.813mm;
	left:175.683mm;
	border:0px solid;
	width: 100px;
	text-align: right;
}
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

<!--onLoad="printer()"-->
<body  onLoad="printer()">

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

<div id="contenedor">
<div id="sec1">
<div id="fecha"><?php echo $fecha_emision ?></div>
<div id="serie"><?php echo $doc ?> / <?php echo $serie ?>-<?php echo $numero ?></div>
<div id="nombre"><span class="Estilo7"><?php echo strtoupper($nom_aux) ?></span></div>
<div id="doc"><span class="Estilo7"><?php echo $descrip_docu_ref ?></span></div>
<div id="ruc">  
  <table width="75"  border="0" cellpadding="0" cellspacing="0">
  <tr>
      <td width="100">&nbsp;</td>
      <td width="20"><?php echo $ruc_aux; ?></td>
      <td width="50">&nbsp;</td>
      <td width="20"><?php echo $dni_aux; ?></td>
  </tr>
  </table>
</div>
<div id="num_doc"><?php echo $num_ref_ser ?>-<?php echo $num_ref_corr?></div>
</div>
<div id="sec2">
<div id="detalle">
  <table width="715"  border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="67"  height="29"><span style="visibility:hidden" align ="center"><span class="Estilo8">CANT</span></span></td>
	        <td width="70"  height="29"><span style="visibility:hidden" align ="center"><span class="Estilo8">C.</span></span></td>
            <td width="414" align="center"><span style="visibility:hidden" class="Estilo7">DESCRIPCI&Oacute;N</span></td>
      <td width="70" align="center"><span class="Estilo8" style="visibility:hidden">VALOR</span></td>
      <td  width="94"><span style="visibility:hidden" class="Estilo8"> TOTAL </span></td>
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

$strSQL4="select se.* from series se inner join det_mov det on det.cod_prod=se.producto inner join referencia re on det.cod_cab=re.cod_cab_ref inner join cab_mov ca on re.cod_cab=ca.cod_cab where det.cod_prod='".$P."' and tienda='".$tienda."' and ca.cod_cab='".$codigo."'";
*/
$strSQL4="select distinct(se.id),se.* from series se inner join referencia re on re.cod_cab_ref=se.salida inner join det_mov det on det.cod_cab=re.cod_cab_ref and det.cod_prod=se.producto inner join cab_mov ca on re.cod_cab=ca.cod_cab where det.cod_prod='".$P."' and se.tienda='".$tienda."' and ca.cod_cab='".$codigo."'";
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
      <td align="center" valign="middle"><span class="Estilo7"><?php echo $cant ?></span></td>
	        <td align="center" valign="middle"><span class="Estilo7"><?php echo $P ?></span></td>
            <td height="20" align="left" valign="top"><p class="Estilo7"><?php echo $descripcion;
		 if ($simanejaser == "S" )
				 {
		  		?> <br>
              <?php 
		$acumulador="";
		while($row4=mysql_fetch_array($resultado4)){
			$acumulador=$acumulador.$row4['serie'].", ";
		}
		$acumulador=substr($acumulador,0,strlen($acumulador)-2);
		
		//echo $acumulador;

		
	echo "S/N:".$acumulador;
	 }?>
      </p></td>
      <td align="right" valign="top"><span class="Estilo7">&nbsp;<?php echo number_format($p_unit,2) ?></span></td>
      <td align="right" valign="top"  class="Estilo7" >&nbsp;<?php echo number_format($p_tot,2)?></td>
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
  <div id="subtotal"><?php //echo $moneda.number_format($m_bruto,2) ?></div>
  <div id="imp"><?php echo $p_igv." ".$moneda. number_format( $igv,2) ?></div>
  <div id="total"><?php echo $moneda.number_format($m_total,2) ?></div>
</div>
</div>
</body>
</html>
