<?php 
session_start();
include('conex_inicial.php');
unset($_SESSION['productos']);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Nota de Credito</title>
<link href="styles.css" rel="stylesheet" type="text/css">

<script language="javascript" src="miAJAXlib2.js"></script>

    <script src="jquery-1.2.6.js"></script>
    <script src="jquery.hotkeys.js"></script>
	<script src="mootools-comprimido-1.11.js"></script>

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
.Estilo25 {font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #FFFFFF; }
</style></head>

<body  onLoad="javascript:detalle_ref(event);" >
<form name="form1" method="post" action="">

				  	<?
					$strSQLX="select * from cab_mov where cod_cab='".$_REQUEST['codigo']."' ";
					$resultadoX=mysql_query($strSQLX,$cn);
					$rowX=mysql_fetch_array($resultadoX); 	
					//echo $rowX['cod_ope'];				
					
					$strSQLD="select * from docuser where usuario='".$_SESSION['codvendedor']."' and doc='TN' and tipomov='2' ";
					$resultadoD=mysql_query($strSQLD,$cn);
					$rowD=mysql_fetch_array($resultadoD); 
					//echo $rowD['serie'];
					if ($rowD['serie']==""){
					$ser_docNT='001';
					}else{
					$ser_docNT=$rowD['serie'];
					}
					
					$strSQLC="select max(Num_doc) as Num_doc from cab_mov where serie='".$rowD['serie']."' and cod_ope='TN' and tipo='2' ";
					$resultadoC=mysql_query($strSQLC,$cn);
					$rowC=mysql_fetch_array($resultadoC); 
					$rowC['Num_doc']=$rowC['Num_doc']+1;
					$cod_docNT=$rowC['Num_doc'];
					$cod_docNT=str_pad($cod_docNT, 7, "0", STR_PAD_LEFT);
					//echo  $cod_docNT;
					
					$strSQl="select * from operacion where codigo='TN' and  tipo='2'   ";
					$resultado=mysql_query($strSQl,$cn);
					while($row=mysql_fetch_array($resultado)){
					$cod_doc=$row['codigo'];
					$des_cod_doc=$row['descripcion'];
					$formato_imp=$row['formato'];
					$cola_imp=$row['cola'];
					$imp1=$row['imp1'];
					
					 $permiso1=substr($row['p1'],3,1);
					 $permiso2=substr($row['p1'],8,1);
					//echo $row['p1'];
					if ($permiso1=='N'){
					$imp1=$imp1;
					$incluidoigv='S';
					}else{
					$imp1=0;
					}

					
					}
					
					?>
		<input name="incluidoigv" id="incluidoigv" type="hidden" value="<?=$incluidoigv;?>">
		<input name="permiso2" id="permiso2" type="hidden" value="<?=$permiso2;?>">				
		<input name="impuesto" id="impuesto" type="hidden" value="<?=$imp1;?>">			
  <table width="500" height="296" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="12" height="65">&nbsp;</td>
      <td width="472"><table width="474" height="50" border="0" cellpadding="0" cellspacing="0" style="border:#999999 solid 1px">
          <tr>
            <td width="472" align="center"><table width="447" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="144"><span class="Estilo13" style="font-size:18px">Nota de Credito </span></td>
                  <td width="235"><span class="Estilo13" style="font-size:18px; color:#FF0000">
                    (<input class="textStyocultar"  name="codSNC" type="text" readonly id="codSNC" size="3" value="<?=$ser_docNT;?>" border="0" style="background-color:#F3F3F3; color:#FF0000; text-align:center;font-size:18px;" />-<input class="textStyocultar"  name="codCNC" type="text" readonly id="codCNC" size="8" value="<?=$cod_docNT;?>" border="0" style="background-color:#F3F3F3; color:#FF0000; text-align:center;font-size:18px;" />)
                  </span>		  <input name="doc" type="hidden"  value="<?php echo $rowX['cod_ope']?>" size="5" maxlength="3" readonly>
                  <input type="hidden" name="sucursal" value="<?php echo $_REQUEST['sucursal']?>">
                  <input type="hidden" name="codigo" value="<?php echo $_REQUEST['codigo']?>"></td>
                  <td width="68">
			<input name="cod_ref" type="hidden" value="" size="8">
			<input name="cod_cli_ref" type="hidden" value="" size="8">
			<input name="des_cli_ref" type="hidden" value="" size="8">
			<input name="moneda_doc" id="moneda_doc" type="hidden" value="" size="8">	
            <input name="impto" id="impto" type="hidden" value="" size="8">    	
			<input name="cola_imp" id="cola_imp" type="hidden"  value="<?php echo $cola_imp;?>">
           	<input name="formato_imp" id="formato_imp" type="hidden" value="<?php echo $formato_imp;?>">
								</td>
                </tr>
                <tr>
                  <td><div align="right"><span class="Estilo13" >Documento  Origen :</span> </div></td>
                  <td><input name="serie" type="text" value="<?=$rowX['serie'];?>" size="3" maxlength="3" readonly class="textStyocultar" style="background-color:#F3F3F3;">
                  <input name="numero" type="text" value="<?=$rowX['Num_doc'];?>" size="9" maxlength="7" autocomplete='off' readonly class="textStyocultar" style="background-color:#F3F3F3;"></td>
                  <td>&nbsp;</td>
                </tr>
            </table></td>
          </tr>
      </table></td>
      <td width="16">&nbsp;</td>
    </tr>
    <tr>
      <td height="190">&nbsp;</td>
      <td valign="top" style="border:#999999 solid 1px">
	  <table width="474" border="0" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF" >
  <tr  style="background:url(imagenes/bg_contentbase4.gif); background-position:100% 60%">
    <td width="32" align="center"><span class="texto1">
      <input name="CodNT" type="checkbox" id="CodNT" style="border: 0px; background:none; " onClick="marcar_NC('T')" />
    </span></td>
    <td width="32" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>Cod</strong></span></td>
    <td width="281"><span class="Estilo2 Estilo1 Estilo11"><strong>Descripci&oacute;n</strong></span></td>
    <td width="36" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>Uni.</strong></span></td>
    <td width="36" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>Cant.</strong></span></td>
    <td width="40" height="18" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>PUnit.</strong></span></td>
    <td width="45" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>Total</strong></span></td>
  </tr>

</table>
	  <div id='det_doc' style="height:185; overflow:auto"></div>
	  </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
	      <input name="crear" type="button" id="crear" onClick="save_ref()" value="Crear N.C." disabled>
          <input name="cancelar" type="button" id="cancelar" onClick="vaciar_sesiones();detalle_ref(event);" value="Cancelar"></td>
		  
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<script>
jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_esc').addClass('dirty'); 
close()
return false; });

function detalle_ref(e){
  // if(e.keyCode==13){
	generar_ceros(e,7,"numero");
	
	doc=document.form1.doc.value;
	numero=document.form1.numero.value;
	serie=document.form1.serie.value;
	sucursal=document.form1.sucursal.value;
	impuesto='1.'+document.form1.impuesto.value;
    doAjax('peticion_ajax4.php','&serie='+serie+'&numero='+numero+'&doc='+doc+'&sucursal='+sucursal+'&det_ref'+'&accion=buscar&impuesto='+impuesto,'rpta_det_ref','get','0','1','',''); 
 
  //  }
 

}

function rpta_det_ref(texto){
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

	function quitar_items(codigo){
	
	var cod_cli_ref=document.form1.cod_cli_ref.value;
	var des_cli_ref=document.form1.des_cli_ref.value;
	
doAjax('peticion_ajax4.php','&cod='+codigo+'&det_ref'+'&accion=quitar&cod_ref='+document.form1.cod_ref.value+'&codcliente_ref='+cod_cli_ref+'&descliente_ref='+des_cli_ref,'rpta_det_ref','get','0','1','',''); 
	
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

try {
		var cont = 0; 
		for(var i=0;i<document.form1.codigoNT.length;i++){
				if (document.form1.codigoNT[i].checked) {
				cont = cont + 1;
				}		
		}
		if (document.form1.codigoNT.length==undefined){
			if (document.form1.codigoNT.checked) {
				cont = 1;
			}
		}
} catch(e) { }
if (cont==0){
return false;
}

var serie=document.form1.serie.value;
var numero=document.form1.numero.value;
var doc=document.form1.doc.value;
var cod_cli_ref=document.form1.cod_cli_ref.value;
var des_cli_ref=document.form1.des_cli_ref.value;
var cod_cab_ref=document.form1.cod_ref.value;
var moneda_doc=document.form1.moneda_doc.value;
var impto=document.form1.impto.value;
var codSNC=document.form1.codSNC.value;
var total_doc=document.form1.total_doc.value;
var monto=document.form1.monto.value;
var impuesto1=document.form1.impuesto1.value;
var incluidoigv=document.form1.incluidoigv.value;
var igv=document.form1.impuesto.value;

//window.opener.cargar_ref(serie,numero,cod_cli_ref,des_cli_ref,cod_cab_ref,moneda_doc,impto);
doAjax('compras/peticion_datos.php','&peticion=save_TN&serie='+serie+'&numero='+numero+'&doc='+doc+'&codSNC='+codSNC+'&total_doc='+total_doc+'&monto='+monto+'&impuesto1='+impuesto1+'&incluidoigv='+incluidoigv+'&igv='+igv,'mostrar_grabacion','get','0','1','','');
//close();
}
function mostrar_grabacion(texto){
	var xtemp=texto.split(":");
	
	//alert(texto);
	//open
	var cola_imp=document.form1.cola_imp.value;
	var formato=document.form1.formato_imp.value;
	var codigo=document.form1.codigo.value;	
	//Imprecion	 //showModalDialog
	close();
	
	win00=window.open('formatos/'+formato+'?codcab='+xtemp[f]+'&codigo='+codigo,'ventana2','width=850,height=1000,top=100,left=100,scroolbars=yes,status=yes');		
	
}
	jQuery(document).bind('keydown', 'return',function (evt){jQuery('#_return').addClass('dirty'); 
	
	if(document.activeElement.name=='doc'){
		
		document.form1.serie.focus();	
	}
	
	return false; });

function vaciar_sesiones(){
doAjax('compras/vaciar_sesiones.php','','','get','0','1','','');
}
function marcar_NC(Valor){
//objeto.style.background='url(../imagenes/sky_blue_sel.png)';
document.form1.crear.disabled=true;
if (Valor=='T'){
	if(document.form1.CodNT.checked){	
			for(var i=0;i<document.form1.codigoNT.length;i++){
				if (document.form1.codigoNT[i].disabled){			
				}else{
				document.form1.codigoNT[i].checked=true;
				document.form1.cant_det[i].disabled="";	
				document.form1.crear.disabled=false;				
				}			
			}				
	}else{
	
			for(var i=0;i<document.form1.codigoNT.length;i++){
				document.form1.codigoNT[i].checked=false;			
				document.form1.cant_det[i].disabled="disabled";		
				}
	}	
}else{

	for(var i=0;i<document.form1.codigoNT.length;i++){
		if (document.form1.codigoNT[i].checked){
			document.form1.cant_det[i].disabled="";
			document.form1.crear.disabled=false;
			//document.form1.cant_det[i].focus();
		}else{
			document.form1.cant_det[i].disabled="disabled";	
		}			
					
	}
	if (document.form1.codigoNT.length==undefined){
		if (document.form1.codigoNT.checked){
			document.form1.cant_det.disabled="";
			document.form1.crear.disabled=false;
		}else{
			document.form1.cant_det.disabled="disabled";	
		}	
	}
}		

}

function Modificar_Precio(e,valor,it){
document.form1.crear.disabled=true;
	if(e.keyCode==13){	
		var monto="";
		monto=valor.value;
		monto=parseFloat(monto);
		var ckbNC='';		
		if (document.form1.codigoNT.length==undefined){
		var valorRk=parseFloat(document.form1.cantX.value);
		var codigo=document.form1.codigoNT.value;
			ckbNC=document.form1.codigoNT.checked;	
		}else{
		var valorRk=parseFloat(document.form1.cantX[it].value);
		var codigo=document.form1.codigoNT[it].value;
			for(var i=0;i<document.form1.codigoNT.length;i++){
	    		ckbNC=ckbNC+','+document.form1.codigoNT[i].checked;	
			}
		}
		if(isNaN(monto)){
			alert('Por favor digite cantidad válida');
			valor.value='0';
			return false;
		}else if (valor.value>valorRk ){
			alert('La cantidad no debe de ser mayor al real');
			if (document.form1.codigoNT.length==undefined){
			document.form1.cant_det.value=valorRk;
			}else{
			document.form1.cant_det[it].value=valorRk;
			}			
			cant_prod=valorRk;			
			//return false;
		}else if (valor.value<=0){
			alert('La cantidad no debe de ser menor ni igual a cero');
			if (document.form1.codigoNT.length==undefined){
			document.form1.cant_det.value=valorRk;
			}else{
			document.form1.cant_det[it].value=valorRk;
			}
			cant_prod=valorRk;			
			//return false;
		}else{
			var control=valor.id;		
			var cod_cli_ref=document.form1.cod_cli_ref.value;
			var des_cli_ref=document.form1.des_cli_ref.value;			
			var cant_prod=parseFloat(valor.value);			
		}
impuesto='1.'+document.form1.impuesto.value;		
document.form1.crear.disabled=false;		
doAjax('peticion_ajax4.php','&cod='+codigo+'&det_ref'+'&accion=update&cod_ref='+document.form1.cod_ref.value+'&codcliente_ref='+cod_cli_ref+'&descliente_ref='+des_cli_ref+'&cant_prod='+cant_prod+'&ckbNC='+ckbNC+'&impuesto='+impuesto,'rpta_det_ref','get','0','1','','');
		
	}
}
function Modificar_Precio2(e,valor,it){
//document.form1.crear.disabled=false;
		var ckbNC='';		
		if (document.form1.codigoNT.length==undefined){
		var valorRk=parseFloat(document.form1.cantX.value);
		var codigo=document.form1.codigoNT.value;
			ckbNC=document.form1.codigoNT.checked;
		monto=document.form1.cant_det.value;
		monto=parseFloat(monto);	
		}else{
		monto=document.form1.cant_det[it].value;
		monto=parseFloat(monto);
		var valorRk=parseFloat(document.form1.cantX[it].value);
		var codigo=document.form1.codigoNT[it].value;
			for(var i=0;i<document.form1.codigoNT.length;i++){
	    		ckbNC=ckbNC+','+document.form1.codigoNT[i].checked;	
			}
		}		
		if(isNaN(monto)){
			alert('Por favor digite cantidad válida');
			monto='0';
			//return false;
		}else if (monto>valorRk ){
		alert(monto +"**"+ valorRk);
			alert('La cantidad no debe de ser mayor al real');
			if (document.form1.codigoNT.length==undefined){
			document.form1.cant_det.value=valorRk;
			}else{
			document.form1.cant_det[it].value=valorRk;
			}
			cant_prod=valorRk;			
			//return false;
		}else if (monto<=0){
			alert('La cantidad no debe de ser menor ni igual a cero');
			if (document.form1.codigoNT.length==undefined){
			document.form1.cant_det.value=valorRk;
			}else{
			document.form1.cant_det[it].value=valorRk;
			}
			cant_prod=valorRk;			
			//return false;
		}else{
			var control=valor.id;		
			var cod_cli_ref=document.form1.cod_cli_ref.value;
			var des_cli_ref=document.form1.des_cli_ref.value;
			var cant_prod=parseFloat(monto);			
		}
		impuesto='1.'+document.form1.impuesto.value;
doAjax('peticion_ajax4.php','&cod='+codigo+'&det_ref'+'&accion=update&cod_ref='+document.form1.cod_ref.value+'&codcliente_ref='+cod_cli_ref+'&descliente_ref='+des_cli_ref+'&cant_prod='+cant_prod+'&ckbNC='+ckbNC+'&impuesto='+impuesto,'rpta_det_ref','get','0','1','','');

}
function rspta_detSalMat(texto){
alert(texto);
document.getElementById('detSalMat').innerHTML=texto;
document.formulario.termino.disabled='disabled';
}

function enfocar_prod(objeto){
	// enfocar lo check con un ncolor rk
	for(var i=0;i<document.form1.codigoNT.length;i++){		
		if (document.form1.codigoNT[i].checked){
			 document.getElementById('lista_prodNC').rows[(i)].style.backgroundColor = '#999999';
		}else{
			document.getElementById('lista_prodNC').rows[(i)].style.backgroundColor = 'white';
		}
	}

}

</script>