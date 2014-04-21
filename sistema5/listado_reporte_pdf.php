<?php

	include('conex_inicial.php');
	include ('funciones/funciones.php');

require_once(dirname(__FILE__).'/exportar_pdf/html2pdf.class.php');
    try{
	
			$fecha1=formatofecha($_REQUEST['fecha']);
			$fecha2=formatofecha($_REQUEST['fecha2']);
			
			
			
			$cad_fecha_1=split("-",$fecha1);
			$fecha1_bien=$cad_fecha_1[2]."/".$cad_fecha_1[1]."/".$cad_fecha_1[0];
			$cad_fecha_2=split("-",$fecha2);
			$fecha2_bien=$cad_fecha_2[2]."/".$cad_fecha_2[1]."/".$cad_fecha_2[0];
			
		
			
			$fecha3=$_REQUEST['fecha3'];
			$sucursal=$_REQUEST['empresa_recuperada'];
			$tienda=$_REQUEST['tienda_recuperada'];
			
			
			
			$cad_tienda="select des_tienda from tienda where cod_tienda='$tienda'";
			$rs_tienda=mysql_query($cad_tienda);
			$lista_tienda=mysql_fetch_array($rs_tienda);
			
			$nobre_de_la_tienda=$lista_tienda["des_tienda"];
			
			if(empty($nobre_de_la_tienda)){
			  $nobre_de_la_tienda="TODOS LOS ALMACENES";
			}
			
			
			
			$tipo=$_REQUEST['tipo'];
			$cliente=$_REQUEST['cliente'];
			$percepcion=$_REQUEST['percepcion'];
			
			$sinreferencia=$_REQUEST['sinreferencia'];
					
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
			
			$filtro3=" and substring(fecha,12,9) between '$hinicio' and '$hfin' ";
			
			}else{
			$filtro3="";
			}			
			
		
			if($sucursal=='0'){
			$filtro5="";
			}else{
				if($tienda=='0'){
				$filtro5=" and sucursal='$sucursal' ";					
				}else{
				$filtro5=" and sucursal='$sucursal' and tienda='$tienda' ";					
				}
				
			}
			
			if($cliente!=''){
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
			$rstemp	=	mysql_query("Select documentos from temp where cod_user='".$_REQUEST['cod_user']."' and reporte='REGISTRO_COMPRAS'",$cn);
			}else{	
			$rstemp	=	mysql_query("Select documentos from temp where cod_user='".$_REQUEST['cod_user']."' and reporte='REGISTRO_VENTAS'",$cn);
			}
	
	$rowtemp=	mysql_fetch_array($rstemp);
	if( !empty( $rowtemp['documentos'] ) ){ 
	$filtro56 = " ".$rowtemp['documentos'];	
	$tipdoc="and cod_ope in (".$filtro56.")";
	}

	if($_REQUEST['agrp']=='v_normal'){
	$order=" order by LEFT(fecha,10),cod_ope,CONCAT(serie,Num_doc) ";
	}elseif($_REQUEST['agrp']=='ag_dia'){
	$order=" order by LEFT(fecha,10),cod_ope ";
	}else{
		$order=" order by cod_ope,serie,Num_doc,LEFT(fecha,10) ";
	}
	$ffecha="fecha";
	if($fecha3!=''){
		$ffecha=$fecha3;
	}
	
	if($_REQUEST['condicion']!=0){
	$filtro7= " and condicion='".$_REQUEST['condicion']."'";
	}
	
	$filtroPercep=" ";
	if($percepcion == 'S'){
	$filtroPercep = " and percepcion >0 ";
	}
	
	$filtroRef="";
	if($sinreferencia=='S'){
	$filtroRef=" and flag_r='' ";
	}
					
		$strSQL="select * from cab_mov where tipo='$tipo' $tipdoc and substring($ffecha,1,10) between '$fecha1' and '$fecha2' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$filtro6.$filtro7.$filtroPercep.$filtroRef.$order;
		
		
		
		$resultados = mysql_query($strSQL,$cn);
		
		
		$fec_prev="";$td_prev="";
		$cont=0;	
		
		   $contenido='<style>';
		   $contenido.='body{color:#FF0000;font-size:12px;font-family:Arial, Helvetica, sans-serif;}';
		   $contenido.='.tachado_rojo{height:auto;color:red;text-decoration:line-through;clear:left}';
		   $contenido.='.simbolo_rojo{height:auto;color:red;}';
		   $contenido.='.espaciado{float:left;width:100%;height:1px;}';
		   $contenido.='.data td{font-size:11px;font-family:Arial, Helvetica, sans-serif}';
		   $contenido.='.data th{font-size:11px;font-family:Arial, Helvetica, sans-serif}';
		    
		   
		   $contenido.='.contenedor_cabecera{margin:0px auto;width:550px;height:auto;text-align:center;font-size:12px;margin-top:30px;}';
	       $contenido.='.fila{float:left;width:100%;height:auto;margin-bottom:5px}';
		   $contenido.='</style>';
		   
		   if($tipo=='1'){
		        $texto_cab.='<b>Relacion de Documentos Compras / Ingresos</b>';
		   }else{
				$texto_cab.='<b>Relacion de Documentos Salidas / Ventas</b>';
		   }
		   
			/*$contenido.=$sucursal;
			$contenido.=$tienda;*/
		   
		   
		   
			$contenido.='<div class="contenedor_cabecera">';
			$contenido.='<div class="fila" style="font-size:16px">'.mb_strtoupper($texto_cab,'UTF-8').'</div>';
			
			$contenido.='<div class="fila"><b>'. mb_strtoupper($_REQUEST["name_empresa"],'UTF-8') . " </b>  //  ". "<b> ".$nobre_de_la_tienda.'</b></div>';
			$contenido.='<div class="fila"><b>Del '.$fecha1_bien.' Al '.$fecha2_bien.'</b></div>';
			$contenido.='</div>';
		   

		   
			$contenido.='<div class="espaciado"></div>';
		   		   
			$contenido.='<table cellspacing="0" cellpadding="0" border="0" width="auto" height="auto" class="data">';
			$contenido.='<tr>';
			
			$contenido.='<th width:"40" style="border-bottom:#000000;border-top:#000000;height:35px"><strong>Cod.<br>Local</strong></th>';
			$contenido.='<th width:"55" style="border-bottom:#000000;border-top:#000000"><strong>Kardex</strong></th>';
			
			$contenido.='<th width:"50" style="border-bottom:#000000;border-top:#000000"><strong>Emisi&oacute;n</strong></th>';
			
			$contenido.='<th width:"50" style="border-bottom:#000000;border-top:#000000"><strong>Doc.</strong></th>';
			
			$contenido.='<th width:"80" style="border-bottom:#000000;border-top:#000000"><strong>Nro.<br>Documento</strong></th>';
			
	
	       if($tipo=='2'){ $name_cabecera="Cliente";}else{$name_cabecera="Proveedor";}

	
		    $contenido.='<th width:"170" style="border-bottom:#000000;border-top:#000000"> <strong>'.$name_cabecera.'</strong></th>';
			
			
			 $contenido.='<th width=:100" style="border-bottom:#000000;border-top:#000000"><strong>Condici&oacute;n</strong></th>';
			
			
			$contenido.='<th width:"80" style="border-bottom:#000000;border-top:#000000"><strong>Referencia</strong></th>';
			
			$contenido.='<th width:"60" style="border-bottom:#000000;border-top:#000000"><strong>Moneda</strong></th>';
			
			$contenido.='<th width:"60" style="border-bottom:#000000;border-top:#000000"><strong>B.Imp</strong></th>';
			$contenido.='<th width:"60" style="border-bottom:#000000;border-top:#000000"><strong>Igv</strong></th>';
			
			
			if($tipo!="01"){
			
			$contenido.='<th width:"70" style="border-bottom:#000000;border-top:#000000"><strong>Percep.</strong></th>';
			}
			
			$contenido.='<th width:"60" style="border-bottom:#000000;border-top:#000000"><strong>Total</strong></th>';
			$contenido.='<th width:"60" style="border-bottom:#000000;border-top:#000000"><strong>Responsable</strong></th>';
			$contenido.='</tr>';
	
	
	$importe_soles=0;
	$importe_soles_dolares=0;
	$contador=1;
	 while($row=mysql_fetch_array($resultados)){
	 
	        $cod_vendedor=$row['cod_vendedor'];
			$fecha=$row['fecha']; 
			$td=$row['cod_ope'];
			$documento=$row['serie']." - ".$row['Num_doc'];	
			$cliente=$row['cliente'];
			$referencia=$row['cod_cab'];
			$moneda_real=$row['moneda'];
			$kardex=$row['kardex'];
			$condicion=$row["condicion"];
			
			$cad_cond="SELECT nombre as 'name_c' FROM condicion where codigo='$condicion'";
			$lista_con=mysql_query($cad_cond);
			$rpta_con=mysql_fetch_array($lista_con);
			$name_condicion=$rpta_con["name_c"];
			

			if($moneda_real=='02'){ 
			    $moneda=" US$. "; 
			}else{$moneda=" S/. ";}
			
			$importe=$row['b_imp'];
			$igv=$row['igv'];
			$imp_percepcion=$row['percepcion'];
			$total=$row['total'];
			
			$flag=$row['flag'];
			
			
			if($flag!='A'){
				if($moneda=" US$. "){	  
					$totgen_cant2++;
					$totgen_item2+=$items;
					$totgen_base2+=$importe;
					$totgen_igv2+=$igv;
					$totgen_total2+=$total;
			

				}else{
					$totgen_cant1++;
					$totgen_item1+=$items;
					$totgen_base1+=$importe;
					$totgen_igv1+=$igv;
					$totgen_total1+=$total;
				}
			}
			
			
			
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
			
			
			
			
			if($td=="NC"){
				$importe=$importe*(-1);
				$igv=$igv*(-1);
				$total=$total*-1;
				$items=$items*-1;
			}
		
		
		if($td!='TS'){
			$clix=mysql_fetch_array(mysql_query("select ruc,razonsocial,tipo_aux from cliente where codcliente='".$cliente."'"));
			$tipoaux=$clix['tipo_aux'];
			$razonsocial=$clix['razonsocial'];
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
			
			}
		
		
		 if($flag!='A'){
		$contenido.='<tr>';
		$contenido.='<td align="lefth" width="40" height="auto">'.$tienda.'</td>';
		$contenido.='<td align="lefth" width="55" height="auto">'.$kardex.'</td>';
	
		$contenido.='<td align="lefth" width="70" height="auto">'.extraefecha4(substr($fecha,0,10)).'</td>';
		
		$contenido.='<td align="lefth" width="40" height="auto">'.$td.'</td>';
		$contenido.='<td align="lefth" width="80" height="auto">'.$documento.'</td>';
		$contenido.='<td align="lefth" width="170" height="auto">'.caracteres($razonsocial).'</td>';
		$contenido.='<td align="lefth" width="130" height="auto">'.$name_condicion.'</td>';
				
		//$referencia
		list($cod_cabRef)	=	mysql_fetch_array(mysql_query("select cod_cab_ref from referencia where cod_cab='".$referencia."'"));
		
		
		list($cod_cabRef,$serieRef,$numeroRef)	=	mysql_fetch_array(mysql_query("select cod_ope,serie,Num_doc from cab_mov where cod_cab='".$cod_cabRef."'"));
		
			$contenido.='<td align="lefth" width="100">'.$cod_cabRef." ".$serieRef." ".$numeroRef.'</td>';
			
	
				if($moneda_real=="02"){
				$simbolo="US$.";
				}else{
				$simbolo="S/.";
				}
	
			 $contenido.='<td align="lefth" width="60" height="auto">';
			
			 $contenido.=$simbolo;
			 $contenido.='</td>';
			
			
			 $contenido.='<td align="lefth" width="60" height="auto">';
			
			 $contenido.=number_format($importe,2);
			 $contenido.='</td>';

			
			$contenido.='<td align="lefth" width="60" height="auto">'.number_format($igv,2).'</td>';
			
			if($tipo!="01"){
			$contenido.='<td align="lefth" width="50" height="auto">'.number_format($imp_percepcion,2).'</td>';
			}
			
			$contenido.='<td align="lefth" width="60">'.number_format($total+$imp_percepcion,2).'</td>';
			
			
			$strSQL_vend="select usuario from usuarios where codigo='".$cod_vendedor."'";
			$resultado_vend=mysql_query($strSQL_vend,$cn);
			$row_vend=mysql_fetch_array($resultado_vend);
			
			$responsable=$row_vend['usuario'];
			
			$contenido.='<td align="lefth" width="70">'.$responsable.'</td>';
			

		$contenido.='</tr>';
		}else{
		 $contenido.='<tr>';
		 
		 $contenido.='<td align="lefth" width="40" height="auto" class="tachado_rojo">'.$tienda.'</td>';
		 $contenido.='<td align="lefth" width="55" height="auto" class="tachado_rojo">'.$kardex.'</td>';
		 
		$contenido.='<td align="lefth" width="70" height="auto" class="tachado_rojo">'.extraefecha4(substr($fecha,0,10)).'</td>';
		 
		$contenido.='<td align="lefth" width="40" height="auto" class="tachado_rojo">'.$td.'</td>';
		
		$contenido.='<td align="lefth" width="80" height="auto" class="tachado_rojo">'.$documento.'</td>';
		
		$contenido.='<td align="lefth" width="170" height="auto">'.caracteres($razonsocial).'</td>';
			
		$contenido.='<td align="lefth" width="130" height="auto">'.$name_condicion.'</td>';	
			
				//$referencia
				list($cod_cabRef)	=	mysql_fetch_array(mysql_query("select cod_cab_ref from referencia where cod_cab='".$referencia."'"));
				
				
				list($cod_cabRef,$serieRef,$numeroRef)	=	mysql_fetch_array(mysql_query("select cod_ope,serie,Num_doc from cab_mov where cod_cab='".$cod_cabRef."'"));
				

	$contenido.='<td align="lefth" width="100">'.$cod_cabRef." ".$serieRef." ".$numeroRef.'</td>';
		
			
				
				$contenido.='<td colspan="6" align="center">ANULADO</td>';
				
		 
		 $contenido.='</tr>';
		}
		//$contador=$contador+1;
	 }
	
	
		$strSQL_tot="select sum(total) as total,sum(percepcion) as percepcion, sum(items) as item, count(cod_cab) as cantidad, sum(b_imp) as base,sum(igv) as igv from cab_mov where tipo='$tipo' and flag!='A'   $tipdoc and cod_ope!='NC' and moneda='01' and substring(fecha,1,10) between '$fecha1' and '$fecha2' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$filtro6.$filtroPercep." order by cod_cab ";
		//echo $strSQL_tot;
		$resultado=mysql_query($strSQL_tot,$cn);
		$row_tot=mysql_fetch_array($resultado);
		
		$totgen_base1=number_format($row_tot['base'],2);
		$totgen_igv1=number_format($row_tot['igv'],2);
		$percepcionSoles=number_format($row_tot['percepcion'],2);
		$totgen_total1=number_format($row_tot['total']+$row_tot['percepcion'],2);
		
		
		
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
		
		
		
		
	$contenido.='<tr><td colspan="9">&nbsp;</td></tr>';
	$contenido.='<tr><td colspan="9">&nbsp;</td></tr>';
	$contenido.='<tr><td colspan="9">&nbsp;</td></tr>';
	
	if($tipo!="01"){
	$contenido.='<tr><td colspan="11">&nbsp;</td>';
	}else{
	$contenido.='<tr><td colspan="10">&nbsp;</td>';
	}
	
	
	$contenido.='<td align="right" class="simbolo_rojo">S/.</td>';
	$contenido.='<td align="lefth"><b>'.number_format($tot_otros,2).'</b></td>';
	$contenido.='</tr>';
	
	
	
	$contenido.='<tr><td colspan="12">&nbsp;</td></tr>';
	$contenido.='<tr><td colspan="12">&nbsp;</td></tr>';
	$contenido.='<tr><td colspan="12">&nbsp;</td></tr>';
	
	
	$contenido.='<tr>';
	$contenido.='<td colspan="8">&nbsp;</td>';
	$contenido.='<td align="right" class="simbolo_rojo">S/.</td>';
	$contenido.='<td align="lefth"><b>'.$totgen_base1.'</b></td>';
	$contenido.='<td align="lefth"><b>'.$totgen_igv1.'</b></td>';
	
	if($tipo!="01"){
	$contenido.='<td align="lefth"><b>'.$percepcionSoles.'</b></td>';
	}
	
	$contenido.='<td align="lefth"><b>'.$totgen_total1.'</b></td>';
	$contenido.='</tr>';
	
	
	$contenido.='<tr>';
	$contenido.='<td colspan="8">&nbsp;</td>';
	$contenido.='<td align="right" class="simbolo_rojo">US$/.</td>';
	$contenido.='<td align="lefth"><b>'.$totgen_base2.'</b></td>';
	$contenido.='<td align="lefth"><b>'.$totgen_igv2.'</b></td>';
	
	if($tipo!="01"){
	$contenido.='<td align="lefth"><b>'.$percepcionDolar.'</b></td>';
	}
	
	$contenido.='<td align="lefth"><b>'.$totgen_total2.'</b></td>';
	$contenido.='</tr>';
	
	
	$contenido.='<tr>';
	$contenido.='<td colspan="8">&nbsp;</td>';
	$contenido.='<td align="right" class="simbolo_rojo">S/.</td>';
	$contenido.='<td align="lefth"><b>0.00</b></td>';
	$contenido.='<td align="lefth"><b>0.00</b></td>';
	
	if($tipo!="01"){
	$contenido.='<td align="lefth"><b>0.00</b></td>';
	}
	
	$contenido.='<td align="lefth"><b>0.00</b></td>';
	$contenido.='</tr>';
	
	
	$contenido.='<tr>';
	$contenido.='<td colspan="8">&nbsp;</td>';
	$contenido.='<td align="right" class="simbolo_rojo">US$/.</td>';
	$contenido.='<td align="lefth"><b>0.00</b></td>';
	$contenido.='<td align="lefth"><b>0.00</b></td>';
	
	if($tipo!="01"){
	$contenido.='<td align="lefth"><b>0.00</b></td>';
	}
	
	$contenido.='<td align="lefth"><b>0.00</b></td>';
	$contenido.='</tr>';
	
	
	$contenido.='</table>';
	
	$html2pdf = new HTML2PDF('L', 'A4', 'fr', true, 'UTF-8', 3);
	$html2pdf->pdf->SetDisplayMode('fullpage');
	$html2pdf->writeHTML($contenido);
	$html2pdf->Output('reporte.pdf');
    }catch(HTML2PDF_exception $e){
	   echo $e;
        exit;
	}
	
?>	