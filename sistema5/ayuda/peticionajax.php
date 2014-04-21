<?php 
session_start();
include('../conex_inicial.php');
include('../funciones/funciones.php');

$peticion=$_REQUEST['peticion'];
$valor=$_REQUEST['valor'];

switch($peticion){
	    case "imgAyuda":
	
		$imagenes =  glob("img/".$valor."/{*.jpg,*.png,*.gif}",GLOB_BRACE);
		  foreach ($imagenes as $ima)
				$nombres[]=array_pop(split("/",$ima));
				
		foreach ($nombres as $subkey=> $subvalue){
		//echo $subkey."<br>" width='20' height='20';
		$pant=$pant."<img width='1000' src='img/".$valor."/".$subvalue."'/><br>";		
		} 
		echo $pant;
				 			
		break;				
		
}		


?>