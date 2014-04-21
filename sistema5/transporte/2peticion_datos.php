<?
session_start();
include('conex_inicial.php');
include('../funciones/funciones.php');
$peticion=$_REQUEST['peticion'];
$codigo=$_REQUEST['codigo'];
$codprod=$_REQUEST['codprod'];
$prodet=$_REQUEST['prodet'];
$punto=$_REQUEST['punto'];
$puntosaldo=$_REQUEST['puntosaldo'];
$condicion=$_REQUEST['condicion'];
$efectivo=$_REQUEST['efectivo'];

switch($peticion){
	case "save_canje":
		 
		 $strSQL="select  max(num_doc) as codigo from punto_mov  where cod_ope='PU' ";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$numero=$row['codigo']+1;
		$numero=str_pad($numero, 7, "0", STR_PAD_LEFT);
		 
		$strSQL3="insert into punto_mov(fec_punt,cod_trans,cod_ope,num_doc,punt_acumulado,efectivo,cod_prod,nom_prod,punt_saldo,cod_vendedor,pc,estado)values('".cambiarfecha($fecha)."','".$codigo."','PU','".$numero."','".$punto."','".$efectivo."','".$codprod."','".$prodet."','".$puntosaldo."','".$_SESSION['codvendedor']."','".$_SESSION['pc_ingreso']."','".$estado."')";
		mysql_query($strSQL3,$cn);
		
		
		$strSQL3="update transp_cliente set saldo_punto=saldo_punto+".$punto."  where cod_trans='".$codigo."' "; //and total_punto=''
		mysql_query($strSQL3,$cn);
		
		
		echo "num_docs:".$numero;
	break;
	case "anular_canje":
	$codigo=str_pad($codigo, 11, "0", STR_PAD_LEFT);
		
	$strSQL_ref2="update punto_mov set estado='$condicion' where cod_punto='".$codigo."' ";
	mysql_query($strSQL_ref2);
	
	//actualizar saldo
	$resultados11 = mysql_query("select * from punto_mov  where cod_punto='".$codigo."' ",$cn); 
	$rowSM=mysql_fetch_array($resultados11);
	$cod_trans=$rowSM['cod_trans'];
	$puntacu=$rowSM['punt_acumulado'];
	if ($condicion=='A'){
		$Sal_D=" saldo_punto-'".$puntacu."' ";
	}else{
		$Sal_D=" '".$puntacu."'+saldo_punto ";
	}	
	//validar desanular
	$resulA = mysql_query("select *,".$Sal_D." as SaldoX from transp_cliente 
	 where cod_trans='".$cod_trans."' ",$cn); 
	$rowA=mysql_fetch_array($resulA);
	$tol_p=$rowA['total_punto'];
	$SaldoX=$rowA['SaldoX'];

	if ($SaldoX>$tol_p){
		echo 'error';	
		$strSQL_ref2="update punto_mov set estado='A' where cod_punto='".$codigo."' ";
		mysql_query($strSQL_ref2);			
	}else{
		$strSQL_ref2="update transp_cliente set saldo_punto=".$Sal_D." 
		where cod_trans='".$cod_trans."'";
		mysql_query($strSQL_ref2);
	}
		
	break;
	
	case "rec_punto":
if ($codigo!='x'){ 
$where =" and MH.placa='$codigo' ";
$where2 =" and placa='$codigo' ";
}else{ $where =""; $where2 =""; }	
		
	$strSQL="SELECT MH.placa,sum( total ) / 1.38 AS tot_punto,fec_alta
FROM master_historial MH
INNER JOIN transp_cliente TC ON MH.placa = TC.placa
WHERE estado = 'S' $where
GROUP BY MH.placa,fec_alta ";
	$resultadoX=mysql_query($strSQL,$cn);
	while($rowX=mysql_fetch_array($resultadoX)){
	
		//rnago por fecha de inico de actividad
		//echo $rowX['fec_alta'].'-';
				
		$resultados11 = mysql_query("select sum( total )  AS tot_punto, master_historial.*  from master_historial  
		where placa='".$rowX['placa']."'
		and fec_hor_des>='".$rowX['fec_alta']."'  ",$cn); 	
		 //	 fec_hor_des BETWEEN '".$rowX['fec_alta']."' AND '".cambiarfecha($fecha)."'
	    $rowTP=mysql_fetch_array($resultados11);
	    //echo $T_punto=$rowTP['tot_punto'].'<br>';	
		
		list($factor)=mysql_fetch_row(mysql_query("select factor from factores where '".substr($rowTP['fec_hor_des'],0,10)."'  between fecha and fecha2 limit 1"));

		if($factor=='' || $factor==0){
		$factor=1;
		}	
		
		if ($codigo!='x'){ //--------------2013				
		$strSQL_ref2=" update transp_cliente set 
		total_punto='".$rowTP['tot_punto']/$factor."' 	where
		  placa='$codigo' and estado ='S' ";	
		}else{ //--------------2013	
			$strSQL_ref2=" update transp_cliente set 
		total_punto='".$rowTP['tot_punto']/$factor."' 	where
		  placa='".$rowX['placa']."' and estado ='S' ";	
		}  //--------------2013	
		  
		
			
		mysql_query($strSQL_ref2);
		
	}
	// recalculo de punto cangeados
	$strSQL_ref2=" update transp_cliente set saldo_punto='0' and estado='S' ";
	mysql_query($strSQL_ref2);
	
	$strSQL="SELECT placa,sum( punt_acumulado ) AS punto,fec_alta
FROM punto_mov PM
INNER JOIN transp_cliente TC ON PM.cod_trans = TC.cod_trans
WHERE TC.estado = 'S' and PM.estado <> 'A' $where2
GROUP BY TC.cod_trans,fec_alta ";
	$resultadoX=mysql_query($strSQL,$cn);
	while($rowX=mysql_fetch_array($resultadoX)){		
	
	if ($codigo!='x'){ //--------------2013	
	$strSQL_ref2=" update transp_cliente set saldo_punto='".$rowX['punto']."'  
		where  placa='".$codigo."' and estado ='S' and fec_alta>='".substr($rowX['fec_alta'],0,10)."'  ";
	}else{//--------------2013	
	$strSQL_ref2=" update transp_cliente set saldo_punto='".$rowX['punto']."'  
		where  placa='".$rowX['placa']."' and estado ='S' and fec_alta>='".substr($rowX['fec_alta'],0,10)."'  ";
	}	//--------------2013	
		
		mysql_query($strSQL_ref2);
	}
	
		echo 'Recalculando punto ..';	
		
	break;
	

}
?>
