<?php 
session_start();
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

  if($docref!="0"){
   $filtroCod =" and cod_ope='OR' and  tipo='$docref' ";
  }else{
   $filtroCod =" and cod_ope='OR' and tipo in ('1','2')  ";
  } 
  if($mosdocFac==A){ $SQLMD=" and flag='A' ";}
 $SQLConsulta=" where $almacen 
 $filtroCod  $SQLMosDoc  
 and substring(fecha,1,10) between '".formatofecha($fec1)."' and '".formatofecha($fec2)."' 
and cod_vendedor like '%$vendedor%'   $SQLMD
  "; //and kardex='S' and deuda='N' 

$orden="";
switch($_REQUEST['ordenar']){
	case 'fecha':$orden="ORDER BY cab_mov.fecha DESC ";break;
	case 'numero':$orden="ORDER BY cab_mov.serie,cab_mov.Num_doc ASC ";break;
}

$SQL="select * from cab_mov $SQLConsulta $orden";
$resultados = mysql_query($SQL ,$cn);
$total_registros = mysql_num_rows($resultados); 

$strSQL="$SQL LIMIT $inicio, $registros";
						
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
?>
  <tr bgcolor="<?php echo $color_row?>" onClick="entrada(this)" ondblclick="doc_det(this)"  >
  	<td width="34" align="center">
	  
      <input style="border: 0px; background:none; visibility:hidden" type="radio" name="XDato" value="<?php  echo $row['cod_cab']?>"/><span class="texto2" style="font-size:11px;"><b><? echo $j ?></b></span></td>
      <td width="28" align="center" class="texto1" >
	  <? if ($AnRK<>'3'){ ?>
	   <input 
	   style="border: 0px; background:none; " type="checkbox" name="xcodigo" value="<?php  echo $row['cod_cab']?>" onclick="Anular('S<?=$AnRK;?>')" />
	  <? } ?></td>
      <td width="115" align="center" class="texto1" ><?php echo $row['fecha']?></td>
             <td width="80" class="texto1"><?php echo $row['serie'].'-'.$row['Num_doc']; ?></td>	
			  <td width="146" class="texto1" ><?php						
				/*if ($row['tipo']==1){
					$CodTienda=$row['tienda'];
				}else{
					$strCli="select * from cab_mov where serie='".$row['serie']."' and Num_doc='".$row['Num_doc']."' ";
				$resultadoCli=mysql_query($strCli,$cn);
				$rowCL=mysql_fetch_array($resultadoCli);
					$CodTienda=$rowCL['tienda']; 
				}*/
				//echo $CodTienda;
				if ($row['tipo']==2){
					$TipoN=2;
				}else{
					$TipoN=1;
				}
				$TipoN=2;
				 $strCli="select * from cab_mov where serie='".$row['serie']."' and Num_doc='".$row['Num_doc']."'   and tipo='".$TipoN."' ";
				$resultadoCli=mysql_query($strCli,$cn);
				$rowCL=mysql_fetch_array($resultadoCli); 
				
				$strCli="select * from tienda where cod_tienda='".$rowCL['tienda']."' ";
				$resultadoCli=mysql_query($strCli,$cn);
				$rowCL=mysql_fetch_array($resultadoCli);
				echo $rowCL['des_tienda']; 
				?></td>	
              <td width="161" class="texto1"><?php 
			  	
				
				$TipoN=1;
			  $strCli="select * from cab_mov where serie='".$row['serie']."' and Num_doc='".$row['Num_doc']."'   and tipo='".$TipoN."' ";
				$resultadoCli=mysql_query($strCli,$cn);
				$rowCL=mysql_fetch_array($resultadoCli);
			//	echo $rowCL['cod_cab']; 
				
				$strCli="select * from tienda where cod_tienda='".$rowCL['tienda']."' ";
				$resultadoCli=mysql_query($strCli,$cn);
				$rowCL=mysql_fetch_array($resultadoCli);
				echo $rowCL['des_tienda']; 	
			  
			/*  if ($row['tipo']==2){
					$CodTienda=$row['tienda'];
					//echo 11;
				}else{
				//echo 22;
					$strCli="select * from cab_mov where serie='".$row['serie']."' and Num_doc='".$row['Num_doc']."'  ";
				$resultadoCli=mysql_query($strCli,$cn);
				$rowCL=mysql_fetch_array($resultadoCli);
					$CodTienda=$rowCL['tienda']; 
				}
				echo $CodTienda;
				
				$strCli="select * from tienda where cod_tienda='$CodTienda' ";
				$resultadoCli=mysql_query($strCli,$cn);
				$rowCL=mysql_fetch_array($resultadoCli);
				echo $rowCL['des_tienda']; 
			  */
			  
			  ?></td>
              <td width="43"  class="texto1"><?php 
			$resultados11 = mysql_query("select count(*) as item from det_mov where cod_cab='".$row['cod_cab']."' ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			echo  $row11['item'];						
			}
			  ?></td>
			  <td width="50" class="texto1"><?php 
			  $resultados11 = mysql_query("select Sum(cantidad) as cantidad from det_mov where cod_cab='".$row['cod_cab']."' ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			echo  $row11['cantidad'];						
			}
			  ?></td>	
			  <td width="143" class="texto1"><?php 
			 $resultados11 = mysql_query("select * from usuarios where codigo='".$row['cod_vendedor']."' ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			echo $row11['usuario'];			
			}
			  //echo $row['cod_vendedor'];
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
			
			<input type="hidden" name="docsNoAnu" id="docsNoAnu" value="<?php echo $_SESSION['docConSerie3']?>">
			<input type="hidden" name="docsNoDesAnu" id="docsNoDesAnu" value="<?php echo $_SESSION['docConSerie4']?>">
			
        </td>
      </tr>
    </table>
	<br>
<?php unset($_SESSION['docConSerie3']);unset($_SESSION['docConSerie4']); ?>