<?php 
if($_REQUEST['excel']=="si"){

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=excel.xls");
}
    //session_start();
	include('conex_inicial.php');
	include('funciones/funciones.php');
	//-------------------------------------------
		
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
	

	$fec_ini=explode("-",$_GET['fecha']);
	$fec_ini2=$fec_ini[2]."-".$fec_ini[1]."-".$fec_ini[0];
	$fec_fin=explode("-",$_GET['fecha2']);
	$fec_fin2=$fec_fin[2]."-".$fec_fin[1]."-".$fec_fin[0];
	
	
	if($pagina=='') 	{ 	$inicio = 0; $pagina = 1; } 
	else 				{ 	$inicio = ($pagina - 1) * $registros; 	} 
	
	
	/************************** FILTROS PRINCIPALES *********************************/
	
	//Filtro de Empresa y Sucursal ..... Sucursal depende del campo Empresa 
	//echo "---->".$sucursal."----->".$tienda;
	if($sucursal!='0')	{	
		if( $tienda	==	'0'	){	
			$filtro5=" and sucursal='".$sucursal."' ";	
		}else{
			$filtro5=" and sucursal='".$sucursal."' and tienda='".$tienda."' ";	
		}	
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
	
	//NUemero de filas con el indexado
	$resultados1		= 	mysql_query( $strSQL." LIMIT ".$inicio.",".$registros ,$cn );		
	$resultados2 		=	mysql_num_rows($resultados1); 
	$total_paginas 		= 	ceil($total_registros / $registros);  
?>	

<?php
function mostrar_total($bi,$igv,$total,$contx,$columTotal){

$totgen_base1=$bi;
$totgen_igv1=$igv;
$totgen_total1=$total;

$datos='<table border="0">
  <tr>
    <td  width="250" bgcolor="#F9F9F9">&nbsp;</td>
    <td  width="200" height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td  width="200" bgcolor="#F9F9F9">&nbsp;</td>
    <td colspan="7" bgcolor="#F9F9F9">----------------------------------------------------------------------------------------------------------------------------------</td>
  </tr>
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9"><span class="Estilo7 Estilo33">'.$columTotal.' &nbsp;('.$contx.')</span></td>
    <td align="center" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"></span></td>
    <td align="center" bgcolor="#F9F9F9" style="color:#FF3300; font:bold">S/.</td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">'.number_format($totgen_base1,2).'</span></td>
	<td width="120" align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">&nbsp;</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">'.number_format($totgen_igv1,2).'</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">'.number_format($totgen_total1,2).'</span></td>

  </tr>
  
</table>';
return $datos;
}
	}
 ?>	
<?php if($_REQUEST['excel']=='si'){?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style>
.border_td{
border:1px solid #000000;
padding:0px;
margin:0px;
}
.Estilo17 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #003366; }
.Estilo36 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
.Estilo37 {color: #990000}
.Estilo10 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; }
.anulado {text-decoration:line-through;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#990000; }
</style>
</head>	
<body>	
<?php }?>
<table width="1206"  border="0" cellpadding="1" cellspacing="1" >
  
  <?php if($_REQUEST['excel']=="si"){ ?>
  <tr  >
    <td height="18" colspan="13"align="center"><h3>Libro  de Compras/Ingreso <br/>
        <?php echo "De :".$fec_ini2." al ".$fec_fin2 ?></h3></td>
  </tr>
  <?php }?>
  
  
 <tr 
  <?php 
  if($_REQUEST['excel']=="si"){
  		echo 'bgcolor="#006699" style="background-position:100% 40%;color:#FFFFFF; font-weight:bold"';
   }else{
  		echo 'style="background:url(imagenes/bg_contentbase2.gif);  background-position:100% 40%;color:#FFFFFF";font-weight:bold ';
   } ?>
   >
  
  
    <?php if($_REQUEST['excel']!='si'){ ?><td width="15">&nbsp;</td><?php }?>
    <td width="111" height="18" ><span class="Estilo7 Estilo15 Estilo35">Fecha </span></td>
    <td width="40" ><span class="Estilo7 Estilo15 Estilo35">Doc.</span></td>
    <td width="170" ><span class="Estilo7 Estilo15 Estilo35">N. Documentos </span></td>
    <td width="88" align="center"><span class="Estilo7 Estilo15 Estilo35">Ruc/Dni</span></td>
    <td width="254" align="center"><span class="Estilo7 Estilo15 Estilo35">Razon Social</span></td>
    <td width="35" align="center"><span class="Estilo7 Estilo15 Estilo35">Mon.</span></td>
    <td width="45" align="center"><span class="Estilo7 Estilo15 Estilo35">B. imp ($.)</span></td>
    <td width="48" align="center" ><span class="Estilo7 Estilo15 Estilo35">TC</span></td>
    <td width="145" align="center" ><span class="Estilo7 Estilo15 Estilo35">B. imp (S/.)</span></td>
    <td width="81" align="center" ><span class="Estilo7 Estilo15 Estilo35">Inafectos</span></td>
    <td width="63" align="right" ><span class="Estilo7 Estilo15 Estilo35">Impuesto</span></td>
    <td width="71" align="right" ><span class="Estilo7 Estilo15 Estilo35">Total</span></td>
  </tr>
<?php		

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
				if($_REQUEST['excel']!='si'){echo $tot;} //Muestra la funcion muestra_total
				$imp2=0;$igv2=0;$total2=0;$contx=0;$eje=0;  //vaciamos los valores para sumar el nuevo grupo de tipos segun sunat
			}	
			if($_REQUEST['excel']!='si'){echo "<tr><td colspan='14' ><b>Codigo Sunat: ".$row['sunat']."</b></td></tr>";}
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
  <tr bgcolor="#F9F9F9" onclick="entrada(this)">
    <?php if($_REQUEST['excel']!='si'){ ?><td align="center" ><img style="cursor:pointer" alt="" onclick="doc_det('<?php echo $referencia;?>')" src="imagenes/ico_lupa.png" width="15" height="15" /></td><?php }?>
    <td ><span class="Estilo10"><?php echo formatofecha($fecha); ?></span></td>
    <td ><span class="Estilo10"><?php echo $td?></span></td>
    <td ><span class="Estilo10"><label for="select"><?php echo $documento?></label></span></td>
    <td align="center"><span class="Estilo10"><?  if ($row['sunat']=='03'){ echo $dni; }else{ echo $ruc;} ?></span></td>
    <td><span class="Estilo10"><?php echo $razon?></span></td>
    <td align="center"><span class="Estilo10"><?php echo $moneda?></span></td>
    <td align="right" ><span class="Estilo10"><?
	 if($moneda	==	"US$."	) {
		echo number_format($row['b_imp'],2);
	} else { echo '0.00'; 	}
	?></span></td>
    <td align="center"><span class="Estilo10">
	<?
	 if($moneda	==	"US$."	) {
			echo $tc ; 
	} else { echo '0.00'; }
	?></span></td>
    <td align="right" ><span class="Estilo10"><? 	
	echo number_format(($total-$totalInafectos-$igvto)*$sig ,2) 
	/*if($moneda	==	"US$."	) {
		echo number_format($row['b_imp']*$tc,2);
	} else { 
		echo number_format($row['b_imp'],2);
	 }*/
	 ?></span></td>
    <td align="right" ><span class="Estilo10"><?php  
	echo number_format($totalInafectos*$sig ,2) ; ?></span></td>
    <td align="right" ><span class="Estilo10"><?php echo number_format($igvto*$sig ,2) ?></span></td>
    <td align="right" ><span class="Estilo10"><?php	echo number_format($total*$sig ,2)	?></span></td>
  </tr>
  <?php }else{ ?>
    <tr bgcolor="#F9F9F9" onclick="entrada(this)">
    <td align="center" ><img style="cursor:pointer" alt="" onclick="doc_det('<?php echo $referencia;?>')" src="imagenes/ico_lupa.png" width="15" height="15" /></td>
    <td ><span class="anulado"><?php echo formatofecha($fecha); ?></span></td>
    <td ><span class="anulado"><?php echo $td?></span></td>
    <td ><span class="anulado"><label for="select"><?php echo $documento?></label></span></td>
    <td align="center"><span class="anulado"><?  if ($row['sunat']=='03'){ echo $dni; }else{ echo $ruc;} ?></span></td>
    <td align="center"><span class="anulado"><?php echo $razon?></span></td>
    <td colspan="7" align="center" style="letter-spacing:50px">ANULADO</td>
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
		$tot	=	"<tr><td colspan='14'></td></tr><tr><td colspan='14'>".mostrar_total($imp2,$igv2,$total2,$contx,'Sub Total')."</td></tr>";	
		}	
		
		//Mostrar el ultimo subtotal
		if( $inicio+$resultados2  == $total_registros ) { echo $tot;}
		if($total_paginas==$pagina){
		echo "<tr><td colspan='14'></td></tr><tr><td colspan='14'>".mostrar_total($impge,$igvge,$totalge,$contge,'Total General')."</td></tr>";	
		}
	?>
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td colspan="2" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
</table>
<?php if($_REQUEST['excel']!='si'){ ?>
|
<table width="100%" height="21" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="311" height="21" align="left" valign="bottom" style="color:#333333"><span class="Estilo10">Viendo del <strong><?php echo $inicio+1?></strong> al<strong><?php echo $inicio+$resultados2 ?></strong>(de <strong><?php echo $total_registros?></strong> documentos)</span>.</td>
    <td width="526" align="right" valign="bottom" style="color:#999999"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:13px">
    <?php 		  
		if(	($pagina - 1) > 0) { 
			echo "<a style='cursor:pointer' onclick='cargar_detalle($pagina-1,$imp2,$igv2,$total2,$contx,$x,$temdes,0,$pagina)'>< Anterior </a> "; 
		} 

		for ($i=1; $i<=$total_paginas; $i++){ 
			if ($pagina == $i) { echo "<b style='color:#000000'>".$pagina."</b> "; }
			else 			   { echo "<a style='cursor:pointer' href='#' onclick='cargar_detalle($i,$imp2,$igv2,$total2,$contx,$x,$temdes,0,$pagina)'>".$i."</a> "; }
		}
		if(	($pagina + 1)	<=	$total_paginas	) { 
			echo " <a style='cursor:pointer' onclick='cargar_detalle($pagina+1,$imp2,$igv2,$total2,$contx,$x,$temdes,0,$pagina)'>Siguiente ></a>"; 
		} 

	?>
     <input type="hidden" name="pag" value="<?php echo $pagina?>" />&nbsp;&nbsp;    </font> </td>
  </tr>
</table>
<?php }?>
<?php if($_REQUEST['excel']=='si'){?>
</body>	
</html>	
<?php }?>