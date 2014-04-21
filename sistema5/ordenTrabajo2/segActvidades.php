<?php 
session_start();
include('../conex_inicial.php');

$referencia=$_REQUEST['referencia'];
//echo $referencia;
$strsql="select * from cab_mov where cod_cab='$referencia'";
$resultado=mysql_query($strsql,$cn);
$cont=mysql_num_rows($resultado);
$row=mysql_fetch_array($resultado);

// $strSQLRef="select referencia.* from referencia,cab_mov where cab_mov.cod_cab=referencia.cod_cab_ref and referencia.cod_cab='".$referencia."' and cod_ope='SM'";

list($seriePO,$numeroPO,$codcabPO)=mysql_fetch_row(mysql_query("SELECT serie,correlativo,cod_cab_ref FROM referencia WHERE cod_cab = '".$referencia."'"));

$noperacion=$row['noperacion'];
$numero=$row['Num_doc'];
$serie=$row['serie'];
$flag=$row['flag'];

//echo $numero;
$ruc=$row['ruc'];
$cliente=$row['cliente'];
$fecha=$row['fecha'];
$cod_ope=$row['cod_ope'];
$codsucursal=$row['sucursal'];
$codtienda=$row['tienda'];
$cod_vendedor=$row['cod_vendedor'];
$tipo_cambio=$row['tc'];
$moneda=$row['moneda'];
$fecha_aud=$row['fecha_aud'];
$nom_pc=$row['pc'];
$inafecto=$row['inafecto'];
$incluidoigv=$row['incluidoigv'];
$b_imp=$row['b_imp'];
$igv=$row['igv'];
$impto=$row['impto1'];


if($inafecto=='S'){
	$texto_incl_igv=" DOC. INAFECTO ";
}else{

	if($incluidoigv=='S'){
	$texto_incl_igv=" INCLUIDO IGV";
	}else{
	$texto_incl_igv=" NO INCLUIDO IGV";
	}
}


if($moneda=='01'){
$des_mon="SOLES S/.";
$simbolo="S/.";
}else{
$des_mon="DOLARES US$.";
$simbolo="US$.";
}
$importe=$row['total'];

//-----------------------------------RM---------------------------------------------------
$serieRM='001';
list($numeroRM)=mysql_fetch_row(mysql_query("select max(Num_doc) from cab_mov where cod_ope='RM' and serie='".$serieRM."' and sucursal='".$codsucursal."' "));

$numeroRM=str_pad($numeroRM+1,7,"0",STR_PAD_LEFT);

//----------------------------------------------------------------------------------------




	$strSQL_clie="select *  from cliente where codcliente='".$cliente."'";
	$resultado_clie=mysql_query($strSQL_clie,$cn);
	$row_clie=mysql_fetch_array($resultado_clie);
	$razonsocial=$row_clie['razonsocial'];
	$ruc=$row_clie['ruc'];
	$direccion=$row_clie['direccion'];
	
//	echo $strSQL_clie;
	
	$strSQL_ope="select *  from operacion where codigo='".$cod_ope."'";
	$resultado_ope=mysql_query($strSQL_ope,$cn);
	$row_ope=mysql_fetch_array($resultado_ope);
	$ticket=$row_ope['descripcion'];
	
	
	$strSQL_emp="select des_suc from sucursal where cod_suc='".$codsucursal."'";
	$resultado_emp=mysql_query($strSQL_emp,$cn);
	$row_emp=mysql_fetch_array($resultado_emp);
	$dessuc=$row_emp['des_suc'];
	
	
	
	$strSQL_tien="select des_tienda from tienda where cod_tienda='".$codtienda."'";
	$resultado_tien=mysql_query($strSQL_tien,$cn);
	$row_tien=mysql_fetch_array($resultado_tien);
	$destienda=$row_tien['des_tienda'];
	
	$empresa=$dessuc." / ".$destienda;
	
	$strSQL_vend="select usuario from usuarios where codigo='".$cod_vendedor."'";
	$resultado_vend=mysql_query($strSQL_vend,$cn);
	$row_vend=mysql_fetch_array($resultado_vend);
	
	$responsable=$row_vend['usuario'];
	
	$afecha=explode('-',trim(substr($fecha,0,10)));
	$fecha=$afecha[2]."-".$afecha[1]."-".$afecha[0]." ".substr($fecha,11,18);





//-----------------------------------Numero siguiente ---------------------------------------------------

list($numeroActv)=mysql_fetch_row(mysql_query("select max(numero) from activxordent  where cod_cab='".$referencia."' "));

$numeroActv=str_pad($numeroActv+1,7,"0",STR_PAD_LEFT);

//----------------------------------------------------------------------------------------
 	

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Detalle</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {
	color: #FFFFFF;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo7 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.Estilo12 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo21 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #FF0000; }
img { behavior: url(../ventas/iepngfix.htc); }
-->
</style>
<style media="print" type="text/css">
.no_print{
display:none;
}
</style>
<script src="../jquery-1.2.6.js"></script>
<script src="../jquery.hotkeys.js"></script>

<script language="javascript" src="../Finanzas/miAJAXlib3.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />

<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>

<script language="JavaScript">
jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_esc').addClass('dirty'); 
close()
return false; });
function printer() 
{ 
vbPrintPage(); 
return false; 
} 
</script>
<SCRIPT LANGUAGE="VBScript"> 
Sub window_onunload 
On Error Resume Next 
Set WB = nothing 
End Sub 
Sub vbPrintPage 
OLECMDID_PRINT = 6 
OLECMDEXECOPT_DONTPROMPTUSER = 2 
OLECMDEXECOPT_PROMPTUSER = 1 
On Error Resume Next 
WB.ExecWB OLECMDID_PRINT, OLECMDEXECOPT_DONTPROMPTUSER, OLECMDEXECOPT_PROMPTUSER 
End Sub 
</SCRIPT> 
<style type="text/css">
<!--
.Estilo31 {color: #FF0000}
.Estilo42 {
	color: #0066FF;
	font-weight: bold;
}
.Estilo44 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo45 {color: #FFFFFF}
.Estilo15 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #990000;
}
-->
</style>
</head>

<body>

<form id="form1" name="form1" method="post" action="" >

<table width="100%" height="337" border="0" cellpadding="0" cellspacing="0">
  <tr>
  <td height="39" colspan="3" align="center" bgcolor="#003366"><span class="Estilo1">SEGUIMIENTO DE ACTIVIDADES <br>
  ORDEN TRABAJO </span></td>
  
  <?php if($flag=='A'){?>
  </tr>
  <tr>
    <td height="21" colspan="3" align="center" ><span class="Estilo21">( Anulado )</span></td>
  </tr> 
  
  <?php }?>
  <tr>
  
    <td width="8" height="86">&nbsp;</td>
    <td width="100%" style="padding-top:10px">
	<fieldset><legend><span class="Estilo44">Datos Orden de Trabajo</span></legend>
    <table width="100%" height="57" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="19">&nbsp;</td>
        <td><span class="Estilo7">Empresa/ Tienda: </span><span class="Estilo12"><?php echo $empresa; ?></span></td>
        <td><span class="Estilo7">Fecha: </span><span class="Estilo12"><?php echo $fecha?></span></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="34" height="19">&nbsp;</td>
        <td width="404"><span class="Estilo12"><span class="Estilo7">TD</span></span>: <span class="Estilo12 Estilo42"><?php echo $cod_ope." : ".$serie."-".$numero ?></strong></span></td>
        <td width="319">
		<!--
		<span class="Estilo12"><?php //echo "Nro.Operaci&oacute;n: ".str_pad($noperacion, 10, "0", STR_PAD_LEFT)?></span>-->
		<span class="Estilo7 Estilo31">PRESUPUESTO:&nbsp; </span><span class="Estilo12 Estilo42"> <?php echo $seriePO."-".$numeroPO; ?>&nbsp;&nbsp; </span><img onClick="origenPO('<?php echo $codcabPO ?>')" src="../imagenes/ico_lupa.png"  width="16" height="16" border="0" style="cursor:pointer">
		<input type="hidden" name="prueba" id="prueba"></td>
        <td width="96" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td height="19">&nbsp;</td>
        <td><span class="Estilo7">Se&ntilde;ores:</span><span class="Estilo12"> <?php echo $razonsocial; ?></span></td>
        <td><span class="Estilo7">Direcci&oacute;n</span>:<span class="Estilo12"><?php echo $direccion; ?></span></td>
        <td width="96" align="center"><a href="#" onClick="javascript:printer()" ></a></td>
      </tr>
    </table>
    </fieldset>	</td>
    <td width="9">&nbsp;</td>
  </tr>
  <tr>
    <td height="5"></td>
    <td ></td>
    <td></td>
  </tr>
  <tr>
    <td height="29">&nbsp;</td>
    <td style="padding-top:10px"><fieldset>
        <legend class="Estilo44"> Documento Actividades </legend>
        <table width="867" height="106" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="59" height="32" class="Estilo44"><strong>Trabajador</strong></td>
            <td width="210" class="Estilo7"><span class="Estilo15">
              <select style="width:190"  name="usuario" id="usuario" onChange="document.form1.fechaActv.focus();document.form1.fechaActv.select()" >
              <option value="0"></option>
                <?php 				
			  $resultados1 = mysql_query("select * from usuarios order by codigo ",$cn); 
			  
			  
			while($row1=mysql_fetch_array($resultados1))
			{
		?>
                <option value="<?php echo $row1['codigo'] ?>"><?php echo $row1['usuario'] ?></option>
                <?php }?>
              </select>
            </span></td>
            <td width="134" class="Estilo7">Fecha</td>
            <td width="117" class="Estilo7"><input name="fechaActv" id="fechaActv" type="text" size="10" maxlength="10" onChange="javascript:this.focus();this.select()" value="<?php echo date("d-m-Y")?>" onKeyUp="filtrarActv(event)" >
              <button type="reset" id="f_trigger_b1" style="height:18; vertical-align:top" >...</button>
              <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fechaActv",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b1",   
        singleClick    :    true,           
        step           :    1                
    });
              </script>			</td>
            <td width="65" class="Estilo7">Nro.Doc.</td>
            <td colspan="3" class="Estilo12"><?php echo $numeroActv ?></td>
          </tr>
          <tr>
            <td rowspan="2" valign="bottom" class="Estilo7">Actividad</td>
            <td rowspan="2" valign="bottom" class="Estilo7">
			<?php 
			$strSQL="select p.* from activxpresu a,procesos p where a.codpresup='".$codcabPO."' and p.id=a.procesos";
			//echo $strSQL;
			$resultado=mysql_query($strSQL,$cn);
			?>
			<select name="actividades" id="actividades" disabled="disabled" style="width:190px">
			<?php 
			
			while($row=mysql_fetch_array($resultado)){
			?>
			  <option value="<?php echo $row['id']?>"><?php echo $row['nombre']?></option>
			<?php 
			}
			?>		
            </select>            </td>
            <td rowspan="2" valign="bottom" ><span class="Estilo7">Hora Inicio (hh : mm)</span><span class="Estilo12">(formato de 24 horas)</span></td>
            <td rowspan="2" valign="bottom" class="Estilo7">
			
			<select name="horaIni" id="horaIni" disabled="disabled">
			<?php
			$i=0; 
			while($i<24){?>
			 <option value="<?php echo str_pad($i,2,"0",STR_PAD_LEFT)?>"><?php echo str_pad($i,2,"0",STR_PAD_LEFT)?></option>
			 <?php  
			 $i++;
			 }
			 ?>
            </select>
			:
			<select name="minIni" id="minIni" disabled="disabled">
               	<?php
			$i=0; 
			while($i<60){?>
			 <option value="<?php echo str_pad($i,2,"0",STR_PAD_LEFT)?>"><?php echo str_pad($i,2,"0",STR_PAD_LEFT)?></option>
			 <?php  
			 $i++;
			 }
			 ?>
              </select></td>
            <td rowspan="2" valign="bottom" class="Estilo7">Tiempo:</td>
            <td height="14" valign="bottom"><span class="Estilo44">horas
              
              </span></td>
            <td valign="bottom"><span class="Estilo44">minutos</span></td>
            <td width="172" rowspan="2" valign="bottom"><span class="Estilo7">Cant.<span class="Estilo44">
              <input name="cantidad" type="text" id="cantidad" size="5" maxlength="10" disabled="disabled">
            </span></span></td>
          </tr>
          <tr>
            <td width="49" height="22" valign="bottom"><input name="horaTiempo" id="horaTiempo" type="text" size="3" maxlength="5" onKeyDown="validarNumero(this,event)" disabled="disabled" value="0"></td>
            <td width="61" valign="bottom"><span class="Estilo44">
              <input name="minTiempo" id="minTiempo" type="text" size="3" maxlength="5" onKeyDown="validarNumero(this,event)" disabled="disabled" value="0">
            </span></td>
          </tr>
          <tr>
            <td height="38" colspan="8" align="center" valign="bottom"><input disabled="disabled" onClick="insertAcvt()" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(../imagenes/boton_aplicar.gif) ; cursor:pointer" type="button" name="Submit" id="Submit" value="Insertar" ></td>
          </tr>
        </table>
    </fieldset></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="55">&nbsp;</td>
    <td>
	
	<br>
        <div id="datos">
		<table width="100%" height="45" border="0" cellpadding="1" cellspacing="1">
          <tr style="background:url(../imagenes/bg_contentbase4.gif); background-position:80px 60px">
            <td width="18" height="21">&nbsp;</td>
            <td width="104"><span class="Estilo12 Estilo45"><strong>Fecha</strong></span></td>
            <td colspan="2"><span class="Estilo12 Estilo45"><strong>Nro Documento </strong></span></td>
            <td width="268"><span class="Estilo12 Estilo45"><strong>Actividad</strong></span></td>
            <td width="139"><span class="Estilo12 Estilo45"><strong>Trabajador</strong></span></td>
            <td width="141"><span class="Estilo12 Estilo45"><strong>Tiempo</strong></span></td>
            <td width="89"><span class="Estilo12 Estilo45"><strong>Cantidad</strong></span></td>
          </tr>
	
	
          <tr>
            <td height="21">&nbsp;</td>
            <td>&nbsp;</td>
            <td width="43">&nbsp;</td>
            <td width="48">&nbsp;</td>
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
    <td height="19">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</form>
<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>
</body>
</html>
<script>
function origenPO(codigo){

var Datos2=window.open("../doc_det.php?referencia="+codigo,"PO","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=720, height=520,left=200 top=150");
Datos2.focus();
}


function marcarChk(obj){

	if(obj.checked){
	
		if((parseFloat(obj.parentNode.parentNode.childNodes[4].innerHTML)-parseFloat(obj.parentNode.parentNode.childNodes[5].innerHTML))<=0){
		alert("No tiene cantidad disponible para devolver");
		obj.checked=false;
		return false;
		}
		obj.parentNode.parentNode.parentNode.rows[obj.parentNode.parentNode.rowIndex].style.background='#93FF93';
//		alert(obj.parentNode.parentNode.rowIndex);
		obj.parentNode.parentNode.childNodes[8].childNodes[0].childNodes[0].disabled=false;
		obj.parentNode.parentNode.childNodes[8].childNodes[0].childNodes[0].value="";
		obj.parentNode.parentNode.childNodes[8].childNodes[0].childNodes[0].focus();
		obj.parentNode.parentNode.childNodes[8].childNodes[0].childNodes[0].select();
	
	}else{
	obj.parentNode.parentNode.childNodes[8].childNodes[0].childNodes[0].value="0";
	obj.parentNode.parentNode.childNodes[8].childNodes[0].childNodes[0].disabled=true;
	obj.parentNode.parentNode.parentNode.rows[obj.parentNode.parentNode.rowIndex].style.background='#EFEFEF';
	
	
	}

}

function controlCant(obj){
	//alert(obj.parentNode.parentNode.parentNode.childNodes[4].innerHTML);
	if(obj.value >(parseFloat(obj.parentNode.parentNode.parentNode.childNodes[4].innerHTML)-parseFloat(obj.parentNode.parentNode.parentNode.childNodes[5].innerHTML))){
	obj.value='0';
	obj.focus();
	obj.select();
	alert("la cantidad ingresada no esta disponible");
	}
	
}

function validarNumero(control,e){
//alert(e.keyCode);
	try{
		if((e.keyCode>=96 && e.keyCode<=105) || (e.keyCode>46 && e.keyCode<58) || e.keyCode==8 || e.keyCode==190 || e.keyCode==37 || e.keyCode==39 || e.keyCode==110){
			temp=control.value.split(".");
			if(e.keyCode==190 || e.keyCode==110){
				if(temp[1]!=undefined){	
					e.keyCode=0;
					event.returnValue=false;
					return false;
				}
			}
		}else{
			if(e.keyCode==13){
				
				
			}else{
				e.keyCode=0;
				event.returnValue=false;
				return false;
			}
		}
	}catch(e){
	
	}	

}

function doc_det(valor){

window.open("../doc_det2.php?referencia="+valor,"","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=320,left=300 top=250");

}
function cambiar_fondo(control,evento){

if(evento=='e')
control.style.backgroundImage='url(../imagenes/boton_aplicar2.gif)';
else
control.style.backgroundImage='url(../imagenes/boton_aplicar.gif)';


}

function validarNumero(control,e){
//alert(e.keyCode);
	try{
		if((e.keyCode>=96 && e.keyCode<=105) || (e.keyCode>46 && e.keyCode<58) || e.keyCode==8  || e.keyCode==37 || e.keyCode==39 ){
			temp=control.value.split(".");
			if(e.keyCode==190 || e.keyCode==110){
				if(temp[1]!=undefined){	
					e.keyCode=0;
					event.returnValue=false;
					return false;
				}
			}
		}else{
			if(e.keyCode==13){
				
				
			}else{
				e.keyCode=0;
				event.returnValue=false;
				return false;
			}
		}
	}catch(e){
	
	}	

}

function filtrarActv(e){

	if(e.keyCode==13){
	document.form1.horaTiempo.disabled=false;
	document.form1.minTiempo.disabled=false;
	document.form1.horaIni.disabled=false;
	document.form1.minIni.disabled=false;
	document.form1.actividades.disabled=false;
    document.form1.cantidad.disabled=false;
	
	document.form1.Submit.disabled=false;
	
	document.form1.fechaActv.disabled=true;
	document.form1.usuario.disabled=true;
	document.form1.f_trigger_b1.disabled=true;
	
	document.form1.actividades.focus();
	
	document.form1.horaTiempo.select();
	
	var codcabOT="<?php echo $referencia ?>";
	var trabajador=document.form1.usuario.value;
	var fecha=document.form1.fechaActv.value;
	
	doAjax('listaActiv.php','peticion=listarActvOT&codcabOT='+codcabOT+'&trabajador='+trabajador+'&fecha='+fecha,'mostrar_filtro','get','0','1','','datos');
	
	}

}


function mostrar_filtro(texto){
//alert(texto);
document.getElementById("datos").innerHTML=texto;
}


function insertAcvt(){


    var codcabOT="<?php echo $referencia ?>";
	var trabajador=document.form1.usuario.value;
	var fecha=document.form1.fechaActv.value;
	var actividad=document.form1.actividades.value;
	var hora=document.form1.horaIni.value+":"+document.form1.minIni.value+":00";
	var tiempo=document.form1.horaTiempo.value+":"+document.form1.minTiempo.value+":00";
	var tienda="<?php echo $codtienda ?>";
	var numeroActv=<?php echo $numeroActv ?>;
	var cantidad=document.form1.cantidad.value;
	
	if((document.form1.horaTiempo.value==0 && document.form1.minTiempo.value==0) || (document.form1.horaTiempo.value=='' || document.form1.minTiempo.value=='')){
	alert("tiene que ingresar el tiempo");
	return false;
	}
	if(document.form1.cantidad.value==''){
	alert("Tiene que ingresar una cantidad");
	document.form1.cantidad.focus();
	return false;
	}	
	
	doAjax('listaActiv.php','peticion=listarActvOT&codcabOT='+codcabOT+'&trabajador='+trabajador+'&fecha='+fecha+'&hora='+hora+'&tiempo='+tiempo+'&actividad='+actividad+'&tienda='+tienda+'&numeroActv='+numeroActv+'&guardar&cantidad='+cantidad,'mostrar_filtro','get','0','1','','datos');
	

}

function eliminarActv(codigo){
var codcabOT="<?php echo $referencia ?>";
	var trabajador=document.form1.usuario.value;
	var fecha=document.form1.fechaActv.value;
	var actividad=document.form1.actividades.value;
	var hora=document.form1.horaIni.value+":"+document.form1.minIni.value+":00";
	var tiempo=document.form1.horaTiempo.value+":"+document.form1.minTiempo.value+":00";
	var tienda="<?php echo $codtienda ?>";
	
	
	doAjax('listaActiv.php','peticion=listarActvOT&codcabOT='+codcabOT+'&trabajador='+trabajador+'&fecha='+fecha+'&hora='+hora+'&tiempo='+tiempo+'&actividad='+actividad+'&tienda='+tienda+'&codigo='+codigo+'&eliminar','mostrar_filtro','get','0','1','','datos');
	
}

</script>