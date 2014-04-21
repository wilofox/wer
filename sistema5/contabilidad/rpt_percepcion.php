<?php 
	include('../conex_inicial.php');

?>

	<script language="javascript" src="../miAJAXlib2.js"></script>
    <script src="../jquery-1.2.6.js"></script>
    <script src="../jquery.hotkeys.js"></script>
	<script src="../mootools-comprimido-1.11.js"></script>


<script>
function cargarproducto(pagina){
//alert('df');
cancel_peticion();
var valor=document.form1.sucursal.value;
//var criterio=document.form1.criterio.value;
doAjax('../reportes/tiendas.php','valor='+valor,'detalle_prod','get','0','1','','');
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

}

	function cargartiendas(){
	
	var sucursal=document.form1.sucursal.value;
	
	doAjax('../reportes/tiendas.php','valor='+sucursal,'lista_tiendas','get','0','1','','');
	
	
	}
	
	function lista_tiendas(datos){
	
	document.getElementById('tiendas').innerHTML=datos;
	
	}

function validar_form(){	 
		 var fecha1=document.form1.fecha1.value;		 
		  var fecha2=document.form1.fecha2.value;	
		//  var movimiento=document.form1.cmbmov.value;
		 // var presentacion=document.form1.cmbPres.value;
		  var formato=document.form1.cmbformato.value;
		 // var ordenar=document.form1.cmbordenar.value;
		 // var valorizar=document.form1.cmbValor.value;
		  var sucursal=document.form1.sucursal.value;
		  //var tiendas=document.form1.Tiendas;
		  //	alert(document.form1.chk_tiendas.length);			
			
		 if(fecha1==''){
		 alert('Ingrese fecha');
		 return false;
		 }
		 if(fecha2==''){
		 alert('Ingrese fecha');
		 return false;
		 }
		 if(sucursal=='-1'){
		 alert('Seleccione una Sucursal');
		 return false;
		 }
		 ///
		 	var temp1=0;
			if(!isFinite(document.form1.chk_tiendas.length)){
				if(document.form1.chk_tiendas.checked){
					temp1=1;
				}
			}else{
				for(var i=0;i<document.form1.chk_tiendas.length;i++){
					if(document.form1.chk_tiendas[i].checked){
			 			temp1=1;
					}
				}
			}
			if(temp1==0){
			alert('Seleccione una Tienda');
			return false
			}
			
		 ///
		 var temp1=0;
		 var temp2=0;
			for(var i=0;i<document.form1.Ingresos.length;i++){
			if(document.form1.Ingresos[i].checked){
			 temp1=1;
			}
			}
			for(var i=0;i<document.form1.chkSalidas.length;i++){
			if(document.form1.chkSalidas[i].checked){
			 temp2=1;
			}
			}
			
			
			//alert(document.form1.cmbmov.value);
			
		/*	if (document.form1.cmbmov.value=='I'){
				if(temp1==0){
				alert('Seleccione un Documento de Ingreso');
				return false
				}
			}
			if (document.form1.cmbmov.value=='S'){
				if(temp2==0){
				alert('Seleccione un Documento de Salida');
				return false
				}
			}
			if (document.form1.cmbmov.value=='A'){
				if(temp1==0 || temp2==0){ //&&
				alert('Seleccione un Documento de Ingreso y de Salida');
				return false
				}
			}
*/

		
		 ///
		 ///
		 
         
		  if(formato=='-1'){
		 alert('Seleccione el Formato del Reporte');
		 return false;
		 }
		 /*
		 if(presentacion=='-1'){
		 alert('Seleccione la Presentacion del Reporte');
		 return false;
		 }
		 */
		 //ingresos
		 
		/* if(document.form1.cmbmov.value=='1'){
		 
		 var temp2=0;
		 for(var x=0;x<document.form1.Ingresos.length;x++){
		 if(document.form1.Ingresos[x].checked){
		 temp2=1;
		 }
		 }
		 
		 if(temp2==0){
		 alert('Seleccione por lo menos un documento de ingreso');
		 return false
		 }
		 }*/
		 //
		 //salidas
		 
		/* if(document.form1.cmbmov.value=='2'){
		 var temp3=0;
		 for(var y=0;y<document.form1.chkSalidas.length;y++){
		 if(document.form1.chkSalidas[y].checked){
		 temp3=1;
		 }
		 }
		 
		 if(temp3==0){
		 alert('Seleccione por lo menos un documento de salida');
		 return false
		 }
		 //
		}*/
		 
		 /* if(ordenar=='-1'){
		 alert('Seleccione el Item a Ordenar');
		 return false;
		 }*/
		 
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
	
	if(control.name=='cmbmov'){
	document.form1.cmbformato.focus();
	}
	if(control.name=='cmbformato'){
	document.form1.cmbPres.focus();
	}
	/*if(control.name=='cmbPres'){
	document.form1.cmbValor.focus();
	}*/
	
	
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
  /* if(control.name=='cbosubcateg'){
	document.form1.cmbordenar.focus();
	}*/
	

}


function marcar(control){
if (control.name=='GrupoOpciones1'){
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
if (control.name=='GrupoOpciones2'){
	if(document.form1.GrupoOpciones2[0].checked){
		if(!isFinite(document.form1.chk_tiendas.length)){
			document.form1.chk_tiendas.checked=true;
		}else{
		 	for(var i=0;i<document.form1.chk_tiendas.length;i++){
		 		document.form1.chk_tiendas[i].checked=true;
		 	}
		}
    }else{
		if(!isFinite(document.form1.chk_tiendas.length)){
			document.form1.chk_tiendas.checked=false;
		}else{
			for(var i=0;i<document.form1.chk_tiendas.length;i++){
				document.form1.chk_tiendas[i].checked=false;
			}
		}
	}
}	

	if (control.name=='GrupoOpciones3'){
		if(document.form1.GrupoOpciones3[0].checked){
			 for(var i=0;i<document.form1.chkSalidas.length;i++){
			 document.form1.chkSalidas[i].checked=true;
			 }
		}else{
				 for(var i=0;i<document.form1.chkSalidas.length;i++){
				 document.form1.chkSalidas[i].checked=false;
				 }
		}
	}
}
function marcar_chkAgrupar(){
	if(document.form1.chkagr_cla.checked==true){
	 document.form1.agr_cla.value="S";
	}else{
	document.form1.agr_cla.value="N";
	}
	if(document.form1.chkAgruparCat.checked==true){
	document.form1.agr_cat.value="S";
	}else{
	document.form1.agr_cat.value="N";
	}
	if(document.form1.chkAgruparSub.checked==true){
	document.form1.agr_sub.value="S";
	}else{
	document.form1.agr_sub.value="N";
	}
}

function enviarFrm(param,tipo){
var formato=document.form1.cmbformato.value;

	if(validar_form(document.form1)){	
	
//var presentacion=document.form1.cmbPres.value;
//var ordenar=document.form1.cmbordenar.value;
//var valorizar=document.form1.cmbValor.value;		
var fecha1=document.form1.fecha1.value;
var fecha2=document.form1.fecha2.value;

var moneda=document.form1.moneda.value;

var movimiento='I';

var chk_tiendas='';
var chkIngresos='';
var chkSalidas='';

if(document.form1.chk_tiendas.length==undefined){
	chk_tiendas=document.form1.chk_tiendas.value;
}else{
	for(var i=0;i<document.form1.chk_tiendas.length;i++){
		 if (document.form1.chk_tiendas[i].checked==true){
		 //alert(document.form1.chk_tiendas[i].value);
		 chk_tiendas+=document.form1.chk_tiendas[i].value+'|';
	 	}
	}
}
if(document.form1.Ingresos.length==undefined){
	chkIngresos=document.form1.Ingresos.value;
}else{
	for(var i=0;i<document.form1.Ingresos.length;i++){
		if (document.form1.Ingresos[i].checked==true){
		//alert(document.form1.Ingresos[i].value);
		chkIngresos+=document.form1.Ingresos[i].value+'|';
		}
	}
}
if(document.form1.chkSalidas.length==undefined){
	chkSalidas=document.form1.chkSalidas.value;
}else{
	for(var i=0;i<document.form1.chkSalidas.length;i++){
		if (document.form1.chkSalidas[i].checked==true){
		 //alert(document.form1.chkSalidas[i].value);
		 chkSalidas+=document.form1.chkSalidas[i].value+'|';
	 	}
	}
}
//radiobutton=document.form1.radiobutton.value;

sucursal=document.form1.sucursal.value;
//cboclasifica=document.form1.cboclasifica.value;
//cbocateg=document.form1.cbocateg.value;
//cbosubcateg=document.form1.cbosubcateg.value;
//chkAgruparClas=document.form1.chkAgruparClasificacion.value;
//chkAgruparCat=document.form1.chkAgruparCategoria.value;
//chkAgruparSub=document.form1.chkAgruparSubCategoria.value;
//agr_cla=document.form1.agr_cla.value;
//agr_cat=document.form1.agr_cat.value;
//agr_sub=document.form1.agr_sub.value;

htmlreporte="?chk_tiendas="+chk_tiendas+"&chkIngresos="+chkIngresos+"&chkSalidas="+chkSalidas+"&fecha1="+fecha1+"&fecha2="+fecha2+"&cmbformato="+formato+"&sucursal="+sucursal;
var aplicacion=document.form1.aplicacion.value;

if(aplicacion=='2'){

	if(tipo=='1'){
			window.open("det_rpt_percepcion.php?chk_tiendas="+chk_tiendas+"&chkIngresos="+chkIngresos+"&chkSalidas="+chkSalidas+"&fecha1="+fecha1+"&fecha2="+fecha2+"&cmbformato="+formato+"&sucursal="+sucursal+"&cmbmov="+movimiento+"&excel="+param+"&moneda="+moneda+"&aplicacion="+aplicacion,"","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=820, height=620,left=300 top=250");
	}else{
			window.open("det_rpt_percepcion2.php?chk_tiendas="+chk_tiendas+"&chkIngresos="+chkIngresos+"&chkSalidas="+chkSalidas+"&fecha1="+fecha1+"&fecha2="+fecha2+"&cmbformato="+formato+"&sucursal="+sucursal+"&cmbmov="+movimiento+"&excel="+param+"&moneda="+moneda+"&aplicacion="+aplicacion,"","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=820, height=620,left=300 top=250");
	}

}else{

	if(tipo=='1'){
			window.open("det_rpt_percepcionC.php?chk_tiendas="+chk_tiendas+"&chkIngresos="+chkIngresos+"&chkSalidas="+chkSalidas+"&fecha1="+fecha1+"&fecha2="+fecha2+"&cmbformato="+formato+"&sucursal="+sucursal+"&cmbmov="+movimiento+"&excel="+param+"&moneda="+moneda+"&aplicacion="+aplicacion,"","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=820, height=620,left=300 top=250");
	}else{
			window.open("det_rpt_percepcion2.php?chk_tiendas="+chk_tiendas+"&chkIngresos="+chkIngresos+"&chkSalidas="+chkSalidas+"&fecha1="+fecha1+"&fecha2="+fecha2+"&cmbformato="+formato+"&sucursal="+sucursal+"&cmbmov="+movimiento+"&excel="+param+"&moneda="+moneda+"&aplicacion="+aplicacion,"","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=820, height=620,left=300 top=250");
	}


}
		
		
		/*
		if(formato=="C"){
			document.form1.action="rpt_cons_movifecha.php"+htmlreporte;
			document.form1.submit();		
		}else{
		document.form1.action="rpt_det_movifecha.php"+htmlreporte;
			document.form1.submit();	
		}
		*/
	}
}

function enviarExcel(){
var formato=document.form1.cmbformato.value;
	if(validar_form(document.form1)){	
		if(formato=="C"){
		    document.form1.excel.value="S";
			enviarFrm();
			//document.form1.action="rpt_cons_movifecha.php";
			//document.form1.submit();		
		}else{
		 document.form1.excel.value="S";
		 enviarFrm();
		 //document.form1.action="rpt_det_movifecha.php";
		  //document.form1.submit();	
		}
	}
	document.form1.excel.value="N";
}

function borrarOption(){

//alert(document.form1.cmbValor.options.length);
		
		
		//if(document.form1.cmbformato.value=='D' && document.form1.cmbPres.value=='V' && document.form1.cmbValor.options.length==3 ){				
//				
//		// Aadir item a combos y listas (Moneda Origen)
//			/*var opt = document.form1.cmbValor.options; 
//			opt[opt.length] = new Option("Moneda origen","Origen"); */
//		}else{
//			if(document.form1.cmbformato.value!='D' || document.form1.cmbPres.value!='V' && document.form1.cmbValor.options.length==4 ){		
//		
//			//Quitar items de combos y listas (Moneda Origen)
//			/*var aBorrar = document.form1.cmbValor.options[3];
//			aBorrar.parentNode.removeChild(aBorrar);*/
//			}
//		
//		}
	
}



function cambiarDocs(){

var aplicacion=document.form1.aplicacion.value;

doAjax('../compras/peticion_datos.php','peticion=docsRepPercep&aplicacion='+aplicacion,'rpta_cambiarDocs','get','0','1','','');

}

function rpta_cambiarDocs(data){

document.getElementById("capaDocs").innerHTML=data;

}


</script>


<style type="text/css">

body {
 /*	background-image: url(imagenes/bg3.jpg); */
}

</style>


<html>

<link href="../styles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>


<style type="text/css">
<!--
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
.Estilo28 {
	color: #003366;
	font-size: 12;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.Estilo29 {color: #0066FF}
.Estilo30 {color: #0066CC}
-->
</style>
<body onLoad="iniciar();cargartiendas()">

<table width="710" height="203" border="0" align="left"  cellpadding="0" cellspacing="0">
  <tr>
    <td width="710" valign="top">
	
	<form id="form1" name="form1" method="post" action="" >
      <table height="402" border="0" cellpadding="0" cellspacing="0" bordercolor="#3300FF">
	  <tr  style="background:url(../imagenes/white-top-bottom.gif)">
      <td height="24" colspan="11" style="border:#999999">
	  <span class="Estilo21 Estilo19 Estilo1 Estilo15 Estilo28"><strong> Gerencia :: Contabilidad :: Reporte de Percepciones
        <input name="auxiliar" type="hidden" id="auxiliar" value="<?php echo $tipo_aux; ?>">
      </strong></span>	  </td>
    </tr>
        <tr>
          <td height="19" colspan="2" class="Estilo12">Rango de Fechas: </td>
          <td width="399" rowspan="4" align="center" valign="middle">
		  
		  <table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25"><span class="Estilo12">Aplicacion : 
      <select name="aplicacion" id="aplicacion" onChange="cambiarDocs(this)">
        <option value="2" selected>VENTAS</option>
        <option value="1">COMPRAS</option>
      </select>
    </span></td>
  </tr>
  <tr>
    <td height="127"><fieldset>
       <legend><span class="Estilo30">Ddocumentos Salidas </span> </legend>
           
            <table width="250px" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="125"><div id="capaDocs" style="overflow-y:scroll;height:110px">
                  <table  id="tblIn" border="0" cellspacing="1" cellpadding="1">
                    <tr>
                      <td width="32" align="center" bgcolor="#0066CC"><span class="Estilo24">ok</span></td>
                      <td width="38" align="center" bgcolor="#0066CC"><span class="Estilo24">CD</span></td>
                      <td width="194" bgcolor="#0066CC"><span class="Estilo25">Descripcion</span></td>
                    </tr>
                    <?php 
					
					$strSQl="select * from operacion where tipo='2' order by descripcion";
					$resultado=mysql_query($strSQl,$cn);
					while($row=mysql_fetch_array($resultado)){
						
				if(substr($row['codigo'],0,1)=='F' || substr($row['codigo'],0,1)=='B' ){
					$marcar=" checked ";		
				}else{
					$marcar=" ";		
				}
					
					?>
                    <tr>
                      <td height="20" align="center" bgcolor="#F5F5F5">
                      <input name="chkIngresos[]" id="Ingresos" type="checkbox" style="background:none; border:none" value="<?php echo $row['codigo']?>" <?php echo $marcar?> />                      </td>
                      <td align="center" bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row['codigo']?></span></td>
                      <td bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row['descripcion']?></span></td>
                    </tr>
                    <?php 
					  }
					  ?>
                  </table>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
              </div></td>
            </tr>
          </table>
          </fieldset>	</td>
  </tr>
  <tr>
    <td><input id="GrupoOpciones1" name="GrupoOpciones1"  style="background:none; border:none"  type="radio" value="todos"  onClick="marcar(this)">
      Marcar todos
        <input id="GrupoOpciones1" name="GrupoOpciones1" style="background:none; border:none" checked="checked" type="radio" value="ninguno"  onClick="marcar(this)">
        Desmarcar todos </td>
  </tr>
</table>
<br>
		  
                     
            <legend></legend>            <table height="147" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="127"><fieldset>
                  <legend><span class="Estilo30">Condiciones de Pago</span> </legend>
                  <br>
                  <table width="250px" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td>
                        <div style="overflow-y:scroll;height:110px">
                          <table width="" border="0" cellpadding="1" cellspacing="1">
                            <tr>
                              <td width="32" align="center" bgcolor="#0066CC"><span class="Estilo24">ok</span></td>
                            <td width="38" align="center" bgcolor="#0066CC"><span class="Estilo24">CD</span></td>
                            <td width="194" align="center" bgcolor="#0066CC"><span class="Estilo24">Documento</span></td>
                          </tr>
                            <?php
				  $sql="Select * from condicion";
				  $resultado=mysql_query($sql,$cn);
				  while($row=mysql_fetch_array($resultado)){
				  
				  
				  
				  ?>
                            <tr>
                              <td align="center" bgcolor="#F5F5F5"><input style="background:none; border:none" type="checkbox" id ="chkSalidas" name="chkSalidas[]" value="<?php echo $row['codigo']?>" checked></td>
                            <td align="center" bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row['codigo']?></span></td>
                            <td align="left" bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row['nombre']?></span></td>
                          </tr>
                            <?php
				  }
				  ?>
                            </table> 
							<p>&nbsp;</p>
                			<p>&nbsp;</p>
					  </div>					</td>
                    </tr>
                  </table><legend></legend></fieldset></td>
              </tr>
              <tr>
                <td height="20"><input id="GrupoOpciones3" name="GrupoOpciones3"  style="background:none; border:none"  type="radio" value="todos"  onClick="marcar(this)" checked="checked" >
Marcar todos
  <input id="GrupoOpciones3" name="GrupoOpciones3" style="background:none; border:none"type="radio" value="ninguno"  onClick="marcar(this)">
Desmarcar todos </td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td width="168" height="29" align="center" valign="middle"><span class="Estilo27">Desde</span>
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
                  </script></td>
          <td width="143" align="center" valign="middle"><span class="Estilo27">Hasta</span>
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

          <td height="161" colspan="2" align="center" valign="top"><fieldset style="height:90px">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <legend>Tiendas x Sucursal </legend>
            <br>
            <table  width="100" height="67" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="47" valign="top"><span class="Estilo12">Sucursal</span></td>
                <td width="240"><p>
                    <select name="sucursal" id="sucursal" onChange="cargartiendas()" style="width:180px">
                      <!--<option value="-1">-----------------------------</option>-->
                      <?php 
					 				
				$sql="SELECT * FROM sucursal order by cod_suc desc";
				$rs=mysql_query($sql);
				while ($reg=mysql_fetch_array($rs)){
					echo "<option value=".$reg['cod_suc']." selected>".$reg['des_suc']."</option>";
				}
				  ?>
                    </select>
                </p></td>
              </tr>
              <tr>
                <td height="46" colspan="2"><br>
                    <table border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><div style="overflow-y:scroll;height:110px" id="tiendas" >
                            <table width="250px" border="0" cellpadding="1" cellspacing="1">
                              <tr>
                                <td width="61" bgcolor="#0066CC"><span class="Estilo16">ok</span></td>
                                <td width="50" bgcolor="#0066CC"><span class="Estilo16">codigo</span></td>
                                <td width="179" bgcolor="#0066CC"><span class="Estilo16">Descripci&oacute;n</span></td>
                              </tr>
                              <tr>
                                <td bgcolor="#F5F5F5"><label>
                                  <input type="checkbox" style="background:none; border:none" name="chk_tiendas[]" id="Tiendas" value="">
                                </label></td>
                                <td bgcolor="#F5F5F5">&nbsp;</td>
                                <td bgcolor="#F5F5F5">&nbsp;</td>
                              </tr>
                            </table>
                            </div></td>
                      </tr>
                      <tr>
                        <td><input id="GrupoOpciones2" name="GrupoOpciones2"  style="background:none; border:none"  type="radio" value="todos2"  onClick="marcar(this)">
Marcar todos
  <input id="GrupoOpciones2" name="GrupoOpciones2" style="background:none; border:none" checked="checked" type="radio" value="ninguno2"  onClick="marcar(this)">
Desmarcar todos </td>
                      </tr>
                  </table></td>
              </tr>
            </table>
          </fieldset></td>
          </tr>
        <tr>
          <td height="121" colspan="2" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center">
			  <fieldset ><legend>Presentaci&oacute;n</legend><table width="257"  border="0" cellpadding="0" cellspacing="0">         
              
			
              <tr>
                <td width="136" height="19" align="right" class="Estilo27">Agrupado: </td>
                <td width="144" align="left" class="Estilo27"><select name="cmbformato" id="cmbformato" onChange="borrarOption()" style="width:130px">
                  <!--<option value="-1">---------------------</option>-->
                  <option value="1">Tipo de Documento</option>
                  <option value="2">Fecha de Documento</option>
				  <option value="3">Razon social</option>
                </select></td>
              </tr>
			  
              <tr>
                <td height="19" align="right" class="Estilo27">Moneda:</td>
                <td align="left" class="Estilo27"><select name="moneda" id="moneda"  style="width:130px">
                  <!--<option value="-1">---------------------</option>-->
                  <option value="1" selected>Soles</option>
                  <option value="2">Origen</option>
                 
                </select></td>
              </tr>
              <tr>
                <td height="41" align="center" class="Estilo27"><input type="button" name="vista" id="vista" value="Vista" onClick="enviarFrm('','1')" ></td>
                <td height="41" align="center" class="Estilo27"><table  onClick="enviarFrm('S','1')"  style="cursor:pointer; display:block"  width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="center"><img  src="../imagenes/ico-excel.gif" width="22" height="22"></td>
                  </tr>
                  <tr>
                    <td height="19" align="center"><span class="Estilo9 Estilo13">Exportar a Excel</span>
                        <input type="hidden" value="N"  id="excel" name="excel" ></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="41" colspan="2" align="center" class="Estilo27"><input type="button" name="vista2" id="vista2" value="Consolidado" onClick="enviarFrm('','2')" ></td>
                </tr>
			  <br>
            </table>  
			
			
              </fieldset>
			  </td>
            </tr>
          </table>		  </td>
          </tr>
      </table>
      </form>
    </td>
  </tr>
</table>
</body>
</html>