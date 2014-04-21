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

$puntos=$row ['puntos'];

$dirPartida=$row ['dirPartida'];
$dirDestino=$row ['dirDestino']; 
 
$transportista=$row ['transportista'];

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

$año_fech = substr ($f[0],2,2);





$nom_aux3 = $row ['cod_vendedor']; 

$nom_aux4 = $row ['condicion']; 

$m_total = $row ['total']; 

 

$m_bruto  = $row ['b_imp']; 

$igv = $row ['igv']; 
$flete = $row ['flete']; 



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

	if($row ['ruc']==""){
	$ruc_aux = $row ['doc_iden']; 
	}else{
	$ruc_aux = $row ['ruc']; 
	}

$email_aux=$row ['email']; 

 

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



//if ($moneda1 = '01')

///($moneda = 'S/' );

//else	

//($moneda = 'US$');	



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
border:0mm;
padding:0mm 0mm;
font-size: 18px; 
font:Arial, Helvetica, sans-serif;

}
#contenedor{
position:relative;
top:0mm;
left:0mm;
width:100mm;
border:0px solid;
}
#sec1{
position:relative;
height:50mm;
border:0px solid;
}
#serie{
	position:absolute;
	top:125px;
	right:-127.265mm;
	border:0px solid;
	width: 194px;
}
#referencia{
	position:absolute;
	top:21px;
	right:-126.206mm;
	border:0px solid;
	width: 194px;
}
#fecha{
	position:absolute;
	top:54.504mm;
	right:-6.085mm;
	border:0px solid;
	width: 185px;
	height: 23px;
}
#cliente{
	position:absolute;
	float:left;
	top:159px;
	left:101px;
	border:0px solid;
	width: 387px;
}
#direccion{
	position:absolute;
	top:272px;
	left:107px;
	border:0px solid;
	width: 379px;
}
#rucCliente{
	position:absolute;
	top:65.881mm;
	left:203.729mm;
	border:0px solid;
	width: 131px;
	height: 12px;
}
#condicion{
	position:absolute;
	top:63.765mm;
	left:188.648mm;
	border:0px solid;
	width: 69px;
}

#sec2{
position:relative;
height:100mm;
border:0px solid;
}
#detalle{
	position:absolute;
	top:327px;
	left:7px;
	border:0px solid;
	width: 898px;
}
#sec3{
position:relative;
height:20mm;
border:0px solid;
}
#total{
	position:absolute;
	float:left;
	top: 679px;
	right:-453px;
	border:0px solid;
	width: 120px;
}
#fechaUdt{
	position:absolute;
	top:1.058mm;
	left:3.969mm;
	border:0px solid;
	width: 49.477mm;
	text-align:left;
	visibility: visible;
	height: 20px;
}
#moneda_letras{
	position:absolute;
	top:400px;
	left:18.256px;
	border:0px solid;
	height:18px;
	vertical-align:baseline;
	width: 471px;
}
#responsable{
	position:absolute;
	top:-43.656mm;
	left:16.933mm;
	border:0px solid;
	height:18px;
	vertical-align:baseline;
	width: 115px;
}

#totalCant{
	position:absolute;
	top:330.729mm;
	left:23.283mm;
	border:0px solid;
	height:18px;
	vertical-align:baseline;
	width: 115px;
}
#tcatalogo{
	position:absolute;
	top:330.729mm;
	left:60.854mm;
	border:0px solid;
	height:18px;
	vertical-align:baseline;
	width: 115px;
}
#tcatalogo2{
	position:absolute;
	top:331.258mm;
	left:217.752mm;
	border:0px solid;
	height:18px;
	vertical-align:baseline;
	width: 115px;
}
#tdescuento{
	position:absolute;
	top:330.729mm;
	left:99.483mm;
	border:0px solid;
	height:18px;
	vertical-align:baseline;
	width: 115px;
}


#tcatmendesc{
	position:absolute;
	top:330.729mm;
	left:139.965mm;
	border:0px solid;
	height:18px;
	vertical-align:baseline;
	width: 115px;
}
#flete{
	position:absolute;
	top:330.729mm;
	left:167.481mm;
	border:0px solid;
	height:18px;
	vertical-align:baseline;
	width: 115px;
}
#peso{
	position:absolute;
	top:338.667mm;
	left:56.356mm;
	border:0px solid;
	height:18px;
	vertical-align:baseline;
	width: 115px;
}

</style>
<style media="print">
	.noprint { display: none }
	body{ font-size:18px !important; }
</style>

<style type="text/css">
#moneda_letras2 {
	position:absolute;
	top:314.06mm;
	left:27.781mm;
	border:0px solid;
	height:20px;
	vertical-align:baseline;
	width: 609px;
}
#llegada {	position:absolute;
	top:79.64mm;
	left:148.96mm;
	width:90.223mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}
#partida {	position:absolute;
	top:25.135mm;
	left:39.952mm;
	width:108.215mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}
#destino {	position:absolute;
	top:52mm;
	left:6mm;
	width:75mm;
	text-indent:19mm;
	border:0px solid;
}
#destino {	position:absolute;
	top:16.14mm;
	left:37.835mm;
	width:105.833mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}
#lice {	position:absolute;
	top:43.127mm;
	left:151.606mm;
	width:27.517mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}
#mar {	position:absolute;
	top:42.333mm;
	left:46.302mm;
	width:27.517mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}
#pla {	position:absolute;
	top:43.127mm;
	left:91.81mm;
	width:27.517mm;
	text-indent:0mm;
	border:0px solid;
	height: 20px;
}

#trans_nom {	position:absolute;
	top:84.931mm;
	left:38.365mm;
	border:0px solid;
	width: 365px;
	height: 20px;
}
#trans_ruc {	position:absolute;
	top:85.46mm;
	left:202.671mm;
	border:0px solid;
	width: 135px;
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



<!--<script type="text/javascript" src="../javascript/colaimp.js"></script> -->



<script language="javascript">
	var pc = "<?php echo $_SESSION['pc_ingreso'] ?>";
	var cola = "<?php echo $cola?>";
	function printer() 
	{ 
		vbPrintPage(); 
		//window.print();
		//return false; 
	}
</script>

<!--onLoad="defrente()"-->
<body onLoad="printer()">


<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>
<div id="contenedor">
<div id="sec1">
<div id="serie"><?php echo $doc ?> / <?php echo $serie ?> - <?php echo $numero ?></div>
<div id="referencia"><?php echo $tip_docu_ref ?> / <?php echo $num_ref_ser ?> - <?php echo $num_ref_corr ?></div>

<div id="fecha">
  <table width="152" height="20" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="48" align="center" valign="middle"><?php echo $dia_fech ?></td>
        <td width="51" align="center" valign="middle"><?php echo $mes_letra ?></td>
        <td width="66" align="center" valign="middle"> <?php echo $año_fech ?></td>
      </tr>
    </table>
</div>



</div>
<div id="sec2">
<div id="detalle">
  <table width="887"  border="0" align="left" cellpadding="0" cellspacing="0">

      <tr>
		<td align="center" width="222"><span style="visibility:hidden">Codigo</span></td>
        <td align="center" width="101"><span style="visibility:hidden">Cantidad</span></td>
        <td align="center" width="219"><span style="visibility:hidden">Descripcion</span></td>
		<td align="center" width="77"><span style="visibility:hidden">Dscto</span></td>
		<td align="center" width="98"><span style="visibility:hidden">Precio unit.</span></td>
		<td align="center" width="73"><span style="visibility:hidden">unit con desc</span></td>
		<td align="center" width="97"><span style="visibility:hidden">sub total</span></td>
      </tr>

<?php
	$strSQL = "select * from det_mov where cod_cab= '".$codigo."' order by cod_det " ;
	$resultado = mysql_query ($strSQL,$cn);
	$tcatalogo=0;
	while ($row = mysql_fetch_array ($resultado)) {
		$cant = $row ['cantidad']; 
		$P =  $row ['cod_prod'];
		$descripcion =  $row ['nom_prod'];
		$p_unit = $row ['precio'];
		$p_tot = $cant * $p_unit;
		$desc = ($row['desc1'] * $p_tot ) / 100;
		$peso=$peso+$row ['peso']*$row ['cantidad'];		
		$strSQL1 = "select * from producto where idproducto= '".$P."' " ;
		$resultado1 = mysql_query ($strSQL1,$cn);
		$row1 = mysql_fetch_array ($resultado1);
		$u = $row1['und'];
		$codAnexo1=$row1['cod_prod'];
		 
		$cod_producto = $row1['idproducto']; 
		$simanejaser = $row1 ['series']; 
		$garantia = $row1 ['garantia']; 
		$strSQL2 = "select * from unidades where id = '".$u."' " ;
		$resultado2 = mysql_query($strSQL2,$cn);
		$row2 = mysql_fetch_array($resultado2);
		$unid= $row2['nombre'];
		$strSQL4 = "select * from series where producto='".$P."' and tienda='".$tienda."' and salida='".$codigo."'";
		$resultado4 = mysql_query ($strSQL4,$cn);
		
		$totalCant=$totalCant+$cant;
		$tcatalogo=$tcatalogo + $p_tot ;		
		$tdescuento=$tdescuento+$desc;
		
		?>

      <tr>
	  	<td width="222"  align="center" valign="top"><?php echo $codAnexo1 ?></td>
        <td width="101"  align="center" valign="top"><?php echo $cant ?></td>
        <td height="20" align="left" valign="top">
		<p class="Estilo7">
			<?php echo substr($descripcion,0,80);
			if ($simanejaser == "S" ){
				?><br><?php 
				$acumulador="";
				
				while($row4=mysql_fetch_array($resultado4)){
					$acumulador=$acumulador.$row4 ['serie'].", ";
				}
	
				$acumulador=substr($acumulador,0,strlen($acumulador)-2);
				echo "S/N:".$acumulador;
			}
			?>
        </p>		</td>
		<td width="77"  align="center" valign="top"><?php //echo number_format(($p_unit*$row['desc1']/100)*$cant,2) 
		echo $row['desc1']." % ";
		?></td>
        <td align="center" valign="top"><?php echo number_format($p_unit,2) ?></td>
		<td align="right" valign="top" class="Estilo7" ><?php echo number_format($p_unit-($p_unit*$row['desc1']/100),2) ?></td>
        <td align="right" valign="top" class="Estilo7" ><?php echo number_format($row['imp_item'], 2); ?></td>
      </tr>
<?php } ?>	  
      <tr><td height="19" colspan="6">&nbsp;</td></tr>
    </table>
</div>
<div id="partida"><?php echo strtoupper(htmlspecialchars($dirPartida)); ?></div>
<div id="destino"><?php echo caracteres($nom_aux)?></div>
<div id="lice"><?php echo $lic; ?></div>
<div id="mar"><?php echo $marca; ?></div>
<div id="pla"><?php echo $placa; ?></div>
</div>
<!--	Precio x descuento / 100	-->
<div id="sec3">
  <div id="total"><?php echo $moneda." ".number_format($m_total,2) ?></div>

</div>
</div>
<div id="rucCliente"><?php echo " ".$ruc_aux ?></div>
<div id="trans_ruc"><?php echo $ructrans; ?></div>
<div id="trans_nom"><?php echo htmlspecialchars($nomtrans) ?></div>
<div id="llegada">
  <?php 
if($dirDestino==""){
	$dirDestino=$direc_aux;
}
echo strtoupper(htmlspecialchars($dirDestino)); 
?>
</div>
<!--<div id="fechaUdt"><font class="Estilo7"><?php //echo gmdate('d-m-Y H:i:s',time()-18000) ?></font></div>-->

<div id="totalCant"><font class="Estilo7"><?php echo $totalCant ?></font></div>
<div id="tcatalogo"><font class="Estilo7"><?php echo $moneda." ".number_format($tcatalogo,2) ?></font></div>
<div id="tcatalogo2"><font class="Estilo7"><?php echo number_format($puntos,2) ?></font></div>

<div id="tdescuento"><font class="Estilo7"><?php echo $moneda." ".number_format($tcatalogo-$m_total+$flete,2) ?></font></div>

<div id="tcatmendesc"><font class="Estilo7"><?php echo $moneda." ".number_format($tcatalogo-number_format($tcatalogo-$m_total+$flete,2),2) ?></font></div>
<div id="flete"><font class="Estilo7"><?php echo number_format($flete,2) ?></font></div>



</body>

</html>

