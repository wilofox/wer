<?php 
	include('../conex_inicial.php'); 
	include('model/Mysql.php'); 
	include('model/Sucursal.php'); 

	$objSucursal = new Sucursal;
	$arySucursales = $objSucursal->getRegistros();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Kardex Permanente 12.1(fisico)</title>
		<link href="../styles.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="css/estilos.css">
		<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.8.18.custom.css">
		<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
		<script type="text/javascript" src="js/js.js"></script>
	</head>
	<body>

		<div class="cnt-titulo">FORMATO 12.1: "REGISTRO DEL INVENTARIO PERMANENTE EN UNIDADES FÍSICAS- DETALLE DEL INVENTARIO PERMANENTE EN UNIDADES FÍSICAS</div>

		<div class="cnt-criterios">
		
			<div class="item">
				<label>Empresas:</label>
				<select id="sucursal" name="sucursal">
					<option value="0">Todas</option>
					<?php for($x = 0 ; $x < count($arySucursales) ; $x++){ ?>
						<option value="<?php echo $arySucursales[$x]['cod_suc'] ?>"><?php echo $arySucursales[$x]['des_suc'] ?></option>
					<?php } ?>
				</select>
			</div>
			
			<div class="item">
				<label>Tiendas:</label>
				<select id="almacen" name="almacen">
					<option value="0">Todas</option>
				</select>
			</div>
			
			<div class="item">
				<label>Rango de fechas:</label>
				<span>Del </span><input type="text" id="inicio" name="inicio" value="<?=date('01-m-Y')?>">
				<span> al </span><input type="text" id="termino" name="termino" value="<?=date('d-m-Y')?>">
			</div>
			
			<div class="item">
				<input type="button" id="btnProcesar" name="btnProcesar" value="Procesar">
			</div>

		</div>

		<div id="cnt-resultados">
			<div id="progressbar"></div>
		</div>

        <div id="cnt-exportar">
        	<div id="btnExportar">Exportar a excel</div>
        </div>

	</body>
</html>