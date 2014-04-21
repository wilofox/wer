<? 
    function mostrarEmpleados( $cn , $anio , $mes , $filtro0 , $filtro1 , $filtro2 , $filtro3 )
	{
		$strvend = mysql_query("SELECT c.cod_vendedor,c.fecha
								FROM cab_mov AS c
								INNER JOIN operacion AS o ON o.codigo=c.cod_ope 
								WHERE c.tipo='2' AND YEAR(c.fecha)='".$anio."'  AND MONTH(c.fecha)='".$mes."' ".$filtro0.$filtro1.$filtro2.$filtro3." AND o.sunat!='' AND c.flag!='A' AND c.deuda='S' GROUP BY c.cod_vendedor ORDER BY c.cod_vendedor,c.fecha ");
         
		while( $rowvend = mysql_fetch_assoc( $strvend ))
		{   
			$temp['cod_vendedor'] = $rowvend['cod_vendedor'];
			$temp['fecha'] = $rowvend['fecha'];
			$data[] = $temp;
		}
		return $data;
	}
	
	function mostrarSunat( $cn , $anio , $mes , $filtro0 , $filtro1 , $filtro2 , $filtro3 )
	{   
		$strsunat = mysql_query("SELECT o.sunat,c.fecha
								FROM cab_mov AS c
								INNER JOIN operacion AS o ON o.codigo=c.cod_ope 
								WHERE c.tipo='2' AND YEAR(c.fecha)='".$anio."'  AND MONTH(c.fecha)='".$mes."' ".$filtro0.$filtro1.$filtro2.$filtro3." AND o.sunat!='' AND c.flag!='A' AND c.deuda='S' GROUP BY o.sunat ORDER BY o.sunat,c.fecha ");
     
	   while( $rowsunat = mysql_fetch_assoc( $strsunat ))
		{   
			$temp['sunat'] = $rowsunat['sunat'];
			$temp['fecha'] = $rowsunat['fecha'];
			$data[] = $temp;
		}
		return $data;
	}
	
	function mostrarDocumeto( $cn , $anio , $mes , $filtro0 , $filtro1 , $filtro2 , $filtro3 )
	{
		$strsunat = mysql_query("SELECT c.cod_ope,c.fecha
								FROM cab_mov AS c
								INNER JOIN operacion AS o ON o.codigo=c.cod_ope 
								WHERE c.tipo='2' AND YEAR(c.fecha)='".$anio."'  AND MONTH(c.fecha)='".$mes."' ".$filtro0.$filtro1.$filtro2.$filtro3." AND o.sunat!='' AND c.flag!='A' AND c.deuda='S' GROUP BY c.cod_ope ORDER BY c.cod_ope,c.fecha ");
        while( $rowsunat = mysql_fetch_assoc( $strsunat ))
		{   
			$temp['cod_ope'] = $rowsunat['cod_ope'];
			$temp['fecha'] = $rowsunat['fecha'];
			$data[] = $temp;
		}
		return $data;
	}
	function obtenerFechasCodSunat( $cn , $anio , $mes , $filtro0 , $filtro1 , $filtro2 , $filtro3 , $filtro4 )
	{   $sqlvend ="SELECT DATE_FORMAT(c.fecha, '%Y-%m-%d') as fecha
								FROM cab_mov AS c
								INNER JOIN operacion AS o ON o.codigo=c.cod_ope 
								WHERE c.tipo='2' AND YEAR(c.fecha)='".$anio."'  AND MONTH(c.fecha)='".$mes."' ".$filtro0.$filtro1.$filtro2.$filtro3.$filtro4." AND o.sunat!='' AND c.flag!='A' AND c.deuda='S' GROUP BY DATE_FORMAT(c.fecha, '%Y-%m-%d')  order by c.fecha ";
		
		$strvend = mysql_query( $sqlvend  ,$cn );
        while( $rowvend = mysql_fetch_assoc( $strvend ))
		{   $temp['fecha'] 		= 	$rowvend['fecha'];
			$data[] = $temp;
		}
		return $data;
	}
	
	function mostrarEmpleados_Sunat_Fecha( $cn , $anio , $mes , $filtro0 , $filtro1 , $filtro2 , $filtro3 , $filtro4 , $filtro5 )
	{   $sqlvend ="SELECT c.cod_cab ,c.cod_ope,o.sunat,c.serie,c.Num_doc,c.moneda,c.impto1,c.tc,c.igv,c.total,c.inafecto,c.total
								FROM cab_mov AS c
								INNER JOIN operacion AS o ON o.codigo=c.cod_ope 
								WHERE c.tipo='2' AND YEAR(c.fecha)='".$anio."'  AND MONTH(c.fecha)='".$mes."' ".$filtro0.$filtro1.$filtro2.$filtro3.$filtro4.$filtro5." AND o.sunat!='' AND c.flag!='A' AND c.deuda='S'  ";
		//echo $sqlvend;
		$strvend = mysql_query( $sqlvend  ,$cn );
        while( $rowvend = mysql_fetch_assoc( $strvend ))
		{   $temp['cod_cab'] 	= 	$rowvend['cod_cab'];
		    $temp['cod_ope'] 	= 	$rowvend['cod_ope'];
			$temp['serie'] 		= 	$rowvend['serie'];
			$temp['Num_doc'] 	= 	$rowvend['Num_doc'];
			$temp['moneda'] 	= 	$rowvend['moneda'];
			$temp['impt1'] 		= 	$rowvend['impt1'];
			$temp['tc'] 		= 	$rowvend['tc'];
			$temp['igv'] 		= 	$rowvend['igv'];
			$temp['total'] 		= 	$rowvend['total'];
			$temp['inafecto'] 	= 	$rowvend['inafecto'];
			
			$data[] = $temp;
		}
		return $data;
	}
	
?>