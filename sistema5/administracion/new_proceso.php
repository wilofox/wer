<?php include('miclase.php');
//include('../funciones/funciones.php');

$clase=new miclase('');
if(isset($_REQUEST['cod'])){
list($cid,$cnombre,$cdescripcion)=$clase->consulta_procesos($_REQUEST['cod']);
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
        <td colspan="6"><strong><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">Actividades de Obra </font></strong></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="6"><input name="accion" type="hidden" id="accion" value='<?php echo $_REQUEST['accion'];?>'/><span style="color:#0000FF"></span></td>
        </tr>
      <tr>
        <td>&nbsp;&nbsp;</td>
        <td colspan="6"><table width="251" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="96" height="21"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>C&oacute;digo:</strong></font></td>
            <td colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>
              <?php if($_REQUEST['accion']=="n"){echo $clase->cod_autogenerado('id','procesos');}else{ echo $cid;}?>
              <input name="codigo" type="hidden" id="codigo"  value="<?php if($_REQUEST['accion']=="n"){echo $clase->cod_autogenerado('id','procesos');}else{ echo $cid;}?>"/>
            </strong></font></td>
          </tr>
		  <tr>
		         <td height="21" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Nombre: </strong></font></td>
                 <td><input autocomplete="off" id="nombre" name="nombre" type="text" size="20" maxlength="50"  style="height:18; " value="<?php echo caracteres($cnombre) ?>" />
                  </span></td>
         </tr>
		 		  <tr>
		         <td height="21" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Descripci&oacute;n: </strong></font></td>
                 <td></span></td>
         </tr>
		 		 		  <tr>
		         <td height="50" colspan="2" align="center" >
		           <label>
		           <textarea  id="descripcion"  name="descripcion" cols="30" rows="5" style="background:#FFFFFF"><?php echo caracteres($cdescripcion) ?></textarea>
		           </label>
                   </span></td>
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
