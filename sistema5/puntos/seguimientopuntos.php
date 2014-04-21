<?php 
session_start();
include('../conex_inicial.php');
$Ucodvendedor=  $_SESSION['codvendedor'];
if($_SESSION['nivel_usu']==4 || $_SESSION['nivel_usu']==5){
$verBtn="visible";
$deshab=" ";
}else{
$verBtn="hidden";
$deshab=" disabled ";
}


?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<script src="../jquery-1.2.6.js"></script>
<script src="../jquery.hotkeys.js"></script>

<script language="JavaScript">
jQuery(document).bind('keydown', 'f3',function (evt){jQuery('#_f6').addClass('dirty');
	evt.keyCode=0;
	evt.returnValue=false;
		if (document.getElementById('btn1').disabled==false){
			//Facturar(this);
			add_SM('SM');
		}
 return false; }); 
jQuery(document).bind('keydown', 'f5',function (evt){jQuery('#_f6').addClass('dirty');
	evt.keyCode=0;
	evt.returnValue=false;
		if (document.getElementById('btn2').disabled==false){
			Anular('A');
		}
 return false; }); 
 jQuery(document).bind('keydown', 'f6',function (evt){jQuery('#_f6').addClass('dirty');
	evt.keyCode=0;
	evt.returnValue=false;
		if (document.getElementById('btn3').disabled==false){
			Anular('');
		}	
 return false; }); 
 jQuery(document).bind('keydown', 'f8',function (evt){jQuery('#_f6').addClass('dirty');
	evt.keyCode=0;
	evt.returnValue=false;
		//doc_det(document.form1.XDato.value);
		doc_det(this);
		
 return false; }); 
 
  jQuery(document).bind('keydown', 'f9',function (evt){jQuery('#_f6').addClass('dirty');
	evt.keyCode=0;
	evt.returnValue=false;
		//doc_det(document.form1.XDato.value);
	 ant_imprimir();
		
 return false; }); 
 

  jQuery(document).bind('keydown', 'f7',function (evt){
	evt.keyCode=0;
	evt.returnValue=false;
		//doc_det(document.form1.XDato.value);

		enviar_excel('imp')
		
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
-->
</style>


<link href="../styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
background-color:#F3F3F3;   
}
.Estilo13 {color: #0767C7}

.Estilo100 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
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
.Estilo117 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
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

function buscar_formato(){
var codigo=new Array();
var formato=new Array();
var result=new Array();
   if (document.form1.XDato.length==undefined){
		if (document.form1.XDato.checked ){
			codigo[0]=document.form1.XDato.value;
			result[0]=document.form1.tipformato.value;
			
			 
		}	
	}else{
	var x=0;
		for(var i=0;i<document.form1.XDato.length;i++){
		
				if (document.form1.XDato[i].checked ){		
				        codigo[x]=document.form1.XDato[i].value;
						result[x]=document.form1.tipformato[i].value;
						x++;
						
				}		
			}
	}

return result;				
}

	function ant_imprimir(){
		
	//var formato=find_prm(tab_formato,tab_cod);
	var data=buscar_formato();

	//alert(data);
/*	if(formato==''){
	alert('Este tipo de documento no tiene asignado un formato de impresión');
	return false;
	}
			*/		
		for(var a=0;a<data.length;a++){
	
		imprimir(data[a]);
		}
		cargardatos('');
	
	}

	
	function imprimir(dat){
	
	var reg=dat.split("~");
	var sucursal=reg[0];
	var doc=reg[1];
	var serie=reg[2];
	var numero=reg[3];
	var ci=reg[4];
//	alert(ci);
	//alert(sucursal);
	var formato=reg[5]
	//var impresion=find_prm(tab_impresion,tab_cod);
	
	
//	if(sucursal!='' && doc!='' && serie!='' && numero!='' && formato!='' && ci<3){ 
if(sucursal!='' && doc!='' && serie!='' && numero!='' && formato!=''){ 
	//var win00=window.open('../formatos/'+formato+'?empresa='+sucursal+'&doc='+doc+'&serie='+serie+'&numero='+numero+'&impresion='+impresion ,'ventana2','width=850,height=1000,top=100,left=100,scroolbars=yes,status=yes');
		var win00=window.open('../formatos/'+formato+'?empresa='+sucursal+'&doc='+doc+'&serie='+serie+'&numero='+numero+'&reimp=','ventana2','width=850,height=1000,top=100,left=100,scroolbars=yes,status=yes');	
		
	$.post("funciones.php",'&empresa='+sucursal+'&doc='+doc+'&serie='+serie+'&numero='+numero,function (data){
	//alert(data);

	});
	win00.focus();
	
	}else{
	alert('No es posible imprimir el doc:'+serie+'-'+numero);
	}
	
		
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
function ordenar(campoOrder,formaOrder){
document.form1.tpcampo.value=campoOrder;
document.form1.tporden.value=formaOrder;
cargardatos('');
document.getElementById("divOrder").style.visibility="hidden";

}
</script>
</head>
<body onLoad="document.form1.almacen.focus(); cargardatos('');CarCodT();">

<form id="form1" name="form1" method="post" action="">
  <table width="807" height="413" border="0" cellpadding="0" cellspacing="0">
    
    <tr style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="5" height="23">&nbsp;</td>
      
	   <td width="802" height="25" colspan="12" style="border:#999999">
	  <span class="Estilo100">Ventas : Seguimiento de Puntos </span>	  
      <input type="hidden" name="carga" id="carga" value="N">	  </td>	  
    </tr>
    <tr>
      <td height="26">&nbsp;</td>
      <td colspan="2">
	  
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
        </select>
			  
		</td>
            <td width="110" class="Estilo114"><div align="right">
              <input <?php echo $deshab ?> name="ckbven" type="checkbox" id="ckbven" style="border: 0px; background-color:#F9F9F9; " onClick="activar('ven')"  value="checkbox">
            Vendedor : </div></td>
            <td width="227"><span class="Estilo15"><span class="Estilo114">
              <select name="vendedor" id="vendedor" style="width:200"  disabled>
                 <?php 
		    $resultados11 = mysql_query("select * from usuarios order by usuario ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			if($row11['codigo']==$Ucodvendedor){
			?>
			<option value="<?php echo $row11['codigo']?>" selected><?php echo $row11['usuario'];?></option>
			<?
			}else{
			?>
			<option value="<?php echo $row11['codigo']?>"><?php echo $row11['usuario'];?></option>
			<?
			}
			
			 }?>
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
                  <td height="24" align="center"><img style="cursor:pointer; visibility:hidden"  src="../imagenes/ico-excel.gif" width="20" height="20"/></td>
                </tr>
            </table>
			</td>
          </tr>
          <tr>
            <td ><div align="right">Cliente : </div></td>
            <td width="152"><input name="cliente" type="text" id="cliente"  style="height:20; border-color:#CCCCCC"  size="25" maxlength="100" autocomplete="off" ></td>
            <td width="32" class="Estilo114"><div align="right">Ruc : </div></td>
            <td width="95" class="Estilo114"><input name="ruc" type="text" id="ruc"  style="height:20; border-color:#CCCCCC" size="11" maxlength="11" autocomplete="off"></td>
            <td class="Estilo114"><div align="right">Docs. de Ref.: </div></td>
            <td><span class="Estilo15">
              <select name="docref" id="docref" style="width:200"  >	
			  
			  		   <option selected="selected" value="0">Todos </option>	
                <?php 
	$resultados11 = mysql_query("select * from operacion where tipo ='2'  and substring(p1,28,1)='S' and  substring(p1,5,1)='S' order by descripcion ",$cn); 
	while($row11=mysql_fetch_array($resultados11)){
					
		  ?>
                <option value="<?php echo $row11['codigo']?>"><?php echo $row11['codigo'].' - '.$row11['descripcion'];?> </option>
                <?php 
			  }
			  ?>
              </select>
              <input name="docref2" type="hidden" id="docref2" value="" >
            </span></td>
            <td class="Estilo114">&nbsp;</td>
          </tr>
          <tr>
            <td height="27"><div align="right">Fecha  : </div></td>
            <td colspan="3"> de 
              <input name="fec1" id="fec1" <?php echo $deshab ?> type="text" size="10" maxlength="50" value="<?php echo date("d-m-Y"); ?>"  >
                <button <?php echo $deshab ?> type="reset" id="f_trigger_b2"  style="height:18" >...</button>
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
              <input <?php echo $deshab ?> name="fec2" id="fec2" type="text" size="10" maxlength="50"  value="<?php echo date('d-m-Y')?>" >
              <button <?php echo $deshab ?> type="reset" id="f_trigger_b1" style="height:18; vertical-align:top" >...</button>
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
            <td colspan="2" class="Estilo114"><div align="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="Estilo116" style="visibility:hidden">Estado</span>
              <select name="select" onChange="cambiarEstado(this)" style="visibility:hidden">
                <option value="and estadoOT=T">Aprobado</option>
                <option value="and flag=A">Anulado</option>
                <option value="and estadoOT=O">Observado</option>
                <option value="P" >Pendiente</option>
                <option value="T" selected>Todos</option>
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
      <td rowspan="2">&nbsp;</td>
	  
      <td height="21"  valign="top"><table width="800" border="0" cellpadding="0" cellspacing="1">
        <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
          <td   style=" border:#CCCCCC solid 1px" width="20" height="21" align="center" ><span class="texto2"><strong>OK</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px; display:none" width="23" align="center"><span class="texto1">
            <input style="border: 0px; background:none; " type="checkbox" name="Cod" onClick="marcar()"   />
          </span></td>
          <td  style=" border:#CCCCCC solid 1px" width="85" align="center"><span class="texto2"><strong>Fec. de Emi</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="30" ><span class="texto2"><strong>Hora</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="72" ><span class="texto2"><strong>N&uacute;mero</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="213"><span class="texto2"><strong>Cliente<img src="../imgenes/arrowmain.gif" width="8" height="16" onClick="verOrder()" style="cursor:pointer"></strong></span>
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
		  </div>
		  </td>
          <td  style=" border:#CCCCCC solid 1px" width="40" ><span class="texto2"><strong>Mon</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="78" ><span class="texto2"><strong>Importe</strong></span></td>
          <td width="99" align="center"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Puntos </strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="55" ><span class="texto2"><strong>Almac&eacute;n</strong></span></td>
          <td width="33"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Adj.</strong></span></td>
          <td width="47"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Obs.</strong></span></td>
		  <td width="42"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>C.I.</strong></span></td>
        </tr>
        <tr>
          <td colspan="13">
		  
		  <div id="detalle" style="width:800px; height:170px; border:0px solid;" ><span class="Estilo114">
              <input name="almcod" type="hidden" disabled id="almcod"  style="height:20; border-color:#CCCCCC" size="8">
          </span>
		  </div>
		  
		  </td>
        </tr>
      </table></td>
      <td rowspan="2" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td height="22" valign="top" style="visibility:hidden"><span class="Estilo114"><b>Mostrar Documento:</b></span>
        <input name="ckbDoc" type="checkbox" id="ckbDoc" style="border: 0px; background-color:#F9F9F9; " checked   onClick="activar('mosdoc1');cargardatos('')" >
Todos
<input name="ckbDoc" type="hidden" id="ckbDoc" style="border: 0px; background-color:#F9F9F9; " onClick="activar('mosdoc2');cargardatos('')" title="Solo Facturados" >
<input name="ckbDoc" type="checkbox" id="ckbDoc" style="border: 0px; background-color:#F9F9F9; " onClick="activar('mosdoc3');cargardatos('')" >
Solo Anulados&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td height="15">&nbsp;</td>
      <td colspan="2"><table width="88%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="27" >&nbsp;</td>
          <td width="115">&nbsp;</td>
          <td width="89"><table width="80" border="0" cellpadding="0" cellspacing="0" onClick="canjear()" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)"  id="btn6"  style="cursor:pointer; " >
              <tr>
                <td width="71" align="center"><img src="../imgenes/view_bottom.png" width="26" height="26"></td>
              </tr>
              <tr>
                <td height="24" align="center" ><span class="Estilo100"><span style="color:#FF3300">[F3]</span> Canjear </span></td>
              </tr>
          </table></td>
          <td width="100"><table onClick="Anular('')"  style="cursor:pointer; display:none" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="95%" border="0" cellpadding="0" cellspacing="0"  id="btn7" >
            <tr>
              <td align="center"><img  src="../imagenes/cerrar.jpg" width="22" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" style="font-size:9px"><span style="color:#FF3300;">[F5]</span> Desanular</span></td>
            </tr>
          </table>		  
            <table width="80"  border="0" cellpadding="0" cellspacing="0" onClick="Anular('A')" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)"  id="btn2"  style="cursor:pointer;  visibility:<?php echo "hidden";//$verBtnM; ?>" disabled="disabled" >
              <tr>
                <td width="69" align="center"><img  src="../imagenes/cerrar.jpg" width="22" height="22"></td>
              </tr>
              <tr>
                <td height="24" align="center"><span class="Estilo100"><span style="color:#FF3300">[F5]</span> Anular</span></td>
              </tr>
            </table>			</td>
          <td width="92" ><table width="80" border="0" cellpadding="0" cellspacing="0" onClick="FuncionOT(this,'OBS')" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)"  id="btn3"  style="cursor:pointer; visibility:hidden" disabled="disabled" >
            <tr>
              <td align="center"><img  src="../imgenes/AdminFeatures.gif" width="20" height="20"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100"><span style="color:#FF3300">[F6]</span> Observa</span></td>
            </tr>
          </table></td>
          <td width="100" ><table width="80" border="0" cellpadding="0" cellspacing="0" onClick="ant_imprimir()" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)"  id="btn4"  style="cursor:pointer; visibility:hidden" disabled="disabled" >
            <tr>
              <td align="center"><img src="../imgenes/i_imp.gif" width="22" height="20" border="0" ></td>
            </tr>
            <tr>
              <td height="24" align="center" ><span class="Estilo100"><span style="color:#FF3300">[F9]</span>Enviar a la  cola</span></td>
            </tr>
          </table></td>
          <td width="98" ><table width="80"  border="0" cellpadding="0" cellspacing="0" onClick="FacPagos(this)" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" id="btn5"  style="cursor:pointer; visibility:hidden " title="Nota de Credito [F9]" disabled>
            <tr>
              <td width="126" align="center"><img  src="../imgenes/AdminAddresses.gif" width="22" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo117" ><span style="color:#FF3300">[F10]</span> N.C.</span></td>
            </tr>
          </table></td>
          <td width="186"><table width="80" border="0" cellpadding="0" cellspacing="0" onClick="FuncionOT(this,'TER')" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" id="btn1"  style="cursor:pointer;  visibility:<?php echo "hidden" ?>" disabled>
            <tr>
              <td align="center"><img  src="../imgenes/email_edit.gif" width="20" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" ><span style="color:#FF3300">[F12]</span>Cierre</span></td>
            </tr>
          </table></td>

          <td width="49"><table disabled=disabled onClick="add_SM('RM')"  style="cursor:pointer; display:none" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="68%" border="0" cellpadding="0" cellspacing="0"  id="btnRM" >
            <tr>
              <td align="center"><img src="../imgenes/view_bottom.png" width="26" height="26"></td>
            </tr>
            <tr>
              <td height="24" align="center" ><span class="Estilo100"><span style="color:#FF3300">[F4]</span> Copiar</span></td>
            </tr>
          </table></td>
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

function cargardatos(pagina){
//alert(pagina);
document.getElementById('btn1').disabled="";	
document.getElementById('btn2').disabled="";
document.getElementById('btn3').disabled="";
document.getElementById('btn4').disabled="";
document.getElementById('btn6').disabled="";

var almacen=document.form1.almacen.value;
var cliente=document.form1.cliente.value;
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
document.form1.docref2.value=docref;
var mosdocFac='';
var mosdocAnu='';
if (document.form1.ckbDoc[0].checked){ var mosdocFac=''; var mosdocAnu=''; }
if (document.form1.ckbDoc[1].checked){ var mosdocFac='B'; }
if (document.form1.ckbDoc[2].checked){ var mosdocAnu='A'; }
//alert(mosdocFac+'//'+mosdocAnu);
//var pagina=document.form1.pag.value;
var fec1=document.form1.fec1.value;
var fec2=document.form1.fec2.value;

//alert(Estado);
doAjax('lista_segpuntos.php','&almacen='+almacen+'&cliente='+cliente+'&pagina='+pagina+'&ruc='+ruc+'&vendedor='+vendedor+'&docref='+docref+'&mosdocFac='+mosdocFac+'&mosdocAnu='+mosdocAnu+'&Estado='+Estado+'&fec1='+fec1+'&fec2='+fec2+'&campoOrder='+campoOrder+'&formaOrder='+formaOrder,'mostrar_filtro','get','0','1','','');

//setInterval("cargardatos('')", 20000);
}
var vent="";
function enviar_excel(tip){
//alert(pagina);
document.getElementById('btn1').disabled="disabled";	
document.getElementById('btn2').disabled="disabled";
document.getElementById('btn3').disabled="disabled";
document.getElementById('btn4').disabled="disabled";
//document.getElementById('btn6').disabled="disabled";


var almacen=document.form1.almacen.value;
var cliente=document.form1.cliente.value;
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
var fec1=document.form1.fec1.value;
var fec2=document.form1.fec2.value;

vent=window.open('lista_segpuntos_excel.php?&almacen='+almacen+'&cliente='+cliente+'&ruc='+ruc+'&vendedor='+vendedor+'&docref='+docref+'&mosdocFac='+mosdocFac+'&mosdocAnu='+mosdocAnu+'&Estado='+Estado+'&fec1='+fec1+'&fec2='+fec2+'&tip='+tip+'&campoOrder='+campoOrder+'&formaOrder='+formaOrder);


if(tip!='imp'){

setInterval("vent.close()", 10000);
}
}


function cambiarEstado(obj){
document.form1.Estado.value=obj.value;
cargardatos('');
}



function mostrar_filtro(texto){
document.getElementById('detalle').innerHTML=texto;
cargar();
document.getElementById('btn1').disabled="disabled";	
document.getElementById('btn2').disabled="disabled";
document.getElementById('btn3').disabled="disabled";
document.getElementById('btn4').disabled="disabled";
//document.getElementById('btn6').disabled="disabled";


document.getElementById('btnRM').disabled="disabled";
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
	document.getElementById('AnularRk').style.visibility='hidden';
	document.getElementById('AnularRk').style.visibility='visible';
	document.form1.carga.value='S';
	doAjax('../ventas/anular.php','&CodDoc='+valor+'&Condicion='+condicion,'UpdateAnulado','get','0','1','','');
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

if (objeto=='E'){
		if(confirm("Esta seguro de Eliminar los documentos seleccionados")){
		AnularDoc(document.form1.xcodigo[i].value,objeto);
		
		}else{
		return false;
		}
 }
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
/*
document.getElementById('btn1').disabled="disabled";	
document.getElementById('btn2').disabled="disabled";
document.getElementById('btn3').disabled="disabled";
document.getElementById('btn4').disabled="disabled";

document.getElementById('btn6').disabled="disabled";
document.getElementById('btnRM').disabled="disabled";

document.getElementById('btn7').style.display='none';
document.getElementById('btn2').style.display='block';
*/
document.getElementById('btn5').disabled="disabled";

	if (document.form1.XDato.length==undefined){
		if (document.form1.XDato.checked  ){
							tempEstDoc='';
							try {
							tempEstDoc=document.form1.estadoDoc[i].value.split("-");
							} catch(e) { }

							if (tempEstDoc[0]=='A' || tempEstDoc[1]=='T' ){
							document.getElementById('btn1').disabled="disabled";
							document.getElementById('btn2').disabled="disabled";
							document.getElementById('btn3').disabled="";
							document.getElementById('btn4').disabled="";					
							}else{
							document.getElementById('btn1').disabled="";
							document.getElementById('btn2').disabled="";
							document.getElementById('btn3').disabled="";
							document.getElementById('btn4').disabled="";
							//document.getElementById('btn6').disabled="";
							//document.getElementById('btn2').style.display='none';
						   // document.getElementById('btn7').style.display='block';	
							}
							
			if (objeto=='A' || objeto==''){ 
			AnularDoc(document.form1.xcodigo.value,objeto);
			//alert(document.form1.XDato[i].value);	
			}
		}	
	}else{
	
	
			for(var i=0;i<document.form1.XDato.length;i++){
					if (document.form1.XDato[i].checked ){
						tempEstDoc=document.form1.estadoDoc[i].value.split("-");
						//return false;		
						//alert(tempEstDoc[0]);					
						//alert(tempEstDoc[1]);
				
					
						
							if (tempEstDoc[0]=='A' || tempEstDoc[1]=='T' ){
							document.getElementById('btn1').disabled="disabled";
							document.getElementById('btn2').disabled="disabled";
							document.getElementById('btn3').disabled="";
							document.getElementById('btn4').disabled="";								
							}else{
							document.getElementById('btn1').disabled="";
							document.getElementById('btn2').disabled="";
							document.getElementById('btn3').disabled="";
							document.getElementById('btn4').disabled="";
							}	
							
						if (tempEstDoc[0]=='A' || document.form1.docref2.value=='TN'  ){
							document.getElementById('btn1').disabled="disabled";
							document.getElementById('btn5').disabled="disabled";
						}else{							
							document.getElementById('btn5').disabled="";
						}		
																		
							if (objeto=='A' || objeto=='' ){ 							
							AnularDoc(document.form1.xcodigo[i].value,objeto);
							//alert(document.form1.XDato[i].value);	
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
	//alert(document.getElementById("xcodigo").length);
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
var tempv=valor.split("|");
window.open("../doc_det2.php?referencia="+tempv[0],"","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=620, height=420,left=300 top=250");

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

	if (document.form1.XDato.length==undefined){
		if (document.form1.XDato.checked  ){
			//AnularDoc(document.form1.xcodigo.value,objeto);
			codigo=document.form1.XDato.value;
			
			window.open("../ventas/funcionOT.php?CodDoc="+codigo+"&Fun="+Valor, "ventana1" , "width=550,height=250,scrollbars=NO,top=100,left=200") 
		}	
	}else{
		for(var i=0;i<document.form1.XDato.length;i++){
				if (document.form1.XDato[i].checked ){
					//alert(document.form1.xcodigo.value)	
					codigo=document.form1.XDato[i].value;
					//alert(Valor);
					window.open("../ventas/funcionOT.php?CodDoc="+codigo+"&Fun="+Valor+"&ventana=SegCaja", "ventana1" , "width=550,height=250,scrollbars=NO,top=100,left=200") 
				}		
			}	
	}	
	
	
		
}
function FuncionOT2(Codigo,Valor){
	window.open("funcionOT.php?Fun="+Valor, "ventana1" , "width=550,height=250,scrollbars=NO,top=100,left=200") 
}
function FacPagos(objeto){
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
	var sucursal=1; 
	var tipomov=2; 
//window.open("../add_referTN.php?sucursal="+sucursal+"&tipomov="+tipomov+"&codigo="+valor,valor,"toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=320,left=300 top=250");
window.showModalDialog('../add_referTN.php?sucursal='+sucursal+'&tipomov='+tipomov+"&codigo="+valor,"","dialogWidth:520px;dialogHeight:360px,top=100,left=200,status=yes,scrollbars=yes");

}


function canjear(){

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
//alert(valor);
var tempv=valor.split("|");
var tienda=document.form1.almacen.value;

window.showModalDialog("gen_doc.php?codigo="+tempv[1]+"&tienda="+tienda,"","dialogWidth:610px;dialogHeight:520px,top=100,left=200,status=yes,scrollbars=yes");

}

</script>