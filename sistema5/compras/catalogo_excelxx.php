<?php 
//session_start();
include('../conex_inicial.php');

if($_REQUEST['formato']=="excel"){

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=excel.xls");
}

		$registros = 40; 
		$pagina = $_REQUEST["pagina"]; 
		
		if (!$pagina) { 
		$inicio = 0; 
		$pagina = 1; 
		} 
		else { 
		$inicio = ($pagina - 1) * $registros; 
		}

		$filtro_cla=$_REQUEST['filtro_cla'];
		$filtro_cat=$_REQUEST['filtro_cat'];
		$filtro_sub=$_REQUEST['filtro_sub'];
		
		$agr_cla=$_REQUEST['agr_cla'];
		$agr_cat=$_REQUEST['agr_cat'];
		$agr_sub=$_REQUEST['agr_sub'];
		$agr_cant=$_REQUEST['agr_cant'];	
		$agr_stck=$_REQUEST['agr_stck'];
		$moneda=$_REQUEST['moneda'];
		$valor=$_REQUEST['valor'];	
		$almacen=$_REQUEST['almacen'];
		$precio1=$_REQUEST['precio1'];
		$precio2=$_REQUEST['precio2'];
		$precio3=$_REQUEST['precio3'];
		$precio4=$_REQUEST['precio4'];
		$precio5=$_REQUEST['precio5'];
		$precio6=$_REQUEST['precio6'];
				
		
		
		//echo  $precio2;
		
		$filtro_ordenar=$_REQUEST['ordenar'];
		$filtro_precio="";
		
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>

</head>

<script>
function cerrar(){
//alert();
//window.close();
}

</script>

<body >

<div id="seleccion" style="height:600px; width:670px; overflow:auto" >


<style type="text/css">
<!--
.Estilo10 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo11 {font-family: Arial, Helvetica, sans-serif}
.Estilo13 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.Estilo15 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	font-weight: bold;
}
.Estilo17 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.Estilo19 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
body {
	margin-left: 20px;
	margin-top: 5px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo33 {color: #000000}
-->
</style>
<table width="636" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" style="border:#999999 solid 1px" >
  <tr>
    <td colspan="10"><table width="100%" border="0" cellpadding="0" cellspacing="0" >
      <tr>
        <td colspan="8" class="Estilo19" >P&aacute;gina <?php echo $pagina; ?></td>
        <td align="right" colspan='2'><span class="Estilo13">Fecha: <?php echo date('d-m-Y');?></span></td>
      </tr>
      <tr>
        <td width="23">&nbsp;</td>
        <td align="center" colspan='7'><span class="Estilo15">Reporte de Cat&aacute;logo de Productos</span></td>
        <td align="right" colspan="2"><span class="Estilo13">Hora : <?php echo date('H:i:s',time()-3600)?></span></td>
      </tr>
      <tr>
        <td colspan="10" align="center"><span class="Estilo17">Al: <?php echo date('d-m-Y')?></span></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td width="7%" height="29"><span class="Estilo13">C&oacute;digo</span></td>
    <td width="21%"><span class="Estilo13">Nombre de Art&iacute;culo </span></td>
    <td width="11%"><span class="Estilo13">Uni. </span></td>
    
    <?php if($agr_cant1=='S'){?><td  width="6%"><span class="Estilo13" >Cant.</span></td><?php } ?>
    
    <td width="6%"><span class="Estilo13">Mon.</span></td>
  <?php if($precio1=='true'){ ?>  <td width="8%" align="right" ><span class="Estilo13">Precio1</span></td><?php } ?>
   <?php if($precio2=='true'){ ?>  <td width="8%" align="right" ><span class="Estilo13">Precio2</span></td><?php } ?>
    <?php if($precio3=='true'){ ?> <td width="8%" align="right" ><span class="Estilo13">Precio3</span></td><?php } ?>
    <?php if($precio4=='true'){ ?> <td width="8%" align="right" ><span class="Estilo13">Precio4</span></td><?php } ?>
    <?php if($precio5=='true'){ ?> <td width="8%" align="right" ><span class="Estilo13">Precio5</span></td><?php } ?>
    <?php if($precio6=='true'){ ?> <td width="9%" align="right" ><span class="Estilo13">Prec.Ref.</span></td><?php } ?>
  </tr>
  <?php 

		
	if($moneda=='01'){
	 	$SqlMonRk=",REPLACE( moneda, '02', '01' ) as monedaSD";
	}elseif($moneda=='02'){
	 	$SqlMonRk=",REPLACE( moneda, '01', '02' ) as monedaSD";	
	}else{
	 	$SqlMonRk="";	
	}
	
		//echo $filtro_cat;
		
	if($filtro_cla!="" || $filtro_cat!="" || $filtro_sub!=""){	
	 
	    if($filtro_cla!="" and $agr_cla=='S'){
		$filtro1=" and clasificacion='$filtro_cla' ";
		}		
		if($filtro_cat!="" and $agr_cat=='S' ){
		$filtro1.=" and categoria='$filtro_cat' ";
		}
		if($filtro_sub!="" and $agr_sub=='S' ){
		$filtro1.=" and subcategoria='$filtro_sub' ";
		}			
	}

/*	if($almacen!="0"){
		 $filtro3=" and saldo$almacen > 0";
	}
	*/
	if($agr_stck=="S") {$mstck=" > 0 ";}else{ $mstck=" >= 0 ";}
	if($almacen=="0"){
			$strSQL22="select * from tienda  order by cod_tienda";
			$resultado22=mysql_query($strSQL22,$cn);
			while($row22=mysql_fetch_array($resultado22)){
			 $saldos[]="saldo".$row22['cod_tienda'];
			}
				
				
				$filtro3=" and ( ";
				for($i=0;$i<count($saldos);$i++){
				$filtro3=$filtro3." + ".$saldos[$i];
				}
				$filtro3.=" ) ".$mstck;
	}else{
	//$sumsaldos="saldo".$tienda;
	$filtro3=" and saldo$almacen ".$mstck;
	}
			
	
	$filtro2=" and nombre like '%$valor%' " ;
	
	$filtro1= "where  kardex<>'' and concepto!='S' $filtro2 "; //$filtro1 $filtro2  $filtro3 

		//$strSQL="select ".$filtro2.",idproducto,nombre, p.* from producto p ,clasificacion ,categoria ,subcategoria where ".$filtro3." ".$filtro1." ".$filtro_incluir."  group by nombre,idproducto order by des_clas asc,des_cat asc,des_subcateg asc, ".$filtro_ordenar." ";	
		
	echo	$strSQL="Select *  $SqlMonRk from producto ".$filtro1."  order by  ".$filtro_ordenar."  ";
		//echo $strSQL;
		$resultado = mysql_query($strSQL); 
		$total_registros = mysql_num_rows($resultado);
		
		if($_REQUEST['formato']=="excel"){		 
		$resultado = mysql_query($strSQL); 
		}else{
		$resultado = mysql_query($strSQL." LIMIT $inicio, $registros"); 
		}	
		$resultados2 =mysql_num_rows($resultado); 
		$total_paginas = ceil($total_registros / $registros);   
		
		
			
		
		
		while($row=mysql_fetch_array($resultado)){
		
				 if($almacen==0 || $almacen==""){
					$tot_saldo=0;
					for($i=0;$i<count($saldos);$i++)
						$tot_saldo=$tot_saldo+$row[$saldos[$i]];
				 }else{
				   $campo="saldo".$almacen;
				   $tot_saldo=$row[$campo];				   
				 }				 
?>
  <tr>
    <td valign="top"><span class="Estilo10"><?php echo $row['idproducto'];?></span></td>
    <td><span class="Estilo10"><?php echo $row['nombre'];?></span></td>
    <td align="center" ><span class="Estilo10">
      <?php 
			  
			$strSQL23="select * from unidades where id='".$row['und']."' ";
			$resultado23=mysql_query($strSQL23,$cn);
			$row23=mysql_fetch_array($resultado23);
			echo $row23['nombre'];
			  
			   ?>
    </span></td>
    <?php if($agr_cant1=='S'){?><td ><span class='Estilo10' ><?php  echo $tot_saldo ?></span></td><?php }?>
    <td align="center"><span class="Estilo10">
      <?  
			  if($moneda==''){
			  if ($row['moneda']=='02'){echo 'US$.';}else{echo 'S/.';}
			  }else{
			  if ($row['monedaSD']=='02'){echo 'US$.';}else{echo 'S/.';}
			  }
			   ?>
    </span></td>
   <?php if($precio1=='true'){?> <td align="right" ><span class="Estilo10">
      <?php 
			  if ($row['moneda']==$moneda ||  $moneda == ''){
					echo  number_format($row['precio'],4);	
			  }else{
				   if ($row['moneda']=='02'){
					echo  number_format($row['precio'] * $_SESSION['tc'],4);					
					}
			 		if ($row['moneda']=='01'){
					echo  number_format($row['precio'] / $_SESSION['tc'],4);	
					}				
			  }?>
    </span></td><?php } ?>
	
	<?php if($precio2=='true'){?>
    <td align="right" ><span class="Estilo10">
      <?php 
			  if ($row['moneda']==$moneda ||  $moneda == ''){
					echo  number_format($row['precio2'],4);	
			  }else{
				   if ($row['moneda']=='02'){
					echo  number_format($row['precio2'] * $_SESSION['tc'],4);					
					}
			 		if ($row['moneda']=='01'){
					echo  number_format($row['precio2'] / $_SESSION['tc'],4);	
					}				
			  }?>
    </span></td><?php } ?>
    <?php if($precio3=='true'){?>
	<td align="right" ><span class="Estilo10">
      <?php 
			  if ($row['moneda']==$moneda ||  $moneda == ''){
					echo  number_format($row['precio3'],4);	
			  }else{
				   if ($row['moneda']=='02'){
					echo  number_format($row['precio3'] * $_SESSION['tc'],4);					
					}
			 		if ($row['moneda']=='01'){
					echo  number_format($row['precio3'] / $_SESSION['tc'],4);	
					}				
			  }?>
    </span></td><?php } ?>
	<?php if($precio4=='true'){?>
    <td align="right" style="display:<?php if($precio4=='false'){echo "none";}?>"><span class="Estilo10">
      <?php 
			  if ($row['moneda']==$moneda ||  $moneda == ''){
					echo  number_format($row['precio4'],4);	
			  }else{
				   if ($row['moneda']=='02'){
					echo  number_format($row['precio4'] * $_SESSION['tc'],4);					
					}
			 		if ($row['moneda']=='01'){
					echo  number_format($row['precio4'] / $_SESSION['tc'],4);	
					}				
			  }?>
    </span></td><?php } ?>
	<?php if($precio5=='true'){?>
    <td align="right" style="display:<?php if($precio5=='false'){echo "none";}?>"><span class="Estilo10">
      <?php 
			  if ($row['moneda']==$moneda ||  $moneda == ''){
					echo  number_format($row['precio5'],4);	
			  }else{
				   if ($row['moneda']=='02'){
					echo  number_format($row['precio5'] * $_SESSION['tc'],4);					
					}
			 		if ($row['moneda']=='01'){
					echo  number_format($row['precio5'] / $_SESSION['tc'],4);	
					}				
			  }?>
    </span></td><?php } ?>
	<?php if($precio6=='true'){?>
    <td align="right" style="display:<?php if($precio6=='false'){echo "none";}?>"><span class="Estilo10">
      <?php 
			  if ($row['moneda']==$moneda ||  $moneda == ''){
					echo  number_format($row['pre_ref'],4);	
			  }else{
				   if ($row['moneda']=='02'){
					echo  number_format($row['pre_ref'] * $_SESSION['tc'],4);					
					}
			 		if ($row['moneda']=='01'){
					echo  number_format($row['pre_ref'] / $_SESSION['tc'],4);	
					}				
			  }?>
    </span></td><?php } ?>
  </tr>
  <?php 
  }
  ?>
</table>
</div>
<?php

if($_REQUEST['formato']!="excel"){?>
<br>
<table width="644" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="284" bgcolor="#F2F2F2"><span class="Estilo19" style="color:#999999"><span class="Estilo33">Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (de <strong><?php echo $total_registros?></strong> productos)</span>.</span></td>
    <td width="10" rowspan="2" bgcolor="#F2F2F2">&nbsp;</td>
    <td width="361" rowspan="2" bgcolor="#F2F2F2"><span class="Estilo10"><?php 
	
		$filtro_cla=$_REQUEST['filtro_cla'];
		$filtro_cat=$_REQUEST['filtro_cat'];
		$filtro_sub=$_REQUEST['filtro_sub'];
		
		$agr_cla=$_REQUEST['agr_cla'];
		$agr_cat=$_REQUEST['agr_cat'];
		$agr_sub=$_REQUEST['agr_sub'];		
		
		$filtro_ordenar=$_REQUEST['ordenar'];
	
			  
			  if(($pagina - 1) > 0) { 
//echo "<a href='catalogo_excel.php?sucursal=$sucursal&tienda=$tienda&precios=$precios&incluir=$incluir&filtro_cla=$filtro_cla&filtro_cat=$filtro_cat&filtro_sub=$filtro_sub&agr_cla=$agr_cla&agr_cat=$agr_cat&agr_sub=$agr_sub&ordenar=$filtro_ordenar&pagina=".($pagina-1)."'>< Anterior </a> "; 
echo "<a href='catalogo_excel.php?agr_cla=$agr_cla&agr_cat=$agr_cat&agr_sub=$agr_sub&filtro_cla=$filtro_cla&filtro_cat=$filtro_cat&filtro_sub=$filtro_sub&ordenar=$filtro_ordenar&formato=vista&moneda=$moneda&valor=$valor&almacen=$almacen&pagina=".($pagina-1)."&precio1=$precio1&precio2=$precio2&precio3=$precio3&precio4=$precio4&precio5=$precio5&precio6=$precio6'>< Anterior </a> "; 
} 

for ($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
	echo "<b>".$pagina."</b> "; 
	} else { 
	echo "<a href='catalogo_excel.php?agr_cla=$agr_cla&agr_cat=$agr_cat&agr_sub=$agr_sub&filtro_cla=$filtro_cla&filtro_cat=$filtro_cat&filtro_sub=$filtro_sub&ordenar=$filtro_ordenar&formato=vista&moneda=$moneda&valor=$valor&almacen=$almacen&pagina=$i&precio1=$precio1&precio2=$precio2&precio3=$precio3&precio4=$precio4&precio5=$precio5&precio6=$precio6'>$i</a> "; 
	}
}

if(($pagina + 1)<=$total_paginas) { 
echo " <a href='catalogo_excel.php?agr_cla=$agr_cla&agr_cat=$agr_cat&agr_sub=$agr_sub&filtro_cla=$filtro_cla&filtro_cat=$filtro_cat&filtro_sub=$filtro_sub&ordenar=$filtro_ordenar&formato=vista&moneda=$moneda&valor=$valor&almacen=$almacen&pagina=".($pagina+1)."&precio1=$precio1&precio2=$precio2&precio3=$precio3&precio4=$precio4&precio5=$precio5&precio6=$precio6'>Siguiente></a>"; 
} 

			  ?></span></td>
  </tr>
  <tr>
    <td align="left" bgcolor="#F2F2F2"><a href="#" onClick="javascript:imprSelec()"><img src="../imgenes/fileprint.png" width="25" height="25" border="0"> <span class="Estilo19">Imprimir Pag.</span> </a></td>
  </tr>
</table>
<?php } ?>
</body>
</html>


<script language="Javascript">
function imprSelec()
{
  var ficha = document.getElementById('seleccion');
  var ventimp = window.open(' ', 'popimpr');
  ventimp.document.write( ficha.innerHTML );
  ventimp.document.close();
  ventimp.print();
  ventimp.close();
}

 
</script> 

