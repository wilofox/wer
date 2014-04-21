<? session_start();
   include('../conex_inicial.php');
   include('../funciones/consolidado_ventas.php');
   
    //SIRVE PARA SACAR TODOS LOS DOCUMENTOS SELECCIONADOS DE ESTE REPORTE Y DE LA SESSION INGRESADA 
    $reporte 	= 	'CONSOLIDADO_VENTA';
    $documentos = 	'';
	
	//Filtro de Empresa y Sucursal ..... Sucursal depende del campo Empresa 
	if(	$_POST['cod_suc'] !=  'to' ){	if( $_POST['cod_tienda'] ==	'to' ){	$filtro1 = " and c.sucursal='".$_POST['cod_suc']."' ";	}
										else				 			  {	$filtro1 = " and c.sucursal='".$_POST['cod_suc']."' and c.tienda='".$_POST['cod_tienda']."' ";	}	
	}
	
	//filtro del campo caja		
	if(	$_POST['codigo_caja'] !=  'to' )   {	$filtro2 	= 	" and c.serie='".$_POST['codigo_caja']."' "; }

	//filtro del campo vendedor		
	if( $_POST['codigo_usuario'] !=  'to' ){	$filtro3 	= 	" and c.cod_vendedor='".$_POST['codigo_usuario']."' "; }
    
	
	//Filtro de los campos de Tipos de Documentos
	$rstemp	=	mysql_query("Select documentos from temp where cod_user='".$_SESSION['codvendedor']."' and reporte='".$reporte."'",$cn);
	$rowtemp=	mysql_fetch_array($rstemp);
	if( !empty( $rowtemp['documentos'] ) ) $filtro0 = " and o.codigo in (".$rowtemp['documentos'].") ";
	
	//AGRUPACION POR VENDEDOR
	if(	$_POST['agrupacion'] ==  've' )    {  $agrupacion =	 mostrarEmpleados( $cn , $_POST['anio'] , $_POST['mes'] , $filtro0 , $filtro1 , $filtro2 , $filtro3 ); $agru = 'Vendedor'; }
    
	//AGRUPACION POR SUNAT	
    if(	$_POST['agrupacion'] ==  'codsu' )  {  $agrupacion = mostrarSunat( $cn , $_POST['anio'] , $_POST['mes'] , $filtro0 , $filtro1 , $filtro2 , $filtro3 ); $agru = 'Codigo Sunat'; }
    
	//AGRUPACION POR DOCUMENTO
    if(	$_POST['agrupacion'] ==  'doc' )    {  $agrupacion = mostrarDocumeto( $cn , $_POST['anio'] , $_POST['mes'] , $filtro0 , $filtro1 , $filtro2 , $filtro3 ); $agru = 'Documento'; }
    	
	
 // print_r($vendedores);
  
?>
<table width="600" border="0" cellpadding="1" cellspacing="1" class="tr_square2">
	<tr style="background:url('imagenes/bg_contentbase2.gif');  background-position:100% 40%;">
	  <td width="110" height="31" bgcolor="#006699"><div align="center"><span class="Estilo7 Estilo15">Fecha</span></div></td>
	  <td width="26" bgcolor="#006699"><div align="center"><span class="Estilo7 Estilo15">T.D.</span></div></td>
	  <td width="50" bgcolor="#006699"><div align="center"><span class="Estilo7 Estilo15">Doc-Ini</span></div></td>
	  <td width="26" bgcolor="#006699"><div align="center"><span class="Estilo7 Estilo15">T.D.</span></div></td>
	  <td width="50" bgcolor="#006699"><div align="center"><span class="Estilo7 Estilo15">Doc-Fin</span></div></td>
	  <td width="59" bgcolor="#006699" align="center"><span class="Estilo7 Estilo15">Cantidad</span></td>
	  <td width="57" style="display:none" align="right" bgcolor="#006699"><div align="center"><span class="Estilo7 Estilo15">Importe</span></div></td>
	  <td width="48" style="display:none" align="right" bgcolor="#006699"><div align="center"><span class="Estilo7 Estilo15">IGV</span></div></td>
	  <td width="80" style="display:none" align="right" bgcolor="#006699"><div align="center"><span class="Estilo7 Estilo15">Servicio</span></div></td>
	 <? if( $_POST['agrupacion'] !=  'codsu' ) { ?>  
	  <td width="76" align="right" bgcolor="#006699"><span class="Estilo7 Estilo15">Total(US$.)</span></td>
	 <? } ?>
	  <td width="79" align="right" bgcolor="#006699"><div align="center"><span class="Estilo7 Estilo15">Total(S/.)</span></div></td>
	</tr>
<?  $bad = 0 ; $tot_tvendia_dolares =0;	$tot_tvendia_soles=0 ; $sub_canti_tot=0;
    for ( $x=0 ; count($agrupacion) > $x ; $x++ ) { 
	
		if(	$_POST['agrupacion'] ==  've' )
		{	$a =  $agrupacion[$x-1]['cod_vendedor']; 
			$b  = $agrupacion[$x]['cod_vendedor'] ; 
			$c  = $agrupacion[$x+1]['cod_vendedor'] ;
		}
		//FILTRO POR SUNAT
		if(	$_POST['agrupacion'] ==  'codsu' )
		{	$a =  $agrupacion[$x-1]['sunat']; 
			$b  = $agrupacion[$x]['sunat'] ; 
			$c  = $agrupacion[$x+1]['sunat'] ;
		}
		//FILTRO POR DOCUMENTO
		if(	$_POST['agrupacion'] ==  'doc' )
		{	$a =  $agrupacion[$x-1]['cod_ope']; 
			$b  = $agrupacion[$x]['cod_ope'] ; 
			$c  = $agrupacion[$x+1]['cod_ope'] ;
		}
			
		//FILTRO POR VENDEDOR
		if(!empty(	$agrupacion[$x]['cod_vendedor']	) && $_POST['agrupacion'] ==  've' )			
		{	$filtro4    =    " and c.cod_vendedor='".$agrupacion[$x]['cod_vendedor']."'";
			$data  		=    obtenerFechasCodSunat( $cn , $_POST['anio'] , $_POST['mes'] , $filtro0 , $filtro1 , $filtro2 , $filtro3 , $filtro4 );
		}
		//FILTRO POR SUNAT
		if(!empty(	$agrupacion[$x]['sunat']	) && $_POST['agrupacion'] ==  'codsu' )			
		{	$filtro4    =    "  and o.sunat='".$agrupacion[$x]['sunat']."'";
			$data  		=    obtenerFechasCodSunat( $cn , $_POST['anio'] , $_POST['mes'] , $filtro0 , $filtro1 , $filtro2 , $filtro3 , $filtro4 );
		}
		//FILTRO POR DOCUMENTO
		if(!empty(	$agrupacion[$x]['cod_ope']	) && $_POST['agrupacion'] ==  'doc' )			
		{	$filtro4    =    " and c.cod_ope='".$agrupacion[$x]['cod_ope']."'";
			$data  		=    obtenerFechasCodSunat( $cn , $_POST['anio'] , $_POST['mes'] , $filtro0 , $filtro1 , $filtro2 , $filtro3 , $filtro4 );
		}				
		
		//FILTRO POR VENDEDOR		
		if(	$_POST['agrupacion'] ==  've' )      
		{	$strusu		= 	"select usuario from usuarios where codigo= '".$agrupacion[$x]['cod_vendedor']."' " ;
			$rsusu 		= 	mysql_query (  $strusu,$cn	);
			$rowusu		= 	mysql_fetch_array( $rsusu );
			$cab        = 	$rowusu['usuario'];
		}
		//FILTRO POR SUNAT
		if(	$_POST['agrupacion'] ==  'codsu' )      
		{	$cab = $agrupacion[$x]['sunat'] ;
				   
		}
		//FILTRO POR DOCUMENTO
		if(	$_POST['agrupacion'] ==  'doc' )      
		{	$strop		= 	"select descripcion from operacion where codigo= '".$agrupacion[$x]['cod_ope']."' " ;
			$rsop 		= 	mysql_query (	$strop,$cn	);
			$rowop		= 	mysql_fetch_array( $rsop );
			$cab        = 	$rowop['descripcion'];       
		}
		if( $a != $b ) {
	   ?>
	<tr>
	  <td height="21" colspan="<?  if( $_POST['agrupacion'] ==  'codsu' ) { echo '11';}else echo '10'; ?>" bgcolor="#F9F9F9"><span class="cabeza"><?=$agru ;?>: <?=$cab?></span></td>
    </tr>
	<? } 
	    //verificar signo y tipo de cambio
		$sig = 1;
		
		for( $m = 0 ; count( $data ) > $m ; $m++ )
		{	$filtro5    = " and  DATE_FORMAT(c.fecha, '%Y-%m-%d') = '".$data[$m]['fecha']."'";
		
		//echo $filtro5;
			$datasunatfecha =  mostrarEmpleados_Sunat_Fecha( $cn , $_POST['anio'] , $_POST['mes'] , $filtro0 , $filtro1 , $filtro2 , $filtro3 , $filtro4 , $filtro5 );	
			for( $k = 0 ; count( $datasunatfecha ) > $k ; $k++ )
			{	
				$rsdmov	=	mysql_query("select cod_ope,numero,tcambio,moneda,precio,cantidad,imp_item,tipo,flag_kardex from det_mov where cod_cab =".$datasunatfecha[$k]['cod_cab'] );
				
				//echo "select cod_ope,numero,tcambio,moneda,precio,cantidad,imp_item,tipo,flag_kardex from det_mov where cod_cab =".$datasunatfecha[$k]['cod_cab'];
				
				while(  $rowdmov  =	 mysql_fetch_assoc( $rsdmov ) )
				{  
				
				$sig 		= 1;	$montdoc_soles=0;	$montdoc_dolares =0;
					$imp_item 	= $rowdmov['imp_item']; 
					$tcambio  	= $rowdmov['tcambio'];
				
					//si  se resta si es diferente
					if( $rowdmov['tipo'] !=  $rowdmov['flag_kardex'] ){ $sig = -1 ; $imp_item = $imp_item*$sig ;  }
					
					//Si es buscqueda por sunat se transforma todo a soles
					if(  $_POST['agrupacion'] ==  'codsu' )
					{ 	if( $rowdmov['moneda'] == '02' ){ $montdoc_soles 	= $imp_item*$tcambio ; $montdoc_dolares	=	0; }  
						else                            { $montdoc_soles 	= $imp_item; $montdoc_dolares	=	0; }
					}
					else
					{	if( $rowdmov['moneda'] == '02' ){ $montdoc_dolares 	= $imp_item; 	} 
						else							{ $montdoc_soles 	= $imp_item;	}
					}
					$monttodoc_soles += $montdoc_soles; $monttodoc_dolares += $montdoc_dolares;
				}
			}
		
		$fec = explode( '-', $data[$m]['fecha'] );
		$cant = count( $datasunatfecha );	
		//SUBTOTALES POR FILTRO
		$sub_cantito 			+= 	count( $datasunatfecha );
		$sub_monttodoc_soles  	+= 	$monttodoc_soles  ; 
		$sub_monttodoc_dolares  += 	$monttodoc_dolares ; 
		
		//TOTALES POR FILTRO
		$totge_cantito 			 += count( $datasunatfecha );
		$totge_monttodoc_soles 	 += $monttodoc_soles ; 
		$totge_monttodoc_dolares += $monttodoc_dolares ; 
		
		?>
	<tr>
	  <td bgcolor="#F9F9F9"><span class="Estilo10"><?=$fec[2].'-'.$fec[1].'-'.$fec[0]; ?></span></td>
	  <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?=$datasunatfecha[0]['cod_ope'] ?></span></td>
	  <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?=$datasunatfecha[0]['serie'].'-'.$datasunatfecha[0]['Num_doc']?></span></td>
	  <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?=$datasunatfecha[$cant-1]['cod_ope'] ?></span></td>
	  <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?=$datasunatfecha[$cant-1]['serie'].'-'.$datasunatfecha[$cant-1]['Num_doc']?></span></td>
	  <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?=$cant;?></span></td>
	  <td align="right"  style="display:none" bgcolor="#F9F9F9"><span class="Estilo10"><?=$importe?></span></td>
	  <td align="right"  style="display:none" bgcolor="#F9F9F9"><span class="Estilo10"><?=$igv?></span></td>
	  <td align="right"  style="display:none" bgcolor="#F9F9F9"><span class="Estilo10"><?=$servicio?></span></td>
	  <? if( $_POST['agrupacion'] !=  'codsu' ) { ?><td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"><?=number_format($monttodoc_dolares,2) ;?></span></td><? } ?> 
	  <td align="right"  bgcolor="#F9F9F9"><span class="Estilo10"><?=number_format($monttodoc_soles,2);?></span></td>
	</tr><? $monttodoc_dolares = 0 ;$monttodoc_soles = 0;} ?>
	<? if( $b != $c ) { ?> 
    <tr>
	  <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
	  <td bgcolor="#F9F9F9">&nbsp;</td>
	  <td colspan="2" bgcolor="#F9F9F9">&nbsp;</td>
	  <td bgcolor="#F9F9F9"><span class="Estilo7">SubTotal( <?=$sub_cantito?> )</span></td>
	  <td align="center" bgcolor="#F9F9F9"><span class="Estilo7">&nbsp;</span></td>
	  <td style="display:none" align="right" bgcolor="#F9F9F9">0</td>
	  <td style="display:none" align="right" bgcolor="#F9F9F9">0</td>
	  <td style="display:none" align="right" bgcolor="#F9F9F9">0</td>
	  <? if( $_POST['agrupacion'] !=  'codsu' ){ ?><td align="right" bgcolor="#F9F9F9"><span class="Estilo7"><?=number_format($sub_monttodoc_dolares,2); ?></span></td><? } ?>
	  <td align="right" bgcolor="#F9F9F9"><span class="Estilo7"><?=number_format($sub_monttodoc_soles ,2);?></span></td>
	</tr>
	<? $sub_cantito = 0 ; $sub_monttodoc_dolares = 0; $sub_monttodoc_soles = 0 ;} ?>
	<tr>
	  <td height="21" colspan="11" bgcolor="#F9F9F9">&nbsp;</td>
    </tr>
	<? } ?> 
	<tr>
	  <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
	  <td bgcolor="#F9F9F9">&nbsp;</td>
	  <td colspan="2" bgcolor="#F9F9F9">&nbsp;</td>
	  <td bgcolor="#F9F9F9"><span class="total">TOTAL GENERAL( <?=$totge_cantito?> )</span> </td>
	  <td align="center" bgcolor="#F9F9F9"><span class="total">&nbsp;</span></td>
	  <td style="display:none" align="right" bgcolor="#F9F9F9"><span class="total"><?// echo number_format($importe_tot,2)?></span></td>
	  <td style="display:none" align="right" bgcolor="#F9F9F9"><span class="total"><?// echo number_format($igv_tot,2)?></span></td>
	  <td style="display:none"  align="right" bgcolor="#F9F9F9"><span class="total"><?// echo number_format($servicio_total,4)?></span></td>
	  <? if( $_POST['agrupacion'] !=  'codsu' ){ ?><td align="right" bgcolor="#F9F9F9"><span class="total"><?=number_format($totge_monttodoc_dolares  ,2); ?></span></td><? } ?>
	  <td align="right" bgcolor="#F9F9F9"><span class="total"><?=number_format($totge_monttodoc_soles,2);?></span></td>
	</tr>
</table>
