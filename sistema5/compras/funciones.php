<?php
include('../conex_inicial.php');

function act_reg(){

$empresa=$_POST['empresa'];
$doc=$_POST['doc'];
$serie=$_POST['serie'];
$numero=$_POST['numero'];

list($x)=mysql_fetch_array(mysql_query("select ci from cab_mov where sucursal='$empresa' and cod_ope='$doc' and serie='$serie' and Num_doc='$numero'"));
$x++;
mysql_query("update cab_mov set ci=$x where sucursal='$empresa' and cod_ope='$doc' and serie='$serie' and Num_doc='$numero'");
}
act_reg();
?>