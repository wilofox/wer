<?php session_start();
 include('conex_inicial.php');


//number_format(13.1651111111111111,2);


	if(isset($_REQUEST['instalar'])){
	
	$razon=$_REQUEST['razonsocial'];
	$codigo=$_REQUEST['codigocliente'];
	$terminal=$_REQUEST['terminal'];
	$serie=$_REQUEST['serie'];
	$fecha=$_REQUEST['fecha'];
	$responsable=$_REQUEST['responsable'];
	
	$cadena=$codigo.$terminal.$serie;
	
	$unico=md5($cadena);
	$strSQL="insert into instalar(razonsocial,codcliente,terminal,serie,unico,fecha,responsable) values ('".$razon."','".$codigo."','".$terminal."','".$serie."','".$unico."','".$fecha."','".$responsable."')";
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

//echo $_SESSION['terminal'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!-- saved from url=(0045)http://www.utp.edu.pe/universidadvirtual.html -->
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>:::: SISTEMA PROLYAM RP :::::</TITLE>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<STYLE type=text/css>
BODY {
	BACKGROUND-IMAGE: url(imagenes/fondointranet2.gif)
}
</STYLE>
<LINK href="imagenes/stilos.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.2900.3660" name=GENERATOR>
<style type="text/css">
<!--
.Estilo4 {
	font-size: 16px;
	font-family: Georgia, "Times New Roman", Times, serif;
}
.Estilo8 {font-family: Tahoma}
-->
</style>
</HEAD>
<script type="text/javascript" src="utilitarios/npProlyam.js"></script> 
<script type="text/javascript" src="utilitarios/jquery-1.4.4.js"></script> 

<script language="javascript">
	// var  objPlugin = new  npPlugin("plugin");
  
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
		
		
	function cargar(){
	
	//document.getElementById('pc').innerHTML=objPlugin.getComputerName();
	document.form1.usuario.focus();
	}	
			
</script>



<BODY onLoad="cargar()">

	<?php /*?>  <!--[if IE]>
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
    <!--<![endif]--><?php */?>
	
	
	
	

<TABLE cellSpacing=0 cellPadding=0 width=780 align=center border=0>
  <TBODY>
  <TR>
    <TD vAlign=top>
      <TABLE height=132 cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD>
	<!--
	<label id="pc"></label><br>
		  <input type=button value="Call plugin.FunctionValue('getVersion')" onClick="alert(objPlugin.getVersion())">
          <input type=button value="Call plugin.FunctionValue('getPrinters')" onClick="alert(objPlugin.getPrinters())">
		   <br>
-->		   
		   <!--
		  <input type=button value="Call plugin.FunctionValue('getMAC')" onClick="alert(objPlugin.getMAC())"><br> <input name="button" type=button onClick="alert(objPlugin.getSO())" value="Call plugin.FunctionValue('getSO')"><br><input type=button value="Call plugin.FunctionValue('getComputerName')" onClick="alert(objPlugin.getComputerName())">
		   <input type=button value="Call plugin.FunctionValue('getUserName')" onClick="alert(objPlugin.getUserName())">
    <BR>
    <input type=button value="Call plugin.FunctionValue('getPrinters')" onClick="alert(objPlugin.getPrinters())">
    <BR>
    <input type=button value="Call plugin.FunctionValue('getHDDSerial')" onClick="alert(objPlugin.getHDDSerial())">
    <BR>
	<input type=button value="Call PrintHTML()" onClick="PrintHTMLSample()">
    <label>printer:<input id="printer" type=text value="CutePDF Writer"> </label>

-->




		  </TD></TR></TBODY></TABLE>
      <form name="form1" method="post" action="login_script.php" onSubmit="return validar_navegador()">
        <TABLE height=250 cellSpacing=0 cellPadding=0 width="100%" border=0>
          <TBODY>
            <TR>
              <TD vAlign=center align=middle><TABLE height=301 cellSpacing=0 cellPadding=0 width=561 
            background=imagenes/contenedor3.gif border=0>
                  <TBODY>
                    <TR>
                      <TD vAlign=top><TABLE height=99 cellSpacing=0 cellPadding=0 width="100%" 
                  border=0>
                          <TBODY>
                            <TR>
                              <TD vAlign=top><TABLE height=99 cellSpacing=0 cellPadding=0 
                        width="100%" border=0>
                                  <TBODY>
                                    <TR>
                                      <TD vAlign=top align=left width="52%">&nbsp;</TD>
                                      <TD vAlign=top width="48%"><TABLE cellSpacing=0 cellPadding=0 width="100%" 
                              border=0>
                                          <TBODY>
                                            <TR>
                                              <TD>&nbsp;</TD>
                                            </TR>
                                          </TBODY>
                                      </TABLE>
                                          <TABLE cellSpacing=0 cellPadding=0 width="100%" 
                              border=0>
                                            <TBODY>
                                              <TR>
                                                <TD>&nbsp;</TD>
                                              </TR>
                                            </TBODY>
                                          </TABLE>
                                        <TABLE cellSpacing=0 cellPadding=0 width="100%" 
                              border=0>
                                            <TBODY>
                                              <TR>
                                                <TD>&nbsp;</TD>
                                              </TR>
                                            </TBODY>
                                        </TABLE>
                                        <TABLE cellSpacing=0 cellPadding=0 width="100%" 
                              border=0>
                                            <TBODY>
                                              <TR>
                                                <TD>&nbsp;</TD>
                                              </TR>
                                            </TBODY>
                                        </TABLE>
                                        <TABLE cellSpacing=0 cellPadding=0 width="100%" 
                              border=0>
                                            <TBODY>
                                              <TR>
                                                <TD vAlign=top align=center><SPAN 
                                class=tahoma13boldgris Estilo4><SPAN 
                                class=Estilo8>SISTEMA VIRTUAL RP</SPAN></SPAN></TD>
                                              </TR>
                                            </TBODY>
                                        </TABLE></TD>
                                    </TR>
                                  </TBODY>
                              </TABLE></TD>
                            </TR>
                          </TBODY>
                      </TABLE>
                          <TABLE height=183 cellSpacing=0 cellPadding=0 width="100%" 
                  border=0>
                            <TBODY>
                              <TR>
                                <TD vAlign=top align=left>&nbsp;</TD>
                                <TD vAlign=top align=left width="50%"><TABLE height=53 cellSpacing=0 cellPadding=0 
                        width="100%" border=0>
                                    <TBODY>
                                      <TR vAlign=top>
                                        <TD>&nbsp;</TD>
                                      </TR>
                                    </TBODY>
                                </TABLE>
                                    <TABLE height=58 cellSpacing=0 cellPadding=0 
                        width="100%" border=0>
                                      <TBODY>
                                        <TR>
                                          <TD vAlign=top><TABLE cellSpacing=0 cellPadding=0 width="100%" 
                              border=0>
                                              <TBODY>
                                                <TR>
                                                  <TD class=arial11boldgris 
                                width="32%">USUARIO</TD>
                                                  <TD width="68%"><input name="usuario" type="text"  size="20" maxlength="50" autocomplete="off" value="<?php echo $_SESSION['temp_usu'];?>" />
                                                      <input type="hidden" name="temp_conx" value="N"></TD>
                                                </TR>
                                              </TBODY>
                                          </TABLE>
                                              <TABLE cellSpacing=0 cellPadding=0 width="100%" 
                              border=0>
                                                <TBODY>
                                                  <TR>
                                                    <TD>&nbsp;</TD>
                                                  </TR>
                                                </TBODY>
                                              </TABLE>
                                            <TABLE cellSpacing=0 cellPadding=0 width="100%" 
                              border=0>
                                                <TBODY>
                                                  <TR>
                                                    <TD class=arial11boldgris 
                                width="32%">CONTRASE&Ntilde;A</TD>
                                                    <TD class=arial11boldgris width="68%"><input name="password" type="password"  onKeyUp="enter(event)" size="20" maxlength="50" autocomplete="off" value="<?php echo $_SESSION['temp_pas']?>" /></TD>
                                                  </TR>
                                                </TBODY>
                                            </TABLE></TD>
                                        </TR>
                                      </TBODY>
                                    </TABLE>
                                  <TABLE cellSpacing=0 cellPadding=0 width="100%" 
border=0>
                                      <TBODY>
                                        <TR>
                                          <TD>&nbsp;</TD>
                                        </TR>
                                      </TBODY>
                                  </TABLE>
                                  <TABLE cellSpacing=0 cellPadding=0 width="100%" 
border=0>
                                      <TBODY>
                                        <TR>
                                          <TD>&nbsp;</TD>
                                        </TR>
                                      </TBODY>
                                  </TABLE>
                                  <TABLE height=29 cellSpacing=0 cellPadding=0 
                        width="100%" border=0>
                                      <TBODY>
                                        <TR>
                                          <TD width="61%">&nbsp;</TD>
                                          <TD width="39%"><button type="submit" style="background:none; border:none" ><IMG style="cursor:pointer" height=24 
                              src="imagenes/ingresar.gif" 
                          width=65></button></TD>
                                        </TR>
                                      </TBODY>
                                  </TABLE></TD>
                              </TR>
                            </TBODY>
                          </TABLE></TD>
                    </TR>
                  </TBODY>
              </TABLE></TD>
            </TR>
          </TBODY>
        </TABLE>
            </form>
      </TD>
  </TR></TBODY></TABLE></BODY></HTML>
  
  <script>
var estado="<?php echo $_REQUEST['e']?>";

if(estado=='c'){
var usuario="<?php echo  $_SESSION['temp_usu']?>";

	if(confirm(" El usuario "+usuario+" a iniciado sesion desde otro equipo. Si acepta cerrara automaticamente la otra conexion.")){
	
	document.form1.temp_conx.value="S";
	enviar_form();
	}else{
	document.form1.usuario.value="";
	document.form1.password.value="";
	document.form1.usuario.focus();
	}
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

function validar_navegador(){ 
	if(navigator.appName!='Microsoft Internet Explorer'){
	alert('Este Navegador no es compatible con el sistema');
	return false;
	window.close();
	}
	return true;
}

</script>




<script language="javascript">
  
</script>




