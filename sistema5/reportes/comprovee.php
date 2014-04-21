<?php 
	session_start();
	include('../conex_inicial.php');
	if($_REQUEST['tipo']=='1'){
		$tcl=" tipo_aux in ('P','A')";
	}else{
		$tcl=" tipo_aux in ('C','A')";
	}
	//$_SESSION['reg']=0;
?>


<html>
	<script language="javascript" src="miAJAXlib2.js"></script>
    <script src="../jquery-1.2.6.js"></script>
    <script src="../jquery.hotkeys.js"></script>
	<script src="../mootools-comprimido-1.11.js"></script>


<script>
var tipo="<?php echo $_REQUEST['tipo']?>";
function Guarda(){
	var temp1=0;
	var docRk ='';
	
	for(var i=0;i<document.form1.Ingresos.length;i++){	
		if(document.form1.Ingresos[i].checked){
		docRk+=document.form1.Ingresos[i].value+',';
		temp1=1;
		}		
	}
//alert(docRk);
			
	if(temp1==0){
	alert('Seleccione Documento');
	return false
	}
	//var tipo=document.form1.tipo.value;
	if(tipo=="1"){
	var rep="REGISTRO_COMPRAS";
	}else{
	var rep="REGISTRO_VENTAS";
	}
    //if(confirm("Seguro de Aceptar configuración")){
	//alert(docRk+" "+rep);
			//document.form1.carga.value="S";
			doAjax('../reportes/documentos.php','&docRk='+docRk+"&reporte="+rep,'','get','0','1','','');
			document.getElementById('docincluir').style.visibility='hidden';
	//}
}


function salir(){

	if (document.getElementById('docincluir').style.visibility=='visible'){
	document.getElementById('docincluir').style.visibility='hidden';
	}
	
}

function validartecla2(e,valor,temp){
	if(document.getElementById(temp).style.visibility!='visible' ){
		//temp_busqueda2=document.form1.busqueda2.value;
		//alert(temp_busqueda2);
	document.form1.carga.value="S";
	//var tipo=document.form1.tipo.value;
	if(tipo=="1"){
	var rep="REGISTRO_COMPRAS";
	}else{
	var rep="REGISTRO_VENTAS";
	}
doAjax('../reportes/documentos.php','&temp='+temp+'&tipo='+tipo+"&reporte="+rep,'listadocumentos','get','0','1','','');
	
	}
}
function listadocumentos(texto){
	var r = texto;
	document.getElementById('docincluir').innerHTML=r;
	//document.getElementById('docincluir').rows[0].style.background='#fff1bb';
	document.getElementById('docincluir').style.visibility='visible';

}

function marcar(){
	
	if(document.form1.GrupoOpciones1[0].checked){
		for(var i=0;i<document.form1.Ingresos.length;i++){
		document.form1.Ingresos[i].checked=true;
		}	
	}else{
			for(var i=0;i<document.form1.Ingresos.length;i++){
			document.form1.Ingresos[i].checked=false;
			}		
	}
}

function cargarproducto(pagina){
//alert('df');
cancel_peticion();
var valor=document.form1.sucursal.value;
//var criterio=document.form1.criterio.value;
doAjax('tiendas.php','valor='+valor,'detalle_prod','get','0','1','','');
//document.form1.submit();
}
function detalle_prod(texto){
//alert(texto);
var r = texto.split('?');
document.getElementById('detalle').innerHTML=r[0];
//document.form1.carga.value='N';
document.getElementById('paginacion').innerHTML=r[1];
}


function iniciar(){

document.form1.fecha1.focus();
document.form1.fecha1.select();
if(document.form1.TodosS.checked){
	document.form1.sucursal.disabled;
	document.form1.TodosA.checked=true;
	document.form1.almacen.disabled;
}else{
	if(document.form1.TodosA.checked){
		document.form1.almacen.disabled;
	}else{
		if(document.form1.sucursal.value!='0'){
			doAjax('../carga_cbo_tienda.php','&codsuc='+document.form1.sucursal.value,'cargar_cbo','get','0','1','','');
		}
	}
}
}

	function cargartiendas(){
	
	var sucursal=document.form1.sucursal.value;
	
	doAjax('tiendas.php','valor='+sucursal,'lista_tiendas','get','0','1','','');
	
	
	}
	
	function lista_tiendas(datos){
	
	document.getElementById('tiendas').innerHTML=datos;
	
	}

function validar_form(){	 
	var fecha1=document.form1.fecha1.value;		 
	var fecha2=document.form1.fecha2.value;	
	var sucursal='';
	var tienda='';
	if(document.form1.TodosS.checked){
		sucursal='T';
		tienda='T';
	}else{
		if(document.form1.TodosA.checked){
			sucursal=document.form1.sucursal.value;
			tienda='T';
		}else{
			sucursal=document.form1.sucursal.value;
			tienda=document.form1.almacen.value;
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
	if(tienda=='0'){
		alert('Seleccione una Tienda');
		return false;
	}
	var temp1=0;
	var temp2=0;
	//alert(document.form1.chkTodos.length);
	//alert(document.getElementById('tblIn').childNodes[0].childNodes[1].childNodes[0].innerHTML);
	if(document.form1.chkTodos.length==undefined){
		if(document.form1.chkTodos.checked){
			temp1=1;
		}
	}else{
		for(var i=0;i<document.form1.chkTodos.length;i++){
			if(document.form1.chkTodos[i].checked){
				temp1=1;
			}
		}
	}
	if(temp1==0){
		if(tipo=='1'){
			alert('Seleccione Proveedor');
		}else{
			alert('Seleccione Cliente');
		}
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


function marcar_d(control){
	if (control.name=='GrupoOpciones12'){
		if(document.form1.GrupoOpciones12[0].checked){
			for(var i=0;i<document.form1.Todos.length;i++){
		 		document.form1.Todos[i].checked=true;
		 	}
		}else{
			for(var i=0;i<document.form1.Todos.length;i++){
		 		document.form1.Todos[i].checked=false;
			}
		}
	}else{
		switch(control.name){
			case 'TodosS': 
				document.form1.sucursal.disabled=control.checked;
				document.form1.TodosA.checked=control.checked;
				document.form1.almacen.disabled=control.checked;break;
			case 'TodosA':
				if(document.form1.TodosS.checked==true){
					control.checked=true;
				}
				document.form1.almacen.disabled=control.checked;break;
			case 'radiobutton':break;	
		}
	}
}
function enviarFrm(){
if(validar_form(document.form1)){	
	var fecha1=document.form1.fecha1.value;
	var fecha2=document.form1.fecha2.value;

	var chkTodos='';
	if(document.form1.chkTodos.length==undefined){
		chkTodos=document.form1.chkTodos.value;
	}else{
		for(var i=0;i<document.form1.chkTodos.length;i++){
			if (document.form1.chkTodos[i].checked==true){
				chkTodos+=document.form1.chkTodos[i].value+'|';
			}
		}
	}
	if(document.form1.TodosS.checked){
		sucursal="T";
		almacen="T";
	}else{
		if(document.form1.TodosA.checked){
			sucursal=document.form1.sucursal.value;
			almacen="T";
		}else{
			sucursal=document.form1.sucursal.value;
			almacen=document.form1.almacen.value;
		}
	}
	var mostrar='';
	var treporte='';
	for(var j=0;j<document.form1.radiobutton.length;j++){
		if (document.form1.radiobutton[j].checked==true){
			treporte=document.form1.radiobutton[j].value;
		}
	}
	for(var k=0;k<document.form1.radiobutton2.length;k++){
		if (document.form1.radiobutton2[k].checked==true){
			mostrar=document.form1.radiobutton2[k].value;
		}
	}
	var moneda=document.form1.cmbMoneda.value;
	var monto=document.form1.cmbImporte.value;
	//alert(tipo);
	if(document.form1.excel.value=='S'){
		htmlreporte="?auxiliar="+chkTodos+"&mostrar="+mostrar+"&treporte="+treporte+"&moneda="+moneda+"&fecha1="+fecha1+"&fecha2="+fecha2+"&monto="+monto+"&tipo="+tipo+"&sucursal="+sucursal+"&almacen="+almacen+"&excel=S";
	}else{
		htmlreporte="?auxiliar="+chkTodos+"&mostrar="+mostrar+"&treporte="+treporte+"&moneda="+moneda+"&fecha1="+fecha1+"&fecha2="+fecha2+"&monto="+monto+"&tipo="+tipo+"&sucursal="+sucursal+"&almacen="+almacen;
	}
	//alert("rpt_comprovee.php"+htmlreporte);
	if(treporte=='Detallado'){
		document.form1.action="rpt_comprovee.php"+htmlreporte;
	}else{
		document.form1.action="rpt_comprovee_cons.php"+htmlreporte;
	}
	document.form1.submit();
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
	var r = texto;
	document.getElementById('cbo_tienda').innerHTML=r;
	//doAjax('../lista_doc.php','&tdoc='+document.form1.rdoc.value,'cargar_lista','get','0','1','','');
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
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #333333;
	font-weight: bold;
}
.Estilo24 {color: #FFFFFF; font-weight: bold; font-family: Arial; }
.Estilo25 {
	font-family: Arial, Helvetica, sans-serif;
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo27 {color: #000000}
.Estilo32 {
	font-family: Arial, Helvetica, sans-serif;
	color: #003366;
}
-->
</style>
<body onLoad="iniciar();">
<form id="form1" name="form1" method="post" action="" >
<table width="416" height="203" border="0" align="left"  cellpadding="0" cellspacing="0">
	<tr style="background:url(../imagenes/white-top-bottom.gif)">
		<td width="1033" height="27" colspan="11" style="border:#999999"><span class="Estilo21 Estilo19 Estilo1 Estilo15 text4"><span class="Estilo21 Estilo19 Estilo15  Estilo32"><strong> Log&iacute;stica :: Compras por Proveedor<input name="auxiliar" type="hidden" id="auxiliar" value="<?php echo $tipo_aux; ?>"></strong></span></span></td>
	</tr>
	<tr>
		<td width="416" valign="top">
		<table width="396" border="0" cellpadding="0" cellspacing="0" bordercolor="#3300FF">
			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>
			<tr>
				<td width="91">Empresa: </td>
				<td><select style="width:160"  name="sucursal" onChange="doAjax('../carga_cbo_tienda.php','&codsuc='+document.form1.sucursal.value,'cargar_cbo','get','0','1','','');" >
					<option value="0"></option>
					<?php 
						$resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn); 
						$k=0;
						while($row1=mysql_fetch_array($resultados1)){?>
							<option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
					<?php }?>
				</select></td>
				<td colspan="3"><input name="sucursal2" type="hidden" size="3" value="0" />
					<input type="checkbox" name="TodosS" onClick="marcar_d(this)">
					Todos</td>
			</tr>    
			<tr>
				<td>&nbsp;</td>
				<td colspan="4">&nbsp;</td>
			</tr>
			<tr>
				<td><span class="Estilo14">Tienda</span><input name="almacen2" type="hidden" size="3"  value="0"/></td>
				<td><span class="Estilo15"><div id="cbo_tienda">
                	<select  style="width:160" name="almacen"  onBlur="">
			    		<option value="0"></option>
			    	</select>
				</div></span></td>
				<td colspan="3"><span class="Estilo15">
				<input type="checkbox" name="TodosA" onClick="marcar_d(this)">
				Todos</span></td>
			</tr>
			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>
			<tr>
				<td height="19" colspan="5"><span class="Estilo1">Rango de Fechas </span></td>
				<td colspan="4" rowspan="2" align="center" valign="middle"><p>
				<p></td>
			</tr>
			<tr>
				<td colspan="5" align="center" valign="middle"><span class="Estilo27">Desde</span>
				<input name="fecha1" value="<?php echo "01-".date('m-Y')?>" type="text" id="fecha1"     size="12" />
				<button type="reset" id="f_trigger_b3" >...</button>
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
				<span class="Estilo27">Hasta</span>
				<input name="fecha2" value="<?php echo date('d-m-Y')?>"type="text" id="fecha2" size="12" />
				<button type="reset" id="f_trigger_b2" >...</button>
					<script type="text/javascript">
						Calendar.setup({
						inputField     :    "fecha2",      
						ifFormat       :    "%d-%m-%Y",      
						showsTime      :    true,            
						button         :    "f_trigger_b2",   
						singleClick    :    true,           
						step           :    1                
					});
					</script></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="4">&nbsp;</td>
			</tr>
			<tr>
				<td><span class="Estilo27">Tipo de Reporte:</span></td>
				<td width="167"><span class="Estilo27"><input name="radiobutton" style="background:none; border:none" type="radio" class="text7" value="Detallado" onClick="marcar_d(this)" checked>Detallado por Doc.</span></td>
				<td width="222"><span class="Estilo27"><input name="radiobutton" style="background:none; border:none" type="radio" value="Consolidado" onClick="marcar_d(this)">Consolidado por prod. </span></td>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="4">&nbsp;</td>
			</tr>
			<tr>
				<td><span class="Estilo27">Mostrar:</span></td>
				<td width="167"><span class="Estilo27"><input name="radiobutton2" style="background:none; border:none" type="radio" class="text7" value="Cod.Sist." checked>Codigo Sistema</span></td>
				<td width="222"><span class="Estilo27"><input name="radiobutton2" style="background:none; border:none" type="radio" value="Cod.Anex.">Codigo Anexo </span></td>
				<td colspan="3">&nbsp;</td>
			</tr>  
			<tr>
				<td>&nbsp;</td>
				<td colspan="4">&nbsp;</td>
			</tr>
			<tr>
				<td><span class="Estilo27">Moneda:</span></td>
				<td><select name="cmbMoneda" id="cmbMoneda">
					<option value="01">Soles</option><option value="02">Dolares</option><option value="00" selected>Origen</option></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Importe:</td>
				<td><select name="cmbImporte" id="cmbImporte">
					<option value="BI">Base Imponible</option><option value="TD" selected>Total Doc.</option></select></td>
				<td colspan="3">&nbsp;</td>
			</tr>  
			<tr>
				<td>&nbsp;</td>
				<td colspan="4">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>(*) Filtro de Documentos				  </td>
				<td width="80"><input onClick="validartecla2(event,this,'docincluir')"  name="btnInc" type="button" id="btnInc" value="   ?   " /></td>
			</tr>
			<tr>
				<td><div id="docincluir" style="position:absolute; left:470px; top:113px; width:302px; height:180px; z-index:2; visibility:hidden"> </div></td>
				<td colspan="4">&nbsp;</td>
			</tr>
			<tr>
				<td>Buscar :</td>
				<td colspan="4"><input type="hidden" name="carga" id="carga" value=""><select name="buscarpor" id="buscarpor" onChange="doAjax('../lista_doc.php','&tbus='+document.form1.buscarpor.value+'&tipoaux='+tipo+'&mostrar=aux','cargar_lista','get','0','1','','');" style="width:100px">
					<option value="razonsocial">Razon Social</option>
					<option value="ruc">Ruc</option>
					<option value="codcliente">Cod.Sist.</option>
				</select>
				<input type="text" name="buscar" id="buscar" value="" onKeyUp="doAjax('../lista_doc.php','&tbus='+document.form1.buscarpor.value+'&valor='+this.value+'&tipoaux='+tipo+'&mostrar=aux','cargar_lista','get','0','1','','');" style="width:200"></td>
			</tr>
			<tr>
				<td colspan="5" align="center"><div id="rldoc">
					<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td><br><legend>Selecci&oacute;n de Proveedor</legend>
							<table width="480px" border="1" cellspacing="0" cellpadding="0">
								<tr>
									<td height="150"><div style="overflow-y:scroll;height:110px">
										<table  id="tblIn" border="0" cellspacing="1" cellpadding="1">
											<tr>
												<td width="32" align="center" bgcolor="#0066CC"><span class="Estilo24">ok</span></td>
												<td width="38" align="center" bgcolor="#0066CC"><span class="Estilo24">Codigo</span></td>
												<td width="300" bgcolor="#0066CC"><span class="Estilo25">Raz&oacute;n Social</span></td>
												<td width="40" bgcolor="#0066CC"><span class="Estilo25">Ruc</span></td>
												<td width="70" bgcolor="#0066CC"><span class="Estilo25">Telefono</span></td>
											</tr>
											<?php 
												$strSQl="select * from cliente where $tcl order by razonsocial";
												$resultado=mysql_query($strSQl,$cn);
												while($row=mysql_fetch_array($resultado)){?>
											<tr>
												<td height="20" align="center" bgcolor="#F5F5F5"><input name="chkTodos[]" id="chkTodos" type="checkbox" style="background:none; border:none" value="<?php echo $row['codcliente']?>"/></td>
												<td align="center" bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row['codcliente']?></span></td>
												<td bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row['razonsocial']?></span></td>
												<td bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row['ruc']?></span></td>
												<td bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row['telefono']?></span></td>
											</tr>
											<?php }?>
										</table>
									</div></td>
								</tr>
							</table>
							</td>
						</tr>
						<tr>
							<td align="center"><input id="GrupoOpciones12" name="GrupoOpciones12"  style="background:none; border:none"  type="radio" value="todos"  onClick="marcar_d(this)"> Marcar todos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input id="GrupoOpciones12" name="GrupoOpciones12" style="background:none; border:none" checked="checked" type="radio" value="ninguno"  onClick="marcar_d(this)"> Desmarcar todos </td>
						</tr>
					</table>
				</div></td>
			</tr>
			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><span class="Estilo27"></span>	  <div align="center"><input type="button" name="vista" id="vista" value="Vista" onClick="enviarFrm()" ></div></td>
				<td colspan="2">
                	<table onClick="enviarExcel()"  style="cursor:pointer"  width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td align="center"><img  src="../imagenes/ico-excel.gif" width="22" height="22"></td>
						</tr>
						<tr>
							<td align="center"><span class="Estilo9 Estilo13">Exportar a Excel</span></td>
						</tr>
					</table>
				</td>
				<td width="17"><span class="Estilo27"><label></label></span><input type="hidden" value="N"  id="excel" name="excel"></td>
			</tr>
		</table><div id="detalle" style="visibility:hidden"></div></td>
  	</tr>
</table>
</form>
</body>
</html>