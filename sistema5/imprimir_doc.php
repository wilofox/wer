<?php 
session_start();
include ('../../conex_inicial.php'); 
include('../../numero_letras.php');

$empresa 	=  	$_REQUEST['empresa'];
$doc	 	=  	$_REQUEST['doc'];
$serie 	 	=  	$_REQUEST['serie'];
$numero  	=  	$_REQUEST['numero'];

$strcab		= 	"select * from cab_mov where sucursal='".$empresa."' and cod_ope='".$doc".'  and serie='".$serie."' and Num_doc='".$numero."' " ;
$rscab 		= 	mysql_query (	$strcab,$cn	);
$row 		= 	mysql_fetch_array (	$rscab	);

$codigo	  	= 	$row['cod_cab'];
$nom_aux1 	= 	$row ['cliente']; 
$moneda1 	= 	$row ['moneda']; 
$obs1 		= 	$row ['obs1']; 
$obs2 		= 	$row ['obs2']; 
$obs3 		= 	$row ['obs3']; 
$obs4 		= 	$row ['obs4']; 
$obs5 		= 	$row ['obs5']; 
$tienda		= 	$row ['tienda']; 
$f 			= 	explode("-",substr ($row ['fecha'],0,10)) ;
$dia_fech 	= 	$f[2]; $mes_fech = $f[1]; $ao_fech = substr ($f[0],2,2);
$nom_aux3 	= 	$row ['cod_vendedor']; 
$nom_aux4 	= 	$row ['condicion']; 
$m_total 	= 	$row ['total']; 
$m_bruto  	= 	$row ['b_imp']; 
$igv 		= 	$row ['igv']; 

$stremp		= 	"select * from sucursal where cod_suc = '".$empresa."' " ;
$rsemp		=	mysql_query (	$stremp,$cn	);
$rowemp 		= 	mysql_fetch_array ($rsemp);

$strti		= 	"select * from tienda where cod_tienda = '".$tienda	."' " ;
$rsti		=	mysql_query (	$strti,$cn	);
$rowti 		= 	mysql_fetch_array ($rsti);

$strref		= 	"select * from referencia where cod_cab = '".$codigo."' " ;
$rsref		=	mysql_query (	$strref,$cn	);
$row 		= 	mysql_fetch_array ($rsref);
$num_ref_ser = 	$row ['serie']; 
$num_ref_corr = $row ['correlativo']; 
$cod_cab_ref1 = $row ['cod_cab_ref']; 

$strcabref	= 	"select * from cab_mov where cod_cab= '".$cod_cab_ref1."' " ;
$rsref 		= 	mysql_query ($strcabref,$cn);
$row 		= 	mysql_fetch_array ($rsref);
$tip_docu_ref = $row ['cod_ope']; 

$strcli		= 	"select * from cliente where codcliente = '".$nom_aux1."' " ;
$rsccli	    = 	mysql_query (	$strcli,$cn	);
$row 		= 	mysql_fetch_array (	$rsccli	);
$nom_aux 	= 	$row ['razonsocial']; 
$direc_aux 	=  	$row ['direccion']; 
$dni_aux 	= 	$row ['doc_iden']; 
//$ruc_aux = $row ['ruc']; 
$email_aux  =	$row ['email']; 

$strusu		= 	"select * from usuarios where codigo= '".$nom_aux3."' " ;
$rsusu 		= 	mysql_query (	$strusu,$cn	);
$row 		= 	mysql_fetch_array( $rsusu );
$responsable= 	$row ['usuario']; 

$strcod		= 	"select * from condicion where codigo= '".$nom_aux4."' " ;
$rscod 		= 	mysql_query ( $strcod,$cn );
$row 		= 	mysql_fetch_array ( $rscod );
$condicion 	= 	$row ['nombre']; 

$strdet		= 	"select * from det_mov where cod_cab= '".$codigo."' " ;
$rsdet 		= 	mysql_query ( $strdet,$cn );
$row 		= 	mysql_fetch_array ( $rsdet	);
$cant		= 	$row ['cantidad']; 
$P 			=  	$row ['cod_prod'];
$descripcion=  	$row ['nom_prod'];
$p_unit 	= 	$row ['precio'];
$nota 		= 	substr($row ['notas'],0,15);


$strpro		= 	"select * from producto where idproducto= '".$P."' " ;
$rspro 		= 	mysql_query ( $strpro,$cn );
$row 		= 	mysql_fetch_array ( $rspro );
$u 			= 	$row ['und']; 

$struni		= "select * from unidades where id = '".$u."' " ;
$rsuni	 	= mysql_query ( $struni,$cn );
$row 		= mysql_fetch_array ( $rsuni );
$unid		= $row ['nombre'];

switch($moneda1)
{  	case "01"	:	$moneda = "S/.";break;
	case "02"	:	$moneda = "US$";break;
}

switch($moneda1)
{   case "01"	:	$monedalet = "NUEVOS SOLES";break;
	case "02"	:	$monedalet = "DOLARES AMERICANOS";break;
}

switch($mes_fech)
 { 	case "01"	:   $mes_letra = "Enero";break;
	case "02"	:   $mes_letra = "Febrero";break;
	case "03"	:   $mes_letra = "Marzo";break;
	case "04"	:   $mes_letra = "Abril";break;
	case "05"   :   $mes_letra = "Mayo";break;
    case "06"   :   $mes_letra = "Junio";break;
	case "07"	:   $mes_letra = "Julio";break;
	case "08"	:   $mes_letra = "Agosto";break;
	case "09"	:   $mes_letra = "Setiembre";break;
	case "10"	:   $mes_letra = "Octubre";	break;
	case "11"	:   $mes_letra = "Noviembre";break;
	case "12"	:	$mes_letra = "Diciembre";break;

}

$strop	= 	"select * from operacion where codigo = '".$doc."' " ;
$rs		= 	mysql_query (	$strop,$cn	);
$row_doc= 	mysql_fetch_array ($resultado_doc);
$cola   =	$row_doc['cola'];

session_id($_GET["idsesion"]);
session_start();
include('conex_inicial.php');


$ruc=$_REQUEST['ruc'];
$cliente=$_REQUEST['cliente'];

$cliente=ereg_replace ("%", "&", $cliente); 
$direccion=$_REQUEST['direccion'];
$serie=$_REQUEST['serie'];

$temp_turno=$_SESSION['turno'];
$strsql="select * from turno where nombre='$temp_turno'";
$resultado=mysql_query($strsql,$cn);
$row=mysql_fetch_array($resultado);
$hinicio=$row['hinicio'];
$hfin=$row['hfin'];
$fecha=date('Y-m-d',time()-3600);
$temp_caja=$_SESSION['codterminal'];

$strsql="select * from cab_mov where caja='$temp_caja' and substring(fecha,1,10)='$fecha' and substring(fecha,12,9) between '$hinicio' and '$hfin' ";
$resultado=mysql_query($strsql,$cn);
$cont=mysql_num_rows($resultado);
//echo $strsql;
$noperacion=$cont+1;
$cola="HP Deskjet D2300 series";

?>


<script LANGUAGE="JavaScript"> 

var  pc="<?php echo $_SESSION['pc_ingreso'] ?>";
var cola="<?php echo $cola?>";

function printer() 
{ 
vbPrintPage(); 
return false; 
} 
</script> 

<SCRIPT LANGUAGE="VBScript"> 
Sub window_onunload 
On Error Resume Next 
Set WB = nothing 
End Sub 
Sub vbPrintPage 
OLECMDID_PRINT = 6 
OLECMDEXECOPT_DONTPROMPTUSER = 2 
OLECMDEXECOPT_PROMPTUSER = 1 
On Error Resume Next 
WB.ExecWB OLECMDID_PRINT, OLECMDEXECOPT_DONTPROMPTUSER, OLECMDEXECOPT_PROMPTUSER 
End Sub 
</SCRIPT> 

<html>
<head>
<title>:::::IMPRIMIENDO::::</title>
<link rel="stylesheet" type="text/css" href="sample.css" />

<!-- special style sheet for printing -->
<style media="print">
.noprint     { display: none }
</style>


<style type="text/css">

.Estilo40 {font-family: Geneva, Arial, Helvetica, sans-serif ; font-size: 11px;}
.Estilo50 {font-size: 13px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.Estilo55 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}

</style>
</head>




    <script src="jquery-1.2.6.js"></script>
    <script src="jquery.hotkeys.js"></script>
	<script src="javascript/colaimp.js"></script>

<script>
jQuery(document).bind('keypress', 'return',function (evt){jQuery('#_return').addClass('dirty'); 

if(document.form2.temp_imp.value=='T'){
window.close();
}else{
alert('imprimiendo documento....');
}

return false; });

</script>


<script>
function terminar(){
var mesa=document.form1.numero_mesa.value;
if(mesa!=""){
//	if(confirm('Imprimiendo Documento....Desea continuar?')){
	//location.href='pedido.php';
	window.open('restaurante/comanda_mesa.php','principal');
	//window.open('pedido.php','','target=principal');
//	}else{
//	window.open('restaurante/comanda_mesa.php','principal');
//	}
}else{

//		if(confirm('Imprimiendo Documento....Desea continuar?')){
	//location.href='pedido.php';
//	window.open('pedido.php','principal');
	//window.open('pedido.php','','target=principal');
//	}else{
	window.open('pedido.php','principal');
//	}



}
	
//window.parent.parent.opener.recargar();
}

function defrente(){
window.focus();
	if(pc=="localhost"){
	
	viewinit1();
	Print(false, top);
	terminar();
	
	}else{
	//alert();
	printer();
	terminar();
	
	}
}
</script>


<!--onUnload="terminar()" onLoad="viewinit1();Print(false, top)"-->

<style type="text/css" media="print">
#imp {
visibility:hidden;
display:none;
};
</style>

<body onLoad="defrente()"  scroll="auto">
<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT> 
<!--onLoad="viewinit()-->

<?php if($_SESSION['pc_ingreso']=='localhost'){ ?>

<object id="secmgr" style="display:none" viewastext classid="clsid:5445BE81-B796-11D2-B931-002018654E2E" codebase="http://www.prolyam.com/restaurante/javascript/smsx.cab#Version=6.5.439.37">
<param name="GUID" value="{0ADB2135-6917-470B-B615-330DB4AE3701}">
<param name="Path" value="http://www.meadroid.com/scriptx/sxlic.mlf">
<param name="Revision" value="0">
<param name="PerUser" value="true">
</object>

<object id="factory" style="display:none" viewastext classid="clsid:1663ED61-23EB-11D2-B92F-008048FDD814" codebase="http://codestore.meadroid.com/products/scriptx/binary.ashx?version=6,5,439,50&filename=smsx.cab&x2ref=http://www.meadroid.com/scriptx/docs/samples/basic.asp#Version=6,5,439,50">
</object>
<?php }?>


<div id=imp  style="height:50">          Imprimiendo Documento.......<br>
  <table width="250" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="123"><span class="noprint" style="height:100"><span class="Estilo55">VUELTO: <?php echo $_REQUEST['vuelto']?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <script>
        </script>
    </span></td>
    <td width="127"><form name="form2" method="post" action="">
      <span class="noprint" style="height:100">
      <input type="button" name="Submit" value="    Aceptar   " onClick="javascript:window.close();">
      </span>
      <input type="hidden" name="temp_imp" value="">
    </form></td>
  </tr>
</table>
  <script>
</script>
</div>
<div id="installFailure" style="width:300px; height:1">
	
</div>


<div id="installOK" style="width:240px; height:10">



 <table width="242" border="0" cellpadding="0" cellspacing="0" align="center">
   <tr>
     <td colspan="3" align="center" ><p><span class="Estilo50">
       </span><span class="Estilo50"><?=$rowemp['des_suc']?></span><span class="Estilo50"><br> 
         R.U.C <?=$rowemp['ruc']?><br>
      <?=$rowti['direccion']?> - <?=$rowti['des_tienda']?> - <?=$rowti['telefono']?></span>
      <br></td>
    </tr>
   
   <tr>
    <td colspan="3"><table width="100%"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="18"  align="center"><span class="Estilo50">Nro.Serie S/N <?=$serie;?></span>       </td>
        </tr>
    </table>	</td>
    </tr>
   <tr>
     <td height="34" colspan="3" align="center"><span class="Estilo50"><?php echo date('d/m/Y H:i:s' ,time() - 3600);?>&nbsp;
	 <br><?php echo "N/O: ". str_pad($noperacion, 10, "0", STR_PAD_LEFT);?></span></td>
   </tr>
   <tr>
     <td height="22" colspan="3" align="center">---------------------------------------------</td>
   </tr>
   <tr>
     <td height="18" colspan="3" align="center"><span class="Estilo50">
       <?php 
		  if($ruc==""){
		  echo " Ticket BOLETA Nro. ";
		  }else{
		  echo "Ticket FACTURA Nro. ";
		  }
		  
		  ?>
       <?php echo $serie."-".$_REQUEST['numero'] ?></span>	   </td>
   </tr>
   <tr>
     <td height="23" colspan="3" align="center">---------------------------------------------</td>
   </tr>
   <?php if($ruc!=""){?>
   <tr>
     <td colspan="3"><span class="Estilo50">Cliente:<?php echo $cliente?><br>
       Ruc:<?php echo $ruc?><br>
       Direccin:<?php echo $direccion?></span></td>
   </tr>
   <tr>
    <td colspan="3">---------------------------------------------</td>
    </tr>
	
	
  
<?php }?>

 <tr>
     <td colspan="3" align="left" valign="baseline">
	 
	 <table width="236" border="0" cellpadding="0" cellspacing="0">
         <tr>
           <td width="33"><span class="Estilo50">Cant</span></td>
           <td width="137"><span class="Estilo50">Producto </span></td>
           <td width="66" align="right"><span class="Estilo50">Total S/.</span> </td>
         </tr>
     </table></td>
   </tr>
   <tr>
     <td colspan="3">---------------------------------------------</td>
   </tr>


<?php

$vuelto=$_REQUEST['vuelto'];
$moneda_v=$_REQUEST['moneda_v'];
//$direccion=$_REQUEST[''];
$mesa=$_REQUEST['mesa'];
$fecha=date('Y-m-d H:i:s' ,time() - 3600);

if($mesa!=""){
$strSQLL="update mesa set estado='L' where id=$mesa";
mysql_query($strSQLL);
$strSQLD="delete from comanda where mesa=$mesa";
mysql_query($strSQLD);

}


if($moneda_v=="S"){
$moneda_v="soles";}
if($moneda_v=="D"){
$moneda_v="dolares";}


  $strSQL22="select max(cod_cab) as codigo from cab_mov";
  $resultado22=mysql_query($strSQL22,$cn);
  $row22=mysql_fetch_array($resultado22);
  
  
  $var22=$row22['codigo']+1;
  $cod_cab2=str_pad($var22, 6, "0", STR_PAD_LEFT);
  mysql_free_result($resultado22);
   
  //$strSQL221="update det_mov set cod_cab='$cod_cab2',fechad='$fecha' where cod_cab='".$_SESSION['registro']."'";
  //mysql_query($strSQL221,$cn);
 
 $tipo_mov=2;
 
  foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
 
 $strSQL4="select * from producto where idproducto='".$subvalue."' ";
 $resultado4=mysql_query($strSQL4,$cn);
 while($row4=mysql_fetch_array($resultado4)){
 
  $strSQL4= "insert into det_mov(cod_cab,tipo,cod_prod,nom_prod,precio,cantidad,notas,fechad) values ('".$cod_cab2."','".$tipo_mov."','".$row4['idproducto']."','".$row4['nombre']."','".$_SESSION['productos'][2][$subkey]."','".$_SESSION['productos'][1][$subkey]."','".$notas."','".$fecha."')";
	  mysql_query($strSQL4);
 
	
 
 
 }}
 
 
 
 
 //-------------------------------------------------------------
// $i_1=0;
// while($i_1!=1){
 
	$strSQL_1="select * from pagos where referencia='".$_SESSION['registro']."'";
	$resultado_1=mysql_query($strSQL_1,$cn);
	$temp_1=mysql_num_rows($resultado_1);

//	if($temp_1==1){ 
	$strSQL222="update pagos set referencia='$cod_cab2',vuelto='$vuelto',moneda_v='$moneda_v',fechap='$fecha' where referencia='".$_SESSION['registro']."'";
	mysql_query($strSQL222,$cn);
//	$i_1=1;
	
	//echo "$strSQL222 <br> i=$i_1";
	
//	}
//  }	
	


 //-------------------------------------------------------------
 
 
// echo $strSQL222;
 
 

$num_doc=$_REQUEST['numero'];

$cod_vendedor=$_SESSION['codvendedor'];
$cod_terminal=$_SESSION['codterminal'];


$tc=$_REQUEST['tc'];
$f_venc="";

$importe=$_REQUEST['importe'];

  
  $b_imp=number_format(($importe/1.19),2);
  $igv=number_format($importe-$b_imp,2);
  
//$servicio=$importe-($b_imp+$igv);

$total=$b_imp+$igv;//+$servicio;

$cod_ope=$_REQUEST['operacion'];

$moneda="01";
$tipo_mov="2";

$strSQL44="insert into cab_mov(cod_cab,tipo,cod_ope,num_doc,serie,cod_vendedor,caja,cliente,ruc,fecha,f_venc,moneda,tc,b_imp,igv,servicio,total,saldo,tienda,sucursal,noperacion) values ('".$cod_cab2."','".$tipo_mov."','".$cod_ope."','".$num_doc."','".$serie."','".$cod_vendedor."','".$cod_terminal."','".$cliente."','".$ruc."','".$fecha."','".$fecha."','".$moneda."','".$tc."','".$b_imp."','".$igv."','".$servicio."','".$total."','".$saldo."','".$_SESSION['tienda']."','".$_SESSION['sucursal']."','".$noperacion."')";

	mysql_query($strSQL44,$cn);
   
      
	  if($mesa!=""){
	  $strSQL="update det_mov set cod_cab='".$cod_cab2."' where  cod_cab='".$_SESSION['registro']."'";
	  mysql_query($strSQL);
	  }
	  
//----------------------------------------------------------------------------------------
   $nitems=0;

  foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
 
 $strSQL4="select * from producto where idproducto='".$subvalue."' ";
 $resultado4=mysql_query($strSQL4,$cn);
$row4=mysql_fetch_array($resultado4);
// echo $strSQL4;

 $nitems=$nitems+1;
 ?>

    <td width="17"><span class="Estilo50"><?php echo $_SESSION['productos'][1][$subkey];?></span></td>
    <td width="175"><span class="Estilo50"><?php echo substr($row4['nombre'],0,20);?></span></td>
    <td width="51" align="right"><span class="Estilo50"><?php 
	
	$total=$_SESSION['productos'][2][$subkey]*$_SESSION['productos'][1][$subkey];
	echo number_format($total,2);
	?></span></td>
    </tr>
  <?php 
  
    if($row4['kardex']=='S'){
  
   $strSQL400="update producto set saldo101=saldo101-'".$_SESSION['productos'][1][$subkey]."' where idproducto='".$row4['idproducto']."' ";
   mysql_query($strSQL400,$cn);
	   
	 }  
 // echo $strSQL400;
} 
   
   
  $str_items="update cab_mov set items='".$nitems."' where cod_cab='".$cod_cab2."'";
  mysql_query($str_items,$cn);
  
  
  
  
  
  ?>  
  
  <tr>
    <td colspan="3">---------------------------------------------</td>
    </tr>
	<?php if($ruc!=""){?>
  <tr>
    <td colspan="2"><span class="Estilo50">***Valor de Venta S/. </span></td>
    <td align="right"><span class="Estilo50"><?php echo number_format($b_imp,2);?></span></td>
    </tr>
  <tr>
    <td colspan="2"><span class="Estilo50">***Igv : 19%</span></td>
    <td align="right"><span class="Estilo50"><?php echo number_format($igv,2) ?></span></td>
    </tr>
	<?php }?>
	
  <tr style="display:none">
    <td colspan="2"><span class="Estilo50">***Servicio</span></td>
    <td align="right"><span class="Estilo50"><?php echo number_format($servicio,2)?></span></td>
    </tr>
  <tr>
    <td colspan="2"><span class="Estilo50">***TOTAL VENTAS/.</span></td>
    <td align="right"><span class="Estilo50"><?php echo number_format($importe,2);?></span></td>
    </tr>
  <tr>
    <td colspan="2"><span class="Estilo50">VUELTO:<?php echo number_format($vuelto,2);?></span></td>
    <td align="right">&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan="2"><span class="Estilo50">USUARIO:<?php echo  $_SESSION['user']; echo "<script>document.form2.temp_imp.value='T'</script>" ?></span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">---------------------------------------------</td>
    </tr>
  <tr>
    <td colspan="3" align="center"><span class="Estilo50">NO SE ACEPTAN DEVOLUCIONES<br>Gracias por su Preferencia </span></td>
    </tr>
</table>



 <div id=idControls class="noprint">
 <b>Botones para Impresion directa</b>

	 <div id="idBtn">

    </div>

     <form name="form1" method="post" action="">
       <input type="hidden" name="numero_mesa" value="<?php echo $mesa?>">
     </form>
    <p><b>Select the template type to use: </b><select onChange="newTemplate(this)" size="1"><option value="default">Default</option><option value="IE55">IE 5.5/6</option><option selected value="IE7">IE 7</option></select></p>



	</div>

</div>

</body>
</html>
