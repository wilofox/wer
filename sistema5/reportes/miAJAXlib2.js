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

var myreq= createREQ();

function doAjax(url,query,callback,reqtype,getxml,nropagina,cod,consulta) {
//alert(url+"  "+query+"  "+callback+"  "+reqtype+"  "+getxml);
	
//	txtcriterio1=document.form1.txtcriterio1.value;
	//txtvalor1=document.form1.txtvalor1.value;

//	var query2='&txtcriterio1='+document.form1.txtcriterio1.value+'&txtvalor1='+document.form1.txtvalor1.value+'&pag='+nropagina+'&cod='+cod+'&consulta='+consulta;nomb_det

//query='codsuc='+document.form1.sucursal.value;
// crea la instancia del objeto XMLHTTPRequest 
var query=query;
//query+='codsuc='+document.form1.sucursal.value;

//alert(url+"  "+query+"  "+callback+"  "+reqtype+"  "+getxml+" "+nropagina+" "+cod+" "+consulta);
	//alert(query);

myreq = createREQ();

myreq.onreadystatechange = function() {
	if(myreq.readyState == 4) {
		
	   if(myreq.status == 200) {
	  
		  var item = myreq.responseText;
		  if(getxml==1) {
			 item = myreq.responseXML;
		  }
		  //alert(callback+" "+item)
		//  setTimeout("",20000);
		doCallback(callback, item)
		}
 	 }else{
		 
		if(eval("document.getElementById('carga')")!=null){
			if(document.form1.carga.value!="S"){
			
			var length_div=document.getElementById('detalle').style.width.length;
			var width_div=document.getElementById('detalle').style.width.substring(0,length_div-2)/2;
			//alert(width_div);
			document.getElementById('detalle').innerHTML="<br><br><br><br><span style='padding-left:"+width_div+"px'><img src='../imgenes/cargando2.gif' > Cargando .....</span>";
			document.form1.carga.value="S";
			}	 
		}
		
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
	requestPOST(url,query,myreq);
	} else {
	
	requestGET(url,query,myreq);
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
	myreq.abort();

	} 