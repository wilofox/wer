<?php 
include('../conex_inicial.php');

	if(isset($_REQUEST['excel'])){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=excel.xls");
		
		echo "<table><tr><td colspan='11' height='100px' valign='middle' align='center' style='font-size:18px;font:bold' >PLANILLA DE COBRANZAS <br/></td></tr></table>";
	
	
echo "<table width='760' border='0' cellpadding='0' cellspacing='1'>
        <tr  style='border:#999999 solid 1px;'>
         
          <td height='24' colspan='8' align='center' bgcolor='#666666' class='text6'>Documento</td>
          <td colspan='2' bgcolor='#666666' class='text6' >Moneda </td>
          <td width='108' bgcolor='#666666' class='text6' >C.P.</td>
        </tr>
        <tr  style='background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px'>
          <td height='21' colspan='1' align='center'   style=' border:#CCCCCC solid 1px' >&nbsp;</td>
          <td width='58' align='center'  style=' border:#CCCCCC solid 1px'><span class='texto2'><strong>Fec.Pago</strong></span></td>
          <td width='54' align='center'  style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>Td.</strong></span></td>
          <td width='76'  style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>N&deg; Doc. </strong></span></td>
          <td width='118'  style=' border:#CCCCCC solid 1px'><span class='texto2'><strong>CLIENTE</strong></span></td>
          <td width='71'  style=' border:#CCCCCC solid 1px'><span class='texto2'><strong>Vcto.Doc.</strong></span></td>
          <td width='98'  style=' border:#CCCCCC solid 1px'><span class='texto2'><strong>Total Doc.</strong></span></td>
          <td width='36'  style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>T.C.</strong></span></td>
          <td width='70'  style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>S/.</strong></span></td>
          <td width='72'  style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>US$.</strong></span></td>
          <td  style=' border:#CCCCCC solid 1px' ><span class='texto2'><strong>Tip.Pago</strong></span></td>
          </tr>
        <tr>
          <td colspan='12'><div id='detalle' style='width:800px; height:250px;' > </div></td>
        </tr>
      </table>
	";
}
?>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #0066CC;
}
.Estilo2 {font-family: Arial, Helvetica, sans-serif}
.Estilo4 {font-size: 11px}
.Estilo7 {font-size: 12}
.Estilo8 {font-family: Arial, Helvetica, sans-serif; font-size: 12; }
.Estilo10 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo11 {font-size: 12px}
-->
</style>

<table width="200" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td><span class="Estilo1">PLANILLA DE COBRANZA</span> </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	<table width="806" border="0" cellpadding="0" cellspacing="1">
        
        <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
          <td width="25" height="21" colspan="2" align="center"   style=" border:#CCCCCC solid 1px" >&nbsp;</td>
          <td width="58" align="center"  style=" border:#CCCCCC solid 1px"><span class="texto2 Estilo2 Estilo11"><strong>Fec.Pago</strong></span></td>
          <td width="54" align="center"  style=" border:#CCCCCC solid 1px" ><span class="texto2 Estilo2 Estilo11"><strong>Td.</strong></span></td>
          <td width="76"  style=" border:#CCCCCC solid 1px" ><span class="texto2 Estilo2 Estilo11"><strong>N&deg; Doc. </strong></span></td>
          <td width="118"  style=" border:#CCCCCC solid 1px"><span class="texto2 Estilo2 Estilo11"><strong>CLIENTE</strong></span></td>
          <td width="71"  style=" border:#CCCCCC solid 1px"><span class="texto2 Estilo2 Estilo11"><strong>Vcto.Doc.</strong></span></td>
          <td width="98"  style=" border:#CCCCCC solid 1px"><span class="texto2 Estilo2 Estilo11"><strong>Total Doc.</strong></span></td>
          <td width="36"  style=" border:#CCCCCC solid 1px" ><span class="texto2 Estilo2 Estilo11"><strong>T.C.</strong></span></td>
          <td width="70"  style=" border:#CCCCCC solid 1px" ><span class="texto2 Estilo2 Estilo11"><strong>S/.</strong></span></td>
          <td width="72"  style=" border:#CCCCCC solid 1px" ><span class="texto2 Estilo2 Estilo11"><strong>US$.</strong></span></td>
          <td width="108"  style=" border:#CCCCCC solid 1px" ><span class="texto2 Estilo2 Estilo11"><strong>Tip.Pago</strong></span></td>
        </tr>
        <tr>
          <td colspan="12"></td>
        </tr>
      </table>
	
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><div id="detalle" style="width:803px; height:200px; overflow:auto ; " >
      <?php

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
		
		$docref=$_REQUEST['docref'];
		
		
		if($docref==0)$FilDocInc=" and ca.cod_ope in ('B0','F0') ";
		if($docref=='B0')$FilDocInc=" and ca.cod_ope in ('B0') ";
		if($docref=='F0')$FilDocInc=" and ca.cod_ope in ('F0') ";
		
		
		
		 
			  if($sucursal=='0'){
			  $sqls="select * from sucursal";
			  }else{
			  $sqls="select * from sucursal where cod_suc='".$sucursal."'";
			  }
			  $resultados=mysql_query($sqls,$cn);
			 while($rows=mysql_fetch_array($resultados)){
			 $sucursales=$sucursales."'".$rows['cod_suc']."',";
			 }			
	$sucursales2=substr($sucursales,0,strlen($sucursales)-1).""; //111
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
	
	/*
	$sql="Select * from temp where cod_user='".$cod_user."' and reporte='COBRANZAS' ";
 	$rs=mysql_query($sql,$cn);
	$cont=mysql_num_rows($rs);
	while ($row=mysql_fetch_array($rs)){
		$FilDocInc=" and md.id in (".$row['documentos'].") ";
	}
	*/
	//Filtro por transportista
	/*if ($transporte<>'0' and $transporte<>'' ){
	   $TransRk=" and transportista='".$transporte."'  ";
	}*/
	if ($responsable<>'0' and $responsable<>'' ){
	   $TransRk=" and cod_user='".$responsable."'  ";
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
			$SqlRk=" $filtro and ca.tipo='2'  ORDER BY ca.f_venc ";
		}else{
			 $SqlRk=" $filtro and ca.tipo='2'   ORDER BY ca.f_venc";
		}
			//echo $SqlRk;		 group by tp.modalidad
	
		// rem inicio de proceso ---------------------
		/*$resultados = mysql_query("select * from cab_mov  $SqlRk "  ,$cn);
		$total_registros = mysql_num_rows($resultados); 
		
		$sql2= "select * from cab_mov $SqlRk  LIMIT $inicio, $registros";
		*/
		
		$resultados = mysql_query("SELECT tp.descripcion AS patip,pa.numero ASanum,pa.fecha AS pafec,mo.simbolo AS pamon,pa.monto AS pamonto,ca.cod_ope AS doctip,CONCAT(ca.serie,ca.Num_doc) AS docnum,cli.razonsocial AS clirz,ca.total AS doctot,ca.fecha AS docfec,pa.tcambio AS tc,ca.f_venc AS docvenc, md.nombre as nommod FROM pagos pa INNER JOIN moneda mo ON mo.id=pa.moneda INNER JOIN t_pago tp ON tp.id=pa.t_pago INNER JOIN cab_mov ca ON ca.cod_cab=pa.referencia INNER JOIN cliente cli ON cli.codcliente=ca.cliente INNER JOIN modalidad md ON md.id=tp.modalidad  $SqlRk "  ,$cn);
		$total_registros = mysql_num_rows($resultados); 
		
		
		$limites=""; 
		if(!isset($_REQUEST['excel'])){
		$limites=" LIMIT $inicio, $registros ";
		}
		$sql2= "SELECT tp.descripcion AS patip,pa.numero AS panum,pa.fecha AS pafec,mo.simbolo AS pamon,pa.monto AS pamonto,ca.cod_ope AS doctip,CONCAT(ca.serie,ca.Num_doc) AS docnum,cli.razonsocial AS clirz,ca.total AS doctot,ca.fecha AS docfec,pa.tcambio AS tc,ca.f_venc AS docvenc, md.nombre as nommod FROM pagos pa INNER JOIN moneda mo ON mo.id=pa.moneda INNER JOIN t_pago tp ON tp.id=pa.t_pago INNER JOIN cab_mov ca ON ca.cod_cab=pa.referencia INNER JOIN cliente cli ON cli.codcliente=ca.cliente INNER JOIN modalidad md ON md.id=tp.modalidad $SqlRk $limites";
	
		//echo $sql2;
		
	$resultado2=mysql_query($sql2,$cn);
	$total_registros2 = mysql_num_rows($resultado2); 
	$total_paginas = ceil($total_registros / $registros); 
		
	$tempMod="";
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
		
		//echo substr($row['docfec'],0,10)." / ".substr($row['pafec'],0,10)."<br>";
		if(trim(substr($row['docfec'],1,10)) != trim(substr($row['pafec'],1,10))){
		$bgcolor="#51A8FF";
		}else{
		$bgcolor="#FFFFFF";
		}
		
		if($row['nommod']!=$tempMod){
		$tempMod=$row['nommod'];
		echo "<strong style='font-family:Arial, Helvetica, sans-serif;font-size:12px; color:#FF0000'>$tempMod</strong>";
		}
		?>
      <div style="padding-top:5px; "></div>
      <table width="786" height="22" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" >
        <tr bgcolor="<?php echo $bgcolor; ?>">
          <td width="25" class="Detalle1 Estilo2 Estilo4">&nbsp;</td>
          <td width="59" class="Detalle1 Estilo2 Estilo4"><?
			
			echo $row['pafec'];
				//transportista			
				
				?></td>
          <td width="55" align="center"><span class="Detalle1 Estilo2 Estilo4">
            <?
			
			echo $row['doctip'];
				//transportista			
				
				?>
          </span></td>
          <td width="72"><span class="Detalle1 Estilo2 Estilo4">
            <?
			
			echo $row['docnum'];
				//transportista			
				
				?>
          </span></td>
          <td width="120"><span class="Detalle1 Estilo2 Estilo4">
            <?
			
			echo caracteres($row['clirz']);
				//transportista			
				
				?>
          </span></td>
          <td width="67"><span class="Detalle1 Estilo2 Estilo4">
            <?
			
			echo substr($row['docvenc'],0,10);
				//transportista			
				
				?>
          </span></td>
          <td width="97" align="right"><span class="Detalle1 Estilo2 Estilo4">
            <?
			
			echo number_format($row['doctot'],2);
				//transportista			
				
				?>
          </span></td>
          <td width="38" align="center"><span class="Detalle1 Estilo2 Estilo4">
            <?
			
			echo $row['tc'];
				//transportista			
				
				?>
          </span></td>
          <td width="70" align="right"><span class="Detalle1 Estilo2 Estilo4">
            <?
			
			echo $temp_monto1;
				//transportista			
				
				?>
          </span></td>
          <td width="70" align="right"><span class="Detalle1 Estilo2 Estilo4">
            <?
			
			echo $temp_monto2;
				//transportista			
				
				?>
          </span></td>
          <td width="89" align="center"><span class="Detalle1 Estilo2 Estilo4">
            <?
			
			echo $row['patip'];
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
      <span class="Estilo10">
 <?

//if ($total_paginas==$pagina){
echo '<div align="right" style="color:#009900; padding-right:15px"><b>------------------------------------------<br>';
echo 'TOTAL FECHA (S/.) &nbsp;&nbsp;&nbsp; '.number_format($TolS,2).' &nbsp;&nbsp;&nbsp;<br>';
echo 'TOTAL FECHA (US$.) &nbsp;&nbsp;&nbsp; '.number_format($TolD,2).' &nbsp;&nbsp;&nbsp;</b></div>';
//}

?></span>
      <table width="804" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="21"><span class="Estilo7"></span></td>
          <td><span class="Estilo7"></span>                </tr>
        <tr>
          <td width="562" height="21"><span class="Estilo8">Viendo del <?php echo $inicio+1?> al <?php echo $inicio+$total_registros2 ?> (de <?php echo $total_registros?> documentos) </span></td>
          <td width="236"><span class="Estilo8">
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
        </span></tr>
      </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
