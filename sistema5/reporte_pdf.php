<?php
session_start();
$_SESSION['nivel_usu']="5";
include('conex_inicial.php');
include('funciones.php');

$referencia=$_REQUEST["informacion_pdf"];

$strsql="select * from cab_mov where cod_cab='$referencia'";



$resultado=mysql_query($strsql,$cn);
$cont=mysql_num_rows($resultado);
$row=mysql_fetch_array($resultado);



$noperacion=$row['noperacion'];
$numero=$row['Num_doc'];
$serie=$row['serie'];
$flag=$row['flag'];
$tipoMov=$row['tipo'];

//echo $numero;
$ruc=$row['ruc'];
$cliente=$row['cliente'];
$fecha=$row['fecha'];
$cod_ope=$row['cod_ope'];
$codsucursal=$row['sucursal'];
$codtienda=$row['tienda'];
$cod_vendedor=$row['cod_vendedor'];
$tipo_cambio=$row['tc'];
$moneda=$row['moneda'];
$fecha_aud=$row['fecha_aud'];
$nom_pc=$row['pc'];
$inafecto=$row['inafecto'];
$incluidoigv=$row['incluidoigv'];
$b_imp=$row['b_imp'];
$igv=$row['igv'];
$impto=$row['impto1'];
$dirDestino=$row['dirDestino'];
$dirPartida=$row['dirPartida'];

$percepcion=$row['percepcion'];

$condicion=$row['condicion'];
$transportista=$row['transportista'];
$chofer=$row['chofer'];
////////////////////Solo garantias
$obser=$row['obs1'];
$tarea=$row['obs2'];
$flete=$row['flete'];
$puntos=$row['puntos'];

//documento Cod_pro por Cos_anexo
$Tip=$_REQUEST['Tip'];
////////////////////

if($inafecto=='S'){
	$texto_incl_igv=" DOC. INAFECTO ";
}else{

	if($incluidoigv=='S'){
	$texto_incl_igv=" INCLUIDO IGV";
	}else{
	$texto_incl_igv=" NO INCLUIDO IGV";
	}
}





if($moneda=='01'){
$des_mon="SOLES S/.";
$simbolo="S/.";
}else{
$des_mon="DOLARES US$.";
$simbolo="US$.";
}



$importe=$row['total'];

	$strSQL_clie="select *  from cliente where codcliente='".$cliente."'";
	$resultado_clie=mysql_query($strSQL_clie,$cn);
	$row_clie=mysql_fetch_array($resultado_clie);
	$razonsocial=$row_clie['razonsocial'];
	$ruc=$row_clie['ruc'];
	$direccion=$row_clie['direccion'];
	
//	echo $strSQL_clie;
	
	$strSQL_ope="select *  from operacion where codigo='".$cod_ope."' and tipo ='".$tipoMov."'";
	$resultado_ope=mysql_query($strSQL_ope,$cn);
	$row_ope=mysql_fetch_array($resultado_ope);
	$ticket=$row_ope['descripcion'];
	$permisoPuntos=substr($row_ope['p1'],27,1);	
	//echo "-->".$permisoPuntos;	
	
	$strSQL_emp="select des_suc from sucursal where cod_suc='".$codsucursal."'";
	$resultado_emp=mysql_query($strSQL_emp,$cn);
	$row_emp=mysql_fetch_array($resultado_emp);
	$dessuc=$row_emp['des_suc'];
		
	$strSQL_tien="select des_tienda from tienda where cod_tienda='".$codtienda."'";
	$resultado_tien=mysql_query($strSQL_tien,$cn);
	$row_tien=mysql_fetch_array($resultado_tien);
	$destienda=$row_tien['des_tienda'];
	
	$empresa=$dessuc." / ".$destienda;
	
	$strSQL_vend="select usuario from usuarios where codigo='".$cod_vendedor."'";
	$resultado_vend=mysql_query($strSQL_vend,$cn);
	$row_vend=mysql_fetch_array($resultado_vend);
	
	$responsable=$row_vend['usuario'];
	
	$afecha=explode('-',trim(substr($fecha,0,10)));
	$fecha=$afecha[2]."-".$afecha[1]."-".$afecha[0]." ".substr($fecha,11,18);

$strSQLCope="select * from costopexpresu where codpresup='".$referencia."'";
$resultadoCope=mysql_query($strSQLCope, $cn);
while($rowCope=mysql_fetch_array($resultadoCope)){
	
	if($moneda==$rowCope['moneda']){
	$totalCostos=$totalCostos+$rowCope['costoparcial'];
	}else{
		if($rowCope['moneda']=='01'){
		$totalCostos=$totalCostos+($rowCope['costoparcial']/$tipo_cambio);
		}else{
		$totalCostos=$totalCostos+($rowCope['costoparcial']*$tipo_cambio);
		}
	
	}
	
}

$strSQLCope="select * from activxpresu where codpresup='".$referencia."'";
$resultadoCope=mysql_query($strSQLCope, $cn);
while($rowCope=mysql_fetch_array($resultadoCope)){

	
	if($moneda==$rowCope['moneda']){
	$totalActxObra=$totalActxObra+$rowCope['costoparcial'];
	}else{
		if($rowCope['moneda']=='01'){
		$totalActxObra=$totalActxObra+($rowCope['costoparcial']/$tipo_cambio);
		}else{
		$totalActxObra=$totalActxObra+($rowCope['costoparcial']*$tipo_cambio);
		}
	
	}
	
	
}


 // convert to PDF
    require_once(dirname(__FILE__).'/exportar_pdf/html2pdf.class.php');
    try
    {
	
	  $contenido='<style>';
	  $contenido.='body{font-size: 12px;font-family:Arial, Helvetica, sans-serif;}';
	  $contenido.='.titulo_general{width:100%;height:auto;background-color:#003366;color:#FFFFFF;float:left;text-align:center;font-weight:bold;padding:7px 0;font-size:12px}';
	  $contenido.='.cuadro_detalle{width:98%;height:auto;border:#999999;margin-top:10px;margin-left:7px;padding:7px 5px}';
	  $contenido.='.cuadro_detalle2{width:98%;height:auto;margin-top:50px;margin-left:5px;}';
	  $contenido.='.cuadro_detalle3{width:98%;height:auto;margin-top:10px;margin-left:5px;}';
	  $contenido.='.cuadro_detalle4{width:96%;height:auto;margin-top:10px;margin-left:5px;border:#999999;margin-left:7px;padding:7px 5px}';
	  $contenido.='.desc{height:auto;margin-left:5px;float:left;width:160px;}'; 
	  $contenido.='.desc2{height:auto;margin-left:5px;float:left;width:350px;}';
	  $contenido.='.desc2_tc{height:auto;margin-left:5px;float:left;width:400px;}';
	  
	  $contenido.='.desc_cliente{height:auto;margin-left:5px;float:left;width:217px;}'; 
	  $contenido.='.desc_td{height:auto;margin-left:5px;float:left;width:252px;}'; 
	  $contenido.='.desc_d{height:auto;margin-left:5px;float:left;width:209px;}'; 
	  $contenido.='.desc_responsable{height:auto;margin-left:5px;float:left;width:186px;}'; 
	  $contenido.='.desc_trans{height:auto;margin-left:5px;float:left;width:184px;}'; 
	  $contenido.='.desc_referenciado{height:auto;margin-left:5px;float:left;width:320px;}'; 
	  
	  $contenido.='.rojo{color:#FF0000;width:auto;height:auto}';
	  $contenido.='.det{width:100%;height:auto;color:#000000;float:left;font-weight: bold;}';
	  $contenido.='.vacio{width:100%;height:3px;float:left;}';
	  $contenido.='b.abajo{float:left;margin-top:6px}';
	  $contenido.='b.afecto{float:left;margin-left:5px}';
	  $contenido.='.auditoria{width:100%;height:25px;float:left;}';
	  
	  $contenido.='</style>';
	
	$contenido.='<div class="titulo_general">';
	$contenido.=strtoupper($ticket);
	$contenido.='</div>';
	
	 if($flag=='A'){ 
	   $contenido.='<div style="width:100%;height:auto;text-align:center;color:#FF0000;">( Anulado )</div>';
	} 	
	
		$contenido.='<div class="cuadro_detalle">';
		
			$contenido.='<table width="auto" cellpadding="0" cellspacing="0">';
		    $contenido.='<tr>';
			$contenido.='<td width="300" height="17">';
			$contenido.='<b>';
			$contenido.='Empresa / Tienda:';
			$contenido.='</b>';
			$contenido.='<div class="desc">'.$empresa.'</div>';
			$contenido.='</td>';
			$contenido.='<td width="320" height="17">';
			$contenido.='<b>';
			$contenido.='Fecha:';
			$contenido.='</b>';
			$contenido.='<div class="desc2">'.$fecha.'</div>';
			$contenido.='</td>';
			$contenido.='</tr>';
			$contenido.='<tr>';
			$contenido.='<td width="300" height="17">';
			$contenido.='<b>';
			$contenido.='TD:';
			$contenido.='</b>';
			$contenido.='<div class="desc_td">'.$cod_ope." : ".$serie."-".$numero.'</div>';
			$contenido.='</td>';
			$contenido.='<td width="320" height="17">';
			$contenido.='<b>';
			$contenido.='Condicion:';
			$contenido.='</b>';
			
			list($nombreCondi)	=	mysql_fetch_array(mysql_query("select nombre from condicion where codigo='".$condicion."'"));
			
			$contenido.='<div class="desc2">'.$nombreCondi.'</div>';
			$contenido.='</td>';
			$contenido.='</tr>';
			 $contenido.='<tr>';
			$contenido.='<td width="300" height="17">';
			$contenido.='<b>';
			$contenido.='Se&ntilde;ores:';
			$contenido.='</b>';
				$contenido.='<div class="desc_cliente">'.$razonsocial.'</div>';
			$contenido.='</td>';
			$contenido.='<td width="320" height="17">';
			$contenido.='<b>';
			$contenido.='Ruc:';
			$contenido.='</b>';
			$contenido.='<div class="desc2">'.$ruc.'</div>';
			$contenido.='</td>';
			$contenido.='</tr>';
			$contenido.='<tr>';
			$contenido.='<td width="300" height="17">';
			$contenido.='<b>';
			$contenido.='Direcci&oacute;n:';
			$contenido.='</b>';
			
			if($tipoMov=='1'){
			$contenido.='<div class="desc_d">'.htmlspecialchars($dirPartida).'</div>';
		    }else{
			$contenido.='<div class="desc_d">'.caracteres($dirDestino).'</div>';
		    }
			$contenido.='</td>';
			$contenido.='<td width="320" height="17">';
			$contenido.='<b>';
			$contenido.='Tc.';
			$contenido.='</b>';
			$contenido.='<div class="desc2_tc">'.$tipo_cambio.'&nbsp;&nbsp;&nbsp; <b>Moneda:</b> '.$des_mon.'&nbsp;&nbsp;&nbsp; <b>Impuesto: </b> <div class="rojo">'.$texto_incl_igv.'</div></div>';
			$contenido.='</td>';
			$contenido.='</tr>';
			$contenido.='<tr>';
			$contenido.='<td width="300" height="17">';
			$contenido.='<b>';
			$contenido.='Responsable:';
			$contenido.='</b>';
			$contenido.='<div class="desc_responsable">'.$responsable.'</div>';
			$contenido.='</td>';

			//$referencia
			list($cod_cabRef)	=	mysql_fetch_array(mysql_query("select cod_cab_ref from referencia where cod_cab='".$referencia."'"));
			list($cod_cabRef,$serieRef,$numeroRef)	=	mysql_fetch_array(mysql_query("select cod_ope,serie,Num_doc from cab_mov where cod_cab='".$cod_cabRef."'"));
			//$referencia
			list($cod_cabRef2)	=	mysql_fetch_array(mysql_query("select cod_cab from referencia where cod_cab_ref='".$referencia."'"));
			list($cod_cabRef2,$serieRef2,$numeroRef2)	=	mysql_fetch_array(mysql_query("select cod_ope,serie,Num_doc from cab_mov where cod_cab='".$cod_cabRef2."'"));
			
			
			$contenido.='<td width="320" height="17">';
			$contenido.='<b>';
			$contenido.='Doc.Referencia:';
			$contenido.='</b>';
			$contenido.='<div class="desc_referenciado">'.$cod_cabRef." ".$serieRef." ".$numeroRef.'&nbsp;&nbsp;&nbsp; <b>Doc.Referenciado:</b> '.$cod_cabRef2." ".$serieRef2." ".$numeroRef2.'</div>';
			$contenido.='</td>';
			
			
			
			
			$contenido.='</tr>';
			$contenido.='<tr>';
			$contenido.='<td width="300" height="17">';
			$contenido.='<b>';
			$contenido.='Transportista:';
			$contenido.='</b>';	
			list($nombretransp)	=	mysql_fetch_array(mysql_query("select nombre from transportista where id='".$transportista."'"));
			$contenido.='<div class="desc_trans">'.$nombretransp.'</div>';
			$contenido.='</td>';
			$contenido.='<td width="320" height="17">';
			$contenido.='<b>';
			$contenido.='Chofer:';
			$contenido.='</b>';
			list($nombrechofer)	=	mysql_fetch_array(mysql_query("select nombre from chofer where cod='".$chofer."'"));
			$contenido.='<div class="desc2">'.$nombrechofer.'</div>';
			$contenido.='</td>';
			$contenido.='</tr>';
			$contenido.='</table>';
			$contenido.='</div>';
			$contenido.='<div class="cuadro_detalle2">';
			$contenido.='<div class="det">Detalle :</div>';
			$contenido.='<div class="vacio"></div>';
			$contenido.='<table cellspacing="0" cellpadding="0" border="0" width="auto">';
			$contenido.='<tr>';
			$contenido.='<th width="10" align="center" bgcolor="#DADADA"><b class="abajo">Cod</b></th>';
			$contenido.='<th width="250" align="center" bgcolor="#DADADA"><b class="abajo">Producto</b></th>';
			$contenido.='<th width="40" align="center" bgcolor="#DADADA"><b class="abajo">Und.</b></th>';
			$contenido.='<th width="80" align="center" bgcolor="#DADADA"><b>Factor Conv.</b></th>';
			$contenido.='<th width="50" align="center" bgcolor="#DADADA"><b class="abajo">Cant.</b></th>';
			$contenido.='<th width="40" align="center" bgcolor="#DADADA"><b class="abajo">P.Unit</b></th>';
			$contenido.='<th width="65" align="center" bgcolor="#DADADA"><b>Desc. 1 (%)</b></th>';
			$contenido.='<th width="65" align="center" bgcolor="#DADADA"><b>Desc. 2 (%)</b></th>';
			$contenido.='<th width="70" align="center" bgcolor="#DADADA"><b class="abajo">Total</b></th>';
			$contenido.='</tr>';
			
			$strSQL4="select cantidad,cod_prod,nom_prod,precio,unidad,codanex, desc1, desc2, imp_item  from det_mov where cod_cab='".$referencia."' order by cod_det";
			$resultado4=mysql_query($strSQL4,$cn);
			// echo $strSQL4;
			$nitems=0;
			while($row4=mysql_fetch_array($resultado4)){
			$nitems=$nitems+1;
			
			$strSQL40="select * from producto where idproducto='".$row4['cod_prod']."'";
			$resultado40=mysql_query($strSQL40,$cn);
			$row40=mysql_fetch_array($resultado40);
			
			$total=$row4['precio']*$row4['cantidad'];
			//echo $row40['agente_percep']; 
			if($row40['agente_percep']=='S'){
			$marcador="(*) ";
			}else{
			$marcador="";
			}
			
			$contenido.='<tr>';
			if ($Tip==2){
			$contenido.='<td valign="top">'.substr($row4['codanex'],0,50).'</td>';
		    }else{
			$contenido.='<td valign="top"">'.substr($row4['cod_prod'],0,50).'</td>';
		    }
			$contenido.='<td valign="top" width="250" align="center">'.$marcador.utf8_encode(substr($row4['nom_prod'],0,100));
			
			$sqlx="SELECT serie from series WHERE producto='".$row4['cod_prod']."' and tienda='".$codtienda."' and (ingreso ='".$referencia."' or salida='".$referencia."')";
	//echo $sqlx;
	$seriesx="";
	  $resultadox=mysql_query($sqlx,$cn);
	  if(mysql_num_rows($resultadox)){
	  $c=0;
		  while($rowx=mysql_fetch_array($resultadox)){
		  $d=1;
		  //$f=4*$d;
			  if($c%4==0){
			  $seriesx=$seriesx."<br>"; 
			  $d++;
			  }
		  $seriesx=$seriesx.$rowx['serie'].",&nbsp;&nbsp;";	
		  $c++;  
		  }
			$contenido.='Series::'.$seriesx; 
			}
			$contenido.='</td>';
			
			$strUND="select * from unidades  where id='".$row4['unidad']."'";
			$resultadoUND=mysql_query($strUND,$cn);
			$rowUND=mysql_fetch_array($resultadoUND);
		
			$contenido.='<td valign="top" align="center">'.$rowUND['nombre'].'</td>';
			
			
			$strUND="select * from unixprod where unidad='".$row4['unidad']."' and producto='".$row4['cod_prod']."'";
		$resultadoUND=mysql_query($strUND,$cn);
		$rowUND=mysql_fetch_array($resultadoUND);
		
		 $contenido.='<td valign="top" align="center">'.$rowUND['factor'].'</td>';
			
	     $contenido.='<td valign="top" align="center">'.$row4['cantidad'].'</td>';		
			
		  if ($_SESSION['nivel_usu']==2){
        	$contenido.='<td width="80" align="center">***</td>';
	      }else{
	       $contenido.='<td width="80" align="center">'.number_format($row4['precio'],2).'</td>';
	      }	
		
			$valventa=$valventa+($row4['cantidad']*$row4['precio']);
			
			$totalitem=$row4['cantidad'] * $row4['precio'] ;
			
			$tempDesc1=$totalitem*($row4['desc1']/100);
			$tempDesc2=($totalitem-$tempDesc1)*($row4['desc2']/100);
			
			$descTotal=$descTotal+($tempDesc1+$tempDesc2);	
			
			$contenido.='<td  align="center" valign="top">'.number_format($row4['desc1'],2).'</td>';
			
			$contenido.='<td  align="center" valign="top">'.number_format($row4['desc2'],2).'</td>';
				
			if ($_SESSION['nivel_usu']==2){
			$contenido.='<td width="10" align="center" valign="top">***</td>';
		    }else{
		    $contenido.='<td width="50" align="center" valign="top">'.number_format($row4['imp_item'],2).'</td>';
		    }
		
			$contenido.='</tr>';
			}
			
			
			
			if($inafecto=='N'){
			    $contenido.='<tr>';
				$contenido.='<td colspan="7" align="right">&nbsp;</td>';
				$contenido.='</tr>';
			
				$contenido.='<tr>';
				$contenido.='<td height="21">&nbsp;</td>';
				$contenido.='<td colspan="7" align="right"><b>Valor Venta</b></td>';
				if ($_SESSION['nivel_usu']==2){
		         $contenido.='<td align="right">***</td>';
		        }else{
		         $contenido.='<td align="right">'.number_format($valventa,2).'</td>';
		        }
				$contenido.='</tr>';
				$contenido.='<tr>';
				$contenido.='<td height="21">&nbsp;</td>';
				$contenido.='<td colspan="7" align="right"><b>Total Descuento</b></td>';
				if ($_SESSION['nivel_usu']==2){
		          $contenido.='<td align="right">***</td>';
		        }else{
				  $contenido.='<td align="right">'.number_format($descTotal,2).'</td>';
		        }
				$contenido.='</tr>';
				
				$contenido.='<tr>';
				$contenido.='<td height="21">&nbsp;</td>';
				$contenido.='<td colspan="7" align="right"><b>Flete</b></td>';
				if ($_SESSION['nivel_usu']==2){
		          $contenido.='<td align="right">***</td>';
		        }else{
				  $contenido.='<td align="right">'.number_format($flete,2).'</td>';
		        }
				$contenido.='</tr>';
				
				
				$contenido.='<tr>';
				$contenido.='<td height="21">&nbsp;</td>';
				$contenido.='<td colspan="7" align="right"><b>Base Imponible</b></td>';
				if ($_SESSION['nivel_usu']==2){
		          $contenido.='<td align="right">***</td>';
		        }else{
				  $contenido.='<td align="right">'.$b_imp.'</td>';
		        }
				$contenido.='</tr>';
				
				
				$contenido.='<tr>';
				$contenido.='<td height="21">&nbsp;</td>';
				$contenido.='<td colspan="7" align="right"><b>Impuesto('.$impto.')%</b></td>';
				if ($_SESSION['nivel_usu']==2){
		          $contenido.='<td align="right">***</td>';
		        }else{
				  $contenido.='<td align="right">'.$igv.'</td>';
		        }
				$contenido.='</tr>';
				
				$contenido.='<tr>';
				$contenido.='<td height="21">&nbsp;</td>';
				$contenido.='<td colspan="7" align="right"><b>Percepci&oacute;n</b></td>';
				if ($_SESSION['nivel_usu']==2){
		          $contenido.='<td align="right">***</td>';
		        }else{
				  $contenido.='<td align="right">'.number_format($percepcion,2).'</td>';
		        }
				$contenido.='</tr>';	
			}
			
			$contenido.='<tr>';
			$contenido.='<td height="21">&nbsp;</td>';
			$contenido.='<td colspan="7" align="right"><b>Total Documento'.$simbolo.'</b></td>';
			if ($_SESSION['nivel_usu']==2){
			$contenido.='<td align="right">***</td>';
			}else{
			$contenido.='<td align="right">'.number_format($importe+$percepcion,2).'</td>';
			}
			$contenido.='</tr>';
			
			/*$contenido.='<tr>';
			$contenido.='<td height="21" colspan="8"><table width="auto" height="29" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="35"><table width="32" height="12" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td bgcolor="#ABF3EC" width="30" height="10"></td>
              </tr>
            </table></td>
            <td width="auto">Afecto a Percepcion</td>
          </tr>
        </table>          
          </td>
        <td align="right">&nbsp;</td>';
		$contenido.='</tr>';
		
		$contenido.='<tr>';
		$contenido.='<td height="22">Descripcion&nbsp;</td>';
		$contenido.='<td colspan="5" align="left">'.$tarea.'</td>';
		$contenido.='<td align="right">&nbsp;</td>';
		$contenido.='</tr>';*/
			
			
			
			
			$contenido.='</table>';
			$contenido.='</div>';
			
			$contenido.='<div class="cuadro_detalle3">';
			$contenido.='<table width="auto" height="8" border="0" cellspacing="0" cellpadding="0">';
			$contenido.='<tr>';
			$contenido.='<td width="400" height="10">(*) Afecto a Percepcion</td>';
			$contenido.='</tr>';
			
			$contenido.='<tr>';
			$contenido.='<td>&nbsp;</td>';
			$contenido.='</tr>';
			
			$contenido.='<tr>';
			$contenido.='<td height="22"><b>Descripcion&nbsp;</b></td>';
			$contenido.='<td colspan="5" align="left">'.$tarea.'</td>';
			$contenido.='<td align="right">&nbsp;</td>';
			$contenido.='</tr>';
			
			
			$contenido.='<tr>';
			$contenido.='<td>&nbsp;</td>';
			$contenido.='</tr>';
			
			$contenido.='<tr>';
			$contenido.='<td height="22"><b>Obs.&nbsp;</b></td>';
			$contenido.='<td colspan="5" align="left">'.$obser.'</td>';
			$contenido.='<td align="right">&nbsp;</td>';
			$contenido.='</tr>';
			 
			 
			if($permisoPuntos=='S'){
				$contenido.='<tr>';
				$contenido.='<td>&nbsp;</td>';
				$contenido.='</tr>';
				
				$contenido.='<tr>';
				$contenido.='<td height="22"><b>Puntos</b></td>';
				$contenido.='<td colspan="5" align="left">'.$puntos.'</td>';
				$contenido.='<td align="right">&nbsp;</td>';
				$contenido.='</tr>';
			}
			
			$contenido.='</table>';
			$contenido.='</div>';
			
			
			$contenido.='<div class="cuadro_detalle4">';
			$contenido.='<div class="auditoria">Auditoria</div>';
			
			$contenido.='<table width="auto" cellpadding="0" cellspacing="0">';
			$contenido.='<tr>';
			$contenido.='<td width="300" height="17">';
			$contenido.='<b>';
			$contenido.='Fecha de Creaci&oacute;n :';
			$contenido.='</b>';
			$contenido.='<div class="desc">'.$fecha_aud.'</div>';
			$contenido.='</td>';
			$contenido.='<td width="320" height="17">';
			$contenido.='<b>';
			$contenido.='Nombre PC:</b><br>'.$nom_pc;
			$contenido.='</td>';
			$contenido.='</tr>';
			$contenido.='</table>';
			$contenido.='</div>';
	
		
	$html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 3);
	//$html2pdf->pdf->SetDisplayMode('fullpage');
	$html2pdf->writeHTML($contenido);
	$html2pdf->Output('reporte.pdf');
	
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }


?>