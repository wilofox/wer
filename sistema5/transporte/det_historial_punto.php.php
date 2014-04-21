<?php include('conex_inicial.php');
include('../funciones/funciones.php');
  $tipo_aux=$_REQUEST['tipo_aux'];
  $valor=$_REQUEST['filtro'];
  $criterio=$_REQUEST['criterio'];	
	  	    
	 ?>
<style type="text/css">
<!--
.Estilo15 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #990000;
}
-->
</style>
<div id="resultado" style="width:570px; height:212px; overflow:auto; padding-left:5px;"   >	
	<table id="lista_aux" width="547" border="0" cellpadding="0" cellspacing="1">
	   <?php  
	    //PAGINACION 1	
		 $registros = 50; 
		 $pagina = $_REQUEST['pagina']; 
		// echo $pagina;

		if ($pagina=='') { 
		$inicio = 0; 
		$pagina = 1; 
		} 
		else { 
		$inicio = ($pagina - 1) * $registros; 
		} 
	//-------------------------------------------
			if($_REQUEST['ordenar']!=""){
			 	$filtro2=" order by ".$_REQUEST['ordenar']. " ".$_REQUEST['orden']; 	
			}else{
				$filtro2=" order by fec_hor_des asc "; 	
			}
			
		$criterio=$_REQUEST['criterio'];
     	$strSQL="select * from master_historial  where placa ='$valor' and fec_hor_des>='$criterio' $filtro2  ";
	$j=0;

		
		$resultado = mysql_query($strSQL); 
		$total_registros = mysql_num_rows($resultado); 
		$resultado = mysql_query($strSQL." LIMIT $inicio, $registros"); 
			
		$resultados2 =mysql_num_rows($resultado); 
		$total_paginas = ceil($total_registros / $registros);   
$T1=0;
$P1=0;	  
while($row=mysql_fetch_array($resultado))
{

list($factor)=mysql_fetch_row(mysql_query("select factor from factores where '".substr($row['fec_hor_des'],0,10)."'  between fecha and fecha2 limit 1"));

if($factor=='' || $factor==0){

$factor=1;
}

 ?>
        <tr bordercolor="#CCCCCC"  bgcolor="#F9F9F9" onClick="entrada(this);">
          <td width="20" align="center" ><input style="border: 0px; background:none; " type="radio" name="xaux" value="<?php  echo $row['cod_prod']?>" /></td>
          
          <td width="135"><span class="Estilo12"><?php echo formatofecha(substr($row['fec_hor_des'],0,10)).' '.substr($row['fec_hor_des'],11,20) ?></span></td>
          <td width="112"><span class="Estilo12"><?php echo $row['cod_ope'] ?> <?php echo $row['ruc'] ?></span></td>
          <td width="72" ><span class="Estilo12"><?php echo $row['Num_serdoc']  ?></span></td>
          <td width="66" align="right"><?php echo number_format($row['total'],2); $T1+=$row['total'];?></td>
          <td width="68" align="center"><span class="Estilo12"><?php echo $factor;  ?></span></td>
          <td width="66" align="right"><?php echo number_format($row['total']/ $factor ,0); $T1+=$row['total']/ $factor  ?></td>
      </tr>
		
		<?php  
  
  }
  mysql_free_result($resultado);
  
  ?>
</table> 
</div> 

<table width="547" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="417">&nbsp;</td>
    <td width="57"><? //=number_format($T1,2);?></td>
    <td width="73"><? //=number_format($P1,2);?></td>
  </tr>
</table>
<table width="547" height="21" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="21" align="left" valign="bottom" style="color:#999999"><span class="Estilo29"><strong>del <?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (<strong><?php echo $total_registros?></strong> compras)</span>.</td>
    <td align="right" valign="bottom" style="color:#999999"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:13px">
      <?php 
			  
 if(($pagina - 1) > 0) { 
echo "<a style='cursor:pointer' onclick='filtrar($pagina-1)'>< Ant.</a> "; 
} 

for ($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
	echo "<b style='color:#000000'>".$pagina."</b> "; 
	} else { 
	echo "<a style='cursor:pointer' href='#' onclick='filtrar($i)'>$i</a> "; 
	}
}
if(($pagina + 1)<=$total_paginas) { 
echo " <a style='cursor:pointer' onclick='filtrar($pagina+1)'>Sig. ></a>"; 
} 
    ?>
      <input type="hidden" name="pag" value="<?php echo $pagina?>" />
    &nbsp;&nbsp; </font> </td>
  </tr>
</table>
