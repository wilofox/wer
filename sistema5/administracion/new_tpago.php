<?php include('miclase.php');
include('../conex_inicial.php');
$clase=new miclase('');
if(isset($_REQUEST['cod'])){
list($cid,$ccodigo,$cdescripcion,$cformato,$ccola,$modalidad,$cc1,$cc2)=$clase->consulta_tpagos($_REQUEST['cod']);
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
        <td colspan="6"><strong><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">Tipos de Pago</font></strong></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="6"><input name="accion" type="hidden" id="accion" value='<?php echo $_REQUEST['accion'];?>'/><span style="color:#0000FF"></span></td>
        </tr>
      <tr>
        <td>&nbsp;&nbsp;</td>
        <td colspan="6"><table width="251" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="96" height="21" valign="middle"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Id:</strong></font></td>
            <td colspan="3" valign="middle"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>
              <?php if($_REQUEST['accion']=="n"){echo $clase->cod_autogenerado('id','t_pago');}else{ echo $cid;}?>
              <input name="codid" type="hidden" id="codid"  value="<?php if($_REQUEST['accion']=="n"){echo $clase->cod_autogenerado('id','t_pago');}else{ echo $cid;}?>"/>
              <input type="hidden" name="temp_modalidad" id="temp_modalidad" value="<?php echo $modalidad?>"/>
            </strong></font></td>
          </tr>
		  <tr>
		         <td height="21" valign="middle" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>C&oacute;digo: </strong></font></td>
                 <td valign="middle"><input autocomplete="off" id="codigo" name="codigo" type="text" size="20" maxlength="3"  style="height:18; " value="<?php echo $ccodigo ?>" />
                  </span></td>
         </tr>
		  <tr>
		         <td height="21" valign="middle" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Descripci&oacute;n: </strong></font></td>
                 <td valign="middle"><input autocomplete="off" id="descripcion" name="descripcion" type="text" size="20" maxlength="25"  style="height:18; " value="<?php echo $cdescripcion ?>" />
                  </span></td>
         </tr>

		 		  <tr>
		         <td height="21" valign="middle" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Formato: </strong></font></td>
                 <td valign="middle"><input autocomplete="off" id="formato" name="formato" type="text" size="20" maxlength="50"  style="height:18; " value="<?php echo $cformato ?>" />
                  </span></td>
         </tr>
		 		  <tr>
		         <td height="21" valign="middle" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Cola : </strong></font></td>
                 <td valign="middle"><input autocomplete="off" id="cola" name="cola" type="text" size="20" maxlength="50"  style="height:18; " value="<?php echo $ccola ?>" />
                  </span></td>
         </tr>
		 		  <tr>
		 		    <td height="21" valign="middle" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Modalidad: </strong></font></td>
		 		    <td valign="middle">
					
					<select name="modalidad" id="modalidad">
					<?php 
					$strSQl="select * from modalidad order by id";
					$resultado=mysql_query($strSQl,$cn);
					while($row=mysql_fetch_array($resultado)){
					
					?>
					  <option value="<?php echo $row['id']?>"><?php echo $row['nombre']?></option>
					  
					 <?php 
					 }
					 ?> 
		 		    </select>		 		    </td>
	 		    </tr>
		 		  <tr>
		 		    <td height="21" valign="middle" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Cuenta Contab.1 </strong></font></td>
		 		    <td valign="middle"><input autocomplete="off" id="cc1" name="cc1" type="text" size="20" maxlength="50"  style="height:18; " value="<?php echo $cc1 ?>" /></td>
	 		    </tr>
		 		  <tr>
		 		    <td height="21" valign="middle" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Cuenta Contab.1 </strong></font></td>
		 		    <td valign="middle"><input autocomplete="off" id="cc2" name="cc2" type="text" size="20" maxlength="50"  style="height:18; " value="<?php echo $cc2 ?>" /></td>
	 		    </tr>
                
        </table></td>
        </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td colspan="6" align="center"><label for="Submit"></label>
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
