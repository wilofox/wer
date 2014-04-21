<?php 
session_start();
include('conex_inicial.php');
include('funciones/funciones.php');

//$fecha=gmdate('Y-m-d',time()-18000);
$hora=gmdate('h:i:s a',time()-18000);

//$fecha="2011-11-02";
//$hora=date( 'H:i:s a' ,time() - 3600);
$t_doc='TB';

$tcierre=$_REQUEST['series'];

$series=$tcierre;

//echo $series;

if(isset($_REQUEST['responsable']) && $_REQUEST['responsable']==""){
$filtro=" ";
}

if(isset($_REQUEST['responsable']) && $_REQUEST['responsable']!=""){
$filtro= " and cod_vendedor='".$_REQUEST['responsable']."' ";
$codRespons=$_REQUEST['responsable'];
}

if(!isset($_REQUEST['responsable'])){
$filtro= " and cod_vendedor='".$_REQUEST['responsable2']."' ";
$codRespons=$_REQUEST['responsable2'];
}

if(!isset($_REQUEST['tcierre'])){
//$series=$_REQUEST['tcierre2'];
}

if($_SESSION['nivel_usu']=='4' || $_SESSION['nivel_usu']=='5' ){
	$deshabilitar="";
	$fecha_visible=" style='visibility:visible' ";
	$fecha=extraefecha4($_REQUEST['fecha']);
	$fecha_imp=$_REQUEST['fecha'];
}else{
	$deshabilitar="disabled='disabled'";
	$fecha_visible=" style='visibility:hidden' ";
	$fecha=gmdate('Y-m-d',time()-18000);
	$fecha_imp=gmdate('d-m-Y',time()-18000);
}

$strSQLC="select max(fecha) from cierre where caja='".$series."' and operador='".$_REQUEST['responsable']."' ";

$resultadoC=mysql_query($strSQLC,$cn);
$rowC=mysql_fetch_array($resultadoC);

if($rowC[0]==NULL){
	$fechaIniCierre="0000-00-00 00:00:00";
}else{
	$fechaIniCierre=$rowC[0];
}
	$fechaFinCierre=($_REQUEST['fecha']);

for($j=0;$j<=2;$j++){	
	if($j==0) $t_doc='TB';
	if($j==1) $t_doc='TF';
	if($j==2) $t_doc='TN';

	$strSQL="select substring(fecha,1,10) as fecha,num_doc,serie from cab_mov where cod_cab=(select min(cod_cab) from cab_mov where substring(fecha,1,10)='$fecha' and cod_ope='$t_doc' and pc='$series' and flag!='A' $filtro ) or cod_cab=(select max(cod_cab) from cab_mov where fecha between '$fechaIniCierre' and '$fechaFinCierre' and cod_ope='$t_doc' and pc='$series' and flag!='A' $filtro ) ORDER BY num_doc";
					
	//echo $strSQL.'<br>';
			
	$resultado=mysql_query($strSQL,$cn);
	$cont=mysql_num_rows($resultado);
	$i=1;
	while($row=mysql_fetch_array($resultado)){
		if($i==1){$doc_ini_b[]=$row['serie']."-".$row['num_doc'];}
		if($i==2 or $cont==1){$doc_fin_b[]=$row['serie']."-".$row['num_doc'];}
		$i=$i+1;
		//$fecha=$row['fecha'];
		//$td1='BV';
	}
	
	if($cont==0){
		$doc_ini_b[]=$row['serie']."-".$row['num_doc'];
		$doc_fin_b[]=$row['serie']."-".$row['num_doc'];
		$i=$i+1;
	}
	
	mysql_free_result($resultado);
	
	$strSQL2="SELECT count(cod_cab) as cantidad,sum(b_imp) as importe,sum(igv) as igv,sum(servicio) as servicio, sum(total) as total,sum(percepcion) as percepcion  from cab_mov WHERE  fecha between '$fechaIniCierre' and '$fechaFinCierre'  and cod_ope='$t_doc' and pc='$series' and flag!='A' $filtro ";
	//echo $strSQL2."<br>";
	$resultado2=mysql_query($strSQL2,$cn);
	$row2=mysql_fetch_array($resultado2);
	$cantidad[]=$row2['cantidad'];
	$importe[]=$row2['importe'];
	$igv[]=$row2['igv'];
	$servicio[]=$row2['servicio'];
	$total[]=$row2['total'];
	$percepcion[]=$row2['percepcion'];
	
	
	mysql_free_result($resultado2);


	$strSQL3="select sum(total) as total, count(serie) as cantidad from cab_mov where fecha between '$fechaIniCierre' and '$fechaFinCierre' and cod_ope='$t_doc' and pc='$series' and flag='A' $filtro ";
	$resultado3=mysql_query($strSQL3,$cn);
	$row3=mysql_fetch_array($resultado3);
	$cant_anu[]=$row3['cantidad'];
	$total_anu[]=$row3['total'];

//$t_doc='TF';
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo18 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px; }
.Estilo19 {font-size: 16}
.Estilo21 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px; font-weight: bold; }
.Estilo22 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 16px;
}
.Estilo25 {color: #990000}
.Estilo26 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 16px;
}
-->
</style>
</head>


<link href="styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
<style type="text/css">
<!--
.Estilo18 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12; }
.Estilo19 {font-size: 12}
.Estilo21 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12; font-weight: bold; }
.Estilo22 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 11px;
}
.Estilo25 {color: #990000}
.Estilo26 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 10px;
}
-->
</style>
-->
</style>


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

<script language="javascript"> 
function printer() 
{ 
vbPrintPage(); 
return false; 
} 

function defrente(){
//window.focus();

	//if(pc=="localhost"){
	//viewinit1();
	//Print(false, top);
	//}else{
	printer();
	
	//}
	
}

</script> 
<!--onLoad="defrente()"-->
<body onLoad="defrente()">
<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>

<table width="334" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="20">&nbsp;</td>
    <td width="298">&nbsp;</td>
    <td width="16">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table width="290" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tr>
        <td colspan="4" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4" align="center"><span class="Estilo21">CIERRE PARCIAL DE CAJA </span></td>
      </tr>
      <tr>
        <td colspan="4" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><span class="Estilo18">Maquina Registradora </span></td>
        <td width="7"><span class="Estilo18">:</span></td>
        <td width="99" align="right"><span class="Estilo18">FFGF007572</span></td>
      </tr>
      <tr>
        <td width="167"><span class="Estilo18">Fecha</span></td>
        <td width="17"><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $fecha_imp ?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Hora</span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $hora?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Tipo de Cambio </span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($tc,2)?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Pto. Venta </span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19">
		
		<?php
		/*
		 $strSQLUser="select *  from caja where serie1='".$series."'";
		 $resultadoUser=mysql_query($strSQLUser,$cn);
		 $rowUser=mysql_fetch_array($resultadoUser);
		 echo $rowUser['descripcion'];
		 */
		 echo $series;
		 ?>
		
		</span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Operador</span></td>
        <td>&nbsp;</td>
        <td><span class="Estilo18">:</span></td>
        <td align="right">
		
		<?php
		 $strSQLUser="select * from usuarios where codigo='".$codRespons."'";
		 $resultadoUser=mysql_query($strSQLUser,$cn);
		 $rowUser=mysql_fetch_array($resultadoUser);
		 echo $rowUser['usuario'];
		 
		 ?>		</td>
      </tr>
      <tr>
        <td colspan="4"><span class="Estilo18">----------------------------------------------------------</span></td>
      </tr>
      <tr>
        <td colspan="4" align="center"><span class="Estilo21">REPORTE DE TICKETS BOLETA </span></td>
      </tr>
      <tr>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
      </tr>
      <tr>
        <td colspan="2"><span class="Estilo18">Nro de Transacciones </span><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $cantidad[0]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Nro Ticket Inicial </span></td>
        <td>&nbsp;</td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $doc_ini_b[0]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Nro Ticket Final </span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $doc_fin_b[0]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Valor de Venta </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $importe[0]?></span></td>
      </tr>
     <!--
	  <tr>
        <td><span class="Estilo18">Servicios(13%)</span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php //echo $servicio[0]?></span></td>
      </tr>
	-->	  
      <tr>
        <td><span class="Estilo18">I.G.V.</span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $igv[0]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Venta Total del D&iacute;a </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $total[0]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total Percepci&oacute;n</span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo18">:</span></td>
        <td align="right"><span class="Estilo19"><?php echo $percepcion[0]?></span></td>
      </tr>
      <tr>
        <td colspan="2"><span class="Estilo18">Nro Tickets Anulados </span><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $cant_anu[0];?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total Ticket Anulado </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($total_anu[0],2)?></span></td>
      </tr>
      <tr>
        <td colspan="4"><span class="Estilo18">----------------------------------------------------------</span></td>
      </tr>
      <tr>
        <td colspan="4" align="center"><span class="Estilo21">REPORTE DE TICKETS FACTURA </span></td>
      </tr>
      <tr>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
      </tr>
      <tr>
        <td colspan="2"><span class="Estilo18">Nro de Transacciones </span><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $cantidad[1]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Nro Ticket Inicial </span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $doc_ini_b[1]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Nro Ticket Final </span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $doc_fin_b[1]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Valor de Venta </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $importe[1]?></span></td>
      </tr>
     <!--
	  <tr>
        <td><span class="Estilo18">Servicios(13%)</span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php //echo $servicio[1]?></span></td>
      </tr>
	-->		  
      <tr>
        <td><span class="Estilo18">I.G.V.</span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $igv[1]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Venta Total del Dia </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($total[1],2)?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total Percepci&oacute;n </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo18">:</span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($percepcion[1],2)?></span></td>
      </tr>
      <tr>
        <td colspan="2"><span class="Estilo18">Nro Tickets Anulados </span><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $cant_anu[1]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total Ticket Anulado </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($total_anu[1],2)?></span></td>
      </tr>
      <tr>
        <td colspan="4"><span class="Estilo18">----------------------------------------------------------</span></td>
      </tr>
      <tr>
        <td colspan="4" align="center"><span class="Estilo21">REPORTE DE TICKETS NOTA CREDITO </span></td>
      </tr>
      <tr>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
      </tr>
      <tr>
        <td colspan="2"><span class="Estilo18">Nro de Transacciones </span><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $cantidad[2]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Nro Ticket Inicial </span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $doc_ini_b[2]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Nro Ticket Final </span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $doc_fin_b[2]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Valor de Venta </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $importe[2]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">I.G.V.</span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $igv[2]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Venta Total del Dia </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($total[2],2)?></span></td>
      </tr>
      <tr>
        <td colspan="2"><span class="Estilo18">Nro Tickets Anulados </span><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $cant_anu[2]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total Ticket Anulado </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($total_anu[2],2)?></span></td>
      </tr>
      <tr>
        <td colspan="4"><span class="Estilo18">----------------------------------------------------------</span></td>
      </tr>
      <tr>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo18">Gran Total </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo18">:</span></td>
        <td><span class="Estilo19"></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total(z)</span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
      </tr>
      <tr>
        <td colspan="4"><span class="Estilo18">----------------------------------------------------------</span></td>
      </tr>
      <tr>
        <td height="24" colspan="4" align="center"><span class="Estilo21">RESUMEN DE VENTAS </span></td>
      </tr>
      <tr>
        <td height="24" colspan="4" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total Ticket. Boleta </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($total[0],2)?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total Ticket Factura </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($total[1],2)?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total Ticket Nota Credito </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td>:</td>
        <td align="right"><span class="Estilo19"><?php echo "-".number_format($total[2],2)?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total Boletas </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19">0.00</span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total Facturas </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19">0.00</span></td>
      </tr>
      <tr>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td align="right"><span class="Estilo18">----------</span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total General </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($total[0]+$total[1]-$total[2],2);?></span></td>
      </tr>
      <tr>
        <td colspan="4"><span class="Estilo18">----------------------------------------------------------</span></td>
      </tr>
      <tr>
        <td colspan="4" align="center"><span class="Estilo21">PLANILLA DE COBRANZA </span></td>
      </tr>
      <tr>
        <td colspan="4" align="center">&nbsp;</td>
      </tr>
      <?php 
	  
	  
	///--------------------------------Ticket Nota de credito--------------------------------------------------
	
	// ----DOCUMENTOS SOLES---
	$strSQLTN="select sum(total) as total from cab_mov c where cod_ope='TN' and  c.fecha between '$fechaIniCierre' and '$fechaFinCierre'  and c.pc='$series' and c.flag!='A' and c.moneda='01' $filtro ";
  //echo $strSQL2;
   $resultadoTN=mysql_query($strSQLTN,$cn);
  $rowTN=mysql_fetch_array($resultadoTN);
  $efectivo_TN_soles=$rowTN['total'];  
	 
	// echo  $efectivo_TN_soles;
	 
   // ----DOCUMENTOS DOLARES---
	$strSQLTN="select sum(total) as total from cab_mov c where cod_ope='TN' and  c.fecha between '$fechaIniCierre' and '$fechaFinCierre'  and c.pc='$series' and c.flag!='A' and c.moneda='02' $filtro ";
  //echo $strSQL2;
   $resultadoTN=mysql_query($strSQLTN,$cn);
  $rowTN=mysql_fetch_array($resultadoTN);
  $efectivo_TN_dolares=$rowTN['total'];  
	 
	// echo  $efectivo_TN_dolares;
	 
	 	 
  //---------------------------ventas por tipo de pagoo----------------------------------
  
  $strSQL="SELECT sum(total) as total, p.t_pago,t.descripcion from cab_mov,pagos p,t_pago t where t.id=p.t_pago and p.referencia=cod_cab and  cab_mov.fecha between '$fechaIniCierre' and '$fechaFinCierre' and cab_mov.pc='$series' and flag!='A' $filtro group by p.t_pago";
  //echo $strSQL;
  $resultado=mysql_query($strSQL,$cn);
  while($row=mysql_fetch_array($resultado)){
  
	$tot_pago[]=$row['total'];
	$descripcion[]=$row['descripcion'];	
	
	if($row['descripcion']=='Efectivo'){
	$efectivo=$row['total'];
	}
  }
  
  $efectivo=$efectivo-$efectivo_TN_soles;
  
  
  mysql_free_result($resultado);
  
  $strSQL2="select sum(monto) as total, sum(vuelto) as vuelto from cab_mov c,pagos p where t_pago='1' and p.moneda='01'and referencia=c.cod_cab and  c.fecha between '$fechaIniCierre' and '$fechaFinCierre'  and c.pc='$series' and c.flag!='A' $filtro ";
  //echo $strSQL2;
   $resultado2=mysql_query($strSQL2,$cn);
  $row2=mysql_fetch_array($resultado2);
  $efectivo_bruto=$row2['total']-$efectivo_TN_soles;
  $vuelto_soles=$row2['vuelto'];
  
  
  $strSQL3="select sum(monto) as dolares, sum(vuelto) as vuelto from cab_mov c,pagos p where t_pago='1' and p.moneda='02' and referencia=c.cod_cab and  c.fecha between '$fechaIniCierre' and '$fechaFinCierre'  and c.pc='$series' and c.flag!='A' $filtro ";
   $resultado3=mysql_query($strSQL3,$cn);
  $row3=mysql_fetch_array($resultado3);
  $dolares_bruto=$row3['dolares']-$efectivo_TN_dolares;
  $vuelto_dolares=$row3['vuelto'];
  
  ?>
      <tr>
        <td><span class="Estilo18">EFECTIVO </span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo19">&nbsp;&nbsp;&nbsp;S/.:</span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right"><span class="Estilo19"><?php echo number_format($efectivo_bruto,2)?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18"><span class="Estilo19">&nbsp;</span><span class="Estilo19">&nbsp;</span><span class="Estilo19">&nbsp;</span><span class="Estilo19"> </span>Vuelto</span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right"><span class="Estilo19"><?php echo number_format($vuelto_soles,2)?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18"><span class="Estilo19">&nbsp;</span><span class="Estilo19">&nbsp;</span><span class="Estilo19">&nbsp; </span>Neto</span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php
		 $tempTotal1=number_format($efectivo_bruto-$vuelto_soles,2);
		 echo number_format($efectivo_bruto-$vuelto_soles,2);
		 
		 ?></span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo19">&nbsp;</span><span class="Estilo19">&nbsp;</span><span class="Estilo19">&nbsp;</span>US$.:</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right"><span class="Estilo19"><?php echo number_format($dolares_bruto,2)?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18"><span class="Estilo19">&nbsp;</span><span class="Estilo19"> &nbsp; Neto U$. a S/. </span></span></td>
        <td><span class="Estilo19">.</span></td>
        <td>&nbsp;</td>
        <td align="right"><span class="Estilo19"><?php echo number_format($dolares_bruto*$tc,2)?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18"><span class="Estilo19">&nbsp;</span><span class="Estilo19">&nbsp;&nbsp; Vuelto</span></span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right"><span class="Estilo19"><?php echo number_format($vuelto_dolares,2)?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo19">&nbsp;</span><span class="Estilo19">&nbsp;<span class="Estilo18">&nbsp; Neto</span></span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right"><span class="Estilo19"><?php
		 $tempTotal2=number_format(($dolares_bruto*$tc)-$vuelto_dolares,2);
		 echo number_format(($dolares_bruto*$tc)-$vuelto_dolares,2);
		 
		 ?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo19">&nbsp;</span><span class="Estilo19">&nbsp;</span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4"><span class="Estilo18">TARJETA EN SOLES </span></td>
      </tr>
      <tr>
        <td colspan="4"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <?php 
	// print_r($tot_pago);
	// print_r($descripcion);
	 for($k=0;$k<count($tot_pago);$k++){
	 
	    if($descripcion[$k]!='Efectivo'){
		$total_tarjeta=$total_tarjeta+$tot_pago[$k];
	 ?>
            <tr>
              <td width="58%"><span class="Estilo18"><?php echo $descripcion[$k]?></span></td>
              <td width="6%"><span class="Estilo19">S/.</span></td>
              <td width="3%"><span class="Estilo19"><span class="Estilo18">:</span></span></td>
              <td width="33%" align="right"><span class="Estilo19"><?php echo number_format($tot_pago[$k],2)?></span></td>
            </tr>
            <?php
	    }
	  }
	   ?>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right"><span class="Estilo18">----------</span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total Tarjeta </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($total_tarjeta,2)?></span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total General </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($efectivo+$total_tarjeta,2)?></span></td>
      </tr>
      <tr>
        <td colspan="4"><span class="Estilo18">----------------------------------------------------------</span></td>
      </tr>
      <tr>
        <td colspan="4" align="center"><span class="Estilo19"><span class="Estilo21">ARQUEO DE CAJA </span></span></td>
      </tr>
      <tr>
        <td colspan="4" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo19"><span class="Estilo18">Total Efectivo </span></span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($tempTotal1+$tempTotal2,2); ?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo19"><span class="Estilo18">Total en Caja </span></span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($efectivo+$total_tarjeta,2)?></span></td>
      </tr>
      <tr>
        <td colspan="4"><span class="Estilo19"></span><span class="Estilo19"></span><span class="Estilo19"></span><span class="Estilo19">-----------------------------------------------------------------------</span></td>
      </tr>
      <tr>
        <td colspan="4" align="center"><span class="Estilo19"></span><span class="Estilo19"></span><span class="Estilo19"></span><span class="Estilo19"><span class="Estilo21">VENTAS POR PRODUCTO </span></span></td>
      </tr>
      <tr>
        <td colspan="4" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
      </tr>
      <tr>
        <td colspan="4"><span class="Estilo19"></span><span class="Estilo19"></span><span class="Estilo19"></span>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <?php 
  
  $strSQL="SELECT cod_prod, sum(if(c.cod_ope!='TN',cantidad,-cantidad))  as cantidad,nom_prod, sum(if(c.cod_ope!='TN',precio*cantidad , -precio*cantidad) ) as totales from cab_mov c,det_mov d where c.cod_cab=d.cod_cab and  c.fecha between '$fechaIniCierre' and '$fechaFinCierre'  and c.pc='$series' and c.flag!='A' $filtro group by cod_prod,nom_prod";
  
  //echo $strSQL;
  $resultado=mysql_query($strSQL,$cn);
  while($row=mysql_fetch_array($resultado)){
  
  $tot=$tot+$row['totales'];
  ?>
              <tr>
                <td width="74%"><span class="Estilo19"><span class="Estilo18"><?php echo substr($row['nom_prod'],0,26);?></span></span></td>
                <td width="14%"><span class="Estilo19"><?php echo $row['cantidad']?></span></td>
                <td width="12%" align="right"><span class="Estilo19"><?php echo number_format($row['totales'],2)?></span></td>
              </tr>
              <?php 
		}
		mysql_free_result($resultado); 
		
		?>
            </table>          </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right"><span class="Estilo18">----------</span></td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo19"><span class="Estilo18">Total General</span></span> </td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($tot,2)?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
      </tr>
      <tr>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
      </tr>
      <tr>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
      </tr>
      <tr>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
      </tr>
      <tr>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
      </tr>
      <tr>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>

<?php 

if($_REQUEST['cierreModo']=='TOTAL'){
	
$fecha_cierre=$_REQUEST['fecha'];
$operador=$codRespons;
$caja_cierre=$_REQUEST['series'];

$resultado3=mysql_query("select max(id) as codigo from cierre",$cn);
			$row3=mysql_fetch_array($resultado3);
			
			$codigo77=$row3['codigo'];
			$codigo77=$codigo77+1;

	$strSQL77="insert into cierre(id,fecha,operador,total,caja,user_aud,pc_aud,fecha_aud) values ('".$codigo77."','".$fecha_cierre."','".$operador."','".number_format($total[0]+$total[1],2)."','".$caja_cierre."','".$_SESSION['codvendedor']."','".$_SESSION['pc_ingreso']."','".date('Y-m-d H:i:s')."')";
	//echo $strSQL77;
	mysql_query($strSQL77,$cn);	

}
?>