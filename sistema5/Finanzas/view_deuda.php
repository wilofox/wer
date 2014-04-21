<?php
session_start();
include_once('../funciones/funciones.php');
include_once('mcc/MLetras.php');
$ml=new MLetras();
$cli=$_REQUEST['cliente'];
$tip=$_REQUEST['tipo'];
$tre=$_REQUEST['trep'];
$suc=$_REQUEST['sucursal'];
$est=$_REQUEST['estado'];
$mon=$_REQUEST['moneda'];
$fec=$_REQUEST['fecha'];
$ml->cliente=$cli;
$ml->tipo=$tip;
$ml->cod_suc=$suc;
$ml->estado=$est;
$ml->moneda=$mon;

$ListaCliente=$ml->MostrarDatosCliente();
$titulo="";
switch($tre){
	case 'let':$titulo.="Letras ";$Lista=$ml->MostrarLetrasVencimiento($fec);$fun="let_det";break;
	case 'doc':$titulo.="Documentos ";$Lista=$ml->MostrarDocumentosVencimiento($fec);$fun="doc_det";break;
}
$titulo.="Pendientes de ";
switch($tip){
	case '1':$titulo.="Pago";break;
	case '2':$titulo.="Cobranza";break;
}
?>
<html>
<head>
<title>
<?php echo $titulo;?></title>
<script language="javascript">
function doc_det(cod){
	window.open("../doc_det2.php?referencia="+cod,"","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=320,left=300 top=250");
}
function let_det(cod){
}
</script>
</head>
<?php
echo "<h3>".$titulo."</h3>";
?>
<table border="0">

<?php
echo "<tr><td>Cliente: </td><td>".caracteres($ListaCliente[0]['razonsocial'])."</td>";
echo "<tr><td>Fecha Venc.: </td><td>".formatofecha($fec)."</td>";
for($i=0;$i<count($Lista);$i++){
	echo "<tr><td>Empresa : </td><td>".$Lista[$i]['sucu']."</td></tr>";
	echo "<tr><td>Doc : </td><td>".$Lista[$i]['cod_docu'];
	if($Lista[$i]['serie_docu']!=""){
	echo " ".$Lista[$i]['serie_docu']."-".$Lista[$i]['numero_docu'];
	}else{
		echo " ".$Lista[$i]['numero_docu'];
	}
	echo "</td><td><img src='../imagenes/ico_lupa.jpg' style='cursor:pointer;width:15px;height:15px;' title='Ver Documento' onclick='".$fun."(".$Lista[0]['cod'].")'></td>";
	$ml->moneda=$Lista[$i]['moneda'];
	$ListaMoneda=$ml->MostrarMoneda();
	echo "<tr><td>Saldo : </td><td>".$ListaMoneda[0]['simbolo']." ".$Lista[$i]['saldo']."</td></tr>";
	echo "<tr><td colspan='3'>--------------------------------------</td></tr>";
}
?>
</table>
</html>