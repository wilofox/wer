<style type="text/css">
<!--
.Estilo10 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; }
.Estilo15 {color: #FFFFFF}
.Estilo33 {color: #000066}
.Estilo34 {color: #003399}
.Estilo35 {font-size: 11px}
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.anulado {text-decoration:line-through;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#990000; }
.Estilo36 {
	color: #FF0000;
	font-weight: bold;
}
.Estilo37 {
	color: #FF3300;
	font-weight: bold;
}
-->
</style>
<table width="1206"  border="0" cellpadding="1" cellspacing="1" >
  <tr style="background:url(imagenes/bg_contentbase2.gif);  background-position:100% 40%;">
    <td width="15">&nbsp;</td>
    <td width="111" height="18" ><span class="Estilo7 Estilo15 Estilo35">Fecha </span></td>
    <td width="40" ><span class="Estilo7 Estilo15 Estilo35">Doc.</span></td>
    <td width="170" ><span class="Estilo7 Estilo15 Estilo35">N. Documentos </span></td>
    <td width="88" align="center"><span class="Estilo7 Estilo15 Estilo35">Ruc</span></td>
    <td width="254" align="center"><span class="Estilo7 Estilo15 Estilo35">Razon Social</span></td>
    <td width="35" align="center"><span class="Estilo7 Estilo15 Estilo35">Mon.</span></td>
    <td width="45" align="center"><span class="Estilo7 Estilo15 Estilo35">B. imp ($.)</span></td>
    <td width="48" align="center" ><span class="Estilo7 Estilo15 Estilo35">TC</span></td>
    <td width="145" align="center" ><span class="Estilo7 Estilo15 Estilo35">B. imp (S/.)</span></td>
    <td width="81" align="center" ><span class="Estilo7 Estilo15 Estilo35">Inafectos</span></td>
    <td width="63" align="right" ><span class="Estilo7 Estilo15 Estilo35">Impuesto</span></td>
    <td width="71" align="right" ><span class="Estilo7 Estilo15 Estilo35">Total</span></td>
  </tr>
  <?php 
		    include('conex_inicial.php');
			include ('funciones/funciones.php');
			//-------------------------------------------
			
			
					   $registros = 40; 
					   $pagina = $_REQUEST['pagina']; 
					   $cantidad_documentos=0;
					   
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
			$cliente=$_REQUEST['cliente'];
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
			
			$docRk=$_REQUEST['docRk'];	
			
			$TEMp=explode("-",$docRk);
			$filtro56="";
			for($i=0;$i<count($TEMp)-1;$i++){
			 $filtro55[$i]="'".substr($TEMp[$i],2,2)."'".",";
			 $filtro56=$filtro56.$filtro55[$i];	
			}
			$longitud=strlen($filtro56);
			$filtro56=substr($filtro56,0,$longitud-1);
			
	
						
			// and operacion.cod_ope in ($filtro56)
		

			$strSQL="select *,cliente.tipo_aux,cliente.razonsocial,cliente.ruc,operacion.descripcion from cab_mov inner join cliente on cliente=codcliente inner join operacion  on operacion.codigo=cab_mov.cod_ope  and operacion.codigo in ($filtro56) where cab_mov.tipo='$tipo' and substring(fecha,1,10) between '$fecha1' and '$fecha2' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$filtro6." and operacion.sunat!='' order by operacion.descripcion,fecha ";
					
			//echo $strSQL;
			
			  $resultados = mysql_query($strSQL,$cn);
			  $total_registros = mysql_num_rows($resultados); 
			  $resultados = mysql_query($strSQL." LIMIT $inicio, $registros " ,$cn);
					
	//echo $strSQL." LIMIT $inicio, $registros ";
			  $resultados2 =mysql_num_rows($resultados); 
			  $total_paginas = ceil($total_registros / $registros);  
			$temdes="";	$x=1;	$temdes2="";
			$imp2=0;$igv2=0;$total2=0;	$imp3=0;$igv3=0;$total3=0;
		
							
			
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
			while($row=mysql_fetch_array($resultados)){ // aqui empieza a mostrar todos las consultas		
						
			$fecha=substr($row['fecha'],0,10);
			$fecha2=explode("-",$fecha);
			$td=$row['cod_ope'];
			$documento=$row['serie']." - ".$row['Num_doc'];	
			$importe=$row['b_imp'];
			$igv_p=$row['impto1'];
			$igv=$row['igv'];
			$total=$row['total'];
			$noperacion=$row['noperacion'];
			$items=$row['items'];
			$flag=$row['flag'];
			$referencia=$row['cod_cab']; // devuelve codigo de cabezera
			$moneda=$row['moneda'];
			$precio=$row["precio"];
						
			/*$query=mysql_query("select  venta  from tcambio  where date(concat(substring(fecha,7,4),'-',substring(fecha,4,2),'-',substring(fecha,1,2)))<=date('".$fecha."') order by fecha desc limit 0,1 ");*/
			
		//list($tc)=mysql_fetch_array($query);
		
		$cantidad_documentos++; // para contar la cantidad de documentos y mostrar al final
		
		$consultaDBA=mysql_query("select *from tcambio");// se consulta la tabla tipo de cambio
			while ($valor=mysql_fetch_assoc($consultaDBA))  // se muestra el tipo de cambio con la fecha correspondiente
			{ 		
						$fechaTc=$valor["fecha"];
						$fechaTc=formatofecharay($fechaTc);
					if ($fechaTc==$fecha)
					{
					$tc=$valor["venta"];
					}
					else if ($fecha>=$fechaTc)
					{$tc=$valor["venta"];
					}
			}


			$razon=$row['razonsocial'];
			$ruc=$row['ruc'];
			if($moneda=='02'){
			$moneda="US$.";
			}else{
			$moneda="S/.";
			}
		//	echo $x;

			if( $row['descripcion']!=$temdes ){
			
	//$imp3+=$imp2;
	//$igv3+=$igv2;
	//$total3+=$total2;

					
					if($x>1 ){
					
					echo $tot;
							echo $imp2."-".$igv2."-".$total2;

				}


				/*$tot="<tr><td colspan='14'></td></tr><tr><td colspan='14'>".mostrar_total($imp2,$igv2,$total2)."</td></tr>";
			
	echo "<tr><td colspan='14' ><b>".$row['descripcion']."</b></td></tr>";*/
	}
		
		$consulta2=mysql_query("select *from det_mov ");
				while ($valor2=mysql_fetch_assoc($consulta2))
					{				
								
							if ($referencia==$valor2["cod_cab"] and $valor2["afectoigv"]=="N")
					  			 	{ 	
											$importeInafectos= $valor2["precio"];
											$totalInafectos= $importeInafectos*$valor2["cantidad"] + $totalInafectos;
									}
					}
			?>
  <tr bgcolor="#F9F9F9" onclick="entrada(this)">
 
    <td align="center" ><img style="cursor:pointer" alt="" onclick="doc_det('<?php echo $referencia;?>')" src="imagenes/ico_lupa.png" width="15" height="15" /></td>
    <td ><span class="Estilo10"><?php echo $fecha; ?>
	</span></td>
    <td ><span class="Estilo10"><?php echo $td?></span></td>
    <td ><span class="Estilo10">
      <label for="select"><?php echo $documento?></label>
    </span></td>
    <td align="center"><span class="Estilo10"><?php echo $ruc?></span></td>
    <td align="center"><span class="Estilo10"><?php echo $razon?></span></td>
    <td align="center"><span class="Estilo10"><?php echo $moneda?></span></td>
    <td align="right" ><span class="Estilo10">
      <?php if($moneda=="US$.") {echo $importe; }?>
    </span></td>
    <td align="right" ><span class="Estilo10">
      <?php if($moneda=="US$.") echo "<center>$tc</center>"; ?>
    </span></td>
    <td align="right" ><span class="Estilo10">
      <?php if($moneda=="S/.") { echo number_format($importe,2);$imp2+=$importe;}else{echo number_format($importe*$tc,2);$imp2+=$importe*$tc;} ?>
    </span></td>
    <td align="right" ><span class="Estilo10">
      <?php  echo $totalInafectos; ?>
    </span></td>
    <!--<td align="right" ><span class="Estilo10">
      <?php if($igv!=0)  echo $igv_p?>
    </span></td> -->
    <td align="right" ><span class="Estilo10">
      <?php if($igv!=0) {if($moneda=="S/.") { echo number_format($igv,2);$igv2+=$igv;}else{echo number_format($igv*$tc,2);$igv2+=$igv*$tc;}}?>
    </span></td>
    <td align="right" ><span class="Estilo10">
      <?php 
	if($moneda=="US$."){
	$muestratotal=$importe*$tc+$igv*$tc;
	echo number_format($muestratotal,2);
	}
	else
	{
	echo number_format($total,2);
	}
	$total2+=$total;?>
    </span></td>

  </tr>
  <?php 

		
					if( $row['descripcion']!=$temdes ){
	$temdes=$row['descripcion'];

	
	
	}
	$x++;
		
		} //////// fin de while que muestra  
		/*if($total_paginas==$pagina){
			$temtotal="<tr><td colspan='14'></td></tr><tr><td colspan='14'>".mostrar_total($imp2,$igv2,$total2)."</td></tr>";
				echo $temtotal;
				}*/
			?>
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td colspan="2" bgcolor="#F9F9F9">&nbsp;</td>
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
    <td colspan="3" bgcolor="#F9F9F9"><strong>Total Ticket Boleta&nbsp;&nbsp; (<?php echo $cant_tb; ?>) </strong></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9"><strong><?php echo number_format($total_tb,2); ?></strong>.</td>
    <td align="right" bgcolor="#F9F9F9">S/</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td colspan="3" bgcolor="#F9F9F9"><strong>Total Ticket factura&nbsp;&nbsp; (<?php echo $cant_tf; ?>) </strong></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9"><strong><?php echo number_format($total_tf,2); ?></strong>.</td>
    <td align="right" bgcolor="#F9F9F9">S/</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td colspan="3" bgcolor="#F9F9F9"><strong> Ticket Anulados&nbsp; (<?php echo $cant_tanu; ?>) </strong></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9"><strong><?php echo number_format($total_tanu,2); ?></strong>.</td>
    <td align="right" bgcolor="#F9F9F9">S/</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td colspan="3" bgcolor="#F9F9F9"><strong>Total P&aacute;gina  &nbsp; (<?php echo $cant_otros; ?>) </strong></td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
    <td align="right" bgcolor="#F9F9F9"><strong><?php echo number_format($tot_otros,2); ?></strong></td>
    <td align="right" bgcolor="#F9F9F9">S/.</td>
    <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
</table>
<?php }?>
<?php }
	
?>
?
<table width="100%" height="21" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="311" height="21" align="left" valign="bottom" style="color:#333333"><span class="Estilo10">Viendo del <strong><?php echo $inicio+1?></strong> al<strong><?php echo $inicio+$resultados2 ?></strong>(de <strong><?php echo $total_registros?></strong> documentos)</span>.</td>
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
<?php

function mostrar_total($bi,$igv,$total){

$totgen_base1=$bi;
$totgen_igv1=$igv;
$totgen_total1=$total;

//echo "$totgen_base1 - $totgen_igv1 - $totgen_total1 <br>";
/*
if($where!=""){
		$filtrox=" and cod_ope='".$where."'";
		}else{
		$filtrox="";
		}
  
  $strSQL_tot="select sum(total) as total, sum(items) as item, count(cod_cab) as cantidad, sum(b_imp) as base,sum(igv) as igv from cab_mov inner join operacion on cod_ope=codigo where cab_mov.tipo='".$GLOBALS['tipo']."' and sunat!='' and flag!='A' and moneda='01' and substring(fecha,1,10) between '".$GLOBALS['fecha1']."' and '".$GLOBALS['fecha2']."' ".$GLOBALS['filtro1'].$GLOBALS['filtro2'].$GLOBALS['filtro3'].$GLOBALS['filtro4'].$GLOBALS['filtro5'].$filtrox." order by cod_cab ";
//  echo $strSQL_tot;
  $resultado=mysql_query($strSQL_tot);
  $row_tot=mysql_fetch_array($resultado);
  
  $totgen_cant1=$row_tot['cantidad'];
  $totgen_item1=number_format($row_tot['item'],2);
  $totgen_base1=number_format($row_tot['base'],2);
  $totgen_igv1=number_format($row_tot['igv'],2);
  $totgen_total1=number_format($row_tot['total'],2);
  
  
  $strSQL_tot="select sum(total) as total, sum(items) as item, count(cod_cab) as cantidad, sum(b_imp) as base,sum(igv) as igv from cab_mov inner join operacion on cod_ope=codigo where cab_mov.tipo='".$GLOBALS['tipo']."' and sunat!='' and flag!='A' and moneda='02' and substring(fecha,1,10) between '".$GLOBALS['fecha1']."' and '".$GLOBALS['fecha2']."' ".$GLOBALS['filtro1'].$GLOBALS['filtro2'].$GLOBALS['filtro3'].$GLOBALS['filtro4'].$GLOBALS['filtro5'].$filtrox." order by cod_cab ";
    echo $strSQL_tot;
  $resultado=mysql_query($strSQL_tot);
  $row_tot=mysql_fetch_array($resultado);
  
  $totgen_cant2=$row_tot['cantidad'];
  $totgen_item2=number_format($row_tot['item'],2);
  $totgen_base2=number_format($row_tot['base'],2);
  $totgen_igv2=number_format($row_tot['igv'],2);
  $totgen_total2=number_format($row_tot['total'],2);*/

$datos='<table border="0">
  <tr>
    <td  width="250" bgcolor="#F9F9F9">&nbsp;</td>
    <td  width="200" height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td  width="200" bgcolor="#F9F9F9">&nbsp;</td>
    <td colspan="7" bgcolor="#F9F9F9">----------------------------------------------------------------------------------------------------------------------------------</td>
  </tr>
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9">&nbsp;</td>
    <td bgcolor="#F9F9F9"><span class="Estilo7 Estilo33">Total General &nbsp;('.$totgen_item1.')</span></td>
    <td align="center" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">'.$totgen_item1.'</span></td>
    <td align="center" bgcolor="#F9F9F9" style="color:#FF3300; font:bold">S/.</td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">'.$totgen_base1.'</span></td>
	<td width="120" align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">&nbsp;</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">'.$totgen_igv1 .'</span></td>
    <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34">'.$totgen_total1 .'</span></td>

  </tr>
  
</table>';

return $datos;
}
 ?>