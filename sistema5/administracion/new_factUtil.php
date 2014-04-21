<?php include('miclase.php');

$clase=new miclase('');
if(isset($_REQUEST['cod'])){
list($cid,$cnombre,$factor1,$factor2,$factor3,$factor4)=$clase->consulta_DatosTabla($_REQUEST['cod'],"factorutilidad");
//echo $cid."-".$cnombre;
}
    ?>


<form id="form1" name="form1" method="post" action="?" >
<table width="270" height="72" border="1" cellpadding="0" cellspacing="0" bgcolor="#FDEED9">
  <tr>
    <td><table width="351" border="0" cellpadding="0" cellspacing="0" >
      <tr>
        <td colspan="7" align="right"></td>
      </tr>
      <tr  style="background:url(../imagenes/bg_contentbase2.gif) 100% 70% ">
        <td width="8" height="24">&nbsp;</td>
        <td width="343" colspan="6"><strong><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">Edici&oacute;n Factor Utilidad </font></strong></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="6"><input name="accion" type="hidden" id="accion" value='<?php echo $_REQUEST['accion'];?>'/><span style="color:#0000FF"></span></td>
        </tr>
      <tr>
        <td>&nbsp;&nbsp;</td>
        <td colspan="6"><table width="343" border="0" cellpadding="0" cellspacing="5">
          <tr>
            <td width="96" height="21"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>C&oacute;digo:</strong></font></td>
            <td width="232" colspan="3"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>
              <?php if($_REQUEST['accion']=="n"){echo $clase->cod_autogenerado('id','factorutilidad');}else{ echo $cid;}?>
              <input name="codigo" type="hidden" id="codigo"  value="<?php if($_REQUEST['accion']=="n"){echo $clase->cod_autogenerado('id','factorutilidad');}else{ echo $cid;}?>"/>
            </strong></font></td>
          </tr>
		  <tr>
		         <td height="21" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Descripci&oacute;n: </strong></font></td>
                 <td><input autocomplete="off" id="descripcion" name="descripcion" type="text" size="40" maxlength="50"  style="height:18; font-size:10px" value="<?php echo $cnombre ?>" />
                  </span></td>
         </tr>
		  <tr>
		    <td height="21" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Factor 1 </strong></font></td>
		    <td><input autocomplete="off" id="factor1" name="factor1" type="text" size="10" maxlength="50"  style="height:18; font-size:10px;  text-align:right" value="<?php echo $factor1 ?>" />
		      <font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>%</strong></font></td>
		    </tr>
		  <tr>
		    <td height="21" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Factor 2 </strong></font></td>
		    <td><input autocomplete="off" id="factor2" name="factor2" type="text" size="10" maxlength="50"  style="height:18; font-size:10px;  text-align:right" value="<?php echo $factor2 ?>" />
		      <font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>%</strong></font></td>
		    </tr>
		  <tr>
		    <td height="21" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Factor 3 </strong></font></td>
		    <td><input autocomplete="off" id="factor3" name="factor3" type="text" size="10" maxlength="50"  style="height:18; font-size:10px;  text-align:right" value="<?php echo $factor3 ?>" />
		      <font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>%</strong></font></td>
		    </tr>
		  <tr>
		    <td height="21" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Factor 4 </strong></font></td>
		    <td><input autocomplete="off" id="factor4" name="factor4" type="text" size="10" maxlength="50"  style="height:18; font-size:10px;  text-align:right" value="<?php echo $factor4 ?>" />
		      <font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>%</strong></font></td>
		    </tr>
        </table></td>
        </tr>
      
      <tr>
        <td height="28">&nbsp;</td>
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
