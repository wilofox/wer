<?php session_start();
include('conex_inicial.php');

$_SESSION['tienda']=$_REQUEST['sucu'];
$_SESSION['sucursal']=$_REQUEST['tien'];
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
  
  factory.printing.leftMargin = 0.0
  factory.printing.topMargin = 0.0
  factory.printing.rightMargin = 0.0
  factory.printing.bottomMargin = 0.0
  
  //factory.printing.leftMargin = 0.75
  //factory.printing.topMargin = 1.5
  //factory.printing.rightMargin = 0.75
  //factory.printing.bottomMargin = 1.5
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
    "Please wait for spooling to complete ..." :window.close();
    "Spooling is complete";
	//window.parent.opener.formulario.termino.focus();
	//window.parent.opener.formulario.ruc2.value="1";
	
//window.open('empresa.php','vent','width=585,height=480,top=180,left=200,status=yes,scrollbars=yes');

//	
	
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
.Estilo50 {
	font-family: Tahoma, Arial;
	font-size: 15px;
}
-->
</style>
</head>

<script>
function defrente(){
//window.parent.opener.formulario.termino.focus();


viewinit1();
Print(false, top);
//window.parent.opener.formulario.ruc2.value="1";
window.open('empresa.php','vent','width=585,height=480,top=180,left=200,status=yes,scrollbars=yes');


//window.close();
}

</script>
<!--onLoad="defrente()"-->
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

<!--
<object id="factory" style="display:none" viewastext classid="clsid:1663ED61-23EB-11D2-B92F-008048FDD814">
<param name="template" value="MeadCo://IE7" />
</object>
-->

<div id="installFailure" style="width:200px; height:10">
	
</div>


<div id="installOK" style="width:300px; height:10">


 <table width="300" border="0" cellpadding="0" cellspacing="0">
   <tr>
     <td colspan="4" align="center"><span class="Estilo50"><br>
        <br>
         <br>
         <br>
     Mr STEAK<br>
       Inversiones CCOYPA S.A.C.<BR>
       Av. Ferrocarril N&ordm;1035 2do Nivel-Tda Lc <br>
       Centro Comercial Real Plaza Huancayo <br>
      RUC: 20518623681 Telf.064221494</span></td>
    </tr>
   <tr>
     <td colspan="4">-----------------------------------------------------</td>
    </tr>
   <tr>
     <td colspan="4"><table width="100%" height="25" border="0" cellpadding="0" cellspacing="0">
       <tr><?php 
	   
	 $strSQL4="select count(cod_det) as contador from det_mov group by cod_cab";
	 $resultado4=mysql_query($strSQL4,$cn);
	 $cant=mysql_num_rows($resultado4);
	 $cant=$cant+1;
	 $num_orden=str_pad($cant, 7, "0", STR_PAD_LEFT);
	 
	 ?>
         <td width="401"><span class="Estilo50"><br>
           A. SUNAT 23845011506<br>
           Ticket N&ordm; <?php echo $num_orden?><br>&nbsp;</span></td>
         <td width="10">&nbsp;</td>
         <td width="189"><span class="Estilo50"><?php echo date('d/m/Y');?><br>
            <?php echo date('h:i:s a')?></span></td>
       </tr>
     </table></td>
   </tr>
  <tr>
    <td colspan="4">-----------------------------------------------------</td>
    </tr>
<?php 

/*

$strSQL22="select max(cod_cab) as codigo from cab_mov";
$resultado22=mysql_query($strSQL22,$cn);
  $row22=mysql_fetch_array($resultado22);
  $var22=$row22['codigo']+1;
  $cod_cab=str_pad($var22, 6, "0", STR_PAD_LEFT);
   mysql_free_result($resultado22);
   

$cod_operacion="bv";
$serie="001";
//$cod_vendedor="responsable";
//$cliente="";

$strSQL33="select max(num_doc) as codigo from cab_mov where cod_ope='$cod_operacion' and serie='$serie'";
$resultado33=mysql_query($strSQL33,$cn);
  $row33=mysql_fetch_array($resultado33);
  $var33=$row33['codigo']+1;
  $num_doc=str_pad($var33, 7, "0", STR_PAD_LEFT);
   mysql_free_result($resultado33);

   */
   
//----------------------------------------------------------------------------------------
   

$strSQL4="select * from det_mov where cod_cab='".$_SESSION['registro']."' order by cod_det";
 $resultado4=mysql_query($strSQL4,$cn);
// echo $strSQL4;
 while($row4=mysql_fetch_array($resultado4)){
 
 ?>
  <tr>
    <td width="8">&nbsp;</td>
    <td width="21"><span class="Estilo50"><?php echo $row4['cantidad'];?></span></td>
    <td width="218"><span class="Estilo50"><?php echo $row4['nom_prod'];?></span></td>
    <td width="53"><span class="Estilo50"><?php echo $row4['notas'];?></span></td>
  </tr>
  <?php } ?>  
  
  <tr>
    <td colspan="4">-----------------------------------------------------</td>
    </tr>
</table>



 <div id=idControls class="noprint" style="width:200px; height:10">
 <b>Botones para Impresion directa</b>

 <div id="idBtn" style="width:200px; height:10">
 
 <p><input type="button" value="Hp "
 onclick="viewinit1();Print(false, top)">
 <input type="button" value="epson "
  onclick="viewinit2();Print(false, top)">
  </div>

 <p><b>Select the template type to use: </b>
 <select onChange="newTemplate(this)" size="1">
 <option value="default">Default</option>
 <option value="IE55">IE 5.5/6</option>
 <option selected value="IE7">IE 7</option></select></p>
 <p>&nbsp;</p>
</div>

<p>

<!--<iframe name="idFrame" width="100%" height="60%" src="frame.htm">
</iframe>
-->
</div>

</body>
</html>