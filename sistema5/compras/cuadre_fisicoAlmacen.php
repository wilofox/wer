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

<script src="../jquery-1.2.6.js"></script>
<script src="../jquery.hotkeys.js"></script>

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


</style>

<script>

function cargar_cbo(texto){
//alert(texto);
var r = texto;
document.getElementById('cbo_tienda').innerHTML=r;
document.form1.almacen.focus();
buscar_prod('');

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

<body onLoad="buscar_prod('');document.form1.sucursal.focus();">
<form id="form1" name="form1" method="post" action="">
  <table width="800" height="404" border="0" cellpadding="0" cellspacing="0">
    
    <tr style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="5" height="23">&nbsp;</td>
      
	   <td width="760" height="25" colspan="11" style="border:#999999">
	  <span class="Estilo100">Log&iacute;stica ::</span>  <span class="Estilo100">Cuadre F&iacute;sico de Amac&eacute;n</span>
	  <input type="hidden" name="carga" id="carga" value="N">
	  <input type="hidden" name="tpuser" id="tpuser" value="<?php echo $tpuser;?>">
	  <input name="tipomov"  type="hidden" value="2" size="5" />
	   </td>
	  
    </tr>
    <tr style="background:url(../imagenes/botones.gif)">
      <td height="26">&nbsp;</td>
      <td><table width="721" border="0" cellpadding="0" cellspacing="0">
          
          <tr>
            <td><span class="Estilo7">Sucursal</span></td>
            <td height="22" colspan="2"><select  style="width:240"  name="sucursal" onkeypress="keyfocus(this,event);">
        <?php 		
		$resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn);	 		  
		while($row1=mysql_fetch_array($resultados1)){
			echo '<option value="'.$row1['cod_suc'].'">'.$row1['des_suc'] .'</option>';
		}
		?>
            </select></td>
            <td colspan="3"><img src="../imagenes/lupa5.gif" width="18" height="20"></td>
            <td>&nbsp;</td>
            <td><span class="Estilo7">Responsable</span></td>
            <td><select name="responsable" style="width:140" onChange=""  onFocus="enfocar_cbo(this);limpiar_enfoque(this);cbo_cond()">
		  <?php 
			$marcar="";
		    $resultados11 = mysql_query("select * from usuarios order by usuario ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			$marcar="";
			if($row11['codigo']==$_SESSION['codvendedor']){
			$marcar=" selected='selected' ";
			}
			
		  ?>
           
              <option <?php echo $marcar?> value="<?php echo $row11['codigo']?>"><?php echo $row11['usuario'];?></option>
			  <?php }?>
            </select></td>
            <td width="139" rowspan="2"><table width="91" border="0" align="right" cellpadding="0" cellspacing="0" onClick="buscar_prod('')" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" style="cursor:pointer">
                <tr>
                  <td align="center"><span class="Estilo9"><img src="../imagenes/ico_lupa.jpg" width="20" height="20"></span></td>
                </tr>
                <tr>
                  <td align="center"><span class="Estilo9 Estilo13">Generar Lista </span></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td width="86"><span class="Estilo7">N&uacute;mero</span></td>
            <td width="119" height="22">
              <input name="num_serie" type="text" id="num_serie" size="3" maxlength="3" onKeyPress="numero();"  onKeyUp="generar_ceros(event,3,'serie')" >
            <input name="num_correlativo" type="text" id="num_correlativo" size="10" maxlength="10" onKeyPress="numero();" onKeyUp="generar_ceros(event,7,'correlativo')">			</td>
            <td width="125" align="right">
			<span class="Estilo7">Fecha</span>
			<strong>
              <input style="height:17" autocomplete="off"  name="fecha"  id="fecha" type="text" value="<?php echo date('d-m-Y')?>" size="10" onKeyPress="keyfocus(this,event);" >
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
			<?php 
			$temp_fecha=date('Y-m-d');
			$fecha=explode("-",$temp_fecha);
			$fecha1=$fecha[0]."-".$fecha[1]."-01";
			$fecha2=$temp_fecha;
			?>
			
            <td colspan="3">&nbsp;</td>
            <td width="16">&nbsp;</td>
            <td width="78"><span class="Estilo7">Condici&oacute;n</span></td>
            <td width="140"><span class="Estilo15">
            <div id="cbo_cond">		
			<select name="condicion" style="width:140" onChange=""  onFocus="enfocar_cbo(this);limpiar_enfoque(this);cbo_cond()">
		  <?php 
			$marcar="";
		    $resultados11 = mysql_query("select * from condicion order by codigo ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){					
		  ?>           
              <option <?php echo $marcar?> value="<?php echo $row11['codigo']?>"><?php echo $row11['nombre'];?></option>
			  <?php 
			  }
			  ?>
            </select>
			</div>
            </span></td>
          </tr>
          <tr>
            <td><span class="Estilo7">Almac&eacute;n</span></td>
            <td height="22" colspan="2"><div id="cbo_tienda">
              <select  style="width:240" name="almacen"  onBlur="">
                <option value="0">Todas</option>
              </select>
            </div></td>
            <td colspan="3"><img src="../imagenes/lupa5.gif" width="18" height="20"></td>
            <td>&nbsp;</td>
            <td><span class="Estilo7">Busar Por </span></td>
            <td><select name="criterio" style="width:140px;" onkeypress="keyfocus(this,event);">
                <option value="0" >C&oacute;digo</option>
                <option value="1" >Cod. Anexo</option>
				<option value="2" selected>Descipci&oacute;n</option>
              </select></td>
            <td><strong>
              <input style="height:20" autocomplete="off"  name="valor"  id="valor" type="text" size="22" onKeyUp="buscar_prod('')">
            </strong></td>
          </tr>
          
      </table></td>
    </tr>
    <tr>
      <td height="211">&nbsp;</td>
      <td>
	  <br>
	  <table width="725" border="0" cellpadding="0" cellspacing="1">
        <tr  style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px; border:#999999 solid 1px">
          <td   width="21" height="21" align="center" ><span class="texto2"><strong>OK</strong></span></td>
          <td   width="53" align="center"><span class="texto2"><strong>C&oacute;digo</strong></span></td>
          <td   width="109" ><span class="texto2"><strong>Cod. Anexo </strong></span></td>
          <td   width="279" ><span class="texto2"><strong>Descripci&oacute;n</strong></span></td>
          <td   width="62" ><span class="texto2"><strong>Unidad</strong></span></td>
          <td   width="60"><span class="texto2"><strong>Stock Sist. </strong></span></td>
          <td   width="71" ><span class="texto2"><strong>Stock Fisico. </strong></span></td>
          <td   width="61" ><span class="texto2"><strong>Ajuste</strong></span></td>
        </tr>
        <tr>
          <td colspan="8">
		  <div id="detalle" style="width:740px; height:240px; overflow:auto" >		  </div>		  </td>
          </tr>
        
        <tr>
          <td colspan="8" height="5"><div id="pagina" style="width:720px;" >
		
		  </div></td>
        </tr>
         <tr>
          <td colspan="8" height="5"></td>
      </table>
	  </td>
    </tr>
    <tr>
      <td height="15">&nbsp;</td>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="25%"><table width="146" height="27" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="91%"><fieldset>
                  <legend>Leyenda</legend>
                  <table width="109%" height="31" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="16" align="center"><table  width="25" border="0" cellpadding="0" cellspacing="0" style="border:#cccccc solid 1px">
                          <tr>
                            <td  height="8" bgcolor="#0000FF"></td>
                          </tr>
                      </table></td>
                      <td><span class="Estilo122">Ajuste Positivo </span></td>
                    </tr>
                    <tr>
                      <td width="32%" height="15" align="center"><table style="border:#999999 solid 1px"  width="25" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td  height="8" bgcolor="#FF0000"></td>
                          </tr>
                      </table></td>
                      <td width="68%"><span class="Estilo122">Ajuste Negativo </span></td>
                    </tr>
                  </table>
                </fieldset></td>
                <td width="9%">&nbsp;</td>
              </tr>
            </table> </td>
            <td width="75%">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<? // <!--CONSULTA // ADICI&Oacute;N // MODIFICACI&Oacute;N--> ?>
			<label style="font-size:19px; font-weight:bold; color:#0000FF">(EN ESPERA)</label>
			<br><label style="font-weight:bold">[Ctrl+E] Eliminar Doc Inventario</label> </td>
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
doAjax('lista_prod_kardex7c.php','&valor='+document.form1.valor.value+'&tienda='+tienda+'&pagina='+pagina+'&sucursal='+sucursal+'&fecha='+fecha,'mostrar_filtro','get','0','1','','');

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
	//alert(fecha);
	if(parametro=='vista'){
	window.open("inventario_excel.php?precio="+document.form1.precios.value+"&agr_cla="+agr_cla+"&agr_cat="+agr_cat+"&agr_sub="+agr_sub+"&filtro_cla="+clasificacion+"&filtro_cat="+categoria+"&fecha="+fecha+"&filtro_sub="+subcategoria+"&ordenar="+ordenar+"&formato="+parametro+"&tienda="+tienda+"&precios="+precios+"&sucursal="+sucursal+"&incluir="+incluir+"&mon="+mon+"&valor="+valor+'&tpuser='+tpuser,"vent2","toolbar=no,status=yes, menubar=no, scrollbars=no, width=750, height=700,left=50 top=50");
	}else{
	window.open("inventario_excel.php?precio="+document.form1.precios.value+"&agr_cla="+agr_cla+"&agr_cat="+agr_cat+"&agr_sub="+agr_sub+"&filtro_cla="+clasificacion+"&filtro_cat="+categoria+"&fecha="+fecha+"&filtro_sub="+subcategoria+"&ordenar="+ordenar+"&formato="+parametro+"&tienda="+tienda+"&precios="+precios+"&sucursal="+sucursal+"&incluir="+incluir+"&mon="+mon+"&valor="+valor+'&tpuser='+tpuser,"vent2","toolbar=no,status=yes, menubar=no, scrollbars=no, width=700, height=700,left=50 top=50");
	
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
function numero(){
	var key=window.event.keyCode;
	if (key < 48 || key > 57){
		window.event.keyCode=0;
	}
}
function numerodesc(){
	var key=window.event.keyCode;
	if (key < 48 || key > 57  ){
		if (key == 46){
			return false;
		}
	window.event.keyCode=0;
	}
}
function cbo_cond(){
	var doc="CF";//document.formulario.doc.value;
	document.form1.carga.value='S';
	doAjax('peticion_datos.php','&doc='+doc+'&peticion=cargar_cond','cargar_cbo_cond','get','0','1','','');
}
function cargar_cbo_cond(texto){
	document.getElementById('cbo_cond').innerHTML=texto;
	document.form1.condicion.focus();
	
}
jQuery(document).bind('keyup', 'return',function (evt){jQuery('#_return').addClass('dirty');

if(document.activeElement.name=='almacen'){
	document.form1.condicion.focus();
} 
else if(document.activeElement.name=='condicion'){
	document.form1.criterio.focus();
} 
 
	event.keyCode=0;
	event.returnValue=false;
			
return false; });

function keyfocus(f,e){
	if(e.keyCode == 13){
		if(f.name=='sucursal'){
			document.form1.num_serie.focus();
		}
		if(f.name=='fecha'){
			document.form1.almacen.focus();
		}
		if(document.activeElement.name=='criterio'){
			document.form1.valor.focus();
		}
		/*if(f.name=='txtser'){
			alert();
		}*/
	}
}

var tab_cod;
var tab_numero_ini;
var tab_numero_fin;
function generar_ceros(e,ceros,control){
	var serie=document.form1.num_serie.value;
	var numero=document.form1.num_correlativo.value;
	var doc="CF";//document.form1.doc.value;
	var sucursal=document.form1.sucursal.value;
	var tipomov=document.form1.tipomov.value;	
	if(e.keyCode==13 ){
		var valor="";
		if(control=='serie'){
			valor=serie;
		}else{
			valor2=serie;	
			valor=numero;
		}		
		
		valor = parseFloat(valor);
		if(control=='correlativo'){
			valor2 = parseFloat(valor2);
		}
		if(isNaN(valor)){
			//alert('Por favor digite un número válido');
			return false;
		}else{		
			valor=valor.toString();
			if(control=='correlativo'){
				valor2=valor2.toString();
			}
		}	
		
		document.form1.carga.value='S';
		if(control=='serie'){			   
		   if(tipomov==2 || document.form1.correlativo.value=='S'){
		   document.form1.num_serie.value=ponerCeros(valor,ceros);
		   doAjax('peticion_datos.php','&serie='+document.form1.num_serie.value+'&doc='+doc+'&sucursal='+sucursal+'&peticion=generar_numero&tipomov='+tipomov,'rpta_gen_numero','get','0','1','',''); 
		   }else{
		   alert(2);			
			document.form1.num_serie.value=ponerCeros(valor,ceros);
			document.form1.num_correlativo.disabled=false;
			document.form1.num_correlativo.focus();
			document.form1.num_correlativo.select();
			}
		}
	
	
	if(control=='correlativo'){				
		if(document.form1.num_correlativo.value!=0){
		var temp_numero_ini=0;//find_prm(tab_numero_ini,tab_cod);
		var temp_numero_fin=0//;find_prm(tab_numero_fin,tab_cod);
		var temp_numero=document.form1.num_correlativo.value;
		
		 if(temp_numero_ini!='' && temp_numero_fin!=''){	
		 alert(22);		
			if(parseFloat(temp_numero)<parseFloat(temp_numero_ini) || parseFloat(temp_numero)>parseFloat(temp_numero_fin)){			
			// alert(parseFloat(temp_numero)+"  "+parseFloat(temp_numero_ini)+"  "+parseFloat(temp_numero_fin));	
			alert('Número de documento no autorizado...');
			document.form1.num_correlativo.value='';
			document.form1.num_correlativo.select();			
			return false;
			}
	 	}
			document.form1.num_correlativo.value=ponerCeros(valor,ceros);
			document.form1.num_serie.value=ponerCeros(valor2,'3');					
			numero=document.form1.num_correlativo.value;
			
				if(tipomov==1){
				alert(33);
				doAjax('peticion_datos.php','&serie='+serie+'&numero='+numero+'&doc='+doc+'&sucursal='+sucursal+'&peticion=buscar_prov&tipomov='+document.form1.tipomov.value,'rpta_con_datos','get','0','1','','');
				}else{
				doAjax('peticion_datos.php','&serie='+serie+'&numero='+numero+'&doc='+doc+'&sucursal='+sucursal+'&peticion=buscar_prov2&tipomov='+document.form1.tipomov.value,'rpta_bus_numero','get','0','1','','');								
				}
	 }	} 
	
	
	}

}
function rpta_bus_numero(texto){
	var temp=texto.split("?");
	//alert(texto);
	
	//document.form1.temp_doc.value=temp[0];
	document.form1.sucursal.disabled=true;
	//document.form1.doc.disabled=true;
	document.form1.num_correlativo.disabled=true;
	document.form1.num_serie.disabled=true;
	//f_trigger_b1
	cbo_cond();	
	doAjax('../carga_cbo_tienda.php','&kardex=s&codsuc='+document.form1.sucursal.value,'cargar_cbo','get','0','1','','')
	document.form1.fecha.focus();	

}
function ponerCeros(obj,i) {
		  while (obj.length<i){
			obj = '0'+obj;
			}
		//	alert(obj);
			return obj;
}
function rpta_gen_numero(texto){		  
	document.form1.num_serie.value=ponerCeros(document.form1.num_serie.value,3);
	document.form1.num_correlativo.disabled=false;		  
	document.form1.num_correlativo.value=ponerCeros(texto,7);		  
	document.form1.num_correlativo.focus();
	document.form1.num_correlativo.select();	  
}
function find_prm(prm,codigo){
	for (var i=0;i<prm.length;i++){
		if(codigo[i]==doc){
		return prm[i];
		}
	} 
}
</script>