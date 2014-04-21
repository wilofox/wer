<?php 
session_start();
include('conex_inicial.php');


		
		

if(isset($_POST['accion'])){
//echo "entro";
 $accion=$_POST['accion'];

				$codigo=$_REQUEST['codigo'];
				$des_suc=$_REQUEST['des_suc'];
				$ruc=$_REQUEST['ruc'];
				$telefono=$_REQUEST['telefono'];
				$web=$_REQUEST['web'];
				$email=$_REQUEST['email'];
				
				
				$percepcion='N';
				if($_REQUEST['chk_percep']!=''){
				$percepcion='S';
				}
				
				
		
		$fileName = $_FILES['userfile']['name'];
		$tmpName  = $_FILES['userfile']['tmp_name'];			
		$nombre_archivo = "imagenes/".$_FILES['userfile']['name'];		
				
	 if($accion=='n'){
			
						
			//----------------------------iamgenes-----------------------------
			
			//--------------------------------------------------------------------------	
			
				if(move_uploaded_file($tmpName,$nombre_archivo))
				{
				$imagen1="imagenes/".$_FILES['userfile']['name'];
				}
			
				$strSQL2= "insert into sucursal (cod_suc,des_suc,ruc,telefono,percepcion,web,email,logo) values ('".$codigo."','".$des_suc."','".$ruc."','".$telefono."','".$percepcion."','".$web."','".$email."','".$imagen1."')";
				
				mysql_query($strSQL2);
			unset($accion);
				header("location: lista_sucursal.php");
		
			
	}

	if($accion=='e'){
	
		if(move_uploaded_file($tmpName,$nombre_archivo))
		{
		$imagen1="imagenes/".$_FILES['userfile']['name'];
		$strSQL="update sucursal set logo='" . $imagen1 . "' where cod_suc='" . $codigo  . "'";
		//echo $strSQL;
		mysql_query($strSQL);
		}
	
	$strSQL="update sucursal set des_suc='".$des_suc."',ruc='".$ruc."',telefono='".$telefono."',percepcion='".$percepcion."',web='".$web."',email='".$email."' where cod_suc='".$codigo."'";
	//echo $strSQL;
	mysql_query($strSQL);
	}
}

?>
<script language="javascript" src="miAJAXlib2.js"></script>
<script type="text/javascript" src="javascript/mover_div.js"></script>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>administradores</title>
<link href="styles.css" rel="stylesheet" type="text/css">
<script>


var scrollDivs=new Array();
scrollDivs[0]="sucursal";
//scrollDivs[1]="div2";


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
}

function nuevo_suc(texto){

//alert(texto);
var r = texto;
document.getElementById('sucursal').innerHTML=r;
document.getElementById('sucursal').style.visibility='visible';
//alert('entro');
//document.form1.txtnombre.focus();
}

function ocultar(){
document.getElementById('sucursal').style.visibility='hidden';
}

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
.Estilo34 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
.EstiloTexto1{
 font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#000000; font:bold;
}
-->
</style>
</head>


<?php 

?>


<body>

<form name="form1" id="form1" method="post" action="" enctype="multipart/form-data">
  <table width="100%" border="0">
    <tr style="background:url(imagenes/white-top-bottom.gif)">
       <td height="27" colspan="13" style="border:#999999">&nbsp;<span class="Estilo34">Administraci&oacute;n :: Empresas</span></td>
    </tr>
  <tr>
    <td><table width="602" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC" >
      <tr>
        <td colspan="8">&nbsp;</td>
      </tr>

      <tr height="20px" style="background:url(imagenes/sky_blue_grid.gif); border:#999999 solid 1px">

        <td width="74" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">C&oacute;digo</td>
        <td width="157" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Nombre</td>
        <td width="79" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Ruc</td>
        <td width="138" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Tel&eacute;fono</td>
        <td width="138" style=" border:#CCCCCC solid 1px" class="EstiloTexto1"><span class="EstiloTexto1" style=" border:#CCCCCC solid 1px">logo</span></td>
        <td colspan="2" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Acciones</td>
      </tr>
      <?php  
	
	//----------eliminando------------------------
	
	if(isset($_REQUEST['cod'])){
	//echo "codigo eliminado".$_REQUEST['cod'];
	
	$strSQL="delete from sucursal where cod_suc='" . $_REQUEST['cod'] . "'";
	mysql_query($strSQL);
	}
	
	//-------------------------------------------
	
  $resultados = mysql_query("select * from sucursal where estado='S' order by cod_suc ",$cn);
			 // echo "resultado".$resultado;
			  
while($row=mysql_fetch_array($resultados))
{
 ?>
      <tr  bgcolor='#FFFFFF'>

        <td align="center"><span class="Estilo12"><?php echo $row['cod_suc'];?></span></td>
        <td><span class="Estilo12"><?php echo $row['des_suc'];?>&nbsp;</span></td>
        <td><span class="Estilo12"><?php echo $row['ruc'];?></span></td>
        <td><span class="Estilo12"><?php echo $row['telefono'];?></span></td>
        <td><span class="Estilo12"><?php echo $row['logo'];?></span></td>
        <td width="62" align="center"><span class="Estilo13"><span class="Estilo12">&nbsp;<a href="javascript:editar('<?php echo $row['cod_suc']?>');"><img src='imgenes/ico_edit.gif' border='0'></a></span></span></td>
        <td width="63"><span class="Estilo13"  style="display:none"><span class="Estilo12"><a href="javascript:eliminar('<?php echo $row['cod_suc']?>');">Eliminar</a></span></span></td>
      </tr>
      <?php  
  
  }
  mysql_free_result($resultados);
  
  ?>
      <tr>
        <td height="56" colspan="8">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
  <div id="sucursal" style="position:absolute; left:198px; top:100px; width:350px; height:180px; z-index:1; visibility:hidden"> </div>

  
</form>
</body>
<script>

function editar(cod){
if(confirm('Esta seguro de modificar puede que tenga documentos relacionados')){
doAjax('new_sucursal.php','accion=e&cod='+cod,'nuevo_suc','get','0','1','','');
}
}

function eliminar(cod){
	if(confirm('Esta seguro que desea eliminar este producto?')){
	location.href='lista_sucursal.php?cod='+cod;
	//this.form1.submit();
	}
//window.open('editar_producto.php?cod='+cod,'ventana','height=470 width=500');
}


</script>
</html>
