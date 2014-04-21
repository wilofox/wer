<?php 
include('conex_inicial.php');


if($_REQUEST['menu_temp']=='1'){
 ?>
<script>location.href="inv_valorizado.php?menu_temp=2"</script>
<?php
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>

<script language="javascript" src="miAJAXlib2.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="calendario/calendar.js"></script>
<script type="text/javascript" src="calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendario/calendar-setup.js"></script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo9 {
	font-size: 10px;
	font-weight: bold;
}
.Estilo14 {
	font-size: 10px;
	font-family: tahoma, verdana, sans-serif;
}
-->
</style></head>


<link href="styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
background-color:#F3F3F3;   
}
.Estilo7 {color: #747374; font-size: 10px; font-weight: bold; }
.Estilo13 {color: #0767C7}
.Estilo19 {font-family: tahoma, verdana, sans-serif}
.Estilo20 {font-size: 10px}

.Estilo100 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
.texto1{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #000000;
}
.texto2{
	font-family: Verdana,Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #000000;
}
</style>

<script>



function cargar_cbo(texto){
//alert(texto);
var r = texto;
document.getElementById('cbo_tienda').innerHTML=r;
document.form1.almacen.focus();
}

var temp="";
function entrada(objeto){

//	objeto.style.background='url(imagenes/sky_blue_sel.png)';
	
	objeto.cells[0].childNodes[0].checked=true;
	
//	temp=objeto;
	if(objeto.style.background=='url(imagenes/sky_blue_sel.png)'){
	//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='url(imagenes/sky_blue_sel.png)';
	temp.style.background=temp.bgColor;;
	//'#E9F3FE';
	temp=objeto;
	}

}

function cargar(){
	try {
	/*
		var nombreVariable=document.getElementById('lista_productos').rows[0];
		alert(isset(nombreVariable));
		if(isset(nombreVariable)){
		return false;
		}
	*/
document.getElementById('lista_productos').rows[0].style.background='url(sky_blue_sel.png)';
temp=document.getElementById('lista_productos').rows[0];
document.getElementById('lista_productos').rows[0].cells[0].childNodes[0].checked=true;

	 } catch(e) { }

}

  function isset(variable_name) {
			try {
				 if (typeof(eval(variable_name)) != 'undefined')
				 if (eval(variable_name) != null)
				 return true;
			 } catch(e) { }
			return false;
	}


function cargarcatalogo(pagina){

var valor=document.form1.valor.value;
//var valor2=document.form1.valor2.value;
var criterio=document.form1.criterio.value;
var clasificacion=document.form1.clasific.value;
var categoria=document.form1.combocategoria.value;
var subcategoria=document.form1.combosubcategoria.value;
//var moneda=document.form1.cmbmoneda.value;
var stock =document.form1.checkbox4.checked;
var almacen=document.form1.almacen.value;

//
document.form1.clasificacion.value=document.form1.clasific.value;
document.form1.categoria.value=document.form1.combocategoria.value;
document.form1.subcategoria.value=document.form1.combosubcategoria.value;
//document.form1.moneda.value=document.form1.cmbmoneda.value;

/*var ordenar=document.form1.ordenar.value;*/

doAjax('ventas/catal_lista_prod_kardex2c.php','&valor='+valor+'&criterio='+criterio+'&pagina='+pagina+'&clasificacion='+clasificacion+'&categoria='+categoria+'&subcategoria='+subcategoria+'&moneda=&stock='+stock+'&almacen='+almacen,'mostrar_filtro','get','0','1','','');

}
</script>


<body onLoad="document.form1.valor.focus(); cargarcatalogo('');">

<form id="form1" name="form1" method="post" action="">
  <table width="760" height="404" border="0" cellpadding="0" cellspacing="0">
    
    <tr style="background:url(imagenes/white-top-bottom.gif)">
      <td width="5" height="23">&nbsp;</td>
      
	   <td width="760" height="25" colspan="11" style="border:#999999">
	  <span class="Estilo100">Log&iacute;stica :: Inventarios :: Cat&aacute;logo de Productos</span>	  <input type="hidden" name="carga" id="carga" value="N"></td>	  
    </tr>
    <tr style="background:url(imagenes/botones.gif)">
      <td height="26">&nbsp;</td>
      <td><table width="795" border="0" cellpadding="0" cellspacing="0">
          
          <tr>
            <td width="215" height="22">&nbsp;</td>
            <td width="161">&nbsp;</td>
			<?php 
			$temp_fecha=date('Y-m-d');
			$fecha=explode("-",$temp_fecha);
			$fecha1=$fecha[0]."-".$fecha[1]."-01";
			$fecha2=$temp_fecha;
			?>
			
            <td colspan="3">&nbsp;</td>
            <td width="151">&nbsp;</td>
            <td width="248">&nbsp;<strong>Conversi&oacute;n de Moneda

            </strong></td>
          </tr>
          
      </table>
	  
	  
	   <table width="751" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="37"><span class="Estilo7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Buscar&nbsp;</span></td>
                      <td width="115"  align="left"><select name="criterio">
						  <option value="idproducto">Codigo Sistema</option>
                          <option value="nombre" selected>Descripci&oacute;n</option>
                          <option value="cod_prod">Codigo anexo</option>
                        </select></td>
                      <td width="152" align="left"><input name="valor" type="text" id="valor"  style="height:20; border-color:#CCCCCC" onKeyUp="cargarcatalogo('')" size="25" maxlength="100" autocomplete="off"></td>
                      <td width="18" align="right"><img src="imagenes/lupa5.gif" width="18" height="20"></td>
                      <td width="140" align="right"><select style="width:140px" name="clasific" onChange="cargarcatalogo('')" >
					  
					    <option selected="selected" value="999">--- <?=$CatgNomEti1;?> ---</option>
					  
<?php 	  
$resultados0 = mysql_query("select * from clasificacion order by des_clas ",$cn);
 
while($row0=mysql_fetch_array($resultados0))
{		
	  ?>
<option value="<?php echo $row0['idclasificacion']?>"><?php echo $row0['des_clas']?></option>
       <?php 
	 }
	  ?>
                     </select></td>
                      <td width="140" align="left"><select style="width:140px" name="combocategoria" onChange="cargarcatalogo('')">
					  
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
                      </select></td>
                      <td width="149" align="left"><select style="width:140px" name="combosubcategoria" onChange="cargarcatalogo('')">
					  
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
	  ?>   </select></td>
                    </tr>
        </table>
	  
	  
	  
	  </td>
    </tr>
    <tr>
      <td height="211">&nbsp;</td>
      <td>
	  
	  <table width="800" border="0" cellpadding="0" cellspacing="1">
        <tr  style="background:url(imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
          <td   style=" border:#CCCCCC solid 1px" width="26" height="21" align="center" ><span class="texto2"><strong>OK</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="47" align="center"><span class="texto2"><strong>Codigo</strong></span></td>
		   <td  style=" border:#CCCCCC solid 1px" width="47" align="center"><span class="texto2"><strong>C.Anexo</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="215" ><span class="texto2"><strong>Descripci&oacute;n</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="53" ><span class="texto2"><strong>Unidad</strong></span></td>
                    <td  style=" border:#CCCCCC solid 1px" width="53" ><span class="texto2"><strong>Garantia</strong></span></td>
          </tr>
        <tr>
          <td colspan="11">
		  <div id="detalle" style="width:800px; height:180px;" >		  </div>		  </td>
          </tr>
     </table>
	
	  </td>
    </tr>
    <tr>
      <td height="15">&nbsp;</td>
      <td><table width="98%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="38%"><table style="border:#CCCCCC solid 1px" width="97%" height="132" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td align="center" valign="top"><table width="88%" height="120" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="56%" height="20"><span class="Estilo9 Estilo19"><?=$CatgNomEti1;?></span></td>
                    <td width="44%"><span class="Estilo14" style="font-weight: bold">
                      <input style="border: 0px; background-color:#F9F9F9; " type="checkbox" name="checkbox" value="checkbox">
                      Agrupar</span></td>
                  </tr>
                <tr>
                  <td height="19" colspan="2">
                    
                    <select name="clasificacion" disabled>
                      
                      <option value="">------------------------------------</option>
                      <?php  
				  $resultados3 = mysql_query("select * from clasificacion order by des_clas ",$cn); 
					while($row3=mysql_fetch_array($resultados3))
					{ 
		?>
                      <option value="<?php echo $row3['idclasificacion']; ?>"><?php echo $row3['des_clas']; ?></option>
                      <?php } ?>
                      </select>                  </td>
                  </tr>
                <tr>
                  <td height="20"><span class="Estilo9"><?=$CatgNomEti2;?></span></td>
                    <td><span class="Estilo20" style="font-weight: bold">
                      <input checked="checked" style="border: 0px; background-color:#F9F9F9; " type="checkbox" name="checkbox2" value="checkbox">
                      Agrupar</span></td>
                  </tr>
                <tr>
                  <td height="19" colspan="2"><select name="categoria" disabled>
                    <option value="">------------------------------------</option>
                    <?php  
				  $resultados3 = mysql_query("select * from categoria order by des_cat ",$cn); 
					while($row3=mysql_fetch_array($resultados3))
					{ 
		?>
                    <option value="<?php echo $row3['idCategoria']; ?>"><?php echo $row3['des_cat']; ?></option>
                    <?php } ?>
                    </select></td>
                  </tr>
                <tr>
                  <td height="20"><span class="Estilo20"><strong><?=$CatgNomEti3;?></strong></span></td>
                    <td><span class="Estilo20" style="font-weight: bold">
                      <input checked="checked" style="border: 0px; background-color:#F9F9F9; " type="checkbox" name="checkbox3" value="checkbox">
                      Agrupar</span></td>
                  </tr>
                <tr>
                  <td height="22" colspan="2"><select name="subcategoria" disabled>
                    <option value="">------------------------------------</option>
                    <?php  
				  $resultados3 = mysql_query("select * from subcategoria order by des_subcateg ",$cn); 
					while($row3=mysql_fetch_array($resultados3))
					{ 
		?>
                    <option value="<?php echo $row3['idsubcategoria']; ?>"><?php echo $row3['des_subcateg']; ?></option>
                    <?php } ?>
                    </select></td>
                  </tr>
                </table></td>
              </tr>
          </table></td>
          <td width="44%" valign="top"><table width="94%" height="70" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="23%" height="23"><span class="Estilo20"><strong>Ordenar Por : </strong></span></td>
              <td width="77%"><select name="ordenar" style="width:150px">
                  <option value="nombre">Nombre producto</option>
                  <option value="cod_prod">Codigo Anexo</option>
                </select></td>
            </tr>
            <tr>
              <td height="23"><strong>Mostrar:</strong></td>
              <td><strong>
                <select name="columna" id="columna" style="width:150">
                  <option value="">Ambos</option>
				  <option value="1">C&oacute;digo Sistema</option>
                  <option value="2">C&oacute;digo Anexo</option>
                </select>
              </strong></td>
            </tr>
            <tr>
              <td colspan='2'><table><tr><td><strong>Productos con Stock<span class="Estilo14" style="font-weight: bold">
                <input style="border: 0px; " type="checkbox" name="checkbox4" value="checkbox" onClick="activar('4')" >
              </span></strong></td><td>&nbsp;<strong>Mostrar cant.<span class="Estilo14" style="font-weight: bold">
                <input style="border: 0px; background-color:#F9F9F9; " type="checkbox" name="checkbox5" value="checkbox"  >
              </span></strong></td></tr></table></td>
            </tr>
            <tr>
              <td><strong>Tienda : </strong></td>
              <td>
			  <select  style="width:160" name="almacen"  onBlur="" disabled onChange="cargarcatalogo('');">
                 <option value="0">Todos</option>
                      <?php 
		 $resultados1 = mysql_query("select * from tienda order by des_tienda ",$cn);
		while($row1=mysql_fetch_array($resultados1))
		{
		?>
      <option value="<?php echo $row1['cod_tienda'] ?>"><?php echo $row1['des_tienda'] ?></option>
                      <?php }?>
                  </select>			  </td>
            </tr>
          </table></td>
          <td width="18%" valign="top"><table width="77%" height="81" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="63%" height="40" align="center" valign="middle"><table onClick="generar_inventario('excel')"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="center"><img  src="imagenes/ico-excel.gif" width="22" height="22"></td>
                </tr>
                <tr>
                  <td align="center"><span class="Estilo9 Estilo13">Exportar a Excel</span></td>
                </tr>
              </table></td>
            </tr>
            
            <tr>
              <td align="center"><table style="cursor:pointer" onClick="generar_inventario('vista')" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="95%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="center"><span class="Estilo9"><img src="imagenes/ico_lupa.jpg" width="20" height="20"></span></td>
                </tr>
                <tr>
                  <td align="center"><span class="Estilo9 Estilo13">Vista Previa</span></td>
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
</html>

<script>

function mostrar_filtro(texto){
document.getElementById('detalle').innerHTML=texto;
cargar();
document.form1.carga.value='N';
}




function generar_inventario(parametro){

	if(document.form1.checkbox.checked){
	var agr_cla="S";
	}else{
	var agr_cla="N";
	}
	if(document.form1.checkbox2.checked){
	var agr_cat="S";
	}else{
	var agr_cat="N";
	}
	if(document.form1.checkbox3.checked){
	var agr_sub="S";
	}else{
	var agr_sub="N";
	}
	if(document.form1.checkbox4.checked){
	var agr_stck="S";
	}else{
	var agr_stck="N";
	}
	if(document.form1.checkbox5.checked){
	var agr_cant="S";
	}else{
	var agr_cant="N";
	}
var clasificacion=document.form1.clasificacion.value;
var categoria=document.form1.categoria.value;
var subcategoria=document.form1.subcategoria.value;
var ordenar=document.form1.ordenar.value;
//var moneda=document.form1.moneda.value;
var valor=document.form1.valor.value;
var almacen=document.form1.almacen.value;
var columna=document.form1.columna.value;


window.open("ventas/catalogo_excel.php?agr_cla="+agr_cla+"&agr_cat="+agr_cat+"&agr_sub="+agr_sub+"&agr_stck="+agr_stck+"&agr_cant="+agr_cant+"&filtro_cla="+clasificacion+"&filtro_cat="+categoria+"&filtro_sub="+subcategoria+"&ordenar="+ordenar+"&formato="+parametro+"&moneda=&valor="+valor+"&almacen="+almacen+"&columna="+columna,"vent","toolbar=no,status=yes, menubar=no, scrollbars=yes, width=750, height=600,left=50 top=50");


}

function cambiar_color1(obj){
obj.style.background='#FFF1BB';
obj.style.border='#C0C0C0 solid 1px';
}

function cambiar_color2(obj){
obj.style.background='#F3F3F3';
obj.style.border=' ';
}

function procesar(){

}
function enfocar_cbo(e){}
function limpiar_enfoque(e){}
function cambiar_enfoque(e){}

function detalle_prod(codigo){
window.open('compras/espec_prod.php?codigo='+codigo,'','width=650,height=400,top=150,left=150,scroolbars=no,directories=no,location=no,menubar=no,titlebar=no,toolbar=no');

}
function activar(tipo){
	if(tipo=='4'){
		if(document.form1.checkbox4.checked==true){
			document.form1.almacen.disabled=false;			
		}else{
			document.form1.almacen.disabled=true;
			document.form1.almacen.value="0";
		}
		cargarcatalogo('');
	}
}
</script>