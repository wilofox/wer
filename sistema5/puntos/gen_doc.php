<?php session_start();
   include('../conex_inicial.php');
   $codigo=$_REQUEST['codigo'];
   $tienda=$_REQUEST['tienda'];
   /*
    $strSQL="select * from transp_cliente where cod_trans='".$codigo."'  ";
	$resultado=mysql_query($strSQL,$cn);
	$row=mysql_fetch_array($resultado);
	
	$placa=$row['placa'];
	$vehiculo=$row['vehiculo'];
	$Saldo_punto=$row['saldo_punto'];
	$Total_punto =$row['total_punto'];
	
	
	$strSQLH="select sum(total) as Tl from master_historial where placa='".$placa."'  ";
	$resultadoH=mysql_query($strSQLH,$cn);
	$rowH=mysql_fetch_array($resultadoH);
	$puntoA=$Total_punto;//number_format($rowH['Tl']/1.38);
	
	
	 $strSQLM="select sum(punt_acumulado) as Pa from punto_mov where cod_trans='".$row['cod_trans']."' and estado<>'A' ";
	 $resultadoM=mysql_query($strSQLM,$cn);
	 $rowM=mysql_fetch_array($resultadoM);
	 $puntoD=$puntoA-$Saldo_punto;//$puntoA-$rowM['Pa'];
*/
	
	$strSQL="select * from tienda where cod_tienda='".$tienda."'  ";
	$resultado=mysql_query($strSQL,$cn);
	$row=mysql_fetch_array($resultado);
	$nomTienda=$row['des_tienda'];
	
 	$strSQL="select sum(puntos) as puntos from cab_mov where cliente='".$codigo."'";
	$resultado=mysql_query($strSQL,$cn);
	$row=mysql_fetch_array($resultado);
	$puntoA=$row['puntos'];
	
	$strSQL="select * from cliente where codcliente='".$codigo."'";
	$resultado=mysql_query($strSQL,$cn);
	$row=mysql_fetch_array($resultado);
	$razon=$row['razonsocial'];
	$dircliente=$row['direccion'];
	
	$strSQL="select sum(punt_canje) as punt_canje from canjes where cliente='".$codigo."' and estado='' ";
	$resultado=mysql_query($strSQL,$cn);
	$row=mysql_fetch_array($resultado);
	$puntosCanjeados=$row['punt_canje'];
	
		$puntoD=$puntoA-$puntosCanjeados;

?>
<script>
var temp="<?php echo $_REQUEST['caducado']?>";
var tempNivelUser="<?php echo $_SESSION['nivel_usu'] ?>";
//alert(tempNivelUser);
if(temp=="s"){
window.parent.location.href="index.php";
}
</script>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Canje de Producto</title>
<style type="text/css">
<!--
.Estilo1 {
	color: #990000;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
}
.Estilo14 {font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color:#333333 }
.Estilo31 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FFFFFF; }
.Estilo111 {color:#0066CC;}
.Estilo34 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
.Estilo112 {color: #000000}
-->
.Estilo_det{font:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#333333}
.Estilo115 {color: #333333}
</style>
</head>

<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../javascript/mover_div.js"></script>
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>
<SCRIPT src="../javascript/popup.js" type=text/javascript></SCRIPT>

<script language="javascript" src="../miAJAXlib.js"></script>
    <script src="../jquery-1.2.6.js"></script>
    <script src="../jquery.hotkeys.js"></script>
	<script type="text/javascript" src="../modalbox/lib/prototype.js"></script>
	<script type="text/javascript" src="../modalbox/lib/scriptaculous.js?load=effects"></script>
	
	<script type="text/javascript" src="../modalbox/modalbox.js"></script>
	<link rel="stylesheet" href="../modalbox/modalbox.css" type="text/css" />


<script>

jQuery(document).bind('keydown', 'f2',function (evt){jQuery('#_up').addClass('dirty');
	
	grabar_doc(this);
	
return false; });


function grabar_doc(valor){			
			
if (document.formulario.codprod.value==''){
alert("Debe de seleccionar un producto a canjear");
return false;
}

if (document.formulario.pd4.value<0){
alert("Este producto no puede ser canjeado seleccione otro");
return false;
}

var codigo=document.formulario.codigo.value;
var prodet=document.getElementById("pd1").innerHTML;
var punto=document.formulario.pd2.value;
var codprod=document.formulario.codprod.value;
var puntosaldo=document.formulario.pd4.value;
var efectivo=document.formulario.pd5.value;
var tienda=document.formulario.tienda.value;
	
	if(confirm('Desea confirmar canje de producto')){
		doAjax('peticion_datos.php','&peticion=save_canje&codigo='+codigo+'&prodet='+prodet+'&codprod='+codprod+'&punto='+punto+'&puntosaldo='+puntosaldo+'&efectivo='+efectivo+'&tienda='+tienda,'guardar_datos','get','0','1','','');
	}		
}
function guardar_datos(texto){

	var temp=texto.split("|");
	var formato="ticketcanje.php";
	
	var serie=temp[0];
	var numero=temp[1];
	var tienda=temp[2];
	var codigo=temp[3];
	var fecha=temp[4];
	var punto=temp[5];
	var efectivo=temp[6];
	var codprod=temp[7];
	var puntosaldo=temp[8];
	
	
	var win00=window.open('../formatos/'+formato+'?serie='+serie+'&numero='+numero+'&tienda='+tienda+'&cliente='+codigo+'&fecha='+fecha+'&punto='+punto+'&efectivo='+efectivo+'&codprod='+codprod+'&puntosaldo='+puntosaldo ,'ventana2','width=500,height=700,top=100,left=100,scroolbars=yes,status=yes');	
	
	win00.focus();
	
	
	//alert(texto);
	salir();
}

						
function mostrar_grabacion(texto){
//alert(texto);
		if(texto=='error'){		
			alert('Documento no grabó.....Verifique su conexión de red.');
			document.formulario.submit();
			return false;			
		}
		if(texto!='' && texto!='error'){			
				var texto2=texto.split(":");
				//alert(texto);
				if(texto2[0]=='serie ingresada'){
				alert('Serie ya existe en stock.... \n Producto: '+texto2[2]+' \n Serie: ' + texto2[1]);					
				
				}else{
				alert("Cantidad no corresponde con las series del producto: "+texto);
				temporal_teclas="";
				return false;
				}				
		}else{
		
			if(document.formulario.temp_imp.value=='S'){
			imprimir();
			}			
			document.formulario.submit();
			
	   }
}



jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_esc').addClass('dirty'); 
//alert("escape");
salir();
return false; });


jQuery(document).bind('keydown', 'f7',function (evt){jQuery('#_f7').addClass('dirty');
ant_imprimir();	
	 return false; }); 

function salir(){				
	close();	
}

</script>

<link href="../styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
background-color:#F3F3F3;   
}
.Estilo38 {color: #990000}
.Estilo113 {
	color: #CC3300;
	font-weight: bold;
	font-size: 10px;
	font-family: Arial, Helvetica, sans-serif;
}
.Estilo114 {font-size: 11px; color:#003366; font-family: Verdana, Arial, Helvetica, sans-serif;}
-->
</style>


<script>
function vaciar_sesiones(){

return false;
		var doc=document.formulario.doc.value;
		var tipomov=document.formulario.tipomov.value;
		var auxiliar=document.formulario.auxiliar2.value;
		var tienda=document.formulario.almacen.value;

		
		doAjax('vaciar_sesiones.php','&sucursal='+sucursal+'&numero='+numero+'&serie='+serie+'&doc='+doc+'&auxiliar='+auxiliar+'&tipomov='+tipomov+'&tienda='+tienda,'dev_vaciar','get','0','1','','');

}


		  
	    function ponerCeros(obj,i) {
		  while (obj.length<i){
			obj = '0'+obj;
			}
		//	alert(obj);
			return obj;
		}		 
		  
function rpta_gen_numero(texto){
document.formulario.num_serie.value=ponerCeros(document.formulario.num_serie.value,3);
document.formulario.num_correlativo.disabled=false;
document.formulario.num_correlativo.value=ponerCeros(texto,7);
		  /*document.formulario.num_correlativo.focus();
	      document.formulario.num_correlativo.select();*/
		 // cbo_cond();
		 // tem doc yedem
		 var numero=document.formulario.num_correlativo.value;		 
		 var serie=document.formulario.num_serie.value;
		 var doc=document.formulario.doc.value;
		 var sucursal=document.formulario.sucursal.value;
doAjax('peticion_datos.php','&serie='+serie+'&numero='+numero+'&doc='+doc+'&sucursal='+sucursal+'&peticion=buscar_prov2&tipomov='+document.formulario.tipomov.value,'rpta_bus_numero','get','0','1','','');
}
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
 
		  	
function imprimir(){
	
	var sucursal=document.formulario.sucursal.value;
	var doc=document.formulario.doc.value;
	var serie=document.formulario.num_serie.value;
	var numero=document.formulario.num_correlativo.value;
	
	
	var formato=find_prm(tab_formato,tab_cod);
	var impresion=find_prm(tab_impresion,tab_cod);
	
	
	if(serie!='' && document.formulario.num_serie.disabled && document.formulario.total_doc.value!=0 && formato!=''){ 
	var win00=window.open('../formatos/'+formato+'?empresa='+sucursal+'&doc='+doc+'&serie='+serie+'&numero='+numero+'&impresion='+impresion ,'ventana2','width=850,height=1000,top=100,left=100,scroolbars=yes,status=yes');	
	
	win00.focus();
	
	}else{
	alert('No es posible imprimir');
	}
	
	
	}

function filtrar(pagina){
var filtro=document.formulario.producto.value;
var criterio=document.formulario.criterio.value;
var ordenar=document.formulario.ordenar.value;
var orden=document.formulario.orden.value;
var tienda=document.formulario.tienda.value;

doAjax('det_producto.php','&filtro='+filtro+'&criterio='+criterio+'&ordenar='+ordenar+'&orden='+orden+'&pagina='+pagina+'&tienda='+tienda,'cargar_detalle2','get','0','1','','');
}	
function cargar_detalle2(datos){
//alert(datos);
document.getElementById('resultado').innerHTML=datos;
	if(document.getElementById('lista_aux').rows.length >0){
	cargar_reg();
	}

}
var temp="";
function entrada(objeto){
//	objeto.style.background='url(imagenes/sky_blue_sel.png)';
	objeto.cells[0].childNodes[0].checked=true;
//	temp=objeto;
	if(objeto.style.background=='url(../imagenes/sky_blue_sel.png)'){
	//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='url(../imagenes/sky_blue_sel.png)';
	
	temp.style.background=temp.bgColor;;
	//'#E9F3FE';
	temp=objeto;
	}

}
function cargar_reg(){
document.getElementById('lista_aux').rows[0].style.background='url(../sky_blue_sel.png)';
temp=document.getElementById('lista_aux').rows[0];
document.getElementById('lista_aux').rows[0].cells[0].childNodes[0].checked=true;
}
function canjear(valor){	
		if(document.formulario.xaux.length >0){	

		  for (var i=0;i<document.formulario.xaux.length;i++){ 
			   if (document.formulario.xaux[i].checked) {
			   var cod=document.formulario.xaux[i].value;
			   var prodet=document.formulario.prodet[i].value;
			   var puntos=document.formulario.puntos[i].value;
			   var efectivo=parseFloat(document.formulario.efectivo[i].value);	
			   break; 
			   }

			} 
		}else{	
		var cod=document.formulario.xaux.value;
		var prodet=document.formulario.prodet.value;
		var puntos=document.formulario.puntos.value;		
		var efectivo=parseFloat(document.formulario.efectivo.value);	
		}	
		
		
		document.formulario.codprod.value=cod;
		document.getElementById("pd1").innerHTML = prodet;
		document.formulario.pd2.value=puntos;
		document.formulario.pd4.value=document.formulario.pd3.value-puntos;
		document.formulario.pd5.value=efectivo.toFixed(2);
		
		if (document.formulario.pd4.value>=0){
			document.getElementById("caso").innerHTML = "<b style=color:#000000>Producto Canje v&aacute;lido</b>";
		}else{
			document.getElementById("caso").innerHTML = "<b style=color:#FF0000>Producto no puede ser canjeado<br> te falta "+(document.formulario.pd4.value*-1)+" Puntos para canjear</b>";
		}
//doAjax('new_cliente.php','accion=e&cod='+cod+'&auctip='+auctip+'&aux='+aux,'nuevo_suc','get','0','1','','');
}

function cambiar_fondo2(control,evento){
	
	if(evento=='e')
	control.style.backgroundImage='url(../imagenes/boton_aplicar4.gif)';
	else
	control.style.backgroundImage='url(../imagenes/boton_aplicar3.gif)';
	
	}


	function cargar_cbo(texto){
	var r = texto;
	document.getElementById('cbo_tienda').innerHTML=r;
	//document.form1.almacen.focus();
	}

function cambiar_enfoque(){
}
function enfocar_cbo(){
}
function limpiar_enfoque(){
}

 </script>
<body  onload="document.formulario.producto.focus(); filtrar('');" onUnload="vaciar_sesiones()" >
<!--
iniciar();carga_div();
-->
<form id="formulario" name="formulario" method="post" action="" >
  <table width="577" border="0" cellpadding="0" cellspacing="0">
   
      <tr style="background:url(../imagenes/white-top-bottom.gif)">
       <td height="27" colspan="13" style="border:#999999">&nbsp;<span class="Estilo34">Generador :: <span class="Estilo14 Estilo38">Canje de Puntos
       </span></span>  
	  <input name="orden" type="hidden" size="5" value="asc">
	  <input name="ordenar" type="hidden" size="5" value="">
	  <input name="codigo" type="hidden" size="5" value="<?=$codigo;?>"> 
	   <input name="tienda" type="hidden" size="5" value="<?=$tienda;?>"> 
	  </td>
    </tr>
	
    <tr style="background:url(../imagenes/botones.gif)" >
      <td width="5" height="28">&nbsp;</td>
      <td width="5">&nbsp;</td>
      <td colspan="7"><table width="97%" height="21" border="0" cellpadding="0" cellspacing="0" style="border-bottom:#CCCCCC solid 1px">
        <tr>
          <td width="86" >
              <table  title="Salir [Esc]"width="72" height="21" border="0" cellpadding="0" cellspacing="0">
                <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="salir()">
                  <td width="3" ></td>
                  <td width="20" ><img src="../imagenes/salir.JPG"  width="16" height="16" border="0"></td>
                  <td width="46" ><span class="Estilo112">Salir<span class="Estilo113">[Esc]</span></span></td>
                  <td width="3" ></td>
                </tr>
            </table></td>
          <td width="72" ><table style="visibility:hidden" title="Grabar [F2]" width="80" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onClick="javascript:grabar_doc(this)" onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer;">
                <td width="3" ></td>
                <td width="20" ><span class="Estilo112"><img src="../imgenes/revert.png" width="14" height="16"></span></td>
                <td width="54" ><span class="Estilo112">Grabar<span class="Estilo113">[F2]</span></span></td>
                <td width="3" style="border:#666666 solid 1px" ></td>
              </tr>
          </table></td>
          <td width="83"><table title="Cambiar Moneda [F8]" width="80" height="21" border="0" cellpadding="0" cellspacing="0" style="visibility:hidden">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="func_f8()">
                <td width="3" ></td>
                <td width="16" ><span class="Estilo112"><img src="../imagenes/dolar.gif" width="15" height="15"></span></td>
                <td width="58" ><span class="Estilo112">Moneda<span class="Estilo113">[F8]</span> </span></td>
                <td width="3" ></td>
              </tr>
          </table></td>
          <td width="99"><table title="Incl./no Incl.[F9]" width="70" height="21" border="0" cellpadding="0" cellspacing="0" style="visibility:hidden">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="cambiar_impuesto()">
                <td width="3" ></td>
                <td width="24" ><span class="Estilo112"><img src="../imagenes/igv.gif" width="20" height="16"></span></td>
                <td width="45" ><span class="Estilo112">&nbsp;Imp<span class="Estilo113">[F9]</span> </span></td>
                <td width="3" ></td>
              </tr>
          </table></td>
          <td width="86"><table title="Nuevo[F3]" width="85" height="21" border="0" cellpadding="0" cellspacing="0" style="visibility:hidden">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="ant_imprimir()">
                <td width="3" ></td>
                <td width="20" align="center" ><img src="../imgenes/fileprint.png" width="16" height="16"></td>
                <td width="59" ><span class="Estilo112">Imprimir<span class="Estilo113">[F7]</span> </span></td>
                <td width="3" ></td>
              </tr>
          </table></td>
          <td width="73">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td></td>
      <td height="10"></td>
      <td colspan="7" align="left"><div style="display:none" id="factura"><span class="Estilo1">FACTURA </span></div>      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td height="28">&nbsp;</td>
      <td colspan="7" rowspan="2" align="left" valign="top"><table width="560" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="2">
		  <fieldset style="padding-left:8px; padding-top:5px; padding-bottom:5px; ">
		  <table width="538" border="0" cellspacing="0" cellpadding="0">
                   <tr>
                     <td colspan="3"><span class="Estilo114"><span class="Estilo111">Cliente</span> :</span> <span class="text3" style="color:#000000">
                       <?=$razon;?>
                     </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                   </tr>
                   <tr>
                     <td height="21"><span class="Estilo111">Direccion: </span></td>
                     <td class="Estilo112">
                       <?=$dircliente;?></td>
                     <td width="206" rowspan="2"><div id="tipodoc2" style="display:block">
                       <table style="border:#CCCCCC solid 1px" width="198" height="47" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFF3AE">
                         <tr>
                           <td width="144"><span class="Estilo1 Estilo35"><span class="Estilo44">&nbsp;Puntos Acumulados : </span></span></td>
                           <td width="44"><span class="Estilo1 Estilo35"><span class="Estilo44">
                             <input name="puntoA" type="text" id="puntoA" value="<?=$puntoA;?>" size="5" readonly style="text-align:center">
                           </span></span></td>
                         </tr>
                         <tr>
                           <td><span class="Estilo1 Estilo35"><span class="Estilo44">&nbsp;Puntos Disponibles :</span></span></td>
                           <td><span class="Estilo44">
                             <input name="puntoD" type="text" id="puntoD" value="<?=$puntoD;?>" size="5" readonly style="text-align:center">
                           </span></td>
                         </tr>
                       </table>
                     </div></td>
                   </tr>
                   <tr>
                     <td width="55" height="24"><span class="Estilo111">Tienda: </span></td>
                     <td width="277"><span class="Estilo112"><?php echo $nomTienda ?></span></td>
                   </tr>
                 </table>
		  </fieldset>		  </td>
          </tr>
        <tr>
          <td width="417">		  </td>
          <td width="143">&nbsp;</td>
        </tr>
        
      </table>
      </td>
    </tr>
    <tr>
      <td height="41">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td></td>
      <td ></td>
      <td colspan="7"><table width="100%" height="5" border="0" cellpadding="0" cellspacing="0" style="border-top: #CCCCCC solid 1px">
        <tr>
          <td width="767" height="5"></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td ></td>
      <td colspan="7"><table border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><span class="Estilo14">Producto a Canjear:</span></td>
          <td><span style="border:#999999">
            <input name="termino" type="hidden" size="5" value="">
            <input name="cantidad" type="hidden" size="5" value="">
            <input name="codprod" type="hidden" size="5" value="">
          </span></td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td><select name="criterio" id="criterio" onChange="">
				<option value="cod_prod" >Cod. Sistemas</option>
				<option value="codigo">C&oacute;digo</option>
				<option value="anexo">Anexo</option>   
				<option value="nombre" selected>Nombre</option>  
			 </select>          </td>
          <td><input  name="producto"  type="text" id="producto"  onKeyUp="filtrar('')" autocomplete="off" /></td>
          <td>    <img src="../imagenes/lupa5.gif" width="18" height="20"></td>
          </tr>
      </table></td>
    </tr>
    
    <tr>
      <td colspan="9"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="7">
	  
	    <table width="350" border="0" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
          <tr>
            <td width="18" align="center" bgcolor="#3366CC">&nbsp;</td>
            <td width="40" align="center" bgcolor="#3366CC"><span class="Estilo31">C&oacute;digo</span></td>
            <td width="0" height="18" align="center" bgcolor="#3366CC"></td>
            <td width="190" bgcolor="#3366CC"><span class="Estilo31">Descripci&oacute;n</span></td>
            <td width="35" align="center" bgcolor="#3366CC"><span class="Estilo31">Punto</span></td>
            <td width="48" align="center" bgcolor="#3366CC"><span class="Estilo31">Efec.</span></td>
          </tr>
 
          <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
            <td colspan="6"><div id="resultado"></div></td>
          </tr>
		  	  	  
          <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
            <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
            <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
            <td align="center" bgcolor="#FFFFFF"></td>
            <td bgcolor="#FFFFFF">&nbsp;</td>
            <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
            <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="434">

<DIV id=modal style="BORDER-RIGHT: white 3px solid;  BORDER-TOP: white 3px solid; DISPLAY: none;   BORDER-LEFT: white 3px solid;  BORDER-BOTTOM: white 3px solid; BACKGROUND-COLOR:#003366; "> 
    
	  <table width="270" height="150" border="0">
  <tr>
    <td align="center" style="font:Arial, Helvetica, sans-serif; font:bold; font-size:12; color:#FFFFFF">Espere un momento por favor</td>
  </tr>
  <tr>
    <td align="center" valign="bottom" style="font:Arial, Helvetica, sans-serif; font:bold; font-size:10; color:#FFFFFF">Procesando Datos...</td>
  </tr>
  <tr>
    <td align="center"> <img height="45" width="45" src="../imgenes/cargando.gif">	 </td>
	 <tr>
    <td align="center"> 	
	 <INPUT name="button" type=button onClick="Popup.hide('modal')" value=OK>	 </td>
  </tr>
</table>
    </DIV>
	

	  <table width="488" border="0" align="left" cellpadding="0" cellspacing="0"  style="display:none">
        <tr>
          <td width="71" align="left"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">Referencia</span>
		  <img style="cursor:pointer" alt="" onClick="doc_det(document.formulario.cod_cab_ref.value)" src="../imagenes/ico_lupa.png" width="12" height="12">		  </td>
          <td width="127" align="left">
		  <input readonly="readonly"  style="text-align:right" name="serie_ref" id="serie_ref" type="text" size="5" maxlength="3" />
            <input readonly="readonly" style="text-align:right" name="correlativo_ref" id="correlativo_ref" type="text" size="10" maxlength="7" /></td>
          <td width="290" align="left"><button title="[Alt+r]" disabled="disabled" onClick="vent_ref()" type="button" id="doc_ref"  style="height:18px"><span style=" font-family:Arial, Helvetica, sans-serif;font-size:9px">Referencia</span></button>
            <button title="[Alt+r]" disabled="disabled" onClick="vent_referenciado()" type="button" id="doc_ref2"  style="height:18px"><span style=" font-family:Arial, Helvetica, sans-serif;font-size:9px">Referenciado</span></button>
			
			 <button title="" disabled="disabled" onClick="cambiar_dir()" type="button" id="btnCambiarDir"  style="height:18px"><span style=" font-family:Arial, Helvetica, sans-serif;font-size:9px">Cambiar Direccion</span></button>			</td>
          </tr>
      </table></td>
      <td width="49">&nbsp;</td>
      <td width="5">&nbsp;</td>
      <td width="99" colspan="3">&nbsp;</td>
    </tr>
  </table>
   
    
  <div id="importar_excel" style="position:absolute; left:381px; top:179px; width:199px; height:58px; z-index:1;">
    <table width="90%" height="27" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="93%"><fieldset>
          <legend>Estado de Canje:</legend>
          <table width="182" height="167" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td height="34" colspan="2" ><span class="Estilo115">Producto :</span><br>
				&nbsp;&nbsp;&nbsp;&nbsp;<label id='pd1' style="color:#990000;font-weight:bold">Seleccione Producto</label>              </td>
            </tr>
            <tr>
              <td height="15">Puntos para canje : </td>
              <td><span class="Estilo44">
                <input name="pd2" type="text" id="pd2" value="0" size="7" readonly style="text-align:center">
              </span></td>
            </tr>
            <tr>
              <td height="15" >Efectivo : </td>
              <td><span class="Estilo44">
                <input name="pd5" type="text" id="pd5" value="0.00" size="7" readonly style="text-align:center">
              </span></td>
            </tr>
            <tr>
              <td height="15" >Puntos Disponibles : </td>
              <td><span class="Estilo44">
                <input name="pd3" type="text" id="pd3" value="<?=$puntoD;?>" size="7" readonly style="text-align:center">
              </span></td>
            </tr>
            <tr>
              <td height="15">Puntos Restantes : </td>
              <td><span class="Estilo44">
                <input name="pd4" type="text" id="pd4" value="<?=$puntoD;?>" size="7" readonly style="text-align:center">
              </span></td>
            </tr>
            <tr>
              <td height="15" colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td height="15" colspan="2"><span class="Estilo44">
			  <label id='caso' style="color:#FF0000">Mensaje.</label>
              </span></td>
            </tr>
            <tr>
              <td height="15" align="center">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
        </fieldset></td>
        <td width="7%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" align="center">
		<input onMouseOver="cambiar_fondo2(this,'e')" onMouseOut="cambiar_fondo2(this,'s')" style="border:none; height:35px; width:80px; vertical-align:top;background-image:url(../imagenes/boton_aplicar3.gif) ; cursor:pointer; font:bold; font-size:10px; text-align:center" type="button" name="Submit5" value=" CANJEAR&#10;PUNTOS" onClick="grabar_doc(this)" >		</td>
      </tr>
    </table>
  </div>
  <div id="productos" style="position:absolute; left:22px; top:205px; width:300px; height:180px; z-index:1; visibility:hidden"> </div>
 
</div>
 
</form>

</body>
</html>
