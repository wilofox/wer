<?php 
  session_start();
  include('../conex_inicial.php');
  include('../funciones/funciones.php');
	$peticion=$_REQUEST['peticion'];
    $valor=$_REQUEST['valor'];
	$tienda=$_REQUEST['tienda'];
	$documento=$_REQUEST['documento'];
	
switch($peticion){
	case "listarOE":
  
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
            <td width="301"><table width="357" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="26" style="font:Arial, Helvetica, sans-serif; font-size:10px; color:#000000">Doc.</td>
                <td>
				
				
				<?php 
				$strSQL="select * from operacion where substr(p1,24,1)='S'";
				//echo $strSQL;
				$resultado=mysql_query($strSQL,$cn);
				?>
				<select name="documento" id="documento" onchange="buscar_obs(this,event)">
				<?php 
				
				while($row=mysql_fetch_array($resultado)){
					if($row['codigo']=='OE'){
				?>
				  <option selected value="<?php echo $row['codigo']."-".substr($row['p1'],9,1)?>"><?php echo $row['descripcion']?></option>
				<?php 		
					}else{
				?>
				  <option value="<?php echo $row['codigo']."-".substr($row['p1'],10,1)?>"><?php echo $row['descripcion']?></option>
				<?php 
					}
				}
				?>
                </select>
                </td>
              </tr>
              <tr>
                <td width="46" height="26" style="font:Arial, Helvetica, sans-serif; font-size:10px; color:#000000"><strong>Buscar&nbsp; </strong></td>
                <td width="311"><input  autocomplete="off"  onkeyup="buscar_obs(this,event)"  name="scanner" type="text" id="scanner" size="50" maxlength="250" />                 </td>
                </tr>
            </table></td>
            <td align="center" >		    						</td>
          </tr>
          <tr>
            <td colspan="2">
			
                <table id="tbl_series" width="427" border="0" cellpadding="0" cellspacing="1">
                  <tr style="background-image:url(imagenes/bg_contentbase2.gif); background-position:100% 40%">
                    <td width="51" height="19">&nbsp;</td>
                    <td width="119" align="center" style="color:#FFFFFF; font-size:11px; font-family:Arial, Helvetica, sans-serif"><strong>Nro. de Doc. </strong></td>
                    <td width="151" align="center" style="color:#FFFFFF; font-size:11px; font-family:Arial, Helvetica, sans-serif"><strong>Descripci&oacute;n</strong> </td>
                    <td width="101" align="center" style="color:#FFFFFF; font-size:11px; font-family:Arial, Helvetica, sans-serif"><strong>Fecha</strong></td>
                  </tr>

                  <tr  >
                    <td height="20" colspan="4">
					<div style="height:200px; width:420px;overflow-y:scroll" id="tblListaOE">
					<table  width="408" border="0" cellpadding="0" cellspacing="1">
					<?php 
				$strSQL="select * from cab_mov where cod_ope='OE' and tipo='2' and estadoOT!='V' and flag!='A' and tienda='".$tienda."'";
				//echo $strSQL;
				//	print_r($_SESSION['seriesprod'][0]);
				$resultado=mysql_query($strSQL,$cn);
				while($row=mysql_fetch_array($resultado)){
						$numeroDoc=$row['serie']."-".$row['Num_doc'];
						$descripcion=$row['obs1'];
						$fecha=$row['fecha'];
														
					 ?>
					  <tr onClick="entradae2(this)" bgcolor="#FFFFFF"  style="background:#FFFFFF">
						<td width="52" align="center"><input style="border:none; background:none" type="radio" name="checkbox" id="checkbox" value="<?php echo $row['cod_cab']?>" /></td>
						<td width="120" align="center"><span style="color:#000000"><?php echo $numeroDoc; ?></span></td>
						<td width="152" align="center"><span style="color:#000000"><?php echo $descripcion ?></span></td>
						<td width="84" align="center"><?php echo substr($fecha,0,10); ?></td>
					  </tr>
					<?php 
				   		}
					?>
					</table></div></td>
                  </tr>
                </table>
            </td>
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
      <td align="center"><input onclick="aceptar_OE(); " onmouseover="cambiar_fondo(this,'e')" onmouseout="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(imagenes/boton_aplicar.gif) ; cursor:pointer" type="button" name="Submit" value="Aceptar" />
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
<?php 
break;

case "buscarOE":
?>

<table  width="408" border="0" cellpadding="0" cellspacing="1">
					<?php 
				$strSQL="select * from cab_mov where cod_ope='".$documento."' and tipo='2' and obs1 like '%".$valor."%' and estadoOT!='V' and flag!='A' and tienda='".$tienda."' ";
				//	print_r($_SESSION['seriesprod'][0]);
				//echo $strSQL;
				$resultado=mysql_query($strSQL,$cn);
				while($row=mysql_fetch_array($resultado)){
						$numeroDoc=$row['serie']."-".$row['Num_doc'];
						$descripcion=$row['obs1'];
						$fecha=$row['fecha'];
														
					 ?>
					  <tr onClick="entradae2(this)" bgcolor="#FFFFFF"  style="background:#FFFFFF">
						<td width="52" align="center"><input style="border:none; background:none" type="radio" name="checkbox" value="<?php echo $row['cod_cab']?>" /></td>
						<td width="120" align="center"><span style="color:#000000"><?php echo $numeroDoc; ?></span></td>
						<td width="152" align="center"><span style="color:#000000"><?php echo $descripcion ?></span></td>
						<td width="84" align="center"><?php echo substr($fecha,0,10); ?></td>
					  </tr>
					<?php 
				   		}
					?>
					</table>

<?php 
break;

case "pasarOE":
				
				
					unset($_SESSION['seriesprod']);
					unset($_SESSION['seriesprod2']);
					unset($_SESSION['temp_series']);
					
					unset($_SESSION['productos']);
					unset($_SESSION['productos2']);
					unset($_SESSION['productos3']);

				$strSQL3="select * from det_mov where cod_cab='".$_REQUEST['codcab']."' ";
				//echo $strSQL3;
				$resultado3=mysql_query($strSQL3,$cn);
				while($row3=mysql_fetch_array($resultado3)){
					
					if($row3['cod_prod']!='TEXTO'){
					//echo "dddd";
					$_SESSION['productos'][0][] = $row3['cod_prod'];
					$_SESSION['productos'][1][] = $row3['cantidad'];	
					$_SESSION['productos'][2][] = $row3['precio'];
					$_SESSION['productos'][3][] = $row3['notas'];	
					$_SESSION['productos'][4][] = $row3['unidad'];	
					
					$_SESSION['productos'][7][] = $row3['ancho'];	
					$_SESSION['productos'][8][] = $row3['largo'];	
					$_SESSION['productos'][9][] = $row3['mt2'];	
					$_SESSION['productos'][10][] = $row3['factor'];	
					$_SESSION['productos'][13][] = "";	
					$_SESSION['productos'][14][]= "";	
					$_SESSION['productos'][20][]= count($_SESSION['productos'][20])+1;	
					
					$strSQL005="select * from series where producto='".$row3['cod_prod']."' and salida='".$_REQUEST['codcab']."'";
					$resultado005=mysql_query($strSQL005,$cn);
					
					while($row005=mysql_fetch_array($resultado005)){	
						  $_SESSION['seriesprod'][0][]=$row005['serie'];
						  $_SESSION['seriesprod'][1][]=$fvenc;
						  $_SESSION['seriesprod'][2][]=$row3['cod_prod'];
						  $tserie=S;
					}
					
						if($cadena14!=''){
						$strSQL005="select * from series where producto='".$row3['cod_prod']."' ".$filtro2;
						$resultado005=mysql_query($strSQL005,$cn);
						
							while($row005=mysql_fetch_array($resultado005)){	
							  $_SESSION['seriesprod'][0][]=$row005['serie'];
							  $_SESSION['seriesprod'][1][]=$fvenc;
							  $_SESSION['seriesprod'][2][]=$row3['cod_prod'];
							  $tserie=S;
							}		
						}
					}else{
					$_SESSION['productos'][0][] = "";
					//$_SESSION['productos'][1][] = "";
					$_SESSION['productos'][1][] = $row3['cantidad'];	
					$_SESSION['productos'][2][] = $row3['precio'];
					$_SESSION['productos'][3][] = $row3['notas'];	
					$_SESSION['productos'][4][] = $row3['unidad'];
					$_SESSION['productos'][13][] = $row3['nom_prod'];	
					$_SESSION['productos'][14][]=$row3['prodpase'];
					$_SESSION['productos'][20][]= count($_SESSION['productos'][20])+1;	
					}
					
			    }


break;

}

?>