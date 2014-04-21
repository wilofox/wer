<?php 
include('../conex_inicial.php');
include('../funciones/funciones.php');

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=excel.xls");


$tienda=$_REQUEST['tienda'];
$fecha=$_REQUEST['fecha'];


 list($destienda)=mysql_fetch_row(mysql_query("select des_tienda from tienda where cod_tienda='".$tienda."'"));
 list($dessuc)=mysql_fetch_row(mysql_query("select des_suc from sucursal where cod_suc='".substr($tienda,0,1)."'"));



/////////////////  cAlculo de SALDOS***********************************

$egreso_soles=0;
$ingreso_soles=0;
$egreso_dolar=0;
$ingreso_dolar=0;

//Calculo del saldo Inicial
//$strSQL2="SELECT * FROM cajach WHERE fecpago<'$fecha' and cod_tienda='$tienda'";
$strSQL2="SELECT * FROM cajach c,t_pago t WHERE fecpago<'$fecha' and cod_tienda='$tienda' and c.tippago=t.id and t.modalidad='1'";
$resultado2=mysql_query($strSQL2,$cn);

while($row2=mysql_fetch_array($resultado2)){

if($row2['tipmov']=='E' && $row2['moneda']=='01'){
$egreso_soles=$egreso_soles+$row2['importe'];
}
if($row2['tipmov']=='I' && $row2['moneda']=='01'){
$ingreso_soles=$ingreso_soles+$row2['importe'];
}

if($row2['tipmov']=='E' && $row2['moneda']=='02'){
$egreso_dolar=$egreso_dolar+$row2['importe'];
}
if($row2['tipmov']=='I' && $row2['moneda']=='02'){
$ingreso_dolar=$ingreso_dolar+$row2['importe'];
}
}

$saldo_inicial_soles=$ingreso_soles-$egreso_soles;
$saldo_inicial_dolar=$ingreso_dolar-$egreso_dolar;
//Fin del Calculo

$egreso_soles=0;
$ingreso_soles=0;
$egreso_dolar=0;
$ingreso_dolar=0;


//$strSQL="select * from flujo where fecha='$fecha'";
//$strSQL="select * from cajach where fecpago='$fecha' and cod_tienda='$tienda'";
$strSQL="select * from cajach c,t_pago t where fecpago='$fecha' and cod_tienda='$tienda' and c.tippago=t.id and t.modalidad='1'";
$resultado=mysql_query($strSQL,$cn);

while($row=mysql_fetch_array($resultado)){

if($row['tipmov']=='E' && $row['moneda']=='01'){
$egreso_soles=$egreso_soles+$row['importe'];
}
if($row['tipmov']=='I' && $row['moneda']=='01'){
$ingreso_soles=$ingreso_soles+$row['importe'];
}

if($row['tipmov']=='E' && $row['moneda']=='02'){
$egreso_dolar=$egreso_dolar+$row['importe'];
}
if($row['tipmov']=='I' && $row['moneda']=='02'){
$ingreso_dolar=$ingreso_dolar+$row['importe'];
}



}
$saldo_final_soles=($saldo_inicial_soles+$ingreso_soles)-$egreso_soles;
$saldo_final_dolar=($saldo_inicial_dolar+$ingreso_dolar)-$egreso_dolar;


//echo number_format($egreso_soles,2).'?'.number_format($ingreso_soles,2).'?'.number_format($saldo_final_soles,2).'?'.number_format($egreso_dolar,2).'?'.number_format($ingreso_dolar,2).'?'.number_format($saldo_final_dolar,2).'?'.number_format($saldo_inicial_soles,2).'?'.number_format($saldo_inicial_dolar,2).'?';


/////////////////////////////--------------------*********************************
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #0066FF;
}
.Estilo4 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo5 {color: #FFFFFF}
.Estilo14 {font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color:#333333 }
.Estilo14 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo34 {font-size: 10}
.Estilo43 {	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
	color: #990000;
}
.Estilo46 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
-->
</style>
</head>



<body>
<table width="823" height="445" border="0">
  <tr>
    <td colspan="4" align="center"><span class="Estilo1">REPORTE DE CAJA CHICA </span></td>
  </tr>
  <tr>
    <td width="1" height="232">&nbsp;</td>
    <td width="398">&nbsp;</td>
    <td width="398" rowspan="2"><table width="309" height="193" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="41" colspan="3"><span class="Estilo43">SALDO DISPONIBLE </span></td>
      </tr>
      <tr bgcolor="#CCCCCC">
        <td height="26" colspan="3" align="center"><span class="Estilo46">Dinero en Efectivo </span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center"><span class="Estilo46">Soles</span></td>
        <td align="center"><span class="Estilo46">D&oacute;lares</span></td>
      </tr>
      <tr>
        <td width="31%"><span class="Estilo14">Saldo Inicial </span></td>
        <td width="32%" align="center"><?php echo number_format($saldo_inicial_soles,2)?></td>
        <td width="37%" align="center"><?php echo number_format($saldo_inicial_dolar,2)?></td>
      </tr>
      <tr>
        <td><span class="Estilo14">Ingresos </span></td>
        <td align="center"><?php echo number_format($ingreso_soles,2)?></td>
        <td align="center"><?php echo number_format($ingreso_dolar,2)?></td>
      </tr>
      <tr>
        <td><span class="Estilo14">Egresos</span></td>
        <td align="center"><?php echo number_format($egreso_soles,2)?></td>
        <td align="center"><?php echo number_format($egreso_dolar,2)?></td>
      </tr>
      <tr>
        <td><span class="Estilo14">Saldo Final </span></td>
        <td align="center"><?php echo number_format($saldo_final_soles,2)?></td>
        <td align="center"><?php echo number_format($saldo_final_dolar,2) ?></td>
      </tr>
      <tr>
        <td><span class="Estilo34"></span></td>
        <td><span class="Estilo34"></span></td>
        <td><span class="Estilo34"></span></td>
      </tr>
    </table></td>
    <td width="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
    <td><span class="Estilo4"><strong>Empresa  / Tienda: </strong><?php echo $dessuc ." / ". $destienda ?></span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="23">&nbsp;</td>
    <td><span class="Estilo4"><strong>Fecha: </strong><?php echo $fecha ?> </span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><table width="796" height="111" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td width="29" align="center" bgcolor="#0066CC"><span class="Estilo5">Tipo</span></td>
        <td width="50" align="center" bgcolor="#0066CC"><span class="Estilo5">Forma de Pago</span></td>
        <td width="53" align="center" bgcolor="#0066CC"><span class="Estilo5">Numero</span></td>
        <td width="229" align="center" bgcolor="#0066CC"><span class="Estilo5">Clie/Prov</span></td>
        <td width="69" align="center" bgcolor="#0066CC"><span class="Estilo5">Moneda</span></td>
        <td width="55" align="center" bgcolor="#0066CC"><span class="Estilo5">T.c.</span></td>
        <td width="52" align="center" bgcolor="#0066CC"><span class="Estilo5">Monto</span></td>
        <td width="157" align="center" bgcolor="#0066CC"><span class="Estilo5">Obs</span></td>
        </tr>
      <?php
  
  //$strSQL="select * from flujo where fecha='$fecha'";
  $strSQL="select * from cajach where fecpago='$fecha' and cod_tienda='$tienda'";
  //echo $strSQL;
  $resultado=mysql_query($strSQL,$cn);
  while($row=mysql_fetch_array($resultado)){
  ?>
      <tr id="<?php echo $row['idcaja'];?>">
        <td align="center" bgcolor="#EAEAEA"><span class="Estilo14"><?php echo $row['tipmov']?></span></td>
        <td bgcolor="#EAEAEA"><span class="Estilo14">
          <?php 
	$strSQL2="select * from t_pago where id='".$row['tippago']."'";
	$resultado2=mysql_query($strSQL2,$cn);
  	while($row2=mysql_fetch_array($resultado2)){
		echo $row2['descripcion'];
	}
	?>
        </span></td>
        <td bgcolor="#EAEAEA"><span class="Estilo14"><?php echo $row['docpago']?></span></td>
        <td align="center" bgcolor="#EAEAEA"><span class="Estilo14">
          <?php 
	$aux=$row['codclie'];
	$des_aux=mysql_fetch_array(mysql_query("Select * from cliente where codcliente='".$row['codclie']."'",$cn));
	$tipo=$row['tipmov'];
	echo $aux." - ".$des_aux['razonsocial'];
	if($row['tipmov']=='A'){
		$desmov="Documentos Pendientes";
	}
	?>
          <input type="button" name="cancelar" onClick="cargar_docs('<?php echo $aux.",".$tipo.",".$row['idcaja'];?>')" value="Documentos Pendientes" />
        </span></td>
        <td align="center" bgcolor="#EAEAEA"><span class="Estilo14">
          <?php 
	if($row['moneda']=="1" || $row['moneda']=="01"){
		echo "S/.";
	}else{
		echo "US$.";
	}
	?>
        </span></td>
        <td bgcolor="#EAEAEA"><span class="Estilo14"><?php echo $row['tipcambio']?></span></td>
        <td align="right" bgcolor="#EAEAEA"><span class="Estilo14"><?php echo number_format($row['importe'],2)?></span></td>
        <td bgcolor="#EAEAEA"><span class="Estilo14"><?php echo $row['Observa']?></span></td>
        </tr>
      <?php }?>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
