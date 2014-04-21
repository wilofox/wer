/*
 * jQuery CSS popUp
 * http://dixso.net/
 *
 * Copyright (c) 2009 Julio De La Calle Palanques
 *
 * Date: 2009-03-27 12:34:00 - (Viernes, 27 Mar 2009)
 * 
 */
 
//Variable que almacenar la posicin del scroll, por defecto tiene valor 0.
var scrollCachePosition = 0;
//alert();
$(function() {
	$("#abrirPop").click(function(event) {//alert();
		scrollCachePosition = $(window).scrollTop();
		//Envo el scroll a la posicin 0 (left), 0 (top), es decir, arriba de todo.
		window.top.scroll(0,0);

		//Si el body es mas grande que la capa 'wrapper' incrementa la altura del body a la capa 'capaPopUp'.
		if ($("body").outerHeight()>$("#wrapper").outerHeight()){
			var altura=$("body").outerHeight();
	    }else{
		//Si la capa 'wrapper' es ms grande que el body incrementa la altura de la capa 'wrapper' a la capa 'capaPopUp'.
			var altura=$("#wrapper").outerHeight();
		}
		window.document.getElementById("capaPopUp").style.height=altura-20+"px";
		event.preventDefault();
		//Muestro la capa con el efecto 'slideToggle'.
		$("#capaPopUp").slideToggle();

		//Calculo la altura de la capa 'popUpDiv' y lo divido entre 2 para darle un margen negativo.
		var altura=$("#popUpDiv").outerHeight();
		$("#popUpDiv").css("margin-top","-"+parseInt(altura/2)+"px");
		
		//Calculo la anchura de la capa 'popUpDiv' y lo divido entre 2 para darle un margen negativo.
		var anchura=$("#popUpDiv").outerWidth();
		$("#popUpDiv").css("margin-left","-"+parseInt(anchura/2)+"px");
		
		//Muestro la capa con el efecto 'slideToggle'.
		
		ocultar_combos();
	
	
		$("#popUpDiv").slideToggle();
	});
	
	$("#cerrar").click(function(event) {
		event.preventDefault();
		//Cierro las capas con el efecto 'slideToggle'.
		$("#capaPopUp").slideToggle();
		$("#popUpDiv").slideToggle();
		
		window.setTimeout("mostrar_combos()",200);
		
		//Si la variable scrollCachePosition es mayor que 0 incrementar la posicin del scroll al valor que se almacen. 
		if (scrollCachePosition > 0) {
			window.top.scroll(0,scrollCachePosition);
			//Reseteamos la variable scrollCachePosition a 0 para poder ejecutar el script tantas veces sea necesario.
			scrollCachePosition = 0;
		}
	});
	
	$("#cerrar2").click(function(event) {
		event.preventDefault();
		//Cierro las capas con el efecto 'slideToggle'.
		$("#capaPopUp").slideToggle();
		$("#popUpDiv").slideToggle();
		
		window.setTimeout("mostrar_combos()",200);
		
		//Si la variable scrollCachePosition es mayor que 0 incrementar la posicin del scroll al valor que se almacen. 
		if (scrollCachePosition > 0) {
			window.top.scroll(0,scrollCachePosition);
			//Reseteamos la variable scrollCachePosition a 0 para poder ejecutar el script tantas veces sea necesario.
			scrollCachePosition = 0;
		}
	});
	
	
	$("#anular").click(function(event) {
		event.preventDefault();
		//Cierro las capas con el efecto 'slideToggle'.
	//	var motivo=document.getElementById('motivo').value;
		$("#capaPopUp").slideToggle();
		$("#popUpDiv").slideToggle();
		window.setTimeout("mostrar_combos()",200);
	cerrar_capa();
		
 	
		//Si la variable scrollCachePosition es mayor que 0 incrementar la posicin del scroll al valor que se almacen. 
	
		
		if (scrollCachePosition > 0) {
			window.top.scroll(0,scrollCachePosition);
			//Reseteamos la variable scrollCachePosition a 0 para poder ejecutar el script tantas veces sea necesario.
			scrollCachePosition = 0;
		}
	});	
	
});


	