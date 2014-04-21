<?php 
	session_start();
	include('conex_inicial.php');

	$resultados_per = mysql_query("select * from operacion where codigo='TS' ",$cn); 
	$row_per = mysql_fetch_array($resultados_per);
	echo "<script>var prms_doc_stock='".substr($row_per['p1'],0,1)."'</script>";
	echo "<script>var prms_doc_serie='".substr($row_per['p1'],22,1)."'</script>";
	echo "<script>var prms_doc_envases='".substr($row_per['p1'],28,1)."'</script>";
	$perserie = "";
	if(substr($row_per['p1'],22,1)=="N"){
		$perserie = "disabled='disabled'";
	}
?>
<script language="javascript" src="miAJAXlib2.js"></script>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>administradores</title>

	<LINK href="pestanas/tab-view.css" type=text/css rel=stylesheet>
	<SCRIPT src="pestanas/tab-view.js" type=text/javascript></SCRIPT>
	
	<link rel="stylesheet" type="text/css" media="all" href="calendario/Style_calenda.css" title="win2k-cold-1" />
	
	
	<!--<script type="text/javascript" src="calendario/calendar.js"></script>
	<script type="text/javascript" src="calendario/lang/calendar-en.js"></script>
	<script type="text/javascript" src="calendario/calendar-setup.js"></script>-->
	
	<script type="text/javascript" src="calendario/calendar.js"></script>
	<script type="text/javascript" src="calendario/lang/calendar-en.js"></script>
	<script type="text/javascript" src="calendario/calendar-setup.js"></script>

    <script src="jquery-1.2.6.js"></script>
	
	<!--<script src="js/jquery-1.6.1.js"></script>-->
	
    <script src="jquery.hotkeys.js"></script>
	<!--<script src="mootools-comprimido-1.11.js"></script>-->
	
	<script type="text/javascript" src="modalbox/lib/prototype.js"></script>
	<script type="text/javascript" src="modalbox/lib/scriptaculous.js?load=effects"></script>
	
	<script type="text/javascript" src="modalbox/modalbox.js"></script>	
	<link rel="stylesheet" href="modalbox/modalbox.css" type="text/css" />

<script language="JavaScript"> 
//(c) 1999-2001 Zone Web 

var temporal_teclas="";
var temporal_teclas2="";

var user_tienda="<?php echo $_SESSION['user_tienda'] ?>";
var user_sucursal="<?php echo $_SESSION['user_sucursal'] ?>";

function click() { 
/*if (event.button==2) { 
//alert ('Derechos Reservados a Prolyam Software.') 
} */
} 
document.onmousedown=click 
//--> 

 jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_f6').addClass('dirty');
 
    if(document.getElementById('productos').style.visibility=='visible'){
	 document.getElementById('productos').style.visibility='hidden';
		
	}else{
	 salir_transf();
	}	
	//alert();
 return false; }); 

 jQuery(document).bind('keydown', 'f1',function (evt){jQuery('#_f6').addClass('dirty');
	//if(navigator.appName != 'Microsoft Internet Explorer'){}else{
		event.keyCode = 0;
		event.returnValue = false;
		return false;
	//}
 }); 

 jQuery(document).bind('keydown', 'f2',function (evt){jQuery('#_f6').addClass('dirty');

	 if (temporal_teclas == "") {
		var total_doc = document.form1.total_doc.value;
		temporal_teclas ='grabar';
		grabar_doc();
	}else{
		if(navigator.appName == 'Microsoft Internet Explorer'){
			event.keyCode=0;
			event.returnValue=false;
		}else{
			evt.keyCode=0;
			evt.returnValue=false;
		}
	}

 return false; });
 
 jQuery(document).bind('keydown', 'f3',function (evt){jQuery('#_f6').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
	doAjax('new_cliente.php','accion=n','nuevo_suc','get','0','1','','')
 return false; }); 
  jQuery(document).bind('keydown', 'del',function (evt){jQuery('#_del').addClass('dirty');
    if(navigator.appName == 'Microsoft Internet Explorer'){
		event.keyCode=0;
		event.returnValue=false;
	}else{
 		evt.keyCode=0;
		evt.returnValue=false;
	}
	eliminar_transf();
	
 return false; }); 
  jQuery(document).bind('keydown', 'f5',function (evt){jQuery('#_f6').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
 return false; }); 
 jQuery(document).bind('keydown', 'f6',function (evt){jQuery('#_f6').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
 return false; }); 
 
	jQuery(document).bind('keydown', 'f7',function (evt){jQuery('#_f6').addClass('dirty');
		if (temporal_teclas2=="") {
			ant_imprimir();
			temporal_teclas2='grabar';
		}else{
			if(navigator.appName == 'Microsoft Internet Explorer'){
				event.keyCode=0;
				event.returnValue=false;
			}else{
				evt.keyCode=0;
				evt.returnValue=false;
			}
		}
	return false; }); 
	
 jQuery(document).bind('keydown', 'f8',function (evt){jQuery('#_f6').addClass('dirty');
 
 	event.keyCode=0;
	event.returnValue=false;
	
	if(document.getElementById('productos').style.visibility=='visible'){
		
		   for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
			  if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb'){
			
				var temp=document.getElementById('tblproductos').rows[i].cells[0].childNodes[0].childNodes[0]
		
				//espec_prod(temp);
		//var temp3=document.getElementById('tblproductos').rows[i].cells[3].innerHTML;
				var codigo=temp.innerHTML;
				var moneda=document.form1.tmoneda.value;
				var sucursal=document.form1.sucursal.value;
				
					window.open('compras/espec_prod.php?codigo='+codigo+'&moneda='+moneda+'&sucursal='+sucursal,'','width=650,height=420,top=300,left=300,scroolbars=yes,directories=no,location=no,menubar=no,titlebar=no,toolbar=no,status=yes');	
	   
				}
			 }
		
		
		}
	
	
	
				
	
 return false; }); 
 jQuery(document).bind('keydown', 'f9',function (evt){jQuery('#_f6').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
 return false; }); 
 jQuery(document).bind('keydown', 'f10',function (evt){jQuery('#_f6').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
 return false; }); 
 </script> 

<script>
function recargar(){
location.reload();
}

function grabar_doc(){
	if(document.getElementById('items').value > 0){
			temporal_teclas='grabar';
				var total_doc=document.form1.total_doc.value;
				//if(total_doc!=0){
				
				//alert();
				var tienda=document.form1.tienda.value;
				var tienda2=document.form1.tienda2.value;
				var serie=document.form1.serie.value;
				var numero=document.form1.numero.value;
				var responsable=document.form1.responsable.value;
				var condicion=document.form1.condicion.value;
				var transportista=document.form1.transportista.value;
				var fecha=document.form1.fecha.value;
				var moneda="01";		
				
				//document.form1.accion.value="grabar";
				
				  if(document.getElementById('estado').innerHTML=="CONSULTA" || document.getElementById('estado').innerHTML=="ANULADO"){
				  alert('Este documento solo es de consulta');
				  }else{
				  
				//  alert();
		doAjax('compras/peticion_datos.php','&tienda='+tienda+'&tienda2='+tienda2+'&serie='+serie+'&numero='+numero+'&responsable='+responsable+'&condicion='+condicion+'&transportista='+transportista+'&femision='+fecha+'&tmoneda='+moneda+'&peticion=gen_transf','mostrar_grabacion','get','0','1','','');
				}

				//}else{
				//alert('No se puede guardar el documento sin  detalle');						
				//}
	}else{
		alert('documento sin items... Agregue un item');
	}	
}

function mostrar_grabacion(texto){
	if(texto=='error'){
		if(confirm('Numero documento ya fue utilizado desea asignarle un nuevo número')){
		var valor=parseFloat(document.form1.numero.value) + 1;
		document.form1.numero.value= ponerCeros(valor.toString(),7);	
		grabar_doc();	
		//return false;
		}else{
		location.reload();
		return false;
		}

	}else{
		if(texto!=''){
		var texto2=texto.split(":");
				//alert(texto);
				if(texto2[0]=='serie ingresada'){
				alert('Serie ya existe en stock.... \n Producto: '+texto2[2]+' \n Serie: ' + texto2[1]);					
				return false;
				}else{
				alert("Cantidad no corresponde con las series del producto: "+texto);
				temporal_teclas="";
				return false;
				}
		}
	
	}	

	if(document.form1.temp_imp.value=='S'){
	imprimir();
	}
	
//document.formulario.submit();	
location.reload();
//alert(texto);
}

</script>


		  <script>
		  function entrar_btn(obj){
		  obj.cells[0].style.backgroundImage="url(imagenes/bordes_boton1.gif)";
		  obj.cells[1].style.backgroundImage="url(imagenes/bordes_boton2.gif)";
		  obj.cells[2].style.backgroundImage="url(imagenes/bordes_boton2.gif)";
		  obj.cells[3].style.backgroundImage="url(imagenes/bordes_boton3.gif)";
		  
		  }
		  function salir_btn(obj){
		  obj.cells[0].style.backgroundImage="";
		  obj.cells[1].style.backgroundImage="";
		  obj.cells[2].style.backgroundImage="";
		  obj.cells[3].style.backgroundImage="";
		  
		  }
		  
		  
		  
		  </script>


<link href="styles.css" rel="stylesheet" type="text/css">

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
.Estilo12 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color:#333333 }
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo28 {color: #000000}
.Estilo15 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #990000;
}
.Estilo111 {color:#0066CC;}
.Estilo31 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FFFFFF; }
.Estilo32 {color: #FFFFFF}
.Estilo113 {	color: #CC3300;
	font-weight: bold;
	font-size: 10px;
	font-family: Arial, Helvetica, sans-serif;
}
.Estilo114 {color: #FF0000}


-->
</style>
</head>

<script>

function vaciar_sesiones(){

		var tipomov="";
		doAjax('compras/vaciar_sesiones.php','&tipomov='+tipomov,'dev_vaciar','get','0','1','','');
		

}


function iniciar(){
	if(user_tienda=='' || user_tienda=='0'){
	document.form1.tienda.focus();
	}else{
	change_tienda();
	}
}

</script>
<body bgcolor="#FFFFFF" onUnload="salir_transf();" onLoad="iniciar()">

<form name="form1" method="post" action="" onSubmit="return validar_datos();">
  <table width="756" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" >
    <tr  style="background:url(imagenes/white-top-bottom.gif)">
      <td width="1033" height="27" colspan="11" style="border:#999999"><span class="Estilo1">Log&iacute;stica :: Transferencia entre Almacenes<span class="text4">
        <input name="auxiliar" type="hidden" id="auxiliar" value="<?php echo $tipo_aux; ?>">
        <input name="saldo" type="hidden" size="10" maxlength="10">
        <input type="hidden" name="cod_transf">
		<input type="hidden" name="cod_transf2">
		<input name="series" type="hidden" id="series" value="" size="3" maxlength="3">
		<input name="pruebas" type="hidden" value='' size="5">
		<input name="serie_ing" type="hidden" id="serie_ing" value="" size="3" maxlength="3">
		<input type="hidden" name="temp_imp" id="temp_imp" value="">
		
		<input type="hidden" name="items" id="items" value="0">
				
        <input type="hidden" name="tmoneda" id="tmoneda" value="01">
        <input type="hidden" name="sucursal" id="sucursal" value="1">
		<input name="ccajas" id="ccajas" type="hidden" value="">
		<input name="esmodelo" id="esmodelo" type="hidden" value="">
		   <input name="cantModelo" id="cantModelo" type="hidden" value="">
		
      </span></span></td>
    </tr>
    <tr style="background:url(imagenes/botones.gif)">
      <td height="30" colspan="11" style="border-bottom:#CCCCCC solid 1px;" >
	  
	  <table width="663" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="71" height="31">
	
			    <table width="71" height="21" border="0" cellpadding="0" cellspacing="0">
                <tr onClick="" onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer">
                  <td width="3" ></td>
                  <td width="20" ><span class="Estilo28"><img src="imagenes/nuevo.gif" width="14" height="16"></span></td>
                  <td width="45" ><span class="Estilo28">Nuevo</span></td>
                  <td width="3" ></td>
                </tr>
              </table></td>
          <td width="82"><table title="[F2]" width="82" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="grabar_doc();">
              <td width="3" ></td>
              <td width="20" ><a href=""><span class="Estilo28"><img src="imgenes/revert.png" width="14" height="16" border="0"></span></a></td>
              <td width="55" ><span class="Estilo28">Grabar<span class="Estilo113">[F2]</span></span></td>
              <td width="4" ></td>
            </tr>
          </table></td>
          <td width="83"><table width="83" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="eliminar_transf()">
              <td width="3" ></td>
              <td width="20" ><span class="Estilo28"><img src="imgenes/eliminar.png" width="16" height="16"></span></td>
              <td width="55" ><span class="Estilo28">Eliminar<span class="Estilo113">[del/supr]</span></span></td>
              <td width="5" ></td>
            </tr>
          </table></td>
          <td width="100">
		  
		  <table width="100" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="recargar()">
              <td width="3" ></td>
              <td width="20" ><span class="Estilo28"><img src="imgenes/refresh.png" width="16" height="16"></span></td>
              <td width="74" ><span class="Estilo28">Actualizar<span class="Estilo113">[Esc]</span> </span></td>
              <td width="3" ></td>
            </tr>
          </table></td>
          <td width="92">
		   <table title="Nuevo[F3]" width="85" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="ant_imprimir()">
              <td width="3" ></td>
              <td width="20" align="center" ><img src="imgenes/fileprint.png" width="16" height="16"></td>
              <td width="59" ><span class="Estilo112">Imprimir<span class="Estilo113">[F7]</span> </span></td>
              <td width="3" ></td>
            </tr>
          </table>	
		  </td>
          <td width="235">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="10" colspan="11"></td>
    </tr>
    
    <tr bordercolor="#CCCCCC" >
      <td height="156" colspan="11" align="left"  valign="top"><table width="741" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="11" height="119" valign="top">&nbsp;</td>
          <td width="333" valign="top">
		  
		  <table bgcolor="#F3F3F3" style="border:#CCCCCC solid 1px" width="327" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="325" height="26" background="imagenes/grid3-hrow-over.gif" class="Estilo12" style="font-size:10px"><strong>Origen de Transferencia </strong></td>
            </tr>
            <tr>
              <td><table style="padding-left:5px" width="326" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="8" colspan="3" class="Estilo12"></td>
                  </tr>
                <tr>
                  <td width="57" class="Estilo12">Tienda</td>
                  <td colspan="2" class="Estilo12"><span class="Estilo15">
				  
				  <?php 
				     if($_SESSION['user_tienda']=='' || $_SESSION['user_tienda']=='0'){
					  $disabled='';
					  }else{
					  $disabled=' disabled ';
					 }
					?>
                    <select <?php echo $disabled ?> name="tienda" style="width:180" onChange="change_tienda()"  >
                      <?php 
					  
					  
		    $resultados11 = mysql_query("select * from tienda order by des_tienda ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			
			$marcar=" ";
			if($_SESSION['user_tienda']==$row11['cod_tienda']){
				$marcar=" selected ";		
			}
		  ?>
		  		
		  
                      <option <?php echo $marcar; ?> value="<?php echo $row11['cod_tienda']?>"><?php echo $row11['des_tienda'];?></option>
                      <?php }?>
                    </select>
                  </span></td>
                </tr>
                <tr>
                  <td height="24"><span class="Estilo12">N&uacute;mero 
                    
                  </span></td>
                  <td width="132"><span class="Estilo12">
                    <input <?php echo $perserie; ?> name="serie" type="text" size="4" maxlength="3" onKeyUp="generar_ceros(event,3,'serie')">
                    <input  autocomplete="OFF" disabled="disabled" name="numero" type="text" size="10" maxlength="7" onKeyUp="generar_ceros(event,7,'correlativo')">
                  </span></td>
                  <td width="137"><span class="Estilo12">Fecha
                    <input id="fecha" name="fecha" type="text" size="10" maxlength="10" value="<?php echo date('d-m-Y')?>" onKeyUp="generar_ceros(event,3,'fecha')">
                    <button type="reset" id="f_trigger_b2" style="height:18" >...</button>
                    <script type="text/javascript">
						Calendar.setup({
							inputField     :    "fecha",      
							ifFormat       :    "%d-%m-%Y",      
							showsTime      :    true,            
							button         :    "f_trigger_b2",   
							singleClick    :    true,           
							step           :    1                
						});
	
	
	function remover_item(){
		
	//	alert();
		var j="";
	
	    for (i=0;i<document.form1.tienda.options.length;i++)
        {
		
         	if ((document.form1.tienda.options[i].value==document.form1.tienda.value) || (document.form1.tienda.options[i].value.substring(0,1)!=document.form1.tienda.value.substring(0,1) ) )  {
			 //j=j+"|"+i;
			 	//if(document.form1.tienda.options[i].value==document.form1.tienda.value))
			 
				 for (var m=0;m<document.form1.tienda2.options.length;m++)
					{
						if(document.form1.tienda2.options[m].value==document.form1.tienda.options[i].value){
						var aBorrar = document.forms["form1"]["tienda2"].options[m];
						aBorrar.parentNode.removeChild(aBorrar);
						}
					
					}	
			 
            }
		
		
			if(document.form1.tienda2.options.length==0){
				alert("No es posible la transferencia");
				document.form1.submit();
			}
		        
        }
			/*
			var temp=j.split("|");
			//alert(temp.length);
			for (k=1;k<temp.length;k++)
			{	
				alert(temp[k]);
				if(temp[k]!=""){
				var aBorrar = document.forms["form1"]["tienda2"].options[temp[k]];
				aBorrar.parentNode.removeChild(aBorrar);
				}
				
			}	
	       */
	 }
	 
	
                    </script>
                  </span></td>
                </tr>
                <tr>
                  <td height="24"><span class="Estilo12">Respons.</span></td>
                  <td colspan="2"><span class="Estilo15">
                    <select name="responsable" style="width:180"  >
                      <?php 
            $marcar="";
		    $resultados11 = mysql_query("select * from usuarios order by usuario ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			$marcar="";
			if($row11['codigo']==$_SESSION['codvendedor']){
			$marcar=" selected='selected' ";
			}
		  ?>
                    <option <?php echo $marcar ?> value="<?php echo $row11['codigo']?>"><?php echo $row11['usuario'];?></option>
            <?php }?>
            </select>
                  </span></td>
                  </tr>
                <tr>
                  <td height="5px" colspan="3"></td>
                  </tr>
              </table></td>
            </tr>
          </table></td>
          <td width="36"><img src="imagenes/icono_flecha_siguiente.gif" width="30" height="22"></td>
          <td width="361" valign="top"><table bgcolor="#F3F3F3" style="border:#CCCCCC solid 1px" width="327" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="325" height="26" background="imagenes/grid3-hrow-over.gif" class="Estilo12" style="font-size:10px"><strong>Destino de Mercaderia </strong></td>
            </tr>
            <tr>
              <td><table style="padding-left:10px" width="326" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="8" colspan="2" class="Estilo12"></td>
                  </tr>
                  <tr>
                    <td width="57" class="Estilo12">Tienda</td>
                    <td class="Estilo12"><span class="Estilo15">
                      <select name="tienda2" style="width:180"  >
                        <?php 
		    $resultados11 = mysql_query("select * from tienda order by des_tienda ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
		  ?>
                        <option value="<?php echo $row11['cod_tienda']?>"><?php echo $row11['des_tienda'];?></option>
                        <?php }?>
                      </select>
                    </span></td>
                  </tr>
                  <tr>
                    <td height="24"><span class="Estilo12">Condici&oacute;n </span></td>
                    <td><span class="Estilo15">
                      <select name="condicion" style="width:180"  >
                        <?php 
		    $resultados11 = mysql_query("select * from detope where documento='TS' order by descondi ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
		  ?>
                        <option value="<?php echo $row11['condicion']?>"><?php echo $row11['descondi'];?></option>
                        <?php }?>
                      </select>
                    </span></td>
                    </tr>
                  <tr>
                    <td height="24"><span class="Estilo12">Transp.</span></td>
                    <td><span class="Estilo15">
                      <select name="transportista" style="width:180"  >
                        <option value="1">transportista 1</option>
                        <option value="2">transportista 2</option>
                      </select>
                    </span></td>
                  </tr>
                  <tr>
                    <td colspan="2" height="5px"></td>
                    </tr>
              </table></td>
            </tr>
          </table>
		  
		  
		  		<?php 
			
		function php2js ($var) {

			if (is_array($var)) {
				$res = "[";
				$array = array();
				foreach ($var as $a_var) {
					$array[] = php2js($a_var);
				}
				return "[" . join(",", $array) . "]";
			}
			elseif (is_bool($var)) {
				return $var ? "true" : "false";
			}
			elseif (is_int($var) || is_integer($var) || is_double($var) || is_float($var)) {
				return $var;
			}
			elseif (is_string($var)) {
				return "\"" . addslashes(stripslashes($var)) . "\"";
			}
		
			return FALSE;
		}

			$js1 = php2js($p1); 
			$js2 = php2js($p1_cod); 
			
			
			
			?>
			
			
			<script language="JavaScript">
			var tab1 = "<?php echo $js1; ?>";
			var tab2 = "<?php echo $js2; ?>";

			</script>		  </td>
        </tr>
        <tr>
          <td height="25" valign="top">&nbsp;</td>
          <td colspan="3" rowspan="2" valign="top" class="Estilo12">
		  
		  <table width="670" id="tblCampos"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="18">&nbsp;</td>
              <td width="69">Producto</td>
              <td width="148">
			  <input type="hidden" name="uni_p" id="uni_p" value="" size="5">
			<input name="factor_p" type="hidden" id="factor_p" value="" size="5">
            <input type="hidden" name="precio_p" id="precio_p" value="" size="5">			  </td>
              <td width="147">Presentación:</td>
              <td width="72" >Cant.:</td>
              <td width="71" style="display:none" id="tdcajas1">Cajas</td>
              <td width="75">P.Costo</td>
              <td width="127"><span class="text3">&nbsp;Total:</span></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>   <input autocomplete="off"  name="codprod" id="codprod"  type="text" size="8"  onKeyUp="validartecla(event,this,'productos')" onFocus="activar2;"/>
            <script>
		  function verfactor(){
		  var codigo=document.form1.codprod.value;
		  doAjax('buscar_factor.php','&cod='+codigo,'mostrar_factor','get','0','1','','');
		  }
		  function mostrar_factor(texto){
			if(texto ==1){
			document.form1.precio.readOnly=true;
			}else{
			document.form1.precio.readOnly=false;
			}
			
			
		  }
		  
		    </script>
            <span class="Estilo15">
            <input name="pro" type="hidden" size="3"  value="0"/>
            </span></td>
              <td><span class="text3">
            <input name="termino" type="text" size="20" onFocus="" onKeyUp="">
            <span class="Estilo15"> &nbsp;
            <input name="ter" type="hidden" size="3"  value="0"/>
            </span></span></td>
              <td><span class="Estilo14"><span class="Estilo15">
           <div id="cbo_uni">
		    <select name="presentacion" style="width:140px"  id="presentacion">
			</select>
			</div>
			
          </span></span></td>
              <td ><input style=" text-align:right" name="cantidad"  type="text" size="8" onKeyUp="calc_pre_total()" /></td>
              <td style="display:none" id="tdcajas2"><input style=" text-align:right" name="pcajas"  type="text" size="8"/></td>
              <td><input  name="punit" type="text" size="8" style=" text-align:right" onKeyUp="calcular_ptotal()" /></td>
              <td><input style="font:bold; text-align:right" name="precio" type="text" size="8"   onKeyUp="calcular_cant()" />
<input  name="precio2" type="hidden" size="3"/></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="25" valign="top">&nbsp;</td>
          </tr>
        <tr>
          <td height="130" valign="top">&nbsp;</td>
          <td height="130" colspan="3" valign="top">
		  <div id="resultado">
            <table width="726" border="0" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
              <tr>
                <td width="48" height="18" align="center" bgcolor="#3366CC"><span class="Estilo31">C&oacute;digo</span></td>
                <td width="298" bgcolor="#3366CC"><span class="Estilo31">Descripci&oacute;n</span></td>
                <td width="74" align="center" bgcolor="#3366CC"><span class="Estilo31">UND</span></td>
                <td width="52" align="center" bgcolor="#3366CC"><span class="Estilo31">Cant.</span></td>
                <td width="72" bgcolor="#3366CC"><span class="Estilo32"><span class="Estilo31">P. Unit.</span></span></td>
                <td width="64" bgcolor="#3366CC"><span class="Estilo31">Total</span></td>
                <td width="51" bgcolor="#3366CC"><span class="Estilo31">Eliminar</span></td>
              </tr>
              <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
                <td align="center" bgcolor="#F5F5F5">&nbsp;</td>
                <td bgcolor="#F5F5F5">&nbsp;</td>
                <td align="right" bgcolor="#F5F5F5">&nbsp;</td>
                <td bgcolor="#F5F5F5"></td>
                <td align="right" bgcolor="#F5F5F5">&nbsp;</td>
                <td bgcolor="#F5F5F5">&nbsp;</td>
                <td align="center" bgcolor="#F5F5F5"></td>
              </tr>
              <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
                <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
                <td bgcolor="#FFFFFF">&nbsp;</td>
                <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
                <td bgcolor="#FFFFFF"></td>
                <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
                <td bgcolor="#FFFFFF"></td>
                <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
              </tr>
			  
              <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
                <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
                <td bgcolor="#FFFFFF"></td>
                <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
                <td colspan="2" bgcolor="#FFFFFF">Monto</td>
                <td align="right"><strong>
                  <input name="monto" type="text" size="10" style="text-align:right"  value="<?php echo number_format($total,2);?>"/>
                </strong></td>
                <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
              </tr>
              <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
                <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
                <td bgcolor="#FFFFFF"><input type="hidden" name="estado" value=""></td>
                <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
                <td colspan="2" bgcolor="#FFFFFF">Impuesto1(19%)</td>
                <td align="right"><strong>
                  <input name="impuesto1" type="text" size="10" style="text-align:right"  value="<?php echo number_format($total*0.19,2);?>"/>
                </strong></td>
                <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
              </tr>
              <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
                <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
                <td bgcolor="#FFFFFF"></td>
                <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
                <td colspan="2" bgcolor="#FFFFFF"><span class="Estilo111" style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold">TOTAL DOC </span></td>
                <td width="64" align="right"><strong>
                  <input name="total_doc" type="text" size="10" style="text-align:right"  value="<?php echo number_format($total+$total*0.19,2);?>"/>
                </strong></td>
                <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
              </tr>
            </table>
          
		  </div>
		  
		  </td>
        </tr>
      </table></td>
    </tr>
    <tr bordercolor="#CCCCCC" >
      <td colspan="11" align="left">
	
  </td>
    </tr>
   
    
    <tr>
      <td height="56" colspan="11"><span class="Estilo114">*Nota: Solo se permite las transferencias en una misma empresa </span></td>
    </tr>
  </table>
  
  
<div id="productos" style="position:absolute; left:50px; top:215px; width:300px; height:180px; z-index:1; visibility:hidden"> 
    
   </div>
</form>
</body>



<script>

function activar2(){
document.form1.pro.value=1;
}



function editar(){


		  for (var i=0;i<document.form1.xaux.length;i++){ 
			   if (document.form1.xaux[i].checked) {
			   var cod=document.form1.xaux[i].value;
			   break; 
			   }
			} 

doAjax('new_cliente.php','accion=e&cod='+cod,'nuevo_suc','get','0','1','','');
}

function eliminar(codigo,prod){
	if(!document.form1.codprod.disabled){	
	i=document.getElementById('items').value;
		document.getElementById('items').value=parseFloat(i)-1;
	doAjax('compras/detalle_doc.php','&trans=&incluidoigv=S&cod_delete='+codigo+'&cod='+codigo+'&codSerie='+prod,'mostrar','get','0','1',codigo,'eliminar');
	}
}


var temp="";

function entrada(objeto){
	//objeto.cells[0].childNodes[0].checked=true;
	//temp=objeto;
	
	if(tempColor==""){
	tempColor=document.getElementById('tblproductos').rows[0];
	}
	
	    tempColor.style.background='#ffffff';
		if(objeto.style.background=='#fff1bb'){
	//objeto.style.background=objeto.bgColor;
		}else{
		objeto.style.background='#fff1bb';
			if(temp!=''){
			//alert(temp.style.background);
			//alert(objeto.bgColor);
			temp.style.background=temp.bgColor;
			}
			temp=objeto;
		}
		
}


/*function entrada(objeto){

	objeto.cells[0].childNodes[0].checked=true;
//	temp=objeto;
	if(objeto.style.background=='#fff1bb'){
	//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='#FFF1BB';
	temp.style.background='#F9F9F9';
	temp=objeto;
	}

}*/

var temp_busqueda="<?php echo $_SESSION['filtro_busqueda'] ?>";
function validartecla(e,valor,temp){

	var tipomov="2";
	//document.formulario.tempauxprod.value=temp;
	var temp="productos";
	
	if(document.getElementById('productos').style.visibility=='visible'){
	temp_busqueda=document.form1.busqueda.value;
	}
	
	if ( ( (e.keyCode>=96) && (e.keyCode<=105) || (e.keyCode>=48) && (e.keyCode<=57) )  || ((e.keyCode>=65) && (e.keyCode<=90)) || e.keyCode==8 || e.keyCode==32 ) {
	doAjax('compras/lista_aux.php','&pto_venta&temp='+temp+'&tipomov='+tipomov,'listaprod','get','0','1','','');
	}
	
	//if(e.keyCode==13 && document.formulario.auxiliar2.value!="" && (document.formulario.codprod.disabled) ){
	//document.formulario.auxiliar.focus();
	//}
	
}


function listaprod(texto){

	var r = texto;
	document.getElementById('productos').innerHTML=r;
	document.getElementById('productos').style.visibility='visible';
	var valor=document.form1.codprod.value;
	
	selec_busq();

	var temp="productos";
	var tipomov="2";
	var tienda=document.form1.tienda.value;
	
	
	//-------------------------control busqueda-------------------------
			var controltipoBus=controlBusqueda(valor).split("|");
			if(controltipoBus[0]=='false'){
			return false;
			}
			valor=controltipoBus[2];
	//------------------------------------------------------------------
	
	//alert(valor)
	 var moneda_doc=document.form1.tmoneda.value;
	 var tempPreDefecto="7";	 	
	doAjax('compras/det_aux.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_busqueda+'&tipoBus='+controltipoBus[1]+'&predefecto='+tempPreDefecto+'&moneda_doc='+moneda_doc+'&ventana=transf','detalle_prod','get','0','1','','');
	
}




function detalle_prod(texto){
//alert(texto);
var r = texto;

document.getElementById('detalle').innerHTML=r;
document.getElementById('tblproductos').rows[0].style.background='#fff1bb';

temp=document.getElementById('tblproductos').rows[0];	
}

function selec_busq(){
	
	 var valor1=temp_busqueda;
     var i;
	 for (i=0;i<document.form1.busqueda.options.length;i++)
        {
		
            if (document.form1.busqueda.options[i].value==valor1)
               {
			   
               document.form1.busqueda.options[i].selected=true;
               }
        
        }
	
	}


function salir(){

	document.getElementById('productos').style.visibility='hidden';

}


jQuery(document).bind('keyup', 'down',function (evt){jQuery('#_down').addClass('dirty');

 if(document.getElementById('productos').style.visibility == 'visible'){
 //alert('entro');
	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
			
			//alert(document.getElementById('tblproductos').rows.length);
			
			//alert(document.getElementById('tblproductos').rows[i].style.background);
			
			//none repeat scroll 0% 0% rgb(0, 0, 0)
			
			if((document.getElementById('tblproductos').rows[i].style.background=='#fff1bb' || document.getElementById('tblproductos').rows[i].style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || document.getElementById('tblproductos').rows[i].style.background=='rgb(255, 241, 187)')  && (i!=document.getElementById('tblproductos').rows.length-1) ){
			
				//alert(document.getElementById('TablaDatos').rows[i].style.background);
				
				document.getElementById('tblproductos').rows[i].style.background=document.getElementById('tblproductos').rows[i].bgColor;
				
				//if(navigator.appName!='Microsoft Internet Explorer'){
				//	document.getElementById('tblproductos').rows[i+1].style.background='none repeat scroll 0% 0% rgb(255, 241, 187)';
				//}else{
					document.getElementById('tblproductos').rows[i+1].style.background='#FFF1BB';
				//}
				
				tempColor=document.getElementById('tblproductos').rows[i+1];
				
				if(i%4==0 && i!=0){
					location.href="#ancla"+i;
					document.form1.codprod.focus();
				}
				
				break;
					
			}
		}
 	}
	
	
 return false; });
 
 var tempColor="";
 
 jQuery(document).bind('keyup', 'up',function (evt){jQuery('#_up').addClass('dirty');
	//document.getElementById('TablaDatos').rows[0].style.background='#FFCC00';
	if(document.getElementById('productos').style.visibility=='visible'){
	
	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
//	alert(document.getElementById('tblproductos').rows.length);

		if((document.getElementById('tblproductos').rows[i].style.background=='#fff1bb'  || document.getElementById('tblproductos').rows[i].style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || document.getElementById('tblproductos').rows[i].style.background=='rgb(255, 241, 187)') && (i!=0) ){
		
		document.getElementById('tblproductos').rows[i].style.background=document.getElementById('tblproductos').rows[i].bgColor;

		//if(navigator.appName!='Microsoft Internet Explorer'){
		//	document.getElementById('tblproductos').rows[i-1].style.background='none repeat scroll 0% 0% rgb(255, 241, 187)';
		//}else{
			document.getElementById('tblproductos').rows[i-1].style.background='#FFF1BB';
		//}
		
		tempColor=document.getElementById('tblproductos').rows[i-1];
		
		location.href="#ancla"+(i-1);
		document.form1.codprod.focus();
			
		if(i%4==0 && i!=0){
		//capa_desplazar = $('detalle');
		//capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y - 60);
		}
		break;
		}
	  }
   }
 
 return false; });

function isset(variable_name) {
			try {
				 if (typeof(eval(variable_name)) != 'undefined')
				 if (eval(variable_name) != null)
				 return true;
			 } catch(e) { }
			return false;
}
		   
jQuery(document).bind('keyup', 'return',function (evt){jQuery('#_return').addClass('dirty'); 

//	jQuery('#_return').addClass('dirty'); 
	//alert();
		
		
			var nombreVariable=document.getElementById('MB_frame');
			try {
				 if (typeof(eval(nombreVariable)) != 'undefined' ){
					 if (eval(nombreVariable) != null){
					return false();
					}
				}
			 } catch(e) { }
			 
			//alert(typeof(eval(nombreVariable)));
			if(isset(nombreVariable)){
			return false;
			}
		
		
		if(document.activeElement.name=='presentacion'){
		document.form1.cantidad.focus();
		return false;
		}

  	if(document.activeElement.name=='tienda' || document.activeElement.name=='responsable' || document.activeElement.name=='tienda2' || document.activeElement.name=='condicion' || document.activeElement.name=='transportista' ){
	
		cambiar_enfoque(document.activeElement);
				
	}

	
	if(document.getElementById('productos').style.visibility=='visible'){
		for (var i = 0 ; i<document.getElementById('tblproductos').rows.length ; i++) {
			 
			if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb' || document.getElementById('tblproductos').rows[i].style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || document.getElementById('tblproductos').rows[i].style.background=='rgb(255, 241, 187)'){

		if(navigator.appName!='Microsoft Internet Explorer'){
			var temp = document.getElementById('tblproductos').rows[i].cells[0].childNodes[1].childNodes[1].innerHTML;
		var temp1=document.getElementById('tblproductos').rows[i].cells[1].childNodes[1].innerHTML;	
		}else{
			var temp = document.getElementById('tblproductos').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
		var temp1=document.getElementById('tblproductos').rows[i].cells[1].childNodes[0].innerHTML;
		}
		
		//alert(temp1);
		var temp3=document.getElementById('tblproductos').rows[i].cells[3].innerHTML;
		var temp4=document.getElementById('tblproductos').rows[i].cells[4].innerHTML;

		/*var temp = $('#tblproductos tr:eq('+i+') td:eq(0) font a').html();
		var temp = $('#tblproductos tr:eq('+i+') td:eq(1) font').html();
		var temp = $('#tblproductos tr:eq('+i+') td:eq(3)').html();
		var temp = $('#tblproductos tr:eq('+i+') td:eq(4)').html();*/

	   document.form1.saldo.value=temp3;
	   
	   var unidad=temp4.split("-");
	   
	   document.form1.uni_p.value=unidad[0];
	   document.form1.factor_p.value=unidad[1];
	   document.form1.precio_p.value=unidad[2];
	 
	  //document.form1.punit.value=parseFloat(unidad[2]).toFixed(4);
	  document.form1.punit.value="0.00";
	   /* document.form1.punit.value=parseFloat(unidad[6]).toFixed(4);*/
	   document.form1.series.value=unidad[4];
	   document.form1.serie_ing.value="";
	   document.form1.pruebas.value=unidad[5];
	   
	   document.form1.esmodelo.value=unidad[20];
	   document.form1.cantModelo.value=unidad[21];
	   
	   //alert();
		document.form1.ccajas.value=unidad[18];
	   if(unidad[18]=='S'){
	    document.getElementById("tblCampos").style.width=727;
	   	document.getElementById("tdcajas1").style.display="block";
		document.getElementById("tdcajas2").style.display="block";
	   }else{
	    document.getElementById("tblCampos").style.width=670;
	   	document.getElementById("tdcajas1").style.display="none";
		document.getElementById("tdcajas2").style.display="none";
	   }
		
		
		
	  // elegir(temp,temp1);
	   var tempDes=temp1.split("|");
	   elegir(temp,tempDes[1].substring(8,tempDes[1].length));
	   
			}
		 }
	   }
	   
	   
	   if(document.form1.cantidad.value!="" && document.form1.codprod.value!="" && document.form1.punit.value!="" && document.form1.cantidad.value!=0 )
		{

					var cant=document.form1.cantidad.value;
					var saldo=document.form1.saldo.value;
					
					//alert(document.form1.presentacion.value);					
					//return false;
			        //$temp_subunidad=$_SESSION['productos3'][1][$subkey];
				    //$temp_subunidad=$temp_subunidad*($row_prod['factor']/$factor_subund);
			        //saldo=saldo*(FP/Fs)
			
						if(parseFloat(saldo) >= parseFloat(cant) || prms_doc_stock=='N' ){
						
							if(document.form1.series.value=='S' && document.form1.serie_ing.value==""){
							//alert('el producto maneja series');
							
							var cant=document.form1.cantidad.value;
							var randomnumber=Math.floor(Math.random()*99999);
							var producto=document.form1.codprod.value;
							//var fecha=document.form1.femi.value;
							var tienda=document.form1.tienda.value;
							
							//alert();
							Modalbox.show('compras/sal_series2.php?cant='+cant+'&ran='+randomnumber+'&producto='+producto+'&tienda='+tienda, {title: 'Serie de productos ( SALIDAS )', width: 500}); 	return false;
								
							}			
							
							
							if(document.activeElement.name=='cantidad'){
									
									if(document.form1.ccajas.value=='S'){
									document.form1.pcajas.focus();
									document.form1.pcajas.select();
									return false;
									}else{
										if(document.form1.serie.value=='' || document.form1.numero.value==''){
											if(user_tienda!="" && user_tienda!="0"){
												if(prms_doc_serie=="S"){
													document.form1.serie.disabled=="";
													document.form1.serie.focus();
												}else{
													var sucursal=document.form1.tienda.value.substring(0,1);
													document.form1.serie.value=document.form1.tienda.value;
													doAjax('compras/peticion_datos.php','&tienda='+document.form1.tienda.value+'&serie='+document.form1.serie.value+'&sucursal='+sucursal+'&permisoS='+prms_doc_serie+'&peticion=generar_numero_transf','rpta_gen_numero','get','0','1','','');
												}
											}else{
												alert('Debe seleccionar la tienda Origen');
												if(document.form1.tienda.disabled){
													document.form1.tienda.disabled='';
												}
												document.form1.tienda.focus();
											}
										}else{
											doAjax('compras/buscar_item.php','prod='+document.form1.codprod.value,'buscar_item2','get','0','1','','');
										}
									}
									
							}
							if(document.activeElement.name=='pcajas'){		
								if(document.form1.serie.value=='' || document.form1.numero.value==''){
									if(user_tienda!="" && user_tienda!="0"){
										if(prms_doc_serie=="S"){
											document.form1.serie.disabled=="";
											document.form1.serie.focus();
										}else{
											var sucursal=document.form1.tienda.value.substring(0,1);
											document.form1.serie.value=document.form1.tienda.value;
											doAjax('compras/peticion_datos.php','&tienda='+document.form1.tienda.value+'&serie='+document.form1.serie.value+'&sucursal='+sucursal+'&permisoS='+prms_doc_serie+'&peticion=generar_numero_transf','rpta_gen_numero','get','0','1','','');
										}
									}else{
										alert('Debe seleccionar la tienda Origen');
										if(document.form1.tienda.disabled){
											document.form1.tienda.disabled='';
										}
									document.form1.tienda.focus();
									}
								}else{
									doAjax('compras/buscar_item.php','prod='+document.form1.codprod.value,'buscar_item2','get','0','1','','');		
								}
							}				
							
						
						}else{
						
						
						alert("Producto sin Stock ... \n Stock Disponible: "+saldo);	
						document.form1.cantidad.value="";
						document.form1.codprod.value="";
						document.form1.precio.value="";
						document.form1.punit.value="";
						document.form1.codprod.select();
																
						}		
	
		}
							
return false; });
 
 
 function elegir(cod,des){
	document.form1.codprod.value=cod;
	document.form1.termino.value=des;
	document.getElementById('productos').style.visibility='hidden';
	document.form1.ter.value=0;
	//document.formulario.cantidad.value=1;
	document.form1.cantidad.disabled=false;
	document.form1.precio.readOnly=true;
	document.form1.punit.disabled=true;
	/*if(temp_busqueda=='serie'){
	document.form1.cantidad.value=1;
	//alert(document.form1.pruebas.value);
			if(document.form1.pruebas.value!=""){
			
				var producto=document.form1.codprod.value;
				var accion="";
				var series="_"+document.form1.pruebas.value;
				var tienda=document.form1.tienda.value;
									
				doAjax('compras/peticion_datos.php','&peticion=sal_series&series='+series+'&producto='+producto+'&accion='+accion+'&tienda='+tienda,'rspta_aceptar_sal_serie','get','0','1','','');
			}
		enviar();		
	}else{
	document.form1.cantidad.focus();	
	}*/
	
var uni_p=document.form1.uni_p.value;
var factor_p=document.form1.factor_p.value;
var precio_p=document.form1.precio_p.value;

doAjax('carga_cbo_uni.php','&producto='+cod+'&uni_p='+uni_p+'&factor_p='+factor_p+'&precio_p='+precio_p,'view_cbo_uni','get','0','1','','');

	
 }
 
 function view_cbo_uni(texto){
	document.getElementById('cbo_uni').innerHTML=texto;

	if(temp_busqueda=='serie'){
	//alert(temp_busqueda);
	document.form1.cantidad.value=1;
	document.form1.cantidad.disabled=true;
	calculos_pretot();
	document.form1.punit.select();
	document.form1.punit.focus();
	document.form1.serie_ing.value="S";
	}else{
	document.form1.presentacion.focus();
	}
}
 
 function calculos_pretot(){
	 	for (i=0;i<document.form1.presentacion.options.length;i++)
        {
		
         if (document.form1.presentacion.options[i].value==document.form1.presentacion.value)
            {
			   var des_pres=document.form1.presentacion.options[i].text;
            }
        
        }
		var total_precio="";	
		var precio=parseFloat(des_pres.substring(10));
			
		total_precio=parseFloat(precio);
		document.form1.punit.value=parseFloat(total_precio).toFixed(4);
			
	}
 
 function borrar() { 
		
		var n=document.form1.presentacion.options.length;
   		for (var i=0;i<n;i++)  {
		//alert(i);
        	aBorrar = document.forms["form1"]["presentacion"].options[0];
			aBorrar.parentNode.removeChild(aBorrar);
			
		}
} 

 function buscar_item2(texto){
	if(texto==0){
	enviar();
	
	}else{
	
		//if(confirm('Este item ya se encuentra ingresado en el detalle desea volver a ingresarlo? ')){
		//enviar();
		//}else{
		alert('Este item ya se encuentra ingresado en el detalle');
		document.form1.precio.value="";
		document.form1.punit.value="";
		document.form1.cantidad.value="";
		document.form1.termino.value="";
		document.form1.codprod.value="";
		document.form1.codprod.focus();
		
		//}
	
	}


 }
 
 
 
	function mostrar_precio(texto){
	//alert(texto);
		var cadena=texto.split('?');
		document.form1.precio.value=cadena[0];
		document.form1.punit.value=cadena[1];
		
	}
 
 
function enviar(){
	i=document.getElementById('items').value;
	document.getElementById('items').value=parseFloat(i)+1;
	var permiso28=prms_doc_envases;
	var pcajas=document.form1.pcajas.value;
	
	
	if(document.form1.factor_p.value>1 && document.form1.esmodelo.value=='S'){
	
		var residuo=parseFloat(document.form1.cantidad.value)%parseFloat(document.form1.cantModelo.value);
		
		if(residuo!=0){
		alert("La cantidad ingresada debe ser múltiplo mayor del producto modelo a generar");
		
		document.form1.cantidad.focus();
		document.form1.cantidad.select();
		return false;
		}
		
	}
	
	
	doAjax('compras/detalle_doc.php','&trans=&incluidoigv=S&punitario='+document.form1.punit.value+'&prod='+document.form1.codprod.value+'&cant='+document.form1.cantidad.value+'&presentacion='+document.form1.presentacion.value+'&permiso28='+permiso28+'&pcajas='+pcajas,'mostrar','get','0','1','','');			
} 
function ingEnvases(control,producto,e){
//alert(e.keyCode);
   if(e.keyCode==13){
	
	    var tc_doc="";
		var permiso4="";
		var permiso10="";
		var impto="";	
		var percep_suc="";
	    var percep_doc="";
		var min_percep_doc="";
		var est_percep_clie="";
		var por_percep_clie="";
	    var total_doc="";
		var tipomov="";
		var fechaEmi="";
        var condicion="";
		var tienda="";
		var permiso21="";//mostrar descuento
		var permiso27="";
		var permiso28=prms_doc_envases;
		var tipoDescuento="";
		
		var cantEnvases=control.value;
		
		doAjax('compras/detalle_doc.php','&trans=&incluidoigv=S&accion=cambiar_dolar&tmoneda&mon_ini&permiso4='+permiso4+'&permiso10='+permiso10+'&producto='+producto+'&ingEnvases&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov+'&fechaEmi='+fechaEmi+'&condicion='+condicion+'&tienda='+tienda+'&permiso21='+permiso21+'&permiso27='+permiso27+'&permiso28='+permiso28+'&tipoDescuento='+tipoDescuento+'&cantEnvases='+cantEnvases,'mostrar','get','0','1','','');
	
	  }else{
	  
	  control.style.background='#B0FFCC';
	  }
	   

}

function mostrar(texto) {
var r = texto;
document.getElementById('resultado').innerHTML=r;
document.getElementById('resultado').style.display="block";
document.form1.precio2.value='<?php echo $_SESSION['registro']?>';
document.form1.codprod.value="";
document.form1.cantidad.value="";
document.form1.precio.value="";
document.form1.termino.value="";
document.form1.punit.value="";
document.form1.ccajas.value="";
	
	document.getElementById("tblCampos").style.width=670;
	document.getElementById("tdcajas1").style.display="none";
	document.getElementById("tdcajas2").style.display="none";

	if(!document.form1.codprod.disabled){
	document.form1.codprod.focus();
	document.form1.pro.value=1;
	borrar();
	}
	//document.form1.accion.value="";
	//cambiar_impuesto();
		
}

  function cambiar_enfoque(control){
		//  alert(control.name);
					
			if(control.name=="tienda"){
						
			var sucursal=document.form1.tienda.value.substring(0,1);
			
			if(prms_doc_serie!="S" || (user_tienda!='' && user_tienda!='0')){
			document.form1.serie.value=document.form1.tienda.value;
			 doAjax('compras/peticion_datos.php','&tienda='+document.form1.tienda.value+'&serie='+document.form1.serie.value+'&sucursal='+sucursal+'&permisoS='+prms_doc_serie+'&peticion=generar_numero_transf','rpta_gen_numero','get','0','1','',''); 		
			}
			//document.form1.numero.focus();
			//document.form1.numero.select();		
						
			}
			if(control.name=="responsable"){	
			//document.formulario.doc.disabled=false;
			document.form1.tienda2.focus();
			//alert();
			return false;
			}
			if(control.name=="tienda2"){	
			//document.formulario.num_serie.disabled=false;
			document.form1.condicion.focus();
			return false;
			}
			
			if(control.name=="condicion"){
			//document.formulario.condicion.disabled=false;
			document.form1.transportista.focus();
			return false;
			}
			
			if(control.name=="transportista"){
			document.form1.codprod.focus();
			return false;
			
			}
			
  }
  
  
	function generar_ceros(e,ceros,control){
			var serie = document.form1.serie.value;
			var numero = document.form1.numero.value;
			var sucursal = document.form1.tienda.value.substring(0,1);
			
			
						
			if(e.keyCode == 13 ){
			
				var valor = "";
				if(control == 'serie'){
					valor = serie
				}else{
					valor = numero
				}
				
				
				valor = parseFloat(valor);
				//alert(valor);
				if(isNaN(valor)){
				alert('Por favor digite un número válido');
				return false;
				}else{
				
				valor=valor.toString();
				}
						
			
			
			   if(control=='serie'){
			   
				  			   
				   document.form1.serie.value=ponerCeros(valor,ceros);
				   
				   doAjax('compras/peticion_datos.php','&serie='+document.form1.serie.value+'&tienda='+document.form1.tienda.value+'&permisoS='+prms_doc_serie+'&sucursal='+sucursal+'&peticion=generar_numero_transf','rpta_gen_numero','get','0','1','',''); 
				  
		    	}
								
				if(control=='correlativo'){
				
					if(document.form1.numero.value!=0){
	
						document.form1.numero.value=ponerCeros(valor,ceros);
						numero=document.form1.numero.value;
						
						doAjax('compras/peticion_datos.php','&serie='+serie+'&numero='+numero+'&sucursal='+sucursal+'&peticion=buscar_transf','rpta_bus_transf','get','0','1','','');
						//alert();											
					}													
					
				}
				
				if(control=='fecha'){
				
				//document.form1.fven.disabled=false;
				
				//document.form1.codprod.focus();
				//document.form1.responsable.focus();
				
				validar_fecha_doc(control);
				
				}
				
				if(control.name=='fven'){
				document.form1.codprod.disabled=false;
				document.form1.codprod.focus();
				//document.formulario.codprod.select();
				}
							
			}
		
		}
  
 function rpta_gen_numero(texto){
		  //alert(texto);
		  if(texto.substring(0,7)!='ocupado'){ 
		  
		  //alert();
          document.form1.serie.value=ponerCeros(document.form1.serie.value,3);		
		  document.form1.numero.value=ponerCeros(texto,7);				
		  document.form1.numero.disabled=false;				
          
		  //document.form1.numero.select();	
		  
		  document.form1.numero.select();
		  document.form1.numero.focus();
		  
		   document.form1.tienda.disabled=true;
		   document.form1.serie.disabled=true;
		   remover_item();
		  //alert();
		  }else{
			  /*if(user_tienda!='' && user_tienda!='0'){
				  document.form1.serie.value=ponerCeros(valor,ceros);
				  doAjax('compras/peticion_datos.php','&serie='+document.form1.serie.value+'&tienda='+document.form1.tienda.value+'&permisoS='+prms_doc_serie+'&sucursal='+sucursal+'&peticion=generar_numero_transf','rpta_gen_numero','get','0','1','',''); 
			  }else{*/
				  var temp=texto.split("?");
		  						
				  alert('Esta tienda se encuentra realizando una transferencia por el usuario:'+temp[1]+' , seleccione otra');
				  document.form1.serie.value='';
				  //document.form1.tienda.focus();
			  //}
		  }
		  
		  
 }
 
    function ponerCeros(obj,i) {
		  while (obj.length<i){
			obj = '0'+obj;
			}
		//	alert(obj);
			return obj;
	}
 
 
	function rpta_bus_transf(texto){
	
	
	var temp=texto.split("?");
	
	if(temp[8]!=''){
	document.form1.fecha.value=temp[3].substring(0,10);
	
	//alert(temp[2]);
	seleccionar_cbo('responsable',temp[2]);
	seleccionar_cbo('tienda2',temp[7]);
	seleccionar_cbo('condicion',temp[4]);
//	seleccionar_cbo('transportista',temp[5]);
	
	document.form1.cod_transf.value=temp[8];
	document.form1.cod_transf2.value=temp[9];
	
	
	desabilitar();
	
	doAjax('compras/detalle_doc.php','&trans=&incluidoigv=&punitario='+document.form1.punit.value+'&accion=mostrarprod','mostrar','get','0','1','','');

	
	}else{
	
	document.form1.numero.disabled=true;
	//document.form1.tienda.disabled=true;
	document.form1.fecha.select();
	document.form1.fecha.focus();
	}
	
	
	
	} 
 
 	
	function seleccionar_cbo(control,valor){
		
		 var valor1=valor;
         var i;
		 
	     for (i=0;i< eval("document.form1."+control+".options.length");i++)
        {
		
		
		
         if (eval("document.form1."+control+".options[i].value")==valor1)
            {
			//alert(document.form1.responsable.options[i].value+" "+valor1);
			   eval("document.form1."+control+".options[i].selected=true");
            }
        
        }
		
	}
 
 	function desabilitar(){
	
	document.form1.tienda.disabled=true;
	document.form1.serie.disabled=true;
	document.form1.numero.disabled=true;
	document.form1.responsable.disabled=true;
	document.form1.fecha.disabled=true;
	document.form1.tienda2.disabled=true;
	document.form1.condicion.disabled=true;
	document.form1.transportista.disabled=true;
	
	document.form1.codprod.disabled=true;
	document.form1.termino.disabled=true;
	document.form1.cantidad.disabled=true;
	document.form1.punit.disabled=true;	
	//document.form1.total.disabled=true;	
	

	
	}
	
	function espec_prod(objeto){
	
	//var codigo=objeto.innerHTML;
	
	selecionarItem(objeto.parentNode.parentNode.parentNode.rowIndex);
	
	//alert(objeto.parentNode.parentNode.parentNode.rowIndex);
//	window.open('compras/espec_prod.php?codigo='+codigo,'','width=650,height=420,top=300,left=300,scroolbars=yes,directories=no,location=no,menubar=no,titlebar=no,toolbar=no,status=yes');	
	
	}
 
 var tempNivelUser="<?php echo $_SESSION['nivel_usu'] ?>";
  
 function eliminar_transf(){ 
 
 	var feli="<?php echo date("Y-m-d")?>";
  	
	if(feli!=document.form1.fecha.value && (tempNivelUser==7 ||tempNivelUser==1 || tempNivelUser==2 || tempNivelUser==6 || tempNivelUser==9 || tempNivelUser==3 || tempNivelUser==8)){
	
	alert("Este usuario solo puede eliminar documentos de la fecha actual ");
	return false;
	}
	
	
    var cod_transf=document.form1.cod_transf.value;
    var cod_transf2=document.form1.cod_transf2.value;
 	var tienda=document.form1.tienda.value;
 	var tienda2=document.form1.tienda2.value;
 
doAjax('compras/peticion_datos.php','&tienda='+tienda+'&tienda2='+tienda2+'&cod_transf='+cod_transf+'&cod_transf2='+cod_transf2+'&peticion=eliminar_transf','rspta_eliminar_transf','get','0','1','','');
 	
	
	
 }
  
 function rspta_eliminar_transf(texto){
 
	 if(texto==""){
	 	location.reload();
	 }else{
	 	alert("Una de las series ya tiene salida no se puede eliminar");
	 }		
	 
 }
 
 function change_tienda(){
 
			 var sucursal=document.form1.tienda.value.substring(0,1);
			if(prms_doc_serie!="S"  || (user_tienda!='' && user_tienda!='0')){
			document.form1.serie.value=document.form1.tienda.value;
			 doAjax('compras/peticion_datos.php','&tienda='+document.form1.tienda.value+'&serie='+document.form1.serie.value+'&sucursal='+sucursal+'&permisoS='+prms_doc_serie+'&peticion=generar_numero_transf','rpta_gen_numero','get','0','1','',''); 		
			}else{
				document.form1.serie.focus();
				document.form1.serie.select();
			}
		//	document.form1.numero.focus();
		//	document.form1.numero.select();	
 
 }
 
 function salir_transf(){
 
	 if(document.form1.numero.value!=''){
	  doAjax('compras/peticion_datos.php','&tienda='+document.form1.tienda.value+'&peticion=salir_transf','rpta_salir','get','0','1','','');
	  }else{
	   recargar();
	  }
  
  }
 
 function rpta_salir(texto){
 recargar();
 }
 
	function enfocar_codprod(){
	var pagina = self.location.href.match( /\/([^/]+)$/ )[1];
		if(pagina=='transferencia.php'){
		document.form1.codprod.focus();document.form1.codprod.select();
		}else{
		document.formulario.codprod.focus();document.formulario.codprod.select();
		}
	}
 
 function buscar_serie(serie,e){
		if(e.keyCode==13){	
			var temp='N';
			//alert(serie.value+ " "+ document.getElementById('tbl_series').rows[i].cells[1].innerHTML);
			
			if(contorl_item_selec()==document.form_series.cant_req.value){
			
				if(confirm('Cantidad de item ya ha sido completada desea seguir agregando mas items....')){
				
				}else{
				return false;
				}
			
			}	
							
				for (var i=1;i<document.getElementById('tbl_series').rows.length;i++) { 
					if(document.getElementById('tbl_series').rows[i].cells[1].childNodes[0].innerHTML==serie.value){
					
					document.getElementById('tbl_series').rows[i].style.background='#fff1bb';
					document.getElementById('tbl_series').rows[i].cells[0].childNodes[0].checked=true;
					document.getElementById("label_cant_selec").innerHTML=contorl_item_selec();
					document.form_series.cant_selec.value=contorl_item_selec();
					//alert(document.getElementById('tbl_series').rows[i].cells[0].innerHTML);
					document.form_series.scanner.focus();
					document.form_series.scanner.select();
					temp='S';
					return false;
					}
				}
				if(temp=='N'){
				alert('serie no encontrada');
				document.form_series.scanner.focus();
				document.form_series.scanner.select();
				}		
					
			}
			
			
			return false;
	
 }
 
 function contorl_item_selec(){
	
		var contador=0;
		for (var i=1;i<document.getElementById('tbl_series').rows.length;i++) {
		
			if(document.getElementById('tbl_series').rows[i].cells[0].childNodes[0].checked){
				contador++;
			}
		}
		return contador;
 }
 
 function cambiar_fondo(control,evento){
	
	if(evento=='e')
	control.style.backgroundImage='url(imagenes/boton_aplicar2.gif)';
	else
	control.style.backgroundImage='url(imagenes/boton_aplicar.gif)';
	
	
}

function entradae(objeto){
	
		if(document.activeElement.type=='text' || document.activeElement.type=='checkbox' ){
		objeto.cells[0].childNodes[0].checked=false;
		}
		//alert(objeto.innerHTML);
			if(objeto.style.background=='#fff1bb'){
		//	alert('rrr');
			objeto.style.background=objeto.bgColor;
			objeto.cells[0].childNodes[0].checked=false;
			document.getElementById("label_cant_selec").innerHTML=contorl_item_selec();
			document.form_series.cant_selec.value=contorl_item_selec();
			}else{
			
				if(contorl_item_selec()==document.form_series.cant_req.value ){
					
					if(document.form_series.accion_series.value=='editar'){
					alert('Solo puede cambiar el número de serie');
					return false;
					}
									
					if(confirm('Cantidad de item ya ha sido completada..... desea seguir agregando mas items?')){
					}else{
					return false;
					}
				}else{
				
				}
				
			objeto.style.background='#FFF1BB';
			objeto.cells[0].childNodes[0].checked=true;
			document.getElementById("label_cant_selec").innerHTML=contorl_item_selec();
			document.form_series.cant_selec.value=contorl_item_selec();
			}
	
}

	function aceptar_sal_serie(){
		
		var accion=document.form_series.accion_series.value;
		var tienda=document.form1.tienda.value;
		
		if(accion=='editar'){
				if(contorl_item_selec()!=document.form_series.cant_req.value){
				alert('Solo puede cambiar el numero de serie');
				return false;
				}
			
		document.form1.codprod.focus();
		}else{
		document.form1.cantidad.value=document.form_series.cant_selec.value;
		calc_pre_total()
		
		document.form1.cantidad.focus();
		document.form1.cantidad.select();
		
		}
		var producto=document.form_series.codprod2.value;	
			
		
		var series="";
		
		
			for (var i=1;i<document.getElementById('tbl_series').rows.length;i++) {
			 
				if(document.getElementById('tbl_series').rows[i].cells[0].childNodes[0].checked){
				series=series+"_"+document.getElementById('tbl_series').rows[i].cells[1].childNodes[0].innerHTML;
				}
			}
//		alert(document.getElementById('tbl_series').rows[i].cells[2].childNodes[0].innerHTML);
		
		if(series!=""){	
		
		doAjax('compras/peticion_datos.php','&peticion=sal_series&series='+series+'&producto='+producto+'&accion='+accion+'&tienda='+tienda,'rspta_aceptar_sal_serie','get','0','1','','');
		}else{
			alert("No ha ingresado ningun número de serie..");
			return false;
		}
				
		
	}
	
	function rspta_aceptar_sal_serie(texto){
	//alert(texto);
	document.form1.serie_ing.value="S";
		if(document.form1.pruebas.value==""){
		Modalbox.hide();
		
		}
	document.form1.pruebas.value="";
		
	}

	function calc_pre_total(){
	//document.form1.precio.value=document.form1.cantidad.value*document.form1.punit.value;
	
	var totalitem=document.form1.punit.value*document.form1.cantidad.value;
	document.form1.precio.value=(Math.round((totalitem)*1000)/1000).toFixed(4);	
	}
	
	function editar_serie(codprod,control){	
	var tipomov=2
	var randomnumber=Math.floor(Math.random()*99999);
	var cantidad=control.innerHTML;
	var estado_doc=document.getElementById('estado').innerHTML;
//	var temp_doc=document.form1.temp_doc.value;
	var temp_doc="";
	var tienda=document.form1.tienda.value;
			
	Modalbox.show('compras/sal_series2.php?accion=editar&ran='+randomnumber+'&producto='+codprod+'&cant='+cantidad+'&estado_doc='+estado_doc+'&temp_doc='+temp_doc+'&tienda='+tienda, {title: 'Serie de productos ( Salidas )', width: 500}); 
	}
	
	function ant_imprimir(){
	//var formato=find_prm(tab_formato,tab_cod);
	var formato="fmto_transferencia.php";
	
	if(formato==''){
	alert('Este tipo de documento no tiene asignado un formato de impresión');
	return false;
	}
					
	var tienda=document.form1.tienda2.value;
	var serie=document.form1.serie.value;
	var numero=document.form1.numero.value;
	
	var temp=document.getElementById('detalle_doc_gen').rows.length;
	
		
		if(serie!='' && document.form1.serie.disabled && document.form1.tienda2.disabled && tienda!="0" && numero!='' && temp>1 ){
		
		//alert('imprimir')
		imprimir();
		
		}else{
	
		document.form1.temp_imp.value='S';
	//	alert('grabar');
		grabar_doc();
								
		}	
	
	}
	
	
	function imprimir(){
	
	//var sucursal=document.form1.sucursal.value;
	
	var doc="TS";
	var serie=document.form1.serie.value;
	var numero=document.form1.numero.value;
	var tienda=document.form1.tienda.value;
	var tienda2=document.form1.tienda2.value;
		
	var formato="rpt_transferencia.php";
	//var impresion=find_prm(tab_impresion,tab_cod);
	var impresion="";
	var temp=document.getElementById('detalle_doc_gen').rows.length;
		
	if(serie!='' && document.form1.serie.disabled && temp>1 && formato!=''){ 
	var win00=window.open('formatos/'+formato+'?tienda='+tienda+'&tienda2='+tienda2+'&doc='+doc+'&serie='+serie+'&numero='+numero+'&impresion='+impresion ,'ventana2','width=850,height=600,top=100,left=100,scroolbars=yes status=yes');	
	
	win00.focus();
	
	}else{
	alert('No es posible imprimir');
	}
	
}

 function esInteger(e,t) {
	//alert(e.keyCode);
	var charCode 
	charCode = e.keyCode 
	//status = charCode 
	
	if(t==1){
	var tempcharCode=47;
	var tempcharCode2=46;
	}else{
	var tempcharCode=40;
	var tempcharCode2=48;
	} 
	//alert(tempcharCode);
	if (charCode > 31 && (charCode < tempcharCode2 || charCode > 57 || charCode==tempcharCode)) {
	return false
	}
	return true
}


function selecionarItem(indice){

//if(document.getElementById('productos').style.visibility=='visible'){
	//	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
		//	if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb'){
			
		if(navigator.appName!='Microsoft Internet Explorer'){
		var temp=document.getElementById('tblproductos').rows[indice].cells[0].childNodes[1].childNodes[1].innerHTML;
		var temp1=document.getElementById('tblproductos').rows[indice].cells[1].childNodes[1].innerHTML;
		
		}else{	
		var temp=document.getElementById('tblproductos').rows[indice].cells[0].childNodes[0].childNodes[0].innerHTML;
		var temp1=document.getElementById('tblproductos').rows[indice].cells[1].childNodes[0].innerHTML;
		}
		
		
		
		var cadena=document.getElementById('tblproductos').rows[indice].cells[3].innerHTML;
		var temp_prod=document.getElementById('tblproductos').rows[indice].cells[4].innerHTML.split("-");
		var temp4=document.getElementById('tblproductos').rows[indice].cells[4].innerHTML;
        var unidad=temp4.split("-");
		
		document.form1.series.value=unidad[4];
  		
		var total_precio="";	
		var precio=parseFloat(temp_prod[2]);
		var prod_moneda=parseFloat(temp_prod[3]);
			
			total_precio=precio;
			//alert(total_precio);
			/*
			if(prod_moneda==01 && document.getElementById('moneda').innerHTML=='(US$.)'){
			
			total_precio=parseFloat(total_precio/tc_doc).toFixed(4);
			}else{
			//alert();
				if(prod_moneda==02 && document.getElementById('moneda').innerHTML=='(S/.)'){
				//alert();
				total_precio=parseFloat(total_precio*tc_doc).toFixed(4);
				}
			
			}
			*/
//alert();

	   document.form1.uni_p.value=unidad[0];
	   document.form1.factor_p.value=unidad[1];
	   document.form1.precio_p.value=unidad[2];
		document.form1.serie_ing.value="";	
		//alert(temp_prod[3]);			
		document.form1.punit.value=total_precio;
	//	document.form1.prod_moneda.value=temp_prod[3];
	//	document.form1.unidad.value=temp_prod[2];
	//	document.form1.precio_prod.value=precio;
		document.form1.saldo.value=cadena;
		
		//document.form1.codBarraEnc.value=temp_prod[13];
		  var tempDes=temp1.split("|");
	   elegir(temp,tempDes[1].substring(8,tempDes[1].length));
		//elegir(temp);
		
			//}
		//}
		
	//} 


}

function controlBusqueda(valor){

			var tipoBus="";
			var tempValor=valor;
			var estado=true;
			//cancel_peticion()
			//alert(valor.value.substring(0,1));
			if(tempValor.substring(0,1)=='*' || tempValor.substring(0,2)=='**'){
				if(tempValor.length<5){
				estado=false;
				}
				tipoBus="aprox";
				//alert(tempValor.substring(0,2));
				if(tempValor.substring(0,2)=='**')
				tempValor=tempValor.substring(2,tempValor.length);
				else
				tempValor=tempValor.substring(1,tempValor.length);
			}else{
				tipoBus="ini";
				if(tempValor.length<3){
				estado=false;
				}	
			}
			//alert(estado+"|"+tipoBus+"|"+tempValor);
			return estado+"|"+tipoBus+"|"+tempValor;
			
}

function recalcular_precios(control,producto,e,precosto,mon_prod,pre_actual){

}

function validar_fecha_doc(objeto){
	
	var objeto=document.form1.fecha;
	
	document.form1.responsable.focus();
		
	if(objeto.value.length==8){
	var dia=objeto.value.substr(0,2);
	var mes=objeto.value.substr(2,2);
	var anio=objeto.value.substr(4,4);
	var fechaNueva=dia+"-"+mes+"-"+anio;
	//alert(fechaNueva);
	objeto.value=fechaNueva;
	}


	var array_fecha=objeto.value.split("-");
	//alert(array_fecha.length);
	
		if(array_fecha.length==3){
		
				//alert(!isNaN(array_fecha[2]));
				if( !isNaN(array_fecha[0]) && !isNaN(array_fecha[1]) && !isNaN(array_fecha[2]) && array_fecha[0].length==2 && array_fecha[1].length==2 && array_fecha[2].length==4 ){
				
				if( (array_fecha[0]>0 && array_fecha[0]<32) &&  (array_fecha[1]>0 && array_fecha[1]<13) && (array_fecha[2]>2000 && array_fecha[2]<2100) ){
				
					if(objeto.name=='femi'){
					/*
						document.formulario.fven.disabled=false;
						document.getElementById("f_trigger_b1").disabled=false;
						document.formulario.femi.disabled=true;
						document.getElementById("f_trigger_b2").disabled=true;
						
						var texto=document.formulario.condicion.options[document.formulario.condicion.selectedIndex].text;
						
						
						var temp=texto.split(" ");
						if(isNaN(parseInt(temp[1]))){
						document.formulario.fven.value=document.formulario.femi.value;
						}
						
						document.formulario.fven.select();
						document.formulario.fven.focus();
						*/
					}else{
							/*					
						var myDate1 = new Date(objeto.value);
						var myDate2 = new Date(document.formulario.femi.value);
						//alert(myDate1 +" "+ myDate2);
						if(compare_dates(objeto.value,document.formulario.femi.value)){
												
				//			if(objeto.value >= document.formulario.femi.value){
							document.formulario.codprod.disabled=false;
							document.formulario.punit.disabled=false;
							document.formulario.cantidad.disabled=false;
							document.formulario.notas.disabled=false;
							document.formulario.termino.disabled=false;
							
							document.formulario.codprod.focus();
							document.formulario.fven.disabled=true;
							document.getElementById("f_trigger_b1").disabled=true;
							}else{
							alert("La fecha de vencimiento no puede ser menor a la fecha de emisión");
							document.formulario.fven.select();
							document.formulario.fven.focus();
							}
							*/
					}		
				
				
				}else{
				alert("Fecha no valida");
				objeto.select();
				objeto.focus();								
				}						
				
			}else{
			alert("El formato de fecha no es correcto");
			objeto.select();
		    objeto.focus();				
			}			
		
		}else{
		alert("Fecha incorrecta");
		objeto.select();
		objeto.focus();				
		}	
}

function prev_validarNumero2(control,e,unidad){

	if(unidad=='07'){
	var ok=validarNumero1(control,e)// solo enteros
	}else{
	var ok=validarNumero2(control,e)// con decimales
	}
	
}

function validarNumero1(control,e){
//alert(e.keyCode);
	try{
		if((e.keyCode>=96 && e.keyCode<=105) || (e.keyCode>46 && e.keyCode<58) || e.keyCode==8  || e.keyCode==37 || e.keyCode==39 ){
			temp=control.value.split(".");
			if(e.keyCode==190 || e.keyCode==110){
				if(temp[1]!=undefined){	
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

function validarNumero2(control,e){
//alert(e.keyCode);
	try{
	//alert(e.keyCode);
		if((e.keyCode>=96 && e.keyCode<=105) || (e.keyCode>46 && e.keyCode<58) || e.keyCode==8 || e.keyCode==190 || e.keyCode==37 || e.keyCode==39 || e.keyCode==110){
			temp=control.value.split(".");
			if(e.keyCode==190 || e.keyCode==110){
				if(temp[1]!=undefined){	
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

function recalcular_cant(){}


 </script>
</html>