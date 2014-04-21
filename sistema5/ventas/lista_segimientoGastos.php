<style type="text/css">
<!--
.Estilo100 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
-->
</style>
<div id="detalle" style="width:800px; height:165px; overflow:auto" >
<table width="800" height="24" border="0" cellpadding="0" cellspacing="0" id="lista_productos">
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
			$inifec=explode("-",$fec1);
			$finfec=explode("-",$fec2);
			
			if ($almacen=='0'){	
			$strSQL22="select * from tienda order by cod_tienda";
			$resultado22=mysql_query($strSQL22,$cn);
			while($row22=mysql_fetch_array($resultado22)){
			//echo  $saldos[]=",'".$row22['cod_tienda'].'';
			 $tiendas=$tiendas.$row22['cod_tienda'].",";
			}
		$tiendas2=substr($tiendas,0,strlen($tiendas)-1);
		$almacen1  =' CM.tienda in('.$tiendas2.') ';		
		}else{
		$almacen1 = " CM.tienda='$almacen' ";
		}	

if ($mosdocAnu<>''){			
 $SQLMosDoc=" and flag ='$mosdocAnu' ";
}

 if ($Estado<>''){
		  if (trim($Estado)=='T'){
			 $SQLEstado ="";
		  }elseif (trim($Estado)=='L'){
		  	//$filtroCod =" and flag_r='OT'  and flag<>'A' ";  
		  }elseif (trim($Estado)=='A'){
			$SQLEstado =" and flag='A' "; 
		  }else{
			//$filtroCod =" and flag_r='RA' ";  
		  }	
 }else{
		
  }
  if($docref!="0"){
		$filtroCod =$filtroCod."and flag_r='RA' and cod_ope='$docref' and tipo='1' ";
  }else{
  }
//echo $SQLEstado; 
  
 
// and DM.nom_prod like '%$cliente%'	  
 $SQLConsulta=" where  $almacen1 ".$filtroCod."  and cod_vendedor like '%$cliente%'

 and C.ruc like '%$ruc%'
  $SQLMosDoc   $SQLEstado
    ";

// 	and flag_r <>'RA'
//and substring(fecha,1,10) between '".formatofecha($fec1)."' and '".date('Y-m-d')."'
//inner join det_mov DM on CM.cod_cab =DM.cod_cab 
$resultados = mysql_query("select * from cab_mov CM
inner join cliente C on CM.cliente =C.codcliente 
inner join referencia R on CM.cod_cab =R.cod_cab 
$SQLConsulta and substring(CM.fecha,1,10) between '".$inifec[2]."-".$inifec[1]."-".$inifec[0]."' and '".$finfec[2]."-".$finfec[1]."-".$finfec[0]."'	
" ,$cn);
$total_registros = mysql_num_rows($resultados); 
// inner join det_mov DM on CM.cod_cab =DM.cod_cab			
$strSQL="select * from cab_mov  CM
inner join cliente C on CM.cliente =C.codcliente 
inner join referencia R on CM.cod_cab =R.cod_cab 
$SQLConsulta and substring(CM.fecha,1,10) between '".$inifec[2]."-".$inifec[1]."-".$inifec[0]."' and '".$finfec[2]."-".$finfec[1]."-".$finfec[0]."'	
LIMIT $inicio, $registros";
		
//$SQLConsulta and fecha between '".$inifec[2]."-".$inifec[1]."-".$inifec[0]."' and '".$finfec[2]."-".$finfec[1]."-".$finfec[0]."'		
						
			$j=0;
			$resultado=mysql_query($strSQL,$cn);
			 //echo $strSQL;

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
where cod_cab  ='".$row['cod_cab_ref']."' ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX['flag']=='A'){
		$color_row='#FF0000';
		$AnRK='2';
	}
	$cod_opeRef=$rowX['cod_ope'];
	$serieRef=$rowX['serie'];
	$numeroRef=$rowX['Num_doc'];
}			 					
 //documentos Terminado  and prodpase='N'  and flag<>'A' 
 
$sql="select * from cab_mov  CM
 inner join det_mov DM on CM.cod_cab =DM.cod_cab
 where CM.cod_cab='".$row['cod_cab']."' and flag<>'A'
LIMIT 0, 1  ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX['prodpase']=='N'){
		$color_row='#0066FF';
		$AnRK='3';
	}
}	

$AnRK='3';
?>


			
  <tr bgcolor="<?php echo $color_row?>" onClick="entrada(this)" ondblclick="doc_det(this)"  >
      <td width="20" align="center"><input style="border: 0px; background:none; " type="radio" name="XDato" value="<?php  echo $row['cod_cab']?>" /></td>
      <td width="28" align="center" class="texto1" >	  
	   <? if ($AnRK<>'3'){ ?>
	   <input 
	   <? //if ($AnRK=='3'){ echo 'disabled';  } ?>
	   style="border: 0px; background:none; " type="checkbox" name="xcodigo" value="<?php  echo $row['cod_cab']?>" onclick="Anular('S<?=$AnRK;?>')" />
	  <? } ?>	  </td>
             <td width="120" class="texto1" align="center"><?php echo $row['fecha']?></td>	
			  <td width="85" class="texto1" ><?php 
			  $strCli="select * from tienda where cod_tienda 	='".$row['tienda']."' ";
				$resultadoCli=mysql_query($strCli,$cn);
				$rowCL=mysql_fetch_array($resultadoCli);		 
				echo substr($rowCL['des_tienda'],0,30)
				
			  //echo $row['tienda']; ?></td>	
              <td width="90" class="texto1"><?php echo $row['cod_ope']."  ".$row['serie']."-".$row['Num_doc'];?></td>
              <td width="244" class="texto1"><?php 
			  $strCli="select * from cliente where codcliente='".$row['cliente']."' and tipo_aux='P' ";
				$resultadoCli=mysql_query($strCli,$cn);
				$rowCL=mysql_fetch_array($resultadoCli);		 
				echo substr($rowCL['razonsocial'],0,30)
			  //echo  $row['auxiliar'];	?></td>
			  <td width="46" class="texto1"><?php 	
			  	
			  if($row['moneda']=='01'){
			  echo "S/.";
			  }else{
			  echo "US$.";
			  } 
			  
			  ?></td>	
			  <td width="85" class="texto1"><?php 	
			  	
			  echo number_format($row['total'],2);			
			  
			  ?></td>
			  <td width="82" class="texto1"><?php echo $cod_opeRef.'-'.$serieRef.'-'.$numeroRef; ?></td>
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
for($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
	echo "<b style='color:#000000'>".$pagina."</b> "; 
	}else{ 
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