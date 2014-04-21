<?php 
	$moneda = $_REQUEST['moneda'];
	$reporte = $_REQUEST['reporte'];
	$util = $_REQUEST['util'];
	$moneda = $_REQUEST['moneda'];
 	$sucursal = $_REQUEST['sucursal'];	
 	$tienda = $_REQUEST['almacen'];
	$cliente = $_REQUEST['cliente'];	
	$ruc = $_REQUEST['ruc'];	
	$producto = $_REQUEST['producto'];	
	$respon = $_REQUEST['respon'];	
	$documento = $_REQUEST['documento'];	
 	$filtro_cla = $_REQUEST['filtro_cla'];	
 	$filtro_cat = $_REQUEST['filtro_cat'];	
	$filtro_sub = $_REQUEST['filtro_sub'];	
	$fecha1 = $_REQUEST['fecha1'];
	$fecha2 = $_REQUEST['fecha2'];			
	$ordenar = $_REQUEST['ordenar'];				
 	$cmbnum = $_REQUEST['cmbnum'];	
	$Costo = $_REQUEST['Costo'];
	$utilizar = $_REQUEST['utilizar'];
	$imprimir = $_REQUEST['imprimir'];

	//echo $documento.":<br>";
	include('../funciones/funciones.php');
	include('../conex_inicial.php');
	include('../funciones/Recalculo.php');

	//PAGINACION 1
	$registros = 50; 
	$pagina = $_REQUEST['pagina']; 

	//echo $pagina;
	if($pagina == ''){ 
		$inicio = 0; 
		$pagina = 1; 
	}else{ 
		$inicio = ($pagina - 1) * $registros; 
	}

	//------------------------------------------
	$filtro = " where sucursal ='$sucursal' ";

	if($tienda == 0){
		$filtro2 = "";
	}else{
		$filtro2 = " and tienda ='$tienda' "; 
	}

	//$filtro3 = " and auxiliar in (select codcliente from cliente where razonsocial like'%$cliente%' )";
	//$filtro4 = " and auxiliar in (select codcliente from cliente where ruc like'%$ruc%' )";
	$filtro5 = " and DM.cod_prod like '%$producto%' ";
	//$filtro6 = " and cod_cab in (select cod_cab from cab_mov where cod_vendedor like '%$respon%' ) " ;
	$documento = substr($documento,0,strlen($documento)-1)."";
	$documento = str_replace("\'", "'", $documento);
	$filtro7 = " and cod_ope in ( $documento ) ";
	//$filtro8 = " and DM.cod_prod in ( select idproducto from producto where clasificacion like '%$filtro_cla%') ";
	//$filtro9 = " and DM.cod_prod in ( select idproducto from producto where categoria like '%$filtro_cat%') ";
	//$filtro10 = " and DM.cod_prod in ( select idproducto from producto where subcategoria like '%$filtro_sub%') ";
	$filtro11 = " and substring(fechad,1,10) between '".formatofecha($fecha1)."' and '".formatofecha($fecha2)."'  ";
	//$Costo mayor a cero

	if ($Costo){
		//$filtro12=" and costo_inven > 0 ";
	}

	if($ordenar == "cod_Anexo"){
		 $order = " order by $cmbnum ";
	}else{
		 $order = " order by $ordenar ";
	}
	//echo $order;

 	$SqlConWerRK = " $filtro $filtro2 $filtro3 $filtro4 $filtro5 $filtro6 $filtro7 $filtro8 $filtr98 $filtro10 $filtro11 $filtro12 
	AND DM.cod_cab IN (SELECT cod_cab FROM cab_mov WHERE flag <> 'A')   
	" ;
?>
<style type="text/css">
<!--
.Estilo13 {color: #0767C7}
.Estilo9 {font-size: 10px;
	font-weight: bold;
}
-->
</style>
<?
if($_REQUEST['pagina']==''){
$pag=1;
}else{
$pag=$_REQUEST['pagina'];
}
?>
<input type="hidden" name="pagina" id="pagina" value="<?=$pag;?>">
<div style="padding-left:20px;">
<?
if ($reporte=='Consolidado'){
$width='700px;';
/*}elseif ($util=='cliente' and $reporte=='Detallado' ){
$width='900px;';*/
}else{
$width='810px;';
}
?>
<div id="detalle" style="width:<?=$width;?>; height:400px; overflow:auto; background-color:#FFFFFF"  >
<?

/*	RESULTADO UTILIDAD (CONSOLIDADO / PRODUCTO )	*/

if ($util=='producto' and $reporte=='Consolidado' ){ ?>
<table width="684" border="0" cellpadding="0" cellspacing="0" id="lista_productos">
<?
	$dc=explode(",",$documento);
	$resultados = mysql_query("SELECT * FROM det_mov DM ".$SqlConWerRK." GROUP BY cod_prod" ,$cn);

	$total_registros = mysql_num_rows($resultados); 
 	$strSQL = "
		SELECT 
			*,
			DM.moneda as moneda2,
			sum(cantidad) as cantidad2,
			DM.cod_prod as cod_prod,
			sum(imp_item) as tventa 
		FROM det_mov DM 
		INNER JOIN producto P ON DM.cod_prod = P.idproducto	".$SqlConWerRK."  GROUP BY DM.cod_prod ".$order."  LIMIT ".$inicio.",".$registros." ";
	$j = 0;
	$resultado = mysql_query($strSQL,$cn);

	$resultados2 = mysql_num_rows($resultado); 
	$total_paginas = ceil($total_registros / $registros); 
	
	//echo $strSQL;

	while($row=mysql_fetch_array($resultado)){
	
//	echo $row['cod_prod']."<br>";
	
		 	 	$j++;
				if($j%2==0){
				$color_row='#E9F3FE';
				}else{
				$color_row='#FFFFFF';
				}
				
?>

<?  // oculta los que no tienes costo cero



			if ($utilizar == 'true'){
				//Parte 1
				$sql = "
					SELECT * FROM det_mov WHERE cod_prod = '".$row['cod_prod']."' AND sucursal = '".$sucursal."' AND tipo='1' AND substring(fechad,1,10) <= substring('".$row['fechad']."',1,10)	ORDER BY fechad DESC ";
			
				//echo $sql."<br clear='all'>";
				
				$resultadoX = mysql_query($sql,$cn);
				$rowX = mysql_fetch_array($resultadoX);
				
				while($rowX = mysql_fetch_array($resultadoX)){
					$ConCosto = $rowX['costo_inven'];
				}
				
			}else{
				$sql = "
					SELECT * 
					FROM producto 
					WHERE idproducto = '".$row['cod_prod']."'
				";
				$resultadoX = mysql_query($sql,$cn);
				while($rowX = mysql_fetch_array($resultadoX)){
					$ConCosto = $rowX['pre_ref'];	
				}
			}


			$strSQL_dprod = mysql_query("
				SELECT 
					*,
					DM.moneda AS moneda2,
					cantidad AS cantidad2,
					DM.cod_prod AS cod_prod,
					imp_item AS tventa,
					DM.tipo
				FROM det_mov DM 
					INNER JOIN producto P ON DM.cod_prod = P.idproducto ".$SqlConWerRK."
					AND DM.cod_prod='".$row['cod_prod']."'",$cn);

			$cantidad_2 = 0;
			$TotCosto2 = 0;
			$CostoRk = '';
			$TotVenta = 0;
			/*
			    echo " SELECT *, DM.moneda AS moneda2,cantidad AS cantidad2,
					DM.cod_prod AS cod_prod,P.igv as igvprod , imp_item AS tventa 
				FROM det_mov DM 
					INNER JOIN producto P ON DM.cod_prod = P.idproducto ".$SqlConWerRK."
					AND DM.cod_prod='".$row['cod_prod']."'<br>";
			*/
			
			//echo $contRO=mysql_num_rows($strSQL_dprod)."<br>";
			
			
			while($rw_d=mysql_fetch_array($strSQL_dprod)){
				$est_re = "";
								
				$sql_referencia = mysql_query("Select cod_ope from det_mov d inner join referencia re on re.cod_cab_ref=d.cod_cab where re.cod_cab='".$rw_d['cod_cab']."'$filtro7$filtro11",$cn);
				if(mysql_num_rows($sql_referencia) > 0){
					$est_re = "1";
				}
				
				
				if($est_re == ""){
					$sql1 = mysql_query("Select * from unixprod where producto='".$rw_d['cod_prod']."' and unidad='".$rw_d['unidad']."'");
					$rw_1 = mysql_fetch_array($sql1);
					$factor_p = 1;
					if($rw_1['factor'] != ""){
						$sql2 = mysql_query("Select * from producto where idproducto='".$rw_d['cod_prod']."'");
						$rw_2 = mysql_fetch_array($sql2);
						$factor_p = number_format($rw_1['factor'],4,".","")/number_format($rw_2['factor'],4,".","");
					}

					$res = $rw_d['cantidad'] * $factor_p;
									
					
					if($rw_d['tipo'] == $rw_d['flag_kardex'] && $rw_d['flag_kardex'] != ""){
						$cantidad_2 += number_format($res,4,".","");
					}else{
						if($rw_d['flag_kardex'] != ""){
							$cantidad_2 = $cantidad_2 - number_format($res,4,".","");
						}
					}
								
					
					//echo $rw_d['cod_prod']."-".$rw_d['imp_item']."<br>";
					$CostoRk = $rw_d['imp_item'];
					$IGV = '0';		
					
					$sql = "select * from cab_mov where cod_cab  ='".$rw_d['cod_cab']."' ";
					$resultadoX = mysql_query($sql,$cn);
					$rowX = mysql_fetch_array($resultadoX);
					
					
					//$sql_pro = mysql_query("Select * from producto where idproducto='".$rw_d['cod_prod']."'");
					//$row_pro = mysql_fetch_array($sql_pro);
					//echo $rowX['incluidoigv']." ".$row_d['igvprod']."<br>"; 
					//if ($rowX['incluidoigv'] == 'S' && $row_d['igvprod'] == 'S'){
					if ($rowX['incluidoigv'] == 'S' && $rowX['inafecto'] == 'N'){
						$IGV = $rowX['impto1'];	
					}
					
					if ($moneda == 1){
						$TotVenta2 = $CostoRk;
					}else{
						$TotVenta2 = $CostoRk * $rw_d['tc'];				
					}
					//echo $rw_d['afectoigv']."<br>"; 
					
					if ($rw_d['afectoigv'] == 'S'){
						$IGV = '1.'.$IGV;	
						$TotVenta2 = $TotVenta2/$IGV;
						 			 
					}
					
					//echo  $IGV." / ".$TotVenta2."<br>";
					
					$TotVenta += $TotVenta2;
				}

				if ($utilizar == 'true'){
					
					
					$sql = "select * from det_mov where cod_prod ='".$rw_d['cod_prod']."' and sucursal='$sucursal' and tipo='1'  and substring(fechad,1,10) <= substring('".$rw_d['fechad']."',1,10) order by fechad desc";
					//order by cod_det desc;
					$resultadoX = mysql_query($sql,$cn);
					$rowX = mysql_fetch_array($resultadoX);
					
					//echo $sql."<br>".$rowX['costo_inven']."<br>".$res."<br>";
					
					//while($rowX=mysql_fetch_array($resultadoX)){
					
					
					
					/*					
					if($sucursal == 0){
						$filtrod = "";
					}else{
						$filtrod = " and d.sucursal='$sucursal' ";
					}
				
					if($tienda != "0"){			
						$filtrod .= " and d.tienda='$tienda' ";
					}	
					//echo $rw_d['cod_prod']."  ".substr($rw_d['fechad'],0,10)." ";
					
			    	$resp2 = explode("?",recalculo2($rw_d['cod_prod'],substr($rw_d['fechad'],0,10),$filtrod,"2",$sucursal));
                    $cos_saldo = number_format($resp2[1],4);
					*/
					//echo $rowX['costo_inven']." * ".$res." = ".$TotCosto2."<br>";
					
					$TotCosto2 += ($rowX['costo_inven'] * $res);		
					//$TotCosto2 += ($cos_saldo * $res);
					//echo $cos_saldo." | ".$rw_d['tipo']."<br>";
					// echo $cos_saldo."<br>"; 
					//}

					//echo $rowX['costo_inven']." * ".$res." = ".$TotCosto2."<br>";
										
				}else{ 
					$sql = " select * from producto where idproducto ='".$rw_d['cod_prod']."'";
					$resultadoX = mysql_query($sql,$cn);
					while($rowX = mysql_fetch_array($resultadoX)){
						 $TotCosto2 += $rowX['pre_ref'] * $res;		
					}
				}
				  
				
			}

			//echo "<br>-<br>";

			if ($Costo == 'true'){
				if ($ConCosto == 0 ){					
					$color_row = '#00000';
					//$C=$C+1;
					//$C rem paginacion
				}
			}

		if ($color_row <> '#00000'){
			?>
			<tr bgcolor="<?php echo $color_row?>">
			
				<td width="10" align="center">&nbsp;</td>

				<?php if($imprimir=='true'){ ?>
					<td width="126" align="center" class="texto1" ><?php echo $row['cod_prod']?></td>
				<?php }else{ ?>
					<td width="126" class="texto1" align="center">
						<?php
							$sql="select * from producto where idproducto  ='".$row['cod_prod']."' ";
							$resultadoX=mysql_query($sql,$cn);
							while($rowX=mysql_fetch_array($resultadoX)){
								echo $rowX['cod_prod'];
							}
						?>
					</td>
				<?php } ?>
				
				<td width="199" class="texto1" title="<?=$row['nom_prod'];?>"><? echo substr($row['nom_prod'], 0, 30)  ?></td>	
						             
				<td width="67" align="center" class="texto1"><? echo $cantidad_2;//echo $row['cantidad2'] ?></td>
				
				<td width="70" align="right" class="texto1"><?php 
					// $sql2="select *,DM.moneda as moneda2,CASE WHEN DM.moneda = '02' THEN DM.imp_item * DM.tcambio ELSE DM.imp_item END AS imp_item2 from cab_mov CM inner join det_mov DM on CM.cod_cab=DM.cod_cab where  cod_prod='".$row['cod_prod']."' and DM.cod_ope in ( $documento ) $filtro11 AND DM.cod_cab IN (SELECT cod_cab FROM cab_mov WHERE flag <> 'A')"; // $SqlConWerRK						
					echo  number_format($TotVenta,2);	
					//echo $row['tcosto'];
					$TolVentaG+= number_format($TotVenta,2, '.', '');	
					//$TolVentaG+=$TotVenta;
					?>
				</td>
				
				
				
				
				
				
				<td width="81" align="right" class="texto1"><?php 	
				
					// TOTAL COSTO	
					//echo $utilizar;
					if ($moneda==1){
						$TotCosto = $TotCosto2;
					}else{
						$TotCosto = $TotCosto2 * $rw_d['tc'];				
					}
					echo number_format($TotCosto,2);	
					// echo  $TotCosto='0';
					$TolCostoG += number_format($TotCosto,2, '.', ''); //$TotCosto;
				?>
				</td>
				
				
				
				
				
				<td width="65" align="right" class="texto1"><?php 
					/*if ($TotCosto==0){
					$Utilidad=0;
					}else*/
					//echo number_format($TotCosto,2, '.', '')."<br>";
					if ($TotVenta == 0){
						$Utilidad = 0;
					}else{
						$Utilidad = number_format($TotVenta,2, '.', '') - number_format($TotCosto,2, '.', '');
					}
					//  $Utilidad=$TotCosto-$TotVenta;
					//  echo  number_format($Utilidad,2);	
					echo $Utilidad;
					$UtilidadG += number_format($Utilidad,2, '.', '');
					?>
				</td>
				
				
				
				
				<td width="66" align="right" class="texto1">
					<?php   
						if ($TotVenta<>0){
							echo  number_format(($Utilidad*100)/$TotVenta,2);
						}else{
							echo '100';
						} 
					?>
				</td>

			</tr>
	
  <?php }}	?>
</table>

<?
}elseif ($util=='producto' and $reporte=='Detallado' ){
?>
<table width="800" border="0" cellpadding="0" cellspacing="0" id="lista_productos">
<?
	$resultados = mysql_query("select * from det_mov DM  $SqlConWerRK  " ,$cn);
	$total_registros = mysql_num_rows($resultados); 
	//,DM.cod_prod as cod_prod
 	$strSQL="select *,DM.moneda as moneda2, DM.precio as precio2 from det_mov DM 	
	INNER JOIN producto P ON DM.cod_prod = P.idproducto		
	 $SqlConWerRK  $order LIMIT $inicio, $registros";
	//echo $strSQL;
	$j=0;
	$resultado=mysql_query($strSQL,$cn);

	$resultados2 =mysql_num_rows($resultado); 
	$total_paginas = ceil($total_registros / $registros); 
	

	while($row=mysql_fetch_array($resultado)){
		$est_re="";
		$sql_referencia=mysql_query("Select cod_ope from det_mov d inner join referencia re on re.cod_cab_ref=d.cod_cab where re.cod_cab='".$row['cod_cab']."'$filtro7$filtro11",$cn);
		if(mysql_num_rows($sql_referencia)>0){
			$est_re="1";
		}
	if($est_re==""){
		$j++;
		if($j%2==0){
			$color_row='#E9F3FE';
		}else{
			$color_row='#FFFFFF';
		}
?> 
<?  // oculta los que no tienes costo cero
		if ($utilizar=='true'){
			$sql=" select * from det_mov where cod_prod ='".$row['idproducto']."' and sucursal='$sucursal' and tipo='1'  and substring(fechad,1,10) <= substring('".$row['fechad']."',1,10) order by fechad desc";
			$resultadoX=mysql_query($sql,$cn);
			$rowX=mysql_fetch_array($resultadoX);
			$ConCosto =$rowX['costo_inven'];
		}else{ 
 			$sql=" select * from producto where idproducto ='".$row['idproducto']."'";
			$resultadoX=mysql_query($sql,$cn);
			while($rowX=mysql_fetch_array($resultadoX)){
				 $ConCosto=$rowX['pre_ref'];		
			}
		}
		if ($Costo=='true'){
			if ($ConCosto==0 ){					
				$color_row='#00000';
			}
		}
			
	if ($color_row<>'#00000'){	
	  ?>
  <tr bgcolor="<?php echo $color_row?>" >
	<td width="7" align="center">&nbsp;</td>
	<td width="17" align="center" class="texto1" ><?php echo $row['cod_ope']?></td>
	<td width="70" align="center" class="texto1" ><?php echo $row['serie']."-".$row['numero']?></td>
	<td width="59" align="center" class="texto1" ><?php echo formatofecha(substr($row['fechad'],0,10))?></td>
	<?php if($imprimir=='true'){ ?>
	<td width="93" align="center" class="texto1" ><?php echo $row['cod_prod']?></td>
	<?php }else{ ?>
    <td width="93" align="center" class="texto1">
	<?php $sql="select * from producto where idproducto  ='".$row['cod_prod']."' ";
	$resultadoX=mysql_query($sql,$cn);
	while($rowX=mysql_fetch_array($resultadoX)){
		echo $rowX['cod_prod'];
	}?></td>
	<?php } ?>
	<td width="165" class="texto1" title="<?=$row['nom_prod'];?>"><? echo substr($row['nom_prod'], 0, 25)  ?></td>		
	<td width="48" align="center" class="texto1"><? echo $row['cantidad'] ?></td>
	<td width="51"  align="right"  class="texto1">
	<?php $IGV='';		
	$sql="select * from cab_mov where cod_cab  ='".$row['cod_cab']."' ";
	$resultadoX=mysql_query($sql,$cn);
	while($rowX=mysql_fetch_array($resultadoX)){
		if ($rowX['incluidoigv']=='S'){
			$IGV=$rowX['impto1'];	
		}
	}	
	$CostoRk='';
	if ($row['moneda2']=='01'){ //soles
		$CostoRk=$row['precio2'];
	}else{			  	//doleres
		$CostoRk=$row['precio2']*$row['tcambio'];
	}
	if ($moneda==1){
		$TotCosto= $CostoRk;
	}else{
		$TotCosto= $CostoRk *$row['tcambio'];				
	}
			    //si acefta el igv
	if ($row['afectoigv']=='S'){
		$IGV= '1.'.$IGV;	
		$TotCosto=$TotCosto/$IGV;	
	}
	echo  number_format($TotCosto,2);				  
	?></td>
	<td width="59"  align="right"  class="texto1" >
	<?php
    	if ($utilizar=='true'){
			$sql=" select * from det_mov where cod_prod ='".$row['idproducto']."' and sucursal='$sucursal' and tipo='1'  and substring(fechad,1,10) <= substring('".$row['fechad']."',1,10) order by fechad desc";
			$resultadoX=mysql_query($sql,$cn);
			$rowX=mysql_fetch_array($resultadoX);
			$TotVenta=$rowX['costo_inven'] ;		
		}else{ 
			$sql=" select * from producto where idproducto ='".$row['idproducto']."'";
			$resultadoX=mysql_query($sql,$cn);
			while($rowX=mysql_fetch_array($resultadoX)){
				$TotVenta=$rowX['pre_ref'];		
			}
		}    
		if ($moneda==1){
			$TotVenta= $TotVenta;
		}else{
			$TotVenta= $TotVenta / $_SESSION['tc'];				
		}
		echo  number_format($TotVenta,2);
		?></td>
		<td width="67" align="right" class="texto1">
		<?php $IGV='';		
		$sql="select * from cab_mov where cod_cab  ='".$row['cod_cab']."' ";
		$resultadoX=mysql_query($sql,$cn);
		while($rowX=mysql_fetch_array($resultadoX)){
			if ($rowX['incluidoigv']=='S'){
				$IGV=$rowX['impto1'];	
			}
		}	
		$CostoRk='';
		if ($row['moneda2']=='01'){ //soles
			$CostoRk=$row['imp_item'];
		}else{			  	//doleres
			$CostoRk=$row['imp_item']*$row['tcambio'];
		}
		//echo $CostoRk;
		if ($moneda==1){
			$TotCosto= $CostoRk;
		}else{
			$TotCosto= $CostoRk / $_SESSION['tc'];				
		}
		//si acefta el igv
		if ($row['afectoigv']=='S'){
		//$TotCosto=$TotCosto+(($TotCosto*$IGV)/100);			 
			$IGV= '1.'.$IGV;	
			$TotCosto=$TotCosto/$IGV;
		}
		echo  number_format($TotCosto,2);	
		//$TolVentaG+=$TotCosto;
		$TolVentaG+=number_format($TotCosto,2, '.', '');
		?></td>
		<td width="61" align="right" class="texto1"><?php 
			if ($utilizar=='true'){
				$sql="select * from det_mov where cod_prod ='".$row['idproducto']."' and sucursal='$sucursal' and tipo='1'  and substring(fechad,1,10) <= substring('".$row['fechad']."',1,10) order by fechad desc";
				$resultadoX=mysql_query($sql,$cn);
				$rowX=mysql_fetch_array($resultadoX);
				$TotVenta=$rowX['costo_inven'] * $row['cantidad'];		
			}else{ 
				$sql=" select * from producto where idproducto ='".$row['idproducto']."'";
				$resultadoX=mysql_query($sql,$cn);
				$rowX=mysql_fetch_array($resultadoX);
				$TotVenta=$rowX['pre_ref'] * $row['cantidad'];		
			}
			if ($moneda==1){
				$TotVenta= $TotVenta;
			}else{
				$TotVenta= $TotVenta / $row['tc'];				
			}
			echo  number_format($TotVenta,2);			  
			$TolCostoG+=number_format($TotVenta,2, '.', '');
			?></td>
			<td width="61" align="right" class="texto1"><?php 
			if ($TotCosto==0){
				$Utilidad=0;
			}else{
				$Utilidad=number_format($TotCosto,2, '.', '')-number_format($TotVenta,2, '.', '');
			}
			echo $Utilidad;
			$UtilidadG+=number_format($Utilidad,2, '.', '');	
			?></td>
			<td width="61" align="right" class="texto1"><?php   
				if ($TotVenta<>0){
					echo  number_format(($Utilidad*100)/$TotVenta,2);
				}else{
					echo '100';
				}
			?></td>
		</tr>
	<?php }}}?>
</table>
<?
}elseif ($util=='cliente' and $reporte=='Consolidado' ){
?>
<table width="683" border="0" cellpadding="0" cellspacing="0" id="lista_productos">
<?
	$resultados = mysql_query("select * from det_mov DM  $SqlConWerRK   group by auxiliar" ,$cn);
	$total_registros = mysql_num_rows($resultados); 
    $strSQL="select *,DM.moneda as moneda2 ,sum(cantidad) as cantidad2,sum(imp_item) as tventa from det_mov    
	DM inner join cliente C on DM.auxiliar =C.codcliente
	INNER JOIN producto P ON DM.cod_prod = P.idproducto	
	$SqlConWerRK   group by auxiliar $order LIMIT $inicio, $registros";
	//echo $strSQL;
	$j=0;
	$resultado=mysql_query($strSQL,$cn);

	$resultados2 =mysql_num_rows($resultado); 
	$total_paginas = ceil($total_registros / $registros); 
	
	while($row=mysql_fetch_array($resultado)){
		 	 	$j++;
				if($j%2==0){
				$color_row='#E9F3FE';
				}else{
				$color_row='#FFFFFF';
				}
?>  
<?  // oculta los que no tienes costo cero
   	if ($utilizar=='true'){
			//Parte 2
					   $sql=" select * from det_mov 
					   where cod_prod ='".$row['idproducto']."'
					   and sucursal='$sucursal' and tipo='1'  and substring(fechad,1,10) <= substring('".$row['fechad']."',1,10)
					   order by fechad desc
						";
						$resultadoX=mysql_query($sql,$cn);
						$rowX=mysql_fetch_array($resultadoX);
						//while($rowX=mysql_fetch_array($resultadoX)){
							$ConCosto =$rowX['costo_inven'];
						//}	
			 }else{ 
						$sql=" select * from producto 
					   where idproducto ='".$row['idproducto']."'
						";
						$resultadoX=mysql_query($sql,$cn);
						$rowX=mysql_fetch_array($resultadoX);
							$ConCosto=$rowX['pre_ref'];	
						
			 }  	
 			
			if ($Costo=='true'){
				if ($ConCosto==0 ){					
					$color_row='#00000';
					//$C=$C+1;
					//$C rem paginacion
				}
			}
			
 	if ($color_row<>'#00000'){	
	  ?>
  <tr bgcolor="<?php echo $color_row?>" >
      <td width="10" align="center">&nbsp;</td>
      <td width="54" align="center" class="texto1" ><?php echo $row['auxiliar']?></td>
              <td width="81" class="texto1" align="center">
			   <?php 
$sql="select * from cliente 
where codcliente  ='".$row['auxiliar']."' ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
echo $rowX['ruc'];
}	
?>		      </td>
              <td width="253" class="texto1" >
			   <?php 
$sql="select * from cliente 
where codcliente  ='".$row['auxiliar']."' ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
echo $rowX['razonsocial'];
}	
			    ?>			  </td>			             
              <td width="70" align="right" class="texto1">
			  <?php
			    $IGV='';		
				$sql="select * from cab_mov 
				where cod_cab  ='".$row['cod_cab']."' ";
				$resultadoX=mysql_query($sql,$cn);
				while($rowX=mysql_fetch_array($resultadoX)){
					if ($rowX['incluidoigv']=='S'){
						$IGV=$rowX['impto1'];	
					}
				}	

			  $CostoRk='';
			  if ($row['moneda2']=='01'){ //soles
			  	$CostoRk=$row['tventa'];
			  }else{			  	//doleres
			  	 $CostoRk=$row['tventa']*$row['tcambio'];
			  }
				//echo $CostoRk;
				if ($moneda==1){
				$TotVenta= $CostoRk;
				}else{
				$TotVenta= $CostoRk / $_SESSION['tc'];				
				}
			    //si acefta el igv
			   if ($row['afectoigv']=='S'){
			   //$TotVenta=$TotVenta+(($TotVenta*$IGV)/100);
			   $IGV= '1.'.$IGV;	
			    $TotVenta=$TotVenta/$IGV;
			   }
			  echo  number_format($TotVenta,2);
			  //$TolVentaG+=$TotVenta;
			  $TolVentaG+=number_format($TotVenta,2, '.', '');	
			  ?></td>
              <td width="85" align="right" class="texto1"><?php 
			if ($utilizar=='true'){
					
					  /*echo $sql=" select * from det_mov 
					  where cod_prod ='".$row['idproducto']."'				  
					  and sucursal='$sucursal'
					   order by cod_det desc ";*/
				//$TotCosto=$rowX['costo_inven'] * $row['cantidad2'];
						 
						$sql="select * from det_mov where auxiliar='".$row['auxiliar']."'
						 
						 $filtro7 $filtro11						 
						  ";//$SqlConWerRK					
						$TotCosto=0;
						$resultadoX=mysql_query($sql,$cn);
						while($rowX=mysql_fetch_array($resultadoX)){							
							 //echo $rowX['cantidad'];
							 $sql2="select * from det_mov where cod_prod ='".$row['idproducto']."'
					   and sucursal='$sucursal' and tipo='1'  and substring(fechad,1,10) <= substring('".$row['fechad']."',1,10)
					   order by fechad desc
						";		
							  $resultado2=mysql_query($sql2,$cn);
							  $row2=mysql_fetch_array($resultado2);
							  		$TotCosto+=$row2['costo_inven'] * $rowX['cantidad'];
							  
						}
						
						
			 }else{ 
 						$sql=" select * from producto 
					   where idproducto ='".$row['idproducto']."'
						";
						$resultadoX=mysql_query($sql,$cn);
						while($rowX=mysql_fetch_array($resultadoX)){
							 $TotCosto=$rowX['pre_ref'] * $row['cantidad2'];		
						}
			 } 
			  
			 	if ($moneda==1){
				$TotCosto= $TotCosto;
				}else{
				$TotCosto= $TotCosto / $_SESSION['tc'];				
				}
		   echo  number_format($TotCosto,2);
			//$TolCostoG+=$TotCosto;
			$TolCostoG+=number_format($TotCosto,2, '.', '');			 		  
			  ?></td>
			  <td width="65" align="right" class="texto1"><?php 
			   /*if ($TotCosto==0){
			  	 $Utilidad=0;
			  }else*/if ($TotVenta==0){
				 $Utilidad=0;
			  }else{
			   //$Utilidad=$TotVenta-$TotCosto;
			   $Utilidad=number_format($TotVenta,2, '.', '')-number_format($TotCosto,2, '.', '');
			  }
				echo $Utilidad;
			  $UtilidadG+=number_format($Utilidad,2, '.', '');	
			  ?></td>
			  <td width="65" align="right" class="texto1"><?php   
			   if ($TotVenta<>0){
			   echo  number_format(($Utilidad*100)/$TotVenta,2);
			   }else{
			   echo '100';
			   }
			  ?></td>
    </tr>
  
  <?php }}?>
</table>
<?
}elseif ($util=='cliente' and $reporte=='Detallado' ){
?>

<?
	$resultados = mysql_query("select * from det_mov DM $SqlConWerRK  group by auxiliar " ,$cn);
	$total_registros = mysql_num_rows($resultados); 
	$strSQL="select * from det_mov 	
	 DM inner join cliente C on DM.auxiliar =C.codcliente
  $SqlConWerRK group by auxiliar  $order  LIMIT $inicio, $registros";
	//echo $strSQL;
	$j=0;
	$resultadoT=mysql_query($strSQL,$cn);

	$resultados2 =mysql_num_rows($resultadoT); 
	$total_paginas = ceil($total_registros / $registros); 
	
	while($rowT=mysql_fetch_array($resultadoT)){
echo '&nbsp;&nbsp;&nbsp;<span style="color:#003399; font-weight:bold; font-size:13px">'.$rowT['auxiliar'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

		$sql="select * from cliente where codcliente='".$rowT['auxiliar']."' ";
		$resultadoC=mysql_query($sql,$cn);
		while($rowC=mysql_fetch_array($resultadoC)){
		echo $rowC['razonsocial'].'</span><br>';
		}
?>

<table width="800" border="0" cellpadding="0" cellspacing="0" id="lista_productos">
<?


	$j=0;
   $sql="select * from det_mov where auxiliar='".$rowT['auxiliar']."' $filtro7 $filtro11 
   AND cod_cab IN (SELECT cod_cab FROM cab_mov WHERE flag <> 'A')   
    ";
   $resultado=mysql_query($sql,$cn);
	while($row=mysql_fetch_array($resultado)){
		 	 	$j++;
				if($j%2==0){
				$color_row='#E9F3FE';
				}else{
				$color_row='#FFFFFF';
				}
?>  
<?  // oculta los que no tienes costo cero
		if ($utilizar=='true'){
					  $sql=" select * from det_mov 
					   where cod_prod ='".$row['idproducto']."'
					   and sucursal='$sucursal' and tipo='1'  and substring(fechad,1,10) <= substring('".$row['fechad']."',1,10)
					   order by fechad desc
						";
						$resultadoX=mysql_query($sql,$cn);
						$rowX=mysql_fetch_array($resultadoX);
						//while($rowX=mysql_fetch_array($resultadoX)){
							$ConCosto =$rowX['costo_inven']; //.'<br>' * $row['cantidad'];		
						//}	
			 }else{ 
 						$sql=" select * from producto 
					   where idproducto ='".$row['cod_prod']."'
						";
						$resultadoX=mysql_query($sql,$cn);
						while($rowX=mysql_fetch_array($resultadoX)){
							 $ConCosto=$rowX['pre_ref'];			
						}
			 } 
			

		   	  
			
			if ($Costo=='true'){
				if ($ConCosto==0 ){					
					$color_row='#00000';
					//$C=$C+1;
					//$C rem paginacion
				}
			}
			
 	if ($color_row<>'#00000'){	
	  ?>
  <tr bgcolor="<?php echo $color_row?>" >
      <td width="9" align="center">&nbsp;</td>
      <td width="17" align="center" class="texto1" ><?php echo $row['cod_ope']?></td>
      <td width="68" align="center" class="texto1" ><?php echo $row['serie']."-".$row['numero']?></td>
      <td width="59" align="center" class="texto1" ><?php echo formatofecha(substr($row['fechad'],0,10))?></td>
      <?php //if(){?>
       <?php if($imprimir=='true'){ ?>
      <td width="96" align="center" class="texto1" ><?php echo $row['cod_prod']?></td>
          <?php }else{ ?>
                  <td width="96" align="center" class="texto1">
			   <?php 
$sql="select * from producto 
where idproducto  ='".$row['cod_prod']."' ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
echo $rowX['cod_prod'];
}	
?>		      </td>

			  <?php } ?>
              <td width="123" class="texto1" title="<?=$row['nom_prod'];?>"><? echo substr($row['nom_prod'], 0, 18)  ?></td>			             
              <td width="41" align="center" class="texto1"><? echo $row['cantidad'] ?></td>
              <td width="51"  align="right"  class="texto1"><?php 
			  $IGV='';		
$sql="select * from cab_mov 
where cod_cab  ='".$row['cod_cab']."'

 ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX['incluidoigv']=='S'){
		$IGV=$rowX['impto1'];	
	}
}	
			  $CostoRk='';
		      //echo $row['moneda'].'//';
			  //echo $moneda.'//';
			  if ($row['moneda']=='01'){ //soles
			  	$CostoRk=$row['precio'];
			  }else{			  	//doleres
			  	$CostoRk=$row['precio']*$row['tcambio'];
			  }
				//echo $row['precio'].'='.$CostoRk.'//';
				if ($moneda==1){
				$TotCosto= $CostoRk;
				}else{
				$TotCosto= $CostoRk / $_SESSION['tc'];				
				}
			    //si acefta el igv
			   if ($row['afectoigv']=='S'){
			   //$TotCosto=$TotCosto+(($TotCosto*$IGV)/100);	
			   $IGV= '1.'.$IGV;	
			    $TotCosto=$TotCosto/$IGV;
			   }
			  echo  number_format($TotCosto,2);				  
			  
			  ?></td>
              <td width="54"  align="right"  class="texto1" ><?php 
			  if ($utilizar=='true'){
					   $sql=" select * from det_mov 
					   where cod_prod ='".$row['idproducto']."'
					   and sucursal='$sucursal' and tipo='1'  and substring(fechad,1,10) <= substring('".$row['fechad']."',1,10)
					   order by fechad desc
						";
						$resultadoX=mysql_query($sql,$cn);
						$rowX=mysql_fetch_array($resultadoX);
						//while($rowX=mysql_fetch_array($resultadoX)){
							 $TotVenta=$rowX['costo_inven'] ;		
						//}	
			 }else{ 
 						$sql=" select * from producto 
					   where idproducto ='".$row['cod_prod']."'
						";
						$resultadoX=mysql_query($sql,$cn);
						while($rowX=mysql_fetch_array($resultadoX)){
							 $TotVenta=$rowX['pre_ref'];		
						}
			 } 
			  
			  
			   
			  
			 	if ($moneda==1){
				$TotVenta= $TotVenta;
				}else{
				$TotVenta= $TotVenta / $_SESSION['tc'];				
				}
		   echo  number_format($TotVenta,2);
			// echo '0.00';
			  ?></td>
              <td width="57" align="right" class="texto1">
			  <?php 
			  $IGV='';		
$sql="select * from cab_mov 
where cod_cab  ='".$row['cod_cab']."' ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX['incluidoigv']=='S'){
		$IGV=$rowX['impto1'];	
	}
}	
			  $CostoRk='';
		      //echo $row['moneda'].'//';
			  //echo $moneda.'//';
			  if ($row['moneda']=='01'){ //soles
			  	$CostoRk=$row['imp_item'];
			  }else{			  	//doleres
			  	$CostoRk=$row['imp_item']*$row['tcambio'];
			  }
				//echo $CostoRk;
				if ($moneda==1){
				$TotCosto= $CostoRk;
				}else{
				$TotCosto= $CostoRk / $_SESSION['tc'];				
				}
			    //si acefta el igv
			   if ($row['afectoigv']=='S'){
			   //$TotCosto=$TotCosto+(($TotCosto*$IGV)/100);
			   $IGV= '1.'.$IGV;	
			    $TotCosto=$TotCosto/$IGV;
			   }
			  echo  number_format($TotCosto,2);	
			   //$TolVentaG+=$TotCosto;	
			   $TolVentaG+=number_format($TotCosto,2, '.', '');			  
			  ?></td>
              <td width="59" align="right" class="texto1"><?php 
			if ($utilizar=='true'){
					   $sql=" select * from det_mov 
					   where cod_prod ='".$row['idproducto']."'
					   and sucursal='$sucursal' and tipo='1'  and substring(fechad,1,10) <= substring('".$row['fechad']."',1,10)
					   order by fechad desc
						";
						$resultadoX=mysql_query($sql,$cn);
						$rowX=mysql_fetch_array($resultadoX);
						//while($rowX=mysql_fetch_array($resultadoX)){
							 $TotVenta=$rowX['costo_inven'] * $row['cantidad'];		
						//}		
			 }else{ 
 						$sql=" select * from producto 
					   where idproducto ='".$row['cod_prod']."'
						";
						$resultadoX=mysql_query($sql,$cn);
						while($rowX=mysql_fetch_array($resultadoX)){
							 $TotVenta=$rowX['pre_ref']* $row['cantidad'];			
						}
			 } 
		     
			  
			 	if ($moneda==1){
				$TotVenta = $TotVenta;
				}else{
				$TotVenta = $TotVenta / $_SESSION['tc'];				
				}
		   echo number_format($TotVenta,2);			 
			// echo  $TotVenta='20000';	
			//$TolCostoG+=$TotVenta;
			$TolCostoG+=number_format($TotVenta,2, '.', '');			  
			  ?></td>
			  <td width="61" align="right" class="texto1"><?php 
			  /*if ($TotCosto==0){
			  	 $Utilidad=0;
			  }else*/if ($TotCosto == 0){
				 $Utilidad = 0;
			  }else{
			   //$Utilidad=$TotCosto-$TotVenta;
			   $Utilidad = number_format($TotCosto,2, '.', '')-number_format($TotVenta,2, '.', '');
			  }
				echo $Utilidad;
			  $UtilidadG += number_format($Utilidad,2, '.', '');	
			  ?></td>
			  <td width="58" align="right" class="texto1"><?php   
			   if ($TotVenta<>0){
			   echo  number_format(($Utilidad*100)/$TotVenta,2);
			   }else{
			   echo '100';
			   }
			  ?></td>
    </tr>
  <?php }}?>
</table>

<?
 } //cierre de consulta de agrupacion
} //cierre de filtro 
?>
</div>
</div>	  
<table width="100%" height="21" border="0" cellpadding="0" cellspacing="0" style="padding-left:20px">
  <tr>
    <td width="311" height="21" align="left" valign="bottom" style="color:#999999"><span class="Estilo29">Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (de <strong><?php echo $total_registros ?></strong> productos)</span>.</td>
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
      <input type="hidden" name="pag" value="<?php echo $pagina?>" />
      &nbsp;&nbsp; </font> </td>
  </tr>
</table>

<br>
<div style="padding-left:20px;" >
  <table width="701" border="0" cellpadding="0" cellspacing="0" style="border:#CCCCCC solid 1px">
    <tr>
      <td width="249" align="center" valign="top" style="padding-bottom:10px; padding-left:10px; padding-right:10px; padding-top:10px;"><table border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td>&nbsp;</td>
            <td><strong> Ventas </strong></td>
            <td><input name="txt1" type="text" disabled="disabled" id="txt1"  style="height:20; border-color:#CCCCCC" value="<?=number_format($TolVentaG,2);?>" autocomplete="off" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><strong>Costo</strong></td>
            <td><input name="txt2" type="text" disabled="disabled" id="txt2"  style="height:20; border-color:#CCCCCC"  value="<?=number_format($TolCostoG,2);?>" autocomplete="off" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><strong></span>Utilidad </strong></td>
            <td><input name="txt3" type="text" disabled="disabled" id="txt3"  style="height:20; border-color:#CCCCCC" value="<?=number_format($UtilidadG,2);?><? //number_format($TolVentaG-$TolCostoG,2);?>" autocomplete="off" /></td>
          </tr>
      </table></td>
      <td width="477" align="center" valign="top" style="padding-bottom:10px; padding-left:10px; padding-right:10px; padding-top:10px;"><table width="47%" height="58" border="0" align="right" cellpadding="0" cellspacing="0">
          <tr>
            <td width="63%" align="center"><table onclick="generar_inventario('excel')"  style="cursor:pointer" onmouseover="cambiar_color1(this)" onmouseout="cambiar_color2(this)" width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="center"><img  src="../imagenes/ico-excel.gif" width="22" height="22" /></td>
                </tr>
                <tr>
                  <td align="center"><span class="Estilo9 Estilo13">Exportar a Excel</span></td>
                </tr>
            </table></td>
            <td width="63%" align="center"><table style="cursor:pointer; display:none" onclick="generar_inventario('vista')" onmouseover="cambiar_color1(this)" onmouseout="cambiar_color2(this)" width="95%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="center"><span class="Estilo9"><img src="../imgenes/fileprint.png" width="22" height="22" /></span></td>
                </tr>
                <tr>
                  <td align="center"><span class="Estilo9 Estilo13">Vista Previa</span></td>
                </tr>
            </table></td>
          </tr>
      </table></td>
    </tr>
  </table>
  <br>
</div>