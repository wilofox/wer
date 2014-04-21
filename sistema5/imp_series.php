<?php
session_start();
include('conex_inicial.php');

/*
$strSQL2="select * from producto order by nombre asc";
$resultado2 = mysql_query ($strSQL2,$cn);
$cont=1;
while($row2 = mysql_fetch_array ($resultado2)){
$strU="update producto set idproducto='".$cont."' where codanex3='".$row2['codanex3']."' ";
mysql_query($strU,$cn);
$cont++;

}
*/

$producto=$_REQUEST['producto'];
$referencia=$_REQUEST['referencia'];
$tienda=$_REQUEST['tienda'];
$precio=$_REQUEST['precio'];

function caracteresImp($text){
  // this function will intially be used to implement underlining support, but could be used for a range of other
  // purposes
  //echo $text;
  $search = array('á','é','í','ó','ú','Ñ','?','ñ','°','Á','É','Í','Ó','Ú');
 // $search = array('','','','','','','?');
  $replace = array('&#225;','&#233;','&#237;','&#243','&#250;','&#209;','&#63;','&#241;','&#176;','&#193;','&#201;','&#205;','&#211;','&#218;');
   //&#209;
  //$tempcaract=str_replace($search,$replace,$text);
 //echo  $tempcaract;
  return str_replace($search,$replace,$text);

 
}

?>


<? 

 
 define (__TRACE_ENABLED__, false);
 define (__DEBUG_ENABLED__, false);			
    
 require("codBarras/barcode/barcode.php");		   
 require("codBarras/barcode/i25object.php");
 require("codBarras/barcode/c39object.php");
 require("codBarras/barcode/c128aobject.php");
 require("codBarras/barcode/c128bobject.php");
 require("codBarras/barcode/c128cobject.php");
 
function codBarras($barcode){


//$barcode='';

$type="C128C";
//$border="on"; 
//$drawtext="on"; 
/* Default value */
if (!isset($output))  $output   = "png"; 
if (!isset($barcode)) $barcode  = "0123456789";
if (!isset($type))    $type     = "I25";
if (!isset($width))   $width    = "80";
if (!isset($height))  $height   = "50";
if (!isset($xres))    $xres     = "1";
if (!isset($font))    $font     = "5";
/*********************************/ 


	//if (isset($barcode) && strlen($barcode)>0) {    
	if (strlen($barcode)>0) {    
	  $style  = BCS_ALIGN_CENTER;					       
	  $style |= ($output  == "png" ) ? BCS_IMAGE_PNG  : 0; 
	  $style |= ($output  == "jpeg") ? BCS_IMAGE_JPEG : 0; 
	  $style |= ($border  == "on"  ) ? BCS_BORDER 	  : 0; 
	  $style |= ($drawtext== "on"  ) ? BCS_DRAW_TEXT  : 0; 
	  $style |= ($stretchtext== "on" ) ? BCS_STRETCH_TEXT  : 0; 
	  $style |= ($negative== "on"  ) ? BCS_REVERSE_COLOR  : 0; 
	  
	  switch ($type)
	  {
		case "I25":
				  $obj = new I25Object(250, 120, $style, $barcode);
				  break;
		case "C39":
				  $obj = new C39Object(250, 120, $style, $barcode);
				  break;
		case "C128A":
				  $obj = new C128AObject(250, 120, $style, $barcode);
				  break;
		case "C128B":
				  $obj = new C128BObject(1, 1, $style, $barcode);
				  break;
		case "C128C":
				  $obj = new C128CObject(250, 120, $style, $barcode);
				  break;
		default:
				$obj = false;
	  }
	  if ($obj) {
		 if ($obj->DrawObject($xres)) {
			 return "<img  src='codBarras/barcode/image.php?code=".$barcode."&style=".$style."&type=".$type."&width=".$width."&height=".$height."&xres=".$xres."&font=".$font."'>";
		 } else return "<table align='center'><tr><td><font color='#FF0000'>".($obj->GetError())."</font></td></tr></table>";
	  }
	}

}
									

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
.Estilo1 {font-family: Arial, Helvetica, sans-serif; font-size:9px; }
-->
</style>
<style type="text/css">
<!--
.Estilo6 {font-family: Geneva, Arial, Helvetica, sans-serif}
.Estilo8 {font-size: 9px}
-->
</style>
</head>
<style media="print">
.noprint     { display: none }

.imgs{

-moz-transform: rotate(90deg);  /* Firefox */
  -o-transform: rotate(90deg);  /* Opera */
   -webkit-transform: rotate(90deg);  /* Safari y Chrome */
  filter: progid:DXImageTransform.Microsoft.Matrix(sizingMethod='auto expand', M11=0.7071067811865476, M12=-0.7071067811865475, M21=0.7071067811865475, M22=0.7071067811865476); /* IE */

}

.celdaV{
-webkit-transform: rotate(90deg);
-moz-transform: rotate(90deg);
filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=90);

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
<script type="text/javascript" src="utilitarios/otros/npProlyam.js"></script> 
<script type="text/javascript" src="utilitarios/otros/jquery-1.4.4.js"></script> 
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
	$url="imp_series.php";
	$cola="HPLaserJet";
	
	$anchodoc="2100";
	
	$altura="2900";
 ?>
 
 
<script language="javascript">


 function PrintHTMLSample()
    {
	
	  var url="<?php echo $url.'?producto='.$producto.'&referencia='.$referencia.'&tienda='.$tienda?>";
	  
	  
	  //alert(url);
	  
	  var impresora="<?php echo $cola;?>";
	  
	 // SaveHTML(url);
	 // var objCola=objPlugin.PrintHTML( url, impresora);
	  
	 //alert(url+ " -- " +impresora);
	 
	 //return false;
	//alert(impresora);
	 	/*
	   SaveHTML(url);
	   var objCola=objPlugin.PrintHTML( url, impresora);
	   //alert(objCola);	   
	   if(objCola=='OK'){
	   // window.close();
	   }	   
		*/
		
		objPlugin.PrintHTML( url, impresora, "<?php echo $altura.'|'.$anchodoc ?>");
		
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
	
	
	
		//PrintHTMLSample();
		
		print();
	
				
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
	<br><br>
	
	
    <table width="399" border="0" align="center" cellpadding="0" cellspacing="0">


<?php 

$tempSerie="";


$campoPre="precio".$precio;

//$strSQL2="SELECT serie,$campoPre as precioVenta,idproducto,cod_prod,costo from series,producto WHERE  idproducto=producto and producto='".$producto."' and tienda='".$tienda."' and ingreso ='".$referencia."' ";

$strSQL2="SELECT des_lote as serie,$campoPre as precioVenta,idproducto,cod_prod,costo,cant from lotes,producto WHERE  idproducto=producto and producto='".$producto."' and cod_cab ='".$referencia."' ";

//echo $strSQL2;

$resultado2 = mysql_query ($strSQL2,$cn);
while($row2 = mysql_fetch_array ($resultado2)){
/*
$tempSerie=$tempSerie.$row2['serie']."~";
$tempPrecio=$tempPrecio.$row2['precioVenta']."~";
$tempId=$tempId.$row2['idproducto']."~";
$tempCodAnex3=$tempCodAnex3.$row2['cod_prod']."~";
$tempCosto=$tempCosto.$row2['costo']."~";
*/

$tempSerie=$tempSerie.$row2['serie']."~";
$tempPrecio=$tempPrecio.$row2['precioVenta']."~";
$tempId=$tempId.$row2['idproducto']."~";
$tempCodAnex3=$tempCodAnex3.$row2['cod_prod']."~";
$tempCosto=$tempCosto.$row2['costo']."~";
$cant=$row2['cant'];

}
//echo $cant;
$tempSerie2=explode("~",$tempSerie);
$tempPrecio2=explode("~",$tempPrecio);
$tempId2=explode("~",$tempId);
$tempCodAnex3_2=explode("~",$tempCodAnex3);
$tempCosto2=explode("~",$tempCosto);

//print_r($tempSerie2);

$left=50;
$top=25;

for($i=0; $i<$cant ; $i++){
//echo "<<";

//if($tempSerie2[$i]=='')break;

?>
  <tr>
    <td width="8" height="144" align="center" class="Estilo1">&nbsp;</td>
    <td width="86" align="center" class="Estilo1">	
	
	
			
	<?php  echo "&nbsp;".substr($tempCodAnex3_2[0],0,13)."<br>".$tempId2[0]."<br>".codBarras($tempId2[0])."<br>".$tempSerie2[0]."<br> S/.".number_format($tempPrecio2[0],2)."<br><br>".number_format($tempPrecio2[0]-$tempCosto2[0],2) ;?>
	
	</td>
	
	
    <td width="11" align="center" class="Estilo1">&nbsp;</td>
    <td width="86" align="center" class="Estilo1"><?php echo  "&nbsp;".substr($tempCodAnex3_2[0],0,13)."<br>".$tempId2[0]."<br>".codBarras($tempId2[0])."<br>".$tempSerie2[0]."<br> S/.".number_format($tempPrecio2[0],2)."<br><br>".number_format($tempPrecio2[0]-$tempCosto2[0],2);?></td>
    <td width="11" align="center" class="Estilo1">&nbsp;</td>
    <td width="86" align="center" class="Estilo1"><?php echo "&nbsp;".substr($tempCodAnex3_2[0],0,13)."<br>".$tempId2[0]."<br>".codBarras($tempId2[0])."<br>".$tempSerie2[0]."<br> S/.".number_format($tempPrecio2[0],2)."<br><br>".number_format($tempPrecio2[0]-$tempCosto2[0],2);?></td>
    <td width="11" align="center" class="Estilo1">&nbsp;</td>
    <td width="86" align="center" class="Estilo1"><?php echo "&nbsp;".substr($tempCodAnex3_2[0],0,13)."<br>".$tempId2[0]."<br>".codBarras($tempId2[0])."<br>".$tempSerie2[0]."<br> S/.".number_format($tempPrecio2[0],2)."<br><br>".number_format($tempPrecio2[0]-$tempCosto2[0],2);?></td>
    <td width="8" align="center" class="Estilo1">&nbsp;</td>
  </tr>
  <tr>
    <td height="9" colspan="9" align="center" class="Estilo1"></td>
    </tr>
  
<?php 

$i=$i+3;

}

 ?>  
</table>



</body>
</html>