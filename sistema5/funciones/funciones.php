<?php
//date_default_timezone_set('GMT-3');
 
function caracteres($text){
  // this function will intially be used to implement underlining support, but could be used for a range of other
  // purposes
  //echo $text;
 // $search = array('á','é','í','ó','ú','Ñ','?');
 // $search = array('','','','','','','?');
  //$replace = array('&#225;','&#233;','&#237;','&#243','&#250;','&#209;','&#63;');
   
  //$tempcaract=str_replace($search,$replace,$text);
  
  //return str_replace($search,$replace,$text);
  // unset($search);
   //unset($replace);
   //htmlspecialchars
   
   
   // javascript unicode
   //-------------------------------
   //\u00e1---->á
   //\u00e9---->é
   //\u00ed---->í
   //\u00f3---->ó
   //\u00efa---->ú
   //\u00ef1---->ñ
   //-------------------------------
     
     return utf8_encode($text);  
 
}
function caracteres2($text){
  // this function will intially be used to implement underlining support, but could be used for a range of other
 
 $search = array('á','é','í','ó','ú','Ñ','?','Á','É','Í','Ó','Ú','°');
  //$search = array('','','','','','','?');
 $replace = array('&#225;','&#233;','&#237;','&#243','&#250;','&#209;','&#63;','&#193;','&#201;','&#205;','&#211;','&#218;','&deg;');
    
  $tempcaract=str_replace($search,$replace,$text);
  
  //return str_replace($search,$replace,$text);
  // unset($search);
   //unset($replace);
   //htmlspecialchars
   
   
   // javascript unicode
   //-------------------------------
   //\u00e1---->á
   //\u00e9---->é
   //\u00ed---->í
   //\u00f3---->ó
   //\u00efa---->ú
   //\u00ef1---->ñ
   //-------------------------------
     
     return $tempcaract;  
 
}




function apostrofe($text){

//$text=addslashes($text);

return $text;

}



function formatofecha($fecha){
$temp_fecha=explode('-',$fecha);
$fechanueva=trim($temp_fecha[2]).'-'.trim($temp_fecha[1]).'-'.trim($temp_fecha[0]);
return  $fechanueva;
}


function restaFechas($dFecIni, $dFecFin)
{
    $dFecIni = str_replace("-","",$dFecIni);
    $dFecIni = str_replace("/","",$dFecIni);
    $dFecFin = str_replace("-","",$dFecFin);
    $dFecFin = str_replace("/","",$dFecFin);

    ereg( "([0-9]{1,2})([0-9]{1,2})([0-9]{2,4})", $dFecIni, $aFecIni);
    ereg( "([0-9]{1,2})([0-9]{1,2})([0-9]{2,4})", $dFecFin, $aFecFin);

    $date1 = mktime(0,0,0,$aFecIni[2], $aFecIni[1], $aFecIni[3]);
    $date2 = mktime(0,0,0,$aFecFin[2], $aFecFin[1], $aFecFin[3]);

    return round(($date2 - $date1) / (60 * 60 * 24));
}
// La funcion funciona con el formato YYYY-mm-dd en ambas fechas
function restaFechas2($dFecIni, $dFecFin)
{
    $date1=strtotime($dFecIni); 
	$date2=strtotime($dFecFin); 
    return round(($date2 - $date1) / (60 * 60 * 24));
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
$nfecha=$afecha[2]."-".$afecha[1]."-".$afecha[0]." ".gmdate('H:i:s',time()-18000);
return $nfecha;
}

function extraefecha($valor){
$afecha=explode('-',trim($valor));
$afecha2=explode(' ',trim($afecha[2]));
$nfecha=$afecha2[0]."-".$afecha[1]."-".$afecha[0];
return $nfecha;
}


function extraefecha2($valor){
$afecha=explode('-',trim($valor));
$afecha2=explode(' ',trim($afecha[2]));
$nfecha=$afecha2[0]."/".$afecha[1]."/".$afecha[0];
return $nfecha;
}

function extraefecha3($valor){
$afecha=explode('-',trim($valor));
$afecha2=explode(' ',trim($afecha[2]));
$nfecha=$afecha[0]."/".$afecha[1]."/".$afecha2[0];
return $nfecha;
}
function extraefecha4($valor){
$afecha=explode('-',trim($valor));
$afecha2=explode(' ',trim($afecha[2]));
$nfecha=$afecha2[0]."-".$afecha[1]."-".$afecha[0]." ".$afecha2[1] ;
return $nfecha;
}

function formatobarrafecha($fecha){
	$temp_fecha=explode('-',$fecha);
	$fechanueva=trim($temp_fecha[2]).'/'.trim($temp_fecha[1]).'/'.trim($temp_fecha[0]);
	return  $fechanueva;
}

function formatofecharay($fecha){
	$temp_fecha=explode('/',$fecha);
	$fechanueva=trim($temp_fecha[2]).'-'.trim($temp_fecha[1]).'-'.trim($temp_fecha[0]);
	return  $fechanueva;
}

function diasemana($fecha){
	$tim1=strtotime($fecha);
	$sd=date('w',$tim1);
	switch($sd){
		case '0':$dsem="Dom.";break;
		case '1':$dsem="Lun.";break;
		case '2':$dsem="Mar.";break;
		case '3':$dsem="Mie.";break;
		case '4':$dsem="Jue.";break;
		case '5':$dsem="Vie.";break;
		case '6':$dsem="Sab.";break;
	}
	
	return  $dsem."||".extraefecha($fecha);
}

/*
select (
SELECT count(*)  FROM INFORMATION_SCHEMA.COLUMNS  WHERE ( table_name ="cab_mov" ) and table_schema="df") as cabmov,

(SELECT count(*) FROM INFORMATION_SCHEMA.COLUMNS  WHERE ( table_name ="cliente" ) and table_schema="df") as cliente,

(SELECT count(*) FROM INFORMATION_SCHEMA.COLUMNS  WHERE ( table_name ="operacion" ) and table_schema="df") as operacion,

(SELECT count(*) FROM INFORMATION_SCHEMA.COLUMNS  WHERE ( table_name ="pagos" ) and table_schema="df") as pagos,

(SELECT count(*) FROM INFORMATION_SCHEMA.COLUMNS  WHERE ( table_name ="producto" ) and table_schema="df") as producto,

(SELECT count(*) FROM INFORMATION_SCHEMA.COLUMNS  WHERE ( table_name ="sucursal" ) and table_schema="df") as sucursal

 from  INFORMATION_SCHEMA.COLUMNS  WHERE table_schema="df" limit 1

*/

?>
