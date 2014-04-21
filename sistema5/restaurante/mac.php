
<?php 
     
    $ip="192.168.0.44"; 
    $comando='/usr/sbin/ping $ip 5'; 
    //Aquí cambia un poco la salida dependiendo del OS para Irix y Windows: 
    // $activa=explode(",",$comando); 
    //if (eregi ("0", $activa[1])) echo "La máquina con la IP <b>".$ip."</b> no está activa<br>"; 
    if (eregi ("no", $comando)) echo "La máquina con la IP <b>".$ip."</b> no está activa<br>";  
    else 
    { 
        //Irix:/usr/etc/arp $ip en Window$:arp -a $ip 
        $comando='/usr/sbin/arp $ip'; 
        ereg(".{1,2}-.{1,2}-.{1,2}-.{1,2}-.{1,2}-.{1,2}|.{1,2}:.{1,2}:.{1,2}:.{1,2}:.{1,2}:.{1,2}", $comando, $mac); 
            echo "La IP <b>".$ip."</b> tiene esta MAC Address <b>".$mac[0]."</b><br>"; 
    } 
    //By MiStYkO Redes Acatlán UNAM (México) 
?> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
</body>
</html>
