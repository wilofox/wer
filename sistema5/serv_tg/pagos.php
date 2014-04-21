<?php session_start();
include("../conex_inicial.php");
$Codigo=$_REQUEST['codigo'];
$sql="select * from cab_mov CM inner join det_mov DM on CM.cod_cab=DM.cod_cab
 where CM.cod_cab='$Codigo'  ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	$cliente= $rowX['cliente'];	
	$moneda_doc= $rowX['moneda'];
	$total_doc=$rowX['total'];
	$tcambio_doc=$rowX['tc'];
	$doctip=$rowX['cod_ope'];	
	}

	if($moneda_doc==01){
		$simb_mon_doc="S/.";
		$total_sol=$total_doc;
		$total_dol=number_format($total_doc/$tcambio_doc,2);
	}else{
		$simb_mon_doc="US$.";
		$total_sol=number_format($total_doc*$tcambio_doc,2);
		$total_dol=$total_doc;
	}
	

if ($referencia<>''){
$referencia=$_REQUEST['referencia'];
$total=$_REQUEST['total'];
$condicion=$_REQUEST['condicion'];
$femision=$_REQUEST['femision'];
$fvencimiento=$_REQUEST['fvencimiento'];
$tipo=$_REQUEST['tipo'];
$tmoneda=$_REQUEST['tmoneda'];
$tcambio=$_REQUEST['tcambio'];
$fecha_aud=date('Y-m-d H:i:s');
	if($tmoneda==01){
		$tmoneda='dolares';
	}else{
		$tmoneda='soles';
	}
$strSQL0025="select  max(id) as id from pagos";
$resultado0025=mysql_query($strSQL0025,$cn);
$row0025=mysql_fetch_array($resultado0025);
//$codigo_pago=$row0025['id']+1;		
$codigo_pago=str_pad($row0025['id']+1, 6, "0", STR_PAD_LEFT);	

$strSQLRk="INSERT INTO pagos VALUES ('$codigo_pago', 'A', '1', '$femision', '$fvencimiento', '', '$total', '$tmoneda', '0', '', '$fecha_aud', '$tcambio', '$referencia', ''); ";
mysql_query($strSQLRk,$cn);

$strSQLRk="
update cab_mov set
saldo='0' where cod_cab ='$referencia'
";
mysql_query($strSQLRk,$cn);
}
	
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Caja Recaudaci&oacute;n (Cancelación)</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo15 {font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo25 {font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #FFFFFF; }
.Estilo27 {font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #003366; }
.Estilo48 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #FFFFFF; }
.Estilo49 {font-size: 11px; color: #FFFFFF; font-family: Arial, Helvetica, sans-serif;}
.Estilo53 {color: #A82222}
.Estilo54 {font-size: 14px}
.Estilo55 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	color: #CC0000;
}


-->
</style>
<link href="../styles.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
.Estilo56 {font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #333333; }
.Estilo57 {color: #333333}
.Estilo58 {
	color: #F40B0B;
	font-weight: bold;
	font-size: 18px;
}
.Estilo61 {font-size: 18px}
.Estilo62 {color: #FFFFFF}
-->
</style>
</head>
<script language="javascript" src="../modulos_usuarios/miAJAXlib3.js"></script>
    <script src="../jquery-1.2.6.js"></script>
    <script src="../jquery.hotkeys.js"></script>
<!--<script src="mootools-comprimido-1.11.js"></script>-->


	<script type="text/javascript" src="../modalbox/lib/prototype.js"></script>
	<script type="text/javascript" src="../modalbox/lib/scriptaculous.js?load=effects"></script>
	
	<script type="text/javascript" src="../modalbox/modalbox.js"></script>
	<link rel="stylesheet" href="../modalbox/modalbox.css" type="text/css" />


<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>
<script>

jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_esc').addClass('dirty'); 
close()
return false; });

jQuery(document).bind('keydown', 'f5',function (evt){jQuery('#_up').addClass('dirty');
//	alert('f5');
	var tecla=window.event.keyCode;
    if (tecla==116) {//alert("F5 deshabilitado!")
    event.keyCode=0;
	event.returnValue=false;}
	return false; });

	 
jQuery(document).bind('keydown', 'f7',function (evt){jQuery('#_f7').addClass('dirty');
		var total_doc=document.form1.importe.value;

		if(total_doc!=0){
		temporal_teclas='grabar';
		grabar_doc();
		}else{
		alert('No se puede guardar este documento');			
		}	

	event.keyCode=0;
	event.returnValue=false;


 return false; }); 	 
	 

function grabar_doc(){

			var total_doc=document.form1.importe.value;
			if(total_doc!=0){
			
			var condicion=document.form1.condicion.value;
			var femision=document.form1.fecha.value;
			var fvencimiento=document.form1.fecha2.value;
			var tipo="A";
			var tmoneda=document.form1.moneda_doc.value;
			var tcambio=document.form1.tc.value;
			var referencia=document.form1.referencia.value;
			
			//alert(referencia);
			  
doAjax('pagos.php','&referencia='+referencia+'&total='+total_doc+'&condicion='+condicion+'&femision='+femision+'&fvencimiento='+fvencimiento+'&tipo='+tipo+'&tmoneda='+tmoneda+'&tcambio='+tcambio,'mostrar_grabacion','get','0','1','','');
			
		}else{
		alert('No se puede guardar el documento sin  detalle');						
		}
		close()
}

function mostrar_grabacion(texto){

var texto2=texto.split("?");
var sucursal=texto[0];
var tipomov=texto[1];
var doc=texto[2];
var serie=texto[3];
var numero=texto[4];

//imprimir(sucursal,doc,serie,numero);

}
	 
function imprimir(sucursal,doc,serie,numero){
	
	var formato=find_prm(tab_formato,tab_cod);
	var impresion=find_prm(tab_impresion,tab_cod);
	
	var cola_imp=document.form1.cola_imp.value;
	var formato=document.form1.formato_imp.value;
	
	
	if(serie!='' && formato!=''){ 
	var win00=window.open('../formatos/'+formato+'?empresa='+sucursal+'&doc='+doc+'&serie='+serie+'&numero='+numero+'&impresion='+impresion+'&cola_imp='+cola_imp ,'ventana2','width=850,height=1000,top=100,left=100,scroolbars=yes,status=yes');	
	
	win00.focus();
	
	}else{
	alert('No es posible imprimir');
	}
	
	
}	 


</script>
<?php 
$total=0;
//$tc=3.040;
$fecha=date('d-m-Y');
//documento referencia
	$sqlCli="select * from cliente where codcliente='".$cliente."'  ";
	$resultadoCli=mysql_query($sqlCli,$cn);
		while($rowCli=mysql_fetch_array($resultadoCli)){
		$codcli= $rowCli['codcliente'];
		$razcli= $rowCli['razonsocial'];
		$ruccli= $rowCli['ruc'];
		$dircli= $rowCli['direccion'];
		} 
		
	$strSQl="select * from operacion where codigo='$doctip' and tipo='2' ";
	$resultado=mysql_query($strSQl,$cn);
	while($row=mysql_fetch_array($resultado)){
		$Documento=$row['descripcion'];
	}	
		
?>
<script>

function terminar(){
window.close();
}

function cerrar(){
window.parent.opener.formulario.ruc2.value="0";
}
</script>
<body  onLoad="" onBlur="">
<table width="584" border="1" bgcolor="#FFFFFF">
  <tr>
    <td width="574" colspan="5" valign="top">
	
	<form id="form1" name="form1" method="post" action="" >
      <table width="574" height="193" border="0" cellpadding="0" cellspacing="0">
        <tr bgcolor="#6699CC">
          <td height="39" bgcolor="#004993">&nbsp;</td>
          <td colspan="2" bgcolor="#004993"><table width="286" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td colspan="4" height="5"></td>
              </tr>
            <tr>
              <td width="22"><span class="Estilo48">F7 = </span></td>
              <td width="117"><span class="Estilo49">Imprimir</span></td>
              <td width="110">&nbsp;</td>
              <td width="37">&nbsp;</td>
            </tr>
          </table>            
            <label for="textfield"></label></td>
          <td colspan="2" align="right" bgcolor="#004993">&nbsp;</td>
          </tr>
        <tr>
          <td width="21" height="33" >&nbsp;</td>
          <td width="86"><span class="Estilo15">Ruc</span></td>
          <td width="272"><label for="textfield"></label>
            <input name="ruc3" type="text" disabled="disabled" id="ruc3"  onFocus="cambiardoc4()"  onBlur="cambiardoc3()" onChange="cambiardoc2()" onKeyUp="validartecla(event,this)" value="<?=$ruccli;?>" size="10" maxlength="11"/>
			 <input name="moneda_doc" id="moneda_doc" type="hidden" size="3" maxlength="5" value="<?php echo $moneda_doc?>">
			<input name="referencia" id="referencia" type="hidden" size="3" maxlength="5" value="<?php echo $Codigo?>">
			<input name="cola_imp" id="cola_imp" type="hidden" size="3" maxlength="5" value="">
            <input name="formato_imp" id="formato_imp" type="hidden" size="3" maxlength="5" value="">
			 
			</td>
          <td colspan="2" align="center" valign="middle"><div id="boleta" style="display:block;"><span class="Estilo54 Estilo58"><span class="Estilo61"><?=$Documento;?></span></span></div></td>
          </tr>
        <tr>
          <td height="29">&nbsp;</td>
          <td><span class="Estilo15">Cliente</span></td>
          <td><input name="cliente2" disabled="disabled"  type="text" id="cliente2" size="30" maxlength="200" value="<?=$razcli;?>" /></td>
		  <td bgcolor="#FFFF99">&nbsp;&nbsp;&nbsp;<span class="Estilo56">Total (<?php echo $simb_mon_doc ?>) </span></td>
          <td width="72" bgcolor="#FFFF99" align="right"><input name="importe" type="text" id="importe"  style="text-align:right; font:bold ; font-size:12px" value="<?php echo $total_doc?>" size="10" readonly="readonly" /></td>
          </tr>
		<tr>
          <td height="22">&nbsp;</td>
          <td><span class="Estilo15">Direcci&oacute;n</span></td>
          <td><input name="direc2" disabled="disabled"  type="text" id="cliente3" size="30" maxlength="200" value="<?=$dircli;?>" /></td>
          <td width="123">&nbsp;</td>
          <td align="right">&nbsp;</td>
        </tr>
        <tr>
          <td height="22">&nbsp;</td>
          <td><span class="Estilo15">Condici&oacute;n</span></td>
          <td><table width="269" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="141"><select name='condicion' style='width:120' >
						<option value='1'>contado</option>
					  </select> </td>
              <td width="97"> <span class="Estilo15">T.C.</span>
            <input name="tc"  style="color:#990000; font:bold ; text-align:right"type="text" id="tc" size="5" maxlength="6" value="<?php echo $tc?>" /></td>
            </tr>
          </table>		 </td>
          <td>&nbsp;</td>
          <td align="right">&nbsp;</td>
        </tr>
        <tr>
          <td height="22">&nbsp;</td>
          <td><span class="Estilo15">Fecha Doc. </span></td>
          <td><input name="fecha" type="text" id="fecha" size="9" maxlength="10" value="<?php echo $fecha?>" />
            <span class="Estilo15">&nbsp;&nbsp;Fecha Venc. &nbsp;
            <input name="fecha2" type="text" id="fecha2" size="9" maxlength="10" value="<?php echo $fecha?>" />
            </span></td>
          <td>&nbsp;</td>
          <td align="right">&nbsp;</td>
        </tr>
        
        <tr>
          <td height="9" colspan="5"></td>
          </tr>
        <tr>
          <td colspan="5" height="5"></td>
          </tr>
        <tr>
          <td height="12" colspan="5"></td>
          </tr>
      </table>
	  <div id="clientes" style="position:absolute; left:67px; top:115px; width:300px; height:180px; z-index:1; visibility:hidden; z-index:1"> </div>
	  
	    <div id="nuevo_cliente" style="position:absolute; left:110px; top:110px; width:400px; height:280px; z-index:1; visibility:hidden; z-index:1"> </div>
      </form>
    </td>
  </tr>
</table>

</body>
</html>