<?
		//Borrar Sesion multifactura
		session_start();
		include('../conex_inicial.php');
		include('../funciones/funciones.php');
		
		unset($_SESSION['Multifactura']);
?>
<style type="text/css">
<!--
.Estilo100 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
-->
</style>
<div id="detalle" style="width:800px; height:170px; overflow:auto" >
<table width="800" height="24" border="0" cellpadding="0" cellspacing="0" id="lista_productos">
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
			
  <tr bgcolor="<?php echo $color_row?>" onClick="entrada(this)" ondblclick="doc_det(this)"  >
      <td width="27" align="center" class="texto1"><input style="border: 0px; background:none; " type="radio" name="XDato" value="<?php  echo $row['cod_cab']?>" /><b><?=$j;?></b></td>
      <td width="22" align="center" class="texto1" >  
	   <? if ($AnRK<>'3'){ ?>
	   <input style="border: 0px; background:none; " type="checkbox" name="xcodigo" value="<?=$row['cliente'];?><?=$row['cod_cab'];?>" onclick="Anular('S<?=$AnRK;?>')" />
	  <? } ?>	  </td>
              <td width="124" class="texto1" align="center" ><?php echo $row['fecha']?></td>
              <td width="92" class="texto1" ><?php echo $row['cod_ope'].'-'.$row['serie'].'-'.$row['Num_doc']; ?></td>
              <td width="181" class="texto1"><?php echo substr(caracteres($row['razonsocial']),0,27); ?></td>			   
              <td width="61" class="texto1"><?php 
			  $sqlK="select count( * ) as items from det_mov 
			  where cod_cab='".$row['cod_cab']."' group by cod_cab ";
			  $resultados11 = mysql_query($sqlK,$cn); 
			  $rowSM=mysql_fetch_array($resultados11);
			  echo $rowSM['items'];
			  ?></td>
              <td width="17" align="center" class="texto1"><?  
			  if($moneda==''){
			  if ($row['moneda']=='02'){echo 'US$.';}else{echo 'S/.';}
			  }else{
			  if ($row['monedaSD']=='02'){echo 'US$.';}else{echo 'S/.';}
			  }
			   ?></td>
              <td width="63" align="right" class="texto1"><?php 
			  //-$row['total'];
			  //if ($row['deuda']=='S'){
			  if ($row['saldo']>0){
				  echo $row['saldo'];
			  }else{
			  	echo $row['total'];
			  }
			  ?></td>
			  <td width="89" align="right" class="texto1"><?php
			  //$row['pc']; 
			$resultados11 = mysql_query("select * from usuarios where codigo='".$row['cod_vendedor']."' ",$cn); 
			$rowSM=mysql_fetch_array($resultados11);
			  echo $rowSM['usuario'];
				?></td>
			  <td width="93" align="center" class="texto1"><?php 
				 if ($row['archivo']<>''){
			   		echo  '<a href="'.$row['archivo'].'"><img src="../imgenes/archivo.jpg"  width="16" height="16" border="0"></a>';
				 }
		
			   ?></td>			 
			   <td width="31" align="center" class="texto1" style="visibility:hidden">
			   <?
			   if ($row['archivo']<>''){
			   	//echo  '<a href="'.$row['archivo'].'"><img src="../imgenes/archivo.jpg"  width="16" height="16" border="0"></a>';
			   }
			   ?>
			   </td>
    </tr>
  
  <?php }?>
</table>
</div>
		  
	<table width="100%" height="21" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="311" height="21" align="left" valign="bottom" style="color:#999999"><span class="Estilo29">Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (de <strong><?php echo $total_registros?></strong> productos)</span>.</td>
    <td width="526" align="right" valign="bottom" style="color:#999999"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:13px">
      <?php 
			  
 if(($pagina - 1) > 0) { 
echo "<a style='cursor:pointer' onclick='cargardatos($pagina-1)'>< Anterior </a> "; 
} 

for ($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
	echo "<b style='color:#000000'>".$pagina."</b> "; 
	} else { 
	echo "<a style='cursor:pointer' href='#' onclick='cargardatos($i)'>$i</a> "; 
	}
}
if(($pagina + 1)<=$total_paginas) { 
echo " <a style='cursor:pointer' onclick='cargardatos($pagina+1)'>Siguiente ></a>"; 
} 
    ?>
	 &nbsp;&nbsp;</font> 
	 <input type="hidden" name="pag" id="pag" value="<?php echo $pagina?>" />
	</td>
  </tr>
</table>