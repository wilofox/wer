<?php 
include('conex_inicial.php');


if(isset($_REQUEST['accion'])){

$accion=$_REQUEST['accion'];

	if($accion=='grabar'){
		$fecha=$_REQUEST['fecha'];
		$tipo=$_REQUEST['tipo'];
		$numero=$_REQUEST['numero'];
		$tcambio=$_REQUEST['tcambio'];
		$moneda=$_REQUEST['moneda'];
		$monto=number_format($_REQUEST['monto'],2);
		$obs=$_REQUEST['obs'];
	
		$strSQL1="select max(id) as codigo from flujo";
		$resultado1=mysql_query($strSQL1,$cn);
		$row1=mysql_fetch_array($resultado1);
		$codigo=str_pad($row1['codigo']+1, 6, "0", STR_PAD_LEFT);
		
		$strSQL2="insert into flujo(id,fecha,tipo,numero,moneda,tc,monto,observaciones) values('".$codigo."','".$fecha."','".$tipo."','".$numero."','".$moneda."','".$tcambio."','".$monto."','".$obs."')";
		//echo $strSQL2;
		mysql_query($strSQL2);
	}


	if($accion=='eliminar'){
	$strSQL3="delete from flujo where id='".$_REQUEST['id']."'";
	mysql_query($strSQL3);
	}

}



?>

<table width="425" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="32" align="center" bgcolor="#0066CC"><span class="Estilo17">Tipo</span></td>
    <td width="57" align="center" bgcolor="#0066CC"><span class="Estilo17">Numero</span></td>
    <td width="51" align="center" bgcolor="#0066CC"><span class="Estilo17">Moneda</span></td>
    <td width="36" align="center" bgcolor="#0066CC"><span class="Estilo17">T.c.</span></td>
    <td width="42" align="center" bgcolor="#0066CC"><span class="Estilo17">Monto</span></td>
    <td width="150" align="center" bgcolor="#0066CC"><span class="Estilo17">Obs</span></td>
    <td width="35" align="center" bgcolor="#0066CC"><span class="Estilo17">A</span></td>
  </tr>
  <?php
  
  $fecha=$_REQUEST['fecha'];
  
  $strSQL="select * from flujo where fecha='$fecha'";
  //echo $strSQL;
  $resultado=mysql_query($strSQL,$cn);
  while($row=mysql_fetch_array($resultado)){
  
  ?>
  
  <tr>
    <td align="center" bgcolor="#EAEAEA"><span class="Estilo14"><?php echo $row['tipo']?></span></td>
    <td bgcolor="#EAEAEA"><span class="Estilo14"><?php echo $row['numero']?></span></td>
    <td align="center" bgcolor="#EAEAEA"><span class="Estilo14"><?php echo $row['moneda']?></span></td>
    <td bgcolor="#EAEAEA"><span class="Estilo14"><?php echo $row['tc']?></span></td>
    <td align="right" bgcolor="#EAEAEA"><span class="Estilo14"><?php echo number_format($row['monto'],2)?></span></td>
    <td bgcolor="#EAEAEA"><span class="Estilo14"><?php echo $row['observaciones']?></span></td>
    <td align="center" bgcolor="#EAEAEA"><a href="javascript:eliminar('<?php echo $row['id']?>')"><img src="imgenes/eliminar.gif" width="14" height="14" border="0" /></a></td>
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
  </tr>
</table>

