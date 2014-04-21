<?php 
if(isset($_REQUEST['excel'])){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=excel.xls");
	$display=" style='display:none' ";
}
include('../conex_inicial.php');
include ('../funciones/funciones.php');
?>

<style media="all">
.noprint{ display: none }
</style>

<style type="text/css">
<!--
.Estilo10 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo15 {color: #FFFFFF}
.Estilo35 {font-size: 11px}
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.anulado {text-decoration:line-through;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#990000; }
-->
</style>

<?php 
if(isset($_REQUEST['excel'])){
	if($_REQUEST['tipo']=='2'){
		$tit="COBRAR";
	}else{
		$tit="PAGAR";
	}
	echo "<center><b><h1>REPORTE DE ESTADO DE CUENTAS POR ".$tit."</h1></b></center><table border='0'>";
	echo  "<tr><td width='100' colspan='10' align='center'><b>Fecha de:</b></td><td>".$_REQUEST['fecha']." al ".$_REQUEST['fecha2']."</td></tr>";
	if($_REQUEST['sucursal']!="" && $_REQUEST['sucursal']!="0"){
		$dat=mysql_fetch_array(mysql_query("select * from sucursal where cod_suc='".$_REQUEST['sucursal']."'"));
		$suc=$dat['des_suc'];
	}else{
		$suc="Todas";
	}
		echo  "<tr><td colspan='2'><b>Empresa:</b></td><td>$suc</td></tr>";
	if($_REQUEST['almacen']!="" && $_REQUEST['almacen']!="0"){
		$dat=mysql_fetch_array(mysql_query("select * from tienda where cod_tienda='".$_REQUEST['almacen']."'"));
		$t1=$dat['des_tienda'];
	}else{
		$t1="Todas";
	}
		echo  "<tr><td colspan='2'><b>Tienda:</b></td><td>".$t1."</td></tr>";
	if($_REQUEST['vendedor']!="" && $_REQUEST['vendedor']!="000"){
		$dat=mysql_fetch_array(mysql_query("select * from usuarios where codigo='".$_REQUEST['vendedor']."'"));
		$u1=$dat['usuario'];
	}else{
		$u1="Todos";
	}
	echo  "<tr><td colspan='2'><b>Vendedor:</b></td><td>".$u1."</td></tr>";
	if($_REQUEST['turno']!="" && $_REQUEST['turno']!="0"){
		$dat=mysql_fetch_array(mysql_query("select * from turno where id='".$_REQUEST['turno']."'"));
		echo  "<tr><td colspan='2'><b>Turno:</b></td><td>".$dat['abreviatura']."</td></tr>";
	}

	if($_REQUEST['serie']!="" && $_REQUEST['serie']!="000"){
		$dat=mysql_fetch_array(mysql_query("select * from caja where codigo='".$_REQUEST['serie']."'"));
		echo  "<tr><td colspan='2'><b>Serie:</b></td><td>".$dat['descripcion']."</td></tr>";
	}
	if($_REQUEST['tickets']=="true"){
		echo  "<tr><td colspan='2'><b>Documentos:</b></td><td>Todos</td></tr>";
	}
	echo "</table><br/>";
}
?>
<table width="952" border="0" cellpadding="1" cellspacing="1" >
	<tr bgcolor="#D6D6D6" style="background:url(../imagenes/bg_contentbase2.gif);  background-position:100% 40%;">
	<?php if(!isset($_REQUEST['excel'])){?>
		<td width="15" height="15"><span class="noprint" >O. </span></td>
		<td width="16"><span class="Estilo7 Estilo15 Estilo35">P. </span></td>
	<?php } ?>
		<td width="44"><span class="Estilo7 Estilo15 Estilo35"><b>Tienda</b></span></td>
		<td width="79"><span class="Estilo7 Estilo15 Estilo35"><b>F. Emi</b></span></td>
		<td width="79"><span class="Estilo7 Estilo15 Estilo35"><b>F. venc</b></span></td>
		<td width="28" ><span class="Estilo7 Estilo15 Estilo35"><b>Doc.</b></span></td>
		<td width="84" ><span class="Estilo7 Estilo15 Estilo35"><b>N. Documento </b></span></td>
		<td width="178"><span class="Estilo7 Estilo15 Estilo35"><b>Cliente</b></span></td>
		<td colspan="2"><span class="Estilo7 Estilo15 Estilo35"><b>Vendedor</b></span></td>
		<td width="59" align="center"><span class="Estilo7 Estilo15 Estilo35"><b>Moneda</b></span></td>
		<td width="62" align="center" ><span class="Estilo7 Estilo15 Estilo35"><b>Total</b></span></td>
		<td width="62" align="right" ><span class="Estilo7 Estilo15 Estilo35"><b>Cargos</b></span></td>
		<td width="50" align="right" ><span class="Estilo7 Estilo15 Estilo35"><b>A cta</b></span></td>
		<td width="57" align="right" ><span class="Estilo7 Estilo15 Estilo35"><b>Saldo</b></span></td>
	</tr>
	<?php if($_REQUEST['formato']=='D'){ ?>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td style="background:url(../imagenes/bg_contentbase2.gif);  background-position:100% 40%;" height="15" bgcolor="#FCFEF5"><span class="Estilo7 Estilo15 Estilo35">Fecha Pago </span></td>
		<td style="background:url(../imagenes/bg_contentbase2.gif);  background-position:100% 40%;" height="15" align="center" colspan="2" bgcolor="#FCFEF5"><span class="Estilo7 Estilo15 Estilo35">T.Pago</span></td>
		<td style="background:url(../imagenes/bg_contentbase2.gif);  background-position:100% 40%;" height="15" align="center" bgcolor="#FCFEF5"><span class="Estilo7 Estilo15 Estilo35">Numero</span></td>
		<td width="62" height="15" align="center" bgcolor="#FCFEF5" style="background:url(../imagenes/bg_contentbase2.gif);  background-position:100% 40%;"><span class="Estilo7 Estilo15 Estilo35">T. Ope. </span></td>
		<td width="31" align="center" bgcolor="#FCFEF5" style="background:url(../imagenes/bg_contentbase2.gif);  background-position:100% 40%;"><span class="Estilo7 Estilo15 Estilo35">T. C. </span></td>
		<td style="background:url(../imagenes/bg_contentbase2.gif);  background-position:100% 40%;" height="15" align="center" bgcolor="#FCFEF5"><span class="Estilo7 Estilo15 Estilo35">Moneda</span></td>
		<td style="background:url(../imagenes/bg_contentbase2.gif);  background-position:100% 40%;" height="15" bgcolor="#FCFEF5"><span class="Estilo7 Estilo15 Estilo35">Importe</span></td>
		<td style="background:url(../imagenes/bg_contentbase2.gif);  background-position:100% 40%;" height="15" bgcolor="#FCFEF5" colspan="3"><span class="Estilo7 Estilo15 Estilo35">Observaciones</span></td>
	</tr>
	<?php }
	$fecha1=extraefecha($_REQUEST['fecha']);
	$fecha2=extraefecha($_REQUEST['fecha2']);
	$sucursal=$_REQUEST['sucursal'];
	$tienda=$_REQUEST['almacen'];
	$tipo=$_REQUEST['tipo'];
						
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
	$trep=$_REQUEST['tiporep'];
	$filtro4="";
	if($sucursal=='0'){
		$filtro5="";
	}else{
		if($tienda=='0'){
			$filtro5=" and sucursal='$sucursal' ";					
		}else{
			$filtro5=" and sucursal='$sucursal' and tienda='$tienda' ";					
		}
	}
	$codcliente=$_REQUEST['codcli'];
	if($codcliente!=""){
		$filtro6=" and cliente='$codcliente'";
	}else{
		$filtro6="";
	}
	if($_REQUEST['acliente']=="true"){
		$agcliente="s";
	}else{
		$agcliente="n";
	}	
	
	//$filtro6.=" and cab_mov.condicion in(Select condicion from detope where documento=cab_mov.cod_ope and deuda='S')";
	
	if($agcliente=="s"){
		$strSQL_cab="select cab_mov.*,razonsocial from cab_mov inner join detope do on do.documento=cab_mov.cod_ope and do.condicion=cab_mov.condicion inner join cliente on cab_mov.cliente=cliente.codcliente inner join operacion op on op.codigo=cab_mov.cod_ope and op.tipo=cab_mov.tipo where cab_mov.tipo='$tipo' and substring(fecha,1,10) <= '$fecha2' and do.deuda='S' and cab_mov.cod_ope NOT IN('NC','TN') and substr(op.p1,5,1)='S' ".$filtro1.$filtro2.$filtro4.$filtro5.$filtro6." and flag!='A' order by razonsocial asc,f_venc asc";
		//$strSQL_cab="select *,razonsocial from cab_mov inner join cliente on cab_mov.cliente=cliente.codcliente where cab_mov.tipo='$tipo' and substring(fecha,1,10) <= '$fecha2' and cab_mov.cod_ope NOT IN('NC','TN') and deuda='S' ".$filtro1.$filtro2.$filtro4.$filtro5.$filtro6." and flag!='A' order by razonsocial asc,f_venc asc";
		$res=mysql_query($strSQL_cab,$cn);
		$cod_ant_cab="";
		$x=0;
		while($rowxx=mysql_fetch_array($res)){
			$listasa=saldoa($rowxx['cod_cab'],$fecha1,$fecha2,$rowxx['moneda'],number_format($rowxx['total'],2,'.',''),"1");
			$totales=explode("||",$listasa);
			//if($rowxx['cod_cab']=="25816"){
				//print_r($totales);
			//echo "(".number_format($totales[0],2,'.','').">0 && ".number_format($totales[3],2,'.','').">0 && ".$trep."==P)xxxxxx(".number_format($totales[0],2,'.','').">0 && ".number_format($totales[3],2,'.','')."==0 && ".$trep."==C)xxxxxx(".number_format($totales[0],2,'.','').">0 && ".number_format($totales[3],2,'.','').">=0 && ".$trep."==T)"."<br>";
			//}
			if((number_format($totales[0],2,'.','')>0 && number_format($totales[3],2,'.','')>0 && $trep=="P")||(number_format($totales[0],2,'.','')>0 && number_format($totales[3],2,'.','')==0 && $trep=="C")||(number_format($totales[0],2,'.','')>0 && number_format($totales[3],2,'.','')>=0 && $trep=="T")){	
				$cod_ant_cab.="','".$rowxx['cod_cab'];
			}
		}
		$strSQL="select cab_mov.*,razonsocial  from cab_mov inner join cliente on cab_mov.cliente=cliente.codcliente where cod_cab in ('".$cod_ant_cab."') order by concat(razonsocial,f_venc)";
	}else{
		$strSQL_cab="select cab_mov.* from cab_mov inner join detope do on do.documento=cab_mov.cod_ope and do.condicion=cab_mov.condicion inner join operacion op on op.codigo=cab_mov.cod_ope and op.tipo=cab_mov.tipo where cab_mov.tipo='$tipo' and do.deuda='S' and substring(fecha,1,10) <= '$fecha2' and cab_mov.cod_ope NOT IN('NC','TN') and substr(op.p1,5,1)='S' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$filtro6." and flag!='A' order by f_venc asc";
		//$strSQL_cab="select * from cab_mov where cab_mov.tipo='$tipo' and substring(fecha,1,10) <= '$fecha2' and cab_mov.cod_ope NOT IN('NC','TN') and deuda='S' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$filtro6." and flag!='A' order by f_venc asc";
		$res=mysql_query($strSQL_cab,$cn);
		$cod_ant_cab="";
		while($rowxx=mysql_fetch_array($res)){
			$listasa=saldoa($rowxx['cod_cab'],$fecha1,$fecha2,$rowxx['moneda'],number_format($rowxx['total'],2,'.',''),"1");
			$totales=explode("||",$listasa);
			if((number_format($totales[0],2,'.','')>0 && number_format($totales[3],2,'.','')>0 && $trep=="P")||(number_format($totales[0],2,'.','')>0 && number_format($totales[3],2,'.','')==0 && $trep=="C")||(number_format($totales[0],2,'.','')>0 && number_format($totales[3],2,'.','')>=0 && $trep=="T")){
				$cod_ant_cab.="','".$rowxx['cod_cab'];
			}
		}
		$strSQL="select cab_mov.* from cab_mov where cod_cab in ('".$cod_ant_cab."') order by f_venc asc";
	}
	
	$registros = 25; 
	$pagina = $_REQUEST['pagina']; 
	$total_paginas=0;
	if ($pagina=='') { 
		$inicio = 0; 
		$pagina = 1; 
	} else {
		$inicio = ($pagina - 1) * $registros;
	} 
	if(!isset($_REQUEST['excel'])){
		$limit=" LIMIT ".$inicio.",".$registros;
	}else{
		$limit="";
	}
	if($agcliente=="true"){
		$resultados2 = mysql_query($strSQL,$cn);
		$total_registros = mysql_num_rows($resultados2); 
		$textsql =$strSQL.$limit;
	}else{
		$resultados2 = mysql_query($strSQL,$cn);
		$total_registros = mysql_num_rows($resultados2); 
		$textsql = $strSQL.$limit;
	}	
	$total_paginas = ceil($total_registros / $registros); 
	$cant_tfa=0;
	$cant_tbv=0;
	$cant_tanu=0;
	$cant_otros=0;
	$ttbs=0;
	$ttbd=0;
	$ttfs=0;
	$ttfd=0;
	$ttas=0;
	$ttad=0;
	$todvs=0;
	$todvd=0;
	$tgbis=0;
	$tgbid=0;
	$tgigvs=0;
	$tgigvd=0;
	$tgs=0;
	$tactas=0;

	$tactad=0;
	$tcargos=0;
	$tcargod=0;
	$tgd=0;	
	$temcli="";	
	$x=1;
	$txsql=mysql_query($textsql,$cn);
	while($row1=mysql_fetch_array($txsql)){
		$fecha=$row1['fecha'];
		$td=$row1['cod_ope'];
		$documento=$row1['serie']." - ".$row1['Num_doc'];	
		$importe=$row1['b_imp'];
		$igv=$row1['igv'];
		$noperacion=$row1['noperacion'];
		$items=$row1['items'];
		$flag=$row1['flag'];
		$referencia=$row1['cod_cab'];
		$tienda=$row1['tienda'];
		$fvencimiento=substr($row1['f_venc'],0,10);
		$femision=substr($row1['fecha'],0,10);
		$lista_sa=saldoa($referencia,$fecha1,$fecha2,$row1['moneda'],$row1['total'],"1");
		$totales=explode("||",$lista_sa);
		$total=number_format($totales[0],2,'.','');
		$lista_pa=saldoa($referencia,$fecha1,$fecha2,$row1['moneda'],$row1['total'],"2");
		list($cliente)=mysql_fetch_array(mysql_query("select razonsocial from cliente where codcliente='".$row1['cliente']."'"));
		if($agcliente=="s" && $row1['cliente']!=$temcli ){
			if($x>1 ){
				echo $tot;
			}
			$tot=mostrar_total($tipo,$fecha1,$fecha2,$cod_ant_cab,$row1['cliente']);
			$temp="";
			if($tipo=='1'){
				$tempCP=" Proveedor: ";
			}else{
				$tempCP=" Cliente: ";;
			}
			echo "<tr><td colspan='12'><b>".$row1['cliente']."- $tempCP: $cliente</b></td></tr>";
		}
		list($vendedor)=mysql_fetch_array(mysql_query("select usuario from usuarios where codigo=".$row1['cod_vendedor']));
		if($row1['moneda']=='01'){
			$mone="S/.";
		}else{
			$mone="US$.";
		}
		?>
	<tr bgcolor="#F9F9F9" <?php echo $estilo;?> onclick="entrada(this)">
		<?php if(!isset($_REQUEST['excel'])){?>
		<td align="center" ><img style="cursor:pointer" alt="" onclick="doc_det('<?php echo $referencia;?>')" src="../imagenes/ico_lupa.png" width="15" height="15" /></td>
		<td align="center" ><img style="cursor:pointer" alt="" onclick="pago_det('<?php echo $referencia;?>')" src="../imagenes/ico_lupa.png" width="15" height="15" /></td>
		<?php }?>
		<td align="left" ><span class="Estilo10"><?php echo $tienda?></span></td>
		<td align="left" ><span class="Estilo10"><?php echo extraefecha($femision)?></span></td>
		<td align="left" ><span class="Estilo10"><?php echo extraefecha($fvencimiento)?></span></td>
		<td ><span class="Estilo10"><?php echo $td?></span></td>
		<td ><span class="Estilo10"><label for="select"><?php echo $documento?></label></span></td>
		<td ><span class="Estilo10"><?php echo caracteres($cliente)?></span></td>
		<td colspan="2" ><span class="Estilo10"><?php echo $vendedor?></span></td>
		<td align="center"><span class="Estilo10"><?php echo $mone?></span></td>
		<td align="right" ><span class="Estilo10"><?php echo number_format($total,2)?></span></td>
		<td align="right" ><span class="Estilo10">
        <?php 
			echo number_format($totales[1],2,'.','');
		?>
      </span></td>
		<td align="right" ><span class="Estilo10">
        <?php 
			echo number_format($totales[2],2,'.','');
		?>
        </span></td>
		<td align="right" ><span class="Estilo10">
		<?php 
			echo number_format($totales[3],2,'.','');
		?>
		</span></td>
	</tr>
	<?php
	for($xi=0;$xi<count($lista_pa);$xi++){
	?>	
	<tr>
		<td height="24"></td>
		<td></td>
		<td></td>
        <td></td>
		<td bgcolor="#FCFEF5"><?php echo formatofecha($lista_pa[$xi]['fecha'])?></td>
		<td align="center" colspan="2" bgcolor="#FCFEF5"><?php 
		list($tipoPago,$despago)=mysql_fetch_array(mysql_query("select codigo,descripcion from t_pago where id='".$lista_pa[$xi]['t_pago']."'"));
		echo $tipoPago." - ".$despago;
		?></td>
		<td bgcolor="#FCFEF5"><?php echo $lista_pa[$xi]['numero']?></td>
		<td align="center" bgcolor="#FCFEF5"><?php echo $lista_pa[$xi]['tipo'];
				switch($lista_pa[$xi]['tipo']){
					case 'A':echo " - Abono";break;
					case 'C':echo " - Cargo";break;
				}?></td>
		<td align="center" bgcolor="#FCFEF5"><?php if($row1['moneda']!=$lista_pa[$xi]['moneda']) {echo $lista_pa[$xi]['tcambio'];}?></td>
		<td align="center" bgcolor="#FCFEF5"><?php
				if($lista_pa[$xi]['moneda']=='01'){
					echo "S/.";
				}else{
				    echo "US$";
				}
		?></td>
		<td align="right" bgcolor="#FCFEF5"><?php echo number_format($lista_pa[$xi]['monto'],2)?></td>
		<td bgcolor="#FCFEF5" colspan="3"><?php echo $lista_pa[$xi]['obs']?></td>
	</tr>
	<?php
	}
		if($agcliente=="s" && $row1['cliente']!=$temcli ){
			if($x==1){
			}
			$temcli=$row1['cliente'];
			$x++;
		}
	}
	if($agcliente=="s" && $codcliente==""){
		$temtotal="<tr><td colspan='12'>".mostrar_total($tipo,$fecha1,$fecha2,$cod_ant_cab,$temcli)."</td></tr>";
		echo $temtotal;
	}
	function paginar($total_registros,$pagina,$registros){
		$funcion="cargar_detalle";
		if ($pagina=='') { 
			$inicio = 0; 
		} else { 
			$inicio = ($pagina - 1) * $registros; 
		} 
		$total_paginas = ceil($total_registros / $registros);   
		$del=$inicio+1;
		if($total_registros>=($pagina*$registros)){
			$al=$pagina*$registros;
		}else{
			$al=$total_registros;
		}
		echo '<table  border="0" cellpadding="0" cellspacing="0" style=" font-size:12px;font-weight:bold" width="100%"><tr><td  height="30"  >Viendo del '.$del.' al '. $al .'(de '.$total_registros.' registros).</td><td  align="right" >';
		if(($pagina - 1) > 0) { 
			echo "<a style='cursor:pointer' onclick='$funcion($pagina-1)'>< Anterior </a> ";
		}
		for ($i=1; $i<=$total_paginas; $i++){ 
			if ($pagina == $i) {
				echo "<b style='color:#000000'>".$pagina."</b> ";
			} else {
				echo "<a style='cursor:pointer' onclick='javascript:$funcion(".$i.");'>$i</a> ";
			}
		}
		if(($pagina + 1)<=$total_paginas) {
			echo " <a style='cursor:pointer' onclick='$funcion($pagina+1)'>Siguiente ></a>";
		}
		echo '&nbsp;&nbsp;</td></tr></table>';
	}
	
	if($total_paginas==$pagina || isset($_REQUEST['excel'])){
		echo mostrar_total($tipo,$fecha1,$fecha2,$cod_ant_cab,$codcliente);
	}
?>
</table>
<?php 
	function saldoa($referencia,$fecha1,$fecha2,$mone,$tot,$tip){
		$tot_abo=0;
		$tot_car=0;
		$sql=" select * from pagos where referencia='".$referencia."' and fecha<'".$fecha1."'";
		/*if($referencia=="276" and $tip=="1"){
			echo $sql;
		}*/
		$sant=mysql_query($sql);
		while($row66=mysql_fetch_assoc($sant)){
			$mon_pago=$row66['monto'];
			$tca_pago=$row66['tcambio'];
			$mne_pago=$row66['moneda'];
			$temp_pago=0;
			if($mne_pago!=$mone){
				switch($mne_pago){
					case '01':$temp_pago=number_format($mon_pago/$tca_pago,2,'.','');break;
					case '02':$temp_pago=number_format($mon_pago*$tca_pago,2,'.','');break;
				}
			}else{
				$temp_pago=number_format($mon_pago,2,'.','');
			}
			switch($row66['tipo']){
				case 'A':$tot_abo=number_format($tot_abo,2,'.','')+number_format($temp_pago,2,'.','');break;
				case 'C':$tot_car=number_format($tot_car,2,'.','')+number_format($temp_pago,2,'.','');break;
			}
		}
		$saldo_ant=number_format((number_format($tot,2,'.','')+number_format($tot_car,2,'.',''))-number_format($tot_abo,2,'.',''),2,'.','');
		$tot_abo=0;
		$tot_car=0;
		
		$sql=" select * from pagos where referencia='".$referencia."' and fecha between '".$fecha1."' and '".$fecha2."'";
		
		$res=mysql_query($sql);
		while($row66=mysql_fetch_assoc($res)){
			$mon_pago=$row66['monto'];
			$tca_pago=$row66['tcambio'];
			$mne_pago=$row66['moneda'];
			$temp_pago=0;
			/*if($referencia=="25816"){
			echo $mne_pago."!=".$mone;
			}*/
			if($mne_pago!=$mone){
				switch($mne_pago){
					case '01':$temp_pago=number_format($mon_pago/$tca_pago,2,'.','');break;
					case '02':$temp_pago=number_format($mon_pago*$tca_pago,2,'.','');break;
				}
			}else{
				$temp_pago=number_format($mon_pago,2,'.','');
			}
			switch($row66['tipo']){
				case 'A':$tot_abo=number_format($tot_abo,2,'.','')+number_format($temp_pago,2,'.','');break;
				case 'C':$tot_car=number_format($tot_car,2,'.','')+number_format($temp_pago,2,'.','');break;
			}
			$lista[]=$row66;
		}
		$cargos=$tot_car;
		$abonos=$tot_abo;
		$saldo_fin=number_format((number_format($saldo_ant,2,'.','')+number_format($tot_car,2,'.',''))-number_format($tot_abo,2,'.',''),2,'.','');
		if($tip=="1"){
			return $saldo_ant."||".$cargos."||".$abonos."||".$saldo_fin;
		}else{
			return $lista;
		}
	}
	
	function mostrar_total($tipo,$fecha1,$fecha2,$cod_cabx,$where=""){
		if($where!=""){
			$filtrox=" and cliente='".$where."'";
		}else{
			$filtrox="";
		}
		$strSQL="select * from cab_mov where cod_cab in('".$cod_cabx."')".$filtrox." order by cod_cab ";
		$resultado=mysql_query($strSQL);
		$cant_t_s=0;
		$cargos_t_s=0;
		$abonos_t_s=0;
		$total_t_s=0;
		$saldo_t_s=0;
		$cant_t_d=0;
		$cargos_t_d=0;
		$abonos_t_d=0;
		$total_t_d=0;
		$saldo_t_d=0;
		while($row=mysql_fetch_array($resultado)){
			$lista_sa=saldoa($row['cod_cab'],$fecha1,$fecha2,$row['moneda'],$row['total'],"1");
			$totales=explode("||",$lista_sa);
			$total=number_format($totales[0],2,'.','');
			$cargo=number_format($totales[1],2,'.','');
			$abono=number_format($totales[2],2,'.','');
			$saldo=number_format($totales[3],2,'.','');
			switch($row['moneda']){
				case '01':
					$cant_t_s++;
					$total_t_s=number_format($total_t_s,2,'.','')+number_format($total,2,'.','');
					$abonos_t_s=number_format($abonos_t_s,2,'.','')+number_format($abono,2,'.','');
					$cargos_t_s=number_format($cargos_t_s,2,'.','')+number_format($cargo,2,'.','');
					$saldo_t_s=number_format($saldo_t_s,2,'.','')+number_format($saldo,2,'.','');break;
				case '02':
					$cant_t_d++;
					$total_t_d=number_format($total_t_d,2,'.','')+number_format($total,2,'.','');
					$abonos_t_d=number_format($abonos_t_d,2,'.','')+number_format($abono,2,'.','');
					$cargos_t_d=number_format($cargos_t_d,2,'.','')+number_format($cargo,2,'.','');
					$saldo_t_d=number_format($saldo_t_d,2,'.','')+number_format($saldo,2,'.','');break;
			}
		}
		$dattable='<tr>
			<td bgcolor="#F9F9F9"></td>
			<td bgcolor="#F9F9F9"></td>
			<td bgcolor="#F9F9F9"></td>
			<td bgcolor="#F9F9F9"></td>
			<td height="21" colspan="11" bgcolor="#F9F9F9">-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
			</tr><tr>';
		if(!isset($_REQUEST['excel'])){ 
			$dattable.='<td bgcolor="#F9F9F9">&nbsp;</td>
				<td bgcolor="#F9F9F9">&nbsp;</td>
				<td bgcolor="#F9F9F9">&nbsp;</td>
				<td bgcolor="#F9F9F9">&nbsp;</td>
				<td colspan="4" height="21" bgcolor="#F9F9F9">&nbsp;</td>';
		} else {
			$dattable.='<td  bgcolor="#F9F9F9">&nbsp;</td>
				<td bgcolor="#F9F9F9">&nbsp;</td>
				<td bgcolor="#F9F9F9">&nbsp;</td>
				<td bgcolor="#F9F9F9">&nbsp;</td>
				<td bgcolor="#F9F9F9">&nbsp;</td>';
		}
		$dattable.='<td bgcolor="#F9F9F9" colspan="3" align="center"><span class="Estilo7 Estilo33">Total ';
		if($where==""){ $dattable.='General';}
		$dattable.=" S/. (".$cant_t_s.")" ;
		$dattable.='</span></td>
			<td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">';
		$dattable.=number_format($total_t_s,2,'.','');
		//$row_tot['saldos']
		//<td align="right" bgcolor="#F9F9F9" class="Estilo7 Estilo34">'.number_format($GLOBALS['tactas'],2).'</td>
		$dattable.='</span></td>
			<td align="right" bgcolor="#F9F9F9" class="Estilo7 Estilo34">'.number_format($cargos_t_s,2,'.','').'</td>
			<td align="right" bgcolor="#F9F9F9" class="Estilo7 Estilo34">'.number_format($abonos_t_s,2,'.','').'</td>
			<td align="right" bgcolor="#F9F9F9" class="Estilo7 Estilo34">'.number_format($saldo_t_s,2,'.','').'</td>
		</tr>
		<tr>';
		if(!isset($_REQUEST['excel'])){ 
			$dattable.='<td bgcolor="#F9F9F9">&nbsp;</td>
				<td bgcolor="#F9F9F9">&nbsp;</td>
				<td bgcolor="#F9F9F9">&nbsp;</td>
				<td bgcolor="#F9F9F9">&nbsp;</td>
				<td colspan="4" height="21" bgcolor="#F9F9F9">&nbsp;</td>';
		} else {
			$dattable.='<td bgcolor="#F9F9F9">&nbsp;</td>
				<td bgcolor="#F9F9F9">&nbsp;</td>
				<td bgcolor="#F9F9F9">&nbsp;</td>
				<td bgcolor="#F9F9F9">&nbsp;</td>
				<td bgcolor="#F9F9F9">&nbsp;</td>';
		}
		$dattable.=' <td colspan="3" bgcolor="#F9F9F9" align="center"><span class="Estilo7 Estilo33">Total ';
		if($where==""){ $dattable.= "General";}
		$dattable.= " US$.(".$cant_t_d.")" ;
		$dattable.='</span></td>
			<td align="right" bgcolor="#F9F9F9" class="Estilo7 Estilo34">';
			$dattable.=number_format($total_t_d,2,'.','');
			$dattable.='</td><td align="right" bgcolor="#F9F9F9" class="Estilo7 Estilo34">';
			$dattable.=number_format($cargos_t_d,2,'.','');
			$dattable.='</td><td align="right" bgcolor="#F9F9F9" class="Estilo7 Estilo34">';
			$dattable.=number_format($abonos_t_d,2,'.','');
			$dattable.='</td>';
			$dattable.='</td><td align="right" bgcolor="#F9F9F9" class="Estilo7 Estilo34">';
			$dattable.=number_format($saldo_t_d,2,'.','');
			$dattable.='</td>
		</tr>';
		return $dattable;
	}
	if(!isset($_REQUEST['excel'])){
	?>
    |
	<?php paginar($total_registros,$pagina,$registros);?>
	<?php } ?>