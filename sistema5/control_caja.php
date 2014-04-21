<?php include('conex_inicial.php');

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo12 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.Estilo15 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #990000;
}
-->
</style>
<script language="javascript" src="miAJAXlib2.js"></script>

</head>
<?php  

$usuario=$_REQUEST['usuario'];
$caja=$_REQUEST['caja'];
$serie_rapida=$_REQUEST['serie_rapida'];
$serie_mesa=$_REQUEST['serie_mesa'];
$numerofar=$_REQUEST['numerofar'];
$numerobvr=$_REQUEST['numerobvr'];
$numerofam=$_REQUEST['numerofam'];
$numerobvm=$_REQUEST['numerobvm'];

	if(isset($_REQUEST['Submit'])){
	$strSQl="update caja set serie1='".$serie_rapida."',num1_fa='".$numerofar."',num1_bv='".$numerobvr."',serie2='".$serie_mesa."',num2_fa='".$numerofam."',num2_bv='".$numerobvm."' where codigo='".$usuario."'";
	
	//echo $strSQl;
	mysql_query($strSQl,$cn);
	}

?>

<script>

function buscar_usuario(texto){
//alert(texto);
//
$cadena=texto.split("-");
$cadena[0];
document.form1.caja2.value=$cadena[0];

limpiar();

	if($cadena[1]==""){
	document.form1.serie_rapida.disabled=true;
	document.form1.chfar.disabled=true;
	document.form1.chbvr.disabled=true;
	document.form1.numerofar.disabled=true;
	document.form1.numerobvr.disabled=true;
	
	}else{
	document.form1.vr.checked=true;
	document.form1.serie_rapida.disabled=false;
	document.form1.serie_rapida.value=$cadena[1];
	
		if($cadena[2]==""){
		document.form1.numerofar.disabled=true;
		}else{
		document.form1.chfar.checked=true;
		document.form1.numerofar.value=$cadena[2];
		}
		if($cadena[3]==""){
		document.form1.numerobvr.disabled=true;
		}else{
		document.form1.chbvr.checked=true;
		document.form1.numerobvr.value=$cadena[3];
		}
		
	
	}
	
	
	if($cadena[4]==""){
	document.form1.serie_mesa.disabled=true;
	document.form1.chfam.disabled=true;
	document.form1.chbvm.disabled=true;
	document.form1.numerofam.disabled=true;
	document.form1.numerobvm.disabled=true;

	}else{
	document.form1.me.checked=true;
	document.form1.serie_mesa.disabled=false;
	document.form1.serie_mesa.value=$cadena[4];
	
		if($cadena[5]==""){
		document.form1.numerofam.disabled=true;
		}else{
		document.form1.chfam.checked=true;
		document.form1.numerofam.value=$cadena[5];
		}
		if($cadena[6]==""){
		document.form1.numerobvm.disabled=true;
		}else{
		//alert($cadena[6]);
		document.form1.chbvm.checked=true;
		document.form1.numerobvm.value=$cadena[6];
		}
		
	
	}


	
	


}


function limpiar(){
document.form1.me.checked=false;
document.form1.vr.checked=false;
document.form1.chfar.checked=false;
document.form1.chbvr.checked=false;
document.form1.chfam.checked=false;
document.form1.chfam.checked=false;

document.form1.numerofar.value="";
document.form1.numerobvr.value="";

document.form1.numerofam.value="";
document.form1.numerobvm.value="";

document.form1.serie_mesa.value="";
document.form1.serie_rapida.value="";

document.form1.chfar.disabled=false;
document.form1.chbvr.disabled=false;
document.form1.chfam.disabled=false;
document.form1.chbvm.disabled=false;

document.form1.numerofar.disabled=false;
document.form1.numerobvr.disabled=false;
document.form1.numerofam.disabled=false;
document.form1.numerobvm.disabled=false;

}

</script>

<body>
<form name="form1" method="post" action="">
  <table width="613" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="4">&nbsp;</td>
      <td width="63">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
      <td width="4">&nbsp;</td>
    </tr>
    <tr>
      <td height="31">&nbsp;</td>
      <td><span class="Estilo12">Usuario</span></td>
      <td colspan="3"><span class="Estilo15">
        <select name="usuario" onChange="doAjax('buscar_caja.php','usu='+document.form1.usuario.value,'buscar_usuario','get','0','1','','');">
          <?php 
		
  $resultados1 = mysql_query("select * from usuarios order by codigo ",$cn); 
while($row1=mysql_fetch_array($resultados1))
{
		?>
          <option value="<?php echo $row1['caja'] ?>"><?php echo $row1['usuario'] ?></option>
          <?php }?>
        </select>
      </span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="30">&nbsp;</td>
      <td><span class="Estilo12">Caja</span></td>
      <td colspan="3"><input disabled="disabled" name="caja2" type="text" size="10">
      <input name="caja" type="hidden" size="10"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="4" rowspan="6"><table width="446" height="64" border="1" cellpadding="0" cellspacing="0">
          <tr>
            <td><table width="626" border="0" cellpadding="0" cellspacing="0" bgcolor="#EEEEEE">
                <tr>
                  <td colspan="4">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td colspan="2">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><input  onClick="desactivar()" type="checkbox" name="vr" value="1" id="vr">
                  <label for="checkbox"></label></td>
                  <td colspan="2"><span class="Estilo12">Venta Rapida </span></td>
                  <td><input name="serie_rapida" type="text" size="5"></td>
                  <td width="18"><input type="checkbox" name="me" value="2" id="me" onClick="desactivar()"></td>
                  <td colspan="2"><span class="Estilo12">Salon</span></td>
                  <td width="188"><input name="serie_mesa" type="text" size="5" onBlur="llenar2()"></td>
                  <td width="17">&nbsp;</td>
                </tr>
                <tr>
                  <td width="15" align="right">&nbsp;</td>
                  <td width="27" height="33" align="right">&nbsp;</td>
                  <td width="79" align="right"><span class="Estilo12">
                    <input type="checkbox" name="chfar" value="checkbox" id="chfar" onClick="desactivar()">
                  FA</span></td>
                  <td width="17" align="right">&nbsp;</td>
                  <td width="172"><span class="Estilo12">
                    <input disabled="disabled" name="far" type="text" size="3">
                    <input name="numerofar" type="text" size="10" maxlength="7" onFocus="llenar()">
                  </span></td>
                  <td>&nbsp;</td>
                  <td width="81" align="right"><span class="Estilo12">
                    <input type="checkbox" name="chfam" value="checkbox" id="chfam" onClick="desactivar()">
                  FA</span></td>
                  <td width="12" align="right">&nbsp;</td>
                  <td><span class="Estilo12">
                    <input disabled="disabled" name="fam" type="text" size="3">
                    <input name="numerofam" type="text" size="10" maxlength="7"  onFocus="llenar2()">
                  </span></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td align="right">&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right"><span class="Estilo12">
                    <input type="checkbox" name="chbvr" value="checkbox" id="chbvr" onClick="desactivar()">
                  BV</span></td>
                  <td align="right">&nbsp;</td>
                  <td><span class="Estilo12">
                    <input disabled="disabled" name="bvr" type="text" size="3">
                    <input name="numerobvr" type="text" size="10" maxlength="7" onFocus="llenar()">
                  </span></td>
                  <td>&nbsp;</td>
                  <td height="23" align="right"><span class="Estilo12">
                    <input type="checkbox" name="chbvm" value="checkbox" id="chbvm" onClick="desactivar()">
                  BV</span></td>
                  <td height="23" align="right">&nbsp;</td>
                  <td><span class="Estilo12">
                    <input disabled="disabled" name="bvm" type="text" size="3">
                    <input name="numerobvm" type="text" size="10" maxlength="7" onFocus="llenar2()">
                  </span></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td align="right">&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td height="23" align="right">&nbsp;</td>
                  <td height="23" align="right">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
            </table></td>
          </tr>
      </table></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="23">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="354">&nbsp;</td>
      <td width="191"><input type="submit" name="Submit" value="Guardar">
      <input type="submit" name="Submit2" value="Cancelar"></td>
      <td width="6">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
<script>

function desactivar(){
//alert(document.form1.vr.value);
	if(!document.form1.vr.checked){
	document.form1.chfar.disabled=true;
	document.form1.chbvr.disabled=true;
	document.form1.serie_rapida.disabled=true;
	}else{
	document.form1.chfar.disabled=false;
	document.form1.chbvr.disabled=false;
	document.form1.serie_rapida.disabled=false;
	}	
//document.form1.serie_rapida.disabled=true;
//document.form1.numerofar.disabled=true;
//document.form1.numerobvr.disabled=true;

	if(!document.form1.chfar.checked){
	document.form1.numerofar.disabled=true;
	}else{
	document.form1.numerofar.disabled=false;
	}
	
	if(!document.form1.chbvr.checked){
	document.form1.numerobvr.disabled=true;
	}else{
	document.form1.numerobvr.disabled=false;
	}		
	//---------------------mesas--------------------
	
	if(!document.form1.me.checked){
	document.form1.chfam.disabled=true;
	document.form1.chbvm.disabled=true;
	document.form1.serie_mesa.disabled=true;
	}else{
	document.form1.chfam.disabled=false;
	document.form1.chbvm.disabled=false;
	document.form1.serie_mesa.disabled=false;
	}	
	
	if(!document.form1.chfam.checked){
	document.form1.numerofam.disabled=true;
	}else{
	document.form1.numerofam.disabled=false;
	}
	
	if(!document.form1.chbvm.checked){
	document.form1.numerobvm.disabled=true;
	}else{
	document.form1.numerobvm.disabled=false;
	}	
	
	
}



function llenar(){
if(document.form1.chfar.checked){
document.form1.far.value=document.form1.serie_rapida.value;
}
if(document.form1.chbvr.checked){
document.form1.bvr.value=document.form1.serie_rapida.value;
}
//document.form1.numerofar.value='0000001';
//document.form1.numerobvr.value='0000001';
}
function llenar2(){

	if(document.form1.chfam.checked){
	document.form1.fam.value=document.form1.serie_mesa.value;
	}
	if(document.form1.chbvm.checked){
	document.form1.bvm.value=document.form1.serie_mesa.value;
	}
}
</script>

</html>
