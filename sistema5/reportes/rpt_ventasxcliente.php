<?php 
	session_start();
	include('../conex_inicial.php');	
 //echo $_SESSION['codvendedor'];	
?>
<script language="javascript" src="miAJAXlib2.js"></script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>


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
</style>
<link href="../styles.css" rel="stylesheet" type="text/css">
</head>


<script>

var user_tienda="<?php echo $_SESSION['user_tienda'] ?>";
var user_sucursal="<?php echo $_SESSION['user_sucursal'] ?>";

function iniciar(){

	if( (user_tienda.length==3 || user_sucursal!="0") && user_tienda!=0 ){
	//alert();
		seleccionar_cbo('sucursal',user_sucursal);
		document.form1.carga.value='S';		
		doAjax('carga_cbo_tienda.php','&codsuc='+document.form1.sucursal.value,'cargar_cbo3','get','0','1','','')
		
	}
	
	
}

function seleccionar_cbo(control,valor){
		
		 var valor1=valor;
         var i;
		// alert(valor1+" "+control);
	     for (i=0;i< eval("document.form1."+control+".options.length");i++)
        {
		//alert(eval("document.formulario."+control+".options[i].value")+" "+valor1);
         if (eval("document.form1."+control+".options[i].value=='"+valor1+"'"))
            {
		//	alert("entro");
			   eval("document.form1."+control+".options[i].selected=true");
            }
        
        }
		
		
		document.form1.sucursal.disabled=true;
		document.form1.almacen.disabled=true;
}

function cargar_cbo3(r){

    document.getElementById('cbo_tienda').innerHTML=r;
	
		
	if(user_tienda.length==3){
		seleccionar_cbo('almacen',user_tienda);
		//cargar_detalle('');
	}
		
	document.form1.carga.value='N';	
}



</script>

<body onLoad="iniciar('')">
<form id="form1" name="form1" method="post" action="">
<table width="760" height="404" border="0" cellpadding="0" cellspacing="0">
    <tr style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="5" height="23">&nbsp;</td>
      
      <td width="760" height="25" colspan="11" style="border:#999999;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="626"><span class="Estilo100">Ventas :: Ventas por Cliente </span>
            <input type="hidden" name="carga" id="carga" value="N" />
		<input type="hidden" name="cod_user" id="cod_user" value="<?=$_SESSION['codvendedor'];?>" />
			</td>
          <td width="173"><b>Documentos a Incluir</b>
            <input onClick="validartecla(event,this,'docincluir')"  name="btnInc" type="button" id="btnInc" value="   ?   " /></td>
        </tr>
      </table></td>	  
    </tr>
    <tr style="background:url(imagenes/botones.gif)">
      <td height="26">&nbsp;</td>
      <td><table width="791" border="0" cellpadding="0" cellspacing="0" bordercolor="#0000FF" class="Estilo14">
        <tr style="color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:12px">
          <td  >
           </td>
		   <td colspan="2" class="Estilo25">&nbsp;&nbsp;</td>
          <td class="Estilo25">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="6" class="Estilo25">Rango de Fechas: 
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
           <input onClick="cargar_detalle('')" style="width:70px; cursor:pointer" type="button" name="Submit" value="Procesar" /></td>
          <td><img style="cursor:pointer" onClick="enviar_excel2('');" src="../imagenes/ico-excel.gif" width="20" height="20" /></td>
        </tr>
        <tr style="color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:12px">
          <td width="45" ><div align="right"><span class="Estilo25">Empresa:</span></div></td>
          <td width="160">
		  <select style="width:160"  name="sucursal" onChange="doAjax('carga_cbo_tienda.php','&codsuc='+document.form1.sucursal.value,'cargar_cbo','get','0','1','',''); cambiar_enfoque(this);" onFocus="enfocar_cbo(this);limpiar_enfoque(this)" >
			
              <?php 		
  $resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn); 
while($row1=mysql_fetch_array($resultados1))
{		?>              <option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
              <?php }?>
            </select>
            <input name="sucursal2" type="hidden" size="3" value="0" />  		    </td>
          <td width="21"></td>
          <td width="83" class="Estilo25"><div align="right">Raz&oacute;n Social:</div></td>
          <td width="145"><input onKeyUp="cargar_detalle('')" disabled name="cliente" type="text" id="cliente" size="22" /></td>
          <td width="36"><span class="Estilo25">
            <input name="todors" type="checkbox" id="todors"  onclick="activar('rs')" onKeyUp="cargar_detalle('')" checked="checked" />
          </span></td>
          <td width="40" class="Estilo25"><div align="right">Desde:</div></td>
          <td width="62" class="Estilo25"><input onKeyUp="cargar_detalle('')" type="text" name="fecha1" value="<?php echo '01'.substr(date('d-m-Y'),2,8)?>" size="10" id="fecha1"/></td>
          <td width="18" class="Estilo25"><button type="reset" id="f_trigger_b2" >...</button>            <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha1",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b2",   
        singleClick    :    true,           
        step           :    1                
    });
                  </script></td>
          <td width="52"><div align="right">Hasta:</div></td>
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
		     <select  style="width:160" name="almacen" onBlur="" >
               <option value="0"></option>
             </select>
		   </div> </td>
          <td><input name="todostie" type="checkbox" id="todostie" 
		  onclick="activar('alm')" onKeyUp="cargar_detalle('')" /></td>
          <td><div align="right"><span class="Estilo25">Transporte:</span></div></td>
          <td>
		  <select  style="width:145" name="transporte"  onblur="" id="transporte" onKeyUp="cargar_detalle('')" >	
			 <option value="0"></option>			
              <?php 		
  $resultados1 = mysql_query("select * from transportista order by nombre ",$cn); 
while($row1=mysql_fetch_array($resultados1))
{		?>              <option value="<?php echo $row1['id'] ?>"><?php echo $row1['nombre'] ?></option>
              <?php }?>
           </select>		  </td>
          <td><input name="todostrans" type="checkbox" id="todostrans" onClick="activar('tra')" onKeyUp="cargar_detalle('')" /></td>
          <td colspan="7" class="Estilo25">
              <input name="agrupar" type="radio" id="agrupar" style=" background:none; border:none" onKeyUp="cargar_detalle('')" value="C" checked="checked" />
                    por Cliente
           <input type="hidden" name="agruparc" id="agruparc" value="C" /> <input style="background-color:#F3F3F3;background:none; border:none" name="agrupar" type="radio" id="agrupar" onKeyUp="cargar_detalle('')" value="F" />
          por Fecha
            <input type="hidden" name="agruparf" id="agruparf" value="F" />
            <input style="background-color:#F3F3F3;background:none; border:none" name="agrupar" type="radio" id="radio" onKeyUp="cargar_detalle('')" value="F" />
            por Condici&oacute;n </td>
          </tr>
        
        <tr>
          <td colspan="13" align="center"></td>
        </tr>
        <tr>
          <td colspan="13"></td>
        </tr>
      </table>
	  </td>
    </tr>
    <tr>
      <td height="211">&nbsp;</td>
      <td style="padding-top:10px">
        <table width="760" border="0" cellpadding="0" cellspacing="1">
        <tr  style="border:#999999 solid 1px;">
          <td width="23" align="center" bgcolor="#666666" class="text6"    >&nbsp;</td>
          <td height="24" colspan="2" align="center" bgcolor="#666666" class="text6">Alm.</td>
          <td width="49" align="center"  bgcolor="#666666" class="text6">Doc.</td>
          <td width="69" bgcolor="#666666" class="text6" >Fec.Doc.<br /></td>
          <td width="78" bgcolor="#666666" class="text6">Referencia </td>
          <td width="94" bgcolor="#666666" class="text6">Tipo de venta</td>
          <td width="66" bgcolor="#666666" class="text6"> Auxiliar </td>
          <td colspan="3" bgcolor="#666666" class="text6" >Responsable</td>
          <td colspan="2" bgcolor="#666666" class="text6" >Inclu/No Inclu </td>
          <td width="81" bgcolor="#666666" class="text6" >Monto Total</td>
          </tr>
        <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
          <td height="21" colspan="2" align="center"   style=" border:#CCCCCC solid 1px" >&nbsp;</td>
          <td width="53" align="center"  style=" border:#CCCCCC solid 1px"><span class="texto2"><strong>Cantidad</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>C&oacute;digo</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Cod. Anexo </strong></span></td>
          <td colspan="3"  style=" border:#CCCCCC solid 1px"><span class="texto2"><strong>Descripcion</strong></span></td>
          <td width="83"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>P.Unit.</strong></span></td>
          <td width="83"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Desc1</strong></span></td>
           <td width="83"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Desc2</strong></span></td>
          <td width="67"  style=" border:#CCCCCC solid 1px" >&nbsp;</td>
          <td width="56"  style=" border:#CCCCCC solid 1px" >&nbsp;</td>
          <td  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Total</strong></span></td>
          </tr>
        <tr>
          <td colspan="16"><div id="detalle" style="width:800px; height:250px;" > </div></td>
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
/*
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
*/
	
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
	    if(document.form1.todostrans.checked==true){
		document.form1.transporte.disabled=true;
		document.form1.transporte.value='';
		}else{
		document.form1.transporte.disabled=false;
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
	var agruparf=document.form1.agruparf.value;
	var cliente=document.form1.cliente.value;
	var transporte=document.form1.transporte.value;
	var cod_user=document.form1.cod_user.value;

    var agrupar = document.getElementsByName ("agrupar");
	for (var i=0; i < agrupar.length; i++) {
		if (agrupar[i].checked) {
			//alert (i);
			var agruparc=i;
		}
	}
	//alert(agruparc);
	
	if (document.form1.todors.checked==false){
		if (cliente==''){
		alert('Debe de Seleccionar un Cliente para Proceder.');
		return false;}
	}
	/*
	if (document.form1.todosemp.checked==true){
	sucursal='';
	}
	*/
	if (document.form1.todostie.checked==true){
	almacen='';
	}
doAjax('det_ventasxcliente.php','fecha1='+fecha1+'&fecha2='+fecha2+'&sucursal='+sucursal+'&almacen='+almacen+'&cliente='+cliente+'&transporte='+transporte+'&agruparc='+agruparc+'&agruparf='+agruparf+'&pagina='+pagina+'&cod_user='+cod_user,'view_det','get','0','1','','');
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
		var tipo=2;
	if(tipo==1){
	var rep="VENTAS_X_CLIENTE";
	}else{
	var rep="VENTAS_X_CLIENTE";
	}

doAjax('documentos.php','&temp='+temp+'&tipo='+tipo+"&reporte="+rep,'listadocumentos','get','0','1','','');


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

//if(confirm("Seguro de Aceptar configuración")){
	document.form1.carga.value="S";
	
	var tipo=2;
	if(tipo==1){
	var rep="VENTAS_X_CLIENTE";
	}else{
	var rep="VENTAS_X_CLIENTE";
	}
    //if(confirm("Seguro de Aceptar configuración")){
	//alert(docRk+" "+rep);
			//document.form1.carga.value="S";
	doAjax('documentos.php','&docRk='+docRk+"&reporte="+rep,'','get','0','1','','');
	
		
	document.getElementById('docincluir').style.visibility='hidden';
//}

}


function enviar_excel2(pagina){
	
	
	
	var sucursal=document.form1.sucursal.value;
	var almacen=document.form1.almacen.value;
	var fecha1=document.form1.fecha1.value;
	var fecha2=document.form1.fecha2.value;
	var agruparc=document.form1.agruparc.value;
	var agruparf=document.form1.agruparf.value;
	var cliente=document.form1.cliente.value;
	var transporte=document.form1.transporte.value;
	var cod_user=document.form1.cod_user.value;

    var agrupar = document.getElementsByName ("agrupar");
	for (var i=0; i < agrupar.length; i++) {
		if (agrupar[i].checked) {
			//alert (i);
			var agruparc=i;
		}
	}
	//alert(agruparc);
	
	if (document.form1.todors.checked==false){
		if (cliente==''){
		alert('Debe de Seleccionar un Cliente para Proceder.');
		return false;}
	}
	/*
	if (document.form1.todosemp.checked==true){
	sucursal='';
	}
	*/
	if (document.form1.todostie.checked==true){
	almacen='';
	}
//doAjax('det_ventasxcliente.php','fecha1='+fecha1+'&fecha2='+fecha2+'&sucursal='+sucursal+'&almacen='+almacen+'&cliente='+cliente+'&transporte='+transporte+'&agruparc='+agruparc+'&agruparf='+agruparf+'&pagina='+pagina+'&cod_user='+cod_user,'view_det','get','0','1','','');
	
	win00 = window.open('det_ventasxcliente.php?fecha1='+fecha1+'&fecha2='+fecha2+'&sucursal='+sucursal+'&almacen='+almacen+'&cliente='+cliente+'&transporte='+transporte+'&agruparc='+agruparc+'&agruparf='+agruparf+'&pagina='+pagina+'&cod_user='+cod_user+'&excel=',"","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=620, height=520,left=50 top=50");
}


</script>