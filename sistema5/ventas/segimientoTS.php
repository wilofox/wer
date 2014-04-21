<?php
session_start(); 
include('../conex_inicial.php');
//echo $_SESSION['user_tienda']
	$desabilitar="";
    if($_SESSION['nivel_usu']=='1'){
			$desabilitar=" disabled ";
	} 
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<script src="../jquery-1.2.6.js"></script>
<script src="../jquery.hotkeys.js"></script>

<script language="JavaScript">
jQuery(document).bind('keydown', 'f12',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		if (document.getElementById('btn1').disabled==false){
			FuncionOT(this,'TER','<?=$_SESSION['nivel_usu'];?>')			
		}
 return false; }); 
jQuery(document).bind('keydown', 'f5',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		
		if (document.getElementById('btn2').disabled==true){
			if (document.getElementById('btn7').disabled==false){
				Anular('');
			}
		}else{
			if (document.getElementById('btn2').disabled==false){
				Anular('A');
			}
		}
		
		
 return false; }); 
 jQuery(document).bind('keydown', 'f6',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		if (document.getElementById('btn3').disabled==false){
			FuncionOT(this,'OBS');
			//Anular('');
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
		cargar_ventana('imp')
		
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
		//$.post("lista_segimientoTS.php", { variable: variable_post }, function(data){	
		$.post('lista_segimientoTS.php?almacen='+almacen+'&cliente='+cliente+'&ruc='+ruc+'&vendedor='+vendedor+'&docref='+docref+'&fec1='+fec1+'&fec2='+fec2+'&mosdocFac='+mosdocFac+'&mosdocAnu='+mosdocAnu+'&pagina='+pagina, { variable: variable_post }, function(data){	
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
.Estilo117 {font-size: 12}
.Estilo118 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo120 {font-size: 11px; font: bold;}
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
	if(document.form1.almacen.value==0){
		for (var i=0;i<document.form1.docref.length;i++){ 
			//alert(document.form1.docref.options[i].value+" - "+document.form1.docref.options[i].text);
			if(document.form1.docref.options[i].value==0){
			//alert(document.form1.docref.value+" -  "+ document.form1.docref.options[document.form1.docref.selectedIndex].text);
			var aBorrar = document.forms["form1"]["docref"].options[i];
			aBorrar.parentNode.removeChild(aBorrar);
			}
		}
	}else{
		var j=0;
		for (var i=0;i<document.form1.docref.length;i++){ 
			if(document.form1.docref.options[i].value==0){
				j=1;
			}
		//	alert(document.form1.docref.options[i].value+" - "+document.form1.docref.options[i].text);
		}
		
		if(j==0){
		//alert(document.form1.docref.value+" -  "+ document.form1.docref.options[document.form1.docref.selectedIndex].text);
		var opt = document.form1.docref.options; 
		opt[opt.length] = new Option("Todos",0); 
		}

	}
}	
	
</script>
<body onLoad="cargardatos('');">
<form id="form1" name="form1" method="post" action="">
  <table width="807" height="413" border="0" cellpadding="0" cellspacing="0">
    
    <tr style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="5" height="23">&nbsp;</td>
      
      <td width="802" height="25" colspan="12" style="border:#999999">
	    <span class="Estilo100 text5 Estilo117 Estilo118"><span class="text5 Estilo117  Estilo120">Log&iacute;stica :: Transferencia entre Almacenes :: Seguimiento de Transferencias</span></span>	  
        <span class="text5 Estilo117 Estilo118"><span class="text5 Estilo117">
        <input type="hidden" name="carga" id="carga" value="N">
      </span></span><span class="text5 Estilo117">      </span><span class="text5">      </span></td>	  
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
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="cargar_ventana('imp')">
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
            <td>
					
			<select <?php echo $desabilitar ?> name="almacen" id="almacen" style="width:200" onChange="CarCodT()">
			<option value="0">Todos</option>
        <?php 		
  $resultados1 = mysql_query("select * from tienda order by des_tienda ",$cn); 
while($row1=mysql_fetch_array($resultados1))
{			
			
			if ($_SESSION['user_tienda']==$row1['cod_tienda']){
			?>
		 <option selected value="<?php echo $row1['cod_tienda'] ?>"><?php echo $row1['des_tienda'] ?></option>	
			<?
			}else{
			?>
		 <option value="<?php echo $row1['cod_tienda'] ?>"><?php echo $row1['des_tienda'] ?></option>	
			<?
			}
 } ?>
              </select></td>
            <td width="110" class="Estilo114"><div align="right">
              <input <?php echo $desabilitar ?> name="ckbven" type="checkbox" id="ckbven" style="border: 0px; background-color:#F9F9F9; " onClick="activar('ven')"  value="checkbox">
            Responsable : </div></td>
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
            <td ><div align="right">Doc. de Ref.: </div>            </td>
            <td><span class="Estilo15">
              <select name="docref" id="docref" style="width:200" >
                <option value="0">Todos</option>
                <?php 
	$resultados11 = mysql_query("select * from operacion where codigo='TS' order by descripcion ",$cn); 
	while($row11=mysql_fetch_array($resultados11)){
					
		  ?>
                <option value="<?php echo $row11['tipo']?>"><?php 
			 if ($row11['tipo']==2){ echo 'Salida';}else{echo 'Ingreso';}
				  
				echo '('.$row11['codigo'].') - '.$row11['descripcion'];							
				?></option>
                <?php 
			  }
			  
			
			  ?>
              </select>
            </span></td>
            <td class="Estilo15" align="right"> Ordenar por:</td>
		    <td><select name="ordenar" id="ordenar" onChange="cargardatos('')"><option value="fecha">Fecha/Hora</option><option value="numero">Numero</option></select><input name="cliente" type="hidden" id="cliente"  style="height:20; border-color:#CCCCCC"  size="25" maxlength="100" autocomplete="off" >
		      <span class="Estilo114">
		      <input name="ruc" type="hidden" id="ruc"  style="height:20; border-color:#CCCCCC" size="11" maxlength="11" autocomplete="off">
	        </span></td>
            <td class="Estilo114">&nbsp;</td>
          </tr>
          <tr>
            <td height="26"><div align="right">Fec. Transf. : </div></td>
            <td> de 
              <input <?php echo $desabilitar ?> name="fec1" type="text" size="10" maxlength="50" value="<?php echo 
			  date('d-m-Y');
			  //date("d-m-Y", strtotime(date('d-m-Y')." -30 day")); ?>"  >
                <button <?php echo $desabilitar ?> type="reset" id="f_trigger_b2"  style="height:18" >...</button>
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
              <input <?php echo $desabilitar ?> name="fec2" type="text" size="10" maxlength="50"  value="<?php echo date('d-m-Y')?>" >
              <button <?php echo $desabilitar ?> type="reset" id="f_trigger_b1" style="height:18; vertical-align:top" >...</button>
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
            <td colspan="2" class="Estilo114"><div align="middle" style="visibility:hidden">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="Estilo116">Estado</span>
              <select name="select" onChange="cambiarEstado(this)">
                <option value="and estadoOT=T">Aprobado</option>
                <option value="and flag=A">Anulado</option>
                <option value="and estadoOT=O">Observado</option>
                <option value="P" selected>Pendiente</option>
                <option value="T">Todos</option>
              </select>
			  </div>		    </td>
            <td class="Estilo114">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td> <input name="Estado" type="hidden" id="Estado" value="" ></td>
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
          <td   style=" border:#CCCCCC solid 1px" width="34" height="21" align="center" ><span class="texto2"><strong>Num.</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="23" align="center"><span class="texto1">
            <input style="border: 0px; background:none; " type="checkbox" name="Cod" onClick="marcar()"   />
          </span></td>
          <td  style=" border:#CCCCCC solid 1px" width="55" align="center"><span class="texto2"><strong>Fecha</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="53" align="center"><span class="texto2"><strong>Hora </strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="78" ><span class="texto2"><strong>N&uacute;mero</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="150" ><strong class="texto2">Tienda Origen</strong></td>
          <td  style=" border:#CCCCCC solid 1px" width="159"><span class="texto2"><strong>Tienda Destino </strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="40" ><span class="texto2"><strong>Item</strong></span></td>
          <td width="50"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Unidad</strong></span></td>
          <td width="148"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Responsable</strong></span></td>
          </tr>
        <tr>
          <td colspan="10"><div id="detalle" style="width:800px; height:180px;" ><span class="Estilo114">
              <input name="almcod" type="hidden" disabled id="almcod"  style="height:20; border-color:#CCCCCC" size="8">
          </span></div></td>
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
      <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="121" height="50"><table width="58%" height="27" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><table width="114" height="36" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td bgcolor="#FF0000"><div align="center" class="text9">ANULADO</div></td>
                    </tr>
                    <tr style="display:none">
                      <td bgcolor="#0066FF"><div align="center" class="text9">APROBADO </div></td>
                    </tr>
                </table></td>
              </tr>
          </table></td>
          <td width="17">&nbsp;</td>
          <td width="8">
		  
		  
		  <!--
		  <table onClick="FuncionOT2(this,'EST')"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="95%" border="0" cellpadding="0" cellspacing="0" id="btn5" >
            <tr>
              <td align="center"><img src="../images/view_choose.gif" width="28" height="28"></td>
            </tr>
            <tr>
              <td height="24" align="center" ><span class="Estilo100"><span style="color:#FF3300">[F2]</span> Estado </span></td>
            </tr>
          </table>
-->		  </td>
          <td width="102"><table onClick="add_SM('SM')"  style="cursor:pointer; visibility:hidden" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="78%" border="0" cellpadding="0" cellspacing="0"  id="btn6" disabled="disabled">
              <tr>
                <td align="center"><img src="../imgenes/view_bottom.png" width="26" height="26"></td>
              </tr>
              <tr>
                <td height="24" align="center" ><span class="Estilo100"><span style="color:#FF3300">[F3]</span> SM </span></td>
              </tr>
          </table></td>
          <td width="113"><table disabled=disabled onClick="add_SM('RM')"  style="cursor:pointer;visibility:hidden" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="68%" border="0" cellpadding="0" cellspacing="0"  id="btnRM" >
            <tr>
              <td align="center"><img src="../imgenes/view_bottom.png" width="26" height="26"></td>
            </tr>
            <tr>
              <td height="24" align="center" ><span class="Estilo100"><span style="color:#FF3300">[F4]</span> RM </span></td>
            </tr>
          </table></td>
          <td width="90"><table onClick="Anular('')"  style="cursor:pointer; display:none" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="95%" border="0" cellpadding="0" cellspacing="0"  id="btn7" >
            <tr>
              <td align="center"><img  src="../imagenes/cerrar.jpg" width="22" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100"><span style="color:#FF3300;">[F5]</span> Desanular</span></td>
            </tr>
          </table>		  
            <table onClick="Anular('A')"  style="cursor:pointer;" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="80%" border="0" cellpadding="0" cellspacing="0"  id="btn2" disabled="disabled" >
              <tr>
                <td align="center"><img  src="../imagenes/cerrar.jpg" width="22" height="22"></td>
              </tr>
              <tr>
                <td height="24" align="center"><span class="Estilo100"><span style="color:#FF3300">[F5]</span> Anular</span></td>
              </tr>
            </table></td>
          <td width="99">
		  <table onClick="FuncionOT(this,'OBS')"  style="cursor:pointer;" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="91%" border="0" cellpadding="0" cellspacing="0"  id="btn3" disabled="disabled" >
            <tr>
              <td align="center"><img  src="../imgenes/AdminFeatures.gif" width="20" height="20"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100"><span style="color:#FF3300">[F6]</span> Observa</span></td>
            </tr>
          </table></td>
          <td width="113">
		  <table onClick="FuncionOT(this,'TER','<?=$_SESSION['nivel_usu'];?>')"  style="cursor:pointer; visibility:hidden" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="91%" border="0" cellpadding="0" cellspacing="0" disabled id="btn1">
            <tr>
              <td align="center"><img  src="../imgenes/email_edit.gif" width="20" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" ><span style="color:#FF3300">[F12]</span> Aprobar </span></td>
            </tr>
          </table>		  
		  </td>
          <td width="90"><table onClick="FuncionOT(this,'ADJ')"  style="cursor:pointer;visibility:hidden" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="73%" border="0" cellpadding="0" cellspacing="0"  id="btn4" disabled="disabled" >
            <tr>
              <td align="center"><img src="../imgenes/archivo.jpg" width="22" height="20"></td>
            </tr>
            <tr>
              <td height="24" align="center" ><span class="Estilo100"><span style="color:#FF3300">[F9]</span> Archivo </span></td>
            </tr>
          </table></td>
          <td width="52">&nbsp;</td>
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
document.getElementById('btn1').disabled="disabled";	
document.getElementById('btn2').disabled="disabled";
document.getElementById('btn3').disabled="disabled";
document.getElementById('btn4').disabled="disabled";
//document.getElementById('btn5').disabled="disabled";
document.getElementById('btn6').disabled="disabled";

var almacen=document.form1.almacen.value;
var cliente=document.form1.cliente.value;
var ruc=document.form1.ruc.value;
var ckbven=document.form1.ckbven.checked;
var Estado=document.form1.Estado.value;
var fec1=document.form1.fec1.value;
var fec2=document.form1.fec2.value;
var ordenar=document.form1.ordenar.value;
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


doAjax('lista_segimientoTS.php','&almacen='+almacen+'&cliente='+cliente+'&pagina='+pagina+'&ruc='+ruc+'&vendedor='+vendedor+'&docref='+docref+'&mosdocFac='+mosdocFac+'&ordenar='+ordenar+'&mosdocAnu='+mosdocAnu+'&Estado='+Estado+'&fec1='+fec1+'&fec2='+fec2,'mostrar_filtro','get','0','1','','');

//setInterval("cargardatos('')", 20000);
}

function cargar_ventana(tip){

document.getElementById('btn1').disabled="disabled";	
document.getElementById('btn2').disabled="disabled";
document.getElementById('btn3').disabled="disabled";
document.getElementById('btn4').disabled="disabled";
//document.getElementById('btn5').disabled="disabled";
document.getElementById('btn6').disabled="disabled";

var almacen=document.form1.almacen.value;
var cliente=document.form1.cliente.value;
var ruc=document.form1.ruc.value;
var ckbven=document.form1.ckbven.checked;
var Estado=document.form1.Estado.value;
var fec1=document.form1.fec1.value;
var fec2=document.form1.fec2.value;
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


window.open('lista_segimientoTS_mostrar.php?&almacen='+almacen+'&cliente='+cliente+'&ruc='+ruc+'&vendedor='+vendedor+'&docref='+docref+'&mosdocFac='+mosdocFac+'&mosdocAnu='+mosdocAnu+'&Estado='+Estado+'&fec1='+fec1+'&fec2='+fec2+'&tip='+tip);

//setInterval("cargardatos('')", 20000);
}


function cambiarEstado(obj){
document.form1.Estado.value=obj.value;
cargardatos('');
}



function mostrar_filtro(texto){
document.getElementById('detalle').innerHTML=texto;
cargar();
document.form1.carga.value='N';

	
	if(document.form1.docsNoAnu.value!=""){
	var tex="";
		var tempDocsNoAnu=document.form1.docsNoAnu.value.split("/");	
			//alert(tempDocsNoAnu[0]);
			for(var i=1;i<tempDocsNoAnu.length;i++){
			tex=tex+"\n TS "+tempDocsNoAnu[i];
			}
		alert("Los siguientes documentos no fueron anulados:"+ tex);
	}
	
	if(document.form1.docsNoDesAnu.value!=""){
	var tex2="";
		var tempDocsNoDesAnu=document.form1.docsNoDesAnu.value.split("/");	
			//alert(tempDocsNoAnu[0]);
			for(var i=1;i<tempDocsNoDesAnu.length;i++){
			tex2=tex2+"\n TS "+tempDocsNoDesAnu[i];
			}
		alert("Los siguientes documentos no fueron desanulados porque sus items manejan series :"+ tex2);
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
	//alert(valor+" "+condicion);
	doAjax('anular.php','&CodDoc='+valor+'&Condicion='+condicion,'UpdateAnulado','get','0','1','','');
}
function UpdateAnulado(texto){
alert(texto);

	if(texto!=''){
	//document.form1.docsNoAnu.value=texto;
	//document.getElementById('AnularRk').innerHTML=r;
	//document.getElementById('AnularRk').style.visibility='visible';
	}
	
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
document.getElementById('btn4').disabled="disabled";
//document.getElementById('btn5').disabled="disabled";
document.getElementById('btn6').disabled="disabled";
document.getElementById('btnRM').disabled="disabled";

document.getElementById('btn7').style.display='none';
document.getElementById('btn2').style.display='block';
	if (document.form1.xcodigo.length==undefined){
		if (document.form1.xcodigo.checked  ){
							if (objeto=='S'){
						document.getElementById('btn1').disabled="";
						document.getElementById('btn2').disabled="";
						document.getElementById('btn4').disabled="";
						//document.getElementById('btn5').disabled="";
						document.getElementById('btn6').disabled="";
						document.getElementById('btnRM').disabled="";
						document.getElementById('btn3').disabled="";
						document.getElementById('btn7').style.display='none';
						document.getElementById('btn2').style.display='block';							
							}else{
							document.getElementById('btn2').style.display='none';
						    document.getElementById('btn7').style.display='block';	
							}
							
			if (objeto=='A' || objeto==''){ 
			AnularDoc(document.form1.xcodigo.value,objeto);
			//return false;
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
						//document.getElementById('btn5').disabled="";
						document.getElementById('btn6').disabled="";
						document.getElementById('btnRM').disabled="";
						document.getElementById('btn3').disabled="";
						document.getElementById('btn7').style.display='none';
						document.getElementById('btn2').style.display='block';							
							}else{
							document.getElementById('btn2').style.display='none';
						    document.getElementById('btn7').style.display='block';						
							}
						
							if (objeto=='A' || objeto=='' ){ 
							
							AnularDoc(document.form1.xcodigo[i].value,objeto);
							//alert(document.form1.xcodigo[i].value);	
							//return false;
							}
					}		
			}	
		}
		
if (objeto=='A'  || objeto==''){ cargardatos('');
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
for(var i=0;i<document.form1.XDato.length;i++){
	if (document.form1.XDato[i].checked){
	var valor=document.form1.XDato[i].value;
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
			window.open("funcionOT.php?CodDoc="+codigo+"&Fun="+Valor+"&ventana=ts", "ventana1" , "width=550,height=250,scrollbars=NO,top=100,left=200") 
		}	
	}else{
		for(var i=0;i<document.form1.xcodigo.length;i++){
				if (document.form1.xcodigo[i].checked ){
					//alert(document.form1.xcodigo.value)	
					codigo=document.form1.xcodigo[i].value;
					window.open("funcionOT.php?CodDoc="+codigo+"&Fun="+Valor+"&ventana=ts", "ventana1" , "width=550,height=250,scrollbars=NO,top=100,left=200") 
				}		
			}	
	}	
	
	
		
}
function FuncionOT2(Codigo,Valor){
	window.open("funcionOT.php?Fun="+Valor, "ventana1" , "width=550,height=250,scrollbars=NO,top=100,left=200") 
}
</script>