<?php 
session_start();
include('../conex_inicial.php');


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
	font-size: 12px;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #003366;
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
.Estilo7 {color: #333333; font-size: 10px; font-weight: bold; }
</style>
<script language="javascript" src="../miAJAXlib2.js"></script>
<script>

var tempSucursal="<?php echo $_SESSION['user_sucursal']?>";
var tempTienda="<?php echo $_SESSION['user_tienda']?>";


function cargar_cbo(texto){
//alert(texto);
var r = texto;
document.getElementById('cbo_tienda').innerHTML=r;
document.form1.almacen.focus();
	
	//alert(tempTienda);
	if(tempTienda=='' || tempTienda=='0'){
	 document.form1.almacen.options[0].selected=true;
	}else{
	seleccionar_combo();
	}

}

var temp="";
/*function entrada(objeto){


	objeto.cells[0].childNodes[0].checked=true;
	
//	temp=objeto;
	if(objeto.style.background=='url(imagenes/sky_blue_sel.png)'){
	//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='url(imagenes/sky_blue_sel.png)';
	
	temp.style.background='#E9F3FE';
	temp=objeto;
	}

}
*/
function entrada(objeto){


	
	if(navigator.appName == 'Microsoft Internet Explorer'){
		objeto.cells[0].childNodes[0].checked=true;
	}else{
		objeto.cells[0].childNodes[1].checked=true;
	}
	
//	temp=objeto;
	if(objeto.style.background=='url(../imagenes/sky_blue_sel.png)'){
//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='url(../imagenes/sky_blue_sel.png)';
		if(temp!=''){
		//alert(temp.style.background);
		temp.style.background="#ffffff";
		}
		temp=objeto;
	}
	
}



function cargar(){
	try{
		document.getElementById('lista_productos').rows[0].style.background='url(../imagenes/sky_blue_sel.png)';
		temp=document.getElementById('lista_productos').rows[0];
		document.getElementById('lista_productos').rows[0].cells[0].childNodes[0].checked=true;

	}catch(e){
	
	}

}
</script>

<body onLoad="iniciar();">
<form id="form1" name="form1" method="post" action="">
  <table width="786" height="188" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="13">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr  style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="1033" height="27" colspan="11" style="border:#999999">
	  <span class="Estilo21 Estilo19 Estilo1 Estilo15"><strong> Log&iacute;stica :: Inventarios :: Kardex F&iacute;sico
        <input name="auxiliar" type="hidden" id="auxiliar" value="<?php echo $tipo_aux; ?>">
      </span></td>
    </tr>
    <tr>
      <td height="78">&nbsp;</td>
      <td><fieldset>
      <table width="625" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="173"><span class="Estilo7 ">Empresas</span></td>
          <td width="200"><span class="Estilo7 ">Tiendas</span></td>
          <td width="141"><span class="Estilo7 ">Rango de Fechas : </span></td>
          <td width="120">&nbsp;</td>
        </tr>
        <tr>
          <td height="26"><label>
            <select style="width:160"  name="sucursal" onChange="doAjax('../carga_cbo_tienda.php','&kardex=s&codsuc='+document.form1.sucursal.value,'cargar_cbo','get','0','1','','')" >
             
              <?php 
		// <option value="0">Todas</option>
		 $resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn); 
		while($row1=mysql_fetch_array($resultados1))
		{
		?>
              <option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
              <?php }?>
            </select>
          </label></td>
          <td><div id="cbo_tienda">
              <select  style="width:160" name="almacen"  onBlur="">
                <option value="0">Todas</option>
              </select>
          </div></td>
          <?php 
			$temp_fecha=date('d-m-Y');
			$fecha=explode("-",$temp_fecha);
			$fecha1='01-'.$fecha[1]."-".$fecha[2];
			//$fecha1=$fecha[0]."-".$fecha[1]."-01";
			$fecha2=$temp_fecha;
			?>
          <td colspan="2">del:
              <input name="text" type="text"  id="fecha1" value="<?php echo $fecha1?>" size="10" maxlength="10"/>
              <button type="reset" id="f_trigger_b1"  style="height:18" >...</button>
            <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha1",      
        ifFormat       :    "%d-%m-%Y",      
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
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b2",   
        singleClick    :    true,           
        step           :    1                
    });
              </script></td>
        </tr>
        <tr>
          <td height="23"><strong>Busqueda por Aprox. : </strong></td>
          <td colspan="2"><strong>
            <select name="criterio">
              <option value="idproducto">C&oacute;digo Sistema</option>
              <option value="nombre" selected>Descripci&oacute;n</option>
              <option value="cod_prod">C&oacute;digo anexo</option>
            </select>
            </strong>
              <input autocomplete="off"  name="valor" type="text" size="25" onKeyUp="buscar_prod()"></td>
          <td>&nbsp;</td>
        </tr>
      </table>
      </fieldset></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="74">&nbsp;</td>
      <td><table width="735" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr style="background:url(../imagenes/bg_contentbase4.gif); background-position:100px 50px">
          <td width="56" height="21" align="center"><span class="Estilo2">OK</span></td>
          <td width="82" align="center"><span class="Estilo2">C&oacute;digo</span></td>
          <td width="85" align="center"><span class="Estilo2">Cod.Anexo</span></td>
          <td width="365"><span class="Estilo2">Descripci&oacute;n</span></td>
          <td width="162"><span class="Estilo2">Unidad</span></td>
        </tr>
        <tr>
          <td colspan="5">
		  <div id="productos" style="width:750px; height:180px; overflow:scroll ; border:#CCCCCC solid 1px; background:#F4F4F4" >
		  <?php /*?><table  width="730" height="24" border="0" cellpadding="0" cellspacing="1" id="lista_productos">
            
			
			<?php 
			
			$strSQL="select *  from producto where kardex='S' order by nombre";
			$resultado=mysql_query($strSQL,$cn);
			while($row=mysql_fetch_array($resultado)){
			?>
			
			<tr style="background:#FFFFFF" onClick="entrada(this)" onDblClick="mostrar_kardex()">
              <td width="51" align="center"><input style="background:none; border:none;" type="radio" name="xproducto" value="<?php echo $row['idproducto']?>" /></td>
              <td width="76" align="center"><?php echo $row['idproducto']?></td>
              <td width="451" style="color:#333333"><?php echo $row['nombre']?></td>
              <td width="147"><?php 
			
			$strSQL23="select * from unidades where id='".$row['und']."' ";
			$resultado23=mysql_query($strSQL23,$cn);
			$row23=mysql_fetch_array($resultado23);
			echo $row23['descripcion'];
			  
			   ?>
			  </td>
            </tr>
			
			<?php }?>
          </table><?php */?>
		  </div>		  </td>
          </tr>
        
        <tr>
          <td colspan="5" height="5"></td>
        </tr>
        <tr>
          <td colspan="4"><table width="306" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="2" align="center"  valign="bottom"></td>
              <td width="311" valign="bottom" align="center">
			  <fieldset>
                <table width="237" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="29"><input checked="checked" style="border: none; background:none;" name="radiobutton" type="radio" value="radiobutton"></td>
                    <td width="95"><strong>Por Producto </strong></td>
                    <td width="27"><input style="border: none; background:none;" name="radiobutton" type="radio" value="radiobutton"></td>
                    <td width="103"><strong>Por Selecci&oacute;n </strong></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="3"><p>
                        <label></label>
                        <label>
                        <input type="radio" style="border: none; background:none;" name="GrupoOpciones1" value="opci&oacute;n">
                          Marcar Todos</label>
                        <br>
                        <label>
                        <input type="radio" style="border: none; background:none;" name="GrupoOpciones1" value="opci&oacute;n">
                          Desmarcar Todos</label>
                        <br>
                        <br>
                    </p></td>
                  </tr>
                </table>
              </fieldset> 			  </td>
            </tr>
          </table></td>
          <td><table width="108" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="50" height="30" align="center"><img onClick="javascript:mostrar_kardex('V')" style="cursor:pointer" src="../imgenes/procesar.gif" width="20" height="20"></td>
              <td width="50" align="center"><img onClick="javascript:mostrar_kardex('E')"  src="../imagenes/ico-excel.gif" width="22" height="22"></td>
            </tr>
            <tr>
              <td><span class="Estilo3"><strong>Procesar</strong></span></td>
              <td align="center"><span class="Estilo3"><strong>Excel </strong></span></td>
            </tr>
          </table></td>
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


var criterio=document.form1.criterio.value;


doAjax('lista_prod_kardex.php','&valor='+document.form1.valor.value+'&criterio='+criterio,'mostrar_filtro','get','0','1','','');

}

function mostrar_filtro(texto){
//alert(texto);
document.getElementById('productos').innerHTML=texto;


cargar();
}



function mostrar_kardex(valor){

	//if(document.form1.sucursal.value!=0){
			 
			for (var i=0;i<document.form1.xproducto.length;i++){ 
			   if (document.form1.xproducto[i].checked) {
			   var codigo=document.form1.xproducto[i].value;

			   break; 
			   }
				//  
			} 
		//	alert(document.form1.xproducto.length);
			
		
		
		 for (i=0;i<document.form1.sucursal.options.length;i++)
        {
		
         if (document.form1.sucursal.options[i].value==document.form1.sucursal.value)
            {
			   var des_suc=document.form1.sucursal.options[i].text;
            }
        
        }
		des_suc=des_suc.replace('&',"|");
		
		 for (i=0;i<document.form1.almacen.options.length;i++)
        {
		
         if (document.form1.almacen.options[i].value==document.form1.almacen.value){
			   var des_tie=document.form1.almacen.options[i].text;
            }
        
        }
			
		
		if(valor=='E'){
		
		window.open("resultado_kardex.php?cod_prod="+codigo+"&des_tie="+des_tie+"&des_suc="+des_suc+"&sucursal="+document.form1.sucursal.value+"&tienda="+document.form1.almacen.value+"&fecha1="+document.form1.fecha1.value+"&fecha2="+document.form1.fecha2.value+'&excel',"vent","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=890, height=400,left=100 top=250");
		
		
		}else{
		
		window.open("resultado_kardex.php?cod_prod="+codigo+"&des_tie="+des_tie+"&des_suc="+des_suc+"&sucursal="+document.form1.sucursal.value+"&tienda="+document.form1.almacen.value+"&fecha1="+document.form1.fecha1.value+"&fecha2="+document.form1.fecha2.value,"vent","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=890, height=400,left=100 top=250");
		}
		
	//}else{
	
//	alert('Debe seleccionar una Empresa');
	//}
	
}


function iniciar(){
selecComboSuc();
}
function selecComboSuc(){
 	 var valor1=tempSucursal;
     var i;
	 for (i=0;i<document.form1.sucursal.options.length;i++)
        {
		
            if (document.form1.sucursal.options[i].value==valor1)
               {
			   
               document.form1.sucursal.options[i].selected=true;
               }
        
        }
		
		gene();
				
}

function gene(){
doAjax('../carga_cbo_tienda.php','&kardex=s&codsuc='+document.form1.sucursal.value,'cargar_cbo','get','0','1','','');
}


function seleccionar_combo(){

 	 var valor1=tempTienda;
     var i;
	 for (i=0;i<document.form1.almacen.options.length;i++)
        {
		
            if (document.form1.almacen.options[i].value==valor1)
               {
			   
               document.form1.almacen.options[i].selected=true;
               }        
        }
		
		document.form1.sucursal.disabled=true;
		document.form1.almacen.disabled=true;
			
}

</script>