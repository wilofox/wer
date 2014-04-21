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
		<?php 
		if(isset($_REQUEST["buscar"])){
				
		?>

			<table id="tbl_series" width="427" border="0" cellpadding="0" cellspacing="1">
							  <tr style="background-image:<?php echo $background1?>; background-position:100% 45%">
								<td width="51" height="19">&nbsp;</td>
								<td width="89" align="center" style="color:#FFFFFF; font-size:11px; font-family:Arial, Helvetica, sans-serif"><strong>Codigo</strong></td>
								<td width="283" align="center" style="color:#FFFFFF; font-size:11px; font-family:Arial, Helvetica, sans-serif"><strong>Producto</strong></td>
							  </tr>
							
							  <?php 
							  
						 $agrupado=$_REQUEST['agrupado'];
						 
	 
			//echo "cc";									
				$strSQL="select * from producto p , clasificacion c where p.clasificacion=c.idclasificacion and c.agrupado='".$agrupado."' and (p.nombre like '%".$_REQUEST['valor']."%' or p.idproducto like '%".$_REQUEST['valor']."%') order by p.nombre limit 100";
				
				//echo $strSQL;
				$resultado=mysql_query($strSQL,$cn);
				//$i=0;
				while($row=mysql_fetch_array($resultado)){
				
			
						$bgcolor="#FFFFFF";					
				  ?>
                  <tr onClick="entradae(this)"  style="background:<?php echo $bgcolor ?>" >
                    <td height="20"  align="center"  >
					<input <?php echo $checkbox ?>  style="border:none; background:none" type="checkbox" name="checkbox" id="checkbox" value="<?php echo $row['idproducto']?>" onclick="this.checked=false"  />					</td>
                    <td align="center"><?php echo $row['idproducto']?></td>
                    <td align="left"><?php echo $row['nombre']?></td>
                  </tr>
                  <?php 
				  
				  	
			    }//final While
				?>
                </table>
		<?php 
		die();
		}
		
		?>		
				

<form id="form_series" name="form_series" method="post" action="">
  <table width="477" border="0" cellpadding="0" cellspacing="0">

    <tr>
      <td width="4" >&nbsp;</td>
      <td width="453"><table width="446" border="0" cellpadding="0" cellspacing="0">
          
          <tr>
            <td width="425"><table width="233" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="53" height="26" style="font:Arial, Helvetica, sans-serif; font-size:10px; color:#000000"><strong>Busqueda</strong></td>
                <td width="180"><input autocomplete="off"  onkeyup="buscarProd(this)"   name="scanner" type="text" id="scanner" size="30" maxlength="250" /></td>
                </tr>
            </table>
            <input type="hidden" name="tipoMat" id="tipoMat" value="<?php echo $_REQUEST['tipoMat']?>" />
			<input type="hidden" name="agrupado" id="agrupado" value="<?php echo $_REQUEST['agrupado']?>" />
			</td>
            <td width="21" align="center" ></td>
          </tr>
          <tr>
            <td colspan="2">
			
			<div style="height:200px; overflow-y:scroll" id="listaProd">
			
                <table id="tbl_series" width="427" border="0" cellpadding="0" cellspacing="1">
                  <tr style="background-image:<?php echo $background1?>; background-position:100% 45%">
                    <td width="51" height="19">&nbsp;</td>
                    <td width="89" align="center" style="color:#FFFFFF; font-size:11px; font-family:Arial, Helvetica, sans-serif"><strong>Codigo</strong></td>
                    <td width="283" align="center" style="color:#FFFFFF; font-size:11px; font-family:Arial, Helvetica, sans-serif"><strong>Producto</strong></td>
                  </tr>
                
                  <?php 
				  
			 $agrupado=$_REQUEST['agrupado'];
	 
	 
	
	
			//echo "cc";									
				$strSQL="select * from producto p , clasificacion c where p.clasificacion=c.idclasificacion and c.agrupado='".$agrupado."'  order by p.nombre limit 100";
				
				//echo $strSQL;
				$resultado=mysql_query($strSQL,$cn);
				//$i=0;
				while($row=mysql_fetch_array($resultado)){
				
			
						$bgcolor="#FFFFFF";					
				  ?>
                  <tr onClick="entradae(this)"  style="background:<?php echo $bgcolor ?>" >
                    <td height="20"  align="center"  >
					<input <?php echo $checkbox ?>  style="border:none; background:none" type="checkbox" name="checkbox" id="checkbox" value="<?php echo $row['idproducto']?>" onclick="this.checked=false"  />					</td>
                    <td align="center"><?php echo $row['idproducto']?></td>
                    <td align="left"><?php echo $row['nombre']?></td>
                  </tr>
                  <?php 
				  
				  	
			    }//final While
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
      <td align="center"><input <?php echo $disable ?>  onclick="aceptarMP(); " onmouseover="cambiar_fondo(this,'e')" onmouseout="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:<?php echo $background2;?> ; cursor:pointer" type="button" name="Submit" value="Aceptar" />
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
