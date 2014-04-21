<?php
function validar ($dia,$mes,$anio,$hora,$minutos,$segundos)
    {
    if (!checkdate($mes,$dia,$anio))
        return FALSE;
    elseif (!(($hora<=23)&&($hora>=0)))
        return FALSE;
    elseif (!(($minutos<=59)&&($minutos>=0)))
        return FALSE;
    elseif (!(($segundos<=59)&&($minutos>=0)))
        return FALSE;
    return TRUE;
    }
	$fecha="2011-10-01 06:35:25";
	$fechoF=explode("-", substr($fecha,0,10) );
	$fechoH=explode(":", substr($fecha,12,20) );
	echo validar($fechoF[2],$fechoF[1],$fechoF[0],$fechoH[0],$fechoH[1],$fechoH[2]);
?>