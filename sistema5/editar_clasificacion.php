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
.Estilo29 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
-->
</style>
</head>

<?php 
$accion=$_REQUEST['accion'];
//echo $accion;
if(isset($_POST['Submit'])){

$cod=$_REQUEST['cod'];
$nombre=$_POST['cnombre'];
$agrupado=$_REQUEST['agrupado'];
echo $agrupado;
//----------------------------iamgenes-----------------------------
$fileName = $_FILES['userfile']['name'];
$tmpName  = $_FILES['userfile']['tmp_name'];

$nombre_archivo = "../imagenes/productos/".$_FILES['userfile']['name'];


if($accion=='actualizar'){
	if(move_uploaded_file($tmpName,$nombre_archivo))
	{
	$imagen1="imagenes/productos/".$_FILES['userfile']['name'];
	$strSQL="update clasificacion set imagen='" . $imagen1 . "' where idclasificacion='" . $cod  . "'";
	mysql_query($strSQL);
	}

	$strSQL2="update clasificacion set des_clas='" . $nombre . "',agrupado='" . $agrupado . "'  where idclasificacion='" . $cod . "'";
	mysql_query($strSQL2);
	
	echo "<script>window.parent.opener.recargar();close();</script>";	
	
	
		
}

if($accion=='grabar'){
	if(move_uploaded_file($tmpName,$nombre_archivo))
	{
	$imagen1="imagenes/productos/".$_FILES['userfile']['name'];
	}
	
	$strSQL2="insert into clasificacion(idclasificacion,des_clas,imagen,agrupado) values('".$cod."','".$nombre."','".$imagen1."','".$agrupado."')";
//	echo $strSQL2;

/*  echo "<script>alert('Se grabo correctamente')</script>";*/

	mysql_query($strSQL2);
	
	echo "<script>window.parent.opener.recargar();close();</script>";	
	

}

	
}






	
	
	
	
	

?>




<body>
<form action="editar_clasificacion.php" method="post" enctype="multipart/form-data" name="form1">
  <table width="400" height="250" border="0" cellpadding="0" cellspacing="0">
    <tr bgcolor="#003399">
      <td height="41" colspan="5"><span class="Estilo13">Edici&oacute;n de Clasificaci&oacute;n</span></td>
    </tr>
    
    <?php   



  
$cod=$_REQUEST['cod'];

if($cod==''){
$resultados2 = mysql_query("select max(idclasificacion) as codi from clasificacion ",$cn);
$row2=mysql_fetch_array($resultados2);
$idclasificacion=str_pad($row2['codi']+1, 3, "0", STR_PAD_LEFT);  
//echo $idclasificacion;
}

$resultados = mysql_query("select * from clasificacion where idclasificacion='$cod'",$cn);
 // echo "resultado".$resultado;
 //echo "select * from clasificacion where idclasificacion='$cod'";
while($row=mysql_fetch_array($resultados))
{
$idclasificacion=$row['idclasificacion'];
$descripcion=$row['des_clas'];
$imagen=$row['imagen'];
$agrupado=$row['agrupado'];
}



 ?>
    <tr>
      <td width="16" height="25" bgcolor="#F8EFD6">&nbsp;</td>
      <td width="98" bgcolor="#F8EFD6">&nbsp;</td>
      <td width="144" bgcolor="#F8EFD6"><span class="Estilo12">
        <input type="hidden" name="accion" id="accion" value="<?php echo $accion;?>">
      </span></td>
      <td width="142" colspan="2" rowspan="3" bgcolor="#F8EFD6">&nbsp;</td>
    </tr>
    <tr>
      <td height="29" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6"><span class="Estilo29">C&oacute;digo</span></td>
      <td bgcolor="#F8EFD6"><span class="Estilo12"><?php echo $idclasificacion;?>
          <label for="textfield"></label>
          <input type="hidden" name="cod" id="cod" value="<?php echo $idclasificacion;?>">
      </span></td>
    </tr>
    
    <tr>
      <td height="29" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6"><span class="Estilo29">Descripci&oacute;n</span></td>
      <td bgcolor="#F8EFD6"><input type="text" name="cnombre" value="<?php echo $descripcion;?>" /></td>
    </tr>
    
    <tr style="display:none">
      <td height="31" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6"><span class="Estilo29">Imagen1</span></td>
      <td colspan="3" bgcolor="#F8EFD6"><input type="file" name="userfile" id="userfile">
      <input type="hidden" name="imagen1" value="<?php echo $imagen;?>"></td>
    </tr>
    <tr>
      <td height="19" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6" class="Estilo29">Elementos de Producci&oacute;n </td>
      <td colspan="3" bgcolor="#F8EFD6">
	  <?php /*?> 
	  <select name="agrupado" id="agrupado" >
	    <option value="1" selected="selected">(1) Mercaderias</option>  Materia prima/Insumos            materiales
	    <option value="2">(2) Equipos</option>							Mercaderia/Producto Terminado    Equipos
	    <option value="3">(3) Servicios</option>						Servicios	                     Herramientas  	  <?php */?>
	 <select name="agrupado" id="agrupado" >
	    <option value="1" selected="selected">(1) Materia prima/Insumos</option>
	    <option value="2">(2) Mercaderia/Producto Terminado</option>
	    <option value="3">(3) Servicios</option>
		<script>
	   var valor1="<?php echo $agrupado?>";
     var i;
	 for (i=0;i<document.form1.agrupado.options.length;i++)
        {
		
            if (document.form1.agrupado.options[i].value==valor1)
               {
			   
               document.form1.agrupado.options[i].selected=true;
               }
        
        }
	      </script>
      </select>
	  <!--
	  mercaderias---equipos y servicios
	  
	  -->
      </td>
    </tr>
    
    
    <?php 
  
  
  //mysql_free_result($resultados);
  
  ?>
    <tr>
      <td bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6">&nbsp;</td>
      <td colspan="3" bgcolor="#F8EFD6"><label for="Submit"></label>
          <input type="submit" name="Submit" value="Grabar" id="Submit" >
          <input type="button" name="Submit2" value="Cancelar" onClick="salir_ventana();">
          <label for="label"></label>
          <input type="button" name="Submit3" value="Salir" id="label" onClick="salir_ventana();"></td>
    </tr>
    <tr>
      <td bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6">&nbsp;</td>
      <td colspan="3" bgcolor="#F8EFD6">&nbsp;</td>
    </tr>
  </table>
</form>
</body>

<script>


function salir_ventana(){
//window.opener.parent.frames[0].recargar();
//window.opener.parent.frames[0].location.href="lista_productos.php";
document.form2.submit(); 
close();
}

</script>

</html>
<form name="form2" action="clasificacion.php" method="get" target="principal"></form>