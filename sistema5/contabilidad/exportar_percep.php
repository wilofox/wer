<?php
session_start();
include('../conex_inicial.php');
include('../funciones/funciones.php');
//echo $_REQUEST['temporal'];


//echo substr($filtroDoc,count($filtroDoc));

function extraefecha_tc($valor){
	$afecha=explode('-',trim($valor));
	$afecha2=explode(' ',trim($afecha[2]));
	$nfecha=$afecha2[0]."/".$afecha[1]."/".$afecha[0];
	return $nfecha;
}

function UltimoDia($anho,$mes){ 
//echo $anho."-".$mes;
   if (((fmod($anho,4)==0) and (fmod($anho,100)!=0)) or (fmod($anho,400)==0)) { 
       $dias_febrero = 29; 
   } else { 
       $dias_febrero = 28; 
   } 
   //echo "$mes";
   switch($mes) { 
       case 01: return 31; break; 
       case 02: return $dias_febrero; break; 
       case 03: return 31; break; 
       case 04: return 30; break; 
       case 05: return 31; break; 
       case 06: return 30; break; 
       case 07: return 31; break; 
	   case '08': return 31; break; 
       case '09': return 30; break; 
       case 10: return 31; break; 
       case 11: return 30; break; 
       case 12: return 31; break; 
   } 

}

function quitarTilde($valor){

   $search = array('á','é','í','ó','ú','Á','É','Í','Ó','Ú');
   $replace = array('a','e','i','o','u','A','E','I','O','U');
   
   $tempcaract=str_replace($search,$replace,$valor);
  	
  return $tempcaract;

}
 
//echo $_REQUEST['submit']; 
if($_REQUEST['submit']=='Generar Archivo'){
$mes=$_REQUEST['mes'];
$anio=$_REQUEST['anio'];
$idsucursal=$_REQUEST['sucursal'];

list($ruc_empresa)=mysql_fetch_row(mysql_query("select ruc from sucursal where cod_suc='".$idsucursal."'"));


	$fecha=$mes.$anio;
	$fecha2=$mes.$anio;
	$documentos=" 'B0','F0' ";	
	$periodo_formato=$anio.$mes;
	
	$strSQL="select substring(fecha,1,10) as fecha,cod_cab,cod_ope,serie,Num_doc,flag,ruc,cliente,tc,b_imp,servicio,igv,total,moneda,percepcion from cab_mov where substring(fecha,6,2)='$mes' and substring(fecha,1,4)='$anio' and Num_doc!='' and serie!='' and sucursal='".$idsucursal."' and cod_ope in($documentos) and tipo='2' and flag!='A' and percepcion > 0 order by fecha";
	
$nombreFile="0697".$ruc_empresa.$periodo_formato."VC.txt";

$filename = "temp/".$nombreFile;
$archivo = fopen($filename, "a");
fclose($archivo);
$archivo = fopen($filename, "w");

$resultado=mysql_query($strSQL,$cn);
while($row=mysql_fetch_array($resultado)){
if($row['cod_ope']=='F0'){
$tipoDocCliente='06';
$num14='01';
}
if($row['cod_ope']=='B0'){
$tipoDocCliente='01';
$num14='03';
}

 list($razonsocial,$ruc,$doc_iden,$t_persona,$estado_percep,$por_percep)=mysql_fetch_row(mysql_query("select razonsocial,ruc,doc_iden,t_persona,estado_percep,por_percep from cliente where codcliente='".$row['cliente']."'"));

 $importe_prod=0;

if($t_persona=='natural'){
$ruc=$doc_iden;
}

 $strSQL2="select * from det_mov where cod_cab='".$row['cod_cab']."'";
 $resultado2=mysql_query($strSQL2,$cn);
 while($row2=mysql_fetch_array($resultado2)){
  
  $percep_prod=$row2['flag_percep'];
  
	//list($percep_prod)=mysql_fetch_row(mysql_query("select agente_percep from producto where idproducto='".$row2['cod_prod']."'"));
	
	if($percep_prod=='S'){	
	$importe_prod=$importe_prod + number_format($row2['imp_item'],2,'.','');
	}
	
	
 }

$apePat="";
$apeMat="";
$nombres="";
$serie_doc=str_pad($row['serie'],4, "0", STR_PAD_LEFT);
$numero_doc=str_pad($row['Num_doc'],8, "0", STR_PAD_LEFT);
$fecha_doc=extraefecha2($row['fecha']);

$num10='1';
$num11='0';
$num12=$estado_percep;
$num13=$row['percepcion']+$importe_prod;

		$strSQLTC="select * from tcambio where fecha='".extraefecha_tc($row['fecha'])."'"; 
		$resultadoTC=mysql_query($strSQLTC,$cn);
		$rowTC=mysql_fetch_array($resultadoTC);
	
$tc=str_pad(number_format($rowTC['compra'],3),11, "0", STR_PAD_LEFT);

if($row['moneda']=='02'){
$num13=$num13*$tc;
}

$num13=number_format($num13,2,'.','');

if(substr($ruc,0,2)=='10'){
$temp=explode(" ",$razonsocial);
$apePat=$temp[0];
$apeMat=$temp[1];
$nombres=$temp[2].$temp[3].$temp[4].$temp[5];
$razonsocial="";
}




if($tipoDocCliente=='01'){
$tempRazon=explode(" ",$razonsocial);
//$razonsocial=$tempRazon[0]."|".$tempRazon[1]."|".$tempRazon[2];	
	
$razonsocial="";
$apePat=$tempRazon[0];
$apeMat=$tempRazon[1];
$nombres=$tempRazon[2];

$num10=0;
}

$conta.=$tipoDocCliente."|".$ruc."|".substr(quitarTilde($razonsocial),0,40)."|".quitarTilde($apePat)."|".quitarTilde($apeMat)."|".substr(quitarTilde($nombres),0,20)."|".$serie_doc."|".$numero_doc."|".$fecha_doc."|".$num10."|".$num11."|".$num12."|".$num13."|".$num14."|".chr(13).chr(10);

}
//echo $conta;
$grabar = fwrite($archivo, $conta);
fclose($archivo);

echo "<script>window.open('../descargarFiles.php?ruta=contabilidad/temp/$nombreFile');</script>";

/*echo "<script>alert('Se creo correctamente el archivo en la siguiente ruta $filename')</script>";
*/

//---------------------------------- Guardar DATOS ---------------------------------------------------
}

?> 


<title>Transferencia a Contabilidad</title>
<style type="text/css">
<!--
.Estilo10 {font-size: 12px; font-family: Arial, Helvetica, sans-serif;}
.Estilo12 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #003366; }
.borderBajo{
border-bottom:#E5E5E5 solid 1px
}
.Estilo24 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>

</head>

<script>

var temp_tabla1=new Array();
var temp_tabla2=new Array();

function validar(form){
	

	
	if(document.form1.cc1.value=='' || document.form1.cc3.value==''){
	alert("los campos de centro de costo no pueden estar vacios");
	return false;
	}
	
	if(document.getElementById('docincluir').innerHTML==""){
	alert('Seleccionar documentos por favor...');
	return false;
	}
	
	if(form.mes.disabled && form.fecha.disabled){
	alert('Debe seleccionar un periodo');
	return false;
	}
	//alert(document.form1.cuentabi.value.length);
	//alert(document.form1.cuentatotS[0].value.length);
	
	
	if(document.form1.tipo.value==2){
		if(document.form1.cuentabi[0].value=="" || document.form1.cuentabi[0].value.length < 2 || document.form1.cuentaimp[0].value=="" || document.form1.cuentaimp[0].value.length < 2 || document.form1.cuentades.value=="" || document.form1.cuentades.value.length < 2 || document.form1.cuentatotS[0].value=="" || document.form1.cuentatotS[0].value.length < 2 || document.form1.cuentatotD[0].value=="" || document.form1.cuentatotD[0].value.length < 2){
		alert("las cuentas cuentables no deben tener menos de 4 d\u00edgitos");
		return false;
		}
		
		
		if(document.form1.cuentabi[0].value.length==4 || document.form1.cuentabi[0].value.length==6 || document.form1.cuentabi[0].value.length==8 || document.form1.cuentabi[0].value.length==10 || document.form1.cuentabi[0].value.length==12 || document.form1.cuentabi[0].value.length >13 ||  document.form1.cuentaimp[0].value.length==4 || document.form1.cuentaimp[0].value.length==6 || document.form1.cuentaimp[0].value.length==8 || document.form1.cuentaimp[0].value.length==10 || document.form1.cuentaimp[0].value.length==12 || document.form1.cuentaimp[0].value.length >13  ||  document.form1.cuentades.value.length==4 || document.form1.cuentades.value.length==6 || document.form1.cuentades.value.length==8 || document.form1.cuentades.value.length==10 || document.form1.cuentades.value.length==12 || document.form1.cuentades.value.length >13   ||  document.form1.cuentatotS[0].value.length==4 || document.form1.cuentatotS[0].value.length==6 || document.form1.cuentatotS[0].value.length==8 || document.form1.cuentatotS[0].value.length==10 || document.form1.cuentatotS[0].value.length==12 || document.form1.cuentatotS[0].value.length >13   ||  document.form1.cuentatotD[0].value.length==4 || document.form1.cuentatotD[0].value.length==6 || document.form1.cuentatotD[0].value.length==8 || document.form1.cuentatotD[0].value.length==10 || document.form1.cuentatotD[0].value.length==12 || document.form1.cuentatotD[0].value.length >13  ){
		alert("Una de las cuentas ingresadas no es v\u00e1lida");
		return false;
		}
		
	}else{
	
		if(document.form1.cuentabi[1].value=="" || document.form1.cuentabi[1].value.length < 2 || document.form1.cuentaimp[1].value=="" || document.form1.cuentaimp[1].value.length < 2 || document.form1.cuentatotS[1].value=="" || document.form1.cuentatotS[1].value.length < 2 || document.form1.cuentatotD[1].value=="" || document.form1.cuentatotD[1].value.length < 2){
		alert("las cuentas cuentables no deben tener menos de 4 d\u00edgitos");
		return false;
		}
		
		
		if(document.form1.cuentabi[1].value.length==4 || document.form1.cuentabi[1].value.length==6 || document.form1.cuentabi[1].value.length==8 || document.form1.cuentabi[1].value.length==10 || document.form1.cuentabi[1].value.length==12 || document.form1.cuentabi[1].value.length >13 ||  document.form1.cuentaimp[1].value.length==4 || document.form1.cuentaimp[1].value.length==6 || document.form1.cuentaimp[1].value.length==8 || document.form1.cuentaimp[1].value.length==10 || document.form1.cuentaimp[1].value.length==12 || document.form1.cuentaimp[1].value.length >13  ||  document.form1.cuentatotS[1].value.length==4 || document.form1.cuentatotS[1].value.length==6 || document.form1.cuentatotS[1].value.length==8 || document.form1.cuentatotS[1].value.length==10 || document.form1.cuentatotS[1].value.length==12 || document.form1.cuentatotS[1].value.length >13   ||  document.form1.cuentatotD[1].value.length==4 || document.form1.cuentatotD[1].value.length==6 || document.form1.cuentatotD[1].value.length==8 || document.form1.cuentatotD[1].value.length==10 || document.form1.cuentatotD[1].value.length==12 || document.form1.cuentatotD[1].value.length >13  ){
		alert("Una de las cuentas ingresadas no es v\u00e1lida");
		return false;
		}
		
	}
	
	
	temp1=0;
	for(var i=0;i<document.form1.Ingresos.length;i++){	
		if(document.form1.Ingresos[i].checked){
		temp1=1;
		}		
	}
	if(temp1==0){
	alert('Seleccionar documentos por favor...');
	return false;
	}

	
return true;
	
}
function soloNumeros(evt) {     //Validar la existencia del objeto event    
 evt = (evt) ? evt : event;       //Extraer el codigo del caracter de uno de los diferentes grupos de codigos   
   var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));       //Predefinir como valido   
     var respuesta = true;       //Validar si el codigo corresponde a los NO aceptables  
	    if (charCode > 31 && (charCode < 48 || charCode > 57))     {         //Asignar FALSE a la respuesta si es de los NO aceptables    
		  respuesta = false;
		}       //Regresar la respuesta    
 return respuesta; 
}
	
	
	
</script>


<link href="styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
background-color:#F7F7F7;   
}
.Estilo100 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
.Estilo102 {color: #333333}
.Estilo104 {font-family: Arial, Helvetica, sans-serif}
.Estilo106 {font-size: 11px}
.Estilo107 {color: #0066FF}
.Estilo38 {	color: #003366;
	font-weight: bold;
}
.Estilo110 {color: #FF3300}
.Estilo111 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #333333;
	font-weight: bold;
	font-size: 10px;
}
.Estilo113 {font-size: 10px}
-->
</style>

<script language="javascript" src="../miAJAXlib2.js"></script>

<body onLoad="">
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" >
  <table width="780" border="0" cellpadding="0" cellspacing="0">
    <tr style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="780" height="22"><span class="Estilo100"><span style="border:#999999"><span class="Estilo110"></span> <span class="Estilo14 Estilo38">Gerencia :: Contabilidad :: Exportar Percepciones - SUNAT </span></span>
          <input type="hidden" name="carga" id="carga" value="S">
          <input type="hidden" name="temporal" />
      </span></td>
    </tr>
    <tr>
      <td><table width="775" height="289" border="0"  cellpadding="0" cellspacing="0">
        
        <tr>
          <td width="5" height="49">&nbsp;</td>
          <td rowspan="3"><br><fieldset>
            <table width="349" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="118" height="32"><span class="Estilo111">Empresa :</span></td>
                <td width="231">
				
				<script>
				function sel_tienda(control){
				//alert(control.value);
					for(var i=0;i<temp_tabla1.length;i++){
					//alert(temp_tabla1[i]);
						if(control.value.substring(0,1)==temp_tabla1[i]){
						document.getElementById("labelEmp").innerHTML=temp_tabla2[i];
						document.getElementById("cc2").value=temp_tabla1[i];
						document.getElementById("cc4").value=control.value.substring(1,3);
						
						}
					}
				
				}
				
				</script>
				<span class="Estilo24">
				<select style="width:160"  name="sucursal" onChange="doAjax('carga_cbo_tienda.php','&kardex=s&codsuc='+document.form1.sucursal.value,'cargar_cbo','get','0','1','','')" >
                  <option value="0">Todos</option>
                  <?php 
		
		 $resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn);
		 
		  
		while($row1=mysql_fetch_array($resultados1))
		{
		?>
                  <option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
                  <?php }?>
                  <script>
			 var valor1="<?php echo $_REQUEST['sucursal']?>";			
			 var i;
	 for (i=0;i<document.form1.sucursal.options.length;i++)
        {
		
            if (document.form1.sucursal.options[i].value==valor1)
               {
			   
               document.form1.sucursal.options[i].selected=true;
               }
        
        }
			      </script>
                </select>
				</span></td>
              </tr>
              <tr>
                <td height="29"><span class="Estilo111">Periodo: </span></td>
                <td height="29"><select  name="mes" >
                  <option value="01">Enero </option>
                  <option value="02">Febrero </option>
                  <option value="03">Marzo </option>
                  <option value="04">Abril </option>
                  <option value="05">Mayo </option>
                  <option value="06">Junio </option>
                  <option value="07">Julio </option>
                  <option value="08">Agosto </option>
                  <option value="09">Septiembre </option>
                  <option value="10">Octubre </option>
                  <option value="11">Noviembre </option>
                  <option value="12">Diciembre </option>
                  <script>
			 var valor1="<?php echo $mes?>";
     var i;
	 for (i=0;i<document.form1.mes.options.length;i++)
        {
		
            if (document.form1.mes.options[i].value==valor1)
               {
			   
               document.form1.mes.options[i].selected=true;
               }
        
        }
			
			    </script>
                </select>
                  <select name="anio" >
                    <option value="2009">2009</option>
                    <option value="2010" selected>2010</option>
                    <option value="2011">2011</option>
                    <option value="2012">2012</option>
                    <option value="2013">2013</option>
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <script>
			 var valor1="<?php echo $anio?>";
     var i;
	 for (i=0;i<document.form1.anio.options.length;i++)
        {
		
            if (document.form1.anio.options[i].value==valor1)
               {
			   
               document.form1.anio.options[i].selected=true;
               }
        
        }
			
			      </script>
                  </select></td>
              </tr>
              
              <tr>
                <td height="69" colspan="2" align="center"><!--<input name="submit" type="submit" value="Generar Archivo" disabled="disabled"/>-->
                  <input name="submit" type="submit" value="Generar Archivo"  /></td></tr>
            </table>
          </fieldset></td>
          </tr>
        <tr>
          <td height="43">&nbsp;</td>
          </tr>
        
        <tr>
          <td height="19">&nbsp;</td>
          </tr>
        
        <tr>
          <td height="19">&nbsp;</td>
          <td height="19" class="Estilo111">Archivos</td>
        </tr>
        <tr>
          <td height="19">&nbsp;</td>
          <td>
		  <div id="listaDatos" style=" overflow-y:scroll; height:130px;">		  </div>		  </td>
          </tr>
		  
		    <tr>
          <td height="19">&nbsp;</td>
          <td>
		  <div id="paginacion">		  </div>		  </td>
          </tr>
            
      </table></td>
    </tr>
  </table>
  
   <div id="docincluir" style="position:absolute; left:470px; top:113px; width:302px; height:180px; z-index:2; visibility:hidden"> </div>  
  
</form>
</body>
</html>

<script>
function cambiar(valor){
document.form1.temporal.value=valor;
}

function activar(temp){

	if(temp.checked){
		if(temp.value=="M"){
		document.form1.mes.disabled=false;
		document.form1.anio.disabled=false;
		document.form1.fecha.disabled=true;
		document.form1.f_trigger_b2.disabled=true;
		}
		
		if(temp.value=="D"){
		document.form1.fecha.disabled=false;
		document.form1.f_trigger_b2.disabled=false;
		document.form1.mes.disabled=true;
		document.form1.anio.disabled=true;
		
		}
	
	}


}
function validartecla2(e,valor,temp){
	//if(document.getElementById(temp).style.visibility!='visible' ){
		//temp_busqueda2=document.form1.busqueda2.value;
		//alert(temp_busqueda2);
	document.form1.carga.value="S";
	var tipo=document.form1.tipo.value;
	if(tipo==1){
	var rep="TRANSF_CONTA_COMPRAS";
	}else{
	var rep="TRANSF_CONTA_VENTAS";
	}
doAjax('reportes/documentos.php','&temp='+temp+'&tipo='+tipo+"&reporte="+rep,'listadocumentos','get','0','1','','');
	//}
}
function listadocumentos(texto){
	var r = texto;
	document.getElementById('docincluir').innerHTML=r;
	//document.getElementById('docincluir').rows[0].style.background='#fff1bb';
	document.getElementById('docincluir').style.visibility='visible';
	ocultarCbos();
}

function listadocumentos2(texto){
	var r = texto;
	document.getElementById('docincluir').innerHTML=r;

}

function ocultarCbos(){	
	for(var i=0;i<document.form1.elements.length;i++){
	//alert(document.formulario.elements[i].type);
	 	if(document.form1.elements[i].type=="select-one"){
		 document.form1.elements[i].style.visibility="hidden";
		}
	}
}
function mostrarCbos(){	
	for(var i=0;i<document.form1.elements.length;i++){
	//alert(document.formulario.elements[i].type);
	 	if(document.form1.elements[i].type=="select-one"){
		 document.form1.elements[i].style.visibility="visible";
		}
	}
}
function salir(){

	document.getElementById('docincluir').style.visibility='hidden';
	mostrarCbos();
	
}
function Guarda(){
	var temp1=0;
	var docRk ='';
	//alert();
	for(var i=0;i<document.form1.Ingresos.length;i++){	
		if(document.form1.Ingresos[i].checked){
		docRk+=document.form1.Ingresos[i].value+',';
		temp1=1;
		}		
	}
//alert(docRk);
			
	if(temp1==0){
	alert('Seleccione Documento');
	return false
	}
	var tipo=document.form1.tipo.value;
	if(tipo==1){
	var rep="TRANSF_CONTA_COMPRAS";
	}else{
	var rep="TRANSF_CONTA_VENTAS";
	}
    //if(confirm("Seguro de Aceptar configuración")){
	//alert(docRk+" "+rep);
			//document.form1.carga.value="S";
			doAjax('reportes/documentos.php','&docRk='+docRk+"&reporte="+rep,'','get','0','1','','');
			document.getElementById('docincluir').style.visibility='hidden';
			mostrarCbos();
	//}
}

function marcar(){
	
	if(document.form1.GrupoOpciones1[0].checked){
		for(var i=0;i<document.form1.Ingresos.length;i++){
		document.form1.Ingresos[i].checked=true;
		}	
	}else{
			for(var i=0;i<document.form1.Ingresos.length;i++){
			document.form1.Ingresos[i].checked=false;
			}		
	}
}

function cargar_lista(pag){
	doAjax('peticion_ajax2.php','&peticion=lista_transfConta&pag='+pag,'mostrarLista','get','0','1','','');
	
}
function cargar_datos(pag){
cargar_lista(pag);

}


function mostrarLista(texto){
//alert(texto);
var temp=texto.split("|");
document.getElementById('listaDatos').innerHTML=temp[0];
document.getElementById('paginacion').innerHTML=temp[1];

document.form1.carga.value="S";
	var tipo=document.form1.tipo.value;
	if(tipo==1){
	var rep="TRANSF_CONTA_COMPRAS";
	}else{
	var rep="TRANSF_CONTA_VENTAS";
	}
	
doAjax('reportes/documentos.php','&temp=docincluir&tipo='+tipo+"&reporte="+rep,'listadocumentos2','get','0','1','','');

}

function cambiarCuentas(control){
	if(control.value=='1'){
	document.getElementById('cuentasCompras').style.display="block";
	document.getElementById('cuentasVentas').style.display="none";
	
	seleccionar_cbo(document.form1.destinobi[1],"D");
	seleccionar_cbo(document.form1.destinoimp[1],"D");
	//seleccionar_cbo("destinodes","H");
	seleccionar_cbo(document.form1.destinotot[1],"H");
	
	}else{
	document.getElementById('cuentasVentas').style.display="block";
	document.getElementById('cuentasCompras').style.display="none";
	
	seleccionar_cbo(document.form1.destinobi[0],"H");
	seleccionar_cbo(document.form1.destinoimp[0],"H");
	seleccionar_cbo(document.form1.destinodes,"H");
	seleccionar_cbo(document.form1.destinotot[0],"D");
	
	}
	var tipo=document.form1.tipo.value;
	if(tipo==1){
	var rep="TRANSF_CONTA_COMPRAS";
	}else{
	var rep="TRANSF_CONTA_VENTAS";
	}
	//alert();
doAjax('reportes/documentos.php','&temp=docincluir&tipo='+tipo+"&reporte="+rep,'listadocumentos2','get','0','1','','');

}

function seleccionar_cbo(control,valor){
		
		 var valor1=valor;
         var i;
		// alert(valor1+" "+control);
	     for (i=0;i< control.options.length;i++)
        {
		//alert(eval("document.formulario."+control+".options[i].value")+" "+valor1);
         if (control.options[i].value==valor1 )
            {
		//	alert("entro");
			   control.options[i].selected=true;
            }
        
        }
		
}

</script>