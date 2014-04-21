<?php include('miclase.php');

$clase=new miclase('');
if(isset($_REQUEST['cod'])){
list($cid,$cnombre,$cdescripcion,$cproducto,$ccapacidad,$cubicacion,$clargo,$cradio)=$clase->consulta_tanque($_REQUEST['cod']);
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
        <td colspan="6"><strong><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">Tanques</font></strong></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="6"><input name="accion" type="hidden" id="accion" value='<?php echo $_REQUEST['accion'];?>'/><span style="color:#0000FF"></span></td>
        </tr>
      <tr>
        <td>&nbsp;&nbsp;</td>
        <td colspan="6"><table width="295" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="54" height="21"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Codigo:</strong></font></td>
            <td colspan="6"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>
              <?php if($_REQUEST['accion']=="n"){echo $clase->cod_autogenerado('id','tanques');}else{ echo $cid;}?>
              <input name="codigo" type="hidden" id="codigo"  value="<?php if($_REQUEST['accion']=="n"){echo $clase->cod_autogenerado('id','tanques');}else{ echo $cid;}?>"/>
            </strong></font></td>
          </tr>
		  <tr>
		         <td height="21" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Nombre: </strong></font></td>
                 <td width="120"><input autocomplete="off" id="nombre" name="nombre" type="text" size="20" maxlength="50"  style="height:18; " value="<?php echo $cnombre ?>" />
                  </span></td>
                 <td width="7">&nbsp;</td>
                 <td width="35">&nbsp;</td>
                 <td width="79">&nbsp;</td>
		  </tr>
		 		  <tr>
		         <td height="21" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Nº_Compart.: </strong></font></td>
                 <td>
                   <input name="descripcion" type="text" id="descripcion" style="background:#FFFFFF" value="<?php echo $cdescripcion ?>" size="10" /></td>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
	 		    </tr>
		 		  <tr>
		 		    <td height="21" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Producto:</strong></font></td>
		 		    <td colspan="4">
					 <select name="producto" style="width:260px" onChange="tipotanque(this);" >
			<?php 
			
 				 $resultados1 = mysql_query("select * from producto order by nombre "); 
				while($rowD=mysql_fetch_array($resultados1))
				{
				
				if ($rowD['idproducto']== $cproducto){
				?>
			<option value="<?php echo $rowD['idproducto'] ?>" selected><?php echo $rowD['nombre'] ?></option>

		    <?php 
				}else{
		?>
			<option value="<?php echo $rowD['idproducto'] ?>"><?php echo $rowD['nombre'] ?></option>

		    <?php 
				}
			}?>
        </select>		 		    </td>
 		        </tr>
		 		  <tr>
		 		    <td height="21" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Ubicacion:</strong></font></td>
		 		    <td colspan="4"><div id="cbo_tienda">
		 		      <input name="ubicacion" type="text" id="ubicacion" style="background:#FFFFFF" value="<?php echo $cubicacion ?>" size="30" />
</div></td>
 		        </tr>
		 		  <tr>
		 		    <td height="21" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Capacidad:</strong></font></td>
		 		    <td><input name="capacidad" type="text" id="capacidad" style="background:#FFFFFF" value="<?php echo $ccapacidad ?>" size="10" onkeypress="numerodesc()" /></td>
	 		        <td>&nbsp;</td>
	 		        <td>&nbsp;</td>
	 		        <td>&nbsp;</td>
	 		    </tr>
		 		  <tr id='tipGLP'>
		 		    <td height="21" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Largo : </strong></font></td>
		 		    <td><input name="largo" type="text" id="largo" style="background:#FFFFFF" value="<?php echo $clargo ?>" size="10" onkeypress="numero()" /></td>
	 		        <td>&nbsp;</td>
	 		        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#000000"><strong>Radio : </strong></font></td>
	 		        <td><input name="radio" type="text" id="radio" style="background:#FFFFFF" value="<?php echo $cradio ?>" size="10"  /></td>
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
