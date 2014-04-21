<?php
session_start();
include('../conex_inicial.php');

$CodDoc=$_REQUEST['CodDoc'];
$tempCodDoc=explode("-",$CodDoc);
//print_r($tempCodDoc);
$strsql="select * from cab_mov where cod_cab='".$tempCodDoc[1]."'";
$resultado=mysql_query($strsql,$cn);
$cont=mysql_num_rows($resultado);
$row=mysql_fetch_array($resultado);
//echo $cont;

$codsucursal=$row['sucursal'];
$codtienda=$row['tienda'];
$auxiliar=$row['cliente'];
$tipo=$row['tipo'];
$condicion=$row['condicion'];
$monedacab=$row['moneda'];

list($nomAuxliar)=mysql_fetch_array(mysql_query(" select razonsocial from cliente where codcliente='".$auxiliar."'"));
list($nomEmpresa)=mysql_fetch_array(mysql_query(" select des_suc from sucursal where cod_suc='".$codsucursal."'"));
list($nomTienda)=mysql_fetch_array(mysql_query(" select des_tienda from tienda where cod_tienda='".$codtienda."'"));
list($nomCondi)=mysql_fetch_array(mysql_query(" select nombre from condicion where codigo='".$condicion."'"));

if($tipo=='1'){
$doc='F1';
}else{
$doc='FA';
}



list($imp1,$p1,$formato)=mysql_fetch_array(mysql_query(" select imp1,p1,formato from operacion where codigo='".$doc."'" ));



$SQLDocUser="select * from docuser where tipomov='".$tipo."' and doc='".$doc."' and usuario='".$_SESSION['codvendedor']."' ";
$resultadoDocUser=mysql_query($SQLDocUser,$cn);
$rowDocUser=mysql_fetch_array($resultadoDocUser);
$serieDocUser=$rowDocUser['serie'];


//echo substr($p1,4,1);
//echo "ffff".$p1;

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Facturar Pases</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #33CCCC;
}
.Estilo5 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 11px; }
.Estilo12 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #FFFFFF; font-weight: bold; }
.Estilo14 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: small; }
-->
</style></head>
<script language="javascript" src="../miAJAXlib2.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />


<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>

<body onLoad="cbo_cond()">
<form id="form1" name="form1" method="post" action="">
  <table width="604" height="278" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="23" colspan="3"><span class="Estilo14">...:::: FACTURA PASES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::: </span></td>
    </tr>
    <tr>
      <td width="9" height="110">&nbsp;</td>
      <td width="568"><fieldset>
        <table width="558" height="77" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td>&nbsp;</td>
            <td colspan="5" class="Estilo5">&nbsp;</td>
          </tr>
          <tr>
            <td width="374"><span class="Estilo5">Empresa/Tienda: <?php echo $nomEmpresa." / ".$nomTienda ?>
                <input type="hidden" name="sucursal" id="sucursal" value="<?php echo $codsucursal?>" >
              <input type="hidden" name="tienda" id="tienda" value="<?php echo $codtienda ?>" >
              <input type="hidden" name="auxiliar" id="auxiliar" value="<?php echo $auxiliar ?>" >
              <input type="hidden" name="tipomov" id="tipomov" value="<?php echo $tipo ?>" >
              <input type="hidden" name="kardex_doc" id="kardex_doc" value="<?php echo substr($p1,9,1); ?>" >
              <input type="hidden" name="deuda_doc" id="deuda_doc" value="<?php echo substr($p1,4,1); ?>" >
              <input type="hidden" name="inafecto_doc" id="inafecto_doc" value="<?php echo substr($p1,3,1); ?>" >
              <input type="hidden" name="responsable" id="responsable" value="<?php echo $_SESSION['codvendedor'] ?>" >
              <input type="hidden" name="incluidoigv" id="incluidoigv" value="S" >
              <input type="hidden" name="imp1" id="imp1" value="<?php echo $imp1?>">
              <input type="hidden" name="CodDoc" id="CodDoc" value="<?php echo $CodDoc; ?>">
              <input type="hidden" name="formato" id="formato" value="<?php echo $formato; ?>">
			  
			 <input name="obs1" type="hidden" size="8" maxlength="150">
            <input name="obs2" type="hidden" size="8" maxlength="150">
            <input name="obs3" type="hidden" size="8" maxlength="150">
            <input name="obs4" type="hidden" size="8" maxlength="150">
            <input name="obs5" type="hidden" size="8" maxlength="150">
			  
            </span></td>
            <td colspan="5" class="Estilo5"><!--<input type="hidden" name="condicion" id="condicion" value="<?php //echo $condicion ?>" >-->
            Resp.:            
            <input readonly="readonly" type="text" name="nomresponsable" id="nomresponsable" value="<?php echo $_SESSION['user'] ?>"></td>
          </tr>
          <tr>
            <td><span class="Estilo5">Tipo Documento:
                <input name="doc" type="text" size="5" maxlength="5" value="<?php echo $doc?>" />
            Nro. Factura:
             <?php 
			  if($serieDocUser!=''){
			  $desahSerie="disabled='disabled'";
			  }else{
			  $desahSerie="";
			  }
			  
			  ?>
             <input <?php echo $desahSerie ?> name="serie" id="serie" type="text" size="4" maxlength="3" onKeyUp="genNumCopiar(event,this)" value="<?php echo $serieDocUser ?>" />
            <input name="numero"  id="numero" type="text" size="8" maxlength="7"  onKeyUp="genNumCopiar(event,this)" />
            </span></td>
            <td colspan="4"><span class="Estilo5">:              T. cambio:
                
            </span></td>
            <td><span class="Estilo5">
              <input readonly="" name="tipoC"  id="tipoC" type="text" size="8" maxlength="7" value="<?php echo $tc?>" />
            </span></td>
          </tr>
          <tr>
            <td colspan="4" class="Estilo5">Razon Social: <?php echo  $nomAuxliar ?></td>
            <td width="62"><span class="Estilo5">Condici&oacute;n: </span></td>
            <td width="117">
			
			<div id="cbo_cond">            </div>			</td>
          </tr>
          
          <tr>
            <td colspan="6"><table width="554" border="1">
              <tr>
                <td width="87" bgcolor="#FF6666"><span class="Estilo5">Moneda:</span></td>
                <td width="145" bgcolor="#FF6666"><span class="Estilo5">
                  <select name="moneda" id="moneda" disabled="disabled">
				  
				  <?php if($monedacab==02){?>
                    <option value="01">S/.</option>
                    <option value="02"  selected="selected">US$.</option>
					<?php }else{?>
					<option value="01" selected="selected">S/.</option>
                    <option value="02" >US$.</option>
					<?php }?>
					
                  </select>
                  Selecionar
                </span></td>
                <td width="53" bgcolor="#FF6666"><span class="Estilo5"> Fecha: </span></td>
                <td width="133" bgcolor="#FF6666"><span class="Estilo5">
                  <input name="fechaEmi" type="text" id="fechaEmi" value="<?php echo date('d-m-Y')?>" size="10" maxlength="10">
                
		          <button type="reset" id="f_trigger_b2"  style="height:18" >...</button>
		          <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fechaEmi",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b2",   
        singleClick    :    true,           
        step           :    1                
    });
	
	
	var tempCond="<?php echo $condicion ?>";
	
	var tempMoneda="<?php echo $monedacab ?>";
	//alert(tempMoneda);
	              </script>
                </span></td>
                <td width="27"><span class="Estilo5">Impuesto</span></td>
                <td width="69">Inc. Igv</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td colspan="6">&nbsp;</td>
          </tr>
        </table>
        </fieldset>       </td>
      <td width="5">&nbsp;</td>
    </tr>
    <tr>
      <td height="23" class="Estilo5">&nbsp;</td>
      <td class="Estilo5">Detalle</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td bgcolor="#00FFCC"><table width="544" border="0" cellpadding="0" cellspacing="0">
        <tr style="background:url(../imagenes/bg_contentbase2.gif);  background-position:100% 40%;">
          <td width="50"><span class="Estilo12">Cod.</span></td>
          <td width="252"><span class="Estilo12">Producto</span></td>
          <td width="72"><span class="Estilo12">Cant.</span></td>
          <td width="72"><span class="Estilo12">P. Unit </span></td>
          <td width="64"><span class="Estilo12">Total</span></td>
        </tr>
		
		<?php 
			unset($_SESSION['productos']);
			
		foreach($tempCodDoc as $subkey=> $subvalue) {
			
			$strsql="select * from det_mov where cod_cab='".$subvalue."'";
			$resultado=mysql_query($strsql,$cn);
			$cont=mysql_num_rows($resultado);
			while($row=mysql_fetch_array($resultado)){
			
			$codprod=$row['cod_prod'];
			$nomprod=$row['nom_prod'];
			$cantprod=$row['cantidad'];
			$preprod=$row['precio'];
			$unidad=$row['unidad'];
			$moneda=$row['moneda'];
			$impitem=$row['imp_item'];
			
					$_SESSION['productos'][0][] = $row['cod_prod'];
					$_SESSION['productos'][1][] = $row['cantidad'];	
					$_SESSION['productos'][2][] = $row['precio'];
					$_SESSION['productos'][3][] = $row['notas'];	
					$_SESSION['productos'][4][] = $row['unidad'];
					
			
			$totalDoc=$totalDoc+$impitem;
		 ?>
		
        <tr>
          <td align="center" class="Estilo5"><?php echo $codprod?></td>
          <td class="Estilo5"><?php echo $nomprod?></td>
          <td align="center" class="Estilo5"><?php echo $cantprod?></td>
          <td align="right" class="Estilo5"><?php echo $preprod?></td>
          <td align="right" class="Estilo5"><?php echo $impitem?></td>
        </tr>
		
		<?php 
			}
		}
		$imp1=($imp1/100)+1;
		//echo $imp1;
		$subtotal=$totalDoc/$imp1;
		$igv=$totalDoc-$subtotal;
		
		?>
		
		
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right" bgcolor="#00FFCC"><table width="545" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="197" align="right" class="Estilo5">SubTotal: 
            <input readonly="" name="subtotal" id="subtotal" type="text" size="8" value="<?php echo number_format($subtotal,2) ?>"></td>
          <td width="147" align="right" class="Estilo5">Igv:
            <input readonly="" name="igv" id="igv" type="text" size="8" value="<?php echo number_format($igv,2)?>"></td>
          <td width="159" align="right" class="Estilo5">Total Doc:
            <input readonly="" name="totaldoc" id="totaldoc" type="text" size="8" value="<?php echo number_format($totalDoc,2)?>"></td>
          <td width="42" align="right" class="Estilo5">&nbsp;</td>
        </tr>

      </table></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center"><input type="button" name="Submit" id="Submit" value="Guardar" disabled="disabled" onClick="antes_guardar()" >
      <input type="button" name="Submit2" value="Cancelar" onClick="javascript:window.close()"></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>


<script>

function genNumCopiar(e,control){

 		
		if(e.keyCode==13){
		//alert()
				if(control.name=='serie'){
			   		var valor=document.form1.serie.value;
					var ceros=3;
					var doc=document.form1.doc.value;
					var sucursal=document.form1.sucursal.value;
					var tipomov=document.form1.tipomov.value;
					var auxiliar=document.form1.auxiliar.value;
				   document.form1.serie.value=ponerCeros(valor,ceros);
				      
				   doAjax('peticion_datos.php','&serie='+document.form1.serie.value+'&doc='+doc+'&sucursal='+sucursal+'&peticion=generar_numero_pases&tipomov='+tipomov+'&auxiliar='+auxiliar,'genNumCopiar2','get','0','1','',''); 
				  
		    	}
				if(control.name=='numero'){
			   		var valor=document.form1.serie.value;
					var ceros=3;
					var doc=document.form1.doc.value;
					var sucursal=document.form1.sucursal.value;
					var tipomov=document.form1.tipomov.value;
					var auxiliar=document.form1.auxiliar.value;
				   document.form1.serie.value=ponerCeros(valor,ceros);
				   var numero=ponerCeros(document.form1.numero.value,7);
				   document.form1.numero.value=numero;
				   
				   doAjax('peticion_datos.php','&serie='+document.form1.serie.value+'&doc='+doc+'&sucursal='+sucursal+'&peticion=generar_numero_pases&tipomov='+tipomov+'&auxiliar='+auxiliar+'&validarNum=&numero='+numero,'genNumCopiar3','get','0','1','',''); 
				  
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

function genNumCopiar2(texto){
document.form1.numero.value=ponerCeros(texto,7);;
document.form1.numero.focus();
document.form1.numero.select();
}
function genNumCopiar3(texto){

	//alert(texto);
	if(texto=='existe'){
	alert("Este Documento ya existe");
	document.form1.numero.focus();
	document.form1.numero.select();
	
	}else{
	document.form1.numero.disabled=true;
	document.form1.serie.disabled=true;
	document.form1.Submit.disabled=false;
	document.form1.Submit.focus();
	
	}
	
	
}


function antes_guardar(){
//alert();

	window.open('observaciones2.php','','width=350,height=300,top=250,left=350,scroolbars=yes,directories=yes,location=no,menubar=yes,titlebar=yes,toolbar=yes,statusbar=yes');
	
	//;
}


function guardar(){
			
			var responsable=document.form1.responsable.value;
			var tipomov=document.form1.tipomov.value;
			var tienda=document.form1.tienda.value;
			var condicion=document.form1.condicion.value;
			var femision=document.form1.fechaEmi.value;
			var fvencimiento=document.form1.fechaEmi.value;
			var monto=document.form1.subtotal.value;
			var impuesto1=document.form1.igv.value;
			var total_doc=document.form1.totaldoc.value;
	
			var incluidoigv=document.form1.incluidoigv.value;
			var auxiliar=document.form1.auxiliar.value;
			var tmoneda=document.form1.moneda.value;
			var tcambio=document.form1.tipoC.value;
			var sucursal=document.form1.sucursal.value;
			var doc=document.form1.doc.value;
			var serie=document.form1.serie.value;
			var numero=document.form1.numero.value;
			var auxiliar=document.form1.auxiliar.value;
			var impto=document.form1.imp1.value;
			var kardex_doc=document.form1.kardex_doc.value;
			var deuda_doc=document.form1.deuda_doc.value;
			var inafecto_doc=document.form1.inafecto_doc.value;
			var CodDoc=document.form1.CodDoc.value;
			
			
			var obs1=document.form1.obs1.value;
			var obs2=document.form1.obs2.value;
			var obs3=document.form1.obs3.value;
			var obs4=document.form1.obs4.value;
			var obs5=document.form1.obs5.value;
			
			//alert(condicion);
		
			
doAjax('peticion_datos.php','&responsable='+responsable+'&tipomov='+tipomov+'&tienda='+tienda+'&condicion='+condicion+'&femision='+femision+'&fvencimiento='+fvencimiento+'&monto='+monto+'&impuesto1='+impuesto1+'&total_doc='+total_doc+'&incluidoigv='+incluidoigv+'&auxiliar='+auxiliar+'&tmoneda='+tmoneda+'&tcambio='+tcambio+'&peticion=save_facturaPases'+'&sucursal='+sucursal+'&kardex_doc='+kardex_doc+'&doc='+doc+'&serie='+serie+'&numero='+numero+'&auxiliar='+auxiliar+'&impto='+impto+'&deuda_doc='+deuda_doc+'&inafecto_doc='+inafecto_doc+'&CodDoc='+CodDoc+'&obs1='+obs1+'&obs2='+obs2+'&obs3='+obs3+'&obs4='+obs4+'&obs5='+obs5,'mostrar_grabacion','get','0','1','','');
}


function mostrar_grabacion(texto){
	
	//alert(texto);
	var impresion='';
	
	if(document.form1.tipomov.value==2){
		var formato=document.form1.formato.value;
		var win00=window.open('../formatos/gedeon/'+formato+'?codcab='+texto+'&impresion='+impresion ,'ventana2','width=850,height=1000,top=100,left=100,scroolbars=yes,status=yes');	
		win00.focus();
	}
	
window.close();
}

function cbo_cond(){
	var doc=document.form1.doc.value;
	doAjax('peticion_datos.php','&doc='+doc+'&peticion=cargar_cond','cargar_cbo_cond','get','0','1','','');
	
}

function cargar_cbo_cond(texto){
//alert(texto);
	document.getElementById('cbo_cond').innerHTML=texto;
	seleccionar_cbo('condicion',tempCond);
	seleccionar_cbo('moneda',tempMoneda);
	
	document.form1.condicion.disabled=true;
	
}		
function enfocar_cbo(obj){
}
function limpiar_enfoque(obj){

}
function sumarFechaVen(obj){

}		
		
function seleccionar_cbo(control,valor){
		
		

		 var valor1=valor;
         var i;
		 //alert(valor1+" "+control);
		
		
	  for (i=0;i< document.form1.condicion.options.length;i++)
        {
		
         	if (document.form1.condicion.options[i].value==valor1)
			 {
				document.form1.condicion.options[i].selected=true;
			 }
        
        }
	
}

</script>
