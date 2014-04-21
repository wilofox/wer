<?php 
//include('sesion.php');
require('../../fpdf2/fpdf.php');
include('../../conex_inicial.php');
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
		
	
		
	include('../../conex_inicial.php');
	include('../../funciones/funciones.php');
	
		$sucursal=$_REQUEST['sucursal'];
		$tienda=$_REQUEST['almacen'];
		$tipo=$_REQUEST['tipo'];
		$cliente=$_REQUEST['cliente'];
		$k=0;

		$fecha1=($_REQUEST['fecha']);
		$fecha2=($_REQUEST['fecha2']);
		
		if($tienda==0){
		$etiqTien=" Todas las Tiendas ";
		}else{
		
		list($nom_tienda)=mysql_fetch_row(mysql_query("select des_tienda from tienda where cod_tienda='".$tienda."'"));
		$etiqTien=$nom_tienda;
		}
		
		if($sucursal==0){
		$etiqEmp=" Todas las Empresas ";
		}else{
		
		list($nom_emp)=mysql_fetch_row(mysql_query("select des_suc from sucursal where cod_suc='".$sucursal."'"));
		$etiqEmp=$nom_emp;
		}	
			
		
		
		if($tipo=='1'){
		$des_tipo=" COMPRAS ";
		}else{
		$des_tipo=" VENTAS ";
		}
		
		
		$this->SetFont('Arial','B',10);
		
		//$this->Cell(10,6,'',0,0,'L');
		$this->Cell(180,8,htmlspecialchars(" RELACIÓN DE DOCUMENTOS DE $des_tipo  "),0,0,'C');
		$this->SetFont('Arial','',8);
		$this->Ln(5);
		$this->Cell(180,8,$etiqEmp." / ".$etiqTien,0,0,'C');
		$this->Ln(5);
		$this->Cell(180,8," Del: $fecha1 Al: $fecha2 ",0,0,'C');
		
		$this->Ln(20);
			
		
		$this->SetFillColor('248','248','248'); 
		$this->SetFont('Arial','B',7);
		
		//$this->Cell(5,5,'',0,0,'C',0);
		
		$this->Cell(5,5,'Alm','TB',0,'C',1);		
		$this->Cell(5,5,'TD','TB',0,'C',1);
		$this->Cell(20,5,'Documento','TB',0,'C',1);
		$this->Cell(15,5,htmlspecialchars('Emisión'),'TB',0,'C',1);
		$this->Cell(20,5,'Doc.Ref(A)','TB',0,'C',1);
		$this->Cell(20,5,'Doc.Ref(O)','TB',0,'C',1);
		$this->Cell(20,5,htmlspecialchars('Condición'),'TB',0,'L',1);
		$this->Cell(45,5,htmlspecialchars('Razón Social'),'TB',0,'L',1);
		$this->Cell(20,5,'Responsable','TB',0,'L',1);		
		$this->Cell(5,5,'Mon','TB',0,'C',1);
		$this->Cell(20,5,'Importe','TB',0,'C',1);
				
		
		
		 $registros = 40; 
					   $pagina = $_REQUEST['pagina']; 
					   
					   
			//	echo "pag".$pagina;
		
				if ($pagina=='' || $pagina=='X') { 
				$inicio = 0; 
				$pagina = 1; 

				} else { 
				$inicio = ($pagina - 1) * $registros; 
				} 
			
  			
				$fecha1=formatofecha($_REQUEST['fecha']);
				$fecha2=formatofecha($_REQUEST['fecha2']);
		
			
			$fecha3=$_REQUEST['fecha3'];
			$percepcion=$_REQUEST['percepcion'];
			
			$sinreferencia=$_REQUEST['sinreferencia'];
			$soloanul=$_REQUEST['soloanul'];
					//echo "--->".$soloanul;
			$tot_importe=0;
			$tot_igv=0;
			$tot_tot=0;
			$tot_item=0;
			
			$vendedor=$_REQUEST['vendedor'];
			if($vendedor!="000"){
			$filtro1=" and cod_vendedor='$vendedor' ";
			}else{
			$filtro1="";
			}
			
			$serie=$_REQUEST['serie'];
			if($serie!="000"){
			$filtro2=" and serie='$serie' ";
			}else{
			$filtro2="";
			}
			
			$turno=$_REQUEST['turno'];
			if($turno!="000"){
			
			$temp_turno=$_REQUEST['turno'];
			$strsql="select * from turno where id='$temp_turno'";
			$resultado=mysql_query($strsql,$cn);
			$row=mysql_fetch_array($resultado);
			$hinicio=$row['hinicio'];
			$hfin=$row['hfin'];
			
			
			//$fecha=date('d/m/Y');
			
			$filtro3=" and substring(fecha,12,9) between '$hinicio' and '$hfin' ";
			
			}else{
			$filtro3="";
			}			
			
			//echo $_REQUEST['tickets']."<br>"; 
			/*
			if($_REQUEST['tickets']=='false' and $tipo=='2'){
			//$filtro4=" and ( cod_ope='TB' or cod_ope='TF' ) ";
			$filtro4=" and deuda='S' ";
			}else{
			$filtro4='';
			}			
			*/
			
			//echo "S=".$sucursal;
			if($sucursal=='0'){
			$filtro5="";
			}else{
			//echo "-->";
				if($tienda=='0'){
				$filtro5=" and sucursal='$sucursal' ";					
				}else{
				$filtro5=" and sucursal='$sucursal' and tienda='$tienda' ";					
				}
				
			}
			
			if($cliente!=''){
			//$filtro4=" and ( cod_ope='TB' or cod_ope='TF' ) ";
			$filtro6=" and cliente='$cliente' ";
			}else{
			$filtro6='';
			}	
		
			$cant_tfa=0;
			$tot_tfa=0;
			$cant_tbv=0;
			$tot_tbv=0;
			$cant_tanu=0;
			$total_tanu=0;
			$cant_otros=0;
			$tot_otros=0;
			$tipdoc="";
						
			if($tipo==1){
			$rstemp	=	mysql_query("Select documentos from temp where cod_user='".$_REQUEST['coduser']."' and reporte='REGISTRO_COMPRAS'",$cn);
			}else{
			$rstemp	=	mysql_query("Select documentos from temp where cod_user='".$_REQUEST['coduser']."' and reporte='REGISTRO_VENTAS'",$cn);
			}
			
			
	$rowtemp=	mysql_fetch_array($rstemp);
	if( !empty( $rowtemp['documentos'] ) ){ 
	$filtro56 = " ".$rowtemp['documentos'];	
	$tipdoc="and cod_ope in (".$filtro56.")";
	}

	if($_REQUEST['agdoc']=='v_normal'){
	$order=" order by CONCAT(LEFT(fecha,10),cod_ope,serie,Num_doc) ";
	}elseif($_REQUEST['agdoc']=='ag_dia'){
	$order=" order by CONCAT(LEFT(fecha,10),cod_ope,serie,Num_doc) ";
	}else{
		$order=" order by CONCAT(cod_ope,serie,Num_doc,LEFT(fecha,10)) ";
	}
	$ffecha="fecha";
	if($fecha3!=''){
		$ffecha=$fecha3;
	}
	
	if($_REQUEST['condicion']!=0){
	$filtro7= " and condicion='".$_REQUEST['condicion']."'";
	}
	//echo "-->".$percepcion;
	$filtroPercep=" ";
	if($percepcion == 'S'){
	$filtroPercep = " and percepcion >0 ";
	}
	
	$filtroRef="";
	if($sinreferencia=='S'){
	$filtroRef=" and flag_r='' ";
	}
	
	$filtroSoloanul="";
	if($soloanul=='S'){
	$filtroSoloanul=" and flag='A' ";
	}
	
	if($_REQUEST['serieDoc']!='' && $_REQUEST['numeroDoc']!=''){
	$serieDoc=str_pad($_REQUEST['serieDoc'],3,"0",STR_PAD_LEFT);
	$numeroDoc=str_pad($_REQUEST['numeroDoc'],7,"0",STR_PAD_LEFT);
	$filtroSerNum=" and serie='".$serieDoc."' and Num_doc='".$numeroDoc."' ";
	}
					
			$strSQL="select * from cab_mov where tipo='$tipo' $tipdoc and substring($ffecha,1,10) between '$fecha1' and '$fecha2'  $filtroSerNum ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$filtro6.$filtro7.$filtroPercep.$filtroRef.$filtroSoloanul.$order;
			
	
			//echo $strSQL;
			 
			  $resultados = mysql_query($strSQL,$cn);
			  $total_registros = mysql_num_rows($resultados); 
			  if(!isset($_REQUEST['excel'])){
			  $resultados = mysql_query($strSQL." LIMIT $inicio, $registros " ,$cn);
			  }
										
					
	//echo $strSQL." LIMIT $inicio, $registros ";
			  $resultados2 =mysql_num_rows($resultados); 
			  $total_paginas = ceil($total_registros / $registros);  
			$fec_prev="";$td_prev="";
			$cont=0;	
			while($row=mysql_fetch_array($resultados)){
			
			$fecha=$row['fecha'];
			$fechav=$row['f_venc'];
			$td=$row['cod_ope'];
			$documento=$row['serie']." - ".$row['Num_doc'];	
	
			$importe=$row['b_imp'];
			$igv=$row['igv'];
			$total=$row['total'];
			$items=$row['items'];
			$imp_percepcion=$row['percepcion'];
			
			$noperacion=$row['noperacion'];
			
			$flag=$row['flag'];
			$referencia=$row['cod_cab'];
			$moneda=$row['moneda'];
			$cliente=$row['cliente'];
			$condicion=$row['condicion'];
			$codxvend=$row['cod_vendedor'];
			$kardexDoc=$row['kardex'];
			$audita=$row['audita'];
			$tienda=$row['tienda'];
			
			$color_texto="";
			if($audita=='1'){
			$color_texto="#009999";
			}
			if($audita=='2'){
			$color_texto="#FF6B24";
			}
			
			/*
			if($cliente!=""){
			$clix=mysql_fetch_array(mysql_query("select ruc,razonsocial from cliente where codcliente=".$cliente." and ruc!=''"));
			}
			*/
			if($td!='TS'){
			$clix=mysql_fetch_array(mysql_query("select ruc,razonsocial,tipo_aux,ubigeo from cliente where codcliente='".$cliente."'"));
			$tipoaux=$clix['tipo_aux'];
			$razonsocial=$clix['razonsocial'];
			$ubigeox=$clix['ubigeo'];
			
			$conx=mysql_fetch_array(mysql_query("select * from condicion where codigo='".$condicion."'"));
			$descrip_cond=$conx['nombre'];
			
			$usux=mysql_fetch_array(mysql_query("select * from usuarios where codigo='".$codxvend."'"));
			$descrip_usua=$usux['usuario'];
			
			//echo "<br>----".$ubigeox."----<br>";
			$ubix=mysql_fetch_array(mysql_query("select * from ubigeo where id='".$ubigeox."'"));
			$descrip_dist=$ubix['desdist'];
			$descrip_prov=$ubix['desprovi'];
			$descrip_depa=$ubix['desdepa'];
			
			}else{
			
				if($tipo=='2'){
				$temp_tipo='1';
				$texto=" Enviado a: ";
				}else{
				$temp_tipo='2';
				$texto=" Recibido de: ";
				}
			
			$clix=mysql_fetch_array(mysql_query("select des_tienda from cab_mov,tienda where serie='".$row['serie']."' and Num_doc='".$row['Num_doc']."' and tipo='".$temp_tipo."' and cod_ope='TS' and cod_tienda=tienda "));
			$tipoaux='';
			$razonsocial=$texto.$clix['des_tienda'];
			$descrip_cond="Translado";
			}
			
			
			if($moneda=='02'){

			$moneda=" US$. ";
			}else{
			$moneda=" S/. ";
			}
			if($_REQUEST['agdoc']=='ag_dia'){
			if(substr($fecha,0,10)!=$fec_prev ){
			
			if($cont>0){
			//echo "doc".$td;
			echo $prev_sub;
			}
			
			echo"<tr><td colspan='5'>Fecha:".extraefecha4(substr($fecha,0,10))."</td></tr>";
			$prev_sub=mostrar_sub_total($td,substr($fecha,0,10));
			}
				
			if($td!=$td_prev && $cont>0 && substr($fecha,0,10)==$fec_prev){
			
				//echo "doc".$td;
			echo $prev_sub;
			echo"<tr><td colspan='5'>&nbsp;&nbsp;&nbsp;Documento:".$td."</td></tr>";
$prev_sub=mostrar_sub_total($td,substr($fecha,0,10));

			$cont=0;
			}elseif(substr($fecha,0,10)!=$fec_prev){
			echo"<tr><td colspan='5'>&nbsp;&nbsp;&nbsp;Documento:".$td."</td></tr>";

			$cont=0;
			}
			}
			if($_REQUEST['agdoc']=='ag_doc'){
				//echo $td."!=".$td_prev ."&&". $cont.">0"; 
				
			//if(substr($fecha,0,10)!=$fec_prev ){
			/*
			if($td!=$td_prev && $cont==0){
			//echo "doc".$td;
			echo $prev_sub;
			}
			
			//echo"<tr><td colspan='5'>Fecha:".substr($fecha,0,10)."</td></tr>";
			$prev_sub=mostrar_sub_total($td,substr($fecha,0,10));
			//}
			*/
				
				if($td!=$td_prev && $cont>0 ){
				
				
				echo $prev_sub;
				echo"<tr><td colspan='5'>&nbsp;&nbsp;&nbsp;Documento:".$td."</td></tr>";
	//$prev_sub=mostrar_sub_total($td,substr($fecha,0,10));
	
				$cont=0;
				}elseif($td!=$td_prev && $cont==0){
				echo $prev_sub;
				echo"<tr><td colspan='5'>&nbsp;&nbsp;&nbsp;Documento:".$td."</td></tr>";
	
				$cont=0;
				}
					$prev_sub=mostrar_sub_total($td,substr($fecha,0,10));
			}
			
			
			list($cod_cabRef)	=	mysql_fetch_array(mysql_query("select cod_cab_ref from referencia where cod_cab='".$referencia."'"));
		
		
		    list($cod_cabRef,$serieRef,$numeroRef)	=	mysql_fetch_array(mysql_query("select cod_ope,serie,Num_doc from cab_mov where cod_cab='".$cod_cabRef."'"));
		
		    $docRefer=$cod_cabRef." ".$serieRef." ".$numeroRef;
			
			
			list($cod_cabRef)	=	mysql_fetch_array(mysql_query("select cod_cab from referencia where cod_cab_ref='".$referencia."'"));
		
		
		    list($cod_cabRef,$serieRef,$numeroRef)	=	mysql_fetch_array(mysql_query("select cod_ope,serie,Num_doc from cab_mov where cod_cab='".$cod_cabRef."'"));
		
		    $docRefer2=$cod_cabRef." ".$serieRef." ".$numeroRef;
			
			
			
			
				if($flag!='A'){
				
				$tot_importe=$tot_importe+$importe;
				$tot_igv=$tot_igv+$igv;
				$tot_tot=$tot_tot+$total;	
				$tot_item=$tot_item+$items;
				
				if($td=='TB'){
				$cant_tbv=$cant_tbv+1;
				$tot_tbv=$tot_tbv+$total;
				}else{
					if($td=='TF'){
					$cant_tfa=$cant_tfa+1;
					$tot_tfa=$tot_tfa+$total;
					}else{
					$cant_otros++;
					$tot_otros=$tot_otros+$total+$imp_percepcion;
					}
				}
				//echo substr($fecha,0,10)."!=".$fec_prev;
	
				
				if($td=="NC"){
				$importe=$importe*(-1);
				$igv=$igv*(-1);
				$total=$total*-1;
				$items=$items*-1;
				}
			
			$this->SetTextColor(0,0,0);
			$this->SetFont('Arial','',7);			
			
			$this->Ln();
			$this->Cell(5,5,$tienda,0,0,'C',0);		
			$this->Cell(5,5,$td,0,0,'C',0);
			$this->Cell(20,5,$documento,0,0,'C',0);
			$this->Cell(15,5,extraefecha($fecha),0,0,'C',0);
			$this->Cell(20,5,$docRefer,0,0,'C',0);
			$this->Cell(20,5,$docRefer2,0,0,'C',0);
			$this->Cell(20,5,htmlspecialchars(substr($descrip_cond,0,15)),0,0,'L',0);
			$this->Cell(45,5,htmlspecialchars(substr($razonsocial,0,26)) ,0,0,'L',0);
			$this->Cell(20,5,$descrip_usua,0,0,'L',0);		
			$this->Cell(5,5,$moneda,0,0,'C',0);
			$this->Cell(20,5,number_format($total+$imp_percepcion,2),0,0,'R',0);
				
			
			}else{
				$cant_tanu=$cant_tanu+1;
				$total_tanu=$total_tanu+$total;
			
			$this->SetTextColor(238,0,0); 
			$this->SetFont('Arial','',7);
				
			$this->Ln();
			$this->Cell(5,5,$tienda,0,0,'C',0);		
			$this->Cell(5,5,$td,0,0,'C',0);
			$this->Cell(20,5,$documento,0,0,'C',0);
			$this->Cell(15,5,extraefecha($fecha),0,0,'C',0);
			$this->Cell(20,5,'',0,0,'C',0);
			$this->Cell(20,5,'',0,0,'C',0);
			$this->Cell(20,5,htmlspecialchars(substr($descrip_cond,0,15)),0,0,'L',0);
			$this->Cell(45,5,htmlspecialchars(substr($razonsocial,0,26)) ,0,0,'L',0);
			/*
			$this->Cell(20,5,$descrip_usua,0,0,'L',0);		
			$this->Cell(5,5,$moneda,0,0,'C',0);
			$this->Cell(20,5,number_format($total+$imp_percepcion,2),0,0,'R',0);
			*/
			$this->Cell(45,5,"A N U L A D O",0,0,'C',0);
			
				
			}	
		
		
		}//fin while
		
		
		//******************************* CALCULOS TOTALES *******************************
		
		
			$filtroPercep=" ";
			if($percepcion == 'S'){
			$filtroPercep = " and percepcion >0 ";
			}
		 
		  $strSQL_tot="select sum(total) as total,sum(percepcion) as percepcion, sum(items) as item, count(cod_cab) as cantidad, sum(b_imp) as base,sum(igv) as igv from cab_mov where tipo='$tipo' and flag!='A'   $tipdoc and cod_ope!='NC' and moneda='01' and substring(fecha,1,10) between '$fecha1' and '$fecha2' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$filtro6.$filtroPercep." order by cod_cab ";
		  //echo $strSQL_tot;
		  $resultado=mysql_query($strSQL_tot,$cn);
		  $row_tot=mysql_fetch_array($resultado);
		  
		  $totgen_cant1=$row_tot['cantidad'];
		  $totgen_item1=number_format($row_tot['item'],2);
		  $totgen_base1=number_format($row_tot['base'],2);
		  $totgen_igv1=number_format($row_tot['igv'],2);
		  $totgen_total1=number_format($row_tot['total']+$row_tot['percepcion'],2);
		  $percepcionSoles=number_format($row_tot['percepcion'],2);
		  
		  
		  $strSQL_tot="select sum(total) as total,sum(percepcion) as percepcion, sum(items) as item, count(cod_cab) as cantidad, sum(b_imp) as base,sum(igv) as igv from cab_mov where tipo='$tipo' and flag!='A' $tipdoc and cod_ope!='NC' and moneda='02' and substring(fecha,1,10) between '$fecha1' and '$fecha2' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$filtro6.$filtroPercep." order by cod_cab ";
		  $resultado=mysql_query($strSQL_tot,$cn);
			//echo $strSQL_tot;
		  $row_tot=mysql_fetch_array($resultado);
		  
		  $totgen_cant2=$row_tot['cantidad'];
		  $totgen_item2=number_format($row_tot['item'],2);
		  $totgen_base2=number_format($row_tot['base'],2);
		  $totgen_igv2=number_format($row_tot['igv'],2);
		  $totgen_total2=number_format($row_tot['total']+$row_tot['percepcion'],2);
		  $percepcionDolar=number_format($row_tot['percepcion'],2);
		  
  			
			$totalGenAnul=$totgen_cant1_a + $totgen_cant2_a;
			
			$this->SetTextColor(0,0,0); 
			$this->SetFont('Arial','B',8);				
			$this->Ln();
			$this->Cell(10,5,'',0,0,'C',0);		
			$this->Cell(10,5,'',0,0,'C',0);
			$this->Cell(20,5,'',0,0,'C',0);
			$this->Cell(20,5,'',0,0,'C',0);
			$this->Cell(20,5,'',0,0,'C',0);
			$this->Cell(20,5,'',0,0,'C',0);
			$this->Cell(20,5,'','T',0,'L',0);
			$this->Cell(30,5,'','T',0,'L',0);			
			$this->Cell(45,5,'','T',0,'R',0);
			
			
  
			$this->SetTextColor(0,0,0); 
			$this->SetFont('Arial','B',8);				
			$this->Ln(5);
			$this->Cell(10,5,'',0,0,'C',0);		
			$this->Cell(10,5,'',0,0,'C',0);
			$this->Cell(20,5,'',0,0,'C',0);
			$this->Cell(20,5,'',0,0,'C',0);
			$this->Cell(20,5,'',0,0,'C',0);
			$this->Cell(20,5,'',0,0,'C',0);
			$this->Cell(20,5,'',0,0,'L',0);
			$this->Cell(30,5,'Total General S/.( '.$totgen_cant1.' ) ',0,0,'L',0);
			
			$this->Cell(45,5,$totgen_total1,0,0,'R',0);
			
			
			$this->SetTextColor(0,0,0); 
			$this->SetFont('Arial','B',8);				
			$this->Ln();
			$this->Cell(10,5,'',0,0,'C',0);		
			$this->Cell(10,5,'',0,0,'C',0);
			$this->Cell(20,5,'',0,0,'C',0);
			$this->Cell(20,5,'',0,0,'C',0);
			$this->Cell(20,5,'',0,0,'C',0);
			$this->Cell(20,5,'',0,0,'C',0);
			$this->Cell(20,5,'',0,0,'L',0);
			$this->Cell(30,5,'Total General US$. ( '.$totgen_cant2.' ) ',0,0,'L',0);
			
			$this->Cell(45,5,$totgen_total2,0,0,'R',0);
			
			$this->SetTextColor(238,0,0); 
			$this->SetFont('Arial','',8);			
			$this->Ln();
			$this->Cell(10,5,'',0,0,'C',0);		
			$this->Cell(10,5,'',0,0,'C',0);
			$this->Cell(20,5,'',0,0,'C',0);
			$this->Cell(20,5,'',0,0,'C',0);
			$this->Cell(20,5,'',0,0,'C',0);
			$this->Cell(20,5,'',0,0,'C',0);
			$this->Cell(20,5,'',0,0,'L',0);
			$this->Cell(30,5,'**Total Anulados  ( '.$cant_tanu.' ) ',0,0,'L',0);
			
			$this->Cell(45,5,'',0,0,'R',0);
		
		//******************************************************************
		
		
		
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
		$this->Cell(5,5,'',0,0,'C',0);
		$this->Cell(20,5,'','LB',0,'C',0);
		$this->Cell(120,5,'Total','RB',0,'R',0);
		$this->Cell(20,5,$moneda,'LRB',0,'C',0);
		$this->Cell(20,5,number_format($m_total,2)." ",'LRB',0,'R',0);
			
		*/
		
		/*
		$this->Ln();
		$this->Cell(5,5,'',0,0,'C',0);
		$this->Cell(20,5,'','LB',0,'C',0);
		$this->Cell(120,5,'Total Soles','RB',0,'R',0);
		$this->Cell(20,5,'S/.','LRB',0,'C',0);
		$this->Cell(20,5,number_format($m_soles,2)." ",'LRB',0,'R',0);
		*/
		
		/*
		
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
		$this->Cell(40,6,"Forma de Pago",0,0,'L');
		$this->Cell(10,6,':',0,0,'R');
		$this->Cell(50,6,$condicion,0,0,'L');
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
		
		*/
			
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
	/*
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
		*/
		
		$this->SetY(-15);
		$this->SetFont('Arial','I',8);
		$this->SetTextColor(128);
		$this->Cell(0,10,htmlspecialchars('Página ')." ".$this->PageNo(),0,0,'R');
	}
	
	
	function AcceptPageBreak()
	{
			
		//	$this->line(13,187,278,187);				
			return true;
			
	}

	
} 

$pdf=new PDF('L','mm','A4');

$pdf->SetFont('Arial','',10);
$pdf->AliasNbPages();

$pdf->AddPage('P');
//$pdf->BasicTable($header,$data);
//$pdf->AddPage();
//$pdf->ImprovedTable($header,$data);
//$pdf->AddPage();

//$pdf->SetDrawColor(100,100,0);/proformadatos.gif 

//$pdf->Image('../../imagenes/proforma_logo.jpg',15,20,90);
//$pdf->Image('../../imagenes/proformaimg.jpg',110,20,90);
//$pdf->Image('../../imagenes/proformadatos.jpg',5,5,190);
//$pdf->Image('../../imagenes/proformanumero.jpg',110,38,90);
//$pdf->Image('../../imagenes/proformafecha.jpg',110,52,90);

//$pdf->Cell(150,8,'3.-REQUISITOS',0,0,'L');
$pdf->FancyTable($header,$data);
//$pdf->Output();
$pdf->Output("proforma.pdf","D");


?>