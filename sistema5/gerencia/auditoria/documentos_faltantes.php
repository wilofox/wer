<?php 
	include('../../conex_inicial.php'); 
	include('../../contabilidad/model/Mysql.php'); 
	include('../../contabilidad/model/Sucursal.php'); 
	include('../../contabilidad/model/Operacion.php');
	include('../../funciones/funciones.php');

	$objSucursal = new Sucursal;
	$arySucursales = $objSucursal->getRegistros();

	$objOperacion = new Operacion;
	$aryOperaciones = $objOperacion->getRegistrosXtipo(2);
	

	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Documentos faltantes</title>
		<link href="../../styles.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="../../contabilidad/css/estilos.css">
		<link rel="stylesheet" type="text/css" href="../../contabilidad/css/ui-lightness/jquery-ui-1.8.18.custom.css">
		<script type="text/javascript" src="../../contabilidad/js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="../../contabilidad/js/jquery-ui-1.8.18.custom.min.js"></script>
		<script type="text/javascript" src="../../contabilidad/js/jquery.maskedinput-1.2.2.js"></script>        
		<script type="text/javascript" src="../../contabilidad/js/js.js"></script>
	    <style type="text/css">
<!--
.Estilo10 {
	color: #003366;
	font-size: 12px;
}
.Estilo11 {color: #0066FF}
-->
        </style>
</head>
	<body>
	<form action="#" name="form1" id="form1" method="post">
	<table width="770" border="0" cellpadding="0" cellspacing="0">
 <tr  style="background:url(../../imagenes/white-top-bottom.gif)">
      <td width="834" height="27" colspan="11" style="border:#999999">
	  <span class="Estilo21 Estilo19 Estilo1 Estilo15"><strong> <span class="Estilo10">Gerencia :: Auditoria :: Documentos Faltantes</span><span class="text4">
        <input style="visibility:hidden" name="auxiliar" type="text" id="auxiliar" value="<?php echo $tipo_aux; ?>">
      </span></strong></span>	  <span class="item">
      <input style="visibility:hidden" type="text" id="serie_inicio" name="serie_inicio" value="0000001" onblur="ceros2(this)" />
      <input style="visibility:hidden" type="text" id="serie_termino" name="serie_termino" value="0000002" onblur="ceros2(this)" />
      <input style="visibility:hidden" id="radio" name="rdoOpcion" class="rdoOpcion" type="radio" value="numeros" checked="checked" />
      <input style="visibility:hidden" id="rdoOpcion" name="rdoOpcion" class="rdoOpcion" type="radio" value="fechas" />
      </span></td>
    </tr>
 <tr >
   <td height="13" colspan="11" style="border:#999999">&nbsp;</td>
 </tr>
 <tr >
   <td height="54" colspan="11" style="border:#999999"><table width="763" height="88" border="0" cellpadding="0" cellspacing="0">
     <tr>
       <td width="80" height="26"><span class="item">
         <label>Aplicación:</label>
       </span></td>
       <td width="106"><span class="item">
         <select id="sleApp" name="sleApp">
           <!--<option value="1">Compras</option>-->
           <option value="2" selected="selected">Ventas</option>
         </select>
         
         	
       </span></td>
       <td width="65"><span class="item sucursal">
         <label>Empresa:</label>
       </span></td>
       <td width="166"><span class="item sucursal">
         <select id="sleSucursal" name="sleSucursal">
           <?php for($x = 0 ; $x < count($arySucursales) ; $x++){ ?>
           <option value="<?php echo $arySucursales[$x]['cod_suc'] ?>"
								<?php if($arySucursales[$x]['cod_suc']){ echo "selected='selected'";} ?>
								><?php echo $arySucursales[$x]['des_suc'] ?></option>
           <?php } ?>
         </select>
         
         <script>
			 var valor1="<?php echo $_REQUEST['sleSucursal']?>";
			 var i;
			 for (i=0;i<document.form1.sleSucursal.options.length;i++)
				{
				
					if (document.form1.sleSucursal.options[i].value==valor1)
					   {
					   
					   document.form1.sleSucursal.options[i].selected=true;
					   }
				
				}
			
			</script>
         
       </span></td>
       <td width="71"><span >Documento:</span></td>
       <td width="275"><span class="item serie">
         <select id="sleDocumento" name="sleDocumento">
           <?php for($x = 0 ; $x < count($aryOperaciones) ; $x++){ ?>
           <option value="<?php echo $aryOperaciones[$x]['codigo'] ?>" <?php if($aryOperaciones[$x]['codigo'] == 'BV'){ echo 'selected="selected"'; }?>><?php echo $aryOperaciones[$x]['descripcion'] ?></option>
           <?php } ?>
           
         </select>
         
         <script>
			 var valor1="<?php echo $_REQUEST['sleDocumento']?>";
			 var i;
			 for (i=0;i<document.form1.sleDocumento.options.length;i++)
				{
				
					if (document.form1.sleDocumento.options[i].value==valor1)
					   {
					   
					   document.form1.sleDocumento.options[i].selected=true;
					   }
				
				}
			
			</script>
         
       </span></td>
     </tr>
     <tr>
       <td height="14" colspan="6"><span class="item" style="display:none">Búsqueda
           
Entre números /

Entre fechas </span></td>
       </tr>
     <tr>
       <td height="30" colspan="6"><span class="item">
         <label></label>
       </span><span class="item">
         <label>Rango de fechas:</label>
         <span>Del </span>
         
<?php 

	if(isset($_REQUEST['inicio'])){
		$valFecha=$_REQUEST['inicio'];
		$valFin=$_REQUEST['termino'];
		$valSerie=$_REQUEST['txtSerie'];
	}else{
		$valFecha=date('01-m-Y');
		$valFin=date('d-m-Y');
		$valSerie="001";
	}

?>
         
         <input type="text" id="inicio" name="inicio" value="<?=$valFecha?>" />
         <span> al </span>
         <input type="text" id="termino" name="termino" value="<?=$valFin?>" />
       </span>	   <span class="item serie"> Serie:<span class="item">
       <input style="visibility:visible" type="text" id="txtSerie" name="txtSerie" value="<?php echo $valSerie ?>" onblur="ceros(this)" />
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="submit" name="Submit" value="Generar" />
       </span></span></td>
       </tr>
     <tr>
       <td height="18" colspan="6">&nbsp;</td>
       </tr>
   </table></td>
 </tr>
 <tr >
   <td height="13" colspan="11" style="border:#999999">&nbsp;</td>
 </tr>
 <tr >
   <td height="20" colspan="11" style="border:#999999"><fieldset><legend><span class="Estilo11">Resultados</span></legend>
   <br>
     <?php 
   
   
  // $esperado = 1; // inicio
//$fin = 100; // fin

$fechaIni=formatofecha($_REQUEST['inicio']);
$fechaFin=formatofecha($_REQUEST['termino']);

///********************************* INICIO ********************************************
$EjecSql="SELECT Num_doc FROM cab_mov WHERE cod_ope='".$_REQUEST['sleDocumento']."' and sucursal='".$_REQUEST['sleSucursal']."' and serie='".$_REQUEST['txtSerie']."' and  substring(fecha,1,10) BETWEEN '$fechaIni' AND '$fechaFin' ORDER BY Num_doc asc limit 1";
//echo $EjecSql;
$resultado=mysql_query($EjecSql,$cn);
$rs2=mysql_fetch_array($resultado);

$esperado=$rs2['Num_doc'];
//echo $esperado;
//***********************************************************************************


///************************************ FIN *****************************************
$EjecSql="SELECT Num_doc FROM cab_mov WHERE cod_ope='".$_REQUEST['sleDocumento']."' and sucursal='".$_REQUEST['sleSucursal']."' and serie='".$_REQUEST['txtSerie']."' and  substring(fecha,1,10) BETWEEN '$fechaIni' AND '$fechaFin' ORDER BY Num_doc desc limit 1";
//echo $EjecSql;
$resultado=mysql_query($EjecSql,$cn);
$rs2=mysql_fetch_array($resultado);

$fin=$rs2['Num_doc'];

//**********************************************************************************

echo "<strong>N&Uacute;MERO INICIAL : </strong>".$_REQUEST['txtSerie']."-".$esperado."<br>";
echo "<strong>N&Uacute;MERO FINAL    &nbsp;&nbsp;&nbsp;&nbsp;: </strong>".$_REQUEST['txtSerie']."-".$fin."<br>";



if($fin!=''){

$EjecSql="SELECT Num_doc FROM cab_mov WHERE cod_ope='".$_REQUEST['sleDocumento']."' and sucursal='".$_REQUEST['sleSucursal']."' and serie='".$_REQUEST['txtSerie']."' and  Num_doc BETWEEN $esperado AND $fin ORDER BY Num_doc";
//echo $EjecSql;
$resultado=mysql_query($EjecSql,$cn);

while($rs=mysql_fetch_array($resultado))
{ 

$id = $rs['Num_doc']; // traspaso el primer folio de la tabla a la variable $id // 


	if($id <= $fin ){ //Aca controle que solo llegara hasta el final del rango 
		if ($id > $esperado) { 
			for ($i = $esperado; $i < $id; $i++) { 
			
			$faltantes[] = $i; 
			//echo $i."<br>";
			
			} 
		} 
	} 

$esperado = $id+1; //Aca debo controlar por que cuando el inicio es mayor el Esperado cambia

} // fin while //

$numeroIni=$faltantes[0];
$j=0;
$k=0;
if(isset($faltantes)){
	foreach ($faltantes as $subkey=> $subvalue) {
	
	
		if($j>0){
		
			if( ($numeroIni+1) == $subvalue){
			
			$conse=$subvalue;
				if($k==0){
				$primerCon=$subvalue;
				}
			$k++;
			}else{
			
				if($k>0 ){
					
					if($primerCon==$numeroIni){
						
						$noConse=$noConse."  ".$_REQUEST['txtSerie']."-".str_pad($primerCon,7,"0",STR_PAD_LEFT)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						
					}else{
					
					$noConse=$noConse." <strong> del ".$_REQUEST['txtSerie']."-".str_pad($primerCon,7,"0",STR_PAD_LEFT)." al ".$_REQUEST['txtSerie']."-".str_pad($numeroIni,7,"0",STR_PAD_LEFT)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong> ";
					}
									
				}
				$noConse=$noConse."  ".$_REQUEST['txtSerie']."-".str_pad($subvalue,7,"0",STR_PAD_LEFT)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				
			$k=0;
			}
				
			$numeroIni=$subvalue;
		
		
		}
		
	$j++;
	
	}
	if($noConse==""){
		echo "<br><br>No existen resultados...";
		}
}else{
echo "<br><br>No existen resultados...";

}
echo "<br><br>".$noConse;
	
}else{

echo "<br><br>No existen resultados...";
}
   
   
   ?>
   <br> <br>
   </fieldset></td>
 </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
	<script>
			function ceros(obj) {
			  numCeros = '000'; // pon el nº de ceros que necesites
			  valor = obj.value;
			  valor = numCeros.substring(0,numCeros.length-valor.length)+valor;
			  obj.value = valor; 
			}
			
			function ceros2(obj) {
			  numCeros = '0000000'; // pon el nº de ceros que necesites
			  valor = obj.value;
			  valor = numCeros.substring(0,numCeros.length-valor.length)+valor;
			  obj.value = valor; 
			}
		</script>
</form>
	</body>
</html>