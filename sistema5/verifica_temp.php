<?php 
include("conex_inicial.php");
$ids="0";
$sql=mysql_query("select * from tempdoc where estado!='R' order by id desc",$cn);
while($row=mysql_fetch_array($sql)){
	$sql_cons_doc=mysql_query("select * from cab_mov where cod_ope='".$row['doc']."' and tipo='".$row['tipodoc']."' and sucursal='".$row['sucursal']."' and serie='".$row['serie']."' and Num_doc='".$row['numero']."'",$cn);
	if(mysql_num_rows($sql_cons_doc)==0){
		$ids=$ids+"','".$row['id'];
	}
}
mysql_query("delete from tempdoc where id in('".$ids."')");
?>