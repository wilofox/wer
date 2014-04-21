<?php include('conex_inicial.php');



$strSQL4="select * from producto where cod_prod='".$_REQUEST['cod']."'";
  $resultado4=mysql_query($strSQL4,$cn);
  while($row4=mysql_fetch_array($resultado4))
  {
  $codigo=$_REQUEST['cod'];
  $nombre=$row4['nombre'];
  $nom_unid=$row4['nom_unid'];
  $precio=$row4['precio'];
  $categoria=$row4['cod_categ'];
  $clasificacion=$row4['clasificacion'];
  }
//  echo $categoria;
    ?>
<table width="270" height="72" border="1" cellpadding="0" cellspacing="0" bgcolor="#FFD3B7">
  <tr>
    <td><table width="270" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="7" align="right"></td>
      </tr>
      <tr bgcolor="#003399">
        <td width="21">&nbsp;</td>
        <td colspan="4"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong><font color="#FFFFFF" size="2">Nuevo Producto &nbsp;</font><font color="#FFFFFF">&nbsp;&nbsp;</font></strong></font></td>
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
        <td width="52" height="21"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Codigo:</strong></font></td>
        <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
		<?php if($_REQUEST['accion']=='e'){?>
          <input readonly="readonly" name="codigo" type="text"  style="height:18; font-size:10px; font:bold" size="5" value="<?php echo $codigo?>" />
		  <?php 
		  }else{
		  ?>
		   <input name="codigo" type="text"  style="height:18; font-size:10px; font:bold" size="5" value="<?php echo $codigo?>" />
		  
		  <?php
		  }
		  ?>
		  
        </strong></font></td>
        <td rowspan="6">&nbsp;</td>
        <td rowspan="6">&nbsp;</td>
      </tr>
      <tr>
        <td height="27"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Nombre:</strong></font></td>
        <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="nombre" type="text"  style="height:18; font-size:10px" size="20" value="<?php echo $nombre?>" />
        </strong></font></td>
        </tr>
      <tr>
        <td height="27"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Nombre Unid. </strong></font></td>
        <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="nom_unid" type="text"  style="height:18; font-size:10px" size="20" value="<?php echo $nom_unid?>" />
        </strong></font></td>
      </tr>
      <tr>
        <td height="24"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Precio:</strong></font></td>
        <td width="53"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="precio" type="text"  style="height:18; font-size:10px" size="10" value="<?php echo $precio?>" />
        </strong></font></td>
        <td width="57"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Categoria:</strong></font></td>
        <td width="70"><label>
          <select name="categorias">
		  <?php 
		
	
  $resultados1 = mysql_query("select * from categoria order by nombre ",$cn); 
while($row1=mysql_fetch_array($resultados1))
{
		?>
            <option value="<?php echo $row1['codigo'] ?>"><?php echo $row1['nombre'] ?></option>
			 <?php }?>
          </select>
		  
		
        </label></td>
      </tr>
      <tr>
        <td height="24"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Clasificacion:</strong></font></td>
        <td colspan="3"><select name="clasificacion">
          <?php 
		
	
  $resultados1 = mysql_query("select * from clasificacion order by codigo ",$cn); 
while($row1=mysql_fetch_array($resultados1))
{
		?>
          <option value="<?php echo $row1['codigo'] ?>"><?php echo $row1['descripcion'] ?></option>
          <?php }?>
        </select></td>
        </tr>
      <tr>
        <td height="19" colspan="4"><input type="hidden" name="accion" value="<?php echo $_REQUEST['accion']?>" />
          <input type="hidden" name="cat" value="<?php echo $categoria?>" />
          <input type="hidden" name="cla" value="<?php echo $clasificacion?>" /></td>
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