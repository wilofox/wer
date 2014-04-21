// -- Deluxe Tuner Style Names
var itemStylesNames=["Top Item",];
var menuStylesNames=["Top Menu",];
// -- End of Deluxe Tuner Style Names

//--- Common
var isHorizontal=1;
var smColumns=1;
var smOrientation=0;
var smViewType=0;
var dmRTL=0;
var pressedItem=-2;
var itemCursor="pointer";
var itemTarget="principal";
var statusString="link";
var blankImage="images/blank.gif";

//--- Dimensions
var menuWidth="300px";
var menuHeight="";
var smWidth="";
var smHeight="";

//--- Positioning
var absolutePos=0;
var posX="10";
var posY="10";
var topDX=0;
var topDY=0;
var DX=-4;
var DY=-1;

//--- Font
var fontStyle="normal 11px Tahoma ";
var fontColor=["#000000","#FFFFFF"];
var fontDecoration=["none","none"];
var fontColorDisabled="#AAAAAA";

//--- Appearance
var menuBackColor="#FCEEB0";
var menuBackImage="";
var menuBackRepeat="repeat";
var menuBorderColor="#C0AF62";
var menuBorderWidth=1;
var menuBorderStyle="solid";

//--- Item Appearance
var itemBackColor=["#FCEEB0","#65BDDC"];
var itemBackImage=["",""];
var itemBorderWidth=1;
var itemBorderColor=["#FCEEB0","#4C99AB"];
var itemBorderStyle=["solid","solid"];
var itemSpacing=2;
var itemPadding="2";
var itemAlignTop="left";
var itemAlign="left";
var subMenuAlign="";

//--- Icons
var iconTopWidth=16;
var iconTopHeight=16;
var iconWidth=15;
var iconHeight=15;
var arrowWidth=8;
var arrowHeight=16;
var arrowImageMain=["imgenes/arrowmain.gif","imgenes/arrowmaino.gif"];
var arrowImageSub=["imgenes/arrowsub.gif","imgenes/arr_white_2.gif"];

//--- Separators
var separatorImage="";
var separatorWidth="100%";
var separatorHeight="3";
var separatorAlignment="left";
var separatorVImage="";
var separatorVWidth="3px";
var separatorVHeight="100%";
var separatorPadding="0px";
//--- Floatable Menu
var floatable=0;
var floatIterations=6;
var floatableX=1;
var floatableY=1;

//--- Movable Menu
var movable=0;
var moveWidth=12;
var moveHeight=20;
var moveColor="#DECA9A";
var moveImage="";
var moveCursor="move";
var smMovable=0;
var closeBtnW=15;
var closeBtnH=15;
var closeBtn="";

//--- Transitional Effects & Filters
var transparency="100";
var transition=24;
var transOptions="";
var transDuration=350;
var transDuration2=200;
var shadowLen=4;
var shadowColor="#B1B1B1";
var shadowTop=0;

//--- CSS Support (CSS-based Menu)
var cssStyle=0;
var cssSubmenu="";
var cssItem=["",""];
var cssItemText=["",""];

//--- Advanced
var dmObjectsCheck=0;
var saveNavigationPath=1;
var showByClick=0;
var noWrap=1;
var pathPrefix_img="";
var pathPrefix_link="";
var smShowPause=200;
var smHidePause=1000;
var smSmartScroll=1;
var smHideOnClick=1;
var dm_writeAll=0;
var aleatorio=Math.random()*99999 ;
//--- AJAX-like Technology
var dmAJAX=0;
var dmAJAXCount=0;

//--- Dynamic Menu
var dynamic=0;

//--- Keystrokes Support
var keystrokes=1;
var dm_focus=1;
var dm_actKey=113;

var itemStyles = [
    ["itemBackColor=#FCEEB0,#65BDDC"],
];
var menuStyles = [
  ["menuBorderWidth=1","menuBackColor=#C0AF62","itemSpacing=1","itemPadding=0px"],
];

var menuItems = [

    ["PROLYAM","", , , , , "0", , , ],
    ["Ventas","","imgenes/icon1.gif","imgenes/icon1o.gif", , , "0", , , ],
	
	/*------------------------------------------punto de venta------------------------------------------
	
	["|Punto de Venta","","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , ventaxref, "0", , , ],
		
		["||Punto de Venta","pedido.php", "imgenes/icon1.gif", "imgenes/icon1o.gif", ,ptoventa, , , , ],
		 ["||Seguimiento Caja Venta","compras/seguimientoCaja.php", "imgenes/icon1.gif", "imgenes/icon1o.gif", ,ptoventa, , , , ],  
		 
	*/	 
	
		 
/*
----------------------------Ventas por referencias-----------------------------

*/
	
	 ["|Facturaci&oacute;n por Referencia de Pedidos ","","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , ventaxref, "0", , , ],
			["||Punto de Venta Vendedor","compras/gen_docVendedor.php?tipomov=2", "imgenes/icon5.gif", "imgenes/icon5o.gif", , , , , , ],
		["||Multifacturador de Pedidos","ventas/genDocMiltifactura.php", "imgenes/icon5.gif", "imgenes/icon5o.gif", , , , , , ],
		["||Listado Planilla de Cobranza","", "imgenes/icon5.gif", "imgenes/icon5o.gif", , , , , , ],
		["||Opcion de Cierre ''X'' y Cierre ''Z'' ","", "imgenes/icon5.gif", "imgenes/icon5o.gif", , , , , , ],
		["||Listado Planilla por d&iacute;as ","", "imgenes/icon5.gif", "imgenes/icon5o.gif", , , , , , ],	
			

/*  
 	  ["|Ventas por Referencias","","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , ventaxref, "0", , , ],
		["||Caja Facturacui&oacute;n de Pedidos","ventas/genDocRef.php", "imgenes/icon1.gif", "imgenes/icon1o.gif", , , , , , ],
        ["||Caja Facturaci&oacute;n","ventas/genDocRef2.php", "imgenes/icon1.gif", "imgenes/icon1o.gif", , , , , , ],
		["||Facturaci&oacute;n por Grupos","", "imgenes/icon1.gif", "imgenes/icon1o.gif", , , , , , ],
*/
	["|Ventas-Salidas","compras/gen_doc.php?tipomov=2","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , ventas, "0", , , ],
		
	["|Relac. Doc Ventas","reporte_venta4.php?tipo=2","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , redocV, "0", , , ],
	["|Ventas por Cliente","reportes/rpt_ventasxcliente.php","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , ventascli, "0", , , ],
			
/*		
      ["|Restaurante","", "imgenes/icon5.gif", "imgenes/icon5o.gif", , , , , , ],
        ["||Comandas","restaurante/comanda.php", "imgenes/icon5.gif", "imgenes/icon5o.gif", , , , , , ],
        ["||Lista Mesas ","restaurante/comanda_mesa.php", "imgenes/icon5.gif", "imgenes/icon5o.gif", , , , , , ],
		
*/	
	  ["|Catalogo de Precios","catalogo.php","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , catalogoPre, "0", , , ],
	
	


	/* 		----------------------------servicio tecnico y garantias-----------------------------
	
	["|Servicio T&#233;cnico Y Garant&#237;a","","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , servTecGar, "0", , , ],
		["||Ordenes pendientes de entrega","serv_tg/genDoc.php","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , , "0", , , ],
		["||Seguimiento de articulos entregados","serv_tg/genDocSeg.php","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , , "0", , , ],
		*/
		
		
			
        /*   ["||Comandas X Mesa","", "images/icon_xp_1.gif", "images/icon_xp_1o.gif", , , , , , ],
             ["||Cross-frame Support","", "images/icon_xp_1.gif", "images/icon_xp_1o.gif", , , , , , ],
            ["||Popup Mode (Contextual Menus)","", "images/icon_xp_1.gif", "images/icon_xp_1o.gif", , , , , , ],
            ["||Smart Scrollable Submenus","", "images/icon_xp_1.gif", "images/icon_xp_1o.gif", , , , , , ],
            ["||CSS Support (CSS-Based Menus)","", "images/icon_xp_1.gif", "images/icon_xp_1o.gif", , , , , , ],
            ["||Objects Overlapping","", "images/icon_xp_1.gif", "images/icon_xp_1o.gif", , , , , , ],
            ["||Filters and Transitional Effects","", "images/icon_xp_1.gif", "images/icon_xp_1o.gif", , , , , , ],
            ["||Individual Styles","", "images/icon_xp_1.gif", "images/icon_xp_1o.gif", , , , , , ],
            ["||Movable & Floatable Menus","", "images/icon_xp_1.gif", "images/icon_xp_1o.gif", , , , , , ],
            ["||Multilevel & Multicolumn Menus","", "images/icon_xp_1.gif", "images/icon_xp_1o.gif", , , , , , ],
            ["||Several Menus on One Page","", "images/icon_xp_1.gif", "images/icon_xp_1o.gif", , , , , , ],
            ["||etc.","", "images/icon_xp_1.gif", "images/icon_xp_1o.gif", , , , , , ],
        ["|Documentation","", "images/icon_xp_5.gif", "images/icon_xp_5o.gif", , , , , , ],
            ["||Description of Files","", "images/icon_xp_4.gif", "images/icon_xp_4o.gif", "Different .js files are loaded according to selected menu features.", , , , , ],
            ["||Parameters Info","", "images/icon_xp_4.gif", "images/icon_xp_4o.gif", "A lot of flexible parameters get you a fully customizable appearance of your menus.", , , , , ],
            ["||How To Setup","", "images/icon_xp_4.gif", "images/icon_xp_4o.gif", "Add several rows of code within html page - your menu is ready! Use Deluxe Tuner - visual interface that allows you to create your menus easily and in no time.", , , , , ],
            ["||JavaScript API","", "images/icon_xp_4.gif", "images/icon_xp_4o.gif", "Special JavaScript API for changing menu 'on-the-fly', without page reloading!", , , , , ],
        ["|Browsers List","", "images/icon_xp_6.gif", "images/icon_xp_6o.gif", , , , , , ],
            ["||Internet Explorer","", "images/icon_xp_1.gif", "images/icon_xp_1o.gif", , , , , , ],
            ["||Firefox","", "images/icon_xp_1.gif", "images/icon_xp_1o.gif", , , , , , ],
            ["||Mozilla","", "images/icon_xp_1.gif", "images/icon_xp_1o.gif", , , , , , ],
            ["||Netscape","", "images/icon_xp_1.gif", "images/icon_xp_1o.gif", , , , , , ],
            ["||Opera","", "images/icon_xp_1.gif", "images/icon_xp_1o.gif", , , , , , ],
            ["||Safari","", "images/icon_xp_1.gif", "images/icon_xp_1o.gif", , , , , , ],
            ["||Konqueror","", "images/icon_xp_1.gif", "images/icon_xp_1o.gif", , , , , , ],
        ["|-","", , , , , , , , ],
        ["|Deluxe Tuner Application","", "images/icons_xp_tuner.gif", "images/icons_xp_tunero.gif", "Deluxe Tuner is a powerful application that gives you the full control over creation and customization of Deluxe Menu. It has a user-friendly interface that allows you to create your menus easily and in no time.", , , , , ],
		
		*/
		
		
		
	
	
		/* --------------------------------Ordenes de Trabajo---------------------------------------
		
		["|Proyectos","","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , ventaxref, "0", , , ],
	
	
	["||Ordenes de Trabajo","","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , inventarios, "0", , , ],
		
		
	["|||Generador de Ordenes Trabajo","ordenTrabajo/genOT.php?tipomov=2","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , transferencia, "0", , , ],
   	//["||Generador de Ordenes Trabajo","compras/ordenT.php?tipomov=2","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , transferencia, "0", , , ],
		
		["|||Factor costo de produccion","administracion/mantFactorOT.php","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , transferencia, "0", , , ],
		["|||Seguimiento de O.T.","ventas/genDocRefOT.php?docRef=OT","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , transferencia, "0", , , ],
		["|||Seguimiento de Entregas","ventas/genDocRefSM.php","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , transferencia, "0", , , ],
		
				
		["|||Centros de Costos ","administracion/m_costo.php", "imgenes/icon5.gif", "imgenes/icon5.gif", , centroCosto, , , , ],
		["||||Centro costo ","administracion/m_costo.php", "imgenes/icon5.gif", "imgenes/icon5.gif", , centroCosto, , , , ],
		["||||Area costo ","administracion/m_area_costo.php", "imgenes/icon5.gif", "imgenes/icon5.gif", , centroCosto, , , , ],
		["||||Procesos ","administracion/procesos.php", "imgenes/icon5.gif", "imgenes/icon5.gif", , centroCosto, , , , ],
		
		*/	

	
	/*-------------------------------------Presuppuestos----------------------------------------------------
	
	["||Presupuestos de Obras","","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , inventarios, "0", , , ],
						
			["|||Generador de Presupuestos","ordenTrabajo/presupuesto.php?tipomov=2","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , transferencia, "0", , , ],
				
			
			["|||Seguimiento de Presupuestos","ventas/genDocRefOT.php?docRef=PO","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , transferencia, "0", , , ],
	
	
	*/
		
    ["Log&iacute;stica","","imgenes/icon1.gif","imgenes/icon1o.gif", , , "0", , , ],
    	["|Compras-Ingresos","compras/gen_doc.php?tipomov=1","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , compras, "0", , , ],
		
		["|Relac. Doc Compras","reporte_venta4.php?tipo=1","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , redocC, "0", , , ],
		["|Inventarios","","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , inventarios, "0", , , ],
		["||Kardex Fsico","compras/kardex_fisico.php","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , , "0", , , ],
		["||Inventario Valorizado","compras/inv_valorizado.php?menu_temp=1","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , , "0", , , ],
		["||Movimiento entre Fechas","reportes/movi_fecha.php", "imgenes/icon5.gif", "imgenes/icon5o.gif", "", , , , , ],
		["||Catalogo de Productos","catalogo_prod.php","imgenes/icon5.gif", "imgenes/icon5o.gif" , , redocC, "0", , , ],
		["||Recoleccion de Productos","ventas/rpt_recoleccion.php", "imgenes/icon5.gif", "imgenes/icon5o.gif", "",rptRecoleccion , , , , ],

    	["||Comparativo stock entre almacenes","reportes/comp_stock_alma.php", "imgenes/icon5.gif", "imgenes/icon5o.gif", "",rptCompStock , , , , ],
		
		["|Transferencia entre almacenes","","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , transferencia, "0", , , ],
		["||Transferencia entre almacenes","transferencia.php","imgenes/icon5.gif" ,"imgenes/icon5o.gif" , , transferencia, "0", , , ],
		["||Seguimiento de T.S.","ventas/segimientoTS.php","imgenes/icon5.gif" ,"imgenes/icon5o.gif" , , transferencia, "0", , , ],
		["||Seguimiento de Entregas","ventas/segimientoEntrega.php","imgenes/icon5.gif" ,"imgenes/icon5o.gif" , , transferencia, "0", , , ],
		
		
		
	

		/*-------------------------------control de series-------------------------------------------
		
		["|Control de Series","","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , inventarios, "0", , , ],
		 ["||Inventario Fisico de Series","compras/inv_valorizado_serien.php?menu_temp=1", "imgenes/icon5.gif", "imgenes/icon5o.gif", "",  , , , , ],
		  ["||Busqueda Sensitiva de Series","reportes/rptbusqueda_series.php", "imgenes/icon5.gif", "imgenes/icon5o.gif",  ,"_blank" , , , ,],
		*/
		
		
		/*-----------------------------Modelos y transformaciones---------------------------------
		*/		
		["|Modelos y Transformaciones","","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , inventarios, "0", , , ],
		 ["||Generador de Modelos ","modelo_trasformacion/genDocModelo.php", "imgenes/icon5.gif", "imgenes/icon5o.gif", "",  , , , , ],
	
		
		
	        ["Finanzas","","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , , "0", , , ],
            ["|Cuentas Corrientes","", "imgenes/icon5.gif", "imgenes/icon5.gif", ,cuentasC , , , , ],
        	["||Cuentas Corrientes - Clientes","Finanzas/cuentaCorrienteN.php?tipo=2", "imgenes/icon5.gif", "imgenes/icon5.gif", , , , , , ],
			["||Reporte Estado de Ctas. por Cobrar","Finanzas/reportect1.php?tipo=2", "imgenes/icon5.gif", "imgenes/icon5.gif", , , , , , ],
			["||Reporte de Cuentas Corrientes x Cliente","Finanzas/Estado_Cta_Cte.php?tipo=2", "imgenes/icon5.gif", "imgenes/icon5.gif", , , , , , ],
	
			["||Creditos por Cliente","reportes/rpt_creditoxcliente.php","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , , "0", , , ],	
			["||---------------------------------","", "", "", , , , , , ],
		
        	["||Cuentas Corrientes - Proveedores","Finanzas/cuentaCorrienteN.php?tipo=1", "imgenes/icon5.gif", "imgenes/icon5.gif", , , , , , ],
			["||Reporte Estado de Ctas. por Pagar","Finanzas/reportect1.php?tipo=1", "imgenes/icon5.gif", "imgenes/icon5.gif", , , , , , ],
			["||Reporte de Cuentas Corrientes x Proveedor","Finanzas/Estado_Cta_Cte.php?tipo=1", "imgenes/icon5.gif", "imgenes/icon5.gif", , , , , , ],
		["|Caja Chica","Finanzas/flujocajaT.php", "imgenes/icon5.gif", "imgenes/icon5.gif", , flujoC, , , , ],
 
 		
	["Gerencia","","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , , "0", , , ],
        ["|Utilidad de Ventas x Clientes/Productos","gerencia/utilidad_venta.php", "imgenes/icon5.gif", "imgenes/icon5.gif", ,utilVentasxClie , , , , ],
   ["|Ventas Consolidado","", "imgenes/icon5.gif", "imgenes/icon5o.gif", , ventasCons, , , , ],
		 ["||Mensual","reporte_venta2_rj.php", "imgenes/icon5.gif", "imgenes/icon5o.gif", , , , , , ],
		["|Transferencia a contabilidad","contabilidad.php", "imgenes/icon5.gif", "imgenes/icon5o.gif", "",transfCont , , , , ],
		
		["|Contabilidad","", "imgenes/icon5.gif", "imgenes/icon5o.gif", ,contabilidad , , , , ],
		["||Libro de compras","l_compra.php", "imgenes/icon5.gif", "imgenes/icon5o.gif", "",transfCont , , , , ],

		["||Libro de ventas","l_venta.php", "imgenes/icon5.gif", "imgenes/icon5o.gif", "",transfCont , , , , ],
 
 ["|Modificar Costos","administracion/docxprod.php", "imgenes/icon5.gif", "imgenes/icon5.gif", ,modcostos, , , , ],
 
 	["Administracion","","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , , "0", , , ],
        ["|Empresas","lista_sucursal.php", "imgenes/icon5.gif", "imgenes/icon5.gif", ,sucursal , , , , ],
        ["|Locales por Empresa","lista_tiendas.php", "imgenes/icon5.gif", "imgenes/icon5.gif", ,tienda, , , , ],
       
	   ["|Auxiliares","", "imgenes/icon5.gif", "imgenes/icon5.gif", , articulos, , , , ],	   
	    ["||Clientes","maestro_cliente.php?auxiliar=C", "imgenes/icon5.gif", "imgenes/icon5.gif", , clientes, , , , ],
		["||Proveedores","maestro_cliente.php?auxiliar=P", "imgenes/icon5.gif", "imgenes/icon5.gif", , proveedores, , , , ],
		["||Transportista","administracion/transportista.php", "imgenes/icon5.gif", "imgenes/icon5.gif", , tipocambio, , , , ],
		["||Chofer","administracion/chofer.php", "imgenes/icon5.gif", "imgenes/icon5.gif", , tipocambio, , , , ],
		
			["||Clasificacion","administracion/m_clasificacion.php", "imgenes/icon5.gif", "imgenes/icon5.gif", , condicion, , , , ],
		
		["|Articulos","", "imgenes/icon5.gif", "imgenes/icon5.gif", , articulos, , , , ],
		
			["||Soporte Productos","productos.php", "imgenes/icon5.gif", "imgenes/icon5.gif", , , , , , ],
			["||Clasificacin","clasificacion.php", "imgenes/icon5.gif", "imgenes/icon5.gif", ,  , , , , ],
			["||Categorias","categorias.php", "imgenes/icon5.gif", "imgenes/icon5.gif", , , , , , ],
			["||Subcategorias","subcategorias.php", "imgenes/icon5.gif", "imgenes/icon5.gif", , , , , , ],
        	["||U. de Medida ","administracion/m_unitmedida.php", "imgenes/icon5.gif", "imgenes/icon5.gif", , undMedida, , , , ],
		
        
		["|Documentos","", "imgenes/icon5.gif", "imgenes/icon5.gif", , articulos, , , , ],
		["||Documentos Compras/ventas","documentos.php", "imgenes/icon5.gif", "imgenes/icon5.gif", ,, , , , ],
		["||Condiciones","administracion/m_condicion.php", "imgenes/icon5.gif", "imgenes/icon5.gif", , condicion, , , , ],
	

		
		["|Utiles","", "imgenes/icon5.gif", "imgenes/icon5.gif", , articulos, , , , ],
		   ["||Tipo de Cambio","tcambio.php", "imgenes/icon5.gif", "imgenes/icon5.gif", , tipocambio, , , , ],
		   ["||Backups","administracion/backup.php", "imgenes/icon5.gif", "imgenes/icon5.gif", ,, , , , ],
		   ["||Recalculo de Stocks Y Costos","recalculo.php", "imgenes/icon5.gif", "imgenes/icon5.gif", ,recalculo, , , , ],
       // ["|Control de Caja","control_caja.php", "imgenes/icon5.gif", "imgenes/icon5.gif", ,controlC, , , , ],
        ["|Usuarios","lista_usuarios.php", "imgenes/icon5.gif", "imgenes/icon5.gif", ,usuarios, , , , ],
		
		["|Administrador de Accesos","modulos_usuarios/permisos.php", "imgenes/icon5.gif", "imgenes/icon5.gif", ,admaccesos, , , , ],
		["|Documentos por Usuario","modulos_usuarios/docxuser.php", "imgenes/icon5.gif", "imgenes/icon5.gif", ,docxuser, , , , ],
		
		
		["|Organizar Precios de Venta","administracion/precios_venta.php", "imgenes/icon5.gif", "imgenes/icon5.gif", ,preciosV, , , , ],
		
		["|Configuracion","", "imgenes/icon5.gif", "imgenes/icon5.gif", ,configuracion, , , , ],
		["||Etiqueta de Precio","configuracion/precio.php", "imgenes/icon5.gif", "imgenes/icon5.gif", ,, , , , ],
		["||Etiqueta de Categoria","configuracion/categoria.php", "imgenes/icon5.gif", "imgenes/icon5.gif", ,, , , , ],
		["||Etiqueta de Anexo","configuracion/anexo.php", "imgenes/icon5.gif", "imgenes/icon5.gif", ,, , , , ],
["||Etiqueta de Anexo2","configuracion/anexo.php", "imgenes/icon5.gif", "imgenes/icon5.gif", ,, , , , ],

		
      /*  ["|Sample 8","", "imgenes/icon5.gif", "imgenes/icon5.gif", , , , , , ],
       ["|Sample 9","", "imgenes/icon5.gif", "imgenes/icon5.gif", , , , , , ],*/
    ["Reportes","","imgenes/icon1.gif" ,"imgenes/icon1.gif" , , "_blank", "0", , , ],
      
		// ["||Dia","reporte_venta3.php", "imgenes/icon5.gif", "imgenes/icon5o.gif", , , , , , ],
		 /*
	    ["|Ventas Detallado","", "imgenes/icon5.gif", "imgenes/icon5o.gif", ,usuarios , , , , ],
         ["||Documentos x Dia","reporte_venta4.php", "imgenes/icon5.gif", "imgenes/icon5o.gif", ,usuarios, , , , ],
		 */

		["|Reporte de Cierre","reporte_cierre.php", "imgenes/icon5.gif", "imgenes/icon5o.gif", "",rptCierre , , , , ],
       
			

	
		//	["|Relacion de Clientes","reportes/rpt_relacion_clientes.php", "imgenes/icon5.gif", "imgenes/icon5o.gif", "",rptRelClie , , , , ],
		
   /*     ["|Developer License","", "images/icon_xp_8.gif", "images/icon_xp_8o.gif", "Developer license allows you to use the menu on any Internet or Intranet sites and redistribute as a part of your own applications.", , , , , ],
        ["|-","", , , , , , , , ],
        ["|Free Non-Profit License","", "images/icon_xp_8.gif", "images/icon_xp_8o.gif", "Non-profit license allows you to use the menu on 1 NON-PROFIT INTERNET website (NOT Intranet/local website).", , , , , ],
    ["Contacts","", , , , , "0", , , ],*/
];
dm_init();