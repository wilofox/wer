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
	echo "<center><b><h1>REPORTE DE ESTADO DE CUENTAS POR COBRAR</h1></b></center><table border='0'>";
	echo  "<tr><td width='100'><b>Fecha de:</b></td><td>".$_REQUEST['fecha']." al ".$_REQUEST['fecha2']."</td></tr>";
	if($_REQUEST['sucursal']!="" && $_REQUEST['sucursal']!="0"){
		$dat=mysql_fetch_array(mysql_query("select * from sucursal where cod_suc='".$_REQUEST['sucursal']."'"));
		$suc=$dat['des_suc'];
	}else{
		$suc="Todas";
	}
		echo  "<tr><td><b>Empresa:</b></td><td>$suc</td></tr>";
	if($_REQUEST['almacen']!="" && $_REQUEST['almacen']!="0"){
		$dat=mysql_fetch_array(mysql_query("select * from tienda where cod_tienda='".$_REQUEST['almacen']."'"));
		$t1=$dat['des_tienda'];
	}else{
		$t1="Todas";
	}
		echo  "<tr><td><b>Tienda:</b></td><td>".$t1."</td></tr>";
	if($_REQUEST['vendedor']!="" && $_REQUEST['vendedor']!="000"){
		$dat=mysql_fetch_array(mysql_query("select * from usuarios where codigo='".$_REQUEST['vendedor']."'"));
		$u1=$dat['usuario'];
	}else{
		$u1="Todos";
	}
	echo  "<tr><td><b>Vendedor:</b></td><td>".$u1."</td></tr>";
	if($_REQUEST['turno']!="" && $_REQUEST['turno']!="0"){
		$dat=mysql_fetch_array(mysql_query("select * from turno where id='".$_REQUEST['turno']."'"));
		echo  "<tr><td><b>Turno:</b></td><td>".$dat['abreviatura']."</td></tr>";
	}

	if($_REQUEST['serie']!="" && $_REQUEST['serie']!="000"){
		$dat=mysql_fetch_array(mysql_query("select * from caja where codigo='".$_REQUEST['serie']."'"));
		echo  "<tr><td><b>Serie:</b></td><td>".$dat['descripcion']."</td></tr>";
	}
//echo $_REQUEST['tickets'];
	if($_REQUEST['tickets']=="true"){
//$dat=mysql_fetch_array(mysql_query("select * from tienda where cod_tienda='".$_REQUEST['vendedor']."'"));
		echo  "<tr><td><b>Documentos:</b></td><td>Todos</td></tr>";
	}
	echo "</table><br/>";
}
?>
<table width="896" border="0" cellpadding="1" cellspacing="1" >
	<tr bgcolor="#D6D6D6" style="background:url(../imagenes/bg_contentbase2.gif);  background-position:100% 40%;">
	<?php if(!isset($_REQUEST['excel'])){?>
		<td width="16" height="15"><span class="noprint" >O. </span></td>
		<td width="16"><span class="Estilo7 Estilo15 Estilo35">P. </span></td>
	<?php } ?>
		<td width="44"><span class="Estilo7 Estilo15 Estilo35"><b>Tienda</b></span></td>
		<td width="80"><span class="Estilo7 Estilo15 Estilo35"><b>F. Emi</b></span></td>
		<td width="80"><span class="Estilo7 Estilo15 Estilo35"><b>F. venc</b></span></td>
		<td width="28" ><span class="Estilo7 Estilo15 Estilo35"><b>Doc.</b></span></td>
		<td width="85" ><span class="Estilo7 Estilo15 Estilo35"><b>N. Documento </b></span></td>
		<td width="179"><span class="Estilo7 Estilo15 Estilo35"><b>Cliente</b></span></td>
		<td colspan="2"><span class="Estilo7 Estilo15 Estilo35"><b>Vendedor</b></span></td>
		<td width="60" align="center"><span class="Estilo7 Estilo15 Estilo35"><b>Moneda</b></span></td>
		<td width="63" align="center" ><span class="Estilo7 Estilo15 Estilo35"><b>Total</b></span></td>
		<td width="53" align="right" ><span class="Estilo7 Estilo15 Estilo35"><b>A cta</b></span></td>
		<td width="54" align="right" ><span class="Estilo7 Estilo15 Estilo35"><b>Saldo</b></span></td>
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
		<td width="63" height="15" align="center" bgcolor="#FCFEF5" style="background:url(../imagenes/bg_contentbase2.gif);  background-position:100% 40%;"><span class="Estilo7 Estilo15 Estilo35">T. Ope. </span></td>
		<td width="32" align="center" bgcolor="#FCFEF5" style="background:url(../imagenes/bg_contentbase2.gif);  background-position:100% 40%;"><span class="Estilo7 Estilo15 Estilo35">T. C. </span></td>
		<td style="background:url(../imagenes/bg_contentbase2.gif);  background-position:100% 40%;" height="15" align="center" bgcolor="#FCFEF5"><span class="Estilo7 Estilo15 Estilo35">Moneda</span></td>
		<td style="background:url(../imagenes/bg_contentbase2.gif);  background-position:100% 40%;" height="15" bgcolor="#FCFEF5"><span class="Estilo7 Estilo15 Estilo35">Importe</span></td>
		<td style="background:url(../imagenes/bg_contentbase2.gif);  background-position:100% 40%;" height="15" bgcolor="#FCFEF5" colspan="2"><span class="Estilo7 Estilo15 Estilo35">Observaciones</span></td>
	</tr>
	<?php }
			//-------------------------------------------
	$fecha1=extraefecha($_REQUEST['fecha']);
	$fecha2=extraefecha($_REQUEST['fecha2']);
	$sucursal=$_REQUEST['sucursal'];
	$tienda=$_REQUEST['almacen'];
	$tipo=$_REQUEST['tipo'];
						
	$tot_importe=0;
	$tot_igv=0;
	$tot_tot=0;
	$tot_item=0;
			
	//echo $_REQUEST['tickets2'];
			
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
	if($_REQUEST['tickets']=='false' and $tipo=='2'){
		//$filtro4=" and ( cod_ope='TB' or cod_ope='TF' ) ";
		//echo $_REQUEST['doc_cancel'];
		if($_REQUEST['doc_cancel']=='S'){
			$filtro4=" and deuda='S' and saldo=0 ";
		}else{
			$filtro4=" and deuda='S' and saldo>0 ";
		}
	}else{
		$filtro4=" and deuda='S' ";
		if($_REQUEST['tickets2']!="S"){
			if($_REQUEST['doc_cancel']=='S'){
				$filtro4="and saldo=0 ";
			}
			if($_REQUEST['doc_cancel2']=='S'){
				$filtro4.=" and saldo>0 ";
			}
		}
		//$filtro4=" and deuda='S' ";
	}			
	if($sucursal==0){
		$filtro5="";
	}else{
		if($tienda==0){
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
	$agcliente=$_REQUEST['acliente'];
	/*if($agcliente=="true"){
		$group=" group by  codcli";
	}else{
		$group="";
	}*/
	/*
	$cant_tfa=0;
	$tot_tfa=0;
	$cant_tfa=0;
	$cant_tbv=0;
	$tot_tbv=0;
	$cant_tfa=0;
	$cant_tbv=0;
	$cant_tanu=0;
	$total_tanu=0;
	$cant_tfa=0;
	$cant_tbv=0;
	$cant_tanu=0;
	$cant_otros=0;
	$tot_otros=0;
	*/
	//echo $_REQUEST['doc_credit'];
	if($_REQUEST['doc_credit']=="S"){
		$filtro6.=" and cab_mov.condicion in(Select condicion from detope where documento=cab_mov.cod_ope and deuda='S')";
	}
	if($agcliente=="true"){		
	//$strSQL="select distinct(cliente) from cab_mov where tipo='$tipo' and substring(fecha,1,10) between '$fecha1' and '$fecha2' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$filtro6." order by f_venc asc";
		$strSQL="select *,razonsocial  from cab_mov inner join cliente on cab_mov.cliente=cliente.codcliente where tipo='$tipo'  and substring(fecha,1,10) between '$fecha1' and '$fecha2' and cab_mov.cod_ope!='NC' and cab_mov.cod_ope!='TN' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$filtro6." and flag!='A' order by razonsocial asc,f_venc asc";
	}else{
		$strSQL="select * from cab_mov where tipo='$tipo' and substring(fecha,1,10) between '$fecha1' and '$fecha2' and cab_mov.cod_ope!='NC' and cab_mov.cod_ope!='TN' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$filtro6."  and flag!='A'  order by f_venc asc";
		//echo $strSQL;
	}		
	$registros = 25; 
	$pagina = $_REQUEST['pagina']; 
	$total_paginas=0;
	//	echo "pag".$pagina;
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
	//	echo $strSQL.$limit;
	if($agcliente=="true"){
		//echo $strSQL;	
		$resultados2 = mysql_query($strSQL,$cn);
		$total_registros = mysql_num_rows($resultados2); 
		$textsql =$strSQL.$limit;
		// echo mysql_num_rows($resultados);
	}else{
		//echo $strSQL;
		$resultados2 = mysql_query($strSQL,$cn);
		$total_registros = mysql_num_rows($resultados2); 
		$textsql = $strSQL.$limit;
	}	
	$total_paginas = ceil($total_registros / $registros);  
	//echo $strSQL." LIMIT $inicio, $registros ";
	// $resultados = mysql_query($strSQL,$cn);
	//$resultados2 =mysql_num_rows($resultados); 
	//$total_paginas = ceil($total_registros / $registros);  
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
	//$GLOBALS['tactas']="150";
	function muestra_datos($datos,$ag=""){	
		$datosx=mysql_query($datos);
		$temcli="";	
		$x=1;
		$tregistro=mysql_num_rows($datosx);
		while($row=mysql_fetch_array($datosx)){
			$fecha=$row['fecha'];
			$td=$row['cod_ope'];
			$documento=$row['serie']." - ".$row['Num_doc'];	
			$importe=$row['b_imp'];
			$igv=$row['igv'];
			$total=$row['total']+$row['percepcion'];
			$noperacion=$row['noperacion'];
			$items=$row['items'];
			$flag=$row['flag'];
			$referencia=$row['cod_cab'];
			$tienda=$row['tienda'];
			$fvencimiento=substr($row['f_venc'],0,10);
			$femision=substr($row['fecha'],0,10);
			list($cliente)=mysql_fetch_array(mysql_query("select razonsocial from cliente where codcliente='".$row['cliente']."'"));
			if($ag=="s" && $row['cliente']!=$temcli ){
				if($x>1 ){//&& $tregistro==$x 
					//$mos=$tot;
					//echo $mos;
					echo $tot;
				}
				$tot=mostrar_total($GLOBALS['tipo'],$GLOBALS['fecha1'],$GLOBALS['fecha2'],$GLOBALS['filtro1'],$GLOBALS['filtro2'],$GLOBALS['filtro3'],$GLOBALS['filtro4'],$GLOBALS['filtro5'],$GLOBALS['filtro6'],$row['cliente']);
				$temp="";
				if($_REQUEST['tipo']=='1'){
					$tempCP=" Proveedor: ";
				}else{
					$tempCP=" Cliente: ";;
				}
				echo "<tr><td colspan='12'><b>".$row['cliente']."- $tempCP: $cliente</b></td></tr>";
				//$ult=mysql_query("")
			}else{
				//$tot="";
			}
			list($vendedor)=mysql_fetch_array(mysql_query("select usuario from usuarios where codigo=".$row['cod_vendedor']));
			if($row['moneda']=='01'){
				$mone="S/.";
			}else{
				$mone="US$.";
			}
			if($flag!='A'){
				/*
				$tot_importe=$tot_importe+$importe;
				$tot_igv=$tot_igv+$igv;
				$tot_tot=$tot_tot+$total;	
				$tot_item=$tot_item+$items;
				*/
				$tot_item=$tot_item+$items;
				if($row['moneda']=='01'){
					$tgs=$tgs+$total;
					$tgbis=$importe+$tgbis;
					$tgigbs=$igv+$tgigbs;
				}else{
					$tgd=$tgd+$total;
					$tgbid=$importe+$tgbid;
					$tgigbd=$igv+$tgigbd;
				}
				if($td=='TB'){
					$cant_tbv=$cant_tbv+1;
					if($row['moneda']=='01'){
						$ttbs=$ttbs+$total;
						//$tot_tbv=$tot_tbv+$total;
					}else{
						$ttbd=$ttbd+$total;
					}
				}else{
					if($td=='TF'){
						$cant_tfa=$cant_tfa+1;
						if($row['moneda']=='01'){	
							$ttfs=$ttfs+$total;
						}else{
							$ttfd=$ttfd+$total;
						}
					}else{
						$cant_otros++;
						if($row['moneda']=='01'){
							//$tot_otros=$tot_otros+$total;
							$todvs=$todvs+$total;
						}else{
							$todvd=$todvd+$total;
						}
					}
				}
				$estilo="";
				if($_REQUEST['tickets2']=="S"){
					$f2=formatofecha($_REQUEST['fecha2']);
					$lista_sa=saldoa($referencia,$f2,$row['moneda'],$row['total'],"1");
					$lista=saldoa($referencia,$f2,$row['moneda'],$row['total'],"2");
					if($lista_sa==0.00){
						$estilo="style='visibility:none'";
					}
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
					if($_REQUEST['tickets2']!="S"){
						$sql2="Select * from pagos where referencia='".$row['cod_cab']."'";
						$con2=mysql_query($sql2);
						$acta=0;
						while($row22=mysql_fetch_array($con2)){
							$acta2=0;
							if($row22['tipo']=="A"){
								if($row['moneda']!=$row22['moneda']){
									switch($row22['moneda']){
										case '01':$acta2=$acta2+number_format($row22['monto']/$row22['tcambio'],2,'.','');break;
										case '02':$acta2=$acta2+number_format($row22['monto']*$row22['tcambio'],2,'.','');break;
									}
								}else{
									$acta2=$acta2+number_format($row22['monto'],2,'.','');
								}
								switch($row['moneda']){
									case '01':$GLOBALS['tactas']=$GLOBALS['tactas']+number_format($acta2,2,'.','');$acta=$acta+number_format($acta2,2,'.','');break;
									case '02':$GLOBALS['tactad']=$GLOBALS['tactad']+number_format($acta2,2,'.','');$acta=$acta+number_format($acta2,2,'.','');break;
								}
							}
						}
						echo number_format($acta,2);
					}else{
						if(is_array($lista)){
							$acta=0;
							for($i=0;$i<count($lista);$i++){
								$acta2=0;
								if($lista[$i]['tipo']=="A"){
									if($row['moneda']!=$lista[$i]['moneda']){
										switch($lista[$i]['moneda']){
											case '01':$acta2=$acta2+number_format($lista[$i]['monto']/$lista[$i]['tcambio'],2,'.','');break;
											case '02':$acta2=$acta2+number_format($lista[$i]['monto']*$lista[$i]['tcambio'],2,'.','');break;
										}
									}else{
										$acta2=$acta2+number_format($lista[$i]['monto'],2,'.','');
									}
									switch($row['moneda']){
										case '01':$GLOBALS['tactas']=$GLOBALS['tactas']+number_format($acta2,2,'.','');$acta=$acta+number_format($acta2,2,'.','');break;
										case '02':$GLOBALS['tactad']=$GLOBALS['tactad']+number_format($acta2,2,'.','');$acta=$acta+number_format($acta2,2,'.','');break;
									}
								}
							}
							echo number_format($acta,2,'.','');
						}else{
							echo "0.00";
						}
					}
				?>
		</span></td>
		<td align="right" ><span class="Estilo10">
				<?php 
					if($_REQUEST['tickets2']!="S"){
						echo number_format($row['saldo'],2);
					}else{
						echo number_format($lista_sa,2);
					}
				?>
		</span></td>
				<?php /* <td align="center" ><span class="Estilo10"><?php echo $noperacion?></span></td>
		if($row['moneda']=='01'){*/
				?>
	</tr>
				<?php 
					if($_REQUEST['tickets2']!="S"){
						$strSQL12=" select * from pagos where referencia='".$referencia."'";
						$resultado12=mysql_query($strSQL12);
						$temPagos=mysql_num_rows($resultado12);
						if(($temPagos>0 && $_REQUEST['formato']=='D')){
							while($row12=mysql_fetch_array($resultado12)){
						?>
	<tr>
		<td height="24"></td>
		<td></td>
		<td></td>
        <td></td>
		<td bgcolor="#FCFEF5"><?php echo formatofecha($row12['fecha'])?></td>
		<td align="center" colspan="2" bgcolor="#FCFEF5"><?php 
								list($tipoPago,$despago)=mysql_fetch_array(mysql_query("select codigo,descripcion from t_pago where id='".$row12['t_pago']."'"));
								echo $tipoPago." - ".$despago;
		?></td>
		<td bgcolor="#FCFEF5"><?php echo $row12['numero']?></td>
		<td align="center" bgcolor="#FCFEF5"><?php echo $row12['tipo'];
								switch($row12['tipo']){
									case 'A':echo " - Abono";break;
									case 'C':echo " - Cargo";break;
								}?></td>
		<td align="center" bgcolor="#FCFEF5"><?php if($row['moneda']!=$row12['moneda']) {echo $row12['tcambio'];}?></td>
		<td align="center" bgcolor="#FCFEF5"><?php
								if($row12['moneda']=='01'){
									echo "S/.";
								}else{
								    echo "US$";
								}
		?></td>
		<td align="right" bgcolor="#FCFEF5"><?php echo number_format($row12['monto'],2)?></td>
		<td bgcolor="#FCFEF5" colspan="2"><?php echo $row12['obs']?></td>
	</tr>
						<?php 
							}
						}
					}else{
						if((count($lista)>0 && $_REQUEST['formato']=='D')){
							for($i=0;$i<count($lista);$i++){ ?>
	<tr>
		<td height="24"></td>
		<td></td>
		<td></td>
        <td></td>
		<td width="80" bgcolor="#FCFEF5"><?php echo $lista[$i]['fechap']?></td>
		<td width="28" align="center" bgcolor="#FCFEF5"><?php 
								list($tipoPago)=mysql_fetch_array(mysql_query("select codigo from t_pago where id='".$lista[$i]['t_pago']."'"));
								echo $tipoPago;
		?></td>
		<td width="85" bgcolor="#FCFEF5"><?php echo $lista[$i]['numero']?></td>
		<td width="179" align="center" bgcolor="#FCFEF5"><?php echo $lista[$i]['tipo']?></td>
		<td colspan="2" align="center" bgcolor="#FCFEF5"><?php
								if($lista[$i]['moneda']=='01'){
									echo "S/.";
								}else{
									echo "US$";
								}
		?></td>
		<td width="60" align="right" bgcolor="#FCFEF5"><?php echo number_format($lista[$i]['monto'],2)?></td>
		<td width="63" bgcolor="#FCFEF5"><?php echo $lista[$i]['obs']?></td>
						<?php }?>
	</tr>
					<?php
                    	}
					}
					if($ag=="s" && $row['cliente']!=$temcli ){
						if($x==1){
							//$mos=$tot;
							//echo $mos;
							//echo $tot;
						}
						//$tot="<tr><td colspan='12'></td></tr><tr><td colspan='12'>". mostrar_total($GLOBALS['tipo'],$GLOBALS['fecha1'],$GLOBALS['fecha2'],$filtro1,$filtro2,$filtro3,$filtro4,$filtro5,$row['cliente'])."</td></tr>";
				//mostrar_total($tipo,$fecha1,$fecha2,$filtro1,$filtro2,$filtro3,$filtro4,$filtro5,$row['cliente']).
				
						$temcli=$row['cliente'];
						$x++;
					}
			}
		}
		if($ag=="s" && 	$GLOBALS['codcliente']==""){
			$temtotal="<tr><td colspan='12'>".mostrar_total($GLOBALS['tipo'],$GLOBALS['fecha1'],$GLOBALS['fecha2'],$GLOBALS['filtro1'],$GLOBALS['filtro2'],$GLOBALS['filtro3'],$GLOBALS['filtro4'],$GLOBALS['filtro5'],$GLOBALS['filtro6'],$temcli)."</td></tr>";
			echo $temtotal;
		}
	}
	
	function paginar($total_registros,$pagina,$registros){
		//echo  $total_registros;
		//PAGINACION 1	
		//$registros =3; 
		// $pagina = $_REQUEST['pagina']; 
		// echo $pagina;
		//$total_paginas;
		$funcion="cargar_detalle";
		if ($pagina=='') { 
			$inicio = 0; 
			//	$pagina = 1; 
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
			//$inicio = ($i - 1) * $registros; 
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
	
	if($agcliente=="true"){	
		$tot=0;$x=1;
			//$resultados=mysql_query($textsql);
				/*while($row=mysql_fetch_array($resultados)){
				$sqlx="select * from cab_mov where tipo='$tipo' and substring(fecha,1,10) between '$fecha1' and '$fecha2' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5." and cliente='".$row['cliente']."' order by f_venc asc";
				
				list($clientex)=mysql_fetch_array(mysql_query("select razonsocial from cliente where codcliente=".$row['cliente']));
				echo "<tr><td colspan='12'><b>".$x++.".-cliente:$clientex</b></td></tr>";
				$result=mysql_query($sqlx);
				$tot+=mysql_num_rows($result);
		
				muestra_datos($sqlx);
					echo "<tr><td colspan='12'>";
				mostrar_total($tipo,$fecha1,$fecha2,$filtro1,$filtro2,$filtro3,$filtro4,$filtro5,$row['cliente']);
				echo "</td></tr>";
					
				}*/
		muestra_datos($textsql,"s");
	//$total_registros=$tot;
	}else{
		muestra_datos($textsql);
	}
	if($GLOBALS['total_paginas']==$GLOBALS['pagina'] || isset($_REQUEST['excel'])){
		echo mostrar_total($tipo,$fecha1,$fecha2,$filtro1,$filtro2,$filtro3,$filtro4,$filtro5,$filtro6,$codcliente);
	}
?>
</table>
<?php 
	function saldoa($referencia,$fecha2,$mone,$tot,$tip){
		$tot_abo=0;
		$tot_car=0;
		$sql=" select * from pagos where referencia='".$referencia."' and fecha<='".$fecha2."'";
		$res=mysql_query($sql);
		//$i=0;
		while($row=mysql_fetch_assoc($res)){
			$mon_pago=$row['monto'];
			$tca_pago=$row['tcambio'];
			$mne_pago=$row['moneda'];
			$temp_pago=0;
			if($mne_pago!=$mone){
				switch($mne_pago){
					case '01':$temp_pago=number_format($mon_pago/$tca_pago,2,'.','');break;
					case '02':$temp_pago=number_format($mon_pago*$tca_pago,2,'.','');break;
				}
			}else{
				$temp_pago=number_format($mon_pago,2,'.','');
			}
			switch($row['tipo']){
				case 'A':$tot_abo=number_format($tot_abo,2,'.','')+number_format($temp_pago,2,'.','');break;
				case 'C':$tot_car=number_format($tot_car,2,'.','')+number_format($temp_pago,2,'.','');break;
			}
			//$i=$i+1;
			$lista[]=$row;
		}
		$saldo=number_format((number_format($tot,2,'.','')+number_format($tot_car,2,'.',''))-number_format($tot_abo,2,'.',''),2,'.','');
		if($tip=="1"){
			return $saldo;
		}else{
			return $lista;
		}
	}
	
	function mostrar_total($tipo,$fecha1,$fecha2,$filtro1,$filtro2,$filtro3,$filtro4,$filtro5,$filtro6,$where=""){
		if($where!=""){
			$filtrox=" and cliente='".$where."'";
		}else{
			$filtrox="";
		}
		//echo $total_paginas."==".$pagina;
		// if($total_paginas==$pagina){
		if($tipo=='2'){
			$strSQL="select sum(total) as total,count(cod_cab) as cantidad from cab_mov where tipo='$tipo' and flag!='A' and substring(fecha,1,10) between '$fecha1'  and '$fecha2' ".$filtro1.$filtro2.$filtro3." and flag!='A' and cod_ope='TB' and cod_ope!='TN' and cod_ope!='NC' ".$filtro5.$filtro6.$filtrox." order by cod_cab ";
			$resultado=mysql_query($strSQL);
			$row=mysql_fetch_array($resultado);
			$cant_tb=$row['cantidad'];
			$total_tb=$row['total'];
			//echo $strSQL;
			
			$strSQL="select sum(total) as total,count(cod_cab) as cantidad from cab_mov where tipo='$tipo' and flag!='A' and substring(fecha,1,10) between '$fecha1' and '$fecha2' ".$filtro1.$filtro2.$filtro3." and flag!='A' and cod_ope!='TN' and cod_ope!='NC' and cod_ope='TF' ".$filtro5.$filtro6.$filtrox." order by cod_cab ";//" and cod_ope='TF' "
			//echo $strSQL;
			$resultado=mysql_query($strSQL);
			$row=mysql_fetch_array($resultado);
			$cant_tf=$row['cantidad'];
			$total_tf=$row['total'];
		}
		$strSQL_tot="SELECT SUM(IF(moneda='01',total+percepcion,0)) AS totals, SUM(IF(moneda='02',total+percepcion,0)) AS totald, SUM(IF(moneda='01',items,0)) AS items, SUM(IF(moneda='02',items,0)) AS itemd, SUM(IF(moneda='01',1,0)) AS cantidads, SUM(IF(moneda='02',1,0)) AS cantidadd, SUM(IF(moneda='01',b_imp,0)) AS bases, SUM(IF(moneda='02',b_imp,0)) AS based, SUM(IF(moneda='01',igv,0)) AS igvs, SUM(IF(moneda='02',igv,0)) AS igvd, SUM(IF(moneda='01',saldo,0)) AS saldos, SUM(IF(moneda='02',saldo,0)) AS saldod FROM cab_mov where tipo='$tipo' and flag!='A' and substring(fecha,1,10) between '$fecha1' and '$fecha2' and cod_ope!='TN' and cod_ope!='NC' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$filtro6.$filtrox." order by cod_cab";
		// echo $strSQL_tot;
		$resultado=mysql_query($strSQL_tot);
		$row_tot=mysql_fetch_array($resultado);
		//  $dattable='<table width="936" border="0">
		$strSQL_pagos="SELECT cab_mov.moneda as mone_doc, pa.moneda as mone_pag, pa.monto as monto, pa.tcambio as tca, pa.tipo as tipo FROM cab_mov inner join pagos pa on pa.referencia=cab_mov.cod_cab where cab_mov.tipo='$tipo' and cab_mov.flag!='A' and substring(cab_mov.fecha,1,10) between '$fecha1' and '$fecha2' and cod_ope!='TN' and cod_ope!='NC' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$filtro6.$filtrox." order by cab_mov.cod_cab";
		$rs_pagos=mysql_query($strSQL_pagos);
		$total_ab_s=0;
		$total_ab_d=0;
		while($row_pa=mysql_fetch_array($rs_pagos)){
			$monto_pa=0;
			if($row_pa['tipo']=="A"){
				if($row_pa['mone_doc']!=$row_pa['mone_pag']){
					switch($row_pa['mone_pag']){
						case '01':$monto_pa=number_format($row_pa['monto']/$row_pa['tca'],2,'.','');break;
						case '02':$monto_pa=number_format($row_pa['monto']*$row_pa['tca'],2,'.','');break;
					}
				}else{
					$monto_pa=number_format($row_pa['monto'],2,'.','');
				}
				switch($row_pa['mone_doc']){
					case '01':$total_ab_s=number_format($monto_pa,2,'.','')+number_format($total_ab_s,2,'.','');break;
					case '02':$total_ab_d=number_format($monto_pa,2,'.','')+number_format($total_ab_d,2,'.','');break;
				}
			}
		}
		$dattable='<tr>
			<td bgcolor="#F9F9F9"></td>
			<td bgcolor="#F9F9F9"></td>
			<td bgcolor="#F9F9F9"></td>
			<td bgcolor="#F9F9F9"></td>
			<td height="21" colspan="10" bgcolor="#F9F9F9">-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
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
		$dattable.=" S/. (".$row_tot['cantidads'].")" ;
		$dattable.='</span></td>
			<td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">';
		$dattable.=number_format($row_tot['totals'],2,'.','');
		//$row_tot['saldos']
		//<td align="right" bgcolor="#F9F9F9" class="Estilo7 Estilo34">'.number_format($GLOBALS['tactas'],2).'</td>
		$dattable.='</span></td>
			<td align="right" bgcolor="#F9F9F9" class="Estilo7 Estilo34">'.number_format($total_ab_s,2,'.','').'</td>
			<td align="right" bgcolor="#F9F9F9" class="Estilo7 Estilo34">'.number_format(number_format($row_tot['totals'],2,'.','')-number_format($total_ab_s,2,'.',''),2,'.','').'</td>
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
		$dattable.= " US$.(".$row_tot['cantidadd'].")" ;
		$dattable.='</span></td>
			<td align="right" bgcolor="#F9F9F9" class="Estilo7 Estilo34">';
			$dattable.=number_format($row_tot['totald'],2,'.','');
			$dattable.='</td><td align="right" bgcolor="#F9F9F9" class="Estilo7 Estilo34">';
			$dattable.=number_format($total_ab_d,2,'.','');
			$dattable.='</td><td align="right" bgcolor="#F9F9F9" class="Estilo7 Estilo34">';
			$dattable.=number_format(number_format($row_tot['totald'],2,'.','')-number_format($total_ab_d,2,'.',''),2,'.','');
			$dattable.='</td>
		</tr>';
		//$dattable.='</table>';
		//$GLOBALS['total_paginas']=5;
		//echo $GLOBALS['total_paginas']."==".$GLOBALS['pagina'];
		//if($GLOBALS['total_paginas']==$GLOBALS['pagina']){
		return $dattable;
	//}
	}
	if(!isset($_REQUEST['excel'])){
	?>
    |
	<?php paginar($total_registros,$pagina,$registros);?>
	<?php } ?>