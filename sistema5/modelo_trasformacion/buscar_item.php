<?php 
session_start();
$cod_prod=$_REQUEST['prod'];

$temp=0;
$tempD='';

if(count($_SESSION['productos'][0])>0 ){
	foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {	
			if($subvalue==$cod_prod){
			$temp=1;
			$tempD='P';
			}
	}
}

if(count($_SESSION['2productos'][0])>0 ){
	foreach ($_SESSION['2productos'][0] as $subkey=> $subvalue) {	
			if($subvalue==$cod_prod){
			$temp=1;
			$tempD='F';
			}
	}
}

echo $temp.'?'.$tempD;

?>