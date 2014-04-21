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
			$criterio=$_REQUEST['criterio'];
			$valor=$_REQUEST['valor'];
			
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
			//echo  $saldos[]=",'".$row22['cod_tienda'].'';
			 $tiendas=$tiendas.$row22['cod_tienda'].",";
			}
		$tiendas2=substr($tiendas,0,strlen($tiendas)-1);
		$almacen  =' tienda in('.$tiendas2.') ';
		
		}else{
		$almacen = " tienda='$almacen' ";
		}	

$SQLEstado =" and flag<>'A' ";	
 
if ($Estado<>''){
		  if (trim($Estado)=='T'){
			 $SQLEstado =" ";
		  }elseif (trim($Estado)=='C'){
			$SQLEstado ="  ";	
		  }elseif (trim($Estado)=='A'){
		    $SQLEstado =" and flag='A' ";
		  }elseif (trim($Estado)=='O'){
		    $SQLEstado ="  and obs<>'' and flag<>'A'  ";		
		  }	
}
if ($valor!=''){
	$valor=" and $criterio like '%$valor%' ";
}
 
 //$almacen 
  $SQLConsulta=" where  
  substring(fecha_ini ,1,10) between '".formatofecha($fec1)."' and '".formatofecha($fec2)."' 
  $valor	$SQLEstado
  "; //and cod_vendedor like '%$vendedor%' 

$sqlx=" select * from oferta $SQLConsulta ";

$resultados = mysql_query(" $sqlx " ,$cn);
$total_registros = mysql_num_rows($resultados); 
			
$strSQL="$sqlx order by fecha_ini  desc LIMIT $inicio, $registros";
						
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
$sql="select * from oferta  
M inner join oferta_det MD on M.cod_ofe=MD.cod_ofe 
where M.cod_ofe  ='".$row['cod_ofe']."' ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX['flag']=='A'){
		$color_row='#FF0000';
		$AnRK='2';
	}else if ($rowX['estado']=='A'){
		$color_row='#0066FF';
		$AnRK='3';
	}
}	


?>
			
  <tr bgcolor="<?php echo $color_row?>" onClick="entrada(this)" ondblclick="doc_det(this)"  >
      <td width="24" align="center">	  
      <input style="border: 0px; background:none; " type="radio" name="XDato" value="<?=$row['cod_ofe'];?>" /><span class="texto2" style="font-size:11px;"><b><? echo $j ?></b></span></td>
      <td width="40" align="center" class="texto1" >
	  <? if ($AnRK<>'3'){ ?>
	   <input 
	   style="border: 0px; background:none; " type="checkbox" name="xcodigo" value="<?=$row['cod_ofe'];?>" onclick="Anular('S<?=$AnRK;?>')" />
	  <? } ?></td>
      <td width="258" class="texto1" title="<?php echo $row['nom_oferta'];?>" >(<?php echo $row['cod_prod'];?>) <?php echo substr($row['nom_oferta'],0,30);?></td>
             <td width="107" class="texto1"><?php						
				$strCli="select * from unidades where id='".$row['unidad']."' ";
				$resultadoCli=mysql_query($strCli,$cn);
				$rowCL=mysql_fetch_array($resultadoCli);
				echo $rowCL['descripcion']; 
				?></td>	
			  <td width="44" class="texto1" ><?php echo $row['cantidad']; ?></td>	
              <td width="75" class="texto1"><?php	echo formatofecha(substr($row['fecha_ini'],0,10)); ?></td>
              <td width="80"  class="texto1"><?php 
			   if ($row['fecha_fin']<>'0000-00-00 00:00:00'){
			  echo formatofecha(substr($row['fecha_fin'],0,10)); 
			  }
			  ?></td>
			  <td width="61" class="texto1"><?php echo $row['condicion']; ?></td>	
			  <td width="66" class="texto1"><?php echo $row['monto'];?></td>
			   <td width="45" class="texto1"><div align="center">
			     <?php
			   if ($row['obs']<>''){
			   	echo  '<img src="../imgenes/AdminFeatures.gif"  width="16" height="16" border="0">';
			   }
			   ?>
			   </div>		       </td>
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
	<br>
