<? //session_start();
   include('../conex_inicial.php');
   include('../funciones/l_rpt_ventas.php');
   include('../funciones/funciones.php');

	$moneda		=	'S/.';
	$agru = 'Codigo Sunat'; 
	$reporte    = 	'LIBRO_VENTAS';
	 $pagina=$_REQUEST['pagina'];
    //SIRVE PARA SACAR TODOS LOS DOCUMENTOS SELECCIONADOS DE ESTE REPORTE Y DE LA SESSION INGRESADA 
   // $reporte 	= 	'CONSOLIDADO_VENTA';
    $documentos = 	'';
	
	//Filtro de Empresa y Sucursal ..... Sucursal depende del campo Empresa 
	if(	$_POST['cod_suc'] !=  'to' ){	if( $_POST['cod_tienda'] ==	'0' ){	$filtro1 = " and c.sucursal='".$_POST['cod_suc']."' ";	}
										else				 			  {	$filtro1 = " and c.sucursal='".$_POST['cod_suc']."' and c.tienda='".$_POST['cod_tienda']."' ";	}	
	}
	
	//filtro del campo caja		
	if(	$_POST['codigo_caja'] !=  'to' )   {	$filtro2 	= 	" and c.serie='".$_POST['codigo_caja']."' "; }
	
	//filtro del campo vendedor		
	if( $_POST['codigo_usuario'] !=  'to' ){	$filtro3 	= 	" and c.cod_vendedor='".$_POST['codigo_usuario']."' "; }

	//filtro del campo turno
	if(	$_POST['codigo_turno']	!=	 "to"	)	{
		$rstu	   = mysql_query("select hinicio,hfin from turno where id='".$_POST['codigo_turno']."'",$cn);
		$rowtu	   = mysql_fetch_array(	$rstu );
		$filtro4   = " and substring(c.fecha,12,9) between '".$rowtu['hinicio']."' and '".$rowtu['hfin']."' ";
	}	
	
	//Filtro de los campos de Tipos de Documentos
	$rstemp	=	mysql_query("Select documentos from temp where cod_user='".$_REQUEST['coduser']."' and reporte='".$reporte."'",$cn);
	$rowtemp=	mysql_fetch_array($rstemp);
	if( !empty( $rowtemp['documentos'] ) ) $filtro0 = " and o.codigo in (".$rowtemp['documentos'].") ";

?>
<table border="0" cellpadding="1" cellspacing="1"  width="1859"  >
<tr bgcolor="#CCCCCC">
   <?php if($_REQUEST['excel']!="si"){ ?><td width="15" rowspan="3" align="center" valign="middle">&nbsp;</td><?php } ?>
    <td width="109" rowspan="3" align="center" valign="middle">NUMERO
      CORRELATIVO<br />
      DEL REGISTRO O<br />
      CÓDIGO UNICO
    DE LA<br /> OPERACIÓN</td>
    <td width="119" rowspan="3" align="center" valign="middle" >FECHA DE
      EMISIÓN DEL
      COMPROBANTE<br />
      DE PAGO O
    DOCUMENTO</td>
	<td width="109" rowspan="3" align="center" valign="middle" >FECHA DE<br />
	  VENCIMIENTO<br />
    Y/O PAGO</td>
    <td height="18" colspan="3" align="center" valign="middle" >COMPROBANTE DE PAGO
    O DOCUMENTO</td>

    <td colspan="3" align="center" valign="middle">INFORMACIÓN DEL
    CLIENTE</td>
    <td width="111"  rowspan="3" align="center" valign="middle">VALOR<br />
      FACTURADO<br />
      DE LA<br />
    EXPORTACION</td>
    <td width="91"  rowspan="3" align="center" valign="middle" >BASE<br />
      IMPONIBLE<br />
      DE LA<br />
      OPERACIÓN<br />
    GRAVADA</td>
	<td colspan="2" rowspan="2" align="center" valign="middle" >IMPORTE TOTAL<br />
    DE LA OPERACION</td>

    <td width="25" rowspan="3" align="center" valign="middle" >ISC</td>
    <td width="40" rowspan="3" align="center" valign="middle" >IGV<br />
      Y/O<br />
    IPM</td>
        <td width="92" rowspan="3" align="center" valign="middle" >OTROS TRIBUTOS<br />
          Y CARGOS QUE<br />
          NO FORMAN PARTE<br />
          DE LA<br />
        BASE IMPONIBLE</td>
	    <td width="80"  rowspan="3" align="center" valign="middle" >IMPORTE<br />
	      TOTAL DEL<br />
	      COMPROBANTE<br />
        DE PAGO</td>
    <td width="50" rowspan="3" align="center" valign="middle" >TIPO
      DE
    CAMBIO</td>
    <td colspan="4" rowspan="2" align="center" valign="middle" >REFERENCIA DEL COMPROBANTE DE PAGO<br/>
    O DOCUMENTO ORIGINAL QUE MODIFICA</td>
  </tr>
    <tr bgcolor="#CCCCCC">
    <td width="36" rowspan="2" align="center" valign="middle" >TIPO</td>
	<td width="122" rowspan="2" align="center" valign="middle" >N° SERIE O<br />
	  N° DE SERIE DE LA<br />
	  MAQUINA REGISTRADORA</td>
	<td width="70" rowspan="2" align="center" valign="middle" >NUMERO</td>
    <td height="18" colspan="2" align="center" valign="middle">DOCUMENTO DE IDENTIDAD</td>
    <td width="200" rowspan="2" align="center" valign="middle">APELLIDOS Y NOMBRES,<br />
      DENOMINACIÓN O RAZÓN SOCIAL</td>
  </tr>
      <tr bgcolor="#CCCCCC">
    <td width="42" align="center" valign="middle">TIPO</td>
	 <td width="74" align="center" valign="middle">NÚMERO</td>
    <td width="96" align="center" valign="middle" >EXONERADA</td>
    <td width="77" align="center" valign="middle" >INAFECTA</td>
    <td width="52" align="center" valign="middle" >FECHA</td>
    <td width="36" align="center" valign="middle" >TIPO</td>
    <td width="43" align="center" valign="middle" >SERIE</td>
    <td width="130" align="center" valign="middle" >N° DEL
      COMPROBANTE
      DE PAGO O
      DOCUMENTO</td>
  </tr>
<?  
	$bad = 0 ; $tot_tvendia_dolares =0;	$tot_tvendia_soles=0 ; $sub_canti_tot=0;
	$total_registros=0;
	$registros=30;

	$registros=30;
	$dataprev  		=    mostrarSunatDocFecha_rj( $cn , formatofecha($_POST['fecha']) , formatofecha($_POST['fecha2']) , $filtro0 , $filtro1 ,$filtro2 , $filtro3 , $filtro4 , $filtro5  ); 
	$total_registros=count($dataprev);

	$total_paginas 		= 	ceil($total_registros / $registros);


	if($pagina==''){ 	
		$inicio = 0; $pagina = 1; 
	}else { 
		$inicio = ($pagina - 1) * $registros; 	
	} 

	$data  		=    mostrarSunatDocFecha_rj( $cn , formatofecha($_POST['fecha']) , formatofecha($_POST['fecha2']) , $filtro0 , $filtro1 , $filtro2 , $filtro3 , $filtro4 , $filtro5 , $inicio ,$registros ); 
	
			//verificar signo y tipo de cambio
			$sig = 1;
			//$sub_canti 	+= count( $data );	$canti_ge += count( $data );
			for( $m = 0 ; count( $data ) > $m ; $m++ )
			{	
			
				
	if( $prev_serie != $data[$m]['serie'] ) {
	if($xx>0){ 
	$sub_total=mostrarSunatDocFecha_total_rj( $cn , formatofecha($_POST['fecha']) , formatofecha($_POST['fecha2']) , $filtro0 , $filtro1 , $filtro2 , $filtro3 , $filtro4 , $filtro5 ,$prev_sunat,$prev_serie ); 
	?>

  <tr bgcolor="#F9F9F9" onclick="entrada(this)">
	  <td height="21" colspan="2" bgcolor="#F9F9F9">&nbsp;</td>
	  <td bgcolor="#F9F9F9">&nbsp;</td>
	  <td colspan="4" bgcolor="#F9F9F9">&nbsp;</td>
	  <td colspan="4" bgcolor="#F9F9F9"><span class="subcabeza">SubTotal</span><span class="Estilo7">( <?=$sub_total['numdoc'] ;?> )  </span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="subcabeza"> <?=$sub_total['afecto']; ?></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="subcabeza"></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="subcabeza"><?=$sub_total['inafecto']?></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="subcabeza"></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="subcabeza"><?=$sub_total['igv'];?></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="subcabeza"></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="subcabeza"><?=$sub_total['total'];?></span></td>
	  <td align="right" bgcolor="#F9F9F9" colspan="5"><span class="total"></span></td>
    </tr>
	<? 
	}
	$sub_canti = 0 ;$sub_canti_afecto=0;$sub_canti_inafecto=0;$sub_canti_igv=0;
	$prev_serie = $data[$m]['serie'] ;

	if( $prev_sunat != $data[$m]['sunat'] ) { 
			//FILTRO POR SUNAT
		$prev_sunat = $data[$m]['sunat'] ;
	   ?>
	<tr bgcolor="#F9F9F9" onclick="entrada(this)" >
	  <td height="10" colspan="23" bgcolor="#F9F9F9"><span class="cabeza"><?=$agru ;?>: <?=$prev_sunat?></span></td>
    </tr>
	<? } 
	?>
	<tr bgcolor="#F9F9F9" onclick="entrada(this)" >
	  <td height="10" colspan="23" bgcolor="#F9F9F9">&nbsp;&nbsp; <span class="subcabeza">Serie: <?=$prev_serie ?></span></td>
    </tr>	
	<?
	}
			
			//verificar el signo
				$rsdmov	=	mysql_query("select cod_ope,numero,tcambio,moneda,precio,cantidad,imp_item,tipo,flag_kardex from det_mov where cod_cab =".$data[$m]['cod_cab'] );
				while(  $rowdmov  =	 mysql_fetch_assoc( $rsdmov ) )
				{   $inafecto =0;   $afecto = 0; $igv =0;	$tcambio=$rowdmov['tcambio']; $afectodolar =0;
				
					if( $rowdmov['afectoigv']	==	'N'	){ 	number_format($rowdmov['imp_item'],2,".",""); }
					else								 {  $afecto 	= 	number_format($rowdmov['imp_item'],2,".","")*100/( 100 + $data[$m]['impto1'] ) ;
					//$afecto 	= 	$rowdmov['imp_item']*100/( 100 + $rowdmov['tcambio'] ) ;
															$igv 		=  	number_format($rowdmov['imp_item'],2,".","")- $afecto;
															}	
					//si  se resta si es diferente
					if( $rowdmov['tipo'] !=  $rowdmov['flag_kardex'] ){ $sig = -1 ; $inafecto= $inafecto*$sig ; $afecto = $afecto*$sig; $igv = $igv*$sig;  }
					
					//si es dolar se transforma a soles
					if( $rowdmov['moneda'] == '02' ){  $afectodolar = $afecto;$inafecto = $inafecto*$tcambio ; $afecto = $afecto*$tcambio; $igv = $igv*$tcambio; }
					
					
					$inafectotodoc += $inafecto ; $afectotodoc += $afecto; $igvtodoc += $igv;
				}//end while
				
				if( $data[$m]['moneda'] == '01' ) { $mone = 'S/.'; }else{ $mone = '$/.' ;}
				//DATOS DEL CLIENTE
				$rscli	 =	mysql_query("select ruc,razonsocial from cliente where codcliente ='".$data[$m]['cliente']."'" ,$cn );
				$rowcli  =	mysql_fetch_assoc( $rscli );				
				
				//fecha
				$fec = explode('-',substr($data[$m]['fecha'],0,10));
				$fecx = $fec[2].'-'.$fec[1].'-'.$fec[0];
		if($data[$m]['flag']!="A"){	
				$sub_canti++;	$canti_ge++;
				//SUBTOTALES
				
				
				
				$f_venc		=	substr($data[$m]['f_venc'],0,10);
			
				if($data[$m]['tipo_aux']=='natural'){
				$tempNat='01';
				}else{
				$tempNat='06';
				}
				
				$sub_canti_afecto 	+= $afectotodoc; 
				$sub_canti_inafecto += $inafectotodoc; 
				$sub_canti_igv 		+= $igvtodoc;
				
				//TOTALES GENERALES
				
				$canti_afecto_ge 	+= $afectotodoc; 
				$canti_inafecto_ge  += $inafectotodoc; 
				$canti_igv_ge 		+= $igvtodoc;	
		list($td_sunat)	=	mysql_fetch_array(mysql_query("select sunat from operacion where codigo='".$data[$m]['cod_ope']."'"));				
	?>
	<tr bgcolor="#F9F9F9" onclick="entrada(this)">
	  <td align="left" bgcolor="#F9F9F9" ><img style="cursor:pointer" alt="" onclick="doc_det('<?=$data[$m]['cod_cab'] ;?>')" src="imagenes/ico_lupa.png" width="15" height="15" /></td>
	  	  <td align="left" bgcolor="#F9F9F9" ><span class="Estilo10"><? echo '&nbsp;'.str_pad(++$XX,7,"0",STR_PAD_LEFT);?></span></td>

	  <td align="left" bgcolor="#F9F9F9" ><span class="Estilo10"><?='&nbsp;'.$fecx;?></span></td>
	  	  <td align="center" bgcolor="#F9F9F9" ><span class="Estilo10"><?php echo $f_venc	?></span></td>
	  <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?=$td_sunat; ?></span></td>
	  	  <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?=$data[$m]['serie']?></span></td>
	  <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?=$data[$m]['Num_doc']?></span></td>
	  	  <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?php echo $tempNat?></span></td>
	  <td align="center" bgcolor="#F9F9F9"><span class="Estilo10">&nbsp;<?=$rowcli['ruc'];?>&nbsp;</span></td>
	  <td align="left" bgcolor="#F9F9F9"><span class="Estilo10">&nbsp;<?php echo  utf8_encode($rowcli['razonsocial']);?></span></td>
		  <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"></span></td>
	  <td align="right"  bgcolor="#F9F9F9"><span class="Estilo10">
	    <?=number_format($afectotodoc,2) ?>
      &nbsp;</span></td>
	  <td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"></span></td>
	  	  <td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"><?=number_format($inafectotodoc,2) ;?>&nbsp;</span></td>
	  <td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"></span></td>


	  <td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"><?=number_format($igvtodoc,2);?>&nbsp;</span></td>

	  	  <td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"></span></td>
	  <td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"><?=number_format($afectotodoc+$inafectotodoc+$igvtodoc,2);?></span></td>
	  	  <td align="right"  bgcolor="#F9F9F9"><span class="Estilo10">&nbsp;<?=$data[$m]['tc'];?>&nbsp;</span></td>
	<td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"></span></td>
		<td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"></span></td>
			<td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"></span></td>
				<td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"></span></td>
	</tr>
	<?php }else{ ?>
		<tr bgcolor="#F9F9F9" onclick="entrada(this)">
	  <td align="left" bgcolor="#F9F9F9" ><img style="cursor:pointer" alt="" onclick="doc_det('<?=$data[$m]['cod_cab'] ;?>')" src="imagenes/ico_lupa.png" width="15" height="15" /></td>
	  	  <td align="left" bgcolor="#F9F9F9" ><span class="anulado"><? echo '&nbsp;'.str_pad(++$XX,7,"0",STR_PAD_LEFT);?></span></td>

	  <td align="left" bgcolor="#F9F9F9" ><span class="anulado"><?='&nbsp;'.$fecx;?></span></td>
	  	  <td align="left" bgcolor="#F9F9F9" ><span class="Estilo10"></span></td>
	  <td align="center" bgcolor="#F9F9F9"><span class="anulado"><?=$td_sunat; ?></span></td>
	  	  <td align="center" bgcolor="#F9F9F9"><span class="anulado"><?=$data[$m]['serie']?></span></td>
	  <td align="center" bgcolor="#F9F9F9"><span class="anulado"><?=$data[$m]['Num_doc']?></span></td>
	  	  <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"></span></td>
	  <td align="center" bgcolor="#F9F9F9"><span class="anulado">&nbsp;<?=$rowcli['ruc'];?>&nbsp;</span></td>
	  <td align="left" bgcolor="#F9F9F9"><span class="anulado">&nbsp;<?php echo utf8_encode($rowcli['razonsocial']);?></span></td>
		  <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"></span></td>
	  <td colspan="8" align="center"  bgcolor="#F9F9F9"><span class="Estilo10" style="letter-spacing:50px;">ANULADO</span></td>
	  <td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"></span></td>
		<td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"></span></td>
			<td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"></span></td>
				<td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"></span></td>
	</tr>
	
	
	<? 	
	}
		$xx++;
		$afectotodoc = 0; $inafectotodoc =0 ; $igvtodoc = 0;    ?>
	<? if( $prev_serie != $data[$m]['serie']) { 
		$xx=0;
		echo $m;
		} 
	}//end for   ?>

	<tr>
	  <td height="21" colspan="23" bgcolor="#F9F9F9">&nbsp;</td>
    </tr>
	    <? //} ?>
	<? // }//end for 
	if($pagina==$total_paginas ){

	$sub_total=mostrarSunatDocFecha_total_rj( $cn , formatofecha($_POST['fecha']) , formatofecha($_POST['fecha2']) , $filtro0 , $filtro1 , $filtro2 , $filtro3 , $filtro4 , $filtro5 ,$prev_sunat,$prev_serie ); 
	?>
  <tr bgcolor="#F9F9F9" onclick="entrada(this)">
	  <td height="21" colspan="2" bgcolor="#F9F9F9">&nbsp;</td>
	  <td bgcolor="#F9F9F9">&nbsp;</td>
	  <td colspan="4" bgcolor="#F9F9F9">&nbsp;</td>
	  <td colspan="4" bgcolor="#F9F9F9"><span class="subcabeza">SubTotal</span><span class="Estilo7">( <?=$sub_total['numdoc'] ;?> )  </span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="subcabeza"> <?=$sub_total['afecto']; ?></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="subcabeza"></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="subcabeza"><?=$sub_total['inafecto']?></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="subcabeza"></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="subcabeza"><?=$sub_total['igv'];?></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="subcabeza"></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="subcabeza"><?=$sub_total['total'];?></span></td>
	  <td align="right" bgcolor="#F9F9F9" colspan="5"><span class="total"></span></td>
    </tr>
	<? 
	
		$total_gen=mostrarSunatDocFecha_total_rj( $cn , formatofecha($_POST['fecha']) , formatofecha($_POST['fecha2']) , $filtro0 , $filtro1 , $filtro2 , $filtro3 , $filtro4 , $filtro5 ); 
	?> 
	
	  <tr bgcolor="#F9F9F9" onclick="entrada(this)">
	  <td height="21" colspan="2" bgcolor="#F9F9F9">&nbsp;</td>
	  <td bgcolor="#F9F9F9">&nbsp;</td>
	  <td colspan="4" bgcolor="#F9F9F9">&nbsp;</td>
	  <td colspan="4" bgcolor="#F9F9F9"><span class="total">TOTAL GENERAL( <?=$total_gen['numdoc']; ?>)</span> <span class="total">
	  </span><span class="total"></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="total"><?=$total_gen['afecto']; ?></span></td>
	  	  <td align="right" bgcolor="#F9F9F9"><span class="subcabeza"></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="total"><?=$total_gen['inafecto']; ?></span></td>
	  	  <td align="right" bgcolor="#F9F9F9"><span class="subcabeza"></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="total"><?=$total_gen['igv']; ?></span></td>
	  	  <td align="right" bgcolor="#F9F9F9"><span class="subcabeza"></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="total"><?=$total_gen['total']; ?></span></td>
	  	  <td align="right" bgcolor="#F9F9F9" colspan="5"><span class="total"></span></td>
	</tr>
</table>

<?php }?>
|
<table width="100%" height="21" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="311" height="21" align="left" valign="bottom" style="color:#333333"><span class="Estilo10">Viendo del <strong><?php echo $inicio+1?></strong> al<strong><?php echo $inicio+count($data) ?></strong>(de <strong><?php echo $total_registros?></strong> documentos)</span>.</td>
    <td width="526" align="right" valign="bottom" style="color:#999999"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:13px">
    <?php 		  
		if(	($pagina - 1) > 0) { 
			echo "<a style='cursor:pointer' onclick='cargar_detalle($pagina-1)'>< Anterior </a> "; 
		} 

		for ($i=1; $i<=$total_paginas; $i++){ 
			if ($pagina == $i) { echo "<b style='color:#000000'>".$pagina."</b> "; }
			else 			   { echo "<a style='cursor:pointer' href='#' onclick='cargar_detalle($i)'>".$i."</a> "; }
		}
		if(	($pagina + 1)	<=	$total_paginas	) { 
			echo " <a style='cursor:pointer' onclick='cargar_detalle($pagina+1)'>Siguiente ></a>"; 
		} 

	?>
     <input type="hidden" name="pag" value="<?php echo $pagina?>" />&nbsp;&nbsp;    </font> </td>
  </tr>
</table>