<?php
include('../conex_inicial.php');

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo15 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #990000;
}
.Estilo16 {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 11px;
	font-weight: bold;
}
.Estilo17 {
	font-family: Arial, Helvetica, sans-serif;
	color: #000000;
}
.Estilo21 {
	color: #003366;
	font-weight: bold;
}
.Estilo20 {
	color:#FFFFFF;
	font-weight: bold;
}
-->
</style></head>
<link href="../styles.css" rel="stylesheet" type="text/css">

<script language="javascript" src="miAJAXlib3.js"></script>
   <script src="../jquery-1.2.6.js"></script>
    <script src="../jquery.hotkeys.js"></script>
	<script src="../mootools-comprimido-1.11.js"></script>

<body onLoad="iniciar();carga_doc()">
<form name="form1" method="post" action="" >
  <table width="813" border="0" cellpadding="0" cellspacing="0">
   <tr  style="background:url(../imagenes/white-top-bottom.gif)">
      <td height="27" colspan="11" style="border:#999999">
	  <span class="Estilo1 Estilo19 Estilo21"> Administraci&oacute;n :: Documentos por Usuario<span class="text4">
        <input name="auxiliar" type="hidden" id="auxiliar" value="<?php echo $tipo_aux; ?>">
      </span></span>	  </td>
    </tr>
    <tr>
      <td width="11" height="60">&nbsp;</td>
      <td width="797"><fieldset style="height:50px;">
      <table width="792" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="9"></td>
            <td height="10px" colspan="2"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td width="634"><span class="Estilo17">Usuario:</span> <span class="Estilo15">
            <select name="usuario" onChange="insertar('listar');" >
              <?php 				
  $resultados1 = mysql_query("select * from usuarios order by codigo ",$cn); 
while($row1=mysql_fetch_array($resultados1))
{
		?>
              <option value="<?php echo $row1['codigo'] ?>"><?php echo $row1['usuario'] ?></option>
              <?php }?>
            </select>
            </span>
              <label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input   onClick="carga_doc()" style=" background:none; border:none" type="radio" name="GrupoOpciones1" id="GrupoOpciones1" value="opci&oacute;n" checked="checked">
              <span class="Estilo17">Compras ( Ingresos )</span></label>
              &nbsp;&nbsp;
              <label>
              <input  onClick="carga_doc()" style="background:none; border: none" type="radio" name="GrupoOpciones1" id="GrupoOpciones1" value="opci&oacute;n">
              <span class="Estilo17">Ventas ( Salidas )
              <input type="hidden" name="carga" id="carga" value="N">
            </span></label></td>
            <td width="149" align="center">&nbsp;</td>
          </tr>
        </table>
      </fieldset>
      </td>
	  <td width="5">&nbsp;</td>
    </tr>
	  <tr>
	  <td height="52">&nbsp;</td>
      <td align="center" valign="top">
	  
	  <fieldset>
      <table width="791" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="4" height="10px"></td>
          </tr>
        <tr>
          <td width="8">&nbsp;</td>
          <td width="25"><span class="Estilo17">Doc:</span>          </td>
          <td width="147">
		  <div id="documentos" style="width:140px">
            <select style="width:140" name="doc"  onChange="cambiar_enfoque(this);">
              <option value="0"></option>
              <?php 
		   $resultados10 = mysql_query("select * from operacion where  and codigo!='TS'  and tipo='1' order by descripcion ",$cn); 
			while($row10=mysql_fetch_array($resultados10))
			{
					
		  ?>
              <option value="<?php echo $row10['codigo']?>"><?php echo $row10['codigo']."-".$row10['descripcion']?></option>
              <?php }?>
            </select>
			</div>          </td>
          <td width="611"><span class="Estilo17">Serie:</span>
            <input name="num_serie" type="text" size="3" maxlength="3">
            <span class="Estilo17"> Apartir:</span>
            <input name="numero_ini" type="text" size="7" maxlength="7">
            <span class="Estilo17">hasta:</span>
            <input name="numero_fin" type="text" size="7" maxlength="7">
            <span class="Estilo17"> Empresa:</span>
            <select style="width:140"  name="sucursal" onChange="cambiar_enfoque(this)"  >
              <option value="0"></option>
              <?php 
		
  $resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn); 
while($row1=mysql_fetch_array($resultados1))
{
		?>
              <option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
              <?php }?>
            </select>
            <span class="Estilo17"> Acci&oacute;n:</span>
            <select name="accion">
              <option value="I" selected>Imprimir</option>
              <option value="P">Pantalla</option>
			  <option value="E">Generar PDF</option>
            </select></td>
        </tr>
        <tr>
          <td height="27">&nbsp;</td>
          <td colspan="3"><span class="Estilo17">PC: 
            <input type="text" name="pc" id="pc">
          Tipo de cola: 
          <select name="tcola" id="tcola">
            <option value="1">Predeterminada</option>
            <option value="2">Personalizada</option>
          </select>
          Nombre Cola
          <input type="text" name="cola" id="cola">
          </span></td>
          </tr>
        
        <tr>
          <td height="35" colspan="4" align="center"><input onClick="insertar('insertar')" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(../imagenes/boton_aplicar.gif) ; cursor:pointer" type="button" name="Submit" value="Guardar" ></td>
        </tr>
      </table>
      </fieldset></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="187">&nbsp;</td>
      <td valign="top" align="center"><div id="det_docu" style="width:752px; height:200px"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>

<script>


 

jQuery(document).bind('keyup', 'return',function (evt){jQuery('#_return').addClass('dirty'); 

  	cambiar_enfoque(document.activeElement);
		
	return false; });


function iniciar(){
document.form1.doc.focus();

insertar('listar');

}


function carga_doc(){

var compras=document.form1.GrupoOpciones1[0].checked;

var tipomov='';
if(compras) tipomov=1;
else tipomov=2;

doAjax('ajax_user.php','&peticion=carga_doc&tipomov='+tipomov,'res_carga_doc','get','0','1','documentos','');
}

function res_carga_doc(texto){

document.getElementById('documentos').innerHTML=texto;
document.form1.carga.value='N';

insertar('listar');
}

function cambiar_enfoque(control){


	if(control.name=='doc'){
	document.form1.num_serie.value=ponerCeros(document.form1.num_serie.value,3);
	document.form1.num_serie.select();
	document.form1.num_serie.focus();
	}
	
	if(control.name=='num_serie'){
	document.form1.numero_ini.value=ponerCeros(document.form1.numero_ini.value,7);
	document.form1.numero_ini.select();
	document.form1.numero_ini.focus();
	
		if(document.form1.num_serie.value>0)
		document.form1.num_serie.value=ponerCeros(document.form1.num_serie.value,3);
		else
		document.form1.num_serie.value='';
	
	}
	
	if(control.name=='numero_ini'){
	document.form1.numero_fin.value=ponerCeros(document.form1.numero_fin.value,7);
	document.form1.numero_fin.select();
	document.form1.numero_fin.focus();
	
		if(document.form1.numero_ini.value>0)
		document.form1.numero_ini.value=ponerCeros(document.form1.numero_ini.value,7);
		else
		document.form1.numero_ini.value='';
	
	}
	
	if(control.name=='numero_fin'){
	
	document.form1.sucursal.focus();
	
		if(document.form1.numero_fin.value>0)
		document.form1.numero_fin.value=ponerCeros(document.form1.numero_fin.value,7);
		else
		document.form1.numero_fin.value='';
	
	}
	
	
	if(control.name=='sucursal'){
	
	document.form1.accion.focus();
	
			
	}
	
	
	
	
	

}


 function ponerCeros(obj,i) {
		  while (obj.length<i){
			obj = '0'+obj;
			}
		//	alert(obj);
			return obj;
}


function cambiar_fondo(control,evento){

if(evento=='e')
control.style.backgroundImage='url(../imagenes/boton_aplicar2.gif)';
else
control.style.backgroundImage='url(../imagenes/boton_aplicar.gif)';


}

function insertar(ac,cod){
//alert(ac)
if(ac=='insertar'){
	var temp=validar();
	
	if(!temp)return false;
}	
	

var compras=document.form1.GrupoOpciones1[0].checked;
var tipomov='';
if(compras) tipomov=1;
else tipomov=2;

	 for (i=0;i<document.form1.doc.options.length;i++)
        {
		
         if (document.form1.doc.options[i].value==document.form1.doc.value)
            {
			   var desdoc=document.form1.doc.options[i].text;
            }
        
        }


var usuario=document.form1.usuario.value;
var doc=document.form1.doc.value;
var serie=document.form1.num_serie.value;
var numero_ini=document.form1.numero_ini.value;
var numero_fin=document.form1.numero_fin.value;
var empresa=document.form1.sucursal.value;
var accion=document.form1.accion.value;
var cola=document.form1.cola.value;
var pc=document.form1.pc.value;
var tcola=document.form1.tcola.value;

doAjax('ajax_user.php','&peticion=detalle_doc&tipomov='+tipomov+'&usuario='+usuario+'&doc='+doc+'&serie='+serie+'&numero_ini='+numero_ini+'&numero_fin='+numero_fin+'&empresa='+empresa+'&accion='+accion+'&desdoc='+desdoc+'&ac='+ac+'&cod='+cod+'&pc='+pc+'&cola='+cola+'&tcola='+tcola,'res_insertar','get','0','1','det_docu','');
}

function res_insertar(texto){
document.getElementById('det_docu').innerHTML=texto;
document.form1.carga.value='N';
document.form1.doc.focus();
}

function validar(){

	if(document.form1.doc.value==0){
	alert("Debe seleccionar un documento");
	return false;
	}
	if(document.form1.sucursal.value==0){
	alert("Debe seleccionar un Empresa");
	return false;
	}

return true;
}



</script>
