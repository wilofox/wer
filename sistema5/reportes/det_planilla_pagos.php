<?php 
if(isset($_REQUEST['excel'])){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=excel.xls");
}
include('../conex_inicial.php');
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
		//echo $transporte;
		/*echo $almacen;*/
		//echo $sucursal;
		 $emp_des="";
			  if($sucursal=='0' || $sucursal==''){
			  $sqls="select * from sucursal";
			  $emp_des="Todas";
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
			$tie_des="";
			  if ($almacen=='0' || $almacen=='') {
			  	$sql="select * from tienda where cod_suc='".$sucursal."' ";
				$tie_des="Todas";
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
	
	

include('../funciones/funciones.php');	
 //PAGINACION 1	
		 $registros = 20; 
		 $pagina = $_REQUEST['pagina']; 
			   
		//echo $pagina;

		if ($pagina=='') { 
		$inicio = 0; 
		$pagina = 1; 
		} 
		else { 
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
	$sql="Select * from temp where cod_user='".$cod_user."' and reporte='COBRANZAS' ";
 	$rs=mysql_query($sql,$cn);
	$cont=mysql_num_rows($rs);
	while ($row=mysql_fetch_array($rs)){
		$FilDocInc=" and md.id in (".$row['documentos'].") ";
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
		$filtro="where pa.fecha between '".formatofecha($fecha1)."' and '".formatofecha($fecha2)."'  
			".$FilSR."   ".$FilTE."  ".$FilDocInc."	 ".$TransRk."	
 and  cliente in ( select codcliente from cliente where razonsocial like '%".$auxiliar."%'  )
			";	

// filtro de agrupacion				
		if ($agruparc==0){
			$SqlRk=" $filtro and ca.tipo='1' ORDER BY ca.f_venc ";
		}else{
			 $SqlRk=" $filtro and ca.tipo='1' ORDER BY ca.f_venc";
		}
			//echo $SqlRk;		
	
		// rem inicio de proceso ---------------------
		/*$resultados = mysql_query("select * from cab_mov  $SqlRk "  ,$cn);
		$total_registros = mysql_num_rows($resultados); 
		
		$sql2= "select * from cab_mov $SqlRk  LIMIT $inicio, $registros";
		*/
		
		if(isset($_REQUEST['excel'])){
	echo "<table><tr><td colspan='12' height='100px' valign='middle' align='center' style='font-size:18px;font:bold' >PLANILLA DE PAGOS <br/></td></tr>
	<tr><td colspan='12' height='100px' valign='middle' align='center' style='font-size:14px;font:bold' >Desde: ".$fecha1."  Hasta: ".$fecha2." <br/></td></tr>
	<tr><td colspan='2' height='100px' valign='middle' align='center' style='font-size:14px;font:bold' >Empresa: <br> Tienda: <br/></td><td colspan=10>".$emp_des." <br>".$tie_des."</td> </tr>";
	echo "<tr><td colspan='12' height='100px' valign='middle' align='center' style='font-size:18px;font:bold' ><table border='0' cellpadding='0' cellspacing='1'>
		<tr  style='border:#999999 solid 1px;'>
			<td height='24' colspan='8' align='center' bgcolor='#666666' class='text6'>Documento</td>
			<td colspan='3' bgcolor='#666666' class='text6' >Moneda </td>
			<td width='108' bgcolor='#666666' class='text6' >C.P.</td>
		</tr>
		<tr style='background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px'>
			<td height='21' colspan='1' align='center'   style=' border:#CCCCCC solid 1px' >&nbsp;</td>
			<td width='58' align='center'  style=' border:#CCCCCC solid 1px'><span class='texto2'><strong>Fec.Pago</strong></span></td>
			<td width='54' align='center'  style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>Td.</strong></span></td>
			<td width='76'  style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>N&deg; Doc. </strong></span></td>
			<td width='118'  style=' border:#CCCCCC solid 1px'><span class='texto2'><strong>CLIENTE</strong></span></td>
			<td width='71'  style=' border:#CCCCCC solid 1px'><span class='texto2'><strong>Vcto.Doc.</strong></span></td>
			<td width='98'  style=' border:#CCCCCC solid 1px'><span class='texto2'><strong>Total Doc.</strong></span></td>
			<td width='76'  style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>Referencia </strong></span></td>
			<td width='36'  style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>T.C.</strong></span></td>
			<td width='70'  style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>S/.</strong></span></td>
			<td width='72'  style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>US$.</strong></span></td>
			<td style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>T.P./Numero</strong></span></td>
		</tr>
		<tr>
			<td colspan='12'>
	";
}
		$resultados = mysql_query("SELECT tp.descripcion AS patip,pa.numero AS panum,pa.fecha AS pafec,mo.simbolo AS pamon,pa.monto AS pamonto,ca.cod_ope AS doctip,CONCAT(ca.serie,ca.Num_doc) AS docnum,cli.razonsocial AS clirz,ca.total AS doctot,ca.fecha AS docfec,pa.tcambio AS tc,ca.f_venc AS docvenc FROM pagos pa INNER JOIN moneda mo ON mo.id=pa.moneda INNER JOIN t_pago tp ON tp.id=pa.t_pago INNER JOIN cab_mov ca ON ca.cod_cab=pa.referencia INNER JOIN cliente cli ON cli.codcliente=ca.cliente INNER JOIN modalidad md ON md.id=tp.modalidad  $SqlRk "  ,$cn);
		$total_registros = mysql_num_rows($resultados); 
		
		
		$limites=""; 
		if(!isset($_REQUEST['excel'])){
		$limites=" LIMIT $inicio, $registros ";
		}
		$sql2= "SELECT tp.descripcion AS patip,pa.numero AS panum,pa.fecha AS pafec,mo.simbolo AS pamon,pa.monto AS pamonto,ca.cod_ope AS doctip,CONCAT(ca.serie,ca.Num_doc) AS docnum,cli.razonsocial AS clirz,ca.total AS doctot,ca.fecha AS docfec,pa.tcambio AS tc,ca.cod_cab as refer,ca.f_venc AS docvenc,pa.numero as num_pag,tp.codigo as tpag FROM pagos pa INNER JOIN moneda mo ON mo.id=pa.moneda INNER JOIN t_pago tp ON tp.id=pa.t_pago INNER JOIN cab_mov ca ON ca.cod_cab=pa.referencia INNER JOIN cliente cli ON cli.codcliente=ca.cliente INNER JOIN modalidad md ON md.id=tp.modalidad $SqlRk  $limites";
	
		//echo $sql2;
		
	$resultado2=mysql_query($sql2,$cn);
	$total_registros2 = mysql_num_rows($resultado2); 
	$total_paginas = ceil($total_registros / $registros); 
	while($row=mysql_fetch_array($resultado2)){
		
		if($row['pamon']=='S/.'){
		$temp_monto1=number_format($row['pamonto'],2);
		$temp_monto2="";
		$TolS=$TolS+$row['pamonto'];
		}else{
		$temp_monto1="";
		$temp_monto2=number_format($row['pamonto'],2);
		$TolD=$TolD+$row['pamonto'];
		}
		
		
		if(trim(substr($row['docfec'],1,10)) != trim(substr($row['pafec'],1,10))){
		$bgcolor="#51A8FF";
		}else{
		$bgcolor="#FFFFFF";
		}
		
		?>
		<table height="22" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" >
          <tr bgcolor="<?php echo $bgcolor; ?>" >
            <td width="25" class="Detalle1">&nbsp;</td>
            <td width="66" class="Detalle1">
			<?
			
			echo $row['pafec'];
				//transportista			
				
				?></td>
            <td width="48" align="center"><span class="Detalle1">
              <?
			
			echo $row['doctip'];
				//transportista			
				
				?>
            </span></td>
            <td width="72"><span class="Detalle1">
              <?
			
			echo $row['docnum'];
				//transportista			
				
				?>
            </span></td>			
            <td width="131"><span class="Detalle1">
              <?
			
			echo caracteres($row['clirz']);
				//transportista			
				
				?>
            </span></td>
            <td width="65"><span class="Detalle1">
              <?
			
			echo substr($row['docvenc'],0,10);
				//transportista			
				
				?>
            </span></td>
            <td width="71" align="right"><span class="Detalle1">
              <?
			
			echo number_format($row['doctot'],2);
				//transportista			
				
				?>
            </span></td>
            <td width="95" align="right"><span class="Detalle1">
              <?
			$con_ref=mysql_fetch_array(mysql_query("select (select cod_ope from cab_mov where cod_cab=re.cod_cab_ref) as cod,serie,correlativo from referencia re where cod_cab='".$row['refer']."'",$cn));
			echo $con_ref['cod']." ".$con_ref['serie']."-".$con_ref['correlativo'];
				//transportista			
				
				?>
            </span></td>
            <td width="57" align="center"><span class="Detalle1">
              <?
			
			echo $row['tc'];
				//transportista			
				
				?>
            </span></td>
            <td width="61" align="right"><span class="Detalle1">
              <?
			
			echo $temp_monto1;
				//transportista			
				
				?>
            </span></td>
            <td width="79" align="right"><span class="Detalle1">
              <?
			
			echo $temp_monto2;
				//transportista			
				
				?>
            </span></td>
            <td width="89" align="center"><span class="Detalle1">
              <?
			
			echo $row['tpag']." ".$row['num_pag'];
				//transportista			
				
				?>
            </span></td>
          </tr>
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
		?>	
</div>	
<?

//if ($total_paginas==$pagina){
echo '<div align="right" style="color:#009900; padding-right:15px"><b>------------------------------------------<br>';
echo 'TOTAL FECHA (S/.) &nbsp;&nbsp;&nbsp; '.number_format($TolS,2).' &nbsp;&nbsp;&nbsp;<br>';
echo 'TOTAL FECHA (US$.) &nbsp;&nbsp;&nbsp; '.number_format($TolD,2).' &nbsp;&nbsp;&nbsp;</b></div>';
//}
if(!isset($_REQUEST['excel'])){
?>
		<table width="804" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="21">&nbsp;</td>
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
	<?php }else{
		echo "</td>
		</tr>
	</table></td>
	</tr>
	</table>";
	}?>