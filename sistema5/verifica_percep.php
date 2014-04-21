<?php
include_once('conex_inicial.php');
$sql="Select * from cab_mov where percepcion>0";
$res_per=mysql_query($sql,$cn);
while($row_percep=mysql_fetch_array($res_per)){
	$sql_pag="select * from pagos where referencia='".$row_percep['cod_cab']."' and tipo='C' and monto='".$row_percep['percepcion']."'";
	$res_pag=mysql_query($sql_pag,$cn);
	if(mysql_num_rows($res_pag)==0){
		
	}
}
?>