<?
		//Borrar Sesion multifactura
		session_start();
		include('../conex_inicial.php');
		include('../funciones/funciones.php');
		
		unset($_SESSION['Multifactura']);
?><div id="detalle" style="width:800px; height:170px; overflow:auto" >
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
			
			$tipoMov=$_REQUEST['tipoMov'];
						
			$serie=$_REQUEST['serie'];
			$numero=$_REQUEST['numero'];
			
			if($serie!='' || $numero!=''){
			$filtroNumDoc= " and serie like '%$serie%' and Num_doc like '%$numero%' "; 			
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
			
	
		if ($almacen=='0'){	
			$strSQL22="select * from tienda order by cod_tienda";
			$resultado22=mysql_query($strSQL22,$cn);
			while($row22=mysql_fetch_array($resultado22)){
			 $tiendas=$tiendas."'".$row22['cod_tienda']."',";
			}
		$tiendas2=substr($tiendas,0,strlen($tiendas)-1);
		$almacen1  =' tienda in('.$tiendas2.') ';		
		}else{
		$almacen1 = " tienda='$almacen' ";
		}	

if ($Estado<>''){
		  if (trim($Estado)=='T'){
			 $SQLEstado ="";
		  }elseif (trim($Estado)=='P'){
		  	$SQLEstado =" and flag<>'A' and estadoOT='P' "; //and CM.condicion<>1	
		  }elseif (trim($Estado)=='A'){
			$SQLEstado ="  and flag<>'A' and estadoOT='A' ";	// and CM.condicion<>1
		  }elseif (trim($Estado)=='AN'){
		    $SQLEstado ="  and flag='A'  ";	//and CM.condicion<>1and CM.condicion<>2 
		  }else{
		  			
			//$SQLEstado =" and flag='A' ";
		  }	
 }else{
 
 	$SQLEstado ="  and flag<>'A' ";	 
//	$SQLEstado ="  and saldo>0  and flag<>'A' and CM.condicion<>1 ";	 
 }
  
//echo $SQLEstado; 
  
if ($cmbmoneda==''){
	$Cmoneda='';
}else{
	$Cmoneda=" and moneda='".$cmbmoneda."' ";
}
if ($docref=='0'){
	//$CodDoc=" and cod_ope in('NV','TB','TF')  ";
	//$CodDoc=" and cod_ope in('NV','TB','TF','FA','BV')  ";
	$CodDoc=" and cod_ope in('B0','F0')  ";
}else{
	$CodDoc=" and cod_ope='$docref' ";
}
 
 //and cod_ope='$docref'
 $SQLConsulta=" where $almacen1
 $CodDoc
 and cod_vendedor like '%$vendedor%'
 and C.razonsocial like '%$cliente%'	
 and C.ruc like '%$ruc%'
 and substring(fecha,1,10) between '".formatofecha($fec1)."' and '".formatofecha($fec2)."' and tipo='".$tipoMov."' and modulo='2' $SQLMosDoc  $Cmoneda  $SQLEstado $filtroNumDoc  "; //

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
/*
$sql="select * from cab_mov 
where cod_cab  ='".$row['cod_cab']."' ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX['flag']=='A'){
		$color_row='#FF7979';
		$AnRK='3';
	}
	else if ($rowX['cod_ope']=='TF' || $rowX['cod_ope']=='FA'){		
		$color_row='#DDDDDD';
		//$AnRK='3';
	}
	else if ($rowX['saldo']=='0' && $rowX['cod_ope']!='TN'){
		$color_row='#59ACFF';
		$AnRK='3';
	}
	else if ($rowX['saldo']>0 &&  $rowX['saldo']<>$rowX['total'] ){ //$rowX['saldo']==$rowX['total'] 
		$color_row='#CBFD99';
		//$AnRK='3';
	}
}
	*/
	//$color_row="#FFFFFF";
	$estCheck=' ';
	
	if($row['estadoOT']=='P'){
	$color_row='#FFFFFF';		
	}
	if($row['estadoOT']=='A'){
	$color_row='#CBFD99';
	
		if($tipoMov=='1')$estCheck=' disabled ';
	
	}
	
	if($row['flag']=='A'){
	$color_row='#FF7D81';	
	$estCheck=' disabled ';
	}
	
			 					
if (trim($Estado)=='T'){
	 //$AnRK='3';
}
?>
			
  <tr bgcolor="<?php echo $color_row?>" onClick="entrada(this,'<?php echo $estCheck; ?>'); " >
      <td width="28" align="center" class="texto1" height="20px">
	  
	  <b><?=$j;?>
	  </b></td>
	  
      <td width="23" align="center" class="texto1" >  
	  
	 
	  <input <?php echo $estCheck; ?> style="border: 0px; background:none; " type="radio" name="XDato" value="<?php  echo $row['cod_cab']?>" />
	  
	  	  
	   <? //if ($AnRK<>'3'){ ?>
	 <?php /*?>  <input style="border: 0px; background:none; " type="checkbox" name="xcodigo" value="<?=$row['cliente'];?><?=$row['cod_cab'];?>" onclick="Anular('S<?=$AnRK;?>')"  /><?php */?>
	  <? //} ?>	 
	  
      </td>
              <td width="128" class="texto1" align="center" ><?php echo extraefecha4($row['fecha'])?></td>
              <td width="95" class="texto1" ><?php echo $row['pc']; ?></td>
              <td width="87" class="texto1"><?php echo $row['cod_ope'].'-'.$row['serie'].'-'.$row['Num_doc']; ?></td>			   
              <td width="144" class="texto1"><?php //echo $row['cliente']; ?><?php echo substr(caracteres($row['razonsocial']),0,27); ?></td>
              <td width="21" align="center" class="texto1"><?  
			  if($moneda==''){
			  if ($row['moneda']=='02'){echo 'US$.';}else{echo 'S/.';}
			  }else{
			  if ($row['monedaSD']=='02'){echo 'US$.';}else{echo 'S/.';}
			  }
			   ?></td>
              <td width="67" align="right" class="texto1"><?php 
			  //-$row['total'];
			  //if ($row['deuda']=='S'){
			  if ($row['saldo']>0){
				  echo number_format($row['saldo'],2);
			  }else{
			  	  echo number_format($row['total'],2);
			  }
			  $totalGen=$totalGen+$row['total'];
			  ?></td>
			  <td width="77" align="right" class="texto1"><?php 
		$resultados11 = mysql_query("select * from usuarios where codigo='".$row['cod_vendedor']."' ",$cn); 
			  $rowSM=mysql_fetch_array($resultados11);
			  echo $rowSM['usuario'];
				?></td>
			  <td width="130" align="center" class="texto1"><?php 
		$strSQLSM="select * from referencia where cod_cab='".$row['cod_cab']."' order by id desc ";
	$resultadoMS=mysql_query($strSQLSM,$cn);
	//$rowSM=mysql_fetch_array($resultadoMS);
	while($rowSM=mysql_fetch_array($resultadoMS)){
		//echo $rowSM['cod_cab_ref'];
		$strSQLY="select * from cab_mov where cod_cab='".$rowSM['cod_cab_ref']."'  ";
		$resultadoM=mysql_query($strSQLY,$cn);
		$rowS=mysql_fetch_array($resultadoM);
		echo $sucursal=$rowS['serie'].'-'.$rowS['Num_doc'].'-|-';
	
	}
	//echo $sucursal=$rowSM['serie'].'-'.$rowSM['correlativo'];
	
	
/*	while($rowSM=mysql_fetch_array($resultadoMS)){
	$codRefec=$rowSM['cod_cab'].',';
	//echo $codRefec;
		$strSQL2="select * from cab_mov where cod_cab in (".$codRefec."0) ";
		$resultado2=mysql_query($strSQL2,$cn);
		//$rowR=mysql_fetch_array($resultadoMS);   	
		while($rowR=mysql_fetch_array($resultado2)){
			if ($rowR['cod_cab']<>''){
				}echo $rowR['serie'].'-'.$rowR['Num_doc'].' | ';	
			
		}
	
	}*/
		
			   ?></td>			 
    </tr>
  
  <?php }?>
</table>
</div>
		  
	<table width="100%" height="20" border="0" cellpadding="0" cellspacing="0" bgcolor="#FBFBFB">
  <tr>
    <td width="311" height="20" align="left" valign="middle" style=" border-top:#C1E1F9 solid 1px"><span class="Estilo29">Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (de <strong><?php echo $total_registros?></strong> productos)</span>.</td>
    <td width="526" height="20" align="right" valign="middle" style="border-top:#C1E1F9 solid 1px"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:13px">
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
    <input type="hidden" name="pag" id="pag" value="<?php echo $pagina?>" />	</td>
  </tr>
</table>
