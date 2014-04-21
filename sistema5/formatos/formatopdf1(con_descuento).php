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

	class PDF extends FPDF{
	var  $telSuc;
	var  $emailSuc;
	var  $webSuc;
	var  $comentario1;
	
	
	function Header()
	{

	}
		
	

	function FancyTable($header,$data)
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

$strSQL1= "select * from ubigeo where id= '".$codubigeo."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);

$distrito = $row ['desdist']; 
$provincia = $row ['desprovi']; 
$departamento = $row ['desdepa']; 

$direc_aux= $direc_aux." - ".$distrito." - ".$provincia." - ".$departamento;

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

$this->comentario1=$row ['comentario1'];
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
$tipoDesc=$row_doc['tipoDesc'];

if($tipoDesc=='P'){
$simPorc="%";
}else{
$simPorc="";
}

		$this->Ln(-40);		
		$this->SetFont('Arial','B',14);
		$this->Cell(130,0,'',0,0,'L');
		$this->Cell(30,8,$row_doc['descripcion'],0,0,'C');
		$this->Ln(1);
		
		$this->Ln(15);
			
		$this->SetFont('Arial','B',12);
		$this->Cell(130,8,'',0,0,'L');
		$this->Cell(30,8,"Nro. ".$serie."-".$numero,0,0,'C');
		$this->Ln(1);
		$this->SetFont('Arial','B',10);
		$this->Cell(10,6,'',0,0,'L');
		$this->Cell(80,8,$dessuc,0,0,'C');
		$this->Ln(5);
		$this->Cell(100,8,"RUC ".$rucsuc,0,0,'C');
		$this->Ln(5);
		$this->SetFont('Arial','B',8);
		$this->Cell(100,8,$dirtienda,0,0,'C');
		//Colores, ancho de lnea y fuente en negrita
		$this->Ln(4);
		$this->SetFont('Arial','B',10);
		$this->Cell(130,8,'',0,0,'C');
		$this->Cell(40,6,'Fecha: '.$fecha,0,0,'L');
		
		
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
		$this->Cell(20,6,'  Cargo',0,0,'L');
		$this->Cell(3,6,':',0,0,'R');
		$this->Cell(25,6,$cargo,0,0,'L');
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
		$this->Cell(80,5,utf8_decode('Descripción'),1,0,'C',0);
		$this->Cell(20,5,'P. Unit.',1,0,'C',0);
		$this->Cell(20,5,'Desc.1',1,0,'C',0);
		$this->Cell(20,5,'Desc.2',1,0,'C',0);
		$this->Cell(20,5,'Total',1,0,'C',0);
		
		
		$strSQL= "select * from det_mov where cod_cab= '".$codigo."' " ;
		$resultado = mysql_query ($strSQL,$cn);
		
		while ($row = mysql_fetch_array ($resultado)) {
		
		$cant= $row ['cantidad']; 
		$P =  $row ['cod_prod'];
		$descripcion =  substr($row ['nom_prod'],0,40);
		$p_unit = $row ['precio'];
		$p_tot = $cant * $p_unit;
		
		$desc1=$row['desc1'];
		$desc2=$row['desc2'];
			  
		$strSQL1= "select * from producto where idproducto= '".$P."' " ;
		$resultado1 = mysql_query ($strSQL1,$cn);
		$row1 = mysql_fetch_array ($resultado1);
		$u = $row1 ['und']; 
		$cod_producto=$row1 ['idproducto']; 
		$simanejaser = $row1 ['series']; 
		
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
		$this->Cell(80,5,$descripcion,'LR',0,'L',0);		
		$this->Cell(20,5,number_format($p_unit,2)." ",'LR',0,'R',0);
		
		$this->Cell(20,5,number_format($desc1,2)." ".$simPorc,'LR',0,'C',0);
		$this->Cell(20,5,number_format($desc2,2)." ".$simPorc,'LR',0,'C',0);
		
		$p_tot=$p_tot-($p_tot*$desc1/100);		
		$p_tot=$p_tot-($p_tot*$desc2/100);
										
		$this->Cell(20,5,number_format($p_tot,2)." ",'LR',0,'R',0);
		
		}
		$this->Ln();
		$this->Cell(5,5,'',0,0,'C',0);
		$this->Cell(20,5,'','LRB',0,'C',0);
		$this->Cell(80,5,'','LRB',0,'C',0);
		$this->Cell(20,5,'','LRB',0,'C',0);
		$this->Cell(20,5,'','LRB',0,'C',0);
		$this->Cell(20,5,'','LRB',0,'C',0);
		$this->Cell(20,5,'','LRB',0,'C',0);
		$this->Ln();

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
		$this->Cell(50,6,$incluido." ( 18% ) ",0,0,'L');
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
		
		
		/*
		$this->Image('../imagenes/proformapie.jpg',50,240,190);
		
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
		
		$this->SetFont('Arial','I',8);
		$this->Cell(10,6,'',0,0,'L');
		$this->Cell(180,6,$this->comentario1,0,0,'C');
		
		$this->Ln(5);
		
		$this->SetFont('Arial','I',8);
		$this->Cell(10,6,'',0,0,'L');
		$this->Cell(20,6,$this->telSuc,0,0,'L');
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

$pdf->Image('../imagenes/proforma_logo.jpg',15,20,90);
$pdf->Image('../imagenes/proformaimg.jpg',110,20,90);
$pdf->Image('../imagenes/proformadatos.jpg',15,40,90);
$pdf->Image('../imagenes/proformanumero.jpg',110,38,90);
$pdf->Image('../imagenes/proformafecha.jpg',110,52,90);

//$pdf->Cell(150,8,'3.-REQUISITOS',0,0,'L');
$pdf->FancyTable($header,$data);
//$pdf->Output();
$pdf->Output("proforma.pdf","D");


?>