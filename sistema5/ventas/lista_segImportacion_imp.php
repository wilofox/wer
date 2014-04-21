<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo101 {font-family: Arial, Helvetica, sans-serif}
.Estilo102 {font-size: 12px}
.Estilo103 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
-->
</style>
<?php
		include('../conex_inicial.php');
		include('../funciones/funciones.php');
		//Borrar Sesion multifactura
		session_start();
		unset($_SESSION['Multifactura']);
		 //PAGINACION 1	
		 $registros = 100; 
		 $pagina = $_REQUEST['pagina']; 
			   
		//echo $pagina;

		if ($pagina=='') { 
		$inicio = 0; 
		$pagina = 1; 
		} 
		else { 
		$inicio = ($pagina - 1) * $registros; 
		} 
		//------------------------------------------
			
			$almacen=$_REQUEST['almacen'];
			$cliente=$_REQUEST['cliente'];
			$ruc=$_REQUEST['ruc'];
			$vendedor=$_REQUEST['vendedor'];
			$docref=$_REQUEST['docref'];
			$fec1=$_REQUEST['fec1'];
			$fec2=$_REQUEST['fec2'];
			$Estado=$_REQUEST['Estado'];
			$cmbmoneda=$_REQUEST['cmbmoneda'];
			
			$formaOrder=$_REQUEST['formaOrder'];
			$campoOrder=$_REQUEST['campoOrder'];

		if($campoOrder!="" && $formaOrder!=""){
			$filtroOrden=" order by  ".$campoOrder." ".$formaOrder; 
		}else{		
			if($_REQUEST['ordenar']!=""){
			 	$filtro2=" order by ".$_REQUEST['ordenar']. " ".$_REQUEST['orden']; 	
			}else{
				$filtro2=" order by fecha desc "; 	
			}
		}
		
			

list($n_tienda)=mysql_fetch_array(mysql_query("select des_tienda from tienda  where cod_tienda='".$_REQUEST['almacen']."'"));	
if($_REQUEST['almacen']==0) $n_tienda="Todos";
?>
</head>
<body onload="print()">
<table width="823" border="0" align="center">
  <tr>
    <td width="2"  align="center"></td>
    <td colspan="11" align="center"><h2><b>Reporte de Importaci&oacute;n </b></h2></td>
  </tr>
  <tr>
    <td  align="center"></td>
    <td colspan="4"><strong>Tienda: <?php echo $n_tienda ?></strong></td>
    <td width="354" colspan="7"><strong>Estado:
      <?php 
				
	switch($_REQUEST['Estado']){
case "A":
echo "Anulado";
break;
case "O":
echo "Observado";
break;
case "P":
echo "Pendiente";
break;
case "T":
echo "Todos";
break;
default:
echo "Pendiente";
break;

}

	 ?>
    </strong></td>
  </tr>
  <tr>
    <td  align="center"></td>
    <td colspan="11"><strong>Fecha: De <?php echo $fec1 ?> al <?php echo $fec2 ?></strong></td>
  </tr>
</table>
<table  border="0" align="center" cellpadding="0" cellspacing="0" id="lista_productos">
        <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
          <td height="21" colspan="7" align="center"   style=" border:#CCCCCC solid 1px" ><strong class="Estilo103">.</strong></td>
          <td colspan="2" align="center"  style=" border:#CCCCCC solid 1px" ><strong class="Estilo103">.</strong></td>
        </tr>
        <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
          <td   style=" border:#CCCCCC solid 1px" width="30" height="21" align="center" ><span class="texto2 Estilo101 Estilo102"><strong>N</strong></span></td>

          <td width="88" align="center"  style=" border:#CCCCCC solid 1px"><span class="texto2 Estilo101 Estilo102"><strong>Fec. de Emi </strong></span></td>
		    <td  style=" border:#CCCCCC solid 1px" width="98" ><span class="texto2 Estilo101 Estilo102"><strong><strong>N&uacute;mero</strong></strong></span></td>
		    <td  style=" border:#CCCCCC solid 1px" width="186" ><span class="texto2 Estilo101 Estilo102"><strong><span style=" bor
		  der:#CCCCCC solid 1px"><strong>Proveedor</strong></span></strong></span></td>
		  
          <td  style=" bor
		  der:#CCCCCC solid 1px" width="54" ><span style=" border:#CCCCCC solid 1px"><span class="texto2 Estilo101 Estilo102"><strong><strong>Item.</strong></strong></span></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="40" ><span class="texto2 Estilo101 Estilo102"><strong>Mon</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="73" ><span class="texto2 Estilo101 Estilo102"><strong>Total</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="79" ><span class="Estilo103">Vendedor</span></td>
  </tr>
  <?php 

	if ($almacen=='0'){	
			$strSQL22="select * from tienda order by cod_tienda";
			$resultado22=mysql_query($strSQL22,$cn);
			while($row22=mysql_fetch_array($resultado22)){
			 $tiendas=$tiendas.$row22['cod_tienda'].",";
			}
		$tiendas2=substr($tiendas,0,strlen($tiendas)-1);
		$almacen1  =' tienda in('.$tiendas2.') ';		
		}else{
		$almacen1 = " tienda='$almacen' ";
		}	
//echo $Estado;
$SQLEstado =" and flag<>'A' and cod_cab in (select 	cod_cab FROM det_mov where flag_kardex='') ";	
 
if ($Estado<>''){
		  if (trim($Estado)=='T'){
			 $SQLEstado =" ";
		  }elseif (trim($Estado)=='C'){
			$SQLEstado =" and flag<>'A' and cod_cab in (select 	cod_cab FROM det_mov where flag_kardex='1') ";	
		  }elseif (trim($Estado)=='A'){
		    $SQLEstado =" and flag='A' ";
		  }elseif (trim($Estado)=='O'){
		    $SQLEstado ="  and obs1<>'' and flag<>'A'  ";	//and CM.condicion<>1		
		  }	
 }
 
if ($cmbmoneda==''){
	$Cmoneda='';
}else{
	$Cmoneda=" and moneda='".$cmbmoneda."' ";
}
if ($docref=='0'){
	$CodDoc=" and cod_ope in('NV','TB','TF')  ";
}else{
	$CodDoc=" and cod_ope='$docref' ";
}
 
  $SQLConsulta=" where $almacen1
 $CodDoc
 and cod_vendedor like '%$vendedor%'
 and C.razonsocial like '%$cliente%'	
 and C.ruc like '%$ruc%'
 and substring(fecha,1,10) between '".formatofecha($fec1)."' and '".formatofecha($fec2)."'
 $SQLMosDoc  $Cmoneda  $SQLEstado   "; //

$resultados = mysql_query("select * from cab_mov CM
inner join cliente C on CM.cliente =C.codcliente 
$SQLConsulta
order by cod_ope" ,$cn);
$total_registros = mysql_num_rows($resultados); 
			
$strSQL="select * from cab_mov  CM
inner join cliente C on CM.cliente =C.codcliente 	
$SQLConsulta  $filtro2 $filtroOrden 
LIMIT $inicio, $registros";		
	//echo $strSQL;
						
			$j=0;
			$resultado=mysql_query($strSQL,$cn);

	$resultados2 =mysql_num_rows($resultado); 
	$total_paginas = ceil($total_registros / $registros); 
			
			while($row=mysql_fetch_array($resultado)){
			 	$j++;
				if($j%2==0){
				$color_row='#FFFFFF';//'#E9F3FE';
				}else{
				$color_row='#FFFFFF';
				}	
	
$AnRK='';	
// documentos anulados rojo
$sql="select * from cab_mov  CM inner join det_mov DM on CM.cod_cab=DM.cod_cab  
where CM.cod_cab  ='".$row['cod_cab']."' ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX['flag']=='A'){
		$color_row='#FF0000';
		$AnRK='2';
	}
	else if ($rowX['flag_kardex']==''){		
		$color_row='#FFFFFF';
		//$AnRK='3';
	}
	else if ($rowX['flag_kardex']=='1'){
		$color_row='#0066FF';
		$AnRK='3';
	}
}			 					
if (trim($Estado)=='T'){
	 //$AnRK='3';
}
			 					
?>
			
  <tr >
      <td width="30" align="center"><b><?=$j;?></b></td>

              <td class="texto1" align="center" ><?php echo extraefecha2(substr($row['fecha'],0,10))?></td>
              <td class="texto1" ><?php echo $row['serie'].'-'.$row['Num_doc']; ?></td>
              <td class="texto1"><?php //echo $row['cliente']; ?>
              <?php echo substr(caracteres($row['razonsocial']),0,27); ?></td>			   
              <td class="texto1" align="right"><?php 
			  $sqlK="select count( * ) as items from det_mov 
			  where cod_cab='".$row['cod_cab']."' group by cod_cab ";
			  $resultados11 = mysql_query($sqlK,$cn); 
			  $rowSM=mysql_fetch_array($resultados11);
			  echo $rowSM['items'];
			  ?></td>
              <td align="center" class="texto1"><?  
			  if($moneda==''){
			  if ($row['moneda']=='02'){echo 'US$.';}else{echo 'S/.';}
			  }else{
			  if ($row['monedaSD']=='02'){echo 'US$.';}else{echo 'S/.';}
			  }
			   ?></td>
              <td align="right" class="texto1"><?php echo number_format($row['total'],2)?></td>
			  <td  class="texto1"><?php $resultados11 = mysql_query("select * from usuarios where codigo='".$row['cod_vendedor']."' ",$cn); 
			$rowSM=mysql_fetch_array($resultados11);
			  echo $rowSM['usuario'];?></td>
  </tr>
  
  <?php }?>
</table>
</body>
</html>