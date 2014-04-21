<?php 
	session_start();
	include('conex_inicial.php');
	
	
	if(isset($_REQUEST['instalar'])){

		$razon = $_REQUEST['razonsocial'];
		$codigo = $_REQUEST['codigocliente'];
		$terminal = $_REQUEST['terminal'];
		$serie = $_REQUEST['serie'];
		$fecha = $_REQUEST['fecha'];
		$responsable = $_REQUEST['responsable'];
		
		$cadena = $codigo . $terminal . $serie;
		
		$unico = md5($cadena);
		$strSQL = "insert into instalar(razonsocial,codcliente,terminal,serie,unico,fecha,responsable) values ('".$razon."','".$codigo."','".$terminal."','".$serie."','".$unico."','".$fecha."','".$responsable."')";
		//echo $strSQL;
		mysql_query($strSQL,$cn);
		
		$resultado3=mysql_query("select max(codigo) as codigo from caja",$cn);
		$row3=mysql_fetch_array($resultado3);
		
		$codi=$row3['codigo'];
		$codi=str_pad($codi+1, 3, "0", STR_PAD_LEFT);
		
		$strsql22="insert into caja (codigo,descripcion) values('".$codi."','".$terminal."')";
		mysql_query($strsql22,$cn);
		
		$fp = fopen("terminal_prolyam.ini","w+"); 
		fwrite($fp, $unico); 
		fclose($fp); 
	}

	/*
$nombre_archivo = "terminal_prolyam.ini";
$control_archivo = fopen($nombre_archivo, 'a+') or die("no se puede abrir");
$texto=fgets($control_archivo,100);
fclose($control_archivo);
$cont=strlen($texto);
//mkdir("d:/syshyl/prolyres/", 0700);

if($cont>0){
$temp='N';
$strSQl2="select * from instalar";
$resultado=mysql_query($strSQl2,$cn);
	while($row=mysql_fetch_array($resultado)){
		
		if($row['unico']==$texto){
		$temp='S';
		}
	}
}

*/
/*
//$pc=gethostbyaddr('209.126.254.221');
$pc=gethostbyaddr($_SERVER['REMOTE_ADDR']);
//$pc=$_ENV["COMPUTERNAME"];

echo $pc;
$strSQl2="select * from caja where pc='$pc'";

$resultado=mysql_query($strSQl2,$cn);
$cont=mysql_num_rows($resultado);
	while($row=mysql_fetch_array($resultado)){
	$_SESSION['terminal']=$row['descripcion'];
	$_SESSION['codterminal']=$row['codigo'];
	$_SESSION['caja_serie']=$row['serie1'];
	$_SESSION['registradora']=$row['maqreg'];
	}

$_SESSION['pc_ingreso']=$pc;
*/
//echo $_SESSION['terminal'];
?>

<!-- saved from url=(0045)http://www.utp.edu.pe/universidadvirtual.html -->
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>:::: SISTEMA PROLYAM RP :::::</TITLE>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<STYLE type=text/css>

</STYLE>
<LINK href="imagenes/stilos.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.2900.3660" name=GENERATOR>
<style type="text/css">
<!--
.Estilo9 {color: #FFFFFF}
.Estilo10 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
	color: #FFFFFF;
}
.Estilo11 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 11px;
}
.Estilo12 {
	font-size: 11px;
	font-family: Arial, Helvetica, sans-serif;
	color: #FF0000;
}
-->
</style>
</HEAD>
<script type="text/javascript" src="utilitarios/npProlyam.js"></script> 
<script type="text/javascript" src="utilitarios/jquery-1.4.4.js"></script> 

<script language="javascript" src="miAJAXlib2.js"></script>

<script language="javascript">
	 var  objPlugin = new  npPlugin("plugin");
  
    function extract_link_href(aSourceHTML)
    {
        var regexp=/<link.*href\s*=\s*[\'\"]([^\"\']*)[\"\'][^>]*>/ig;
        var result;
        var sret="";
        while((result = regexp.exec(aSourceHTML)) != null) {
            sret+=result[1]+";";
        }
        return sret; 
    }

    function SaveHTML(url)
    {
        var url_links="";
        var alinks=new Array();
        var all_css =new Array();
        var s_url="";
        var all_html="";
       // alert(1);
        s_url=url;
        all_html="";
        if (s_url!=""){
                alert(s_url);
                $.ajax({
                  type: "GET",
                  async:false,    
                  dataType: "text/html",          
                  url: s_url,//alinks[link],
                  complete: function( res, status ) {
                        // If successful, inject the HTML into all the matched elements
                        if ( status === "success" || status === "notmodified" ) 
                        {
                          //alert(res.responseText);
                          all_html=res.responseText;
                        }
                        //alert(res.responseText);
                        //alert(22);
                    }
                });        
        }
        // alert(20);
        if (all_html==""){
            alert("error al recuperar html base.... pf verifique");
            return ;
         }   
         
         url_links= extract_link_href(all_html);
        alinks= url_links.split(";");
        for (var link in alinks )
        {
            var s_url=alinks[link];
            //alert(s_url);
            if (s_url!=""){
                $.ajax({
                  type: "GET",
                  async:false,    
                 // contentType='application/x-www-form-urlencoded',
                  dataType: "text/html",          
                  url: s_url,//alinks[link],
                  complete: function( res, status ) {
                        // If successful, inject the HTML into all the matched elements
                        if ( status === "success" || status === "notmodified" ) 
                        {
                          all_css[s_url]=res.responseText;
                          //alert(res.responseText);
                        }
                        //all_css+=res.responseText;
                    }
                });        
            }
        }
        //alert("1");  
        //alert(all_html);
        objPlugin.saveDataHTML(url,all_html, "html");
        for (var v in  all_css)
        {
            //alert(all_css[v]);
            objPlugin.saveDataHTML(v,all_css[v], "css");
        } 
    }    


    function PrintHTMLSample()
    {
	  var url="formatos/rpt_factura_div_gedeon.php?serie=001&numero=0003531&sucursal=1&doc=GR";
	  objPlugin.PrintHTML( url, document.getElementById("printer").value);
	  // colocar la URL a imprimir
	//  SaveHTML(url)
//       objPlugin.PrintHTML(url,document.getElementById("printer").value);
        
    }
	
	function iniciar(){
	objPlugin.getVersion();
		
	//alert(valor);
	}
	
	function isset(variable_name) {
			try {
			//alert(variable_name);
				 if (typeof(eval(variable_name)) != 'Object')
				 if (eval(variable_name) != null)
				 return true;
			 } catch(e) { }
			return false;
	}
		
	var tempPlugin=0;	
	var tempPlugin2=0;	
	function cargar(){
		// alert(objPlugin.getPrinters());
		try{
		document.getElementById('pc').innerHTML=objPlugin.getComputerName();
		document.form1.pc.value=objPlugin.getComputerName();
		document.form1.usuario.focus();
		tempPlugin2=1;
		var mac=objPlugin.getMAC().split("|");
		document.form1.mac.value=mac[0];
		//alert();
		document.form1.userWin.value=objPlugin.getUserName();
		doAjax('peticion_ajax5.php','&mac='+mac[0]+'&userWin='+objPlugin.getUserName()+'&peticion=actConexion','tempR','get','0','1','','');
		}catch(e){
			//alert("Desea ejecutar el RP Prolyam en esta computadora ? ");
			var answer = confirm ("Desea ejecutar el RP Prolyam en esta computadora ? ")
			if (answer){
				window.showModalDialog("utilitarios/pruebaExe.php" ,"","dialogWidth:210px;dialogHeight:140px,top=100,left=200,status=yes,scrollbars=yes");
				window.open("utilitarios/pruebaExe.php" ,"","dialogWidth:210px;dialogHeight:140px,top=100,left=200,status=yes,scrollbars=yes");
			//document.form1.submit();
			}
		}
	
	}
	
	function tempR(t){
	//alert(t);
	
	}
	
	function tempR2(t){
	//alert(t);
	//document.getElementById("capaAlert").style.visibility='hidden';
	//var elemento=document.getElementById('capa_fondo');
	//elemento.parentNode.removeChild(elemento);
	
	location.href="index.php";
	}	
			
</script>
<BODY onLoad="cargar()" style="vertical-align:top; text-align:center; background-color:#EEEEEE">

<label id="pc">

</label>
        <TABLE height='100%' cellSpacing=0 cellPadding=0 width='100%' border=0 >
          <TBODY>
            <TR>
              <TD height="46" align=left vAlign=top >&nbsp;</TD>
            </TR>
            <TR >
              <TD  align="center" >
			  <TABLE style="background:url(imagenes/ACCESO-AL-SISTEMA.jpg)" height="550px" cellSpacing=0 cellPadding=0 width="1100px" border=0>
                <TBODY>
                  <TR>
                    <TD height="226" vAlign=center align="right">
					<!--  onSubmit="return validar_navegador()" -->
					<form name="form1" method="post" action="login_script.php" onSubmit="return validarInstalador()" >
                        <TABLE cellSpacing=0 cellPadding=0 width="44%" 
                              border=0>
                          <TBODY>
                            <TR>
                              <TD height="180" align="right" class="arial11boldgris Estilo9 Estilo9">&nbsp;</TD>
                              <TD colspan="2" align="center" class="arial11boldgris">&nbsp;</TD>
                            </TR>
                            <TR>
                              <TD width="44%" height="34" align="right" class="arial11boldgris Estilo9 Estilo9">USUARIO</TD>
                              <TD 
                                width="45%" align="center" class="arial11boldgris"><input name="usuario" type="text"  size="20" maxlength="50" autocomplete="off" value="<?php echo $_SESSION['temp_usu'];?>"  style=""/>
                              <input type="hidden" name="temp_conx" value="N">
                              <input readonly="" type="hidden" name="pc" id="pc">
                              <input readonly="" type="hidden" name="mac" id="mac">
                              <input readonly="" type="hidden" name="userWin" id="userWin"></TD>
                              <TD 
                                width="11%" align="center" class="arial11boldgris">&nbsp;</TD>
                            </TR>
                            <TR>
                              <TD height="32" align="right" class=arial11boldgris><span class="arial11boldgris Estilo9">CONTRASE&Ntilde;A</span></TD>
                              <TD align="center" class=arial11boldgris style="padding-top:10px"><input name="password" type="password"  onKeyUp="enter(event)" size="20" maxlength="50" autocomplete="off" value="<?php echo $_SESSION['temp_pas']?>" style="" /></TD>
                              <TD align="center" class=arial11boldgris style="padding-top:10px">&nbsp;</TD>
                            </TR>
                            <TR>
                              <TD height="41" class=arial11boldgris>&nbsp;</TD>
                              <TD align="right" class=arial11boldgris><button type="submit" style="background:none; border:none; width:70px; height:18px; cursor:pointer; background-image:url(imagenes/botonlogin.png); background-repeat:no-repeat" ></button>                                        </TD>
                              <TD align="right" class=arial11boldgris>&nbsp;</TD>
                            </TR>
                          </TBODY>
                        </TABLE>
                    </form></TD>
                  </TR>
                </TBODY>
              </TABLE></TD>
            </TR>
            <TR>
              <TD align=left vAlign=top  >&nbsp;</TD>
            </TR>
          </TBODY>
        </TABLE>
     
      <!--[if IE]>
    <object CLASSID="CLSID:D59F4895-9DEE-471E-B176-6E7FC9E01130"  
            id="plugin" 
            type="application/prolyam-plugin"  
            width="200" 
            height="50"  
			 style="visibility:hidden"
			>
    </object>
    
    <![endif]-->
    <!--[if !IE]> <!-->
    <object id="plugin" 
            type="application/prolyam-plugin"  
            width="200" 
            height="50"
			 style="visibility:hidden"
			 >
    </object>
    <!--<![endif]-->
	
	<div id="capaAlert" style="background:#E2FAFE; position:absolute; left:324px; top:253px; z-index:2; visibility:hidden; background-color: #F1FBFE; width: 514px; height: 204px;">
 <!--<form id="frm_cajaFact" name="frm_cajaFact">-->
 <table width="516" height="203" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td height="23" colspan="3" ><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="54" style="background:url(imagenes/img_panelbox/top_logo.gif) repeat-x scroll 0 0 transparent">&nbsp;</td>
        <td width="456" style="background:url(imagenes/img_panelbox/top_m.gif) repeat-x scroll 0 0 transparent; "><table width="455" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="435"><span class="Estilo119 Estilo10">Restauracion de Sistema </span></td>
            <td width="20" align="center" style="cursor:pointer; display:none" onClick="cerrarCaja()"><span class="Estilo131">x</span></td>
          </tr>
        </table></td>
        <td width="6" style="background:url(imagenes/img_panelbox/top_r.gif) repeat-x scroll 0 0 transparent"></td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td width="6" height="173" style="background:url(imagenes/img_panelbox/left.gif) repeat scroll 0 0 transparent"></td>
    <td width="358" valign="top"><table width="498" height="184" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="83" align="center"><span class="Estilo125"><label id="etiqMonCaja"></label> <label id="montoCajaF"></label>
        </span><span class="Estilo11">Se esta realizando un mantenimiento del sistema no cerrar esta ventana  hasta que termine . Gracias </span></td>
        </tr>
      
      <tr>
        <td height="39" align="center"><img src="imgenes/cargando2.gif" width="16" height="16"></td>
      </tr>
      <tr>
        <td height="59" align="center" valign="top" class="Estilo12">Verificando Integridad de  Datos </td>
        </tr>
    </table></td>
    <td width="6" style=" background:url(imagenes/img_panelbox/right.gif) repeat scroll 0 0 transparent"></td>
  </tr>
  
  <tr>
    <td height="7" align="center" style="background:url(imagenes/img_panelbox/bottom_l.gif) repeat scroll 0 0 transparent"></td>
    <td height="7" align="center" style="background:url(imagenes/img_panelbox/bottom_m.gif) repeat scroll 0 0 transparent"></td>
    <td width="6" style="background:url(imagenes/img_panelbox/bottom_r.gif) repeat scroll 0 0 transparent"></td>
  </tr>
</table>
<!--</form>-->
</div>
	
	
</BODY></HTML>
  
  <script>
var estado="<?php echo $_REQUEST['e']?>";

if(estado=='c'){
	var usuario="<?php echo  $_SESSION['temp_usu']?>";
	
	alert("El sistema ya se encuentra abierto en esta pc");
	window.close();
	
	/*if(confirm(" El usuario "+usuario+" a iniciado sesion desde otro equipo. Si acepta cerrara automaticamente la otra conexion.")){
	
	document.form1.temp_conx.value="S";
	enviar_form();
	}else{
	document.form1.usuario.value="";
	document.form1.password.value="";
	document.form1.usuario.focus();
	}
	*/
}else{
	<?php echo $_SESSION['temp_usu']=''?>
	<?php echo $_SESSION['temp_pas']=''?>
}

function enviar_form(){
	document.form1.submit();
}

function enter(e){
	if(e.keyCode==13){
		enviar_form();	
	
	}
}
/*
function validar_navegador(){ 

	if(navigator.appName!='Microsoft Internet Explorer'){
		alert('Este Navegador no es compatible con el sistema');
	return false;
	window.close();
	}
	return true;
}
*/

function recargar(){
	//document.form1.submit();
	location.reload();
	
}

function validarInstalador(){

	try{
		document.getElementById('pc').innerHTML=objPlugin.getComputerName();
		document.form1.pc.value=objPlugin.getComputerName();
		
		//document.form1.usuario.focus();
		tempPlugin2=1;
		var mac=objPlugin.getMAC().split("|");
		document.form1.mac.value=mac[0];
		//alert();
		document.form1.userWin.value=objPlugin.getUserName();
		
		return true;
				
		}catch(e){
		//alert("Desea ejecutar el RP Prolyam en esta computadora ? ");
		var answer = confirm ("El sistema no se encuentra instalado ........Desea ejecutar el RP Prolyam en esta computadora ? ")
			if (answer){
			//window.showModalDialog("utilitarios/pruebaExe.php" ,"","dialogWidth:210px;dialogHeight:140px,top=100,left=200,status=yes,scrollbars=yes");
			window.open("utilitarios/pruebaExe.php" ,"","dialogWidth:50px;dialogHeight:50px,top=0,left=0,status=yes,scrollbars=yes");
			//document.form1.submit();
			}else{
			
			}
		return false;		
		}

}

function generateCoverDiv(id, color, opacity)
{
    var navegador=1;
    if(navigator.userAgent.indexOf("MSIE")>=0) navegador=0;
    
    var layer=document.createElement('div');
    layer.id=id;
    layer.style.width=document.body.offsetWidth+'px';
    layer.style.height=document.body.offsetHeight+'px';
	//layer.style.width=’100%’;
	//layer.style.height=’100%’
	
    layer.style.backgroundColor=color;
    layer.style.position='absolute';
    layer.style.top=0;
    layer.style.left=0;
    layer.style.zIndex=0;
    if(navegador==0) layer.style.filter='alpha(opacity='+opacity+')';
    else layer.style.opacity=opacity/100;
    
    document.body.appendChild(layer);
} 


</script>