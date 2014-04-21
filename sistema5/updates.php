<?php 
include('conex_inicial.php');
include('funciones/funciones.php');

/*
///------- obtener el primer costo ----------------------------------------

$strSQL_prod="select * from producto order by idproducto";
$resultado_prod=mysql_query($strSQL_prod,$cn);
while($row_prod=mysql_fetch_array($resultado_prod)){


$codprod=$row_prod['idproducto'];
$strSQL3="select d.tcambio,c.moneda,c.inafecto,c.incluidoigv,d.afectoigv,c.fecha,c.cod_ope,c.cod_cab,c.tienda,d.tipo,d.cantidad,d.precio,saldo_actual,costo_inven from det_mov d,cab_mov c where kardex!='N' and c.cod_cab=d.cod_cab and c.flag!='A' and cod_prod='".$codprod."' and c.tipo='1' and c.cod_ope!='TS' order by d.fechad limit 1";
	
	$resultado3=mysql_query($strSQL3,$cn);
	$row3=mysql_fetch_array($resultado3);
	
	$moneda=$row3['moneda'];
	$tcambio_doc=$row3['tcambio'];
	$inafecto=$row3['inafecto'];
	$afectoigv=$row3['afectoigv'];
	$precio=$row3['precio'];
	$incluidoigv=$row3['incluidoigv'];
	
	if($moneda=='01'){
	$costo_ref=$tcambio_doc*$precio;
	}else{
	$costo_ref=$precio;
	}
	
	if($inafecto=='N' && $afectoigv=='S' && $incluidoigv=='S'){
	$costo_ref=number_format($costo_ref/1.19,3);
	}
		
	$update="update producto set pre_ref='".$costo_ref."' where idproducto='".$codprod."'";
	//echo $update."<br>";
	mysql_query($update,$cn);
	
}
	
*/
//-------------actualizar deudas del cab_mov------------------------
/*
$strSQl="SELECT *,substr(p1,5,1) as p FROM `operacion` o,cab_mov c WHERE c.cod_ope=o.codigo";
$resultado=mysql_query($strSQl,$cn);
while($row=mysql_fetch_array($resultado)){

		$valor=$row['p'];
		
		echo $row['cod_ope']." ".$valor."<br>";
		$strSQL2="update cab_mov set deuda='".$valor."' where cod_cab='".$row['cod_cab']."'  ";
		mysql_query($strSQL2,$cn);
		
}
*/
//-----------------------------------------------------------------
//contrasea: 0753
//--------------------------actualizar saldos----------------------------
/*
$strSQl="SELECT * FROM cab_mov where deuda='S'";
$resultado=mysql_query($strSQl,$cn);
while($row=mysql_fetch_array($resultado)){

$condicion=$row['condicion'];
$cabecera=$row['cod_cab'];
echo $condicion;
	if($condicion!=1){
	$strSQl="update cab_mov set saldo=total where cod_cab='".$cabecera."'";
	echo $strSQl."<br>";
	mysql_query($strSQl,$cn);
	}

}
*/
//---------------------------------------------------------------------------
/*

$strSQl="SELECT * FROM cab_mov where deuda='S'";
$resultado=mysql_query($strSQl,$cn);
while($row=mysql_fetch_array($resultado)){

$condicion=$row['condicion'];
$cod_cab=$row['cod_cab'];
$fecha=extraefecha2($row['fecha']);
//echo $fecha;
$fechav=extraefecha2($row['f_venc']);
$cod_moneda=$row['moneda'];
$monto=$row['total'];
$fecha_aud=$row['fecha_aud'];
$tcambio_doc=$row['tc'];

if($cod_moneda=='02'){
$moneda="dolares";
}else{
$moneda="soles";
}

	$strSQL2="select max(id) as id from pagos";
	$resultado2=mysql_query($strSQL2,$cn);
	$row2=mysql_fetch_array($resultado2);
	$id=str_pad($row2['id']+1, 6, "0", STR_PAD_LEFT);
		
		
	if($condicion==1){
		$strSQ3="insert into pagos(id,t_pago,fecha,fechav,monto,moneda,fechap,tcambio,referencia) values ('".$id."',1,'".$fecha."','".$fechav."',".$monto.",'".$moneda."','".$fecha_aud."',".$tcambio_doc.",'".$cod_cab."')";
	    echo $strSQ3;
	mysql_query($strSQ3,$cn);
	}

}
*/
//-------------------------------------------------------------------------------------------------------
//--------------Actualizacion de Saldos ----------------------------------------------------------------

/*
$strSQL="select * from cab_mov where deuda='S' and flag!='A' and condicion='2'  and cod_cab='554'";
$resultado=mysql_query($strSQL,$cn);
while($row=mysql_fetch_array($resultado)){

	$importe=$row['total']+$row['percepcion'];
  	$mon_d=$row['moneda'];
  	$referencia=$row['cod_cab'];
	
  $total_soles=0;
  $total_dolares=0;
  $cargo_soles=0;
  $cargo_dolares=0;
  $cargo=0;  
	  $strSQL4="select * from pagos where referencia='".$referencia."' order by id";
	  //echo "$strSQL4";
		$resultado4=mysql_query($strSQL4,$cn);
	while($row4=mysql_fetch_array($resultado4)){
		if($row4['tipo']=='A'){
			if($mon_d=='01'){
				if($row4['moneda']=='soles'){
					$total_soles=$total_soles+$row4['monto']-$row4['vuelto'];
				}
				if($row4['moneda']=='dolares'){
					$total_dolares=$total_dolares+($row4['monto']*$row4['tcambio'])-$row4['vuelto'];
				}
			}else{
				if($row4['moneda']=='soles'){
					$total_soles=$total_soles+($row4['monto']/$row4['tcambio'])-$row4['vuelto'];
				}
				if($row4['moneda']=='dolares'){
					$total_dolares=$total_dolares+$row4['monto']-$row4['vuelto'];
				}
			}
		}else{
			if($row4['tipo']=='C'){
				if($mon_d=='01'){
					if($row4['moneda']=='soles'){
						$cargo_soles=$cargo_soles+$row4['monto'];
					}
					if($row4['moneda']=='dolares'){
						$cargo_dolares=$cargo_dolares+($row4['monto']*$row4['tcambio']);
					}
				}else{
					if($row4['moneda']=='soles'){
						$cargo_soles=$cargo_soles+($row4['monto']/$row4['tcambio']);
					}
					if($row4['moneda']=='dolares'){
						$cargo_dolares=$cargo_dolares+($row4['monto']);
					}
				}
			}
		}
	}
	$cargo=$cargo_soles+$cargo_dolares;
	$total=$total_soles+($total_dolares);

//echo $tc;


//	if($mon_d=='01'){
  		$acta=number_format($total,2,'.','');
//		echo 
//	}else{
//		echo number_format($total/$tc,2);
//	}
//}

//if($accion=='vuelto'){
	//if($mon_d=='01'){
		$vuelto=$importe+$cargo-$total;
 		//echo number_format($vuelto,2);
		$vueltos=number_format($vuelto,2,'.','');
	//}else{	echo 
	//	$vuelto=$importe-($total/$tc)+($cargo/$tc);
 	//	echo number_format($vuelto,2);
	//}
	
//}
//if($accion=='cargos'){
	//if($mon_d=='01'){
		//$cargos=$total-$importe;
 		//echo number_format($vuelto,2);
		$cargos=number_format($cargo,2,'.','');
		//echo 
	//}else{
	//	$cargos=($cargo/$tc);
 	//	echo number_format($cargos,2);
	//}
	
//}
//if($accion=='total'){
	if($cargo>0){
		$tot2=$importe+$cargo;
		$total2=number_format($tot2,2,'.','');
//		echo 
	}else{
		$total2=number_format($importe,2,'.','');
		//echo number_format($importe,2);
	}
//	echo $cargos."?".$total2."?".$acta."?".$vueltos."?";
	
		$ref=$referencia;
		$sql="Update cab_mov set saldo=".$vueltos." where cod_cab='".$ref."'";
		echo $sql; 
		mysql_query($sql,$cn);
	
}

*/

///-----------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------
//Actualizar fechas de ingreso de las series
/*
$strSQL="select * from series";
$resultado=mysql_query($strSQL,$cn);
while($row=mysql_fetch_array($resultado)){
	$strSQL2="select * from cab_mov where cod_cab='".$row['ingreso']."'";
	$resultado2=mysql_query($strSQL2,$cn);
	$row2=mysql_fetch_array($resultado2);
	
	$strSQL3="update series set fing='".substr($row2['fecha'],0,10)."' where id='".$row['id']."'";
	mysql_query($strSQL3,$cn);

}
*/
///-----------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------

//Consulta para  saber la cantidad de campos por tabla de una base de datos

//SELECT TABLE_NAME,COUNT(TABLE_NAME) AS NUM_CAMPOS FROM COLUMNS WHERE TABLE_SCHEMA='prolyamrp' GROUP BY  TABLE_NAME

////-----------------------------------------------------------------------------------------------

/*
echo  " PRODUCTO --> SERIE --> COD.INGRESO --> COD.DOC --> SERIE --> NUMERO --> TIENDA<br>";

$strSQL="select count(*) as num,serie from series group by serie";
$resultado=mysql_query($strSQL,$cn);
while($row=mysql_fetch_array($resultado)){
	if($row['num']>1){
	$strSQL2="select s.producto,s.ingreso,c.cod_ope,c.serie,c.Num_doc,c.fecha,c.tienda,s.serie as serieprod from series s,cab_mov c where s.serie='".$row['serie']."' and s.ingreso=c.cod_cab order by c.cod_ope";
	//echo $strSQL2;
	$resultado2=mysql_query($strSQL2,$cn);
		while($row2=mysql_fetch_array($resultado2)){
		echo $row2['producto']." --> ".$row2['serieprod']." --> ".$row2['ingreso']."-->".$row2['cod_ope']."-->".$row2['serie']."-->".$row2['Num_doc']."-->".$row2['tienda']."<br>";
		}
		echo "-------------------------------------------------------"."<br>";
	}


}
*/

/*
$strSQL="SELECT * FROM cab_mov WHERE tienda = '' OR tienda = '0'";
$resultado=mysql_query($strSQL,$cn);
while($row=mysql_fetch_array($resultado)){

	$strSQL2="SELECT * FROM usuarios where codigo='".$row['cod_vendedor']."'";
	$resultado2=mysql_query($strSQL2,$cn);
	$row2=mysql_fetch_array($resultado2);
	
	$update="update cab_mov  set tienda='".$row2['tienda']."' where cod_cab='".$row['cod_cab']."'";
	mysql_query($update,$cn);
	
	echo $row['cod_vendedor'];
}

*/

//---------------eliminacion de guias del sistema---------------------------------------

/*
$strSQL="select * from cab_mov where cod_ope='GR' and tipo='2' ";
$resultado=mysql_query($strSQL,$cn);
while($row=mysql_fetch_array($resultado)){

$delete="delete from cab_mov where cod_cab='".$row['cod_cab']."'";
mysql_query($delete,$cn);

$delete="delete from det_mov where cod_cab='".$row['cod_cab']."'";
mysql_query($delete,$cn);

$delete="delete from pagos where referencia='".$row['cod_cab']."'";
mysql_query($delete,$cn);


	$strSQL2="select * from referencia where cod_cab='".$row['cod_cab']."' ";
	$resultado2=mysql_query($strSQL2,$cn);
	while($row2=mysql_fetch_array($resultado2)){
	
	$update="update cab_mov set flag_r='' where cod_cab='".$row2['cod_cab_ref']."' "; 
	mysql_query($update,$cn);
	
	$delete="delete from referencia where cod_cab='".$row['cod_cab']."'";
	mysql_query($delete,$cn);
	
	}
	
	$strSQL2="select * from referencia where cod_cab_ref='".$row['cod_cab']."' ";
	$resultado2=mysql_query($strSQL2,$cn);
	while($row2=mysql_fetch_array($resultado2)){
	
	$update="update cab_mov set flag_r='' where cod_cab='".$row2['cod_cab']."' "; 
	mysql_query($update,$cn);
	
	$delete="delete from referencia where cod_cab_ref='".$row['cod_cab']."'";
	mysql_query($delete,$cn);
	
	}
	

}
*/

//-----------------------------------------------------------------------------------

//update [nombre_tabla] set [nombre_campo] = replace([nombre_campo],'[cadena_a_encontrar]','[cadena_sustituta]');
/*
$strSQL="select * from cab_mov where tienda='203'";
$resultado=mysql_query($strSQL,$cn);
while($row=mysql_fetch_array($resultado)){

$strSQLDEL="delete from cab_mov where cod_cab='".$row['cod_cab']."'"; 
mysql_query($strSQLDEL,$cn);

$strSQLDEL="delete from det_mov where cod_cab='".$row['cod_cab']."'"; 
mysql_query($strSQLDEL,$cn);

$strSQLDEL="delete from pagos where referencia='".$row['cod_cab']."'"; 
mysql_query($strSQLDEL,$cn);

	if($row['tipo']=='2'){
	$strSQLDEL="delete from tempdoc where sucursal='2' and doc='".$row['cod_ope']."' and serie='".$row['serie']."' and numero='".$row['Num_doc']."'"; 
	mysql_query($strSQLDEL,$cn);
	}else{
	$strSQLDEL="delete from tempdoc where sucursal='2' and doc='".$row['cod_ope']."' and serie='".$row['serie']."' and numero='".$row['Num_doc']."' and auxiliar='".$row['cliente']."'"; 
	mysql_query($strSQLDEL,$cn);
	}


}
*/
/*
$cont=0;
$strSQL="SELECT* FROM producto WHERE nombre LIKE '%color' ";
$resultado=mysql_query($strSQL,$cn);
while($row=mysql_fetch_array($resultado)){

$strSQL2="update producto set und='04',factor='1000' where idproducto='".$row['idproducto']."'";
mysql_query($strSQL2,$cn);
$cont=$cont+1;

}
echo $cont;

*/

/*
$strSQL="SELECT* FROM det_mov d,cab_mov c WHERE cod_prod='000154' and c.tipo='2' and  c.cod_cab=d.cod_cab and flag!='A'";
$resultado=mysql_query($strSQL,$cn);
while($row=mysql_fetch_array($resultado)){
	
	
	$strSQL2="SELECT* FROM series WHERE producto='000154' and salida='".$row['cod_cab']."'";
	$resultado2=mysql_query($strSQL2,$cn);
	$cont=mysql_num_rows($resultado2);
	
	if($cont!=$row['cantidad'])echo $row['cod_cab']."<br>";
	
	
}

*/

/*
$i=1;
echo " SERIE - NUMERO - SUCURSAL - TIENDA - CLIENTE <br>";

$strSQL="select count(cod_cab) as cont , cod_cab from cab_mov group by cod_cab ORDER BY `cont` desc limit 24";
$resultado=mysql_query($strSQL,$cn);
while($row=mysql_fetch_array($resultado)){

	echo "---------------------------------------------------------<br>";
	$strSQLx="select serie,Num_doc,sucursal,tienda,cliente from cab_mov where cod_cab='".$row['cod_cab']."'";
	$resultadox=mysql_query($strSQLx,$cn);
	while($rowx=mysql_fetch_array($resultadox)){
	
	echo $i.") ".$rowx['serie']." - ".$rowx['Num_doc']." - ".$rowx['sucursal']." - ".$rowx['tienda']." - ".$rowx['cliente']."<br>";	
		
	}
	
	$i++;
	
}
*/

/*
$fecha1="2013-05-17";
$fecha2="2013-07-02";

$strSQL="select c.cod_cab as cabecera , imp_item as total_item, c.percepcion as percepcion, flag_percep as per,d.cod_det as det_id  from cab_mov c,det_mov d,producto p,categoria t  where c.cod_cab=d.cod_cab and d.cod_prod=p.idproducto and p.categoria=t.idCategoria and  substring(fecha,1,10) between '$fecha1' and '$fecha2' and c.percepcion > 0 and t.idCategoria in ('010','019','023','025','025','041','042','043','044','045','046','047','002','007','011','012')  order by c.cod_cab";
//echo $strSQL;
$resultado=mysql_query($strSQL,$cn);
while($row=mysql_fetch_array($resultado)){

//echo $row['cabecera']."  -  ".$row['total_item']."  -  ".$row['percepcion']."  --->  ".$row['total_item']*0.02." -----> ".$row['per']." ---> ".$row['det_id']."<br>";

//
//$update="update det_mov set flag_percep='S' where cod_det ='".$row['det_id']."' ";

//echo $update."<br>";
//mysql_query($update,$cn);


}
//$update="update det_mov set flag_percep='S' where cod_det in ('55891','55943','55962','56013','56027','56030','56046','56071','56099','56109','56110','56111','56155','56164') ";
//mysql_query($update,$cn);

*/

/*
$res = mysql_query("SELECT * FROM producto",$cn);
$juicio    =    array(); 
while($row = mysql_fetch_array($res) ) 
{ 
    $juicio[]    = array( $row['idproducto']." <br> ", $row['nombre'] ); 
} 

header("Content-type: text/csv"); 
header("Content-Disposition: attachment; filename=file.csv"); 
header("Pragma: no-cache"); 
header("Expires: 0"); 
outputCSV($juicio); 

function outputCSV($dato) { 
    $salida = fopen("php://output", "w"); 
    function __outputCSV(&$vals, $key, $manipulador) { 
        fputcsv($manipulador, $vals, "  ");  
    } 
    array_walk($dato, "__outputCSV", $salida); 
    fclose($salida); 
} 
*/


$res = mysql_query("SELECT * FROM cab_mov where tipo='2' and flag_r!='' ",$cn);
while($row = mysql_fetch_array($res) ) 
{ 

$res2 = mysql_query("SELECT * FROM referencia where cod_cab='".$row['cod_cab']."' ",$cn);
$cont2=mysql_num_rows($res2); 

	if($cont2==0){
	//echo $row['cod_ope']." ".$row['serie']."-".$row['Num_doc']."<br>";
	$strSQLUpdate="update cab_mov set kardex='S', flag_r='' where cod_cab='".$row['cod_cab']."' ";
	mysql_query($strSQLUpdate,$cn);
	echo $strSQLUpdate."<br>";
	}

}


?>



