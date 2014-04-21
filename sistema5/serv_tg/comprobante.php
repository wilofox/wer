<?php session_start();
include("../conex_inicial.php");
$Codigo=$_REQUEST['codigo'];
$url=$_REQUEST['url'];


$sql="select * from cab_mov CM inner join det_mov DM on CM.cod_cab=DM.cod_cab
 where CM.cod_cab='$Codigo'  ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	//echo $rowX['cod_cab'];	
	
	//datos del docuemnto
	$total_doc=$rowX['total']; 
	$tmoneda=$rowX['moneda'];
	$tcambio=$rowX['tc'];
	$sucursal=$rowX['sucursal'];
	$tienda=$rowX['tienda'];
	$responsable=$rowX['cod_vendedor'];
	$incluidoigv=$rowX['incluidoigv'];
	$impto=$rowX['impto1']/100;
	$impuesto1=$rowX['igv'];
	$baseimp=$rowX['b_imp'];
	$codcliente=$rowX['cliente'];
	
	$serie_ref=$rowX['serie'];
	$correlativo_ref=$rowX['Num_doc'];
	$total_ref=$rowX['total'];
	
	//Sesion detalle de documento	
	$_SESSION['productos3'][0][] = $rowX['cod_prod']; //$cod_prod;
	$_SESSION['productos3'][1][] = $rowX['cantidad']; //$cantidad;
	$_SESSION['productos3'][2][] = $rowX['precio']; //$punitario;
	$_SESSION['productos3'][3][] = $rowX['notas']; //$notas;
	$_SESSION['productos3'][4][] = $rowX['unidad']; //$presentacion;
	$_SESSION['productos3'][5][] = $rowX['unidad']; //$presentacion;
	$_SESSION['productos3'][6][] = $rowX['precosto']; //$precosto;	
	
}

/*foreach ($_SESSION['productos3'][0]  as $subkey => $subvalue) {
	echo $_SESSION['productos3'][0][$subkey]."<br>";
}*/

//$urlRk= "../empresa.php?total_doc=150.00&moneda_doc=02&tcambio_doc=2.62&sucursal=1&tienda=101&responsable=003&incluidoigv=S&impto=0.18&impuesto1=22.88&baseimp=127.12" ;

//../empresa.php
$urlRk= "../empresa.php?total_doc=".$total_doc.'&moneda_doc='.$tmoneda.'&tcambio_doc='.$tcambio.'&sucursal='.$sucursal.'&tienda='.$tienda.'&responsable='.$responsable.'&incluidoigv='.$incluidoigv.'&impto='.$impto.'&impuesto1='.$impuesto1.'&baseimp='.$baseimp.'&codcliente='.$codcliente.'&condicionRk=RA' ;

if ($_REQUEST['referencia']=='doc'){
		$SQLRef1="SELECT * FROM cab_mov ORDER BY cod_cab DESC ";
		$resultadoR=mysql_query($SQLRef1,$cn);
		$rowR=mysql_fetch_array($resultadoR);
		$codigo_ref2=$rowR['cod_cab'];
	
	if ($codcliente==$rowR['cliente'] and $rowR['total']==$total_ref ){
		$strSQL0025="select  max(id) as id from referencia";
		$resultado0025=mysql_query($strSQL0025,$cn);
		$row0025=mysql_fetch_array($resultado0025);
		$codigo_ref=$row0025['id']+1;
		
		$strSQL_ref="insert into referencia (id,cod_cab,serie,correlativo,cod_cab_ref)values('".$codigo_ref."','".$codigo_ref2."','".$serie_ref."','".$correlativo_ref."','".$Codigo."')";	
		mysql_query($strSQL_ref,$cn);
			
		echo $strSQL_ref2="update cab_mov set flag_r=CONCAT(flag_r,'RO') where cod_cab='".$Codigo."'";
		mysql_query($strSQL_ref2);
		echo $strSQL_ref2="update cab_mov set flag_r=CONCAT(flag_r,'RA') where cod_cab='".$codigo_ref2."'";
		mysql_query($strSQL_ref2);
	}
	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Caja Recaudaci&oacute;n</title>
</head>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo15 {font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo25 {font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #FFFFFF; }
.Estilo27 {font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #003366; }
.Estilo48 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #FFFFFF; }
.Estilo49 {font-size: 11px; color: #FFFFFF; font-family: Arial, Helvetica, sans-serif;}
.Estilo53 {color: #A82222}
.Estilo54 {font-size: 14px}
.Estilo55 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	color: #CC0000;
}
-->
</style>
<link href="../styles.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../miAJAXlib2.js"></script>
<script src="../jquery-1.2.6.js"></script>
<script src="../jquery.hotkeys.js"></script>
<script language="JavaScript">
jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_esc').addClass('dirty'); 
close()
return false; });
</script>
<body onUnload="Finalizar('<?=$Codigo;?>');vaciar_sesiones()" >
<div align="center">
 <iframe width="585" height="485" id="comprobante"
name="comprobante" marginwidth=0 marginheight=0 src="<?=$urlRk;?>" 
frameborder=0  style="border:#000000;"> </iframe>
</div>
</body>
</html>
<script>
function Finalizar(codigo){
//showModalDialog
var datos = window.open("comprobante.php?referencia=doc&codigo="+codigo,"comprobante","dialogWidth:200px;dialogHeight:200px,top=100,left=200,status=yes,scrollbars=yes");
}
function vaciar_sesiones(){
//alert(2);
doAjax('../compras/vaciar_sesiones.php','','','get','0','1','','');
}
</script>