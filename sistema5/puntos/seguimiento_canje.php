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
<script src="../jquery-1.2.6.js"></script>
<script src="../jquery.hotkeys.js"></script>

<script language="JavaScript">
jQuery(document).bind('keydown', 'f3',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;

 return false; }); 
 jQuery(document).bind('keydown', 'f10',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;		
		
 return false; }); 
jQuery(document).bind('keydown', 'f5',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		Anular('A');
 return false; }); 
 jQuery(document).bind('keydown', 'f8',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		//doc_det(this);
 return false; }); 
  jQuery(document).bind('keydown', 'f7',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		//doc_det(document.form1.XDato.value);
//mostrar_vent();
		
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
		$.post('lista_segcanje.php?almacen='+almacen+'&cliente='+cliente+'&ruc='+ruc+'&vendedor='+vendedor+'&docref='+docref+'&fec1='+fec1+'&fec2='+fec2+'&mosdocFac='+mosdocFac+'&mosdocAnu='+mosdocAnu+'&pagina='+pagina, { variable: variable_post }, function(data){	
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
}

</script>


<body onLoad="document.form1.almcod.focus(); cargardatos('');">

<form id="form1" name="form1" method="post" action="">
  <table width="810" height="413" border="0" cellpadding="0" cellspacing="0">
    
    <tr style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="5" height="23">&nbsp;</td>
      
	   <td width="760" height="25" colspan="11" style="border:#999999">
	  <span class="Estilo100">PUNTOS : Seguimiento de Canjes</span>	  
      <input type="hidden" name="carga" id="carga" value="N">
	  <input name="orden" type="hidden" size="5" value="asc">
	  <input name="ordenar" type="hidden" size="5" value=""> 	  
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
		  <td width="105" >
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
		  <table  title="Imprimir [F7]"width="87%" height="20" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="mostrar_vent()">
              <td width="1" ></td>
              <td width="23" ><img src="../imgenes/fileprint.gif"  width="16" height="16" border="0"></td>
              <td width="62" ><span class="Estilo112"> Imprimir<span class="Estilo113">[F7]</span></span></td>
              <td width="3" ></td>
            </tr>
          </table></td>
		  <td width="77" >&nbsp;</td>
		  <td width="79"><table  title="Salir [Esc]"width="72" height="21" border="0" cellpadding="0" cellspacing="0" style="visibility:hidden">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="doc_det(this)">
              <td width="3" ></td>
              <td width="20" ><img src="../imagenes/ico_lupa.png"  width="16" height="16" border="0"></td>
              <td width="46" ><span class="Estilo112">Doc.<span class="Estilo113">[F8]</span></span></td>
              <td width="3" ></td>
            </tr>
          </table></td>
          <td width="79">&nbsp;</td>
          <td width="88">&nbsp;</td>
          <td width="77">&nbsp;</td>
          <td width="78">&nbsp;</td>
          <td width="214">&nbsp;</td>
        </tr>
      </table>
		
	    <table width="795" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="85" height="26"><div align="right"><span class="Estilo114">Cliente : </span></div></td>
            <td colspan="3"><span class="Estilo114">
             <input name="almcod" type="text" id="almcod"  style="height:20; border-color:#CCCCCC" size="25">
              </span>
              <select  name="almacen" id="almacen" style="width:50;visibility:hidden" onChange="CarCodT()">
                <option value="0">Todos</option>
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
            <td width="110" class="Estilo114"><div align="right">
              <input name="ckbven" type="checkbox" id="ckbven" style="border: 0px; background-color:#F9F9F9; " onClick="activar('ven')"   <?
			  if ($Univel==1 || $Univel==6){
			  	echo 'checked   disabled';
			  }else{
			   echo '';
			  }
			  ?> value="checkbox" >
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
            <td ><div align="right">Producto : </div></td>
            <td width="152"><input name="cliente" type="text" id="cliente"  style="height:20; border-color:#CCCCCC"  size="25" maxlength="100" autocomplete="off" ></td>
            <td width="32" class="Estilo114"><div align="right" style="visibility:hidden">Ruc : </div></td>
            <td width="95" class="Estilo114"><input name="ruc" type="text" id="ruc"  style="height:20; border-color:#CCCCCC; visibility:hidden" size="11" maxlength="11" autocomplete="off"></td>
            <td class="Estilo114"><div align="right" style="visibility:hidden">Docs. de Ref.: </div></td>
            <td><span class="Estilo15">
              <select name="docref" id="docref" style="width:200; visibility:hidden" disabled  >
                <?php 
	$resultados11 = mysql_query("select * from operacion where tipo ='2' and codigo='PV' order by descripcion ",$cn); 
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
            <td colspan="3">
			<?
			//echo $Univel;
			if ($Univel==1 || $Univel==6){
			 $ActUsr ='style="height:18; visibility:hidden"';
			 $DisUsr='disabled';
			}else{
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
              Hasta <input name="fec2" type="text" size="10" maxlength="50"  value="<?php echo date('d-m-Y')?>" <?=$DisUsr;?> >
              <button type="reset" id="f_trigger_b1" <?=$ActUsr;?>  >...</button>
              <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fec2",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b1",   
        singleClick    :    true,           
        step           :    1                
    });
              </script></td>
            <td colspan="2" class="Estilo114">
			<div align="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="Estilo116">Estado</span>
              <select name="Estado" id="Estado" onChange="cambiarEstado(this)">
			    <option value="P" selected>Canjeados</option>
				<option value="A">Anulado</option>                
                <option value="T">Todos</option>
              </select>
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="Estilo116" style="visibility:hidden">Moneda</span>
			  <select style="width:90;visibility:hidden" name="cmbmoneda" onChange="cargardatos('')">
				  <option value="" selected >Moneda</option>
				  <option value="01" >Soles(S/.)</option>
                  <option value="02">Dolares(US$.)</option>                
              </select>
			  </div>
			</td>
            <td class="Estilo114">&nbsp;</td>
          </tr>
          <tr style="display:none" id="row_transp">
            <td height="25">&nbsp;</td>
            <td colspan="3"></td>
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
	  
      <td valign="top">
	  
	  <table width="800" border="0" cellpadding="0" cellspacing="1">
        <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
          <td   style=" border:#CCCCCC solid 1px" width="36" height="21" align="center" ><span class="texto2"><strong>OK</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px; display:none" width="30" align="center" ><span class="texto1">
            <input style="border: 0px; background:none; " type="checkbox" name="Cod" onClick="marcar()"   />
          </span></td>
          <td width="93" align="center" onMouseOver="entradaOrderY(this)" onMouseOut="entradaOrderY(this)" onClick="ordenamiento('fec_punt')" style=" border:#CCCCCC solid 1px;cursor:pointer; text-decoration:underline"><span class="texto2"><strong>Fec. de Emi </strong></span></td>
        
          <td  style=" border:#CCCCCC solid 1px" width="50"><span class="texto2"><strong>Hora</strong></span></td>
		    <td  style=" border:#CCCCCC solid 1px" width="66" ><span class="texto2"><strong>Cliente</strong></span></td>
		    <td  onMouseOver="entradaOrderY(this)" onMouseOut="entradaOrderY(this)" onClick="ordenamiento('num_doc')" style=" border:#CCCCCC solid 1px;cursor:pointer; text-decoration:underline;" width="114" ><span class="texto2"><strong>N&uacute;mero Doc. </strong></span></td>
		  
            <td  onMouseOver="entradaOrderY(this)" onMouseOut="entradaOrderY(this)" onClick="ordenamiento('punt_acumulado')" style=" border:#CCCCCC solid 1px;cursor:pointer; text-decoration:underline" width="208" ><span class="texto2"><strong>Prod.Canjeado</strong></span></td>
            <td  style=" border:#CCCCCC solid 1px" width="74" ><span class="texto2"><strong>SaldoPuntos</strong></span></td>
          <td width="120"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Usuario-PC</strong></span></td>
          </tr>
        <tr>          
		  <td colspan="9" >
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
      <td><table width="764" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="235"><table width="51%" height="27" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="91%"><fieldset>
                <legend>Leyenda</legend>
                <table width="109%" height="30" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="32%" height="15" align="center"><table style="border:#999999 solid 1px"  width="25" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td  height="8" bgcolor="#FF0000"></td>
                        </tr>
                    </table></td>
                    <td width="68%"><span class="Estilo122">Anulado</span></td>
                  </tr>
                  <tr>
                    <td height="15" align="center"><table style="border:#999999 solid 1px"  width="25" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td  height="8" bgcolor="#FFFFFF"></td>
                        </tr>
                    </table></td>
                    <td><span class="Estilo122">Canjeado</span></td>
                  </tr>
                </table>
              </fieldset></td>
              <td width="9%">&nbsp;</td>
            </tr>
          </table></td>
          <td width="10">&nbsp;</td>
          <td width="98"><table onClick="Facturar(this)"  style="cursor:pointer; visibility:hidden" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="96" border="0" cellpadding="0" cellspacing="0" disabled id="btn1">
            <tr>
              <td align="center"><img  src="../imagenes/iconohoja.gif" width="16" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" ><span style="color:#FF3300">[F3]</span>Facturar </span></td>
            </tr>
          </table></td>
          <td width="87"><table onClick="Anular('')"  style="cursor:pointer; display:none" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="95%" border="0" cellpadding="0" cellspacing="0"  id="btn3" >
            <tr>
              <td align="center"><img  src="../imagenes/cerrar.jpg" width="22" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" style="font-size:9px"><span style="color:#FF3300;">[F5]</span> Desanular</span></td>
            </tr>
          </table>		  
            <table onClick="Anular('A')"  style="cursor:pointer;" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="82" border="0" cellpadding="0" cellspacing="0"  id="btn2" >
              <tr>
                <td width="82" align="center"><img  src="../imagenes/cerrar.jpg" width="22" height="22"></td>
              </tr>
              <tr>
                <td height="24" align="center"><span class="Estilo100"><span style="color:#FF3300">[F5]</span> Anular</span></td>
              </tr>
            </table></td>
          <td width="330"><table onClick="FuncionOT(this,'CON','<?=$_SESSION['nivel_usu'];?>')"  style="cursor:pointer; visibility:hidden" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="111" border="0" cellpadding="0" cellspacing="0" disabled id="btn4">
            <tr>
              <td width="126" align="center"><img  src="../imgenes/email_edit.gif" width="20" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" ><span style="color:#FF3300">[F10]</span> Tot. Venta </span></td>
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
//document.getElementById('btn2').disabled="disabled";
document.getElementById('btn4').disabled="disabled";

var almcod=document.form1.almcod.value;
var cliente=document.form1.cliente.value;
var ckbven=document.form1.ckbven.checked;
var Estado=document.form1.Estado.value;
var vendedor='';
	if (ckbven){
		var vendedor=document.form1.vendedor.value;
	}
var fec1=document.form1.fec1.value;
var fec2=document.form1.fec2.value;
var ordenar=document.form1.ordenar.value;
var orden=document.form1.orden.value;

//alert(mosdocFac+'//'+mosdocAnu);


doAjax('lista_segcanje.php','&almcod='+almcod+'&cliente='+cliente+'&pagina='+pagina+'&Estado='+Estado+'&vendedor='+vendedor+'&fec1='+fec1+'&fec2='+fec2+'&Estado='+Estado+'&ordenar='+ordenar+'&orden='+orden,'mostrar_filtro','get','0','1','','');

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
	//document.form1.carga.value='S';
//	alert(valor);
 doAjax('peticion_datos.php','&peticion=anular_canje&codigo='+valor+'&condicion='+condicion,'UpdateAnulado','get','0','1','','');
	
}
function UpdateAnulado(texto){

	if (texto=='error'){
		alert("No puede desanular un documento \n mayor al los puntos acumulados");
	}
	var r = texto;
	var valor="";
	var temp_criterio='';
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
//document.getElementById('btn2').disabled="disabled";
document.getElementById('btn4').disabled="disabled";

document.getElementById('btn3').style.display='none';
//document.getElementById('btn2').style.display='block';
//alert(document.getElementById('btn2').style.display);

try{
	if (document.form1.XDato.length==undefined){
		if (document.form1.XDato.checked  ){
							if (objeto=='S'){
						document.getElementById('btn1').disabled="";
						document.getElementById('btn2').disabled="";
						document.getElementById('btn4').disabled="";
						//document.getElementById('btn3').style.display='none';
						//document.getElementById('btn2').style.display='block';	
							}else{
						document.getElementById('btn3').disabled="";
						//document.getElementById('btn2').style.display='none';
						//document.getElementById('btn3').style.display='block';
							}
							
			if (objeto=='A' || objeto==''){ 
			AnularDoc(document.form1.XDato.value,objeto);
			//alert(document.form1.xcodigo[i].value);	
			}
		}	
	}else{
			for(var i=0;i<document.form1.XDato.length;i++){
					if (document.form1.XDato[i].checked ){
							if (objeto=='S'){
						document.getElementById('btn1').disabled="";
						document.getElementById('btn2').disabled="";
						document.getElementById('btn4').disabled="";
						//document.getElementById('btn3').style.display='none';
						//document.getElementById('btn2').style.display='block';	
							}else{
							document.getElementById('btn3').disabled="";
						//document.getElementById('btn2').style.display='none';
						//document.getElementById('btn3').style.display='block';
							}
						
							if (objeto=='A' || objeto=='' ){ 
							AnularDoc(document.form1.XDato[i].value,objeto);
							//alert(document.form1.xcodigo[i].value);	
							}
					}		
				}	
	
	}
	
}catch(e){}	
	
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
			document.getElementById('btn4').disabled="disabled";
			}	
	}
	
}
function doc_det(valor){
	return false;
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
			//Comprobante(document.form1.xcodigo.value,objeto);
			NumDc=0;
			codigoCli = document.form1.xcodigo.value.substr(0,6) ;	
			codigoRk1 = document.form1.xcodigo.value.substr(6,15) ;	
			//alert (NumDc + '//' +codigoCli + '//' + codigoRk1)
			document.form1.carga.value='S';			
			doAjax('../compras/peticion_datos.php','&peticion=save_SesionMilFac&NumDc=0&codigo='+codigoRk1+'&codigoCli='+codigoCli,'mostrar_SesionMilFac','get','0','1','','');

			alert("Procesando información... ");
		 doAjax('../compras/peticion_datos.php','&peticion=save_SesionMilFac&insert=multifac','mostrar_SesionMilFac','get','0','1','','');
		 
		}
	}else{
		var NumDc=-1;
		var codigoCli='';
		var CodigoVal='';
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
				doAjax('../compras/peticion_datos.php','&peticion=save_SesionMilFac&NumDc='+NumDc+'&codigo='+codigoRk1+'&codigoCli='+codigoCli,'mostrar_SesionMilFac','get','0','1','','');
			//temporal
			CodigoVal +=codigoRk1+',';
			}
		}		 
		alert("Procesando información... ");
		 doAjax('../compras/peticion_datos.php','&peticion=save_SesionMilFac&insert=multifac','mostrar_SesionMilFac','get','0','1','','');
	}
		
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
window.open("funcionOT.php?CodDoc="+codigo+"&Fun="+Valor+"&ventana=ts",Valor,"toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=320,left=300 top=250");
	
		
}
</script>
