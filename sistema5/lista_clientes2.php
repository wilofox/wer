<?php 
session_start();
include('conex_inicial.php');

//echo $_POST['ac'];

if(isset($_POST['accion'])){
//echo "entro";
 $accion=$_POST['accion'];
 
 if($accion=='nuevo'){
		$codcliente=$_POST['ccodcliente'];
		$nombre=$_POST['cnombre'];
		$precio=$_POST['cprecio'];
		$modelo=$_POST['cmodelo'];
		$fabricante=$_POST['cfabricante'];
		$cantidad=$_POST['ccantidad'];
		$descripcion=$_POST['cdescripcion'];
		$categoria=$_POST['ccategoria'];
		//----------------------------iamgenes-----------------------------
		$fileName = $_FILES['userfile']['name'];
		$tmpName  = $_FILES['userfile']['tmp_name'];
		
		$fileName2 = $_FILES['userfile2']['name'];
		$tmpName2  = $_FILES['userfile2']['tmp_name'];
		
		$nombre_archivo = "../imagenes/".$_FILES['userfile']['name'];
		$nombre_archivo2 = "../imagenes/".$_FILES['userfile2']['name'];
		
		
			if(move_uploaded_file($tmpName,$nombre_archivo))
			{
			$imagen1="imagenes/".$_FILES['userfile']['name'];
		//	$strSQL="update producto set imagen='" . $imagen1 . "' where codigo='" . $cod  . "'";
		//  mysql_query($strSQL);
			}
		
			if(move_uploaded_file($tmpName2,$nombre_archivo2))
			{
			$imagen2="imagenes/".$_FILES['userfile2']['name'];
		//  $strSQL="update producto set imagen2='" . $imagen2 . "' where codigo='" . $cod  . "'";
		//	mysql_query($strSQL);
			}
		//--------------------------------------------------------------------------	
			$resultado3=mysql_query("select max(codigo) as codigo from producto",$cn);
			$row3=mysql_fetch_array($resultado3);
			
			$var=substr($row3['codigo'],1,3);
			$var=$var+1;
			
			$codigo=str_pad($var, 3, "0", STR_PAD_LEFT);  
			$codigo="P".$codigo;
			
			$strSQL2= "insert into producto (codigo,nombre,precio,modelo,fabricante,cantidad,imagen,imagen2,descripcion,categoria) values ('".$codigo."','".$nombre."','".$precio."','".$modelo."','".$fabricante."','".$cantidad."','".$imagen1."','".$imagen2."','".$descripcion."','".$categoria."')";
			
		//	$strSQL2="update producto set nombre='" . $nombre . "',precio='" . $precio . "',modelo='" . $modelo . "',fabricante='" . $fabricante . "',cantidad='" . $cantidad . "',descripcion='" . $descripcion . "' where codigo='" . $cod . "'";
			//echo $strSQL2;
			mysql_query($strSQL2);
			unset($accion);
			header("location: lista_productos.php");
	
		
}


}


if(isset($_POST['codregistro'])){

//echo $_POST['codregistro']." ".$_POST['ccodcliente'];

$strSQL2="update clientes set  codcliente='" . $_POST['ccodcliente'] . "' where cod_registro='" . $_POST['codregistro'] . "'";
//echo $strSQL2;
mysql_query($strSQL2);
}


?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>administradores</title>

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
}
.Estilo15 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #FFFFFF; }
.Estilo16 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo17 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
}
-->
</style>
</head>


<?php 

?>


<body bgcolor="#FFFFFF">
<form name="form1" method="post" action="lista_clientes.php">
  <table width="1479" border="0" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC" >
    <tr>
      <td colspan="18">&nbsp;</td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td colspan="2" ><span class="Estilo1">Lista de Clientes </span></td>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td colspan="6" >&nbsp;</td>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td colspan="18" height="5"></td>
    </tr>
    <tr>
      <td colspan="18"><span class="Estilo17">&nbsp;Criterio Busqueda:
          <label for="select"></label>
          <select name="select" id="select">
            <option value="nombres">Nombres</option>
            <option value="empresa">Razon Social</option>
            <option value="ruc">Ruc</option>
          </select>
Valor
<label for="textfield"></label>
<input name="valor" type="text" id="valor" size="15">
<label for="Submit"></label>
<input type="submit" name="buscar" value="Buscar" id="buscar">
      </span></td>
    </tr>
    <tr>
      <td colspan="18" height="10"></td>
    </tr>
    <tr bordercolor="#CCCCCC">
      <td width="3">&nbsp;</td>
      <td width="49" bgcolor="#0073AA"><span class="Estilo15">Codigo</span></td>
      <td width="70" bgcolor="#0073AA"><span class="Estilo15">Nombres</span></td>
      <td width="78" bgcolor="#0073AA"><span class="Estilo15">A. Paterno </span></td>
      <td width="79" bgcolor="#0073AA"><span class="Estilo15">A. Materno </span></td>
      <td width="33" bgcolor="#0073AA"><span class="Estilo15">Sexo</span></td>
      <td width="101" align="center" bgcolor="#0073AA"><span class="Estilo15">Email</span></td>
      <td width="76" align="center" bgcolor="#0073AA"><span class="Estilo15">Contrase&ntilde;a</span></td>
      <td width="57" bgcolor="#0073AA"><span class="Estilo15">Telefono</span></td>
      <td width="85" bgcolor="#0073AA"><span class="Estilo15">Nextel_Rpm</span></td>
      <td width="150" align="center" bgcolor="#0073AA"><span class="Estilo15">Fecha de Inscripcion </span></td>
      <td width="140" align="center" bgcolor="#0073AA"><span class="Estilo15">Codigo Sistema </span></td>
      <td width="120" align="center" bgcolor="#0073AA"><span class="Estilo15">Razon social</span></td>
      <td width="108" align="center" bgcolor="#0073AA"><span class="Estilo15">Ruc</span></td>
      <td width="79" align="center" bgcolor="#0073AA"><span class="Estilo15">Cargo</span></td>
      <td width="99" align="center" bgcolor="#0073AA"><span class="Estilo15">Direcci&oacute;n</span></td>
      <td colspan="2" bgcolor="#0073AA"><span class="Estilo15">Acciones</span></td>
    </tr>
    <?php  
	
	//----------eliminando------------------------
	
	if(isset($_REQUEST['cod'])){
	//echo "codigo eliminado".$_REQUEST['cod'];
	
	$strSQL="delete from clientes where cod_registro='" . $_REQUEST['cod'] . "'";
	//echo "delete from clientes where cod_registro='" . $_REQUEST['cod'] . "'";
	mysql_query($strSQL);
	}
	
	//-------------------------------------------
	
	if(isset($_POST['buscar']) && $valor=$_POST['valor']!=""){
	
	$criterio=$_POST['select'];
	$valor=$_POST['valor'];
	
	
	$filtro="where $criterio='$valor'";
	
	}else{
	$filtro="";
	}
	
  $resultados = mysql_query("select * from clientes " . $filtro . " order by cod_registro desc ",$cn);
			 // echo "resultado".$resultado;
			 
			 
			  
while($row=mysql_fetch_array($resultados))
{
 ?>
    <tr  bgcolor="#EEEEEE" onMouseOver="entrada(this)" onMouseOut="salida(this)">
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td align="center"><span class="Estilo12"><?php echo $row['cod_registro'];?></span></td>
      <td><span class="Estilo12"><?php echo $row['nombres'];?>&nbsp;</span></td>
      <td align="left" ><span class="Estilo12"><?php echo $row['a_paterno'];?>&nbsp;</span></td>
      <td><span class="Estilo12"><?php echo $row['a_materno'];?>&nbsp;</span></td>
      <td><span class="Estilo12"><?php echo $row['sexo'];?>&nbsp;</span></td>
      <td align="left"><span class="Estilo12"><?php echo $row['mail'];?>&nbsp;</span></td>
      <td><span class="Estilo12"><?php echo $row['codigo'];?></span></td>
      <td><span class="Estilo12"><?php echo $row['telefono'];?>&nbsp;</span></td>
      <td><span class="Estilo12"><?php echo $row['nextel_rpm'];?>&nbsp;</span></td>
      <td><span class="Estilo12">&nbsp;<?php echo substr($row['f_inscripcion'], 0,20);?></span></td>
      <td><span class="Estilo12"><?php echo substr($row['codcliente'], 0,20);?></span></td>
      <td><span class="Estilo12"><?php echo substr($row['empresa'], 0,20);?></span></td>
      <td><span class="Estilo12"><?php echo substr($row['ruc'], 0,20);?></span></td>
      <td><span class="Estilo12"><?php echo substr($row['razonsocial'], 0,20);?></span></td>
      <td><span class="Estilo12"><?php echo substr($row['direccion'], 0,20);?></span></td>
      <td width="43"><span class="Estilo13"><span class="Estilo12">&nbsp;<a href="javascript:editar('<?php echo $row['cod_registro']?>');">Editar</a></span></span></td>
      <td width="54"><span class="Estilo13"><span class="Estilo12"><a href="javascript:eliminar('<?php echo $row['cod_registro']?>');">Eliminar</a></span></span></td>
    </tr>
    <?php  
  
  }
  mysql_free_result($resultados);
  
  ?>
    <tr>
      <td height="56" colspan="18"><span class="Estilo16"><a href="nuevo_cliente.php">Nuevo Cliente </a></span></td>
    </tr>
  </table>
</form>
</body>
<script>

function editar(cod){
window.open('nuevo_cliente.php?cod='+cod,'ventana','height=300 width=640');
}

function eliminar(cod){
	if(confirm('Esta seguro que desea eliminar este producto?')){
	location.href='lista_clientes.php?cod='+cod;
	//this.form1.submit();
	}
//window.open('editar_producto.php?cod='+cod,'ventana','height=470 width=500');
}

function recargar(){
document.form1.submit();
}


</script>
</html>
