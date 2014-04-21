<?php 
session_start();
include('conex_inicial.php');

// if(isset($_REQUEST['ptoventa'])){
  $background1="url(imagenes/bg_contentbase2.gif)";
  $background2="url(imagenes/boton_aplicar.gif)";
  //}else{
  //$background1="url(../imagenes/bg_contentbase2.gif)";
  //$background2="url(../imagenes/boton_aplicar.gif)";
  //}
$persona="";
$razon="";
$ruc="";
$dni="";
$direccion="";
$contacto="";
  if($_REQUEST['tip']=="e"){
  	$strSQL01="select * from cliente where codcliente='".trim($_REQUEST['cod'])."'";
  	$resultado01=mysql_query($strSQL01,$cn);
  	$row01=mysql_fetch_array($resultado01);
	$codigo=$row01['codcliente'];
	$persona=$row01['t_persona'];
	$razon=$row01['razonsocial'];
	$ruc=$row01['ruc'];
	$dni=$row01['doc_iden'];
	$direccion=$row01['direccion'];
	$contacto=$row01['contacto'];
 }else{
  	$strSQL01="select max(codcliente) as codigo from cliente ";
  	$resultado01=mysql_query($strSQL01,$cn);
  	$row01=mysql_fetch_array($resultado01);
  	$codigo=str_pad($row01['codigo']+1,"6","0",STR_PAD_LEFT);
	
	//echo "-->".$_REQUEST['ope'];
	if($_REQUEST['ope']=='F0'){
	$persona="juridica";
	}else{
	$persona="natural";
	}
	
  }
  $nat="";$jur="";
  if($persona=="natural"){
	$nat=" selected";
  }else{
	if($persona=="juridica"){
		$jur=" selected";
	}else{
		$nat=" selected";
	}
  }
  
  
  
//  echo $persona;
  
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
body {
	background-image: url(imagenes/bg3.jpg);
}
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo28 {color: #000000}
.Estilo30 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #0066FF;
}
.Etiqueta01{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	}

-->
</style>
</head>

<body>
<table width="10" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><form name="form_clientes" method="post" action="">
      <table style="border:#E6E6E6 solid 1px" width="477" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#F9F9F9" >
        
        <tr>
          <td width="78771" height="5" colspan="11"></td>
        </tr>
        
        <tr bordercolor="#CCCCCC" >
          <td colspan="11" align="left">
            <table width="466" height="124" border="0">
              <tr>
                <td height="28" colspan="4"><span  style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold; color:#0066FF">Formulario de nuevo registro </span></td>
                </tr>
              <tr>
                <td width="113" height="27" class="Etiqueta01">Codigo:</td>
                <td width="115"><input readonly name="codigo_aux" type="text" size="8" maxlength="6" value="<?php echo $codigo ?>"></td>
                <td width="52" class="Etiqueta01">Persona:</td>
                <td width="158"><select name="persona_aux">
				  <option value="natural"<?php echo $nat;?>>Natural</option>
                  <option value="juridica"<?php echo $jur;?>>Jur&iacute;dica / Natural con RUC</option>
                </select>                </td>
              </tr>
              <tr>
                <td class="Etiqueta01">Cli./Razon Social: </td>
                <td colspan="3"><input name="razonsocial_aux" type="text" size="30" value="<?php echo $razon;?>" maxlength="100"></td>
                </tr>
              <tr>
                <td class="Etiqueta01">Ruc:</td>
                <td><input onKeyUp="keyValidarRuc(event)" name="ruc_aux" type="text" size="11" maxlength="11" value="<?php echo $ruc;?>"><?php if($_SESSION['verificadorruc']=="S"){?><input type="button" value="..." style="height:15px;width:15px;" onClick="VerificadorRuc()" title="Buscador Ruc"><?php }?></td>
                <td class="Etiqueta01">Dni:</td>
                <td><input name="dni_aux" type="text" size="10" maxlength="8" value="<?php echo $dni;?>"></td>
              </tr>
              <tr>
                <td class="Etiqueta01">Direcci&oacute;n</td>
                <td colspan="3"><input name="direccion_aux" type="text" size="30" maxlength="100" value="<?php echo $direccion;?>"></td>
                </tr>
              <tr>
                <td class="Etiqueta01">Contacto</td>
                <td colspan="3"><input name="contacto_aux" type="text" size="30" maxlength="100" value="<?php echo $contacto;?>"></td>
                </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="2">&nbsp;</td>
              </tr>
            </table>         </td>
        </tr>
        <tr>
          <td height="8" colspan="11" align="center"></td>
        </tr>
        <tr>
		
          <td height="26" colspan="11" align="center">
		  
		  <?php if(isset($_REQUEST['ptovta34'])){  ?>
		  
		  <input <?php echo $disable ?>  onclick="guardar_aux('<?php echo $_REQUEST['tip'] ?>')" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:<?php echo $background2;?> ; cursor:pointer; color:#126B96; font:bold; font-size:10px" type="button" name="Submit" value="Guardar" />
		  
		  <?php }else{?>
		  	
			<input <?php echo $disable ?>  onclick="guardar_aux()" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:<?php echo $background2;?> ; cursor:pointer; color:#126B96; font:bold; font-size:10px" type="button" name="Submit" value="Guardar" />
		  <?php }?>
            &nbsp;
            &nbsp;
            &nbsp;
            &nbsp;
			
			<?php if(!isset($_REQUEST['gen_multifac'])){ ?>	  
                
			<input onClick="Modalbox.hide(); return false;" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:<?php echo $background2?> ; cursor:pointer;color:#126B96; font:bold; font-size:10px" type="button" name="Submit" value="Cancelar" />
				
			<?php }else{ ?>	
			
			<input onClick="btn_cancelar();" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:<?php echo $background2?>; cursor:pointer;color:#126B96; font:bold; font-size:10px" type="button" name="Submit" value="Cancelar" />
							
			<?php } ?>
				</td>
        </tr>
        <tr>
          <td height="26" colspan="11" align="center">&nbsp;</td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
</body>
</html>
