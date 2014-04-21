<?php
session_start(); 
include('../conex_inicial.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Modelo</title>
<script src="../jquery-1.2.6.js"></script>
<script src="../jquery.hotkeys.js"></script>

<script language="JavaScript">
jQuery(document).bind('keydown', 'f12',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		FuncionOT(this,'TER','<?=$_SESSION['nivel_usu'];?>');
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
	editar('actualizar');	
 return false; }); 
 jQuery(document).bind('keydown', 'f8',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		//doc_det(document.form1.XDato.value);
		doc_det(this);
		
 return false; }); 
  jQuery(document).bind('keydown', 'f4',function (evt){jQuery('#_f4').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		eliminar_doc()
		
 return false; }); 
 jQuery(document).bind('keydown', 'f3',function (evt){jQuery('#_f3').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
	editar('grabar');
		
 return false; }); 
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
</script>
<!--CarCodT();-->

<body onLoad="document.form1.valor.focus(); cargardatos('');">
<form id="form1" name="form1" method="post" action="">
  <table width="807" height="413" border="0" cellpadding="0" cellspacing="0">
    
    <tr style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="5" height="23">&nbsp;</td>
      
	   <td width="802" height="25" colspan="12" style="border:#999999">
	  <span class="Estilo100">Log&iacute;stica : Segumiento de Modelos</span>	  
      <input type="hidden" name="carga" id="carga" value="N">	  </td>	  
    </tr>
    <tr>
      <td height="26">&nbsp;</td>
      <td colspan="2"><table width="800" border="0" cellpadding="0" cellspacing="0" bordercolor="#0000FF" style="border-bottom:#DFDFEA solid 2px">
          <tr>
            <td width="79" > <script>
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
                <table title="Nuevo[F3]" width="73" height="21" border="0" cellpadding="0" cellspacing="0">
                  <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="javascript:editar('grabar')">
                    <td width="2" ></td>
                    <td width="16" align="center" ><span class="Estilo33"><img src="../imagenes/nuevo.gif" width="14" height="16"></span></td>
                    <td width="51" ><span class="Estilo33">Nuevo<span class="Estilo113">[F3]</span> </span></td>
                    <td width="4" ></td>
                  </tr>
              </table></td>
            <td width="82"><table onClick="eliminar_doc()" width="80" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer">
                <td width="2" ></td>
                <td width="17" ><span class="Estilo33"><img src="../imgenes/eliminar.png" width="16" height="16"></span></td>
                <td width="56" ><span class="Estilo33">Eliminar<span class="Estilo113">[F4]</span></span></td>
                <td width="5" ></td>
              </tr>
            </table></td>
            <td width="86"><table width="75" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer;" onClick="editar('actualizar')">
                <td width="3" ></td>
                <td width="20" ><img src="../imgenes/ico_edit.gif" alt="Editar" width="16" height="16" border="0"></td>
                <td width="48" ><span class="Estilo33">Editar<span class="Estilo113">[F6]</span></span></td>
                <td width="4" ></td>
              </tr>
            </table></td>
            <td width="97"><table  title="Exportar Excel [F]"width="86" height="22" border="0" cellpadding="0" cellspacing="0" onClick="doc_det(this)" name="excel" >
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="cargar_ventana('imp')">
                <td width="1" ></td>
                <td width="19" ><img src="../imagenes/ico-excel.gif"  width="16" height="16" border="0"></td>
                <td width="62" ><span class="Estilo112"> Exportar</span></td>
                <td width="4" ></td>
              </tr>
            </table></td>
            <td width="91">&nbsp;</td>
            <td width="239"><table  title="Imprimir [F7]"width="86" height="22" border="0" cellpadding="0" cellspacing="0" onClick="cargar_ventana('imp')" style="visibility:hidden">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" >
                <td width="1" ></td>
                <td width="19" ><img src="../imgenes/fileprint.gif"  width="16" height="16" border="0"></td>
                <td width="62" ><span class="Estilo112"> Imprimir<span class="Estilo113">[F7]</span></span></td>
                <td width="4" ></td>
              </tr>
            </table></td>
            <td width="110"><input name="ordenar" type="hidden" size="5" value="">
                <input name="orden" type="hidden" size="5" value="asc"></td>
          </tr>
        </table>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td>&nbsp;</td>
            <td  align="left">&nbsp;</td>
            <td align="left">&nbsp;</td>
            <td align="right">&nbsp;</td>
            <td align="right">&nbsp;</td>
            <td align="left">&nbsp;</td>
            <td align="left">&nbsp;</td>
            <td width="189" rowspan="3" align="left" ><table onClick="cargardatos('')"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="86" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="center"><img  src="../imagenes/ico_lupa.png" width="22" height="22"></td>
              </tr>
              <tr>
                <td height="24" align="center"><span class="Estilo9 Estilo13">Procesar</span></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td width="58"><div align="right">Buscar : </div></td>
            <td width="100"  align="left"><strong>
              <select name="criterio" style="width:100px;">
                <option value="nom_prodmodelo" selected>  Modelo  </option>
                <option value="alias" >  Alias  </option>
              </select>
            </strong></td>
            <td width="153" align="left"><input autocomplete="off" name="valor" type="text"  style="height:20; border-color:#CCCCCC" size="25" maxlength="100" onKeyUp="cargardatos('')"></td>
            <td width="18" align="right"><img src="../imagenes/lupa5.gif" width="18" height="20"></td>
            <td width="30" align="right">&nbsp;</td>
            <td width="116" align="left"><div align="right">
              <input name="ckbven" type="checkbox" id="ckbven" style="border: 0px; background-color:#F9F9F9; " onClick="activar('ven')"   <?
			  if ($Univel==1 ){ //|| $Univel==6
			  	echo 'checked   disabled';
			  }else{
			   echo '';
			  }
			  ?> value="checkbox" >
            Vendedor : </div></td>
            <td width="141" align="left"><span class="Estilo114">
              <select name="vendedor" id="vendedor" style="width:120px"  disabled>
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
            </span></td>
          </tr>
          <tr>
            <td><div align="right">Fecha : </div></td>
            <td colspan="2"  align="left"><input name="fec1" type="text" size="10" maxlength="50" value="<?php echo 
			 //date('d-m-Y');
			  date("d-m-Y", strtotime(date('d-m-Y')." -30 day")); ?>"  >
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
            <td align="right">&nbsp;</td>
            <td align="right">&nbsp;</td>
            <td align="left"><div align="right">Estado : </div></td>
            <td align="left"><select name="select" onChange="cambiarEstado(this)">
              <option value="P" selected>Pendiente</option>
              <!--<option value="O">Ofertados</option>-->
			  <option value="A">Anulado</option>
              <option value="O">Observados</option>              
              <option value="T">Todos</option>
            </select></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td  align="left"><input name="Estado" type="hidden" id="Estado" value="" ><input name="tpcampo" type="hidden" id="tpcampo"  ><input name="tporden" type="hidden" id="tporden" ></td>
            <td align="left">&nbsp;</td>
            <td align="right">&nbsp;</td>
            <td align="right">&nbsp;</td>
            <td align="left">&nbsp;</td>
            <td align="left">&nbsp;</td>
            <td align="left">&nbsp;</td>
          </tr>
        </table>
	  </td>
    </tr>
    <tr>
      <td rowspan="2">&nbsp;</td>
	  
      <td height="21"  valign="top"><table width="800" border="0" cellpadding="0" cellspacing="1">
        <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
          <td   style=" border:#CCCCCC solid 1px" width="34" height="21" align="center" ><span class="texto2"><strong>Num.</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="23" align="center"><span class="texto1">
            <input style="border: 0px; background:none; " type="checkbox" name="Cod" onClick="marcar()"   />
          </span></td>
          <td  style=" border:#CCCCCC solid 1px" width="151" align="center"><span class="texto2"><strong>Alias</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="182" align="center"><span class="texto2"><strong>Modelo </strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="81" ><span class="texto2"><strong>Factor</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="71" ><strong class="texto2">Fec. Alta </strong></td>
          <td  style=" border:#CCCCCC solid 1px" width="74"><span class="texto2"><strong>Fec. Baja </strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="52" ><span class="texto2"><strong>Item</strong></span></td>
          <td width="81"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Pre.Costo</strong></span></td>
          <td width="41"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Adj</strong></span></td>
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
          <td width="121" height="50"><table width="92%" height="27" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="91%"><fieldset>
                <legend>Leyenda</legend>
                <table width="109%" height="46" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="16" align="center"><table  width="25" border="0" cellpadding="0" cellspacing="0" style="border:#cccccc solid 1px">
                        <tr>
                          <td  height="8" bgcolor="#FFFFFF"></td>
                        </tr>
                    </table></td>
                    <td><span class="Estilo122">Sin Aprobar</span></td>
                  </tr>
                  <tr>
                    <td height="15" align="center"><table style="border:#999999 solid 1px"  width="25" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td  height="8" bgcolor="#0066FF"></td>
                        </tr>
                    </table></td>
                    <td><span class="Estilo122">Aprobados</span></td>
                  </tr>
                  <tr>
                    <td width="32%" height="15" align="center"><table style="border:#999999 solid 1px"  width="25" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td  height="8" bgcolor="#FF0000"></td>
                        </tr>
                    </table></td>
                    <td width="68%"><span class="Estilo122">Anulado</span></td>
                  </tr>
                </table>
              </fieldset></td>
              <td width="9%">&nbsp;</td>
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
          <td width="85"><table onClick="Anular('')"  style="cursor:pointer; display:none" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="95%" border="0" cellpadding="0" cellspacing="0"  id="btn7" >
            <tr>
              <td align="center"><img  src="../imagenes/cerrar.jpg" width="22" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100"><span style="color:#FF3300;">[F5]</span> Desanular</span></td>
            </tr>
          </table>		  
            <table onClick="Anular('A')"  style="cursor:pointer;" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="80" border="0" cellpadding="0" cellspacing="0"  id="btn2" disabled="disabled" >
              <tr>
                <td align="center"><img  src="../imagenes/cerrar.jpg" width="22" height="22"></td>
              </tr>
              <tr>
                <td height="24" align="center"><span class="Estilo100"><span style="color:#FF3300">[F5]</span> Anular</span></td>
              </tr>
            </table></td>
          <td width="99">
		  <table onClick="FuncionOT(this,'OBS')"  style="cursor:pointer;" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="80" border="0" cellpadding="0" cellspacing="0"  id="btn3" disabled="disabled" >
            <tr>
              <td align="center"><img  src="../imgenes/AdminFeatures.gif" width="20" height="20"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100"><span style="color:#FF3300">[F6]</span> Observa</span></td>
            </tr>
          </table></td>
          <td width="113"><table onClick="FuncionOT(this,'ADJ')"  style="cursor:pointer;" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="80" border="0" cellpadding="0" cellspacing="0"  id="btn4" disabled="disabled" >
            <tr>
              <td align="center"><img src="../imgenes/archivo.jpg" width="22" height="20"></td>
            </tr>
            <tr>
              <td height="24" align="center" ><span class="Estilo100"><span style="color:#FF3300">[F8]</span> Adjuntar </span></td>
            </tr>
          </table></td>
          <td width="90"><table onClick="FuncionOT(this,'TER','<?=$_SESSION['nivel_usu'];?>')"  style="cursor:pointer;" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="80" border="0" cellpadding="0" cellspacing="0" disabled id="btn1">
              <tr>
                <td align="center"><img  src="../imgenes/email_edit.gif" width="20" height="22"></td>
              </tr>
              <tr>
                <td height="24" align="center"><span class="Estilo100" ><span style="color:#FF3300">[F12]</span> Aprobar </span></td>
              </tr>
            </table></td>
          <td width="52">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
  </table>
  <div id="AnularRk" style="position:absolute; visibility:hidden; left: 266px; top: 190px; width: 240px; height: 38px;"></div>
  <div id="gendoc_ventana" style="position:absolute; left:208px; top:114px; width:300px; height:180px; z-index:1; visibility:hidden">  </div> 
</form>

  

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

var almacen="";//document.form1.almacen.value;
var cliente="";//document.form1.cliente.value;
var ruc="";//document.form1.ruc.value;
var ckbven=document.form1.ckbven.checked;
var Estado=document.form1.Estado.value;
var fec1=document.form1.fec1.value;
var fec2=document.form1.fec2.value;
var vendedor='';
	if (ckbven){
		var vendedor=document.form1.vendedor.value;
	}
var docref="";//document.form1.docref.value;
var mosdocFac='';
var mosdocAnu='';
if (document.form1.ckbDoc[0].checked){ var mosdocFac=''; var mosdocAnu=''; }
if (document.form1.ckbDoc[1].checked){ var mosdocFac='B'; }
if (document.form1.ckbDoc[2].checked){ var mosdocAnu='A'; }
//alert(mosdocFac+'//'+mosdocAnu);
//var pagina=document.form1.pag.value;
var criterio=document.form1.criterio.value;
var valor=document.form1.valor.value;


doAjax('lista_genDocModelo.php','&almacen='+almacen+'&cliente='+cliente+'&pagina='+pagina+'&ruc='+ruc+'&vendedor='+vendedor+'&docref='+docref+'&mosdocFac='+mosdocFac+'&mosdocAnu='+mosdocAnu+'&Estado='+Estado+'&fec1='+fec1+'&fec2='+fec2+'&criterio='+criterio+'&valor='+valor,'mostrar_filtro','get','0','1','','');

//setInterval("cargardatos('')", 20000);
}

function cargar_ventana(tip){

document.getElementById('btn1').disabled="disabled";	
document.getElementById('btn2').disabled="disabled";
document.getElementById('btn3').disabled="disabled";
document.getElementById('btn4').disabled="disabled";
//document.getElementById('btn5').disabled="disabled";
document.getElementById('btn6').disabled="disabled";

//var almacen=document.form1.almacen.value;
//var cliente=document.form1.cliente.value;
//var ruc=document.form1.ruc.value;
var ckbven=document.form1.ckbven.checked;
var Estado=document.form1.Estado.value;
var fec1=document.form1.fec1.value;
var fec2=document.form1.fec2.value;
var vendedor='';
	if (ckbven){
		var vendedor=document.form1.vendedor.value;
	}
//var docref=document.form1.docref.value;
var mosdocFac='';
var mosdocAnu='';
if (document.form1.ckbDoc[0].checked){ var mosdocFac=''; var mosdocAnu=''; }
if (document.form1.ckbDoc[1].checked){ var mosdocFac='B'; }
if (document.form1.ckbDoc[2].checked){ var mosdocAnu='A'; }
//alert(mosdocFac+'//'+mosdocAnu);
//var pagina=document.form1.pag.value;

//window.open('lista_segimientoTransf_mostrar.php?&vendedor='+vendedor+'&mosdocFac='+mosdocFac+'&mosdocAnu='+mosdocAnu+'&Estado='+Estado+'&fec1='+fec1+'&fec2='+fec2+'&tip='+tip);

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
//alert(valor+'//'+condicion);
doAjax('peticion_datos.php','&peticion=anular_doc&codigo='+valor+'&condicion='+condicion,'','get','0','1','','');

cargardatos('');
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
format='';
if (valor.name=='excel'){
	format='&formato=excel';
}
if(document.form1.XDato.length >0){
	for(var i=0;i<document.form1.XDato.length;i++){
		if (document.form1.XDato[i].checked){
		var valor=document.form1.XDato[i].value;
		}
	}
}else{	
	var valor=document.form1.XDato.value;
}
//open  showModalDialog
window.open("doc_det.php?referencia="+valor+''+format,valor,"toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=320,left=300 top=250");

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
			codigo=document.form1.xcodigo.value;
			if (Valor=='TER' ){
				Doc_valor(codigo,Valor,'C');
			}else{
			window.open("funcion.php?CodDoc="+codigo+"&Fun="+Valor+"&ventana=ts", "ventana1" , "width=500,height=200,scrollbars=NO,top=150,left=200") 
			}
		}	
	}else{
		for(var i=0;i<document.form1.xcodigo.length;i++){
				if (document.form1.xcodigo[i].checked ){
					codigo=document.form1.xcodigo[i].value;
					if (Valor=='TER' ){
						Doc_valor(codigo,Valor,'C');
					}else{
					window.open("funcion.php?CodDoc="+codigo+"&Fun="+Valor+"&ventana=ts", "ventana1" , "width=500,height=200,scrollbars=NO,top=150,left=200") 
					}
				}		
			}	
	}	

}
function Doc_valor(codigo,Valor,accion){
text='';
ventana='';
/*if(Valor!='TER'){
	ventana='newventana';	
}
if (accion=='G'){
	if (Valor=='OBS'){
		text=document.form1.txtObsr.value;
	}
	if (Valor=='ADJ'){
	text=document.form1.archivo.value;	
	}
	salir();
	ventana='';
}*/
	
	document.form1.carga.value='S';
	doAjax('peticion_datos.php','&peticion='+Valor+'&codigo='+codigo+'&accion='+accion+'&text='+text,ventana,'get','0','1','','');
	cargardatos('');
}
function newventana(texto){
	document.getElementById('gendoc_ventana').innerHTML=texto;
	document.getElementById('gendoc_ventana').style.visibility='visible';
}
function salir(){
	document.getElementById('gendoc_ventana').style.visibility='hidden';
	setTimeout("cargardatos('')",1000); 
}


function editar(accion){
	if(document.form1.XDato.length >0){
		for(var i=0;i<document.form1.XDato.length;i++){
			if (document.form1.XDato[i].checked){
			var valor=document.form1.XDato[i].value;
			}
		}
	}else{	
		var valor=document.form1.XDato.value;
	}
location.href='../compras/gen_docModelo.php?cod='+ valor +'&accion=editar';
	
}
function eliminar_doc(codigo){
	if (document.form1.XDato.length==undefined){
		var valor=document.form1.XDato.value;
	}else{
		for(var i=0;i<document.form1.XDato.length;i++){
				if (document.form1.XDato[i].checked){
					var valor=document.form1.XDato[i].value;
				}
		}
	}
	var respuesta=confirm("confirma que desea eliminar este dato?")
	if(respuesta){
		document.form1.carga.value="S";
		doAjax('peticion_datos.php','peticion=eliminar_doc&codigo='+valor,'','get','0','1','','');
		cargardatos('');
		//alert("eliminando Codigo numero: "+valor);
	}else{
		//alert("no se pudo eliminar..");
	}
}
</script>