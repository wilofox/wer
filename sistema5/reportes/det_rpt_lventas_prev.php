<? //session_start();
   include('../conex_inicial.php');
   include('../funciones/l_rpt_ventas.php');
   
	$registros 	= 	531; 
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
	
	//AGRUPACION POR SUNAT	
    $agrupacion = mostrarSunat( $cn , $_POST['fecha'] , $_POST['fecha2'] , $filtro0 , $filtro1 , $filtro2 , $filtro3 , $filtro4 ); 
?>
<table border="0" cellpadding="1" cellspacing="1"  width="900"  >
	<tr style="background:url('imagenes/bg_contentbase2.gif');  background-position:100% 40%;" >
	  <td bgcolor="#006699">&nbsp;&nbsp;</td>
	  <td bgcolor="#006699"><div align="center"><span class="Estilo7 Estilo15">FECHA</span></div></td>
	  <td bgcolor="#006699"><div align="center"><span class="Estilo7 Estilo15"><span class="Estilo7 Estilo15 Estilo35">Doc</span></span></div></td>
	  <td bgcolor="#006699"><div align="center"><span class="Estilo7 Estilo15 Estilo35">N. Documento </span></div></td>
	  <td bgcolor="#006699"><div align="center"><span class="Estilo7 Estilo15"><span class="Estilo7 Estilo15 Estilo35">Ruc</span></span></div></td>
	  <td bgcolor="#006699"><div align="center"><span class="Estilo7 Estilo15">Razon Social</span></div></td>
	  <td bgcolor="#006699" align="center"><div align="center"><span class="Estilo7 Estilo15 Estilo35">Mon.</span></div></td>
	  <td align="right" bgcolor="#006699"><div align="center"><span class="Estilo7 Estilo15 Estilo35">B. imp ($.)</span></div></td>
	  <td align="right" bgcolor="#006699"><div align="center"><span class="Estilo7 Estilo15 Estilo35">TC</span></div></td>
	  <td align="right" bgcolor="#006699"><div align="center"><span class="Estilo7 Estilo15 Estilo35">B. imp (S/.)</span></div></td>
	  <td align="right" bgcolor="#006699"><span class="Estilo7 Estilo15 Estilo35">Inafectos</span></td>
	  <td align="right" bgcolor="#006699"><span class="Estilo7 Estilo15 Estilo35">Impuesto</span></td>
	  <td align="right" bgcolor="#006699"><span class="Estilo7 Estilo15">Total(S/.)</span></td>
	</tr>
<?  $bad = 0 ; $tot_tvendia_dolares =0;	$tot_tvendia_soles=0 ; $sub_canti_tot=0;
$total_registros=0;
    for ( $x=0 ; count($agrupacion) > $x ; $x++ ) { 
	//AGRUPACION POR SUNAT
	$a =  $agrupacion[$x-1]['sunat']; 
	$b  = $agrupacion[$x]['sunat'] ; 
	$c  = $agrupacion[$x+1]['sunat'] ;
	
	if( $a != $b ) { 
			//FILTRO POR SUNAT
		$cab = $agrupacion[$x]['sunat'] ;
	   ?>
	<tr bgcolor="#F9F9F9" onclick="entrada(this)" >
	  <td height="10" colspan="13" bgcolor="#F9F9F9"><span class="cabeza"><?=$agru ;?>: <?=$cab?></span></td>
    </tr>
	<? } ?>
	<tr bgcolor="#F9F9F9" onclick="entrada(this)" >
	  <td height="10" colspan="13" bgcolor="#F9F9F9">&nbsp;&nbsp; <span class="subcabeza">Serie: <?=$agrupacion[$x]['serie']?></span></td>
    </tr>	
	<?
		if(!empty($agrupacion[$x]['fecha'] ))
		{	$fecha 		=    explode('-' , substr( $agrupacion[$x]['fecha'] , 0 , 10	) )  ;
			
			//FILTRO POR SUNAT
			if( !empty(	$agrupacion[$x]['sunat'] ) && !empty( $agrupacion[$x]['serie'] ) )			
			{	//$filtro5    =    " and substring(c.fecha,1,10)='".$fecha[0].'-'.$fecha[1].'-'.$fecha[2]."' and o.sunat='".$agrupacion[$x]['sunat']."'";
				$data  		=    mostrarSunatDocFecha( $cn , $_POST['fecha'] , $_POST['fecha2'] , $filtro0 , $filtro1 , $filtro2 , $filtro3 , $filtro4 , $filtro5 , $agrupacion[$x]['sunat'] , $agrupacion[$x]['serie'] ); 
			}								
			$total_registros+=count($data);
			echo $total_registros;
			//verificar signo y tipo de cambio
			$sig = 1;
			//$sub_canti 	+= count( $data );	$canti_ge += count( $data );
			for( $m = 0 ; count( $data ) > $m ; $m++ )
			{	//verificar el signo
			//echo $data[$m]['flag'] ;
				$rsdmov	=	mysql_query("select cod_cab,cod_ope,numero,tcambio,moneda,precio,cantidad,imp_item,tipo,flag_kardex from det_mov where cod_cab =".$data[$m]['cod_cab'] );
				while(  $rowdmov  =	 mysql_fetch_assoc( $rsdmov ) )
				{   $inafecto =0;   $afecto = 0; $igv =0;	$tcambio=$rowdmov['tcambio']; $afectodolar =0;
				
					if( $rowdmov['afectoigv']	==	'N'	){ 	$inafecto 	= 	number_format($rowdmov['imp_item'],2,".",""); }
					else								 {  $afecto 	= 	number_format($rowdmov['imp_item'],2,".","")*100/( 100 + $data[$m]['impto1'] ) ;
					//$afecto 	= 	$rowdmov['imp_item']*100/( 100 + $rowdmov['tcambio'] ) ;
															$igv 		=  	number_format($rowdmov['imp_item'],2,".","")- $afecto;
														 }	
					//si  se resta si es diferente
					if( $rowdmov['tipo'] !=  $rowdmov['flag_kardex'] ){ $sig = -1 ; $inafecto= $inafecto*$sig ; $afecto = $afecto*$sig; $igv = $igv*$sig;  }
					
					//si es dolar se transforma a soles
					if( $rowdmov['moneda'] == '02' ){  $afectodolar = $afecto;$inafecto = $inafecto*$tcambio ; $afecto = $afecto*$tcambio; $igv = $igv*$tcambio; }
					
					
					$inafectotodoc += $inafecto ; $afectotodoc += $afecto; $igvtodoc += $igv;
				}
				
				if( $data[$m]['moneda'] == '01' ) { $mone = 'S/.'; }else{ $mone = '$/.' ;}
				//DATOS DEL CLIENTE
				$rscli	 =	mysql_query("select ruc,razonsocial from cliente where codcliente ='".$data[$m]['cliente']."'" ,$cn );
				$rowcli  =	mysql_fetch_assoc( $rscli );				
				
				//fecha
				$fec = explode('-',substr($data[$m]['fecha'],0,10));
				$fecx = $fec[2].'-'.$fec[1].'-'.$fec[0];
			if($data[$m]['flag']!="A"){	
			//SUBTOTALES
				$sub_canti++;	$canti_ge++;
				$sub_canti_afecto 	+= $afectotodoc; 
				$sub_canti_inafecto += $inafectotodoc; 
				$sub_canti_igv 		+= $igvtodoc;
				
				//TOTALES GENERALES
				
				$canti_afecto_ge 	+= $afectotodoc; 
				$canti_inafecto_ge  += $inafectotodoc; 
				$canti_igv_ge 		+= $igvtodoc;
				
						
	?>
	<tr bgcolor="#F9F9F9" onclick="entrada(this)">
	  <td align="left" bgcolor="#F9F9F9" ><img style="cursor:pointer" alt="" onclick="doc_det('<?=$data[$m]['cod_cab'] ;?>')" src="imagenes/ico_lupa.png" width="15" height="15" /></td>
	  <td align="left" bgcolor="#F9F9F9" ><span class="Estilo10"><?='&nbsp;'.$fecx;?></span></td>
	  <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?=$data[$m]['cod_ope']; ?></span></td>
	  <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?=$data[$m]['Num_doc']?></span></td>
	  <td align="center" bgcolor="#F9F9F9"><span class="Estilo10">&nbsp;<?=$rowcli['ruc'];?>&nbsp;</span></td>
	  <td align="left" bgcolor="#F9F9F9"><span class="Estilo10">&nbsp;<?php echo utf8_encode($rowcli['razonsocial']);?></span></td>
	  <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?=$mone ; ?>&nbsp;</span></td>
	  <td align="right"  bgcolor="#F9F9F9"><span class="Estilo10">&nbsp;<?=number_format($afectodolar,2);?>&nbsp;</span></td>
	  <td align="right"  bgcolor="#F9F9F9"><span class="Estilo10">&nbsp;<?=$data[$m]['tc'];?>&nbsp;</span></td>
	  <td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"><?=number_format($afectotodoc,2) ?>&nbsp;</span></td>
	  <td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"><?=number_format($inafectotodoc,2) ;?>&nbsp;</span></td>
	  <td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"><?=number_format($igvtodoc,2);?>&nbsp;</span></td>
	  <td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"><?=number_format($afectotodoc+$inafectotodoc+$igvtodoc,2);?></span></td>
	</tr>
	<?php }else{?>
		<tr bgcolor="#F9F9F9" onclick="entrada(this)">
	  <td align="left" bgcolor="#F9F9F9" ><img style="cursor:pointer" alt="" onclick="doc_det('<?=$data[$m]['cod_cab'] ;?>')" src="imagenes/ico_lupa.png" width="15" height="15" /></td>
	  <td align="left" bgcolor="#F9F9F9" ><span class="anulado"><?='&nbsp;'.$fecx;?></span></td>
	  <td align="center" bgcolor="#F9F9F9"><span class="anulado"><?=$data[$m]['cod_ope']; ?></span></td>
	  <td align="center" bgcolor="#F9F9F9"><span class="anulado"><?=$data[$m]['Num_doc']?></span></td>
	  <td align="center" bgcolor="#F9F9F9"><span class="anulado">&nbsp;<?=$rowcli['ruc'];?>&nbsp;</span></td>
	  <td align="left" bgcolor="#F9F9F9"><span class="anulado">&nbsp;<?php echo utf8_encode($rowcli['razonsocial']);?></span></td>
	  <td colspan="7" align="center" bgcolor="#F9F9F9" style="letter-spacing:50px;">ANULADO</td>
    </tr>

	<? 	
	}
		$afectotodoc = 0; $inafectotodoc =0 ; $igvtodoc = 0; }   ?>
	<? if( $b != $c ) { ?> 
    <tr bgcolor="#F9F9F9" onclick="entrada(this)">
	  <td width="50" height="21" colspan="2" bgcolor="#F9F9F9">&nbsp;</td>
	  <td bgcolor="#F9F9F9">&nbsp;</td>
	  <td colspan="2" bgcolor="#F9F9F9">&nbsp;</td>
	  <td colspan="4" bgcolor="#F9F9F9"><span class="subcabeza">SubTotal</span><span class="Estilo7">( <?=$sub_canti ;?> )  </span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="subcabeza"> <?=number_format($sub_canti_afecto ,2 ); ?></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="subcabeza"><?=number_format($sub_canti_inafecto,2 );?></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="subcabeza"><?=number_format($sub_canti_igv ,2 );?></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="subcabeza"><?=number_format($sub_canti_afecto+$sub_canti_inafecto+$sub_canti_igv ,2 );?></span></td>
    </tr>
	<? $sub_canti = 0 ;$sub_canti_afecto=0;$sub_canti_inafecto=0;$sub_canti_igv=0;} ?>
	<tr>
	  <td height="21" colspan="13" bgcolor="#F9F9F9">&nbsp;</td>
    </tr>
	    <? } ?>
	<? } ?> 
	<tr bgcolor="#F9F9F9" onclick="entrada(this)">
	  <td width="50" height="21" colspan="2" bgcolor="#F9F9F9">&nbsp;</td>
	  <td bgcolor="#F9F9F9">&nbsp;</td>
	  <td colspan="2" bgcolor="#F9F9F9">&nbsp;</td>
	  <td colspan="4" bgcolor="#F9F9F9"><span class="total">TOTAL GENERAL( <?=$canti_ge?> )</span> <span class="total">
	  </span><span class="total"></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="total"><?=number_format($canti_afecto_ge,2); ?></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="total"><?=number_format($canti_inafecto_ge ,2);?></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="total"><?=number_format($canti_igv_ge,2);?></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="total"><?=number_format($canti_afecto_ge+$canti_inafecto_ge+$canti_igv_ge,2);?></span></td>
	</tr>
</table>
|
<?php
 
	$registros=30;
	$total_paginas 		= 	ceil($total_registros / $registros);
?>
<table width="100%" height="21" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="311" height="21" align="left" valign="bottom" style="color:#333333"><span class="Estilo10">Viendo del <strong><?php echo $inicio+1?></strong> al<strong><?php echo $inicio+$resultados2 ?></strong>(de <strong><?php echo $total_registros?></strong> documentos)</span>.</td>
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