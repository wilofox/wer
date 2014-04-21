<?
include('conex_inicial.php');

$handle = fopen ('c:\\06_del_11.csv', 'r');
while (($data = fgetcsv($handle, 1000, ',', '"')) !== FALSE)
{
echo $query = "INSERT INTO mashist_temp VALUES ('". implode("','", $data) ."')";
$query = @mysql_query($query);
}


	
?>
<?php
/*$row = 1;
if (($handle = fopen("c:\\07_del_11.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }
    fclose($handle);
}*/
?>
<?php
/*   setlocale(LC_ALL, 'es-ES');
   $loc = setlocale(LC_TIME, NULL);
   echo strftime("%A %e %B %Y", mktime(0, 0, 0, 12, 22, 2011));
  // jeuves 22 diciembre 1978*/
?>
<?php
/*	echo "Fecha del servidor: [".date("d/m/Y H:i:s")."]<br />";
	echo "Fecha UTC: [".gmdate("d/m/Y H:i:s")."]<p />";

	date_default_timezone_set('UTC');

	echo "Fecha del servidor: [".date("d/m/Y H:i:s")."]<br />";
	echo "Fecha UTC: [".gmdate("d/m/Y H:i:s")."]";*/
?>