<?
//Borrar Sesion multifactura
session_start();

include('../conex_inicial.php');
include('../funciones/funciones.php');
		
unset($_SESSION['Multifactura']);
//PAGINACION 1	
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
<div id="detalle" style="width:800px; height:175px; overflow:auto" >
<table width="800" height="24" border="0" cellpadding="0" cellspacing="0" id="lista_productos">
  <?php 
		
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
			
			$sucursal=$_REQUEST['sucursal'];
			//$almacen=$_REQUEST['almacen'];
			if(isset($_REQUEST['cliente']))
			$cliente=$_REQUEST['cliente'];
			if(isset($_REQUEST['ruc'])){
			$ruc=$_REQUEST['ruc'];
			}
			//$vendedor=$_REQUEST['vendedor'];
			//$docref=$_REQUEST['docref'];
			$fec1=$_REQUEST['fec1'];
			$fec2=$_REQUEST['fec2'];
			//if(isset($_REQUEST['tipo']))
			$tipo=$_REQUEST['tipo'];
			//$mosdocFac=$_REQUEST['mosdocFac'];
			//$mosdocAnu=$_REQUEST['mosdocAnu'];
			$Estado=$_REQUEST['estado'];
			$cmbmoneda=$_REQUEST['moneda'];
			$formaOrder=$_REQUEST['formaOrder'];
			$campoOrder=$_REQUEST['campoOrder'];
			$filtroOrden="";
			
			$cliente=$_REQUEST['cliente'];
			$filtrocli="";
			if($cliente!="" && $cliente!="T" ){
				$filtrocli=" and cm.cliente='".$_REQUEST['cliente']."'";
			}
			
		if($campoOrder!="" && $formaOrder!=""){
			$filtroOrden=" order by  ".$campoOrder." ".$formaOrder; 
		}else{		
			if($_REQUEST['ordenar']!=""){
			 	$filtro2=" order by ".$_REQUEST['ordenar']. " ".$_REQUEST['orden']; 	
			}else{
				$filtro2=" order by fecha desc "; 	
			}
		}
			
		/*if ($almacen=='0'){	
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
}*/

if ($Estado<>''){
		  if (trim($Estado)=='T'){
			 $SQLEstado ="";
		  }elseif (trim($Estado)=='P'){
			  $sql_ex=mysql_query("Select multi_id from multi_det where det_id in(Select refer_letra from pagos where fecha between '".formatofecha($fec1)."' and '".formatofecha($fec2)."' and refer_letra!='')",$cn);
			  $cda="";
			  $cdn=0;
			  while($rw_ex=mysql_fetch_array($sql_ex)){
				  if($cdn==0){
					  $cda=$rw_ex[0];
				  }else{
					  $cda=$rw_ex[0]."','".$cda;
				  }
				  $cdn=1;
			  }
			  //echo $cda;
			//$SQLEstado =" and flag_r <>'RA' and flag<>'A' and estadoOT<>'O' and estadoOT<>'T' "; 
			//$SQLEstado =" and flag_r ='' and flag<>'A' ";
			$SQLEstado =" and dm.multi_id in('".$cda."') ";
		  }elseif (trim($Estado)=='B'){
		  	//$SQLEstado =" and flag_r <>'' ";
			$SQLEstado =" and dm.banco_id <> 0 ";
		  }else{			
			//$SQLEstado =$Estado;
			 $SQLEstado =" and cm.estado='A' ";
		  }	
 }else{
	//$SQLEstado =" and flag_r <>'RA' and flag<>'A' and estadoOT<>'O' and estadoOT<>'T' ";
	//$SQLEstado =" and flag_r =''  and flag<>'A' ";	  
	$SQLEstado ="";
 }
  
//echo $SQLEstado; 
  
if ($cmbmoneda=='T'){
	$Cmoneda='';
}else{
	$Cmoneda=" and cm.moneda='".$cmbmoneda."' ";
}
 
/* $SQLConsulta=" where $almacen1
 and cod_ope='$docref'
 and cod_vendedor like '%$vendedor%'
 and C.razonsocial like '%$cliente%'	
 and C.ruc like '%$ruc%'
 and substring(fecha,1,10) between '".formatofecha($fec1)."' and '".formatofecha($fec2)."'
 $SQLMosDoc $SQLEstado $Cmoneda";*/
 
 /*if($Estado!="P"){
 $SQLConsulta=" where cod_suc=$sucursal and tipo='$tipo'
 and substring(fechavcto,1,10) between '".formatofecha($fec1)."' and '".formatofecha($fec2)."'".$SQLEstado.$Cmoneda;
 }else{
	 $SQLConsulta=" where cod_suc='$sucursal' and tipo='$tipo'$SQLEstado$Cmoneda";
 }*/
 
 $SQLConsulta=" where ";
 if($sucursal!="T"){
	 $SQLConsulta.="cod_suc='".$sucursal."'";
 }
 if($Estado!="P"){
	 if($sucursal!="T"){
		$SQLConsulta.=" and";
	 }
 	$SQLConsulta.=" tipo='$tipo' and substring(fechavcto,1,10) between '".formatofecha($fec1)."' and '".formatofecha($fec2)."'".$SQLEstado.$Cmoneda.$filtrocli;
 }else{
	 if($sucursal!="T"){
		$SQLConsulta.=" and";
	 }
	 $SQLConsulta.=" tipo='$tipo'$SQLEstado$Cmoneda$filtrocli";
 }

$AnRK="";

$resultados = mysql_query("SELECT CM.cliente as cliente, CM.fecha AS fec_emi,dm.* FROM multi_det dm INNER JOIN multicj CM ON dm.multi_id=CM.multi_id INNER JOIN cliente C ON CM.cliente =C.codcliente 
$SQLConsulta order by dm.det_id" ,$cn);
/*echo "SELECT CM.cliente as cliente, CM.fecha AS fec_emi,dm.* FROM multi_det dm INNER JOIN multicj CM ON dm.multi_id=CM.multi_id INNER JOIN cliente C ON CM.cliente =C.codcliente 
$SQLConsulta order by dm.det_id";*/
$total_registros = mysql_num_rows($resultados); 
			
$strSQL="SELECT cm.*,cm.cliente as cliente,dm.banco_id as banco,dm.letra as num_let, dm.numbco as num_banco,cm.fecha AS fec_emi,dm.det_id as det_id,dm.cod_letra as cod_letra,dm.letra as letra,dm.monto as monto,dm.saldo as saldo,dm.dias as dias,dm.fechavcto as fechavcto,dm.estado as estado,dm.banco_id as banco_id,c.razonsocial as razonsocial FROM multi_det dm INNER JOIN multicj cm ON dm.multi_id=cm.multi_id INNER JOIN cliente c ON cm.cliente =c.codcliente 	
$SQLConsulta  $filtroOrden 
LIMIT $inicio, $registros";
		
	//echo $strSQL;
						
			$j=0;
			$resultado=mysql_query($strSQL,$cn);
			

	$resultados2 =mysql_num_rows($resultado); 
	$total_paginas = ceil($total_registros / $registros); 
			
			while($row=mysql_fetch_array($resultado)){
						 
			 	$j++;
				if($j%2==0){
				$color_row='#E9F3FE';//'#FFFFFF';
				}else{
				$color_row='#FFFFFF';
				}	
// documentos anulados rojo
/*$AnRK='';	
$sql="select * from cab_mov 
where cod_cab  ='".$row['cod_cab']."' ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){*/
	switch($row['estado']){
		case 'A':$color_row='#FF0000';$AnRK='2';
	}
//}	
// documentos con serie (anulara y desanular no permite)
$sql="select count(pa.id) from pagos pa 
inner join multi_det md on 
md.det_id=pa.refer_letra 
inner join multicj mc on
mc.multi_id=md.multi_id
where mc.estado <> 'A'
and mc.multi_id='".$row['multi_id']."'
and mc.cod_suc='$sucursal' ";
$resultadoX=mysql_query($sql,$cn);
$rowX=mysql_fetch_array($resultadoX);
//while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX[0]>0){
		$color_row='#D7FFF0';
		//$AnRK='3';
	}
//}
			 					
 //documentos facturado o canjeado
/*$sql="select * from referencia where cod_cab_ref='".$row['cod_cab']."'  
LIMIT 0, 1  "; // and flag_r='RO' 
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){*/
	//if ($rowX['flag_r']=='RO' || $rowX['flag_r']=='RORA'){
if($row['banco_id']<>"0"){		
		$color_row='#0066FF';
		$AnRK='3';
	//}
}					 					
?>
			
<tr bgcolor="<?php echo $color_row?>" onClick="entrada(this);" ondblclick="doc_det(this)" >
	<td width="33" align="center" ><input style="border: 0px; background:none; " type="radio" name="XDato" value="<?php  echo $row['det_id']?>" /><b><?=$j;?></b></td>
	<td width="23" align="center" class="texto1" >	  
	<? //if ($AnRK<>'3'){ ?>
	<input style="border: 0px; background:none; " type="checkbox" name="xcodigo" value="<?=$row['cliente'];?><?=$row['det_id'];?>" onclick="Anular('S')" />
	<? //} ?></td>
	<td width="69" class="texto1" align="center" ><?php echo extraefecha($row['fec_emi']);?></td>
    <td width="69" class="texto1" align="center" ><?php echo extraefecha($row['fechavcto']);?></td>
	<td width="85" class="texto1" >
	<?php 
	
	switch($row['estado']){
		case 'A': echo "Anulada";break;
		case 'P': echo "Protestada";break;
	}
	if($row['estado']=='' && $row['banco']!="0"){
		echo "en Banco";	
	}else{
		if($row['estado']==''){
			echo "Cartera";
		}
	}?></td>
	<td width="81" class="texto1"><?php echo $row['num_let']; ?></td>			   
	<td width="118" class="texto1"><?php echo substr(caracteres($row['razonsocial']),0,27); ?></td>
	<td width="24" align="center" class="texto1"><?  
		if($moneda==''){
			if ($row['moneda']=='02'){
				echo 'US$.';
			}else{
				echo 'S/.';
			}
		}else{
			if ($row['moneda']=='02'){
				echo 'US$.';
			}else{
				echo 'S/.';
			}
		}
	?></td>
	<td width="72" align="right" class="texto1"><?php echo number_format($row['importe'],2)?></td>
	<td width="76" align="right" class="texto1"><?php if($row['num_banco']!=""){echo $row['num_banco'];}else{echo $row['numcje'];}?></td>
	<td width="100" align="right" class="texto1"><?php
	$sql_doc=mysql_query("Select * from multi_doc where multi_id='".$row['multi_id']."'",$cn);
	 //echo $row['canlet'];
	 echo mysql_num_rows($sql_doc);?></td>
	<td width="119" align="center" class="texto1"><?php 
		$sql2=mysql_query("Select * from bancos where id='".$row['banco_id']."'",$cn);
		$rw_b=mysql_fetch_array($sql2);
		echo $rw_b['descrip'];
		/*$strSQLSM="select * from referencia where cod_cab_ref='".$row['cod_cab']."' order by id desc ";
	$resultadoMS=mysql_query($strSQLSM,$cn);
	//$rowSM=mysql_fetch_array($resultadoMS);
	//echo $sucursal=$rowSM['serie'].'-'.$rowSM['correlativo'];
	while($rowSM=mysql_fetch_array($resultadoMS)){
	$codRefec=$rowSM['cod_cab'].',';
	//echo $codRefec;
		$strSQL2="select * from cab_mov where cod_cab in (".$codRefec."0) ";
		$resultado2=mysql_query($strSQL2,$cn);
		//$rowR=mysql_fetch_array($resultadoMS);   	
		while($rowR=mysql_fetch_array($resultado2)){
			if ($rowR['cod_cab']<>''){
				}echo $rowR['cod_ope'].'-'.$rowR['serie'].'-'.$rowR['Num_doc'].' | ';	
			
		}
	
	}*/
		
	?></td>
	<td width="33" align="center" class="texto1">
	<?php
		if ($row['archivo']<>''){
			echo '<a href="'.$row['archivo'].'" target="_blank"><img src="../imagenes/archivo.png" width="15" height="15" border="0" border="0"></a>';
		}
	?></td>		 
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
</table><br>