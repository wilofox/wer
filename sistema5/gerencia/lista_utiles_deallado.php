<div id="detalle" style="width:800px; height:175px; overflow:auto" >
<table id="lista_productos" width="783" height="24" border="0" cellpadding="0" cellspacing="0">
  <?php 

			include('../conex_inicial.php');
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
			
			$valor=$_REQUEST['valor'];
			$tienda=$_REQUEST['tienda'];
			$sucursal=$_REQUEST['sucursal'];
			
			if($sucursal==0){
			$filtro="";
			$campo_suc='costo_inven1';
			}else{
			$filtro=" where cod_suc='$sucursal' ";
			$campo_suc='costo_inven'.$sucursal;
			}
			
			$strSQL22="select * from tienda ".$filtro." order by cod_tienda";
			$resultado22=mysql_query($strSQL22,$cn);
			while($row22=mysql_fetch_array($resultado22)){
			$saldos[]="saldo".$row22['cod_tienda'];
			}
			//echo $sucursal."<br>";
			//print_r($saldos);
	//PAGINACION 2		
	
	if($moneda=='01'){
	 	$SqlMonRk=",REPLACE( moneda, '02', '01' ) as monedaSD";
	}elseif($moneda=='02'){
	 	$SqlMonRk=",REPLACE( moneda, '01', '02' ) as monedaSD";	
	}else{
	 	$SqlMonRk="";	
	}
	
	//Consulta 
	if($_REQUEST['valor']!=""){
	$valor=$_REQUEST['valor'];
	$criterio=$_REQUEST['criterio'];
	$filtro=" and  $criterio like'%$valor%' ";
	}
	$clasificacion=$_REQUEST['clasificacion'];
	$categoria=$_REQUEST['categoria'];
	$subcategoria=$_REQUEST['subcategoria'];
	
	$filtro3="";
	if($clasificacion!='999'){
	$filtro3=" and  clasificacion='$clasificacion' ";
	}
	if($categoria!='999'){
	$filtro3.=" and  categoria='$categoria' ";
	}
	if($subcategoria!='999'){
	$filtro3.=" and  subcategoria='$subcategoria' ";
	}
	
	//echo $filtro3;
	//$SqlConWerRK="and  nombre like '%$valor%' or idproducto like '%$valor%' ";
	$SqlConWerRK=  " $filtro $filtro3  " ;

	
$resultados = mysql_query("select * $SqlMonRk from producto where  kardex<>'' $SqlConWerRK order by nombre" ,$cn);
$total_registros = mysql_num_rows($resultados); 
			
                  $strSQL="select * $SqlMonRk from producto where kardex<>'' $SqlConWerRK  order by nombre LIMIT $inicio, $registros";
		
	//echo $strSQL;
						
			$j=0;
			$resultado=mysql_query($strSQL,$cn);
			

	$resultados2 =mysql_num_rows($resultado); 
	$total_paginas = ceil($total_registros / $registros); 
			
			while($row=mysql_fetch_array($resultado)){
			
			/*if($tienda==0 || $tienda==""){
					$tot_saldo=0;
					for($i=0;$i<count($saldos);$i++)
						$tot_saldo=$tot_saldo+$row[$saldos[$i]];
			}else{
				   $campo="saldo".$tienda;
				   $tot_saldo=$row[$campo];
				   
			 }	*/
			 
			 	$j++;
				if($j%2==0){
				$color_row='#E9F3FE';
				}else{
				$color_row='#FFFFFF';
				}			 					
			?>
			
  <tr bgcolor="<?php echo $color_row?>" onClick="entrada(this)" onDblClick="detalle_prod('<?php echo $row['idproducto']?>')">
      <td width="27" align="center"><input style="border: 0px; background:none; " type="radio" name="xproducto" value="<?php  echo $row['idproducto']?>" /></td>
              <td width="54" align="center" class="texto1" ><?php echo $row['idproducto']?></td>
              <td width="206" class="texto1" title="<? echo $row['nombre']; ?>"><? echo substr($row['nombre'], 0, 30)  ?></td>
              <td width="52" class="texto1"><?php echo "unidades" ?></td>			   
              <td width="48" class="texto1" align="center">
			  <?  
			  if($moneda==''){
			  if ($row['moneda']=='02'){echo 'US$.';}else{echo 'S/.';}
			  }else{
			  if ($row['monedaSD']=='02'){echo 'US$.';}else{echo 'S/.';}
			  }
			   ?></td>
              <td width="62" class="texto1" align="right"><?php 
			  if ($row['moneda']==$moneda ||  $moneda == ''){
					echo  number_format($row['precio'],2);	
			  }else{
				   if ($row['moneda']=='02'){
					echo  number_format($row['precio'] * $_SESSION['tc'],2);					
					}
			 		if ($row['moneda']=='01'){
					echo  number_format($row['precio'] / $_SESSION['tc'],2);	
					}				
			  }?></td>
              <td width="71" class="texto1" align="right"><?php 
			  if ($row['moneda']==$moneda ||  $moneda == ''){
					echo  number_format($row['precio2'],2);	
			  }else{
				   if ($row['moneda']=='02'){
					echo  number_format($row['precio2'] * $_SESSION['tc'],2);					
					}
			 		if ($row['moneda']=='01'){
					echo  number_format($row['precio2'] / $_SESSION['tc'],2);	
					}				
			  }?></td>
			  <td width="68" class="texto1" align="right"><?php 
			  if ($row['moneda']==$moneda ||  $moneda == ''){
					echo  number_format($row['precio3'],2);	
			  }else{
				   if ($row['moneda']=='02'){
					echo  number_format($row['precio3'] * $_SESSION['tc'],2);					
					}
			 		if ($row['moneda']=='01'){
					echo  number_format($row['precio3'] / $_SESSION['tc'],2);	
					}				
			  }?></td>
			  <td width="67" class="texto1" align="right"><?php 
			  if ($row['moneda']==$moneda ||  $moneda == ''){
					echo  number_format($row['precio4'],2);	
			  }else{
				   if ($row['moneda']=='02'){
					echo  number_format($row['precio4'] * $_SESSION['tc'],2);					
					}
			 		if ($row['moneda']=='01'){
					echo  number_format($row['precio4'] / $_SESSION['tc'],2);	
					}				
			  }?></td>
			 
			  <td width="70" class="texto1" align="right"><?php 
			  if ($row['moneda']==$moneda ||  $moneda == ''){
					echo  number_format($row['precio5'],2);	
			  }else{
				   if ($row['moneda']=='02'){
					echo  number_format($row['precio5'] * $_SESSION['tc'],2);					
					}
			 		if ($row['moneda']=='01'){
					echo  number_format($row['precio5'] / $_SESSION['tc'],2);	
					}				
			  }?></td>
			   <td width="58" class="texto1" align="right">
			   <?php 
			  if ($row['moneda']==$moneda ||  $moneda == ''){
					echo  number_format($row['pre_ref'],2);	
			  }else{
				   if ($row['moneda']=='02'){
					echo  number_format($row['pre_ref'] * $_SESSION['tc'],2);					
					}
			 		if ($row['moneda']=='01'){
					echo  number_format($row['pre_ref'] / $_SESSION['tc'],2);	
					}				
			  }?>			   </td>
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
echo "<a style='cursor:pointer' onclick='cargarcatalogo($pagina-1)'>< Anterior </a> "; 
} 

for ($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
	echo "<b style='color:#000000'>".$pagina."</b> "; 
	} else { 
	echo "<a style='cursor:pointer' href='#' onclick='cargarcatalogo($i)'>$i</a> "; 
	}
}
if(($pagina + 1)<=$total_paginas) { 
echo " <a style='cursor:pointer' onclick='cargarcatalogo($pagina+1)'>Siguiente ></a>"; 
} 
    ?>
      <input type="hidden" name="pag" value="<?php echo $pagina?>" />
    &nbsp;&nbsp;    </font> </td>
  </tr>
</table><br>
