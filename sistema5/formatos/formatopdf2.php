<?php 
//include('sesion.php');
require('../fpdf2/fpdf.php');
include('../conex_inicial.php');
/*
$codigo=$_SESSION['codcliente'];
$strSQL="select * from clientes where codigo='$codigo'";					 
$resultado=mysql_query($strSQL,$cn);
$row=mysql_fetch_array($resultado);


	$nombre=$row['nombre'];
	$apellido=$row['apellido'];
	$dni=$row['dni'];
	$direccion=$row['direccion'];
	$telefono1=$row['telefono1'];
	$razonsocial=$row['razonsocial'];
	$ruc=$row['ruc'];
	
	$cliente=$nombre." ".$apellido;

$plan=$_REQUEST['plan'];
$contrato=$_REQUEST['contrato'];
$equipo=$_REQUEST['equipo'];
$lineas=$_REQUEST['lineas'];

$strSQL2="select * from planequipo where idplan='$plan' and idequipo='$equipo' and contrato='$contrato' ";					 
$resultado2=mysql_query($strSQL2,$cn);
$row2=mysql_fetch_array($resultado2);
$costoequipo=$row2['costo'];

$strSQL3="select * from planes where id='$plan'";					 
$resultado3=mysql_query($strSQL3,$cn);
$row3=mysql_fetch_array($resultado3);

$nombreplan=$row3['plan'];
$cargosol=$row3['cargosol'];
$cargodol=$row3['cargodol'];
$rpm=$row3['rpm'];
$mmf=$row3['mmf'];
$momdli=$row3['momdli'];
$tododes=$row3['tododes'];
$sms=$row3['sms'];
$mms=$row3['mms'];
$internet=$row3['internet'];
$ndestino=$row3['ndestino'];
$limitecre=$row3['limitecre'];

$strSQL4="select * from contratos where id='$contrato'";					 
$resultado4=mysql_query($strSQL4,$cn);
$row4=mysql_fetch_array($resultado4);
$nombrecontrato=$row4['descripcion'];

$strSQL5="select * from producto where idProducto='$equipo'";					 
$resultado5=mysql_query($strSQL5,$cn);
$row5=mysql_fetch_array($resultado5);
$nombreequipo=$row5['Nombre_pro'];
$imagen=$row5['Imagen_peque'];
$modelo=$row5['modelo'];




//------------------------------------clase FPDF--------------------------------------------------------------------------------


class PDF extends FPDF{
	function Header()
	{

	}
		
	function Footer()
	{
		//Posicin: a 1,5 cm del final
		//$this->SetY(-15);
		//Arial italic 8
		$this->SetFont('Arial','I',8);
		//Nmero de pgina
		//$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}

	function FancyTable($header,$data)
	{
	
	
	
	include('../conex_inicial.php');

$codigo=$_SESSION['codcliente'];
$vend=$_SESSION['vendedor'];
$strSQL="select * from clientes where codigo='$codigo'";					 
$resultado=mysql_query($strSQL,$cn);
$row=mysql_fetch_array($resultado);
	$nombre=$row['nombre'];
	$apellido=$row['apellido'];
	$dni=$row['dni'];
	$direccion=$row['direccion'];
	$telefono1=$row['telefono1'];
	$razonsocial=$row['razonsocial'];
	$ruc=$row['ruc'];
	$movil=$row['movil'];
	$representante=$row['representante'];
	
	if($nombre!="" && $apellido!=""){
	$cliente=$nombre." ".$apellido;
	$documento=$dni;
	}else{
	$cliente=$razonsocial;
	$documento=$ruc;
	}

$plan=$_REQUEST['plan'];
$contrato=$_REQUEST['contrato'];
$equipo=$_REQUEST['equipo'];
$lineas=$_REQUEST['lineas'];

$strSQL2="select * from planequipo where idplan='$plan' and idequipo='$equipo' and contrato='$contrato' ";					 
$resultado2=mysql_query($strSQL2,$cn);
$row2=mysql_fetch_array($resultado2);
$costoequipo=$row2['costo'];

$strSQL3="select * from planes where id='$plan'";					 
$resultado3=mysql_query($strSQL3,$cn);
$row3=mysql_fetch_array($resultado3);

$nombreplan=$row3['plan'];
$cargosol=$row3['cargosol'];
$cargodol=$row3['cargodol'];
$rpm=$row3['rpm'];
$mmf=$row3['mmf'];
$momdli=$row3['momdli'];
$tododes=$row3['tododes'];
$sms=$row3['sms'];
$mms=$row3['mms'];
$internet=$row3['internet'];
$ndestino=$row3['ndestino'];
$limitecre=$row3['limitecre'];

$strSQL4="select * from contratos where id='$contrato'";					 
$resultado4=mysql_query($strSQL4,$cn);
$row4=mysql_fetch_array($resultado4);
$nombrecontrato=$row4['descripcion'];

$strSQL5="select * from producto where idProducto='$equipo'";					 
$resultado5=mysql_query($strSQL5,$cn);
$row5=mysql_fetch_array($resultado5);
$nombreequipo=$row5['Nombre_pro'];
$imagen=$row5['Imagen_peque'];


$strSQL6="select * from proforma order by id desc limit 1";					 
$resultado6=mysql_query($strSQL6,$cn);
$row6=mysql_fetch_array($resultado6);
$nproforma=$row6['numero'];


	$fecha=date('d/m/Y');
*/

function hex2dec($couleur = "#000000"){
    $R = substr($couleur, 1, 2);
    $rouge = hexdec($R);
    $V = substr($couleur, 3, 2);
    $vert = hexdec($V);
    $B = substr($couleur, 5, 2);
    $bleu = hexdec($B);
    $tbl_couleur = array();
    $tbl_couleur['R']=$rouge;
    $tbl_couleur['V']=$vert;
    $tbl_couleur['B']=$bleu;
    return $tbl_couleur;
}

//conversion pixel -> millimeter at 72 dpi
function px2mm($px){
    return $px*25.4/72;
}

	function txtentities($html){
		$trans = get_html_translation_table(HTML_ENTITIES);
		$trans = array_flip($trans);
		return strtr($html, $trans);
	}

	class PDF extends FPDF{
	var  $telSuc;
	var  $emailSuc;
	var  $webSuc;
	
	//variables pdfhtml
	var $B=0;
    var $I=0;
    var $U=0;
    var $HREF='';
    var $ALIGN='';
	
	
	function Header()
	{

	}
		
	

	function FancyTable($data)
	{
		
	
		
	include('../conex_inicial.php');
	include('../funciones/funciones.php');
	
	$empresa =  $_REQUEST['empresa'];
$doc=  $_REQUEST['doc'];
$serie =  $_REQUEST['serie'];
$numero =  $_REQUEST['numero'];


if($_REQUEST['codigoCab']==''){

$strSQL= "select * from cab_mov where sucursal='$empresa ' and cod_ope='$doc'  and serie='$serie' and Num_doc='$numero' " ;
}else{
$strSQL= "select * from cab_mov where cod_cab='".$_REQUEST['codigoCab']."' " ;
}

//echo $strSQL;

$resultado = mysql_query ($strSQL,$cn);
$row = mysql_fetch_array ($resultado);

$codigo= $row['cod_cab'];
$nom_aux1 = $row ['cliente']; 
$moneda1 =  $row ['moneda']; 
$obs1 = $row ['obs1']; 
$obs2 = $row ['obs2']; 
$obs3 = $row ['obs3']; 
$obs4 = $row ['obs4']; 
$obs5 = $row ['obs5']; 
$numero=  $row ['Num_doc']; 
$serie= $row ['serie'];
$tcambio= $row ['tc']; 
$inc= $row ['incluidoigv'];
$doc=$row ['cod_ope'];
$empresa=$row ['sucursal'];
$tienda=$row ['tienda'];
$tipomov=$row ['tipo'];

$desAux="CLIENTE";
if($row ['tipo']=='1'){
$desAux="PROVEEDOR";
}

$desAux2="  Cliente";
if($row ['tipo']=='1'){
$desAux2="  Proveedor";
}

$fecha_emision1 = substr ($row ['fecha'],0,19); 
$f = explode("-",$fecha_emision1) ;

$dia_fech = substr ($f[2],0,2);
$mes_fech = $f[1];
$año_fech = substr ($f[0],0,4);
$hora = substr ($f[2],3,8);

$nom_aux3 = $row ['cod_vendedor']; 
$nom_aux4 = $row ['condicion']; 
$m_total = $row ['total'];  
$m_bruto  = $row ['b_imp']; 
$igv = $row ['igv']; 

$strSQL1= "select * from referencia where cod_cab = '".$codigo."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$num_ref_ser = $row ['serie']; 
$num_ref_corr = $row ['correlativo']; 
$cod_cab_ref1 = $row ['cod_cab_ref']; 

$strSQL3= "select * from cab_mov where cod_cab= '".$cod_cab_ref1."' " ;

$resultado3 = mysql_query ($strSQL3,$cn);
$row = mysql_fetch_array ($resultado3);
$tip_docu_ref = $row ['cod_ope']; 

$strSQL1= "select * from cliente where codcliente = '".$nom_aux1."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$nom_aux = $row ['razonsocial']; 
$direc_aux =  $row ['direccion']; 
$contacto =  $row ['contacto']; 
$cargo =  $row ['cargo']; 
$telefono_aux =  $row ['telefono']; 


$dni_aux = $row ['doc_iden']; 
$ruc_aux = $row ['ruc']; 
if($dni_aux==''){
$docu_aux=$ruc_aux;
}else{
$docu_aux=$dni_aux;
} 

$codubigeo=$row['ubigeo'];

$strSQL1= "select * from usuarios where codigo= '".$nom_aux3."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$distrito = $row ['desdist']; 
$provincia= $row ['desprovi']; 
$departamento= $row ['desdepa']; 


$strSQL1= "select * from usuarios where codigo= '".$nom_aux3."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$responsable = $row ['usuario']; 
$nombresUser = $row ['nombres']; 
$emailUser = $row ['email']; 
$telefono1User = $row ['telefono1']; 

$strSQL1= "select * from condicion where codigo= '".$nom_aux4."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$condicion = $row ['nombre']; 

$strSQL1= "select * from det_mov where cod_cab= '".$codigo."' " ;
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

$strSQL2= "select * from sucursal where cod_suc = '".$empresa."' " ;
$resultado1 = mysql_query ($strSQL2,$cn);
$row = mysql_fetch_array ($resultado1);
$dessuc= $row ['des_suc'];
$rucsuc=$row ['ruc'];

$this->emailSuc=$row ['email'];
$this->webSuc=$row ['web'];

$strSQL2= "select * from tienda where cod_tienda = '".$tienda."' " ;
$resultado1 = mysql_query ($strSQL2,$cn);
$row = mysql_fetch_array ($resultado1);
$dirtienda= $row ['direccion'];


$strSQL2= "select * from operacion where codigo = '".$doc."' " ;
$resultado1 = mysql_query ($strSQL2,$cn);
$row = mysql_fetch_array ($resultado1);
$this->telSuc=$row ['comentario2'];
//if ($moneda1 = "01")
//$m_dolares = $m_total * $t_cambio ;
//$m_soles = $m_total;

//else
//$m_dolares = $m_total;
//$m_soles = $m_total / $t_cambio ;

switch($moneda1)
{
case "01":
$m_soles = $m_total; 
$m_dolares = $m_total / $tcambio ;
$moneda = "S/.";
break;

case "02":
$m_dolares = $m_total  ;
$m_soles = $m_total * $tcambio; 
$moneda = "US$";
break;
}


switch($moneda1)
{
case "01":
$monedalet = "NUEVOS SOLES";
break;

case "02":
$monedalet = "DOLARES AMERICANOS";
break;
}
switch($inc)
{
case "S":
$incluido = "INCLUIDO IGV";
break;

case "N":
$incluido = "NO INCLUYEN EL IGV";
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

$strSQL_doc= "select * from operacion where codigo = '".$doc."' " ;
$resultado_doc = mysql_query ($strSQL_doc,$cn);
$row_doc = mysql_fetch_array ($resultado_doc);
$cola1=$row_doc['cola'];
$cola2=$row_doc['cola2'];
$formato=$row_doc['formato'];
$etiquetaOSB1=$row_doc['obs1'];
$etiquetaOSB2=$row_doc['obs2'];
$etiquetaOSB3=$row_doc['obs3'];

		$this->Ln(-40);		
		$this->SetFont('Arial','B',14);
		//$this->Cell(130,0,'',0,0,'L');
		////$this->Cell(30,8,$row_doc['descripcion'],0,0,'C');
		//$this->Ln(1);
		
		$this->Ln(26);
			
		$this->SetFont('Arial','B',12);
		$this->Cell(130,8,'',0,0,'L');
		$this->Cell(30,2,$row_doc['descripcion']."  Nro. ".$serie."-".$numero,0,0,'C');
		$this->Ln(1);
		$this->SetFont('Arial','B',10);
		/*
		$this->Cell(10,6,'',0,0,'L');
		$this->Cell(80,8,$dessuc,0,0,'C');
		$this->Ln(5);
		$this->Cell(100,8,"RUC ".$rucsuc,0,0,'C');
		$this->Ln(5);
		$this->Cell(100,8,$dirtienda,0,0,'C');
		*/
		//Colores, ancho de lnea y fuente en negrita
		$this->Ln(5);
		$this->Cell(130,8,'',0,0,'C');
		$this->Cell(40,2,'Fecha: '.$fecha,0,0,'L');
		
		
		$this->Ln(10);
		$this->Cell(5,6,'',0,0,'L');
		$this->Cell(70,8,'DATOS DEL '.$desAux,0,0,'L');
		$this->Ln();
		
		$this->SetFont('Arial','',10);
		$this->Cell(10,6,'',0,0,'R');
		$this->Cell(20,6,$desAux2,0,0,'L');
		$this->Cell(3,6,':',0,0,'R');
		$this->Cell(50,6,$nom_aux,0,0,'L');
		$this->Ln();
		$this->Cell(10,6,'',0,0,'L');
		$this->Cell(20,6,'  Ruc:',0,0,'L');
		$this->Cell(3,6,':',0,0,'R');
		$this->Cell(50,6,$docu_aux,0,0,'L');
		$this->Ln();
		
		
		$this->Cell(10,6,'',0,0,'L');
		$this->Cell(20,6,'  Contacto',0,0,'L');
		$this->Cell(3,6,':',0,0,'R');
		$this->Cell(80,6,$contacto,0,0,'L');
		
		$this->Cell(5,6,'',0,0,'L');
		$this->Cell(20,6,'  Vendedor',0,0,'L');
		$this->Cell(3,6,':',0,0,'R');
		$this->Cell(25,6,$responsable,0,0,'L');
		//$this->Cell(10,6,'',0,0,'L');
		//$this->Cell(40,6,'  DNI/RUC',0,0,'L');
		//$this->Cell(10,6,':',0,0,'R');
		//$this->Cell(50,6,$documento,0,0,'L');
		$this->Ln();						
		$this->Cell(10,6,'',0,0,'L');
		$this->Cell(20,6,utf8_decode('  Dirección'),0,0,'L');
		$this->Cell(3,6,':',0,0,'R');
		$this->Cell(50,6,$direc_aux,0,0,'L');
		$this->Ln();		
		/*
		$this->Cell(10,6,'',0,0,'L');
		$this->Cell(20,6,'  Distrito',0,0,'L');
		$this->Cell(3,6,':',0,0,'R');
		$this->Cell(25,6,$distrito,0,0,'L');
		
		$this->Cell(5,6,'',0,0,'L');
		$this->Cell(20,6,'  Provincia',0,0,'L');
		$this->Cell(3,6,':',0,0,'R');
		$this->Cell(25,6,$provincia,0,0,'L');
		
		$this->Cell(5,6,'',0,0,'L');
		$this->Cell(20,6,'  Departamento',0,0,'L');
		$this->Cell(10,6,':',0,0,'R');
		$this->Cell(25,6,$departamento,0,0,'L');
		
		$this->Ln();		
		
		
		
		$this->Cell(10,6,'',0,0,'L');
		$this->Cell(20,6,utf8_decode('  Teléfono'),0,0,'L');
		$this->Cell(3,6,':',0,0,'R');
		$this->Cell(25,6,$telefono_aux,0,0,'L');
		
		$this->Ln();
		*/
				
		//$this->Cell(10,6,'',0,0,'L');
		//$this->Cell(40,6,'  Telf. Casa/Oficina',0,0,'L');
		//$this->Cell(10,6,':',0,0,'R');
		//$this->Cell(50,6,$telefono1,0,0,'L');
		//$this->Ln();
		//$this->Cell(10,6,'',0,0,'L');
		//$this->Cell(40,6,'  Telf. Mvil',0,0,'L');
		//$this->Cell(10,6,':',0,0,'R');
		//$this->Cell(50,6,$movil,0,0,'L');
		
		
		
		$this->SetFont('Arial','B',11);
		$this->Ln(10);
		$this->Cell(5,6,'',0,0,'L');
		$this->Cell(70,8,'DETALLE DEL PRODUCTO',0,0,'L');
		$this->Ln();
		/*
		$this->SetFont('Arial','',10);
		$this->Cell(10,6,'',0,0,'L');
		$this->Cell(40,6,'  Producto',0,0,'L');
		$this->Cell(10,6,':',0,0,'R');
		$this->Cell(50,6,'RPM-EMPRESARIAL',0,0,'L');
		$this->Ln();
		
		$this->Cell(10,6,'',0,0,'L');
		$this->Cell(40,6,'  Cantidad de Lineas',0,0,'L');
		$this->Cell(10,6,':',0,0,'R');
		$this->Cell(50,6,$lineas,0,0,'L');
		$this->Ln();
		
		$this->Cell(10,6,'',0,0,'L');
		$this->Cell(40,6,'  Plan',0,0,'L');
		$this->Cell(10,6,':',0,0,'R');
		$this->Cell(50,6,$nombreplan,0,0,'L');
		$this->Ln();
		
		$this->Cell(10,6,'',0,0,'L');
		$this->Cell(40,6,'  Contrato',0,0,'L');
		$this->Cell(10,6,':',0,0,'R');
		$this->Cell(50,6,$nombrecontrato,0,0,'L');
		$this->Ln();
		
		$this->Cell(10,6,'',0,0,'L');
		$this->Cell(40,6,'  Detalle del Plan',0,0,'L');
		$this->Cell(10,6,':',0,0,'R');
		$this->Cell(50,6,'',0,0,'L');
		$this->Ln(10);
		*/
		
		$this->SetFont('Arial','B',9);
		$this->Cell(5,5,'',0,0,'C',0);
		$this->Cell(20,5,'Cantidad',1,0,'C',0);
		$this->Cell(120,5,utf8_decode('Descripción'),1,0,'C',0);
		$this->Cell(20,5,'P. Unit.',1,0,'C',0);
		$this->Cell(20,5,'Total',1,0,'C',0);
		
		
		$strSQL= "select * from det_mov where cod_cab= '".$codigo."' " ;
		$resultado = mysql_query ($strSQL,$cn);
		
		while ($row = mysql_fetch_array ($resultado)) {
		
		$cant= $row ['cantidad']; 
		$P =  $row ['cod_prod'];
		$descripcion =  substr($row ['nom_prod'],0,65);
		$p_unit = $row ['precio'];
		$p_tot = $cant * $p_unit;
			  
		$strSQL1= "select * from producto where idproducto= '".$P."' " ;
		$resultado1 = mysql_query ($strSQL1,$cn);
		$row1 = mysql_fetch_array ($resultado1);
		$u = $row1 ['und']; 
		$cod_producto=$row1 ['idproducto']; 
		$simanejaser = $row1 ['series'];
		$datos = $row1 ['datos']; 
		
		$strSQL2= "select * from unidades where id = '".$u."' " ;
		$resultado2 = mysql_query ($strSQL2,$cn);
		$row2 = mysql_fetch_array ($resultado2);
		$unid= $row2 ['nombre'];
		
		$strSQL3= "select * from tienda where cod_suc = '".$empresa."' " ;
		$resultado3 = mysql_query ($strSQL3,$cn);
		$row3 = mysql_fetch_array ($resultado3);
		$tienda= $row3 ['cod_tienda'];
		
		$strSQL4="select * from series where producto='".$P."' and tienda='".$tienda."' and salida='".$codigo."'";
		$resultado4 = mysql_query ($strSQL4,$cn);
		
		$this->Ln();
		$this->Cell(5,5,'','',0,'C',0);
		$this->Cell(20,5,$cant,'LR',0,'C',0);
		$this->Cell(120,5,$descripcion,'LR',0,'L',0);
		$this->Cell(20,5,number_format($p_unit,2)." ",'LR',0,'R',0);
		$this->Cell(20,5,number_format($p_tot,2)." ",'LR',0,'R',0);
		
		
		
		$this->SetFont('');
		
		if($datos!=''){
		
		$datosformat=$this->WriteHTML($datos);
		$datosformat=(string)$datosformat;
		
		$datosformat=str_replace('&nbsp;','',$datosformat);
		//$datosformat="dsgsdhjsjhiotdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddjhe";
		
		$temp_datosformat=explode('<br />',$datosformat);
				
		for($j=0; $j<count($temp_datosformat);$j++){
		
		$datosformat=$temp_datosformat[$j];		
		
		$caractxlinea=62;
		$longtotal=strlen($datosformat);
		$iteraciones=intval($longtotal/$caractxlinea);
		$temp=0;	
		 
		 	for($i=0; $i<$iteraciones;$i++){									
			$this->Ln();
			$this->Cell(5,5,'','',0,'C',0);
			$this->Cell(20,5,'','LR',0,'C',0);
			$this->Cell(120,5,substr($datosformat,$temp,$caractxlinea),'LR',0,'L',0);
			$this->Cell(20,5," ",'LR',0,'R',0);
			$this->Cell(20,5," ",'LR',0,'R',0);
							
			$temp=$temp+$caractxlinea;	
			}	
						
			$this->Ln();
			$this->Cell(5,5,'','',0,'C',0);
			$this->Cell(20,5,'','LR',0,'C',0);
			$this->Cell(120,5,substr($datosformat,$temp,$caractxlinea),'LR',0,'L',0);
			$this->Cell(20,5," ",'LR',0,'R',0);
			$this->Cell(20,5," ",'LR',0,'R',0);	
			//$this->Cell(120,5,$this->WriteHTML($datos),'LR',0,'L',0);		
		}
		
		
		}
		
		
		}
		$this->Ln();
		$this->Cell(5,5,'',0,0,'C',0);
		$this->Cell(20,5,'','LRB',0,'C',0);
		$this->Cell(120,5,'','LRB',0,'C',0);
		$this->Cell(20,5,'','LRB',0,'C',0);
		$this->Cell(20,5,'','LRB',0,'C',0);
		$this->Ln();
/*
		$this->Cell(5,5,'',0,0,'C',0);
		$this->Cell(20,5,'','LB',0,'C',0);
		$this->Cell(120,5,'SubTotal','RB',0,'R',0);
		$this->Cell(20,5,$moneda,'LRB',0,'C',0);
		$this->Cell(20,5,number_format($m_bruto,2)." ",'LRB',0,'R',0);
		
		$this->Ln();
		$this->Cell(5,5,'',0,0,'C',0);
		$this->Cell(20,5,'','LB',0,'C',0);
		$this->Cell(120,5,'IGV','RB',0,'R',0);
		$this->Cell(20,5,$moneda,'LRB',0,'C',0);
		$this->Cell(20,5,number_format($igv,2)." ",'LRB',0,'R',0);
		$this->Ln();
		*/
		$this->Cell(5,5,'',0,0,'C',0);
		$this->Cell(20,5,'','LB',0,'C',0);
		$this->Cell(120,5,'Total','RB',0,'R',0);
		$this->Cell(20,5,$moneda,'LRB',0,'C',0);
		$this->Cell(20,5,number_format($m_total,2)." ",'LRB',0,'R',0);
		
		/*
		$this->Ln();
		$this->Cell(5,5,'',0,0,'C',0);
		$this->Cell(20,5,'','LB',0,'C',0);
		$this->Cell(120,5,'Total Soles','RB',0,'R',0);
		$this->Cell(20,5,'S/.','LRB',0,'C',0);
		$this->Cell(20,5,number_format($m_soles,2)." ",'LRB',0,'R',0);
		*/
		
		
		
		$this->Ln(10);
		$this->SetFont('Arial','B',11);
		$this->Cell(5,6,'',0,0,'L');
		$this->Cell(30,6,'  Condiciones Comerciales :',0,0,'L');
		$this->SetFont('Arial','',10);
		$this->Ln(5);
		$this->Cell(10,6,'',0,0,'L');
		$this->Cell(40,6,'Los Precios',0,0,'L');
		$this->Cell(10,6,':',0,0,'R');
		$this->Cell(50,6,$incluido,0,0,'L');
		$this->Ln(5);
		$this->Cell(10,6,'',0,0,'L');
		$this->Cell(40,6,$etiquetaOSB1,0,0,'L');
		$this->Cell(10,6,':',0,0,'R');
		$this->Cell(50,6,$obs1,0,0,'L');

		$this->Ln(5);
		$this->Cell(10,6,'',0,0,'L');
		$this->Cell(40,6,$etiquetaOSB2,0,0,'L');
		$this->Cell(10,6,':',0,0,'R');
		$this->Cell(50,6,$obs2,0,0,'L');
		
		$this->Ln(5);
		$this->Cell(10,6,'',0,0,'L');
		$this->Cell(40,6,$etiquetaOSB3,0,0,'L');
		$this->Cell(10,6,':',0,0,'R');
		$this->Cell(50,6,$obs3,0,0,'L');
		
		/*
		$this->Ln(20);
		$this->Cell(100,6,'',0,0,'C');
		$this->Cell(40,6,"Atentamente, ",0,0,'C');
		
		
		$this->Ln(5);
		$this->Cell(100,6,'',0,0,'C');
		$this->Cell(40,6,$nombresUser,0,0,'C');
		
		$this->Ln(5);
		$this->Cell(100,6,'',0,0,'C');
		$this->Cell(40,6,$telefono1User,0,0,'C');
		
		$this->Ln(5);
		$this->Cell(100,6,'',0,0,'C');
		$this->Cell(40,6,$emailUser,0,0,'C');
		
		//$this->Cell(10,6,':',0,0,'R');
		//$this->Cell(50,6,$obs3,0,0,'L');
		
		*/
		
		$this->Image('../imagenes/marcas2.jpg',15,250,170);
		
		$this->Ln(2);
		$this->SetFont('Arial','B',9);
		$this->Cell(10,6,'',0,0,'L');
		$this->Cell(40,6," C.C Compuplaza Jr. Camana 1152 Tda. 240-241 Tda.233 - Lima ",0,0,'L');
		$this->Ln(5);
		$this->Cell(10,6,'',0,0,'L');
		$this->Cell(40,6," Cyber Plaza Av. Garcilazo de la Vega 1348 Tda. 1A-134 / Tda. 1A-124 ",0,0,'L');
		
		/*
		$this->Ln(-5);
		$this->SetFont('Arial','',7);
		$this->Ln(10);
		$this->Cell(10,3,'',0,0,'L');
		$this->Cell(10,3,'M-M:',0,0,'L');
		$this->Cell(70,3,'Movistar a Movistar',0,0,'L');
		$this->Ln();
		$this->Cell(10,3,'',0,0,'L');
		$this->Cell(10,3,'M-O :',0,0,'L');
		$this->Cell(40,3,'Movistar a otros destinos',0,0,'L');
		$this->Ln();
		$this->Cell(10,3,'',0,0,'L');
		$this->Cell(10,3,'M-LDI :',0,0,'L');
		$this->Cell(40,3,'Movistar a larga distancia internacional',0,0,'L');
		
		
		$this->Ln(10);
		*/
			
	}
		
	function Footer()
	{
		//Posicin: a 1,5 cm del final
		$this->SetY(-15);
		//Arial italic 8
		$this->SetFont('Arial','B',8);
		$this->Cell(25,6,'',0,0,'L');
		$this->Cell(50,6,$this->telSuc,0,0,'L');
		//$this->Cell(3,6,':',0,0,'R');
		//$this->Cell(30,6,$this->telSuc,0,0,'L');
		$this->Ln(5);
		$this->Cell(10,6,'',0,0,'L');
		$this->Cell(60,6,"Email : ".$this->emailSuc,0,0,'L');
		$this->Cell(60,6,'',0,0,'L');
		$this->Cell(50,6,"Web: ".$this->webSuc,0,0,'L');
		//Nmero de pgina
		//$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
	
	
	function AcceptPageBreak()
	{
			
		//	$this->line(13,187,278,187);				
			return true;
			
	}
	
	
	

  function WriteHTML($html)
{
    //HTML parser
    $html=strip_tags($html,"<b><u><i><a><img><br><strong><em><font><tr><blockquote>"); //supprime tous les tags sauf ceux reconnus
    $html=str_replace("\n",' ',$html); //remplace retour à la ligne par un espace
    $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE); //éclate la chaîne avec les balises
    
   return $html;
   /*
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            //Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,stripslashes(txtentities($e)));
        }
        else
        {
            //Tag
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                //Extract attributes
                $a2=explode(' ',$e);
                $tag=strtoupper(array_shift($a2));
                $attr=array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])]=$a3[2];
                }
              //  $this->OpenTag($tag,$attr);
            }
        }
    }
	*/
}

function OpenTag($tag, $attr)
{
    //Opening tag
    switch($tag){
        case 'STRONG':
            $this->SetStyle('B',true);
            break;
        case 'EM':
            $this->SetStyle('I',true);
            break;
        case 'B':
        case 'I':
        case 'U':
            $this->SetStyle($tag,true);
            break;
        case 'A':
            $this->HREF=$attr['HREF'];
            break;
        case 'IMG':
            if(isset($attr['SRC']) && (isset($attr['WIDTH']) || isset($attr['HEIGHT']))) {
                if(!isset($attr['WIDTH']))
                    $attr['WIDTH'] = 0;
                if(!isset($attr['HEIGHT']))
                    $attr['HEIGHT'] = 0;
                $this->Image($attr['SRC'], $this->GetX(), $this->GetY(), px2mm($attr['WIDTH']), px2mm($attr['HEIGHT']));
            }
            break;
        case 'TR':
        case 'BLOCKQUOTE':
        case 'BR':
            $this->Ln(5);
            break;
        case 'P':
            $this->Ln(10);
            break;
        case 'FONT':
            if (isset($attr['COLOR']) && $attr['COLOR']!='') {
                $coul=hex2dec($attr['COLOR']);
                $this->SetTextColor($coul['R'],$coul['V'],$coul['B']);
                $this->issetcolor=true;
            }
            if (isset($attr['FACE']) && in_array(strtolower($attr['FACE']), $this->fontlist)) {
                $this->SetFont(strtolower($attr['FACE']));
                $this->issetfont=true;
            }
            break;
    }
}

function CloseTag($tag)
{
    //Closing tag
    if($tag=='STRONG')
        $tag='B';
    if($tag=='EM')
        $tag='I';
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF='';
    if($tag=='FONT'){
        if ($this->issetcolor==true) {
            $this->SetTextColor(0);
        }
        if ($this->issetfont) {
            $this->SetFont('arial');
            $this->issetfont=false;
        }
    }
}

function SetStyle($tag, $enable)
{
    //Modify style and select corresponding font
    $this->$tag+=($enable ? 1 : -1);
    $style='';
    foreach(array('B','I','U') as $s)
    {
        if($this->$s>0)
            $style.=$s;
    }
    $this->SetFont('',$style);
}

function PutLink($URL, $txt)
{
    //Put a hyperlink
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}


	
} 


class PDF_HTML extends FPDF
{
   
}



$pdf=new PDF();

$pdf->SetFont('Arial','',10);
$pdf->AliasNbPages();
$pdf->AddPage('P');
//$pdf->BasicTable($header,$data);
//$pdf->AddPage();
//$pdf->ImprovedTable($header,$data);
//$pdf->AddPage();

//$pdf->SetDrawColor(100,100,0);/proformadatos.gif 

$pdf->Image('../imagenes/proforma_logo.jpg',15,20,185);
$pdf->Image('../imagenes/proformaimg.jpg',110,60,90);
$pdf->Image('../imagenes/proformaimg.jpg',110,60,90);

//$pdf->Image('../imagenes/tarjetas.jpg',110,560,90);

//$pdf->Image('../imagenes/proformadatos.jpg',15,40,90);
//$pdf->Image('../imagenes/proformanumero.jpg',110,38,90);
//$pdf->Image('../imagenes/proformafecha.jpg',110,52,90);

//$pdf->Cell(150,8,'3.-REQUISITOS',0,0,'L');
$pdf->FancyTable($data);
//$pdf->Output();
/*
$pdf2=new PDF_HTML();
$pdf2->AddPage();
$pdf2->SetFont('Arial');
$pdf2->WriteHTML($datanueva);
*/
$pdf->Output("proforma.pdf","D");

?>