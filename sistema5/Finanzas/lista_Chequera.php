<?
//Borrar Sesion multifactura
session_start();
include_once('mcc/MCheques.php');
//include('../conex_inicial.php');
include_once('../funciones/funciones.php');

unset($_SESSION['Multifactura']);
$mc=new MCheques();
//PAGINACION 1	
?>
<style type="text/css">
<!--
.Estilo100 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
-->
</style>
<div id="detalle" style="width:800px; height:175px; overflow:auto" >
<table width="800" height="24" border="0" cellpadding="0" cellspacing="0" id="lista_productos">
<?php 
	$registros = 100; 
	$pagina = $_REQUEST['pagina']; 
	
	//echo $pagina;

	if ($pagina=='') { 
		$inicio = 0; 
		$pagina = 1; 
	}else{ 
		$inicio = ($pagina - 1) * $registros; 
	}
	//------------------------------------------
	$sucursal=$_REQUEST['sucursal'];
	$banco=$_REQUEST['banco'];
	//$almacen=$_REQUEST['almacen'];
	//$cliente=$_REQUEST['cliente'];
	//$ruc=$_REQUEST['ruc'];
	//$vendedor=$_REQUEST['vendedor'];
	//$docref=$_REQUEST['docref'];
	$fec1=$_REQUEST['fec1'];
	$fec2=$_REQUEST['fec2'];
	$estado=$_REQUEST['estado'];
	$mc->sucursal=$sucursal;
	$mc->banco=$banco;
	$mc->fecha1=formatofecha($fec1);
	$mc->fecha2=formatofecha($fec2);
	$mc->estado=$estado;
	$row=$mc->ListadoChequera();
	/*if(isset($_REQUEST['tipo']))
		$tipo=$_REQUEST['tipo'];
	$Estado=$_REQUEST['estado'];
	$cmbmoneda=$_REQUEST['moneda'];
	$formaOrder=$_REQUEST['formaOrder'];
	$campoOrder=$_REQUEST['campoOrder'];
	$filtroOrden="";
	if($campoOrder!="" && $formaOrder!=""){
		$filtroOrden=" order by  ".$campoOrder." ".$formaOrder; 
	}else{		
		if($_REQUEST['ordenar']!=""){
			$filtro2=" order by ".$_REQUEST['ordenar']. " ".$_REQUEST['orden']; 	
		}else{
			$filtro2=" order by fecha desc "; 	
		}
	}*/
	
	/*if ($almacen=='0'){	
		$strSQL22="select * from tienda order by cod_tienda";
		$resultado22=mysql_query($strSQL22,$cn);
		while($row22=mysql_fetch_array($resultado22)){
			//echo  $saldos[]=",'".$row22['cod_tienda'].'';
			$tiendas=$tiendas.$row22['cod_tienda'].",";
		}
		$tiendas2=substr($tiendas,0,strlen($tiendas)-1);
		$almacen1  =' tienda in('.$tiendas2.') ';		
	}else{
		$almacen1 = " tienda='$almacen' ";
	}	

	if ($mosdocAnu<>''){			
		echo $SQLMosDoc=" and flag ='$mosdocAnu' ";
	}*/

	/*if ($Estado<>''){
		if (trim($Estado)=='T'){
			$SQLEstado ="";
		}elseif (trim($Estado)=='P'){
			$sql_ex=mysql_query("Select multi_id from multi_det where det_id in(Select refer_letra from pagos where fecha between '".formatofecha($fec1)."' and '".formatofecha($fec2)."' and refer_letra!='')",$cn);
			$cda="";
			$cdn=0;
			while($rw_ex=mysql_fetch_array($sql_ex)){
				if($cdn==0){
					$cda=$rw_ex[0];
				}else{
					$cda=$rw_ex[0]."','".$cda;
				}
				$cdn=1;
			}
			//echo $cda;
			//$SQLEstado =" and flag_r <>'RA' and flag<>'A' and estadoOT<>'O' and estadoOT<>'T' "; 
			//$SQLEstado =" and flag_r ='' and flag<>'A' ";
			$SQLEstado =" and multi_id in('".$cda."') ";
		}elseif (trim($Estado)=='B'){
			//$SQLEstado =" and flag_r <>'' ";
			$SQLEstado =" and banco_id <> 0 ";
		}else{			
			//$SQLEstado =$Estado;
			$SQLEstado =" and estado='A' ";
		}	
	}else{
		//$SQLEstado =" and flag_r <>'RA' and flag<>'A' and estadoOT<>'O' and estadoOT<>'T' ";
		//$SQLEstado =" and flag_r =''  and flag<>'A' ";	  
		$SQLEstado ="";
	}
	//echo $SQLEstado; 
  
	if ($cmbmoneda=='T'){
		$Cmoneda='';
	}else{
		$Cmoneda=" and moneda='".$cmbmoneda."' ";
	}*/
 
	/* $SQLConsulta=" where $almacen1
	and cod_ope='$docref'
	and cod_vendedor like '%$vendedor%'
	and C.razonsocial like '%$cliente%'	
	and C.ruc like '%$ruc%'
	and substring(fecha,1,10) between '".formatofecha($fec1)."' and '".formatofecha($fec2)."'
	$SQLMosDoc $SQLEstado $Cmoneda";
	if($Estado!="P"){
		$SQLConsulta=" where cod_suc=$sucursal and substring(fecha,1,10) between '".formatofecha($fec1)."' and '".formatofecha($fec2)."'".$SQLEstado.$Cmoneda;
	}else{
		$SQLConsulta=" where cod_suc=$sucursal$SQLEstado$Cmoneda";
	}
	$AnRK="";
	$resultados = mysql_query("select * from multicj CM inner join cliente C on CM.cliente =C.codcliente $SQLConsulta order by numcje" ,$cn);
	$total_registros = mysql_num_rows($resultados); 
	$strSQL="select * from multicj CM inner join cliente C on CM.cliente =C.codcliente $SQLConsulta $filtroOrden LIMIT $inicio, $registros";
	//echo $strSQL;
						
			$j=0;
			$resultado=mysql_query($strSQL,$cn);
			

	$resultados2 =mysql_num_rows($resultado); 
	$total_paginas = ceil($total_registros / $registros); 
			*/
			$j=0;
			//while($row=mysql_fetch_array($resultado)){
	for($i=0;$i<count($row);$i++){
		$j++;
		if($j%2==0){
			$color_row='#E9F3FE';//'#FFFFFF';
		}else{
			$color_row='#FFFFFF';
		}	
		// documentos anulados rojo
		/*$AnRK='';	
		$sql="select * from cab_mov 
		where cod_cab  ='".$row['cod_cab']."' ";
		$resultadoX=mysql_query($sql,$cn);
		while($rowX=mysql_fetch_array($resultadoX)){*/
		$est="";
		switch($row[$i]['estado']){
			case 'A':$color_row='#79AEFF';$AnRK='2';$est="Activada";break;
			case 'E':$color_row='#FF0000';$AnRK='2';$est="Desactivada";break;
			case 'O':$AnRK='2';$est="Observado";break;
		}
//}	
// documentos con serie (anulara y desanular no permite)
/*$sql="select count(pa.id) from pagos pa 
inner join multi_det md on 
md.det_id=pa.refer_letra 
inner join multicj mc on
mc.multi_id=md.multi_id
where mc.estado <> 'A'
and mc.multi_id='".$row['multi_id']."'
and mc.cod_suc='$sucursal' ";
$resultadoX=mysql_query($sql,$cn);
$rowX=mysql_fetch_array($resultadoX);
//while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX[0]>0){
		$color_row='#D7FFF0';
		//$AnRK='3';
	}
//}
	*/		 					
 //documentos facturado o canjeado
/*$sql="select * from referencia where cod_cab_ref='".$row['cod_cab']."'  
LIMIT 0, 1  "; // and flag_r='RO' 
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){*/
	//if ($rowX['flag_r']=='RO' || $rowX['flag_r']=='RORA'){
	/*if($row[$i]['banco_id']<>"0"){		
		$color_row='#0066FF';
		$AnRK='3';
	}*/					 					
	?>
			
<tr bgcolor="<?php echo $color_row?>" onClick="entrada(this);" ondblclick="" >
<?php if($row[0]["estado"]=="N"){?>
<td colspan="12" align="center" ><?php  echo $row[$i]['cheq_id']?></td>
<?php }else{?>
	<td width="33" align="center" ><input style="border: 0px; background:none; " type="radio" name="XDato" value="<?php  echo $row[$i]['cheq_id']."|";?>" /><b><?=$j;?></b></td>
	<td width="23" align="center" class="texto1" >	  
	<? //if ($AnRK<>'3'){ ?>
	<input style="border: 0px; background:none; " type="checkbox" name="xcodigo" value="<?=$row[$i]['cheq_id'];?>" onclick="Anular('S')" />
	<? //} ?></td>
	<td width="72" class="texto1" align="center" ><?php echo extraefecha($row[$i]['fecha_aut']);?></td>
	<td width="100" class="texto1" ><?php echo $row[$i]['ctabco']; ?></td>
	<td width="46" align="center" class="texto1"><?php echo $row[$i]['simbolo']; ?></td>			
	<td width="118" class="texto1"><?php echo $row[$i]['num_aut']; ?></td>
	<td width="110" align="right" class="texto1"><?php echo str_pad($row[$i]['num_ini'],11,"0",STR_PAD_LEFT);?></td>
	<td width="110" align="right" class="texto1"><?php echo str_pad($row[$i]['num_fin'],11,"0",STR_PAD_LEFT);?></td>
	<td width="72" align="center" class="texto1"><?php echo extraefecha($row[$i]['fecha_vcto']);
	?></td>
	<td width="79" colspan="3" align="center" class="texto1"><?php echo $est;?></td>
	<?php /*<td width="23" align="center" class="texto1">
		$sql2=mysql_query("Select * from bancos where id='".$row['banco_id']."'",$cn);
		$rw_b=mysql_fetch_array($sql2);
		echo $rw_b['descrip'];*/
		/*$strSQLSM="select * from referencia where cod_cab_ref='".$row['cod_cab']."' order by id desc ";
	$resultadoMS=mysql_query($strSQLSM,$cn);
	//$rowSM=mysql_fetch_array($resultadoMS);
	//echo $sucursal=$rowSM['serie'].'-'.$rowSM['correlativo'];
	while($rowSM=mysql_fetch_array($resultadoMS)){
	$codRefec=$rowSM['cod_cab'].',';
	//echo $codRefec;
		$strSQL2="select * from cab_mov where cod_cab in (".$codRefec."0) ";
		$resultado2=mysql_query($strSQL2,$cn);
		//$rowR=mysql_fetch_array($resultadoMS);   	
		while($rowR=mysql_fetch_array($resultado2)){
			if ($rowR['cod_cab']<>''){
				}echo $rowR['cod_ope'].'-'.$rowR['serie'].'-'.$rowR['Num_doc'].' | ';	
			
		}
	
	}</td>
	<td width="33" align="center" class="texto1">
	<?php
		/*if ($row['archivo']<>''){
			echo '<a href="'.$row['archivo'].'" target="_blank"><img src="../imagenes/archivo.png" width="15" height="15" border="0" border="0"></a>';
		}</td>*/
	}?>	 
</tr>
<?php }?>
</table>
</div>
		  
	<table width="100%" height="21" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="311" height="21" align="left" valign="bottom" style="color:#999999"><span class="Estilo29">Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+0;//$resultados2 ?></strong> (de <strong><?php echo "1";//$total_registros?></strong> productos)</span>.</td>
    <td width="526" align="right" valign="bottom" style="color:#999999"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:13px">
      <?php 
			  
 if(($pagina - 1) > 0) { 
echo "<a style='cursor:pointer' onclick='cargardatos($pagina-1)'>< Anterior </a> "; 
} 

for ($i=1; $i<=1; $i++){ //$total_paginas
	if ($pagina == $i) { 
	echo "<b style='color:#000000'>".$pagina."</b> "; 
	} else { 
	echo "<a style='cursor:pointer' href='#' onclick='cargardatos($i)'>$i</a> "; 
	}
}
if(($pagina + 1)<=1) { //$total_paginas
echo " <a style='cursor:pointer' onclick='cargardatos($pagina+1)'>Siguiente ></a>"; 
} 
    ?>
	 &nbsp;&nbsp;</font> 
	 <input type="hidden" name="pag" id="pag" value="<?php echo $pagina?>" />
	</td>
  </tr>
</table><br>