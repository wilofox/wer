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
<?php 
if($_REQUEST['temp']=='auxiliares' && $_REQUEST['tipomov']==1){
$texto=" Proveedores ";
$detalle="detalle1";
$titulo="Ruc";
}else{
	if($_REQUEST['temp']=='auxiliares' && $_REQUEST['tipomov']==2){
	$texto=" Clientes ";
	$detalle="detalle1";
	$titulo="Ruc";
	}else{
	$texto=" Productos Generales ";
	$detalle="detalle";
	$titulo="Precio";
	}
}

//echo "det".$detalle;

?>

<table width="392" height="72" border="1" cellpadding="0" cellspacing="0" bgcolor="#EFD5C2"><!--FFD3B7-->
  <tr>
    <td><table width="413" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="5" align="right"></td>
      </tr>
      <tr>
        <td width="20" height="23" bgcolor="#004F9D">&nbsp;</td>
        <td width="62" bgcolor="#004F9D"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#FFFFFF"><strong>Nuevo </strong></font></td>
        <td width="122" bgcolor="#004F9D">&nbsp;</td>
        <td colspan="2" bgcolor="#004F9D">&nbsp;</td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td align="center">.<span style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold">T. pers.</span>: </td>
        <td><input name="radiobutton" type="radio" value="radiobutton" />
          <span style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold">Jur.</span>
          <input name="radiobutton" type="radio" value="radiobutton" />
  <span style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold">Nat.</span></td>
        <td width="51">&nbsp;</td>
        <td width="158">&nbsp;</td>
      </tr>
      <tr>
        <td height="28">&nbsp;&nbsp;</td>
        <td align="center"><span style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold">Ruc</span></td>
        <td><input name="textfield" type="text" size="10" maxlength="11" /></td>
        <td colspan="2"><span style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold">Dni</span>
          <input name="textfield2" type="text" size="10" maxlength="8" /></td>
      </tr>
      <tr>
        <td height="28">&nbsp;</td>
        <td align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold">Cli./Raz&oacute;n</td>
        <td colspan="3"><input name="textfield3" type="text" size="30" maxlength="100" /></td>
        </tr>
      <tr>
        <td height="28">&nbsp;</td>
        <td align="center"><span style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold">Contacto</span></td>
        <td colspan="3"><input name="textfield32" type="text" size="30" maxlength="100" /></td>
        </tr>
      <tr>
        <td height="28">&nbsp;</td>
        <td align="center"><span style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold">Cargo</span></td>
        <td colspan="3"><input type="text" name="textfield4" /></td>
        </tr>
      <tr>
        <td height="30">&nbsp;</td>
        <td><span style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold">Direcci&oacute;n</span></td>
        <td colspan="3"><textarea name="textarea" cols="30" rows="3"></textarea></td>
        </tr>
      <tr>
        <td height="29">&nbsp;</td>
        <td colspan="4" align="left"><input type="submit" name="Submit" value="Guardar" />
          <input type="submit" name="Submit2" value="Cancelar" /></td>
        </tr>
	     <tr>
        <td height="10"></td>
        <td></td>
        <td></td>
      </tr>
    </table>
    </td>
  </tr>
  
</table>

