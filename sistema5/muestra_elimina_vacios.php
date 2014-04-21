<?php
$sql="Select * from cab_mob where cod_ope='' or Num_doc=''or serie=''";
$rs=mysql_query($sql,$cn);
while($row=mysql_fetch_array($rs)){
	echo $row['cod_cab']."<br>";
	$sql_det="Select * from detmov where cod_cab='".$row['cod_cab']."'";
	$rs_det=mysql_query($sql_det,$cn);
}
?>