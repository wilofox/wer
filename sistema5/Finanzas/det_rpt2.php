<style type="text/css">
<!--
.Estilo10 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo15 {color: #FFFFFF}
.Estilo33 {color: #000066}
.Estilo34 {color: #003399}
.Estilo35 {font-size: 11px}
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.anulado {text-decoration:line-through;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#990000; }
-->
</style>
<table width="855" border="0" cellpadding="1" cellspacing="1" >
  <tr style="background:url(imagenes/bg_contentbase2.gif);  background-position:100% 40%;">
    <td width="16">&nbsp;</td>
    <td width="142" height="18" ><span class="Estilo7 Estilo15 Estilo35">Fecha Canc. </span></td>
    <td width="29" ><span class="Estilo7 Estilo15 Estilo35">Doc.</span></td>
    <td width="172" ><span class="Estilo7 Estilo15 Estilo35">Nro. Documento </span></td>
    <td width="77" align="center"><span class="Estilo7 Estilo15 Estilo35">Items</span></td>
    <td width="51" align="center" ><span class="Estilo7 Estilo15 Estilo35">Moneda</span></td>
    <td width="79" align="center" ><span class="Estilo7 Estilo15 Estilo35">Importe</span></td>
    <td width="68" align="right" ><span class="Estilo7 Estilo15 Estilo35">IGV</span></td>
    <td width="78" align="right" ><span class="Estilo7 Estilo15 Estilo35">Total</span></td>
    <td width="112" align="right" ><span class="Estilo7 Estilo15 Estilo35">Nro.Operaci&oacute;n</span></td>
  </tr>
  <?php 
		    include('conex_inicial.php');
			include ('funciones/funciones.php');
			//-------------------------------------------
			
			
					   $registros = 100; 
					   $pagina = $_REQUEST['pagina']; 
					   
					   
			//	echo "pag".$pagina;
		
				if ($pagina=='') { 
				$inicio = 0; 
				$pagina = 1; 

				} else { 
				$inicio = ($pagina - 1) * $registros; 
				} 
			
  			
			$fecha1=$_REQUEST['fecha'];
			$fecha2=$_REQUEST['fecha2'];
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
			//$fecha=date('d/m/Y');
			
			$filtro3=" and substring(fecha,12,9) between '$hinicio' and '$hfin' ";
			
			}else{
			$filtro3="";
			}			
			
			//echo $_REQUEST['tickets']."<br>"; 
			if($_REQUEST['tickets']=='false' and $tipo=='2'){
			//$filtro4=" and ( cod_ope='TB' or cod_ope='TF' ) ";
			$filtro4=" and deuda='S' ";
			}else{
			$filtro4='';
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
			
					
			$strSQL="select * from cab_mov where tipo='$tipo' and substring(fecha,1,10) between '$fecha1' and '$fecha2' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5." order by cod_cab ";
					
			//echo $strSQL;
			
			  $resultados = mysql_query($strSQL,$cn);
			  $total_registros = mysql_num_rows($resultados); 
			  $resultados = mysql_query($strSQL." LIMIT $inicio, $registros " ,$cn);
					
	//echo $strSQL." LIMIT $inicio, $registros ";
			  $resultados2 =mysql_num_rows($resultados); 
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
			$tgd=0;			
			while($row=mysql_fetch_array($resultados)){
			
			$fecha=$row['fecha'];
			$td=$row['cod_ope'];
			$documento=$row['serie']." - ".$row['Num_doc'];	
			$importe=$row['b_imp'];
			$igv=$row['igv'];
			$total=$row['total'];
			$noperacion=$row['noperacion'];
			$items=$row['items'];
			$flag=$row['flag'];
			$referencia=$row['cod_cab'];
			
			if($row['Moneda']=='01'){
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
			if($row['Moneda']=='01'){
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
				if($row['Moneda']=='01'){
					$ttbs=$ttbs+$total;
					//$tot_tbv=$tot_tbv+$total;
				}else{
					$ttbd=$ttbd+$total;
				}
			}else{
				if($td=='TF'){
				$cant_tfa=$cant_tfa+1;
					if($row['Moneda']=='01'){	
						$ttfs=$ttfs+$total;
					}else{
						$ttfd=$ttfd+$total;
					}
				}else{
				$cant_otros++;
					if($row['Moneda']=='01'){
						//$tot_otros=$tot_otros+$total;
						$todvs=$todvs+$total;
					}else{
						$todvd=$todvd+$total;
					}
				}
			}
			?>
  <tr bgcolor="#F9F9F9" onClick="entrada(this)">
    <td align="center" ><img style="cursor:pointer" alt="" onClick="doc_det('<?php echo $referencia;?>')" src="imagenes/ico_lupa.png" width="15" height="15"></td>
    <td ><span class="Estilo10"><?php echo $fecha?></span></td>
    <td ><span class="Estilo10"><?php echo $td?></span></td>
    <td ><span class="Estilo10">
      <label for="select"><?php echo $documento?></label>
    </span></td>
    <td align="center"><span class="Estilo10"><?php echo $items?></span></td>
    <td align="center" ><span class="Estilo10"><?php echo $mone?></span></td>
    <td align="right" ><span class="Estilo10"><?php echo $importe?></span></td>
    <td align="right" ><span class="Estilo10"><?php echo $igv?></span></td>
    <td align="right" ><span class="Estilo10"><?php echo number_format($total,2)?></span></td>
    <td align="center" ><span class="Estilo10"><?php echo $noperacion?></span></td>
    <?php /*
	if($row['moneda']=='01'){*/
	?>
  </tr>
  <?php 
			
		}else{
			$cant_tanu=$cant_tanu+1;
			if($row['Moneda']=='01'){
				//$total_tanu=$total_tanu+$total;
				$ttas=$ttas+$total;
			}else{
				$ttad=$ttad+$total;
			}
		?>
  <tr bgcolor="#F9F9F9" onClick="entrada(this)">
    <td align="center" ><img style="cursor:pointer" onClick="doc_det('<?php echo $referencia;?>')" src="imagenes/ico_lupa.jpg" width="15" height="15"></td>
    <td ><span class="anulado"><?php echo $fecha?></span></td>
    <td ><span class="anulado"><?php echo $td?></span></td>
    <td ><span class="anulado">
      <label for="select"><?php echo $documento?></label>
    </span></td>
    <td align="center" ><span class="anulado"><?php echo $items?></span></td>
    <td align="center" ><span class="anulado"><?php echo $mone?></span></td>
    <td align="right" ><span class="anulado"><?php echo $importe?></span></td>
    <td align="right" ><span class="anulado"><?php echo $igv?></span></td>
    <td align="right" ><span class="anulado"><?php echo number_format($total,2)?></span></td>
    <td align="center" ><span class="anulado"><?php echo $noperacion?></span></td>
  </tr>
  <?php 
		}}
			?>
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
  <?php 
  if($total_paginas==$pagina){
  		if($tipo=='2'){
		
	     	
			$strSQL="select sum(total) as total,count(cod_cab) as cantidad from cab_mov where tipo='$tipo' and flag!='A' and substring(fecha,1,10) between '$fecha1'  and '$fecha2' ".$filtro1.$filtro2.$filtro3." and cod_ope='TB' ".$filtro5." order by cod_cab ";
			$resultado=mysql_query($strSQL,$cn);
			$row=mysql_fetch_array($resultado);
			$cant_tb=$row['cantidad'];
			$total_tb=$row['total'];
			
			//	echo $strSQL;
			
			$strSQL="select sum(total) as total,count(cod_cab) as cantidad from cab_mov where tipo='$tipo' and flag!='A' and substring(fecha,1,10) between '$fecha1' and '$fecha2' ".$filtro1.$filtro2.$filtro3." and cod_ope='TF' ".$filtro5." order by cod_cab ";
			$resultado=mysql_query($strSQL,$cn);
			$row=mysql_fetch_array($resultado);
			$cant_tf=$row['cantidad'];
			$total_tf=$row['total'];
			
			
			
			
			
  
  ?>
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9"><strong>Total Ticket Boleta&nbsp;&nbsp; (<?php echo $cant_tb; ?>) </strong></td>
    <td align="center" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">S/.</td>
    <td align="right" bgcolor="#F9F9F9"><strong><?php /*echo number_format($total_tb,2);*/echo number_format($ttbs,2); ?></strong></td>
    <td align="right" bgcolor="#F9F9F9">US$.</td>
    <td align="right" bgcolor="#F9F9F9"><strong><?php echo number_format($ttbd,2); ?></strong></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9"><strong>Total Ticket factura&nbsp;&nbsp; (<?php echo $cant_tf; ?>) </strong></td>
    <td align="center" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">S/.</td>
    <td align="right" bgcolor="#F9F9F9"><strong><?php echo number_format($ttfs,2); ?></strong></td>
    <td align="right" bgcolor="#F9F9F9">US$.</td>
    <td align="right" bgcolor="#F9F9F9"><strong><?php /*echo number_format($total_tf,2);*/echo number_format($ttfd,2); ?></strong></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9"><strong> Ticket Anulados&nbsp; (<?php echo $cant_tanu; ?>) </strong></td>
    <td align="center" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">S/.</td>
    <td align="right" bgcolor="#F9F9F9"><strong><?php /*echo number_format($total_tanu,2);*/echo number_format($ttas,2); ?></strong></td>
    <td align="right" bgcolor="#F9F9F9">US$.</td>
    <td align="right" bgcolor="#F9F9F9"><strong><?php /*echo number_format($total_tanu,2);*/echo number_format($ttad,2); ?></strong></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9"><strong>Otros Doc. Ventas &nbsp; (<?php echo $cant_otros; ?>) </strong></td>
    <td align="center" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9">S/.</td>
    <td align="right" bgcolor="#F9F9F9"><strong><?php /*echo number_format($tot_otros,2);*/echo number_format($todvs,2); ?></strong></td>
    <td align="right" bgcolor="#F9F9F9">US$.</td>
    <td align="right" bgcolor="#F9F9F9"><strong><?php echo number_format($todvd,2); ?></strong></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
  <?php }?>
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td colspan="7" bgcolor="#F9F9F9">-------------------------------------------------------------------------------------------------------------</td>
  </tr>
  <?php 
  
  $strSQL_tot="SELECT SUM(IF(moneda='01',total,0)) AS totals, SUM(IF(moneda='02',total,0)) AS totald, SUM(IF(moneda='01',items,0)) AS items, SUM(IF(moneda='02',items,0)) AS itemd, SUM(IF(moneda='01',1,0)) AS cantidads, SUM(IF(moneda='02',1,0)) AS cantidadd, SUM(IF(moneda='01',b_imp,0)) AS bases, SUM(IF(moneda='02',b_imp,0)) AS based, SUM(IF(moneda='01',igv,0)) AS igvs, SUM(IF(moneda='02',igv,0)) AS igvd FROM cab_mov where tipo='$tipo' and flag!='A' and substring(fecha,1,10) between '$fecha1' and '$fecha2' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5." order by cod_cab ";
  $resultado=mysql_query($strSQL_tot,$cn);
  $row_tot=mysql_fetch_array($resultado);
    
//
  ?>
  
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9"><span class="Estilo7 Estilo33">Total General S/. &nbsp;(<?php echo $row_tot['cantidads'] ?>)</span></td>
    <td align="center" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo $row_tot['items']?></span></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo number_format($row_tot['bases'],2)?></span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo number_format($row_tot['igvs'],2)?></span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo number_format($row_tot['totals'],2)?></span></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9"><span class="Estilo7 Estilo33">Total General US$. &nbsp;(<?php echo $row_tot['cantidadd'] ?>)</span></td>
    <td align="center" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo $row_tot['itemd']?></span></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo number_format($row_tot['based'],2)?></span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo number_format($row_tot['igvd'],2)?></span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo number_format($row_tot['totald'],2)?></span></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
  
  
  
  <?php }?>
  
</table>

?

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
