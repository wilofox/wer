<script LANGUAGE="JavaScript"> 
function printer() 
{ 
vbPrintPage() 
return false; 
} 
</script> 
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
<html> 
<head> 
<meta NAME="GENERATOR" Content="Microsoft Visual Studio 6.0"> 
</head> 
<body onLoad="printer()"> 
<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT> 
Preparate MUNDO por que me voy a imprimir 
Si tenes mas de una impresora va a continuar saliendo el cuadro de la impresora 
</body> 
</html> 