<?php
include("../conex_inicial.php");
//include('../funciones/funciones.php');
include('../administracion/miclase.php');
$clase=new miclase('');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.Estilo2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
}
.Estilo6 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #FFFFFF; }
.Estilo100 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 15px;
	color:#003366;
	font-weight:bold;
	
}
-->
</style>
</head>

<body>
<table width="818" border="1" cellspacing="0" cellpadding="0" align='center'>
  <tr>
    <td width="818" align="center"><table width="1018" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#F3F3F3">
	<form action="" name="form1" id="form1" method="">
  <tr style="background:url(../imagenes/white-top-bottom.gif)">
    <td height="27" colspan="3" align="center"><span class="Estilo100">Busqueda Sensitiva de Series </span></td>
  </tr>
  <tr>
    <td colspan="3" align="center">&nbsp;</td>
  </tr>
    <tr>
      <td width="126"><div align="right"><span class="Estilo2">Serie:</span></div></td>
      <td width="216"><input type="text" name="serie" value="<?php echo $_REQUEST['serie']?>" /></td>
      <td width="676"><input name="Aceptar" type="submit" id="Aceptar" style="background-image:url(../imagenes/button2.jpg); border:0px; width:72px; height:25px; color: #000000;" value="Procesar"/>
        <input name="pag" type="hidden" id="pag" /></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
      </tr>
    <tr>
    <td colspan="3" align="center"><table width="1014" border="0" cellspacing="1" cellpadding="1" style="border:solid 2px;">
  <tr bgcolor="#0066FF">
    <td width="44" bgcolor="#0066CC"><span class="Estilo6">D. sal </span></td>
	<td width="44" bgcolor="#0066CC"><span class="Estilo6">D. ing </span></td>
    <td width="339" bgcolor="#0066CC"><span class="Estilo6">Producto</span></td>
    <td width="110" bgcolor="#0066CC"><span class="Estilo6">Serie</span></td>
    <td width="173" bgcolor="#0066CC"><span class="Estilo6">Doc. Ingreso</span></td>
    <td width="169" bgcolor="#0066CC"><span class="Estilo6">Doc. Salida</span></td>
    <td width="156" bgcolor="#0066CC"><span class="Estilo6">Tienda</span></td>
  </tr>
  <?php
  $serie= strtoupper($_REQUEST['serie']);
  if($serie!=''){
   $sql="SELECT producto, serie, ingreso, salida, t.des_tienda,s.estado,p.nombre ,fing
FROM series s, producto p, tienda t
WHERE s.producto = p.idproducto
AND t.cod_tienda = s.tienda
AND upper(s.serie) like '%".$serie."%' order by s.serie,fing";
//echo $sql;
 $resultado=mysql_query($sql,$cn);
 $total_reg=mysql_num_rows($resultado);
 	if ($_GET['pag']=='') { 
		$y = 0; 
		} else { 
		$y=$_GET['pag']-1;
		}
 $x=$y*30;
// echo $sql." limit $x,30";
 $resultado=mysql_query($sql." limit $x,30",$cn);
 while($row=mysql_fetch_array($resultado)){
  ?>
  <tr bgcolor="#FFFFFF" style="color:#000000; font-size:11px; font-family:Arial, Helvetica, sans-serif;<?php
  if($row['ingreso']!='' &&  $row['salida']!='0' && $row['estado']=='V' ){ 
	 echo " background-color:#DDDDDD;";
	}elseif($row['ingreso']!='' &&  $row['salida']=='0' && $row['estado']=='F'){
	echo " background-color:#FFFFFF;";
	}elseif($row['ingreso']!='' &&  $row['salida']=='0' && $row['estado']=='V'){
	echo " background-color:#f7b5b5;";
	}

  ?>">
    <td align="center"><img src="../imagenes/ico_lupa.png" width="15" height="15" border="0"  style="cursor:pointer" onClick="doc_det(
	<?php
	if($row['ingreso']!='' &&  $row['salida']!='0' && $row['estado']=='V'){ 
	echo $row['salida'];
	$cod_cab="salida";
	//$color='gris';
	}elseif($row['ingreso']!='' &&  $row['salida']=='0' && $row['estado']=='F'){
	echo $row['ingreso'];
	$cod_cab="ingreso";
    //$color='blanco';
	}elseif($row['ingreso']!='' &&  $row['salida']=='0' && $row['estado']=='V'){
	echo $row['ingreso'];
	$cod_cab="ingreso";
	//$color='rojo';
	}
	 ?>,'<?php echo $cod_cab ?>')"/></td>
	     <td align="center"><img src="../imagenes/ico_lupa.png" width="15" height="15" border="0"  style="cursor:pointer" onClick="doc_det_ini('<?php echo $row['ingreso'] ?>')"/></td>
	
    <td><?php echo $row['nombre'] ?></td>
    <td bgcolor="#EEFC41"><?php echo $row['serie'] ?></td>
    <td><?php $sql2="select cod_ope,serie,num_doc,cod_cab,fecha from cab_mov where cod_cab='".$row['ingreso']."'";
	//echo $sql2;
	           $resultado2=mysql_query($sql2,$cn);
			   $row2=mysql_fetch_array($resultado2);
			   echo '<a href="javascript:void(0)" style="text-decoration:none" onclick="doc_det_ini('.$row['ingreso'].')">'.formatofecha(substr($row2['fecha'],0,10))."&nbsp;&nbsp;&nbsp;&nbsp;".$row2['cod_ope']." ".$row2['serie']."-".$row2['num_doc']."</a>"; ?></td>
			   
   <td><?php $sql3="select cod_ope,serie,num_doc,cod_cab,fecha from cab_mov where cod_cab='".$row['salida']."'";
	           $resultado3=mysql_query($sql3,$cn);
			   $row3=mysql_fetch_array($resultado3);
			   if(isset($row3['num_doc'])){
			   echo formatofecha(substr($row3['fecha'],0,10))."&nbsp;&nbsp;&nbsp;&nbsp;".$row3['cod_ope']." ".$row3['serie']."-".$row3['num_doc']; }?></td>
    <td><?php echo $row['des_tienda'] ?></td>
  </tr>

  <?php
  
  }
  ?>
  <?php
  }
 else{
  ?>
  <tr bgcolor="#CCCCCC">
  <td >&nbsp;</td>
    <td>&nbsp;</td>
	  <td>&nbsp;</td>  
	    <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  	  <td>&nbsp;</td>
  </tr>
  <?php
  }
  ?>
</table></td>
  </tr>
  </form>
</table>
<?php
$clase-> paginacion($total_reg,$_GET['pag'],'30');
?>
</td>
  </tr>
</table>

</body>
</html>
<script language="javascript">
function cargar_datos(pag){
document.form1.pag.value=pag;
document.form1.submit();
}
function doc_det(valor,valor2){

window.open("doc_dey_series.php?referencia="+valor+"&cod_cab="+valor2,"","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=530, height=350,left=300 top=250");

}
function doc_det_ini(valor){

window.open("doc_dey_series_ini.php?referencia="+valor+"&cod_cab=ingreso","","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=530, height=350,left=300 top=250");

}
</script>
