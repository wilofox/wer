<?php 
	if(isset($_REQUEST['excel'])){
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=excel.xls");
	}
include('../conex_inicial.php'); 	
	
?>

<div id="detalle" style="width:800px; height:230px; overflow:auto ; padding-left:10px;" >

<?php

	$TolS=0;
	$TolD=0;
		
	$fecha1=$_REQUEST['fecha1'];
	$fecha2=$_REQUEST['fecha2'];
	$agruparc=$_REQUEST['agruparc'];
	$agruparf=$_REQUEST['agruparf'];
	$sucursal=$_REQUEST['sucursal'];
	$almacen=$_REQUEST['almacen'];
	$auxiliar=$_REQUEST['cliente'];
	$transporte=$_REQUEST['transporte'];
	$pagina=$_REQUEST['pagina'];
	$cod_user=$_REQUEST['cod_user'];
	//echo $transporte;
	/*echo $almacen;*/
	$emp_des="";
	$tie_des="";
	$ven_des="";
	$cli_des="";
	if($sucursal=='0' || $sucursal=='' ){
		$sqls="select * from sucursal";
		$emp_des="todas";
	}else{
		$sqls="select * from sucursal where cod_suc='".$sucursal."'";
	}
	$resultados=mysql_query($sqls,$cn);
	while($rows=mysql_fetch_array($resultados)){
		$sucursales=$sucursales."'".$rows['cod_suc']."',";
		if($emp_des==""){
			$emp_des=$rows['des_suc'];
		}
	}			
	$sucursales2=substr($sucursales,0,strlen($sucursales)-1).""; //111
	////////////////////////////////			  
	if ($almacen=='0' || $almacen=='') {
		$sql="select * from tienda where cod_suc='".$sucursal."' ";
		$tie_des="todas";
	}else{
		$sql="select * from tienda where cod_tienda='".$almacen."' ";
	}
	//$sql="select * from tienda where cod_suc='".$sucursal."'";
	$resultado=mysql_query($sql,$cn);
	while($row=mysql_fetch_array($resultado)){
		$tiendas=$tiendas.$row['cod_tienda'].",";
		if($tie_des==""){
			$tie_des=$row['des_tienda'];
		}
	}
	$tiendas2=substr($tiendas,0,strlen($tiendas)-1);
	$cli_des=$auxiliar;
	include('../funciones/funciones.php');	
	//PAGINACION 1	
	$registros = 20; 
	$pagina = $_REQUEST['pagina']; 
			   
	//echo $pagina;

	if ($pagina=='') { 
		$inicio = 0; 
		$pagina = 1; 
	}else { 
		$inicio = ($pagina - 1) * $registros; 
	} 
	//------------------------------------------
	// filtro por sucursal y almacen
	if ($sucursal<>''){
		$FilSR=' and  sucursal in('.$sucursales2.') ';
	}
	if ($almacen<>'' and $sucursal<>0){
		$FilTE=' and  tienda in('.$tiendas2.') ';
	}
	
	// filtro por documento a incluir
	$sql="Select * from temp where cod_user='".$cod_user."'and reporte='VENTAS_X_CLIENTE' ";
	
	//echo $sql; 
 	$rs=mysql_query($sql,$cn);
	$cont=mysql_num_rows($rs);
	$docx="";
	while ($row=mysql_fetch_array($rs)){
		$FilDocInc=" and cod_ope in (".$row['documentos'].") ";
		$docx.=$row['documentos'].",";
	}
	//Filtro por transportista
	if ($transporte<>'0' and $transporte<>'' ){
		$TransRk=" and transportista='".$transporte."'  ";
	}
	
	//filtro general  
	$filtro="where substring(fecha,1,10) between '".formatofecha($fecha1)."' and '".formatofecha($fecha2)."'".$FilSR." ".$FilTE." ".$FilDocInc." ".$TransRk." and tipo='2' and  cliente in ( select codcliente from cliente where razonsocial like '%".$auxiliar."%' )";

	// filtro de agrupacion				
	if ($agruparc==0){
		$SqlRk=" $filtro group by cliente order by concat(cl.razonsocial),cod_ope ";
	}else{
		if ($agruparc==1){
			$SqlRk=" $filtro group by LEFT( fecha, 10 ) order by concat(fecha,cod_ope,serie,Num_doc)";
		}else{
			$SqlRk=" $filtro group by cab_mov.condicion order by concat(cab_mov.condicion,cod_ope,serie,Num_doc) ";
		}
	}
	//echo "select cab_mov.* from cab_mov inner join cliente cl on cl.codcliente=cab_mov.cliente $SqlRk";		
	
	if(isset($_REQUEST['excel'])){
		$visible=" style='visibility:hidden' ";
	
		echo "<table width='760' border='0' cellpadding='0' cellspacing='1'>
			<tr>
				<td colspan='12' height='100px' valign='middle' align='center' style='font-size:18px;font:bold' >VENTAS POR CLIENTE <br/></td>
			</tr>
			<tr>
				<td colspan='12' height='100px' valign='middle' align='center' style='font-size:14px;font:bold' >Desde: ".$fecha1."  Hasta:".$fecha2."</td>
			</tr>
			<tr>
				<td colspan='12' height='100px' valign='middle' align='center' style='font-size:14px;font:bold'>Empresa: ".$emp_des."</td>
			</tr>
			<tr>
				<td colspan='12' height='100px' valign='middle' align='right' style='font-size:14px;font:bold' >Tienda: ".$tie_des."</td>
			</tr>
			<tr>
				<td colspan='12' height='100px' valign='middle' align='right' style='font-size:14px;font:bold' >Filtro de Cliente: ".$cli_des."                  Docs. Filtrados:".$docx."</td>
			</tr>
			<tr  style='border:#999999 solid 1px;'>
				<td width='25' align='center' bgcolor='#666666' class='text6'    >&nbsp;</td>
				<td height='24' colspan='2' align='center' bgcolor='#666666' class='text6'>Alm.</td>
				<td width='54' align='center'  bgcolor='#666666' class='text6'>Doc.</td>
				<td width='76' bgcolor='#666666' class='text6' >Fec.Doc.<br /></td>
				<td width='85' bgcolor='#666666' class='text6'>Referencia </td>
				<td width='102' bgcolor='#666666' class='text6'>Tipo de venta</td>
				<td width='72' bgcolor='#666666' class='text6'> Auxiliar </td>
				<td width='87' bgcolor='#666666' class='text6' >Responsable</td>
				<td colspan='2' bgcolor='#666666' class='text6' >Inclu/No Inclu </td>
				<td width='91' bgcolor='#666666' class='text6' >Monto Total</td>
			</tr>
			<tr  style='background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px'>
				<td height='21' colspan='2' align='center'   style=' border:#CCCCCC solid 1px' >&nbsp;</td>
				<td width='58' align='center'  style=' border:#CCCCCC solid 1px'><span class='texto2'><strong>Cantidad</strong></span></td>
				<td  style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>C&oacute;digo</strong></span></td>
				<td  style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>Cod. Anexo </strong></span></td>
				<td colspan='3'  style=' border:#CCCCCC solid 1px'><span class='texto2'><strong>Descripcion</strong></span></td>
				<td  style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>P.Unit.</strong></span></td>
				<td width='74'  style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>B.Imp.</strong></span></td>
				<td width='61'  style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>Imptos</strong></span></td>
				<td  style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>Total</strong></span></td>
			</tr>
			<tr>
				<td colspan='12'><div id='detalle' style='width:800px; height:250px;' > </div></td>
			</tr>
		</table>";
	}
	// rem inicio de proceso ---------------------
	$resultados = mysql_query("select cab_mov.* from cab_mov inner join cliente cl on cl.codcliente=cab_mov.cliente $SqlRk "  ,$cn);
	$total_registros = mysql_num_rows($resultados); 
		if(!isset($_REQUEST['excel'])){
	$sql2= "select cab_mov.* from cab_mov inner join cliente cl on cl.codcliente=cab_mov.cliente $SqlRk  LIMIT $inicio, $registros";
		}else{
			$sql2= "select cab_mov.* from cab_mov inner join cliente cl on cl.codcliente=cab_mov.cliente $SqlRk ";
		}
	// echo $sql2;
	$resultado2=mysql_query($sql2,$cn);
	$total_paginas = ceil($total_registros / $registros); 
	while($row=mysql_fetch_array($resultado2)){
	?>
	<div style="padding-top:5px;"></div>
	<table width="788" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td style="color:#0386B8; font-size:12px;"><b>
		<?php 
		if ($agruparc==0){
			echo $row['cliente'];
			//echo '&nbsp;&nbsp;&nbsp;';
			$sql="select * from cliente where codcliente ='".$row['cliente']."' ";
			$resultadoX=mysql_query($sql,$cn);
			while($rowX=mysql_fetch_array($resultadoX)){
				echo '&nbsp;&nbsp;&nbsp;'.$rowX['razonsocial'];
			}
			//transportista	
			/*		
			if ($transporte<>'0' and $transporte<>'' ){
				$sql="select * from transportista where id ='".$transporte."' ";
				$resultadoX=mysql_query($sql,$cn);
				while($rowX=mysql_fetch_array($resultadoX)){
					echo ' &nbsp;&nbsp;TRANSPORTISTA: '.$rowX['nombre'];			
					echo ' &nbsp;&nbsp;PLACA: '.$rowX['placa'];					
				}								
			}
			//chofer
			$sql="select * from chofer where cod ='".$row['chofer']."' ";
			$resultadoX=mysql_query($sql,$cn);
			while($rowX=mysql_fetch_array($resultadoX)){
				echo ' &nbsp;&nbsp;CHOFER: '.$rowX['nombre'];
			}
			*/
		}else{
			if ($agruparc==1){
				echo formatobarrafecha(substr($row['fecha'],0,10));
			}else{
			//echo $row['condicion'];
				list($nom_condicion)=mysql_fetch_row(mysql_query("select nombre from condicion where codigo='".$row['condicion']."'"));
				echo $nom_condicion;
			//transportista	
			/*		
				if ($transporte<>'0' and $transporte<>'' ){
					$sql="select * from transportista where id ='".$transporte."' ";
					$resultadoX=mysql_query($sql,$cn);
					while($rowX=mysql_fetch_array($resultadoX)){
						echo ' &nbsp;&nbsp;TRANSPORTISTA: '.$rowX['nombre'];			
						echo ' &nbsp;&nbsp;PLACA: '.$rowX['placa'];					
					}								
				}
				//chofer
				$sql="select * from chofer where cod ='".$row['chofer']."' ";
				$resultadoX=mysql_query($sql,$cn);
					while($rowX=mysql_fetch_array($resultadoX)){
						echo ' &nbsp;&nbsp;CHOFER: '.$rowX['nombre'];
					 }
			*/	
			}
		}
		?></b></td>
		<td></td>
		<td>&nbsp;</td>			
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	</table>
	<?php 	
	if ($sucursal<>''){
	  $FilSR=' and  cm.sucursal in('.$sucursales2.') ';
	}
	if ($almacen<>'' and $sucursal<>0){
	  $FilTE=' and  cm.tienda in('.$tiendas2.') ';
	}

	if ($agruparc==0){
		$SqlRk_1=" cm.cliente='".$row['cliente']."' ";
		$txt_total=" TOTAL CLIENTE ";	
	}else{
		if ($agruparc==1){
			$SqlRk_1=" left( fecha, 10 ) = '".substr($row['fecha'],0,10)."' ";
			$txt_total=" TOTAL FECHA ";	
		}else{
			$SqlRk_1=" cm.condicion='".$row['condicion']."' ";		  
			$txt_total=" TOTAL CONDICION ";	
		}
	}
	$sql3="SELECT *,cm.tienda as almacen FROM cab_mov cm INNER JOIN condicion c ON cm.condicion = c.codigo INNER JOIN cliente cl ON cm.cliente  = cl.codcliente INNER JOIN usuarios u ON cm.cod_vendedor  = u.codigo WHERE $SqlRk_1 and substring(fecha,1,10) between '".formatofecha($fecha1)."' and '".formatofecha($fecha2)."' and razonsocial like '%".$auxiliar."%'".$FilSR." ".$FilTE." ".$FilDocInc." ".$TransRk." ";

	 //echo $sql3;
	$resultado3=mysql_query($sql3,$cn);
	while($row3=mysql_fetch_array($resultado3)){
	$tipoDesc=$row3['tipoDesc'];
	$infectoDoc=$row3['inafecto'];
	$percepcionDoc=$row3['percepcion'];
	$anulado=$row3['flag'];
	
	$rayado="";
	if($anulado=='A'){
	$rayado="text-decoration:line-through; color:#FF0000";		
	}
	
	?>
		<table  width="760" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="26" align="center" style=" border-bottom:#CCCCCC solid 1px; font-weight:bold">&nbsp;</td>
			<td height="23" colspan="2" align="center" style=" border-bottom:#CCCCCC solid 1px; font-weight:bold; <?php echo $rayado?>"><?=$row3['almacen'];?></td>
			<td width="85" align="center" style=" border-bottom:#CCCCCC solid 1px; font-weight:bold;<?php echo $rayado; ?>" ><?=$row3['cod_ope'].$row3['Num_doc'];?></td>
			<td width="71" style=" border-bottom:#CCCCCC solid 1px; font-weight:bold;<?php echo $rayado?> "><?=formatobarrafecha(substr($row3['fecha'],0,10));?></td>
			<td width="92" style=" border-bottom:#CCCCCC solid 1px; font-weight:bold; <?php echo $rayado?>">&nbsp;<?=caracteres($row3['flag_r']); ?></td>
			<td width="100" style=" border-bottom:#CCCCCC solid 1px; font-weight:bold; <?php echo $rayado?>"><?=caracteres($row3['nombre']); ?></td>
			<td width="85" style=" border-bottom:#CCCCCC solid 1px; font-weight:bold; <?php echo $rayado?>" title="<?=caracteres($row3['razonsocial']);?>" ><? echo substr(caracteres($row3['razonsocial']), 0, 12)  ?></td>
			<td width="102" style=" border-bottom:#CCCCCC solid 1px; font-weight:bold; <?php echo $rayado?>" title="<?=$row3['usuario'];?>" ><? echo substr(caracteres($row3['usuario']), 0, 12)  ?></td>
			<td colspan="2" style=" border-bottom:#CCCCCC solid 1px; font-weight:bold; <?php echo $rayado?>" align="center"><? if ($row3['incluidoigv']=='S'){echo 'IGV Inclu.';}else{echo 'NO IGV Inclu.';} ?>&nbsp;</td>
			<td width="66" style=" border-bottom:#CCCCCC solid 1px; font-weight:bold; <?php echo $rayado?>" align="right"><? if ($row3['moneda']=='01'){echo'S/.';}else{echo'US$.';}  ?> 
			<?php
			
			if($anulado=='A'){
			echo "0.00";
			}else{
			 number_format($row3['total'],2); 
			}
			
			?></td>
		</tr>
		</table>
		<?php 		
		//$TolSoles=0;
		//$TolDolares=0;	

		$j=0;
		
		$sql="select * from det_mov dm where cod_cab ='".$row3['cod_cab']."'";
		$resultado4=mysql_query($sql,$cn);
		while($row4=mysql_fetch_array($resultado4)){
		
		$afectoigvProd=$row4['afectoigv'];
			$j++;
			if($j%2==0){
				//$color_row='#ccccccc';
			}else{
				$color_row='#FFFFFF';
			}	
		?>
			<table bgcolor="<?php echo $color_row?>" width="760" height="20" border="0" cellpadding="0" cellspacing="0"  >
			<tr>   
				<td width="20" align="center"></td>
				<td width="61" align="center" ><?php echo $row4['cantidad'] ?></td>
				<td width="61" align="center" ><?php echo $row4['cod_prod'] ?></td>
				<td width="82" align="center" ><?php 
				//echo $row4['cod_prod']
				$sql="select * from producto where idproducto  ='".$row4['cod_prod']."' ";
				$resultadoX=mysql_query($sql,$cn);
				while($rowX=mysql_fetch_array($resultadoX)){
					echo $rowX['cod_prod'];
				}?></td>
				<td width="271" title="<?=$row4['nom_prod'];?>" ><? 
				echo substr(caracteres($row4['nom_prod']),0,40);
				echo "<span style='color:#FF0000'>";
				if($afectoigvProd=='N') echo " (I) ";
				if($percepcionDoc > 0) echo " *";
				echo "</span>";
				 ?></td>
				<td width="74" align="center" ><?php echo number_format($row4['precio'],4)  ?></td>
				<td width="74" align="center" ><?php 
				echo $row4['desc1'];
				if($tipoDesc=='P'){
				echo " %" ;
				}
				
				?></td>
				<td width="74" align="center" ><?php 
				echo $row4['desc2'];
				if($tipoDesc=='P'){
				echo " %" ;
				}
				?></td>
				<td width="68" align="center" >
				<?php 
				//echo $row4['precosto'] 
				$impue="1.".$row3['impto1']."<br>";
				//echo number_format($row4['cantidad']*$row4['precio']/$impue,2);
				?>
				</td>
				<td width="61" align="right" ><?php //echo $row4['costo_inven'] 
				$tot=$row4['precio']*$row4['cantidad'];
				//echo number_format($tot-($tot/$impue),2);
				?></td>
				<td width="62" align="right"><?php 
				
				//echo number_format($row4['precio']*$row4['cantidad'],2); 
				if($anulado=='A'){
				echo "0.00";
				}else{
				echo number_format($row4['imp_item'],2); 
				}
				
				
				?>
				<?php
				
                if ($row3['moneda']=='01'){
					//$TolSoles+=$row4['precio']*$row4['cantidad'] ;
					$TolSoles+=$row4['imp_item'] ;
				}else{
				
					//$TolDolares+=$row4['precio']*$row4['cantidad'] ;
					$TolDolares+=$row4['imp_item'] ;
				}
				
				?></td>
			</tr>
			</table>
		<?php 
		}
		$TolS+=$TolSoles;
		$TolD+=$TolDolares;
	}
	
	/*
	if($anulado=='A'){	
	echo '<div align="right" style="color:#000066"><b>------------------------------------------<br>';
	echo $txt_total.'(S/.) &nbsp;&nbsp;&nbsp;0.00&nbsp;&nbsp;&nbsp;<br>';
	echo $txt_total.'(US$.) &nbsp;&nbsp;&nbsp;0.00&nbsp;&nbsp;&nbsp;</b><br><br><br></div>';	
	}else{	
	echo '<div align="right" style="color:#000066"><b>------------------------------------------<br>';
	echo $txt_total.'(S/.) &nbsp;&nbsp;&nbsp;'.number_format($TolSoles,2).'&nbsp;&nbsp;&nbsp;<br>';
	echo $txt_total.'(US$.) &nbsp;&nbsp;&nbsp;'.number_format($TolDolares,2).'&nbsp;&nbsp;&nbsp;</b><br><br><br></div>';		
	}*/
	
	echo "<br><br>";
			
	}
	?>	
</div>	
<?

//if ($total_paginas==$pagina){
/*
echo '<div align="right" style="color:#009900; padding-right:15px"><b>------------------------------------------<br>';
echo 'TOTAL FECHA (S/.) &nbsp;&nbsp;&nbsp; '.number_format($TolS,2).' &nbsp;&nbsp;&nbsp;<br>';
echo 'TOTAL FECHA (US$.) &nbsp;&nbsp;&nbsp; '.number_format($TolD,2).' &nbsp;&nbsp;&nbsp;</b></div>';
*/
//}

if(!isset($_REQUEST['excel'])){
?>
		<table width="804">
      <tr>
        <td width="677" height="26">Viendo del <?php echo $inicio+1?> al <?php echo $inicio+$resultados2 ?> (de <?php echo $total_registros?> documentos) </td>
        <td width="115"><?php 
			  
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
	<?php } ?>