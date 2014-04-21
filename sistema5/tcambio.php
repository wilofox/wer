<?php 
session_start();
include('conex_inicial.php');


$strSQl0="select id,venta from tcambio order by id desc limit 1";
//echo $strSQl0;
$resultado0=mysql_query($strSQl0,$cn);
$row0=mysql_fetch_array($resultado0);
$strSQL00="insert into tcambio (fecha,venta) values ('".$fecha."','".$row0['venta']."')";
mysql_query($strSQL00,$cn);

//echo $strSQL00;
if(isset($_POST['accion'])){
//echo "entro";
 $accion=$_POST['accion'];

				$codigo=$_REQUEST['codigo'];
				$des_suc=$_REQUEST['des_suc'];
				$ruc=$_REQUEST['ruc'];
				$compra=$_REQUEST['compra'];
				$promedio=$_REQUEST['promedio'];
			
	 if($accion=='n'){
			
						
			//----------------------------iamgenes-----------------------------
			
			//--------------------------------------------------------------------------	
			
				
				$strSQL2= "insert into tcambio (fecha,venta,compra,promedio) values ('".$des_suc."','".$ruc."','".$compra."','".$promedio."')";
				
				mysql_query($strSQL2);
			unset($accion);
				header("location: tcambio.php");
		
			
	}

	if($accion=='e'){
	
$strSQL="update tcambio set fecha='".$des_suc."',venta='".$ruc."',compra='".$compra."',promedio='".$promedio."' where id='".$codigo."'";
//echo $strSQL;

mysql_query($strSQL);
}
}

?>
<script language="javascript" src="miAJAXlib2.js"></script>


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
objeto.style.background='#F5F5F5';
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

function graba(){
document.form1.submit();
}
jQuery(document).bind('keydown', 'f2',function (evt){
 event.keyCode=0;
	event.returnValue=false;

graba();
 
  return false; });
  
jQuery(document).bind('keydown', 'f3',function (evt){//jQuery('#_esc').addClass('dirty'); 
event.keyCode=0;
	event.returnValue=false;
//	alert("m");
doAjax('new_cambio.php','accion=n','nuevo_suc','get','0','1','','');
		
return false; });
jQuery(document).bind('keydown', 'esc',function (evt){

//jQuery('#_esc').addClass('dirty'); 
ocultar();
event.keyCode=0;
	event.returnValue=false;		
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

<link href="styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-image: url(imagenes/bg3.jpg);
}
-->
</style>

<body bgcolor="#FFFFFF">
<form name="form1" method="post" action="tcambio.php">
  <table width="100%" border="0">
    <tr style="background:url(imagenes/white-top-bottom.gif)">
       <td height="27" colspan="13" style="border:#999999">&nbsp;<span class="Estilo34">Administraci&oacute;n :: &Uacute;tiles :: Tipo de Cambio</span></td>
    </tr>
    <tr>
      <td><table width="99%" height="21" border="0" cellpadding="0" cellspacing="0" style="border-bottom:#CCCCCC solid 1px">
        <tr>
          <td width="80" ><script>
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
              <table title="Grabar [F2]" width="99" height="21" border="0" cellpadding="0" cellspacing="0">
                <tr  onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer;" onClick="graba()">
                  <td width="1" ></td>
                  <td width="15" ><span class="Estilo112"><img src="imgenes/revert.png" width="14" height="16"></span></td>
                  <td width="83" ><span class="Estilo112">Grabar<span class="Estilo113">[F2]</span></span></td>
                </tr>
            </table></td>
          <td width="76" ><table title="Nuevo[F3]" width="94" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="javascript: doAjax('new_cambio.php','accion=n','nuevo_suc','get','0','1','','');" >
                <td width="1" ></td>
                <td width="15" align="center" ><span class="Estilo112"><img src="imagenes/nuevo.gif" width="14" height="16"></span></td>
                <td width="78" ><span class="Estilo112">Nuevo<span class="Estilo113">[F3]</span> </span></td>
              </tr>
          </table></td>
          <td width="79"><table  title="Salir [Esc]"width="89" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="ocultar()" >
                <td width="1" ></td>
                <td width="16" ><img src="imagenes/salir.JPG"  width="16" height="16" border="0"></td>
                <td width="63" ><span class="Estilo112">Salir<span class="Estilo113">[Esc]</span></span></td>
                <td width="9" ></td>
              </tr>
          </table></td>
          <td width="56">&nbsp;</td>
          <td width="57">&nbsp;</td>
          <td width="51">&nbsp;</td>
          <td width="52">&nbsp;</td>
          <td width="141">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td><table width="570" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC" >
        <tr>
          <td colspan="5">&nbsp;</td>
        </tr>

        <tr>
          <td colspan="5">&nbsp;</td>
        </tr>
        <tr height="20px" style="background:url(imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
          <td width="52" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">id</td>
          <td width="75" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Fecha</td>
          <td width="99" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Venta</td>
          <td width="105" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Compra</td>
          <td width="110" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Promedio</td>
          <td colspan="2" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Acciones</td>
        </tr>
        <?php  
	
	//----------eliminando------------------------
	
	if(isset($_REQUEST['cod'])){
	//echo "codigo eliminado".$_REQUEST['cod'];
	
	$strSQL="delete from tcambio where id='" . $_REQUEST['cod'] . "'";
	mysql_query($strSQL);
	}
	
	//-------------------------------------------
	
  $resultados = mysql_query("select * from tcambio order by mid(fecha,7,4) desc,mid(fecha,4,2) desc,mid(fecha,1,2) desc",$cn);
			 // echo "resultado".$resultado;
			  
while($row=mysql_fetch_array($resultados))
{
 ?>
        <tr  bgcolor="#F5F5F5" onMouseOver="entrada(this)" onMouseOut="salida(this)">
          <td align="center" bgcolor="#FCFCFC"><span class="Estilo12"><?php echo $row['id'];?></span></td>
          <td align="center" bgcolor="#FCFCFC"><span class="Estilo12"><?php echo $row['fecha'];?>&nbsp;</span></td>
          <td align="center" bgcolor="#FCFCFC"><span class="Estilo12"><?php echo $row['venta'];?></span></td>
          <td align="center" bgcolor="#FCFCFC"><span class="Estilo12"><?php echo $row['compra'];?></span></td>
          <td align="center" bgcolor="#FCFCFC"><span class="Estilo12"><?php echo $row['promedio'];?></span></td>
          <td width="58" align="center" bgcolor="#FCFCFC"><span class="Estilo13"><span class="Estilo12">&nbsp;<a href="javascript:editar('<?php echo $row['id']?>');"><img src='imgenes/ico_edit.gif' border='0'></a></span></span></td>
          <td width="49" align="center" bgcolor="#FCFCFC"><span class="Estilo13"><span class="Estilo12"><a href="javascript:eliminar('<?php echo $row['id']?>');"><img src="imgenes/eliminar.gif" border="0"></a></span></span></td>
        </tr>
        <?php  
  
  }
  mysql_free_result($resultados);
  
  ?>
        <tr>
          <td height="56" colspan="5"></td>
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
doAjax('new_cambio.php','accion=e&cod='+cod,'nuevo_suc','get','0','1','','');
}

function eliminar(cod){
	if(confirm('Esta seguro que desea eliminar este tipo de cambio?')){
	location.href='tcambio.php?cod='+cod;
	//this.form1.submit();
	}
//window.open('editar_producto.php?cod='+cod,'ventana','height=470 width=500');
}


</script>
</html>
<?php // echo $_SESSION['registro']=""?>