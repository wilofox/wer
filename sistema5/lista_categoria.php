<?php 
session_start();
include('conex_inicial.php');


if(isset($_POST['accion'])){
//echo "entro";
 $accion=$_POST['accion'];
 
 if($accion=='nuevo'){
		
		$nombre=$_POST['cnombre'];
				
		//----------------------------iamgenes-----------------------------
		
		//--------------------------------------------------------------------------	
			$resultado3=mysql_query("select max(id) as codigo from categoria",$cn);
			$row3=mysql_fetch_array($resultado3);
			
			$var=substr($row3['codigo'],1,3);
			$var=$var+1;
			
			$codigo=str_pad($var, 3, "0", STR_PAD_LEFT);  
			$codigo="C".$codigo;
			
			$strSQL2= "insert into categoria (id,nombre) values ('".$codigo."','".$nombre."')";
			
			mysql_query($strSQL2);
			unset($accion);
			header("location: lista_categoria.php");
	
		
}

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
-->
</style>
</head>


<?php 

?>


<body bgcolor="#FFFFFF">
<form name="form1" method="post" action="">
  <table width="602" border="0" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC" >
    <tr>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td colspan="2" ><span class="Estilo1">Lista de Categorias </span></td>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr bordercolor="#CCCCCC">
      <td width="13">&nbsp;</td>
      <td width="104" align="center" bgcolor="#0073AA"><span class="Estilo15">Codigo</span></td>
      <td width="307" bgcolor="#0073AA"><span class="Estilo15">Nombre</span></td>
      <td colspan="2" bgcolor="#0073AA"><span class="Estilo15">Acciones</span></td>
    </tr>
    <?php  
	
	//----------eliminando------------------------
	
	if(isset($_REQUEST['cod'])){
	//echo "codigo eliminado".$_REQUEST['cod'];
	
	$strSQL="delete from categoria where id='" . $_REQUEST['cod'] . "'";
	mysql_query($strSQL);
	}
	
	//-------------------------------------------
	
  $resultados = mysql_query("select * from categoria order by id ",$cn);
			 // echo "resultado".$resultado;
			  
while($row=mysql_fetch_array($resultados))
{
 ?>
    <tr  bgcolor="#EEEEEE" onMouseOver="entrada(this)" onMouseOut="salida(this)">
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td align="center"><span class="Estilo12"><?php echo $row['id'];?></span></td>
      <td><span class="Estilo12"><?php echo $row['nombre'];?>&nbsp;</span></td>
      <td width="87"><span class="Estilo13"><span class="Estilo12">&nbsp;<a href="javascript:editar('<?php echo $row['id']?>');">Editar</a></span></span></td>
      <td width="75"><span class="Estilo13"><span class="Estilo12"><a href="javascript:eliminar('<?php echo $row['id']?>');">Eliminar</a></span></span></td>
    </tr>
    <?php  
  
  }
  mysql_free_result($resultados);
  
  ?>
    <tr>
      <td height="56" colspan="5"><span class="Estilo16"><a href="nueva_categoria.php">Nueva Categoria </a></span></td>
    </tr>
  </table>
</form>
</body>
<script>

function editar(cod){
window.open('editar_categoria.php?cod='+cod,'ventana','height=200 width=300');
}

function eliminar(cod){
	if(confirm('Esta seguro que desea eliminar este producto?')){
	location.href='lista_categoria.php?cod='+cod;
	//this.form1.submit();
	}
//window.open('editar_producto.php?cod='+cod,'ventana','height=470 width=500');
}


</script>
</html>
