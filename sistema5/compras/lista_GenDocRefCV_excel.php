<?php 
if($_REQUEST['tip']!='imp'){
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=excel.xls");
}else{
$print="onload='javascript:window.print();'";
}
		session_start();
		include('../conex_inicial.php');
		include('../funciones/funciones.php');
list($n_tienda)=mysql_fetch_array(mysql_query("select des_tienda from tienda  where cod_tienda='".$_REQUEST['almacen']."'"));	

?>

<html>
<head>
<style type="text/css">
<!--
*{
font-size:12px;
}
.Estilo1 {
	font-size: 24px;
	font-weight: bold;
}
-->
</style>
</head>
<body <?php echo $print ?> >
<table width="905" border="0">
  <tr>
    <td  align="center"></td>
    <td colspan="11" align="center"><span class="Estilo1">Reporte Seguimiento C.V. </span></td>
  </tr>
  <tr>
    <td  align="center"></td>
    <td width="315" colspan="4"><strong>Tienda: <?php echo $n_tienda ?></strong></td>
    <td width="405" colspan="7"><strong>Estado:
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
    <td colspan="11"><strong>Fecha: De <?php echo $_REQUEST['fec1'] ?> al <?php echo $_REQUEST['fec2'] ?></strong></td>
  </tr>
</table>
<table width="773"  border="0" cellpadding="0" cellspacing="1">
        <tr style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px" >
          <td   width="1" height="21" align="center" ><span class="texto2"><strong></strong></span></td>

          <td width="88" align="center"  bgcolor="#CCCCCC"><span class="texto2"><strong>Fec. de Emi </strong></span></td>

          <td width="96" align="center"  bgcolor="#CCCCCC" ><span class="texto2"><strong>N&uacute;mero</strong></span></td>
          <td width="184" align="center"  bgcolor="#CCCCCC"><span class="texto2"><strong>Cliente</strong></span></td>
          <td width="51" align="center"    bgcolor="#CCCCCC" ><span class="texto2"><strong>Mon</strong></span></td>
          <td width="74" align="center"  bgcolor="#CCCCCC" ><span class="texto2"><strong>Importe</strong></span></td>
          <td width="128" align="center"  bgcolor="#CCCCCC" ><span class="texto2"><strong>Ult.Entrega</strong></span></td>
          <td width="54" align="center"  bgcolor="#CCCCCC" ><span class="texto2"><strong>Almac&eacute;n</strong></span></td>
          <td width="32" align="center"  bgcolor="#CCCCCC" ><span class="texto2"><strong>Adj.</strong></span></td>
          <td width="54" align="center" bgcolor="#CCCCCC"><span class="texto2"><strong>Obs.</strong></span></td>
		   <td width="54" align="center" bgcolor="#CCCCCC"><span class="texto2"><strong>Est.</strong></span></td>
        </tr>
  <?php 
    
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
			$mosdocFac=$_REQUEST['mosdocFac'];
			$mosdocAnu=$_REQUEST['mosdocAnu'];
			$Estado=$_REQUEST['Estado'];
			$inifec=explode("-",$fec1);
			$finfec=explode("-",$fec2);
			$formaOrder=$_REQUEST['formaOrder'];
			$campoOrder=$_REQUEST['campoOrder'];
			
			if($campoOrder!="" && $formaOrder!=""){
			$filtroOrden=" order by  ".$campoOrder." ".$formaOrder; 
			}else{
			$filtroOrden=" order by fecha asc ";
			}


if ($mosdocAnu<>''){			
 $SQLMosDoc=" and flag ='$mosdocAnu' ";
}


$Estado=ereg_replace("=T", "='T'", $Estado);
$Estado=ereg_replace("=O", "='O'", $Estado);
$Estado=ereg_replace("=A", "='A'", $Estado);

if (substr($Estado,0,2)<>'T'){
	if (substr($Estado,0,2)=='P' || substr($Estado,0,2)=='T'){
	$Estado=substr($Estado,2,200);
	}
		$Estado=ereg_replace("and", "or", $Estado);
		$Estado= "and ".substr($Estado,3,300);
	if ($Estado=="and "){
	$Estado= "";
	}
}
//echo $Estado;

 if ($Estado<>''){
		  if (trim($Estado)=='T'){
			 $SQLEstado ="";
		  }elseif (trim($Estado)=='P'){
			$SQLEstado =" and flag_r <>'RA' and flag<>'A' and estadoOT<>'O' and estadoOT<>'T' "; 
		  }else{
			$SQLEstado =$Estado;
		  }	
 }else{
	$SQLEstado =" and flag<>'A' and estadoOT<>'O' and estadoOT<>'T' ";
  }
 
 // and flag_r <>'RA'
  if($docref!="0"){
   $filtroCod =" and cod_ope='$docref' ";
  }else{
   $filtroCod =" and (cod_ope='TB' or cod_ope='TF' or cod_ope='NV') ";
  } 
  
 $SQLConsulta=" where tienda='$almacen' ".$filtroCod." and cod_vendedor like '%$vendedor%'
 and C.razonsocial like '%$cliente%'	
 and C.ruc like '%$ruc%'
  $SQLMosDoc   $SQLEstado
    ";
	
// 	and flag_r <>'RA'
//and substring(fecha,1,10) between '".formatofecha($fec1)."' and '".date('Y-m-d')."'

$resultados = mysql_query("select * from cab_mov CM
inner join cliente C on CM.cliente =C.codcliente 
$SQLConsulta
order by cod_ope" ,$cn);
$total_registros = mysql_num_rows($resultados); 
			
$strSQL="select * from cab_mov  CM
inner join cliente C on CM.cliente =C.codcliente 	
$SQLConsulta and substring(fecha,1,10) between '".$inifec[2]."-".$inifec[1]."-".$inifec[0]."' and '".$finfec[2]."-".$finfec[1]."-".$finfec[0]."'  $filtroOrden LIMIT $inicio, $registros";

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
// documentos anulados rojo
$AnRK='';	
$sql="select * from cab_mov 
where cod_cab  ='".$row['cod_cab']."' ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
$est="";
	if ($rowX['flag']=='A'){
		$color_row='#FF0000';
		$AnRK='2';
		$est="A";
	}
}	
// documentos con serie (anulara y desanular no permite)
$sql="select * from series where producto in  (
select cod_prod from det_mov where cod_cab='".$row['cod_cab']."' )
and tienda='$almacen'  LIMIT 0, 1  ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX['id']<>''){
		$color_row='#D7FFF0';
		$AnRK='3';
	}
}
 //documentos con Pagos (anulara y desanular no permite)
/*$sql="select *  from cab_mov where cod_cab='".$row['cod_cab']."'  and condicion='2'
 and flag <>'A'
LIMIT 0, 1  ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
		$color_row='#FFDFF4';
		$AnRK='3';
}*/						 					
 //documentos Terminado
$sql="select * from cab_mov where cod_cab='".$row['cod_cab']."'  and cod_ope in ('TB','TF','NV') and flag<>'A'
LIMIT 0, 1  ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
$est="";
	if ($rowX['estadoOT']=='T'){
		$color_row='#0066FF';
		$AnRK='3';
		$est="T";
	}elseif ($rowX['estadoOT']=='O'){
		$color_row='#FF6600';
		
		
		//$AnRK='3';
	}
	//echo "estado".$rowX['estadoOT'];
}						 					

?>
			
  <tr  onClick="entrada(this)" onDblClick="doc_det(this)"  >
             <td   width="1" height="21" align="center" ><span class="texto2"><strong></strong></span></td>
			 <td width="117" class="texto1"><?php echo  substr($row['fecha'],0,10)?></td>	
			  <td width="79" class="texto1" ><?php echo $row['serie'].'-'.$row['Num_doc']; ?></td>	
              <td width="195" class="texto1"><?php echo $row['razonsocial']?></td>
              <td width="32" align="center" class="texto1"><?  
			  if($moneda==''){
			  if ($row['moneda']=='02'){echo 'US$.';}else{echo 'S/.';}
			  }else{
			  if ($row['monedaSD']=='02'){echo 'US$.';}else{echo 'S/.';}
			  }
			   ?></td>
              <td width="79" align="right" class="texto1"><?php 
			  if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	echo $row['total'];
	}
			  ?></td>
			  <td width="114" align="right" class="texto1">
			  <?php 
			$strSQLSM="select * from referencia where cod_cab='".$row['cod_cab']."' order by id desc ";
	$resultadoMS=mysql_query($strSQLSM,$cn);
	$rowSM=mysql_fetch_array($resultadoMS);
	//echo $sucursal=$rowSM['serie'].'-'.$rowSM['correlativo'];

	$strSQLSM="select * from cab_mov where cod_cab='".$rowSM['cod_cab_ref']."' ";
	$resultadoMS=mysql_query($strSQLSM,$cn);
	$rowR=mysql_fetch_array($resultadoMS);   	
	if ($rowR['cod_cab']<>''){
	//echo '('.formatofecha(substr($rowR['fecha'],0,10)).')  '.$rowR['serie'].'-'.$rowR['Num_doc'];		
	echo formatofecha(substr($rowR['fecha'],0,10)).'-|-'.$rowR['Num_doc'];		
			}	
			   ?></td>			  
			  <td width="48" align="center" class="texto1"><?php echo $row['tienda']?></td>	
			  <td width="31" align="right" class="texto1"><?php  if ($row['archivo']<>''){ echo 'X';}?></td>
			  <td width="61" align="center" class="texto1"><?php if ($row['obs1']<>''){ echo '-|-'; }; ?></td>	
			   <td width="54" align="center" class="texto1" ><?php echo $est ?></td>		 
    </tr>
  
  <?php }?>
</table>



</body>
</html>

		  
	