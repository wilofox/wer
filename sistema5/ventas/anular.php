<? 
session_start();
include('../conex_inicial.php');
$codigo = $_REQUEST['CodDoc'];
$Condicion = $_REQUEST['Condicion'];
$modulo=$_REQUEST['modulo'];
if(isset($_REQUEST['Elim'])){
	$codigo=$_REQUEST['CodDoc'];
	//echo "Select * from pagos where referencia=$codigo";
	/*$rspa=mysql_query("Select * from pagos where referencia=$codigo",$cn);
	if(mysql_num_rows($rspa)>0){
		echo "pagos";
	}else{*/
		$sql=mysql_query("Select flag,tienda from cab_mov where cod_cab=$codigo",$cn);
		$row=mysql_fetch_array($sql);
		$sql1="Delete from cab_mov where cod_cab=$codigo";
		$sql2="Delete from det_mov where cod_cab=$codigo";
		$sql4="Delete from pagos where referencia=$codigo";
		$sql5="Delete from series where ingreso=$codigo";
		//Kardex	
		//echo $codigo;
		$Tienda="saldo".$row['tienda'];
		if($row['flag']==''){
			$sql=" select * from cab_mov CM inner join det_mov DM on CM.cod_cab=DM.cod_cab where kardex='S' and descargo='S' and CM.cod_cab='".$codigo."'"; //
 			$resultadoX=mysql_query($sql,$cn);
			while($rowX=mysql_fetch_array($resultadoX)){
			
			//----------------subunidadesssss---------------------------
				 $cantidad=$rowX['cantidad'];
				 $strSQL4="select * from producto where idproducto='".$rowX['cod_prod']."' ";
				 $resultado4=mysql_query($strSQL4,$cn);
				
				while($row4=mysql_fetch_array($resultado4)){
					$und_pr=$row4['und'];
					$factor_pr=$row4['factor']; 
				}
				//-----------------------------	
				if($und_pr != $rowX['unidad']){
				
					$strSQL_unid="select * from unixprod where producto='".$rowX['cod_prod']."' and unidad='".$rowX['unidad']."'";
					$resultado_unid=mysql_query($strSQL_unid,$cn);
					$row_unid=mysql_fetch_array($resultado_unid);
					$factor_subund=$row_unid['factor'];

					//$cantidad=$cantidad*($factor_pr/$factor_subund);
					if ($row_unid['mconv']=='P'){
					//procentual
					//$cantidad=$cantidad*($factor_pr/$factor_subund);
						$cantidad=$cantidad*$factor_subund;
					}else{
					//nominal
					//$cantidad=(($cantidad*$factor_subund)*10)/factor_pr;
						$FacSbU = explode('.',$factor_subund);
					//echo $FacSbU[0]		
						$SuT1=$cantidad*$FacSbU[0];	//5*1 - 5 
						$SuT2=$cantidad*$FacSbU[1];	//5*3 -	15
						$CatSu = explode('.',number_format($SuT2/$factor_pr,3,'.','.'));//agrege para redondeo
						//$CatSu = explode('.',$SuT2/$factor_pr); //15/12 - 1.25
						$SuT1=$SuT1+$CatSu[0]; //5+1 - 6
						$SuT2=($CatSu[1]*$factor_pr)/100; // (25*12)/100 - 3
						$SuT2= number_format($SuT2,0,'','');	 //agrege para redondeo
						$cantidad=$SuT1.'.'.$SuT2 ; //6.3
					}												
				}else{
					 $cantidad=$cantidad;
				}
				//------------------------------------------------------------------	
				$strSQL1="update producto set $Tienda=$Tienda+$cantidad where idproducto='".$rowX['cod_prod']."'";
				mysql_query($strSQL1,$cn);			
			} 
		}
		mysql_query($sql1,$cn);
		mysql_query($sql2,$cn);
		mysql_query($sql4,$cn);
		mysql_query($sql5,$cn);
	//}
}else{

//Verificando datos masivamente concidencias

if(isset($_REQUEST['actvOT'])){
$strSQL="update activxordent  set estado='A' where id='".$codigo."'";
mysql_query($strSQL,$cn);
die();
}


if($Condicion=='Lpase'){
	$strSQL1="update det_mov set bajapase='S' where cod_det='$codigo'";
	mysql_query($strSQL1,$cn);
	die();
}

if($Condicion=='R'){
	$strSQL1="update cab_mov set estadoOT='$Condicion' where cod_cab='$codigo'";
	mysql_query($strSQL1,$cn);
	die();
}
if($Condicion=='E'){
	$strSQL1="update cab_mov set estadoOT='$Condicion' where cod_cab='$codigo'";
	mysql_query($strSQL1,$cn);
	die();
}
if($Condicion=='O'){
	$strSQL1="update cab_mov set estadoOT='$Condicion' where cod_cab='$codigo'";
	mysql_query($strSQL1,$cn);
	die();
}


$sqlR=" select * from cab_mov where cod_cab='$codigo' "; 
$resultadoR=mysql_query($sqlR,$cn);
$rowR=mysql_fetch_array($resultadoR);
	//echo $rowR['flag'];		
	if ($rowR['flag']==$Condicion ){
		$codigo ='999999999';
	}
$sqlR2=" select * from cab_mov where cod_ope='TS' and serie='".$rowR['serie']."' and Num_doc='".$rowR['Num_doc']."' and sucursal='".$rowR['sucursal']."' "; 
$resultadoR2=mysql_query($sqlR2,$cn);
while($rowR2=mysql_fetch_array($resultadoR2)){
	if($rowR2['tipo']==1){
		$transfIng=$rowR2['cod_cab'];
		$docConSerie=$rowR2['serie']."-".$rowR2['Num_doc'];
		$cod_ope="TS";
		$tipo_mov=$rowR2['tipo'];
	}
	if($rowR2['tipo']==2){
		$transfIng2=$rowR2['cod_cab'];
		$docConSerie2=$rowR2['serie']."-".$rowR2['Num_doc'];
		$cod_ope="TS";
		$tipo_mov2=$rowR2['tipo'];
	}
}

//--------verificar si maneja serie y si tiene salida -------------
 if($cod_ope=="TS"){
  	$cont=0;
	echo $Condicion; 
	if($Condicion=='A'){	
		$strSQL_serie="select * from series where ingreso='".$transfIng."' and (salida!=0 or salida!='')";
		$resultado=mysql_query($strSQL_serie,$cn);
		$cont=mysql_num_rows($resultado);
		// echo "dd".$strSQL_serie;
		if($cont!=0){
			$_SESSION['docConSerie3']=$_SESSION['docConSerie3']."/".$docConSerie; 
		}
		anular_transf($transfIng,$tipo_mov,$Condicion);
		anular_transf($transfIng2,$tipo_mov2,$Condicion);	  
		//  echo $transfIng." - ".$transfIng2;
	}else{
		$strSQL111="select *  from det_mov where cod_cab='".$codigo."'";
		$resultado111=mysql_query($strSQL111,$cn);
		while($row111=mysql_fetch_array($resultado111)){		 
			$strSQL="select * from producto where idproducto='".$row111['cod_prod']."'";
			$resultado=mysql_query($strSQL,$cn);
			$row=mysql_fetch_array($resultado);
			if($row['series']=='S'){
				$cont=1;
			}
		}
		//echo "dd".strSQL;
		if($cont!=0){
			$_SESSION['docConSerie4']=$_SESSION['docConSerie4']."/".$docConSerie;
		//die();
		}
	 	anular_transf($transfIng,$tipo,$Condicion);
		anular_transf($transfIng,$tipo,$Condicion);
	}
	die(); 
}
  
//echo "sarh";
//--------------------------------------------------------

//Cambiar de estado A Principal	
$strSQL1="update cab_mov set flag='$Condicion' where cod_cab='$codigo'";
mysql_query($strSQL1,$cn);

//Pagos
$sql=" select * from cab_mov where condicion='2' and cod_cab='$codigo'
 "; // and flag<> '$Condicion' 
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	echo $strSQL1="update pagos set estado='$Condicion' where referencia='$codigo' ";
	mysql_query($strSQL1,$cn);
}
//Kardex	
$sql=" select * from cab_mov CM inner join det_mov DM on CM.cod_cab=DM.cod_cab where kardex='S' and descargo='S' and CM.cod_cab='$codigo'"; //and flag <> '$Condicion' 
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){

	/*echo	$Condicion.'<br>';
	echo  	$rowX['tienda'].'<br>';
	echo	$rowX['cantidad'].'<br>';
	echo	$rowX['cod_prod'].'<br>';*/
	
		$Tienda='saldo'.$rowX['tienda'];	
			
			//----------------subunidadesssss---------------------------
				 $cantidad=$rowX['cantidad'];
				 $strSQL4="select * from producto where idproducto='".$rowX['cod_prod']."' ";
				 $resultado4=mysql_query($strSQL4,$cn);
				
				while($row4=mysql_fetch_array($resultado4)){
					$und_pr=$row4['und'];
					$factor_pr=$row4['factor']; 
				}
				//-----------------------------	
				if($und_pr != $rowX['unidad']){
				
					$strSQL_unid="select * from unixprod where producto='".$rowX['cod_prod']."' and unidad='".$rowX['unidad']."'";
					$resultado_unid=mysql_query($strSQL_unid,$cn);
					$row_unid=mysql_fetch_array($resultado_unid);
					$factor_subund=$row_unid['factor'];

					//$cantidad=$cantidad*($factor_pr/$factor_subund);
						if ($row_unid['mconv']=='P'){
						//procentual
							//$cantidad=$cantidad*($factor_pr/$factor_subund);
							$cantidad=$cantidad*$factor_subund;
						}else{
						//nominal
							//$cantidad=(($cantidad*$factor_subund)*10)/factor_pr;
							$FacSbU = explode('.',$factor_subund);
							//echo $FacSbU[0]		
							$SuT1=$cantidad*$FacSbU[0];	//5*1 - 5 
							$SuT2=$cantidad*$FacSbU[1];	//5*3 -	15
					$CatSu = explode('.',number_format($SuT2/$factor_pr,3,'.','.'));//agrege para redondeo
							//$CatSu = explode('.',$SuT2/$factor_pr); //15/12 - 1.25
							$SuT1=$SuT1+$CatSu[0]; //5+1 - 6
							$SuT2=($CatSu[1]*$factor_pr)/100; // (25*12)/100 - 3
							$SuT2= number_format($SuT2,0,'','');	 //agrege para redondeo
							$cantidad=$SuT1.'.'.$SuT2 ; //6.3
						}												
				}else{
					 $cantidad=$cantidad;
				}
			//------------------------------------------------------------------	
							
			if ($Condicion=='A'){
				$strSQL1="update producto set $Tienda=$Tienda+$cantidad 
				where idproducto='".$rowX['cod_prod']."'";
			}else{
				$strSQL1="update producto set $Tienda=$Tienda-$cantidad
				where idproducto='".$rowX['cod_prod']."'";
			}	
			mysql_query($strSQL1,$cn);
			
}

}

function anular_transf($codCabTranf,$tipo,$Condicion){
	
	include('../conex_inicial.php');
 	 $doc_transf=$codCabTranf;
		 
		 $strSQL="update cab_mov set flag='".$Condicion."' where cod_cab='$doc_transf'";
		 mysql_query($strSQL,$cn);
		
	//Kardex	
$sql=" select * from cab_mov CM inner join det_mov DM on
CM.cod_cab=DM.cod_cab where kardex='S' and descargo='S' and CM.cod_cab='$doc_transf'
  "; //and flag <> '$Condicion' 
    			
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	/*echo	$Condicion.'<br>';
	echo  	$rowX['tienda'].'<br>';
	echo	$rowX['cantidad'].'<br>';
	echo	$rowX['cod_prod'].'<br>';*/
	
		$Tienda='saldo'.$rowX['tienda'];	
			
			//----------------subunidadesssss---------------------------
				 $cantidad=$rowX['cantidad'];
				 $strSQL4="select * from producto where idproducto='".$rowX['cod_prod']."' ";
				 $resultado4=mysql_query($strSQL4,$cn);
				
				while($row4=mysql_fetch_array($resultado4)){
					$und_pr=$row4['und'];
					$factor_pr=$row4['factor']; 
				}
				//-----------------------------	
				if($und_pr != $rowX['unidad']){
				
					$strSQL_unid="select * from unixprod where producto='".$rowX['cod_prod']."' and unidad='".$rowX['unidad']."'";
					$resultado_unid=mysql_query($strSQL_unid,$cn);
					$row_unid=mysql_fetch_array($resultado_unid);
					$factor_subund=$row_unid['factor'];

					//$cantidad=$cantidad*($factor_pr/$factor_subund);
						if ($row_unid['mconv']=='P'){
						//procentual
							//$cantidad=$cantidad*($factor_pr/$factor_subund);
							$cantidad=$cantidad*$factor_subund;
						}else{
						//nominal
							//$cantidad=(($cantidad*$factor_subund)*10)/factor_pr;
							$FacSbU = explode('.',$factor_subund);
							//echo $FacSbU[0]		
							$SuT1=$cantidad*$FacSbU[0];	//5*1 - 5 
							$SuT2=$cantidad*$FacSbU[1];	//5*3 -	15
					$CatSu = explode('.',number_format($SuT2/$factor_pr,2,'.','.'));//agrege para redondeo
							//$CatSu = explode('.',$SuT2/$factor_pr); //15/12 - 1.25
							$SuT1=$SuT1+$CatSu[0]; //5+1 - 6
							$SuT2=($CatSu[1]*$factor_pr)/100; // (25*12)/100 - 3
							$SuT2= number_format($SuT2,0,'','');	 //agrege para redondeo
							$cantidad=$SuT1.'.'.$SuT2 ; //6.3
						}												
				}else{
					 $cantidad=$cantidad;
				}
			//------------------------------------------------------------------	
							
			if ($tipo==1){
				$strSQL1="update producto set $Tienda=$Tienda-$cantidad 
				where idproducto='".$rowX['cod_prod']."'";
				$strSQl_series="delete from series where ingreso='".$doc_transf."'";
			}else{
				$strSQL1="update producto set $Tienda=$Tienda+$cantidad
				where idproducto='".$rowX['cod_prod']."'";
				$strSQl_series="update series set salida='',estado='F' where salida='".$doc_transf."'";
			}	
			mysql_query($strSQL1,$cn);
			if($Condicion=='A'){
			mysql_query($strSQl_series,$cn); 
		 	}
	
		  /*
			$strSQl_serie_destino="delete from series where ingreso='".$doc_transf2."'";
			mysql_query($strSQl_serie_destino,$cn);
			
			$strSQl_serie_ingreso="update series set salida='',estado='F' where salida='".$doc_transf."'";
			mysql_query($strSQl_serie_ingreso,$cn);  
		  		  
	*/
}
	
}
if(isset($_REQUEST['Anul'])){
	
	$codigo=$_REQUEST['CodDoc'];
	$sql=mysql_query("delete from pagos where referencia='$codigo'",$cn);
	$strSQl_series=mysql_query("update series set salida='',estado='F' where salida='$codigo'",$cn);
	
	
}

?>
