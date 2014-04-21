<?php 
session_start();
include('../conex_inicial.php');

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
.Estilo9 {font-weight: bold; color: #0066CC;}
.Estilo10 {color: #0066CC}
.Estilo11 {color: #FFFFFF}
.Estilo12 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #FFFFFF; }
.Estilo14 {color: #333333}
.Estilo15 {
	color: #003366;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style></head>

<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>

<script language="javascript" src="../modulos_usuarios/miAJAXlib3.js"></script>
		
 <link rel="stylesheet" type="text/css" href="../estilos.css" media="all" />
 <link href="../styles.css" rel="stylesheet" type="text/css">
 
<body>
<form name="form1" method="post" action="">
  <table width="768" border="0" cellpadding="0" cellspacing="0">
 <tr  style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="1033" height="27" colspan="11" style="border:#999999">
	  <span class="Estilo21 Estilo19 Estilo1 Estilo15"><strong> Administraci&oacute;n :: Documentos por Usuario
        <input name="auxiliar" type="hidden" id="auxiliar" value="<?php echo $tipo_aux; ?>">
      </strong></span>	  </td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td>
	  
	  <fieldset>
	  <table width="638" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"  height="5"></td>
  </tr>
  <tr>
    <td width="8">&nbsp;</td>
    <td width="615">
	
	
	  <span class="Estilo9">Producto:</span>
        <input autocomplete="off" name="valor" id="valor" type="text"  style="height:20; border-color:#CCCCCC" size="25" maxlength="100" onKeyUp="cargar_doc(event)">
		
			<?php 
			$temp_fecha=date('Y-m-d');
			$fecha=explode("-",$temp_fecha);
			$fecha1=$fecha[0]."-".$fecha[1]."-01";
			$fecha2=$temp_fecha;
			?>
		
        <span class="Estilo10"> Fecha:</span>
<input name="text" type="text"  id="fecha1" value="<?php echo $fecha1?>" size="10" maxlength="10"/>
<button type="reset" id="f_trigger_b1"  style="height:18" >...</button>
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha1",      
        ifFormat       :    "%Y-%m-%d",      
        showsTime      :    true,            
        button         :    "f_trigger_b1",   
        singleClick    :    true,           
        step           :    1                
    });
            </script>
<script>
			
						
			
			</script>
<span class="Estilo10">al</span>
<input name="text" type="text" size="10" maxlength="10" id="fecha2" value="<?php echo $fecha2?>" />
<button type="reset" id="f_trigger_b2"  style="height:18" >...</button>
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha2",      
        ifFormat       :    "%Y-%m-%d",      
        showsTime      :    true,            
        button         :    "f_trigger_b2",   
        singleClick    :    true,           
        step           :    1                
    });
              </script>
    
	</td>
    <td width="15">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" height="5"></td>
  </tr>
</table>

	    </fieldset>
	
	  
	  </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="44">&nbsp;</td>
      <td>
	  
	  <div id="doc_ing" style="width:800px; height:350px; overflow:scroll">
	  <table width="783" border="0" cellpadding="1" cellspacing="1">
        <tr style="background:url(../imagenes/bg_contentbase2.gif) ; background-position:100% 60%; ">
          <td width="21" height="21"><span class="Estilo11"></span></td>
          <td width="132"><span class="Estilo12">Fecha</span></td>
          <td width="26"><span class="Estilo12">Tipo</span></td>
          <td width="85"><span class="Estilo12">Nro. doc.</span></td>
          <td width="108"><span class="Estilo12">Proveedor</span></td>
          <td width="62"><span class="Estilo12">C&oacute;digo</span></td>
          <td width="211"><span class="Estilo12">Producto</span></td>
          <td width="45"><span class="Estilo12">Costo</span></td>
          <td width="65"><span class="Estilo12">Cantidad</span></td>
        </tr>
		
		<?php 
		
		$fecha1=$_REQUEST['fecha1'];
		$fecha1=$_REQUEST['fecha2'];
		$producto=$_REQUEST['producto'];
		
		$strSQl="select d.cod_prod,c.cod_ope,c.serie,numero,fechad,cliente,nom_prod,c.cod_cab from det_mov d , cab_mov c where nom_prod like '%".$producto."%' and  d.cod_cab=c.cod_cab and c.tipo='1' and substring(fecha,1,10) between '$fecha1' and '$fecha2' and  flag!='A' and c.cod_ope!='TS' ";
	 //	echo $strSQl;
		$resultado=mysql_query($strSQl,$cn);
		while($row=mysql_fetch_array($resultado)){
		
		?>
        <tr>
          <td bgcolor="#F8F8F8"><img style="cursor:pointer" alt="" onClick="doc_det('<?php echo $row['cod_cab']; ?>')" src="../imagenes/ico_lupa.png" width="15" height="15"></td>
          <td bgcolor="#F8F8F8"><span class="Estilo14"><?php echo $row['fechad']; ?></span></td>
          <td bgcolor="#F8F8F8"><span class="Estilo14"><?php echo $row['cod_ope']; ?></span></td>
          <td bgcolor="#F8F8F8"><span class="Estilo14"><?php echo $row['serie']."-".$row['numero']; ?></span></td>
          <td bgcolor="#F8F8F8"><span class="Estilo14"><?php echo $row['cliente']; ?></span></td>
		  
          <td bgcolor="#F8F8F8"><span class="Estilo14"><?php echo $row['cod_prod']; ?></span></td>
          <td bgcolor="#F8F8F8"><span class="Estilo14"><?php echo $row['nom_prod']; ?></span></td>
          <td bgcolor="#F8F8F8"><span class="Estilo14"><?php echo $row['costo_inven']; ?></span></td>
          <td bgcolor="#F8F8F8"><span class="Estilo14"><?php echo $row['cantidad']; ?></span></td>
        </tr>
		<?php 
		
		}
		
		?>
      </table>
	  </div>
	  
	  </td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>

<script>

function cargar_doc(e){
	//if(e.keyCode==13){
	var producto=document.form1.valor.value;
	var fecha1=document.form1.fecha1.value;
	var fecha2=document.form1.fecha2.value;
	
	doAjax('ajax_admin.php','&producto='+producto+'&fecha1='+fecha1+'&fecha2='+fecha2+'&peticion=docxprod','rspta_cargar_doc','get','0','1','','');
	
	//}
}

function rspta_cargar_doc(datos){
//alert(datos);
document.getElementById('doc_ing').innerHTML=datos;
}

function doc_det(valor){ 
window.open("doc_det.php?referencia="+valor,"","toolbar=no,status=yes, scrollbars=yes, resizable=yes, width=580, height=500,left=300 top=200");
}



</script>
