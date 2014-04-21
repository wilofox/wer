//window.attachEvent('onload',inicializar);

function inicializar(){
	
	doAjax('pedido_det.php','','mostrar','get','0','1','','');
	}
	
function createREQ() {
try {
     req = new XMLHttpRequest(); /* p.e. Firefox */
     } catch(err1) {
       try {
       req = new ActiveXObject('Msxml2.XMLHTTP'); /* algunas versiones IE */
       } catch (err2) {
         try {
         req = new ActiveXObject("Microsoft.XMLHTTP"); /* algunas versiones IE */
         } catch (err3) {
          req = false;
         }
       }
     }
     return req;
}

function requestGET(url, query, req) {
//	alert(url+" "+query+" "+req);
myRand=parseInt(Math.random()*99999999);
req.open("GET",url+'?'+query+'&rand='+myRand,true);
//alert(url+'?'+query+'&rand='+myRand);
req.send(null);
}

function requestPOST(url, query, req) {
req.open("POST", url,true);
req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
req.send(query);
}

function doCallback(callback,item) {
//	alert("entro");
eval(callback + '(item)');
//var f=callback + '(item)';
}

//var myreq2 = createREQ();
//var myreq2;

function doAjax(url,query,callback,reqtype,getxml,nropagina,cod,consulta) {
		//alert(url+"  "+query+"  "+callback+"  "+reqtype+"  "+getxml);
//	alert();
//	txtcriterio1=document.form1.txtcriterio1.value;
	//txtvalor1=document.form1.txtvalor1.value;

//	var query2='&txtcriterio1='+document.form1.txtcriterio1.value+'&txtvalor1='+document.form1.txtvalor1.value+'&pag='+nropagina+'&cod='+cod+'&consulta='+consulta;nomb_det
	/*
query='prod='+document.formulario.codprod.value+query+'&notas='+document.formulario.termino.value+'&cant='+document.formulario.cantidad.value+'&cod='+cod+'&accion='+consulta;*/
// crea la instancia del objeto XMLHTTPRequest 
//var query=query;

//alert(url+"  "+query+"  "+callback+"  "+reqtype+"  "+getxml+" "+nropagina+" "+cod+" "+consulta);
	//alert(query);

//var myreq = createREQ();
var myreq2 = createREQ();

myreq2.onreadystatechange = function() {
	if(myreq2.readyState == 4) {
		
	   if(myreq2.status == 200) {
	  
		  var item = myreq2.responseText;
		  if(getxml==1) {
			 item = myreq2.responseXML;
		  }
		  //alert(callback+" "+item)
		//  setTimeout("",20000);
		doCallback(callback, item)
		}
 	 }else{
		 try{
	//	 alert(cod);
		if(eval("document.getElementById('carga')")!=null){
			if(document.form1.carga.value!="S"){
			
			var length_div=eval("document.getElementById('"+cod+"').style.width.length");
			var width_div=eval("(document.getElementById('"+cod+"').style.width.substring(0,length_div-2)/2)")-35;
			
			var temp=eval("document.getElementById('"+cod+"')");
			
							
					temp.innerHTML="<br><br><br><br><span style='padding-left:"+width_div+"px';><img src='../imgenes/cargando2.gif' > Cargando .....</span>";
				
			
			document.form1.carga.value="S";
			//document.form1.carga.style;
			}	 
		}
		 }catch(e){}
	}
 // else
 // {
	   //setTimeout(alert('hola'),2000000); 
	 // alert('hola');
//document.getElementById('resultado').style.display="none";
//document.getElementById('cabecera').style.display="block";

}
//alert(item);
	if(reqtype=='post') {
	requestPOST(url,query,myreq2);
	} else {
	
	requestGET(url,query,myreq2);
	}
}


function eliminar(codigo){
	var respuesta=confirm("confirma que desea eliminar este dato?")
	if(respuesta)
	{
	doAjax('pagos_det.php','accion=eliminar&cod_pago='+codigo,'lista_pago','get','0','1','','');
//	alert("eliminando Codigo numero: "+codigo);
	}
	else
	{
		//alert("no se pudo eliminar..");
	}
	}


function modificar(pagina,codigo)
{
	
doAjax('result2.php','','mostrar','get','0',pagina,codigo,'modificar');

//alert(fila);
}

function guardar(pagina,codigo){
	
	var nombre=document.getElementById('cnombre').value;
	var ruc=document.getElementById('cruc').value;
	var dni=document.getElementById('cdni').value;
	var tipo=document.getElementById('ctipo').value;
	var telefono=document.getElementById('ctelefonos').value;
	var fax=document.getElementById('cfaxes').value;
	
	var query="nombre="+nombre+"&ruc="+ruc+"&dni="+dni+"&tipo="+tipo+"&telefono="+telefono+"&fax="+fax;
	doAjax('result2.php',query,'mostrar','get','0',pagina,codigo,'actualizar');
	
	}

function cancel_peticion(){
	myreq2.abort();

	} 