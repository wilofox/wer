<?php session_start();
include('../conex_inicial.php');

$Utienda= $_SESSION['user_tienda'] ;
$Usucursal= $_SESSION['user_sucursal'] ;
$Ucodvendedor=  $_SESSION['codvendedor'];
$Univel= $_SESSION['nivel_usu'];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>

<!--
<script src="../jquery-1.2.6.js"></script>
<script src="../jquery.hotkeys.js"></script>
-->
	
	<script src="../js/js/jquery-1.8.2.js"></script>
	<script src="../js/js/jquery-ui-1.9.1.custom.js"></script>


<script language="JavaScript">


$(function() {
    $( "#fec1" ).datepicker({
	  dateFormat: "dd-mm-yy",		
      changeMonth: true,
      changeYear: true,
	  showButtonPanel: true
    });
	 $( "#fec2" ).datepicker({
	  dateFormat: "dd-mm-yy",		
      changeMonth: true,
      changeYear: true,
	  showButtonPanel: true
    });
	
	 $( "#fec12" ).datepicker({
	  dateFormat: "dd-mm-yy",		
      changeMonth: true,
      changeYear: true,
	  showButtonPanel: true
    });	
	
	/*
	$( "button:first" ).button({
      icons: {
         primary: "ui-icon-gear",
        secondary: "ui-icon-triangle-1-s"
      },
      text: false
    });
	*/
	
});

 $(function() {
    $( "input[type=submit], a, button" )
      .button({
		  icons: {
			//primary: "ui-icon-gear",
			//secondary: "ui-icon-triangle-1-s"
		  }
	  })
      .click(function( event ) {
        event.preventDefault();
      });
  });
  
  function procesarEvento(evento){
  //$("#texto").html($("#texto").html() + evento.type + ": " + evento.which + ", "); 
	
	//alert((evento.which));	
		if(evento.which=='114'){
		event.keyCode = 0;
   		event.returnValue = false;
		Facturar(this);	
		}
		if(evento.which=='119'){
		doc_det(this)
		}
		if(evento.which=='116'){//f5
		event.keyCode = 0;
   		event.returnValue = false;
		}
	
  }
  

$(document).keydown(procesarEvento);
//$(document).keypress(procesarEvento);
//$(document).keyup(procesarEvento);
/* ----combinar teclas----------
var ctrlPressed = false;
var teclaCtrl = 17, teclaC = 67;

$(document).keydown(function(e){
  if (e.keyCode == teclaCtrl)
    ctrlPressed = true;

  if (ctrlPressed && (e.keyCode == teclaC))
    alert("Has presionado Ctrl+C");

});

$(document).keyup(function(e){
  if (e.keyCode == teclaCtrl)
    ctrlPressed = false;
});
 */

</script>

<script language="javascript">

var nivelUser="<?php echo $Univel ?>";

function recargar(){
document.getElementById('btn1').disabled="disabled";	
document.getElementById('btn2').disabled="disabled";
document.getElementById('btn4').disabled="disabled";

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
		$.post('lista_milifacturaGuias.php?almacen='+almacen+'&cliente='+cliente+'&ruc='+ruc+'&vendedor='+vendedor+'&docref='+docref+'&fec1='+fec1+'&fec2='+fec2+'&mosdocFac='+mosdocFac+'&mosdocAnu='+mosdocAnu+'&pagina='+pagina, { variable: variable_post }, function(data){	
		$("#detalle").html(data).fadeIn();
		});			
	});
}

$actual=0;
//timer = setInterval("recargar()", 20000);
</script>

<script language="javascript" src="../miAJAXlib2.js"></script>
<!--
<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>
<style type="text/css">
-->

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
<style type="text/css">
<!--
.Estilo115 {color: #FF0000}
-->
</style>
</head>


<link href="../styles.css" rel="stylesheet" type="text/css">
<link href="../js/css/ui-lightness/jquery-ui-1.9.1.custom.css" rel="stylesheet">

<style type="text/css">
<!--
body {
background-color:#F3F3F3;   
}

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
.Estilo114 {font-size: 10px}

.fieldset1 {
border: 1px solid #FF9900;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
padding: 5px;
font-family: Verdana, Arial, Helvetica, sans-serif;
color: #0B173B;
background:#FEFACB;
}
.legend1 {
text-align:center;
font-weight:bold;
font-size:10px;
color:#0066FF;

}
.fieldset2 {
border: 1px solid #E1E1E1;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
padding: 2px;
color: #0B173B;
background:#F8F8F8;
}
.fieldset3 {
border: 1px solid #E1E1E1;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
padding: 2px;
color: #0B173B;
background:#F8F8F8;
}

.Estilo116 {color: #0066CC}
</style>

<script>
function cargar_cbo(texto){
//alert(texto);
var r = texto;
document.getElementById('cbo_tienda').innerHTML=r;
//alert();
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
document.form1.almcod.value=document.form1.almacen.value;
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
cargardatos('');
document.getElementById("divOrder").style.visibility="hidden";
}
function ordenamiento(Campo){
var ordenar=Campo;
var orden=document.form1.orden.value;
document.form1.ordenar.value=Campo;
var pagina='';

cargardatos('');

	if(orden=='asc'){
		document.form1.orden.value="desc";
	}else{
		document.form1.orden.value="asc";
	}	
		
}
function mostrar_vent(){
//alert(pagina);

document.getElementById('btn1').disabled="disabled";	
document.getElementById('btn2').disabled="disabled";
document.getElementById('btn4').disabled="disabled";

var almacen=document.form1.almacen.value;
var cliente=document.form1.cliente.value;
var ruc=document.form1.ruc.value;
var ckbven=document.form1.ckbven.checked;
var Estado=document.form1.Estado.value;
var cmbmoneda=document.form1.cmbmoneda.value;
var campoOrder=document.form1.tpcampo.value;
var formaOrder=document.form1.tporden.value;

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
window.open('lista_milifactura_imp.php?almacen='+almacen+'&cliente='+cliente+'&ruc='+ruc+'&vendedor='+vendedor+'&docref='+docref+'&fec1='+fec1+'&fec2='+fec2+'&mosdocFac='+mosdocFac+'&mosdocAnu='+mosdocAnu+'&Estado='+Estado+'&cmbmoneda='+cmbmoneda+'&campoOrder='+campoOrder+'&formaOrder='+formaOrder);

//setInterval("cargardatos('')", 20000);
}

</script>


<body onLoad="document.form1.almacen.focus(); cargardatos('');CarCodT();">

<form id="form1" name="form1" method="post" action="">
  <table width="810" height="422" border="0" cellpadding="0" cellspacing="0">
    
    <tr style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="5" height="23">&nbsp;</td>
      
      <td width="760" height="25" colspan="11" style="border:#999999">
	  <span class="Estilo100">Vendedor : MultiFacturador de Pedidos</span>	  
      <input type="hidden" name="carga" id="carga" value="N">
	  <input name="orden" type="hidden" size="5" value="asc">
	  <input name="ordenar" type="hidden" size="5" value=""> 	  
	  <select name="select" onChange="cambiarEstado(this)" style="visibility:hidden">
        <option value="P" selected>Pendiente</option>
        <option value="F">Terminado</option>
        <option value="and flag=A">Anulado</option>
        <option value="T">Todos</option>
      </select>
	  <span class="Estilo114">
	  <input name="ruc" type="hidden" id="ruc"  style="height:20; border-color:#CCCCCC" size="11" maxlength="11" autocomplete="off">
	  <input name="ckbven" type="checkbox" id="ckbven" style="border: 0px; background-color:#F9F9F9; visibility:hidden " onClick="activar('ven')"   <?
			  if ($Univel==1 ){ //|| $Univel==6
			  	echo 'checked   disabled';
			  }else{
			   echo '';
			  }
			  ?> value="checkbox" >
	  <span class="Estilo15">
	  <select name="vendedor" id="vendedor" style="width:200; visibility:hidden"  disabled>
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
		 <table width="99%" height="20" border="0" cellpadding="0" cellspacing="0" >
        <tr>
		  <td >
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
		  <?php 
			  
			  if($Univel!='4' && $Univel!='5'){
			  $disabTien='disabled';
			  }
			  ?>
            <input name="Estado" type="hidden" id="Estado" value="" >
            <input name="tpcampo" type="hidden" id="tpcampo"  >
            <input name="tporden" type="hidden" id="tporden" ></td>
          </tr>
        <tr>
          <td  height="20"></td>
        </tr>
      </table>
		
	    <table width="802" border="0" cellpadding="1" cellspacing="0">
          <tr>
            <td width="469" height="82" align="center" class="Estilo114">
			<fieldset class="fieldset2">
              <table width="446" height="103" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="66" height="22" align="right">Tiendas :</td>
                  <td width="281"><input name="almcod" type="text" disabled id="almcod"  style="height:20; border-color:#CCCCCC" size="5">
                    <select  name="almacen" id="almacen" style="width:200" onChange="CarCodT()" <?php echo $disabTien?>>
                        <?php 		
  $resultados1 = mysql_query("select * from tienda order by des_tienda ",$cn); 
  $k=0;
while($row1=mysql_fetch_array($resultados1))
{

	if ($Utienda==$row1['cod_tienda'] and $Univel<>5){
	?>
                        <option value="<?php echo $row1['cod_tienda'] ?>" selected><?php echo $row1['des_tienda'] ?></option>
                        <?
	}else{
	?>
                        <option value="<?php echo $row1['cod_tienda'] ?>"><?php echo $row1['des_tienda'] ?></option>
                        <?
	}
	 
	$k++;
		}?>
                    </select></td>
                  <td width="99" rowspan="4"><table onClick="cargardatos('')"   width="86%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td align="center"></td>
                      </tr>
                      <tr>
                        <td height="24" align="center"><button><img src="../imagenes/ico_lupa.png"><br>
                          Procesar</button></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td height="29" align="right" >Cliente : </td>
                  <td><input name="cliente" type="text" id="cliente"  style="height:20; border-color:#CCCCCC"  size="20" maxlength="100" autocomplete="off" onKeyUp="cargardatos('')"  >
                    Mon:
                    <select style="width:90" name="cmbmoneda" onChange="cargardatos('')" >
          <option value="" selected >Todas</option>
          <option value="01" >Soles(S/.)</option>
          <option value="02">Dolares(US$.)</option>
      </select></td>
                </tr>
                <tr>
                  <td height="26" align="right">Fecha  : </td>
                  <td><?
			//echo $Univel;
			if ($Univel==1 ){ // || $Univel==6
			 $ActUsr ='style="height:18; visibility:hidden"';
			 $DisUsr='disabled';
			}else{
			$ActUsr ='style="height:18"';
			$DisUsr='';
			}
			?>
                      <input name="fec1" id="fec1" type="text" size="10" maxlength="50" value="<?php echo date('d-m-Y')?>"   >
                    Hasta
                    <input name="fec2" id="fec2" type="text" size="10" maxlength="50"  value="<?php echo date('d-m-Y')?>"  ></td>
                </tr>
                <tr>
                  <td height="26" align="right"><span class="Estilo116">Docs. : </span></td>
                  <td><span class="Estilo15">
                    <select name="docref" id="docref" style="width:200" >
                      <?php 
	$resultados11 = mysql_query("select * from operacion where tipo ='2'  and substring(p1,32,1)='S' order by descripcion ",$cn); 
	while($row11=mysql_fetch_array($resultados11)){
					
		  ?>
                      <option value="<?php echo $row11['codigo']?>"><?php echo $row11['codigo'].' - '.$row11['descripcion'];?></option>
                      <?php 
			  }
			  ?>
                    </select>
                  </span><span class="Estilo15"> </span></td>
                </tr>
              </table>
            </fieldset>&nbsp;</td>
            <td width="14" class="Estilo114"></td>
            <td width="319" class="Estilo114" >
			
			<fieldset class="fieldset1">
              <legend class="legend1" >Datos de Facturaci&oacute;n</legend>
              <table width="293" height="75" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="125" height="27" align="left" valign="middle"> Precio:
                    <label for="select"></label>
                      <select name="lista_pre" id="lista_pre">
                        <option value="1">Guia</option>
                        <option value="2">Lista</option>
                    </select></td>
                  <td width="204" height="27" valign="middle">
				F.emi:
                    <input name="fec12" id="fec12" type="text" size="10" maxlength="50" value="<?php echo date('d-m-Y')?>"  <?=$DisUsr;?>  >       			  </td>
                </tr>
                <tr>
                  <td height="24" colspan="2" align="left" valign="middle">Tipo Formato:
                    <select name="forma" id="forma">
                      <option value="1" selected>Detallado</option>
                      <option value="2">Consolidado</option>
                    </select></td>
                </tr>
                <tr>
                  <td height="24" colspan="2" valign="middle">Generar Doc. en:                  
                  <input name="rbMoneda" type="radio" style="border:none; background:none" value="01" checked>
                  <span class="Estilo114"><strong>Soles (S/. )                  </strong></span>
                  <input name="rbMoneda" type="radio" value="02" style="border:none; background:none">
                  <span class="Estilo114"><strong> D&oacute;lares (US$.) </strong></span></td>
                </tr>
              </table>
              <span class="Estilo114"></fieldset></td>
          </tr>
        </table>      </td>
    </tr>
    <tr>
      <td height="200">&nbsp;</td>
	  
      <td valign="top">
	  
	  <table width="800" border="0" cellpadding="0" cellspacing="1">
        <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
          <td   style=" border:#CCCCCC solid 1px" width="28" height="21" align="center" ><span class="texto2"><strong>OK</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="22" align="center"><span class="texto1">
            <input style="border: 0px; background:none; " type="checkbox" name="Cod" onClick="marcar()"   />
          </span></td>
          <td width="72" align="center"  onClick="ordenamiento('fecha')" style=" border:#CCCCCC solid 1px;cursor:pointer; text-decoration:underline"><span class="texto2"><strong>Fec. de Emi </strong></span></td>
        
          <td  style=" border:#CCCCCC solid 1px" width="39"><span class="texto2"><strong>Hora</strong></span></td>
		    <td  style=" border:#CCCCCC solid 1px" width="102" ><span class="texto2"><strong>PC</strong></span></td>
		    <td   onClick="ordenamiento('Num_doc')" style=" border:#CCCCCC solid 1px;cursor:pointer; text-decoration:underline;" width="85" ><span class="texto2"><strong>N&uacute;mero(PV)</strong></span></td>
		  
            <td   onClick="ordenamiento('cliente')" style=" border:#CCCCCC solid 1px;cursor:pointer; text-decoration:underline" width="141" ><span class="texto2"><strong>Cliente</strong></span>
			
			 &nbsp;
		  <div id="divOrder" style="position:absolute; left: 380px; top: 153px; height: 48px; width: 95px; visibility:hidden">
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
          <td  style=" border:#CCCCCC solid 1px" width="30" ><span class="texto2"><strong>Mon</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="67" ><span class="texto2"><strong>Importe</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="85" ><span class="texto2"><strong>Vendedor</strong></span></td>
          <td width="117" onClick="ordenamiento('cod_cab')" style=" border:#CCCCCC solid 1px;cursor:pointer; text-decoration:underline" ><span class="texto2"><strong>Referencia </strong></span></td>
          </tr>
        <tr>          
		  <td height="150" colspan="11" >
		  <div id="detalle" style="width:800px; height:150px;" ></div>		  </td>
          </tr>
     </table>
	 </td>
    </tr>
    <tr>
      <td height="15">&nbsp;</td>
      <td><table width="764" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="230">
		  
		  <table width="100%" height="27" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td><fieldset class="fieldset3">
                <table width="114" height="25" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="30" height="25" align="center" ><table width="15" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="5" height="5" bgcolor="#00CC66"></td>
                        </tr>
                    </table></td>
                    <td width="84" ><span class="text9 Estilo114" style="color:#000000">CON SERIE</span></td>
                  </tr>
                </table>
              </fieldset>&nbsp;</td>
              <td><table width="114" height="36" border="0" cellpadding="0" cellspacing="0" style="visibility:hidden">
                <tr  >
                  <td bgcolor="#D7FFF0" ><div align="center" class="text9" style="color:#000000">Doc. CON SERIE</div></td>
                </tr>
                <tr>
                  <td bgcolor="#FFDFF4"><div align="center" class="text9" style="color:#000000">Doc. CON PAGO</div></td>
                </tr>
              </table></td>
            </tr>
          </table>          </td>
          <td width="5">&nbsp;</td>
          <td width="80">
		
		  <table onClick="Facturar(this)" border="0" cellpadding="0" cellspacing="0" disabled id="btn1">
            <tr>
              <td align="center"><button  style="width:80px"><img  src="../imagenes/iconohoja.gif" width="16" height="22"><br>
                <span class="Estilo114"><span class="Estilo116">Facturaci&oacute;n</span><br>
                <span class="Estilo115">[F3]</span></span></button></td>
            </tr>
          </table>
		  
		  		  </td>
          <td width="1"><table onClick="Anular('')"  style="cursor:pointer; display:none" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="95%" border="0" cellpadding="0" cellspacing="0"  id="btn3" >
            <tr>
              <td align="center"><img  src="../imagenes/cerrar.jpg" width="22" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" style="font-size:9px"><span style="color:#FF3300;">[F5]</span> Desanular</span></td>
            </tr>
          </table><td width="5">&nbsp;</td>
		  
          <td width="80">
		  <table onClick="doc_det(this)" border="0" cellpadding="0" cellspacing="0" disabled id="btn2">
            <tr>
              <td align="center"><button style="width:80px"><img  src="../imgenes/origen.png" width="20" height="22"><br>
                <span class="Estilo114"><span class="Estilo116">Origen </span> <br>
                <span class="Estilo115">[F8]</span></span></button></td>
            </tr>
            
          </table>
		  </td>
          <td width="5">&nbsp;</td>
          <td width="333"><table onClick="FuncionOT(this,'CON','<?=$_SESSION['nivel_usu'];?>')"  style="cursor:pointer; visibility:hidden" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="71" border="0" cellpadding="0" cellspacing="0" disabled id="btn4">
            <tr>
              <td width="71" align="center"><img  src="../imgenes/email_edit.gif" width="20" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" ><span style="color:#FF3300">[F10]</span> Tot. Venta </span></td>
            </tr>
          </table></td>
        </tr>
      </table>	 </td>
    </tr>
  </table>
  
  <div style="display:none">
      <span class="Estilo114"><b>Mostrar Documento:</b></span>
      <input name="ckbDoc"  type="checkbox" id="ckbDoc" style="border: 0px; background-color:#F9F9F9; " checked   onClick="activar('mosdoc1');cargardatos('')" > 
      Todos
	  <input name="ckbDoc" type="hidden" id="ckbDoc" style="border: 0px; background-color:#F9F9F9; " onClick="activar('mosdoc2');cargardatos('')" title="Solo Facturados" > 
	  <input name="ckbDoc" type="checkbox" id="ckbDoc" style="border: 0px; background-color:#F9F9F9; " onClick="activar('mosdoc3');cargardatos('')" > 
	  Solo Anulados	  </div>
  
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
document.getElementById('btn4').disabled="disabled";

var almacen=document.form1.almacen.value;
var cliente=document.form1.cliente.value;
var ruc=document.form1.ruc.value;
var ckbven=document.form1.ckbven.checked;
var Estado=document.form1.Estado.value;
var cmbmoneda=document.form1.cmbmoneda.value;
var campoOrder=document.form1.tpcampo.value;
var formaOrder=document.form1.tporden.value;
var vendedor='';
	if (ckbven){
		var vendedor=document.form1.vendedor.value;
	}
var docref=document.form1.docref.value;
var fec1=document.form1.fec1.value;
var fec2=document.form1.fec2.value;
var ordenar=document.form1.ordenar.value;
var orden=document.form1.orden.value;
var mosdocFac='';
var mosdocAnu='';
if (document.form1.ckbDoc[0].checked){ var mosdocFac=''; var mosdocAnu=''; }
if (document.form1.ckbDoc[1].checked){ var mosdocFac='B'; }
if (document.form1.ckbDoc[2].checked){ var mosdocAnu='A'; }
//alert(mosdocFac+'//'+mosdocAnu);
//var pagina=document.form1.pag.value;

//lista_GenDocRef.php
doAjax('lista_milifacturaGuias.php','&almacen='+almacen+'&cliente='+cliente+'&pagina='+pagina+'&ruc='+ruc+'&vendedor='+vendedor+'&docref='+docref+'&fec1='+fec1+'&fec2='+fec2+'&mosdocFac='+mosdocFac+'&mosdocAnu='+mosdocAnu+'&Estado='+Estado+'&cmbmoneda='+cmbmoneda+'&campoOrder='+campoOrder+'&formaOrder='+formaOrder+'&ordenar='+ordenar+'&orden='+orden,'mostrar_filtro','get','0','1','','');

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
	document.getElementById('AnularRk').style.visibility='hidden';
	document.getElementById('AnularRk').style.visibility='visible';
	document.form1.carga.value='S';
	valor=valor.substr(6,15);
	doAjax('anular.php','&CodDoc='+valor+'&Condicion='+condicion,'UpdateAnulado','get','0','1','','');
}
function UpdateAnulado(texto){
//alert(texto);
var r = texto;
	var valor="";
	var temp_criterio='';

//	document.getElementById('AnularRk').innerHTML=r;
//	document.getElementById('AnularRk').style.visibility='visible';
}

function Anular(objeto){
//alert(nivelUser);
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
document.getElementById('btn4').disabled="disabled";

document.getElementById('btn3').style.display='none';
document.getElementById('btn2').style.display='block';
//alert(document.getElementById('btn2').style.display);
	if (document.form1.xcodigo.length==undefined){
		if (document.form1.xcodigo.checked  ){
		
							if (objeto=='S'){
						
						
						if(nivelUser!='8'){	
						document.getElementById('btn1').disabled="";
						}
						
						document.getElementById('btn2').disabled="";
						document.getElementById('btn4').disabled="";
						document.getElementById('btn3').style.display='none';
						document.getElementById('btn2').style.display='block';	
							}else{
						document.getElementById('btn3').disabled="";
						document.getElementById('btn2').style.display='none';
						document.getElementById('btn3').style.display='block';
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
							
						if(nivelUser!='8'){	
						document.getElementById('btn1').disabled="";
						}
						document.getElementById('btn2').disabled="";
						document.getElementById('btn4').disabled="";
						document.getElementById('btn3').style.display='none';
						document.getElementById('btn2').style.display='block';	
							}else{
							document.getElementById('btn3').disabled="";
						document.getElementById('btn2').style.display='none';
						document.getElementById('btn3').style.display='block';
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
			//alert(nivelUser);
		if(nivelUser!='8'){				
		document.getElementById('btn1').disabled="";
		}
		document.getElementById('btn2').disabled="";
		}		
	}else{
		for(var i=0;i<document.form1.xcodigo.length;i++){
			document.form1.xcodigo[i].checked=false;
			
			document.getElementById('btn1').disabled="disabled";	
			
			document.getElementById('btn2').disabled="disabled";
			document.getElementById('btn4').disabled="disabled";
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
			//Comprobante(document.form1.xcodigo.value,objeto);
			NumDc=0;
			codigoCli = document.form1.xcodigo.value.substr(0,6) ;	
			codigoRk1 = document.form1.xcodigo.value.substr(6,15) ;	
			//alert (NumDc + '//' +codigoCli + '//' + codigoRk1)
			document.form1.carga.value='S';			
			CodigoVal="'"+codigoRk1+"',";
			 doAjax('../compras/peticion_datos.php','&peticion=save_SesionMilFac&insert=multifac','mostrar_SesionMilFac','get','0','1','','');
			//doAjax('../compras/peticion_datos.php','&peticion=save_SesionMilFac&NumDc=0&codigo='+codigoRk1+'&codigoCli='+codigoCli,'mostrar_SesionMilFac','get','0','1','','');

		//	alert("Procesando información \n clic en Aceptar... ");
			
		// doAjax('../compras/peticion_datos.php','&peticion=save_SesionMilFac&insert=multifac','mostrar_SesionMilFac','get','0','1','','');
		 
		}
	}else{
		var NumDc=-1;
		var codigoCli='';
		CodigoVal='';
		var codCliVal='';
		
		var myCars=new Array();
	   
		 for(var i=0;i<document.form1.xcodigo.length;i++){
			if (document.form1.xcodigo[i].checked ){					
				codigoCli = document.form1.xcodigo[i].value.substr(0,6) ;	
				codigoRk1 = document.form1.xcodigo[i].value.substr(6,15) ;	
				// asignar array
				NumDc++; 
				myCars[NumDc]=codigoCli;
				// Aguardando datos 
				//alert (NumDc + '//' +codigoCli + '//' + codigoRk1)
				document.form1.carga.value='S';
				//doAjax('../compras/peticion_datos.php','&peticion=save_SesionMilFac&NumDc='+NumDc+'&codigo='+codigoRk1+'&codigoCli='+codigoCli,'mostrar_SesionMilFac','get','0','1','','');
			//temporal
			CodigoVal +="'"+codigoRk1+"',";
			}
		}	
		//alert(CodigoVal);	 
		//alert("Procesando información \n  clic en Aceptar... ... ");
		 doAjax('../compras/peticion_datos.php','&peticion=save_SesionMilFac&insert=multifac','mostrar_SesionMilFac','get','0','1','','');
	}
		
}
var CodigoVal="";
function mostrar_SesionMilFac(texto){
//alert(texto);
//return false
	if (texto!=''){
		for(var z=0;z<texto;z++){
			//Comprobante(z);
			//Comprobante(myCars[z]);
			//Comprobante(CodigoVal);
		}
		
		Comprobante(CodigoVal);
		//alert(CodigoVal);
		//cargardatos('');	
	}

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
function Comprobante(valor){
//alert(valor);
//showModalDialog

if(document.form1.rbMoneda[0].checked) var Monfact="01";
if(document.form1.rbMoneda[1].checked) var Monfact="02";

//alert(Monfact);

window.showModalDialog("../empresaMultifacturaGuias.php?codigo="+valor+"&condicionRk=RA&lista_pre="+document.form1.lista_pre.value+"&forma="+document.form1.forma.value+"&Monfact="+Monfact+'&femiFact='+document.form1.fec12.value ,"","dialogWidth:610px;dialogHeight:540px,top=100,left=200,status=yes,scrollbars=yes");


//window.open("../empresaMultifacturaGuias.php?codigo="+valor+"&condicionRk=RA" ,"","dialogWidth:610px;dialogHeight:540px,top=100,left=200,status=yes,scrollbars=yes");

}

function cambiarEstado(obj){
document.form1.Estado.value=obj.value;
cargardatos('');
}
function FuncionOT(Codigo,Valor,Nivel){

if (Valor=='TER' ){
	if (Nivel==5 || Nivel== 4){

	}else{
		alert('Usuario no Autorizado');
		return false
	}
}

	
	if (document.form1.xcodigo.length==undefined){
		if (document.form1.xcodigo.checked  ){
			//AnularDoc(document.form1.xcodigo.value,objeto);
			codigo=document.form1.xcodigo.value;
			codigo=codigo.substr(6,15)+',';
			//window.open("funcionOT.php?CodDoc="+codigo+"&Fun="+Valor+"&ventana=ts", "ventana1" , "width=550,height=250,scrollbars=NO,top=100,left=200") 	
		}	
	}else{
XcodM='';
		for(var i=0;i<document.form1.xcodigo.length;i++){
				if (document.form1.xcodigo[i].checked ){
					codigo=document.form1.xcodigo[i].value;
					codigo=codigo.substr(6,15);
					XcodM+=codigo+',';					
//window.open("funcionOT.php?CodDoc="+codigo+"&Fun="+Valor+"&ventana=ts",codigo,"toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=320,left=300 top=250");
				}		
			}	
			codigo=XcodM;
	}	
//alert(codigo);
//alert(myAgupar);	
window.open("funcionOT.php?CodDoc="+codigo+"&Fun="+Valor+"&ventana=ts",Valor,"toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=320,left=300 top=250");
	
		
}
</script>
