<?php include('miclase.php');

$clase=new miclase('');
if(isset($_REQUEST['cod'])){
list($cid,$csimbolo,$cnombre,$factorSub)=$clase->consulta_medidas($_REQUEST['cod']);
}
    ?>


<form id="form1" name="form1" method="post" action="?" onSubmit="return validar()">
<table width="270" height="72" border="1" cellpadding="0" cellspacing="0" bgcolor="#FFE7D7">
  <tr>
    <td><table width="268" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="7" align="right"></td>
      </tr>
      <tr bgcolor="#003399">
        <td width="8">&nbsp;</td>
        <td colspan="6"><strong><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">Unidades</font></strong></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="6"><input name="accion" type="hidden" id="accion" value='<?php echo $_REQUEST['accion'];?>'/><span style="color:#0000FF"></span></td>
        </tr>
      <tr>
        <td>&nbsp;&nbsp;</td>
        <td colspan="6"><table width="251" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="96" height="21" style="color:#000000"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>C&oacute;digo:</strong></font></td>
            <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
              <?php if($_REQUEST['accion']=="n"){echo $clase->cod_autogenerado('id','unidades');}else{ echo $cid;}?>
              <input name="codigo" type="hidden" id="codigo"  value="<?php if($_REQUEST['accion']=="n"){echo $clase->cod_autogenerado('id','unidades');}else{ echo $cid;}?>"/>
            </strong></font></td>
          </tr>
         <!-- <tr>
            <td height="27"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Producto:</strong></font></td>
            <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
              <input name="nombre" type="text" id="nombre"  style="height:18; font-size:10px" value="<?php echo $csimbolo?>" size="20" onkeypress="return val_letras(event);" />
            </strong></font></td>
          </tr> -->  <tr>
		         <td style="color:#000000"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Unidad: </strong></font></td>
                 <td><input autocomplete="off" id="simbolo" name="simbolo" type="text" size="20" maxlength="50"  style="height:18; font-size:10px" value="<?php echo $csimbolo ?>" />
                  </span></td>
         </tr>
          <tr>
            <td height="27" style="color:#000000"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Descripci&oacute;n :</strong></font></td>
            <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
              <input name="nombre" type="text" id="nombre"  style="height:18; font-size:10px" value="<?php echo $cnombre?>" size="20"   />
            </strong></font></td>
          </tr>
          <tr>
            <td height="22" style="color:#000000"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Factor :</strong></font></td>
            <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
              <input name="factorSub" type="text" id="factorSub"  style="height:18; font-size:10px" value="<?php echo $factorSub?>" size="20">
            </strong></font></td>
          </tr>
        </table></td>
        </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td colspan="6" align="center"><label for="Submit"></label>
          <input style="font-size:10px" type="submit" name="guardar" value="Guardar" id="guardar">
          <input style="font-size:10px" type="button" name="Submit2" value="Cancelar" id="Submit2"  onclick="ocultar();"></td>
        </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
