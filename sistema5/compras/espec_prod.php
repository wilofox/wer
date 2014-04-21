<?php session_start();?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Consulta de Producto</title>

	<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo13 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #FFFFFF; }
.Estilo14 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
}
.Estilo17 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo18 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 11px;
	color: #003366;
}

-->
    </style>
</head>

	<link rel="shortcut icon" href="favicon.ico" />
		<link rel="stylesheet" href="engine/css/lightbox.css" type="text/css" media="screen" />
		<script src="engine/js/prototype.js" type="text/javascript"></script>
		<script src="engine/js/scriptaculous.js?load=effects,builder" type="text/javascript"></script>
		<script src="engine/js/lightbox.js" type="text/javascript"></script>

	<style>
			.gallery {
				zoom:1;
				width:auto;				
			}
			.gallery a {
				display:block;
				float:left;
				margin:5px;
				opacity:0.87;
				text-align:center;
			}
			.gallery a:hover {
				opacity:1;
			}
			.gallery a img {
				border:none;
				display:block;
			}
			.gallery a#vlightbox{display:none}
    .Estilo20 {color: #0066CC}
    .Estilo22 {font-size: 11px; font-family: Arial, Helvetica, sans-serif;}
    .Estilo23 {font-size: 11px}
    .Estilo25 {font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: #FF3300; }
    </style>
<?php 

	include('../conex_inicial.php');
		
		$codigo=$_REQUEST['codigo'];	
		$sucursal=$_REQUEST['sucursal'];	
		$moneda=$_REQUEST['moneda'];	
		
	
	  $strSQL1="select * from producto where idproducto='$codigo'";
	  $resultado1=mysql_query($strSQL1,$cn);
	  while($row1=mysql_fetch_array($resultado1)){
		
	   $nombre=$row1['nombre'];
	   $cod_anexo=$row1['cod_prod'];
	   $clasificacion=$row1['clasificacion'];
	   $categoria=$row1['categoria'];
	   $subcategoria=$row1['subcategoria'];
	   $enlace=$row1['enlace'];
	   $caracteristicas=$row1['datos'];
	  }	
		
		$cadena_cla="select des_clas from clasificacion where idclasificacion='$clasificacion'";
		$des_clasificacion=consultas_BD($cadena_cla);
		
		$cadena_cat="select des_cat from categoria where idCategoria='$categoria'";
		$des_categoria=consultas_BD($cadena_cat);
		
		$cadena_subcat="select des_subcateg from subcategoria where idsubcategoria='$subcategoria'";
		$des_subcategoria=consultas_BD($cadena_subcat);
		
		
	function consultas_BD($strSQL){
	  include('../conex_inicial.php');
	  $resultado100=mysql_query($strSQL,$cn);
	  $row100=mysql_fetch_array($resultado100);
	  return  $row100[0];
	}


?>


<body style="background:#F4F4F4">
<table width="706" height="211" border="0" cellpadding="0" cellspacing="0">
  
  <tr>
    <td width="15" height="71">&nbsp;</td>
    <td width="691" valign="top"><table width="669" height="166" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="19" colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td width="387" height="19"><input style="background:#FFF1BB" readonly="" name="textfield" type="text" size="5" maxlength="10" value="<?php echo $codigo;?>">
          <input style="background-color:#FFF1BB" readonly="" value="<?php echo $nombre?>" name="textfield2" type="text" size="45" maxlength="200"></td>
        <td height="19"><span class="Estilo18">Imagen de producto </span></td>
      </tr>
      <tr>
        <td height="50">
		
		<div style="width:385; height:150; overflow:scroll; border:#CCCCCC solid 1px">
		<table width="366" border="0" cellpadding="0" cellspacing="1">
          <tr style="background:url(../imagenes/bg_contentbase4.gif); background-position:100px 50px">
            <td width="42" align="center"><span class="Estilo13">Alm</span></td>
            <td width="234" align="center"><span class="Estilo13">Almac&eacute;n</span></td>
            <td width="48" align="center"><span class="Estilo13">Stock</span></td>
            <td width="37">&nbsp;</td>
          </tr>
		  <?php 
		  
		  
		  	$strSQL21="select * from producto where idproducto='$codigo'";
			$resultado21=mysql_query($strSQL21,$cn);
			$row21=mysql_fetch_array($resultado21);
			$moneda_prod=$row21['moneda'];
			
			if($moneda=='02'){
			$simbolo_moneda=" Dolares (US$.) ";
			}else{
			$simbolo_moneda=" Soles (S/.) ";
			}
			
			//echo $row21['precio'];
			if($moneda=='02' && $moneda_prod=='01'){
			//$pcosto=number_format($row21['costo_inven'.$sucursal]/$tcambio,2);
			  $pcosto=number_format($row21['pre_ref']/$tcambio,2);
			  $precio1=number_format($row21['precio']/$tcambio,2);
			  $precio2=number_format($row21['precio2']/$tcambio,2);
			  $precio3=number_format($row21['precio3']/$tcambio,2);
			  $precio4=number_format($row21['precio4']/$tcambio,2);
			  $precio5=number_format($row21['precio5']/$tcambio,2);
			  
			}else{
				if($moneda=='01' && $moneda_prod=='02'){
				$pcosto=number_format($row21['pre_ref']*$tcambio,2);
				$precio1=number_format($row21['precio']*$tcambio,2);
				$precio2=number_format($row21['precio2']*$tcambio,2);
				$precio3=number_format($row21['precio3']*$tcambio,2);
				$precio4=number_format($row21['precio4']*$tcambio,2);
				$precio5=number_format($row21['precio5']*$tcambio,2);
				}else{
				//echo $row21['precio2'];
			    $pcosto=$row21['pre_ref'];
				$precio1=$row21['precio'];
				$precio2=$row21['precio2'];
				$precio3=$row21['precio3'];
				$precio4=$row21['precio4'];
				$precio5=$row21['precio5'];
				}
			}
		  
		  $strSQL22="select * from tienda order by cod_tienda";
			$resultado22=mysql_query($strSQL22,$cn);
			while($row22=mysql_fetch_array($resultado22)){
				$campo='saldo'.$row22['cod_tienda'];	  
		  ?>
          <tr bgcolor="#FFFFFF">
            <td align="center" ><span class="Estilo17"><?php echo $row22['cod_tienda'];?></span></td>
            <td ><span class="Estilo17"><?php echo $row22['des_tienda'];?></span></td>
            <td align="center"><span class="Estilo17"><?php echo $row21[$campo] ;?></span></td>
            <td ><span class="Estilo17"></span></td>
          </tr>
		  	<?
			}
			?>	  
        </table>
		</div>		</td>
        <td width="282" valign="top" style="padding-left:20px">
		
		<?php if($row21['imagen']==''){
			$img="../imagenes/img_no_disponible.jpg";
			}else{
			$img="../".$row21['imagen']; 
			} ?>
		
		<table width="204" height="175" border="1" cellpadding="0" cellspacing="0" >
          <tr>		           
			<td width="200" align="center">
						
			<div class="gallery"> <a href="<?php echo $img?>" rel="lightbox[sample]" title="<?php echo $nombre?>"> <img src="<?php echo $img?>" width="180" height="150" border="0"> </a> </div></td>
          </tr>
        </table>		</td>
      </tr>
      <tr>
        <td><table width="382" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="91"><span class="Estilo14">Cod. Anexo</span> </td>
            <td width="127"><input name="textfield3" type="text" disabled="disabled" style="font:bold" value="<?php echo $cod_anexo?>" size="10"></td>
            <td width="180">&nbsp;</td>
          </tr>
          <tr>
            <td><span class="Estilo14"><?=$CatgNomEti1;?></span></td>
            <td colspan="2"><input style="font:bold; font-size:11px"  readonly="readonly" name="textfield32" type="text" size="35" maxlength="100" value="<?php echo $des_clasificacion?>"></td>
            </tr>
          <tr>
            <td><span class="Estilo14"><?=$CatgNomEti2;?></span></td>
            <td colspan="2"><input style="font:bold; font-size:11px"  readonly="readonly" name="textfield33" type="text" size="35" maxlength="100" value="<?php echo $des_categoria?>"></td>
            </tr>
          <tr>
            <td><span class="Estilo14"><?=$CatgNomEti3;?></span></td>
            <td colspan="2"><input  style="font:bold; font-size:11px"  readonly="readonly" name="textfield34" type="text" size="35" maxlength="100" value="<?php echo $des_subcategoria?>"></td>
            </tr>
        </table></td>
        <td width="282" rowspan="2" valign="top"><table width="251" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="251" height="29"><table width="207" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="22"><span class="Estilo17">Url.</span></td>
                  <td  width="185" align="center" valign="middle"><table width="100%" height="20" border="0" align="left" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="border:#999999 solid 1px">
                      <tr>
                        <td width="183"><a href="<?php echo $enlace?>" target="_blank"><span class="Estilo17"><?php echo substr($enlace,0,30)."..."?></span></a></td>
                      </tr>
                  </table></td>
                </tr>
            </table></td>
          </tr>
        </table> 
		<?php 
		if($_SESSION['nivel_usu']!=2 ){
		?>
		
		<table width="249" height="145" border="0" cellpadding="0" cellspacing="0" bgcolor="#F0FABC" style="border:#006699 solid 1px">
            <tr>
              <td height="20" colspan="5"><span class="Estilo14"><span class="Estilo20">Moneda:</span></span>
			  
			    <span class="Estilo25">
			    <?php 
			  echo $simbolo_moneda
			  ?>
   			      </span></td>
            </tr>
            <tr>
              <td height="30" colspan="5" style="border-bottom:#E5E5E5 solid 1px"><span class="Estilo14"><span class="Estilo20">Costo Referencial: 
                    <input name="textfield352" type="text"  readonly="readonly" style="font:bold; text-align:right" value="<?php echo $pcosto?>" size="10">
                </span></span></td>
              </tr>
            <tr>
              <td width="4" height="25" bgcolor="#F3F9FA" class="Estilo22">&nbsp;</td>
              <td width="97" bgcolor="#F3F9FA" class="Estilo22"><?php echo $PrecNomEti1 ?></td>
              <td width="31" bgcolor="#F3F9FA"><span class="Estilo20">
                <input name="textfield3522" type="text"  readonly="readonly" style="font:bold; font-size:9px; text-align:right" value="<?php echo $precio1?>" size="6">
              </span></td>
              <td width="80" bgcolor="#F3F9FA" class="Estilo22">&nbsp;<?php echo $PrecNomEti3 ?></td>
              <td width="35" bgcolor="#F3F9FA"><span class="Estilo20">
                <input name="textfield35223" type="text"  readonly="readonly" style="font:bold; font-size:9px; text-align:right" value="<?php echo $precio3?>" size="6">
              </span></td>
            </tr>
            <tr>
              <td height="24" bgcolor="#F3F9FA" class="Estilo22">&nbsp;</td>
              <td bgcolor="#F3F9FA" class="Estilo22"><?php echo $PrecNomEti2 ?></td>
              <td bgcolor="#F3F9FA"><span class="Estilo20">
                <input name="textfield35222" type="text"  readonly="readonly" style="font:bold; font-size:9px; text-align:right" value="<?php echo $precio2?>" size="6">
              </span></td>
              <td bgcolor="#F3F9FA"><span class="Estilo17 Estilo23"><span class="Estilo22">&nbsp;</span><span class="Estilo22"><?php echo $PrecNomEti4 ?></span></span></td>
              <td bgcolor="#F3F9FA"><span class="Estilo20">
                <input name="textfield35224" type="text"  readonly="readonly" style="font:bold; font-size:9px; text-align:right" value="<?php echo $precio4?>" size="6">
              </span></td>
            </tr>
            <tr>
              <td height="25" bgcolor="#F3F9FA" class="Estilo17 Estilo23">&nbsp;</td>
              <td bgcolor="#F3F9FA" class="Estilo17 Estilo23"><span class="Estilo22"><?php echo $PrecNomEti5 ?></span></td>
              <td colspan="3" bgcolor="#F3F9FA"><span class="Estilo20">
                <input name="textfield35225" type="text"  readonly="readonly" style="font:bold; font-size:9px; text-align:right" value="<?php echo $precio5?>" size="6">
              </span></td>
            </tr>
            <tr>
              <td bgcolor="#F3F9FA">&nbsp;</td>
              <td bgcolor="#F3F9FA">&nbsp;</td>
              <td colspan="3" bgcolor="#F3F9FA">&nbsp;</td>
            </tr>
          </table>
		  
		  
		  <?php } ?>
		  
		  
		  
		  </td>
      </tr>
      
      
      <tr>
        <td><table width="361" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="92"><span class="Estilo14">Caracter&iacute;sticas</span></td>
            <td width="259" style="border:#CCCCCC solid 1px"><div  style="background-color:#FFFFFF; overflow-y:scroll; height:90px; width:270px; border-color:#E7EFFE"> <?php echo $caracteristicas?> </div></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
<?php mysql_close($cn);?>