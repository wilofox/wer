// Cargo los ID's de los arrays que se convierten en "scrollables"
//alert();
//alert(navigator.appName);
//if(navigator.appName=='Microsoft Internet Explorer'){

	function carga_div()
	{
		
		posicion=0;
		
		// IE
		if(navigator.userAgent.indexOf("MSIE")>=0) navegador=0;
		// Otros
		else navegador=1;
	
		registraDivs();
	}
	
	function registraDivs()
	{
		//alert(scrollDivs);
		for(var divId=0;divId<scrollDivs.length;divId++)
		{
			//alert(scrollDivs[divId]);
			document.getElementById(scrollDivs[divId]).onmouseover=function() { this.style.cursor="move"; }
			document.getElementById(scrollDivs[divId]).onmousedown=comienzoMovimiento;
		}
	}
	
	function evitaEventos(event)
	{
		// Funcion que evita que se ejecuten eventos adicionales
		if(navegador==0)
		{
			window.event.cancelBubble=true;
			window.event.returnValue=false;
		}
		if(navegador==1) event.preventDefault();
	}
	
	function comienzoMovimiento(event)
	{
	//	alert();
		var id=this.id;
		elMovimiento=document.getElementById(id);
		
		 // Obtengo la posicion del cursor
		 
		if(navegador==0)
		 {
			cursorComienzoX=window.event.clientX+document.documentElement.scrollLeft+document.body.scrollLeft;
			cursorComienzoY=window.event.clientY+document.documentElement.scrollTop+document.body.scrollTop;
		}
		if(navegador==1)
		{    
			cursorComienzoX=event.clientX+window.scrollX;
			cursorComienzoY=event.clientY+window.scrollY;
		}
		
		elMovimiento.onmousemove=enMovimiento;
		elMovimiento.onmouseup=finMovimiento;
		
		elComienzoX=parseInt(elMovimiento.style.left);
		elComienzoY=parseInt(elMovimiento.style.top);
		// Actualizo el posicion del elemento
		elMovimiento.style.zIndex=++posicion;
		
		evitaEventos(event);
	}
	
	function enMovimiento(event)
	{  
		var xActual, yActual;
		if(navegador==0)
		{    
			xActual=window.event.clientX+document.documentElement.scrollLeft+document.body.scrollLeft;
			yActual=window.event.clientY+document.documentElement.scrollTop+document.body.scrollTop;
		}  
		if(navegador==1)
		{
			xActual=event.clientX+window.scrollX;
			yActual=event.clientY+window.scrollY;
		}
		
		elMovimiento.style.left=(elComienzoX+xActual-cursorComienzoX)+"px";
		elMovimiento.style.top=(elComienzoY+yActual-cursorComienzoY)+"px";
	
		evitaEventos(event);
	}
	
	function finMovimiento(event)
	{	
		try{
		elMovimiento.onmousemove=null;
		elMovimiento.onmouseup=null;
		}catch(e){
		}
	}
	
	//window.onload=carga_div;
/*
}else{
	function carga_div()
	{
		alert();
	}
	
	function registraDivs()
	{
	
	}
	
	function evitaEventos(event)
	{
	
	}
	
	function comienzoMovimiento(event)
	{
	
	}
	
	function enMovimiento(event)
	{  
	
	}
	
	function finMovimiento(event)
	{	
	
	}
	
	window.onload=carga_div;
	
	
}
*/