<?php
include_once('conex_inicial.php');
$strSQL_cab="select cab_mov.*,razonsocial from cab_mov inner join detope do on do.documento=cab_mov.cod_ope and do.condicion=cab_mov.condicion inner join cliente on cab_mov.cliente=cliente.codcliente inner join operacion op on op.codigo=cab_mov.cod_ope and op.tipo=cab_mov.tipo where cab_mov.tipo='$tipo' and substring(fecha,1,10) <= '".date('Y-m-d')."' and do.deuda!='S' and cab_mov.cod_ope NOT IN('NC','TN') and substr(op.p1,5,1)='S' and flag!='A' order by razonsocial asc,f_venc asc";
mysql_query($strSQL_cab,$cn);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
</body>
</html>