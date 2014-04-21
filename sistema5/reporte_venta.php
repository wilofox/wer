<?php 
include('conex_inicial.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo2 {font-size: 11px}
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.Estilo10 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
-->
</style>
</head>
<?php 
$fecha1=$_REQUEST['fecha1'];
$fecha2=$_REQUEST['fecha2'];
/*
$f=str_pad((substr($fecha1,0,2)+1),2,"0",STR_PAD_LEFT);
$fnueva=$f.substr($fecha1,2,9);
echo $fnueva;
*/
//for ( $i = 1 ; $i <= 10 ; $i ++) {
//-------------------------------------------------------------------------------------------
$strSQL="select substring(fecha,1,10) as fecha,num_doc,serie from cab_mov where cod_cab=(select min(cod_cab) from cab_mov where substring(fecha,1,10)='$fecha1' and cod_ope='BV') or cod_cab=(select max(cod_cab) from cab_mov where substring(fecha,1,10)='$fecha1' and cod_ope='BV')";
//echo $strSQL;
$resultado=mysql_query($strSQL,$cn);
$cont=mysql_num_rows($resultado);
$i=1;
while($row=mysql_fetch_array($resultado)){
	if($i==1){$doc_ini_b=$row['serie']."-".$row['num_doc'];}
	if($i==2 or $cont==1){$doc_fin_b=$row['serie']."-".$row['num_doc'];}
	$i=$i+1;
	$fecha=$row['fecha'];
	$td1='BV';
}

mysql_free_result($resultado);

$strSQL2="SELECT count(cod_cab) as cantidad,sum(b_imp) as importe,sum(igv) as igv,sum(servicio) as servicio, sum(total) as total  from cab_mov WHERE substring(fecha,1,10)='$fecha1' and cod_ope='BV'";
//echo $strSQL2;
$resultado2=mysql_query($strSQL2,$cn);
$row2=mysql_fetch_array($resultado2);
$cantidad=$row2['cantidad'];
$importe=$row2['importe'];
$igv=$row2['igv'];
$servicio=$row2['servicio'];
$total=number_format($row2['total'],2);

mysql_free_result($resultado2);
//--------------------------------------------------------------------------------------------------

$strSQL0="select substring(fecha,1,10) as fecha,num_doc,serie from cab_mov where cod_cab=(select min(cod_cab) from cab_mov where substring(fecha,1,10)='$fecha1' and cod_ope='FA') or cod_cab=(select max(cod_cab) from cab_mov where substring(fecha,1,10)='$fecha1' and cod_ope='FA')";
//echo $strSQL;
$resultado0=mysql_query($strSQL0,$cn);
$cont=mysql_num_rows($resultado0);
$i=1;
while($row0=mysql_fetch_array($resultado0)){
	if($i==1){$doc_ini_f=$row0['serie']."-".$row0['num_doc'];}
	if($i==2 or $cont==1){$doc_fin_f=$row0['serie']."-".$row0['num_doc'];}
	$i=$i+1;
	$fecha0=$row0['fecha'];
	$td2='FV';
}

mysql_free_result($resultado0);

$strSQL20="SELECT count(cod_cab) as cantidad,sum(b_imp) as importe,sum(igv) as igv,sum(servicio) as servicio, sum(total) as total  from cab_mov WHERE substring(fecha,1,10)='$fecha1' and cod_ope='FA'";
//echo $strSQL2;
$resultado20=mysql_query($strSQL20,$cn);
$row20=mysql_fetch_array($resultado20);
$cantidad0=$row20['cantidad'];
$importe0=$row20['importe'];
$igv0=$row20['igv'];
$servicio0=$row20['servicio'];
$total0=number_format($row20['total'],2);


?>


<body>
<table width="809" height="151" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><form name="form1" method="post" action="">
      <table width="793" height="109" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="43">&nbsp;</td>
          <td width="665"><label for="textfield"></label>
            <span class="Estilo7">Fecha</span>
            <input name="fecha1" type="text" id="fecha1" size="10" maxlength="10">
            <span class="Estilo2">(dd/mm/aaaa)</span>
            <input type="submit" name="Submit" value="Enviar"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><table width="735" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="93"><span class="Estilo7">Fecha</span></td>
              <td width="34"><span class="Estilo7">T.D.</span></td>
              <td width="114"><span class="Estilo7">Doc-Ini</span></td>
              <td width="116"><span class="Estilo7">Doc-FIn</span></td>
              <td width="60"><span class="Estilo7">Cantidad</span></td>
              <td width="59" align="right"><span class="Estilo7">Importe</span></td>
              <td width="58" align="right"><span class="Estilo7">IGV</span></td>
              <td width="89" align="right"><span class="Estilo7">Servicio</span></td>
              <td width="65" align="right"><span class="Estilo7">Total</span></td>
              <td width="47">&nbsp;</td>
            </tr>
			
            <tr>
              <td><span class="Estilo10"><?php echo $fecha?></span></td>
              <td><span class="Estilo10"><?php echo $td1?></span></td>
              <td><span class="Estilo10">
                <label for="select"><?php echo $doc_ini_b?></label>
              </span></td>
              <td><span class="Estilo10"><?php echo $doc_fin_b?></span></td>
              <td align="center"><span class="Estilo10"><?php echo $cantidad?></span></td>
              <td align="right"><span class="Estilo10"><?php echo $importe?></span></td>
              <td align="right"><span class="Estilo10"><?php echo $igv?></span></td>
              <td align="right"><span class="Estilo10"><?php echo $servicio?></span></td>
              <td align="right"><span class="Estilo10"><?php echo $total?></span></td>
              <td>&nbsp;</td>
            </tr>
			
            <tr>
              <td height="21"><span class="Estilo10"><?php echo $fecha0?></span></td>
              <td><span class="Estilo10"><?php echo $td2?></span></td>
              <td><span class="Estilo10">
                <label for="select"><?php echo $doc_ini_f?></label>
              </span></td>
              <td><span class="Estilo10"><?php echo $doc_fin_f?></span></td>
              <td align="center"><span class="Estilo10"><?php echo $cantidad0?></span></td>
              <td align="right"><span class="Estilo10"><?php echo $importe0?></span></td>
              <td align="right"><span class="Estilo10"><?php echo $igv0?></span></td>
              <td align="right"><span class="Estilo10"><?php echo $servicio0?></span></td>
              <td align="right"><span class="Estilo10"><?php echo $total0?></span></td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      </form>
    </td>
  </tr>
</table>



</body>
</html>
