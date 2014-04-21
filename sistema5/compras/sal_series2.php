<?php 
  session_start();
  include('../conex_inicial.php');
  include('../funciones/funciones.php');
  
  $accion=$_REQUEST['accion']; 
  $producto=$_REQUEST['producto'];
  $fechaemi=$_REQUEST['fecha'];
  $cantidad=$_REQUEST['cant'];
  $tienda=$_REQUEST['tienda'];
  
  $strSQL="select * from producto where idproducto='".$producto."'";
  $resultado=mysql_query($strSQL,$cn);
  $row=mysql_fetch_array($resultado);
      
  $nom_prod=$row['nombre'];
  $codigo_prod=$row['idproducto'];
  $garantia=$row['garantia'];
  
 // echo suma_fecha($fecha,);
      
   $fecha = new Fecha();
   $fecha->Fecha('2010','12','18','00','00','00');
   $fecha->SumaTiempo('0',$garantia,'0','0','0','0');
   $fvenc=$fecha->getFecha();
  // echo substr($fvenc,0,10);
  
  $item_sel=0;
  if($accion=='editar'){
  $item_sel=$cantidad;
    
    
  }
  
?><style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {font-weight: bold}
-->
</style>

<form id="form_series" name="form_series" method="post" action="">
  <table width="477" border="0" cellpadding="0" cellspacing="0">

    <tr>
      <td width="4" >&nbsp;</td>
      <td width="453"><table width="431" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="275"><span class="Estilo1" style="font-size:10px">Producto: </span>&nbsp;&nbsp;<span style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#0066FF; font:bold"><?php echo $nom_prod; ?>
              <input type="hidden" name="temp_fvenserie" id="temp_fvenserie" value="<?php echo substr($fvenc,0,10) ?>" />
            </span><span style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#0066FF; font:bold">
            <input type="hidden" name="accion_series" id="accion_series" value="<?php echo $accion ?>" />
            </span><br>
			<span class="Estilo1" style="font-size:10px">C&oacute;digo: </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#0066FF; font:bold"><?php echo  $codigo_prod; ?>
              <input type="hidden" name="temp_fvenserie" id="temp_fvenserie" value="<?php echo substr($fvenc,0,10) ?>" /><input type="hidden" name="codprod2" id="codprod2" value="<?php echo $codigo_prod ?>" />
			</span></td>
            <td width="72" rowspan="2" align="center" >	
				<fieldset>
			<strong>
			<span style="font:Arial, Helvetica, sans-serif; font-size:10px; color:#000000" >Cantidad Requerida:</span></strong><br>
            <span style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000; font:bold"><?php echo  $cantidad?></span>
			<input type="hidden" name="cant_req" value="<?php echo  $cantidad?>" />
			</fieldset>					 </td>
            <td width="10" rowspan="2" align="center" >			</td>
            <td width="74" rowspan="2" align="center" >
				<fieldset>
			<strong>
			<span style="font:Arial, Helvetica, sans-serif; font-size:10px; color:#000000" >Items<br>&nbsp;&nbsp;&nbsp; Selec.:&nbsp;&nbsp;&nbsp;</span></strong><br>
            <span id="label_cant_selec" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000; font:bold"><?php echo  $item_sel?></span>
			<input type="hidden" name="cant_selec" value="<?php echo  $cantidad?>" />
			</fieldset>	
			</td>
          </tr>
          <tr>
            <td><table width="233" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="53" height="26" style="font:Arial, Helvetica, sans-serif; font-size:10px; color:#000000"><strong>Escanner</strong></td>
                <td width="180"><input  autocomplete="off"  onkeydown="buscar_serie(this,event)"  name="scanner" type="text" id="scanner" size="30" maxlength="250" />                 </td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td colspan="4"><div style="height:200px; overflow-y:scroll">
			
                <table id="tbl_series" width="427" border="0" cellpadding="0" cellspacing="1">
                  <tr style="background-image:url(imagenes/bg_contentbase2.gif); background-position:100% 40%">
                    <td width="51" height="19">&nbsp;</td>
                    <td width="213" align="center" style="color:#FFFFFF; font-size:11px; font-family:Arial, Helvetica, sans-serif"><strong>Nro. de Serie </strong></td>
                    <td width="159" align="center" style="color:#FFFFFF; font-size:11px; font-family:Arial, Helvetica, sans-serif"><strong>Garant&iacute;a</strong> </td>
                  </tr>
<?php 
	$strSQL="select * from series where tienda='".$tienda."' and producto='".$codigo_prod."' and (salida='' || salida=0) ";
	//	print_r($_SESSION['seriesprod'][0]);
	$resultado=mysql_query($strSQL,$cn);
	while($row=mysql_fetch_array($resultado)){
		$temporal="N";
		$bgcolor="#ffffff";
		$checkbox=" ";
					
		if($accion=='editar'){	
			foreach ($_SESSION['seriesprod'][0] as $subkey=> $subvalue) {
				if($subvalue==$row['serie']){
					$bgcolor="#fff1bb";
					$checkbox=" checked='checked' ";
							
					if($row['estado']=='V' && $subvalue!=$row['serie']){
						$temporal="S";
					}
							
				}
											
							
			}
		}else{
						
			if(isset($_SESSION['seriesprod'][0])){
				foreach ($_SESSION['seriesprod'][0] as $subkey=> $subvalue) {
					if($subvalue==$row['serie'] || $row['estado']=='V'){
						$temporal="S";
					}
				}
			}
		}
					
		if($temporal=='N'){
		
			$tepmSer=caracteres((str_replace("’","&#8217;",$row['serie'])));				
			  ?>
                  <tr onClick="entradae(this)" bgcolor="#FFFFFF"  style="background:<?php echo $bgcolor ?>" >
                    <td height="20"  align="center"  >
					<input <?php echo $checkbox ?>  style="border:none; background:none" type="checkbox" name="checkbox" value="checkbox" /></td>
                    <td align="center"><span style="color:#000000"><?php echo strtoupper($tepmSer); ?></span></td>
                    <td align="center"><span style="color:#000000"><?php echo $garantia." meses" ?></span></td>
                  </tr>
                  <?php 
				  
	  	}
	}
		
		?>
                </table>
            </div></td>
          </tr>
      </table></td>
      <td width="12">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center"><input onclick="aceptar_sal_serie(); " onmouseover="cambiar_fondo(this,'e')" onmouseout="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(imagenes/boton_aplicar.gif) ; cursor:pointer" type="button" name="Submit" value="Aceptar" />
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
             <input onclick="Modalbox.hide(); return false;" onmouseover="cambiar_fondo(this,'e')" onmouseout="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(imagenes/boton_aplicar.gif) ; cursor:pointer" type="button" name="Submit" value="Cancelar" />
      </td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
