<?php session_start();
include('../conex_inicial.php');

//$Utienda= $_SESSION['user_tienda'] ;
$Usucursal= $_SESSION['user_sucursal'] ;
//$Ucodvendedor=  $_SESSION['codvendedor'];
$Univel= $_SESSION['nivel_usu'];
$tip=$_REQUEST['tipo'];
switch($tip){
	case '1':$title="Proveedores";break;
	case '2':$title="Clientes";break;
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
		docs();
 return false; }); 
jQuery(document).bind('keydown', 'f12',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		if (document.getElementById('btn5').disabled==false){
			Cancelar(this);
		}
 return false; }); 
jQuery(document).bind('keydown', 'f3',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		Nuevo();
 return false; }); 
 jQuery(document).bind('keydown', 'f10',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;		
		//if (document.getElementById('btn4').disabled==false){
			FuncionOT(this,'CON','<?=$_SESSION['nivel_usu'];?>');
		//}
		
 return false; }); 
 jQuery(document).bind('keydown', 'f6',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;		
		if (document.getElementById('btn6').disabled==false){
			FuncionOT(this,'OBS',this);
		}
		
 return false; }); 
 jQuery(document).bind('keydown', 'f4',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;		
		if (document.getElementById('btn6').disabled==false){
			FuncionOT(this,'LET','<?=$_SESSION['nivel_usu'];?>');
		}
		
 return false; }); 
 jQuery(document).bind('keydown', 'f9',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;		
		if (document.getElementById('btn7').disabled==false){
			FuncionOT(this,'ADJ',this);
		}
		
 return false; }); 
jQuery(document).bind('keydown', 'f5',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		if (document.getElementById('btn2').disabled==true){
			if (document.getElementById('btn3').disabled==false){
				Anular('');
			}
		}else{
			if (document.getElementById('btn2').disabled==false){
				Anular('A');
			}
		}
 return false; }); 
 jQuery(document).bind('keydown', 'f8',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		//doc_det(document.form1.XDato.value);
		doc_det(this);
		
 return false; }); 
  jQuery(document).bind('keydown', 'f7',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		//doc_det(document.form1.XDato.value);
mostrar_vent();
		
 return false; }); 
</script>

<script language="javascript">
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
		$.post('lista_MultiCanje.php?almacen='+almacen+'&cliente='+cliente+'&ruc='+ruc+'&vendedor='+vendedor+'&docref='+docref+'&fec1='+fec1+'&fec2='+fec2+'&mosdocFac='+mosdocFac+'&mosdocAnu='+mosdocAnu+'&pagina='+pagina, { variable: variable_post }, function(data){	
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
.Estilo114 {color: #333333}
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
	/*
	for(var i=0;i<document.form1.xcodigo.length;i++){
		if (document.form1.xcodigo[i].checked){
			 document.getElementById('lista_productos').rows[i].style.backgroundColor = '#999999';
		}
	}
	*/

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


<body onLoad="document.form1.Sucursal.focus(); cargardatos('');CarCodT();">

<form id="form1" name="form1" method="post" action="">
  <table width="810" height="417" border="0" cellpadding="0" cellspacing="0">
    
    <tr style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="5" height="23">&nbsp;</td>
      
	   <td width="760" height="25" colspan="11" style="border:#999999">
	  <span class="Estilo100">Finanzas :: Cuentas Proveedores :: Programaci&oacute;n de Pagos Proveedores :: Programaci&oacute;n de Pagos<?php echo $title;?></span>	  
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
		  <td width="88" >
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
		  <table  title="Ver Documento Origen  [F8]"width="72" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="doc_det(this)">
                <td width="3" ></td>
                <td width="20" ><img src="../imagenes/ico_lupa.png"  width="16" height="16" border="0"></td>
                <td width="46" ><span class="Estilo112">Doc.<span class="Estilo113">[F8]</span></span></td>
                <td width="3" ></td>
              </tr>
          </table>
		  </td>
          <td width="94" ><table  title="Imprimir [F7]"width="87%" height="20" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="mostrar_vent()">
              <td width="1" ></td>
              <td width="23" ><img src="../imgenes/fileprint.gif"  width="16" height="16" border="0"></td>
              <td width="62" ><span class="Estilo112"> Imprimir<span class="Estilo113">[F7]</span></span></td>
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
              <input name="tpcampo" type="hidden" id="tpcampo"  ><input name="tporden" type="hidden" id="tporden" >&nbsp;</td>
            <td width="85"><div align="right">Fecha de Giro : </div></td>
            <td colspan="3"><?
			//echo $Univel;
			if ($Univel==1 ){ // || $Univel==6
			 $ActUsr ='style="height:18; visibility:hidden"';
			 $DisUsr='disabled';
			}else{
			$ActUsr ='style="height:18"';
			$DisUsr='';
			}
			?>
              <input name="fec1" type="text" size="10" maxlength="50" value="<?php echo "01-".date('m-Y')?>"  <?=$DisUsr;?>  >
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
              </script></td>
            <td width="67" colspan="2" rowspan="2" align="center" valign="middle" class="Estilo114" ><table onClick="cargardatos('')"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="86%" border="0" cellpadding="0" cellspacing="0">
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
            <td colspan="3"><select name="cbomoneda" id="cbomoneda" onChange="cargardatos('')">
            <option value='T'>Todos</option>
			<?php $sql_mon=mysql_query("Select * from moneda",$cn); 
			while($rw_mon=mysql_fetch_array($sql_mon)){ 
				echo "<option value='".$rw_mon['id']."'>".strtoupper($rw_mon['descripcion'])." (".$rw_mon['simbolo'].")</option>";
			} ?></select>&nbsp;</td>
            <td width="85"><div align="right"><span class="Estilo114">Estado : </span></div></td>
            <td colspan="3"><select name="cboestado" id="cboestado" onChange="cargardatos('')">
				<option value='A'>Anulados</option>
                <option value='T'>Aprobado</option>
                <option value='E'>En espera</option>
                <option value='' selected>Todos</option>
			</select>&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td height="227">&nbsp;</td>
	  
      <td valign="top">
	  
	  <table width="800" border="0" cellpadding="0" cellspacing="1">
        <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
          <td   style=" border:#CCCCCC solid 1px" width="27" height="21" align="center" ><span class="texto2"><strong>OK</strong></span></td>
          <?php /*?><td  style=" border:#CCCCCC solid 1px" width="23" align="center"><span class="texto1">
            <input style="border: 0px; background:none; " type="checkbox" name="Cod" onClick="marcar()"   />
          </span></td><?php */?>
          <td width="65" align="center" onMouseOver="entradaOrderY(this)" onMouseOut="entradaOrderY(this)" onClick="ordenamiento('fecha')" style=" border:#CCCCCC solid 1px;cursor:pointer; text-decoration:underline"><span class="texto2"><strong>Cta Banco </strong></span></td>
		    <td  style=" border:#CCCCCC solid 1px" width="77" ><span class="texto2"><strong>Moneda</strong></span></td>
		    <td width="59" align="center" style=" border:#CCCCCC solid 1px;cursor:pointer; text-decoration:underline;" onClick="ordenamiento('Num_doc')"  onMouseOver="entradaOrderY(this)" onMouseOut="entradaOrderY(this)" ><span class="texto2"><strong>T.P</strong></span></td>
		  
            <td  onMouseOver="entradaOrderY(this)" onMouseOut="entradaOrderY(this)" onClick="ordenamiento('cliente')" style=" border:#CCCCCC solid 1px;cursor:pointer; text-decoration:underline" width="59" ><span class="texto2"><strong>N&uacute;mero</strong></span>&nbsp;
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
		  </div>
		  </td>
          <td  style=" border:#CCCCCC solid 1px" width="130" ><span class="texto2"><strong>Proveedor</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="75" ><span class="texto2"><strong>Fecha Giro </strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="52" ><span class="texto2"><strong>T.C.</strong></span></td>
          <td width="98" align="center" style=" border:#CCCCCC solid 1px;cursor:pointer; text-decoration:underline" onClick="ordenamiento('cod_cab')" onMouseOver="entradaOrderY(this)" onMouseOut="entradaOrderY(this)" ><span class="texto2"><strong>Importe</strong></span></td>
          <td width="112" onMouseOver="entradaOrderY(this)" onMouseOut="entradaOrderY(this)" onClick="ordenamiento('cod_cab')" style=" border:#CCCCCC solid 1px;cursor:pointer; text-decoration:underline" ><span class="texto2"><strong>Observaciones </strong></span></td>
          <td width="14" onMouseOver="entradaOrderY(this)" onMouseOut="entradaOrderY(this)" style=" border:#CCCCCC solid 1px;" ><span class="texto2"><strong>A </strong></span></td>
          </tr>
        <tr>          
		  <td colspan="12" >
		  <div id="detalle" style="width:800px; height:180px;" ></div>		  </td>
          </tr>
     </table>
	 <div style="display:none">
      <span class="Estilo114"><b>Mostrar Documento:</b></span>
      <input name="ckbDoc"  type="checkbox" id="ckbDoc" style="border: 0px; background-color:#F9F9F9; " checked   onClick="activar('mosdoc1');cargardatos('')" > 
      Todos
	  <input name="ckbDoc" type="hidden" id="ckbDoc" style="border: 0px; background-color:#F9F9F9; " onClick="activar('mosdoc2');cargardatos('')" title="Solo Facturados" > 
	  <input name="ckbDoc" type="checkbox" id="ckbDoc" style="border: 0px; background-color:#F9F9F9; " onClick="activar('mosdoc3');cargardatos('')" > 
	  Solo Anulados
	  </div>
	  </td>
    </tr>
    <tr>
      <td height="15">&nbsp;</td>
      <td><table width="799" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="118">
		  
		  <table width="53%" height="27" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="51%"><table width="114" height="68" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td bgcolor="#FF0000"><div align="center" class="text9">ANULADO</div></td>
                </tr>
                <tr>
                  <td bgcolor="#79AEFF"><div align="center" class="text9" >APROBADO</div></td>
                </tr>
                <tr>
                  <td height="22" align="center" bgcolor="#FFFFFF" style="border:#CACACA solid 1px"><span class="text9 Estilo114">EN ESPERA </span></td>
                </tr>
              </table></td>
              <td width="49%">&nbsp;</td>
            </tr>
          </table>          </td>
          <td width="59">&nbsp;</td>
          <td width="72" align="center" valign="middle"><table onClick="Nuevo()"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="65" border="0" cellpadding="0" cellspacing="0" id="btn22">
            <tr>
              <td width="65" align="center"><img  src="../imagenes/iconohoja.gif" width="16" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" ><span style="color:#FF3300">[F3]</span>Insertar Nuevo </span></td>
            </tr>
          </table></td>
          <td width="91" align="center" valign="middle"><table onClick="docs()"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="65" border="0" cellpadding="0" cellspacing="0" id="btn22">
            <tr>
              <td  align="center"><img  src="../imagenes/icoDocs.png" width="30" height="26"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" ><span style="color:#FF3300">[F4]<br> </span> Doc(s) Programados </span></td>
            </tr>
          </table></td>
          <td width="88" align="center" valign="middle"><table onClick="Anular('')"  style="cursor:pointer; display:none" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="95%" border="0" cellpadding="0" cellspacing="0"  id="btn3" >
            <tr>
              <td align="center"><img  src="../imagenes/cerrar.jpg" width="22" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" style="font-size:9px"><span style="color:#FF3300;">[F5]</span> Desanular</span></td>
            </tr>
          </table>
            <table onClick="anularProg()"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="65" border="0" cellpadding="0" cellspacing="0" id="btn22">
              <tr>
                <td  align="center"><img src="../imgenes/anular.gif" width="34" height="34"></td>
              </tr>
              <tr>
                <td height="24" align="center"><span class="Estilo100" ><span style="color:#FF3300">[F5]<br>
                </span> Anular </span></td>
              </tr>
            </table></td>
          <td width="89" align="center"><table onClick="eliminarCheque()"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="65" border="0" cellpadding="0" cellspacing="0" id="btn22">
            <tr>
              <td height="34"  align="center"><img src="../imgenes/cancel.gif" width="28" height="28"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" ><span style="color:#FF3300">[F5]<br>
              </span> Eliminar </span></td>
            </tr>
          </table></td>
          <td width="78" height="75" align="center"><table onClick="imprimirCheque()"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="65" border="0" cellpadding="0" cellspacing="0" id="btn22">
            <tr>
              <td height="34"  align="center"><img src="../imgenes/fileprint.png" width="32" height="32"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" ><span style="color:#FF3300">[F5]<br>
              </span> Imprimir </span></td>
            </tr>
          </table></td>
          <td width="82" height="75" align="center">&nbsp;</td>
          <td width="92" align="center">&nbsp;</td>
          <td width="30">&nbsp;</td>
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
/*
document.getElementById('btn1').disabled="disabled";	
document.getElementById('btn2').disabled="disabled";
document.getElementById('btn4').disabled="disabled";
document.getElementById('btn6').disabled="disabled";
document.getElementById('btn5').disabled="disabled";
document.getElementById('btn7').disabled="disabled";

*/
//var almacen=document.form1.almacen.value;
var sucursal=document.form1.Sucursal.value;
/*var cliente=document.form1.cliente.value;
var ruc=document.form1.ruc.value;
var ckbven=document.form1.ckbven.checked;*/
var Estado=document.form1.cboestado.value;
var cmbmoneda=document.form1.cbomoneda.value;
var campoOrder=document.form1.tpcampo.value;
var formaOrder=document.form1.tporden.value;
/*var vendedor='';
	if (ckbven){
		var vendedor=document.form1.vendedor.value;
	}
var docref=document.form1.docref.value;*/
var fec1=document.form1.fec1.value;
//var fec2=document.form1.fec2.value;
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
//alert();
doAjax('det_progpagos.php','&sucursal='+sucursal+'&estado='+Estado+'&moneda='+cmbmoneda+'&pagina='+pagina+'&fec1='+fec1+'&campoOrder='+campoOrder+'&formaOrder='+formaOrder+'&ordenar='+ordenar+'&orden='+orden,'mostrar_filtro','get','0','1','','');

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
	//alert(valor);
	doAjax('anular.php','&CodDoc='+valor+'&Condicion='+condicion,'UpdateAnulado','get','0','1','','');
}
function UpdateAnulado(texto){
//alert(texto);
var r = texto;
if(r!=""){
	alert("No se puede Anular. Contiene Letras "+r);
}
	var valor="";
	var temp_criterio='';
	
cargardatos('');

//	document.getElementById('AnularRk').innerHTML=r;
//	document.getElementById('AnularRk').style.visibility='visible';
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
//document.getElementById('btn4').disabled="disabled";
document.getElementById('btn5').disabled="disabled";
//document.getElementById('btn7').disabled="disabled";

document.getElementById('btn3').style.display='none';
document.getElementById('btn2').style.display='block';
//alert(document.getElementById('btn2').style.display);
	if (document.form1.xcodigo.length==undefined){
		if (document.form1.xcodigo.checked  ){
							if (objeto=='S'){
						document.getElementById('btn1').disabled="";
						document.getElementById('btn2').disabled="";
						document.getElementById('btn4').disabled="";
						document.getElementById('btn6').disabled="";
						document.getElementById('btn5').disabled="";
						document.getElementById('btn7').disabled="";
						//document.getElementById('btn3').style.display='block';
						document.getElementById('btn2').style.display='block';	
							}else{
						document.getElementById('btn3').disabled="";
						//document.getElementById('btn5').disabled="";
						document.getElementById('btn2').style.display='block';
						//document.getElementById('btn3').style.display='block';
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
						document.getElementById('btn4').disabled="";
						document.getElementById('btn6').disabled="";
						document.getElementById('btn7').disabled="";
						document.getElementById('btn5').disabled="";
						//document.getElementById('btn3').style.display='block';
						document.getElementById('btn2').style.display='block';	
							}else{
							document.getElementById('btn3').disabled="";
						document.getElementById('btn2').style.display='block';
						//document.getElementById('btn3').style.display='block';
							}
						
							if (objeto=='A' || objeto=='' ){ 
							AnularDoc(document.form1.xcodigo[i].value,objeto);
							//alert(document.form1.xcodigo[i].value);	
							}
					}		
				}	
	
	}
	//if (objeto=='A'  || objeto==''){	cargardatos(''); }
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
		document.getElementById('btn4').disabled="";
		document.getElementById('btn6').disabled="";
		document.getElementById('btn7').disabled="";
		}		
	}else{
		for(var i=0;i<document.form1.xcodigo.length;i++){
			document.form1.xcodigo[i].checked=false;
			document.getElementById('btn1').disabled="disabled";	
			document.getElementById('btn2').disabled="disabled";
			document.getElementById('btn4').disabled="disabled";
			document.getElementById('btn4').disabled="disabled";
			document.getElementById('btn7').disabled="disabled";
			document.getElementById('btn5').disabled="disabled";
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
function Cancelar(objeto){
	if (document.form1.xcodigo.length==undefined){
		if (document.form1.xcodigo.checked  ){		
			//Comprobante(document.form1.xcodigo.value,objeto);
			NumDc=0;
			codigoCli = document.form1.xcodigo.value.substr(0,6) ;	
			codigoRk1 = document.form1.xcodigo.value.substr(6,15) ;	
			alert (codigoRk1);
			//alert (NumDc + '//' +codigoCli + '//' + codigoRk1);
			document.form1.carga.value='S';			
			//doAjax('../compras/peticion_datos.php','&peticion=save_SesionMilFac&NumDc=0&codigo='+codigoRk1+'&codigoCli='+codigoCli,'mostrar_SesionMilFac','get','0','1','','');

			//alert("Procesando información \n clic en Aceptar... ");
			
		 //doAjax('../compras/peticion_datos.php','&peticion=save_SesionMilFac&insert=multifac','mostrar_SesionMilFac','get','0','1','','');
		 
		}
	}else{
		var NumDc=-1;
		var codigoCli='';
		var CodigoVal='';
		var codCliVal='';
		
		var myCars=new Array();
	   
		 for(var i=0;i<document.form1.xcodigo.length;i++){
			if (document.form1.xcodigo[i].checked && NumDc==-1){					
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
			CodigoVal +=codigoRk1+',';
			}
		}		 
		//alert("Procesando información \n  clic en Aceptar... ... ");
		// doAjax('../compras/peticion_datos.php','&peticion=save_SesionMilFac&insert=multifac','mostrar_SesionMilFac','get','0','1','','');
	}
		//alert (codigoRk1);
	//window.showModalDialog('letras_det.php?mcanje='+codigoRk1,'Cancelacion de Letras',"dialogWidth:730px;dialogHeight:540px,top=100,left=200,status=no,scrollbars=yes");
	window.open('letras_det.php?mcanje='+codigoRk1,'','width:730px;height:540px,top=100,left=200,status=no,scrollbars=yes','');
	//dialogWidth:730px;dialogHeight:540px,top=100,left=200,status=no,scrollbars=yes
}
function mostrar_SesionMilFac(texto){
//alert(texto);
//return false
	if (texto!=''){
		for(var z=0;z<texto;z++){
			Comprobante(z);
			//Comprobante(myCars[z]);
			//Comprobante(CodigoVal);
		}
		cargardatos('');	
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
window.showModalDialog("../empresaMultifactura.php?codigo="+valor+"&condicionRk=RA" ,"","dialogWidth:610px;dialogHeight:540px,top=100,left=200,status=yes,scrollbars=yes");



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
//window.showModalDialog("funcionFN.php?CodDoc="+codigo+"&Fun="+Valor+"&ventana=ts",Valor,"toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=320,left=300 top=250");
if(Valor=="ADJ" || Valor=="OBS"){
	window.open("funcionFN.php?CodDoc="+codigo+"&Fun="+Valor+"&ventana=ts",Valor,"toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=200,left=300 top=200");
}else{
	window.open("funcionFN.php?CodDoc="+codigo+"&Fun="+Valor+"&ventana=ts",Valor,"toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=500,left=300 top=200");
}
		
}
function Nuevo(){

	var tipo="<?php echo $tip;?>";
	var sucursal=document.form1.Sucursal.value;
	var fec1=document.form1.fec1.value;
	
	//window.showModalDialog('nuevopago.php?tipo='+tipo+'&sucursal='+sucursal+'&fec1='+fec1,'Planilla de Letras',"dialogWidth:600px;dialogHeight:700px,top=100,left=200,status=no,scrollbars=yes");
	
	window.open("nuevopago.php?tipo="+tipo+"&sucursal="+sucursal+"&fec1="+fec1,"ventana","toolbar=no,status=yes, menubar=no, scrollbars=yes,resizable=yes, width=620, height=620,left=300 top=100");
			
}

function docs(){

	var tipo="<?php echo $tip;?>";
	var sucursal=document.form1.Sucursal.value;
	var fec1=document.form1.fec1.value;
	
	if (document.form1.XDato.length==undefined){
		var valor=document.form1.XDato.value;
	}else{
		for(var i=0;i<document.form1.XDato.length;i++){
				if (document.form1.XDato[i].checked){
					var valor=document.form1.XDato[i].value;
					var estado=document.form1.estado[i].value;
				}
		}
	}
	
	//alert(estado);
	
	window.open("docs_prog.php?tipo="+tipo+"&sucursal="+sucursal+"&fec1="+fec1+"&id="+valor,"ventana","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=620, height=420,left=300 top=100");
	
				
}

function anularProg(){

	var tipo="<?php echo $tip;?>";
	var sucursal=document.form1.Sucursal.value;
	var fec1=document.form1.fec1.value;
	
	if (document.form1.XDato.length==undefined){
		var valor=document.form1.XDato.value;
	}else{
		for(var i=0;i<document.form1.XDato.length;i++){
				if (document.form1.XDato[i].checked){
					var valor=document.form1.XDato[i].value;
					var estado=document.form1.estado[i].value;
				}
		}
	}
	
	if(estado=='T'){
	alert("No es posible Anular cheques aprobados ");
	}else{
	
	doAjax('../peticion_ajax5.php','&peticion=anularCheque&valor='+valor,'rspta_anularProg','get','0','1','','');
	
	}		

}

function rspta_anularProg(data){
//alert(data);
cargardatos('');
}

function eliminarCheque(){

	var tipo="<?php echo $tip;?>";
	var sucursal=document.form1.Sucursal.value;
	var fec1=document.form1.fec1.value;
	
	if (document.form1.XDato.length==undefined){
		var valor=document.form1.XDato.value;
	}else{
		for(var i=0;i<document.form1.XDato.length;i++){
				if (document.form1.XDato[i].checked){
					var valor=document.form1.XDato[i].value;
					var estado=document.form1.estado[i].value;
				}
		}
	}
	
	if(estado=='T'){
	alert("No es posible Eliminar cheques aprobados ");
	}else{
	
	doAjax('../peticion_ajax5.php','&peticion=eliminarCheque&valor='+valor,'rspta_eliminarCheque','get','0','1','','');
	
	}	

}

function rspta_eliminarCheque(data){
	if(data!=""){
		alert(data);
	}else{
cargardatos('');
	}
}

function imprimirCheque(){

	var tipo="<?php echo $tip;?>";
	var sucursal=document.form1.Sucursal.value;
	var fec1=document.form1.fec1.value;
	
	if (document.form1.XDato.length==undefined){
		var valor=document.form1.XDato.value;
	}else{
		for(var i=0;i<document.form1.XDato.length;i++){
				if (document.form1.XDato[i].checked){
					var valor=document.form1.XDato[i].value;
					var estado=document.form1.estado[i].value;
				}
		}
	}
	
	window.open("impresionCheque.php?valor="+valor,"ventana","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=700, height=420,left=300 top=100");
	
}

</script>
