<?php 
session_start();
include('conex_inicial.php');
include('funciones/funciones.php');
$factor='1';
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Soporte de Conceptos Contables</title>
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
<script language="javascript" src="jquery.js" type="text/javascript"></script>
<script src="jquery.hotkeys.js"></script>
<script>
var templ;
function validartecla(e,valor,temp){
		
		//alert(e.keyCode);
		/*
		if(e.keyCode==40 || e.keyCode==38){
		return false;
		}
	
		if(templ==1){
		return false;
		}
		if(e.keyCode==0){
		templ=1;
		}
		*/
switch(valor.id){
case "txtclasificacion":
var tipo="clasificacion";
jQuery(temp).css("top","130px");
break;
case "txtcategoria":
var tipo="categoria";
jQuery(temp).css("top","150px");
break;
case "txtsubcat":
var tipo="subcategoria";
jQuery(temp).css("top","175px");
break;
}
valor=valor.value;

	if ( ( (e.keyCode>=96) && (e.keyCode<=105) || (e.keyCode>=48) && (e.keyCode<=57) )  || ((e.keyCode>=65) && (e.keyCode<=90)) || e.keyCode==8 || e.keyCode==32 || e.keyCode==0 ) {
		jQuery.post('lista_resultados.php', {tipo : tipo , data : valor}, function(data){
 		jQuery(temp).html(data);
		 var tblres=document.getElementById('tblresultado');
			if(tblres.rows.length>0) tblres.rows[0].style.background='#fff1bb';
 		});
			jQuery(temp).css("border","1px solid");
			jQuery(temp).css("visibility","visible");
		
	}
}
function asignar(tipo,id,valor){
//alert(tipox+"-"+id+"-"+valor);
switch(tipo){
case "clasificacion":
var txtn="txtclasificacion";
var hdn="hdclasificacion";
//document.getElementById("txtcategoria").focus();
break;
case "categoria":
var txtn="txtcategoria";
var hdn="hdcategoria";
document.getElementById("txtsubcat").focus();
break;
case "subcategoria":
var txtn="txtsubcat";
var hdn="hdsubcat";
break;
}
var txtcla=document.getElementById(txtn);
txtcla.value=valor;
var hdcla=document.getElementById(hdn);
hdcla.value=id;
salir();
	
}
function salir(){
		jQuery("#auxiliares").css("visibility","hidden");
}

jQuery(document).bind('keydown', 'esc',function (evt){
salir();	
return false; });

	var sw=0;
jQuery(document).bind('keydown', 'down',function (evt){

 var tblres=document.getElementById('tblresultado');

 	if(document.getElementById('auxiliares').style.visibility=='visible'){

		for (var i=0;i<tblres.rows.length;i++) { 

			if(tblres.rows[i].style.background=='#fff1bb'&& (i<tblres.rows.length-1)){
			tblres.rows[i].style.background='#ffffff';
			tblres.rows[i+1].style.background='#fff1bb';
			sw=i;
			break;	
			}
		}
		//alert(sw);
		for (var i=0;i<tblres.rows.length;i++) {
			if(sw==i && (i<tblres.rows.length-1)){
			
				tblres.rows[i].style.background='#ffffff';
				tblres.rows[i+1].style.background='#fff1bb';
				sw=i;
			//if(i%4==0 && i!=0){

			//document.getElementById('detalle').href="#ancla"+i;
			//alert(document.getElementById('detalle').href);
			//document.formulario.codprod.focus();
			//var i=1;
			//var ancla="#ancla"+i;
			//var puntodescroll = document.getElementById(ancla).offsetTop;
			//alert(ancla);
			//if(i <= 6 && i >= 1)
			//{
			//document.getElementById('detalle').scrollTop = puntodescroll;
			//i++;
			//}

			
			//}
			break;
			}
		}
			
		
 }
	
	
 return false; });
 jQuery(document).bind('keydown', 'up',function (evt){

 var tblres=document.getElementById('tblresultado');

 	if(document.getElementById('auxiliares').style.visibility=='visible'){

		for (var i=0;i<tblres.rows.length;i++) { 
			//alert(tblres.rows[i].style.background);
			if(i>0 && tblres.rows[i].style.background=='#fff1bb'&& (i!=tblres.rows.length)){
			
			tblres.rows[i].style.background='#ffffff';
			tblres.rows[i-1].style.background='#fff1bb';
			//tblres.rows[i+1].style.background='#ffffff';
			sw=i;

			break;	
			}
		}
			
 }
	
	
 return false; });

jQuery(document).bind('keyup', 'return',function (evt){jQuery('#_return').addClass('dirty'); 
 var tblres=document.getElementById('tblresultado');
	if(document.getElementById('auxiliares').style.visibility=='visible'){

		for (var i=0;i<tblres.rows.length;i++) { 
		
			if(tblres.rows[i].style.background=='#fff1bb'){
		
				var temp=tblres.rows[i].cells[0].innerHTML;
				var temp1=tblres.rows[i].cells[1].innerHTML;
				var tip=tblres.name;
				asignar(tip,temp,temp1);
				
			}
		 }
	}
	   

return false; });


	
</script>
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
 $rspro_	=	mysql_query("select nombre,und from producto where idproducto='".$_REQUEST['cod']."'",$cn);
 $rowpro_  =   mysql_fetch_array($rspro_);

//verificar si este producto tiene movimientos  


if(!empty($_REQUEST['cod']) && $_REQUEST['accion']	==	'actualizar' )
{  
    //VERIFICA SI EL PRODUCTO TIENE MOVIMIENTOS Y SALE EL ALERT DE EL PRODUCTO TIENE MOVIMIENTOS DE SER CIERTO
    if(!empty($_REQUEST['cod']) )
	{  	$rsdtmov	=	mysql_query("select * from det_mov where cod_prod='".$_REQUEST['cod']."'",$cn);
		if( mysql_num_rows($rsdtmov) >0 )
		{ 	$mov		=	'ok';  }
	}
    
   //SACA LA UNIDAD
	$rsuni	=	mysql_query("select und,nombre from producto where idproducto='".$_REQUEST['cod']."'",$cn);
    $rowuni =   mysql_fetch_array($rsuni);
	$unipro =   str_pad($rowuni['und'],"2","0",STR_PAD_LEFT) ; $nompro =   $rowuni['nombre'];
	
   //VERIFICA SI LA UNIDAD DEL PRODUCTO TIENE MOVIMIENTOS Y DE SER CIERTA DESABILITA EL SELECT UNIDAD
	if( !empty($rowuni['und']) ) {	
	$rsdet	=	mysql_query("select unidad from det_mov where cod_prod='".$_REQUEST['cod']."' and unidad='".$unipro."'",$cn);
       if( mysql_num_rows($rsdet) >0 ){
	    	$b_uni='disabled';
		}else{
			$b_uni='';
		}
   }
   
   
   /*
   //VERIFICA SI CAMBIAS LA UNIDAD Y ESTA TIENE SUBUNIDADES AL MOMENTO DE PONER GUARDAR TE SALE UNA ALERTA  INDICANDOTE ESTO 
   if( !empty($rowuni['und']) )
   {   
       $rsdunix	=	mysql_query("SELECT unidad FROM unixprod WHERE producto='".$_REQUEST['cod']."'",$cn);
       if( mysql_num_rows($rsdunix) > 0 )
		{ 	$sub_uni		=	'ok';}
   }*/
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
$und=str_pad($_REQUEST['und'],"2","0",STR_PAD_LEFT);
$factor=$_REQUEST['factor'];
$enlace=$_REQUEST['enlace'];
$caracteristicas=$_REQUEST['caracteristicas'];

$clasificacion=$_REQUEST['hdclasificacion'];
$categoria=$_REQUEST['hdcategoria'];
$subcategoria=$_REQUEST['hdsubcat'];
$valor_percep=$_REQUEST['valor_percep'];
$factorC=$_REQUEST['factorC'];
$cuentacontable=$_REQUEST['cuentacontable'];
$mostrar=$_REQUEST['mostrar'];

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

    //ELIMINAR LAS SUBUNIDADES
	//echo 'yedem'.$subunidad;
	//echo $_REQUEST['checkbox'];
	/*if( $und  != $unipro  ){
		$strdel = " DELETE FROM unixprod WHERE producto='".$cod."'";
		mysql_query($strdel);
	} */
	//echo $tmpName."-".$nombre_archivo."-".$fileName;
	if(move_uploaded_file($tmpName,$nombre_archivo))
	{
	$imagen1="imagenes/productos/".$_FILES['userfile']['name'];
	$strSQL="update producto set imagen='" . $imagen1 . "' where idProducto='" . $cod  . "'";
	//echo $strSQL;
	mysql_query($strSQL);
	}
	
	  $strSQL2="update producto set nombre='" . $nombre . "',precio='" . $precio ."',precio2='" . $precio2 ."',precio3='" . $precio3 ."',precio4='" . $precio4 ."',precio5='" . $precio5 ."',und='" . str_pad($und,"2","0",STR_PAD_LEFT) . "',factor='" . $factor . "',cod_prod='" . $codprod .  "',codanex2='" . $codprod2 .  "',codanex3='" . $codprod3 .  "',clasificacion='" . $clasificacion . "',categoria='" . $categoria . "',subcategoria='" . $subcategoria . "',enlace='" . $enlace . "',igv='" . $afectoigv . "',kardex='" . $kardex . "'  ,moneda='" . $moneda . "',datos='".$caracteristicas."',series='".$series."',garantia='".$garantia."',agente_percep='".$percepcion."',valor_percep='".$valor_percep."' ,factorCompra ='".$factorC."',ccontable ='".$cuentacontable."',lista ='".$mostrar."'  where idProducto='" . $cod . "'";
//	echo $strSQL2;
    mysql_query($strSQL2);
	

//close();
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
									
			$strSQL2= "insert into producto (idproducto,clasificacion,categoria,subcategoria,cod_prod,codanex2,codanex3,nombre,precio,precio2,precio3,precio4,precio5,und,factor,imagen,enlace,igv,kardex,moneda,datos,series,garantia,agente_percep,valor_percep,concepto,ccontable,lista) values ('".$cod."','".$clasificacion."','".$categoria."','".$subcategoria."','".$codprod."','".$codprod2."','".$codprod3."','".$nombre."','".$precio."','".$precio2."','".$precio3."','".$precio4."','".$precio5."','".$und."','".$factor."','".$imagen1."','".$enlace."','".$afectoigv."','".$kardex."','".$moneda."','".$caracteristicas."','".$series."','".$garantia."','".$percepcion."','".$valor_percep."','S','".$cuentacontable."','".$mostrar."')";
		
			
		mysql_query($strSQL2);
		
		echo "<script>window.parent.opener.cargarproducto('".$_REQUEST['pagina']."');close();</script>";//

   }
   
   // echo $strSQL2;
   }else{
 
  echo "<script>alert('El codigo ".$AnexNomEti1." ya esta en uso');</script>";
 } 
   }else{
 
  echo "<script>alert('El codigo ".$AnexNomEti2." ya esta en uso');</script>";
 } 
 }else{
 
  echo "<script>alert('El codigo ".$AnexNomEti3." ya esta en uso');</script>";
 }  
   
}




?>

<script>
function validarSubunidad()
{  var unidad = "<?=$rowpro_['und']?>";
   if( document.form1.und.value != unidad ){ document.form1.checkbox.disabled 	= true;  
                                             document.form1.undprod.disabled 	= true;  
											 alert('Si desea agregar Subunidades Grabar primero los cambios');}
   else									   { document.form1.checkbox.disabled	= false;
                                             document.form1.undprod.disabled 	= false;  
   }
}

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

    
	var bad = "0";
	
	if(document.form1.codprod.value=="" && document.form1.codprod2.value=="" && document.form1.codprod3.value==""){
		bad="1";
	}else{
		if(document.form1.codprod.value!=""){
			bad = "1";
		}else{
			alert("Se debe ingresar el primer codigo anexo");
			return false;
		}
	}
	
	var mov 	= "<?=$mov; ?>";//validar si tiene movientos el producto
	var sub_uni = "<?=$sub_uni?>";//vaidar si la unidad tiene subunidades
	var accion 	= "<?='actualizar'; ?>";
	var uni     = "<?=$unipro?>";
	var nompro  = "<?=$nompro?>";
	
	//COMFIRMAR SI PRODUCTO TIENE MOVIMIENTOS
	if(  nompro != document.form1.nombre.value )
	{	if( mov == 'ok' && accion == 'actualizar' )
		{	if(confirm(" Este producto tiene movimientos desea grabar de todas maneras ? "))
			{  bad = "1";		}
			else{ return false; }
		}	
	}
	
	/*
	//CONFIRMA SI UNIDAD TIENE SUBUNIDADES y CAMBIAS LAS UNIDADES RAIZ
	if( uni != document.form1.und.value )
	{ 
		if( sub_uni == 'ok' && accion == 'actualizar' )	
		{   if(confirm('Esta UNIDAD tiene subunidades desea eliminar todas sus subunidades relacionadas a esta?'))
			{	bad = "1";		}
			else{ return false; }
		}
	}*/
		
	if( bad == "1" ){	return true; }
    else { return false ;}	
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
list($nomclas)=mysql_fetch_array(mysql_query("select des_clas from clasificacion where idclasificacion='".$clasificacion."'"));
$categoria=$row['categoria'];
list($nomcat)=mysql_fetch_array(mysql_query("select des_cat from categoria where idCategoria='".$categoria."'"));
$subcategoria=$row['subcategoria'];
list($nomsubcat)=mysql_fetch_array(mysql_query("select des_subcateg from subcategoria where idsubcategoria='".$subcategoria."'"));
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
$factorC=$row['factorCompra'];
$cuentacontable=$row['ccontable'];
$mostrar=$row['lista'];

}
//echo $afectoigv;
$disab_precep=" disabled='disabled' ";
	if($percepcion=='S'){
		$checkpercep=" checked='checked' ";
		$disab_precep=" ";
	}

 ?>
<script>
	function Salir(){
		window.parent.opener.cargarproducto('<?=$_REQUEST['pagina'];?>');close();
	}
</script>
<body onLoad="javascript:document.form1.nombre.focus()" >

<form action="" method="post"  name="form1" id="form1"  enctype="multipart/form-data" >

  <table width="624" height="347" border="0" cellpadding="0" cellspacing="0">
    
    <tr>
      <td width="17" height="19" bgcolor="#FAF3E2">&nbsp;</td>
      <td width="79" bgcolor="#FAF3E2"><span class="Estilo12">
        <input type="hidden" name="accion" id="accion" value="<?php echo $_REQUEST['accion']?>">
        <input type="hidden" name="pagina" value="<?php echo $_REQUEST['pagina']?>">
        <input type="hidden" name="nombre_" id="nombre_" value="<?=$rowpro_['nombre']?>">
      </span></td>
      <td width="197" bgcolor="#FAF3E2">&nbsp;</td>
      <td width="331" bgcolor="#FAF3E2">
	  
	    <table  style="background-color:#FFFFFF; display:none" width="204" height="178" border="1" cellpadding="0" cellspacing="0" >
          <tr>
            <td width="200" height="176" align="center">
			<div class="gallery">
				<a href="<?php echo $imagen1?>" rel="lightbox[sample]" title="<?php echo $nombre?>">
			<img src="<?php echo $imagen1?>" width="180" height="150"  style="border:#E9E9E9 solid 1px" /></a>			</div>			</td>
          </tr>
        </table>
      <span class="Estilo60" style="display:none">Clic en la imagen para aumentar de tama&ntilde;o </span></td>
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
      <td width="331" bgcolor="#FAF3E2">&nbsp;</td>
    </tr>
    <tr>
      <td height="24" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2"><span class="Estilo56">Cod.<?=$AnexNomEti1;?>: </span></td>
      <td colspan="2" bgcolor="#FAF3E2"><input name="codprod" type="text" value="<?php echo $codprod;?>" size="12" maxlength="25" onKeyUp="saltar_campo(event,this)">        <span class="Estilo56">Cod.
          <?=$AnexNomEti2;?>
      :
      <input name="codprod2" type="text" value="<?php echo $codprod2;?>" size="12" maxlength="25" onKeyUp="saltar_campo(event,this)">
        Cod.
        <?=$AnexNomEti3;?>
      :
      <input name="codprod3" type="text" value="<?php echo $codprod3;?>" size="12" maxlength="25" onKeyUp="saltar_campo(event,this)">
      </span></td>
    </tr>
    
    <tr>
      <td height="22" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2" class="Estilo56">Nombre:</td>
      <td colspan="2" bgcolor="#FAF3E2"><input name="nombre" type="text" value="<?php echo $nombre;?>" size="70" maxlength="200" /></td>
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
      <td width="331" bgcolor="#FAF3E2"><span class="Estilo56">Und. Principal
          <select name="und" id="und"  style="width:160px"  >
          <?php 	  
	   $resultados0 = mysql_query("select * from unidades order by descripcion ",$cn);
				while($row0=mysql_fetch_array($resultados0))
		{		
				if ($und==$row0['id']){
				echo '<option value="'.$row0['id'].'" selected  >'. $row0['descripcion'].' - '.$row0['nombre'].'</option>';
				}else{
							/*
							if ($b_uni==''){
							echo '<option value="'.$row0['id'].'" >'. $row0['descripcion'].' - '.$row0['nombre'].'</option>';
							}
							*/
							if ($row0['id']=='07' && $und=='' ){
							echo '<option value="'.$row0['id'].'"  selected>'. $row0['descripcion'].' - '.$row0['nombre'].'</option>';
							}else{
							echo '<option value="'.$row0['id'].'" >'. $row0['descripcion'].' - '.$row0['nombre'].'</option>';			
							}
							
				}
		}		
   ?>
        </select>
      </span></td>
    </tr>
    
    
    
    
    <tr>
      <td height="23" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2"><span class="Estilo56"><?=$CatgNomEti1;?></span></td>
      <td colspan="2" rowspan="4" bgcolor="#FAF3E2"><table width="504" border="0" cellpadding="0" cellspacing="0">
        
        <tr>
          <td height="24"><!--<select style="width:160px" name="clasificacion" >
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
          </select>-->
            <input name="txtclasificacion" type="text" id="txtclasificacion" onKeyUp="validartecla(event,this,'#auxiliares')" onFocus="validartecla(event,this,'#auxiliares')"  size="18" maxlength="50" autocomplete="off" value="<?php echo $nomclas //"contabilidad" ?>">
            <input name="hdclasificacion" type="hidden" id="hdclasificacion"  size="3" value="<?php echo $clasificacion ?>"/>		  </td>
            <td><span class="Estilo56">Factor Princ.
              <input name="factor" type="text" value="<?php echo $factor;?>" size="5" maxlength="10" />
            </span></td>
          </tr>
        <tr>
          <td width="200" height="24"><!--<select style="width:160px" name="combocategoria">
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
          </select>-->
            <input disabled="disabled" name="txtcategoria" type="text" id="txtcategoria" onKeyUp="validartecla(event,this,'#auxiliares')" onFocus="validartecla(event,this,'#auxiliares')"  size="18" maxlength="50" autocomplete="off" value="<?php echo "contabilidad" // $nomcat ?>"><input name="hdcategoria" type="hidden" id="hdcategoria"  value="<?php echo $categoria ?>" size="3"/></td>
            <td width="304"><span class="Estilo56" >Afecto IGV
                <input style="border:none; background:none" type="checkbox" name="afectoigv" value="checkbox" <?php if($afectoigv=='S' || $afectoigv==''  )echo "checked='checked'"?> >
&nbsp;&nbsp;</span><span class="Estilo56">&nbsp;</span><span class="Estilo56">&nbsp;</span><span class="Estilo56">&nbsp;</span><span class="Estilo56" disabled>Efecto en Kardex
<input style="border:none; background:none" type="checkbox" name="kardex" id="kardex" onClick="efecto_kardex(this)" value="checkbox" >
</span></td>
          </tr>
        <tr>
          <td height="26"><!--<select style="width:160px" name="combosubcategoria">
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
          </select>--><input disabled="disabled" name="txtsubcat" type="text" id="txtsubcat" onKeyUp="validartecla(event,this,'#auxiliares')" onFocus="validartecla(event,this,'#auxiliares')" onBlur="javascript:templ=0" size="18" maxlength="50" autocomplete="off" value="<?php echo "contabilidad" //$nomsubcat ?>"><input name="hdsubcat" type="hidden" id="hdsubcat"  value="<?php echo $subcategoria ?>" size="3"/></td>
            <td width="304"><span class="Estilo56">Cuenta Contable </span>
              <input type="text" name="cuentacontable" id="cuentacontable" value="<?php echo $cuentacontable?>"></td>
          </tr>
        <tr>
          <td height="26">&nbsp;</td>
          <td><span class="Estilo56">Mostrar en: 
              <select name="mostrar" >
              <option value="1" selected>Lista  Compras</option>
              <option value="2">Lista Ventas</option>
              <option value="3">Ambos</option>
            </select>
			<script>
	   var valor1="<?php echo $mostrar?>";
     var i;
	 for (i=0;i<document.form1.mostrar.options.length;i++)
        {
		
            if (document.form1.mostrar.options[i].value==valor1)
               {
			   
               document.form1.mostrar.options[i].selected=true;
               }
        
        }
	      </script>
          </span></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="22" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2"><span class="Estilo56"><?=$CatgNomEti2;?></span></td>
    </tr>
    <tr>
      <td height="19" rowspan="2" bgcolor="#FAF3E2">&nbsp;</td>
      <td height="20" bgcolor="#FAF3E2"><span class="Estilo56"><?=$CatgNomEti3;?></span></td>
    </tr>
    <tr>
      <td height="19" bgcolor="#FAF3E2">&nbsp;</td>
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
        <input type="button" name="Submit3" value="Salir" id="label"  onClick="Salir();"></td>
    </tr>
    
    
    <?php 

  
  ?>
    <tr>
      <td height="28" bgcolor="#FAF3E2">&nbsp;</td>
      <td colspan="3" align="center" bgcolor="#FAF3E2"><label for="Submit"></label></td>
    </tr>
    <tr>
      <td height="19" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2">&nbsp;</td>
      <td colspan="2" bgcolor="#FAF3E2">&nbsp;</td>
    </tr>
  </table>
</form>
  <div id="productos" style="position:absolute; left:22px; top:205px; width:300px; height:180px; z-index:1; visibility:hidden"> </div>
  
   <div id="auxiliares" style="position:absolute; left:100px; top:320px; width:300px; height:180px; z-index:2; visibility:hidden;"></div>
</body>

<script>


function grabar_prod(){
    if(validar(document.form1))
	{  document.form1.submit(); }

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