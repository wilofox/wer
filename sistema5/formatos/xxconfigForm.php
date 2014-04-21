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
	<script src="../jqueryUI/jquery.ui.selectable.js"></script>
	
	<!--<script src="../jqueryUI/jquery-ui.js"></script>-->
	
	<link rel="stylesheet" href="../jqueryUI/demos.css">
	
	<script language="javascript" src="../Finanzas/miAJAXlib3.js"></script>
	
	<style>
	#feedback { font-size: 1.4em; }
	#selectable .ui-selecting { background: #FECA40; }
	#selectable .ui-selected { background: #F39814; color: white; }
	/*#selectable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
	#selectable li { margin: 3px; padding: 0.4em; font-size: 1.4em; height: 18px; }*/
	</style>
	
<script>

	$(function() {	
	
	$( "#selectable" ).selectable();
	
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

<!--
<ol id="selectable">
    <li >Item 1</li>
    <li class="ui-widget-content">Item 2</li>
    <li class="ui-widget-content">Item 3</li>
    <li class="ui-widget-content">Item 4</li>
    <li class="ui-widget-content">Item 5</li>
    <li class="ui-widget-content">Item 6</li>
    <li class="ui-widget-content">Item 7</li>
</ol>
-->

<?php 



$margen=0;
echo "<div id='selectable' style='left:200px; position:absolute;width:75%;height:90%; overflow=scroll'>";

//echo "<li >Item 1</li>";
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


<div  style="height:100%; width:200px; border:#999999 solid 1px; z-index:9999999" >
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
      <td width="176"><select style="width:180"  name="sucursal" id="sucursal" onChange="cambiarDoc()" >
          
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
      <td><span class="Estilo2">Documento:</span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="22">&nbsp;</td>
      <td><span style="width:140px">
      <select style="width:180" name="doc" id="doc"  onChange="cambiarDoc()" >
        <option value="0"></option>
        <?php 
		   $resultados10 = mysql_query("select * from operacion where  codigo!='TS'  and tipo='2' and reservado!='' order by descripcion ",$cn); 
			while($row10=mysql_fetch_array($resultados10))
			{
					
		  ?>
        <option value="<?php echo $row10['codigo']?>"><?php echo $row10['codigo']." - ".$row10['descripcion']?></option>
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
        <input readonly="readonly" name="posix" type="text" id="posix" size="5"  > 
        y :
        <input readonly="readonly" name="posiy" type="text" id="posiy" size="5"  ></td>
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
        <input readonly="readonly" name="ancho" type="text" id="ancho" size="5"  >
        h:
        <input readonly="readonly" name="alto" type="text" id="alto" size="5"  ></td>
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
      <td align="left" style=" padding-right:20px"><div align="right"><span class="Estilo2">Tamaño Fuente </span>:
          <input  name="fontsize" type="text" id="fontsize" size="5"  >
      </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="left" style=" padding-right:20px"><div align="right"><span class="Estilo2">Altura Doc. 
        <input  name="alturaDoc" type="text" id="alturaDoc" size="5"  >
      </span></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="left">&nbsp;</td>
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
          <table width="174" height="78" border="0" cellpadding="0" cellspacing="0">
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
		   $resultados10 = mysql_query("select * from operacion where  codigo!='TS'  and tipo='2' and reservado!='' order by descripcion ",$cn); 
			while($row10=mysql_fetch_array($resultados10))
			{
					
		  ?>
                  <option value="<?php echo $row10['codigo']?>"><?php echo $row10['codigo']." - ".$row10['descripcion']?></option>
                  <?php }?>
                </select>
              </span></span></td>
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
//alert();

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
	//alert(document.getElementById("posix").value);
	document.getElementById("posix").value=posicion.left;
	//document.getElementById("posix").value=posicion.left;
	document.getElementById("posiy").value=posicion.top;
	document.getElementById("ancho").value=elemento.width();
	document.getElementById("alto").value=elemento.height();
	
	if(document.getElementById("posix").value != ""){
	var diferenciapos=parseFloat(document.getElementById("posix").value)-parseFloat(posicion.left);
	//alert(diferenciapos);
	}
	
	
		for(var i=1; i<temp2.length;i++){
			//alert(temp2[i]);	
			if($("#"+temp2[i]).css("background-color")=='rgb(243, 152, 20)'){
			//alert(diferenciapos);
			$("#"+temp2[i]).position.left = $("#"+temp2[i]).position().left+10;	
			//alert(temp2[i]);
			//eval("document.getElementById("+temp2[i]+").style.left="+$("#"+temp2[i]).position().left+diferenciapos);
			
			//var posicion2=posicion().left+diferenciapos;
			//alert(temp2[i]);
			
			
			};//==F39814
			
			//$( "#"+temp2[i] ).draggable();
			//$( "#"+temp2[i] ).resizable();
			
			
		}
	
	
	if(posicion.left<=200){
	//$("#"+c.id).draggable( "disable" );
	//$("#"+c.id).position().left="200px";
	//alert(c._x);
	//document.getElementById(c.id).style.left="200px";
	//c._x="200px";
	}

}

function cambiarDoc(control){
var doc=document.getElementById("doc").value;
var sucursal=document.getElementById("sucursal").value;
doAjax('../peticion_ajax5.php','&doc='+doc+'&peticion=cargaFormato&sucursal='+sucursal,'rpta_cambiarDoc','get','0','1','','');
}

var temp2="";

function rpta_cambiarDoc(data){

var temp=data.split("|");
document.getElementById("selectable").innerHTML=temp[0];
temp2=temp[1].split("-");

		for(var i=1; i<temp2.length;i++){
			//alert(temp2[i]);	
			
			$( "#"+temp2[i] ).draggable();
			$( "#"+temp2[i] ).resizable();
			
			
		}
		
		$( "#selectable" ).selectable();	
		

document.getElementById("camposDisp").innerHTML=temp[4];
document.getElementById("fontsize").value=temp[2];
document.getElementById("alturaDoc").value=temp[3];

}

function save(){

//alert(temp2);
var acumulador="";
var acumulador2="";
var sucursal=document.getElementById("sucursal").value;
var fontsize1=document.getElementById("fontsize").value;
var alturaDoc=document.getElementById("alturaDoc").value;

		for(var i=1; i<temp2.length;i++){
				
			var elemento = $("#"+temp2[i]);
			var posicion = elemento.position();		
				
			var posx=posicion.left-<?php echo $margen;?>;
			var posy=posicion.top;
			var width=elemento.width();
			var height=elemento.height();
			
			
			acumulador=acumulador+"|"+temp2[i]+"-"+posx+"-"+posy+"-"+width+"-"+height;
		}
		//alert(acumulador);

		var doc=document.getElementById("doc").value;
		
		 for(var x=0;x<document.form1.checkbox.length;x++){
			 if(document.form1.checkbox[x].checked){
			 acumulador2=acumulador2+"-"+document.form1.checkbox[x].value;
			 }
		 }
		
		//alert(acumulador2);
		acumulador=acumulador+"~"+acumulador2;
		
		
	doAjax('../peticion_ajax5.php','&doc='+doc+'&peticion=saveFormato&acumulador='+acumulador+'&sucursal='+sucursal+'&fontsize1='+fontsize1+'&alturaDoc='+alturaDoc,'rpta_save','get','0','1','','');

}

function rpta_save(data){
alert("Se guardaron los cambios");
cambiarDoc();
}

function savecopiar(){
	var sucursal2=document.getElementById("sucursal2").value;
	var sucursal=document.getElementById("sucursal").value;
	var doc=document.getElementById("doc").value;
	var doc2=document.getElementById("doc2").value;
	
		
		if(confirm("Esta seguro que desea copiar este documento ?")){
		
		}else{
		return false;
		}
		
	doAjax('../peticion_ajax5.php','&doc='+doc+'&peticion=saveCopiaForm&sucursal='+sucursal+'&sucursal2='+sucursal2+'&doc2='+doc2,'rpta_savecopia','get','0','1','','');

}

function rpta_savecopia(data){

location.href="configForm.php";
}

function eliminarForm(){

	
	
	var sucursal2=document.getElementById("sucursal2").value;
	var sucursal=document.getElementById("sucursal").value;
	var doc=document.getElementById("doc").value;
	//alert(doc);
	if(doc=='0'){
	alert("Tiene que seleccionar un documento");
	return false;
	}
	
	doAjax('../peticion_ajax5.php','&doc='+doc+'&peticion=eliminarForm&sucursal='+sucursal,'rpta_eliminarForm','get','0','1','','');

}

function rpta_eliminarForm(data){

location.href="configForm.php";

}

function salirMouse(){

alert("");

}

</script>
