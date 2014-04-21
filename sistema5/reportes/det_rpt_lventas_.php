<? session_start();
   include('../conex_inicial.php');
   include('../funciones/l_rpt_ventas.php');
   
	$registros 	= 	531; 
	$moneda		=	'S/.';
	$agru = 'Codigo Sunat'; 
	$reporte    = 	'LIBRO_VENTAS';
 
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
	echo "Select documentos from temp where cod_user='".$_SESSION['codvendedor']."' and reporte='".$reporte."'";
	$rstemp	=	mysql_query("Select documentos from temp where cod_user='".$_SESSION['codvendedor']."' and reporte='".$reporte."'",$cn);
	$rowtemp=	mysql_fetch_array($rstemp);
	if( !empty( $rowtemp['documentos'] ) ) $filtro0 = " and o.codigo in (".$rowtemp['documentos'].") ";
	
	//AGRUPACION POR SUNAT	
    $agrupacion = mostrarSunat( $cn , $_POST['fecha'] , $_POST['fecha2'] , $filtro0 , $filtro1 , $filtro2 , $filtro3 , $filtro4 ); 
?>
<table width="742" border="0" cellpadding="1" cellspacing="1" class="tr_square2">
	<tr>
	  <td width="78" height="31" bgcolor="#006699"><div align="center"><span class="Estilo7 Estilo15">Fecha</span></div></td>
	  <td width="26" bgcolor="#006699"><div align="center"><span class="Estilo7 Estilo15"><span class="Estilo7 Estilo15 Estilo35">Doc</span></span></div></td>
	  <td width="80" bgcolor="#006699"><div align="center"><span class="Estilo7 Estilo15 Estilo35">N. Documento </span></div></td>
	  <td width="26" bgcolor="#006699"><div align="center"><span class="Estilo7 Estilo15"><span class="Estilo7 Estilo15 Estilo35">Ruc</span></span></div></td>
	  <td width="99" bgcolor="#006699"><div align="center">Razon Social </div></td>
	  <td width="59" bgcolor="#006699" align="center"><div align="center"><span class="Estilo7 Estilo15 Estilo35">Mon.</span></div></td>
	  <td width="57" align="right" bgcolor="#006699"><div align="center"><span class="Estilo7 Estilo15 Estilo35">B. imp ($.)</span></div></td>
	  <td width="48" align="right" bgcolor="#006699"><div align="center"><span class="Estilo7 Estilo15 Estilo35">TC</span></div></td>
	  <td width="80" align="right" bgcolor="#006699"><div align="center"><span class="Estilo7 Estilo15 Estilo35">B. imp (S/.)</span></div></td>
	  <td width="76" align="right" bgcolor="#006699"><span class="Estilo7 Estilo15 Estilo35">Inafectos</span></td>
	  <td width="39" align="right" bgcolor="#006699"><span class="Estilo7 Estilo15 Estilo35">Impuesto</span></td>
	  <td width="39" align="right" bgcolor="#006699"><span class="Estilo7 Estilo15">Total(S/.)</span></td>
	</tr>
<?  $bad = 0 ; $tot_tvendia_dolares =0;	$tot_tvendia_soles=0 ; $sub_canti_tot=0;
    for ( $x=0 ; count($agrupacion) > $x ; $x++ ) { 
	//AGRUPACION POR SUNAT
	$a =  $agrupacion[$x-1]['sunat']; 
	$b  = $agrupacion[$x]['sunat'] ; 
	$c  = $agrupacion[$x+1]['sunat'] ;
	
	if( $a != $b ) {
			//FILTRO POR SUNAT
		$cab = $agrupacion[$x]['sunat'] ;
	   ?>
	<tr>
	  <td height="10" colspan="11" bgcolor="#F9F9F9"><span class="cabeza"><?=$agru ;?>: <?=$cab?></span></td>
    </tr>
	<? } ?>
	<tr>
	  <td height="10" colspan="11" bgcolor="#F9F9F9">&nbsp;&nbsp; Serie: <?=$agrupacion[$x]['serie']?></td>
    </tr>	
	<?
		if(!empty($agrupacion[$x]['fecha'] ))
		{	$fecha 		=    explode('-' , substr( $agrupacion[$x]['fecha'] , 0 , 10	) )  ;
			
			//FILTRO POR SUNAT
			if( !empty(	$agrupacion[$x]['sunat'] ) && !empty( $agrupacion[$x]['serie'] ) )			
			{	$filtro5    =    " and substring(c.fecha,1,10)='".$fecha[0].'-'.$fecha[1].'-'.$fecha[2]."' and o.sunat='".$agrupacion[$x]['sunat']."'";
				$data  		=    mostrarSunatDocFecha( $cn , $_POST['fecha'] , $_POST['fecha2'] , $filtro0 , $filtro1 , $filtro2 , $filtro3 , $filtro4 , $filtro5 , $agrupacion[$x]['sunat'] , $agrupacion[$x]['serie'] ); 
			}
					
			$cantidad   =    count($data);									
			$tvendia_soles = 0; $tvendia_dolares  = 0; 
			
			//verificar signo y tipo de cambio
			$sig = 1;
			
			for( $m = 0 ; count( $data ) > $m ; $m++ )
			{	//verificar el signo
				$rsdmov	=	mysql_query("select cod_cab,cod_ope,numero,tcambio,moneda,precio,cantidad,imp_item,tipo,flag_kardex from det_mov where cod_cab =".$data[$m]['cod_cab'] );
				while(  $rowdmov  =	 mysql_fetch_assoc( $rsdmov ) )
				{   
					if( $rowdmov['afectoigv']	==	'N'	){ 	number_format($rowdmov['imp_item'],2,".",""); }
					else								 {  $afecto 	= 	number_format($rowdmov['imp_item'],2,".","")*100/( 100 + $data[$m]['impto1'] ) ;
					//$afecto 	= 	$rowdmov['imp_item']*100/( 100 + $rowdmov['tcambio'] ) ;
															$igv 		=  	number_format($rowdmov['imp_item'],2,".","")- $afecto;
														 }
					
					//si  se resta si es diferente
					if( $rowdmov['tipo'] !=  $rowdmov['flag_kardex'] ){ $sig = -1 ; $inafecto = $inafecto*$sig ; $afecto = $afecto*$sig; $igv = $igv*$sig;  }
					
					//si es dolar se transforma a soles
					if( $rowdmov['moneda'] == '02' ){  $inafecto = $inafecto*$tcambio ; $afecto = $afecto*$tcambio; $igv = $igv*$tcambio; }
					
					$inafectotodoc += $inafecto ; $afectotodoc += $afecto; $igvtodoc += $igv;
				}
				
				if( $data[$m]['moneda'] == '01' ) { $mone = 'S/.'; }else{ $mone = '$/.)' ;}
				//DATOS DEL CLIENTE
				$rscli	 =	mysql_query("select ruc,razonsocial from cliente where codcliente ='".$data[$m]['cliente']."'" ,$cn );
				$rowcli  =	mysql_fetch_assoc( $rscli );				
				
				//SUBTOTALES
				$sub_canti 			+= count( $data );
				$sub_canti_afecto 	+= $afectotodoc; 
				$sub_canti_inafecto += $inafectotodoc; 
				$sub_canti_igv 		+= $igvtodoc;
				
				//TOTALES GENERALES
				$canti_ge 			+= count( $data );
				$canti_afecto_ge 	+= $afectotodoc; 
				$canti_inafecto_ge  += $inafectotodoc; 
				$canti_igv_ge 		+= $igvtodoc;				
	?>
	<tr>
	  <td bgcolor="#F9F9F9"><span class="Estilo10"><?=$fecha[2].'-'.$fecha[1].'-'.$fecha[0]; ?></span></td>
	  <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?=$data[$m]['cod_ope']; ?></span></td>
	  <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?=$data[$m]['Num_doc']?></span></td>
	  <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?=$rowcli['ruc'];?></span></td>
	  <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?=$rowcli['razonsocial'];?></span></td>
	  <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?=; ?></span></td>
	  <td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"><?=number_format($data[$m]['b_imp'],4);?></span></td>
	  <td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"><?=$data[$m]['tc'];?></span></td>
	  <td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"><?=number_format($afectotodoc,4) ?></span></td>
	  <td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"><?=number_format($inafectotodoc,4) ;?></span></td>
	  <td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"><?=number_format($igvtodoc,4);?></span></td>
	  <td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"><?=number_format($afectotodoc+$inafectotodoc+$igvtodoc,4);?></span></td>
	</tr>
	<? 		$afectotodoc = 0; $inafectotodoc =0 ; $igvtodoc = 0; }   ?>
	<? if( $b != $c ) { ?> 
    <tr>
	  <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
	  <td bgcolor="#F9F9F9">&nbsp;</td>
	  <td colspan="2" bgcolor="#F9F9F9">&nbsp;</td>
	  <td bgcolor="#F9F9F9"><span class="Estilo7">SubTotal</span></td>
	  <td align="center" bgcolor="#F9F9F9"><span class="Estilo7"><?=$sub_canti?></span></td>
	  <td align="right" bgcolor="#F9F9F9">0</td>
	  <td align="right" bgcolor="#F9F9F9">0</td>
	  <td align="right" bgcolor="#F9F9F9"><span class="Estilo7"><?=number_format($sub_canti_afecto ,4 ); ?></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="Estilo7"><?=number_format($sub_canti_inafecto,4 );?></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="Estilo7"><?=number_format($sub_canti_igv ,4 );?></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="Estilo10"><?=number_format($sub_canti_afecto+$sub_canti_inafecto+$sub_canti_igv ,4 );?></span></td>
    </tr>
	<? $sub_canti = 0 ;$sub_canti_afecto=0;$sub_canti_inafecto=0;$sub_canti_igv=0;} ?>
	<tr>
	  <td height="21" colspan="12" bgcolor="#F9F9F9">&nbsp;</td>
    </tr>
	    <? } ?>
	<? } ?> 
	<tr>
	  <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
	  <td bgcolor="#F9F9F9">&nbsp;</td>
	  <td colspan="2" bgcolor="#F9F9F9">&nbsp;</td>
	  <td bgcolor="#F9F9F9"><span class="total">TOTAL GENERAL(<?=$canti_ge?>)</span> </td>
	  <td align="center" bgcolor="#F9F9F9"><span class="total"><?=$sub_canti_tot?></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="total">0</span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="total"></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="total"><?=number_format($canti_afecto_ge,4); ?></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="total"><?=number_format($canti_inafecto_ge ,4);?></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="total"><?=number_format($canti_igv_ge,4);?></span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="Estilo10"><?=number_format($canti_igv_ge,4);?></span></td>
	</tr>
</table>
