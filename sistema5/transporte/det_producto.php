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
<div id="resultado" style="width:355px; height:212px; overflow:auto; padding-left:5px;"   >	
	<table id="lista_aux" width="350" border="0" cellpadding="0" cellspacing="1">
	   <?php  
	    //PAGINACION 1	
		 $registros = 10; 
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
				$filtro2=" order by nombre asc "; 	
			}
			
		$criterio=$_REQUEST['criterio'];
     	$strSQL="select * from productos  where $criterio like '%$valor%' and estado='A' $filtro2  ";
	$j=0;

		
		$resultado = mysql_query($strSQL); 
		$total_registros = mysql_num_rows($resultado); 
		$resultado = mysql_query($strSQL." LIMIT $inicio, $registros"); 
			
		$resultados2 =mysql_num_rows($resultado); 
		$total_paginas = ceil($total_registros / $registros);   
			  
while($row=mysql_fetch_array($resultado))
{

//list($clasificacion)=mysql_fetch_array(mysql_query("select nombre from clas_clie where codigo='".$row['clas_clie']."'"));
//list($condicion)=mysql_fetch_array(mysql_query("select nombre from condicion where codigo='".$row['condicion']."'"));
 ?>
        <tr bordercolor="#CCCCCC"  bgcolor="#F9F9F9" onClick="entrada(this);canjear(this)" ondblclick="">
          <td width="20" align="center" ><input style="border: 0px; background:none; " type="radio" name="xaux" value="<?php  echo $row['cod_prod']?>" /></td>
          
          <td width="45"><span class="Estilo12"><?php echo $row['codigo']; ?></span></td>
          <td width="52"><span class="Estilo12"><?php echo $row['anexo'] ?></span></td>
          <td width="124" ><span class="Estilo12"><?php echo caracteres(substr($row['nombre'], 0, 25)) ?>
            <input type="hidden" name="prodet" value="<?=$row['nombre'];?>" />
          </span></td>
          <td width="52" align="right"><span class="Estilo12"><?php echo $row['punto']?>
            <input type="hidden" name="puntos" value="<?=$row['punto'];?>" />
          </span></td>
          <td width="50" align="right"><?php echo number_format($row['efectivo'],2)?>
          <input type="hidden" name="efectivo" value="<?=$row['efectivo'];?>" /></td>
      </tr>
		
		<?php  
  
  }
  mysql_free_result($resultado);
  
  ?>
</table> 
</div> 

<table width="336" height="21" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="21" align="left" valign="bottom" style="color:#999999"><span class="Estilo29"><strong>del <?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (<strong><?php echo $total_registros?></strong> productos)</span>.</td>
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
