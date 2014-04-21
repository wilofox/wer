<?php 

session_start();

include ('../../conex_inicial.php'); 

include('../../numero_letras.php');
include('../../funciones/funciones.php');


$empresa =  $_REQUEST['empresa'];

$doc=  $_REQUEST['doc'];

$serie =  $_REQUEST['serie'];

$numero =  $_REQUEST['numero'];

$strSQL= "select * from cab_mov where sucursal='$empresa ' and cod_ope='$doc'  and serie='$serie' and Num_doc='$numero' " ;

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
$dirPartida=$row ['dirPartida'];

$tienda=$row ['tienda'];  
$transportista=$row ['transportista'];  

$dat_trans=mysql_fetch_array(mysql_query("select * from transportista where id=".$transportista));
$nomtrans=$dat_trans['nombre'];
$ructrans=$dat_trans['ruc'];
$marca=$dat_trans['marca'];
$direTransp=$dat_trans['direccion'];
$placa=$dat_trans['placa'];

$lic=$dat_trans['lic_mtc'];

$fecha_emision1 = substr ($row ['fecha'],0,10); 

$f = explode("-",$fecha_emision1) ;

$dia_fech = $f[2];

$mes_fech = $f[1];

$año_fech = $f[0];
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

$fecha_ref = $row ['fecha']; 







if ($moneda1 == "01")

($moneda = "S/" );



else

($moneda = "US$");


/*
if ($t_persona == "natural")

($ruc_aux = $dni_aux);



else

($ruc_aux = $ruc_aux);
*/




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

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Documento sin t&iacute;tulo</title>
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
height:250mm;
border:0px solid;
}
#fecha{
	position:absolute;
	top:53.975mm;
	left:43.127mm;
	border:0px solid;
	width: 182px;
	height: 24px;
}
#fecha2{
	position:absolute;
	top:244.475mm;
	left:94.456mm;
	border:0px solid;
	width: 211px;
	height: 21px;
}
#partida{
	position:absolute;
	top:67.469mm;
	left:18.256mm;
	width:75mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}
#llegada{
	position:absolute;
	top:61.383mm;
	left:128.852mm;
	width:84.402mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}
#referencia{
	position:absolute;
	top:244.475mm;
	left:68.263mm;
	width:58.473mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}
#destino{
position:absolute;
top:52mm;
left:6mm;
width:75mm;
text-indent:19mm;
border:0px solid;
}
#ruc{
	position:absolute;
	top:77.258mm;
	left:124.354mm;
	border:0px solid;
	width: 142px;
	height: 20px;
}
#dni{
	position:absolute;
	top:50.271mm;
	left:65.617mm;
	border:0px solid;
	width: 101px;
	height: 20px;
}
#destino{
	position:absolute;
	top:71.702mm;
	left:115.623mm;
	width:78.581mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}
#dirAlma{
	position:absolute;
	top:61.383mm;
	left:32.808mm;
	width:84.137mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}

#mar{
	position:absolute;
	top:88.106mm;
	left:50.006mm;
	width:42.333mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}
#placa{
	position:absolute;
	top:88.635mm;
	left:65.881mm;
	width:41.275mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}
#lice{
	position:absolute;
	top:101.6mm;
	left:50.535mm;
	width:25.135mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}
#detalle{
	position:absolute;
	top:108.479mm;
	left:5.292mm;
	border:0px solid;
	width: 734px;
	height: 95px;
}
#trans_nom{
	position:absolute;
	top:88.106mm;
	left:130.175mm;
	border:0px solid;
	width: 193px;
	height: 20px;
}
#trans_ruc{
	position:absolute;
	top:101.6mm;
	left:130.704mm;
	border:0px solid;
	width: 124px;
	height: 20px;
}
#total{
position:absolute;
top:198mm;
left:4mm;
border:0px solid;
}
#fechaUdt{
	position:absolute;
	top:0.794mm;
	left:0.529mm;
	border:0px solid;
	width: 66.146mm;
	text-align:left;
	visibility: visible;
	height: 20px;
}
#serie{
	position:absolute;
	top:41.01mm;
	left:146.315mm;
	border:0px solid;
	width: 173px;
	height: 24px;
}

#direTransp{
	position:absolute;
	top:59.531mm;
	left:39.158mm;
	border:0px solid;
	width: 130px;
	height: 24px;
}
.Estilo7 {font-size: 12px; font:Arial, Helvetica, sans-serif}
</style>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style></head>

<style media="print">
.noprint     { display: none }
</style>



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

<!--onLoad="defrente()"-->

<body onLoad="printer();"> 

<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>


<!--<div class="Estilo7" id="direTransp" ><?php echo $direTransp ?></div>
<div id="fecha">-->

<!--<table width="161" height="19" border="0" cellpadding="0" cellspacing="0">

</table>-->
</div>

<div class="Estilo7" id="serie"><?php echo $doc ?> / <?php echo $serie ?>-<?php echo $numero ?></div>
<div class="Estilo7" id="llegada"><?php echo utf8_encode(strtoupper($direc_aux)); ?></div>
<div class="Estilo7" id="destino"><?php echo utf8_encode($nom_aux)?></div>
<div class="Estilo7" id="dirAlma"><?php echo utf8_encode($dirPartida)?></div>

<div id="ruc" class="Estilo7"><?php echo $ruc_aux; ?></div>
<div class="Estilo7" id="trans_nom"><?php echo utf8_encode($nomtrans) ?></div>
<div class="Estilo7" id="trans_ruc"><?php echo $ructrans; ?></div>
<div class="Estilo7" id="mar"><?php echo $marca ?></div>
<div class="Estilo7" id="placa"><?php echo $placa; ?></div>
<div class="Estilo7" id="lice"><?php echo $lic; ?></div>
<div id="fecha"> 
<table width="121" height="18" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="22" align="center" valign="middle"><?php echo $dia_fech;?></td>
	  <td width="34" align="center" valign="middle">/</td>
      <td width="31" align="center" valign="middle"><?php echo $mes_letra;?></td>
	  <td width="34" align="center" valign="middle">/</td>
      <td width="45" align="center" valign="middle">20<?php echo substr($año_fech,2,2);?></td>
    </tr>
  </table>
</div>
<div id="detalle">
  <table width="671" height="75"  border="0" align="left" cellpadding="0" cellspacing="0">
    <tr>
      <td width="46" >&nbsp;</td>
      <td width="67" >&nbsp;</td>
      <td width="45" >&nbsp;</td>
      <td width="375" ><span class="Estilo7" style="visibility:hidden">DESCRIPCI&Oacute;N</span></td>
      <td width="25" >&nbsp;</td>
      <td width="113" >&nbsp;</td>
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

$p_tot = number_format ($cant * $p_unit,2);





$strSQL4="select distinct(se.id),se.* from series se inner join referencia re on re.cod_cab_ref=se.salida inner join det_mov det on det.cod_cab=re.cod_cab_ref and det.cod_prod=se.producto inner join cab_mov ca on re.cod_cab=ca.cod_cab where det.cod_prod='".$P."' and se.tienda='".$tienda."' and ca.cod_cab='".$codigo."'";

$resultado4 = mysql_query ($strSQL4,$cn);

	  ?>
    <tr>
      <td  align="left" valign="top" class="Estilo7"><span class="Estilo7"></span><span class="Estilo7"><?php echo $P  ?></td>
      <td  align="center" valign="top" class="Estilo7"><?php echo $cant ?></td>
      <td colspan="3"  align="left" valign="top" class="Estilo7"><span class="Estilo7"><?php echo utf8_encode($descripcion);?></span></td>
    </tr>
    <?php 



}



?>
    <tr>
      <td  colspan="28" class="Estilo7"><div align="left"></div></td>
    </tr>
  </table>
</div>
<div id="fecha2">

<table width="202"  height="19" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="202" align="center" valign="middle" class="Estilo7"><?php echo $fecha_ref ?></td>
    </tr>
  </table>


</div>
<div class="Estilo7" id="referencia"><?php echo $tip_docu_ref  ?> / <?php echo $num_ref_ser ?>-<?php echo $num_ref_corr ?></div>

<div id="fechaUdt"><?php echo gmdate('d-m-Y H:i:s',time()-18000) ?></div>

</body>

</html>

