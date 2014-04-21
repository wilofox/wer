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
font-size: 14px; 
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
	top:80px;
	right:-116.681mm;
	border:0px solid;
	width: 160px;
}
#fecha{
	position:absolute;
	top:13.494mm;
	right:-115.623mm;
	border:0px solid;
	width: 185px;
	height: 23px;
}

#fechaVen{
	position:absolute;
	top:73.29mm;
	right:-14.817mm;
	border:0px solid;
	width: 185px;
	height: 23px;
}
#docReferencia{
	position:absolute;
	top:58.737mm;
	right:-22.225mm;
	border:0px solid;
	width: 185px;
	height: 23px;
}

#cliente{
	position:absolute;
	float:left;
	top:72px;
	left:199px;
	border:0px solid;
	width: 387px;
}
#direccion{
	position:absolute;
	top:475px;
	left:79px;
	border:0px solid;
	width: 379px;
}
#email{
	position:absolute;
	top:29.369mm;
	left:30.692mm;
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
	top:140px;
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
	top: 490px;
	right:-357px;
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
	body{ font-size:14px !important; }
</style>

<style type="text/css">
#moneda_letras2 {
	position:absolute;
	top:281.781mm;
	left:26.987mm;
	border:0px solid;
	height:20px;
	vertical-align:baseline;
	width: 609px;
}
#telefono {	position:absolute;
	top:112.448mm;
	left:25.929mm;
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

  <table width="836"  border="0" align="left" cellpadding="0" cellspacing="0">

      <tr>
        <td height="135" colspan="8" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="33%">&nbsp;</td>
                <td width="36%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center"><strong>IMPORT &amp; SERVICE MIN E.I.R.L. </strong></td>
                  </tr>
                  <tr>
                    <td align="center">Av. 28 de julio N&ordm; 2738 - La Victoria </td>
                  </tr>
                  <tr>
                    <td align="center">Telf: 652-2950 Cel: 9888-54889 </td>
                  </tr>
                  <tr>
                    <td align="center">www.fourheartsperu.com</td>
                  </tr>
                </table></td>
                <td width="31%" align="center"><table width="214" height="42" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="center">Ruc: 20538459675<br> 
                      <strong>PROFORMA</strong> <br>
                    Serie: <?php echo $serie ?> <?php echo $numero ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="14%">NOMBRE</td>
                <td width="37%"><?php echo strtoupper(caracteres($nom_aux)); ?></td>
                <td width="6%">&nbsp;</td>
                <td width="21%">&nbsp;</td>
                <td width="22%">&nbsp;</td>
              </tr>
              <tr>
                <td>DNI/CODIGO</td>
                <td><?php echo " ".$dni_aux ?></td>
                <td>&nbsp;</td>
                <td>FECHA DE EMISION </td>
                <td><table width="165" height="20" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="60" align="center" valign="middle"><?php echo $dia_fech ?></td>
                    <td width="60" align="center" valign="middle"><?php echo $mes_letra ?></td>
                    <td width="60" align="center" valign="middle"><?php echo $año_fech ?></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td>DIRECCION</td>
                <td><?php echo strtoupper(htmlspecialchars($direc_aux)); ?></td>
                <td>&nbsp;</td>
                <td>GUIA</td>
                <td><?php echo $num_ref_cod; ?> / <?php echo $num_ref_ser; ?> - <?php echo $num_ref_corr; ?></td>
              </tr>
              <tr>
                <td>TELEFONO</td>
                <td><font class="Estilo7"><?php echo $telefono ?></font></td>
                <td>&nbsp;</td>
                <td>FECHA DE PAGO </td>
                <td><table width="187" height="20" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="55" align="center" valign="middle"><?php echo $dia_fech2 ?></td>
                    <td width="78" align="center" valign="middle"><?php echo $mes_letra2 ?></td>
                    <td width="54" align="center" valign="middle"><?php echo $anio_fech2 ?></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2" rowspan="2" align="center"><strong>Codigo</strong></td>
        <td width="110" rowspan="2" align="center"><strong>Cantidad</strong></td>
        <td width="94" rowspan="2" align="center"><strong>Descripcion</strong></td>
        <td width="94" rowspan="2" align="center"><strong>Descto</strong></td>
        <td align="center"><strong>Precio Cat </strong></td>
        <td align="center"><strong>Precio Cat </strong></td>
        <td align="center"><strong>Total</strong></td>
      </tr>
      <tr>
        <td align="center" width="111"><strong> unit.</strong></td>
		<td align="center" width="102"><strong>unit con desc</strong></td>
		<td align="center" width="114"><strong>sub total</strong></td>
      </tr>

<?php
	$strSQL = "select * from det_mov where cod_cab= '".$codigo."' " ;
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
	  	<td colspan="2"  align="center" valign="top"><?php echo $codAnexo1; ?></td>
        <td width="110"  align="center" valign="top"><?php echo $cant ?></td>
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
		<td width="94"  align="center" valign="top"><?php echo number_format(($p_unit*$row['desc1']/100)*$cant,2) ?></td>
        <td align="right" valign="top"><?php echo number_format($p_unit,2) ?></td>
		<td align="right" valign="top" class="Estilo7" ><?php echo number_format($p_unit-($p_unit*$row['desc1']/100),2) ?></td>
        <td align="right" valign="top" class="Estilo7" ><?php echo number_format($row['imp_item'], 2); ?></td>
      </tr>
<?php } ?>	  
      <tr>
        <td height="26" colspan="8" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td height="41" colspan="8" align="center"><strong>SOLO SE RECONOCE PAGOS REALIZADOS EN EL BANCO AUTORIZADO </strong></td>
      </tr>
      <tr>
        <td height="19" colspan="8" align="left"><strong>IMPORT &amp; SERVICE MIN EIRL</strong><br> 
          BANCO DE CREDITO CTA CTE SOLES : 191-1912438-0-54 <br>
          Despues de la fecha de vencimiento del monto total de la boleta estar&aacute; sujeto a intereses </td>
      </tr>
      <tr>
        <td width="95" height="19" align="center"><strong>Unid</strong></td>
        <td width="116" align="center"><strong>T.Catalogo</strong></td>
        <td height="19" align="center"><strong>Descuento</strong></td>
        <td height="19" colspan="2" align="center"><strong>Total Cat. Menos Dctos </strong></td>
        <td height="19" align="center"><strong>Flete</strong></td>
        <td height="19" align="center"><strong>Total a Pagar </strong></td>
        <td height="19" align="center"><strong>Puntos</strong></td>
      </tr>
      <tr>
        <td height="19" align="center"><font class="Estilo7"><?php echo $totalCant ?></font></td>
        <td align="center"><font class="Estilo7"><?php echo $moneda." ".number_format($tcatalogo,2) ?></font></td>
        <td height="19" align="center"><font class="Estilo7"><?php echo $moneda." ".number_format($tcatalogo-$m_total+$flete,2) ?></font></td>
        <td height="19" colspan="2" align="center"><font class="Estilo7"><?php echo $moneda." ".number_format($tcatalogo-number_format($tcatalogo-$m_total+$flete,2),2) ?></font></td>
        <td height="19" align="center"><font class="Estilo7"><?php echo number_format($flete,2) ?></font></td>
        <td height="19" align="center"><?php echo $moneda." ".number_format($m_total,2) ?></td>
        <td height="19" align="center"><font class="Estilo7"><?php echo number_format($puntos,2) ?></font></td>
      </tr>
    </table>


</body>

</html>

