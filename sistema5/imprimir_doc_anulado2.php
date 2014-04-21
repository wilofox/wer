<?php 
//session_id($_GET["idsesion"]);
session_start();
include('conex_inicial.php');


//$ruc=$_REQUEST['ruc'];
//$cliente=$_REQUEST['cliente'];
$referencia=$_REQUEST['referencia'];

//$cliente=ereg_replace ("%", "&", $cliente); 
//$direccion=$_REQUEST['direccion'];
//$serie=$_REQUEST['serie'];

$temp_turno=$_SESSION['turno'];
$strsql="select * from turno where nombre='$temp_turno'";
$resultado=mysql_query($strsql,$cn);
$row=mysql_fetch_array($resultado);
$hinicio=$row['hinicio'];
$hfin=$row['hfin'];
$fecha=date('d/m/Y');

$strsql="select * from cab_mov where cod_cab='$referencia'";
$resultado=mysql_query($strsql,$cn);
$cont=mysql_num_rows($resultado);
$row=mysql_fetch_array($resultado,$cn);
//echo $strsql;
$noperacion=$row['noperacion'];
$numero=$row['Num_doc'];
$serie=$row['serie'];
$ruc=$row['ruc'];
$cliente=$row['cliente'];
$importe=$row['total'];
?>

<html>
<head>
<title>:::::IMPRIMIENDO::::</title>
<link rel="stylesheet" type="text/css" href="sample.css" />

<!-- special style sheet for printing -->
<style media="print">
.noprint     { display: none }
</style>

    <script src="jquery-1.2.6.js"></script>
    <script src="jquery.hotkeys.js"></script>

<script>
jQuery(document).bind('keypress', 'return',function (evt){jQuery('#_return').addClass('dirty'); 
window.close();
return false; });

</script>

<script defer>
function setInstallStyles(fOK) {
	document.getElementById("installFailure").runtimeStyle.display = fOK ? "none" : "block";
	document.getElementById("installOK").runtimeStyle.display = fOK ? "block" : "none";
}
function okInstall() {
	setInstallStyles(true);
}
function noInstall() {
	setInstallStyles(false);
}

function viewinit1() {
  if (!secmgr.object) {
  	noInstall();
  	return;
  } else {
  okInstall();
  factory.printing.header = ""
  factory.printing.footer = ""
  factory.printing.SetMarginMeasure(2) // margins in inches
  factory.printing.printer = "HP Deskjet D2300 series";
  factory.printing.paperSize = "";
  factory.printing.paperSource = "";
  
  factory.printing.leftMargin = 0.01
  factory.printing.topMargin = 0.01
  factory.printing.rightMargin = 0.01
  factory.printing.bottomMargin = 0.01
  
//  factory.printing.leftMargin = 0.75
//  factory.printing.topMargin = 1.5
//  factory.printing.rightMargin = 0.75
//  factory.printing.bottomMargin = 1.5

  factory.printing.printBackground = true;
  factory.printing.disableUI = true; // disable IE native printing UI

  // enable control buttons
  var templateSupported = factory.printing.IsTemplateSupported();
  var controls = idControls.all.tags("input");
  for (var i = 0; i < controls.length; i++ ) {
    controls[i].disabled = false;
    if ( templateSupported && controls[i].className == "ie55" )
      controls[i].style.display = "inline";
    }
  }

//  idPreviewFrame.disabled = true;
}

function viewinit2() {
  if (!secmgr.object) {
  	noInstall();
  	return;
  } else {
  okInstall();
  factory.printing.header = ""
  factory.printing.footer = ""
  factory.printing.SetMarginMeasure(2) // margins in inches
  factory.printing.printer = "PROLYAM";
  factory.printing.leftMargin = 0.75
  factory.printing.topMargin = 1.5
  factory.printing.rightMargin = 0.75
  factory.printing.bottomMargin = 1.5
  factory.printing.printBackground = true;
  factory.printing.disableUI = true; // disable IE native printing UI

  // enable control buttons
  var templateSupported = factory.printing.IsTemplateSupported();
  var controls = idControls.all.tags("input");
  for (var i = 0; i < controls.length; i++ ) {
    controls[i].disabled = false;
    if ( templateSupported && controls[i].className == "ie55" )
      controls[i].style.display = "inline";
    }
  }
//  idPreviewFrame.disabled = true;
}


function SpoolStatus(start) {
  // provide some visual feedback on spooling status
  window.status = start?
    "Please wait for spooling to complete ..." :
    "Spooling is complete";
	//window.parent.opener.formulario.termino.focus();
	//window.parent.opener.form1.ruc3.focus();
//---------------------------------------------------------------	
	 window.close();
	
//--------------------------------------------------------------
	//window.parent.opener.terminar();
	
	 // document.form1.ruc.focus();
	
	//alert("Imprimiendo....");		

}
/*
function window.onload() {
  for ( i = 0; printer = factory.printing.EnumPrinters(i); i++ ) {
    alert("Printer name: "+printer);
    var job = {};
    for ( j = 0; status = factory.printing.EnumJobs(printer, j, job); j++ )
      alert("Job name: "+job[0]+", status: "+status);
  }
}

*/

function Print(prompt, frame) {
  if ( factory.printing.Print(prompt, frame) ) {
    SpoolStatus(true);
    factory.printing.WaitForSpoolingComplete();
    SpoolStatus(false);
	//alert("prueba")
	// CheckSpooling();
	 }
	 
}


function PrintAllDocs() {
//alert(url);
  factory.printing.PrintHTML(url);
  factory.printing.PrintXML(src1);
  factory.printing.PrintXML(src2);
 // CheckSpooling();
}

function CheckSpooling() {
  if ( !factory.printing.IsSpooling() ) window.close()
  setTimeout("CheckSpooling()", 1000);
}

/*
function PrintAndGo(prompt, frame) {
//alert("prueba");
  if ( factory.printing.Print(prompt, frame) )
    factory.printing.WaitForSpoolingComplete()
  window.close()
}
*/

function PrintHTML(url) {
  SpoolStatus(true);
  factory.printing.PrintHTML(url);
  factory.printing.WaitForSpoolingComplete();
  SpoolStatus(false);
 }

function newTemplate(s) {
	alert("Changing the template to: " + ("MeadCo://" + s.options[s.selectedIndex].value));
	factory.printing.templateURL = "MeadCo://" + s.options[s.selectedIndex].value;
	idPreviewFrame.disabled = s.selectedIndex != 2;
}
 

</script>

<style type="text/css">
<!--
.Estilo40 {font-family: Geneva, Arial, Helvetica, sans-serif ; font-size: 11px;}
.Estilo50 {font-size: 13px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.Estilo55 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
-->
</style>
</head>
<script>
function terminar(){
var mesa=document.form1.numero_mesa.value;
if(mesa!=""){
//	if(confirm('Imprimiendo Documento....Desea continuar?')){
	//location.href='pedido.php';
	window.open('restaurante/comanda_mesa.php','principal');
	//window.open('pedido.php','','target=principal');
//	}else{
//	window.open('restaurante/comanda_mesa.php','principal');
//	}
}else{

//		if(confirm('Imprimiendo Documento....Desea continuar?')){
	//location.href='pedido.php';
//	window.open('pedido.php','principal');
	//window.open('pedido.php','','target=principal');
//	}else{
	//window.open('pedido.php','principal');
//	}



}
	
//window.parent.parent.opener.recargar();
}

function defrente(){
window.focus();
viewinit1();
Print(false, top);
terminar();
//window.open('pedido.php','principal');
//window.close();
}
</script>

<!--onUnload="terminar()" onLoad="viewinit1();Print(false, top)"-->


<body onLoad="defrente()"  scroll="auto">

<!--onLoad="viewinit()-->

<!-- MeadCo Security Manager -->
<!-- ********************************************************************************* -->
<!-- * DO NOT copy this codebase - it can change at any time                         * -->
<!-- * download the (free) ScriptX Resource Kit and store the cab on your own server * -->
<!-- ********************************************************************************* -->

<object id="secmgr" style="display:none" viewastext classid="clsid:5445BE81-B796-11D2-B931-002018654E2E" codebase="http://www.prolyam.com/restaurante/javascript/smsx.cab#Version=6.5.439.37">
<param name="GUID" value="{0ADB2135-6917-470B-B615-330DB4AE3701}">
<param name="Path" value="http://www.meadroid.com/scriptx/sxlic.mlf">
<param name="Revision" value="0">
<param name="PerUser" value="true">
</object>

<object id="factory" style="display:none" viewastext classid="clsid:1663ED61-23EB-11D2-B92F-008048FDD814" codebase="http://codestore.meadroid.com/products/scriptx/binary.ashx?version=6,5,439,50&filename=smsx.cab&x2ref=http://www.meadroid.com/scriptx/docs/samples/basic.asp#Version=6,5,439,50">
</object>



<div id=imp class="noprint" style="height:50">          Imprimiendo Documento Anulado.......<br>
  <table width="250" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="28"><span class="noprint" style="height:100"><span class="Estilo55"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <script>
        </script>
    </span></td>
    <td width="222"><form name="form2" method="post" action="">
      <span class="noprint" style="height:100">
      <input type="button" name="Submit" value="    Aceptar   " onClick="javascript:window.close();">
      </span>
    </form></td>
  </tr>
</table>
<script>
</script>
</div>
<div id="installFailure" style="width:300px; height:1">
	
</div>


<div id="installOK" style="width:240px; height:10">



 <table background="imgenes/2.gif" width="242" border="0" cellpadding="0" cellspacing="0" align="center">
   <tr>
     <td colspan="3" align="center" ><span class="Estilo50">
         </span><span class="Estilo50">DISTRIBUIDORA</span><span class="Estilo50"> VILLA ELENA E.I.R.L. <br> 
     R.U.C 20502196589
     <BR>
PANADERIA Y PASTELERIA SAN SERAFINO <br>
AV. VENEZUELA 857 
      </span></td>
    </tr>
   
   <tr>
    <td colspan="3"><table width="100%"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="18"  align="center"><span class="Estilo50">Nro.Serie S/N FFFF0102406</span>       </td>
        </tr>
    </table>	</td>
    </tr>
   <tr>
     <td height="34" colspan="3" align="center"><span class="Estilo50"><?php echo date('d/m/Y');?>&nbsp;<?php echo date('h:i:s a')?><br><?php echo "N/O: ". str_pad($noperacion, 10, "0", STR_PAD_LEFT);?></span></td>
   </tr>
   <tr>
     <td height="22" colspan="3" align="center">---------------------------------------------</td>
   </tr>
   <tr>
     <td height="18" colspan="3" align="center"><span class="Estilo50">
       <?php 
		  if($ruc==""){
		  echo " Ticket BOLETA Nro. ";
		  }else{
		  echo "Ticket FACTURA Nro. ";
		  }
		  
		  ?>
       <?php echo $serie."-".$numero ?></span>	   </td>
   </tr>
   <tr>
     <td height="23" colspan="3" align="center">---------------------------------------------</td>
   </tr>
   <?php if($ruc!=""){?>
   <tr>
     <td colspan="3"><span class="Estilo50">Cliente:<?php echo $cliente?><br>
       Ruc:<?php echo $ruc?><br>
       Dirección:<?php echo $direccion?></span></td>
   </tr>
   <tr>
    <td colspan="3">---------------------------------------------</td>
    </tr>
	
	
  
<?php }?>

 <tr>
     <td colspan="3" align="left" valign="baseline">
	 
	 <table width="236" border="0" cellpadding="0" cellspacing="0">
         <tr>
           <td width="33"><span class="Estilo50">Cant</span></td>
           <td width="137"><span class="Estilo50">Producto </span></td>
           <td width="66" align="right"><span class="Estilo50">Total S/.</span> </td>
         </tr>
     </table></td>
   </tr>
   <tr>
     <td colspan="3">---------------------------------------------</td>
   </tr>


<?php

$vuelto=$_REQUEST['vuelto'];
$moneda_v=$_REQUEST['moneda_v'];
//$direccion=$_REQUEST[''];
$mesa=$_REQUEST['mesa'];
$fecha=date('d/m/Y H:i:s' ,time() - 3600);



if($moneda_v=="S"){
$moneda_v="soles";}
if($moneda_v=="D"){
$moneda_v="dolares";}

  $strSQL22="select max(cod_cab) as codigo from cab_mov";
  $resultado22=mysql_query($strSQL22,$cn);
  $row22=mysql_fetch_array($resultado22);
  
  
  $var22=$row22['codigo']+1;
  $cod_cab2=str_pad($var22, 6, "0", STR_PAD_LEFT);
  mysql_free_result($resultado22);
   
 // $strSQL221="update det_mov set cod_cab='$cod_cab2',fechad='$fecha' where cod_cab='".$_SESSION['registro']."'";
  //mysql_query($strSQL221,$cn);
 // echo $strSQL221;
 
 //-------------------------------------------------------------
// $i_1=0;
// while($i_1!=1){
 /*
	$strSQL_1="select * from pagos where referencia='".$_SESSION['registro']."'";
	$resultado_1=mysql_query($strSQL_1,$cn);
	$temp_1=mysql_num_rows($resultado_1);

//	if($temp_1==1){ 
	$strSQL222="update pagos set referencia='$cod_cab2',vuelto='$vuelto',moneda_v='$moneda_v',fechap='$fecha' where referencia='".$_SESSION['registro']."'";
	mysql_query($strSQL222,$cn);
//	$i_1=1;
	
	//echo "$strSQL222 <br> i=$i_1";
	
//	}
//  }	
	
*/

 //-------------------------------------------------------------
 
 
// echo $strSQL222;
 
 

$num_doc=$_REQUEST['numero'];

$cod_vendedor=$_SESSION['codvendedor'];
$cod_terminal=$_SESSION['codterminal'];


$tc=$_REQUEST['tc'];
$f_venc="";

$importe=$importe;

$igv=round(($importe*0.19)*100)/100;
$b_imp=round(($importe-$igv)*100)/100;
//$servicio=$importe-($b_imp+$igv);

$total=$b_imp+$igv;//+$servicio;

$cod_ope=$operacion;

$moneda="01";
/*
$strSQL44="insert into cab_mov(cod_cab,cod_ope,num_doc,serie,cod_vendedor,caja,cliente,ruc,fecha,f_venc,moneda,tc,b_imp,igv,servicio,total,saldo,tienda,sucursal,noperacion) values ('".$cod_cab2."','".$cod_ope."','".$num_doc."','".$serie."','".$cod_vendedor."','".$cod_terminal."','".$cliente."','".$ruc."','".$fecha."','".$f_venc."','".$moneda."','".$tc."','".$b_imp."','".$igv."','".$servicio."','".$total."','".$saldo."','".$_SESSION['tienda']."','".$_SESSION['sucursal']."','".$noperacion."')";

	mysql_query($strSQL44,$cn);
   */
      
//----------------------------------------------------------------------------------------
   

$strSQL4="select cantidad,cod_prod,nom_prod  from det_mov where cod_cab='".$referencia."' order by cod_det";
 $resultado4=mysql_query($strSQL4,$cn);
// echo $strSQL4;
$nitems=0;
 while($row4=mysql_fetch_array($resultado4)){
 $nitems=$nitems+1;
 ?>

    <td width="17"><span class="Estilo50"></span><span class="Estilo40"><?php echo $row4['cantidad'];?></span></td>
    <td width="175"><span class="Estilo50"><?php echo substr($row4['nom_prod'],0,20);?></span></td>
    <td width="51" align="right"><span class="Estilo50"><?php 
	
	$strSQL40="select * from producto where cod_prod='".$row4['cod_prod']."'";
 $resultado40=mysql_query($strSQL40,$cn);
	$row40=mysql_fetch_array($resultado40);
	
	$total=$row40['precio']*$row4['cantidad'];
	echo number_format($total,2);
	?></span></td>
    </tr>
  <?php } 
  
  //$str_items="update cab_mov set items='".$nitems."' where cod_cab='".$cod_cab2."'";
  //mysql_query($str_items,$cn);


  ?>  
  
  <tr>
    <td colspan="3">---------------------------------------------</td>
    </tr>
	<?php if($ruc!=""){?>
  <tr>
    <td colspan="2"><span class="Estilo50">***Valor de Venta S/. </span></td>
    <td align="right"><span class="Estilo50"><?php echo number_format($b_imp,2);?></span></td>
    </tr>
  <tr>
    <td colspan="2"><span class="Estilo50">***Igv : 19%</span></td>
    <td align="right"><span class="Estilo50"><?php echo number_format($igv,2) ?></span></td>
    </tr>
	<?php }?>
	
  <tr style="display:none">
    <td colspan="2"><span class="Estilo50">***Servicio</span></td>
    <td align="right"><span class="Estilo50"><?php echo number_format($servicio,2)?></span></td>
    </tr>
  <tr>
    <td colspan="2"><span class="Estilo50">***TOTAL VENTAS/.</span></td>
    <td align="right"><span class="Estilo50"><?php echo number_format($importe,2);?></span></td>
    </tr>
  <tr>
    <td colspan="2"><span class="Estilo50">VUELTO:<?php echo number_format($vuelto,2);?></span></td>
    <td align="right">&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan="2"><span class="Estilo50">USUARIO:<?php echo $_SESSION['user']?></span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">---------------------------------------------</td>
    </tr>
  <tr>
    <td colspan="3" align="center"><span class="Estilo50">NO SE ACEPTAN DEVOLUCIONES<br>Gracias por su Preferencia </span></td>
    </tr>
</table>



 <div id=idControls class="noprint">
 <b>Botones para Impresion directa</b>

	 <div id="idBtn">
	 
	 <p><input type="button" value="Hp "
	 onclick="viewinit1();Print(false, top)">
	 <input type="button" value="epson "
	  onclick="viewinit2();Print(false, top)">
    </div>

     <form name="form1" method="post" action="">
       <input type="hidden" name="numero_mesa" value="<?php echo $mesa?>">
     </form>
    <p><b>Select the template type to use: </b><select onChange="newTemplate(this)" size="1"><option value="default">Default</option><option value="IE55">IE 5.5/6</option><option selected value="IE7">IE 7</option></select></p>
 <p>The default template type is for IE 5.5/6 behaviour for IE 5.5/6 browser versions and IE 7 type behaviour for the IE 7 browser. This sample has specifically requested the IE 7 style template is used.</p>


</div>

<p>

<!--<iframe name="idFrame" width="100%" height="60%" src="frame.htm">
</iframe>
-->
</div>

</body>
</html>
