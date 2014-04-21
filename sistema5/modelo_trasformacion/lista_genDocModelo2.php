<style type="text/css">
<!--
.Estilo100 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
-->
</style>
<div id="detalle3" style="width:780px; height:165px; overflow:auto" >
<table width="761" height="28" border="0" cellpadding="0" cellspacing="0" id="lista_productos">
  <?php 
		include('../conex_inicial.php');
		include('../funciones/funciones.php');
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
			$criterio=$_REQUEST['criterio'];
			$valor=$_REQUEST['valor'];
			
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
			$strSQL22="select * from tienda order by cod_tienda";
			$resultado22=mysql_query($strSQL22,$cn);
			while($row22=mysql_fetch_array($resultado22)){
			//echo  $saldos[]=",'".$row22['cod_tienda'].'';
			 $tiendas=$tiendas.$row22['cod_tienda'].",";
			}
		$tiendas2=substr($tiendas,0,strlen($tiendas)-1);
		$almacen  =' tienda in('.$tiendas2.') ';
		
		}else{
		$almacen = " tienda='$almacen' ";
		}	

$SQLEstado =" and flag<>'A' and estado<>'A' ";	
 
if ($Estado<>''){
		  if (trim($Estado)=='T'){
			 $SQLEstado =" ";
		  }elseif (trim($Estado)=='C'){
			$SQLEstado ="  ";	
		  }elseif (trim($Estado)=='A'){
		    $SQLEstado =" and flag='A' and estado<>'A'";
		  }elseif (trim($Estado)=='O'){
		    $SQLEstado ="  and obs<>'' and flag<>'A'  ";		
		  }	
}
if ($valor!=''){
	$valor=" and $criterio like '%$valor%' ";
}
 
 //$almacen 
 $SQLConsulta=" where cod_vendedor like '%$vendedor%' 
 $valor	$SQLEstado
  "; //and kardex='S' and deuda='N' 

$sqlx="  select * from producto  where modelo='S' and baja='N' ";

//M inner join modelo_det MD on M.cod_mod=MD.cod_mod 
//$SQLConsulta
$resultados = mysql_query(" $sqlx " ,$cn);
$total_registros = mysql_num_rows($resultados); 
			
$strSQL="$sqlx order by nombre desc LIMIT $inicio, $registros";

						
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



?>
			
  <tr bgcolor="<?php echo $color_row?>" onClick="entrada(this)" ondblclick="doc_det('<?=$row['idproducto'];?>')"  >
      <td width="90" align="center">	  
      <input style="border: 0px; background:none; " type="radio" name="XDato" value="<?=$row['idproducto'];?>" /><span class="texto2" style="font-size:11px;"><b><? echo $j ?></b></span></td>
      <td width="464" class="texto1"><?php echo caracteres(substr($row['nombre'],0,30));?></td>	
      <td width="73" align="center" class="texto1" ><?=$row['idproducto'];?></td>	
              <td width="106" align="center" class="texto1"><?php

			    $tipo_imp="";
			    $sql="select * from modelo  
				M inner join modelo_det MD on M.cod_mod=MD.cod_mod 
				where M.cod_prod  ='".$row['idproducto']."' ";
				$resultadoX=mysql_query($sql,$cn);
				$cont=mysql_num_rows($resultadoX);
				while($rowX=mysql_fetch_array($resultadoX)){
				$tipo_imp=$rowX['modo_imp'];
				$id_modelo=$rowX['cod_mod'];
				}
				if($cont==0){
				echo "Disponible";
				}else{
				echo "No Disponible";
				}
			  
			   ?></td>
			   <td width="67" align="center" class="texto1"><input name="textfield" type="text" size="5" maxlength="1" value="<?php echo $tipo_imp ?>" style="text-align:center" onkeyup="save_tipoImp(this,event,'<?php echo $id_modelo; ?>');" /></td>
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
    </table>
	<br>
