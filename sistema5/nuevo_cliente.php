<?php 
session_start();
include('conex_inicial.php');

$codcliente="";
$nombre="";
$paterno="";
$materno="";
$sexo="";
$telefono="";
$rpm="";
$email="";
$razon="";
$ruc="";
$cargo="";
$direccion="";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo12 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo13 {
	font-size: 12px;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #FFFFFF;
}
body {
	margin-left: 00px;
	margin-top: 00px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo27 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.Estilo29 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }
-->
</style>
</head>

<body>
<form action="lista_clientes.php" method="post" name="form1" target="principal" >
  <table width="635" height="354" border="0" align="center" cellpadding="0" cellspacing="0">
    <?php if(!isset($_REQUEST['cod'])){?>
	
	<tr >
      <td height="25" colspan="6">&nbsp;</td>
    </tr>
	
	<?php }?>
    <tr bgcolor="#003399">
      <td height="41">&nbsp;</td>
      <td height="41" colspan="2">
	  <?php if(!isset($_REQUEST['cod'])){?>
	  <span class="Estilo13">Nuevo Cliente  </span>
	  <?php }else{?>
	   <span class="Estilo13">Editar Cliente  </span>
	  <?php }?>	  </td>
      <td height="41">&nbsp;</td>
      <td height="41">&nbsp;</td>
      <td height="41">&nbsp;</td>
    </tr>
    <tr>
      <td width="31" height="22" bgcolor="#F8EFD6">&nbsp;</td>
      <td width="126" bgcolor="#F8EFD6">&nbsp;</td>
      <td colspan="2" bgcolor="#F8EFD6"><input type="hidden" name="ac" value="actualizar"></td>
      <td colspan="2" bgcolor="#F8EFD6">&nbsp;</td>
    </tr>
 
 <?php 
 
if(isset($_REQUEST['cod'])){

		  $cod=$_REQUEST['cod'];
		  $resultados = mysql_query("select * from clientes where cod_registro='$cod'",$cn);
					 // echo "resultado".$resultado;
					  
		while($row=mysql_fetch_array($resultados))
		{
		
		$codcliente=$row['codcliente'];
		$nombre=$row['nombres'];
		$paterno=$row['a_paterno'];
		$materno=$row['a_materno'];
		$sexo=$row['sexo'];
		$telefono=$row['telefono'];
		$rpm=$row['nextel_rpm'];
		$email=$row['mail'];
		$razon=$row['empresa'];
		$ruc=$row['ruc'];
		$cargo=$row['razonsocial'];
		$direccion=$row['direccion'];
		
		}
		mysql_free_result($resultados);

}
		
		
	

 ?>
 
    <tr>
      <td height="24" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6"><span class="Estilo27">Codigo</span></td>
      <td width="175" bgcolor="#F8EFD6"><span class="Estilo12">
        <label for="textfield"></label>
        <input type="hidden" name="codregistro" id="codregistro" value="<?php echo $cod?>">
        <strong>      Autogenerado</strong></span></td>
      <td width="86" align="center" bgcolor="#F8EFD6"><label for="label"></label></td>
      <td width="86" align="center" bgcolor="#F8EFD6">
	  
	  <input type="submit" name="Submit" value="Grabar" id="Submit"  onClick="salir_ventana();">   
	  
      </td>
      <td width="131" align="left" bgcolor="#F8EFD6"><input type="button" name="Submit2" value="Cancelar" onClick="salir_ventana();"></td>
    </tr>
    <tr>
      <td height="22" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6"><span class="Estilo27">Codigo Prolyam </span></td>
      <td bgcolor="#F8EFD6"><input name="ccodcliente" type="text" value="<?php echo $codcliente?>" size="10" maxlength="6" /></td>
      <td align="left" bgcolor="#F8EFD6">&nbsp;</td>
      <td colspan="2" align="left" bgcolor="#F8EFD6">&nbsp;</td>
    </tr>
    <tr>
      <td height="27" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6"><span class="Estilo27">Nombres</span></td>
      <td bgcolor="#F8EFD6"><input type="text" name="cnombre" value="<?php echo $nombre?>" /></td>
      <td bgcolor="#F8EFD6"><span class="Estilo27">Sexo</span></td>
      <td bgcolor="#F8EFD6"><label for="select">
        <select name="csexo" id="csexo">
          <option value="M">M</option>
          <option value="F">F</option>
        </select>
      </label></td>
      <td bgcolor="#F8EFD6"><span class="Estilo27">Nextel:
          <input name="ctelefonos2" type="text" value="<?php echo $rpm?>" size="8" />
      </span></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6"><span class="Estilo27">A. Paterno </span></td>
      <td bgcolor="#F8EFD6"><input type="text" name="cpaterno" value="<?php echo $paterno?>" /></td>
      <td bgcolor="#F8EFD6"><span class="Estilo27">Telefonos</span></td>
      <td colspan="2" bgcolor="#F8EFD6"><input name="ctelefonos" type="text" value="<?php echo $telefono?>" size="15" /></td>
    </tr>
    <tr>
      <td height="26" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6"><span class="Estilo27">A. Materno </span></td>
      <td bgcolor="#F8EFD6"><input type="text" name="cmaterno" value="<?php echo $materno?>" /></td>
      <td bgcolor="#F8EFD6"><span class="Estilo27">Email</span></td>
      <td colspan="2" bgcolor="#F8EFD6"><input type="text" name="cemail" value="<?php echo $email?>" /></td>
    </tr>
    <tr>
      <td height="19" colspan="6" bgcolor="#F8EFD6">&nbsp;</td>
    </tr>
    <tr>
      <td height="30" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6"><span class="Estilo27">Raz&oacute;n Social </span></td>
      <td bgcolor="#F8EFD6"><input type="text" name="crazon" value="<?php echo $razon?>" /></td>
      <td bgcolor="#F8EFD6"><span class="Estilo27">Ruc</span></td>
      <td colspan="2" bgcolor="#F8EFD6"><input name="cruc" type="text" value="<?php echo $ruc?>" size="15" /></td>
    </tr>
    <tr>
      <td height="30" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6"><span class="Estilo27">Cargo</span></td>
      <td bgcolor="#F8EFD6"><input name="ccargo" type="text" value="<?php echo $cargo?>" size="15" /></td>
      <td bgcolor="#F8EFD6"><span class="Estilo27">Direcci&oacute;n</span></td>
      <td colspan="2" bgcolor="#F8EFD6"><input type="text" name="cdireccion" value="<?php echo $direccion?>" /></td>
    </tr>
	
	<?php 
	
		
		?>
    <tr>
      <td height="22" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6">&nbsp;</td>
    </tr>
    <tr>
      <td height="22" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td colspan="4" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
  </table>
</form>
</body>

<script>

function salir_ventana(){
//window.opener.parent.frames[0].recargar();
close();
}

</script>

</html>
