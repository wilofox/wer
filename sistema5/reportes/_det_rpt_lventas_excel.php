<? 
//header("Content-type: application/vnd.ms-excel");
//header("Content-Disposition: attachment; filename=excel.xls");

//session_start();
   include('../conex_inicial.php');
   include('../funciones/l_rpt_ventas.php');
   
	$registros 	= 	531; 
	$moneda		=	'S/.';
	$agru = 'Codigo Sunat'; 
	$reporte    = 	'LIBRO_VENTAS';
 
    //SIRVE PARA SACAR TODOS LOS DOCUMENTOS SELECCIONADOS DE ESTE REPORTE Y DE LA SESSION INGRESADA 
    //$reporte 	= 	'CONSOLIDADO_VENTA';
    $documentos = 	'';
	
	//Filtro de Empresa y Sucursal ..... Sucursal depende del campo Empresa 
	if(	$_GET['cod_suc'] !=  'to' ){	if( $_GET['cod_tienda'] ==	'0' ){	$filtro1 = " and c.sucursal='".$_GET['cod_suc']."' ";	}
										else				 			  {	$filtro1 = " and c.sucursal='".$_GET['cod_suc']."' and c.tienda='".$_GET['cod_tienda']."' ";	}	
	}
	
	//filtro del campo caja		
	if(	$_GET['codigo_caja'] !=  'to' )   {	$filtro2 	= 	" and c.serie='".$_GET['codigo_caja']."' "; }
	
	//filtro del campo vendedor		
	if( $_GET['codigo_usuario'] !=  'to' ){	$filtro3 	= 	" and c.cod_vendedor='".$_GET['codigo_usuario']."' "; }

	//filtro del campo turno
	if(	$_GET['codigo_turno']	!=	 "to"	)	{
		$rstu	   = mysql_query("select hinicio,hfin from turno where id='".$_GET['codigo_turno']."'",$cn);
		$rowtu	   = mysql_fetch_array(	$rstu );
		$filtro4   = " and substring(c.fecha,12,9) between '".$rowtu['hinicio']."' and '".$rowtu['hfin']."' ";
	}	
	
	//Filtro de los campos de Tipos de Documentos
	$rstemp	=	mysql_query("Select documentos from temp where cod_user='".$_REQUEST['coduser']."' and reporte='".$reporte."'",$cn);
	$rowtemp=	mysql_fetch_array($rstemp);
	if( !empty( $rowtemp['documentos'] ) ) $filtro0 = " and o.codigo in (".$rowtemp['documentos'].") ";
	
	//AGRUPACION POR SUNAT	
    $agrupacion = mostrarSunat( $cn , $_GET['fecha'] , $_GET['fecha2'] , $filtro0 , $filtro1 , $filtro2 , $filtro3 , $filtro4 ); 
	//echo "ola".$agrupacion;
	$fec_ini=explode("-",$_GET['fecha']);
	$fec_ini2=$fec_ini[2]."-".$fec_ini[1]."-".$fec_ini[0];
	$fec_fin=explode("-",$_GET['fecha2']);
	$fec_fin2=$fec_fin[2]."-".$fec_fin[1]."-".$fec_fin[0];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style>

.anulado  {text-decoration:line-through;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color:#990000; }
</style>
</head>
<body>
<center>
<table  >
<tr>
<td width="93"></td>
<td>
<table border="1" cellpadding="1" cellspacing="1"  width="636"  >
<tr><td colspan="6" align="center"><h3>Libro  de Ventas/Salidas <br/><?php echo "De :".$fec_ini2." al ".$fec_fin2 ?></h3>
    </td>
</tr>
	<tr  >
<td width="93"  align="center" valign="middle" bgcolor="#006699"><div align="center"><strong><span class="Estilo7 Estilo15" style="color:#FFFFFF">FECHA</span></strong></div></td>
		<td width="93"  align="center" valign="middle" bgcolor="#006699"><div align="center"><strong><span class="Estilo7 Estilo15" style="color:#FFFFFF">RUC</span></strong></div></td>
		<td width="93"  align="center" valign="middle" bgcolor="#006699"><div align="center"><strong><span class="Estilo7 Estilo15" style="color:#FFFFFF">RAZON SOCIAL</span></strong></div></td>
	  <td width="57" bgcolor="#006699" ><div align="center"><strong><span class="Estilo7 Estilo15"><span class="Estilo7 Estilo15 Estilo35" style="color:#FFFFFF">Doc</span></span></strong></div></td>
	  <td width="134" bgcolor="#006699"><div align="center"><strong><span class="Estilo7 Estilo15 Estilo35" style="color:#FFFFFF">N. Documento </span></strong></div></td>
	  <!--<td style="display:none"><div align="center"><strong><span class="Estilo7 Estilo15"><span class="Estilo7 Estilo15 Estilo35">Ruc</span></span></strong></div></td>
	  <td ><div align="center"><strong><span class="Estilo7 Estilo15">Razon Social</span></strong></div></td>
	  <td align="center"><div align="center"><strong><span class="Estilo7 Estilo15 Estilo35">Mon.</span></strong></div></td>
	  <td align="right" ><div align="center"><strong><span class="Estilo7 Estilo15 Estilo35">B. imp ($.)</span></strong></div></td>
	  <td align="right" ><div align="center"><strong><span class="Estilo7 Estilo15 Estilo35">TC</span></strong></div></td>-->
	  <td width="108" align="right" bgcolor="#006699"><div align="center"><strong><span class="Estilo7 Estilo15 Estilo35" style="color:#FFFFFF">B. imp (S/.)</span></strong></div></td>
	 <!-- <td align="right" ><span class="Estilo35 Estilo15 Estilo7"><strong>Inafectos</strong></span></td>-->
	  <td width="92" align="right" bgcolor="#006699"><span class="Estilo35 Estilo15 Estilo7" style="color:#FFFFFF"><strong>Impuesto</strong></span></td>
	  <td width="119" align="right" bgcolor="#006699"><span class="Estilo15 Estilo7" style="color:#FFFFFF"><strong>Total(S/.)</strong></span></td>
	</tr>
	
	<tr><td><?php echo count($agrupacion); ?></td></tr>
	
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
	<tr bgcolor="#F9F9F9" onClick="entrada(this)" >
<td height="20" colspan="6" bgcolor="#FFFFFF"><span class="cabeza"><?=$agru ;?>: <?=$cab?></span></td>
    </tr>
	<? } ?>
	<tr  onclick="entrada(this)" >
<td height="20" colspan="6" bgcolor="#FFFFFF">&nbsp;&nbsp; <span class="subcabeza">Serie: <?=$agrupacion[$x]['serie']?></span></td>
    </tr>	
	<?
		if(!empty($agrupacion[$x]['fecha'] ))
		{	$fecha 		=    explode('-' , substr( $agrupacion[$x]['fecha'] , 0 , 10	) )  ;
			
			//FILTRO POR SUNAT
			if( !empty(	$agrupacion[$x]['sunat'] ) && !empty( $agrupacion[$x]['serie'] ) )			
			{	//$filtro5    =    " and substring(c.fecha,1,10)='".$fecha[0].'-'.$fecha[1].'-'.$fecha[2]."' and o.sunat='".$agrupacion[$x]['sunat']."'";
				$data  		=    mostrarSunatDocFecha( $cn , $_GET['fecha'] , $_GET['fecha2'] , $filtro0 , $filtro1 , $filtro2 , $filtro3 , $filtro4 , $filtro5 , $agrupacion[$x]['sunat'] , $agrupacion[$x]['serie'] ); 
			}								
			
			//verificar signo y tipo de cambio
			$sig = 1;
			//$sub_canti 	+= count( $data );	$canti_ge += count( $data );
			for( $m = 0 ; count( $data ) > $m ; $m++ )
			{	//verificar el signo
				$rsdmov	=	mysql_query("select cod_cab,cod_ope,numero,tcambio,moneda,precio,cantidad,imp_item,tipo,flag_kardex from det_mov where cod_cab =".$data[$m]['cod_cab'] );
				while(  $rowdmov  =	 mysql_fetch_assoc( $rsdmov ) )
				{   $inafecto =0;   $afecto = 0; $igv =0;	$tcambio=$rowdmov['tcambio']; $afectodolar =0;
				
					if( $rowdmov['afectoigv']	==	'N'	){ 	$inafecto 	= 	number_format($rowdmov['imp_item'],2,".",""); }
					else								 { $afecto 	= 	number_format($rowdmov['imp_item'],2,".","")*100/( 100 + $data[$m]['impto1'] ) ;
					//$rowdmov['imp_item']/( 1 + $data[$m]['impto1'] ) ;
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
					$sub_canti++;	$canti_ge++;
				//SUBTOTALES
				
				$sub_canti_afecto 	+= $afectotodoc; 
				$sub_canti_inafecto += $inafectotodoc; 
				$sub_canti_igv 		+= $igvtodoc;
				
				//TOTALES GENERALES
				
				$canti_afecto_ge 	+= $afectotodoc; 
				$canti_inafecto_ge  += $inafectotodoc; 
				$canti_igv_ge 		+= $igvtodoc;				
	?>
	<tr  onclick="entrada(this)">

	  <td align="left" bgcolor="#FFFFFF" ><span class="Estilo10"><?='&nbsp;'.$fecx;?></span></td>
	  <td align="left" bgcolor="#FFFFFF" ><span class="Estilo10"><?='&nbsp;'.$rowcli['ruc'];?></span></td>
	  <td align="left" bgcolor="#FFFFFF" ><span class="Estilo10"><?='&nbsp;'.$rowcli['razonsocial'];?></span></td>
	  <td align="center" bgcolor="#FFFFFF"><span class="Estilo10"><?=$data[$m]['cod_ope']; ?></span></td>
	  <td align="center" bgcolor="#FFFFFF"><span class="Estilo10"><?=$data[$m]['serie']."-".$data[$m]['Num_doc']?></span></td>

	  <td align="right"  bgcolor="#FFFFFF"><span class="Estilo10"><?=number_format($afectotodoc,2) ?>&nbsp;</span></td>

	  <td align="right"  bgcolor="#FFFFFF"><span class="Estilo10"><?=number_format($igvtodoc,2);?>&nbsp;</span></td>
	  <td align="right"  bgcolor="#FFFFFF"><span class="Estilo10"><?=number_format($afectotodoc+$inafectotodoc+$igvtodoc,2);?></span></td>
	</tr>
	<?php }else{?>
	
		<tr  onclick="entrada(this)">

	  <td align="left" bgcolor="#FFFFFF" ><span class="anulado"><?='&nbsp;'.$fecx;?></span></td>
	  <td align="left" bgcolor="#FFFFFF" ><span class="Estilo10"><?='&nbsp;'.$rowcli['ruc'];?></span></td>
	  <td align="left" bgcolor="#FFFFFF" ><span class="Estilo10"><?='&nbsp;'.$rowcli['razonsocial'];?></span></td>
	  <td align="center" bgcolor="#FFFFFF"><span class="anulado"><?=$data[$m]['cod_ope']; ?></span></td>
	  <td align="center" bgcolor="#FFFFFF"><span class="anulado"><?=$data[$m]['serie']."-".$data[$m]['Num_doc']?></span></td>

	  <td colspan="3" align="center"  bgcolor="#FFFFFF" style="letter-spacing:50px;">ANULADO</td>
    </tr>
	
	<? 	}
		$afectotodoc = 0; $inafectotodoc =0 ; $igvtodoc = 0; }   ?>
	<? if( $b != $c ) { ?> 
    <tr  onclick="entrada(this)">
		<td></td>
		<td></td>
	  <td colspan="3" bgcolor="#FFFFFF"><span class="subcabeza">SubTotal</span><span class="Estilo7">( <?=$sub_canti ;?> )  </span></td>
	  <td align="right" bgcolor="#FFFFFF"><span class="subcabeza"> <?=number_format($sub_canti_afecto ,2 ); ?></span></td>
	  <!--<td align="right" bgcolor="#F9F9F9"><span class="subcabeza"><?=number_format($sub_canti_inafecto,2 );?></span></td>-->
	  <td align="right" bgcolor="#FFFFFF"><span class="subcabeza"><?=number_format($sub_canti_igv ,2 );?></span></td>
	  <td align="right" bgcolor="#FFFFFF"><span class="subcabeza"><?=number_format($sub_canti_afecto+$sub_canti_inafecto+$sub_canti_igv ,2 );?></span></td>
    </tr>
	<? $sub_canti = 0 ;$sub_canti_afecto=0;$sub_canti_inafecto=0;$sub_canti_igv=0;} ?>
	<tr>

	  <td height="21" colspan="8" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
	    <? } ?>
	<? } ?> 
	<tr onClick="entrada(this)">
		<td></td>
		<td></td>
	  <td height="21" colspan="3"  bgcolor="#FFFFFF"><span class="total">TOTAL GENERAL( <?=$canti_ge?> )</span> <span class="total">
	  </span><span class="total"></span></td>
	  <td align="right" bgcolor="#FFFFFF"><span class="total"><?=number_format($canti_afecto_ge,2); ?></span></td>
	  <!--<td align="right" bgcolor="#F9F9F9"><span class="total"><?=number_format($canti_inafecto_ge ,2);?></span></td>-->
	  <td align="right" bgcolor="#FFFFFF"><span class="total"><?=number_format($canti_igv_ge,2);?></span></td>
	  <td align="right" bgcolor="#FFFFFF"><span class="total"><?=number_format($canti_afecto_ge+$canti_inafecto_ge+$canti_igv_ge,2);?></span></td>
	</tr>
</table>
</td></tr></table>
</center>
</body>
</html>
