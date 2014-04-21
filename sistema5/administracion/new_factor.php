<?php include('miclase.php');

$clase=new miclase('');
list($cid,$citem,$cancho,$clargo,$cm2ini,$cm2fin,$cfactor,$cnomprod)=$clase->consulta_factor($_REQUEST['cod']);

    ?>


<!--<form id="form1" name="form1" method="post" action="?" onSubmit="return validar()">-->
<table width="270" height="72" border="1" cellpadding="0" cellspacing="0" bgcolor="#DDDDDD">
  <tr>
    <td><table width="268" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="7" align="right"></td>
      </tr>
      <tr bgcolor="#003399">
        <td width="8">&nbsp;</td>
        <td colspan="6"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong><font color="#FFFFFF" size="2">Factor</font></strong></font></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="6"><input name="accion" type="hidden" id="accion" value='<?php echo $_REQUEST['accion'];?>'/><span style="color:#0000FF">campo opcional(*)</span></td>
        </tr>
      <tr>
        <td>&nbsp;&nbsp;</td>
        <td colspan="6"><table width="251" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="96" height="21"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>C&oacute;digo:</strong></font></td>
            <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
              <?php if($_REQUEST['accion']=="n"){echo $clase->cod_autogenerado('id','factorot');}else{ echo $cid;}?>
              <input name="codigo" type="hidden" id="codigo"  value="<?php if($_REQUEST['accion']=="n"){echo $clase->cod_autogenerado('id','transportista');}else{ echo $cid;}?>"/>
            </strong></font></td>
          </tr>
         <!-- <tr>
            <td height="27"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Producto:</strong></font></td>
            <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
              <input name="nombre" type="text" id="nombre"  style="height:18; font-size:10px" value="<?php echo $nombre?>" size="20" onkeypress="return val_letras(event);" />
            </strong></font></td>
          </tr> -->  <tr>
		         <td ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Producto: </strong></font></td>
       <td><input autocomplete="off" id="producto" name="producto" type="text" size="20" maxlength="50" onkeyup="validartecla(event,this,'auxiliares')" style="height:18; font-size:10px" value="<?php echo $cnomprod ?>" />
         <input id="auxiliar2" name="auxiliar2" type="hidden" size="3"  value="<?php echo $citem ?>"/>
          </span></td></tr>
		  <tr>
            <td height="27"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Ancho :</strong></font></td>
            <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
              <input name="ancho" type="text" id="ancho"  style="height:18; font-size:10px" value="<?php echo $cancho?>" size="20"  onkeypress="return val_numeros(event)" />
            </strong></font></td>
          </tr>
		  <tr>
            <td height="27"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Largo :</strong></font></td>
            <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
              <input name="largo" type="text" id="largo"  style="height:18; font-size:10px" value="<?php echo $clargo?>" size="20"  onkeypress="return val_numeros(event)" />
            </strong></font></td>
          </tr>
          <tr>
            <td height="27"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>M2 inicial :</strong></font></td>
            <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
              <input name="m2ini" type="text" id="m2ini"  style="height:18; font-size:10px" value="<?php echo $cm2ini?>" size="20"  onkeypress="return val_numeros(event)" />
            </strong></font></td>
          </tr>
          <tr>
            <td height="27"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>M2 fnal :</strong></font></td>
            <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
              <input name="m2fin" type="text" id="m2fin"  style="height:18; font-size:10px" value="<?php echo $cm2fin?>" size="20" maxlength="11"  onkeypress="return val_numeros(event)" />
            </strong></font></td>
          </tr>
          <tr>
            <td height="27"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Factor :</strong></font></td>
            <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
              <input  name="numfac" type="text" id="numfac" style="height:18; font-size:10px" value="<?php echo $cfactor?>" size="10"    onkeypress="return val_numeros(event)" maxlength="10" />
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
<!--</form>-->
