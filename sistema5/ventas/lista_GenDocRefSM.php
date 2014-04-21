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
$SQLConsulta and substring(fecha,1,10) between '".$inifec[2]."-".$inifec[1]."-".$inifec[0]."' and '".$finfec[2]."-".$finfec[1]."-".$finfec[0]."'
LIMIT $inicio, $registros";
						
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
	if ($rowX['estadoOT']=='T'){
		$color_row='#0066FF';
		$AnRK='3';
	}elseif ($rowX['estadoOT']=='O'){
		$color_row='#FF6600';
		//$AnRK='3';
	}
}	
?>
			
  <tr bgcolor="<?php echo $color_row?>" onClick="entrada(this)" ondblclick="doc_det(this)"  >
      <td width="24" align="center"><input style="border: 0px; background:none; " type="radio" name="XDato" value="<?php  echo $row['cod_cab']?>" /></td>
      <td width="32" align="center" class="texto1" >	  
	   <? if ($AnRK<>'3'){ ?>
	   <input 
	   <? //if ($AnRK=='3'){ echo 'disabled';  } ?>
	   style="border: 0px; background:none; " type="checkbox" name="xcodigo" value="<?php  echo $row['cod_cab']?>" onclick="Anular('S<?=$AnRK;?>')" />
	  <? } ?>	  </td>
             <td width="129" class="texto1" align="center"><?php echo $row['fecha']?></td>	
			  <td width="36" align="center" class="texto1" ><?php echo $row['cod_ope']; ?></td>	
              <td width="92" class="texto1" ><?php echo $row['serie'].'-'.$row['Num_doc']; ?></td>
              <td width="188" class="texto1"><?php 
			 $resultados11 = mysql_query("select * from usuarios where codigo='".$row['cod_vendedor']."' ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			echo $row11['usuario'];			
			}
			  //echo $row['cod_vendedor'];
			?></td>
              <td width="72" align="right" class="texto1"><?php 
			//echo $row['cod_cab'];
			$resultados11 = mysql_query("select * from det_mov where cod_cab='".$row['cod_cab']."' ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			echo  $row11['cantidad'];						
			}
			  ?></td>
			  <td width="124" align="center" class="texto1"><?php 
		   $resultados11 = mysql_query("select * from referencia r,cab_mov c where r.cod_cab='".$row['cod_cab']."' and r.cod_cab_ref=c.cod_cab and c.cod_ope='OT' ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			$codOT= $row11['cod_cab_ref'];	
			 echo $row11['serie'].'-'.$row11['Num_doc']; 		
			}
		
			
			  
			  ?></td>	
			  <td width="57" align="center" class="texto1"><?php  if ($row['archivo']<>''){ echo '<a href="'.$row['archivo'].'" target="_blank"><img src="../imagenes/archivo.png" width="15" height="15" border="0" border="0"></a>';}?></td>
			  <td width="46" align="center" class="texto1"><?php if ($row['obs1']<>''){ echo '-|-'; }; ?></td>		 
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