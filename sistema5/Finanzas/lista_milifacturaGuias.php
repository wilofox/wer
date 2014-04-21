<?
//Borrar Sesion multifactura
include('../conex_inicial.php');
include('../funciones/funciones.php');

if(isset($_REQUEST['excel'])){
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=excel.xls");
$visible=" style='visibility:hidden' ";


if($_REQUEST['almacen']!='0'){
 		$resultados1 = mysql_query("select * from sucursal where cod_suc='".$_REQUEST['almacen']."' ",$cn);			  
		while($row1=mysql_fetch_array($resultados1))
		{
		$empresa_razon=$row1['des_suc'];
		}
}else{
$empresa_razon=" TODAS ";
}		
		

echo "
<table>
<tr><td colspan='8' align='center' style='font-size:20px' ><strong>REPORTE DE VENCIMIENTO DE LETRAS / CHEQUES</strong></td></tr>
<tr><td colspan='8' align='center'><strong>Del: ".$_REQUEST['fec1']." Al: ".$_REQUEST['fec2']." </strong></td></tr>
<tr><td colspan='8' align='center' ><strong>EMPRESA: ".$empresa_razon."</strong></td></tr>
<tr><td colspan='8' align='center' ><strong></strong></td></tr>

<tr><td width='64' height='21' align='center'  style=' border:#CCCCCC solid 1px;cursor:pointer; text-decoration:underline'><span class='texto2'><strong>Fec.  Venc </strong></span></td> 
          <td width='62'  style=' border:#CCCCCC solid 1px; display:block'><span class='texto2'><strong>Fec. Emi</strong></span></td>
		    <td  style=' border:#CCCCCC solid 1px;cursor:pointer; text-decoration:underline;' width='87' ><span class='texto2'><strong>Letra / Cheque </strong></span></td>
		  
            <td   style=' border:#CCCCCC solid 1px;cursor:pointer; text-decoration:underline' width='107' ><span class='texto2'><strong>Proveedor</strong></span>&nbsp;		  </td>
          
           
          <td  style=' border:#CCCCCC solid 1px' width='34' ><span class='texto2'><strong>Mon</strong></span></td>
          <td  style=' border:#CCCCCC solid 1px' width='61' ><span class='texto2'><strong>Saldo</strong></span></td>
          <td  style=' border:#CCCCCC solid 1px' width='76' ><span class='texto2'><strong>Nro Canje </strong></span></td>
          <td width='112'  style=' border:#CCCCCC solid 1px;cursor:pointer; text-decoration:underline' ><span class='texto2'><strong>Referencia </strong></span></td>
</tr>
</table>


";

}else{
session_start();
}
		


		
		unset($_SESSION['Multifactura']);
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
<div id="detalle" style="width:790px; height:180px; overflow:auto" >
<table width="772" height="24" border="0" cellpadding="0" cellspacing="0" id="lista_productos">
  <?php 
		
		 $registros = 100; 
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
			
			$almacen=$_REQUEST['almacen'];
			$cliente=$_REQUEST['cliente'];
			$ruc=$_REQUEST['ruc'];
			$vendedor=$_REQUEST['vendedor'];
			$docref=$_REQUEST['docref'];
			$fec1=$_REQUEST['fec1'];
			$fec2=$_REQUEST['fec2'];
			$mosdocFac=$_REQUEST['mosdocFac'];
			$mosdocAnu=$_REQUEST['mosdocAnu'];
			$Estado=$_REQUEST['Estado'];
			$cmbmoneda=$_REQUEST['cmbmoneda'];
			$formaOrder=$_REQUEST['formaOrder'];
			$campoOrder=$_REQUEST['campoOrder'];

		if($campoOrder!="" && $formaOrder!=""){
			$filtroOrden=" order by  ".$campoOrder." ".$formaOrder; 
		}else{		
			if($_REQUEST['ordenar']!=""){
			 	$filtro2=" order by ".$_REQUEST['ordenar']. " ".$_REQUEST['orden']; 	
			}else{
				$filtro2=" order by fecha desc "; 	
			}
		}
			
		if ($almacen=='0'){	
		/*
			$strSQL22="select * from tienda order by cod_tienda";
			$resultado22=mysql_query($strSQL22,$cn);
			while($row22=mysql_fetch_array($resultado22)){
			 //$tiendas= $tiendas.$row22['cod_tienda']."',";
			 //2013
			  $tiendas= $tiendas."'".$row22['cod_tienda']."',";
			}
		*/
			
		//$tiendas2=substr($tiendas,0,strlen($tiendas)-1);
		
		//$almacen1  =" tienda in(".$tiendas2.") ";		
		$almacen1  =" ";		
		}else{
		$almacen1 = " sucursal='$almacen' ";
		}	
		
		if($cliente!=''){
		
		$filtroClie=" and cl.razonsocial like '%".$cliente."%' ";
		
		}

if ($mosdocAnu<>''){			
 echo $SQLMosDoc=" and flag ='$mosdocAnu' ";
}

if ($Estado<>''){
		  if (trim($Estado)=='T'){
			 $SQLEstado ="";
		  }elseif (trim($Estado)=='P'){
			//$SQLEstado =" and flag_r <>'RA' and flag<>'A' and estadoOT<>'O' and estadoOT<>'T' "; 
			$SQLEstado =" and flag_r ='' and flag<>'A' ";
		  }elseif (trim($Estado)=='F'){
		  	$SQLEstado =" and flag_r <>'' ";
		  }else{			
			//$SQLEstado =$Estado;
			 $SQLEstado =" and flag='A' ";
		  }	
 }else{
	//$SQLEstado =" and flag_r <>'RA' and flag<>'A' and estadoOT<>'O' and estadoOT<>'T' ";
	$SQLEstado =" and flag_r =''  and flag<>'A' ";	  
 }
  
//echo $SQLEstado; 
  
if ($cmbmoneda==''){
	$Cmoneda='';
}else{
	$Cmoneda=" and moneda='".$cmbmoneda."' ";
}
 /*
 $SQLConsulta=" where $almacen1
 and cod_ope='$docref'
 and CM.tipo='2'
 and cod_vendedor like '%$vendedor%'
 and C.razonsocial like '%$cliente%'	
 and C.ruc like '%$ruc%'
 and substring(fecha,1,10) between '".formatofecha($fec1)."' and '".formatofecha($fec2)."'
 $SQLMosDoc $SQLEstado $Cmoneda
    ";
*/

$consultaSQL=" ( select md.det_id as det_id, md.fechavcto as fechavcto, mc.fecha as fecha,md.letra as letra, mc.cliente as cliente,md.moneda as moneda,mc.multi_id as multi_id,mc.numcje as numcje,md.saldo as saldo,mc.tcambio as tcambio from multi_det md ,multicj mc,cliente cl where md.fechavcto between '".formatofecha($fec1)."' and '".formatofecha($fec2)."' and mc.multi_id=md.multi_id and mc.estado!='A' and mc.tipo='1' and mc.cliente=cl.codcliente $filtroClie ) 
UNION 
( select  id as det_id, fechavenc as fechavcto, fecha2 as fecha,numero as letra, proveedor as cliente,cuenta as moneda,id as multi_id, 'CHEQUE' as numcje, importe as saldo, tc as tcambio  from progpagos , cliente cl where proveedor=cl.codcliente $filtroClie and fechavenc between '".formatofecha($fec1)."' and '".formatofecha($fec2)."' )
order by fechavcto asc";

$resultados = mysql_query($consultaSQL,$cn);
$total_registros = mysql_num_rows($resultados); 	
if(!isset($_REQUEST['excel'])){			
$strSQL=$consultaSQL." LIMIT $inicio, $registros ";		
}else{
$strSQL=$consultaSQL." ";		
}
//echo $strSQL;
	
			$j=0;
			$resultado=mysql_query($strSQL,$cn);		

	$resultados2 =mysql_num_rows($resultado); 
	$total_paginas = ceil($total_registros / $registros); 
			
			while($row=mysql_fetch_array($resultado)){
						 
			 	$j++;
				if($j%2==0){
				$color_row='#FFFFFF';//'#E9F3FE';
				}else{
				$color_row='#FFFFFF';
				}	
// documentos anulados rojo
$AnRK='';	
$sql="select * from cab_mov 
where cod_cab  ='".$row['cod_cab']."' ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX['flag']=='A'){
		$color_row='#FF0000';
		$AnRK='2';
	}
}	
// documentos con serie (anulara y desanular no permite)
$sql="select * from series where producto in  (
select cod_prod from det_mov where cod_cab='".$row['cod_cab']."' )
and tienda='$almacen'  LIMIT 0, 1  ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX['id']<>''){
		$color_row='#D7FFF0';
		//$AnRK='3';
	}
}				
 //documentos facturado o canjeado
 /*
$sql="select * from referencia where cod_cab_ref='".$row['cod_cab']."'  
LIMIT 0, 1  "; // and flag_r='RO' 
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	//if ($rowX['flag_r']=='RO' || $rowX['flag_r']=='RORA'){
		$color_row='#0066FF';
		$AnRK='3';
	//}
}	*/
		if($row['flag_r']){
		$color_row='#78B5FE';
		$AnRK='3';
		}	
		
		
		
		if($tempFe!=$row['fechavcto']){
		
			if($j!=1){
			
			$totalDia=$totalDia;
			
			if(isset($_REQUEST['excel'])){
			echo "<tr>
		   <td colspan='8' height='20px' align='right' ><strong>TOTAL DIA S/. : ".number_format($totalDia,2)."</strong></td>
		   </tr>";				
			}else{
			echo "<tr>
		   <td colspan='10' height='20px' align='right' ><strong>TOTAL DIA S/. : ".number_format($totalDia,2)."</strong></td>
		   </tr>";	
			}
			
		   
		   
		   
			$totalDia=0;
			}		
			
		   echo "<tr>
		   <td colspan='10' height='20px' style='color:#0999FF'  align='left'  ><strong>".formatofecha($row['fechavcto'])."</strong></td>
		   </tr>";			   
						
		}
		
		$tempFe=$row['fechavcto'];
		
		if($row['moneda']=='02'){
		$saldo=$row['saldo']*$row['tcambio'];
		}else{
		$saldo=$row['saldo'];
		}
		
		$totalDia=$totalDia + $saldo;
			 					
?>
			
  <tr bgcolor="<?php echo $color_row?>" onClick="entrada(this);" ondblclick="doc_det(this)" >
    <?php if(!isset($_REQUEST['excel'])){?>
	  <td width="35" align="center" valign="top" style="border-bottom:#E9E9E9 solid 1px " >
	  	
	  <input style="border: 0px; background:none; " type="radio" name="XDato" value="<?php  echo $row['det_id']?>" />
	  	
	  
	  <b><?=$j;?>	  
	  </b></td>
	  
      <td width="20" align="center" valign="top" class="texto1" style="display:none; border-bottom:#E9E9E9 solid 1px" >	  
	   	
	   <? if ($AnRK<>'3'){ ?>
	   <input style="border: 0px; background:none; " type="checkbox" name="xcodigo" value="<?=$row['cliente'];?><?=$row['det_id'];?>" onclick="Anular('S<?=$AnRK;?>')" />
	  <? } ?>	  </td>
	  <?php } ?>
	  
              <td width="75" align="center" valign="top" class="texto1" style="border-bottom:#E9E9E9 solid 1px " ><?php echo formatofecha($row['fechavcto'])?></td>
              <td width="79" align="center" valign="top" class="texto1" style="border-bottom:#E9E9E9 solid 1px " ><?php echo extraefecha($row['fecha']); ?></td>
              <td width="109" valign="top" class="texto1" style="border-bottom:#E9E9E9 solid 1px " align="center"><?php echo $row['letra'] ?></td>			   
              <td width="154" valign="top" class="texto1" style="border-bottom:#E9E9E9 solid 1px "><?php 
			  
			  list($razonsocial)	=	mysql_fetch_array(mysql_query("select razonsocial from cliente where codcliente='".$row['cliente']."'"));
			  echo $razonsocial;
			  
			  ?></td>
              <td width="27" align="center" valign="top" class="texto1" style="border-bottom:#E9E9E9 solid 1px "><?  
			  
			  if($row['moneda']=='02'){echo 'US$.';}else{echo 'S/.';}
			 
			   ?></td>
              <td width="79" align="right" valign="top" class="texto1" style="border-bottom:#E9E9E9 solid 1px "><?php echo number_format($row['saldo'],2)?></td>
			  <td width="88" align="center" valign="top" class="texto1" style="border-bottom:#E9E9E9 solid 1px "><a style="cursor:pointer" onclick="doc_det2('<?php echo $row['multi_id'];?>')"><?php 
			 echo $row['numcje'];
				?></a></td>
			  <td width="106" align="center" valign="top" class="texto1" style="border-bottom:#E9E9E9 solid 1px "><?php 
		
		if($row['numcje']!='CHEQUE'){
			  
			$strSQLSM="select * from multi_doc where multi_id='".$row['multi_id']."' order by cab_mov ";
			$resultadoMS=mysql_query($strSQLSM,$cn);
			//$rowSM=mysql_fetch_array($resultadoMS);
			//echo $sucursal=$rowSM['serie'].'-'.$rowSM['correlativo'];
			$codRefec="";
			while($rowSM=mysql_fetch_array($resultadoMS)){
			$codRefec.=','.$rowSM['cab_mov'];
			//echo $codRefec;
			}
				$strSQL2="select * from cab_mov where cod_cab in (0".$codRefec.") ";
				$resultado2=mysql_query($strSQL2,$cn);
				//$rowR=mysql_fetch_array($resultadoMS);   	
				while($rowR=mysql_fetch_array($resultado2)){
		
					echo "<a style=cursor:pointer onclick=doc_det3('".$rowR['cod_cab']."')>".$rowR['cod_ope'].'-'.$rowR['serie'].'-'.$rowR['Num_doc'].'</a> <br> ';	
					
				}
		
		}else{
		
				$strSQL2="select * from progpagos_det where id_progpagos='".$row['multi_id']."'";
				$resultado2=mysql_query($strSQL2,$cn);
				//$rowR=mysql_fetch_array($resultadoMS);   	
				while($rowR=mysql_fetch_array($resultado2)){
		
					echo "<a style=cursor:pointer onclick=doc_det3('".$rowR['cod_cab']."')>".$rowR['cod_ope'].'-'.$rowR['serie'].'-'.$rowR['numero'].'</a> <br> ';	
					
				}
		
				
		}
		
	
	
		
			   ?></td>			 
    </tr>
  
  <?php }
  
  
  if(isset($_REQUEST['excel'])){
			echo "<tr>
		   <td colspan='8' height='20px' align='right' ><strong>TOTAL DIA S/. : ".number_format($totalDia,2)."</strong></td>
		   </tr>";				
	}else{
			echo "<tr>
		   <td colspan='10' height='20px' align='right' ><strong>TOTAL DIA S/. : ".number_format($totalDia,2)."</strong></td>
		   </tr>";	
	}
  
  ?>
</table>
</div>
	
	<?php if(!isset($_REQUEST['excel'])){ ?>
		  
	<table width="100%" height="21" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="311" height="21" align="left" valign="bottom" style="color:#999999"><span class="Estilo29">Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (de <strong><?php echo $total_registros?></strong> registros)</span>.</td>
    <td width="526" align="right" valign="bottom" style="color:#999999"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:13px">

<?php 
			  
 if(($pagina - 1) > 0) { 
echo "<a style='cursor:pointer' onclick='cargardatos($pagina-1)'>< Anterior </a> "; 
} 

for ($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
	echo "<b style='color:#000000'>".$pagina."</b> "; 
	} else { 
	echo "<a style='cursor:pointer' href='#' onclick='cargardatos($i)'>$i</a> "; 
	}
}
if(($pagina + 1)<=$total_paginas) { 
echo " <a style='cursor:pointer' onclick='cargardatos($pagina+1)'>Siguiente ></a>"; 
}
 
?>
	 &nbsp;&nbsp;</font> 
	 <input type="hidden" name="pag" id="pag" value="<?php echo $pagina?>" />
	</td>
  </tr>
</table><br>

<?php } ?>