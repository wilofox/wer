<?php include('miclase.php');

$clase=new miclase('');
if(isset($_REQUEST['cod'])){
list($cid,$cnombre,$cdescripcion,$ctanque,$csurtidor,$cfactor)=$clase->consulta_manguera($_REQUEST['cod']);
//echo $cid."-".$cnombre;
}

    ?>

<form id="form1" name="form1" method="post" action="?" onSubmit="return validar()">
<table width="270" height="72" border="1" cellpadding="0" cellspacing="0" bgcolor="#FFE7D7">
  <tr>
    <td><table width="268" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="7" align="right"></td>
      </tr>
      <tr bgcolor="#003399">
        <td width="8">&nbsp;</td>
        <td colspan="6"><strong><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">Manguera </font></strong></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="6"><input name="accion" type="hidden" id="accion" value='<?php echo $_REQUEST['accion'];?>'/><span style="color:#0000FF"></span></td>
        </tr>
      <tr>
        <td>&nbsp;&nbsp;</td>
        <td colspan="6"><table width="251" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="96" height="21"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Codigo:</strong></font></td>
            <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>
              <?php if($_REQUEST['accion']=="n"){echo $clase->cod_autogenerado('id','manguera');}else{ echo $cid;}?>
              <input name="codigo" type="hidden" id="codigo"  value="<?php if($_REQUEST['accion']=="n"){echo $clase->cod_autogenerado('id','manguera');}else{ echo $cid;}?>"/>
            </strong></font></td>
          </tr>
		  <tr>
		         <td height="21" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Nombre: </strong></font></td>
                 <td><input autocomplete="off" id="nombre" name="nombre" type="text" size="20" maxlength="50"  style="height:18; " value="<?php echo $cnombre ?>" />
                  </span></td>
         </tr>
		 		  <tr>
		         <td height="21" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Serial: </strong></font></td>
                 <td>
                   <input name="descripcion" type="text" id="descripcion" style="background:#FFFFFF" value="<?php echo $cdescripcion ?>" size="30" /></td>
         </tr>
		 		  <tr>
		 		    <td height="21" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Tanque:</strong></font></td>
		 		    <td>
					 <select name="tanque" id="tanque" style="width:160px" >
			<?php 
			
 				 $resultados1 = mysql_query("select * from tanques order by nom_tanq "); 
				while($rowD=mysql_fetch_array($resultados1))
				{
				
				if ($rowD['id']== $ctanque){
				?>
			<option value="<?php echo $rowD['id'] ?>" selected><?php echo $rowD['nom_tanq'] ?></option>

		    <?php 
				}else{
		?>
			<option value="<?php echo $rowD['id'] ?>"><?php echo $rowD['nom_tanq'] ?></option>

		    <?php 
				}
			}?>
        </select>		 		    </td>
	 		    </tr>
		 		  <tr>
		 		    <td height="21" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Surtidor:</strong></font></td>
		 		    <td><select name="surtidor" id="surtidor" style="width:160px" >
			<?php 
			
 				 $resultados1 = mysql_query("select * from surtidor order by nom_surt "); 
				while($rowD=mysql_fetch_array($resultados1))
				{
				
				if ($rowD['id']== $csurtidor){
				?>
			<option value="<?php echo $rowD['id'] ?>" selected><?php echo $rowD['nom_surt'] ?></option>

		    <?php 
				}else{
		?>
			<option value="<?php echo $rowD['id'] ?>"><?php echo $rowD['nom_surt'] ?></option>

		    <?php 
				}
			}?>
        </select></td>
	 		    </tr>
		 		  <tr>
		 		    <td height="21" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Fator: </strong></font></td>
		 		    <td><input autocomplete="off" id="factor" name="factor" type="text" size="20" maxlength="50"  style="height:18; " value="<?php echo $cfactor ?>" onkeypress="numero()" /></td>
	 		    </tr>
		 		  <tr>
		 		    <td height="21" >&nbsp;</td>
		 		    <td>&nbsp;</td>
	 		    </tr>
		 		 		  <tr></tr>
        </table></td>
        </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td colspan="6" align="center"><label for="Submit"></label>
          <input style="font-size:10px" type="submit" name="guardar" value="Guardar [F2] " id="guardar">
          <input style="font-size:10px" type="button" name="Submit2" value="Cancelar [ESC] " id="Submit2"  onclick="ocultar();"></td>
        </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
