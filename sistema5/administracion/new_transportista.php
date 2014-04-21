<?php include('miclase.php');

$clase=new miclase('');
list($codigo,$nombre,$direccion,$ruc,$telefono,$web,$vehiculo,$placa,$marca,$lic_mtc,$idchofer,$nomchofer)=$clase->consulta_transportista($_REQUEST['cod']);

    ?>


<form id="form1" name="form1" method="post" action="?" onSubmit="return validar()">
<table width="270" height="72" border="1" cellpadding="0" cellspacing="0" bgcolor="#FFD3B7">
  <tr>
    <td><table width="522" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFE7D7">
      <tr>
        <td colspan="7" align="right"></td>
      </tr>
      <tr bgcolor="#003399">
        <td width="8">&nbsp;</td>
        <td colspan="4"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong><font color="#FFFFFF" size="2">Transportista</font></strong></font></td>
        <td width="5">&nbsp;</td>
        <td width="336">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="4"><input name="accion" type="hidden" id="accion" value='<?php echo $_REQUEST['accion'];?>'/><span style="color:#0000FF">campo opcional(*)</span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;</td>
        <td colspan="4"><table width="251" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="96" height="21" style="color:#000000"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>C&oacute;digo:</strong></font></td>
            <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
              <?php if($_REQUEST['accion']=="n"){echo $clase->cod_autogenerado('id','transportista');}else{ echo $codigo;}?>
              <input name="codigo" type="hidden" id="codigo"  value="<?php if($_REQUEST['accion']=="n"){echo $clase->cod_autogenerado('id','transportista');}else{ echo $codigo;}?>"/>
            </strong></font></td>
          </tr>
          <tr>
            <td height="27" style="color:#000000"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Nombre:</strong></font></td>
            <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
              <input name="nombre" type="text" id="nombre"  style="height:18; font-size:10px" value="<?php echo $nombre?>" size="20" onkeypress="return val_letras(event);" />
            </strong></font></td>
          </tr>
          <tr>
            <td height="27" style="color:#000000"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Direcci&oacute;n:</strong></font></td>
            <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
              <input name="direccion" type="text" id="direccion"  style="height:18; font-size:10px" value="<?php echo $direccion?>" size="20"  />
            </strong></font></td>
          </tr>
          <tr>
            <td height="27" style="color:#000000"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>RUC:</strong></font></td>
            <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
              <input name="ruc" type="text" id="ruc"  style="height:18; font-size:10px" value="<?php echo $ruc?>" size="20" maxlength="11"  onkeypress="return val_numeros(event)" />
            </strong></font></td>
          </tr>
          <tr>
            <td height="27" style="color:#000000"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Tel&eacute;fono:</strong></font></td>
            <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
              <input  name="telefono" type="text" id="telefono" style="height:18; font-size:10px" value="<?php echo $telefono?>" size="10"    onkeypress="return val_numeros(event)" maxlength="10" />
            <span style="color:#0000FF">*</span></strong></font></td>
          </tr>
          <tr>
            <td height="27" style="color:#000000"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Web:</strong></font></td>
            <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
              <input name="web" type="text" id="web"  style="height:18; font-size:10px" value="<?php echo $web?>" size="20" />
            <span style="color:#0000FF">*</span></strong></font></td>
          </tr>
          <tr>
            <td height="27" style="color:#000000"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Licencia:</strong></font></td>
            <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
              <input name="licencia" type="text" id="licencia"  style="height:18; font-size:10px" value="<?php echo $lic_mtc?>" size="20" />
            </strong></font></td>
          </tr>
        </table></td>
        <td>&nbsp;</td>
        <td><table width="253" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="27" style="color:#000000"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Modelo:</strong></font></td>
            <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
              <input name="vehiculo" type="text" id="vehiculo"  style="height:18; font-size:10px" value="<?php echo $vehiculo?>" size="20" />
            </strong></font></td>
          </tr>
          <tr>
            <td height="27" style="color:#000000"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Marca:</strong></font></td>
            <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
              <input name="marca" type="text" id="marca"  style="height:18; font-size:10px" value="<?php echo $marca?>" size="20" />
            </strong></font></td>
          </tr>
          <tr>
            <td height="27" style="color:#000000"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Placa:</strong></font></td>
            <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
              <input name="placa" type="text" id="placa"  style="height:18; font-size:10px" value="<?php echo $placa?>" size="20" />
            </strong></font></td>
          </tr>
          <tr>
            <td height="27" style="color:#000000"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Chofer:</strong></font></td>
            <td colspan="3"><?php $clase->lis_chofer()?>                </td>
          </tr>
          <tr>
            <td height="27">&nbsp;</td>
            <td colspan="3">&nbsp;</td>
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
