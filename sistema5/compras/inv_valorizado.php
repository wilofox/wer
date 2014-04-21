<?php 
session_start();
include('../conex_inicial.php');
$tpuser=$_SESSION['nivel_usu'];

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

<script language="javascript" src="../miAJAXlib2.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />

<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>
<style type="text/css">
<!--
.body {
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
.body {
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
	color:#333333;
}
.texto2{
	font-family: Verdana,Arial, Helvetica, sans-serif;
	font-size: 10px;
	color:#FFFFFF;
}
.bordeCelda{
      border-bottom: #CCCCCC solid 1px;

}


.Estilo101 {
	font-size: 12;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.Estilo104 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;}
.Estilo106 {font-family: Arial, Helvetica, sans-serif; font-size: 12px;}
.Estilo107 {font-size: 12}
</style>

<script>

var tempSucursal="<?php echo $_SESSION['user_sucursal']?>";
var tempTienda="<?php echo $_SESSION['user_tienda']?>";

function cargar_cbo(texto){
//alert(texto);
var r = texto;
document.getElementById('cbo_tienda').innerHTML=r;
document.form1.almacen.focus();
//buscar_prod('');
	
	//alert(tempTienda);
	if(tempTienda=='' || tempTienda=='0'){
	 document.form1.almacen.options[0].selected=true;
	}else{
	seleccionar_combo();
	}

}

var temp="";
/*
function entrada(objeto){

//	objeto.style.background='url(imagenes/sky_blue_sel.png)';
	
	objeto.cells[0].childNodes[0].checked=true;
	
//	temp=objeto;
	if(objeto.style.background=='url(../imagenes/sky_blue_sel.png)'){
	//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='url(../imagenes/sky_blue_sel.png)';
	
	
	temp.style.background=temp.bgColor;;
	//'#E9F3FE';
	temp=objeto;
	}

}
*/
function entrada(objeto){

	objeto.cells[0].childNodes[0].checked=true;
//	temp=objeto;
	if(objeto.style.background=='url(../imagenes/sky_blue_sel.png)'){
//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='url(../imagenes/sky_blue_sel.png)';
		if(temp!=''){
		//alert(temp.style.background);
		temp.style.background="#ffffff";
		}
		temp=objeto;
	}
	
}

function cargar(){
document.getElementById('lista_productos').rows[0].style.background='url(../imagenes/sky_blue_sel.png)';
temp=document.getElementById('lista_productos').rows[0];
document.getElementById('lista_productos').rows[0].cells[0].childNodes[0].checked=true;
}
</script>

<body onLoad="iniciar()">
<form id="form1" name="form1" method="post" action="">
  <table width="760" height="404" border="0" cellpadding="0" cellspacing="0">
    
    <tr style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="5" height="23">&nbsp;</td>
      
	   <td width="760" height="25" colspan="11" style="border:#999999">
	     <span class="Estilo100 text5 Estilo101"><span class="text5  Estilo104">Log&iacute;stica :: Inventarios :: Inventario Valorizado </span></span>	  <span class="Estilo8 text5 Estilo101"><span class="text5  Estilo106"><?php echo date('d-m-Y',time()-3600)?></span></span>
	     <span class="text5 Estilo101"><span class="text5  Estilo107">
	     <input type="hidden" name="carga" id="carga" value="S">
	     <input type="hidden" name="tpuser" id="tpuser" value="<?php echo $tpuser;?>">
      </span></span></td>
	  
    </tr>
    <tr style="background:url(../imagenes/botones.gif)">
      <td height="26">&nbsp;</td>
      <td><table width="721" border="0" cellpadding="0" cellspacing="0">
          <?php /*?><!-- <option value="0">Todas</option>--><?php */?>
          <tr>
            <td width="189" height="22"><label>
<span class="Estilo7">Empresa:</span>
<select style="width:160"  name="sucursal" onChange="doAjax('../carga_cbo_tienda.php','&kardex=s&codsuc='+document.form1.sucursal.value,'cargar_cbo','get','0','1','','')" >
			
			
			
              <?php 
		
		$resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn);
		 		 		  
		while($row1=mysql_fetch_array($resultados1))
		{
		?>
              <option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
              <?php }?>
            </select>
			
			
	        </label></td>
            <td width="167">
			<span class="Estilo7">Local/Tienda:</span>			
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
            <td width="91"><strong>
              <input style="height:17" autocomplete="off"  name="fecha"  id="fecha" type="text" value="<?php echo date('d-m-Y')?>" size="10">
              <button type="reset" id="f_trigger_b1" style="height:18; vertical-align:top" >...</button>
				<script type="text/javascript">
				Calendar.setup({
					inputField     :    "fecha",      
					ifFormat       :    "%d-%m-%Y",      
					showsTime      :    true,            
					button         :    "f_trigger_b1",   
					singleClick    :    true,           
					step           :    1                
				});
            </script>	
            </strong></td>
            <td width="139"><strong>
              <input style="height:20" autocomplete="off"  name="valor"  id="valor" type="text" size="22" onKeyUp="buscar_prod('')">
            </strong></td>
            <td width="117"><strong>
              <input style="height:20" type="button" name="Submit" value="Procesar" onClick="buscar_prod('')">
            </strong></td>
          </tr>
          
      </table></td>
    </tr>
    <tr>
      <td height="211">&nbsp;</td>
      <td>
	  
	  <table width="720" border="0" cellpadding="0" cellspacing="1">
        <tr  style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px; border:#999999 solid 1px">
          <td   width="37" height="21" align="center" ><span class="texto2"><strong>OK</strong></span></td>
          <td   width="76" align="center"><span class="texto2"><strong>C&oacute;digo</strong></span></td>
          <td   width="279" ><span class="texto2"><strong>Descripci&oacute;n</strong></span></td>
          <td   width="73" ><span class="texto2"><strong>Unidad</strong></span></td>
          <td   width="76"><span class="texto2"><strong>Stock Act. </strong></span></td>
          <td   width="72" ><span class="texto2"><strong>Costo</strong></span></td>
          <td   width="107" ><span class="texto2"><strong>Val. en Soles </strong></span></td>
        </tr>
        <tr>
          <td colspan="7">
		  <div id="detalle" style="width:720px; height:180px; overflow:auto" >
		
		  </div>		  </td>
          </tr>
        
        <tr>
          <td colspan="7" height="5"><div id="pagina" style="width:720px;" >
		
		  </div></td>
        </tr>
         <tr>
          <td colspan="7" height="5"></td>
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
          <td width="44%" valign="top"><table width="94%" height="70" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="23" colspan="2"><span class="Estilo20"><strong>Valorizar con: </strong></span></td>
              <td colspan="2">
			  
			  <select name="precios" id="precios" style="width:150px">
                  <option value="costo_inven">Precio de Costo</option>
				  <option value="pre_ref">Costo Referencial</option>
                  <option value="precio">Precio 1</option>
				  <option value="precio2">Precio 2</option>
				  <option value="precio3">Precio 3</option>
				  <option value="precio4">Precio 4</option>
				  <option value="precio5">Precio 5</option>				  
              </select>
			  
			  </td>
            </tr>
            <tr>
              <td height="23" colspan="2"><span class="Estilo20"><strong>Ordenar por : </strong></span></td>
              <td colspan="2"><select name="ordenar" style="width:150px">
				  <option value="p.nombre">Descripci&oacute;n</option>
                  <option value="p.idproducto">C&oacute;digo Sistema</option>
                  <option value="p.cod_prod">C&oacute;digo Anexo</option>
                </select>              </td>
            </tr>
            <tr>
              <td colspan="2"><span class="Estilo20"><strong>Incluir : </strong></span></td>
              <td colspan="2"><select name="incluir" style="width:150px">
                <option value="0">Todos los productos</option>
                <option value="1" selected>Stock mayor a cero</option>
				<option value="2">Stock menor a cero</option>
				<option value="3">Stock igual a cero</option>
              </select></td>
            </tr>
            <tr>
              <td colspan="2"><span class="Estilo20"><strong>Mostrar C&oacute;digo:</strong></span></td>
              <td colspan="2"><select name="columna" id="columna" style="width:150px">
                <option value="0">Ambos</option>
				<option value="1">C&oacute;digo sistema</option>
                <option value="2">C&oacute;digo anexo</option>
              </select></td>
            </tr>
            <tr>
              <td colspan="2"><span class="Estilo20"><strong><b>Moneda:</b></strong></span></td>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td width="10%">
                <input  name="moneda" type="radio" value="01" style="border:0px;" checked >             </td>
              <td width="22%">Soles</td>
              <td width="10%">
                <input name="moneda" type="radio" value="02" style="border:0px;">              </td>
              <td width="58%">D&oacute;lares</td>
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
function validar_pag(pagina,total){
	if(isNaN(pagina.value)){
		pagina.value=1;
		buscar_prod(1);
	}else{
		if(pagina.value<total){
			pagina.value=pagina.value;
			buscar_prod(pagina.value);
		}else{
			buscar_prod(total);
		}
	}
}
function buscar_prod(pagina){
//cancel_peticion();

var tienda=document.form1.almacen.value;
var sucursal=document.form1.sucursal.value;
var fecha=document.form1.fecha.value;
doAjax('lista_prod_kardex5c.php','&valor='+document.form1.valor.value+'&tienda='+tienda+'&pagina='+pagina+'&sucursal='+sucursal+'&fecha='+fecha,'mostrar_filtro','get','0','1','','');

}

function mostrar_filtro(texto){
///alert(texto)
var resp=texto.split("|");
document.getElementById('detalle').innerHTML=resp[0];
document.getElementById('pagina').innerHTML=resp[1];
//cargar();
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
	if(document.form1.moneda[0].checked){
		var mon=document.form1.moneda[0].value;
	}else{
		var mon=document.form1.moneda[1].value;
	}
	
var clasificacion=document.form1.clasificacion.value;
var categoria=document.form1.categoria.value;
var subcategoria=document.form1.subcategoria.value;
var ordenar=document.form1.ordenar.value;
var tienda=document.form1.almacen.value;
var sucursal=document.form1.sucursal.value;
var precios=document.form1.precios.value;
var incluir=document.form1.incluir.value;
var valor=document.form1.valor.value;
var fecha=document.form1.fecha.value;
var tpuser=document.form1.tpuser.value;
var columna=document.form1.columna.value;

	//alert(columna);
	if(parametro=='vista'){
	window.open("inventario_excel.php?precio="+document.form1.precios.value+"&agr_cla="+agr_cla+"&agr_cat="+agr_cat+"&agr_sub="+agr_sub+"&filtro_cla="+clasificacion+"&filtro_cat="+categoria+"&fecha="+fecha+"&filtro_sub="+subcategoria+"&ordenar="+ordenar+"&formato="+parametro+"&tienda="+tienda+"&precios="+precios+"&sucursal="+sucursal+"&incluir="+incluir+"&mon="+mon+"&valor="+valor+'&tpuser='+tpuser+'&columna='+columna,"vent2","toolbar=no,status=yes, menubar=no, scrollbars=no, width=750, height=700,left=50 top=50");
	}else{
	window.open("inventario_excel.php?precio="+document.form1.precios.value+"&agr_cla="+agr_cla+"&agr_cat="+agr_cat+"&agr_sub="+agr_sub+"&filtro_cla="+clasificacion+"&filtro_cat="+categoria+"&fecha="+fecha+"&filtro_sub="+subcategoria+"&ordenar="+ordenar+"&formato="+parametro+"&tienda="+tienda+"&precios="+precios+"&sucursal="+sucursal+"&incluir="+incluir+"&mon="+mon+"&valor="+valor+'&tpuser='+tpuser+'&columna='+columna,"vent2","toolbar=no,status=yes, menubar=no, scrollbars=no, width=700, height=700,left=50 top=50");
	
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


function iniciar(){
selecComboSuc();
}
function selecComboSuc(){
 	 var valor1=tempSucursal;
     var i;
	 for (i=0;i<document.form1.sucursal.options.length;i++)
        {
		
            if (document.form1.sucursal.options[i].value==valor1)
               {
			   
               document.form1.sucursal.options[i].selected=true;
               }
        
        }
		
		gene();
				
}

function gene(){
doAjax('../carga_cbo_tienda.php','&kardex=s&codsuc='+document.form1.sucursal.value,'cargar_cbo','get','0','1','','');
}


function seleccionar_combo(){

 	 var valor1=tempTienda;
     var i;
	 for (i=0;i<document.form1.almacen.options.length;i++)
        {
		
            if (document.form1.almacen.options[i].value==valor1)
               {
			   
               document.form1.almacen.options[i].selected=true;
               }        
        }
		
		document.form1.sucursal.disabled=true;
		document.form1.almacen.disabled=true;
			
}


</script>