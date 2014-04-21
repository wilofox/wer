<?php 
	include('../conex_inicial.php');
	$titulo="Inventarios :: Productos M&aacute;s Vendidos";
?>
<html>
<head>
	<script language="javascript" src="miAJAXlib2.js"></script>
    <script src="../jquery-1.2.6.js"></script>
    <script src="../jquery.hotkeys.js"></script>
	<script src="../mootools-comprimido-1.11.js"></script>


<script>
function Activar(control){
	switch(control.name){
		case 'clasificacion':var nombre='cboclasificacion';break;
		case 'categoria':var nombre='cbocategoria';break;
		case 'subcategoria':var nombre='cbosubcategoria';break;
	}
	document.getElementById(nombre).disabled=!control.checked;
}


function iniciar(){
doAjax('../lista_doc.php','&mostrar=tiendas&valor=1','cargar_cbo','get','0','1','','');
}


function validar_form(){	 
	var fecha1=document.form1.fecha1.value;		 
	var fecha2=document.form1.fecha2.value;	
	var tiendas='';
	var sucursal=document.form1.sucursal.value;
	try{
		for(var i=0;i<document.form1.Tienda.length;i++){
			if(document.form1.Tienda[i].checked){
				tiendas=document.form1.Tienda[i].value+"|"+tiendas;
				temp1=1;
			}
		}
	}catch(e){
		if(document.form1.Tienda.checked){
			tiendas=document.form1.Tienda.value+"|";
			temp1=1;
		}
	}
	if(fecha1==''){
		alert('Ingrese fecha');
		return false;
	}
	if(fecha2==''){
		alert('Ingrese fecha');
		return false;
	}
	if(sucursal=='0'){
		alert('Seleccione una Sucursal');
		return false;
	}
	if(tiendas==''){
		alert('Seleccione una Tienda');
		return false;
	}
	var temp1=0;
	var temp2=0;

	if(document.form1.rdoc.value=='2'){
		for(var i=0;i<document.form1.Salidas.length;i++){
			if(document.form1.Salidas[i].checked){
				temp1=1;
			}
		}
	}
	
	if(temp1==0){
		alert('Seleccione una Documeto');
		return false
	}
	return true;
}


jQuery(document).bind('keydown', 'return',function (evt){jQuery('#_return').addClass('dirty'); 

  	cambiar_enfoque(document.activeElement);
		
return false; });

function cambiar_enfoque(control){
	
	if(control.name=='fecha1'){
	document.form1.fecha2.focus();
	document.form1.fecha2.select();
	}
	
	if(control.name=='fecha2'){
	document.form1.fecha2.blur();
	document.form1.sucursal.focus();

	}
	if(control.name=='sucursal'){
	document.form1.cmbmov.focus();
    }
	if(control.name=='cmbmov'){
	document.form1.cmbformato.focus();
	}
	if(control.name=='cmbformato'){
	document.form1.cmbPres.focus();
	}
	if(control.name=='cmbPres'){
	document.form1.cmbValor.focus();
	}
	if(control.name=='cmbValor'){
	document.form1.chkagr_cla.focus();
	document.form1.chkagr_cla.select();
	}
	if(control.name=='chkAgruparClasificacion'){
	document.form1.cboclasifica.focus();
	}
	if(control.name=='cboclasifica'){
	document.form1.chkAgruparCat.focus();
	}
	if(control.name=='chkAgruparCategoria'){
	document.form1.cbocateg.focus();
	}
	if(control.name=='cbocateg'){
	document.form1.chkAgruparSub.focus();
	}
	if(control.name=='chkAgruparSubCategoria'){
	document.form1.cbosubcateg.focus();
	}
	//if(control.name=='cbocateg'){
	//document.form1.tblIn.focus();
	//}
   if(control.name=='cbosubcateg'){
	document.form1.cmbordenar.focus();
	}
	

}


function marcar(control){
	if (control.name=='GrupoOpciones1'){
		if(document.form1.rdoc.value=="2"){
			if(document.form1.GrupoOpciones1[0].checked){
				for(var i=0;i<document.form1.Salidas.length;i++){
			 		document.form1.Salidas[i].checked=true;
			 	}
			}else{
				for(var i=0;i<document.form1.Salidas.length;i++){
			 		document.form1.Salidas[i].checked=false;
				}
			}
		}
	}else{
		/*if(control.name=='TodosS'){
			document.form1.sucursal.disabled=control.checked;
			document.form1.TodosA.checked=control.checked;
			document.form1.almacen.disabled=control.checked;
		}else{
			if(control.name=='TodosA'){
				if(document.form1.TodosS.checked==true){
					control.checked=true;
				}
				document.form1.almacen.disabled=control.checked;
			}
		}*/
	}
}
function enviarFrm(){
if(validar_form(document.form1)){	
	chkSalidas="";
	var fecha1=document.form1.fecha1.value;
	var fecha2=document.form1.fecha2.value;
	if(document.form1.rdoc.value=='2'){
		if(document.form1.Salidas.length==undefined){
			chkSalidas=document.form1.Salidas.value;
		}else{
			for(var i=0;i<document.form1.Salidas.length;i++){
				if (document.form1.Salidas[i].checked==true){
					chkSalidas+=document.form1.Salidas[i].value+'|';
				}
			}
		}
	}
	imprimir="";
	for(var j=0;j<document.form1.imprimir.length;j++){
		if (document.form1.imprimir[j].checked==true){
			imprimir=document.form1.imprimir[j].value;
		 }
	}
	sucursal=document.form1.sucursal.value;
	var tiendas='';
	try{
		for(var i=0;i<document.form1.Tienda.length;i++){
			if(document.form1.Tienda[i].checked){
				tiendas=document.form1.Tienda[i].value+"|"+tiendas;
			}
		}
	}catch(e){
		if(document.form1.Tienda.checked){
			tiendas=document.form1.Tienda.value+"|";
		}
	}
	var mostrar=document.form1.cbomostrar.value;
	var clasificacion='0';
	var categoria='0';
	var subcategoria='0';
	if(document.form1.clasificacion.checked){
		clasificacion=document.form1.cboclasificacion.value;
	}
	if(document.form1.categoria.checked){
		categoria=document.form1.cbocategoria.value;
	}
	if(document.form1.subcategoria.checked){
		subcategoria=document.form1.cbosubcategoria.value;
	}
	var orden=document.form1.cboorden.value;
	var cant=document.form1.cantmostrar.value;
	htmlreporte="?chkSalidas="+chkSalidas+"&imprimir="+imprimir+"&fecha1="+fecha1+"&fecha2="+fecha2+"&sucursal="+sucursal+"&tiendas="+tiendas+"&clasificacion="+clasificacion+"&categoria="+categoria+"&subcategoria="+subcategoria+"&orden="+orden+"&mostrar="+mostrar+"&cant="+cant;
	if(document.form1.excel.value=='S'){
		htmlreporte=htmlreporte+"&excel";
	}
	/*document.form1.action="rpt_prodmasvend.php?clasificacion="+clasificacion;
	document.form1.submit();		*/
	location.href="rpt_prodmasvend.php"+htmlreporte;
}
}

function enviarExcel(){
	if(validar_form(document.form1)){
    	document.form1.excel.value="S";
		enviarFrm();
	}
	document.form1.excel.value="N";
}

function cargar_cbo(texto){
	//alert(texto);
	var r = texto;
	document.getElementById('cbo_tienda').innerHTML=r;
	doAjax('../lista_doc.php','&mostrar=docu&tdoc=2','cargar_cbo3','get','0','1','','');
	//doAjax('../lista_doc.php','&tdoc='+document.form1.rdoc.value,'cargar_lista','get','0','1','','');
}
function cargar_cbo3(texto){
	document.getElementById('cbo_doc').innerHTML=texto;
}
function cargar_lista(texto){
	var r = texto;
	document.getElementById('rldoc').innerHTML=r;
}

function borrarOption(){

//alert(document.form1.cmbValor.options.length);
		
		
		if(document.form1.cmbformato.value=='D' && document.form1.cmbPres.value=='V' && document.form1.cmbValor.options.length==3 ){				
				
		// Aadir item a combos y listas (Moneda Origen)
			/*var opt = document.form1.cmbValor.options; 
			opt[opt.length] = new Option("Moneda origen","Origen"); */
		}else{
			if(document.form1.cmbformato.value!='D' || document.form1.cmbPres.value!='V' && document.form1.cmbValor.options.length==4 ){		
		
			//Quitar items de combos y listas (Moneda Origen)
			/*var aBorrar = document.form1.cmbValor.options[3];
			aBorrar.parentNode.removeChild(aBorrar);*/
			}
		
		}
	
}

</script>


<style type="text/css">

body {
 /*	background-image: url(imagenes/bg3.jpg); */
}

</style>




<link href="../styles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>


<style type="text/css">
<!--
body {
	background-image: url(../imagenes/bg3.jpg);
}
.Estilo001 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #333333;
	font-weight: bold;
}
.Estilo12 {
	font-size: 11px;
	font-family: Arial, Helvetica, sans-serif;
	color: #000000;
}
.Estilo16 {color: #FFFFFF; font-weight: bold; font-size: 11px; font-family: Arial, Helvetica, sans-serif; }
.Estilo24 {color: #FFFFFF; font-weight: bold; font-family: Arial; }
.Estilo25 {
	font-family: Arial, Helvetica, sans-serif;
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo27 {color: #000000}
.Estilo28 {color: #0033FF}
-->
</style>
</head>
<body onLoad="iniciar();">

<table width="807" height="203" border="0" align="left"  cellpadding="0" cellspacing="0">
<tr>
       <td height="27" colspan="3" style="background:url(../imagenes/white-top-bottom.gif); border:#999999"><span class="Estilo001">Log&iacute;stica :: <?php echo $titulo;?> </span>         </tr>
  <tr>
    <td width="800" valign="top">
	
	<form id="form1" name="form1" method="post" action="" >
	<table width="659" border="0" cellpadding="0" cellspacing="0" bordercolor="#3300FF">
		<tr>
			<td colspan="2">&nbsp;</td>
			<td colspan="2">&nbsp;</td>
		  </tr>
        <tr>
    		<td colspan="2">Empresa:&nbsp;&nbsp;<select style="width:160"  name="sucursal" onChange="doAjax('../lista_doc.php','&mostrar=tiendas&valor='+document.form1.sucursal.value,'cargar_cbo','get','0','1','','');" >
				<?php 
				$resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn); 
				$k=0;
				while($row1=mysql_fetch_array($resultados1)){?>
					<option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
				<?php }?>
			</select>
   		    <input name="sucursal2" type="hidden" size="3" value="0" /></td>
    		<td colspan="2">Seleccionar Documentos de VENTAS: <input type="hidden" name="rdoc" id="rdoc" value="2"></td>
   		  </tr>    
        <tr>
			<td height="75" colspan="2" align="center" valign="top"><span class="Estilo15"><div id="cbo_tienda"></div>
		    </span><br></td>
			<td colspan="2" valign="top" align="center"><span class="Estilo15"><div id="cbo_doc"></div></span><br></td>
		  </tr>
        <tr>
          <td height="25" colspan="2">Filtro/Agrupacion de Productos:</td>
          <td height="25" colspan="3">Ordenar Por:
            <select name="cboorden" id="cboorden">
              <option value="cod_prod">C&oacute;d. de Producto</option>
              <option value="cod_anexo">C&oacute;d. Especial</option>
              <option value="nom_prod">Nombre de Producto</option>
              <option value="mayor" selected>De MAYOR a Menor</option>
              <option value="menor">De MENOR a Mayor</option>
            </select>&nbsp;</td>
          </tr>
        <tr>
          <td width="128" height="34"><input type="checkbox" name="clasificacion" id="clasificacion" onClick="Activar(this)">Filtro x Clasificaci&oacute;n:            </td>
          <td width="230"><select name="cboclasificacion" id="cboclasificacion" disabled>
          <option value="0">-------------------------</option>
            <?php $cclasi="Select idclasificacion,substr(des_clas,1,30) from clasificacion order by idclasificacion";
		  $rsclasi=mysql_query($cclasi,$cn);
		  while($rwclasi=mysql_fetch_array($rsclasi)){
			echo "<option value='".$rwclasi[0]."'>".$rwclasi[1]."</option>";
		  }?>
          </select>
&nbsp;</td>
          <td height="34" colspan="2">Rango de Fechas:</td>
          </tr>
		<tr>
		  <td height="31"><input type="checkbox" name="categoria" id="categoria" onClick="Activar(this)">Filtro x Categoria:
		    &nbsp;</td>
		  <td height="31"><select name="cbocategoria" id="cbocategoria" disabled>
          <option value="0">-------------------------</option>
		    <?php $ccate="Select idcategoria,substr(des_cat,1,30) from categoria order by des_cat";
		  $rscate=mysql_query($ccate,$cn);
		  while($rwcate=mysql_fetch_array($rscate)){
			echo "<option value='".$rwcate[0]."'>".$rwcate[1]."</option>";
		  }?>
		    </select></td>
		  <td colspan="2" align="center" valign="top"><span class="Estilo27">Desde</span>
              <input name="fecha1" value="<?php echo date('d-m-Y')?>" type="text" id="fecha1" size="12" />
              <button type="reset" style="height:18px" id="f_trigger_b3" >...</button>
              <span class="Estilo27">Hasta</span>
              <input name="fecha2" value="<?php echo date('d-m-Y')?>"type="text" id="fecha2" size="12" />
              <button type="reset" style="height:18px" id="f_trigger_b2" >...</button>
            </td>
            <script type="text/javascript">
				Calendar.setup({
					inputField     :    "fecha1",      
					ifFormat       :    "%d-%m-%Y",      
					showsTime      :    true,            
					button         :    "f_trigger_b3",   
					singleClick    :    true,           
					step           :    1                
				});
		        </script>
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
		  </tr>
		<tr>
		  <td height="31"><input type="checkbox" name="subcategoria" id="subcategoria" onClick="Activar(this)">Filtro x SubCategoria:		    </td>
		  <td height="31"><select name="cbosubcategoria" id="cbosubcategoria" disabled>
          <option value="0">-------------------------</option>
		    <?php $cscate="Select idsubcategoria,substr(des_subcateg,1,30) from subcategoria order by des_subcateg";
		  $rsscate=mysql_query($cscate,$cn);
		  while($rwscate=mysql_fetch_array($rsscate)){
			echo "<option value='".$rwscate[0]."'>".$rwscate[1]."</option>";
		  }?>
		    </select>
&nbsp;</td>
		  <td colspan="3">Imprimir:&nbsp;&nbsp; 
		    <input type="radio" name="imprimir" checked value="cod_prod" id="imprimir">
		    Cod.Sistema&nbsp;&nbsp;
		    <input type="radio" name="imprimir" value="cod_anexo" id="imprimir">
		    Cod.Anexo&nbsp;&nbsp;</td>
		  </tr>
		<tr>
			<td colspan="5">&nbsp;</td>
		  </tr>

<tr>
	<td colspan="2">Mostrar:&nbsp;&nbsp;<select name="cbomostrar" id="cbomostrar"><option value="mas">Mas Vendidos</option><option value="menos">Menos Vendidos</option></select>&nbsp;&nbsp;<input type="text" value="20" name="cantmostrar" id="cantmostrar" size="3" maxlength="3" style="height:18px"></td>
    <td width="96" colspan="-2" align="center"><span class="Estilo27"></span>	  <div align="center"><input type="button" name="vista" id="vista" value="Vista" onClick="enviarFrm()" >
      <input type="hidden" value="N"  id="excel" name="excel">
    </div>	  <span class="Estilo27"><label></label></span></td>
    <td width="198" align="center"><table onClick="enviarExcel()"  style="cursor:pointer"  width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center"><img  src="../imagenes/ico-excel.gif" width="22" height="22"></td>
      </tr>
      <tr>
        <td align="center"><span class="Estilo9 Estilo13">Exportar a Excel</span></td>
      </tr>
    </table></td>
	<td width="7" colspan="-2" >&nbsp;</td>
	</tr>
    		</table>
</form>
    	</td>
  	</tr>
</table>
</body>
</html>