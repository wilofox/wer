<?php session_start();
include('../conex_inicial.php');
include('../funciones/funciones.php');

$sucursal=$_REQUEST['sucursal'];
$fec1=$_REQUEST['fec1'];
list($nom_suc)=mysql_fetch_row(mysql_query("select des_suc from sucursal where cod_suc='".$sucursal."'"));
 
 
// echo "-->".$_REQUEST['importe2'];
 
if(isset($_REQUEST["importe2"])){

 $temp=explode("-",$_REQUEST['banco']);
 
 $banco=$temp[0];
 $sucursal=$_REQUEST['sucursal'];
 $numero=$_REQUEST['numero'];
 $cliente2=$_REQUEST['cliente2'];
 $fechaVenc=extraefecha($_REQUEST['fechaVenc']);
 $tcambioProg=$_REQUEST['tcambioProg'];
 $importe=$_REQUEST['importe3'];
 $observaciones=$_REQUEST['observaciones'];
 $tipopago=$_REQUEST['tipopago']; 
 $monedaCuenta=$_REQUEST['monedaCuenta'];
 $fecha2=$_REQUEST["fecha2"];
 $fecha_audita=date('Y-m-d H:i:s');
 
 /*$cod_cab=$_REQUEST["cod_cab"];
 $acuenta=$_REQUEST["acuenta"];
 
 $serie=$_REQUEST["serie"];
 $numeroDoc=$_REQUEST["numeroDoc"];
 $mon_doc=$_REQUEST["mon_doc"];
 $cod_ope=$_REQUEST["cod_ope"];
 $deuda=$_REQUEST["deuda"];*/
 
 //print_r($cod_cab);
 
 if($importe>0.00){ 
	$strSQL_pagos="select max(id) as id from progpagos";
	$resultado_pagos=mysql_query($strSQL_pagos,$cn);
	$row_pagos=mysql_fetch_array($resultado_pagos);
	$id_pagos=$row_pagos['id']+1;
	$est="E";
	if($importe==0.01){
		$est="A";
	}
 
	$strSQL="insert into progpagos(id,cuenta,sucursal,numero,proveedor,fechavenc,tc,importe,observaciones,estado,tipo,fecha2,fecha_audita)values('".$id_pagos."','".$banco."','".$sucursal."','".$numero."','".$cliente2."','".$fechaVenc."','".$tcambioProg."','".$importe."','".$observaciones."','".$est."','".$tipopago."','".$fecha2."','".$fecha_audita."')"; 

	mysql_query($strSQL,$cn); 
 
// foreach ($cod_cab as $subkey=> $subvalue) {
	foreach ($_SESSION['prog_pagos'][0] as $subkey=> $subvalue) {
// print_r($_SESSION['prog_pagos'][9]);
//	 if($acuenta[$subkey]!=0 && $acuenta[$subkey]!=''){
		if($_SESSION['prog_pagos'][9][$subkey]!=0.00 && $_SESSION['prog_pagos'][9][$subkey]!=''){
//	  $strSQL="insert into progpagos_det(id_progpagos,cod_cab,cod_ope,serie,numero,mon_doc,deuda,mon_ac,acuenta,saldo)values('".$id_pagos."','".$cod_cab[$subkey]."','".$cod_ope[$subkey]."','".$serie[$subkey]."','".$numeroDoc[$subkey]."','".$mon_doc[$subkey]."','".$deuda[$subkey]."','".$monedaCuenta."','".$acuenta[$subkey]."','".$saldo[$subkey]."')";
			$codigoxd=$_SESSION['prog_pagos'][2][$subkey];
			$sqlope=mysql_query("select * from t_pago where codigo='".$codigoxd."' and modalidad=4",$cn);
			if(mysql_num_rows($sqlope)==0){
				$campo="cod_cab";
				$campo2="numero";
			}else{
				$campo="cod_let";
				$campo2="num_let";
			}
			$strSQL="insert into progpagos_det(id_progpagos, ".$campo.", cod_ope, serie, ".$campo2.", mon_doc, deuda, mon_ac, acuenta, saldo) values('".$id_pagos."','".$_SESSION['prog_pagos'][0][$subkey]."','".$_SESSION['prog_pagos'][2][$subkey]."','".$_SESSION['prog_pagos'][3][$subkey]."','".$_SESSION['prog_pagos'][4][$subkey]."','".$_SESSION['prog_pagos'][6][$subkey]."','".$_SESSION['prog_pagos'][7][$subkey]."','".$monedaCuenta."','".$_SESSION['prog_pagos'][9][$subkey]."','".$_SESSION['prog_pagos'][10][$subkey]."')";
	  
	//echo $strSQL."<br>";
	 
			mysql_query($strSQL,$cn);
		}
	  
	}
	$sqlfin=mysql_query("select * from progpagos_det where id_progpagos='".$id_pagos."'",$cn);
	if(mysql_num_rows($sqlfin)==0){
		mysql_query("delete from progpagos where id='".$id_pagos."'",$cn);
		echo "<script>alert('Verifique su conexion de red... Cheque no generado...');</script>";
	}
 	echo "<script>window.close();</script>";
 }else{
	echo "<script>alert('Favor de generar nuevamente...');window.close();</script>";
 } 
}
 
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Insertar programaci&oacute;n</title>
<style type="text/css">
<!--
.Estilo1 {
	font-size: 12px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
	color: #0066CC;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo12 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.Estilo18 {font-size: 11px; font-weight: bold; color: #0066CC; font-family: Arial, Helvetica, sans-serif;}
.Estilo22 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #FFFFFF; }
.EstiloDetPagos {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
-->
</style>
</head>

    <script src="../jquery-1.2.6.js"></script>
    <script src="../jquery.hotkeys.js"></script>
	
	
<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>

<script language="javascript" src="../miAJAXlib2.js"></script>

<body onLoad="VerificaVent();">
<form id="form1" name="form1" method="get" action="?" >
  <table width="596" height="571" border="0">
    <tr>
      <td height="23" colspan="3" bgcolor="#EAEAEA"><p><span class="Estilo1"> &nbsp;&nbsp;&nbsp;PROGRAMACI&Oacute;N DE PAGO </span></p></td>
    </tr>
    <tr>
      <td width="17" height="173">&nbsp;</td>
      <td width="562" valign="top"><table width="562" height="228" border="0">

        <tr>
          <td colspan="3"><fieldset>
            
            <table width="533" height="24" border="0">
              <tr>
                <td width="54"><span class="Estilo12">Sucursal: </span></td>
                <td width="355"><span class="Estilo12"><?php echo $nom_suc; ?></span></td>
                <td width="110"><span class="Estilo12">Fecha: <?php echo $fec1; ?> </span></td>
              </tr>
            </table>
          </fieldset> </td>
          </tr>
        <tr>
          <td width="93" height="26"><span class="Estilo12">Cta Banco: </span></td>
          <td colspan="2">
		    <span class="Estilo12">
		    <select name="banco" onChange="cambiar_cuenta(this)">
			<option value="0">Seleccionar </option>
		        <?php 
		  
		   $resultados11 = mysql_query("select * from cuentas, bancos where banco_id = id and empresa='".$sucursal."'",$cn); 
			while($rowSM=mysql_fetch_array($resultados11)){
			
			if($rowSM['moneda']=='01') $simMon="S/. " ;else $simMon="US$";
				
		  
		  ?>
		      
		      <option value="<?php echo $rowSM['cta_id']."-".$rowSM['moneda']; ?>"><?php echo $rowSM['cta_id']."&nbsp;&nbsp;&nbsp;".$rowSM['descrip']."&nbsp;&nbsp;&nbsp;".$rowSM['ctabco']."&nbsp;&nbsp;&nbsp;".$simMon; ?></option>
		      
		        <?php } ?>
	          </select>
		    </span> 
			
			<input name="tempauxprod"  type="hidden" value="auxiliares" size="15" />
            <input name="tipomov"  type="hidden" value="1" />
            <input name="sucursal"  type="hidden"  value="<?php echo $sucursal; ?>"/>			
            <input name="fec1"  type="hidden"  value="<?php echo $fec1; ?>"/>
            <input type="hidden" name="monedaCuenta">
            <input type="hidden" name="tipopago"></td>
          </tr>
        <tr>
          <td><span class="Estilo12">Tipo de Pago:</span></td>
          <td width="248"><div id="t_pago"><select name="tpago" onChange="cambiar_pago(this)"><option value="-">Seleccione Pago</option></select></div></td>
          <td width="207"><span class="Estilo12">Numero: </span>&nbsp;<input name="numero" type="text" onKeyUp="validarNumCheque(event,this)"></td>
          
        </tr>
        <tr>
          <td><span class="Estilo12">Proveedor</span></td>
          <td><input autocomplete="off" name="cliente" id="cliente" type="text" size="25" maxlength="50" onKeyUp="validartecla(event,this,'auxiliares')" disabled="disabled">
            <input name="cliente2" type="hidden" size="3"  value=""/></td>
          <td><span class="Estilo12">T.C.: </span>
            <input name="tcambioProg" type="text" size="10" value="<?php echo $tcambio ?>" style="text-align:right"></td>
        </tr>
        <tr>
          <td><span class="Estilo12">Fecha: Giro. </span></td>
          <td colspan="2"><input name="fechaVenc" type="text" size="10" value="<?php echo $fec1;?>" readonly="">
            <span class="Estilo12">Fecha: Venc. 
            <input name="fecha2" type="text" size="10" value="<?php echo $fec1;?>" >
            </span></td>
          </tr>
        <tr>
          <td><span class="Estilo12">Importe: </span></td>
          <td><span class="Estilo12">
            <input name="importe" type="text" id="importe" onBlur="javascript:temp=parseFloat(document.form1.importe.value);" onKeyUp="activar(event)" size="10">
            <input type="button" name="Submit" value="Cuentas Deudas" onClick="cuentasDeudas()" disabled="disabled">
            <input type="hidden" name="importe2" id="importe2" >
          </span></td>
          <td><span class="Estilo12">Utilizado:
            <input name="importe3" type="text" id="importe3" size="10" readonly>
          </span></td>
        </tr>
        <tr>
          <td><span class="Estilo12">Observaciones</span></td>
          <td colspan="2"><input name="observaciones" type="text" size="50"></td>
          </tr>
        
      </table></td>
      <td width="3">&nbsp;</td>
    </tr>
    <tr>
      <td height="119">&nbsp;</td>
      <td><fieldset><legend><span class="Estilo18">Cuentas Corrientes</span></legend><br>
          <table width="558" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="558">
			  <div style="height:250px; overflow-y:scroll" id="lista_cuentasDeudas" >
			  
			  
			  <table width="557" height="68" border="0" cellpadding="0" cellspacing="1">
                <tr>
                  <td width="30" height="23" bgcolor="#0099CC"><span class="Estilo22">Alm</span></td>
                  <td width="30" bgcolor="#0099CC"><span class="Estilo22">Td</span></td>
                  <td width="58" bgcolor="#0099CC"><span class="Estilo22">Numero</span></td>
                  <td width="79" bgcolor="#0099CC"><span class="Estilo22">Fecha Vcto </span></td>
                  <td width="33" bgcolor="#0099CC"><span class="Estilo22">Mon</span></td>
                  <td width="47" bgcolor="#0099CC"><span class="Estilo22">Deuda</span></td>
                  <td width="94" bgcolor="#0099CC"><span class="Estilo22">Programado</span></td>
                  <td width="65" bgcolor="#0099CC"><span class="Estilo22">En  (US$) </span></td>
                  <td width="62" bgcolor="#0099CC"><span class="Estilo22">Acuenta</span></td>
                  <td width="48" bgcolor="#0099CC"><span class="Estilo22">Saldo</span></td>
                  <td width="48" bgcolor="#0099CC"><span class="Estilo22">Acci&oacute;n</span></td>
                </tr>
                <?php 
			
			
			?>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
			  </div>			  </td>
            </tr>
          </table>
      </fieldset>
       </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td align="center"><input type="button" name="Submit2" value="Guardar Programaci&oacute;n" onClick="guardarProg()"></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>


<div id="auxiliares" style="position:absolute; left:82px; top:171px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>
  <div id="productos" style="position:absolute; left:22px; top:192px; width:300px; height:180px; z-index:1; visibility:hidden"> </div>

</body>
</html>

<script>

var temp_busqueda2="razonsocial";
function validartecla(e,valor,temp){

	var tipomov=document.form1.tipomov.value;
	document.form1.tempauxprod.value=temp;
	
		if(document.getElementById('auxiliares').style.visibility=='visible'){
		temp_busqueda2=document.formauxiliar.busqueda2.value;
	
		}
	
	var lentexto=document.form1.cliente.value.length;

	if(lentexto>=1){
	
	if ( ( (e.keyCode>=96) && (e.keyCode<=105) || (e.keyCode>=48) && (e.keyCode<=57) )  || ((e.keyCode>=65) && (e.keyCode<=90)) || e.keyCode==8 || e.keyCode==32 ) {
	

		
		
		if(document.getElementById(temp).style.visibility!='visible' ){
	
			doAjax('../lista_aux_3.php','&temp='+temp+'&tipomov='+tipomov+'&modulo=tranf&pagoprov','listaprod','get','0','1','','');
		
		}else{
			var valor="";
			var temp_criterio;
			if(document.form1.tempauxprod.value=='auxiliares'){
			valor=document.form1.cliente.value;
			temp_criterio=temp_busqueda2;
		
			}
	
			var temp=document.form1.tempauxprod.value;
			var tipomov=document.form1.tipomov.value;
	
			
			
		doAjax('../det_aux_3.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&criterio='+temp_criterio,'detalle_prod','get','0','1','','');
		
	//	doAjax('det_aux_3.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc='+document.formulario.prov_asoc.value+'&moneda_doc='+moneda_doc,'detalle_prod','get','0','1','','');
		 //alert('entro');
		}
		
		
	}
}else{
salir();
}
}

 
function listaprod(texto){

	var r = texto;
	var valor="";
	var temp_criterio='';
	
	if(document.form1.tempauxprod.value=='auxiliares'){
	document.getElementById('auxiliares').innerHTML=r;
	document.getElementById('auxiliares').style.visibility='visible';

	
	valor=document.form1.cliente.value; 
	  // alert(temp_busqueda2);
	temp_criterio=temp_busqueda2;
	selec_busq2();
	}
	
	
	var temp=document.form1.tempauxprod.value;
	var tipomov=document.form1.tipomov.value;
	var tienda;//=document.forms[0].almacen.value;
	var moneda_doc;//=document.forms[0].tmoneda.value;
	//document.formulario.prov_asoc.value
	//alert(temp_criterio);
	doAjax('../det_aux_3.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc=&moneda_doc='+moneda_doc,'detalle_prod','get','0','1','','');
				//doAjax('det_aux.php','&clasificacion=1&temp=auxiliares&tipomov='+document.formulario.tipomov.value+'&prov_asoc='+texto,'detalle_prod','get','0','1','','');
	
}		
	
function detalle_prod(texto){

	var r = texto;
	if(document.forms[0].tempauxprod.value=='auxiliares'){
	document.getElementById('detalle1').innerHTML=r;
	document.getElementById('tblproductos1').rows[0].style.background='#fff1bb';
	}
	if(document.forms[0].tempauxprod.value=='productos'){
	document.getElementById('detalle').innerHTML=r;
	document.getElementById('tblproductos').rows[0].style.background='#fff1bb';
	}

}

jQuery(document).bind('keyup', 'up',function (evt){jQuery('#_up').addClass('dirty');

	/*
	if(document.getElementById('auxiliares').style.visibility=='visible'){
	
		for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
		
			if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' || document.getElementById('tblproductos1').rows[i].style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' && (i!=0) ){
				document.getElementById('tblproductos1').rows[i].style.background=document.getElementById('tblproductos1').rows[i].bgColor;
				document.getElementById('tblproductos1').rows[i-1].style.background='#FFF1BB';
				location.href="#ancla"+(i-1);
				document.form1.cliente.focus();
				if(i%4==0 && i!=0){}
				break;
			}

		}
	
	}
**/
//alert();
if(document.getElementById('auxiliares').style.visibility=='visible'){
	
	for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
//	alert(document.getElementById('tblproductos').rows.length);
		if((document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' || document.getElementById('tblproductos1').rows[i].style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || document.getElementById('tblproductos1').rows[i].style.background=='rgb(255, 241, 187)') && (i!=0) ){
		document.getElementById('tblproductos1').rows[i].style.background=document.getElementById('tblproductos1').rows[i].bgColor;
		document.getElementById('tblproductos1').rows[i-1].style.background='#FFF1BB';
		
		//tempColor=document.getElementById('tblproductos1').rows[i-1];
			
			location.href="#ancla"+(i-1);
			document.form1.cliente.focus();
			
			if(i%4==0 && i!=0){
			//	capa_desplazar = $('detalle1');
		//	capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y - 60);
			}
			break;
		}
	  }
   }
      

	
	return false; 
});

 jQuery(document).bind('keyup', 'down',function (evt){jQuery('#_down').addClass('dirty');

	/*
	if(document.getElementById('auxiliares').style.visibility=='visible'){
 //alert('entro');
	for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
			
		//	alert(document.getElementById('tblproductos').rows.length);
			if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' || document.getElementById('tblproductos1').rows[i].style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' && (i!=document.getElementById('tblproductos1').rows.length-1)){
			//alert(document.getElementById('TablaDatos').rows[i].style.background);
			document.getElementById('tblproductos1').rows[i].style.background=document.getElementById('tblproductos1').rows[i].bgColor;
			document.getElementById('tblproductos1').rows[i+1].style.background='#FFF1BB';
			
			if(i%4==0 && i!=0){
			
			location.href="#ancla"+i;
			document.form1.cliente.focus();
			//capa_desplazar = $('detalle1');
			//capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y + 60);
			}
			
			break;
				
			}
		}
 	}
	*/
	if(document.getElementById('auxiliares').style.visibility=='visible'){
 //alert('entro');
	for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
			
		//	alert(document.getElementById('tblproductos').rows.length);
			if((document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' || document.getElementById('tblproductos1').rows[i].style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || document.getElementById('tblproductos1').rows[i].style.background=='rgb(255, 241, 187)') && (i!=document.getElementById('tblproductos1').rows.length-1)){
			//alert(document.getElementById('TablaDatos').rows[i].style.background);
			document.getElementById('tblproductos1').rows[i].style.background=document.getElementById('tblproductos1').rows[i].bgColor;
			document.getElementById('tblproductos1').rows[i+1].style.background='#FFF1BB';
			//tempColor=document.getElementById('tblproductos1').rows[i+1];
			
			if(i%4==0 && i!=0){
			
			location.href="#ancla"+i;
			document.form1.cliente.focus();
			//capa_desplazar = $('detalle1');
			//capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y + 60);
			}
			
			break;

				
			}
		}
 	}
	
 return false; });
 
 jQuery(document).bind('keydown', 'return',function (evt){jQuery('#_return').addClass('dirty'); 


/*
	   if(document.getElementById('auxiliares').style.visibility=='visible'){

		for (var i=0 ; i < document.getElementById('tblproductos1').rows.length ; i++) { 

		if( document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' || document.getElementById('tblproductos1').rows[i].style.background == 'none repeat scroll 0% 0% rgb(255, 241, 187)'){

		if(navigator.appName == 'Microsoft Internet Explorer'){
			var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
			var temp1=document.getElementById('tblproductos1').rows[i].cells[1].childNodes[0].innerHTML;
			var ruc=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[0].childNodes[0].childNodes[0].childNodes[0].innerHTML;
		}else{

			var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[1].childNodes[1].innerHTML
			var temp1=document.getElementById('tblproductos1').rows[i].cells[1].childNodes[0].innerHTML;
			var ruc=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[1].childNodes[1].childNodes[0].childNodes[1].childNodes[0].innerHTML;
		}
			 temp1=temp1.replace('&amp;','&');
			
			 elegir2(temp,temp1);
			 //}		  
			}
		 }
	   }
	   
	  */ 
	///-----------------------------------------------------------------------
//alert(document.getElementById('auxiliares').style.visibility);	
	if(document.getElementById('auxiliares').style.visibility=='visible'){

		for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
		
			if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb'  || document.getElementById('tblproductos1').rows[i].style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || document.getElementById('tblproductos1').rows[i].style.background=='rgb(255, 241, 187)' ){
			   if(navigator.appName!='Microsoft Internet Explorer'){
	    var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[1].childNodes[1].innerHTML;
		var temp1=document.getElementById('tblproductos1').rows[i].cells[1].childNodes[0].innerHTML;
		var ruc=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[1].childNodes[1].childNodes[0].childNodes[1].childNodes[0].innerHTML;
		        }else{								
		var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
		var temp1=document.getElementById('tblproductos1').rows[i].cells[1].childNodes[0].innerHTML;
		var ruc=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[0].childNodes[0].childNodes[0].childNodes[0].innerHTML;
				}
				
			 temp1=temp1.replace('&amp;','&');
			 //alert(temp+" "+temp1);
			 elegir2(temp,temp1);
			
			}
		 }
	   }
	
			
return false; });
function elegir2(cod,des){
//razon.replace('&','amps')
des=des.replace('amps','&');
document.form1.cliente.value=des;
document.form1.cliente2.value=cod;
document.getElementById('auxiliares').style.visibility='hidden';
document.form1.importe.focus();
}

jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_esc').addClass('dirty'); 

//document.formulario.codprod.focus();
//alert("escape");
salir();
		
return false; });

function salir(){

	if (document.getElementById('docincluir').style.visibility=='visible'){
	document.getElementById('docincluir').style.visibility='hidden';
	}else
	document.getElementById('auxiliares').style.visibility='hidden';
	
}

function selec_busq2(){
	
	 var valor1=temp_busqueda2;

 
     var i;

	for (i=0;i<document.formauxiliar.busqueda2.options.length;i++)

        {
			
            if (document.formauxiliar.busqueda2.options[i].value==valor1)
               {
			   document.formauxiliar.busqueda2.options[i].selected=true;
               }
        
        }
	
	}

function cuentasDeudas(){

  //  document.form1.importe.disabled=true;
	
	document.form1.importe2.value=document.form1.importe.value;
	if(document.form1.importe2.value=="A"){
		document.form1.importe3.value=0.01;
	}else{
	document.form1.importe3.value=0.00;
	}
	temp=document.form1.importe2.value;
	
	var sucursal=document.form1.sucursal.value;
	var fecha1=document.form1.fec1.value; //fecha1
	var proveedor=document.form1.cliente2.value;
	var monedaCuenta=document.form1.monedaCuenta.value;
	var tcambioProg=document.form1.tcambioProg.value;
	
	doAjax('../peticion_ajax5.php','&sucursal='+sucursal+"&fecha1="+fecha1+"&valor="+temp+"&peticion=cuentasDeudas&proveedor="+proveedor+"&monedaCuenta="+monedaCuenta+"&tcambioProg="+tcambioProg,'rspta_cuentasDeudas','get','0','1','','');

}

function rspta_cuentasDeudas(data){

//document.getElementById('lista_cuentasDeudas').style.visibility='hidden';
document.getElementById('lista_cuentasDeudas').innerHTML=data;

}

var temp=0;

function cancelar(obj,saldo,pos){
//alert(temp);
	if(temp>0){
		if( (temp-saldo) >= 0){
			if(document.form1.acuenta[pos]==undefined){
				document.form1.acuenta.value=parseFloat(saldo).toFixed(2);
				document.form1.saldo.value=0.00;
			}else{
				document.form1.acuenta[pos].value=parseFloat(saldo).toFixed(2);
				document.form1.saldo[pos].value=0.00;
			}
		temp=temp-parseFloat(saldo);
			obj.parentNode.parentNode.parentNode.style.background="#fff1bb";
			//alert();		
		}else{
			if(document.form1.acuenta[pos]==undefined){
				document.form1.acuenta.value=parseFloat(temp).toFixed(2);
				//alert(saldo+"-"+temp);
				document.form1.saldo.value=parseFloat(saldo)-parseFloat(temp);	
			}else{
				document.form1.acuenta[pos].value=parseFloat(temp).toFixed(2);
				//alert(saldo+"-"+temp);
				document.form1.saldo[pos].value=parseFloat(saldo)-parseFloat(temp);	
			}
		//alert('X');
		    obj.parentNode.parentNode.parentNode.style.background="#fff1bb";
		temp=0;
		}
		obj.parentNode.parentNode.parentNode.disabled=false;
		if(document.form1.acuenta[pos]==undefined){
			var monto1=document.form1.acuenta.value;
			var monto2=document.form1.saldo.value;
		}else{
			var monto1=document.form1.acuenta[pos].value;
			var monto2=document.form1.saldo[pos].value;
		}
//		alert(pos+"-"+monto1+"-"+monto2);
		doAjax('../peticion_ajax5.php','&it='+pos+'&monto='+monto1+'&peticion=ModificaCuentasDeudas&monto1='+monto2,'rspta_cancelar','get','0','1','','');
		
	}else{
	alert("No tiene saldo para cancelar");
	}
	
	document.form1.importe3.value=(parseFloat(document.form1.importe.value)-temp).toFixed(2);

}

function descancelar(obj,saldo,pos){
		
		if(document.form1.acuenta[pos]==undefined){
			var acuenta=document.form1.acuenta;
			var saldo=document.form1.saldo;
		}else{
			var acuenta=document.form1.acuenta[pos];
			var saldo=document.form1.saldo[pos];
		}
				
		if(parseFloat(acuenta.value)>0){
		temp=temp+parseFloat(acuenta.value);
		acuenta.value=0.00;
		saldo.value=0.00;
		obj.parentNode.parentNode.parentNode.style.background="";	
		}
		document.form1.importe3.value=(parseFloat(document.form1.importe.value)-temp).toFixed(2);
		
		obj.parentNode.parentNode.parentNode.disabled=true;
		
		var monto1=acuenta.value;
		var monto2=saldo.value;
//		alert(pos+"-"+monto1+"-"+monto2);
		doAjax('../peticion_ajax5.php','&it='+pos+'&monto='+monto1+'&peticion=ModificaCuentasDeudas&monto1='+monto2,'rspta_cancelar','get','0','1','','');
}

function rspta_cancelar(texto){
	//alert(texto);
}

function activar(e){
	if(e.keyCode==13 && document.form1.importe.value!=''){
	document.form1.Submit.disabled=false;	
	}
}

function cambiar_cuenta(control){

	if(this.value!=0){
	
	var temp=document.form1.banco.value.split("-");
	document.form1.monedaCuenta.value=temp[1];
	}	
	
	var sucursal=document.form1.sucursal.value;
	var fecha1=document.form1.fec1.value; //fecha1
	var proveedor=document.form1.cliente2.value;
	var monedaCuenta=document.form1.monedaCuenta.value;
	var tcambioProg=document.form1.tcambioProg.value;
	//alert();
	doAjax('../peticion_ajax5.php','&sucursal='+sucursal+"&fecha1="+fecha1+"&peticion=tipoCheque&proveedor="+proveedor+"&cta_banco="+temp[0],'rspta_tipoCheque','get','0','1','','');
	
	
}

function rspta_tipoCheque(data){
	//alert(data);
	document.getElementById('t_pago').innerHTML=data;
}

function cambiar_pago(control){

	if(this.value!=0){
	
	var temp=document.form1.banco.value.split("-");
	document.form1.monedaCuenta.value=temp[1];
	}	
	document.form1.numero.value="";
	var sucursal=document.form1.sucursal.value;
	var fecha1=document.form1.fec1.value; //fecha1
	var proveedor=document.form1.cliente2.value;
	var monedaCuenta=document.form1.monedaCuenta.value;
	var tcambioProg=document.form1.tcambioProg.value;
	document.form1.tipopago.value=control.value;
	document.form1.tpago.focus();
	//alert();
	doAjax('../peticion_ajax5.php','&sucursal='+sucursal+"&fecha1="+fecha1+"&peticion=numeroCheque&proveedor="+proveedor+"&tipo="+control.value+"&cta_banco="+temp[0],'rspta_numeroCheque','get','0','1','','');
	
	
}

function rspta_numeroCheque(data){
	//alert(data);
	if(data!=""){
	var temp=data.split("|");
	document.form1.numero.value=temp[0];
	document.form1.tipopago.value=temp[1];
	document.form1.numero.focus();
	document.form1.numero.select();
	
	//alert();
	}else{
	alert("Esta cuenta no tiene chequera asociada");
	document.form1.numero.value="";
	document.form1.banco.focus();	
	}
}

function validarNumCheque(e,obj){

	if(e.keyCode==13 && document.form1.numero.value!=''){	
	
	var temp=document.form1.banco.value.split("-");
	document.form1.monedaCuenta.value=temp[1];

	
	var sucursal=document.form1.sucursal.value;
	var fecha1=document.form1.fec1.value; //fecha1
	var proveedor=document.form1.cliente2.value;
	var monedaCuenta=document.form1.monedaCuenta.value;
	var tcambioProg=document.form1.tcambioProg.value;
	obj.value=ponerCeros(obj.value,11);
	
	doAjax('../peticion_ajax5.php','&sucursal='+sucursal+"&fecha1="+fecha1+"&peticion=validarNumCheque&proveedor="+proveedor+"&cta_banco="+temp[0]+'&numero='+obj.value,'rspta_validarNumCheque','get','0','1','','');
	
	}	
}

function rspta_validarNumCheque(data){
	//alert(data);
	if(data=='S'){
		document.form1.cliente.disabled=false;
		document.form1.cliente.focus();
		
	}else{
		alert("Numero incorrecto");
		document.form1.numero.focus();
		document.form1.numero.select();
	}
	
	

}

 function ponerCeros(obj,i) {
		//alert(obj.length);
		  while (obj.length<i){
			obj = '0'+obj;
			
			}
		//	alert(obj);
			return obj;
}


function guardarProg(){
	var banco=document.form1.banco.value;
	var sucursal=document.form1.sucursal.value;
	var numero=document.form1.numero.value;
	var cliente2=document.form1.cliente2.value;
	var fechaVenc=document.form1.fechaVenc.value;
	var tcambioProg=document.form1.tcambioProg.value;
	var importe3=document.form1.importe3.value;
	var observaciones=document.form1.observaciones.value;
	var tipopago=document.form1.tipopago.value;
	var monedaCuenta=document.form1.monedaCuenta.value;
	var fecha2=document.form1.fecha2.value;
	var fecha1=document.form1.fec1.value;
	//document.form1.submit();
	location.href='nuevopago.php?banco='+banco+'&sucursal='+sucursal+'&numero='+numero+'&cliente2='+cliente2+'&fechaVenc='+fechaVenc+'&tcambioProg='+tcambioProg+'&importe3='+importe3+'&observaciones='+observaciones+'&tipopago='+tipopago+'&monedaCuenta='+monedaCuenta+'&fecha2='+fecha2+'&fec1='+fecha1+'&importe2';
}

function VerificaVent(){
	if(window.opener==undefined){
		try{
			if(window.close()==undefined){
				location.href='../index.php';
			}
		}catch(e){
		}
	}
}
</script>
