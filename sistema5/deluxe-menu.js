// -- Deluxe Tuner Style Names
var itemStylesNames=[];
var menuStylesNames=[];
// -- End of Deluxe Tuner Style Names

//--- Common
var isHorizontal=1;
var smColumns=1;
var smOrientation=0;
var dmRTL=0;
var pressedItem=-2;
var itemCursor="pointer";
var itemTarget="principal";
var statusString="link";
var blankImage="deluxe-menu.files/blank.gif";
var pathPrefix_img="";
var pathPrefix_link="";

//--- Dimensions
var menuWidth="";
var menuHeight="";
var smWidth="";
var smHeight="";

//--- Positioning
var absolutePos=1;
var posX="100px";
var posY="100px";
var topDX=0;
var topDY=1;
var DX=-5;
var DY=0;
var subMenuAlign="left";
var subMenuVAlign="top";

//--- Font
var fontStyle=["normal 11px Trebuchet MS, Tahoma","normal 11px Trebuchet MS, Tahoma"];
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
var beforeItemImage=["",""];
var afterItemImage=["",""];
var beforeItemImageW="";
var afterItemImageW="";
var beforeItemImageH="";
var afterItemImageH="";
var itemBorderWidth=1;
var itemBorderColor=["#FCEEB0","#4C99AB"];
var itemBorderStyle=["solid","solid"];
var itemSpacing=3;
var itemPadding="3px";
var itemAlignTop="left";
var itemAlign="left";

//--- Icons
var iconTopWidth=16;
var iconTopHeight=16;
var iconWidth=16;
var iconHeight=16;
var arrowWidth=8;
var arrowHeight=16;
var arrowImageMain=["deluxe-menu.files/arrowmain.gif","deluxe-menu.files/arrowmaino.gif"];
var arrowWidthSub=0;
var arrowHeightSub=0;
var arrowImageSub=["deluxe-menu.files/arrowsub.gif","deluxe-menu.files/arrowsubo.gif"];

//--- Separators
var separatorImage="";
var separatorWidth="100%";
var separatorHeight="3px";
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
var floatableDX=15;
var floatableDY=15;

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
var transparency="80";
var transition=24;
var transOptions="";
var transDuration=350;
var transDuration2=200;
var shadowLen=3;
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
var smShowPause=200;
var smHidePause=1000;
var smSmartScroll=1;
var topSmartScroll=0;
var smHideOnClick=1;
var dm_writeAll=1;
var useIFRAME=0;
var dmSearch=0;

//--- AJAX-like Technology
var dmAJAX=0;
var dmAJAXCount=0;
var ajaxReload=0;

//--- Dynamic Menu
var dynamic=0;

//--- Popup Menu
var popupMode=0;

//--- Keystrokes Support
var keystrokes=0;
var dm_focus=1;
var dm_actKey=113;

//--- Sound
var onOverSnd="";
var onClickSnd="";

var itemStyles = [
];
var menuStyles = [
];

var menuItems = [

    ["Inicio","testlink.html", "", "", "", "", "", "", "", "", "", ],
    ["Ventas","", "deluxe-menu.files/icon1.gif", "deluxe-menu.files/icon1o.gif", "", "", "", "", "", "", "", ],
        ["|Features","testlink.html", "deluxe-menu.files/icon2.gif", "deluxe-menu.files/icon2o.gif", "", "", "", "", "", "", "", ],
        ["|Installation","", "deluxe-menu.files/icon2.gif", "deluxe-menu.files/icon2o.gif", "", "", "", "", "", "", "", ],
            ["||Description of Files","testlink.html", "deluxe-menu.files/icon6.gif", "deluxe-menu.files/icon6o.gif", "", "", "", "", "", "", "", ],
            ["||How To Setup","testlink.html", "deluxe-menu.files/icon6.gif", "deluxe-menu.files/icon6o.gif", "", "", "", "", "", "", "", ],
        ["|Parameters Info","testlink.html", "deluxe-menu.files/icon2.gif", "deluxe-menu.files/icon2o.gif", "", "", "", "", "", "", "", ],
        ["|Dynamic Functions","testlink.html", "deluxe-menu.files/icon2.gif", "deluxe-menu.files/icon2o.gif", "", "", "", "", "", "", "", ],
        ["|Supported Browsers","", "deluxe-menu.files/icon2.gif", "deluxe-menu.files/icon2o.gif", "", "", "", "", "", "", "", ],
            ["||Windows OS","", "deluxe-menu.files/icon3.gif", "deluxe-menu.files/icon3o.gif", "", "", "", "", "", "", "", ],
            ["||Internet Explorer","", "deluxe-menu.files/icon5.gif", "deluxe-menu.files/icon5o.gif", "", "", "", "", "", "", "", ],
            ["||Firefox","", "deluxe-menu.files/icon5.gif", "deluxe-menu.files/icon5o.gif", "", "", "", "", "", "", "", ],
            ["||Mozilla","", "deluxe-menu.files/icon5.gif", "deluxe-menu.files/icon5o.gif", "", "", "", "", "", "", "", ],
            ["||Netscape","", "deluxe-menu.files/icon5.gif", "deluxe-menu.files/icon5o.gif", "", "", "", "", "", "", "", ],
            ["||Opera","", "deluxe-menu.files/icon5.gif", "deluxe-menu.files/icon5o.gif", "", "", "", "", "", "", "", ],
            ["||MAC OS","", "deluxe-menu.files/icon3.gif", "deluxe-menu.files/icon3o.gif", "", "", "", "", "", "", "", ],
            ["||Firefox","", "deluxe-menu.files/icon5.gif", "deluxe-menu.files/icon5o.gif", "", "", "", "", "", "", "", ],
            ["||Safari","", "deluxe-menu.files/icon5.gif", "deluxe-menu.files/icon5o.gif", "", "", "", "", "", "", "", ],
            ["||Internet Explorer","", "deluxe-menu.files/icon5.gif", "deluxe-menu.files/icon5o.gif", "", "", "", "", "", "", "", ],
            ["||Unix/Linux OS","", "deluxe-menu.files/icon3.gif", "deluxe-menu.files/icon3o.gif", "", "", "", "", "", "", "", ],
            ["||Firefox","", "deluxe-menu.files/icon5.gif", "deluxe-menu.files/icon5o.gif", "", "", "", "", "", "", "", ],
            ["||Konqueror","", "deluxe-menu.files/icon5.gif", "deluxe-menu.files/icon5o.gif", "", "", "", "", "", "", "", ],
    ["Samples","", "deluxe-menu.files/icon1.gif", "deluxe-menu.files/icon1o.gif", "", "", "", "", "", "", "", ],
        ["|Sample 1","testlink.html", "deluxe-menu.files/icon6.gif", "deluxe-menu.files/icon6o.gif", "", "", "", "", "", "", "", ],
        ["|Sample 2 is Disabled","testlink.html", "deluxe-menu.files/icon6.gif", "deluxe-menu.files/icon6o.gif", "", "_", "", "", "", "", "", ],
        ["|Sample 3","testlink.html", "deluxe-menu.files/icon6.gif", "deluxe-menu.files/icon6o.gif", "", "", "", "", "", "", "", ],
        ["|Sample 4","testlink.html", "deluxe-menu.files/icon6.gif", "deluxe-menu.files/icon6o.gif", "", "", "", "", "", "", "", ],
        ["|Sample 5","testlink.html", "deluxe-menu.files/icon6.gif", "deluxe-menu.files/icon6o.gif", "", "", "", "", "", "", "", ],
        ["|Sample 6","testlink.html", "deluxe-menu.files/icon6.gif", "deluxe-menu.files/icon6o.gif", "", "", "", "", "", "", "", ],
        ["|Sample 7","testlink.html", "deluxe-menu.files/icon6.gif", "deluxe-menu.files/icon6o.gif", "", "", "", "", "", "", "", ],
        ["|Sample 8","testlink.html", "deluxe-menu.files/icon6.gif", "deluxe-menu.files/icon6o.gif", "", "", "", "", "", "", "", ],
        ["|Sample 9","testlink.html", "deluxe-menu.files/icon6.gif", "deluxe-menu.files/icon6o.gif", "", "", "", "", "", "", "", ],
    ["Purchase","http://deluxe-menu.com/order-purchase.html", "deluxe-menu.files/icon1.gif", "deluxe-menu.files/icon1o.gif", "", "_blank", "", "", "", "", "", ],
    ["Contact Us","testlink.htm", "deluxe-menu.files/icon1.gif", "deluxe-menu.files/icon1o.gif", "", "", "", "", "", "", "", ],
];

dm_init();