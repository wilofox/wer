<div id="detalle" style="width:800px; height:175px; overflow:auto" >
||
<table id="lista_productos" width="783" height="24" border="0" cellpadding="0" cellspacing="0">
||
  <?php 

		include('../conex_inicial.php');
		include('../funciones/funciones.php');
		 //PAGINACION 1	
		 //$registros = 100; 
		 $registros = 100; 
		 $pagina = $_REQUEST['pagina']; 
		 $stock=$_REQUEST['stock'];
		 $cant=$_REQUEST['cant'];	  
		 $almacen=$_REQUEST['almacen'];	
		 $tp=$_REQUEST['tp'];
		 $moneda=$_REQUEST['moneda'];
		 $mostrar=$_REQUEST['columna'];
		 $precio1=substr($_REQUEST['precios'],0,1);
		 $precio2=substr($_REQUEST['precios'],1,1);
		 $precio3=substr($_REQUEST['precios'],2,1);
		 $precio4=substr($_REQUEST['precios'],3,1);
		 $precio5=substr($_REQUEST['precios'],4,1);
		 $precio6=substr($_REQUEST['precios'],5,1);
		 //echo $_REQUEST['precios']."<br>";
		 //echo $precio1."-".$precio2."-".$precio3."-".$precio4."-".$precio5."-".$precio6."<br>";
		 switch($mostrar){
			 case '1':$campo_prod="idproducto";$titulo_cod="C&oacute;d. Sist.";$wcodigo=61;$wdescrip=156;break;
			 case '2':$campo_prod="cod_prod";$titulo_cod="C&oacute;d. Anex.";$wcodigo=131;$wdescrip=85;break;
		 }
		//echo '//'.$tp; //_SESSION['tc'] 	
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
	
	/*if($stock == 'true')
	{ $fil01= ' and saldo101 +saldo102 +saldo103 + saldo201 + saldo202  +saldo301  +saldo302 + saldo401 + saldo402  +saldo501  +saldo502 + saldo601 + saldo602 + saldo701 + saldo702  +saldo801  +saldo802 + saldo901  +saldo902 >0 ';  	
	}
	if(!empty($almacen)){ 
	   if($almacen==103)
	   $fil02= ' and saldo103 > 0 ';
	   
	   if($almacen==104)
	   $fil02= ' and saldo104 > 0 ';
	   
	   if($almacen==201)
	   $fil02= ' and saldo201 > 0 ';
	   
	   if($almacen==101)
	   $fil02= ' and saldo101 > 0 ';
	   
	   if($almacen==102)
	   $fil02= ' and saldo102 > 0 ';
	}*/

///---------------------------------------------------------------------------
if($stock == 'true' || $cant == 'true'){	
	//if($stock=="S") {$mstck=" > 0 ";}else{ $mstck=" >= 0 ";}
	if($stock == 'true'){
		$mstck=" > 0 ";
	}
	if($almacen=="0"){
		$strSQL22="select * from tienda  order by cod_tienda";
		$resultado22=mysql_query($strSQL22,$cn);
		while($row22=mysql_fetch_array($resultado22)){
			$saldos[]="saldo".$row22['cod_tienda'];
		}
		if($stock == 'true'){
			$fil02=" and ( ";
			for($i=0;$i<count($saldos);$i++){
				$fil02=$fil02." + ".$saldos[$i];
			}
			$fil02.=" ) ".$mstck;
		}
	}else{
		if($stock == 'true'){
			$fil02=" and saldo$almacen ".$mstck;
		}
	}
}
///---------------------------------------------------------------------------	
	//echo $fil02;
	//$SqlConWerRK="and  nombre like '%$valor%' or idproducto like '%$valor%' ";
	$SqlConWerRK=  " $filtro $filtro3   $fil01 $fil02 " ;

	//echo $SqlConWerRK;
$resultados = mysql_query("select * $SqlMonRk from producto where  kardex<>'' and concepto!='S' $SqlConWerRK order by nombre" ,$cn);
$total_registros = mysql_num_rows($resultados); 
			
                  $strSQL="select * $SqlMonRk from producto where kardex<>'' and concepto!='S' $SqlConWerRK  order by nombre LIMIT $inicio, $registros";
		
//	echo $strSQL;
						
			$j=0;
			$resultado=mysql_query($strSQL,$cn);
			

	$resultados2 =mysql_num_rows($resultado); 
	$total_paginas = ceil($total_registros / $registros); 
	// width="26" width="47" width="215" width="53" width="50" width="69" width="66" width="66" width="66" width="66" width="65" 
			?>
    <?php if($cant=='false'){ $wdescrip+=50; } ?>        
    <?php if($precio1=='N'){ $wdescrip+=62; } ?>
   <?php if($precio2=='N'){ $wdescrip+=71; } ?>
    <?php if($precio3=='N'){ $wdescrip+=68; } ?>
    <?php if($precio4=='N'){ $wdescrip+=67; } ?>
    <?php if($precio5=='N'){ $wdescrip+=70; } ?>
    <?php if($precio6=='N'){ $wdescrip+=58; } ?>        
            <table width="783" height="24" border="0" cellpadding="0" cellspacing="0">
        <tr style="background:url(imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
          <td style=" border:#CCCCCC solid 1px" width="20" height="21" align="center" ><span class="texto2"><strong>OK</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="<?php echo $wcodigo; ?>" align="center"><span class="texto2"><strong><?php echo $titulo_cod;?></strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="<?php echo $wdescrip;?>"><span class="texto2"><strong>Descripci&oacute;n</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="52"><span class="texto2"><strong>Unidad</strong></span></td>
          <?php if($cant=='true'){?><td  style=" border:#CCCCCC solid 1px; display:block;" width="50" id="Stock"><span class="texto2"><strong>Stock</strong></span></td><?php }?>
          <td  style=" border:#CCCCCC solid 1px" width="48"><span class="texto2"><strong>Moneda</strong></span></td>
          <?php if($precio1=='S'){ ?><td  style=" border:#CCCCCC solid 1px; display:block;" width="62" id="EPrecio1"><span class="texto2"><strong><?=$PrecNomEti1;?></strong></span></td><?php } ?>
   <?php if($precio2=='S'){ ?><td  style=" border:#CCCCCC solid 1px; display:block;" width="71" id="EPrecio2"><span class="texto2"><strong><?=$PrecNomEti2;?></strong></span></td><?php } ?>
    <?php if($precio3=='S'){ ?><td  style=" border:#CCCCCC solid 1px; display:block;" width="68" id="EPrecio3"><span class="texto2"><strong><?=$PrecNomEti3;?></strong></span></td><?php } ?>
    <?php if($precio4=='S'){ ?><td  style=" border:#CCCCCC solid 1px; display:block;" width="67" id="EPrecio4"><span class="texto2"><strong><?=$PrecNomEti4;?></strong></span></td><?php } ?>
    <?php if($precio5=='S'){ ?><td  style=" border:#CCCCCC solid 1px; display:block;" width="70" id="EPrecio5"><span class="texto2"><strong><?=$PrecNomEti5;?></strong></span></td><?php } ?>
    <?php if($precio6=='S'){ ?><td  style=" border:#CCCCCC solid 1px; display:block;" width="58" id="EPrecioR"><span class="texto2"><strong>Prec.Ref.</strong></span></td><?php } ?>
          </tr>
          </table>
          ||
            <?php
			while($row=mysql_fetch_array($resultado)){
				if($almacen==0 || $almacen==""){
					$tot_saldo=0;
					for($i=0;$i<count($saldos);$i++)
						$tot_saldo=$tot_saldo+$row[$saldos[$i]];
				}else{
					$campo="saldo".$almacen;
					$tot_saldo=$row[$campo];				   
				}
			 	$j++;
				if($j%2==0){
				$color_row='#E9F3FE';
				}else{
				$color_row='#FFFFFF';
				}			 					
			?>
			
  <tr bgcolor="<?php echo $color_row?>" onClick="entrada(this)" onDblClick="detalle_prod('<?php echo $row['idproducto']?>')">
      <td width="20" align="center"><input style="border: 0px; background:none; " type="radio" name="xproducto" value="<?php  echo $row['idproducto']?>" /></td>
              <td width="<?php echo $wcodigo; ?>" align="center" class="texto1" ><?php echo $row[$campo_prod]?></td>
              <td width="<?php echo $wdescrip;?>" class="texto1" title="<? echo $row['nombre']; ?>"><?
			  echo $row['nombre'];//else{ echo caracteres(substr($row['nombre'], 0, 30));}  ?></td>
              <td width="52" align="center" class="texto1"><?php 
			  
			$strSQL23="select * from unidades where id='".$row['und']."' ";
			$resultado23=mysql_query($strSQL23,$cn);
			$row23=mysql_fetch_array($resultado23);
			echo $row23['nombre'];
			  
			   ?></td>
               <?php if($cant=='true'){?><td class="texto1" width="33" align="right"><?php  echo $tot_saldo ?></td><?php }?>
              <td width="48" class="texto1" align="center">
			  <?  
			  if($moneda==''){
			  if ($row['moneda']=='02'){echo 'US$.';}else{echo 'S/.';}
			  }else{
			  if ($row['monedaSD']=='02'){echo 'US$.';}else{echo 'S/.';}
			  }
			   ?></td>
			<?php if($precio1=='S'){ ?>
              <td width="62" class="texto1" align="right"><?php 
			  if ($row['moneda']==$moneda ||  $moneda == ''){
					echo  number_format($row['precio'],4);	
			  }else{
				   if ($row['moneda']=='02'){
					echo  number_format($row['precio'] * $tp,4);					
					}
			 		if ($row['moneda']=='01'){
					echo  number_format($row['precio'] / $tp,4);	
					}				
			  }?></td>
			<?php } if($precio2=='S'){ ?>
              <td width="62" class="texto1" align="right"><?php 
			  if ($row['moneda']==$moneda ||  $moneda == ''){
					echo  number_format($row['precio2'],4);	
			  }else{
				   if ($row['moneda']=='02'){
					echo  number_format($row['precio2'] * $tp,4);					
					}
			 		if ($row['moneda']=='01'){
					echo  number_format($row['precio2'] / $tp,4);	
					}				
			  }?></td>
              <?php } if($precio3=='S'){ ?>
			  <td width="68" class="texto1" align="right"><?php 
			  if ($row['moneda']==$moneda ||  $moneda == ''){
					echo  number_format($row['precio3'],4);	
			  }else{
				   if ($row['moneda']=='02'){
					echo  number_format($row['precio3'] * $tp,4);					
					}
			 		if ($row['moneda']=='01'){
					echo  number_format($row['precio3'] / $tp,4);	
					}				
			  }?></td>
              <?php } if($precio4=='S'){ ?>
			  <td width="67" class="texto1" align="right"><?php 
			  if ($row['moneda']==$moneda ||  $moneda == ''){
					echo  number_format($row['precio4'],4);	
			  }else{
				   if ($row['moneda']=='02'){
					echo  number_format($row['precio4'] * $tp,4);					
					}
			 		if ($row['moneda']=='01'){
					echo  number_format($row['precio4'] / $tp,4);	
					}				
			  }?></td>
              <?php } if($precio5=='S'){ ?>
			  <td width="70" class="texto1" align="right"><?php 
			  if ($row['moneda']==$moneda ||  $moneda == ''){
					echo  number_format($row['precio5'],4);	
			  }else{
				   if ($row['moneda']=='02'){
					echo  number_format($row['precio5'] * $tp,4);					
					}
			 		if ($row['moneda']=='01'){
					echo  number_format($row['precio5'] / $tp,4);	
					}				
			  }?></td>
              <?php } if($precio6=='S'){ ?>
			   <td width="58" class="texto1" align="right">
			   <?php 
			  if ($row['moneda']==$moneda ||  $moneda == ''){
					echo  number_format($row['pre_ref'],4);	
			  }else{
				   if ($row['moneda']=='02'){
					echo  number_format($row['pre_ref'] * $tp,4);					
					}
			 		if ($row['moneda']=='01'){
					echo  number_format($row['pre_ref'] / $tp,4);	
					}				
			  }?>			   </td>
              <?php } ?>
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
