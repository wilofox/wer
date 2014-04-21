<?php
	include('../conex_inicial.php'); 
	include('model/Mysql.php'); 
	include('../funciones/funciones.php');
	include('../funciones/Recalculo.php');

	include('model/Sucursal.php'); 
	include('model/Producto.php');
	include('model/Tiendas.php');

	$objListaProducto = new Producto;

	$aryProductos = $objListaProducto->getRegistros();

	$sucursal = $_POST['sucursal'];
	$xtienda = $_POST['tienda'];
	/*$des_suc = $_POST['des_suc'];
	$des_tie = $_POST['des_tie'];
	$codigo = $_POST['cod_prod'];*/
	$fecha1 = $_POST['fecha1'];
	$fecha2 = $_POST['fecha2'];

	/*$sucursal = 1;
	$xtienda = 101;
	//$des_suc = $_POST['des_suc'];
	//$des_tie = $_POST['des_tie'];
	$fecha1 = '01-03-2010';
	$fecha2 = '02-03-2012';*/

	$salidas = 0;
	$ingresos = 0;	

	if($sucursal == 0){
		$filtro_multi = "";
	}else{
		if($xtienda == 0){
			$filtro_multi = " c.sucursal='".$sucursal."' AND ";
		}else{
			$filtro_multi = " c.tienda='".$xtienda."' AND c.sucursal='".$sucursal."' AND ";
		}
	}

	

	//for($x = 0 ; $x < count($aryProductos) ; $x++){
	for($x = 0 ; $x < 10 ; $x++){

		if($sucursal == 0){
			$filtrod = "";
		}else{
			$filtrod = " and d.sucursal='".$sucursal."' ";
		}
	
		if($xtienda != "0"){			
			$filtrod .= " and d.tienda='".$xtienda."' ";
		}

		$resp = explode("?",recalculo2($aryProductos[$x]['idproducto'],formatofecha($fecha1),$filtrod,"3",""));
		$resp2 = explode("?",recalculo2($aryProductos[$x]['idproducto'],formatofecha($fecha1),$filtrod,"2",$sucursal));
		$tot_saldo = $resp[0];
		$cos_saldo = number_format($resp2[1],4);
		$costo_inven = $cos_saldo; 
		$existencia = $tot_saldo;

		$aryDetalle = $objListaProducto->detalle_kardex($filtro_multi, $aryProductos[$x]['idproducto'], $fecha1, $fecha2);

		if(count($aryDetalle) > 0){

			$objTienda = new Tiendas($aryDetalle[0]['tienda']);

			// Impresion
			echo "<br><br>";
			
			/*echo "RUC: <br>";
			echo "Cliente: <br>";*/

			echo "Periodo: ".substr($aryDetalle[0]['fecha'],6,4)."<br>";
			
			echo "Establecimiento: ".$objTienda->des_tienda."<br>";
			echo "Codigo de la existencia: ".$aryProductos[$x]['idproducto']."<br>";
			
			$res_clas = mysql_query("SELECT * FROM clasificacion WHERE idclasificacion = '".$aryProductos[$x]['clasificacion']."' ",$cn); 
			while( $rw_resclas = mysql_fetch_array( $res_clas ) ){
				echo "Tipo: ".$rw_resclas['des_clas']."<br>";
			}
			echo "Descripcion: ".$aryProductos[$x]['cod_prod']." - ".$aryProductos[$x]['nombre']."<br>";

			$resultados11 = mysql_query("SELECT * FROM unidades WHERE id = '".$aryProductos[$x]['und']."' ",$cn); 
			while( $row11 = mysql_fetch_array( $resultados11 ) ){
				echo "Codigo de la unidad de medida: ".$row11['descripcion'].' ('.$aryProductos[$x]['factor'].') <br>';
			}

			echo "Metodo de evaluacion: <br>";

			echo "<table>";

			echo "<tr>";

			echo "<th>Fecha</th>";
			echo "<th>Tipo</th>";
			echo "<th>Serie</th>";
			echo "<th>Numero</th>";
			echo "<th>Tipo de operacion</th>";
			echo "<th>Entradas</th>";
			echo "<th>Salidas</th>";
			echo "<th>Saldos</th>";
			
			echo "</tr>";

			for($y = 0 ; $y < count($aryDetalle) ; $y++){

			/*	OPERACIONES		*/

			if( $aryDetalle[$y]['flag_r'] != '' ){

				$strSQL_ref = "
					SELECT 
						kardex 
					FROM 
						referencia r,
						cab_mov c 
					WHERE 
						r.cod_cab = '".$aryDetalle[$y]['referencia']."' 
						AND r.cod_cab_ref = c.cod_cab 
						AND kardex = 'S'";

				$resultado_ref = mysql_query( $strSQL_ref, $cn );
				$cont_ref = mysql_num_rows( $resultado_ref );

				$temp = "";

				if($aryDetalle[$y]['flag_kardex'] != ''){
					if($aryDetalle[$y]['tipo'] != $aryDetalle[$y]['flag_kardex']){
						$temp = "pasar";
					}
				}

				if($cont_ref > 0 && $temp == ""){
					continue;
				}

			}

			if( $aryDetalle[$y]['tipo'] != $act_kar_IS && $act_kar_IS != "" ){
				$tipomov_temp = $act_kar_IS;					
			}else{
				$tipomov_temp = $aryDetalle[$y]['tipo'];
			}

			if($tipomov_temp == 1){
				if( $aryDetalle[$y]['unidad'] != $codunidad ){		
					$strSQL_unid = "select * from unixprod where producto='".$aryProductos[$x]['cod_prod']."' and unidad='".$aryDetalle[$y]['unidad']."'";
					$resultado_unid = mysql_query($strSQL_unid,$cn);
					$tempCont = mysql_num_rows($resultado_unid);
					if($tempCont != 0){
						$row_unid = mysql_fetch_array($resultado_unid);
						$ingresos = $aryDetalle[$y]['cantidad'] * $row_unid['factor'];
						$factorSub = $row_unid['factor'];
					}else{
						$ingresos = $aryDetalle[$y]['cantidad'];
						$factorSub = $row_unid['factor'];
					}
				}else{
					$ingresos = $aryDetalle[$y]['cantidad'];
				}

				$total_ingresos = $total_ingresos + $ingresos;
				$existencia = $existencia + $ingresos + $saldo_actual;
				$salidas = "";

				if($aryDetalle[$y]['moneda'] == '02'){
					$precio_soles = $aryDetalle[$y]['precio'] * $aryDetalle[$y]['tc'];
				}else{ 
					$precio_soles = $aryDetalle[$y]['precio'];
				}

				if($aryDetalle[$y]['tipo'] == 1){
	
					if ($aryDetalle[$y]['unidad'] != $codunidad){
						$costo_inven = $aryDetalle[$y]['costo_inven'];
	
						if($inafecto == 'N'){
							if($incl_igv == 'S' && $prod_igv == 'S'){
								$punit = $precio_soles / $impto;
								if($factorSub != '' && $factorSub != 0){
									$punit = $punit / $factorSub;
								}
							}else{
								$punit = $precio_soles;
							}
						}else{
							$punit = $precio_soles;
						}
						$debe = $punit * $ingresos;

					}else{
						$costo_inven = $aryDetalle[$y]['costo_inven'];
						if($inafecto=='N'){
							if($incl_igv == 'S' && $prod_igv == 'S'){
								$punit = $precio_soles / $impto;
							}else{
								$punit = $precio_soles;
							}
						}else{
							$punit = $precio_soles;
						}
						$debe = $punit * $ingresos;
					}
	
				}else{
					$debe = $costo_inven * $ingresos;				
				}
				
				
				$haber = "";
				$saldo = $saldo + $debe;	
			
			}else{	
	
				$punit = "";
				
				if ( $codunidad != $aryDetalle[$y]['unidad'] ){
	
					$strSQL_unid = "select * from unixprod where producto='".$aryProductos[$x]['cod_prod']."' and unidad='".$aryDetalle[$y]['unidad']."'";
					$resultado_unid = mysql_query($strSQL_unid,$cn);
					$row_unid = mysql_fetch_array($resultado_unid);
					$factor_subund = $row_unid['factor'];
	
					$salidas = $aryDetalle[$y]['cantidad'];

					if($factor_subund <> ""){
						if ($row_unid['mconv'] == 'P'){
							$salidas = $salidas * $factor_subund;
						}else{
							$FacSbU = explode('.', $factor_subund);
							$SuT1 = $salidas * $FacSbU[0];
							$SuT2 = $salidas * $FacSbU[1];
							$CatSu = explode('.', number_format($SuT2 / $factor,3,'.','.'));					
							$SuT1 = $SuT1+$CatSu[0];
							$SuT2 = ($CatSu[1] * $factor) / 100;
							$SuT2 = number_format($SuT2,0,'','');			
							$salidas = $SuT1.'.'.$SuT2 ;
						}						
					}
					
				}else{
					$salidas = $aryDetalle[$y]['cantidad'];
				}

				$total_salidas = $total_salidas + $salidas;
				$existencia = $existencia - $salidas + $saldo_actual;
				$ingresos = "";

				$debe = "";
				$haber = $costo_inven * $salidas;
				$saldo = $saldo - $haber;
			}

			$saldo_actual = 0;
			/*	---------------	*/

				echo "<tr>";
				
				echo "<td>".$aryDetalle[$y]['fecha']."</td>";
				echo "<td>".$aryDetalle[$y]['cod_ope']."</td>";
				echo "<td>".$aryDetalle[$y]['serie']."</td>";
				echo "<td>".$aryDetalle[$y]['Num_doc']."</td>";
				echo "<td></td>";
				
				$ingresos = ($ingresos=='') ? 0 : $ingresos;
				echo "<td>".$ingresos."</td>";
				
				$salidas = ($salidas=='') ? 0 : $salidas;
				echo "<td>".$salidas."</td>";
				echo "<td>".$existencia."</td>";
				
				echo "</tr>";

			}

			echo "</table>";

		}

	}

?>