<?php 
include('conex_inicial.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documentos de Referencia</title>
<link href="styles.css" rel="stylesheet" type="text/css">

<script language="javascript" src="miAJAXlib2.js"></script>

    <script src="jquery-1.2.6.js"></script>
    <script src="jquery.hotkeys.js"></script>
	<script src="mootools-comprimido-1.11.js"></script>
<script>
function FiltraDoc(obj,e){
	if(e.keyCode==13){
		for(i=0;i<=1;i++){
			if(document.form1.buscarpor[i].checked){
				buscarpor=document.form1.buscarpor[i].value;
			}
		}
		doc=document.form1.doc.value;
		numero=document.form1.numero.value;
		serie=document.form1.serie.value;
		//sucursal=document.form1.sucursal.value; +'&sucursal='+sucursal
		cliente=document.form1.cliente.value;
		serie_prod=document.form1.serie_prod.value;
		docu='';
		if(serie!="" && numero!=""){
			docu='&serie='+serie+'&numero='+numero;
		}
		if(serie_prod==""){
			doAjax('peticion_ajax3.php','&doc='+doc+docu+'&cliente='+cliente+'&det_ref_cli'+'&accion=buscar','rpta_det_ref','get','0','1','',''); 
		//
		}else{
			if(buscarpor=='serie'){
				//alert('serie');
				doAjax('peticion_ajax3.php','&doc='+doc+docu+'&cliente='+cliente+'&serie_prod='+serie_prod+'&det_ref_cli'+'&accion=buscar','rpta_det_ref','get','0','1','','');
			}else{
				//alert('no serie');
				doAjax('peticion_ajax3.php','&doc='+doc+docu+'&cliente='+cliente+'&nom_prod='+serie_prod+'&det_ref_cli'+'&accion=buscar','rpta_det_ref','get','0','1','','');
			}
		}
	}
}
function verifica_ser(texto){
	//alert(texto);
	temp=texto.split('?');
	//alert(temp[2]);
	//alert(temp[2]);
	if(temp[0]=='N'){
		switch(temp[1]){
			case '1':alert('Serie ya esta ingresada en Almacen');break;
			case '2':alert('Serie producto no se ha vendido');break;
			case '3':alert('Producto Rechazado no Procede a Garantia');break;
		}
	}else{
		save_ref();
	}
}
</script>
<style type="text/css">
<!--
body {
	background-color:#F3F3F3;   
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo11 {font-family: Verdana, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FFFFFF; }
.Estilo13 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #000000; }
-->
.Estilo18 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold color:#FFFFFF; }
.Estilo_det {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color:#000000; }
</style></head>

<body  onLoad="javascript:document.form1.doc.focus()" >
<form name="form1" method="post" action="">


  <table width="500" height="328" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="8" height="118">&nbsp;</td>
      <td width="487"><table width="493" height="118" border="0" cellpadding="0" cellspacing="0" style="border:#999999 solid 1px">
          <tr>
            <td width="491" height="116" align="center">

		<DIV id='clientedes' style="font-size:12px; color:#000000; "><b>
		<?php 
		$strSQLP="select * from cliente where codcliente ='".$_REQUEST['auxiliar2']."' ";
		$resultadoP=mysql_query($strSQLP,$cn);
		$rowP=mysql_fetch_array($resultadoP);
		echo "CLIENTE: ".$rowP['razonsocial'];

		?></b></DIV>
			<input type="hidden" name="cliente" value="<?php echo $_REQUEST['auxiliar2']?>">
			<table width="478" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="169" rowspan="2"><span class="Estilo13">Tipo de Documento </span></td>
                  <td width="144" rowspan="2"><span class="Estilo13">Documento
                    <input type="hidden" name="sucursal" value="<?php echo $_REQUEST['sucursal']?>">
                  </span></td>
                  <td width="123"><span class="Estilo13">Busqueda por:</span></td>
                  <td width="42" rowspan="2"><span class="Estilo13">
                    <input name="cod_ref" type="hidden" value="" size="8">
                    <input name="cod_cli_ref" type="hidden" value="" size="8">
                    <input name="des_cli_ref" type="hidden" value="" size="8">
                    <input name="impto" id="impto" type="hidden" value="" size="8">
                  </span></td>
                </tr>
                <tr>
                  <td height="33">
      <input name="buscarpor" type="radio" id="buscarpor_0" value="producto">
      Producto
      <input name="buscarpor" type="radio" id="buscarpor_1" value="serie" checked>
Serie</td>
                </tr>
                <tr>
                  <td height="32" valign="top"><?php /* echo "select * from operacion where tipo='$tipomov' AND codigo IN (SELECT cod_ope FROM cab_mov WHERE cod_ope IN(Select codigo from refope where documento='R1'))  order by descripcion ";*/?><select onFocus="FiltraDoc(this)" onChange="FiltraDoc(this)" style="width:160" name="doc"  >
                  	<option value="Todos"> Todos los Documentos </option>
                      <?php 
					  $tipomov=$_REQUEST['tipomov'];
					  $cliente=$_REQUEST['auxiliar2'];
					  if($cliente!=""){
						//$resultados10 = mysql_query("select * from operacion where tipo='$tipomov' AND codigo IN (SELECT cod_ope FROM cab_mov WHERE cliente=$cliente and cod_ope IN('FA','BV','NV') AND kardex='S')  order by descripcion ",$cn); 
						$resultados10 = mysql_query("select * from operacion where tipo='$tipomov' AND codigo IN (SELECT cod_ope FROM cab_mov WHERE cliente=$cliente and cod_ope IN(Select codigo from refope where documento='R1'))  order by descripcion ",$cn); 
					  }else{
						//$resultados10 = mysql_query("select * from operacion where tipo='$tipomov' AND codigo IN (SELECT cod_ope FROM cab_mov WHERE kardex='S' and cod_ope IN('FA','BV','NV'))  order by descripcion ",$cn); 
						$resultados10 = mysql_query("select * from operacion where tipo='$tipomov' AND codigo IN (SELECT cod_ope FROM cab_mov WHERE cod_ope IN(Select codigo from refope where documento='R1'))  order by descripcion ",$cn); 
					  }
					  
			while($row10=mysql_fetch_array($resultados10))
			{
			
		  ?>
                      <option value="<?php echo $row10['codigo']?>"><?php echo $row10['descripcion']?></option>
                      <?php }?>
                  </select></td>
                  <td valign="top">
				  <input name="serie" type="text" size="5" maxlength="3" onKeyUp="generar_ceros(event,3,'serie')">
				  <input autocomplete='off' name="numero" type="text" size="10" maxlength="7" onKeyUp="generar_ceros(event,7,'numero');FiltraDoc(this,event)">
				  <input type="hidden" name="des_prod" id="des_prod" value=""></td>
                  <td valign="top"><input autocomplete='off' name="serie_prod" id="serie_prod" type="text" size="15" maxlength="15" onKeyUp="FiltraDoc(this,event)">
                    <span class="Estilo13">
                    <input type="hidden" name="cod_prod" id="cod_prod" value="">
                  </span></td>
                  <td><span class="Estilo13">
                  <input name="moneda_doc" id="moneda_doc" type="hidden" value="" size="8">
                  </span>
                    <input type="hidden" name="series_prod" id="series_prod" value="">                    &nbsp;</td>
                </tr>
            </table></td>
          </tr>
      </table></td>
      <td width="10">&nbsp;</td>
    </tr>
    <tr>
      <td height="187">&nbsp;</td>
      <td align="center" valign="top" style="border:#999999 solid 1px">
	  
	  <div id='det_doc' style="height:185; overflow:auto">
	  
	  <table width="474" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td width="32" height="18" bgcolor="#008A8A"><span class="Estilo11">Cod</span></td>
            <td width="281" bgcolor="#008A8A"><span class="Estilo11">Descripcion</span></td>
            <td width="36" bgcolor="#008A8A"><span class="Estilo11">Cant</span></td>
            <td width="40" bgcolor="#008A8A"><span class="Estilo11">Punit.</span></td>
            <td width="45" bgcolor="#008A8A"><span class="Estilo11">Total</span></td>
            <td width="40" bgcolor="#008A8A">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
      </table>
	  
	  </div>
	  </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="button" name="Submit" value="Aceptar" onClick="save_ref()">
          <input type="button" name="Submit2" value="Cancelar" onClick="vaciar_sesiones()"></td>
		  
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<script>

function detalle_ref(){
//   if(e.keyCode==13){
	for(i=0;i<=1;i++){
		if(document.form1.buscarpor[i].checked){
			buscarpor=document.form1.buscarpor[i].value;
		}
	}
	numero=document.form1.numero.value;
	serie=document.form1.serie.value;
	doc=document.form1.doc.value;
	//sucursal=document.form1.sucursal.value; +'&sucursal='+sucursal
	cliente=document.form1.cliente.value;
	serie_prod=document.form1.serie_prod.value;
	if(buscarpor=='serie'){
		if(serie_prod==""){
    		doAjax('peticion_ajax3.php','&serie='+serie+'&numero='+numero+'&doc='+doc+'&cliente='+cliente+'&det_ref&accion=buscar','rpta_det_ref','get','0','1','',''); 
		}else{
			doAjax('peticion_ajax3.php','&serie='+serie+'&numero='+numero+'&doc='+doc+'&cliente='+cliente+'&serie_prod='+serie_prod+'&det_ref&accion=buscar','rpta_det_ref','get','0','1','',''); 
		}
	}else{
		if(serie_prod==""){
    		doAjax('peticion_ajax3.php','&serie='+serie+'&numero='+numero+'&doc='+doc+'&cliente='+cliente+'&det_ref&accion=buscar','rpta_det_ref','get','0','1','',''); 
		}else{
			doAjax('peticion_ajax3.php','&serie='+serie+'&numero='+numero+'&doc='+doc+'&cliente='+cliente+'&nom_prod='+serie_prod+'&det_ref&accion=buscar','rpta_det_ref','get','0','1','',''); 
		}
		//alert('Proximamente por producto');
	}
//    }
}

function cargar_doc(obj){
	for(i=0;i<=1;i++){
		if(document.form1.buscarpor[i].checked){
			buscarpor=document.form1.buscarpor[i].value;
		}
	}
	var codigo=document.getElementById(obj).childNodes[0].innerHTML;
	document.getElementById('doc').value=codigo;
	var cliente=document.getElementById(obj).childNodes[1].innerHTML.split('-');
	document.getElementById('clientedes').innerHTML="<b>CLIENTE: "+cliente[1]+"</b>";
	document.getElementById('des_cli_ref').value=cliente[1];
	document.getElementById('cod_cli_ref').value=cliente[0];
	var temp=document.getElementById(obj).childNodes[2].innerHTML.split('-');
	document.getElementById('numero').value=temp[1];
	document.getElementById('serie').value=temp[0];
	detalle_ref();
}


function rpta_det_ref(texto){
	//alert(texto);
	var temp=texto.split('?');
	if(temp[0]=='N'){
		alert('Documento no Existe');
		document.getElementById('det_doc').innerHTML=temp[6];
		document.form1.cod_ref.value="";
		document.form1.cod_cli_ref.value="";
		document.form1.des_cli_ref.value="";
		document.form1.moneda_doc.value="";
		document.form1.impto.value="";	
	}else{
		document.getElementById('det_doc').innerHTML=temp[6];
		document.form1.cod_ref.value=temp[1];
		document.form1.cod_cli_ref.value=temp[2];
		document.form1.des_cli_ref.value=temp[3];
		document.form1.moneda_doc.value=temp[4];
		document.form1.impto.value=temp[5];
	}
	
	
}

	function selec_item(codigo){
	for(i=0;i<=1;i++){
		if(document.form1.buscarpor[i].checked){
			buscarpor=document.form1.buscarpor[i].value;
		}
	}
		document.getElementById('cod_prod').value=document.getElementById(codigo).childNodes[0].innerHTML;
		document.getElementById('des_prod').value=document.getElementById(codigo).childNodes[1].innerHTML;
		document.getElementById('series_prod').value=document.getElementById(codigo).childNodes[2].innerHTML;
		cod_prod=document.getElementById('cod_prod').value;
		serie_prod=document.getElementById('series_prod').value;
		//alert(serie_prod);
		doc=document.form1.doc.value;
		numero=document.form1.numero.value;
		serie=document.form1.serie.value;
		//sucursal=document.form1.sucursal.value; +'&sucursal='+sucursal
		cliente=document.form1.cliente.value;
		docu='';
		if(serie!="" && numero!=""){
			docu='&serie='+serie+'&numero='+numero;
		}
	//if(buscarpor=='serie'){
	if(serie_prod!=""){
		//alert('serie');
		doAjax('peticion_ajax3.php','&cod_prod='+cod_prod+'&doc='+doc+docu+'&cliente='+cliente+'&serie_prod='+serie_prod+'&peticion=Verifica'+'&accion=buscar','verifica_ser','get','0','1','','');
	}else{
		//alert('no serie');
		doAjax('peticion_ajax3.php','&cod_prod='+cod_prod+'&doc='+doc+docu+'&cliente='+cliente+'&nom_prod='+serie_prod+'&peticion=Verifica'+'&accion=buscar','verifica_ser','get','0','1','','');
	}
	}
	
	function generar_ceros(e,ceros,control){
			var serie=document.form1.serie.value;
			var numero=document.form1.numero.value;
			
			if(e.keyCode==13 ){

				var valor="";
				if(control=='serie'){
				valor=serie
				}else{
				valor=numero
				}
				
				valor = parseFloat(valor);
				//alert(valor);
				if(isNaN(valor)){
				alert('Por favor digite un número válido');
				return false;
				}else{
				
				valor=valor.toString();
				}
						
			   if(control=='serie'){
				 document.form1.serie.value=ponerCeros(valor,ceros);
				 document.form1.numero.focus();
                 document.form1.numero.select();
				}
				if(control=='numero'){
				 document.form1.numero.value=ponerCeros(valor,ceros);
				}
				
			}  
	}	
	
	
	 function ponerCeros(obj,i) {
		  while (obj.length<i){
			obj = '0'+obj;
			}
		//	alert(obj);
			return obj;
		}		


function save_ref(){

var serie=document.form1.serie.value;
var numero=document.form1.numero.value;
var cod_cli_ref=document.form1.cod_cli_ref.value;
var des_cli_ref=document.form1.des_cli_ref.value;
var cod_cab_ref=document.form1.cod_ref.value;
var moneda_doc=document.form1.moneda_doc.value;
var impto=document.form1.impto.value;
var serie_prod=document.form1.series_prod.value;
var cod_prod=document.form1.cod_prod.value;
var des_prod=document.form1.des_prod.value;

window.opener.cargar_ref(serie,numero,cod_cli_ref,des_cli_ref,cod_cab_ref,moneda_doc,impto,cod_prod,des_prod,serie_prod,serie,numero);
close();

}

	jQuery(document).bind('keydown', 'return',function (evt){jQuery('#_return').addClass('dirty'); 
	
	if(document.activeElement.name=='doc'){
		
		document.form1.serie.focus();	
	}
	
	return false; });

function vaciar_sesiones(){
	document.form1.reload();
doAjax('compras/vaciar_sesiones.php','','','get','0','1','','');
}


</script>