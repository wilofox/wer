<?php
//session_start();
/*if($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']!=$_SERVER['HTTP_HOST']."/prolyamrp/login_script.php" && $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']!=$_SERVER['HTTP_HOST']."/prolyamrp/index.php"){
include('seguridad.php');
}
*/

$hostname_conexion = "";
$database_conexion = "";
$username_conexion = "";
$password_conexion = "";
define('CONEXION',mysql_connect($hostname_conexion, $username_conexion, $password_conexion));
$cn = mysql_connect($hostname_conexion, $username_conexion, $password_conexion) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database_conexion,$cn);
$mysqli01 = new mysqli($hostname_conexion, $username_conexion, $password_conexion, $database_conexion);

$fecha=date('d/m/Y');
//if($_SESSION['tc']==''){
$strSQl0="select * from tcambio order by mid(fecha,7,4) desc,mid(fecha,4,2) desc,mid(fecha,1,2) desc limit 1";
//echo $strSQl0;
$resultado0=mysql_query($strSQl0,$cn);
$row0=mysql_fetch_array($resultado0);
$tcambio=$row0['venta'];
$_SESSION['tc']=$tcambio;
$_SESSION['tc_compra']=$row0['compra'];
$_SESSION['tc_promedio']=$row0['promedio'];
//}

//Nombre de Etiquetas de Precio
//Consulta todos los datos
	$ConsultaRk=" select * from config  where cod_config='NomEtiPre'";
	$resulRk=mysql_query($ConsultaRk,$cn);
	while($rowRk=mysql_fetch_array($resulRk)){
	//echo $rowX['nom_precio']; 	
		$docuser=$rowRk['nom_precio'];
	}	  
	 mysql_free_result($resulRk);

 	$EtiquetaPrecio = explode(',',$docuser);
	//echo $ValorEti[0];
	$PrecNomEti1=$EtiquetaPrecio[0];
	$PrecNomEti2=$EtiquetaPrecio[1];
	$PrecNomEti3=$EtiquetaPrecio[2];
	$PrecNomEti4=$EtiquetaPrecio[3];
	$PrecNomEti5=$EtiquetaPrecio[4];	
//Nombre de Etiquetas de Precio
//Consulta todos los datos
	$ConsultaRk=" select * from config  where cod_config='NomEtiCat'";
	$resulRk=mysql_query($ConsultaRk,$cn);
	while($rowRk=mysql_fetch_array($resulRk)){
	//echo $rowX['nom_precio']; 	
	 $docuser=$rowRk['nom_precio'];
	}	  
	 mysql_free_result($resulRk);
	
    $EtiquetaCategoria = explode(',',$docuser);
	//echo $ValorEti[0];
	$CatgNomEti1=$EtiquetaCategoria[0];
	$CatgNomEti2=$EtiquetaCategoria[1];
	$CatgNomEti3=$EtiquetaCategoria[2];	
//Nombre de Etiquetas de Anexo
//Consulta todos los datos
	$ConsultaRk=" select * from config  where cod_config='NomEtiAnex'";
	$resulRk=mysql_query($ConsultaRk,$cn);
	while($rowRk=mysql_fetch_array($resulRk)){
	//echo $rowX['nom_precio']; 	
	 $docuser=$rowRk['nom_precio'];
	}
	mysql_free_result($resulRk);	  
	
 	 $EtiquetaAnexo = explode(',',$docuser);
	//echo $ValorEti[0];
	$AnexNomEti1=$EtiquetaAnexo[0];
	$AnexNomEti2=$EtiquetaAnexo[1];
	$AnexNomEti3=$EtiquetaAnexo[2];	
	
	$ConsultaRk=" select * from config  where cod_config='NomEtiPro'";
	$resulRk=mysql_query($ConsultaRk,$cn);
	while($rowRk=mysql_fetch_array($resulRk)){
	//echo $rowX['nom_precio']; 	
	 $docuser=$rowRk['nom_precio'];
	}	  
	
	mysql_free_result($resulRk);
	
 	 $EtiquetaProduccion = explode(',',$docuser);
	//echo $ValorEti[0];
	$ProdNomEti1=$EtiquetaProduccion[0];
	$ProdNomEti2=$EtiquetaProduccion[1];
	$ProdNomEti3=$EtiquetaProduccion[2];
	$ProdNomEti4=$EtiquetaProduccion[3];	

?>
