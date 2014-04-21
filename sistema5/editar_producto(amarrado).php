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
.Estilo28 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo56 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.Estilo57 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.Estilo58 {
	font-size: 12px;
	font-weight: bold;
}
.Estilo59 {
	font-size: 11px;
	color: #990000;
}
-->
</style>
</head>

<script language="javascript" src="miAJAXlib2.js"></script>

<?php 

$accion=$_REQUEST['accion'];

if(isset($_POST['Submit'])){

$cod=$_REQUEST['cod'];
$codprod=$_REQUEST['codprod'];
$nombre=$_POST['nombre'];
$precio=$_POST['precio'];
$und=$_POST['und'];
$factor=$_POST['factor'];

$clasificacion=$_POST['clasificacion'];
$categoria=$_POST['categoria'];
$subcategoria=$_POST['subcategoria'];

//----------------------------iamgenes-----------------------------
$fileName = $_FILES['userfile']['name'];
$tmpName  = $_FILES['userfile']['tmp_name'];

$nombre_archivo = "../imagenes/productos/".$_FILES['userfile']['name'];

 if($accion=='actualizar'){  

	if(move_uploaded_file($tmpName,$nombre_archivo))
	{
	$imagen1="imagenes/productos/".$_FILES['userfile']['name'];
	$strSQL="update producto set imagen='" . $imagen1 . "' where idProducto='" . $cod  . "'";
	mysql_query($strSQL);
	}

	
	
	$strSQL2="update producto set nombre='" . $nombre . "',precio='" . $precio ."',und='" . $und . "',factor='" . $factor . "',cod_prod='" . $codprod . "',imagen='" . $imagen . "',clasificacion='" . $clasificacion . "',categoria='" . $categoria . "',subcategoria='" . $subcategoria . "' where idProducto='" . $cod . "'";
//	echo $strSQL2;
mysql_query($strSQL2);
   echo "<script>alert('Se actualizo correctamente')</script>";

   }
   //---------------------------------------------------------------------------------
   if($accion=='grabar'){
   
   
  			 if(move_uploaded_file($tmpName,$nombre_archivo))
			{
			$imagen1="imagenes/productos/".$_FILES['userfile']['name'];
			}
		
			
		//--------------------------------------------------------------------------	
									
			$strSQL2= "insert into producto (idproducto,clasificacion,categoria,subcategoria,cod_prod,nombre,precio,und,factor,imagen) values ('".$cod."','".$clasificacion."','".$categoria."','".$subcategoria."','".$codprod."','".$nombre."','".$precio."','".$und."','".$factor."','".$imagen."')";
			
		mysql_query($strSQL2);
   
   echo "<script>window.parent.opener.cargarproducto();close();</script>";
   }
   
   
   
}




?>

<script>

function validar(form){
/*
if(form.clasificacion.value=='seleccionar'){
alert('seleccione una clasificacion ');
return false;
}
if(form.categoria.value=='seleccionar'){
alert('seleccione una categoria ');
return false;
}
if(form.subcategoria.value=='seleccionar'){
alert('seleccione una subcategoria ');
return false;
}
*/
return (true);

}




</script>


<body onLoad="cargarcombos()">
<form action="editar_producto.php" method="post" enctype="multipart/form-data" name="form1" onSubmit="return validar(this)">
  <table width="649" height="486" border="0" cellpadding="0" cellspacing="0">
    <tr bgcolor="#003399">
      <td height="41" colspan="5" bgcolor="#006FB9" align="center"><table width="252" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="252"><span class="Estilo13">Edicion de Producto </span></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td width="17" bgcolor="#FAF3E2">&nbsp;</td>
      <td width="113" bgcolor="#FAF3E2">&nbsp;</td>
      <td colspan="3" bgcolor="#FAF3E2"><span class="Estilo12">
        <input type="hidden" name="accion" id="accion" value="<?php if($_REQUEST['cod']==''){
		echo "grabar"; }else{ echo "actualizar"; } ?>">
      </span></td>
    </tr>
    <?php   
  
  $cod=$_REQUEST['cod'];

if($cod==''){
$resultados2 = mysql_query("select max(idProducto) as codi,max(cod_prod) as anexo from producto ",$cn);
$row2=mysql_fetch_array($resultados2);
$codigo=str_pad($row2['codi']+1, 6, "0", STR_PAD_LEFT);  
$codprod=$row2['anexo']+1;  

}
  
  
$resultados = mysql_query("select * from producto where idproducto='$cod'",$cn);
			 // echo "resultado".$resultado;
			  
while($row=mysql_fetch_array($resultados))
{
$codigo=$row['idproducto'];
$nombre=$row['nombre'];
$codprod=$row['cod_prod'];
$precio=$row['precio'];
$clasificacion=$row['clasificacion'];
$categoria=$row['categoria'];
$subcategoria=$row['subcategoria'];
$und=$row['und'];
$factor=$row['factor'];
$imagen1=$row['imagen'];


}
 ?>
    <tr>
      <td height="23" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2"><span class="Estilo56">Codigo</span></td>
      <td bgcolor="#FAF3E2"><span class="Estilo12"><?php echo $codigo;?>
        <label for="textfield"></label>
        <input type="hidden" name="cod" id="cod" value="<?php echo $codigo;?>">
        <input type="hidden" name="subcat" id="subcat" value="<?php echo $subcategoria;?>">
		<input type="hidden" name="cat" id="cat" value="<?php echo $categoria;?>">
      </span></td>
      <td colspan="2" rowspan="7" bgcolor="#FAF3E2">
	  
	  <table width="151" border="1" cellpadding="0" cellspacing="0" >
          <tr>
            <td align="center"><img src="../<?php echo $imagen1?>" width="150" height="150" border="0" /></td>
          </tr>
      </table>	  </td>
    </tr>
    <tr>
      <td height="29" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2"><span class="Estilo56">Codigo Anexo: </span></td>
      <td bgcolor="#FAF3E2"><input type="text" name="codprod" value="<?php echo $codprod;?>"></td>
    </tr>
    <tr>
      <td height="29" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2" class="Estilo56">Nombre:</td>
      <td bgcolor="#FAF3E2"><input type="text" name="nombre" value="<?php echo $nombre;?>" /></td>
    </tr>
    <tr>
      <td height="29" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2" class="Estilo56">Precio:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td bgcolor="#FAF3E2"><input name="precio" type="text" value="<?php echo $precio ?>" size="8" maxlength="10" /></td>
    </tr>
    <tr>
      <td height="29" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2" class="Estilo56">Fecha Modif.: </td>
      <td bgcolor="#FAF3E2" class="Estilo12"><?php echo date('d-m-Y')?></td>
    </tr>
    
    <tr>
      <td height="29" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2"><span class="Estilo56">Unidad</span></td>
      <td bgcolor="#FAF3E2"><select name="und">
        <option value="1" selected>und - Unidad </option>
        <option value="2">Kg - Kilogramos</option>
        <option value="3">Lt - Litros</option>
      </select>
	   <script>
	   var valor1="<?php echo $und?>";
     var i;
	 for (i=0;i<document.form1.und.options.length;i++)
        {
		
            if (document.form1.und.options[i].value==valor1)
               {
			   
               document.form1.und.options[i].selected=true;
               }
        
        }
	      </script>
	  
	  
      </td>
    </tr>
    <tr>
      <td height="31" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2"><span class="Estilo56">Factor</span></td>
      <td width="214" bgcolor="#FAF3E2"><input type="text" name="factor" value="<?php echo $factor;?>" /></td>
    </tr>
    <tr>
      <td height="31" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2"><span class="Estilo56">Imagen1</span></td>
      <td colspan="3" bgcolor="#FAF3E2"><input type="file" name="userfile" id="userfile">
      <input type="hidden" name="imagen1" value="<?php echo $imagen1;?>">
      <span class="Estilo28">Tama&ntilde;o 150 * 150 </span></td>
    </tr>
    
    <tr>
      <td height="29" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2"><span class="Estilo56">Clasificaci&oacute;n</span></td>
      <td colspan="3" bgcolor="#FAF3E2">
	  
	  <select name="clasificacion" onChange="cargarcat()">
        <option value="000">---seleccionar---</option>
        <?php 
	  
	    $resultados0 = mysql_query("select * from clasificacion order by des_clas ",$cn);
			 // echo "resultado".$resultado;
			  
while($row0=mysql_fetch_array($resultados0))
{
		
	  ?>
        <option value="<?php echo $row0['idclasificacion']?>"><?php echo $row0['des_clas']?></option>
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
    </tr>
    <tr>
      <td height="30" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2"><span class="Estilo56">Categoria</span></td>
      <td colspan="3" bgcolor="#FAF3E2"><div id="combocategoria">
        <select name="categoria">
         </select>
		 
		 
		   
  <script>
  function marcarcat(){
	   var valor1=document.form1.cat.value;
     var i;
	 for (i=0;i<document.form1.categoria.options.length;i++)
        {
		
            if (document.form1.categoria.options[i].value==valor1)
               {
			   
               document.form1.categoria.options[i].selected=true;
               }
        
        }
		
	}	
	      </script>
		 
		 
      </div></td>
    </tr>
    <tr>
      <td height="19" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2"><span class="Estilo56">Subcategoria</span></td>
      <td colspan="3" bgcolor="#FAF3E2"><div id="combosubcategoria">
        <select name="subcategoria">
        <!--  <option value="000">---seleccionar---</option>-->
        </select>
		
		<script>
  function marcarsubcat(){
	   var valor1=document.form1.subcat.value;
     var i;
	 for (i=0;i<document.form1.subcategoria.options.length;i++)
        {
		
            if (document.form1.subcategoria.options[i].value==valor1)
               {
			   
               document.form1.subcategoria.options[i].selected=true;
               }
        
        }
		
	}	
	      </script>
		 
		
      </div></td>
    </tr>
    <tr>
      <td height="28" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2">&nbsp;</td>
      <td colspan="3" bgcolor="#FAF3E2"  valign="bottom">&nbsp;</td>
    </tr>
    
    
    <?php 

  
  ?>
    <tr>
      <td height="28" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2">&nbsp;</td>
      <td colspan="2" align="center" bgcolor="#FAF3E2"><label for="Submit"></label>
          <input type="submit" name="Submit" value="Grabar" id="Submit" >
          <input type="button" name="Submit2" value="Cancelar" onClick="salir_ventana();">
          <label for="label"></label>
      <input type="button" name="Submit3" value="Salir" id="label"  onClick="salir_ventana();"></td>
      <td width="304" bgcolor="#FAF3E2">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2">&nbsp;</td>
      <td colspan="3" bgcolor="#FAF3E2">&nbsp;</td>
    </tr>
  </table>
</form>
</body>

<script>


function salir_ventana(){
//window.opener.parent.frames[0].recargar();
//window.opener.parent.frames[0].location.href="lista_productos.php";
window.parent.opener.cargarproducto();
//document.form2.submit(); 
close();
}

function cargarcat(){
//alert();
var clas=document.form1.clasificacion.value;
doAjax('cargarcategorias.php','clas='+clas,'mostrarcat','get','0','1','','');
}
function mostrarcat(texto){
//alert(texto);
document.getElementById('combocategoria').innerHTML=texto;
marcarcat();
}
//---------------------------------------------------------------------------
function cargarsubcat(){
//alert();
var clas=document.form1.categoria.value;
doAjax('cargarsubcategorias.php','clas='+clas,'mostrarsubcat','get','0','1','','');
}
function mostrarsubcat(texto){
//alert(texto);
document.getElementById('combosubcategoria').innerHTML=texto;
marcarsubcat();
}

function cargarcombos(){
var clas=document.form1.clasificacion.value;
var cat=document.form1.cat.value;
var subcat=document.form1.subcat.value;

	if(cat!=''){
	doAjax('cargarcategorias.php','clas='+clas,'mostrarcat','get','0','1','','');
	doAjax('cargarsubcategorias.php','clas='+cat,'mostrarsubcat','get','0','1','','');
	}
}


function espec(cod){
window.open('especificaciones.php?cod='+cod,'ventana3','height=620 width=620 top=80 left=220 status=yes scrollbars=yes');
}


</script>

</html>
<form name="form2" action="productos.php" method="get" target="principal"></form>