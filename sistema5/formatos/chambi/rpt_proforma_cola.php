<?php 
session_start();
include ('../../conex_inicial.php'); 
include('../../numero_letras.php');


$empresa =  $_REQUEST['empresa'];
$doc=  $_REQUEST['doc'];
$serie =  $_REQUEST['serie'];
$numero =  $_REQUEST['numero'];


if($_REQUEST['codigoCab']==''){

$strSQL= "select * from cab_mov where sucursal='$empresa ' and cod_ope='$doc'  and serie='$serie' and Num_doc='$numero' " ;
}else{
$strSQL= "select * from cab_mov where cod_cab='".$_REQUEST['codigoCab']."' " ;
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
$numero=  $row ['Num_doc']; 
$serie= $row ['serie'];
$tcambio= $row ['tc']; 
$inc= $row ['incluidoigv'];
$doc=$row ['cod_ope'];
$empresa=$row ['sucursal'];

$fecha_emision1 = substr ($row ['fecha'],0,19); 
$f = explode("-",$fecha_emision1) ;

$dia_fech = substr ($f[2],0,2);
$mes_fech = $f[1];
$año_fech = substr ($f[0],0,4);
$hora = substr ($f[2],3,8);


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
//$m_dolares = $m_total * $t_cambio ;
//$m_soles = $m_total;

//else
//$m_dolares = $m_total;
//$m_soles = $m_total / $t_cambio ;

switch($moneda1)
{
case "01":
$m_soles = $m_total; 
$m_dolares = $m_total / $tcambio ;
$moneda = "S/.";
break;

case "02":
$m_dolares = $m_total  ;
$m_soles = $m_total * $tcambio; 
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
switch($inc)
{
case "S":
$incluido = "INCLUIDO IGV";
break;

case "N":
$incluido = "NO INCLUYEN EL IGV";
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
$cola1=$row_doc['cola'];
$cola2=$row_doc['cola2'];
$formato=$row_doc['formato'];
//echo $cola1;
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
-->
</style>

<style media="print">
.noprint     { display: none }
</style>
<style type="text/css">
<!--
.Estilo12 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 9px;
}
.Estilo13 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 9px;
}
.Estilo15 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 16;
}
.Estilo20 {font-size: 12px; font-family: Geneva, Arial, Helvetica, sans-serif; font-weight: bold; font-style: italic; }
.Estilo28 {
	font-size: 12px;
	font-family: Geneva, Arial, Helvetica, sans-serif;
}
.Estilo30 {font-size: 12px; font-family: Geneva, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
</head>



<script type="text/javascript" src="../../utilitarios/otros/npProlyam.js"></script> 
<script type="text/javascript" src="../../utilitarios/otros/jquery-1.4.4.js"></script> 
<script type="text/javascript" src="../../utilitarios/otros/activex.js"></script> 
 
 <?php 
 
  $temp=explode("\\\\",$cola1); 
	     // print_r($temp);
	//echo $cola1;	  
		  if(count($temp)>1){
		  $impresora="\\\\\\\\".$temp[2]."\\\\".$temp[4];
		  }else{
		  $impresora=$cola1;
		  }
	
	$temp2=explode("/",$formato);
	//print_r($temp2);
	if(count($temp2)>1){
	$url=$temp2[1];
	}else{
	$url=$formato;
	}
	/* 
	if(isset($_REQUEST['rpt_seg'])){
	$url=$formato;
	}else{
	$url=$formato;
	}
	*/
	$url="rpt_proforma_cola.php";
	$impresora="\\\\\\\\DESARROLLOWEB1\\\\Epson LX-300+";
 ?>
 
<script language="javascript">


 function PrintHTMLSample()
    {
	
	  var url="<?php echo $url.'?empresa='.$empresa.'&doc='.$doc.'&serie='.$serie.'&numero='.$numero.'&codigoCab='.$codigo ?>";
	  
	  var impresora="<?php echo $impresora ?>";
	// alert(url+ " -- " +impresora);
	  SaveHTML(url);
	   var objCola=objPlugin.PrintHTML( url, impresora);
	   //alert(objCola);	   
	   if(objCola=='OK'){
	   // window.close();
	   }	   
	   
	  // colocar la URL a imprimir
	  
      //objPlugin.PrintHTML(url,document.getElementById("printer").value);
	  
         
    }
	
	function cargarIni(){
	//objPlugin.getVersion();
	//alert(objPlugin.getPrinters());
	PrintHTMLSample();
	//document.getElementById('pc').innerHTML=objPlugin.getComputerName();
	//document.form1.usuario.focus();
	}	

</script>


<body onLoad="cargarIni()" >
<!--[if IE]>
    <object CLASSID="CLSID:D59F4895-9DEE-471E-B176-6E7FC9E01130"  
            id="plugin" 
            type="application/prolyam-plugin"  
            width="200" 
            height="50"  
			 style="visibility:hidden"
			>
    </object>
    
    <![endif]-->
    <!--[if !IE]> <!-->
    <object id="plugin" 
            type="application/prolyam-plugin"  
            width="200" 
            height="50"
			 style="visibility:hidden"
			 >
    </object>
    <!--<![endif]-->
<div id="installOK">

<table width="715" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="688" height="161">&nbsp;</td>
    <td width="27" colspan="3" valign="bottom"><table style="display:none" width="94%" height ="82" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2"><div style="visibility:hidden"  align="left">R.U.C. N&ordf; 20528334181 </div></td>
      </tr>
      <tr>
        <td colspan="2"><div style="visibility:hidden"  align="left">BOLETA DE VENTA  </div></td>
      </tr>
      <tr>
        <td width="31%"><div style="visibility:hidden"  align="left">N&quot; 001 - </div></td>
        <td width="69%"><div style="visibility:hidden"  align="left"></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="75" colspan="4" align="left" valign="top"><table width="750" height="210" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="21" colspan="3" >&nbsp;</td>
        <td width="273" align="center" class="Estilo3  Estilo15" >PROFORMA N&ordm;  <?php echo $serie ?>-<?php echo $numero; ?></td>
        <td colspan="3" align="center" >Lima <?php echo $dia_fech ?> de <?php echo $mes_letra?> del <?php echo $año_fech ?> &nbsp;&nbsp;&nbsp;<?php echo $hora;?></td>
        </tr>
      <tr>
        <td height="29" class="Estilo12">&nbsp;</td>
        <td class="Estilo12">&nbsp;</td>
        <td colspan="2" class="Estilo12">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td colspan="2" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td height="18" class="Estilo12">&nbsp;</td>
        <td class="Estilo28">EMPRESA / LOCAL:</td>
        <td colspan="5" class="Estilo28">&nbsp;</td>
        </tr>
      <tr>
        <td height="18" class="Estilo12">&nbsp;</td>
        <td class="Estilo28">&nbsp;</td>
        <td colspan="2" class="Estilo28">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td colspan="2" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td width="40" height="18" class="Estilo12">&nbsp;</td>
        <td width="114" class="Estilo28">NOMBRE : </td>
        <td colspan="2" class="Estilo28"><?php echo strtoupper($nom_aux) ?></td>
        <td width="173" align="right"><span class="Estilo28">VENDEDOR: </span></td>
        <td colspan="2" align="center"><span class="Estilo28"><?php echo strtoupper($responsable) ?></span></td>
        </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td height="20"><span  class="Estilo28">RUC :</span></td>
        <td colspan="2"><span class="Estilo28"><?php echo $ruc_aux?></span></td>
        <td class="Estilo12">&nbsp;</td>
        <td class="Estilo12">&nbsp;</td>
        <td class="Estilo12">&nbsp;</td>
      </tr>
      <tr>
        <td height="22" align="center">&nbsp;</td>
        <td height="22" align="left" class="Estilo28">DIRECCION:</td>
        <td height="22" colspan="3" align="left"><span class="Estilo7"><?php echo strtoupper($direc_aux) ?></span><span class="Estilo28">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
        <td width="90" >&nbsp;</td>
        <td width="54" valign="middle">&nbsp;</td>
      </tr>
      <tr>
        <td height="45" align="center">&nbsp;</td>
        <td height="45" colspan="5" align="left" class="Estilo28"><p class="Estilo28">Estimados Se&ntilde;ores:<br>
         Por medio de la presente hacemos llegar nuestro cordial saludo y a la vez la presente cotizaci&oacute;n que nos solicit&oacute;.<br>
         Con las Siguientes caracter&iacute;sticas:</p></td>
        <td valign="middle">&nbsp;</td>
      </tr>
      <tr>
        <td height="19" align="center">&nbsp;</td>
        <td height="19" colspan="5" align="left" class="Estilo28">&nbsp;</td>
        <td valign="middle">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="411" colspan="4" align="center" valign="top"><table width="86%" height="50"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td style= "border-top:#000000 solid 1px; border-bottom:#000000 solid 1px" width="55"  height="24" align="center" bordercolor="#000000" bgcolor="#ECE9D8" class="Estilo28"><span  align ="center"><span class="Estilo30">CANT</span></span></td>
       
        <td style= "border-top:#000000 solid 1px; border-bottom:#000000 solid 1px"  width="427" align="center" bordercolor="#000000" bgcolor="#ECE9D8" class="Estilo12"><span class="Estilo28" >DESCRIPCI&Oacute;N</span></td>
        <td style= "border-top:#000000 solid 1px; border-bottom:#000000 solid 1px"  width="78" align="center" bordercolor="#000000" bgcolor="#ECE9D8" class="Estilo12"><span class="Estilo28" >VALOR</span></td>
        <td  style= "border-top:#000000 solid 1px; border-bottom:#000000 solid 1px" width="85" align="center" bordercolor="#000000" bgcolor="#ECE9D8" class="Estilo12"><span class="Estilo28" > TOTAL </span></td>
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

$strSQL3= "select * from tienda where cod_suc = '".$empresa."' " ;
$resultado3 = mysql_query ($strSQL3,$cn);
$row3 = mysql_fetch_array ($resultado3);
$tienda= $row3 ['cod_tienda'];

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
        <td height="20" align="center" valign="middle" class="Estilo28"><span class="Estilo28">&nbsp; &nbsp;&nbsp; <?php echo $cant ?>&nbsp;&nbsp;&nbsp;</span></td>
        <td align="left" valign="middle" class="Estilo28"><?php echo $descripcion; ?>       </td>
        <td align="center" valign="middle" class="Estilo28"><span class="Estilo28"><?php echo $moneda ?>&nbsp;<?php echo number_format($p_unit,2) ?></span></td>
        <td align="center" valign="middle"  class="Estilo28" ><span class="Estilo28"><?php echo $moneda ?></span>&nbsp;<?php echo number_format($p_tot,2)?></td>
      </tr>
<?php 

}

?>	  
	  
      <tr>        </tr>
    </table></td>
  </tr>
  
   <tr>
    <td  height="12" colspan="4" valign="bottom" class="Estilo13">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
   
  
  
  
  <tr>
    <td  height="20" colspan="4" align="right"><table width="276" height="61"  border="0" cellpadding="1" cellspacing="0">
        <tr>
          <td width="139" height="31" align="right" valign="bottom" class="Estilo20">TOTAL DOLARES : </td>
          <td width="40" align="right" valign="bottom"class="Estilo20" >US$</td>
          <td align="center" valign="bottom"><span class="Estilo20"><?php echo number_format($m_dolares,2) ?></span></td>
        </tr>
        
        <tr>
          <td align="center" valign="middle" class="Estilo20">TOTAL  SOLES: </td>
          <td align="right" valign="middle" class="Estilo20">S/.</td>
          <td width="83" align="center" valign="middle"><span class="Estilo20"><?php echo number_format($m_soles,2) ?></span></td>
        </tr>
      </table>
      
      <table width="662" height="129" border="0" cellpadding="1" cellspacing="0">
        <tr>
          <td colspan="2" class="Estilo20">CONDICIONES GENERALES </td>
          </tr>
        <tr>
          <td width="121" height="20"><span class="Estilo28">LOS PRECIOS:</span></td>
          <td width="361"><span class="Estilo20"><?php echo $incluido ?></span></td>
        </tr>
        <tr>
          <td class="Estilo28">VALIDEZ DE LA OFERTA :</td>
          <td class="Estilo20"> 7 Dias </td>
        </tr>
        <tr>
          <td height="21" class="Estilo28">GARANTIA:</td>
          <td class="Estilo20">12 meses </td>
        </tr>
        <tr>
          <td height="20" colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td height="20" colspan="2"><span class="Estilo20">CUENTA CORRIENTE </span></td>
          </tr>
        <tr>
          <td height="17" class="Estilo20"> DOLARES:</td>
          <td class="Estilo20"></td>
        </tr>
        <tr>
          <td class="Estilo20">SOLES: </td>
          <td class="Estilo20"></td>
        </tr>
      </table>
     
      </td>
  </tr>
</table>

	
</div>




</body>
</html>
