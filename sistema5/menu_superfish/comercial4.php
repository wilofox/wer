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
		
		jQuery(".lnk2").click(function() {
			//jQuery().attr('src', $(this).attr('rel'));
			window.open($(this).attr('rel'),"");
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
			<li class="current">
				<a style="display:<?php echo  $rptCierre ?>"  >Punto de venta</a>
				<ul>
				
					
					<!--					
					<li><a style="display:<?php //echo  $ptoventa ?>" class="lnk" rel="pedido.php">Punto de Caja-Venta</a></li>
					<li><a style="display:<?php //echo $ptoventa ?>" class="lnk" rel="compras/seguimientoCaja.php">Seguimiento Caja-Venta</a></li>
					-->
					
					<li><a style="display:<?php echo  $ptoventa ?>" class="lnk" rel="pedido2.php">Punto de Venta Cr&eacute;ditos</a></li>			
					<li><a style="display:<?php echo  $ptoventa ?>" class="lnk" rel="ventas/genDocSegMiltifac.php">Caja - Cr&eacute;ditos</a></li>
						
						<?php /*?><li><a style="display:<?php   $ptoventa ?>" class="lnk" rel="ventas/SeguimientoPedidos.php">Seguimiento de Pedidos</a></li><?php */?>
						
					<li ><a  style="display:<?php echo  $rptCierre ?>" class="lnk" rel="reporte_cierre.php">Reporte de Cierre</a></li>
					<li>
						<a style="display:<?php echo $ptoventa ?>" class="lnk" rel="ventas/genDocRefPCs.php">Seguimiento de PCs </a>					</li>
				</ul>
			</li>
			
		
			<li><a style="display:<?php echo  $cajacred ?>" class="lnk" rel="ventas/genDocMiltifacturaGuias.php">Multifacturaci&oacute;n de Guias</a></li>
			<li><a style="display:<?php echo  $ventas ?>" class="lnk" rel="compras/gen_doc.php?tipomov=2">Ventas-Salidas</a></li>
			<li><a style="display:<?php echo  $redocV ?>" class="lnk" rel="reporte_venta4.php?tipo=2">Relac. Doc Ventas</a></li>
			<li><a style="display:<?php echo  $ventascli ?>" class="lnk" rel="reportes/rpt_ventasxcliente.php">Ventas por Cliente</a></li>
			<li><a style="display:<?php echo  $catalogoPre ?>" class="lnk" rel="catalogo.php">Cat&aacute;logo de Precios</a></li>
			
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
	  </ul>
	</li>
	  
	
	        <!---------------------------------LOGISTICA------------------------------------------------------>

	<li class="current">
		<a style="display:block" href="#">Log&iacute;stica</a>
		<ul>

			<li><a style="display:<?php echo $compras ?>" class="lnk" rel="compras/gen_doc.php?tipomov=1">Compras-Ingresos
			
			</a></li>
			
		
			
			<li><a style="display:<?php echo  $redocC ?>" class="lnk" rel="reporte_venta4.php?tipo=1">Relac. Doc Compras</a></li>
			<li><a style="display:<?php echo  $redocC ?>" class="lnk" rel="compras/seguimientoPases.php">Seguimiento Pases</a></li>
			
			 <li><a style="display:<?php echo  $redocC ?>" class="lnk" rel="reportes/comprovee.php?tipo=1">Compras por Proveedor</a></li>
			
			<li><a style="display:<?php echo  $redocC ?>" class="lnk" rel="reportes/buscasen.php">B&uacute;squeda Sensitiva Detalle</a></li>
			<?php /*?><li><a style="display:<?php echo  $compras ?>" class="lnk" rel="compras/cuadre_fisicoAlmacen.php?menu_temp=2">Cuadre F&iacute;sico de Almacen</a></li><?php */?>


<li>	
		<a style="display:<?php echo  $genGuiasTransf ?>" class="lnk" rel="#">Generar Guias x Transferencias</a>
			<ul>
			<li><a style="display:<?php echo $compras ?>" class="lnk" rel="compras/genGuiasTransf.php">Generador de Guias x Transferencias</a></li>
			
			<li><a style="display:<?php echo $compras ?>" class="lnk" rel="ventas/seguimientoGrTransf.php">Seguimiento de Guias x Transferencias</a></li>
			</ul>	
		</li>

			<li>
				<a style="display:<?php echo  $inventarios ?>" class="lnk" rel="#">Inventarios</a>
				<ul>
					<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="compras/kardex_fisico.php">Kardex Fsico</a></li>
					<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="compras/inv_valorizado.php?menu_temp=1">Inventario Valorizado</a></li>
					<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="compras/inv_valorizado_pCateg.php?menu_temp=1">Inventario Valorizado x Categ.</a></li>
					 <li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="compras/inv_lotes.php">Inventario x Lotes</a></li>
					<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="reportes/movi_fecha.php">Movimiento entre Fechas</a></li>
					<li><a style="display:<?php echo  $redocC ?>" class="lnk" rel="catalogo_prod.php">Cat&aacute;logo de Productos</a></li>
					<li><a style="display:<?php echo  $rptRecoleccion ?>" class="lnk" rel="reporte_venta5.php">Consolidados Productos Vendidos</a></li>
					<li><a style="display:<?php echo  $rptCompStock ?>" class="lnk" rel="reportes/comp_stock_alma.php">Comparativo Stock entre Almacenes</a></li>
					<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="reportes/prodmasvend.php">Productos M&aacute;s/Menos Vendidos</a></li>
					<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="compras/stockMin.php">Reposici&oacute;n de Stock</a></li>
				</ul>
			</li>
			
			<li>
				<a style="display:<?php echo  $transferencia ?>"  rel="#">Transferencia entre Almacenes</a>
				<ul>
					<li><a style="display:<?php echo  $transferencia ?>" class="lnk" rel="transferencia.php">Transferencia entre Almacenes</a></li>
					<li><a style="display:<?php echo  $transferencia ?>" class="lnk" rel="ventas/segimientoTS.php">Seguimiento de T.S.</a></li>
					<!--<li><a style="display:<?php echo  $transferencia ?>" class="lnk" rel="ventas/segimientoEntrega.php">Seguimiento de Entregas</a></li>-->
				</ul>
			</li>

			<?php /*?><li>
				<a style="display:<?php echo  $inventarios ?>"  rel="#">Control de Series</a>
				<ul>
					<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="compras/inv_valorizado_serien.php?menu_temp=1">Inventario Fsico de Series</a></li>
					<li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="reportes/rptbusqueda_series.php">B&uacute;squeda Sensitiva de Series</a></li>
				</ul>
			</li><?php */?>

			<li>
				<a style="display:<?php echo  $transferencia ?>" href="#">Modelos y transformaciones</a><ul>
                  <li> <a style="display:<?php echo  $inventarios ?>" href="#">Modelos</a>
                      <ul>
                        <li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="compras/gen_docModelo.php?cod=&amp;accion=grabar">Generador de Modelos</a></li>
                        <li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="modelo_trasformacion/genDocModelo.php">Seguimiento de Modelos</a></li>
                      </ul>
                  </li>
                  <li> <a style="display:<?php echo  $inventarios ?>" href="#">Transformaciones</a>
                      <ul>
                        <li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="modelo_trasformacion/genDocTransformacion.php">Generador de Transformaci&oacute;n</a></li>
                        <li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="modelo_trasformacion/segimientoTransformacion.php">Seguimiento de Transformaci&oacute;n</a></li>
                      </ul>
                  </li>
                  <li> <a style="display:<?php echo  $inventarios ?>" href="#">Combos Ofertas</a>
                      <ul>
                        <li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="modelo_trasformacion/gen_docOferta">Generador de Combos Ofertas</a></li>
                        <li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="modelo_trasformacion/segimientoOferta.php">Seguimiento de Combos Ofertas</a></li>
                        <li><a style="display:<?php echo  $inventarios ?>" class="lnk" rel="modelo_trasformacion/segimientoBoniEnt.php">Bonificaciones entregadas</a></li>
                      </ul>
                  </li>
                  </ul>
		  </li>

		 
	  </ul>
	</li>

		<!-------------------------------------------------finanzas--------------------------------------->

	<li class="current">
		<a style="display:block" href="#">Finanzas</a>
		<ul>
			<li class="current">
				<a style="display:<?php echo  $cuentasC ?>" href="#">Creditos y cobranzas</a>
				<ul>
					<li><a style="display:<?php echo  $cobCtaCli ?>" class="lnk" rel="Finanzas/cuentaCorrienteN.php?tipo=2">Cobranza Cuentas Cliente</a></li>
					<li><a style="display:<?php echo  $estCtaCli ?>" class="lnk" rel="Finanzas/Estado_Cta_Cte.php?tipo=2">Estado Cta. Cte. Cliente</a></li>
					<li><a style="display:<?php echo  $docPenCli ?>" class="lnk" rel="Finanzas/reportect1.php?tipo=2">Documentos Pendientes Clientes</a></li>
					<li><a style="display:<?php echo  $planCobra ?>" href="#">Planilla de Cobranzas</a>
				      <ul>
				        <li><a style="display:<?php echo  $cuentasC ?>" class="lnk" rel="reportes/rpt_planilla_cobranzas.php?tipo=2">Planilla de Cobranzas - Agrupado por Modalidad</a></li>
		                  <li><a style="display:<?php echo  $cuentasC ?>" class="lnk" rel="reportes/rpt_planilla_cobranzasTO.php?tipo=2">Planilla de Cobranzas - Agrupado por Tipo de Pago</a></li>
                      </ul>
                  </li>
					<li><a style="display:<?php echo  $credXClie ?>" class="lnk" rel="reportes/rpt_creditoxcliente.php">Cr&eacute;ditos por Cliente</a></li>
					<li><a style="display:<?php echo  $canjeLetrasCli ?>" href="#">Canje Letras Clientes</a>
				      <ul>
				        <li><a style="display:<?php echo  $letrasC ?>" class="lnk" rel="Finanzas/genMultiCanje.php?tipo=2">Planilla de Letras</a></li>
		                  <li><a style="display:<?php echo  $letrasC ?>" class="lnk" rel="Finanzas/genSegLet.php?tipo=2">Seguimiento de Letras por Vencimiento</a></li>
                      </ul>
                  </li>
                  <li><a style="display:<?php echo  $rptVencCob7Day ?>" class="lnk" rel="Finanzas/rpt_vencimientosxdia.php?tipo=2">Reporte de Vencimientos de Cobranzas a 7 d&iacute;as</a></li>
				</ul>
				
			</li>
			<li class="current">
				<a style="display:<?php echo  $cuentasP ?>" href="#">Cuentas Proveedores</a>
				<ul>
					<li><a style="display:<?php echo  $pagoCtaProv ?>" class="lnk" rel="Finanzas/cuentaCorrienteN.php?tipo=1">Pago Cuentas Proveedores</a></li>
					<li><a style="display:<?php echo  $estCtaProv ?>" class="lnk" rel="Finanzas/Estado_Cta_Cte.php?tipo=1">Estado Cta. Cte. Proveedor</a></li>
					<li><a style="display:<?php echo  $docPenProv ?>" class="lnk" rel="Finanzas/reportect1.php?tipo=1">Documentos Pendientes Proveedores</a></li>
					<!--<li><a style="display:<?php echo $cuentasP ?>" class="lnk" rel="ventas/segimientoPases.php">Seguimento de Pases - Proveedores</a></li>-->
					<li><a style="display:<?php echo $planillaPagos ?>" class="lnk" rel="reportes/rpt_planilla_pago.php">Planilla de Pagos</a></li>
					
				    <li><a style="display:<?php echo $canjLetProv ?>" href="#">Canje Letras Proveedores</a>
				      <ul>
				        <li><a style="display:<?php echo $letrasP ?>" class="lnk" rel="Finanzas/genMultiCanje.php?tipo=1">Planilla de Letras</a></li>
		                  <li><a style="display:<?php echo $letrasP ?>" class="lnk" rel="Finanzas/genSegLet.php?tipo=1">Seguimiento de Letras por Vencimiento</a></li>
                      </ul>
                  </li>
			      <li><a style="display:<?php echo $ProgP ?>" href="#">Programaci&oacute;n Pago Proveedores</a>
                    <ul>
                      <li><a style="display:<?php echo $ProgP1 ?>" class="lnk" rel="Finanzas/progPagosProv.php">Programaci&oacute;n de Pagos</a></li>
                      <li><a style="display:<?php echo $ProgP2 ?>" class="lnk" rel="Finanzas/aprobPagosProv.php">Aprobaci&oacute;n de Pagos</a></li>
                    </ul>
			      </li>
				    <li class="current"><a style="display:<?php echo $moduloBancos ?>" href="#">M&oacute;dulo de Bancos</a>
                        <ul>
                          <li><a style="display:<?php echo $bancos ?>" class="lnk" rel="">Movimiento de Bancos</a></li>
                          <li><a style="display:<?php echo $bancos ?>" class="lnk" rel="">Seguimiento de Pagos y Cobranzas x Tip. Pago</a></li>
                          <li><a style="display:<?php echo $bancos ?>" class="lnk" rel="">Reporte por Vencimientos</a></li>
                        </ul>
			      </li>
                  <li><a style="display:<?php echo  $rptVencPag7Day ?>" class="lnk" rel="Finanzas/rpt_vencimientosxdia.php?tipo=1">Reporte de Vencimientos de Pagos a 7 d&iacute;as</a></li>			
				   <li><a style="display:<?php echo  $rptVencPag7Day ?>" class="lnk" rel="Finanzas/rpt_VencLetraCheque.php?tipo=1">Vencimiento Letras/Cheques Proveedores</a></li>
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
					<li><a style="display:<?php echo  $transfCont ?>" class="lnk" rel="l_venta.php">Libro de Ventas</a></li>
					<li><a style="display:<?php echo  $transfCont ?>" class="lnk" rel="contabilidad/kardex_permantente_f.php">Kardex Permanente 13.1 (F&iacute;sico y Valorizado)</a></li>
					<!--<li><a style="display:<?php echo  $transfCont ?>" class="lnk" rel="contabilidad/kardexPermanenteF.php">Kardex Permanente 13.1(valorizado)</a></li>-->
					<li><a style="display:<?php echo  $transfCont ?>" class="lnk" rel="contabilidad.php">Transferencia a Contabilidad (Compras y Ventas)</a></li>
					
					<li><a style="display:<?php echo  $transfCont ?>" class="lnk" rel="contabilidad3.php">Transferencia a Contabilidad (Pagos y Cobranzas) </a></li>
					
				    <li><a style="display:<?php echo  $transfCont ?>" class="lnk" rel="contabilidad/exportar_percep.php">Exportar  Percepciones - SUNAT </a></li>
					 <li><a style="display:<?php echo  $transfCont ?>" class="lnk" rel="contabilidad/rpt_percepcion.php">Reporte de Percepciones </a></li>
				</ul>
			</li>
			<li><a style="display:<?php echo  $modcostos ?>" class="lnk" rel="administracion/docxprod.php">Modificar Costos</a></li>
			<li class="current">
				<a style="display:<?php echo  $contabilidad ?>" href="#">Auditoria</a>
				<ul>
					<li><a style="display:<?php echo  $transfCont ?>" class="lnk" rel="gerencia/auditoria/documentos_faltantes.php">Documentos Faltantes</a></li>
					<li><a style="display:<?php echo  $transfCont ?>" class="lnk" rel="gerencia/auditoria/documentos_saldos.php">Documentos Contado con Saldo</a></li>
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
				<a style="display:<?php echo  $auxiliares ?>" href="#">Auxiliares</a>
				<ul>
					<li><a style="display:<?php echo  $clientes ?>" class="lnk" rel="maestro_cliente.php?auxiliar=C">Clientes</a></li>
					<li><a style="display:<?php echo  $proveedores ?>" class="lnk" rel="maestro_cliente.php?auxiliar=P">Proveedores</a></li>
					<li><a style="display:<?php echo  $transportista ?>" class="lnk" rel="administracion/transportista.php">Transportista</a></li>
					<li><a style="display:<?php echo  $chofer ?>" class="lnk" rel="administracion/chofer.php">Chofer</a></li>
					<li><a style="display:<?php echo  $condicion ?>" class="lnk" rel="administracion/m_clasificacion.php">Clasificaci&oacute;n</a></li>
                    <li><a style="display:<?php echo  $condicion ?>" class="lnk" rel="administracion/m_zonas.php">Zonas</a></li>
	            </ul>
		    </li>
		  <li class="current" style="display:<?php echo  $finanzas ?>"> <a href="#">Finanzas</a>
            <ul>
              <li><a class="lnk" rel="administracion/m_bancos.php">Bancos</a></li>
              <li><a class="lnk" rel="administracion/m_ctasb.php">Cuentas Bancarias </a></li>
              <li><a class="lnk" rel="Finanzas/genChequera.php?tipo=3">Registro de Chequeras</a></li>
			  	<li><a style="display:<?php echo  $configuracion ?>" class="lnk" rel="administracion/tPagos.php">Tipos de pago</a></li>
            </ul>
		  </li>
			<li class="current">
				<a style="display:<?php echo  $articulos ?>" href="#">Art&iacute;culos</a>
				<ul>
					<li><a style="display:<?php echo  $articulos ?>" class="lnk" rel="productos.php">Soporte Productos</a></li>
					<li><a style="display:<?php echo  $articulos ?>" class="lnk" rel="clasificacion.php">Clasificaci&oacute;n</a></li>
					<li><a style="display:<?php echo  $articulos ?>" class="lnk" rel="categorias.php">Categor&iacute;as</a></li>
					<li><a style="display:<?php echo  $articulos ?>" class="lnk" rel="subcategorias.php">Subcategor&iacute;as</a></li>
					<li><a style="display:<?php echo  $articulos ?>" class="lnk" rel="administracion/m_unitmedida.php">U. de Medida</a></li>
					<li><a style="display:<?php echo  $configuracion ?>" class="lnk" rel="productos2.php">Soporte de Conceptos</a></li>
				</ul>
			</li>
			<li class="current">
				<a style="display:<?php echo  $documentos ?>" href="#">Documentos</a>
				<ul>
					<li><a style="display:<?php echo  $condicion ?>" class="lnk" rel="documentos.php">Documentos Compras/Ventas</a></li>
					<li><a style="display:<?php echo  $condicion ?>" class="lnk" rel="administracion/m_condicion.php">Condiciones</a></li>
				</ul>
			</li>
			<li class="current">
				<a style="display:<?php echo  $utiles ?>" href="#">&Uacute;tiles</a>
				<ul>
					<li><a style="display:<?php echo  $ticambio ?>" class="lnk" rel="tcambio.php">Tipo de Cambio</a></li>
					<li><a style="display:<?php echo  $backup ?>" class="lnk" rel="administracion/backup.php">Backups</a></li>
					<li><a style="display:<?php echo  $recalculo ?>" class="lnk" rel="recalculo.php">Rec&aacute;lculo de Stocks y Costos</a></li>
					<li><a style="display:<?php echo  $editorForm ?>" class="lnk2" rel="formatos/configForm.php">Editor de Formatos</a></li>
				</ul>
			</li>


			<li class="current">
				<a style="display:<?php echo  $usuarios ?>" href="#">Personal / Usuarios</a>
				<ul>
					<li><a style="display:<?php echo  $usuarios1 ?>" class="lnk" rel="lista_usuarios.php">Usuarios</a></li>
					<li><a style="display:<?php echo  $usuarios2 ?>" class="lnk" rel="temporizador.php">Horarios de trabajador</a></li>
					
					<li><a style="display:<?php echo  $admaccesos ?>" class="lnk" rel="modulos_usuarios/permisos.php">Administrador de Accesos</a></li>
			<li><a style="display:<?php echo  $docxuser ?>" class="lnk" rel="modulos_usuarios/docxuser.php">Documentos por Usuario</a></li>
			   </ul>
			</li>
	
			
			
			
			<li><a style="display:<?php echo  $organizarPV ?>" class="lnk" rel="administracion/precios_venta.php">Organizar Precios de Venta</a></li>
			<li class="current">
				<a style="display:<?php echo  $configuracion ?>" href="#">Configuraci&oacute;n</a>
				<ul>
					<li><a style="display:<?php echo  $configuracion ?>" class="lnk" rel="configuracion/precio.php">Etiqueta de Precio</a></li>
					<li><a style="display:<?php echo  $configuracion ?>" class="lnk" rel="configuracion/categoria.php">Etiqueta de Categor&iacute;a</a></li>
					<li><a style="display:<?php echo  $configuracion ?>" class="lnk" rel="configuracion/anexo.php">Etiqueta de Anexo</a></li>
				</ul>
			</li>
		
			
		</ul>
	</li>
	
	
	
	<li class="current">
		<a style="display:block" href="#">Ayuda</a>
		<ul>
			<li><a style="display:block" class="lnk" rel="ayuda/acercade.php">Acerca de Prolyam RP</a></li>
			<li><a style="display:block" class="lnk" rel="ayuda/temp.php">Manual de Usuario</a></li>
		</ul>
	</li>
</ul>
