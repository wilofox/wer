<?php 
include('../../conex_inicial.php'); 
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=excel.xls");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo3 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo5 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.Estilo6 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #0066CC;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="23" align="center" colspan="7" bgcolor="#F7F7F7" class="Estilo6">DOCUMENTOS CON SALDO </td>
  </tr>
  <tr>
    <td colspan="7"><span class="Estilo3">&nbsp;</span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFF99"></td><td colspan="6"><span class="Estilo3">Documento de Venta</span></td>
  </tr>
  <tr>
    <td bgcolor="#66CCFF"></td><td colspan="6"><span class="Estilo3">Documento de Compra</span></td>
  </tr>
  <tr>
    <td colspan="7"><span class="Estilo3">&nbsp;</span></td>
  </tr>
  <tr>
    <td width="13%" height="23" bgcolor="#F7F7F7"><span class="Estilo5">Tienda</span></td>
    <td width="15%" align="center" bgcolor="#F7F7F7"><span class="Estilo5">Fecha</span></td>
    <td width="17%" align="center" bgcolor="#F7F7F7"><span class="Estilo5">Fecha Audita </span></td>
    <td width="14%" bgcolor="#F7F7F7"><span class="Estilo5">Doc</span></td>
    <td width="15%" bgcolor="#F7F7F7"><span class="Estilo5">Numero</span></td>
    <td width="15%" bgcolor="#F7F7F7"><span class="Estilo5">Condicion</span></td>
    <td width="15%" bgcolor="#F7F7F7"><span class="Estilo5">Moneda</span></td>
    <td width="11%" bgcolor="#F7F7F7"><span class="Estilo5">Saldo</span></td>
  </tr>
  
  <?php 
  
  //$strSQL="SELECT cm.tienda, cm.fecha, cm.cod_ope, cm.serie, cm.Num_doc, cm.moneda, cm.saldo, cm.fecha_aud FROM cab_mov cm WHERE cm.saldo >0 AND cm.condicion ='1'";
  $strSQL="SELECT cm.tipo, concat(su.des_suc, ' - ', ti.des_tienda) as tienda, cm.fecha, cm.condicion, cm.cod_ope, cm.serie, cm.Num_doc, mo.simbolo as moneda, cm.saldo, cm.fecha_aud FROM cab_mov cm inner join sucursal su on su.cod_suc=cm.sucursal inner join operacion op on op.codigo=cm.cod_ope inner join tienda ti on ti.cod_tienda=cm.tienda inner join moneda mo on mo.id=cm.moneda WHERE cm.saldo >0 AND cm.condicion IN (select dt.condicion from detope dt where dt.documento=cm.cod_ope and deuda!='S') and cm.flag!='A' and op.tipo=cm.tipo and substr(op.p1,5,1)='S' and cm.cod_ope NOT IN ('NC','TN') order by concat(cm.tienda,cm.fecha)";
  $resultado=mysql_query($strSQL,$cn);
  while($row=mysql_fetch_array($resultado)){
	  
	  if($row['tipo']=="1"){
		  $bg="#66CCFF";
	  }else{
		  if($row['tipo']=="2"){
			$bg="#FFFF99";  
		  }else{
			$bg="#FFFFFF";
		  }
	  }
  ?>
  <tr>
    <td bgcolor="<?php echo $bg;?>"><span class="Estilo3"><?php echo $row['tienda']?></span></td>
    <td bgcolor="<?php echo $bg;?>" align="center"><span class="Estilo3"><?php echo $row['fecha']?></span></td>
    <td bgcolor="<?php echo $bg;?>" align="center"><span class="Estilo3"><?php echo $row['fecha_aud']?></span></td>
    <td bgcolor="<?php echo $bg;?>"><span class="Estilo3"><?php echo $row['cod_ope']?></span></td>
    <td bgcolor="<?php echo $bg;?>"><span class="Estilo3"><?php echo $row['serie']."-".$row['Num_doc']?></span></td>
    <td bgcolor="<?php echo $bg;?>"><span class="Estilo3"><?php $sql_condi=mysql_fetch_array(mysql_query("select nombre from condicion where codigo='".$row['condicion']."'",$cn)); echo $sql_condi[0];?></span></td>
    <td bgcolor="<?php echo $bg;?>"><span class="Estilo3"><?php echo $row['moneda']?></span></td>
    <td bgcolor="<?php echo $bg;?>" align="right"><span class="Estilo3"><?php echo $row['saldo']?></span></td>
  </tr>
  
  <?php  } ?>
</table>
</body>
</html>
