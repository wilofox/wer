<?php include('conex_inicial.php');


if($_REQUEST['accion']=='n'){
			$resultado3=mysql_query("select max(cod_tienda) as codigo from tienda where cod_suc='".$_REQUEST['suc']."'",$cn);
			$row3=mysql_fetch_array($resultado3);
			
			$codigo=substr($row3['codigo'],1,2);
			$codigo=$codigo+1;
			$codigo=str_pad($codigo, 2, "0", STR_PAD_LEFT);
			$codigo=$_REQUEST['suc'].$codigo;
			
}

$strSQL4="select * from tienda where cod_tienda='".$_REQUEST['cod']."'";
  $resultado4=mysql_query($strSQL4,$cn);
  while($row4=mysql_fetch_array($resultado4))
  {
  $codigo=$_REQUEST['cod'];
  $nombre=$row4['des_tienda'];
  $telefono=$row4['telefono'];
  $direccion=$row4['direccion'];
  $aplicaOfertas=$row4['aplicaBon'];
  }
  
  $tempCheck="";
  if($aplicaOfertas=='S'){
  $tempCheck=' checked=checked ';
  }
  
    ?>
<table width="270" height="72" border="1" cellpadding="0" cellspacing="0" bgcolor="#FFD3B7">
  <tr>
    <td><table width="270" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFE7D7">
      <tr>
        <td colspan="7" align="right"></td>
      </tr>
      <tr bgcolor="#003399">
        <td width="21">&nbsp;</td>
        <td colspan="4"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong><font color="#FFFFFF" size="2">Nuevo Local &nbsp;</font><font color="#FFFFFF">&nbsp;&nbsp;</font></strong></font></td>
        <td width="7">&nbsp;</td>
        <td width="10">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="4">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td rowspan="6">&nbsp;&nbsp;</td>
        <td width="57" height="21"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>C&oacute;digo:</strong></font></td>
        <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input  readonly="readonly" name="codigo" type="text"  style="height:18; font-size:10px; font:bold" size="2" value="<?php echo $codigo?>" />
        </strong></font></td>
        <td rowspan="6">&nbsp;</td>
        <td rowspan="6">&nbsp;</td>
      </tr>
      <tr>
        <td height="27"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Nombre:</strong></font></td>
        <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="des_tienda" type="text"  style="height:18; font-size:10px" size="20" value="<?php echo $nombre?>" />
        </strong></font></td>
      </tr>
      <tr>
        <td height="24"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Tel&eacute;fono:</strong></font></td>
        <td width="48"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="telefono" type="text"  style="height:18; font-size:10px" size="10" value="<?php echo $telefono?>" />
        </strong></font></td>
        <td width="71">&nbsp;</td>
        <td width="56">&nbsp;</td>
      </tr>
      <tr>
        <td height="24"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Direcci&oacute;n:</strong></font></td>
        <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="direccion" type="text"  style="height:18; font-size:10px" size="15" value="<?php echo $direccion?>" />
        </strong></font></td>
        </tr>
      <tr>
        <td height="24" colspan="4"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Aplica Ofertas 
          
		  
		  <input type="checkbox" name="checkbox" value="S" <?php echo $tempCheck ?> />
		  
        </strong></font></td>
        </tr>
      <tr>
        <td height="19" colspan="4"><input type="hidden" name="accion" value="<?php echo $_REQUEST['accion']?>" /></td>
        </tr>
      <tr>
        <td rowspan="2">&nbsp;</td>
        <td colspan="4" align="right"><label for="Submit"></label>
          <input style="font-size:10px" type="submit" name="guardar" value="Guardar" id="guardar">
          <input style="font-size:10px" type="button" name="Submit2" value="Cancelar" id="Submit2"  onclick="ocultar();"></td>
        <td rowspan="2">&nbsp;</td>
        <td rowspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<?php 


?>