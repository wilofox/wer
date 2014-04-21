<?php session_start();
include('../conex_inicial.php');
include('../funciones/Recalculo.php');
include('../funciones/funciones.php');
	
	
			
			$registros = 30; 
			$pagina = $_REQUEST['pagina']; 
					   
			if ($pagina=='') { 
				$inicio = 0; 
				$pagina = 1; 
			} else { 
				$inicio = ($pagina - 1) * $registros; 
			} 
			
			$valor=$_REQUEST['valor'];
			$tienda=$_REQUEST['tienda'];
			$sucursal=$_REQUEST['sucursal'];
			$fecha=formatofecha($_REQUEST['fecha']);
			//echo $sucursal;
			if($sucursal=='0'){
			$filtro="";
			$campo_suc='costo_inven1';
			}else{
			$filtro=" where cod_suc='$sucursal' ";
			$filtrod=" and d.sucursal='$sucursal' ";
			$campo_suc='costo_inven'.$sucursal;
			if(isset($_REQUEST['precio'])){
					if($_REQUEST['precio']!='costo_inven'){
						$campo_suc=$_REQUEST['precio'];
					}else{
						$campo_suc=$_REQUEST['precio'].$sucursal;
					}
				}
			}
			
			$strSQL22="select * from tienda ".$filtro." order by cod_tienda";
			//echo $strSQL22;
			$resultado22=mysql_query($strSQL22,$cn);
			while($row22=mysql_fetch_array($resultado22)){
			 $saldos[]="saldo".$row22['cod_tienda'];
			 //echo "saldo".$row22['cod_tienda'];
			}
				
				
			if($tienda==0){			
				$sumsaldos="( ";
				for($i=0;$i<count($saldos);$i++){
				$sumsaldos=$sumsaldos." + ".$saldos[$i];
				}
				$sumsaldos.=" )";
			}else{
				$filtrod.=" and d.tienda='$tienda' ";
			$sumsaldos="saldo".$tienda;
			}
			//echo $sucursal."<br>";
			//print_r($saldos);
			
		//echo $strSQL="select *  from producto where kardex='S' and  nombre like '%$valor%' or idproducto like '%$valor%' order by nombre limit 100";
		
		$filtro_cla=$_REQUEST['filtro_cla'];
		$filtro_cat=$_REQUEST['filtro_cat'];
		$filtro_sub=$_REQUEST['filtro_sub'];
		
		if($filtro_cla!="" || $filtro_cat!="" || $filtro_sub!=""){		 
			if($filtro_cla!=""){
			$filtro1=" and p.clasificacion='$filtro_cla' ";
			}		
			if($filtro_cat!=""){
			$filtro1=$filtro1." and p.categoria='$filtro_cat' ";
			}
			if($filtro_sub!=""){
			$filtro1=$filtro1." and p.subcategoria='$filtro_sub' ";
			}			
		}
		
	$strSQL="select des_clas,des_cat,des_subcateg ,idproducto,nombre, p.* from producto p ,clasificacion ,categoria ,subcategoria where p.clasificacion=idclasificacion and p.categoria=idcategoria and p.subcategoria=idsubcategoria  and (nombre like '%$valor%' or idproducto like '%$valor%' or cod_prod like '%$valor%' ) and lotes='S' $filtro1 group by nombre,idproducto order by idproducto,nombre   ";
			//echo $strSQL;
			$j=0;
			$resultado_gen=mysql_query($strSQL,$cn);
			$resultado=mysql_query($strSQL." LIMIT $inicio, $registros ",$cn);
			//echo mysql_num_rows($resultado);
			$total_registros=mysql_num_rows($resultado_gen);
			$resultados2 =mysql_num_rows($resultado);
			$total_paginas = ceil($total_registros / $registros);
			while($row=mysql_fetch_array($resultado)){
			
			if($tienda==0 || $tienda==""){
					$tot_saldo=0;
					for($i=0;$i<count($saldos);$i++)
						//echo $saldos[$i].'-'.$row[$saldos[$i]].'<br>';
						$tot_saldo=$tot_saldo+$row[$saldos[$i]];										
			}else{
				   $campo="saldo".$tienda;				   
				   $tot_saldo=$row[$campo];				   
				   //echo $campo;
			 }	
			 //echo $tot_saldo;
			
							$strSQL4x="select * from modelo where cod_prod='".$row['idproducto']."'";
							$resultado4x=mysql_query($strSQL4x,$cn);
							$contModel=mysql_num_rows($resultado4x);
								if($contModel>0){
																
								}else{
										$resp=explode("?",recalculo2($row['idproducto'],$fecha,$filtrod,"4",""));
																																																																												     									//$resp2=explode("?",recalculo2($row['idproducto'],$fecha,$filtrod,"1",$sucursal));
//																																																																																						echo "--->";
																																																																																						
																																																																																						
										$tot_saldo=number_format($resp[0],4,'.','');			
								}
			
			
			 
			

			
			if($tot_saldo==-0)$tot_saldo=0;
			 
			 //$tot_saldo=numerb($resp[0]);
			 
			 

			 //$cos_saldo=number_format($resp2[1],4);
				
			
			// if($resp[0]!='hoy'){
				 //$tot_saldo=$resp[0];
				// $cos_saldo=number_format($resp2[1],4);
			 //}else{
			 if($row[$campo_suc]!=''){
				// $cos_saldo=number_format($row[$campo_suc],4);
				}else{
				$cos_saldo=0;
				} 
			 //}
		 
			 	$j++;
				if($j%2==0){
				$color_row='#E9F3FE';
				}else{
				$color_row='#E9F3FE';
				}
			 
			
			?>
			
<table id="lista_productos" width="720" height="20" border="0" cellpadding="0" cellspacing="0" >
  <tr bgcolor="<?php echo $color_row?>" onclick="entrada(this)" onDblClick="detalle_prod('<?php echo $row['idproducto']?>')">
    <td class="bordeCelda" width="40" align="center" valign="top"><input style="border: 0px; background:none;  " type="radio" name="xproducto" value="<?php echo $row['idproducto']?>" /></td>
    <td class="bordeCelda texto1" width="74" align="left" valign="top" ><?php echo $row['idproducto']?></td>
    <td class="bordeCelda texto1" width="115" align="left" valign="top" ><?php echo $row['cod_prod']?>&nbsp;</td>
    <td class="bordeCelda texto1" width="225" align="left" valign="top" ><?php echo caracteres(substr($row['nombre'],0,38))?></td>
     <td class="bordeCelda texto1" width="50" align="left" valign="top" colspan="2"  >&nbsp;</td>
    <td class="bordeCelda texto1" width="68" align="left" valign="top"  ><?php 
			if($tienda==0){			
				$filtroTiendas=mysql_query("Select * from tienda where substring(cod_tienda,1,1)='".$sucursal."'",$cn);
				$campo_s="(";
				while($row_tiendas=mysql_fetch_array($filtroTiendas)){
					$campo_s.="+saldo".$row_tiendas[0];
				}
				$campo_s.=") as tot_saldo";
			}else{
				$campo_s="(saldo".$tienda.") as tot_saldo";
			}
			$sql_tot=mysql_query("Select ".$campo_s." from producto where idproducto='".$row['idproducto']."'",$cn);
			$row_tot=mysql_fetch_array($sql_tot);
			echo $row_tot['tot_saldo'];
			//$resultado23=mysql_query($strSQL23,$cn);
			//$row23=mysql_fetch_array($resultado23);
			//echo $row23['nombre'];
	?></td>
    <td class="bordeCelda texto1" width="110" align="left" valign="top"  ><?php 
			$strSQL23="select * from unidades where id='".$row['und']."'";
			$resultado23=mysql_query($strSQL23,$cn);
			$row23=mysql_fetch_array($resultado23);
			echo $row23['nombre'];
			
		 ?></td>
  </tr>
  <?php
		if($tienda==0){			
			$filtroTiendaL=" and substring(tienda,1,1)='".$sucursal."'";
		}else{
			$filtroTiendaL=" and tienda='$tienda' ";
		}
		
		$strSQLLote="select * from lotes_cons where producto='".$row['idproducto']."' $filtroTiendaL ";
		$resultadoLote=mysql_query($strSQLLote,$cn);
		$cont=mysql_num_rows($resultadoLote);
		if($cont>0){
			?>
		<tr bgcolor="<?php echo $color_row?>">
        	<td class="bordeCelda" width="40" align="center" valign="top">&nbsp;</td>
		    <td class="bordeCelda texto1" width="74" align="left" valign="top" >&nbsp;</td>
		    <td class="bordeCelda texto1" width="115" align="left" valign="top" >&nbsp;</td>
		    <td class="bordeCelda texto1" width="225" align="left" valign="top" >&nbsp;</td>
            <td bgcolor="#DBDBDB" colspan="2" style="color:#000">Nro. Lote</td>
		    <td bgcolor="#DBDBDB" align="center" style="color:#000">Existencia</td>
		    <td bgcolor="#DBDBDB" align="center" style="color:#000">Fecha Venc.</td>
		</tr>
			<?php
            while($rowLotes=mysql_fetch_array($resultadoLote)){
				list($fechaLote)=mysql_fetch_row(mysql_query("select venc_lote from lotes where producto='".$row['idproducto']."' and des_lote='".$rowLotes['des_lote']."' "));
			?>
  <tr bgcolor="<?php echo $color_row?>">
    <td class="bordeCelda" width="40" align="center" valign="top">&nbsp;</td>
    <td class="bordeCelda texto1" width="74" align="left" valign="top" >&nbsp;</td>
    <td class="bordeCelda texto1" width="115" align="left" valign="top" >&nbsp;</td>
    <td class="bordeCelda texto1" width="225" align="left" valign="top" >&nbsp;</td>
     <td class="bordeCelda texto1" width="50" align="left" valign="top" colspan="2"><?php echo $rowLotes['des_lote']?></td>
    <td class="bordeCelda texto1" width="68" align="left" valign="top"  ><?php echo $rowLotes['existencia'];?></td>
    <td class="bordeCelda texto1" width="110" align="left" valign="top"  ><?php echo formatofecha($fechaLote);?></td>
  </tr>
  <?php
			}?>
		<tr height="5px" bgcolor="<?php echo $color_row?>">
        	<td class="bordeCelda" width="40" align="center" valign="top"></td>
		    <td class="bordeCelda texto1" width="74" align="left" valign="top" ></td>
		    <td class="bordeCelda texto1" width="115" align="left" valign="top" ></td>
		    <td class="bordeCelda texto1" width="225" align="left" valign="top" ></td>
            <td class="bordeCelda texto1" colspan="2" style="color:#000"></td>
		    <td class="bordeCelda texto1" align="center" style="color:#000"></td>
		    <td class="bordeCelda texto1" align="center" style="color:#000"></td>
		</tr>
        <?php
		}
			}
  ?>
</table>
|
<table width="100%" height="21" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="311" height="21" align="left" valign="bottom" style="color:#333333"><span class="Estilo10">Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (de <strong><?php echo $total_registros?></strong> productos)</span>.</td>
    <td width="116" align="right" valign="bottom" style="color:#999999"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:13px">Ir a pag. <input type="text" size="3" maxlength="3" value="<?php echo $pagina?>" onkeyup="validar_pag(this,<?php echo $total_paginas;?>);" /></font></td>
    <td width="410" align="right" valign="bottom" style="color:#999999"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:13px">
      <?php 
			  
 if(($pagina - 1) > 0) { 
 echo "<a style='cursor:pointer' onclick='buscar_prod(1)'>< Primera </a> ";
//echo "<a style='cursor:pointer' onclick='buscar_prod($pagina-1)'>< Anterior </a> "; 
} 
//$total_paginas;
if($pagina+4<=$total_paginas){
	if($pagina>4){
	$inicio=$pagina-4;
	}else{
		$inicio=1;
	}
	$mostrar=$pagina+4;
}else{
	if(($pagina!=$total_paginas) && ($pagina+4<$total_paginas)){
	$inicio=$pagina-4;
	}else{
	$inicio=1;
	}
	$temp=$total_paginas-$pagina;
	$mostrar=$pagina+$temp;
}
for ($i=$inicio; $i<=$mostrar; $i++){ 
	if ($pagina == $i) { 
		echo "<b style='color:#000000'>".$pagina."</b> "; 
	} else { 
		echo "<a style='cursor:pointer' href='#' onclick='buscar_prod($i)'>$i</a> "; 
	}
}

if(($pagina + 1)<=$total_paginas) { 
//echo " <a style='cursor:pointer' onclick='buscar_prod($pagina+1)'>Siguiente ></a>"; 
echo "<a style='cursor:pointer' onclick='buscar_prod($total_paginas)'>Ultima ></a> ";
} 

			  ?>
      <input type="hidden" name="pag" value="<?php echo $pagina?>" />
    &nbsp;&nbsp;    </font> </td>
  </tr>
</table>
<?php
//function recalculo_prod($codigo,$fechak,$filtro){
//	include('../conex_inicial.php');
//	if($fechak!=date('Y-m-d')){
//		$sql="Select d.*,c.flag_r from det_mov d,cab_mov c where cod_prod='".$codigo."' and substr(d.fechad,1,11)<'".$fechak."' $filtro and kardex!='N' and c.cod_cab=d.cod_cab and c.flag!='A' order by d.fechad asc";
//		$res=mysql_query($sql,$cn);
//		$cant=0;
//		$cost=0;
//		while($row=mysql_fetch_array($res)){
///*			if($row['numero']=='' or $row['serie']=='' or $row['cod_ope']==''){
//				continue;
//			}
//			if($row['flag_r']!='' && ($row['flag_kardex']==$row['tipo'])){
//				$strSQL_ref="select kardex from referencia r , cab_mov c where r.cod_cab='".$row['cod_cab']."' and r.cod_cab_ref=c.cod_cab and kardex='S'";
//				$resultado_ref=mysql_query($strSQL_ref,$cn);
//				$cont_ref=mysql_num_rows($resultado_ref);
//	
//				if($cont_ref>0){
//					continue;
//				}
//			}
//			if($row['flag_kardex']=='1' || $row['flag_kardex']==''){
//				$cant=$cant+$row['cantidad'];
//			}else{
//				if($row['flag_kardex']=='2'){
//					$cant=$cant-$row['cantidad'];
//				}
//			}
//			if($row['tipo']=="1" && $row['flag_kardex']==$row['tipo']){
//				$cost=$row['costo_inven'];
//			}
//		}
//		return $cant."?".$cost."?";*/
//			$act_kar_IS=$row['flag_kardex'];
//			//echo "ads<br>";
//			if($row['flag_r']!=''){
//				$strSQL_ref="select kardex from referencia r , cab_mov c where r.cod_cab='".$row['cod_cab']."' and r.cod_cab_ref=c.cod_cab and kardex='S'";
//				$resultado_ref=mysql_query($strSQL_ref,$cn);
//				$cont_ref=mysql_num_rows($resultado_ref);
//				$temp="";
//			
//				if($row['flag_kardex']!=''){
//					if($row['tipo']!=$row['flag_kardex']){
//						$temp="pasar";
//					}
//				}
//		
//		
//				if($cont_ref >0 && $temp==""){
//					//echo "<br>.Doc ".$documento." ".$numero."<br>";
//					continue;
//				}
//			
//			}
//		
//							
//			if($row['tipo']!=$act_kar_IS && $act_kar_IS!="" ){
//				$tipomov_temp=$act_kar_IS;					
//			}else{
//				$tipomov_temp=$row['tipo'];
//			}
//					
//			//if($tipomov_temp=='1'){
//			//echo "<br>".$row10['cod_cab']." ".$tipomov_temp." ".$row10['cantidad']."<br>";
//			if($tipomov_temp==1){
//				$ingresos=$row['cantidad'];
//				$total_ingresos=$total_ingresos+$ingresos;
//				$existencia=$existencia+$ingresos;
//				$salidas="";
//		    }else{	
//				$salidas=$row['cantidad'];
//				$total_salidas=$total_salidas+$salidas;
//				$existencia=$existencia-$salidas;
//				$ingresos="";
//			} 
//		}
//		//echo "<br>existencia=".$existencia."<br>";
//		return $existencia;		
//	}else{
//		return 'hoy?';
//	}
//}
?>