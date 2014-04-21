<?php 
session_start();
include('../conex_inicial.php');
include('../funciones/funciones.php');

 		  $strSQL_doc="select * from operacion where codigo='GR' and  tipo='2' ";
		  $resultado_doc=mysql_query($strSQL_doc,$cn);
		  $row_doc=mysql_fetch_array($resultado_doc);
		  
		  $permiso10=substr($row_doc['p1'],0,1);
		  
		  unset($_SESSION['temp_series'][0]);
		  unset($_SESSION['temp_series'][2]);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>administradores</title>
<!--
<LINK href="../pestanas/tab-view.css" type=text/css rel=stylesheet>
<SCRIPT src="../pestanas/tab-view.js" type=text/javascript></SCRIPT>
--->
<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>
<!--
<script src="../jquery-1.2.6.js"></script>
<script src="../jquery.hotkeys.js"></script>
-->

	<link href="../js/css/ui-lightness/jquery-ui-1.9.1.custom.css" rel="stylesheet">
	<script src="../js/js/jquery-1.8.2.js"></script>
	<script src="../js/js/jquery-ui-1.9.1.custom.js"></script>
    

 <script language="javascript">
	$(function() {
						
		$( "#dialog" ).dialog({
			autoOpen: false,
			width: 400,
			buttons: [
				{
					text: "Guardar",
					click: function() {
						//guardar_cuentaProd();
						//$('div#dialog').html('');
						//$( this ).dialog( "close" );
						//alert("Se Guardaron los Cambios");
						aceptar_sal_serie();
						
					}
				},
				{
					text: "Cancel",
					click: function() {
						
						$( this ).dialog( "close" );
						$('div#dialog').html('');					
							
						
					}
				}
			]
		});

		// Link to open the dialog
		
	});
	
	var  myVar='';
 
 $(document).ready(function(){
	     $( "#dialog" ).dialog({
			       autoOpen: false,
				   modal: true,
				   height: 340,	
				   width: 350,
				   zIndex: 400,
				  show: {
					effect: "blind",
					duration: 500
				  },
				  hide: {
					effect: "explode",
					duration: 500				
				  }	  
				  
	    });
		
			
		
});


function abrirPopup(idproducto){
	
	$( "#dialog" ).dialog( "open" );
	
	 //var aplicacion = $('#tipo :selected').val();
	 var cod_tienda_origen=$('#cod_tienda_origen').val();
	 var cod_cab_doc=$('#cod_cab_doc').val();
	// alert(cod_tienda_origen);
	 var aplicacion = "";
		 //alert(aplicacion);
		  var contenidoAjax = $('div#dialog').html('<p align="center"><img src="../imgenes/loader.gif" /></p>');
		    $.ajax({
			type : "POST",
			//url : "../peticion_ajax5.php",
			url : "../compras/sal_series3.php",
			data  : 'peticion=series_dispo&idproducto='+idproducto+'&cod_tienda_origen='+cod_tienda_origen+'&cod_cab_doc='+cod_cab_doc ,
			success : function(data) {								
			contenidoAjax.html(data);
			  //alert(data);
			 document.getElementById("dialog").innerHTML=data;
									}
			});	
}	

function cerrar_modal_x(){
	$('div#dialog').html('');
}
	
	</script>



<script>

var scrollDivs=new Array();
scrollDivs[0]="sucursal";
scrollDivs[1]="divUbigeo";

var controlStock="<?php echo $permiso10 ?>";
//alert(controlStock);

function recargar(){
document.form1.submit();
}

function nuevo_suc(texto){

//alert(texto);
var r = texto.split('pestana');
document.getElementById('dhtmlgoodies_tabView1').getElementsByTagName('DIV')[3].innerHTML=r[0];
document.getElementById('dhtmlgoodies_tabView1').getElementsByTagName('DIV')[4].innerHTML=r[1];
document.getElementById('sucursal').style.display='block';
seleccionar_combo();
seleccionar_combo2();
seleccionar_combo3();
seleccionar_combo4();
//seleccionar_combo2();

//alert('entro');
//document.form1.txtnombre.focus();

//initTabs('dhtmlgoodies_tabView1',Array('General','Datos adicionales'),0,500,200,Array(false,false));

//alert(dhtmlgoodies_tabObj);

}

function ocultar(){
document.getElementById('sucursal').style.display='none';
}


function seleccionar_combo(){

 	 var valor1=document.form1.t_persona2.value;;
     var i;
	 for (i=0;i<document.form1.t_persona.options.length;i++)
        {
		
            if (document.form1.t_persona.options[i].value==valor1)
               {
			   
               document.form1.t_persona.options[i].selected=true;
               }
        
        }
		
		cambiar_persona();
		
}
function seleccionar_combo2(){

 	 var valor1=document.form1.condicion2.value;;
     var i;
	 for (i=0;i<document.form1.condicion.options.length;i++)
        {
		
            if (document.form1.condicion.options[i].value==valor1)
               {
			   
               document.form1.condicion.options[i].selected=true;
               }
        
        }
		
	
		
}
function seleccionar_combo3(){

 	 var valor1=document.form1.responsable2.value;;
     var i;
	 for (i=0;i<document.form1.responsable.options.length;i++)
        {
		
            if (document.form1.responsable.options[i].value==valor1)
               {
			   
               document.form1.responsable.options[i].selected=true;
               }
        
        }
		
	
		
}
function seleccionar_combo4(){

 	 var valor1=document.form1.clas_clie2.value;;
     var i;
	 for (i=0;i<document.form1.clas_clie.options.length;i++)
        {
		
            if (document.form1.clas_clie.options[i].value==valor1)
               {
			   
               document.form1.clas_clie.options[i].selected=true;
               }
        
        }
		
	
		
}





function validar_datos(){
    var mov = "<? echo $_REQUEST['mov']; ?>";
	//alert(mov);
	var persona=document.form1.t_persona.value;
	//alert(persona);
	if(persona=='juridica'){
		
		//alert(document.form1.ruc.value.substring(0,2));
		if(document.form1.tipoprov.value=='1'){		
			if(!(document.form1.ruc.value.substring(0,2)>=10 &&  document.form1.ruc.value.substring(0,2)<=20)){
					//&&  ruc.substring(0,2)!='15'
				alert('Ingrese un número de ruc válido');
				return false;
				document.formulario.document.form1.ruc.value.select();
				document.formulario.document.form1.ruc.value.focus();
			}
		}
		
		if(document.form1.razonsocial.value==''){
		alert('Ingrese un nombre de cliente ó Razón social válida');
		return false;
		}
		
		if(document.form1.tipoprov.value=='1'){	
			if(document.form1.ruc.value=='' || document.form1.ruc.value.length!=11 ){
			alert('Ingrese un número de ruc válido');
			return false;
			}
		}
		
	}
	
	if(persona=='natural'){

		if(document.form1.razonsocial.value=='' ){
		alert('Ingrese un nombre de cliente ó Razón social válida');
		return false;
		}
		
		/*if(document.form1.docu_iden.value=='' || document.form1.docu_iden.value.length!=8 ){
		alert('Ingrese un número de documento válido');
		return false;
		}
		*/
	}
	
	//COMFIRMAR SI TIENE MOVIMIENTOS
    /*if( mov == 'ok' )
	{	if(confirm("**************   ESTE CLIENTE YA REALIZO MOVIMIENTOS  **************")){  return true;		}
		else{ return false; }
	}*/
	return true;
}
</script>




<link href="../styles.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
body {
	background-image: url(imagenes/bg3.jpg);
}
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}

.Estilo28 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color:#000000 }
.Estilo24 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo29 {color: #0066FF}
.Estilo30 {color: #000000}


-->
</style>
</head>

<script language="javascript" src="../miAJAXlib2.js"></script>

<body bgcolor="#FFFFFF" >
<form name="form1" method="post" action="?" onSubmit="return validar_datos();">

<div id="dialog" title="Series Disponibles" > 
 
</div> 

  <table width="780" height="508" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" >
    <tr  style="background:url(../imagenes/white-top-bottom.gif)">
      <td height="27" colspan="3" style="border:#999999">
	  <span class="Estilo1">Log&iacute;stica :: Generar Guias x Transferencias :: Generador de Guias por Transferencias <?php echo $texto?><span class="text4">
        <input name="auxiliar" type="hidden" id="auxiliar" value="<?php echo $tipo_aux; ?>">
      </span></span>	  <span class="Estilo28">
      <?php /*?><select name="documentos" style="width:120px">
                  <option value="0">Todos</option>
                  <?php 
					 $resultados1 = mysql_query("select * from operacion where tipo='1' and substring(p1,10,1)='S' and codigo!='TS' ",$cn); 
					 while($row1=mysql_fetch_array($resultados1)){
					?>
                  <option value="<?php echo $row1['codigo'] ?>"><?php echo $row1['descripcion'] ?></option>
                  <?php 
					}
					?>
                </select><?php */?>
      </span></td>
    </tr>
    <tr style="background:url(imagenes/botones.gif)">
      <td height="10" colspan="3" ></td>
    </tr>
    <tr>
      <td height="164" colspan="3" align="center" valign="top"><fieldset>
        <table width="773" height="149" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="773" height="32" class="Estilo28">
			<table width="768" height="66" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="164" height="22" class="Estilo28">Empresa:</td>
                <td class="Estilo28">Local / Tienda: </td>
                <td><span class="Estilo30">Fecha del: </span></td>
                <td>&nbsp;</td>
                <td><span class="Estilo30">Al:</span></td>
                <td>&nbsp;</td>
                <td class="Estilo28">Proveedor:</td>
              </tr>
              <tr>
                <td height="22" class="Estilo28"><span class="Estilo24">
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
                </span></td>
                <td width="165" class="Estilo28">
				
				<div id="cbo_tienda">
				  <select  style="width:160" name="almacen"  onBlur="">
                    <option value="0">Todos</option>
                  </select>
				  </div>				  </td>
                <td width="64"><input  name="fecha" type="text" id="fecha" size="10"   maxlength="10" value="<?php if(isset($_REQUEST['fecha'])){echo $_REQUEST['fecha'];}else{ echo date("d-m-Y", strtotime(gmdate('d-m-Y')." -7 day")); } ?>"></td>
                <td width="22"><button type="reset" id="f_trigger_b2" style="height:20px" >...</button>
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
                <td width="66"><input  name="fecha2" type="text" id="fecha2" size="10"   maxlength="10" value="<?php if(isset($_REQUEST['fecha2'])){echo $_REQUEST['fecha2'];}else{ echo gmdate('d-m-Y');} ?>"></td>
                <td width="21"><button type="reset" id="f_trigger_b3" style="height:20px" >...</button>
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
                <td width="266" class="Estilo28"><input type="text" name="proveedor" id="proveedor">
                  <input type="button" name="Submit" value="Consultar" onClick="cargar_datos('')"></td>
                </tr>
              <tr>
                <td height="22" colspan="2" class="Estilo28">N&uacute;mero Documento  
                  <input name="serie" type="text" id="serie" onBlur="if(document.form1.serie.value!='')document.form1.serie.value=ponerCeros(document.form1.serie.value,3)" size="5" maxlength="3">
                  <input name="numero" id="numero" type="text" size="10" onBlur="if(document.form1.numero.value!='')document.form1.numero.value=ponerCeros(document.form1.numero.value,7)"></td>
                <td colspan="5"><strong>
                  <select name="criterio">
                    <option value="idproducto">C&oacute;digo Sistema</option>
                    <option value="nombre" selected>Descripci&oacute;n</option>
                    <option value="cod_prod">C&oacute;digo anexo</option>
                  </select>
                </strong>
                  <input autocomplete="off"  name="valorProd" id="valorProd" type="text" size="25" onKeyUp="buscar_prod()"></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td height="9"><hr></td>
          </tr>
          <tr>
            <td height="108"><table width="770" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="770" height="96" valign="top"><div id="capaDocIng" ></div></td>
              </tr>
              
            </table></td>
          </tr>
        </table>
      </fieldset></td>
    </tr>
    
    <tr bordercolor="#CCCCCC" >
      <td height="10" colspan="3" align="center"   ></td>
    </tr>
    <tr bordercolor="#CCCCCC" >
      <td height="174" colspan="3" align="center"   ><fieldset><legend style="color:#0066FF">Detalle de Documento</legend>
        <table width="773" height="159" border="0">
          <tr>
            <td height="155" valign="top">
			
			<div id="capaDetalleDoc" >
			
			
			
			</div>
			
			</td>
          </tr>
        </table>
      </fieldset></td>
    </tr>
    
    <tr>
      <td height="5" colspan="3"></td>
    </tr>
    <tr>
      <td width="393" height="105" align="center"><fieldset><legend><span class="Estilo29">Documento Origen</span></legend>
        <table width="365" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="3"><span class="Estilo28">
              <input type="hidden" name="cod_cab_doc" id="cod_cab_doc">
            </span></td>
          </tr>
          <tr>
            <td height="21"><span class="Estilo28">Empresa</span>:</td>
            <td height="21" colspan="2" class="Estilo28"><input type="hidden" name="cod_suc_origen" id="cod_suc_origen"><strong><label id="des_suc_origen"></label></strong></td>
          </tr>
          <tr>
            <td height="20"><span class="Estilo28">Tienda</span>:</td>
            <td height="20" colspan="2" class="Estilo28"><input type="hidden" name="cod_tienda_origen" id="cod_tienda_origen"><strong>
			<label id="des_tienda_origen"></label></strong>
			</td>
          </tr>
          <tr>
            <td width="64"><span class="Estilo28">Documento:</span></td>
            <td width="73" align="left"><span class="Estilo28">
              <input name="cod_ope" id="cod_ope" type="text" size="5" style="border:none; background:none; font:bold" readonly="" value="GR" >
            </span></td>
            <td width="228"><span class="Estilo28">N&uacute;mero :
                <input name="serieDocOrigen" type="text" size="5" onKeyUp="generarNumero(event)" onKeyDown="validarNumero2(this,event)">
                <input name="numeroDocOrigen" type="text" size="10" onKeyUp="validarNumero(event)" onKeyDown="validarNumero2(this,event)">
            </span></td>
          </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr>
        </table>
      </fieldset>       </td>
      <td width="14">&nbsp;</td>
      <td width="373" height="105" align="center"><fieldset>
        <legend><span class="Estilo29">Documento Destino </span></legend>
        <table width="365" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr>
            <td height="21"><span class="Estilo28">Empresa</span>:</td>
            <td height="21" colspan="2" align="left" class="Estilo28"><strong>
              
                <span class="Estilo24">
                <select style="width:160"  name="sucursal2" onChange="doAjax('../carga_cbo_tienda2.php','&kardex=s&codsuc='+document.form1.sucursal2.value,'cargar_cbo2','get','0','1','','')" >
           <option value="0">---Seleccionar---</option>
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
            </span></strong></td></tr>
          <tr>
            <td height="20"><span class="Estilo28">Tienda</span>:</td>
            <td height="20" colspan="2" align="left" class="Estilo28"><strong>
                     </strong>
				
				<div id="cbo_tienda2">
				  <select  style="width:160" name="almacen2"  onBlur="">
                    <option value="0">Todos</option>
                  </select>
			  </div>	
		    </td></tr>
          <tr>
            <td width="64">&nbsp;</td>
            <td width="73" align="left">&nbsp;</td>
            <td width="228">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" align="center"><input type="button" name="Submit2" value="Guardar Documento" onClick="save_doc()"></td>
          </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr>
        </table>
      </fieldset>
       </td>
    </tr>
  </table>
   

  
<div id="divCliente" style="position:absolute; left:200px; top:150px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>

  
<div id="divItinerarios" style="position:absolute; left:50px; top:100px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>


<div id="divAsientos" style="position:absolute; left:80px; top:50px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>



</form>
</body>

</html>

<script>


function cargar_cbo(texto){
var r = texto;
document.getElementById('cbo_tienda').innerHTML=r;
//document.form1.almacen.focus();
}

function cargar_cbo2(texto){
var r = texto;
document.getElementById('cbo_tienda2').innerHTML=r;
//document.form1.almacen.focus();  

}

function enfocar_cbo(x){
}

function limpiar_enfoque(x){
}
function cambiar_enfoque(x){
}

function cargar_datos(pag){

var fecha1=document.form1.fecha.value;
var fecha2=document.form1.fecha2.value;
var sucursal=document.form1.sucursal.value;
var tienda=document.form1.almacen.value;
var proveedor=document.form1.proveedor.value;
var serie=document.form1.serie.value;
var numero=document.form1.numero.value;

var criterio=document.form1.criterio.value;
var valorProd=document.form1.valorProd.value;


doAjax('../peticion_ajax5.php','&peticion=docsIng&fecha1='+fecha1+'&fecha2='+fecha2+'&sucursal='+sucursal+'&tienda='+tienda+'&proveedor='+proveedor+'&pag='+pag+'&serie='+serie+'&numero='+numero+'&valorProd='+valorProd+'&criterio='+criterio,'rspta_docsIng','get','0','1','','');


}

function rspta_docsIng(data){

document.getElementById('capaDocIng').innerHTML=data;	

temp=document.getElementById('tbl_productos').rows[0];
}

function cargarDetalle(cod,cod_ope,sucursal,des_suc,tienda,des_tienda){

doAjax('../peticion_ajax5.php','&peticion=detallaDoc&cod='+cod,'rspta_cargarDetalle','get','0','1','','');

document.form1.cod_suc_origen.value=sucursal;
document.form1.cod_tienda_origen.value=tienda;	
//document.form1.cod_ope.value=cod_ope;	
document.getElementById('des_suc_origen').innerHTML=des_suc;
document.getElementById('des_tienda_origen').innerHTML=des_tienda;
//alert(sucursal+" "+tienda);
//document.getElementById('cod_suc_origen').innerHTML=sucursal;
//document.getElementById('cod_tienda_origen').innerHTML=tienda;

document.form1.cod_cab_doc.value=cod;


}

function rspta_cargarDetalle(data){
document.getElementById('capaDetalleDoc').innerHTML=data;
}


var temp="";
function entrada2(objeto){

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
		//alert(document.getElementById('tbl_productos').rows[i].innerHTML);
			 document.getElementById('tbl_productos').rows[i].style.backgroundColor = '#999999';
		}
	}

//alert(temp);
}

	var acumCant="";	
	var acumCod="";	
	


function validarCantFact(control,serieprod,codprod){
	
	//alert(temp);
		
	
	
		var cantfac=parseFloat(control.value);
		
		if (document.form1.cantFact.length==undefined){
		
		 	var cantdesp=parseFloat(document.form1.cantdesp.value);
			var cantstock=parseFloat(document.form1.cantstock.value);		
			var cantped=parseFloat(document.form1.cantped.value);
			//alert(cantped+" "+cantdesp+" "+cantstock+" "+cantfac);
			var tepm= cantped-cantdesp;
												
			if(cantstock>0){
				if(controlStock=='S'){
						
					if(cantfac>cantstock || cantfac<0 || cantfac>tepm){
											
					
					if(cantfac>cantstock)alert("La cantidad ingresada no puede ser mayor al stock ");
					if(cantfac<0)alert("La cantidad ingresada no puede ser menor a cero ");
					if(cantfac>tepm)alert("La cantidad ingresada no puede ser mayor al saldo ");
											
					document.form1.cantFact.value=cantfac;
					control.select();
					control.focus();
					return false;
					}
					
				}else{
				
					if(cantfac<0 || cantfac>tepm){
					alert("La cantidad ingresada no es correcta ");
					document.form1.cantFact.value=cantfac;
					control.select();
					control.focus();
					return false;
					}

				
				}
				
				
			}else{
				
				if(controlStock=='S'){
				
					if(cantfac>0){
					alert("La cantidad ingresada no es correcta");
					document.form1.cantFact.value=cantfac;
					control.select();
					control.focus();
					return false;
					}
				}	
			
			}
				  
				
		}else{
			for(var i=0; i<document.form1.cantFact.length; i++){
				
				if(control==document.form1.cantFact[i]){
					var indice=i;			
				}
				
			}
			
			var cantdesp=parseFloat(document.form1.cantdesp[indice].value);
			var cantstock=parseFloat(document.form1.cantstock[indice].value);		
			var cantped=parseFloat(document.form1.cantped[indice].value);
			//alert(cantped+" "+cantdesp+" "+cantstock+" "+cantfac);
			var tepm= cantped-cantdesp;
			
			if(cantstock>0){
			
				
				
				if(controlStock=='S'){
						
					if(cantfac>cantstock || cantfac<0 || cantfac>tepm){
					alert("La cantidad ingresada no es correcta ");
					document.form1.cantFact[indice].value=cantfac;
					control.select();
					control.focus();
					return false;
					}
				
					
				}else{
				
					if(cantfac<0 || cantfac>tepm){
					alert("La cantidad ingresada no es correcta ");
					document.form1.cantFact[indice].value=cantfac;
					control.select();
					control.focus();
					return false;
					}

				
				}
				
				
			}else{
			
				if(controlStock=='S'){
				
					if(cantfac>0){
					alert("La cantidad ingresada no es correcta");
					document.form1.cantFact[indice].value=cantfac;
					control.select();
					control.focus();
					return false;
					}
				}			
			}
		
		}
			
	
}
function save_doc(){

		
		var sucursal_destino=document.form1.sucursal2.value;
		var almacen_destino=document.form1.almacen2.value;
		var serieDocOrigen=document.form1.serieDocOrigen.value;
		var numeroDocOrigen=document.form1.numeroDocOrigen.value;
		var cod_suc_origen=document.form1.cod_suc_origen.value;
		var cod_tienda_origen=document.form1.cod_tienda_origen.value; 
		var cod_cab_doc=document.form1.cod_cab_doc.value; 
		
		if(sucursal_destino==0 || almacen_destino==0){
		alert("Seleccionar una Empresa y Tienda de Destino");
		return false;
		}
		
		if(serieDocOrigen=='' || serieDocOrigen=='0'){
		alert("Ingrese el numero de serie del Documento GR");
		return false;
		}
		
		if(!document.form1.numeroDocOrigen.disabled){
		alert("Debe aceptar el número de documento para continuar...");
		document.form1.numeroDocOrigen.focus();
		document.form1.numeroDocOrigen.select();
		return false;
		}
		
		if (document.form1.cantFact.length==undefined){
		
			    acumCant=acumCant+"|"+document.form1.cantFact.value;
				acumCod=acumCod+"|"+document.form1.codFact.value;
		
		}else{
		
			for(var i=0; i<document.form1.cantFact.length; i++){
			//alert(document.form1.cantFact[i].value);codFact
				if(document.form1.cantFact[i].value>0){
				acumCant=acumCant+"|"+document.form1.cantFact[i].value;
				acumCod=acumCod+"|"+document.form1.codFact[i].value;
				}		
			}		
			
		}
		
		
		//alert(acumCant);
		//alert(acumCod);
		if(acumCant=='' && acumCant==0){
		alert("No es posible guardar un documento con cantidad a transferir cero ");
		
		}else{
		
		doAjax('../peticion_ajax5.php','peticion=save_doc&cod_cab_doc='+cod_cab_doc+'&sucursal_destino='+sucursal_destino+'&almacen_destino='+almacen_destino+'&serieDocOrigen='+serieDocOrigen+'&acumCant='+acumCant+'&acumCod='+acumCod+'&numeroDocOrigen='+numeroDocOrigen,'rspta_save_doc','get','0','1','','');
					
		}
		
			
		
}

function rspta_save_doc(data){
//alert(data);
document.form1.submit();
}



function doc_det(valor){

window.open("../doc_det2.php?referencia="+valor,"","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=320,left=300 top=250");

}

function generarNumero(e){

		if(e.keyCode==13){
		
		document.form1.serieDocOrigen.value=ponerCeros(document.form1.serieDocOrigen.value,3);
		
		var serieDocOrigen=document.form1.serieDocOrigen.value;
		var cod_suc_origen=document.form1.cod_suc_origen.value;
		
		
		doAjax('../peticion_ajax5.php','peticion=genNumero&serieDocOrigen='+serieDocOrigen+'&cod_suc_origen='+cod_suc_origen,'rspta_generarNumero','get','0','1','','');
		}


}

function rspta_generarNumero(data){

document.form1.numeroDocOrigen.disabled=false;
document.form1.numeroDocOrigen.value=data;
document.form1.numeroDocOrigen.focus();
document.form1.numeroDocOrigen.select();

}

function validarNumero2(control,e){
//alert(e.keyCode);
	try{
	//alert(e.keyCode);
		if((e.keyCode>=96 && e.keyCode<=105) || (e.keyCode>46 && e.keyCode<58) || e.keyCode==8 || e.keyCode==190 || e.keyCode==37 || e.keyCode==39 || e.keyCode==110){
			tempx=control.value.split(".");
			if(e.keyCode==190 || e.keyCode==110){
				if(tempx[1]!=undefined){	
					e.keyCode=0;
					event.returnValue=false;
					return false;
				}
			}
		}else{
			if(e.keyCode==13){
				
				
			}else{
				e.keyCode=0;
				event.returnValue=false;
				return false;
			}
		}
	}catch(e){
	
	}	

}

function validarNumero3(control,e){
//alert(e.keyCode);
	try{
		if((e.keyCode>=96 && e.keyCode<=105) || (e.keyCode>46 && e.keyCode<58) || e.keyCode==8  || e.keyCode==37 || e.keyCode==39 ){
			tempx=control.value.split(".");
			if(e.keyCode==190 || e.keyCode==110){
				if(tempx[1]!=undefined){	
					e.keyCode=0;
					event.returnValue=false;
					return false;
				}
			}
		}else{
			if(e.keyCode==13){
				
				
			}else{
				e.keyCode=0;
				event.returnValue=false;
				return false;
			}
		}
	}catch(e){
	
	}	

}



 function ponerCeros(obj,i) {
		//alert(obj.length);
		  while (obj.length<i){
			obj = '0'+obj;
			
			}
		//	alert(obj);
			return obj;
}


function validarNumero(e){

		if(e.keyCode==13){
		
		
		if(document.form1.sucursal2.value==0){
		alert("seleccionar la sucursal de destino ");
		document.form1.sucursal2.focus();
		return false;
		}
				
		document.form1.serieDocOrigen.value=ponerCeros(document.form1.serieDocOrigen.value,3);		
		document.form1.numeroDocOrigen.value=ponerCeros(document.form1.numeroDocOrigen.value,7);
		
		var serieDocOrigen=document.form1.serieDocOrigen.value;
		var cod_suc_origen=document.form1.cod_suc_origen.value;		
		var numeroDocOrigen=document.form1.numeroDocOrigen.value;
		
		var cod_suc_destino=document.form1.sucursal2.value;
		
		doAjax('../peticion_ajax5.php','peticion=validarNumero&serieDocOrigen='+serieDocOrigen+'&cod_suc_origen='+cod_suc_origen+'&numeroDocOrigen='+numeroDocOrigen+'&cod_suc_destino='+cod_suc_destino,'rspta_validarNumero','get','0','1','','');
		
		}

}

function rspta_validarNumero(data){
//document.form1.numeroDocOrigen.value=data;	
//alert(data);
	if(data > 0){
	alert("El Número de guia de remisión ingresado ya existe");
	document.form1.numeroDocOrigen.focus();
	document.form1.numeroDocOrigen.select();
	
	}else{
	//alert("El Número de guia de remisión ingresado esta libre");
	document.form1.numeroDocOrigen.disabled=true;
	document.form1.sucursal2.focus();
	
	}	
	
	
}

function generateCoverDiv(id, color, opacity)
{
    var navegador=1;
    if(navigator.userAgent.indexOf("MSIE")>=0) navegador=0;
    
    var layer=document.createElement('div');
    layer.id=id;
    layer.style.width=document.body.offsetWidth+'px';
    layer.style.height=document.body.offsetHeight+'px';
	//layer.style.width='100%';
	//layer.style.height='100%'
	layer.style.backgroundImage="url('../images/ui-bg_diagonals-thick_20_666666_40x40.png')";
	
    layer.style.backgroundColor=color;
    layer.style.position='absolute';
    layer.style.top=0;
    layer.style.left=0;
    layer.style.zIndex=0;
    if(navegador==0) layer.style.filter='alpha(opacity='+opacity+')';
    else layer.style.opacity=opacity/100;
    
    document.body.appendChild(layer);
} 


function entradae(objeto){
		//alert(objeto);
		
		if(document.activeElement.type=='text' || document.activeElement.type=='checkbox' ){
		//alert("");
			if(navigator.appName!='Microsoft Internet Explorer'){
			
			objeto.cells[0].childNodes[1].checked=false;
			//document.getElementById("seriesSel").value=parseFloat(document.getElementById("seriesSel").value)-1;
			}else{
			//alert(objeto.cells[0].innerHTML);
			objeto.cells[0].childNodes[0].checked=false;
			//document.getElementById("seriesSel").value=parseFloat(document.getElementById("seriesSel").value)-1;
			}
		}
		
			//alert(objeto);
			
			if(objeto.style.background=='#fff1bb'  || objeto.style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || objeto.style.background=='rgb(255, 241, 187)'){
			//alert(objeto.bgColor);
			objeto.style.background='#ffffff';
				if(navigator.appName!='Microsoft Internet Explorer'){
				objeto.cells[0].childNodes[1].checked=false;
				document.getElementById("seriesSel").value=parseFloat(document.getElementById("seriesSel").value)-1;
				}else{
				objeto.cells[0].childNodes[0].checked=false;
				document.getElementById("seriesSel").value=parseFloat(document.getElementById("seriesSel").value)-1;
				}
			
			document.getElementById('contaSerie').value=parseFloat($('#contaSerie').val()) - 1;	
			//document.getElementById("label_cant_selec").innerHTML=contorl_item_selec();
			//document.form_series.cant_selec.value=contorl_item_selec();
			}else{
			  //alert(contorl_item_selec() +" "+ document.form_series.cant_req.value);
			
			//alert(document.getElementById("seriesSel").value);				
			
			
			//if(objeto.style.background=='#ffffff'){
			document.getElementById('contaSerie').value=parseFloat($('#contaSerie').val()) + 1;	
			//}
						
			objeto.style.background='#FFF1BB';
			if(navigator.appName!='Microsoft Internet Explorer'){
			objeto.cells[0].childNodes[1].checked=true;
			document.getElementById("seriesSel").value=parseFloat(document.getElementById("seriesSel").value)+1;
			}else{
			objeto.cells[0].childNodes[0].checked=true;
			document.getElementById("seriesSel").value=parseFloat(document.getElementById("seriesSel").value)+1;
			}
			//document.getElementById("label_cant_selec").innerHTML=contorl_item_selec();
			//document.form_series.cant_selec.value=contorl_item_selec();
			}
		
	}
var j=0;	
function aceptar_sal_serie(){

			var series="";		
			var producto=$('#cod_prod_serie').val();
			
			for (var i=1;i<document.getElementById('tbl_series').rows.length;i++) {
			 			 
			  if(navigator.appName!='Microsoft Internet Explorer'){	
			        //alert(document.getElementById('tbl_series').rows[i].cells[0].childNodes[0].checked);
					if(document.getElementById('tbl_series').rows[i].cells[0].childNodes[1].checked){
					//alert(document.getElementById('tbl_series').rows[i].cells[1].childNodes[1].childNodes[1].value);
					series=series+"_"+document.getElementById('tbl_series').rows[i].cells[1].childNodes[1].childNodes[1].value;
					}
			  }else{
					if(document.getElementById('tbl_series').rows[i].cells[0].childNodes[0].checked){
					series=series+"_"+document.getElementById('tbl_series').rows[i].cells[1].innerHTML;
					
					j++;
					}			  
			  }	
				
			}
			
			if (document.form1.cantFact.length==undefined){
			document.form1.cantFact.value=j;
			}else{
			document.form1.cantFact[posActual].value=j;			
			}			
			
			doAjax('../peticion_ajax5.php','&peticion=sal_series&series='+series+'&producto='+producto,'rspta_aceptar_sal_serie','get','0','1','','');				

}	

function rspta_aceptar_sal_serie(r){
//document.form1.cantFact.focus();
//document.form1.cantFact.value=j;
j=0;

$( "#dialog" ).dialog( "close" );
}


var posActual='';
var saldoPosActual='0';
function ventanaSeries(codprod,pos,saldo){
	
		abrirPopup(codprod);
		posActual=pos;
		saldoPosActual=saldo;
		
			//for (var i=0;i<document.form1.cantFact.length;i++) {
			//alert(document.form1.cantFact[i].value);
			
			//}		
	
}

function buscarSerie(control,e){

	if(e.keyCode==13){
	
		
		for (var i=1;i<document.getElementById('tbl_series').rows.length;i++) {
			 			 
			  if(navigator.appName!='Microsoft Internet Explorer'){	
			        //alert(document.getElementById('tbl_series').rows[i].cells[0].childNodes[0].checked);
					if(document.getElementById('tbl_series').rows[i].cells[0].childNodes[1].checked){
					//alert(document.getElementById('tbl_series').rows[i].cells[1].childNodes[1].childNodes[1].value);
					series=series+"_"+document.getElementById('tbl_series').rows[i].cells[1].childNodes[1].childNodes[1].value;
					}
			  }else{
				
					if(document.getElementById('tbl_series').rows[i].cells[1].innerHTML==control.value){					
						
				var objeto=document.getElementById('tbl_series').rows[i];				
				if(objeto.style.background=='#fff1bb'  || objeto.style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || objeto.style.background=='rgb(255, 241, 187)'){
				alert("Serie ya ha sido seleccionada");
				}else{
				document.getElementById('tbl_series').rows[i].cells[0].childNodes[0].checked=true;
				document.getElementById('tbl_series').rows[i].style.background='#fff1bb';
				document.getElementById('contaSerie').value=parseFloat($('#contaSerie').val()) + 1;
				
				}	
					//document.getElementById("contaSerie").value=parseFloat(document.form1.contaSerie.value) + 1;
					
					}
					
								  
			  }	
				
			}
		
	
	}

}

function marcarAll(control){

	if(control.checked){
	
		
		for (var i=1;i<document.getElementById('tbl_series').rows.length;i++) {
			 			 
			  if(navigator.appName!='Microsoft Internet Explorer'){	
			        				
			  }else{					
				var objeto=document.getElementById('tbl_series').rows[i];
								
				if(objeto.style.background=='#fff1bb'  || objeto.style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || objeto.style.background=='rgb(255, 241, 187)'){				
				
				}else{
				document.getElementById('contaSerie').value=parseFloat($('#contaSerie').val()) + 1;
				}
				
				document.getElementById('tbl_series').rows[i].cells[0].childNodes[0].checked=true;
				document.getElementById('tbl_series').rows[i].style.background='#fff1bb';
				
												  
			  }	
				
		}
	
	
	}else{
	
		for (var i=1;i<document.getElementById('tbl_series').rows.length;i++) {
			 			 
			  if(navigator.appName!='Microsoft Internet Explorer'){	
			
				        				
			  }else{
			  
			  var objeto=document.getElementById('tbl_series').rows[i];
			  if(objeto.style.background=='#fff1bb'  || objeto.style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || objeto.style.background=='rgb(255, 241, 187)'){				
				document.getElementById('contaSerie').value=parseFloat($('#contaSerie').val()) - 1;
				}else{
				
				}
									
				document.getElementById('tbl_series').rows[i].cells[0].childNodes[0].checked=false;
				document.getElementById('tbl_series').rows[i].style.background='#ffffff';
												  
			  }	
				
		}
	
	
	
	}

}



</script>

