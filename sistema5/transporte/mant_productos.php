<?php session_start();
   include('conex_inicial.php');
	
	if(isset($_REQUEST['Submit'])){

		$cod_prod=$_REQUEST['cod_prod'];
		$nombre_prod=$_REQUEST['nombre_prod'];
		$puntos=$_REQUEST['puntos'];
		$efectivo=$_REQUEST['efectivo'];
		$fecha=date("Y-m-d h:i:s");

		if($_REQUEST['Submit']=='Insertar'){
		$strSQL="insert into productos(cod_prod,codigo,anexo,nombre,punto,efectivo,fec_alta,estado) values('".$cod_prod."','".$cod_prod."','".$cod_prod."','".$nombre_prod."','".$puntos."','".$efectivo."','".$fecha."','A')";
		//echo $strSQL;
		mysql_query($strSQL);
		}
		
		if($_REQUEST['Submit']=='Actualizar'){	
		$strSQL="update productos set nombre='".$nombre_prod."',punto='".$puntos."',efectivo='".$efectivo."' where codigo='".$cod_prod."'";		
		mysql_query($strSQL);
		}
		
		if($_REQUEST['Submit']=='baja'){	
		$strSQL="update productos set estado='B',fec_baja='".date("Y-m-d h:i:s")."' where codigo='".$cod_prod."'";		
		mysql_query($strSQL);
		}
		if($_REQUEST['Submit']=='alta'){	
		$strSQL="update productos set estado='A' where codigo='".$cod_prod."'";		
		mysql_query($strSQL);
		}
		
		header("location: mant_productos.php");
		
				
	}else{	
		list($cod_prod)=mysql_fetch_row(mysql_query("select max(cod_prod) as nombre from productos"));
		$cod_prod+=1;
	}
	
?>
	
	
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo13 {color: #FFFFFF; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo14 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
}
.Estilo15 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 11px;
}
.Estilo22 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo24 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 11px; color: #0066CC; }
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo29 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 11px; color: #333333; }
.Estilo30 {color: #FF0000}
.Estilo32 {color: #333333}
.Estilo33 {color: #0066CC}
-->
</style>
</head>
<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>

<body>
<form name="form1" method="get" action="" id="form1" onSubmit=" return validar(this)">
  <table width="770" height="218" border="0" cellpadding="0" cellspacing="0">
    
    <tr>
      <td height="29" colspan="7" style="background:url(../imagenes/white-top-bottom.gif); border:#999999"><span class="Estilo29"><span class="Estilo32">Ventas  <span class="Estilo30">:: </span>Acumulaci&oacute;n de Puntos</span> <span class="Estilo30">::</span> <span class="Estilo33">Mantenimiento de Productos</span></span> </td>
    </tr>
    <tr>
      <td height="19" colspan="7" >&nbsp;</td>
    </tr>
    <tr>
      <td height="89" colspan="7"><fieldset>
        <legend><span class="Estilo24">Nuevo Producto</span></legend>
        <table width="672" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><span class="Estilo15">C&oacute;digo  </span></td>
            <td><input name="cod_prod" type="text" size="8" readonly="" value="<?php echo $cod_prod ?>" style="text-align:center"></td>
            <td><span class="Estilo15">Descripci&oacute;n</span></td>
            <td><input name="nombre_prod" type="text" size="30"></td>
            <td><span class="Estilo15">Fecha</span>
              <input readonly="" name="fecha" type="text" size="10" value="<?php echo date('d-m-Y')?>"></td>
            <td><input type="submit" name="Submit" id="Submit" value="Insertar">
              <input type="hidden" name="id"></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><span class="Estilo15">Punto   
              
                
            </span></td>
            <td><span class="Estilo15">
              <input name="puntos" type="text" size="8" style="text-align:right" onKeyDown="validarNumero(this,event)">
            </span></td>
            <td><span class="Estilo15">Efectivo</span></td>
            <td><span class="Estilo15">
              <input name="efectivo" type="text" size="8" style="text-align:right" onKeyDown="validarNumero(this,event)">
            </span></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </fieldset> </td>
    </tr>
    
    <tr>
      <td height="61" colspan="7"><fieldset><legend class="Estilo24">Listado Productos</legend>
      <table width="753" height="64" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="23" colspan="6" align="center">&nbsp;</td>
          </tr>
          <tr>
            <td width="93" height="22" align="center" bgcolor="#51A8FF"><span class="Estilo13">C&oacute;digo </span></td>
            <td width="404" align="center" bgcolor="#51A8FF"><span class="Estilo13">Descripci&oacute;n</span></td>
            <td width="76" align="center" bgcolor="#51A8FF"><span class="Estilo13">Puntos</span></td>
            <td width="71" align="center" bgcolor="#51A8FF"><span class="Estilo13">Efectivo</span></td>
            <td colspan="2" align="center" bgcolor="#51A8FF"><span class="Estilo13">Acciones</span></td>
          </tr>
          <?php
	    
		$strSQL="select * from productos order by cod_prod";
		$resultado=mysql_query($strSQL,$cn);
		while($row=mysql_fetch_array($resultado)){
		 
		 if($row['estado']=='B'){
		 $colorRow='#FFAEAE';
		 }else{
		 $colorRow='#F5F5F5';
		 }
		 
		?>
          <tr bgcolor="<?php echo $colorRow ?>">
            <td align="center" ><span class="Estilo22"><?php echo $row['codigo'];?></span></td>
            <td align="left" ><span class="Estilo22"><?php echo $row['nombre'];?></span></td>
            <td align="center" ><span class="Estilo22"><?php echo $row['punto'];?></span></td>
            <td align="center" ><span class="Estilo22"><?php echo $row['efectivo'];?></span></td>
            <td width="58" align="center" ><span class="Estilo22">
			<?php if($row['estado']=='A'){?>
			<a href="#" title="Editar" onClick="accion('<?php echo $row['codigo']?>','<?php echo $row['nombre']?>','<?php echo $row['punto']?>','<?php echo $row['efectivo']?>','e')"><img src="../imgenes/ico_edit.gif" width="16" height="16" border="0"></a> 
			<?php }?>
			
			</span></td>
            <td width="68" align="center" ><span class="Estilo22">
			<?php if($row['estado']=='A'){?>
			<a href="#" title="Dar de Baja" onClick="accion('<?php echo $row['codigo']?>','<?php echo $row['nombre']?>','<?php echo $row['punto']?>','<?php echo $row['efectivo']?>','b')"><img src="../imgenes/debaja.png" width="16" height="16" border="0"></a>
			<?php }else{ ?>
						
			<a href="#" title="Dar de Alta" onClick="accion('<?php echo $row['codigo']?>','<?php echo $row['nombre']?>','<?php echo $row['punto']?>','<?php echo $row['efectivo']?>','a')"><img src="../imgenes/debaja.png" width="16" height="16" border="0"></a>
			
			<?php }?>
			</span></td>
          </tr>
          <?php 
	  
	  }
	  ?>
        </table></fieldset>      </td>
    </tr>
  </table>
</form>
</body>

</html>

<script>

function accion(cod_prod,nombre_prod,puntos,efectivo,ac){

	if(ac=='e'){
	document.form1.cod_prod.value=cod_prod;
	document.form1.nombre_prod.value=nombre_prod;
	document.form1.puntos.value=puntos;
	document.form1.efectivo.value=efectivo;
	document.form1.Submit.value='Actualizar';
	
	}
	
	if(ac=='b'){
	location.href="mant_productos.php?cod_prod="+cod_prod+'&Submit=baja';
	}
	if(ac=='a'){
	location.href="mant_productos.php?cod_prod="+cod_prod+'&Submit=alta';
	}
	
}

function validar(form){

	if(form.nombre_prod.value=='' || form.puntos.value==''){
	alert("Los campos descripción y puntos son obligatorios");
	return false;
	}
	return true;

}

function validarNumero(control,e){
//alert(e.keyCode);
	try{
		if((e.keyCode>=96 && e.keyCode<=105) || (e.keyCode>46 && e.keyCode<58) || e.keyCode==8 || e.keyCode==190 || e.keyCode==37 || e.keyCode==39 || e.keyCode==110){
			temp=control.value.split(".");
			if(e.keyCode==190 || e.keyCode==110){
				if(temp[1]!=undefined){	
					e.keyCode=0;
					event.returnValue=false;
					return false;
				}
			}
		}else{
			if(e.keyCode==13){
				
				
			}else{
				e.keyCode=0;
				event.returnValue=false;
				return false;
			}
		}
	}catch(e){
	
	}	

}


</script>
