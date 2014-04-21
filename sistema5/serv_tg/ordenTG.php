<?php 
session_start();
include("../conex_inicial.php");
include('../funciones/funciones.php');
unset($_SESSION['xcodprod']);
unset($_SESSION['xdesprod']);
unset($_SESSION['xcantidad']);

$codigo = $_REQUEST['CodDoc'];
$txtFec = $_REQUEST['txtFec'];

$tipodoc="2";
$doc=$_REQUEST['doc'];
$numero=$_REQUEST['numero'];

list($serieS1)=mysql_fetch_row(mysql_query("select serie from docuser where usuario='".$_SESSION['codvendedor']."' and doc='S1' "));
list($serieR1)=mysql_fetch_row(mysql_query("select serie from docuser where usuario='".$_SESSION['codvendedor']."' and doc='R1' "));




$serie=$serieR1;//$_REQUEST['serie'];
$cod_vendedor=$_REQUEST['cod_vendedor'];
$cliente=$_REQUEST['cliente'];
$txtFecI=$_REQUEST['txtFecI'];
$txtFecT=$_REQUEST['txtFecT'];
$tienda=$_REQUEST['tienda'];
$sucursal=$_REQUEST['sucursal'];
$cod_re=$_REQUEST['referencia'];

//if(isset($_REQUEST['referencia'])){
//}else{
	$strSQL01="select max(Num_doc) as numero from cab_mov where tipo='".$tipodoc."' and cod_ope='R1' and serie='".$serie."' ";
//}
if(isset($_REQUEST['referencia'])){
echo "<script>alert('Opcion activada proximamente');close();</script>";
}
$resultado01=mysql_query($strSQL01,$cn);
$row01=mysql_fetch_array($resultado01);
$numero=str_pad($row01['numero']+1, 7, "0", STR_PAD_LEFT);

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Servicio Tecnico y Garantias (ORDEN)</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 11px;
}
.Estilo8 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #FFFFFF; font-weight: bold; }
.Estilo10 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
	color: #0066CC;
}
.Estilo14 {font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color:#333333 }
-->
</style></head>

<script type="text/javascript" src="../javascript/mover_div.js"></script>
<script language="javascript" src="../miAJAXlib2.js"></script>
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>

    <script src="../jquery-1.2.6.js"></script>
    <script src="../jquery.hotkeys.js"></script>
<link href="../styles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script>
var scrollDivs=new Array();
scrollDivs[0]="productos";
var temp_tienda="<?php echo $_SESSION['user_tienda']; ?>";
var temp_sucursal="<?php echo $_SESSION['user_sucursal']; ?>";
</script>
<body onLoad="iniciar();carga_div2();" onUnload="vaciar_sesiones()">
<form name="formulario" method="post" action="">
  <table width="631" border="0">
    <tr>
      <td width="1" height="30" bgcolor="#F5F5F5">&nbsp;</td>
      <td colspan="5" align="center" bgcolor="#F5F5F5"><span class="Estilo10">Generador de Orden</span>
<input name="tipomov"  type="hidden" value="2" size="5" />
<input name="tempauxprod"  type="hidden" value=""  size="5" />
<input name="tmoneda" type="hidden" size="5" maxlength="10" value="02">
<input name="prov_asoc" type="hidden" size="8" maxlength="150">
<input name="busqueda3" type="hidden" size="8" maxlength="150">
<input type="hidden" name="uni_p" id="uni_p" value="" size="5">

<input type="hidden" name="uni_p" id="uni_p" value="" size="5">
			<input name="factor_p" type="hidden" id="factor_p" value="" size="5">
            <input type="hidden" name="precio_p" id="precio_p" value="" size="5">
			<input type="hidden" name="prod_moneda" id="prod_moneda" value="" size="5">
			<input name="series" type="hidden" id="series" value="" size="3" maxlength="3">
			<input name="pruebas" type="hidden" value='' size="5">
			<input name="serie_ing" type="hidden" id="serie_ing" value="" size="3" maxlength="3">
			<input name="kardex_prod" id="kardex_prod" type="hidden" size="6" maxlength="6" value="">
			
			<input name="precosto" type="hidden" id="precosto" value="" size="5" maxlength="3">
			<input name="codBarraEnc" id="codBarraEnc" type="hidden" value="">
            <input name="cod_ref" id="cod_ref" type="hidden" value="">
            <input name="cod_cab_ref2" id="cod_cab_ref2" type="hidden" value="">
            <input name="serie_ref" id="serie_ref" type="hidden" value="">
            <input name="correlativo_ref" id="correlativo_ref" type="hidden" value="">
			<input name="serieS1" id="serieS1" type="hidden" value="<?php echo $serieS1?>">
			<input name="serieR1" id="serieR1" type="hidden" value="<?php echo $serieR1?>">			
			
				  </td>
      <td width="17" bgcolor="#F5F5F5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="Estilo1">Empresa</span></td>
      <td><select style="width:160"  name="sucursal" <?php /*?>onChange="doAjax('../carga_cbo_tienda.php','&codsuc='+document.formulario.sucursal.value,'cargar_cbo','get','0','1','',''); "<?php */?> >
        <option value="0"></option>
        <?php 		
  $resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn); 
  $k=0;
while($row1=mysql_fetch_array($resultados1))
{
/*echo "<script> array_idsuc[$k]='".$row1['cod_suc']."'; array_percepsuc[$k]='".$row1['percepcion']."'; </script>";*/
		?>
        <option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
        <?php 
			  
$k++;
}?>
      </select></td>
      <td><span class="Estilo1">N&uacute;mero:</span> </td>
      <td width="44"><input readonly="readonly" name="num_serie" id="num_serie" type="text" size="5" maxlength="3" value="<?php echo $serie?>"></td>
      <td width="115"><div id="Cod_docTG">
        <input readonly="readonly" name="num_correlativo" id="num_correlativo" type="text" size="10" maxlength="7" value="<?php echo $numero; ?>">
		</div>
        <input name="accion" type="hidden" id="accion" value="" size="5">
        <input name="cod_cabOT" type="hidden" id="cod_cabOT" value="<?php echo $_REQUEST['CodDoc']?>" size="10"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="Estilo1">Tienda</span></td>
      <td><span class="Estilo15">
		   <div id="cbo_tienda">
		     <select  style="width:160" name="almacen"  onBlur="">
               <option value="0"></option>
             </select>
		   </div>    
            </span></td>
      <td><span class="Estilo1">Fec. Emisi&oacute;n:</span></td>
      <td colspan="2"><input name="femi" type="text" size="15" maxlength="10" value="<?php echo date('d-m-Y')?>"   onChange="enfocar_fecha(this)" >
		  		  				  
	  <button type="reset" id="f_trigger_b2"  style="height:18" >...</button>	    <script type="text/javascript">
    Calendar.setup({
        inputField     :    "femi",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b2",   
        singleClick    :    true,           
        step           :    1                
    });
            </script>	</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="Estilo1">Doc</span></td>
      <td><select name="doc" id="doc" style="width:200" onBlur="guardar('C');" onChange="guardar('C');" >
                <?php 
	$resultados11 = mysql_query("select * from operacion where codigo='S1' or codigo='R1' order by descripcion ",$cn); 
	while($row11=mysql_fetch_array($resultados11)){
					
		  ?>
                <option value="<?php echo $row11['codigo']?>"><?php echo $row11['codigo'].' - '.$row11['descripcion'];?></option>
                <?php 
			  }
			  ?>
              </select></td>
      <td><span class="Estilo1">Fec.Venc:</span></td>
      <td colspan="2"><input name="fven" type="text" size="15" maxlength="10"  value="<?php echo date('d-m-Y')?>" onChange="enfocar_fecha(this)">
		  <button type="reset" id="f_trigger_b1" style="height:18; vertical-align:top" >...</button>
      <script type="text/javascript">
			  
			  var doc_p1="<?php echo $p1 ?>";

			  
    Calendar.setup({
        inputField     :    "fven",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b1",   
        singleClick    :    true,           
        step           :    1                
    });
            </script>	</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="Estilo1">Cliente:</span></td>
      <td><span class="Estilo15">
            <input autocomplete="off" name="auxiliar" type="text" size="18" maxlength="50" onKeyUp="validartecla(event,this,'auxiliares')">
            <input name="auxiliar2" type="hidden" size="3"  value=""/>
			<button title="[Alt+r]" onClick="vent_ref()" type="button" id="doc_ref"  style="height:18px"><span style=" font-family:Arial, Helvetica, sans-serif;font-size:9px">Documentos</span></button>
          </span></td>
      <td><span class="Estilo1">Responsable</span></td>
      <td colspan="2"><select name="responsable" style="width:120" onChange="" >
		  <?php 
			$marcar="";
		    $resultados11 = mysql_query("select * from usuarios order by usuario ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			$marcar="";
			if($row11['codigo']==$_SESSION['codvendedor']){
			$marcar=" selected='selected' ";
			}
		  ?>
		  <option <?php echo $marcar?> value="<?php echo $row11['codigo']?>"><?php echo $row11['usuario'];?></option>
			  <?php }?>
      </select></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
    <td><div id="new_aux" style="position:absolute; left:65px; top:128px; width:300px; height:180px; z-index:2; visibility:hidden">
<!--  ; visibility:hidden-->
  <table width="392" height="72" border="1" cellpadding="0" cellspacing="0" bgcolor="#FEF5E2"><!--FFD3B7-->
  <tr>
    <td>
	<table width="413" border="0" cellpadding="0" cellspacing="0">
      <tr>
	      <td colspan="5" align="right"></td>
      </tr>
      <tr style="background:url(../imagenes/bg_contentbase2.gif) 100% 70%">
        <td width="20" height="23">&nbsp;</td>
        <td colspan="2"><span class="text5 Estilo116"><font face="Verdana, Arial, Helvetica, sans-serif" color="#FFFFFF"><strong>Nuevo Auxiliar </strong></font></span></td>
        <td colspan="2">&nbsp;</td>
      </tr>
      
      <tr>
        <td colspan="5" height="10"></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td width="62" align="center"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">T. pers.</span>: </td>
        <td colspan="2"><input name="persona" type="radio" value="J" style="border:none; background:none" onClick="validarNewClie(this)" />
          <span style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold; color:#0066FF">Juridica.</span>
          <input style="border:none; background:none" checked="checked" name="persona" type="radio" value="N" onClick="validarNewClie(this)" />
  <span style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold; color:#0066FF">Natural.</span></td>
        <td width="158"><input name="accionAux" type="hidden" id="accionAux" size="5" maxlength="5">
          <input name="codClie" type="hidden" id="codClie" size="5" maxlength="5"></td>
      </tr>
      <tr>
        <td height="20">&nbsp;&nbsp;</td>
        <td align="center"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Ruc</span></td>
        <td width="159"><input name="aux_ruc" type="text" size="17" maxlength="11"  disabled="disabled" /></td>
        <td colspan="2"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Dni/CE</span>
          <input name="aux_dni" type="text" size="15" maxlength="8" />
		  <script>
		  function validarNewClie(control){
			  if(control.name=='persona'){
			  	if(control.value=='J'){
				  document.formulario.aux_dni.value="";
				  document.formulario.aux_dni.disabled=true;
				  document.formulario.aux_ruc.disabled=false;
				  document.formulario.aux_ruc.focus();
				}else{
				  document.formulario.aux_ruc.value="";
				  document.formulario.aux_ruc.disabled=true;
				  document.formulario.aux_dni.disabled=false;
				  document.formulario.aux_dni.focus();  
				}
			  }
		  
		  }
		  
		  </script>		  </td>
      </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td align="center" style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Cli./Razon</td>
        <td colspan="3"><input name="aux_razon" type="text" size="42" maxlength="100" /></td>
        </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td align="center"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">Contacto</span></td>
        <td><input name="aux_contacto" type="text" size="25" maxlength="100" /></td>
        <td width="45"><span style="font-size: 10px; color: #333333">Telefono</span></td>
        <td><input type="text" name="tel_auxi" id="tel_auxi" value=""></td>
        </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td align="center"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Cargo</span></td>
        <td><input type="text" name="aux_cargo" /></td>
        <td><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Correo</span></td>
        <td><input type="text" name="correo_auxi" id="correo_auxi" value=""></td>
        </tr>
      <tr>
        <td height="30">&nbsp;</td>
        <td><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Direcci&oacute;n</span></td>
        <td colspan="3"><textarea name="aux_direccion" cols="42" rows="3"></textarea></td>
        </tr>
      <tr>
        <td height="29">&nbsp;</td>
        <td colspan="4" align="left"><input type="button" name="Submit" value="Guardar" onClick="guardar_aux();" />
          <input type="button" name="Submit2" value="Cancelar" onClick="cancel_nuevo_aux()" /></td>
        </tr>
	     <tr>
        <td height="10"></td>
        <td></td>
        <td></td>
      </tr>
    </table>
    </td>
  </tr>
  
</table>

  </div></td></tr>
    <tr id="servic" style="display:none">
      <td>&nbsp;</td>
      <td class="Estilo1">Tipo Servicio</td>
      <td colspan="4"><select name="tservi" id="tservi" style="width:200" onChange="VerificaHist()" >
        <option value="-">Seleccione un Tipo de Servicio</option>
        <?php 
	$resultados11 = mysql_query("select * from producto where upper(substr(nombre,1,8))='SERVICIO' order by nombre ",$cn); 
	while($row11=mysql_fetch_array($resultados11)){
					
		  ?>
        <option value="<?php echo $row11['idproducto']?>"><?php echo $row11['nombre'];?></option>
        <?php 
			  }
			  ?>
      </select><button title="[Alt+H]" onClick="ConsultaHist4('existe2')" disabled type="button" id="doc_hist"  style="height:18px"><span style=" font-family:Arial, Helvetica, sans-serif;font-size:9px">Historia</span></button></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td width="73"><span class="Estilo1">Producto: </span></td>
      <td width="269">
	  <!--onKeyUp="validartecla(event,this,'productos')"-->
	  <input type="text" name="termino" id="termino" onKeyUp="validartecla(event,this,'productos')" >
         <!--<button  id="btn_transp" type="button" title="Seleccione poroducto" style="height:18; vertical-align:top" onClick="cambiar_chofer('P')" >...</button>-->
      <input type="hidden" name="codprod" id="codprod">
      <input type="hidden" name="serie_prod" id="serie_prod">
	  <input  name="punit" type="hidden" size="8" style=" text-align:right"  />	  
	  <span class="Estilo1">
	  <input name="cantidad" type="hidden" disabled id="cantidad" value="1" size="5" >
	  </span></td>
      <td width="82"><span class="Estilo1">Condici&oacute;n </span></td>
      <td colspan="2"><span class="Estilo15">
            <div id="cbo_cond">
              <select name="condicion" style="width:120" onChange=""  onFocus="cbo_cond()">
                <?php 
			$marcar="";
		    $resultados11 = mysql_query("select * from condicion order by codigo ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){					
		  ?>
                <option <?php echo $marcar?> value="<?php echo $row11['codigo']?>"><?php echo $row11['nombre'];?></option>
                <?php 
			  }
			  ?>
              </select>
            </div>
      </span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="Estilo1">Texto:</td>
      <td><input type="text" name="termino2" id="termino2">
        <span class="Estilo15">
        <input name="AddProd" type="button" id="AddProd" onClick="insertMat()" value="Insertar Item">
      </span></td>
      <td><span class="Estilo1">Moneda
        
      </span></td>
      <td colspan="2"><span class="Estilo15">
        <select onChange="Cambiar_Moneda(this)" name="cbomon" id="cbomon">
          <option value="01">Soles</option>
          <option value="02" selected>D&oacute;lares</option>
        </select>
      </span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td colspan="5">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="65">&nbsp;</td>
      <td colspan="5" valign="top">
	  <div id="detSalMat">
	  <table width="598" border="0" cellpadding="0" cellspacing="0">
          <tr style="background:url(../imagenes/bg_contentbase2.gif); background-position:100 60">
            <td width="77"><span class="Estilo8">&nbsp;&nbsp;C&oacute;digo</span></td>
            <td width="373"><span class="Estilo8">Descripci&oacute;n</span></td>
            <td width="59"><span class="Estilo8">Cantidad</span></td>
            <td width="58"><span class="Estilo8">Precio</span></td>
            <td width="31">&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#F5F5F5">&nbsp;</td>
            <td bgcolor="#F5F5F5">&nbsp;</td>
            <td bgcolor="#F5F5F5">&nbsp;</td>
            <td bgcolor="#F5F5F5">&nbsp;</td>
            <td bgcolor="#F5F5F5">&nbsp;</td>
          </tr>
      </table>
	  </div>	  </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="22">&nbsp;</td>
      <td colspan="5" valign="top">
          <table width="598" border="0" cellpadding="0" cellspacing="0" id="tbserie" style="visibility:hidden">
          	<tr style="background:url(../imagenes/bg_contentbase2.gif); background-position:100 60">
            	<td width="106"><span class="Estilo8">Serie:</span></td>
                <td width="492"><input type="text" name="serietec" value="" id="serietec">
          	</tr>
          </table>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="46">&nbsp;</td>
      <td colspan="5" valign="top">
          <table width="598" border="0" cellpadding="0" cellspacing="0">
          	<tr style="background:url(../imagenes/bg_contentbase2.gif); background-position:100 60">
            	<td width="104"><span class="Estilo8">Descripci&oacute;n:</span></td>
                <td width="494"><textarea rows="3" cols="75" name="txtdescrip" value="" id="txtdescrip"></textarea></td>
          	</tr>
          </table>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="62">&nbsp;</td>
      <td colspan="5" valign="top">
          <table width="598" border="0" cellpadding="0" cellspacing="0">
          	<tr style="background:url(../imagenes/bg_contentbase2.gif); background-position:100 60">
            	<td width="104"><span class="Estilo8">Observaciones:</span></td>
                <td width="494"><textarea rows="3" cols="75" name="txtobs" value="" id="txtobs"></textarea>                </tr>
          </table>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="5" align="center">
	  <input onClick="Actualizar_Precio()" type="button" name="Submit2" value="     Guardar    ">
      <input type="button" name="Submit22" value="     Cancelar   " onClick="Cerrar()">	</td>
      <td>&nbsp;</td>
    </tr>
  </table>
<div id="productos" style="position:absolute; left:5px; top:173px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>
   <div id="auxiliares" style="position:absolute; left:5px; top:121px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>
</form>
</body>
</html>
 <div id="text_coten" ></div>
<script>
var formato="rpt_serv_tec.php";
var tempColor="";
function cambiar_chofer(param){
	doAjax('../peticion_ajax2.php','&peticion=mostrar_chofer&tabla='+param,'listaProd','get','0','1','','');
}

function listaProd(texto){
//alert(texto);
//document.getElementById('productos').style.zIndex='100';
document.getElementById('productos').innerHTML=texto;
document.getElementById('productos').style.visibility="visible";
}

function sel_chofer(codigo,nombre){
	alert('chofer');
		document.formulario.codprod.value=codigo;
		document.formulario.termino.value=nombre;
	
salir();
}

function salir(){
document.getElementById('productos').style.visibility="hidden";
document.formulario.cantidad.focus();

}

var temp2="";

function entrada(objeto){
/*	//objeto.cells[0].childNodes[0].checked=true;
	//temp=objeto;
		if(objeto.style.background=='url(../imagenes/sky_blue_sel.png)'){
	//objeto.style.background=objeto.bgColor;
		}else{
		objeto.style.background='url(../imagenes/sky_blue_sel.png)';
			if(temp2!=''){
			//alert(temp.style.background);
			//alert(objeto.bgColor);
			temp2.style.background=temp2.bgColor;
			}
			temp2=objeto;
		}*/
	if(tempColor==""){
	tempColor=document.getElementById('tblproductos').rows[0];
	}
		try{
		tempColor.style.background='#ffffff';
			if(objeto.style.background=='#fff1bb'){
		//objeto.style.background=objeto.bgColor;
		//temp=objeto;
			}else{
			objeto.style.background='#fff1bb';
				if(temp2!=''){
				//alert(temp.style.background);
				//alert(objeto.bgColor);
				temp2.style.background=temp2.bgColor;
				}
				temp2=objeto;
			}
		}catch(e){}
	
}

function busqueda_chofer(pag){

var tabla="P";
var valor=document.formulario.valor_chofer.value;

doAjax('../peticion_ajax2.php','&peticion=buscar_chofer&valor='+valor+'&tabla='+tabla+'&pag='+pag,'mostrar_bus_chofer','get','0','1','','');
}

function cargar_datos(pag){
busqueda_chofer(pag);
}

function mostrar_bus_chofer(texto){
temp=texto.split("~");
document.getElementById('detalle_chofer').innerHTML=temp[0];
document.getElementById('divpagina').innerHTML=temp[1];

}


function insertMat(){
var tservi=document.formulario.tservi.value;
if(tservi=="-" && document.formulario.doc.value=="S1"){
	alert("Seleccionar un Tipo Servicio");
	document.formulario.tservi.focus();
}else{
	var codprod=document.formulario.codprod.value;
	var moneda=document.formulario.cbomon.value;
	if(document.formulario.termino2.value!=""){
		var desprod="&codprod=TEXTO&descrip="+document.formulario.termino2.value;
	}else{
		var desprod="&codprod="+codprod;
	}
	//alert(desprod);
	var serie_prod=document.formulario.serie_prod.value;
	var cantidad=document.formulario.cantidad.value;

	document.formulario.sucursal.disabled='disabled';
	document.formulario.almacen.disabled='disabled';
	document.formulario.doc.disabled='disabled';

	document.formulario.doc_ref.disabled='disabled';
	document.formulario.auxiliar.disabled='disabled';
	document.formulario.AddProd.disabled='disabled';
	if(document.formulario.tservi!=undefined){
		document.formulario.tservi.disabled='disabled';
	}
	if(document.formulario.doc.value!="R1"){
		tservi='&tservi='+tservi;
	}else{
		tservi='';
	}
	//alert('&peticion=detSalMat&moneda='+moneda+'&serie_prod='+serie_prod+desprod+'&cantidad='+cantidad+tservi);
	if(serie_prod==''){
		doAjax('../peticion_ajax3.php','&peticion=detSalMat&moneda='+moneda+desprod+'&cantidad='+cantidad+tservi,'rspta_detSalMat','get','0','1','','');
	}else{
		doAjax('../peticion_ajax3.php','&peticion=detSalMat&moneda='+moneda+'&serie_prod='+serie_prod+desprod+'&cantidad='+cantidad+tservi,'rspta_detSalMat','get','0','1','','');
	}
}

}
function rspta_detSalMat2(texto){
	document.getElementById('detSalMat').innerHTML=texto;
}

function rspta_detSalMat(texto){
//alert(texto);
document.getElementById('detSalMat').innerHTML=texto;
if(document.getElementById('doc').value=='S1'){
	document.getElementById('pre_det').focus();
	document.getElementById('pre_det').select();
}
document.formulario.termino.disabled='disabled';
document.formulario.termino2.disabled='disabled';
//document.formulario.codprod.value="";
//document.formulario.termino.value="";
//document.formulario.cantidad.value="1";
//document.formulario.desprod.focus();
}

function vaciar_sesiones(){

doAjax('../peticion_ajax3.php','&peticion=detSalMat&accion=salir','','get','0','1','','');
}

function eliminar(item){
	document.formulario.cod_cab_ref2.value='';
	document.formulario.serie_ref.value='';
	document.formulario.correlativo_ref.value='';
	if(document.formulario.doc.value=='R1'){
		document.formulario.AddProd.disabled='disabled';
		document.getElementById('doc_ref').disabled='';
		document.getElementById('servic').style.display='none';
	}else{
		document.formulario.AddProd.disabled='';
		document.getElementById('doc_ref').disabled='disabled';
		document.formulario.termino.disabled='';
		document.formulario.termino.value='';
		document.formulario.termino2.disabled='';
		document.formulario.termino2.value='';
		document.getElementById('servic').style.display='block';
	}
	//document.formulario.sucursal.disabled='';
	//document.formulario.almacen.disabled='';
	//document.formulario.doc.disabled='';
	if(document.formulario.tservi!=undefined){
		document.formulario.tservi.disabled='';
		document.formulario.tservi.focus();
	}
	//document.formulario.tservi.disabled='';
	document.formulario.auxiliar.disabled='';
doAjax('../peticion_ajax3.php','&peticion=detSalMat&accion=eliminar&item='+item,'rspta_detSalMat','get','0','1','','');
}

function guardar(Valor){
	if(document.formulario.doc.value=='S1'){
		document.formulario.num_serie.value=document.formulario.serieS1.value;
	}else{
		document.formulario.num_serie.value=document.formulario.serieR1.value;
	}

	document.formulario.accion.value='G';
	//$tipodoc=document.formulario.accion.value;
	doc_ref=document.formulario.cod_cab_ref2.value;
	ser_ref=document.formulario.serie_ref.value;
	cor_ref=document.formulario.correlativo_ref.value;
	doc=document.formulario.doc.value;
	numero=document.formulario.num_correlativo.value;
	serie=document.formulario.num_serie.value;
	cod_vendedor=document.formulario.responsable.value;
	cliente=document.formulario.auxiliar2.value;
	txtFecI=document.formulario.femi.value;
	txtFecT=document.formulario.femi.value;
	tienda=document.formulario.almacen.value;
	sucursal=document.formulario.sucursal.value;
	condicion=document.formulario.condicion.value;
	moneda=document.getElementById('cbomon').value;
	serie_tec=document.getElementById('serietec').value;
	obs=document.getElementById('txtobs').value;
	descrip=document.getElementById('txtdescrip').value;
	accion=Valor;//document.formulario.accion.value;
	if(doc_ref!=''){
		refer='&cod_ref='+doc_ref+'&serie_ref='+ser_ref+'&cor_ref='+cor_ref+'&referencia';
	}else{
		refer='';
	}

	if(serie_tec!=""){
		st='&serie_tec='+serie_tec;
	}else{
		st='';
	}
	if (accion=='G'){
		if(doc=='S1' && document.formulario.pre_det.value==0.00){
			alert('No se permite grabar Servicio Tecnico sin precio');
		}else{
			if(obs=='' || descrip==''){
				alert('Debe llenar los campos de observaciones y Descripcion');
			}else{
			alert(st);
				doAjax('pedir_dato.php',st+'&doc='+doc+'&numero='+numero+'&serie='+serie+'&moneda='+moneda+'&cod_vendedor='+cod_vendedor+'&cliente='+cliente+'&txtFecI='+txtFecI+'&txtFecT='+txtFecT+'&tienda='+tienda+'&sucursal='+sucursal+'&accion='+accion+'&condicion='+condicion+refer+'&observacion='+obs+'&descrip='+descrip,'mantGuardar','get','0','1','','');
			}
		}
	}else{
		if(document.formulario.doc.value=='S1'){
			document.getElementById('doc_ref').disabled='disabled';
			document.formulario.AddProd.disabled='';
			document.formulario.termino.disabled='';
			document.formulario.termino.value='';
			document.formulario.termino2.disabled='';
			document.formulario.termino2.value='';
			document.getElementById('tbserie').style.visibility='visible';
			document.getElementById('servic').style.display='block';
		}else{
			document.getElementById('doc_ref').disabled='';
			document.formulario.AddProd.disabled='disabled';
			document.formulario.termino.disabled='disabled';
			document.formulario.termino2.disabled='disabled';
			document.getElementById('tbserie').style.visibility='hidden';
			document.getElementById('servic').style.display='none';
			//document.getElementById('doc_ref').click();
		}
		//alert(serie);
		doAjax('pedir_dato.php','&doc='+doc+'&numero='+numero+'&serie='+serie+'&cod_vendedor='+cod_vendedor+'&cliente='+cliente+'&txtFecI='+txtFecI+'&txtFecT='+txtFecT+'&tienda='+tienda+'&sucursal='+sucursal+'&accion='+accion+'&condicion='+condicion,'GenCodigoTG','get','0','1','','');
	}
}

function mantGuardar(texto){
	//document.getElementById('text_coten').innerHTML=texto;
	//alert(texto);
	if(document.formulario.doc.value=="S1"){
		win000=window.open('../empresa1.php'+'?cod='+texto,'Cancelacion','width=600,height=490,top=180,left=200,status=yes,scrollbars=yes');
		win000.focus();
	}else{
		if(confirm("Desea Imprimir el Comprobante?")){
			imprimir(texto);
		}else{
			Cerrar();
		}
	}
}
function imprimir8(cod,monto){
	var win00=window.open('formatos/'+formato+'?cod='+cod+'&vuelto='+monto,'ServicioTecnico','width=850,height=1000,top=100,left=100,scroolbars=yes,status=yes');
	win00.focus();
}
function imprimir(cod){
	//alert(formato);
	//alert(cod)
	var win00=window.open('../formatos/'+formato+'?cod='+cod,'ServicioTecnico','width=850,height=1000,top=100,left=100,scroolbars=yes,status=yes');
	win00.focus();
}
function GenCodigoTG(texto){
	//alert(texto);
	var r = texto.split("|");
	document.getElementById('Cod_docTG').innerHTML=r[0];
	seleccionar_cbo2('cbomon',r[1])
	cbo_cond();
}
function Cerrar(){
	//window.opener.location=window.opener.location;
	if(confirm('Desea crear un nuevo Documento?')){
		location.reload();
	}else{
		window.parent.opener.cargardatos('');
		close();
		return false
	}
}

function iniciar(){

	if( (temp_tienda.length==3 || temp_sucursal!="0") && temp_tienda!=0 ){
	//alert();
		seleccionar_cbo('sucursal',temp_sucursal);
		doAjax('../carga_cbo_tienda.php','&codsuc='+temp_sucursal,'cargar_cbo3','get','0','1','','')
	}
}
function cargar_cbo3(r){
	//alert(r);
    document.getElementById('cbo_tienda').innerHTML=r;
	
		
	if(temp_tienda.length==3){
		seleccionar_cbo('almacen',temp_tienda);
		document.formulario.doc.focus();
	}
		
		
}

function cargar_cbo(texto){
	var r = texto;
	document.getElementById('cbo_tienda').innerHTML=r;
	document.formulario.almacen.focus();
	cargar_cbo_doc();
}
function cargar_cbo_doc(){
	var tipomov=document.formulario.tipomov.value;
	var empresa=document.formulario.sucursal.value;
	doAjax('../carga_cbo_doc.php','&tipomov='+tipomov+'&empresa='+empresa,'res_cargar_cbo_doc','get','0','1','','');
} 
function res_cargar_cbo_doc(texto){
//alert(temp_tienda);
seleccionar_cbo('almacen',temp_tienda);
}

function seleccionar_cbo(control,valor){
		
		 var valor1=valor;
         var i;
		// alert(valor1+" "+control);
	     for (i=0;i< eval("document.formulario."+control+".options.length");i++)
        {
		//alert(eval("document.formulario."+control+".options[i].value")+" "+valor1);
         if (eval("document.formulario."+control+".options[i].value=='"+valor1+"'"))
            {
		//	alert("entro");
			   eval("document.formulario."+control+".options[i].selected=true");
            }
        
        }
if(control=='almacen'){
	//alert();
document.formulario.doc.disabled=false;
if(document.formulario.servi!=undefined){
	document.formulario.servi.disabled=false;
}
//document.formulario.doc.focus();
}
//alert(control);
eval("document.formulario."+control+".disabled=true");
		
}

function seleccionar_cbo2(control,valor){
		 var valor1=valor;
         var i;
	     for (i=0;i< eval("document.formulario."+control+".options.length");i++)
        {
         if (eval("document.formulario."+control+".options[i].value=='"+valor1+"'"))
            {
			   eval("document.formulario."+control+".options[i].selected=true");
            }
        }		
}

 function enfocar_cbo(control){
  }
 function limpiar_enfoque(control){
  
 }
function cambiar_enfoque(control){
}
function validartecla(e,valor,temp){
	if(valor.value.length<3){
	return false;
	}
	
	var tipomov=document.formulario.tipomov.value;
	document.formulario.tempauxprod.value=temp;

	if(document.getElementById('productos').style.visibility=='visible'){
	temp_busqueda=document.formulario.busqueda.value;
	
	}else{
		if(document.getElementById('auxiliares').style.visibility=='visible'){
		temp_busqueda2=document.formulario.busqueda2.value;
		}	
	}
	
	if ( ( (e.keyCode>=96) && (e.keyCode<=105) || (e.keyCode>=48) && (e.keyCode<=57) )  || ((e.keyCode>=65) && (e.keyCode<=90)) || e.keyCode==8 || e.keyCode==32 ) {

		if(document.getElementById(temp).style.visibility!='visible' ){
			doAjax('../compras/lista_aux.php','&temp='+temp+'&tipomov='+tipomov+'&modulo=tranf','listaprod','get','0','1','','');	
		}else{
			var valor="";
			var temp_criterio=temp_busqueda;
			if(document.formulario.tempauxprod.value=='auxiliares'){
			valor=document.formulario.auxiliar.value;
			temp_criterio=temp_busqueda2;
			if(document.getElementById('doc').value=='S1'){
				document.getElementById('doc_ref').disabled='disabled';
			}else{
				document.getElementById('doc_ref').disabled='';
			}
			//selec_busq2();
			}
			if(document.formulario.tempauxprod.value=='productos'){
			valor=document.formulario.termino.value;
			temp_criterio=temp_busqueda;
			//alert();
			selec_busq();
			}
		
			var temp=document.formulario.tempauxprod.value;
			var tipomov=document.formulario.tipomov.value;
			var tienda=document.formulario.almacen.value;			
			var moneda_doc=document.formulario.tmoneda.value;
			//alert(2);
			//var estSP='V';
			//+'&estSP='+estSP
		doAjax('../compras/det_aux.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc='+document.formulario.prov_asoc.value+'&moneda_doc='+moneda_doc+'&servtg','detalle_prod','get','0','1','','');
		}
		
		
}
}
var temp_busqueda2="";
//var temp_busqueda="serie";
var temp_busqueda="descripcion";
function listaprod(texto){
	var r = texto;
	var valor="";
	var temp_criterio='';

	if(document.formulario.tempauxprod.value=='auxiliares'){	
	document.getElementById('auxiliares').innerHTML=r;
	document.getElementById('auxiliares').style.visibility='visible';
	//ocultar_cbos();
	valor=document.formulario.auxiliar.value;
	temp_criterio=temp_busqueda2;	
	
	selec_busq2();
	}
	if(document.formulario.tempauxprod.value=='productos'){
	document.getElementById('productos').innerHTML=r;
	document.getElementById('productos').style.visibility='visible';
	valor=document.formulario.termino.value;
	temp_criterio=temp_busqueda;	
	//alert();	
	selec_busq();
	}
	var temp=document.formulario.tempauxprod.value;
	var tipomov=document.formulario.tipomov.value;
	var tienda=document.formulario.almacen.value;
	var moneda_doc=document.formulario.tmoneda.value;
	var estSP='V';
	doAjax('../compras/det_aux.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc='+document.formulario.prov_asoc.value+'&moneda_doc='+moneda_doc+'&estSP='+estSP+'&servtg','detalle_prod','get','0','1','','');
}		
			
function detalle_prod(texto){
	var r = texto;
	if(document.formulario.tempauxprod.value=='auxiliares'){
	document.getElementById('detalle1').innerHTML=r;
	document.getElementById('tblproductos1').rows[0].style.background='#fff1bb';
	if(document.getElementById('doc').value=='S1'){
		document.getElementById('doc_ref').disabled='disabled';
	}else{
		document.getElementById('doc_ref').disabled='';
	}
	}
	if(document.formulario.tempauxprod.value=='productos'){
	document.getElementById('detalle').innerHTML=r;
	document.getElementById('tblproductos').rows[0].style.background='#fff1bb';
	}
}	
/*	var codigo=objeto.innerHTML;
	var moneda=document.formulario.tmoneda.value;
	var sucursal=document.formulario.sucursal.value;
window.open('../compras/espec_prod.php?codigo='+codigo+'&moneda='+moneda+'&sucursal='+sucursal,'','width=650,height=420,top=100,left=300,scroolbars=yes,directories=no,location=no,menubar=no,titlebar=no,toolbar=no,status=yes');*/
function espec_prod(objeto){
	
//	alert(objeto.parentNode.parentNode.parentNode.rowIndex);
	
	selecionarItem(objeto.parentNode.parentNode.parentNode.rowIndex);
	var codigo=objeto.innerHTML;
	var moneda=document.formulario.tmoneda.value;
	var sucursal=document.formulario.sucursal.value;
	
	//window.open('espec_prod.php?codigo='+codigo+'&moneda='+moneda+'&sucursal='+sucursal,'','width=650,height=420,top=300,left=300,scroolbars=yes,directories=no,location=no,menubar=no,titlebar=no,toolbar=no,status=yes');	
	
	}
	
function selec_busq(){

	 var valor1=temp_busqueda;
 	 var obj=document.formulario.busqueda;
	 if(isset(obj)){ 
		 var i;
		 for (i=0;i<document.formulario.busqueda.options.length;i++)
			{			
				if (document.formulario.busqueda.options[i].value==valor1)
				   {
				   document.formulario.busqueda.options[i].selected=true;
				   }			
			}
	 }	
	}	
function isset(variable_name) {
			try {
				 if (typeof(eval(variable_name)) != 'undefined')
				 if (eval(variable_name) != null)
				 return true;
			 } catch(e) { }
			return false;
		   }	  
function selec_busq2(){
	 var valor1=temp_busqueda; 
     var i;	
	 for (i=0;i<document.formulario.busqueda2.options.length;i++)
        {		
            if (document.formulario.busqueda2.options[i].value==valor1)
               {
			   document.formulario.busqueda2.options[i].selected=true;
               }        
        }	
	}


function salir(){				
		var nombreVariable=document.getElementById('MB_frame');
		
		/*if(isset(nombreVariable)){
		Modalbox.hide();
		return false;		
		}*/	
	

	if(document.getElementById('productos').style.visibility=='hidden' && document.getElementById('auxiliares').style.visibility=='hidden' && document.getElementById('new_aux').style.visibility=='hidden') {
			if(confirm("Esta seguro que desea salir...")){
					var total_doc=document.formulario.total_doc.value;
					var sucursal=document.formulario.sucursal.value;
					var tienda=document.formulario.almacen.value;
					var numero=document.formulario.num_correlativo.value;
					var serie= document.formulario.num_serie.value;
					var doc=document.formulario.doc.value;
					var tipomov=document.formulario.tipomov.value;
					var auxiliar=document.formulario.auxiliar2.value;

					//alert();
					if(document.formulario.num_correlativo.disabled && (document.getElementById('estado').innerHTML=="INGRESO" ||  document.getElementById('estado').innerHTML=="")){
				doAjax('../compras/peticion_datos.php','&sucursal='+sucursal+'&tienda='+tienda+'&numero='+numero+'&serie='+serie+'&doc='+doc+'&tipomov='+tipomov+'&auxiliar='+auxiliar+'&peticion=liberar_numero','liberar_numero','get','0','1','','');
										
					}else{
					document.formulario.submit();
					}
					
			}else{
			
			}
	}else{	
	document.getElementById('productos').style.visibility='hidden';
	document.getElementById('auxiliares').style.visibility='hidden';
	document.formulario.prov_asoc.value='';
	}		
}
function enfocar_fecha(objeto){
objeto.select();
//objeto.focus();
}				


jQuery(document).bind('keyup', 'up',function (evt){jQuery('#_up').addClass('dirty');
	if(document.getElementById('productos').style.visibility=='visible'){


	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
		if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb' && (i!=0) ){
		document.getElementById('tblproductos').rows[i].style.background=document.getElementById('tblproductos').rows[i].bgColor;
		document.getElementById('tblproductos').rows[i-1].style.background='#FFF1BB';

			tempColor=document.getElementById('tblproductos').rows[i-1];
			
			location.href="#ancla"+(i-1);
			document.formulario.termino.focus();
			if(i%3==0 && i!=0){

			}
			break;
		}
	  }
   }

   if(document.getElementById('auxiliares').style.visibility=='visible'){
	
	for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
		if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' && (i!=0) ){
		document.getElementById('tblproductos1').rows[i].style.background=document.getElementById('tblproductos1').rows[i].bgColor;
		document.getElementById('tblproductos1').rows[i-1].style.background='#FFF1BB';
		
		tempColor=document.getElementById('tblproductos1').rows[i-1];
			
			location.href="#ancla"+(i-1);
			document.formulario.auxiliar.focus();
			
			if(i%4==0 && i!=0){
				}
			break;
		}
	  }
   }
         
 return false; });

   /*jQuery('#platform-details').html('<code>' + navigator.userAgent + '</code>');

function domo(){

 jQuery(document).bind('keydown', 'f6',function (evt){jQuery('#_f6').addClass('dirty');
  		
	window.open('observaciones.php?doc='+document.formulario.doc.value,'','width=350,height=300,top=250,left=350,scroolbars=no,directories=no,location=no,menubar =no,titlebar=no,toolbar=no,status=yes');
	
  return false; });*/


jQuery(document).bind('keyup', 'down',function (evt){jQuery('#_down').addClass('dirty');

 if(document.getElementById('productos').style.visibility=='visible'){
	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 

			if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb' && (i!=document.getElementById('tblproductos').rows.length-1)){
			
			document.getElementById('tblproductos').rows[i].style.background=document.getElementById('tblproductos').rows[i].bgColor;
			document.getElementById('tblproductos').rows[i+1].style.background='#FFF1BB';
			
			tempColor=document.getElementById('tblproductos').rows[i+1];
			
			if(i%4==0 && i!=0){
			location.href="#ancla"+i;
			document.formulario.cantidad.focus();
			}
				break;
			}
		}
 	}
	
	if(document.getElementById('auxiliares').style.visibility=='visible'){
	for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
			
			if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' && (i!=document.getElementById('tblproductos1').rows.length-1)){

			document.getElementById('tblproductos1').rows[i].style.background=document.getElementById('tblproductos1').rows[i].bgColor;
			document.getElementById('tblproductos1').rows[i+1].style.background='#FFF1BB';
			
			tempColor=document.getElementById('tblproductos1').rows[i+1];
			
			if(i%4==0 && i!=0){
			
			location.href="#ancla"+i;
			document.formulario.auxiliar.focus();			
			}
			
			break;
				
			}
		}
 	}	
 return false; });
 

jQuery(document).bind('keyup', 'return',function (evt){jQuery('#_return').addClass('dirty'); 		
																				   
			var nombreVariable=document.getElementById('MB_frame');
			try {
				 if (typeof(eval(nombreVariable)) != 'undefined' ){
					 if (eval(nombreVariable) != null){
					return false();
					}
				}
			 } catch(e) { }			 

			/*if(isset(nombreVariable)){
			return false;
			}*/
			switch(document.activeElement.name){
				case 'almacen':document.formulario.doc.disabled="";document.formulario.doc.focus();break;
				case 'doc':
					if(document.getElementById('doc').value=='S1'){
						document.formulario.auxiliar.disabled="";							
						document.formulario.auxiliar.focus();
					}else{
						document.formulario.doc_ref.focus();
					}break;
				//case 'auxiliar':	
//					if(document.getElementById('doc').value=='S1'){
//						document.formulario.tservi.disabled="";document.formulario.tservi.focus();
//					}else{
//						document.formulario.termino.disabled="disabled";
//					}break;
				case 'tservi':document.formulario.termino.disabled="";document.formulario.termino.focus();document.formulario.termino.select();break;
				case 'termino':document.formulario.termino2.disabled="";document.formulario.termino2.focus();break;
				case 'termino2':document.formulario.femi.disabled="";document.formulario.femi.focus();break;
				case 'femi':document.formulario.fven.disabled="";document.formulario.fven.focus();break;
				case 'fven':document.formulario.responsable.disabled="";document.formulario.responsable.focus();break;
				case 'responsable':document.formulario.condicion.disabled="";document.formulario.condicion.focus();break;
				case 'condicion':document.formulario.cbomon.focus();break;
				case 'cbomon':
				if(document.formulario.AddProd.disabled){
					alert('Solo se puede agregar un Item por Documento');
					if(confirm('Desea Guardar el Documento?')){
						guardar('G');
					}
				}else{
					document.formulario.AddProd.disabled=""
					document.formulario.AddProd.focus();
				}break;
				case 'pre_det':document.formulario.serietec.disabled="";document.formulario.serietec.focus();document.formulario.serietec.select();break;
				case 'serietec':document.formulario.txtdescrip.disabled="";document.formulario.txtdescrip.focus();document.formulario.txtdescrip.select();break;
			}
			/*
			if (document.activeElement.name=='almacen'){
				document.formulario.doc.disabled="";
				document.formulario.doc.focus();
			}else if (document.activeElement.name=='doc'){
				if(document.getElementById('doc').value=='S1'){
					document.formulario.auxiliar.disabled="";							
					document.formulario.auxiliar.focus();
				}else{
					document.formulario.doc_ref.focus();
					//document.formulario.doc_ref.select();
				}
			}else if (document.activeElement.name=='auxiliar'){
				if(document.getElementById('doc').value=='S1'){
					document.getElementById('tservi').focus();
				}else{
					document.formulario.termino.disabled="disabled";
				}
			}else if (document.activeElement.name=='tservi'){
				document.formulario.termino.disabled="";
				document.formulario.termino.focus();
				document.formulario.termino.select();
			}else if (document.activeElement.name=='termino'){
				document.formulario.femi.disabled="";
				document.formulario.femi.focus();
			}else if (document.activeElement.name=='femi'){
				document.formulario.fven.disabled=""
				document.formulario.fven.focus();
			}else if (document.activeElement.name=='fven'){
				document.formulario.responsable.disabled=""
				document.formulario.responsable.focus();	
			}else if (document.activeElement.name=='responsable'){
				document.formulario.condicion.disabled=""
				document.formulario.condicion.focus();	
			}else if (document.activeElement.name=='condicion'){
				document.formulario.cbomon.focus();	
			}else if (document.activeElement.name=='cbomon'){
				if(document.formulario.AddProd.disabled){
					alert('Solo se puede agregar un Item por Documento');
					if(confirm('Desea Guardar el Documento?')){
						guardar('G');
					}
				}else{
					document.formulario.AddProd.disabled=""
					document.formulario.AddProd.focus();
				}
			}else if (document.activeElement.name=='f_trigger_b2'){
				document.formulario.f_trigger_b1.disabled=""
				document.formulario.f_trigger_b1.focus();
			}
		*/
  	if(document.activeElement.name=='sucursal' || document.activeElement.name=='almacen' || document.activeElement.name=='doc' || document.activeElement.name=='responsable' || document.activeElement.name=='condicion' || document.activeElement.name=='presentacion' ){
	
		cambiar_enfoque(document.activeElement);
		
		if(document.activeElement.name=='almacen' && document.formulario.almacen.value==0 ){
		//doAjax('../carga_cbo_tienda.php','&codsuc='+document.formulario.sucursal.value,'cargar_cbo','get','0','1','','');
		}
		
		if(document.activeElement.name=='presentacion'){
		document.formulario.cantidad.focus();
		}
				
	}

	
	if(document.getElementById('productos').style.visibility=='visible'){
		for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
			if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb'){
			
				var temp=document.getElementById('tblproductos').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
				var temp1=document.getElementById('tblproductos').rows[i].cells[1].childNodes[0].innerHTML;
				var temp3=document.getElementById('tblproductos').rows[i].cells[3].innerHTML;
				var temp4=document.getElementById('tblproductos').rows[i].cells[4].innerHTML;
	    	//alert(temp4);
				var unidad=temp4.split("-");
				document.formulario.uni_p.value=unidad[0];
				document.formulario.factor_p.value=unidad[1];
				document.formulario.precio_p.value=unidad[2];
				document.formulario.prod_moneda.value=unidad[3];
				document.formulario.series.value=unidad[4];
				document.formulario.serie_ing.value="";
				document.formulario.pruebas.value=unidad[5];
				document.formulario.kardex_prod.value=unidad[11];
   	   //document.formulario.codAnexProd.value=unidad[15];
	   
	   
	   
	   
				var prod_moneda=unidad[3];
				if(document.formulario.tipomov.value==2){
		 
					var precosto=unidad[7];			
					/*if(prod_moneda=='01' && document.getElementById('moneda').innerHTML=='(US$.)'){
						precosto=parseFloat(precosto/tc_doc).toFixed(4);
					}else{
						if(prod_moneda=='02' && document.getElementById('moneda').innerHTML=='(S/.)'){
							precosto=parseFloat(precosto*tc_doc).toFixed(4);
						}
					}
					document.formulario.precosto.value=precosto;*/
				}else{
					var precosto=unidad[6];
					if(precosto<0){
						precosto=0.00;
					}
			
			if(document.getElementById('moneda').innerHTML=='(US$.)'){
			precosto=parseFloat(precosto/tc_doc).toFixed(4);
			}
			alert(1);
			document.formulario.punit.value=precosto;		
		}
			 
		document.formulario.codBarraEnc.value=unidad[13];
		//alert(temp+""+temp1)
		var temDes=temp1.split("|");
		elegir(temp,temDes[1].substring(8,temDes[1].length));
	   //elegir(temp,temp1);
	   //document.formulario.saldo.value=temp3;
			}
		 }
	   }
	   if(document.getElementById('auxiliares').style.visibility=='visible'){

		for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
			if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb'){
			
		var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
		var temp1=document.getElementById('tblproductos1').rows[i].cells[1].childNodes[0].innerHTML;
		
		var doc=document.formulario.doc.value;
		var ruc=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].innerHTML;
		
		var temp4=document.getElementById('tblproductos1').rows[i].cells[4].innerHTML.split("-");
	

			 if( (doc=='FA' || doc=='F1') && ruc==""  ){
			 alert(" Cliente no tiene Ruc ");
			 return false;
			 }else{
			 		 
			 temp1=temp1.replace('&amp;','&');
			 //alert(temp1);
			 //alert(temp4[16]);
			 if(temp4[16]!=""){
				 elegir2(temp,temp1);
			 }else{
			 	alert(" Cliente no tiene Telefono Registrado ");
				buscarCliente(temp);
			 }
			 }		  

			}
		 }
	   }
	 

	   if(document.formulario.cantidad.value!="" && document.formulario.codprod.value!="" && document.formulario.punit.value!="" && document.formulario.cantidad.value!=0  )
		{
		
		//-------------------control de items-------------------------------------------
		  
				 for(var i=0;i<tab_nitems.length;i++){
				 
					 if(tab_cod[i]==document.formulario.doc.value){
							var items_max=tab_nitems[i];		 
					 }
				 
				 }
		 		
				var mer=parseInt(document.getElementById('nitems').innerHTML)+1;
			
					if(mer>items_max){
					alert('No es permitido más items en el documento...');
					return false;
					}
				
		//--------------------------------------------------------------------------------
							var prms_doc_stock=find_prm(tab1,tab_cod);
			
					var cant=document.formulario.cantidad.value;
					var saldo=document.formulario.saldo.value;
					var kardex_prod=document.formulario.kardex_prod.value;
					 if(document.formulario.tipomov.value==2){
						
					if (document.formulario.cantSubUnidad.value>0){
						saldo=document.formulario.cantSubUnidad.value;
					}
									
						if( parseFloat(saldo) >= parseFloat(cant) || prms_doc_stock=='N' || kardex_prod=='N' ){
						
							var permiso10=find_prm(tab10,tab_cod);
						
								if(document.formulario.series.value=='S' && document.formulario.serie_ing.value=="" && permiso10=='S' ){

								var cant=document.formulario.cantidad.value;
								var randomnumber=Math.floor(Math.random()*99999);
								var producto=document.formulario.codprod.value;
								var fecha=document.formulario.femi.value;
								var tienda=document.formulario.almacen.value;
								var cod_cab_ref=document.formulario.cod_cab_ref.value;
									
									Modalbox.show('sal_series.php?cant='+cant+'&ran='+randomnumber+'&producto='+producto+'&fecha='+fecha+'&tienda='+tienda+'&cod_cab_ref='+cod_cab_ref, {title: 'Serie de productos ( SALIDAS )', width: 500}); 	return false;
									
	
								}
							
								if(document.formulario.pruebas.value!=""){
										var producto=document.formulario.codprod.value;
										var accion="";
										var series="_"+document.formulario.pruebas.value;
										var tienda=document.formulario.almacen.value;
										
										doAjax('peticion_datos.php','&peticion=sal_series&series='+series+'&producto='+producto+'&accion='+accion+'&tienda='+tienda,'rspta_aceptar_sal_serie','get','0','1','','');
								}
							
							  if((document.formulario.precio.value==0 || document.formulario.precio.value=='' ) && document.formulario.doc.value!='GR'){
								document.formulario.punit.focus();
								document.formulario.punit.select();							
								return false;
	
							  }
							if(document.activeElement.name=='cantidad'){
							document.formulario.punit.focus();
							document.formulario.punit.select();	
							return false;
							}
							
							doAjax('buscar_item.php','','buscar_item2','get','0','1','','');
												
						}else{
												
						alert("Producto sin Stock ... \n Stock Disponible: "+saldo);	
						document.formulario.cantidad.value="";
						document.formulario.codprod.value="";
						document.formulario.precio.value="";
						alert(9);
						document.formulario.punit.value="";
						document.formulario.codprod.select();
																
						}
						
					}else{
					
						if(document.formulario.punit.value==0 || document.formulario.punit.value=='' ){
						document.formulario.punit.focus();
				        document.formulario.punit.select();
						return false;
						}
					
					doAjax('buscar_item.php','','buscar_item2','get','0','1','','');
					
					}									

		}else{
		
			if(document.formulario.cantidad.value=="" && document.formulario.termino.value!="" && document.formulario.codprod.value=="" && document.formulario.punit.value=="" ){
			enviar();
			}else{
			 	
				//nombreVariable=document.getElementById('MB_frame');
					//if(document.formulario.cantidad.value!="" && document.formulario.termino.value!="" && document.formulario.codprod.value!="" && (document.formulario.punit.value=="" || document.formulario.punit.value==0) && !isset(nombreVariable) ){
				//document.formulario.punit.focus();
				//document.formulario.punit.select();
				
				//}
				
			}	
						
		}
			
return false; });

jQuery(document).bind('keyup', 'Esc',function (evt){jQuery('#_Esc').addClass('dirty'); 		
			Cerrar();
return false; });

jQuery(document).bind('keyup', 'F2',function (evt){jQuery('#_F2').addClass('dirty'); 		
																				   
			var nombreVariable=document.getElementById('MB_frame');
			try {
				 if (typeof(eval(nombreVariable)) != 'undefined' ){
					 if (eval(nombreVariable) != null){
					return false();
					}
				}
			 } catch(e) { }			 
		if(isset(document.getElementById('pre_det'))==true){
			if(document.getElementById('doc').value=='S1'){
				Actualizar_Precio();
			}else{
				guardar('G');
			}
		}else{
			alert('Documento sin items agregue un item...');
		}
return false; });


jQuery(document).bind('keydown', 'f8',function (evt){jQuery('#_f8').addClass('dirty');

 
	func_f8();	

return false; }); 

jQuery(document).bind('keydown', 'f3',function (evt){jQuery('#_f3').addClass('dirty');
	event.returnValue=false;
	event.keyCode=0;
	
	  if(document.getElementById('auxiliares').style.visibility=='visible'){
	  ver_new_aux();
	  }
		
 return false; }); 
  jQuery(document).bind('keydown', 'f10',function (evt){jQuery('#_f3').addClass('dirty');
	event.returnValue=false;
	event.keyCode=0;
	
	  if(document.getElementById('auxiliares').style.visibility=='visible'){
	  editCliente();
	  }
		
 return false; }); 

function editCliente(){
	if(document.getElementById('auxiliares').style.visibility=='visible'){

		for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
			if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb'){
				var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
				//var temp2=document.getElementById('tblproductos1').rows[i].cells[1].childNodes[0].innerHTML;
				//var temp3=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[0].childNodes[0].childNodes[0].innerHTML;
				
			//alert(temp);
			buscarCliente(temp);
			
			}
		}
	}
		
 }
function buscarCliente(codigo){
  document.getElementById('auxiliares').style.visibility='hidden';
  doAjax('../compras/peticion_datos.php','&codigo='+codigo+'&peticion=buscar_cliente','mostrarCliente','get','0','1','','');
  
  }
  
  function mostrarCliente(texto){

  var temp=texto.split('?');
  
  var codigo=temp[0];
  var razon=temp[1];
  var ruc=temp[2];
  var direccion=temp[3];
  var tipo=temp[4];
  var dni=temp[5];
  var email=temp[6];
  var telefono=temp[7];
  
  document.getElementById('new_aux').style.visibility='visible';
  
  document.formulario.aux_razon.value=razon;
  document.formulario.aux_dni.value=dni;
  document.formulario.aux_ruc.value=ruc;
  document.formulario.aux_direccion.value=direccion;
  document.formulario.tel_auxi.value=telefono;
//  alert(tipo+" "+ document.formulario.persona[1].value);
	  if(tipo!='natural'){
	  document.formulario.persona[0].checked=true;
	  document.formulario.persona[1].checked=false;
	 
	  document.formulario.aux_ruc.disabled=false;
	  document.formulario.aux_dni.disabled=true;
	  }else{
	   document.formulario.persona[1].checked=true;
	  document.formulario.persona[0].checked=false;
	  document.formulario.aux_ruc.disabled=true;
	  document.formulario.aux_dni.disabled=false;
	  }
  
  document.formulario.accionAux.value='e';
  document.formulario.codClie.value=codigo;
  //codClie
  }  
function func_f8(){
	
	if(document.getElementById('productos').style.visibility=='visible' ){
		if(document.getElementById('productos').style.visibility=='visible'){
			for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
				if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb'){
					var temp=document.getElementById('tblproductos').rows[i].cells[0].childNodes[0].childNodes[0]
					var codigo=temp.innerHTML;
					var moneda=document.formulario.tmoneda.value;
					var sucursal=document.formulario.sucursal.value;
					window.open('../compras/espec_prod.php?codigo='+codigo+'&moneda='+moneda+'&sucursal='+sucursal,'','width=650,height=420,top=300,left=300,scroolbars=yes,directories=no,location=no,menubar=no,titlebar=no,toolbar=no,status=yes');	
				}
			}
		}
	}
}

function elegir2(cod,des){
//razon.replace('&','amps')
des=des.replace('amps','&');
if(document.getElementById('doc').value=='S1'){
	document.formulario.tservi.disabled="";document.formulario.tservi.focus();
}else{
	document.formulario.termino.disabled="disabled";
}
document.formulario.auxiliar.value=des;
document.formulario.auxiliar2.value=cod;
document.getElementById('auxiliares').style.visibility='hidden';

			var serie=document.formulario.num_serie.value;
			var numero=document.formulario.num_correlativo.value;
			var doc=document.formulario.doc.value;
			var sucursal=document.formulario.sucursal.value;
			var tipomov=document.formulario.tipomov.value;
			
	if(tipomov==1){
	doAjax('../compras/peticion_datos.php','&serie='+serie+'&numero='+numero+'&doc='+doc+'&sucursal='+sucursal+'&auxiliar='+cod+'&peticion=buscar_prov2&tipomov='+tipomov,'rpta_con_datos2','get','0','1','','');
	}else{
				
				/*document.formulario.termino.disabled=false;
				document.formulario.termino.focus();*/
				/*document.formulario.responsable.disabled=false;
				document.formulario.responsable.focus();*/
				
	}
		

}

function rpta_con_datos2(texto){
var temp=texto.split("?");

//alert(temp);
		if(temp[1]=="reservado"){
			document.formulario.temp_doc.value=temp[0];
			document.formulario.sucursal.disabled=true;
			document.formulario.doc.disabled=true;
			document.formulario.num_correlativo.disabled=true;
			document.formulario.num_serie.disabled=true;
			document.formulario.auxiliar.disabled=true;
			document.formulario.almacen.disabled=true;
			
			
			document.formulario.responsable.disabled=false;
			document.formulario.responsable.focus();
		}else{
			 
			 habilitar();
			 
			 seleccionar_cbo('almacen',temp[2]);
			 seleccionar_cbo('responsable',temp[3]);	
			 seleccionar_cbo('condicion',temp[4]);	
			 document.formulario.femi.value=temp[5].substring(0,10);
			 document.formulario.fven.value=temp[6].substring(0,10);
			 document.formulario.temp_doc.value=temp[0];
			 
			 //alert(temp[8]);	
			 document.formulario.serie_ref.value=temp[11];
			 document.formulario.correlativo_ref.value=temp[12];
			 document.formulario.cod_cab_ref2.value=temp[14];
			 document.formulario.incluidoigv.value=temp[8];
			 		 			 
			 deshabilitar();
			 			 			 			 
			 var permiso4=find_prm(tab4,tab_cod);
			 var permiso10=find_prm(tab10,tab_cod);
			 var tmoneda2=temp[9];
			// alert(parseInt(temp[15])/100);
			 var impto=parseInt(temp[15])/100;
			 
			 var percep_suc=document.formulario.percep_suc.value;
		     var percep_doc=document.formulario.percep_doc.value;
			 var min_percep_doc=document.formulario.min_percep_doc.value;
			 var est_percep_clie=document.formulario.est_percep_clie.value;
			 var por_percep_clie=document.formulario.por_percep_clie.value;
			 var total_doc=document.formulario.total_doc.value;
			 var tipomov=document.formulario.tipomov.value;
			 	
							 			 
			 doAjax('../compras/detalle_doc.php','&incluidoigv='+document.formulario.incluidoigv.value+'&punitario='+document.formulario.punit.value+'&accion=mostrarprod&permiso4='+permiso4+'&permiso10='+permiso10+'&tmoneda2='+tmoneda2+'&impto='+impto+'&percep_suc='+percep_suc+'&percep_doc='+percep_doc+'&min_percep_doc='+min_percep_doc+'&est_percep_clie='+est_percep_clie+'&por_percep_clie='+por_percep_clie+'&total_doc='+total_doc+'&tipomov='+tipomov,'mostrar','get','0','1','','');				
		
		}

}

function mostrar(texto) {

var r = texto;

document.getElementById('resultado').innerHTML=r;

document.getElementById('resultado').style.display="block";

document.formulario.precio2.value='<?php echo $_SESSION['registro']?>';
document.formulario.codprod.value="";
document.formulario.cantidad.value="";
document.formulario.precio.value="";
document.formulario.termino.value="";
document.formulario.termino2.value="";
document.formulario.punit.value="";
document.formulario.notas.value="";

	if(!document.formulario.codprod.disabled){
	document.formulario.codprod.focus();
	document.formulario.pro.value=1;
		borrar();
	}
	document.formulario.accion.value="";
	
		if(document.formulario.total_doc.value==0.00){		
			if(document.getElementById('moneda').innerHTML=='(S/.)'){
			temp_mon="01";
			}else{
			temp_mon="02";
			}
		}
	
	
}

function elegir(cod,des){
document.formulario.codprod.value=cod;
document.formulario.termino.value=des;

document.getElementById('productos').style.visibility='hidden';

var uni_p=document.formulario.uni_p.value;
var factor_p=document.formulario.factor_p.value;
var precio_p=document.formulario.precio_p.value;

cliente=document.formulario.auxiliar2.value;
doc=document.formulario.doc.value;
//doAjax('pedir_dato.php','&prod='+cod+'&clie='+cliente+'&docu='+doc+'&peticion=historia','ConsultaHist','get','0','1','','');
}

function VerificaHist(){
	cod=document.formulario.tservi.value;
	cliente=document.formulario.auxiliar2.value;
	doc=document.formulario.doc.value;
	doAjax('pedir_dato.php','&prod='+cod+'&clie='+cliente+'&docu='+doc+'&peticion=historia','ConsultaHist4','get','0','1','','');
}

function ConsultaHist4(texto){
	//alert(texto);
	switch(texto){
	case 'existe':document.formulario.doc_hist.disabled=false;break;
	case 'pasa': document.formulario.doc_hist.disabled=true;break;
	case 'existe2':
		cod=document.formulario.tservi.value;
		cliente=document.formulario.auxiliar2.value;
		doc=document.formulario.doc.value;
		window.open('MostrarHist.php?prod='+cod+'&clie='+cliente+'&docu='+doc,"Consulta");break;
	}
}

function ConsultaHist(texto){
	//alert(texto);
	switch(texto){
		case 'existe':
		cod=document.formulario.codprod.value;
		cliente=document.formulario.auxiliar2.value;
		doc=document.formulario.doc.value;
		window.open('MostrarHist.php?prod='+cod+'&clie='+cliente+'&docu='+doc,"Consulta");break;
		case 'carga':
		cod=document.formulario.codprod.value;
		cliente=document.formulario.auxiliar2.value;
		doc=document.formulario.doc.value;
		ser=document.formulario.serie_prod.value;
		doAjax('pedir_dato.php','&prod='+cod+'&clie='+cliente+'&docu='+doc+'&prodser='+ser+'&peticion=historia','ConsultaHist2','get','0','1','','');
		break;
		case 'pasa':document.formulario.femi.disabled="";document.formulario.femi.focus();break;
	}
}
function ConsultaHist2(texto){
	//alert(texto);
	switch(texto){
		case 'existe':cod=document.formulario.codprod.value;
		cliente=document.formulario.auxiliar2.value;
		doc=document.formulario.doc.value;
		ser=document.formulario.serie_prod.value;
		window.open('MostrarHist.php?prod='+cod+'&clie='+cliente+'&docu='+doc+'&prodser='+ser,"Consulta");insertMat();break;
		case 'pasa':insertMat();break;
	}
}

function view_cbo_uni(texto){
	
	if(temp_busqueda=='cod_prod' && document.formulario.presentacion.length>1 && document.formulario.codBarraEnc.value==2){
	document.formulario.presentacion.options[1].selected="selected";
	calculos_pretot();
	}
	
	if(temp_busqueda=='serie'){
	document.formulario.cantidad.value=1;
	calculos_pretot();
	document.formulario.punit.select();
	document.formulario.punit.focus();
	document.formulario.serie_ing.value="S";
	
	}else{
		
		if(document.formulario.factor_p.value==1){
		document.formulario.cantidad.focus();
		}else{
		calc_pre_total();
		document.formulario.precio.focus();
		document.formulario.precio.select();
		}
		
	}

}
function carga_div2(){

	if(document.formulario.serieS1.value=='' || document.formulario.serieS1.value==''){
	alert("Usuario NO AUTORIZADO.........");
	window.close();
	}
    
	document.formulario.almacen.disabled="disabled";
	document.formulario.doc.disabled="disabled";
	document.formulario.auxiliar.disabled="disabled";
	document.formulario.termino.disabled="disabled";
	document.formulario.termino2.disabled="disabled";
	document.formulario.AddProd.disabled="disabled";
	document.formulario.femi.disabled="disabled";
	document.formulario.fven.disabled="disabled";
	document.formulario.responsable.disabled="disabled";
}
function cbo_cond(){
	var doc=document.formulario.doc.value;
	doAjax('../compras/peticion_datos.php','&doc='+doc+'&peticion=cargar_cond','cargar_cbo_cond','get','0','1','','');
}
function cargar_cbo_cond(texto){
	document.getElementById('cbo_cond').innerHTML=texto;
	document.formulario.condicion.disabled="disabled";
}
function sumarFechaVen(){
}
function enfocar_codprod(){
	var pagina = self.location.href.match( /\/([^/]+)$/ )[1];
		if(pagina=='transferencia.php'){
		document.form1.termino.focus();document.form1.termino.select();
		}else{
		document.formulario.termino.focus();document.formulario.termino.select();
		}
	}
function vent_ref(){
	/*var sucursal=document.formulario.sucursal.value;	sucursal='+sucursal+'&*/
	var tipomov=document.formulario.tipomov.value;
	var auxiliar2=document.formulario.auxiliar2.value;

	window.open('../add_referDocCli.php?tipomov='+tipomov+'&auxiliar2='+auxiliar2,'ventana','width=500,height=340,top=300,left=300,scroolbars=yes,directories=yes,location=yes,menubar=yes,titlebar=yes,toolbar=yes,status=yes');		
		
	}
	
function cargar_ref(serie,numero,cod_cli_ref,des_cli_ref,cod_cab_ref,mon_doc_ref,impto,cod_prod,des_prod,serie_prod,serie_ref,correlativo_ref){
	/*if(serie_prod==''){
		alert('Solo se puede agregar si Producto Maneja Serie');
		return false;
	}else{*/
		if(serie_prod==''){
			document.getElementById('tbserie').style.visibility='visible';
		}else{
			document.getElementById('tbserie').style.visibility='hidden';
		}
		document.formulario.auxiliar2.value=cod_cli_ref;
		document.formulario.auxiliar.value=des_cli_ref;
		document.formulario.cod_cab_ref2.value=cod_cab_ref;
		document.formulario.serie_ref.value=serie_ref;
		document.formulario.correlativo_ref.value=correlativo_ref;
		document.formulario.codprod.value=cod_prod;
		document.formulario.termino.value=des_prod;
		document.formulario.serie_prod.value=serie_prod;
		ConsultaHist("carga");
	//}
}

function Cambiar_Moneda(valor){
	mone=valor.value;
	if(isset(document.getElementById('pre_det'))==true){
		doAjax('../peticion_ajax3.php','&peticion=detSalMat&CambiaMoneda&moneda='+mone,'rspta_detSalMat','get','0','1','','');
	}
}

function Actualizar_Precio(){

	if(document.formulario.auxiliar.value=="" || document.formulario.auxiliar2.value==""){
	alert("Debe seleccionar un cliente para  continuar...");
	return false;
	}


	if(isset(document.getElementById('pre_det'))==false){
		alert('Documento sin items... Agregue un item...');
		return false;
	}else{
		valor=document.getElementById('pre_det');
		it=document.getElementById('itpx').value;
		var monto="";
		monto=valor.value;
		monto=parseFloat(monto);
		if(isNaN(monto)){
			alert('Por favor digite un monto válido');
			valor.value='0.00';
			return false;
		}else{
			if(monto==0.00 && document.getElementById('doc').value=='S1'){
				alert('Ingrese un monto Valido');
				valor.focus();
				valor.select();
				return false;
			}else{
				monto=monto.toString();
				var control=valor.id;
				//alert(document.getElementById(control).parentNode[0].childNodes[0].innerHTML);
				var precio_det=valor.value;
				var moneda=document.getElementById('cbomon').value;
				//alert(precio_det)
				doAjax('../peticion_ajax3.php','&peticion=detSalMat&mod_precio&moneda='+moneda+'&item='+it+'&precio='+precio_det,'procede_guardar','get','0','1','','');
			}
		}
	}
}

function procede_guardar(texto){
	guardar('G');
}

function Modificar_Precio(e,valor,it){
	if(e.keyCode==13){
		var monto="";
		monto=valor.value;
		monto=parseFloat(monto);
		if(isNaN(monto)){
			alert('Por favor digite un monto válido');
			valor.value='0.00';
			return false;
		}else{
			if(monto==0.00 && document.getElementById('doc').value=='S1'){
				alert('Ingrese un monto Valido');
				valor.focus();
				valor.select();
			}else{
				monto=monto.toString();
				var control=valor.id;
				//alert(document.getElementById(control).parentNode[0].childNodes[0].innerHTML);
				var precio_det=valor.value;
				var moneda=document.getElementById('cbomon').value;
				//alert(precio_det)
				doAjax('../peticion_ajax3.php','&peticion=detSalMat&mod_precio&moneda='+moneda+'&item='+it+'&precio='+precio_det,'rspta_detSalMat2','get','0','1','','');
			}
		}
	}
}

function selecionarItem(indice){

//if(document.getElementById('productos').style.visibility=='visible'){
		//for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
		//	if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb'){
			
		var temp=document.getElementById('tblproductos').rows[indice].cells[0].childNodes[0].childNodes[0].innerHTML;
		var temp1=document.getElementById('tblproductos').rows[indice].cells[1].childNodes[0].innerHTML;
		var temp3=document.getElementById('tblproductos').rows[indice].cells[3].innerHTML;
		var temp4=document.getElementById('tblproductos').rows[indice].cells[4].innerHTML;
		// alert(temp4);
		   var unidad=temp4.split("-");
	   document.formulario.uni_p.value=unidad[0];
	   document.formulario.factor_p.value=unidad[1];
	   document.formulario.precio_p.value=unidad[2];
	   document.formulario.prod_moneda.value=unidad[3];
	   document.formulario.series.value=unidad[4];
	   document.formulario.serie_ing.value="";
	   document.formulario.pruebas.value=unidad[5];
	   document.formulario.kardex_prod.value=unidad[11];
	  // document.formulario.codAnexProd.value=unidad[15];
	  // document.formulario.precosto.value=unidad[6];
	   
	   
	   
	   var prod_moneda=unidad[3];
		if(document.formulario.tipomov.value==2){
				
			var precosto=unidad[6];
			/*
			if(prod_moneda=='01' && document.getElementById('moneda').innerHTML=='(US$.)'){
			precosto=parseFloat(precosto/tc_doc).toFixed(4);
			}else{
				if(prod_moneda=='02' && document.getElementById('moneda').innerHTML=='(S/.)'){
				precosto=parseFloat(precosto*tc_doc).toFixed(4);
				}
			
			}
			*/
			document.formulario.precosto.value=precosto;
						
	    }else{
			var precosto=unidad[6];
			if(precosto<0 || tempNivelUser==2){
			precosto=0.00;
			}
						
			if(document.getElementById('moneda').innerHTML=='(US$.)'){
			precosto=parseFloat(precosto/tc_doc).toFixed(4);
			}
			document.formulario.punit.value=precosto;
		
		}
		
		document.formulario.codBarraEnc.value=unidad[13];
	   var tempDes=temp1.split("|");
	   elegir(temp,tempDes[1].substring(8,tempDes[1].length));
	   //elegir(temp,temp1);

	   document.formulario.saldo.value=temp3;
	   
		//	}
	//	 }
	//   }


}
function ver_new_aux(){
	document.formulario.aux_ruc.value="";
			document.formulario.aux_dni.value="";
			document.formulario.aux_razon.value="";
			document.formulario.aux_direccion.value="";
			document.formulario.accionAux.value="";
			document.formulario.codClie.value="";
			
		if(document.getElementById('auxiliares').style.visibility=='visible'){
		document.getElementById('auxiliares').style.visibility='hidden';
	//	mostrar_cbos()
		document.getElementById('new_aux').style.visibility='visible';
		
		document.formulario.persona[1].checked=true;
		document.formulario.persona[0].checked=false;
		document.formulario.aux_ruc.disabled=true;
		document.formulario.aux_dni.disabled=false;
		document.formulario.aux_dni.focus();
		}

}
function cancel_nuevo_aux(){
	document.getElementById('auxiliares').style.visibility='visible';
	//mostrar_cbos();
	document.getElementById('new_aux').style.visibility='hidden';
	document.formulario.auxiliar.select();
}
function entrar_btn(obj){
	obj.cells[0].style.backgroundImage="url(../imagenes/bordes_boton1.gif)";
	obj.cells[1].style.backgroundImage="url(../imagenes/bordes_boton2.gif)";
	obj.cells[2].style.backgroundImage="url(../imagenes/bordes_boton2.gif)";
	obj.cells[3].style.backgroundImage="url(../imagenes/bordes_boton3.gif)";
}
function salir_btn(obj){
	obj.cells[0].style.backgroundImage="";
	obj.cells[1].style.backgroundImage="";
	obj.cells[2].style.backgroundImage="";
	obj.cells[3].style.backgroundImage="";
}
function  guardar_aux(){
	
	var ruc=document.formulario.aux_ruc.value;
	var dni=document.formulario.aux_dni.value;
	var razon=document.formulario.aux_razon.value;
	var contacto=document.formulario.aux_contacto.value;
	var cargo=document.formulario.aux_cargo.value;
	var direccion=document.formulario.aux_direccion.value;
	var tipo_mov=document.formulario.tipomov.value;
	var doc=document.formulario.doc.value;

	var correo=document.formulario.correo_auxi.value;
	var telefono=document.formulario.tel_auxi.value;
	
	var persona='';
	var tipo_aux='';	
	if(document.formulario.persona[0].checked){
		persona='juridica';	
	}else{
		persona='natural';	
	}
						
	if(tipo_mov==1){
		tipo_aux='P';
	}else{
		tipo_aux='C';	
	}
		
	if(persona=='juridica'){
		if(ruc.substring(0,2)>='10' &&  ruc.substring(0,2)<='20'){
			alert('Ingrese un numero de ruc válido');
			document.formulario.aux_ruc.select();
			document.formulario.aux_ruc.focus();
			return false;
		}
		if(ruc=="" || ruc.length!=11){
			alert('Ingrese un numero de ruc válido');
			document.formulario.aux_ruc.select();
			document.formulario.aux_ruc.focus();
			return false;
		}		
	}

	if( (doc=="F1" || doc=="FA") && (ruc=="" || ruc.length!=11) ){
		alert('Ingrese un numero de ruc válido');
		document.formulario.aux_ruc.focus();
		return false;
	}else{
		razon=razon.replace('&','amps');//)('&','/&#38;/')
		var accionAux=document.formulario.accionAux.value;
		var codClie=document.formulario.codClie.value;
		if(telefono=="" && telefono.length<=6){
			alert('Ingrese un Numero Telefonico Valido');
			document.formulario.tel_auxi.focus();
			document.formulario.tel_auxi.select();
			return false;
		}else{
			doAjax('pedir_dato.php','&ruc='+ruc+'&dni='+dni+'&razon='+razon+'&contacto='+contacto+'&cargo='+cargo+'&direccion='+direccion+'&persona='+persona+'&tipo_aux='+tipo_aux+'&telefono='+telefono+'&correo='+correo+'&peticion=save_aux&accionAux='+accionAux+'&codClie='+codClie,'rspta_aux','get','0','1','','');
		}
	}
}
function rspta_aux(texto){
	var ruc=document.formulario.aux_ruc.value;
	var dni=document.formulario.aux_dni.value;
	
	var temp=texto.split('?');
	if(temp[2]>0){
		if(ruc!=''){
			alert("El ruc ingresado ya existe");
			document.formulario.aux_ruc.select();
			document.formulario.aux_ruc.focus();
	  	}else{
			alert("El dni ingresado ya existe");
			document.formulario.aux_dni.select();
			document.formulario.aux_dni.focus();
		}
		return false;
	}
	elegir2(temp[0],temp[1])
	document.getElementById('new_aux').style.visibility='hidden';			
	if(document.getElementById('accionAux').value='e'){
		document.getElementById('accionAux').value="";
	}
}
</script>
