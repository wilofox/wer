<?php
session_start();
///^ colocado recientemente GMY ///
include('../conex_inicial.php');


if(isset($_REQUEST['Submit'])){

$usuario=$_REQUEST['usuario'];
$sucursal=$_REQUEST['sucursal'];
$tienda=$_REQUEST['almacen'];
$busaux=$_REQUEST['busaux'];
//---Permiso Finanzas---//Para futuros permisos sumarle a la variable con comas
$esta=""; //inicio no borrar
////////Repetir por los permisos que se usaran incrementando variable $esta con S o N segun el permiso

$esta1="N";
$esta2="N";
$esta3="N";
$esta4="N";
$esta5="N";

if($_REQUEST['chkaprob']=="S"){ 
	$esta1="S";
}
if($_REQUEST['chkprog']=="S"){ 
	$esta2="S";
}

if($_REQUEST['chkcredito']=="S"){ 
	$esta3='S';
}
if($_REQUEST['chkmoneda']=="S"){ 
	$esta4='S';
}
if($_REQUEST['chkincluido']=="S"){ 
	$esta5='S';
}




$esta=$esta1.$esta2.$esta3.$esta4.$esta5;
//echo $esta;
$strSQL="update usuarios set sucursal='".$sucursal."', tienda='".$tienda."', busaux='".$busaux."', permiso='".$esta."' where codigo='".$usuario."' ";

//echo $strSQL;
mysql_query($strSQL,$cn);

}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
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
.Estilo16 {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 11px;
	font-weight: bold;
}
.Estilo15 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #990000;
}
.Estilo17 {
	font-family: Arial, Helvetica, sans-serif;
	color: #000000;
}
.Estilo19 {
	color: #003366;
	font-weight: bold;
}
-->
</style></head>


	<link href="../styles.css" rel="stylesheet" type="text/css">
	<script language="javascript" src="miAJAXlib3.js"></script>
    <script src="../jquery-1.2.6.js"></script>
    <script src="../jquery.hotkeys.js"></script>
	<script src="../mootools-comprimido-1.11.js"></script>

<!--checkbox-->
<!--
		<SCRIPT src="checkbox/js/jquery-1.4.2.js" type=text/javascript charset="utf-8"></SCRIPT>
		<script src="checkbox/js/prettyCheckboxes.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="checkbox/css/prettyCheckboxes.css" type="text/css" media="screen" title="prettyComment main stylesheet" charset="utf-8" />
-->

<body>
<form name="form1" method="post" action="">
  <table width="802" height="436" border="0" cellpadding="0" cellspacing="0">
  <tr  style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="1033" height="27" colspan="11" style="border:#999999">
	  <span class="Estilo1 Estilo19"> Administraci&oacute;n :: Administrador de Accesos<span class="text4">
        <input name="auxiliar" type="hidden" id="auxiliar" value="<?php echo $tipo_aux; ?>">
      </span></span>	  </td>
    </tr>
    <tr>
      <td width="374" align="center" valign="top"><fieldset>
        <legend><span class="Estilo16"></span></legend>
        <table width="351" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="357" height="83"><table width="351" height="56" border="00" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="341" height="26"><span class="Estilo17">Nombre de usuario:&nbsp;</span><span class="Estilo15">
                    <select style="width:140"  name="usuario" onChange="cargar_sucursal()" >
					<option value="0"></option>
                      <?php 				
			  $resultados1 = mysql_query("select * from usuarios order by codigo ",$cn); 
			  
			  
			while($row1=mysql_fetch_array($resultados1))
			{
		?>
                      <option value="<?php echo $row1['codigo'] ?>"><?php echo $row1['usuario'] ?></option>
                      <?php }?>
                    </select>
                  </span></td>
                </tr>
                <tr style="visibility:hidden">
                  <td height="29"><span class="Estilo17">Nueva contrase&ntilde;a </span>
                      <input name="textfield" type="password" size="13" maxlength="30">
                      <span class="Estilo17">Confirmar</span>
                      <input name="textfield2" type="password" size="13" maxlength="30"></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td height="78" valign="top"><fieldset>
              <table width="349" height="52" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="5" colspan="2"></td>
                </tr>
                <tr>
                  <td width="116" height="25"><span class="Estilo17">Empresa por defecto</span></td>
                  <td width="233">
				  <div id="cbo_sucursal">
				  <select style="width:160"  name="sucursal" onChange="doAjax('../carga_cbo_tienda.php','&codsuc='+document.form1.sucursal.value,'cargar_cbo','get','0','1','','');"  >
                      <option value="0"></option>
                      <?php 
		
			  $resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn); 
			while($row1=mysql_fetch_array($resultados1))
			{
		?>
                      <option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
                      <?php }?>
                  </select>
				  </div>				  </td>
                </tr>
                <tr>
                  <td class="Estilo17">Almac&eacute;n por defecto </td>
                  <td class="Estilo17">
				  
				  <div id="cbo_tienda"> 
				  	   <select name="almacen"  style="width:160px" >
			<option value=""></option>
        </select>
				  </div>				  </td>
                </tr>
              </table>
              </fieldset>               </td>
          </tr>
          <tr>
            <td height="163" align="center" valign="top"><!--
		  <div id="wrap">
		  
		  <fieldset><legend><span class="Estilo18">Modulos de Usuario</span></legend>
            <table width="326" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="5" colspan="3" align="center"></td>
              </tr>
              <tr>
                <td width="37" height="25" align="center"><span class="Estilo14" style="font-weight: bold">
                  <input checked="checked" style="background:none; border: none " type="checkbox" name="checkbox" value="checkbox">
                </span></td>
                <td width="3" class="Estilo17">&nbsp;</td>
                <td width="264" class="Estilo17">Ventas</td>
              </tr>
              <tr>
                <td height="25" align="center"><span class="Estilo14" style="font-weight: bold">
                  <input checked="checked" style="background:none; border: none " type="checkbox" name="checkbox2" value="checkbox">
                </span></td>
                <td class="Estilo17">&nbsp;</td>
                <td class="Estilo17">Compras</td>
              </tr>
              <tr>
                <td height="25" align="center"><span class="Estilo14" style="font-weight: bold">
                  <input checked="checked" style="background:none; border: none " type="checkbox" name="checkbox3" value="checkbox">
                </span></td>
                <td class="Estilo17">&nbsp;</td>
                <td class="Estilo17">Punto de Venta </td>
              </tr>
              <tr>
                <td height="24" align="center"><span class="Estilo14" style="font-weight: bold">
                  <input checked="checked" style="background:none; border: none " type="checkbox" name="checkbox4" value="checkbox">
                </span></td>
                <td class="Estilo17">&nbsp;</td>
                <td class="Estilo17">Restaurante</td>
              </tr>
              <tr>
                <td height="25" align="center"><span class="Estilo14" style="font-weight: bold">
                  <input checked="checked" style="background:none; border: none " type="checkbox" name="checkbox5" value="checkbox">
                </span></td>
                <td class="Estilo17">&nbsp;</td>
                <td class="Estilo17">Inventarios</td>
              </tr>
              <tr>
                <td height="26" align="center"><span class="Estilo14" style="font-weight: bold">
                  <input checked="checked" type="checkbox" name="checkbox52" value="checkbox">
                </span></td>
                <td>&nbsp;</td>
                <td><span class="Estilo17">Utilitarios
                  <input type="checkbox" name="checkbox-1[braket]" id="checkbox-1" value="checkbox-1" onClick="alert('this checkbox has an onclick event');" />
                </span></td>
              </tr>
            </table>
          </fieldset>&nbsp;
		  </div>
		  
		  
		  -->
                <fieldset>
                <legend>M&oacute;dulos de Usuario</legend>
                  <table width="330" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="2" height="5"></td>
                  </tr>
                  <tr>
                    <td width="22">&nbsp;</td>
                    <td width="317"><table width="293" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="33" align="center"><input style="border:none; background:none" type="checkbox" name="checkbox" value="checkbox"></td>
                          <td width="260">Ventas</td>
                        </tr>
                        <tr>
                          <td align="center"><input style="border:none; background:none" type="checkbox" name="checkbox2" value="checkbox"></td>
                          <td>Compras</td>
                        </tr>
                        <tr>
                          <td align="center"><input style="border:none; background:none" type="checkbox" name="checkbox3" value="checkbox"></td>
                          <td>Punto de Venta </td>
                        </tr>
                        <tr>
                          <td align="center"><input style="border:none; background:none" type="checkbox" name="checkbox4" value="checkbox"></td>
                          <td>Modulo 4 </td>
                        </tr>
                        <tr>
                          <td align="center">&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                    </table></td>
                  </tr>
                </table>
                </fieldset>
				<br>
				 <input  onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(../imagenes/boton_aplicar.gif) ; cursor:pointer" type="submit" name="Submit" id="Submit" value="Guardar" >			</td>
          </tr>
        </table>
        </fieldset>         </td>
      <td width="11" align="center" valign="top">&nbsp;</td>
      <td width="417" align="center" valign="top"><table width="402" height="369"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="402" height="301" valign="top"><fieldset><legend>Permisos</legend>
            <table width="381" height="139" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="92" height="39">B&uacute;squeda Auxiliar: </td>
                <td width="254">
				<select style="width:160"  name="busaux" id="busaux" >
				
                <option value="ruc">Ruc</option>
				<option value="dni">Dni</option>
				<option selected="selected" value="razon">Razón social</option>
               
                </select>
				</td>
                <td width="35">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2"><?php if($_SESSION['financiero']=="S" ){ ?>
				
				  <?php if($_SESSION['nivel_usu']=="5" || $_SESSION['nivel_usu']=="11"){ ?>	
                  <input  type="checkbox" name="chkaprob" id="chkaprob" value="S" style="background:none; border:none">
				  &nbsp;Permitir Ingreso: Aprobaci&oacute;n Pagos Proveedores <br>
				  <?php }else{
				   ?>
				  <input disabled="disabled"  type="checkbox" name="chkaprob" id="chkaprob" value="S" style="background:none; border:none">
				  &nbsp;Permitir Ingreso: Aprobaci&oacute;n Pagos Proveedores <br>
				  <?php 				  
				  } 				  
				  ?>                  
                  <input  type="checkbox" name="chkprog" id="chkprog" value="S" style="background:none; border:none">
                  &nbsp;Permitir Ingreso: Programaci&oacute;n Pagos Proveedores<br>
				  <input  type="checkbox" name="chkcredito" id="chkcredito" value="S" style="background:none; border:none">
				  &nbsp;Permitir Venta al credito
                  <?php }else{ ?>
                  <input type="hidden" name="chkaprob" id="chkaprob" value="N">
                  <input type="hidden" name="chkaprob" id="chkprog" value="N">
				  <input type="hidden" name="chkcredito" id="chkcredito" value="N">
                  <?php }?>				  
                  <br><input  type="checkbox" name="chkmoneda" id="chkmoneda" value="S" style="background:none; border:none">
&nbsp;Permitir cambiar de moneda [F8]<br>
<input  type="checkbox" name="chkincluido" id="chkincluido" value="S" style="background:none; border:none">
&nbsp;Permitir cambiar Inluido/No incluido [F9]</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </fieldset> </td>
        </tr>
        <tr>
          <td height="38" >&nbsp;</td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>
<script>

function cargar_cbo(texto){
var r = texto;
document.getElementById('cbo_tienda').innerHTML=r;

seleccionar_combo();
}

function seleccionar_combo(){

 	 var valor1="101";
     var i;
	 for (i=0;i<document.form1.almacen.options.length;i++)
        {
		
            if (document.form1.almacen.options[i].value==valor1)
               {
			   
               document.form1.almacen.options[i].selected=true;
               }
        
        }
				
}

function enfocar_cbo(control){
}


function limpiar_enfoque(control){
}

function cambiar_fondo(control,evento){

if(evento=='e')
control.style.backgroundImage='url(../imagenes/boton_aplicar2.gif)';
else
control.style.backgroundImage='url(../imagenes/boton_aplicar.gif)';

}

	function cargar_sucursal(){
	
	doAjax('ajax_user.php','&coduser='+document.form1.usuario.value+'&peticion=cargar_sucursal','rpta_cargar_sucursal','get','0','1','','');
	
	}
	
	function rpta_cargar_sucursal(texto){
	document.getElementById('cbo_sucursal').innerHTML=texto;
	cargar_tienda();
	}
	
	function cargar_tienda(){
	//alert(document.form1.sucursal.value);
	doAjax('ajax_user.php','&sucursal='+document.form1.sucursal.value+'&coduser='+document.form1.usuario.value+'&peticion=cargar_tienda','rpta_cargar_tienda','get','0','1','','');
	
	}
	
	function rpta_cargar_tienda(texto){
	var temp=texto.split("|");
	document.getElementById('cbo_tienda').innerHTML=temp[0];
	//alert(temp[2]);
	if(temp[2].substr(0,1)=="S"){
		document.form1.chkaprob.checked=true;
	}else{
		document.form1.chkaprob.checked=false;
	}
	if(temp[2].substr(1,1)=="S"){	
		document.form1.chkprog.checked=true;
		
	}else{
		document.form1.chkprog.checked=false;
	}
	if(temp[2].substr(2,1)=="S"){
		document.form1.chkcredito.checked=true;
	}else{
		document.form1.chkcredito.checked=false;
	}
	if(temp[2].substr(3,1)=="S"){
		document.form1.chkmoneda.checked=true;
	}else{
		document.form1.chkmoneda.checked=false;
	}
	if(temp[2].substr(4,1)=="S"){
		document.form1.chkincluido.checked=true;
	}else{
		document.form1.chkincluido.checked=false;
	}
	seleccionar_cbo("busaux",temp[1]);
	}
	
	function cambiar_enfoque(control){
	
	}
	
	
	function seleccionar_cbo(control,valor){
		//alert(control+"|"+valor);
		 var valor1=valor;
         var i;
		 
	     for (i=0;i< eval("document.form1."+control+".options.length");i++)
        {	
		
         if (eval("document.form1."+control+".options[i].value")==valor1)
            {
			//alert(document.form1.responsable.options[i].value+" "+valor1);
			   eval("document.form1."+control+".options[i].selected=true");
            }
        
        }
		
	}

</script>