<?php 
session_start();

 unset($_SESSION['array_des']);
 
 $_SESSION['array_des'][0][] = "";
 $_SESSION['array_des'][1][] = "";
 $_SESSION['array_des'][2][] = "";

?>

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Condiciones de Documento</title>

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
.Estilo1 {
	color: #000000;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo13 {font-size: 11px; font-family: Arial, Helvetica, sans-serif;}
.Estilo15 {font-size: 11px; font-family: Arial, Helvetica, sans-serif; color: #000000; }
.EstiloL1{ color:#000000}
.Estilo20 {color: #FFFFFF; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
-->
</style>
</head>

<?php 
include('conex_inicial.php');
		$des_doc=$_REQUEST['nombre'];
		$codigo=$_REQUEST['codigo'];
		$tipo=$_REQUEST['tipo'];
		
		$strSQL="select * from refope where  documento='$codigo' and tipo='$tipo' order by id";
		$resultado=mysql_query($strSQL,$cn);
		while($row=mysql_fetch_array($resultado)){
		
         $_SESSION['array_des'][0][] = $row['codigo'];
		 $_SESSION['array_des'][1][] = $row['descripcion'];
		 //$_SESSION['array_des'][2][] = $row['deuda'];
		}
	  
?>

<script language="javascript" src="miAJAXlib2.js"></script>
<script>
		  function entrar_btn(obj){
		  obj.cells[0].style.backgroundImage="url(imagenes/bordes_boton1.gif)";
		  obj.cells[1].style.backgroundImage="url(imagenes/bordes_boton2.gif)";
		  //obj.cells[2].style.backgroundImage="url(imagenes/bordes_boton3.gif)";
		  }
		  
		  function salir_btn(obj){
		  obj.cells[0].style.backgroundImage="";
		  obj.cells[1].style.backgroundImage="";
		  //obj.cells[2].style.backgroundImage="";
		  }
		  
		  
	var temp="";
function entrada(objeto){

	objeto.cells[0].childNodes[0].checked=true;

	if(objeto.style.background=='#fff1bb'){
	//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='#FFF1BB';
	
	temp.style.background='#FFFFFF';
	temp=objeto;
	}

}	  
		  
	function carga(){
	document.forms["form1"]["lst_condi"].value=document.forms["form1"]["lst_condi"].options[0].value;
	
	
		if(document.getElementById('lista_condi').rows.length > 1){
		
		document.getElementById('lista_condi').rows[1].style.background='#fff1bb';
		temp=document.getElementById('lista_condi').rows[1];
		document.getElementById('lista_condi').rows[1].cells[0].childNodes[0].checked=true;
		}
	
	}		  

		  
		  
		  
</script>

<body onLoad="carga()">
<form id="form1" name="form1" method="post" action="" >
  <table  width="546" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="49" colspan="4" style="padding-left:15px">
	  
	  <table style="border:#CCCCCC solid 1px" width="527" height="38" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="525"><table width="524" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="94"><span class="Estilo1">Documento</span></td>
                  <td width="430"><input readonly="" name="textfield" type="text" size="40" maxlength="100" value="<?php echo $des_doc?>" />
                  <input type="hidden" name="cod_docu" value="<?php echo $_REQUEST['codigo']?>"></td>
                </tr>
            </table></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td width="14">&nbsp;</td>
      <td><span class="Estilo1">Documentos</span></td>
      <td>&nbsp;</td>
      <td width="272"><span class="Estilo1">Selecci&oacute;n</span></td>
    </tr>
    <tr>
      <td height="55">&nbsp;</td>
      <td width="170"><select name="lst_condi" size="10"  style="width:170">
        <?php 
		
		$filtro=" where tipo='$tipo' and codigo!='".$codigo."' ";
		foreach ($_SESSION['array_des'][0] as $subkey=> $subvalue) {
		$filtro.=" and codigo!='".$_SESSION['array_des'][0][$subkey]."' ";
		}	  
	  	  
	    $resultados1 = mysql_query("select * from operacion ".$filtro." order by descripcion ",$cn); 
		while($row1=mysql_fetch_array($resultados1))
		{
		  
	  ?>
        <option value="<?php echo $row1['codigo']?>" ><?php echo $row1['descripcion']?></option>
        <?php 
	   }
	   ?>
      </select>
	  
	  </td>
      <td width="90"><table width="68" height="91" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="22" colspan="3" align="center">&nbsp;</td>
        </tr>
        <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="agregar()">
          <td width="3" height="22" align="center" class="Estilo13" >&nbsp;</td>
          <td width="59"  align="center" class="Estilo13" ><img src="imagenes/Adicionar.gif" width="25" height="17"></td>
          <td width="3" align="center" class="Estilo13" >&nbsp;</td>
        </tr>
        <tr>
          <td height="24" colspan="3" align="center"><span class="Estilo15">Adicionar</span></td>
        </tr>
       <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="quitar_item()">
          <td width="3" height="22" align="center" class="Estilo13" >&nbsp;</td>
          <td width="59"  align="center" class="Estilo13" ><img src="imagenes/quitar.gif" width="25" height="17"></td>
          <td width="3" align="center" class="Estilo13" >&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3" align="center" class="Estilo15">Quitar</td>
        </tr>
      </table></td>
      <td valign="top">
	  
	  <div id='cond_doc' style="height:150px; border:#999999 solid 1px; vertical-align:top; overflow:auto">
	   <table id="lista_condi" width="270"  border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
			<tr>
			  <td width="22" height="10" bgcolor="#1FAF9D">&nbsp;</td>
			  <td width="184" bgcolor="#1FAF9D"><span class="Estilo20">Documentos</span></td>
			  <td width="31" bgcolor="#1FAF9D"><span class="Estilo20"></span></td>
		    </tr>
			
			<?php 
			
			foreach ($_SESSION['array_des'][0] as $subkey=> $subvalue) {
			
				if($_SESSION['array_des'][1][$subkey]!=''){
				
					/*if($_SESSION['array_des'][2][$subkey]=='S'){
					$marcar=" checked='checked' ";				
					}else{*/
					$marcar=" ";
					//}			
				
				
			?>
			<tr onClick="entrada(this)" bgcolor="#FFFFFF">
			  <td >
			   <input  name="radiobutton"  type="radio" value="<?php echo $_SESSION['array_des'][0][$subkey]?>" style="border:#FFFFFF solid 1px">			  </td>
			  <td class="EstiloL1"><?php echo $_SESSION['array_des'][1][$subkey] ?></td>
			  <td><?php /* ?><input <?php echo $marcar ?> type="checkbox" name="deuda[]" id="deuda" value="checkbox" style="border:#FFFFFF solid 1px"><?php */?></td>
		    </tr>
			<?php 
			  }
			}
			?>
		  </table>
	  
	  
	  </div></td>
    </tr>
    <tr>
      <td height="55">&nbsp;</td>
      <td colspan="3" align="center"><table width="300" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="97" align="center"><input type="button" name="Submit" value="Aplicar"  onClick="save_cond()" ></td>
          <td width="10" align="center">&nbsp;</td>
          <td width="96" align="center"><input type="button" name="Submit2" value="Cancelar" onClick="javascript:window.close()"></td>
          <td width="97" align="center">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>
<script>
var tipo="<?php echo $_REQUEST['tipo'];?>";
	function agregar(){
	var condicion=document.form1.lst_condi.value;
	
	
	 for (i=0;i<document.form1.lst_condi.options.length;i++)
        {
		
         if (document.form1.lst_condi.options[i].value==document.form1.lst_condi.value)
            {
			   var descondi=document.form1.lst_condi.options[i].text;
			   var aBorrar = document.forms["form1"]["lst_condi"].options[i];
               aBorrar.parentNode.removeChild(aBorrar);
			 //  alert(aBorrar.parentNode.innerHTML);
			   
            }
        }
	

	doAjax('peticion_ajax.php','peticion=doc&add&condicion='+condicion+'&tipo='+tipo+'&descondi='+descondi,'add_cond','get','0','1','','');
		
	}

	function add_cond(valor){
	document.getElementById('cond_doc').innerHTML=valor;
	//document.forms["form1"]["lst_condi"].value=document.forms["form1"]["lst_condi"].options[0].value;
	carga();
	}
	
	function quitar_item(valor){
		
			for (var i=0;i<document.form1.radiobutton.length;i++){ 
			   if (document.form1.radiobutton[i].checked) {
			   var descripcion=document.form1.radiobutton[i].parentNode.parentNode.childNodes[1].innerHTML;
			   var codigo=document.form1.radiobutton[i].value;
			   break; 
			   }
				
			} 
						
		var temp=document.form1.lst_condi.options.length ;
		
		var opt = document.form1.lst_condi.options; 
		opt[opt.length] = new Option(descripcion,codigo); 
		
		//var aBorrar=document.form1.radiobutton[i].parentNode.parentNode;
		//aBorrar.parentNode.removeChild(aBorrar);											
		doAjax('peticion_ajax.php','peticion=doc&add&delete&tipo='+tipo+'&condicion='+codigo,'add_cond','get','0','1','','');
		//alert(codigo);
	}
	
	
	function save_cond(){
		var deuda="";
		
			/*for (var i=0;i<document.form1.deuda.length;i++){ 
			   if(document.form1.deuda[i].checked){
			   	  deuda=deuda + "S-";
			   }else{
			   	  deuda=deuda + "N-";	
			   }
			 }*/ 
		
		//alert(deuda);
		doAjax('peticion_ajax.php','peticion=doc&save&cod_docu='+document.form1.cod_docu.value+'&deuda='+deuda+'&tipo='+tipo,'cerrar','get','0','1','','');
	
	}
	
	function cerrar(texto){
	//alert(texto);
	window.close();
	} 
		
</script>

