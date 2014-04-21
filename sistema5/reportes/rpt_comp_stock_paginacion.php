<?php 
session_start();
//////////////////////
?>
<?php 
	include('../conex_inicial.php');
	include('../funciones/funciones.php');
	?>
<?php
          $registros = 30; 
          $pagina = $_REQUEST['pagina'];
		    
		  if ($pagina=='') { 
				$inicio = 0; 
				$pagina = 1; 

				} else { 
				$inicio = ($pagina - 1) * $registros; 
				} 
					   

$mostrar=$_REQUEST['mostrar2'];
//echo $mostrar;
if($mostrar=='SUCURSALES'){
$check=$_REQUEST['checkbox'];
//echo $mostrar."<br>";
$condiciom='dt.sucursal';
}
if($mostrar=='LOCALES POR SUCURSAL'){
$check=$_REQUEST['chk_tiendas'];
//echo $_REQUEST['chk_tiendas'];
//echo $mostrar."<br>";
$condiciom='dt.tienda';
}
if($mostrar=='TODOS LOS LOCALES'){
$check=$_REQUEST['chktds_alma'];
//echo $mostrar."<br>";
//echo ($check[0].$check[1].$check[2]);
$condiciom='dt.tienda';
}
$array_check=explode('-',$check);
//echo $check."<br>";
//print_r($array_check)."<br>";
?>

<?php
//$sucursal=$_REQUEST['mostrar'];


if($mostrar=='SUCURSALES'){
$sucursal=$_REQUEST['checkbox'];
$sucursales=mysql_fetch_array(mysql_query("Select * from sucursal where cod_suc='$sucursal'" ));
//echo $sucursales;
}


?>

      <?php

//$tienda=$_REQUEST['tienda'];
$fecha1=$_REQUEST['fecha1'];
$fecha2=$_REQUEST['fecha2'];
$formato=$_REQUEST['cboformato'];
$presentacion=$_REQUEST['cmbPres'];
$valorizar=$_REQUEST['cmbValor'];
$ordenar=$_REQUEST['txtorden'];

$cmbclas=$_REQUEST['cmbclas'];
$cmbcat=$_REQUEST['cmbcat'];
$cmbsub=$_REQUEST['cmbsub'];
$chkclas=$_REQUEST['chkclas'];
$chkcat=$_REQUEST['chkcat'];
$chksub=$_REQUEST['chksub'];
$cbosucursal=$_REQUEST['cbosucursal'];

//---------------------
$agr_cla=$_REQUEST['agr_cla'];
$agr_cat=$_REQUEST['agr_cat'];
$agr_sub=$_REQUEST['agr_sub'];
$cod_doc_i=$_REQUEST['chkIngresos'];
$cod_doc_s=$_REQUEST['chkSalidas'];

				if($ordenar=='2'){
					$ordenp="order by dt.nom_prod";
				}if($ordenar=='1'){
					$ordenp="order by codprod";
				}if($ordenar=='3'){
					$ordenp="order by dt.nom_prod";
				}	
//echo $cod_doc_i."<br>";
//echo $cod_doc_s."<br>";
//echo $a=$cod_doc_i.'-'.$cod_doc_s;
//$check=$_REQUEST['chk_tiendas'];
?>
<table border="0" width="781" align="center" cellpadding="0" cellspacing="0">

      <tr>
        <td width="781" align="center"><table width="781" height="61" border="0" cellpadding="1" cellspacing="1">
            <tr>
             
		
		
		
			 
			 
 <td width="58" rowspan="2" align="center" bgcolor="#0066CC" class="Estilo16"><?php echo $_POST["Sistema"]; ?></td>
     <td width="149" rowspan="2" align="center" bgcolor="#0066CC" class="Estilo16"><span class="Estilo8">Nombre</span></td>
     <td width="31" rowspan="2" bgcolor="#0066CC" class="Estilo16" ><span class="Estilo8">Und.</span></td>
  	<?php	
			if($mostrar=='SUCURSALES'){
				$titn='Sucursales';
			}else{
				$titn='Tiendas';				
			}
		$array_check=explode('-',$check);
			
		if(count($array_check)>0){
			echo "<td colspan=".count($array_check)." align=center bgcolor=#0066CC class=Estilo16>Tiendas</td>";				
		}		
	?>			
 <td width="116" rowspan="2" bgcolor="#0066CC" class="Estilo16"><span class="Estilo8">Total</span></td>
		</tr>
	<tr>
	<?php			
		if(count($array_check)>0){
			for($i=0;$i<count($array_check);$i++){
				echo "<td bgcolor=#0066CC class=Estilo16 align=center>".$array_check[$i]."&nbsp;</td>";
			}
		}		
		?>	 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
            </tr>
            <?php
	if($cmbclas!="-1" || $cmbcat!="-1" || $cmbsub!="-1"){
		if($cmbclas!="-1"){
	    $filtro1=" and p.clasificacion='$cmbclas' ";
		}
		if($cmbcat!="-1"){
		$filtro1=$filtro1. " and p.categoria='$cmbcat' ";
		}
		if($cmbsub!="-1"){
		$filtro1=$filtro1. " and p.subcategoria='$cmbsub' ";
		}

	}
	
	///////////////////////////////////////////////////////////////////////////////
	if($agr_cla!='N' || $agr_cat!='N' || $agr_sub!='N'){
	
		if($agr_cla=='S' and $agr_cat=='S' and $agr_sub=='S'){
		$clas="999";
		//$clas2="999";
		$cat="999";
		//$cat2="999";
		$subcat="999";
		//$subcat2="999";
		$filtro2=" des_clas,des_cat,des_subcateg,";
		$filtro3="and  p.clasificacion=cl.idclasificacion and p.categoria=ct.idcategoria and        
		p.subcategoria=sc.idsubcategoria  ";
		$tablas=",clasificacion cl, categoria ct, subcategoria sc";
		$agrupar=" des_clas,des_cat,des_subcateg,";
		}else{
			if($agr_cla=='S' and $agr_cat=='S'){
			$clas="999";
			//$clas2="999";
			$cat="999";
			//$cat2="999";
			$subcat="";
			//$subcat2="999";
			$filtro2=" des_clas,des_cat, ";
			$filtro3=" and p.clasificacion=cl.idclasificacion and p.categoria=ct.idcategoria and 
			p.subcategoria!='000'  ";
			$tablas=",clasificacion cl, categoria ct ";
			$agrupar=" des_clas,des_cat,";
			}else{
				if($agr_cla=='S' and $agr_sub=='S'){
				$clas="999";
				//$clas2="999";
				$cat="";
				//$cat2="";
				$subcat="999";
				//$subcat2="999";
				$filtro2=" des_clas,des_subcateg, ";
				$filtro3=" and p.clasificacion=cl.idclasificacion and p.categoria!='000' and 
				p.subcategoria=sc.idsubcategoria  ";
				$tablas=",clasificacion cl, subcategoria sc";
				$agrupar=" des_clas,des_subcateg,";
				}else{
					if($agr_cat=='S' and $agr_sub=='S'){
					$clas="";
					//$clas2="";
					$cat="999";
					//$cat2="999";
					$subcat="999";
					//$subcat2="999";
					$filtro2=" des_cat,des_subcateg, ";
					$filtro3=" and p.clasificacion!='000' and p.categoria=ct.idcategoria and 
					p.subcategoria=sc.idsubcategoria  ";
					$tablas=",categoria ct, subcategoria sc";
					$agrupar=" des_cat,des_subcateg,";
					}else{
						if($agr_cla=='S'){
						$clas="999";
						//$clas2="999";
						$cat="";
						//$cat2="";
						$subcat="";
						//$subcat2="";
						$filtro2=" des_clas, ";
						$filtro3=" and  p.clasificacion=cl.idclasificacion and p.categoria!='000' and 
						p.subcategoria!='000'  ";
						$tablas=",clasificacion cl";
						$agrupar=" des_clas,";
						}else{
							if($agr_cat=='S'){
							$clas="";
							//$clas2="";
							$cat="999";
							//$cat2="999";
							$subcat="";
							//$subcat2="";
							$filtro2=" des_cat, ";
							$filtro3="and p.clasificacion!='000' and p.categoria=ct.idcategoria and                            p.subcategoria!='000'  
							";
							$tablas=",categoria ct";
							$agrupar=" des_cat,";
							}else{
								if($agr_sub=='S'){
								$clas="";
								//$clas2="";
								$cat="";
								//$cat2="";
								$subcat="999";
								//$subcat2="999";
								$filtro2=" des_subcateg, ";
								$filtro3=" and p.clasificacion!='000' and p.categoria!='000' and 
								p.subcategoria=sc.idsubcategoria  ";
								$tablas=",subcategoria sc";
								$agrupar=" des_subcateg,";
								}else{
									$clas="";
									//$clas2="";
									$cat="";
									//$cat2="";
									$subcat="";
									//$subcat2="";
									$filtro2=" dt.cod_prod, ";
									$filtro3=" and p.clasificacion!='000' and p.categoria!='000'  and   p.subcategoria!='000'  ";
									$tablas=" ";
									$agrupar=" ";
									
									}
		                        }
		                   }
		              }
		         }
		    }
		}
	}else{
	$filtro2=" p.cod_prod,";
	$filtro3=' and p.clasificacion=cl.idclasificacion and p.categoria=ct.idcategoria and 
	p.subcategoria=sc.idsubcategoria';
    $tablas=" ,clasificacion cl,categoria ct,subcategoria sc ";
	}	
	
	//echo $filtro2."<br>";
	//echo $filtro3;
	?>
            <?php
	 $fecha1_c=formatofecha($fecha1);
	 $fecha2_c=formatofecha($fecha2);
	//////////
	if ($formato=="1"){
//$filtrodocs="''";
//echo count($cod_doc_i);
    $array_cod_doc_i=explode('-',$cod_doc_i);
	for($i=0;$i<count($array_cod_doc_i);$i++){
	$filtrodocs=$filtrodocs."'".$array_cod_doc_i[$i]."',";	
	}
	$filtrodocs=substr($filtrodocs,0,strlen($filtrodocs)-1);
	}
	if($formato=='2'){
		//$filtrodocs="''";
	//	echo count($cod_doc_s);
	        $array_cod_doc_s=explode('-',$cod_doc_s);
			for($i=0;$i<count($array_cod_doc_s);$i++){
			$filtrodocs=$filtrodocs."'".$array_cod_doc_s[$i]."',";
			}
			$filtrodocs=substr($filtrodocs,0,strlen($filtrodocs)-1);
	}
	if($formato=='3'){
	//$filtrodocs="''";
	          $array_union=$cod_doc_i.'-'.$cod_doc_s;
			  $array_union2=explode('-',$array_union);
			  //$union=array_merge($cod_doc_i,$cod_doc_s);
              for($i=0;$i<count($array_union2);$i++){
			  $filtrodocs=$filtrodocs."'". $array_union2[$i]."',";
			  }	
			  $filtrodocs=substr($filtrodocs,0,strlen($filtrodocs)-1);
	}
	//echo "<br>";
	//echo $filtrodocs."<br>";
	
	  $filtromostrar='';
	 if($formato!='3'){  
	  
	  //echo $mostrar;
//	  echo count($check);
		 if(count($array_check)>0){	
			 for($i=0;$i<count($array_check);$i++){
			  // $tienda = $check[$i];
			/* $strSQL2="select det_mov.cod_prod, nom_prod, unidades.nombre, sum( if( tipo ='".$formato."', cantidad, 0 ) ) as cant from det_mov,producto,unidades where unidades.id=producto.und and idproducto=det_mov.cod_prod and  tienda in ('".$tienda."') group by det_mov.cod_prod " ;
			*/ 
			//echo count($check)."<br>";
			$filtromostrar=$filtromostrar.(",sum( if( dt.flag_kardex = '".$formato."' AND  ".$condiciom." ='".$array_check[$i]."' and if(cm.flag_r='RA' and (SELECT kardex from cab_mov where cod_cab=(SELECT cod_cab_ref
		FROM referencia r
		WHERE r.cod_cab = cm.cod_cab))='S',false,true) , if(p.subunidad='S' and dt.unidad!=p.und,cantidad*(select factor from unixprod where producto=dt.cod_prod and unidad=dt.unidad ), cantidad) , 0 ) ) AS '".$array_check[$i]."'");
			// echo $filtrotiendas;
			 
			}
		}
	}else{
	//SALDOS//
		if(count($array_check)>0){	
			 for($i=0;$i<count($array_check);$i++){
			  // $tienda = $check[$i];
			/* $strSQL2="select det_mov.cod_prod, nom_prod, unidades.nombre, sum( if( tipo ='".$formato."', cantidad, 0 ) ) as cant from det_mov,producto,unidades where unidades.id=producto.und and idproducto=det_mov.cod_prod and  tienda in ('".$tienda."') group by det_mov.cod_prod " ;
			*/ 
			//echo count($check)."<br>";
			$filtromostrar=$filtromostrar.(",sum( if( dt.flag_kardex = '1' AND ".$condiciom." ='".$array_check[$i]."', cantidad, 0 ) ) AS '".$array_check[$i]."In'");
				$filtromostrar=$filtromostrar.(",sum( if( dt.flag_kardex = '2'  AND ".$condiciom." ='".$array_check[$i]."', cantidad, 0 ) ) AS '".$array_check[$i]."Sal'");
			// echo $filtromostrar;
			 
			}
		}
	}	

//	 echo $filtromostrar."h";
	if($ordenar=='2'){
		$orden="order by dt.nom_prod";
	}if($ordenar=='1'){
		$orden="order by codprod";
	}if($ordenar=='3'){
		$orden="order by dt.nom_prod";
	}
	
//between '".$fecha1_c."' and '".$fecha2_c."' 	
if ($formato ==3){
  $fecRango=" between '1999-01-01' and '".$fecha2_c."' ";
  $docRengo='';
}else{
  $fecRango=" between '".$fecha1_c."' and '".$fecha2_c."' ";
  $docRengo=" AND dt.cod_ope in(".$filtrodocs.") ";
}
$strSQL2="SELECT ".$filtro2." dt.cod_prod as 'codprod', dt.nom_prod, unidades.nombre as und ".$filtromostrar." FROM det_mov dt,cab_mov cm,producto p,operacion o, unidades".$tablas."
WHERE unidades.id = p.und
AND p.idproducto = dt.cod_prod ".$filtro3." 
AND dt.cod_cab = cm.cod_cab 
AND cm.cod_ope = o.codigo 
AND dt.cod_ope=o.codigo  
AND dt.tipo=o.tipo 
$docRengo
AND substring(dt.fechad,1,10) $fecRango
AND (cm.deuda='S' or cm.kardex='S') 
GROUP BY ".$agrupar."dt.cod_prod,p.nombre ".$orden;
	
/*echo $strSQL2="SELECT ".$filtro2." dt.cod_prod as 'codprod', dt.nom_prod as 'nom_prod', unidades.nombre as und ".$filtromostrar." FROM det_mov dt,cab_mov cm,producto p,operacion o, unidades".$tablas."
WHERE unidades.id = p.und
AND p.idproducto = dt.cod_prod ".$filtro3." 
AND dt.cod_cab = cm.cod_cab 
AND cm.cod_ope = o.codigo 
AND dt.cod_ope=o.codigo  
AND dt.tipo=o.tipo 
AND dt.cod_ope in(".$filtrodocs.")  
AND substring(dt.fechad,1,10) between '".$fecha1_c."' and '".$fecha2_c."' 
AND (cm.deuda='S' or cm.kardex='S') 
GROUP BY ".$agrupar."dt.cod_prod,p.nombre ".$ordenp;*/
	 
	 
	//echo $strSQL2." LIMIT $inicio, $registros ";
	
		$resultado2=mysql_query($strSQL2,$cn);
		$total_registros = mysql_num_rows($resultado2); 
		$resultados = mysql_query($strSQL2." LIMIT $inicio, $registros " ,$cn);
		$resultados2 =mysql_num_rows($resultados);
		$total_paginas = ceil($total_registros / $registros);  
		
		$cont=0;
		//$o=999;
		 while($row2=mysql_fetch_array($resultados)){
				/*
			  $codigo=$row2['cod_prod'];
			  $nom_prod = $row2['nom_prod'];
			  $und=$row2['nombre'];
			  */
			 /* 
			  $arr_codigo[]=$row2['cod_prod'];
			  $arr_prod[]=$row2['nom_prod'];
			  $arr_und[]=$row2['nombre'];
			  
			  
			  $arr_saldo[$i][]=$row2['cant'];
			 */	  
			 
		  //}	//fin while
			  	 
				 
	
		//}//fin for
		
	//	} //fin if
		
	//print_r($arr_saldo); 
	
		// for($i=0;$i<count($arr_codigo);$i++){		 
		 ?>
            <!---Esto es Nuevo  -->
            <?php
		//totales
				if($cont==0){
				 $subcat2=$row2['des_subcateg'];
				 $cat2=$row2['des_cat'];
				 $clas2=$row2['des_clas'];
				 }
				 
				  if($subcat2!=$row2['des_subcateg']){
				
			   	 echo "<tr style='font:bold ; font:Arial, Helvetica, sans-serif; font-size:12px' >
				 <td colspan='2'  style='color:#FF0000' align='right'>TOTAL ".$subcat2.":</td>";
				echo  "<td align='left'>&nbsp;&nbsp;</td>";
				 
				 for($o=0;$o<count($array_check);$o++){
				 echo "<td  colspan='2' style='color:#FF0000' align='left'>".$tot[$o]."</td>";
				 $totalsub=$totalsub+$tot[$o];
				 }
				 // echo "<td style='color:#FF0000' align='left'>&nbsp;</td>";
				 echo "<td style='color:#FF0000' align='center'>".$totalsub."</td>";
				    $totalsub=0;	
				   
				 echo "</tr>";	
			 for($i=0;$i<count($array_check);$i++){
	           $tot[$i]=0;
	          }		
				$subcat2=$row2['des_subcateg'];		 
			   }	
			    if($cat2!=$row2['des_cat']){
			  	 echo"<tr style='font:bold; font:Arial, Helvetica, sans-serif; font-size:12px'>
				 <td colspan='2' style='color:#003399' align='right'>TOTAL".$cat2."</td>";
				 echo  "<td  align='left'>&nbsp;&nbsp;</td>";
				 
			 for($b=0;$b<count($array_check);$b++){
				echo  "<td colspan='2' style='color:#003399' align='left'>".$tot2[$b]."</td>";
				$totalcat=$totalcat+$tot2[$b];
				 }
				 echo "<td style='color:#003399'align='center'>".$totalcat."</td>";
				 $totalcat=0;
				echo "</tr>";
				
			 for($i=0;$i<count($array_check);$i++){
	         $tot2[$i]=0;
	         }
			  $cat2=$row2['des_cat'];
                 }		  
	  	  		
				  if($clas2!=$row2['des_clas']){
			   echo "<tr style=' font:bold ; font:Arial, Helvetica, sans-serif; font-size:12px' >
			   <td colspan='2' style='color:#006666' align='right'>TOTAL ".$clas2."</td>";
			   echo  "<td  align='left'>&nbsp;&nbsp;</td>";
			   
		 for($c=0;$c<count($array_check);$c++){
				 echo "<td  style='color:#006666' colspan='2' align='left'>".$tot3[$c]."</td>";
				 $totalclas=$totalclas+$tot3[$c];
				 }
				  echo "<td style='color:#006666' align='center'>".$totalclas."</td>";
				  $totalclas=0;
			  echo " </tr>";
			   for($i=0;$i<count($array_check);$i++){
	         $tot3[$i]=0;
	         }
			     $clas2=$row2['des_clas'];
			  }
		
			//titulos 
		if($clas!=$row2['des_clas']){
		$clas=$row2['des_clas'];
		echo " <tr>
    <td align='left' colspan='2' style='color:#006666 ; font:bold ; font:Arial, Helvetica, sans-serif;    
	font-size:12px'>".$clas."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
 
    </tr>
		";
		
		}
		
		if($cat!=$row2['des_cat']){
		$cat=$row2['des_cat'];
		
		echo " <tr>
    <td  align='left' colspan='2' style='color:#003399; font:bold; font:Arial, Helvetica, sans-serif; font-size:12px'>&nbsp;&nbsp;".$cat."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>


  </tr>
		";
		
		}
		 if($subcat!=$row2['des_subcateg']){
		$subcat=$row2['des_subcateg'];
	
		echo " <tr>
    <td  align='left' style='color:#FF0000 ; font:bold ; font:Arial, Helvetica, sans-serif; font-size:12px' colspan='2'>&nbsp;&nbsp;&nbsp;&nbsp;".$subcat."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>


  </tr>
		";	 
			 
		}
		
		//totales

	
		?>
            <!---Esto es el Fin de lo Nuevo -->
            <tr>
              <td style="color:#000000" align="left"><?php 
		//echo $arr_codigo[$i]
		if ($_POST["Sistema"]=='Cod. Sistema'){
			echo $row2['codprod'];
		}else{
			echo $row2['cod_prod'];
		}
		?></td>
              <td style="color:#000000" align="left"><?php 
		//echo $arr_prod[$i]
		echo $row2['nom_prod']?></td>
              <td style="color:#000000" align="center"><?php 
		//echo  $arr_und[$i]
		echo $row2['und']?></td>
              <?php 
		if($formato!='3'){
					 for($j=0;$j<count($array_check);$j++){			
				$tienda=$array_check[$j];
					echo "<td style='color:#000000' >".$row2[$tienda]."</td>";
				  $sum=$row2[$tienda];
				  $total=$total+$sum;	
				 $tot[$j]=$tot[$j]+$row2[$tienda];
				 $tot2[$j]=$tot2[$j]+$row2[$tienda];
				 $tot3[$j]=$tot3[$j]+$row2[$tienda];
				 
				}
		}else{
		 /*for($j=0;$j<count($array_check);$j++){			
				$tiendaI=$array_check[$j]."In";
				$tiendaS=$array_check[$j]."Sal";
				$saldo=$row2[$tiendaI]-$row2[$tiendaS];	
				//colspan=2			
               echo "<td style='color:#000000' >".$saldo."</td>";
				  $sum=$saldo;
				  $total=$total+$sum;	
				 $tot[$j]=$tot[$j]+$saldo;
				 $tot2[$j]=$tot2[$j]+$saldo;
				 $tot3[$j]=$tot3[$j]+$saldo;				 
				}*/	
				if(count($array_check)>0){
					for($i=0;$i<count($array_check);$i++){
						$strP="select * from producto where idproducto='".$row2['codprod']."'  ";
						$resulP=mysql_query($strP,$cn);
						$rowP=mysql_fetch_array($resulP);
						$saldo=$rowP['saldo'.$array_check[$i]];
						echo "<td style='color:#000000' align='right' >".$saldo."</td>";
						$sum=$saldo;
						$total=$total+$sum;						
					}
				}
		
		}
		 ?>
              <td  style="color:#000000" align='center'><?php echo $total?></td>
            </tr>
            <?php 
	  $total=0;
	  $cont++;
	  }

				   //$totalsub=0;
	  //pie de pagina
	  if($agr_sub=='S'){
	   if($subcat2!='999'){
				//echo "si diferente";
			   	 echo "<tr style='font:bold ; font:Arial, Helvetica, sans-serif;font-size:12px' class='Estilo28'>
				 <td colspan='2 'style='color:#FF0000' align='right'>TOTAL ".$subcat2.":</td>";
				 echo "<td align='left'>&nbsp;&nbsp;</td>";
				 for($a=0;$a<count($array_check);$a++){
				     echo "  <td colspan='2' style='color:#FF0000' align='left'>".$tot[$a]."</td>";
					 $sumsub=$sumsub+$tot[$a];
				 }
				 
			 echo "<td style='color:#006666' align='center'>".$sumsub."</td>";
			 echo "</tr>";
			 	  $subcat2=$row2['des_subcateg'];
	 }		 
}	  

if($agr_cat=='S'){
     if($cat2!='999'){		 
		
			  	 echo"<tr style='font:bold; font:Arial, Helvetica, sans-serif; font-size:12px' class='Estilo28'>
				 <td colspan='2' style='color:#003399' align='right'>TOTAL ".$cat2."</td>";
				 echo "<td  align='left'>&nbsp;&nbsp;</td>";
				 for($b=0;$b<count($arrat_check);$b++){
				 echo "<td colspan='2' style='color:#003399' align='left'>".$tot2[$b]."</td>";
				 $sumcat=$sumcat+$tot2[$b];
				 }
				 echo "<td  style='color:#003399' align='center'>".$sumcat."</td>";
				 "</tr>";
				 ///
				 $cat2=$row2['des_cat'];

	  }			  
} 	  
 if($agr_cla=='S'){
	 if($clas2!='999'){		
		
			   echo "<tr style=' font:bold ; font:Arial, Helvetica, sans-serif;               font-size:12px' class='Estilo28'>
			   <td colspan='2' style='color:#006666' align='right'>TOTAL ".$clas2."</td>";
			  echo "<td align='left'>&nbsp;&nbsp;</td>";
			  for($c=0;$c<count($array_check);$c++){
			   echo "<td colspan='2' style='color:#006666' align='left'>".$tot3[$c]."</td>";
			   $sumclas=$sumclas+$tot3[$c];
			  }
			  echo "<td  style='color:#006666' align='center'>".$sumclas."</td>";
			  echo " </tr>";
			     $clas2=$row2['des_clas'];
	
       }
} 
	  ?>
        </table></td>
      </tr>

    </table></td>
  </tr>
?
  <tr>
    <td><table width="883">
      <tr>
        <td width="617" height="26">Viendo del <?php echo $inicio+1?> al <?php echo $inicio+$resultados2 ?> (de <?php echo $total_registros?> documentos) </td>
        <td width="250"><?php 
			  
 if(($pagina - 1) > 0) { 
echo "<a style='cursor:pointer' onclick='cargar_detalle($pagina-1)'>< Anterior </a> "; 
} 

for ($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
	echo "<b style='color:#000000'>".$pagina."</b> "; 
	} else { 
	echo "<a style='cursor:pointer' href='#' onclick='cargar_detalle($i)'>$i</a> "; 
	}
}

if(($pagina + 1)<=$total_paginas) { 
echo " <a style='cursor:pointer' onclick='cargar_detalle($pagina+1)'>Siguiente ></a>"; 
} 

			  ?>
          <input type="hidden" name="pag" value="<?php echo $pagina?>" />      </tr>
    </table>


