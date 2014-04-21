<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo100 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
.texto1{
font-size:12px;
}
-->
</style>
<?php

		include('../conex_inicial.php');
		include('../funciones/funciones.php');
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
			$campoOrder=$_REQUEST['campoOrder'];
			$formaOrder=$_REQUEST['formaOrder'];
			list($n_tienda)=mysql_fetch_array(mysql_query("select des_tienda from tienda  where cod_tienda='".$_REQUEST['almacen']."'"));	
if($_REQUEST['almacen']==0) $n_tienda="Todos";
?>

</head>
<body onload="print()">
<table width="823" border="0" align="center">
  <tr>
    <td width="2"  align="center"></td>
    <td colspan="11" align="center"><h2><b>Reporte Art&iacute;culos Entregados </b></h2></td>
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
    <td colspan="11"><strong>Fecha: De <?php echo $_REQUEST['fec1'] ?> al <?php echo $_REQUEST['fec2'] ?></strong></td>
  </tr>
</table>
<table  border="0" align="center" cellpadding="0" cellspacing="0" id="lista_productos">
    <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
          <td   style=" border:#CCCCCC solid 1px" width="25" height="21" align="center" ><span class="texto2"><strong>N</strong></span></td>

          <td  style=" border:#CCCCCC solid 1px" width="82" ><strong class="texto2">Local</strong></td>
          <td width="75" align="center"  style=" border:#CCCCCC solid 1px"><span class="texto2"><strong>Fec.Entrega </strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="150" ><span class="texto2"><strong>Cliente</strong></span>		  </td>
          <td  style=" border:#CCCCCC solid 1px" width="150"><span class="texto2"><strong>Art&iacute;culo
		  </strong></span>		  </td>
          <td  style=" border:#CCCCCC solid 1px" width="78" ><span class="texto2"><strong>Referencia</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="71" ><span class="texto2"><strong>Condici&oacute;n </strong></span></td>
          <td width="72"  style=" border:#CCCCCC solid 1px" align="center" ><span class="texto2"><strong>T&eacute;cnico</strong></span></td>
          <td width="38"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Días</strong></span></td>
          <td width="82"  style=" border:#CCCCCC solid 1px" align="center"><span class="texto2"><strong>Fec.Emisi&oacute;n</strong></span></td>
		  <td  style=" border:#CCCCCC solid 1px" width="29" align="center"><span class="texto1"><b>Est.</b>
          </span></td>
  </tr>
  <?php 

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
//echo  $Estado;

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
			//$SQLEstado =$Estado;
	$SQLEstado= " and cod_cab in (select cod_cab from cab_mov where ".substr($Estado,3,300)."  and cod_ope in ('S2','R2') )";

		  }	
 }else{
	$SQLEstado =" and flag<>'A' and estadoOT<>'O' and estadoOT<>'T' ";
  }

  
if($almacen<>0){	
  $Tienda=" tienda='$almacen' and ";
 }
 if($docref=='S2' || $docref=='R2'){	
  $CodDoc=" cod_ope='$docref' and ";
 }else{
    $CodDoc=" cod_ope in ('S2','R2') and ";
 }
 // echo $SQLEstado;
 $SQLConsulta=" where $Tienda $CodDoc cod_vendedor like '%$vendedor%'
 and C.razonsocial like '%$cliente%'	
 and C.ruc like '%$ruc%'
  and substring(fecha,1,10) between '".formatofecha($fec1)."' and '".formatofecha($fec2)."'
 $SQLMosDoc   $SQLEstado  ";


$resultados = mysql_query("select *,CM.condicion as cod_condicion from cab_mov CM
inner join cliente C on CM.cliente =C.codcliente 
inner join tienda T on CM.tienda = T.cod_tienda 
$SQLConsulta
order by cod_ope" ,$cn);
 
$total_registros = mysql_num_rows($resultados); 
			
$strSQL="select *,CM.condicion as cod_condicion,(select p.nombre from producto p inner join det_mov dt where dt.cod_cab=CM.cod_cab and p.idproducto=dt.cod_prod limit 1) as n_prod from cab_mov  CM
inner join cliente C on CM.cliente =C.codcliente 	
inner join tienda T on CM.tienda = T.cod_tienda
$SQLConsulta	$filtroOrden
LIMIT $inicio, $registros";
						
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
				$est="";
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
		$est="";
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
		$est="";
}						 					
 //documentos Terminado
$sql="select * from cab_mov where cod_cab='".$row['cod_cab']."'  and cod_ope in ('S2','R2') and flag<>'A'
LIMIT 0, 1  ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX['estadoOT']=='T'){
		$color_row='#0066FF';
		$AnRK='3';
		$est="T";
	}elseif ($rowX['estadoOT']=='O'){
		$color_row='#FF6600';
		//$AnRK='3';
		$est="O";
	}
}	
?>
			
  <tr  onClick="entrada(this)" ondblclick="doc_det(this)"  >
      <td align="center"><?php echo ++$num_item?></td>

             <td class="texto1" ><?php echo $row['des_tienda']?></td>	
			  <td class="texto1" ><?php echo formatofecha(substr($row['fecha'],0,10));?></td>	
              <td class="texto1"><?php echo substr(caracteres($row['razonsocial']),0,20);?></td>
              <td class="texto1"><?php 
			  $strSQLSM="select * from det_mov where cod_cab='".$row['cod_cab']."' ";
				$resultadoMS=mysql_query($strSQLSM,$cn);
				$rowR=mysql_fetch_array($resultadoMS);					

			  $strSQLP="select * from producto where idproducto ='".$rowR['cod_prod']."' ";
				$resultadoP=mysql_query($strSQLP,$cn);
				$rowP=mysql_fetch_array($resultadoP);

				echo substr(caracteres($rowP['nombre']),0,18);
			  ?></td>
			  <td class="texto1"><?php 
			  $strSQL08="select * from referencia where cod_cab_ref='".$row['cod_cab']."'  ";
			  $resultado08=mysql_query($strSQL08,$cn);
		      $row08=mysql_fetch_array($resultado08);
			  
			  $strSQL09="select * from cab_mov where cod_cab='".$row08['cod_cab']."'  ";
			  $resultado09=mysql_query($strSQL09,$cn);
		      $row09=mysql_fetch_array($resultado09);
			  echo $row09['serie'].'-'.$row09['Num_doc'];
			   ?></td>
			  <td class="texto1"><?php 
			  $strSQL09="select * from condicion where codigo='".$row[27]."'  ";
			  $resultado09=mysql_query($strSQL09,$cn);
		      $row09=mysql_fetch_array($resultado09);			  
			  echo $row09['nombre']; 
			  ?></td>
			  <td align="center" class="texto1"><?php 
			   $strSQL09="select * from usuarios where codigo='".$row['cod_vendedor']."'  ";
			  $resultado09=mysql_query($strSQL09,$cn);
		      $row09=mysql_fetch_array($resultado09);
			  echo $row09['usuario']; ?></td>	
			  <td align="center" class="texto1"><?php 
			  //formatofecha(substr($row['fecha'],0,10));
			  //formatofecha(substr($row['f_venc'],0,10));
			  echo restaFechas(formatofecha(substr($row['fecha'],0,10)),formatofecha(substr($row['f_venc'],0,10)));			
			  
			  ?></td>
			  <td align="center" class="texto1"><?php echo formatofecha(substr($row['f_venc'],0,10));?></td>	
<td align="center" class="texto1" >	  
	   <? echo $est; ?> </td>	 
  </tr>
  <?php }?>
</table>
</body>
</html>