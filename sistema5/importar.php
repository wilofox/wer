<?php 
//require("config.php"); 
include('conex_inicial.php');

$row = 1; 
$fp = fopen ("producto.csv","r"); 
while ($data = fgetcsv ($fp, 1000, ",")) 
{ 
$num = count ($data); 
print " <br>"; 
$row++; 
echo "$row- ".$data[0].$data[1].$data[2].$data[3].$data[4].$data[5].$data[6].$data[7].$data[8]; 
$insertar="INSERT INTO producto (idproducto,cod_prod,clasificacion,categoria,subcategoria,nombre,precio,und,factor) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]')"; 
mysql_query($insertar); 
} 
//echo $insertar;
fclose ($fp); 

?> 
