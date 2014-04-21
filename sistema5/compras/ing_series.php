<?php 
  session_start();
  include('../conex_inicial.php');
  include('../funciones/funciones.php');
  
	$accion=$_REQUEST['accion'];
  	$estado_doc=$_REQUEST['estado_doc'];
	$temp_doc=$_REQUEST['temp_doc'];
	$tienda=$_REQUEST['tienda'];
	$cod_cab_ref=$_REQUEST['cod_cab_ref'];
	
	
	unset($_SESSION['temp_series2'][0]);
	unset($_SESSION['temp_series2'][1]);
	unset($_SESSION['temp_series2'][2]);
	
	if($accion=='editar'){
			$producto=$_REQUEST['producto'];
			
			   if($estado_doc=='CONSULTA' || $cod_cab_ref!=''){
			
				unset($_SESSION['seriesprod'][0]);
				unset($_SESSION['seriesprod'][1]);
				unset($_SESSION['seriesprod'][2]);
				
				if($cod_cab_ref!=''){
				$temp_doc=$cod_cab_ref;
				$boton_desah=" disabled='disabled' ";
				}
					
				$strSQL="select * from series where tienda='".$tienda."' and producto='".$producto."' and ingreso='".$temp_doc."'";
				//echo $strSQL;
				
				$resultado=mysql_query($strSQL,$cn);
				while($row=mysql_fetch_array($resultado)){
					$_SESSION['seriesprod'][0][]=str_replace("||","'",$row['serie']);
					$_SESSION['seriesprod'][1][]=formatofecha($row['fvenc']);
					$_SESSION['seriesprod'][2][]=$row['producto'];
				}
					
			}
			
				//if($cod_cab_ref!=''){
				
				
			
				//}	
			
			
		
				foreach ($_SESSION['seriesprod'][2] as $subkey=> $subvalue) {
							  
				  if($_SESSION['seriesprod'][2][$subkey]==$producto){ 
				  $_SESSION['temp_series2'][0][]=$_SESSION['seriesprod'][0][$subkey];
				  $_SESSION['temp_series2'][1][]=$_SESSION['seriesprod'][1][$subkey];
				  $_SESSION['temp_series2'][2][]=$_SESSION['seriesprod'][2][$subkey];
				  
				  }
				  
				}
				$cantidad=count($_SESSION['temp_series2'][2]);
		  
  	}else{
	  $producto=$_REQUEST['producto'];
	  $fechaemi=$_REQUEST['fecha'];
	  $cantidad=$_REQUEST['cant'];
	}
	
	  
	  $strSQL="select * from producto where idproducto='".$producto."'";
	  $resultado=mysql_query($strSQL,$cn);
	  $row=mysql_fetch_array($resultado);
	  
	  $nom_prod=$row['nombre'];
	  $codigo_prod=$row['idproducto'];
	  $garantia=$row['garantia'];
  
 // echo suma_fecha($fecha);
      
	   $fecha = new Fecha();
	   $fecha->Fecha(date('Y'),date('m'),date('d'),'00','00','00');
	   $fecha->SumaTiempo('0',$garantia,'0','0','0','0');
	   $fvenc=$fecha->getFecha();
  // echo substr($fvenc,0,10);
	
	
  
  
?><style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>

<form id="form_series" name="form_series" method="post" action="">
  <table width="477" border="0" cellpadding="0" cellspacing="0">

    <tr>
      <td width="4" >&nbsp;</td>
      <td width="453"><table width="431" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="299"><span class="Estilo1" style="font-size:10px">Producto: </span>&nbsp;&nbsp;<span style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#0066FF; font:bold"><?php echo $nom_prod; ?>
              <input type="hidden" name="temp_fvenserie" id="temp_fvenserie" value="<?php echo substr($fvenc,0,10) ?>" />
            </span><span style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#0066FF; font:bold">
            <input type="hidden" name="accion_serie" id="accion_serie" value="<?php echo $accion ?>" />
            </span><br>
			<span class="Estilo1" style="font-size:10px">C&oacute;digo: </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#0066FF; font:bold"><?php echo  $codigo_prod; ?></span>			<span style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#0066FF; font:bold">
			<input type="hidden" name="codprod2" id="codprod2" value="<?php echo $codigo_prod ?>" />
			</span></td>
            <td width="132" align="right" style="font:Verdana, Arial, Helvetica, sans-serif; font-size:10px "><a style="text-decoration:underline; cursor:pointer" onclick="cambiar_fecha()">Cambiar Fecha</a> </td>
          </tr>
          <tr>
            <td colspan="2"><div style="height:200px; overflow-y:scroll">
                <table width="427" border="0" cellpadding="0" cellspacing="1">
                  <tr style="background-image:url(../imagenes/bg_contentbase2.gif); background-position:100% 40%">
                    <td width="80" height="19">&nbsp;</td>
                    <td width="184" align="center" style="color:#FFFFFF; font-size:11px; font-family:Arial, Helvetica, sans-serif"><strong>Nro. de Serie </strong></td>
                    <td width="159" align="center" style="color:#FFFFFF; font-size:11px; font-family:Arial, Helvetica, sans-serif"><strong>F. Vencimiento</strong> </td>
                  </tr>
                  <tr>
                    <td width="80"  bgcolor="#FFFFFF"></td>
                    <td width="184" align="center" bgcolor="#FFFFFF" style="color:#FFFFFF; font-size:11px; font-family:Arial, Helvetica, sans-serif"></td>
                    <td width="159" align="center" bgcolor="#FFFFFF" style="color:#FFFFFF; font-size:11px; font-family:Arial, Helvetica, sans-serif">
					<div  id="cambiar_fecha" style="display:none">
					  <select name="dia">
                        <?php 
					  $i=1;
					  while($i<31){
					  ?>
                        <option value="<?php echo str_pad($i,2,"0",STR_PAD_LEFT)?>"><?php echo str_pad($i,2,"0",STR_PAD_LEFT)?></option>
                        <?php 
					  $i++;
					  }
					  ?>
                      </select>
                      <select name="mes">
                        <?php 
					  $i=1;
					  while($i<13){
					  ?>
                        <option value="<?php echo str_pad($i,2,"0",STR_PAD_LEFT)?>"><?php echo str_pad($i,2,"0",STR_PAD_LEFT)?></option>
                        <?php 
					  $i++;
					  }
					  ?>
                      </select>
                      <select name="anio">
                        <?php 
					  $i=2000;
					  while($i<2020){
					  ?>
                        <option value="<?php echo str_pad($i,2,"0",STR_PAD_LEFT)?>"><?php echo str_pad($i,2,"0",STR_PAD_LEFT)?></option>
                        <?php 
					  $i++;
					  }
					  ?>
                      </select>
					</div>
					
					</td>
                  </tr>
                  <?php 
				
		for($i=1;$i<=$cantidad;$i++){
		
		$tepmSer=caracteres((str_replace("’","&#8217;",$_SESSION['temp_series2'][0][$i-1])));
		?>
                  <tr>
                    <td align="center" bgcolor="#FFFFFF" ><span class="Estilo1">Item <?php echo $i?> </span></td>
                    <td align="center" bgcolor="#FFFFFF"><input <?php echo $boton_desah ?>  onblur="llenar_fvenc(this);" type="text" name="nroserie[]" id="nroserie" onkeyup="llenar_fecha(this,event)" value="<?php echo $tepmSer;?>" /></td>
                    <td align="center" bgcolor="#FFFFFF"><input readonly="readonly" name="fvenserie[]" id="fvenserie" type="text" size="10" maxlength="10" value="<?php echo $_SESSION['temp_series2'][1][$i-1]?>" />                    </td>
                  </tr>
        <?php 
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
      <td align="center">
	  <?php if($estado_doc=='CONSULTA'){ ?>
	  <input disabled="disabled" onclick="save_serie_edit(); " onmouseover="cambiar_fondo(this,'e')" onmouseout="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; background-repeat:no-repeat; vertical-align:top;background-image:url(../imagenes/boton_aplicar.gif) ; cursor:pointer" type="button" name="Submit" value="Guardar" />
	  <?php }else{?>
	  <input <?php echo $boton_desah ?> onclick="aceptar_serie(); " onmouseover="cambiar_fondo(this,'e')" onmouseout="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(../imagenes/boton_aplicar.gif) ; cursor:pointer" type="button" name="Submit" value="Aceptar" />	  
	  
	  <?php }?>
	  
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
             <input onclick="Modalbox.hide(); return false;" onmouseover="cambiar_fondo(this,'e')" onmouseout="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(../imagenes/boton_aplicar.gif) ; cursor:pointer" type="button" name="Submit" value="Cancelar" />
      </td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>

<?php

if($cod_cab_ref!=''){
				unset($_SESSION['seriesprod'][0]);
				unset($_SESSION['seriesprod'][1]);
				unset($_SESSION['seriesprod'][2]);
}

?>

