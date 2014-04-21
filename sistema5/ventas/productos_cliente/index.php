<?php
	include('../../conex_inicial.php'); 
	include('../../contabilidad/model/Mysql.php');
	include('../../contabilidad/model/Tiendas.php');
	include('../../contabilidad/model/Sucursal.php');
	include('../../contabilidad/model/Usuarios.php');
	include('../../contabilidad/model/Clientes.php');

	$objSucursal = new Sucursal;
	$arySucursales = $objSucursal->getRegistros();

	$objTiendas = new Tiendas;
	$aryTiendas = $objTiendas->getRegistrosXSucursal( $arySucursales[0]['cod_suc'] );

	$objUsuarios = new Usuarios;
	$aryUsuarios = $objUsuarios->getRegistros();

	$objClientes = new Clientes;
	$aryClientes = $objClientes->getRegistros();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Documento sin t&iacute;tulo</title>
	<link rel="stylesheet" type="text/css" href="estilos.css">
	<link rel="stylesheet" type="text/css" media="all" href="../../calendario/Style_calenda.css" title="win2k-cold-1" />

	<script type="text/javascript" src="../../calendario/calendar.js"></script>
	<script type="text/javascript" src="../../calendario/lang/calendar-en.js"></script>
	<script type="text/javascript" src="../../calendario/calendar-setup.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){

			var $loadingGif = $('#loading-gif');

			$loadingGif.on('ajaxStart', function(){
				$(this).show();
			});

			$loadingGif.on('ajaxStop', function(){
				$(this).hide();
			});

			$("#chkTodasLasSucusales").click(function(event){
				if($(this).is(":checked")) {
					$("#sleSucursal").attr("disabled", "disabled");
					$("#sleAlmacenes").attr("disabled", "disabled");
					$("#chkAlmacenes").attr("disabled", "disabled");
				}else{
					$("#sleSucursal").removeAttr("disabled");
					$("#sleAlmacenes").removeAttr("disabled");
					$("#chkAlmacenes").removeAttr("disabled");
				}
			});

			$("#chkAlmacenes").click(function(event){
				if($(this).is(":checked")) {
					$("#sleAlmacenes").attr("disabled", "disabled");
				}else{
					$("#sleAlmacenes").removeAttr("disabled");
				}
			});

			$("#chkVendedores").click(function(event){
				if($(this).is(":checked")) {
					$("#sleVendedores").attr("disabled", "disabled");
				}else{
					$("#sleVendedores").removeAttr("disabled");
				}
			});

			$("#resultados table tr").click(function() {
				//alert( $(this).children('td.codcliente').text() );
				$("#consolidado").show();
				$("#resultado_consolidado").html('');
				$("#resultado_consolidado").html("ventas/productos_cliente/obtener_consolidado.php?codcliente=".$(this).children('td.codcliente').text() );
			});	

			$("#cerrar").click(function() {
				$("#consolidado").hide();
			});	

		});
	</script>
</head>

<body>

	<div class="div_general">

		<div class="div_filtro">
			<form id="frmCriterio" name="frmCriterio">

				<input type="checkbox" id="chkTodasLasSucusales" /> Todos
				<select id="sleSucursal" name="sleSucursal">
					<?php for($x = 0 ; $x < count($arySucursales) ; $x++){ ?>
						<option value="<?php echo $arySucursales[$x]['cod_suc'] ?>"
						<?php if($x == 0){ echo "selected='selected'";} ?>
						><?php echo $arySucursales[$x]['des_suc'] ?></option>
					<?php } ?>
				</select>

				<input type="checkbox" id="chkAlmacenes" /> Todos
				<select id="sleAlmacenes" name="sleAlmacenes">
					<?php for($x = 0 ; $x < count($aryTiendas) ; $x++){ ?>
						<option value="<?php echo $aryTiendas[$x]['cod_tienda'] ?>"
						><?php echo $aryTiendas[$x]['des_tienda'] ?></option>
					<?php } ?>
				</select>

				<!--<input type="checkbox" id="chkVendedores" /> Todos
				<select id="sleVendedores" name="sleVendedores">
					<?php for($x = 0 ; $x < count($aryUsuarios) ; $x++){ ?>
						<option value="<?php echo $aryUsuarios[$x]['codigo'] ?>"
						><?php echo $aryUsuarios[$x]['usuario'] ?></option>
					<?php } ?>
				</select>-->

				<input type="text" id="txt_fecha_inicio" value="<?php echo date('d-m-Y'); ?>">
				<button type="reset" id="btn_fecha_inicio">...</button>
				<script type="text/javascript">
					Calendar.setup({
						inputField     :    "txt_fecha_inicio",      
						ifFormat       :    "%d-%m-%Y",      
						showsTime      :    true,            
						button         :    "btn_fecha_inicio",   
						singleClick    :    true,           
						step           :    1                
					});
				</script>

				<input type="text" id="txt_fecha_final" value="<?php echo date('d-m-Y'); ?>">
				<button type="reset" id="btn_fecha_final">...</button>
				<script type="text/javascript">
					Calendar.setup({
						inputField     :    "txt_fecha_final",      
						ifFormat       :    "%d-%m-%Y",      
						showsTime      :    true,            
						button         :    "btn_fecha_final",   
						singleClick    :    true,           
						step           :    1                
					});
				</script>

			</form>
		</div>

		<div id="resultados">
			<table id="tabla_clientes">
				<tr>
					<th>Codigo</th>
					<th>Razon social</th>
					<th>RUC</th>
					<th>Doc. Identidad</th>
					<th>Teléfono</th>
					<th>Contacto</th>
				</tr>
			<?php for($x = 0 ; $x < count($aryClientes) ; $x++){ ?>
				<tr class="fila">
					<td class="codcliente"><?php echo $aryClientes[$x]['codcliente'] ?></td>
					<td class="razonsocial"><?php echo $aryClientes[$x]['razonsocial'] ?></td>
					<td class="ruc"><?php echo $aryClientes[$x]['ruc'] ?></td>
					<td class="doc_iden"><?php echo $aryClientes[$x]['doc_iden'] ?></td>
					<td class="telefono"><?php echo $aryClientes[$x]['telefono'] ?></td>
					<td class="contacto"><?php echo $aryClientes[$x]['contacto'] ?></td>
				</tr>
			<?php } ?>
			</table>
		</div>

		<div id="consolidado">
			<img src="../../imagenes/cargando.gif" id="loading-gif" />
			<div id="cerrar">[x]</div>
			<div id="resultado_consolidado"></div>
		</div>

	</div>

</body>
</html>
