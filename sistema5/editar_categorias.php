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
.Estilo28 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.Estilo37 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #0066FF; font-weight: bold; }
.Estilo39 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
-->
</style>
</head>

<?php 
$accion=$_REQUEST['accion'];

if(isset($_POST['Submit'])){

$cod=$_REQUEST['cod'];
$nombre=$_POST['cnombre'];
$clasificacion=$_POST['clasificacion'];
$puntos=$_POST['radiobutton'];

if($puntos=='C'){
$cantpuntos=$_POST['cantptos1'];
}else{
$cantpuntos=$_POST['cantptos2'];
}


//----------------------------iamgenes-----------------------------
$fileName = $_FILES['userfile']['name'];
$tmpName  = $_FILES['userfile']['tmp_name'];

$nombre_archivo = "../imagenes/productos/".$_FILES['userfile']['name'];


if($accion=='actualizar'){
	if(move_uploaded_file($tmpName,$nombre_archivo))
	{
	$imagen1="imagenes/productos/".$_FILES['userfile']['name'];
	$strSQL="update categoria set imagen='" . $imagen1 . "' where idCategoria='" . $cod  . "'";
	mysql_query($strSQL);
	}

	$strSQL2="update categoria set des_cat='" . $nombre . "',clasificacion='" . $clasificacion . "',puntos='" . $puntos . "',cantpuntos='" . $cantpuntos . "' where idCategoria='" . $cod . "'";
	mysql_query($strSQL2);
	echo "<script>window.parent.opener.recargar();close();</script>";	
	
	
}

if($accion=='grabar'){
	if(move_uploaded_file($tmpName,$nombre_archivo))
	{
	$imagen1="imagenes/productos/".$_FILES['userfile']['name'];
	}
	
	$strSQL2="insert into categoria(idCategoria,des_cat,imagen,clasificacion,puntos,cantpuntos) values('".$cod."','".$nombre."','".$imagen1."','".$clasificacion."','".$puntos."','".$cantpuntos."')";
//	echo $strSQL2;
	mysql_query($strSQL2);
	echo "<script>window.parent.opener.recargar();close();</script>";
	
}

}

?>

<body>
<form action="editar_categorias.php" method="post" enctype="multipart/form-data" name="form1">
  <table width="429" height="319" border="0" cellpadding="0" cellspacing="0">
    <tr bgcolor="#003399">
      <td height="41" colspan="3"><span class="Estilo13">Edici&oacute;n de Categor&iacute;as </span></td>
    </tr>
    
    <?php   



  
$cod=$_REQUEST['cod'];

if($cod==''){
$resultados2 = mysql_query("select max(idCategoria) as codi from categoria ",$cn);
$row2=mysql_fetch_array($resultados2);
$idCategoria=str_pad($row2['codi']+1, 3, "0", STR_PAD_LEFT);  
}

$resultados = mysql_query("select * from categoria where idCategoria='$cod'",$cn);
 // echo "resultado".$resultado;
 
 $chk1="";
 $chk2="";
 $cantptos1="";
 $cantptos2="";
 $disabled1="";
 $disabled2="";
 
while($row=mysql_fetch_array($resultados))
{
$idCategoria=$row['idCategoria'];
$descripcion=$row['des_cat'];
$imagen=$row['imagen'];
$clasificacion=$row['clasificacion'];

$puntos=$row['puntos'];
$cantpuntos=$row['cantpuntos'];

	if($puntos=='V'){
	$chk2=" checked ";
	$cantptos2=$row['cantpuntos'];
	$disabled1= " disabled ";
	
	}else{
	$chk1=" checked ";
	$cantptos1=$row['cantpuntos'];
	$disabled2= " disabled ";
	}
}


 ?>
    <tr>
      <td width="9" height="25" bgcolor="#F8EFD6">&nbsp;</td>
      <td width="84" bgcolor="#F8EFD6">&nbsp;</td>
      <td width="336" bgcolor="#F8EFD6"><span class="Estilo12">
        <input type="hidden" name="accion" id="accion" value="<?php echo $accion;?>">
      </span></td>
    </tr>
    <tr>
      <td height="35" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6"><span class="Estilo27">C&oacute;digo</span></td>
      <td bgcolor="#F8EFD6"><span class="Estilo12"><?php echo $idCategoria;?>
          <label for="textfield"></label>
          <input type="hidden" name="cod" id="cod" value="<?php echo $idCategoria;?>">
      </span></td>
    </tr>
    
    <tr>
      <td height="35" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6"><span class="Estilo27">Descripci&oacute;n</span></td>
      <td bgcolor="#F8EFD6"><input name="cnombre" type="text"   onKeyDown="evento(event)" value="<?php echo $descripcion;?>" size="30" /></td>
    </tr>
    <tr style="display:none">
      <td height="31" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6"><span class="Estilo27">Clasificaci&oacute;n</span></td>
      <td bgcolor="#F8EFD6">
	  
	  <select name="clasificacion">
        <?php 
	  
	    $resultados0 = mysql_query("select * from clasificacion order by idclasificacion ",$cn);
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
    <tr style="display:none">
      <td height="31" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6"><span class="Estilo27">Imagen1</span></td>
      <td bgcolor="#F8EFD6"><input type="file" name="userfile" id="userfile">
      <input type="hidden" name="imagen1" value="<?php echo $imagen;?>">
      <span class="Estilo28">Tama&ntilde;o150*150</span></td>
    </tr>
    <tr >
      <td height="78" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6"><span class="Estilo27">Puntos </span></td>
      <td bgcolor="#F8EFD6"><table style="border:#999999 solid 1px" width="323" height="66" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="140" height="23" align="center" bgcolor="#EEEEEE" style="border-right:#999999 solid 1px;border-bottom:#999999 solid 1px;"><span class="Estilo37">
            <input name="radiobutton" type="radio" value="C" <?php echo $chk1; ?>  onClick="limpiarchk(this)">
            Por Cantidad </span></td>
          <td width="163" align="center" bgcolor="#EEEEEE" style="border-bottom:#999999 solid 1px"><span class="Estilo37">
            <input name="radiobutton" type="radio" value="V" <?php echo $chk2; ?> onClick="limpiarchk(this)">
            Por valor catalogo </span></td>
        </tr>
        <tr>
          <td height="41" align="center" bgcolor="#EEEEEE" style="border-right:#999999 solid 1px"><span class="Estilo39"> 1 und  
            =
            <input <?php echo $disabled1 ?> name="cantptos1" type="text" size="5" maxlength="6" value="<?php echo $cantptos1; ?>" onKeyDown="validarNumero(this,event)">
            ptos.</span></td>
          <td align="center" bgcolor="#EEEEEE"><span class="Estilo39"> 1
            <select name="select" style="font:Arial, Helvetica, sans-serif; font-size:11px;">
                  <option value="01">S/.</option>
                  <option value="02">US$</option>
              </select>
            =
            <input <?php echo $disabled2 ?> name="cantptos2" type="text" size="5" maxlength="6" value="<?php echo $cantptos2;?>" onKeyDown="validarNumero(this,event)">
            ptos.</span></td>
        </tr>
      </table></td>
    </tr>
    
    
    
    <?php   
  //mysql_free_result($resultados);
   ?>
    <tr>
      <td bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6"><label for="Submit"></label>
          <input type="submit" name="Submit" value="Grabar" id="Submit" >
          <input type="button" name="Submit2" value="Cancelar" onClick="salir_ventana();">
          <label for="label"></label>
          <input type="button" name="Submit3" value="Salir" id="label" onClick="salir_ventana();"></td>
    </tr>
    <tr>
      <td height="19" bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6">&nbsp;</td>
      <td bgcolor="#F8EFD6">&nbsp;</td>
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

function evento(e){
	if(e.keyCode==13){
	event.keyCode=0;
	event.returnValue=false
	return false;
	}
}

function limpiarchk(obj){
	//alert(e.value);
	if(obj.value=='C'){
	document.form1.cantptos2.value="";
	document.form1.cantptos1.disabled=false;
	document.form1.cantptos2.disabled=true;
	
	}else{
	document.form1.cantptos1.value="";
	document.form1.cantptos2.disabled=false;
	document.form1.cantptos1.disabled=true;
	}

}


function validarNumero(control,e){
//alert(e.keyCode);
	try{
		if((e.keyCode>=96 && e.keyCode<=105) || (e.keyCode>46 && e.keyCode<58) || e.keyCode==8  || e.keyCode==37 || e.keyCode==39 ){
			temp=control.value.split(".");
			if(e.keyCode==190 || e.keyCode==110){
				if(temp[1]!=undefined){	
					e.keyCode=0;
					event.returnValue=false;
					return false;
				}
			}
		}else{
			if(e.keyCode==13){
				
				
			}else{
				e.keyCode=0;
				event.returnValue=false;
				return false;
			}
		}
	}catch(e){
	
	}	

}

</script>

</html>
<form name="form2" action="categorias.php" method="get" target="principal"></form>