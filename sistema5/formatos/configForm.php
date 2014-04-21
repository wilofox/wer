<?php 
session_start();
include ('../conex_inicial.php'); 
include('../numero_letras.php');

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editor de Formatos</title>
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
	font-size: 12px;
}
.Estilo2 {font-size: 12px}
.Estilo27 {font-size: 12px; color: #0066CC; }

/*#resizable { width: 150px; height: 150px; padding: 0.5em; }*/

-->
</style></head>
	<link rel="stylesheet" href="../jqueryUI/jquery.ui.all.css">
	<script src="../jqueryUI/jquery-1.8.0.js"></script>
	<script src="../jqueryUI/jquery.ui.core.js"></script>
	<script src="../jqueryUI/jquery.ui.widget.js"></script>
	<script src="../jqueryUI/jquery.ui.mouse.js"></script>
	<script src="../jqueryUI/jquery.ui.draggable.js"></script>
	<script src="../jqueryUI/jquery.ui.resizable.js"></script>
	
	<link rel="stylesheet" href="../jqueryUI/demos.css">
	
	<script language="javascript" src="../Finanzas/miAJAXlib3.js"></script>
	
	 <script src="../jquery.hotkeys.js"></script>
	 
<script>

	jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_esc').addClass('dirty'); 
	
	
	deselDiv();
			
	return false; });

	$(function() {	
	
	<?php 
	$strSQL= "select * from formatos where doc='BV'" ;
	$resultado = mysql_query ($strSQL,$cn);
	while($row = mysql_fetch_array ($resultado)){
	?>
		$( "#<?php echo $row['descripcion']; ?>" ).draggable();
		$( "#<?php echo $row['descripcion']; ?>" ).resizable();
	
	<?
	}
	?>	
		
	});

</script>
<body >
<?php 

$margen=0;
echo "<div id='campos' style='left:200px; position:absolute;width:75%;height:90%; overflow=scroll'>";
/*
$strSQL= "select * from formatos where doc='BV'" ;
$resultado = mysql_query ($strSQL,$cn);
while($row = mysql_fetch_array ($resultado)){

echo "<div class='ui-widget-content' id='".$row['descripcion']."' style='border:#333333 solid 1px;width:".$row['ancho'].";height:".$row['alto']."; top:".$row['coordy']."; left:".($margen+$row['coordx'])."; position: absolute; cursor:move; z-index:1' onMouseMove='controlDiv(this)'  >".$row['descripcion']."</div>";
//onMouseMove='moverDiv(this)'
}
*/
echo "</div>";
?>
<!--<input name="posi" type="text" onClick="posDiv();" >-->


<div  style="height:110%; width:200px; border:#999999 solid 1px; z-index:9999999" >
  <table width="197" height="396" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="24" colspan="3" align="center" bgcolor="#0683FF"><span class="Estilo1">Formatos</span></td>
    </tr>
    <tr>
      <td height="22">&nbsp;</td>
      <td><span class="Estilo2">Empresa:</span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="10" height="22">&nbsp;</td>
      <td width="176"><select style="width:180"  name="sucursal" id="sucursal" >
          
          <?php 
		
		 $resultados1 = mysql_query("select * from sucursal order by cod_suc ",$cn);
		 
		  
		while($row1=mysql_fetch_array($resultados1))
		{
		?>
          <option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['cod_suc']." - ".$row1['des_suc'] ?></option>
          <?php }?>
        </select>
      </span></td>
      <td width="11">&nbsp;</td>
    </tr>
    <tr>
      <td height="22">&nbsp;</td>
      <td><span class="Estilo2">Caja/PC:</span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="22">&nbsp;</td>
      <td><select style="width:180"  name="codigoPC" id="codigoPC" >
	  <option value="0"></option>
        <?php 
		
		 $resultados1 = mysql_query("select * from caja order by pc ",$cn);
		 
		  
		while($row1=mysql_fetch_array($resultados1))
		{
		?>
        <option value="<?php echo $row1['codigo'] ?>"><?php echo $row1['codigo']."-".$row1['pc'] ?></option>
        <?php }?>
      </select></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="22">&nbsp;</td>
      <td><span class="Estilo2">Documento:</span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="22">&nbsp;</td>
      <td><span style="width:140px">
      <select style="width:180" name="doc" id="doc"  onChange="cambiarDoc()" >
        <option value="0"></option>
        <?php 
		//$resultados10 = mysql_query("select * from operacion where  codigo!='TS'  and tipo='2' and reservado!='' order by descripcion ",$cn);
		   $resultados10 = mysql_query("select * from operacion where  codigo!='TS'  and tipo='2' and reservado!='' UNION select codigo,'3' as tipo,descripcion,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,formato,cola,NULL,'N' as reservado,NULL,NULL,NULL,NULL from t_pago order by tipo,descripcion ",$cn); 
			while($row10=mysql_fetch_array($resultados10))
			{
			/*<option value="<?php echo $row10['codigo']?>"><?php echo $row10['codigo']." - ".$row10['descripcion']?></option>*/
		  ?>
        <option value="<?php echo $row10['codigo']."-".$row10['tipo'];?>"><?php echo $row10['codigo']." - ".$row10['descripcion']?></option>
        <?php }?>
      </select>
      </span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="22">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="22">&nbsp;</td>
      <td><span class="Estilo2"><strong>Campo:</strong> 
        <input name="campoAct" type="text" id="campoAct" size="15"  style=" font-weight:bold; color:#FF0000; border:none; background:none" >
      </span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="22">&nbsp;</td>
      <td><span class="Estilo2">Cordenadas:</span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>x:
        <input  name="posix" type="text" id="posix" size="5" onKeyUp="editCoor(event)"  > 
        y :
        <input  name="posiy" type="text" id="posiy" size="5"  onKeyUp="editCoor(event)" ></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="Estilo2">Dimensiones : </span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>w:
        <input name="ancho" type="text" id="ancho" size="5" onKeyUp="editDimen(event)"  >
        h:
        <input  name="alto" type="text" id="alto" size="5" onKeyUp="editDimen(event)"  ></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="56">&nbsp;</td>
      <td>
	  <form  name="form1" id="form1">
	  <fieldset>
      <legend>CAMPOS</legend>
	  <div style="width:165px; height:150px; overflow-y:scroll" id="camposDisp">		</div>  
      </fieldset></form>	  </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="left" style=" padding-right:10px"><div align="right"><span class="Estilo2">Tamaño Fuente </span>:
          <input  name="fontsize" type="text" id="fontsize" size="5"  >
      </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="left" style=" padding-right:10px"><div align="right"><span class="Estilo2"> Fuente </span>:
        <select name="fuente" id="fuente">
          <option value="1">Arial</option>
          <option value="2">Times New</option>
          <option value="3">Verdana</option>
		  <option value="4">Courier New</option>
		  <option value="5">Draft Condensed</option>
        </select>
</div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="left" style=" padding-right:10px"><div align="right"><span class="Estilo2"> Espacio Caract </span>:
          <input name="separacion" id="separacion" type="text" size="5">
</div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="left" style=" padding-right:10px"><div align="right"><span class="Estilo2">Altura Doc. 
        <input  name="alturaDoc" type="text" id="alturaDoc" size="5"  >
      </span></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="left" style=" padding-right:10px"><div align="right"><span class="Estilo2">Ancho Doc.
            <input  name="anchoDoc" type="text" id="anchoDoc" size="5"  >
      </span></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right" style=" padding-right:10px"><span class="Estilo2">Altura Items.
          <input  name="alturaItems" type="text" id="alturaItems" size="5"  >
      </span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right" style=" padding-right:10px"><div align="right"><div align="right"><span class="Estilo2">Decimales:</span>
        <select name="decimales" id="decimales" style="width:65px; ">
          <option value="1">1</option>
          <option value="2" >2</option>
          <option value="3">3</option>
          <option value="4" selected>4</option>
        </select>
      </span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right" style=" padding-right:10px"><span class="Estilo2">Campo Nuevo
          <input name="camponew" id="camponew" type="text" size="10">
      </span></td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td align="left" style=" padding-right:10px">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center"><input type="button" name="Submit" value="Guardar Cambios" onClick="save();"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td><img src="../imgenes/eliminar.png" width="16" height="16"><span class="Estilo27"> <a style="cursor:pointer" onClick="eliminarForm()">Eliminar Formato</a> </span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><fieldset>
          <legend>Copiar Formato A: </legend>
          <table width="174" height="100" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="164" height="22"><span class="Estilo2">Emp: 
                </span>                <select style="width:140"  name="sucursal2" id="sucursal2" >
                  <?php 
		
		 $resultados1 = mysql_query("select * from sucursal order by cod_suc ",$cn);
		 
		  
		while($row1=mysql_fetch_array($resultados1))
		{
		?>
                  <option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['cod_suc']." - ".$row1['des_suc'] ?></option>
                  <?php }?>
                </select></td>
            </tr>
            <tr>
              <td height="22"><span class="Estilo2">Doc: <span style="width:140px">
                <select style="width:140" name="doc2" id="doc2" >
                  <option value="0"></option>
                  <?php 
		   $resultados10 = mysql_query("select * from operacion where  codigo!='TS'  and tipo='2' and reservado!='' UNION select codigo,'3' as tipo,descripcion,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,formato,cola,NULL,'N' as reservado,NULL,NULL,NULL,NULL from t_pago order by tipo,descripcion",$cn); 
			while($row10=mysql_fetch_array($resultados10))
			{
					
		  ?>
                  <option value="<?php echo $row10['codigo']."-".$row10['tipo'];?>"><?php echo $row10['codigo']." - ".$row10['descripcion']?></option>
                  <?php }?>
                </select>
              </span></span></td>
            </tr>
            <tr>
              <td height="22" align="left"><span class="Estilo2"> Pc :</span>
                <select style="width:140"  name="codigoPC2" id="codigoPC2" >
                <option value="0"></option>
                <?php 
		
		 $resultados1 = mysql_query("select * from caja order by pc ",$cn);
		 
		  
		while($row1=mysql_fetch_array($resultados1))
		{
		?>
                <option value="<?php echo $row1['codigo'] ?>"><?php echo $row1['codigo']."-".$row1['pc'] ?></option>
                <?php }?>
              </select></td>
            </tr>
            <tr>
              <td height="12" align="center"></td>
            </tr>
            <tr>
              <td height="22" align="center"><input type="button" name="Submit2" value="Copiar" onClick="savecopiar();"></td>
            </tr>
          </table>
      </fieldset> </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>

</body>
</html>

<script>

function posDiv(){

capas=document.getElementsByTagName('div');
	for (i=0;i<capas.length;i++){
	
	var elemento = $("#"+capas[i].id);
	var posicion = elemento.position();
	
	//alert(capas[i].id);
	//alert( "left: " + posicion.left + ", top: " + posicion.top );
	alert(capas[i].id+"-"+posicion.left+"-"+posicion.top);
//	document.getElementById("posi").value=posicion.left;
	
	}


}

function controlDiv(c){
	var elemento = $("#"+c.id);
	var posicion = elemento.position();
		//alert(posicion.left);	
	document.getElementById("campoAct").value=c.id;
	document.getElementById("posix").value=posicion.left;
	document.getElementById("posix").value=posicion.left;
	document.getElementById("posiy").value=posicion.top;
	document.getElementById("ancho").value=elemento.width();
	document.getElementById("alto").value=elemento.height();
	
	if(posicion.left<=200){
	//$("#"+c.id).draggable( "disable" );
	//$("#"+c.id).position().left="200px";
	//alert(c._x);
	//document.getElementById(c.id).style.left="200px";
	//c._x="200px";
	}

}

function cambiarDoc(control){
//var doc=document.getElementById("doc").value;
var temp=document.getElementById("doc").value.split('-');
var tipo=temp[1];
var doc=temp[0];
var sucursal=document.getElementById("sucursal").value;
var codigoPC=document.getElementById("codigoPC").value;

doAjax('../peticion_ajax5.php','&doc='+doc+'&tipo='+tipo+'&peticion=cargaFormato&sucursal='+sucursal+'&codigoPC='+codigoPC,'rpta_cambiarDoc','get','0','1','','');
}

var temp2="";

function rpta_cambiarDoc(data){
//alert(data);
var temp=data.split("|");
document.getElementById("campos").innerHTML=temp[0];
temp2=temp[1].split("-");

		for(var i=1; i<temp2.length;i++){
			//alert(temp2[i]);	
			
			$( "#"+temp2[i] ).draggable();
			$( "#"+temp2[i] ).resizable();
		}



document.getElementById("fontsize").value=temp[2];
document.getElementById("alturaDoc").value=temp[3];
document.getElementById("fuente").value=temp[4];
document.getElementById("separacion").value=temp[5];
document.getElementById("anchoDoc").value=temp[6];
document.getElementById("alturaItems").value=temp[7];
document.getElementById("decimales").value=temp[8];


document.getElementById("camposDisp").innerHTML=temp[9];
}

function save(){

//alert(temp2);
var acumulador="";
var acumulador2="";
var sucursal=document.getElementById("sucursal").value;
var fontsize1=document.getElementById("fontsize").value;
var alturaDoc=document.getElementById("alturaDoc").value;
var separacion=document.getElementById("separacion").value;
var fuente=document.getElementById("fuente").value;
var anchoDoc=document.getElementById("anchoDoc").value;
var decimales=document.getElementById("decimales").value;

var alturaItems=document.getElementById("alturaItems").value;
var codigoPC=document.getElementById("codigoPC").value;
var camponew=document.getElementById("camponew").value;


		for(var i=1; i<temp2.length;i++){				
			var elemento = $("#"+temp2[i]);
			var posicion = elemento.position();		
				
			var posx=posicion.left-<?php echo $margen;?>;
			var posy=posicion.top;
			var width=elemento.width();
			var height=elemento.height();
			
			  for(var x=0;x<document.form1.checkbox.length;x++){
				 if(document.form1.checkbox[x].value==temp2[i] && document.form1.checkbox[x].checked){
				  acumulador=acumulador+"|"+temp2[i]+"-"+posx+"-"+posy+"-"+width+"-"+height;
				 }
			  }			
			
		}
		
		
		var acumulador3="";
		
		for(var x=0;x<document.form1.checkbox.length;x++){
			 	
				 var tempB=1;
						 
				 if(document.form1.checkbox[x].checked){
					var tempB=0;
					
					for(var i=1; i<temp2.length;i++){				
					 var elemento = $("#"+temp2[i]);
					 var posicion = elemento.position();	
								
						//alert(document.form1.checkbox[x].value+" "+temp2[i]);		
						 if(document.form1.checkbox[x].value==temp2[i]){
							 
							 var tempB=1;
							 
							 var posx=posicion.left-<?php echo $margen;?>;
							 var posy=posicion.top;
							 var width=elemento.width();
							 var height=elemento.height();	
						 }
				 
					}//end for
			
				}//end if
				
				//alert(tempB);
				if(tempB==0){

					  ///acumulador=acumulador+"|"+document.form1.checkbox[x].value+"-"+posx+"-"+posy+"-"+width+"-"+height;
					  
					  acumulador3=acumulador3+"|"+document.form1.checkbox[x].value;
					  
				}
				
		}
		 
		//alert(acumulador);

		//var doc=document.getElementById("doc").value;
		
		var temp=document.getElementById("doc").value.split('-');
		var tipo=temp[1];
		var doc=temp[0];
		
		
	/*	 for(var x=0;x<document.form1.checkbox.length;x++){
			 if(document.form1.checkbox[x].checked){
			 acumulador2=acumulador2+"-"+document.form1.checkbox[x].value;
			 }
		 }
		
		//alert(acumulador);
		
		if(acumulador!=''){
			acumulador2='';
		}
		
		
			
		acumulador=acumulador+"~"+acumulador2;*/
		
		
		
	//alert(acumulador+"<----->"+acumulador3);	
	
	var cociente=Math.floor(parseFloat(acumulador.length/4));
	var residuo=parseFloat(acumulador.length%4);
	//alert(acumulador.length+"<--->"+cociente+"<--->"+residuo);
	var cadena1=acumulador.substr(0,cociente);
	var cadena2=acumulador.substr(cociente*1,cociente);
	var cadena3=acumulador.substr(cociente*2,cociente);
	var cadena4=acumulador.substr(cociente*3,cociente);
	var cadena5=acumulador.substr(cociente*4,residuo);
	//alert(parseFloat(tempNum)+1);
	//var cadena2=acumulador.substring(parseFloat(tempNum),acumulador.length);
		
	//alert(acumulador);
	//alert(acumulador+"<---->"+cadena1+" <---->"+cadena2+" <---->"+cadena3+" <---->"+cadena4+" <---->"+cadena5);
	
	
	doAjax('../peticion_ajax5.php','&doc='+doc+'&tipo='+tipo+'&peticion=saveFormato&cadena1='+cadena1+'&cadena2='+cadena2+'&cadena2='+cadena2+'&cadena3='+cadena3+'&cadena4='+cadena4+'&cadena5='+cadena5+'&sucursal='+sucursal+'&fontsize1='+fontsize1+'&alturaDoc='+alturaDoc+'&separacion='+separacion+'&fuente='+fuente+'&anchoDoc='+anchoDoc+'&alturaItems='+alturaItems+'&acumulador3='+acumulador3+'&codigoPC='+codigoPC+'&decimales='+decimales+'&camponew='+camponew,'rpta_save','get','0','1','','');
	
	

}

function rpta_save(data){
	//alert(data);
	
	if(data=='existe'){
	alert("Campo nuevo ya existe");
	return false;
	}
	
alert("Se guardaron los cambios");
document.getElementById("camponew").value="";
cambiarDoc();
}

function savecopiar(){
	var sucursal2=document.getElementById("sucursal2").value;
	var sucursal=document.getElementById("sucursal").value;
	var temp=document.getElementById("doc").value.split('-');
	var tipo=temp[1];
	var doc=temp[0];
	var temp2=document.getElementById("doc2").value.split('-');
	var tipo2=temp2[1];
	var doc2=temp2[0];
	//var doc=document.getElementById("doc").value;
	//var doc2=document.getElementById("doc2").value;
	var codigoPC=document.getElementById("codigoPC").value;
	var codigoPC2=document.getElementById("codigoPC2").value;
		
		if(confirm("Esta seguro que desea copiar este documento ?")){
				
		}else{
		return false;
		}
		
	doAjax('../peticion_ajax5.php','&doc='+doc+'&tipo='+tipo+'&peticion=saveCopiaForm&sucursal='+sucursal+'&sucursal2='+sucursal2+'&tipo2='+tipo2+'&doc2='+doc2+'&codigoPC='+codigoPC+'&codigoPC2='+codigoPC2,'rpta_savecopia','get','0','1','','');
}

function rpta_savecopia(data){
location.href="configForm.php";
}

function eliminarForm(){	
	
	var sucursal2=document.getElementById("sucursal2").value;
	var sucursal=document.getElementById("sucursal").value;
	//var doc=document.getElementById("doc").value;
	var temp=document.getElementById("doc").value.split('-');
	var tipo=temp[1];
	var doc=temp[0];
	var codigoPC=document.getElementById("codigoPC").value;
	//alert(doc);
	if(doc=='0'){
	alert("Tiene que seleccionar un documento");
	return false;
	}
	
	doAjax('../peticion_ajax5.php','&doc='+doc+'&tipo='+tipo+'&peticion=eliminarForm&sucursal='+sucursal+'&codigoPC='+codigoPC,'rpta_eliminarForm','get','0','1','','');

}

function rpta_eliminarForm(data){

location.href="configForm.php";

}


function selecDiv(obj){
//alert();
	if(obj.style.background=='rgb(230, 197, 6)'){
	
	obj.style.background='';
	}else{
	obj.style.background='#E6C506';
	}


}

var posTempX=0;
var posTempY=0;

function entrarDiv(obj){
//alert(1);


	var elemento = $("#"+obj.id);
	var posicion = elemento.position();
		//alert(posicion.left);	
	//document.getElementById("campoAct").value=c.id;
	posTempX=parseFloat(posicion.left);
	posTempY=parseFloat(posicion.top);
	
	//alert(posTempX+" "+posTempY);


}

function salirDiv(obj){
//alert(2);

	var elemento = $("#"+obj.id);
	var posicion = elemento.position();
	
	if((posicion.left!=posTempX || posicion.top!=posTempY) && obj.style.background=='rgb(230, 197, 6)'){
	//alert();
	
	var difX=parseFloat(posicion.left)-posTempX;
	var difY=parseFloat(posicion.top)-posTempY;
	
	
		for(var i=1; i<temp2.length;i++){
			//alert(temp2[i]);	
			
			//alert(temp2[i]);
			if(eval("document.getElementById('"+temp2[i]+"').style.background=='rgb(230, 197, 6)'") && obj.id!=temp2[i] ){
			
			//alert();
			
			var elemento2 = $("#"+temp2[i]);
			var posicion2= elemento2.position();
			
			//alert(posicion2.left+difX +"---"+difY);
			var temp1X=parseFloat(posicion2.left)+ difX ;
			var temp2Y=parseFloat(posicion2.top)+ difY;
			
			eval("document.getElementById('"+temp2[i]+"').style.left="+ temp1X);
			eval("document.getElementById('"+temp2[i]+"').style.top="+ temp2Y);
			/*
			posicion2.left=posicion2.left+difX;
			posicion2.top=posicion2.top+difY;
			*/
			//document.getElementById("posiy").value=posicion.top;
			
			}
			//if(temp2.){
			
			//}
			//$( "#"+temp2[i] ).draggable();
			//$( "#"+temp2[i] ).resizable();
		}
		
	
	}
//alert();
}

function deselDiv(){

	for(var i=1; i<temp2.length;i++){
	
	eval("document.getElementById('"+temp2[i]+"').style.background=''");
	
	}

}


function editCoor(e){
	
	if(e.keyCode==13){
	
	
	var cont=0;
	for(var i=1; i<temp2.length;i++){
			
	  if(eval("document.getElementById('"+temp2[i]+"').style.background=='rgb(230, 197, 6)'") ){
			
			cont++;
			
			}
			
	}
	//alert(cont);
	if(cont>1){
	alert("no es posible");
	return false;
	}
	
	
		for(var i=1; i<temp2.length;i++){
				//alert(temp2[i]);	
				
				
		  if(eval("document.getElementById('"+temp2[i]+"').style.background=='rgb(230, 197, 6)'")){
					//alert(temp2[i]);				
							
				eval("document.getElementById('"+temp2[i]+"').style.left="+ $("#posix").val());
				eval("document.getElementById('"+temp2[i]+"').style.top="+ $("#posiy").val());
								
		  }
				
		}
	}		

}

function editDimen(e){
	
	if(e.keyCode==13){
	
	
	var cont=0;
	for(var i=1; i<temp2.length;i++){
			
	  if(eval("document.getElementById('"+temp2[i]+"').style.background=='rgb(230, 197, 6)'") ){
			
			cont++;
			
			}
			
	}
	//alert(cont);
	if(cont>1){
	alert("No es posible");
	return false;
	}
	
	
		for(var i=1; i<temp2.length;i++){
				//alert(temp2[i]);	
				
				
		  if(eval("document.getElementById('"+temp2[i]+"').style.background=='rgb(230, 197, 6)'")){
					//alert(temp2[i]);				
							
				eval("document.getElementById('"+temp2[i]+"').style.width="+ $("#ancho").val());
				eval("document.getElementById('"+temp2[i]+"').style.height="+ $("#alto").val());
								
		  }
				
		}
	}		

}

</script>
