<?php include('conex_inicial.php');


if($_REQUEST['accion']=='n'){
			$resultado3=mysql_query("select max(cod_suc) as codigo from sucursal",$cn);
			$row3=mysql_fetch_array($resultado3);
			
			$codigo=$row3['codigo'];
			$codigo=$codigo+1;
			
}

$strSQL4="select * from sucursal where cod_suc='".$_REQUEST['cod']."'";
  $resultado4=mysql_query($strSQL4,$cn);
  while($row4=mysql_fetch_array($resultado4))
  {
  $codigo=$_REQUEST['cod'];
  $nombre=$row4['des_suc'];
  $ruc=$row4['ruc'];
  $telefono=$row4['telefono'];
  $web=$row4['web'];
  $email=$row4['email'];
	 
	  if($row4['percepcion']=='S'){
	  $chk_percep=" checked='checked' ";
	  }
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
        <td colspan="4"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong><font color="#FFFFFF" size="2">Nueva Empresa &nbsp;</font><font color="#FFFFFF">&nbsp;&nbsp;</font></strong></font></td>
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
        <td rowspan="7">&nbsp;&nbsp;</td>
        <td width="57" height="21"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Codigo:</strong></font></td>
        <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input  readonly="readonly" name="codigo" type="text"  style="height:18; font-size:10px; font:bold" size="2" value="<?php echo $codigo?>" />
        </strong></font></td>
        <td rowspan="7">&nbsp;</td>
        <td rowspan="7">&nbsp;</td>
      </tr>
      <tr>
        <td height="27"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Nombre:</strong></font></td>
        <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="des_suc" type="text"  style="height:18; font-size:10px" size="20" value="<?php echo $nombre?>" />
        </strong></font></td>
      </tr>
      <tr>
        <td height="24"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Ruc:</strong></font></td>
        <td width="48"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="ruc" type="text"  style="height:18; font-size:10px" size="10" value="<?php echo $ruc?>" />
        </strong></font></td>
        <td width="71"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Telefono:</strong></font></td>
        <td width="56"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="telefono" type="text"  style="height:18; font-size:10px" size="10" value="<?php echo $telefono?>" />
        </strong></font></td>
      </tr>
      <tr>
        <td height="24"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Web</strong></font></td>
        <td colspan="3"><input name="web" type="text" id="web" value="<?php echo $web?>" /></td>
        </tr>
      <tr>
        <td height="24"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Email</strong></font></td>
        <td colspan="3"><input name="email" type="text" id="email" value="<?php echo $email?>" /></td>
      </tr>
      <tr>
        <td height="24"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Logo</strong></font></td>
        <td colspan="3"><input name="userfile" id="userfile" type="file" size="15" /></td>
      </tr>
      <tr>
        <td height="30" colspan="4" valign="top"><input type="hidden" name="accion" value="<?php echo $_REQUEST['accion']?>" />
          <input type="checkbox" name="chk_percep" value="checkbox" <?php echo $chk_percep?>/>          
          <font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Agente de Percepciones:</strong></font></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="19" valign="middle">&nbsp;</td>
        <td height="19" colspan="3" valign="top">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
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