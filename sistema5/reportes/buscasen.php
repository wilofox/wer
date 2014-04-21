<?php  include('../conex_inicial.php'); ?>

<script language="javascript" src="miAJAXlib2.js"></script>
<script src="../jquery-1.2.6.js"></script>
<script src="../jquery.hotkeys.js"></script>
<script src="../mootools-comprimido-1.11.js"></script>

<script>
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
	if(document.form1.rdoc.value=='1'){
		for(var i=0;i<document.form1.Ingresos.length;i++){
			if(document.form1.Ingresos[i].checked){
				temp1=1;
			}
		}
	}else{
		if(document.form1.rdoc.value=='2'){
			for(var i=0;i<document.form1.Salidas.length;i++){
				if(document.form1.Salidas[i].checked){
					temp1=1;
				}
			}
		}else{
			for(var i=0;i<document.form1.Todos.length;i++){
				if(document.form1.Todos[i].checked){
					temp1=1;
				}
			}
		}
	}
	
	if(temp1==0){
		alert('Seleccione una Documeto');
		return false
	}
	if(document.form1.buscar.value==''){
		alert('Ingresar codigo/Frase a Buscar');
		return false;
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
		if(document.form1.rdoc.value=="1"){
			if(document.form1.GrupoOpciones1[0].checked){
				for(var i=0;i<document.form1.Ingresos.length;i++){
					document.form1.Ingresos[i].checked=true;
				}	
			}else{
				for(var i=0;i<document.form1.Ingresos.length;i++){
					document.form1.Ingresos[i].checked=false;
				}		
			}
		}else{
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
			}else{
				if(document.form1.GrupoOpciones1[0].checked){
					for(var i=0;i<document.form1.Todos.length;i++){
				 		document.form1.Todos[i].checked=true;
				 	}
				}else{
					for(var i=0;i<document.form1.Todos.length;i++){
				 		document.form1.Todos[i].checked=false;
					}
				}
			}
		}
	}else{
		if(control.name=='TodosS'){
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
		}
	}
}
function enviarFrm(){
if(validar_form(document.form1)){	
	var fecha1=document.form1.fecha1.value;
	var fecha2=document.form1.fecha2.value;
	var factor=document.form1.factor.value;
	
	var chkIngresos='';
	var chkSalidas='';
	var chkTodos='';
	
	if(document.form1.rdoc.value=='1'){
		if(document.form1.Ingresos.length==undefined){
			chkIngresos=document.form1.Ingresos.value;
		}else{
			for(var i=0;i<document.form1.Ingresos.length;i++){
				if (document.form1.Ingresos[i].checked==true){
					chkIngresos+=document.form1.Ingresos[i].value+'|';
				}
			}
		}
	}else{
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
		}else{
			if(document.form1.Todos.length==undefined){
				chkTodos=document.form1.Todos.value;
			}else{
				for(var i=0;i<document.form1.Todos.length;i++){
					if (document.form1.Todos[i].checked==true){
						chkTodos+=document.form1.Todos[i].value+'|';
		 			}
				}
			}
		}
	}
	buscarpor="";
	for(var j=0;j<document.form1.radiobutton.length;j++){
		if (document.form1.radiobutton[j].checked==true){
			buscarpor=document.form1.radiobutton[j].value;
		 }
	}
	valor=document.form1.buscar.value;
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
	if(document.form1.excel.value=='S'){
		htmlreporte="?chkTodos="+chkTodos+"&chkIngresos="+chkIngresos+"&chkSalidas="+chkSalidas+"&buscarpor="+buscarpor+"&fecha1="+fecha1+"&fecha2="+fecha2+"&valor="+valor+"&sucursal="+sucursal+"&almacen="+almacen+"&excel='S'&factor="+factor;
	}else{
		htmlreporte="?chkTodos="+chkTodos+"&chkIngresos="+chkIngresos+"&chkSalidas="+chkSalidas+"&buscarpor="+buscarpor+"&fecha1="+fecha1+"&fecha2="+fecha2+"&valor="+valor+"&sucursal="+sucursal+"&almacen="+almacen+"&factor="+factor;
	}
	document.form1.action="rpt_buscasen.php"+htmlreporte;
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

<html>
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
.Estilo30 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #003366; font-weight: bold; }
.Estilo31 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>
<body onLoad="iniciar();">
<table width="804" border="0" cellpadding="0" cellspacing="0">
   <tr  style="background:url(../imagenes/white-top-bottom.gif)">
     <td width="844" height="27" colspan="11" style="border:#999999">
	  <span class="Estilo30">Log&iacute;stica :: B&uacute;squeda Sensitiva Detalle<span class="Estilo31">
	  <input name="auxiliar" type="hidden" id="auxiliar" value="<?php echo $tipo_aux; ?>">
     </span></span>	  </td>
  </tr>
  <tr>
    <td><table width="700" height="203" border="0" align="left"  cellpadding="0" cellspacing="0" style="padding:15px 0 0 25px;">
      <tr>
        <td valign="top"><form id="form1" name="form1" method="post" action="" >
            <table width="396" border="0" cellpadding="0" cellspacing="0" bordercolor="#3300FF" style="position:relative; float:left;">
              <tr>
                <td colspan="5">&nbsp;</td>
              </tr>
              <tr>
                <td width="92">Empresa: </td>
                <td colspan="2"><select style="width:160"  name="sucursal" onChange="doAjax('../carga_cbo_tienda.php','&codsuc='+document.form1.sucursal.value,'cargar_cbo','get','0','1','','');" >
                    <option value="0"></option>
                    <?php 
				$resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn); 
				$k=0;
				while($row1=mysql_fetch_array($resultados1)){?>
                    <option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
                    <?php }?>
                </select></td>
                <td colspan="2"><input name="sucursal2" type="hidden" size="3" value="0" />
                    <input type="checkbox" name="TodosS" onClick="marcar(this)">
                  Todos</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td colspan="4">&nbsp;</td>
              </tr>
              <tr>
                <td><span class="Estilo14">Tienda</span>
                    <input name="almacen2" type="hidden" size="3"  value="0"/></td>
                <td colspan="2"><span class="Estilo15">
                  <div id="cbo_tienda">
                    <select  style="width:160" name="almacen"  onBlur="">
                      <option value="0"></option>
                    </select>
                  </div>
                </span></td>
                <td colspan="2"><span class="Estilo15">
                  <input type="checkbox" name="TodosA" onClick="marcar(this)">
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
                    <input name="fecha1" value="<?php echo date('d-m-Y')?>" type="text" id="fecha1"     size="12" />
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
                <td height="29"><span class="Estilo27">Factor:</span></td>
                <td colspan="4"><select name="factor" id="factor">
                  <option value="0" selected>Todos</option>
                  <option value="1">Factor 1000</option>
                </select>
                </td>
              </tr>
              <tr>
                <td><span class="Estilo27">Buscar por:</span></td>
                <td width="71"><span class="Estilo27">
                  <input name="radiobutton" style="background:none; border:none" type="radio" class="text7" value="Cod.Sist." checked>
                  Cod.Prod</span></td>
                <td width="89"><span class="Estilo27">
                  <input name="radiobutton" style="background:none; border:none" type="radio" value="Cod.Anex.">
                  Cod. Anexo </span></td>
                <td width="80"><span class="Estilo27">
                  <input name="radiobutton" style="background:none; border:none" type="radio" class="text7" value="Descripcion">
                  Descripcion</span></td>
                <td width="60"><span class="Estilo27">
                  <input name="radiobutton" style="background:none; border:none" type="radio" value="Notas">
                  Notas </span></td>
                <td colspan="3">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="8" align="center">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="8" align="center"><input type="text" name="buscar" id="buscar" value="" style="width:300"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td colspan="4">&nbsp;</td>
              </tr>
              <tr>
              </table>
          <table style="position:relative; float:left; width:auto; height:auto; ">
              <tr>
                <td>Documentos de :</td>
                <td colspan="4"><select name="rdoc" id="rdoc" onChange="doAjax('../lista_doc.php','&tdoc='+document.form1.rdoc.value+'&mostrar=docu','cargar_lista','get','0','1','','');" style="width:130px">
                    <option value="1">Compras</option>
                    <option value="2">Ventas</option>
                    <option value="0" selected>Compra/Venta</option>
                </select></td>
              </tr>
              <tr>
                <td colspan="5" align="center"><div id="rldoc">
                    <table border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><fieldset>
                          <br>
                          <legend>Selecci&oacute;n de documentos</legend>
                          <table width="250px" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="125"><div style="overflow-y:scroll;height:110px">
                                  <table  id="tblIn" border="0" cellspacing="1" cellpadding="1">
                                    <tr>
                                      <td width="32" align="center" bgcolor="#0066CC"><span class="Estilo24">ok</span></td>
                                      <td width="38" align="center" bgcolor="#0066CC"><span class="Estilo24">CD</span></td>
                                      <td width="194" bgcolor="#0066CC"><span class="Estilo25">Descripcion</span></td>
                                    </tr>
                                    <?php 
							$strSQl="select * from operacion";
							$resultado=mysql_query($strSQl,$cn);
							while($row=mysql_fetch_array($resultado)){?>
                                    <tr>
                                      <td height="20" align="center" bgcolor="#F5F5F5"><input name="chkTodos[]" id="Todos" type="checkbox" style="background:none; border:none" value="<?php echo $row['codigo']?>"/></td>
                                      <td align="center" bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row['codigo']?></span></td>
                                      <td bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row['descripcion']?></span></td>
                                    </tr>
                                    <?php }?>
                                  </table>
                              </div></td>
                            </tr>
                          </table>
                        </fieldset></td>
                      </tr>
                      <tr>
                        <td><input id="GrupoOpciones1" name="GrupoOpciones1"  style="background:none; border:none"  type="radio" value="todos"  onClick="marcar(this)">
                          Marcar todos
                          <input id="GrupoOpciones1" name="GrupoOpciones1" style="background:none; border:none" checked="checked" type="radio" value="ninguno"  onClick="marcar(this)">
                          Desmarcar todos </td>
                      </tr>
                    </table>
                </div></td>
              </tr>
              <tr>
                <td>    
              </tr>
              <tr>
                <td>    
              </tr>
              <tr>
                <td colspan="5" align="center"><span class="Estilo27"></span>
                    <div align="center">
                      <input type="button" name="vista" id="vista" value="Vista" onClick="enviarFrm()" >
&nbsp; <img style="cursor:pointer" onClick="enviarExcel();" src="../imagenes/ico-excel.gif" width="20" height="20"> 
                    </div></td>
                <!--<td colspan="2"><table onClick="enviarExcel()"  style="cursor:pointer"  width="100%" border="0" cellpadding="0" cellspacing="0">
	  <tr>
	    <td align="center"><img  src="../imagenes/ico-excel.gif" width="22" height="22"></td>
	    </tr>
	  <tr>
	    <td align="center"><span class="Estilo9 Estilo13">Exportar a Excel</span>
	      </td>
	    </tr>
	  </table></td>-->
                <td width="4"><span class="Estilo27">
                  <label></label>
                  </span>
                    <input type="hidden" value="N"  id="excel" name="excel"></td>
              </tr>
            </table>
        </form></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>