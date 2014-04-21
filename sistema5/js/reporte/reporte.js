function cargar_cbo(texto){
		var r = texto;
		document.getElementById('cbo_tienda').innerHTML=r;
	}
	
function cargar_combox()
{ if( $('cod_suc').value != '' )
    {  param = 'cod_tienda='+$('cod_suc').value;
       path = 'funciones/select_tienda.php';
	   AjaxUpdate( 'div_tienda', param , path );
	}
}
function mostrar_consolidado( idMostrar , anio , mes , cod_suc , cod_tienda , codigo_caja , codigo_usuario , agrupacion )
{
	var anio_ 			= 	$(anio).value;
	var mes_ 			= 	$(mes).value;
	var cod_suc_ 		= 	$(cod_suc).value;
	var cod_tienda_ 	= 	$(cod_tienda).value;
	var codigo_caja_ 	= 	$(codigo_caja).value;
	var codigo_usuario_ = 	$(codigo_usuario).value;
	var agrupacion_ 	= 	$(agrupacion).value;
    var path_msj 		= 	'msj_espera.php';
	var path 			=   'reportes/rpt_consolidado_venta_mensual.php';	
	
	msjEspera( idMostrar , path_msj );
	param = 'anio=' + anio_ + '&mes=' + mes_ + '&cod_suc=' + cod_suc_  + '&cod_tienda=' + cod_tienda_ + '&codigo_caja=' + codigo_caja_ + '&codigo_usuario=' + codigo_usuario_ + '&agrupacion=' + agrupacion_;

	AjaxUpdate( idMostrar , param , path );	
}

function cargar_doc(e,valor,temp){
	if(document.getElementById(temp).style.visibility!='visible' ){
		
		$var_cad = "&temp="+temp+"&tipo=2"+"&reporte=CONSOLIDADO_VENTA";
		doAjax('reportes/documentos.php', $var_cad,'listadocumentos','get','0','1','','');
	}
}

function listadocumentos(texto){
	var r = texto;
	document.getElementById('docincluir').innerHTML=r;
	document.getElementById('docincluir').style.visibility='visible';
}

function salir(){
	if (document.getElementById('docincluir').style.visibility=='visible'){
	document.getElementById('docincluir').style.visibility='hidden';
	}else
	document.getElementById('auxiliares').style.visibility='hidden';
	
}

function marcar(){	
	if( document.form1.GrupoOpciones1[0].checked){
		for(var i=0;i<document.form1.Ingresos.length;i++){
		document.form1.Ingresos[i].checked=true;
		}	
	}
	else{
		for(var i=0;i<document.form1.Ingresos.length;i++){
		document.form1.Ingresos[i].checked=false;
		}		
	}
}	

// SE GUARDAN LOS DATOS
function Guarda(){
	var temp1=0;
	var docRk ='';
	
	for(var i=0;i<document.form1.Ingresos.length;i++){	
		if(document.form1.Ingresos[i].checked){
		docRk+=document.form1.Ingresos[i].value+',';
		temp1=1;
		}		
	}
			
	if(temp1==0){
	alert('Seleccione Documento');
	return false
	}
    
	doAjax('reportes/documentos.php','&docRk='+docRk+'&reporte=CONSOLIDADO_VENTA','','get','0','1','','');
	document.getElementById('docincluir').style.visibility='hidden';
	mostrar_consolidado('mostrar_busqueda','anio','mes','cod_suc','cod_tienda','codigo_caja','codigo_usuario','agrupacion' );
}