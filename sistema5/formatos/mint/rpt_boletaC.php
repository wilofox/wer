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


$fecha_emision1 = substr ($row ['fecha'],0,10); 

$f = explode("-",$fecha_emision1) ;



$dia_fech = $f[2];

$mes_fech = $f[1];

$año_fech = substr ($f[0],2,2);


$fecha_emision2 = substr ($row ['f_venc'],0,10); 
$f2 = explode("-",$fecha_emision2) ;
$dia_fech2 = $f2[2];
$mes_fech2 = $f2[1];
$anio_fech2 = substr ($f2[0],2,2);



$nom_aux3 = $row ['cod_vendedor']; 

$nom_aux4 = $row ['condicion']; 

$m_total = $row ['total']; 

 

$m_bruto  = $row ['b_imp']; 

$igv = $row ['igv']; 
$flete = $row ['flete']; 



$strSQL1= "select * from referencia where cod_cab = '".$codigo."' " ;

$resultado1 = mysql_query ($strSQL1,$cn);

$row = mysql_fetch_array ($resultado1);

$num_ref_cod = $row ['cod_ope']; 

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

//$ruc_aux = $row ['ruc']; 
$email_aux=$row ['email']; 
$telefono=$row ['telefono']; 

 

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

switch($mes_fech2)

 {

 

  	case "01":

    $mes_letra2 = "Enero";

	break;

	

	case "02":

    $mes_letra2 = "Febrero";

	break;

	

	case "03":

    $mes_letra2 = "Marzo";

	break;

	

	case "04":

    $mes_letra2 = "Abril";

	break;

	

	case "05":

    $mes_letra2 = "Mayo";

	break;

	

	case "06":

    $mes_letra2 = "Junio";

	break;

	

	case "07":

    $mes_letra2 = "Julio";

	break;

	

	case "08":

    $mes_letra2 = "Agosto";

	break;

	

	case "09":

    $mes_letra2 = "Setiembre";

	break;

	

	case "10":

    $mes_letra2 = "Octubre";

	break;

	

	case "11":

    $mes_letra2 = "Noviembre";

	break;

	

	case "12":

	$mes_letra2 = "Diciembre";

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
	top:114px;
	right:-110.86mm;
	border:0px solid;
	width: 160px;
}
#fecha{
	position:absolute;
	top:57.415mm;
	right:-123.031mm;
	border:0px solid;
	width: 185px;
	height: 23px;
}

#fechaVen{
	position:absolute;
	top:78.581mm;
	right:-129.117mm;
	border:0px solid;
	width: 185px;
	height: 23px;
}
#docReferencia{
	position:absolute;
	top:67.204mm;
	right:-120.65mm;
	border:0px solid;
	width: 185px;
	height: 30px;
}

#cliente{
	position:absolute;
	float:left;
	top:170px;
	left:131px;
	border:0px solid;
	width: 387px;
}
#direccion{
	position:absolute;
	top:255px;
	left:146px;
	border:0px solid;
	width: 379px;
}
#email{
	position:absolute;
	top:56.356mm;
	left:47.89mm;
	border:0px solid;
	width: 177px;
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
	top:167px;
	left:7px;
	border:0px solid;
	width: 874px;
}
#sec3{
position:relative;
height:20mm;
border:0px solid;
}
#total{
	position:absolute;
	float:left;
	top: 556px;
	right:-390px;
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
	top:297.127mm;
	left:24.077mm;
	border:0px solid;
	height:18px;
	vertical-align:baseline;
	width: 115px;
}
#tcatalogo{
	position:absolute;
	top:297.127mm;
	left:55.827mm;
	border:0px solid;
	height:18px;
	vertical-align:baseline;
	width: 115px;
}
#tcatalogo2{
	position:absolute;
	top:297.127mm;
	left:209.815mm;
	border:0px solid;
	height:18px;
	vertical-align:baseline;
	width: 47px;
}

#tdescuento{
	position:absolute;
	top:297.127mm;
	left:88.9mm;
	border:0px solid;
	height:18px;
	vertical-align:baseline;
	width: 115px;
}


#tcatmendesc{
	position:absolute;
	top:297.127mm;
	left:122.502mm;
	border:0px solid;
	height:18px;
	vertical-align:baseline;
	width: 115px;
}

#flete{
	position:absolute;
	top:297.127mm;
	left:154.517mm;
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
	top:278.871mm;
	left:26.987mm;
	border:0px solid;
	height:20px;
	vertical-align:baseline;
	width: 609px;
}
#telefono {	position:absolute;
	top:79.64mm;
	left:37.571mm;
	border:0px solid;
	height:18px;
	vertical-align:baseline;
	width: 280px;
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
<div id="fecha">
  <table width="165" height="20" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="60" align="center" valign="middle"><?php echo $dia_fech ?></td>
        <td width="60" align="center" valign="middle"><?php echo $mes_letra ?></td>
        <td width="60" align="center" valign="middle"> <?php echo $año_fech ?></td>
      </tr>
    </table>
</div>
<div id="fechaVen">
  <table width="187" height="20" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="55" align="center" valign="middle"><?php echo $dia_fech2 ?></td>
        <td width="78" align="center" valign="middle"><?php echo $mes_letra2 ?></td>
        <td width="54" align="center" valign="middle"> <?php echo $anio_fech2 ?></td>
      </tr>
    </table>
</div>


<div id="docReferencia">
 <?php echo $num_ref_cod; ?> / <?php echo $num_ref_ser; ?> - <?php echo $num_ref_corr; ?></div>

<div id="cliente"><?php echo strtoupper(caracteres($nom_aux)); ?></div>
<div id="direccion"><?php echo htmlspecialchars($direc_aux); ?></div>
<div id="email"><?php echo " ".$dni_aux ?></div>
</div>
<div id="sec2">
<div id="detalle">
  <table width="836"  border="0" align="left" cellpadding="0" cellspacing="0">

      <tr>
		<td align="center" width="218"><span style="visibility:hidden">Codigo</span></td>
        <td align="center" width="72"><span style="visibility:hidden">Cantidad</span></td>
        <td align="center" width="218"><span style="visibility:hidden">Descripcion</span></td>
		<td align="center" width="65"><span style="visibility:hidden">Descto</span></td>
		<td align="center" width="70"><span style="visibility:hidden">Precio unit.</span></td>
		<td align="center" width="106"><span style="visibility:hidden">unit con desc</span></td>
		<td align="center" width="87"><span style="visibility:hidden">sub total</span></td>
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
		$tcatalogo=$tcatalogo+($p_unit*$cant);		
		$tdescuento=$tdescuento+$desc;
		
		?>

      <tr>
	  	<td width="218"  align="center" valign="top"><?php echo $codAnexo1; ?></td>
        <td width="72"  align="center" valign="top"><?php echo $cant ?></td>
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
		<td width="65"  align="center" valign="top"><?php //echo number_format(($p_unit*$row['desc1']/100)*$cant,2) 
		echo $row['desc1']." % ";
		?></td>
        <td align="right" valign="top"><?php echo number_format($p_unit,2) ?></td>
		<td align="right" valign="top" class="Estilo7" ><?php echo number_format($p_unit-($p_unit*$row['desc1']/100),2) ?></td>
        <td align="right" valign="top" class="Estilo7" ><?php echo number_format($row['imp_item'], 2); ?></td>
      </tr>
<?php } ?>	  
      <tr><td height="19" colspan="6">&nbsp;</td></tr>
    </table>
</div>
</div>
<!--	Precio x descuento / 100	-->
<div id="sec3">
  <div id="total"><?php echo $moneda." ".number_format($m_total,2) ?></div>

</div>
</div>

<div id="telefono"><font class="Estilo7"><?php echo $telefono ?></font></div>
<div id="moneda_letras2"><?php echo  strtoupper(num2letras($m_total)." ".$monedalet); ?></div>
<!--<div id="fechaUdt"><font class="Estilo7"><?php //echo gmdate('d-m-Y H:i:s',time()-18000) ?></font></div>-->

<div id="totalCant"><font class="Estilo7"><?php echo $totalCant ?></font></div>
<div id="tcatalogo"><font class="Estilo7"><?php echo $moneda." ".number_format($tcatalogo,2) ?></font></div>
<div id="tcatalogo2"><font class="Estilo7"><?php echo number_format($puntos,2) ?></font></div>

<div id="tdescuento"><font class="Estilo7"><?php echo $moneda." ".number_format($tcatalogo-$m_total+$flete,2) ?></font></div>

<div id="tcatmendesc"><font class="Estilo7"><?php echo $moneda." ".number_format($tcatalogo-number_format($tcatalogo-$m_total+$flete,2),2) ?></font></div>
<div id="flete"><font class="Estilo7"><?php echo number_format($flete,2) ?></font></div>


</body>

</html>

