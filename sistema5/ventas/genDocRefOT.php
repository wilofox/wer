<?php 
session_start();
include('../conex_inicial.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<!--<script src="../jquery-1.2.6.js"></script>-->
<!--<script src="../js/jquery-1.4.2.js"></script>-->
<!--<script src="../js/jquery-1.6.1.js"></script>-->
<script src="../js/jquery.tools.min.js"></script>
<script src="../js/jquery.hotkeys2.js"></script>


<script language="JavaScript">
jQuery(document).bind('keydown', 'f3',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		if (document.getElementById('btn1').disabled==false){
			//Facturar(this);
			add_SM('SM');		
			
		}
 return false; }); 
jQuery(document).bind('keydown', 'f5',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		if (document.getElementById('abrirPop').disabled==false){
		//	Anular('A');
		document.getElementById("abrirPop").click();
		}
 return false; }); 
 jQuery(document).bind('keydown', 'f6',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		if (document.getElementById('btn3').disabled==false){
			//Anular('');
			FuncionOT(document.getElementById('btn3'),'OBS')
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

		enviar_excel('imp')
		
 return false; }); 
 
  jQuery(document).bind('keydown', 'f10',function (evt){jQuery('#_f10').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		if (document.getElementById('btn1').disabled==false){
			//Anular('');
			FuncionOT(document.getElementById('btn1'),'TER');
		}	
 return false; }); 



jQuery(document).bind('keydown', 'f11',function (evt){jQuery('#_f11').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		//doc_det(document.form1.XDato.value);
		//alert(document.getElementById("btn6").disabled);
		if(!document.getElementById("btn6").disabled){
		CostosOpe();
		}	
 return false; }); 
 
 jQuery(document).bind('keydown', 'f12',function (evt){
	event.keyCode=0;
	event.returnValue=false;
		//doc_det(document.form1.XDato.value);
		if(!document.getElementById("btn6").disabled){
		 activxPres();
		}
 return false; }); 
 
 
 $(document).bind('keydown', 'alt+s', function(){alert("bingo");});
</script>

<script language="javascript">
function recargar(){
document.getElementById('btn1').disabled="disabled";	
document.getElementById('abrirPop').disabled="disabled";
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
/*
if (document.form1.ckbDoc[0].checked){ var mosdocFac=''; var mosdocAnu=''; }
if (document.form1.ckbDoc[1].checked){ var mosdocFac='B'; }
if (document.form1.ckbDoc[2].checked){ var mosdocAnu='A'; }
*/

var pagina=document.form1.pag.value;

	var variable_post=$actual;
	$("#detalle").fadeOut(function() {
		//$.post("lista_GenDocRefOT.php", { variable: variable_post }, function(data){	
		$.post('lista_GenDocRefOT.php?almacen='+almacen+'&cliente='+cliente+'&ruc='+ruc+'&vendedor='+vendedor+'&docref='+docref+'&fec1='+fec1+'&fec2='+fec2+'&mosdocFac='+mosdocFac+'&mosdocAnu='+mosdocAnu+'&pagina='+pagina, { variable: variable_post }, function(data){	
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
.Estilo121 {color: #FFFFFF}
.Estilo122 {color: #333333}
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
	font-size: 10px;
	color:#003366;
	font:bold;
	
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
.Estilo114 {color: #FF3300}
.Estilo116 {color: #FF3300; font-weight: bold; }
.Estilo118 {font-size: 10px}
.Estilo119 {font-family: Verdana, Arial, Helvetica, sans-serif}

-->
img { behavior: url(iepngfix.htc); }
</style>



<LINK href="../css/tooltip.css" type=text/css rel=stylesheet>
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
var temp2="";
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
	
</script>


 <?php 
		  
		  if($_REQUEST['docRef']=='PO'){
		  $verBtn="hidden";
		  $nombreTer="Aprobado";
		  $titulo=" Presupuestos ";
		  
		  $eventoBtn1="CostosOpe()"; 
		  $teclaBtn1="[F11]";
		  $titBtn1="Costos Operativos";
		  
		  $eventoabrirPop="activxPres()"; 
		  $teclaabrirPop="[F12]";
		  $titabrirPop="Actividades de Obra";
		  
		  $eventoBtn3="utilxPres()"; 
		  $teclaBtn3="";
		  $titBtn3="Factores Utilidad";
		  
		  }else{
		  $verBtn="visible";
		  $nombreTer="Terminado";
		  $titulo=" O.T. ";
		  
		  $eventoBtn1="add_SM('SM')"; 
		  $teclaBtn1="[F3]";
		  $titBtn1="SM";
		  
          $eventoabrirPop="add_SM('RM')"; 
		  $teclaabrirPop="[F4]";
		  $titabrirPop="RM";
		  
		  $eventoBtn3="cajaGastos()"; 
		  $teclaBtn3="[F11]";
		  $titBtn3="Caja Gastos";
		  }
		  
?>
 	<link rel="stylesheet" type="text/css" href="../administracion/estilos.css" media="all" />
 	<script language="javascript" type="text/javascript" src="../administracion/csspopup2.js"></script>
	
<body onLoad="document.form1.almacen.focus(); cargardatos('');CarCodT();">
<form id="form1" name="form1" method="post" action="">

 <div id="capaPopUp" style="z-index:1;filter:alpha(opacity=40);-moz-opacity:.60;opacity:.60"></div>
     <div  id="popUpDiv"><!--id="popUpDiv"-->
        <div id="capaContent">

<table width="400" height="200" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
	
	<table width="398">
      <tr style="background-image:url(../imagenes/title.png); background-position:100% 40%;">
        <td height="23" colspan="3" style="font:Arial, Helvetica, sans-serif; color:#CC6600; font-size:12px"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="310"><span class="Estilo38">&nbsp;Seleccionar</span></td>
            <td width="78" align="right"><table width="29" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td  align="right"><img id="cerrar2" onClick="javascript:void(0)" style="cursor:pointer" src="../imagenes/cerrar.jpg" width="23" height="21"></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td width="11" height="133">&nbsp;</td>
        <td width="354" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#003366" valign="top">
		
		<div >
		  <table width="337" height="174" border="0" cellpadding="1" cellspacing="1">
            <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
              <td width="77" height="24" align="center" class="EstiloTexto1"><span class="Estilo112"><strong>Opci&oacute;n</strong></span></td>
              <td width="252" align="center" class="EstiloTexto1"><span class="Estilo112"><strong>Estados</strong></span></td>
              </tr>
            <?php 
		 
		  ?>
            
            <tr>
              <td align="center" bgcolor="#F8F8F8"><input name="radioEst[]" id="radioEst" style="border:none; background:none" type="radio" value="E"></td>
              <td align="left" bgcolor="#F8F8F8" class="Estilo12 Estilo112">Presentado / Entregado </td>
            </tr>
            <tr>
              <td align="center" bgcolor="#F8F8F8"><input name="radioEst[]" id="radioEst" style="border:none; background:none" type="radio" value="R"></td>
              <td align="left" bgcolor="#F8F8F8" class="Estilo12 Estilo112">Rechazado</td>
            </tr>
            <tr>
              <td align="center" bgcolor="#F8F8F8"><input name="radioEst[]" id="radioEst" style="border:none; background:none" type="radio" value="O"></td>
              <td align="left" bgcolor="#F8F8F8" class="Estilo12 Estilo112">Suspendido / Observado </td>
            </tr>
            <tr>
              <td align="center" bgcolor="#F8F8F8"><input name="radioEst[]" id="radioEst" style="border:none; background:none" type="radio" value="A"></td>
              <td align="left" bgcolor="#F8F8F8" class="Estilo12 Estilo112"><label id="anulDes">Anulado</label></td>
            </tr>
            <?php 
			
			?>
          </table>
		</div>
		
		</td>
        <td width="17">&nbsp;</td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center"><input onClick="javascript:void(0);" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(../imagenes/boton_aplicar.gif) ; cursor:pointer" type="button" name="aplicarform" value="Aplicar"  id="anular" >
		
		&nbsp;&nbsp;&nbsp;
		
		<input onClick="javascript:void(0);" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(../imagenes/boton_aplicar.gif) ; cursor:pointer" type="button" name="cerrarform" value="Cancelar"  id="cerrar" >	</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>


</div>
</div>
</div>
  <table width="807" height="432" border="0" cellpadding="0" cellspacing="0">
    
    <tr style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="5" height="23">&nbsp;</td>
      
	   <td height="25" colspan="13" style="border:#999999">
	  <span class="Estilo100">Log&iacute;stica : Seguimiento de <?php echo $titulo ?>.</span>	  
<input type="hidden" name="carga" id="carga" value="N">	 

 <!-- <input id="abrirPop" type="button" name="Submit2" value="Agregar Nuevo" onClick="javascript:void(0)">--> </td>	  
    </tr>
    <tr>
      <td height="26">&nbsp;</td>
      <td colspan="3">
	  
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
          <td width="107">&nbsp;</td>
          <td width="63">&nbsp;</td>
          <td width="144">&nbsp;</td>
          <td width="104"><table  title="Imprimir [F7]"width="87%" height="20" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="enviar_excel('imp')">
              <td width="1" ></td>
              <td width="23" ><img src="../imgenes/fileprint.gif"  width="16" height="16" border="0"></td>
              <td width="62" ><span class="Estilo112"> Imprimir<span class="Estilo113">[F7]</span></span></td>
              <td width="3" ></td>
            </tr>
          </table></td>
          <td width="120"><table  title="Documento de Origen [F8]"width="93%" height="21" border="0" cellpadding="0" cellspacing="0">
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
            <td width="85"><div align="right">Tiendas : </div></td>
            <td colspan="3"><select  name="almacen" id="almacen" style="width:200" onChange="CarCodT()">
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
            </table>
			<table onClick="enviar_excel('xls')"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="86%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="24" align="center"><img style="cursor:pointer"  src="../imagenes/ico-excel.gif" width="20" height="20"/></td>
                </tr>
            </table>			</td>
          </tr>
          <tr>
            <td ><div align="right">Cliente : </div></td>
            <td width="152"><input name="cliente" type="text" id="cliente"  style="height:20; border-color:#CCCCCC"  size="25" maxlength="100" autocomplete="off" ></td>
            <td width="32" class="Estilo114"><div align="right">Ruc : </div></td>
            <td width="95" class="Estilo114"><input name="ruc" type="text" id="ruc"  style="height:20; border-color:#CCCCCC" size="11" maxlength="11" autocomplete="off"></td>
            <td class="Estilo114"><div align="right">Docs. de Ref.: </div></td>
            <td><span class="Estilo15">
              <select name="docref" id="docref" style="width:200" disabled >			
                <?php 
	$resultados11 = mysql_query("select * from operacion where tipo ='2'  and codigo='".$_REQUEST['docRef']."' order by descripcion ",$cn); 
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
            <td colspan="2" class="Estilo114"><div align="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="Estilo116">Estado</span>
              <select name="select" onChange="cambiarEstado(this)">
			   <option value="P" selected>Pendiente x Presentar</option>
			   <option value="and estadoOT='E'" selected>Presentado / Entregado</option>
			   <option value="and estadoOT='T'" selected>Aceptado / Aprobado</option>
			   <option value="and estadoOT='R'" selected>Rechazado</option>
			   <option value="and estadoOT='O'" selected>Suspendido/ Observado</option>
			   <option value="and flag=A" selected>Anulado</option>
			    <option value="T" selected="selected">Todos</option>
			   
			    <!--<option value="and estadoOT=T">Aprobado</option>
                <option value="and estadoOT=T">Aprobado</option>
                <option value="and flag=A">Anulado</option>
                <option value="and estadoOT=O">Observado</option>
                
               -->
              </select>
			  </div>		    </td>
            <td class="Estilo114">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="3"> <input name="Estado" type="hidden" id="Estado" value="T" ><input name="tporden" type="hidden" id="tporden" value="asc" ></td>
            <td class="Estilo114">&nbsp;</td>
            <td>&nbsp;</td>
            <td class="Estilo114">&nbsp;</td>
          </tr>
        </table>      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
	  
      <td height="217" colspan="2"  valign="top"><table width="790" border="0" cellpadding="0" cellspacing="1">
        <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
          <td   style=" border:#CCCCCC solid 1px" width="20" height="21" align="center" ><span class="texto2"><strong>OK</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="23" align="center"><span class="texto1">
            <input style="border: 0px; background:none; " type="checkbox" name="Cod" onClick="marcar()"   />
          </span></td>
          <td  style=" border:#CCCCCC solid 1px" width="73" align="center"><span class="texto2"><strong>Fec. de Emi </strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="32" ><span class="texto2"><strong>Hora</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="80" ><span class="texto2"><strong>N&uacute;mero</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="209"><span class="texto2"><strong>Cliente&nbsp;&nbsp;<img src="../imgenes/arrowmain.gif" width="8" height="16" onClick="verOrder()" style="cursor:pointer">
		  </strong></span>
		  &nbsp;
		  <div id="divOrder" style="position:absolute; left: 288px; top: 153px; height: 48px; width: 95px; visibility:hidden">
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
		  </div>		  </td>
		   <td width="135" align="center"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Dirección</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="40" ><span class="texto2"><strong>Mon</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="69" ><span class="texto2"><strong>Importe</strong></span></td>
          <td width="53" align="center"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Costo O. </strong></span></td>
          <td width="53" align="center"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Actv.</strong></span></td>
         
          
        </tr>
        <tr>
          <td colspan="13"><div id="detalle" style="width:790px; height:180px;" ><span class="Estilo114">
              <input name="almcod" type="hidden" disabled id="almcod"  style="height:20; border-color:#CCCCCC" size="8">
          </span></div></td>
        </tr>
      </table></td>
      <td width="27" valign="top">&nbsp;</td>
    </tr>
    
    <tr>
      <td height="80" >&nbsp;</td>
      <td width="137"><table width="131" height="80" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="122" height="80" ><fieldset><legend>Leyenda</legend>
            <table width="92%" height="78" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="32%" height="15" align="center"><table style="border:#999999 solid 1px"  width="26" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="24"  height="8" bgcolor="#A0F3DB"></td>
                  </tr>
                </table></td>
                <td width="68%"><span class="Estilo122">Presentado</span></td>
              </tr>
              <tr>
                <td height="15" align="center"><table style="border:#999999 solid 1px"  width="25" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td  height="8" bgcolor="#339FFF"></td>
                    </tr>
                </table></td>
                <td><span class="Estilo122">Aprobado</span></td>
              </tr>
              <tr>
                <td height="16" align="center"><table style="border:#999999 solid 1px"  width="25" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td  height="8" bgcolor="#CAA2FB"></td>
                  </tr>
                </table></td>
                <td><span class="Estilo122">Rechazado</span></td>
              </tr>
              <tr>
                <td height="17" align="center"><table style="border:#999999 solid 1px"  width="25" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td  height="8" bgcolor="#FFB546"></td>
                  </tr>
                </table></td>
                <td><span class="Estilo122">Observado</span></td>
              </tr>
              <tr>
                <td height="15" align="center"><table style="border:#999999 solid 1px"  width="25" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td  height="8" bgcolor="#FF0000"></td>
                  </tr>
                </table></td>
                <td><span class="Estilo122">Anulado</span></td>
              </tr>
            </table>
          </fieldset></td>
          <td width="5">&nbsp;</td>
          <td width="4"><!--
		  <table onClick="FuncionOT2(this,'EST')"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="95%" border="0" cellpadding="0" cellspacing="0" id="btn5" >
            <tr>
              <td align="center"><img src="../images/view_choose.gif" width="28" height="28"></td>
            </tr>
            <tr>
              <td height="24" align="center" ><span class="Estilo100"><span style="color:#FF3300">[F2]</span> Estado </span></td>
            </tr>
          </table>
-->          </td>
          </tr>
      </table></td>
      <td width="664"><fieldset><table width="651" height="78" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="78"><table onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" onClick="<?php echo $eventoBtn1 ?>"  style="cursor:pointer; visibility:visible "  width="88%" border="0" cellpadding="0" cellspacing="0"  id="btn6" disabled="disabled"><!--onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)"-->
                <tr>
                  <td align="center" ><a id="download_now"><img src="../imgenes/view_bottom.png" width="26" height="26"></a><DIV class="tooltip"><span style="color:#000000">Costos Operativos</span> </DIV>
				  </td>
                </tr>
				
				
                <tr>
                  <td height="24" align="center" ><span class="Estilo100"><span style="color:#FF3300"><?php echo $teclaBtn1?></span>&nbsp; <?php echo $titBtn1 ?> </span></td>
                </tr>
            </table>
			
			
			
			</td>
            <td width="77"><table disabled=disabled onClick="<?php echo $eventoabrirPop ?>"  style="cursor:pointer; visibility:visible" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="92%" border="0" cellpadding="0" cellspacing="0"  id="btnRM" >
                <tr>
                  <td align="center"><a id="download_now2"><img src="../imgenes/view_bottom.png" width="26" height="26"></a><DIV class="tooltip"><span style="color:#000000">Actividades de Obra</span> </DIV></td>
                </tr>
                <tr>
                  <td height="24" align="center" ><span class="Estilo100"><span style="color:#FF3300"><?php echo $teclaabrirPop?></span><?php echo $titabrirPop ?> </span></td>
                </tr>
            </table></td>
            <td width="13">&nbsp;</td>
            <td width="84"><table disabled=disabled onClick="<?php echo $eventoBtn3 ?>"  style="cursor:pointer; visibility:visible" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="83%" border="0" cellpadding="0" cellspacing="0"  id="btnUtil" >
                <tr>
                  <td align="center"><img  src="../imagenes/iconSist2.gif" width="35" height="32"></td>
                </tr>
                <tr>
                  <td height="24" align="center" ><span class="Estilo100"><span style="color:#FF3300"><?php echo $teclaBtn3?></span><?php echo $titBtn3 ?> </span></td>
                </tr>
            </table></td>
            <td width="11">&nbsp;</td>
            <td width="91"><table onClick="Anular('')"  style="cursor:pointer; display:none" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="95%" border="0" cellpadding="0" cellspacing="0"  id="btn7" >
                <tr>
                  <td align="center"><img  src="../imagenes/cerrar.jpg" width="22" height="22"></td>
                </tr>
                <tr>
                  <td height="24" align="center"><span class="Estilo100" style="font-size:9px"><span style="color:#FF3300;">[F5]</span> Desanular</span></td>
                </tr>
              </table>
                <!--onClick="Anular('A')"	  abrirPop-->
                <table onClick="javascript:void(0)"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="85%" border="0" cellpadding="0" cellspacing="0"  id="abrirPop" disabled="disabled" >
                  <tr>
                    <td align="center"><img  src="../imagenes/iconSist3.gif" width="30" height="32"></td>
                  </tr>
                  <tr>
                    <td height="24" align="center"><span class="Estilo100"><span style="color:#FF3300">[F5]<br></span> Cambiar  Estado </span></td>
                  </tr>
              </table></td>
            <td width="87"><table onClick="FuncionOT(this,'OBS')"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="80%" border="0" cellpadding="0" cellspacing="0"  id="btn3" disabled="disabled" >
                <tr>
                  <td align="center"><img  src="../imgenes/AdminFeatures.gif" width="20" height="20"></td>
                </tr>
                <tr>
                  <td height="24" align="center"><span class="Estilo100"><span style="color:#FF3300">[F6]</span> Observaciones </span></td>
                </tr>
            </table></td>
            <td width="72"><table onClick="FuncionOT(this,'ADJ')"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="87%" border="0" cellpadding="0" cellspacing="0"  id="btn4" disabled="disabled" >
                <tr>
                  <td align="center"><img src="../imgenes/archivo.jpg" width="22" height="20"></td>
                </tr>
                <tr>
                  <td height="24" align="center" ><span class="Estilo100"><span style="color:#FF3300">[F9]</span> Archivo </span></td>
                </tr>
            </table></td>
            <td width="78"><table onClick="FuncionOT(this,'TER')"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="86%" border="0" cellpadding="0" cellspacing="0" disabled id="btn1">
                <tr>
                  <td align="center"><img  src="../imagenes/iconSist1.gif" width="25" height="28"></td>
                </tr>
                <tr>
                  <td height="24" align="center"><span class="Estilo100" ><span style="color:#FF3300">[F10]</span> <?php echo $nombreTer ?> </span></td>
                </tr>
            </table></td>
            <td width="74"><table   style="cursor:pointer; visibility:<?php echo $verBtn ?>" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="77%" border="0" cellpadding="0" cellspacing="0" disabled id="btn1">
                <tr>
                  <td align="center"><img  src="../imagenes/iconSist4.gif" width="32" height="30"></td>
                </tr>
                <tr>
                  <td height="24" align="center"><span class="Estilo100" >Seguimiento Actividades </span></td>
                </tr>
            </table></td>
            <td>&nbsp;</td>
          </tr>
        </table></fieldset></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form></body>
  
<!--<div id="AnularRk" style="position:absolute; visibility:hidden; left: 266px; top: 190px; width: 240px; height: 38px;"></div>
  <div id="FactuaRk" style="position:absolute; left:208px; top:114px; width:300px; height:180px; z-index:1; visibility:hidden">  </div>-->
  
</html>

<script>

function cargardatos(pagina){
//alert();
document.getElementById('btn1').disabled="disabled";	
document.getElementById('abrirPop').disabled="disabled";
document.getElementById('btn3').disabled="disabled";
document.getElementById('btn4').disabled="disabled";
//document.getElementById('btn5').disabled="disabled";
document.getElementById('btn6').disabled="disabled";

var almacen=document.form1.almacen.value;
var cliente=document.form1.cliente.value;
var ruc=document.form1.ruc.value;
var ckbven=document.form1.ckbven.checked;
var Estado=document.form1.Estado.value;
var vendedor='';
	if (ckbven){
		var vendedor=document.form1.vendedor.value;
	}
var docref=document.form1.docref.value;
var mosdocFac='';
var mosdocAnu='';
/*
if (document.form1.ckbDoc[0].checked){ var mosdocFac=''; var mosdocAnu=''; }
if (document.form1.ckbDoc[1].checked){ var mosdocFac='B'; }
if (document.form1.ckbDoc[2].checked){ var mosdocAnu='A'; }*/
//alert(mosdocFac+'//'+mosdocAnu);
//var pagina=document.form1.pag.value;
var fec1=document.form1.fec1.value;
var fec2=document.form1.fec2.value;

//alert(Estado);
doAjax('lista_GenDocRefOT.php','&almacen='+almacen+'&cliente='+cliente+'&pagina='+pagina+'&ruc='+ruc+'&vendedor='+vendedor+'&docref='+docref+'&mosdocFac='+mosdocFac+'&mosdocAnu='+mosdocAnu+'&Estado='+Estado+'&fec1='+fec1+'&fec2='+fec2,'mostrar_filtro','get','0','1','','');

//setInterval("cargardatos('')", 20000);
}
var vent="";
function enviar_excel(tip){
//alert(pagina);
document.getElementById('btn1').disabled="disabled";	
document.getElementById('abrirPop').disabled="disabled";
document.getElementById('btn3').disabled="disabled";
document.getElementById('btn4').disabled="disabled";
//document.getElementById('btn5').disabled="disabled";
document.getElementById('btn6').disabled="disabled";

var almacen=document.form1.almacen.value;
var cliente=document.form1.cliente.value;
var ruc=document.form1.ruc.value;
var ckbven=document.form1.ckbven.checked;
var Estado=document.form1.Estado.value;
var tporden=document.form1.tporden.value;
var vendedor='';
	if (ckbven){
		var vendedor=document.form1.vendedor.value;
	}
var docref=document.form1.docref.value;
var mosdocFac='';
var mosdocAnu='';
/*
if (document.form1.ckbDoc[0].checked){ var mosdocFac=''; var mosdocAnu=''; }
if (document.form1.ckbDoc[1].checked){ var mosdocFac='B'; }
if (document.form1.ckbDoc[2].checked){ var mosdocAnu='A'; }
*/
//alert(mosdocFac+'//'+mosdocAnu);
//var pagina=document.form1.pag.value;
var fec1=document.form1.fec1.value;
var fec2=document.form1.fec2.value;

vent=window.open('lista_GenDocRefOT_excel.php?&almacen='+almacen+'&cliente='+cliente+'&ruc='+ruc+'&vendedor='+vendedor+'&docref='+docref+'&mosdocFac='+mosdocFac+'&mosdocAnu='+mosdocAnu+'&Estado='+Estado+'&fec1='+fec1+'&fec2='+fec2+'&tip='+tip+'&tporden='+tporden);
if(tip!='imp'){
setInterval("vent.close()", 5000);
}
}


function cambiarEstado(obj){
document.form1.Estado.value=obj.value;
cargardatos('');
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
		//document.form1.ckbDoc[1].checked=false;
		//document.form1.ckbDoc[2].checked=false;
	}	
	if(tipo=='mosdoc2'){
		//document.form1.ckbDoc[0].checked=false;
	}
	if(tipo=='mosdoc3'){
		//document.form1.ckbDoc[0].checked=false;
	}
}
function AnularDoc(valor,condicion){
	//document.getElementById('AnularRk').style.visibility='hidden';
	//document.getElementById('AnularRk').style.visibility='visible';
	document.form1.carga.value='S';
	doAjax('anular.php','&CodDoc='+valor+'&Condicion='+condicion,'UpdateAnulado','get','0','1','','');
}
function UpdateAnulado(texto){
//alert(texto);
var r = texto;
	var valor="";
	var temp_criterio='';
	//document.getElementById('AnularRk').innerHTML=r;
	//document.getElementById('AnularRk').style.visibility='visible';
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
document.getElementById('abrirPop').disabled="disabled";
document.getElementById('btn3').disabled="disabled";
document.getElementById('btn4').disabled="disabled";
//document.getElementById('btn5').disabled="disabled";
document.getElementById('btn6').disabled="disabled";
document.getElementById('btnRM').disabled="disabled";
document.getElementById('btnUtil').disabled="disabled";


//document.getElementById('btn7').style.display='none';
//document.form1.radioEst[5].value="A"; 
document.getElementsByName("radioEst")[3].value="A";
document.getElementById("anulDes").innerHTML="Anular";

document.getElementById('abrirPop').style.display='block';
	if (document.form1.xcodigo.length==undefined){
		if (document.form1.xcodigo.checked  ){
							if (objeto=='S'){
						document.getElementById('btn1').disabled="";
						document.getElementById('abrirPop').disabled="";
						document.getElementById('btn4').disabled="";
						//document.getElementById('btn5').disabled="";
						document.getElementById('btn6').disabled="";
						document.getElementById('btnRM').disabled="";
						document.getElementById('btnUtil').disabled="";
						
						
						document.getElementById('btn7').style.display='none';
						document.getElementById('abrirPop').style.display='block';							
							}else{
							//document.getElementById('abrirPop').style.display='none';
						    //document.getElementById('btn7').style.display='block';	
							//document.form1.radioEst[5].value="R";
							document.getElementById('abrirPop').disabled="";
							document.getElementsByName("radioEst")[3].value="A";
							document.getElementById("anulDes").innerHTML="DesAnular";
							
							
							}
							
			if (objeto=='E' || objeto=='R' || objeto=='O' || objeto=='A' || objeto==''){ 
			AnularDoc(document.form1.xcodigo.value,objeto);
			//alert(document.form1.xcodigo[i].value);	
			}
		}	
	}else{
	
	
			for(var i=0;i<document.form1.xcodigo.length;i++){
					if (document.form1.xcodigo[i].checked ){
							if (objeto=='S'){
						document.getElementById('btn1').disabled="";
						document.getElementById('abrirPop').disabled="";
						document.getElementById('btn4').disabled="";
						//document.getElementById('btn5').disabled="";
						document.getElementById('btn6').disabled="";
						document.getElementById('btnRM').disabled="";
						document.getElementById('btnUtil').disabled="";
						
						document.getElementById('btn3').disabled="";
						document.getElementById('btn7').style.display='none';
						document.getElementById('abrirPop').style.display='block';							
							}else{
							//document.getElementById('abrirPop').style.display='none';
						    //document.getElementById('btn7').style.display='block';						
							document.getElementById('abrirPop').disabled="";
							document.getElementsByName("radioEst")[3].value="D";
							document.getElementById("anulDes").innerHTML="DesAnular";
							}
						
							if (objeto=='E' || objeto=='R' || objeto=='O' || objeto=='A' || objeto=='' ){ 
							//alert(objeto);
							AnularDoc(document.form1.xcodigo[i].value,objeto);
							//alert(document.form1.xcodigo[i].value);	
							}
					}		
			}	
		}
	if (objeto=='E' || objeto=='R' || objeto=='O' || objeto=='A' || objeto==''){	cargardatos(''); }
}
function marcar(){
	if(document.form1.Cod.checked){
		for(var i=0;i<document.form1.xcodigo.length;i++){
		    if (document.form1.xcodigo[i].disabled){			
			}else{
			document.form1.xcodigo[i].checked=true;
			}			
		document.getElementById('btn1').disabled="";
		document.getElementById('abrirPop').disabled="";
		}		
	}else{
		for(var i=0;i<document.form1.xcodigo.length;i++){
			document.form1.xcodigo[i].checked=false;
			document.getElementById('btn1').disabled="disabled";	
			document.getElementById('abrirPop').disabled="disabled";
			}	
	}
	
}
function doc_det(valor){
	if (document.form1.XDato.length==undefined){
		if (document.form1.XDato.checked  ){
			var valor=document.form1.XDato.value;
		}	
	}else{
		for(var i=0;i<document.form1.XDato.length;i++){
			if (document.form1.XDato[i].checked){
				var valor=document.form1.XDato[i].value;
			}	
		}
	}		
//open  showModalDialog
var tempStick="<?php echo $_SESSION['stickcom']?>"
if(tempStick=='S'){
window.open("../doc_det_ot.php?referencia="+valor,valor,"toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=720, height=520,left=200 top=150");
}else{
window.open("../doc_det.php?referencia="+valor,valor,"toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=720, height=520,left=200 top=150");

}



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

function add_SM(codOpe){
   if (document.form1.xcodigo.length==undefined){
		if (document.form1.xcodigo.checked ){
			 codigo=document.form1.xcodigo.value;
			 var randomnumber=Math.floor(Math.random()*99999);
			 window.open("salidaMateriales.php?"+randomnumber+"&CodDoc="+codigo+"&tipoDocRec="+codOpe,"","Width=650px Height=450px,top=100,left=200,status=yes,scrollbars=yes");
		}	
	}else{
		for(var i=0;i<document.form1.xcodigo.length;i++){
				if (document.form1.xcodigo[i].checked ){		
				        codigo=document.form1.xcodigo[i].value;
						var randomnumber=Math.floor(Math.random()*99999);
						 window.open("salidaMateriales.php?"+randomnumber+"&CodDoc="+codigo+"&tipoDocRec="+codOpe,"","Width=650px Height=450px,top=100,left=200,status=yes,scrollbars=yes");		
				}		
			}
	}				
		
}
function FuncionOT(Codigo,Valor){

	if (document.form1.xcodigo.length==undefined){
		if (document.form1.xcodigo.checked  ){
			//AnularDoc(document.form1.xcodigo.value,objeto);
			codigo=document.form1.xcodigo.value;
			window.open("funcionOT.php?CodDoc="+codigo+"&Fun="+Valor+'&ventana=PO', "ventana1" , "width=550,height=250,scrollbars=NO,top=100,left=200") 
		}	
	}else{
		for(var i=0;i<document.form1.xcodigo.length;i++){
				if (document.form1.xcodigo[i].checked ){
					//alert(document.form1.xcodigo.value)	
					codigo=document.form1.xcodigo[i].value;
					window.open("funcionOT.php?CodDoc="+codigo+"&Fun="+Valor+'&ventana=PO', "ventana1" , "width=550,height=250,scrollbars=NO,top=100,left=200") 
				}		
			}	
	}	
	
	
		
}
function FuncionOT2(Codigo,Valor){
	window.open("funcionOT.php?Fun="+Valor, "ventana1" , "width=550,height=250,scrollbars=NO,top=100,left=200") 
}

function activxPres(){
	 if (document.form1.XDato.length==undefined){
			if (document.form1.XDato.checked ){
				 codigo=document.form1.XDato.value;
				 var randomnumber=Math.floor(Math.random()*99999);
			//	 window.open("salidaMateriales.php?"+randomnumber+"&CodDoc="+codigo+"&tipoDocRec="+codOpe,"","Width=650px Height=450px,top=100,left=200,status=yes,scrollbars=yes");
			window.open("activxPresup.php?"+randomnumber+"&CodDoc="+codigo,"","Width=650px Height=450px,top=100,left=200,status=yes,scrollbars=yes");
			}	
		}else{
			for(var i=0;i<document.form1.XDato.length;i++){
					if (document.form1.XDato[i].checked ){		
							codigo=document.form1.XDato[i].value;
							var randomnumber=Math.floor(Math.random()*99999);
							//alert(codigo);
				 window.open("activxPresup.php?"+randomnumber+"&CodDoc="+codigo,"","Width=650px Height=450px,top=100,left=200,status=yes,scrollbars=yes");		
					}		
				}
		}	

}


function utilxPres(){
	 if (document.form1.XDato.length==undefined){
			if (document.form1.XDato.checked ){
				 codigo=document.form1.XDato.value;
				 var randomnumber=Math.floor(Math.random()*99999);
			//	 window.open("salidaMateriales.php?"+randomnumber+"&CodDoc="+codigo+"&tipoDocRec="+codOpe,"","Width=650px Height=450px,top=100,left=200,status=yes,scrollbars=yes");
			window.open("utilxPresup.php?"+randomnumber+"&CodDoc="+codigo,"","Width=800px Height=600px,top=100,left=200,status=yes,scrollbars=yes");
			}	
		}else{
			for(var i=0;i<document.form1.XDato.length;i++){
					if (document.form1.XDato[i].checked ){		
							codigo=document.form1.XDato[i].value;
							var randomnumber=Math.floor(Math.random()*99999);
							//alert(codigo);
				 window.open("utilxPresup.php?"+randomnumber+"&CodDoc="+codigo,"","Width=800px Height=600px,top=100,left=200,status=yes,scrollbars=yes");		
					}		
				}
		}	

}

function CostosOpe(){
 	if (document.form1.XDato.length==undefined){
			if (document.form1.XDato.checked ){
				 codigo=document.form1.XDato.value;
				 var randomnumber=Math.floor(Math.random()*99999);
			//	 window.open("salidaMateriales.php?"+randomnumber+"&CodDoc="+codigo+"&tipoDocRec="+codOpe,"","Width=650px Height=450px,top=100,left=200,status=yes,scrollbars=yes");
			window.open("cOperxPresup.php?"+randomnumber+"&CodDoc="+codigo,"","Width=650px Height=450px,top=100,left=200,status=yes,scrollbars=yes");
			}	
		}else{
			for(var i=0;i<document.form1.XDato.length;i++){
					if (document.form1.XDato[i].checked ){		
							codigo=document.form1.XDato[i].value;
							var randomnumber=Math.floor(Math.random()*99999);
							//alert(codigo);
				 window.open("cOperxPresup.php?"+randomnumber+"&CodDoc="+codigo,"","Width=650px Height=550px,top=100,left=200,status=yes,scrollbars=yes");		
					}		
			}
	}	

}

function verOrder(){
	document.getElementById("divOrder").style.visibility="visible";
}

function ordenar(campoOrder,formaOrder){

pagina='';

document.getElementById('btn1').disabled="disabled";	
document.getElementById('abrirPop').disabled="disabled";
document.getElementById('btn3').disabled="disabled";
document.getElementById('btn4').disabled="disabled";
//document.getElementById('btn5').disabled="disabled";
document.getElementById('btn6').disabled="disabled";

var almacen=document.form1.almacen.value;
var cliente=document.form1.cliente.value;
var ruc=document.form1.ruc.value;
var ckbven=document.form1.ckbven.checked;
var Estado=document.form1.Estado.value;

document.form1.tporden.value=formaOrder;

var vendedor='';
	if (ckbven){
		var vendedor=document.form1.vendedor.value;
	}
var docref=document.form1.docref.value;
var mosdocFac='';
var mosdocAnu='';
/*
if (document.form1.ckbDoc[0].checked){ var mosdocFac=''; var mosdocAnu=''; }
if (document.form1.ckbDoc[1].checked){ var mosdocFac='B'; }
if (document.form1.ckbDoc[2].checked){ var mosdocAnu='A'; }
*/
//alert(mosdocFac+'//'+mosdocAnu);
//var pagina=document.form1.pag.value;
var fec1=document.form1.fec1.value;
var fec2=document.form1.fec2.value;

doAjax('lista_GenDocRefOT.php','&almacen='+almacen+'&cliente='+cliente+'&pagina='+pagina+'&ruc='+ruc+'&vendedor='+vendedor+'&docref='+docref+'&mosdocFac='+mosdocFac+'&mosdocAnu='+mosdocAnu+'&Estado='+Estado+'&fec1='+fec1+'&fec2='+fec2+'&campoOrder='+campoOrder+'&formaOrder='+formaOrder,'mostrar_filtro','get','0','1','','');


document.getElementById("divOrder").style.visibility="hidden";
}


function ocultar_combos(){	
	for(var i=0;i<document.form1.elements.length;i++){
	//alert(document.formulario.elements[i].type);
	 	if(document.form1.elements[i].type=="select-one"){
		 document.form1.elements[i].style.visibility="hidden";
		}
	}
}
function mostrar_combos(){	
	for(var i=0;i<document.form1.elements.length;i++){
	//alert(document.formulario.elements[i].type);
	 	if(document.form1.elements[i].type=="select-one"){
		 document.form1.elements[i].style.visibility="visible";
		}
	}
}

function cerrar_capa(){
//alert();


	for(var i=0;i<document.form1.radioEst.length;i++){
		if(document.form1.radioEst[i].checked){
		var estado=document.form1.radioEst[i].value;
		}
	}
	
	//alert(estado);
	if(estado=='A'){
	Anular('A');
	}
	if(estado=='D'){
	Anular('');
	}
	if(estado=='E' || estado=='R' || estado=='O'){
	
	Anular(estado);
	
	}
	
	
}


function cambiar_fondo(control,evento){

	if(evento=='e')
	control.style.backgroundImage='url(../imagenes/boton_aplicar2.gif)';
	else
	control.style.backgroundImage='url(../imagenes/boton_aplicar.gif)';

}


// What is $(document).ready ? See: http://flowplayer.org/tools/documentation/basics.html#document_ready

			$(document).ready(function() {
			
			$("#download_now").tooltip({ effect: 'slide'});
			$("#download_now2").tooltip({ effect: 'slide'});
			
			});
			

</script>