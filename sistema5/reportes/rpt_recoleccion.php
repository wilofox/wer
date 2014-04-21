<?php 
//session_start();
include('../conex_inicial.php');

if($_REQUEST['formato']=="excel"){

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=excel.xls");
}else{

		$registros = 40; 
		$pagina = $_REQUEST["pagina"]; 
		
		if (!$pagina) { 
		$inicio = 0; 
		$pagina = 1; 
		} 
		else { 
		$inicio = ($pagina - 1) * $registros; 
		}
}
	$fecha1=$_REQUEST['fecha1'];
	$fecha2=$_REQUEST['fecha2'];


?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo10 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo11 {font-family: Arial, Helvetica, sans-serif}
.Estilo13 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.Estilo15 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	font-weight: bold;
}
.Estilo17 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.Estilo19 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
body {
	margin-left: 20px;
	margin-top: 5px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo33 {color: #000000}
-->
</style>
</head>

<script>
function cerrar(){
//alert();
//window.close();
}

</script>

<body >
<div id="seleccion" style="height:600px; width:670px; overflow:auto" >
<table width="636" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" style="border:#999999 solid 1px" >
  <tr>
    <td colspan="6">
	
	<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:#999999 solid 1px">
      <tr>
        <td width="143" class="Estilo19" >Pagina <?php echo $pagina; ?></td>
        <td width="364" >&nbsp;</td>
        <td width="125" align="right" ><span class="Estilo13">Fecha: <?php echo date('d-m-Y');?></span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center"><span class="Estilo15">Reporte Consolidado de Productos Vendidos </span></td>
        <td align="right"><span class="Estilo13">Hora : <?php echo date('H:i:s',time()-3600)?></span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center" valign="top"><span class="Estilo17">Del <?php echo $fecha1 ?> Al: <?php echo $fecha2 ?></span></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>	</td>
  </tr>
  
  <tr>
    <td height="29">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td width="14%" height="29"><span class="Estilo13">Codigo</span></td>
    <td width="48%"><span class="Estilo13">Nombre de Articulo </span></td>
    <td width="12%"><span class="Estilo13">Cantidad </span></td>
    <td width="7%"><span class="Estilo13">Mon</span></td>
    <td width="10%" align="right"><span class="Estilo13">Valorizado</span></td>
    <td width="9%" align="right">&nbsp;</td>
    </tr>
<?php 
						
			
$vende=$_REQUEST['vendedor'];
if($vende!="000"){
	$filtro1=" and c.cod_vendedor='$vende' ";
}else{
	$filtro1="";
}
$val_item=0;
	
$strSQL="SELECT c.*,cod_prod,cantidad,precio,c.impto1 as igv_d,c.incluidoigv as flag_igv,d.flag_kardex as fk from cab_mov c, det_mov d where d.cod_cab=c.cod_cab and c.cod_ope!='CM' and c.cod_ope!='AS' and c.cod_ope!='TS' and  substring(fecha,1,10) between '$fecha1' and '$fecha2' ".$filtro2.$filtro1." and c.flag!='A' and c.tipo=2 order by d.nom_prod";

$d=0;
$c=0;
$resultado=mysql_query($strSQL,$cn);
while($row=mysql_fetch_array($resultado)){
	if($row['total']<>0.00){
		if($d==0){
			$codp=$row['cod_prod'];
			$result[0][$c]=$row['cod_prod'];
			$result[1][$c]=0;
			$result[2][$c]=0;
		}
		if($codp==$row['cod_prod']){
			if($row['fk']=='1'){
				$result[1][$c]=$row['cantidad']-$result[1][$c];
			}else{
				$result[1][$c]=$row['cantidad']+$result[1][$c];
			}
			$sql_prod=mysql_query("Select moneda from producto where idproducto='".$row['cod_prod']."'",$cn);
			$row_prod=mysql_fetch_array($sql_prod);
			if($row['moneda']<>$row_prod[0]){
				switch($row['moneda']){
					case '01':$precio=$row['precio']*$row['tc'];break;
					case '02':$precio=$row['precio']/$row['tc'];break;
				}
			}else{
				$precio=$row['precio'];
			}
			$imp_t=$row['cantidad']*$precio;
			if($row['flag_igv']=='N'){
				$iv=$imp_t*$row['igv_d']/100;
				$imp_t=$imp_t+$iv;
			}
			$result[2][$c]=$imp_t+$result[2][$c];
		}else{
			$c++;
			$codp=$row['cod_prod'];
			$result[0][$c]=$row['cod_prod'];
			$result[1][$c]=0;
			$result[2][$c]=0;
			if($row['fk']=='1'){
				$result[1][$c]=$row['cantidad']-$result[1][$c];
			}else{
				$result[1][$c]=$row['cantidad']+$result[1][$c];
			}
			$sql_prod=mysql_query("Select moneda from producto where idproducto='".$row['cod_prod']."'",$cn);
			$row_prod=mysql_fetch_array($sql_prod);
			if($row['moneda']<>$row_prod[0]){
				switch($row['moneda']){
					case '01':$precio=$row['precio']*$row['tc'];break;
					case '02':$precio=$row['precio']/$row['tc'];break;
				}
			}else{
				$precio=$row['precio'];
			}
			$imp_t=$row['cantidad']*$precio;
			if($row['flag_igv']=='N'){
				$iv=$imp_t*$row['igv_d']/100;
				$imp_t=$imp_t+$iv;
			}
			$result[2][$c]=$imp_t+$result[2][$c];
		}
		$d++;
	}
}
for($i=0;$i<count($result[0]);$i++){  
	$codigo=$result[0][$i];
	$cantidad=$result[1][$i]; 
	$sql_prod=mysql_query("Select nombre,moneda from producto where idproducto='".$codigo."'",$cn);
	$row_prod=mysql_fetch_array($sql_prod);
	$producto=$row_prod[0];
	if($row_prod['moneda']=="01"){
		$moneda="S/.";
	}else{
		$moneda="US$.";
	}
    $total_item=$total_item+$cantidad;
	//$val_item=$val_item+($cantidad*$row['precio']);
	$val_item=$val_item+($result[2][$i]);
?>
						
	<tr>
    	<td bgcolor="#F9F9F9"><span class="Estilo10"><?php echo $codigo?></span></td>
        <td bgcolor="#F9F9F9"><span class="Estilo10"><?php echo $producto?></span></td>
        <td bgcolor="#F9F9F9" align="center"><span class="Estilo10"><?php echo $cantidad?></span></td>
        <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?php echo $moneda?></span></td>
        <td align="right" bgcolor="#F9F9F9"><span class="Estilo10"><?php echo number_format($result[2][$i],2,".","");/*echo $cantidad*$row['precio'];*/?></span></td>
        <td align="center" bgcolor="#F9F9F9">&nbsp;</td>
    </tr>
<?php 
}
?>
    <tr>
		<td bgcolor="#F9F9F9">&nbsp;</td>
		<td height="21" bgcolor="#F9F9F9">&nbsp;</td>
		<td bgcolor="#F9F9F9">&nbsp;</td>
		<td align="center" bgcolor="#F9F9F9">&nbsp;</td>
		<td align="right" bgcolor="#F9F9F9">&nbsp;</td>
		<td bgcolor="#F9F9F9">&nbsp;</td>
	</tr>
	<tr>
	    <td bgcolor="#F9F9F9">&nbsp;</td>
        <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
        <td bgcolor="#F9F9F9"><span class="Estilo7">Total General</span></td>
        <td align="center" bgcolor="#F9F9F9"><span class="Estilo7"><?php echo $total_item?></span></td>
        <td align="right" bgcolor="#F9F9F9" class="Estilo17"><?php echo number_format($val_item,2,".","");?></td>
        <td align="center" bgcolor="#F9F9F9">&nbsp;</td>
    </tr>
</table>
</div>
<?php if($_REQUEST['formato']=='vista'){?>
<table>
	<tr>
    	<td align="left" bgcolor="#F2F2F2"><a href="#" onClick="javascript:imprSelec()"><img src="../imgenes/fileprint.png" width="25" height="25" border="0"> <span class="Estilo19">Imprimir Pag.</span> </a></td>
  	</tr>
</table>
<?php }?>
</body>
</html>


<script language="Javascript">
function imprSelec()
{
  var ficha = document.getElementById('seleccion');
  var ventimp = window.open(' ', 'popimpr');
  ventimp.document.write( ficha.innerHTML );
  ventimp.document.close();
  ventimp.print( );
  ventimp.close();
} 
</script> 

