<?
//Borrar Sesion multifactura
		session_start();
		include('conex_inicial.php');
		include('../funciones/funciones.php');
		
		unset($_SESSION['Multifactura']);
?><style type="text/css">
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
			
			$almcod=$_REQUEST['almcod'];
			$cliente=$_REQUEST['cliente'];
			$vendedor=$_REQUEST['vendedor'];

			$fec1=$_REQUEST['fec1'];
			$fec2=$_REQUEST['fec2'];
			$Estado=$_REQUEST['Estado'];
	
			if($_REQUEST['ordenar']!=""){
			 	$filtro2=" order by ".$_REQUEST['ordenar']. " ".$_REQUEST['orden']; 	
			}else{
				$filtro2=" order by fec_punt desc "; 	
			}



if ($Estado<>''){
		  if (trim($Estado)=='T'){
			 $SQLEstado ="";
		  }elseif (trim($Estado)=='P'){
			 $SQLEstado =" and PM.estado<>'A' ";
		  }else{			
			 $SQLEstado =" and PM.estado='A' ";
		  }	
 }else{

	$SQLEstado =" and PM.estado<>'A' ";  
 }
  

 $SQLConsulta=" where  
  placa like '%$almcod%' and 
  nom_prod like '%$cliente%' and 
  cod_vendedor like '%$vendedor%' and 
  substring(fec_punt,1,10) between '".formatofecha($fec1)."' and '".formatofecha($fec2)."'
 $SQLEstado  
    ";
	
	/*echo "select * from punto_mov PM
inner join transp_cliente C on PM.cod_trans =C.cod_trans 
$SQLConsulta ";*/

$resultados = mysql_query("select * from punto_mov PM
inner join transp_cliente C on PM.cod_trans =C.cod_trans 
$SQLConsulta " ,$cn);
$total_registros = mysql_num_rows($resultados); 
			
 $strSQL="select * from punto_mov PM
inner join transp_cliente C on PM.cod_trans =C.cod_trans 
 $SQLConsulta $filtro2 
LIMIT $inicio, $registros";
		
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
$sql="select * from punto_mov 
where cod_punto  ='".$row['cod_punto']."' ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX['estado']=='A'){
		$color_row='#FF0000';
		$AnRK='2';
	}
}	
		 					
?>
			
  <tr bgcolor="<?php echo $color_row?>" onClick="entrada(this);" ondblclick="doc_det(this)" >
      <td width="34" align="center" ><input style="border: 0px; background:none; " type="radio" name="XDato" value="<?php  echo $row['cod_punto']?>" /><b><?=$j;?></b></td>
      <td width="39" align="center" class="texto1" >	  
	   <? if ($AnRK<>'3'){ ?>
	   <input style="border: 0px; background:none; " type="checkbox" name="xcodigo" value="<?=$row['	cod_trans'];?><?=$row['cod_punto'];?>" onclick="Anular('S<?=$AnRK;?>')" />
	  <? } ?>	  </td>
              <td width="149" align="center" class="texto1" ><?php echo $row['fec_punt']?></td>
              <td width="76" class="texto1" ><?php echo $row['placa']; ?></td>
              <td width="103" class="texto1"><?php echo $row['cod_ope'].'-'.$row['num_doc']; ?></td>			   
              <td width="213" class="texto1"><?php echo substr(caracteres($row['nom_prod']),0,27); ?> <b>|| <?php echo $row['punt_acumulado']; ?> puntos <?  if ($row['efectivo']>0){ echo ' + '.number_format($row['efectivo'],2);} ?></b></td>
              <td width="70" class="texto1"><?php echo $row['punt_saldo']; ?> puntos</td>
              <td width="116"  class="texto1"><?php echo $row['pc']; ?></td>
    </tr>
  
  <?php }?>
</table>
</div>
		  
	<table width="100%" height="21" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="311" height="21" align="left" valign="bottom" style="color:#999999"><span class="Estilo29">Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (de <strong><?php echo $total_registros?></strong> productos)</span>.</td>
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