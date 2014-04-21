function AdjustMenu(pobjName,pblnCenter,pintLeft,pintTop) {
var w_newWidth,padding,xoffset;

  if (navigator.appName.indexOf("Microsoft") != -1) {
  	w_newWidth=(document.documentElement.clientWidth == 0)?document.body.clientWidth:document.documentElement.clientWidth;
  	xoffset=21;
  }else{
  	w_newWidth=document.documentElement.clientWidth;
  	xoffset=17;
	} 	  
	if (pblnCenter=='true'){
		document.getElementById(pobjName).style.left=(w_newWidth-parseInt(document.getElementById(pobjName).style.width))/2+'px';
	}else{
	padding=parseInt((window.screen.width-xoffset-parseInt(document.getElementById(pobjName).style.width))/2-pintLeft);    		
		document.getElementById(pobjName).style.left=(w_newWidth-parseInt(document.getElementById(pobjName).style.width))/2-padding+'px';
	}
	if (parseInt(document.getElementById(pobjName).style.left)<0) 
		document.getElementById(pobjName).style.left='0px';
	document.getElementById(pobjName).style.top=pintTop+'px';      		
}
