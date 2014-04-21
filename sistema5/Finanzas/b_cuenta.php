<?php include('../conex_inicial.php');
include('../funciones/funciones.php');

$tipo=$_REQUEST['tipo'];
$serie=$_REQUEST['serie'];
$numero=$_REQUEST['numero'];
$doc=$_REQUEST['doc'];
$suc=$_REQUEST['suc'];

//$strSQL="select * from cab_mov where cod_ope='$doc' and serie='$serie' and Num_doc='$numero'";
if($tipo==2){
	$strSQL="SELECT cl.ruc as rucli,ca.*,IF(ca.moneda='02',ca.total+ca.percepcion,(ca.total+ca.percepcion)/ca.tc) AS totaldpc,IF(ca.moneda='02',ca.total,ca.total/ca.tc) AS totald,ca.tc as tc_doc, IF(ca.moneda='01',ca.total+ca.percepcion,(ca.total+ca.percepcion)*ca.tc) AS totalspc, IF(ca.moneda='01',ca.total,ca.total*ca.tc) AS totals, ca.moneda AS mon, cl.razonsocial AS cli, usu.usuario AS vende FROM cab_mov ca INNER JOIN cliente cl ON cl.codcliente=ca.cliente INNER JOIN usuarios usu ON usu.codigo=ca.cod_vendedor WHERE cod_ope='".$doc."' and serie='".$serie."' and Num_doc='".$numero."' and ca.sucursal='".$suc."'";
}else{
	$codi=$_REQUEST['aux'];
	$strSQL="SELECT cl.ruc as rucli,ca.*,IF(ca.moneda='02',ca.total+ca.percepcion,(ca.total+ca.percepcion)/ca.tc) AS totaldpc,IF(ca.moneda='02',ca.total,ca.total/ca.tc) AS totald,ca.tc as tc_doc, IF(ca.moneda='01',ca.total+ca.percepcion,(ca.total+ca.percepcion)*ca.tc) AS totalspc, IF(ca.moneda='01',ca.total,ca.total*ca.tc) AS totals,ca.moneda AS mon, cl.razonsocial AS cli, usu.usuario AS vende FROM cab_mov ca INNER JOIN cliente cl ON cl.codcliente=ca.cliente INNER JOIN usuarios usu ON usu.codigo=ca.cod_vendedor WHERE cod_ope='".$doc."' and serie='".$serie."' and Num_doc='".$numero."' and ca.sucursal='".$suc."' and ca.cliente='".$codi."'";	
}
$resultado=mysql_query($strSQL,$cn);
$row=mysql_fetch_array($resultado);
if($row['mon']=='01'){
	//if($row['condicion']=='1'){
		$importe=$row['totals'];
	//}else{
	//	$importe=$row['totalspc'];
	//}
}else{
	//if($row['condicion']=='1'){
		$importe=$row['totald'];
	//}else{
	//	$importe=$row['totaldpc'];
	//}
}
//echo $strSQL;
//$row['condicion']
//echo "select descondi,deuda from detope where condicion='".$row['condicion']."' and documento='".$_REQUEST['doc']."'";
list($condi,$deuda)=mysql_fetch_array(mysql_query("select condicion,deuda from detope where condicion='".$row['condicion']."' and documento='".$_REQUEST['doc']."'",$cn));
$cadena=$row['rucli']."|||".$row['cliente']."|||".number_format($importe,2,'.','')."|||".$row['tc_doc']."|||".formatobarrafecha(substr($row['fecha'],0,10))."|||".$row['cod_cab']."|||".$row['flag']."|||".caracteres($row['cli'])."|||".$row['vende']."|||".$row['mon']."|||".formatobarrafecha(substr($row['f_venc'],0,10))."|||".$condi."-".$deuda."|||";
echo $cadena;
?>
