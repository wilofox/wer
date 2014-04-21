<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo14 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.Estilo15 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #990000;
}
-->
</style>
</head>

<body>
<table width="679" height="102" border="0" cellpadding="0" cellspacing="0" bgcolor="#6699CC">
  <tr>
    <td height="59"><table width="650" height="43" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bgcolor="#E0E0E0">
      <tr>
        <td height="43" align="center"><table width="628" height="25" border="0" align="left" cellpadding="0" cellspacing="0">
            <tr>
              <td width="175"><table width="172" border="0" cellpadding="0" cellspacing="0" id="pro" >
                  <tr>
                    <td width="172"><span class="Estilo14">Producto:</span>
                        <input  name="codprod"  type="text" size="8"  onfocus="activar2();" onBlur="desactivar2()"/>
                        <span class="Estilo15">
                        <input type="button" name="f8" value="f8">
                        <input name="pro" type="hidden" size="3"  value="0"/>
                      </span></td>
                  </tr>
              </table></td>
              <td width="199"><span class="Estilo14">Termino</span><span class="Estilo14">:
                <input name="termino" type="text" size="15" onFocus="activar();" onBlur="javascript:imprimiendo();"/>
                    <span class="Estilo15">
                    <input name="ter" type="hidden" size="3"  value="0"/>
                  </span></span><span class="Estilo14"> </span></td>
              <td width="139"><span class="Estilo14">Cantidad:
                <input name="cantidad"  type="text" size="3" onKeyUp="doAjax('../calcular_precio.php','','mostrar_precio','get','0','1','','');" />
              </span></td>
              <td width="153"><span class="Estilo14">&nbsp;Precio:
                <input name="precio" type="text" size="3" />
                    <input name="precio2" type="hidden" size="3"/>
              </span></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div id="resultado"></div></td>
  </tr>
</table>
</body>
</html>
