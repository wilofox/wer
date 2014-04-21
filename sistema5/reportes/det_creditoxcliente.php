<?php 
	include('../conex_inicial.php'); 
	if(isset($_REQUEST['excel'])){
	header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=excel.xls");
echo "<table><tr><td colspan='10' height='100px' valign='middle' align='center' style='font-size:18px;font:bold' >Reporte  Creditos por cliente</td></tr></table>";
}
?>


<div id="detalle" style="width:1000px; height:200px; overflow:auto ; padding-left:10px;" >


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
		$tipdoc="";
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
	$sql="Select * from temp where cod_user='".$cod_user."' ";
 	$rs=mysql_query($sql,$cn);
	$cont=mysql_num_rows($rs);
	while ($row=mysql_fetch_array($rs)){
		$FilDocInc=" and cod_ope in (".$row['documentos'].") ";
		//$FilDocInc=" ";
	}
	//Filtro por transportista
	if ($transporte<>'0' and $transporte<>'' ){
	   $TransRk=" and transportista='".$transporte."'  ";
	}
	
	//filtro general  
	$filtro="where substring(fecha,1,10) between '".formatofecha($fecha1)."' and '".formatofecha($fecha2)."'  
			".$FilSR."   ".$FilTE."  ".$FilDocInc."	 ".$TransRk."	
 and  cliente in ( select codcliente from cliente where razonsocial like '%".$auxiliar."%'  )
			and tipo='2' and deuda='S'
 ";

// filtro de agrupacion				
		if ($agruparc==0){
			$SqlRk=" $filtro group by cliente
order by cliente ";
		}else{
			 $SqlRk=" $filtro group by LEFT( fecha, 10 )
order by fecha";
		}
			//echo $SqlRk;		
	
		// rem inicio de proceso ---------------------
		$resultados = mysql_query("select * from cab_mov  $SqlRk "  ,$cn);
		$total_registros = mysql_num_rows($resultados); 
		
		$sql2= "select * from cab_mov $SqlRk  LIMIT $inicio, $registros";

		// echo $sql2;
	$resultado2=mysql_query($sql2,$cn);
	$numitem=mysql_num_rows($resultado2);
	$total_paginas = ceil($total_registros / $registros); 
	while($row=mysql_fetch_array($resultado2)){
		
		
		?><div style="padding-top:5px;"></div>
		<table width="800" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td style="color:#000066; font-size:12px;"><b>
			<?
			if ($agruparc==0){
			echo $row['cliente'];
			//echo '&nbsp;&nbsp;&nbsp;';
				$sql="select * from cliente 
				where codcliente ='".$row['cliente']."' ";
				$resultadoX=mysql_query($sql,$cn);
					while($rowX=mysql_fetch_array($resultadoX)){
					echo '&nbsp;&nbsp;&nbsp;'.$rowX['razonsocial'];
					$auxiliar=$rowX['razonsocial'];
				}
				//transportista			
				if ($transporte<>'0' and $transporte<>'' ){
					$sql="select * from transportista 
					where id ='".$transporte."' ";
					$resultadoX=mysql_query($sql,$cn);
					while($rowX=mysql_fetch_array($resultadoX)){
						echo ' &nbsp;&nbsp;TRANSPORTISTA: '.$rowX['nombre'];			
						echo ' &nbsp;&nbsp;PLACA: '.$rowX['placa'];					
					}								
				 }
				 //chofer
				 $sql="select * from chofer 
					where cod ='".$row['chofer']."' ";
					$resultadoX=mysql_query($sql,$cn);
					while($rowX=mysql_fetch_array($resultadoX)){
						echo ' &nbsp;&nbsp;CHOFER: '.$rowX['nombre'];
				 }
				 	
			}else{
			echo formatobarrafecha(substr($row['fecha'],0,10));
				//transportista			
				if ($transporte<>'0' and $transporte<>'' ){
					$sql="select * from transportista 
					where id ='".$transporte."' ";
					$resultadoX=mysql_query($sql,$cn);
					while($rowX=mysql_fetch_array($resultadoX)){
						echo ' &nbsp;&nbsp;TRANSPORTISTA: '.$rowX['nombre'];			
						echo ' &nbsp;&nbsp;PLACA: '.$rowX['placa'];					
					}								
				 }
				 //chofer
				 $sql="select * from chofer 
					where cod ='".$row['chofer']."' ";
					$resultadoX=mysql_query($sql,$cn);
					while($rowX=mysql_fetch_array($resultadoX)){
						echo ' &nbsp;&nbsp;CHOFER: '.$rowX['nombre'];
				 }	
			}
				?></b></td>
          </tr>
  </table>

		<?php 	
		
if ($sucursal<>''){
	  $FilSR=' and  cm.sucursal in('.$sucursales2.') ';
	}
	if ($almacen<>'' and $sucursal<>0){
	  $FilTE=' and  cm.tienda in('.$tiendas2.') ';
	}

			
 $sql3="
SELECT *,cm.tienda as almacen FROM cab_mov cm
INNER JOIN condicion c ON cm.condicion = c.codigo
INNER JOIN cliente cl ON cm.cliente  = cl.codcliente
INNER JOIN usuarios u ON cm.cod_vendedor  = u.codigo
WHERE left( fecha, 10 ) = '".substr($row['fecha'],0,10)."'
and razonsocial like '%".$auxiliar."%' 

".$FilSR."   ".$FilTE."  ".$FilDocInc."	 ".$TransRk."	

 and tipo='2' order by concat(cod_ope,cm.serie,cm.Num_docu) asc ";
 //echo $sql3;
		$resultado3=mysql_query($sql3,$cn);
		$cont=0;?>
		<?php
		while($row3=mysql_fetch_array($resultado3)){
		
		list($placatrans)=mysql_fetch_array(mysql_query("select placa from transportista where id='".$row3['transportista']."'"));
		list($nomchof,$dnichof)=mysql_fetch_array(mysql_query("select nombre,dni from chofer where cod='".$row3['chofer']."'"));
		$cont++;
		//echo $tipdoc."!=".$row3['cod_ope'];
		 echo "<table border='0'><tr ><td colspan='12'>";
		if($cont>1 && $tipdoc!=$row3['cod_ope']){
			echo '<div align="right" style="color:#000066"><b>------------------------------------------<br>';
			echo 'TOTAL DOC. (S/.) &nbsp;&nbsp;&nbsp;'.number_format($TolSoles,2).'&nbsp;&nbsp;&nbsp;<br>';
			echo 'TOTAL DOC.(US$.) &nbsp;&nbsp;&nbsp;'.number_format($TolDolares,2).'&nbsp;&nbsp;&nbsp;</b><br><br><br></div>';	
			
		}
	
		if($cont==1 || $tipdoc!=$row3['cod_ope']) {
			echo "<b>Documento : ".$row3['cod_ope']."</b>";
			$TolSoles=0;
			$TolDolares=0;	
		}
			echo "</td></tr></table>";
		?>
		<table width="900" border="0" cellpadding="0" cellspacing="0">
  <tr >

	 <td width="26" align="center">&nbsp;</td>

    <td height="23" colspan="2" align="center" ><?=$row3['almacen'];?></td>
    <td width="85" align="center" ><?=$row3['cod_ope'].$row3['Num_doc'];?></td>
    <td width="81" ><?=formatobarrafecha(substr($row3['fecha'],0,10));?></td>
    <td width="92" ><?=caracteres($row3['flag_r']); ?></td>
    <td width="100" ><?=caracteres($row3['nombre']); ?></td>
    <td width="85" title="<?=caracteres($row3['razonsocial']);?>" ><? echo substr(caracteres($row3['razonsocial']), 0, 12)  ?></td>
    <td width="102" title="<?=$row3['usuario'];?>" ><? echo substr(caracteres($row3['usuario']), 0, 12)  ?></td>
    <td colspan="2" align="center"><? if ($row3['incluidoigv']=='S'){echo 'IGV Inclu.';}else{echo 'NO IGV Inclu.';} ?>&nbsp;</td>
    <td width="66" align="right"><? if ($row3['moneda']=='01'){echo'S/.';}else{echo'US$.';}  ?> <?=$row3['total']; ?></td>
  </tr>
</table>
		<?php 		
		
		

	$j=0;
		
		$sql="select * from det_mov dm
		where cod_cab ='".$row3['cod_cab']."'
		";
$resultado4=mysql_query($sql,$cn);
while($row4=mysql_fetch_array($resultado4)){
 	$j++;
				if($j%2==0){
				$color_row='#ccccccc';
				}else{
				$color_row='#FFFFFF';
				}	
	      ?>
<table bgcolor="<?php echo $color_row?>" width="970" height="20" border="0" cellpadding="0" cellspacing="2"  >
  <tr>   
	<td width="10" align="center"></td>
    <td width="61" align="center" ><?php echo $row4['cod_prod'] ?></td>
    <td width="280" title="<?=$row4['nom_prod'];?>" ><? echo substr(caracteres($row4['nom_prod']), 0, 40)  ?></td>
<td width='230'><?php echo $nomchof ?></td>
<td width='100'><?php echo $dnichof ?></td>
<td><?php echo $placatrans ?></td>
    <!--<td width="68" align="center" ><?php echo $row4['precosto'] ?></td>-->
	<td width="61" align="center" ><?php echo $row4['cantidad'] ?></td>
    <td width="74" align="center" ><?php echo number_format($row4['precio']+0.0000,4)/*echo number_format($row3['total']/$row4['cantidad'],2)*/  ?></td>
    <td width="62" align="right"><?php echo number_format($row4['precio']*$row4['cantidad'],2) ?>	
	<? 
	if ($row3['moneda']=='01'){
		$TolSoles+=number_format($row4['precio']*$row4['cantidad'],2) ;
	}else{
		$TolDolares+=number_format($row4['precio']*$row4['cantidad'],2) ;
	}  ?> 
	</td>
  </tr>
</table>
		<?php 
			}
			
			//$TolS+=$TolSoles;
			//$TolD+=$TolDolares;
			if ($row3['moneda']=='01'){
			
				$TolS+=$row3['total'];
			}else{
				$TolD+=$row3['total'];
			}  
	
			//echo $TolSoles."<br/>";
			//echo $TolS."<br/>";
			if($tipdoc!=$row3['cod_ope']){
				$tipdoc=$row3['cod_ope'];
			
				//echo $tipdoc;

				}

		}
			echo '<div align="right" style="color:#000066"><b>------------------------------------------<br>';
			echo 'TOTAL DOC. (S/.) &nbsp;&nbsp;&nbsp;'.number_format($TolSoles,2).'&nbsp;&nbsp;&nbsp;<br>';
			echo 'TOTAL DOC. (US$.) &nbsp;&nbsp;&nbsp;'.number_format($TolDolares,2).'&nbsp;&nbsp;&nbsp;</b><br><br>					<br></div>';
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
		<table width="804">
      <tr>
        <td width="562" height="26">Viendo del <?php echo $inicio+1?> al <?php echo $inicio+$numitem ?> (de <?php echo $total_registros?> documentos) </td>
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
<?php } ?>	