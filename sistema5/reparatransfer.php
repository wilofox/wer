<?php include('conex_inicial.php');
$sql_doc="Select * from cab_mov where cod_ope='TF' or cod_ope='TB'";
$res_doc=mysql_query($sql_doc,$cn);
while($row_doc=mysql_fetch_array($res_doc)){
	switch($row_doc['cod_ope']){
		case 'TF':$doc_dest="FA";break;
		case 'TB':$doc_dest="BV";break;
	}
	$cons_doc_des="Select * from cab_mov where cod_ope='".$doc_dest."' and serie='".$row_doc['serie']."' and Num_doc='".$row_doc['Num_doc']."'";
	$res_doc_des=mysql_query($cons_doc_des,$cn);
	if(mysql_num_rows($res_doc_des)>0){
		continue;
	}
	$update=mysql_query("Update cab_mov set cod_ope='".$doc_dest."' where cod_cab='".$row_doc['cod_cab']."'",$cn);
	$update=mysql_query("Update det_mov set cod_ope='".$doc_dest."' where cod_cab='".$row_doc['cod_cab']."'",$cn);
}





/////////Corrige productos con NO SERIE si esta vacio el campo

/*$cn = mysql_connect($hostname_conexion, $username_conexion, $password_conexion) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database_conexion,$cn);

$sql=mysql_query("select * from producto",$cn);
while($row=mysql_fetch_array($sql)){
	$mod="";
	$campo="";
	if($row['series']==""){
		$campo.="series='N'";
		$mod="S";
	}else{
		$campo.="";
	}
	if($row['factorOT']==""){
		if($mod!=""){
			$campo.=", ";
		}
		$campo.="factorOT='N'";
		$mod="S";
	}else{
		$campo.="";
	}
	if($row['agente_percep']==""){
		if($mod!=""){
			$campo.=", ";
		}
		$campo.="agente_percep='N'";
		$mod="S";
	}else{
		$campo.="";
	}
	if(strlen($row['moneda'])==1){
		if($mod!=""){
			$campo.=", ";
		}
		$campo.="moneda='0".$row['moneda']."'";
		$mod="S";
	}else{
		$campo.="";
	}
	if(strlen($row['und'])==1){
		if($mod!=""){
			$campo.=", ";
		}
		$campo.="und='0".$row['und']."'";
		$mod="S";
	}else{
		$campo.="";
	}
	$campo.="cod_prod='".str_pad($row['cod_prod'],6, "0",STR_PAD_LEFT)."', und='07'";
	if($mod!=""){
		if($row['lista']==" "){
			$campo.=", lista=3";
		}
		$sql2=mysql_query("update producto set $campo where idproducto='".$row[0]."'",$cn);
	}else{
		if($row['lista']==" "){
			$campo="lista=3";
		}
		$sql2=mysql_query("update producto set $campo where idproducto='".$row[0]."'",$cn);
	}
	
	echo "update producto set $campo where idproducto='".$row[0]."' <br>";
}
/*mysql_query("UPDATE cliente SET t_persona='juridico' WHERE ruc!=''",$cn);
mysql_query("UPDATE cliente SET t_persona='natural' WHERE ruc=''",$cn);*/
?>