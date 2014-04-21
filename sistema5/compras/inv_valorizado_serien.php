<?php 
include('../conex_inicial.php');


if($_REQUEST['menu_temp']=='1'){
 ?>
<script>//location.href="inv_valorizado_serien.php?menu_temp=2"</script>
<?php
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>

<script language="javascript" src="../miAJAXlib2.js"></script>

<link rel="stylesheet" type="text/css" media="all" href=../"calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>
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
.Estilo8 {    font-family: Arial, Helvetica, sans-serif;
	color: #990000;
	font-size: 12px;
	font-weight: bold;
}
-->
</style></head>


<link href="../styles.css" rel="stylesheet" type="text/css">
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
	color:#FFFFFF;
}



</style>

<script>



function cargar_cbo(texto){

var r = texto;
document.getElementById('cbo_tienda').innerHTML=r;

document.form1.almacen.focus();
buscar_prod();

}

var temp="";
function entrada(objeto){

//	objeto.style.background='url(imagenes/sky_blue_sel.png)';
	
	objeto.cells[0].childNodes[0].checked=true;
	
//	temp=objeto;
	if(objeto.style.background=='url(../imagenes/sky_blue_sel2.png)'){
	//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='url(../imagenes/sky_blue_sel2.png)';
	temp.style.background=temp.bgColor;
	//'#E9F3FE';
	temp=objeto;
	}

}


function cargar(){
//alert(document.getElementById('lista_productos').rows.length);
if(document.getElementById('lista_productos').rows.length>0){
document.getElementById('lista_productos').rows[0].style.background='url(../imagenes/sky_blue_sel.png)';
temp=document.getElementById('lista_productos').rows[0];
document.getElementById('lista_productos').rows[0].cells[0].childNodes[0].checked=true;
}
}
</script>

<body onLoad="buscar_prod();">
<form id="form1" name="form1" method="post" action="">
  <table width="760" height="404" border="0" cellpadding="0" cellspacing="0">
    
    <tr style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="5" height="23">&nbsp;</td>
      
	   <td width="760" height="25" colspan="11" style="border:#999999">
	  <span class="Estilo100">INVENTARIO F&Iacute;SICO CON SERIE::  </span>	  <span class="Estilo8"><?php echo date('d-m-Y',time()-3600)?></span>
	  <input type="hidden" name="carga" id="carga" value="N"></td>
	  
    </tr>
    <tr style="background:url(../imagenes/botones.gif)">
      <td height="26">&nbsp;</td>
      <td><table width="721" border="0" cellpadding="0" cellspacing="0">
          
          <tr>
            <td width="215" height="22"><label>
<span class="Estilo7">Empresas</span>
<select style="width:160"  name="sucursal" onChange="doAjax('../carga_cbo_tienda.php','&kardex=s&codsuc='+document.form1.sucursal.value,'cargar_cbo','get','0','1','','')" >
			
			 <option value="0">Todas</option>
			
              <?php 
		
		$resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn);
		 		 		  
		while($row1=mysql_fetch_array($resultados1))
		{
		?>
              <option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
              <?php }?>
            </select>
			
			
	        </label></td>
            <td width="174">
									
			<div id="cbo_tienda">
              <select  style="width:160" name="almacen"  onBlur="">
                <option value="0">Todas</option>
              </select>
            </div>			</td>
			<?php 
			$temp_fecha=date('Y-m-d');
			$fecha=explode("-",$temp_fecha);
			$fecha1=$fecha[0]."-".$fecha[1]."-01";
			$fecha2=$temp_fecha;
			?>
			
            <td colspan="3"><img src="../imagenes/lupa5.gif" width="18" height="20"></td>
            <td width="160"><strong>
              <input style="height:20" autocomplete="off"  name="valor" type="text" size="22" onKeyUp="buscar_prod()">
            </strong></td>
            <td width="154"><strong>
              <input style="height:20" type="button" name="Submit" value="Procesar" onClick="buscar_prod()">
            </strong></td>
          </tr>
          
      </table></td>
    </tr>
    <tr>
      <td height="211">&nbsp;</td>
      <td>
	  
	  <table width="720" border="0" cellpadding="0" cellspacing="1">
        <tr  style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px; border:#999999 solid 1px">
          <td   width="23" height="21" align="center" ><span class="texto2"><strong>OK</strong></span></td>
          <td   width="40" align="center"><span class="texto2"><strong>Codigo</strong></span></td>
          <td   width="280" ><span class="texto2"><strong>Descripci&oacute;n</strong></span></td>
		  <td   width="66"><span class="texto2"><strong>Stock Act. </strong></span></td>
          <td   width="400" align="center" ><table width="100%" border="0">
            <tr>
              <td width="21%" align="center"><span class="texto2"><strong>Serie </strong></span></td>
              <td width="16%" align="center"><span class="texto2"><strong>Fecha</strong></span></td>
              <td width="30%" align="center"><span class="texto2"><strong>Proveedor</strong></span></td>
              <td width="16%" align="center"><span class="texto2"><strong>D. ing</strong></span></td>
            </tr>
          </table></td>

          </tr>
        <tr>
          <td colspan="5">
		  <div id="detalle" style="width:810px; height:180px; overflow:auto" ></div>		  </td>
          </tr>
        
        <tr>
          <td colspan="5" height="5"></td>
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
                      <input  style="border: 0px; background-color:#F9F9F9; " type="checkbox" name="checkbox" value="checkbox">
                      Agrupar</span></td>
                  </tr>
                <tr>
                  <td height="19" colspan="2">
                    
                    <select name="clasificacion">
                      
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
                  <td height="19" colspan="2"><select name="categoria">
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
                  <td height="22" colspan="2"><select name="subcategoria">
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
          <td width="44%" valign="top"><table width="94%" height="46" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="32%" height="23"><span class="Estilo20"><strong>Ordenar Por : </strong></span></td>
              <td width="68%"><select name="ordenar" style="width:150px">
                  <option value="p.nombre">Nombre producto</option>
                  <option value="p.idproducto">C&oacute;digo Anexo</option>
                </select>              </td>
            </tr>
            <tr>
              <td height="23">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
          <td width="18%" valign="top"><table width="77%" height="81" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="63%" height="40" align="center" valign="middle"><table onClick="generar_inventario('excel')"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="center"><img  src="../imagenes/ico-excel.gif" width="22" height="22"></td>
                </tr>
                <tr>
                  <td align="center"><span class="Estilo9 Estilo13">Exportar a Excel</span></td>
                </tr>
              </table></td>
            </tr>
            
            <tr>
              <td align="center"><table style="cursor:pointer" onClick="generar_inventario('vista')" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="95%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="center"><span class="Estilo9"><img src="../imagenes/ico_lupa.jpg" width="20" height="20"></span></td>
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
function  buscar_prod(){
//cancel_peticion();

var tienda=document.form1.almacen.value;
var sucursal=document.form1.sucursal.value;
var valor=document.form1.valor.value;

doAjax('lista_prod_kardex4c.php','&valor='+valor+'&tienda='+tienda+'&sucursal='+sucursal,'mostrar_filtro','get','0','1','','');
}

function mostrar_filtro(texto){
//alert(texto);
document.getElementById('detalle').innerHTML=texto;
cargar();
document.form1.carga.value='N';
}


function mostrar_kardex(){

	if(document.form1.sucursal.value!=0){
			var i 
			for (i=0;i<document.form1.xproducto.length;i++){ 
			   if (document.form1.xproducto[i].checked) {
			   var codigo=document.form1.xproducto[i].value;
			   break; 
			   }
				//  
			} 
	
		
		 for (i=0;i<document.form1.sucursal.options.length;i++)
        {
		
         if (document.form1.sucursal.options[i].value==document.form1.sucursal.value)
            {
			   var des_suc=document.form1.sucursal.options[i].text;
            }
        
        }
		
		//alert(des_suc);
		
		
		window.open("resultado_kardex.php?cod_prod="+codigo+"&des_suc="+des_suc+"&sucursal="+document.form1.sucursal.value+"&tienda="+document.form1.almacen.value+"&fecha1="+document.form1.fecha1.value+"&fecha2="+document.form1.fecha2.value,"vent","toolbar=yes,status=no, menubar=no, scrollbars=no, width=650, height=300,left=300 top=250");
		
	}else{
	
	alert('Debe seleccionar una Empresa');
	}
	
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
	
	if(document.form1.sucursal.value==0){
	alert('Seleccione una sucursal');
	return false;
	}

	
var clasificacion=document.form1.clasificacion.value;
var categoria=document.form1.categoria.value;
var subcategoria=document.form1.subcategoria.value;
var ordenar=document.form1.ordenar.value;
var tienda=document.form1.almacen.value;
var sucursal=document.form1.sucursal.value;
var valor=document.form1.valor.value;

	//alert(mon);
	if(parametro=='vista'){
	window.open("inventario_excel2.php?agr_cla="+agr_cla+"&agr_cat="+agr_cat+"&agr_sub="+agr_sub+"&filtro_cla="+clasificacion+"&filtro_cat="+categoria+"&filtro_sub="+subcategoria+"&ordenar="+ordenar+"&formato="+parametro+"&tienda="+tienda+"&sucursal="+sucursal+"&valor="+valor,"vent2","toolbar=no,status=yes, menubar=no, scrollbars=no, width=870, height=700,left=50 top=50");
	}else{
	window.open("inventario_excel2.php?agr_cla="+agr_cla+"&agr_cat="+agr_cat+"&agr_sub="+agr_sub+"&filtro_cla="+clasificacion+"&filtro_cat="+categoria+"&filtro_sub="+subcategoria+"&ordenar="+ordenar+"&formato="+parametro+"&tienda="+tienda+"&sucursal="+sucursal+"&valor="+valor,"vent2","toolbar=no,status=yes, menubar=no, scrollbars=no, width=700, height=700,left=50 top=50");
	
	}

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
window.open('espec_prod.php?codigo='+codigo,'','width=650,height=400,top=150,left=150,scroolbars=no,directories=no,location=no,menubar=no,titlebar=no,toolbar=no');
}

</script>