<?php 
session_start();
?>
	<script language="javascript" src="miAJAXlib2.js"></script>
<?php 
	include('../conex_inicial.php');
	include('../funciones/funciones.php');
	
if($_REQUEST['excel']=="S"){
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=excel.xls");
}
?>
<?php
         
					   

$mostrar=$_POST['mostrar'];
//echo $mostrar;
if($mostrar=='SUCURSALES'){
$check=$_POST['checkbox'];
$condiciom='dt.sucursal';
}
if($mostrar=='ALMACENES POR SUCURSAL'){
$check=$_POST['chk_tiendas'];
$condiciom='dt.tienda';
}
if($mostrar=='TODOS LOS ALMACENES'){
$check=$_POST['chktds_alma'];
//echo ($check[0].$check[1].$check[2]);
$condiciom='dt.tienda';
}
?>

<?php
//$sucursal=$_POST['mostrar'];


if($mostrar=='SUCURSALES'){
$sucursal=$_POST['checkbox'];
$sucursales=mysql_fetch_array(mysql_query("Select * from sucursal where cod_suc='$sucursal'" ));
//echo $sucursales;
}


?>

      <?php

$tienda=$_POST['tienda'];
$fecha1=$_POST['fecha1'];
$fecha2=$_POST['fecha2'];
$formato=$_POST['cboformato'];
$presentacion=$_POST['cmbPres'];
$valorizar=$_POST['cmbValor'];
$ordenar=$_POST['cmbordenar'];

$cmbclas=$_POST['cmbclas'];
$cmbcat=$_POST['cmbcat'];
$cmbsub=$_POST['cmbsub'];
$chkclas=$_POST['chkclas'];
$chkcat=$_POST['chkcat'];
$chksub=$_POST['chksub'];
$cbosucursal=$_POST['cbosucursal'];

//---------------------
$agr_cla=$_POST['agr_cla'];
$agr_cat=$_POST['agr_cat'];
$agr_sub=$_POST['agr_sub'];
$cod_doc_i=$_REQUEST['chkIngresos'];
$cod_doc_s=$_REQUEST['chksalidas'];
//$check=$_POST['chk_tiendas'];
//echo $agr_cla."<b>";
//echo $agr_cat."<br>";
//echo $agr_sub."<br>";

?>

<html>

<link href="css/webuserestilo.css" rel="stylesheet" type="text/css">
<!-- -->
<link href="../styles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />


<style type="text/css">
<!--
.Estilo16 {color: #FFFFFF; font-weight: bold; font-size: 11px; font-family: Arial, Helvetica, sans-serif; }
.Estilo27 {color: #000000}
-->
</style>
<body>
<form name="form1" id="form1" method="">
<table width="897" height="422"  align="center">
   
  <tr>
    <td>
	
	<table border="0" width="800px" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4" align="left">	                            </td>
  </tr>
  <tr>
    <td colspan="4" align="right"><table width="120px" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="41" align="right" valign="top"><span class="Estilo27">Fecha</span>:</td>
          <td width="79"><?php echo date('d-m-Y')?></td>
        </tr>
        <tr>
          <td align="right"><span class="Estilo27">Hora:</span></td>
          <td><?php echo date('H:i:s A')?> </td>
      </tr>
      </table></td></tr>
  <tr>
    <td colspan="4" align="center">
	<br />
	<table width="269" height="38" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center"><span class="Estilo27">
          <strong>ROTACION DE PRODUCTOS </strong></span>	      </td>
        </tr>
      <tr>
        <td align="center"><span class="Estilo27">Al:</span><?php echo $fecha2;?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="4" align="left" class="Estilo27">COMPARATIVO ENTRE <span class="Estilo4"><?php echo $mostrar."&nbsp;"?> 
	
	<?php 
	
	$filtrosuc="''";
if($mostrar=='SUCURSALES'){
$sucursal=$_POST['checkbox'];
for($i=0;$i<count($sucursal);$i++){
$filtrosuc=$filtrosuc.",'".$sucursal[$i]."'";
}
$query="Select * from sucursal where cod_suc in (".$filtrosuc.")";
$res=mysql_query($query,$cn);
while($row=mysql_fetch_array($res)){
$des_sucu=$row['des_suc'];
echo $des_sucu;
}
}else{
	if ($cbosucursal!="-1") {
		$sql="SELECT * FROM sucursal where cod_suc='".$cbosucursal."'";
		$rs=mysql_query($sql,$cn);
		while ($reg=mysql_fetch_array($rs)){
	        $des_sucu="(".$reg["des_suc"].")";
		}
	}else{
		$des_sucu='';
	}
	echo $des_sucu;
	}	
				
	?>
		
	</span></td>
  </tr>
  <tr>
    <td align="left"><span class="Estilo27"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
    <td align="left">&nbsp;</td>
    <td align="left">&nbsp;</td>
    <td align="right"><span class="Estilo27"><span class="Estilo4"><?php 
											  if($formato==3)
											  echo "SALDOS";
											  if($formato==1)
											  echo "INGRESOS";
											  if($formato==2)
											  echo "SALIDAS";
											  
											  ?></span> &nbsp;&nbsp;&nbsp;&nbsp;</span></td>
  </tr>
  <tr>
    <td colspan="4" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center"><table width="781" height="61" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td width="58" align="center" bgcolor="#0066CC" class="Estilo16"><?php echo $_POST["Sistema"]; ?></td>
        <td width="149" align="center" bgcolor="#0066CC" class="Estilo16"><span class="Estilo8">Nombre</span></td>
        <td width="31" bgcolor="#0066CC" class="Estilo16"><span class="Estilo8">Und.</span></td>
         
			<?php
		
			//$check2=$_POST['checkbox'];
			//$check2=$_POST['chktds_alma'];

			//echo count($check)."h";
			//$filtro="";
			//echo $mostrar;
			if(count($check)>0){
				for($i=0;$i<count($check);$i++){
             //echo count($check)."contando";
					echo "<td colspan=2 bgcolor=#0066CC class=Estilo16>".$check[$i]."&nbsp;</td>";
					//$filtro=$check[$i].",".$filtro;
														
				}
			}		
			//if(count($check2)>0){
				//for($i=0;$i<count($check2);$i++){
				//	echo "<td colspan=2 bgcolor=#0066CC class=Estilo16>".$check2[$i]."&nbsp;</td>";
					//$filtro1="'".$check[$i]."'".",".$filtro1;
				//}
		//	}
			
			//echo $filtro1;
			?>
			
        <td width="116" bgcolor="#0066CC" class="Estilo16"><span class="Estilo8">Total</span></td>
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
		$filtro3=" and  p.clasificacion=cl.idclasificacion and p.categoria=ct.idcategoria and        
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
									$filtro3=" and p.clasificacion!='000' and p.categoria!='000'                                    and   p.subcategoria!='000'  ";
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
	$filtro2=" dt.cod_prod,";
	$tablas=" ,clasificacion cl,categoria ct,subcategoria sc ";
	$filtro3=' and p.clasificacion=cl.idclasificacion and p.categoria=ct.idcategoria and 
	p.subcategoria=sc.idsubcategoria   ';
	}	
	
	//echo $filtro2."<br>";
	//echo $filtro3;
	?> 
     <?php
	 $fecha1_c=formatofecha($fecha1);
	 $fecha2_c=formatofecha($fecha2);
	//////////
	if ($formato=="1"){
$filtrodocs="''";
//echo count($cod_doc_i);
	for($i=0;$i<count($cod_doc_i);$i++){
	$filtrodocs=$filtrodocs.",'".$cod_doc_i[$i]."'";	
	}
	}
	if($formato=='2'){
		$filtrodocs="''";
	//	echo count($cod_doc_s);
			for($i=0;$i<count($cod_doc_s);$i++){
			$filtrodocs=$filtrodocs.",'".$cod_doc_s[$i]."'";
			}
	}
	if($formato=='3'){
	$filtrodocs="''";
			  $union=array_merge($cod_doc_i,$cod_doc_s);
              for($i=0;$i<count($union);$i++){
			  $filtrodocs=$filtrodocs.",'".$union[$i]."'";
			  }	
	}
	
	  $filtromostrar='';
	 if($formato!='3'){  
	  
	  //echo $mostrar;
//	  echo count($check);
		 if(count($check)>0){	
			 for($i=0;$i<count($check);$i++){
			  // $tienda = $check[$i];
			/* $strSQL2="select det_mov.cod_prod, nom_prod, unidades.nombre, sum( if( tipo ='".$formato."', cantidad, 0 ) ) as cant from det_mov,producto,unidades where unidades.id=producto.und and idproducto=det_mov.cod_prod and  tienda in ('".$tienda."') group by det_mov.cod_prod " ;
			*/ 
			//echo count($check)."<br>";
			$filtromostrar=$filtromostrar.(",sum( if( dt.flag_kardex = '".$formato."' AND  ".$condiciom." ='".$check[$i]."' and if(cm.flag_r='RA' and (SELECT kardex from cab_mov where cod_cab=(SELECT cod_cab_ref
		FROM referencia r
		WHERE r.cod_cab = cm.cod_cab))='S',false,true) , if(p.subunidad='S' and dt.unidad!=p.und,cantidad*(select factor from unixprod where producto=dt.cod_prod and unidad=dt.unidad ), cantidad) , 0 ) ) AS '".$check[$i]."'");
			// echo $filtrotiendas;
			 
			}
		}
	}else{
	//SALDOS//
		if(count($check)>0){	
			 for($i=0;$i<count($check);$i++){
			  // $tienda = $check[$i];
			/* $strSQL2="select det_mov.cod_prod, nom_prod, unidades.nombre, sum( if( tipo ='".$formato."', cantidad, 0 ) ) as cant from det_mov,producto,unidades where unidades.id=producto.und and idproducto=det_mov.cod_prod and  tienda in ('".$tienda."') group by det_mov.cod_prod " ;
			*/ 
			//echo count($check)."<br>";
			$filtromostrar=$filtromostrar.(",sum( if( dt.flag_kardex = '1' AND ".$condiciom." ='".$check[$i]."', cantidad, 0 ) ) AS '".$check[$i]."In'");
				$filtromostrar=$filtromostrar.(",sum( if( dt.flag_kardex = '2'  AND ".$condiciom." ='".$check[$i]."', cantidad, 0 ) ) AS '".$check[$i]."Sal'");
			// echo $filtromostrar;
			 
			}
		}
	}	

//	 echo $filtromostrar."h";
	
	$strSQL2="SELECT ".$filtro2." dt.cod_prod as 'codprod', dt.nom_prod, unidades.nombre as und ".$filtromostrar." FROM det_mov dt,cab_mov cm,producto p,operacion o, unidades".$tablas."
WHERE unidades.id = p.und
AND p.idproducto = dt.cod_prod ".$filtro3." 
AND dt.cod_cab = cm.cod_cab 
AND cm.cod_ope = o.codigo 
AND dt.cod_ope=o.codigo  
AND dt.tipo=o.tipo 
AND dt.cod_ope in(".$filtrodocs.")  
AND substring(dt.fechad,1,10) between '".$fecha1_c."' and '".$fecha2_c."' 
AND (cm.deuda='S' or cm.kardex='S') 
GROUP BY ".$agrupar."dt.cod_prod,p.nombre";
	 
	//echo $strSQL2." LIMIT $inicio, $registros ";
	
		$resultados=mysql_query($strSQL2,$cn);
		//$total_registros = mysql_num_rows($resultado2); 
		//$resultados = mysql_query($strSQL2." LIMIT $inicio, $registros " ,$cn);
		//$resultados2 =mysql_num_rows($resultados);
		//$total_paginas = ceil($total_registros / $registros);  
		
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
				 
				 for($o=0;$o<count($check);$o++){
				 echo "<td  colspan='2' style='color:#FF0000' align='left'>".$tot[$o]."</td>";
				 $totalsub=$totalsub+$tot[$o];
				 }
				 // echo "<td style='color:#FF0000' align='left'>&nbsp;</td>";
				 echo "<td style='color:#FF0000' align='center'>".$totalsub."</td>";
				    $totalsub=0;	
				   
				 echo "</tr>";	
			 for($i=0;$i<count($check);$i++){
	           $tot[$i]=0;
	          }		
				$subcat2=$row2['des_subcateg'];		 
			   }	
			    if($cat2!=$row2['des_cat']){
			  	 echo"<tr style='font:bold; font:Arial, Helvetica, sans-serif; font-size:12px'>
				 <td colspan='2' style='color:#003399' align='right'>TOTAL".$cat2."</td>";
				 echo  "<td  align='left'>&nbsp;&nbsp;</td>";
				 
			 for($b=0;$b<count($check);$b++){
				echo  "<td colspan='2' style='color:#003399' align='left'>".$tot2[$b]."</td>";
				$totalcat=$totalcat+$tot2[$b];
				 }
				 echo "<td style='color:#003399'align='center'>".$totalcat."</td>";
				 $totalcat=0;
				echo "</tr>";
				
			 for($i=0;$i<count($check);$i++){
	         $tot2[$i]=0;
	         }
			  $cat2=$row2['des_cat'];
                 }		  
	  	  		
				  if($clas2!=$row2['des_clas']){
			   echo "<tr style=' font:bold ; font:Arial, Helvetica, sans-serif; font-size:12px' >
			   <td colspan='2' style='color:#006666' align='right'>TOTAL ".$clas2."</td>";
			   echo  "<td  align='left'>&nbsp;&nbsp;</td>";
			   
		 for($c=0;$c<count($check);$c++){
				 echo "<td  style='color:#006666' colspan='2' align='left'>".$tot3[$c]."</td>";
				 $totalclas=$totalclas+$tot3[$c];
				 }
				  echo "<td style='color:#006666' align='center'>".$totalclas."</td>";
				  $totalclas=0;
			  echo " </tr>";
			   for($i=0;$i<count($check);$i++){
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
		echo $row2['codprod']
		?></td>
        <td style="color:#000000" align="left"><?php 
		//echo $arr_prod[$i]
		echo $row2['nom_prod']?></td>
        <td style="color:#000000" align="center"><?php 
		//echo  $arr_und[$i]
		echo $row2['und']?></td>
     
		<?php 
		if($formato!='3'){
					 for($j=0;$j<count($check);$j++){			
				$tienda=$check[$j];
					echo "<td colspan=2 style='color:#000000' >".$row2[$tienda]."</td>";
				  $sum=$row2[$tienda];
				  $total=$total+$sum;	
				 $tot[$j]=$tot[$j]+$row2[$tienda];
				 $tot2[$j]=$tot2[$j]+$row2[$tienda];
				 $tot3[$j]=$tot3[$j]+$row2[$tienda];
				 
				}
		}else{
		 for($j=0;$j<count($check);$j++){			
				$tiendaI=$check[$j]."In";
				$tiendaS=$check[$j]."Sal";
				$saldo=$row2[$tiendaI]-$row2[$tiendaS];				
               echo "<td colspan=2 style='color:#000000' >".$saldo."</td>";
				  $sum=$saldo;
				  $total=$total+$sum;	
				 $tot[$j]=$tot[$j]+$saldo;
				 $tot2[$j]=$tot2[$j]+$saldo;
				 $tot3[$j]=$tot3[$j]+$saldo;
				 
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
				 for($a=0;$a<count($check);$a++){
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
				 for($b=0;$b<count($check);$b++){
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
			  for($c=0;$c<count($check);$c++){
			   echo "<td colspan='2' style='color:#006666' align='left'>".$tot3[$c]."</td>";
			   $sumclas=$sumclas+$tot3[$c];
			  }
			  echo "<td  style='color:#006666' align='center'>".$sumclas."</td>";
			  echo " </tr>";
			     $clas2=$row2['des_clas'];
	
       }
} 
	  ?>
      
      
    </table>    </td>	
  </tr>
  
  
  
  <tr>
    <td colspan="4" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" valign="top">&nbsp;</td>
  </tr>
</table>    </td>
  </tr>
</table>
</form>
</body>
</html>
<script language="javascript">
function cargar_detalle(pagina){
	var mostrar2=document.form1.mostrar2.value;
	var checkbox=document.form1.checkbox.value;
	var chk_tiendas=document.form1.chk_tiendas.value;
	var chktds_alma=document.form1.chktds_alma.value;
	var fecha1=document.form1.fecha1.value;
	var fecha2=document.form1.fecha2.value;
	var cboformato=document.form1.cboformato.value;
	var cmbPres=document.form1.cmbPres.value;
	var cmbValor=document.form1.cmbValor.value;
	var cmbordenar=document.form1.cmbordenar.value;
	var cmbclas=document.form1.cmbclas.value;
	var cmbcat=document.form1.cmbcat.value;
	var cmbsub=document.form1.cmbsub.value;
	var chkclas=document.form1.chkclas.value;
	var chksub=document.form1.chksub.value;
	var chkcat=document.form1.chkcat.value;
	var cbosucursal=document.form1.cbosucursal.value;
	var agr_cla=document.form1.agr_cla.value;
	var agr_cat=document.form1.agr_cat.value;
	var agr_sub=document.form1.agr_sub.value;
	var chkIngresos=document.form1.chkIngresos.value;
	var chkSalidas=document.form1.chkSalidas.value;
	
	doAjax('rpt_comp_stock_paginacion.php','fecha1='+fecha1+'&fecha2='+fecha2+'&mostrar2='+mostrar2+'&checkbox='+checkbox+'&chk_tiendas='+chk_tiendas+'&chktds_alma='+chktds_alma+'&cboformato='+cboformato+'&cmbPres='+cmbPres+'&cmbValor='+cmbValor+'&cmbordenar='+cmbordenar+'&cmbclas='+cmbclas+'&cmbcat='+cmbcat+'&cmbsub='+cmbsub+'&chkclas='+chkclas+'&chksub='+chksub+'&chkcat='+chkcat+'&cbosucursal='+cbosucursal+'&agr_cla='+agr_cla+'&agr_cat='+agr_cat+'&agr_sub='+agr_sub+'&chkIngresos='+chkIngresos+'&chksalidas='+chkSalidas+'&pagina='+pagina,'view_det','get','0','1','','');
	
}
function view_det(texto){
alert(texto);
var r = texto.split('?');
document.getElementById('detalle').innerHTML=r[0];
//document.form1.carga.value='N';
document.getElementById('paginacion').innerHTML=r[1];

}
</script>
 
