<?php session_start();
include('../conex_inicial.php');

//$Utienda= $_SESSION['user_tienda'] ;
$Usucursal= $_SESSION['user_sucursal'] ;
//$Ucodvendedor=  $_SESSION['codvendedor'];
$Univel= $_SESSION['nivel_usu'];
$tip=$_REQUEST['tipo'];
//echo $tip;
switch($tip){
	case '1':$title="Pagos";break;
	case '2':$title="Cobranzas";break;
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<script src="../jquery-1.2.6.js"></script>
<script src="../jquery.hotkeys.js"></script>

<script language="JavaScript">
jQuery(document).bind('keydown', 'f4',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		if (document.getElementById('btn1').disabled==false){
			//Cancelar(this);
		}
 return false; }); 
jQuery(document).bind('keydown', 'f12',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		if (document.getElementById('btn5').disabled==false){
			//Cancelar(this);
		}
 return false; }); 
jQuery(document).bind('keydown', 'f3',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		//Nuevo();
 return false; }); 
 jQuery(document).bind('keydown', 'f10',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;		
		//if (document.getElementById('btn4').disabled==false){
			//FuncionOT(this,'CON','<?$_SESSION['nivel_usu'];?>');
		//}
		
 return false; }); 
 jQuery(document).bind('keydown', 'f6',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;		
		if (document.getElementById('btn6').disabled==false){
			//FuncionOT(this,'OBS',this);
		}
		
 return false; }); 
 jQuery(document).bind('keydown', 'f4',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;		
		if (document.getElementById('btn6').disabled==false){
			//FuncionOT(this,'LET','<?=$_SESSION['nivel_usu'];?>');
		}
		
 return false; }); 
 jQuery(document).bind('keydown', 'f9',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;		
		if (document.getElementById('btn7').disabled==false){
			//FuncionOT(this,'ADJ',this);
		}
		
 return false; }); 
jQuery(document).bind('keydown', 'f5',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		if (document.getElementById('btn2').disabled==true){
			if (document.getElementById('btn3').disabled==false){
				//Anular('');
			}
		}else{
			if (document.getElementById('btn2').disabled==false){
				//Anular('A');
			}
		}
 return false; }); 
 jQuery(document).bind('keydown', 'f8',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		//doc_det(document.form1.XDato.value);
		//doc_det(this);
		
 return false; }); 
  jQuery(document).bind('keydown', 'f7',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		//doc_det(document.form1.XDato.value);
mostrar_print(this);
		
 return false; }); 
</script>

<script language="javascript" src="miAJAXlib3.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>
<script language="javascript">
function CargarCliente(pag){
	var tipo="<?php echo $_REQUEST['tipo'];?>";
	//var sucursal=document.form1.;
	var sucursal=document.form1.succod.value;
	var estado=document.form1.cboestado.value;
	var cmbmoneda=document.form1.cbomoneda.value;
	var fec1=document.form1.fec1.value;
	var dias=document.form1.dias.value;
	var error="";
	if(tipo==''){
		error="Debe volver a entrar";
	}
	if(estado==''){
		error="Debe seleccionar una condicion";
	}
	if(cmbmoneda==''){
		error="Debe seleccionar una moneda";
	}
	if(fec1==''){
		error="Debe seleccionar una fecha Valida";
	}
	if(dias=='' || dias=='0'){
		error="Debe ingresar cantidad de dias";
	}
	if(dias<7 || dias>15){
		error="Minimo de dias 7 - Maximo de dias 15";
	}
	if(error==""){
		//alert(sucursal);
		doAjax('Consultas_reporte.php','&tipo='+tipo+'&sucursal='+sucursal+'&estado='+estado+'&moneda='+cmbmoneda+'&pagina='+pag+'&fec1='+fec1+'&dias='+dias+'&modulo=rptletvenc&operacion=ListarClientes','Rpta_datos','get','0','1','progra','');
		//doAjax('Consultas_reporte.php','&tipo='+tipo+'&sucursal='+sucursal+'&estado='+estado+'&moneda='+cmbmoneda+'&pagina='+pag+'&fec1='+fec1+'&dias='+dias+'&modulo=rptletvenc&operacion=paginacion','Rpta_pagina','get','0','1','','');
	}else{
		alert(error);
	}
}

function CargarClienteExcel(){
	var tipo="<?php echo $_REQUEST['tipo'];?>";
	//var sucursal=document.form1.;
	var pag='excel';
	var sucursal=document.form1.succod.value;
	var estado=document.form1.cboestado.value;
	var cmbmoneda=document.form1.cbomoneda.value;
	var fec1=document.form1.fec1.value;
	var dias=document.form1.dias.value;
	var error="";
	if(tipo==''){
		error="Debe volver a entrar";
	}
	if(estado==''){
		error="Debe seleccionar una condicion";
	}
	if(cmbmoneda==''){
		error="Debe seleccionar una moneda";
	}
	if(fec1==''){
		error="Debe seleccionar una fecha Valida";
	}
	if(dias=='' || dias=='0'){
		error="Debe ingresar cantidad de dias";
	}
	if(dias<7 || dias>15){
		error="Minimo de dias 7 - Maximo de dias 15";
	}
	if(error==""){
		window.open('Consultas_reporte.php?tipo='+tipo+'&sucursal='+sucursal+'&estado='+estado+'&moneda='+cmbmoneda+'&pagina='+pag+'&fec1='+fec1+'&dias='+dias+'&modulo=rptletvenc&operacion=excel');
		//doAjax('Consultas_reporte.php','&tipo='+tipo+'&sucursal='+sucursal+'&estado='+estado+'&moneda='+cmbmoneda+'&pagina='+pag+'&fec1='+fec1+'&dias='+dias+'&modulo=rptletvenc&operacion=paginacion','Rpta_pagina','get','0','1','','');
	}else{
		alert(error);
	}
}

function Rpta_datos(texto){
	var datos=texto.split("|");
	//alert(datos[1]);
	//alert(datos[2]);
	//alert(datos[3]);
	document.getElementById('clientes1').innerHTML=datos[2];
	//document.getElementById('clientes2').innerHTML=datos[3];
	document.getElementById('progra').innerHTML=datos[1]+datos[3];
	document.getElementById('paginacion').innerHTML=datos[4];
}

function Rpta_pagina(texto){
	alert(texto);
}

function view_doc(trep,cliente,fecha){
	var tipo="<?php echo $_REQUEST['tipo'];?>";
	var sucursal=document.form1.succod.value;
	var estado=document.form1.cboestado.value;
	var cmbmoneda=document.form1.cbomoneda.value;
	window.open('view_deuda.php?tipo='+tipo+'&cliente='+cliente+'&trep='+trep+'&fecha='+fecha+'&sucursal='+sucursal+'&estado='+estado+'&cmbmoneda='+cmbmoneda,'deuda','toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=790, height=500, left=200, top=100');
}

</script>
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
.Estilo112 {color: #000000}
.Estilo113 {	color: #CC3300;
	font-weight: bold;
	font-size: 10px;
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style></head>


<link href="../styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
background-color:#F3F3F3;   
}
.Estilo13 {color: #0767C7}

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

//	objeto.style.background='url(../imagenes/sky_blue_sel.png)';
	objeto.cells[0].childNodes[0].checked=true;
//	temp=objeto;
	if(objeto.style.background=='url(../imagenes/sky_blue_sel.png)'){
	//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='url(../imagenes/sky_blue_sel.png)';
	temp.style.background=temp.bgColor;
	temp=objeto;
	}
	
	// enfocar lo check con un ncolor rk
	for(var i=0;i<document.form1.xcodigo.length;i++){
		if (document.form1.xcodigo[i].checked){
			 document.getElementById('lista_productos').rows[i].style.backgroundColor = '#999999';
		}
	}


}

function cargar(){
	try {

document.getElementById('lista_productos').rows[0].style.background='url(../imagenes/sky_blue_sel.png)';
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
function CarCodT(){
document.form1.succod.value=document.form1.Sucursal.value;
}	
function verOrder(){
	document.getElementById("divOrder").style.visibility="visible";
}
function entradaOrder(objeto){

//	objeto.style.background='url(../imagenes/sky_blue_sel.png)';
	//objeto.cells[0].childNodes[0].checked=true;
//	temp=objeto;
	if(objeto.style.background=='url(../imagenes/sky_blue_sel.png)'){
	objeto.style.background=objeto.bgColor;
	objeto.cells[0].style.color="#FFFFFF";
	}else{
	objeto.style.background='url(../imagenes/sky_blue_sel.png)';
	//alert(objeto.cells[0].innerHTML);
	objeto.cells[0].style.color="#000000";
	//temp2.style.background=temp2.bgColor;
	//'#E9F3FE';
	temp2=objeto;
	}

}
function entradaOrderY(objeto){
	if(objeto.style.background=='url(../imagenes/sky_blue_sel.png)'){
	objeto.style.background='url(../imagenes/sky_blue_grid.gif)';
	}else{
	objeto.style.background='url(../imagenes/sky_blue_sel.png)';
	}
}
function ordenar(campoOrder,formaOrder){
document.form1.tpcampo.value=campoOrder;
document.form1.tporden.value=formaOrder;
CargarCliente('');
document.getElementById("divOrder").style.visibility="hidden";
}
function ordenamiento(Campo){
var ordenar=Campo;
var orden=document.form1.orden.value;
document.form1.ordenar.value=Campo;
var pagina='';

CargarCliente('');

	if(orden=='asc'){
		document.form1.orden.value="desc";
	}else{
		document.form1.orden.value="asc";
	}	
		
}
</script>


<body onLoad="document.form1.Sucursal.focus(); CargarCliente('');CarCodT();">

<form id="form1" name="form1" method="post" action="">
  <table width="810" height="336" border="0" cellpadding="0" cellspacing="0">
    
    <tr style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="5" height="23">&nbsp;</td>
      
	   <td width="760" height="25" colspan="11" style="border:#999999">
	  <span class="Estilo100">Finanzas :: Cr&eacute;ditos y Cobranzas :: Reporte de <?php echo $title;?> de 7 d&iacute;as </span>	  
      <input type="hidden" name="carga" id="carga" value="N">
	  <input name="orden" type="hidden" size="5" value="asc">
	  <input name="ordenar" type="hidden" size="5" value=""> 	  
	  </td>	  
    </tr>
    <tr>
      <td height="84">&nbsp;</td>
      <td>
	  
	    <table width="99%" height="21" border="0" cellpadding="0" cellspacing="0" style="border-bottom:#CCCCCC solid 1px ;display:none">
          <tr>
            <td width="80" >&nbsp;</td>
            <td width="72" >&nbsp;</td>
            <td width="82">&nbsp;</td>
            <td width="76">&nbsp;</td>
            <td width="80">&nbsp;</td>
            <td width="70">&nbsp;</td>
            <td width="71">&nbsp;</td>
            <td width="192">&nbsp;</td>
          </tr>
        </table>
		 <table width="99%" height="26" border="0" cellpadding="0" cellspacing="0" style="border-bottom:#CCCCCC solid 1px">
        <tr>
		  <td width="88" height="25" >&nbsp;
		  <script>
		  function entrar_btn(obj){
		  obj.cells[0].style.backgroundImage="url(../imagenes/bordes_boton1.gif)";
		  obj.cells[1].style.backgroundImage="url(../imagenes/bordes_boton2.gif)";
		  obj.cells[2].style.backgroundImage="url(../imagenes/bordes_boton2.gif)";
		  obj.cells[3].style.backgroundImage="url(../imagenes/bordes_boton3.gif)";
		  
		  }
		  function salir_btn(obj){
		  obj.cells[0].style.backgroundImage="";
		  obj.cells[1].style.backgroundImage="";
		  obj.cells[2].style.backgroundImage="";
		  obj.cells[3].style.backgroundImage="";
		  
		  }
		  </script>
		  </td>
          <td width="94" ><table  title="Imprimir [F7]"width="87%" height="20" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="mostrar_print(this)">
              <td width="1" ></td>
              <td width="23" ><img src="../imagenes/ico-excel.gif"  width="22" height="22" border="0"></td>
              <td width="62" ><span class="Estilo112">&nbsp;Excel<span class="Estilo113">[F7]</span></span></td>
              <td width="3" ></td>
            </tr>
          </table></td>
          <td width="79">&nbsp;</td>
          <td width="79">&nbsp;</td>
          <td width="88">&nbsp;</td>
          <td width="77">&nbsp;</td>
          <td width="78">&nbsp;</td>
          <td width="214">&nbsp;</td>
        </tr>
      </table>
		
	    <table width="795" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="69" height="32"><div align="right"><span class="Estilo114">Empresa : </span></div></td>
            <td colspan="3"><span class="Estilo114">
              <input name="succod" type="text" disabled id="succod"  style="height:20; border-color:#CCCCCC" size="5">
              </span>
              <select  name="Sucursal" id="Sucursal" style="width:200" onChange="CarCodT()">
                <?php 		
  $resultados1 = mysql_query("select * from sucursal order by cod_suc ",$cn); 
  $k=0;
while($row1=mysql_fetch_array($resultados1))
{

	if ($Usucursal==$row1['cod_suc'] and $Univel<>5){
	?>
	<option value="<?php echo $row1['cod_suc'] ?>" selected><?php echo $row1['des_suc'] ?></option>
	<?
	}else{
	?>
	<option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
	<?
	}
	 
	$k++;
		}?>
              </select>
              <input name="Estado" type="hidden" id="Estado" value="" >
              <input name="tpcampo" type="hidden" id="tpcampo"  ><input name="tporden" type="hidden" id="tporden" ><input type="checkbox" name="chksuc" id="chksuc" onClick="Asig_suc('T')">Todas &nbsp;</td>
            <td width="64"><div align="right">A Partir de  : </div></td>
            <td colspan="3"><?
			//echo $Univel;
			//if ($Univel==1 ){ // || $Univel==6
			$DisUsr2='';
			if ($Univel==1 ){
			 $ActUsr ='style="height:18; visibility:hidden"';
			 $DisUsr='disabled';
			}else{
				if($Univel>=1){
					$DisUsr2='disabled';
				}
			$ActUsr ='style="height:18"';
			$DisUsr='';
			}
			?>
              <input name="fec1" type="text" size="10" maxlength="50" value="<?php echo date('d-m-Y')?>"  <?=$DisUsr;?>  >
              <button type="reset" id="f_trigger_b2"  <?=$ActUsr;?> >...</button>
              <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fec1",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b2",   
        singleClick    :    true,           
        step           :    1                
    });
              </script>
              Cantidad D&iacute;as
  <input name="dias" type="text" size="2" maxlength="2"  value="7" <?=$DisUsr2;?> >
  <script language="JavaScript">
			
			var tab1 ;
			var tab2 ;
			var tab3 ;
			var tab4 ;
			var tab5 ;
			var tab6 ;
			var tab7 ;
			var tab8 ;
			var tab9 ;
			var tab10 ;
			var tab11 ;
			var tab12;
			var tab13;
			var tab14;
			var tab15;
			 			
		//	alert(tab11);
			var tab_cod;
			var tab_nitems;
			var tab_serie;
			var tab_numero_ini;
			var tab_numero_fin;
			var tab_impresion;
			var tab_formato;
			var tab_kardex_doc;
			var tab_impuesto1;
			var tab_min_percep;
			
			  </script></td>
            <td width="67" colspan="2" rowspan="2" align="center" valign="middle" class="Estilo114" ><table onClick="CargarCliente('')"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="86%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="center"><img  src="../imagenes/ico_lupa.png" width="22" height="22"></td>
                </tr>
              <tr>
                <td height="24" align="center"><span class="Estilo9 Estilo13">Procesar</span></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td height="24"><div align="right"><span class="Estilo114">Moneda : </span></div></td>
            <td colspan="3"><select name="cbomoneda" id="cbomoneda" onChange="CargarCliente('')">
            <option value='T'>Todos</option>
			<?php $sql_mon=mysql_query("Select * from moneda",$cn); 
			while($rw_mon=mysql_fetch_array($sql_mon)){ 
				echo "<option value='".$rw_mon['id']."'>".strtoupper($rw_mon['descripcion'])." (".$rw_mon['simbolo'].")</option>";
			} ?></select>&nbsp;</td>
            <td width="64"><div align="right"><span class="Estilo114">Estado : </span></div></td>
            <td colspan="3"><select name="cboestado" id="cboestado" onChange="CargarCliente('')">
				<option value='A'>Anulados</option>
                <option value='B'>En Banco</option>
                <option value='P'>Con Pagos</option>
                <option value='T' selected>Todos</option>
			</select>&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td height="227">&nbsp;</td>
	  
      <td valign="top">
	  
	  <table width="800" height="229" border="0" cellpadding="0" cellspacing="1">
        <tr>          
          <td width="753" >
            <div id="detalle" style="width:800px; height:180px" ><?php include('det_rpt_vencimientosxdia.php');?></div>		  </td>
        </tr>
        <tr>          
          <td width="753" height="25" >
            <div id="paginacion" style="width:800px;height:25px; text-align-last:center;" ></div>		  </td>
        </tr>
     </table>
	 <div style="display:none">
      <span class="Estilo114"><b>Mostrar Documento:</b></span>
      <input name="ckbDoc"  type="checkbox" id="ckbDoc" style="border: 0px; background-color:#F9F9F9; " checked   onClick="activar('mosdoc1');CargarCliente('')" > 
      Todos
	  <input name="ckbDoc" type="hidden" id="ckbDoc" style="border: 0px; background-color:#F9F9F9; " onClick="activar('mosdoc2');CargarCliente('')" title="Solo Facturados" > 
	  <input name="ckbDoc" type="checkbox" id="ckbDoc" style="border: 0px; background-color:#F9F9F9; " onClick="activar('mosdoc3');CargarCliente('')" > 
	  Solo Anulados
	  </div>
	  </td>
    </tr>
  </table>
</form>
 <div id="AnularRk" style="position:absolute; visibility:hidden; left: 266px; top: 190px; width: 240px; height: 38px;"></div>
  <div id="FactuaRk" style="position:absolute; left:208px; top:114px; width:300px; height:180px; z-index:1; visibility:hidden">  </div>
  
  

</body>
</html>

<script>
function cambiar_color1(obj){
obj.style.background='#FFF1BB';
obj.style.border='#C0C0C0 solid 1px';
}

function Asig_suc(obj){
if(document.form1.chksuc.checked){
	//alert('Todos');
	document.form1.Sucursal.disabled=true;
	document.form1.succod.value="T"
}else{
	//alert('Uno');
	document.form1.Sucursal.disabled=false;
	document.form1.succod.value=document.form1.Sucursal.value;
}
}

function cambiar_color2(obj){
obj.style.background='#F3F3F3';
obj.style.border=' ';
}

function enfocar_cbo(e){}
function limpiar_enfoque(e){}
function cambiar_enfoque(e){}
function activar(tipo){
	if(tipo=='ven'){
		if(document.form1.ckbven.checked==true){
		document.form1.vendedor.disabled=false;
		}else{
		document.form1.vendedor.disabled=true;
		}
	}
	if(tipo=='mosdoc1'){	
		document.form1.ckbDoc[1].checked=false;
		document.form1.ckbDoc[2].checked=false;
	}	
	if(tipo=='mosdoc2'){
		document.form1.ckbDoc[0].checked=false;
	}
	if(tipo=='mosdoc3'){
		document.form1.ckbDoc[0].checked=false;
	}
}
function mostrar_print(valor){
	CargarClienteExcel();
	//alert();
}

function countValues(aVals){
var aRes = new Array();
var nPrev = aVals[0];
var nCount = 0;
for (var i = 0; i < aVals.length; i++){
 if (aVals[i] != nPrev){
  if (nPrev != -1)
   //aRes.push(new Array(nPrev, nCount));
    aRes.push(new Array(nPrev));
  nCount = 1;
  nPrev = aVals[i];
 } else nCount++;
}
//aRes.push(new Array(nPrev, nCount));
aRes.push(new Array(nPrev));
return aRes;
}	
</script>
