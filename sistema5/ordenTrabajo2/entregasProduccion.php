<?php 
session_start();
include("../conex_inicial.php");
include('../funciones/funciones.php');

$CodDoc=$_REQUEST['CodDoc'];

$resultado=mysql_query("select * from det_mov where cod_cab='".$CodDoc."'",$cn);
$cont=mysql_num_rows($resultado);
$row=mysql_fetch_row($resultado);
//print_r($row);
$arraypestanas="";
for($i=1;$i<=$cont;$i++){
$arraypestanas=$arraypestanas." ITEM Nro ".$i." ,";
}

$arraypestanas=substr($arraypestanas,0,strlen($arraypestanas)-1);
//echo "sf".$_REQUEST['Submit22'];
if(isset($_REQUEST['Submit22'])){


	$CodDoc=$_REQUEST['CodDoc'];
	list($sucursal,$monedaDoc,$clienteOT,$serieOT,$numeroOT)=mysql_fetch_row(mysql_query("select sucursal,moneda,cliente,serie,Num_doc from cab_mov where cod_cab='".$CodDoc."'"));

	for($i=1;$i<=$_REQUEST['cont'];$i++){	
	
	$tienda=$_REQUEST['tienda'.$i];
	$tipomov=$_REQUEST['tipomov'.$i];
	$sumaCant=$_REQUEST['sumaCant'.$i];
	$tipodoc='2';
	$doc='EP';
	$serie=$tienda;
	//$sumaCant=$_REQUEST['tienda'.$i];
	$fecha_aud=gmdate('Y-m-d H:i:s',time()-18000);
	$pcIngreso=$_SESSION['pc_ingreso'];
	$codvendedor=$_SESSION['codvendedor'];
	$cantMat=$_REQUEST['cantMat'.$i];
	$codigop=$_REQUEST['codigop'.$i];
	$cantEnvases=$_REQUEST['cantEnvases'.$i];
			
		//echo $sumaCant."<br>";
		if($sumaCant>0){
				$strSQL04="select  max(cod_cab) as cod_cab from cab_mov";
				$resultado04=mysql_query($strSQL04,$cn);
				$row04=mysql_fetch_array($resultado04);
				$cod_cab=$row04['cod_cab']+1;
				
				$strSQL01="select max(Num_doc) as numero from cab_mov where sucursal='".$sucursal."' and tipo='".$tipodoc."' and cod_ope='".$doc."' and serie='".$serie."' ";
				//echo $strSQL01;
				$resultado01=mysql_query($strSQL01,$cn);
				$row01=mysql_fetch_array($resultado01);
				$numero=str_pad($row01['numero']+1, 7, "0", STR_PAD_LEFT);
			
			if($tipomov=='I' || $tipomov=='S'){
			$kardexDoc='S';
			}else{
			$kardexDoc='N';
			}
			
			$flag_kardex=2;
			if($tipomov=='I')$flag_kardex=1;
			if($tipomov=='S')$flag_kardex=2;
		
				$strSQL05="insert into cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,cliente,fecha,tienda,sucursal,flag_r,kardex,moneda,impto1,incluidoigv,condicion,inafecto,deuda,fecha_aud,pc,usuario,f_venc) values('".$cod_cab."','".$tipodoc."','".$doc."','".$numero."','".$serie."','".$codvendedor."','".$clienteOT."','".date('Y-m-d h:i:s')."','".$tienda."','".$sucursal."','RA','".$kardexDoc."','".$monedaDoc."','18','S','1','S','N','".$fecha_aud."','".$pcIngreso."','".$codvendedor."','".$fecha_aud."')";
				
			//echo $strSQL05."<br>";
								
				mysql_query($strSQL05,$cn);		
			
			for($j=0;$j<count($cantMat);$j++){
					
				if($cantMat[$j]>0){	
			list($nom_prod,$unidad,$descargo,$afectoigv)=mysql_fetch_row(mysql_query("select nombre,und,kardex,igv from producto where idproducto='".$codigop[$j]."'"));
						
			$strSQL06="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,unidad,cantidad,fechad,precio,imp_item,tcambio,moneda,descargo,afectoigv,flag_kardex,envases) values('".$cod_cab."','".$tipodoc."','".$doc."','".$serie."','".$numero."','".$clienteOT."','".$tienda."','".$sucursal."','".$codigop[$j]."','".$nom_prod."','".$unidad."','".$cantMat[$j]."','".$fecha_aud."','".$precioProd."','".$imp_item."','".$_SESSION['tc']."','".$monedaDoc."','".$descargo."','".$afectoigv."','".$flag_kardex."','".$cantEnvases[$j]."')";	
			
			mysql_query($strSQL06,$cn);
			
					$updateProd="";
				    if($flag_kardex=='2'){
					$updateProd="update producto set saldo".$tienda."=saldo".$tienda."-'".$cantMat[$j]."' where idproducto='".$codigop[$j]."'";			
					}else{
						if($flag_kardex=='1'){
						$updateProd="update producto set saldo".$tienda."=saldo".$tienda."+'".$cantMat[$j]."' where idproducto='".$codigop[$j]."'";		
						}
					}
			//echo $updateProd."<br>";
			//echo $strSQL06."<br>";
					if($updateProd!=""){
					mysql_query($updateProd,$cn);
					}
				
				 }		
			}	
		
		//------referencia--		
		$strSQLRef="insert into referencia(cod_cab,serie,correlativo,cod_cab_ref)values('".$CodDoc."','".$serieOT."','".$numeroOT."','".$cod_cab."')";
		//echo $strSQLRef."<br>";						 
			mysql_query($strSQLRef,$cn);	
		}//fin if
		
//-------------------------------------------------------------------------------------------------------------------		

	$tienda=$_REQUEST['tienda3'.$i];
	$tipomov=$_REQUEST['tipomov3'.$i];
	$sumaCant=$_REQUEST['sumaCant3'.$i];
	$tipodoc='2';
	$doc='EP';
	$serie=$tienda;
	//$sumaCant=$_REQUEST['tienda'.$i];
	$fecha_aud=gmdate('Y-m-d H:i:s',time()-18000);
	$pcIngreso=$_SESSION['pc_ingreso'];
	$codvendedor=$_SESSION['codvendedor'];
	$cantMat=$_REQUEST['cantMat3'.$i];
	$codigop=$_REQUEST['codigop3'.$i];
	$cantEnvases=$_REQUEST['cantEnvases3'.$i];
	
	if($sumaCant>0){
				$strSQL04="select  max(cod_cab) as cod_cab from cab_mov";
				$resultado04=mysql_query($strSQL04,$cn);
				$row04=mysql_fetch_array($resultado04);
				$cod_cab=$row04['cod_cab']+1;
				
				$strSQL01="select max(Num_doc) as numero from cab_mov where sucursal='".$sucursal."' and tipo='".$tipodoc."' and cod_ope='".$doc."' and serie='".$serie."' ";
				//echo $strSQL01;
				$resultado01=mysql_query($strSQL01,$cn);
				$row01=mysql_fetch_array($resultado01);
				$numero=str_pad($row01['numero']+1, 7, "0", STR_PAD_LEFT);
			
			if($tipomov=='I' || $tipomov=='S'){
			$kardexDoc='S';
			}else{
			$kardexDoc='N';
			}
			
			$flag_kardex=2;
			if($tipomov=='I')$flag_kardex=1;
			if($tipomov=='S')$flag_kardex=2;
		
				$strSQL05="insert into cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,cliente,fecha,tienda,sucursal,flag_r,kardex,moneda,impto1,incluidoigv,condicion,inafecto,deuda,fecha_aud,pc,usuario,f_venc) values('".$cod_cab."','".$tipodoc."','".$doc."','".$numero."','".$serie."','".$codvendedor."','".$clienteOT."','".date('Y-m-d h:i:s')."','".$tienda."','".$sucursal."','RA','".$kardexDoc."','".$monedaDoc."','18','S','1','S','N','".$fecha_aud."','".$pcIngreso."','".$codvendedor."','".$fecha_aud."')";
				
			//echo $strSQL05."<br>";
								
				mysql_query($strSQL05,$cn);		
			
			for($j=0;$j<count($cantMat);$j++){
					
				if($cantMat[$j]>0){	
			list($nom_prod,$unidad,$descargo,$afectoigv)=mysql_fetch_row(mysql_query("select nombre,und,kardex,igv from producto where idproducto='".$codigop[$j]."'"));
						
			$strSQL06="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,unidad,cantidad,fechad,precio,imp_item,tcambio,moneda,descargo,afectoigv,flag_kardex,envases) values('".$cod_cab."','".$tipodoc."','".$doc."','".$serie."','".$numero."','".$clienteOT."','".$tienda."','".$sucursal."','".$codigop[$j]."','".$nom_prod."','".$unidad."','".$cantMat[$j]."','".$fecha_aud."','".$precioProd."','".$imp_item."','".$_SESSION['tc']."','".$monedaDoc."','".$descargo."','".$afectoigv."','".$flag_kardex."','".$cantEnvases[$j]."')";	
			
			mysql_query($strSQL06,$cn);
			
					$updateProd="";
				    if($flag_kardex=='2'){
					$updateProd="update producto set saldo".$tienda."=saldo".$tienda."-'".$cantMat[$j]."' where idproducto='".$codigop[$j]."'";			
					}else{
						if($flag_kardex=='1'){
						$updateProd="update producto set saldo".$tienda."=saldo".$tienda."+'".$cantMat[$j]."' where idproducto='".$codigop[$j]."'";		
						}
					}
			//echo $updateProd."<br>";		
			//echo $strSQL06."<br>";
					if($updateProd!=""){
					mysql_query($updateProd,$cn);
					}
				
				 }		
			}	
		
		//------referencia--		
		$strSQLRef="insert into referencia(cod_cab,serie,correlativo,cod_cab_ref)values('".$CodDoc."','".$serieOT."','".$numeroOT."','".$cod_cab."')";
		//echo $strSQLRef."<br>";						 
			mysql_query($strSQLRef,$cn);	
		}//fin if
		
	//---------------------------------------------------------------------------------------------------------------		
		
	}//fin for
	
	echo "<script>window.close();</script>";
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Salida de Mercaderias</title>

<LINK href="../pestanas/tab-view.css" type=text/css rel=stylesheet>
<SCRIPT src="../pestanas/tab-view.js" type=text/javascript></SCRIPT>

<script src="../jquery-1.2.6.js"></script>
<script src="../jquery.hotkeys.js"></script>

<script language="javascript" src="../miAJAXlib2.js"></script>
<link href="../styles.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 11px;
}
.Estilo8 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #FFFFFF; font-weight: bold; }
.Estilo10 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
	color: #0066CC;
}
.Estilo11 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.Estilo13 {color: #FF0000}
.Estilo14 {color: #000000}
-->
img { behavior: url(../ventas/iepngfix.htc); }
</style></head>

	<style type="text/css">
<!--
.Estilo5 {font-size: 11px; font-weight: bold; font-family: Arial, Helvetica, sans-serif; color: #FFFFFF; }
-->
</style>

<script>

function consulDoc(){
	alert("Guardar");
}

function nuevo(){
var aux="C";
//alert(aux);
var CodDoc="<?php echo $_REQUEST['CodDoc']; ?>";
doAjax('peticion_datos.php','&peticion=contenedor2&CodDoc='+CodDoc,'nuevo_suc','get','0','1','','')
}

function nuevo_suc(texto){


var r = texto.split('|');
//alert(r[0]);
//alert(document.getElementById('dhtmlgoodies_tabView1').getElementsByTagName('DIV')[6].innerHTML);
//document.getElementById('dhtmlgoodies_tabView1').getElementsByTagName('DIV')[3].innerHTML=r[0];

var cantpest="<?php echo $cont?>";
var temppest="<?php echo $cont?>";
//alert(cantpest.length);
for(var i=0;i<cantpest;i++ ){

temppest++;
//alert(r[i]);
document.getElementById('dhtmlgoodies_tabView1').getElementsByTagName('DIV')[temppest].innerHTML=r[i];
//document.getElementById('dhtmlgoodies_tabView1').getElementsByTagName('DIV')[5].innerHTML=r[1];
//document.getElementById('dhtmlgoodies_tabView1').getElementsByTagName('DIV')[6].innerHTML=r[2];
}
//document.getElementById('sucursal').style.display='block';
//seleccionar_combo();
//seleccionar_combo2();

//alert('entro');
//document.form1.txtnombre.focus();

//initTabs('dhtmlgoodies_tabView1',Array('General','Datos adicionales'),0,500,200,Array(false,false));

//alert(dhtmlgoodies_tabObj);

}

  function entrar_btn(obj){
		  obj.cells[0].style.backgroundImage="url(../imagenes/bordes_boton1.gif)";
		  obj.cells[1].style.backgroundImage="url(../imagenes/bordes_boton2.gif)";
		  obj.cells[2].style.backgroundImage="url(../imagenes/bordes_boton2.gif)";
		  obj.cells[3].style.backgroundImage="url(../imagenes/bordes_boton3.gif)";
		  
  }
  
  function salir_btn(obj){
		  obj.cells[0].style.backgroundImage="";
		  obj.cells[1].style.backgroundImage="";
		  obj.cells[2].style.backgroundImage="";
		  obj.cells[3].style.backgroundImage="";
		  
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
<body  onLoad="nuevo()">
<form name="formulario" method="post" action="">
  <table width="630" border="0">
    <tr>
      <td width="2" height="30" bgcolor="#F5F5F5">&nbsp;</td>
      <td width="618" align="center" bgcolor="#F5F5F5"><span class="Estilo10">Entrega de Producci&oacute;n </span></td>
    </tr>
    <tr>
      <td rowspan="3">&nbsp;</td>
      <td height="46">
	  
	<DIV id=dhtmlgoodies_tabView1>
		
		<?php 
		for($i=1;$i<=$cont;$i++){
				
		?>
		<DIV class=dhtmlgoodies_aTab>
		No hay informacion que mostrar		</DIV>
	  
		<?php 
		}
		?>
	</DIV>	  </td>
    </tr>
      
    <tr>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><input  type="submit" name="Submit22" value="     Guardar    " /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center">&nbsp;</td>
    </tr>
  </table>
  
 
	
	
</form>
</body>


</html>

<script>
var temparraypestnas="<?php echo $arraypestanas ?>";
var arraypestnas=temparraypestnas.split(",");
//alert(arraypestnas);
//initTabs('dhtmlgoodies_tabView1',Array(' ITEM Nro1 ',' ITEM Nro2 ',' ITEM Nro3 '),0,500,200,Array(false,false,false));
initTabs('dhtmlgoodies_tabView1',arraypestnas,0,500,200,Array(false,false,false));


function sumarCant(obj){
temp=obj.id.split("cantMat");
//alert(temp[1]);
var acumulador=0;
	if(eval("document.formulario.cantMat3"+temp[1]+".length!=undefined")){

		for(var i=0; eval("i<document.formulario.cantMat"+temp[1]+".length");i++){
			if(eval("document.formulario.cantMat"+temp[1]+"["+(i)+"].value==''")){
			acumulador+=0;
			}else{
			eval("acumulador+=parseFloat(document.formulario.cantMat"+temp[1]+"["+(i)+"].value)")
			}
		}
		eval("document.formulario.sumaCant"+temp[1]+".value=acumulador");
		
	}else{
	
		if(eval("document.formulario.cantMat"+temp[1]+".value==''")){
		acumulador+=0;
		}else{
		eval("acumulador+=parseFloat(document.formulario.cantMat"+temp[1]+".value)")
		}
			
		eval("document.formulario.sumaCant"+temp[1]+".value=acumulador");
		
	
	}	
}
function sumarCant3(obj){
temp=obj.id.split("cantMat3");
//alert(temp[1]);
var acumulador=0;
//alert(eval("document.formulario.cantMat3"+temp[1]+".length!=undefined"));

	if(eval("document.formulario.cantMat3"+temp[1]+".length!=undefined")){
	
		for(var i=0; eval("i<document.formulario.cantMat3"+temp[1]+".length");i++){
			if(eval("document.formulario.cantMat3"+temp[1]+"["+(i)+"].value==''")){
			acumulador+=0;
			}else{
			eval("acumulador+=parseFloat(document.formulario.cantMat3"+temp[1]+"["+(i)+"].value)")
			}
		}	
		eval("document.formulario.sumaCant3"+temp[1]+".value=acumulador");
	}else{
		
			if(eval("document.formulario.cantMat3"+temp[1]+".value==''")){
			acumulador+=0;
			}else{
			eval("acumulador+=parseFloat(document.formulario.cantMat3"+temp[1]+".value)")
			}
			
			eval("document.formulario.sumaCant3"+temp[1]+".value=acumulador");
	
	}	
}

</script>
