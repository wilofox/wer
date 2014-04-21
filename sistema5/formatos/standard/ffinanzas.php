<?php 

session_start();

include ('../../conex_inicial.php');
include('../../numero_letras.php');
//include('../../funciones/funciones.php');


$empresa =  $_REQUEST['empresa'];
$tipo = "3";
$doc = $_REQUEST['doc'];
$serie = $_REQUEST['serie'];
$numero = $_REQUEST['numero'];

	if(isset($_REQUEST['codigo'])){
		$tabla=$_REQUEST['tabla'];
		switch($tabla){
			case 'letra':$strcab = "select md.*,mc.cod_suc as sucursal,md.banco_id as banco from multi_det md inner join multicj mc on mc.multi_id=md.multi_id where md.det_id='".$_REQUEST['codigo']."' " ;
				//$strcab = "select md.* where md.det_id='".$_REQUEST['codigo']."' " ;break;
				$resultado	=   mysql_query($strcab,$cn);
				$row		=   mysql_fetch_array($resultado);	
				$empresa 	=  	$row['sucursal'];
				$doc	 	=  	$row['cod_letra'];
				//$serie 	 	=  	$row['serie'];
				$numero  	=  	$row['letra'];break;
			case 'cheque':$strcab = "select pg.numero as numero,pg.fechavenc as fechavenc,pg.importe as importe,pg.observaciones as observaciones,tp.codigo as codigo,tp.descripcion as descripcion,cl.razonsocial as razonsocial,s.des_suc as sucursal ";
			//$strcab = "select sucursal,cuenta,numero,proveedor,fechavenc,importe,observaciones,tipo from progpagos where id='".$_REQUEST['codigo']."'";break;
			case 'efectivo':$strcab = "select * from pagos where id ='".$_REQUEST['codigo']."' " ;
				$resultado	=   mysql_query($strcab,$cn);
				$row		=   mysql_fetch_array($resultado);	
				//$empresa 	=  	$row['sucursal'];
				$doc	 	=  	$row['t_pago'];
				//$serie 	 	=  	$row['serie'];
				$numero  	=  	$row['numero'];break;
		}
	//$strcab		= 	"select * from cab_mov where cod_cab='".$_REQUEST['codcab']."' " ;
	
	/*$resultado	=   mysql_query($strcab,$cn);
	$row		=   mysql_fetch_array($resultado);	
	$empresa 	=  	$row['sucursal'];
	$doc	 	=  	$row['cod_ope'];
	$serie 	 	=  	$row['serie'];
	$numero  	=  	$row['Num_doc'];*/
	}

function extraefecha4($valor){
$afecha=explode('-',trim($valor));
$afecha2=explode(' ',trim($afecha[2]));
$nfecha=$afecha2[0]."/".$afecha[1]."/".$afecha[0] ;
return $nfecha;
}

function caracteres($text){
  // this function will intially be used to implement underlining support, but could be used for a range of other
  // purposes
  //echo $text;
  $search = array('á','é','í','ó','ú','Ñ','?','ñ','°','Á','É','Í','Ó','Ú');
 // $search = array('','','','','','','?');
  $replace = array('&#225;','&#233;','&#237;','&#243','&#250;','&#209;','&#63;','&#241;','&#176;','&#193;','&#201;','&#205;','&#211;','&#218;');
   //&#209;
  //$tempcaract=str_replace($search,$replace,$text);
 //echo  $tempcaract;
  return str_replace($search,$replace,$text);
  // unset($search);
   //unset($replace);
   //htmlspecialchars
   
   
   // javascript unicode
   //-------------------------------
   //\u00e1---->á
   //\u00e9---->é
   //\u00ed---->í
   //\u00f3---->ó
   //\u00efa---->ú
   //\u00ef1---->ñ
   //-------------------------------
   //return utf8_encode($text);
 
}

$tabla=$_REQUEST['tabla'];
switch($tabla){
	case 'letra': $strSQL= "select md.*,mc.numcje as numerocj,mc.estado as estado,mc.codvendedor as codvendedor,mc.cod_suc as sucursal,mc.fecha as fecha,md.banco_id as banco,mc.cliente as cliente from multi_det md inner join multicj mc on mc.multi_id=md.multi_id where mc.cod_suc='$empresa' and md.cod_letra='$doc' and md.letra='$numero'";break;
	case 'efectivo': $ver=mysql_fetch_array(mysql_query("Select refer_letra from pagos where id='".$_REQUEST['codigo']."'",$cn));
	if($ver[0]!=""){
		$strSQL="Select pa.fecha as fechapx,pa.id as det_id, pa.cod_user as codvendedor, mc.cod_suc as sucursal,mc.cliente as cliente,GROUP_CONCAT(concat(c.cod_ope,' ',c.serie,'-',c.Num_doc) ORDER BY c.cod_cab ASC SEPARATOR '||') as docsx,if(md.numbco!='',md.numbco,md.letra) as numerolet,pa.*,mc.fecha as fechal,md.fechavcto as fechavcto from pagos pa inner join multi_det md on md.det_id=pa.refer_letra inner join multicj mc on mc.multi_id=md.multi_id inner join multi_doc mdo on mdo.multi_id=mc.multi_id inner join cab_mov c on c.cod_cab=mdo.cab_mov where pa.id='".$_REQUEST['codigo']."' group by pa.id";
	}else{
		$strSQL="Select * from pagos where id='".$_REQUEST['codigo']."'";
	}
	break;
}

 //echo $strSQL;
//echo "<br>".$empresa."-".$doc."-".$numero."<br>";


$resultado = mysql_query ($strSQL,$cn);

$row = mysql_fetch_array ($resultado);

if($empresa==''){
$empresa= $row['sucursal'];
}

$codigo= $row['det_id'];

$nom_aux1 = $row ['cliente']; 

$moneda1 =  $row ['moneda']; 

$fecha_venc=substr ($row ['fechavcto'],0,10);

$f2 = explode("-",$fecha_venc) ;

$dia_fecv = $f2[2];
$mes_fecv = $f2[1];
$ani_fecv = $f2[0];
if(isset($row['fechal'])){
$fecha_emision1 = substr ($row ['fechal'],0,10); 
}else{
	$fecha_emision1 = substr ($row ['fecha'],0,10); 
}

$f = explode("-",$fecha_emision1) ;

$dia_fech = $f[2];
$mes_fech = $f[1];
$año_fech = $f[0];

if($_REQUEST['tabla']=='efectivo'){
	
$fechap_venc=substr ($row ['fechav'],0,10);

$fp2 = explode("-",$fecha_venc) ;

$diap_fecv = $fp2[2];
$mesp_fecv = $fp2[1];
$anip_fecv = $fp2[0];

$fechap_emision1 = substr ($row ['fechapx'],0,10); 

$fp = explode("-",$fecha_emision1) ;

$diap_fech = $fp[2];
$mesp_fech = $fp[1];
$añop_fech = $fp[0];
}

$nom_aux3 = $row ['codvendedor'];
$nom_aux4 = $row ['estado']; 
$numcanje = $row ['numerocj'];
$m_total = $row ['monto']; 
//$m_bruto  = $row ['b_imp'];
//$igv = $row ['igv']; 



/*$strSQL1= "select * from referencia where cod_cab = '".$codigo."' " ;

$resultado1 = mysql_query ($strSQL1,$cn);

$row = mysql_fetch_array ($resultado1);

$num_ref_ser = $row ['serie']; 

$num_ref_corr = $row ['correlativo']; 

$cod_cab_ref1 = $row ['cod_cab_ref']; 





$strSQL3= "select * from cab_mov where cod_cab= '".$cod_cab_ref1."' " ;

$resultado3 = mysql_query ($strSQL3,$cn);

$row = mysql_fetch_array ($resultado3);

$tip_docu_ref = $row ['cod_ope']; 

$fec_emi_ref = extraefecha4($row ['fecha']); 

$doc_referencia=$tip_docu_ref." ".$num_ref_ser."-".$num_ref_corr;


$strSQL_doc= "select * from operacion where codigo = '".$tip_docu_ref."' and tipo='2' " ;
$resultado_doc = mysql_query ($strSQL_doc,$cn);
$row_doc = mysql_fetch_array ($resultado_doc);

$nombreDocRef=$row_doc['descripcion'];
*/


$strSQL1= "select * from cliente where codcliente = '".$nom_aux1."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$nom_aux = $row ['razonsocial']; 
$direc_aux =  $row ['direccion']; 
$dni_aux = $row ['doc_iden']; 
$ruc_aux = $row ['ruc']; 
$email_aux=$row ['email']; 
$ubigeo=$row ['ubigeo']; 
$tel_cliente=$row ['telefono']; 

//----------Aval*******/////////
$nom_aval=$row ['nombre_aval']; 
$tel_aval=$row ['tel_aval']; 
$dir_aval=$row ['direc_aval']; 
$doc_aval=$row ['doc_aval']; 
////////////////////////////////


$strSQL1= "select * from ubigeo where id= '".$ubigeo."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);

$distrito = $row ['desdist']; 
$provincia = $row ['desprovi']; 
$departamento = $row ['desdepa']; 
  

$strSQL1= "select * from usuarios where codigo= '".$nom_aux3."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$responsable = $row ['usuario']; 


$strSQL1= "select * from condicion where codigo= '".$nom_aux4."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);

$row = mysql_fetch_array ($resultado1);

$condicion = $row ['nombre']; 



/*$strSQL1= "select * from det_mov where cod_cab= '".$codigo."' " ;

$resultado1 = mysql_query ($strSQL1,$cn);

$row = mysql_fetch_array ($resultado1);

$cant= $row ['cantidad']; 

$P =  $row ['cod_prod'];

$descripcion =  $row ['nom_prod'];

$p_unit = $row ['precio'];

$nota = substr($row ['notas'],0,15);



$strSQL1= "select * from producto where idproducto= '".$P."' " ;

$resultado1 = mysql_query ($strSQL1,$cn);

$row = mysql_fetch_array ($resultado1);

$u = $row ['und']; 



$strSQL2= "select * from unidades where id = '".$u."' " ;

$resultado1 = mysql_query ($strSQL2,$cn);

$row = mysql_fetch_array ($resultado1);

$unid= $row ['nombre'];
*/


//if ($moneda1 = '01')

///($moneda = 'S/' );

//else	

//($moneda = 'US$');	



switch($moneda1)

{

case "01":

$moneda = "S/.";

$monedalet = "NUEVOS  SOLES";

break;



case "02":

$moneda = "US$";

$monedalet = "DOLARES "." "." "." AMERICANOS";

break;

}

switch($mes_fech)

 {

 

  	case "01":

    $mes_letra = "Enero";

	break;

	

	case "02":

    $mes_letra = "Febrero";

	break;

	

	case "03":

    $mes_letra = "Marzo";

	break;

	

	case "04":

    $mes_letra = "Abril";

	break;

	

	case "05":

    $mes_letra = "Mayo";

	break;

	

	case "06":

    $mes_letra = "Junio";

	break;

	

	case "07":

    $mes_letra = "Julio";

	break;

	

	case "08":

    $mes_letra = "Agosto";

	break;

	

	case "09":

    $mes_letra = "Setiembre";

	break;

	

	case "10":

    $mes_letra = "Octubre";

	break;

	

	case "11":

    $mes_letra = "Noviembre";

	break;

	

	case "12":

	$mes_letra = "Diciembre";

	break;

}

$strSQL_suc= "select * from sucursal where cod_suc = '".$empresa."'" ;
$resultado_suc = mysql_query ($strSQL_suc,$cn);
$row_suc = mysql_fetch_array ($resultado_suc);

$des_suc=$row_suc['des_suc'];
if($_REQUEST['tabla']=="efectivo"){
	$strSQL_doc= "select * from t_pago where id = '".$doc."'" ;
}else{
$strSQL_doc= "select * from t_pago where codigo = '".$doc."'" ;
}
$resultado_doc = mysql_query ($strSQL_doc,$cn);
$row_doc = mysql_fetch_array ($resultado_doc);

$cola1=$row_doc['cola'];

//$cola2=$row_doc['cola2'];
$formato=$row_doc['formato'];
//$comentario1=$row_doc['comentario1'];
//$comentario2=$row_doc['comentario2'];


/*				$strSQL="select * from docuser where pc='".$_SESSION['pc_ingreso']."' and usuario='".$_SESSION['codvendedor']."' and  doc='".$doc."' and tipomov='2' and empresa='".$empresa."' ";
			
			$resultado=mysql_query($strSQL,$cn);
			$row=mysql_fetch_array($resultado);
			$cola1=$row['cola'];*/
			$tcola="1";
			
			//echo $strSQL;			

/*if($dirDestino==""){
	$dirDestino=$direc_aux;
}*/


$direccion=$direc_aux;


//echo "select fontsize,altura,fuente,separacion,anchodoc from formatos where doc='".$doc."' and tipo='".$tipo."' and sucursal='".$empresa."'";
if($_REQUEST['tabla']=="efectivo"){
	$strSQL="select f.fontsize,f.altura,f.fuente,f.separacion,f.anchodoc from formatos f inner join t_pago tp on tp.codigo=f.doc where tp.id='".$doc."' and f.tipo='".$tipo."' and f.sucursal='".$empresa."'";
}else{
	$strSQL="select fontsize,altura,fuente,separacion,anchodoc from formatos where doc='".$doc."' and tipo='".$tipo."' and sucursal='".$empresa."'";
}
list($fontsize,$altura,$fuente,$separacion,$anchodoc)=mysql_fetch_row(mysql_query($strSQL));

//echo $fontsize;

$sucursal=$empresa;

if($fuente=='1')$tfuente="Arial";
if($fuente=='2')$tfuente="Times New Roman";
if($fuente=='3')$tfuente="Verdana";
if($fuente=='4')$tfuente="Courier New";
if($fuente=='5')$tfuente="Draft Condensed";

//$separacion='5';

$fuenteTexto=$tfuente." ; letter-spacing: ".$separacion." px";
//$fuenteTexto="Arial, Helvetica, sans-serif;";
//$fuenteTexto="";
//$fuenteTexto="";

?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Documento sin t&iacute;tulo</title>

<style type="text/css">
*{
margin:0mm;
border:0mm;
padding:0mm 0mm;
font-size: 10px; 
font:Arial, Helvetica, sans-serif; 
}

#contenedor{
position:relative;
top:0mm;
left:0mm;
width:100mm;
border:0px solid;
}
#sec1{
position:relative;
height:50mm;
border:0px solid;
}
#serie{
	position:absolute;
	top:124px;
	right:-110.067mm;
	border:0px solid;
	width: 160px;
}
#fecha{
	position:absolute;
	top:47.36mm;
	right:-118.798mm;
	border:0px solid;
	width: 257px;
	height: 23px;
}
#cliente{
	position:absolute;
	float:left;
	top:218px;
	left:121px;
	border:0px solid;
	width: 488px;
	height: 24px;
}
#direccion{
	position:absolute;
	top:252px;
	left:120px;
	border:0px solid;
	width: 491px;
}
#email{
	position:absolute;
	top:56.885mm;
	left:30.162mm;
	border:0px solid;
	width: 177px;
	height: 12px;
}
#condicion{
	position:absolute;
	top:63.765mm;
	left:188.648mm;
	border:0px solid;
	width: 69px;
}

#sec2{
position:relative;
height:100mm;
border:0px solid;
}
#detalle{
	position:absolute;
	top:313px;
	left:80px;
	border:0px solid;
	width: 758px;
}
#sec3{
position:relative;
height:20mm;
border:0px solid;
}
#total{
	position:absolute;
	float:left;
	top: 27px;
	right:-485px;
	border:0px solid;
	text-align:center;
	width: 120px;
}
#fechaUdt{
	position:absolute;
	top:1.058mm;
	left:3.969mm;
	border:0px solid;
	width: 49.477mm;
	text-align:left;
	visibility: visible;
	height: 20px;
}
#moneda_letras{
	position:absolute;
	top:-51.329mm;
	left:18.256mm;
	border:0px solid;
	height:18px;
	vertical-align:baseline;
	width: 471px;
}
#responsable{
	position:absolute;
	top:-43.656mm;
	left:16.933mm;
	border:0px solid;
	height:18px;
	vertical-align:baseline;
	width: 115px;
}
</style>
<style media="print">
	.noprint { display: none }
	body{ font-size:10px !important;font:Arial, Helvetica, sans-serif, Times, serif !important; }
</style>

<style type="text/css">
#moneda_letras2 {
	position:absolute;
	top:146.05mm;
	left:33.337mm;
	border:0px solid;
	height:27px;
	vertical-align:baseline;
	width: 608px;
}

.giro90 {
	left:0;
  position:absolute;
  top:40px;
  /* Chrome y Safari */
     -webkit-transform: rotate(-90deg);

     /* Firefox */
     -moz-transform: rotate(-90deg);

     /* Opera */
     -o-transform: rotate(-90deg);

     /* IE 9 */
     -ms-transform: rotate(-90deg);

     /* IE 8 */
     filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
}
hr.v{
width: 1px;
height: 500px;
}
</style>
</head>


<SCRIPT LANGUAGE="VBScript"> 
Sub window_onunload 
On Error Resume Next
Set WB = nothing 
End Sub 
Sub vbPrintPage 
OLECMDID_PRINT = 6 
OLECMDEXECOPT_DONTPROMPTUSER = 2 
OLECMDEXECOPT_PROMPTUSER = 1 
On Error Resume Next 
WB.ExecWB OLECMDID_PRINT, OLECMDEXECOPT_DONTPROMPTUSER, OLECMDEXECOPT_PROMPTUSER 
End Sub 
</SCRIPT> 

<!--<script type="text/javascript" src="../javascript/colaimp.js"></script> -->
<script type="text/javascript" src="../../utilitarios/otros/npProlyam.js"></script> 
<script type="text/javascript" src="../../utilitarios/otros/jquery-1.4.4.js"></script> 
<!--<script type="text/javascript" src="../../utilitarios/otros/activex.js"></script> -->

<script language="javascript">
 var  objPlugin = new  npPlugin("plugin");
 </script>
 <?php 
 	
	//echo $cola1;
	
  	$temp=explode("\\\\",$cola1); 
	     // print_r($temp);
	//echo $cola1;	  
		  if(count($temp)>1){
		  $impresora="\\\\\\\\".$temp[2]."\\\\".$temp[4];
		  }else{
		  $impresora=$cola1;
		  }
	
	$temp2=explode("/",$formato);
	
	//print_r($temp2);
	
	//echo count($temp2);
	if(count($temp2)>1){
	$url=$temp2[1];
	}else{
	$url=$formato;
	}
	
	//echo "--->".$url;
	
	
	/* 
	if(isset($_REQUEST['rpt_seg'])){
	$url=$formato;
	}else{
	$url=$formato;
	}
	*/
	//$url="rpt_proforma_cola.php";
	//$impresora="\\\\\\\\DESARROLLOWEB1\\\\Epson LX-300+";
	
	//$impresora=$cola1;
 ?>
 
<script language="javascript">


 function PrintHTMLSample()
    {
	
	  var url="<?php echo $url.'?empresa='.$empresa.'&codigo='.$codigo.'&tabla='.$_REQUEST['tabla'] ?>";
	  
	  var impresora="<?php echo $impresora ?>";
	  
	 // SaveHTML(url);
	 // var objCola=objPlugin.PrintHTML( url, impresora);
	  
	 //alert(url+ " -- " +impresora);
	//alert(impresora);
	 	/*
	   SaveHTML(url);
	   var objCola=objPlugin.PrintHTML( url, impresora);
	   //alert(objCola);	   
	   if(objCola=='OK'){
	   // window.close();
	   }	   
		*/
		//alert(url);
		alert(url+' - '+impresora+' - '+'<?php echo $altura.'|'.$anchodoc ?>');
		objPlugin.PrintHTML( url, impresora, "<?php echo $altura.'|'.$anchodoc ?>");
		
		//alto, ancho, vertical u horizontal, nro copias) 
	//   objPlugin.PrintHTML( url, impresora, "1395"); 
	   //alert(objCola);	   
	   //if(objCola=='OK'){
	   // window.close();
	   //}
	   //objPlugin.SaveHTML(url);
	 //  objPlugin.PrintHTML( url,impresora,"1500");	   
	  // colocar la URL a imprimir	  
      //objPlugin.PrintHTML(url,document.getElementById("printer").value);	  
         
    }
	
	function cargarIni(){
	//objPlugin.getVersion();
	//alert(objPlugin.getPrinters());
	//PrintHTMLSample();
	//document.getElementById('pc').innerHTML=objPlugin.getComputerName();
	//document.form1.usuario.focus();
	//var tcola="<?php // echo $tcola ?>";
	var tcola=2;
	//alert(tcola);
		if(tcola==1){
		vbPrintPage();
		}else{
		PrintHTMLSample();
		//alert();
		}
		
	}	

</script>

<!--onLoad="defrente()"-->
<body onLoad="cargarIni()">

<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>


<!--[if IE]>
    <object CLASSID="CLSID:D59F4895-9DEE-471E-B176-6E7FC9E01130"  
            id="plugin" 
            type="application/prolyam-plugin"  
            width="200" 
            height="50"  
			 style="visibility:hidden"
			>
    </object>
	    
    <![endif]-->
    <!--[if !IE]> <!-->
    <object id="plugin" 
            type="application/prolyam-plugin"  
            width="200" 
            height="50"
			 style="visibility:hidden"
			 >
    </object>
<!--<![endif]-->

<!--<div id="contenedor" style=" position:absolute; left:0; top:0; width:600px; height:900px">-->



<?php 

if($_REQUEST['tabla']=="efectivo"){
	$strSQL="select f.coordx,f.coordy,f.alto,f.ancho,f.habilitar,f.descripcion from formatos f inner join t_pago tp on tp.codigo=f.doc where tp.id='".$doc."' and f.tipo='".$tipo."' and f.sucursal='".$empresa."'";
}else{
$strSQL="select coordx,coordy,alto,ancho,habilitar,descripcion from formatos where doc='".$doc."' and tipo='".$tipo."' and sucursal='".$empresa."'";
}
//echo $strSQL;
$resultrado=mysql_query($strSQL,$cn);
while($row=mysql_fetch_array($resultrado)){

$habilitar[]=$row['habilitar'];
$ancho[]=$row['ancho'];
$alto[]=$row['alto'];
$coordx[]=$row['coordx'];
$coordy[]=$row['coordy'];
$descripcion2[]=$row['descripcion'];

}
//print_r($habilitar); echo "<br>";

?>


<?php
$pos=array_search('fechaEmiRef', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>"><?php echo $fec_emi_ref; ?></div>

<?php
$pos=array_search('nombre_aval', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>"><?php echo $nom_aval; ?></div>

<?php
$pos=array_search('direccion_aval', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>"><?php echo $dir_aval; ?></div>

<?php
$pos=array_search('telefono_aval', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>"><?php echo $tel_aval; ?></div>

<?php
$pos=array_search('documento_aval', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>"><?php echo $doc_aval; ?></div>


<?php
$pos=array_search('nombreDocRef', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>"><?php echo $nombreDocRef; ?></div>

<?php
$pos=array_search('cod_cliente', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>"><?php echo $nom_aux1; ?></div>

<?php
$pos=array_search('tel_cliente', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>"><?php echo $tel_cliente; ?></div>

<?php
$pos=array_search('fec_dd_mm_aaaa', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>"><?php echo $dia_fech."/".$mes_fech."/".$año_fech; ?></div>


<?php
$pos=array_search('fec_venc', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>"><?php echo $fecha_venc; ?></div>


<?php
$pos=array_search('fec_dd_mm_aaaa2', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>"><?php echo $dia_fech." / ".$mes_fech." / ".$año_fech; ?></div>

<?php 
$pos=array_search('fecVen_dia', $descripcion2);

 if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>"><?php echo strtoupper($dia_fecv); ?></div>

<?php

$pos=array_search('fecVen_mes', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ;display:<?php echo $display?> "><?php echo strtoupper($mes_fecv); ?></div>

<?php 
$pos=array_search('fecVen_anio', $descripcion2);

 if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>"><?php echo strtoupper($ani_fecv); ?></div>


<?php 
$pos=array_search('fecEmi_dia', $descripcion2);

 if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>"><?php echo $dia_fech; ?></div>

<?php

$pos=array_search('fecEmi_mes', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ;display:<?php echo $display?> "><?php //$mes_letra;
echo strtoupper($mes_fech); ?></div>

<?php 
$pos=array_search('fecEmi_anio', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>"><?php echo strtoupper($año_fech); ?></div>


<?php 
$pos=array_search('b_imp', $descripcion2);
echo "-->".$habilitar[$pos]."-->".$pos; 
if($habilitar[$pos]=='S' && $pos!=''){$display='block'; }else{ $display='none';} ?>

<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo number_format($m_bruto,2); ?></div>


<?php 
$pos=array_search('b_imp2', $descripcion2);
//echo "-->".$habilitar[$pos]."-->".$pos; 
if($habilitar[$pos]=='S' && $pos!=''){$display='block'; }else{ $display='none';} ?>

<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo number_format($m_bruto,2); ?></div>

<?php 
$pos=array_search('des_suc', $descripcion2);
//echo "-->".$habilitar[$pos]."-->".$pos; 
if($habilitar[$pos]=='S' && $pos!=''){$display='block'; }else{ $display='none';} ?>

<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left"><?php echo strtoupper($des_suc); ?></div>




<?php 
$pos=array_search('igv', $descripcion2);
if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo number_format($igv,2); ?></div>

<?php 
$pos=array_search('total', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $moneda."   ".number_format($m_total+$percepcion,2); ?></div>


<?php 
$pos=array_search('total2', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo number_format($m_total+$percepcion,2); ?></div>


<?php 
$pos=array_search('moneda1', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $moneda; ?></div>

<?php 
$pos=array_search('moneda2', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $moneda; ?></div>


<?php 
$pos=array_search('moneda3', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $moneda; ?></div>


<?php 
$pos=array_search('moneda4', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $moneda; ?></div>


<?php 
$pos=array_search('total_letras', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left"><?php echo strtoupper(num2letras($m_total+$percepcion)." ".$monedalet) ?></div>

<?php 
$pos=array_search('direc_origen', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left"><?php echo strtoupper(htmlspecialchars($dirPartida)); ?></div>

<?php 
$pos=array_search('texto_letra', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div class="giro90" style="position: relative;width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ; font-size:9px; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left;"><?php echo "CLAUSULAS <br>(1)&nbsp;En caso de mora, esta letra de cambio ganar&aacute;las tasas de inter&eacute;s Compensatorio y<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monetario mas altas que la ley permita a su Tenedor.<br>(2)&nbsp;El plazo de vencimiento podr&aacute; ser prorogado por el Tenedor, por el plazo que este se&ntilde;ale,<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sin que sea necesario la intervenci&oacute;n del obligatorio principal ni de los solidarios.<br>(3)&nbsp;Su importe debe ser pagado solo en la misma moneda que expresa este titulo valor.<br>(4)&nbsp;Esta letra de pago no requiere ser protestada por falta de pago.<br><br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_____________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_____________________<br>_______________________________________________________________________________"; ?></div>

<?php 
$pos=array_search('texto_letra2', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left"><?php echo ""; ?></div>

<?php 
$pos=array_search('lugar_letra', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left"><?php echo "L&nbsp;I&nbsp;M&nbsp;A"; ?></div>

<?php 
$pos=array_search('transp_nombre', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left"><?php echo htmlspecialchars($nomtrans); ?></div>

<?php  
$pos=array_search('transp_ruc', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left"><?php echo $ructrans; ?></div>

<?php 
$pos=array_search('transp_lice', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left"><?php echo $lic; ?></div>

<?php 
$pos=array_search('transp_marca', $descripcion2); 

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left"><?php echo $marca; ?></div>

<?php 
$pos=array_search('transp_placa', $descripcion2);  

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left"><?php echo $placa; ?></div>


<?php 
$pos=array_search('transp_direc', $descripcion2);  

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $transp_direc; ?></div>


<?php 
$pos=array_search('chofer_nombre', $descripcion2);  

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left"><?php echo $nomChofer; ?></div>


<?php 
$pos=array_search('fec_auditoria', $descripcion2);  

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo gmdate('d-m-Y H:i:s',time()-18000); ?></div>

<?php 
$pos=array_search('porcen_simb', $descripcion2); 
//echo $habilitar[$pos]; 
if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo "%" ;?></div>

<?php 
$pos=array_search('porcen_valor', $descripcion2); 


//echo "--->".$pos;
if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $impto1 ?></div>


<?php 
$pos=array_search('dni', $descripcion2); 
//echo "--->".$pos;
if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $dni_aux ?></div>

<?php 
$pos=array_search('obs1', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $obs1 ?></div>

<?php 
$pos=array_search('obs2', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $obs2 ?></div>

<?php 
$pos=array_search('obs3', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $obs3 ?></div>

<?php 
$pos=array_search('obs4', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $obs4 ?></div>

<?php
$pos=array_search('obs5', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $obs5 ?></div>

<?php 
$pos=array_search('cond_pago', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left"><?php echo $condicion ?></div>

<?php 
$pos=array_search('doc_referencia', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $doc_referencia ?></div>

<?php 
$pos=array_search('razonsocial', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left"><?php echo strtoupper(caracteres($nom_aux)); ?></div>

<?php 
$pos=array_search('direccion', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left"><?php echo strtoupper($direccion) ?></div>

<?php 
$pos=array_search('direccion2', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?><div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left"><?php echo strtoupper($dirDestino) ?></div>

<?php 
$pos=array_search('direc_completa', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left"><?php echo strtoupper($dirDestino." - ".$distrito." - ".$provincia." - ".$departamento) ?></div>

<?php 
$pos=array_search('ruc', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:left"><?php echo strtoupper($ruc_aux) ?></div>


<?php 
$pos=array_search('cod_ope', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo strtoupper($doc) ?></div>

<?php 
$pos=array_search('serie', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo strtoupper($serie) ?></div>

<?php 
$pos=array_search('num_doc', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo strtoupper($numero) ?></div>

<?php 
$pos=array_search('numcanje', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo str_pad($numcanje,10,"0",STR_PAD_LEFT) ?></div>


<?php 
$pos=array_search('responsable', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo strtoupper($responsable) ?></div>


<?php 
$pos=array_search('distrito', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo strtoupper($distrito) ?></div>


<?php 
$pos=array_search('provincia', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo strtoupper($provincia) ?></div>


<?php 
$pos=array_search('departamento', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo strtoupper($departamento) ?></div>


<?php 
$pos=array_search('son', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo "SON: "; ?></div>


<?php 
$pos=array_search('condicion', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $condicion; ?></div>

<?php 

if($percepcion!=0 && $percepcion!=''){
$pos=array_search('percepcion', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo number_format($percepcion,2); ?></div>


<?php 
}

if($percepcion!=0){

$pos=array_search('etiq_percepcion', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo " *OPERACION SUJETA A PERCEPCION DEL IGV.   2.00 %   TOTAL: " ?></div>

<?php 

}

$pos=array_search('comentario1', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $comentario1; ?></div>

<?php 
$pos=array_search('comentario2', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $comentario2; ?></div>

<?php 
$pos=array_search('etiqueta_Vendedor', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo "Vendedor"; ?></div>

<?php 
$pos=array_search('etiqueta_RUC', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo "RUC"; ?></div>

<?php 
$pos=array_search('etiqueta_Fec_Emi', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo "Fecha Emisi&oacute;n"; ?></div>

<?php 
$pos=array_search('etiqueta_Fec_Venc', $descripcion2);

if($habilitar[$pos]=='S' && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo "Fecha Vencimiento"; ?></div>




<!------------------------------------------------------------------------------------------------>

	  <?php 	  
	  
	  list($coordx1,$coordy1,$alto1,$ancho1,$habilitar1)=mysql_fetch_row(mysql_query("select coordx,coordy,alto,ancho,habilitar from formatos where doc='".$doc."' and descripcion='cod_prod' and sucursal='".$empresa."' and tipo='".$tipo."'"));if($habilitar1=='S')$display1='block'; else $display1='none';
	   
  	  list($coordx2,$coordy2,$alto2,$ancho2)=mysql_fetch_row(mysql_query("select coordx,coordy,alto,ancho from formatos where doc='".$doc."' and descripcion='nombre'  and sucursal='".$empresa."' and tipo='".$tipo."'")); 
	  
 	  list($coordx3,$coordy3,$alto3,$ancho3,$habilitar3)=mysql_fetch_row(mysql_query("select coordx,coordy,alto,ancho,habilitar from formatos where doc='".$doc."' and descripcion='cantidad'  and sucursal='".$empresa."' and tipo='".$tipo."'"));if($habilitar3=='S')$display3='block'; else $display3='none'; 
	  
	  list($coordx4,$coordy4,$alto4,$ancho4,$habilitar4)=mysql_fetch_row(mysql_query("select coordx,coordy,alto,ancho,habilitar from formatos where doc='".$doc."' and descripcion='und'  and sucursal='".$empresa."' and tipo='".$tipo."'"));if($habilitar4=='S')$display4='block'; else $display4='none';
	  
  	  list($coordx5,$coordy5,$alto5,$ancho5,$habilitar5)=mysql_fetch_row(mysql_query("select coordx,coordy,alto,ancho,habilitar from formatos where doc='".$doc."' and descripcion='precio'  and sucursal='".$empresa."' and tipo='".$tipo."'"));if($habilitar5=='S')$display5='block'; else $display5='none';
	  
	  list($coordx6,$coordy6,$alto6,$ancho6,$habilitar6)=mysql_fetch_row(mysql_query("select coordx,coordy,alto,ancho,habilitar from formatos where doc='".$doc."' and descripcion='imp_item'  and sucursal='".$empresa."' and tipo='".$tipo."'"));if($habilitar6=='S')$display6='block'; else $display6='none';
	  
	   list($coordx7,$coordy7,$alto7,$ancho7,$habilitar7)=mysql_fetch_row(mysql_query("select coordx,coordy,alto,ancho,habilitar from formatos where doc='".$doc."' and descripcion='serieprod'  and sucursal='".$empresa."' and tipo='".$tipo."'"));if($habilitar7=='S')$display7='block'; else $display7='none';
	   
	    list($coordx8,$coordy8,$alto8,$ancho8,$habilitar8)=mysql_fetch_row(mysql_query("select coordx,coordy,alto,ancho,habilitar from formatos where doc='".$doc."' and descripcion='conta_items'  and sucursal='".$empresa."' and tipo='".$tipo."'"));if($habilitar8=='S')$display8='block'; else $display8='none';
		
		list($coordx9,$coordy9,$alto9,$ancho9,$habilitar9)=mysql_fetch_row(mysql_query("select coordx,coordy,alto,ancho,habilitar from formatos where doc='".$doc."' and descripcion='desc1'  and sucursal='".$empresa."' and tipo='".$tipo."'"));if($habilitar9=='S')$display9='block'; else $display9='none';
	   
	   list($coordx10,$coordy10,$alto10,$ancho10,$habilitar10)=mysql_fetch_row(mysql_query("select coordx,coordy,alto,ancho,habilitar from formatos where doc='".$doc."' and descripcion='cod_anexo'  and sucursal='".$empresa."' and tipo='".$tipo."'"));if($habilitar10=='S')$display10='block'; else $display10='none';
	   
	   list($coordx11,$coordy11,$alto11,$ancho11,$habilitar11)=mysql_fetch_row(mysql_query("select coordx,coordy,alto,ancho,habilitar from formatos where doc='".$doc."' and descripcion='desc2'  and sucursal='".$empresa."' and tipo='".$tipo."'"));if($habilitar11=='S')$display11='block'; else $display11='none';
	   
	   list($coordx12,$coordy12,$alto12,$ancho12,$habilitar12)=mysql_fetch_row(mysql_query("select coordx,coordy,alto,ancho,habilitar from formatos where doc='".$doc."' and descripcion='desc1_desc2'  and sucursal='".$empresa."' and tipo='".$tipo."'"));if($habilitar12=='S')$display12='block'; else $display12='none';
	   
	  // echo $display7;
/*$conta_items=0;	  
$strSQL= "select * from det_mov where cod_cab= '".$codigo."' " ;
$resultado = mysql_query ($strSQL,$cn);
while ($row = mysql_fetch_array ($resultado)) {
$cant= $row ['cantidad']; 
$P =  $row ['cod_prod'];
$descripcion =  $row ['nom_prod'];
$p_unit = $row ['precio'];
$p_tot = $cant * $p_unit;	  

$conta_items++;
$desc1=$row ['desc1'];
$desc2=$row ['desc2'];

$impCDesc=$row['imp_item'];
$totalDesc=$totalDesc+($p_tot-$impCDesc);

$strSQL1= "select * from producto where idproducto= '".$P."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row1 = mysql_fetch_array ($resultado1);
$u = $row1 ['und']; 
$cod_producto=$row1 ['idproducto']; 
$simanejaser = $row1 ['series']; 
$garantia= $row1 ['garantia']; 
$cod_anexo=$row1 ['cod_prod']; 

$strSQL2= "select * from unidades where id = '".$u."' " ;
$resultado2 = mysql_query ($strSQL2,$cn);
$row2 = mysql_fetch_array ($resultado2);
$unid= $row2 ['nombre'];
/*
$strSQL3= "select * from tienda where cod_suc = '".$empresa."' " ;
$resultado3 = mysql_query ($strSQL3,$cn);
$row3 = mysql_fetch_array ($resultado3);
$tienda= $row3 ['cod_tienda'];


if($cod_cab_ref1==''){
$tempCodigoSerie=$codigo;
}else{
$tempCodigoSerie=$cod_cab_ref1;
}


$strSQL4="select * from series where producto='".$P."' and tienda='".$tienda."' and salida='".$tempCodigoSerie."'";
$resultado4 = mysql_query ($strSQL4,$cn);
*/
//echo $strSQL4;
//$row4 = mysql_fetch_array ($resultado4);
//$acumulador = $row4 ['serie'];
//$acumulador = $row4 ['serie'].",";
//*********************************

//while($row=mysql_fetch_array($resultado4)){
//$acumulador=$acumulador.$row['serie'].", ";
//}
//$acumulador=substr($acumulador,0,strlen($acumulador)-2);
//echo $acumulador;
	  ?>
	  					
		<div style="width:<?php echo $ancho1?> ; height:<?php echo $alto1?> ; left:<?php echo $coordx1?> ; top:<?php echo $coordy1?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display1?>; text-align:left  "><?php if($P!="TEXTO") echo strtoupper($P); ?></div>
		<?php  $coordy1=$coordy1+15?>
		
		<div style="width:<?php echo $ancho2?> ; height:<?php echo $alto2?> ; left:<?php echo $coordx2?> ; top:<?php echo $coordy2?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; text-align:left ;  "><?php echo strtoupper(caracteres(substr($descripcion,0,50))); ?></div>
		<?php  $coordy2=$coordy2+15?>
		
		<div style="width:<?php echo $ancho3?> ; height:<?php echo $alto3?> ; left:<?php echo $coordx3?> ; top:<?php echo $coordy3?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; text-align:right ; display:<?php echo $display3?>"><?php 
		
		if($cant!=0)echo number_format($cant,2); 
		
		?></div>
		<?php  $coordy3=$coordy3+15?>
		
		<div style="width:<?php echo $ancho4?> ; height:<?php echo $alto4?> ; left:<?php echo $coordx4?> ; top:<?php echo $coordy4?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display4?>"><?php  if($unid!="") echo strtoupper($unid); ?></div>
		<?php  $coordy4=$coordy4+15?>
		
		<div style="width:<?php echo $ancho5?> ; height:<?php echo $alto5?> ; left:<?php echo $coordx5?> ; top:<?php echo $coordy5?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display5?>; text-align:right"><?php if($p_unit!=0) echo number_format($p_unit,4); ?></div>
		<?php  $coordy5=$coordy5+15?>
				
		<div style="width:<?php echo $ancho6?> ; height:<?php echo $alto6?> ; left:<?php echo $coordx6?> ; top:<?php echo $coordy6?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display6?>; text-align:right "><?php  if($p_tot!=0) echo number_format($impCDesc,2); ?></div>
		<?php  $coordy6=$coordy6+15?>
		
		<div style="width:<?php echo $ancho8?> ; height:<?php echo $alto8?> ; left:<?php echo $coordx8?> ; top:<?php echo $coordy8?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display8?>; text-align:right "><?php  echo number_format($conta_items); ?></div>
		<?php  $coordy8=$coordy8+15?>
		
		<div style="width:<?php echo $ancho9?> ; height:<?php echo $alto9?> ; left:<?php echo $coordx9?> ; top:<?php echo $coordy9?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display9?>; text-align:right "><?php  echo $desc1."  - " ?></div>
		<?php  $coordy9=$coordy9+15?>
		
		<div style="width:<?php echo $ancho10?> ; height:<?php echo $alto10?> ; left:<?php echo $coordx10?> ; top:<?php echo $coordy10?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display10?>; text-align:right "><?php  echo $cod_anexo ?></div>
		<?php  $coordy10=$coordy10+15?>
		
		<div style="width:<?php echo $ancho11?> ; height:<?php echo $alto11?> ; left:<?php echo $coordx11?> ; top:<?php echo $coordy11?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display11?>; text-align:right "><?php  echo $desc2 ?></div>
		<?php  $coordy11=$coordy11+15?>
		
		<div style="width:<?php echo $ancho12?> ; height:<?php echo $alto12?> ; left:<?php echo $coordx12?> ; top:<?php echo $coordy12?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display12?>; text-align:right "><?php  echo $desc1."% - ".$desc2."%" ?></div>
		<?php  $coordy12=$coordy12+15?>
		
					
		<?php 

		 if ($simanejaser == "S" )
		 {
			$acumulador="";
			$contSerie=0;
			$switch='F';
			
			while($row4=mysql_fetch_array($resultado4)){
			$acumulador=$acumulador.$row4 ['serie'].", "; 
			//echo "--->$acumulador";
			$contSerie++;			
			
			
				if(fmod($contSerie,2)==0){	
				
				//$acumulador=substr($acumulador,0,strlen($acumulador)-2);	
				
				$coordy7=$coordy2;
			?>
				
				
				<div style="width:<?php echo $ancho7?> ; height:<?php echo $alto7?> ; left:<?php echo $coordx7?> ; top:<?php echo $coordy7?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display7?>; text-align:left;"><?php echo "S/N : ".$acumulador; ?></div>
			<?php  
			
			$coordy1=$coordy1+15;
			$coordy2=$coordy2+15;
			$coordy3=$coordy3+15;
			$coordy4=$coordy4+15;
			$coordy5=$coordy5+15;
			$coordy6=$coordy6+15;
			$coordy7=$coordy7+15;
			$coordy8=$coordy8+15;
			$coordy9=$coordy9+15;
			$coordy10=$coordy10+15;
			$coordy11=$coordy11+15;
			$coordy12=$coordy12+15;
			
			
			$acumulador="";
			$switch='T';
			
			?>
			
			<?php 
				 }
				
			 }//while
		  
		  //echo "---->".$acumulador;	
			$acumulador=substr($acumulador,0,strlen($acumulador)-2);	
			//echo "---->".$acumulador;	
			
			if($acumulador!=''){
			
				if($switch=='F'){
				//echo "--->";
				$coordy7=$coordy2;
				}
		  ?>
				
				<div style="width:<?php echo $ancho7?> ; height:<?php echo $alto7?> ; left:<?php echo $coordx7?> ; top:<?php echo $coordy7?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display7?>; text-align:left; "><?php echo "S/N : ".$acumulador; ?></div>
			<?php  
			
			$coordy1=$coordy1+15;
			$coordy2=$coordy2+15;
			$coordy3=$coordy3+15;
			$coordy4=$coordy4+15;
			$coordy5=$coordy5+15;
			$coordy6=$coordy6+15;
			$coordy8=$coordy8+15;
			$coordy9=$coordy9+15;
			$coordy10=$coordy10+15;
			$coordy11=$coordy11+15;
			$coordy12=$coordy12+15;
			
			//$coordy7=$coordy7+25;
			$acumulador="";
			}
			?>
			
			
		
		<?php 
	//echo $acumulador;
		//echo "S/N:".$acumulador;
		}//if
		
		
//}
?>

<?php 
$pos=array_search('totalDesc', $descripcion2);

if($habilitar[$pos]=='S'  && $pos!='' )$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $totalDesc; ?></div>

<?php 
$pos=array_search('totalImporte', $descripcion2);

if($habilitar[$pos]=='S'  && $pos!='')$display='block'; else $display='none';?>
<div style="width:<?php echo $ancho[$pos]?> ; height:<?php echo $alto[$pos]?> ; left:<?php echo $coordx[$pos]?> ; top:<?php echo $coordy[$pos]?>; position: absolute ;font-size:<?php echo $fontsize?>; font-family:<?php echo $fuenteTexto?> ; display:<?php echo $display?>; text-align:right"><?php echo $m_total+$totalDesc; ?></div>


<!--  <div id="total"><?php //echo $moneda." ".number_format($m_total,2) ?></div>-->

<!--<div id="moneda_letras2"><?php //echo  strtoupper(num2letras($m_total)." ".$monedalet); ?></div>-->
<!--<div id="fechaUdt"><font class="Estilo7"><?php //echo gmdate('d-m-Y H:i:s',time()-18000) ?></font></div>-->

<!--</div>-->
</body>

</html>

