<?php 
include('../conex_inicial.php');
include('../funciones/funciones.php');

		 $registros = 50; 
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

$peticion=$_REQUEST['peticion'];
$sucursal=$_REQUEST['sucursal'];

$suc="costo_inven".$sucursal;
//echo $suc ;
switch($peticion){
	
	case "lista":
		
	if($_REQUEST['valor']!=""){
	$valor=$_REQUEST['valor'];
	$criterio=$_REQUEST['criterio'];
	$filtro=" and  $criterio like'%$valor%'";
	}

	$clasificacion=$_REQUEST['clasificacion'];
	$categoria=$_REQUEST['categoria'];
	$subcategoria=$_REQUEST['subcategoria'];
	
	$filtro3="";
	if($clasificacion!='999'){
	$filtro3=" and  clasificacion='$clasificacion' ";
	}
	if($categoria!='999'){
	$filtro3.=" and  categoria='$categoria' ";
	}
	if($subcategoria!='999'){
	$filtro3.=" and  subcategoria='$subcategoria' ";
	}

	
 ?>	
	
<style type="text/css">
<!--
.Estilo12 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #FFFFFF; font-weight: bold; }
.Estilo6 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color:#333333 }
.Estilo36 {color: #99FF00}
.Estilo14 {color: #333333}
-->
</style>
 <?php 
	  $strSQL11="select * from unidades order by descripcion";
	  $resultado11=mysql_query($strSQL11,$cn);
	  $contador=mysql_num_rows($resultado11);
	 //$contador=$contador*60+920;
	  $contador=900;
	    
	  ?>
<div id="detalle" style="width:800px; height:295px; overflow:auto" >	  
<table id="tbl_lista" width="<?php echo $contador?>" border="0" cellpadding="1" cellspacing="1">
          <tr style="background:url(../imagenes/bg_contentbase2.gif) ; background-position:100% 40%; ">
            <td width="25"><input style="background:none; border=none" type="checkbox" name="marcar_all" value="checkbox" onClick="marcar_checks()"></td>
            <td width="60" height="28"><span class="Estilo12">Codigo</span></td>
            <td width="225"><span class="Estilo12">Nombre de Producto </span></td>
            <td width="80" align="center"><span class="Estilo12">Precio de Costo S/. </span></td>
            <td width="60" align="center"><span class="Estilo12">Moneda</span></td>
            <td width="60" align="center"><span class="Estilo12">Costo Ref. <span class="Estilo36"> (PR)</span> </span></td>
            <td width="60" align="center" id="descuento1" style="display:none; background:url(../imagenes/bg_contentbase3.jpg) ;background-position:100% 50%; "><span class="Estilo12">Desc.1 (%)</span></td>
            <td width="60" align="center" id="descuento2" style="display:none; background:url(../imagenes/bg_contentbase3.jpg) ;background-position:100% 50%; "><span class="Estilo12">Desc.2 (%)</span></td>
            <td width="60" align="center" id="descuento3" style="display:none; background:url(../imagenes/bg_contentbase3.jpg) ;background-position:100% 50%; "><span class="Estilo12">Desc.3 (%)</span></td>
            <td width="60" align="center" id="cel_previo" style="display:none; background:url(../imagenes/bg_contentbase3.jpg) ;background-position:100% 50%; "><span class="Estilo12">Previo</span></td>
            <td width="60" align="center" id="cel_utilidad" style="display:none; background:url(../imagenes/bg_contentbase3.jpg) ;background-position:100% 50%; "><span class="Estilo12">Utilidad</span></td>
            <td width="60" align="center" id="cel_igv" style="display:none; background:url(../imagenes/bg_contentbase3.jpg) ;background-position:100% 50%; "><span class="Estilo12">I.G.V.</span></td>
            <td width="60"  align="center"><span class="Estilo12"><?=$PrecNomEti1;?> <span class="Estilo36">(P1)</span></span></td>
            <td width="60" align="center" id="celda_formu" style="display:none"><span class="Estilo12">Formula</span></td>
			
			
            <td width="60" align="center"><span class="Estilo12"><?=$PrecNomEti2;?> <span class="Estilo36">(P2)</span></span></td>
            <td width="60" align="center"><span class="Estilo12"><?=$PrecNomEti3;?> <span class="Estilo36">(P3)</span></span></td>
            <td width="60" align="center"><span class="Estilo12"><?=$PrecNomEti4;?> <span class="Estilo36"> (P4)</span></span></td>
            <td width="60" align="center"><span class="Estilo12"><?=$PrecNomEti5;?> <span class="Estilo36">(P5)</span></span></td>
		
		
		
		<!-------------------subunidad----------------------->	

		<?php /*?>	<?php
			
			$strSQL11="select * from unidades order by descripcion";
			$resultado11=mysql_query($strSQL11,$cn);
			while($row11=mysql_fetch_array($resultado11)){
			
			$filtro_uni=$filtro_uni.",sum(if(unidad='".$row11['id']."',precio,'0.00')) as '".$row11['nombre']."' ";
			
			 ?>
	
			  <td width="60" align="center"><span class="Estilo12"><?php echo $row11['nombre'];?> </span></td>
			  			
			<?php 
			}	?><?php */?>
			
			
		<!---------------------------------------------------->	
			
          </tr>
          <?php 
	  $resultados = mysql_query("select * from producto where 1 ".$filtro3.$filtro." ",$cn);
	  $total_registros = mysql_num_rows($resultados); 
	  $strSQL="select * from producto where 1 ".$filtro3.$filtro." LIMIT $inicio, $registros";	  
		  
				  
	  $i=0;
//$resultados = mysql_query("select * from producto where 1 ".$filtro3.$filtro." limit 100 " ,$cn);
	$resultado=mysql_query($strSQL,$cn);			

	$resultados2 =mysql_num_rows($resultado); 
	$total_paginas = ceil($total_registros / $registros); 

		//while($row=mysql_fetch_array($resultados)){
		while($row=mysql_fetch_array($resultado)){
	  $i++;
	    if($i%2==0){
		$color_row='#E9F3FE';
		}else{
		$color_row='#FFFFFF';
		}	
	  
	  ?>
          <tr bgcolor="<?php echo $color_row?>" onClick="entradae(this)">
            <td><input style="background:none; border:none"  type="checkbox" name="chk[]" id="chk" value="<?php echo $row['idproducto']?>"  />            </td>
            <td><span class="Estilo6"><?php echo $row['idproducto']?>
                  <input type="hidden" name="codigo[]" id="codigo" value="<?php echo $row['idproducto']?>">
            </span></td>
           <td class="Estilo6" title="<? echo caracteres($row['nombre']); ?>"><? echo substr(caracteres($row['nombre']), 0, 40)  ?></td>
		   
            <td align="center" class="Estilo6" style="background:#F5FBE1"><strong>S/.</strong>
            <input disabled="disabled" style="text-align:right; font:bold" automplete='off' name="pcosto[]" id="pcosto" type="text" size="7" maxlength="10" value="<?php echo $row[$suc]?>" /></td>
            <td align="center"><span class="Estilo6">
              <select name="moneda[]" id="moneda" style="width:45px">
                <?php 
			  if($row['moneda']=='01'){
			  echo "<option value='01' selected='selected'>S/.</option>
			  <option value='02'>US$.</option>";
			  }else{
			   echo "<option value='01' >S/.</option>
			  <option value='02' selected='selected'>US$.</option>";
			  
			  }
			 
			  ?>
              </select>
            </span></td>
            <td align="center" id="cel_preferencial<?php echo $i?>"><input onkeydown="validarNumero(this,event)" onKeyUp="calcular_p1(this,event)" style="text-align:right" name="preferencial[]" id="preferencial" type="text" size="7" maxlength="10" value="<?php echo number_format($row['pre_ref'],4,'.','')?>" /></td>
            <td align="center" id="descuento1<?php echo $i?>" style="display:none"><input onBlur="color_fondo(this)" onFocus="color_fondo(this)" style="text-align:right" name="desc1[]" id="desc1" type="text" size="7" maxlength="10" onKeyUp="cambiar_temp(this,event)" value="<?php echo number_format($row['desc1'],2,'.','')?>" onkeydown="validarNumero(this,event)" /></td>
            <td align="center" id="descuento2<?php echo $i?>" style="display:none"><input style="text-align:right" name="desc2[]" id="desc2" type="text" size="7" maxlength="10" value="<?php echo number_format($row['desc2'],2,'.','')?>" onKeyUp="cambiar_temp(this,event)" onkeydown="validarNumero(this,event)" /></td>
            <td align="center" id="descuento3<?php echo $i?>" style="display:none"><input onKeyUp="cambiar_temp(this,event)" style="text-align:right" name="desc3[]" id="desc3" type="text" size="7" maxlength="10" value="<?php echo number_format($row['desc3'],2,'.','')?>" onkeydown="validarNumero(this,event)" /></td>
            <td align="center" id="cel_previo<?php echo $i?>" style="display:none"><input style="text-align:right" name="previo[]" id="previo" disabled="disabled" type="text" size="7" maxlength="10" value="<?php echo number_format($row['previo'],2,'.','')?>" /></td>
            <td align="center" id="cel_utilidad<?php echo $i?>" style="display:none"><input onKeyUp="cambiar_temp(this,event)" style="text-align:right" name="utilidad[]" id="utilidad" type="text" size="7" maxlength="10" value="<?php echo number_format($row['utilidad'],2,'.','')?>" onkeydown="validarNumero(this,event)" /></td>
            <td  align="center" id="cel_igv<?php echo $i?>" style="display:none"><input onKeyUp="cambiar_temp(this,event)" style="text-align:right" name="igv[]" id="igv" type="text" size="7" maxlength="10" value="<?php echo number_format($row['igv'],2,'.','')?>" onkeydown="validarNumero(this,event)" /></td>
            <td align="center"><input name="precio1[]"  id="precio1" type="text" size="5" maxlength="10" value="<?php echo number_format($row['precio'],4,'.','')?>" style="text-align:right" onkeydown="validarNumero(this,event)"/></td>
            <td class="Estilo6" id="celda_formu<?php echo $i?>" style="display:none"><input style="text-align:right; font:bold" autocomplete='off' name="formulaxitem[]" id="formulaxitem" type="text" size="7" maxlength="10" value="<?php echo $row['formula']?>" /></td>
			
			
            <td align="center"><input name="precio2[]"  id="precio2" type="text" size="5" maxlength="10" value="<?php echo number_format($row['precio2'],4,'.','')?>" style="text-align:right" onkeydown="validarNumero(this,event)"/></td>
            <td align="center"><input name="precio3[]"  id="precio3" type="text" size="5" maxlength="10" value="<?php echo number_format($row['precio3'],4,'.','')?>" style="text-align:right" onkeydown="validarNumero(this,event)"/></td>
            <td align="center"><input name="precio4[]"  id="precio4" type="text" size="5" maxlength="10" value="<?php echo number_format($row['precio4'],4,'.','')?>" style="text-align:right" onkeydown="validarNumero(this,event)" /></td>
            <td align="center"><input name="precio5[]"  id="precio5" type="text" size="5" maxlength="10" value="<?php echo number_format($row['precio5'],4,'.','')?>" style="text-align:right" onkeydown="validarNumero(this,event)" /></td>
			
			
			
					<!-------------------subunidad----------------------->	
			
		<?php /*?><?php
		
			$strSQL12="SELECT producto ".$filtro_uni." FROM unixprod WHERE producto='".$row['idproducto']."' group by producto";
			//echo $strSQL12."<br>";
			$resultado12=mysql_query($strSQL12,$cn);
			$row12=mysql_fetch_array($resultado12);
			//echo $row12['kgr'];	
					
			$strSQL13="select * from unidades order by descripcion";
			$resultado13=mysql_query($strSQL13,$cn);
			
			while($row13=mysql_fetch_array($resultado13)){
			$abrev=$row13['nombre'];
			//echo $abrev." ".$row12['Lbs'];
			 ?>
	
			  <td align="center"><input name="precio_sub_<?php echo $row13['id']?>[]"  id="precio_sub_<?php echo $row13['id']?>" type="text" size="5" maxlength="10" value="<?php echo $row12[$abrev] ?>" style="text-align:right" /> </td>
			  		
									
			<?php }	?>	<?php */?>
			
					<!------------------------------------------------->	
			
          </tr>
          <?php 
	  
	  }
	  ?>
	  
	  
	  
	  
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td >&nbsp;</td>
            <td align="center" id="copiar_desc1" style="display:none"><input style="text-align:right; font:bold" automplete='off' name="temp_desc1" id="temp_desc1" type="hidden" size="7" maxlength="10" value=""/>
                <input type="button" name="btn_desc1" value="Copiar" onClick="copiar_valor(this)"></td>
            <td align="center" id="copiar_desc2" style="display:none"><input style="text-align:right; font:bold" automplete='off' name="temp_desc2" id="temp_desc2" type="hidden" size="7" maxlength="10" value=""/>
                <input type="button" name="btn_desc2" value="Copiar" onClick="copiar_valor(this)"></td>
            <td align="center" id="copiar_desc3" style="display:none"><input style="text-align:right; font:bold" automplete='off' name="temp_desc3" id="temp_desc3" type="hidden" size="7" maxlength="10" value=""/>
                <input type="button" name="btn_desc3" value="Copiar" onClick="copiar_valor(this)">            </td>
            <td align="center">&nbsp;</td>
            <td align="center" id="copiar_utilidad" style="display:none"><input style="text-align:right; font:bold" automplete='off' name="temp_utilidad3" id="temp_utilidad" type="hidden" size="7" maxlength="10" value=""/>
                <input type="button" name="btn_utilidad" value="Copiar" onClick="copiar_valor(this)">            </td>
            <td align="center" id="copiar_igv" style="display:none"><input style="text-align:right; font:bold" automplete='off' name="temp_igv" id="temp_igv" type="hidden" size="7" maxlength="10" value=""/>
                <input type="button" name="btn_igv" value="Copiar" onClick="copiar_valor(this)">            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
           
		    <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
			<td>&nbsp;</td>
			
          </tr>
</table>
</div>
<?php	
	break;
	
	case "docxprod":
		
	?>
	
	<table width="783" border="0" cellpadding="1" cellspacing="1">
        <tr style="background:url(../imagenes/bg_contentbase2.gif) ; background-position:100% 40%; ">
          <td width="21" height="21"><span class="Estilo11"></span></td>
          <td width="132"><span class="Estilo12">Fecha</span></td>
          <td width="26"><span class="Estilo12">Tipo</span></td>
          <td width="85"><span class="Estilo12">Nro. doc.</span></td>
          <td width="100"><span class="Estilo12">Proveedor</span></td>
          <td width="70"><span class="Estilo12">Codigo</span></td>
          <td width="211"><span class="Estilo12">Producto</span></td>
          <td width="45"><span class="Estilo12">Costo</span></td>
          <td width="65"><span class="Estilo12">Cantidad</span></td>
        </tr>
		
		<?php 
		
		$fecha1=$_REQUEST['fecha1'];
		$fecha2=$_REQUEST['fecha2'];
		$producto=$_REQUEST['producto'];
		
		$strSQl="select d.cod_prod,c.cod_ope,c.serie,numero,fechad,cliente,nom_prod,c.cod_cab from det_mov d , cab_mov c where nom_prod like '%".$producto."%' and  d.cod_cab=c.cod_cab and c.tipo='1' and substring(fecha,1,10) between '$fecha1' and '$fecha2' and  flag!='A' and c.cod_ope!='TS'";
	 	//echo $strSQl;
		$resultado=mysql_query($strSQl,$cn);
		while($row=mysql_fetch_array($resultado)){
		
		?>
        <tr>
          <td bgcolor="#F8F8F8"><img style="cursor:pointer" alt="" onClick="doc_det('<?php echo $row['cod_cab'];?>')" src="../imagenes/ico_lupa.png" width="15" height="15"></td>
          <td bgcolor="#F8F8F8"><span class="Estilo14"><?php echo $row['fechad']; ?></span></td>
          <td bgcolor="#F8F8F8"><span class="Estilo14"><?php echo $row['cod_ope']; ?></span></td>
          <td bgcolor="#F8F8F8"><span class="Estilo14"><?php echo $row['serie']."-".$row['numero']; ?></span></td>
          <td bgcolor="#F8F8F8"><span class="Estilo14"><?php echo $row['cliente']; ?></span></td>
          <td bgcolor="#F8F8F8"><span class="Estilo14"><?php echo $row['cod_prod']; ?></span></td>
          <td bgcolor="#F8F8F8"><span class="Estilo14"><?php echo $row['nom_prod']; ?></span></td>
          <td bgcolor="#F8F8F8"><span class="Estilo14"><?php echo $row['costo_inven']; ?></span></td>
          <td bgcolor="#F8F8F8"><span class="Estilo14"><?php echo $row['cantidad']; ?></span></td>
        </tr>
		<?php 
		
		}
		
		?>
</table>
	
	
	
	<?php 
	break;
	
}	

?>

<table width="100%" height="21" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="311" height="21" align="left" valign="bottom" style="color:#999999"><span class="Estilo29">Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (de <strong><?php echo $total_registros?></strong> productos)</span>.</td>
    <td width="526" align="right" valign="bottom" style="color:#999999"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:13px">
      <?php 
			  
 if(($pagina - 1) > 0) { 
echo "<a style='cursor:pointer' onclick='cargar_lista($pagina-1)'>< Anterior </a> "; 
} 

for ($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
	echo "<b style='color:#000000'>".$pagina."</b> "; 
	} else { 
	echo "<a style='cursor:pointer' href='#' onclick='cargar_lista($i)'>$i</a> "; 
	}
}
if(($pagina + 1)<=$total_paginas) { 
echo " <a style='cursor:pointer' onclick='cargar_lista($pagina+1)'>Siguiente ></a>"; 
} 
    ?>
      <input type="hidden" name="pag" value="<?php echo $pagina?>" />
    &nbsp;&nbsp;    </font> </td>
  </tr>
</table>