<?php 
session_start();
include('conex_inicial.php');


if($_REQUEST['accion']=='nh'){
			$resultado3=mysql_query("select max(id_ht)+1 as codigo from hor_trabajador ",$cn);
			$row3=mysql_fetch_array($resultado3);
			
			$codigo=$row3['codigo'];
			//$codigo=str_pad($codigo+1, 3, "0", STR_PAD_LEFT);
}



$strSQL4="select * from hor_trabajador where id_ht='".$_REQUEST['cod']."'";
  $resultado4=mysql_query($strSQL4,$cn);
  while($row4=mysql_fetch_array($resultado4))
  {
  $codigo=$_REQUEST['cod'];
  $tipo=$row4['tipo'];
  $h_ingreso=$row4['h_ingreso'];
  $h_salida=$row4['h_salida'];  
  }  
  
    ?>
<style type="text/css">
<!--
.Estilo15 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #990000;
}
-->
</style>

<table width="270" height="72" border="1" cellpadding="0" cellspacing="0" bgcolor="#FFE7D7">
  <tr>
    <td><table width="270" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="5" align="right"></td>
      </tr>
      <tr bgcolor="#003399">
        <td width="21" height="26" bgcolor="#004080">&nbsp;</td>
        <td colspan="2" bgcolor="#004080"><strong><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">Horario del trabajador 
          <input type="hidden" name="accion" value="<?php echo $_REQUEST['accion']?>" />
        </font></strong></td>
        <td width="7" bgcolor="#004080">&nbsp;</td>
        <td width="10" bgcolor="#004080">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td rowspan="6">&nbsp;&nbsp;</td>
        <td width="56" height="21"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>C&oacute;digo:</strong></font></td>
        <td width="176"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input  readonly="readonly" name="codigo" type="text"  style="height:18; font-size:10px; font:bold" size="2" value="<?php echo $codigo?>" />
        </strong></font></td>
        <td rowspan="6">&nbsp;</td>
        <td rowspan="6">&nbsp;</td>
      </tr>
      <tr>
        <td height="27"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>HT:</strong></font></td>
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="ht" type="text" id="ht"  style="height:18; font-size:10px" value="<?php echo $tipo?>" size="20" />
        </strong></font></td>
      </tr>
      <tr>
      <tr>
        <td height="24"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>H.Ingreso</strong></font></td>
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="hingreso" type="text" id="hingreso"  style="height:18; font-size:10px" value="<?php echo $h_ingreso?>" size="20" />
        (hh:mm:ss)</strong></font></td>
      </tr>
      <tr>
        <td height="24"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>H.Salida</strong></font></td>
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="hsalida" type="text" id="hsalida"  style="height:18; font-size:10px" value="<?php echo $h_salida ?>" size="20" />
        (hh:mm:ss)</strong></font></td>
      </tr>

      <tr>
        <td rowspan="2">&nbsp;</td>
        <td colspan="2" align="right"><label for="Submit"></label>
          <input style="font-size:10px" type="submit" name="guardar" value="Guardar" id="guardar">
          <input style="font-size:10px" type="button" name="Submit2" value="Cancelar" id="Submit2"  onclick="ocultar();"></td>

      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<?php 


?>