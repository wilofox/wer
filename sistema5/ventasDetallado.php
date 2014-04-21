<?php 
session_start();
include('conex_inicial.php');


    $rowd=mysql_fetch_array(mysql_query("select usuario from usuarios where codigo='".$_SESSION['codvendedor']."' ",$cn));
	//$meta=$rowd['meta'];
	$usuario=$rowd['usuario'];
	
	/*
	 $rowd2=mysql_fetch_array(mysql_query("select * from utilxvendedor where usuario='".$_SESSION['codvendedor']."' ",$cn));
	 $meta=$rowd2['meta'];
	*/
	
	$fecha1=date('Y-m-d');
	
function ventasVendUtil($fecha1,$fecha2,$responsable){

    include('conex_inicial.php');
	//$rowd=mysql_fetch_array(mysql_query("select meta from usuarios where codigo='".$responsable."' ",$cn));
	//$meta=$rowd['meta'];
	/*
	 $rowd2=mysql_fetch_array(mysql_query("select * from utilxvendedor where usuario='".$responsable."' ",$cn));
	 $meta=$rowd2['meta'];
*/
	$strSQL="select * from cab_mov c,det_mov d where d.cod_cab=c.cod_cab and substring(c.fecha,1,10) between '$fecha1' and '$fecha2' and flag!='A' and cod_vendedor='".$usuario."' and c.tipo='2' and c.cod_ope in('TF','TB','NV','FA','BV','OP') ";
	//echo $strSQL;
	$resultado=mysql_query($strSQL,$cn);
	while($row=mysql_fetch_array($resultado)){
	//echo $row['cod_ope']." ".$row['serie']." ".$row['numero']."<br>";
	
	$strSQL2="select * from series where salida='".$row['cod_cab']."' and producto='".$row['cod_prod']."' and tienda='".$row['tienda']."'";
	$resultado2=mysql_query($strSQL2,$cn);
	$row2=mysql_fetch_array($resultado2);
	$conReg=mysql_num_rows($resultado2);
	//echo $strSQL2."<br>";
	
	/*
		$tempCosto=$row2['costo'];
		if($conReg>0){
		$pcosto=$tempCosto*$row['cantidad'];
		$utilidadTotal=$utilidadTotal+($row['precio']*$row['cantidad']-$pcosto);
		
		}else{
			if($row['descargo']=='N'){
				$utilidadTotal=$utilidadTotal+($row['precio']*$row['cantidad']);
							
			}
		}
	*/
	$strSQL2="select * from lotes where cod_cab='".$row['cod_cab']."' and producto='".$row['cod_prod']."' ";
	$resultado2=mysql_query($strSQL2,$cn);
	while($row2=mysql_fetch_array($resultado2)){
		
		$tempCosto=$row2['costo'];
		$pcosto=$tempCosto*$row2['cant'];
		$utilidadTotal=$utilidadTotal+($row['precio']*$row2['cant']-$pcosto);
	}
			
		
		
	$totalVentas=$totalVentas+$row['precio']*$row['cantidad'];
	}

	if($totalVentas=='')$totalVentas=0;
	if($utilidadTotal=='')$utilidadTotal=0;
	
	return $totalVentas."|".$utilidadTotal;
	
}



?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo7 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 11px; color: #FFFFFF; }
.Estilo8 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 14px;
}
.Estilo10 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
}
.Estilo13 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
-->
</style>
</head>
<script>
function iniciar(){
}
</script>

<body onLoad="iniciar()">
<form name="form1" method="post" action="">
  <table width="783" height="122" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="26" colspan="3" align="center"><span class="Estilo8">Ventas Detallado x Producto </span></td>
    </tr>
    <tr>
      <td width="9">&nbsp;</td>
      <td width="761"><table width="759" height="103" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td width="81" bgcolor="#0066CC"><span class="Estilo7">Codigo</span></td>
            <td width="345" align="center" bgcolor="#0066CC"><span class="Estilo7">Producto</span></td>
            <td width="77" align="center" bgcolor="#0066CC"><span class="Estilo7">Cantidad</span></td>
            <td width="72" align="center" bgcolor="#0066CC"><span class="Estilo7">Total Venta </span></td>
            <td width="83" align="center" bgcolor="#0066CC"><span class="Estilo7">Total Costo </span></td>
            <td width="82" align="center" bgcolor="#0066CC"><span class="Estilo7">Utilidad</span></td>
          </tr>
          <?php 
	 
	 
	 $strSQL="select cod_prod,c.cod_cab,c.tienda,sum(if(c.cod_ope!='TN',cantidad,-cantidad))  as cantidad,nom_prod, sum(if(c.cod_ope!='TN',precio*cantidad , -precio*cantidad) ) as totales from cab_mov c,det_mov d where c.cod_cab=d.cod_cab and substring(fecha,1,10)='$fecha1'  and c.flag!='A' and c.cod_vendedor='".$_SESSION['codvendedor']."' and c.tipo='2' and c.cod_ope in('TF','TB','NV','FA','BV','OP') group by cod_prod,nom_prod";
  
//  echo $strSQL."<br>";
  $resultado=mysql_query($strSQL,$cn);
  while($row=mysql_fetch_array($resultado)){
  
  $tot=$tot+$row['totales'];
   $totcant=$totcant+$row['cantidad'];
	
	
	 $strSQLS="select cantidad,c.cod_cab,cod_prod from cab_mov c,det_mov d where c.cod_cab=d.cod_cab and substring(fecha,1,10)='$fecha1'  and c.flag!='A' and c.cod_vendedor='".$_SESSION['codvendedor']."' and c.tipo='2' and c.cod_ope in('TF','TB','NV','FA','BV','OP') and cod_prod='".$row['cod_prod']."'";
	
	//echo $strSQLS."<br>";
	$resultadoS=mysql_query($strSQLS,$cn);
	$totalCosto=0;
	
  	while($rowS=mysql_fetch_array($resultadoS)){
	
	
	/*
	************* series *************

	$strSQL2="select * from series where salida='".$rowS['cod_cab']."' and producto='".$row['cod_prod']."' and tienda='".$row['tienda']."'";
	$resultado2=mysql_query($strSQL2,$cn);
	$row2=mysql_fetch_array($resultado2);
	$conReg=mysql_num_rows($resultado2);
	
	$tempCosto=$row2['costo'];
	$totalCosto=$totalCosto+($rowS['cantidad']*$tempCosto);
	
	//***********************
	*/
	
	}
	
	$strSQL2="select * from lotes where cod_cab='".$row['cod_cab']."' and producto='".$row['cod_prod']."' ";
	//echo $strSQL2;
	$resultado2=mysql_query($strSQL2,$cn);
	while($row2=mysql_fetch_array($resultado2)){
		
		$tempCosto=$row2['costo'];
		$totalCosto=$totalCosto+($row2['cant']*$tempCosto);
		
	}
		
	
	
	//echo $strSQL2."<br>";
	
	//list($cantxserie)=mysql_fetch_row(mysql_query("select cantidad from det_mov where cod_cab='".$row['cod_cab']."' and cod_prod='".$row['cod_prod']."' and tienda='".$row['tienda']."'"));
	
	
		
	 /*-----------------*/ 
	 	//$totalCosto=$row['cantidad']*$tempCosto;
		
		
		
		
		$totcosto=$totcosto+$totalCosto;
		
		$totUtil=$totUtil+($row['totales']-$totalCosto);

	 ?>
          <tr>
            <td bgcolor="#E6E6E6" style="border-bottom:#999999 solid 1px"><span class="Estilo13"><?php echo $row['cod_prod']; ?></span></td>
            <td align="left" bgcolor="#E6E6E6" style="border-bottom:#999999 solid 1px"><span class="Estilo13"><?php echo $row['nom_prod']; ?></span></td>
            <td align="center" bgcolor="#E6E6E6" style="border-bottom:#999999 solid 1px"><span class="Estilo13"><?php echo $row['cantidad']; ?></span></td>
            <td align="right" bgcolor="#E6E6E6" style="border-bottom:#999999 solid 1px"><span class="Estilo13"><?php echo number_format($row['totales'],2); ?></span></td>
            <td align="right" bgcolor="#E6E6E6" class="Estilo13" style="border-bottom:#999999 solid 1px"><?php echo number_format($totalCosto,2); ?></td>
            <td align="right" bgcolor="#E6E6E6" class="Estilo13" style="border-bottom:#999999 solid 1px"><?php  echo number_format($row['totales']-$totalCosto,2) ;?></td>
          </tr>
          <?php 
	 
	 }
	 ?>
          <tr>
            <td height="42" bgcolor="#F8DF7C"><span class="Estilo10">TOTAL</span></td>
            <td align="left" bgcolor="#F8DF7C" class="Estilo13">&nbsp;</td>
            <td align="center" bgcolor="#F8DF7C" class="Estilo13"><strong><?php echo $totcant ?></strong></td>
            <td align="right" bgcolor="#F8DF7C" class="Estilo13"><strong><?php echo number_format($tot,2) ?></strong></td>
            <td align="right" bgcolor="#F8DF7C" class="Estilo13"><strong><?php echo number_format($totcosto,2) ?></strong></td>
            <td align="right" bgcolor="#F8DF7C" class="Estilo13"><strong><?php echo number_format($totUtil,2); ?></strong></td>
          </tr>
      </table></td>
      <td width="13">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="hidden" name="tempTotU" id="tempTotU" value="<?php echo $totalUtil ?>">
      <input type="hidden" name="tempMeta" id="tempMeta" value="<?php echo $meta ?>"></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
