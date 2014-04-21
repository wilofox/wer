<style type="text/css">
<!--
.Estilo100 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
-->
</style>
<div id="detalle" style="width:800px; height:165px; overflow-y:scroll; overflow-x:scroll" >
<table width="860" border="0" cellpadding="0" cellspacing="1">
<tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
	<td width="27" style=" border:#CCCCCC solid 1px" height="21" align="center" ><span class="texto2"><strong>OK <input style="border: 0px; background:none; display:none " type="checkbox" name="Cod" onClick="marcar()"   /></strong></span></td>
	<td width="61" align="center"  style="border:#CCCCCC solid 1px"><span class="texto2"><strong>Fec.Emi </strong></span></td>
	<td width="44"  style=" border:#CCCCCC solid 1px"><span class="texto2"><strong>Hora</strong></span></td>
	<td width="86"  style=" border:#CCCCCC solid 1px"><span class="texto2"><strong>Local</strong></span></td>
	<td width="94"  style=" border:#CCCCCC solid 1px"><span class="texto2"><strong><strong>Documento</strong></strong></span></td>
    <td width="151"  style=" border:#CCCCCC solid 1px"><span class="texto2"><strong>Producto</strong></span></td>
    <td width="65" align="center"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Cant.<br>
            Ped. </strong></span></td>
    <td width="67" align="center"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong >Por <br>
            entregar</strong></span></td>
    <td width="94"  style=" border:#CCCCCC solid 1px"><span class="texto2"><strong><strong>Documento Venta</strong></strong></span></td>
    <td width="162" style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Cliente</strong></span></td>
</tr>
<tr>
	<td colspan="10"><table width="860" height="24" border="1" cellpadding="0" cellspacing="0" id="lista_productos">
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
			 //$SQLEstado =" and prodpase='S' ";
			 $SQLEstado ="";
		  }elseif (trim($Estado)=='L'){
		  	$filtroCod =" and CM.cod_cab in(Select cod_cab_ref from referencia) ";  
		  }elseif (trim($Estado)=='A'){
			$SQLEstado =" and CM.cod_cab NOT in(Select cod_cab_ref from referencia) and flag='A' "; 
		  }else{
			$filtroCod =" and CM.cod_cab NOT in(Select cod_cab_ref from referencia) and flag<>'A' ";  
		  }	
 }else{
		if($docref!="0"){
		//echo "sddddd";
		$filtroCod =" and cod_ope='$docref' ";
		}else{
		$filtroCod =" and prodpase='N' ";   
		}
  }
  $filtroCod.=" and CM.cod_ope='$docref' ";
//echo $SQLEstado; 
  
 
  
 $SQLConsulta=" where  $almacen1 ".$filtroCod."  and cod_vendedor like '%$vendedor%'
 and DM.nom_prod like '%$cliente%'	
 and C.ruc like '%$ruc%'
  $SQLMosDoc   $SQLEstado
    ";

// 	and flag_r <>'RA'
//and substring(fecha,1,10) between '".formatofecha($fec1)."' and '".date('Y-m-d')."'

$resultados = mysql_query("select *,CM.cod_cab as ccm,cod_prod as prod,(Select sum(cantidad) from det_mov inner join cab_mov on cab_mov.cod_cab=det_mov.cod_cab inner join referencia re on re.cod_cab=det_mov.cod_cab where re.cod_cab_ref=ccm and cod_prod=prod and flag<>'A' group by cod_prod) as canjeado,(select count(*) from referencia where cod_cab_ref=ccm) as refer from cab_mov CM
inner join det_mov DM on CM.cod_cab =DM.cod_cab 
inner join cliente C on CM.cliente =C.codcliente 
$SQLConsulta and CM.fecha between '".$inifec[2]."-".$inifec[1]."-".$inifec[0]."' and '".$finfec[2]."-".$finfec[1]."-".$finfec[0]."' " ,$cn);
//and flag_r='RA'
$total_registros = mysql_num_rows($resultados); 

$strSQL="select *,CM.cod_cab as ccm,cod_prod as prod,(Select sum(cantidad) from det_mov inner join cab_mov on cab_mov.cod_cab=det_mov.cod_cab inner join referencia re on re.cod_cab=det_mov.cod_cab where re.cod_cab_ref=ccm and cod_prod=prod and flag<>'A' group by cod_prod) as canjeado,(select count(*) from referencia where cod_cab_ref=ccm) as refer, (select concat(ca.cod_cab,'=',ca.cod_ope,' ',ca.serie,'-',ca.Num_doc) from cab_mov ca inner join referencia re on re.cod_cab=ca.cod_cab where cod_cab_ref=ccm) as docref from cab_mov  CM
 inner join det_mov DM on CM.cod_cab =DM.cod_cab
inner join cliente C on CM.cliente =C.codcliente 
$SQLConsulta and substring(CM.fecha,1,10) between '".$inifec[2]."-".$inifec[1]."-".$inifec[0]."' and '".$finfec[2]."-".$finfec[1]."-".$finfec[0]."' order by CM.fecha desc LIMIT $inicio, $registros";
// and flag_r='RA' 
		
//$SQLConsulta and fecha between '".$inifec[2]."-".$inifec[1]."-".$inifec[0]."' and '".$finfec[2]."-".$finfec[1]."-".$finfec[0]."'		
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
/*
$sql="select * from cab_mov 
where cod_cab  ='".$row['cod_cab']."' ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX['flag']=='A'){
		$color_row='#FF0000';
		$AnRK='2';
	}
}			 */
					
 //documentos Terminado  and prodpase='N'  and flag<>'A' 
 /*
$sql="select * from cab_mov  CM
 inner join det_mov DM on CM.cod_cab =DM.cod_cab
 where CM.cod_cab='".$row['cod_cab']."' LIMIT 0, 1  ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	*/	


	//echo "sg".$rowX['flag'];
	if ($row['refer']>0){
		$color_row='#0066FF';
		$AnRK='4';
	}
	if ($row['flag']=='A' && $row['refer']==0){
		$color_row='#FF0000';
		$AnRK='2';
	}
	
	
//}	


?>


			
  <tr align="center" bgcolor="<?php echo $color_row?>" onClick="entrada(this)" ondblclick="doc_det('<?php  echo $row['cod_cab']?>')"  >
      <td width="26">
	  <?php 
	  if($AnRK=='4'){
	  ?>
	  <input disabled="disabled" style="border: 0px; background:none; " type="radio" name="XDato" value="" onclick="Anular('S<?=$AnRK;?>')" />
	  <?php }else{ ?>
	  <input style="border: 0px; background:none; " type="checkbox" name="XDato" value="<?php  echo $row['cod_det']."-".$row['cod_cab']?>" onclick="Anular('S<?=$AnRK;?>')" />
      <?php /*?><!--<input style="border: 0px; background:none; " type="radio" name="XDato" value="<?php  echo $row['cod_det']."-".$row['cod_cab']?>" onclick="Anular('S<?=$AnRK;?>')" />--><?php */?>
	   <?php } 
	  $AnRK='3';	
	  ?>	  </td>
             <td width="105" class="texto1"><?php echo $row['fecha']?></td>	
			  <td width="85" class="texto1" ><?php 
			  $strCli="select * from tienda where cod_tienda 	='".$row['tienda']."' ";
				$resultadoCli=mysql_query($strCli,$cn);
				$rowCL=mysql_fetch_array($resultadoCli);		 
				echo substr($rowCL['des_tienda'],0,30)
				
			  //echo $row['tienda']; ?></td>	
              <td width="93" class="texto1"><?php echo $row['cod_ope'].'-'.$row['serie'].'-'.$row['Num_doc']; ?></td>
              <td width="149" class="texto1"><?php echo substr($row['nom_prod'],0,25);?></td>
			  <td width="64" class="texto1"><?php 
			  echo $row['cantidad'];
			  ?></td>	
			  <td width="66" class="texto1">
			  <?php 
			  //echo $row['notas'];
			  //echo SalidaProducto($row['cod_cab'],$row['cod_prod']);
			  echo $row['cantidad']-$row['canjeado'];
			  ?>			  </td>
              <td width="93" class="texto1"><?php $referen=explode('=',$row['docref']); if($referen[1]!=""){echo $referen[1];}else{
				  echo str_pad("",13,"-");	}?></td>
              <td width="159" class="texto1"><?php 
			  $strCli="select * from cliente where codcliente='".$row['cliente']."' and tipo_aux='C' ";
				$resultadoCli=mysql_query($strCli,$cn);
				$rowCL=mysql_fetch_array($resultadoCli);		 
				echo substr($rowCL['razonsocial'],0,30)
			  //echo $row['cliente']; ?></td>
  </tr>
  
  <?php }?>
</table>
</td></tr>
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
<?php
/*function SalidaProducto($docu,$prod){
	include("../conex_inicial.php");
	$sql="Select sum(cantidad) from det_mov inner join cab_mov on cab_mov.cod_cab=det_mov.cod_cab where det_mov.cod_cab in(Select cod_cab from referencia where cod_cab_ref=$docu) and cod_prod=$prod and flag<>'A' group by cod_prod";
	$rs=mysql_query($sql);
	$row=mysql_fetch_array($rs);
	return $row[0];
}*/
?>