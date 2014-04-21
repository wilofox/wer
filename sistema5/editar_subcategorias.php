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

<?php 
$accion=$_REQUEST['accion'];

if(isset($_POST['Submit'])){

$cod=$_REQUEST['cod'];
$nombre=$_POST['cnombre'];
$clasificacion=$_POST['clasificacion'];

//----------------------------iamgenes-----------------------------
$fileName = $_FILES['userfile']['name'];
$tmpName  = $_FILES['userfile']['tmp_name'];

$nombre_archivo = "../imagenes/productos/".$_FILES['userfile']['name'];


if($accion=='actualizar'){
	if(move_uploaded_file($tmpName,$nombre_archivo))
	{
	$imagen1="imagenes/productos/".$_FILES['userfile']['name'];
	$strSQL="update subcategoria set imagen='" . $imagen1 . "' where idsubcategoria='" . $cod  . "'";
	mysql_query($strSQL);
	}

	$strSQL2="update subcategoria set des_subcateg='" . $nombre . "',categoria='" . $clasificacion . "' where idsubcategoria='" . $cod . "'";
	mysql_query($strSQL2);
	
	echo "<script>window.parent.opener.recargar();close();</script>";
	
}

if($accion=='grabar'){

	if(move_uploaded_file($tmpName,$nombre_archivo))
	{
	$imagen1="imagenes/productos/".$_FILES['userfile']['name'];
	}
	
	if($cod!='' && $cod!='000'){
	$strSQL2="insert into subcategoria(idsubcategoria,des_subcateg,imagen,categoria) values('".$cod."','".$nombre."','".$imagen1."','".$clasificacion."')";
//	echo $strSQL2;
	mysql_query($strSQL2);
	}
	
	echo "<script>window.parent.opener.recargar();close();</script>";
	

}

}

?>

<body>
<form action="editar_subcategorias.php" method="post" enctype="multipart/form-data" name="form1">
  <table width="400" height="280" border="0" cellpadding="0" cellspacing="0">
    <tr bgcolor="#003399">
      <td height="41" colspan="5"><span class="Estilo13">Edici&oacute;n de Subcategor&iacute;as </span></td>
    </tr>
    
    <?php   



  
$cod=$_REQUEST['cod'];

if($cod==''){
$resultados2 = mysql_query("select max(idsubcategoria) as codi from subcategoria ",$cn);
$row2=mysql_fetch_array($resultados2);
$idCategoria=str_pad($row2['codi']+1, 3, "0", STR_PAD_LEFT);  
}

$resultados = mysql_query("select * from subcategoria where idsubcategoria='$cod'",$cn);
 // echo "resultado".$resultado;
while($row=mysql_fetch_array($resultados))
{
$idCategoria=$row['idsubcategoria'];
$descripcion=$row['des_subcateg'];
$imagen=$row['imagen'];
$clasificacion=$row['categoria'];
}


 ?>
    <tr>
      <td width="31" height="25" bgcolor="#F8EFD6">&nbsp;</td>
      <td width="100" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6"><span class="Estilo12">
        <input type="hidden" name="accion" id="accion" value="<?php echo $accion;?>">
      </span></td>
      <td width="13" colspan="2" bgcolor="#F8EFD6">&nbsp;</td>
    </tr>
    <tr>
      <td height="29" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6"><span class="Estilo27">C&oacute;digo</span></td>
      <td bgcolor="#F8EFD6"><span class="Estilo12"><?php echo $idCategoria;?>
          <label for="textfield"></label>
          <input type="hidden" name="cod" id="cod" value="<?php echo $idCategoria;?>">
      </span></td>
      <td width="13" colspan="2" bgcolor="#F8EFD6">&nbsp;</td>
    </tr>
    
    <tr>
      <td height="29" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6"><span class="Estilo27">Descripci&oacute;n</span></td>
      <td bgcolor="#F8EFD6"><input type="text" name="cnombre" value="<?php echo $descripcion;?>" /></td>
      <td width="13" colspan="2" bgcolor="#F8EFD6">&nbsp;</td>
    </tr>
    <tr style="display:none">
      <td height="31" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6"><span class="Estilo27">Categor&iacute;as</span></td>
      <td width="171" bgcolor="#F8EFD6">
	  
	  <select name="clasificacion">
        <?php 
	  
	    $resultados0 = mysql_query("select * from categoria order by des_cat ",$cn);
			 // echo "resultado".$resultado;
			  
	while($row0=mysql_fetch_array($resultados0))
	{
		
	  ?>
        <option value="<?php echo $row0['idCategoria']?>"><?php echo $row0['des_cat']?></option>
        <?php 
	 }
	  ?>
        <script>
	   var valor1="<?php echo $clasificacion?>";
     var i;
	 for (i=0;i<document.form1.clasificacion.options.length;i++)
        {
		
            if (document.form1.clasificacion.options[i].value==valor1)
               {
			   
               document.form1.clasificacion.options[i].selected=true;
               }
        
        }
	  </script>
      </select></td>
      <td width="13" colspan="2" bgcolor="#F8EFD6">&nbsp;</td>
    </tr>
    <tr style="display:none">
      <td height="31" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6"><span class="Estilo27">Imagen1</span></td>
      <td colspan="3" bgcolor="#F8EFD6"><input type="file" name="userfile" id="userfile">
      <input type="hidden" name="imagen1" value="<?php echo $imagen;?>"></td>
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
      <td height="19" bgcolor="#F8EFD6">&nbsp;</td>
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
<form name="form2" action="subcategorias.php" method="get" target="principal"></form>