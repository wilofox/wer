<?php include('conex_inicial.php');
$nombre=date('d/m/Y');

if($_REQUEST['accion']=='n'){
			$resultado3=mysql_query("select max(id) as codigo from tcambio",$cn);
			$row3=mysql_fetch_array($resultado3);
			
			$codigo=$row3['codigo'];
			$codigo=$codigo+1;
}

$strSQL4="select * from tcambio where id='".$_REQUEST['cod']."'";
  $resultado4=mysql_query($strSQL4,$cn);
  while($row4=mysql_fetch_array($resultado4))
  {
  $codigo=$_REQUEST['cod'];
  $nombre=$row4['fecha'];
  $ruc=$row4['venta'];
  $compra=$row4['compra'];
  $promedio=$row4['promedio'];
  

  }
  
    ?>
<table width="270" height="72" border="1" cellpadding="0" cellspacing="0" bgcolor="#FFE7D7" >
  <tr>
    <td><table width="270" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="6" align="right"></td>
      </tr>
      <tr bgcolor="#003399">
        <td width="21">&nbsp;</td>
        <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong><font color="#FFFFFF" size="2">Nuevo Tipo de Cambio &nbsp;</font><font color="#FFFFFF">&nbsp;&nbsp;</font></strong></font></td>
        <td width="7">&nbsp;</td>
        <td width="10">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td rowspan="6">&nbsp;&nbsp;</td>
        <td width="64" height="21"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Codigo:</strong></font></td>
        <td colspan="2"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input  readonly="readonly" name="codigo" type="text"  style="height:18; font-size:10px; font:bold" size="2" value="<?php echo $codigo?>" />
        </strong></font></td>
        <td rowspan="6">&nbsp;</td>
        <td rowspan="6">&nbsp;</td>
      </tr>
      <tr>
        <td height="27"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Fecha:</strong></font></td>
        <td colspan="2"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="des_suc" type="text"  style="height:18; font-size:10px" size="20" value="<?php echo $nombre?>" />
        </strong></font></td>
      </tr>
      <tr>
        <td height="24"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Venta:</strong></font></td>
        <td width="138"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="ruc" type="text"  style="height:18; font-size:10px" size="10" value="<?php echo number_format($ruc,3) ?>" />
        </strong></font></td>
        <td width="30">&nbsp;</td>
      </tr>
      <tr>
        <td height="24"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Compra:</strong></font></td>
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="compra" type="text"  style="height:18; font-size:10px" size="10" value="<?php echo number_format($compra,3)?>" />
        </strong></font></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="24"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Promedio:</strong></font></td>
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="promedio" type="text"  style="height:18; font-size:10px" size="10" value="<?php echo number_format($promedio,3)?>" />
        </strong></font></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="19" colspan="3"><input type="hidden" name="accion" value="<?php echo $_REQUEST['accion']?>" /></td>
        </tr>
      <tr>
        <td rowspan="2">&nbsp;</td>
        <td colspan="3" align="right"><label for="Submit"></label>
          <input style="font-size:10px" type="submit" name="guardar" value="Guardar" id="guardar">
          <input style="font-size:10px" type="button" name="Submit2" value="Cancelar" id="Submit2"  onclick="ocultar();"></td>
        <td rowspan="2">&nbsp;</td>
        <td rowspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<?php 


?>