<?php session_start();
		include('../conex_inicial.php');
		include('../funciones/funciones.php');
		
?><style type="text/css">
<!--
.Estilo101 {
	color: #0066FF;
	font-weight: bold;
}
-->
</style>
<div id="detalle" style="width:800px; height:164px; overflow:auto;border:0px solid;" >
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
			$mosdocFac=$_REQUEST['mosdocFac'];
			$mosdocAnu=$_REQUEST['mosdocAnu'];
			$Estado=$_REQUEST['Estado'];
			$inifec=explode("-",$fec1);
			$finfec=explode("-",$fec2);
			
			$formaOrder=$_REQUEST['formaOrder'];
			$campoOrder=$_REQUEST['campoOrder'];
			
			if($campoOrder!="" && $formaOrder!=""){
			$filtroOrden=" order by  ".$campoOrder." ".$formaOrder; 
			}else{
			$filtroOrden=" order by fecha desc ";
			}
	
	//echo $_SESSION['codvendedor'];	
if($_SESSION['nivel_usu']==4 || $_SESSION['nivel_usu']==5){
$filtroVendedor=" cod_vendedor like '%$vendedor%' ";
}else{
$filtroVendedor=" cod_vendedor like '%".$_SESSION['codvendedor']."%' ";
}			
			
			

if ($mosdocAnu<>''){			
 $SQLMosDoc=" and flag ='$mosdocAnu' ";
}


$Estado=ereg_replace("=T", "='T'", $Estado);
$Estado=ereg_replace("=O", "='O'", $Estado);
$Estado=ereg_replace("=A", "='A'", $Estado);

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
	$SQLEstado =" and flag<>'A' and estadoOT<>'O' and estadoOT<>'T' ";
  }
 
 // and flag_r <>'RA'
  
  if($docref!="0"){
   $filtroCod =" and cod_ope='$docref' ";
  }else{
//   $filtroCod =" and (cod_ope='TB' or cod_ope='TF' or cod_ope='NV') ";
  	 $filtroCod=" CM.cod_ope='--' ";	
	 $resultados11 = mysql_query("select * from operacion where tipo ='2'  and substring(p1,28,1)='S' and  substring(p1,5,1)='S' order by descripcion ",$cn); 
		while($row11=mysql_fetch_array($resultados11)){
	
		$filtroCod=$filtroCod. " or CM.cod_ope='".$row11['codigo']."' ";
		}
  	 $filtroCod=" and ( $filtroCod ) ";

  } 
 
 $totPuntos=0; 

  
 $SQLConsulta=" where tienda='$almacen' ".$filtroCod." and ".$filtroVendedor."
  and C.razonsocial like '%$cliente%'	
 and C.ruc like '%$ruc%'
  $SQLMosDoc   $SQLEstado
    ";

// 	and flag_r <>'RA'
//and substring(fecha,1,10) between '".formatofecha($fec1)."' and '".date('Y-m-d')."'

$resultados = mysql_query("select * from cab_mov CM
inner join cliente C on CM.cliente =C.codcliente 
$SQLConsulta and CM.tipo='2' and substring(fecha,1,10) between '".$inifec[2]."-".$inifec[1]."-".$inifec[0]."' and '".$finfec[2]."-".$finfec[1]."-".$finfec[0]."' $filtroOrden " ,$cn);
$total_registros = mysql_num_rows($resultados); 
			
$strSQL="select * from cab_mov  CM
inner join cliente C on CM.cliente =C.codcliente 	
$SQLConsulta and CM.tipo='2' and substring(fecha,1,10) between '".$inifec[2]."-".$inifec[1]."-".$inifec[0]."' and '".$finfec[2]."-".$finfec[1]."-".$finfec[0]."' $filtroOrden LIMIT $inicio, $registros";

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
		
 //documentos Terminado
$sql="select * from cab_mov where cod_cab='".$row['cod_cab']."'  and cod_ope in ('TB','TF','NV') and flag<>'A'
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
	//echo "estado".$rowX['estadoOT'];
}
$data="";	
$data=$row['sucursal']."~".$row['cod_ope']."~".$row['serie']."~".$row['Num_doc']."~".$row['ci']."~";
list($tip_form)=mysql_fetch_array(mysql_query(" select formato from operacion where codigo='".$row['cod_ope']."'"));					
$data.=	$tip_form;			

?>
			
  <tr bgcolor="<?php echo $color_row?>" onClick="entrada(this);Anular('S<?=$AnRK;?>')" ondblclick="doc_det(this)"  >
      <td width="26" align="center">
	  <? //if ($AnRK<>'3'){ ?>
	  <input onclick="Anular('S<?=$AnRK;?>')" style="border: 0px; background:none; " type="radio" name="XDato" value="<?php  echo $row['cod_cab']."|".$row['cliente']?>" />
	    <? // } ?>
		 <input name="estadoDoc" type="hidden" value="<?php echo $row['flag']."-".$row['estadoOT']?>" size="5" />	
	  </td>
      <td width="21" align="center" class="texto1" style="display:none" >	  
	   <? if ($AnRK<>'3'){ ?>
	   <input 
	   <? //if ($AnRK=='3'){ echo 'disabled';  } ?>
	   style="border: 0px; background:none; " type="checkbox" name="xcodigo" value="<?php  echo $row['cod_cab']?>" onclick="Anular('S<?=$AnRK;?>')" />
	  <? } ?>
	  <input type="hidden" name="tipformato" value="<?php echo $data ?>" />	  </td>
             <td width="119" class="texto1"><?php echo $row['fecha']?></td>	
			  <td width="85" class="texto1" ><?php echo $row['serie'].'-'.$row['Num_doc']; ?></td>	
              <td width="161" class="texto1"><?php echo utf8_encode($row['razonsocial'])?></td>
              <td width="28" align="center" class="texto1"><?  
			  if($moneda==''){
			  if ($row['moneda']=='02'){echo 'US$.';}else{echo 'S/.';}
			  }else{
			  if ($row['monedaSD']=='02'){echo 'US$.';}else{echo 'S/.';}
			  }
			   ?></td>
              <td width="91" align="right" class="texto1"><?php 
			  if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	echo number_format($row['total'],2);
	}
			  ?></td>
			  <td width="97" align="right" class="texto1">
			  <?php 
		  /*
			$strSQLSM="select * from referencia where cod_cab='".$row['cod_cab']."' order by id desc ";
			$resultadoMS=mysql_query($strSQLSM,$cn);
			$rowSM=mysql_fetch_array($resultadoMS);
			//echo $sucursal=$rowSM['serie'].'-'.$rowSM['correlativo'];
		
			$strSQLSM="select * from cab_mov where cod_cab='".$rowSM['cod_cab_ref']."' ";
			$resultadoMS=mysql_query($strSQLSM,$cn);
			$rowR=mysql_fetch_array($resultadoMS);   	
			if ($rowR['cod_cab']<>''){
			//echo '('.formatofecha(substr($rowR['fecha'],0,10)).')  '.$rowR['serie'].'-'.$rowR['Num_doc'];		
			echo formatofecha(substr($rowR['fecha'],0,10)).'-|-'.$rowR['Num_doc'];		
					}	
		  */
		  
		  echo  number_format($row['puntos'],2);
			
			$totPuntos=$totPuntos+$row['puntos'];
			   ?></td>			  
			  <td width="86" align="center" class="texto1"><?php echo $row['tienda']?></td>	
			  <td width="33" align="right" class="texto1"><?php  if ($row['archivo']<>''){ echo '<a href="'.$row['archivo'].'" target="_blank"><img src="../imagenes/archivo.png" width="15" height="15" border="0" border="0"></a>';}?></td>
			  <td width="55" align="center" class="texto1"><?php if ($row['obs1']<>''){ echo '-|-'; }; ?></td>
			  <td width="50" align="center" class="texto1"><?php echo $row['ci']; ?></td>		 
    </tr>
  
  <?php }?>
</table>
</div>
		  
	<table width="100%" height="21" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="319" height="21" align="left" valign="bottom" style="color:#999999"><span class="Estilo29">Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (de <strong><?php echo $total_registros?></strong> productos)</span>.</td>
    <td width="285" align="right" valign="bottom" style="color:#666666">Total Puntos: <span  style="color:#0066FF"><strong><?php echo number_format($totPuntos,2);?> </strong></span></td>
    <td width="255" align="right" valign="bottom" style="color:#999999"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:13px">
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
      <input type="hidden" name="pag" id="pag" value="<?php echo $pagina?>" /></td>
  </tr>
</table>
