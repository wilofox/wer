<?php 
session_start();
include('conex_inicial.php');


if($_REQUEST['accion']=='nn'){
			$resultado3=mysql_query("select max(id_nivel)+1 as codigo from nivel ",$cn);
			$row3=mysql_fetch_array($resultado3);
			
			$codigo=$row3['codigo'];
			//$codigo=str_pad($codigo+1, 3, "0", STR_PAD_LEFT);
}



$strSQL4="select * from nivel  where id_nivel='".$_REQUEST['cod']."'";
  $resultado4=mysql_query($strSQL4,$cn);
  while($row4=mysql_fetch_array($resultado4))
  {
  $codigo=$_REQUEST['cod'];
  $nivel=$row4['descrp_nivel'];
  $ht=$row4['id_ht'];
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
        <td colspan="2" bgcolor="#004080"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong><font color="#FFFFFF" size="2">Nivel de Personal 
          <input type="hidden" name="accion" value="<?php echo $_REQUEST['accion']?>" />
        </font></strong></font></td>
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
        <td width="55" height="21"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>C&oacute;digo:</strong></font></td>
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input  readonly="readonly" name="codigo" type="text"  style="height:18; font-size:10px; font:bold" size="2" value="<?php echo $codigo?>" />
        </strong></font></td>
        <td rowspan="6">&nbsp;</td>
        <td rowspan="6">&nbsp;</td>
      </tr>
      <tr>
        <td height="27"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Nivel:</strong></font></td>
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="nivel" type="text" id="nivel"  style="height:18; font-size:10px" value="<?php echo $nivel?>" size="20" />
        </strong></font></td>
      </tr>
      <tr>
        <td height="24"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>HT:</strong></font></td>
        <td>
		 <select  style="width:120" name="ht" id="ht">
	<!-- <option value="" selected>Desabilitar</option>-->
		 <option value="" selected>Libre</option>
    <?php 
	$resultados1 = mysql_query("select * from hor_trabajador ",$cn);  
	while($row1=mysql_fetch_array($resultados1))
	{
	
	if ($row1['id_ht']==$ht){
		echo '<option value="'.$row1['id_ht'].'" selected>'.$row1['tipo'].'</option>';
	}else{
		echo '<option value="'.$row1['id_ht'].'">'.$row1['tipo'].'</option>';	
	}
	?>	
			 
<!--<option value="<?php echo $row1['id_ht'] ?>" selected="selected"> <?php echo $row1['tipo'] ?></option>-->
    <?php }
	mysql_free_result($resultados1);
	?>
</select>


		
          <input type="hidden" name="ht_temp" value="<?php echo $ht ?>"/></td>
        </tr>


        <td>&nbsp;</td>
        <td height="25">&nbsp;</td>
        
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
