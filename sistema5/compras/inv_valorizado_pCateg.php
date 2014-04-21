<?php 
session_start();
include('../conex_inicial.php');
$tpuser=$_SESSION['nivel_usu'];

if($_REQUEST['menu_temp']=='1'){
 ?>
<script>location.href="inv_valorizado_pCateg.php?menu_temp=2"</script>
<?php
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>

<script language="javascript" src="../Finanzas/miAJAXlib3.js"></script>

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
.Estilo8 {    font-family: Verdana, Arial, Helvetica, sans-serif;
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


.Estilo101 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo104 {font-size: 11px}
</style>

<script>

function MostrarFiltro(rep){
	if(rep.value!="-"){
		doAjax('../lista_doc.php','&mostrar='+rep.value,'MostrarFiltro2','get','0','1','','');
	}else{
		document.getElementById('reporte').innerHTML="";
	}
}

function MostrarFiltro2(texto){
	document.getElementById('reporte').innerHTML=texto;
}

function marcar_d(control){
	if(document.form1.GrupoOpciones12[0].checked){
		for(var i=0;i<document.form1.Todos.length;i++){
	 		document.form1.Todos[i].checked=true;
	 	}
	}else{
		for(var i=0;i<document.form1.Todos.length;i++){
	 		document.form1.Todos[i].checked=false;
		}
	}
}

/*function MostrarFiltro3(rep,fil,fil2){
	if(rep.value!="-"){
		doAjax('../lista_doc.php','&mostrar=filtrado2&tfil='+rep.options[rep.selectedIndex].text+'&fil='+fil+'&fil2='+fil2+'&valor='+rep.value,'MostrarFiltro4','get','0','1','','');
	}
}

function MostrarFiltro4(texto){
	document.getElementById('detfil').innerHTML=texto;
}*/

function cargar_cbo(texto){
//alert(texto);
var r = texto;
document.getElementById('cbo_tienda').innerHTML=r;
document.form1.almacen.focus();
//buscar_prod('');

}

var temp="";

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

<body>
<form id="form1" name="form1" method="post" action="">
  <table height="473" border="0" cellpadding="0" cellspacing="0">
    <tr style="background:url(../imagenes/white-top-bottom.gif)">
       <td height="25" colspan="11" style="border:#999999">
	     <span class="Estilo100 text5 text5"><span class="text5 text5  Estilo104">Log&iacute;stica :: Inventarios :: Inventario Valorizado x Categor&iacute;a </span></span>	  <span class="Estilo8 text5 text5">&nbsp;&nbsp;&nbsp;Del:
         <label id="fec_inv_ini"><?php echo date('d-m-Y',time()-3600)?></label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Al:
<label id="fec_inv_fin"><?php echo date('d-m-Y',time()-3600)?></label>
	     </span>
	     <span class="text5 text5 Estilo101">
	     <input type="hidden" name="carga" id="carga" value="N">
	     <input type="hidden" name="tpuser" id="tpuser" value="<?php echo $tpuser;?>">
      </span></td>
	</tr>
    <tr style="background:url(../imagenes/botones.gif)">
    <td width="5" height="100">&nbsp;</td>
      <td width="824"><table width="777" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="96" height="31"><label> <span class="Estilo7">Empresas</span></label></td>
          <td width="201" height="31"><select style="width:160"  name="sucursal" onChange="doAjax('../carga_cbo_tienda.php','&codsuc='+document.form1.sucursal.value,'cargar_cbo','get','0','1','','')" >
            <option value="0">Todas</option>
            <?php 
		
		$resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn);
		 		 		  
		while($row1=mysql_fetch_array($resultados1))
		{
		?>
            <option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
            <?php }?>
            </select></td>
          <td width="480" height="31"><div align="center">Filtrar:
            <select name="tfiltro" id="tfiltro" onChange="MostrarFiltro(this);">
              <option value="-">Seleccione</option>
              <option value="clasificacion">Clasificaci&oacute;n</option>
              <option value="categoria">Categoria</option>
              <option value="subcategoria">Sub-Categoria</option>
              </select>
            </div></td>
          <?php 
			$temp_fecha=date('Y-m-d');
			$fecha=explode("-",$temp_fecha);
			$fecha1=$fecha[0]."-".$fecha[1]."-01";
			$fecha2=$temp_fecha;
			$fecha3="01-".$fecha[1]."-".$fecha[0];
			?>
        </tr>
        <tr>
          <td height="31"><label> <span class="Estilo7">Tienda</span></label></td>
          <td height="31"><div id="cbo_tienda">
            <select  style="width:160" name="almacen"  onBlur="">
              <option value="0">Todas</option>
            </select>
          </div></td>
          <td height="54" colspan="2" rowspan="7" valign="top"><div align="center" id="reporte"></div></td>
        </tr>
        <tr>
          <td height="31" colspan="2">Desde <strong>
            <input style="height:17" autocomplete="off"  name="fecha"  id="fecha" type="text" value="<?php echo date('01-m-Y')?>" size="10">
            </strong> <strong>
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
              Hasta <strong>
                <input style="height:17" autocomplete="off"  name="fecha2"  id="fecha2" type="text" value="<?php echo date('d-m-Y')?>" size="10">
                </strong> <strong>
                  <button type="reset" id="f_trigger_b2" style="height:18; vertical-align:top" >...</button>
                  <script type="text/javascript">
				Calendar.setup({
					inputField     :    "fecha2",      
					ifFormat       :    "%d-%m-%Y",      
					showsTime      :    true,            
					button         :    "f_trigger_b2",   
					singleClick    :    true,           
					step           :    1
				});
                        </script>
                </strong></strong></td>
        </tr>
        <tr>
          <td height="31"><span class="Estilo20"><strong>Valorizar con: </strong></span></td>
          <td><select name="precios" style="width:150px">
            <option value="costo_inven">Precio de Costo</option>
            <option value="precio">Precio de Venta</option>
          </select></td>
        </tr>
        <tr>
          <td height="31"><span class="Estilo20"><strong>Ordenar Por : </strong></span></td>
          <td><select name="ordenar" style="width:150px">
            <option value="p.nombre">Nombre producto</option>
            <option value="p.idproducto">C&oacute;digo Sist.</option>
            <option value="p.cod_prod">C&oacute;digo Anexo</option>
          </select></td>
        </tr>
        <tr>
          <td height="31"><strong>Incluir : </strong></td>
          <td><select name="incluir" style="width:150px">
            <option value="0" selected>Todos los productos</option>
            <option value="1" >Stock mayor a cero</option>
            <option value="2">Stock menor a cero</option>
          </select></td>
        </tr>
        <tr>
          <td height="31"><b>Moneda:</b></td>
          <td><select name="moneda" style="width:150px">
            <option value="1" selected>Soles</option>
            <option value="2">Dolares</option>
          </select></td>
        </tr>
        <tr>
          <td height="54" colspan="2"><div align="center">
		  
            <table width="258" border="0">
              <tr>
                <td width="83"><table style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="25%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="32%" rowspan="2" align="center"><strong>
                      <input style="height:20" type="button" name="Submit" value="Procesar" onClick="buscar_prod('')">
                      </strong></td>
                    </tr>
                  </table></td>
                <td width="74"><table style="cursor:pointer" onClick="generar_inventario('vista')" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="32%" align="center"><span class="Estilo9"><img src="../imagenes/ico_lupa.jpg" width="22" height="21"></span></td>
                    </tr>
                  <tr>
                    <td align="center"><span class="Estilo9 Estilo13">Vista Previa</span></td>
                    </tr>
                  </table></td>
                <td width="87"><table style="cursor:pointer" onClick="generar_inventario('excel')" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="100%" align="center"><img  src="../imagenes/ico-excel.gif" width="22" height="22"></td>
                    </tr>
                  <tr>
                    <td align="center"><span class="Estilo9 Estilo13">Exportar a Excel</span></td>
                    </tr>
                  </table></td>
                </tr>
              </table>
			  
          </div></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="211">&nbsp;</td>
      <td>
	  
	  <table width="779" border="0" cellpadding="0" cellspacing="1">
        <tr  style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px; border:#999999 solid 1px">
          <td   width="33" height="21" align="center" ><span class="texto2"><strong>OK</strong></span></td>
          <td   width="64" align="center"><span class="texto2"><strong>C&oacute;digo</strong></span></td>
          <td   width="320" ><span class="texto2"><strong>Descripci&oacute;n</strong></span></td>
          <td   width="64" align="center"><span class="texto2"><strong>Stock Ini.</strong></span></td>
          <td   width="57" align="center"><span class="texto2"><strong>Total Ingresos</strong></span></td>
          <td   width="57" align="center"><span class="texto2"><strong>Total Egresos</strong></span></td>
          <td   width="57" align="center"><span class="texto2"><strong>Stock Act.</strong></span></td>
          <td   width="61" align="center"><span class="texto2"><strong>Ult.Costo</strong></span></td>
           <td   width="79" align="center"><span class="texto2"><strong>Valorizacion</strong></span></td>
        </tr>
        <tr>
          <td colspan="9">
		  <div id="detalle" style="width:800px; height:180px; overflow:auto" >
		
		  </div>		  </td>
          </tr>
        
        <tr>
          <td colspan="9" height="5"><div id="pagina" style="width:770px;" >
		
		  </div></td>
        </tr>
         <tr>
          <td colspan="9" height="5"></td>
      </table>
	  </td>
    </tr>
    <tr>
      <td height="15">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>

<script>
function isset(variable_name) {
try {
	if (typeof(eval(variable_name)) != 'undefined'){
		if (eval(variable_name) != null)
			return true;
	}
} catch(e) { }
	return false;
}
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

	temp_c = 0;

	if(document.getElementById('reporte').innerHTML==""){
		alert('Debe seleccionar un tipo de Reporte');
		return false;
	}else{
		for(var i=0;i<document.form1.Todos.length;i++){
			if(document.form1.Todos[i].checked){
				temp_c=1;
			}
		}
	}
if(temp_c==0){
	alert('Debe seleccionar Filtro de producto');
	return false;
}
var tienda=document.form1.almacen.value;
var sucursal=document.form1.sucursal.value;
var fecha=document.form1.fecha.value;
var fecha2=document.form1.fecha2.value;
var moneda=document.form1.moneda.value;
var incluir=document.form1.incluir.value;
var orden=document.form1.ordenar.value;
var filtro=document.form1.tfiltro.value;
var precios=document.form1.precios.value;

var variable="";
var agrupar1="";
var agrupar2="";
var clasificacion="";
var categoria="";
var d=0;
//try{
	if(isset(document.getElementById('agrrep1'))){
		if(document.getElementById('agrrep1').checked){
			agrupar1=document.form1.agrrep1.value;
		}
	}
	if(isset(document.getElementById('agrrep2'))){
		if(document.getElementById('agrrep2').checked){
			agrupar2=document.form1.agrrep2.value;
		}
	}
	if(isset(document.form1.cmbClasificacion)){
		clasificacion=document.form1.cmbClasificacion.value;
	}
	if(isset(document.form1.cmbCategoria)){
		categoria=document.form1.cmbCategoria.value;
	}
if(isset(document.form1.Todos)){
for(var i=0;i<document.form1.Todos.length;i++){
	if(document.form1.Todos[i].checked){
		if(d==0){
			variable=document.form1.Todos[i].value;
		}else{
			variable=variable+"|"+document.form1.Todos[i].value;
		}
		d=1;
	}
}
}
//}catch(e){}
if(d==0 && variable!=""){
	var enviar=variable+"|";
}else{
	var enviar=variable;
}
document.getElementById('fec_inv_ini').innerHTML=fecha;
document.getElementById('fec_inv_fin').innerHTML=fecha2;

doAjax('lista_prod_kardex6c.php','tienda='+tienda+'&pagina='+pagina+'&sucursal='+sucursal+'&fecha='+fecha+'&fecha2='+fecha2+'&incluir='+incluir+'&moneda='+moneda+'&orden='+orden+'&filtro='+filtro+'&precios='+precios+'&agrupar2='+agrupar2+'&agrupar1='+agrupar1+'&valor='+enviar+'&categoria='+categoria+'&clasificacion='+clasificacion,'mostrar_filtro','get','0','1','detalle','');
/*var tienda=document.form1.almacen.value;
var sucursal=document.form1.sucursal.value;
var fecha=document.form1.fecha.value;
doAjax('lista_prod_kardex5c.php','&valor='+document.form1.valor.value+'&tienda='+tienda+'&pagina='+pagina+'&sucursal='+sucursal+'&fecha='+fecha,'mostrar_filtro','get','0','1','','');
*/
}

function mostrar_filtro(texto){
//alert(texto)
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

temp_c=0;
if(document.getElementById('reporte').innerHTML==""){
	alert('Debe seleccionar un tipo de Reporte');
	return false;
}else{
for(var i=0;i<document.form1.Todos.length;i++){
	if(document.form1.Todos[i].checked){
		temp_c=1;
	}
}
}
if(temp_c==0){
	alert('Debe seleccionar Filtro de producto');
	return false;
}
var tienda=document.form1.almacen.value;
var sucursal=document.form1.sucursal.value;
var fecha=document.form1.fecha.value;
var fecha2=document.form1.fecha2.value;
var moneda=document.form1.moneda.value;
var incluir=document.form1.incluir.value;
var orden=document.form1.ordenar.value;
var filtro=document.form1.tfiltro.value;
var precios=document.form1.precios.value;

var variable="";
var agrupar1="";
var agrupar2="";
var clasificacion="";
var categoria="";
var d=0;
//try{
	if(isset(document.getElementById('agrrep1'))){
		if(document.getElementById('agrrep1').checked){
			agrupar1=document.form1.agrrep1.value;
		}
	}
	if(isset(document.getElementById('agrrep2'))){
		if(document.getElementById('agrrep2').checked){
			agrupar2=document.form1.agrrep2.value;
		}
	}
	if(isset(document.form1.cmbClasificacion)){
		clasificacion=document.form1.cmbClasificacion.value;
	}
	if(isset(document.form1.cmbCategoria)){
		categoria=document.form1.cmbCategoria.value;
	}
if(isset(document.form1.Todos)){
for(var i=0;i<document.form1.Todos.length;i++){
	if(document.form1.Todos[i].checked){
		if(d==0){
			variable=document.form1.Todos[i].value;
		}else{
			variable=variable+"|"+document.form1.Todos[i].value;
		}
		d=1;
	}
}
}
//}catch(e){}
if(d==0 && variable!=""){
	var enviar=variable+"|";
}else{
	var enviar=variable;
}
document.getElementById('fec_inv_ini').innerHTML=fecha;
document.getElementById('fec_inv_fin').innerHTML=fecha2;
var tpuser=document.form1.tpuser.value;
//doAjax('lista_prod_kardex6c.php','tienda='+tienda+'&pagina='+pagina+'&sucursal='+sucursal+'&fecha='+fecha+'&fecha2='+fecha2+'&incluir='+incluir+'&moneda='+moneda+'&orden='+orden+'&filtro='+filtro+'&precios='+precios+'&agrupar2='+agrupar2+'&agrupar1='+agrupar1+'&valor='+enviar+'&categoria='+categoria+'&clasificacion='+clasificacion,'mostrar_filtro','get','0','1','detalle','');

//alert(filtro);
//alert(agrupar1);
//alert(agrupar2);

if(parametro=='vista'){
	window.open('inventario_pCateg_excel.php?tienda='+tienda+'&sucursal='+sucursal+'&fecha='+fecha+'&fecha2='+fecha2+'&incluir='+incluir+'&moneda='+moneda+'&ordenar='+orden+'&filtro='+filtro+'&precios='+precios+'&agrupar2='+agrupar2+'&agrupar1='+agrupar1+'&valor='+enviar+'&categoria='+categoria+'&clasificacion='+clasificacion+'&formato='+parametro+'&tpuser='+tpuser,"vent2","toolbar=no,status=yes, menubar=no, scrollbars=no, width=870, height=750,left=50 top=50");
}else{
	window.open('inventario_pCateg_excel.php?tienda='+tienda+'&sucursal='+sucursal+'&fecha='+fecha+'&fecha2='+fecha2+'&incluir='+incluir+'&moneda='+moneda+'&ordenar='+orden+'&filtro='+filtro+'&precios='+precios+'&agrupar2='+agrupar2+'&agrupar1='+agrupar1+'&valor='+enviar+'&categoria='+categoria+'&clasificacion='+clasificacion+'&formato='+parametro+'&tpuser='+tpuser,"vent2","toolbar=no,status=yes, menubar=no, scrollbars=no, width=870, height=750,left=50 top=50");
}
/*	if(document.form1.checkbox.checked){
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
	//alert(fecha);
	if(parametro=='vista'){
	window.open("inventario_excel.php?precio="+document.form1.precios.value+"&agr_cla="+agr_cla+"&agr_cat="+agr_cat+"&agr_sub="+agr_sub+"&filtro_cla="+clasificacion+"&filtro_cat="+categoria+"&fecha="+fecha+"&filtro_sub="+subcategoria+"&ordenar="+ordenar+"&formato="+parametro+"&tienda="+tienda+"&precios="+precios+"&sucursal="+sucursal+"&incluir="+incluir+"&mon="+mon+"&valor="+valor+'&tpuser='+tpuser,"vent2","toolbar=no,status=yes, menubar=no, scrollbars=no, width=750, height=700,left=50 top=50");
	}else{
	window.open("inventario_excel.php?precio="+document.form1.precios.value+"&agr_cla="+agr_cla+"&agr_cat="+agr_cat+"&agr_sub="+agr_sub+"&filtro_cla="+clasificacion+"&filtro_cat="+categoria+"&fecha="+fecha+"&filtro_sub="+subcategoria+"&ordenar="+ordenar+"&formato="+parametro+"&tienda="+tienda+"&precios="+precios+"&sucursal="+sucursal+"&incluir="+incluir+"&mon="+mon+"&valor="+valor+'&tpuser='+tpuser,"vent2","toolbar=no,status=yes, menubar=no, scrollbars=no, width=700, height=700,left=50 top=50");
	
	}*/
	
}

function cambiar_color1(obj){
	obj.style.background='#FFF1BB';
	obj.style.border='#C0C0C0 solid 1px';
}

function cambiar_color2(obj){
	obj.style.background='#F3F3F3';
	obj.style.border=' ';
}

function procesar(){}
function enfocar_cbo(e){}
function limpiar_enfoque(e){}
function cambiar_enfoque(e){}

function detalle_prod(codigo){
window.open('espec_prod.php?codigo='+codigo,'','width=650,height=400,top=150,left=150,scroolbars=no,directories=no,location=no,menubar=no,titlebar=no,toolbar=no');
}

</script>