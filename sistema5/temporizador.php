<?php 
session_start();
include('conex_inicial.php');
$msg='';
if(isset($_POST['accion'])){

$accion=$_POST['accion'];

				$codigo=$_REQUEST['codigo'];
				$nivel=$_REQUEST['nivel'];
				$ht=$_REQUEST['ht'];
				$hingreso=$_REQUEST['hingreso'];
				$hsalida=$_REQUEST['hsalida'];
				
	//nivel			
	 if($accion=='nn'){
			//--------------------------------------------------------------------------	
			$strSQL2= "insert into nivel (id_nivel,descrp_nivel,id_ht) values ('".$codigo."','".$nivel."','".$ht."')";
			mysql_query($strSQL2);
			unset($accion);
			//header("location: temporizador.php");
		}

		if($accion=='en'){
			$strSQL="update nivel set descrp_nivel='".$nivel."',id_ht='".$ht."' where id_nivel='".$codigo."'";
			mysql_query($strSQL);
		}
	//horario de trabajador	
		if($accion=='nh'){
			//--------------------------------------------------------------------------	
			$strSQL2= "insert into hor_trabajador (id_ht,tipo,h_ingreso,h_salida) values ('".$codigo."','".$ht."','".$hingreso."','".$hsalida."')";
			mysql_query($strSQL2);
			unset($accion);
			//header("location: temporizador.php");
		}

		if($accion=='eh'){
			$strSQL="update hor_trabajador set tipo='".$ht."',h_ingreso='".$hingreso."',h_salida='".$hsalida."' where id_ht='".$codigo."'";
			mysql_query($strSQL);
		}
		

}
//acceso menu temporicador
	if($accion=='am'){
		//echo $codigo;
		//echo $accion;
		$strSQL="update usuarios set  temporizador=''  where temporizador<>'N' ";
		mysql_query($strSQL);
		
		$strSQL="update usuarios set  temporizador='S'  where codigo='".$codigo."'";
		mysql_query($strSQL);	
	}

//eliminar ht
$accion=$_GET['accion'];
$codigo=$_GET['cod'];
	if($accion=='dh'){
			$resultados2 = mysql_query("select * from nivel  where id_ht='".$codigo."' ",$cn);
			$row2=mysql_fetch_array($resultados2);				
			//echo $row2['id_nivel'];
			if ($row2['id_nivel']==''){
				$strSQL="delete from hor_trabajador  where id_ht='".$codigo."'";
				mysql_query($strSQL);				
			}else{
				$msg="No se pudo eliminar porque esta siendo utilizado por un nivel de personal";
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
<script type="text/javascript" src="javascript/mover_div.js"></script>

<script>

var scrollDivs=new Array();
scrollDivs[0]="sucursal";

function entrada(objeto){
objeto.style.background='#FFF1BB';
}

function salida(objeto){
objeto.style.background='#EEEEEE';
}

function recargar(){
document.form1.submit();
}

function nuevo_suc(texto){
var r = texto;
document.getElementById('sucursal').innerHTML=r;
document.getElementById('sucursal').style.visibility='visible';
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
<form name="form1" method="post" action="temporizador.php">
  <table width="100%" border="0">
    <tr style="background:url(imagenes/white-top-bottom.gif)">
      <td height="27" colspan="13" style="border:#999999">&nbsp;<span class="Estilo34">Administraci&oacute;n :: Personal :: Horario de trabajador </span></td>
    </tr>
    <tr>
      <td><table width="99%" height="21" border="0" cellpadding="0" cellspacing="0" style="border-bottom:#CCCCCC solid 1px; visibility:hidden">
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
      <td>
	  
	  
	  
	    <table width="640" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr <? if ($_SESSION['nivel_usu']!=5 ) { echo ' style="display:none" '; } ?> >
            <td width="94">Acceso al
              Men&uacute;
              :
              <select style="width:140"  name="usuario" >
                <option value=""></option>
                <?php
				// where nivel='4'  				
			  $resultados1 = mysql_query("select * from usuarios order by codigo ",$cn); 
			while($row1=mysql_fetch_array($resultados1))
			{
				if ($row1['temporizador']=='S'){
					echo '<option value="'.$row1['codigo'].'" selected>'.$row1['usuario'] .'</option>';
				}else{
					echo '<option value="'.$row1['codigo'].'">'.$row1['usuario'] .'</option>';
				}
				
				
			}?>
              </select>
              <a href="javascript:ActivarMenu('');"><img src='imgenes/check.png' alt="Activar acceso"  border='0'></a></td>
            <td width="26">&nbsp;</td>
            <td width="80">&nbsp;</td>
          </tr>
          <tr>
            <td valign="top"><table width="100%" border="0" cellpadding="1" cellspacing="1">
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="5" class="EstiloTexto1" style=" border:#CCCCCC solid 1px">&nbsp;&nbsp;-> Nivel de Personal </td>
				<td colspan="2" class="EstiloTexto1" style=" border:#CCCCCC solid 1px" align="center">
				
				
				<table title="Nuevo[F3]" width="70" height="21" border="0" cellpadding="0" cellspacing="0">
                  <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="javascript: doAjax('new_nivel.php','accion=nn','nuevo_suc','get','0','1','','');" >
                    <td width="1" ></td>
                    <td width="15" align="center" ><span class="Estilo112"><img src="imagenes/nuevo.gif" width="14" height="16"></span></td>
                    <td width="60" ><span class="Estilo112"> Nuevo</span></td>
                  </tr>
                </table>				</td>
			    </tr>
              <tr  style="background:url(imagenes/sky_blue_grid.gif); border:#999999 solid 1px" >
                <td rowspan="2" class="EstiloTexto1" style=" border:#CCCCCC solid 1px">C&oacute;digo</td>
                <td rowspan="2" class="EstiloTexto1" style=" border:#CCCCCC solid 1px">Nivel</td>
                <td rowspan="2" class="EstiloTexto1" style=" border:#CCCCCC solid 1px">Tipo Horario </td>
                <td colspan="2" class="EstiloTexto1" style=" border:#CCCCCC solid 1px" align="center">Horario</td>
                <td colspan="2" rowspan="2" class="EstiloTexto1" style=" border:#CCCCCC solid 1px" align="center">Acciones</td>
                </tr>
              <tr  style="background:url(imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
                <td style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Ingreso</td>
                <td style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Salida</td>
                </tr>
                 <?php  
  $resultados = mysql_query("select * from nivel where id_nivel<>'5' order by id_nivel ",$cn);
 // echo "resultado".$resultado;
			  
while($row=mysql_fetch_array($resultados))
{
 ?>
			  <tr  bgcolor="#EEEEEE" onMouseOver="entrada(this)" onMouseOut="salida(this)">
                <td bgcolor="#F9F9F9" align="center"><span class="Estilo12"><?php echo $row['id_nivel'];?></span></td>
                <td bgcolor="#F9F9F9"><?php echo $row['descrp_nivel'];?></td>
                <td bgcolor="#F9F9F9" align="center"><span class="Estilo12"><?php echo $row['id_ht'];?></span></td>
                <td bgcolor="#F9F9F9"><span class="Estilo12">
				<?
			$resultados2 = mysql_query("select * from hor_trabajador  where id_ht='".$row['id_ht']."' ",$cn);
				$row2=mysql_fetch_array($resultados2);				
				echo $row2['h_ingreso'];
				
				?>
				</span></td>
                <td bgcolor="#F9F9F9"><span class="Estilo12">
				<?=$row2['h_salida'];;?>
				</span></td>
                <td bgcolor="#F9F9F9" align="center"><span class="Estilo13"><span class="Estilo12">&nbsp;<a href="javascript:editar('<?php echo $row['id_nivel']?>');"><img src='imgenes/ico_edit.gif' border='0'></a></span></span></td>
                <td bgcolor="#F9F9F9" align="center" style="visibility:hidden"><span class="Estilo13"><span class="Estilo12"><a href="javascript:eliminar('<?php echo $row['id_nivel']?>');"><img src="imgenes/eliminar.gif" border="0"></a></span></span></td>
                </tr>
	 <?php    
  }
  mysql_free_result($resultados);
  
  ?>			
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                </tr>
            </table></td>
            <td>&nbsp;</td>
            <td valign="top"><table width="100%" border="0" cellpadding="1" cellspacing="1">
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="4" class="EstiloTexto1" style=" border:#CCCCCC solid 1px">&nbsp;&nbsp;-> Horarios del trabajador </td>
				<td colspan="2" class="EstiloTexto1" style=" border:#CCCCCC solid 1px" align="center">
				
				
				<table title="Nuevo[F3]" width="70" height="21" border="0" cellpadding="0" cellspacing="0">
                  <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="javascript: doAjax('new_ht.php','accion=nh','nuevo_suc','get','0','1','','');" >
                    <td width="1" ></td>
                    <td width="15" align="center" ><span class="Estilo112"><img src="imagenes/nuevo.gif" width="14" height="16"></span></td>
                    <td width="60" ><span class="Estilo112"> Nuevo</span></td>
                  </tr>
                </table>				</td>
                </tr>
              <tr  style="background:url(imagenes/sky_blue_grid.gif); border:#999999 solid 1px" >
                <td rowspan="2" class="EstiloTexto1" style=" border:#CCCCCC solid 1px">C&oacute;digo</td>
                <td rowspan="2" class="EstiloTexto1" style=" border:#CCCCCC solid 1px">Tipo Horario </td>
                <td colspan="2" class="EstiloTexto1" style=" border:#CCCCCC solid 1px" align="center">Horario</td>
                <td colspan="2" rowspan="2" class="EstiloTexto1" style=" border:#CCCCCC solid 1px" align="center">Acciones</td>
              </tr>
              <tr  style="background:url(imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
                <td style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Ingreso</td>
                <td style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Salida</td>
              </tr>
              <?php  
  $resultados = mysql_query("select * from hor_trabajador  order by id_ht ",$cn);
 // echo "resultado".$resultado;
			  
while($row=mysql_fetch_array($resultados))
{
 ?>
              <tr  bgcolor="#EEEEEE" onMouseOver="entrada(this)" onMouseOut="salida(this)">
                <td bgcolor="#F9F9F9" align="center"><span class="Estilo12"><?php echo $row['id_ht'];?></span></td>
                <td bgcolor="#F9F9F9" align="center"><span class="Estilo12"><?php echo $row['tipo'];?></span></td>
                <td bgcolor="#F9F9F9"><span class="Estilo12"><?php echo $row['h_ingreso'];?></span></td>
                <td bgcolor="#F9F9F9"><span class="Estilo12"><?php echo $row['h_salida'];?></span></td>
                <td bgcolor="#F9F9F9" align="center"><span class="Estilo13"><span class="Estilo12">&nbsp;<a href="javascript:editar2('<?php echo $row['id_ht']?>');"><img src='imgenes/ico_edit.gif' border='0'></a></span></span></td>
                <td bgcolor="#F9F9F9" align="center"><span class="Estilo13"><span class="Estilo12"><a href="javascript:eliminar('<?php echo $row['id_ht']?>');"><img src="imgenes/eliminar.gif" border="0"></a></span></span></td>
              </tr>
              <?php    
  }
  mysql_free_result($resultados);
  
  ?>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><div style="color:#FF0000"> <?=$msg;?></div> </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
  <div id="sucursal" style="position:absolute; left:234px; top:102px; width:350px; height:180px; z-index:1; visibility:hidden"> </div>

  
</form>
</body>
<script>

function editar(cod){
doAjax('new_nivel.php','accion=en&cod='+cod,'nuevo_suc','get','0','1','','');
}
function editar2(cod){
doAjax('new_ht.php','accion=eh&cod='+cod,'nuevo_suc','get','0','1','','');
}
function eliminar(cod){
	if(confirm('Esta seguro que desea eliminar este registro?')){
	location.href='temporizador.php?accion=dh&cod='+cod;
	//this.form1.submit();
	}
//window.open('editar_producto.php?cod='+cod,'ventana','height=470 width=500');
}
function ActivarMenu(cod){
	user=document.form1.usuario.value;
	location.href='temporizador.php?accion=am&codigo='+user;
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
