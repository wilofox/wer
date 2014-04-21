<?php session_start();
   include('conex_inicial.php');

	
	if(isset($_REQUEST['Submit'])){

		if($_REQUEST['Submit']=='Ingresar'){
			
		$fecha=$_REQUEST['fecha'];
		$fecha2=$_REQUEST['fecha2'];
		
		$strSQL="insert into factores(fecha,fecha2,factor) values('".$fecha."','".$fecha2."','".$_REQUEST['factor']."')";
		mysql_query($strSQL);
		}
		if($_REQUEST['Submit']=='Actualizar'){
			
		$fecha=$_REQUEST['fecha'];
		$fecha2=$_REQUEST['fecha2'];
		
		$strSQL="update factores set fecha='".$fecha."',fecha2='".$fecha2."',factor='".$_REQUEST['factor']."' where id='".$_REQUEST['id']."'";
		
		mysql_query($strSQL);
		}
		
		header("location: mant_factor.php");
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
-->
</style>
</head>
<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>

<body>
<form name="form1" method="get" action="" id="form1">
  <table width="686" height="132" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="19" colspan="7">&nbsp;</td>
    </tr>
    <tr>
      <td width="84"><span class="Estilo15">Nuevo factor :</span></td>
      <td width="121"><input name="factor" type="text" size="10"></td>
      <td width="32"><span class="Estilo15">Del</span></td>
      <td width="133"><input readonly="" name="fecha" type="text" size="10">
	  <button type="reset" id="f_trigger_b1" style="height:20px" >...</button>
                        <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha",      
        ifFormat       :    "%Y-%m-%d",      
        showsTime      :    true,            
        button         :    "f_trigger_b1",   
        singleClick    :    true,           
        step           :    1                
    });
                        </script>	  </td>
      <td width="24"><span class="Estilo15">Al</span></td>
      <td width="156"><input readonly="" name="fecha2" type="text" size="10">
	    <button type="reset" id="f_trigger_b2" style="height:20px" >...</button>
                        <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha2",      
        ifFormat       :    "%Y-%m-%d",      
        showsTime      :    true,            
        button         :    "f_trigger_b2",   
        singleClick    :    true,           
        step           :    1                
    });
                        </script>	  </td>
      <td width="136"><input type="submit" name="Submit" id="Submit" value="Ingresar">
      <input type="hidden" name="id"></td>
    </tr>
    <tr>
      <td height="61" colspan="7"><table width="486" height="65" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="23" colspan="6" align="center"><span class="Estilo14">Factores</span></td>
          </tr>
          <tr>
            <td width="59" height="22" align="center" bgcolor="#51A8FF"><span class="Estilo13">Id</span></td>
            <td width="115" align="center" bgcolor="#51A8FF"><span class="Estilo13">Del</span></td>
            <td width="106" align="center" bgcolor="#51A8FF"><span class="Estilo13">Al</span></td>
            <td width="97" align="center" bgcolor="#51A8FF"><span class="Estilo13">Factor</span></td>
            <td colspan="2" align="center" bgcolor="#51A8FF"><span class="Estilo13">Acciones</span></td>
          </tr>
          <?php
	    
		$strSQL="select * from factores ";
		$resultado=mysql_query($strSQL,$cn);
		while($row=mysql_fetch_array($resultado)){
		
		?>
          <tr>
            <td align="center" bgcolor="#F5F5F5"><span class="Estilo22"><?php echo $row['id'];?></span></td>
            <td align="center" bgcolor="#F5F5F5"><span class="Estilo22"><?php echo $row['fecha'];?></span></td>
            <td align="center" bgcolor="#F5F5F5"><span class="Estilo22"><?php echo $row['fecha2'];?></span></td>
            <td align="center" bgcolor="#F5F5F5"><span class="Estilo22"><?php echo $row['factor'];?></span></td>
            <td width="48" align="center" bgcolor="#F5F5F5"><span class="Estilo22"><a href="#" onClick="accion('<?php echo $row['id']?>','<?php echo $row['fecha']?>','<?php echo $row['fecha2']?>','<?php echo $row['factor']?>','e')">Editar</a> </span></td>
            <td width="61" align="center" bgcolor="#F5F5F5"><span class="Estilo22"><a style="display:none" href="#" onClick="">Eliminar</a></span></td>
          </tr>
          <?php 
	  
	  }
	  ?>
      </table></td>
    </tr>
  </table>
</form>
</body>

</html>

<script>

function accion(id,fecha,fecha2,factor,ac){

	if(ac=='e'){
		
	//document.form1.submit();
	
	document.form1.id.value=id;
	document.form1.fecha.value=fecha;
	document.form1.fecha2.value=fecha2;
	document.form1.factor.value=factor;
	document.form1.Submit.value='Actualizar';
	
	}

}

</script>
