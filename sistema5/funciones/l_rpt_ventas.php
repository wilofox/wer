<? 
	function mostrarSunat( $cn , $fecha1 , $fecha2 , $filtro0 , $filtro1 , $filtro2 , $filtro3 , $filtro4 )
	{
	
			$sql = "SELECT o.sunat,c.serie,c.fecha,c.flag
								FROM cab_mov AS c
								INNER JOIN operacion AS o ON o.codigo=c.cod_ope 
								WHERE c.tipo='2' and substring(fecha,1,10) between '".$fecha1."' and '".$fecha2."' ".$filtro0.$filtro1.$filtro2.$filtro3.$filtro4." AND o.sunat!=''  GROUP BY o.sunat,c.serie ORDER BY o.sunat, c.serie ";
	
				$strsunat = mysql_query($sql);
       //c.deuda='S'
	   //echo $sql."<br>";
	   
		while( $rowsunat = mysql_fetch_assoc( $strsunat ))
		{   
			$temp['sunat'] = $rowsunat['sunat'];
			$temp['serie'] = $rowsunat['serie'];
			$temp['fecha'] = $rowsunat['fecha'];
			$data[] = $temp;
		}
		return $data;
	}

	function mostrarSunatDocFecha( $cn , $fecha1 , $fecha2 , $filtro0 , $filtro1 , $filtro2 , $filtro3 , $filtro4 , $filtro5 , $sunat , $serie  )
	{   $sqlvend ="SELECT c.cod_cab ,c.cod_ope,o.sunat,c.serie,c.Num_doc,c.ruc,c.cliente,c.fecha,c.f_venc,c.moneda,c.impto1,c.b_imp,c.tc,c.igv,c.percepcion,c.total,c.inafecto,c.total,c.flag
								FROM cab_mov AS c
								INNER JOIN operacion AS o ON o.codigo=c.cod_ope 
								WHERE c.tipo='2' and substring(fecha,1,10) between '".$fecha1."' and '".$fecha2."' ".$filtro0.$filtro1.$filtro2.$filtro3.$filtro4.$filtro5." and o.sunat ='".$sunat."' and c.serie = '".$serie."' AND o.sunat!=''  
								
								GROUP BY c.cod_cab, c.cod_ope
								
								 order by DATE(c.fecha), c.Num_doc ";
								 //AND c.deuda='S'
	//echo $sqlvend;
		$strvend = mysql_query( $sqlvend  ,$cn );
        while( $rowvend = mysql_fetch_assoc( $strvend ))
		{   $temp['cod_cab'] 	= 	$rowvend['cod_cab'];
		    $temp['cod_ope'] 	= 	$rowvend['cod_ope'];
			$temp['serie'] 		= 	$rowvend['serie'];
			$temp['Num_doc'] 	= 	$rowvend['Num_doc'];
			$temp['ruc'] 		= 	$rowvend['ruc'];
			$temp['cliente'] 	= 	$rowvend['cliente'];
			$temp['fecha'] 		= 	$rowvend['fecha'];
			$temp['f_venc'] 		= 	$rowvend['f_venc'];
			$temp['moneda'] 	= 	$rowvend['moneda'];
			$temp['impto1'] 	= 	$rowvend['impto1'];
			$temp['b_imp'] 		= 	$rowvend['b_imp'];
			$temp['tc'] 		= 	$rowvend['tc'];
			$temp['percepcion'] = 	$rowvend['percepcion'];
			$temp['igv'] 		= 	$rowvend['igv'];
			$temp['total'] 		= 	$rowvend['total'];
			$temp['inafecto'] 	= 	$rowvend['inafecto'];
			$temp['flag'] 	= 	$rowvend['flag'];
			
			$data[] = $temp;
		}
		return $data;
	}
	
		function mostrarSunatDocFecha_rj( $cn , $fecha1 , $fecha2 , $filtro0 , $filtro1 , $filtro2 , $filtro3 , $filtro4 , $filtro5 , $posreg=-1,$mosreg=-1 )
	{   
		//echo  $posreg."-".$mosreg;
	if($posreg >= 0  && $mosreg>=0){
		$limit=" limit ".(int)$posreg.",".(int)$mosreg;
	}else{
		$limit="";
	}
	// ren agrage agrupacion 
		$sqlvend ="
		SELECT 
			c.cod_cab,
			c.cod_ope,
			o.sunat,
			c.serie,
			c.Num_doc,
			c.ruc,
			c.cliente,
			c.fecha,
			c.f_venc,
			c.moneda,
			c.impto1,
			c.b_imp,
			c.tc,
			c.igv,
			c.percepcion,
			c.total,
			c.inafecto,
			c.total,
			c.flag
		FROM cab_mov AS c
		INNER JOIN operacion AS o ON o.codigo = c.cod_ope 
		WHERE c.tipo = '2' 
		AND DATE(c.fecha) BETWEEN '".$fecha1."' 
		AND '".$fecha2."' 
		".$filtro0.$filtro1.$filtro2.$filtro3.$filtro4.$filtro5."  
		AND o.sunat != ''
		 
		
		GROUP BY c.cod_cab, c.cod_ope
		
		ORDER BY o.sunat, c.serie, DATE(c.fecha), c.Num_doc ".$limit;
		//AND c.deuda = 'S'
		//echo $sqlvend."<br>";

		$strvend = mysql_query( $sqlvend  ,$cn );
        while( $rowvend = mysql_fetch_assoc( $strvend ))
		{   $temp['cod_cab'] 	= 	$rowvend['cod_cab'];
		    $temp['cod_ope'] 	= 	$rowvend['cod_ope'];
			$temp['sunat'] 		= 	$rowvend['sunat'];
			$temp['serie'] 		= 	$rowvend['serie'];
			$temp['Num_doc'] 	= 	$rowvend['Num_doc'];
			$temp['ruc'] 		= 	$rowvend['ruc'];
			$temp['cliente'] 	= 	$rowvend['cliente'];
			$temp['fecha'] 		= 	$rowvend['fecha'];
			$temp['f_venc'] 	= 	$rowvend['f_venc'];
			$temp['moneda'] 	= 	$rowvend['moneda'];
			$temp['impto1'] 	= 	$rowvend['impto1'];
			$temp['b_imp'] 		= 	$rowvend['b_imp'];
			//$temp['tc'] 		= 	$rowvend['tc'];
			$temp['igv'] 		= 	$rowvend['igv'];
			$temp['percepcion'] = 	$rowvend['percepcion'];
			$temp['total'] 		= 	$rowvend['total'];
			$temp['inafecto'] 	= 	$rowvend['inafecto'];
			$temp['flag'] 	= 	$rowvend['flag'];
			//*-*-*-*-*-*--*-*-*-*-*-*--*-*--*-*-*-*--*-*-*-*-*-*-*-*-*-*-*-*-*-*-
			//tipo de cambio tabla 
			$fecha =  substr($rowvend['fecha'],0,10);
			$SQLTC="SELECT * FROM tcambio WHERE STR_TO_DATE(fecha,'%d/%m/%Y') <= '$fecha'
			 order by STR_TO_DATE( fecha,  '%d/%m/%Y' )  desc ";
			$resulTC=mysql_query($SQLTC,$cn);
			$rowTC=mysql_fetch_array($resulTC);
			$temp['tc'] 		= 	$rowTC['venta'];
			//*-*-*-*-*-*--*-*-*-*-*-*--*-*--*-*-*-*--*-*-*-*-*-*-*-*-*-*-*-*-*-*-
			
			
			$data[] = $temp;
		}

		return $data;
	}
	
function mostrarSunatDocFecha_total_rj( $cn , $fecha1 , $fecha2 , $filtro0 , $filtro1 , $filtro2 , $filtro3 , $filtro4 , $filtro5,$sunat="",$serie=""){   
	$numdoc=0;
	if($sunat!="" && $serie!=""){
 		$n_filtro=" and o.sunat ='".$sunat."' and c.serie = '".$serie."'";
	}else{
		$n_filtro=" ";
	}
	// modificado agrupacion
	$sqlvend ="SELECT c.cod_cab ,c.cod_ope,o.sunat,c.serie,c.Num_doc,c.ruc,c.cliente,c.fecha,c.moneda,c.impto1,c.b_imp,c.tc,c.igv,c.percepcion,c.total,c.inafecto,c.total,c.flag as flag FROM cab_mov AS c INNER JOIN operacion AS o ON o.codigo=c.cod_ope WHERE c.tipo='2' and substring(fecha,1,10) between '".$fecha1."' and '".$fecha2."' ".$filtro0.$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$n_filtro." AND o.sunat!=''  

GROUP BY c.cod_cab, c.cod_ope

 order by o.sunat,c.serie,c.fecha ";
//AND c.deuda='S'
	$strvend = mysql_query( $sqlvend  ,$cn );
	while( $rowvend = mysql_fetch_assoc( $strvend )){   
	
		if($rowvend['flag']!="A"){	
			//$rsdmov	=	mysql_query("select cod_ope,numero,tcambio,moneda,precio,cantidad,imp_item,tipo,flag_kardex from det_mov where cod_cab =".$rowvend['cod_cab'] );
			$rsdmov	=	mysql_query("select D.cod_ope,numero,tcambio,D.moneda,precio,cantidad,imp_item,D.tipo,flag_kardex,percepcion,fecha from cab_mov C inner join  det_mov D on C.cod_cab=D.cod_cab where C.cod_cab =".$rowvend['cod_cab'] );
			
				
			while($rowdmov=mysql_fetch_assoc($rsdmov)){ 			
				$inafecto =0;   $afecto = 0; $igv =0 ;$percepcion =0 ;
				//$tcambio=$rowdmov['tcambio']; $afectodolar =0;
			if ($Temp==''){
			$Temp='xx';
			$percepcion=number_format($rowdmov['percepcion'],2,".","");
			}else{$percepcion=0;}	
			//*-*-*-*-*-*--*-*-*-*-*-*--*-*--*-*-*-*--*-*-*-*-*-*-*-*-*-*-*-*-*-*-
			//tipo de cambio tabla 
			$fecha =  substr($rowdmov['fecha'],0,10);
			$SQLTC="SELECT * FROM tcambio WHERE STR_TO_DATE(fecha,'%d/%m/%Y') <= '$fecha'
			 order by STR_TO_DATE( fecha,  '%d/%m/%Y' )  desc ";
			$resulTC=mysql_query($SQLTC,$cn);
			$rowTC=mysql_fetch_array($resulTC);
			$tcambio= 	$rowTC['venta'];
			//*-*-*-*-*-*--*-*-*-*-*-*--*-*--*-*-*-*--*-*-*-*-*-*-*-*-*-*-*-*-*-*-
			
			
							
				if( $rowdmov['afectoigv']	==	'N'	){ 
					$inafecto 	= 	number_format($rowdmov['imp_item'],2,".",""); 					
				}else{  
					//$afecto 	= 	$rowdmov['imp_item']*100/( 100 + $rowdmov['tcambio'] ) ;
					$afecto 	= 	number_format($rowdmov['imp_item'],2,".","")*100/( 100 + $rowvend['impto1'] ) ;
					$igv 		=  	number_format($rowdmov['imp_item'],2,".","")- $afecto;		
				}	
				//si  se resta si es diferente
				if( $rowdmov['tipo'] !=  $rowdmov['flag_kardex'] ){ 
					$sig = -1 ; $inafecto= $inafecto*$sig ; $afecto = $afecto*$sig; $igv = $igv*$sig;  					$percepcion = $percepcion*$sig;
				}	
	
				//si es dolar se transforma a soles
				if( $rowdmov['moneda'] == '02' ){ 
					$afectodolar = $afecto;$inafecto = $inafecto*$tcambio ; $afecto = $afecto*$tcambio; $igv = $igv*$tcambio; $percepcion = $percepcion*$tcambio; 
				}
				$inafectotodoc += $inafecto ; $afectotodoc += $afecto; $igvtodoc += $igv; 
				//$percepciontodoc += $percepcion;
				$percepciontodoc += $percepcion;
			}//end while
		}
		$Temp='';
		$numdoc++;
	}//end while
	
	$totdoc=$afectotodoc+$inafectotodoc+$igvtodoc+$percepciontodoc;
	$data['numdoc']=$numdoc;
	$data['afecto']=number_format($afectotodoc,2);
	$data['inafecto']=number_format($inafectotodoc,2);
	$data['igv']=number_format($igvtodoc,2);
	$data['percepcion']=number_format($percepciontodoc,2);
	$data['total']=number_format($totdoc,2);
	//$data['total']=$totdoc;
	return $data;
		//echo "inafecto:".$inafectotodoc."-afecto:".$afectotodoc."-igv:".$igvtodoc;
}
	
?>