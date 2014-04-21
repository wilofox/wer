<?php
session_start();
include('../conex_inicial.php');
include("../funciones/funciones.php");

$serie=$_REQUEST['serie'];
$numero=$_REQUEST['numero'];
$doc=$_REQUEST['doc'];
$tienda=$_REQUEST['tienda'];
$tienda2=$_REQUEST['tienda2'];


$strSQL1="select * from cab_mov where serie='".$serie."' and Num_doc='".$numero."' and cod_ope='".$doc."' order by tipo ";
$resultado1=mysql_query($strSQL1,$cn);
while($row1=mysql_fetch_array($resultado1)){

	if($row1['tipo']==1){
	$cod_cab_destino=$row1['cod_cab'];
	$sucursal2=$row1['sucursal'];
	}else{
	$cod_cab_origen=$row1['cod_cab'];
	$sucursal1=$row1['sucursal'];
	}
	
	$cod_responsable=$row1['cod_vendedor'];
	$fecha_doc=$row1['fecha'];
}



$strSQL2= "select * from usuarios where codigo= '".$cod_responsable."' " ;
$resultado2 = mysql_query ($strSQL2,$cn);
$row2 = mysql_fetch_array ($resultado2);
$responsable = $row2['usuario']; 

$strSQL3= "select * from tienda where cod_tienda= '".$tienda."' " ;
$resultado3 = mysql_query ($strSQL3,$cn);
$row3 = mysql_fetch_array ($resultado3);
$des_tienda1=$row3['des_tienda'];

$strSQL3= "select * from tienda where cod_tienda= '".$tienda2."' " ;
$resultado3 = mysql_query ($strSQL3,$cn);
$row3 = mysql_fetch_array ($resultado3);
$des_tienda2=$row3['des_tienda'];

$strSQL3= "select * from sucursal where cod_suc= '".$sucursal1."' " ;
$resultado3 = mysql_query ($strSQL3,$cn);
$row3 = mysql_fetch_array ($resultado3);
$des_sucursal1=$row3['des_suc'];

$strSQL3= "select * from sucursal where cod_suc= '".$sucursal2."' " ;
$resultado3 = mysql_query ($strSQL3,$cn);
$row3 = mysql_fetch_array ($resultado3);
$des_sucursal2=$row3['des_suc'];

$strSQL_doc= "select * from operacion where codigo = '".$doc."' and tipo='2' " ;
$resultado_doc = mysql_query ($strSQL_doc,$cn);
$row_doc = mysql_fetch_array ($resultado_doc);

$cola1=$row_doc['cola'];
//$cola2=$row_doc['cola2'];
$formato=$row_doc['formato'];
$comentario1=$row_doc['comentario1'];
$comentario2=$row_doc['comentario2'];
$tipoDesc=$row_doc['tipoDesc'];

if($tipoDesc=='P'){
$simPorc="%";
}else{
$simPorc="";
}

/*
			$strSQL="select * from docuser where pc='".$_SESSION['pc_ingreso']."' and usuario='".$_SESSION['codvendedor']."' and  doc='".$doc."' and tipomov='2' and empresa='".$empresa."' ";
			
			$resultado=mysql_query($strSQL,$cn);
			$row=mysql_fetch_array($resultado);
			$cola1=$row['cola'];
			$tcola=$row['tcola'];

*/

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
.Estilo1 {font-family: Arial, Helvetica, sans-serif; font-size:11px; }
-->
</style>
<style type="text/css">
<!--
.Estilo2 {font-family: "Times New Roman", Times, serif}
-->
</style>
<style type="text/css">
<!--
.Estilo3 {font-family: "Courier New", Courier, monospace}
-->
</style>
<style type="text/css">
<!--
.Estilo4 {font-family: Georgia, "Times New Roman", Times, serif}
-->
</style>
<style type="text/css">
<!--
.Estilo5 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>
<style type="text/css">
<!--
.Estilo6 {font-family: Geneva, Arial, Helvetica, sans-serif}
-->
</style>
</head>
<style media="print">
.noprint     { display: none }
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
<script type="text/javascript" src="../utilitarios/otros/npProlyam.js"></script> 
<script type="text/javascript" src="../utilitarios/otros/jquery-1.4.4.js"></script> 
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
	
	  var url="<?php echo $url.'?empresa='.$empresa.'&doc='.$doc.'&serie='.$serie.'&numero='.$numero.'&codigoCab='.$codigo ?>;";
	  
	  var impresora="<?php echo $impresora ?>";
	  
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
	
	
	
		PrintHTMLSample();
	
				
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

<table width="797" height="275" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10" height="137">&nbsp;</td>
    <td width="754">
	<table width="747" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" colspan="2" align="center" class="Estilo1 Estilo2 Estilo3 Estilo4 Estilo5 Estilo6 Estilo1">TRANSFERENCIA DE STOCKS </td>
        </tr>
      <tr>
        <td height="23" colspan="2" align="center"><span class="Estilo1">TS <?php echo $serie."-".$numero ?></span></td>
      </tr>
      <tr>
        <td width="357"><span class="Estilo1">Origen :<?php echo $des_tienda1?></span></td>
        <td width="374"><span class="Estilo1">Destino :<?php echo $des_tienda2?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo1">Sucursal : <?php echo $des_sucursal1 ?></span></td>
        <td><span class="Estilo1">Sucursal : <?php echo $des_sucursal2 ?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo1">Fecha :<?php echo $fecha_doc ?></span></td>
        <td><span class="Estilo1"></span></td>
      </tr>
    </table></td>
    <td width="11">&nbsp;</td>
  </tr>
  <tr>
    <td height="73">&nbsp;</td>
    <td ><table width="745" cellpadding="0" cellspacing="0"  >
      <tr >
        <td colspan="4" align="center" >.....................................................................................................................................................................................</td>
        </tr>
      <tr >
        <td width="66" height="14" align="center" ><span class="Estilo1">Item</span></td>
        <td width="153" align="center" ><span class="Estilo1">Cantidad</span></td>
        <td width="134" align="center" ><span class="Estilo1">C&oacute;digo</span></td>
        <td width="390" ><span class="Estilo1">Producto</span></td>
      </tr>
      <tr >
        <td height="14" colspan="4" align="center" >.....................................................................................................................................................................................</td>
        </tr>
      <tr>
        <td  colspan="4" ></td>
        </tr>
	  <?php 
	  $i=0;
	  $strSQL3= "select * from det_mov where cod_cab= '".$cod_cab_destino."' " ;
	  $resultado3 = mysql_query ($strSQL3,$cn);
	  while($row3 = mysql_fetch_array ($resultado3)){
	  
	  	  $strSQL41= "select * from producto where idproducto='".$row3['cod_prod']."' " ;
		  $resultado41 = mysql_query ($strSQL41,$cn);
		  $row41 = mysql_fetch_array ($resultado41);
		  $codAnexo=$row41['cod_prod'];
	  
	    $i++;
		  $strSQL4= "select * from series where ingreso='".$cod_cab_destino."' and producto='".$row3['cod_prod']."' " ;
		  $resultado4 = mysql_query ($strSQL4,$cn);
		  //echo $strSQL4;
		  $series="";
		  while($row4 = mysql_fetch_array ($resultado4)){
		  $series=$series.$row4['serie'].", ";
		  }
	  ?>
      <tr>
        <td align="center" valign="top"><span class="Estilo1"><?php echo $i?></span></td>
        <td align="center" valign="top"><span class="Estilo1"><?php echo number_format($row3['cantidad'],2); ?></span></td>
        <td align="center" valign="top"><span class="Estilo1"><?php echo $codAnexo;?></span></td>
        <td><span class="Estilo1"><?php echo $row3['nom_prod'];?><br>
            <?php echo $series?></span></td>
      </tr>
      
	  
	  <?php 
	  }
	  ?>
      <tr>
        <td colspan="4" align="center" valign="top">.....................................................................................................................................................................................</td>
      </tr>
        
    </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table width="750" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="100"><span class="Estilo1">Visto Bueno </span></td>
        <td colspan="2"><span class="Estilo1">.........................................................................</span></td>
      </tr>
      <tr>
        <td><span class="Estilo1">Responsable</span></td>
        <td width="292"><span class="Estilo1"><?php echo $responsable?></span></td>
        <td width="336"><span class="Estilo1">Recibido:.................................................................</span></td>
      </tr>
      <tr>
        <td><span class="Estilo1">Fecha </span></td>
        <td colspan="2"><span class="Estilo1"><?php echo date('d-m-Y H:i:s'); ?></span></td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
</table>

	<div id=idControls class="noprint">
		 <div id="idBtn">
		 </div>
  </div>
	
	
</div>

</body>
</html>
