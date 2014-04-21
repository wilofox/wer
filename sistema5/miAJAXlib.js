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
	//alert(url+" "+query+" "+req);
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

var myreq;

function doAjax(url,query,callback,reqtype,getxml,nropagina,cod,consulta) {
	//	alert(url+"  "+query+"  "+callback+"  "+reqtype+"  "+getxml);
	//alert('fdg');
//alert(carga);
//	txtcriterio1=document.form1.txtcriterio1.value;
	//txtvalor1=document.form1.txtvalor1.value;

//	var query2='&txtcriterio1='+document.form1.txtcriterio1.value+'&txtvalor1='+document.form1.txtvalor1.value+'&pag='+nropagina+'&cod='+cod+'&consulta='+consulta;nomb_det

//var query2='prod='+document.formulario.codprod.value+query+'&notas='+document.formulario.termino.value+'&cant='+document.formulario.cantidad.value+'&cod='+cod+'&accion='+consulta;

var query2='&prod='+document.formulario.codprod.value+query+'&cant='+document.formulario.cantidad.value+'&cod='+cod;

//alert(query2);
// crea la instancia del objeto XMLHTTPRequest 
query=query2;

//alert(query);
//query=query2;

//alert(url+"  "+query+"  "+callback+"  "+reqtype+"  "+getxml+" "+nropagina+" "+cod+" "+consulta);
	//alert(query);

myreq = createREQ();
var temp=0;
myreq.onreadystatechange = function() {
	

	 
	 
	if(myreq.readyState == 4) {
		
		if(eval("document.getElementById('accion')")!=null)
  		 {
		Popup.hide('modal'); 
   		}
	
	   if(myreq.status == 200) {
			
		  var item = myreq.responseText;
		  if(getxml==1) {
		  item = myreq.responseXML;
			   //alert(myreq.status);
		  }
		  //alert(callback+" "+item)
		//  setTimeout("",20000);
		doCallback(callback, item)
		temp=0;
		  }
 	 
	 }else{
	  
	  if(eval("document.getElementById('ptoventa')")!=null && temp==0){
		  
		   if(document.getElementById('productos').style.visibility=='visible' && document.formulario.ptoventa.value=='S'){
			document.getElementById('detalle').innerHTML="<br><br><br><br><span style='padding-left:150px'><img src='imgenes/cargando2.gif' > Cargando .....</span>";
		   }
		   	   
		  temp=1;
		  
	  }
	  
	

if(eval("document.getElementById('accion')")!=null)
   {
	
		  if(document.getElementById('productos').style.visibility=='visible'){
			document.getElementById('detalle').innerHTML="<br><br><br><br>Cargando...";
		  }
		  
		  if(document.getElementById('auxiliares').style.visibility=='visible'){
		  document.getElementById('detalle1').innerHTML="<br><br><br><br>Cargando...";
		  }
		  
		 
		  
			  if(document.formulario.accion.value=="grabar" || document.formulario.carga.value=="S"){
				  if(document.getElementById('modal').style.display=='none'){
				  Popup.showModal('modal');return false;
				  }
			  }
			  
			  
			  
		  
	}   
	   
 }
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


//function eliminar(codigo){
	//var respuesta=confirm("confirmass que desea eliminar este dato?")
	//if(respuesta)
	//{
	//doAjax('pedido_det.php','','mostrar','get','0','1',codigo,'eliminar');
//	alert("eliminando Codigo numero: "+codigo);
	//}
	//else
	//{
		//alert("no se pudo eliminar..");
//	}
	//}


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
	//alert();
	myreq.abort();

	} 