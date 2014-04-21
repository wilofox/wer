<?php 
session_start();
include('../conex_inicial.php');
include('../funciones/funciones.php');

$referencia=$_REQUEST['referencia'];


if(isset($_REQUEST['Submit'])){


$pcosto=$_REQUEST['pre_costo'];
$codprod=$_REQUEST['codprod'];
$total_item=$_REQUEST['total_item'];
$moneda_doc=$_REQUEST['cbo_moneda'];
$fecha_doc=$_REQUEST['fecha_doc'];
$fecha_doc=cambiarfecha($fecha_doc);
$responsable=$_REQUEST['responsable'];
$baseimponible=$_REQUEST['baseimponible'];
$impuesto=$_REQUEST['impuesto'];
$total_general=$_REQUEST['total_general'];
$incluidoigv=$_REQUEST['incluye'];
$condicion=$_REQUEST['condicion'];
//print_r($total_item);
$fecharegis=$_REQUEST['fecharegis'];
$numeroOT=$_REQUEST['serieOT']."-".$_REQUEST['numeroOT'];

if($incluidoigv==''){
$incluidoigv='S';
}

		for($i=0;$i<count($codprod);$i++){
	
		   $strSQL="update det_mov set precio='".$pcosto[$i]."',imp_item='".$total_item[$i]."',fechad='".$fecha_doc."' where cod_prod='".$codprod[$i]."' and cod_cab='".$referencia."' ";
		   mysql_query($strSQL,$cn);
		  // echo $strSQL;
	   }
	
		$strSQL="update cab_mov set moneda='".$moneda_doc."',fecha='".$fecha_doc."',f_venc='".$fecha_doc."',cod_vendedor='".$responsable."',b_imp='".$baseimponible."',igv='".$impuesto."',total='".$total_general."',incluidoigv='".$incluidoigv."',condicion='".$condicion."',fecharegis='".$fecharegis."',numeroOT='".$numeroOT."' where cod_cab='".$referencia."' ";
		mysql_query($strSQL,$cn);
	
}


$strsql="select * from cab_mov where cod_cab='$referencia'";
$resultado=mysql_query($strsql,$cn);
$cont=mysql_num_rows($resultado);
$row=mysql_fetch_array($resultado);
//echo $cont;

$noperacion=$row['noperacion'];
$numero=$row['Num_doc'];
$serie=$row['serie'];
$flag=$row['flag'];


$ruc=$row['ruc'];
$cliente=$row['cliente'];
$fecha=$row['fecha'];
$cod_ope=$row['cod_ope'];
$codsucursal=$row['sucursal'];
$codtienda=$row['tienda'];
$cod_vendedor=$row['cod_vendedor'];
$tipo_cambio=$row['tc'];
$moneda=$row['moneda'];
$fecha_aud=$row['fecha_aud'];
$nom_pc=$row['pc'];
$base_imponible=$row['b_imp'];
$impuesto=$row['igv'];
$incluidoigv=$row['incluidoigv'];
$inafecto=$row['inafecto'];
$importe=$row['total'];
$impto=$row['impto1'];
$condicion=$row['condicion'];
$fecharegis=$row['fecharegis'];
$temp=explode("-",$row['numeroOT']);

$serieOT=$temp[0];
$numeroOT=$temp[1];


$des_doc="";
if($inafecto=='S'){
	$des_doc=" disabled='disabled' ";
}


	$strSQL_clie="select *  from cliente where codcliente='".$cliente."'";
	$resultado_clie=mysql_query($strSQL_clie,$cn);
	$row_clie=mysql_fetch_array($resultado_clie);
	$razonsocial=$row_clie['razonsocial'];
	$ruc=$row_clie['ruc'];
	$direccion=$row_clie['direccion'];
	
//	echo $strSQL_clie;
	
	$strSQL_ope="select *  from operacion where codigo='".$cod_ope."'";
	$resultado_ope=mysql_query($strSQL_ope,$cn);
	$row_ope=mysql_fetch_array($resultado_ope);
	$ticket=$row_ope['descripcion'];
	
	$strSQL_emp="select des_suc from sucursal where cod_suc='".$codsucursal."'";
	$resultado_emp=mysql_query($strSQL_emp,$cn);
	$row_emp=mysql_fetch_array($resultado_emp);
	$dessuc=$row_emp['des_suc'];
	
	
	
	$strSQL_tien="select des_tienda from tienda where cod_tienda='".$codtienda."'";
	$resultado_tien=mysql_query($strSQL_tien,$cn);
	$row_tien=mysql_fetch_array($resultado_tien);
	$destienda=$row_tien['des_tienda'];
	
	$empresa=$dessuc." / ".$destienda;
	
	/*
	$strSQL_vend="select usuario from usuarios where codigo='".$cod_vendedor."'";
	$resultado_vend=mysql_query($strSQL_vend,$cn);
	$row_vend=mysql_fetch_array($resultado_vend);
	
	$responsable=$row_vend['usuario'];
	*/
	
	$afecha=explode('-',trim(substr($fecha,0,10)));
	$fecha=$afecha[2]."-".$afecha[1]."-".$afecha[0];


?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>detalle</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {
	color: #FFFFFF;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo3 {
	color: #003366;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo7 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.Estilo12 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo19 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo21 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #FF0000; }
.Estilo24 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #FFFFFF; }
.Estilo15 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #990000;
}
-->
</style></head>

<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>

<script>

var inafecto="<?php echo $inafecto ?>";
</script>

<body>
<form name="form1" method="post" action="">
  <table width="100%" height="313" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="32" colspan="3" align="center" bgcolor="#003366"><span class="Estilo1"><?php echo strtoupper($ticket); ?>
        <input type="hidden" name="referencia" id="referencia" value="<?php echo $referencia ?>">
</span></td>
      <?php if($flag=='A'){?>
    </tr>
    <tr>
      <td height="21" colspan="3" align="center" ><span class="Estilo21">( Anulado )</span></td>
    </tr>
    <?php }?>
    <tr>
      <td width="6" height="86">&nbsp;</td>
      <td width="100%" style="padding-top:10px">
	  
	  <fieldset style="vertical-align:middle">
        <table style="background:#F7F7F7" width="100%" height="156" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="19">&nbsp;</td>
            <td colspan="2"><span class="Estilo7">Empresa/ Tienda: </span><span class="Estilo12"><?php echo $empresa; ?></span></td>
          </tr>
          <tr>
            <td width="33" height="19">&nbsp;</td>
            <td width="491"><span class="Estilo12"><span class="Estilo7">TD</span>: <?php echo $cod_ope." : ".$serie."-".$numero ?></strong></span></td>
            <td width="343">
			
			<?php /*?><span class="Estilo12">
			<?php echo "Nro.Operaci&oacute;n: ".str_pad($noperacion, 10, "0", STR_PAD_LEFT)?>
			</span><?php */?>
			
			
			
			<span class="Estilo7">Fecha: </span><span class="Estilo12">
            <input style="height:20px; font-size:12px; font-family: Arial, Helvetica, sans-serif" name="fecha_doc" type="text" value="<?php echo $fecha; ?>" size="10" maxlength="8">
            <button type="reset" id="f_trigger_b2"  style="height:18" >...</button>
            <script type="text/javascript">
					Calendar.setup({
						inputField     :    "fecha_doc",      
						ifFormat       :    "%d-%m-%Y",      
						showsTime      :    true,            
						button         :    "f_trigger_b2",   
						singleClick    :    true,           
						step           :    1                
					});
				</script>
            </span></td>
          </tr>
          <tr>
            <td height="19">&nbsp;</td>
            <td><span class="Estilo7">Se&ntilde;ores:</span><span class="Estilo12"> <?php echo $razonsocial; ?></span></td>
            <td><span class="Estilo7">Ruc:</span><span class="Estilo12">&nbsp;<?php echo $ruc; ?></span></td>
          </tr>
          <tr>
            <td height="19">&nbsp;</td>
            <td><span class="Estilo7">Direcci&oacute;n</span>:<span class="Estilo12"><?php echo $direccion; ?></span></td>
            <td valign="top"><span class="Estilo7">Tc.</span><span class="Estilo12"><?php echo $tipo_cambio; ?></span> <span class="Estilo7">&nbsp;&nbsp;&nbsp;Moneda:</span><span class="Estilo12">
            <?php 
		//echo $moneda; 
		if($moneda=='01'){
		$select_sol=" selected='selected' ";
		$select_dol=" ";
		}else{
		$select_sol=" ";
		$select_dol=" selected='selected' ";
		}
		//echo "sol=".$select_sol." dol=".$select_dol;
		?>
            <select name="cbo_moneda" id="cbo_moneda"  style="width:100px; font:Arial, Helvetica, sans-serif; font-size:10px"  >
              <option <?php echo $select_sol ?>  value="01">SOLES S/.</option>
              <option <?php echo $select_dol ?> value="02">DOLARES US$.</option>
            </select>
            </span></td>
          </tr>
          <tr>
            <td height="26">&nbsp;</td>
            <td><span class="Estilo7">Responsable:
 
			  
			  
              <span class="Estilo15">
              <select name="responsable" style="width:120" >
                <?php 
			$marcar="";
		    $resultados11 = mysql_query("select * from usuarios order by usuario ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			$marcar="";
			if($row11['codigo']==$cod_vendedor){
			$marcar=" selected='selected' ";
			}
		  ?>
                <option <?php echo $marcar?> value="<?php echo $row11['codigo']?>"><?php echo $row11['usuario'];?></option>
                <?php }
				
				?>
              </select>
            </span></span></td>
            <td>
			
			<span class="Estilo7">Impuesto:			</span>
			<?php 
				
			
				
				if($incluidoigv=='S'){
				$marcar_imp1=" selected='selected' ";
				$marcar_imp2=" ";
				}else{
				$marcar_imp1=" ";
				$marcar_imp2=" selected='selected' ";
				}
			
			 if($inafecto=='N'){
			?>
			
			
                <select name="incluye" <?php echo $des_doc ?> onChange="calcular()" >
			    <option <?php echo $marcar_imp1 ?> value="S">Incluido IGV</option>
                <option <?php echo $marcar_imp2 ?> value="N">No Incluye IGV</option>
              </select>
			  
			  <?php 
			  
			  }else{
			
			   echo "<strong><font  color='#FF0000' style='font-size:11px; font:Arial, Helvetica, sans-serif'> DOC. INAFECTO </font></strong>";
				
			  }
			  
			  ?>			</td>
          </tr>
          <tr>
            <td height="27">&nbsp;</td>
            <td><span class="Estilo7">Condición:
              
            </span><span class="Estilo15">
            <select name="condicion" id="condicion" style="width:120" >
              <?php 
			$marcar="";
		    $resultados11 = mysql_query("select * from detope where documento='".$cod_ope."' order by descondi ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			$marcar="";
			if($row11['condicion']==$condicion){
			$marcar=" selected='selected' ";
			}
		  ?>
              <option <?php echo $marcar?> value="<?php echo $row11['condicion']?>"><?php echo $row11['descondi'];?></option>
              <?php }
				
				?>
            </select>
            </span></td>
            <td><span class="Estilo7">
              Orden de Trabajo
              <input name="serieOT" id="serieOT" type="text" size="3" maxlength="3" value="<?php echo $serieOT?>">
              <input name="numeroOT" id="numeroOT" type="text" size="8" maxlength="7" value="<?php echo $numeroOT?>">
            </span></td>
          </tr>
          <tr>
            <td height="27">&nbsp;</td>
            <td><span class="Estilo7">Fecha de Registro:
              <input readonly="readonly" name="fecharegis" type="text" id="fecharegis" value="<?php echo $fecharegis ?>" size="10" maxlength="10">
              <button type="reset" id="f_trigger_b3"  style="height:18" >...</button>
              <script type="text/javascript">
					Calendar.setup({
						inputField     :    "fecharegis",      
						ifFormat       :    "%Y-%m-%d",      
						showsTime      :    true,            
						button         :    "f_trigger_b3",   
						singleClick    :    true,           
						step           :    1                
					});
				</script>
</span></td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </fieldset></td>
      <td width="10">&nbsp;</td>
    </tr>
    <tr>
      <td height="117">&nbsp;</td>
      <td><table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td height="25" colspan="6"><span class="Estilo3">Detalle del Pedido: </span></td>
          </tr>
          <tr style="background:url(../imagenes/bg_contentbase2.gif);  background-position:100% 40%;">
            <td width="78" height="18" align="center" ><span class="Estilo24">C&oacute;digo </span></td>
            <td width="194" ><span class="Estilo24">Producto</span></td>
            <td width="40" align="center" ><span class="Estilo24">Und.</span></td>
            <td width="47" align="center" ><span class="Estilo24">Cant.</span></td>
            <td width="40" align="right" ><span class="Estilo24">P.Costo</span></td>
            <td width="77" align="right" ><span class="Estilo24">Total</span></td>
          </tr>
          <?php 
	  
	  $strSQL4="select cantidad,cod_prod,nom_prod,precio,unidad,imp_item  from det_mov where cod_cab='".$referencia."' order by cod_det";
 $resultado4=mysql_query($strSQL4,$cn);
// echo $strSQL4;
$nitems=0;
 while($row4=mysql_fetch_array($resultado4)){
 $nitems=$nitems+1;
 
 
	  ?>
          <tr>
            <td valign="top" bgcolor="#EFEFEF" class="Estilo7" ><?php echo substr($row4['cod_prod'],0,50);?>
            <input name="codprod[]" id="codprod" type="hidden" value="<?php echo $row4['cod_prod'];?>"></td>
            <td bgcolor="#EFEFEF"><span class="Estilo7"><?php echo substr($row4['nom_prod'],0,50);?></span><span class="Estilo7" style="color:#0066FF; font-family:Arial, Helvetica, sans-serif; font-size:9px"><br>
                  <?php
	  $sqlx="SELECT serie from series WHERE producto=".$row4['cod_prod']." and tienda='".$codtienda."' and (ingreso ='".$referencia."' or salida='".$referencia."')";
	//echo $sqlx;
	$seriesx="";
	  $resultadox=mysql_query($sqlx,$cn);
	  if(mysql_num_rows($resultadox)){
	  $c=0;
		  while($rowx=mysql_fetch_array($resultadox)){
		  $d=1;
		  //$f=4*$d;
			  /*
			  if($c%4==0){
			  $seriesx=$seriesx."<br>"; 
			  $d++;
			  }
			  */
		  $seriesx=$rowx['serie']." ,&nbsp;&nbsp; ";	
		  echo $seriesx;
		 // $c++;  
		  }
	  
	  ?>
      <?php //echo "Series::".$seriesx; 
		}
		
	  ?></span>            </td>
            <td valign="top"  align="center" bgcolor="#EFEFEF"><span class="Estilo7">
              <?php 
		$strUND="select * from unidades  where id='".$row4['unidad']."'";
		$resultadoUND=mysql_query($strUND,$cn);
		$rowUND=mysql_fetch_array($resultadoUND);
		 echo $rowUND['nombre'];

			
		?>
            </span></td>
            <td align="center" bgcolor="#EFEFEF" valign="top" ><span class="Estilo7">
              <input name="cantidad" id="cantidad" type="hidden" value="<?php echo $row4['cantidad'];?>">
              <?php echo $row4['cantidad'];?></span></td>
            <td align="right" bgcolor="#EFEFEF" valign="top" ><span class="Estilo7">
              <?php 
	
	$strSQL40="select * from producto where idproducto='".$row4['cod_prod']."'";
 $resultado40=mysql_query($strSQL40,$cn);
	$row40=mysql_fetch_array($resultado40);
	
	//$total=$row4['precio']*$row4['cantidad'];
	//$importe=$importe+$total;
	
	//echo number_format($row4['precio'],2);
	?>
              <input name="pre_costo[]" id="pre_costo" type="text" size="5" maxlength="8" value="<?php echo number_format($row4['precio'],4,'.','');?>"  onKeyUp="calcular(this,event)" style="text-align:right">
            </span></td>
            <td align="right" valign="top"  bgcolor="#EFEFEF"><span class="Estilo7" >
              <input  name="total_item[]" id="total_item" type="hidden" size="5" maxlength="8" value="<?php echo number_format($row4['imp_item'],2,'.',''); ?>" style="text-align:right">
			  
			  <input disabled="disabled" name="total_item2[]" id="total_item2" type="text" size="5" maxlength="8" value="<?php echo number_format($row4['imp_item'],2,'.',''); ?>" style="text-align:right">
			  
            </span></td>
          </tr>
          <?php }?>
          <tr>
            <td >&nbsp;</td>
            <td colspan="4" align="right"><span class="Estilo7">Base Imponible </span></td>
            <td align="right"><span class="Estilo12">
              <input  readonly="readonly" name="baseimponible" type="text" id="baseimponible" value="<?php echo number_format($base_imponible,2,'.','');?>" size="5" maxlength="8" style="text-align:right">
            </span></td>
          </tr>
          <tr>
            <td >&nbsp;</td>
            <td colspan="4" align="right"><span class="Estilo7">Impuesto(<?php echo $impto?>%)</span></td>
            <td align="right"><span class="Estilo12">
              <input  readonly="readonly" name="impuesto" type="text" id="impuesto" value="<?php echo number_format($impuesto,2,'.','');?>" size="5" maxlength="8" style="text-align:right">
            </span></td>
          </tr>
          <tr>
            <td >&nbsp;</td>
            <td colspan="4" align="right"><span class="Estilo7">Total General <?php echo $simbolo;?> </span></td>
            <td align="right"><span class="Estilo12"><input  readonly="readonly" name="total_general" type="text" id="total_general" value="<?php echo number_format($importe,2,'.','');?>" size="5" maxlength="8" style="text-align:right">
            </span></td>
          </tr>
      </table></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
      <td><fieldset>
        <legend><span class="Estilo12">Auditoria</span></legend>
        <table  width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="232"><span class="Estilo7">Fecha de Creaci&oacute;n : </span><span class="Estilo12"><?php echo $fecha_aud?></span></td>
            <td width="254" colspan="2"><span class="Estilo7">Nombre PC: </span><span class="Estilo12"><?php echo $nom_pc?></span></td>
          </tr>
        </table>
        </fieldset>
         </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
      <td align="center"><input type="submit" name="Submit" value="Guardar Cambios"></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>

<script>

function calcular(valor,e){
	
	
		
	try {
		 if (typeof(eval(document.form1.pre_costo.length)) != 'undefined')
		 var ESarray='S';
		 else
		 var ESarray='N';
	} catch(e) { }
	 
	// alert(ESarray);
	if(ESarray=='S'){
		
		if( typeof(eval(valor))!= 'undefined' ){	
			for(var i=0;i<document.form1.pre_costo.length;i++){
			
				if(valor==document.form1.pre_costo[i]){
				//alert(document.form1.total_item[i].value);
				document.form1.total_item[i].value=valor.value*document.form1.cantidad[i].value;
				document.form1.total_item2[i].value=valor.value*document.form1.cantidad[i].value;
				
				}
				
			}
		}
		
		var temp=0;
		for(var i=0;i<document.form1.total_item.length;i++){
		//alert(document.form1.total_item[i].value);
		var temp=parseFloat(temp) + parseFloat(document.form1.total_item[i].value);

		}
		
		calc_base_imp(temp);
		
	}else{
	
	if( typeof(eval(valor))!= 'undefined' ){
	
	  //alert();
		document.form1.total_item.value=valor.value*document.form1.cantidad.value;
		document.form1.total_item2.value=valor.value*document.form1.cantidad.value;
	}
	//document.form1.total_general.value=document.form1.total_item.value;
	calc_base_imp(document.form1.total_item.value);
	}
	
	
}

	
function calc_base_imp(total){
	
	if(inafecto=='S'){
	document.form1.total_general.value=parseFloat(total).toFixed(2);
	document.form1.baseimponible.value=parseFloat(total).toFixed(2);
	}else{
	
		if(document.form1.incluye.value=='S'){
		
		var base=total/1.19;
		var impuesto=total-base;
		
		document.form1.baseimponible.value=parseFloat(base).toFixed(2);
		document.form1.impuesto.value=parseFloat(impuesto).toFixed(2);
		document.form1.total_general.value=parseFloat(total).toFixed(2);
		
		}else{
		
		var base=parseFloat(total);
		var impuesto=total*0.19;
		var total2=base+impuesto;
		
		document.form1.baseimponible.value=parseFloat(base).toFixed(2);
		document.form1.impuesto.value=parseFloat(impuesto).toFixed(2);
		document.form1.total_general.value=parseFloat(total2).toFixed(2);
		
		
		}
	
	
	}
	
}


</script>