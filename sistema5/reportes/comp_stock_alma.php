<?php 
	include('../conex_inicial.php');
	$titulo="Inventarios :: Comparativo Stock entre Almacenes";
?>
<html>
<head>
	<script language="javascript" src="miAJAXlib2.js"></script>
    <script src="../jquery-1.2.6.js"></script>
    <script src="../jquery.hotkeys.js"></script>
	<script src="../mootools-comprimido-1.11.js"></script>

<script>
function cargarproducto(pagina){
//alert('df');
cancel_peticion(valor);
var valor=document.form1.sucursal.value;

//var valor1=document.form1.mostrarsuc.value;
//var criterio=document.form1.criterio.value;
doAjax('tiendas.php','valor='+valor,'detalle_prod','get','0','1','','');

//doAjax('sucursales.php','valor1='+valor,'detalle_prod','get','0','1','','');
//document.form1.submit();
}


function detalle_prod(texto){
//alert(texto);
var r = texto.split('?');
document.getElementById('detalle').innerHTML=r[0];
//document.form1.carga.value='N';
document.getElementById('paginacion').innerHTML=r[1];
}

function ordena(){
	document.form1.txtorden.value=document.form1.cboordenar.value;
}
function rangofecha(){
	cmb1=document.form1.cboformato.value;
	//document.getElementById('fecIni').style.visibility="";
	
	document.getElementById('fecIni').style.visibility="";
	document.getElementById('fecFin').style.visibility="";
	document.getElementById('txtFec').style.visibility="";
	document.getElementById('sucursalStock').style.visibility="";
	
	document.getElementById('fieldset1').disabled=false;
	document.getElementById('fieldset2').disabled=false;
	
	if (cmb1==3){
		//document.getElementById('fecIni').style.visibility="hidden";
		document.getElementById('fecIni').style.visibility="hidden";
		document.getElementById('fecFin').style.visibility="hidden";
		document.getElementById('txtFec').style.visibility="hidden";
		document.getElementById('sucursalStock').style.visibility="hidden";

		document.getElementById('fieldset1').disabled=true;
		document.getElementById('fieldset2').disabled=true;	
		document.form1.GrupoOpciones1[1].checked=true;
		marcar('2');
		document.form1.GrupoOpciones2[1].checked=true;
		marcar('3');		
		document.form1.mostrar[1].checked=true;
		cbo0();
	}

	
}
function cargartiendas(){
	//alert(document.form1.GrupoOpciones0[1].checked);
if (document.form1.GrupoOpciones0[0].checked=true){ document.form1.GrupoOpciones0[1].checked=true }
	var sucursal=document.form1.sucursal.value;
		doAjax('tiendas.php','valor='+sucursal,'lista_tiendas','get','0','1','','');
	}
function suc(){

document.getElementById('tutsucx').innerHTML="Seleccionar Sucursales: ";
document.getElementById('sucx').style.visibility="hidden";
document.form1.GrupoOpciones0[1].checked=true
	
	var mostrarsuc=document.form1.mostrar[0].value;
	doAjax('sucursales.php','valor='+mostrarsuc,'lista_suc','get','0','1','','');
	document.form1.sucursal.disabled = true;
	
			
	}

function lista_tiendas(datos){
//alert(datos);
	document.getElementById('tiendas').innerHTML=datos;
	
	}
	
	function lista_suc(datos){
	
	document.getElementById('tiendas').innerHTML=datos;
		}
		//*****************************
function validar_form(){
	 
		 var fecha1=document.form1.fecha1.value;
		 var fecha2=document.form1.fecha2.value;
		 var sucursal=document.form1.sucursal.value;
		 var formato=document.form1.cboformato.value;
		 var ordenar=document.form1.cboordenar.value;
		
		 if(fecha1==''){
		 alert('Ingrese fecha de Inicio');
		 return false;
		 }
		 if(fecha2==''){
		 alert('Ingrese fecha de Fin');
		 return false;
		 }
		 //cuando se selecciona sucursales
		
		 if (document.form1.mostrar[0].checked==true){		
		  var temp1=0;
		 // alert(document.form1.checkbox.length);
			for(var i=0;i<document.form1.checkbox.length;i++){			
				if(document.form1.checkbox[i].checked==true){
				 //temp1=1;
				 temp1=temp1+1;
				}
			}
			if(temp1<2){
			alert('Seleccione 2 Locales de Sucursal');			
			return false
			}
			
		 }
		 //
		 //cuando selecciona almacenes por sucursal
	
		 if (document.form1.mostrar[1].checked){	
		 var temp1=0;
		// alert(document.form1.chk_tiendas);
			for(var i=0;i<document.form1.chk_tiendas.length;i++){
				if(document.form1.chk_tiendas[i].checked){
					//temp1=1;
					temp1=temp1+1;
				}
			}
			
			if(temp1<2){
			alert('Seleccione 2 Tiendas');
			return false
			}
			
		 }
		 //fin sucursal
		 //cuando se seleccona todas las tiendas
		  if (document.form1.mostrar[2].checked){
		 var temp1=0;
			if(document.form1.mostrar[2].checked)
			for(var i=0;i<document.form1.chktds_alma.length;i++){
				if(document.form1.chktds_alma[i].checked){
				 //temp1=1;
				 temp1=temp1+1;
				}
			}			
			if(temp1<2){
			alert('Seleccione 2 Tiendas');
			return false
			}
			
		 }		 
		  if(formato=='-1'){
		 alert('Seleccione el Movimiento de Stock');
		 return false;
		 }
		
		////-------------ingreso salida documento 
		 var temp3=0;
		 var temp4=0;
			for(var i=0;i<document.form1.chkIngresos.length;i++){
			if(document.form1.chkIngresos[i].checked){
			 temp3=1;
			}
			}
			for(var i=0;i<document.form1.chksalidas.length;i++){
			if(document.form1.chksalidas[i].checked){
			 temp4=1;
			}
			}
		
		if (document.form1.cboformato.value=='1'){
				if(temp3==0){
				alert('Seleccione un Documento de Ingreso');
				return false
				}
			}
			if (document.form1.cboformato.value=='2'){
				if(temp4==0){
				alert('Seleccione un Documento de Salida');
				return false
				}
			}
			if (document.form1.cboformato.value=='3'){
				if(temp3==0 || temp4==0){ 
				alert('Seleccione un Documento de Ingreso y de Salida');
				return false
				}
			}	
			
		//------------------------------------	
		 
		 if(ordenar=='-1'){
		 alert('Seleccione el Item a Ordenar');
		 return false;
		 }
		 

		 return true;
}

jQuery(document).bind('keydown', 'return',function (evt){jQuery('#_return').addClass('dirty'); 
  	cambiar_enfoque(document.activeElement);
return false; });

function cambiar_enfoque(control){
	//alert(control.name);
	if(control.name=='fecha1'){
	document.form1.fecha2.focus();
	document.form1.fecha2.select();
	}
	
	if(control.name=='fecha2'){
	document.form1.fecha2.blur();
	document.form1.mostrar[0].focus();
	}

	


	if(control.name=='sucursal'){
	document.form1.cboclas.focus();
	}
	if(control.name=='cboclas'){
	document.form1.cbocat.focus();
	}
	if(control.name=='cbocat'){
	document.form1.cbosub.focus();
	}
	if(control.name=='cbosub'){
	document.form1.cboformato.focus();
	}
	if(control.name=='cboformato'){
	document.form1.cboordenar.focus();
	}
	
}

//*****************
		function cbo0(){
		document.getElementById('tutsucx').innerHTML="Local por Sucursal: ";
		document.getElementById('sucx').style.visibility="visible";
						
			document.form1.sucursal.disabled = false;
			
		//document.form1.sucursal.options[0].selected = true;
		document.form1.sucursal.options[0].selected=true;
		
			cargartiendas();
			
			
		
		}		
		
function marcar(valor){

		if(document.form1.GrupoOpciones1[0].checked){
			for(var i=0;i<document.form1.chkIngresos.length;i++){
		   document.form1.chkIngresos[i].checked=true;
			}		
		}else{
			for(var i=0;i<document.form1.chkIngresos.length;i++){
			document.form1.chkIngresos[i].checked=false;
			}		
		}
		
	    if(document.form1.GrupoOpciones2[0].checked){
    		for(var i=0;i<document.form1.chksalidas.length;i++){
	   		document.form1.chksalidas[i].checked=true;
			}
		
	   }else{
			for(var i=0;i<document.form1.chksalidas.length;i++){
			document.form1.chksalidas[i].checked=false;  
			}		
		}

if (valor==1){
	if (document.form1.mostrar[0].checked==1){   /////////----------------------
		if(document.form1.GrupoOpciones0[0].checked){
				for(var i=0;i<document.form1.checkbox.length;i++){
				document.form1.checkbox[i].checked=true;
				}			
		   }else{
				for(var i=0;i<document.form1.checkbox.length;i++){
				document.form1.checkbox[i].checked=false;  
				}		
			}
	}else if (document.form1.mostrar[1].checked==true){ /////////----------------------
		if(document.form1.GrupoOpciones0[0].checked){
				for(var i=0;i<document.form1.chk_tiendas.length;i++){
				document.form1.chk_tiendas[i].checked=true;
				}
			
		   }else{
				for(var i=0;i<document.form1.chk_tiendas.length;i++){
				document.form1.chk_tiendas[i].checked=false;  
				}		
			}	
	}else if (document.form1.mostrar[2].checked==true){ /////////----------------------
		if(document.form1.GrupoOpciones0[0].checked){
				for(var i=0;i<document.form1.chktds_alma.length;i++){
				document.form1.chktds_alma[i].checked=true;
				}			
		   }else{
				for(var i=0;i<document.form1.chktds_alma.length;i++){
				document.form1.chktds_alma[i].checked=false;  
				}		
			}
	}
}	
	
		
		
		
		
}
			
		
		function cantidad_marca(){
			c=0;
			if(document.form1.mostrar.value=="SUCURSAL"){
				for(var i=0;i<document.form1.checkbox.length;i++){
		   			if(document.form1.chk_tiendas[i].checked==true){
						c++;
					}
				}
			}
			for(var i=0;i<document.form1.chk_tiendas.length;i++){
		   		if(document.form1.chk_tiendas[i].checked==true){
					c++;
				}
			}
			return c;
		}
		
		function mostrartodos(){
    document.getElementById('tutsucx').innerHTML="Seleccionar Locales: ";
	document.getElementById('sucx').style.visibility="hidden";
	document.form1.GrupoOpciones0[1].checked=true
			
	var most_alma=document.form1.mostrar[2].value;
	
	doAjax('todosalmacenes.php','valor='+most_alma,'lista_suc','get','0','1','','');
	
	document.form1.sucursal.disabled = true;
			
		}
		
function marcar_chkAgrupar(){
	/*if(document.form1.chkclas.checked==true){
	 alert(document.form1.agr_cla.value="S");
	}else{
	alert(document.form1.agr_cla.value="N");
	}
	
	if(document.form1.chkcat.checked==true){
	alert(document.form1.agr_cat.value="S");
	}else{
	alert(document.form1.agr_cat.value="N");
	}
	
	if(document.form1.chksub.checked==true){
	alert(document.form1.agr_sub.value="S");
	}else{
	alert(document.form1.agr_sub.value="N");
	}*/
}

function enviarFrm(){

	if(validar_form(document.form1)){					
			document.form1.excel.value="S";
            document.form1.submit();
	}
}

	function enviar_Frm(valor){
			//$can=cantidad_marca();
			//<input type="hidden" value=$can name="cant">
			document.form1.excel.value=valor;
			//document.form1.action="rpt_comp_stock_excel.php";
			document.form1.submit();
	}


                </script>



<link href="../styles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>


<script>

function iniciar(){
		
				
document.form1.fecha1.focus();
document.form1.fecha1.select();
//document.form1.chkclas.disabled=true;
//document.form1.chkcat.disabled=true;
//document.form1.chksub.disabled=true;

cbo0();
}
</script>

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
.Estilo16 {color: #FFFFFF; font-weight: bold; font-size: 11px; font-family: Arial, Helvetica, sans-serif; }
.Estilo24 {color: #FFFFFF; font-weight: bold; font-family: Arial; }
.Estilo25 {
	font-family: Arial, Helvetica, sans-serif;
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo27 {color: #000000}
#apDiv1 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:1;
	left: 471px;
	top: 12px;
}
.Estilo28 {
	font-size: 12;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.Estilo31 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;}
-->
</style>
</head>
<body onLoad="iniciar()">
<table width="793" height="203" border="0" align="center"  cellpadding="0" cellspacing="0">
  <tr>
       <td height="27" colspan="3" style="background:url(../imagenes/white-top-bottom.gif); border:#999999"><span class="Estilo001 text5 Estilo28"><span class="text5  Estilo31">Log&iacute;stica :: <?php echo $titulo;?> </span></span>         </tr>
  <tr>
    <td width="793" valign="top">
	 
	<form action="rpt_comp_stock.php" method="post" name="form1" id="form1" onSubmit="return validar_form()">
      <table border="0" cellspacing="0" cellpadding="0">
        
		  <tr>
		    <td height="19" colspan="2" valign="top" align="center">
			 <fieldset>
                <legend><span class="Estilo27">Movimiento de Stock</span></legend>
				<br><table width="222" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="64" align="center" class="Estilo27">Movimiento</td>
    <td colspan="2"><span class="Estilo27">
      <select name="cboformato" id="cboformato" onChange="rangofecha()" >
		<option value="1">INGRESOS</option>
        <option value="2">SALIDAS</option>
		<option value="3">STOCK</option>
      </select>
    </span></td>
  </tr>
</table><br>
		  </fieldset>			</td>
		    <td rowspan="4" align="center" valign="middle">	  
		      
		      <table width="300" border="0" cellpadding="0" cellspacing="0" >
		        <tr>
		          <td align="center" valign="middle" ><fieldset id='fieldset1' >
		            <legend><span class="Estilo27">Seleccione  documentos de INGRESO</span></legend>
                  <br>
		            <table width="250px" border="0" cellspacing="0" cellpadding="0">
		              <tr>
		                <td height="125" valign="middle"><table width="250px" border="0" cellspacing="0" cellpadding="0">
		                  <tr>
		                    <td height="125"><div style="overflow-y:scroll;height:120px">
		                      <table  id="tblIn" border="0" cellspacing="1" cellpadding="1">
		                        <tr>
		                          <td width="32" align="center" bgcolor="#0066CC"><span class="Estilo24">ok</span></td>
                                <td width="38" align="center" bgcolor="#0066CC"><span class="Estilo24">CD</span></td>
                                <td width="194" bgcolor="#0066CC"><span class="Estilo25">Descripcion</span></td>
                              </tr>
		                        <?php 
					
					$strSQl="select * from operacion where tipo='1'";
					$resultado=mysql_query($strSQl,$cn);
					while($row=mysql_fetch_array($resultado)){
					
					?>
		                        <tr>
		                          <td height="20" align="center" bgcolor="#F5F5F5"><input name="chkIngresos[]" id="chkIngresos" type="checkbox" style="background:none; border:none" value="<?php echo $row['codigo']?>" /></td>
                                <td align="center" bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row['codigo']?></span></td>
                                <td bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row['descripcion']?></span></td>
                              </tr>
		                        <?php 
					  }
					  ?>
		                        </table>
                          </div></td>
                        </tr>
	                    </table></td>
                    </tr>
	                </table>
                  <input id="GrupoOpciones1" name="GrupoOpciones1"  style="background:none; border:none"  type="radio" value="todos"  onClick="marcar('2')">
		            Marcar todos
		            <input id="GrupoOpciones1" name="GrupoOpciones1" style="background:none; border:none" checked="checked" type="radio" value="ninguno"  onClick="marcar('2')">
		            Desmarcar todos
  </fieldset></td>
              </tr>
            </table></td>
	      </tr>
		  <tr>
          <td height="19" colspan="2"><div class="Estilo27" id="txtFec"> Rango de Fechas </div></td>
          </tr>
        <tr class="Estilo27">
          <td width="163" height="27" align="center" valign="top" >
		 <div id='fecIni'> 
		  Desde
            <input name="fecha1" value="<?php echo '01'.substr(date('d-m-Y'),2,8)?>" type="text" id="fecha1" size="12" />
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
		</div>		  
		    </td>
          <td width="188" align="center" valign="top">
		  <div id='fecFin'> 
		  Hasta<input name="fecha2"  value="<?php echo date('d-m-Y')?>" type="text" id="fecha2" size="12" />
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
                  </script>
			</div>	  
		    </td>
        </tr>
        <tr class="Estilo27">
          <td colspan="2" align="center" valign="top">
		    <fieldset style="height:90px">
          <legend class="Estilo27">Comparativo por: </legend>
		  <table>
            <tr>
              <td><table width="200">
                  <tr>
                    <td><span class="Estilo27" id="sucursalStock" >
                     
                      <input  style="background:none; border:none" type="radio" name="mostrar" value="SUCURSALES" id="mostrar" onClick="suc()">
                      <label>   Sucursales</label>
                    </span></td>
                  </tr>
                  <tr>
                    <td><span class="Estilo27">
                      <label>
                      <input name="mostrar" type="radio" id="mostrar" style="background:none; border:none" onClick="cbo0()" value="LOCALES POR SUCURSAL" checked>
                      <label>Locales por sucursal</label>
                    </span></td>
                  </tr>
                  <tr>
                    <td><span class="Estilo27">
                     
                      <input style="background:none; border:none " type="radio" name="mostrar" value="TODOS LOS LOCALES" id="mostrar" onClick="mostrartodos()">
                        <label> Todos los locales</label>
                    </span></td>
                  </tr>
                </table></td>
            </tr>
          </table>
		  <br>
		    </fieldset></td>
          </tr>
		<br>
        <tr>
          <td height="199" colspan="2" align="center" valign="top">
		  <fieldset >
          <legend class="Estilo27"><label id="tutsucx">Locales por Sucursal:</label>  </legend>
            <table  width="243" border="0" cellpadding="0" cellspacing="0" id="sucx">
              <tr>
                <td><span class="Estilo27">Sucursal</span></td>
                <td><select name="cbosucursal" id="sucursal" onChange="cargartiendas()">
                  <!-- <option value="-1">-----------------------------</option>-->
                  <?php 					 				
				$sql="SELECT * FROM sucursal order by des_suc asc"; 
				$rs=mysql_query($sql);
				while ($reg=mysql_fetch_array($rs)){
					echo "<option value='".$reg['cod_suc']."'>".$reg['des_suc']."</option>";
				}
				  ?>
                </select></td>
              </tr>
            </table>
			
			
            <table  width="100" height="46" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="287" height="46"><br>
                    <div style="overflow-y:scroll;height:110px" id="tiendas" >
                      <table width="250px" border="0" cellpadding="1" cellspacing="1">
                        <tr>
                          <td width="20" align="center" bgcolor="#0066CC"><span class="Estilo16">ok</span></td>
                          <td width="46" align="center" bgcolor="#0066CC"><span class="Estilo16">codigo</span></td>
                          <td width="174" bgcolor="#0066CC"><span class="Estilo16">Descripci&oacute;n</span></td>
                        </tr>
                        <tr>
                          <td align="center" bgcolor="#F5F5F5"><label>
                          <input type="checkbox" style="background:none; border:none" name="chk_tiendas[]" id="chk_tiendas" value="">
                          </label></td>
                          <td align="center" bgcolor="#F5F5F5">&nbsp;</td>
                          <td bgcolor="#F5F5F5">&nbsp;</td>
                        </tr>
                      </table>
                    </div></td>
              </tr>
            </table>
           <input id="GrupoOpciones1" name="GrupoOpciones0"  style="background:none; border:none"  type="radio" value="todos"  onClick="marcar('1')">
      Marcar todos
        <input id="GrupoOpciones1" name="GrupoOpciones0" style="background:none; border:none" checked="checked" type="radio" value="ninguno"  onClick="marcar('1')">
Desmarcar todos
          </fieldset></td>
          <td width="388" align="center" valign="top">
            
              <table width="300" height= border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="147" align="center"><fieldset id='fieldset2'>
                    <legend class="Estilo27">Seleccione  documentos de SALIDA</legend>
                    <br>
                    <table width= 252 height="115" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="262"><div style="overflow-y:scroll;height:110px">
                          <table width="" border="0" cellpadding="1" cellspacing="1">
                            <tr>
                              <td width="32" align="center" bgcolor="#0066CC"><span class="Estilo24">ok</span></td>
                              <td width="38" align="center" bgcolor="#0066CC"><span class="Estilo24">CD</span></td>
                              <td width="194" align="center" bgcolor="#0066CC"><span class="Estilo24">Documento</span></td>
                            </tr>
                            <?php
				  $sql="Select * from operacion where tipo='2'";
				  $resultado=mysql_query($sql,$cn);
				  while($row=mysql_fetch_array($resultado)){
				  
				  
				  
				  ?>
                            <tr>
                              <td align="center" bgcolor="#F5F5F5"><input style="background:none; border:none" id="chksalidas" type="checkbox" name="chksalidas[]"  value="<?php echo $row['codigo']?>"></td>
                              <td align="center" bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row['codigo']?></span></td>
                              <td align="left" bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row['descripcion']?></span></td>
                            </tr>
                            <?php
				  }
				  ?>
                          </table>
                        </div></td>
                      </tr>
                    </table>
                 
              <label>        <input id="GrupoOpciones2" name="GrupoOpciones2"  style="background:none; border:none"  type="radio" value="todos"  onClick="marcar('3')">
Marcar todos</label>
<input id="GrupoOpciones2" name="GrupoOpciones2" style="background:none; border:none" checked="checked" type="radio" value="ninguno"  onClick="marcar('3')">
Desmarcar todos 
                  </fieldset></td>
                </tr>
              </table>            </td>
        </tr>
        <tr>
          <td height="152" colspan="2" align="center" valign="top"><fieldset>
            <legend class="Estilo27" >Agrupaci&oacute;n de productos</legend>
            <br>
            <table width= height="50" height="124" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="69%" valign="middle"><span class="Estilo27">&nbsp;
                  <label> </label>
                  Filtro x Clasificacion&nbsp;&nbsp;</span></td>
                <td width="31%" align="left"><span class="Estilo27">
                  <label>
                    <input style="background:none; border:none" name="chkclas" type="checkbox" value="chkclas" id="chkclas"    onClick="marcar_chkAgrupar()" />
                  </label>
                  Agrupar
				   <input type="hidden" name="agr_cla" value="N" id="agr_cla">
				  </span></td>
              </tr>
              <tr>
                <td colspan="2"><span class="Estilo27">
                  <select name="cboclas" id="cboclas">
                    <option value="-1">--------------------------------------------------</option>
                    <?php 
					 				
				$sql="SELECT * FROM clasificacion  order by des_clas asc";
				$rs=mysql_query($sql);
				while ($reg=mysql_fetch_array($rs)){
					echo "<option value=".$reg['idclasificacion'].">".$reg['des_clas']."</option>";
				}
				  ?>
                  </select>
                </span></td>
              </tr>
              <tr>
                <td><span class="Estilo27">&nbsp;
                  <label></label>
                  Filtro x Categoria&nbsp;&nbsp;&nbsp;&nbsp;
                  <label></label>
                </span></td>
                <td align="left"><span class="Estilo27">
                  <label>
                    <input style="background:none; border:none" name="chkcat" type="checkbox" value="chkcat" id="chkcat"    onClick="marcar_chkAgrupar()"/>
                  </label>
                  Agrupar
				  <input type="hidden" name="agr_cat" id="agr_cat" value="N">
				  </span></td>
              </tr>
              <tr>
                <td colspan="2"><span class="Estilo27">
                  <select name="cbocat" id="cbocat">
                    <option value="-1">--------------------------------------------------</option>
                    <?php 
					 				
				$sql="SELECT * FROM categoria  order by des_cat asc";
				$rs=mysql_query($sql);
				while ($reg=mysql_fetch_array($rs)){
					echo "<option value=".$reg['idCategoria'].">".$reg['des_cat']."</option>";
				}
				  ?>
                  </select>
                </span></td>
              </tr>
              <tr>
                <td><span class="Estilo27">&nbsp;
                  <label></label>
                  Filtro x SubCategoria&nbsp;&nbsp;&nbsp;</span></td>
                <td><span class="Estilo27">
                  <label>
                    <input style="background:none; border:none" name="chksub" type="checkbox" value="chksub" id="chksub"    onClick="marcar_chkAgrupar()"/>
                  </label>
                  Agrupar
				  <input type="hidden" name="agr_sub" id="agr_sub" value="N">
				  </span></td>
              </tr>
              <tr>
                <td colspan="2"><span class="Estilo27">
                  <select name="cbosub" id="cbosub">
                    <option value="-1">--------------------------------------------------</option>
                    <?php 
					 				
				$sql="SELECT * FROM subcategoria order by des_subcateg asc";
				$rs=mysql_query($sql);
				while ($reg=mysql_fetch_array($rs)){
					echo "<option value=".$reg['idsubcategoria'].">".$reg['des_subcateg']."</option>";
				}
				  ?>
                  </select>
                <input type="hidden" name="pagina" value=""/></span></td>
              </tr>
            </table>
<br>
          </fieldset></td>
          <td align="center" valign="top"><table width="300" height="152" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="311" height="152" align="left" valign="top"><fieldset>
              
                  <legend class="Estilo27">Datos a ordenar</legend>
               
                <br>
                <table border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="center"><span class="Estilo27">Ordenar por: </span></td>
                    <td colspan="2"><span class="Estilo27">
                      <select name="cboordenar" id="cboordenar" onChange="ordena()">
                        <option value="1">Codigo de sistema</option>
                        <option value="2">descripci&oacute;n</option>
                        <option value="3">codigo anexo</option>
                      </select>
                      <input type="hidden" name="txtorden" value="">
                    </span></td>
                  </tr>
                  <tr>
                    <td align="center"><span class="Estilo27">Imprimir:</span></td>
                    <td colspan="2"><span class="Estilo27">
                      <input style="background:none; border:none" name="Sistema" type="radio" value="Cod. Anexo">
                      Cod. Anexo 
                      <input name="Sistema" type="radio" style="background:none; border:none" value="Cod. Sistema" checked>
Cod. Sistema </span></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><span class="Estilo27">
                      <input type="button" name="Submit" value="  Vista  " onClick="enviar_Frm('N');">
                    </span></td>
                    <td><table onClick="enviar_Frm('S');"style="cursor:pointer" width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td align="center"><img  src="../imagenes/ico-excel.gif" width="22" height="22"></td>
                      </tr>
                      <tr>
                        <td align="center"><span class="Estilo9 Estilo13">Exportar a Excel</span>
                            <input type="hidden" value="N"  id="excel" name="excel" ></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td><span class="Estilo27"></span></td>
                    <td>.</td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
              </fieldset></td>
            </tr>
          </table></td>
        </tr>
      </table>
      </form>
    </td>
  </tr>
</table>
</body>
</html>