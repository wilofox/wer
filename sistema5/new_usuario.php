<?php 
session_start();
include('conex_inicial.php');


if($_REQUEST['accion']=='n'){
			$resultado3=mysql_query("select max(codigo) as codigo from usuarios",$cn);
			$row3=mysql_fetch_array($resultado3);
			
			$codigo=$row3['codigo'];
			$codigo=str_pad($codigo+1, 3, "0", STR_PAD_LEFT);
}



$strSQL4="select * from usuarios where codigo='".$_REQUEST['cod']."'";
  $resultado4=mysql_query($strSQL4,$cn);
  while($row4=mysql_fetch_array($resultado4))
  {
  $codigo=$_REQUEST['cod'];
  $usuario=$row4['usuario'];
  $password=$row4['password'];
  $caja=$row4['caja'];
  $nivel=$row4['nivel'];
  $estado=$row4['estado'];
  if(isset($row4['nombres'])){
  $nombres=$row4['nombres'];
  $email=$row4['email'];
  $telefono1=$row4['telefono1'];  
  $acceso=$row4['acceso'];  
  $dni=$row4['dni'];   
  }else{
	  $nombres="";
  $email="";
  $telefono1="";  
  $acceso="";  
  $dni="";   
  }
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
        <td colspan="2" bgcolor="#004080"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong><font color="#FFFFFF" size="2">Nuevo Usuario &nbsp;</font><font color="#FFFFFF">&nbsp;&nbsp;</font></strong></font></td>
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
        <td height="27"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Usuario:</strong></font></td>
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="usuario" type="text"  style="height:18; font-size:10px" size="20" value="<?php echo $usuario?>" />
        </strong></font></td>
      </tr>
      <tr>
        <td height="24"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Contrase&ntilde;a:</strong></font></td>
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="password" type="password"  style="height:18; font-size:10px" size="10" value="<?php echo $password?>" />
          <span class="Estilo15">
          <select  style="visibility:hidden" name="caja">
            <?php 
		
  $resultados1 = mysql_query("select * from caja order by codigo ",$cn); 
while($row1=mysql_fetch_array($resultados1))
{
		?>
            <option value="<?php echo $row1['codigo'] ?>"><?php echo $row1['descripcion'] ?></option>
            <?php }?>
          </select>
          </span></strong></font></td>
        </tr>
      <tr>
        <td height="24"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Nivel:</strong></font></td>
        <td><label for="select">
          <select name="nivel">
            <option value=1>Vendedor1(1)</option>
			<option value=7>Vendedor2(7)</option>
			<option value=8>Vendedor3(8)</option>
            <option value=2>almacen(2)</option>
            <option value=3>Compras(3)</option>
			<option value=4>Oficina(4)</option>
			<option value=9>Oficina2(9)</option>
			<option value=10>Contabilidad(10)</option>
			<option value=11>Gerencia(11)</option>
			
			<?php 
			if($_SESSION['nivel_usu']==5){
			
			?>
			<option value=5>Administrador(5)</option>
			<?php }?>
			<option value=6>Caja(6)</option>
          </select>
          <input type="hidden" name="nivel_temp" value="<?php echo $nivel ?>"/>
        </label></td>
        </tr>
      <tr>
        <td height="24"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Estado:</strong></font></td>
        <td><select name="estado">
          <option value="C">Conectado</option>
          <option value="D" selected="selected">Desconectado</option>
        </select>
          <input type="hidden" name="estado_temp" value="<?php echo $estado ?>" />        </td>
      </tr>
      
      <tr>
        <td height="19" colspan="2"><input type="hidden" name="accion" value="<?php echo $_REQUEST['accion']?>" />
          <font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>B&uacute;squedas por: 
          <select name="busqueda">
            <option value="idproducto">C&oacute;digo Sistema</option>
			   <option value="nombre" selected="selected">Descripci&oacute;n</option>
			    <option value="cod_prod">C&oacute;digo Anexo</option>
				 <option value="serie">Series</option>
          </select>
          </strong></font></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="25"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Agenda; </strong></font></td>
        <td height="25"><select name="agenda">
          <option value="S">SI</option>
          <option value="N" selected="selected">NO</option>
        </select>        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="25"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Nombres</strong></font></td>
        <td height="25"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="nombres" type="text"  style="height:18; font-size:10px" size="20" value="<?php echo $nombres?>" />
        </strong></font></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="25"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Email</strong></font></td>
        <td height="25"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="email" type="text"  style="height:18; font-size:10px" size="20" value="<?php echo $email ?>" />
        </strong></font></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="25"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Tel&eacute;fono</strong></font></td>
        <td height="25"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="telefono1" type="text"  style="height:18; font-size:10px" size="20" value="<?php echo $telefono1 ?>" />
        </strong></font></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="25"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Dni</strong></font></td>
        <td height="25"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="dni" type="text"  style="height:18; font-size:10px" size="20" value="<?php echo $dni ?>" />
        </strong></font></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
	  
	  <?php 
	  
	  ?>
      
	  <?php 
	  
	  ?>
	  
      <tr>
        <td>&nbsp;</td>
        <td height="25">
		<?php 
		if($_SESSION['nivel_usu']==5){
		
		?>
		<strong><font size="1px" face="Verdana, Arial, Helvetica, sans-serif">Usuario de sistema </font></strong>
		<?php 
		}
		?>		</td>
        <td height="25">
		
		<?php 
		if($_SESSION['nivel_usu']==5){
		
		?>
		<select name="acceso">
          <option value="S">SI</option>
          <option value="N" selected="selected">NO</option>
        </select>
		
		<?php 
		
		}
		?>
		   <input type="hidden" name="acceso_temp" value="<?php echo $acceso ?>" />		</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td rowspan="2">&nbsp;</td>
        <td colspan="2" align="right"><label for="Submit"></label>
          <input style="font-size:10px" type="submit" name="guardar" value="Guardar" id="guardar">
          <input style="font-size:10px" type="button" name="Submit2" value="Cancelar" id="Submit2"  onclick="ocultar();"></td>
        <td rowspan="2">&nbsp;</td>
        <td rowspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<?php 


?>