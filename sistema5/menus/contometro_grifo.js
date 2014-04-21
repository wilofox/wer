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

	
	/* --------------------------------Contometro---------------------------------------*/	
	
["Cont&oacute;metros para Grifos","","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , , , "0", , , ],
		["|Historial de Cont&oacute;metros","contometro/hist_contometro.php", "imgenes/icon5.gif", "imgenes/icon5.gif", , , , , , ],
		["|Ingreso de Varillaje","contometro/hist_varillaje.php", "imgenes/icon5.gif", "imgenes/icon5.gif", , , , , , ],
		["|Informe de Cont&oacute;metros y tanques","contometro/informe_ContTanq.php", "imgenes/icon5.gif", "imgenes/icon5.gif", , , , , , ],
		

["Maestro de Cont&oacute;metros","", "imgenes/icon1.gif", "imgenes/icon1o.gif", , mastercont , , , , ],
		["|Islas","contometro/isla.php","imgenes/icon5.gif" ,"imgenes/icon5.gif" , , , "0", , , ],
		["|Tanques","contometro/tanque.php","imgenes/icon5.gif" ,"imgenes/icon5.gif" , , , "0", , , ],
		["|Surtidor","contometro/surtidor.php","imgenes/icon5.gif" ,"imgenes/icon5.gif" , , , "0", , , ],
		["|Manguera","contometro/manguera.php","imgenes/icon5.gif" ,"imgenes/icon5.gif" , , , "0", , , ],
["Administraci&oacute;n","","imgenes/icon1.gif" ,"imgenes/icon1o.gif" , ,masteradm , "0", , , ],
        ["|Empresas","lista_sucursal.php", "imgenes/icon5.gif", "imgenes/icon5.gif", ,sucursal , , , , ],
        ["|Locales por Empresa","lista_tiendas.php", "imgenes/icon5.gif", "imgenes/icon5.gif", ,tienda, , , , ],
		["|Usuarios","lista_usuarios.php", "imgenes/icon5.gif", "imgenes/icon5.gif", ,usuarios, , , , ],
    	["|Soporte Productos","productos.php", "imgenes/icon5.gif", "imgenes/icon5.gif", , , , , , ],
		
["Ayuda","","imgenes/icon1.gif" ,"imgenes/icon1.gif" , , "_blank", "0", , , ],
		["||Acerca de Prolyam RP ","ayuda/acercade.php", "imgenes/icon5.gif", "imgenes/icon5o.gif", , , , , , ],
		["||Manual de Usuario ","ayuda/temp.php", "imgenes/icon5.gif", "imgenes/icon5o.gif", , "_blank" , , , , ],
		
];
dm_init();