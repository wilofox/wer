<?php
session_start();
include('../conex_inicial.php');
include("../funciones/funciones.php");

$id_pago=$_REQUEST['id_pago'];
$cola=$_REQUEST['cola'];

$strSQL2= "select * from cajach where idcaja= '".$id_pago."' " ;
//echo $strSQL2;
$resultado2 = mysql_query ($strSQL2,$cn);
$row2 = mysql_fetch_array ($resultado2);
$cod_tienda = $row2['cod_tienda'];
$fecpago = $row2['fecpago'];
$tippago  = $row2['tippago'];
$tipmov = $row2['tipmov'];
$codclie = $row2['codclie'];
$moneda = $row2['moneda'];
$tipcambio = $row2['tipcambio'];
$importe = $row2['importe'];
$Observa  = $row2['Observa'];
$cod_user  = $row2['cod_user'];
$docpago  = $row2['docpago'];

$strSQL2= "select * from usuarios where codigo= '".$cod_user."' " ;
$resultado2 = mysql_query ($strSQL2,$cn);
$row2 = mysql_fetch_array ($resultado2);
$responsable = $row2['usuario']; 

$strSQL3= "select * from tienda where cod_tienda= '".$cod_tienda."' " ;
$resultado3 = mysql_query ($strSQL3,$cn);
$row3 = mysql_fetch_array ($resultado3);
$des_tienda1=$row3['des_tienda'];

$strSQL3= "select * from sucursal where cod_suc= '".substr($cod_tienda,0,1)."' " ;
$resultado3 = mysql_query ($strSQL3,$cn);
$row3 = mysql_fetch_array ($resultado3);
$des_sucursal1=$row3['des_suc'];

$strSQL3= "select * from cliente where codcliente= '".$codclie."' " ;
$resultado3 = mysql_query ($strSQL3,$cn);
$row3 = mysql_fetch_array ($resultado3);
$des_cliente=$row3['razonsocial'];


$strSQL3= "select * from t_pago where id='".$tippago."' " ;
$resultado3 = mysql_query ($strSQL3,$cn);
$row3 = mysql_fetch_array ($resultado3);
$des_tpago=$row3['descripcion'];
$codTpago=$row3['codigo'];



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
.Estilo1 {font-family: Arial, Helvetica, sans-serif; font-size:12px; }
-->
</style>
<style type="text/css">
<!--
.Estilo6 {font-family: Geneva, Arial, Helvetica, sans-serif}
.Estilo8 {font-size: 12px}
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
	$url="imp_pago.php";
 ?>
 
<script language="javascript">


 function PrintHTMLSample()
    {
	
	  var url="<?php echo $url.'?id_pago='.$id_pago.'&cola='.$cola;?>;";
	  
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

<table width="602" height="275" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="6" height="137">&nbsp;</td>
    <td width="583"><table width="573" height="197" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="75" colspan="2" align="center" class="Estilo8 Estilo1 Estilo6"><strong>
		
		<?php 
		
		//is_numeric();
		//echo $codTpag;
		
		if(substr($codTpago,0,1)=='D'){
		
		echo "DEP&Oacute;SITO ".strtoupper($des_tpago);
						
		}else{
		
		echo "RECIBO ". strtoupper($des_tpago);		
		
		}
		
		
		
		?>
		
		
		</strong></td>
      </tr>
      <tr>
        <td height="23" colspan="2" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo1">Empresa :<?php echo caracteresImp($des_sucursal1) ?></span></td>
        <td><span class="Estilo1">Movimiento: <?php if($tipmov=='I') echo "Ingreso" ; else echo "Egreso"; ?>
        </span></td>
      </tr>
      <tr>
        <td width="364"><span class="Estilo1">Tienda : <?php echo $des_tienda1 ?></span></td>
        <td width="298"><span class="Estilo1">Fecha :<?php echo formatofecha($fecpago) ?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo1">Auxiliar: <?php echo caracteresImp($des_cliente); ?></span></td>
        <td><span class="Estilo1">Responsable: <?php echo $responsable;?> </span></td>
      </tr>
      <tr>
        <td height="45" colspan="2"><span class="Estilo1">Cuenta: 
		<?php 
		
					 if($moneda=='01'){
					 $cb=" cbancaria1 ";
					 }else{
					 $cb=" cbancaria2 ";
					 }
		
					$strSQl="select $cb as cuentab from t_pago where id='".$tippago."' ";
					$resultado=mysql_query($strSQl,$cn);
					$row=mysql_fetch_array($resultado);
					
					
					$strSQl="select * from cuentas,bancos where id=banco_id and cta_id='".$row['cuentab']."' order by ctabco";
					$resultado=mysql_query($strSQl,$cn);
					$row=mysql_fetch_array($resultado);
					
					if($moneda=='01'){ $simb="S/."; }else{ $simb="US$"; }
					
					echo $row['descrip']." (".$simb.") ".$row['ctabco'];
		
		?>
		
		</span></td>
        </tr>
    </table></td>
    <td width="13">&nbsp;</td>
  </tr>
  <tr>
    <td height="73">&nbsp;</td>
    <td ><table width="99%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="28%" height="22" align="center" style="border-top:#666666 solid 1px; border-bottom:#666666 solid 1px "><span class="Estilo1"><strong>Tipo de Pago </strong></span></td>
        <td width="35%" align="center" style="border-top:#666666 solid 1px; border-bottom:#666666 solid 1px"><span class="Estilo1"><strong>N&uacute;mero</strong></span></td>
        <td width="11%" align="center" style="border-top:#666666 solid 1px; border-bottom:#666666 solid 1px"><span class="Estilo1"><strong>Moneda</strong></span></td>
        <td width="26%" align="center" style="border-top:#666666 solid 1px; border-bottom:#666666 solid 1px"><span class="Estilo1"><strong>Monto</strong></span></td>
      </tr>
      <tr>
        <td align="center" class="Estilo1"><?php echo $des_tpago ; ?></td>
        <td align="center" class="Estilo1"><?php echo $docpago; ?></td>
        <td align="center" class="Estilo1"><?php if($moneda=='01'){ echo "S/."; }else{ echo "US$"; } ?></td>
        <td align="right" class="Estilo1"><?php echo number_format($importe,2); ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="41" colspan="4"><span class="Estilo1">Observaciones: <?php echo caracteresImp($Observa); ?></span></td>
        </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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
