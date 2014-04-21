<?php 

		session_start();
		include('../conex_inicial.php');
		include('../funciones/funciones.php');
		
?><style type="text/css">
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
			
			if($campoOrder!=""){
			$filtroOrden=" order by  ".$campoOrder." ".$formaOrder; 
			}else{
			$filtroOrden=" order by fecha desc ";
			}
			

if ($mosdocAnu<>''){			
 $SQLMosDoc=" and flag ='$mosdocAnu' ";
}

//echo $Estado;
$Estado=ereg_replace("=T", "='T'", $Estado);
$Estado=ereg_replace("=O", "='O'", $Estado);
$Estado=ereg_replace("=A", "='A'", $Estado);
$Estado=ereg_replace("=R", "='R'", $Estado);

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
			$SQLEstado =" and flag_r <>'RA' and flag<>'A' and estadoOT<>'O' and estadoOT<>'T'  "; 
		  }else{
			$SQLEstado =stripslashes($Estado);
		  }	
 }else{
	$SQLEstado =" and flag<>'A' and estadoOT<>'O' and estadoOT<>'T' and estadoOT<>'R' and  estadoOT<>'E' ";
  }
 
 // and flag_r <>'RA'
 // echo $SQLEstado;
 //echo $docref; 
   if($docref=="0"){
  $filtroDocs="  ";
  }else{
   $filtroDocs=" and cod_ope='$docref' ";
  }
 //echo $filtroDocs;
 $SQLConsulta=" where tienda='$almacen'
 $filtroDocs
 and cod_vendedor like '%$vendedor%'
 and C.razonsocial like '%$cliente%'	
 and C.ruc like '%$ruc%'
  $SQLMosDoc   $SQLEstado
    ";

// 	and flag_r <>'RA'
//and substring(fecha,1,10) between '".formatofecha($fec1)."' and '".date('Y-m-d')."'

$resultados = mysql_query("select CM.* from cab_mov CM
inner join cliente C on CM.cliente =C.codcliente 
inner join referencia R on CM.cod_cab =R.cod_cab_ref 
$SQLConsulta
order by cod_ope" ,$cn);
$total_registros = mysql_num_rows($resultados); 
			
$strSQL="select CM.* from cab_mov  CM
inner join cliente C on CM.cliente =C.codcliente
inner join referencia R on CM.cod_cab =R.cod_cab_ref  	
$SQLConsulta and substring(fecha,1,10) between '".$inifec[2]."-".$inifec[1]."-".$inifec[0]."' and '".$finfec[2]."-".$finfec[1]."-".$finfec[0]."' $filtroOrden LIMIT $inicio, $registros";

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

 //documentos con Pagos (anulara y desanular no permite)
/*$sql="select *  from cab_mov where cod_cab='".$row['cod_cab']."'  and condicion='2'
 and flag <>'A'
LIMIT 0, 1  ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
		$color_row='#FFDFF4';
		$AnRK='3';
}*/						 					
 //documentos Terminado
$sql="select * from cab_mov where cod_cab='".$row['cod_cab']."'  and cod_ope ='OT' and flag<>'A'
LIMIT 0, 1  ";

$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	
	if ($rowX['estadoOT']=='T'){
	//echo "asfa";
		$color_row='#339FFF';
		$AnRK='3';
	}elseif ($rowX['estadoOT']=='O'){
		$color_row='#FFB546';
		//$AnRK='3';
	}elseif ($rowX['estadoOT']=='R'){
		$color_row='#CAA2FB';
		//$AnRK='3';
	}elseif ($rowX['estadoOT']=='E'){
		$color_row='#A0F3DB';
		//$AnRK='3';
	}elseif ($rowX['estadoOT']=='O'){
		//$color_row='#F4BC46';
		//$AnRK='3';
	}
	
}
if(stripslashes($Estado)=="and estadoOT='P'" && $row['cod_ope']=='OS'){
$color_row='#A0FEB0';
}						 					

list($ref_cod,$ref_serie,$ref_num,$ref_estadoOT)=mysql_fetch_row(mysql_query("select c.cod_ope,c.serie,c.Num_doc,c.estadoOT from cab_mov c, referencia r where cod_cab_ref='".$row['cod_cab']."' and c.cod_cab=r.cod_cab"));
//echo "select c.cod_ope,c.serie,c.Num_doc,c.estadoOT from cab_mov c, referencia r where cod_cab_ref='".$row['cod_cab']."' and c.cod_cab=r.cod_cab";
$disaRow="";
if($ref_estadoOT=='T'){
$disaRow=" disabled ";
}

list($flag_kardex)=mysql_fetch_row(mysql_query("select flag_kardex from det_mov where cod_cab='".$row['cod_cab']."'"));

?>
			
  <tr <?php echo $disaRow ?> bgcolor="<?php echo $color_row?>" onClick="entrada(this);Anular('S<?=$AnRK;?>')" ondblclick="doc_det(this)" >
      <td width="24"  align="center"><input onclick="" style="border: 0px; background:none; " type="radio" name="XDato" value="<?php  echo $row['cod_cab']?>" /></td>
      <td width="20" align="center" class="texto1" >	  
	   <? if ($AnRK<>'3'){ ?>
	   <!--<input 
	   <? //if ($AnRK=='3'){ echo 'disabled';  } ?>
	   style="border: 0px; background:none; visibility:visible " type="checkbox" name="xcodigo" value="<?php // echo $row['cod_cab']?>" onclick="Anular('S<?=$AnRK;?>')" />-->
	  <? } ?>	<?php echo $AnRK;?>  </td>
             <td width="117" class="texto1"><?php echo $row['fecha']?></td>	
			  <td width="79" class="texto1" ><?php echo $row['serie'].'-'.$row['Num_doc']; ?></td>	
              <td width="71" align="center" class="texto1">
			  <?php 
			
			echo $row['cod_ope'];
			  ?>			  </td>
              <td width="274" align="left" class="texto1"><?php 
			  
			    list($razonsocial)=mysql_fetch_row(mysql_query("select razonsocial from cliente where codcliente='".$row['cliente']."'"));
			  
			  echo $razonsocial;
			  ?></td>
              <td width="128" align="center" class="texto1"><?php 
					//echo $row['cod_ope'];
		
				
				  
					
					echo $ref_cod." ".$ref_serie." - ".$ref_num;
			   ?></td>	  
			  <td colspan="3" width="87" align="center" class="texto1"><?php 
			echo $flag_kardex;
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
</table>