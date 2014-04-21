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
<table width="800" height="24" border="0" cellpadding="1" cellspacing="1" id="lista_productos">
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
			//$cliente=$_REQUEST['cliente'];
			//$ruc=$_REQUEST['ruc'];
			//$vendedor=$_REQUEST['vendedor'];
			//$docref=$_REQUEST['docref'];
			$fec1=$_REQUEST['fec1'];
			$fec2=$_REQUEST['fec2'];
			if(isset($_REQUEST['tipo']))
			$tipo=$_REQUEST['tipo'];
			//$mosdocFac=$_REQUEST['mosdocFac'];
			//$mosdocAnu=$_REQUEST['mosdocAnu'];
			$Estado=$_REQUEST['estado'];
			$cmbmoneda=$_REQUEST['moneda'];
			$cmbcuenta=$_REQUEST['cuenta'];
			$formaOrder=$_REQUEST['formaOrder'];
			$campoOrder=$_REQUEST['campoOrder'];
			$filtroOrden="";

		if($campoOrder!="" && $formaOrder!=""){
			$filtroOrden=" order by  ".$campoOrder." ".$formaOrder; 
		}else{		
			if($_REQUEST['ordenar']!=""){
			 	//$filtro2=" order by ".$_REQUEST['ordenar']. " ".$_REQUEST['orden']; 	
				$filtroOrden=" order by ".$_REQUEST['ordenar']. " ".$_REQUEST['orden']; 	
			}else{
				//$filtro2=" order by fecha desc "; 	
				$filtroOrden=" order by tipo asc,numero asc ,fechavenc desc "; 	
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
			$SQLEstado =" and multi_id in('".$cda."') ";
		  }elseif (trim($Estado)=='B'){
		  	//$SQLEstado =" and flag_r <>'' ";
			$SQLEstado =" and banco_id <> 0 ";
		  }else{			
			//$SQLEstado =$Estado;
			 $SQLEstado =" and estado='A' ";
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
	$Cmoneda=" and moneda='".$cmbmoneda."' ";
}

$Ccuenta='';
if ($cmbcuenta=='T'){
	$Ccuenta='';
}else{
	$Ccuenta=" and cuenta='".$cmbcuenta."' ";
}

if ($Estado<>''){

$filtroEstado=" and estado='".$Estado."' ";

}

if($_REQUEST['nroCheque']!=''){

$filtroNroCheque=" and CM.numero='".$_REQUEST['nroCheque']."' ";

}

if($_REQUEST['serieDoc']!='' && $_REQUEST['numeroDoc']!=''){

$filtroNroDoc=" and p.numero='".$_REQUEST['numeroDoc']."' and p.serie='".$_REQUEST['serieDoc']."' ";

}
 
/* $SQLConsulta=" where $almacen1
 and cod_ope='$docref'
 and cod_vendedor like '%$vendedor%'
 and C.razonsocial like '%$cliente%'	
 and C.ruc like '%$ruc%'
 and substring(fecha,1,10) between '".formatofecha($fec1)."' and '".formatofecha($fec2)."'
 $SQLMosDoc $SQLEstado $Cmoneda";*/
 if($Estado!="P"){
 
 	if(isset($_REQUEST['fec2'])){
	 $SQLConsulta=" and sucursal='$sucursal'
 and substring(fechavenc,1,10) between '".formatofecha($fec1)."' and '".formatofecha($_REQUEST['fec2'])."'".$Ccuenta;
	}else{
	$SQLConsulta=" and sucursal='$sucursal'
 and substring(fechavenc,1,10) = '".formatofecha($fec1)."'".$SQLEstado.$Cmoneda;
	}
 
 }else{
	 $SQLConsulta=" and sucursal=$sucursal$SQLEstado$Cmoneda$Ccuenta";
 }
 
 $SQLConsulta=$SQLConsulta.$filtroEstado.$filtroNroCheque.$filtroNroDoc;

$AnRK="";
/*
$resultados = mysql_query("select CM.*,C.* from progpagos CM
inner join cliente C on CM.proveedor =C.codcliente 
inner join progpagos_det p on p.id_progpagos=CM.id 	
$SQLConsulta order by id" ,$cn);
*/

$resultados = mysql_query("select CM.*,C.* from progpagos CM,cliente C,progpagos_det p where CM.proveedor =C.codcliente and p.id_progpagos=CM.id and CM.proveedor =C.codcliente $SQLConsulta group by CM.id order by fechavenc " ,$cn);


$total_registros = mysql_num_rows($resultados); 
			
$strSQL="select CM.*,C.* from progpagos CM,cliente C,progpagos_det p where CM.proveedor =C.codcliente and p.id_progpagos=CM.id and CM.proveedor =C.codcliente $SQLConsulta group by CM.id $filtroOrden 
LIMIT $inicio, $registros";
		
	//echo $strSQL;
						
			$j=0;
			$resultado=mysql_query($strSQL,$cn);
			

	$resultados2 =mysql_num_rows($resultado); 
	$total_paginas = ceil($total_registros / $registros); 
			
			while($row=mysql_fetch_array($resultado)){
						 
			 	$j++;
				if($j%2==0){
				//$color_row='#E9F3FE';//'#FFFFFF';
				}else{
				
				}
				$color_row='#FFFFFF';	
// documentos anulados rojo
/*$AnRK='';	
$sql="select * from cab_mov 
where cod_cab  ='".$row['cod_cab']."' ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){*/
	switch($row['estado']){
		case 'A':$color_row='#FF7979';$AnRK='2';break;
		case 'T':$color_row='#79AEFF';$AnRK='2';break;
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
	echo "1";
		//$color_row='#D7FFF0';
		//$AnRK='3';
	}
//}
			 					
 //documentos facturado o canjeado
/*$sql="select * from referencia where cod_cab_ref='".$row['cod_cab']."'  
LIMIT 0, 1  "; // and flag_r='RO' 
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){*/
	//if ($rowX['flag_r']=='RO' || $rowX['flag_r']=='RORA'){
				 					
?>
			
<tr bgcolor="<?php echo $color_row?>" onClick="entrada(this);" >
	<td width="31" align="center" ><input style="border: 0px; background:none; " type="radio" name="XDato" value="<?php  echo $row['id']?>" /><b><?=$j;?></b>
	<input name="estado" id="estado" type="text"  style="display:none"  value="<?php  echo $row['estado']?>"/>
	</td>
	<?php /*?><td width="22" align="center" class="texto1" >	  
	<? //if ($AnRK<>'3'){ ?>
	<input style="border: 0px; background:none; " type="checkbox" name="xcodigo" value="<?=$row['cliente'];?><?=$row['multi_id'];?>" onclick="Anular('S')" />
	<? //} ?></td><?php */?>
	
	<?php 
	
	    $resultados11 = mysql_query("select * from cuentas, bancos where cta_id='".$row['cuenta']."' and banco_id = id",$cn); 		$rowSM=mysql_fetch_array($resultados11);
		if($rowSM['moneda']=='01') $simMon="S/." ;else $simMon="US$";
	
	?>
	<td width="56" class="texto1" align="center" title="<?php echo $rowSM['cta_id']."&nbsp;&nbsp;&nbsp;".$rowSM['descrip']."&nbsp;&nbsp;&nbsp;".$rowSM['ctabco']."&nbsp;&nbsp;&nbsp;".$simMon; ?>" style="text-decoration:underline"><?php
	
		
		//echo "select * from cuentas, bancos where cta_id='".$row['cuenta']."',banco_id = id";
			
		 echo $rowSM['cta_id'];
	 
	 ?></td>
	<td width="76" align="center" class="texto1" ><?php   if($rowSM['moneda']=='01') echo "S/." ;else echo "US$";  ?></td>
	<td width="63" align="center" bgcolor="<?php echo $color_row?>" class="texto1">&nbsp;<?php 
	
	list($des_tipo,$cod_tipo)=mysql_fetch_row(mysql_query("select descripcion,codigo from t_pago where id='".$row['tipo']."'"));
	echo $cod_tipo; 
	
	?></td>			   
	<td width="53" class="texto1"><?php echo $row['numero']; ?></td>
	<td width="130" align="left" class="texto1"><?  
		echo $row['razonsocial'];
		
	?></td>
	<td width="73" align="right" class="texto1"><?php echo extraefecha($row['fechavenc']) ?></td>
	<td width="50" align="right" class="texto1"><?php 
		echo $row['tc'];
	?></td>
	<td width="94" align="right" class="texto1"><?php echo number_format($row['importe'],2);?></td>
	<td width="105" align="center" class="texto1">&nbsp;<?php echo $row['observaciones']; ?></td>
	<td width="21" align="center" class="texto1">
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