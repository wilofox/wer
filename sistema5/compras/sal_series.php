<?php 
  session_start();
  include('../conex_inicial.php');
  include('../funciones/funciones.php');
  
  $accion=$_REQUEST['accion']; 
  $producto=$_REQUEST['producto'];
  $fechaemi=$_REQUEST['fecha'];
  $cantidad=$_REQUEST['cant'];
  $tienda=$_REQUEST['tienda'];
  $cab_doc=$_REQUEST['cab_doc'];
  $tipo_mov=$_REQUEST['tipo_mov'];
  $kardex_doc=$_REQUEST['kardex_doc'];
 // $estado_doc=$_REQUEST['estado_doc'];
  
    
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
  
  $disable="";
  $evento=" onkeydown='buscar_serie(this,event)' ";
  
  if($estado_doc=='CONSULTA'){
  $disable=" disabled='disabled' ";
  $evento=" ";	
  }
  
  
  
  if(isset($_REQUEST['ptoventa'])){
  
  $background1="url(imagenes/bg_contentbase2.gif)";
  $background2="url(imagenes/boton_aplicar.gif)";
  
  }else{
  
  $background1="url(../imagenes/bg_contentbase2.gif)";
  $background2="url(../imagenes/boton_aplicar.gif)";
  }
  
  //print_r($_SESSION['seriesprod'][0]);
  //echo "<br>";
  //print_r($_SESSION['seriesprod'][2]);
  
?>
<style type="text/css">
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
                <td width="180"><input autocomplete="off" <?php echo $evento ?>    name="scanner" type="text" id="scanner" size="30" maxlength="250" /></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td colspan="4"><div style="height:200px; overflow-y:scroll">
			
                <table id="tbl_series" width="427" border="0" cellpadding="0" cellspacing="1">
                  <tr style="background-image:<?php echo $background1?>; background-position:100% 45%">
                    <td width="51" height="19">&nbsp;</td>
                    <td width="201" align="center" style="color:#FFFFFF; font-size:11px; font-family:Arial, Helvetica, sans-serif"><strong>Nro. de Serie </strong></td>
                    <td width="85" align="center" style="color:#FFFFFF; font-size:11px; font-family:Arial, Helvetica, sans-serif"><strong>F. Ingreso. </strong></td>
                    <td width="85" align="center" style="color:#FFFFFF; font-size:11px; font-family:Arial, Helvetica, sans-serif"><strong>F. Venc. Garant&iacute;a</strong></td>
                  </tr>
                
                  <?php 
				  
	 $estado_doc=$_REQUEST['estado_doc'];
	 $cod_cab_ref=$_REQUEST['cod_cab_ref'];
	 
	if($estado_doc!='CONSULTA' && $estado_doc!='ANULADO' && $cod_cab_ref==''){
	
			//echo "cc";									
				$strSQL="select * from series where tienda='".$tienda."' and producto='".$codigo_prod."' and (salida='' || salida=0 || salida='".$_REQUEST['codcabOE']."') ";
				
				//echo $strSQL;
				$resultado=mysql_query($strSQL,$cn);
				//$i=0;
				while($row=mysql_fetch_array($resultado)){
				
			//	$_SESSION['seriep'][0][]=$row['serie'];
				//echo "<input type='text' name='nroserie[]' id='nroserie'  value='".$_SESSION['seriep'][0][$i]."' /><br>";
				//$i++;
				$temporal="N";
						$bgcolor="#FFFFFF";
						$checkbox=" ";
					
					if($accion=='editar'){	
					
						foreach ($_SESSION['seriesprod'][0] as $subkey=> $subvalue) {
						 //echo "<input type='text' name='nroserie[]' id='nroserie'  value='".$subvalue."' /><br>"; 
						// echo caracteres($subvalue)."==".caracteres($row['serie'])."<br>";
							if(caracteres($subvalue)==caracteres($row['serie'])){
							$bgcolor="#fff1bb";
							$checkbox=" checked='checked' ";
							
								if($row['estado']=='V' && caracteres($subvalue)!=caracteres($row['serie'])){
								$temporal="S";
								}
							
							}
											
							
						}
					}else{
						
						if(isset($_SESSION['seriesprod'][0])){
							foreach ($_SESSION['seriesprod'][0] as $subkey=> $subvalue) {
								if(caracteres($subvalue)==caracteres($row['serie']) || $row['estado']=='V'){
								$temporal="S";
								}
							}
						}
					}
					
				
					
					if($temporal=='N'){
					$tepmSer=caracteres((str_replace("’","&#8217;",$row['serie'])));
											
				  ?>
                  <tr onClick="entradae(this)"  style="background:<?php echo $bgcolor ?>" >
                    <td height="20"  align="center"  >
					<input <?php echo $checkbox ?>  style="border:none; background:none" type="checkbox" name="checkbox" value="checkbox" onclick="this.checked=false"  />
					</td>
                    <td align="center">
					<span style="color:#000000">
					<input type="text" style="background:none; border:none" value="<?php echo strtoupper($tepmSer); ?>" size="30" />
					</span>
					</td>
                    <td align="center">
					<span style="color:#000000"><?php echo extraefecha($row['fing']);//$garantia." meses" ?></span></td>
                    <td align="center">
					<span style="color:#000000"><?php echo extraefecha($row['fvenc']);//$garantia." meses" ?></span></td>
                  </tr>
                  <?php 
				  
				  	}
			}//final While
		
		
	}else{
	
		//echo $kardex_doc." ";
		if($kardex_doc=='I'){
		$kardex_doc=1;
		}else{
		$kardex_doc=2;
		}
		
//		echo $tipo_mov." ".$kardex_doc;
		
		
		
		//echo $tipo_mov." ".$kardex_doc;
		if($cod_cab_ref==''){
			$desah=" disabled='disabled' ";
			$cod_cab_ref=$cab_doc;
		}else{
			if($tipo_mov!=$kardex_doc){
			$desah="   ";
			$desah2=" onClick='entradae(this)' ";
			}else{
			//echo "dsf";
			$desah=" disabled='disabled' ";
			
				
			}
			
		}
		
				$strSQL="select kardex from cab_mov where cod_cab='".$cod_cab_ref."' ";
				$resultado=mysql_query($strSQL,$cn);
				$row=mysql_fetch_array($resultado);
				$kardex_origen=$row['kardex'];
				//echo $kardex_origen;
		
		
		if($kardex_origen=='S'){
		
//		echo $tipo_mov;
		
		if($tipo_mov=='1'){
		  
		  if($estado_doc=='CONSULTA'){
		   $filtro=" and salida='".$cod_cab_ref."' ";
		  }else{
		  $filtro=" and ingreso='".$cod_cab_ref."'  and exists(select * from series where  producto='".$producto."' and (salida='0' or salida='') and serie=se) ";
		  }
		  
		}else{
			
		  if($estado_doc=='CONSULTA'){
		  	//	echo 
		  		if($tipo_mov==$kardex_doc){
					 $filtro=" and salida='".$cod_cab_ref."' ";
				}else{
		     		$filtro=" and ingreso='".$cod_cab_ref."' ";
			 	}
		  }else{
		   $filtro=" and salida='".$cod_cab_ref."' ";
		  }
		  
		  
		}
		
		}else{
		$filtro=" and tienda='".$tienda."' and (salida='' or salida=0) and estado='F' ";
		$desah="  ";
		$desah2=" onClick='entradae(this)' ";
		}
	
		$strSQL="select *,serie as se from series where producto='".$producto."' ".$filtro." ";
		$resultado=mysql_query($strSQL,$cn);
		
		//echo $strSQL;
		while($row=mysql_fetch_array($resultado)){
	
			$bgcolor="";
			$checkbox=" ";
		
		 if(isset($_SESSION['seriesprod'][0])){					
			
			foreach ($_SESSION['seriesprod'][0] as $subkey=> $subvalue) {	
			//echo str_replace("||","'",caracteres($subvalue))."==".str_replace("||","'",caracteres($row['serie']));
				if(caracteres($subvalue)==caracteres($row['serie'])){
					$bgcolor="#fff1bb";
					$checkbox=" checked='checked' ";
							
				}//if
			
			}//for		
		 }
		 
		$tepmSer=caracteres((str_replace("’","&#8217;",$row['serie'])));
				 		
		?>
					
							
					<tr style="background:<?php echo $bgcolor ?>" <?php echo $desah2 ?> >
						<td height="20"  align="center"  >
						<input <?php echo $checkbox ?> <?php echo $desah ?>  style="border:none; background:none" type="checkbox" name="checkbox" value="checkbox" /></td>
						<td align="center"><span style="color:#000000">
						<input type="text" style="background:none; border:none" value="<?php echo strtoupper($tepmSer); ?>" size="30" />
						</span></td>
						<td align="center"><span style="color:#000000"><?php echo extraefecha($row['fing']);//$garantia." meses" ?></span></td>
					    <td align="center"><span style="color:#000000"><?php echo extraefecha($row['fvenc']) //$garantia." meses" ?></span></td>
					</tr>	
				
				
			<?php
			
				
			
		}//while	 
			
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
      <td align="center"><input <?php echo $disable ?>  onclick="aceptar_sal_serie(); " onmouseover="cambiar_fondo(this,'e')" onmouseout="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:<?php echo $background2;?> ; cursor:pointer" type="button" name="Submit" value="Aceptar" />
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
             <input onclick="Modalbox.hide(); return false;" onmouseover="cambiar_fondo(this,'e')" onmouseout="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:<?php echo $background2?> ; cursor:pointer" type="button" name="Submit" value="Cancelar" />
      </td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
