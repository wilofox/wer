<?php 
function caracteres($text){
  // this function will intially be used to implement underlining support, but could be used for a range of other
  // purposes
 
  
  $search = array('','','','','','','','amps');
 // $search = array('á','é','í','ó','ú','Ñ','?');
  $replace = array('&#225;','&#233;','&#237;','&#243;','&#250;','&#209;','&#63;','&');
  
  
  return str_replace($search,$replace,$text);
   unset($search);
  unset($replace);
}

function formatofecha($fecha){
$temp_fecha=explode('-',$fecha);
$fechanueva=trim($temp_fecha[2]).'-'.trim($temp_fecha[1]).'-'.trim($temp_fecha[0]);
return  $fechanueva;
}



// Esto es lo que deben traer tus variables para el correcto funcionamiento 
function suma_fecha($fecha,$dias){

$inicio=strtotime($fecha); 
$dias=($dias*86400); 
return date("Y-m-d",$inicio+$dias); 
 
}
//--------------------------------------------------clase FECHA------------------------------------

class Fecha { 

    var $fecha;      
    function Fecha($a = 0, $m = 0, $d = 0, $h = 0, $mi = 0, $s = 0) {         
	      if ($a==0) $a = date("Y");       
		  if ($m==0) $m = date("m");  
		  if ($d==0) $d = date("d");  
		  if ($h==0) $h = date("H");    
		  if ($mi==0) $mi = date("i");   
		  if ($s==0) $s = date("s");       
		  $this -> fecha = date("Y-m-d-H-i-s", mktime($h,$mi,$s,$m,$d,$a));    
	}      
	function SumaTiempo($a = 0, $m = 0, $d = 0, $h = 0, $mi = 0, $s = 0) {
	     
		  $array_date = explode("-", $this->fecha);    
		  //echo $a;
		  $this->fecha = date("d-m-Y-H-i-s", mktime($array_date[3] + $h, $array_date[4] + $mi, $array_date[5] + $s, $array_date[1] + $m, $array_date[2] + $d, $array_date[0] + $a));  
		// echo $this->fecha ;
	}
		  
	
	function getFecha() { 
	return $this->fecha; 
	}
	
	}
//---------------------------------------------------------------------------------------------------------

function cambiarfecha($valor){
$afecha=explode('-',trim($valor));
$nfecha=$afecha[2]."-".$afecha[1]."-".$afecha[0]." ".date('H:i:s',time());
return $nfecha;
}


?>
