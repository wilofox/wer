<?php 



/*
if (!isset($_GET['file']) || empty($_GET['file'])) {
	exit();
}
// get filename
$root = "img/";
$file = basename($_GET['file']);
$path = $root.$file;
$type = '';

if (is_file($path)) {
	$size = filesize($path); 
	if (function_exists('mime_content_type')) {
		$type = mime_content_type($path);
	} else if (function_exists('finfo_file')) {
		$info = finfo_open(FILEINFO_MIME);
		$type = finfo_file($info, $path);
		finfo_close($info);  
	}
	if ($type == '') {
		$type = "application/force-download";
	}
	// Set Headers
	header("Content-Type: $type");
	header("Content-Disposition: attachment; filename=\"$file\"");
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: " . $size);
	// Download File
	readfile($path);
} else {
	die("File not exist !!");
}

*/
$url="http://prolyam.com/imagenes/imagen_prolyam.gif"; //ruta de imagen de otro servidor
$path="img/"; //directorio del servidor donde se guardara la imagen

//llamada a la function 
download_img($url, $path);

//funcion
function download_img($url, $path) { 
    if ((@$f = fopen($url, 'r')) != false) { 
        fclose($f); 
        $res = join(file($url)); 
                         
        if((@$f = fopen( $path . basename($url), "w" )) != false) {  
            fwrite($f, $res); 
            fclose( $f ); 
        }  
    } 
}  

?>