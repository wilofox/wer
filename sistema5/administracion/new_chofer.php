<?php include('miclase.php');

$clase=new miclase('');
list($codigo,$nombre,$dni,$licencia,$fecha,$direccion,$telefono)=$clase->consulta_chofer($_REQUEST['cod']);

    ?>
<form id="form1" name="form1" method="post" action="?" onSubmit="return validar()">

<table width="270" height="72" border="1" cellpadding="0" cellspacing="0" bgcolor="#FFD3B7">
  <tr>
    <td><table width="347" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFE7D7">
      <tr>
        <td colspan="7" align="right"></td>
      </tr>
      <tr bgcolor="#003399">
        <td width="21">&nbsp;</td>
        <td colspan="6"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong><font color="#FFFFFF" size="2">Chofer</font><font color="#FFFFFF">&nbsp;&nbsp;</font></strong></font></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="6"><input name="accion" type="hidden" id="accion" value='<?php echo $_REQUEST['accion'];?>'/><span style="color:#0000FF">campo opcional(*)</span></td>
        </tr>
      <tr>
        <td rowspan="7">&nbsp;&nbsp;</td>
        <td width="85" height="21" style="color:#000000"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>C&oacute;digo:</strong></font></td>
        <td colspan="3" style="color:#000000"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
    <?php if($_REQUEST['accion']=="n"){echo $clase->cod_autogenerado('cod','chofer');}else{ echo $codigo;}?>
        <input name="codigo" type="hidden" id="codigo"  value=" <?php if($_REQUEST['accion']=="n"){echo $clase->cod_autogenerado('cod','chofer');}else{ echo $codigo;}?>"/>
        </strong></font></td>
      </tr>
	  <tr>
        <td height="27" style="color:#000000"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>DNI:</strong></font></td>
        <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="dni" type="text" id="dni"  style="height:18; font-size:10px" maxlength="8" value="<?php echo $dni?>" size="20" onkeypress="return val_numeros(event)" />
        </strong></font></td>
      </tr>
      <tr>
        <td height="27" style="color:#000000"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Nombre:</strong></font></td>
        <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="nombre" type="text" id="nombre"  style="height:18; font-size:10px" value="<?php echo $nombre?>" size="20" onkeypress="return val_letras(event);" />
        </strong></font></td>
      </tr>
	        

      <tr>
        <td height="27" style="color:#000000"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Licencia:</strong></font></td>
        <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="licencia" type="text" id="licencia"  style="height:18; font-size:10px" value="<?php echo $licencia?>" size="20" />
        </strong></font></td>
      </tr>

      <tr>
        <td height="27" style="color:#000000"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>F.  Nacimiento:</strong></font></td>
        <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>		  
		  
          <label>
          <select name="fecha1" id="fecha1">
		  <?php 
		  for($x=1;$x<=31;$x++){
		  if($x<10) $x="0".$x;
		   echo '<option value="'.$x.'">'.$x.'</option>';
		
		   }
		   ?>
          </select>
          </label>
          <label>
          <select name="fecha2" id="fecha2">
            <option value="01">Enero</option>
            <option value="02">Febrero</option>
            <option value="03">Marzo</option>
            <option value="04">Abril</option>
            <option value="05">Mayo</option>
            <option value="06">Junio</option>
            <option value="07">Julio</option>
            <option value="08">Agosto</option>
            <option value="09">Setiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
          </select>
          </label>
          <label></label>
          <select name="fecha3" id="fecha3">
            <?php 
			$year=date("Y");
		  for($x=$year-40;$x<=$year;$x++){
		   echo '<option value="'.$x.'">'.$x.'</option>';
		   }
		   ?>
              </select>
        </strong></font></td>
      </tr>
	        <tr>
        <td height="27" style="color:#000000"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Direcci&oacute;n:</strong></font></td>
        <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="direccion" type="text" id="direccion"  style="height:18; font-size:10px" value="<?php echo $direccion?>" size="20" />
        </strong></font></td>
      </tr>
	        <tr>
        <td height="27" style="color:#000000"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Tel&eacute;fono:</strong></font></td>
        <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="telefono" type="text" id="telefono"  style="height:18; font-size:10px" value="<?php echo $telefono?>" size="20" onkeypress="return val_numeros(event)"/>
        </strong></font><span style="color:#0000FF">*</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="4" align="center"><label for="Submit"></label>
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
