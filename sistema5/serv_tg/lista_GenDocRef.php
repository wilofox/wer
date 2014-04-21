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
<table width="800" border="0" cellpadding="0" cellspacing="0" id="lista_productos">
  <?php 
  //height="24" 
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
			$numero=$_REQUEST['numerost'];
			$consnumero="";
			if($numero!=""){
				$consnumero="and Num_doc like '%$numero'";
			}
			$vendedor=$_REQUEST['vendedor'];
			$docref=$_REQUEST['docref'];
			$fec1=$_REQUEST['fec1'];
			$fec2=$_REQUEST['fec2'];
			$mosdocFac=$_REQUEST['mosdocFac'];
			$mosdocAnu=$_REQUEST['mosdocAnu'];
			$Estado=$_REQUEST['Estado'];
			$campoOrder=$_REQUEST['campoOrder'];
			$formaOrder=$_REQUEST['formaOrder'];
			if($campoOrder!="" && $formaOrder!=""){
			$filtroOrden=" order by  ".$campoOrder." ".$formaOrder; 
			}else{
			$filtroOrden=" order by fecha asc ";
			}

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
			//$SQLEstado =$Estado;
	$SQLEstado= " and cod_cab in (select cod_cab from cab_mov where ".substr($Estado,3,300)."  and cod_ope in ('S1','R1') )";

		  }	
 }else{
	$SQLEstado =" and flag<>'A' and estadoOT<>'O' and estadoOT<>'T' ";
  }

  
if($almacen<>0){	
  $Tienda=" tienda='$almacen' and ";
 }
 if($docref=='S1' || $docref=='R1'){	
  $CodDoc=" cod_ope='$docref' and ";
 }else{
    $CodDoc=" cod_ope in ('S1','R1') and ";
 }
 // echo $SQLEstado;
 $SQLConsulta=" where $Tienda $CodDoc cod_vendedor like '%$vendedor%'
 and C.razonsocial like '%$cliente%'	
 and C.ruc like '%$ruc%'
 $consnumero
  and substring(fecha,1,10) between '".formatofecha($fec1)."' and '".formatofecha($fec2)."'
 $SQLMosDoc   $SQLEstado  ";


$resultados = mysql_query("select * from cab_mov CM
inner join cliente C on CM.cliente =C.codcliente 
inner join tienda T on CM.tienda = T.cod_tienda 
$SQLConsulta
order by cod_ope" ,$cn);
 
$total_registros = mysql_num_rows($resultados); 
			
$strSQL="select *,(select p.nombre from producto p inner join det_mov dt where dt.cod_cab=CM.cod_cab and p.idproducto=dt.cod_prod limit 1) as n_prod from cab_mov  CM
inner join cliente C on CM.cliente =C.codcliente 	
inner join tienda T on CM.tienda = T.cod_tienda
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
				$color_row='#FFFFFF';//'#E9F3FE';
				}else{
				$color_row='#FFFFFF';
				}	
// documentos anulados rojo
$AnRK='';	
// documentos con serie (anulara y desanular no permite)
$sql="select * from series where producto in  (
select cod_prod from det_mov where cod_cab='".$row['cod_cab']."' )
and tienda='$almacen'  LIMIT 0, 1  ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX['id']<>''){
		$color_row='#D7FFF0';
		$AnRK='';
	}
}
$sql="select * from cab_mov 
where cod_cab  ='".$row['cod_cab']."' ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX['flag']=='A'){
		$color_row='#FF0000';
		$AnRK='2';
	}
}	
 /*documentos con Pagos (anulara y desanular no permite) 
 inner join pagos pa on pa.referencia=cab_mov.cod_cab*/
$sql="select * from cab_mov where cod_cab='".$row['cod_cab']."'  and condicion='2'
 and flag <>'A'
LIMIT 0, 1  ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
		$color_row='#FFDFF4';
		$AnRK='';
}						 					
 //documentos Terminado
$sql="select * from cab_mov where cod_cab='".$row['cod_cab']."'  and cod_ope in ('S1','R1') and flag<>'A'
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
			
  <tr bgcolor="<?php echo $color_row?>" onClick="entrada(this)" ondblclick="doc_det(this)">
      <td width="25" align="center"><input style="border: 0px; background:none; " type="radio" name="XDato" value="<?php  echo $row['cod_cab']?>" /></td>
      <td width="28" align="center" class="texto1" >	  
	   <? if ($AnRK<>'3'){ ?>
	   <input 
	   <? //if ($AnRK=='3'){ echo 'disabled';  } ?>
	   style="border: 0px; background:none; " type="checkbox" name="xcodigo" value="<?php  echo $row['cod_cab']?>" onclick="Anular('S<?=$AnRK;?>')" />
	  <? } ?>	  </td>
             <td width="70" class="texto1" ><?php echo $row['des_tienda']?></td>	
			  <td width="57" class="texto1" ><?php echo formatofecha(substr($row['fecha'],0,10));?><input type="hidden" value="<?php echo formatofecha(substr($row['fecha'],0,10));?>" id="<?php echo "C".$row['cod_cab'] ?>" /></td>	
              <td width="90" class="texto1"><?php echo substr(caracteres($row['razonsocial']),0,22);?></td>
              <td width="80" class="texto1"><?php echo $row['cod_ope']." ".$row['serie']."-".$row['Num_doc'];?></td>
              <td width="110"  class="texto1" title="Hol"><?php 
			   $strSQLSM="select * from det_mov where cod_cab='".$row['cod_cab']."' order by cod_det";
				$resultadoMS=mysql_query($strSQLSM,$cn);
				$rowR=mysql_fetch_array($resultadoMS);					

			  $strSQLP="select * from producto where idproducto ='".$rowR['cod_prod']."' ";
				$resultadoP=mysql_query($strSQLP,$cn);
				$rowP=mysql_fetch_array($resultadoP);

				echo substr(caracteres($rowP['nombre']),0,18);
			  ?><input type="hidden" value="<?php echo $rowR['cod_prod'];?>" id="<?php echo "P".$row['cod_prod']?>" /></td>
			  <td width="85" align="center" class="texto1"><?php 
			  $strSQLSM="select * from referencia where cod_cab='".$row['cod_cab']."'  ";
			  $resultadoMS=mysql_query($strSQLSM,$cn);
		      $rowSM=mysql_fetch_array($resultadoMS);
			  //echo $rowSM['cod_cab_ref'];
			  echo $rowSM['serie'].'-'.$rowSM['correlativo'];
			   ?></td>
			  <td width="99" class="texto1"><?php 
			 $strSQL09="select * from condicion where codigo='".$row[27]."'  ";
			  $resultado09=mysql_query($strSQL09,$cn);
		      $row09=mysql_fetch_array($resultado09);	
			  echo $row09['nombre'];
		  
			   ?></td>
			  <td width="60" align="center" class="texto1"><?php echo formatofecha(substr($row['f_venc'],0,10));?></td>	
			  <td width="33" align="center" class="texto1"><?php  if ($row['archivo']<>''){ echo '<a href="'.$row['archivo'].'" target="_blank"><img src="../imagenes/archivo.png" width="15" height="15" border="0" border="0"></a>';}?></td>
			  <td width="28" align="center" class="texto1"><?php if ($row['obs1']<>''){ echo '-|-'; }; ?></td>		 
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