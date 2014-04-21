<?
    session_start();
	include('conex_inicial.php');
	include('funciones/funciones.php');
	//-------------------------------------------
	/***********************************--------**************************/

	$fecha1  	=   $_REQUEST['fecha'];
	$fecha2   	=	$_REQUEST['fecha2'];
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
	$temserie	=	'';
	$registros 	= 	531; 
	$moneda		=	'S/.';
	$reporte    = 	'LIBRO_VENTAS';
	
	
	
	if($pagina=='') 	{ 	$inicio = 0; $pagina = 1; } 
	else 				{ 	$inicio = ($pagina - 1) * $registros; 	} 
	
	
	/************************** FILTROS PRINCIPALES *********************************/
	
	//Filtro de Empresa y Sucursal ..... Sucursal depende del campo Empresa 
	if($sucursal!=0)	{	if( $tienda	==	0	){	$filtro5=" and sucursal='".$sucursal."' ";	}
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
	
	//Filtro de los campos de Tipos de Documentos
	$rstemp	=	mysql_query("Select documentos from temp where cod_user='".$_SESSION['codvendedor']."' and reporte='".$reporte."'",$cn);
	$rowtemp=	mysql_fetch_array($rstemp);
	if( !empty( $rowtemp['documentos'] ) ) $filtro0= " ".$rowtemp['documentos'];
	
	//DUDA FILTROS NO UTILIZADOS ???	
	//if($_REQUEST['tickets']=='false' and $tipo=='2'){ 	$filtro4	=	" and deuda='S' " ;}				
	//if(	$cliente!=''	)							{	$filtro6	=	" and cliente='".$cliente."' ";}
	
	
			
	/************************CONSULTA DE LOS FILTROS *********************/
	$strSQL = "select cab_mov.*,cliente.tipo_aux,cliente.razonsocial,cliente.ruc,operacion.sunat 
				from cab_mov inner join cliente on cliente=codcliente inner join operacion  on operacion.codigo=cab_mov.cod_ope  and operacion.codigo in (".$filtro0.") 
				where cab_mov.tipo='".$tipo."' and substring(fecha,1,10) between '".$fecha1."' and '".$fecha2."' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$filtro6." and operacion.sunat!='' 
				and flag!='A' and deuda='S'  order by operacion.sunat,serie,fecha ";
	
    echo $strSQL;	
	//Numero de filas totales			
	$resultados 		= 	mysql_query( $strSQL,$cn );
	$total_registros 	= 	mysql_num_rows( $resultados ); 
	
	//NUemero de filas con el indexado
	$resultados1		= 	mysql_query( $strSQL." LIMIT ".$inicio.",".$registros ,$cn );		
	$resultados2 		=	mysql_num_rows($resultados1); 
	$total_paginas 		= 	ceil($total_registros / $registros);  
?>		
<table width="1206"  border="0" cellpadding="1" cellspacing="1" >
  <tr style="background:url(imagenes/bg_contentbase2.gif);  background-position:100% 40%;">
    <td width="15">&nbsp;</td>
    <td width="111" height="18" ><span class="Estilo7 Estilo15 Estilo35">Fecha </span></td>
    <td width="40" ><span class="Estilo7 Estilo15 Estilo35">Doc.</span></td>
    <td width="170" ><span class="Estilo7 Estilo15 Estilo35">N. Documentos </span></td>
    <td width="88" align="center"><span class="Estilo7 Estilo15 Estilo35">Ruc</span></td>
    <td width="254" align="center"><span class="Estilo7 Estilo15 Estilo35">Razon Social</span></td>
    <td width="35" align="center"><span class="Estilo7 Estilo15 Estilo35">Mon.</span></td>
    <td width="45" align="center"><span class="Estilo7 Estilo15 Estilo35">B. imp ($.)</span></td>
    <td width="48" align="center" ><span class="Estilo7 Estilo15 Estilo35">TC</span></td>
    <td width="145" align="center" ><span class="Estilo7 Estilo15 Estilo35">B. imp (S/.)</span></td>
    <td width="81" align="center" ><span class="Estilo7 Estilo15 Estilo35">Inafectos</span></td>
    <td width="63" align="right" ><span class="Estilo7 Estilo15 Estilo35">Impuesto</span></td>
    <td width="71" align="right" ><span class="Estilo7 Estilo15 Estilo35">Total</span></td>
  </tr>
<?

		while ( $filx = mysql_fetch_assoc( $resultados ) )  
		{ 		
				$tc2 = $filx['tc'];
				$consulta2	=	mysql_query("select * from det_mov where cod_cab =".$filx['cod_cab'] );
				while(  $valor2	=	mysql_fetch_assoc($consulta2) )
				{	if( $valor2['tipo'] ==  $valor2['flag_kardex'] ){  $sig = 1 ; }else { $sig = -1; } 
				}
				
				if($filx['moneda']	==	'01'	) { 
				                                      $impge += $filx['b_imp']*$sig; 	  
													  $igvge += $filx['igv']*$sig;      
													  $totalge	+=	($filx['b_imp'] + $filx['igv'])*$sig;
													}
				else					  		{     $impge += $filx['b_imp']*$tc2*$sig; 
				                                      $igvge += $filx['igv']*$tc2*$sig  ;
													  $totalge	+=	($filx['b_imp']+$filx['igv'])*$tc2*$sig;
												}
			 $contge++;
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
			$tc         =   $row['tc'];
	//	echo $row['sunat'] ."-".$moneda."-".$tc ;
		if( $moneda == '02' ){	$moneda = 'US$.';	  }
		else				 {		$moneda = 'S/.';  }
		
		if( $row['sunat'] != $temdes ){					
			echo $tot;
			echo "<tr><td colspan='14' ><b>Codigo Sunat: ".$row['sunat']."</b></td></tr>";
			$temserie='';$imp2=0;$igv2=0;$total2=0;$contx=0;$eje=0; 
		}
		
		if( $row['serie'] != $temserie ){
			if( $row['sunat'] == $temdes &&  $x > 0 ){
				echo $tot;//Muestra la funcion muestra_total
				$imp2=0;$igv2=0;$total2=0;$contx=0;$eje=0;  //vaciamos los valores para sumar el nuevo grupo de tipos segun sunat
			}	
			echo "<tr><td></td><td colspan='13' ><b>Serie: ".$row['serie']."</b></td></tr>";
			
		}	
	
		$igvto  =  0;$total=0;
		if( $igv  !=  0 )  {    if( $moneda == 'S/.' ) {   $igvto = $igv;          }
								else			 	   {   $igvto = $igv*$tc; 	   }
							}
		if($moneda	==	'US$.'	){	$total	=	($importe  +	$igv)*$tc;         }
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
		
?>
  <tr bgcolor="#F9F9F9" onclick="entrada(this)">
    <td align="center" ><img style="cursor:pointer" alt="" onclick="doc_det('<?php echo $referencia;?>')" src="imagenes/ico_lupa.png" width="15" height="15" /></td>
    <td ><span class="Estilo10"><?php echo $fecha; ?></span></td>
    <td ><span class="Estilo10"><?php echo $td?></span></td>
    <td ><span class="Estilo10"><label for="select"><?php echo $documento?></label></span></td>
    <td align="center"><span class="Estilo10"><?php echo $ruc?></span></td>
    <td align="center"><span class="Estilo10"><?php echo $razon?></span></td>
    <td align="center"><span class="Estilo10"><?php echo $moneda?></span></td>
    <td align="right" ><span class="Estilo10"><?php echo number_format($row['b_imp'],2); ?></span></td>
    <td align="right" ><span class="Estilo10"><?php if($moneda	==	"US$."	) {?><center><?php echo $tc ;?></center><?php } ?></span></td>
    <td align="right" ><span class="Estilo10"><? echo number_format(($total-$totalInafectos-$igvto)*$sig ,2)  ?></span></td>
    <td align="right" ><span class="Estilo10"><?php  echo number_format($totalInafectos*$sig ,2) ; ?></span></td>
    <td align="right" ><span class="Estilo10"><?php echo number_format($igvto*$sig ,2) ?></span></td>
    <td align="right" ><span class="Estilo10"><?php	echo number_format($total*$sig ,2)	?></span></td>
  </tr>
  <? 
		if( $row['sunat'] != $temdes )	{  $temdes = $row['sunat'];} 
		
		if($row['serie'] != $temserie){$temserie=$row['serie']; 
	    	    $strSQL02 = mysql_query("select cab_mov.cod_cab,cab_mov.b_imp, cab_mov.igv , cab_mov.fecha,cab_mov.moneda,operacion.sunat ,cab_mov.tc
				from cab_mov inner join cliente on cliente=codcliente inner join operacion  on operacion.codigo=cab_mov.cod_ope  and operacion.codigo in (".$filtro0.") 
				where cab_mov.tipo='".$tipo."' and substring(fecha,1,10) between '".$fecha1."' and '".$fecha2."' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$filtro6." and operacion.sunat='".$row['sunat']."' and cab_mov.serie='".$row['serie']."' and flag!='A' and deuda='S' ");

	        while ( $filx = mysql_fetch_assoc( $strSQL02 ) )  
			{ 	
				$tc2 = $filx['tc'];
				$consulta2	=	mysql_query("select * from det_mov where cod_cab =".$filx['cod_cab'] );
				while(  $valor2	=	mysql_fetch_assoc($consulta2) )
				{	if( $valor2['tipo'] ==  $valor2['flag_kardex'] ){  $sig = 1 ; }else { $sig = -1; } 
				}
				
				//echo $temdes."-".$filx['moneda']."-".$tc2."<br/>";
				if($filx['moneda']	==	'01'	) 	{ $imp2 += $filx['b_imp']*$sig;  	  $igv2 +=  $filx['igv']*$sig;      $total2	+=	($filx['b_imp'] + $filx['igv'])*$sig;  }
				else					 			{ $imp2 += $filx['b_imp']*$tc2*$sig; $igv2 += $filx['igv']*$tc2*$sig; $total2	+= ($filx['b_imp']+ $filx['igv'])*$tc2*$sig;}
			}
		}
		
		$x++;     //
		$contx=mysql_num_rows($strSQL02 );		
		$tot	=	"<tr><td colspan='14'></td></tr><tr><td colspan='14'>".mostrar_total($imp2,$igv2,$total2,$contx)."</td></tr>";	
		}	
		
		//Mostrar el ultimo subtotal
		if( $inicio+$resultados2  == $total_registros ) { echo $tot;}
		if($total_paginas==$pagina){
		echo "<tr><td colspan='14'></td></tr><tr><td colspan='14'>".mostrar_total($impge,$igvge,$totalge,$contge)."</td></tr>";	
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
<?
function mostrar_total($bi,$igv,$total,$contx){
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
    <td bgcolor="#F9F9F9"><span class="Estilo7 Estilo33">Total General &nbsp;('.$contx.')</span></td>
    <td align="center" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"></span></td>
    <td align="center" bgcolor="#F9F9F9" style="color:#FF3300; font:bold">S/.</td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">'.number_format($totgen_base1,4).'</span></td>
	<td width="120" align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">&nbsp;</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">'.number_format($totgen_igv1,4).'</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">'.number_format($totgen_total1,4).'</span></td>

  </tr>
  
</table>';
return $datos;
}
 ?>