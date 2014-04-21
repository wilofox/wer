<?php 
session_start();
include('conex_inicial.php');

		$strSQL00="update usuarios set estado='D' where codigo='".$_SESSION['codvendedor']."' and pc='".$_SESSION['pc_ingreso']."'";
		mysql_query($strSQL00,$cn);
		
	//	$strSQL01="update usuarios set estado='D',conexiones=conexiones-1 where codigo='".$_SESSION['codvendedor']."'";
	//	mysql_query($strSQL01,$cn);
		//684126733 7633
		session_destroy();
		
?>
