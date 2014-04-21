<?php 
session_start();
include('../conex_inicial.php');

$archivo="1.txt";

$fa=fopen($archivo,"w+"); 
fwrite($fa,""); 
fclose($fa);


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head >
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>

<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>

<!--
<script type="text/javascript" src="../jquery-1.3.2.min.js"></script>
<script language="javascript">
$(document).ready(function() {
	$(".botonExcel").click(function(event) {
		$("#datos_a_enviar").val( $("<div>").append( $("#movProd").eq(0).clone()).html());
		//$("#fecha1").val();
		$("#form1").submit();
});
});
</script>
-->
    
	<link href="../js/css/ui-lightness/jquery-ui-1.9.1.custom.css" rel="stylesheet">
	<script src="../js/js/jquery-1.8.2.js"></script>
	<script src="../js/js/jquery-ui-1.9.1.custom.js"></script>
	
	 <script>
	$(function() {
						
		$( "#dialog" ).dialog({
			autoOpen: false,
			width: 540,
			buttons: [
				{
					text: "Guardar",
					click: function() {
						guardar_cuentaProd();
						//$('div#dialog').html('');
						//$( this ).dialog( "close" );
						alert("Se Guardaron los Cambios");
						
					}
				},
				{
					text: "Cancel",
					click: function() {
						$('div#dialog').html('');
						$( this ).dialog( "close" );
						
					}
				}
			]
		});

		// Link to open the dialog	
		
	});
	</script>

 
 <script>  
 
var  myVar='';
 
 $(document).ready(function(){
	     $( "#dialog" ).dialog({
			       autoOpen: false,
				   modal: true,
				    height: 340,	
				   width: 520	
	    });
		
		
		
		$( "#opener1" ).click(function(){			
			$( "#dialog" ).dialog( "open" );
		});
		
		$( "#opener2" ).click(function(){			
			$( "#dialog" ).dialog( "open" );
		});
		
		$( "#opener3" ).click(function(){			
			$( "#dialog" ).dialog( "open" );
		});		
		
		$( "#opener1" ).click(function(){
		   cargar_lista('1'); //clasificacion
		});
		
		$( "#opener2" ).click(function(){		 
		  cargar_lista('2'); //Unidades  
		});

		$( "#opener3" ).click(function(){		 
		  cargar_lista('3'); //Condicion  
		});		
});


function cargar_lista(aplicacion){

			$('#aplicacion').val(aplicacion);
			
  			var contenidoAjax = $('div#dialog').html('<p align="center"><img src="../imgenes/loader.gif" /></p>');
		    $.ajax({
			type : "POST",
			url : "../peticion_ajax5.php",
			data  : 'peticion=lisCuentaSunat&aplicacion='+aplicacion ,
			success : function(data) {
				
				contenidoAjax.html(data);
			  //alert(data);
			  //document.getElementById("dialog").innerHTML=data;
			    }
		    });
}


function cerrar_modal_x(){
	$('div#dialog').html('');
	}

function guardar_cuentaProd(){
	
			//var aplicacion = $('#tipo :selected').val();
			var aplicacion=$('#aplicacion').val();
			//var cont=0;
			var cont; 			
			var cuentas="";
			var cuentas2="";
			var codigos="";
						
			$('div#detalle_chofer input').each(function(i){
			
				if(aplicacion=='3'){    
					if(i%3==0){							
					//alert($('#'+this.id).val());									
					cuentas=cuentas+"|"+$('#'+this.id).val();					
					}
					if(i%3==1){	
					cuentas2=cuentas2+"|"+$('#'+this.id).val();
					}
					if(i%3==2){
					codigos=codigos+"|"+$('#'+this.id).val();						
					}				
				}else{
				
					if(i%2==0){
					cuentas=cuentas+"|"+$('#'+this.id).val();	
					}else{
					codigos=codigos+"|"+$('#'+this.id).val();	
					}			
				
				}
				
			});
			
			//alert(cuentas+" ----- "+cuentas2);
			
		    $.ajax({
			type  : "POST",
			url   : "../peticion_ajax5.php",
			data  : 'peticion=saveCuentasKardex&aplicacion='+aplicacion+'&cuentas='+cuentas+'&cuentas2='+cuentas2+'&codigos='+codigos,
			success : function(data) {
				
				//alert(data);
				//contenidoAjax.html(data);
			  //alert(data);
			  //document.getElementById("dialog").innerHTML=data;
			}
		  });
	
	
	}	
		
function copiar_cuentaProd(){
	var texto = $('#txtcopiar').val();
	//var cont=0;
	//alert(texto);
	var cont; 			
	var cuentas="";
	var codigos="";
						
	$('div#detalle_chofer input').each(function(i){
		if(i%2==0){
			$('#'+this.id).val(texto);	
			//alert($('#'+this.id).val());				
		}
		//else{
			//codigos=codigos+"|"+$('#'+this.id).val();	
		//}
				
	});
			
	//alert(cuentas+" ----- "+codigos);
}


function buscarprod(control,evento){
	
	if(evento.keyCode==13){
	
		  var aplicacion = $('#tipo :selected').val();
		 //alert(control.value);
		  var contenidoAjax = $('div#dialog').html('<p align="center"><img src="imgenes/loader.gif" /></p>');
		    $.ajax({
			type : "POST",
			url : "peticion_ajax5.php",
			data  : 'peticion=lista_prod_cuentas&aplicacion='+aplicacion+'&valor='+control.value ,
			success : function(data) {
				
				contenidoAjax.html(data);
			  //alert(data);
			  //document.getElementById("dialog").innerHTML=data;
			}
		  });
		 
	}
	
	}
		 
</script>

<style type="text/css">
.botonExcel{cursor:pointer;}
</style>


<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {
	font-size: 12px;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #003366;
}
.Estilo22 {font-size: 10px}
-->
</style></head>


<link href="../styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
background-color:#F3F3F3;   
}
.Estilo2 {
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo3 {color: #000000; font-family:Verdana, Arial, Helvetica, sans-serif}
.Estilo7 {color: #333333; font-size: 10px; font-weight: bold; }


//---------------------------------------

.Estilo7 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; font-family:Verdana, Arial, Helvetica, sans-serif }
.Estilo21 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
-->
body {
background-color:#F3F3F3;   
}

.BorderTabla{border-bottom:#E8E8E8 solid 1px;}
.Estilo142 {font-size: 10px; color: #0066CC; font-weight: bold; }
</style>

<script>

var tempSucursal="<?php echo $_SESSION['user_sucursal']?>";
var tempTienda="<?php echo $_SESSION['user_tienda']?>";


function cargar_cbo(texto){
//alert(texto);
var r = texto;
document.getElementById('cbo_tienda').innerHTML=r;
document.form1.almacen.focus();
	
	//alert(tempTienda);
	if(tempTienda=='' || tempTienda=='0'){
	 document.form1.almacen.options[0].selected=true;
	}else{
	seleccionar_combo();
	}

}

var temp="";
/*function entrada(objeto){


	objeto.cells[0].childNodes[0].checked=true;
	
//	temp=objeto;
	if(objeto.style.background=='url(imagenes/sky_blue_sel.png)'){
	//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='url(imagenes/sky_blue_sel.png)';
	
	temp.style.background='#E9F3FE';
	temp=objeto;
	}

}
*/
function entrada(objeto){


	
	if(navigator.appName == 'Microsoft Internet Explorer'){
		objeto.cells[0].childNodes[0].checked=true;
	}else{
		objeto.cells[0].childNodes[1].checked=true;
	}
	
//	temp=objeto;
	if(objeto.style.background=='url(../imagenes/sky_blue_sel.png)'){
//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='url(../imagenes/sky_blue_sel.png)';
		if(temp!=''){
		//alert(temp.style.background);
		temp.style.background="#ffffff";
		}
		temp=objeto;
	}
	
}



function cargar(){
	try{
		document.getElementById('lista_productos').rows[0].style.background='url(../imagenes/sky_blue_sel.png)';
		temp=document.getElementById('lista_productos').rows[0];
		document.getElementById('lista_productos').rows[0].cells[0].childNodes[0].checked=true;

	}catch(e){
	
	}

}
</script>

<script language="javascript" src="../Finanzas/miAJAXlib3.js"></script>

<body onLoad="iniciar();">
<form id="form1" name="form1" method="post" action="../ficheroExcel2.php">

<div id="dialog" title="CONFIGURACI&Oacute;N SUNAT"> 

 
</div> 

  <table width="787" height="188" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="31" height="13">&nbsp;</td>
      <td width="750" align="center">&nbsp;</td>
      <td width="6">&nbsp;</td>
    </tr>
    <tr  style="background:url(../imagenes/white-top-bottom.gif)">
      <td height="27" colspan="11" style="border:#999999">
	  <span class="Estilo21 Estilo19 Estilo1 Estilo15"><strong> Gerencia :: Contabilidad :: Kardex Permanente 13.1
        <input name="auxiliar" type="hidden" id="auxiliar" value="<?php echo $tipo_aux; ?>">
		
		
		 <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" value="N" />
	    <input type="hidden" id="carga" name="carga" value="N" />
	    <input type="hidden" id="aplicacion" name="aplicacion" value="" />
	  </span></td>
    </tr>
    <tr>
      <td height="78">&nbsp;</td>
      <td><fieldset>
      <table width="741" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="171"><span class="Estilo7 ">Empresas</span></td>
          <td width="196"><span class="Estilo7 ">Tiendas</span></td>
          <td width="131"><span class="Estilo7 ">Rango de Fechas : </span></td>
          <td width="151">&nbsp;</td>
          <td width="92" rowspan="3" align="center">
		  <img onClick="javascript:buscar_prod()" style="cursor:pointer" src="../imgenes/procesar.gif" width="20" height="20"><br>
          <span class="Estilo3"><strong>Generar Productos</strong></span>
		  </td>
        </tr>
        <tr>
          <td height="26"><label>
            <select style="width:160"  name="sucursal" onChange="doAjax('../carga_cbo_tienda.php','&kardex=s&codsuc='+document.form1.sucursal.value,'cargar_cbo','get','0','1','','')" >
             
              <?php 
		// <option value="0">Todas</option>
		 $resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn); 
		while($row1=mysql_fetch_array($resultados1))
		{
		?>
              <option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
              <?php }?>
            </select>
          </label></td>
          <td><div id="cbo_tienda">
              <select  style="width:160" name="almacen"  onBlur="">
                <option value="0">Todas</option>
              </select>
          </div></td>
          <?php 
			$temp_fecha=date('d-m-Y');
			$fecha=explode("-",$temp_fecha);
			$fecha1='01-'.$fecha[1]."-".$fecha[2];
			//$fecha1=$fecha[0]."-".$fecha[1]."-01";
			$fecha2=$temp_fecha;
			?>
          <td colspan="2">del:
              <input name="fecha1" type="text"  id="fecha1" value="<?php echo $fecha1?>" size="10" maxlength="10"/>
              <button type="reset" id="f_trigger_b1"  style="height:18" >...</button>
            <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha1",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b1",   
        singleClick    :    true,           
        step           :    1                
    });
            </script>
              <script>
			
			function enfocar_cbo(evet){
			}
			function limpiar_enfoque(vent){
			
			}
			function cambiar_enfoque(fer){
			
			}
			
			
			</script>
            al
            <input name="fecha2" type="text" size="10" maxlength="10" id="fecha2" value="<?php echo $fecha2?>" />
            <button type="reset" id="f_trigger_b2"  style="height:18" >...</button>
            <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha2",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b2",   
        singleClick    :    true,           
        step           :    1                
    });
              </script></td>
          </tr>
        <tr>
          <td height="23"><strong class="Estilo7">Busqueda por Aprox. : </strong></td>
          <td colspan="3"><strong>
            <select name="criterio">
              <option value="idproducto">C&oacute;digo Sistema</option>
              <option value="nombre" selected>Descripci&oacute;n</option>
              <option value="cod_prod">C&oacute;digo anexo</option>
            </select>
            </strong>
              <input autocomplete="off"  name="valor" type="text" size="45" onKeyUp="buscar_prod()"></td>
          </tr>
        <tr>
          <td height="32" colspan="3"><fieldset>
          <strong class="Estilo7">C&oacute;digos Sunat  : </strong>
          &nbsp;
          <input onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(../imagenes/boton_aplicar.gif) ; cursor:pointer" type="button" value="Clasificaci&oacute;n" id="opener1" name="opener1" >
          &nbsp;&nbsp;&nbsp;
          <input onClick="editarSunat('con')" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(../imagenes/boton_aplicar.gif) ; cursor:pointer" type="button" name="opener3" id="opener3" value="Condici&oacute;n" >
          &nbsp;&nbsp;&nbsp;
          <input onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(../imagenes/boton_aplicar.gif) ; cursor:pointer" type="button" name="opener2" id="opener2" value="Unidades" >
          </fieldset></td>
          <td height="32"></td>
          <td height="32"></td>
        </tr>
      </table>
      </fieldset></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="74">&nbsp;</td>
      <td><table width="735" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr style="background:url(../imagenes/bg_contentbase4.gif); background-position:100px 50px">
          <td width="56" height="21" align="center"><span class="Estilo2">OK</span></td>
          <td width="82" align="center"><span class="Estilo2">C&oacute;digo</span></td>
          <td width="85" align="center"><span class="Estilo2">Cod.Anexo</span></td>
          <td width="375"><span class="Estilo2">Descripci&oacute;n</span></td>
          <td width="152"><span class="Estilo2">Unidad</span></td>
        </tr>
        <tr>
          <td colspan="5">
		  <div id="productos" style="width:750px; height:200px; overflow:scroll ; border:#CCCCCC solid 1px; background:#F4F4F4" >
		  <?php /*?><table  width="730" height="24" border="0" cellpadding="0" cellspacing="1" id="lista_productos">
            
			
			<?php 
			
			$strSQL="select *  from producto where kardex='S' order by nombre";
			$resultado=mysql_query($strSQL,$cn);
			while($row=mysql_fetch_array($resultado)){
			?>
			
			<tr style="background:#FFFFFF" onClick="entrada(this)" onDblClick="mostrar_kardex()">
              <td width="51" align="center"><input style="background:none; border:none;" type="radio" name="xproducto" value="<?php echo $row['idproducto']?>" /></td>
              <td width="76" align="center"><?php echo $row['idproducto']?></td>
              <td width="451" style="color:#333333"><?php echo $row['nombre']?></td>
              <td width="147"><?php 
			
			$strSQL23="select * from unidades where id='".$row['und']."' ";
			$resultado23=mysql_query($strSQL23,$cn);
			$row23=mysql_fetch_array($resultado23);
			echo $row23['descripcion'];
			  
			   ?>
			  </td>
            </tr>
			
			<?php }?>
          </table><?php */?>
		  </div>		  </td>
          </tr>
        
        <tr>
          <td colspan="5" height="5"></td>
        </tr>
        <tr>
          <td colspan="5" align="left"><table width="580" border="0" align="left" cellpadding="0" cellspacing="0">
            <tr>
              <td width="330" rowspan="2" align="left"><table width="304" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="108"><span class="Estilo142">Total Productos: </span></td>
                  <td><input style="text-align:right" name="tprod" id="tprod" type="text" size="5" value="0"></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><span class="Estilo142">Procesados:</span></td>
                  <td width="37"><input style="text-align:right" name="tproc" id="tproc" type="text" size="5"  value="0"></td>
                  <td width="159" align="center"><div id="imgCargaimg" style="visibility:hidden"><img src='../imgenes/cargando2.gif' ><span style="color:#F00">Procesando Informaci&oacute;n</span></div></td>
                </tr>
              </table></td>
              <td width="17" align="center">&nbsp;</td>
              <td width="109" height="30" align="center"><img onClick="javascript:mostrar_kardex()" style="cursor:pointer" src="../imgenes/procesar.gif" width="20" height="20"></td>
              <td width="124" rowspan="2" align="center"><table id="td_excel" width="83%" height="100%" border="0" cellpadding="0" cellspacing="0" disabled onClick="openExcel()" style="cursor:pointer">
                <tr>
                  <td height="32" align="center"><img src="../imagenes/icono-excel.gif" width="30" height="25" ></td>
                </tr>
                <tr>
                  <td align="center"><strong class="Estilo3 Estilo22">Enviar a Excel</strong></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td align="center"><span class="Estilo3 Estilo22"><strong>Procesar Kardex </strong></span></td>
              </tr>
          </table></td>
          </tr>
        <tr>
          <td colspan="5" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="5" align="center">
		  <div id="movProd" style="width:750px; height:100px; overflow:scroll ; border:#CCCCCC solid 1px; background:#F4F4F4;  display:none" >
		
		  </div>
		  </td>
        </tr>
        <tr >
          <td height="2" colspan="5" align="center" valign="middle"   style="visibility:hidden" ></td>
        </tr>
        
      </table>
	  <br>
	  
	  </td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>

<script>

function  buscar_prod(){
//alert(document.getElementById("movProd").innerHTML);
document.getElementById("movProd").innerHTML="";
tempx=0;
var criterio=document.form1.criterio.value;
doAjax('lista_prod_kardex.php','&valor='+document.form1.valor.value+'&criterio='+criterio+'&fecha1='+document.form1.fecha1.value+'&fecha2='+document.form1.fecha2.value,'mostrar_filtro','get','0','1','productos','');
}


var tempx=0
function mostrar_kardex(){
		
	//if(document.form1.sucursal.value!=0){
			 
			//for (var i=0;i<document.form1.xproducto.length;i++){ 
			  // if (document.form1.xproducto[i].checked) {
			   var codigo=document.form1.xproducto[tempx].value;
				
			   //break; 
			 //  }
				//  
			//} 
		//	alert(document.form1.xproducto.length);		
		
		
		 for (i=0;i<document.form1.sucursal.options.length;i++)
        {
		
         if (document.form1.sucursal.options[i].value==document.form1.sucursal.value)
            {
			   var des_suc=document.form1.sucursal.options[i].text;
            }
        
        }
		des_suc=des_suc.replace('&',"|");
		
		 for (i=0;i<document.form1.almacen.options.length;i++)
        {
		
         if (document.form1.almacen.options[i].value==document.form1.almacen.value){
			   var des_tie=document.form1.almacen.options[i].text;
            }
        
        }
			
	//	alert();
		
	//	window.open("resultado_kardex.php?cod_prod="+codigo+"&des_tie="+des_tie+"&des_suc="+des_suc+"&sucursal="+document.form1.sucursal.value+"&tienda="+document.form1.almacen.value+"&fecha1="+document.form1.fecha1.value+"&fecha2="+document.form1.fecha2.value,"vent","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=890, height=400,left=100 top=250");
	
	document.getElementById("imgCargaimg").style.visibility="visible";
	
	//alert(tempx+1+" <--->"+document.form1.tprod.value);
	
		if(parseFloat(document.form1.tprod.value)==tempx+1){
		var ultimoItem='S';
		}else{
		var ultimoItem='N';
		}
	
	doAjax('resultado_kardex.php',"cod_prod="+codigo+"&des_tie="+des_tie+"&des_suc="+des_suc+"&sucursal="+document.form1.sucursal.value+"&tienda="+document.form1.almacen.value+"&fecha1="+document.form1.fecha1.value+"&fecha2="+document.form1.fecha2.value+'&ultimoItem='+ultimoItem,'mostrar_filtro2','get','0','1','','');
	
	
		
	//}else{
	
//	alert('Debe seleccionar una Empresa');
	//}
	
}

function mostrar_filtro2(texto){
//document.getElementById('movProd').innerHTML=document.getElementById('movProd').innerHTML+" <br> "+texto;

	var objDiv=add_div(tempx);
	objDiv.innerHTML=texto;
	//document.form1.carga.value='N';
		
tempx=tempx+1;
	document.form1.tproc.value=tempx;
	
	if(tempx<document.form1.xproducto.length-1){
	document.form1.xproducto[tempx].checked=true;
	document.form1.xproducto[tempx].focus();
	
	document.getElementById('lista_productos').rows[tempx].style.background='url(../imagenes/sky_blue_sel.png)';
	mostrar_kardex();
	}else{
	document.getElementById("imgCargaimg").style.visibility="hidden";	
	}
	
	
	if(parseFloat(document.form1.tprod.value)==tempx){
	//document.getElementById("td_excel").style.visibility="visible";
	document.getElementById("td_excel").disabled=false;
	
	}
	
}

function mostrar_filtro(texto){
document.getElementById('productos').innerHTML=texto;
document.form1.carga.value='N';

document.form1.tprod.value=document.form1.xproducto.length-1;
cargar();
}


function add_div(op) { 
  obj=document.getElementById('movProd'); 
  //alert(obj);
  tab = document.createElement('div');
  tab.id = 'divKardex'.op;
  tab.style.padding = "1px";
  obj.appendChild(tab); 
  return tab;
  //document.getElementById('calendario').innerHTML="prueba";
 
} 


function iniciar(){
selecComboSuc();
}
function selecComboSuc(){
 	 var valor1=tempSucursal;
     var i;
	 for (i=0;i<document.form1.sucursal.options.length;i++)
        {
		
            if (document.form1.sucursal.options[i].value==valor1)
               {
			   
               document.form1.sucursal.options[i].selected=true;
               }
        
        }
		
		gene();
				
}

function gene(){
doAjax('../carga_cbo_tienda.php','&kardex=s&codsuc='+document.form1.sucursal.value,'cargar_cbo','get','0','1','','');
}


function seleccionar_combo(){

 	 var valor1=tempTienda;
     var i;
	 for (i=0;i<document.form1.almacen.options.length;i++)
        {
		
            if (document.form1.almacen.options[i].value==valor1)
               {
			   
               document.form1.almacen.options[i].selected=true;
               }        
        }
		
		document.form1.sucursal.disabled=true;
		document.form1.almacen.disabled=true;
			
}

function openExcel(){
  //window.open('data:application/vnd.ms-excel,'+document.documentElement.innerHTML);
  var ficha = document.getElementById('movPrxod');
  var ventimp = window.open('datos.php', 'popimpr');
  //ventimp.document.write( ficha.innerHTML );
  // window.open('data:application/vnd.ms-excel,' + encodeURIComponent(ficha.innerHTML));
  
}

function cambiar_fondo(control,evento){
if(evento=='e')
control.style.backgroundImage='url(../imagenes/boton_aplicar2.gif)';
else
control.style.backgroundImage='url(../imagenes/boton_aplicar.gif)';
}


function editarSunat(){

}


</script>