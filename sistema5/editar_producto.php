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
jQuery(temp).css("top","300px");
break;
case "txtcategoria":
var tipo="categoria";
jQuery(temp).css("top","320px");
break;
case "txtsubcat":
var tipo="subcategoria";
jQuery(temp).css("top","345px");
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
	switch(tipo){
		case "clasificacion":
		var txtn="txtclasificacion";
		var hdn="hdclasificacion";
		document.getElementById("txtcategoria").focus();
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
	var txtcla = document.getElementById(txtn);
	txtcla.value = valor;
	var hdcla = document.getElementById(hdn);
	hdcla.value = id;
	salir();

}
function salir(){
		jQuery("#auxiliares").css("visibility","hidden");
}

jQuery(document).bind('keydown', 'esc',function (evt){
salir_ventana();	
return false; });


jQuery(document).bind('keydown', 'f2',function (evt){
//alert();
grabar_prod()	
return false; });



	var sw=0;
jQuery(document).bind('keydown', 'down',function (evt){

 var tblres=document.getElementById('tblresultado');

 	if(document.getElementById('auxiliares').style.visibility=='visible'){
		for (var i=0 ; i<tblres.rows.length ; i++) { 
		
			//alert(tblres.rows[i].style.background);	
			if(tblres.rows[i].style.background == '#fff1bb' || tblres.rows[i].style.background == 'rgb(255, 241, 187)' && (i<tblres.rows.length-1)){
				tblres.rows[i].style.background = '#ffffff';
				tblres.rows[i+1].style.background = '#fff1bb';
				sw = i;
				break;	
			}
		}
		for (var i=0;i<tblres.rows.length;i++) {
			if(sw == i && (i<tblres.rows.length-1)){
				tblres.rows[i].style.background='#ffffff';
				tblres.rows[i+1].style.background='#fff1bb';
				sw=i;
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
			if(i>0 && tblres.rows[i].style.background=='#fff1bb' || tblres.rows[i].style.background == 'rgb(255, 241, 187)' && (i!=tblres.rows.length)){
			
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
	var tblres = document.getElementById('tblresultado');
	if(document.getElementById('auxiliares').style.visibility=='visible'){
		for (var i=0;i<tblres.rows.length;i++) { 

			if(tblres.rows[i].style.background == '#fff1bb' || tblres.rows[i].style.background	 == 'rgb(255, 241, 187)' ){

				var temp = tblres.rows[i].cells[0].innerHTML;
				var temp1 = tblres.rows[i].cells[1].innerHTML;

				var tip = jQuery('#tblresultado').attr('name');
				asignar(tip,temp,temp1);
			}
		}
	}
	return false; 
});

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
		theme_advanced_buttons1 : "cut,copy,paste,|,search,replace,|,bullist,numlist,|,undo,redo",
		theme_advanced_buttons2 :"|,bold,italic,underline|,justifyleft,justifycenter,justifyright,justifyfull,|,sub,sup,|,fullscreen",
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
$nombre=apostrofe($_REQUEST['nombre']);
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
$garantia=$_REQUEST['garantia'];
$puntos=$_REQUEST['puntos'];
$puntos2=$_REQUEST['puntos2'];
$efectivo=$_REQUEST['efectivo'];
$campo_imp=$_REQUEST['campo_imp'];


//$oferta=$_REQUEST['oferta'];
$baja='N';
if($_REQUEST['baja']=='baja'){
$baja='S';
}


$moneda=$_REQUEST['moneda'];
$afectoigv='N';
$kardex='N';
$series='N';
$percepcion='N';
$oferta='N';
$lotes='N';

if($_REQUEST['oferta']!=""){
$oferta='S';
}
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
if($_REQUEST['canje']!=""){
$canje='S';
}
if($_REQUEST['ccajas']!=""){
$ccajas='S';
}

if($_REQUEST['chkmodelo']!=""){
$modelo='S';
}

if($_REQUEST['chkLotes']!=""){
$lotes='S';
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
	
	$resultados233 = mysql_query("select * from producto where nombre='".$nombre."' and idproducto!='$cod'  ",$cn);
	
	//$row20=mysql_fetch_array($resultados20);
	$temp4=mysql_num_rows($resultados233);
	

//echo "select * from producto where cod_prod='".$codprod."'";
//----------------------------iamgenes-----------------------------
$fileName = $_FILES['userfile']['name'];
$tmpName  = $_FILES['userfile']['tmp_name'];

$nombre_archivo = "imagenes/productos/".$_FILES['userfile']['name'];
//echo $temp.$temp2.$temp3;
if($temp==0){
if($temp2==0){
if($temp3==0){
if($temp4==0){
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
	
	  $strSQL2="update producto set nombre='" . $nombre . "',precio='" . $precio ."',precio2='" . $precio2 ."',precio3='" . $precio3 ."',precio4='" . $precio4 ."',precio5='" . $precio5 ."',und='" . str_pad($und,"2","0",STR_PAD_LEFT) . "',factor='" . $factor . "',cod_prod='" . $codprod .  "',codanex2='" . $codprod2 .  "',codanex3='" . $codprod3 .  "',clasificacion='" . $clasificacion . "',categoria='" . $categoria . "',subcategoria='" . $subcategoria . "',enlace='" . $enlace . "',igv='" . $afectoigv . "',kardex='" . $kardex . "'  ,moneda='" . $moneda . "',datos='".$caracteristicas."',series='".$series."',garantia='".$garantia."',agente_percep='".$percepcion."',valor_percep='".$valor_percep."' ,factorCompra ='".$factorC."',oferta ='".$oferta."',canje ='".$canje."',puntos ='".$puntos."',efectivo ='".$efectivo."',puntos2 ='".$puntos2."',ccajas ='".$ccajas."',baja ='".$baja."',campo_imp='".$campo_imp."',modelo='".$modelo."',lotes ='".$lotes."'  where idProducto='" . $cod . "'";	
	
	//$strSQL2=mysql_real_escape_string($strSQL2); 
	
	
	//echo $strSQL2;
    mysql_query($strSQL2);
	
		//---------------------stock minimo portienda-----------------------

if(isset($_REQUEST['codtienda'])){
	$codtienda=$_REQUEST['codtienda'];
	$stockMin=$_REQUEST['stockMinxTienda'];
	
	foreach($codtienda as $key => $value){
		$strSQL24="select * from stockmintienda where producto='".$cod."' and tienda='".$codtienda[$key]."' ";
		$resultado24=mysql_query($strSQL24,$cn);
		$cont24=mysql_num_rows($resultado24);
		
		if($cont24==0){
		$str24="insert into stockmintienda(producto,tienda,stockmin) values('".$cod."','".$codtienda[$key]."','".$stockMin[$key]."')";
		}else{
		$str24="update stockmintienda set stockmin='".$stockMin[$key]."' where producto='".$cod."' and tienda='".$codtienda[$key]."'";
		}
		//echo $str24."<br>";
		mysql_query($str24,$cn);
	}
	
}


//--------------------------------------------
	
	
echo "<script>window.parent.opener.cargarproducto('".$_REQUEST['pagina']."');close();</script>";//
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
		
		//verifica codigo vacios---------	
			$resultados2rX = mysql_query("select * from producto order by idproducto ",$cn);
			$roxcountX=mysql_num_rows($resultados2rX);			
			
			for ($i = 1; $i <= $roxcountX; $i++) {
			$codT=str_pad($i, 6, "0", STR_PAD_LEFT);
				if ($stop==''){	
				$rt = mysql_query("select * from producto where idproducto='".$codT."' ",$cn);
				$row2rt=mysql_fetch_array($rt);
				$roxT=mysql_num_rows($rt);				
					if ($roxT==0){
						$cod=$codT; 
						$stop='SI'; 
					}
				}
			}
				//verifica codigo vacios fin	
	
		//--------------------------------------------------------------------------	
									
			$strSQL2= "insert into producto (idproducto,clasificacion,categoria,subcategoria,cod_prod,codanex2,codanex3,nombre,precio,precio2,precio3,precio4,precio5,und,factor,imagen,enlace,igv,kardex,moneda,datos,series,garantia,agente_percep,valor_percep,oferta,canje,puntos,efectivo,puntos2,ccajas,baja,campo_imp,modelo,lotes) values ('".$cod."','".$clasificacion."','".$categoria."','".$subcategoria."','".$codprod."','".$codprod2."','".$codprod3."','".$nombre."','".$precio."','".$precio2."','".$precio3."','".$precio4."','".$precio5."','".$und."','".$factor."','".$imagen1."','".$enlace."','".$afectoigv."','".$kardex."','".$moneda."','".$caracteristicas."','".$series."','".$garantia."','".$percepcion."','".$valor_percep."','".$oferta."','".$canje."','".$puntos."','".$efectivo."','".$puntos2."','".$ccajas."','".$baja."','".$campo_imp."','".$modelo."','".$lotes."')";
		
			
			//echo $strSQL2;
		mysql_query($strSQL2);
		
			//---------------------stock minimo portienda-----------------------
		
		if(isset($_REQUEST['codtienda'])){
			$codtienda=$_REQUEST['codtienda'];
			$stockMin=$_REQUEST['stockMinxTienda'];
			
			foreach($codtienda as $key => $value){
				$strSQL24="select * from stockmintienda where producto='".$cod."' and tienda='".$codtienda[$key]."' ";
				$resultado24=mysql_query($strSQL24,$cn);
				$cont24=mysql_num_rows($resultado24);
				
				if($cont24==0){
				$str24="insert into stockmintienda(producto,tienda,stockmin) values('".$cod."','".$codtienda[$key]."','".$stockMin[$key]."')";
				}else{
				$str24="update stockmintienda set stockmin='".$stockMin[$key]."' where producto='".$cod."' and tienda='".$codtienda[$key]."'";
				}
				//echo $str24."<br>";
				mysql_query($str24,$cn);
			}
			
		}
		
		
		//--------------------------------------------
		
						
		
		 echo "<script>window.parent.opener.cargarproducto('".$_REQUEST['pagina']."');close();</script>";//

   }
   
   // echo $strSQL2;
   }else{
 
  echo "<script>alert('El nombre del producto ya está en uso');</script>";
 } 
   }else{
 
  echo "<script>alert('El codigo ".$AnexNomEti1." ya está en uso');</script>";
 } 
   }else{
 
  echo "<script>alert('El codigo ".$AnexNomEti2." ya está en uso');</script>";
 } 
 }else{
 
  echo "<script>alert('El codigo ".$AnexNomEti3." ya está en uso');</script>";
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
	//var nompro  = "<?php //$nompro ?>";
	
	//COMFIRMAR SI PRODUCTO TIENE MOVIMIENTOS
	//if(  nompro != document.form1.nombre.value )
	//{
		if( mov == 'ok' && accion == 'actualizar' )
		{	if(confirm(" Este producto tiene movimientos desea grabar de todas maneras ? "))
			{  bad = "1";		}
			else{ return false; }
		}	
	//}
	
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
//$nombre=str_replace('"',"''",$row['nombre']);

$nombre=str_replace('"',"&#34;",$row['nombre']);
//$nombre=$row['nombre'];
$codprod=$row['cod_prod'];
$codprod2=$row['codanex2'];
$codprod3=$row['codanex3'];
$precio=$row['precio'];
$precio2=$row['precio2'];
$precio3=$row['precio3'];
$precio4=$row['precio4'];
$precio5=$row['precio5'];
$puntos=$row['puntos'];

$clasificacion=$row['clasificacion'];
list($nomclas)=mysql_fetch_array(mysql_query("select des_clas from clasificacion where idclasificacion='".$clasificacion."'"));
$categoria=$row['categoria'];
list($nomcat)=mysql_fetch_array(mysql_query("select des_cat from categoria where idCategoria='".$categoria."'"));
$subcategoria=$row['subcategoria'];
list($nomsubcat)=mysql_fetch_array(mysql_query("select des_subcateg from subcategoria where idsubcategoria='".$subcategoria."'"));
//echo "select des_subcateg from subcategoria where idsubcategoria='".$subcategoria."'";
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
$oferta=$row['oferta'];
$canje=$row['canje'];
$puntos=$row['puntos'];
$puntos2=$row['puntos2'];
$efectivo=$row['efectivo'];
$ccajas=$row['ccajas'];
$campo_imp=$row['campo_imp'];
$modelo=$row['modelo'];
$lotes=$row['lotes'];
$baja=$row['baja'];

}


if($modelo=='S'){
		$checkmodelo="checked='checked'";
}

//echo $afectoigv;
$disab_precep=" disabled='disabled' ";
	if($percepcion=='S'){
		$checkpercep=" checked='checked' ";
		$disab_precep=" ";
	}
 //echo $oferta;
 ?>
 
<script>
	function Salir(){
		window.parent.opener.cargarproducto('<?=$_REQUEST['pagina'];?>');close();
	}
</script>
<body onLoad="javascript:document.form1.nombre.focus()" >

<form action="" method="post"  name="form1" id="form1"  enctype="multipart/form-data" >

  <table width="624" height="602" border="0" cellpadding="0" cellspacing="0">
    
    <tr>
      <td width="17" height="19" bgcolor="#FAF3E2">&nbsp;</td>
      <td width="79" bgcolor="#FAF3E2">&nbsp;</td>
      <td width="231" bgcolor="#FAF3E2"><span class="Estilo12">
        <input type="hidden" name="accion" id="accion" value="<?php echo $_REQUEST['accion']?>">
        <input type="hidden" name="pagina" value="<?php echo $_REQUEST['pagina']?>">
         <input type="hidden" name="nombre_" id="nombre_" value="<?=$rowpro_['nombre']?>">
	  </span></td>
      <td width="297" rowspan="8" bgcolor="#FAF3E2">
	  
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
      <td bgcolor="#FAF3E2"><span class="Estilo56">C&oacute;digo</span></td>
      <td bgcolor="#FAF3E2"><span class="Estilo12" style="color:#0066FF"><strong><?php echo $cod;?>
        </strong>
        <input type="hidden" name="cod" id="cod" value="<?php echo $cod;?>">
        <input type="hidden" name="subcat" id="subcat" value="<?php echo $subcategoria;?>">
		<input type="hidden" name="cat" id="cat" value="<?php echo $categoria;?>">
      </span></td>
    </tr>
    <tr>
      <td height="24" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2"><span class="Estilo56">Cod.<?=$AnexNomEti1;?>: </span></td>
      <td bgcolor="#FAF3E2"><input name="codprod" type="text" value="<?php echo $codprod;?>" size="30" maxlength="25" onKeyUp="saltar_campo(event,this)"></td>
    </tr>
    <tr>
      <td height="22" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2"><span class="Estilo56">Cod.<?=$AnexNomEti2;?>:</span></td>
      <td bgcolor="#FAF3E2"><input name="codprod2" type="text" value="<?php echo $codprod2;?>" size="30" maxlength="25" onKeyUp="saltar_campo(event,this)"></td>
    </tr>
    <tr>
      <td height="21" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2"><span class="Estilo56">Cod.<?=$AnexNomEti3;?>:</span></td>
      <td bgcolor="#FAF3E2"><input name="codprod3" type="text" value="<?php echo $codprod3;?>" size="30" maxlength="130" onKeyUp="saltar_campo(event,this)"></td>
    </tr>
    <tr>
      <td height="22" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2" class="Estilo56">Nombre:</td>
      <td bgcolor="#FAF3E2"><input name="nombre" type="text" value="<?php echo $nombre;?>" size="30" maxlength="200" onKeyUp="saltar_campo(event,this)"/></td>
    </tr>
    <tr>
      <td height="30" bgcolor="#FAF3E2">&nbsp;</td>
      <td colspan="2" bgcolor="#FAF3E2" class="Estilo56">
	  
	  <span class="Estilo56">Campo de Impresi&oacute;n: </span>   
	  <select name="campo_imp">   
	 
		  <option value="nombre" selected>nombre</option>
          <option value="cod_prod">cod. anexo 1</option>
          <option value="codanex2">cod. anexo 2</option>
          <option value="codanex3">cod. anexo 3</option>
		  	  <script>
	   var valor1="<?php echo $campo_imp?>";
     var i;
	 for (i=0;i<document.form1.campo_imp.options.length;i++)
        {
		
            if (document.form1.campo_imp.options[i].value==valor1)
               {
			   
               document.form1.campo_imp.options[i].selected=true;
               }
        
        }
	        </script>
        </select>
	  </td>
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
            <td width="10%" ><input style="text-align:right" name="precio" type="text" value="<?php if($precio==''){echo "0.00";}else{ echo $precio;} ?>" size="4" maxlength="10"  onKeyDown="validarNumero(this,event)" onKeyUp="saltar_campo(event,this)"/></td>
            <td width="40%"><span class="Estilo60">
              &nbsp;
              <?=$PrecNomEti2;?>
            </span></td>
            <td width="10%"><input style="text-align:right" name="precio2" type="text" value="<?php echo $precio2 ?>" size="4" maxlength="10" onKeyDown="validarNumero(this,event)" onKeyUp="saltar_campo(event,this)"/></td>
          </tr>
          <tr>
            <td><span class="Estilo60">
            <?=$PrecNomEti3;?>
            </span></td>
            <td><input style="text-align:right" name="precio3" type="text" value="<?php echo $precio3 ?>" size="4" maxlength="10" onKeyDown="validarNumero(this,event)" onKeyUp="saltar_campo(event,this)"/></td>
            <td><span class="Estilo60">&nbsp;
              <?=$PrecNomEti4;?>
            </span></td>
            <td><input style="text-align:right" name="precio4" type="text" value="<?php echo $precio4 ?>" size="4" maxlength="10" onKeyDown="validarNumero(this,event)" onKeyUp="saltar_campo(event,this)"/></td>
          </tr>
          <tr>
            <td><span class="Estilo60">
              <?=$PrecNomEti5;?>
            </span></td>
            <td><input style="text-align:right" name="precio5" type="text" value="<?php echo $precio5 ?>" size="4" maxlength="10" onKeyDown="validarNumero(this,event)" onKeyUp="saltar_campo(event,this)"/></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
	  </fieldset>         </td>
    </tr>
    <tr>
      <td height="22" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2" class="Estilo56">Moneda</td>
      <td bgcolor="#FAF3E2" class="Estilo12"><select name="moneda" onKeyUp="saltar_campo(event,this)">
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
      <td  width="297" bgcolor="#FAF3E2"><input type="file" name="userfile" id="userfile" onKeyUp="saltar_campo(event,this)">
        <span class="Estilo60">
        <input type="hidden" name="imagen1" value="<?php echo $imagen1;?>">
      </span> </td>
    </tr>
    
    <tr>
      <td height="23" bgcolor="#FAF3E2">&nbsp;</td>
      <td bgcolor="#FAF3E2"><span class="Estilo56">Und. Principal </span></td>
      <td colspan="2" bgcolor="#FAF3E2">
	  <select name="und" id="und" onChange="validarSubunidad()" style="width:160px" onKeyUp="saltar_campo(event,this)">
	  <?php 	  
	   $resultados0 = mysql_query("select * from unidades order by descripcion ",$cn);
				while($row0=mysql_fetch_array($resultados0))
		{		
			
				if ($und==$row0['id']){
				echo '<option value="'.$row0['id'].'" selected  >'. $row0['descripcion'].' - '.$row0['nombre'].'</option>';
				}else{
							if ($row0['id']=='07' && $und=='' ){
							echo '<option value="'.$row0['id'].'"  selected>'. $row0['descripcion'].' - '.$row0['nombre'].'</option>';
							}else{
							echo '<option value="'.$row0['id'].'" >'. $row0['descripcion'].' - '.$row0['nombre'].'</option>';			
							}
				}
				
		}		
   ?>
      </select>
	       
	   <span class="Estilo56">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Agente de Percepciones: 
	      <input <?php echo $checkpercep?> onClick="activar_percep(this)" style="border:none; background:none" type="checkbox" name="chk_percep" value="checkbox" onKeyUp="saltar_campo(event,this)">
          <input <?php echo $disab_precep; ?> style="text-align:right" name="valor_percep" id="valor_percep" type="text" size="8" maxlength="6"  value="<?php echo number_format($valor_percep,2)?>" onKeyUp="saltar_campo(event,this)">
       %</span></td>
    </tr>
    <tr>
      <td height="22" bgcolor="#FAF3E2">&nbsp;</td>
      <td colspan="3" rowspan="4" bgcolor="#FAF3E2"><table width="592" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><span class="Estilo56">Factor Princ. </span></td>
            <td height="24"><input name="fctor" type="text" value="<?php echo $factor;?>" size="5" maxlength="10" onKeyUp="saltar_campo(event,this)" />
              <span class="Estilo56">Factor Comp. </span>
            <input name="factorC" type="text" value="<?php echo $factorC;?>" size="5" maxlength="10" onKeyUp="saltar_campo(event,this)" />		  </td>
		    <?php 
		  
		  if($_SESSION['manejaSubunidad']=='N'){
		  $verSubunidad=" style='visibility:hidden' ";
		  }else{
		  $verSubunidad=" style='visibility:visible' ";
		  }
		  
		  ?>
          
          <td width="329" colspan="3" ><span class="Estilo56" <?php echo $verSubunidad?>>Sub-Unidad
            <?php 
		$btn=" disabled='disabled'";
		if($subunidad=='S'){
		$check="checked='checked'";
		$btn="";
		}		
		if($series=='S'){
		$checkseries="checked='checked'";
		}
		if($canje=='S'){
		$checkcanje="checked='checked'";
		}
		if($lotes=='S'){
		$checkLotes="checked='checked'";
		}	
		
				
		?>
            <!--8872.5254
		
		-->
            
            <input  style="border:none; background:none" type="checkbox" <?php echo $check;?> id="checkbox"  name="checkbox" value="checkbox" onClick="activar_cbo(this)" onKeyUp="saltar_campo(event,this)">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button onClick="abrir_subund()" <?php echo $btn;?> type="button" id="undprod" name="undprod" style="height:20; width:160px; font-size:11px" >Unidades por Producto</button>
            </span></td>
          </tr>
        <tr>
          <td><span class="Estilo56">
            <?=$CatgNomEti1;?>
            </span></td>
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
              <input name="txtclasificacion" type="text" id="txtclasificacion" onKeyUp="validartecla(event,this,'#auxiliares'); saltar_campo(event,this)" onFocus="validartecla(event,this,'#auxiliares')"  size="18" maxlength="50" autocomplete="off" value="<?php echo $nomclas ?>">
            <input name="hdclasificacion" type="hidden" id="hdclasificacion"  size="3" value="<?php echo $clasificacion ?>" onKeyUp="saltar_campo(event,this)"/>		  </td>
            <td colspan="3"><span class="Estilo56" >Afecto IGV
              <input style="border:none; background:none" type="checkbox" name="afectoigv" value="checkbox" <?php if($afectoigv=='S' || $afectoigv==''  )echo "checked='checked'"?> onKeyUp="saltar_campo(event,this)">
              &nbsp;&nbsp;</span><span class="Estilo56">&nbsp;</span><span class="Estilo56">Efecto en Kardex
              <input style="border:none; background:none" type="checkbox" name="kardex" id="kardex" onClick="efecto_kardex(this)" value="checkbox" <?php if($kardex=='S' || $afectoigv=='' )echo "checked='checked'"?> onKeyUp="saltar_campo(event,this)">
              Oferta
              <input style="border:none; background:none" type="checkbox" name="oferta" id="oferta" onClick="" value="checkbox" <?php if($oferta=='S' || $oferta=='' )echo "checked='checked'"?> onKeyUp="saltar_campo(event,this)">
            </span></td>
          </tr>
        <tr>
          <td width="83"><span class="Estilo56">
            <?=$CatgNomEti2;?>
            </span></td>
            <td width="180" height="24"><!--<select style="width:160px" name="combocategoria">
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
              <input name="txtcategoria" type="text" id="txtcategoria" onKeyUp="validartecla(event,this,'#auxiliares'); saltar_campo(event,this)" onFocus="validartecla(event,this,'#auxiliares')"  size="18" maxlength="50" autocomplete="off" value="<?php echo $nomcat ?>">
            <input name="hdcategoria" type="hidden" id="hdcategoria"  value="<?php echo $categoria ?>" size="3" onKeyUp="saltar_campo(event,this)"/></td>
		    
		  
		    <?php 
		  
		  if($_SESSION['manejaSerie']=='N'){
		  $verSeries=" style='visibility:hidden' ";
		  }else{
		  $verSeries=" style='visibility:visible' ";
		  }
		  
		  ?>
          <td colspan="3"><span class="Estilo56"  <?php echo $verSeries?>>Series
            <input <?php echo $checkseries?> style="border:none; background:none" type="checkbox" name="chkseries" value="checkbox"  onClick="efecto_kardex(this)" id="chkseries" onKeyUp="saltar_campo(event,this)">
            Garantia: 
            <select name="garantia" onKeyUp="saltar_campo(event,this)">
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
            
                   
            </span>
			
			 <span class="Estilo56">&nbsp;&nbsp;&nbsp;Dar  Baja
           <input type="checkbox" name="baja" id="baja" value="baja" style="background:none; border:none" <?php if($baja=='S')echo "checked='checked'"?>>
           </span>		
			
			
			</td>
          </tr>
        <tr>
          <td><span class="Estilo56">
            <?=$CatgNomEti3;?>
            </span></td>
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
          </select>--><input name="txtsubcat" type="text" id="txtsubcat" onKeyUp="validartecla(event,this,'#auxiliares'); saltar_campo(event,this)" onFocus="validartecla(event,this,'#auxiliares')" onBlur="javascript:templ=0" size="18" maxlength="50" autocomplete="off" value="<?php echo $nomsubcat ?>"><input name="hdsubcat" type="hidden" id="hdsubcat"  value="<?php echo $subcategoria ?>" size="3"/></td>
            <td colspan="3"><span class="Estilo56">Enlace</span>
              <input value="<?php echo $enlace?>" name="enlace" type="text" size="30" maxlength="250" onKeyUp="saltar_campo(event,this)"></td>
          </tr>
        <tr>
          <td  colspan="2">Descripcion</td>
            <td colspan="3">
			
			<?php if($_SESSION['modulopuntos']=='S'){?>
              <table style="border:#D1D1D1 solid 1px" width="282" height="44" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="68" rowspan="2"><span class="Estilo56">Canje
                    <input <?php echo $checkcanje ?> style="border:none; background:none" type="checkbox" name="canje" value="checkbox"   id="canje" >
                  </span></td>
                  <td width="105" align="center"><span class="Estilo56">Solo Puntos: </span></td>
                  <td width="107" align="center"><span class="Estilo56">Puntos y Efectivo </span></td>
                </tr>
                <tr>
                  <td align="center"><span class="Estilo56">
                    <input name="puntos" id="puntos" type="text" value="<?php echo $puntos ?>" size="5" maxlength="10" />
                  </span></td>
                  <td align="center"><span class="Estilo56">
                    <input name="puntos2" id="puntos2" type="text" value="<?php echo $puntos2 ?>" size="5" maxlength="10" />
                    <input name="efectivo" id="efectivo" type="text" value="<?php echo $efectivo ?>" size="5" maxlength="10" />
                  </span></td>
                </tr>
              </table>
			  <?php }else{ ?>
			  
			  <span class="Estilo56" >Control de Envases
              <input style="border:none; background:none" type="checkbox" name="ccajas" value="checkbox" <?php if($ccajas=='S' )echo "checked='checked'"?> ></span>
			  	  
			  <?php }?>
			  
			  <span class="Estilo56" style="visibility:visible">Modelo 
		  <input <?php echo $checkmodelo ?> style="border:none; background:none" type="checkbox" name="chkmodelo" value="checkbox"   id="chkmodelo"  onClick="validarChkKardex(this)">
		  </span>			  
		  
		    <span class="Estilo56"  <?php echo $verLotes?>>Lotes
            <input <?php echo $checkLotes?> style="border:none; background:none" type="checkbox" name="chkLotes" value="checkbox"  onClick="" id="chkLotes" onKeyUp="saltar_campo(event,this)">
            </span>
			
		  </td>
          </tr>
        
      </table></td>
    </tr>
    
    
    <tr>
      <td height="26" bgcolor="#FAF3E2">&nbsp;</td>
    </tr>
    <tr>
      <td height="19" bgcolor="#FAF3E2">&nbsp;</td>
    </tr>
    <tr>
      <td height="80" bgcolor="#FAF3E2">&nbsp;</td>
    </tr>
    
    <tr>
      <td height="28" bgcolor="#FAF3E2">&nbsp;</td>
      <td colspan="3" bgcolor="#FAF3E2"><table width="598" border="0" cellpadding="0" cellspacing="0">
        
        <tr>
          <td width="287"><textarea id="caracteristicas" name="caracteristicas" cols="32" rows="4" style="width:80%"><?php echo $caracteristicas?></textarea></td>
          <td width="311" valign="top">
		  
		  <div style="overflow-y:scroll; height:150px">
		    <table width="304" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="21" colspan="2"><span class="Estilo62">Reposici&oacute;n de Stock x Tienda </span></td>
                </tr>
              <tr>
                <td width="255" height="21" bgcolor="#A8F2CF"><span class="Estilo56">Tienda</span></td>
                <td width="60" bgcolor="#A8F2CF"><span class="Estilo56">Stock Min. </span></td>
              </tr>
              <?php 
			$strSQL22="select * from tienda order by des_tienda";
			$resultado22=mysql_query($strSQL22,$cn);
			while($row22=mysql_fetch_array($resultado22)){
			
		
			?>
              <tr>
                <td bgcolor="#FFFFFF"><span class="Estilo63"><?php echo $row22['des_tienda'] ?>
                  <input name="codtienda[]" type="hidden" id="codtienda" size="3" value="<?php echo $row22['cod_tienda']?>">
                </span></td>
                <td align="center" bgcolor="#FFFFFF">
				
				
				<?php 
				$strSQL23="select * from stockmintienda  where  producto='".$cod."' and tienda='".$row22['cod_tienda'] ."' ";
				$resultado23=mysql_query($strSQL23,$cn);
				$row23=mysql_fetch_array($resultado23);
				
				
				?>
				
				<input name="stockMinxTienda[]" id="stockMinxTienda" type="text" size="4" value="<?php echo $row23['stockmin'] ?>">				</td>
              </tr>
              <?php } ?>
            </table>
		  </div>
		  </td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="28" colspan="4" align="center" bgcolor="#FAF3E2">
	  <input onClick="grabar_prod()" type="button" name="Submit" value="Grabar [F2]" id="Submit"  >
        <input type="button" name="Submit2" value="Cancelar [Esc]" onClick="salir_ventana();">
        <label for="label"></label>
      <!--  <input type="button" name="Submit3" value="Salir" id="label"  onClick="Salir();">--></td>
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
  <div id="productos" style="position:absolute; left:22px; top:205px; width:300px; height:180px; z-index:1; visibility:hidden"> </div>
  
   <div id="auxiliares" style="position:absolute; left:224px; top:302px; width:300px; height:180px; z-index:2; visibility:hidden;"></div>
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
		if(control.name=="nombre"){
		document.form1.precio.focus();
		}
		if(control.name=="precio"){
		document.form1.precio2.focus();
		}
		if(control.name=="precio2"){
		document.form1.precio3.focus();
		}
		if(control.name=="precio3"){
		document.form1.precio4.focus();
		}
		if(control.name=="precio4"){
		document.form1.precio5.focus();
		}
		if(control.name=="precio5"){
		document.form1.moneda.focus();
		}
		if(control.name=="moneda"){
		document.form1.und.focus();
		}
		if(control.name=="und"){
		document.form1.factor.focus();
		}
		if(control.name=="factor"){
		document.form1.factorC.focus();
		}
		if(control.name=="factorC"){
		document.form1.txtclasificacion.focus();
		}
		if(control.name=="txtclasificacion"){
		document.form1.txtcategoria.focus();
		}
		if(control.name=="txtcategoria"){
		document.form1.txtsubcat.focus();
		}
		if(control.name=="txtsubcat"){
		document.form1.userfile.focus();
		}
		if(control.name=="userfile"){
		document.form1.chk_percep.focus();
		}
		if(control.name=="chk_percep"){
		document.form1.valor_percep.focus();
		}
		if(control.name=="valor_percep"){
		document.form1.afectoigv.focus();
		}
		if(control.name=="afectoigv"){
		document.form1.kardex.focus();
		}
		if(control.name=="kardex"){
		document.form1.oferta.focus();
		}
		if(control.name=="oferta"){
		document.form1.chkseries.focus();
		}
		if(control.name=="chkseries"){
		document.form1.garantia.focus();
		}
		if(control.name=="garantia"){
		document.form1.enlace.focus();
		}
		if(control.name=="enlace"){
			tinyMCE.get('caracteristicas').focus()
		}
	}

	return false;
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


function validarChkKardex(obj){

	if(document.form1.kardex.checked && obj.checked){
	alert("Un modelo no debe tener efecto en kardex");
	obj.checked=false;
	}


}

</script>

</html>
<form name="form2" action="productos.php" method="get" target="principal"></form>