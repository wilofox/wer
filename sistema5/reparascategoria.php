<html>
<?php include('conex_inicial.php');
/////////Corrige productos con NO SERIE si esta vacio el campo
$sql=mysql_query("select * from producto",$cn);
while($row=mysql_fetch_array($sql)){
	$mod="";
	if($row['serie']==""){
		$campo.="serie='N'";
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
	//series "N"
	//moneda "0"+moneda
	 //"N"
	//factorOT "N"
	//lista 3
	if($mod!=""){
		$campo.=",lista=3";
		echo $sql2="update producto set $campo where idproducto='".$row[0]."' <br>";
	}
}?>
<head></head>
<body>
</body>
</html>