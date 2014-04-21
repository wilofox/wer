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
	
function ventasVendUtil($fecha1,$fecha2,$responsable){

    include('conex_inicial.php');
	//$rowd=mysql_fetch_array(mysql_query("select meta from usuarios where codigo='".$responsable."' ",$cn));
	//$meta=$rowd['meta'];
	/*
	 $rowd2=mysql_fetch_array(mysql_query("select * from utilxvendedor where usuario='".$responsable."' ",$cn));
	 $meta=$rowd2['meta'];
*/
	$strSQL="select * from cab_mov c,det_mov d where d.cod_cab=c.cod_cab and substring(c.fecha,1,10) between '$fecha1' and '$fecha2' and flag!='A' and cod_vendedor='".$responsable."' and c.tipo='2' and c.cod_ope in('TF','TB','NV','FA','BV','OP') ";
	//echo $strSQL;
	$resultado=mysql_query($strSQL,$cn);
	while($row=mysql_fetch_array($resultado)){
	//echo $row['cod_ope']." ".$row['serie']." ".$row['numero']."<br>";
	
	///************series ***************
	/*
	$strSQL2="select * from series where salida='".$row['cod_cab']."' and producto='".$row['cod_prod']."' and tienda='".$row['tienda']."'";
	$resultado2=mysql_query($strSQL2,$cn);
	$row2=mysql_fetch_array($resultado2);
	$conReg=mysql_num_rows($resultado2);
	
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
	//************************************
	
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
.Estilo9 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 11px;
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
document.getElementById("utilbruta").innerHTML=parseFloat(document.form1.tempTotU.value).toFixed(2);
document.getElementById("utilNeta").innerHTML=(parseFloat(document.form1.tempTotU.value)-parseFloat(document.form1.tempMeta.value)).toFixed(2);
}
</script>

<body onLoad="iniciar()">
<form name="form1" method="post" action="">
  <table width="429" height="122" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="26" colspan="3" align="center"><span class="Estilo8">Ventas Mensual </span></td>
    </tr>
    <tr>
      <td width="9">&nbsp;</td>
      <td width="408"><table width="400" height="104" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td colspan="3"><span class="Estilo9">usuario:</span> <?php echo $usuario ?> &nbsp;&nbsp;<span class="Estilo9"> meta capital:</span> <?php echo  number_format($meta,2)?></td>
          </tr>
          <tr>
            <td colspan="3"><span class="Estilo9">Utilidad bruta:</span>
              <label id="utilbruta"></label>&nbsp;&nbsp;&nbsp;
             <span class="Estilo9"> Utilidad Neta: </span><label id="utilNeta"></label></td>
          </tr>
          <tr>
            <td colspan="3"><span class="Estilo9">Sueldo M&iacute;nimo : </span>S/.750 &nbsp;&nbsp;<span class="Estilo9">Hora Extras:  </span>S/.100 &nbsp;<span class="Estilo9"> </span></td>
          </tr>
          <tr>
            <td colspan="3"><span class="Estilo9">Bon1:</span> S/. 50&nbsp;&nbsp;<span class="Estilo9">&nbsp;</span> <span class="Estilo9">Bon2:</span> 1%(Utilidad Neta) <span class="Estilo9">&nbsp;&nbsp;&nbsp;Desc: jubilaci&oacute;n &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
          </tr>
          
          <tr>
            <td colspan="3"><span class="Estilo9">Total  &nbsp;Pago: Sueldo M&iacute;nimo</span> + <span class="Estilo9">Hora Extras </span>+<span class="Estilo9"> Bon1</span> + <span class="Estilo9">Bon2 - Desc</span></td>
          </tr>
          <tr>
            <td width="85" bgcolor="#0066CC"><span class="Estilo7">Fecha</span></td>
            <td width="115" align="center" bgcolor="#0066CC"><span class="Estilo7">Ventas</span></td>
            <td width="113" align="center" bgcolor="#0066CC"><span class="Estilo7">Utilidad</span></td>
          </tr>
          <?php 
	 
	 $fecha_actual=date("Y-m-d");
	 $dia_actual=date("d");
	 
	 
	 for ( $i = 1 ; $i <= $dia_actual ; $i ++) {
	 
	$tempDatos=explode("|",ventasVendUtil(date("Y-m-").str_pad($i,2,"0",STR_PAD_LEFT),date("Y-m-").str_pad($i,2,"0",STR_PAD_LEFT),$_SESSION['codvendedor']));
	
	//if($tempDatos[0]=='')
	$totalVentas=$totalVentas+$tempDatos[0];
	$totalUtil=$totalUtil+$tempDatos[1];
	 ?>
          <tr>
            <td bgcolor="#F8F8F8"><span class="Estilo13"><?php echo str_pad($i,2,"0",STR_PAD_LEFT).date("-m-Y")?></span></td>
            <td align="center" bgcolor="#F8F8F8"><span class="Estilo13"><?php echo number_format($tempDatos[0],2)?></span></td>
            <td align="center" bgcolor="#F8F8F8"><span class="Estilo13"><?php echo number_format($tempDatos[1],2)?></span></td>
          </tr>
          <?php 
	 
	 }
	 ?>
          <tr>
            <td height="42" bgcolor="#F8F8F8"><span class="Estilo10">TOTAL</span></td>
            <td align="center" bgcolor="#F8F8F8" class="Estilo13"><strong><?php echo number_format($totalVentas,2)?></strong></td>
            <td align="center" bgcolor="#F8F8F8" class="Estilo13"><strong><?php echo number_format($totalUtil,2)?></strong></td>
          </tr>
      </table></td>
      <td width="12">&nbsp;</td>
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
