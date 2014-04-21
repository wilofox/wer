<?php 
session_start();
include('conex_inicial.php');

if(isset($_REQUEST['cod'])){
	
	$strSQL_cla="select * from producto where subcategoria='".$_REQUEST['cod']."' ";
	$resultado_cla=mysql_query($strSQL_cla,$cn);
	$cont=mysql_num_rows($resultado_cla);
	
		if($cont==0){
		$strSQL="delete from subcategoria where idsubcategoria='" . $_REQUEST['cod'] . "'";
		mysql_query($strSQL,$cn);
		}else{
		echo "<script>alert('Esta subcategoria tiene productos relacionados...')</script>";
	//	header("location: clasificacion.php");
		
		}
		
	}



?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>administradores</title>
<link href="styles.css" rel="stylesheet" type="text/css">
<script src="jquery-1.2.6.js"></script>
<script src="jquery.hotkeys.js"></script>
<script>
function entrada(objeto){
//document.getElementById('prueba').value=objeto.style.background;
//alert(objeto.style.background);
objeto.style.background='#FFF1BB';
//document.getElementById('prueba').value=objeto.style.background;
//est=0;
}

function salida(objeto){
//document.getElementById('prueba').value=objeto.style.background;
//alert(objeto.style.background);
objeto.style.background='#EEEEEE';
//document.getElementById('prueba').value=objeto.style.background;
//est=0;
}

function recargar(){
document.form1.submit();
//alert();
//location.href="lista_productos.php";
}
jQuery(document).bind('keydown', 'f3',function (evt){//jQuery('#_esc').addClass('dirty'); 
evt.keyCode=0;
	evt.returnValue=false;
	//alert("m");

editar('','grabar');
		
return false; });
</script>

<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #990000;
	font-weight: bold;
}
.Estilo12 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo13 {font-size: 11px}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #F3F3F3;
}
.Estilo15 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #FFFFFF; }
.Estilo16 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo112 {color: #000000};
.Estilo112 {color: #000000};
.Estilo113 {color: #CC3300;
	font-weight: bold;
	font-size: 10px;
	font-family: Arial, Helvetica, sans-serif;
}
.Estilo113 {color: #CC3300;
	font-weight: bold;
	font-size: 10px;
	font-family: Arial, Helvetica, sans-serif;
}
.Estilo34 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
.EstiloTexto1 { font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#000000; font:bold;
}
.EstiloTexto1{
 font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#000000; font:bold;
}
.Estilo34 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
-->
</style>
</head>


<?php 

?>


<body>
<form name="form1" method="post" action="subcategorias.php">
  <table width="100%" border="0">
    <tr style="background:url(imagenes/white-top-bottom.gif)">
      <td height="27" colspan="13" style="border:#999999">&nbsp;<span class="Estilo34">Administraci&oacute;n :: Art&iacute;culos :: <span class="Estilo14 Estilo38">Subcategor&iacute;as </span></span></td>
    </tr>
    <tr style="background:url(imagenes/botones.gif)">
      <td colspan="7"><table width="98%" height="21" border="0" cellpadding="0" cellspacing="0" style="border-bottom:#CCCCCC solid 1px">
          <tr>
            <td width="15" ><script>
		  function entrar_btn(obj){
		  obj.cells[0].style.backgroundImage="url(imagenes/bordes_boton1.gif)";
		  obj.cells[1].style.backgroundImage="url(imagenes/bordes_boton2.gif)";
		  obj.cells[2].style.backgroundImage="url(imagenes/bordes_boton2.gif)";
		  //obj.cells[3].style.backgroundImage="url(../imagenes/bordes_boton3.gif)";
		  
		  }
		  function salir_btn(obj){
		  obj.cells[0].style.backgroundImage="";
		  obj.cells[1].style.backgroundImage="";
		  obj.cells[2].style.backgroundImage="";
		  //obj.cells[3].style.backgroundImage="";
		  
		  }
		  
		  
		  
		    </script>
            </td>
            <td width="215" ><table title="Nuevo[F3]" width="85" height="21" border="0" cellpadding="0" cellspacing="0">
                <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="javascript:editar('','grabar')">
                  <td width="1" ></td>
                  <td width="15" align="center" ><span class="Estilo112"><img src="imagenes/nuevo.gif" width="14" height="16"></span></td>
                  <td width="68" ><span class="Estilo112">Nuevo<span class="Estilo113">[F3]</span> </span></td>
                </tr>
            </table></td>
            <td width="111">&nbsp;</td>
            <td width="76">&nbsp;</td>
            <td width="77">&nbsp;</td>
            <td width="69">&nbsp;</td>
            <td width="70">&nbsp;</td>
            <td width="197">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td align="center"><table width="655" border="0" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC" >
        <tr>
          <td colspan="6">&nbsp;</td>
        </tr>
        <tr height="20px" style="background:url(imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
         
          <td width="114" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">C&oacute;digo</td>
          <td width="367" align="center" class="EstiloTexto1" style=" border:#CCCCCC solid 1px">Descripci&oacute;n</td>
          <td width="106" align="center" class="EstiloTexto1" style=" border:#CCCCCC solid 1px">Categor&iacute;a</td>
          <td colspan="2" align="center" class="EstiloTexto1" style=" border:#CCCCCC solid 1px">Acciones</td>
        </tr>
        <?php  
	
	//----------eliminando------------------------
	
	//-------------------------------------------
	
  $resultados = mysql_query("select * from subcategoria order by idsubcategoria ",$cn);
			 // echo "resultado".$resultado;
			  
while($row=mysql_fetch_array($resultados))
{
 ?>
        <tr bgcolor="#FFFFFF">

          <td align="center"><span class="Estilo12"><?php echo $row['idsubcategoria'];?></span></td>
          <td><span class="Estilo12"><?php echo $row['des_subcateg'];?>&nbsp;</span></td>
          <td align="left"><span class="Estilo12"><?php echo $row['categoria'];?></span></td>
          <td width="29" align="center" bgcolor="#FFFFFF"><span class="Estilo13"><span class="Estilo12">&nbsp;<a href="javascript:editar('<?php echo $row['idsubcategoria']?>','actualizar');"><img src="imgenes/ico_edit.gif" border="0"></a></span></span></td>
          <td width="23" align="center" bgcolor="#FFFFFF"><span class="Estilo13"><span class="Estilo12"><a href="javascript:eliminar('<?php echo $row['idsubcategoria']?>');"><img src="imgenes/eliminar.gif" border="0"></a></span></span></td>
        </tr>
        <?php  
  
  }
  mysql_free_result($resultados);
  
  ?>
        <tr>
          <td height="56" colspan="6"><span class="Estilo16"></span></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
</body>
<script>

function editar(cod,accion){
window.open('editar_subcategorias.php?cod='+cod+'&accion='+accion,'ventana','height=280, width=400, top=200, left=250');
}

function eliminar(cod){
	if(confirm('Esta seguro que desea eliminar este producto?')){
	location.href='subcategorias.php?cod='+cod;
	//this.form1.submit();
	}
//window.open('editar_producto.php?cod='+cod,'ventana','height=470 width=500');
}


</script>
</html>
