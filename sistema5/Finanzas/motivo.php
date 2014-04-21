<?php 
include_once("../conex_inicial.php");
$tot=$_REQUEST['total'];
if($_REQUEST['mone']=="01"){
	$mon="S/.";
}else{
	$mon="US$.";
}
if(isset($_REQUEST['generarletra'])){?>
<style type="text/css">
<!--
.Estilo1 {
	font-size: 12px;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style>
<table width="257" border="3" bgcolor="#009966">
  <tr>
    <td width="247"><table width="251" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="42" colspan="3" align="center" valign="middle"><table width="214" border="3" bordercolor="#000033" cellpadding="0" cellspacing="0">
        <tr>
        	<td width="100" align="center"><span class="Estilo353">A Canjear</span></td>
			<td width="19"><input type="text" size="1" readonly="readonly" name="mone" value="<?php echo $mon;?>"></td>
			<td width="83"><input align="right" type="text" size="9" readonly="readonly" name="total" value="<?php echo number_format($tot,2,'.','');?>"></td>
      	</tr>
        </table></td>
      </tr>
      <tr>
        <td width="146"><span class="Estilo354">Venc. por cada:</span></td>
        <td width="68"><input type="text" size="3" name="venc" value="15">
        <span class="Estilo354">dias</span></td>
        <td width="37">&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo354">Numero de Cuotas:</span></td>
        <td colspan="2"><input type="text" id="cuo" size="5" name="cuo" value="10" onkeyup="calcularcuotas(this.value,document.form1.docgen.value)" /></td>
      </tr>
      <tr>
        <td height="29" colspan="3"><div id="rescuota" align="center" class="Estilo353">10 Letra de <?php echo $mon."     ".($tot/10);?> </div></td>
        </tr>
      <tr>
        <td><span class="Estilo354">Documento a Generar:</span></td>
        <td><select name="docgen" id="docgen">
        <?php 
		$sql=mysql_query("Select * from t_pago where modalidad='4'",$cn);
		while($row=mysql_fetch_array($sql)){
		?>
        <option value="<?php echo $row['codigo']?>"><?php echo $row['descripcion']?></option>
        <?php 
		}
		?>
       	</select></td>
        <td>&nbsp;</td>
	</tr>
	<tr>
		<td height="42" colspan="3" align="center" valign="middle"><input type="button" onclick="GenerarLetras(document.form1.cuo.value,document.form1.docgen.value)" value="Generar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onclick="document.getElementById('motivo').style.visibility='hidden'" value="Cerrar"></td>
	</tr>
    <tr>
		<td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
	</tr>
		
    </table>
	</td>
  </tr>
  </table>
  <label for="textfield"></label>
<?php }else{ ?>  
  
<style type="text/css">
<!--
.Estilo1 {
	font-size: 12px;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style>
<table width="122" border="1">
  <tr>
    <td width="112"><table width="389" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="139">&nbsp;</td>
        <td width="122">&nbsp;</td>
        <td width="106">&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo1">Motivo de Anulaci&oacute;n </span></td>
        <td colspan="2"><textarea name="textfield" id="textfield"></textarea></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
	</tr>
		
    </table>
	</td>
  </tr>
</table>
  <label for="textfield"></label>
<?php } ?>  