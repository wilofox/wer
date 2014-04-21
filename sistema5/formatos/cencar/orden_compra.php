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
$vendedor=$row ['cod_vendedor']; 
 
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
//$año_fech = substr ($f[0],2,4);
$año_fech = $f[0];


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
$nom_contacto=$row ['contacto']; 
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
font-size: 12px; 
/*font:Arial, Helvetica, sans-serif;*/
font:dratf condensed;

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
	top:35.454mm;
	left:147.902mm;
	border:0px solid;
	width: 168px;
	visibility: visible;
}
#imagen{
	position:absolute;
	top:4.233mm;
	left:2.117mm;
	border:0px solid;
	width: 397px;
	visibility: visible;
	height: 101px;
}
#imagen2{
	position:absolute;
	top:9.79mm;
	left:113.242mm;
	border:0px solid;
	width: 243px;
	visibility: visible;
	height: 69px;
}
#cliente{
	position:absolute;
	top:53.181mm;
	left:27.781mm;
	height:18px;
	width:117.21mm;
	border:0px solid;
	visibility: visible;
}
#contacto{
	position:absolute;
	top:58.208mm;
	left:28.046mm;
	height:18px;
	width:117.21mm;
	border:0px solid;
	visibility: visible;
}
#direccion{
	position:absolute;
	top:64.294mm;
	left:28.31mm;
	height:17px;
	width:115.623mm;
	border:0px solid;
	visibility: visible;
}

#ruc{
	position:absolute;
	top:64.029mm;
	left:24.077mm;
	height:17px;
	border:0px solid;
	visibility: visible;
	width: 101px;
}
#referencia{
	position:absolute;
	top:55.827mm;
	left:147.637mm;
	border:0px solid;
	height:20px;
	visibility: visible;
	width: 70px;
}
#vendedor{
	position:absolute;
	top:169.598mm;
	left:114.035mm;
	border:0px solid;
	height:20px;
	visibility: visible;
	width: 141px;
}
#layer2{
	position:absolute;
	top:96.308mm;
	left:57.415mm;
	border:0px solid;
	height:20px;
	visibility: visible;
	width: 241px;
}

#fecha2{
position:absolute;
top:17.198mm;
left:118.004mm;
border:0px solid;
}
#sec2{
position:relative;
height:145mm;
border:0px solid;
}
#detalle{
	position:absolute;
	top:73.554mm;
	left:12.965mm;
	border:0px solid;
	width: 696px;
	visibility: visible;
	height: 218px;
}
#sec3{
position:relative;
height:40mm;
border:0px solid;
}
#moneda_letras{
	position:absolute;
	top:166.158mm;
	left:24.606mm;
	border:0px solid;
	height:21px;
	vertical-align:baseline;
	visibility: visible;
	width: 459px;
}
#fecha{
	position:absolute;
	top:46.037mm;
	left:23.283mm;
	border:0px solid;
	width: 334px;
	visibility: visible;
}
#subtotal{
	position:absolute;
	top:140.229mm;
	left:161.66mm;
	border:0px solid;
	width: 32.015mm;
	text-align:right;
	visibility: visible;
	height: 26px;
}
#imp{
	position:absolute;
	top:147.902mm;
	left:161.66mm;
	border:0px solid;
	width: 32.808mm;
	text-align:right;
	visibility: visible;
	height: 28px;
}
#total{
	position:absolute;
	top:155.575mm;
	left:161.131mm;
	border:0px solid;
	width: 32.808mm;
	text-align:right;
	visibility: visible;
	height: 26px;
}
</style>
<style media="print">
.noprint     { display: none }
</style>

<style type="text/css">
<!--
.Estilo7 {font-size: 14px; font:Arial, Helvetica, sans-serif}
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
<body  onLoad="defrente()" >
<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>


<div id="serie">
  <div align="center"><span style="font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:bold">ORDEN DE COMPRA</span><br>
    <?php echo $doc ?> / <?php echo $serie ?>-<?php echo $numero ?></div>
</div>
<div id="imagen"><img src="../../imagenes/LOGO_CENCAR.jpg" width="392" height="114"></div>
<div id="imagen2"><img src="../../imagenes/LOGO_CENCAR2.jpg" ></div>

<div id="cliente"><strong>Proveedor:</strong> <?php echo strtoupper($nom_aux); ?></div>
<div id="contacto"><strong>Contacto:</strong> <?php echo strtoupper($nom_contacto); ?></div>
<div id="direccion"><strong>Direcci&oacute;n:</strong> <?php echo $direc_aux?></div>
<?php /*?><div id="ruc"> 
<?php echo $ruc_aux; ?></div><?php */?>

<?php /*?><div id="referencia"><?php 
echo $tip_docu_ref."/".$num_ref_ser."-".$num_ref_corr ?></div><?php */?>
<!--
<div id="fecha2">
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="30" align="center" valign="middle"><?php //echo $dia_fech;?></td>
      <td width="30" align="center" valign="middle"><?php //echo $mes_letra;?></td>
      <td width="40" align="center" valign="middle"><?php //echo $año_fech;?></td>
    </tr>
  </table>
</div>
-->
<div id="detalle" style="vertical-align:top">
  <table width="699" height="412" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="4"><table width="695" height="216"  border="0" cellpadding="0" cellspacing="0" style="border:#000000 solid 1px">
        <tr>
          <td  height="25" rowspan="2"><strong>Item</strong></td>
          <td  height="25" rowspan="2">&nbsp;</td>
          <td  height="25" rowspan="2"><strong>Codigo P/N </strong></td>
          <td width="317" rowspan="2" align="center"><strong>Descripci&oacute;n</strong></td>
          <td rowspan="2" align="center"><strong>Qty</strong></td>
          <td rowspan="2" align="center"><strong>Unidad</strong></td>
          <td colspan="2" align="center"><strong>Precios</strong></td>
        </tr>
        <tr>
          <td align="center"><strong>Unitario</strong></td>
          <td  width="56" align="center"><strong>Parcial</strong></td>
        </tr>
        <?php 	  
$strSQL= "select * from det_mov where cod_cab= '".$codigo."'  order by cod_det" ;
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
$partnumber=$row1 ['cod_prod']; 
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
          <td width="27" height="45" align="center" valign="top"><p class="Estilo7"><?php echo $z;?></p>
              <span class="Estilo7"></span></td>
          <td width="10" align="left" valign="top">&nbsp;</td>
          <td width="79" align="left" valign="top"><?php echo $partnumber ?></td>
          <td align="left" valign="top"><?php echo $descripcion;
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
	 
	 ?>          </td>
          <td width="73" align="center" valign="top"><span class="Estilo7">&nbsp;</span><span class="Estilo7"><?php echo $cant ?></span></td>
          <td width="70" align="center" valign="top"><?php echo $unid?></td>
          <td width="61" align="center" valign="top"><span class="Estilo7"><?php echo number_format($p_unit,2) ?></span></td>
          <td align="center" valign="top"  class="Estilo7" >&nbsp;<?php echo number_format($p_tot,2)?></td>
        </tr>
        <?php 
		$z++;
		}
		?>
        <tr>
          <td height="16" align="center" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          <td align="right" valign="top">&nbsp;</td>
          <td align="right" valign="top"  class="Estilo7" >&nbsp;</td>
        </tr>
        <tr>
          <td height="18" align="center" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          <td colspan="2" align="right" valign="top"><strong>Sub Total: </strong><?php echo $moneda.number_format($m_bruto,2) ?></td>
        </tr>
        <tr>
          <td height="18" align="center" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          <td colspan="2" align="right" valign="top"><strong>Igv: </strong><?php echo $$impto."% ".$moneda. number_format( $igv,2) ?></td>
        </tr>
        <tr>
          <td height="27" align="center" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          <td colspan="2" align="right" valign="top"><strong>Total: </strong><?php echo $moneda.number_format($m_total,2) ?></td>
        </tr>
        
      </table></td>
    </tr>
    <tr>
      <td height="103" colspan="4"><table width="695" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="118" height="69">&nbsp;</td>
          <td width="214"><strong>Condiciones Comerciales</strong><br>
Moneda: <?php echo $monedalet;?> <br>
Forma de Pago: <?php echo $condicion ?> <br>
Plazo de Entrega : <?php echo "Inmediata"; ?></td>
          <td width="166">&nbsp;</td>
          <td width="169">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td width="174">&nbsp;</td>
      <td width="261">&nbsp;</td>
      <td width="203" align="center"><strong>Atentamente, </strong><br>
        <br>
        <?php echo $vendedor ?> <br>
Cencar S.A.C.
            proyectos01@cencarsac.com
            Centrar: 273-5136 / 272-1115
      Fax: 271-3314 </td>
      <td width="61">&nbsp;</td>
    </tr>
  </table>
</div>

<!--<div id="moneda_letras"><?php //echo  strtoupper(num2letras($m_total)." ".$monedalet); ?></div>-->
<div id="fecha">
  <table width="329" height="21" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="44" align="left" valign="middle"><strong>Fecha:</strong></td>
      <td width="44" align="left" valign="middle"><?php echo $dia_fech;?></td>
      <td width="129" align="center" valign="middle"><?php echo $mes_letra;?></td>
      <td width="79" align="center" valign="middle"><?php echo $año_fech;?></td>
    </tr>
  </table>
</div>
</body>
</body>
</html>
