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
  factory.printing.header = "";
  factory.printing.footer = "";
  factory.printing.SetMarginMeasure(2); // margins in inches
  factory.printing.printer = cola;
  factory.printing.paperSize = "";
  factory.printing.paperSource = "";
  
  factory.printing.leftMargin = 0.01;
  factory.printing.topMargin = 0.01;
  factory.printing.rightMargin = 0.01;
  factory.printing.bottomMargin = 0.01;
  
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


function SpoolStatus(start) {
  // provide some visual feedback on spooling status
  window.status = start?
    "Please wait for spooling to complete ..." :
    "Spooling is complete";
	//window.parent.opener.formulario.termino.focus();
	//window.parent.opener.form1.ruc3.focus();
//---------------------------------------------------------------	
	// window.close();
	
//--------------------------------------------------------------
	//window.parent.opener.terminar();
	
	 // document.form1.ruc.focus();
	
	//alert("Imprimiendo....");		

}


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
