<?php session_start();
	include ('../../conex_inicial.php'); 
	include('../../numero_letras.php');
	include('../../funciones/funciones.php');
	$empresa = $_REQUEST['empresa'];
	$doc = $_REQUEST['doc'];
	$serie =  $_REQUEST['serie'];
	$numero =  $_REQUEST['numero'];
	$strSQL = "select * from cab_mov where sucursal='$empresa ' and cod_ope='$doc'  and serie='$serie' and Num_doc='$numero' " ;
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
	$transportista=$row ['transportista'];
	$dirPartida=$row ['dirPartida'];
	$dirDestino=$row ['dirDestino']; 
	$dat_trans=mysql_fetch_array(mysql_query("select * from transportista where id=".$transportista));
	$nomtrans=$dat_trans['nombre'];
	$ructrans=$dat_trans['ruc'];
	$marca=$dat_trans['marca'];
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
	$m_bruto = number_format ($row ['b_imp'],2); 
	$igv = number_format ($row ['igv'],2); 
	$strSQL1 = "select * from cliente where codcliente = '".$nom_aux1."' " ;
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
	$strSQL1 = "select * from tienda where cod_tienda= '".$cod_tienda."' " ;
	$resultado1 = mysql_query ($strSQL1,$cn);
	$row = mysql_fetch_array ($resultado1);
	$direc_alma = $row ['direccion'];
	$nombre_tienda = $row ['des_tienda'];
	$strSQL1 = "select * from condicion where codigo= '".$nom_aux4."' " ;
	$resultado1 = mysql_query ($strSQL1,$cn);
	$row = mysql_fetch_array ($resultado1);
	$condicion = $row ['nombre']; 
	$strSQL1 = "select * from det_mov where cod_cab= '".$codigo."' " ;
	$resultado1 = mysql_query ($strSQL1,$cn);
	$row = mysql_fetch_array ($resultado1);
	$cant= $row ['cantidad']; 
	$P = $row ['cod_prod'];
	$descripcion =  $row ['nom_prod'];
	$p_unit = number_format ($row ['precio'],2);
	$nota = substr($row ['notas'],0,15);
	$strSQL1= "select * from producto where idproducto= '".$P."' " ;
	$resultado1 = mysql_query ($strSQL1,$cn);
	$row = mysql_fetch_array ($resultado1);
	$u = $row ['und']; 
	$strSQL2 = "select * from unidades where id = '".$u."' " ;
	$resultado1 = mysql_query ($strSQL2,$cn);
	$row = mysql_fetch_array ($resultado1);
	$unid = $row ['nombre'];
	$strSQL1 = "select * from referencia where cod_cab = '".$codigo."' " ;
	$resultado1 = mysql_query ($strSQL1,$cn);
	$row = mysql_fetch_array ($resultado1);
	$num_ref_ser = $row ['serie']; 
	$num_ref_corr = $row ['correlativo']; 
	$cod_cab_ref = $row ['cod_cab_ref']; 
	$strSQL3 = "select * from cab_mov where cod_cab= '".$cod_cab_ref."' " ;
	$resultado3 = mysql_query ($strSQL3,$cn);
	$row = mysql_fetch_array ($resultado3);
	$tip_docu_ref = $row ['cod_ope']; 
	$fecha_ref = $row ['fecha']; 

	if ($moneda1 == "01")
		($moneda = "S/" );
	else
		($moneda = "US$");

	if ($t_persona == "natural")
		$ruc_aux = $dni_aux;
	else
		$ruc_aux = $ruc_aux;

	$p_tot = number_format ($cant * $p_unit,2);
	$val_fact = number_format($m_bruto - $val_descu,2);
	$m_total = number_format($val_fact + $igv,2) ;
	$strSQL_doc = "select * from operacion where codigo = '".$doc."' " ;
	$resultado_doc = mysql_query ($strSQL_doc,$cn);
	$row_doc = mysql_fetch_array ($resultado_doc);
	$cola = $row_doc['cola'];
?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
*{
	margin:0mm;
	padding:0mm 0mm;
	font:Arial, Helvetica, sans-serif;
	font-size:14px;
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
	top:50.271mm;
	left:142.081mm;
	border:0px solid;
	width: 64px;
	height: 30px;
}
#fecha2{
	position:absolute;
	top:58.208mm;
	left:46.567mm;
	border:0px solid;
	width: 237px;
	height: 20px;
}
#partida{
	position:absolute;
	top:48.683mm;
	left:18.785mm;
	width:87.048mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}
#llegada{
	position:absolute;
	top:49.212mm;
	left:110.067mm;
	width:96.044mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}
#referencia{
	position:absolute;
	top:187.06mm;
	left:63.5mm;
	width:35.983mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}
#referencia2{
	position:absolute;
	top:186.267mm;
	left:101.6mm;
	width:33.867mm;
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
	top:62.177mm;
	left:135.202mm;
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
	top:57.679mm;
	left:127.265mm;
	width:63.235mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}
#mar{
	position:absolute;
	top:75.142mm;
	left:56.356mm;
	width:57.15mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}
#placa{
	position:absolute;
	top:78.052mm;
	left:134.408mm;
	width:30.692mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}
#lice{
	position:absolute;
	top:88.106mm;
	left:55.563mm;
	width:37.306mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}
#obs1{
	position:absolute;
	top:186.796mm;
	left:61.648mm;
	width:41.804mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}
#obs2{
	position:absolute;
	top:138.112mm;
	left:13.229mm;
	width:41.804mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}
#obs3{
	position:absolute;
	top:145.256mm;
	left:12.965mm;
	width:41.804mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}
#obs4{
	position:absolute;
	top:152.929mm;
	left:13.494mm;
	width:41.804mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}
#obs5{
	position:absolute;
	top:162.19mm;
	left:13.758mm;
	width:41.804mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}
#detalle{
	position:absolute;
	top:98.69mm;
	left:19.579mm;
	border:0px solid;
	width: 676px;
}
#trans_nom{
	position:absolute;
	top:77.523mm;
	left:136.26mm;
	border:0px solid;
	width: 195px;
	height: 20px;
}
#trans_ruc{
	position:absolute;
	top:84.931mm;
	left:136.26mm;
	border:0px solid;
	width: 194px;
	height: 20px;
}
#total{
	position:absolute;
	top:198mm;
	left:4mm;
	border:0px solid;
}
#serie{
	position:absolute;
	top:26.194mm;
	left:147.902mm;
	border:0px solid;
	width: 143px;
	height: 24px;
}
#condicion {	
	position:absolute;
	top:129.381mm;
	left:160.602mm;
	border:0px solid;
	height: 20px;
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
function printer() 
{ 
vbPrintPage(); 
return false; 
} 

function defrente(){
	printer();
}

</script>
<body onLoad="defrente()"> 

<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>

<div id="contenedor">
  <div id="serie"><?php echo $doc ?> / <?php echo $serie ?>-<?php echo $numero ?></div>
<div id="partida"><?php echo strtoupper($dirPartida)."-".$empresa; ?></div>

<div id="llegada">
  <?php 
if($dirDestino==""){
	$dirDestino=$direc_aux;
}
echo strtoupper($dirDestino); 
?>
</div>
<div id="destino"><?php echo $nom_aux?></div>

<div id="referencia">
<?php echo $tip_docu_ref;?></div>
<div id="referencia2">
<?php echo $num_ref_ser."-".$num_ref_corr;?></div>
<div id="obs1">
<?php echo $obs1;?></div>

<div id="ruc">  
<?php echo $ruc_aux; ?></div>
<div id="trans_nom"><?php echo $nomtrans ?></div>
<div id="trans_ruc"><?php echo $ructrans; ?></div>
<div id="mar"><?php echo $marca." / ".$placa; ?></div>

<div id="lice"><?php echo $lic; ?></div>



<div id="detalle">
  <table width="654"  border="0" align="left" cellpadding="0" cellspacing="0">
    <tr>
      <td width="64" ><span class="Estilo7" style="visibility:hidden">DESCRP</span></td>
      <td colspan="2" >&nbsp;</td>
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
      <td height="20" align="left" valign="top"><span class="Estilo7">&nbsp;<?php echo $cant; ?></span></td>
      <td width="49" align="center" valign="top"><span class="Estilo7"><?php echo number_format($p_unit,2) ?></span></td>
      <td width="541" align="left" valign="top"><span class="Estilo7"><?php echo $unid?><?php echo $descripcion;?></span></td>
    </tr>
    <?php 
}



?>
    <tr>
      <td  colspan="25"><div align="left"></div></td>
    </tr>
  </table>
</div>
<div id="fecha2">
  <table width="148" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="58" align="center" valign="middle"><?php echo $dia_fech." - ";?></td>
      <td width="50" align="center" valign="middle"><?php echo $mes_fech." - ";?></td>
      <td width="40" align="center" valign="middle"><?php echo $año_fech;?></td>
    </tr>
  </table>
</div>
</div>
</body>

</html>

