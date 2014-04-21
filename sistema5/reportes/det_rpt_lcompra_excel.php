<? 
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=excel.xls");

//session_start();
   include('../conex_inicial.php');
   include('../funciones/funciones.php');

    $fecha1  	=   formatofecha($_REQUEST['fecha']);
	$fecha2   	=	formatofecha($_REQUEST['fecha2']);
	$sucursal	=	$_REQUEST['sucursal'];
	$tienda		=	$_REQUEST['almacen'];
	$tipo		=	$_REQUEST['tipo'];
	$cliente	=	$_REQUEST['cliente'];	
	$vendedor	=	$_REQUEST['vendedor'];
	$serie	    =	$_REQUEST['serie'];
	$turno		=	$_REQUEST['turno'];
	$temp_turno	=	$_REQUEST['turno'];
	$pagina 	= 	$_REQUEST['pagina'];
	$paginaac	= 	$_REQUEST['paginaac'];//pagina anterior
	$docRk		=	$_REQUEST['docRk'];
	$x			=	$_REQUEST['x'];
	$temdes		=	'';	
	$registros	= 	531; 
	$moneda		=	'S/.';
	$reporte    = 	'LIBRO_COMPRAS';
	

	$fec_ini=explode("-",$fecha1);
	$fec_ini2=$fec_ini[2]."-".$fec_ini[1]."-".$fec_ini[0];
	$fec_fin=explode("-",$fecha2);
	$fec_fin2=$fec_fin[2]."-".$fec_fin[1]."-".$fec_fin[0];
	
	
	if($pagina=='') 	{ 	$inicio = 0; $pagina = 1; } 
	else 				{ 	$inicio = ($pagina - 1) * $registros; 	} 
	
	
	/************************** FILTROS PRINCIPALES *********************************/
	
	//Filtro de Empresa y Sucursal ..... Sucursal depende del campo Empresa 
	if($sucursal!='0')	{	if( $tienda	==	'0'	){	$filtro5=" and sucursal='".$sucursal."' ";	}
							else				 {	$filtro5=" and sucursal='".$sucursal."' and tienda='".$tienda."' ";	}	
	}
	
	//filtro del campo vendedor		
	if($vendedor!="000"){	$filtro1=" and cod_vendedor='".$vendedor."' "; }
	
	//filtro del campo caja		
	if($serie!="000")	{	$filtro2=" and serie='".$serie."' "; }

	//filtro del campo turno
	if($turno!="000")	{
		//consulta para ver si es Manaa o Tarde
		$strsql    = "select * from turno where id='".$temp_turno."'";
		$resultado = mysql_query($strsql,$cn);
		$row	   = mysql_fetch_array($resultado);
		$filtro3   = " and substring(fecha,12,9) between '".$row['hinicio']."' and '".$row['hfin']."' ";
	}	
	//echo "Select documentos from temp where cod_user='".$_SESSION['codvendedor']."' and reporte='".$reporte."'";
	//Filtro de los campos de Tipos de Documentos
	
	$rstemp	=	mysql_query("Select documentos from temp where cod_user='".$_REQUEST['coduser']."' and reporte='".$reporte."'",$cn);
	///SI ES QUE TIENE DATOS
	if(mysql_num_rows($rstemp)==0){
		echo "NO";
	}else{
	//SINO
	$rowtemp=	mysql_fetch_array($rstemp);
	if( !empty( $rowtemp['documentos'] ) ) $filtro56 = " ".$rowtemp['documentos'];
	
	//DUDA FILTROS NO UTILIZADOS ???	
	//if($_REQUEST['tickets']=='false' and $tipo=='2'){ 	$filtro4	=	" and deuda='S' " ;}				
	//if(	$cliente!=''	)							{	$filtro6	=	" and cliente='".$cliente."' ";}
	
	/***********************************--------**************************/
			
			
	/************************CONSULTA DE LOS FILTROS *********************/
	$strSQL = "select cab_mov.*,cliente.tipo_aux,cliente.razonsocial,cliente.ruc,cliente.doc_iden,operacion.sunat 
				from cab_mov inner join cliente on cliente=codcliente inner join operacion  on operacion.codigo=cab_mov.cod_ope  and operacion.codigo in (".$filtro56.") 
				where cab_mov.tipo='".$tipo."' and substring(fecha,1,10) between '".$fecha1."' and '".$fecha2."' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$filtro6." and operacion.sunat!='' 
				group by cod_cab
				order by operacion.sunat,fecha ";
			//echo 	$strSQL;
	//Numero de filas totales			
//	echo $strSQL;
	$resultados 		= 	mysql_query( $strSQL,$cn );
	$total_registros 	= 	mysql_num_rows( $resultados ); 
	
	//NUemero de filas con el indexado ." LIMIT ".$inicio.",".$registros
	$resultados1		= 	mysql_query( $strSQL ,$cn );		
	$resultados2 		=	mysql_num_rows($resultados1); 
	$total_paginas 		= 	ceil($total_registros / $registros);  

	function mostrar_total($bi,$igv,$total,$contx,$columTotal){
		$totgen_base1=$bi;
		$totgen_igv1=$igv;
		$totgen_total1=$total;	
$datos='
<tr  >
	  <td align="left" bgcolor="#FFFFFF" >&nbsp;</td>
	  <td align="left" bgcolor="#FFFFFF" >&nbsp;</td>
	  <td align="left" bgcolor="#FFFFFF" >&nbsp;</td>
	  <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
	  <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
	  <td align="right"  bgcolor="#FFFFFF">&nbsp;</td>
	  <td colspan="6" align="right"  bgcolor="#FFFFFF">-----------------------------------------------------------------</td>
	  </tr>
<tr>
 	  <td align="left" bgcolor="#FFFFFF" >&nbsp;</td>
	  <td align="left" bgcolor="#FFFFFF" >&nbsp;</td>
	  <td align="left" bgcolor="#FFFFFF" >&nbsp;</td>
	  <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
	  <!--<td align="center" bgcolor="#FFFFFF">&nbsp;</td>-->	  
	  <td colspan="3" align="right"  bgcolor="#FFFFFF"><span class="Estilo7 Estilo33">'.$columTotal.' &nbsp;('.$contx.')</span></td>
	  <td align="right"  style="color:#FF3300; font:bold">S/.</td>
	  <td align="right"  bgcolor="#FFFFFF">'.number_format($totgen_base1,2).'</td>
	  <td align="right"  bgcolor="#FFFFFF">&nbsp;</td>
	  <td align="right"  bgcolor="#FFFFFF">'.number_format($totgen_igv1,2).'</td>
	  <td align="right"  bgcolor="#FFFFFF">'.number_format($totgen_total1,2).'</td>
</tr>	  
';
return $datos;



	}
}



//$filtro1
	$sql="Select * from sucursal where cod_suc='$sucursal'";
	$query=mysql_query($sql,$cn);
	$rowE=mysql_fetch_array($query);
	if ($rowE['des_suc']==''){ $Empr= 'Todos'; }else{$Empr= $rowE['des_suc'];}

	$sql="Select * from tienda  where cod_tienda='$tienda'";
	$query=mysql_query($sql,$cn);
	$rowE=mysql_fetch_array($query);
	//$Tiemda= $rowE['des_tienda'];
	if ($rowE['des_tienda']==''){ $Tiemda= 'Todos'; }else{$Tiemda= $rowE['des_tienda'];}	
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style>

.anulado  {text-decoration:line-through;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color:#990000; }
.Estilo10 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; }
.anulado1 {text-decoration:line-through;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#990000; }
</style>
</head>
<body>
<center>
<table  >
<tr>
<td width="93"></td>
<td>
<table  width="1263" height="265" border="1" cellpadding="1" cellspacing="1"  >
<tr><td colspan="12"><h3>
<div  align="center">Libro  de Compras/Ingreso<br/><?php echo "De :".$fec_ini2." al ".$fec_fin2 ?></div>


<div align="left">
Empresa:&nbsp;&nbsp;<?=$Empr;?><br>
Local/Tienda:&nbsp;&nbsp;<?=$Tiemda;?>
</div>

</h3>
    </td>
</tr>
	<tr  >
<td width="93"  align="center" valign="middle" bgcolor="#006699"><div align="center"><strong><span class="Estilo7 Estilo15" style="color:#FFFFFF">FECHA</span></strong></div></td>
	  <td width="57" bgcolor="#006699" ><div align="center"><strong><span class="Estilo7 Estilo15"><span class="Estilo7 Estilo15 Estilo35" style="color:#FFFFFF">Doc</span></span></strong></div></td>
	  <td width="134" bgcolor="#006699"><div align="center"><strong><span class="Estilo7 Estilo15 Estilo35" style="color:#FFFFFF">N. Documento </span></strong></div></td>
	  <td width="93"  align="center" valign="middle" bgcolor="#006699"><div align="center"><strong><span class="Estilo7 Estilo15" style="color:#FFFFFF">RUC/DNI</span></strong></div></td>
	  <td width="93"  align="center" valign="middle" bgcolor="#006699"><div align="center"><strong><span class="Estilo7 Estilo15" style="color:#FFFFFF">RAZON SOCIAL</span></strong></div></td>
	  <td width="108" align="right" bgcolor="#006699"><div align="center"><strong><span class="Estilo7 Estilo15 Estilo35" style="color:#FFFFFF">Mon.</span></strong></div></td>
	  <td width="108" align="right" bgcolor="#006699"><div align="center"><strong><span class="Estilo7 Estilo15 Estilo35" style="color:#FFFFFF">B. imp (S/.)</span></strong></div></td>
      <td width="92" align="right" bgcolor="#006699"><div align="center"><strong><span class="Estilo7 Estilo15 Estilo35" style="color:#FFFFFF">TC</span></strong></div></td>
      <td width="92" align="right" bgcolor="#006699"><div align="center"><strong><span class="Estilo7 Estilo15 Estilo35" style="color:#FFFFFF">B. imp (S/.)</span></strong></div>        </td>
      <td width="92" align="right" bgcolor="#006699"><span class="Estilo35 Estilo15 Estilo7" style="color:#FFFFFF"><strong>Inafectos</strong></span></td>
	  <td width="119" align="right" bgcolor="#006699"><span class="Estilo35 Estilo15 Estilo7" style="color:#FFFFFF"><strong>Impuesto</strong></span></td>
	  <td width="119" align="right" bgcolor="#006699"><span class="Estilo15 Estilo7" style="color:#FFFFFF"><strong>Total</strong></span></td>
	</tr>
<? 

while ( $filx = mysql_fetch_assoc( $resultados ) )  
		{ 		$fecha2		    =	substr($filx['fecha'],0,10);
			    $consultaDBA2	=	mysql_query("select * from tcambio");
				
				while ($valor2=mysql_fetch_assoc($consultaDBA2))  
				{ 	$fechaTc2 	=	$valor2["fecha"];
					$fechaTc2	=	formatofecharay($fechaTc2);
					if(	$fechaTc2 ==	$fecha2	){	$tc2	=	$valor2["venta"]; }
					//OJO CON ESTO TODOS LOS DIAS HABRIA QUE PONER EL TIPO DE CAMBIO SINO JUGARIAS CON EL TIPO DE CAMBIO Y RESULTADOS FINALES
					else 					 {  if ( $fecha2 >= $fechaTc2 )   {	$tc2	=	$valor2["venta"];	} }
				}
				if($filx['flag']!="A"){
				$consulta2	=	mysql_query("select * from det_mov where cod_cab =".$filx['cod_cab'] );
				while(  $valor2	=	mysql_fetch_assoc($consulta2) )
				{	if( $valor2['tipo'] ==  $valor2['flag_kardex'] ){  $sig = 1 ; }else { $sig = -1; } 
				}
				
				if($filx['moneda']	==	'01'	) { 
				                                      $impge += $filx['b_imp']*$sig; 	  
													  $igvge += $filx['igv']*$sig;      
													  $totalge	+=	$filx['b_imp']*$sig + $filx['igv']*$sig;
													}
				else					  		{     $impge += $filx['b_imp']*$tc2*$sig; 
				                                      $igvge +=  $filx['igv']*$tc2*$sig  ;
													  $totalge	+=	($filx['b_imp']+$filx['igv'])*$tc2*$sig;
												}
												
			 $contge++;
			 }else{
			// echo $filx['cod_cab'];
			 }
		}
			
		

		/***********************CARGAR DATOS A MOSTRAR**********************************/					
        while($row=mysql_fetch_array($resultados1)){ // aqui empieza a mostrar todos las consultas					
			$fecha		=	substr($row['fecha'],0,10);
			$fecha2		=	explode("-",$fecha);
			$td			=	$row['cod_ope'];
			$documento	=	$row['serie']." - ".$row['Num_doc'];	
			$importe  	=	$row['b_imp'];
			$igv_p	  	=	$row['impto1'];
			$igv	  	=	$row['igv'];
			$total		=	$row['total'];
			$noperacion	=	$row['noperacion'];
			$items		=	$row['items'];
			$flag		=	$row['flag'];
			$referencia	=	$row['cod_cab']; // devuelve codigo de cabezera
			$moneda		=	$row['moneda'];
			$precio		=	$row["precio"];
			$razon		=	$row['razonsocial'];
			$ruc		=	$row['ruc'];
			$ruc		=	$row['ruc'];
			$dni		=	$row['doc_iden'];
	//	echo $row['sunat'] ."-".$moneda."-".$tc ;
		if( $moneda == '02' ){	$moneda = 'US$.';	
		    //se averigua el tipo de cambio en la fecha de la compra de producto de la tabla cambio
			$consultaDBA	=	mysql_query("select * from tcambio");
			while ($valor=mysql_fetch_assoc($consultaDBA))  
			{ 	$fechaTc 	=	$valor["fecha"];
				$fechaTc	=	formatofecharay($fechaTc);
			
				if(	$fechaTc ==	$fecha	){ $tc	=	$valor["venta"];break;	}
				//OJO CON ESTO TODOS LOS DIAS HABRIA QUE PONER EL TIPO DE CAMBIO SINO JUGARIAS CON EL TIPO DE CAMBIO Y RESULTADOS FINALES
				else 					 {   if  ( $fecha >= $fechaTc )   {  $tc	=	$valor["venta"];	}else{/*$tc	=0;*/} }
			}
		}else{		$moneda = 'S/.';  }
		
		if( $row['sunat'] != $temdes ){					
			if( $x > 0 ){
				if($_REQUEST['excel']!='RKsi'){echo $tot;} //Muestra la funcion muestra_total
				$imp2=0;$igv2=0;$total2=0;$contx=0;$eje=0;  //vaciamos los valores para sumar el nuevo grupo de tipos segun sunat
			}	
			if($_REQUEST['excel']!='RKsi'){echo "<tr><td colspan='12' ><b>Codigo Sunat: ".$row['sunat']."</b></td></tr>";}
		}
	
		$igvto  =  0;$total=0;
		if( $igv  !=  0 )  {    if( $moneda == 'S/.' ) {   $igvto = $igv;          }
								else			 	   {   $igvto = $igv*$tc; 	   }
							}
		if($moneda	==	'US$.'	){	$total	=	$importe*$tc  +	$igv*$tc;         }
		else					 {  $total  =   $importe  +	$igv  		;         }
																
		$totalInafectos=0;
		$consulta2	=	mysql_query("select * from det_mov where cod_cab =".$row['cod_cab'] );
		while(  $valor2	=	mysql_fetch_assoc($consulta2) )
		{	if( $referencia	==	$valor2["cod_cab"] and $valor2["afectoigv"]	==	"N"	)
			{ 	$importeInafectos	= $valor2["precio"];
				$totalInafectos		= $importeInafectos*$valor2["cantidad"] + $totalInafectos;
			}
			if( $valor2['tipo'] ==  $valor2['flag_kardex'] ){  $sig = 1 ; }else { $sig = -1; } 
		}

        if($moneda	==	'US$.'	){	$totalInafectos	 =	$totalInafectos	*$tc;   }
	if($flag!="A"){				
	?>
	<tr  >
	  <td align="left" bgcolor="#FFFFFF" ><?php echo formatofecha($fecha); ?></td>
	  <td align="left" bgcolor="#FFFFFF" ><?php echo $td?></td>
	  <td align="left" bgcolor="#FFFFFF" ><?php echo $documento?></td>
	  <td align="center" bgcolor="#FFFFFF"><?  if ($row['sunat']=='03'){ echo $dni; }else{ echo $ruc;} ?></td>
	  <td align="center" bgcolor="#FFFFFF"><?php echo $razon?></td>
	  <td align="right"  bgcolor="#FFFFFF"><?php echo $moneda?></td>
	  <td align="right"  bgcolor="#FFFFFF"><?
	 if($moneda	==	"US$."	) {
		echo number_format($row['b_imp'],2);
	} else { echo '0.00'; 	}
	?></td>
	  <td align="center">
	<?
	 if($moneda	==	"US$."	) {
			echo $tc ; 
	} else { echo '0.00'; }
	?></td>
	  <td align="right"  bgcolor="#FFFFFF"><? echo number_format(($total-$totalInafectos-$igvto)*$sig ,2)  ?></td>
	  <td align="right"  bgcolor="#FFFFFF"><?php  echo number_format($totalInafectos*$sig ,2) ; ?></td>
	  <td align="right"  bgcolor="#FFFFFF"><?php echo number_format($igvto*$sig ,2) ?></td>
	  <td align="right"  bgcolor="#FFFFFF"><?php	echo number_format($total*$sig ,2)	?></td>
	  </tr>
 <?php }else{ ?>
   
  	<tr  >
	  <td align="left" bgcolor="#FFFFFF" ><span class="anulado1"><?php echo formatofecha($fecha); ?></span></td>
	  <td align="left" bgcolor="#FFFFFF" ><span class="anulado1"><?php echo $td?></span></td>
	  <td align="left" bgcolor="#FFFFFF" ><?php echo $documento?></td>
	  <td align="center" bgcolor="#FFFFFF"><span class="anulado1"><?  if ($row['sunat']=='03'){ echo $dni; }else{ echo $ruc;} ?></span></td>
	  <td align="center" bgcolor="#FFFFFF"><span class="anulado1"><?php echo $razon?></span></td>
	  <td colspan="7" bgcolor="#FFFFFF" align="center" style="letter-spacing:50px"><span >ANULADO</span></td>
	  </tr> 
<?php 
}
		if( $row['sunat'] != $temdes )	{  $temdes = $row['sunat'];    
	    	    $strSQL02 = mysql_query("select cab_mov.cod_cab,cab_mov.b_imp, cab_mov.igv , cab_mov.fecha,cab_mov.moneda,operacion.sunat 
				from cab_mov inner join cliente on cliente=codcliente inner join operacion  on operacion.codigo=cab_mov.cod_ope  and operacion.codigo in (".$filtro56.") 
				where cab_mov.tipo='".$tipo."' and substring(fecha,1,10) between '".$fecha1."' and '".$fecha2."' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$filtro6." and operacion.sunat='".$row['sunat']."' and flag!='A'
				group by cod_cab
				");
	        while ( $filx = mysql_fetch_assoc( $strSQL02 ) )  
			{ 	$fecha2		    =	substr($filx['fecha'],0,10);
			    $consultaDBA2	=	mysql_query("select * from tcambio");
				while ($valor2=mysql_fetch_assoc($consultaDBA2))  
				{ 	$fechaTc2 	=	$valor2["fecha"];
					$fechaTc2	=	formatofecharay($fechaTc2);
					if(	$fechaTc2 ==	$fecha2	){	$tc2	=	$valor2["venta"];break;	}
					//OJO CON ESTO TODOS LOS DIAS HABRIA QUE PONER EL TIPO DE CAMBIO SINO JUGARIAS CON EL TIPO DE CAMBIO Y RESULTADOS FINALES
					else 					 {  if ( $fecha2 >= $fechaTc2 )   {	$tc2	=	$valor2["venta"];	} }
				}
				
				$consulta2	=	mysql_query("select * from det_mov where cod_cab =".$filx['cod_cab'] );
				while(  $valor2	=	mysql_fetch_assoc($consulta2) )
				{	if( $valor2['tipo'] ==  $valor2['flag_kardex'] ){  $sig = 1 ; }else { $sig = -1; } 
				}
				
				//echo $temdes."-".$filx['moneda']."-".$tc2."<br/>";
				if($filx['moneda']	==	'01'	) { $imp2 += number_format($filx['b_imp']*$sig,2,'.','');  	  $igv2 +=  number_format($filx['igv']*$sig,2,'.','');      $total2	+=	number_format($filx['b_imp']*$sig + $filx['igv']*$sig,2,'.','');  }
				else					  { $imp2 += number_format($filx['b_imp']*$tc2*$sig,2,'.',''); $igv2 += number_format($filx['igv']*$tc2*$sig,2,'.',''); $total2	+=number_format($filx['b_imp']*$tc2*$sig  + $filx['igv']*$tc2*$sig,2,'.','');}
			}
		}
		
		$x++;     //
		$contx=mysql_num_rows($strSQL02 );		
		//echo $imp2."-".$igv2."-".$total2."-".$contx;
		$tot	=	"<tr><td colspan='11'></td></tr>".mostrar_total($imp2,$igv2,$total2,$contx,'Sub Total')." ";	
		}		
		//Mostrar el ultimo subtotal
		if( $inicio+$resultados2  == $total_registros ) { echo $tot;}
		if($total_paginas==$pagina){
		echo "<tr><td colspan='11'></td></tr>".mostrar_total($impge,$igvge,$totalge,$contge,'Total General')." ";	
		}
	
	 ?>	  

	<tr >
	  <td align="left" bgcolor="#FFFFFF" >&nbsp;</td>
	  <td align="left" bgcolor="#FFFFFF" >&nbsp;</td>
	  <td align="left" bgcolor="#FFFFFF" >&nbsp;</td>
	  <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
	  <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
	  <td align="right"  bgcolor="#FFFFFF">&nbsp;</td>
	  <td align="right"  bgcolor="#FFFFFF">&nbsp;</td>
	  <td align="right"  bgcolor="#FFFFFF">&nbsp;</td>
	  <td align="right"  bgcolor="#FFFFFF">&nbsp;</td>
	  <td align="right"  bgcolor="#FFFFFF">&nbsp;</td>
	  <td align="right"  bgcolor="#FFFFFF">&nbsp;</td>
	  <td align="right"  bgcolor="#FFFFFF">&nbsp;</td>
	  </tr>	
      <?php echo "<tr><td colspan='12'></td></tr>".mostrar_total($impge,$igvge,$totalge,$contge,'Total General')." "; ?>
</table>
</td></tr>
</table>
</center>
</body>
</html>
