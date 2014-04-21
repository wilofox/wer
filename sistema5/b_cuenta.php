<?php include('conex_inicial.php');

$serie=$_REQUEST['serie'];
$numero=$_REQUEST['numero'];
$doc=$_REQUEST['doc'];

$strSQL="select * from cab_mov where cod_ope='$doc' and serie='$serie' and Num_doc='$numero'";
$resultado=mysql_query($strSQL,$cn);
$row=mysql_fetch_array($resultado);
//echo $strSQL;
$cadena=$row['ruc']."?".$row['cliente']."?".number_format($row['total'],2)."?".$row['tc']."?".substr($row['fecha'],0,10)."?".$row['cod_cab']."?".$row['flag']."?";
echo $cadena;
?>
