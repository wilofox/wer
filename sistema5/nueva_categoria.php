<?php 
session_start();
include('conex_inicial.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo12 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo13 {
	font-size: 14px;
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
-->
</style>
</head>

<body>
<form action="lista_categoria.php" method="post" enctype="multipart/form-data" name="form1">
  <table width="401" height="201" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor="#003399">
      <td height="41" colspan="5" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr bgcolor="#003399">
      <td height="41" colspan="5"><span class="Estilo13">Nueva Categoria </span></td>
    </tr>
    <tr>
      <td width="18" height="19" bgcolor="#F8EFD6">&nbsp;</td>
      <td width="77" bgcolor="#F8EFD6">&nbsp;</td>
      <td colspan="2" bgcolor="#F8EFD6"><input type="hidden" name="accion" value="nuevo"></td>
      <td width="145" bgcolor="#F8EFD6">&nbsp;</td>
    </tr>
    <tr>
      <td height="25" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6"><span class="Estilo27">Codigo</span></td>
      <td width="160" bgcolor="#F8EFD6"><span class="Estilo12">
        <label for="textfield"><strong>Autogenerado</strong></label>
        <input type="hidden" name="cod" id="cod" value="">
      </span></td>
      <td colspan="2" bgcolor="#F8EFD6">&nbsp;</td>
    </tr>
    <tr>
      <td height="29" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6"><span class="Estilo27">Nombre</span></td>
      <td bgcolor="#F8EFD6"><input type="text" name="cnombre" value="" /></td>
      <td colspan="2" bgcolor="#F8EFD6">&nbsp;</td>
    </tr>
  
    <tr>
      <td height="19" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6">&nbsp;</td>
      <td colspan="3" bgcolor="#F8EFD6">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6">&nbsp;</td>
      <td colspan="3" bgcolor="#F8EFD6"><label for="Submit"></label>
          <input type="submit" name="Submit" value="Grabar" id="Submit">
          <input type="button" name="Submit2" value="Cancelar" onClick="salir_ventana();">
          <label for="label"></label>
          <input type="button" name="Submit3" value="Salir" id="label" onClick="salir_ventana();"></td>
    </tr>
    <tr>
      <td height="35" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6">&nbsp;</td>
      <td colspan="3" bgcolor="#F8EFD6">&nbsp;</td>
    </tr>
  </table>
</form>
</body>

<script>


function salir_ventana(){
window.opener.parent.frames[0].recargar();
close();
}

</script>

</html>
