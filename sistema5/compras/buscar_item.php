<?php 
session_start();
$cod_prod=$_REQUEST['prod'];

$temp=0;

if(count($_SESSION['productos'][0])>0 ){

	foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {	
							  
			if($subvalue==$cod_prod){
			$temp=1;
			}
		
	}
}
echo $temp;

?>