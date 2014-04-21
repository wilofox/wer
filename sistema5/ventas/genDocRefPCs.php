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

var nivelUsu="<?php echo $Univel?>";

jQuery(document).bind('keydown', 'f3',function (evt){jQuery('#_f3').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		if (document.getElementById('btn1').disabled==false){
			FacPagos(this,'FP');
		}
 return false; }); 
/* jQuery(document).bind('keydown', 'f4',function (evt){jQuery('#_f4').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		if (document.getElementById('btn1').disabled==false){
			Anular('E');
		}
 return false; }); */
jQuery(document).bind('keydown', 'f5',function (evt){jQuery('#_f5').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		/*if (document.getElementById('btn2').disabled==true){
			if (document.getElementById('btn3').disabled==false){
				Anular('');
			}
		}else{
			*/if (document.getElementById('btn2').disabled==false){
				Anular('A');
			}
		//}
 return false; }); 
 jQuery(document).bind('keydown', 'f8',function (evt){jQuery('#_f8').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		//doc_det(document.form1.XDato.value);
		doc_det(this);		
 return false; }); 
 
  /*jQuery(document).bind('keydown', 'f10',function (evt){jQuery('#_f10').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		FacPagos(this,'NC');		
 return false; }); 
 
  jQuery(document).bind('keydown', 'f11',function (evt){jQuery('#_f11').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
	//	FacPagos(this,'CM');		
 return false; }); 
  jQuery(document).bind('keydown', 'f12',function (evt){jQuery('#_f12').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		hist_pago(this);		
 return false; }); */
 
  jQuery(document).bind('keydown', 'f7',function (evt){jQuery('#_f7').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
		//doc_det(document.form1.XDato.value);
		mostrar_vent();
return false; }); 
/* jQuery(document).bind('keydown', 'f6',function (evt){jQuery('#_f6').addClass('dirty');
	event.keyCode=0;
	event.returnValue=false;
	if (document.getElementById('btn5').disabled==false){
	FuncionOT(this,'OBS','<?=$_SESSION['nivel_usu'];?>');
	}
return false; }); */
 
 
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
		$.post('lista_segmilifactura.php?almacen='+almacen+'&cliente='+cliente+'&ruc='+ruc+'&vendedor='+vendedor+'&docref='+docref+'&fec1='+fec1+'&fec2='+fec2+'&mosdocFac='+mosdocFac+'&mosdocAnu='+mosdocAnu+'&pagina='+pagina, { variable: variable_post }, function(data){	
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
//setInterval("cargardatos('')", 5000); // Timer 1min

function cargar_cbo(texto){
//alert(texto);
var r = texto;
document.getElementById('cbo_tienda').innerHTML=r;
document.form1.almacen.focus();
}

var temp="";

function entrada(objeto){
	if(objeto.childNodes[0].nextSibling.innerHTML==""){
		document.getElementById('btn1').disabled="disabled";
		document.getElementById('btn4').disabled="disabled";
	}

try {
	
	objeto.cells[0].childNodes[0].checked=true;	
	
	if(objeto.style.background=='url(../imagenes/sky_blue_sel.png)'){
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
 } catch(e) { }
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
//var valor=document.form1.valor.value;
//var criterio=document.form1.criterio.value;
var ordenar=Campo;
var orden=document.form1.orden.value;
//var clasificacion=document.form1.clasificacion.value;
//var categoria=document.form1.combocategoria.value;
//var subcategoria=document.form1.combosubcategoria.value;
document.form1.ordenar.value=Campo;
var pagina='';

//doAjax('detprod.php','valor='+valor+'&criterio='+criterio+'&pagina='+pagina+'&clasificacion='+clasificacion+'&categoria='+categoria+'&subcategoria='+subcategoria+'&ordenar='+ordenar+'&orden='+orden,'detalle_prod','get','0','1','','');
cargardatos('');

	if(orden=='asc'){
		document.form1.orden.value="desc";
	}else{
		document.form1.orden.value="asc";
	}	
}
</script>


<body onLoad="cargardatos('');CarCodT();">
<form id="form1" name="form1" method="post" action="">
  <table width="810" height="421" border="0" cellpadding="0" cellspacing="0">
    
    <tr style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="5" height="23">&nbsp;</td>
      
	   <td width="760" height="25" colspan="11" style="border:#999999">
	  <span class="Estilo100">Ventas :: Punto de Venta :: Seguimiento de PCs.</span>	  
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
		  <td width="87" >
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
		  <table  title="Ver Documento Origen  [F8]" width="72" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="doc_det(this)">
                <td width="3" ></td>
                <td width="20" ><img src="../imagenes/ico_lupa.png"  width="16" height="16" border="0"></td>
                <td width="46" ><span class="Estilo112">Doc.<span class="Estilo113">[F8]</span></span></td>
                <td width="3" ></td>
              </tr>
          </table>
		  </td>
          <td width="93" ><table  title="Imprimir [F7]"width="87%" height="20" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="mostrar_vent()">
              <td width="1" ></td>
              <td width="23" ><img src="../imgenes/fileprint.gif"  width="16" height="16" border="0"></td>
              <td width="62" ><span class="Estilo112"> Imprimir<span class="Estilo113">[F7]</span></span></td>
              <td width="3" ></td>
            </tr>
          </table></td>
          <td width="109"><table  title="Historial de Pagos [F12]"width="89%" height="20" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="hist_pago(this)">
              <td width="1" ></td>
              <td width="19" ><img src="../imgenes/email_edit.gif"  width="16" height="16" border="0"></td>
              <td width="87" ><span class="Estilo112"> HisPagos<span class="Estilo113">[F12]</span></span></td>
              <td width="4" ></td>
            </tr>
          </table></td>
          <td width="51">&nbsp;</td>
          <td width="84">&nbsp;</td>
          <td width="73">&nbsp;</td>
          <td width="74">&nbsp;</td>
          <td width="208">&nbsp;</td>
        </tr>
      </table>
	  	
		 <table width="795" border="0" cellpadding="0" cellspacing="0">
           <tr>
             <td width="59"><div align="right"><span class="Estilo114">Tiendas : </span></div></td>
             <td colspan="3"><span class="Estilo114">
              <input name="almcod" type="text" disabled id="almcod"  style="height:20; border-color:#CCCCCC" size="5">
              </span>
	
	
	       <select <?php if( $Univel<>5 && $Univel<>4 )echo "disabled"; ?>  name="almacen" id="almacen" style="width:200" onChange="CarCodT()">
                <option value="0">Todos</option>
				<?php 		
  $resultados1 = mysql_query("select * from tienda order by des_tienda ",$cn); 
  $k=0;
while($row1=mysql_fetch_array($resultados1))
{
	if ($Utienda==$row1['cod_tienda'] and $Univel<>5){
	?>
	<option  value="<?php echo $row1['cod_tienda'] ?>" selected><?php echo $row1['des_tienda']  ?></option>
	<script>  document.form1.almcod.value="<?php echo $row1['cod_tienda'] ?>"</script>
	
	<?
	}else{
	?>
	<option  value="<?php echo $row1['cod_tienda'] ?>"><?php echo $row1['des_tienda'] ?></option>
	<script>  document.form1.almcod.value="<?php echo $row1['cod_tienda'] ?>"</script>
	
	<?
	}
	 
	$k++;
		}?>
            </select></td>
             <td width="91"><input name="ckbven" type="checkbox" id="ckbven" style="border: 0px; background-color:#F9F9F9; " onClick="activar('ven')"   <?
			  if ($Univel==1 ){ //|| $Univel==6
			  	echo 'checked   disabled';
			  }else{
			   echo '';
			  }
			  ?> value="checkbox" >
Vendedor : </td>
             <td width="242"><span class="Estilo15"><span class="Estilo114">
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
             <td width="15">&nbsp;</td>
             <td width="117" rowspan="3"><table onClick="cargardatos('')"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="86%" border="0" cellpadding="0" cellspacing="0">
               <tr>
                 <td align="center"><img  src="../imagenes/ico_lupa.png" width="22" height="22"></td>
               </tr>
               <tr>
                 <td height="24" align="center"><span class="Estilo9 Estilo13">Procesar</span></td>
               </tr>
             </table></td>
           </tr>
           <tr>
             <td><div align="right">Cliente : </div></td>
             <td width="155"><input name="cliente" type="text" id="cliente"  style="height:20; border-color:#CCCCCC"  size="25" maxlength="100" autocomplete="off" ></td>
             <td width="28"><div align="right">Ruc : </div></td>
             <td width="88"><span class="Estilo114">
               <input name="ruc" type="text" id="ruc"  style="height:20; border-color:#CCCCCC" size="11" maxlength="11" autocomplete="off">
             </span></td>
             <td><div align="right">Docs. de Ref.: </div></td>
             <td><span class="Estilo15">
               <?php 
	//$resultados11 = mysql_query("select * from operacion where tipo ='2' and codigo in('B0','F0') order by descripcion ",$cn);
	$resultados11 = mysql_query("select * from operacion where tipo ='2' and codigo in('PV') order by descripcion ",$cn);
			?>
               <select name="docref" id="docref" style="width:200" onChange="habilitarBtn(this)" >
                 <?php 
	while($row11=mysql_fetch_array($resultados11)){					
		$selected="";
			//if($row11['codigo']=='NV'){ $selected=" selected " ; }
		  ?>
                 <option <?php echo $selected ?> value="<?php echo $row11['codigo']?>"><?php echo $row11['codigo'].' - '.$row11['descripcion'];?></option>
                 <?php 
			}
			  ?>
               </select>
               <input name="docref2" type="hidden" id="docref2" value="" >
             </span></td>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td><div align="right">Fecha  : </div></td>
             <td colspan="3"><?
			//echo $Univel; || $Univel==6
			if ($Univel==1){
			 $ActUsr ='style="height:18; visibility:hidden"';
			 $DisUsr='disabled';
			}else{
				$ActUsr ='style="height:18"';
				$DisUsr='';
			}
			?>
               <input name="fec1" id="fec1" type="text" size="10" maxlength="50" value="<?php echo date('d-m-Y')?>"  <?=$DisUsr;?>  >
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
Hasta
<input name="fec2" id="fec2" type="text" size="10" maxlength="50" value="<?php echo date('d-m-Y')?>" <?=$DisUsr;?> >
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
             <td colspan="2"><span class="Estilo116">Estado</span>
            <select name="Estdoc" id="Estdoc" onChange="cambiarEstado(this)" >
				<option value="P" selected>Pendiente(Con deuda)</option>
                 <option value="C">Cancelado</option>
                 <?php /*?><option value="O">Contado</option><?php */?>
                 <option value="A">Anulado</option>
                 <option value="T">Todos</option>
			</select>   
&nbsp;
<input name="serie" id="serie" type="text" size="3" maxlength="3" style="visibility:hidden">
<input name="numero" id="numero" type="text" size="7" maxlength="7" style="visibility:hidden">

</td>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td>&nbsp;</td>
             <td><input name="Estado" type="hidden" id="Estado" value="" >
&nbsp;
<input name="tpcampo" type="hidden" id="tpcampo"  >
<input name="tporden" type="hidden" id="tporden" ></td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td><span class="Estilo116" style="visibility:hidden">Moneda</span>
               <select style="width:90; visibility:hidden" name="cmbmoneda" onChange="cargardatos('')" >
                 <option value="" selected >Moneda</option>
                 <option value="01" >Soles(S/.)</option>
                 <option value="02">Dolares(US$.)</option>
               </select></td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
           </tr>
         </table>
		 
	
		
      </td>
    </tr>
    <tr>
      <td height="194">&nbsp;</td>	  
      <td valign="top">	  
	  
	  <table border="0" cellpadding="0" cellspacing="1">
        <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
          <td width="31" align="center"   style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>OK</strong></span></td>
          <td width="30" align="center"  style=" border:#CCCCCC solid 1px"><span class="texto1">
            <input style="border: 0px; background:none; " type="checkbox" name="Cod" onClick="marcar()"   />
          </span></td>
          <td  width="89" align="center" style=" border:#CCCCCC solid 1px;cursor:pointer; text-decoration:underline" onClick="ordenamiento('fecha')"  onMouseOver="entradaOrderY(this)" onMouseOut="entradaOrderY(this)"><span class="texto2"><strong>Fec. de Emi </strong></span></td>
        
          <td width="47"  style=" border:#CCCCCC solid 1px"><span class="texto2"><strong>Hora</strong></span></td>
		    <td width="88" style=" border:#CCCCCC solid 1px;cursor:pointer; text-decoration:underline;" onClick="ordenamiento('Num_doc')"  onMouseOver="entradaOrderY(this)" onMouseOut="entradaOrderY(this)" ><span class="texto2"><strong>N&uacute;mero</strong></span></td>
		  
          <td width="190" style=" border:#CCCCCC solid 1px;cursor:pointer; text-decoration:underline" onClick="ordenamiento('cliente')"  onMouseOver="entradaOrderY(this)" onMouseOut="entradaOrderY(this)" ><span class="texto2"><strong>Cliente</strong></span></td>
          <td width="40"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Mon</strong></span></td>
          <td width="92"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Importe</strong></span></td>
          <td width="79"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Acuenta</strong></span></td>
          <td width="108" style=" border:#CCCCCC solid 1px;" ><span class="texto2"><strong>Saldo</strong></span></td>
          </tr>
        <tr>          
		  <td colspan="11">
		  <div id="detalle" style="width:800px; height:190px;" ></div> </td>
          </tr>
     </table>
	 <div style="display:none">
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
      <td>
	
	  <table width="764" height="80" border="0" cellpadding="0" cellspacing="0" bordercolor="#0000FF">
        <tr>
          <td width="119">
		  
		  <table width="92%" height="27" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="91%">
			  <fieldset>
            <legend>Leyenda</legend>
            <table width="109%" height="63" border="0" cellpadding="0" cellspacing="0">
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
                      <td  height="8" bgcolor="#0066FF"></td>
                    </tr>
                </table></td>
                <td><span class="Estilo122">Cancelado</span></td>
              </tr>
              <tr>
                <td height="16" align="center"><table style="border:#999999 solid 1px"  width="25" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td  height="8" bgcolor="#DDDDDD"></td>
                    </tr>
                </table></td>
                <td><span class="Estilo122">Entregado</span></td>
              </tr>
              <tr>
                <td height="17" align="center"><table style="border:#999999 solid 1px"  width="25" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td  height="8" bgcolor="#CBFD99"></td>
                    </tr>
                </table></td>
                <td><span class="Estilo122">A Cuenta </span></td>
              </tr>
            </table>
            </fieldset>			  </td>
              <td width="9%">&nbsp;</td>
            </tr>
          </table>          </td>
          <td width="5">&nbsp;</td>
          <td width="90"><table title="Pago [F3]" onClick="FacPagos(this,'FP')"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="90" border="0" cellpadding="0" cellspacing="0" disabled id="btn1">
            <tr>
              <td align="center"><img  src="../images/view_choose.gif" width="22" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" ><span style="color:#FF3300">[F3]</span>Pago</span></td>
            </tr>
          </table></td>
          <td width="90"><table onClick="<?php //echo 'Anular('')'?>"  style="cursor:pointer; display:none" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="95%" border="0" cellpadding="0" cellspacing="0"  id="btn3" >
            <tr>
              <td align="center"><img  src="../imagenes/cerrar.jpg" width="22" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" style="font-size:9px"><span style="color:#FF3300;"><?php //echo "[F5]</span> Desanular</span>"?></td>
            </tr>
          </table>	  
            <table title="Eliminar Doc. [F4]" onClick="Anular('E')"  style="cursor:pointer; visibility:hidden" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="90" border="0" cellpadding="0" cellspacing="0"  id="btn2"  >
              <tr>
                <td width="95" align="center"><img  src="../imgenes/eliminar.png" width="22" height="22"></td>
              </tr>
              <tr>
                <td height="24" align="center"><span class="Estilo100"><span style="color:#FF3300">[F4]</span> Eliminar </span></td>
              </tr>
            </table></td>
          <td width="90">
		  
		  <table title="Anular Doc. [F5]" onClick="Anular('A')"  style="cursor:pointer; " onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="90" border="0" cellpadding="0" cellspacing="0" disabled id="btn4">
            <tr>
              <td width="126" align="center"><img  src="../imagenes/cerrar.jpg" width="22" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" ><span style="color:#FF3300">[F5]</span> Anular </span></td>
            </tr>
          </table>
		  
		  
		  </td>
          <td width="90"><table title="Observacion [F6]" onClick="FuncionOT(this,'OBS','<?=$_SESSION['nivel_usu'];?>')"  style="cursor:pointer; visibility:hidden" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="90" border="0" cellpadding="0" cellspacing="0"  id="btn5">
            <tr>
              <td width="126" align="center"><img  src="../imgenes/AdminFeatures.gif" width="22" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" ><span style="color:#FF3300">[F6]</span> Observ. </span></td>
            </tr>
          </table></td>
          <td width="90"><table title="Reimprimir [F8]" onClick="reimprimir()"  style="cursor:pointer; visibility:hidden " onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="90" border="0" cellpadding="0" cellspacing="0"  id="btn6">
            <tr>
              <td width="126" align="center"><img  src="../imgenes/fileprint.gif" width="22" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" ><span style="color:#FF3300">[F9]</span> ReImpr.</span></td>
            </tr>
          </table></td>
          <td width="90"><table title="Nota de Credito [F9]" onClick="FacPagos(this,'NC')"  style="cursor:pointer; visibility:hidden " onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="90" border="0" cellpadding="0" cellspacing="0"  id="btn7">
            <tr>
              <td width="126" align="center"><img  src="../imgenes/AdminAddresses.gif" width="22" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" ><span style="color:#FF3300">[F10]</span> N.C.</span></td>
            </tr>
          </table></td>
          <td width="100"><table title="Cambio de Mercaderia [F10]" onClick="planillaCobranza()"  style="cursor:pointer; visibility:hidden " onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="90" border="0" cellpadding="0" cellspacing="0" id="btn8">
            <tr>
              <td width="126" align="center"><img  src="../imgenes/AdminAddresses.gif" width="22" height="22"></td>
            </tr>
            <tr>
              <td height="24" align="center"><span class="Estilo100" >Liquidaci&oacute;n</span></td>
            </tr>
          </table></td>
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

var almacen=document.form1.almacen.value;
var cliente=document.form1.cliente.value;
var ruc=document.form1.ruc.value;
var ckbven=document.form1.ckbven.checked;
var Estado=document.form1.Estado.value;
var cmbmoneda=document.form1.cmbmoneda.value;
var campoOrder=document.form1.tpcampo.value;
var formaOrder=document.form1.tporden.value;

var serie=document.form1.serie.value;
var numero=document.form1.numero.value;

var vendedor='';
	if (ckbven){
		var vendedor=document.form1.vendedor.value;
	}
var docref=document.form1.docref.value;
document.form1.docref2.value=docref;
var fec1=document.form1.fec1.value;
var fec2=document.form1.fec2.value;
var ordenar=document.form1.ordenar.value;
var orden=document.form1.orden.value;
//alert(Estado);
doAjax('lista_segmiliPCs.php','&almacen='+almacen+'&cliente='+cliente+'&pagina='+pagina+'&ruc='+ruc+'&vendedor='+vendedor+'&docref='+docref+'&fec1='+fec1+'&fec2='+fec2+'&Estado='+Estado+'&cmbmoneda='+cmbmoneda+'&campoOrder='+campoOrder+'&formaOrder='+formaOrder+'&ordenar='+ordenar+'&orden='+orden+'&serie='+serie+'&numero='+numero,'mostrar_filtro','get','0','1','','');
//+'&ordenar='+ordenar+'&orden='+orden
//setInterval("cargardatos('')", 20000);

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
window.open('lista_segmilifactura_imp.php?almacen='+almacen+'&cliente='+cliente+'&ruc='+ruc+'&vendedor='+vendedor+'&docref='+docref+'&fec1='+fec1+'&fec2='+fec2+'&mosdocFac='+mosdocFac+'&mosdocAnu='+mosdocAnu+'&Estado='+Estado+'&cmbmoneda='+cmbmoneda+'&campoOrder='+campoOrder+'&formaOrder='+formaOrder);

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

function Anular(objeto){

if (objeto=='A'){
		if(confirm("Esta seguro de ANULAR el documento seleccionado")){
		}else{
		return false;
		}
 }
 if (objeto=='E'){
 	if(confirm("Esta seguro de ELIMINAR el documento seleccionado")){
	}else{
		return false;
	}
 }
 /*if (objeto==''){
		if(confirm("DESANULAR documentos seleccionados")){
		}else{
		return false;
		}
 }*/
  
//alert(objeto);
document.getElementById('btn1').disabled="disabled";	
document.getElementById('btn2').disabled="disabled";
document.getElementById('btn4').disabled="";
document.getElementById('btn5').disabled="";	
document.getElementById('btn6').disabled="";
//document.getElementById('btn7').disabled="disabled";
document.getElementById('btn8').disabled="disabled";

document.getElementById('btn3').style.display='none';
document.getElementById('btn2').style.display='block';

	if (document.form1.XDato.length==undefined){
		if (document.form1.XDato.checked ){
		//alert(objeto);
					if (objeto=='S'){
						//if (document.form1.Estdoc.value=='P'){	
						
							if(nivelUsu!=1){
							document.getElementById('btn1').disabled="";
							}
						//}
						document.getElementById('btn2').disabled="";
						document.getElementById('btn4').disabled="";
						
						document.getElementById('btn5').disabled="";	
						document.getElementById('btn6').disabled="";
						
						if (document.form1.docref2.value!='TN'  ){
						document.getElementById('btn7').disabled="";
						document.getElementById('btn8').disabled="";
						}
						/*document.getElementById('btn3').style.display='none';
						document.getElementById('btn2').style.display='block';	
							}else{
						document.getElementById('btn3').disabled="";
						document.getElementById('btn2').style.display='none';
						document.getElementById('btn3').style.display='block';*/
					}
							
			if (objeto=='A' || objeto=='' || objeto=='E'){ 
			
				if(document.form1.XDato.parentNode.parentNode.bgColor=='#ff7979' && objeto=='A'){
				alert("No es posible anular el documento");
				return false;
				}
									
			AnularDoc(document.form1.XDato.value,objeto);
			}
		}	
	}else{
			for(var i=0;i<document.form1.XDato.length;i++){
					if (document.form1.XDato[i].checked ){
							if (objeto=='S'){
					//if (document.form1.Estdoc.value=='P'){
					if(nivelUsu!=1){
						document.getElementById('btn1').disabled="";
					}	
					//}
						document.getElementById('btn2').disabled="";
						document.getElementById('btn4').disabled="";
						
						document.getElementById('btn5').disabled="";	
						//document.getElementById('btn6').disabled="";
						if (document.form1.docref2.value!='TN'  ){
						document.getElementById('btn7').disabled="";
						document.getElementById('btn8').disabled="";
						}
						
						/*document.getElementById('btn3').style.display='none';
						document.getElementById('btn2').style.display='block';	
							}else{
							document.getElementById('btn3').disabled="";
						document.getElementById('btn2').style.display='none';
						document.getElementById('btn3').style.display='block';*/
							}
						
							if (objeto=='A' || objeto=='' || objeto=='E'){ 
							
							if(document.form1.XDato[i].parentNode.parentNode.bgColor=='#ff7979' && objeto=='A'){
							alert("No es posible anular el documento");
							return false;
							}
							AnularDoc(document.form1.XDato[i].value,objeto);
							}
					}		
				}	
	
	}
	if (objeto=='A'  || objeto=='' || objeto=='E'){	
		//cargardatos(''); 
	}
}
function AnularDoc(valor,condicion){
	//document.getElementById('AnularRk').style.visibility='hidden';
	//document.getElementById('AnularRk').style.visibility='visible';
	document.form1.carga.value='S';
	//valor=valor.substr(6,15);
	if(condicion=='E'){
		//alert(valor);
		doAjax('anular.php','&Elim&CodDoc='+valor,'UpdateAnulado','get','0','1','','');
	}else{
		doAjax('anular.php','&Anul&CodDoc='+valor+'&Condicion='+condicion,'UpdateAnulado','get','0','1','','');
	}
}
function UpdateAnulado(texto){
//alert(texto);
var r = texto;
	var valor="";
	var temp_criterio='';
	if(r=='pagos'){
		alert('Este Documento no se puede eliminar (Existen Pagos)');
	}
	cargardatos(''); 
	//document.getElementById('AnularRk').innerHTML=r;
	//document.getElementById('AnularRk').style.visibility='visible';
}
function marcar(){
	if(document.form1.Cod.checked){	
		for(var i=0;i<document.form1.xcodigo.length;i++){
		    if (document.form1.xcodigo[i].disabled){			
			}else{
			document.form1.xcodigo[i].checked=true;
			}
			if(nivelUsu!=1){			
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
function hist_pago(valor){
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
window.open("../doc_det_pago.php?referencia="+valor,valor,"toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=600, height=300,left=300 top=250");
}
function Serie_Pro_fac(objeto){
	
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
window.open("../doc_det_serie.php?referencia="+valor,valor,"toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=320,left=300 top=250");

}
function FacPagos(objeto,doc){
try{

if(objeto.innerHTML.substr(0,3)=='<TD'){
var codigo=objeto.childNodes[0].nextSibling.childNodes[0].value;
//Comprobante(doc,codigoCli,codigoRk1);
codigoCli = codigo.substr(0,6) ;	
			codigoRk1 = codigo.substr(6,15) ;

			Comprobante(doc,codigoCli,codigoRk1);
			return false;
}
}catch(e){
}

if (document.form1.xcodigo.length==undefined){
		if (document.form1.xcodigo.checked  ){	
			
			if(document.form1.xcodigo.parentNode.parentNode.bgColor=='#ff7979'){
            alert("No es posible crear NC para este documento");
			return false;
			}
			
			
			codigoCli = document.form1.xcodigo.value.substr(0,6) ;	
			codigoRk1 = document.form1.xcodigo.value.substr(6,15) ;

			Comprobante(doc,codigoCli,codigoRk1);
			}
}else{
	 for(var i=0;i<document.form1.xcodigo.length;i++){
			if (document.form1.xcodigo[i].checked ){
			
			if(document.form1.xcodigo[i].parentNode.parentNode.bgColor=='#ff7979'){
            alert("No es posible crear NC para este documento");
			return false;
			}

			codigoCli = document.form1.xcodigo[i].value.substr(0,6) ;	
			codigoRk1 = document.form1.xcodigo[i].value.substr(6,15) ;	
						//alert(codigoCli+" "+codigoRk1);	
			Comprobante(doc,codigoCli,codigoRk1);
			}
	}
	
}
		cargardatos('');	
}
	
function Comprobante(doc,valor,codigo){
	if (doc=='FP'){
		//alert(codigo+" "+valor);
		window.showModalDialog("../canjePCs.php?codigo="+codigo+"&valor="+valor+"&condicionRk=RA" ,"","dialogWidth:610px;dialogHeight:540px,top=100,left=200,status=yes,scrollbars=yes");
	}else if(doc=='NC'){
		var sucursal=1; //document.formulario.sucursal.value;
		var tipomov=2; //document.formulario.tipomov.value;		
		window.showModalDialog('../add_referTN.php?sucursal='+sucursal+'&tipomov='+tipomov+"&codigo="+codigo,"","dialogWidth:520px;dialogHeight:360px,top=100,left=200,status=yes,scrollbars=yes");
//window.open('../add_referTN.php?sucursal='+sucursal+'&tipomov='+tipomov+"&codigo="+codigo,"","width=500,height=300,top=300,left=300,scroolbars=no,directories=no,location=no,menubar=no,titlebar=no,toolbar=no,status=yes");
	}else if(doc=='CM'){
		var sucursal=1; //document.formulario.sucursal.value;
		var tipomov=2; //document.formulario.tipomov.value;		
		window.showModalDialog('../add_referCM.php?sucursal='+sucursal+'&tipomov='+tipomov+"&codigo="+codigo,"","dialogWidth:550px;dialogHeight:500px,top=50,left=150,status=yes,scrollbars=yes");
	} 

}
function cargar_ref(serie,numero,cod_cli_ref,des_cli_ref,cod_cab_ref,mon_doc_ref,impto){
alert();
}
function cambiarEstado(obj){
document.form1.Estado.value=obj.value;
cargardatos('');
<?=$AnRK='3';?>
/*for(var i=0;i<document.form1.xcodigo.length;i++){
	document.form1.xcodigo[i].style.visibility = "hidden";
}*/

}
function FuncionOT(Codigo,Valor,Nivel){
if (Valor=='TER' || Valor=='OBS' ){
	if (Nivel==5 || Nivel== 4){
		 
	}else{
		alert('Usuario no Autorizado');
		return false
	}
}

	if (document.form1.XDato.length==undefined){
		var valor=document.form1.XDato.value;
	}else{
		for(var i=0;i<document.form1.XDato.length;i++){
				if (document.form1.XDato[i].checked){
					var valor=document.form1.XDato[i].value;
				}
		}
	}
var codigo=valor;

	if (Valor=='OBS' ){
	window.open("funcionOT.php?CodDoc="+codigo+"&Fun="+Valor+"&ventana=ts",Valor,"toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=250,left=300 top=250");
	}
		
}


function reimprimir(){
  if (document.form1.XDato.length==undefined){
		var valor=document.form1.XDato.value;
	}else{
		for(var i=0;i<document.form1.XDato.length;i++){
				if (document.form1.XDato[i].checked){
					var valor=document.form1.XDato[i].value;
				}
		}
	}
	
window.open("../formatos/tempImpresion.php?CodDoc="+valor,"ventReimprimir","toolbar=no,status=yes, menubar=no, scrollbars=yes,resizable=yes, width=520, height=250,left=300 top=250");
}

function habilitarBtn(objeto){

	if(objeto.value=='TN'){
	document.getElementById('btn7').disabled="disabled";
	}else{
	document.getElementById('btn7').disabled="";
	}
cargardatos('');
}

function planillaCobranza(){


	var fecha1=document.form1.fec1.value;
	var fecha2=document.form1.fec2.value;
	var sucursal=document.form1.almacen.value.substr(0,1);
	var almacen=document.form1.almacen.value;
	
	var agruparc="";
	var agrupard="";
	var cliente="";
	var responsable=document.form1.vendedor.value;
	var cod_user="";

    var agrupar = document.getElementsByName ("agrupar");
	for (var i=0; i < agrupar.length; i++) {
		if (agrupar[i].checked) {
			//alert (i);
			var agruparc=i;
		}
	}
	
	var pagina="";
	var docref=document.form1.docref.value;
	
	win00=window.open('ventPlanilla.php?fecha1='+fecha1+'&fecha2='+fecha2+'&sucursal='+sucursal+'&almacen='+almacen+'&cliente='+cliente+'&responsable='+responsable+'&agruparc='+agruparc+'&agrupard='+agrupard+'&pagina='+pagina+'&cod_user='+cod_user+'&docref='+docref,"","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=900, height=520,left=50 top=50");


}

</script>
