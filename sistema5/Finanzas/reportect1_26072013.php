<?php 
include('../conex_inicial.php');
$tipo=$_REQUEST['tipo'];

if($tipo=='1'){
$titu="Finanzas :: Cuentas Proveedores :: Documentos Pendientes Proveedores";
$agruparpor=" Agrupar por Proveedor ";
}else{
$titu="Finanzas :: Cr&eacute;ditos y Cobranzas :: Documentos Pendientes Clientes";
$agruparpor=" Agrupar por Cliente ";
}
//echo $agruparpor;
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo17 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #003366; }
.Estilo100 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color:#003366;
	font:bold;
	
}
-->
</style>
    <script src="../jquery-1.2.6.js"></script>
    <script src="../jquery.hotkeys.js"></script>
	<script>
jQuery(document).bind('keyup', 'up',function (evt){jQuery('#_up').addClass('dirty');

   if(document.getElementById('auxiliares').style.visibility=='visible'){

	for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
	//alert(document.getElementById('tblproductos1').rows[i].style.background);
		if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' && (i!=0) ){
		document.getElementById('tblproductos1').rows[i].style.background=document.getElementById('tblproductos1').rows[i].bgColor;
		document.getElementById('tblproductos1').rows[i-1].style.background='#FFF1BB';
		
			
			location.href="#ancla"+(i-1);
			
			document.form1.cliente.focus();
			
			if(i%4==0 && i!=0){
			//	capa_desplazar = $('detalle1');
		//	capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y - 60);
			}
			break;
		}
	  }
   }
         
 return false; });
 jQuery(document).bind('keyup', 'down',function (evt){jQuery('#_down').addClass('dirty');

	if(document.getElementById('auxiliares').style.visibility=='visible'){
 //alert('entro');
	for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
			
		//	alert(document.getElementById('tblproductos').rows.length);
			if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' && (i!=document.getElementById('tblproductos1').rows.length-1)){
			//alert(document.getElementById('TablaDatos').rows[i].style.background);
			document.getElementById('tblproductos1').rows[i].style.background=document.getElementById('tblproductos1').rows[i].bgColor;
			document.getElementById('tblproductos1').rows[i+1].style.background='#FFF1BB';
			
			if(i%4==0 && i!=0){
			
			location.href="#ancla"+i;
			document.form1.cliente.focus();
			//capa_desplazar = $('detalle1');
			//capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y + 60);
			}
			
			break;
				
			}
		}
 	}
	
	
 return false; });
 
 jQuery(document).bind('keyup', 'return',function (evt){jQuery('#_return').addClass('dirty'); 

	   if(document.getElementById('auxiliares').style.visibility=='visible'){

		for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
			if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb'){
			
		var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
		var temp1=document.getElementById('tblproductos1').rows[i].cells[1].childNodes[0].innerHTML;
		
		//var doc=document.formulario.doc.value;
		var ruc=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[0].childNodes[0].childNodes[0].childNodes[0].innerHTML;
		//alert(ruc);
			// if( (doc=='FA' || doc=='F1') && ruc==""  ){
			 //alert(" Cliente no tiene Ruc ");
			 //return false;
			 //}else{
			 
			 
			 
			 temp1=temp1.replace('&amp;','&');
			
			 elegir2(temp,temp1);
			 //}		  

			}
		 }
	   }
	   
	   
	
			
return false; });
function elegir2(cod,des){
//razon.replace('&','amps')
des=des.replace('amps','&');

document.form1.cliente.value=des;
document.form1.cliente2.value=cod;
document.getElementById('auxiliares').style.visibility='hidden';

}
jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_esc').addClass('dirty'); 

//document.formulario.codprod.focus();
//alert("escape");
salir();
		
return false; });
 </script>
<script language="javascript">
var temp_busqueda2="razonsocial";
function validartecla(e,valor,temp){

	
	//var tipomov=document.form1.tipomov.value;
	document.form1.tempauxprod.value=temp;
	
	if(document.getElementById('auxiliares').style.visibility=='visible'){
		temp_busqueda2=document.formauxiliar.busqueda2.value;
	
		}
		
	var lentexto=document.form1.cliente.value.length;


	if(lentexto>=1){
	
	if ( ( (e.keyCode>=96) && (e.keyCode<=105) || (e.keyCode>=48) && (e.keyCode<=57) )  || ((e.keyCode>=65) && (e.keyCode<=90)) || e.keyCode==8 || e.keyCode==32 ) {
	

		
		
		if(document.getElementById(temp).style.visibility!='visible' ){
		var tipomov=document.form1.tipo.value;
		doAjax('lista_aux_cliente.php','&temp='+temp+'&tipomov='+tipomov+'&modulo=tranf','listaprod','get','0','1','','');
		
		}else{
			var valor="";
			var temp_criterio;
			if(document.form1.tempauxprod.value=='auxiliares'){
			valor=document.form1.cliente.value;
			temp_criterio=temp_busqueda2;
		
			}
	
			var temp=document.form1.tempauxprod.value;
			//var tipomov= 2;//
			var tipomov=document.form1.tipo.value;
	
			
			
		doAjax('det_aux_cliente.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&criterio='+temp_criterio,'detalle_prod','get','0','1','','');
		
	//	doAjax('det_aux_3.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc='+document.formulario.prov_asoc.value+'&moneda_doc='+moneda_doc,'detalle_prod','get','0','1','','');
		 //alert('entro');
		}
		
		
	}
}else{
salir();
}
}
function listaprod(texto){

	var r = texto;
	var valor="";
	var temp_criterio='';
	
	if(document.form1.tempauxprod.value=='auxiliares'){
	
	document.getElementById('auxiliares').innerHTML=r;
	document.getElementById('auxiliares').style.visibility='visible';

	
	valor=document.form1.cliente.value; 
	  // alert(temp_busqueda2);
	temp_criterio=temp_busqueda2;
	selec_busq2();
	}
	
	
	var temp=document.form1.tempauxprod.value;
	//var tipomov=2;//
	var tipomov=document.form1.tipo.value;
	var tienda;//=document.forms[0].almacen.value;
	var moneda_doc;//=document.forms[0].tmoneda.value;
	//document.formulario.prov_asoc.value
	//alert(temp_criterio);
	doAjax('det_aux_cliente.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc=&moneda_doc='+moneda_doc,'detalle_prod','get','0','1','','');
				//doAjax('det_aux.php','&clasificacion=1&temp=auxiliares&tipomov='+document.formulario.tipomov.value+'&prov_asoc='+texto,'detalle_prod','get','0','1','','');
	
}	
function detalle_prod(texto){

	var r = texto;
	if(document.forms[0].tempauxprod.value=='auxiliares'){
	document.getElementById('detalle1').innerHTML=r;
	document.getElementById('tblproductos1').rows[0].style.background='#fff1bb';
	}
	if(document.forms[0].tempauxprod.value=='productos'){
	document.getElementById('detalle').innerHTML=r;
	document.getElementById('tblproductos').rows[0].style.background='#fff1bb';
	}

}
function selec_busq2(){
	
	 var valor1=temp_busqueda2;

 
     var i;

	for (i=0;i<document.formauxiliar.busqueda2.options.length;i++)

        {
			
            if (document.formauxiliar.busqueda2.options[i].value==valor1)
               {
			   document.formauxiliar.busqueda2.options[i].selected=true;
               }
        
        }
	
	}
	
function salir(){

	document.getElementById('auxiliares').style.visibility='hidden';
	
}	
	
</script>
</head>

<link href="../styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-image: url(../imagenes/bg3.jpg);
}
.Estilo19 {font-family: Arial, Helvetica, sans-serif}
.Estilo24 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo27 {color: #333333}
.Estilo30 {font-family: Verdana, Arial, Helvetica, sans-serif; color: #003366;}
.Estilo31 {font-size: 10px}
.anulado  {text-decoration:line-through;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#990000; }
.Estilo103 {font-size: 12}
-->
</style>

<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>

<script language="javascript" src="miAJAXlib2.js"></script>

<body>
<form name="form1" method="post" action="">
      <table width="776" height="386" border="0" cellpadding="0" cellspacing="0">
        <tr style="background:url(../imagenes/white-top-bottom.gif)">
          <td width="776" height="22" colspan="6" align="left" style="border:#999999"><span class="Estilo100 Estilo24"><span class="Estilo103"><?php echo $titu; ?>
            <input type="hidden" name="tipo" value="<?php echo $tipo?>">
            
            <input type="hidden" name="carga" id="carga" value="N">
          <input name="tempauxprod"  type="hidden" value="auxiliares" size="15" />
          </span></span></td>
        </tr>
        <tr >
          <td height="38" colspan="6" align="left"><table width="789" border="0" cellpadding="0" cellspacing="0"  style="border:#CCCCCC solid 1px; padding-left:5px ">
            <tr>
              <td width="787" align="left" valign="top">
			  
			  <table width="786" border="0" cellpadding="0" cellspacing="0">
                
                <tr style="background:url(../imagenes/botones.gif);">
                  <td width="123" rowspan="2">
				  
				  <table width="123" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="23">Del:                              </td>
                      <td width="76"><input  name="fecha" type="text" id="fecha" size="10"   maxlength="10" value="<?php if(isset($_REQUEST['fecha'])){echo $_REQUEST['fecha'];}else{ echo date('d-m-Y',time()-3600);} ?>"></td>
                      <td width="24"><button type="reset" id="f_trigger_b2" style="height:20px" >...</button>
                        <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b2",   
        singleClick    :    true,           
        step           :    1                
    });
                        </script></td>
                    </tr>
                    <tr>
                      <td>Al:                      </td>
                      <td><input  name="fecha2" type="text" id="fecha2" size="10"   maxlength="10" value="<?php if(isset($_REQUEST['fecha2'])){echo $_REQUEST['fecha2'];}else{ echo date('d-m-Y',time()-3600);} ?>"></td>
                      <td><button type="reset" id="f_trigger_b3" style="height:20px" >...</button>
                          <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha2",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b3",   
        singleClick    :    true,           
        step           :    1                
    });
                        </script></td>
                    </tr>
                  </table></td>
                  <td width="53" height="25" align="left"><span class="Estilo17 text5 text5 Estilo19 Estilo27 Estilo31"><span class="text5 text5 Estilo19 Estilo27 Estilo31  Estilo30"><span class="Estilo24">Empresa
                    
                  </span></span></span></td>
                  <td width="161" align="left"><span class="Estilo17 text5 text5 Estilo19 Estilo27 Estilo31"><span class="text5 text5 Estilo19 Estilo27 Estilo31  Estilo30"><span class="Estilo24">
                    <select style="width:160"  name="sucursal" onChange="doAjax('../carga_cbo_tienda.php','&kardex=s&codsuc='+document.form1.sucursal.value,'cargar_cbo','get','0','1','','')" >
                      <option value="0">Todos</option>
                      <?php 
		
		 $resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn);
		 
		  
		while($row1=mysql_fetch_array($resultados1))
		{
		?>
                      <option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
                      <?php }?>
					  
					  
					<script>
			 var valor1="<?php echo $_REQUEST['sucursal']?>";
     var i;
	 for (i=0;i<document.form1.sucursal.options.length;i++)
        {
		
            if (document.form1.sucursal.options[i].value==valor1)
               {
			   
               document.form1.sucursal.options[i].selected=true;
               }
        
        }
			
			      </script>  
                    </select>
                  </span></span></span></td>
                  <td width="55" align="left"><span class="Estilo17 text5 text5 Estilo19 Estilo27 Estilo31"><span class="text5 text5 Estilo19 Estilo27 Estilo31  Estilo30"><span class="Estilo24">Vendedor</span></span></span></td>
                  <td width="124">                  <select style="width:120" name="vendedor">
                    <option value="000">------ Todos ------</option>
                    <?php 
			$strSQL="select * from usuarios where codigo >=002";
			$resultado=mysql_query($strSQL,$cn);
			while($row=mysql_fetch_array($resultado)){
			
			?>
                    <option value="<?php echo $row['codigo']?>"><?php echo $row['usuario']?></option>
                    <?php 
			
			}?>
                    <script>
			 var valor1="<?php echo $_REQUEST['vendedor']?>";
     var i;
	 for (i=0;i<document.form1.vendedor.options.length;i++)
        {
		
            if (document.form1.vendedor.options[i].value==valor1)
               {
			   
               document.form1.vendedor.options[i].selected=true;
               }
        
        }
			
			      </script>
                  </select></td>
                  <td width="25">                <span class="Estilo17 text5 text5 Estilo19 Estilo27 Estilo31"><span class="text5 text5 Estilo19 Estilo27 Estilo31  Estilo30"><span class="Estilo24">Caja</span></span></span></td>
                  <td width="141" id="tbl"><select name="serie" style="width:120">
                    <option value="000">------ Todos -------</option>
                    <?php 
			$strSQL="select * from caja";
			$resultado=mysql_query($strSQL,$cn);
			while($row=mysql_fetch_array($resultado)){
			
			?>
                    <option value="<?php echo $row['codigo']?>"><?php echo $row['descripcion']?></option>
                    <?php }?>
					
					<script>
			 var valor1="<?php echo $_REQUEST['serie']?>";
     var i;
	 for (i=0;i<document.form1.serie.options.length;i++)
        {
		
            if (document.form1.serie.options[i].value==valor1)
               {
			   
               document.form1.serie.options[i].selected=true;
               }
        
        }
			
			      </script>  
					
                  </select></td>
                  <td width="104" id="tbl">
				  <input onClick="cargar_detalle('')" style="width:70px; cursor:pointer" type="button" name="Submit" value="Procesar" >				  </td>
                </tr>
                <tr>
                  <td  align="left"><span class="Estilo17 text5 text5 Estilo19 Estilo27 Estilo31"><span class="text5 text5 Estilo19 Estilo27 Estilo31  Estilo30"><span class="Estilo24">Tienda</span></span></span></td>
                  <td align="left">
				  <div id="cbo_tienda">
				  <select  style="width:160" name="almacen"  onBlur="">
                    <option value="0">Todos</option>
                  </select>
				  </div>				  </td>
                  <td align="left"><span class="Estilo17 text5 text5 Estilo19 Estilo27 Estilo31"><span class="text5 text5 Estilo19 Estilo27 Estilo31  Estilo30"><span class="Estilo24">Turno</span></span></span></td>
                  <td><select name="turno" style="width:120">
                    <option value="0">------ Todos -------</option>
                    <option value="1">Turno 1</option>
                    <option value="2">Turno 2</option>
					
					<script>
			 var valor1="<?php echo $_REQUEST['turno']?>";
     var i;
	 for (i=0;i<document.form1.turno.options.length;i++)
        {
		
            if (document.form1.turno.options[i].value==valor1)
               {
			   
               document.form1.turno.options[i].selected=true;
               }
        
        }
			
			      </script>
					
                  </select></td>
                  <td colspan="3">
                    
                    <?php if($tipo=='2'){?>
                    <input <?php if($_REQUEST['tickets']!=''){?> checked="checked" <?php }?> style="border: 0px; background-color:#F9F9F9; " type="checkbox" name="tickets" id="tickets" value="checkbox" >
                    <span class="Estilo31"><strong> Todos los Doc. </strong></span>
                    <input style="border: 0px; background-color:#F9F9F9; " type="checkbox" name="doccredit" id="doccredit" value="checkbox" >
                    <span class="Estilo31"><strong>Docs. al Credito</strong></span>
                    <?php }else{?>
                    <input  checked="checked"  style="border: 0px; background-color:#F9F9F9; visibility:hidden " type="checkbox" name="tickets3" id="tickets3" value="checkbox">
                    <input <?php if($_REQUEST['tickets2']!=''){?> checked="checked" <?php }?> style="border: 0px; background-color:#F9F9F9; " type="checkbox" name="tickets2" id="tickets2" value="checkbox" >
                    <span class="Estilo31"><strong> Sin Canc. a la Fecha </strong></span>
                    <?php }?>                    <img style="cursor:pointer" onClick="enviar_excel();" src="../imagenes/ico-excel.gif" width="20" height="20">
                    
                    <!-- <a href="#" onClick="javascript:imprSelec()">&nbsp;&nbsp;<img src="../imgenes/fileprint.png" width="25" height="25" border="0"> </a>-->				  </td>
                </tr>
				    <tr>
                  <td>&nbsp;</td>
                  <td  align="left"><span class="Estilo17 text5 Estilo19 Estilo27 Estilo31 Estilo30"><span class="text5 Estilo19 Estilo27 Estilo31"><span class="Estilo24"><?php if($tipo==2){echo "Cliente:";}else{echo "Proveedor:";}?></span></span></span></td>
                  <td colspan="2" align="left"><label>
                  <input autocomplete="off" name="cliente" id="cliente" type="text" size="25" maxlength="50" onKeyUp="validartecla(event,this,'auxiliares')">
                  <input name="cliente2" type="hidden" size="3"  value=""/></label></td>
                  <td colspan="4"><label>
                    <input name="acliente" type="checkbox" id="acliente" value="checkbox" style="border:0px;">
                   <?php echo $agruparpor; ?></label>
				  
				    <input name="detallePagos" type="checkbox" id="detallePagos" value="checkbox" style="border:0px;">
				  Detallar Pagos 
				  <input name="doc_cancel" type="checkbox" id="doc_cancel" value="checkbox" style="border:0px;">
cancelados 
<input name="doc_cancel2" type="checkbox" id="doc_cancel2" style="border:0px;" value="checkbox" checked>
deuda</td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        
        <tr>
          <td height="258" colspan="6" valign="top">
		
		  <div id="detalle" style="width:774px; height:300px; overflow:scroll">
   		  
		  
		     
		  </div>
		
		  
		  </td>
        </tr>
        <tr>
          <td  colspan="6" valign="top">
		   <div id="paginacion" style="width:760px; height:20px;">
		 	     
		  </div>
		  
		  </td>
        </tr>
  </table>
     
</form>
 <div id="auxiliares" style="position:absolute; left:274px; top:90px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>
  <div id="productos" style="position:absolute; left:22px; top:192px; width:300px; height:180px; z-index:1; visibility:hidden"> </div>


</body>
</html>

<script>

function doc_det(valor){

window.open("../doc_det2.php?referencia="+valor,"","toolbar=no,status=no, menubar=no, scrollbars=yes, width=520, height=320,left=300 top=250");

}
function pago_det(valor){

window.open("pago_det.php?referencia="+valor,"","toolbar=no,status=no, menubar=no, scrollbars=yes, width=672, height=350,left=300 top=250");

}

function entrada(objeto){
//document.getElementById('prueba').value=objeto.style.background;
//alert(objeto.style.background);

	if(objeto.style.background=='#fff1bb'){
//	alert('rrr');
	objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='#FFF1BB';
	
	}
//document.getElementById('prueba').value=objeto.style.background;
//est=0;
}


function cargar_cbo(texto){
var r = texto;
document.getElementById('cbo_tienda').innerHTML=r;
//document.form1.almacen.focus();
}

function enfocar_cbo(x){
}

function limpiar_enfoque(x){
}
function cambiar_enfoque(x){
}


function enviar_excel(){

/*
document.form1.action="reportect1_excel.php";
document.form1.target="_blank";
document.form1.submit();
document.form1.action="";
document.form1.target="";
*/

var fecha=document.form1.fecha.value;
var fecha2=document.form1.fecha2.value;
var sucursal=document.form1.sucursal.value;
var almacen= document.form1.almacen.value;
var vendedor=document.form1.vendedor.value;
var turno=document.form1.turno.value;
var serie=document.form1.serie.value;
var tickets=document.form1.tickets.checked;
//alert(tickets);
var tipo=document.form1.tipo.value;
var tickets2=""
if(tipo=="1"){
	tickets2=document.form1.tickets2.checked;
}
var pagina="";
var formato="";
var acliente=document.form1.acliente.checked;
if(document.form1.detallePagos.checked){
	formato="D";
}

var doc_cancel="N";
if(document.form1.doc_cancel.checked){
	doc_cancel="S";
}

var doc_cancel2="N";
if(document.form1.doc_cancel2.checked){
	doc_cancel2="S";
}

if(document.form1.cliente.value!=""){
var codcli=document.form1.cliente2.value;
}else{
var codcli=""
}

var doc_credit="N";
if(document.form1.doccredit.checked){
	doc_credit="S";
}

window.open('det_rpt1.php?fecha='+fecha+'&fecha2='+fecha2+'&sucursal='+sucursal+'&almacen='+almacen+'&vendedor='+vendedor+'&turno='+turno+'&serie='+serie+'&tickets='+tickets+'&tickets2='+tickets2+'&tipo='+tipo+'&pagina='+pagina+'&acliente='+acliente+'&excel=&formato='+formato+'&codcli='+codcli+'&doc_cancel='+doc_cancel+'&doc_cancel2='+doc_cancel2+'&doc_credit='+doc_credit,"","toolbar=no,status=no, menubar=no, scrollbars=yes, width=672, height=350,left=300 top=250");



}

function cargar_detalle(pagina){
//alert(pagina);
var fecha=document.form1.fecha.value;
var fecha2=document.form1.fecha2.value;
var sucursal=document.form1.sucursal.value;
var almacen= document.form1.almacen.value;
var vendedor=document.form1.vendedor.value;
var turno=document.form1.turno.value;
var serie=document.form1.serie.value;
var tickets=document.form1.tickets.checked;
//var doc_cancel=document.form1.doc_cancel.checked;
if(document.form1.cliente.value!=""){
var codcli=document.form1.cliente2.value;
}else{
var codcli=""
}
var acliente=document.form1.acliente.checked;
//alert(codcli);
var tipo=document.form1.tipo.value;
var tickets2="N";
if(tipo=="1" && document.form1.tickets2.checked){
	tickets2="S";
}
var formato="";
if(document.form1.detallePagos.checked){
	formato="D";
}

var doc_cancel="N";
if(document.form1.doc_cancel.checked){
	doc_cancel="S";
}

var doc_cancel2="N";
if(document.form1.doc_cancel2.checked){
	doc_cancel2="S";
}

var doc_credit="N";
if(document.form1.doccredit.checked){
	doc_credit="S";
}

doAjax('det_rpt1.php','fecha='+fecha+'&fecha2='+fecha2+'&sucursal='+sucursal+'&almacen='+almacen+'&vendedor='+vendedor+'&turno='+turno+'&serie='+serie+'&tickets='+tickets+'&tickets2='+tickets2+'&codcli='+codcli+'&acliente='+acliente+'&tipo='+tipo+'&pagina='+pagina+'&formato='+formato+'&doc_cancel='+doc_cancel+'&doc_cancel2='+doc_cancel2+'&doc_credit='+doc_credit,'view_det','get','0','1','','');

}

function view_det(texto){

var r = texto.split('|');
document.getElementById('detalle').innerHTML=r[0];
document.form1.carga.value='N';
document.getElementById('paginacion').innerHTML=r[1];

}

function imprSelec()
{
 
  
  var ficha = document.getElementById('detalle');
  var ventimp = window.open(' ', 'popimpr');
  ventimp.document.write( ficha.innerHTML );
  ventimp.document.close();
  ventimp.print();
  ventimp.close();
}

function selecCliente(codcli,descli){


document.form1.cliente.value=descli;
document.form1.cliente2.value=codcli;
document.getElementById('auxiliares').style.visibility='hidden';
//alert();
//document.form1.carga.value='N';
//alert(codcli+" " +descli);
}



</script>
