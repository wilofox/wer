<?php 
session_start();
include('conex_inicial.php');



	if(isset($_REQUEST['cod'])){
	//echo "codigo eliminado".$_REQUEST['cod'];
	$tdoc=mysql_num_rows(mysql_query("select  * from det_mov where cod_prod='" . $_REQUEST['cod'] . "'"));
	//echo 	$tdoc;
	if($tdoc==0){
	$strSQL="delete from producto where idProducto='" . $_REQUEST['cod'] . "'";
	mysql_query($strSQL);
	$strSQLespec="delete from especificaciones where producto='" . $_REQUEST['cod'] . "'";
	mysql_query($strSQLespec);
	
		//header("location: productos.php");
		echo "<script>alert('Producto eliminado');location.href='productos2.php'</script>";
		}else{
		echo "<script>alert('Este producto no se puede eliminar tiene documentos relacionados');location.href='productos2.php'</script>";
		}
	}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>administradores</title>

<script language="javascript" src="miAJAXlib2.js"></script>

<LINK href="jquery_nice/base.css" type=text/css rel=stylesheet>
<LINK href="jquery_nice/jNice.css" type=text/css rel=stylesheet>
<SCRIPT src="jquery_nice/jquery-latest.pack.js" type=text/javascript></SCRIPT>
<SCRIPT src="jquery_nice/jquery.jNice.js" type=text/javascript></SCRIPT>

   <script src="jquery-1.2.6.js"></script>
    <script src="jquery.hotkeys.js"></script>
	<script src="mootools-comprimido-1.11.js"></script>

<script>

var temp="";
function entrada(objeto){

	objeto.cells[0].childNodes[0].checked=true;
//	temp=objeto;
	if(objeto.style.background=='url(imagenes/sky_blue_sel.png)'){
//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='url(imagenes/sky_blue_sel.png)';
		if(temp!=''){
		temp.style.background=temp.bgColor;
		}
		temp=objeto;
	}
	
}


function entrada2(objeto){
//document.getElementById('prueba').value=objeto.style.background;
//alert(objeto.style.background);

	if(objeto.style.background=='url(imagenes/sky_blue_sel.png)'){
//	alert('rrr');
	objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='url(imagenes/sky_blue_sel.png)';
	}
//document.getElementById('prueba').value=objeto.style.background;
//est=0;
}

function salida(objeto){
//document.getElementById('prueba').value=objeto.style.background;
//alert(objeto.style.background);
objeto.style.background='#F9F9F9';
//document.getElementById('prueba').value=objeto.style.background;
//est=0;
}

function recargar(){
document.form1.submit();
//alert();
//location.href="lista_productos.php";
}


function cargarproducto(pagina){
//alert('df');
//cancel_peticion();
var valor=document.form1.valor.value;
var criterio=document.form1.criterio.value;
var clasificacion=document.form1.clasificacion.value;
var categoria=document.form1.combocategoria.value;
var subcategoria=document.form1.combosubcategoria.value;
var ordenar=document.form1.ordenar.value;


doAjax('detprod2.php','valor='+valor+'&criterio='+criterio+'&pagina='+pagina+'&clasificacion='+clasificacion+'&categoria='+categoria+'&subcategoria='+subcategoria+'&ordenar='+ordenar,'detalle_prod','get','0','1','','');

}

function detalle_prod(texto){
var r = texto.split('?');
document.getElementById('detalle').innerHTML=r[0];
document.form1.carga.value='N';
document.getElementById('paginacion').innerHTML=r[1];
}

function cargar_reg(){
//document.getElementById('tbl_prod').rows[1].style.background='#fff1bb';
//temp=document.getElementById('tbl_prod').rows[1];

//document.getElementById('tbl_prod').rows[1].cells[0].childNodes[0].checked=true;
//document.form1.xaux[0].checked=true;

//alert(temp.innerHTML);
}


 jQuery(document).bind('keydown', 'f3',function (evt){jQuery('#_f3').addClass('dirty');

	evt.keyCode=0;
	evt.returnValue=false;
	
	editar('grabar');
	
return false; });

 jQuery(document).bind('keydown', 'f6',function (evt){jQuery('#_f6').addClass('dirty');
//	alert('f5');
	evt.keyCode=0;
	evt.returnValue=false;
	
	editar('actualizar');
	
return false; });

 jQuery(document).bind('keydown', 'f4',function (evt){jQuery('#_f4').addClass('dirty');
//	alert('f5');
	evt.keyCode=0;
	evt.returnValue=false;
	
eliminar();
	
return false; });

 jQuery(document).bind('keydown', 'f9',function (evt){jQuery('#_f9').addClass('dirty');
//	alert('f5');
	evt.keyCode=0;
	evt.returnValue=false;
	
recargar('x');
	
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
.Estilo12 { color:#333333;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
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
.Estilo30{font-family: Tahoma, Arial;font-size: 11px; color:#FFFFFF}
.Estilo31 {font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color:#FFFFFF; font:bold  }
.Estilo34 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
.Estilo29 {color: #333333}
.Estilo113 {	color: #CC3300;
	font-weight: bold;
	font-size: 10px;
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style>
</head>


<link href="styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-image: url(imagenes/bg3.jpg);
}
.Estilo17 {
	color: #006699;
	font-weight: bold;
}
.linetopbut{border-bottom:#000000 solid 1px; border-top:#000000 solid 1px;border-right:#999999 solid 1px;}
.linerigth{border-right:#999999 solid 1px;}
.Estilo26 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo33 {color: #000000}
		
		
-->
</style>

<body bgcolor="#FFFFFF" onLoad="document.form1.valor.focus(); cargarproducto('');">
<form name="form1" method="post" action="productos2.php">
  <table width="762" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="762">
	  <table width="762" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" >
        <tr style="background:url(imagenes/white-top-bottom.gif)">
          <td width="762" height="25" colspan="16" style="border:#999999"><span class="Estilo34">Administraci&oacute;n :: Soporte de Conceptos
              <input type="hidden" name="carga" id="carga" value="N">
          </span></td>
        </tr>
        <tr style="background:url(imagenes/botones.gif);">
          <td height="32" colspan="16" >
            <table width="761" border="0" cellpadding="0" cellspacing="0" style="border-bottom:#DFDFEA solid 2px">
              <tr>
                <td width="71" ><script>
		  function entrar_btn(obj){
		  obj.cells[0].style.backgroundImage="url(imagenes/bordes_boton1.gif)";
		  obj.cells[1].style.backgroundImage="url(imagenes/bordes_boton2.gif)";
		  obj.cells[2].style.backgroundImage="url(imagenes/bordes_boton2.gif)";
		  obj.cells[3].style.backgroundImage="url(imagenes/bordes_boton3.gif)";
		  
		  }
		  function salir_btn(obj){
		  obj.cells[0].style.backgroundImage="";
		  obj.cells[1].style.backgroundImage="";
		  obj.cells[2].style.backgroundImage="";
		  obj.cells[3].style.backgroundImage="";
		  
		  }
		  
		  
		  
		    </script>
		      <table title="Nuevo[F3]" width="73" height="21" border="0" cellpadding="0" cellspacing="0">
                <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="javascript:editar('grabar')">
                  <td width="3" ></td>
                  <td width="18" align="center" ><span class="Estilo33"><img src="imagenes/nuevo.gif" width="14" height="16"></span></td>
                  <td width="55" ><span class="Estilo33">Nuevo<span class="Estilo113">[F3]</span> </span></td>
                  <td width="3" ></td>
                </tr>
              </table></td>
                <td width="72"><table width="75" height="21" border="0" cellpadding="0" cellspacing="0">
                    <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="editar('actualizar')">
                      <td width="3" ></td>
                      <td width="20" ><img src="imgenes/ico_edit.gif" alt="Editar" width="16" height="16" border="0"></td>
                      <td width="48" ><span class="Estilo33">Editar<span class="Estilo113">[F6]</span></span></td>
                      <td width="4" ></td>
                    </tr>
                </table></td>
                <td width="73">
				
				<table onClick="eliminar()" width="80" height="21" border="0" cellpadding="0" cellspacing="0">
                    <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer">
                      <td width="2" ></td>
                      <td width="17" ><span class="Estilo33"><img src="imgenes/eliminar.png" width="16" height="16"></span></td>
                      <td width="56" ><span class="Estilo33">Eliminar<span class="Estilo113">[F4]</span></span></td>
                      <td width="5" ></td>
                    </tr>
                </table></td>
                <td width="258"><table width="92" height="21" border="0" cellpadding="0" cellspacing="0">
                    <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="recargar('x')">
                      <td width="3" ></td>
                      <td width="17" ><span class="Estilo33"><img src="imgenes/refresh.png" width="16" height="16"></span></td>
                      <td width="65" ><span class="Estilo33">Actualizar<span class="Estilo113">[F9]</span> </span></td>
                      <td width="3" ></td>
                    </tr>
                </table></td>
                <td width="75"><input name="orden" type="hidden" size="5" value="asc"><input name="ordenar" type="hidden" size="5" value=""></td>
                <td width="146">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        
        <tr>
          <td height="25" colspan="16" valign="top"><table width="99%" border="0" cellpadding="0" cellspacing="0">
              <tr style="background-image:url(../imagenes/topgradient.jpg)">
                <td width="752" height="24" ><strong><!-- <input type="submit" name="Submit2" value="Consultar">-->
                </strong>
                  <table width="751" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="37"><span class="Estilo29">Buscar:</span></td>
                      <td width="115"  align="left"><strong>
                        <select name="criterio">
						<option value="idproducto">Codigo Sistema</option>
                          <option value="nombre" selected>Descripci&oacute;n</option>
                          <option value="cod_prod">Codigo anexo</option>
                        </select>
                      </strong></td>
                      <td width="152" align="left"><input autocomplete="off" name="valor" type="text"  style="height:20; border-color:#CCCCCC" size="25" maxlength="100" onKeyUp="cargarproducto('')"></td>
                      <td width="18" align="right"><img src="imagenes/lupa5.gif" width="18" height="20"></td>
                      <td width="140" align="right">
					  
					  <select style="width:140px" name="clasificacion" onChange="cargarproducto('')" >
					  
					    <option selected="selected" value="999">--- <?=$CatgNomEti1;?> ---</option>
					  
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
                      <td width="140" align="left"><select style="width:140px" name="combocategoria" onChange="cargarproducto('')">
					  
					  <option selected="selected" value="999">--- <?=$CatgNomEti2;?> ---</option>
					  
					  
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
			var valor1="<?php echo $categoria?>";
			var i;
			 for (i=0;i<document.form1.combocategoria.options.length;i++)
			{
			
				if (document.form1.combocategoria.options[i].value==valor1)
				   {
				   
				   document.form1.combocategoria.options[i].selected=true;
				   }
			
			}
	                  </script>
                      </select></td>
                      <td width="149" align="left"><select style="width:140px" name="combosubcategoria" onChange="cargarproducto('')">
					  
					  <option selected="selected" value="999">--- <?=$CatgNomEti3;?> ---</option>
                        <?php 
	  
	    $resultados0 = mysql_query("select * from subcategoria order by des_subcateg ",$cn);
			 // echo "resultado".$resultado;
			  
while($row0=mysql_fetch_array($resultados0))
{
		
	  ?>
                        <option value="<?php echo $row0['idsubcategoria']?>"><?php echo $row0['des_subcateg']?></option>
                        <?php 
	 }
	  ?>
                        <script>
	   var valor1="<?php echo $subcategoria?>";
     var i;
	 for (i=0;i<document.form1.combosubcategoria.options.length;i++)
        {
		
            if (document.form1.combosubcategoria.options[i].value==valor1)
               {
			   
               document.form1.combosubcategoria.options[i].selected=true;
               }
        
        }
	                  </script>
                      </select></td>
                    </tr>
                  </table></td>
                </tr>
          </table></td>
        </tr>
	

        
       
        <tr>
          <td height="56" colspan="16">
		  <div id="detalle" style="width:760px; height:260px; overflow:scroll">
		   
		     
		  </div>		          
            </td>
        </tr>
		
		<tr>
		  <td height="5">
		  
		  <div id="paginacion" style="width:760px; height:20px;">
		 	     
		  </div>
		  
		  
		  </td>
		</tr>
		<tr>
		  <td style="padding-top:5px">
		  
		  <table width="762" border="0" cellpadding="0" cellspacing="0"  style="border:#CCCCCC solid 1px">
            <tr>
              <td width="760" height="25"><table width="760" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="71" class="Estilo33">&nbsp;&nbsp;&nbsp;<strong>Leyenda</strong></td>
                    <td width="12"><table width="10" height="10" border="0" cellpadding="0" cellspacing="0" bgcolor="#009933">
                        <tr>
                          <td width="22"></td>
                        </tr>
                    </table></td>
                    <td width="70"><span class="Estilo33">Inafectos</span></td>
                    <td width="13"><table width="10" height="10" border="0" cellpadding="0" cellspacing="0" bgcolor="#FF0000">
                      <tr>
                        <td width="22"></td>
                      </tr>
                    </table></td>
                    <td width="103"><span class="Estilo33">No Descarga Stock </span></td>
                    <td width="15"><table style="border:#666666 solid 1px" width="10" height="10" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                      <tr>
                        <td width="22"></td>
                      </tr>
                    </table></td>
                    <td width="56"><span class="Estilo33">Ninguno</span></td>
                    <td width="18"><table style="border:#666666 solid 1px" width="10" height="10" border="0" cellpadding="0" cellspacing="0" bgcolor="#0099CC">
                      <tr>
                        <td width="22"></td>
                      </tr>
                    </table></td>
                    <td width="167"><span class="Estilo33">Inafectos / No Descarga Stock</span></td>
                    <td width="182">&nbsp;</td>
                    <td width="53">&nbsp;</td>
                  </tr>
              </table></td>
            </tr>
          </table></td>
		  </tr>
		
      </table></td>
    </tr>
  </table>
</form>
</body>
<script>


function ordenamiento(){

var valor=document.form1.valor.value;
var criterio=document.form1.criterio.value;
var ordenar="nombre";
var orden= document.form1.orden.value;
var clasificacion=document.form1.clasificacion.value;
var categoria=document.form1.combocategoria.value;
var subcategoria=document.form1.combosubcategoria.value;
document.form1.ordenar.value='nombre';
var pagina='';


doAjax('detprod2.php','valor='+valor+'&criterio='+criterio+'&pagina='+pagina+'&clasificacion='+clasificacion+'&categoria='+categoria+'&subcategoria='+subcategoria+'&ordenar='+ordenar+'&orden='+orden,'detalle_prod','get','0','1','','');

	if(orden=='asc'){
	document.form1.orden.value="desc";
	}else{
	document.form1.orden.value="asc";
	}
		
}


function eliminar(){
//alert("No tiene permiso para eliminar items...");
//return false;
		var cod="";
		if(document.form1.xaux.length >0){
		
	//	alert(document.form1.xaux.length);
		  for (var i=0;i<document.form1.xaux.length;i++){ 
			   if (document.form1.xaux[i].checked) {
			   cod=document.form1.xaux[i].value;
			   break; 
			   }
				//  
			} 
		}else{	
		 cod=document.form1.xaux.value;
		}	
	
	if(cod==''){
	alert('Debe seleccionar un producto');
	return false;
	}	

	if(confirm('Esta seguro que desea eliminar este producto?')){
	location.href='productos2.php?cod='+cod;
	//this.form1.submit();
	}
//window.open('editar_producto.php?cod='+cod,'ventana','height=470 width=500');
}


function editar(accion){
	try{	
		var cod="";
		if(document.form1.xaux.length >0){
		
	//	alert(document.form1.xaux.length);
		  for (var i=0;i<document.form1.xaux.length;i++){ 
			   if (document.form1.xaux[i].checked) {
			   cod=document.form1.xaux[i].value;
			   break; 
			   }
				//  
			} 
		}else{	
		 cod=document.form1.xaux.value;
		}	
	}catch(e){
	
	}	
	if(accion=='grabar'){
	cod="";
	}

	if(accion=='actualizar' && cod==''){
	alert('Debe seleccionar un producto');
	return false;
	}			
	
	var pagina=document.form1.pag.value;
	var win00=window.open('editar_producto3.php?cod='+cod+'&accion='+accion+'&pagina='+pagina,'ventana','height=420 width=600 top=80 left=250 status=yes');	
	win00.focus();
	
		
}




</script>
</html>
