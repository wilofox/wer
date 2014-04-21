<link rel="stylesheet" type="text/css" href="menu_superfish/css/superfish.css" media="screen">
<script type="text/javascript" src="menu_superfish/js/hoverIntent.js"></script>
<script type="text/javascript" src="menu_superfish/js/superfish.js"></script>

<script type="text/javascript">
	// initialise plugins
	jQuery(document).ready(function($) {
		jQuery('ul.sf-menu').superfish();

		jQuery(".lnk").click(function() {
			jQuery('#principal').attr('src', $(this).attr('rel'));
			return false;
		});
		jQuery(".sf-menu a").attr('href','#');
	});
</script>

<style>
	.lnk{ cursor:pointer; }
</style>
<ul class="sf-menu">

	<li class="current">
		<a style="display:block" href="#">Ventas</a>
		<ul>
			<!--<li class="current">
				<a style="display:block" href="#">Punto de venta</a>
				<ul>
					<li><a style="display:<?php echo  $ptoventa ?>" class="lnk" rel="pedido.php">Punto de venta</a></li>
					<li><a style="display:<?php echo  $ptoventa ?>" class="lnk" rel="compras/seguimientoCaja.php">Seguimiento Caja Venta</a></li>
					<?php /*?><li><a style="display:<?php   $ptoventa ?>" class="lnk" rel="ventas/SeguimientoPedidos.php">Seguimiento de Pedidos</a></li><?php */?>
					<li ><a  style="display:<?php echo  $rptCierre ?>" class="lnk" rel="reporte_cierre.php">Reporte de Cierre</a></li>
				</ul>
			</li>-->
			
			<!------------------------------------------ventas Multifacruracion-------------------------------------->
		<?php /*?>	
		    <li class="current">
				<a style="display:<?php echo  $ventaxref ?>" href="#">Ventas - Multifacturacion</a>
				<ul>
					<li><a style="display:<?php echo  $puntven ?>" class="lnk" rel="compras/gen_docVendedor.php?tipomov=2">Punto de Venta Vendedor</a></li>
					<li><a style="display:<?php echo  $cajamult ?>" class="lnk" rel="ventas/genDocMiltifactura.php">Caja - Multifacturacin</a></li>
					<li><a style="display:<?php echo  $cajacred ?>" class="lnk" rel="ventas/genDocSegMiltifac.php">Caja - Crditos</a></li>
					<li><a style="display:<?php echo $ventaxref  ?>" class="lnk" rel="#">Listado planilla de cobranza</a></li>
					<li><a style="display:<?php echo  $ventaxref ?>" class="lnk" rel="#">Opcin de Cierre ''X'' y Cierre ''Z''</a></li>
					<li><a style="display:<?php echo  $ventaxref ?>" class="lnk" rel="#">Listado Planilla por Das</a></li>
				</ul>
			</li>
			<?php */?>
			
			<!------------------------------------------------------------------------------------------>
			
			<li><a style="display:<?php echo  $ventas ?>" class="lnk" rel="compras/gen_doc.php?tipomov=2">Ventas-Salidas</a></li>
			<li><a style="display:<?php echo  $redocV ?>" class="lnk" rel="reporte_venta4.php?tipo=2">Relac. Doc Ventas</a></li>
			<li><a style="display:<?php echo  $ventascli ?>" class="lnk" rel="reportes/rpt_ventasxcliente.php">Ventas por Cliente</a></li>
			<li><a style="display:<?php echo  $catalogoPre ?>" class="lnk" rel="catalogo.php">Catalogo de precios</a></li>
			
			<!--<li class="current">
				<a style="display:<?php echo  $servTecGar ?>" href="#">Servicio Tecnico y Garantia</a>
				<ul>
					<li><a style="display:<?php echo  $servTecGar ?>" class="lnk" rel="serv_tg/genDoc.php">Ordenes pendientes de entrega</a></li>
					<li><a style="display:<?php echo  $servTecGar ?>" class="lnk" rel="serv_tg/genDocSeg.php">Seguimiento de articulos entregados</a></li>
				</ul>
			</li>-->
			
			<!------------------------------proyectos--------------------------------------------->
			
		<?php /*?>
			<li class="current">
				<a style="display:<?php echo  $centroCosto ?>" href="#">Proyectos</a>
				<ul>
					<li>
						<a style="display:<?php echo  $centroCosto ?>" href="#">Mantenimiento de tablas</a>
						<ul>
							<li><a style="display:<?php echo  $centroCosto ?>" class="lnk" rel="administracion/m_area_costo.php">Tipo de negocio</a></li>
							<li><a style="display:<?php echo  $centroCosto ?>" class="lnk" rel="administracion/procesos.php">Actividades de obra</a></li>
							<li><a style="display:<?php echo  $centroCosto ?>" class="lnk" rel="administracion/m_costo.php">Centro Costo</a></li>
							<li><a style="display:<?php echo  $centroCosto ?>" class="lnk" rel="administracion/cOperativo.php">Costos Operativo</a></li>
							<li><a style="display:<?php echo  $centroCosto ?>" class="lnk" rel="administracion/factUtil.php">Factores Utilidad</a></li>
						</ul>
					</li>
					
					<li>
						<a style="display:<?php echo  $centroCosto ?>" href="#">Presupuestos de Obras</a>
						<ul>
							<li><a style="display:<?php echo  $transferencia ?>" class="lnk" rel="ordenTrabajo/presupuesto.php?tipomov=2">Generador de Presupuestos</a></li>
							<li><a style="display:<?php echo  $transferencia ?>" class="lnk" rel="ventas/genDocRefOT.php?docRef=PO">Seguimiento de Presupuestos</a></li>
						</ul>
					</li>
					<li>
						<a style="display:<?php echo  $inventarios ?>" href="#">Ordenes de trabajo</a>
						<ul>
							<li><a style="display:<?php echo  $centroCosto ?>" class="lnk" rel="ordenTrabajo/genOT.php?tipomov=2">Generador de rdenes Trabajo</a></li>
							<li><a style="display:<?php echo  $transferencia ?>" class="lnk" rel="ventas/genDocRefOT2.php?docRef=OT">Seguimiento de O.T.</a></li>
							<li><a style="display:<?php echo  $transferencia ?>" class="lnk" rel="ventas/genDocRefSM.php">Seguimiento de Entregas</a></li>
							<li><a style="display:<?php echo  $centroCosto ?>" class="lnk" rel="ventas/segimientoGastos.php">Seguimiento de Gastos</a></li>
							<li><a style="display:<?php echo  $centroCosto ?>" class="lnk" rel="ventas/segimientoActv.php">Seguimiento de Actividades</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<?php */?>
			
			
			<!-----------------------------------ACUMULACION DE PUNTOS---------------------------------------->
			
          <?php /*?>
			<li>
				<a style="display:<?php echo  $ventaxref ?>" class="lnk" rel="#">Mdulo: Acumulacin de Puntos</a>
				<ul>
					<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="transporte/maestro_transportista.php">Registro de Puntos</a></li>
					<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="transporte/seguimiento_canje.php">Seguimiento de Canjes</a></li>
				</ul>
			</li>
			<?php */?>
			
			<!-------------------------------CONTOMETROS---------------------------------------------------->
			<!--
			<li>
				<a style="display:block" class="lnk" rel="#">Contometros para grifos</a>
				<ul>
					<li>
						<a style="display:block" class="lnk" rel="#">Maestros contometros</a>
						<ul>
							<li><a style="display:<?php    ?>" class="lnk" rel="contometro/isla.php">Islas</a></li>
							<li><a style="display:<?php  ?>" class="lnk" rel="contometro/tanque.php">Tanques</a></li>
							<li><a style="display:<?php  ?>" class="lnk" rel="contometro/surtidor.php">Surtidor</a></li>
							<li><a style="display:<?php  ?>" class="lnk" rel="contometro/manguera.php">Manguera</a></li>
						</ul>
					</li>
					<li><a style="display:<?php  ?>" class="lnk" rel="contometro/hist_contometro.php">Historial de contometros</a></li>
					<li><a style="display:<?php  ?>" class="lnk" rel="contometro/hist_varillaje.php">Ingreso de varillaje</a></li>
					<li><a style="display:<?php  ?>" class="lnk" rel="contometro/informe_ContTanq.php">Informe de contmetros y tanque</a></li>
				</ul>
			</li>
			-->
			
			<li>
				<a style="display:block" class="lnk" rel="#">Ordenes de Trabajo</a>
				<ul>					
					<li><a style="display:<?php $catalogoPre  ?>" class="lnk" rel="compras/ordenT.php?tipomov=2">Generador de Ordenes de Trabajo</a></li>
					<li><a style="display:<?php $catalogoPre  ?>" class="lnk" rel="administracion/mantFactorOT.php">Factor Costo de Prodccion</a></li>
					<li><a style="display:<?php $catalogoPre  ?>" class="lnk" rel="ventas/genDocRefOT2.php?docRef=OT">Seguimiento O.T.</a></li>
					<li><a style="display:<?php $catalogoPre  ?>" class="lnk" rel="ventas/genDocRefSM.php">Seguimiento de Entregas</a></li>
				</ul>
			</li>
			
		</ul>
	</li>
	  
	
	        <!---------------------------------LOGISTICA------------------------------------------------------>

	<li class="current">
		<a style="display:block" href="#">Log&iacute;stica</a>
		<ul>

			<li><a style="display:<?php echo $compras ?>" class="lnk" rel="compras/gen_doc.php?tipomov=1">Compras-Ingresos</a></li>
			<li><a style="display:<?php echo  $redocC ?>" class="lnk" rel="reporte_venta4.php?tipo=1">Relac. Doc Compras</a></li>
			<li><a style="display:<?php echo  $transferencia ?>" class="lnk" rel="reportes/buscasen.php">B&uacute;squeda Sensitiva Detalle</a></li>
			<li><a style="display:<?php echo  $compras ?>" class="lnk" rel="compras/cuadre_fisicoAlmacen.php?menu_temp=2">Cuadre F&iacute;sico de Almacen</a></li>

			<li>
				<a style="display:<?php echo  $inventarios ?>" class="lnk" rel="#">Inventarios</a>
				<ul>
					<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="compras/kardex_fisico.php">Kardex Fsico</a></li>
					<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="compras/inv_valorizado.php?menu_temp=1">Inventario Valorizado</a></li>
					<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="compras/inv_valorizado_pCateg.php?menu_temp=1">Inventario Valorizado x Categ.</a></li>
					<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="reportes/movi_fecha.php">Movimiento entre Fechas</a></li>
					<li><a style="display:<?php echo  $redocC ?>" class="lnk" rel="catalogo_prod.php">Ca&aacute;tlogo de Productos</a></li>
					<li><a style="display:<?php echo  $rptRecoleccion ?>" class="lnk" rel="reporte_venta5.php">Consolidados Productos Vendidos</a></li>
					<li><a style="display:<?php echo  $rptCompStock ?>" class="lnk" rel="reportes/comp_stock_alma.php">Comparativo Stock entre Almacenes</a></li>
					<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="reportes/prodmasvend.php">Productos Mas Vendidos</a></li>
				</ul>
			</li>
			
			<li>
				<a style="display:<?php echo  $transferencia ?>" class="lnk" rel="#">Transferencia entre Almacenes</a>
				<ul>
					<li><a style="display:<?php echo  $transferencia ?>" class="lnk" rel="transferencia.php">Transferencia entre Almacenes</a></li>
					<li><a style="display:<?php echo  $transferencia ?>" class="lnk" rel="ventas/segimientoTS.php">Seguimiento de T.S.</a></li>
					<li><a style="display:<?php echo  $transferencia ?>" class="lnk" rel="ventas/segimientoEntrega.php">Seguimiento de Entregas</a></li>
				</ul>
			</li>

			<!--<li>
				<a style="display:<?php echo  $inventarios ?>" class="lnk" rel="#">Control de Series</a>
				<ul>
					<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="compras/inv_valorizado_serien.php?menu_temp=1">Inventario Fsico de Series</a></li>
					<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="reportes/rptbusqueda_series.php">Bsqueda Sensitiva de Series</a></li>
				</ul>
			</li>-->

			<!--<li>
				<a style="display:block" href="#">Modelos y transformaciones</a>
				<ul>
					<li>
						<a style="display:<?php echo  $inventarios ?>" href="#">Modelos</a>
						<ul>
							<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="compras/gen_docModelo.php?cod=&accion=grabar">Generador de Modelos</a></li>
							<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="modelo_trasformacion/genDocModelo.php">Seguimiento de Modelos</a></li>
						</ul>
					</li>
					<li>
						<a style="display:<?php echo  $inventarios ?>" href="#">Transformaciones</a>
						<ul>
							<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="modelo_trasformacion/genDocTransformacion.php">Generador de Transformacin</a></li>
							<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="modelo_trasformacion/segimientoTransformacion.php">Seguimiento de Transformacin</a></li>
						</ul>
					</li>
					<li>
						<a style="display:<?php echo  $inventarios ?>" href="#">Combos ofertas</a>
						<ul>
							<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="modelo_trasformacion/gen_docOferta">Generador de Combos Ofertas</a></li>
							<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="modelo_trasformacion/segimientoOferta.php">Seguimiento de Combos Ofertas</a></li>
							<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="modelo_trasformacion/segimientoBoniEnt.php">Bonificaciones entregadas</a></li>
						</ul>
					</li>
				</ul>
			</li>-->

			<li>
				<a style="display:<?php echo  $inventarios ?>" class="lnk" rel="#">Inventario de Nuevos Productos</a>
				<ul>
					<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="compras/inv_valorizado_serien.php?menu_temp=1">Maestro de Importacin</a></li>
					<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="ventas/genDocSegImportacion.php">Seguimiento de Importacin</a></li>
				</ul>
			</li>

			<li><a style="display:<?php echo  $redocC ?>" class="lnk" rel="reportes/comprovee.php?tipo=1">Compras por Proveedor</a></li>

		</ul>
	</li>

		<!-------------------------------------------------finanzas--------------------------------------->

	<li class="current">
		<a style="display:block" href="#">Finanzas</a>
		<ul>
			<li class="current">
				<a style="display:<?php echo  $cuentasC ?>" href="#">Creditos y cobranzas</a>
				<ul>
					<li><a style="display:<?php echo  $cuentasC ?>" class="lnk" rel="Finanzas/cuentaCorrienteN.php?tipo=2">Cobranza Cuentas Cliente</a></li>
					<li><a style="display:<?php echo  $cuentasC ?>" class="lnk" rel="Finanzas/Estado_Cta_Cte.php?tipo=2">Estado Cta. Cte. Cliente</a></li>
					<li><a style="display:<?php echo  $cuentasC ?>" class="lnk" rel="Finanzas/reportect1.php?tipo=2">Documentos Pendientes Clientes</a></li>
					<li><a style="display:<?php echo  $cuentasC ?>" class="lnk" rel="reportes/rpt_planilla_cobranzas.php">Planilla de Cobranzas</a></li>
					<li><a style="display:<?php echo  $cuentasC ?>" class="lnk" rel="reportes/rpt_creditoxcliente.php">Cr&eacute;ditos por Cliente</a></li>
				</ul>
			</li>
			<li class="current">
				<a style="display:<?php echo  $cuentasC ?>" href="#">Cuentas proveedores</a>
				<ul>
					<li><a style="display:<?php echo  $cuentasC ?>" class="lnk" rel="Finanzas/cuentaCorrienteN.php?tipo=1">Pago Cuentas Proveedores</a></li>
					<li><a style="display:<?php echo  $cuentasC ?>" class="lnk" rel="Finanzas/Estado_Cta_Cte.php?tipo=1">Estado Cta. Cte. Proveedor</a></li>
					<li><a style="display:<?php echo  $cuentasC ?>" class="lnk" rel="Finanzas/reportect1.php?tipo=1">Documentos Pendientes Proveedores</a></li>
					<li><a style="display:<?php echo  $cuentasC ?>" class="lnk" rel="ventas/segimientoPases.php">Seguimento de Pases - Proveedores</a></li>
					<li><a style="display:<?php echo  $cuentasC ?>" class="lnk" rel="reportes/rpt_planilla_pago.php">Planilla de Pagos</a></li>
				</ul>
			</li>
			<li><a style="display:<?php echo  $flujoC ?>" class="lnk" rel="Finanzas/flujocajaT.php">Caja chica</a></li>
		</ul>
		
	<!----------------------------------------------Gerencia---------------------------------------------->
	
	
	<li class="current">
		<a style="display:block" href="#">Gerencia</a>
		<ul>
			<li><a style="display:<?php echo  $utilVentasxClie ?>" class="lnk" rel="gerencia/utilidad_venta.php">Utilidad de Ventas x Clientes/Productos</a></li>
			<li class="current">
				<a style="display:<?php echo  $ventasCons ?>" href="#">Ventas Consolidado</a>
				<ul>
					<li><a style="display:<?php echo  $ventasCons ?>" class="lnk" rel="reporte_venta2_rj.php">Mensual</a></li>
				</ul>
			</li>
			
			<li class="current">
				<a style="display:<?php echo  $contabilidad ?>" href="#">Contabilidad</a>
				<ul>
					<li><a style="display:<?php echo  $contabilidad ?>" class="lnk" rel="l_compra.php">Libro de Compras</a></li>
					<li><a style="display:<?php echo  $transfCont ?>" class="lnk" rel="l_venta.php">Libro de ventas</a></li>
					<li><a style="display:<?php echo  $transfCont ?>" class="lnk" rel="contabilidad/kardex_permantente_f.php">Kardex Permanente 12.1(fisico)</a></li>
					<li><a style="display:<?php echo  $transfCont ?>" class="lnk" rel="contabilidad/kardexPermanenteF.php">Kardex Permanente 13.1(valorizado)</a></li>
					<li><a style="display:<?php echo  $transfCont ?>" class="lnk" rel="contabilidad.php">Transferencia a Contabilidad</a></li>
				</ul>
			</li>
			<li><a style="display:<?php echo  $modcostos ?>" class="lnk" rel="administracion/docxprod.php">Modificar Costos</a></li>
			<li class="current">
				<a style="display:<?php echo  $contabilidad ?>" href="#">Auditoria</a>
				<ul>
					<li><a style="display:<?php echo  $transfCont ?>" class="lnk" rel="gerencia/auditoria/documentos_faltantes.php">Documentos Faltantes</a></li>
				</ul>
			</li>
		</ul>
	</li>
<!---------------------------------------------------Administracion------------------------------------------------->
	<li class="current">
		<a style="display:block" href="#">Administraci&oacute;n</a>
		<ul>
			<li><a style="display:<?php echo  $sucursal ?>" class="lnk" rel="lista_sucursal.php">Empresas</a></li>
			<li><a style="display:<?php echo  $tienda ?>" class="lnk" rel="lista_tiendas.php">Locales / Tiendas</a></li>
			<li class="current">
				<a style="display:<?php echo  $articulos ?>" href="#">Auxiliares</a>
				<ul>
					<li><a style="display:<?php echo  $clientes ?>" class="lnk" rel="maestro_cliente.php?auxiliar=C">Clientes</a></li>
					<li><a style="display:<?php echo  $proveedores ?>" class="lnk" rel="maestro_cliente.php?auxiliar=P">Proveedores</a></li>
					<li><a style="display:<?php echo  $tipocambio ?>" class="lnk" rel="administracion/transportista.php">Transportista</a></li>
					<li><a style="display:<?php echo  $tipocambio ?>" class="lnk" rel="administracion/chofer.php">Chofer</a></li>
					<li><a style="display:<?php echo  $condicion ?>" class="lnk" rel="administracion/m_clasificacion.php">Clasificaci&oacute;n</a></li>
				</ul>
			</li>
			<li class="current">
				<a style="display:<?php echo  $articulos ?>" href="#">Art&iacute;culos</a>
				<ul>
					<li><a style="display:<?php echo  $articulos ?>" class="lnk" rel="productos.php">Soporte Productos</a></li>
					<li><a style="display:<?php echo  $articulos ?>" class="lnk" rel="clasificacion.php">Clasificaci&oacute;n</a></li>
					<li><a style="display:<?php echo  $articulos ?>" class="lnk" rel="categorias.php">Categorias</a></li>
					<li><a style="display:<?php echo  $articulos ?>" class="lnk" rel="subcategorias.php">Subcategorias</a></li>
					<li><a style="display:<?php echo  $articulos ?>" class="lnk" rel="administracion/m_unitmedida.php">U. de Medida</a></li>
				</ul>
			</li>
			<li class="current">
				<a style="display:<?php echo  $articulos ?>" href="#">Documentos</a>
				<ul>
					<li><a style="display:<?php echo  $condicion ?>" class="lnk" rel="documentos.php">Documentos Compras/Ventas</a></li>
					<li><a style="display:<?php echo  $condicion ?>" class="lnk" rel="administracion/m_condicion.php">Condiciones</a></li>
				</ul>
			</li>
			<li class="current">
				<a style="display:<?php echo  $articulos ?>" href="#">&Uacute;tiles</a>
				<ul>
					<li><a style="display:<?php echo  $articulos ?>" class="lnk" rel="tcambio.php">Tipo de Cambio</a></li>
					<li><a style="display:<?php echo  $articulos ?>" class="lnk" rel="administracion/backup.php">Backups</a></li>
					<li><a style="display:<?php echo  $articulos ?>" class="lnk" rel="recalculo.php">Reclculo de Stocks Y Costos</a></li>
				</ul>
			</li>
			<li><a style="display:<?php echo  $usuarios ?>" class="lnk" rel="lista_usuarios.php">Usuarios</a></li>
			<li><a style="display:<?php echo  $admaccesos ?>" class="lnk" rel="modulos_usuarios/permisos.php">Administrador de Accesos</a></li>
			<li><a style="display:<?php echo  $docxuser ?>" class="lnk" rel="modulos_usuarios/docxuser.php">Documentos por Usuario</a></li>
			<li><a style="display:<?php echo  $docxuser ?>" class="lnk" rel="administracion/precios_venta.php">Organizar Precios de Venta</a></li>
			<li class="current">
				<a style="display:<?php echo  $configuracion ?>" href="#">Configuraci&oacute;n</a>
				<ul>
					<li><a style="display:<?php echo  $configuracion ?>" class="lnk" rel="configuracion/precio.php">Etiqueta de Precio</a></li>
					<li><a style="display:<?php echo  $configuracion ?>" class="lnk" rel="configuracion/categoria.php">Etiqueta de Categora</a></li>
					<li><a style="display:<?php echo  $configuracion ?>" class="lnk" rel="configuracion/anexo.php">Etiqueta de Anexo</a></li>
				</ul>
			</li>
			<li><a style="display:<?php echo  $configuracion ?>" class="lnk" rel="administracion/tPagos.php">Tipos de pago</a></li>
			<li><a style="display:<?php echo  $configuracion ?>" class="lnk" rel="productos2.php">Soporte de Conceptos</a></li>
		</ul>
	</li>
	
	
	
	<li class="current">
		<a style="display:block" href="#">Ayuda</a>
		<ul>
			<li><a style="display:block" class="lnk" rel="ayuda/acercade.php">Acerca de prolyam RP</a></li>
			<li><a style="display:block" class="lnk" rel="ayuda/temp.php">Manual de usuario</a></li>
		</ul>
	</li>

</ul>
