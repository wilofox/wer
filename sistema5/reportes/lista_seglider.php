<?php session_start();
		include('../conex_inicial.php');
		include('../funciones/funciones.php');
		
?><style type="text/css">
<!--
.Estilo101 {
	color: #0066FF;
	font-weight: bold;
}
-->
</style>
<div id="detalle" style="width:800px; height:164px; overflow:auto;border:0px solid;" >
<table width="798" height="24" border="0" cellpadding="0" cellspacing="0" id="lista_productos">
  <?php 
    
		 //PAGINACION 1	
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
			$dni=$_REQUEST['dni'];
			$vendedor=$_REQUEST['vendedor'];	
			$docref=$_REQUEST['docref'];
			$fec1=$_REQUEST['fec1'];
			$fec2=$_REQUEST['fec2'];
			$mosdocFac=$_REQUEST['mosdocFac'];
			$mosdocAnu=$_REQUEST['mosdocAnu'];
			$Estado=$_REQUEST['Estado'];
			$inifec=explode("-",$fec1);
			$finfec=explode("-",$fec2);
			
			$formaOrder=$_REQUEST['formaOrder'];
			$campoOrder=$_REQUEST['campoOrder'];
			
			
//and substring(fecha,1,10) between '".formatofecha($fec1)."' and '".date('Y-m-d')."'

$resultados = mysql_query("select * from cliente  where lider='S' and razonsocial like '%$cliente%' and ruc like '%$ruc%' and doc_iden like '%$dni%' order by codcliente" ,$cn);
$total_registros = mysql_num_rows($resultados); 
			
$strSQL="select * from cliente  where lider='S' and  razonsocial like '%$cliente%' and ruc like '%$ruc%' and doc_iden like '%$dni%' order by codcliente LIMIT $inicio, $registros";

//echo $strSQL;	
			$j=0;
			$resultado=mysql_query($strSQL,$cn);
			

	$resultados2 =mysql_num_rows($resultado); 
	$total_paginas = ceil($total_registros / $registros); 
			
			while($row=mysql_fetch_array($resultado)){
						 
		
?>
			
  <tr bgcolor="<?php echo $color_row?>" onClick="entrada(this);Anular('S<?=$AnRK;?>')"  >
      <td width="42" align="center" bgcolor="#FFFFFF">
	  <? //if ($AnRK<>'3'){ ?>
	  <input onclick="Anular('S<?=$AnRK;?>')" style="border: 0px; background:none; " type="radio" name="XDato" value="<?php  echo $row['codcliente']?>" />
	    <? // } ?>
		 <input name="estadoDoc" type="hidden" value="<?php echo $row['flag']."-".$row['estadoOT']?>" size="5" />	  </td>
      <td width="51" align="center" bgcolor="#FFFFFF" class="texto1" style="display:none" >	  
	   <? if ($AnRK<>'3'){ ?>
	   <input 
	   <? //if ($AnRK=='3'){ echo 'disabled';  } ?>
	   style="border: 0px; background:none; " type="checkbox" name="xcodigo" value="<?php  echo $row['codcliente']?>" onclick="Anular('S<?=$AnRK;?>')" />
	  <? } ?>
	  <input type="hidden" name="tipformato" value="<?php echo $data ?>" />	  </td>
             <td width="79" align="center" bgcolor="#FFFFFF" class="texto1"><?php echo $row['codcliente']?></td>	
			  <td width="249" bgcolor="#FFFFFF" class="texto1" ><?php echo $row['razonsocial']; ?></td>	
              <td width="202" bgcolor="#FFFFFF" class="texto1"><?php echo $row['direccion']; ?></td>
              <td width="69" align="center" bgcolor="#FFFFFF" class="texto1"><?php echo $row['ruc']; ?></td>
              <td width="90" align="center" bgcolor="#FFFFFF" class="texto1"><?php echo $row['doc_iden']; ?></td>
  </tr>
  
  <?php }?>
</table>
</div>
		  
	<table width="100%" height="21" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="319" height="21" align="left" valign="bottom" style="color:#999999"><span class="Estilo29">Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (de <strong><?php echo $total_registros?></strong> productos)</span>.</td>
    <td width="285" align="right" valign="bottom" style="color:#666666">&nbsp;</td>
    <td width="255" align="right" valign="bottom" style="color:#999999"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:13px">
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
      <input type="hidden" name="pag" id="pag" value="<?php echo $pagina?>" /></td>
  </tr>
</table>
