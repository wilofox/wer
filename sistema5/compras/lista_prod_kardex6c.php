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
			$fecha2=formatofecha($_REQUEST['fecha2']);
			
			if($sucursal==0){
			$filtro="";
			$campo_suc='costo_inven1';
			}else{
			$filtro=" where cod_suc='$sucursal' ";
			$filtrod=" and d.sucursal='$sucursal' ";
			$campo_suc='costo_inven'.$sucursal;
			}				
				
			if($tienda==0){			
			}else{
				$filtrod.=" and d.tienda='$tienda' ";
			}
			//echo $sucursal."<br>";
			//print_r($saldos);
			
		//echo $strSQL="select *  from producto where kardex='S' and  nombre like '%$valor%' or idproducto like '%$valor%' order by nombre limit 100";
		if($_REQUEST['filtro']!="-"){
			$p_campo=$_REQUEST['filtro'];
		}else{
			$p_campo="idproducto";
		}
		if($_REQUEST['valor']!=""){
		$cat=explode("|",$_REQUEST['valor']);
		for($i=0;$i<count($cat);$i++){
			if($i==0){
				$filtroct=$cat[$i];
			}else{
				$filtroct=$cat[$i]."','".$filtroct;
			}
		}
		}else{
			$filtroct="0";
		}
		$filtroclasi="";
		if($_REQUEST['clasificacion']!="" && $_REQUEST['clasificacion']!="0"){
			$filtroclasi=" and p.clasificacion='".$_REQUEST['clasificacion']."'";
		}
		if($_REQUEST['categoria']!="" && $_REQUEST['categoria']!="0"){
			$filtroclasi.=" and p.categoria='".$_REQUEST['categoria']."'";
		}

$strSQL2="select idproducto,p.* from producto p ,clasificacion ,categoria ,subcategoria where p.clasificacion=idclasificacion and p.categoria=idcategoria and p.subcategoria=idsubcategoria  and p.".$p_campo." in('".trim($filtroct)."') $filtroclasi group by nombre,idproducto order by idproducto,nombre   ";
			//echo $strSQL2."<br>";
$j=0;
$resultado22=mysql_query($strSQL2,$cn);
$con_in=0;
$prod2="";

while($row2=mysql_fetch_array($resultado22)){
		
	//$sql_det=mysql_query("Select * from det_mov where cod_prod='".$row2['idproducto']."' and date(fechad) between '$fecha' and '$fecha2' ",$cn);
	//echo "Select * from det_mov where cod_prod='".$row2['idproducto']."' and fechad between '$fecha' and '$fecha2'<br>";
	//$con_det=mysql_num_rows($sql_det);
	
	//echo $row2['idproducto']."<br>";
	
	$resp=explode("?",recalculo2($row2['idproducto'],$fecha,$filtrod,"4",""));
	$tot_saldo=$resp[0];
	$res_saldo=0;

	switch($_REQUEST['incluir']){
		case "0": $res_saldo=1;break;//if($tot_saldo!=0){$res_saldo=1;}break;
		case "1": if($tot_saldo>0){$res_saldo=1;}break;
		case "2": if($tot_saldo<0){$res_saldo=1;}break;
	}
//echo "$con_det>0";

	if($res_saldo==1){
		if($con_in==0){
			$prod2=$row2['idproducto'];
		}else{
			$prod2=$row2['idproducto']."','".$prod2;
		}
		$con_in++;
	}
}
//echo $prod2."|";
//echo "Clasificacion: ".$_REQUEST['incluir']."<br>"."Categoria: ".$_REQUEST['categoria'];
//echo $_REQUEST['fecha2']."<br>".$_REQUEST['incluir']."<br>".$_REQUEST['moneda']."<br>".$_REQUEST['orden']."<br>".$_REQUEST['filtro']."<br>".$_REQUEST['precios']."<br>".$_REQUEST['agrupar2']."<br>".$_REQUEST['agrupar1']."<br>".$filtroct;
		
	$strSQL="select des_clas,des_cat,des_subcateg ,idproducto,nombre, p.* from producto p ,clasificacion ,categoria ,subcategoria where p.clasificacion=idclasificacion and p.categoria=idcategoria and p.subcategoria=idsubcategoria and idproducto in('$prod2') group by nombre,idproducto order by idproducto,nombre   ";
			//echo $strSQL;
			$j=0;
			$resultado_gen=mysql_query($strSQL,$cn);
			$resultado=mysql_query($strSQL." LIMIT $inicio, $registros ",$cn);
			//echo mysql_num_rows($resultado);
			$total_registros=mysql_num_rows($resultado_gen);
			$resultados2 =mysql_num_rows($resultado);
			$total_paginas = ceil($total_registros / $registros);
			
			while($row=mysql_fetch_array($resultado)){
			
			/*if($tienda==0 || $tienda==""){
					$tot_saldo=0;
					for($i=0;$i<count($saldos);$i++)
						//echo $saldos[$i].'-'.$row[$saldos[$i]].'<br>';
						$tot_saldo=$tot_saldo+$row[$saldos[$i]];										
			}else{
				   $campo="saldo".$tienda;
				   $tot_saldo=$row[$campo];				   
			 }	*/
			 //echo $tot_saldo;
			 $resp=explode("?",recalculo2($row['idproducto'],$fecha,$filtrod,"3",""));
			 $resp2=explode("?",recalculo2($row['idproducto'],$fecha2,$filtrod,"2",$sucursal));
			 $resp3=explode("?",recalculo3($row['idproducto'],$fecha,$fecha2,$filtrod." and d.tipo=1","",""));
			 $resp4=explode("?",recalculo3($row['idproducto'],$fecha,$fecha2,$filtrod." and d.tipo=2","",""));
			
			// if($resp[0]!='hoy'){
				 $tot_saldo=$resp[0];
				 $cos_saldo=number_format($resp2[1],4);
			 //}else{
				// $cos_saldo=number_format($row[$campo_suc],4);
			 //}
		 
			 	$j++;
				if($j%2==0){
				$color_row='#E9F3FE';
				}else{
				$color_row='#FFFFFF';
				}
			
			?>
<table id="lista_productos" width="778" height="20" border="0" cellpadding="0" cellspacing="0" >
  <tr bgcolor="<?php echo $color_row?>" onclick="entrada(this)" onDblClick="detalle_prod('<?php echo $row['idproducto']?>')">
    <td class="bordeCelda" width="44" align="center" valign="top"><input style="border: 0px; background:none;  " type="radio" name="xproducto" value="<?php echo $row['idproducto']?>" /></td>
    <td class="bordeCelda texto1" width="57" align="left" valign="top" ><?php echo $row['idproducto']?></td>
    <td class="bordeCelda texto1" width="276" align="left" valign="top" ><?php echo substr($row['nombre'],0,38)?></td>
    <td class="bordeCelda texto1" width="38" align="right" valign="top"  ><?php 
			$strSQL23="select * from unidades where id='".$row['und']."'";
			$resultado23=mysql_query($strSQL23,$cn);
			$row23=mysql_fetch_array($resultado23);
			echo $row23['nombre'];
			
		 ?></td>
    <td class="bordeCelda texto1" width="59" align="right" valign="top" ><?php 
	$strUni="select * from unixprod where producto='".$row['idproducto']."' ";
	//and unidad='".$row['factor']."'";		
	$resulUni=mysql_query($strUni,$cn);
	$rowUni=mysql_fetch_array($resulUni);
	//echo $tot_saldo;	
	if ($rowUni['id']==""){		 
		echo $tot_saldo;		
	}else{
		if ($rowUni['mconv']==""){		 
			$Valor = explode('.',$tot_saldo);
			echo $Valor[0];    //bien 
			//echo $Valor[1];
			//$Unidad =$row['factor']-(10-$Valor[1]);
			$Unidad =$row['factor']*$Valor[1]*$rowUni['factor'];			
			if ($Valor[1]>0){
				echo ' / '.$Unidad ;				
			}			
			
		}else{		
			echo $tot_saldo;	
		}		
	}
	?></td>
    <td class="bordeCelda texto1" width="62" align="right" valign="top" ><?php 
	$strUni="select * from unixprod where producto='".$row['idproducto']."' ";
	//and unidad='".$row['factor']."'";		
	$resulUni=mysql_query($strUni,$cn);
	$rowUni=mysql_fetch_array($resulUni);
	//echo $tot_saldo;	
	if ($rowUni['id']==""){		 
		echo $resp3[0];		
	}else{
		if ($rowUni['mconv']==""){		 
			$Valor = explode('.',$resp3[0]);
			echo $Valor[0];    //bien 
			//echo $Valor[1];
			//$Unidad =$row['factor']-(10-$Valor[1]);
			$Unidad =$row['factor']*$Valor[1]*$rowUni['factor'];			
			if ($Valor[1]>0){
				echo ' / '.$Unidad ;				
			}			
			
		}else{		
			echo $resp3[0];	
		}		
	}
	?></td>
    <td class="bordeCelda texto1" width="62" align="right" valign="top" ><?php 
	$strUni="select * from unixprod where producto='".$row['idproducto']."' ";
	//and unidad='".$row['factor']."'";		
	$resulUni=mysql_query($strUni,$cn);
	$rowUni=mysql_fetch_array($resulUni);
	//echo $tot_saldo;	
	if ($rowUni['id']==""){		 
		echo abs(number_format($resp4[0],2,".",""));		
	}else{
		if ($rowUni['mconv']==""){		 
			$Valor = explode('.',$resp4[0]);
			echo abs(number_format($Valor[0],0,".",""));    //bien 
			//echo $Valor[1];
			//$Unidad =$row['factor']-(10-$Valor[1]);
			$Unidad =$row['factor']*$Valor[1]*$rowUni['factor'];			
			if ($Valor[1]>0){
				echo ' / '.abs(number_format($Unidad,0,".","")) ;				
			}			
			
		}else{		
			echo abs(number_format($resp4[0],2,".",""));	
		}		
	}
	?></td>
    <td class="bordeCelda texto1" width="55" align="right" valign="top" ><?php 
	$strUni="select * from unixprod where producto='".$row['idproducto']."' ";
	//and unidad='".$row['factor']."'";		
	$resulUni=mysql_query($strUni,$cn);
	$rowUni=mysql_fetch_array($resulUni);
	//echo $tot_saldo;	
	$saldo_fin=$tot_saldo+$resp3[0]+$resp4[0];
	if ($rowUni['id']==""){		 
		echo number_format($saldo_fin,2,".","");		
	}else{
		if ($rowUni['mconv']==""){		 
			$Valor = explode('.',$saldo_fin);
			echo number_format($Valor[0],0,".","");    //bien 
			//echo $Valor[1];
			//$Unidad =$row['factor']-(10-$Valor[1]);
			$Unidad =$row['factor']*$Valor[1]*$rowUni['factor'];			
			if ($Valor[1]>0){
				echo ' / '.number_format($Unidad,0,".","") ;				
			}			
			
		}else{		
			echo number_format($saldo_fin,2,".","");	
		}		
	}?>
    <td class="bordeCelda texto1" width="64" align="right" valign="top"><?php 
	if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	echo $cos_saldo;
	}	
	?></td>
    <td class="bordeCelda texto1" width="61" align="right" valign="top" ><?php 
	if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	echo number_format($saldo_fin*$cos_saldo,2);
	}	
	 ?></td>
  </tr>
  <?php }?>
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