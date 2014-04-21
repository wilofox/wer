<?php
		include('../conex_inicial.php');
		include('../funciones/funciones.php');
if($_REQUEST['tip']=="imp"){

$mostrar="onload=javascript:window.print()";

}
list($n_tienda)=mysql_fetch_array(mysql_query("select des_tienda from tienda  where cod_tienda='".$_REQUEST['almacen']."'"));	
?>
<html>
<head>
<style type="text/css">
<!--
.Estilo1 {	font-size: 24px;
	font-weight: bold;
}
.Estilo101 {color: #FFFFFF}
-->
</style>
</head>
<body <?php echo $mostrar ?> >
<table width="905" border="0">
  <tr>
    <td  align="center"></td>
    <td colspan="11" align="center"><span class="Estilo1">Reporte Seguimiento T.S. </span></td>
  </tr>
  <tr>
    <td  align="center"></td>
    <td width="315" colspan="4"><strong>Tienda: <?php echo $n_tienda ?></strong></td>
    <td width="405" colspan="7"><strong>Doc. de Ref. :
      <?php 
	switch($_REQUEST['docref']){
case "1":
echo "Salidas";
break;
case "2":
echo "Ingresos;";
break;

default:
echo "Todo";
break;

}

	 ?>
    </strong></td>
  </tr>
  <tr>
    <td  align="center"></td>
    <td colspan="11"><strong>Fecha: De <?php echo $_REQUEST['fec1'] ?> al <?php echo $_REQUEST['fec2'] ?></strong></td>
  </tr>
  <tr>
    <td  align="center"></td>
    <td colspan="11">&nbsp;</td>
  </tr>
</table>

<table width="953" border="0" cellpadding="0" cellspacing="1">
        <tr bgcolor="#CCCCCC">
          <td  style=" border:#CCCCCC solid 1px" width="42" height="21" align="center" ><span class="texto2"><strong>Num.</strong></span></td>

          <td  style=" border:#CCCCCC solid 1px" width="183" align="center"><span class="texto2"><strong>Fecha | Hora</strong></span></td>

          <td width="209" align="center"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>N&uacute;mero</strong></span></td>
          <td width="124" align="center"  style=" border:#CCCCCC solid 1px" ><strong class="texto2">Tienda Origen</strong></td>
          <td width="129" align="center"  style=" border:#CCCCCC solid 1px"><span class="texto2"><strong>Tienda Destino </strong></span></td>
          <td width="53" align="center"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Item</strong></span></td>
          <td width="71" align="center"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Unidad</strong></span></td>
          <td width="115" align="center"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Responsable</strong></span></td>
		 <td align="center"   style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Est.</strong></span></td>
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

		if ($almacen=='0'){	
			$strSQL22="select * from tienda order by cod_tienda";
			$resultado22=mysql_query($strSQL22,$cn);
			while($row22=mysql_fetch_array($resultado22)){
			//echo  $saldos[]=",'".$row22['cod_tienda'].'';
			 $tiendas=$tiendas.$row22['cod_tienda'].",";
			}
		$tiendas2=substr($tiendas,0,strlen($tiendas)-1);
		$almacen  =' tienda in('.$tiendas2.') ';
		
		}else{
		$almacen = " tienda='$almacen' ";
		}	

		 
		  
  if($docref!="0"){
   $filtroCod =" and cod_ope='TS' and  tipo='$docref' ";
  }else{
  // $filtroCod =" and (cod_ope='RM' or cod_ope='SM') ";
   $filtroCod =" and cod_ope='TS' and tipo in ('1','2')  ";
  } 
  
 $SQLConsulta=" where $almacen 
 $filtroCod  $SQLMosDoc  
 and substring(fecha,1,10) between '".formatofecha($fec1)."' and '".formatofecha($fec2)."' 
and cod_vendedor like '%$vendedor%' 
and kardex='S' and deuda='N' 
  ";

//

//CM inner join cliente C on CM.cliente =C.codcliente 
//
$resultados = mysql_query("select * from cab_mov  
$SQLConsulta
ORDER BY cab_mov.fecha DESC " ,$cn);
$total_registros = mysql_num_rows($resultados); 
			
$strSQL="select * from cab_mov 
$SQLConsulta	
ORDER BY cab_mov.fecha DESC 
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
	
 //documentos Terminado
$sql="select * from cab_mov where cod_cab='".$row['cod_cab']."'  and cod_ope ='TS' and flag<>'A'
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
		$est="A";
	}
}	
?>
			
  <tr onClick="entrada(this)" onDblClick="doc_det(this)"  >
      <td width="42" align="center">
    <span class="texto2" style="font-size:11px;"><b><? echo $j ?></b></span></td>

      <td width="183" align="center" class="texto1" ><?php echo $row['fecha']?></td>
             <td width="209" class="texto1"><?php echo $row['serie'].'-'.$row['Num_doc']; ?></td>	
			  <td width="124" class="texto1" ><?php						
				/*if ($row['tipo']==1){
					$CodTienda=$row['tienda'];
				}else{
					$strCli="select * from cab_mov where serie='".$row['serie']."' and Num_doc='".$row['Num_doc']."' ";
				$resultadoCli=mysql_query($strCli,$cn);
				$rowCL=mysql_fetch_array($resultadoCli);
					$CodTienda=$rowCL['tienda']; 
				}*/
				//echo $CodTienda;
				$strCli="select * from tienda where cod_tienda='".$row['tienda']."' ";
				$resultadoCli=mysql_query($strCli,$cn);
				$rowCL=mysql_fetch_array($resultadoCli);
				echo $rowCL['des_tienda']; 
				?></td>	
              <td width="129" class="texto1"><?php 
			  	if ($row['tipo']==1){
					$TipoN=2;
				}else{
					$TipoN=1;
				}
				
			  $strCli="select * from cab_mov where serie='".$row['serie']."' and Num_doc='".$row['Num_doc']."'   and tipo='".$TipoN."' ";
				$resultadoCli=mysql_query($strCli,$cn);
				$rowCL=mysql_fetch_array($resultadoCli);
			//	echo $rowCL['cod_cab']; 
				
				$strCli="select * from tienda where cod_tienda='".$rowCL['tienda']."' ";
				$resultadoCli=mysql_query($strCli,$cn);
				$rowCL=mysql_fetch_array($resultadoCli);
				echo $rowCL['des_tienda']; 	
			  
			/*  if ($row['tipo']==2){
					$CodTienda=$row['tienda'];
					//echo 11;
				}else{
				//echo 22;
					$strCli="select * from cab_mov where serie='".$row['serie']."' and Num_doc='".$row['Num_doc']."'  ";
				$resultadoCli=mysql_query($strCli,$cn);
				$rowCL=mysql_fetch_array($resultadoCli);
					$CodTienda=$rowCL['tienda']; 
				}
				echo $CodTienda;
				
				$strCli="select * from tienda where cod_tienda='$CodTienda' ";
				$resultadoCli=mysql_query($strCli,$cn);
				$rowCL=mysql_fetch_array($resultadoCli);
				echo $rowCL['des_tienda']; 
			  */
			  
			  ?></td>
              <td width="53"  class="texto1"><?php 
			$resultados11 = mysql_query("select count(*) as item from det_mov where cod_cab='".$row['cod_cab']."' ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			echo  $row11['item'];						
			}
			  ?></td>
			  <td width="71" class="texto1"><?php 
			  $resultados11 = mysql_query("select Sum(cantidad) as cantidad from det_mov where cod_cab='".$row['cod_cab']."' ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			echo  $row11['cantidad'];						
			}
			  ?></td>	
			  <td width="115" class="texto1"><?php 
			 $resultados11 = mysql_query("select * from usuarios where codigo='".$row['cod_vendedor']."' ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			echo $row11['usuario'];			
			}
			  //echo $row['cod_vendedor'];
			?></td>
			<td align="center"><?php echo $est ?></td>
  </tr>
  
  <?php }?>
</table>
</body>
</html>
