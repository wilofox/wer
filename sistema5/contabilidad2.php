<?php 

session_start();
include('conex_inicial.php');
echo $_REQUEST['temporal'];

$filename = "reportes/contador.txt";
$archivo = fopen($filename, "a");

fclose($archivo);
$archivo = fopen($filename, "w");
$strSQL="select substring(fecha,1,10) as fecha,cod_cab,cod_ope,serie,Num_doc,flag,ruc,cliente,tc,b_imp,servicio,igv,total from cab_mov where substring(fecha,4,2)='10' and Num_doc!='' and serie!='' order by fecha";
$resultado=mysql_query($strSQL,$cn);
while($row=mysql_fetch_array($resultado)){

$coddocu=$row['cod_ope'];
$numdocu=$row['serie'].$row['Num_doc'];
$temp=explode('/',$row['fecha']);
$fecha=$temp[2].$temp[1].$temp[0];
if($row['flag']=='A'){$anulado='S';}else{$anulado='N';}
$codauxiliar='C00001';
$tauxiliar='C';
if($row['ruc']==''){$ruc='           ';$razon='cliente vario                 ';}else{$ruc=str_pad($row['ruc'],11, " ", STR_PAD_RIGHT);$razon=str_pad($row['cliente'],30, " ", STR_PAD_RIGHT);}
$tc=str_pad(number_format($row['tc'],3),11, "0", STR_PAD_LEFT);
$moneda='S';
$codref='TK';
$numref=$row['serie'].$row['Num_doc'];//ingresar documento de referencia
$b_imp=str_pad(number_format($row['b_imp'],2),13, "0", STR_PAD_LEFT);
$servicio=str_pad(number_format($row['servicio'],2),13, "0", STR_PAD_LEFT);
$igv=str_pad(number_format($row['igv'],2),13, "0", STR_PAD_LEFT);
$total=str_pad(number_format($row['total'],2),13, "0", STR_PAD_LEFT);

/*
$centroCosto=str_pad($_REQUEST['cc'],5, "0", STR_PAD_LEFT);
$contBI=str_pad($_REQUEST['contBI'],15, " ", STR_PAD_LEFT);
$destBI=str_pad($_REQUEST['destBI'],1, " ", STR_PAD_LEFT);
$contIMP=str_pad($_REQUEST['contIMP'],15, " ", STR_PAD_LEFT);
$destIMP=str_pad($_REQUEST['destIMP'],1, " ", STR_PAD_LEFT);
$contDES=str_pad($_REQUEST['contDES'],15, " ", STR_PAD_LEFT);
$destDES=str_pad($_REQUEST['destDES'],1, " ", STR_PAD_LEFT);
$contTOT=str_pad($_REQUEST['contTOT'],15, " ", STR_PAD_LEFT);
$destTOT=str_pad($_REQUEST['destTOT'],1, " ", STR_PAD_LEFT);

*/

$centroCosto="00000";
$contBI=str_pad("70101",15, " ", STR_PAD_RIGHT);
$destBI=str_pad("H",1, " ", STR_PAD_LEFT);
$contIMP=str_pad("40101",15, " ", STR_PAD_RIGHT);
$destIMP=str_pad("H",1, " ", STR_PAD_LEFT);
$contDES=str_pad("46901",15, " ", STR_PAD_RIGHT);
$destDES=str_pad("H",1, " ", STR_PAD_LEFT);
$contTOT=str_pad("12101",15, " ", STR_PAD_RIGHT);
$destTOT=str_pad("D",1, " ", STR_PAD_LEFT);


$strSQL2="select * from det_mov d where cod_cab='".$row['cod_cab']."' order by cod_det limit 1";
$resultado2=mysql_query($strSQL2,$cn);
$row2=mysql_fetch_array($resultado2);
$detalle=$row2['nom_prod'];

$conta.=$coddocu.$numdocu.$fecha.$fecha.$anulado.$codauxiliar.$tauxiliar.$ruc.$razon.$tc.$moneda.$codref.$numref.$b_imp.$servicio.$b_imp.$igv.$total.$centroCosto.$contBI.$destBI.$contIMP.$destIMP.$contDES.$destDES.$contTOT.$destTOT.$detalle.chr(13).chr(10);
}

$grabar = fwrite($archivo, $conta);
fclose($archivo);
echo "Se creo correctamente el archivo !!";


?>