<?php include('conex_inicial.php');?>

<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 00px;
	margin-bottom: 0px;
}
.Estilo14 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo17 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color:#FFFFFF }
.Estilo34 {font-size: 10}
.Estilo43 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
	color: #990000;
}
.Estilo46 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.Estilo47 {font-size: 10px}
-->
</style>
<script language="javascript" src="miAJAXlib2.js"></script>



<script>
function generarflujo(e){

	if(e.keyCode == 13){
	//alert('enter');
	doAjax('gen_flujo.php','fecha='+document.form1.fecha.value,'gen_flujo','get','0','1','','');
	}

}

function gen_flujo(texto){
//alert('enter');
document.getElementById('flujo').innerHTML=texto;

doAjax('calcular_saldos.php','fecha='+document.form1.fecha.value,'calcular_saldos','get','0','1','','');

}

function calcular_saldos(texto){

var saldos=texto.split('?');
document.form1.egreso_soles.value=saldos[0];
document.form1.ingreso_soles.value=saldos[1];
document.form1.saldo_final_soles.value=saldos[2];

document.form1.egreso_dolar.value=saldos[3];
document.form1.ingreso_dolar.value=saldos[4];
document.form1.saldo_final_dolar.value=saldos[5];

}


function insertar_flujo(){
var validar=true

	if(document.form1.fecha.value==""){
	validar=false
	alert('ingrese una fecha válida');
	
	}

	if(validar){
		doAjax('gen_flujo.php','fecha='+document.form1.fecha.value+'&tipo='+document.form1.tipo.value+'&tcambio='+document.form1.tcambio.value+'&numero='+document.form1.numero.value+'&moneda='+document.form1.moneda.value+'&monto='+document.form1.monto.value+'&obs='+document.form1.obs.value+'&accion=grabar','gen_flujo','get','0','1','','');
		
		
	}

}

function eliminar(cod){

doAjax('gen_flujo.php','id='+cod+'&accion=eliminar&fecha='+document.form1.fecha.value,'gen_flujo','get','0','1','','');

}



</script>


<html>
<body>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" height="164%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="1%" height="19">&nbsp;</td>
      <td width="54%">&nbsp;</td>
      <td width="2%" rowspan="3" valign="top">&nbsp;</td>
      <td width="43%">&nbsp;</td>
    </tr>
    <tr>
      <td height="203">&nbsp;</td>
      <td valign="top">
	  
	  <table width="414" height="297" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="43" colspan="2"><span class="Estilo43">FLUJO DE CAJA </span></td>
            <td height="43">&nbsp;</td>
            <td height="43">&nbsp;</td>
          </tr>
          <tr>
            <td height="43"><span class="Estilo46">Fecha </span></td>
            <td height="43" colspan="2"><span class="Estilo14">
              <input style="background: #FFE9D2" name="fecha" type="text" size="10" maxlength="10"  onkeypress="generarflujo(event)">
              <span class="Estilo47">(dd/mm/aaaa</span> ) </span></td>
            <td height="43">&nbsp;</td>
          </tr>
          <tr>
            <td width="17%" height="32"><span class="Estilo14">Tipo</span></td>
            <td width="25%"><span class="Estilo14">
              <select name="tipo">
                <option value="I">Ingreso</option>
                <option value="E">Egreso</option>
              </select>
            </span></td>
            <td width="16%"><span class="Estilo14">T.C.</span></td>
            <td width="42%"><input name="tcambio" type="text" size="10" maxlength="10" value="<?php echo $tc?>"/></td>
          </tr>
          <tr>
            <td height="30"><span class="Estilo14">Numero</span></td>
            <td><input name="numero" type="text" size="10" maxlength="10" /></td>
            <td><span class="Estilo14">Moneda</span></td>
            <td><span class="Estilo14">
              <select name="moneda">
                <option value="S/.">Soles (S/.)</option>
                <option value="U$.">Dolares (U$.)</option>
              </select>
            </span></td>
          </tr>
          <tr>
            <td height="42"><span class="Estilo14">Monto</span></td>
            <td><input name="monto" type="text" size="10" maxlength="10" /></td>
            <td><span class="Estilo14">Obs:</span></td>
            <td><textarea name="obs" cols="20"></textarea></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="right"><input type="button" name="Submit" value="Aceptar" onClick="insertar_flujo()" /></td>
          </tr>
          <tr>
            <td height="107" colspan="4"><div  id="flujo"></div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
      </table></td>
      <td valign="top" align="center">
	  
	  <table width="333" height="213" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
          <tr>
            <td><table width="309" height="193" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="41" colspan="3"><span class="Estilo43">SALDO DISPONIBLE </span></td>
                </tr>
                <tr bgcolor="#CCCCCC">
                  <td height="26" colspan="3" align="center"><span class="Estilo46">Dinero en Efectivo </span></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td align="center"><span class="Estilo46">Soles</span></td>
                  <td align="center"><span class="Estilo46">Dolares</span></td>
                </tr>
                <tr>
                  <td width="31%"><span class="Estilo14">Saldo Inicial </span></td>
                  <td width="32%" align="center"><input style="text-align:right" name="saldo_inicial_soles" type="text" size="8" maxlength="10" value="0.00" /></td>
                  <td width="37%" align="center"><input style="text-align:right" name="textfield9" type="text" size="8" maxlength="10" value="0.00" /></td>
                </tr>
                <tr>
                  <td><span class="Estilo14">Ingresos </span></td>
                  <td align="center"><input style="text-align:right" name="ingreso_soles" type="text" size="8" maxlength="10" /></td>
                  <td align="center"><input style="text-align:right" name="ingreso_dolar" type="text" size="8" maxlength="10" /></td>
                </tr>
                <tr>
                  <td><span class="Estilo14">Egresos</span></td>
                  <td align="center"><input style="text-align:right" name="egreso_soles" type="text" size="8" maxlength="10" /></td>
                  <td align="center"><input style="text-align:right" name="egreso_dolar" type="text" size="8" maxlength="10" /></td>
                </tr>
                <tr>
                  <td><span class="Estilo14">Saldo Final </span></td>
                  <td align="center"><input style="text-align:right" name="saldo_final_soles" type="text" size="8" maxlength="10" /></td>
                  <td align="center"><input style="text-align:right" name="saldo_final_dolar" type="text" size="8" maxlength="10" /></td>
                </tr>
                <tr>
                  <td><span class="Estilo34"></span></td>
                  <td><span class="Estilo34"></span></td>
                  <td><span class="Estilo34"></span></td>
                </tr>
            </table></td>
          </tr>
      </table></td>
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
