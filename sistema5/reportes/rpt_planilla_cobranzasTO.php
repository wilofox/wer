<?php 
	session_start();
	include('../conex_inicial.php');	
	$_SESSION['contadortp']=0;
	$_SESSION['contadortm']=0;
	$_SESSION['tpagoact']="";
	$_SESSION['tmodact']="";
 //echo $_SESSION['codvendedor'];	
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title></title>
<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>
<script language="javascript" src="miAJAXlib2.js"></script>


<style type="text/css">
<!--
body {
	background-color:#F3F3F3;   
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
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
.Estilo14 {
	font-size: 10px;
	font-family: tahoma, verdana, sans-serif;
}
.Detalle1{
 	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #333333;
}
</style>
<link href="../styles.css" rel="stylesheet" type="text/css">
</head>

<body onLoad="cargar_detalle('');activar('emp');activar('rs');activar('tra')">
<form id="form1" name="form1" method="post" action="">
<table width="760" height="404" border="0" cellpadding="0" cellspacing="0">
    <tr style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="5" height="23">&nbsp;</td>
      
      <td width="760" height="25" colspan="11" style="border:#999999;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="606"><span class="Estilo100">Finanzas :: Cr&eacute;ditos y Cobranzas :: Planilla de Cobranzas </span>
            <input type="hidden" name="carga" id="carga" value="N" />
		<input type="hidden" name="cod_user" id="cod_user" value="<?=$_SESSION['codvendedor'];?>" />
			</td>
          <td width="193"><b>Seleccionar Tipo de Pago </b>
            <input onClick="validartecla(event,this,'docincluir')"  name="btnInc" type="button" id="btnInc" value="   ?   " /></td>
        </tr>
      </table></td>	  
    </tr>
    <tr style="background:url(imagenes/botones.gif)">
      <td height="26">&nbsp;</td>
      <td><table width="791" border="0" cellpadding="0" cellspacing="0" bordercolor="#0000FF" class="Estilo14">
        <tr style="color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:12px">
          <td>&nbsp;&nbsp;</td>
		   <td colspan="2" class="Estilo25">&nbsp;&nbsp;</td>
          <td class="Estilo25">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="6" class="Estilo25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr style="color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:12px">
          <td width="45" ><div align="right"><span class="Estilo25">Empresa:</span></div></td>
          <td width="160">
		  <select style="width:160px" name="sucursal" id="sucursal" onChange="doAjax('carga_cbo_tienda.php','&codsuc='+document.form1.sucursal.value,'cargar_cbo','get','0','1','',''); cambiar_enfoque(this);" onFocus="enfocar_cbo(this);limpiar_enfoque(this)" >
			
			 <option value="0"></option>			
              <?php 		
  $resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn); 
while($row1=mysql_fetch_array($resultados1))
{		?>              <option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
              <?php }?>
            </select>
            <input name="sucursal2" type="hidden" size="3" value="0" /></td>
          <td width="21"><input name="todosemp" type="checkbox" id="todosemp"  onclick="activar('emp')" onKeyUp="cargar_detalle('')" checked="checked" /></td>
          <td width="83" class="Estilo25"><div align="right">Raz&oacute;n Social:</div></td>
          <td width="145"><input onKeyUp="cargar_detalle('')" disabled name="cliente" type="text" id="cliente" size="22" /></td>
          <td width="36"><span class="Estilo25">
            <input name="todors" type="checkbox" id="todors"  onclick="activar('rs')" onKeyUp="cargar_detalle('')" checked="checked" />
          </span></td>
          <td width="40" class="Estilo25"><div align="right">Desde:</div></td>
          <td width="62" class="Estilo25"><input onKeyUp="cargar_detalle('')" type="text" name="fecha1" value="<?php echo '01'.substr(date('d-m-Y'),2,8)?>" size="10" id="fecha1"/></td>
          <td width="38" class="Estilo25"><button type="reset" id="f_trigger_b2" >...</button>            <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha1",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b2",   
        singleClick    :    true,           
        step           :    1                
    });
                  </script></td>
          <td width="32"><div align="right">Hasta:</div></td>
          <td width="62"><input onKeyUp="cargar_detalle('')" type="text" name="fecha2" value="<?php echo date('d-m-Y')?>" size="10" id="fecha2" /></td>
          <td width="33"><button type="reset" id="f_trigger_b3" >...</button>
            <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha2",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b3",   
        singleClick    :    true,           
        step           :    1                
    });
                  </script>&nbsp;</td>
          <td width="34">&nbsp;</td>
        </tr>
        <tr style="color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:12px">
          <td class="Estilo25" ><div align="right">Tienda:</div> <input name="almacen2" type="hidden" size="3"  value="0"/>  </td>
          <td> <div id="cbo_tienda">
		     <select style="width:160px" name="almacen" onBlur=""  id="almacen">
               <option value="0"></option>
             </select>
		   </div> </td>
          <td><input name="todostie" type="checkbox" id="todostie" 
		  onclick="activar('alm')" onKeyUp="cargar_detalle('')" /></td>
          <td><div align="right"><span class="Estilo25">Responsable:</span></div></td>
          <td>
          <select  style="width:145px" name="responsable"  onblur="" id="responsable" onKeyUp="cargar_detalle('')" >	
			 <option value="0"></option>			
              <?php 		
  $resultados1 = mysql_query("select * from usuarios order by usuario ",$cn);
while($row1=mysql_fetch_array($resultados1))
{		?>              <option value="<?php echo $row1['codigo'];?>"><?php echo $row1['usuario'];?></option>
              <?php }?>
           </select>		  </td>
          <td><input name="todosresp" type="checkbox" id="todosresp" onClick="activar('resp')" onKeyUp="cargar_detalle('')" /></td>
          <td colspan="3" align="center" class="Estilo25">
             
			 <span style="display:none">
			  <input style=" background-color:#F3F3F3" name="agrupar" type="radio" id="agrupar" onKeyUp="cargar_detalle('')" value="C" />
                    Consolidado
              <input type="hidden" name="agruparc" id="agruparc" value="C" /> 
			</span>		
					
					
					<input onClick="cargar_detalle('')" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(../imagenes/boton_aplicar.gif) ; cursor:pointer; font-size:10px; font-weight:bold" type="button" name="Submit" value="PROCESAR " >					</td>
          <td colspan="4" align="center" class="Estilo25">
		   <span style="display:none">
		  <input style="background-color:#F3F3F3" name="agrupar" type="radio" id="agrupar" onKeyUp="cargar_detalle('')" value="D" checked="checked" />
            Detallado
              <input type="hidden" name="agrupard" id="agrupard" value="D" />
			  </span>
		   <table width="139" border="0" cellpadding="0" cellspacing="0">
             <tr>
               <td><span  style="color:#0066FF">Exportar	a	Excel: </span></td>
               <td><img style="cursor:pointer" src="../imagenes/icono-excel.gif" width="30" height="25" onClick="enviar_excel('');"/></td>
             </tr>
           </table>		   </td>
          </tr>
        <tr style="color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:12px">
          <td height="25" align="center" class="Estilo25" ><input type="checkbox" name="t_pago" id="t_pago" value="checkbox"></td>
          <td>Agrupar por tipo de pago </td>
          <td>&nbsp;</td>
          <td><div align="right"><span class="Estilo25">Expresado en:</span></div></td>
          <td><select  style="width:145px" name="cbomoneda"  onblur="" id="cbomoneda" onKeyUp="cargar_detalle('')" >
            <option value="0">Origen</option>
            <?php 		
  $resultados1 = mysql_query("select * from moneda order by id ",$cn);
while($row1=mysql_fetch_array($resultados1))
{		?>
            <option value="<?php echo $row1['id'];?>"><?php echo strtoupper($row1['descripcion'])." (".strtoupper($row1['simbolo'])." )";?></option>
            <?php }?>
          </select></td>
          <td>&nbsp;</td>
          <td colspan="3" align="center" class="Estilo25">&nbsp;</td>
          <td colspan="4" align="center" class="Estilo25">&nbsp;</td>
        </tr>
        
        <tr>
          <td colspan="13" align="center"></td>
        </tr>
        <tr>
          <td height="3" colspan="13"></td>
        </tr>
      </table>
	  </td>
    </tr>
    <tr>
      <td height="211">&nbsp;</td>
      <td style="padding-top:10px">
        <table width="836" border="0" cellpadding="0" cellspacing="1">
        <tr  style="border:#999999 solid 1px;">
          <td width="23" align="center" bgcolor="#666666" class="text6"    >&nbsp;</td>
           <td width="70" bgcolor="#666666" class="text6" >C.P.</td>
           <td colspan="2" bgcolor="#666666" class="text6" >Moneda </td>
          <td height="24" colspan="9" align="center" bgcolor="#666666" class="text6">Documento</td>
          </tr>
        <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
          <td height="21" colspan="1" align="center"   style=" border:#CCCCCC solid 1px" >&nbsp;</td>
          <td  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Tip.Pago</strong></span></td>
          <td width="57" align="center"  style=" border:#CCCCCC solid 1px"><span class="texto2"><strong>Fec.Pago</strong></span></td>
          <td width="68" align="center"  style=" border:#CCCCCC solid 1px"><span class="texto2"><strong>Venc.Pago</strong></span></td>
          <td width="31"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>T.C.</strong></span></td>
          <td width="35"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Mon.</strong></span></td>
          <td width="57"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Importe</strong></span></td>
          <td width="22" align="center"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Td.</strong></span></td>
          <td width="67"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>N&deg; Doc. </strong></span></td>
          <td width="197"  style=" border:#CCCCCC solid 1px"><span class="texto2"><strong>CLIENTE</strong></span></td>
          <td width="85"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Referencia </strong></span></td>
          <td width="62"  style=" border:#CCCCCC solid 1px"><span class="texto2"><strong>Vcto.Doc.</strong></span></td>
          <td width="90"  style=" border:#CCCCCC solid 1px"><span class="texto2"><strong>Total Doc.</strong></span></td>
          </tr>
        <tr>
          <td colspan="13"><div id="detalle" style="width:876px; height:250px;" > </div></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="15">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  
  
     <div id="docincluir" style="position:absolute; left:476px; top:29px; width:302px; height:180px; z-index:2; visibility:hidden"> </div>
  
</form>
</body>
</html>
<script language="javascript">



function ver(value){
alert(value);
}
function cargartiendas(sucursal){
	
	//var sucursal=document.form1.sucursal.value;
	
	doAjax('tiendas.php','valor='+sucursal,'lista_tiendas','get','0','1','','');
	
	
	}
	
function lista_tiendas(datos){

document.getElementById('tiendas').innerHTML=datos;

}


function marcar(){
	
	if(document.form1.GrupoOpciones1[0].checked){
		for(var i=0;i<document.form1.Ingresos.length;i++){
		document.form1.Ingresos[i].checked=true;
		}	
	}else{
			for(var i=0;i<document.form1.Ingresos.length;i++){
			document.form1.Ingresos[i].checked=false;
			}		
	}
/*	if(document.form1.GrupoOpciones[0].checked){
		 for(var i=0;i<document.form1.chkTiendas.length;i++){
		 document.form1.chkTiendas[i].checked=true;
		 }
    }else{
			  for(var i=0;i<document.form1.chkTiendas.length;i++){
			  document.form1.chkTiendas[i].checked=false;
			  }
	}*/
	

}
function activar(tipo){
if(tipo=='emp'){
	if(document.form1.todosemp.checked==true){
	document.form1.sucursal.disabled=true;
	document.form1.sucursal.value='';
	document.form1.almacen.value='';
	document.form1.almacen.disabled=true;
	document.form1.todostie.disabled=true;
	document.form1.todostie.checked=true;
	}else{
	document.form1.sucursal.disabled=false;
	document.form1.almacen.disabled=false;
	document.form1.todostie.disabled=false;
	document.form1.todostie.checked=false;
	}
}
if(tipo=='alm'){
	    if(document.form1.todostie.checked==true){
		document.form1.almacen.disabled=true;
		document.form1.almacen.value='';
		}else{
		document.form1.almacen.disabled=false;
		}
}	
if(tipo=='tra'){
	    if(document.form1.todosresp.checked==true){
		document.form1.responsable.disabled=true;
		document.form1.responsable.value='';
		}else{
		document.form1.responsable.disabled=false;
		}
}	
if(tipo=='rs'){
		if(document.form1.todors.checked==true){
		document.form1.cliente.disabled=true;
		document.form1.cliente.value='';
		}else{
		document.form1.cliente.disabled=false;
		}
}
	
}

function cargar_cbo(texto){
var r = texto;
document.getElementById('cbo_tienda').innerHTML=r;
document.form1.almacen.focus();
}
function enfocar_cbo(x){
}

function limpiar_enfoque(x){
}
function cambiar_enfoque(x){
 //alert(x);
 //cargar_detalle('');
}
function cargar_detalle(pagina){
//alert("prueba");
	var sucursal=document.form1.sucursal.value;
	var almacen=document.form1.almacen.value;
	var fecha1=document.form1.fecha1.value;
	var fecha2=document.form1.fecha2.value;
	var agruparc=document.form1.agruparc.value;
	var agrupard=document.form1.agrupard.value;
	var cliente=document.form1.cliente.value;
	var responsable=document.form1.responsable.value;
	var cod_user=document.form1.cod_user.value;
	var cbomoneda=document.form1.cbomoneda.value;
	
	if(pagina=='' || pagina=='1'){
		pagina=pagina+"&proces";
	}

    var agrupar = document.getElementsByName ("agrupar");
	for (var i=0; i < agrupar.length; i++) {
		if (agrupar[i].checked) {
			//alert (i);
			var agruparc=i;
		}
	}
	
	if (document.form1.todors.checked==false){
		if (cliente==''){
		alert('Debe de Seleccionar un Cliente para Proceder.');
		return false;}
	}
	
	/*if (document.form1.todosemp.checked==true){
	sucursal='';
	}*/
	if (document.form1.todostie.checked==true){
	almacen='';
	}
	
	var t_pago='N';
	if(document.form1.t_pago.checked){
	var t_pago='S';
	}
	//alert('fecha1='+fecha1+'&fecha2='+fecha2+'&sucursal='+sucursal+'&almacen='+almacen+'&cliente='+cliente+'&responsable='+responsable+'&agruparc='+agruparc+'&agrupard='+agrupard+'&pagina='+pagina+'&cod_user='+cod_user);
doAjax('det_planilla_cobranzasTO.php','fecha1='+fecha1+'&fecha2='+fecha2+'&sucursal='+sucursal+'&almacen='+almacen+'&cliente='+cliente+'&responsable='+responsable+'&agruparc='+agruparc+'&cbomoneda='+cbomoneda+'&agrupard='+agrupard+'&pagina='+pagina+'&cod_user='+cod_user+'&t_pago='+t_pago,'view_det','get','0','1','','');
//mostrar_filtro  view_det
}

function view_det(texto){
	try{
var r = texto.split('?');
document.getElementById('detalle').innerHTML=r[0];
document.form1.carga.value='N';
document.getElementById('paginacion').innerHTML=r[1];
	}catch(e){
	
	}
}
function validartecla(e,valor,temp){
	if(document.getElementById(temp).style.visibility!='visible' ){
		//temp_busqueda2=document.form1.busqueda2.value;
		//alert(temp_busqueda2);
	document.form1.carga.value="S";
doAjax('documentos.php','&temp='+temp+'&reporte=COBRANZAS2&pagos2','listadocumentos','get','0','1','','');
	}
}

function listadocumentos(texto){
	var r = texto;
	document.getElementById('docincluir').innerHTML=r;
	document.getElementById('docincluir').style.visibility='visible';

}	

function salir(){
	//if(confirm("Esta seguro que desea salir...")){
		document.getElementById('docincluir').style.visibility='hidden';
	//}	
}

function Guarda(){
	var temp1=0;
	var docRk ='';
	
	for(var i=0;i<document.form1.Ingresos.length;i++){	
		if(document.form1.Ingresos[i].checked){
		docRk+=document.form1.Ingresos[i].value+',';
		temp1=1;
		}		
	}
			
	if(temp1==0){
	alert('Seleccione Documento');
	return false
	}

//if(confirm("Seguro de Aceptar configuracin")){
	document.form1.carga.value="S";
	//alert(docRk);
	//doAjax('documentos.php','&docRk='+docRk,'listadocumentos','get','0','1','','');
	doAjax('documentos.php','&docRk='+docRk+'&reporte=COBRANZAS2&pagos2','','get','0','1','','');
		
	document.getElementById('docincluir').style.visibility='hidden';
//}

}


function cambiar_fondo(control,evento){

if(evento=='e')
control.style.backgroundImage='url(../imagenes/boton_aplicar2.gif)';
else
control.style.backgroundImage='url(../imagenes/boton_aplicar.gif)';
}


function enviar_excel(pagina){
/*
	var fecha=document.form1.fecha.value;
	var fecha2=document.form1.fecha2.value;
	var sucursal=document.form1.sucursal.value;
	var almacen= document.form1.almacen.value;
	var vendedor=document.form1.vendedor.value;
	var turno=document.form1.turno.value;
	var serie=document.form1.serie.value;
	var cod_user=document.form1.cod_user.value;
    var agdoc = document.getElementsByName("agrp");
	for (var i=0; i < agdoc.length; i++) {
	
		if (agdoc[i].checked) {
			var ag_doc=agdoc[i].value;
		}
	}
	//var tickets=document.form1.tickets.checked;
	var tickets="";
	//alert(tickets);
	var tipo=document.form1.tipo.value;
	if(document.form1.cliente.value!=''){
	var cliente=document.form1.cliente2.value ;
	}else{
	var cliente="" ;
	}
*/
	var fecha1=document.form1.fecha1.value;
	var fecha2=document.form1.fecha2.value;
	var sucursal=document.form1.sucursal.value;
	var almacen=document.form1.almacen.value;
	
	var agruparc=document.form1.agruparc.value;
	var agrupard=document.form1.agrupard.value;
	var cliente=document.form1.cliente.value;
	var responsable=document.form1.responsable.value;
	var cod_user=document.form1.cod_user.value;
	var cbomoneda=document.form1.cbomoneda.value;

    var agrupar = document.getElementsByName ("agrupar");
	for (var i=0; i < agrupar.length; i++) {
		if (agrupar[i].checked) {
			//alert (i);
			var agruparc=i;
		}
	}
	
	var t_pago='N';
	if(document.form1.t_pago.checked){
	var t_pago='S';
	}
	
	win00=window.open('det_planilla_cobranzasTO.php?fecha1='+fecha1+'&fecha2='+fecha2+'&sucursal='+sucursal+'&almacen='+almacen+'&cliente='+cliente+'&responsable='+responsable+'&agruparc='+agruparc+'&agruparc='+agruparc+'&cbomoneda='+cbomoneda+'&pagina='+pagina+'&cod_user='+cod_user+'&excel=&t_pago='+t_pago,"","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=620, height=520,left=50 top=50");


	
}
</script>