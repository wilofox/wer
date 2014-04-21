<?php include('conex_inicial.php');

	$resultado3=mysql_query("select max(codcliente) as codigo from cliente",$cn);
	$row3=mysql_fetch_array($resultado3);
	$codigo=$row3['codigo'];
	$codigo=str_pad($codigo+1,6,"0",STR_PAD_LEFT);

?>

<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<table width="320" height="72" border="1" cellpadding="0" cellspacing="0" bgcolor="#FFD3B7">
  <tr>
    <td width="316"><table width="314" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="6" align="right"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="11">&nbsp;</td>
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Cliente
          
        </strong></font></td>
        <td colspan="2"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="ccodcliente" type="text"  style="height:20; font-size:10px" size="5" value="<?php echo $codigo?>" readonly="readonly" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Persona:          &nbsp;&nbsp;&nbsp;
<select style="font:Verdana, Arial, Helvetica, sans-serif; font-size:11px" name="cpersona" id="cpersona">
  <option value="natural">Natural</option>
  <option value="juridica">Juridica</option>
</select>
        </strong></font></td>
        <td width="4">&nbsp;</td>
        <td width="11">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td rowspan="3">&nbsp;&nbsp;</td>
        <td height="25"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Razon Social : </strong></font></td>
        <td width="158"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="crazonsocial" type="text"  style="height:20; font-size:10px" size="30" />
        </strong></font></td>
        <td width="42">&nbsp;</td>
        <td rowspan="3">&nbsp;</td>
        <td rowspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Ruc:</strong></font></td>
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="cruc" type="text"  style="height:20; font-size:10px" size="10" maxlength="11" />
        </strong></font></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="27"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Apellidos:</strong></font></td>
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="capellido" type="text"  style="height:20; font-size:10px" size="30" />
        </strong></font></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Nombres:</strong></font></td>
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="cnombre" type="text"  style="height:20; font-size:10px" size="30" />
        </strong></font></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="25">&nbsp;</td>
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Dni:</strong></font></td>
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="cdni" type="text"  style="height:20; font-size:10px"  size="10" maxlength="8" />
        </strong></font></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Direccion:</strong></font></td>
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="cdireccion" type="text"  style="height:20; font-size:10px" size="30"/>
        </strong></font></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td width="88">&nbsp;</td>
        <td colspan="2"><input type="button" name="Submit" value="Guardar"  onclick="g_cliente()"/>
		<input type="button" name="Submit2" value="Cancelar" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
