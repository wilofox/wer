<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>

<script language="javascript" src="miAJAXlib2.js"></script>
<script>
  function ponerCeros(obj,i) {
		  while (obj.length<i){
			obj = '0'+obj;
			}
		//	alert(obj);
			return obj;
		}


function validar(){
//document.form1.codigo.value=ponerCeros(document.form1.codigo.value,6);
	if(document.form1.codigo2.value==''){
	return false;
	}
	return true;
}

var temp="";
/*
function entrada(objeto){

	objeto.cells[0].childNodes[0].checked=true;
//	temp=objeto;
	if(objeto.style.background=='url(imagenes/sky_blue_sel.png)'){
//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='url(imagenes/sky_blue_sel.png)';
	document.form1.codigo2.value=objeto.cells[1].innerHTML;
		if(temp!=''){
		temp.style.background=temp.bgColor;
		}
		temp=objeto;
	}
	
}
*/


function entrada(objeto){

	objeto.cells[0].childNodes[0].checked=true;
//	temp=objeto;
	if(objeto.style.background=='url(imagenes/sky_blue_sel.png)'){
//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='url(imagenes/sky_blue_sel.png)';
	document.form1.codigo2.value=objeto.cells[1].innerHTML;
	document.form1.descprod.value=objeto.cells[2].innerHTML;
		if(temp!=''){
		//alert(temp.style.background);
		temp.style.background="#ffffff";
		}
		temp=objeto;
	}
	
}

</script>

<link href="styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
}
.Estilo10 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #FFFFFF; font-weight: bold; }
.Estilo12 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #0066FF;
	font-weight: bold;
}
.Estilo13 {
	font-size: 11px;
	font-family: Arial, Helvetica, sans-serif;
	color: #333333;
}
.Estilo14 {color: #FFFFFF}
.Estilo15 {
	font-size: 11px;
	color: #3366CC;
}
.Estilo18 {
	color: #003366;
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
}
.Estilo20 {
	color: #000000;
	font-weight: bold;
}
.Estilo24 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style></head>

<?php  
include('conex_inicial.php');

$filtro1=" ";
if(isset($_REQUEST['combocategoria']) && $_REQUEST['combocategoria']!=='999'){
$filtro1=" where categoria='".$_REQUEST['combocategoria']."'";
}

$strSQL="select * from producto $filtro1 order by idproducto ";
$resultado=mysql_query($strSQL,$cn);
//echo $strSQL;

while($row=mysql_fetch_array($resultado)){
$array1[] =$row['idproducto'];
$array2[] =$row['nombre'];
//$array1[] =$row['idproducto'];
}

		function php2js ($var) {

			if (is_array($var)) {
				$res = "[";
				$array = array();
				foreach ($var as $a_var) {
					$array[] = php2js($a_var);
				}
				return "[" . join(",", $array) . "]";
			}
			elseif (is_bool($var)) {
				return $var ? "true" : "false";
			}
			elseif (is_int($var) || is_integer($var) || is_double($var) || is_float($var)) {
				return $var;
			}
			elseif (is_string($var)) {
				return "\"" . addslashes(stripslashes($var)) . "\"";
			}
		
			return FALSE;
		}
		
	$js1 = php2js($array1); 
	$js2 = php2js($array2); 	

?>

<script>

var array_codprod=<?php echo $js1 ?>;
var array_nombre=<?php echo $js2 ?>;

//alert(array_codprod[1084]);

	//alert(array_codprod);
var i=0;
//var id=0;

</script>

<body onLoad="cargar();">
<form name="form1" method="get" action="recalculo_ts.php" target="_blank" onSubmit="return validar()">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="22" colspan="2" align="left"  style="background:url(imagenes/white-top-bottom.gif)"><span class="Estilo1 text5 text5 text5 text5 Estilo15"><span class="text5 text5 text5 text5  Estilo18">Administraci&oacute;n :: &Uacute;tiles :: Rec&aacute;lculo de Stocks y Costos
            <label></label>
      </span></span></td>
    </tr>
    <tr>
      <td width="93%" height="45" align="left">
	    <fieldset>
	    <legend><span class="Estilo12">Rec&aacute;lculo por Producto</span></legend>
        <span class="Estilo13"> &nbsp; B&uacute;squeda por Aprox. </span>
        <input name="codigo" type="text" id="codigo" onKeyUp="buscar_prod()" size="20" autocomplete='off'>
        <span class="Estilo13"> &nbsp;
        &nbsp;<span class="Estilo20">Producto</span></span>
		 <input  type="hidden" size="35" name="codigo2" id="codigo2">
		  <input  type="hidden" size="35" name="costos" id="costos" value="costos">
        <input  readonly="readonly" type="text" size="35" name="descprod" id="descprod">
		
        <select name="calcular">
		
          <option value="saldos">Stock</option>
          <option value="costos">Costos</option>
		  <option value="todos">Ambos</option>
		  
        </select>
	    <input type="submit" name="Submit2" style="font:bold" value="Recalcular">
	    </fieldset>		</td>
      <td width="7%" height="45" align="left"></td>
    </tr>
    <tr>
      <td colspan="2" align="left">
	  
	  <table width="735" border="0" cellpadding="0" cellspacing="0">
        <tr  style="background:url(imagenes/bg_contentbase4.gif); background-position:100% 70%;">
          <td width="54" height="21" align="center"><span class="Estilo14 Estilo2"><strong>OK</strong></span></td>
          <td width="75" align="center"><span class="Estilo14 Estilo2"><strong>C&oacute;digo</strong></span></td>
          <td width="453"><span class="Estilo14 Estilo2"><strong>Descripci&oacute;n</strong></span></td>
          <td width="168"><span class="Estilo14 Estilo2"><strong>Unidad</strong></span></td>
        </tr>
        <tr>
          <td colspan="4">
		  <div id="productos" style="width:750px; height:180px; overflow:scroll; border:#CCCCCC solid 1px; background:#F4F4F4" >
		  <table id="lista_productos" width="730" height="24" border="0" cellpadding="0" cellspacing="1">
            <?php 
			
			$strSQL="select *  from producto where kardex='S' order by nombre";
			$resultado=mysql_query($strSQL,$cn);
			while($row=mysql_fetch_array($resultado)){
			?>
			
			<tr style="background:#FFFFFF"  onClick="entrada(this)">
              <td width="53" align="center"><input style="border: none; background:none; " type="radio" name="xproducto" value="<?php echo $row['idproducto']?>" /></td>
              <td width="71" align="center"><?php echo $row['idproducto']?></td>
              <td width="451" style=" color:#333333"><?php echo $row['nombre']?></td>
              <td width="150"><?php echo "unidades" ?></td>
            </tr>	
								
			<?php }?>
			
          </table>
		  </div></td>
          </tr>
        
        <tr>
          <td colspan="4" height="5"></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
	  
	  <div id='pruebas'>	  </div>	  </td>
    </tr>
    <tr>
      <td height="31" colspan="2" align="left">
	  <input onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:130px; vertical-align:top;background-image:url(imagenes/boton_aplicar_g.gif) ; cursor:pointer ; font:bold; font-size:10px; color:#333333" type="button" name="Submit" value="Recalcular Todos" onClick="javascript:insertarFila()" />
	  <span class="Estilo24">
	  
	  <?php //echo "select * from sucursal order by des_suc "; ?> 
	  <select style="width:160"  name="sucursal">
	   <?php 		
		 $resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn);		 		  
		  while($row1=mysql_fetch_array($resultados1))
		  {
		?>
		  <option value="<?php echo $row1['cod_suc'] ?>" > <?php echo $row1['des_suc'] ?></option>
          <?php }?> </select>
	  
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
	  </span> Categor&iacute;as
	  <select style="width:140px" name="combocategoria" onChange="recargar()">					  
					  <option selected="selected" value="999" >--- <?php echo "Todas";?> ---</option>
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
			var valor1="<?php echo $_REQUEST['combocategoria'] ?>";
			var i;
			 for (i=0;i<document.form1.combocategoria.options.length;i++)
			{
			
				if (document.form1.combocategoria.options[i].value==valor1)
				   {
				   
				   document.form1.combocategoria.options[i].selected=true;
				   }
			
			}
	                  </script>
                      </select>
	   </td>
    </tr>
    <tr>
      <td height="44" colspan="2" valign="top"><table id="tabla" width="638" border="0" cellpadding="1" cellspacing="1">
          <tr  style="background:url(imagenes/bg_contentbase4.gif); background-position:100% 70%;">
            <td width="81" height="21" align="center"><span class="Estilo10">C&oacute;digo</span></td>
            <td width="413"><span class="Estilo10">Producto</span></td>
            <td width="152"><span class="Estilo10">Estado</span></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td><a name="ancla" id="ancla"></a></td>
      <td>&nbsp;</td>
    </tr>
  </table>

</form>


</body>
</html>

<script>
var i=0;
function insertarFila() {
try{
  var elmTBODY = document.getElementById('tabla');
  var elmTR;
  var elmText;
  
 // alert(array_codprod); 
    
		 var codigo=array_codprod[i];
		 var nombre=array_nombre[i];
	
		 var rows=document.getElementById('tabla').rows.length;	
	     elmTR = elmTBODY.insertRow(rows);
    
	     var bufferImage= new Image();
		 bufferImage.src = "imagenes/barra.gif";
		 bufferImage.width=191;

        codigo2 = document.createTextNode(codigo);
		nombre3 = document.createTextNode(nombre);
		estado = document.createTextNode(bufferImage);
				
		elmTR.insertCell(0).appendChild(codigo2);
		elmTR.insertCell(1).appendChild(nombre3);
		elmTR.insertCell(2).appendChild(bufferImage);
		
		elmTR.style.fontSize='11px';
		elmTR.style.fontFamily='Verdana,Arial,Helvetica,sans-serif';
		elmTR.style.color='#666666';
		
		 	
		if(rows>=2){
		document.getElementById('tabla').rows[rows-1].cells[2].innerHTML='100% Completado';
		}
		
		if(i>array_codprod.length-2){
		//if(i>1060){
		document.getElementById('tabla').rows[rows].cells[2].innerHTML='100% Completado';
		//alert("Proceso de Recalculo Terminado");
		doAjax('recalculo_ts.php','&codigo2='+codigo+'&codsucursal='+document.form1.sucursal.value,'terminado2','get','0','1','','');
		//alert(codigo);
		return false;
		
		}
		i++;
		
		temp_Codigo=codigo;
		temp_Sucursal=document.form1.sucursal.value;
		
		doAjax('recalculo_ts.php','&codigo2='+codigo+'&codsucursal='+document.form1.sucursal.value+'&calcular=saldos','antes','get','0','1','','');
		
		
		//terminado();
}catch(e){
alert(" No existen productos en la categoria seleccionada ");
}		
							 
}

var temp_Codigo="";
var temp_Sucursal="";

function antes(){

doAjax('recalculo_ts.php','&codigo2='+temp_Codigo+'&codsucursal='+temp_Sucursal+'&calcular=costos','terminado','get','0','1','','');

}


function terminado(texto){
setTimeout("insertarFila()",0.5);
document.location.href='#ancla';
}

function terminado2(texto){
alert("Proceso de Recalculo Terminado");
}


function eliminarFila(Modo) {
  var elmTBODY = document.getElementById('CuerpoTabla');
  if (Modo==0) elmTBODY.deleteRow(2);
  if (Modo==1) elmTBODY.removeChild(elmTBODY.childNodes[2]);
}



function  buscar_prod(){
//var criterio=document.form1.criterio.value;
var criterio="";
doAjax('compras/lista_prod_kardex.php','&valor='+document.form1.codigo.value+'&criterio='+criterio,'mostrar_filtro','get','0','1','','');
}

function mostrar_filtro(texto){
//alert(texto);
document.getElementById('productos').innerHTML=texto;
cargar();
}

function cargar(){
	if(document.getElementById('lista_productos').rows.length > 0){
	document.getElementById('lista_productos').rows[0].style.background='url(imagenes/sky_blue_sel.png)';
	temp=document.getElementById('lista_productos').rows[0];
	document.getElementById('lista_productos').rows[0].cells[0].childNodes[0].checked=true;
	document.form1.codigo2.value=temp.cells[1].innerHTML;
	document.form1.descprod.value=temp.cells[2].innerHTML;
	//document.getElementById('lista_productos').rows[0].cells[0].childNodes[0].focus();
	}else{
	document.getElementById('productos').innerHTML="No se encontraron productos....";
	}
		

}

function cambiar_fondo(control,evento){

if(evento=='e')
control.style.backgroundImage='url(imagenes/boton_aplicar2_g.gif)';
else
control.style.backgroundImage='url(imagenes/boton_aplicar_g.gif)';


}

function recargar(){
document.form1.action="recalculo.php";
document.form1.target="_self";
document.form1.submit();
}


</script>
