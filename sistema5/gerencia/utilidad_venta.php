<?php 
include('../conex_inicial.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>

<script language="javascript" src="../miAJAXlib2.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo9 {
	font-size: 10px;
	font-weight: bold;
}
.Estilo14 {
	font-size: 10px;
	font-family: tahoma, verdana, sans-serif;
}
-->
</style></head>


<link href="../styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
background-color:#F3F3F3;   
}
.Estilo7 {color: #747374; font-size: 10px; font-weight: bold; }
.Estilo13 {color: #0767C7}
.Estilo19 {font-family: tahoma, verdana, sans-serif}
.Estilo20 {font-size: 10px}

.Estilo100 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
.texto1{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #000000;
}
.texto2{
	font-family: Verdana,Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #000000;
}



</style>
<body onLoad="document.form1.sucursal.focus();">
<form id="form1" name="form1" method="post" action="">
  <table width="760" height="51" border="0" cellpadding="0" cellspacing="0">
    
    <tr style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="5" height="25">&nbsp;</td>
      
	   <td width="760" height="25" colspan="11" style="border:#999999">
	  <span class="Estilo100">Gerencia :: Utilidad de Ventas por Clientes/Productos </span>	  <input type="hidden" name="carga" id="carga" value="S"></td>
    </tr>
    <tr>
      <td height="26">&nbsp;</td>
      <td><table width="790" height="43" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="246" valign="top"><table style="border:#CCCCCC solid 1px" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td align="center" valign="top" style="padding-bottom:10px; padding-left:10px; padding-right:10px; padding-top:10px;"><table border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td><strong>Empresa</strong></td>
                    <td><select style="width:192px;" name="sucursal" onChange="doAjax('cargar_cmbtienda.php','tipo=almacen&codsuc='+document.form1.sucursal.value,'cargar_cbo','get','0','1','',''); " >
                      <?php 		
  $resultados1 = mysql_query("select * from sucursal order by des_suc desc ",$cn); 
while($row1=mysql_fetch_array($resultados1))
{		?>
                      <option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
                      <?php }?>
                    </select></td>
                  </tr>
                  <tr>
                    
					<td colspan="2">
                     <div id="cbo_tienda">
					  <input name="ckb0" type="checkbox" id="ckb0" style="border: 0px; background-color:#F9F9F9; "  value="checkbox" checked="checked"
					  onclick="doAjax('cargar_cmbtienda.php','tipo=almacen&codsuc='+document.form1.sucursal.value,'cargar_cbo','get','0','1','',''); " >
                     <strong> Todos los locales/tiendas </strong>
					  <br>	
				<div id="cbo_tienda2">	  
		     <select  style="width:240" name="almacen" onBlur="" disabled >
               <option value="0"></option>
             </select></div>
		   </div>					  </td>
                  </tr>
                  <tr>
                    <td colspan="2">					</td>
                  </tr>
              </table></td>
            </tr>
          </table>
            <table style="border:#CCCCCC solid 1px" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="center" valign="top" style="padding-bottom:10px; padding-left:10px; padding-right:10px; padding-top:10px;"><table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><strong>
                        <input name="ckb1" type="checkbox" id="ckb1" style="border: 0px; background-color:#F9F9F9; " value="checkbox" onClick="activar('cli')">
                      </strong></td>
                      <td><strong>
                        Cliente</strong></td>
                      <td><input name="cliente" type="text" disabled id="cliente"  style="height:20; border-color:#CCCCCC" size="25" maxlength="100" autocomplete="off"></td>
                    </tr>
                    <tr>
                      <td><strong>
                        <input name="ckb2" type="checkbox" id="ckb2" style="border: 0px; background-color:#F9F9F9; " value="checkbox" onClick="activar('ruc')">
                      </strong></td>
                      <td><strong></span>R.U.C.</strong></td>
                      <td><input name="ruc" type="text" id="ruc"  style="height:20; border-color:#CCCCCC" onKeyUp="cargarcatalogo('')" size="10" maxlength="11" autocomplete="off" disabled></td>
                    </tr>
                    <tr>
                      <td><strong>
                        <input name="ckb3" type="checkbox" id="ckb3" style="border: 0px; background-color:#F9F9F9; " value="checkbox" onClick="activar('pro')">
                      </strong></td>
                      <td><strong></span>Producto: </strong></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3"><span style="color:#FFFFFF">
                        <select name="producto" disabled id="producto" style="width:240px;">
                          <option value=""> </option>
                          <?php  
				  $resultados3 = mysql_query("select * from producto order by nombre ",$cn); 
					while($row3=mysql_fetch_array($resultados3))
					{ 
		?>
                          <option value="<?php echo $row3['idproducto']; ?>"><?php echo $row3['nombre']; ?></option>
                          <?php } ?>
                        </select>
                      </span></td>
                    </tr>
                    <tr>
                      <td><strong>
                        <input name="ckb4" type="checkbox" id="ckb4" style="border: 0px; background-color:#F9F9F9; " value="checkbox" onClick="activar('res')">
                      </strong></td>
                      <td><strong></span>Respon.</strong></td>
                      <td><select name="respon" disabled id="respon" style="width:166px;">
                          <option value=""></option>
                          <?php  
				  $resultados3 = mysql_query("select * from usuarios order by usuario ",$cn); 
					while($row3=mysql_fetch_array($resultados3))
					{ 	?>
               <option value="<?php echo $row3['codigo']; ?>"><?php echo $row3['usuario']; ?></option>
                          <?php } ?>
                      </select></td>
                    </tr>
                </table></td>
              </tr>
            </table>
            <table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="padding-top:17px;">
				<fieldset>
                  <legend>Selecci&oacute;n de documentos </legend>
                  <table width="250px" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><table border="0" cellpadding="1" cellspacing="1"  id="tblIn">
                          <tr>
                            <td width="32" align="center" bgcolor="#0066CC"><span style="color:#FFFFFF">ok</span></td>
                            <td width="38" align="center" bgcolor="#0066CC"><span style="color:#FFFFFF">CD</span></td>
                            <td width="194" bgcolor="#0066CC"><span style="color:#FFFFFF">Descripci&oacute;n
                              
                            </span></td>
                          </tr>
                        </table>
                          <div style="overflow-y:scroll;height:110px">
                            <table  id="tblIn" border="0" cellspacing="1" cellpadding="1">
                              <?php 
					
					$strSQl="select * from operacion where tipo='2' and 
					substring(p1,5,1)='S'
					 order by descripcion";
					$resultado=mysql_query($strSQl,$cn);
					while($row=mysql_fetch_array($resultado)){
					
					?>
                              <tr>
                                <td width="32" align="center" bgcolor="#ffffff"><input name="chkIngresos[]" id="Ingresos" type="checkbox" style="background:none; border:none" value="<?php echo $row['codigo']?>" checked/></td>
                                <td width="38" align="center" bgcolor="#ffffff"><span class="Estilo27"><?php echo $row['codigo']?></span></td>
                                <td width="194" bgcolor="#ffffff"><span class="Estilo27"><?php echo $row['descripcion']?></span></td>
                              </tr>
                              <?php 
					  }
					  ?>
                            </table>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                          </div></td>
                    </tr>
                  </table>
                </fieldset></td>
              </tr>
              <tr>
                <td><input name="Grupo1"  type="radio" id="Grupo1"  style="background:none; border:none"  onClick="marcar()" value="todos" checked>
                  Marcar todos
                  <input id="Grupo1" name="Grupo1" style="background:none; border:none" type="radio" value="ninguno"  onClick="marcar()">
                  Desmarcar todos </td>
              </tr>
            </table></td>
          <td width="252" valign="top"><table width="262" border="0" cellpadding="0" cellspacing="0" style="border:#CCCCCC solid 1px">
            <tr>
              <td align="center" valign="top" style="padding-bottom:10px; padding-left:10px; padding-right:10px; padding-top:10px;"><table border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="123"><div align="right"><strong>Conversi&oacute;n  Mon. : </strong></div></td>
                    <td width="110">
                      <select style="width:130" name="cmbmoneda" onChange="cargarcatalogo('')" >
                        <option value="01" >En Soles(S/.)</option>
                        <option value="02">En Dolares(US$.)</option>
                      </select></td>
                  </tr>
                  <tr>
                    <td><div align="right"><strong>Utilidad por : </strong></div></td>
              <td><select name="cmbutil" id="cmbutil" style="width:130px;" onChange="cmbDatos()" >
                        <option value="producto">Producto</option>
                        <option value="cliente">Cliente</option>
                    </select></td>
                  </tr>
                  <tr>
                    <td><div align="right"><strong>Tipo de Reporte : </strong></div></td>
                    <td><select name="cmbreporte" id="cmbreporte" style="width:130px;" onChange="cmbDatos()">
                        <option value="Consolidado">Consolidado</option>
                        <option value="Detallado">Detallado</option>
                    </select></td>
                  </tr>
              </table></td>
            </tr>
          </table>
            <table style="border:#CCCCCC solid 1px" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="center" valign="top" style="padding-bottom:10px; padding-left:10px; padding-right:10px; padding-top:10px;"><table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="20"><span class="Estilo14" style="font-weight: bold">
                        <input name="ckb5" type="checkbox" id="ckb5" style="border: 0px; background-color:#F9F9F9; " value="checkbox" onClick="activar('cla')">
                      </span></td>
                      <td width="203"><span class="Estilo14" style="font-weight: bold"> Filtro por <?=$CatgNomEti1;?></span></td>
                    </tr>
                    <tr>
                      <td colspan="2"><select name="clasificacion" style="width:240px" disabled>
                          <option value=""></option>
                          <?php  
				  $resultados3 = mysql_query("select * from clasificacion order by des_clas ",$cn); 
					while($row3=mysql_fetch_array($resultados3))
					{ 
		?>
                          <option value="<?php echo $row3['idclasificacion']; ?>"><?php echo $row3['des_clas']; ?></option>
                          <?php } ?>
                        </select>                      </td>
                    </tr>
                    <tr>
                      <td><span class="Estilo20" style="font-weight: bold">
                        <input name="ckb6" type="checkbox" id="ckb6" style="border: 0px; background-color:#F9F9F9; " value="checkbox" onClick="activar('cat')">
                      </span></td>
                      <td><span class="Estilo20" style="font-weight: bold"> Filtro por <?=$CatgNomEti2;?></span></td>
                    </tr>
                    <tr>
                      <td colspan="2"><select name="categoria" style="width:240px" disabled>
                          <option value=""></option>
                          <?php  
				  $resultados3 = mysql_query("select * from categoria order by des_cat ",$cn); 
					while($row3=mysql_fetch_array($resultados3))
					{ 
		?>
                          <option value="<?php echo $row3['idCategoria']; ?>"><?php echo $row3['des_cat']; ?></option>
                          <?php } ?>
                      </select></td>
                    </tr>
                    <tr>
                      <td><span class="Estilo20" style="font-weight: bold">
                        <input name="ckb7" type="checkbox" id="ckb7" style="border: 0px; background-color:#F9F9F9; " value="checkbox" onClick="activar('sca')">
                      </span></td>
                      <td><span class="Estilo20" style="font-weight: bold"> Filtro por <?=$CatgNomEti3;?></span></td>
                    </tr>
                    <tr>
                      <td colspan="2"><select name="subcategoria" style="width:240px" disabled>
                          <option value=""></option>
                          <?php  
				  $resultados3 = mysql_query("select * from subcategoria order by des_subcateg ",$cn); 
					while($row3=mysql_fetch_array($resultados3))
					{ 
		?>
                          <option value="<?php echo $row3['idsubcategoria']; ?>"><?php echo $row3['des_subcateg']; ?></option>
                          <?php } ?>
                      </select></td>
                    </tr>
                </table></td>
              </tr>
            </table>
            </td>
          <td width="292" valign="top"><table width="265" border="0" cellpadding="0" cellspacing="0" style="border:#CCCCCC solid 1px">
              <tr>
                <td align="center" valign="top" style="padding-bottom:10px; padding-left:10px; padding-right:10px; padding-top:10px;">
				
			<div id="cbo_orden">	
				<table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><div align="right"><strong>Ordenado por: </strong></div></td>
                      <td><strong>
                        <select name="cmborden" id="cmborden" style="width:100"  onChange="activar('ord')" >
                          <option value="nom_prod" >Nom. Producto</option>
                          <option value="cod_Anexo">Cód. Anexo</option>
                          <option value="DM.cod_prod">Cód. Producto</option>
                        </select>
                      </strong></td>
                      <td><strong>
                        <select name="cmbnum" id="cmbnum" style="width:45" disabled >
						 <option value='P.cod_prod' >1</option>
						  <? for ($i = 2; $i <= 25; $i++) { 
				  		  echo "<option value='codanex".$i."' >$i</option>";
								}
						  ?>
                        </select>
                      </strong></td>
                    </tr>
                </table>
			</div>	
				
				</td>
              </tr>
            </table>
            <table width="265" border="0" cellpadding="0" cellspacing="0" style="border:#CCCCCC solid 1px">
              <tr>
                <td align="center" valign="top" style="padding-bottom:10px; padding-left:10px; padding-right:10px; padding-top:10px;"><table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><div align="right"><strong>Del </strong></div></td>
                      <td><span class="Estilo25">
                        <input onKeyUp="cargar_detalle('')" type="text" name="fecha1" value="<?php echo '01'.substr(date('d-m-Y'),2,8)?>" size="10" id="fecha1"/>
                      </span></td>
                      <td>
					  <button type="reset" id="f_trigger_b2" >...</button>            <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha1",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b2",   
        singleClick    :    true,           
        step           :    1                
    });
                  </script>					  </td>
                      <td>&nbsp;</td>
                      <td><strong>Al </strong></td>
                      <td><input onKeyUp="cargar_detalle('')" type="text" name="fecha2" value="<?php echo date('d-m-Y')?>" size="10" id="fecha2" /></td>
                      <td>
					  <button type="reset" id="f_trigger_b3" >...</button>
            <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha2",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b3",   
        singleClick    :    true,           
        step           :    1                
    });
                  </script>					  </td>
                    </tr>
                </table></td>
              </tr>
            </table>
			<fieldset>
                <legend> </legend>
				<b>Imprimir
			    <input name="Grupo3" type="radio" id="radio2" style="background:none; border:none" value="ninguno" checked >
			    C&oacute;d. Producto 
			    <input id="radio3" name="Grupo3" style="background:none; border:none" type="radio" value="ninguno" >
			 C&oacute;d. Anexo </b>
			</fieldset>
			<fieldset>
                <legend> </legend>
<b>				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Uilizar
			    <input name="Grupo4" type="radio" id="radio4" style="background:none; border:none" value="ninguno" checked >
			 Precio Costo&nbsp;&nbsp;&nbsp;  
			 <input id="radio5" name="Grupo4" style="background:none; border:none" type="radio" value="ninguno" >
			 Costo Ref. </b>
			</fieldset>
			<strong style="color:#FF0000">
			<input name="ckbCosto" type="checkbox" id="ckbCosto" style="border: 0px; background-color:#F9F9F9; " value="checkbox">
			Solo con Costo > 0	</strong>
			<br>
			<br>
			<table width="45%" height="81" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="63%" align="center" valign="middle"><table width="75%" height="55" border="0" cellpadding="0" cellspacing="0" onClick="generar_documento('vista')" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" style="cursor:pointer">
                      <tr>
                        <td align="center"><span class="Estilo9"><img src="../imagenes/ico_lupa.jpg" width="20" height="20"></span></td>
                      </tr>
                      <tr>
                        <td align="center"><span class="Estilo9 Estilo13">Vista Previa</span></td>
                      </tr>
                                </table></td>
              </tr>
            </table>
			  <div id="detalle" ></div>
			</td>
        </tr>
      </table>        </td>
    </tr>
  </table>
</form>
</body>
</html>

<script>
function activar(tipo){

if(tipo=='ord'){
	if(document.form1.cmborden.value=='cod_Anexo'){
	document.form1.cmbnum.disabled=false;
	}else{
	document.form1.cmbnum.disabled=true;
	}
}


if(tipo=='alm'){
	if(document.form1.ckb0.checked==true){
	document.form1.almacen.disabled=true;
	document.form1.almacen.value='';
	}else{
	document.form1.almacen.disabled=false;
	}
}
if(tipo=='cli'){
	if(document.form1.ckb1.checked==true){
	document.form1.cliente.disabled=false;
	}else{
	document.form1.cliente.disabled=true;
	document.form1.cliente.value='';
	}
}
if(tipo=='ruc'){
	if(document.form1.ckb2.checked==true){
	document.form1.ruc.disabled=false;
	}else{
	document.form1.ruc.disabled=true;
	document.form1.ruc.value='';
	}
}
if(tipo=='pro'){
	if(document.form1.ckb3.checked==true){
	document.form1.producto.disabled=false;
	}else{
	document.form1.producto.disabled=true;
	document.form1.producto.value='';
	}
}
if(tipo=='res'){
	if(document.form1.ckb4.checked==true){
	document.form1.respon.disabled=false;
	}else{
	document.form1.respon.disabled=true;
	document.form1.respon.value='';
	}
}	
if(tipo=='cla'){
	if(document.form1.ckb5.checked==true){
	document.form1.clasificacion.disabled=false;
	}else{
	document.form1.clasificacion.disabled=true;
	document.form1.clasificacion.value='';
	}
}	
if(tipo=='cat'){
	if(document.form1.ckb6.checked==true){
	document.form1.categoria.disabled=false;
	}else{
	document.form1.categoria.disabled=true;
	document.form1.categoria.value='';
	}
}
if(tipo=='sca'){
	if(document.form1.ckb7.checked==true){
	document.form1.subcategoria.disabled=false;
	}else{
	document.form1.subcategoria.disabled=true;
	document.form1.subcategoria.value='';
	}
}
}
function marcar(){
	if(document.form1.Grupo1[0].checked){
		for(var i=0;i<document.form1.Ingresos.length;i++){
		document.form1.Ingresos[i].checked=true;
		}		
	}else{
		for(var i=0;i<document.form1.Ingresos.length;i++){
			document.form1.Ingresos[i].checked=false;
			}	
	}
	
}

function cmbDatos(){
var util=document.form1.cmbutil.value;
var reporte=document.form1.cmbreporte.value;
//alert(util);
doAjax('cargar_cmbtienda.php','util='+util+'&reporte='+reporte,'cargar_cbo2','get','0','1','','');
}
function cargar_cbo2(texto){
//alert(texto);
var r = texto;
document.getElementById('cbo_orden').innerHTML=r;
//document.form1.almacen.focus();
}
function cargar_cbo(texto){
//alert(texto);
var r = texto;
document.getElementById('cbo_tienda').innerHTML=r;
//document.form1.almacen.focus();
}



function generar_documento(parametro){
var sucursal=document.form1.sucursal.value;
var almacen=document.form1.almacen.value;
var cliente=document.form1.cliente.value;
var ruc=document.form1.ruc.value;
var producto=document.form1.producto.value;
var respon=document.form1.respon.value;
var moneda=document.form1.cmbmoneda.value;
var util=document.form1.cmbutil.value;
var reporte=document.form1.cmbreporte.value;
var clasificacion=document.form1.clasificacion.value;
var categoria=document.form1.categoria.value;
var subcategoria=document.form1.subcategoria.value;
var ordenar=document.form1.cmborden.value;
var cmbnum=document.form1.cmbnum.value;
var fecha1=document.form1.fecha1.value;
var fecha2=document.form1.fecha2.value;
var impirmir=document.form1.Grupo3[0].checked;
var utilizar=document.form1.Grupo4[0].checked;
var Costo=document.form1.ckbCosto.checked;
var temp1=0;
var documento ='';
var Condicion ='';
	
	for(var i=0;i<document.form1.Ingresos.length;i++){	
		if(document.form1.Ingresos[i].checked){
		documento+="'"+document.form1.Ingresos[i].value+"',";
		temp1=1;
		}		
	}
//alert(documento);
if(temp1==0){
	alert('Seleccione Documento');
	return false
}

/*if (reporte=='Detallado'){ 
reporteurl='lista_utiles_conslidado.php';
//reporteurl='lista_utiles_deallado.php';
}else{
reporteurl='lista_utiles_conslidado.php';
}*/

window.open("cabecera.php?sucursal="+sucursal+"&almacen="+almacen+"&cliente="+cliente+"&ruc="+ruc+"&producto="+producto+"&moneda="+moneda+"&util="+util+"&reporte="+reporte+"&filtro_cla="+clasificacion+"&filtro_cat="+categoria+"&filtro_sub="+subcategoria+"&ordenar="+ordenar+"&fecha1="+fecha1+"&fecha2="+fecha2+"&impirmir="+impirmir+"&utilizar="+utilizar+"&Costo="+Costo+"&documento="+documento+"&Condicion="+Condicion+"&formato="+parametro+"&respon="+respon+"&cmbnum="+cmbnum,"UtilVent","toolbar=no,status=yes, menubar=no, scrollbars=yes, width=750, height=600,left=50 top=50");

}

function cambiar_color1(obj){
obj.style.background='#FFF1BB';
obj.style.border='#C0C0C0 solid 1px';
}

function cambiar_color2(obj){
obj.style.background='#F3F3F3';
obj.style.border=' ';
}


function enfocar_cbo(e){}
function limpiar_enfoque(e){}
function cambiar_enfoque(e){}
</script>
