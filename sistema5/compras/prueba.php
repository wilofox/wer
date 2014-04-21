<?php session_start();
   include('../conex_inicial.php');
   $_SESSION['registro']=rand(100000,999999);

   if($_REQUEST['tipomov']==1){
 	$aux="Proveedor";
	$titulo="Ingresos - Compras";
   }else{
	$aux="Cliente";
	$titulo="Salidas - Ventas";
   }
   
   
   $strSQL="select * from series where tienda='101' and producto='000436' and (salida='' || salida=0) ";
				$resultado=mysql_query($strSQL,$cn);
				$i=0;
				while($row=mysql_fetch_array($resultado)){
				
				$_SESSION['seriep'][0][]=$row['serie'];
				echo "<label>".$row['serie']."</label>";
				//echo "<input type='text' name='nroserie[]' id='nroserie'  value='".$_SESSION['seriep'][0][$i]."' /><br>";
				
				
				}
   
?>
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
</body>
</html>
