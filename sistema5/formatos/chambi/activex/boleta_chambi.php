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

$nom_aux3 = $row ['cod_vendedor']; 
$nom_aux4 = $row ['condicion']; 
$m_total = $row ['total']; 
 
$m_bruto  = $row ['b_imp']; 
$igv = $row ['igv']; 

$fecha_emision1 = substr ($row ['fecha'],0,10); 
$f = explode("-",$fecha_emision1) ;

$dia_fech = $f[2];
$mes_fech = $f[1];
$año_fech = substr ($f[0],0,4);


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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css">
*{
margin:0mm;
/*border:1mm;*/
padding:0mm 0mm;
font-size: 12px; 
font:Arial, Helvetica, sans-serif;

}

#responsable{
	position:absolute;
	top:23.548mm;
	left:140.229mm;
	border:0px solid;
	width: 216px;
	visibility: visible;
	height: 21px;
}
#contenedor{
position:relative;
top:0mm;
left:0mm;
width:168mm;
height:218mm;
border:0px solid;
}
#layer2{
	position:absolute;
	top:28.31mm;
	left:102.923mm;
	border:0px solid;
	height:20px;
	visibility: visible;
	width: 82px;
}
#sec1{
position:relative;
height:65mm;
border:0px solid;
}
#serie{
	position:absolute;
	top:5.292mm;
	left:143.933mm;
	border:0px solid;
	width: 149px;
}

#cliente{
	position:absolute;
	top:15.081mm;
	left:0.529mm;
	width:105.304mm;
	border:0px solid;
	height: 21px;
}
#direccion{
position:absolute;
top:23.548mm;
left:2.381mm;
width:106.098mm;
border:0px solid;
}

#ruc{
	position:absolute;
	top:15.081mm;
	left:70.908mm;
	border:0px solid;
	width: 242px;
	height: 21px;
}
#doc_iden{
	position:absolute;
	top:29.104mm;
	left:0.529mm;
	border:0px solid;
	width: 123px;
	height: 20px;
}
#referencia{
position:absolute;
top:56.356mm;
left:132.292mm;
border:0px solid;
}
#fecha2{
position:absolute;
top:10mm;
left:24mm;
border:0px solid;
}
#sec2{
position:relative;
height:60mm;
border:0px solid;
}
#detalle{
	position:absolute;
	top:37.835mm;
	left:-10.583mm;
	border:0px solid;
	width: 804px;
}
#sec3{
position:relative;
height:30mm;
border:0px solid;
}
#moneda_letras{
	position:absolute;
	top:170.127mm;
	left:28.31mm;
	border:0px solid;
	width: 485px;
	height: 25px;
}
#fecha{
position:absolute;
top:20mm;
left:24mm;
border:0px solid;
}
#subtotal{
position:absolute;
top:11.642mm;
left:103.188mm;

border:0px solid;
}
#imp{
position:absolute;
top:11.642mm;
left:110.331mm;
border:0px solid;
}
#total{
	position:absolute;
	top:179.652mm;
	left:151.606mm;
	border:0px solid;
	width: 87px;
	text-align: right;
	height: 26px;
}
#fechaUdt{
	position:absolute;
	top:7.938mm;
	left:-0.794mm;
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
body {
	margin-left: 0cm;
	margin-top: 0cm;
	margin-right: 0cm;
	margin-bottom: 0cm;
}
-->
</style>
</head>

<script type="text/javascript" src="../../utilitarios/npProlyam.js"></script> 
<script type="text/javascript" src="../../utilitarios/jquery-1.4.4.js"></script> 
<script type="text/javascript" src="../../utilitarios/activex.js"></script> 
 
 <?php 
 
  $temp=explode("\\\\",$cola1); 
	    // echo $cola1;
		  //print_r($temp);
		  
		  if(count($temp)>1){
		  $impresora="\\\\\\\\".$temp[1]."\\\\".$temp[2];
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
	  //alert(url+ " -- " +impresora);
	   var objCola=objPlugin.PrintHTML( url, impresora);
	 //  alert(url+ " -- " +impresora);
	   
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



<div id="serie"><span class="Estilo7"><?php echo $doc ?> / <?php echo $serie ?>-<?php echo $numero ?></span></div>

<div id="cliente"><span class="Estilo7"><?php echo utf8_encode($nom_aux); ?></span></div>
<div id="direccion"><span class="Estilo7"><?php echo utf8_encode($direc_aux)?></span></div>
<div id="ruc"> 
<table width="121" height="18" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="22" align="center" valign="middle"><span class="Estilo7"><?php echo $dia_fech;?></span></td>
	  <td width="34" align="center" valign="middle">/</td>
      <td width="31" align="center" valign="middle"><span class="Estilo7"><?php echo $mes_letra;?></span></td>
	  <td width="34" align="center" valign="middle">/</td>
      <td width="45" align="center" valign="middle"><span class="Estilo7">20<?php echo substr($año_fech,2,2);?></span></td>
    </tr>
  </table>
</div>
<div id="doc_iden"><span class="Estilo7"><?php echo $dni_aux ?></span></div>


<div id="detalle">
  <table width="723"  border="0" cellpadding="0" cellspacing="0">
    <tr>
	 <td width="75"  height="10">&nbsp;</td>
      <td width="34">&nbsp;</td>
      <td width="46"  height="10">&nbsp;</td>
      <td width="386" align="center">&nbsp;</td>
      <td width="64" align="center">&nbsp;</td>
      <td width="53" align="center">&nbsp;</td>
      <td  width="62">&nbsp;</td>
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
	<td align="right" valign="top"><p class="Estilo7"><?php echo $P ?></p></td>
      <td align="left" valign="top"><span class="Estilo7"><?php echo $cant ?></span></td>
      <td align="left" valign="top"><p class="Estilo7"><?php echo $unid ?></p></td>
      <td align="left" valign="top"><font class="Estilo7"><?php echo utf8_encode($descripcion);
		 if ($simanejaser == "S" )
				 {
		  		?><br> 
              <?php 
			  
		$acumulador="";
		
		while($row4=mysql_fetch_array($resultado4)){
		$acumulador=$acumulador.$row4 ['serie'].", ";
		}
		$acumulador=substr($acumulador,0,strlen($acumulador)-2);
		
		//echo $acumulador;

		
	echo "S/N:".$acumulador;
	 }
	 
	 ?>
      </font></td>
      <td align="right" valign="top"><?php echo $codanexo1?></td>
      <td align="right" valign="top"><span class="Estilo7">&nbsp;<?php echo number_format($p_unit,2) ?></span></td>
      <td align="left" valign="top"  class="Estilo7" >&nbsp;<?php echo number_format($p_tot,2)?></td>
    </tr>
    <?php 

}

?>
    <tr>
      <td height="19" colspan="8"></td>
    </tr>
  </table>
</div>

<div id="total"><span class="Estilo7"><?php echo $moneda.number_format($m_total,2) ?></span></div>

<div id="moneda_letras"><span class="Estilo7"><?php echo  strtoupper(num2letras($m_total)." ".$monedalet); ?></span></div>

<div id="fechaUdt"><span class="Estilo7"><?php echo gmdate('d-m-Y H:i:s',time()-18000) ?></span></div>
<div id="responsable"><span class="Estilo7"><?php echo $responsable ?></span></div>
<div id="layer2"> <span class="Estilo7"><?php echo $condicion ?></span></div>
<!--[if IE]>
    <object CLASSID="CLSID:D59F4895-9DEE-471E-B176-6E7FC9E01130"  
            id="plugin" 
            type="application/prolyam-plugin"  
            width="1" 
            height="1"  
			 style="visibility:hidden"
			>
    </object>
    
    <![endif]-->
    <!--[if !IE]> <!-->
    <object id="plugin" 
            type="application/prolyam-plugin"  
            width="1" 
            height="1"
			 style=" display:none"
			 >
    </object>
    <!--<![endif]-->


</body>
</html>
