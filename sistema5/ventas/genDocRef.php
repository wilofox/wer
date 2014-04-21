<?php 
include('../conex_inicial.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<script src="../jquery-1.2.6.js"></script>
<script src="../jquery.hotkeys.js"></script>

<script language="JavaScript">
jQuery(document).bind('keydown', 'f3',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		if (document.getElementById('btn1').disabled==false){
			Facturar(this);
		}
 return false; }); 
jQuery(document).bind('keydown', 'f5',function (evt){jQuery('#_f6').addClass('dirty');
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
			Anular('');
		}	
 return false; }); 
 jQuery(document).bind('keydown', 'f8',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		//doc_det(document.form1.XDato.value);
		doc_det(this);
		
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
		lista_GenDocRef.php	
		$.post('lista_milifactura.php?almacen='+almacen+'&cliente='+cliente+'&ruc='+ruc+'&vendedor='+vendedor+'&docref='+docref+'&fec1='+fec1+'&fec2='+fec2+'&mosdocFac='+mosdocFac+'&mosdocAnu='+mosdocAnu+'&pagina='+pagina, { variable: variable_post }, function(data){	
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
.Estilo14 {
	font-size: 10px;
	font-family: tahoma, verdana, sans-serif;
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
document.form1.almcod.value=document.form1.almacen.value;
}	
	
</script>


<body onLoad="document.form1.almacen.focus(); cargardatos('');CarCodT();">

<form id="form1" name="form1" method="post" action="">
  <table width="810" height="413" border="0" cellpadding="0" cellspacing="0">
    
    <tr style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="5" height="23">&nbsp;</td>
      
	   <td width="760" height="25" colspan="11" style="border:#999999">
	  <span class="Estilo100">Ventas : Caja Facturacui&oacute;n de Pedidos</span>	  
<input type="hidden" name="carga" id="carga" value="N">	  
	  </td>	  
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
		  <td width="80" >
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
		  <table  title="Salir [Esc]"width="72" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="doc_det(this)">
                <td width="3" ></td>
                <td width="20" ><img src="../imagenes/ico_lupa.png"  width="16" height="16" border="0"></td>
                <td width="46" ><span class="Estilo112">Doc.<span class="Estilo113">[F8]</span></span></td>
                <td width="3" ></td>
              </tr>
          </table>
		  </td>
          <td width="72" >&nbsp;</td>
          <td width="82">&nbsp;</td>
          <td width="76">&nbsp;</td>
          <td width="80">&nbsp;</td>
          <td width="70">&nbsp;</td>
          <td width="71">&nbsp;</td>
          <td width="192">&nbsp;</td>
        </tr>
      </table>
		
	    <table width="795" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="85" height="26"><div align="right"><span class="Estilo114">Tiendas : </span></div></td>
            <td colspan="3"><span class="Estilo114">
              <input name="almcod" type="text" disabled id="almcod"  style="height:20; border-color:#CCCCCC" size="8">
              </span>
              <select  name="almacen" id="almacen" style="width:200" onChange="CarCodT()">
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
            <td width="76" rowspan="3" class="Estilo114" >
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
            <td class="Estilo114"><div align="right">Docs. de Ref.: </div></td>
            <td><span class="Estilo15">
              <select name="docref" id="docref" style="width:200" >
                <?php 
	$resultados11 = mysql_query("select * from operacion where tipo ='2' order by descripcion ",$cn); 
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
            <td height="27"><div align="right">Fecha Doc(S) : </div></td>
            <td colspan="3"><input name="fec1" type="text" size="10" maxlength="50" value="<?php echo date('d-m-Y')?>"  >
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
              </script></td>
            <td class="Estilo114"><div align="right">Doc(S). Ref. desde : </div></td>
            <td><input name="fec2" type="text" size="10" maxlength="50"  value="<?php echo date('d-m-Y')?>" >
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
            <td class="Estilo114">&nbsp;</td>
          </tr>
          <tr style="display:none" id="row_transp">
            <td height="25">&nbsp;</td>
            <td colspan="3">&nbsp;</td>
            <td class="Estilo114">&nbsp;</td>
            <td>&nbsp;</td>
            <td class="Estilo114">&nbsp;</td>
            <td class="Estilo114">&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td height="242">&nbsp;</td>
	  
      <td valign="top"><table width="800" border="0" cellpadding="0" cellspacing="1">
        <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
          <td   style=" border:#CCCCCC solid 1px" width="21" height="21" align="center" ><span class="texto2"><strong>OK</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="22" align="center"><span class="texto1">
            <input style="border: 0px; background:none; " type="checkbox" name="Cod" onClick="marcar()"   />
          </span></td>
          <td  style=" border:#CCCCCC solid 1px" width="52" align="center"><span class="texto2"><strong>TD</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="66" ><span class="texto2"><strong>N&uacute;mero</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="72" ><span class="texto2"><strong>Fec. de Emi </strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="45"><span class="texto2"><strong>Hora</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="242" ><span class="texto2"><strong>Cliente</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="61" ><span class="texto2"><strong>Mon</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="72" ><span class="texto2"><strong>Total</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="75" ><span class="texto2"><strong>Fac/Bol</strong></span></td>
          <td width="65"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Almac&eacute;n</strong></span></td>
          </tr>
        <tr>
          <td colspan="11">
		  <div id="detalle" style="width:800px; height:180px;" ></div>		  </td>
          </tr>
     </table>
      <span class="Estilo114"><b>Mostrar Documento:</b></span>
      <input name="ckbDoc" type="checkbox" id="ckbDoc" style="border: 0px; background-color:#F9F9F9; " checked   onClick="activar('mosdoc1');cargardatos('')" > 
      Todos
	  <input name="ckbDoc" type="hidden" id="ckbDoc" style="border: 0px; background-color:#F9F9F9; " onClick="activar('mosdoc2');cargardatos('')" title="Solo Facturados" > 
	  <input name="ckbDoc" type="checkbox" id="ckbDoc" style="border: 0px; background-color:#F9F9F9; " onClick="activar('mosdoc3');cargardatos('')" > 
	  Solo Anulados
	  </td>
    </tr>
    <tr>
      <td height="15">&nbsp;</td>
      <td><table width="764" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="235">
		  
		  <table width="100%" height="27" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td><table width="114" height="36" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td bgcolor="#FF0000"><div align="center" class="text9">ANULADO</div></td>
                </tr>
                <tr>
                  <td bgcolor="#00FF00"><div align="center" class="text9" style="color:#000000">CANCELADO</div></td>
                </tr>
              </table></td>
              <td><table width="114" height="36" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td bgcolor="#D7FFF0"><div align="center" class="text9" style="color:#000000">Doc. CON SERIE</div></td>
                </tr>
                <tr>
                  <td bgcolor="#FFDFF4"><div align="center" class="text9" style="color:#000000">Doc. CON PAGO</div></td>
                </tr>
              </table></td>
            </tr>
          </table>          </td>
          <td width="10">&nbsp;</td>
          <td width="98"><table onClick="Facturar(this)"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="96%" border="0" cellpadding="0" cellspacing="0" disabled id="btn1">
            <tr>
              <td align="center"><img  src="../imagenes/iconohoja.gif" width="16" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" >[F3]Cancelar</span></td>
            </tr>
          </table></td>
          <td width="87"><table onClick="Anular('A')"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="93%" border="0" cellpadding="0" cellspacing="0"  id="btn2" disabled="disabled" >
            <tr>
              <td align="center"><img  src="../imagenes/cerrar.jpg" width="22" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100">[F5]Anular</span></td>
            </tr>
          </table></td>
          <td width="330"><table onClick="Anular('')"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="37%" border="0" cellpadding="0" cellspacing="0"  id="btn3" disabled="disabled" >
            <tr>
              <td align="center"><img  src="../imagenes/cerrar.jpg" width="22" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100">[F6]Desanular</span></td>
            </tr>
          </table></td>
          <td width="72">&nbsp;</td>
        </tr>
      </table>
	 </td>
    </tr>
  </table>
</form>
 <div id="AnularRk" style="position:absolute; visibility:hidden; left: 266px; top: 190px; width: 240px; height: 38px;"></div>
  <div id="FactuaRk" style="position:absolute; left:208px; top:114px; width:300px; height:180px; z-index:1; visibility:hidden">  </div>
  
  

</body>
</html>

<script>

function cargardatos(pagina){
//alert(pagina);
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
//alert(mosdocFac+'//'+mosdocAnu);
//var pagina=document.form1.pag.value;

//lista_GenDocRef.php
doAjax('lista_milifactura.php','&almacen='+almacen+'&cliente='+cliente+'&pagina='+pagina+'&ruc='+ruc+'&vendedor='+vendedor+'&docref='+docref+'&fec1='+fec1+'&fec2='+fec2+'&mosdocFac='+mosdocFac+'&mosdocAnu='+mosdocAnu,'mostrar_filtro','get','0','1','','');

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
function AnularDoc(valor,condicion){
//alert(condicion);
	document.getElementById('AnularRk').style.visibility='hidden';
	document.getElementById('AnularRk').style.visibility='visible';
	document.form1.carga.value='S';
	doAjax('anular.php','&CodDoc='+valor+'&Condicion='+condicion,'UpdateAnulado','get','0','1','','');
}
function UpdateAnulado(texto){
//alert(texto);
var r = texto;
	var valor="";
	var temp_criterio='';
	document.getElementById('AnularRk').innerHTML=r;
	document.getElementById('AnularRk').style.visibility='visible';
}

function Anular(objeto){
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
  
//alert(objeto);
document.getElementById('btn1').disabled="disabled";	
document.getElementById('btn2').disabled="disabled";
document.getElementById('btn3').disabled="disabled";
	if (document.form1.xcodigo.length==undefined){
		if (document.form1.xcodigo.checked  ){
							if (objeto=='S'){
						document.getElementById('btn1').disabled="";
						document.getElementById('btn2').disabled="";	
							}else{
						document.getElementById('btn3').disabled="";
							}
							
			if (objeto=='A' || objeto==''){ 
			AnularDoc(document.form1.xcodigo.value,objeto);
			//alert(document.form1.xcodigo[i].value);	
			}
		}	
	}else{
			for(var i=0;i<document.form1.xcodigo.length;i++){
					if (document.form1.xcodigo[i].checked ){
							if (objeto=='S'){
						document.getElementById('btn1').disabled="";
						document.getElementById('btn2').disabled="";	
							}else{
							document.getElementById('btn3').disabled="";
							}
						
							if (objeto=='A' || objeto=='' ){ 
							AnularDoc(document.form1.xcodigo[i].value,objeto);
							//alert(document.form1.xcodigo[i].value);	
							}
					}		
				}	
	
	}
	if (objeto=='A'  || objeto==''){	cargardatos(''); }
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
window.open("../doc_det.php?referencia="+valor,valor,"toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=320,left=300 top=250");

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
</script>
