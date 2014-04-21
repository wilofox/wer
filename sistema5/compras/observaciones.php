<?php    
session_start();
include('../conex_inicial.php');

$codigo=$_REQUEST['doc'];

$strSQlT="select * from operacion where codigo='$codigo'";
$resultadoT=mysql_query($strSQlT,$cn);
$rowT=mysql_fetch_array($resultadoT);
$obs1=$rowT['obs1'];
$obs2=$rowT['obs2'];
$obs3=$rowT['obs3'];
$obs4=$rowT['obs4'];
$obs5=$rowT['obs5'];

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Otros Datos</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
}
.Estilo4 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo5 {font-size: 11px}
-->
</style>

</head>

<body onLoad="document.form1.obs1.focus();">
<form name="form1" method="post" action="">
  <table width="323" height="252" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="22">&nbsp;</td>
      <td width="106" height="19">&nbsp;</td>
      <td width="195">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2"><span class="Estilo1">Observaciones</span>:</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td height="28"><span class="Estilo4"><?php echo $obs1?></span></td>
      <td><input type="text" name="obs1" value="<?php echo $_REQUEST['obs1']?>"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td height="29"><span class="Estilo5"><span class="Estilo4"><?php echo $obs2?></span></span></td>
      <td><input type="text" name="obs2" value="<?php echo $_REQUEST['obs2']?>"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td height="27"><span class="Estilo5"><span class="Estilo4"><?php echo $obs3?></span></span></td>
      <td><input type="text" name="obs3" value="<?php echo $_REQUEST['obs3']?>"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td height="30"><span class="Estilo5"><span class="Estilo4"><?php echo $obs4?></span></span></td>
      <td><input type="text" name="obs4" value="<?php echo $_REQUEST['obs4']?>"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="Estilo4"><?php echo $obs5?></span></td>
      <td><input type="text" name="obs5" value="<?php echo $_REQUEST['obs5']?>"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="40" colspan="3" align="center"><label>
        <input type="button" name="Submit" value="Aceptar" onClick="pasae_valor()">
        <input type="button" name="Submit2" value="Cancelar" onClick="cancelar()">
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>

<script>
function pasae_valor(){
window.parent.opener.document.formulario.obs1.value=document.form1.obs1.value;
window.parent.opener.document.formulario.obs2.value=document.form1.obs2.value;
window.parent.opener.document.formulario.obs3.value=document.form1.obs3.value;
window.parent.opener.document.formulario.obs4.value=document.form1.obs4.value;
window.parent.opener.document.formulario.obs5.value=document.form1.obs5.value;
close();
}

function cancelar(){
window.close();
}

</script>
