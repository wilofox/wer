<?php

	include('../conex_inicial.php');
	$codigo = $_REQUEST['CodDoc'];
	$Condicion = $_REQUEST['Condicion'];

$sql=mysql_query("Select cod_ope from cab_mov where cod_cab=$codigo",$cn);
$rs=mysql_fetch_array($sql);
if($rs[0]=="R1"){
	if($Condicion=='A'){
		$sql1=mysql_query("Update cab_mov set flag='A' where cod_cab=$codigo",$cn);
		$sql2=mysql_query("Select * from det_mov where cod_cab=$codigo",$cn);
		$rowX=mysql_fetch_array($sql2);
		$Tienda='saldo'.$rowX['tienda'];	
		$cantidad=$rowX['cantidad'];
		$strSQL1=mysql_query("update producto set $Tienda=$Tienda-$cantidad where idproducto='".$rowX['cod_prod']."'",$cn);
		$sql3=mysql_query("Delete from referencia where cod_cab=$codigo",$cn);
		$sql4=mysql_query("Delete from pagos where referencia=$codigo",$cn);
		$sql5=mysql_query("Delete from series where ingreso=$codigo",$cn);
		
	}
}else{

if(isset($_REQUEST['CCond'])){
	$sql="Select * from cab_mov where cod_cab=$codigo";
	$row=mysql_fetch_array(mysql_query($sql,$cn));
	$cond=$row['condicion'];
	$cond++;
	if($cond=='23'){
		$cond='17';
	}
	$sql="update cab_mov set condicion=$cond where cod_cab=$codigo";
	mysql_query($sql,$cn);
}else{
	if(isset($_REQUEST['Elim'])){
	echo "Eliminado";	
	}else{
?>
<table width="212" height="30" border="0" cellpadding="0" cellspacing="0" bgcolor="#0000FF">
  <tr>
    <td><div align="center"><span style="color: #FFFFFF">
	
<? 
//Verificando datos masivamente concidencias
$sql=" select * from cab_mov where cod_cab='$codigo' "; 
$resultadoR=mysql_query($sql,$cn);
while($rowR=mysql_fetch_array($resultadoR)){
	//echo $rowR['flag'];		
	if ($rowR['flag']==$Condicion ){
	$codigo ='999999999';
	}
}

//Cambiar de estado A Principal	
$strSQL1="update cab_mov set flag='$Condicion' where cod_cab='$codigo'";
mysql_query($strSQL1,$cn);


//Pagos
$sql=" select * from cab_mov where condicion='2' and cod_cab='$codigo'
 "; // and flag<> '$Condicion' 
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
			echo $strSQL1="update pagos set estado='$Condicion' 
			where referencia='$codigo' ";
			mysql_query($strSQL1,$cn);
}

//Kardex	
echo $codigo;
$sql=" select * from cab_mov CM inner join det_mov DM on
CM.cod_cab=DM.cod_cab where kardex='S' and descargo='S' and CM.cod_cab='".$codigo."'
  "; //
 $resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	echo	$Condicion.'<br>';
	echo  	$rowX['tienda'].'<br>';
	echo	$rowX['cantidad'].'<br>';
	echo	$rowX['cod_prod'].'<br>';
	
	echo	$Tienda='saldo'.$rowX['tienda'];	
			
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
				echo $strSQL1="update producto set $Tienda=$Tienda+$cantidad 
				where idproducto='".$rowX['cod_prod']."'";
			}else{
				echo $strSQL1="update producto set $Tienda=$Tienda-$cantidad
				where idproducto='".$rowX['cod_prod']."'";
			}	
			mysql_query($strSQL1,$cn);			
} 

//ren Anula R2 S2
			$strSQL_ASR="select * from referencia where cod_cab_ref='$codigo' ";
					$resultado_ASR=mysql_query($strSQL_ASR,$cn);
					$row_ASR=mysql_fetch_array($resultado_ASR);
					$Cod_ASR=$row_ASR['cod_cab'];
					$Condicion;
			if ($Condicion=='A'){			
			echo $strSQL1="update cab_mov set estadoOT='' where cod_cab='$Cod_ASR'";
			
			}else{
			echo $strSQL1="update cab_mov set estadoOT='T' where cod_cab='$Cod_ASR'";
			
			}
			mysql_query($strSQL1,$cn);
?>

	</span></div></td>
  </tr>
</table>
<?php
}
if(isset($_REQUEST['Elim'])){
	$sql="SELECT ca.* FROM cab_mov ca INNER JOIN referencia re ON ca.cod_cab=re.cod_cab_ref WHERE re.cod_cab=$codigo";
	$rp=mysql_fetch_array(mysql_query($sql,$cn));
	if($rp['cod_ope']=="R2"){
		echo "<script>alert('Este Documento no se puede eliminar (Ya Entregado)')</script>";
	}else{
		$sql1="Delete from cab_mov where cod_cab=$codigo";
		$sql2="Delete from det_mov where cod_cab=$codigo";
		$sql3="Delete from referencia where cod_cab=$codigo";
		$sql4="Delete from pagos where referencia=$codigo";
		$sql5="Delete from series where ingreso=$codigo";
//Kardex	
echo $codigo;
$sql=" select * from cab_mov CM inner join det_mov DM on
CM.cod_cab=DM.cod_cab where kardex='S' and descargo='S' and CM.cod_cab='".$codigo."'
  "; //
 $resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	echo	$Condicion.'<br>';
	echo  	$rowX['tienda'].'<br>';
	echo	$rowX['cantidad'].'<br>';
	echo	$rowX['cod_prod'].'<br>';
	
	echo	$Tienda='saldo'.$rowX['tienda'];	
			
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
			echo $strSQL1="update producto set $Tienda=$Tienda+$cantidad 
			where idproducto='".$rowX['cod_prod']."'";
			mysql_query($strSQL1,$cn);			
		} 

		mysql_query($sql1,$cn);
		mysql_query($sql2,$cn);
		mysql_query($sql3,$cn);
		mysql_query($sql4,$cn);
		mysql_query($sql5,$cn);
	}
}
}
}
?>