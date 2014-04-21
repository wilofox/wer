<?php 
//session_start();
if(isset($_REQUEST['excel'])){
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=excel.xls");
$visible=" style='visibility:hidden' ";


	$tipo=$_REQUEST['tipo'];
	if($_REQUEST['agdoc']=='v_normal'){
	$subtitulo=" Vista normal";
	}elseif($_REQUEST['agdoc']=='ag_dia'){
	$subtitulo=" Agrupado por Dia";
	}else{
		$subtitulo=" Agrupado por Documento";
	}
	if($tipo=='1'){
	echo "<table><tr><td colspan='10' height='100px' valign='middle' align='center' style='font-size:18px;font:bold' >Relacion de Documentos Compras / Ingresos<br/>(".$subtitulo.")</td></tr></table>";
	}else{
	echo "<table><tr><td colspan='10' height='100px' valign='middle' align='center' style='font-size:18px;font:bold' >Relacion de Documentos Salidas / Ventas <br/>(".$subtitulo.")</td></tr></table>";
	}

}else{
session_start();
}

$k=0;

if($_SESSION['nivel_usu']!='4' && $_SESSION['nivel_usu']!='5'){
	$disabled_audita=" disabled ";
}
?>


<style type="text/css">
<!--
.Estilo10 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo15 {color: #FFFFFF}
.Estilo33 {color: #000066}
.Estilo34 {color: #003399}
.Estilo35 {font-size: 11px}
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.anulado {text-decoration:line-through;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#990000; }
.Estilo38 {color: #FF6B24}
-->
</style>
<!--<table  width="1352" border="0" cellpadding="1" cellspacing="1" >-->
<table  width="1824" height="328" border="0" cellpadding="1" cellspacing="1" >
  <tr style="background:url(imagenes/bg_contentbase2.gif);  background-position:100% 40%;">
  <?php // if(!isset($_REQUEST['excel'])){?>
    <td width="46">&nbsp;</td>
		<?php //}?>
	<?php  if(!isset($_REQUEST['excel'])){?><td colspan="3"  align="center" ><strong class="Estilo10 Estilo15">Estados</strong></td>
	<?php }?>
    <td width="128"  height="18" align="center" ><span class="Estilo7 Estilo15 Estilo35"><strong>Fecha Canc. </strong></span></td>
    <td width="37" ><span class="Estilo7 Estilo15 Estilo35"><strong>Doc.</strong></span></td>
    <td width="102" align="left" ><span class="Estilo7 Estilo15 Estilo35"><strong>Nro. Documento </strong></span></td>
	  <td width="66" align="center"><span class="Estilo7 Estilo15 Estilo35"><strong>RUC</strong></span></td>
	    <td width="257" align="center"><span class="Estilo7 Estilo15 Estilo35"><strong>Razon Social</strong></span></td>
        <td width="99" align="center"><strong><span class="Estilo7 Estilo15 Estilo35">Doc. Referencia </span></strong></td>
        <td width="116" align="center"><strong><span class="Estilo7 Estilo15 Estilo35">Doc. Referenciado</span></strong></td>
        <td width="164" align="center"><span class="Estilo7 Estilo15 Estilo35"><strong>Condicion</strong></span></td>
        <!--<td width="126" align="left" ><span class="Estilo7 Estilo15 Estilo35"><strong>Doc. Referencia </strong></span></td>
        <td width="126" align="left" ><span class="Estilo7 Estilo15 Estilo35"><strong>Doc. Referenciado </strong></span></td>-->
    <td width="47" align="center"><span class="Estilo7 Estilo15 Estilo35"><strong>Items</strong></span></td>
    <td width="57" align="center"><span class="Estilo7 Estilo15 Estilo35"><strong>Moneda</strong></span></td>
    <td width="85" align="center" ><span class="Estilo7 Estilo15 Estilo35"><strong>Importe</strong></span></td>
    <td width="57" align="center" ><span class="Estilo7 Estilo15 Estilo35"><strong>IGV</strong></span></td>
    <td width="80" align="center" ><span class="Estilo7 Estilo15 Estilo35"><strong>Percepci&oacute;n</strong></span></td>
    <td width="75" align="center" ><span class="Estilo7 Estilo15 Estilo35"><strong>Total</strong></span></td>
    <td width="124" align="center" ><span class="Estilo7 Estilo15 Estilo35"><strong>Responable</strong></span></td>
    <td width="108" align="center" ><span class="Estilo7 Estilo15 Estilo35"><strong>Provincia</strong></span></td>
    <td width="47" align="center" ><span class="Estilo7 Estilo15 Estilo35"><strong>Kardex</strong></span></td>
  </tr>
  <?php 
		    include('conex_inicial.php');
			include ('funciones/funciones.php');
			//-------------------------------------------
			
			
					   $registros = 40; 
					   $pagina = $_REQUEST['pagina']; 
					   
					   
			//	echo "pag".$pagina;
		
				if ($pagina=='') { 
				$inicio = 0; 
				$pagina = 1; 

				} else { 
				$inicio = ($pagina - 1) * $registros; 
				} 
			
  			
				$fecha1=formatofecha($_REQUEST['fecha']);
				$fecha2=formatofecha($_REQUEST['fecha2']);
		
			
			$fecha3=$_REQUEST['fecha3'];
			$sucursal=$_REQUEST['sucursal'];
			$tienda=$_REQUEST['almacen'];
			$tipo=$_REQUEST['tipo'];
			$cliente=$_REQUEST['cliente'];
			///////////////////////////////
			$tzona=$_REQUEST['tzona'];
			///////////////////////////////
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
			$filtro6=" and cm.cliente='$cliente' ";
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
	//if( !empty( $rowtemp['documentos'] ) ){ 
	if( trim( $rowtemp['documentos'] )!="" ){ 
	$filtro56 = " ".$rowtemp['documentos'];	
	$tipdoc="and cod_ope in (".$filtro56.")";
	}

	if($_REQUEST['agdoc']=='v_normal'){
	$order=" order by LEFT(fecha,10),cod_ope,CONCAT(serie,Num_doc) ";
	}elseif($_REQUEST['agdoc']=='ag_dia'){
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
	$zonax="";
	if($tzona!="T" && $tzona!=""){
		$zonax="and cl.zona='".$tzona."' ";
	}
		$filtro1=$zonax.$filtro1;		
			$strSQL="select cm.* from cab_mov cm inner join cliente cl on cl.codcliente=cm.cliente where cm.tipo='$tipo' $tipdoc and substring($ffecha,1,10) between '$fecha1' and '$fecha2' $filtroSerNum ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$filtro6.$filtro7.$filtroPercep.$filtroRef.$filtroSoloanul.$order;
			
	
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
			
			$audita=$row['audita'];
			$kardexDoc=$row['kardex'];
			
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
			$clix=mysql_fetch_array(mysql_query("select ruc,razonsocial,tipo_aux from cliente where codcliente='".$cliente."'"));
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
			$prev_sub=mostrar_sub_total($td,substr($fecha,0,10),$tipo,$filtro1,$filtro2,$filtro3,$filtro56,$filtro5,$filtro6,$order,'');
			}
				
			if($td!=$td_prev && $cont>0 && substr($fecha,0,10)==$fec_prev){
			
				//echo "doc".$td;
			echo $prev_sub;
			echo"<tr><td colspan='5'>&nbsp;&nbsp;&nbsp;Documento:".$td."</td></tr>";
$prev_sub=mostrar_sub_total($td,substr($fecha,0,10),$tipo,$filtro1,$filtro2,$filtro3,$filtro56,$filtro5,$filtro6,$order,'');

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
					$prev_sub=mostrar_sub_total($td,substr($fecha,0,10),$tipo,$filtro1,$filtro2,$filtro3,$filtro56,$filtro5,$filtro6,$order,'');
			}
			
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

			//}
			if($td=="NC"){
			$importe=$importe*(-1);
			$igv=$igv*(-1);
			$total=$total*-1;
			$items=$items*-1;
			}
			?>
  <tr bgcolor="#F9F9F9" onClick="entrada(this)"  >

    <td align="center"   >
	<?php if(!isset($_REQUEST['excel'])){?>
	<img style="cursor:pointer" alt="" onClick="doc_det('<?php echo $referencia;?>')" src="imagenes/ico_lupa.png" width="15" height="15">
	<?php }?>	</td>
	
	<?php  if(!isset($_REQUEST['excel'])){?>
    <td width="20" align="center" ><img <?php echo $disabled_audita; ?> style="cursor:pointer" src="imagenes/porrevisar.png" width="20" height="21" alt=" Por revisar " onclick="audita('0','<?php echo $referencia;?>')" /></td>
	<?php } ?>
	
	<?php  if(!isset($_REQUEST['excel'])){?>
    <td width="24" align="center" ><img <?php echo $disabled_audita; ?> style="cursor:pointer" src="imagenes/revisado.png" width="20" height="21" alt=" Revisado " onclick="audita('1','<?php echo $referencia;?>')" /></td>
	<?php } ?>
	
	<?php  if(!isset($_REQUEST['excel'])){?>
    <td width="22" align="center" ><img <?php echo $disabled_audita; ?> style="cursor:pointer" src="imgenes/AdminFeatures.gif" width="16" height="16" alt=" Observado " onclick="audita('2','<?php echo $referencia;?>')" /></td>
	<?php } ?>
	
    <td align="center" style="color:<?php echo $color_texto?>" ><span class="Estilo10"><?php echo extraefecha4($fecha)?></span></td>
    <td style="color:<?php echo $color_texto?>"><span class="Estilo10"><?php echo $td?></span></td>
    <td style="color:<?php echo $color_texto?>"><span class="Estilo10">
      <label for="select"><?php echo $documento?></label>
    </span></td>
	    <td style="color:<?php echo $color_texto?>" align="center"><span class="Estilo10"><?php echo $clix['ruc'] ?></span></td>
	<td style="color:<?php echo $color_texto?>" align="center"><span class="Estilo10"><?php 
	/*if ($tipoaux=='C'){
		echo 'Cliente - ';
	}else if ($tipoaux=='P'){
		echo 'Proveedor - ';
	}else if ($tipoaux=='A'){
		echo 'Cliente-Proveedor - ';
	}*/
	echo caracteres2($razonsocial);//utf8_encode($razonsocial) /*echo caracteres($razonsocial)*/ ?></span></td>
    <td style="color:<?php echo $color_texto?>" align="center">
	<?php 
		
		//$referencia
		list($cod_cabRef)	=	mysql_fetch_array(mysql_query("select cod_cab_ref from referencia where cod_cab='".$referencia."'"));
		
		
		list($cod_cabRef,$serieRef,$numeroRef)	=	mysql_fetch_array(mysql_query("select cod_ope,serie,Num_doc from cab_mov where cod_cab='".$cod_cabRef."'"));
		
		echo $cod_cabRef." ".$serieRef." ".$numeroRef;
		?>	</td>
    <td align="center" style="color:<?php echo $color_texto?>">&nbsp;</td>
    <td style="color:<?php echo $color_texto?>" align="center" ><span class="Estilo10"><?php echo caracteres($descrip_cond);?></span></td>
    <!--<td ><span class="Estilo10">
	<label for="select"><?php 
	//if(substr($row['flag_r'],1,2)=="RA"){
//		$sql="select * from referencia where cod_cab_ref='".$row['cod_cab']."'";
//	}
//	echo $documento?></label>
    </span></td>
    <td ><span class="Estilo10">
      <label for="select"><?php //echo $documento?></label>
    </span></td>-->
    <td style="color:<?php echo $color_texto?>" align="center" ><span class="Estilo10"><?php echo $items?></span></td>
    <td style="color:<?php echo $color_texto?>" align="center"><span class="Estilo10"><?php echo $moneda?></span></td>
    <td style="color:<?php echo $color_texto?>" align="right" ><span class="Estilo10"><?php echo number_format($importe,2)?></span></td>
    <td style="color:<?php echo $color_texto?>" align="right" ><span class="Estilo10"><?php echo number_format($igv,2)?></span></td>
    <td style="color:<?php echo $color_texto?>" align="right" ><?php echo number_format($imp_percepcion,2) ?></td>
    <td style="color:<?php echo $color_texto?>" align="right" ><span class="Estilo10"><?php echo number_format($total+$imp_percepcion,2)?></span></td>
    <td style="color:<?php echo $color_texto?>" align="right" ><?php echo $descrip_usua;?></td>
    <td style="color:<?php echo $color_texto?>" align="right" ><?php echo $descrip_prov;?></td>
    <td style="color:<?php echo $color_texto?>" align="right" ><?php echo $kardexDoc;?></td>
  </tr>
  <?php 

 
			
		}else{
			$cant_tanu=$cant_tanu+1;
			$total_tanu=$total_tanu+$total;
			/*if($_REQUEST['agdoc']!='false'){
			if(substr($fecha,0,10)!=$fec_prev){
			echo"<tr><td colspan='5'>fecha:".substr($fecha,0,10)."</td></tr>";
			}
			if($td!=$td_prev ){
			echo"<tr><td colspan='5'>&nbsp;&nbsp;&nbsp;Documento:".$td."</td></tr>";
			}elseif(substr($fecha,0,10)!=$fec_prev){
			echo"<tr><td colspan='5'>&nbsp;&nbsp;&nbsp;Documento:".$td."</td></tr>";
			}
			}*/
			?>
  <tr bgcolor="#F9F9F9" onClick="entrada(this)">
 
    <td align="center" >
	 <?php if(!isset($_REQUEST['excel'])){?>
	<img style="cursor:pointer" onClick="doc_det('<?php echo $referencia;?>')" src="imagenes/ico_lupa.jpg" width="15" height="15">
	<?php } ?>	</td>
	<?php  if(!isset($_REQUEST['excel'])){?>
    <td colspan="3" align="center" >&nbsp;</td>
	<?php } ?>
    <td align="center" ><span class="anulado"><?php echo extraefecha4($fecha)?></span></td>
    <td ><span class="anulado"><?php echo $td?></span></td>
    <td ><span class="anulado">
      <label for="select"><?php echo $documento?></label>
    </span></td>
		    <td align="center"><span class="Estilo10"><?php echo $clix['ruc'] ?></span></td>
	<td align="center"><span class="Estilo10"><?php echo caracteres2($razonsocial) ?></span></td>
	<td align="center">&nbsp;</td>
	<td align="center">&nbsp;</td>
	<td align="center" colspan="10"><span class="Estilo10" style="letter-spacing:50px">ANULADO</span></td>
    <!--<td align="center" ><span class="anulado"><?php //echo $items?></span></td>
    <td align="center" ><span class="anulado"><?php //echo $moneda?></span></td>
    <td align="right" ><span class="anulado"><?php //echo $importe?></span></td>
    <td align="right" ><span class="anulado"><?php //echo $igv?></span></td>
    <td align="right" ><span class="anulado"><?php //echo number_format($total,2)?></span></td>
    <td align="center" ><span class="anulado"><?php //echo $noperacion?></span></td>-->
  </tr>
  <?php 
		}
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
			
				if($_REQUEST['agdoc']=='ag_dia' ){
				if(substr($fecha,0,10)!=$fec_prev ){
				
				$fec_prev=substr($fecha,0,10);
				//echo $fec_prev."<br/>";
				
				}
				if($td!=$td_prev){
				$td_prev=$td;
				}
				}
				if($_REQUEST['agdoc']=='ag_doc' ){
				if($td!=$td_prev){
				$td_prev=$td;
				}
				}
				$cont++;
			
		}
			
			?>
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
	<?php  if(!isset($_REQUEST['excel'])){?>
    <td colspan="3" bgcolor="#F9F9F9">&nbsp;</td>
	<?php } ?>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td colspan="4" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
	 <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
  <?php 
  
  //echo ">>>>>>";
  
  $ffecha="cm.fecha";
	if($fecha3!=''){		
		if($fecha3=='fecharegis')$ffecha="cm.fecharegis";		
	}
  
  
    		if($tipo=='2' && $_REQUEST['agdoc']=='v_normal'){
		
		
	     	
			$strSQL="select sum(cm.total) as total,count(cm.cod_cab) as cantidad from cab_mov cm inner join cliente cl on cl.codcliente=cm.cliente where cm.tipo='$tipo' and cm.flag!='A' and substring($ffecha,1,10) between '$fecha1' and '$fecha2' ".$filtro1.$filtro2.$filtro3." and cm.cod_ope='TB' ".$filtro5.$filtro6." order by cm.cod_cab ";
			$resultado=mysql_query($strSQL,$cn);
			$row=mysql_fetch_array($resultado);
			$cant_tb=$row['cantidad'];
			$total_tb=$row['total'];
			
			//	echo $strSQL;
			
			$strSQL="select sum(cm.total) as total,count(cm.cod_cab) as cantidad from cab_mov cm inner join cliente cl on cl.codcliente=cm.cliente where cm.tipo='$tipo' and cm.flag!='A' and substring($ffecha,1,10) between '$fecha1' and '$fecha2' ".$filtro1.$filtro2.$filtro3." and cm.cod_ope='TF' ".$filtro5.$filtro6." order by cm.cod_cab ";
			$resultado=mysql_query($strSQL,$cn);
			$row=mysql_fetch_array($resultado);
			$cant_tf=$row['cantidad'];
			$total_tf=$row['total'];

  ?>
  <tr style="display:none">
    <td bgcolor="#F9F9F9" >&nbsp;</td>
	<?php  if(!isset($_REQUEST['excel'])){?>
    <td colspan="3" bgcolor="#F9F9F9">&nbsp;</td>
	<?php } ?>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td colspan="5" bgcolor="#F9F9F9"><strong>Total Ticket Boleta&nbsp;&nbsp; (<?php echo $cant_tb; ?>) <span style="color:<?php echo $color_texto?>">
      <?php 
		
		//$referencia
		list($cod_cabRef)	=	mysql_fetch_array(mysql_query("select cod_cab from referencia where cod_cab_ref='".$referencia."'"));
		
		
		list($cod_cabRef,$serieRef,$numeroRef)	=	mysql_fetch_array(mysql_query("select cod_ope,serie,Num_doc from cab_mov where cod_cab='".$cod_cabRef."'"));
		
		echo $cod_cabRef." ".$serieRef." ".$numeroRef;
		
		?>
    </span></strong></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
	 <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">S/.</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9"><strong><?php echo number_format($total_tb,2); ?></strong></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
  <tr style="display:none">
    <td bgcolor="#F9F9F9" >&nbsp;</td>
    <?php  if(!isset($_REQUEST['excel'])){?>
    <td colspan="3" bgcolor="#F9F9F9">&nbsp;</td>
	<?php } ?>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td colspan="5" bgcolor="#F9F9F9"><strong>Total Ticket factura&nbsp;&nbsp; (<?php echo $cant_tf; ?>) </strong></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
	 <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">S/.</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9"><strong><?php echo number_format($total_tf,2); ?></strong></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <?php  if(!isset($_REQUEST['excel'])){?>
    <td colspan="3" bgcolor="#F9F9F9">&nbsp;</td>
	<?php } ?>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td colspan="5" bgcolor="#F9F9F9"><strong> Docs. Anulados&nbsp; (<?php echo $cant_tanu; ?>) </strong></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
	 <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">S/.</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <?php  if(!isset($_REQUEST['excel'])){?>
    <td colspan="3" bgcolor="#F9F9F9">&nbsp;</td>
	<?php } ?>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td colspan="5" bgcolor="#F9F9F9"><strong>Total P&aacute;gina  &nbsp; (<?php echo $cant_otros; ?>) </strong></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
	 <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">S/.</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9"><strong><?php echo number_format($tot_otros,2); ?></strong></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
  <?php }
  if($_REQUEST['agdoc']=='ag_dia' ){

$strSQL="select count(cm.cod_cab) as cantidad from cab_mov cm inner join cliente cl on cl.codcliente=cm.cliente where cm.tipo='$tipo' and cm.flag!='A' and substring($ffecha,1,10) = '$fec_prev' ".$filtro1.$filtro2.$filtro3." and cm.cod_ope='$td_prev' ".$filtro5.$filtro6." order by cm.cod_cab ";
list($t_reg)=mysql_fetch_row(mysql_query($strSQL));
if($cont==$t_reg) echo mostrar_sub_total($td_prev,$fec_prev,$tipo,$filtro1,$filtro2,$filtro3,$filtro56,$filtro5,$filtro6,$order,'');
  }
  if($_REQUEST['agdoc']=='ag_doc'){

$strSQL="select count(cm.cod_cab) as cantidad from cab_mov cm inner join cliente cl on cl.codcliente=cm.cliente where cm.tipo='$tipo' and cm.flag!='A' and substring($ffecha,1,10) between '".$fecha1."' and '".$fecha2."' ".$filtro1.$filtro2.$filtro3." and cm.cod_ope='$td_prev' ".$filtro5.$filtro6." order by cm.cod_cab ";
list($t_reg)=mysql_fetch_row(mysql_query($strSQL));
//echo $strSQL."<br>";
//echo $cont."---".$t_reg."<br>"; 
//if($cont==$t_reg) {echo mostrar_sub_total($td_prev,$fec_prev);}
  }

  if(($total_paginas==$pagina  || isset($_REQUEST['excel'])) && $k==0){
  //echo "------->";
  $k=1;
  echo mostrar_sub_total($td_prev,$fec_prev,$tipo,$filtro1,$filtro2,$filtro3,$filtro56,$filtro5,$filtro6,$order,'');
?>
  <tr>
    <td height="21" colspan="21" bgcolor="#F9F9F9">--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
  </tr>
  <?php 
  /*
   $strSQL_tot="select sum(total) as total, sum(items) as item, count(cod_cab) as cantidad, sum(b_imp) as base,sum(igv) as igv from cab_mov where tipo='".$GLOBALS['tipo']."' and flag!='A'   and moneda='01' and substring(fecha,1,10) = '".$fec."' ".$GLOBALS['filtro1'].$GLOBALS['filtro2'].$GLOBALS['filtro3'].$GLOBALS['filtro4'].$GLOBALS['filtro5'].$GLOBALS['filtro6']." and cod_ope='".$tip_doc."' ".$GLOBALS['order'];
 */
 
 /*$strSQL="select * from cab_mov where tipo='$tipo' $tipdoc and substring(fecha,1,10) between '$fecha1' and '$fecha2' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$filtro6.$order;*/
 
 	$filtroPercep=" ";
	if($percepcion == 'S'){
	$filtroPercep = " and percepcion >0 ";
	}
 
  $strSQL_tot="select sum(cm.total) as total,sum(cm.percepcion) as percepcion, sum(cm.items) as item, count(cm.cod_cab) as cantidad, sum(cm.b_imp) as base,sum(cm.igv) as igv from cab_mov cm inner join cliente cl on cl.codcliente=cm.cliente where cm.tipo='$tipo' and cm.flag!='A' $tipdoc and cm.cod_ope!='NC' and cm.moneda='01' and substring($ffecha,1,10) between '$fecha1' and '$fecha2' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$filtro6.$filtroPercep." order by cm.cod_cab ";
  //echo $strSQL_tot;
  $resultado=mysql_query($strSQL_tot,$cn);
  $row_tot=mysql_fetch_array($resultado);
  
  $totgen_cant1=$row_tot['cantidad'];
  $totgen_item1=number_format($row_tot['item'],2);
  $totgen_base1=number_format($row_tot['base'],2);
  $totgen_igv1=number_format($row_tot['igv'],2);
  $totgen_total1=number_format($row_tot['total']+$row_tot['percepcion'],2);
  $percepcionSoles=number_format($row_tot['percepcion'],2);
  
  
  $strSQL_tot="select sum(cm.total) as total,sum(cm.percepcion) as percepcion, sum(cm.items) as item, count(cm.cod_cab) as cantidad, sum(cm.b_imp) as base,sum(cm.igv) as igv from cab_mov cm inner join cliente cl on cl.codcliente=cm.cliente where cm.tipo='$tipo' and cm.flag!='A' $tipdoc and cm.cod_ope!='NC' and cm.moneda='02' and substring($ffecha,1,10) between '$fecha1' and '$fecha2' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$filtro6.$filtroPercep." order by cm.cod_cab ";
  $resultado=mysql_query($strSQL_tot,$cn);
    //echo $strSQL_tot;
  $row_tot=mysql_fetch_array($resultado);
  
  $totgen_cant2=$row_tot['cantidad'];
  $totgen_item2=number_format($row_tot['item'],2);
  $totgen_base2=number_format($row_tot['base'],2);
  $totgen_igv2=number_format($row_tot['igv'],2);
  $totgen_total2=number_format($row_tot['total']+$row_tot['percepcion'],2);
  $percepcionDolar=number_format($row_tot['percepcion'],2);
    
//
  ?>
  
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
   <?php  if(!isset($_REQUEST['excel'])){?>
    <td colspan="3" bgcolor="#F9F9F9">&nbsp;</td>
	<?php } ?>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td align="center" bgcolor="#F9F9F9" style="color:#FF3300; font:bold">&nbsp;</td>
    <td align="center" bgcolor="#F9F9F9" style="color:#FF3300; font:bold">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="center" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="center" bgcolor="#F9F9F9" style="color:#FF3300; font:bold"><span class="Estilo7 Estilo33">Total General &nbsp;(<?php echo $totgen_cant1 ?>)</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo $totgen_item1?></span></td>
    <td align="right" bgcolor="#F9F9F9"><span style="color:#FF3300; font:bold">S/.</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo $totgen_base1 ?></span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo $totgen_igv1 ?></span></td>
	 <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo $percepcionSoles ?></span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo $totgen_total1 ?></span></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <?php  if(!isset($_REQUEST['excel'])){?>
    <td colspan="3" bgcolor="#F9F9F9">&nbsp;</td>
	<?php } ?>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td align="center" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="center" bgcolor="#F9F9F9" style="color:#FF3300; font:bold">&nbsp;</td>
    <td align="center" bgcolor="#F9F9F9" style="color:#FF3300; font:bold">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="center" bgcolor="#F9F9F9" style="color:#FF3300; font:bold"><span class="Estilo7 Estilo33">Total General &nbsp;(<?php echo $totgen_cant2 ?>)</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo $totgen_item2 ?></span></td>
    <td align="right" bgcolor="#F9F9F9"><span style="color:#FF3300; font:bold">US$/.</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo $totgen_base2 ?></span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo $totgen_igv2 ?></span></td>
	 <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo $percepcionDolar ?></span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo $totgen_total2 ?></span></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
  <?php
  $strSQL_tot_a="select sum(cm.total) as total, sum(cm.items) as item, count(cm.cod_cab) as cantidad, sum(cm.b_imp) as base,sum(cm.igv) as igv from cab_mov cm inner join cliente cl on cl.codcliente=cm.cliente where cm.tipo='$tipo' and cm.flag='A' $tipdoc and cm.cod_ope!='NC' and cm.moneda='01' and substring($ffecha,1,10) between '$fecha1' and '$fecha2' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$filtro6." order by cm.cod_cab ";
  //echo $strSQL_tot;
  $resultado_a=mysql_query($strSQL_tot_a,$cn);
  $row_tot_a=mysql_fetch_array($resultado_a);
  
  $totgen_cant1_a=$row_tot_a['cantidad'];
  $totgen_item1_a=number_format($row_tot_a['item'],2);
  $totgen_base1_a=number_format($row_tot_a['base'],2);
  $totgen_igv1_a=number_format($row_tot_a['igv'],2);
  $totgen_total1_a=number_format($row_tot_a['total'],2);
  
  
  $strSQL_tot_a="select sum(cm.total) as total, sum(cm.items) as item, count(cm.cod_cab) as cantidad, sum(cm.b_imp) as base,sum(cm.igv) as igv from cab_mov cm inner join cliente cl on cl.codcliente=cm.cliente where cm.tipo='$tipo' and cm.flag='A' $tipdoc and cm.cod_ope!='NC' and cm.moneda='02' and substring($ffecha,1,10) between '$fecha1' and '$fecha2' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$filtro6." order by cm.cod_cab ";
  $resultado_a=mysql_query($strSQL_tot_a,$cn);
    //echo $strSQL_tot;
  $row_tot_a=mysql_fetch_array($resultado_a);
  
  $totgen_cant2_a=$row_tot_a['cantidad'];
  $totgen_item2_a=number_format($row_tot_a['item'],2);
  $totgen_base2_a=number_format($row_tot_a['base'],2);
  $totgen_igv2_a=number_format($row_tot_a['igv'],2);
  $totgen_total2_a=number_format($row_tot_a['total'],2);
    
//
  ?>
  
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <?php  if(!isset($_REQUEST['excel'])){?>
    <td colspan="3" bgcolor="#F9F9F9">&nbsp;</td>
	<?php } ?>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td align="center" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="center" bgcolor="#F9F9F9" style="color:#FF3300; font:bold">&nbsp;</td>
    <td align="center" bgcolor="#F9F9F9" style="color:#FF3300; font:bold">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="center" bgcolor="#F9F9F9" style="color:#FF3300; font:bold"><span class="Estilo7 Estilo33">Total General Anulado &nbsp;(<?php echo $totgen_cant1_a ?>)</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo $totgen_item1_a?></span></td>
    <td align="right" bgcolor="#F9F9F9"><span style="color:#FF3300; font:bold">S/.</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo "0.00"//$totgen_base1_a ?></span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo "0.00"//$totgen_igv1_a ?></span></td>
	 <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo "0.00"//$totgen_total1_a ?></span></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <?php  if(!isset($_REQUEST['excel'])){?>
    <td colspan="3" bgcolor="#F9F9F9">&nbsp;</td>
	<?php } ?>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td align="center" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="center" bgcolor="#F9F9F9" style="color:#FF3300; font:bold">&nbsp;</td>
    <td align="center" bgcolor="#F9F9F9" style="color:#FF3300; font:bold">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="center" bgcolor="#F9F9F9" style="color:#FF3300; font:bold"><span class="Estilo7 Estilo33">Total General Anulado&nbsp;(<?php echo $totgen_cant2_a ?>)</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo $totgen_item2_a ?></span></td>
    <td align="right" bgcolor="#F9F9F9"><span style="color:#FF3300; font:bold">US$/.</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo "0.00"//$totgen_base2_a ?></span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo "0.00"//$totgen_igv2_a ?></span></td>
	 <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo "0.00"//$totgen_total2_a ?></span></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
  
  
  <?php }
 
  
  ?>
</table>

<strong><?php //echo number_format($total_tanu,2); ?></strong>
<?php 
if(!isset($_REQUEST['excel'])){
?>
|

<table width="100%" height="21" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="311" height="21" align="left" valign="bottom" style="color:#333333"><span class="Estilo10">Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (de <strong><?php echo $total_registros?></strong> documentos)</span>.</td>
    <td width="526" align="right" valign="bottom" style="color:#999999"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:13px">
      <?php 
			  
 if(($pagina - 1) > 0) { 
echo "<a style='cursor:pointer' onclick='cargar_detalle($pagina-1)'>< Anterior </a> "; 
} 

for ($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
	echo "<b style='color:#000000'>".$pagina."</b> "; 
	} else { 
	echo "<a style='cursor:pointer' href='#' onclick='cargar_detalle($i)'>$i</a> "; 
	}
}

if(($pagina + 1)<=$total_paginas) { 
echo " <a style='cursor:pointer' onclick='cargar_detalle($pagina+1)'>Siguiente ></a>"; 
} 

			  ?>
      <input type="hidden" name="pag" value="<?php echo $pagina?>" />
    &nbsp;&nbsp;    </font> </td>
  </tr>
</table>
<?php }

//function mostrar_sub_total($tip_doc,$fec){
function mostrar_sub_total($tip_doc,$fec,$tipo,$filtro1,$filtro2,$filtro3,$filtro4,$filtro5,$filtro6,$order,$agdoc){
if($agdoc=="ag_dia"){
 //$strSQL_tot="select sum(total) as total, sum(items) as item, count(cod_cab) as cantidad, sum(b_imp) as base,sum(igv) as igv from cab_mov where tipo='".$GLOBALS['tipo']."' and flag!='A'   and (moneda='01' or  moneda='')  and substring(fecha,1,10) = '".$fec."' ".$GLOBALS['filtro1'].$GLOBALS['filtro2'].$GLOBALS['filtro3'].$GLOBALS['filtro4'].$GLOBALS['filtro5'].$GLOBALS['filtro6']." and cod_ope='".$tip_doc."' ".$GLOBALS['order'];
 $strSQL_tot="select sum(cm.total) as total, sum(cm.items) as item, count(cm.cod_cab) as cantidad, sum(cm.b_imp) as base,sum(cm.igv) as igv from cab_mov cm inner join cliente cl on cl.codcliente=cm.cliente where cm.tipo='".$tipo."' and cm.flag!='A' and (cm.moneda='01' or  cm.moneda='')  and substring(".$GLOBALS['ffecha'].",1,10) = '".$fec."' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$filtro6." and cm.cod_ope='".$tip_doc."' ".$order;
 
 $strSQL_tot_a="select sum(cm.total) as total, sum(cm.items) as item, count(cm.cod_cab) as cantidad, sum(cm.b_imp) as base,sum(cm.igv) as igv from cab_mov cm inner join cliente cl on cl.codcliente=cm.cliente where cm.tipo='".$GLOBALS['tipo']."' and cm.flag='A'   and (cm.moneda='01' or  cm.moneda='')  and substring(".$GLOBALS['ffecha'].",1,10) = '".$fec."' ".$GLOBALS['filtro1'].$GLOBALS['filtro2'].$GLOBALS['filtro3'].$GLOBALS['filtro4'].$GLOBALS['filtro5'].$GLOBALS['filtro6']." and cm.cod_ope='".$tip_doc."' ".$GLOBALS['order'];
}else{
 $strSQL_tot="select sum(cm.total) as total, sum(cm.items) as item, count(cm.cod_cab) as cantidad, sum(cm.b_imp) as base,sum(cm.igv) as igv from cab_mov cm inner join cliente cl on cl.codcliente=cm.cliente where cm.tipo='".$GLOBALS['tipo']."' and cm.flag!='A' and (cm.moneda='01' or  cm.moneda='')  and substring(".$GLOBALS['ffecha'].",1,10) between '".$GLOBALS['fecha1']."' and '".$GLOBALS['fecha2']."' ".$GLOBALS['filtro1'].$GLOBALS['filtro2'].$GLOBALS['filtro3'].$GLOBALS['filtro4'].$GLOBALS['filtro5'].$GLOBALS['filtro6']." and cm.cod_ope='".$tip_doc."' ".$GLOBALS['order'];
 $strSQL_tot_a="select sum(cm.total) as total, sum(cm.items) as item, count(cm.cod_cab) as cantidad, sum(cm.b_imp) as base,sum(cm.igv) as igv from cab_mov cm inner join cliente cl on cl.codcliente=cm.cliente where cm.tipo='".$GLOBALS['tipo']."' and cm.flag='A'   and (cm.moneda='01' or  cm.moneda='')  and substring(".$GLOBALS['ffecha'].",1,10) between '".$GLOBALS['fecha1']."' and '".$GLOBALS['fecha2']."' ".$GLOBALS['filtro1'].$GLOBALS['filtro2'].$GLOBALS['filtro3'].$GLOBALS['filtro4'].$GLOBALS['filtro5'].$GLOBALS['filtro6']." and cm.cod_ope='".$tip_doc."' ".$GLOBALS['order'];
 }

// echo $strSQL_tot;
  $resultado=mysql_query($strSQL_tot);
  $row_tot=mysql_fetch_array($resultado);
     		if($tip_doc=="NC"){
			$tip=-1;
			}else{
			$tip=1;
			}
  $totgen_cant1=$row_tot['cantidad']*$tip;
  $totgen_item1=$row_tot['item']*$tip;
  $totgen_base1=number_format($row_tot['base'],2,".","")*$tip;
  $totgen_igv1=number_format($row_tot['igv'],2,".","")*$tip;
  $totgen_total1=number_format($row_tot['total'],2,".","")*$tip;
  
  $resultado_a=mysql_query($strSQL_tot_a);
  $row_tot_a=mysql_fetch_array($resultado_a);
     		if($tip_doc=="NC"){
			$tip=-1;
			}else{
			$tip=1;
			}
  $totgen_cant1_a=$row_tot_a['cantidad']*$tip;
  $totgen_item1_a=$row_tot_a['item']*$tip;
  $totgen_base1_a=number_format($row_tot_a['base'],2,".","")*$tip;
  $totgen_igv1_a=number_format($row_tot_a['igv'],2,".","")*$tip;
  $totgen_total1_a=number_format($row_tot_a['total'],2,".","")*$tip;

  if($GLOBALS['agdoc']=="ag_dia"){
  $strSQL_tot="select sum(cm.total) as total, sum(cm.items) as item, count(cm.cod_cab) as cantidad, sum(cm.b_imp) as base,sum(cm.igv) as igv from cab_mov cm inner join cliente cl on cl.codcliente=cm.cliente where cm.tipo='".$GLOBALS['tipo']."' and cm.flag!='A' and cm.moneda='02' and cm.substring(fecha,1,10) = '".$fec."' ".$GLOBALS['filtro1'].$GLOBALS['filtro2'].$GLOBALS['filtro3'].$GLOBALS['filtro4'].$GLOBALS['filtro5'].$GLOBALS['filtro6']." and cm.cod_ope='".$tip_doc."' ".$GLOBALS['order'];
  $strSQL_tot_a="select sum(cm.total) as total, sum(cm.items) as item, count(cm.cod_cab) as cantidad, sum(cm.b_imp) as base,sum(cm.igv) as igv from cab_mov cm where cm.tipo='".$GLOBALS['tipo']."' and cm.flag='A' and cm.moneda='02' and substring(".$GLOBALS['ffecha'].",1,10) = '".$fec."' ".$GLOBALS['filtro1'].$GLOBALS['filtro2'].$GLOBALS['filtro3'].$GLOBALS['filtro4'].$GLOBALS['filtro5'].$GLOBALS['filtro6']." and cm.cod_ope='".$tip_doc."' ".$GLOBALS['order'];
}else{
  $strSQL_tot="select sum(cm.total) as total, sum(cm.items) as item, count(cm.cod_cab) as cantidad, sum(cm.b_imp) as base,sum(cm.igv) as igv from cab_mov cm inner join cliente cl on cl.codcliente=cm.cliente where cm.tipo='".$GLOBALS['tipo']."' and cm.flag!='A' and cm.moneda='02' and substring(".$GLOBALS['ffecha'].",1,10) between '".$GLOBALS['fecha1']."' and '".$GLOBALS['fecha2']."' ".$GLOBALS['filtro1'].$GLOBALS['filtro2'].$GLOBALS['filtro3'].$GLOBALS['filtro4'].$GLOBALS['filtro5'].$GLOBALS['filtro6']." and cm.cod_ope='".$tip_doc."' ".$GLOBALS['order'];
  $strSQL_tot_a="select sum(cm.total) as total, sum(cm.items) as item, count(cm.cod_cab) as cantidad, sum(cm.b_imp) as base,sum(cm.igv) as igv from cab_mov cm inner join cliente cl on cl.codcliente=cm.cliente where cm.tipo='".$GLOBALS['tipo']."' and cm.flag='A' and cm.moneda='02' and substring(".$GLOBALS['ffecha'].",1,10) between '".$GLOBALS['fecha1']."' and '".$GLOBALS['fecha2']."' ".$GLOBALS['filtro1'].$GLOBALS['filtro2'].$GLOBALS['filtro3'].$GLOBALS['filtro4'].$GLOBALS['filtro5'].$GLOBALS['filtro6']." and cm.cod_ope='".$tip_doc."' ".$GLOBALS['order'];
}
//echo $strSQL_tot;
  $resultado=mysql_query($strSQL_tot);
  $row_tot=mysql_fetch_array($resultado);
  
  $totgen_cant2=$row_tot['cantidad']*$tip;
  $totgen_item2=$row_tot['item']*$tip;
  $totgen_base2=number_format($row_tot['base'],2,".","")*$tip;
  $totgen_igv2=number_format($row_tot['igv'],2,".","")*$tip;
  $totgen_total2=number_format($row_tot['total'],2,".","")*$tip;
  
  $resultado_a=mysql_query($strSQL_tot_a);
  $row_tot_a=mysql_fetch_array($resultado_a);
  
  $totgen_cant2_a=$row_tot_a['cantidad']*$tip;
  $totgen_item2_a=$row_tot_a['item']*$tip;
  $totgen_base2_a=number_format($row_tot_a['base'],2,".","")*$tip;
  $totgen_igv2_a=number_format($row_tot_a['igv'],2,".","")*$tip;
  $totgen_total2_a=number_format($row_tot_a['total'],2,".","")*$tip;
  
return  ' <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td align="center" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="center" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="center" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="center" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="center" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="center" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="center" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="center" bgcolor="#F9F9F9" style="color:#FF3300; font:bold"><span class="Estilo7 Estilo33">Total &nbsp;('.$totgen_cant1.')</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">'.$totgen_item1.'</span></td>
    <td align="right" bgcolor="#F9F9F9"><span style="color:#FF3300; font:bold">S/.</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">'. number_format($totgen_base1,2).'</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">'.number_format($totgen_igv1,2).'</span></td>
	 <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">0.0</span></td>
	  <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">'.number_format($totgen_total1,2).'</span></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="right" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td align="center" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="center" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="center" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="center" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="center" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="center" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="center" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="center" bgcolor="#F9F9F9" style="color:#FF3300; font:bold"><span class="Estilo7 Estilo33">Total &nbsp;('.$totgen_cant2.')</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">'.$totgen_item2.'</span></td>
    <td align="right" bgcolor="#F9F9F9"><span style="color:#FF3300; font:bold">US$/.</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">'.number_format($totgen_base2,2).'</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">'.number_format($totgen_igv2,2).'</span></td>
	 <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">0.0</span></td>
     <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">'.number_format($totgen_total2,2).'</span></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="right" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td align="center" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="center" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="center" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="center" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="center" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="center" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="center" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="center" bgcolor="#F9F9F9" style="color:#FF3300; font:bold"><span class="Estilo7 Estilo33">Total Anulados&nbsp;('.$totgen_cant1_a.')</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">'.$totgen_item1_a.'</span></td>
    <td align="right" bgcolor="#F9F9F9"><span style="color:#FF3300; font:bold">S/.</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">0.00'./* number_format($totgen_base1_a,2).*/'</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">0.00'./*number_format($totgen_igv1_a,2).*/'</span></td>
	 <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">0.00'./*number_format($totgen_total1_a,2).*/'</span></td>
	 <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">0.00'./*number_format($totgen_total1_a,2).*/'</span></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="right" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td align="center" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="center" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="center" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="center" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="center" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="center" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="center" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="center" bgcolor="#F9F9F9" style="color:#FF3300; font:bold"><span class="Estilo7 Estilo33">Total Anulados&nbsp;('.$totgen_cant2_a.')</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">'.$totgen_item2_a.'</span></td>
    <td align="right" bgcolor="#F9F9F9"><span style="color:#FF3300; font:bold">US$/.</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">0.00'./*number_format($totgen_base2_a,2)*/'</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">0.00'./*number_format($totgen_igv2_a,2).*/'</span></td>
	 <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">0.00'/*.number_format($totgen_total2_a,2).*/.'</span></td>
	 <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">0.00'/*.number_format($totgen_total2_a,2).*/.'</span></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
	<td align="right" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>';
}
?>