<?php 
session_start();
$ocultarFila="";
if($_SESSION['prodfiltro']=='N'){
$ocultarFila=" style='visibility:hidden' ";
}

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="styles.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--


body {
background-image: url(imagenes/bg3.jpg);
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo2 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 11px;
}
.Estilo11 {font-family: Arial, Helvetica, sans-serif; color: #FFFFFF; font-weight: bold; font-size: 11px; }
.texto1{ font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333}
.Estilo13 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 11px; color: #993300; }
.Estilo14 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#000000;
}
.Estilo34 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
.Estilo35 {color: #000000}
.Estilo113 {	color:#FF3300;
	font-weight: bold;
	font-size: 10px;
	font-family: Arial, Helvetica, sans-serif;
}

-->
</style></head>
<script language="javascript" src="miAJAXlib2.js"></script>

<LINK href="jquery_nice/base.css" type=text/css rel=stylesheet>
<LINK href="jquery_nice/jNice.css" type=text/css rel=stylesheet>
<SCRIPT src="jquery_nice/jquery-latest.pack.js" type=text/javascript></SCRIPT>
<SCRIPT src="jquery_nice/jquery.jNice.js" type=text/javascript></SCRIPT>
<script type="text/javascript" src="javascript/mover_div.js"></script>

 <script src="jquery-1.2.6.js"></script>
 <script src="jquery.hotkeys.js"></script>

<script>

jQuery(document).bind('keydown', 'f3',function (evt){jQuery('#_f3').addClass('dirty');
	evt.keyCode=0;
	evt.returnValue=false;
	nuevoDoc()
	
	//alert();
	//window.open("carga.php");
return false; });


var scrollDivs = new Array();
scrollDivs[0] = "divNuevoDoc";
var temp = "";

function entrada(objeto){


	//objeto.cells[0].childNodes[0].checked=true;
	
//	temp=objeto;
	if(objeto.style.background=='#fff1bb'){
	//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='#FFF1BB';
	
	temp.style.background='#FFFFFF';
	temp=objeto;
	}

}

function salida(objeto){
//document.getElementById('prueba').value=objeto.style.background;
//alert(objeto.style.background);
objeto.style.background='#F9F9F9';
//document.getElementById('prueba').value=objeto.style.background;
//est=0;
}


function cargar_doc(){

var valor=document.form1.aplicacion.value;

if(valor==1){
document.getElementById("row1").style.visibility='hidden';
document.getElementById("td1").style.visibility='visible';
document.getElementById("td2").style.visibility='visible';

document.getElementById("td3").style.visibility='hidden';
document.getElementById("td4").style.visibility='hidden';

document.getElementById("docPtoVenta").style.visibility='hidden';
document.getElementById("docPtoVenta2").style.visibility='hidden';



}else{
document.getElementById("row1").style.visibility='visible';
document.getElementById("td1").style.visibility='hidden';
document.getElementById("td2").style.visibility='hidden';

document.getElementById("td3").style.visibility='visible';
document.getElementById("td4").style.visibility='visible';


document.getElementById("docPtoVenta").style.visibility='visible';
document.getElementById("docPtoVenta2").style.visibility='visible';
}


doAjax('cons_documentos.php','valor='+valor,'listar_doc','get','0','1','','');

temp=document.getElementById('lista_docs').rows[1];


	if(valor==1){
	document.getElementById('capa_ocu_percep').style.display='block';
	}else{
	document.getElementById('capa_ocu_percep').style.display='none';
	}

}

function listar_doc(texto){

document.getElementById('tbl_doc').innerHTML=texto;

}


function carga_permisos(valor){
//alert(valor);

var aplicacion=document.form1.aplicacion.value;
doAjax('peticion_ajax.php','valor='+valor+'&aplicacion='+aplicacion,'cargar_permisos','get','0','1','','');
}




function cargar_permisos(texto){
clear_checkbox();
//alert();
var cadena=texto.split('~');
if(cadena[0]=='TS'){
	document.getElementById('Modificatransf').style.visibility='visible';
	document.getElementById('Modificatransf2').style.visibility='visible';
}else{
	document.getElementById('Modificatransf').style.visibility='hidden';
	document.getElementById('Modificatransf2').style.visibility='hidden';	
}
document.form1.codigo.value=cadena[0];
document.form1.nombre.value=cadena[1];
document.form1.imp1.value=cadena[2];
document.form1.imp2.value=cadena[3];
document.form1.sunat.value=cadena[37];
document.form1.comentario1.value=cadena[38];
document.form1.comentario2.value=cadena[39];
document.form1.obs1.value=cadena[40];
document.form1.obs2.value=cadena[41];
document.form1.obs3.value=cadena[42];
document.form1.obs4.value=cadena[43];
document.form1.obs5.value=cadena[44];
document.form1.formato.value=cadena[45];
document.form1.nitems.value=cadena[46];
document.form1.cola.value=cadena[47];
document.form1.min_percep.value=cadena[48];
document.form1.cola2.value=cadena[51];

if(document.form1.sunat.value!=""){
document.form1.p17.disabled=false;
}else{
document.form1.p17.disabled=true;
}

if(document.form1.cola.value!='' && document.form1.cola2.value!=''){
	
	}else{
		
		
	}
//alert(texto);
//alert(cadena[4]);
 	    for (i=0;i<document.form1.kardex.options.length;i++)
        {
		
            if (document.form1.kardex.options[i].value==cadena[4])
               {
			   
               document.form1.kardex.options[i].selected=true;
               }
        
        }
		
		 for (i=0;i<document.form1.moneda.options.length;i++)
        {
		
            if (document.form1.moneda.options[i].value==cadena[49])
               {
			   
               document.form1.moneda.options[i].selected=true;
               }
        
        }
		
		 for (i=0;i<document.form1.pDefecto.options.length;i++)
        {
		
            if (document.form1.pDefecto.options[i].value==cadena[50])
               {
			   
               document.form1.pDefecto.options[i].selected=true;
               }
        
        }
		 for (i=0;i<document.form1.tipoDesc.options.length;i++)
        {
		
            if (document.form1.tipoDesc.options[i].value==cadena[52])
               {
			   
               document.form1.tipoDesc.options[i].selected=true;
               }
        
        }
		 for (i=0;i<document.form1.elemProd.options.length;i++)
        {
		
            if (document.form1.elemProd.options[i].value==cadena[53])
               {
			   
               document.form1.elemProd.options[i].selected=true;
               }
        
        }
		
		
		

var j=1;
		
	for(var i=5;i<37;i++){
	//alert(cadena[i]);
		if(cadena[i]=='S'){
		//document.form1.p1.checked=true;
		eval('document.form1.p'+j+'.checked=true');
		
		}
	j++;
	}

}

function clear_checkbox(){

		
	for (i=0;ele=document.form1.elements[i];i++){
 	 if (ele.type=='checkbox'){
 
		ele.checked=false;
		}
	}
	
	document.form1.codigo.value="";
	document.form1.nombre.value="";
	document.form1.imp1.value="";
	document.form1.imp2.value="";
		
	}


</script>

<?php 

include('conex_inicial.php');


if(isset($_REQUEST['Submit'])){
$codigo=$_POST['codigo'];
$p1="N";
$p2="N";
$p3="N";
$p4="N";
$p5="N";
$p6="N";
$p7="N";
$p8="N";
$p9="N";
$p10="N";
$p11="N";
$p12="N";
$p13="N";
$p14="N";
$p15="N";
$p16="N";
$p17="N";
$p18="N";
$p19="N";
/////Permiso de Correlativo y Descuento////
$p20="N";
$p21="N";
$p22="N";
$p23="N";
$p24="N";
$p25="N";
$p26="N";
$p27="N";
$p28="N";
$p29="N";
$p30="N";
$p31="N";
$p32="N";

///////////////////////////////////////////

//echo $_POST['checkbox'];
	if(isset($_POST['checkbox'])){
		foreach($_POST['checkbox'] as $valor){
		
			if($valor=='checkbox1')$p1='S';
			if($valor=='checkbox2')$p2='S';
			if($valor=='checkbox3')$p3='S';
			if($valor=='checkbox4')$p4='S';
			if($valor=='checkbox5')$p5='S';
			if($valor=='checkbox6')$p6='S';
			if($valor=='checkbox7')$p7='S';
			if($valor=='checkbox8')$p8='S';
			if($valor=='checkbox9')$p9='S';
			if($valor=='checkbox10')$p10='S';
			if($valor=='checkbox11')$p11='S';
			if($valor=='checkbox12')$p12='S';
			if($valor=='checkbox13')$p13='S';
			if($valor=='checkbox14')$p14='S';
			if($valor=='checkbox15')$p15='S';
			if($valor=='checkbox16')$p16='S';
			if($valor=='checkbox17')$p17='S';
			if($valor=='checkbox18')$p18='S';
			if($valor=='checkbox19')$p19='S';
			/////////////
			if($valor=='checkbox20')$p20='S';
			if($valor=='checkbox21')$p21='S';
			if($valor=='checkbox22' && $ocultarFila=="")$p22='S';
			if($valor=='checkbox23')$p23='S';
			if($valor=='checkbox24')$p24='S';
			if($valor=='checkbox25')$p25='S';
			if($valor=='checkbox26')$p26='S';
			if($valor=='checkbox27')$p27='S';
			if($valor=='checkbox28')$p28='S';
			if($valor=='checkbox29')$p29='S';
			if($valor=='checkbox30')$p30='S';
			if($valor=='checkbox31')$p31='S';
			if($valor=='checkbox32')$p32='S';
			/////////////
			
		}
	}
	$cadenap=$p1.$p2.$p3.$p4.$p5.$p6.$p7.$p8.$p9.$p10.$p11.$p12.$p13.$p14.$p15.$p16.$p17.$p18.$p19.$p20.$p21.$p22.$p23.$p24.$p25.$p26.$p27.$p28.$p29.$p30.$p31.$p32;
	//echo $cadenap;
	
	$imp1=$_POST['imp1'];
	$imp2=$_POST['imp2'];
	$kardex=$_POST['kardex'];
	$sunat=$_POST['sunat'];
	$comentario1=$_POST['comentario1'];
	$comentario2=$_POST['comentario2'];
	$obs1=$_POST['obs1'];
	$obs2=$_POST['obs2'];
	$obs3=$_POST['obs3'];
	$obs4=$_POST['obs4'];
    $obs5=$_POST['obs5'];
	$formato=$_POST['formato'];	
	$nitems=$_POST['nitems'];	
	$cola=$_POST['cola'];
	$cola2=$_POST['cola2'];						
	$min_percep=$_POST['min_percep'];						
	$moneda=$_POST['moneda'];						
	$aplicacion=$_POST['aplicacion'];						
	$pDefecto=$_POST['pDefecto'];
	$nombreDoc=$_POST['nombre'];
	$tipoDesc=$_POST['tipoDesc'];
	$elemProd=$_POST['elemProd'];
	
	
//	if($codigo=='TB' or $codigo=='TF'){
	//$strSQL="update operacion set p1='$cadenap',imp1='$imp1',imp2='$imp2',kardex='$kardex',sunat='$sunat',comentario1='$comentario1',comentario2='$comentario2',obs1='$obs1',obs2='$obs2',obs3='$obs3',obs4='$obs4',obs5='$obs5',formato='$formato',nitems='$nitems',cola='$cola',moneda='$moneda',predefecto='$pDefecto',cola2='$cola2'  where codigo='TB' or codigo='TF' ";
	//mysql_query($strSQL,$cn);
	//}else{
	$strSQL="update operacion set p1='$cadenap',imp1='$imp1',imp2='$imp2',kardex='$kardex',sunat='$sunat',comentario1='$comentario1',comentario2='$comentario2',obs1='$obs1',obs2='$obs2',obs3='$obs3',obs4='$obs4',obs5='$obs5',formato='$formato',nitems='$nitems',cola='$cola',min_percep='$min_percep',moneda='$moneda',predefecto='$pDefecto',cola2='$cola2',descripcion='$nombreDoc',tipoDesc='$tipoDesc',elemProd='$elemProd' where codigo='$codigo' and tipo='$aplicacion'";
	mysql_query($strSQL,$cn);
	if($p11=="N"){
		$sql_ref="Delete FROM refope WHERE documento ='$codigo' AND tipo ='$aplicacion'";
		mysql_query($sql_ref,$cn);
	}
		
	//}

//	echo $strSQL;
//echo $sql_ref;

}

?>

<body onLoad="cargar_doc();carga_div()">
<form name="form1" method="post" action="" >
  <table width="780" border="0" cellpadding="0" cellspacing="0">
    <tr style="background:url(imagenes/white-top-bottom.gif)">
      <td height="30" colspan="4" style="border:#999999"><table width="775" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="442"><span class="Estilo34"> Administraci&oacute;n :: Documentos :: Documentos Compras/Ventas </span></td>
          <td width="333" align="right">
		  
		  <table title="Nuevo[F3]" width="100" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="nuevoDoc()">
              <td width="3" ></td>
              <td width="18" align="center" ><span class="Estilo35"><img src="imagenes/nuevo.gif" width="14" height="16"></span></td>
              <td width="76" ><span class="Estilo35">Nuevo Doc <span class="Estilo113">[F3]</span> </span></td>
              <td width="3" ></td>
            </tr>
          </table>
		  
		  </td>
        </tr>
      </table></td>
    </tr>
    
    <tr>
      <td width="1%" height="28">&nbsp;</td>
      <td width="37%"><span class="Estilo2"><span class="Estilo35">Aplicaci&oacute;n</span>:
          <select name="aplicacion" onChange="cargar_doc()">
            <option value="2">Ventas</option>
            <option value="1">Compras</option>
			
			 <script>
	   var valor1="<?php echo $_REQUEST['aplicacion']?>";
     var i;
	 for (i=0;i<document.form1.aplicacion.options.length;i++)
        {
		
            if (document.form1.aplicacion.options[i].value==valor1)
               {
			   
               document.form1.aplicacion.options[i].selected=true;
               }
        
        }
	  </script>
          </select>
		  
      </span></td>
      <td width="1%">&nbsp;</td>
      <td width="61%"><table width="473" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="342"><span class="Estilo13">Permisos de Documento: </span></td>
          <td width="115">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="86">&nbsp;</td>
      <td valign="top"><div id="tbl_doc">
          <table id="lista_docs" width="241" border="0" cellpadding="0" cellspacing="0">
            <tr style="background:url(imagenes/bg_contentbase2.gif); background-position:100px 60px">
              <td width="51" height="23" align="center"><span class="Estilo11">ID</span></td>
              <td width="299" align="center"><span class="Estilo11">Documento</span></td>
            </tr>
            <tr>
              <td height="19">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
      </div></td>
      <td>&nbsp;</td>
      <td valign="top">
	  
	  
	  <table width="476" border="0" cellpadding="0" cellspacing="0" bgcolor="#F7FEE7" style="border:#999999 solid 1px">
        <tr>
          <td colspan="5" height="2"></td>
          </tr>
        <tr style="background-image:url(imagenes/grid3-hrow-over.gif)" >
          <td width="7" height="23">&nbsp;</td>
          <td colspan="4"><table width="463" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="53"><span style="font-family:Arial, Helvetica, sans-serif; font-size:11px; font:bold; color:#000000">C&oacute;digo</span>&nbsp;</td>
              <td width="27"><input readonly="readonly" name="codigo" type="text" size="2" maxlength="5"></td>
              <td width="73">&nbsp;<span style="font-family:Arial, Helvetica, sans-serif; font-size:11px; font:bold; color:#000000">Documento</span></td>
              <td width="155"><input  name="nombre" type="text" size="25" maxlength="30"></td>
              <td width="155"><span style="font-family:Arial, Helvetica, sans-serif; font-size:11px; font:bold; color:#000000">&nbsp;&nbsp;Sunat
                <input  name="sunat" type="text" size="5" maxlength="10">
              </span></td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td  height="10"colspan="5"></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="checkbox[]" type="checkbox" id="p1" value="checkbox1" style="border: 1px; background-color:#F9F9F9; " ></td>
          <td width="200"><span class="Estilo14">NO Permite venta sin stock  </span></td>
          <td width="20"><input name="checkbox[]" type="checkbox" id="p5" value="checkbox5" style="border: 1px; background-color:#F9F9F9; " ></td>
          <td width="227"><span class="Estilo14">Apertura Cuenta Corriente </span></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="checkbox[]" type="checkbox" id="p20" value="checkbox20" style="border: 1px; background-color:#F9F9F9; " ></td>
          <td><span class="Estilo14">Mostrar Correlativo Autom&aacute;tico </span></td>
          <td><input name="checkbox[]" type="checkbox" id="p21" value="checkbox21" style="border: 1px; background-color:#F9F9F9; " ></td>
          <td><span class="Estilo14">Mostrar  Descuentos 
              <select name="tipoDesc" style="width:120px">
              <option value="P">(%) Porcentual</option>
              <option value="I">(S/.) Importe</option>
            </select>
          </span></td>
        </tr>
        
        <tr>
          <td>&nbsp;</td>
          <td><input name="checkbox[]" type="checkbox" id="p2" value="checkbox2" style="border: 1px; background-color:#F9F9F9; " ></td>
          <td><span class="Estilo14">Anular Documento </span></td>
          <td><input name="checkbox[]" type="checkbox" id="p6" value="checkbox6" style="border: 1px; background-color:#F9F9F9; " ></td>
          <td><span class="Estilo14">Exigir RUC </span></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="20"><input name="checkbox[]" type="checkbox" id="p3" value="checkbox3" style="border: 1px; background-color:#F9F9F9; " ></td>
          <td><span class="Estilo14">Eliminar Documento </span></td>
          <td>
		  
		  <input name="checkbox[]" type="checkbox" id="p7" value="checkbox7" style="border: 1px; background-color:#F9F9F9; " >
		  
		  </td>
          <td><span class="Estilo14">Exigir DNI </span></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="checkbox[]" type="checkbox" id="p4" value="checkbox4" style="border: 1px; background-color:#F9F9F9; " onClick="validarChk(this)" >
		  <script>
		  function validarChk(control){
			if(control.id=='p4'){
				if(control.checked){
				document.form1.imp1.readOnly=true;document.form1.imp2.readOnly=true;
				document.form1.imp1.style.color="#999999";document.form1.imp2.value="";
				}else{
				document.form1.imp1.readOnly=false;document.form1.imp2.readOnly=false;
				document.form1.imp1.style.color="#000000";document.form1.imp2.value="";
				}
			}
			
			
		  }
		  </script>		  </td>
          <td><span class="Estilo14">No Calcula IGV  (Inafecto) </span></td>
          <td><input name="checkbox[]" type="checkbox" id="p8" value="checkbox8" style="border: 1px; background-color:#F9F9F9; " ></td>
          <td><span class="Estilo14">Adicionar Impuestos a ITEMS </span></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2" align="left">
		  <fieldset style="width:180px">
            <span class="Estilo14">% Imp.1
            <input name="imp1" type="text" size="4" style="text-align:right">
            </span><span class="Estilo14">&nbsp;% Imp .2
            <input name="imp2" type="text" size="4" style="text-align:right">
            </span>
          </fieldset></td>
          <td><input name="checkbox[]" type="checkbox" id="p9" value="checkbox9" style="border: 1px; background-color:#F9F9F9; " ></td>
          <td><span class="Estilo14">Precios de items no incluyen impuestos</span></td>
        </tr>
        <tr>
          <td height="27">&nbsp;</td>
          <td align="left">
		  <input name="checkbox[]" type="checkbox" id="p11" value="checkbox11" style="border: 1px; background-color:#F9F9F9; " ></td>
          <td align="left"><span class="Estilo14">Solicitar Doc. Referencia </span></td>
          <td><input name="checkbox[]" type="checkbox" id="p10" value="checkbox10" style="border: 1px; background-color:#F9F9F9; " onClick="acitvar_cbo_k()" ></td>
          <td><span class="Estilo14">Actualizar Kardex
              <select name="kardex">
                <option value="I">Ingreso</option>
                <option value="S">Salida</option>
              </select>
              <input name="checkbox[]" type="checkbox" id="p31" value="checkbox31" style="border: 1px; background-color:#F9F9F9; " onClick="acitvar_cbo_k()" >Verificar</span></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="checkbox[]" type="checkbox" id="p12" value="checkbox12" style="border: 1px; background-color:#F9F9F9; " ></td>
          <td><span class="Estilo14">Copiar datos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N&ordm; max. Items
            <input style="text-align:right" name="nitems" id="nitems" type="text" size="4" maxlength="20">
          </span></td>
          <td colspan="2"><span class="Estilo14">&nbsp;&nbsp;Formato&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input name="formato" id="formato" type="text" size="20" maxlength="50" >
          </span></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2" rowspan="2" align="left" valign="middle">
		  
		
            <div id="capa_ocu_percep"  style="background:#F2F2F2; height:46px; width:218; position:absolute; filter:alpha(opacity=70); display: none">			</div>
			
			
			
			<div>
			  <table width="217" border="0" cellpadding="0" cellspacing="0" style="border:#999999 solid 1px">
                <tr bgcolor="#F7FEE7">
                  <td width="27"><span class="Estilo14">
                    <input  name="checkbox[]" type="checkbox" id="p14" value="checkbox14" style="border: 1px; background-color:#F9F9F9; "  >
                  </span></td>
                  <td width="188"><span class="Estilo14">Afecto a Percepci&oacute;n </span></td>
                </tr>
                <tr bgcolor="#F7FEE7">
                  <td height="24">&nbsp;</td>
                  <td><span class="Estilo14">Monto m&iacute;nimo<strong> &nbsp;&nbsp;S/.</strong>
                        <input style="text-align:right" name="min_percep" id="min_percep" type="text" size="5" maxlength="20">
                  </span></td>
                </tr>
              </table>
			</div>		  </td>
          <td colspan="2" rowspan="2" align="center"><fieldset>
            <table style=" border-bottom:#999999 solid 1px; border-left:#999999 solid 1px;border-right:#999999 solid 1px;border-top:#999999 solid 1px;" width="231" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><input style="background:none; border:none" name="radiobutton" type="radio" value="radiobutton">
                  <span class="Estilo14">Utilizar Cola Predeterminada </span></td>
              </tr>
              <tr>
                <td width="231"><input style="background:none; border:none" name="radiobutton" type="radio" value="radiobutton">
                  <span class="Estilo14">Utilizar Colas de impresi&oacute;n </span></td>
              </tr>
              <tr bgcolor="#F7FEE7">
                <td height="25"><span class="Estilo14">&nbsp;&nbsp;  1.
                  <input name="cola" id="cola" type="text" size="12" maxlength="50" >
                  2.
                  <input name="cola2" id="cola2" type="text" size="12" maxlength="50" >
                </span></td>
              </tr>
            </table>
          </fieldset></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td height="22">&nbsp;</td>
          <td colspan="2" align="left" valign="middle"><span class="Estilo14">&nbsp;&nbsp;Moneda:
              <select name="moneda">
                <option value="01" selected>Soles</option>
                <option value="02">Dolares</option>
              </select>
          </span></td>
         
		  <td id="td1"><span class="Estilo14">
            <input name="checkbox[]" type="checkbox" id="p19" value="checkbox19" style="border: 1px; background-color:#F9F9F9;" >
          </span></td>
          <td id="td2"><span class="Estilo14">Editar Fecha de Registro </span></td>
          </tr>
        <tr>
          <td height="22">&nbsp;</td>
          <td><span class="Estilo14">
            <input name="checkbox[]" type="checkbox" id="p13" value="checkbox13" style="border: 1px; background-color:#F9F9F9; "  >
          </span></td>
          <td valign="middle"><span class="Estilo14"> Solicitar Transportista</span></td>
          <td><span class="Estilo14">
            <input name="checkbox[]" type="checkbox" id="p16" value="checkbox16" style="border: 1px; background-color:#F9F9F9; "  >
          </span></td>
          <td><span class="Estilo14">Permitir Precios &quot;0&quot; </span></td>
        </tr>
        <tr>
          <td height="22">&nbsp;</td>
          <td><span class="Estilo14">
            <input name="checkbox[]" type="checkbox" id="p15" value="checkbox15" style="border: 1px; background-color:#F9F9F9; "  >
          </span></td>
          <td valign="middle"><span class="Estilo14">Cambiar Direcci&oacute;n </span></td>
          <td id="td3"><span class="Estilo14">
           
		    <input name="checkbox[]" type="checkbox" id="p17" value="checkbox17" style="border: 1px; background-color:#F9F9F9;" disabled="disabled">
			
          </span></td>
          <td id="td4"><span class="Estilo14">Resumir x dia para contabilidad </span></td>
        </tr>
        <tr   >
          <td height="19">&nbsp;</td>
          <td id="Modificatransf" style="visibility:hidden"><span class="Estilo14">
            <input name="checkbox[]" type="checkbox" id="p23" value="checkbox23" style="border: 1px; background-color:#F9F9F9;" >
          </span></td>
          <td valign="middle" id="Modificatransf2" style="visibility:hidden"><span class="Estilo14">Permitir Modificar Serie de Transf.</span></td>
          <td id="docPtoVenta"><span class="Estilo14">
            <input name="checkbox[]" type="checkbox" id="p24" value="checkbox24" style="border: 1px; background-color:#F9F9F9;" >
          </span></td>
          <td  id="docPtoVenta2"><span class="Estilo14">Referenciar como pedido en pto. ventas </span></td>
        </tr>
        <tr  >
          <td height="19">&nbsp;</td>
          <td colspan="2" style="visibility:visible" id="row1"><span class="Estilo14">
            <input name="checkbox[]" type="checkbox" id="p18" value="checkbox18" style="border: 1px; background-color:#F9F9F9;" >
          </span><span class="Estilo14">Prestamos / Pases </span></td>
          <td colspan="2"><span class="Estilo14">&nbsp;&nbsp;Precio por Defecto :
            <select name="pDefecto" id="pDefecto">
              <option value="1" selected>precio 1</option>
              <option value="2">precio 2</option>
			  <option value="3">precio 3</option>
			  <option value="4">precio 4</option>
			  <option value="5">precio 5</option>
			  <option value="6">Costo Referencial</option>
			  <option value="7">Costo Promedio</option>
            </select>
			
          </span></td>
          </tr>
        <tr  >
          <td height="19">&nbsp;</td>
          <td colspan="2" style="visibility:visible" id="row1"><span class="Estilo14">
            <input name="checkbox[]" type="checkbox" id="p25" value="checkbox25" style="border: 1px; background-color:#F9F9F9;" >
          </span><span class="Estilo14">NO Permitir Modificar precios  </span></td>
          <td colspan="2"><span style="visibility:visible"><span class="Estilo14">
            <input name="checkbox[]" type="checkbox" id="p26" value="checkbox26" style="border: 1px; background-color:#F9F9F9;" >
          </span><span class="Estilo14">Mostrar Caja de Facturaci&oacute;n  </span></span></td>
        </tr>
        <tr  >
          <td height="23">&nbsp;</td>
          <td style="visibility:visible" id="row1"><span class="Estilo14">
            <input name="checkbox[]" type="checkbox" id="p27" value="checkbox27" style="border: 1px; background-color:#F9F9F9;" >
          </span></td>
          <td style="visibility:visible" id="row1"><span class="Estilo14">&nbsp;Permitir modificar descuentos </span></td>
          <td><span class="Estilo14">
            <input name="checkbox[]" type="checkbox" id="p28" value="checkbox28" style="border: 1px; background-color:#F9F9F9;" >
          </span></td>
          <td><span class="Estilo14"> Sistema puntos </span></td>
        </tr>
        <tr  >
          <td height="23">&nbsp;</td>
          <td style="visibility:visible" id="row1"><span class="Estilo14">
            <input name="checkbox[]" type="checkbox" id="p29" value="checkbox29" style="border: 1px; background-color:#F9F9F9;" >
          </span></td>
          <td style="visibility:visible" id="row1"><span class="Estilo14"> Mostrar Control de Envases </span> </td>
          <td><span class="Estilo14">
            <input name="checkbox[]" type="checkbox" id="p30" value="checkbox30" style="border: 1px; background-color:#F9F9F9;"  onClick="javascript:if(!this.checked){document.form1.elemProd.disabled=true;} else{ document.form1.elemProd.disabled=false;}">
          </span></td>
          <td><span class="Estilo14">Elemen. Producci&oacute;n
            <select name="elemProd" id="elemProd" style="width:120px">
              <option value="1" selected="selected">(1) Materia prima/Insumos</option>
			  <option value="2">(2) Mercaderia/Producto Terminado</option>
			  <option value="3">(3) Servicios</option>
            </select>
          </span></td>
        </tr>
        <tr  >
          <td height="19">&nbsp;</td>
          <td style="visibility:visible" id="row1"><span class="Estilo14">
            <input name="checkbox[]" type="checkbox" id="p32" value="checkbox32" style="border: 1px; background-color:#F9F9F9;" >
          </span></td>
          <td style="visibility:visible" id="row1"><span class="Estilo14">Mostrar Seguimiento Guias Fact. </span></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr  <?php echo $ocultarFila ?> id="row2" >
          <td height="19">&nbsp;</td>
          <td><input name="checkbox[]" type="checkbox" id="p22" value="checkbox22" style="border: 1px; background-color:#F9F9F9; " ></td>
          <td valign="middle"><span class="Estilo14">Mostrar O.T. en docs. </span></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        
        
        <tr>
          <td height="65">&nbsp;</td>
          <td colspan="4" align="center"><table style="border:#CCCCCC solid 1px" width="447" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="445" height="27"><span class="Estilo14">Comentarios</span>
                <input name="comentario1" type="text" size="28" maxlength="100">
                <input name="comentario2" type="text" size="28" maxlength="100" ></td>
            </tr>
			
            <tr>
              <td height="32"><span class="Estilo14">Obs1
<input name="obs1" type="text" size="7" maxlength="28">
Obs2
<input name="obs2" type="text" size="7" maxlength="28">
Obs3
<input name="obs3" type="text" size="7" maxlength="28">
Obs4
<input name="obs4" type="text" size="7" maxlength="28">
Obs5
<input name="obs5" type="text" size="7" maxlength="28">
              </span></td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="3" align="center"><input type="submit" name="Submit" value="Guardar">
            <input type="button" name="Submit2" value="Condiciones" onClick="condiciones()">
            <input type="button" name="Submit2" value="Doc.Referencia" onClick="referencias()"></td>
        </tr>
        <tr>
          <td colspan="5" height="8"></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>

  <div id="divNuevoDoc" style="border:#238CE2 solid 1px; background:#E2FAFE; position:absolute; left:274px; top:139px; width:300px; height:180px; z-index:2; visibility:hidden; background-color: #F1FBFE;">
    <table width="298" height="154" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="26" style="background:url(imagenes/bg_contentbase2.gif); background-position:100px 60px; color:#FFFFFF"><strong>&nbsp; </strong><strong></strong></td>
        <td height="26" colspan="2" style="background:url(imagenes/bg_contentbase2.gif); background-position:100px 60px; color:#FFFFFF"><strong>Nuevo Documento</strong></td>
        <td height="26" align="center" style="background:url(imagenes/bg_contentbase2.gif); background-position:100px 60px; color:#FFFFFF; text-decoration:underline; cursor:pointer" onClick="salir();"><strong>x</strong></td>
      </tr>
      <tr>
        <td height="9" colspan="4"></td>
      </tr>
      <tr>
        <td width="8">&nbsp;</td>
        <td width="79" height="23"><span class="Estilo35">Codigo</span></td>
        <td width="198"><input name="codDoc" type="text" id="codDoc" size="5" maxlength="2"></td>
        <td width="13" rowspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="23"><span class="Estilo35">Descripci&oacute;n </span></td>
        <td><input name="desDoc" type="text" id="desDoc" size="30"></td>
      </tr>
      <tr>
        <td width="8">&nbsp;</td>
        <td width="79" height="27"><span class="Estilo35">Tipo</span></td>
        <td><select name="tipoDoc">
          <option value="2" selected>Ventas</option>
          <option value="1">Compras</option>
        </select>        </td>
      </tr>
      <tr>
        <td height="46" colspan="4" align="center"><input onClick="saveNewDoc();" type="button" name="Submit3" value="Aceptar">
            <input type="button" name="Submit4" value="Cancelar" onClick="salir();"></td>
      </tr>
    </table>
  </div>
</form>
</body>
</html>

<script>

function condiciones(){

   var r=  Math.floor(Math.random()*(10000+1));
   var codigo=document.form1.codigo.value;
   var nombre=document.form1.nombre.value;
   
	  
	if(document.form1.codigo.value!=""){
	var datos = window.showModalDialog("condiciones.php?"+r+"&codigo="+codigo+"&nombre="+nombre,"","dialogWidth:585px;dialogHeight:320px,top=180,left=200,status=no,scrollbars=yes");
	}else{
	alert('No se ha seleccionado un documento ');
	}
				
}

function referencias(){

   var r=  Math.floor(Math.random()*(10000+1));
   var codigo=document.form1.codigo.value;
   var nombre=document.form1.nombre.value;
   var tipo=document.form1.aplicacion.value;
   
	  
	if(document.form1.codigo.value!=""){
		if(document.getElementById('p11').checked){
			var datos = window.showModalDialog("referencias.php?"+r+"&codigo="+codigo+"&tipo="+tipo+"&nombre="+nombre,"","dialogWidth:585px;dialogHeight:320px,top=180,left=200,status=no,scrollbars=yes");
		}else{
			alert('Documento debe solicitar Documento de Referencia ');
		}
	}else{
	alert('No se ha seleccionado un documento ');
	}
				
}

function acitvar_cbo_k(){
}


  		function entrar_btn(obj){
		  obj.cells[0].style.backgroundImage="url(imagenes/bordes_boton1.gif)";
		  obj.cells[1].style.backgroundImage="url(imagenes/bordes_boton2.gif)";
		  obj.cells[2].style.backgroundImage="url(imagenes/bordes_boton2.gif)";
		  obj.cells[3].style.backgroundImage="url(imagenes/bordes_boton3.gif)";
		  
		  }
		  function salir_btn(obj){
		  obj.cells[0].style.backgroundImage="";
		  obj.cells[1].style.backgroundImage="";
		  obj.cells[2].style.backgroundImage="";
		  obj.cells[3].style.backgroundImage="";
		  
		  }
	
	function nuevoDoc(){
	
	document.getElementById("divNuevoDoc").style.visibility="visible";
	
	}
	
	function salir(){
	
		if(document.getElementById("divNuevoDoc").style.visibility=="visible"){

		document.getElementById("divNuevoDoc").style.visibility="hidden";
		}
	}
	
	function saveNewDoc(){
	
		var codDoc=document.form1.codDoc.value;
		var desDoc=document.form1.desDoc.value;
		var tipoDoc=document.form1.tipoDoc.value;
		
		doAjax('peticion_ajax.php','codDoc='+codDoc+'&desDoc='+desDoc+'&tipoDoc='+tipoDoc,'saveNewDoc2','get','0','1','','');
	
	}
	
	function saveNewDoc2(texto){
//	alert(texto);
	document.getElementById("divNuevoDoc").style.visibility="hidden";
	location.href="documentos.php";
	}
	
	
</script>
