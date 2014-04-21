<?php 
session_start();
include('conex_inicial.php');


if(isset($_POST['accion'])){
//echo "entro";
 $accion=$_POST['accion'];

				$codigo=$_REQUEST['codigo'];
				$usuario=$_REQUEST['usuario'];
				$password=$_REQUEST['password'];
				$caja=$_REQUEST['caja'];
				$nivel=$_REQUEST['nivel'];
				$estado=$_REQUEST['estado'];
				$busqueda=$_REQUEST['busqueda'];
				$fecha=date('d-m-Y');
				$agenda=$_REQUEST['agenda'];				
				$nombres=$_REQUEST['nombres'];
  				$email=$_REQUEST['email'];
				$telefono1=$_REQUEST['telefono1'];
				$acceso=$_REQUEST['acceso'];
				$dni=$_REQUEST['dni'];
				
	 if($accion=='n'){
								
			//----------------------------iamgenes-----------------------------
			
			if($acceso=='')$acceso='N';
							
				$strSQL2= "insert into usuarios (codigo,usuario,password,caja,nivel,f_creacion,busqueda,agenda,nombres,email,telefono1,acceso,dni) values ('".$codigo."','".$usuario."','".$password."','".$caja."','".$nivel."','".$fecha."','".$busqueda."','".$agenda."','".$nombres."','".$email."','".$telefono1."','".$acceso."','".$dni."')";
				
				//echo $strSQL2;
				mysql_query($strSQL2);
				unset($accion);
				//header("location: lista_usuarios.php");		
							
			
	}

	if($accion=='e'){
	
$strSQL="update usuarios set usuario='".$usuario."',password='".$password."',caja='".$caja."',nivel='".$nivel."',estado='".$estado."',busqueda='".$busqueda."',agenda='".$agenda."',nombres='".$nombres."',email='".$email."',telefono1='".$telefono1."',acceso='".$acceso."',dni='".$dni."' where codigo='".$codigo."'";

//echo $strSQL;

mysql_query($strSQL);
}
}


if(isset($_REQUEST['codacceso'])){

	if ($_REQUEST['accesoU']=='S'){
		$strSQL="update usuarios set acceso='N' where codigo='" . $_REQUEST['codacceso'] . "'";
		mysql_query($strSQL);
	}else{
		$strSQL="update usuarios set acceso='S' where codigo='" . $_REQUEST['codacceso'] . "'";
		mysql_query($strSQL);
	}	
	//alert('Usuario eliminado');
	/*echo "<script>location.href='lista_usuarios.php'</script>";*/

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
<script type="text/javascript" src="javascript/mover_div.js"></script>

<script>

var scrollDivs=new Array();
scrollDivs[0]="sucursal";

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

cargar_combos('estado_temp','estado');
cargar_combos('nivel_temp','nivel');
cargar_combos('acceso_temp','acceso');

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
doAjax('new_usuario.php','accion=n','nuevo_suc','get','0','1','','');
		
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

body {
	background-image: url(imagenes/bg3.jpg);
}

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
.Estilo16 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo17 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #FFFFFF; }
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




<body bgcolor="#FFFFFF">
<form name="form1" method="post" action="lista_usuarios.php">
  <table width="100%" border="0">
    <tr style="background:url(imagenes/white-top-bottom.gif)">
      <td height="27" colspan="13" style="border:#999999">&nbsp;<span class="Estilo34">Administraci&oacute;n :: Personal :: Usuarios </span></td>
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
                <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="javascript: doAjax('new_usuario.php','accion=n','nuevo_suc','get','0','1','','');" >
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
      <td><table width="765" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC" >
        <tr>
          <td colspan="12">&nbsp;</td>
        </tr>

        <tr>
          <td colspan="12">&nbsp;</td>
        </tr>
        <tr height="20px" style="background:url(imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
          <td width="49" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">C&oacute;digo</td>
          <td width="44" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Estado</td>
          <td width="83" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Nombres</td>
          <td width="60" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Email</td>
          <td width="75" align="center" class="EstiloTexto1" style=" border:#CCCCCC solid 1px">Usuario</td>
          <td width="86" class="EstiloTexto1" style=" border:#CCCCCC solid 1px">Contrase&ntilde;a</td>
          <td width="61" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Nivel</td>
          <td width="71" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">B&uacute;squeda</td>
          <td width="62" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1"><span class="EstiloTexto1" style=" border:#CCCCCC solid 1px">Agenda</span></td>
          <td width="62" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1"><span class="EstiloTexto1" style=" border:#CCCCCC solid 1px">Acceso</span></td>
          <td colspan="2" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Acciones</td>
        </tr>
        <?php  
	
	//----------eliminando------------------------
	
	if(isset($_REQUEST['cod'])){
	//echo "codigo eliminado".$_REQUEST['cod'];
	$tdoc=mysql_num_rows(mysql_query("select  * from cab_mov where cod_vendedor='" . $_REQUEST['cod'] . "'"));
	if($tdoc==0){
		$strSQL="delete from usuarios where codigo='" . $_REQUEST['cod'] . "'";
	mysql_query($strSQL);
	echo "<script>alert('Usuario eliminado');location.href='lista_usuarios.php'</script>";
	}else{
	 echo "<script>alert('Este usuario no se puede eliminar tiene documentos relacionados');location.href='lista_usuarios.php'</script>";
	}

	}
	
	//-------------------------------------------
	
	
	if($_SESSION['nivel_usu']==5){
  		$resultados = mysql_query("select * from usuarios order by usuario,codigo ",$cn);
  	}else{
  		$resultados = mysql_query("select * from usuarios where nivel!='5' order by usuario,codigo ",$cn);
  	}
  
			 // echo "resultado".$resultado;
			  
while($row=mysql_fetch_array($resultados))
{
 ?>
        <tr  bgcolor="#EEEEEE" onMouseOver="entrada(this)" onMouseOut="salida(this)">
          <td align="center" bgcolor="#F9F9F9"><span class="Estilo12"><?php echo $row['codigo'];?></span></td>
          <td align="center" bgcolor="#F9F9F9"><?php 
	  if($row['estado']=='C'){
	  echo "<img src='imagenes/conectado.gif' width='21' height='23'>";
	  }else{
	  echo "<img src='imagenes/noconectado.gif' width='21' height='23'>";
	  }
	  	  
	  ?>          </td>
          <td align="left" bgcolor="#F9F9F9"><span class="Estilo12"><?php if(isset($row['nombres'])){ echo $row['nombres'];}?></span></td>
          <td align="center" bgcolor="#F9F9F9"><span class="Estilo12"><?php echo $row['email'];?></span></td>
          <td bgcolor="#F9F9F9"><span class="Estilo12"><?php echo $row['usuario'];?>&nbsp;</span></td>
          <td bgcolor="#F9F9F9"><span class="Estilo12"><?php echo $row['password'];?></span></td>
          <td align="center" bgcolor="#F9F9F9"><span class="Estilo12"><?php echo $row['nivel'];?></span></td>
          <td align="center" bgcolor="#F9F9F9"><?php echo $row['busqueda'] ?></td>
          <td align="center" bgcolor="#F9F9F9"><?php echo $row['agenda'] ?></td>
          <td align="center" bgcolor="#F9F9F9"><a href="javascript:acceso('<?php echo $row['codigo']?>','<?php echo $row['acceso']?>');"><?php 		 
		if($row['acceso']=='S'){
	  		echo "<img border='0' src='imagenes/revisado.png' width='21' height='23'>";	  		
	  	}else{
			echo "<img border='0' src='imagenes/porrevisar.png' width='21' height='23'>";
	  	}	   
		  //echo $row['acceso'] ?></a></td>
          <td width="31" align="center" bgcolor="#F9F9F9"><span class="Estilo13"><span class="Estilo12">&nbsp;<a href="javascript:editar('<?php echo $row['codigo']?>');"><img src='imgenes/ico_edit.gif' border='0'></a></span></span></td>
          <td width="54" align="center" bgcolor="#F9F9F9" style="visibility:hidden"><span class="Estilo13"><span class="Estilo12"><a href="javascript:eliminar('<?php echo $row['codigo']?>');"><img src="imgenes/eliminar.gif" border="0"></a></span></span></td>
        </tr>
        <?php    
  }
  mysql_free_result($resultados);
  
  ?>
        <tr>
          <td height="56" colspan="12">&nbsp;</td>
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
doAjax('new_usuario.php','accion=e&cod='+cod,'nuevo_suc','get','0','1','','');
}


function eliminar(cod){
	if(confirm('Esta seguro que desea eliminar este Usuario?')){
	location.href='lista_usuarios.php?cod='+cod;
	//this.form1.submit();
	}
//window.open('editar_producto.php?cod='+cod,'ventana','height=470 width=500');
}
function acceso(cod,accesoU){
<? if ($_SESSION['nivel_usu']==5  || $_SESSION['usertemporizador']=='S' ){ ?>
	txt='desabilitar'
	if (accesoU!='S'){
		txt='habilitar';
	}
	if(confirm('Esta seguro que desea '+ txt +' Usuario?')){
		location.href='lista_usuarios.php?codacceso='+cod+'&accesoU='+accesoU;
	}
<? } ?>
}


function cargar_combos(temp,combo){

 	 var valor1=eval("document.form1."+temp+".value");
	// alert(valor1);
     var i;
     for (i=0;i< eval("document.form1."+combo+".options.length");i++)
        {
            if ( eval("document.form1."+combo+".options[i].value==valor1") )
               {
               eval("document.form1."+combo+".options[i].selected=true");
               }
        
        }

}


//setInterval("actualizar()", 1*30*1000);

function actualizar(){

//document.form1.submit();

}

</script>
</html>
