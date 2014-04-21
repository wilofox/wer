<?php 
//session_start();
include('../conex_inicial.php');
include('../funciones/funciones.php');
/*if(isset($_REQUEST['proces'])){
	$_SESSION['contadortp']=0;
	$_SESSION['contadortm']=0;
}*/
$TolS=0;
$TolD=0;
		
$fecha1=$_REQUEST['fecha1'];
$fecha2=$_REQUEST['fecha2'];
$agruparc=$_REQUEST['agruparc'];
//$agruparf=$_REQUEST['agruparf'];
$agrupard=$_REQUEST['agrupard'];
$sucursal=$_REQUEST['sucursal'];
$almacen=$_REQUEST['almacen'];
$auxiliar=$_REQUEST['cliente'];
//$transporte=$_REQUEST['transporte'];
$responsable=$_REQUEST['responsable'];
$pagina=$_REQUEST['pagina'];
$cod_user=$_REQUEST['cod_user'];
$cbomoneda=$_REQUEST['cbomoneda'];
switch($cbomoneda){
	case '0':$tmoneda="ORIGEN";break;
	case '1':$tmoneda="SOLES (S/.)";break;
	case '2':$tmoneda="DOLARES (US$.)";break;
}
//echo $transporte;
/*echo $almacen;*/
if($sucursal=='0'){
	$sqls="select * from sucursal";
}else{
	$sqls="select * from sucursal where cod_suc='".$sucursal."'";
}
$resultados=mysql_query($sqls,$cn);
while($rows=mysql_fetch_array($resultados)){
	$sucursales=$sucursales."'".$rows['cod_suc']."',";
	$sucursalesxd=$sucursalesxd."'".$rows['des_suc']."',";
}			
$sucursales2=substr($sucursales,0,strlen($sucursales)-1)."";
$sucursales2xd=substr($sucursalesxd,0,strlen($sucursalesxd)-1).""; //111
////////////////////////////////			  
if ($almacen=='0' || $almacen=='') {
	$sql="select * from tienda where cod_suc='".$sucursal."' ";
}else{
	$sql="select * from tienda where cod_tienda='".$almacen."' ";
}
//$sql="select * from tienda where cod_suc='".$sucursal."'";
$resultado=mysql_query($sql,$cn);
while($row=mysql_fetch_array($resultado)){
	$tiendas=$tiendas.$row['cod_tienda'].",";
	$tiendasxd=$tiendasxd.$row['des_tienda'].",";
}
$tiendas2=substr($tiendas,0,strlen($tiendas)-1);
$tiendas2xd=substr($tiendasxd,0,strlen($tiendasxd)-1);

if(isset($_REQUEST['excel'])){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=excel.xls");
		
	echo "<table><tr><td colspan='13' height='100px' valign='middle' align='center' style='font-size:18px;font:bold' >PLANILLA DE COBRANZAS <br/></td></tr></table>";
	echo "<table><tr><td colspan='13' height='100px' valign='middle' align='center' style='font-size:14px;font:bold' >Desde: ".$fecha1."  Hasta: ".$fecha2." <br/></td></tr></table>";
	echo "<table><tr><td colspan='13' height='100px' valign='middle' align='center' style='font-size:18px;font:bold' >Sucursal: ".strtoupper($sucursales2xd)." <br/></td></tr></table>";
	echo "<table><tr><td colspan='13' height='100px' valign='middle' style='font-size:14px;font:bold'>".strtoupper($tiendas2xd)." <br/></td></tr></table>";
	echo "<table><tr><td colspan='13' height='100px' valign='middle' style='font-size:14px;font:bold'>EXPRESADO EN: ".strtoupper($tmoneda)." <br/></td></tr></table>";
	
	//760
	echo "<table width='836' border='0' cellpadding='0' cellspacing='1'>
		<tr  style='border:#999999 solid 1px;'>
			<td colspan='4' bgcolor='#666666' class='text6' >C.P.</td>
			<td colspan='3' bgcolor='#666666' class='text6' >Moneda </td>
			<td height='24' colspan='6' align='center' bgcolor='#666666' class='text6'>Documento</td>
		</tr>
		<tr  style='background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px'>
			<td height='21' colspan='1' align='center'   style=' border:#CCCCCC solid 1px' >&nbsp;</td>
			<td  style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>Tip.Pago</strong></span></td>
			<td width='58' align='center'  style=' border:#CCCCCC solid 1px'><span class='texto2'><strong>Fec.Pago</strong></span></td>
			<td width='58' align='center'  style=' border:#CCCCCC solid 1px'><span class='texto2'><strong>Venc.Pago</strong></span></td>
			<td width='36'  style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>T.C.</strong></span></td>
			<td width='70'  style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>S/.</strong></span></td>
			<td width='72'  style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>US$.</strong></span></td>
			<td width='54' align='center'  style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>Td.</strong></span></td>
			<td width='76'  style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>N&deg; Doc. </strong></span></td>
			<td width='118'  style=' border:#CCCCCC solid 1px'><span class='texto2'><strong>CLIENTE</strong></span></td>
			<td width='76'  style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>Referencia </strong></span></td>
			<td width='71'  style=' border:#CCCCCC solid 1px'><span class='texto2'><strong>Vcto.Doc.</strong></span></td>
			<td width='98'  style=' border:#CCCCCC solid 1px'><span class='texto2'><strong>Total Doc.</strong></span></td>
		</tr>
		<tr>
			<td colspan='13'><div id='detalle' style='width:836px; height:250px;' > </div></td>
		</tr>
	</table>";
}
?>
<div id="detalle" style="width:872px; height:200px; overflow:auto ; " >
<?php
//PAGINACION 1	
	$registros = 100; 
	$pagina = $_REQUEST['pagina']; 
	//echo $pagina;

	if ($pagina=='') { 
		$inicio = 0; 
		$pagina = 1; 
	}else { 
		$inicio = ($pagina - 1) * $registros; 
	} 
	//------------------------------------------
	//echo $_SESSION['contadortp']."-".$inicio;
	//if($_SESSION['contadortp']>$inicio)
	//if ($pagina=='') { 
//$_SESSION['contadortp']=$inicio;
//$_SESSION['contadortm']=$inicio;
//	}else{
//	$_SESSION['contadortp']=$inicio+$_SESSION['contadortp'];
//	$_SESSION['contadortm']=$inicio+$_SESSION['contadortm'];
//	}
	// filtro por sucursal y almacen
	if ($sucursal<>''){
		$FilSR=' and  sucursal in('.$sucursales2.') ';
	}
	if ($almacen<>'' and $sucursal<>0){
		$FilTE=' and  tienda in('.$tiendas2.') ';
	}

	// filtro por documento a incluir
	$sql="Select * from temp where cod_user='".$cod_user."' and reporte='COBRANZAS2' ";
	$rs=mysql_query($sql,$cn);
	$cont=mysql_num_rows($rs);
	while ($row=mysql_fetch_array($rs)){
		//$FilDocInc=" and md.id in (".$row['documentos'].") ";
		$FilDocInc=" and pa.t_pago in (".$row['documentos'].") ";
	}
	//Filtro por transportista
	/*if ($transporte<>'0' and $transporte<>'' ){
	   $TransRk=" and transportista='".$transporte."'  ";
	}*/
	if ($responsable<>'0' and $responsable<>'' ){
		$TransRk=" and cod_vendedor='".$responsable."'  ";
	}
	
	//filtro general  
	/*$filtro="where CONCAT(SUBSTR(pa.fecha,7,4),'-',SUBSTR(pa.fecha,4,2),'-',SUBSTR(pa.fecha,1,2)) between '".formatofecha($fecha1)."' and '".formatofecha($fecha2)."'  
			".$FilSR."   ".$FilTE."  ".$FilDocInc."	 ".$TransRk."	
 and  cliente in ( select codcliente from cliente where razonsocial like '%".$auxiliar."%'  )
			";*/
	$filtro="where pa.fecha between '".formatofecha($fecha1)."' and '".formatofecha($fecha2)."' ".$FilSR." ".$FilTE." ".$FilDocInc."	".$TransRk." and  cliente in ( select codcliente from cliente where razonsocial like '%".$auxiliar."%' ) and ca.flag!='A' ";	
	$filtrcon="pa.fecha between '".formatofecha($fecha1)."' and '".formatofecha($fecha2)."' ".$FilSR." ".$FilTE." ".$FilDocInc." ".$TransRk." and  cliente in (select codcliente from cliente where razonsocial like '%".$auxiliar."%') and ca.tipo='2' and ca.flag!='A' ";
// filtro de agrupacion				
	if ($agruparc==0){
		$SqlRk=" $filtro and ca.tipo='2' and ca.flag!='A' ORDER BY concat(tp.modalidad,ca.f_venc)";
	}else{
		$SqlRk=" $filtro and ca.tipo='2' and ca.flag!='A' ORDER BY concat(tp.modalidad,pa.t_pago,ca.f_venc)";
	}
	//echo $SqlRk;		
	
	// rem inicio de proceso ---------------------
	/*$resultados = mysql_query("select * from cab_mov  $SqlRk "  ,$cn);
	$total_registros = mysql_num_rows($resultados); 
		
	$sql2= "select * from cab_mov $SqlRk  LIMIT $inicio, $registros";*/
	//INNER JOIN modalidad md ON md.id=tp.modalidad
	$resultados = mysql_query("SELECT tp.descripcion AS patip,pa.numero AS anum,pa.fecha AS pafec,pa.fechav as pavenc,mo.simbolo AS pamon,pa.monto AS pamonto,ca.cod_ope AS doctip,CONCAT(ca.serie,ca.Num_doc) AS docnum,cli.razonsocial AS clirz,ca.total AS doctot,ca.fecha AS docfec,pa.tcambio AS tc,ca.f_venc AS docvenc,tp.modalidad as t_modal FROM pagos pa INNER JOIN moneda mo ON mo.id=pa.moneda INNER JOIN t_pago tp ON tp.id=pa.t_pago INNER JOIN cab_mov ca ON ca.cod_cab=pa.referencia INNER JOIN cliente cli ON cli.codcliente=ca.cliente  $SqlRk "  ,$cn);
	$total_registros = mysql_num_rows($resultados); 
	$limites=""; 
	if(!isset($_REQUEST['excel'])){
		$limites=" LIMIT $inicio, $registros ";
	}
	// INNER JOIN modalidad md ON md.id=tp.modalidad
	$sql2= "SELECT ca.cod_cab as cod_cab,tp.descripcion AS patip,pa.tipo as tipox,pa.numero AS panum,pa.fecha AS pafec,pa.fechav as pavenc,mo.simbolo AS pamon,pa.monto AS pamonto,ca.cod_ope AS doctip,CONCAT(ca.serie,ca.Num_doc) AS docnum,cli.razonsocial AS clirz,ca.total AS doctot,ca.fecha AS docfec,pa.tcambio AS tc,ca.f_venc AS docvenc,pa.t_pago as tipoPago,tp.modalidad as t_modal FROM pagos pa INNER JOIN moneda mo ON mo.id=pa.moneda INNER JOIN t_pago tp ON tp.id=pa.t_pago INNER JOIN cab_mov ca ON ca.cod_cab=pa.referencia INNER JOIN cliente cli ON cli.codcliente=ca.cliente $SqlRk  $limites";
	
	//echo $sql2;
		
	$resultado2=mysql_query($sql2,$cn);
	$resultado_elim=mysql_query($sql2,$cn);
	$total_registros2 = mysql_num_rows($resultado2); 
	$total_paginas = ceil($total_registros / $registros); 
	
	$temp_tpago="";
	//echo $_REQUEST['t_pago'];
	$jk=0;
	$i=0;
	$totalTpagoS=0;
	$totalTpagoD=0;
	//Total Modalidad
	$totalTmodalS=0;
	$totalTmodalD=0;
	while($row_elim=mysql_fetch_array($resultado_elim)){
		$sqlref_elim=mysql_query("select ca.cod_cab as cod_ref from cab_mov ca inner join referencia re on ca.cod_cab=re.cod_cab_ref where re.cod_cab='".$row_elim['cod_cab']."'",$cn);
		$rw_elim=mysql_fetch_array($sqlref_elim);
		$cab[$i]=$rw_elim['cod_ref'];
		mysql_free_result($sqlref_elim);
		$i++;
	}
	
	while($row=mysql_fetch_array($resultado2)){
		//echo "select concat(ca.cod_ope,' ',ca.serie,ca.Num_doc) as doc from cab_mov ca inner join referencia re on ca.cod_cab=re.cod_cab_ref where re.cod_cab='".$row['cod_cab']."'";
		$sqlref=mysql_query("select concat(ca.cod_ope,' ',ca.serie,ca.Num_doc) as doc from cab_mov ca inner join referencia re on ca.cod_cab=re.cod_cab_ref where re.cod_cab='".$row['cod_cab']."'",$cn);
		$rw_ref=mysql_fetch_array($sqlref);
		$doc_ref=$rw_ref['doc'];
		mysql_free_result($sqlref);
		//echo substr($row['docfec'],0,10)." / ".substr($row['pafec'],0,10)."<br>";
		if(trim(substr($row['docfec'],1,10)) != trim(substr($row['pafec'],1,10))){
			$bgcolor="#51A8FF";
		}else{
			$bgcolor="#FFFFFF";
		}
		?><div style="padding-top:5px;"></div>
		<table width="848" height="22" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" >
		<?php 
		//print_r($cab);
		if(!in_array($row['cod_cab'],$cab)){
			switch($cbomoneda){
				case '0':
					if($row['tipox']=="C"){
						$xmonto=number_format("-".$row['pamonto'],2,'.','');
					}else{
						$xmonto=number_format($row['pamonto'],2,'.','');
					}
					if($row['pamon']=='S/.' && $row['patip']!="CANJE"){
						$temp_monto1=number_format($xmonto,2,'.','');
						$temp_monto2="";
						$TolS=number_format($TolS,2,'.','')+number_format($xmonto,2,'.','');
						$totalTpagoS=number_format($totalTpagoS,2,'.','')+number_format($montox,2,'.','');
						$totalTmodalS=number_format($totalTmodalS,2,'.','')+number_format($xmonto,2,'.','');
					}else{
						if($row['patip']!="CANJE"){
							$temp_monto1="";
							$temp_monto2=number_format($xmonto,2,'.','');
							$TolD=number_format($TolD,2,'.','')+number_format($xmonto,2,'.','');
							$totalTpagoD=number_format($totalTpagoD,2,'.','')+number_format($xmonto,2,'.','');
							$totalTmodalD=number_format($totalTmodalD,2,'.','')+number_format($xmonto,2,'.','');
						}else{
							$temp_monto1="";
							$temp_monto2="";
						}
					}break;
				case '1':
					if($row['tipox']=="C"){
						$xmonto=number_format("-".$row['pamonto'],2,'.','');
					}else{
						$xmonto=number_format($row['pamonto'],2,'.','');
					}
					if($row['pamon']=='S/.' && $row['patip']!="CANJE"){
						$temp_monto1=number_format($xmonto,2,'.','');
						$temp_monto2="";
						$TolS=number_format($TolS,2,'.','')+number_format($xmonto,2,'.','');
						$totalTpagoS=number_format($totalTpagoS,2,'.','')+number_format($xmonto,2,'.','');
						$totalTmodalS=number_format($totalTmodalS,2,'.','')+number_format($xmonto,2,'.','');
					}else{
						if($row['patip']!="CANJE"){
							$temp_monto1="";
							$temp_monto2=number_format($xmonto*$row['tc'],2,'.','');
							$TolS=$TolS+number_format($xmonto*$row['tc'],2,'.','');
							$totalTpagoS=number_format($totalTpagoS,2,'.','')+number_format($xmonto*$row['tc'],2,'.','');
							$totalTmodalS=number_format($totalTmodalS,2,'.','')+number_format($xmonto*$row['tc'],2,'.','');
						}else{
							$temp_monto1="";
							$temp_monto2="";
						}
					}break;
				case '2':
					if($row['tipox']=="C"){
						$xmonto=number_format("-".$row['pamonto'],2,'.','');
					}else{
						$xmonto=number_format($row['pamonto'],2,'.','');
					}
					if($row['pamon']=='S/.' && $row['patip']!="CANJE"){
						if($row['tc']!=0){
						$temp_monto1=number_format($xmonto/$row['tc'],2,'.','');
						}else{
							$temp_monto1=0;
						}
						$temp_monto2="";
						if($row['tc']!=0){
						$TolD=number_format($TolD,2,'.','')+number_format($xmonto/$row['tc'],2,'.','');
						}else{
							$TolD=number_format($TolD,2,'.','')+0;
						}
						if($row['tc']!=0){
						$totalTpagoD=number_format($totalTpagoD,2,'.','')+number_format($xmonto/$row['tc'],2,'.','');
						$totalTmodalD=number_format($totalTmodalD,2,'.','')+number_format($xmonto/$row['tc'],2,'.','');
						}else{
							$totalTpagoD=number_format($totalTpagoD,2,'.','')+0.00;
							$totalTmodalD=number_format($totalTmodalD,2,'.','')+0.00;
						}
					}else{
						if($row['patip']!="CANJE"){
							$temp_monto1="";
							$temp_monto2=number_format($xmonto,2,'.','');
							$TolD=number_format($TolD,2,'.','')+number_format($xmonto,2,'.','');
							$totalTpagoD=number_format($totalTpagoD,2,'.','')+number_format($xmonto,2,'.','');
							$totalTmodalD=number_format($totalTmodalD,2,'.','')+number_format($xmonto,2,'.','');
						}else{
							$temp_monto1="";
							$temp_monto2="";
						}
					}break;
			}
		}
		//$tempxtotal=mostrar_totales($row['t_modal'],$row['tipoPago'],$filtrcon);
		if($jk!=0){
		$tempxtotal=mostrar_totales($temp_tmodal,$temp_tpago,$filtrcon,$cbomoneda);
		$totales=explode("|",$tempxtotal);
		//print_r($totales);
		//if($i!=0 && $_REQUEST['t_pago']=='S'){
		//print_r($totales);
		//echo $totales[2]."-".$_SESSION['contadortp']."<br>";
		//if($_SESSION['contadortp']!=0 && $_REQUEST['t_pago']=='S'){
		//echo $row['tipoPago']."!=".$temp_tpago." && ".$jk."!=0<br>";
			if($row['tipoPago']!=$temp_tpago && $jk!=0 && $_REQUEST['t_pago']=='S'){
				//echo "<br>";
				echo $totales[0];
				//$_SESSION['tpagoact'].=",'".$row['tipoPago']."'";
				//echo "<br>";
			}
		///Totalizar Modalidad
		//if($i!=0){
			if($row['t_modal']!=$temp_tmodal && $jk!=0){
		//if($_SESSION['contadortm']==$totales[3]){
			//echo" <tr height='30' align='center'><td colspan='13' class='Detalle1' ><strong>TOTAL TIPO S/.: <span style='color=#0066FF'>".number_format($totalTmodalS,2)."</span></strong></td></tr>";
			//echo" <tr height='30' align='center'><td colspan='13' class='Detalle1' ><strong>TOTAL TIPO US$: <span style='color=#0066FF'>".number_format($totalTmodalD,2)."</span></strong></td></tr>";
			//$totalTmodalS=0;
			//$totalTmodalD=0;
			echo $totales[1];
			//$_SESSION['contadortm']=0;
			//}
		}
		}
		if($_REQUEST['t_pago']=='S'){
		//echo $row['tipoPago']." - ".$temp_tpago;
			if($row['tipoPago']!=$temp_tpago){
				echo" <tr height='30'><td colspan='13' class='Detalle1' ><strong>".$row['patip']."</strong></td></tr>";		
			}
		}		
		$temp_tpago=$row['tipoPago'];
		$temp_tmodal=$row['t_modal'];
		$temp_tpago2=strtoupper($row['patip']);
		$jk++;
		if(!in_array($row['cod_cab'],$cab)){			
		?>	
		<tr bgcolor="<?php echo $bgcolor; ?>">
			<td width="29" class="Detalle1">&nbsp;</td>
			<td width="65" align="center"><span class="Detalle1">
			<?
			echo $row['patip'];
			//transportista			
			?>
			</span></td>
			<td width="66" class="Detalle1">
			<?			
			echo formatobarrafecha($row['pafec']);
			//transportista			
			?></td>
            <td width="66" class="Detalle1">
			<?			
			echo formatobarrafecha($row['pavenc']);
			//transportista			
			?></td> 
            <td width="31" align="center"><span class="Detalle1">
			<?
			echo $row['tc'];
			//transportista			
			?>
			</span></td>
			<td width="35" align="right"><span class="Detalle1">
			<?
			//echo $temp_monto1;
			switch($cbomoneda){
				case '0':echo $row['pamon'];break;
				case '1':echo "S/.";break;
				case '2':echo "US$.";break;
			}
			//echo $row['pamon'];
			//transportista	
			?>
			</span></td>
			<td width="60" align="right"><span class="Detalle1">
			<?
			//echo $temp_monto2;
			if($row['tipox']=="C"){
				$xmonto=number_format("-".$row['pamonto'],2,'.','');
			}else{
				$xmonto=number_format($row['pamonto'],2,'.','');
			}
			switch($cbomoneda){
				case '0':echo number_format($xmonto,2,'.','');break;
				case '1':if($row['pamon']=="US$."){echo number_format($xmonto*$row['tc'],2,'.','');}else{echo number_format($xmonto,2,'.','');};break;
				case '2':if($row['pamon']=="S/." && $row['tc']!=0){echo number_format($xmonto/$row['tc'],2);}else{if($row['pamon']=="S/."){echo number_format("0.00",2,'.','');}else{echo number_format($xmonto,2,'.','');}};break;
			}
			
			//transportista			
			?>
			</span></td>   
			<td width="27" align="center"><span class="Detalle1">
			<?
			echo $row['doctip'];
			//transportista			
			?>
			</span></td>
			<td width="69"><span class="Detalle1">
			<?
			echo $row['docnum'];
			//transportista			
			?>
			</span></td>
			<td width="193"><span class="Detalle1">
			<?
			if(isset($_REQUEST['excel'])){
				echo caracteres($row['clirz']);
			}else{
				echo substr(caracteres($row['clirz']),0,30);
			}
			//transportista			
			?>
            </span></td>
            <td width="85"><span class="Detalle1">
			<?
			echo $doc_ref;
			//transportista			
			?>
            </span></td>
            <td width="58"><span class="Detalle1">
			<?
			echo formatobarrafecha(substr($row['docvenc'],0,10));
			//transportista			
			?>
            </span></td>
            <td width="64" align="right"><span class="Detalle1">
			<?
			echo number_format($row['doctot'],2);
			//transportista			
			?>
            </span></td>
          </tr>
		<?php
		//$_SESSION['contadortp']=number_format($_SESSION['contadortp'],0,'.','')+1;
		//$_SESSION['contadortm']=number_format($_SESSION['contadortm'],0,'.','')+1;
		//echo $row['t_modal']."---".$row['tipoPago']."----".$filtrcon."<br>";
		
	} ?>		
  </table>
		<?php 	
	/*	
	if ($sucursal<>''){
	  $FilSR=' and  cm.sucursal in('.$sucursales2.') ';
	}
	if ($almacen<>'' and $sucursal<>0){
	  $FilTE=' and  cm.tienda in('.$tiendas2.') ';
	}
*/
		?>
		<?php 
		
		}
		echo"<table width='848' height='22' border='0' cellpadding='0' cellspacing='0' bgcolor='#FFFFFF' > 
		<tr><td width='29' class='Detalle1'>&nbsp;</td>
			<td width='65' align='center'><span class='Detalle1'>&nbsp;</span></td>
			<td width='66' class='Detalle1'>&nbsp;</td>
            <td width='66' class='Detalle1'>&nbsp;</td> 
            <td width='31' align='center'><span class='Detalle1'>&nbsp;</span></td>
			<td width='35' align='right'><span class='Detalle1'>&nbsp;</span></td>
			<td width='60' align='right'><span class='Detalle1'>&nbsp;</span></td>   
			<td width='27' align='center'><span class='Detalle1'>&nbsp;</span></td>
			<td width='69'><span class='Detalle1'>&nbsp;</span></td>
			<td width='193'><span class='Detalle1'>&nbsp;</span></td>
            <td width='85'><span class='Detalle1'>&nbsp;</span></td>
            <td width='58'><span class='Detalle1'>&nbsp;</span></td>
            <td width='64' align='right'><span class='Detalle1'>&nbsp;</span></td>
		</tr>";		
		$tempxtotal=mostrar_totales($temp_tmodal,$temp_tpago,$filtrcon,$cbomoneda);
		$totales=explode("|",$tempxtotal);
		//print_r($totales);
		//if($i!=0 && $_REQUEST['t_pago']=='S'){
		//print_r($totales);
		//echo $totales[2]."-".$_SESSION['contadortp']."<br>";
		//if($_SESSION['contadortp']!=0 && $_REQUEST['t_pago']=='S'){
		if($_REQUEST['t_pago']=='S'){
			//if($row['tipoPago']!=$_SESSION['tpagoact']){
			if($jk==0){
			//$_SESSION['tpagoact'].="'".$row['tipoPago']."'";
			//$temp_tpago=$row['tipoPago'];
			}
			//if($_SESSION['contadortp']==$totales[2]){
				//echo $totales[0];
				//$_SESSION['contadortp']=0;
				//echo $i;
			//}
			//echo $row['tipoPago']."!=".$temp_tpago." && ".$jk."!=0<br>";
			//if($row['tipoPago']!=$temp_tpago && $jk!=0 && $_REQUEST['t_pago']=='S'){
				//echo "<br>";
				echo $totales[0];
				//$_SESSION['tpagoact'].=",'".$row['tipoPago']."'";
				//echo "<br>";
			//}
		}
		
		///Totalizar Modalidad
		//if($i!=0){
			if($jk==0){
			}
			//if($row['t_modal']!=$temp_tmodal && $jk!=0){
		//if($_SESSION['contadortm']==$totales[3]){
			//echo" <tr height='30' align='center'><td colspan='13' class='Detalle1' ><strong>TOTAL TIPO S/.: <span style='color=#0066FF'>".number_format($totalTmodalS,2)."</span></strong></td></tr>";
			//echo" <tr height='30' align='center'><td colspan='13' class='Detalle1' ><strong>TOTAL TIPO US$: <span style='color=#0066FF'>".number_format($totalTmodalD,2)."</span></strong></td></tr>";
			//$totalTmodalS=0;
			//$totalTmodalD=0;
			echo $totales[1];
			//$_SESSION['contadortm']=0;
			//}
		//}
		echo "</table>";
        
		/*if($i!=0 && $_REQUEST['t_pago']=='S'){
			//if($row['tipoPago']!=$temp_tpago){
				echo"<tr height='30' align='center'><td colspan='13' class='Detalle1' ><strong>TOTAL $temp_tpago2 S/.: <span style='color=#0066FF'>".number_format($totalTpagoS,2)."</span></strong></td></tr>";
				echo" <tr height='30' align='center'><td colspan='13' class='Detalle1' ><strong>TOTAL $temp_tpago2 US$: <span style='color=#0066FF'>".number_format($totalTpagoD,2)."</span></strong></td></tr>";
				$totalTpagoS=0;
				$totalTpagoD=0;
			//}
		}
		echo" <tr height='30' align='center'><td colspan='13' class='Detalle1' ><strong>TOTAL TIPO S/.: <span style='color=#0066FF'>".number_format($totalTmodalS,2)."</span></strong></td></tr>";
		echo" <tr height='30' align='center'><td colspan='13' class='Detalle1' ><strong>TOTAL TIPO US$: <span style='color=#0066FF'>".number_format($totalTmodalD,2)."</span></strong></td></tr>";
		$totalTmodalS=0;
		$totalTmodalD=0;
		echo"</table>";*/
		?>	
        
</div>	
<?

//if ($total_paginas==$pagina){
echo '<table border="0">
<tr>
<td width="450" colspan="7"><div align="right" style="padding-tight:15px"><b>--------------------------------------------------<br>';
if($cbomoneda=='0'){
echo 'GRAN TOTAL (S/.) &nbsp;&nbsp;&nbsp; '.number_format($TolS,2,'.','').' &nbsp;&nbsp;&nbsp;<br>';
echo 'GRAN TOTAL (US$.) &nbsp;&nbsp;&nbsp; '.number_format($TolD,2,'.','').' &nbsp;&nbsp;&nbsp';
}else{
	if($cbomoneda=='1'){
		$totalx=number_format($TolS,2,'.','');
	}else{
		$totalx=number_format($TolD,2,'.','');
	}
	echo 'GRAN TOTAL &nbsp;&nbsp;&nbsp; '.number_format($totalx,2,'.','').' &nbsp;&nbsp;&nbsp;<br>';
}
echo '</b></div></td>
<tr></table>';
//}
if(!isset($_REQUEST['excel'])){
?>
		<table width="804" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="21" align="right">&nbsp;</td>
        <td>      
      </tr>
      <tr>
        <td width="562" height="21">Viendo del <?php echo $inicio+1?> al <?php echo $inicio+$total_registros2 ?> (de <?php echo $total_registros?> documentos) </td>
        <td width="236"><?php 
			  
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
        <input type="hidden" name="pag" value="<?php echo $pagina?>" />      </tr>
</table>
<?
}

function mostrar_totales($mo,$tp,$whe,$mone){
	include('../conex_inicial.php');
	$res="";
	//if($tp!=''){
		switch($mone){
			case '0':$sql="SELECT tp.descripcion AS patip,pa.tipo as tipox, sum(if(pa.moneda='01',pa.monto,0)) AS totals,sum(if(pa.moneda='02',pa.monto,0)) AS totald FROM pagos pa INNER JOIN moneda mo ON mo.id=pa.moneda INNER JOIN t_pago tp ON tp.id=pa.t_pago INNER JOIN cab_mov ca ON ca.cod_cab=pa.referencia INNER JOIN cliente cli ON cli.codcliente=ca.cliente where tp.id='".$tp."' and ".$whe."GROUP BY tp.id";break;
			default:$sql="SELECT tp.descripcion AS patip,pa.tipo as tipox, pa.monto AS totals,pa.moneda AS totald,pa.tcambio AS tca FROM pagos pa INNER JOIN moneda mo ON mo.id=pa.moneda INNER JOIN t_pago tp ON tp.id=pa.t_pago INNER JOIN cab_mov ca ON ca.cod_cab=pa.referencia INNER JOIN cliente cli ON cli.codcliente=ca.cliente where tp.id='".$tp."' and ".$whe;break;
		}
		$rs=mysql_query($sql,$cn);
		$totalsol=0;
		$totaldol=0;
		$tpago="";
		//$row_tot=mysql_fetch_array($rs);
		while($row_tot=mysql_fetch_array($rs)){
			if($row_tot['tipox']=="C"){
				$xmontos=number_format("-".$row_tot['totals'],2,'.','');
				$xmontod=number_format("-".$row_tot['totald'],2,'.','');
			}else{
				$xmontos=number_format($row_tot['totals'],2,'.','');
				$xmontod=number_format($row_tot['totald'],2,'.','');
			}
			switch($mone){
				//case '0':$totalsol=$row_tot['totals'];$totaldol=$row_tot['totald'];break;
				case '0':$totalsol=$xmontos;$totaldol=$xmontod;break;
				case '1':
					switch($row_tot['totald']){
						//case '01':$totalsol=number_format($row_tot['totals'],2,'.','')+number_format($totalsol,2,'.','');break;
						case '01':$totalsol=number_format($xmontos,2,'.','')+number_format($totalsol,2,'.','');break;
						//case '02':$totalsol=number_format($row_tot['totals']*$row_tot['tca'],2,'.','')+number_format($totalsol,2,'.','');break;
						case '02':$totalsol=number_format($xmontos*$row_tot['tca'],2,'.','')+number_format($totalsol,2,'.','');break;
					}
					break;
				case '2':
					switch($row_tot['totald']){
						//case '01':if($row_tot['tca']>0){$totaldol=number_format($row_tot['totals']/$row_tot['tca'],2,'.','')+number_format($totaldol,2,'.','');}else{$totaldol=number_format("0.00",2,'.','')+number_format($totaldol,2,'.','');};break;
						case '01':if($row_tot['tca']>0){$totaldol=number_format($xmontos/$row_tot['tca'],2,'.','')+number_format($totaldol,2,'.','');}else{$totaldol=number_format("0.00",2,'.','')+number_format($totaldol,2,'.','');};break;
						//case '02':$totaldol=number_format($row_tot['totals'],2,'.','')+number_format($totaldol,2,'.','');break;
						case '02':$totaldol=number_format($xmontos,2,'.','')+number_format($totaldol,2,'.','');break;
					}
					break;
			}
			$tpago=$row_tot['patip'];
		}
		$res="<tr><td colspan='7' align='right'><b>------------------------------------------</td></tr>";
		if(number_format($totalsol,2)!=0.00){
		$res.="<tr align='right'><td colspan='6' class='Detalle1' ><strong>Total Doc. : ".strtoupper($tpago);
		if($mone=='0'){
			$res.=" S/. : ";
		}else{
			$res.=" : ";
		}
		$res.="</strong></td><td class='Detalle1'><strong><span style='color=#0066FF'>".number_format($totalsol,2,'.',',')."</span></strong><br></td></tr>";
		}
		if(number_format($totaldol,2)!=0.00){
		$res.="<tr height='30' align='right'><td colspan='6' class='Detalle1' ><strong>Total Doc. : ".strtoupper($tpago);
		if($mone=='0'){
			$res.=" US$.: ";
		}else{
			$res.=" : ";
		}
		$res.="</strong></td><td class='Detalle1'><strong><span style='color=#0066FF'>".number_format($totaldol,2,'.',',')."</span></strong></td></tr>";
		}
		$res.="<tr align='right'><td colspan='7'><b>--------------------------------</td></tr>";
	//}
	$res.="|";
	//if($mo!=''){
		switch($mone){
			case '0':$sql="SELECT sum(if(pa.moneda='01',pa.monto,0)) AS totals,sum(if(pa.moneda='02',pa.monto,0)) AS totald FROM pagos pa INNER JOIN moneda mo ON mo.id=pa.moneda INNER JOIN t_pago tp ON tp.id=pa.t_pago INNER JOIN cab_mov ca ON ca.cod_cab=pa.referencia INNER JOIN cliente cli ON cli.codcliente=ca.cliente where tp.modalidad='".$mo."' and ".$whe."GROUP BY tp.modalidad";break;
			default:$sql="SELECT tp.descripcion AS patip,pa.monto AS totals,pa.moneda AS totald,pa.tcambio AS tca FROM pagos pa INNER JOIN moneda mo ON mo.id=pa.moneda INNER JOIN t_pago tp ON tp.id=pa.t_pago INNER JOIN cab_mov ca ON ca.cod_cab=pa.referencia INNER JOIN cliente cli ON cli.codcliente=ca.cliente where tp.modalidad='".$mo."' and ".$whe;break;
		}
		$rs=mysql_query($sql,$cn);
		//$row_tot=mysql_fetch_array($rs);
		$totalsol=0;
		$totaldol=0;
		$tpago="";
		//$row_tot=mysql_fetch_array($rs);
		while($row_tot=mysql_fetch_array($rs)){
			switch($mone){
				case '0':$totalsol=$row_tot['totals'];$totaldol=$row_tot['totald'];break;
				case '1':
					switch($row_tot['totald']){
						case '01':$totalsol=number_format($row_tot['totals'],2,'.','')+number_format($totalsol,2,'.','');break;
						case '02':$totalsol=number_format($row_tot['totals']*$row_tot['tca'],2,'.','')+number_format($totalsol,2,'.','');break;
					}
					break;
				case '2':
					switch($row_tot['totald']){
						case '01':if($row_tot['tca']>0){$totaldol=number_format($row_tot['totals']/$row_tot['tca'],2,'.','')+number_format($totaldol,2,'.','');}else{$totaldol=number_format("0.00",2,'.','')+number_format($totaldol,2,'.','');};break;
						case '02':$totaldol=number_format($row_tot['totals'],2,'.','')+number_format($totaldol,2,'.','');break;
					}
					break;
			}
		}
		$res.="<tr><td colspan='7' align='right'><b>--------------------------------</td></tr>";
		if(number_format($totalsol,2)!=0.00){
		$res.="<tr height='30' align='right'><td colspan=6 class='Detalle1' ><strong>";
		if($mone=='0'){
			$res.="TOTAL TIPO S/. : ";
		}else{
			$res.="TOTAL TIPO : ";
		}
		$res.="</strong></td><td class='Detalle1'><strong><span style='color=#0066FF'>".number_format($totalsol,2)."</span></strong></td></tr>";
		}
		if(number_format($totaldol,2)!=0.00){
		$res.="<tr height='30' align='right'><td colspan='6' class='Detalle1' ><strong>";
		if($mone=='0'){
			$res.="TOTAL TIPO US$.: ";
		}else{
			$res.="TOTAL TIPO : ";
		}
		$res.="</strong></td><td class='Detalle1'><strong><span style='color=#0066FF'>".number_format($totaldol,2)."</span></strong></td></tr>";
		}
		$res.="<tr align='right'><td colspan='7'><b>--------------------------------</td></tr>";
	//}
	$res.="|";
	/*$tdoc=explode(",",$_SESSION['tpagoact']);
	$docx="''";
	$tempxdc="";
	for($xi=0;$xi<count($tdoc);$xi++){
		if($tempxdc!=$tdoc[$xi] && $tdoc[$xi]!=""){
			$_SESSION['tpagoact'].=",".$tdoc[$xi];
			$tempxdc=$tdoc[$xi];
		}
	}
	$tempxdc="";
	$tdoc2=explode(",",$_SESSION['tpagoact']);
	$xc=0;
	for($xi=0;$xi<count($tdoc2);$xi++){
		if($tdoc2[$xi]!=""){
		if($tempxdc!=$tdoc2[$xi]){
			if($xc==0){
				$docx="'".$tdoc2[$xi]."'";
			}else{
				$docx=",'".$tdoc2[$xi]."'";
			}
			$xc++;
		}
		}
	}*/
	if($tp!=""){
	$sql="SELECT count(*) as num_total FROM pagos pa INNER JOIN moneda mo ON mo.id=pa.moneda INNER JOIN t_pago tp ON tp.id=pa.t_pago INNER JOIN cab_mov ca ON ca.cod_cab=pa.referencia INNER JOIN cliente cli ON cli.codcliente=ca.cliente where tp.id=".$tp." and ".$whe."GROUP BY tp.id";
	$rs=mysql_query($sql,$cn);
	$row_tot=mysql_fetch_array($rs);
	$res.=$row_tot[0];
	}
	$res.="|";
	if($mo!=""){
	$sql="SELECT count(*) as num_total FROM pagos pa INNER JOIN moneda mo ON mo.id=pa.moneda INNER JOIN t_pago tp ON tp.id=pa.t_pago INNER JOIN cab_mov ca ON ca.cod_cab=pa.referencia INNER JOIN cliente cli ON cli.codcliente=ca.cliente where tp.modalidad='".$mo."' and ".$whe."GROUP BY tp.modalidad";
	$rs=mysql_query($sql,$cn);
	$row_tot=mysql_fetch_array($rs);
	$res.=$row_tot[0];
	return $res;
	}
}
?>	