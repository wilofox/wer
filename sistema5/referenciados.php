<?php 
include('conex_inicial.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documentos de Referenciados</title>
<link href="styles.css" rel="stylesheet" type="text/css">

<script language="javascript" src="miAJAXlib2.js"></script>

    <script src="jquery-1.2.6.js"></script>
    <script src="jquery.hotkeys.js"></script>
	<script src="mootools-comprimido-1.11.js"></script>

<style type="text/css">
<!--
body {
	background-color:#F3F3F3;   
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo11 {font-family: Verdana, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FFFFFF; }
-->
.Estilo_det {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color:#000000; }
.Estilo19 {
	color: #0066FF;
	font-weight: bold;
}
</style></head>

<body >
<form name="form1" method="post" action="">
  <table width="500" height="267" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="12" height="36">&nbsp;</td>
      <td width="472"><table width="474" height="21" border="0" cellpadding="0" cellspacing="0" style="border:#999999 solid 1px">
          <tr>
            <td width="472" height="19" align="center"><span class="Estilo19">Lista de Documentos </span></td>
          </tr>
      </table></td>
      <td width="16">&nbsp;</td>
    </tr>
    <tr>
      <td height="190">&nbsp;</td>
      <td valign="top" style="border:#999999 solid 1px">
	  
	  <div id='det_doc' style="height:185; overflow:auto">
	  
	  <table width="474" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td width="41" height="18" bgcolor="#008A8A"><span class="Estilo11">Alm</span></td>
            <td width="39" bgcolor="#008A8A"><span class="Estilo11">TD</span></td>
            <td width="105" bgcolor="#008A8A"><span class="Estilo11">Numero</span></td>
            <td width="66" bgcolor="#008A8A"><span class="Estilo11">Fecha.</span></td>
            <td width="164" bgcolor="#008A8A"><span class="Estilo11">Condici&oacute;n</span></td>
            <td width="40" bgcolor="#008A8A">&nbsp;</td>
          </tr>
		  
		 <?php 
		 $tipomov=$_REQUEST['tipomov'];
		 $sucursal=$_REQUEST['sucursal'];
		 $doc=$_REQUEST['doc'];
		 $serie=$_REQUEST['serie'];
		 $numero=$_REQUEST['numero'];
 		 $auxiliar=$_REQUEST['auxiliar'];
		 
		 if($tipomov=='1'){
		 $filtro=" and cliente='$auxiliar' ";
		 }else{
		 $filtro="";
		 }
		 
		 $strSQL="select * from cab_mov where tipo='$tipomov' and sucursal='$sucursal' and cod_ope='$doc' and serie='$serie' and Num_doc='$numero' ".$filtro." ";		 		
		 $resultado=mysql_query($strSQL,$cn);
		 $row=mysql_fetch_array($resultado);
		 $codigo=$row['cod_cab'];
		 $flag_r=$row['flag_r'];
		 
		// echo $codigo; 		 
		  
		 $strSQl="select * from referencia where cod_cab_ref='$codigo'"; 
		 $resultado=mysql_query($strSQl,$cn);	
		// echo $strSQl;	 		 		 
		 while($row=mysql_fetch_array($resultado)){

		 $cod_cab=$row['cod_cab'];
		 
		 $strSQl2="select * from cab_mov where cod_cab='$cod_cab'"; 
		 $resultado2=mysql_query($strSQl2,$cn);		 		 		 
		 $row2=mysql_fetch_array($resultado2);
		
		 ?> 
          <tr>
            <td bgcolor="#FFFFFF"><?php echo $row2['tienda'] ?></td>
            <td bgcolor="#FFFFFF"><?php echo $row2['cod_ope'] ?></td>
            <td bgcolor="#FFFFFF"><a href="#" onClick="doc_det('<?php echo $row2['cod_cab'];?>')"><?php echo $row2['serie']."-".$row2['Num_doc'] ?></a></td>
            <td bgcolor="#FFFFFF"><?php echo substr($row2['fecha'],0,10) ?></td>
            <td bgcolor="#FFFFFF"><?php echo $row2['condicion'] ?></td>
			<td bgcolor="#FFFFFF"><?php  ?></td>
          </tr>
		 <?php 
		 }
		 ?> 
      </table>
	  
	  </div>
	  </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="button" name="Submit" value="Aceptar" onClick="javascrip:window.close()">
          <input type="button" name="Submit2" value="Cancelar" onClick=""></td>
		  
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<script>


function doc_det(valor){

window.open("doc_det.php?referencia="+valor,"","toolbar=no,status=no, menubar=no, scrollbars=yes, width=520, height=320,left=300 top=250");

}


</script>