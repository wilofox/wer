<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>
     <link rel="stylesheet" href="libreria/page.css"/>
	<link rel="stylesheet" href="libreria/page.widget.css"/>
	<link rel="stylesheet" href="libreria/widget.calculator.css"/>
	<link rel="stylesheet" href="libreria/widget.calculator.widgetstogo.css"/>
	<script type="text/javascript" src="libreria/Uize.js"></script>
<body>

<style>
.widgetTitle {
	BORDER-RIGHT: #345 1px solid; PADDING-RIGHT: 0px; BORDER-TOP: #bcd 1px solid; PADDING-LEFT: 60px; BACKGROUND: url(libreria/images/widget-title-bg.gif) #89a repeat-x left top; PADDING-BOTTOM: 0px; BORDER-LEFT: #678 1px solid; CURSOR: pointer; PADDING-TOP: 0px; BORDER-BOTTOM: #123 1px solid; POSITION: relative; HEIGHT: 35px
}
</style>

<script type="text/javascript">
	
		Uize.module ({
			required:[
				'UizeDotCom.WidgetToGoPage.Calculator.library',
				'UizeDotCom.WidgetToGoPage'
			],
			builder:function () {
				(
					window.page = UizeDotCom.WidgetToGoPage ({
						title:'Calculator',
						widgetToGoClass:'Uize.Widget.Calculator',
						widgetToGoHtml:'Uize.Templates.Calculator'
					})
				).wireUi ();
			}
		});
	
	</script>
</body>
</html>
