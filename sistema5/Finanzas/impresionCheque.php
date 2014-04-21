<?php 
session_start();

include('../conex_inicial.php');
include('../funciones/funciones.php');

$id=$_REQUEST['valor'];

list($sucursal,$cuenta,$numero,$proveedor,$fechavenc,$importe,$observaciones,$tipo)=mysql_fetch_row(mysql_query("select sucursal,cuenta,numero,proveedor,fechavenc,importe,observaciones,tipo from progpagos where id='".$id."'"));

list($ctabco,$moneda,$banco)=mysql_fetch_row(mysql_query("select ctabco,moneda,descrip from cuentas c,bancos b where c.banco_id=b.id and c.cta_id='".$cuenta."'"));

list($nomSucursal)=mysql_fetch_row(mysql_query("select des_suc from sucursal where cod_suc='".$sucursal."'"));
list($razonsocial)=mysql_fetch_row(mysql_query("select razonsocial from cliente where codcliente='".$proveedor."'"));

list($des_tipo,$cod_tipo)=mysql_fetch_row(mysql_query("select descripcion,codigo from t_pago where id='".$tipo."'"));

list($des_suc)=mysql_fetch_row(mysql_query("select des_suc from sucursal where cod_suc='".$sucursal."'"));

if($moneda=='01'){
$simMon="S/.";
}else{
$simMon="US$.";
}

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
}
.Estilo2 {font-family: Arial, Helvetica, sans-serif}
.Estilo4 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 11px; }
.Estilo6 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo7 {color: #0066CC}
-->
</style>
</head>

<body onLoad="window.print()">
<table width="645" height="250" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="40" align="center"><fieldset>
     <span class="Estilo1"><?php echo $cod_tipo." ".$des_tipo." (".$simMon.")"; ?></span>
   
    </fieldset>
       </td>
  </tr>
  <tr>
    <td height="151"><fieldset>
        <table width="630" height="130" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="88"><span class="Estilo4">Sucursal:</span></td>
            <td width="292"><span class="Estilo1"><?php echo $des_suc ?></span></td>
            <td width="92" class="Estilo4"><span class="Estilo2">Nro Cheque: </span></td>
            <td width="132" class="Estilo6"><span class="Estilo2"><?php echo $numero ?></span></td>
          </tr>
          <tr>
            <td><span class="Estilo4">Banco: </span></td>
            <td class="Estilo6"><span class="Estilo2"><?php echo $banco ?></span></td>
            <td class="Estilo4"><span class="Estilo2">Importe: </span></td>
            <td class="Estilo6"><span class="Estilo2"><?php echo $simMon." ".number_format($importe,2) ?></span></td>
          </tr>
          <tr>
            <td><span class="Estilo4">Nro. Cuenta </span></td>
            <td class="Estilo6"><span class="Estilo2"><?php echo $ctabco ?></span></td>
            <td><span class="Estilo4">Fec. Giro: </span></td>
            <td class="Estilo6"><span class="Estilo2"><?php echo formatofecha($fechavenc); ?></span></td>
          </tr>
          <tr>
            <td><span class="Estilo4">Razonsocial</span></td>
            <td colspan="3" class="Estilo6"><?php echo $razonsocial ?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
    </fieldset>&nbsp;</td>
  </tr>
  <tr>
    <td height="59" align="center"><fieldset><legend class="Estilo4 Estilo7">Documentos</legend>
      <table width="591" height="19" border="0" cellpadding="0" cellspacing="0">
	  
	  <?php 
	  $strSQL="select * from progpagos_det where id_progpagos='".$id."'";
	  //echo $strSQL;
	  $resultado=mysql_query($strSQL,$cn);
	  while($row=mysql_fetch_array($resultado)){
	  ?>
        <tr>
          <td class="Estilo6"><?php echo $row['cod_ope']." ".$row['serie']."-".$row['numero'] ?></td>
        </tr>
	  <?php 
	  }
	  ?>
      </table>
    </fieldset>
     </td>
  </tr>
</table>
</body>
</html>
