<?php 
session_start();
include('seguridad.php');
include('conex_inicial.php');
//echo "dg".$_SESSION['tienda'];

//$menu="menus/stickcom.js";
//$menu="menus/semcar.js";
//$menu="menus/computo.js";
//$menu="menus/computo2.js";
//$menu="menus/comercial1.js";
//$menu="menus/comercial2.js";
//$menu="menus/comercial3.js";
//$menu="menus/contometro_grifo.js";
//$menu="menus/general.js";

//$menu='menu_superfish/general.php';
//$menu='menu_superfish/contometro_grifo.php';
$menu='menu_superfish/comercial1.php';
//$menu='menu_superfish/comercial2.php';
//$menu='menu_superfish/comercial3.php';
//$menu='menu_superfish/computo.php';
//$menu='menu_superfish/computo2.php';
//$menu='menu_superfish/stickcom.php';
//$menu='menu_superfish/semcar.php';

$_SESSION['prodfiltro']='S';//colocar S solo en caso de cencar.
$_SESSION['vendVerTransf']='S';// colocar N para chambi
$_SESSION['actCostoRef']='S';
$_SESSION['stickcom']='N';
$_SESSION['busqOferta']='P';//C=busqueda por categoria  P= busqueda por producto

function ObtenerIP()
{
   if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown"))
           $ip = getenv("HTTP_CLIENT_IP");
   else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
           $ip = getenv("HTTP_X_FORWARDED_FOR");
   else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
           $ip = getenv("REMOTE_ADDR");
   else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
           $ip = $_SERVER['REMOTE_ADDR'];
   else
           $ip = "IP desconocida";
   return($ip);
}

//echo ObtenerIP();

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
<!--
.Estilo51 {font-size: 10px}
.Estilo52 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo54 {color: #000000}
-->
</style>
<head>
<script language="javascript" src="miAJAXlib2.js"></script>

<script src="jquery-1.2.6.js"></script>
<script src="jquery.hotkeys.js"></script>

<script type="text/javascript" src="js/reflection.js"></script>
<script type="text/javascript" src="js/moo.js"></script>

<script language="JavaScript"> 
 jQuery(document).bind('keydown', 'f1',function (evt){jQuery('#_f6').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
 return false; }); 
 jQuery(document).bind('keydown', 'f2',function (evt){jQuery('#_f6').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
 return false; });
 jQuery(document).bind('keydown', 'f3',function (evt){jQuery('#_f6').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
 return false; }); 
  jQuery(document).bind('keydown', 'f4',function (evt){jQuery('#_f6').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
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
 	event.keyCode=0;
	event.returnValue=false;
 return false; }); 
 jQuery(document).bind('keydown', 'f8',function (evt){jQuery('#_f6').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
 return false; }); 
 jQuery(document).bind('keydown', 'f9',function (evt){jQuery('#_f6').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
 return false; }); 
 jQuery(document).bind('keydown', 'f10',function (evt){jQuery('#_f6').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
 return false; }); 
  jQuery(document).bind('keydown', 'ctrl+n',function (evt){jQuery('#_f6').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
 return false; }); 
  jQuery(document).bind('keydown', 'ctrl+k',function (evt){jQuery('#_f6').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
 return false; });
 jQuery(document).bind('keydown', 'ctrl+u',function (evt){jQuery('#_f6').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
 return false; }); 
 
</script> 

<script type="text/javascript" >
function open_menu()
{document.getElementById('color').style.height="100px";
}
function close_menu()
{document.getElementById('color').style.height="24px";
}

function recargar2(){
alert('entro');
//location.href="principal.php";
}
//------------------contometro---------------------------------
var mastercont="";
var masteradm="";

//------------------ventas---------------------------------
var ventas="";
var ptoventa="";
var redocV="";
var ventascli="";
var catalogoPre="";
var ventaxref="";
var servTecGar="";
var puntven="";
var cajamult="";
var cajacred="";
//------------------Compras---------------------------------
var compras="";
var inventarios="";
var redocC="";
var catalogoPro="";
var transferencia="";
var ordenT="";
var controlSerie="";

//------------------Finanzas---------------------------------
var cuentasC="";
var cuentasCC="";
var flujoC="";
//-----------------Gerencia-----------------------------------
var utilVentasxClie="";
var ventasCons="";
var transfCont="";
var contabilidad="";
//---------------------administracion-------------------------------------
var sucursal="";
var tienda="";
var clientes="";
var proveedores="";
var articulos="";
var tipocambio="";
var transportista="";
var chofer="";
var condicion="";
var undMedida="";
var centroCosto="";
var controlC="";
var usuarios="";
var documentos="";
var admaccesos="";
var docxuser="";
var recalculo="";
var preciosV="";
var modcostos="";
var configuracion="";
var backup="";
//--------------------------------repòrtes-------------------------------
var rptRecoleccion = "";
var rptCierre = "";
var rptCompStock = "";
var rptRelClie = "";

</script>


<?php 
$fecha=gmdate('d/m/Y',time()-18000);
$hora=gmdate('H:i:s',time()-18000);
//echo $hora;

$strSQlT="select * from turno where '$hora' between hinicio and hfin  ";
$resultadoT=mysql_query($strSQlT,$cn);
$rowT=mysql_fetch_array($resultadoT);
$_SESSION['turno']=$rowT['nombre'];


if($_SESSION['turno']==""){
/*echo "<script>alert('El turno ya terminó o aun no ah comenzado'); location.href='index.php'</script>";
*/
}

$strSQl="select * from cierre where fecha='$fecha'";
$resultado=mysql_query($strSQl,$cn);
$cont=mysql_num_rows($resultado);

if($cont!=0){
?>
 <script>desabilitar="_";</script>
 <?php 
}
	
	switch ($_SESSION['nivel_usu']) { 
	
		case 1: //---------------------vendedor-------------------
		// $pagprin="compras/gen_docVendedor.php";
		//  $pagprin="pedido.php";
		 //$pagprin="contometro/informe_ContTanq.php";//"pedido.php";
		 $pagprin="compras/gen_doc.php?tipomov=2";//
		 
  ?>
		 <script>
//--------------------ventas-------------------------------
//------------------Compras---------------------------------
 var venVerTranf='<?php echo $_SESSION['vendVerTransf']?>';

 compras="_";
 inventarios="_";
 redocC="_";
 catalogoPro="_";
 if(venVerTranf=='S'){
 	//transferencia="_";
 }else{
 	transferencia="_";
 }
 ordenT="_";
 controlSerie="_";
 cajamult="_";
 cajacred="_";
 mastercont="_";
masteradm="_";
 //------------------Finanzas---------------------------------
 cuentasC="_";
 
 //flujoC="_";
////-----------------Gerencia-----------------------------------
 utilVentasxClie="_";
 ventasCons="_";
 transfCont="_";
 contabilidad="_";
//---------------------administracion-------------------------------------
 sucursal="_";
 tienda="_";
 clientes="_";
 proveedores="_";
 articulos="_";
 tipocambio="_";
 transportista="_";
 chofer="_";
 condicion="_";
 undMedida="_";
 centroCosto="_";
 controlC="_";
 usuarios="_";
 documentos="_";
 admaccesos="_";
 docxuser="_";
 recalculo="_";
 preciosV="_";
 modcostos="_";
 configuracion="_";
 backup="_";
//--------------------------------repòrtes-------------------------------
 rptRecoleccion="_";
 rptCompStock="_";
 rptRelClie="_";

		 </script>
	  
		  
 <?php
		break;
		
		case 2: //-----------------almacen-------------------
		?>
		
        <script>
//------------------ventas---------------------------------
 //ventas="_";
 ptoventa="_";
 //redocV="_";
 ventascli="_";
 catalogoPre="_";
 ventaxref="_";
 servTecGar="_";
//------------------Compras---------------------------------

 //------------------Finanzas---------------------------------
 cuentasC="_";
 flujoC="_";
//-----------------Gerencia-----------------------------------
 utilVentasxClie="_";
 ventasCons="_";
 transfCont="_";
 contabilidad="_";
//---------------------administracion-------------------------------------
 sucursal="_";
 tienda="_";
 clientes="_";
 proveedores="_";
 //articulos="_";
 tipocambio="_";
 transportista="_";
 chofer="_";
 condicion="_";
 undMedida="_";
 centroCosto="_";
 controlC="_";
 usuarios="_";
 documentos="_";
 admaccesos="_";
 docxuser="_";
 recalculo="_";
 preciosV="_";
 modcostos="_";
 configuracion="_";
 backup="_";
//--------------------------------repòrtes-------------------------------
 rptRecoleccion="_";
 rptCierre="_";
 rptCompStock="_";
 rptRelClie="_";
		
		
		</script>
		
		<?php 
		break;
	
		case 3: //---------usuario compras----------	
		?>
		
		<script>
//------------------ventas---------------------------------
 //ventas="_";
 //ptoventa="_";
 //redocV="_";
 ventascli="_";
 catalogoPre="_";
 ventaxref="_";
 servTecGar="_";
//------------------Compras---------------------------------
// compras="_";
// inventarios="_";
// redocC="_";
// catalogoPro="_";
// transferencia="_";
// ordenT="_";
// controlSerie="_";

//------------------Finanzas---------------------------------
 cuentasC="_";
 flujoC="_";
//-----------------Gerencia-----------------------------------
 utilVentasxClie="_";
 ventasCons="_";
 transfCont="_";
 contabilidad="_";
//---------------------administracion-------------------------------------
 sucursal="_";
 tienda="_";
 clientes="_";
 //proveedores="_";
 //articulos="_";
 tipocambio="_";
 transportista="_";
 chofer="_";
 condicion="_";
 undMedida="_";
 centroCosto="_";
 controlC="_";
 usuarios="_";
 documentos="_";
 admaccesos="_";
 docxuser="_";
 recalculo="_";
 preciosV="_";
 //modcostos="_";
 configuracion="_";
 backup="_";
//--------------------------------repòrtes-------------------------------
 rptRecoleccion="_";
 rptCierre="_";
 rptCompStock="_";
 rptRelClie="_";
		</script>
		
		<?php 
		
		break;
	
		case 4: //-----------usuario oficina--------------------------//
		?>
		<script>
//------------------ventas---------------------------------
 //ventas="_";
// ptoventa="_";
 //redocV="_";
 //ventascli="_";
 //catalogoPre="_";
 //ventaxref="_";
  //servTecGar="_";
//------------------Compras---------------------------------
 //compras="_";
 //inventarios="_";
 //redocC="_";
 //catalogoPro="_";
 //transferencia="_";
 //ordenT="_";
 //controlSerie="_";

//------------------Finanzas---------------------------------
 //cuentasC="_";
 //flujoC="_";
//-----------------Gerencia-----------------------------------
 //utilVentasxClie="_";
 //ventasCons="_";
 //transfCont="_";
 //contabilidad="_";
//---------------------administracion-------------------------------------
 //sucursal="_";
 //tienda="_";
 //clientes="_";
 //proveedores="_";
 //articulos="_";
// tipocambio="_";
 //transportista="_";
 //chofer="_";
// condicion="_";
 //undMedida="_";
 //centroCosto="_";
 //controlC="_";
 usuarios="_";
 documentos="_";
 //admaccesos="_";
 //docxuser="_";
 //recalculo="_";
 //preciosV="_";
 //modcostos="_";
 //configuracion="_";
 backup="_";
//--------------------------------repòrtes-------------------------------
 //rptRecoleccion="_";
 //rptCierre="_";
 //rptCompStock="_";
 //rptRelClie="_";

	
		
		</script>
		
		
		<?php 
					
		break;
		
		case 5: //-------------administrador-------------------------	vendedor cobrador 
		//caja chica x tienda 
		
		break;
		case 6: //-------------cajero -vendedores-------------------------	
		 // $pagprin="ventas/genDocSegMiltifac.php";
		 // $pagprin="ventas/genDocSegMiltifac.php";
		 // $pagprin="compras/gen_doc.php?tipomov=2";//
		 
		?>
		<script>
	//	puntven="_";cajero -vendedores
	//	cajamult="_"; 
	     usuarios="_";
		</script>
		<?
		//--------nivel administrador
		
		break;
		
	
	}


 
?>

<script>

function cerrar_sesion(){
	doAjax('cerrar_session.php','','cerrar','get','0','1','','');
	alert('Sesión terminada.........');
}
setInterval("cerrar_turno()", 3000); // Timer 1min

function cerrar_turno(){
	doAjax('verturnos.php','','terminar_turno','get','0','1','','');
}
 
  function terminar_turno(texto){
 	 var texto2=texto.split('#');
	 	
	 if(texto2[0]==0){
	 	   	
		  if(document.getElementById('etiq_turno').innerHTML=='Tarde'){
		  document.getElementById('etiq_turno').innerHTML='Mañana';
		  }else{
		  document.getElementById('etiq_turno').innerHTML='Tarde';
		  }
//		  el usuario oficina a ingresado desde otro equipo y a cerrado esta conexion
		 // alert('Cambio de turno');
	 
  	}
	 
	 if(texto2[1]==1){
	 
	 var usuario="<?PHP echo $_SESSION['user']?>";
	 alert("El usuario "+usuario+" a ingresado desde otro equipo y a cerrado esta conexion ");
	 location.href="index.php"; 
	 }
//	 El usuario oficina ah iniciado sesion desde otro equipo. Si acepta cerrara automaticamente la otra conexion. 
	 

  } 

</script> 


<title>...::: RP Prolyam Software :::...</title>
<link href="styles.css" rel="stylesheet" type="text/css">


<?php 

//------------------------PERMISOS DE USUARIO--------------------------------------------

//------------------contometro---------------------------------
$mastercont="block";
$masteradm="block";

//------------------ventas---------------------------------
$ventas="block";
$ptoventa="block";
$redocV="block";
$ventascli="block";
$catalogoPre="block";
$ventaxref="block";
$servTecGar="block";
$puntven="block";
$cajamult="block";
$cajacred="block";
//------------------Compras---------------------------------
$compras="block";
$inventarios="block";
$redocC="block";
$catalogoPro="block";
$transferencia="block";
$ordenT="block";
$controlSerie="block";

//------------------Finanzas---------------------------------
$cuentasC="block";
$cuentasCC="block";
$flujoC="block";
//-----------------Gerencia-----------------------------------
$utilVentasxClie="block";
$ventasCons="block";
$transfCont="block";
$contabilidad="block";
//---------------------administracion-------------------------------------
$sucursal="block";
$tienda="block";
$clientes="block";
$proveedores="block";
$articulos="block";
$tipocambio="block";
$transportista="block";
$chofer="block";
$condicion="block";
$undMedida="block";
$centroCosto="block";
$controlC="block";
$usuarios="block";
$documentos="block";
$admaccesos="block";
$docxuser="block";
$recalculo="block";
$preciosV="block";
$modcostos="block";
$configuracion="block";
$backup="block";
//--------------------------------repòrtes-------------------------------
$rptRecoleccion = "block";
$rptCierre = "block";
$rptCompStock = "block";
$rptRelClie = "block";

//---------------------------------------------------------------------------------------

//echo $_SESSION['nivel_usu'];
	switch ($_SESSION['nivel_usu']) { 
	
		case 1: //---------------------vendedor-------------------
		// $pagprin="compras/gen_docVendedor.php";
		//  $pagprin="pedido.php";
		 //$pagprin="contometro/informe_ContTanq.php";//"pedido.php";
		$pagprin="compras/gen_doc.php?tipomov=2";//
		
		//--------------------ventas-------------------------------
//------------------Compras---------------------------------
	$venVerTranf=$_SESSION['vendVerTransf'];
	
	 $compras="none";
	 //echo $compras;
	 $inventarios="none";
	 $redocC="none";
	 $catalogoPro="none";
	 if($venVerTranf=='S'){
		//transferencia="none";
	 }else{
		$transferencia="none";
	 }
	 $ordenT="none";
	 $controlSerie="none";
	 $cajamult="none";
	 $cajacred="none";
	 $mastercont="none";
	 $masteradm="none";
	 //------------------Finanzas---------------------------------
	 $cuentasC="none";
	 
	 //flujoC="none";
	////-----------------Gerencia-----------------------------------
	 $utilVentasxClie="none";
	 $ventasCons="none";
	 $transfCont="none";
	 $contabilidad="none";
	//---------------------administracion-------------------------------------
	 $sucursal="none";
	 $tienda="none";
	 $clientes="none";
	 $proveedores="none";
	 $articulos="none";
	 $tipocambio="none";
	 $transportista="none";
	 $chofer="none";
	 $condicion="none";
	 $undMedida="none";
	 $centroCosto="none";
	 $controlC="none";
	 $usuarios="none";
	 $documentos="none";
	 $admaccesos="none";
	 $docxuser="none";
	 $recalculo="none";
	 $preciosV="none";
	 $modcostos="none";
	 $configuracion="none";
	 $backup="none";
	//--------------------------------repòrtes-------------------------------
	 $rptRecoleccion="none";
	 $rptCompStock="none";
	 $rptRelClie="none";
		
		break;
		
		case 2: 
		//------------------ventas---------------------------------
	 //ventas="none";
	 $ptoventa="none";
	 //redocV="none";
	 $ventascli="none";
	 $catalogoPre="none";
	 $ventaxref="none";
	 $servTecGar="none";
	//------------------Compras---------------------------------
	
	 //------------------Finanzas---------------------------------
	 $cuentasC="none";
	 $flujoC="none";
	//-----------------Gerencia-----------------------------------
	 $utilVentasxClie="none";
	 $ventasCons="none";
	 $transfCont="none";
	 $contabilidad="none";
	//---------------------administracion-------------------------------------
	 $sucursal="none";
	 $tienda="none";
	 $clientes="none";
	 $proveedores="none";
	 //articulos="none";
	 $tipocambio="none";
	 $transportista="none";
	 $chofer="none";
	 $condicion="none";
	 $undMedida="none";
	 $centroCosto="none";
	 $controlC="none";
	 $usuarios="none";
	 $documentos="none";
	 $admaccesos="none";
	 $docxuser="none";
	 $recalculo="none";
	 $preciosV="none";
	 $modcostos="none";
	 $configuracion="none";
	 $backup="none";
	//--------------------------------repòrtes-------------------------------
	 $rptRecoleccion="none";
	 $rptCierre="none";
	 $rptCompStock="none";
	 $rptRelClie="none";
			
		break;
	    case 3:
		
	//------------------ventas---------------------------------
	 //ventas="_";
	 //ptoventa="_";
	 //redocV="_";
	 $ventascli="none";
	 $catalogoPre="none";
	 $ventaxref="none";
	 $servTecGar="none";
	//------------------Compras---------------------------------
	// compras="none";
	// inventarios="none";
	// redocC="none";
	// catalogoPro="none";
	// transferencia="none";
	// ordenT="none";
	// controlSerie="none";
	
	//------------------Finanzas---------------------------------
	 $cuentasC="none";
	 $flujoC="none";
	//-----------------Gerencia-----------------------------------
	 $utilVentasxClie="none";
	 $ventasCons="none";
	 $transfCont="none";
	 $contabilidad="none";
	//---------------------administracion-------------------------------------
	 $sucursal="none";
	 $tienda="none";
	 $clientes="none";
	 //proveedores="none";
	 //articulos="none";
	 $tipocambio="none";
	 $transportista="none";
	 $chofer="none";
	 $condicion="none";
	 $undMedida="none";
	 $centroCosto="none";
	 $controlC="none";
	 $usuarios="none";
	 $documentos="none";
	 $admaccesos="none";
	 $docxuser="none";
	 $recalculo="none";
	 $preciosV="none";
	 //modcostos="none";
	 $configuracion="none";
	 $backup="none";
	//--------------------------------repòrtes-------------------------------
	 $rptRecoleccion="none";
	 $rptCierre="none";
	 $rptCompStock="none";
	 $rptRelClie="none";
			
		break;
	
		case 4:
		
	 $usuarios="none";
	 $documentos="none";
	 $backup="none";
	 
		break;
		
		case 5:
		
		break;
		
		case 5:
		
		
		 // $pagprin="ventas/genDocSegMiltifac.php";
		 // $pagprin="ventas/genDocSegMiltifac.php";
		 // $pagprin="compras/gen_doc.php?tipomov=2";//
		
		$usuarios="none";
		break;
			
	}

?>

</head>
<body bgcolor="#9aacb0" style="margin:0;padding:0" onUnload="cerrar_sesion()"  >
<form name="form1" method="post" action="">
  <table width="831" height="656" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="red" background="imagenes/bg0.jpg">
    <tr>
      <td width="13"><img src="imagenes/spacer.gif" width="13" height="1" border="0" alt=""></td>
      <td width="781" valign="top"><table border="0" bordercolor="blue" width="807" cellpadding="0" cellspacing="0">
          <tr>
            <td width="807"><img src="imagenes/spacer.gif" width="739" height="11" border="0" alt=""></td>
          </tr>
          <tr>
            <td background="imagenes/bg1.jpg"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="24%" rowspan="3" align="center" valign="middle"><a href="#"><img src="imagenes/LOGOINICIAL.gif" alt="PROLYAM RP" width="170" height="50" border="0" class="reflect"  /></a></td>
                  <td height="33" colspan="7" valign="bottom">

					<?php include($menu); ?>

				  </td>
                  <td height="33" align="center" valign="middle">&nbsp;</td>
                </tr>
                <tr>
                  <td align="right" valign="center">&nbsp;</td>
                  <td align="right" valign="center">&nbsp;</td>
                  <td align="left" valign="center">&nbsp;</td>
                  <td align="right" valign="center">&nbsp;</td>
                  <td colspan="2" align="right" valign="bottom"><span class="Estilo54">Tipo de Cambio: </span></td>
                  <td align="center" valign="bottom"><input readonly="readonly" name="textfield" type="text" size="8" maxlength="8" value="<?php echo $_SESSION['tc']?>"></td>
                  <td height="30" align="center" valign="middle">&nbsp;</td>
                </tr>
                <tr>
                  <td width="23%" align="right" valign="center"><input type="hidden" name="tempCodVend" id="tempCodVend" value="<?php echo $_SESSION['codvendedor']?>"></td>
                  <td width="3%" align="right" valign="center"><img src="imagenes/user2.gif" width="20" height="20"></td>
                  <td width="14%" align="left" valign="center"><span class="Estilo51">Usuario:<strong><?php echo $_SESSION['user'];?></strong></span></td>
                  <td width="4%" align="right" valign="center"><img src="imagenes/iconopc.gif" width="25" height="25"></td>
                  <td width="12%" align="left" valign="center"><span class="Estilo51"> Terminal:</span><span class="Estilo51"><strong><?php echo $_SESSION['terminal'];?> </strong> &nbsp;&nbsp;</span></td>
                  <td width="3%" align="center" valign="center"><img src="imagenes/iconoreloj.png" width="13" height="13"></td>
                  <td width="14%" align="left" valign="center"><span class="Estilo51">Turno:<strong id="etiq_turno"><?php echo $_SESSION['turno'];?></strong></span></td>
                  <td width="3%" height="19" align="center" valign="middle"><span class="Estilo2"> <a  href="index.php"><img style="text-decoration:underline" src="imagenes/img_salir.gif" width="20" height="20" border="0"><strong><br>
                    Salir</strong></a> </span></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td height="461"><br>
                <iframe width="810" height="450" id="principal"
name="principal" marginwidth=0 marginheight=0 src="<?php echo $pagprin;?>" 
frameborder=0  style="border:#000000;"> </iframe>
              <br>
              <br>
            </td>
          </tr>
          <tr>
            <td><img name="gris_bar" src="imagenes/gris_bar.jpg" width="804" height="4" border="0" alt=""></td>
          </tr>
          <tr>
            <td><img src="imagenes/spacer.gif" width="1" height="4" border="0" alt=""></td>
          </tr>
          <tr>
            <td><table border="0" bordercolor="green" width="779" cellpadding="0" cellspacing="0">
                <tr>
                  <td style="font-size:10;color:#333333;text-align:center"><p><img src="imagenes/spacer.gif" width="229" height="1" border="0" alt=""><br>
                          <span class="Estilo52">Lima - Per&uacute; </span><br>
                          <span class="Estilo52"><span class="Estilo51">&copy; Todos los Derechos Reservados a<br>
                            Prolyam Software </span><br>
                          </span><img src="imagenes/spacer.gif" width="1" height="1" border="0" alt=""><br>
                  </p></td>
                  <td><img src="imagenes/spacer.gif" width="2" height="41" border="0" alt=""></td>
                  <td background="imagenes/pto_gris_btt.jpg"><img src="imagenes/spacer.gif" width="1" height="1" border="0" alt=""></td>
                  <td><table background="imagenes/pto_gris_btt_bg.jpg" border="0" bordercolor="pink" width="574" height="41" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="577"><img name="pto_gris_btt" src="imagenes/pto_gris_btt.jpg" width="100%" height="1" border="0" alt=""></td>
                      </tr>
                      <tr>
                        <td height="100%"><table align="center" border="0" bordercolor="violet" height="41" cellpadding="0" cellspacing="0">
                            <tr>
                              <td><a class="smenu" href="#">Administraci&oacute;n</a></td>
                              <td style="padding-left:9;padding-right:9"><img name="bg0" src="imagenes/bg0.jpg" width="1" height="11" border="0" alt=""></td>
                              <td><a class="smenu" href="#">clientes</a></td>
                              <td style="padding-left:9;padding-right:9"><img name="bg0" src="imagenes/bg0.jpg" width="1" height="11" border="0" alt=""></td>
                              <td><a class="smenu" href="#">Conexiones</a></td>
                              <td style="padding-left:9;padding-right:9"><img name="bg0" src="imagenes/bg0.jpg" width="1" height="11" border="0" alt=""></td>
                              <td><a class="smenu" href="#">Comentarios</a></td>
                              <td style="padding-left:9;padding-right:9"><img name="bg0" src="imagenes/bg0.jpg" width="1" height="11" border="0" alt=""></td>
                              <td><a class="smenu" href="#">Otros</a></td>
                              <td style="padding-left:9;padding-right:9"><img name="bg0" src="imagenes/bg0.jpg" width="1" height="11" border="0" alt=""></td>
                              <td><a class="smenu" href="#">WebMail</a></td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td><img name="pto_gris_btt" src="imagenes/pto_gris_btt.jpg" width="100%" height="1" border="0" alt=""></td>
                      </tr>
                  </table></td>
                  <td background="imagenes/pto_gris_btt.jpg"><img src="imagenes/spacer.gif" width="1" height="1" border="0" alt=""></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td><img src="imagenes/bg0.jpg" width="1" height="4" border="0" alt=""></td>
          </tr>
          <tr>
            <td><img name="gris_bar" src="imagenes/gris_bar.jpg" width="808" height="3" border="0" alt=""></td>
          </tr>
          <tr>
            <td height="10"><img src="imagenes/spacer.gif" width="1" height="10" border="0" alt=""></td>
          </tr>
      </table></td>
      <td width="37">&nbsp;</td>
    </tr>
  </table>
</form>
<img src="imagenes/spacer.gif" width="13" height="1" border="0" alt="">
<div  id="importar_excel" style="position:absolute; display:none; left:796px; top:536px; width:170px; height:54px; z-index:1 ">
  <table width="172" border="0" cellpadding="0" cellspacing="0">

    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><a href="#" onClick="javascript:Messenger();" style="font-size:14px; font-weight:bold">Prolyam Messenger... </a></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
</body>
</html>