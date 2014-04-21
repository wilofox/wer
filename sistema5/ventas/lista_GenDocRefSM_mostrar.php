<?php
		include('../conex_inicial.php');
		include('../funciones/funciones.php');
list($n_tienda)=mysql_fetch_array(mysql_query("select des_tienda from tienda  where cod_tienda='".$_REQUEST['almacen']."'"));	
?>
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
.texto1 {	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #000000;
}
.texto2 {	font-family: Verdana,Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #000000;
}
.Estilo1 {	font-size: 24px;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<table width="708" border="0">
  <tr>
    <td width="2"  align="center"></td>
    <td colspan="11" align="center"><span class="Estilo1">Reporte Seguimiento De Entregas </span></td>
  </tr>
  <tr>
    <td  align="center"></td>
    <td colspan="4"><strong>Tienda: <?php echo $n_tienda ?></strong></td>
    <td width="276" colspan="7"><strong>Estado:
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
<table width="709" border="0" cellpadding="0" cellspacing="1">
  <tr bgcolor="#CCCCCC">

    <td  style=" border:#CCCCCC solid 1px" width="89" align="center"><span class="texto2"><strong>Fec. de Emi </strong></span></td>
    <td width="105" align="center"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Número</strong></span></td>
    <td width="213" align="center"  style=" border:#CCCCCC solid 1px"><span class="texto2"><strong>Responsable</strong></span></td>
    <td width="70" align="center"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Cant.Item</strong></span></td>
    <td width="101" align="center"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>O.T.</strong></span></td>
    <td width="50" align="center"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Adj.</strong></span></td>
    <td width="46" align="center"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Obs</strong></span></td>
	 <td width="26" align="center"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Est.</strong></span></td>
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
			$SQLEstado =$Estado;
		  }	
 }else{
	$SQLEstado =" and flag_r <>'RA' and flag<>'A' and estadoOT<>'O' and estadoOT<>'T' ";
  }
  
//echo $SQLEstado; 
  
  if($docref!="0"){
   $filtroCod =" and cod_ope='$docref' ";
  }else{
   $filtroCod =" and (cod_ope='RM' or cod_ope='SM') ";
  } 
  
 $SQLConsulta=" where tienda='$almacen' ".$filtroCod."  and cod_vendedor like '%$vendedor%'
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
$SQLConsulta and fecha between '".$inifec[2]."-".$inifec[1]."-".$inifec[0]."' and '".$finfec[2]."-".$finfec[1]."-".$finfec[0]."'
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
// documentos anulados rojo
$AnRK='';	
$sql="select * from cab_mov 
where cod_cab  ='".$row['cod_cab']."' ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX['flag']=='A'){
		$color_row='#FF0000';
		$AnRK='2';
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
$sql="select *  from cab_mov where cod_cab='".$row['cod_cab']."'  and condicion='2'
 and flag <>'A'
LIMIT 0, 1  ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
		$color_row='#FFDFF4';
		$AnRK='3';
}						 					
 //documentos Terminado
$sql="select * from cab_mov where cod_cab='".$row['cod_cab']."'  and cod_ope ='SM' and flag<>'A'
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
		$est="A";
		//$AnRK='3';
	}
}	
?>
			
  <tr  onClick="entrada(this)" ondblclick="doc_det(this)"  >

             <td width="89" class="texto1" align="center"><?php echo substr($row['fecha'],0,10)?></td>	
			  <td width="105" class="texto1" ><?php echo $row['serie'].'-'.$row['Num_doc']; ?></td>	
              <td width="213" class="texto1"><?php 
			 $resultados11 = mysql_query("select * from usuarios where codigo='".$row['cod_vendedor']."' ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			echo $row11['usuario'];			
			}
			  //echo $row['cod_vendedor'];
			?></td>
              <td width="70" align="right" class="texto1"><?php 
			//echo $row['cod_cab'];
			$resultados11 = mysql_query("select * from det_mov where cod_cab='".$row['cod_cab']."' ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			echo  $row11['cantidad'];						
			}
			  ?></td>
			  <td width="101" align="center" class="texto1"><?php 
		   $resultados11 = mysql_query("select * from referencia where cod_cab_ref='".$row['cod_cab']."' ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			$codOT= $row11['cod_cab'];	
					
			}
			$resultados11 = mysql_query("select * from cab_mov where cod_cab='".$codOT."' ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			 echo $row11['serie'].'-'.$row11['Num_doc']; 
			}
			
			  
			  ?></td>	
			  <td width="50" align="center" class="texto1"><?php  if ($row['archivo']<>''){ echo 'X';}?></td>
			  <td width="46" align="center" class="texto1"><?php if ($row['obs1']<>''){ echo '-|-'; }; ?></td>	
			  <td width="26" align="center" class="texto1"><?php echo $est ?></td>	 
  </tr>
  
  <?php }?>
</table>
</body>
</html>

