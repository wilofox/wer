<?php 
include('../conex_inicial.php');

$tip=$_REQUEST['tipo'];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>


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
.Estilo1 {
	font-size: 14px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
	color: #0066CC;
}
.Estilo8 {
	color: #003366;
	font-size: 12;
}
-->
</style></head>


<link href="../styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
background-color:#F3F3F3;   
}
.Estilo2 {
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo3 {color: #000000}
.Estilo7 {color: #747374; font-size: 10px; font-weight: bold; }
.Estilo12 {font-family: Verdana, Arial, Helvetica, sans-serif}
</style>
<script language="javascript" src="../miAJAXlib2.js"></script>
<script>
function cargar_cbo(texto){
//alert(texto);
var r = texto;
document.getElementById('cbo_tienda').innerHTML=r;
document.form1.almacen.focus();
}

var temp="";

function entrada(objeto){

	if(objeto.cells[0].childNodes[0].checked==false){
		objeto.cells[0].childNodes[0].checked=false;
	}else{
		objeto.cells[0].childNodes[0].checked=true;
	}
	document.form1.codig.value=objeto.cells[1].innerHTML;
	
//	temp=objeto;
	if(objeto.style.background=='#fff1bb'){
	//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='#FFF1BB';
	
	temp.style.background='#E9F3FE';
	temp=objeto;
	}

}


function cargar(){
document.getElementById('lista_productos').rows[0].style.background='#fff1bb';
temp=document.getElementById('lista_productos').rows[0];
document.getElementById('lista_productos').rows[0].cells[0].childNodes[0].checked=true;

if(document.form1.rb[0].checked){
	porCliente();
}else{
	porSeleccion();
}
document.form1.codig.value=document.getElementById('lista_productos').rows[0].cells[1].innerHTML;
}
</script>

<body onLoad="cargar();">
<form id="form1" name="form1" method="post" action="">
  <table width="744" height="188" border="0" cellpadding="0" cellspacing="0">
 <tr  style="background:url(../imagenes/white-top-bottom.gif)">
      <td height="27" colspan="11" style="border:#999999">
	  <span class="Estilo21 Estilo19 Estilo1 Estilo15 Estilo8"><span class="Estilo21 Estilo19 Estilo15  text5 Estilo12"><strong> Finanzas :: Cr&eacute;ditos y Cobranzas :: Estado de Cuentas Corrientes 

<?php if($tip==1){echo "Proveedores";}else{echo "Clientes";}?>
       
<input name="auxiliar" type="hidden" id="auxiliar" value="<?php echo $tip; ?>">
      </strong></span></span>	  </td>
    </tr>
    
    <tr>
      <td height="78">&nbsp;</td>
      <td><table width="684" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="51"><span class="Estilo7">Empresas</span></td>
            <td width="168"><select style="width:160"  name="sucursal" onChange="doAjax('../carga_cbo_tienda.php','&kardex=s&codsuc='+document.form1.sucursal.value,'cargar_cbo','get','0','1','','')" >
              <option value="0">Todas</option>
              <?php 
		
		 $resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn); 
		while($row1=mysql_fetch_array($resultados1))
		{
		?>
              <option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
              <?php }?>
            </select></td>
            <td width="14">&nbsp;</td>
            <td width="254" align="left"><span class="Estilo7">Rango de Fechas :    
              <input type="hidden" name="codig" id="codig" maxlength="1000" size="1000">
            </span></td>
            <td width="71" align="left"><span class="Estilo7">Documentos:&nbsp;</span></td>
            <td width="102" align="left"><span class="Estilo7"><select name="docu" id="docu">
              <option value="saldo">con Saldo</option>
              <option value="cancelado">Cancelados</option>
              <option value="todos">Todos</option>
            </select></span></td>
            <td width="6">&nbsp;</td>
            <td width="18">&nbsp;</td>
          </tr>
          <tr>
            <td height="26"><span class="Estilo7">Tiendas</span>
           	</td>
            <td height="26"><div id="cbo_tienda">
                <select  style="width:160" name="almacen" onBlur="">
                  <option value="0">Todas</option>
                </select>
            </div></td>
            <td>
              
            </td>
			<?php 
			$temp_fecha=date('Y-m-d');
			$fecha=explode("-",$temp_fecha);
			$fecha1=$fecha[0]."-".$fecha[1]."-01";
			$fecha2=$temp_fecha;
			?>
			
            <td align="left">del:<input type="text" size="10" maxlength="10"  id="fecha1" value="<?php echo $fecha1?>"/>  
            <button type="reset" id="f_trigger_b1"  style="height:18" >...</button>
              <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha1",      
        ifFormat       :    "%Y-%m-%d",      
        showsTime      :    true,            
        button         :    "f_trigger_b1",   
        singleClick    :    true,           
        step           :    1                
    });
            </script>
			
			<script>
			
			function enfocar_cbo(evet){
			}
			function limpiar_enfoque(vent){
			
			}
			function cambiar_enfoque(fer){
			
			}
			
			
			</script>
			
              al
              <input name="text" type="text" size="10" maxlength="10" id="fecha2" value="<?php echo $fecha2?>" />
              <button type="reset" id="f_trigger_b2"  style="height:18" >...</button>
              <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha2",      
        ifFormat       :    "%Y-%m-%d",      
        showsTime      :    true,            
        button         :    "f_trigger_b2",   
        singleClick    :    true,           
        step           :    1                
    });
              </script></td>
            <td colspan="2" align="left"><span class="Estilo7">Tipo de Reporte :    </span></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="23" colspan="4"><strong>B&uacute;squeda por Aprox. : 
                <select name="criterio">
                <option value="codcliente">Codigo Sistema</option>
                <option value="razonsocial" selected>Raz&oacute;n Social</option>
                <option value="ruc">Ruc</option>
              </select>
              <input autocomplete="off"  name="valor" type="text" size="25" onKeyUp="buscar_prod()">
            </strong></td>
            <td colspan="2"><input type="radio" name="treporte" id="treporte" value="Consolidado"> Consolidado  <input checked type="radio" name="treporte" id="treporte" value="detallado"> Detallado</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
      </table></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="74">&nbsp;</td>
      <td><table width="733" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="55" height="21" align="center" bgcolor="#0A8196"><span class="Estilo2">OK</span></td>
          <td width="191" align="center" bgcolor="#0A8196"><span class="Estilo2">Codigo</span></td>
          <td width="213" align="center" bgcolor="#0A8196"><span class="Estilo2">Raz&oacute;n Social</span></td>
          <td width="167" align="center" bgcolor="#0A8196"><span class="Estilo2">Ruc</span></td>
          <td width="108" bgcolor="#0A8196">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="5">
		  <div id="productos" style="width:734px; height:180px; overflow:auto" >
		  <table id="lista_productos" width="732" height="24" border="0" cellpadding="0" cellspacing="0">
            
			
			<?php 
			if($tip==1){
				$codi="P";
			}else{
				$codi="C";
			}
			
			$strSQL="select * from cliente where tipo_aux='".$codi."' order by razonsocial limit 100";
//			echo $strSQL;
			$resultado=mysql_query($strSQL,$cn);
			while($row=mysql_fetch_array($resultado)){
			?>
			
			<tr bgcolor="#E9F3FE" onClick="entrada(this)">
              <td width="55" align="center"><input style="border: 0px; background-color:#F9F9F9; " type="checkbox" name="xproducto" value="<?php echo $row['codcliente']?>" /></td>
              <td width="153" align="center"><?php echo $row['codcliente']?></td>
              <td width="252"><?php echo $row['razonsocial']?></td>
              <td width="272"><?php echo $row['ruc'] ?></td>
            </tr>
			
			<?php }?>
          </table>
		  </div>		  </td>
          </tr>
        
        <tr>
          <td colspan="5" height="5"></td>
        </tr>
        <tr>
          <td colspan="2" rowspan="3"><table style="border:#CCCCCC solid 1px" width="197" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="28"><input checked="checked" style="border: 0px; background-color:#F9F9F9;" id="rb" name="radiobutton" type="radio" value="radiobutton" onClick="porCliente()"></td>
              <td width="77"><strong>Por Cliente </strong></td>
              <td width="21"><input style="border: 0px; background-color:#F9F9F9;" id="rb" name="radiobutton" type="radio" value="radiobutton" onClick="porSeleccion()" ></td>
              <td width="80"><strong>Por Selecci&oacute;n </strong></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="3"><p>
                    <label></label>
                    <label>
                    <input type="radio" style="border: 0px; background-color:#F9F9F9;" id="GO1" name="GrupoOpciones1" onClick="marcarTodos()" value="opción">
Marcar Todos</label>
                    <br>
                    <label>
                    <input type="radio" style="border: 0px; background-color:#F9F9F9;" id="GO1" onClick="desmarcarTodos()" name="GrupoOpciones1" value="opción">
Desmarcar Todos</label>
                    <br>
                    <br>
                            </p></td>
              </tr>
          </table></td>
          <td colspan="2"><strong>Ordenar por : 
            <select name="ordenar">
              <option value="1" selected>Fecha Vencimiento</option>
              <option value="2">Fecha Emisi&oacute;n</option>
			
            </select>
          </strong></td>
          <td rowspan="3"><table width="108" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
            
              <td width="58" align="center"><img style="cursor:pointer" onClick="javascript:mostrar_cuentas('1');" style="cursor:pointer" src="../imagenes/ico-excel.gif" width="20" height="20"></td>
              <td width="50" height="30" align="center"><img onClick="javascript:mostrar_cuentas('')" style="cursor:pointer" src="../imgenes/procesar.gif" width="20" height="20"></td>
              </tr>
            <tr>
              <td align="center"><span class="Estilo3"><strong>Excel</strong></span></td>
              <td><span class="Estilo3"><strong>Procesar</strong></span></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
          </tr>
        <tr>
        
          <td colspan="2">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="5">&nbsp;</td>
        </tr>
      </table>
	  <br>
	  
	  </td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>

<script>

function  buscar_prod(){
//alert(document.form1.auxiliar.value);
var criterio=document.form1.criterio.value;
doAjax('lista_clie_cta.php','&valor='+document.form1.valor.value+'&criterio='+criterio+'&tipo='+document.form1.auxiliar.value,'mostrar_filtro','get','0','1','','');

}

function mostrar_filtro(texto){
//alert(texto);
document.getElementById('productos').innerHTML=texto;


cargar();
}



function mostrar_cuentas(ex){

	//if(document.form1.sucursal.value!=0){
		//var docs=document.form1.docu.value;
//		alert(docs);
	for(var i=0;i<document.form1.treporte.length;i++){
		if (document.form1.treporte[i].checked) {
			var treporte=document.form1.treporte[i].value;
		}
	}
	var c=0;
	var codigo="";
	if(document.form1.rb[0].checked){
		codigo=document.form1.codig.value;
		c=1;
	}else{
		for(var i=0;i<document.form1.xproducto.length;i++){ 
			if (document.form1.xproducto[i].checked) {
				if(c==0){
					codigo=document.form1.xproducto[i].value;
				}else{
					codigo=codigo+","+document.form1.xproducto[i].value;
				}
				c++;
			   //break; 
			}
				//  
		}
	}
	var tipo="<?php echo $tip; ?>";
		//	alert(document.form1.xproducto.length);
	//alert(codigo);
//	var treporte=document.getElementById('treporte').value;
	for (i=0;i<document.form1.sucursal.options.length;i++){
		if (document.form1.sucursal.options[i].value==document.form1.sucursal.value)
		{
			var des_suc=document.form1.sucursal.options[i].text;
		}
	}
    
	
		des_suc=des_suc.replace('&',"|");
		//alert(des_suc);
	
	for (i=0;i<document.form1.docu.options.length;i++){
		if (document.form1.docu.options[i].value==document.form1.docu.value)
		{
			var docs=document.form1.docu.options[i].text;
		}
	}

	for (i=0;i<document.form1.almacen.options.length;i++)
	{
		if (document.form1.almacen.options[i].value==document.form1.almacen.value)
		{
			var des_tie=document.form1.almacen.options[i].text;
		}
	}
	var x="";
	if(ex!=""){
		x="&excel";
	}
	if(treporte=='Consolidado' && c==1){
		alert("Reporte consolidado valido para dos o mas Clientes");
	}else{
		if(c==1){
		
		var ordenar=document.form1.ordenar.value;
			window.open("resultado_ctas2.php?cod_aux="+codigo+"&docs="+docs+"&des_tie="+des_tie+"&des_suc="+des_suc+"&sucursal="+document.form1.sucursal.value+"&tienda="+document.form1.almacen.value+"&fecha1="+document.form1.fecha1.value+"&fecha2="+document.form1.fecha2.value+"&reporte="+treporte+'&ordenar='+ordenar+'&tipo='+tipo+x,"vent","toolbar=no,status=no, menubar=no, resizable=yes, scrollbars=yes, width=850, height=300,left=300 top=250");
		}else{
			//window.open("CtaCte_excel.php?precio="+document.form1.precios.value+"&agr_cla="+agr_cla+"&agr_cat="+agr_cat+"&agr_sub="+agr_sub+"&filtro_cla="+clasificacion+"&filtro_cat="+categoria+"&filtro_sub="+subcategoria+"&ordenar="+ordenar+"&formato="+parametro+"&tienda="+tienda+"&precios="+precios+"&sucursal="+sucursal+"&incluir="+incluir,"vent","toolbar=no,status=yes, menubar=no, scrollbars=no, width=700, height=700,left=50 top=50");
		}
	}
}

function marcarTodos(){
	for (var i=0;i<document.form1.xproducto.length;i++){ 
		   document.form1.xproducto[i].checked=true;
	}
}

function porCliente(){
	for (var i=0;i<document.form1.xproducto.length;i++){ 
		   document.form1.xproducto[i].disabled=true;
	}
	document.form1.GO1[0].disabled=true;
	document.form1.GO1[0].value="opción";
	document.form1.GO1[1].disabled=true;
	document.form1.GO1[1].value="opción";
}

function porSeleccion(){
	for (var i=0;i<document.form1.xproducto.length;i++){ 
		   document.form1.xproducto[i].disabled=false;
	}
	document.form1.GO1[0].disabled=false;
	document.form1.GO1[0].value="opción";
	document.form1.GO1[1].disabled=false;
	document.form1.GO1[1].value="opción";
}

function desmarcarTodos(){
	for (var i=0;i<document.form1.xproducto.length;i++){ 
		   document.form1.xproducto[i].checked=false;
				//  
	}
}

</script>