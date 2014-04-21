// JavaScript Document
$(document).ready(function() {

	/*$(document).keydown(function(tecla){
		if($("#reportes").length > 0){
			if( $("#reportes").val() == 'documentos_faltantes' ){
				if (tecla.keyCode == 13) {
					consultar_documentos_faltantes();
				}
			}
		}
	});*/

	$('#progressbar').progressbar({ value: 100 });
	$('#progressbar').hide();

	var opcion = 'numeros';

	var consultar_kardex = function() {
		$('#progressbar').show();
		$.post('resultado_kardex.php',{
				sucursal: $('#sucursal').val(),
				tienda: $('#almacen').val(),
				fecha1: $('#inicio').val(),
				fecha2: $('#termino').val()
			},
			function (response) {
				$('#resultados').html(response);
				$('#progressbar').hide();
			}
		);
	};

	if($("#inicio, #termino").length > 0){ 
		var dates = $("#inicio, #termino").datepicker({
			dateFormat:'dd-mm-yy',
			onSelect: function( selectedDate ) {
				var option = this.id == "inicio" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
	}

	if($("#sucursal").length > 0){ 
		$('#sucursal').change(function() {
			$.post('cargar_tiendas.php',{
					id_sucursal: $(this).val()
				},
				function (response) {
					var record = response.data;
					$('#almacen').html('<option value="0">Todas</option>');
					for( x = 0 ; x < record.length ; x++){
						$('#almacen').append('<option value='+record[x].cod_tienda+'>'+record[x].des_tienda+'</option>');
					}
				}, 'json'
			);
		});
	}


	if($("#btnProcesar").length > 0){
		$("#btnProcesar").click(function(){
			consultar_kardex();
		});
	}


	/*	Documentos faltantes	*/
	if($("#sleApp").length > 0){ 
		$('#sleApp').change(function() {
			$.post('cargar_operaciones.php',{
					id_tipo: $(this).val()
				},
				function (response) {
					var record = response.data;
					$('#sleDocumento').html('');
					for( x = 0 ; x < record.length ; x++){
						$('#sleDocumento').append('<option value='+record[x].codigo+'>'+record[x].descripcion+'</option>');
					}
				}, 'json'
			);
		});
	}

	//if($("#txtSerie").length > 0){  $("#txtSerie").mask( "999", {placeholder:"0"} ); }
	//if($("#serie_inicio, #serie_termino").length > 0){  $("#serie_inicio, #serie_termino").mask("9999999", {placeholder:"0"} ); }

	if($("#reportes").length > 0){
		if( $("#reportes").val() == 'documentos_faltantes' ){
			$('#serie_inicio, #serie_termino').prop('disabled', false);
			$('#inicio, #termino').prop('disabled', true);
		}
	}

	if($("input[name='rdoOpcion']").length > 0){
		$("input[name='rdoOpcion']").click(function() {
			if( $("input[name='rdoOpcion']:checked").val() == 'numeros' ){
				
				$('#serie_inicio, #serie_termino').prop('disabled', false);
				$('#inicio, #termino').prop('disabled', true);
				
			}else{
				
				$('#serie_inicio, #serie_termino').prop('disabled', true);
				$('#inicio, #termino').prop('disabled', false);
				
			}
		});
	}

	if($("#btnProcesarDocumentosFaltantes").length > 0){
		$("#btnProcesarDocumentosFaltantes").click(function(){
			consultar_documentos_faltantes();
		});
	}

	var consultar_documentos_faltantes = function() {
		$('#resultados').html('');
		$('#progressbar').show();
		$.post('resultados_documentos_faltantes.php',{
				sleSucursal: $('#sleSucursal').val(),
				sleDocumento: $('#sleDocumento').val(),
				txtSerie: $('#txtSerie').val(),
				rdoOpcion: $("input[name='rdoOpcion']:checked").val(),
			   	serie_inicio: $('#serie_inicio').val(),
				serie_termino: $('#serie_termino').val(),
				inicio: $('#inicio').val(),
				termino: $('#termino').val()
			},
			function (response) {
				$('#progressbar').hide();
				$('#resultados').html(response);
			}
		);
	};

	/*	Exportar registros	*/
	if($("#reportes").length > 0){
		if( $("#reportes").val() == 'documentos_faltantes' ){

			if($("#btnExportar").length > 0){
				$("#btnExportar").click(function(){
					var pagina = "exportar_excel.php?sleApp="+$('#sleApp').val()+"&sleSucursal="+$('#sleSucursal').val()+"&sleDocumento="+$('#sleDocumento').val()+"&txtSerie="+$('#txtSerie').val()+"&rdoOpcion="+$("input[name='rdoOpcion']:checked").val()+"&serie_inicio="+$('#serie_inicio').val()+"&serie_termino="+$('#serie_termino').val()+"&inicio="+$('#inicio').val()+"&termino="+$('#termino').val();
					location.href = pagina;
				});
			}

		}

	}

});