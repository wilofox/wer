<?php
include('conex_inicial.php');
$cod_prod=$_REQUEST['prod'];
$cantidad=$_REQUEST['cant'];


 $strSQL1="select * from producto where idproducto='$cod_prod'";
  $resultado1=mysql_query($strSQL1,$cn);
  
  while($row1=mysql_fetch_array($resultado1)){
  
   $nom_prod=$row1['nombre'];
   $precio=$row1['precio'];
  }
  $total=$precio*$cantidad;
  
  echo number_format($total,2)."?".number_format($precio,2)."?";
  
  
  
?>

<?php mysql_close($cn);?>