<?php 
session_start();

include ('../../conex_inicial.php');
include('../../numero_letras.php');
//include('../../funciones/funciones.php');


$empresa =  $_REQUEST['empresa'];
$doc=  $_REQUEST['doc'];
$serie =  $_REQUEST['serie'];
$numero =  $_REQUEST['numero'];

	if(isset($_REQUEST['codcab'])){
	//$strcab		= 	"select * from cab_mov where cod_cab='".$_REQUEST['codcab']."' " ;
	$strcab		= 	"select * from cab_mov where cod_cab='".$_REQUEST['codcab']."' " ;
	$resultado	=   mysql_query($strcab,$cn);
	$row		=   mysql_fetch_array($resultado);	
	$empresa 	=  	$row['sucursal'];
	$doc	 	=  	$row['cod_ope'];
	$serie 	 	=  	$row['serie'];
	$numero  	=  	$row['Num_doc'];
	}
		
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

$impto1=$row ['impto1'];

$dirPartida=$row ['dirPartida'];
$dirDestino=$row ['dirDestino'];  

$transportista=$row ['transportista'];

$fecha_venc=$row ['f_venc'];



	$dat_trans=mysql_fetch_array(mysql_query("select * from transportista where id=".$transportista));
	$nomtrans=$dat_trans['nombre'];
	$ructrans=$dat_trans['ruc'];
	$marca=$dat_trans['marca'];
	$placa=$dat_trans['placa'];
	$lic=$dat_trans['lic_mtc'];
	$transp_direc=$dat_trans['direccion'];
	$cod_chofer=$dat_trans['chofer'];
	
	
	$dat_trans2=mysql_fetch_array(mysql_query("select * from chofer where cod='".$cod_chofer."'"));
	$nomChofer=$dat_trans2['nombre'];



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

$doc_referencia=$tip_docu_ref." ".$num_ref_ser."-".$num_ref_corr;




$strSQL1= "select * from cliente where codcliente = '".$nom_aux1."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$nom_aux = $row ['razonsocial']; 
$direc_aux =  $row ['direccion']; 
$dni_aux = $row ['doc_iden']; 
$ruc_aux = $row ['ruc']; 
$email_aux=$row ['email']; 
$ubigeo=$row ['ubigeo']; 


$strSQL1= "select * from ubigeo where id= '".$ubigeo."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);

$distrito = $row ['desdist']; 
$provincia = $row ['desprovi']; 
$departamento = $row ['desdepa']; 
  

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

$monedalet = "NUEVOS  SOLES";

break;



case "02":

$monedalet = "DOLARES "." "." "." AMERICANOS";

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
//$cola2=$row_doc['cola2'];
$formato=$row_doc['formato'];


				$strSQL="select * from docuser where pc='".$_SESSION['pc_ingreso']."' and usuario='".$_SESSION['codvendedor']."' and  doc='".$doc."' and tipomov='2' and empresa='".$empresa."' ";
			
			$resultado=mysql_query($strSQL,$cn);
			$row=mysql_fetch_array($resultado);
			$cola1=$row['cola'];
			$tcola=$row['tcola'];
			
			//echo $strSQL;			

if($dirDestino==""){
	$dirDestino=$direc_aux;
}


$direccion=$direc_aux;




list($fontsize,$altura,$fuente,$separacion,$anchodoc)=mysql_fetch_row(mysql_query("select fontsize,altura,fuente,separacion,anchodoc from formatos where doc='".$doc."' and sucursal='".$empresa."'"));

//echo $fontsize;

$sucursal=$empresa;

if($fuente=='1')$tfuente="Arial";
if($fuente=='2')$tfuente="Times New Roman";
if($fuente=='3')$tfuente="Verdana";
if($fuente=='4')$tfuente="Courier New";
if($fuente=='5')$tfuente="Draft Condensed";

//$separacion='5';

$fuenteTexto=$tfuente." ; letter-spacing: ".$separacion." px";
//$fuenteTexto="Arial, Helvetica, sans-serif;";
//$fuenteTexto="";
//$fuenteTexto="";
//echo "-->".$tcola;
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
font-size: 10px; 
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
	top:124px;
	right:-110.067mm;
	border:0px solid;
	width: 160px;
}
#fecha{
	position:absolute;
	top:47.36mm;
	right:-118.798mm;
	border:0px solid;
	width: 257px;
	height: 23px;
}
#cliente{
	position:absolute;
	float:left;
	top:218px;
	left:121px;
	border:0px solid;
	width: 488px;
	height: 24px;
}
#direccion{
	position:absolute;
	top:252px;
	left:120px;
	border:0px solid;
	width: 491px;
}
#email{
	position:absolute;
	top:56.885mm;
	left:30.162mm;
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
	top:313px;
	left:80px;
	border:0px solid;
	width: 758px;
}
#sec3{
position:relative;
height:20mm;
border:0px solid;
}
#total{
	position:absolute;
	float:left;
	top: 27px;
	right:-485px;
	border:0px solid;
	text-align:center;
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
	top:-51.329mm;
	left:18.256mm;
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
</style>
<style media="print">
	.noprint { display: none }
	body{ font-size:10px !important;font:Arial, Helvetica, sans-serif, Times, serif !important; }
</style>

<style type="text/css">
#moneda_letras2 {
	position:absolute;
	top:146.05mm;
	left:33.337mm;
	border:0px solid;
	height:27px;
	vertical-align:baseline;
	width: 608px;
}
</style>
</head>


<?php /*?><SCRIPT LANGUAGE="VBScript"> 
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
</SCRIPT> <?php */?>

<script type="text/javascript" src="../javascript/colaimp.js"></script> 
<script type="text/javascript" src="../../utilitarios/otros/npProlyam.js"></script> 
<script type="text/javascript" src="../../utilitarios/otros/jquery-1.4.4.js"></script> 
<!--<script type="text/javascript" src="../../utilitarios/otros/activex.js"></script> -->

<script language="javascript">
 var  objPlugin = new  npPlugin("plugin");
 </script>
 <?php 
 	
	//echo $cola1;
	
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
	//$url="rpt_proforma_cola.php";
	//$impresora="\\\\\\\\DESARROLLOWEB1\\\\Epson LX-300+";
	
	//$impresora=$cola1;
 ?>
 
<script language="javascript">


 function PrintHTMLSample()
    {
	
	  var url="<?php echo $url.'?empresa='.$empresa.'&doc='.$doc.'&serie='.$serie.'&numero='.$numero.'&codigoCab='.$codigo ?>";
	  
	  var impresora="<?php echo $cola1 ?>";
	  
	  //SaveHTML(url);
	 // var objCola=objPlugin.PrintHTML( url, impresora);
	  
	 //alert(url+ " -- " +impresora);
	//alert(impresora);
	 	/*
	   SaveHTML(url);
	   var objCola=objPlugin.PrintHTML( url, impresora);
	   //alert(objCola);	   
	   if(objCola=='OK'){
	   // window.close();
	   }	   
		*/
		
		//objPlugin.PrintHTML( url, impresora, "<?php echo $altura.'|'.$anchodoc ?>");
		
		//alto, ancho, vertical u horizontal, nro copias) 
	//   objPlugin.PrintHTML( url, impresora, "1395"); 
	   //alert(objCola);	   
	   //if(objCola=='OK'){
	   // window.close();
	   //}
	   //objPlugin.SaveHTML(url);
	 //  objPlugin.PrintHTML( url,impresora,"1500");	   
	  // colocar la URL a imprimir	  
      //objPlugin.PrintHTML(url,document.getElementById("printer").value);	  
         
    }
	
	function cargarIni(){
	//objPlugin.getVersion();
	//alert(objPlugin.getPrinters());
	//PrintHTMLSample();
	//document.getElementById('pc').innerHTML=objPlugin.getComputerName();
	//document.form1.usuario.focus();
	var tcola="<?php echo $tcola ?>";
		
		//alert(tcola);
		if(tcola=='1'){
		//vbPrintPage();
		}else{
		//alert();
		PrintHTMLSample();
		}
		
	}	

</script>

<!--onLoad="defrente()"-->
<body onLoad="cargarIni()">

<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>


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

<!--<div id="contenedor" style=" position:absolute; left:0; top:0; width:600px; height:900px">-->



<?php 


$strSQL="select coordx,coordy,alto,ancho,habilitar,descripcion from formatos where doc='".$doc."' and sucursal='".$empresa."'";
//echo $strSQL
$resultrado=mysql_query($strSQL,$cn);
while($row=mysql_fetch_array($resultrado)){

$habilitar[]=$row['habilitar'];
$ancho[]=$row['ancho'];
$alto[]=$row['alto'];
$coordx[]=$row['coordx'];
$coordy[]=$row['coordy'];
$descripcion2[]=$row['descripcion'];

}
//print_r($habilitar); echo "<br>";

?>

<?php
$pos=array_search('fec_dd_mm_aaaa', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>"><?php echo $dia_fech." / ".$mes_fech." / ".$año_fech; ?></div>


<?php
$pos=array_search('fec_venc', $descripcion2);
if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>"><?php echo $fecha_venc; ?></div>


<?php
$pos=array_search('fec_dd_mm_aaaa2', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>"><?php echo $dia_fech." / ".$mes_fech." / ".$año_fech; ?></div>



<?php 
$pos=array_search('fecEmi_dia', $descripcion2);

 if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>"><?php echo strtoupper($dia_fech); ?></div>

<?php

$pos=array_search('fecEmi_mes', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ;display:<?php echo $display?> "><?php echo strtoupper($mes_letra); ?></div>

<?php 
$pos=array_search('fecEmi_anio', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>"><?php echo strtoupper($año_fech); ?></div>


<?php 
$pos=array_search('b_imp', $descripcion2);
//echo "-->".$habilitar[$pos]."-->".$pos; 
if($habilitar[$pos]=='S'){$display='block'; }else{ $display='none';} ?>

<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo number_format($m_bruto,2); ?></div>


<?php 
$pos=array_search('b_imp2', $descripcion2);
//echo "-->".$habilitar[$pos]."-->".$pos; 
if($habilitar[$pos]=='S' && $pos!=''){$display='block'; }else{ $display='none';} ?>

<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo number_format($m_bruto,2); ?></div>




<?php 
$pos=array_search('igv', $descripcion2);
if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo number_format($igv,2); ?></div>

<?php 
$pos=array_search('total', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo number_format($m_total,2); ?></div>


<?php 
$pos=array_search('moneda1', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $moneda; ?></div>

<?php 
$pos=array_search('moneda2', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $moneda; ?></div>


<?php 
$pos=array_search('moneda3', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $moneda; ?></div>


<?php 
$pos=array_search('moneda4', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $moneda; ?></div>


<?php 
$pos=array_search('total_letras', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left"><?php echo strtoupper(num2letras($m_total)." ".$monedalet) ?></div>

<?php 
$pos=array_search('direc_origen', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left"><?php echo strtoupper(htmlspecialchars($dirPartida)); ?></div>

<?php 
$pos=array_search('transp_nombre', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left"><?php echo htmlspecialchars($nomtrans); ?></div>

<?php  
$pos=array_search('transp_ruc', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $ructrans; ?></div>

<?php 
$pos=array_search('transp_lice', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $lic; ?></div>

<?php 
$pos=array_search('transp_marca', $descripcion2); 

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $marca; ?></div>

<?php 
$pos=array_search('transp_placa', $descripcion2);  

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $placa; ?></div>


<?php 
$pos=array_search('transp_direc', $descripcion2);  

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $transp_direc; ?></div>


<?php 
$pos=array_search('chofer_nombre', $descripcion2);  

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $nomChofer; ?></div>


<?php 
$pos=array_search('fec_auditoria', $descripcion2);  

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo gmdate('d-m-Y H:i:s',time()-18000); ?></div>

<?php 
$pos=array_search('porcen_simb', $descripcion2); 
//echo $habilitar[$pos]; 
if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo "%" ?></div>

<?php 
$pos=array_search('porcen_valor', $descripcion2); 


//echo "--->".$pos;
if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $impto1 ?></div>


<?php 
$pos=array_search('dni', $descripcion2); 
//echo "--->".$pos;
if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $dni_aux ?></div>

<?php 
$pos=array_search('obs1', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $obs1 ?></div>

<?php 
$pos=array_search('obs2', $descripcion2);

if($habilitar[$pos]=='S')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $obs2 ?></div>

<?php 
$pos=array_search('obs3', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $obs3 ?></div>

<?php 
$pos=array_search('obs4', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $obs4 ?></div>

<?php
$pos=array_search('obs5', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $obs5 ?></div>

<?php 
$pos=array_search('cond_pago', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left"><?php echo $condicion ?></div>

<?php 
$pos=array_search('doc_referencia', $descripcion2);

if($habilitar[$pos]=='S')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $doc_referencia ?></div>

<?php 
$pos=array_search('razonsocial', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left"><?php echo strtoupper($nom_aux) ?></div>

<?php 
$pos=array_search('direccion', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left"><?php echo strtoupper($direccion) ?></div>

<?php 
$pos=array_search('direccion2', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left"><?php echo strtoupper($dirDestino) ?></div>

<?php 
$pos=array_search('direc_completa', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left"><?php echo strtoupper($dirDestino." - ".$distrito." - ".$provincia." - ".$departamento) ?></div>


<?php 
$pos=array_search('ruc', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo strtoupper($ruc_aux) ?></div>


<?php 
$pos=array_search('cod_ope', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo strtoupper($doc) ?></div>

<?php 
$pos=array_search('serie', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo strtoupper($serie) ?></div>

<?php 
$pos=array_search('num_doc', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='' )$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo strtoupper($numero) ?></div>

<?php 
$pos=array_search('responsable', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo strtoupper($responsable) ?></div>


<?php 
$pos=array_search('distrito', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo strtoupper($distrito) ?></div>


<?php 
$pos=array_search('provincia', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo strtoupper($provincia) ?></div>


<?php 
$pos=array_search('departamento', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo strtoupper($departamento) ?></div>


<?php 
$pos=array_search('son', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo "SON: "; ?></div>


<?php 
$pos=array_search('condicion', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $condicion; ?></div>

<!------------------------------------------------------------------------------------------------>


	  <?php 	  
	  
	  list($coordx1,$coordy1,$alto1,$ancho1,$habilitar1)=mysql_fetch_row(mysql_query("select coordx,coordy,alto,ancho,habilitar from formatos where doc='".$doc."' and descripcion='cod_prod' and sucursal='".$empresa."'"));if($habilitar1=='S')$display1='block'; else $display1='none';
	   
  	  list($coordx2,$coordy2,$alto2,$ancho2)=mysql_fetch_row(mysql_query("select coordx,coordy,alto,ancho from formatos where doc='".$doc."' and descripcion='nombre'  and sucursal='".$empresa."'")); 
	  
 	  list($coordx3,$coordy3,$alto3,$ancho3,$habilitar3)=mysql_fetch_row(mysql_query("select coordx,coordy,alto,ancho,habilitar from formatos where doc='".$doc."' and descripcion='cantidad'  and sucursal='".$empresa."' "));if($habilitar3=='S')$display3='block'; else $display3='none'; 
	  
	  list($coordx4,$coordy4,$alto4,$ancho4,$habilitar4)=mysql_fetch_row(mysql_query("select coordx,coordy,alto,ancho,habilitar from formatos where doc='".$doc."' and descripcion='und'  and sucursal='".$empresa."'"));if($habilitar4=='S')$display4='block'; else $display4='none';
	  
  	  list($coordx5,$coordy5,$alto5,$ancho5,$habilitar5)=mysql_fetch_row(mysql_query("select coordx,coordy,alto,ancho,habilitar from formatos where doc='".$doc."' and descripcion='precio'  and sucursal='".$empresa."'"));if($habilitar5=='S')$display5='block'; else $display5='none';
	  
	  list($coordx6,$coordy6,$alto6,$ancho6,$habilitar6)=mysql_fetch_row(mysql_query("select coordx,coordy,alto,ancho,habilitar from formatos where doc='".$doc."' and descripcion='imp_item'  and sucursal='".$empresa."'"));if($habilitar6=='S')$display6='block'; else $display6='none';
	  
	   list($coordx7,$coordy7,$alto7,$ancho7,$habilitar7)=mysql_fetch_row(mysql_query("select coordx,coordy,alto,ancho,habilitar from formatos where doc='".$doc."' and descripcion='serieprod'  and sucursal='".$empresa."'"));if($habilitar7=='S')$display7='block'; else $display7='none';
	   
	    list($coordx8,$coordy8,$alto8,$ancho8,$habilitar8)=mysql_fetch_row(mysql_query("select coordx,coordy,alto,ancho,habilitar from formatos where doc='".$doc."' and descripcion='conta_items'  and sucursal='".$empresa."'"));if($habilitar8=='S')$display8='block'; else $display8='none';
		
		list($coordx9,$coordy9,$alto9,$ancho9,$habilitar9)=mysql_fetch_row(mysql_query("select coordx,coordy,alto,ancho,habilitar from formatos where doc='".$doc."' and descripcion='desc1'  and sucursal='".$empresa."'"));if($habilitar9=='S')$display9='block'; else $display9='none';
	   
	   
	  // echo $display7;
$conta_items=0;	  
$strSQL= "select * from det_mov where cod_cab= '".$codigo."' ORDER BY cod_det " ;
$resultado = mysql_query ($strSQL,$cn);
while ($row = mysql_fetch_array ($resultado)) {
$cant= $row ['cantidad']; 
$P =  $row ['cod_prod'];
$descripcion =  $row ['nom_prod'];
$p_unit = $row ['precio'];
$p_tot = $cant * $p_unit;
$u = $row ['unidad']; 
$codmodel=$row['cod_model'];	  

$conta_items++;

$strSQL4="select * from modelo where cod_prod='".$P."' ";
//echo $strSQL4;
$resultado4=mysql_query($strSQL4,$cn);
$contModel=mysql_num_rows($resultado4);
$row4=mysql_fetch_array($resultado4);

if($contModel > 0){
$modo_imp=$row4['modo_imp'];
}

/*					
if($modo_imp=='2'){
//continue;
}
*/

//**************************************************** modo impresion 1*************************************


if($modo_imp=='1' || $modo_imp=='4' ){

$strSQL1= "select * from producto where idproducto= '".$P."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row1 = mysql_fetch_array ($resultado1);

$cod_producto=$row1 ['idproducto']; 
$simanejaser = $row1 ['series']; 
$garantia= $row1 ['garantia']; 
$esmodelo=$row1 ['modelo']; 

$carac=$row1 ['datos']; 

/*
if($contModel>0){
$tempCodModel=$P;
}else{
	
	if($codmodel!=''){
	
	}else{
	$tempCodModel="";
	}

}

*/


if($row1['campo_imp']=='cod_prod'){
$descripcion =  $row1 ['cod_prod'];
}
if($row1['campo_imp']=='codanex2'){
$descripcion =  $row1 ['codanex2'];
}
if($row1['campo_imp']=='codanex3'){
$descripcion =  $row1 ['codanex3'];
}


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

if($cod_cab_ref1==''){
$tempCodigoSerie=$codigo;
}else{
$tempCodigoSerie=$cod_cab_ref1;
}


$strSQL4="select * from series where producto='".$P."' and tienda='".$tienda."' and salida='".$tempCodigoSerie."'";
$resultado4 = mysql_query ($strSQL4,$cn);

//echo $strSQL4;
//$row4 = mysql_fetch_array ($resultado4);
//$acumulador = $row4 ['serie'];
//$acumulador = $row4 ['serie'].",";
//*********************************

//while($row=mysql_fetch_array($resultado4)){
//$acumulador=$acumulador.$row['serie'].", ";
//}
//$acumulador=substr($acumulador,0,strlen($acumulador)-2);
//echo $acumulador;
	  ?>
	  	
		<?php 
		if($codmodel==''){
		?>				
		<div style="width:<?php echo $ancho1?> ; height:<?php echo $alto1?> ; left:<?php echo $coordx1?> ; top:<?php echo $coordy1?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display1?>; text-align:left  "><?php if($P!="TEXTO") echo strtoupper($P); ?></div>
		<?php  $coordy1=$coordy1+20?>
		
		<?php
		if($modo_imp=='4' && $esmodelo=='S'){
		$descripcion="";		
		}
		
		?>
		
		<div style="width:<?php echo $ancho2?> ; height:<?php echo $alto2?> ; left:<?php echo $coordx2?> ; top:<?php echo $coordy2?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; text-align:left ;  "><?php echo substr($descripcion,0,50); ?></div>
		<?php  $coordy2=$coordy2+20
		
		?>
		
		<div style="width:<?php echo $ancho3?> ; height:<?php echo $alto3?> ; left:<?php echo $coordx3?> ; top:<?php echo $coordy3?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display3?>"><?php if($cant!=0)echo $cant; 	?></div>		
		<?php  $coordy3=$coordy3+20
			
		?>
				
		<div style="width:<?php echo $ancho4?> ; height:<?php echo $alto4?> ; left:<?php echo $coordx4?> ; top:<?php echo $coordy4?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display4?>"><?php  
	
		if($unid!="") echo strtoupper($unid); 
		
		?></div>
		<?php  $coordy4=$coordy4+20?>
		
		<div style="width:<?php echo $ancho5?> ; height:<?php echo $alto5?> ; left:<?php echo $coordx5?> ; top:<?php echo $coordy5?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display5?>; text-align:right"><?php 
		
		
		if($p_unit!=0) echo number_format($p_unit,2);
		
		 ?></div>
		<?php  $coordy5=$coordy5+20?>
				
		<div style="width:<?php echo $ancho6?> ; height:<?php echo $alto6?> ; left:<?php echo $coordx6?> ; top:<?php echo $coordy6?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display6?>; text-align:right "><?php  
		
	
			echo $m_total;
			
		
		//if($p_tot!=0) echo number_format($p_tot,2); 
		//echo $m_total;
		
		
		
		?></div>
		<?php  $coordy6=$coordy6+20?>
		
		<div style="width:<?php echo $ancho8?> ; height:<?php echo $alto8?> ; left:<?php echo $coordx8?> ; top:<?php echo $coordy8?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display8?>; text-align:right "><?php  echo number_format($conta_items); ?></div>
		<?php  $coordy8=$coordy8+20?>
		
		<div style="width:<?php echo $ancho9?> ; height:<?php echo $alto9?> ; left:<?php echo $coordx9?> ; top:<?php echo $coordy9?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display9?>; text-align:right "><?php  echo ($desc1*100)." %"; ?></div>
		<?php  $coordy9=$coordy9+20?>
		
					
		<?php 
		
		

		 if ($simanejaser == "S" )
		 {
			$acumulador="";
			$contSerie=0;
			$switch='F';
			
			while($row4=mysql_fetch_array($resultado4)){
			$acumulador=$acumulador.$row4 ['serie'].", "; 
			//echo "--->$acumulador";
			$contSerie++;			
			
			
				if(fmod($contSerie,2)==0){	
				
				//$acumulador=substr($acumulador,0,strlen($acumulador)-2);	
				
				$coordy7=$coordy2;
			?>
				
				
				<div style="width:<?php echo $ancho7?> ; height:<?php echo $alto7?> ; left:<?php echo $coordx7?> ; top:<?php echo $coordy7?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display7?>; text-align:left;"><?php echo "S/N : ".$acumulador; ?></div>
			<?php  
			
			$coordy1=$coordy1+20;
			$coordy2=$coordy2+20;
			$coordy3=$coordy3+20;
			$coordy4=$coordy4+20;
			$coordy5=$coordy5+20;
			$coordy6=$coordy6+20;
			$coordy7=$coordy7+20;
			$coordy8=$coordy8+20;
			$coordy9=$coordy9+20;
			
			
			$acumulador="";
			$switch='T';
			
			?>
			
			<?php 
				 }
				
			 }//while
		  
		  //echo "---->".$acumulador;	
			$acumulador=substr($acumulador,0,strlen($acumulador)-2);	
			//echo "------------------>".$acumulador;	
			
			if($acumulador!=''){
			
				if($switch=='F'){
				//echo "--->";
				$coordy7=$coordy2;
				}
		  ?>
				
				<div style="width:<?php echo $ancho7?> ; height:<?php echo $alto7?> ; left:<?php echo $coordx7?> ; top:<?php echo $coordy7?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display7?>; text-align:left; "><?php echo "S/N : ".$acumulador; ?></div>
			<?php  
			
			$coordy1=$coordy1+20;
			$coordy2=$coordy2+20;
			$coordy3=$coordy3+20;
			$coordy4=$coordy4+20;
			$coordy5=$coordy5+20;
			$coordy6=$coordy6+20;
			$coordy8=$coordy8+20;
			$coordy9=$coordy9+20;
			
			//$coordy7=$coordy7+25;
			$acumulador="";
			}
			?>
			
			
		
		<?php 
	//echo $acumulador;
		//echo "S/N:".$acumulador;
		}//if
		
		}
		?>
		
		
		<?php  
		
		//echo $carac;
		
		$divisor=70;
		$dividendo=strlen($carac);
		$cociente=$dividendo / $divisor;
		$residuo=$dividendo % $divisor;
		
		for($k1=0;$k1<$cociente;$k1++){			
		
		$cadena_imp=substr($carac,$divisor*$k1,$divisor);
		
		?>
		
		<div style="width:<?php echo $ancho2?> ; height:<?php echo $alto2?> ; left:<?php echo $coordx2?> ; top:<?php echo $coordy2?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; text-align:left ;  "><?php echo $cadena_imp; ?></div>
		
		
		<?php 
			$coordy1=$coordy1+20;
			$coordy2=$coordy2+20;
			$coordy3=$coordy3+20;
			$coordy4=$coordy4+20;
			$coordy5=$coordy5+20;
			$coordy6=$coordy6+20;
			$coordy8=$coordy8+20;
			$coordy9=$coordy9+20;
		}
		?>
		
		
		<?php 
		

// fin modo imp1
}else{	
//***************************************************************************************************************
	//echo "--->".$modo_imp;
	if($modo_imp=='2'){
	
$strSQL1= "select * from producto where idproducto= '".$P."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row1 = mysql_fetch_array ($resultado1);

$cod_producto=$row1 ['idproducto']; 
$simanejaser = $row1 ['series']; 
$garantia= $row1 ['garantia']; 

/*
if($contModel>0){
$tempCodModel=$P;
}else{
	
	if($codmodel!=''){
	
	}else{
	$tempCodModel="";
	}

}

*/


if($row1['campo_imp']=='cod_prod'){
$descripcion =  $row1 ['cod_prod'];
}
if($row1['campo_imp']=='codanex2'){
$descripcion =  $row1 ['codanex2'];
}
if($row1['campo_imp']=='codanex3'){
$descripcion =  $row1 ['codanex3'];
}


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

if($cod_cab_ref1==''){
$tempCodigoSerie=$codigo;
}else{
$tempCodigoSerie=$cod_cab_ref1;
}


$strSQL4="select * from series where producto='".$P."' and tienda='".$tienda."' and salida='".$tempCodigoSerie."'";
$resultado4 = mysql_query ($strSQL4,$cn);

//echo $strSQL4;
//$row4 = mysql_fetch_array ($resultado4);
//$acumulador = $row4 ['serie'];
//$acumulador = $row4 ['serie'].",";
//*********************************

//while($row=mysql_fetch_array($resultado4)){
//$acumulador=$acumulador.$row['serie'].", ";
//}
//$acumulador=substr($acumulador,0,strlen($acumulador)-2);
//echo $acumulador;
	  ?>
	  	
		<?php 
		
		if($codmodel==''){
		?>				
		<div style="width:<?php echo $ancho1?> ; height:<?php echo $alto1?> ; left:<?php echo $coordx1?> ; top:<?php echo $coordy1?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display1?>; text-align:left  "><?php if($P!="TEXTO") echo strtoupper($P); ?></div>
		<?php  $coordy1=$coordy1+20?>
		
		<?php } ?>
		
		<div style="width:<?php echo $ancho2?> ; height:<?php echo $alto2?> ; left:<?php echo $coordx2?> ; top:<?php echo $coordy2?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; text-align:left ;  "><?php echo substr($descripcion,0,50); ?></div>
		<?php  
		
		
		$coordy2=$coordy2+20?>
		
		<div style="width:<?php echo $ancho3?> ; height:<?php echo $alto3?> ; left:<?php echo $coordx3?> ; top:<?php echo $coordy3?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display3?>"><?php 
		
		
		if($codmodel==''){
		if($cant!=0)echo $cant; 
		}
		
		?></div>
		
		
		<?php  $coordy3=$coordy3+20?>
				
		<div style="width:<?php echo $ancho4?> ; height:<?php echo $alto4?> ; left:<?php echo $coordx4?> ; top:<?php echo $coordy4?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display4?>"><?php  
		
		if($codmodel==''){
		if($unid!="") echo strtoupper($unid); 
		}
		?></div>
		<?php  $coordy4=$coordy4+20?>
		
		<div style="width:<?php echo $ancho5?> ; height:<?php echo $alto5?> ; left:<?php echo $coordx5?> ; top:<?php echo $coordy5?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display5?>; text-align:right"><?php 
		
		if($codmodel==''){
		if($p_unit!=0) echo number_format($p_unit,2);
		}
		
		 ?></div>
		<?php  $coordy5=$coordy5+20?>
				
		<div style="width:<?php echo $ancho6?> ; height:<?php echo $alto6?> ; left:<?php echo $coordx6?> ; top:<?php echo $coordy6?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display6?>; text-align:right "><?php  
		
	
			//echo $m_total;
			
		if($codmodel==''){
		//if($p_tot!=0) echo number_format($p_tot,2); 
		echo $m_total;
		}
		//echo $m_total;
		
		
		
		?></div>
		<?php  $coordy6=$coordy6+20?>
		
		<div style="width:<?php echo $ancho8?> ; height:<?php echo $alto8?> ; left:<?php echo $coordx8?> ; top:<?php echo $coordy8?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display8?>; text-align:right "><?php  echo number_format($conta_items); ?></div>
		<?php  $coordy8=$coordy8+20?>
		
		<div style="width:<?php echo $ancho9?> ; height:<?php echo $alto9?> ; left:<?php echo $coordx9?> ; top:<?php echo $coordy9?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display9?>; text-align:right "><?php  echo ($desc1*100)." %"; ?></div>
		<?php  $coordy9=$coordy9+20?>
		
					
		<?php 
		
		

		 if ($simanejaser == "S" )
		 {
			$acumulador="";
			$contSerie=0;
			$switch='F';
			
			while($row4=mysql_fetch_array($resultado4)){
			$acumulador=$acumulador.$row4 ['serie'].", "; 
			//echo "--->$acumulador";
			$contSerie++;			
			
			
				if(fmod($contSerie,2)==0){	
				
				//$acumulador=substr($acumulador,0,strlen($acumulador)-2);	
				
				$coordy7=$coordy2;
			?>
				
				
				<div style="width:<?php echo $ancho7?> ; height:<?php echo $alto7?> ; left:<?php echo $coordx7?> ; top:<?php echo $coordy7?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display7?>; text-align:left;"><?php echo "S/N : ".$acumulador; ?></div>
			<?php  
			
			$coordy1=$coordy1+20;
			$coordy2=$coordy2+20;
			$coordy3=$coordy3+20;
			$coordy4=$coordy4+20;
			$coordy5=$coordy5+20;
			$coordy6=$coordy6+20;
			$coordy7=$coordy7+20;
			$coordy8=$coordy8+20;
			$coordy9=$coordy9+20;
			
			
			$acumulador="";
			$switch='T';
			
			?>
			
			<?php 
				 }
				
			 }//while
		  
		  //echo "---->".$acumulador;	
			$acumulador=substr($acumulador,0,strlen($acumulador)-2);	
			//echo "---->".$acumulador;	
			
			if($acumulador!=''){
			
				if($switch=='F'){
				//echo "--->";
				$coordy7=$coordy2;
				}
		  ?>
				
				<div style="width:<?php echo $ancho7?> ; height:<?php echo $alto7?> ; left:<?php echo $coordx7?> ; top:<?php echo $coordy7?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display7?>; text-align:left; "><?php echo "S/N : ".$acumulador; ?></div>
			<?php  
			
			$coordy1=$coordy1+20;
			$coordy2=$coordy2+20;
			$coordy3=$coordy3+20;
			$coordy4=$coordy4+20;
			$coordy5=$coordy5+20;
			$coordy6=$coordy6+20;
			$coordy8=$coordy8+20;
			$coordy9=$coordy9+20;
			
			//$coordy7=$coordy7+25;
			$acumulador="";
			}
			?>
			
			
		
		<?php 
	//echo $acumulador;
		//echo "S/N:".$acumulador;
		}//if
			
	
	// fin modo imp2
	}else{
	
	//echo "-->".$modo_imp;
		if($modo_imp=='3'){
		
		$strSQL1= "select * from producto where idproducto= '".$P."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row1 = mysql_fetch_array ($resultado1);

$cod_producto=$row1 ['idproducto']; 
$simanejaser = $row1 ['series']; 
$garantia= $row1 ['garantia']; 

/*
if($contModel>0){
$tempCodModel=$P;
}else{
	
	if($codmodel!=''){
	
	}else{
	$tempCodModel="";
	}

}

*/


if($row1['campo_imp']=='cod_prod'){
$descripcion =  $row1 ['cod_prod'];
}
if($row1['campo_imp']=='codanex2'){
$descripcion =  $row1 ['codanex2'];
}
if($row1['campo_imp']=='codanex3'){
$descripcion =  $row1 ['codanex3'];
}


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

if($cod_cab_ref1==''){
$tempCodigoSerie=$codigo;
}else{
$tempCodigoSerie=$cod_cab_ref1;
}


$strSQL4="select * from series where producto='".$P."' and tienda='".$tienda."' and salida='".$tempCodigoSerie."'";
$resultado4 = mysql_query ($strSQL4,$cn);

//echo $strSQL4;
//$row4 = mysql_fetch_array ($resultado4);
//$acumulador = $row4 ['serie'];
//$acumulador = $row4 ['serie'].",";
//*********************************

//while($row=mysql_fetch_array($resultado4)){
//$acumulador=$acumulador.$row['serie'].", ";
//}
//$acumulador=substr($acumulador,0,strlen($acumulador)-2);
//echo $acumulador;
	  ?>
	  	
		<?php 
		
		
		?>				
		<div style="width:<?php echo $ancho1?> ; height:<?php echo $alto1?> ; left:<?php echo $coordx1?> ; top:<?php echo $coordy1?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display1?>; text-align:left  "><?php 
		
		if($codmodel!=''){
		if($P!="TEXTO") echo strtoupper($P); 
		}
		?></div>
		<?php  $coordy1=$coordy1+20?>
	
		<div style="width:<?php echo $ancho2?> ; height:<?php echo $alto2?> ; left:<?php echo $coordx2?> ; top:<?php echo $coordy2?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; text-align:left ;  "><?php 
		
		if($codmodel!=''){
		echo substr($descripcion,0,50); 
		}
		
		?></div>
		<?php  
		
		
		$coordy2=$coordy2+20?>
		
		<div style="width:<?php echo $ancho3?> ; height:<?php echo $alto3?> ; left:<?php echo $coordx3?> ; top:<?php echo $coordy3?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display3?>"><?php 
		
		
		if($codmodel!=''){
		if($cant!=0)echo $cant; 
		}
		
		?></div>
		
		
		<?php  $coordy3=$coordy3+20?>
				
		<div style="width:<?php echo $ancho4?> ; height:<?php echo $alto4?> ; left:<?php echo $coordx4?> ; top:<?php echo $coordy4?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display4?>"><?php  
		if($codmodel!=''){
		if($unid!="") echo strtoupper($unid); 
		}
		?></div>
		<?php  $coordy4=$coordy4+20?>
		
		<div style="width:<?php echo $ancho5?> ; height:<?php echo $alto5?> ; left:<?php echo $coordx5?> ; top:<?php echo $coordy5?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display5?>; text-align:right"><?php 
		
		if($codmodel!=''){
		if($p_unit!=0) echo number_format($p_unit,2);
		}
		 ?></div>
		<?php  $coordy5=$coordy5+20?>
				
		<div style="width:<?php echo $ancho6?> ; height:<?php echo $alto6?> ; left:<?php echo $coordx6?> ; top:<?php echo $coordy6?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display6?>; text-align:right "><?php  
		
	
			//echo $m_total;
			
		if($codmodel!=''){
		if($p_tot!=0) echo number_format($p_tot,2); 
		}
		//echo $m_total;
		
		
		
		?></div>
		<?php  $coordy6=$coordy6+20?>
		
		<div style="width:<?php echo $ancho8?> ; height:<?php echo $alto8?> ; left:<?php echo $coordx8?> ; top:<?php echo $coordy8?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display8?>; text-align:right "><?php  echo number_format($conta_items); ?></div>
		<?php  $coordy8=$coordy8+20?>
		
		<div style="width:<?php echo $ancho9?> ; height:<?php echo $alto9?> ; left:<?php echo $coordx9?> ; top:<?php echo $coordy9?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display9?>; text-align:right "><?php  echo ($desc1*100)." %"; ?></div>
		<?php  $coordy9=$coordy9+20?>
		
					
		<?php 
		
		

		 if ($simanejaser == "S" )
		 {
			$acumulador="";
			$contSerie=0;
			$switch='F';
			
			while($row4=mysql_fetch_array($resultado4)){
			$acumulador=$acumulador.$row4 ['serie'].", "; 
			//echo "--->$acumulador";
			$contSerie++;			
			
			
				if(fmod($contSerie,2)==0){	
				
				//$acumulador=substr($acumulador,0,strlen($acumulador)-2);	
				
				$coordy7=$coordy2;
			?>
				
				
				<div style="width:<?php echo $ancho7?> ; height:<?php echo $alto7?> ; left:<?php echo $coordx7?> ; top:<?php echo $coordy7?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display7?>; text-align:left;"><?php echo "S/N : ".$acumulador; ?></div>
			<?php  
			
			$coordy1=$coordy1+20;
			$coordy2=$coordy2+20;
			$coordy3=$coordy3+20;
			$coordy4=$coordy4+20;
			$coordy5=$coordy5+20;
			$coordy6=$coordy6+20;
			$coordy7=$coordy7+20;
			$coordy8=$coordy8+20;
			$coordy9=$coordy9+20;
			
			
			$acumulador="";
			$switch='T';
			
			?>
			
			<?php 
				 }
				
			 }//while
		  
		  //echo "---->".$acumulador;	
			$acumulador=substr($acumulador,0,strlen($acumulador)-2);	
			//echo "---->".$acumulador;	
			
			if($acumulador!=''){
			
				if($switch=='F'){
				//echo "--->";
				$coordy7=$coordy2;
				}
		  ?>
				
				<div style="width:<?php echo $ancho7?> ; height:<?php echo $alto7?> ; left:<?php echo $coordx7?> ; top:<?php echo $coordy7?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display7?>; text-align:left; "><?php echo "S/N : ".$acumulador; ?></div>
			<?php  
			
			$coordy1=$coordy1+20;
			$coordy2=$coordy2+20;
			$coordy3=$coordy3+20;
			$coordy4=$coordy4+20;
			$coordy5=$coordy5+20;
			$coordy6=$coordy6+20;
			$coordy8=$coordy8+20;
			$coordy9=$coordy9+20;
			
			//$coordy7=$coordy7+25;
			$acumulador="";
			}
			?>
			
			
		
		<?php 
	//echo $acumulador;
		//echo "S/N:".$acumulador;
		}//if
			
		
		// fin modo imp 3
		
		}else{
		
		$strSQL1= "select * from producto where idproducto= '".$P."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row1 = mysql_fetch_array ($resultado1);

$cod_producto=$row1 ['idproducto']; 
$simanejaser = $row1 ['series']; 
$garantia= $row1 ['garantia']; 

/*
if($contModel>0){
$tempCodModel=$P;
}else{
	
	if($codmodel!=''){
	
	}else{
	$tempCodModel="";
	}

}

*/


if($row1['campo_imp']=='cod_prod'){
$descripcion =  $row1 ['cod_prod'];
}
if($row1['campo_imp']=='codanex2'){
$descripcion =  $row1 ['codanex2'];
}
if($row1['campo_imp']=='codanex3'){
$descripcion =  $row1 ['codanex3'];
}


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

if($cod_cab_ref1==''){
$tempCodigoSerie=$codigo;
}else{
$tempCodigoSerie=$cod_cab_ref1;
}


$strSQL4="select * from series where producto='".$P."' and tienda='".$tienda."' and salida='".$tempCodigoSerie."'";
$resultado4 = mysql_query ($strSQL4,$cn);

//echo $strSQL4;
//$row4 = mysql_fetch_array ($resultado4);
//$acumulador = $row4 ['serie'];
//$acumulador = $row4 ['serie'].",";
//*********************************

//while($row=mysql_fetch_array($resultado4)){
//$acumulador=$acumulador.$row['serie'].", ";
//}
//$acumulador=substr($acumulador,0,strlen($acumulador)-2);
//echo $acumulador;
	  ?>
	  	
		<?php 
		
		?>				
		<div style="width:<?php echo $ancho1?> ; height:<?php echo $alto1?> ; left:<?php echo $coordx1?> ; top:<?php echo $coordy1?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display1?>; text-align:left  "><?php if($P!="TEXTO") echo strtoupper($P); ?></div>
		<?php  $coordy1=$coordy1+20?>
		
		<?php  ?>
		
		<div style="width:<?php echo $ancho2?> ; height:<?php echo $alto2?> ; left:<?php echo $coordx2?> ; top:<?php echo $coordy2?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; text-align:left ;  "><?php echo substr($descripcion,0,50); ?></div>
		<?php  
		
		
		$coordy2=$coordy2+20?>
		
		<div style="width:<?php echo $ancho3?> ; height:<?php echo $alto3?> ; left:<?php echo $coordx3?> ; top:<?php echo $coordy3?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display3?>"><?php 
		
		
		
		if($cant!=0)echo $cant; 
		
		
		?></div>
		
		
		<?php  $coordy3=$coordy3+20?>
				
		<div style="width:<?php echo $ancho4?> ; height:<?php echo $alto4?> ; left:<?php echo $coordx4?> ; top:<?php echo $coordy4?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display4?>"><?php  
	
		if($unid!="") echo strtoupper($unid); 
		
		?></div>
		<?php  $coordy4=$coordy4+20?>
		
		<div style="width:<?php echo $ancho5?> ; height:<?php echo $alto5?> ; left:<?php echo $coordx5?> ; top:<?php echo $coordy5?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display5?>; text-align:right"><?php 
		
		
		if($p_unit!=0) echo number_format($p_unit,2);
		
		 ?></div>
		<?php  $coordy5=$coordy5+20?>
				
		<div style="width:<?php echo $ancho6?> ; height:<?php echo $alto6?> ; left:<?php echo $coordx6?> ; top:<?php echo $coordy6?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display6?>; text-align:right "><?php  
		
	
			//echo $m_total;
			
		
		if($p_tot!=0) echo number_format($p_tot,2); 
		//echo $m_total;
		
		
		
		?></div>
		<?php  $coordy6=$coordy6+20?>
		
		<div style="width:<?php echo $ancho8?> ; height:<?php echo $alto8?> ; left:<?php echo $coordx8?> ; top:<?php echo $coordy8?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display8?>; text-align:right "><?php  echo number_format($conta_items); ?></div>
		<?php  $coordy8=$coordy8+20?>
		
		<div style="width:<?php echo $ancho9?> ; height:<?php echo $alto9?> ; left:<?php echo $coordx9?> ; top:<?php echo $coordy9?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display9?>; text-align:right "><?php  echo ($desc1*100)." %"; ?></div>
		<?php  $coordy9=$coordy9+20?>
		
					
		<?php 
		
		

		 if ($simanejaser == "S" )
		 {
			$acumulador="";
			$contSerie=0;
			$switch='F';
			
			while($row4=mysql_fetch_array($resultado4)){
			$acumulador=$acumulador.$row4 ['serie'].", "; 
			//echo "--->$acumulador";
			$contSerie++;			
			
			
				if(fmod($contSerie,2)==0){	
				
				//$acumulador=substr($acumulador,0,strlen($acumulador)-2);	
				
				$coordy7=$coordy2;
			?>
				
				
				<div style="width:<?php echo $ancho7?> ; height:<?php echo $alto7?> ; left:<?php echo $coordx7?> ; top:<?php echo $coordy7?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display7?>; text-align:left;"><?php echo "S/N : ".$acumulador; ?></div>
			<?php  
			
			$coordy1=$coordy1+20;
			$coordy2=$coordy2+20;
			$coordy3=$coordy3+20;
			$coordy4=$coordy4+20;
			$coordy5=$coordy5+20;
			$coordy6=$coordy6+20;
			$coordy7=$coordy7+20;
			$coordy8=$coordy8+20;
			$coordy9=$coordy9+20;
			
			
			$acumulador="";
			$switch='T';
			
			?>
			
			<?php 
				 }
				
			 }//while
		  
		  //echo "---->".$acumulador;	
			$acumulador=substr($acumulador,0,strlen($acumulador)-2);	
			//echo "---->".$acumulador;	
			
			if($acumulador!=''){
			
				if($switch=='F'){
				//echo "--->";
				$coordy7=$coordy2;
				}
		  ?>
				
				<div style="width:<?php echo $ancho7?> ; height:<?php echo $alto7?> ; left:<?php echo $coordx7?> ; top:<?php echo $coordy7?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display7?>; text-align:left; "><?php echo "S/N : ".$acumulador; ?></div>
			<?php  
			
			$coordy1=$coordy1+20;
			$coordy2=$coordy2+20;
			$coordy3=$coordy3+20;
			$coordy4=$coordy4+20;
			$coordy5=$coordy5+20;
			$coordy6=$coordy6+20;
			$coordy8=$coordy8+20;
			$coordy9=$coordy9+20;
			
			//$coordy7=$coordy7+25;
			$acumulador="";
			}
			?>
			
			
		
		<?php 
	//echo $acumulador;
		//echo "S/N:".$acumulador;
		}//if
		
		
		
		
		}
	
	
	}

///---*************************************************************************************************

}


		
}
?>

<!--  <div id="total"><?php //echo $moneda." ".number_format($m_total,2) ?></div>-->

<!--<div id="moneda_letras2"><?php //echo  strtoupper(num2letras($m_total)." ".$monedalet); ?></div>-->
<!--<div id="fechaUdt"><font class="Estilo7"><?php //echo gmdate('d-m-Y H:i:s',time()-18000) ?></font></div>-->

<!--</div>-->
</body>

</html>

