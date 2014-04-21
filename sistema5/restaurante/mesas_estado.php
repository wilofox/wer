<?php include('conex_inicial.php');

?>
<style type="text/css">
<!--
.Estilo5 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #990000;
}
.Estilo8 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.Estilo11 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }
.Estilo17 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #000000; }
.Estilo19 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FFFFFF; }
-->
</style>

<table width="81" height="240" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><table width="250" height="240" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFD3B7">
      <tr>
        <td height="19" colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td width="10" height="19">&nbsp;</td>
        <td width="240"><span class="Estilo5">Lista de Mesas</span></td>
      </tr>
      <tr>
        <td height="19">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="19"><label for="select"></label></td>
        <td><span class="Estilo8">Salon<font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <select style="font:Verdana, Arial, Helvetica, sans-serif; font-size:10px" name="select" id="select">
            <option value="1">Salon1</option>
                    </select>
        </strong></font></span></td>
      </tr>
      <tr>
        <td height="19" colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" align="right" valign="top">
		
		  <div id="detalle" style="width:100%; height:130px; overflow:auto">
		  <table width="214" height="72" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#F3F3F3">
            <tr>
              <td width="60" height="17" align="center" bgcolor="#CFCFCF"><span class="Estilo17">CODIGO</span></td>
              <td width="66" bgcolor="#CFCFCF"><span class="Estilo17">NOMBRE</span></td>
              <td width="88" bgcolor="#CFCFCF"><span class="Estilo17">ESTADO</span></td>
            </tr>
            <?php 
$strSQL="select * from mesa";

$resultado=mysql_query($strSQL,$cn);
while($row=mysql_fetch_array($resultado))
{
	if($row['estado']=='O'){

?>
            <tr bgcolor="#993300">
              <td align="center"><span class="Estilo19"><?php echo $row['id']?></span></td>
              <td><span class="Estilo19"><?php echo $row['descripcion']?></span></td>
              <td align="left"><span class="Estilo19">
			  <?php echo "OCUPADO";?></span></td>
            </tr>
            <?php
	}else{
	
	?>
	
            <tr>
              <td align="center"><span class="Estilo11"><?php echo $row['id']?></span></td>
              <td><span class="Estilo11"><?php echo $row['descripcion']?></span></td>
              <td align="left"><span class="Estilo11">
			  <?php echo "LIBRE";?></span></td>
            </tr>
	
	<?php
	}

}
 ?>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
		</div>
		</td>
      </tr>
    </table></td>
  </tr>
</table>
