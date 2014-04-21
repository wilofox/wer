<?php include('miclase.php');

$clase=new miclase('');
if(isset($_REQUEST['cod'])){
//list($cid,$cnombre,$cdescripcion,$ccc,$ccostoDI,$ccosto1,$ccosto2 )=$clase->consulta_coperativo($_REQUEST['cod']);
//echo $cid."-".$cnombre;
$mydata=$clase->consulta_coperativo($_REQUEST['cod']);
}
    ?>


<form id="form1" name="form1" method="post" action="?" onSubmit="return validar()">
<table width="270" height="72" border="1" cellpadding="0" cellspacing="0" bgcolor="#FFE7D7">
  <tr>
    <td><table width="313" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="7" align="right"></td>
      </tr>
      <tr bgcolor="#003399">
        <td width="8">&nbsp;</td>
        <td width="305" colspan="6"><strong><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">Costo Operativo</font></strong></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="6"><input name="accion" type="hidden" id="accion" value='<?php echo $_REQUEST['accion'];?>'/><span style="color:#0000FF"></span></td>
        </tr>
      <tr>
        <td>&nbsp;&nbsp;</td>
        <td colspan="6"><table width="301" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="122" height="21" valign="middle"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>C&oacute;digo:</strong></font></td>
            <td width="179" colspan="3" valign="middle"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>
              <?php if($_REQUEST['accion']=="n"){echo $clase->cod_autogenerado('id','costoperativo');}else{ echo $mydata['id'];}?>
              <input name="codigo" type="hidden" id="codigo"  value="<?php if($_REQUEST['accion']=="n"){echo $clase->cod_autogenerado('id','costoperativo');}else{ echo $mydata['id'];}?>"/>
            </strong></font></td>
          </tr>
		  <tr>
		         <td height="21" valign="middle" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Nombre: </strong></font></td>
                 <td valign="middle"><input autocomplete="off" id="nombre" name="nombre" type="text" size="20" maxlength="50"  style="height:18; " value="<?php echo $mydata['nombre'] ?>" />
                  </span></td>
         </tr>
		 		  <tr>
		         <td height="21" colspan="2" valign="middle" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Descripci&oacute;n (max 150): </strong></font></span></td>
                </tr>
		 		 		  <tr>
		         <td height="80" colspan="2" align="center" valign="middle" >
		           <label>
		           <textarea  id="descripcion"  name="descripcion" cols="30" rows="5"  style="background:#FFFFFF" onKeyUp="return maximaLongitud(this,150)"><?php echo $mydata['descripcion'] ?></textarea>
		           </label>
                   </span></td>
				   </tr>
				   		  <tr>
		         <td height="21" valign="middle" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>C. Costo : </strong></font></td>
                 <td valign="middle"><label>
                   <?php echo $clase->c_ccosto($mydata['cc']); ?>
                 </label>
                   </span></td>
         </tr>
		 		  <tr>
		         <td height="21" valign="middle" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>T. Costo : </strong></font></td>
                 <td valign="middle" ><div id="tipo_costo"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000">
                   <input id="tcosto1" name="tcosto" type="radio" value="D" <?php if($mydata['costoDI']=="D") echo "checked" ?>  />

                   Directo 
                   <label>
                   <input  id="tcosto2" name="tcosto" type="radio" value="I" <?php if($mydata['costoDI']=="I") echo "checked" ?>/>
                   Indirecto</label></font></div></td>
         </tr>
		 <tr>
		         <td height="21" valign="middle" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Moneda: </strong></font></td>
                 <td valign="middle">
              <?php echo $clase->c_moneda($mydata['moneda']);?>			  </td>
         </tr>
		 <tr>
		         <td height="21" valign="middle" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Concepto contable: </strong></font></td>
                 <td valign="middle"><?php //echo $clase->c_prod_concepto($mydata['concepto']);?>
				 			  		  <input name="concepto" type="text" id="concepto" onKeyUp="validartecla(event,this,'#auxiliares')" onFocus="validartecla(event,this,'#auxiliares')"  size="18" maxlength="50" autocomplete="off" value="<?php echo $mydata['nom_prod'] ?>">
            <input name="hdconcepto" type="hidden" id="hdconcepto"  size="3" value="<?php echo $mydata['concepto'] ?>"/>				 </td>
         </tr>
		 		  <tr>
		         <td height="21" valign="middle" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Lima : </strong></font></td>
                 <td valign="middle"><input autocomplete="off" id="costo1" name="costo1" type="text" size="20" maxlength="50"  style="height:18; " value="<?php echo $mydata['costo1'] ?>" />
                  </span></td>
         </tr>
		 		  <tr>
		         <td height="21" valign="middle" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Provincia : </strong></font></td>
                 <td valign="middle"><input autocomplete="off" id="costo2" name="costo2" type="text" size="20" maxlength="50"  style="height:18; " value="<?php echo $mydata['costo2'] ?>" />
                  </span></td>
         </tr>
		 		  <tr>
		 		    <td height="21" valign="middle" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Nivel de Agrupaci&oacute;n </strong></font></td>
		 		    <td valign="middle">
					<input autocomplete="off" id="nivel2" name="nivel2" type="hidden" size="20" maxlength="50"  style="height:18; " value="<?php echo $mydata['nivel'] ?>" />
					<select name="nivel" id="nivel">
		 		      <option value="1">Viaticos</option>
		 		      <option value="2">Despliegue de Personal</option>
		 		      <option value="3">Despliegue de Recursos</option>
		 		      </select>
		 		    </td>
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
