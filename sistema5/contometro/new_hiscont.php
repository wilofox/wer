<?php
session_start();

include('miclase.php');
$clase=new miclase('');
if(isset($_REQUEST['cod'])){
list($cid,$cmanguera,$cfecha,$cturno,$cvendedor,$cpc,$cfactor,$ccontini,$ccontfin)=$clase->consulta_histcontometro($_REQUEST['cod']);
//echo $cid."-".$cnombre;
}
?>


<form id="form1" name="form1" method="post" action="?" onSubmit="return validar();" >
<?
if ($cfecha==''){
	$cfecha=date('Y-m-d H:i:s');
}
if ($cvendedor==''){
	 $cvendedor=$_SESSION['codvendedor'];
}
if ($cpc==''){
	$cpc=$_SESSION['pc_ingreso'];
}
?>
<table width="418" height="72" border="1" cellpadding="0" cellspacing="0" bgcolor="#FFE7D7">
  <tr>
    <td width="431"><table width="416" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="7" align="right"></td>
      </tr>
      <tr bgcolor="#003399">
        <td width="8" height="27">&nbsp;</td>
        <td width="408" colspan="6"><strong><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">Nuevo Contometraje </font></strong></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="6"><input name="accion" type="hidden" id="accion" value='<?php echo $_REQUEST['accion'];?>'/><span style="color:#0000FF"></span></td>
        </tr>
      <tr>
        <td>&nbsp;&nbsp;</td>
        <td colspan="6"><table width="398" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="72" height="21"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>C&oacute;digo :</strong></font></td>
            <td colspan="6"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>
              <?php if($_REQUEST['accion']=="n"){echo $clase->cod_autogenerado('id','hist_contometro');}else{ echo $cid;}?>
              <input name="codigo" type="hidden" id="codigo"  value="<?php if($_REQUEST['accion']=="n"){echo $clase->cod_autogenerado('id','hist_contometro');}else{ echo $cid;}?>"/>
            </strong></font></td>
          </tr>
		  <tr>
		         <td height="21" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Fecha : </strong></font></td>
                 <td width="122"><input autocomplete="off" id="fec1" name="fec1" type="text" size="10" maxlength="10"  style="height:18; " value="<?php echo formatofecha(substr($cfecha,0,10)) ?>" />
                   <button type="reset" id="f_trigger_b2" style="visibility:hidden" >...</button>
              <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fec1",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b2",   
        singleClick    :    true,           
        step           :    1                
    });
              </script> </td>
                 <td width="10">&nbsp;</td>
                 <td width="57"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Hora : </strong></font></td>
                 <td width="137"><input readonly=""  id="hora" name="hora" type="text" size="8" maxlength="10"  style="height:18; "  value="<?php echo substr($cfecha,11,20)  ?>" /></td>
		  </tr>
		 		  <tr>
		 		    <td height="21" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Responsable : </strong></font></td>
		 		    <td><?php echo $clase->usuario_lis($cvendedor);?> </td>
		 		    <td>&nbsp;</td>
		 		    <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>PC :</strong></font></td>
		 		    <td><input  readonly id="pc" name="pc" type="text"  style="height:18; " value="<?php echo $cpc ?>" /></td>
	 		    </tr>
		 		  <tr>
		 		    <td height="21" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Empresa: </strong></font></td>
		 		    <td><?php echo $clase->sucrusal_lis($cvendedor);?> </td>
		 		    <td>&nbsp;</td>
		 		    <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Tienda:</strong></font></td>
		 		    <td><div id="manguera_tienda"><?php echo $clase->tienda_lis('1');?></div></td>
	 		    </tr>
		 		  <tr>
		 		    <td height="21" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Manguera : </strong></font></td>
		 		    <td><div id="manguera_nombre">
					  <?php 
					  if ($cmanguera==''){
					  	echo $clase->manguera_lis2('101','1');
					  }else{
					  	echo $clase->manguera_lis($cmanguera);
					  }
					   
					   ?></div></td>
	 		        <td>&nbsp;</td>
	 		        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Turno : </strong></font></td>
	 		        <td><select name="turno" id="turno" style="width:125px" onchange="Marcaje_Anterior();">
	 		         <?
					 if ($cturno==1){
					 echo '<option value="1" selected>Turno1</option> ';
					 echo '<option value="2">Turno2</option> ';
					 }elseif ($cturno==''){
					 echo '<option value="1" selected>Turno1</option> ';
					 echo '<option value="2">Turno2</option> ';
					 }else{	
					 echo '<option value="1">Turno1</option> ';
					 echo '<option value="2" selected>Turno2</option> ';				 
					 }
					 ?>
	 		          </select>	 		        </td>
	 		    </tr>
		 		  <tr>
		 		    <td height="21" colspan="5" style="padding-bottom:10px; padding-top:10px;" ><table width="99%" height="27" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="98%"><fieldset>
                          <legend><b>Datos de Manguera</b></legend>
						  <div id="manguera_det"> 
						  <?php
						if ($cmanguera==''){
						$cmanguera='000001';
						}
						   echo $clase->manguera_datos($cmanguera);?>	
						  </div>
                       </fieldset></td>
                        <td width="2%">&nbsp;</td>
                      </tr>
                    </table></td>
	 		    </tr>
		 		  <tr>
		 		    <td height="21" colspan="5" ><table width="398" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height="21" colspan="2" ><div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Marcaje Anterior : </strong></font></div></td>
                        <td width="10">&nbsp;</td>
                        <td width="75"><div id='mancaje' style="color:#0000FF; font-weight:bold"><input name="contoini" type="text" id="contoini"  style="height:18; " value="<?php echo $ccontini ?>" size="10"  onkeypress="numero()" readonly /></div></td>
                        <td width="172"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Factor:
                          <input name="factor" type="texto" id="factor"  style="height:18; " value="<?php echo $cfactor ?>" size="10" onkeypress="numero()" readonly />
                        </strong></font></td>
                      </tr>
                      <tr>
                        <td height="21" colspan="2" ><div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Marca de Cont&oacute;metro  : </strong></font></div></td>
                        <td>&nbsp;</td>
                        <td><input name="contometro" type="text" id="contometro"  style="height:18; " value="<?php echo $ccontfin ?>" size="10"  onkeypress="numero()"></td>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
	 		    </tr>
		 		  <tr>
		 		    <td height="21" >&nbsp;</td>
		 		    <td>&nbsp;</td>
		 		    <td>&nbsp;</td>
		 		    <td>&nbsp;</td>
		 		    <td>&nbsp;</td>
	 		    </tr>
        </table></td>
        </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td colspan="6" align="center"><label for="Submit"></label>
          <input style="font-size:10px" type="submit" name="guardar" value="Guardar [F2] " id="guardar">
          <input style="font-size:10px" type="button" name="Submit2" value="Cancelar [ESC]" id="Submit2"  onclick="ocultar();"></td>
        </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
