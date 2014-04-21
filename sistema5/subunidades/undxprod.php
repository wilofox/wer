<?php 
include('../conex_inicial.php');
include('../funciones/funciones.php');

  $unidad_ = $_REQUEST['unidad'];
  $codigo  = $_REQUEST['cod'];

  $strSQL1="select * from producto where idproducto='$codigo'";
  $resultado1=mysql_query($strSQL1,$cn);
  $row1=mysql_fetch_array($resultado1);

  $struni="select descripcion from unidades where id='".$unidad_."'";
  $rsuni=mysql_query($struni,$cn);
  $row1uni=mysql_fetch_array($rsuni);
	  

	$codigo=$row1['idproducto'];
	$nombre=$row1['nombre'];
	$precio=$row1['precio'];	
	$und=$row1['und'];	
	$factor=$row1['factor'];

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>UNIDADES POR PRODUCTO</title>
<link href="../styles.css" rel="stylesheet" type="text/css">
	<script language="javascript" src="../modulos_usuarios/miAJAXlib3.js"></script>
   <script src="../jquery-1.2.6.js"></script>
    <script src="../jquery.hotkeys.js"></script>
	<script src="../mootools-comprimido-1.11.js"></script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo3 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #000000; }
.Estilo4 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #0066FF;
	font-weight: bold;
}
.Estilo80 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #D50000;
	font-weight: bold;
}
.Estilo10 {color: #FFFFFF; font-family: Arial, Helvetica, sans-serif; font-weight: bold; }
.Estilo11 {
	color: #0066FF;
	font-weight: bold;
}
.Estilo17 {	font-family: Arial, Helvetica, sans-serif;
	color: #000000;
}
-->
</style></head>

<body onLoad="iniciar();">
<form name="form1" method="post" action="">
  <table width="480" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="36" colspan="3" align="center"><p><span class="Estilo4"><?php echo $codigo." - ";?>
           <?php echo $nombre?></span>
          <input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo;?>">        
          <input type="hidden" name="carga" id="carga" value="N">        
          <input type="hidden" name="pre_pr" id="pre_pr" value="<?php echo $precio?>">
          <input type="hidden" name="idUnixProd" id="idUnixProd" value="">
          <Br>
        <span class="Estilo4">(
          <?
		$str="select * from unidades where id='$und' ";
  		$resul=mysql_query($str,$cn);
  		$rowU=mysql_fetch_array($resul);
			echo $rowU['descripcion'].' - '.$factor;
		?>
          )</span>
      </p></td>
    </tr>
    <tr>
      <td width="9" height="48">&nbsp;</td>
      <td width="463"><fieldset style="height:40px">
      <table border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><span class="Estilo3">Relaci&oacute;n de Unidades </span></td>
          <td>&nbsp;</td>
          <td><span class="Estilo3">Factor</span></td>
          <td><span class="Estilo3">Precio</span></td>
          <td rowspan="2" valign="bottom">
		  <div id="btnInsert" style="display:block">
		  <input onClick="transSQL('insertar')" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(../imagenes/boton_aplicar.gif) ; cursor:pointer" type="button" name="Submit" value="Insertar" >
		  </div>
		  <div id="btnupdt" style="display:none">
		  <input onClick="transSQL('actualizar')" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(../imagenes/boton_aplicar.gif) ; cursor:pointer" type="button" name="Submit" value="Actualizar" >
		  </div>
		  </td>
        </tr>
        <tr>
          <td>
		  
		  
		  <select name="und" style="width:150px" onChange="cambiar_enfoque(this)" id="und">
            <?php 
	   $resultados0 = mysql_query("select * from unidades where id<>'$und' 
	    and id not in (select unidad from unixprod where producto='$codigo' )
	   order by descripcion ",$cn);
			while($row0=mysql_fetch_array($resultados0))
			{
			
			$array1=$array1.$row0['id']."-";
			$array2=$array2.$row0['factorSub']."-";		
	  	?> 
		
		<option value="<?php echo $row0['id'];?>"  selected><?php echo $row0['descripcion']  ?></option>
        <?php
			}	
		 ?>
          </select></td>
          <td><select name="mconv" id="mconv" style="width:100px" onChange="cambiar_enfoque(this)">
          <option value="" selected>NOMINAL</option>
		  <option value="P" >PORCENTUAL</option>        
          </select></td>
          <td><input name="factor" type="text" id="factor" size="8" maxlength="10"></td>
          <td><input name="precio" type="text" id="precio" size="8" maxlength="10"></td>
        </tr>
      </table>
      </fieldset>&nbsp;</td>
      <td width="8">&nbsp;</td>
    </tr>
    <tr>
      <td height="260">&nbsp;</td>
      <td valign="top"><fieldset  style="height:250px"><legend><span class="Estilo11">Unidades por Producto</span></legend>
       <br> 
	   <div id="det_subuni">
	   <table width="447" border="0" cellpadding="0" cellspacing="1">
          <tr style="background:url(../imagenes/bg_contentbase2.gif) ; background-position:100% 40%; ">
            <td width="30" height="21">&nbsp;</td>
            <td width="245"><span class="Estilo10">Unidad</span></td>
            <td width="63" align="center"><span class="Estilo10">Factor</span></td>
            <td width="78" align="center"><span class="Estilo10">Precio</span></td>
            <td width="25" align="center"><span class="Estilo10">A</span></td>
          </tr>
          <tr>
            <td bgcolor="#F7F7F7">&nbsp;</td>
            <td bgcolor="#F7F7F7">&nbsp;</td>
            <td bgcolor="#F7F7F7">&nbsp;</td>
            <td bgcolor="#F7F7F7">&nbsp;</td>
            <td bgcolor="#F7F7F7">&nbsp;</td>
          </tr>
        </table>
		<div>
      </fieldset>
	  
	  
       <u><b>Leyenda:</b></u>
	  <table width="176" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="56" >&nbsp;&nbsp;&nbsp;&nbsp;Nominal</td>
    <td width="24"  style="background-color:#F4F4F4"></td>
    <td width="63">&nbsp;&nbsp;&nbsp;Porcentual</td>
    <td width="27" style="background-color:#FFCC00">&nbsp;</td>
  </tr>
</table>

	  </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center"><input onClick="javascript:window.close()" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(../imagenes/boton_aplicar.gif) ; cursor:pointer" type="button" name="Submit2" value="Aceptar" ></td>
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

function cambiar_fondo(control,evento){

	if(evento=='e')
	control.style.backgroundImage='url(../imagenes/boton_aplicar2.gif)';
	else
	control.style.backgroundImage='url(../imagenes/boton_aplicar.gif)';

}

function transSQL(ac,cod){

var factor=document.form1.factor.value;
var precio=document.form1.precio.value;
var codigo=document.form1.codigo.value;
var cod_uni=document.form1.und.value;
var mconv=document.form1.mconv.value;

//alert(precio);
if(ac=='insertar'){
	var temp=validar();
	if(!temp)return false;
	
	
	 for (i=0;i<document.form1.und.options.length;i++)
        {
		
         if (document.form1.und.options[i].value==document.form1.und.value)
            {
			   var des_uni=document.form1.und.options[i].text;
            }
        
        }
//alert(precio);
doAjax('ajax_subuni.php','&peticion=detalle&factor='+factor+'&precio='+precio+'&codigo='+codigo+'&cod_uni='+cod_uni+'&des_uni='+des_uni+'&ac='+ac+'&mconv='+mconv,'res_transSQL','get','0','1','det_subuni','');
//Actualiza pag
document.form1.submit();
}

	
	if(ac=='eliminar'){
	   doAjax('ajax_subuni.php','&peticion=detalle&&ac='+ac+'&cod='+cod+'&codigo='+codigo,'res_transSQL','get','0','1','det_subuni','');
	  //Actualiza pag
document.form1.submit(); 
	}
	
	if(ac=='editar'){
	   //doAjax('ajax_subuni.php','&peticion=detalle&&ac='+ac+'&cod='+cod+'&codigo='+codigo,'res_transSQL','get','0','1','det_subuni','');
	  //Actualiza pag
//document.form1.submit(); 
	var temp=cod.split("|");
	
	document.form1.precio.value=temp[3];
	document.form1.factor.value=temp[2];
	
	document.form1.idUnixProd.value=temp[0];
	
	document.getElementById("btnInsert").style.display='none';
	document.getElementById("btnupdt").style.display='block';
	//seleccionar_cbo('und',temp[1]);	
	
	}
	
	if(ac=='actualizar'){
		
	doAjax('ajax_subuni.php','&peticion=detalle&&ac='+ac+'&cod='+cod+'&codigo='+codigo+'&idUnixProd='+document.form1.idUnixProd.value+'&precio='+precio+'&factor='+factor,'res_transSQL2','get','0','1','det_subuni','');
	
	}

}

function seleccionar_cbo(control,valor){
		
		 var valor1=valor;
         var i;
		// alert(valor1+" "+control);
	     for (i=0;i< eval("document.form1."+control+".options.length");i++)
        {
		alert(eval("document.form1."+control+".options[i].value")+" "+valor1);
         if (eval("document.form1."+control+".options[i].value=='"+valor1+"'"))
            {
		//	alert("entro");
			   eval("document.form1."+control+".options[i].selected=true");
            }
        
        }
		
}

function res_transSQL(texto){
//alert(texto);
document.getElementById('det_subuni').innerHTML=texto;
document.form1.carga.value='N';
document.form1.und.focus();
}

function res_transSQL2(texto){
//alert(texto);
document.getElementById('det_subuni').innerHTML=texto;
document.form1.carga.value='N';
document.form1.und.focus();

	document.getElementById("btnInsert").style.display='block';
	document.getElementById("btnupdt").style.display='none';
	
	document.form1.precio.value="";
	document.form1.factor.value="";
		
}

function validar(){

	if(document.form1.factor.value==0){
	alert("Debe ingresar el factor");
	return false;
	}
	if(document.form1.precio.value==0){
	alert("Debe ingresar un precio");
	return false;
	}

return true;
}

function cambiar_enfoque(control){

	if(control.name=="und"){
	
		var temp1="<?php echo $array1?>";
		var temp2="<?php echo $array2?>";
		
		var factorPrin="<?php echo $factor ?>";
		
		temp1=temp1.split("-");
		temp2=temp2.split("-");		
		
		for (i=0;i< temp1.length;i++){
		//alert(temp1[i]);
			if(temp1[i]==control.value && temp2[i]!='' && temp2[i]!='0'){				
				document.form1.factor.value=(temp2[i]/factorPrin).toFixed(5);
			}
		
		}
		
		document.form1.factor.focus();
		document.form1.factor.select();
	
	}
	if(control.name=="factor"){
	
	document.form1.precio.value=document.form1.pre_pr.value*document.form1.factor.value;
	
	document.form1.precio.focus();
	document.form1.precio.select();
	}
	if(control.name=="precio"){

	transSQL('insertar','');
	//document.form1.Submit.focus();
	//document.form1.Submit.select();
	
	}
	
	
}

function iniciar(){
document.form1.und.focus();
var codigo=document.form1.codigo.value;
doAjax('ajax_subuni.php','&peticion=detalle&codigo='+codigo,'res_transSQL','get','0','1','det_subuni','');

}

</script>
