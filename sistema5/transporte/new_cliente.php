<?php include('conex_inicial.php');
include('../funciones/funciones.php');
$mov='';


//verificar si este prodcto tiene movimientos  
if( $_REQUEST['auctip'] == 'C' ){ $taux = 'C'; }
else { $taux = 'P'; }
/*if(!empty($_REQUEST['cod']))
{  	$rsdtmov		=	mysql_query("select DISTINCT(auxiliar)  from det_mov where auxiliar='".$_REQUEST['cod']."'",$cn);
    if( mysql_num_rows($rsdtmov) >0 )
    {   $rowmov		=	mysql_fetch_array($rsdtmov);
	    $rsdtmovc	=	mysql_query("select codcliente from cliente where codcliente='".$rowmov['auxiliar']."' and( tipo_aux='".$taux."' or tipo_aux='A')",$cn);
		if( mysql_num_rows($rsdtmovc) > 0 ){	$mov		=	'ok';  }
    }
}*/


if(isset($_REQUEST['upd_cod'])){

	$strSQL_aux="update cliente set tipo_aux='A' where codcliente='".$_REQUEST['upd_cod']."'";
	mysql_query($strSQL_aux,$cn);
	
exit;

}else{

	if(isset($_REQUEST['filtro'])){
	
	  $tipo_aux=$_REQUEST['tipo_aux'];
	  $valor=$_REQUEST['filtro'];	
	  	    
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
<div id="detalle" style="width:800px; height:250px; overflow:auto; padding-left:5px;"   >
  <table id="lista_aux" width="778" border="0" cellpadding="0" cellspacing="0">
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
				$filtro2=" order by dni_t1 DESC "; 	//placa asc 
			}
			
		$criterio=$_REQUEST['criterio'];
        $strSQL="select * from transp_cliente where $criterio like '%$valor%' $filtro2 ";
	
	$j=0;

		
		$resultado = mysql_query($strSQL); 
		$total_registros = mysql_num_rows($resultado); 
		$resultado = mysql_query($strSQL." LIMIT $inicio, $registros"); 
			
		$resultados2 =mysql_num_rows($resultado); 
		$total_paginas = ceil($total_registros / $registros);   
	
		//  echo "resultado".$resultados;
			  
while($row=mysql_fetch_array($resultado))
{
$cod_traspostista=$row['cod_trans'];

 ?>
 
    <? if( extraefecha($row['fec_baja'])=='00-00-0000'){ $color='#F9F9F9'; }else{ $color='#FF4646';} ?>
	<? if( $row['estado']=='S' && extraefecha($row['fec_baja'])=='00-00-0000' ){ $color='#D2EFCB'; }?>
    <tr  bgcolor="<?=$color;?>" onclick="entrada(this)" ondblclick="editar('actualizar')">
      <td width="20" align="center"><input style="border: 0px; background:none; " type="radio" name="xaux" value="<?php  echo $row['cod_trans']?>" /></td>
      <td width="50"><span class="Estilo12"><?php echo $row['placa']; ?></span></td>
      <td width="200"><span class="Estilo12"><?php echo caracteres(substr($row['nom_t1'], 0, 25)) ?> -
        <?=$row['dni_t1'];?>
      </span></td>
      <td width="200" ><span class="Estilo12"><?php echo caracteres(substr($row['ape_t2'].', '.$row['nom_t2'], 0, 25)) ?></span></td>
      <td width="75"><span class="Estilo12"><?php echo formatofecha(substr($row['fec_alta'], 0, 10))?></span></td>
      <td width="75"><span class="Estilo12">
        <?php 
		  if ($color=='#FF4646'){ 
		  echo extraefecha($row['fec_baja']);
		  }
		 ?>
      </span></td>
      <td width="82" align="center"><span class="Estilo12">
        <?php 
		    /*$strSQLH="select sum(total) as Tl from master_historial where placa='".$row['placa']."'  ";
			$resultadoH=mysql_query($strSQLH,$cn);
			$rowH=mysql_fetch_array($resultadoH);
			$puntoA=number_format($rowH['Tl']/1.38);
			echo $puntoA;//.' Puntos';*/
			echo $row['total_punto']-$row['saldo_punto'];
		  ?>
      </span></td>
      <?php if($tipo_aux=="C"){?>
      <?php }?>
      <td width="60" align="center"><span class="Estilo12">
        <?php 
		/* $strSQLM="select sum(punt_acumulado) as Pa from punto_mov where cod_trans='".$row['cod_trans']."'  and estado<>'A' ";
		  $resultadoM=mysql_query($strSQLM,$cn);
		  $rowM=mysql_fetch_array($resultadoM);
		  echo $puntoA-$rowM['Pa'];//.' Puntos';*/
		 echo $row['total_punto'];		  
		  ?>
        </span>
          <?
		   if( extraefecha($row['fec_baja'])=='00-00-0000'){
		  	$bloquear='N';			
		  }else{
		  	//echo '<img src="../imgenes/eliminar.png" alt="Anulado" width="16" height="16" border="0">';
			$bloquear='S';
		  }
			if ( $row['estado']=='S'){
		 	  	$bloquearX='N';
		 	 }else{
			 	$bloquearX='S';
			 }
			  
		  ?>
		  <? //echo $bloquear; ?>
          <input type="hidden" name="bloquear" value="<?=$bloquear;?>" />
		  <input type="hidden" name="bloquearX" value="<?=$bloquearX;?>" />
      </td>
    </tr>
    <?php  
  
  }
  mysql_free_result($resultado);
  
  ?>
  </table>
</div>
<table width="100%" height="21" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="311" height="21" align="left" valign="bottom" style="color:#999999"><span class="Estilo29">&nbsp;&nbsp;Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (de <strong><?php echo $total_registros?></strong> productos)</span>.</td>
    <td width="526" align="right" valign="bottom" style="color:#999999"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:13px">
      <?php 
			  
 if(($pagina - 1) > 0) { 
echo "<a style='cursor:pointer' onclick='filtrar($pagina-1)'>< Anterior </a> "; 
} 
 echo ' <SELECT name="ProvinceState" onchange="changeValue(this)">';
for ($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
	echo '<option value="'.$i.'" selected>'.$i.'</option>';
	} else { 	
	echo '<option value="'.$i.'">'.$i.'</option>';
	}
	/*if ($pagina == $i) { 
	echo "<b style='color:#000000'>".$pagina."</b> "; 
	} else { 
	echo "<a style='cursor:pointer' href='#' onclick='filtrar($i)'>$i</a> "; 
	}*/
}	
	echo '</select>';

if(($pagina + 1)<=$total_paginas) { 
echo " <a style='cursor:pointer' onclick='filtrar($pagina+1)'>Siguiente ></a>"; 
} 
    ?>
      <input type="hidden" name="pag" value="<?php echo $pagina?>" />
    &nbsp;&nbsp;    </font> </td>
  </tr>
</table>	 
	 
	 
	<?php


	}else{


if($_REQUEST['accion']=='n'){
			$resultado3=mysql_query("select max(cod_trans) as codigo from transp_cliente",$cn);
			$row3=mysql_fetch_array($resultado3);
			
			$codigo=$row3['codigo'];
			$codigo=str_pad($codigo+1,7,'0',STR_PAD_LEFT);
			
			 $fecnac_t1=$fecha;
			 $fecnac_t2=$fecha;
			 $ocut_est='visibility:hidden;';
			
}

$strSQL4="select * from transp_cliente where cod_trans='".$_REQUEST['cod']."'";
  $resultado4=mysql_query($strSQL4,$cn);
  while($row4=mysql_fetch_array($resultado4))
  {
  $codigo=$_REQUEST['cod'];
  $placa=$row4['placa'];
  $vehiculo=$row4['vehiculo'];
  $nom_t1=$row4['nom_t1'];
  $ape_t1=$row4['ape_t1'];
  $fecnac_t1=extraefecha($row4['fecnac_t1']);
  $dni_t1=$row4['dni_t1'];
  $telf_t1=$row4['telf_t1'];
  $dir_t1=$row4['dir_t1'];
  $nom_t2=$row4['nom_t2'];
  $ape_t2=$row4['ape_t2'];
  $fecnac_t2=extraefecha($row4['fecnac_t2']);
  $dni_t2=$row4['dni_t2'];
  $telf_t2=$row4['telf_t2'];
  $dir_t2=$row4['dir_t2'];
  $fec_alta=extraefecha($row4['fec_alta']);
  $fec_baja=extraefecha($row4['fec_baja']);
  $estcli =$row4['estado'];	
		
	if( $fec_baja=='00-00-0000'){$baja=='S';}else{$baja=='N';}
	if ($fec_baja!='00-00-0000'){
		$baja='S';
	}
  
  
  $marcar0=" checked='checked' ";
  
	   if($estado_percep==0){
	      $desab=" disabled='disabled' ";
		  $marcar0=" ";
	   }else{
	   		switch($estado_percep){
				case 1:
				$marcar1=" checked='checked' ";
				break;
				case 2:
				$marcar2=" checked='checked' ";
				break;
				case 3:
				$marcar3=" checked='checked' ";
				break;
			}
	   
	   }  
  }
  
    ?>
	<table width="490" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="4" align="right"></td>
      </tr>
      
      <tr>
        <td width="13" bgcolor="#FFE7D7">&nbsp;</td>
        <td colspan="2" bgcolor="#FFE7D7">&nbsp;</td>
        <td width="19" bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td rowspan="11" bgcolor="#FFE7D7">&nbsp;&nbsp;</td>
        <td width="70" height="21" bgcolor="#FFE7D7" class="Estilo12">C&oacute;digo</td>
        <td width="379" bgcolor="#FFE7D7"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="codigo" type="text"  style="height:18; font-size:10px; font:bold" value="<?php echo $codigo?>" size="7" maxlength="7"  readonly="readonly" />&nbsp;&nbsp;&nbsp;
        </strong></font> <span class="Estilo12">Placa </span>
        <input name="placa" type="text" value="<?php echo  $placa; ?>" size="8" maxlength="8" />
        &nbsp;&nbsp;&nbsp;<span class="Estilo12">Veh&iacute;culo</span><span class="Estilo12">
        <input name="vehiculo" type="text" id="vehiculo" value="<?php echo  $vehiculo; ?>" size="18" />
        </span></td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td height="21" bgcolor="#FFE7D7" class="Estilo12"><b>Titular-1</b><br /> Nom/Raz.Social</td>
        <td bgcolor="#FFE7D7" class="Estilo12"><hr>
          <input name="nom_t1" type="text"  style="height:18; font-size:10px" value="<?php echo $nom_t1 ?>" size="50" maxlength="50" autocomplete="off" />
          &nbsp;&nbsp;          
          <input autocomplete="off" name="ape_t1" type="text"  style="height:18; font-size:10px; margin:2px ; visibility:hidden" value="<?php echo $ape_t1 ?>" size="2" />        </td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td height="21" bgcolor="#FFE7D7" class="Estilo12">DNI/RUC. </td>
        <td bgcolor="#FFE7D7" class="Estilo12">
          <input autocomplete="off" name="dni_t1" type="text"  style="height:18; font-size:10px" value="<?php echo $dni_t1 ?>" size="12" maxlength="11" />
        Telef.
        <input name="telf_t1" type="text" id="telf_t1"  style="height:18; font-size:10px; margin-left:3px" value="<?php echo $telf_t1?>" size="15" maxlength="100" />
        Fec.Nac. 
      <input name="fecnac_t1" type="text" size="10" maxlength="50" value="<?php echo $fecnac_t1 ?>" ></td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td height="21" bgcolor="#FFE7D7" class="Estilo12">Direcci&oacute;n</td>
        <td bgcolor="#FFE7D7">
          <input name="dir_t1" type="text" id="dir_t1"  style="height:18; font-size:10px" value="<?php echo $dir_t1 ?>" size="46" maxlength="100" />        </td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      
      <tr>
        <td height="22" bgcolor="#FFE7D7" class="Estilo12"><b>Titular-2</b> Nomb.</td>
        <td height="22" bgcolor="#FFE7D7">
          <hr />
          <input name="nom_t2" type="text" id="nom_t2"  style="height:18; font-size:10px" value="<?php echo $nom_t2?>" size="15" />
           &nbsp;<span class="Estilo12">Apellido
           <input name="ape_t2" type="text" id="ape_t2"  style="height:18; font-size:10px; margin:2px" value="<?php echo $ape_t2 ?>" size="38" autocomplete="off" />
           </span></td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td height="23" bgcolor="#FFE7D7" class="Estilo12">Doc Iden.</td>
        <td height="23" bgcolor="#FFE7D7" class="Estilo12">
          <input name="dni_t2" type="text" id="dni_t2"  style="height:18; font-size:10px" value="<?php echo $dni_t2 ?>" size="9" maxlength="100" />
          &nbsp;Telef.
          <input name="telf_t2" type="text" id="telf_t2"  style="height:18; font-size:10px" value="<?php echo $telf_t2 ?>" size="15" maxlength="100" />
          Fec.Nac.
          <input name="fecnac_t2" type="text" id="fecnac_t2" value="<?php echo $fecnac_t2?>" size="10" maxlength="50"></td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td height="21" bgcolor="#FFE7D7" class="Estilo12">Direcci&oacute;n</td>
        <td bgcolor="#FFE7D7"><input name="dir_t2" type="text" id="dir_t2"  style="height:18; font-size:10px" value="<?php echo $dir_t2 ?>" size="46" maxlength="100" />
        </td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td height="19" colspan="2" bgcolor="#FFE7D7"><input type="hidden" name="accion" value="<?php echo $_REQUEST['accion']?>" />
          <font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#FF0000" style="<?=$ocut_est;?>"><strong>Dar de Baja
          <input type="checkbox" name="baja" value="S" style="cursor:default; border:none; <?=$ocut_est;?>" 
		  <?php if($baja=='S'){echo "checked=checked"; }?> />
          <input style="background-color:#FFE7D7; color:#000000; text-align:center; <?php if($baja!='S'){echo "visibility:hidden"; }?> " name="fec_baja" type="text" id="fec_baja" value="<?php echo $fec_baja ?>" size="9" readonly />
          <b style="color:#000000">Estado</b>
          <input type="checkbox" name="estcli" value="S" style="cursor:default; border:none;" 
		  <?php if($estcli=='S'){echo "checked=checked"; }?> />
          <input name="fec_alta" type="text" id="fec_alta"  value="<?php echo $fec_alta ?>" size="10" maxlength="10" />
          </strong></font></td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      
      <tr>
        <td bgcolor="#FFE7D7">&nbsp;</td>
        <td colspan="2" align="right" bgcolor="#FFE7D7"><label for="Submit"></label>
          <input style="font-size:10px" type="submit" name="guardar" value="Guardar" id="guardar">
          <input style="font-size:10px" type="button" name="Submit2" value="Cancelar" id="Submit2"  onclick="ocultar();"></td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
    </table>
	
	
    pestana
    <table width="490" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="4" align="right"></td>
      </tr>
      
      <tr>
        <td width="8" rowspan="8" bgcolor="#FFE7D7">&nbsp;&nbsp;</td>
        <td height="62" colspan="3" bgcolor="#FFE7D7" class="Estilo12">
		<fieldset style="width:470px; height:212px; overflow:auto; padding-left:5px;">		
		<legend style="height:20px">Punto Canjeados</legend>
		 <table width="460" height="23" border="0" cellpadding="1" cellspacing="1" style="border:#D8D8D8 solid 1px">
  <tr style="background-image:url(../imagenes/grid3-hrow-over.gif)" bordercolor="#CCCCCC"  bgcolor="#F9F9F9" >
    <td width="19"  align="center">&nbsp;</td>
    <td width="69" class="Estilo30" >Fec.Emi</td>
    <td width="70" class="Estilo30" >Documento</td>
    <td width="118" class="Estilo30" >Producto</td>
    <td width="112" class="Estilo30" >Puntos</td>
    <td width="51" class="Estilo30" >Saldo</td>
  </tr>
  <?
$strSQLX="select * from punto_mov where cod_trans='".$_REQUEST['cod']."' order by fec_punt desc";
$resultadoX = mysql_query($strSQLX);
$J='0';
while($rowX=mysql_fetch_array($resultadoX))
{
	$J++;
	$color_row='#FFFFFF';
	if ($rowX['estado']=='A'){
		$color_row='#FF0000';
	}
  ?>
  <tr bgcolor="<?php echo $color_row?>" >
    <td  align="center" class="Estilo30"><?=$J;?>&nbsp;</td>
    <td class="Estilo30" ><?=formatofecha(substr($rowX['fec_punt'],0,10));?></td>
    <td class="Estilo30" >PU <?=$rowX['num_doc'];?></td>
    <td class="Estilo30" ><?=$rowX['nom_prod'];?></td>
    <td class="Estilo30" > <b><?=$rowX['punt_acumulado'];?>
      puntos  <? 
	  if ($rowX['efectivo']>0){ echo ' + '.number_format($rowX['efectivo'],2);} ?>
      </b></td>
    <td class="Estilo30" ><?=$rowX['punt_saldo'];?></td>
  </tr>
  <?
  }
  ?>  
</table>
        </fieldset>		<font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>&nbsp;</strong></font></td>
      </tr>
     
      <tr>
        <td height="19" colspan="2" bgcolor="#FFE7D7">&nbsp;</td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#FFE7D7">&nbsp;</td>
        <td colspan="2" align="right" bgcolor="#FFE7D7"><label for="Submit"></label>
            <input style="font-size:10px" type="submit" name="guardar2" value="Guardar" id="guardar2" />
            <input style="font-size:10px" type="button" name="Submit22" value="Cancelar" id="Submit22"  onclick="ocultar();" /></td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
    </table>
  pestana
    <?php 
}
}
?>