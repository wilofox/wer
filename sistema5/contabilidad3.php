<?php
session_start();
include('conex_inicial.php');
include('funciones/funciones.php');

//echo "----->ventas , productos mas vendidos (por cliente o por vendedor)  ";
function extraefecha_tc($valor){
	$afecha=explode('-',trim($valor));
	$afecha2=explode(' ',trim($afecha[2]));
	$nfecha=$afecha2[0]."/".$afecha[1]."/".$afecha[0];
	return $nfecha;
}


function UltimoDia($anho,$mes){ 
//echo $anho."-".$mes;
   if (((fmod($anho,4)==0) and (fmod($anho,100)!=0)) or (fmod($anho,400)==0)) { 
       $dias_febrero = 29; 
   } else { 
       $dias_febrero = 28; 
   } 
   //echo "$mes";
   switch($mes) { 
       case 01: return 31; break; 
       case 02: return $dias_febrero; break; 
       case 03: return 31; break; 
       case 04: return 30; break; 
       case 05: return 31; break; 
       case 06: return 30; break; 
       case 07: return 31; break; 
	   case '08': return 31; break; 
       case '09': return 30; break; 
       case 10: return 31; break; 
       case 11: return 30; break; 
       case 12: return 31; break; 
   } 

} 

//echo $_REQUEST['tformato'];

if($_REQUEST['temporal']=='generar'){
				
	if($_REQUEST['tformato']=='consolidado'){
	
	
	/*
	
				
		$mes=$_REQUEST['mes'];
		$anio=$_REQUEST['anio'];
		$periodo=$_REQUEST['periodo'];
		$fecha=$_REQUEST['fecha'];
		$idsucursal=$_REQUEST['sucursal'];
		$idalmacen=$_REQUEST['almacen'];
		$tipo=$_REQUEST['tipo'];
		$modoTC=$_REQUEST['modoTC'];
		
		if($idalmacen=='0'){
			
			$filtro1=" and  c.sucursal='".$idsucursal."' ";				
			
		}else{
		
			$filtro1=" and  c.tienda='".$idalmacen."' ";		
		}
				
		$cc=$_REQUEST['cc1'].$_REQUEST['cc2'].$_REQUEST['cc3'].$_REQUEST['cc4'];
		//echo $cc;
		if($tipo==2){
			$cuentaBI=$_REQUEST['inicuentabi'][0].$_REQUEST['cuentabi'][0];
			$cuentaIGV=$_REQUEST['inicuentaimp'][0].$_REQUEST['cuentaimp'][0];
			$cuentaDes=$_REQUEST['inicuentades'][0].$_REQUEST['cuentades'][0];
			$cuentatotalS=$_REQUEST['inicuentatot'][0].$_REQUEST['cuentatotS'][0];
			$cuentatotalD=$_REQUEST['inicuentatot'][0].$_REQUEST['cuentatotD'][0];
				
			$destinoBI=$_REQUEST['destinobi'][0];
			$destinoIGV=$_REQUEST['destinoimp'][0];
			$destinoDes=$_REQUEST['destinodes'][0];
			$destinototal=$_REQUEST['destinotot'][0];
							
		}else{
				
			$cuentaBI=$_REQUEST['inicuentabi'][1].$_REQUEST['cuentabi'][1];
			$cuentaIGV=$_REQUEST['inicuentaimp'][1].$_REQUEST['cuentaimp'][1];
			$cuentaDes=$_REQUEST['inicuentades'][1].$_REQUEST['cuentades'][1];
			$cuentatotalS=$_REQUEST['inicuentatot'][1].$_REQUEST['cuentatotS'][1];
			$cuentatotalD=$_REQUEST['inicuentatot'][1].$_REQUEST['cuentatotD'][1];
					
			$destinoBI=$_REQUEST['destinobi'][1];
			$destinoIGV=$_REQUEST['destinoimp'][1];
			$destinoDes=$_REQUEST['destinodes'][1];
			$destinototal=$_REQUEST['destinotot'][1];
					
		}
		
		
		
//echo $destinoBI."<br>";
//echo $destinoIGV."<br>";
//echo $destinoDes."<br>";
//echo $destinototal."<br>";
//echo $cuentaBI."<br>";
//echo $cuentaIGV."<br>";
//echo $cuentaDes."<br>";
//echo $cuentatotalS."<br>";
//echo $cuentatotalD."<br>";
						
//echo $_REQUEST['fecha'];;
// and cod_ope in (".$filtro56.")"
						
		//$docxResumir[]="";
		$strSQL22="select * from operacion where substring(p1,17,1)='S' ";
		$resultado22=mysql_query($strSQL22,$cn);
		while($row22=mysql_fetch_array($resultado22)){
			$docxResumir[]="'".$row22['codigo']."'";
		}		
			
		$chkIngresos=$_REQUEST['chkIngresos'];
		//echo $chkIngresos['0'];
		//print_r($docxResumir)."<br>";
		//print_r($chkIngresos)."<br>";
		//	print_r($chkIngresos)."<br>--------".print_r($docxResumir);
		for ($i=0;$i<count($chkIngresos);$i++){
			if(!in_array(stripslashes($chkIngresos[$i]),$docxResumir) ){
				$filtroDoc=$filtroDoc.",".$chkIngresos[$i];
			}else{
				$filtroDoc2=$filtroDoc2.",".$chkIngresos[$i];
			}
		}
					
		$documentos=substr($filtroDoc,1,strlen($filtroDoc));
		//$documentos2=substr($filtroDoc2,1,strlen($filtroDoc2));
		$documentos2=$filtroDoc2;
					
		//$documentos=str_replace("'","",$documentos);
		$documentos=stripslashes($documentos);
		$documentos2=stripslashes($documentos2);
					
		//echo $documentos."<br>";
		//echo $documentos2."<br>";
					
		if($periodo=="D"){
			$tempfecha=explode("-",$fecha);
			$dia=$tempfecha[0];
			$mes=$tempfecha[1];
			$anio=$tempfecha[2];
					
			$strSQL="select substring(fecha,1,10) as fecha,cod_cab,cod_ope,serie,Num_doc,flag,ruc,cliente,tc,b_imp,servicio,percepcion,igv,total,moneda from cab_mov where substring(fecha,6,2)='$dia'and substring(fecha,1,2)='$mes' and substring(fecha,7,4)='$anio' and Num_doc!='' and serie!='' and tienda='".$idsucursal."' and cod_ope in ($documentos) order by fecha";
			$fecha2=$dia.$mes.$anio;
		}else{
			$fecha=$mes.$anio;
			$fecha2=$mes.$anio;
			$strSQL="select substring(fecha,1,10) as fecha,cod_cab,cod_ope,serie,Num_doc,flag,ruc,cliente,tc,b_imp,servicio,percepcion,igv,total,moneda from cab_mov where substring(fecha,6,2)='$mes' and substring(fecha,1,4)='$anio' and Num_doc!='' and serie!='' and tienda='".$idsucursal."' and cod_ope in ($documentos)  order by fecha";
		}
		//echo $strSQL;
						
		if($tipo=='1'){
			$nombreFile="COMPRAS".$idsucursal."_".$fecha2.".txt";
		}else{
			$nombreFile="VENTAS".$idsucursal."_".$fecha2.".txt";
		}
							
	
		$filename = "contabilidad/transferencias/".$nombreFile;
		$archivo = fopen($filename, "a");
		fclose($archivo);
		$archivo = fopen($filename, "w");
		//echo $strSQL;
		$resultado=mysql_query($strSQL,$cn);
		while($row=mysql_fetch_array($resultado)){
			$strSQLSunat="select * from operacion where codigo='".$row['cod_ope']."'";
			$resultadoSunat=mysql_query($strSQLSunat,$cn);
			$rowSunat=mysql_fetch_array($resultadoSunat);
						
			$coddocu=$rowSunat['sunat'];
			$numdocu=$row['serie'].$row['Num_doc'];
			$temp=explode('-',$row['fecha']);
			$fecha=$temp[0].$temp[1].$temp[2];
			if($row['flag']=='A'){$anulado='S';}else{$anulado='N';}
			$codauxiliar=$row['cliente'];
			$tauxiliar='C';
			
			if($coddocu=='07'){
				
				if($destinoBI=='D')$destinoBI='H'; else $destinoBI='D';
				if($destinoIGV=='D')$destinoIGV='H'; else $destinoIGV='D';
				if($destinoDes=='D')$destinoDes='H'; else $destinoDes='D';
				if($destinototal=='D')$destinototal='H'; else $destinototal='D';
							
			}
			
							
			$strCliente="select * from cliente where codcliente='".$row['cliente']."'";
			$resultadoClie=mysql_query($strCliente,$cn);
			$rowClie=mysql_fetch_array($resultadoClie);
			$t_persona=$rowClie['t_persona'];
							
			//if($t_persona=='juridica'){
			if(substr($row['cod_ope'],0,1)=='F'){
				if($rowClie['ruc']==''){
					$ruc='           ';
					//$razon='cliente vario                 ';
					$razon=str_pad(substr($rowClie['razonsocial'],0,30),30, " ", STR_PAD_RIGHT);
				}else{
					$ruc=str_pad($rowClie['ruc'],11, " ", STR_PAD_RIGHT);
					$razon=str_pad(substr($rowClie['razonsocial'],0,30),30, " ", STR_PAD_RIGHT);
				}
			}else{	
				//}else{
				$ruc=str_pad($rowClie['doc_iden'],11, " ", STR_PAD_RIGHT);
				$razon=str_pad(substr($rowClie['razonsocial'],0,30),30, " ", STR_PAD_RIGHT);
			}
	//}	
						
						
			$strSQLTC="select * from tcambio where fecha='".extraefecha_tc($row['fecha'])."'"; 
			$resultadoTC=mysql_query($strSQLTC,$cn);
			$rowTC=mysql_fetch_array($resultadoTC);
	
			//$tc=str_pad(number_format($row['tc'],3),11, "0", STR_PAD_LEFT);
	
			if($modoTC=='1'){
				$tempTC='compra';
			}
			if($modoTC=='2'){
				$tempTC='venta';
			}
			if($modoTC=='3'){
				$tempTC='promedio';
			}
	
	
			//echo "----->".$tempTC;
	
			$tc=str_pad(number_format($rowTC[$tempTC],3),11, "0", STR_PAD_LEFT);

			if($row['moneda']=='01'){
				$moneda='S';
				$tempCuentatot=$cuentatotalS;
			}else{
				$moneda='D';
				$tempCuentatot=$cuentatotalD;
			}

			$codref='  ';
			$numref='          ';
			$b_imp=str_pad(number_format($row['b_imp'],2,".",""),13, "0", STR_PAD_LEFT);
			$servicio=str_pad(number_format($row['percepcion'],2,".",""),13, "0", STR_PAD_LEFT);
			$igv=str_pad(number_format($row['igv'],2,".",""),13, "0", STR_PAD_LEFT);
			$total=str_pad(number_format($row['total'],2,".",""),13, "0", STR_PAD_LEFT);


			$centroCosto=str_pad($cc,5, "0", STR_PAD_LEFT);
			$contBI=str_pad($cuentaBI,15, " ", STR_PAD_RIGHT);
			$destBI=str_pad($destinoBI,1, " ", STR_PAD_LEFT);
			$contIMP=str_pad($cuentaIGV,15, " ", STR_PAD_RIGHT);
			$destIMP=str_pad($destinoIGV,1, " ", STR_PAD_LEFT);
			$contDES=str_pad($cuentaDes,15, " ", STR_PAD_RIGHT);
			$destDES=str_pad($destinoDes,1, " ", STR_PAD_LEFT);
			$contTOT=str_pad($tempCuentatot,15, " ", STR_PAD_RIGHT);
			$destTOT=str_pad($destinototal,1, " ", STR_PAD_LEFT);

			$strSQL2="select * from det_mov d where cod_cab='".$row['cod_cab']."' order by cod_det limit 1";
			$resultado2=mysql_query($strSQL2,$cn);
			$row2=mysql_fetch_array($resultado2);
			$detalle=substr($row2['nom_prod'],0,30);

			$conta.=$coddocu.$numdocu.$fecha.$fecha.$anulado.$codauxiliar.$tauxiliar.$ruc.$razon.$tc.$moneda.$codref.$numref.$b_imp.$servicio.$b_imp.$igv.$total.$centroCosto.$contBI.$destBI.$contIMP.$destIMP.$contDES.$destDES.$contTOT.$destTOT.$detalle.chr(13).chr(10);
		}
//--------------------------------------DOCUMENTOS RESUMIDO--------------------------------------------


		if($periodo=="D"){
			$tempfecha=explode("-",$fecha);
			$dia=$tempfecha[0];
			$mes=$tempfecha[1];
			$anio=$tempfecha[2];
		
			$cant_dias=1;
		}else{
			//echo "sadg";
			$cant_dias=UltimoDia($anio,$mes);
	
		}
		//echo $cant_dias;

		for ( $j = 1 ; $j <= $cant_dias ; $j ++) {
			$dia=str_pad($j, 2, "0", STR_PAD_LEFT);
			$fecha1=$anio."-".$mes."-".$dia;
	
			$temp_doc=explode(",",$documentos2);
			//print_r($temp_doc)."<br>";
			for ( $i = 1 ; $i < count($temp_doc) ; $i ++) {
				$strSQL="select substring(fecha,1,10) as fecha,cod_cab,cod_ope,serie,Num_doc,flag,ruc,cliente,tc,b_imp,servicio,igv,total,moneda from cab_mov where substring(fecha,1,10)='$fecha1' and Num_doc!='' and flag!='A' and serie!=''  and tienda='".$idsucursal."' and cod_ope=".$temp_doc[$i]." order by Num_doc";
				$resultado=mysql_query($strSQL,$cn);
				$k=0;
				$BaseImponible=0;
				$impuesto1=0;
				$total=0;
				$numdocs=mysql_num_rows($resultado);	
				while($row=mysql_fetch_array($resultado)){
		
					$strSQLSunat="select * from operacion where codigo='".$row['cod_ope']."'";
					$resultadoSunat=mysql_query($strSQLSunat,$cn);
					$rowSunat=mysql_fetch_array($resultadoSunat);
			
		
					if($k==0){
						$primerNumDoc=$row['Num_doc'];
						$primerSerieDoc=$row['serie'];
						$primerDoc=$rowSunat['sunat'];
						$primertc=$row['tc'];
						$primerMon=$row['moneda'];;
					}
			
					$Bi_temp=$row['b_imp'];
					$imp_temp=$row['igv'];
					$serv_temp=$row['servicio'];
					$tot_temp=$row['total'];
			
					if($primerMon!=$row['moneda']){
						if($row['moneda']=='02'){
							$Bi_temp=$row['b_imp']*$primertc;
							$imp_temp=$row['igv']*$primertc;
							$serv_temp=$row['servicio']*$primertc;
							$tot_temp=$row['total']*$primertc;
						}else{
							$Bi_temp=$row['b_imp']/$primertc;
							$imp_temp=$row['igv']/$primertc;
							$serv_temp=$row['servicio']/$primertc;
							$tot_temp=$row['total']/$primertc;
				
						}
					}
			
					$BaseImponible=$BaseImponible+$Bi_temp;
					$impuesto1=$impuesto1+$imp_temp;
					$servicios=$servicios+$serv_temp;
					$total=$total+$tot_temp;
						
					$k++;
				}//end while
				$BaseImponible=number_format($BaseImponible,2,".","");
				$impuesto1=number_format($impuesto1,2,".","");
				$servicios=number_format($servicios,2,".","");
				$total=number_format($total,2,".","");
		
				$coddocu=$primerDoc;
				$numdocu=$primerSerieDoc.$primerNumDoc;
				//$temp=explode('-',$fecha1);
				$fecha=$anio.$mes.$dia;
				//if($row['flag']=='A'){$anulado='S';}else{$anulado='N';}
				$anulado='N';
				$codauxiliar="000001";
				$tauxiliar='C';
				
				//$strCliente="select * from cliente where codcliente='".$row['cliente']."'";
//				$resultadoClie=mysql_query($strCliente,$cn);
//				$rowClie=mysql_fetch_array($resultadoClie);
				
	
				//if($rowClie['ruc']==''){
				$ruc='           ';
				//$razon='cliente vario                 ';
				$razon=str_pad("cliente varios",30, " ", STR_PAD_RIGHT);
				//}else{
				//$ruc=str_pad($rowClie['ruc'],11, " ", STR_PAD_RIGHT);
				//$razon=str_pad($rowClie['razonsocial'],30, " ", STR_PAD_RIGHT);
				//}
	
				$tc=str_pad(number_format($primertc,3),11, "0", STR_PAD_LEFT);
				if($primerMon=='01'){
					$moneda='S';
					$tempCuentatot=$cuentatotalS;
				}else{
					$moneda='D';
					$tempCuentatot=$cuentatotalD;
				}
	
				$codref='  ';
				$numref='          ';
				$b_imp=str_pad($BaseImponible,13, "0", STR_PAD_LEFT);
				$servicio=str_pad($servicios,13, "0", STR_PAD_LEFT);
				$igv=str_pad($impuesto1,13, "0", STR_PAD_LEFT);
				$total=str_pad($total,13, "0", STR_PAD_LEFT);
		
		
				$centroCosto=str_pad($cc,5, "0", STR_PAD_LEFT);
				$contBI=str_pad($cuentaBI,15, " ", STR_PAD_RIGHT);
				$destBI=str_pad($destinoBI,1, " ", STR_PAD_LEFT);
				$contIMP=str_pad($cuentaIGV,15, " ", STR_PAD_RIGHT);
				$destIMP=str_pad($destinoIGV,1, " ", STR_PAD_LEFT);
				$contDES=str_pad($cuentaDes,15, " ", STR_PAD_RIGHT);
				$destDES=str_pad($destinoDes,1, " ", STR_PAD_LEFT);
				$contTOT=str_pad($tempCuentatot,15, " ", STR_PAD_RIGHT);
				$destTOT=str_pad($destinototal,1, " ", STR_PAD_LEFT);
		
				
//				$strSQL2="select * from det_mov d where cod_cab='".$row['cod_cab']."' order by cod_det limit 1";
//				$resultado2=mysql_query($strSQL2,$cn);
//				$row2=mysql_fetch_array($resultado2);
//				$detalle=$row2['nom_prod'];
				
			
				$detalle="DEL ".$primerSerieDoc."-".$primerNumDoc."(".$numdocs." documentos)";
				if($numdocu!="" &&  $total!=""){
					$conta2.=$coddocu.$numdocu.$fecha.$fecha.$anulado.$codauxiliar.$tauxiliar.$ruc.$razon.$tc.$moneda.$codref.$numref.$b_imp.$servicio.$b_imp.$igv.$total.$centroCosto.$contBI.$destBI.$contIMP.$destIMP.$contDES.$destDES.$contTOT.$destTOT.$detalle.chr(13).chr(10);
				}
		
				$numdocu=""; $total="";$primerSerieDoc="";$primerNumDoc="";
					
			}//end for
			
		}//end for

	
		//echo $conta."<br><br><br>".$conta2;


//------------------------------------------------------------------------------------------------
		$grabar = fwrite($archivo, $conta.$conta2);
		fclose($archivo);
		//echo "<script>alert('Se creo correctamente el archivo en la siguiente ruta $filename')</script>";

//---------------------------------- Guardar DATOS ---------------------------------------------------


		$idsucursal=$_REQUEST['sucursal'];
		$cc=$_REQUEST['cc'];
		$mes =$_REQUEST['mes'];
		$anio=$_REQUEST['anio'];
		$cuentabi =$_REQUEST['cuentabi'];
		$destinobi =$_REQUEST['destinobi'];
		$cuentaimp =$_REQUEST['cuentaimp'];
		$destinoimp =$_REQUEST['destinoimp'];
		$cuentades =$_REQUEST['cuentades'];
		$destinodes =$_REQUEST['destinodes'];
		$cuentatot =$_REQUEST['cuentatot'];
		$destinotot =$_REQUEST['destinotot'];
		$tipo=$_REQUEST['tipo'];
		$chkIngresos=$_REQUEST['chkIngresos'];
		$periodo=$_REQUEST['periodo'];
		$fechaD=$fecha;

		//echo print_r($chkIngresos);
		$fcreacion=date('Y-m-d H:i:s');
		$usuario=$_SESSION['codvendedor'];

		if($periodo=='D'){
			$fechap=formatofecha($fechaD);
		}else{
			$fechap=$anio."-".$mes."-00";
		}
		$filtroDoc="";
		
		for ($i=0;$i<count($chkIngresos);$i++){
			$filtroDoc=$filtroDoc.",".$chkIngresos[$i];
		}
		$documentos=substr($filtroDoc,1,strlen($filtroDoc));
		
		//echo $documentos."<br>";

		$strSQLTienda="select * from tienda where cod_tienda='".$idsucursal."'";
		//echo $strSQLTienda;
		$resultadoTienda=mysql_query($strSQLTienda,$cn);
		$rowTienda=mysql_fetch_array($resultadoTienda);
		$nombre=$rowTienda['des_tienda'];

		//$strSQL3="update contafiles set tienda='".$idsucursal."',nombre='".$nombre."',cc='".$cc."',aplicacion='".$tipo."',documentos ='".$documentos."',periodo ='".$periodo."',fechap ='".$fechap ."',fcreacion ='".$fcreacion ."',usuario ='".$usuario ."',cbi ='".$cuentabi ."',dbi ='".$destinobi ."',cigv ='".$cuentaimp ."',digv ='".$destinoimp ."',ctotal ='".$cuentatot ."',dtotal ='".$destinotot ."',archivo ='".$nombreFile."'";
		
		$strSQL3="insert into contafiles(tienda,nombre,cc,aplicacion,documentos,periodo,fechap,fcreacion,usuario,cbi,dbi,cigv,digv,ctotal,dtotal,archivo)values('".$idsucursal."','".$nombre."','".$cc."','".$tipo."',\"". htmlspecialchars($documentos)."\",'".$periodo."','".$fechap ."','".$fcreacion ."','".$usuario ."','".$cuentabi ."','".$destinobi ."','".$cuentaimp ."','".$destinoimp ."','".$cuentatot ."','".$destinotot ."','".$nombreFile."')";
		//echo $strSQL3;
		mysql_query($strSQL3,$cn);
		
	*/
	
	
	
	}else{
	
	
	
		//****************************** DETALLADO ********************************
		
		$mes=$_REQUEST['mes'];
		$anio=$_REQUEST['anio'];
		$periodo=$_REQUEST['periodo'];
		$fecha=$_REQUEST['fecha'];
		$idsucursal=$_REQUEST['sucursal'];
		$idalmacen=$_REQUEST['almacen'];
		$tipo=$_REQUEST['tipo'];
		$modoTC=$_REQUEST['modoTC'];
		
		$cc="0".$idsucursal.$idalmacen;
		
		if($idalmacen=='0'){			
			$filtro1=" and  c.sucursal='".$idsucursal."' ";							
		}else{
			$filtro1=" and  c.tienda='".$idalmacen."' ";		
		}
			
		$cc=$_REQUEST['cc1'].$_REQUEST['cc2'].$_REQUEST['cc3'].$_REQUEST['cc4'];
	
		list($nom_emp)=mysql_fetch_row(mysql_query("select des_suc from sucursal where cod_suc='".$sucursal."'"));	
		
		$fecha2=$mes.$anio;
				
		if($tipo=='1'){
			$nombreFile=$nom_emp."_P".$fecha2.".txt";
		}else{
			$nombreFile=$nom_emp."_C".$fecha2.".txt";
		}		
				
		
		$filename = "contabilidad/transferencias/".$nombreFile;
		$archivo = fopen($filename, "a");
		fclose($archivo);
		$archivo = fopen($filename, "w");
		
		$strSQL="select *,p.moneda as monedap,c.moneda as monedadoc from pagos p, cab_mov c, operacion o where p.referencia=c.cod_cab and c.cod_ope=o.codigo and c.flag!='A' and o.sunat!='' ";
		
		$resultado=mysql_query($strSQL,$cn);
		while($row=mysql_fetch_array($resultado)){						
			
			list($tipoPersona,$dni,$ruc,$razon)=mysql_fetch_row(mysql_query("select t_persona,doc_iden,ruc,razonsocial from cliente where codcliente='".$row['cliente']."'"));
			
			list($codpago,$cc1,$cc2)=mysql_fetch_row(mysql_query("select codigo,cc1,cc2 from t_pago where id='".$row['t_pago']."'"));
			
			$codtpago=$codpago;
			$numpago=str_pad($row['numero'],10, " ", STR_PAD_RIGHT);
			
			$temp=explode('-',$row['fechap']);
			$fechaPago=$temp[0].$temp[1].substr($temp[2],0,2);
			
			$temp2=explode('-',$row['fechap']);
			$fechaVPago=$temp2[0].$temp2[1].substr($temp2[2],0,2);
			$TCPago=str_pad(number_format($row['tcambio'],3),11, "0", STR_PAD_LEFT);
			$monPago=$row['monedap'];
			$impPago=str_pad(number_format($row['monto'],2),13, "0", STR_PAD_LEFT);
				
				if($tipoPersona=='natural'){
				$tipoAux='2';
				$docAux=str_pad($dni,11, " ", STR_PAD_RIGHT);
				}else{
				$tipoAux='1';
				$docAux=str_pad($ruc,11, " ", STR_PAD_RIGHT);;
				}
			$nomAux=str_pad(substr($razon,0,30),30, " ", STR_PAD_RIGHT);
			$codSunat=$row['sunat'];
			$numDoc=$row['serie'].$row['Num_doc'];
			$monDoc=$row['monedadoc'];
			
			if($monPago=='01'){
			$desMonp='S';
			$ccTpago=$cc1;
			}else{
			$desMonp='D';
			$ccTpago=$cc2;
			}
			
			$destinoBI=$_REQUEST['destinobi'][1];
			if($destinoBI=='D')$destinoBI='H'; else $destinoBI='D';
			$desTpago=$destinoBI;	
			
			$cuentatotalS=$_REQUEST['inicuentatot'][2].$_REQUEST['cuentatotS'][2];
			$cuentatotalD=$_REQUEST['inicuentatot'][2].$_REQUEST['cuentatotD'][2];
			
			if($destinototal=='D')$destinototal='H'; else $destinototal='D';
			
			if($monDoc=='01'){
			$ccDoc=$cuentatotalS;
			$desMonDoc='S';
			}else{
			$ccDoc=$cuentatotalD;
			$desMonDoc='D';
			}
			$desDoc=$destinototal;			
			$detalle=$row['obs'];
												
			$cCostos=str_pad($cc,5, "0", STR_PAD_LEFT);
			
			$ccTpago=str_pad($ccTpago,15, " ", STR_PAD_RIGHT);
			$desTpago=str_pad($desTpago,1, " ", STR_PAD_LEFT);
			$ccDoc=str_pad($ccDoc,15, " ", STR_PAD_RIGHT);
			$desDoc=str_pad($desDoc,1, " ", STR_PAD_LEFT);
			
			
			$conta.=$unficador.$codtpago.$numpago.$fechaPago.$fechaVPago.$TCPago.$desMonp.$impPago.$tipoAux.$docAux.$nomAux.$codSunat.$numDoc.$desMonDoc.$ccTpago.$desTpago.$ccDoc.$desDoc.$cCostos.$detalle.chr(13).chr(10);
					
		//	$conta.=$coddocu.$numdocu.$fecha.$fechaDocRef.$anulado.$codauxiliar.$tauxiliar.$ruc.$razon.$tc.$moneda.$codref.$numref.$b_imp.$servicio.$b_imp.$igv.$total.$centroCosto.$contBI.$destBI.$contIMP.$destIMP.$contDES.$destDES.$contTOT.$destTOT.$detalle.chr(13).chr(10);
		
			
		
		}
		//echo $conta	;
//--------------------------------------DOCUMENTOS RESUMIDO--------------------------------------------
		
		if($periodo=="D"){
			$tempfecha=explode("-",$fecha);
			$dia=$tempfecha[0];
			$mes=$tempfecha[1];
			$anio=$tempfecha[2];
			
			$cant_dias=1;
		}else{
			//echo "sadg";
			$cant_dias=UltimoDia($anio,$mes);
		}
		//echo $cant_dias;
		
		for ( $j = 1 ; $j <= $cant_dias ; $j ++) {
			$dia=str_pad($j, 2, "0", STR_PAD_LEFT);
			$fecha1=$anio."-".$mes."-".$dia;
				
			$temp_doc=explode(",",$documentos2);
			//print_r($temp_doc)."<br>";
			for ( $i = 1 ; $i < count($temp_doc) ; $i ++) {
				$strSQL="select substring(fecha,1,10) as fecha,cod_cab,cod_ope,serie,Num_doc,flag,ruc,cliente,impto1,tc,b_imp,servicio,igv,total,moneda from cab_mov where substring(fecha,1,10)='$fecha1' and Num_doc!='' and flag!='A' and serie!=''  and tienda='".$idsucursal."' and cod_ope=".$temp_doc[$i]." order by Num_doc";
				$resultado=mysql_query($strSQL,$cn);
				$k=0;
				$BaseImponible=0;
				$impuesto1=0;
				$total=0;
				$numdocs=mysql_num_rows($resultado);	
				$tempxdoc='';
				while($row=mysql_fetch_array($resultado)){
					$strSQLSunat="select * from operacion where codigo='".$row['cod_ope']."'";
					$resultadoSunat=mysql_query($strSQLSunat,$cn);
					$rowSunat=mysql_fetch_array($resultadoSunat);
					if($k==0){
						$primerNumDoc=$row['Num_doc'];
						$primerSerieDoc=$row['serie'];
						$primerDoc=$rowSunat['sunat'];
						$primertc=$row['tc'];
						$primerMon=$row['moneda'];;
					}
					$Bi_temp=$row['b_imp'];
					$imp_temp=$row['igv'];
					$serv_temp=$row['servicio'];
					$tot_temp=$row['total'];
					
					if($primerMon!=$row['moneda']){
						if($row['moneda']=='02'){
							$Bi_temp=$row['b_imp']*$primertc;
							$imp_temp=$row['igv']*$primertc;
							$serv_temp=$row['servicio']*$primertc;
							$tot_temp=$row['total']*$primertc;
						}else{
							$Bi_temp=$row['b_imp']/$primertc;
							$imp_temp=$row['igv']/$primertc;
							$serv_temp=$row['servicio']/$primertc;
							$tot_temp=$row['total']/$primertc;
						}
					}
					
					$BaseImponible=$BaseImponible+$Bi_temp;
					$impuesto1=$impuesto1+$imp_temp;
					$servicios=$servicios+$serv_temp;
					$total=$total+$tot_temp;
						
					$k++;
				}//end while
				$BaseImponible=number_format($BaseImponible,2,".","");
				$impuesto1=number_format($impuesto1,2,".","");
				$servicios=number_format($servicios,2,".","");
				//$total=number_format($total,2,".","");
				$total=number_format($total,2,".","")+number_format($servicios,2,".","");
				
				$coddocu=$primerDoc;
				$numdocu=$primerSerieDoc.$primerNumDoc;
				//$temp=explode('-',$fecha1);
				$fecha=$anio.$mes.$dia;
				//if($row['flag']=='A'){$anulado='S';}else{$anulado='N';}
				$anulado='N';
				$codauxiliar="000001";
				$tauxiliar='C';
				/*
				$strCliente="select * from cliente where codcliente='".$row['cliente']."'";
				$resultadoClie=mysql_query($strCliente,$cn);
				$rowClie=mysql_fetch_array($resultadoClie);
				*/
				
				//if($rowClie['ruc']==''){
				$ruc='           ';
				//$razon='cliente vario                 ';
				$razon=str_pad("cliente varios",30, " ", STR_PAD_RIGHT);
				//}else{
				//$ruc=str_pad($rowClie['ruc'],11, " ", STR_PAD_RIGHT);
				//$razon=str_pad($rowClie['razonsocial'],30, " ", STR_PAD_RIGHT);
				//}
				$tc=str_pad(number_format($primertc,3),11, "0", STR_PAD_LEFT);
				if($primerMon=='01'){
					$moneda='S';
					$tempCuentatot=$cuentatotalS;
				}else{
					$moneda='D';
					$tempCuentatot=$cuentatotalD;
				}
				$codref='  ';
				$numref='          ';
				$b_imp=str_pad($BaseImponible,13, "0", STR_PAD_LEFT);
				$igv=str_pad($impuesto1,13, "0", STR_PAD_LEFT);
				
				if($numdocu!=$tempxdoc){
				$servicio=str_pad($servicios,13, "0", STR_PAD_LEFT);
				$total=str_pad(number_format($total,2,'.','')+number_format($servicios,2,'.',''),13, "0", STR_PAD_LEFT);
				}else{
					$servicio=str_pad("0.00",13, "0", STR_PAD_LEFT);
					$total=str_pad("0.00",13, "0", STR_PAD_LEFT);
				}
				$centroCosto=str_pad($cc,5, "0", STR_PAD_LEFT);
				$contBI=str_pad($cuentaBI,15, " ", STR_PAD_RIGHT);
				$destBI=str_pad($destinoBI,1, " ", STR_PAD_LEFT);
				$contIMP=str_pad($cuentaIGV,15, " ", STR_PAD_RIGHT);
				$destIMP=str_pad($destinoIGV,1, " ", STR_PAD_LEFT);
				$contDES=str_pad($cuentaDes,15, " ", STR_PAD_RIGHT);
				$destDES=str_pad($destinoDes,1, " ", STR_PAD_LEFT);
				$contTOT=str_pad($tempCuentatot,15, " ", STR_PAD_RIGHT);
				$destTOT=str_pad($destinototal,1, " ", STR_PAD_LEFT);
				
				/*
				$strSQL2="select * from det_mov d where cod_cab='".$row['cod_cab']."' order by cod_det limit 1";
				$resultado2=mysql_query($strSQL2,$cn);
				$row2=mysql_fetch_array($resultado2);
				$detalle=$row2['nom_prod'];
				*/
					
				$detalle="DEL ".$primerSerieDoc."-".$primerNumDoc."(".$numdocs." documentos)";
				if($numdocu!="" &&  $total!=""){
					$conta2.=$coddocu.$numdocu.$fecha.$fecha.$anulado.$codauxiliar.$tauxiliar.$ruc.$razon.$tc.$moneda.$codref.$numref.$b_imp.$servicio.$b_imp.$igv.$total.$centroCosto.$contBI.$destBI.$contIMP.$destIMP.$contDES.$destDES.$contTOT.$destTOT.$detalle.chr(13).chr(10);
				}
					
				$numdocu=""; $total="";$primerSerieDoc="";$primerNumDoc="";
				
			}//end for
			
		}//end for
		
			
		//echo $conta."<br><br><br>".$conta2;
		
		
//------------------------------------------------------------------------------------------------
		$grabar = fwrite($archivo, $conta.$conta2);
		fclose($archivo);
		/*echo "<script>alert('Se creo correctamente el archivo en la siguiente ruta $filename')</script>";*/
		
//---------------------------------- Guardar DATOS ---------------------------------------------------
		
		
		$idsucursal=$_REQUEST['sucursal'];
		$cc=$_REQUEST['cc'];
		$mes =$_REQUEST['mes'];
		$anio=$_REQUEST['anio'];
		$cuentabi =$_REQUEST['cuentabi'];
		$destinobi =$_REQUEST['destinobi'];
		$cuentaimp =$_REQUEST['cuentaimp'];
		$destinoimp =$_REQUEST['destinoimp'];
		$cuentades =$_REQUEST['cuentades'];
		$destinodes =$_REQUEST['destinodes'];
		$cuentatot =$_REQUEST['cuentatot'];
		$destinotot =$_REQUEST['destinotot'];
		$tipo=$_REQUEST['tipo'];
		$chkIngresos=$_REQUEST['chkIngresos'];
		$periodo=$_REQUEST['periodo'];
		$fechaD=$fecha;
		
		//echo print_r($chkIngresos);
		$fcreacion=date('Y-m-d H:i:s');
		$usuario=$_SESSION['codvendedor'];
		
		if($periodo=='D'){
			$fechap=formatofecha($fechaD);
		}else{
			$fechap=$anio."-".$mes."-00";
		}
		$filtroDoc="";
		
		for ($i=0;$i<count($chkIngresos);$i++){
			$filtroDoc=$filtroDoc.",".$chkIngresos[$i];
		}
		$documentos=substr($filtroDoc,1,strlen($filtroDoc));
		
		//echo $documentos."<br>";
		
		$strSQLTienda="select * from tienda where cod_tienda='".$idalmacen."'";
		//echo $strSQLTienda;
		$resultadoTienda=mysql_query($strSQLTienda,$cn);
		$rowTienda=mysql_fetch_array($resultadoTienda);
		$nombre=$rowTienda['des_tienda'];
				
				
				//$strSQL3="update contafiles set tienda='".$idsucursal."',nombre='".$nombre."',cc='".$cc."',aplicacion='".$tipo."',documentos ='".$documentos."',periodo ='".$periodo."',fechap ='".$fechap ."',fcreacion ='".$fcreacion ."',usuario ='".$usuario ."',cbi ='".$cuentabi ."',dbi ='".$destinobi ."',cigv ='".$cuentaimp ."',digv ='".$destinoimp ."',ctotal ='".$cuentatot ."',dtotal ='".$destinotot ."',archivo ='".$nombreFile."'";
					
		$strSQL3="insert into contafiles(tienda,nombre,cc,aplicacion,documentos,periodo,fechap,fcreacion,usuario,cbi,dbi,cigv,digv,ctotal,dtotal,archivo,modulo)values('".$idalmacen."','".$nombre."','".$cc."','".$tipo."',\"". htmlspecialchars($documentos)."\",'".$periodo."','".$fechap ."','".$fcreacion ."','".$usuario ."','".$cuentabi ."','".$destinobi ."','".$cuentaimp ."','".$destinoimp ."','".$cuentatot ."','".$destinotot ."','".$nombreFile."','pagos')";
				//echo $strSQL3;
		mysql_query($strSQL3,$cn);
		
		
//*************************************************************************
	}
}

/*
///gmy
	$tipo=$_REQUEST['tipo'];
	print_r($_REQUEST['cuentatotS']);
	echo "<br>";
	print_r($_REQUEST['cuentaimp']);
	echo "<br>";
	print_r($_REQUEST['cuentades']);
	echo "<br>";

	if($tipo==2){
		$cuentaBI=$_REQUEST['inicuentabi'][0].$_REQUEST['cuentabi'][0];
		$cuentaIGV=$_REQUEST['inicuentaimp'][0].$_REQUEST['cuentaimp'][2];
		$cuentaDes=$_REQUEST['inicuentades'][0].$_REQUEST['cuentades'][1];
		$cuentatotalS=$_REQUEST['inicuentatot'][0].$_REQUEST['cuentatotS'][2];
		$cuentatotalD=$_REQUEST['inicuentatot'][0].$_REQUEST['cuentatotD'][2];

		$destinoBI=$_REQUEST['destinobi'][0];
		$destinoIGV=$_REQUEST['destinoimp'][0];
		$destinoDes=$_REQUEST['destinodes'][0];
		$destinototal=$_REQUEST['destinotot'][0];

		$campo1="ccontable2";

	}else{

		//$cuentaBI=$_REQUEST['inicuentabi'][1].$_REQUEST['cuentabi'][1];
		$cuentaIGV=$_REQUEST['inicuentaimp'][1].$_REQUEST['cuentaimp'][1];
		$cuentaDes=$_REQUEST['inicuentades'][1].$_REQUEST['cuentades'][1];
		$cuentatotalS=$_REQUEST['inicuentatot'][1].$_REQUEST['cuentatotS'][1];
		$cuentatotalD=$_REQUEST['inicuentatot'][1].$_REQUEST['cuentatotD'][1];

		$destinoBI=$_REQUEST['destinobi'][1];
		$destinoIGV=$_REQUEST['destinoimp'][1];
		$destinoDes=$_REQUEST['destinodes'][1];
		$destinototal=$_REQUEST['destinotot'][1];

		$campo1="ccontable1";
	
	}

	$strSQL2="update transferencia set idsucursal='".$idsucursal."',cc='".$cc."',mes='".$mes."',anio='".$anio."',cuentabi ='".$cuentaBI."',destinobi ='".$destinoBI."',cuentaimp ='".$cuentaIGV ."',destinoimp ='".$destinoIGV ."',cuentades ='".$cuentaDes ."',destinodes ='".$destinoDes ."',cuentatot ='".$cuentatotalS ."',destinotot ='".$destinototal ."'";
mysql_query($strSQL2,$cn);		
////////////////////////////////////////////Actualizacion de datos*/

if($_REQUEST['temporal']=='guardar'){

	$idsucursal=$_REQUEST['sucursal'];
	$cc=$_REQUEST['cc'];
	$mes =$_REQUEST['mes'];
	$anio=$_REQUEST['anio'];
	$cuentabi =$_REQUEST['cuentabi'];
	$destinobi =$_REQUEST['destinobi'];
	$cuentaimp =$_REQUEST['cuentaimp'];
	$destinoimp =$_REQUEST['destinoimp'];
	$cuentades =$_REQUEST['cuentades'];
	$destinodes =$_REQUEST['destinodes'];
	$cuentatot =$_REQUEST['cuentatot'];
	$destinotot =$_REQUEST['destinotot'];
	
	
	$strSQL2="update transferencia set idsucursal='".$idsucursal."',cc='".$cc."',mes='".$mes."',anio='".$anio."',cuentabi ='".$cuentabi."',destinobi ='".$destinobi."',cuentaimp ='".$cuentaimp ."',destinoimp ='".$destinoimp ."',cuentades ='".$cuentades ."',destinodes ='".$destinodes ."',cuentatot ='".$cuentatot ."',destinotot ='".$destinotot ."'";
	mysql_query($strSQL2,$cn);
	
}

$strSQL="select * from transferencia order by id desc limit 1";
$resultado=mysql_query($strSQL,$cn);
$row=mysql_fetch_array($resultado);

$idsucursal=$row['idsucursal'];
$cc=$row['cc'];
$mes =$row['mes'];
$anio=$row['anio'];
$cuentabi =$row['cuentabi'];
$destinobi =$row['destinobi'];
$cuentaimp =$row['cuentaimp'];
$destinoimp =$row['destinoimp'];
$cuentades =$row['cuentades'];
$destinodes =$row['destinodes'];
$cuentatot =$row['cuentatot'];
$destinotot =$row['destinotot'];


?> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<title>Transferencia a Contabilidad</title>
<style type="text/css">
<!--
.Estilo10 {font-size: 12px; font-family: Arial, Helvetica, sans-serif;}
.Estilo12 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #003366; }
.borderBajo{
border-bottom:#E5E5E5 solid 1px
}
.Estilo114 {color: #FF0000}
-->
</style>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<link rel="stylesheet" type="text/css" media="all" href="calendario/Style_calenda.css" title="win2k-cold-1" />

</head>

	
    <script type="text/javascript" src="calendario/calendar.js"></script>
    <script type="text/javascript" src="calendario/lang/calendar-en.js"></script>
    <script type="text/javascript" src="calendario/calendar-setup.js"></script>
   
    <link href="js/css/ui-lightness/jquery-ui-1.9.1.custom.css" rel="stylesheet">
	<script src="js/js/jquery-1.8.2.js"></script>
	<script src="js/js/jquery-ui-1.9.1.custom.js"></script>
  
  <script>
	$(function() {
						
		$( "#dialog" ).dialog({
			autoOpen: false,
			width: 540,
			buttons: [
				{
					text: "Guardar",
					click: function() {
						guardar_cuentaProd();
						//$('div#dialog').html('');
						//$( this ).dialog( "close" );
						alert("Se Guardaron los Cambios");
						
					}
				},
				{
					text: "Cancel",
					click: function() {
						$('div#dialog').html('');
						$( this ).dialog( "close" );
						
					}
				}
			]
		});

		// Link to open the dialog
		

		
		
	});
	</script>

 
 <script>  
 
var  myVar='';
 
 $(document).ready(function(){
	     $( "#dialog" ).dialog({
			       autoOpen: false,
				   modal: true,
				   height: 340,	
				   width: 520	
	    });
		
		$( "#opener2" ).click(function(){			
			$( "#dialog" ).dialog( "open" );
		});
		
		$( "#opener2" ).click(function(){
		 
		  var aplicacion = $('#tipo :selected').val();
		 //alert(aplicacion);
		  var contenidoAjax = $('div#dialog').html('<p align="center"><img src="imgenes/loader.gif" /></p>');
		    $.ajax({
			type : "POST",
			url : "peticion_ajax5.php",
			data  : 'peticion=listaPagosCont&aplicacion='+aplicacion ,
			success : function(data) {
				
				contenidoAjax.html(data);
			  //alert(data);
			  //document.getElementById("dialog").innerHTML=data;
			}
		  });
		  
		 // carga_productos();
		  
		});
		
		$( "#opener1" ).click(function(){			
			$( "#dialog" ).dialog( "open" );
		});
		
		$( "#opener1" ).click(function(){
		 
		  var aplicacion = $('#tipo :selected').val();
		 //alert(aplicacion);
		  var contenidoAjax = $('div#dialog').html('<p align="center"><img src="imgenes/loader.gif" /></p>');
		    $.ajax({
			type : "POST",
			url : "peticion_ajax5.php",
			data  : 'peticion=listaPagosCont&aplicacion='+aplicacion ,
			success : function(data) {
				
				contenidoAjax.html(data);
			  //alert(data);
			  //document.getElementById("dialog").innerHTML=data;
			}
		  });
		  
		 // carga_productos();
		  
		});
		
});


function cerrar_modal_x(){
	$('div#dialog').html('');
	}

function guardar_cuentaProd(){
	
			var aplicacion = $('#tipo :selected').val();
			//var cont=0;
			var cont; 			
			var cuentas="";
			var codigos="";
						
			$('div#detalle_chofer input').each(function(i){
				if(i%2==0){
				cuentas=cuentas+"|"+$('#'+this.id).val();	
				//alert($('#'+this.id).val());				
				}else{
				codigos=codigos+"|"+$('#'+this.id).val();	
				}
				
			});
			
			//alert(cuentas+" ----- "+codigos);
			
		    $.ajax({
			type : "POST",
			url : "peticion_ajax5.php",
			data  : 'peticion=guardarcuentas&aplicacion='+aplicacion+'&cuentas='+cuentas+'&codigos='+codigos,
			success : function(data) {
				
				//alert(data);
				//contenidoAjax.html(data);
			  //alert(data);
			  //document.getElementById("dialog").innerHTML=data;
			}
		  });
	
	
	}	
		
function copiar_cuentaProd(){
	var texto = $('#txtcopiar').val();
	//var cont=0;
	//alert(texto);
	var cont; 			
	var cuentas="";
	var codigos="";
						
	$('div#detalle_chofer input').each(function(i){
		if(i%2==0){
			$('#'+this.id).val(texto);	
			//alert($('#'+this.id).val());				
		}
		//else{
			//codigos=codigos+"|"+$('#'+this.id).val();	
		//}
				
	});
			
	//alert(cuentas+" ----- "+codigos);
}


function buscarprod(control,evento){
	
	if(evento.keyCode==13){
	
		  var aplicacion = $('#tipo :selected').val();
		 //alert(control.value);
		  var contenidoAjax = $('div#dialog').html('<p align="center"><img src="imgenes/loader.gif" /></p>');
		    $.ajax({
			type : "POST",
			url : "peticion_ajax5.php",
			data  : 'peticion=lista_prod_cuentas&aplicacion='+aplicacion+'&valor='+control.value ,
			success : function(data) {
				
				contenidoAjax.html(data);
			  //alert(data);
			  //document.getElementById("dialog").innerHTML=data;
			}
		  });
		 
	}
	
	}
		 
</script>
 

<!--<button id="opener">Open Dialog</button>-->

<script>
var temp_tabla1=new Array();
var temp_tabla2=new Array();

function validar(form){
	

	
	if(document.form1.cc1.value=='' || document.form1.cc3.value==''){
	alert("los campos de centro de costo no pueden estar vacios");
	return false;
	}
	
	if(document.getElementById('docincluir').innerHTML==""){
	alert('Seleccionar documentos por favor...');
	return false;
	}
	
	if(form.mes.disabled && form.fecha.disabled){
	alert('Debe seleccionar un periodo');
	return false;
	}
	//alert(document.form1.cuentabi.value.length);
	//alert(document.form1.cuentatotS[0].value.length);
	
	
	if(document.form1.tipo.value==2){
		
		if(document.form1.tformato[1].checked){			
			
			if(document.form1.cuentaimp[3].value=="" || document.form1.cuentaimp[3].value.length < 2 || document.form1.cuentades.value=="" || document.form1.cuentades.value.length < 2 || document.form1.cuentatotS[3].value=="" || document.form1.cuentatotS[3].value.length < 2 || document.form1.cuentatotD[3].value=="" || document.form1.cuentatotD[3].value.length < 2){
				
			alert("Las cuentas contables no deben tener menos de 4 d\u00edgitos");
			return false;
			}	
			
			
		}else{
		
			if(document.form1.cuentabi[0].value=="" || document.form1.cuentabi[0].value.length < 2 || document.form1.cuentaimp[0].value=="" || document.form1.cuentaimp[0].value.length < 2 || document.form1.cuentades.value=="" || document.form1.cuentades.value.length < 2 || document.form1.cuentatotS[0].value=="" || document.form1.cuentatotS[0].value.length < 2 || document.form1.cuentatotD[0].value=="" || document.form1.cuentatotD[0].value.length < 2){
			alert("Las cuentas contables no deben tener menos de 4 d\u00edgitos");
			return false;
			}	
			
		}
								
		if(document.form1.cuentabi[0].value.length==4 || document.form1.cuentabi[0].value.length==6 || document.form1.cuentabi[0].value.length==8 || document.form1.cuentabi[0].value.length==10 || document.form1.cuentabi[0].value.length==12 || document.form1.cuentabi[0].value.length >13 ||  document.form1.cuentaimp[0].value.length==4 || document.form1.cuentaimp[0].value.length==6 || document.form1.cuentaimp[0].value.length==8 || document.form1.cuentaimp[0].value.length==10 || document.form1.cuentaimp[0].value.length==12 || document.form1.cuentaimp[0].value.length >13  ||  document.form1.cuentades.value.length==4 || document.form1.cuentades.value.length==6 || document.form1.cuentades.value.length==8 || document.form1.cuentades.value.length==10 || document.form1.cuentades.value.length==12 || document.form1.cuentades.value.length >13   ||  document.form1.cuentatotS[0].value.length==4 || document.form1.cuentatotS[0].value.length==6 || document.form1.cuentatotS[0].value.length==8 || document.form1.cuentatotS[0].value.length==10 || document.form1.cuentatotS[0].value.length==12 || document.form1.cuentatotS[0].value.length >13   ||  document.form1.cuentatotD[0].value.length==4 || document.form1.cuentatotD[0].value.length==6 || document.form1.cuentatotD[0].value.length==8 || document.form1.cuentatotD[0].value.length==10 || document.form1.cuentatotD[0].value.length==12 || document.form1.cuentatotD[0].value.length >13  ){
		alert("Una de las cuentas ingresadas no es v\u00e1lida");
		return false;
		}
						
	}else{
	
		if(document.form1.cuentabi[1].value=="" || document.form1.cuentabi[1].value.length < 2 || document.form1.cuentaimp[1].value=="" || document.form1.cuentaimp[1].value.length < 2 || document.form1.cuentatotS[1].value=="" || document.form1.cuentatotS[1].value.length < 2 || document.form1.cuentatotD[1].value=="" || document.form1.cuentatotD[1].value.length < 2){
		//	alert();
		//alert("las cuentas cuentables no deben tener menos de 4 d\u00edgitos");
		//return false;
		}
		
		
		if(document.form1.cuentabi[1].value.length==4 || document.form1.cuentabi[1].value.length==6 || document.form1.cuentabi[1].value.length==8 || document.form1.cuentabi[1].value.length==10 || document.form1.cuentabi[1].value.length==12 || document.form1.cuentabi[1].value.length >13 ||  document.form1.cuentaimp[1].value.length==4 || document.form1.cuentaimp[1].value.length==6 || document.form1.cuentaimp[1].value.length==8 || document.form1.cuentaimp[1].value.length==10 || document.form1.cuentaimp[1].value.length==12 || document.form1.cuentaimp[1].value.length >13  ||  document.form1.cuentatotS[1].value.length==4 || document.form1.cuentatotS[1].value.length==6 || document.form1.cuentatotS[1].value.length==8 || document.form1.cuentatotS[1].value.length==10 || document.form1.cuentatotS[1].value.length==12 || document.form1.cuentatotS[1].value.length >13   ||  document.form1.cuentatotD[1].value.length==4 || document.form1.cuentatotD[1].value.length==6 || document.form1.cuentatotD[1].value.length==8 || document.form1.cuentatotD[1].value.length==10 || document.form1.cuentatotD[1].value.length==12 || document.form1.cuentatotD[1].value.length >13  ){
		alert("Una de las cuentas ingresadas no es v\u00e1lida");
		return false;
		}
		
	}
	
	
	temp1=0;
	for(var i=0;i<document.form1.Ingresos.length;i++){	
		if(document.form1.Ingresos[i].checked){
		temp1=1;
		}		
	}
	if(temp1==0){
	alert('Seleccionar documentos por favor...');
	return false;
	}

	
return true;
	
}
function soloNumeros(evt) {     //Validar la existencia del objeto event    
 evt = (evt) ? evt : event;       //Extraer el codigo del caracter de uno de los diferentes grupos de codigos   
   var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));       //Predefinir como valido   
     var respuesta = true;       //Validar si el codigo corresponde a los NO aceptables  
	    if (charCode > 31 && (charCode < 48 || charCode > 57))     {         //Asignar FALSE a la respuesta si es de los NO aceptables    
		  respuesta = false;
		}       //Regresar la respuesta    
 return respuesta; 
}

function carga_productos(){
	
	doAjax('peticion_ajax5.php','&peticion=lista_prod_cuentas','lista_productos','get','0','1','','');
	
	
}

function lista_productos(data){
	document.getElementById("dialog").innerHTML=data;
}
	
//alert("<?php //echo $strSQL2;?>");	
</script>


<link href="styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
background-color:#F7F7F7;   
}
.Estilo100 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
.Estilo102 {color: #333333}
.Estilo104 {font-family: Arial, Helvetica, sans-serif}
.Estilo106 {font-size: 11px}
.Estilo107 {color: #0066FF}
.Estilo38 {	color: #003366;
	font-weight: bold;
}
.Estilo111 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #333333;
	font-weight: bold;
	font-size: 10px;
}
.Estilo113 {font-size: 10px}
-->
</style>


<script language="javascript" src="miAJAXlib2.js"></script>

<body onLoad="cargar_lista(); sel_tienda(document.form1.sucursal);">
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onSubmit=" return validar(this)">
<div id="dialog" title="Tipos de Pago"> 

 
</div> 

<table width="780" border="0" cellpadding="0" cellspacing="0">
    <tr style="background:url(imagenes/white-top-bottom.gif)">
      <td width="780" height="22"><span class="Estilo100"><span style="border:#999999"> <span class="Estilo14 Estilo38">Gerencia :: Contabilidad :: Transferencia a Contabilidad</span></span>
        <input type="hidden" name="carga" id="carga" value="S">
        <input type="hidden" name="temporal" />
      </span> <span class="Estilo114">(PAGOS) </span></td>
    </tr>
    <tr>
      <td><table width="775" height="420" border="0"  cellpadding="0" cellspacing="0">
        
        <tr>
          <td width="5" height="49">&nbsp;</td>
          <td width="297" rowspan="3"><br><fieldset>
            <table width="278" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="96" height="32"><span class="Estilo111">Empresa :</span></td>
                <td width="182">
				
				<script>
				function sel_tienda(control){
					/*
				//alert(control.value);
					for(var i=0;i<temp_tabla1.length;i++){
					//alert(temp_tabla1[i]);
						if(control.value.substring(0,1)==temp_tabla1[i]){
						document.getElementById("labelEmp").innerHTML=temp_tabla2[i];
						document.getElementById("cc2").value=temp_tabla1[i];
						document.getElementById("cc4").value=control.value.substring(1,3);
						
						}
					}
				*/
				}
				
				</script>
				
				<?php /*?><select style="width:160"  name="sucursal"  onChange="sel_tienda(this)" >
                    <?php 
		
  $resultados1 = mysql_query("select * from tienda,sucursal where tienda.cod_suc=sucursal.cod_suc order by des_tienda ",$cn); 
  $k=0;
while($row1=mysql_fetch_array($resultados1))
{

echo "<script>temp_tabla1[$k]='".$row1['cod_suc']."'; temp_tabla2[$k]='".$row1['des_suc']."'; </script>";

		?>
                    <option value="<?php echo $row1['cod_tienda'] ?>"><?php echo $row1['des_tienda'] ?></option>
                    <?php 
			  
$k++;
}?>
                </select><?php */?>
                
                
                
                <span class="Estilo24">
                <select style="width:160" id="sucursal" name="sucursal" onChange="doAjax('carga_cbo_tienda.php','&kardex=s&codsuc='+document.form1.sucursal.value,'cargar_cbo','get','0','1','','')" >
                 
                  <?php 
		
		 $resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn);
		 
		  
		while($row1=mysql_fetch_array($resultados1))
		{
		?>
                  <option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
                  <?php }?>
                
                </select>
                
                <script>
			 var valor1="<?php echo $_REQUEST['sucursal']?>";			
			 var i;
	 for (i=0;i<document.form1.sucursal.options.length;i++)
        {
		
            if (document.form1.sucursal.options[i].value==valor1)
               {
			   
               document.form1.sucursal.options[i].selected=true;
               }
        
        }
			      </script>  
                
                
                </span></td>
                </tr>
              <tr>
                <td height="22"><span class="Estilo111">Local/Tienda :</span></td>
                <td>
                
                <div id="cbo_tienda">
				  <select  style="width:160" name="almacen" id="almacen" onBlur="">
                    <option value="0">Todos</option>
                  </select>
				</div>
                
                  </td>
              </tr>
              <tr style="display:none">
                <td  height="20"><span class="Estilo111">C. de Costo:</span></td>
                <td><strong>
                 <!-- <input name="cc" type="text" size="5" maxlength="5" value="<?php // echo $cc?>" />-->
				  
				  
                  <input name="cc1" type="text" size="1" maxlength="1" value="0" style="text-align:center; width:15px" readonly>
				   <input name="cc2" id="cc2" readonly="" type="text" size="1" maxlength="1" value="0" style="text-align:center; width:15px; color:#999999">
				  <!--<label id="labelCodSuc"></label>-->
				  
				  <input name="cc3" type="text" style="text-align:center; width:15px" value="0" size="1" maxlength="1" readonly>
				   <input  name="cc4" id="cc4" readonly="" type="text" style="text-align:center; width:25px; color:#999999" value="0" size="1" maxlength="2">
				  
				 <!--   <label id="labelCodTie"></label>-->
					
					
                </strong></td>
                </tr>
              <tr>
                <td height="33"><span class="Estilo111">Aplicaci&oacute;n : </span></td>
                <td><select name="tipo" id="tipo" >
                    <option value="1">Pagos</option>
                    <option value="2">Cobranzas</option>
                </select>
				</td>
                </tr>
              <tr>
                <td height="24" style="visibility:hidden"><span class="Estilo111">T. Cambio: </span></td>
                <td style="visibility:hidden">
					<select name="modoTC" >
                    <option value="1">Compra</option>
					<option value="2" selected>Venta</option>
					<option value="3">Promedio</option>
                    </select>					</td>
              </tr>
              <tr>
                <td height="29" colspan="2" style="display:none"><span class="Estilo10 Estilo102">Seleccionar Documentos: </span>
                  <input onClick="validartecla2(event,this,'docincluir')"  name="btnInc" type="button" id="btnInc" value="   ?   " /></td></tr>
              <tr>
                <td height="23" colspan="2" align="center"><fieldset><legend><span class="Estilo107">Tipo de  Formato</span></legend>
                  <label style="display:none">
                    <input name="tformato" type="radio" id="tformato" style="background:none; border:none" onClick="change_tFormato(this)" value="consolidado">
                    Consolidado</label>
                  <label>
                    <input name="tformato" type="radio" id="tformato" style=" background:none; border:none" onClick="change_tFormato(this)" value="detallado" checked>
                    Detallado</label>
                  </fieldset></td>
              </tr>
              <tr>
                <td height="33" colspan="2" align="center"><!--<input name="submit2" type="submit" value="Guardar Conf." onFocus="cambiar('guardar')" />-->
                  <?php //if($idsucursal==""){?>
                  <!--<input name="submit" type="submit" value="Generar Archivo" disabled="disabled"/>-->
                  <?php //}else{?>
                  <input name="submit" type="submit" value="Generar Archivo"  onFocus="cambiar('generar')"/>
                  <?php //}?></td>
              </tr>
            </table>
          </fieldset></td>
          <td width="11" rowspan="3"></td>
          <td width="462" rowspan="2"><fieldset><legend><span class="Estilo107">Seleccionar Periodo</span></legend><table width="354" height="58" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="48" height="24" align="center"> <input style="border:none; background:none" name="periodo" type="radio" value="M" onClick="activar(this)"></td>
                <td width="79" align="left" class="Estilo10 Estilo102">Mensual</td>
                <td width="118"><select  name="mes" disabled="disabled">
                  <option value="01">Enero </option>
                  <option value="02">Febrero </option>
                  <option value="03">Marzo </option>
                  <option value="04">Abril </option>
                  <option value="05">Mayo </option>
                  <option value="06">Junio </option>
                  <option value="07">Julio </option>
                  <option value="08">Agosto </option>
                  <option value="09">Septiembre </option>
                  <option value="10">Octubre </option>
                  <option value="11">Noviembre </option>
                  <option value="12">Diciembre </option>
                  <script>
			 var valor1="<?php echo $mes?>";
     var i;
	 for (i=0;i<document.form1.mes.options.length;i++)
        {
		
            if (document.form1.mes.options[i].value==valor1)
               {
			   
               document.form1.mes.options[i].selected=true;
               }
        
        }
			
			    </script>
                </select>				</td>
                <td width="109"><select name="anio"  disabled="disabled">
                  <option value="2009">2009</option>
                  <option value="2010">2010</option>
                  <option value="2011">2011</option>
                  <option value="2012">2012</option>
				  <option value="2013" selected>2013</option>
				  <option value="2014">2014</option>
				  <option value="2015">2015</option>
                  <script>
			 var valor1="<?php echo $anio?>";
     var i;
	 for (i=0;i<document.form1.anio.options.length;i++)
        {
		
            if (document.form1.anio.options[i].value==valor1)
               {
			   
               document.form1.anio.options[i].selected=true;
               }
        
        }
			
			    </script>
                </select></td>
              </tr>
              <tr style="display:none" >
                <td height="24" align="center"><input style="border:none; background:none" name="periodo" type="radio" value="D"  onClick="activar(this)"></td>
                <td height="24" align="left" class="Estilo10 Estilo102">Diario</td>
                <td><!--crear fechas -->                <input name="fecha" type="text" id="fecha" size="15" value="<?php echo date('d-m-Y')?>" disabled="disabled"></td>
                <td><button type="reset" id="f_trigger_b2" disabled="disabled">...</button>
                  <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b2",   
        singleClick    :    true,           
        step           :    1                
    });
                  </script></td>
              </tr>
            </table></fieldset>			</td>
        </tr>
        <tr>
          <td height="43">&nbsp;</td>
          </tr>
        
        <tr>
          <td height="173">&nbsp;</td>
          <td><table width="462" height="103" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="462" height="103" align="center">
			  
			  <fieldset>
                <legend class="Estilo107">Seleccionar Cuentas</legend>
				
				<div id="cuentasVentas" style="display:none">
                <table width="403" height="131" border="0" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
                  <tr>
                    <td width="107" height="21">&nbsp;</td>
                    <td colspan="2"><span class="Estilo12 Estilo104 Estilo107 Estilo106"><span class="Estilo104 Estilo102 Estilo113">Cuenta Contable </span></span></td>
                    <td width="105"><span class="Estilo12 Estilo104 Estilo107 Estilo106"><span class="Estilo104 Estilo102 Estilo113">Destino Cuenta </span></span></td>
                  </tr>
                  <tr>
                    <td height="22" align="left"><span class="Estilo10 Estilo102">Base Imponible </span></td>
                    <td colspan="2" align="left">
					<input type="text"  name="inicuentabi[]" value="70" style="text-align:center; width:25px; "/>
					<input name="cuentabi[]" id="cuentabi"  type="text" value="<?php echo substr($cuentaBI,2,strlen($cuentaBI))?>" size="8" style="text-align:center;" onKeyPress="return soloNumeros(event);"  />					</td>
					
                    <td>
					<select name="destinobi[]" id="destinobi">
                       <!-- <option value="0" selected="selected">-------</option>-->
                        <option value="D">DEBE</option>
                        <option selected="selected" value="H">HABER</option>
                      </select>
                        <script>
						 var valor1="<?php echo $destinobi?>";
						 var i;
						 for (i=0;i<document.form1.destinobi.options.length;i++)
							{
							
									if (document.form1.destinobi.options[i].value==valor1)
								   {
								   
								   document.form1.destinobi.options[i].selected=true;
								   }
							
							}
			
			      		</script>
				  </td>
				  
                  </tr>
                  <tr>
                    <td height="22" align="left"><span class="Estilo10 Estilo102">IGV (18%) </span></td>
                    <td colspan="2" align="left"><input type="text" name="inicuentaimp[]" value="40" style="text-align:center; width:25px; "/>
                      <input type="text" name="cuentaimp[]" id="cuentaimp" value="<?php echo  substr($cuentaIGV,2,strlen($cuentaIGV))?>" size="8" style="text-align:center;" /></td>
                    <td><select name="destinoimp[]" id="destinoimp">
                       <!-- <option value="0" selected="selected">-------</option>-->
                        <option value="D">DEBE</option>
                        <option selected="selected" value="H">HABER</option>
                      </select>
                        <script>
			 var valor1="<?php echo $destinoimp?>";
     var i;
	 for (i=0;i<document.form1.destinoimp.options.length;i++)
        {
		
            if (document.form1.destinoimp.options[i].value==valor1)
               {
			   
               document.form1.destinoimp.options[i].selected=true;
               }
        
        }
			
			      </script>                    </td>
                  </tr>
                
				  <tr>
                <td align="left"><span class="Estilo10 Estilo102">Servicios / Otros </span></td>
                <td colspan="2" align="left">
				<input type="text"  name="inicuentades[]" value="40" style="text-align:center; width:25px;"/>
				<input type="text" name="cuentades[]" id="cuentades" value="<?php echo substr($cuentaDes,2,strlen($cuentaDes)) ?>" size="8" style="text-align:center;"/>				        </td>
                <td><select name="destinodes[]" id="destinodes">
                     <!-- <option value="0" selected="selected">-------</option>-->
                      <option value="D">DEBE</option>
                      <option value="H" selected="selected">HABER</option>
                    </select>	
					
					<script>
			 var valor1="<?php echo $destinodes?>";
     var i;
	 for (i=0;i<document.form1.destinodes.options.length;i++)
        {
		
            if (document.form1.destinodes.options[i].value==valor1)
               {
			   
               document.form1.destinodes.options[i].selected=true;
               }
        
        }
			
			    </script>				</td>
              </tr>
				
                  <tr>
                    <td height="39" rowspan="2" align="left"><span class="Estilo10 Estilo102">Total</span></td>
                    <td height="15" align="left" style="color:#FF0000">Soles</td>
                    <td height="15" align="left" style="color:#FF0000">D&oacute;lares</td>
                    <td>                  </td>
                  </tr>
                  <tr>
                    <td width="93" height="22" align="left"><input type="text" name="inicuentatot[]" value="12" style="text-align:center; width:25px; "/>
                      <input type="text" name="cuentatotS[]" id="cuentatotS" value="<?php echo substr($cuentatotalS,2,strlen($cuentatotalS)) ?>" size="5" style="text-align:center;" /></td>
                    <td width="85" align="left"><input type="text" name="inicuentatot2[]" value="12" style="text-align:center; width:25px; "/>
                        <input type="text" name="cuentatotD[]" id="cuentatotD" value="<?php echo substr($cuentatotalD,2,strlen($cuentatotalD)) ?>" size="5" style="text-align:center;" /></td>
                    <td><select name="destinotot[]" id="destinotot">
                      <!--<option value="0" selected="selected">-------</option>-->
                      <option selected="selected" value="D">DEBE</option>
                      <option value="H">HABER</option>
                    </select>
					<script>
			 var valor1="<?php echo $destinotot?>";
     var i;
	 for (i=0;i<document.form1.destinotot.options.length;i++)
        {
		
            if (document.form1.destinotot.options[i].value==valor1)
               {
			   
               document.form1.destinotot.options[i].selected=true;
               }
        
        }
			
			      </script>					</td>
                  </tr>
                </table>
				</div>
				
				<div id="cuentasCompras" style="display:none">
                <table width="385" height="115" border="0" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
                  <tr>
                 <td width="107" height="21">&nbsp;</td>
                    <td colspan="2"><span class="Estilo12 Estilo104 Estilo107 Estilo106"><span class="Estilo104 Estilo102 Estilo113">Cuenta Contable </span></span></td>
                    <td width="109"><span class="Estilo12 Estilo104 Estilo107 Estilo106"><span class="Estilo104 Estilo102 Estilo113">Destino Cuenta </span></span></td>
                  </tr>
                  <tr>
                    <td height="22"><span class="Estilo10 Estilo102">Base Imponible </span></td>
                    <td colspan="2">
					<input type="text" name="inicuentabi[]" value="60" style="text-align:center; width:25px; "/>
					<input name="cuentabi[]" id="cuentabi" type="text" value="<?php echo substr($cuentabi,2,strlen($cuentabi));?>" size="8"  style="text-align:center;" />					</td>
                    <td><select name="destinobi[]" id="destinobi">
                        <option value="0" selected="selected">-------</option>
                        <option value="D">DEBE</option>
                        <option value="H">HABER</option>
                      </select>
                      </td>
                  </tr>
                  <tr>
                    <td height="22"><span class="Estilo10 Estilo102">IGV (18%) </span></td>
                    <td colspan="2"><input type="text" name="inicuentaimp[]" value="40" style="text-align:center; width:25px; "/>
                      <input type="text" name="cuentaimp[]" id="cuentaimp" value="<?php echo substr($cuentaimp,2,strlen($cuentaimp));?>" size="8"  style="text-align:center;" /></td>
                    <td><select name="destinoimp[]" id="destinoimp">
                        <option value="0" selected="selected">-------</option>
                        <option value="D">DEBE</option>
                        <option value="H">HABER</option>
                      </select>
                          </td>
                  </tr>
                 
                  <tr>
                    <td height="39" rowspan="2"><span class="Estilo10 Estilo102">Total</span></td>
                    <td height="15" style="color:#FF0000">Soles</td>
                    <td height="15" style="color:#FF0000">Dolares</td>
                    <td>                  </td>
                  </tr>
                  <tr>
                    <td width="74" height="22"><input type="text" name="inicuentatot[]" value="42" style="text-align:center; width:25px;"/>
                      <input type="text" name="cuentatotS[]" id="cuentatotS" value="12101" size="5" style="text-align:center;" /></td>
                    <td width="82"><input type="text" name="inicuentatot2" value="42" style="text-align:center; width:25px; "/>
                        <input type="text" name="cuentatotD[]" id="cuentatotD" value="12102" size="5" style="text-align:center;" /></td>
                    <td><select name="destinotot[]" id="destinotot">
                      <option value="0" selected="selected">-------</option>
                      <option value="D">DEBE</option>
                      <option value="H">HABER</option>
                    </select>
						  </td>
                  </tr>
                </table>
				</div>
				
                <div id="cuentasVentas2" style="display:none">
                
                <table width="403" height="131" border="0" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
				<tr>
					<td width="107" height="21">&nbsp;</td>
					<td colspan="2"><span class="Estilo12 Estilo104 Estilo107 Estilo106"><span class="Estilo104 Estilo102 Estilo113">Cuenta Contable </span></span></td>
					<td width="105"><span class="Estilo12 Estilo104 Estilo107 Estilo106"><span class="Estilo104 Estilo102 Estilo113">Destino Cuenta </span></span></td>
				</tr>
				<tr>
					<td height="22" align="left"><span class="Estilo10 Estilo102">Productos</span></td>
					<td colspan="2" align="left"><input type="button" name="button" id="opener2" value="Seleccionar Cuentas" ></td>
					<td><select name="destinobi[]2" id="destinobi[]">
			        	<!-- <option value="0" selected="selected">-------</option>-->
						<option value="D">DEBE</option>
						<option selected="selected" value="H">HABER</option>
					</select>
                    <script>
					var valor1="<?php echo $destinobi?>";
					var i;
					//alert(document.form1.destinobi.length);
					//for (i=0;i<document.form1.destinobi.options.length;i++)
					for (i=0;i<document.form1.destinobi.length;i++)
					{
						//if (document.form1.destinobi.options[i].value==valor1)
						if (document.form1.destinobi[i].value==valor1)
               			{
			   				//document.form1.destinobi.options[i].selected=true;
							document.form1.destinobi[i].selected=true;
						}
        			}
					</script></td>
				</tr>
				<tr style=" display:none">
					<td height="22" align="left"><span class="Estilo10 Estilo102">IGV (19%) </span></td>
					<td colspan="2" align="left"><input type="text" name="inicuentaimp[]" value="40" style="text-align:center; width:25px; "/>
					<input type="text" name="cuentaimp[]" id="cuentaimp" value="<?php echo  substr($cuentaIGV,2,strlen($cuentaIGV))?>" size="8" style="text-align:center;" /></td>
					<td><select name="destinoimp[]" id="destinoimp">
						<!-- <option value="0" selected="selected">-------</option>-->
						<option value="D">DEBE</option>
						<option selected="selected" value="H">HABER</option>
					</select>
					<script>
					var valor1="<?php echo $destinoimp?>";
					var i;
					//for (i=0;i<document.form1.destinoimp.options.length;i++)
					for (i=0;i<document.form1.destinoimp.length;i++)
					{
						//if (document.form1.destinoimp.options[i].value==valor1)
						if (document.form1.destinoimp[i].value==valor1)
						{
			   				//document.form1.destinoimp.options[i].selected=true;
							document.form1.destinoimp[i].selected=true;
						}
					}
					</script></td>
				</tr>
				<tr style="display:none">
					<td align="left"><span class="Estilo10 Estilo102">Servicios / Otros </span></td>
					<td colspan="2" align="left">
					<input type="text"  name="inicuentades[]" value="40" style="text-align:center; width:25px;"/>
					<input type="text" name="cuentades[]" id="cuentades" value="<?php echo substr($cuentaDes,2,strlen($cuentaDes)) ?>" size="8" style="text-align:center;"/></td>
					<td><select name="destinodes[]" id="destinodes">
						<!-- <option value="0" selected="selected">-------</option>-->
						<option value="D">DEBE</option>
						<option value="H" selected="selected">HABER</option>
					</select>	
					<script>
						var valor1="<?php echo $destinodes?>";
						var i;
						//for (i=0;i<document.form1.destinodes.options.length;i++)
						for (i=0;i<document.form1.destinodes.length;i++)
						{
							//if (document.form1.destinodes.options[i].value==valor1)
							if (document.form1.destinodes[i].value==valor1)
							{
								//document.form1.destinodes.options[i].selected=true;
								document.form1.destinodes[i].selected=true;
							}
        				}
					</script></td>
				</tr>
				<tr>
					<td height="39" rowspan="2" align="left"><span class="Estilo10 Estilo102">Total</span></td>
					<td height="15" align="left" style="color:#FF0000">Soles</td>
					<td height="15" align="left" style="color:#FF0000">D&oacute;lares</td>
					<td>                  </td>
				</tr>
				<tr>
					<td width="93" height="22" align="left">
                    <input type="text" name="inicuentatot[]" value="12" style="text-align:center; width:25px; "/>
					<input type="text" name="cuentatotS[]" id="cuentatotS" value="<?php echo substr($cuentatotalS,2,strlen($cuentatotalS)) ?>" size="5" style="text-align:center;" /></td>
					<td width="85" align="left"><input type="text" name="inicuentatot2[]" value="12" style="text-align:center; width:25px; "/>
					<input type="text" name="cuentatotD[]" id="cuentatotD" value="<?php echo substr($cuentatotalD,2,strlen($cuentatotalD)) ?>" size="5" style="text-align:center;" /></td>
					<td><select name="destinotot[]" id="destinotot">
						<!--<option value="0" selected="selected">-------</option>-->
						<option selected="selected" value="D">DEBE</option>
						<option value="H">HABER</option>
					</select>
					<script>
						var valor1="<?php echo $destinotot?>";
						var i;
						//for (i=0;i<document.form1.destinotot.options.length;i++)
						for (i=0;i<document.form1.destinotot.length;i++)
						{
							//if (document.form1.destinotot.options[i].value==valor1)
							if (document.form1.destinotot[i].value==valor1)
							{
								//document.form1.destinotot.options[i].selected=true;
								document.form1.destinotot[i].selected=true;
							}
						}
					</script></td>
				</tr>
				</table>
                </div>
				
                <div id="cuentasCompras2" style="display:block">
                <table width="403" height="131" border="0" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
				<tr>
					<td width="96" height="21">&nbsp;</td>
					<td colspan="2"><span class="Estilo12 Estilo104 Estilo107 Estilo106"><span class="Estilo104 Estilo102 Estilo113">Cuenta Contable </span></span></td>
					<td width="113"><span class="Estilo12 Estilo104 Estilo107 Estilo106"><span class="Estilo104 Estilo102 Estilo113">Destino Cuenta </span></span></td>
				</tr>
				<tr>
					<td height="22" align="left"><span class="Estilo10 Estilo102">Productos</span></td>
					<td colspan="2" align="left"><input type="button" name="button" id="opener1" value="Seleccionar Cuentas" ></td>
					<td><select name="destinobi[]2" id="destinobi[]">
			        	<!-- <option value="0" selected="selected">-------</option>-->
						<option selected="selected" value="D">DEBE</option>
						<option value="H">HABER</option>
					</select>
                   <!-- <script>
					var valor1="<?php //echo $destinobi?>";
					var i;
					//alert(document.form1.destinobi.length);
					//for (i=0;i<document.form1.destinobi.options.length;i++)
					for (i=0;i<document.form1.destinobi.length;i++)
					{
						//if (document.form1.destinobi.options[i].value==valor1)
						if (document.form1.destinobi[i].value==valor1)
               			{
			   				//document.form1.destinobi.options[i].selected=true;
							document.form1.destinobi[i].selected=true;
						}
        			}
					</script>--></td>
				</tr>
				<tr style="display:none">
					<td height="22"><span class="Estilo10 Estilo102">IGV (18%) </span></td>
                    <td colspan="2"><input type="text" name="inicuentaimp[]" value="40" style="text-align:center; width:25px; "/>
                      <input type="text" name="cuentaimp[]" id="cuentaimp" value="<?php echo substr($cuentaimp,2,strlen($cuentaimp));?>" size="8"  style="text-align:center;" /></td>
                    <td><select name="destinoimp[]" id="destinoimp">
                        <option value="0">-------</option>
                        <option value="D" selected="selected">DEBE</option>
                        <option value="H">HABER</option>
                      </select>
                          </td>
                  </tr>
                 
                  <tr>
                    <td height="39" rowspan="2"><span class="Estilo10 Estilo102">Total</span></td>
                    <td height="15" style="color:#FF0000">Soles</td>
                    <td height="15" style="color:#FF0000">Dolares</td>
                    <td>                  </td>
                  </tr>
                  <tr>
                    <td width="95" height="22"><input type="text" name="inicuentatot[]" value="42" style="text-align:center; width:25px; "/>
                      <input type="text" name="cuentatotS[]" id="cuentatotS" value="12101" size="5" style="text-align:center;" /></td>
                    <td width="86"><input type="text" name="inicuentatot2" value="42" style="text-align:center; width:25px; "/>
                        <input type="text" name="cuentatotD[]" id="cuentatotD" value="12102" size="5" style="text-align:center;" /></td>
                    <td><select name="destinotot[]" id="destinotot">
                      <option value="0">-------</option>
                      <option value="D">DEBE</option>
                      <option selected="selected" value="H">HABER</option>
                    </select>
						  </td>
                  </tr>
                </table>
				</div>
                
              </fieldset></td>
            </tr>
          </table></td>
        </tr>
        
        <tr>
          <td height="19">&nbsp;</td>
          <td height="19" colspan="3" class="Estilo111">Archivos</td>
        </tr>
        <tr>
          <td height="100">&nbsp;</td>
          <td colspan="3">
		  <div id="listaDatos" style=" overflow-y:scroll; height:100px;">		  </div>		  </td>
          </tr>
		  
		    <tr>
          <td height="19">&nbsp;</td>
          <td colspan="3">
		  <div id="paginacion">		  </div>		  </td>
          </tr>
            
      </table></td>
    </tr>
  </table>
  
   <div id="docincluir" style="position:absolute; left:470px; top:113px; width:302px; height:180px; z-index:2; visibility:hidden"> </div>  
  
</form>
</body>
</html>

<script>
function cambiar(valor){
document.form1.temporal.value=valor;
}

function activar(temp){

	if(temp.checked){
		if(temp.value=="M"){
		document.form1.mes.disabled=false;
		document.form1.anio.disabled=false;
		document.form1.fecha.disabled=true;
		document.form1.f_trigger_b2.disabled=true;
		}
		
		if(temp.value=="D"){
		document.form1.fecha.disabled=false;
		document.form1.f_trigger_b2.disabled=false;
		document.form1.mes.disabled=true;
		document.form1.anio.disabled=true;
		
		}
	
	}


}
function validartecla2(e,valor,temp){
	//if(document.getElementById(temp).style.visibility!='visible' ){
		//temp_busqueda2=document.form1.busqueda2.value;
		//alert(temp_busqueda2);
	document.form1.carga.value="S";
	var tipo=document.form1.tipo.value;
	if(tipo==1){
	var rep="TRANSF_CONTA_COMPRAS";
	}else{
	var rep="TRANSF_CONTA_VENTAS";
	}
doAjax('reportes/documentos.php','&temp='+temp+'&tipo='+tipo+"&reporte="+rep,'listadocumentos','get','0','1','','');
	//}
}
function listadocumentos(texto){
	var r = texto;
	document.getElementById('docincluir').innerHTML=r;
	//document.getElementById('docincluir').rows[0].style.background='#fff1bb';
	document.getElementById('docincluir').style.visibility='visible';
	ocultarCbos();
}

function listadocumentos2(texto){
	var r = texto;
	document.getElementById('docincluir').innerHTML=r;
	
	change_tFormato(document.form1.tformato[1]);

}

function ocultarCbos(){	
	for(var i=0;i<document.form1.elements.length;i++){
	//alert(document.formulario.elements[i].type);
	 	if(document.form1.elements[i].type=="select-one"){
		 document.form1.elements[i].style.visibility="hidden";
		}
	}
}
function mostrarCbos(){	
	for(var i=0;i<document.form1.elements.length;i++){
	//alert(document.formulario.elements[i].type);
	 	if(document.form1.elements[i].type=="select-one"){
		 document.form1.elements[i].style.visibility="visible";
		}
	}
}
function salir(){

	document.getElementById('docincluir').style.visibility='hidden';
	mostrarCbos();
	
}
function Guarda(){
	var temp1=0;
	var docRk ='';
	//alert();
	for(var i=0;i<document.form1.Ingresos.length;i++){	
		if(document.form1.Ingresos[i].checked){
		docRk+=document.form1.Ingresos[i].value+',';
		temp1=1;
		}		
	}
//alert(docRk);
			
	if(temp1==0){
	alert('Seleccione Documento');
	return false
	}
	var tipo=document.form1.tipo.value;
	if(tipo==1){
	var rep="TRANSF_CONTA_COMPRAS";
	}else{
	var rep="TRANSF_CONTA_VENTAS";
	}
    //if(confirm("Seguro de Aceptar configuración")){
	//alert(docRk+" "+rep);
			//document.form1.carga.value="S";
			doAjax('reportes/documentos.php','&docRk='+docRk+"&reporte="+rep,'','get','0','1','','');
			document.getElementById('docincluir').style.visibility='hidden';
			mostrarCbos();
	//}
}

function marcar(){
	
	if(document.form1.GrupoOpciones1[0].checked){
		for(var i=0;i<document.form1.Ingresos.length;i++){
		document.form1.Ingresos[i].checked=true;
		}	
	}else{
			for(var i=0;i<document.form1.Ingresos.length;i++){
			document.form1.Ingresos[i].checked=false;
			}		
	}
}

function cargar_lista(pag){
	var modulo="pagos";
	doAjax('peticion_ajax2.php','&peticion=lista_transfConta&pag='+pag+'&modulo='+modulo,'mostrarLista','get','0','1','','');
	
}
function cargar_datos(pag){
cargar_lista(pag);

}


function mostrarLista(texto){
//alert(texto);
var temp=texto.split("|");
document.getElementById('listaDatos').innerHTML=temp[0];
document.getElementById('paginacion').innerHTML=temp[1];

document.form1.carga.value="S";
	var tipo=document.form1.tipo.value;
	if(tipo==1){
	var rep="TRANSF_CONTA_COMPRAS";
	}else{
	var rep="TRANSF_CONTA_VENTAS";
	}
	
doAjax('reportes/documentos.php','&temp=docincluir&tipo='+tipo+"&reporte="+rep,'listadocumentos2','get','0','1','','');

}

function cambiarCuentas(control){
	if(control.value=='1'){
	document.getElementById('cuentasCompras').style.display="block";
	document.getElementById('cuentasVentas').style.display="none";
	document.getElementById('cuentasVentas2').style.display="none";
	document.getElementById('cuentasCompras2').style.display="none";
	
	seleccionar_cbo(document.form1.destinobi[1],"D");
	seleccionar_cbo(document.form1.destinoimp[1],"D");
	//seleccionar_cbo("destinodes","H");
	seleccionar_cbo(document.form1.destinotot[1],"H");
	
	}else{
	document.getElementById('cuentasVentas').style.display="block";
	document.getElementById('cuentasCompras').style.display="none";
	document.getElementById('cuentasVentas2').style.display="none";
	document.getElementById('cuentasCompras2').style.display="none";
	
	seleccionar_cbo(document.form1.destinobi[0],"H");
	seleccionar_cbo(document.form1.destinoimp[0],"H");
	seleccionar_cbo(document.form1.destinodes,"H");
	seleccionar_cbo(document.form1.destinotot[0],"D");
	
	}
	var tipo=document.form1.tipo.value;
	if(tipo==1){
	var rep="TRANSF_CONTA_COMPRAS";
	}else{
	var rep="TRANSF_CONTA_VENTAS";
	}
	//alert();
doAjax('reportes/documentos.php','&temp=docincluir&tipo='+tipo+"&reporte="+rep,'listadocumentos2','get','0','1','','');

}

function seleccionar_cbo(control,valor){
		
		 var valor1=valor;
         var i;
		// alert(valor1+" "+control);
	     for (i=0;i< control.options.length;i++)
        {
		//alert(eval("document.formulario."+control+".options[i].value")+" "+valor1);
         if (control.options[i].value==valor1 )
            {
		//	alert("entro");
			   control.options[i].selected=true;
            }
        
        }
		
}


function change_tFormato(control){
	
	//alert(control.value);
	if(control.value=='detallado'){	
		document.getElementById('cuentasVentas').style.display="none";
		document.getElementById('cuentasCompras').style.display="none";
				
		if(document.form1.tipo.value=="2"){
			document.getElementById('cuentasVentas2').style.display="block";
		}else{
			document.getElementById('cuentasCompras2').style.display="block";
		}
		
	}else{
	cambiarCuentas(document.form1.tipo);
	}

}

function cargar_datos2(pag){
	
	var aplicacion = $('#tipo :selected').val();
	var contenidoAjax = $('div#dialog').html('<p align="center"><img src="imgenes/loader.gif" /></p>');	
	
	$.ajax({
			type : "POST",
			url : "peticion_ajax5.php",
			data  : 'peticion=lista_prod_cuentas&aplicacion='+aplicacion+'&pag='+pag ,
			success : function(data) {
				
				contenidoAjax.html(data);
			  //alert(data);
			  //document.getElementById("dialog").innerHTML=data;
			}
   });
	
}



function cargar_cbo(texto){
var r = texto;
document.getElementById('cbo_tienda').innerHTML=r;
//document.form1.almacen.focus();
}

function enfocar_cbo(x){
}

function limpiar_enfoque(x){
}
function cambiar_enfoque(x){
}

function eliminarFiles(id,archivo){
	var pag="";
	var modulo="pagos";
	doAjax('peticion_ajax2.php','&peticion=lista_transfConta&pag='+pag+'&eliminar=&id='+id+'&archivo='+archivo+'&modulo='+modulo,'mostrarLista','get','0','1','','');
	
		
}


</script>