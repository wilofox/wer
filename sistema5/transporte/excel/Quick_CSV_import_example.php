<?php
session_start();
include "Quick_CSV_import.php";
include('../conex_inicial.php');
include('../../funciones/funciones.php');
//mysql_connect("localhost", "root", "1");
//mysql_select_db("test"); 

$csv = new Quick_CSV_import();

$arr_encodings = $csv->get_encodings(); //take possible encodings list
$arr_encodings["default"] = "[default database encoding]"; //set a default (when the default database encoding should be used)

if(!isset($_POST["encoding"]))
  $_POST["encoding"] = "default"; //set default encoding for the first page show (no POST vars)

if(isset($_POST["Go"]) && ""!=$_POST["Go"]) //form was submitted
{
  $csv->file_name = $HTTP_POST_FILES['file_source']['tmp_name'];
  
  //optional parameters
  $csv->use_csv_header = isset($_POST["use_csv_header"]);
  $csv->field_separate_char = $_POST["field_separate_char"][0];
  $csv->field_enclose_char = $_POST["field_enclose_char"][0];
  $csv->field_escape_char = $_POST["field_escape_char"][0];
  $csv->encoding = $_POST["encoding"];
  
  //start import now
  $csv->import();
}
else
	$_POST["use_csv_header"] = 1;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Importaci&oacute;n Excel CSV</title>
  <style>
  .edt
  {
    background:#ffffff; 
    border:2px double #aaaaaa; 
    -moz-border-left-colors:  #aaaaaa #ffffff #aaaaaa; 
    -moz-border-right-colors: #aaaaaa #ffffff #aaaaaa; 
    -moz-border-top-colors:   #aaaaaa #ffffff #aaaaaa; 
    -moz-border-bottom-colors:#aaaaaa #ffffff #aaaaaa; 
    width: 250px;
  }
  .edt_30
  {
    background:#ffffff; 
    border:2px double #aaaaaa; 
    font-family: Courier;
    -moz-border-left-colors:  #aaaaaa #ffffff #aaaaaa; 
    -moz-border-right-colors: #aaaaaa #ffffff #aaaaaa; 
    -moz-border-top-colors:   #aaaaaa #ffffff #aaaaaa; 
    -moz-border-bottom-colors:#aaaaaa #ffffff #aaaaaa; 
    width: 30px;
  }
  </style>
<link href="../../styles.css" rel="stylesheet" type="text/css">  
<SCRIPT src="../../javascript/popup.js" type=text/javascript></SCRIPT>
</head>
<body bgcolor="#f2f2f2">
  <h2 align="center" style="color:#000000; padding-top:10px;">Importar Formato Excel (*.CSV) </h2>
  <form method="post" enctype="multipart/form-data">
    <table border="0" align="center">
      <tr>
      	<td>Archivo a Importar(CSV):</td>
      	<td rowspan="30" width="10px">&nbsp;</td>
      	<td>
		<input type="file" name="file_source" id="file_source" class="edt" value="<?=$_REQUEST['excel'];?><?=$file_source?>">		</td>
      </tr>
     <!-- <tr>
      	<td>Utilice CSV cabecera:</td>
      	<td><input type="checkbox" name="use_csv_header" id="use_csv_header" /></td>
    	<? //=(isset($_POST["use_csv_header"])?"checked":"")?>
      </tr>-->
      <tr>
      	<td>Separador de Caracteres:</td>
      	<td><input readonly=""  type="text" name="field_separate_char" id="field_separate_char" class="edt_30"  maxlength="1" value="<?=(""!=$_POST["field_separate_char"] ? htmlspecialchars($_POST["field_separate_char"]) : ",")?>"/></td>
      </tr>
      <tr>
      	<td>Incluya caracteres:</td>
      	<td><input readonly="" type="text" name="field_enclose_char" id="field_enclose_char" class="edt_30"  maxlength="1" value="<?=(""!=$_POST["field_enclose_char"] ? htmlspecialchars($_POST["field_enclose_char"]) : htmlspecialchars("\""))?>"/></td>
      </tr>
      <tr>
      	<td>Escape de caracteres:</td>
      	<td><input readonly="" type="text" name="field_escape_char" id="field_escape_char" class="edt_30"  maxlength="1" value="<?=(""!=$_POST["field_escape_char"] ? htmlspecialchars($_POST["field_escape_char"]) : "\\")?>"/></td>
      </tr>
      <tr>
      	<td>Codificaci&oacute;n:</td>
      	<td>
          <select  disabled name="encoding" id="encoding" class="edt">
          <?
            if(!empty($arr_encodings))
              foreach($arr_encodings as $charset=>$description):
          ?>
            <option value="<?=$charset?>"<?=($charset == $_POST["encoding"] ? "selected=\"selected\"" : "")?>><?=$description?></option>
          <? endforeach;?>
          </select>        </td>
      </tr>
      <tr>
      	<td colspan="3">&nbsp;</td>
      </tr>
      <tr>
      	<td colspan="3" align="center"><input type="Submit" name="Go" value="Importar CSV" onClick=" var s = document.getElementById('file_source'); if(null != s && '' == s.value) {alert('Definir el nombre del archivo'); s.focus(); return false;};Popup.showModal('modal');">
		&nbsp;&nbsp;&nbsp;
   	    <input type="button" name="Go2" value="   Cerrar  " onClick="window.close();"></td>
      </tr>
    </table>
  </form>
 <div style="padding-left:25px;"> 
<span  style="color:#FF0000; padding-left:100px;">
<? //=(!empty($csv->error) ? "<hr/>Error: ".$csv->error : "")?>
<?=$csv->msg;?>
<? $error="El Formato del documento *.CSV es incorrecto"; ?>
<?=(!empty($csv->error) ? "<hr/>Error: ".$error : " ");?>
</span>
<span  style="color:#009900; padding-left:100px; padding-right:50px;">
<?
/*echo  $csv->error;
echo  $file_source;
echo  $csv->msg;
*/

	$strSQLDato=" select * from mashist_temp ";		
	$resulstrSQLDato=mysql_query($strSQLDato,$cn);
	$totalImp =mysql_num_rows($resulstrSQLDato); 
	$fecImp=cambiarfecha($fecha);

if ($csv->error=='' && $totalImp>0 && $csv->msg=='' ){ //&& $file_source<>''
	echo '<hr/>';
	echo "IMPORTACI&Oacute;N DE *.CSV EXITOSA......<br>";
	//echo "Archivo temp importado: ".$csv->file_name;
	echo "Archivo importado Excel(*.CSV): ".formatofecha(substr($_SESSION['docExcel'],0,10));
	echo "<br>";
	
	
	echo "Cantidad de datos Importados: ".$totalImp."<br>";	
	echo "Fecha y hora de importaci&oacute;n: ".$fecImp;
		
	$Campos='fec_hor_des,fec_turno,ruc,cod_ope,Num_serdoc,placa,
	surtidor,cara,lectura_ini,lectura_fin,prec_m3,cant_m3,condicion,
	descuento,incremento,recaudo,total';
	
	//insertar de tabla temp a origem
	$strSQL_ref2=" INSERT INTO master_historial ($Campos)
SELECT $Campos FROM mashist_temp "; 
	mysql_query($strSQL_ref2);
	//recalcula puntos
		
	$strSQL=" SELECT MH.placa,sum( total ) AS tot_punto ,fec_hor_des 
FROM mashist_temp MH
INNER JOIN transp_cliente TC ON MH.placa = TC.placa
WHERE estado = 'S'
GROUP BY MH.placa ";

	$resultadoX=mysql_query($strSQL,$cn);
	while($rowX=mysql_fetch_array($resultadoX)){
	
	
	list($factor)=mysql_fetch_row(mysql_query("select factor from factores where '".substr($rowX['fec_hor_des'],0,10)."'  between fecha and fecha2 limit 1"));

	if($factor=='' || $factor==0){
	$factor=1;
	}
	
		//$rowX['tot_punto'];
		
		$strSQL_ref2=" update transp_cliente set 
		total_punto=total_punto+".$rowX['tot_punto']/$factor."  where  placa='".$rowX['placa']."' ";
		mysql_query($strSQL_ref2);
	}	
	//Limpiar tabla temporal
	$strSQL_ref2="TRUNCATE TABLE mashist_temp ";
	mysql_query($strSQL_ref2);	
	
	$strSQL_ref2="insert into historial values 
	('','".formatofecha(substr($_SESSION['docExcel'],0,10))."','".$fecImp."','".$totalImp."','".$_SESSION['codvendedor']."','".$_SESSION['pc_ingreso']."') ";
	mysql_query($strSQL_ref2);
		
}
?>
</span>
</div>

<DIV id=modal style="BORDER-RIGHT: white 3px solid;  BORDER-TOP: white 3px solid; DISPLAY: none;   BORDER-LEFT: white 3px solid;  BORDER-BOTTOM: white 3px solid; BACKGROUND-COLOR:#003366; "> 
    
	  <table width="270" height="150" border="0">
  <tr>
    <td align="center" style="font:Arial, Helvetica, sans-serif; font:bold; font-size:12; color:#FFFFFF">Espere un momento por favor</td>
  </tr>
  <tr>
		<td align="center" valign="bottom" style="font:Arial, Helvetica, sans-serif; font:bold; font-size:10; color:#FFFFFF">IMPORTANDO PUNTOS...</td>
  </tr>
  <tr>
    <td align="center"> <img height="45" width="45" src="../../imgenes/cargando.gif">	 </td>
	 <tr>
    <td align="center"> 	
	 <INPUT name="button" type=button onClick="Popup.hide('modal')" value=OK style=" visibility:hidden">	 </td>
  </tr>
</table>
</DIV>

</body>
</html>