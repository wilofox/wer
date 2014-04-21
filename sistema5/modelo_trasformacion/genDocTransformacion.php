<?php 
session_start();
include('../conex_inicial.php');

		$resultados_per = mysql_query("select * from operacion where codigo='OR' ",$cn); 
		$row_per=mysql_fetch_array($resultados_per);
		echo "<script>var prms_doc_stock='".substr($row_per['p1'],0,1)."'</script>";
		echo "<script>var prms_doc_serie='".substr($row_per['p1'],22,1)."'</script>";
		$perserie="";
		if(substr($row_per['p1'],22,1)=="N"){
			$perserie="disabled='disabled'";
		}
?>
<script language="javascript" src="../miAJAXlib2.js"></script>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administradores</title>

<LINK href="../pestanas/tab-view.css" type=text/css rel=stylesheet>
<SCRIPT src="../pestanas/tab-view.js" type=text/javascript></SCRIPT>

<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>


    <script src="../jquery-1.2.6.js"></script>
    <script src="../jquery.hotkeys.js"></script>
	<!--<script src="mootools-comprimido-1.11.js"></script>-->
	
	<script type="text/javascript" src="../modalbox/lib/prototype.js"></script>
	<script type="text/javascript" src="../modalbox/lib/scriptaculous.js?load=effects"></script>
	
	<script type="text/javascript" src="../modalbox/modalbox.js"></script>
	<link rel="stylesheet" href="../modalbox/modalbox.css" type="text/css" />
	
	

<script language="JavaScript"> 
//(c) 1999-2001 Zone Web 
var tc_doc="<?php echo $tcambio; ?>";
var temporal_teclas="";
var temporal_teclas2="";
var temp_mon="<?=$row_per['moneda'];?>";//"01";
var user_tienda="<?php echo $_SESSION['user_tienda'] ?>";
var user_sucursal="<?php echo $_SESSION['user_sucursal'] ?>";

function click() { 
if (event.button==2) { 
//alert ('Derechos Reservados a Prolyam Software.') 
} 
} 
document.onmousedown=click 
//--> 

jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_f6').addClass('dirty');
   salir();	
 return false; }); 

 jQuery(document).bind('keydown', 'f1',function (evt){jQuery('#_f6').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
 return false; }); 
 jQuery(document).bind('keydown', 'f2',function (evt){jQuery('#_f6').addClass('dirty');
	 if (temporal_teclas=="") {
		var total_doc=document.form1.total_doc.value;
		temporal_teclas='grabar';		
		grabar_doc();			
	}else{
		event.keyCode=0;
		event.returnValue=false;
	}
 return false; });
 jQuery(document).bind('keydown', 'f3',function (evt){jQuery('#_f6').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
	doAjax('../new_cliente.php','accion=n','nuevo_suc','get','0','1','','')
 return false; }); 
  jQuery(document).bind('keydown', 'del',function (evt){jQuery('#_del').addClass('dirty');
    
 	event.keyCode=0;
	event.returnValue=false;
	
	eliminar_transf();
	
 return false; }); 
  jQuery(document).bind('keydown', 'f5',function (evt){jQuery('#_f5').addClass('dirty');
 	recalcular();
	event.keyCode=0;
	event.returnValue=false;
 return false; }); 
 jQuery(document).bind('keydown', 'f6',function (evt){jQuery('#_f6').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
 return false; }); 
 jQuery(document).bind('keydown', 'f7',function (evt){jQuery('#_f7').addClass('dirty');
   if (temporal_teclas2=="") {
 	ant_imprimir();
	temporal_teclas2='grabar';
	}else{
	event.keyCode=0;
	event.returnValue=false;
	}
	
 	
 return false; }); 
 jQuery(document).bind('keydown', 'f8',function (evt){jQuery('#_f6').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
	func_f8();		
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

if(document.getElementById('items').value==0){
	alert('Documento sin items... Agregue un item a Materia Prima');
	temporal_teclas='';
	return false;
}
if(document.getElementById('items2').value==0){
	alert('Documento sin items... Agregue un item a Producto Final');
	temporal_teclas='';
	return false;
}
	
			temporal_teclas='grabar';
				var total_doc=document.form1.total_doc.value;
				var tienda=document.form1.tienda.value;
				var tienda2=document.form1.tienda2.value;
				var serie=document.form1.serie.value;
				var numero=document.form1.numero.value;
				var responsable=document.form1.responsable.value;
				var condicion=document.form1.condicion.value;
				var transportista=document.form1.transportista.value;
				var fecha=document.form1.fecha.value;
				var moneda=document.form1.tmoneda.value;
				var total_doc2=document.form1.total_docX.value;		
				
				  if(document.getElementById('estado').innerHTML=="CONSULTA" || document.getElementById('estado').innerHTML=="ANULADO"){
				  alert('Este documento solo es de consulta');
				  }else{
		doAjax('peticion_datos.php','&tienda='+tienda+'&tienda2='+tienda2+'&serie='+serie+'&numero='+numero+'&responsable='+responsable+'&condicion='+condicion+'&transportista='+transportista+'&femision='+fecha+'&tmoneda='+moneda+'&peticion=gen_transf&total_doc='+total_doc+'&total_doc2='+total_doc2,'mostrar_grabacion','get','0','1','','');
				}
	
		
}

function mostrar_grabacion(texto){
	//alert(texto);
	if(texto=='error'){
		if(confirm('Numero documento ya fue utilizado desea asignarle un nuevo número')){
			var valor=parseFloat(document.form1.numero.value) + 1;
			document.form1.numero.value= ponerCeros(valor.toString(),7);	
			grabar_doc();			
		}else{
			location.reload();
			return false;
		}

	}else{
		/*if(texto!=''){
		var texto2=texto.split(":");
				if(texto2[0]=='serie ingresada'){
				alert('Serie ya existe en stock.... \n Producto: '+texto2[2]+' \n Serie: ' + texto2[1]);					
				return false;
				}else{
				alert("Cantidad no corresponde con las series del producto: "+texto);
				temporal_teclas="";
				return false;
				}
		}*/
	
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


<link href="../styles.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
body {
	background-image: url(../imagenes/bg3.jpg);
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
		doAjax('../compras/vaciar_sesiones.php','&tipomov='+tipomov,'dev_vaciar','get','0','1','','');
		

}


function iniciar(){
	document.form1.sucursal.focus();
	/*if(user_tienda=='' || user_tienda=='0'){
	document.form1.tienda.focus();
	}else{
	change_tienda();
	}*/
	if(temp_mon=='01'){
			document.getElementById('moneda').innerHTML='(S/.)';
			document.getElementById('moneda2').innerHTML='(S/.)';	
	}else{
			document.getElementById('moneda').innerHTML='(US$.)';
			document.getElementById('moneda2').innerHTML='(S/.)';
	}
}

</script>
<body bgcolor="#FFFFFF" onUnload="salir_transf();" onLoad="iniciar()">

<form name="form1" method="post" action="" onSubmit="return validar_datos();">
  <table width="790" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" >
    <tr  style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="1033" height="27" colspan="11" style="border:#999999"><span class="Estilo1">Log&iacute;stica :: <span class="Estilo100">Tranformaciones</span> <span class="text4">
        <input name="auxiliar" type="hidden" id="auxiliar" value="<?php echo $tipo_aux; ?>">
        <input name="saldo" type="hidden" size="10" maxlength="10">
        <input type="hidden" name="cod_transf">
		<input type="hidden" name="cod_transf2">
		<input name="series" type="hidden" id="series" value="">
		<input name="pruebas" type="hidden" value='' size="5">
		<input name="serie_ing" type="hidden" id="serie_ing" value="">
		<input type="hidden" name="temp_imp" id="temp_imp" value="">		
		<input type="hidden" name="items" id="items" value="0">		
		<input type="hidden" name="items2" id="items2" value="0">			
        <input type="hidden" name="tmoneda" id="tmoneda" value="01">
      </span></span></td>
    </tr>
    <tr style="background:url(../imagenes/botones.gif)">
      <td height="30" colspan="11" style="border-bottom:#CCCCCC solid 1px;" >
	  
	  <table width="663" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="82"><table title="Guardar [F2]" width="82" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="grabar_doc();">
              <td width="3" ></td>
              <td width="20" ><a href=""><span class="Estilo28"><img src="../imgenes/revert.png" width="14" height="16" border="0"></span></a></td>
              <td width="55" ><span class="Estilo28">Grabar<span class="Estilo113">[F2]</span></span></td>
              <td width="4" ></td>
            </tr>
          </table>	</td>
          <td width="100"><table title="Recalcular costos [F5]" width="100" height="21" border="0" cellpadding="0" cellspacing="0" >
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer;" onClick="recalcular()">
              <td width="3" ></td>
              <td width="20" ><span class="Estilo28"><img src="../imagenes/moneda.gif" width="16" height="16"></span></td>
              <td width="74" ><span class="Estilo28">R. costos<span class="Estilo113">[F5]</span> </span></td>
              <td width="3" ></td>
            </tr>
          </table></td>
          <td width="85"><table title="Imprimir [F7]" width="85" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="ant_imprimir()">
              <td width="3" ></td>
              <td width="20" align="center" ><img src="../imgenes/fileprint.png" width="16" height="16"></td>
              <td width="59" ><span class="Estilo112">Imprimir<span class="Estilo113">[F7]</span> </span></td>
              <td width="3" ></td>
            </tr>
          </table></td>
          <td width="88"><table title="Cambiar Moneda [F8]" width="80" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="func_f8()">
              <td width="3" ></td>
              <td width="16" ><span class="Estilo112"><img src="../imagenes/dolar.gif" width="15" height="15"></span></td>
              <td width="58" ><span class="Estilo112">Moneda<span class="Estilo113">[F8]</span> </span></td>
              <td width="3" ></td>
            </tr>
          </table></td>
          <td width="109"><table title="Eliminar [Supr]" width="86" height="21" border="0" cellpadding="0" cellspacing="0" >
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="eliminar_transf()">
              <td width="1" ></td>
              <td width="17" ><span class="Estilo28"><img src="../imgenes/eliminar.png" width="16" height="16"></span></td>
              <td width="65" ><span class="Estilo28">Eliminar<span class="Estilo113">[Supr]</span></span></td>
              <td width="3" ></td>
            </tr>
          </table></td>
          <td width="199">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="10" colspan="11"></td>
    </tr>
    
    <tr bordercolor="#CCCCCC" >
      <td  colspan="11" align="left"  valign="top"><table width="741" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="11" height="119" valign="top">&nbsp;</td>
          <td width="333" valign="top">
		  
		  <table bgcolor="#F3F3F3" style="border:#CCCCCC solid 1px" width="327" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="325" height="26" background="../imagenes/grid3-hrow-over.gif" class="Estilo12" style="font-size:10px"><strong>&nbsp;&nbsp;Origen de Transformaci&oacute;n </strong></td>
            </tr>
            <tr>
              <td><table style="padding-left:5px" width="326" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td colspan="3" class="Estilo12"></td>
                  </tr>
                <tr>
                  <td class="Estilo12">Empresa</td>
                  <td colspan="2" class="Estilo12">
				  
				  <select name="sucursal" id="sucursal" style="width:180" onChange="doAjax('peticion_datos.php','&peticion=cmbsucursal&codsuc='+document.form1.sucursal.value,'cargar_cmbsucursal','get','0','1','','');" >
				  
                        <?php 
		    $resultados11 = mysql_query("select * from sucursal order by des_suc ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
				if ($_SESSION['user_tienda']==$row11['cod_suc']){
					echo '<option value="'.$row11['cod_suc'].'" selected>'.$row11['des_suc'].'</option>';
				}else{
					echo '<option value="'.$row11['cod_suc'].'">'.$row11['des_suc'].'</option>';
				}
		  }?>
                      </select>
					  
					  </td>
                </tr>
                <tr>
                  <td width="57" class="Estilo12">Tienda</td>
                  <td colspan="2" class="Estilo12"><span class="Estilo15">				  
				  <?php 
				     if($_SESSION['user_tienda']=='' || $_SESSION['user_tienda']=='0'){
						 // $disabled='';
						  }else{
						  //$disabled=' disabled ';
					 }
					?>
                    <div id="cmbtienda">
					<select <?php echo $disabled ?> name="tienda" style="width:180" onChange="change_tienda()">
                      <?php 
		    $resultados11 = mysql_query("select * from tienda order by des_tienda ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){			
				if($_SESSION['user_tienda']==$row11['cod_tienda']){
					echo '<option value="'.$row11['cod_tienda'].'" selected>'.$row11['des_tienda'].'</option>';		
				}else{
					echo '<option value="'.$row11['cod_tienda'].'">'.$row11['des_tienda'].'</option>';	
				}
		  }?>
                    </select> </div>
                  </span>				 
				  </td>
                </tr>
                <tr>
                  <td><span class="Estilo12">Numero 
                    
                  </span></td>
                  <td width="132"><span class="Estilo12">
                    <input <?php echo $perserie; ?> name="serie" type="text" size="4" maxlength="3" onKeyUp="generar_ceros(event,3,'serie')">
                    <input  autocomplete="OFF" disabled="disabled" name="numero" type="text" size="10" maxlength="7" onKeyUp="generar_ceros(event,7,'correlativo')">
                  </span></td>
                  <td width="137"><span class="Estilo12">Fecha
                    <input name="fecha" type="text" size="10" maxlength="7" value="<?php echo date('d-m-Y')?>" onKeyUp="generar_ceros(event,3,'fecha')">
                    <button type="reset" id="f_trigger_b2"  style="height:18" >...</button>
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
                  <td><span class="Estilo12">Respons.</span></td>
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
                  <td colspan="3"></td>
                  </tr>
              </table></td>
            </tr>
          </table></td>
          <td width="36"><img src="../imagenes/icono_flecha_siguiente.gif" width="30" height="22"></td>
          <td width="361" valign="top"><table bgcolor="#F3F3F3" style="border:#CCCCCC solid 1px" width="327" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="325" height="26" background="../imagenes/grid3-hrow-over.gif" class="Estilo12" style="font-size:10px"><strong>&nbsp;&nbsp;Destino de Mercaderia </strong></td>
            </tr>
            <tr>
              <td><table style="padding-left:10px" width="326" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="2" class="Estilo12"></td>
                  </tr>
                  <tr>
                    <td class="Estilo12">Empresa</td>
                    <td class="Estilo12"><select name="sucursal2" id="sucursal2" style="width:180" onChange="doAjax('peticion_datos.php','&peticion=cmbsucursal2&codsuc='+document.form1.sucursal2.value+'&codtien='+document.form1.tienda.value,'cargar_cmbsucursal2','get','0','1','','');" >
                        <?php 
		    $resultados11 = mysql_query("select * from sucursal order by des_suc ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
		  ?>
                        <option value="<?php echo $row11['cod_suc']?>"><?php echo $row11['des_suc'];?></option>
                        <?php }?>
                      </select></td>
                  </tr>
                  <tr>
                    <td width="57" class="Estilo12">Tienda</td>
                    <td class="Estilo12"><span class="Estilo15">
                      <div id="cmbtienda2">
					  <select name="tienda2" style="width:180"  >
                        <?php 
		    $resultados11 = mysql_query("select * from tienda order by des_tienda ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
		  ?>
                        <option value="<?php echo $row11['cod_tienda']?>"><?php echo $row11['des_tienda'];?></option>
                        <?php }?>
                      </select></div>
                    </span></td>
                  </tr>
                  <tr>
                    <td><span class="Estilo12">Condicion </span></td>
                    <td><span class="Estilo15">
                      <select name="condicion" style="width:180"  >
                        <?php 
		    $resultados11 = mysql_query("select * from detope where documento='OR' order by descondi ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
		  ?>
                        <option value="<?php echo $row11['condicion']?>"><?php echo $row11['descondi'];?></option>
                        <?php }?>
                      </select>
                    </span></td>
                    </tr>
                  <tr>
                    <td><span class="Estilo12">Transp.</span></td>
                    <td><span class="Estilo15">
                      <select name="transportista" style="width:180"  >
                        <option value="1">transportista 1</option>
                        <option value="2">transportista 2</option>
                      </select>
                    </span></td>
                  </tr>
                  <tr>
                    <td colspan="2"></td>
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
          <td valign="top">&nbsp;</td>
          <td colspan="3" rowspan="2" valign="top" class="Estilo12"><table width="681" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td>&nbsp;</td>
              <td colspan="3"><span class="Estilo114"><b>Materia Prima a Transformar :</b></span></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td width="11">&nbsp;</td>
              <td width="81">Producto</td>
              <td width="152">
			  <input type="hidden" name="uni_p" id="uni_p" value="" size="5">
			<input name="factor_p" type="hidden" id="factor_p" value="" size="5">
            <input type="hidden" name="precio_p" id="precio_p" value="" size="5">			  </td>
              <td width="149">Presentación:</td>
              <td width="64">Cant.:</td>
              <td width="77">P.Costo</td>
              <td width="147"><span class="text3">&nbsp;Total:</span></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>   <input autocomplete="off"  name="codprod" id="codprod"  type="text" size="8"  onKeyUp="validartecla(event,this,'productos')" onFocus="activar2;"/>
            <script>
		  function verfactor(){
		  var codigo=document.form1.codprod.value;
		  doAjax('../buscar_factor.php','&cod='+codigo,'mostrar_factor','get','0','1','','');
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
              <td><input style=" text-align:right" name="cantidad"  type="text" size="8" onKeyUp="calc_pre_total()" /></td>
              <td><input  name="punit" type="text" size="8" style=" text-align:right" onKeyUp="calcular_ptotal()" /></td>
              <td><input style="font:bold; text-align:right" name="precio" type="text" size="8"   onKeyUp="calcular_cant()" />
<input  name="precio2" type="hidden" size="3"/></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td colspan="3" valign="top"><div id="resultado">
		  <table width="715" border="0" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#EBEFF0">
  <tr>
    <td width="48" height="18" align="center" bgcolor="#3366CC"><span class="Estilo31">Codigo</span></td>
    <td width="298" bgcolor="#3366CC"><span class="Estilo31">Descripci&oacute;n</span></td>
    <td width="74" align="center" bgcolor="#3366CC"><span class="Estilo31">UND</span></td>
    <td width="52" align="center" bgcolor="#3366CC"><span class="Estilo31">Cant.</span></td>
    <td width="72" bgcolor="#3366CC"><span class="Estilo32"><span class="Estilo31">P. Unit.</span></span></td>
    <td width="64" bgcolor="#3366CC"><span class="Estilo31">Total</span></td>
    <td width="51" bgcolor="#3366CC"><span class="Estilo31">E</span></td>
  </tr>
  <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
    <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF"></td>
    <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td align="center" bgcolor="#FFFFFF"></td>
  </tr>
  <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
    <td align="center" bgcolor="#EBEFF0">&nbsp;</td>
    <td bgcolor="#EBEFF0"><input type="hidden" name="estado" value=""></td>
    <td align="right" bgcolor="#EBEFF0">&nbsp;</td>
    <td bgcolor="#EBEFF0"></td>
    <td align="right" bgcolor="#EBEFF0">&nbsp;</td>
    <td bgcolor="#EBEFF0"></td>
    <td align="center" bgcolor="#EBEFF0">&nbsp;</td>
  </tr>
  <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
    <td align="center" bgcolor="#EBEFF0">&nbsp;</td>
    <td bgcolor="#EBEFF0" ></td>
    <td align="right" bgcolor="#EBEFF0">&nbsp;</td>
    <td colspan="2" bgcolor="#EBEFF0"><span class="Estilo111" style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold">TOTAL <label id="moneda">(S/.)</label></span></td>
    <td align="right" bgcolor="#EBEFF0"><strong>
      <input name="total_doc" type="text" size="10" style="text-align:right"  value="<?php echo number_format($total+$total*0.19,2);?>"/>
    </strong></td>
    <td align="center" bgcolor="#EBEFF0">&nbsp;</td>
  </tr>
</table>
		  </div></td>
        </tr>
        <tr style="display:none">
          <td height="19" valign="top">&nbsp;</td>
          <td height="19" colspan="3" valign="top">++...</td>
        </tr>
        <tr>
          <td height="19" valign="top">&nbsp;</td>
          <td height="19" colspan="3" valign="top"><table width="681" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><span class="text2"><b>Producto Final :</b></span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="11">&nbsp;</td>
    <td width="81">Producto</td>
    <td width="152"><input type="hidden" name="uni_p2" id="uni_p2" value="" size="5">
      <input name="factor_p2" type="hidden" id="factor_p2" value="" size="5">
      <input type="hidden" name="precio_p2" id="precio_p2" value="" size="5"></td>
    <td width="149">Presentaci&oacute;n:</td>
    <td width="64">Cant.:</td>
    <td width="77">P.Costo</td>
    <td width="147"><span class="text3">&nbsp;Total:</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input autocomplete="off"  name="codprod2" id="codprod2"  type="text" size="8"  onKeyUp="validartecla(event,this,'productos')" onFocus="activar2;"/>
      <span class="Estilo15">
      <input name="pro2" type="hidden" size="3"  value="0"/>
      </span></td>
    <td><span class="text3">
      <input name="termino2" type="text" size="20" onFocus="" onKeyUp="">
      <span class="Estilo15"> &nbsp;
      <input name="ter2" type="hidden" size="3"  value="0"/>
      </span></span></td>
    <td><span class="Estilo14"><span class="Estilo15">
      <div id="cbo_uni2">
		    <select name="presentacion2" style="width:140px"  id="presentacion2">
			</select>
			</div>
    </span></span></td>
    <td><input style=" text-align:right" name="cantidad2"  type="text" size="8" onKeyUp="calc_pre_total2()" /></td>
    <td><input  name="punit2" type="text" size="8" style=" text-align:right" onKeyUp="calcular_ptotal()" /></td>
    <td><input name="precioX" type="text" id="precioX" style="font:bold; text-align:right"   onKeyUp="calcular_cant()" size="8" />
      <input  name="precioX2" type="hidden" id="precioX2" size="3"/></td>
  </tr>
</table></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td colspan="3" valign="top"><div id="resultado2"><table width="715" border="0" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#EBEFF0">
            <tr>
              <td width="48" height="18" align="center" bgcolor="#3366CC"><span class="Estilo31">Codigo</span></td>
              <td width="298" bgcolor="#3366CC"><span class="Estilo31">Descripci&oacute;n</span></td>
              <td width="74" align="center" bgcolor="#3366CC"><span class="Estilo31">UND</span></td>
              <td width="52" align="center" bgcolor="#3366CC"><span class="Estilo31">Cant.</span></td>
              <td width="72" bgcolor="#3366CC"><span class="Estilo32"><span class="Estilo31">P. Unit.</span></span></td>
              <td width="64" bgcolor="#3366CC"><span class="Estilo31">Total</span></td>
              <td width="51" bgcolor="#3366CC"><span class="Estilo31">E</span></td>
            </tr>
            <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
              <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
              <td bgcolor="#FFFFFF">&nbsp;</td>
              <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
              <td bgcolor="#FFFFFF"></td>
              <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
              <td bgcolor="#FFFFFF">&nbsp;</td>
              <td align="center" bgcolor="#FFFFFF"></td>
            </tr>
            <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
              <td align="center" bgcolor="#EBEFF0">&nbsp;</td>
              <td bgcolor="#EBEFF0"><input type="hidden" name="estado2" value=""></td>
              <td align="right" bgcolor="#EBEFF0">&nbsp;</td>
              <td bgcolor="#EBEFF0"></td>
              <td align="right" bgcolor="#EBEFF0">&nbsp;</td>
              <td bgcolor="#EBEFF0"></td>
              <td align="center" bgcolor="#EBEFF0">&nbsp;</td>
            </tr>
            <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
              <td align="center" bgcolor="#EBEFF0">&nbsp;</td>
              <td bgcolor="#EBEFF0" ></td>
              <td align="right" bgcolor="#EBEFF0">&nbsp;</td>
              <td colspan="2" bgcolor="#EBEFF0"><span class="Estilo111" style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold">TOTAL <label id="moneda2">(S/.)</label> </span></td>
              <td align="right" bgcolor="#EBEFF0"><strong>
                <input name="total_doc2" type="text" id="total_doc2" style="text-align:right"  value="<?php echo number_format($total+$total*0.19,2);?>" size="10"/>
              </strong></td>
              <td align="center" bgcolor="#EBEFF0">&nbsp;</td>
            </tr>
          </table></div></td>
        </tr>
      </table></td>
    </tr>
    <tr bordercolor="#CCCCCC" >
      <td colspan="11" align="left">
	
  </td>
    </tr>
   
    
    <tr>
      <td colspan="11">&nbsp;</td>
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
				//  
			} 
			
		//	alert(cod);

doAjax('../new_cliente.php','accion=e&cod='+cod,'nuevo_suc','get','0','1','','');
}

function eliminar(codigo,prod){
	if(!document.form1.codprod.disabled){	
	i=document.getElementById('items').value;
		document.getElementById('items').value=parseFloat(i)-1;
		var moneda_doc=document.form1.tmoneda.value;
	doAjax('detalle_doc.php','&trans=&incluidoigv=S&cod_delete='+codigo+'&cod='+codigo+'&codSerie='+prod+'&tmoneda='+moneda_doc+'&mon_ini='+temp_mon,'mostrar','get','0','1',codigo,'eliminar');
	}
}
function eliminar2(codigo,prod){
	if(!document.form1.codprod2.disabled){	
	i=document.getElementById('items2').value;
		document.getElementById('items2').value=parseFloat(i)-1;
		var moneda_doc=document.form1.tmoneda.value;
		var total_mprima=document.form1.totalpagar.value
	doAjax('detalle_doc2.php','&trans=&incluidoigv=S&cod_delete='+codigo+'&cod='+codigo+'&codSerie='+prod+'&tmoneda='+moneda_doc+'&mon_ini='+temp_mon+'&total_mprima='+total_mprima,'mostrar2','get','0','1',codigo,'eliminar');
	recalcular();
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
var campoP
function validartecla(e,valor,temp){

	var tempValor=valor.value;
	campoP=valor.name;
	if(tempValor.length<3){
		return false;
	}	
				
	var tipomov="2";
	//document.formulario.tempauxprod.value=temp;
	var temp="productos";	
	if(document.getElementById('productos').style.visibility=='visible'){
		temp_busqueda=document.form1.busqueda.value;		
	}
	
	if ( ( (e.keyCode>=96) && (e.keyCode<=105) || (e.keyCode>=48) && (e.keyCode<=57) )  || ((e.keyCode>=65) && (e.keyCode<=90)) || e.keyCode==8 || e.keyCode==32 ) {
	doAjax('../compras/lista_aux.php','&temp='+temp+'&tipomov='+tipomov,'listaprod','get','0','1','','');
	}

	
}


function listaprod(texto){

	var r = texto;
	document.getElementById('productos').innerHTML=r;
	document.getElementById('presentacion').style.visibility='hidden';
	document.getElementById('presentacion2').style.visibility='hidden';	
	document.getElementById('productos').style.visibility='visible';
	if (campoP=='codprod'){
		var valor=document.form1.codprod.value;
	}else{
		var valor=document.form1.codprod2.value;
	}
	
	
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
		var moneda_doc=document.form1.tmoneda.value;  
	//alert(valor)
	doAjax('../compras/det_aux.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_busqueda+'&tipoBus='+controltipoBus[1]+'&moneda_doc='+moneda_doc+'&serie=N','detalle_prod','get','0','1','','');

}




function detalle_prod(texto){
//alert(texto);
var r = texto;
document.getElementById('detalle').innerHTML=r;
document.getElementById('tblproductos').rows[0].style.background='#fff1bb';

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
	if(document.getElementById('productos').style.visibility=='visible'){
	 	document.getElementById('productos').style.visibility='hidden';
		document.getElementById('presentacion').style.visibility='visible';
		document.getElementById('presentacion2').style.visibility='visible';	 	
	}else{
	 salir_transf();
	}
}


jQuery(document).bind('keyup', 'down',function (evt){jQuery('#_down').addClass('dirty');

 if(document.getElementById('productos').style.visibility=='visible'){
 //alert('entro');
	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
			
		//	alert(document.getElementById('tblproductos').rows.length);
			if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb' && (i!=document.getElementById('tblproductos').rows.length-1)){
			//alert(document.getElementById('TablaDatos').rows[i].style.background);
			document.getElementById('tblproductos').rows[i].style.background=document.getElementById('tblproductos').rows[i].bgColor;
			document.getElementById('tblproductos').rows[i+1].style.background='#FFF1BB';
			tempColor=document.getElementById('tblproductos').rows[i+1];
			
			if(i%4==0 && i!=0){
			location.href="#ancla"+i;
				if (campoP=='codprod'){
					document.form1.codprod.focus();
				}else{
					document.form1.codprod2.focus();
				}
			
			}
			
			break;
				
			}
		}
 	}
	
	
 return false; });
 
 var tempColor="";
 
 jQuery(document).bind('keyup', 'up',function (evt){jQuery('#_up').addClass('dirty');
	if(document.getElementById('productos').style.visibility=='visible'){
	
	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
		if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb' && (i!=0) ){
		document.getElementById('tblproductos').rows[i].style.background=document.getElementById('tblproductos').rows[i].bgColor;
		document.getElementById('tblproductos').rows[i-1].style.background='#FFF1BB';
		
		tempColor=document.getElementById('tblproductos').rows[i-1];
		
		location.href="#ancla"+(i-1);
				if (campoP=='codprod'){
					document.form1.codprod.focus();
				}else{
					document.form1.codprod2.focus();
				}
			
		if(i%4==0 && i!=0){
		//capa_desplazar = $('detalle');
		//capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y - 60);
		}
		break;
		}
	  }
   }
 
 return false; });


jQuery(document).bind('keydown', 'return',function (evt){jQuery('#_return').addClass('dirty'); 

		if(document.activeElement.name=='presentacion'){
			document.form1.cantidad.focus();
			return false;
		}
		if(document.activeElement.name=='presentacion2'){
			document.form1.cantidad2.focus();
			return false;
		}
		
  	if(document.activeElement.name=='sucursal' || document.activeElement.name=='tienda' || document.activeElement.name=='responsable' || document.activeElement.name=='sucursal2' || document.activeElement.name=='tienda2' || document.activeElement.name=='condicion' || document.activeElement.name=='transportista' ){
		cambiar_enfoque(document.activeElement);
	}


		
	if(document.getElementById('productos').style.visibility=='visible'){
		for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
			if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb'){
			
		var temp=document.getElementById('tblproductos').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
		var temp1=document.getElementById('tblproductos').rows[i].cells[1].childNodes[0].innerHTML;
		var temp3=document.getElementById('tblproductos').rows[i].cells[3].innerHTML;
		var temp4=document.getElementById('tblproductos').rows[i].cells[4].innerHTML;
	
	   document.form1.saldo.value=temp3;
	   
	   var unidad=temp4.split("-");
			   if (campoP=='codprod'){
					document.form1.uni_p.value=unidad[0];
					document.form1.factor_p.value=unidad[1];
					document.form1.precio_p.value=unidad[2];
					document.form1.punit.value=parseFloat(unidad[2]).toFixed(4);
					 if(document.getElementById('moneda').innerHTML=='(US$.)'){
						document.form1.punit.value=parseFloat(unidad[2]/tc_doc).toFixed(4);
					}
				}else{
					document.form1.uni_p2.value=unidad[0];
					document.form1.factor_p2.value=unidad[1];
					document.form1.precio_p2.value=unidad[2];
					document.form1.punit2.value=parseFloat(unidad[2]).toFixed(4);	
					/*if(document.getElementById('moneda2').innerHTML=='(US$.)'){
						document.form1.punit2.value=parseFloat(unidad[2]/tc_doc).toFixed(4);
					}*/	
				}   
	  
	   /* document.form1.punit.value=parseFloat(unidad[6]).toFixed(4);*/
	   document.form1.series.value=unidad[4];
	   document.form1.serie_ing.value="";
	   document.form1.pruebas.value=unidad[5];
	   
	   //alert();
	   
	  // elegir(temp,temp1);
	   var tempDes=temp1.split("|");
	   elegir(temp,tempDes[1].substring(8,tempDes[1].length));
	   
			}
		 }
	   }
	   
	<!-- enviar datelle 1-->   
	   if(document.form1.cantidad.value!="" && document.form1.codprod.value!="" && document.form1.punit.value!="" && document.form1.cantidad.value!=0 )
		{

					var cant=document.form1.cantidad.value;
					var saldo=document.form1.saldo.value;
					
						if(parseFloat(saldo) >= parseFloat(cant) || prms_doc_stock=='N' ){
						
							if(document.form1.series.value=='S' && document.form1.serie_ing.value==""){
							//alert('el producto maneja series');
							
							var cant=document.form1.cantidad.value;
							var randomnumber=Math.floor(Math.random()*99999);
							var producto=document.form1.codprod.value;
							//var fecha=document.form1.femi.value;
							var tienda=document.form1.tienda.value;
							
							Modalbox.show('../compras/sal_series2.php?cant='+cant+'&ran='+randomnumber+'&producto='+producto+'&tienda='+tienda, {title: 'Serie de productos ( SALIDAS )', width: 500}); 	return false;
								
							}														
						
						//../compras/
						doAjax('buscar_item.php','prod='+document.form1.codprod.value,'buscar_item2','get','0','1','','');
						}else{						
						
						alert("Producto sin Stock ... \n Stock Disponible: "+saldo);	
						document.form1.cantidad.value="";
						document.form1.codprod.value="";
						document.form1.precio.value="";
						document.form1.punit.value="";
						document.form1.codprod.select();																
						}		
	
		}
	
	<!-- enviar datelle 2-->   
	   if(document.form1.cantidad2.value!="" && document.form1.codprod2.value!="" && document.form1.punit2.value!="" && document.form1.cantidad2.value!=0 )
		{

					var cant=document.form1.cantidad2.value;
					var saldo=document.form1.saldo.value;
					
						//if(parseFloat(saldo) >= parseFloat(cant) || prms_doc_stock=='N' ){
						doAjax('buscar_item.php','prod='+document.form1.codprod2.value,'buscar_item2','get','0','1','','');						
						/*}else{	
						alert("Producto sin Stock ... \n Stock Disponible: "+saldo);	
						document.form1.cantidad2.value="";
						document.form1.codprod2.value="";
						document.form1.precioX.value="";
						document.form1.punit2.value="";
						document.form1.codprod2.select();																
						}*/		
	
		}	
		
							
return false; });
 
 
 function elegir(cod,des){

	 if (campoP=='codprod'){
	document.form1.codprod.value=cod;
	document.form1.termino.value=des;
	
	document.form1.ter.value=0;
	document.form1.cantidad.disabled=false;
	document.form1.precio.readOnly=true;
	document.form1.punit.disabled=true;
		
var uni_p=document.form1.uni_p.value;
var factor_p=document.form1.factor_p.value;
var precio_p=document.form1.precio_p.value;

doAjax('carga_cbo_uni.php','&producto='+cod+'&uni_p='+uni_p+'&factor_p='+factor_p+'&precio_p='+precio_p+'&id=presentacion','view_cbo_uni','get','0','1','','');
	}else{
		document.form1.codprod2.value=cod;
		document.form1.termino2.value=des;
		
		document.form1.ter2.value=0;
		document.form1.cantidad2.disabled=false;
		document.form1.precioX.readOnly=true;
		document.form1.punit2.disabled=true;
		
var uni_p=document.form1.uni_p2.value;
var factor_p=document.form1.factor_p2.value;
var precio_p=document.form1.precio_p2.value;
doAjax('carga_cbo_uni.php','&producto='+cod+'&uni_p='+uni_p+'&factor_p='+factor_p+'&precio_p='+precio_p+'&id=presentacion2','view_cbo_uni','get','0','1','','');
		
	}
	document.getElementById('presentacion').style.visibility='';
	document.getElementById('presentacion2').style.visibility='';	
	document.getElementById('productos').style.visibility='hidden';
	
 }
 
 function view_cbo_uni(texto){
	if (campoP=='codprod'){
		document.getElementById('cbo_uni').innerHTML=texto;
		document.form1.cantidad.focus();
		document.form1.presentacion.focus();
	}else{
		document.getElementById('cbo_uni2').innerHTML=texto;
		document.form1.cantidad.focus();
		document.form1.presentacion2.focus();
	}
	
	if(temp_busqueda=='serie'){
	alert(123);
	document.form1.cantidad.value=1;
	document.form1.cantidad.disabled=true;
	calculos_pretot();
	document.form1.punit.select();
	document.form1.punit.focus();
	document.form1.serie_ing.value="S";
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
 function borrar2() { 
		
		var n=document.form1.presentacion2.options.length;
   		for (var i=0;i<n;i++)  {
		//alert(i);
        	aBorrar = document.forms["form1"]["presentacion2"].options[0];
			aBorrar.parentNode.removeChild(aBorrar);
			
		}
}  

 function buscar_item2(texto){
//alert(texto);

	var cadena=texto.split('?');
	textoT=cadena[0];
	articulo=cadena[1];
	if (articulo=='P'){ articulo='Materia Prima'; }else{ articulo='Producto Final'; }

	if(textoT==0){
		enviar();	
	}else{	
		//if(confirm('Este item ya se encuentra ingresado en el detalle desea volver a ingresarlo? ')){
		//enviar();
		//}else{
		if (campoP=='codprod'){
		alert('Este item ya se encuentra ingresado en el detalle de '+ articulo);
		document.form1.precio.value="";
		document.form1.punit.value="";
		document.form1.cantidad.value="";
		document.form1.termino.value="";
		document.form1.codprod.value="";
		document.form1.codprod.focus();
		}else{
		alert('Este item ya se encuentra ingresado en el detalle de '+ articulo);
		document.form1.precioX.value="";
		document.form1.punit2.value="";
		document.form1.cantidad2.value="";
		document.form1.termino2.value="";
		document.form1.codprod2.value="";
		document.form1.codprod2.focus();
		}
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
	
	if (campoP=='codprod'){
	i=document.getElementById('items').value;
	document.getElementById('items').value=parseFloat(i)+1;
	var moneda_doc=document.form1.tmoneda.value;
	doAjax('detalle_doc.php','&trans=&incluidoigv=S&punitario='+document.form1.punit.value+'&prod='+document.form1.codprod.value+'&cant='+document.form1.cantidad.value+'&presentacion='+document.form1.presentacion.value+'&tmoneda='+moneda_doc+'&mon_ini='+temp_mon,'mostrar','get','0','1','','');	
	}else{		
	i=document.getElementById('items2').value;
	document.getElementById('items2').value=parseFloat(i)+1;
	var moneda_doc=document.form1.tmoneda.value;
	var total_mprima=document.form1.totalpagar.value

	doAjax('detalle_doc2.php','&trans=&incluidoigv=S&punitario='+document.form1.punit2.value+'&prod='+document.form1.codprod2.value+'&cant='+document.form1.cantidad2.value+'&presentacion='+document.form1.presentacion2.value+'&tmoneda='+moneda_doc+'&mon_ini='+temp_mon+'&total_mprima='+total_mprima,'mostrar2','get','0','1','','');	
		recalcular();
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

	if(!document.form1.codprod.disabled){
	document.form1.codprod.focus();
	document.form1.pro.value=1;
	borrar();
	}
	//document.form1.accion.value="";
	//cambiar_impuesto();
	if(document.form1.total_doc.value==0.00){		
		if(document.getElementById('moneda').innerHTML=='(S/.)'){
		temp_mon="01";
		}else{
		temp_mon="02";
		}
	}
		
}
function mostrar2(texto) {
var r = texto;
document.getElementById('resultado2').innerHTML=r;
document.getElementById('resultado2').style.display="block";
document.form1.precioX2.value='<?php echo $_SESSION['registro']?>';
document.form1.codprod2.value="";
document.form1.cantidad2.value="";
document.form1.precioX.value="";
document.form1.termino2.value="";
document.form1.punit2.value="";

	if(!document.form1.codprod2.disabled){
	document.form1.codprod2.focus();
	document.form1.pro2.value=1;
	borrar2();
	}

/*	if(document.form1.total_doc2.value==0.00){		
		if(document.getElementById('moneda').innerHTML=='(S/.)'){
		temp_mon="01";
		}else{
		temp_mon="02";
		}
	}*/
		
}

  function cambiar_enfoque(control){
		//  alert(control.name);
			if(control.name=="sucursal"){
			doAjax('peticion_datos.php','&peticion=cmbsucursal&codsuc='+document.form1.sucursal.value,'cargar_cmbsucursal','get','0','1','','');	
			//document.form1.tienda.focus();			
			}
					
			if(control.name=="tienda"){			
			
			var sucursal=document.form1.tienda.value.substring(0,1);
			
			if(prms_doc_serie!="S" || (user_tienda!='' && user_tienda!='0')){
			document.form1.serie.value=document.form1.tienda.value;
			 //../compras/
			 doAjax('peticion_datos.php','&tienda='+document.form1.tienda.value+'&serie='+document.form1.serie.value+'&sucursal='+sucursal+'&permisoS='+prms_doc_serie+'&peticion=generar_numero_transf','rpta_gen_numero','get','0','1','',''); 		
			}

			}
			if(control.name=="responsable"){	
			//document.formulario.doc.disabled=false;
			document.form1.sucursal2.focus();
			}
			if(control.name=="sucursal2"){	
			//document.formulario.doc.disabled=false;
			//document.form1.tienda2.focus();
			doAjax('peticion_datos.php','&peticion=cmbsucursal2&codsuc='+document.form1.sucursal2.value+'&codtien='+document.form1.tienda.value,'cargar_cmbsucursal2','get','0','1','','');
			}
			if(control.name=="tienda2"){	
			//document.formulario.num_serie.disabled=false;
			document.form1.condicion.focus();
			
			}
			
			if(control.name=="condicion"){
			//document.formulario.condicion.disabled=false;
			document.form1.transportista.focus();
			}
			
			if(control.name=="transportista"){
			document.form1.codprod.focus();			
			}
			
			
  }
  
  
	function generar_ceros(e,ceros,control){
			var serie=document.form1.serie.value;
			var numero=document.form1.numero.value;
			var sucursal=document.form1.tienda.value.substring(0,1);
						
			if(e.keyCode==13 ){
			
				var valor="";
				if(control=='serie'){
				valor=serie
				}else{
				valor=numero
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
				   //../compras/
				   doAjax('peticion_datos.php','&serie='+document.form1.serie.value+'&tienda='+document.form1.tienda.value+'&permisoS='+prms_doc_serie+'&sucursal='+sucursal+'&peticion=generar_numero_transf','rpta_gen_numero','get','0','1','',''); 
				  
		    	}
								
				if(control=='correlativo'){
				
					if(document.form1.numero.value!=0){	
						document.form1.numero.value=ponerCeros(valor,ceros);
						numero=document.form1.numero.value;
						doAjax('peticion_datos.php','&serie='+serie+'&numero='+numero+'&sucursal='+sucursal+'&peticion=buscar_transf','rpta_bus_transf','get','0','1','','');
							
					}													
					
				}
				
				if(control=='fecha'){
				
				//document.form1.fven.disabled=false;
				
				document.form1.codprod.focus();
				document.form1.responsable.focus();

				}
				
				if(control.name=='fven'){
				document.form1.codprod.disabled=false;
				document.form1.codprod.focus();
				//document.formulario.codprod.select();
				}
							
			}
		
		}
  
 function rpta_gen_numero(texto){
		  if(texto.substring(0,7)!='ocupado'){ 		  
          document.form1.serie.value=ponerCeros(document.form1.serie.value,3);		
		  document.form1.numero.value=ponerCeros(texto,7);				
		  document.form1.numero.disabled=false;				
          
		  //document.form1.numero.select();	
		  
		  document.form1.numero.select();
		  document.form1.numero.focus();
		  
		   document.form1.sucursal.disabled=true;
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
	//alert(texto);
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
	var moneda_doc=document.form1.tmoneda.value;
	
	desabilitar();
	
	doAjax('detalle_doc.php','&trans=&incluidoigv=&punitario='+document.form1.punit.value+'&accion=mostrarprod&tmoneda='+moneda_doc+'&mon_ini='+temp_mon,'mostrar','get','0','1','','');
	
	setTimeout ("detalle2X();", 500); 
	

	}else{
	
	document.form1.numero.disabled=true;
	//document.form1.tienda.disabled=true;
	document.form1.fecha.select();
	document.form1.fecha.focus();
	}
	
	
	
	} 
 function detalle2X(){
 	var total_mprima=document.form1.totalpagar.value
	var moneda_doc=document.form1.tmoneda.value;	
	doAjax('detalle_doc2.php','&trans=&incluidoigv=&punitario='+document.form1.punit2.valu+'&accion=mostrarprod&tmoneda='+moneda_doc+'&mon_ini='+temp_mon+'&total_mprima='+total_mprima,'mostrar2','get','0','1','','');
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
 
 
 function eliminar_transf(){
     var cod_transf=document.form1.cod_transf.value;
    var cod_transf2=document.form1.cod_transf2.value;
 	var tienda=document.form1.tienda.value;
 	var tienda2=document.form1.tienda2.value;
 doAjax('../compras/peticion_datos.php','&tienda='+tienda+'&tienda2='+tienda2+'&cod_transf='+cod_transf+'&cod_transf2='+cod_transf2+'&peticion=eliminar_transf','rspta_eliminar_transf','get','0','1','','');
 
 }
 
 function rspta_eliminar_transf(texto){
 
// alert(texto);
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
			 	doAjax('../compras/peticion_datos.php','&tienda='+document.form1.tienda.value+'&serie='+document.form1.serie.value+'&sucursal='+sucursal+'&permisoS='+prms_doc_serie+'&peticion=generar_numero_transf','rpta_gen_numero','get','0','1','',''); 		
			}else{
				document.form1.serie.focus();
				document.form1.serie.select();
			}
		//	document.form1.numero.focus();
		//	document.form1.numero.select();	
 
 }
 
 function salir_transf(){
 
	 if(document.form1.numero.value!=''){
	  doAjax('peticion_datos.php','&tienda='+document.form1.tienda.value+'&peticion=salir_transf','rpta_salir','get','0','1','','');
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
	control.style.backgroundImage='url(../imagenes/boton_aplicar2.gif)';
	else
	control.style.backgroundImage='url(../imagenes/boton_aplicar.gif)';
	
	
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
		
		doAjax('../compras/peticion_datos.php','&peticion=sal_series&series='+series+'&producto='+producto+'&accion='+accion+'&tienda='+tienda,'rspta_aceptar_sal_serie','get','0','1','','');
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
	var totalitem=parseFloat(document.form1.punit.value)*parseFloat(document.form1.cantidad.value);
	document.form1.precio.value=(Math.round((totalitem)*1000)/1000).toFixed(4);
	//calculos_pretot();	
	}
function calc_pre_total2(){
	var totalitem=parseFloat(document.form1.punit2.value)*parseFloat(document.form1.cantidad2.value);
	document.form1.precioX.value=(Math.round((totalitem)*1000)/1000).toFixed(4);
	//calculos_pretot();	
}
	function editar_serie(codprod,control){
	
	var tipomov=2
	var randomnumber=Math.floor(Math.random()*99999);
	var cantidad=control.innerHTML;
	var estado_doc=document.getElementById('estado').innerHTML;
//	var temp_doc=document.form1.temp_doc.value;
	var temp_doc="";
	var tienda=document.form1.tienda.value;
			
	Modalbox.show('../compras/sal_series2.php?accion=editar&ran='+randomnumber+'&producto='+codprod+'&cant='+cantidad+'&estado_doc='+estado_doc+'&temp_doc='+temp_doc+'&tienda='+tienda, {title: 'Serie de productos ( Salidas )', width: 500}); 
		
	}


	function ant_imprimir(){

	var formato="";
	
	if(formato==''){
	alert('Este tipo de documento no tiene asignado un formato de impresión');
	return false;
	}
					
	var tienda=document.form1.tienda2.value;
	var serie=document.form1.serie.value;
	var numero=document.form1.numero.value;
	
	//var temp=document.getElementById('detalle_doc_gen').rows.length;
			
		if(serie!='' && document.form1.serie.disabled && document.form1.tienda2.disabled && tienda!="0" && numero!='' && temp>1 ){
		
		alert('imprimir')
		//imprimir();
		
		}else{
	
		document.form1.temp_imp.value='S';
		alert('grabar');
		//grabar_doc();
								
		}	
	
	}
	
	
	function imprimir(){
	
	//var sucursal=document.form1.sucursal.value;
	
	var doc="OR";
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
alrt(11);
			
		var temp=document.getElementById('tblproductos').rows[indice].cells[0].childNodes[0].childNodes[0].innerHTML;
		var cadena=document.getElementById('tblproductos').rows[indice].cells[3].innerHTML;
		
		//elegir(temp);
		
		var temp1=document.getElementById('tblproductos').rows[indice].cells[1].childNodes[0].innerHTML;
		
		var temp_prod=document.getElementById('tblproductos').rows[indice].cells[4].innerHTML.split("-");
		var temp4=document.getElementById('tblproductos').rows[indice].cells[4].innerHTML;
        var unidad=temp4.split("-");
		
		document.form1.series.value=unidad[4];
  		
		var total_precio="";	
		var precio=parseFloat(temp_prod[2]);
		var prod_moneda=parseFloat(temp_prod[3]);
			
			total_precio=precio;
		

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
function cargar_cmbsucursal(texto){
	document.getElementById('cmbtienda').innerHTML=texto
	document.form1.tienda.focus();	
}
function cargar_cmbsucursal2(texto){
	document.getElementById('cmbtienda2').innerHTML=texto
	document.form1.tienda2.focus();
}
function func_f8(){

	if(!document.form1.codprod.disabled && document.getElementById('productos').style.visibility!='visible' ){
			cambiar_moneda_ini();
		}else{
		alert(2);
			if(document.getElementById('productos').style.visibility=='visible'){			
			   for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
				  if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb'){
				
					var temp=document.getElementById('tblproductos').rows[i].cells[0].childNodes[0].childNodes[0]
			
				var codigo=temp.innerHTML;
				var moneda=document.form1.tmoneda.value;
				var sucursal=document.form1.sucursal.value;
				
					window.open('../compras/espec_prod.php?codigo='+codigo+'&moneda='+moneda+'&sucursal='+sucursal,'','width=650,height=420,top=150,left=300,scroolbars=yes,directories=no,location=no,menubar=no,titlebar=no,toolbar=no,status=yes');	
					}
				 }
		   }
	 }
}
function cambiar_moneda_ini(){
		if(document.getElementById('moneda').innerHTML=='(S/.)'){
			document.getElementById('moneda').innerHTML='(US$.)';
			document.getElementById('moneda2').innerHTML='(US$.)';
			document.form1.tmoneda.value="02";
			//document.form1.precosto.value=document.form1.precosto.value/tc_doc;
		}else{
			document.getElementById('moneda').innerHTML='(S/.)';
			document.getElementById('moneda2').innerHTML='(S/.)';
			document.form1.tmoneda.value="01";
			//document.form1.precosto.value=document.form1.precosto.value*tc_doc;
		}
			
			if(document.form1.total_doc.value!=0.00){
			
			var permiso4='';//find_prm(tab4,tab_cod);
			var permiso10='';//find_prm(tab10,tab_cod);
			var impto='';//document.form1.impto.value;			
			
			 var percep_suc='';//ddocument.form1.percep_suc.value;
		     var percep_doc='';//ddocument.form1.percep_doc.value;
			 var min_percep_doc='';//ddocument.form1.min_percep_doc.value;
			 var est_percep_clie='';//ddocument.form1.est_percep_clie.value;
			 var por_percep_clie='';//ddocument.form1.por_percep_clie.value;
			 var total_doc=document.form1.total_doc.value;
			 var tipomov='2';//ddocument.form1.tipomov.value;
			 var moneda_doc=document.form1.tmoneda.value;

			doAjax('detalle_doc.php','&trans=&incluidoigv=S&accion=cambiar_dolar&tmoneda='+document.form1.tmoneda.value+'&permiso4='+permiso4+'&permiso10='+permiso10+'&cargar_ref&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov+'&tmoneda='+moneda_doc+'&mon_ini='+temp_mon,'mostrar','get','0','1','','');
						
		if (document.getElementById('items2').value>0){	
		alert('Recalculando Producto Final...');		
			//var moneda_doc=document.form1.tmoneda.value;			
			//if(document.getElementById('moneda').innerHTML=='(S/.)'){
				var total_mprima=document.form1.totalpagar.value;
			//}else{
			//	var total_mprima=document.form1.totalpagar.value*<?=$tc;?>;
			//}
		
		doAjax('detalle_doc2.php','&trans=&incluidoigv=S&accion=cambiar_dolar&tmoneda='+moneda_doc+'&mon_ini='+temp_mon+'&total_mprima='+total_mprima,'mostrar2','get','0','1','','');		
		}
		
		
			}else{
				if(document.getElementById('moneda').innerHTML=='(S/.)'){
				temp_mon="01";
				}else{
				temp_mon="02";
				}
			}
		
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
	/*if(e.keyCode==13){
	var precio_nuevo=parseFloat(control.value);
	var tc_doc=document.formulario.tcambio.value;
	//alert(precio_nuevo+" "+producto);
	if(mon_prod==1 && document.getElementById('moneda').innerHTML=='(US$.)'){
			precosto=parseFloat(precosto/tc_doc).toFixed(4);
			}else{
				if(mon_prod==2 && document.getElementById('moneda').innerHTML=='(S/.)'){
				precosto=parseFloat(precosto*tc_doc).toFixed(4);
				}
			
	}
	
	
		var permiso4=find_prm(tab4,tab_cod);
		var permiso10=find_prm(tab10,tab_cod);
		var impto=document.formulario.impto.value;	
		
		 var percep_suc=document.formulario.percep_suc.value;
	     var percep_doc=document.formulario.percep_doc.value;
		 var min_percep_doc=document.formulario.min_percep_doc.value;
		 var est_percep_clie=document.formulario.est_percep_clie.value;
		 var por_percep_clie=document.formulario.por_percep_clie.value;
		 var total_doc=document.formulario.total_doc.value;
		var tipomov=document.formulario.tipomov.value;
		//alert(producto);
		
	doAjax('detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&accion=cambiar_dolar&tmoneda='+document.formulario.tmoneda.value+'&mon_ini='+temp_mon+'&permiso4='+permiso4+'&permiso10='+permiso10+'&precio_nuevo='+precio_nuevo+'&producto='+producto+'&cambiar_precio&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov,'mostrar','get','0','1','','');
	
	}*/
}
function recalcular(){
	if (document.getElementById('items2').value>0){
	var moneda_doc=document.form1.tmoneda.value;
	var total_mprima=document.form1.totalpagar.value
//alert(moneda_doc);
	doAjax('detalle_doc2.php','&trans=&incluidoigv=S&accion=cambiar_dolar&tmoneda='+moneda_doc+'&mon_ini='+temp_mon+'&total_mprima='+total_mprima,'mostrar2','get','0','1','','');	
	}else{
		alert('Documento sin items... Agregue un item a Producto Final');
	}
}


 </script>
</html>
