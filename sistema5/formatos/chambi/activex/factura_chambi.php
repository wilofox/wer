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
$tienda=$row ['tienda']; 
$igv=$row ['igv'];
$impto=$row['impto1'];

$numero=  $row ['Num_doc']; 
$serie= $row ['serie'];
$doc=$row ['cod_ope'];
$empresa=$row ['sucursal'];

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
$cola1=$row_doc['cola'];
$cola2=$row_doc['cola2'];
$formato=$row_doc['formato'];


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
	top:21.167mm;
	left:152.929mm;
	border:0px solid;
	width: 98px;
	visibility: visible;
	height: 21px;
}
#responsable{
	position:absolute;
	top:51.329mm;
	left:15.081mm;
	border:0px solid;
	width: 352px;
	visibility: visible;
	height: 21px;
}

#cliente{
	position:absolute;
	top:39.158mm;
	left:14.552mm;
	height:18px;
	width:123.825mm;
	border:0px solid;
	visibility: visible;
}
#direccion{
	position:absolute;
	top:47.36mm;
	left:15.081mm;
	height:17px;
	width:125.412mm;
	border:0px solid;
	visibility: visible;
}

#ruc{
	position:absolute;
	top:56.356mm;
	left:15.61mm;
	height:17px;
	border:0px solid;
	visibility: visible;
}
#referencia{
	position:absolute;
	top:55.563mm;
	left:49.477mm;
	border:0px solid;
	height:20px;
	visibility: visible;
}
#layer2{
	position:absolute;
	top:64.029mm;
	left:49.212mm;
	border:0px solid;
	height:20px;
	visibility: visible;
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
	top:75.142mm;
	left:0.794mm;
	border:0px solid;
	width: 760px;
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
	top:240.242mm;
	left:44.185mm;
	border:0px solid;
	height:21px;
	vertical-align:baseline;
	visibility: visible;
	width: 585px;
}
#fecha{
	position:absolute;
	top:37.835mm;
	left:78.581mm;
	border:0px solid;
	width: 129px;
	visibility: visible;
	height: 22px;
}
#subtotal{
	position:absolute;
	top:252.677mm;
	left:34.131mm;
	border:0px solid;
	width: 20mm;
	text-align:right;
	visibility: visible;
}
#imp{
	position:absolute;
	top:252.677mm;
	left:140.229mm;
	border:0px solid;
	width: 20mm;
	text-align:right;
	visibility: visible;
}
#total{
	position:absolute;
	top:252.677mm;
	left:176.477mm;
	border:0px solid;
	width: 20mm;
	text-align:right;
	visibility: visible;
	height: 18px;
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
.Estilo11 {font-size: 12px}
.Estilo7 {font-size: 12px; font:Arial, Helvetica, sans-serif}
-->
</style>

</head>

<script type="text/javascript" src="../../utilitarios/npProlyam.js"></script> 
<script type="text/javascript" src="../../utilitarios/jquery-1.4.4.js"></script> 
<script type="text/javascript" src="../../utilitarios/activex.js"></script> 
 
 <?php 
 
  $temp=explode("\\\\",$cola1); 
	     // print_r($temp);
		  
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
 ?>
 
<script language="javascript">


 function PrintHTMLSample()
    {
	
	  
	  var url="<?php echo $url.'?empresa='.$empresa.'&doc='.$doc.'&serie='.$serie.'&numero='.$numero.'&codigoCab='.$codigo ?>";
	  
	  var impresora="<?php echo $impresora ?>";
	 // alert(url+ " -- " +impresora);
	   var objCola=objPlugin.PrintHTML( url, impresora);
	   //alert(objCola);
	   
	   if(objCola=='OK'){
	   // window.close();
	   }	   
	   
	  // colocar la URL a imprimir
	  //SaveHTML(url)
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

<!--<body onLoad="defrente()" >-->
<body onLoad="cargarIni()" >

<!--[if IE]>
    <object CLASSID="CLSID:D59F4895-9DEE-471E-B176-6E7FC9E01130"  
            id="plugin" 
            type="application/prolyam-plugin"  
            width="200" 
            height="50" 
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
<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>


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
  <table width="752" height="70"  border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td  height="10" colspan="3">&nbsp;</td>
      <td width="360" align="center">&nbsp;</td>
      <td width="84" align="center">&nbsp;</td>
      <td width="74" align="center">&nbsp;</td>
      <td  width="56">&nbsp;</td>
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
$codanexo1 = $row1 ['cod_prod']; 

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
      <td width="87" align="center" valign="top"><p class="Estilo7"><?php echo $P ?></p></td>
      <td width="32" align="left" valign="top"><span class="Estilo7"><?php echo $cant ?></span></td>
      <td width="59" align="left" valign="top"><span class="Estilo7"><?php echo $unid ?></span></td>
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
      <td align="center" valign="top"><?php echo $codanexo1?></td>
      <td align="center" valign="top"><span class="Estilo7">&nbsp;<?php echo number_format($p_unit,2) ?></span></td>
      <td align="right" valign="top"  class="Estilo7" >&nbsp;<?php echo number_format($p_tot,2)?></td>
    </tr>
    <?php 

}

?>
    <tr>
      <td height="19" colspan="9"><div align="left"></div></td>
    </tr>
  </table>
</div>

<div id="moneda_letras"><?php echo  strtoupper(num2letras($m_total)." ".$monedalet); ?></div>
<div id="fecha">

<table width="95" height="21" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="33" align="center" valign="middle"><?php echo $dia_fech;?> /</td>
      <td width="31" align="center" valign="middle"><?php echo $mes_fech;?> /</td>
      <td width="46" align="center" valign="middle">20<?php echo substr($año_fech,2,2);?></td>
    </tr>
  </table>

</div>
<div id="subtotal"><?php echo $moneda.number_format($m_bruto,2) ?></div>
<div id="imp"><?php echo $p_igv." ".$moneda. number_format( $igv,2) ?></div>
<div id="total"><?php echo $moneda.number_format($m_total,2) ?></div>


<div id="responsable"><?php echo $responsable ?></div>
<div id="fechaUdt"><?php echo gmdate('d-m-Y H:i:s',time()-18000) ?></div>
</body>
</html>