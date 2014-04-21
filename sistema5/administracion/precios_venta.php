<?php 
include('../conex_inicial.php');
include ('../funciones/funciones.php');

if(isset($_REQUEST['codigo'])){

$codigo=$_REQUEST['codigo'];
$precio1=$_REQUEST['precio1'];
$precio2=$_REQUEST['precio2'];
$precio3=$_REQUEST['precio3'];
$precio4=$_REQUEST['precio4'];
$precio5=$_REQUEST['precio5'];
$pre_ref=$_REQUEST['preferencial'];
$desc1=$_REQUEST['desc1'];
$desc2=$_REQUEST['desc2'];
$desc3=$_REQUEST['desc3'];
$previo=$_REQUEST['previo'];
$utilidad=$_REQUEST['utilidad'];
$igv=$_REQUEST['igv'];
$moneda=$_REQUEST['moneda'];

	for($i=0; $i<count($precio1);$i++){
	
	$strSQL="update producto set precio='".$precio1[$i]."',precio2='".$precio2[$i]."',precio3='".$precio3[$i]."',precio4='".$precio4[$i]."',precio5='".$precio5[$i]."',pre_ref='".$pre_ref[$i]."',desc1='".$desc1[$i]."',desc2='".$desc2[$i]."',desc3='".$desc3[$i]."',previo='".$previo[$i]."',utilidad='".$utilidad[$i]."',pigv='".$igv[$i]."',moneda='".$moneda[$i]."' where idproducto='".$codigo[$i]."' ";

	
	mysql_query($strSQL,$cn);
	
	
			$strSQL13="select * from unidades order by descripcion";
			$resultado13=mysql_query($strSQL13,$cn);
			
			while($row13=mysql_fetch_array($resultado13)){
			$abrev=$row13['id'];
			$id="precio_sub_".$row13['id'];
			$precio_nuevo=$_REQUEST[$id];
			//echo count($precio_nuevo)."<br>";
			
			$str_upd="update unixprod set precio='".$precio_nuevo[$i]."' where producto='".$codigo[$i]."' and unidad='".$abrev."'";
			mysql_query($str_upd,$cn);
			//echo $str_upd."<br>";
			
			}
			
				
	}

}
	
	
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo6 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color:#333333 }
.Estilo12 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #FFFFFF; font-weight: bold; }
.Estilo34 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
-->
</style>
		<script language="javascript" src="../modulos_usuarios/miAJAXlib3.js"></script>
		 <!-- CSS -->
 	 <link rel="stylesheet" type="text/css" href="estilos.css" media="all" />
	<script language="javascript" type="text/javascript" src="../javascript/jquery-1.3.2.min.js"></script>
	<script language="javascript" type="text/javascript" src="csspopup.js"></script>
		

        <style type="text/css">
<!--
.Estilo36 {color: #99FF00}
.Estilo37 {
	color: #333333;
	font-weight: bold;
	font-size: 10px;
}
.Estilo38 {
	color: #0066CC;
	font-weight: bold;
}
.Estilo39 {color: #333333}
.Estilo42 {color: #CC0000}
.Estilo43 {font-family: Arial, Helvetica, sans-serif}
.Estilo46 {color: #CC3300}
-->
        </style>
</head>


<script>
function iniciar(){
//document.form1.checkbox.style.backgroundImage='url(../img_control/checkbox.gif)';
}
</script>

<link href="../styles.css" rel="stylesheet" type="text/css">

<body onLoad="document.form1.valor.focus(); cargar_lista('');">

<form id="form1" name="form1" method="post" action="">

  <div id="capaPopUp" style="z-index:1;filter:alpha(opacity=40);-moz-opacity:.60;opacity:.60"></div>
     <div id="popUpDiv">
        <div id="capaContent">

<table width="400" height="200" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
	
	<table width="380">
      <tr style="background-image:url(../imagenes/title.png); background-position:100% 40%;">
        <td height="23" colspan="3" style="font:Arial, Helvetica, sans-serif; color:#CC6600; font-size:12px"><table width="388" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="310"><span class="Estilo38">Formulaci&oacute;n Manual</span></td>
            <td width="78" align="right"><table width="29" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td  align="right"><img id="cerrar2" onClick="javascript:void(0)" style="cursor:pointer" src="../imagenes/cerrar.jpg" width="23" height="21"></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td width="3" height="77">&nbsp;</td>
        <td width="363" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#003366"><table width="333" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="20"><input  disabled="disabled" style="background:none; border:none" name="radiobutton" type="radio" value="radiobutton"></td>
            <td width="151"><span class="Estilo39"><strong>PC</strong>: Precio de Costo </span></td>
            <td width="20"><input  style="background:none; border:none" name="radiobutton" type="radio" value="P3-precio3" onClick="sel_radio(this)"></td>
            <td width="142"><span class="Estilo39"><strong>P3</strong>: Precio 3 </span></td>
          </tr>
          <tr>
            <td><input  style="background:none; border:none" name="radiobutton" onClick="sel_radio(this)" type="radio" value="PR-preferencial"></td>
            <td><span class="Estilo39"><strong>PR</strong>:Precio Referencial </span></td>
            <td><input  style="background:none; border:none" name="radiobutton" type="radio" value="P4-precio4" onClick="sel_radio(this)"></td>
            <td><span class="Estilo39"><strong>P4</strong>: Precio 4</span></td>
          </tr>
          <tr>
            <td><input  style="background:none; border:none" name="radiobutton" type="radio" value="P1-precio1" onClick="sel_radio(this)"></td>
            <td><span class="Estilo39"><strong>P1</strong>: Precio 1 </span></td>
            <td><input  style="background:none; border:none" name="radiobutton" type="radio" value="P5-precio5" onClick="sel_radio(this)"></td>
            <td><span class="Estilo39"><strong>P5</strong>: Precio 5 </span></td>
          </tr>
          <tr>
            <td><input  style="background:none; border:none" name="radiobutton" type="radio" value="P2-precio2" onClick="sel_radio(this)"></td>
            <td><span class="Estilo39"><strong>P2</strong>: Precio 2</span></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          
        </table></td>
        <td width="14">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center"><table width="357" height="20" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="64"><input style=" font:bold"  readonly="readonly" name="resultado" type="text" size="5" maxlength="10">
              <span class="Estilo42">=</span></td>
            <td><input name="formula" type="text" size="30" maxlength="100" autocomplete='off'>
              <span class="Estilo43">Ej: P1=P3 * 0.10 </span></td>
            </tr>
        </table></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input style=" font:bold" readonly="readonly" name="resultado2" type="hidden" size="5" maxlength="10"></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center"><input onClick="javascript:void(0);" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(../imagenes/boton_aplicar.gif) ; cursor:pointer" type="button" name="aplicarform" value="Aplicar"  id="anular" >
		
		&nbsp;&nbsp;&nbsp;
		
		<input onClick="javascript:void(0);" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(../imagenes/boton_aplicar.gif) ; cursor:pointer" type="button" name="cerrarform" value="Cancelar"  id="cerrar" >
		
	</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</div>
</div>
</div>
<!--<div id="wrapper">-->


  <table width="750" border="0" cellpadding="0" cellspacing="0">
    <tr style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="16" height="27">&nbsp;</td>
      <td width="760"><span class="Estilo34"> Administraci&oacute;n :: Organizar Precios de Venta <span class="Estilo46">(Incluido IGV)</span></span>      </td>
    </tr>
    <tr >
      <td>&nbsp;</td>
      <td style="padding-top:5px; padding-bottom:5px"><fieldset>
	  
        <table width="750" border="0" cellpadding="0" cellspacing="0">
          <tr style="background-image:url(../imagenes/topgradient.jpg)">
            <td width="224" height="24" ><span class="Estilo37">Sucursal:</span>              <select style="width:160"  name="sucursal"  id="sucursal" onChange="cargar_lista('')">
                  <?php 
		
  $resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn); 
while($row1=mysql_fetch_array($resultados1))
{
		?>
                  <option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
                  <?php }?>
            </select></td>
            <td width="20" ><input style="background:none; border:none" type="checkbox" name="ver_formula" value="checkbox" onClick="mostrar_formula(this)"></td>
            <td width="81" ><span class="Estilo39">Mostrar F&oacute;rmula </span></td>
            <td width="20" ><input onClick="mostrar_adicionales(this)" name="ver_formula2" type="checkbox" class="Estilo39" style="background:none; border:none" value="checkbox"></td>
            <td width="159" ><span class="Estilo39">Mostrar Columnas Adicionales </span></td>
            <td width="220" >
			<span class="Estilo39" style="visibility:visible" >
			<input onClick="mostrar_subunidades2(this)" name="ver_formula22" type="checkbox" class="Estilo39" style="background:none; border:none; " value="checkbox">
            Mostrar Sub-Unidades </span></td>
            <td width="42">&nbsp;</td>
          </tr>
          <tr style="background-image:url(../imagenes/topgradient.jpg)">
            <td height="24" colspan="7" ><strong>
              <!-- <input type="submit" name="Submit2" value="Consultar">-->
              </strong>
                <table width="766" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="36"><span class="Estilo29"><span class="Estilo37">Buscar</span>:</span></td>
                    <td width="126"  align="left"><strong>
                      <select name="criterio" style="width:120px">
                        <option value="idproducto">C&oacute;digo Sistema</option>
                        <option value="nombre" selected>Descripci&oacute;n</option>
                        <option value="cod_prod">Codigo anexo</option>
                      </select>
                    </strong></td>
                    <td width="165" align="right"><input autocomplete="off" name="valor" id="valor" type="text"  style="height:20; border-color:#CCCCCC" size="25" maxlength="100" onKeyUp="cargar_lista('')"></td>
                    <td width="19" align="right"><img src="../imagenes/lupa5.gif" width="18" height="20"></td>
                    <td width="140" align="right"><select style="width:140px" name="clasificacion" onChange="cargar_lista('')" >
                        <option selected="selected" value="999">--- <?=$CatgNomEti1;?> ---</option>
                        <?php 
	  
	    $resultados0 = mysql_query("select * from clasificacion order by des_clas ",$cn);
			 // echo "resultado".$resultado;
			  
while($row0=mysql_fetch_array($resultados0))
{
		
	  ?>
                        <option value="<?php echo $row0['idclasificacion']?>"><?php echo $row0['des_clas']?></option>
                        <?php 
	 }
	  ?>
                        <script>
	   var valor1="<?php echo $clasificacion?>";
     var i;
	 for (i=0;i<document.form1.clasificacion.options.length;i++)
        {
		
            if (document.form1.clasificacion.options[i].value==valor1)
               {
			   
               document.form1.clasificacion.options[i].selected=true;
               }
        
        }
	                  </script>
                    </select></td>
                    <td width="140" align="left"><select style="width:140px" name="combocategoria" onChange="cargar_lista('')">
                        <option selected="selected" value="999">--- <?=$CatgNomEti2;?> ---</option>
                        <?php 
	  
	    $resultados0 = mysql_query("select * from categoria order by des_cat ",$cn);
			 // echo "resultado".$resultado;
			  
while($row0=mysql_fetch_array($resultados0))
{
		
	  ?>
                        <option value="<?php echo $row0['idCategoria']?>"><?php echo $row0['des_cat']?></option>
                        <?php 
	 }
	  ?>
                        <script>
			var valor1="<?php echo $categoria?>";
			var i;
			 for (i=0;i<document.form1.combocategoria.options.length;i++)
			{
			
				if (document.form1.combocategoria.options[i].value==valor1)
				   {
				   
				   document.form1.combocategoria.options[i].selected=true;
				   }
			
			}
	                  </script>
                    </select></td>
                    <td width="140" align="left"><select style="width:140px" name="combosubcategoria" onChange="cargar_lista('')">
                        <option selected="selected" value="999">--- <?=$CatgNomEti3;?> ---</option>
                        <?php 
	  
	    $resultados0 = mysql_query("select * from subcategoria order by des_subcateg ",$cn);
			 // echo "resultado".$resultado;
			  
while($row0=mysql_fetch_array($resultados0))
{
		
	  ?>
                        <option value="<?php echo $row0['idsubcategoria']?>"><?php echo $row0['des_subcateg']?></option>
                        <?php 
	 }
	  ?>
                        <script>
	   var valor1="<?php echo $subcategoria?>";
     var i;
	 for (i=0;i<document.form1.combosubcategoria.options.length;i++)
        {
		
            if (document.form1.combosubcategoria.options[i].value==valor1)
               {
			   
               document.form1.combosubcategoria.options[i].selected=true;
               }
        
        }
	                  </script>
                    </select></td>
                  </tr>
              </table></td>
          </tr>
          <tr style="background-image:url(../imagenes/topgradient.jpg)">
            <td height="24" colspan="7" ><input type="button" name="Submit3" value="Guardar Cambios" onClick="guardar()">
              <input type="button" name="Submit23" value="Recalcular Precios" onClick="recalcular()" >
              <input  id="abrirPop" type="button" name="Submit222" value="F&oacute;rmula "  onClick="javascript:void(0)" ></td>
          </tr>
        </table>
      </fieldset></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>	      
  <div id='lista_precios' >

  </div>	
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>

	

</body>
</html>


<script>
function guardar(){
document.form1.submit();
}
/*function guardar(){
alert(document.form1.precio1.length);
}*/

function entradae(objeto){
//document.getElementById('prueba').value=objeto.style.background;
//alert(objeto.innerHTML);
		
	if(document.activeElement.type=='text'){
	return false;	
	}
	
	if(objeto.style.background=='#fff1bb'){
//	alert('rrr');
	objeto.style.background=objeto.bgColor;
	objeto.cells[0].childNodes[0].checked=false;
	}else{
	objeto.style.background='#FFF1BB';
	objeto.cells[0].childNodes[0].checked=true;
	}
	
	//alert(objeto.cells[0].childNodes[1].value);
	
	
//document.getElementById('prueba').value=objeto.style.background;
//est=0;
}

//function cargar_lista(){
function cargar_lista(pagina){

document.form1.ver_formula.checked=false;
document.form1.ver_formula2.checked=false;

var sucursal=document.form1.sucursal.value;
var criterio=document.form1.criterio.value;
var valor=document.form1.valor.value;
var clasificacion=document.form1.clasificacion.value;
var categoria=document.form1.combocategoria.value;
var subcategoria=document.form1.combosubcategoria.value;

doAjax('ajax_admin.php','&peticion=lista&sucursal='+sucursal+'&valor='+valor+'&criterio='+criterio+'&clasificacion='+clasificacion+'&categoria='+categoria+'&subcategoria='+subcategoria+'&pagina='+pagina,'res_lista','get','0','1','lista_precios','');

}

function res_lista(texto){
document.getElementById('lista_precios').innerHTML=texto;
}

function sel_radio(control){

var temp=control.value.split("-");
document.form1.resultado.value=temp[0];
document.form1.resultado2.value=temp[1];

}


function aplicar_formula(){

	for(var i=0;i<document.form1.chk.length;i++){
	
		if(document.form1.chk[i].checked){

		  var resultado=document.form1.resultado2.value;
		
		  var temp=0;
		  
		  temp=document.form1.formula.value;
		    
		  temp=temp.replace("PC",document.form1.pcosto[i].value);
		  temp=temp.replace("PR",document.form1.preferencial[i].value);
		  temp=temp.replace("P1",document.form1.precio1[i].value);
		  temp=temp.replace("P2",document.form1.precio2[i].value);
		  temp=temp.replace("P3",document.form1.precio3[i].value);
		  temp=temp.replace("P4",document.form1.precio4[i].value);
		  temp=temp.replace("P5",document.form1.precio5[i].value);
		//temp=document.form1.formula.value.replace("P6",document.form1.pcosto[i].value);
		//temp=document.form1.formula.value.replace("P7",document.form1.pcosto[i].value);

			 
			var temp2=eval(temp).toFixed(3);
		//	alert(temp2);
			
		  eval("document.form1."+resultado+"["+i+"].value="+temp2+".toFixed(2)");
		  
		 		  
		  
		  		
		}
	
	}


}

function cambiar_fondo(control,evento){

	if(evento=='e')
	control.style.backgroundImage='url(../imagenes/boton_aplicar2.gif)';
	else
	control.style.backgroundImage='url(../imagenes/boton_aplicar.gif)';

}

function mostrar_formula(control){


	var obj=document.getElementById('celda_formu');
	var registros=document.getElementById('tbl_lista').rows.length-2;
	//alert(registros);//tbl_lista
		
	if(control.checked){
		document.getElementById('celda_formu').style.display='block';
		for(var i=1;i<=registros;i++){
		document.getElementById('celda_formu'+i).style.display='block';
		}
	}else{
		document.getElementById('celda_formu').style.display='none';
		for(var i=1;i<=registros;i++){
		document.getElementById('celda_formu'+i).style.display='none';
		}
	}

}

function mostrar_adicionales(control){

	var registros=document.getElementById('tbl_lista').rows.length-2;
		
	if(control.checked){
		document.getElementById('tbl_lista').width=parseFloat(document.getElementById('tbl_lista').width) + 360;
		
		document.getElementById('descuento1').style.display='block';
		document.getElementById('descuento2').style.display='block';
		document.getElementById('descuento3').style.display='block';
		document.getElementById('cel_previo').style.display='block';
		document.getElementById('cel_utilidad').style.display='block';
		document.getElementById('cel_igv').style.display='block';
		
		for(var i=1;i<=registros;i++){
		document.getElementById('descuento1'+i).style.display='block';
		document.getElementById('descuento2'+i).style.display='block';
		document.getElementById('descuento3'+i).style.display='block';
		document.getElementById('cel_previo'+i).style.display='block';
		document.getElementById('cel_utilidad'+i).style.display='block';
		document.getElementById('cel_igv'+i).style.display='block';
		}
		document.getElementById('copiar_desc1').style.display='block';
		document.getElementById('copiar_desc2').style.display='block';
		document.getElementById('copiar_desc3').style.display='block';
		document.getElementById('copiar_utilidad').style.display='block';
		document.getElementById('copiar_igv').style.display='block';
		
		
	}else{	
		document.getElementById('tbl_lista').width=parseFloat(document.getElementById('tbl_lista').width) - 360;
		
		document.getElementById('descuento1').style.display='none';
		document.getElementById('descuento2').style.display='none';
		document.getElementById('descuento3').style.display='none';
		document.getElementById('cel_previo').style.display='none';
		document.getElementById('cel_utilidad').style.display='none';
		document.getElementById('cel_igv').style.display='none';
		for(var i=1;i<=registros;i++){
		document.getElementById('descuento1'+i).style.display='none';
		document.getElementById('descuento2'+i).style.display='none';
		document.getElementById('descuento3'+i).style.display='none';
		document.getElementById('cel_previo'+i).style.display='none';
		document.getElementById('cel_utilidad'+i).style.display='none';
		document.getElementById('cel_igv'+i).style.display='none';
		}
		document.getElementById('copiar_desc1').style.display='none';
		document.getElementById('copiar_desc2').style.display='none';
		document.getElementById('copiar_desc3').style.display='none';
		document.getElementById('copiar_utilidad').style.display='none';
		document.getElementById('copiar_igv').style.display='none';
	}

}


function mostrar_subunidades(control){

	
	if(control.checked){	
	var registros=document.getElementById('tbl_lista').rows.length-2;
	var arrayund= unidades.split('-');
	alert(document.getElementById('tbl_lista').width);
	document.getElementById('tbl_lista').width=parseFloat(document.getElementById('tbl_lista').width + 60*(arrayund.length-1));
	
	
	for(var j=0;j<arrayund.length-1;j++){
		document.getElementById('cel_subund'+arrayund[j]).style.display='block';
		for(var i=0;i<registros;i++){
		document.getElementById('cel_subund'+arrayund[j]+i).style.display='block';
		}
	}
	
	}else{
	
	
	}


}


function calcular_p1(control,e){

	if(e.keyCode==13 || e==13){
	
	var numero=control.parentNode.parentNode.cells[5].id.substring(16,18);
	var temp=control.value;
		
	if(document.form1.desc1[numero-1].value!=0 && document.form1.desc1[numero-1].value!=""){
	temp=temp-temp*document.form1.desc1[numero-1].value/100;
	}
	
	if(document.form1.desc2[numero-1].value!=0 && document.form1.desc2[numero-1].value!=""){
	temp=temp-temp*document.form1.desc2[numero-1].value/100;
	}
	
	if(document.form1.desc3[numero-1].value!=0 && document.form1.desc3[numero-1].value!=""){
	temp=temp-temp*document.form1.desc3[numero-1].value/100;
	}
		
	document.form1.previo[numero-1].value=(temp).toFixed(2);
	//alert();
	document.form1.precio1[numero-1].value=(parseFloat(document.form1.previo[numero-1].value) + parseFloat(document.form1.utilidad[numero-1].value) + parseFloat(document.form1.igv[numero-1].value)).toFixed(2);
	}

}
//esta a punto de reemplazar todos los valores de la columna ... por este valor  , aceptar o cancelar 

function copiar_valor(control){

var nombre=control.name.substring(4,control.name.length);
var registros=document.getElementById('tbl_lista').rows.length-2;

var valor=eval("document.form1.temp_"+nombre+".value");

if(valor==""){
alert('Debe presionar enter en la celda que quiere copiar');
return false;
}
//alert(valor);
	
	for(var i=0;i<registros;i++){
	eval("document.form1."+nombre+"[i].value=parseFloat(valor).toFixed(2)");
	}
	
}

function cambiar_temp(control,e){
	
	if(e.keyCode==13){
	var nombre=control.name.substring(0,control.name.length-2);
	eval("document.form1.temp_"+nombre+".value=control.value");
	
	}
	
}

function recalcular(){
	
	for(var i=0;i<document.form1.chk.length;i++){
	
		if(document.form1.chk[i].checked){
		calcular_p1(document.form1.preferencial[i],13);
		
		}
		
	}

}

function marcar_checks(){

	for(var i=0;i<document.form1.chk.length;i++){
		if(document.form1.marcar_all.checked){
		document.form1.chk[i].checked=true;
		//objeto.style.background='#FFF1BB';
		}else{
		document.form1.chk[i].checked=false;
		}
		
	}
}

function color_fondo(control){
	
	if(control.style.background!='#82eead'){
	control.style.background='#82EEAD';
	}else{
	control.style.background='#FFFFFF';
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

</script>