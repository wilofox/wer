<?php 
//Incluimos la libreria 
  /*include('../pclzip.lib.php'); 

//forma de llamar la clase 
$filename="ejemplo";

  $archive = new PclZip('ejemplo.zip'); 

//Ejecutamos la funcion extract 
 
  if ($archive->extract(PCLZIP_OPT_PATH, 'data', 
                        PCLZIP_OPT_REMOVE_PATH, 'temp_install') == 0) { 
    die("Error : ".$archive->errorInfo(true)); 
  } */
  function crear_backup(){

/*$usuario="root";
$passwd="1";
$bd="datablanco";
list($empresa)=mysql_fetch_array(mysql_query("select des_suc from sucursal"));
$empresa=str_replace(" ","_",$empresa );
$filename=$empresa."_".date("d-m-Y");
$executa = "D:\AppServ\MySQL\bin\mysqldump -u $usuario --password=$passwd -B $bd > $filename.sql";
system($executa, $resultado);*/
	
require('../pclzip.lib.php');
$filename="ejemplo";
$zip = new PclZip($filename.".zip");
$zip->create($filename.'.txt');
//$zip->add($filename.'.txt',PCLZIP_OPT_REMOVE_PATH, 'dev');

 header("Pragma: public"); 
 header("Expires: 0"); 
 header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
 header("Cache-Control: public"); 
 header("Content-Description: File Transfer"); 
 header("Content-type: application/octet-stream"); 
 header("Content-Disposition: attachment; filename='ejemplo.zip'"); 
 header("Content-Transfer-Encoding: binary"); 
 header("Content-Length: ".filesize('ejemplo.zip')); 
 /*ob_end_flush(); 
 @readfile($filepath.$filename); 
  

header("Pragma: no-cache");
header("Expires: 0");
header("Content-Transfer-Encoding: binary");
header ("Content-Type: application / pdf"); 
header("Content-type: application/force-download");
header("Content-Disposition: attachment; filename=".$filename."_".date("h-i-sA").".zip");*/
	ob_clean();
 	readfile($filename.".zip");

 	flush(); 
	//unlink($filename.".zip");
	//unlink($filename.".sql");
	exit;

}
 crear_backup();
?>