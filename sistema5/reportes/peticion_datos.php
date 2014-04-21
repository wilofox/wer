<?php 
include('../conex_inicial.php');
include ('../funciones/funciones.php');

$peticion=$_REQUEST['peticion'];
$codLider=$_REQUEST['codLider'];
$fecha1=formatofecha($_REQUEST['fecha1']);
$fecha2=formatofecha($_REQUEST['fecha2']);
$codcliente=$_REQUEST['codcliente'];
$campoOrder=$_REQUEST['campoOrder'];
$tOrder=$_REQUEST['tOrder'];

switch($peticion){
	case "cargarClientes":
	
		$strSQL="select * from cliente where codlider='".$codLider."'";
		$resultado=mysql_query($strSQL,$cn);
				//echo $strSQL;
		while($row=mysql_fetch_array($resultado)){
		
		
		list($cantDoc)=mysql_fetch_row(mysql_query("select count(cod_cab) from cab_mov where cliente='".$row['codcliente']."' and tipo='2' and deuda='S' and substring(fecha,1,10) between '$fecha1' and '$fecha2' "));
		
		list($totaCompras1,$totalpuntos1)=mysql_fetch_row(mysql_query("select sum(total), sum(puntos) from cab_mov where cliente='".$row['codcliente']."' and tipo='2' and deuda='S' and cod_ope!='NC' and substring(fecha,1,10) between '$fecha1' and '$fecha2' and flag!='A'" ));
		
		list($totaCompras2,$totalpuntos2)=mysql_fetch_row(mysql_query("select sum(total), sum(puntos) from cab_mov where cliente='".$row['codcliente']."' and tipo='2' and deuda='S' and cod_ope='NC' and substring(fecha,1,10) between '$fecha1' and '$fecha2' and flag!='A'"));
		
		$totaCompras=$totaCompras1-$totaCompras2;
		$totalpuntos=$totalpuntos1-$totalpuntos2;
				
		$totgen1+=$cantDoc;
		$totgen2+=$totaCompras;		
		$totgen3+=$totalpuntos;
							
		?>
		<table width="630" border="0" cellspacing="0" cellpadding="1" id="tblClie">
     	<tr  onclick="entrada(this)">
        <td width="50" align="center"  style=" border-bottom:#CCCCCC solid 1 px"><span class="Estilo10"><?php echo $row['codcliente']?></span></td>
        <td width="280"  style=" border-bottom:#CCCCCC solid 1 px"><span class="Estilo10"><?php echo $row['razonsocial']?></span></td>
        <td width="75" align="center" style=" border-bottom:#CCCCCC solid 1 px"><span class="Estilo10"><?php echo $row['ruc']?></span></td>
        <td width="65" align="center"  class="Estilo10" style=" border-bottom:#CCCCCC solid 1 px"><?php echo $cantDoc ?></td>
        <td width="65" align="right"  class="Estilo10" style=" border-bottom:#CCCCCC solid 1 px"><?php echo number_format($totaCompras,2)?></td>
        <td width="65" align="center"  class="Estilo10" style=" border-bottom:#CCCCCC solid 1 px"><?php echo $totalpuntos;?></td>
     	<td width="30" align="center"  style=" border-bottom:#CCCCCC solid 1 px"><img style="cursor:pointer;" onclick="cargarDoc('<?php echo $row['codcliente']?>','fecha','desc')" src="../imagenes/ico_lupa.png" width="15" height="14"></td>
     	</tr>
     	
</table>
		<?php 
		
		}
		?>
	   
		 <table width="630" border="0" cellspacing="0" cellpadding="1" >
			<tr  >
        <td width="50" align="center"  style=" border-bottom:#CCCCCC solid 1 px">&nbsp;</td>
        <td width="280"  style=" border-bottom:#CCCCCC solid 1 px">&nbsp;</td>
        <td width="75" align="center" style=" border-bottom:#CCCCCC solid 1 px" class="Estilo15"><strong>Totales</strong></td>
        <td width="65" align="center"  class="Estilo10" style=" border-bottom:#CCCCCC solid 1 px"><strong><?php echo $totgen1?></strong></td>
        <td width="65" align="right"  class="Estilo10" style=" border-bottom:#CCCCCC solid 1 px"><strong><?php echo number_format($totgen2,2)?></strong></td>
        <td width="65" align="center"  class="Estilo10" style=" border-bottom:#CCCCCC solid 1 px"><strong><?php echo $totgen3?></strong></td>
     	<td width="30" align="center"  style=" border-bottom:#CCCCCC solid 1 px">&nbsp;</td>
     	</tr>
	  </table>
		<?php 
	break;
	
	case "cargarDoc":
	
	$strSQL="select * from cab_mov where cliente='".$codcliente."' and tipo='2' and deuda='S' and substring(fecha,1,10) between '$fecha1' and '$fecha2' order by $campoOrder $tOrder";
		$resultado=mysql_query($strSQL,$cn);
		$cont=mysql_num_rows($resultado);
		if($cont==0){
		echo "<span class='Estilo10'>Este Cliente no tiene Documentos.......</span>";
		}
				//echo $strSQL;
		while($row=mysql_fetch_array($resultado)){
		
		if($row['flag']=='A'){
		$anulado=" class='anulado' ";
		$hidden=" visibility: hidden ";
		}else{
		$anulado=" ";
		$hidden="";
		}
							
		?>
		<table <?php echo $anulado?> width="618" border="0" cellspacing="1" cellpadding="0">
     	<tr >
        <td  width="124" align="center"  style=" border-bottom:#CCCCCC solid 1 px"><span class="Estilo10"><?php echo extraefecha4($row['fecha'])?></span></td>
        <td width="58" align="center"  style=" border-bottom:#CCCCCC solid 1 px"><span class="Estilo10"><?php echo $row['tienda']?></span></td>
        <td width="69" align="center" style=" border-bottom:#CCCCCC solid 1 px"><span class="Estilo10"><?php echo $row['cod_ope']?></span></td>
        <td width="106" align="center"  class="Estilo10" style=" border-bottom:#CCCCCC solid 1 px"><?php echo $row['serie']." - ".$row['Num_doc'] ?></td>
        <td width="91" align="right"  class="Estilo10" style=" border-bottom:#CCCCCC solid 1 px; <?php echo $hidden ?>"><?php echo number_format($row['total'],2)?></td>
        <td width="115" align="center"  class="Estilo10" style=" border-bottom:#CCCCCC solid 1 px; <?php echo $hidden ?>"><?php echo $row['puntos']?></td>
     	<td width="47" align="center"  style=" border-bottom:#CCCCCC solid 1 px"><img style="cursor:pointer;" onClick="doc_det('<?php echo $row['cod_cab']?>')" src="../imagenes/ico_lupa.png" width="15" height="14"></td>
     	</tr>
</table>
		<?php 
		}
		list($razonsocial)=mysql_fetch_row(mysql_query("select razonsocial from cliente where codcliente='".$codcliente."' "));
		
	echo "|".$razonsocial."|".$codcliente;
		
	break;
	
}

?>
