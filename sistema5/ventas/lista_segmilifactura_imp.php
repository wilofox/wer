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
			//$fec1=$_REQUEST['fec1'];
			//$fec2=$_REQUEST['fec2'];
			$fec1=gmdate('d-m-Y',time()-18000);
			$fec2=gmdate('d-m-Y',time()-18000);
			
			$mosdocFac=$_REQUEST['mosdocFac'];
			$mosdocAnu=$_REQUEST['mosdocAnu'];
			$Estado=$_REQUEST['Estado'];
			$cmbmoneda=$_REQUEST['cmbmoneda'];
			
			$formaOrder=$_REQUEST['formaOrder'];
			$campoOrder=$_REQUEST['campoOrder'];
			
			if($campoOrder!="" && $formaOrder!=""){
			$filtroOrden=" order by  ".$campoOrder." ".$formaOrder; 
			}else{
			$filtroOrden=" order by PA.fecha desc ";
			}
			

list($n_tienda)=mysql_fetch_array(mysql_query("select des_tienda from tienda  where cod_tienda='".$_REQUEST['almacen']."'"));	
if($_REQUEST['almacen']==0) $n_tienda="Todos";
?>
</head>
<body onload="print()">
<table width="823" border="0" align="center">
  <tr>
    <td width="2"  align="center"></td>
    <td colspan="11" align="center"><h2><b>Reporte de Cobranzas </b></h2></td>
  </tr>
  <tr>
    <td  align="center"></td>
    <td colspan="4"><strong>Tienda: <?php echo $n_tienda ?></strong></td>
    <td width="354" colspan="7"><strong>Estado:
      <?php 
	switch($_REQUEST['Estado']){
case "and estadoOT=T":
echo "Terminado";
break;
case "and flag=A":
echo "Anulado";
break;
case "and estadoOT=O":
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
          <td height="21" colspan="7" align="center"   style=" border:#CCCCCC solid 1px" ><strong class="Estilo103">Documento</strong></td>
          <td colspan="4" align="center"  style=" border:#CCCCCC solid 1px" ><strong class="Estilo103">Cobranza</strong></td>
        </tr>
        <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
          <td   style=" border:#CCCCCC solid 1px" width="26" height="21" align="center" ><span class="texto2 Estilo101 Estilo102"><strong>N</strong></span></td>

          <td width="84" align="center"  style=" border:#CCCCCC solid 1px"><span class="texto2 Estilo101 Estilo102"><strong>Fec. de Emi </strong></span></td>
		    <td  style=" border:#CCCCCC solid 1px" width="94" ><span class="texto2 Estilo101 Estilo102"><strong>PC</strong></span></td>
		    <td  style=" border:#CCCCCC solid 1px" width="99" ><span class="texto2 Estilo101 Estilo102"><strong>N&uacute;mero</strong></span></td>
		  
          <td  style=" bor
		  der:#CCCCCC solid 1px" width="137" ><span class="texto2 Estilo101 Estilo102"><strong>Cliente</strong></span>		  </td>
          <td  style=" border:#CCCCCC solid 1px" width="36" ><span class="texto2 Estilo101 Estilo102"><strong>Mon</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="69" ><span class="texto2 Estilo101 Estilo102"><strong>Importe</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="75" ><span class="Estilo103">Fecha</span></td>
          <td  style=" border:#CCCCCC solid 1px" width="70" ><span class="Estilo103">Acuenta</span></td>
          <td width="55"  style=" border:#CCCCCC solid 1px" ><span class="Estilo103">Saldo</span></td>
		            <td  style=" border:#CCCCCC solid 1px" width="88" align="center"><span class="texto2 Estilo101 Estilo102"><strong>Cajero</strong></span></td>
  </tr>
  <?php 

		if ($almacen=='0'){	
			$strSQL22="select * from tienda order by cod_tienda";
			$resultado22=mysql_query($strSQL22,$cn);
			while($row22=mysql_fetch_array($resultado22)){
			//echo  $saldos[]=",'".$row22['cod_tienda'].'';
			 $tiendas=$tiendas.$row22['cod_tienda'].",";
			}
		$tiendas2=substr($tiendas,0,strlen($tiendas)-1);
		$almacen1  =' tienda in('.$tiendas2.') ';		
		}else{
		$almacen1 = " tienda='$almacen' ";
		}	

if ($mosdocAnu<>''){			
 echo $SQLMosDoc=" and flag ='$mosdocAnu' ";
}

if ($Estado<>''){
		  if (trim($Estado)=='T'){
			 $SQLEstado ="";
		  }elseif (trim($Estado)=='P'){
			//$SQLEstado =" and flag_r <>'RA' and flag<>'A' and estadoOT<>'O' and estadoOT<>'T' "; 
			$SQLEstado =" and flag_r ='' and flag<>'A' ";
		  }elseif (trim($Estado)=='F'){
		  	$SQLEstado =" and flag_r <>'' ";
		  }else{			
			//$SQLEstado =$Estado;
			 $SQLEstado =" and flag='A' ";
		  }	
 }else{
	//$SQLEstado =" and flag_r <>'RA' and flag<>'A' and estadoOT<>'O' and estadoOT<>'T' ";
	$SQLEstado =" and flag_r =''  and flag<>'A' ";	  
 }
  
//echo $SQLEstado; 
  
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
 
 //and cod_ope='$docref'
 //echo $_SESSION['nivel_usu'];
 if($_SESSION['nivel_usu']==6){
 $filtroVend="and PA.cod_user='".$_SESSION['codvendedor']."'";
 }else{
 $filtroVend=" ";
 }
 
 
 $SQLConsulta=" where $almacen1
 $CodDoc
 ".$filtroVend."
 and C.razonsocial like '%$cliente%'	
 and C.ruc like '%$ruc%'
 and substring(PA.fecha,1,10) between '".formatofecha($fec1)."' and '".formatofecha($fec2)."'
 $SQLMosDoc  $Cmoneda and CM.condicion<>1
    "; //$SQLEstado


$resultados = mysql_query("select * from cab_mov CM
inner join cliente C on CM.cliente=C.codcliente 
inner join pagos PA on  CM.cod_cab=PA.referencia 
$SQLConsulta
order by cod_ope" ,$cn);
$total_registros = mysql_num_rows($resultados); 
			
 $strSQL="select * from cab_mov CM
inner join cliente C on CM.cliente=C.codcliente 
inner join pagos PA on  CM.cod_cab=PA.referencia 
$SQLConsulta $filtroOrden
";
	
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
				$AnRK='2';
				
				}	
				$est="";
// documentos con serie (anulara y desanular no permite)
$sql="select * from series where producto in  (
select cod_prod from det_mov where cod_cab='".$row['cod_cab']."' )
and tienda='$almacen'  LIMIT 0, 1  ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX['id']<>''){
		$color_row='#D7FFF0';
		$AnRK='3';
		$AnRK='2';
		$est="";
	}
}
				 					
 //documentos facturado o canjeado
$sql="select * from referencia where cod_cab_ref='".$row['cod_cab']."'  
LIMIT 0, 1  "; // and flag_r='RO' 
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	//if ($rowX['flag_r']=='RO' || $rowX['flag_r']=='RORA'){
		$color_row='#0066FF';
		$AnRK='3';
		$AnRK='2';
		$est="";
	//}
}	
/*$sql=" select * from cab_mov C
inner join det_mov D on  C.cod_cab=D.cod_cab
inner join producto P on  D.cod_prod=P.idproducto
where C.cod_cab='".$row['cod_cab']."'  ";
	$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX['series']=='S'){
		$color_row='#FFDFF4';
		//$AnRK='3';
	}
}	
$sql=" select * from cab_mov C
inner join det_mov D on  C.cod_cab=D.cod_cab
inner join producto P on  D.cod_prod=P.idproducto
inner join series S on  C.cod_cab=S.salida
where C.cod_cab='".$row['cod_cab']."'  ";
	$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX['series']=='S'){
		$color_row='#D7FFF0';
		//$AnRK='3';
	}
}
 //documentos con Pagos (anulara y desanular no permite)
$sql="select *  from cab_mov where cod_cab='".$row['cod_cab']."'  and condicion='2'
 and flag <>'A'
LIMIT 0, 1  ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
		$color_row='#FFDFF4';
		$AnRK='3';
}*/	
// documentos anulados rojo
$AnRK='';	
$sql="select * from cab_mov 
where cod_cab  ='".$row['cod_cab']."' ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX['flag']=='A'){
		$color_row='#FF0000';
		$AnRK='2';
		$est="A";
	}
	$fechaDoc=$rowX['fecha'];
}					 					
?>
			
  <tr >
      <td width="26" align="center"><b><?=$j;?></b></td>

              <td class="texto1" align="center" ><?php echo extraefecha2(substr($fechaDoc,0,10))?></td>
              <td class="texto1" ><?php echo $row['pc']; ?></td>
              <td class="texto1"><?php echo $row['serie'].'-'.$row['Num_doc']; ?></td>			   
              <td class="texto1"><?php //echo $row['cliente']; ?><?php echo substr(caracteres($row['razonsocial']),0,27); ?></td>
              <td align="center" class="texto1"><?  
			  if($moneda==''){
			  if ($row['moneda']=='02'){echo 'US$.';}else{echo 'S/.';}
			  }else{
			  if ($row['monedaSD']=='02'){echo 'US$.';}else{echo 'S/.';}
			  }
			   ?></td>
              <td align="right" class="texto1"><?php echo number_format($row['total'],2)?></td>
			  <td align="center" class="texto1"><?php echo extraefecha2(substr($row['fecha'],0,10))?></td>
			  <td align="right" class="texto1"><?php echo number_format($row['monto'],2)?></td>
			  <td align="right" class="texto1"><?php echo number_format($row['total']-$row['monto'],2)?></td>	
      <td align="center" class="texto1" ><?php 
			  $resultados11 = mysql_query("select * from usuarios where codigo='".$row['cod_vendedor']."' ",$cn); 
			  $rowSM=mysql_fetch_array($resultados11);
			  echo $rowSM['usuario'];
				?></td>		 
  </tr>
  
  <?php }?>
</table>
</body>
</html>