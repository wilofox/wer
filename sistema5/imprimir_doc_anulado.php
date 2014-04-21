<?php 
//session_id($_GET["idsesion"]);
session_start();
include('conex_inicial.php');

$ruc=$_REQUEST['ruc'];
$cliente=$_REQUEST['cliente'];
$direccion=$_REQUEST['direccion'];
$serie=$_REQUEST['serie'];
?>
<html>
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="sample.css" />

<!-- special style sheet for printing -->
<style media="print">
.noprint     { display: none }
</style>

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
  factory.printing.printer = "prolyam";
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
	window.close();
//	window.parent.opener.terminar();
	
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
.Estilo40 {font-size: 13px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>
</head>
<script>
function terminar(){
var mesa=document.form1.numero_mesa.value;
if(mesa!=""){
	if(confirm('Imprimiendo Documento....Desea continuar?')){
	//location.href='pedido.php';
	window.open('restaurante/comanda_mesa.php','principal');
	//window.open('pedido.php','','target=principal');
	}else{
	window.open('restaurante/comanda_mesa.php','principal');
	}
}else{

		if(confirm('Imprimiendo Documento....Desea continuar?')){
	//location.href='pedido.php';
	window.open('pedido.php','principal');
	//window.open('pedido.php','','target=principal');
	}else{
	window.open('pedido.php','principal');
	}



}
	
//window.parent.parent.opener.recargar();
}
</script>
<body  onLoad="viewinit1();Print(false, top)" scroll="auto">

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


<div id="installFailure" style="width:300px; height:10">
	
</div>


<div id="installOK" style="width:300px; height:10">


 <table  background="imgenes/2.gif" width="300" border="0" cellpadding="0" cellspacing="0">
   <tr>
     <td colspan="3" align="center" ><span class="Estilo40"><br><br><br>
       DISTRIBUIDORA VILLA ELENA E.I.R.L. <br>
R.U.C 20502196589 <BR>
PANADERIA Y PASTELERIA SAN SERAFINO <br>
AV. VENEZUELA 857 </span></td>
    </tr>
   <tr>
     <td colspan="3">-----------------------------------------------------</td>
    </tr>
   <tr>
    <td colspan="3"><table width="94%" height="25" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="62%"><span class="Estilo40">Nro.Serie S/N FFFF010241<br>
          <?php 
		  
		  
		  $strSQL40="select * from cab_mov where cod_cab='$referencia'";
		  $resultado40=mysql_query($strSQL40,$cn);
		  while($row40=mysql_fetch_array($resultado40)){
		  $numero=$row40['Num_doc'];
		  $serie=$row40['serie'];
		  $cod_ope=$row40['cod_ope'];
		  $cliente=$row40['cliente'];
		  $ruc=$row40['ruc'];
		  $fecha=$row40['fecha'];
		  $tc=$row40['tc'];
		  $b_imp=$row40['b_imp'];
		  $igv=$row40['igv'];
		  $servicio=$row40['servicio'];
		  $total_fac=$row40['total'];
		  		  
		  }
		  
		  
		  if($cod_ope=="BV"){
		  echo "BOLETA";
		  }else{
		  echo "FACTURA";
		  }
		  
		  ?> <?php echo $serie."-".$numero ?></span></td>
        <td width="3%">&nbsp;</td>
        <td width="35%"><span class="Estilo40"><?php echo substr($fecha,0,10);?><br>
            <?php echo substr($fecha,10,8)?></span></td>
      </tr>
    </table>	</td>
    </tr>
   <tr>
     <td colspan="3">-----------------------------------------------------</td>
   </tr>
   <?php if($cod_ope=="FA"){?>
   <tr>
     <td colspan="3"><span class="Estilo40">Cliente:<?php echo $cliente?><br>
       Ruc:<?php echo $ruc?><br>
       Dirección:<?php echo $direccion?></span></td>
   </tr>
   <tr>
    <td colspan="3">-----------------------------------------------------</td>
    </tr>
<?php }?>
<?php



      
//----------------------------------------------------------------------------------------
   

$strSQL4="select sum(cantidad) as cantidad,cod_prod,nom_prod  from det_mov where cod_cab='".$referencia."' group by cod_prod,nom_prod  order by cod_det";
 $resultado4=mysql_query($strSQL4,$cn);
// echo $strSQL4;
 while($row4=mysql_fetch_array($resultado4)){
 
 ?>
  <tr>
    <td width="20"><span class="Estilo40"></span><span class="Estilo40"><?php echo $row4['cantidad'];?></span></td>
    <td width="281"><span class="Estilo40"><?php echo $row4['nom_prod'];?></span></td>
    <td width="80" align="right"><span class="Estilo40"><?php 
	
	$strSQL40="select * from producto where cod_prod='".$row4['cod_prod']."'";
 $resultado40=mysql_query($strSQL40,$cn);
	$row40=mysql_fetch_array($resultado40);
	
	$total=$row40['precio']*$row4['cantidad'];
	echo number_format($total,2);
	?></span></td>
    </tr>
  <?php } ?>  
  
  <tr>
    <td colspan="3">-----------------------------------------------------</td>
    </tr>
  <tr>
    <td colspan="2"><span class="Estilo40">***Valor de Venta S/. </span></td>
    <td align="right"><span class="Estilo40"><?php echo number_format($b_imp,2);?></span></td>
    </tr>
  <tr>
    <td colspan="2"><span class="Estilo40">***Igv : 19%</span></td>
    <td align="right"><span class="Estilo40"><?php echo number_format($igv,2) ?></span></td>
    </tr>
  <tr>
    <td colspan="2"><span class="Estilo40">***Servicio</span></td>
    <td align="right"><span class="Estilo40"><?php echo number_format($servicio,2)?></span></td>
    </tr>
  <tr>
    <td colspan="2"><span class="Estilo40">***Total S/.</span></td>
    <td align="right"><span class="Estilo40"><?php echo number_format($total_fac,2);?></span></td>
    </tr>
  <tr>
    <td colspan="2"><span class="Estilo40">Vuelto:<?php echo number_format($vuelto,2);?></span></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo40">Tc:.<?php echo $tc?></span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo40">Usuario:<?php echo $_SESSION['des_caja']?></span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">-----------------------------------------------------</td>
    </tr>
  <tr>
    <td colspan="3" align="center"><span class="Estilo40">Gracias por su Preferencia </span></td>
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
       <input type="hidden" name="numero_mesa" value="<?php //echo $mesa?>">
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