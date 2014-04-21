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
			$actividad=$_REQUEST['actividad'];
			$serieOT=$_REQUEST['serieOT'];
			$numeroOT=$_REQUEST['numeroOT'];
			
			//echo $serieOT;
			//echo $numeroOT;
			
			if($serieOT!='' && $numeroOT!=''){
			
			  list($cod_cabOT)=mysql_fetch_row(mysql_query("select cod_cab from cab_mov where serie='".$serieOT."' and Num_doc='".$numeroOT."' and cod_ope='OT' "));
		  
			    if($cod_cabOT!=''){
				$filtroCobcabOT=" and cod_cab='".$cod_cabOT."' ";
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
		$almacen1  =' almacen in('.$tiendas2.') ';		
		}else{
		$almacen1 = " almacen='$almacen' ";
		}	

//echo $vendedor;

if($vendedor!=''){
$filtroResp=" and responsable='".$vendedor."' ";
}
if($actividad!='0'){
$filtroActv=" and actividad='".$actividad."' ";
}

if ($mosdocAnu<>''){			
 $SQLMosDoc=" and flag ='$mosdocAnu' ";
}


if($Estado!="P" && $Estado!="T"){
$filtroEstado=" and estado='".$Estado."' ";
}else{
	if($Estado=="P"){
	$filtroEstado=" and estado='' ";
	}else{
	$filtroEstado=" ";
	}
}
 
  
 
  
 $SQLConsulta=" where  $almacen1 ".$filtroCod."  and cod_vendedor like '%$vendedor%'
 and DM.nom_prod like '%$cliente%'	
 and C.ruc like '%$ruc%'
  $SQLMosDoc   $SQLEstado
    ";

// 	and flag_r <>'RA'
//and substring(fecha,1,10) between '".formatofecha($fec1)."' and '".date('Y-m-d')."'

/*$resultados = mysql_query("select * from cab_mov CM
inner join det_mov DM on CM.cod_cab =DM.cod_cab 
inner join cliente C on CM.cliente =C.codcliente 
$SQLConsulta and CM.fecha between '".$inifec[2]."-".$inifec[1]."-".$inifec[0]."' and '".$finfec[2]."-".$finfec[1]."-".$finfec[0]."'	
" ,$cn);*/
$resultados = mysql_query("select * from activxordent where fecha between '".$inifec[2]."-".$inifec[1]."-".$inifec[0]."' and '".$finfec[2]."-".$finfec[1]."-".$finfec[0]."' and  $almacen1 $filtroResp $filtroActv $filtroCobcabOT $filtroEstado " ,$cn);

$total_registros = mysql_num_rows($resultados); 
			
$strSQL="select * from activxordent where fecha between '".$inifec[2]."-".$inifec[1]."-".$inifec[0]."' and '".$finfec[2]."-".$finfec[1]."-".$finfec[0]."'  and  $almacen1 $filtroResp $filtroActv $filtroCobcabOT $filtroEstado order by fecha desc,hora LIMIT $inicio, $registros";
		
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
	if ($row['prodpase']=='S' && $row['bajapase']=='S' && $row['flag']==''){
		$color_row='#0066FF';
		$AnRK='4';
	}
	if ($row['estado']=='A'){
		$color_row='#FF5B5B';
		$AnRK='2';
	}
	
	
//}	


?>


			
  <tr bgcolor="<?php echo $color_row?>" onClick="entrada(this)" ondblclick="doc_det('<?php  echo $row['cod_cab']?>')"  >
      <td width="20" align="center">
	  <?php 
	  if($AnRK=='4'){
	  ?>
	  <input disabled="disabled" style="border: 0px; background:none; " type="radio" name="XDato" value="" onclick="Anular('S<?=$AnRK;?>')" />
	  <?php }else{ 
	  	if($row['estado']==''){
	  ?>
	  <input style="border: 0px; background:none; " type="radio" name="XDato" value="<?php  echo $row['id']."-".$row['cod_cab']?>" onclick="Anular('S<?=$AnRK;?>')" />
	  <?php } 
	  }	  
	  $AnRK='3';	
	  ?>	  </td>
      <td width="40" align="center" class="texto1" >	  
	   <? if ($AnRK<>'3'){ ?>
	   <input 
	   <? //if ($AnRK=='3'){ echo 'disabled';  } ?>
	   style="border: 0px; background:none; " type="checkbox" name="xcodigo" value="<?php  echo $row['cod_cab']?>" onclick="Anular('S<?=$AnRK;?>')" />
	  <? } 
	  
	  echo $row['almacen'];
	  ?>	  </td>
             <td width="120" class="texto1" align="center"><?php echo $row['fecha']." ".$row['hora'] ?></td>	
			  <td width="236" class="texto1" ><?php 
			
			 list($nombreActv)=mysql_fetch_row(mysql_query("select nombre from procesos  where id='".$row['actividad']."' "));
			 echo caracteres($nombreActv);
			 ?></td>	
              <td width="64" class="texto1"><?php echo $row['numero']; ?></td>
              <td width="97" class="texto1"><?php 
			  list($serieOT,$numOT)=mysql_fetch_row(mysql_query("select serie,Num_doc from cab_mov where cod_cab='".$row['cod_cab']."' "));
			  echo $serieOT."-".$numOT;?>
			  </td>
			  <td width="116" class="texto1"><?php 
			  $strCli="select * from usuarios where codigo='".$row['responsable']."' ";
				$resultadoCli=mysql_query($strCli,$cn);
				$rowCL=mysql_fetch_array($resultadoCli);		 
				echo $rowCL['usuario'];
			  //echo $row['cliente']; ?></td>	
			  <td width="107" class="texto1">
			  <?php 
			   $temp=explode(":",$row['tiempo']);
			   echo $temp[0]." horas ".$temp[1]." min"
			  ?></td></tr>
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