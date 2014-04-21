<?php 
session_start();
include_once('mcc/MLetras.php');
include_once('../funciones/funciones.php');

$ml=new MLetras();
$ml->multi_id=$_REQUEST['codigo'];
$listacanje=$ml->MostrarDatosCanje();
//print_r($listacanje);
if($listacanje[0]['tipo']=='1'){
	$titulo="Proveedores";
}else{
	$titulo="Clientes";
}
if(isset($_REQUEST['excel'])){
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=excel.xls");
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script language="javascript">
function Enviar(inf){
	codigo="<?php echo $_REQUEST['codigo']; ?>";
	location.href('canjevoucher.php?'+inf+'&codigo='+codigo);
}
function Imprimir(){
	Enviar('print');
}
function Excel(){
	Enviar('excel');
}
</script>
</head>

<body>
<table width="735" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="281" align="left" style="font-size:10px; font-style:italic; height:3px;"><b><?php echo $listacanje[0]['empresa'];?></b></td>
	<td width="60"></td>
	<td width="261"></td>
	<td width="1"></td>
	<td width="132"></td>
</tr>
<tr>
	<td align="left" style="font-size:10px; font-style:italic"><b>ProlyanRP - Sistema Web</b></td>
	<td colspan="2" align="right" style="font-size:10px; font-style:italic; height:3px;">Fecha...:</td>
	<td colspan="2" style="font-size:10px; height:3px;"><?php echo gmdate('d/m/Y',time()-18000);?></td>
</tr>
<tr>
	<td></td>
	<td colspan="2" align="right" style="font-size:10px; font-style:italic; height:3px;">Hora...:</td>
	<td colspan="2" style="font-size:10px; height:3px;"><?php echo gmdate('H:i:s',time()-18000);?></td>
</tr>
<tr>
	<td colspan="5" align="center" style="font-size:16px; height:3px;"><b>&nbsp;<font style="text-decoration:underline">Canjes por Letras - <?php echo $titulo; ?></font>&nbsp;</b></td>
</tr>
<tr>
	<td colspan="5" align="center" style="font-size:9px; height:3px;"><b>&nbsp;</b></td>
</tr>
<tr>
	<td height="25" colspan="5" align="center"><table border="0">
	<tr style="font-size:12px">
		<td align="left" colspan="4"><span><b>&nbsp;&nbsp;N&deg; de Canje:</b></span>&nbsp;&nbsp; <?php echo $listacanje[0]['numero'];?></td>
		<td width="196" align="center">&nbsp;</td>
	</tr>
	<tr style="font-size:12px">
		<td height="31" colspan="4" align="left" valign="top"><b>&nbsp;&nbsp;Auxiliar:</b> &nbsp;&nbsp;<font size="+1"><b><?php echo $listacanje[0]['cliente'];?></b></font></td>
		<td width="196" align="center">&nbsp;</td>
	</tr>
    <tr style="font-size:12px">
		<td width="138" align="right"><b>Fecha de Operacion:</b></td>
		<td width="160" align="left">&nbsp;&nbsp;<?php echo extraefecha($listacanje[0]['fecha']);?></td>
		<td width="31"><b>T.C.:</b></td><td width="153" align="left">&nbsp;&nbsp;<?php echo number_format($listacanje[0]['tipcambio'],3,'.','');?></td>
		<td width="196" rowspan="3" align="center"><table border=0>
		<tr align="right">
			<td width="117"><b>TOTAL CANJE:</b></td>
			<td width="80"><?php echo $totalcanje=number_format($listacanje[0]['totalcanje'],2,'.',','); ?></td>
		</tr>
		<tr align="right">
			<td><b>TOTAL LETRAS:</b></td>
			<td><?php 
				$ListaTotalLetras=$ml->MostrarTotalLetras();
				echo $totaletras=number_format($ListaTotalLetras[0]['totalet'],2,'.',','); 
			?></td>
		</tr>
		<tr align="right">
			<td><b>POR CONCILIAR:</b></td>
			<td><?php 
				$saldox=number_format($totalcanje,2,'.','')-number_format($totaletras,2,'.','');
				echo number_format($saldox,2,'.',''); 
			?></td>
		</tr>
		</table></td>
	</tr>
	<tr style="font-size:12px">
		<td width="138" align="right"><b>Condicion de Pago:</b></td>
		<td width="160" align="left">&nbsp;&nbsp;<?php 
			if($listacanje[0]['condicion']=='A')
				echo "Anulado";
			else{
				$ml->estado=$listacanje[0]['condicion'];
				$ListaCondicion=$ml->MostrarCondicion();
				echo $ListaCondicion[0]['nombre'];
			}
		?></td>
		<td colspan="2">&nbsp;&nbsp;</td>
	</tr>
	<tr style="font-size:12px">
		<td width="138" align="right"><b>Deuda Convertido a:</b></td>
		<td width="160" align="left">&nbsp;&nbsp;
			<?php 
			$ml->moneda=$listacanje[0]['moneda'];
			$ListaMoneda=$ml->MostrarMoneda();
			echo strtoupper($ListaMoneda[0]['descripcion'])." (".$ListaMoneda[0]['simbolo'].")";
			?></td>
		<td colspan="2">&nbsp;&nbsp;</td>
	</tr>
	</table></td>
</tr>
<tr>
	<td height="25" colspan="2" align="center"><table width="332" height="22" border="0">
	<tr style="font-size:12px;">
		<td colspan="4" align="center"><font style="text-decoration:underline">DOCUMENTOS CANJEADOS</font></td>
	</tr>
	<tr style="font-size:12px">
		<td width="98">N&deg; doc</td>
		<td width="58">Mon</td>
		<td width="70">importe</td>
		<td width="84">Fecha Vcto.</td>
	</tr>
	</table></td>
	<td height="25" colspan="4" align="center"><table width="392" border="0">
	<tr>
		<td colspan="6" align="center"><font style="text-decoration:underline">DOCUMENTOS GENERADOS</font></td>
	</tr>
	<tr style="font-size:12px">
		<td width="72">N&deg; doc</td>
		<td width="27">Mon</td>
		<td width="54">importe</td>
		<td width="69">Fecha Vcto.</td>
		<td width="58">N&deg; Unic.</td>
		<td width="82">Banco</td>
	</tr>
	</table></td>
</tr>
<tr>
	<td height="25" colspan="2" valign="top" align="center"><table width="330" height="22" border="0">
    <?php
	$ListaDocumentos=$ml->MostrarDocumentosCanje();
	for($i=0;$i<count($ListaDocumentos);$i++){
    ?>
	<tr style="font-size:12px">
		<td width="98"><?php echo $ListaDocumentos[$i]['cod_docu']." ".$ListaDocumentos[$i]['serie_docu']."-".$ListaDocumentos[$i]['num_docu'];?></td>
		<td width="58"><?php echo "(".$ListaDocumentos[$i]['moneda'].")";?></td>
		<td width="70"><?php echo number_format($ListaDocumentos[$i]['total'],2,'.','');?></td>
		<td width="79"><?php echo extraefecha($ListaDocumentos[$i]['fvencimiento']);?></td>
	</tr>
    <?php
	}
	?>
	</table></td>
	<td height="25" colspan="4" valign="top" align="center"><table width="391" border="0">
	<?php
	$ListaLetras=$ml->MostrarLetrasCanje();
	for($i=0;$i<count($ListaLetras);$i++){
    ?>
	<tr style="font-size:12px">
		<td width="72"><?php echo $ListaLetras[$i]['cod_letra']." ".$ListaLetras[$i]['letra'];?></td>
		<td width="27"><?php echo "(".$ListaLetras[$i]['moneda'].")";?></td>
		<td width="54"><?php echo number_format($ListaLetras[$i]['importe'],2,'.','');?></td>
		<td width="69"><?php echo extraefecha($ListaLetras[$i]['fvencimiento']);?></td>
		<td width="58"><?php echo $ListaLetras[$i]['num_banco'];?></td>
		<td width="81"><?php echo $ListaLetras[$i]['banco'];?></td>
	</tr>
    <?php
	}
	?>
	</table></td>
</tr>
<?php if(!isset($_REQUEST['print']) && !isset($_REQUEST['excel'])){ 
echo "";
?>
<tr>
	<td height="68" colspan="5" valign="bottom" align="right">&nbsp;&nbsp;<img title="Imprimir" src="imgenes/imprimir.gif" onclick="Imprimir()" />&nbsp;&nbsp;<img title="Enviar a Excel" src="../imagenes/ico-excel.gif" onclick="Excel()" />&nbsp;&nbsp;</td>
</tr>
<?php }else if(isset($_REQUEST['print'])){
	echo "<script> print();</script>";
}?>
</table>
</body>
</html>