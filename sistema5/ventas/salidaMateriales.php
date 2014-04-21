<?php 
session_start();
include("../conex_inicial.php");
include('../funciones/funciones.php');

if(!isset($_REQUEST['accion'])){
unset($_SESSION['xcodprod']);
unset($_SESSION['xdesprod']);
unset($_SESSION['xcantidad']);
}

$codigo = $_REQUEST['CodDoc'];
$txtFec = $_REQUEST['txtFec'];


$tipoDocRec=$_REQUEST['tipoDocRec'];
//echo $_REQUEST['tipoDocRec'];

if($tipoDocRec=='RM'){
$titulo="RETORNO DE MATERIALES";
$tipodoc="1";
}else{
$titulo="SALIDA DE MATERIALES";
$tipodoc="2";
}


$serie="001";
$doc=$tipoDocRec;
$monedaDoc="01";

	$strSQLSM="select * from cab_mov where cod_cab='".$codigo."' ";
	$resultadoMS=mysql_query($strSQLSM,$cn);
	$rowSM=mysql_fetch_array($resultadoMS);
	$sucursal=$rowSM['sucursal'];
	$tienda=$rowSM['tienda'];
	$cliente=$rowSM['cliente'];
	$cod_vendedor=$rowSM['cod_vendedor'];

$strSQL01="select max(numero) as numero from tempdoc where sucursal='".$sucursal."' and tipodoc='".$tipodoc."' and doc='".$doc."' and serie='".$serie."' ";
//echo $strSQL01;
$resultado01=mysql_query($strSQL01,$cn);
$row01=mysql_fetch_array($resultado01);
$numero=str_pad($row01['numero']+1, 7, "0", STR_PAD_LEFT);



	$strSQL07="select * from cab_mov where cod_cab='".$_REQUEST['CodDoc']."' ";
	$resultado07=mysql_query($strSQL07,$cn);
	$row07=mysql_fetch_array($resultado07);
	$serieOT=$row07['serie'];
	$numeroOT=$row07['Num_doc'];
	$clienteOT=$row07['cliente'];
	$sucursalOT=$row07['sucursal'];
	list($razonsocial)=mysql_fetch_row(mysql_query("select razonsocial from cliente where codcliente='".$clienteOT."'",$cn));
	
	//-----------------------------guia de remision------------------
	$strSQL015="select * from docuser where usuario='".$_SESSION['codvendedor']."' and tipomov='2' and doc='GR' ";
	$resultado15=mysql_query($strSQL015,$cn);
	$row15=mysql_fetch_array($resultado15);
	$serieGuia=$row15['serie'];
	if($serieGuia=='') $serieGuia='001';
	list($numeroGuia)=mysql_fetch_row(mysql_query("select max(Num_doc) from cab_mov where cod_ope='GR' and tipo='2' and  sucursal='".$sucursalOT."' and serie='".$serieGuia."'",$cn));
	
	//-------------------------------------------------------------------
	
	//$serieOT=$row15['serie'];
	//$numeroOT=$row15['Num_doc'];
	
	
	
	$strSQL10="select * from operacion where codigo='".$doc."' ";
	$resultado10=mysql_query($strSQL10,$cn);
	$row10=mysql_fetch_array($resultado10);
//echo $strSQL10;
	$kardexDoc=substr($row10['p1'],9,1);
	$controlStock=substr($row10['p1'],0,1);
	//echo $controlStock;
	$impto1=$row10['imp1'];
	$incluidoIGV="S";
	$condicion="1";
	$inafecto=substr($row10['p1'],3,1);
	$deuda=substr($row10['p1'],4,1);
	$fecha_aud=gmdate('Y-m-d H:i:s',time()-18000);
	$pcIngreso=$_SESSION['pc_ingreso'];
	$predefecto=$row10['predefecto'];
	//echo $kardexDoc;
	
//die();

if($_REQUEST['accion']=='G'){
							
				$strSQL03="select  max(id) as id from tempdoc";
				$resultado03=mysql_query($strSQL03,$cn);
				$row03=mysql_fetch_array($resultado03);
				$id=$row03['id']+1;
				$id_guia=$row03['id']+2;
				
				$strSQL04="select  max(cod_cab) as cod_cab from cab_mov";
				$resultado04=mysql_query($strSQL04,$cn);
				$row04=mysql_fetch_array($resultado04);
				$cod_cab=$row04['cod_cab']+1;
				$cod_cab_guia=$row04['cod_cab']+2;

								
			   $strSQL02="insert into tempdoc(id,sucursal,tipodoc,doc,serie,numero,estado,usuario)values('".$id."','".$sucursal."','".$tipodoc."','".$doc."','".$serie."','".$numero."','G','".$usuario."')";
			mysql_query($strSQL02,$cn);
						
							
			$strSQL05="insert into cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,cliente,fecha,tienda,sucursal,flag_r,kardex,moneda,impto1,incluidoigv,condicion,inafecto,deuda,fecha_aud,pc) values('".$cod_cab."','".$tipodoc."','".$doc."','".$numero."','".$serie."','".$cod_vendedor."','".$clienteOT."','".cambiarfecha($txtFec)."','".$tienda."','".$sucursal."','RA','".$kardexDoc."','".$monedaDoc."','".$impto1."','".$incluidoIGV."','".$condicion."','".$inafecto."','".$deuda."','".$fecha_aud."','".$pcIngreso."')";
			mysql_query($strSQL05,$cn);

			
			foreach ($_SESSION['xcodprod'] as $subkey=> $subvalue) {
			
			$strSQLProd="select * from producto where idproducto='".$_SESSION['xcodprod'][$subkey]."'";
			$resultadoProd=mysql_query($strSQLProd,$cn);
			$rowProd=mysql_fetch_array($resultadoProd);
			$unidad=$rowProd['und'];
			$descargo=$rowProd['kardex'];
			$afectoigv=$rowProd['igv'];
		
			$strSQLProd2="select * from det_mov where cod_prod='".$rowProd['idproducto']."' and cod_cab='".$_REQUEST['CodDoc']."'";
			$resultadoProd2=mysql_query($strSQLProd2,$cn);
			if(mysql_num_rows($resultadoProd2)>0){
			$rowProd2=mysql_fetch_array($resultadoProd2);
			$precioProd=$rowProd2['precio'];
			}else{
				if($predefecto<6){
				$precioProd=$rowProd['precio'.$predefecto];
				}else{
				 if($predefecto==6)$campoPre='pre_ref';
				 if($predefecto==7)$campoPre='costo_inven1';
				$precioProd=$rowProd[$campoPre];
				}
			
			}
			$imp_item=$precioProd*$_SESSION['xcantidad'][$subkey];
						
				if($rowProd['kardex']=='S'){
				
					if($tipodoc=='2'){
					$updateProd="update producto set saldo".$tienda."=saldo".$tienda."-'".$_SESSION['xcantidad'][$subkey]."' where idproducto='".$_SESSION['xcodprod'][$subkey]."'";			
					}else{
					$updateProd="update producto set saldo".$tienda."=saldo".$tienda."+'".$_SESSION['xcantidad'][$subkey]."' where idproducto='".$_SESSION['xcodprod'][$subkey]."'";		
					
					}
				mysql_query($updateProd,$cn);
				//echo $updateProd;
				}
						
			$strSQL06="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,unidad,cantidad,fechad,precio,imp_item,tcambio,moneda,descargo,afectoigv,flag_kardex) values('".$cod_cab."','".$tipodoc."','".$doc."','".$serie."','".$numero."','".$clienteOT."','".$tienda."','".$sucursal."','".$_SESSION['xcodprod'][$subkey]."','".$_SESSION['xdesprod'][$subkey]."','".$unidad."','".$_SESSION['xcantidad'][$subkey]."','".cambiarfecha($txtFec)."','".$precioProd."','".$imp_item."','".$_SESSION['tc']."','".$monedaDoc."','".$descargo."','".$afectoigv."','".$tipodoc."')";
								
			//echo $strSQL06;
			mysql_query($strSQL06,$cn);
			}
			
			///--------------------refrencia de la SM con la OT------------
			
			$strSQL08="insert into referencia(cod_cab,serie,correlativo,cod_cab_ref)values('".$cod_cab."','".$serieOT."','".$numeroOT."','".$_REQUEST['cod_cabOT']."')";
			mysql_query($strSQL08,$cn);
			
			  $strSQL09="update cab_mov set flag_r=CONCAT(flag_r,'RO') where cod_cab='".$_REQUEST['cod_cabOT']."'";
			mysql_query($strSQL09,$cn);
			//-------------------------------------------------------
			
			
			
				//----------------------------GUIA DE REMISION -------------------------------------------------
				
	  if(isset($_REQUEST['serieGuia'])){
						
				//---------datos guia remision------------
				$serie_guia=$_REQUEST['serieGuia'];
				$numero_guia=$_REQUEST['numeroGuia'];
				$transportista=$_REQUEST['transportista'];
				$id_chofer=$_REQUEST['id_chofer'];
				//----------------------------------------
						$strSQL10="select * from operacion where codigo='GR' and tipo='2' ";
						$resultado10=mysql_query($strSQL10,$cn);
						$row10=mysql_fetch_array($resultado10);
					
						$kardexDoc=substr($row10['p1'],9,1);
						$impto1=$row10['imp1'];
						$incluidoIGV="S";
						$condicion="1";
						$inafecto=substr($row10['p1'],3,1);
						$deuda=substr($row10['p1'],4,1);
				/*$sucursal=$_REQUEST['sucursal'];
				$tipodoc=$_REQUEST['tipodoc'];
				$usuario=$_REQUEST['usuario'];
				$numero=$_REQUEST['numero'];*/
				$strSQL02="insert into tempdoc(id,sucursal,tipodoc,doc,serie,numero,estado,usuario)values('".$id_guia."','".$sucursal."','".$tipodoc."','GR','".$serie_guia."','".$numero_guia."','G','".$usuario."')";
			mysql_query($strSQL02,$cn);

				$strSQL05="insert into cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,cliente,fecha,tienda,sucursal,flag_r,kardex,moneda,impto1,incluidoigv,condicion,inafecto,deuda,fecha_aud,pc) values('".$cod_cab_guia."','".$tipodoc."','GR','".$numero_guia."','".$serie_guia."','".$cod_vendedor."','".$clienteOT."','".cambiarfecha($txtFec)."','".$tienda."','".$sucursal."','RA','".$kardexDoc."','".$monedaDoc."','".$impto1."','".$incluidoIGV."','".$condicion."','".$inafecto."','".$deuda."','".$fecha_aud."','".$pcIngreso."')";
			mysql_query($strSQL05,$cn);
			
			//------------------referencia de la SM con la GR----------------------
			    $strSQL08="insert into referencia(cod_cab,serie,correlativo,cod_cab_ref)values('".$cod_cab_guia."','".$serie."','".$numero."','".$cod_cab."')";
			mysql_query($strSQL08,$cn);
		
			    $strSQL09="update cab_mov set flag_r=CONCAT(flag_r,'RO') where cod_cab='".$cod_cab."'";
			mysql_query($strSQL09,$cn);
				//-----------------------------------------------------------------------
			
			foreach ($_SESSION['xcodprod'] as $subkey2=> $subvalue2) {
			
			$strSQLProd="select * from producto where idproducto='".$_SESSION['xcodprod'][$subkey2]."'";
			$resultadoProd=mysql_query($strSQLProd,$cn);
			$rowProd=mysql_fetch_array($resultadoProd);
			$unidad=$rowProd['und'];
			$descargo=$rowProd['kardex'];
			$afectoigv=$rowProd['igv'];
		
			$strSQLProd2="select * from det_mov where cod_prod='".$rowProd['idproducto']."' and cod_cab='".$_REQUEST['CodDoc']."'";
			$resultadoProd2=mysql_query($strSQLProd2,$cn);
			if(mysql_num_rows($resultadoProd2)>0){
			$rowProd2=mysql_fetch_array($resultadoProd2);
			$precioProd=$rowProd2['precio'];
			}else{
				if($predefecto<6){
				$precioProd=$rowProd['precio'.$predefecto];
				}else{
				 if($predefecto==6)$campoPre='pre_ref';
				 if($predefecto==7)$campoPre='costo_inven1';
				$precioProd=$rowProd[$campoPre];
				}
			
			}
			$imp_item=$precioProd*$_SESSION['xcantidad'][$subkey];
			
				/*		
				if($rowProd['kardex']=='S'){
					
					if($tipodoc=='2'){
					$updateProd="update producto set saldo".$tienda."=saldo".$tienda."-'".$_SESSION['xcantidad'][$subkey]."' where idproducto='".$_SESSION['xcodprod'][$subkey]."'";			
					}else{
								
					}
				mysql_query($updateProd,$cn);
				//echo $updateProd;
				}
					*/	
			$strSQL06G="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,unidad,cantidad,fechad,precio,imp_item,tcambio,moneda,descargo,afectoigv,flag_kardex) values('".$cod_cab_guia."','".$tipodoc."','GR','".$serie_guia."','".$numero_guia."','".$clienteOT."','".$tienda."','".$sucursal."','".$_SESSION['xcodprod'][$subkey2]."','".$_SESSION['xdesprod'][$subkey2]."','".$unidad."','".$_SESSION['xcantidad'][$subkey2]."','".cambiarfecha($txtFec)."','".$precioProd."','".$imp_item."','".$_SESSION['tc']."','".$monedaDoc."','".$descargo."','".$afectoigv."','".$tipodoc."')";

			mysql_query($strSQL06G,$cn);
			}
     }
		
		//---------------------------------------------------------------------------------------------	
			
	
}

?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Salida de Mercaderias</title>
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
</style></head>


<script language="javascript" src="../miAJAXlib2.js"></script>
<script type="text/javascript" src="../javascript/mover_div.js"></script>

<link href="../styles.css" rel="stylesheet" type="text/css">

<script>
var scrollDivs=new Array();
scrollDivs[0]="productos";
</script>

<body onLoad="carga_div();" onUnload="vaciar_sesiones()">
<form name="formulario" method="post" action="">
  <table width="629" border="0">
    <tr>
      <td width="2" height="30" bgcolor="#F5F5F5">&nbsp;</td>
      <td colspan="2" align="center" bgcolor="#F5F5F5"><span class="Estilo10"><?php echo $titulo?> </span></td>
    </tr>
    <tr>
      <td rowspan="5">&nbsp;</td>
      <td width="27"><fieldset>
        <table width="315" border="0">
          <tr>
            <td><span class="Estilo1">Numero:</span></td>
            <td><input readonly="readonly" name="serie" id="serie" type="text" size="5" maxlength="3" value="<?php echo $serie?>">
                <input readonly="readonly" name="numero" id="numero" type="text" size="10" maxlength="7" value="<?php echo $numero?>">
                <input name="accion" type="hidden" id="accion" value="" size="5">
                <input name="cod_cabOT" type="hidden" id="cod_cabOT" value="<?php echo $_REQUEST['CodDoc']?>" size="10">
                <input name="tienda" type="hidden" id="tienda" value="<?php echo $tienda?>" size="10"></td>
          </tr>
          <tr>
            <td width="60"><span class="Estilo1">Producto: </span></td>
            <td width="239"><input type="text" name="desprod" id="desprod"  onKeyup="cambiar_chofer('P')" onFocus="cambiar_chofer('P')">
                <button  id="btn_transp" type="button" title="Cambiar transportista" style="height:18; vertical-align:top" onClick="cambiar_chofer('P')" >...</button>
              <input type="hidden" name="codprod" id="codprod">
                <input name="stock" type="hidden" id="stock" size="5"></td>
          </tr>
          <tr>
            <td class="Estilo1">Cantidad:</td>
            <td><input type="text" name="cantidad" id="cantidad" onKeyUp="insertMat2(event)">
                <input type="button" name="Submit" value="Insertar " onClick="insertMat()"></td>
          </tr>
        </table></fieldset></td>
      <td width="291" valign="top"><fieldset><legend><span class="Estilo11">DOCUMENTO REFERENCIA</span></legend>
        <table width="273" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="133" height="27" valign="bottom"><strong>OT:</strong>
              <input  readonly="readonly" name="serieOT" id="numeroOT" type="text" size="3" maxlength="10" value="<?php echo $serieOT ?>">
              <input  readonly="readonly" name="serieOT" id="numeroOT" type="text" size="8" maxlength="7" value="<?php echo $numeroOT; ?>"></td>
            <td width="140" valign="bottom"> Fecha:
            <input name="txtFec" type="text" id="txtFec" value="<?php echo date('d-m-Y')?>" size="10" maxlength="10" readonly="readonly"></td>
          </tr>
          <tr>
            <td height="27" colspan="2"><strong>CLIENTE:&nbsp;&nbsp;</strong><?php echo $razonsocial?></td>
          </tr>
        </table>
      </fieldset></td>
    </tr>
    <?php 
	 if($tipoDocRec=='SM' && $_SESSION['stickcom']=='N'){
	?>
    <tr>
      <td colspan="2" >
	    <fieldset>
	    <table width="589" height="52" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="265"><span class="Estilo13">GUIA DE REMISION Nº :</span>
              <input  name="serieGuia" id="serieGuia" type="text" size="3" maxlength="3" value="<?php echo $serieGuia?>" onKeyUp="generarNum(event,this)">
              <input readonly=""  name="numeroGuia" id="numeroGuia" type="text" size="8" maxlength="7" value="<?php echo str_pad($numeroGuia+1,7,"0",STR_PAD_LEFT) ?>"></td>
            <td width="8">&nbsp;</td>
            <td width="267"><input style="background:none; border:none" type="checkbox" name="checkbox" value="checkbox">
            <span class="Estilo14">            Imprimir Guía de Remisión </span></td>
            <td width="21">&nbsp;</td>
          </tr>
          <tr>
            <td><span class="Estilo14">Transportista:</span> 
            <input type="text" name="nom_transportista" id="nom_transportista" readonly="">
			<button  id="btn_transp" type="button" title="Cambiar transportista" style="height:18; vertical-align:top" onClick="cambiar_chofer('T')" >...</button>
			<input name="transportista" id="transportista" type="hidden" size="8" maxlength="100" value="<?php echo $idchofer ?>"></td>
            <td>&nbsp;</td>
            <td><span class="Estilo14">Chofer:</span> 
            <input type="text" name="nom_chofer" id="nom_chofer" readonly="" >
            <button  id="btn_chofer" type="button" title="Cambiar Chofer" style="height:18; vertical-align:top" onClick="cambiar_chofer('C')" >...</button>	
			
			<input name="id_chofer" id="id_chofer" type="hidden" size="8" maxlength="100" value="<?php echo $idchofer ?>"></td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset></td>
    </tr>
	
	<?php } ?>
    <tr>
      <td height="16" colspan="2"><span class="Estilo1">Materiales e Insumos: </span></td>
    </tr>
    <tr>
      <td height="109" colspan="2" valign="top">
	  <div id="detSalMat">
	  <table width="578" border="0" cellpadding="0" cellspacing="0">
          <tr style="background:url(../imagenes/bg_contentbase2.gif); background-position:100 60">
            <td width="74"><span class="Estilo8">codigo</span></td>
            <td width="343"><span class="Estilo8">Descripcion</span></td>
            <td width="58"><span class="Estilo8">Cantidad</span></td>
            <td width="75">&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#F5F5F5">&nbsp;</td>
            <td bgcolor="#F5F5F5">&nbsp;</td>
            <td bgcolor="#F5F5F5">&nbsp;</td>
            <td bgcolor="#F5F5F5">&nbsp;</td>
          </tr>
      </table>
	  </div>	  </td>
    </tr>
    <tr>
      <td colspan="2" align="center">
	  <input onClick="consulDoc()" type="button" name="Submit2" value="     Guardar    ">
      <input type="button" name="Submit22" value="     Cancelar   " onClick="Cerrar()">	</td>
    </tr>
  </table>
  
   <div id="productos" style="position:absolute; left:114px; top:139px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>
</form>
</body>


</html>

<script>
var controlStock="<?php echo $controlStock ?>";

function cambiar_chofer(param){

	var tienda=document.formulario.tienda.value;	
	doAjax('../peticion_ajax2.php','&peticion=mostrar_chofer&tabla='+param+'&tienda='+tienda,'listaProd','get','0','1','','');
	
}

function listaProd(texto){

//document.getElementById('productos').style.zIndex='100';
document.getElementById('productos').innerHTML=texto;
document.getElementById('productos').style.visibility="visible";
//alert();
	if(document.formulario.transpChofer.value=='P'){
	document.formulario.valor_chofer.value=document.formulario.desprod.value;
	document.formulario.valor_chofer.select();
	document.formulario.valor_chofer.focus();
	}
	if(document.formulario.transpChofer.value=='T'){
	//nom_transportista
	}
	
}

function sel_chofer(codigo,nombre,stock){
		
		if(document.formulario.transpChofer.value=='P'){
		document.formulario.codprod.value=codigo;
		document.formulario.desprod.value=nombre;
		document.formulario.stock.value=stock;
		document.formulario.cantidad.focus();
		}
		if(document.formulario.transpChofer.value=='T'){
		document.formulario.transportista.value=codigo;
		document.formulario.nom_transportista.value=nombre;
		}
		if(document.formulario.transpChofer.value=='C'){
		document.formulario.id_chofer.value=codigo;
		document.formulario.nom_chofer.value=nombre;
		}
		
	
salir();
}

function salir(){
document.getElementById('productos').style.visibility="hidden";

}

var temp2="";
	function entrada(objeto){
	//objeto.cells[0].childNodes[0].checked=true;
	//temp=objeto;
		if(objeto.style.background=='url(../imagenes/sky_blue_sel.png)'){
	//objeto.style.background=objeto.bgColor;
		}else{
		objeto.style.background='url(../imagenes/sky_blue_sel.png)';
			if(temp2!=''){
			//alert(temp.style.background);
			//alert(objeto.bgColor);
			temp2.style.background=temp2.bgColor;
			}
			temp2=objeto;
		}
	
}

function busqueda_chofer(pag){

var tabla="P";
var valor=document.formulario.valor_chofer.value;
var tienda=document.formulario.tienda.value;

doAjax('../peticion_ajax2.php','&peticion=buscar_chofer&valor='+valor+'&tabla='+tabla+'&pag='+pag+'&tienda='+tienda,'mostrar_bus_chofer','get','0','1','','');
}

function cargar_datos(pag){
busqueda_chofer(pag);
}

function mostrar_bus_chofer(texto){
temp=texto.split("~");
document.getElementById('detalle_chofer').innerHTML=temp[0];
document.getElementById('divpagina').innerHTML=temp[1];

}


function insertMat(){
	var codprod=document.formulario.codprod.value;
	var desprod=document.formulario.desprod.value;
	var cantidad=parseFloat(document.formulario.cantidad.value);
	var stock= parseFloat(document.formulario.stock.value);
	
	if(cantidad==0 || cantidad=='' ||  desprod==''){
	alert('Todos los campos son obligatorios');
	return false;
	}
	
		
	
		if(cantidad>stock && controlStock=='S')
		{
		alert("Producto sin Stock ... \n Stock Disponible: "+stock);	
		document.formulario.cantidad.focus();
		document.formulario.cantidad.select();
		return false;
		}
		
		
	var codcab=document.formulario.cod_cabOT.value;
	//alert(codcab);
	doAjax('../peticion_ajax2.php','&peticion=detSalMat&codprod='+codprod+'&desprod='+desprod+'&cantidad='+cantidad+'&codcab='+codcab,'rspta_detSalMat','get','0','1','','');

}

function insertMat(){

	var codprod=document.formulario.codprod.value;
	var desprod=document.formulario.desprod.value;
	var cantidad=parseFloat(document.formulario.cantidad.value);
	var stock= parseFloat(document.formulario.stock.value);
	
	if(cantidad==0 || cantidad==''  || desprod==''){
	alert('Todos los campos son obligatorios');
	return false;
	}
	if(cantidad>stock && controlStock=='S')
	{
	alert("Producto sin Stock ... \n Stock Disponible: "+stock);	
	document.formulario.cantidad.focus();
	document.formulario.cantidad.select();
	return false;
	}
	var codcab=document.formulario.cod_cabOT.value;
	doAjax('../peticion_ajax2.php','&peticion=detSalMat&codprod='+codprod+'&desprod='+desprod+'&cantidad='+cantidad+'&codcab='+codcab,'rspta_detSalMat','get','0','1','','');

}
function insertMat2(e){

if(e.keyCode==13){
	var codprod=document.formulario.codprod.value;
	var desprod=document.formulario.desprod.value;
	var cantidad=parseFloat(document.formulario.cantidad.value);
	var stock= parseFloat(document.formulario.stock.value);
	
	if(cantidad>stock && controlStock=='S')
	{
	alert("Producto sin Stock ... \n Stock Disponible: "+stock);	
	document.formulario.cantidad.focus();
	document.formulario.cantidad.select();
	return false;
	}
	var codcab=document.formulario.cod_cabOT.value;
	doAjax('../peticion_ajax2.php','&peticion=detSalMat&codprod='+codprod+'&desprod='+desprod+'&cantidad='+cantidad+'&codcab='+codcab,'rspta_detSalMat','get','0','1','','');
}
}




function rspta_detSalMat(texto){
//alert(texto);
if(texto=='noexiste'){
alert("Producto no se encuentra registrado en la OT");
document.formulario.codprod.value="";
document.formulario.desprod.value="";
document.formulario.cantidad.value="";
document.formulario.desprod.focus();
return false;
}

document.getElementById('detSalMat').innerHTML=texto;
document.formulario.codprod.value="";
document.formulario.desprod.value="";
document.formulario.cantidad.value="";
document.formulario.desprod.focus();

}

function vaciar_sesiones(){

doAjax('../peticion_ajax2.php','&peticion=detSalMat&accion=salir','','get','0','1','','');
}

function eliminar(item){
doAjax('../peticion_ajax2.php','&peticion=detSalMat&accion=eliminar&item='+item,'rspta_detSalMat','get','0','1','','');
}

function guardar(){
document.formulario.accion.value='G';
document.formulario.submit();

Cerrar();
}
function consulDoc(){
var tipo='2';
var sucursal='<?php echo $sucursalOT ?>';
var doc='GR';
var serie=document.formulario.serieGuia.value;
var numero=document.formulario.numeroGuia.value;
var auxiliar='';
doAjax('../peticion_ajax2.php','&peticion=docExiste&tipo='+tipo+'&sucursal='+sucursal+'&doc='+doc+'&serie='+serie+'&numero='+numero+'&auxiliar='+auxiliar,'rptaConsulDoc','get','0','1','','');

}
function rptaConsulDoc(texto){
//alert(texto);
	if(texto > 0){
	alert('El numero de Guia de Remisión ya se encuentra ingresada');
	document.formulario.numeroGuia.focus();
	}else{
	guardar();
	}
}

function Cerrar(){
	//window.opener.location=window.opener.location;
	window.parent.opener.cargardatos('');
	self.close();
	return false
}

function generarNum(e,control){

	if(e.keyCode==13){
	control.value=ponerCeros(control.value,3);
	doAjax('../compras/peticion_datos.php','&serie='+control.value+'&doc=GR&sucursal=1&peticion=generar_numero&tipomov=2','rpta_gen_numero','get','0','1','',''); 
	}

}

function rpta_gen_numero(texto){
//alert(texto);
document.formulario.numeroGuia.value=ponerCeros(texto,7);
}

function ponerCeros(obj,i) {
		  while (obj.length<i){
			obj = '0'+obj;
			}
		//	alert(obj);
			return obj;
}

</script>
