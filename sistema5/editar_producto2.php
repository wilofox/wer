<?php 
session_start();
include('conex_inicial.php');
include('funciones/funciones.php');
$factor='1';
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Datos de Producto</title>
<style type="text/css">
<!--
.Estilo12 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
body {
	margin-left: 00px;
	margin-top: 00px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo56 {font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color:#000000 }
.Estilo60 {
	font-size: 10px;
	font-family: Arial, Helvetica, sans-serif;
	color:#000000;
}
.Estilo62 {
	font-size: 11px;
	font-family: Arial, Helvetica, sans-serif;
	color: #0066FF;
	font-weight: bold;
}
-->
</style>
</head>

<link href="styles.css" rel="stylesheet" type="text/css">
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="stylesheet" href="engine/css/lightbox.css" type="text/css" media="screen" />
		<script src="engine/js/prototype.js" type="text/javascript"></script>
		<script src="engine/js/scriptaculous.js?load=effects,builder" type="text/javascript"></script>
		<script src="engine/js/lightbox.js" type="text/javascript"></script>

	<style>
			.gallery {
				zoom:1;
				width:auto;				
			}
			.gallery a {
				display:block;
				float:left;
				margin:5px;
				opacity:0.87;
				text-align:center;
			}
			.gallery a:hover {
				opacity:1;
			}
			.gallery a img {
				border:none;
				display:block;
			}
			.gallery a#vlightbox{display:none}
    .Estilo63 {font-family: Verdana, Arial, Helvetica, sans-serif}
    </style>





<script language="javascript" src="miAJAXlib2.js"></script>

<script language="JavaScript" type="text/javascript" src="ajax_estilos.js"></script>

<!-- TinyMCE -->
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		language : "es",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

		// Theme options
		theme_advanced_buttons1 : "cut,copy,paste,|,search,replace,|,bullist,numlist,|,undo,redo,|,link,unlink,image,code,|,preview,|,forecolor,backcolor,|,hr,removeformat,visualaid,|,print",
		theme_advanced_buttons2 :"styleselect,formatselect,fontselect,fontsizeselect,|,bold,italic,underline|,justifyleft,justifycenter,justifyright,justifyfull,|,sub,sup,|,fullscreen",
//,advhr
		theme_advanced_buttons3 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example word content CSS (should be your site CSS) this one removes paragraph margins
		content_css : "css/word.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>

<?php 
//ALMACENAR EL NOMBRE
 $rspro_	=	mysql_query("select nombre from producto where idproducto='".$_REQUEST['cod']."'",$cn);
 $rowpro_  =   mysql_fetch_array($rspro_);

//verificar si este producto tiene movimientos  
if(!empty($_REQUEST['cod']) )
{  $rsdtmov	=	mysql_query("select * from det_mov where cod_prod='".$_REQUEST['cod']."'",$cn);
   if( mysql_num_rows($rsdtmov) >0 )
  $mov		=	'ok';  
}


//verificar si esta unidad tiene movimientos  
if(!empty($_REQUEST['cod']))
{  $rsuni	=	mysql_query("select und from producto where idproducto='".$_REQUEST['cod']."'",$cn);
   $rowuni  =   mysql_fetch_array($rsuni);
   
   //verificar la SI UNIDAD TIENE MOVIMIENTOS
	if( !empty($rowuni['und']) )
   {	$rsdet	=	mysql_query("select unidad from det_mov where cod_prod='".$_REQUEST['cod']."' and unidad='".$rowuni['und']."'",$cn);
   	    if( mysql_num_rows($rsdet) >0 )
		{$b_uni		=	'ok';}
   }
   
   //verificar la SI UNIDAD TIENE SUBUNIDADES
   if( !empty($rowuni['und']) )
   {	$rsdunix	=	mysql_query("SELECT unidad FROM unixprod WHERE producto='".$_REQUEST['cod']."' and unidad='".$rowuni['und']."'",$cn);
       if( mysql_num_rows($rsdunix) >0 )
		{ $sub_uni		=	'ok';}
   }
}


$accion=$_REQUEST['accion'];
//echo "codigo".$_REQUEST['cod'];

if(isset($_REQUEST['caracteristicas'])){

$cod=$_REQUEST['cod'];
$codprod=strtoupper($_REQUEST['codprod']);
$codprod2=strtoupper($_REQUEST['codprod2']);
$codprod3=strtoupper($_REQUEST['codprod3']);
$nombre=$_REQUEST['nombre'];
$precio=$_REQUEST['precio'];
$precio2=$_REQUEST['precio2'];
$precio3=$_REQUEST['precio3'];
$precio4=$_REQUEST['precio4'];
$precio5=$_REQUEST['precio5'];
//echo $codprod2.$codprod3;
$und=$_REQUEST['und'];
$factor=$_REQUEST['factor'];
$enlace=$_REQUEST['enlace'];
$caracteristicas=$_REQUEST['caracteristicas'];

$clasificacion=$_REQUEST['clasificacion'];
$categoria=$_REQUEST['combocategoria'];
$subcategoria=$_REQUEST['combosubcategoria'];
$valor_percep=$_REQUEST['valor_percep'];

$moneda=$_REQUEST['moneda'];
$afectoigv='N';
$kardex='N';
$series='N';
$percepcion='N';

if($_REQUEST['afectoigv']!=""){
$afectoigv='S';
}
if($_REQUEST['kardex']!=""){
$kardex='S';
}
if($_REQUEST['chkseries']!=""){
$series='S';
}
if($_REQUEST['chk_percep']!=""){
$percepcion='S';
}

$temp=0;
//	echo $codprod.$codprod2.$codprod3;
	
	if($codprod!=''){
	
	$resultados20 = mysql_query("select * from producto where (cod_prod='".$codprod."' or codanex2='".$codprod."'   or codanex3='".$codprod."') and  idproducto!='$cod'  ",$cn);
	
	$row20=mysql_fetch_array($resultados20);
	$temp=mysql_num_rows($resultados20);
	}
	if($codprod2!=''){
	$resultados21 = mysql_query("select * from producto where (cod_prod='".$codprod2."' or codanex2='".$codprod2."'   or codanex3='".$codprod2."') and idproducto!='$cod'  ",$cn);
	
	//$row20=mysql_fetch_array($resultados21);
	$temp2=mysql_num_rows($resultados21);
	}
	if($codprod3!=''){
	$resultados22 = mysql_query("select * from producto where (cod_prod='".$codprod3."' or codanex2='".$codprod3."'   or codanex3='".$codprod3."') and idproducto!='$cod'  ",$cn);
	
	//$row20=mysql_fetch_array($resultados20);
	$temp3=mysql_num_rows($resultados22);
	}

//echo "select * from producto where cod_prod='".$codprod."'";
//----------------------------iamgenes-----------------------------
$fileName = $_FILES['userfile']['name'];
$tmpName  = $_FILES['userfile']['tmp_name'];

$nombre_archivo = "imagenes/productos/".$_FILES['userfile']['name'];
//echo $temp.$temp2.$temp3;
if($temp==0){
if($temp2==0){
if($temp3==0){
 if($accion=='actualizar'){  

	if(move_uploaded_file($tmpName,$nombre_archivo))
	{
	$imagen1="imagenes/productos/".$_FILES['userfile']['name'];
	$strSQL="update producto set imagen='" . $imagen1 . "' where idProducto='" . $cod  . "'";
	//echo $strSQL;
	mysql_query($strSQL);
	}

	
	
	$strSQL2="update producto set nombre='" . $nombre . "',precio='" . $precio ."',precio2='" . $precio2 ."',precio3='" . $precio3 ."',precio4='" . $precio4 ."',precio5='" . $precio5 ."',und='" . $und . "',factor='" . $factor . "',cod_prod='" . $codprod .  "',codanex2='" . $codprod2 .  "',codanex3='" . $codprod3 .  "',clasificacion='" . $clasificacion . "',categoria='" . $categoria . "',subcategoria='" . $subcategoria . "',enlace='" . $enlace . "',igv='" . $afectoigv . "',kardex='" . $kardex . "'  ,moneda='" . $moneda . "',datos='".$caracteristicas."',series='".$series."',garantia='".$garantia."',agente_percep='".$percepcion."',valor_percep='".$valor_percep."' where idProducto='" . $cod . "'";
//	echo $strSQL2;
    mysql_query($strSQL2);
	
	//ELIMINAR LAS SUBUNIDADES
	if( $sub_uni == 'ok' )	
    {	$strdel = " DELETE FROM unixprod WHERE producto='".$cod."'";
		mysql_query($strdel);
	} 
	 echo "<script>window.parent.opener.cargarproducto('".$_REQUEST['pagina']."');close();</script>";  //close();
/* echo "<script>alert('Se actualizo correctamente')</script>";*/

   }
   //---------------------------------------------------------------------------------
   if($accion=='grabar'){
   
   
  			 if(move_uploaded_file($tmpName,$nombre_archivo))
			{
			$imagen1="imagenes/productos/".$_FILES['userfile']['name'];
			}
		
			
			$resultados2r = mysql_query("select max(idProducto) as codi from producto ",$cn);
			$row2r=mysql_fetch_array($resultados2r);
			$cod=str_pad($row2r['codi']+1, 6, "0", STR_PAD_LEFT);  
			
		//--------------------------------------------------------------------------	
									
			$strSQL2= "insert into producto (idproducto,clasificacion,categoria,subcategoria,cod_prod,codanex2,codanex3,nombre,precio,precio2,precio3,precio4,precio5,und,factor,imagen,enlace,igv,kardex,moneda,datos,series,garantia,agente_percep,valor_percep) values ('".$cod."','".$clasificacion."','".$categoria."','".$subcategoria."','".$codprod."','".$codprod2."','".$codprod3."','".$nombre."','".$precio."','".$precio2."','".$precio3."','".$precio4."','".$precio5."','".$und."','".$factor."','".$imagen1."','".$enlace."','".$afectoigv."','".$kardex."','".$moneda."','".$caracteristicas."','".$series."','".$garantia."','".$percepcion."','".$valor_percep."')";
			
		mysql_query($strSQL2);
   
 echo "<script>window.parent.opener.cargarproducto('".$_REQUEST['pagina']."');close();</script>";//

   }
   
   // echo $strSQL2;
   }else{
 
  echo "<script>alert('El codigo anexo3 ya esta en uso');</script>";
 } 
   }else{
 
  echo "<script>alert('El codigo anexo2 ya esta en uso');</script>";
 } 
 }else{
 
  echo "<script>alert('El codigo anexo1 ya esta en uso');</script>";
 }  
   
}




?>

<script>

function validar(form){
/*
if(form.clasificacion.value=='seleccionar'){
alert('seleccione una clasificacion ');
return false;
}
if(form.categoria.value=='seleccionar'){
alert('seleccione una categoria ');
return false;
}
if(form.subcategoria.value=='seleccionar'){
alert('seleccione una subcategoria ');
return false;
}
*/


//inafecto= verde
//sin checked kardex= rojo

    
	var bad = 0;
	
	if(document.form1.codprod.value=="" && document.form1.codprod2.value=="" && document.form1.codprod3.value==""){
		bad=1;
	}else{
		if(document.form1.codprod.value!=""){
			bad = 1;
		}else{
			alert("Se debe ingresar el primer codigo anexo");
			return false;
		}
	}
	
	var mov = "<? echo $mov; ?>";
	
	//COMFIRMAR SI TIENE MOVIMIENTOS
    if( bad == 1 )
	{	if( mov == 'ok' )
		{	if(confirm("***********************   ESTE PRODUCTO TIENE MOVIMIENTOS  ***********************")){  return true;		}
			else{ return false; }
		}
		return true;
    }
}




</script>
<?php   
  
  $cod=$_REQUEST['cod'];

if($cod==''){
 //$resultados2 = mysql_query("select max(idProducto) as codi from producto ",$cn);
 //$row2=mysql_fetch_array($resultados2);
 //$cod=str_pad($row2['codi']+1, 6, "0", STR_PAD_LEFT);  
//$codprod=$row2['anexo']+1;  

}


  
$resultados = 	mysql_query("select * from producto where idproducto='$cod'",$cn);

while($row=mysql_fetch_array($resultados))
{
$cod=$row['idproducto'];
$nombre=$row['nombre'];
$codprod=$row['cod_prod'];
$codprod2=$row['codanex2'];
$codprod3=$row['codanex3'];
$precio=$row['precio'];
$precio2=$row['precio2'];
$precio3=$row['precio3'];
$precio4=$row['precio4'];
$precio5=$row['precio5'];

$clasificacion=$row['clasificacion'];
$categoria=$row['categoria'];
$subcategoria=$row['subcategoria'];
$und=$row['und'];
$factor=$row['factor'];
$imagen1=$row['imagen'];
$enlace=$row['enlace'];
$afectoigv=$row['igv'];
$kardex=$row['kardex'];
$moneda=$row['moneda'];
$caracteristicas=$row['datos'];
$subunidad=$row['subunidad'];
$series=$row['series'];
$garantia=$row['garantia'];
$percepcion=$row['agente_percep'];
$valor_percep=$row['valor_percep'];


}
//echo $afectoigv;
$disab_precep=" disabled='disabled' ";
	if($percepcion=='S'){
		$checkpercep=" checked='checked' ";
		$disab_precep=" ";
	}

 ?>

<body onLoad="javascript:document.form1.nombre.focus()" >

<form action="" method="get"  name="form1" id="form1"  enctype="multipart/form-data" >

  <table width="624" height="497" border="0" cellpadding="0" cellspacing="0">
    
    <tr>
      <td width="17" height="19" bgcolor="#FAF3E2">&nbsp;</td>
      <td width="79" bgcolor="#FAF3E2">&nbsp;</td>
      <td width="231" bgcolor="#FAF3E2"><span class="Estilo12">
        <input type="hidden" name="accion" id="accion" value="<?php echo $_REQUEST['accion']?>">
        <input type="hidden" name="pagina" value="<?php echo $_REQUEST['pagina']?>">
         <input type="hidden" name="nombre_" id="nombre_" value="<?=$rowpro_['nombre']?>">
	  </span></td>
      <td width="297" rowspan="7" bgcolor="#FAF3E2">
	  
	    <table style="background-color:#FFFFFF" width="204" height="178" border="1" cellpadding="0" cellspacing="0" >
          <tr>
            <td width="200" height="176" align="center">
			<div class="gallery">
				<a href="<?php echo $imagen1?>" rel="lightbox[sample]" title="<?php echo $nombre?>">
			<img src="<?php echo $imagen1?>" width="180" height="150"  style="border:#E9E9E9 solid 1px" /></a>			</div>			</td>
          </tr>
        </table>
      <span class="Estilo60">Clic en la imagen para aumentar de tama&ntilde;o </span></td>
    </tr>
    
    <tr>
      <td height="19" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2"><span class="Estilo56">Codigo</span></td>
      <td bgcolor="#FAF3E2"><span class="Estilo12" style="color:#0066FF"><strong><?php echo $cod;?>
        </strong>
        <input type="hidden" name="cod" id="cod" value="<?php echo $cod;?>">
        <input type="hidden" name="subcat" id="subcat" value="<?php echo $subcategoria;?>">
		<input type="hidden" name="cat" id="cat" value="<?php echo $categoria;?>">
      </span></td>
    </tr>
    <tr>
      <td height="24" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2"><span class="Estilo56">Cod. Anexo1: </span></td>
      <td bgcolor="#FAF3E2"><input name="codprod" type="text" value="<?php echo $codprod;?>" size="30" maxlength="25" onKeyUp="saltar_campo(event,this)"></td>
	  	  
    </tr>
    <tr>
      <td height="22" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2"><span class="Estilo56">Cod. Anexo2:</span></td>
      <td bgcolor="#FAF3E2"><input name="codprod2" type="text" value="<?php echo $codprod2;?>" size="30" maxlength="25" onKeyUp="saltar_campo(event,this)"></td>
    </tr>
    <tr>
      <td height="21" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2"><span class="Estilo56">Cod. Anexo3:</span></td>
      <td bgcolor="#FAF3E2"><input name="codprod3" type="text" value="<?php echo $codprod3;?>" size="30" maxlength="130" onKeyUp="saltar_campo(event,this)"></td>
    </tr>
    <tr>
      <td height="22" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2" class="Estilo56">Nombre:</td>
      <td bgcolor="#FAF3E2"><input name="nombre" type="text" value="<?php echo $nombre;?>" size="30" maxlength="200" /></td>
    </tr>
    <tr>
      <td height="65" bgcolor="#FAF3E2">&nbsp;</td>
      <td colspan="2" bgcolor="#FAF3E2" class="Estilo56">

	  <fieldset  style="width:290px">
	   <legend>Precios</legend>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td  width="40%" ><span class="Estilo60">
              <?=$PrecNomEti1;?>
            </span></td>
            <td width="10%" ><input style="text-align:right" name="precio" type="text" value="<?php if($precio==''){echo "0.00";}else{ echo $precio;} ?>" size="4" maxlength="10" /></td>
            <td width="40%"><span class="Estilo60">
              &nbsp;
              <?=$PrecNomEti2;?>
            </span></td>
            <td width="10%"><input style="text-align:right" name="precio2" type="text" value="<?php echo $precio2 ?>" size="4" maxlength="10" /></td>
          </tr>
          <tr>
            <td><span class="Estilo60">
            <?=$PrecNomEti3;?>
            </span></td>
            <td><input style="text-align:right" name="precio3" type="text" value="<?php echo $precio3 ?>" size="4" maxlength="10" /></td>
            <td><span class="Estilo60">&nbsp;
              <?=$PrecNomEti4;?>
            </span></td>
            <td><input style="text-align:right" name="precio4" type="text" value="<?php echo $precio4 ?>" size="4" maxlength="10" /></td>
          </tr>
          <tr>
            <td><span class="Estilo60">
              <?=$PrecNomEti5;?>
            </span></td>
            <td><input style="text-align:right" name="precio5" type="text" value="<?php echo $precio5 ?>" size="4" maxlength="10" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
	  </fieldset>         </td>
    </tr>
    <tr>
      <td height="22" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2" class="Estilo56">Moneda</td>
      <td bgcolor="#FAF3E2" class="Estilo12"><select name="moneda">
        <option value="01">SOLES (S/.)</option>
		<option value="02">DOLARES (US$.)</option>
        <script>
	   var valor1="<?php echo $moneda?>";
     var i;
	 for (i=0;i<document.form1.moneda.options.length;i++)
        {
		
            if (document.form1.moneda.options[i].value==valor1)
               {
			   
               document.form1.moneda.options[i].selected=true;
               }
        
        }
	      </script>
      </select></td>
      <td width="297" bgcolor="#FAF3E2"><input type="file" name="userfile" id="userfile">
        <span class="Estilo60">
        <input type="hidden" name="imagen1" value="<?php echo $imagen1;?>">
      </span> </td>
    </tr>
    
    <tr>
      <td height="23" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2"><span class="Estilo56">Unidad</span></td>
      <td colspan="2" bgcolor="#FAF3E2"><select name="und" id="und" style="width:160px" <? if($b_uni == 'ok' ){?>disabled='disabled' <? }?>>
	  <?php 
	  
	   $resultados0 = mysql_query("select * from unidades order by descripcion ",$cn);
		
		while($row0=mysql_fetch_array($resultados0))
		{
		
	  
	  
	  ?>
		<option value="<?php echo $row0['id']?>" selected  ><?php echo $row0['descripcion']."  -  ".$row0['nombre']  ?></option>	  
   
		
		<?php
		}		
			
		 ?>
      </select>
	   <script>
	   var valor1="<?php echo $und?>";
	 var i;
	 for (i=0;i<document.form1.und.options.length;i++)
        {
		
            if (document.form1.und.options[i].value==valor1)
               {
			   
               document.form1.und.options[i].selected=true;
               }
        
        }
	      </script>      
	   <span class="Estilo56">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Agente de Percepciones: 
	      <input <?php echo $checkpercep?> onClick="activar_percep(this)" style="border:none; background:none" type="checkbox" name="chk_percep" value="checkbox">
          <input <?php echo $disab_precep; ?> style="text-align:right" name="valor_percep" id="valor_percep" type="text" size="8" maxlength="6"  value="<?php echo number_format($valor_percep,2)?>">
       %</span></td>
    </tr>
    <tr>
      <td height="22" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2"><span class="Estilo56">Factor</span></td>
      <td colspan="2" rowspan="4" bgcolor="#FAF3E2"><table width="504" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="24"><input name="factor" type="text" value="<?php echo $factor;?>" size="20" maxlength="10" /></td>
          <td ><span class="Estilo56" style="visibility:visible">Sub-Unidad
            <?php 

		$btn=" disabled='disabled'";
		if($subunidad=='S'){
		$check="checked='checked'";
		$btn="";
		}
		
		if($series=='S'){
		$checkseries="checked='checked'";
		}
		
		
		
		?>
                <input  style="border:none; background:none" type="checkbox" <?php echo $check;?> id="checkbox"  name="checkbox" value="checkbox" onClick="activar_cbo(this)">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button onClick="abrir_subund()" <?php echo $btn;?> type="button" id="undprod"  style="height:20; width:160px; font-size:11px" >Unidades por Producto</button>
          </span></td>
        </tr>
        <tr>
          <td height="24"><select style="width:160px" name="clasificacion" >
              <?php 
	  
	    $resultados0 = mysql_query("select * from clasificacion order by des_clas ",$cn);
			 // echo "resultado".$resultado;
			  
while($row0=mysql_fetch_array($resultados0))
{
		
	  ?>
              <option value="<?php echo $row0['idclasificacion']?>"><?php echo $row0['des_clas']?></option>
              <?php 
	 }
	  ?>
              <script>
	   var valor1="<?php echo $clasificacion?>";
     var i;
	 for (i=0;i<document.form1.clasificacion.options.length;i++)
        {
		
            if (document.form1.clasificacion.options[i].value==valor1)
               {
			   
               document.form1.clasificacion.options[i].selected=true;
               }
        
        }
	        </script>
          </select></td>
          <td><span class="Estilo56" >Afecto IGV
            <input style="border:none; background:none" type="checkbox" name="afectoigv" value="checkbox" <?php if($afectoigv=='S' )echo "checked='checked'"?> >
            &nbsp;&nbsp;</span><span class="Estilo56">&nbsp;</span><span class="Estilo56">&nbsp;</span><span class="Estilo56">&nbsp;</span><span class="Estilo56">Efecto en Kardex
              <input style="border:none; background:none" type="checkbox" name="kardex" id="kardex" onClick="efecto_kardex(this)" value="checkbox" <?php if($kardex=='S' || $afectoigv=='' )echo "checked='checked'"?>>
            </span></td>
        </tr>
        <tr>
          <td width="200" height="24"><select style="width:160px" name="combocategoria">
              <?php 
	  
	    $resultados0 = mysql_query("select * from categoria order by des_cat ",$cn);
			 // echo "resultado".$resultado;
			  
while($row0=mysql_fetch_array($resultados0))
{
		
	  ?>
              <option value="<?php echo $row0['idCategoria']?>"><?php echo $row0['des_cat']?></option>
              <?php 
	 }
	  ?>
              <script>
			var valor1="<?php echo $categoria?>";
			var i;
			 for (i=0;i<document.form1.combocategoria.options.length;i++)
			{
			
				if (document.form1.combocategoria.options[i].value==valor1)
				   {
				   
				   document.form1.combocategoria.options[i].selected=true;
				   }
			
			}
	      </script>
          </select></td>
          <td width="304"><span class="Estilo56" style=" display:block">Series
            <input <?php echo $checkseries?> style="border:none; background:none" type="checkbox" name="chkseries" value="checkbox"  onClick="efecto_kardex(this)" id="chkseries">
          Garantia: 
		   <select name="garantia">
            <option value="3">3 Meses</option>
            <option value="6">6 Meses</option>
            <option value="12">12 Meses</option>
            <option value="18">18 Meses</option>
            <option value="24">24 Meses</option>
			<option value="36">36 Meses</option>
			
			  <script>
	   var valor1="<?php echo $garantia?>";
     var i;
	 for (i=0;i<document.form1.garantia.options.length;i++)
        {
		
            if (document.form1.garantia.options[i].value==valor1)
               {
			   
               document.form1.garantia.options[i].selected=true;
               }
        
        }
	        </script>
          </select>
		  
		  
		  
          </span></td>
        </tr>
        <tr>
          <td height="26"><select style="width:160px" name="combosubcategoria">
              <?php 
	  
	    $resultados0 = mysql_query("select * from subcategoria order by des_subcateg ",$cn);
			 // echo "resultado".$resultado;
			  
while($row0=mysql_fetch_array($resultados0))
{
		
	  ?>
              <option value="<?php echo $row0['idsubcategoria']?>"><?php echo $row0['des_subcateg']?></option>
              <?php 
	 }
	  ?>
              <script>
	   var valor1="<?php echo $subcategoria?>";
     var i;
	 for (i=0;i<document.form1.combosubcategoria.options.length;i++)
        {
		
            if (document.form1.combosubcategoria.options[i].value==valor1)
               {
			   
               document.form1.combosubcategoria.options[i].selected=true;
               }
        
        }
	      </script>
          </select></td>
          <td width="304"><span class="Estilo56">Enlace</span>
              <input value="<?php echo $enlace?>" name="enlace" type="text" size="30" maxlength="250"></td>
        </tr>
      </table></td>
    </tr>
    
    
    <tr>
      <td height="26" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2"><span class="Estilo56">Clasificaci&oacute;n</span></td>
    </tr>
    <tr>
      <td height="27" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2"><span class="Estilo56">Categoria</span></td>
    </tr>
    <tr>
      <td height="23" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2"><span class="Estilo56">Subcategoria</span></td>
    </tr>
    <tr>
      <td height="28" bgcolor="#FAF3E2">&nbsp;</td>
      <td colspan="3" bgcolor="#FAF3E2"><table width="586" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="586"><span class="Estilo62">Caracteristicas</span></td>
        </tr>
        <tr>
          <td><textarea name="caracteristicas" cols="32" rows="4" style="width:80%"><?php echo $caracteristicas?></textarea></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="28" colspan="4" align="center" bgcolor="#FAF3E2">
	  <input onClick="grabar_prod()" type="button" name="Submit" value="Grabar" id="Submit"  >
        <input type="button" name="Submit2" value="Cancelar" onClick="salir_ventana();">
        <label for="label"></label>
        <input type="button" name="Submit3" value="Salir" id="label"  onClick="javascript:window.close();"></td>
    </tr>
    
    
    <?php 

  
  ?>
    <tr>
      <td height="28" bgcolor="#FAF3E2">&nbsp;</td>
      <td colspan="3" align="center" bgcolor="#FAF3E2"><label for="Submit"></label></td>
    </tr>
    <tr>
      <td bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2">&nbsp;</td>
      <td colspan="2" bgcolor="#FAF3E2">&nbsp;</td>
    </tr>
  </table>
</form>
</body>

<script>


function grabar_prod(){
	var sub_uni = "<?=$sub_uni?>";
	 if( sub_uni == 'ok' )	
	{   if(confirm('Esta UNIDAD tiene subunidades desea eliminar todas sus subunidades relacionadas ?')){			
			  if(validar(document.form1)){
					document.form1.submit();
				}
		}
		else{ return false; }
	}
    if(validar(document.form1))
	 {  var jjjjj = "<?=$_REQUEST['nombre_']?>" 
	    alert(jjjjj);
		document.form1.submit();
	}

}

function salir_ventana(){
//window.opener.parent.frames[0].recargar();
//window.opener.parent.frames[0].location.href="lista_productos.php";
window.parent.opener.cargarproducto('');

//document.form2.submit(); 

close();
}

function cargarcat(){
//alert();
var clas=document.form1.clasificacion.value;
doAjax('cargarcategorias.php','clas='+clas,'mostrarcat','get','0','1','','');
}
function mostrarcat(texto){
//alert(texto);
document.getElementById('combocategoria').innerHTML=texto;
marcarcat();
}
//---------------------------------------------------------------------------
function cargarsubcat(){
//alert();
var clas=document.form1.categoria.value;
doAjax('cargarsubcategorias.php','clas='+clas,'mostrarsubcat','get','0','1','','');
}
function mostrarsubcat(texto){
//alert(texto);
document.getElementById('combosubcategoria').innerHTML=texto;
marcarsubcat();
}

function cargarcombos(){
var clas=document.form1.clasificacion.value;
var cat=document.form1.cat.value;
var subcat=document.form1.subcat.value;

	if(cat!=''){
	doAjax('cargarcategorias.php','clas='+clas,'mostrarcat','get','0','1','','');
	doAjax('cargarsubcategorias.php','clas='+cat,'mostrarsubcat','get','0','1','','');
	}
}


function espec(cod){
window.open('especificaciones.php?cod='+cod,'ventana3','height=620 width=620 top=80 left=220 status=yes scrollbars=yes');
}

function efecto_kardex(objeto){

//	if(!objeto.checked){
	document.form1.Submit.disabled=true;
	var codigo=document.form1.cod.value;
	//alert(objeto.name);
		if(objeto.name=='kardex'){
		doAjax('peticion_ajax2.php','peticion=kardex_prod&codigo='+codigo,'efecto_kardex_r','get','0','1','','');
		}else{
		doAjax('peticion_ajax2.php','peticion=kardex_prod&codigo='+codigo,'efecto_series_r','get','0','1','','');
		}
	//}
}

function efecto_kardex_r(texto){

	if(texto>0){
	alert('Este producto tiene movimientos');
//document.form1.kardex.checked=true;
	
		if(document.form1.kardex.checked){
		document.form1.kardex.checked=false;
		}else{
		document.form1.kardex.checked=true;
		}
	
	}
	document.form1.Submit.disabled=false;

}

function efecto_series_r(texto){

	if(texto>0){
	alert('Este producto tiene movimientos');

		if(document.form1.chkseries.checked){
		document.form1.chkseries.checked=false;
		}else{
		document.form1.chkseries.checked=true;
		document.form1.kardex.checked=true;
		}
	
	
	}
	
	document.form1.Submit.disabled=false;

}


function activar_cbo(chk){
var temp="<?php echo $accion;?>";

	if(temp=='actualizar'){
		if(chk.checked){
		document.form1.undprod.disabled=false;
		}else{
		document.form1.undprod.disabled=true;
		}
	}else{
	alert('Debe guardar primero el producto.')
	document.form1.checkbox.checked=false;
	}	
}


function abrir_subund( ){
var cod="<?php echo $cod;?>";
var unidad = document.form1.und.value;
window.open('subunidades/undxprod.php?cod='+cod+'&unidad='+unidad,'ventana3','height=420 width=500 top=80 left=220 status=yes scrollbars=yes');

}

function activar_percep(control){
	if(control.checked){
	document.form1.valor_percep.disabled=false;
	document.form1.valor_percep.focus();
	document.form1.valor_percep.select();
	}else{
	document.form1.valor_percep.disabled=true;
	document.form1.focus();
	}

}



function saltar_campo(e,control){

	if(e.keyCode==13){
	
		if(control.name=="codprod"){
		document.form1.codprod2.focus();
		}
		if(control.name=="codprod2"){
		document.form1.codprod3.focus();
		}
		if(control.name=="codprod3"){
		document.form1.nombre.focus();
		}
	
	}
return false;
}
</script>

</html>
<form name="form2" action="productos.php" method="get" target="principal"></form>