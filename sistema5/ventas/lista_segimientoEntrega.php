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
		 $registros = 50; 
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
		$almacen  =' CM.tienda in('.$tiendas2.') ';		
		}else{
		$almacen = " CM.tienda='$almacen' ";
		}	

		 
		  
  if($docref!="0"){
   $filtroCod =" and CM.cod_ope='TS' and  CM.tipo='$docref' ";
  }else{
  // $filtroCod =" and (cod_ope='RM' or cod_ope='SM') ";
   $filtroCod =" and CM.cod_ope='TS' and CM.tipo in ('1','2')  ";
  } 
  
 $SQLConsulta=" where $almacen 
 $filtroCod  $SQLMosDoc  
 and substring(fecha,1,10) between '".formatofecha($fec1)."' and '".formatofecha($fec2)."' 
and cod_vendedor like '%$vendedor%' 
and kardex='S' and deuda='N' 
  ";

//

//CM inner join cliente C on CM.cliente =C.codcliente 
//
$resultados = mysql_query("select * from cab_mov  CM inner join det_mov DM on CM.cod_cab=DM.cod_cab  
$SQLConsulta
ORDER BY CM.fecha DESC " ,$cn);
$total_registros = mysql_num_rows($resultados); 
			
$strSQL="select * from cab_mov  CM inner join det_mov DM on CM.cod_cab=DM.cod_cab  
$SQLConsulta	
ORDER BY CM.fecha DESC 
LIMIT $inicio, $registros";
						
			$j=0;
			$R=0;
			$resultado=mysql_query($strSQL,$cn);
			

	$resultados2 =mysql_num_rows($resultado); 
	$total_paginas = ceil($total_registros / $registros); 
			
			while($row=mysql_fetch_array($resultado)){
						 
			 	$j++;
				$R++;
				
				if($R%2==0){
				$color_row='#EBFEE9';//'#E9F3FE';
				}else{
				$color_row='#FFFFFF';
				}	
			
				
/*// documentos anulados rojo
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
 //documentos Terminado
$sql="select * from cab_mov where cod_cab='".$row['cod_cab']."'  and cod_ope ='TS' and flag<>'A'
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
}*/

$strSQLD="select * from det_mov where cod_cab='".$row['cod_cab']."' ";	
			$resultadoD=mysql_query($strSQLD,$cn);
			$j=$j-1;
			while($rowD=mysql_fetch_array($resultadoD)){
			$j++;			
			//echo $j.'-'.$rowD['cod_det'].'<br>';
			//	}
			//echo $j;
?>
			
  <tr bgcolor="<?php echo $color_row?>" onClick="entrada(this)" ondblclick="doc_det(this)"  >
      <td width="34" align="center">
	  
      <input style="border: 0px; background:none; " type="radio" name="XDato" value="<?php  echo $row['cod_cab']?>" /><span class="texto2" style="font-size:11px;"><b><? echo $j ?></b></span></td>
      <td width="28" align="center" class="texto1" >
	  <? if ($AnRK<>'3'){ ?>
	   <input 
	   style="border: 0px; background:none; " type="checkbox" name="xcodigo" value="<?php  echo $row['cod_cab']?>" onclick="Anular('S<?=$AnRK;?>')" />
	  <? } ?></td>
      <td width="115" align="center" class="texto1" ><?php echo $row['fecha']?></td>
             <td width="80" class="texto1"><?php echo $row['serie'].'-'.$row['Num_doc']; ?></td>	
			  <td width="192" class="texto1" ><?php						
			
				$strCli="select * from producto where idproducto='".$rowD['cod_prod']."' ";
				$resultadoCli=mysql_query($strCli,$cn);
				$rowCL=mysql_fetch_array($resultadoCli);
				//echo $rowCL['nombre']; 
				echo substr($rowCL['nombre'],0,30);
				?>				</td>	
              <td width="97" class="texto1"><?php 
				$strCli="select * from producto where idproducto='".$rowD['cod_prod']."' ";
				$resultadoCli=mysql_query($strCli,$cn);
				$rowCL=mysql_fetch_array($resultadoCli);
				echo $rowCL['cod_prod']; 
			
			  ?></td>
              <td width="54"  class="texto1"><?php 
			echo $rowD['cantidad'];
			  ?></td>
			  <td width="64" class="texto1"><?php 
			 $strUND="select * from unidades  where id='".$rowD['und']."'";
		$resultadoUND=mysql_query($strUND,$cn);
		$rowUND=mysql_fetch_array($resultadoUND);
		 echo $rowUND['nombre'];
			  ?></td>	
			  <td width="136" class="texto1"><?php 
			 $resultados11 = mysql_query("select * from usuarios where codigo='".$row['cod_vendedor']."' ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			echo $row11['usuario'];			
			}
			  //echo $row['cod_vendedor'];
			?></td>
    </tr>
  
  <?php 

			} // detalle
  } // cabesera
  
  
  ?>
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
