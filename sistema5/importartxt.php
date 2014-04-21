<?php
// Set Mysql Variables
$username = "root";
$auth = '1';
$db = mysql_connect("localhost", $username, $auth);
mysql_select_db("datablanco",$db);

$file = "01de10.txt";
$fp = fopen($file, "r");
$data = fread($fp, filesize($file));
fclose($fp);

$output = str_replace("\t|\t", "	", $data);

$output = explode("\n", $output);

$language_id = "1";
$categories_id = 0;

foreach($output as $var) {
$categories_id = $categories_id + 1;

$tmp = explode("	", $var);

$Artikelgroep = $tmp[6];

echo " categories_id: " . $categories_id . " Artikelgroep: " . $Artikelgroep . "<br>";

mysql_query("INSERT INTO txtNota (categories_id,language_id,categories_name) VALUES('$categories_id','$language_id','$Artikelgroep')") or die("Insert failed: " . mysql_error());

}
echo "Done!";

?>