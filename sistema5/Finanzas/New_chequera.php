<?php
session_start();
include_once('mcc/MCheques.php');
include_once('mcc/MBancos.php');
include_once('mcc/MCuentas.php');
include_once('../funciones/funciones.php');

unset($_SESSION['Multifactura']);
$mb=new MBancos();
$mc=new MCheques();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo9 {
	font-size: 10px;
	font-weight: bold;
}
.Estilo112 {color: #000000}
.Estilo113 {	color: #CC3300;
	font-weight: bold;
	font-size: 10px;
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style></head>


<link href="../styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
background-color:#F3F3F3;   
}
.Estilo13 {color: #0767C7}

.Estilo100 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
.texto1{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #000000;
}
.texto2{
	font-family: Verdana,Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #000000;
}
</style>
<script language="javascript" src="miAJAXlib3.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>
<script language="javascript">
function sele_form(tip,control){
	var ope='';
	switch(control.name){
		case 'cmbsuc': ope='cuenta';env=document.getElementById('cmbbanco').value;break;
		case 'cmbbanco': ope='cuenta';env=control.value;break;
		case 'cmbcuenta': ope='moneda';env=control.value;break;
	}
	if(ope!=""){
		doAjax('control.php','accion=combo&valor='+control.value+'&ope='+ope+'&suc='+document.getElementById('cmbsuc').value,'mostrar_combo','get','0','1','','');
	}
}
function mostrar_combo(texto){
	var rpt=texto.split("|");
	control=rpt[1];
	document.getElementById(control).innerHTML=rpt[0];
}
function grabar(){
	var sucu=document.getElementById('cmbsuc').value;
	var banc=document.getElementById('cmbbanco').value;
	var cuen=document.getElementById('cmbcuenta').value;
	var tipo=document.getElementById('cmbtipo').value;
	if(document.getElementById('txtmone')!=undefined){
		var mone=document.getElementById('txtmone').value;
	}else{
		var mone="";
	}
	var maut=document.getElementById('txtnum').value;
	var faut=document.getElementById('txtfec').value;
	var fven=document.getElementById('txtfecvcto').value;
	var nini=document.getElementById('txtnumini').value;
	var nfin=document.getElementById('txtnumfin').value;
	if(sucu!="" && banc!="" && cuen!="" && tipo!="" && mone!="" && maut!="" && faut!="" && nini!="" && nfin!="" && fven!=""){
		doAjax('control.php','accion=guardarchequera&sucu='+sucu+'&banc='+banc+'&cuen='+cuen+'&tipo='+tipo+'&mone='+mone+'&maut='+maut+'&faut='+faut+'&nini='+nini+'&nfin='+nfin+'&fven='+fven,'mostrar_grabacion','get','0','1','','');
	}else{
		alert('Datos incompletos');
	}
}
function mostrar_grabacion(texto){
	//alert(texto);
	window.close();
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<table width="491" border="1">
  <tr>
    <td colspan="3">Registro de Chequeras</td>
  </tr>
  <tr>
    <td>Empresa</td>
    <td><select style="width:200px;" id="cmbsuc" name="cmbsuc" onchange="sele_form('1',this)">
      <option value="0">Seleccione Sucursal</option>
      <?php 
	$lista=$mb->Listarsuc();
	for($i=0;$i<count($lista);$i++){
	?>	
      <option value="<?php echo $lista[$i]['cod_suc']; ?>"><?php echo $lista[$i]['des_suc']; ?></option>
    <?php }?></select></td>
    <td width="158" rowspan="9" align="center" valign="middle"><input type="button" onclick="grabar()" name="cmdguardar" value="Guardar" /></td>
  </tr>
  <tr>
    <td width="98">Banco</td>
    <td width="213"><select style="width:200px;" id="cmbbanco" name="cmbbanco" onchange="sele_form('1',this)">
      <option value="0">Seleccione Banco</option>
      <?php 
	$lista=$mb->Listarban();
	for($i=0;$i<count($lista);$i++){
	?>	
      <option value="<?php echo $lista[$i]['codigo']; ?>"><?php echo $lista[$i]['descrip']; ?></option>
    <?php }?></select></td>
  </tr>
  <tr>
    <td>Cuenta</td>
    <td><div id="cuenta_det"><select style="width:200px;" id="cmbcuenta" name="cmbcuenta" onchange="sele_form('2',this.value)">
    <option value="0">Seleccione Banco</option>
    </select></div></td>
  </tr>
  <tr>
    <td>Tipo</td>
    <td><select style="width:200px;" id="cmbtipo" name="cmbtipo">
    <option value="0">Seleccione Tipo de Cheque</option>
      <?php 
	$lista=$mc->Listartip();
	for($i=0;$i<count($lista);$i++){
	?>	
      <option value="<?php echo $lista[$i]['id']; ?>"><?php echo $lista[$i]['codigo']."-".$lista[$i]['descripcion']; ?></option>
    <?php }?></select></td>
  </tr>
  <tr>
    <td>Moneda</td>
    <td><div id="mone">&nbsp;</div></td>
  </tr>
  <tr>
    <td>Numero Aut.</td>
    <td><input name="txtnum" type="text" id="txtnum" size="35" /></td>
  </tr>
  <tr>
    <td>Fecha Aut.</td>
    <td><input name="txtfec" type="text" id="txtfec" size="15" readonly="readonly" maxlength="10" />
    <button type="reset" id="f_trigger_b2">...</button>
	<script type="text/javascript">
		Calendar.setup({
			inputField     :    "txtfec",      
			ifFormat       :    "%d-%m-%Y",      
			showsTime      :    true,            
			button         :    "f_trigger_b2",   
			singleClick    :    true,           
			step           :    1                
		});
	</script></td>
  </tr>
  <tr>
    <td>Numero Ini.</td>
    <td><input name="txtnumini" type="text" id="txtnumini" size="35" /></td>
  </tr>
  <tr>
    <td>Numero Fin.</td>
    <td><input name="txtnumfin" type="text" id="txtnumfin" size="35" /></td>
  </tr>
  <tr>
    <td>Fecha Venc.</td>
    <td><input name="txtfecvcto" type="text" id="txtfecvcto" readonly="readonly" size="15" maxlength="10" />
     <button type="reset" id="f_trigger_b1">...</button>
	<script type="text/javascript">
		Calendar.setup({
			inputField     :    "txtfecvcto",      
			ifFormat       :    "%d-%m-%Y",      
			showsTime      :    true,            
			button         :    "f_trigger_b1",   
			singleClick    :    true,           
			step           :    1                
		});
	</script></td>
  </tr>
</table>
</body>
</html>