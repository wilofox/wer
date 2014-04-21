<?php 
session_start();
include('../conex_inicial.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<script src="../jquery-1.2.6.js"></script>
<script src="../jquery.hotkeys.js"></script>

<script language="JavaScript">
jQuery(document).bind('keydown', 'f3',function (evt){jQuery('#_f3').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
//		if (document.getElementById('btn1').disabled==false){	
			add_Orden();
//		}
 return false; }); 
jQuery(document).bind('keydown', 'f4',function (evt){jQuery('#_f4').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		if (document.getElementById('btn1').disabled==false){
			Anular('E');
		}
 return false; }); 
jQuery(document).bind('keydown', 'f5',function (evt){jQuery('#_f5').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		if (document.getElementById('btn2').disabled==false){
			Anular('A');
		}
 return false; }); 
 jQuery(document).bind('keydown', 'f6',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		if (document.getElementById('btn3').disabled==false){
			//Anular('');
			FuncionOT(this,'OBS')
		}	
 return false; }); 
 jQuery(document).bind('keydown', 'f8',function (evt){jQuery('#_f8').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		//doc_det(document.form1.XDato.value);
		doc_det(this);
		
 return false; }); 
  jQuery(document).bind('keydown', 'f7',function (evt){jQuery('#_f7').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		//doc_det(document.form1.XDato.value);
		Imprimir();
		
 return false; }); 
  jQuery(document).bind('keydown', 'f10',function (evt){jQuery('#_f10').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		//doc_det(document.form1.XDato.value);
		Mod_Cn(this);
		
 return false; }); 
  jQuery(document).bind('keydown', 'f9',function (evt){jQuery('#_f9').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		FuncionOT(this,'ADJ');
		
 return false; }); 
  jQuery(document).bind('keydown', 'f12',function (evt){jQuery('#_f12').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		FuncionOT(this,'TER');
		
 return false; }); 
</script>

<script language="javascript">
function recargar(){
document.getElementById('btn1').disabled="disabled";	
document.getElementById('btn2').disabled="disabled";
document.getElementById('btn3').disabled="disabled";

var almacen=document.form1.almacen.value;
var cliente=document.form1.cliente.value;
var ruc=document.form1.ruc.value;
var ckbven=document.form1.ckbven.checked;
var vendedor='';
	if (ckbven){
		var vendedor=document.form1.vendedor.value;
	}
var docref=document.form1.docref.value;
var fec1=document.form1.fec1.value;
var fec2=document.form1.fec2.value;
var mosdocFac='';
var mosdocAnu='';
if (document.form1.ckbDoc[0].checked){ var mosdocFac=''; var mosdocAnu=''; }
if (document.form1.ckbDoc[1].checked){ var mosdocFac='B'; }
if (document.form1.ckbDoc[2].checked){ var mosdocAnu='A'; }

var pagina=document.form1.pag.value;

	var variable_post=$actual;
	$("#detalle").fadeOut(function() {
		$.post('lista_GenDocRef.php?almacen='+almacen+'&cliente='+cliente+'&ruc='+ruc+'&vendedor='+vendedor+'&docref='+docref+'&fec1='+fec1+'&fec2='+fec2+'&mosdocFac='+mosdocFac+'&mosdocAnu='+mosdocAnu+'&pagina='+pagina, { variable: variable_post }, function(data){	
		$("#detalle").html(data).fadeIn();
		});			
	});
}

$actual=0;
//timer = setInterval("recargar()", 20000);
</script>

<script language="javascript" src="../miAJAXlib2.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
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
-->
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
	//'#E9F3FE';
	temp=objeto;
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
	//document.form1.almcod.value=document.form1.almacen.value;
}	

function verOrder(id){
	document.getElementById(id).style.visibility="visible";
}
function ordenar(campoOrder,formaOrder){
document.form1.tpcampo.value=campoOrder;
document.form1.tporden.value=formaOrder;
cargardatos('');
document.getElementById("divOrder").style.visibility="hidden";
document.getElementById("divOrder2").style.visibility="hidden";
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
</script>


<body onLoad="document.form1.almacen.focus(); cargardatos('');CarCodT();">

<form id="form1" name="form1" method="post" action="">
  <table width="807" height="413" border="0" cellpadding="0" cellspacing="0">
    
    <tr style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="5" height="23">&nbsp;</td>
      
	   <td width="802" height="25" colspan="11" style="border:#999999">
	  <span class="Estilo100">Finanzas : Seguimiento de Pagos y Cobranzas </span>	  
<input type="hidden" name="carga" id="carga" value="N">	  </td>	  
    </tr>
    <tr>
      <td height="26">&nbsp;</td>
      <td>	  
	    <table width="99%" height="21" border="0" cellpadding="0" cellspacing="0" style="border-bottom:#CCCCCC solid 1px ;display:none">
          <tr>
            <td width="80" >
                <table title="Grabar [F2]" width="80" height="21" border="0" cellpadding="0" cellspacing="0">
                  <tr onClick="javascript:grabar_doc()" onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer;">
                    <td width="3" ></td>
                    <td width="20" ><span class="Estilo112"><img src="../imgenes/revert.png" width="14" height="16"></span></td>
                    <td width="54" ><span class="Estilo112">Grabar<span class="Estilo113">[F2]</span></span></td>
                    <td width="3" style="border:#666666 solid 1px" ></td>
                  </tr>
              </table></td>
            <td width="72" ><table  title="Salir [Esc]"width="72" height="21" border="0" cellpadding="0" cellspacing="0">
                <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="salir()">
                  <td width="3" ></td>
                  <td width="20" ><img src="../imagenes/salir.JPG"  width="16" height="16" border="0"></td>
                  <td width="46" ><span class="Estilo112">Salir<span class="Estilo113">[Esc]</span></span></td>
                  <td width="3" ></td>
                </tr>
            </table></td>
            <td width="82">&nbsp;</td>
            <td width="76">&nbsp;</td>
            <td width="80">&nbsp;</td>
            <td width="70">&nbsp;</td>
            <td width="71">&nbsp;</td>
            <td width="192">&nbsp;</td>
          </tr>
        </table>
		 <table width="99%" height="21" border="0" cellpadding="0" cellspacing="0" style="border-bottom:#CCCCCC solid 1px">
        <tr>
		  <td width="139" >
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
		  </script></td>
		  <td width="27" >&nbsp;</td>
          <td width="90">&nbsp;</td>
          <td width="95">&nbsp;</td>
          <td width="98"><table  title="Modificar [F4]"width="100%" height="20" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="Anular('E')">
              <td width="1" ></td>
              <td width="17" ><img src="../imgenes/AdminAddresses.gif"  width="16" height="16" border="0"></td>
              <td width="67" ><span class="Estilo112"> Eliminar <span class="Estilo113">[F4]</span></span></td>
              <td width="13" ></td>
            </tr>
          </table></td>
          <td width="73"><table  title="Modificar Condicion [F10]"width="91%" height="20" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="">
              <td width="1" ></td>
              <td width="16" ></td>
              <td width="24" ></td>
              <td width="25" ></td>
            </tr>
          </table></td>
          <td width="152"><table  title="Imprimir [F7]"width="87%" height="20" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="Imprimir()">
              <td width="1" ></td>
              <td width="22" ><img src="../imgenes/fileprint.gif"  width="16" height="16" border="0"></td>
              <td width="102" ><span class="Estilo112"> Imprimir Reporte<span class="Estilo113">[F7]</span></span></td>
              <td width="7" ></td>
            </tr>
          </table></td>
          <td width="122"><table  title="Documento de Origen [F8]"width="93%" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="doc_det(this)">
              <td width="2" ></td>
              <td width="22" ><img src="../imagenes/ico_lupa.png"  width="16" height="16" border="0"></td>
              <td width="87" ><span class="Estilo112">Doc. Origen<span class="Estilo113">[F8]</span></span></td>
              <td width="4" ></td>
            </tr>
          </table></td>
        </tr>
      </table>
		
	    <table width="795" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="85"><div align="right"><span class="Estilo114">Tiendas : </span></div></td>
            <td colspan="3"><select  name="almacen" id="almacen" style="width:200" onChange="CarCodT()">
			<option value="0">Todos</option>
                <?php 		
  $resultados1 = mysql_query("select * from tienda order by des_tienda ",$cn); 
  $k=0;
while($row1=mysql_fetch_array($resultados1))
{
		?>
                <option value="<?php echo $row1['cod_tienda'] ?>"><?php echo $row1['des_tienda'] ?></option>
                <?php   
	$k++;
		}?>
              </select></td>
            <td width="110" class="Estilo114"><div align="right">
              <input name="ckbven" type="checkbox" id="ckbven" style="border: 0px; background-color:#F9F9F9; " onClick="activar('ven')"  value="checkbox">
            Vendedor : </div></td>
            <td width="227"><span class="Estilo15"><span class="Estilo114">
              <select name="vendedor" id="vendedor" style="width:200"  disabled>
                <?php 
		    $resultados11 = mysql_query("select * from usuarios order by usuario ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			if($row11['codigo']==$_SESSION['codvendedor']){
			}
			
		  ?>
                <option <?php echo $marcar?> value="<?php echo $row11['codigo']?>"><?php echo $row11['usuario'];?></option>
                <?php }?>
              </select>
            </span></span></td>
            <td width="18" class="Estilo114" >&nbsp;</td>
            <td width="76" rowspan="4" class="Estilo114" >
			  <table onClick="cargardatos('')"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="86%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="center"><img  src="../imagenes/ico_lupa.png" width="22" height="22"></td>
                </tr>
                <tr>
                  <td height="24" align="center"><span class="Estilo9 Estilo13">Procesar</span></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td ><div align="right">Cliente : </div></td>
            <td width="152"><input name="cliente" type="text" id="cliente"  style="height:20; border-color:#CCCCCC"  size="25" maxlength="100" autocomplete="off" ></td>
            <td width="32" class="Estilo114"><div align="right">Ruc : </div></td>
            <td width="95" class="Estilo114"><input name="ruc" type="text" id="ruc"  style="height:20; border-color:#CCCCCC" size="11" maxlength="11" autocomplete="off"></td>
            <td class="Estilo114"><div align="right">Documento: </div></td>
            <td><span class="Estilo15">
              <select name="docref" id="docref" style="width:200"  >
			  <option value="0">Todos</option>			
                <?php 
	$resultados11 = mysql_query("select * from operacion where tipo ='1'  and codigo='S1' or codigo='R1' order by descripcion ",$cn); 
	while($row11=mysql_fetch_array($resultados11)){
					
		  ?>
                <option value="<?php echo $row11['codigo']?>"><?php echo $row11['codigo'].' - '.$row11['descripcion'];?></option>
                <?php 
			  }
			  ?>
              </select>
            </span></td>
            <td class="Estilo114">&nbsp;</td>
          </tr>
          <tr>
            <td height="27"><div align="right">Fecha  : </div></td>
            <td colspan="3"> de 
              <input name="fec1" type="text" size="10" maxlength="50" value="<?php echo date("d-m-Y", strtotime(date('d-m-Y')." -30 day")); ?>"  >
                <button type="reset" id="f_trigger_b2"  style="height:18" >...</button>
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
              Hasta
              <input name="fec2" type="text" size="10" maxlength="50"  value="<?php echo date('d-m-Y')?>" >
              <button type="reset" id="f_trigger_b1" style="height:18; vertical-align:top" >...</button>
              <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fec2",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b1",   
        singleClick    :    true,           
        step           :    1                
    });
              </script>
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
            <td colspan="2" class="Estilo114">
			<div align="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="Estilo116">Estado</span>
              <select name="select" onChange="cambiarEstado(this)">
                <option value="and estadoOT=T">Terminado</option>
                <option value="and flag=A">Anulado</option>
                <option value="and estadoOT=O">Observado</option>
                <option value="P" selected>Pendiente</option>
                <option value="T">Todos</option>
              </select>
			  </div>
			</td>
            <td class="Estilo114">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="3"> <input name="Estado" type="hidden" id="Estado" value="" ><input name="tpcampo" type="hidden" id="tpcampo" value="" ><input name="tporden" type="hidden" id="orden" value="" ></td>
            <td class="Estilo114">&nbsp;</td>
            <td>&nbsp;</td>
            <td class="Estilo114">&nbsp;</td>
          </tr>
        </table>      </td>
    </tr>
    <tr>
      <td height="242">&nbsp;</td>
	  
      <td valign="top"><table width="800" border="0" cellpadding="0" cellspacing="1">
        <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
          <td   style=" border:#CCCCCC solid 1px" width="25" height="21" align="center" ><span class="texto2"><strong>OK</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="29" align="center"><span class="texto1">
            <input style="border: 0px; background:none; " type="checkbox" name="Cod" onClick="marcar()"   />
          </span></td>
          <td  style=" border:#CCCCCC solid 1px" width="77" ><strong class="texto2">Local</strong></td>
          <td width="78" align="center"  style=" border:#CCCCCC solid 1px"><span class="texto2"><strong>Fec.Recibido </strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="127" ><span class="texto2"><strong>Cliente<img src="../imgenes/arrowmain.gif" width="8" height="16" onClick="verOrder('divOrder')" style="cursor:pointer"></strong></span>
		  	  &nbsp;
		  <div id="divOrder" style="position:absolute; left: 268px; top: 153px; height: 48px; width: 95px; visibility:hidden">
		    <table width="75" height="48" border="1"  bgcolor="#1DC0BC">
              <tr>
                <td><table width="92" border="0" cellpadding="0" cellspacing="0">
                  <tr  onMouseOver="entradaOrder(this)" onMouseOut="entradaOrder(this)" style="cursor:pointer" onClick="ordenar('C.razonsocial','asc')">
                    <td height="18" class="Estilo118 Estilo119 Estilo121" style="font:bold; color:#FFFFFF">&nbsp;Ascendente</td>
                  </tr>
                  <tr onMouseOver="entradaOrder(this)" onMouseOut="entradaOrder(this)" style="cursor:pointer" onClick="ordenar('C.razonsocial','desc')" >
                    <td height="18" class="Estilo118 Estilo119 Estilo121" style="font:bold; color:#FFFFFF">&nbsp;Descendente</td>
                  </tr>
                </table></td>
              </tr>
            </table>
		  </div>
		  </td>
          <td  style=" border:#CCCCCC solid 1px" width="131"><span class="texto2"><strong>Articulo<img src="../imgenes/arrowmain.gif" width="8" height="16" onClick="verOrder('divOrder2')" style="cursor:pointer"></strong></span>
		  		  	  &nbsp;
		  <div id="divOrder2" style="position:absolute; left: 400px; top: 153px; height: 48px; width: 95px; visibility:hidden">
		    <table width="75" height="48" border="1"  bgcolor="#1DC0BC">
              <tr>
                <td><table width="92" border="0" cellpadding="0" cellspacing="0">
                  <tr  onMouseOver="entradaOrder(this)" onMouseOut="entradaOrder(this)" style="cursor:pointer" onClick="ordenar('n_prod','asc')">
                    <td height="18" class="Estilo118 Estilo119 Estilo121" style="font:bold; color:#FFFFFF">&nbsp;Ascendente</td>
                  </tr>
                  <tr onMouseOver="entradaOrder(this)" onMouseOut="entradaOrder(this)" style="cursor:pointer" onClick="ordenar('n_prod','desc')" >
                    <td height="18" class="Estilo118 Estilo119 Estilo121" style="font:bold; color:#FFFFFF">&nbsp;Descendente</td>
                  </tr>
                </table></td>
              </tr>
            </table>
		  </div>
		  </td>
          <td  style=" border:#CCCCCC solid 1px" width="87" ><span class="texto2"><strong>Referencia</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="93" ><span class="texto2"><strong>Condici&oacute;n </strong></span></td>
          <td width="81"  style=" border:#CCCCCC solid 1px" align="center" ><span class="texto2"><strong>Fec.Entrega</strong></span></td>
          <td width="36"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Adj.</strong></span></td>
          <td width="28"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Obs.</strong></span></td>
          </tr>
        <tr>
          <td colspan="11">
		  <div id="detalle" style="width:800px; height:180px;" ><span class="Estilo114">
 <input name="almcod" type="hidden" disabled id="almcod"  style="height:20; border-color:#CCCCCC" size="8"></span></div> </td>
          </tr>
     </table>
	 <div style="visibility:hidden">
      <span class="Estilo114"><b>Mostrar Documento:</b></span>
      <input name="ckbDoc" type="checkbox" id="ckbDoc" style="border: 0px; background-color:#F9F9F9; " checked   onClick="activar('mosdoc1');cargardatos('')" > 
      Todos
	  <input name="ckbDoc" type="hidden" id="ckbDoc" style="border: 0px; background-color:#F9F9F9; " onClick="activar('mosdoc2');cargardatos('')" title="Solo Facturados" > 
	  <input name="ckbDoc" type="checkbox" id="ckbDoc" style="border: 0px; background-color:#F9F9F9; " onClick="activar('mosdoc3');cargardatos('')" > 
	  Solo Anulados	
	  </div>
	  </td>
    </tr>
    <tr>
      <td height="15">&nbsp;</td>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="115"><table width="58%" height="27" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><table width="114" height="36" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td bgcolor="#FF0000"><div align="center" class="text9">ANULADO</div></td>
                    </tr>
                    <tr>
                      <td bgcolor="#0066FF"><div align="center" class="text9">TERMINADO</div></td>
                    </tr>
                </table></td>
              </tr>
          </table></td>
          <td width="17">&nbsp;</td>
          <td width="90"><!--<table onClick="FuncionOT2(this,'EST')"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="95%" border="0" cellpadding="0" cellspacing="0" id="btn5" >
            <tr>
              <td align="center"><img src="../images/view_choose.gif" width="28" height="28"></td>
            </tr>
            <tr>
              <td height="24" align="center" ><span class="Estilo100"><span style="color:#FF3300">[F2]</span> Estado </span></td>
            </tr>
          </table>--></td>
          <td width="89"><table onClick="add_Orden()"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="87%" border="0" cellpadding="0" cellspacing="0"  id="btn6" >
              <tr>
                <td align="center"><img src="../imagenes/iconohoja.gif" width="22" height="24"></td>
              </tr>
              <tr>
                <td height="24" align="center" ><span class="Estilo100"><span style="color:#FF3300">[F3]</span> Orden </span></td>
              </tr>
          </table></td>
          <td width="90">
		  
		  <table onClick="Anular('A')"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="92%" border="0" cellpadding="0" cellspacing="0"  id="btn2" disabled="disabled" >
            <tr>
              <td align="center"><img  src="../imagenes/cerrar.jpg" width="22" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100"><span style="color:#FF3300">[F5]</span> Anular</span></td>
            </tr>
          </table>
		  
	<table onClick="Anular('')"  style="cursor:pointer; display:none" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="95%" border="0" cellpadding="0" cellspacing="0"  id="btn7" >
            <tr>
              <td align="center"><img  src="../imagenes/cerrar.jpg" width="22" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" style="font-size:9px"><span style="color:#FF3300;">[F5]</span> Desanular</span></td>
            </tr>
          </table>
		  
		  
		  </td>
          <td width="103"><table onClick="FuncionOT(this,'OBS')"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="95%" border="0" cellpadding="0" cellspacing="0"  id="btn3" disabled="disabled" >
            <tr>
              <td align="center"><img  src="../imgenes/AdminFeatures.gif" width="20" height="20"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100"><span style="color:#FF3300">[F6]</span> Observa</span></td>
            </tr>
          </table></td>
          <td width="91"><table onClick="FuncionOT(this,'ADJ')"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="93%" border="0" cellpadding="0" cellspacing="0"  id="btn4" disabled="disabled" >
            <tr>
              <td align="center"><img src="../imgenes/archivo.jpg" width="22" height="20"></td>
            </tr>
            <tr>
              <td height="24" align="center" ><span class="Estilo100"><span style="color:#FF3300">[F9]</span> Archivo </span></td>
            </tr>
          </table></td>
          <td width="120"><table onClick="FuncionOT(this,'TER')"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="95%" border="0" cellpadding="0" cellspacing="0" disabled id="btn1">
            <tr>
              <td align="center"><img  src="../imgenes/email_edit.gif" width="20" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" ><span style="color:#FF3300">[F12]</span> Entrega </span></td>
            </tr>
          </table></td>
          <td width="39">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
 <div id="AnularRk" style="position:absolute; visibility:hidden; left: 266px; top: 190px; width: 240px; height: 38px;"></div>
  <div id="FactuaRk" style="position:absolute; left:208px; top:114px; width:300px; height:180px; z-index:1; visibility:hidden">  </div>
  
  

</body>
</html>

<script>
var fecha_act="<?php echo date('d-m-Y');?>";
var user_nivel="<?php echo $_SESSION['nivel_usu'];?>";
//alert(user_nivel);
function cargardatos(pagina){
document.getElementById('btn1').disabled="disabled";	
document.getElementById('btn2').disabled="disabled";
document.getElementById('btn3').disabled="disabled";
document.getElementById('btn4').disabled="disabled";
//document.getElementById('btn6').disabled="disabled";

var almacen=document.form1.almacen.value;
var cliente=document.form1.cliente.value;
var fec1=document.form1.fec1.value;
var fec2=document.form1.fec2.value;
var ruc=document.form1.ruc.value;
var ckbven=document.form1.ckbven.checked;
var Estado=document.form1.Estado.value;
var campoOrder=document.form1.tpcampo.value;
var formaOrder=document.form1.tporden.value;
var vendedor='';
	if (ckbven){
		var vendedor=document.form1.vendedor.value;
	}
var docref=document.form1.docref.value;
var mosdocFac='';
var mosdocAnu='';
if (document.form1.ckbDoc[0].checked){ var mosdocFac=''; var mosdocAnu=''; }
if (document.form1.ckbDoc[1].checked){ var mosdocFac='B'; }
if (document.form1.ckbDoc[2].checked){ var mosdocAnu='A'; }
//alert(mosdocFac+'//'+mosdocAnu);
//var pagina=document.form1.pag.value;


doAjax('lista_GenDocRef.php','&almacen='+almacen+'&cliente='+cliente+'&pagina='+pagina+'&ruc='+ruc+'&vendedor='+vendedor+'&fec1='+fec1+'&fec2='+fec2+'&docref='+docref+'&mosdocFac='+mosdocFac+'&mosdocAnu='+mosdocAnu+'&Estado='+Estado+'&campoOrder='+campoOrder+'&formaOrder='+formaOrder,'mostrar_filtro','get','0','1','','');

//setInterval("cargardatos('')", 20000);
}

function Mod_Cn(d){
	valor='';
	if (document.form1.xcodigo.length==undefined){
		if (document.form1.xcodigo.checked  ){
			valor=document.form1.xcodigo.value;
		}
	}else{
		for(i=0;i<document.form1.xcodigo.length;i++){
			if (document.form1.xcodigo[i].checked  ){
				valor=document.form1.xcodigo[i].value;
			}
		}
	}
	if(valor==''){
		alert('Debe Seleccionar un documento');
	}else{
		fdoc=document.getElementById('C'+valor).value;
		if(fecha_act==fdoc || user_nivel=="5"){
			mdcon(valor);
		}else{
			alert('No se puede cambiar la condicion a un documento anterior');
		}
	}
}

function mdcon(valor){
	doAjax('anular.php','&CodDoc='+valor+'&CCond','prueba','get','0','1','','');
}

function prueba(){
	cargardatos('');
}

function Imprimir(){
document.getElementById('btn1').disabled="disabled";	
document.getElementById('btn2').disabled="disabled";
document.getElementById('btn3').disabled="disabled";
document.getElementById('btn4').disabled="disabled";
//document.getElementById('btn6').disabled="disabled";

var almacen=document.form1.almacen.value;
var cliente=document.form1.cliente.value;
var fec1=document.form1.fec1.value;
var fec2=document.form1.fec2.value;
var ruc=document.form1.ruc.value;
var ckbven=document.form1.ckbven.checked;
var Estado=document.form1.Estado.value;
var campoOrder=document.form1.tpcampo.value;
var formaOrder=document.form1.tporden.value;
var vendedor='';
	if (ckbven){
		var vendedor=document.form1.vendedor.value;
	}
var docref=document.form1.docref.value;
var mosdocFac='';
var mosdocAnu='';
if (document.form1.ckbDoc[0].checked){ var mosdocFac=''; var mosdocAnu=''; }
if (document.form1.ckbDoc[1].checked){ var mosdocFac='B'; }
if (document.form1.ckbDoc[2].checked){ var mosdocAnu='A'; }
//alert(mosdocFac+'//'+mosdocAnu);
//var pagina=document.form1.pag.value;


window.open('lista_GenDocRef_imp.php?almacen='+almacen+'&cliente='+cliente+'&ruc='+ruc+'&vendedor='+vendedor+'&fec1='+fec1+'&fec2='+fec2+'&docref='+docref+'&mosdocFac='+mosdocFac+'&mosdocAnu='+mosdocAnu+'&Estado='+Estado+'&campoOrder='+campoOrder+'&formaOrder='+formaOrder);

//setInterval("cargardatos('')", 20000);
}

function mostrar_filtro(texto){
document.getElementById('detalle').innerHTML=texto;
cargar();
document.form1.carga.value='N';
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
function AnularDoc(valor,condicion,elegir){
	//if(elegir==""){
	document.getElementById('AnularRk').style.visibility='hidden';
	//document.getElementById('AnularRk').style.visibility='visible';
	//}
	document.form1.carga.value='S';
	//alert(elegir);
	doAjax('anular.php','&CodDoc='+valor+'&Condicion='+condicion+'&'+elegir,'UpdateAnulado','get','0','1','','');
}
function UpdateAnulado(texto){
//alert(texto);
var r = texto;
	var valor="";
	var temp_criterio='';
	//if(r!="Eliminado"){
	document.getElementById('AnularRk').innerHTML=r;
	//document.getElementById('AnularRk').style.visibility='visible';
	//}
}

function Anular(objeto){
	var e="";
	if (objeto=='A'){
		if(confirm("Esta seguro de ANULAR los documentos seleccionados")){
		}else{
			return false;
		}
 	}
 	if (objeto==''){
		if(confirm("DESANULAR documentos seleccionados")){
		}else{
			return false;
		}
 	}
  	if(objeto=='E'){
		if(confirm("Esta seguro de ELIMINAR los documentos seleccionados")){
			e="Elim";
		}else{
			return false;
		}
	}
		//alert(objeto);
		//alert(e);
	document.getElementById('btn1').disabled="disabled";	
	document.getElementById('btn2').disabled="disabled";
	document.getElementById('btn3').disabled="disabled";
	document.getElementById('btn4').disabled="disabled";
		//document.getElementById('btn6').disabled="disabled";
	if(e==""){
		document.getElementById('btn7').style.display='none';
		document.getElementById('btn2').style.display='block';
	}
	if (document.form1.xcodigo.length==undefined){
		var valor="";
		if (document.form1.xcodigo.checked  ){
			if (objeto=='S'){
				document.getElementById('btn1').disabled="";
				document.getElementById('btn2').disabled="";
				document.getElementById('btn4').disabled="";
				//document.getElementById('btn5').disabled="";
				document.getElementById('btn6').disabled="";
				document.getElementById('btn3').disabled="";
				document.getElementById('btn7').style.display='none';
				document.getElementById('btn2').style.display='block';							
			}else{
				if(objeto!='E'){
					document.getElementById('btn2').style.display='none';
			    	document.getElementById('btn7').style.display='block';	
				}
			}
			valor=document.form1.xcodigo.value;
			fdoc=document.getElementById('C'+valor).value;
			if (objeto=='A' || objeto=='' || objeto=='E'){ 
				if(fecha_act==fdoc || user_nivel=="5"){
					AnularDoc(document.form1.xcodigo.value,objeto,e);
				}else{
					alert("No puede Eliminar/Anular/Desanular Documentos de Fechas Anteriores");
				}
			}
		}	
	}else{
		var valor="";
		for(var i=0;i<document.form1.xcodigo.length;i++){
			if (document.form1.xcodigo[i].checked ){
				if (objeto=='S'){
					document.getElementById('btn1').disabled="";
					document.getElementById('btn2').disabled="";
					document.getElementById('btn4').disabled="";
					//document.getElementById('btn5').disabled="";
					document.getElementById('btn6').disabled="";
					document.getElementById('btn3').disabled="";
					document.getElementById('btn7').style.display='none';
					document.getElementById('btn2').style.display='block';							
				}else{
					if(objeto!='E'){
						document.getElementById('btn2').style.display='none';
				    	document.getElementById('btn7').style.display='block';						
					}
				}
				valor=document.form1.xcodigo[i].value;
				fdoc=document.getElementById('C'+valor).value;
				if (objeto=='A' || objeto=='' || objeto=='E'){ 
					if(fecha_act==fdoc || user_nivel=="5"){
						AnularDoc(document.form1.xcodigo[i].value,objeto,e);
					}else{
						alert("No puede Eliminar/Anular/Desanular Documentos de Fechas Anteriores");
					}
				}
			}
		}	
	}
	if (objeto=='A'  || objeto=='' || objeto=='E'){	
		cargardatos(''); 
	}
}
function marcar(){
	if(document.form1.Cod.checked){
		for(var i=0;i<document.form1.xcodigo.length;i++){
		    if (document.form1.xcodigo[i].disabled){			
			}else{
			document.form1.xcodigo[i].checked=true;
			}			
		document.getElementById('btn1').disabled="";
		document.getElementById('btn2').disabled="";
		}		
	}else{
		for(var i=0;i<document.form1.xcodigo.length;i++){
			document.form1.xcodigo[i].checked=false;
			document.getElementById('btn1').disabled="disabled";	
			document.getElementById('btn2').disabled="disabled";
			}	
	}
	
}
function doc_det(valor){
	if (document.form1.XDato.length==undefined){
		var valor=document.form1.XDato.value;
	}else{
		for(var i=0;i<document.form1.XDato.length;i++){
				if (document.form1.XDato[i].checked){
					var valor=document.form1.XDato[i].value;
				}
		}
	}	
	
//open  showModalDialog
window.open("../doc_det2.php?referencia="+valor,valor,"toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=320,left=300 top=250");

}
function Facturar(objeto){
	if (document.form1.xcodigo.length==undefined){
		if (document.form1.xcodigo.checked  ){		
			//alert(document.form1.xcodigo.value,objeto);
			Comprobante(document.form1.xcodigo.value,objeto);
		}
	}else{
	var cantidad = 0;
		for(var i=0;i<document.form1.xcodigo.length;i++){
			if (document.form1.xcodigo[i].checked ){	
			cantidad++;
			var codigoRk1 =document.form1.xcodigo[i].value,objeto;
			//alert(document.form1.xcodigo[i].value,objeto);
			//Comprobante(document.form1.xcodigo[i].value,objeto);
			}			
		}
		//temporalmenta
		//alert(cantidad)
			if (cantidad==1){
			Comprobante(codigoRk1);
			}else{ alert ('Seleccione un solo documento');}
			
	}

}
//open  showModalDialog
function Comprobante(valor){
	var datos = window.showModalDialog("comprobante.php?codigo="+valor,"","dialogWidth:610px;dialogHeight:540px,top=100,left=200,status=yes,scrollbars=yes");
	cargardatos('');
}

function add_Orden(){
	var randomnumber=Math.floor(Math.random()*99999);
	window.open("ordenTG.php?"+randomnumber,"","Width=650px Height=450px,top=100,left=200,status=yes,scrollbars=yes");
}
function mod_Orden(){
	//alert(date(d-m-Y));
	var randomnumber=Math.floor(Math.random()*99999);
	if (document.form1.XDato.length==undefined){
		var valor=document.form1.XDato.value;
	}else{
		for(var i=0;i<document.form1.XDato.length;i++){
				if (document.form1.XDato[i].checked){
					var valor=document.form1.XDato[i].value;
				}
		}
	}		

	if(document.getElementById('C'+valor).value==fecha_act){
		window.open("ordenTG.php?"+randomnumber+"&referencia="+valor,"","Width=650px Height=450px,top=100,left=200,status=yes,scrollbars=yes");
	}else{
		alert('Solo se pueden Modificar ordenes del Dia');
	}
}

function FuncionOT(Codigo,Valor){
	if (document.form1.xcodigo.length==undefined){
		if (document.form1.xcodigo.checked  ){
			//AnularDoc(document.form1.xcodigo.value,objeto);
			codigo=document.form1.xcodigo.value;
			window.open("funcionST.php?CodDoc="+codigo+"&Fun="+Valor+"&ventana=tg", "ventana1" , "width=550,height=250,scrollbars=NO,top=100,left=200") 
		}	
	}else{
		for(var i=0;i<document.form1.xcodigo.length;i++){
				if (document.form1.xcodigo[i].checked ){
					//alert(document.form1.xcodigo.value)	
					codigo=document.form1.xcodigo[i].value;
					window.open("funcionST.php?CodDoc="+codigo+"&Fun="+Valor+"&ventana=tg", "ventana1" , "width=550,height=250,scrollbars=NO,top=100,left=200") 
				}		
			}	
	}	
	
	
		
}
function FuncionOT2(Codigo,Valor){
	window.open("funcionST.php?Fun="+Valor+"&ventana=tg", "ventana1" , "width=550,height=250,scrollbars=NO,top=100,left=200") 
}
function cambiarEstado(obj){
document.form1.Estado.value=obj.value;
cargardatos('');
}
</script>