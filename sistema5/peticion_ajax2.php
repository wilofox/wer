<?php 
session_start();
include_once('conex_inicial.php');
include('funciones/funciones.php');
include('administracion/miclase.php');

$clase= new miclase('s');

$peticion=$_REQUEST['peticion'];
$tipo=$_REQUEST['tipo'];


//echo $peticion;
switch($peticion){
	case "kardex_prod":
		
		$codigo=$_REQUEST['codigo'];	
	    $strSQL="select cod_det from det_mov where cod_prod='".$codigo."'";
		$resultado=mysql_query($strSQL,$cn);
		$cont=mysql_num_rows($resultado);
		
	echo $cont;
	break;
	/*case "kardex_prod":
		
		$codigo=$_REQUEST['codigo'];	
	    $strSQL="select cod_det from det_mov where cod_prod='".$codigo."'";
		$resultado=mysql_query($strSQL,$cn);
		$cont=mysql_num_rows($resultado);
		
	echo $cont;
	break;
	*/
	case "filtrar_clientes":
		 ?>
		 <table id="lista_aux" width="472" border="0" cellpadding="0" cellspacing="1">
        <?php  
	//echo "sdg";
	$valor=$_REQUEST['valor'];
	//-------------------------------------------
	
  $resultados = mysql_query("select * from cliente where  (tipo_aux='C' or tipo_aux='A')  and (razonsocial like '%$valor%' or razonsocial like '$valor%' or ruc like '%$valor%' or doc_iden like '%$valor%') order by razonsocial limit 10 ",$cn);
			 // echo "select * from cliente where  tipo_aux='C' and razonsocial like '%$valor%' order by codcliente limit 10 ";
$i=0;	  
while($row=mysql_fetch_array($resultados))
{

if($i%2==0){
$bgcolor=" bgcolor='#F9F9F9' ";
}else{
$bgcolor=" bgcolor='#FFFFFF' ";
}
 ?>
        <tr bordercolor="#CCCCCC"  <?php echo $bgcolor?> onClick="entrada(this)">
          <td width="37" align="center"><input  style="border:none; background:none" name="xaux" type="radio"  value="<?php echo $row['codcliente']?>" /></td>
          <td width="51"><span class="Estilo12"><?php echo $row['codcliente'];?></span></td>
          <td width="265"><span class="Estilo12"><?php echo $row['razonsocial'];?></span></td>
          <td width="55"><span class="Estilo12"><?php echo $row['ruc'];?></span></td>
          <td width="58"><span class="Estilo12"><?php echo $row['doc_iden'];?></span></td>
		  <td width="1" height="1" style=" font-size:1px; color:#FFFFFF;"><span><?php echo $row['direccion'];?></span></td>
		  <td width="1" height="1" style=" font-size:1px; color:#FFFFFF; display:none"><span><?php echo $row['t_persona'];?></span></td>
          </tr>
        <?php  
 
 $i++; 
  }
  mysql_free_result($resultados);
  
  ?>
      </table>
		
<?php 	
	break;
	
	case "buscar_cliente":
	$ruc=$_REQUEST['ruc'];
	$strSQl="select * from cliente where ruc='".$ruc."' ";
	$resultado=mysql_query($strSQl,$cn);
	$row=mysql_fetch_array($resultado);
	$cont=mysql_num_rows($resultado);
	$cadena=$row['codcliente']."?".$row['razonsocial']."?".$row['ruc']."?".$row['direccion']."?".$row['t_persona']."?";
	
	echo $cadena;
	break;
	
	
	case "mostrar_chofer":
	
	
	
	   $tabla=$_REQUEST['tabla'];	
	   	
		if($tabla=='A'){
		   		$strSQL="select * from cliente where tipo_aux='C' and baja='N' order by razonsocial";
				$campo1="codcliente";
				$campo2="razonsocial";
				$campo3="ruc";       $etiqueta3="Ruc";
				$campo4="doc_iden";  $etiqueta4="Dni";
				$campo5="direccion";
				
				$titulo=" Clientes ";
		
		}else{	
			if($tabla=='C'){
				$strSQL="select * from chofer order by nombre";
				$campo1="cod";
				$campo2="nombre";
				$campo3="dni";       $etiqueta3="Dni";
				$campo4="licencia";  $etiqueta4="Licencia";
				
				$titulo=" Choferes ";
			}else{
				if($tabla=='P'){
					$strSQL="select * from producto order by nombre";
					$campo1="idproducto";
					$campo2="nombre";
					$campo3="und";       					 $etiqueta3="Und";
					$campo4="saldo".$_REQUEST['tienda'];     $etiqueta4="Stock";
					$campo5="saldo".$_REQUEST['tienda'];
					
					$titulo=" Productos ";
				}else{
					if($tabla=='AC'){
					$strSQL="select * from areacosto order by nombre";
					$campo1="id";
					$campo2="nombre";
					$campo3="und";       					 $etiqueta3=" ";
					$campo4="saldo".$_REQUEST['id'];    	 $etiqueta4=" ";
					$campo5="saldo".$_REQUEST['nombre'];
					
					$titulo=" Area Costo ";
					}else{
					    if($tabla=='prov'){
							$strSQL="select * from cliente where tipo_aux='P' ".$filtro6."  order by razonsocial";
							$campo1="codcliente";
							$campo2="razonsocial";
							$campo3="ruc";       					 $etiqueta3=" ";
							//$campo4="saldo".$_REQUEST['id'];    	 $etiqueta4=" ";
							//$campo5="saldo".$_REQUEST['nombre'];
							
							$titulo=" Area Costo ";
							}else{
					
							$strSQL="select * from transportista order by nombre";
							$campo1="id";
							$campo2="nombre";
							$campo3="ruc";       $etiqueta3="Ruc";
							$campo4="placa";     $etiqueta4="Placa";
							
							$titulo=" Transportistas ";
						}	}
				}	
			}
			
			
				
		}
	
	
	 ?>
	 
	 <table width="456" height="251" border="0" cellpadding="0" cellspacing="0" style="border:#8BB1F8 solid 1px; background:#E3F4F9;">
  <tr style="background:url(../imagenes/aqua-hd-bg.gif)">
    <td height="23" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000">&nbsp;</td>
    <td height="23" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000"><strong>Lista de <?php echo $titulo;?> 
      <input name="transpChofer" id="transpChofer" type="hidden" size="8" maxlength="5" value="<?php echo $tabla?>" />
    </strong></td>
    <td width="16" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000" onclick="salir();">
	
	<font face="Arial, Helvetica, sans-serif" style="text-decoration:underline; font-size:11px; cursor:pointer" color="#0033FF"><strong>x</strong></font
	></td>
  </tr>
  <tr>
    <td width="9" height="207">&nbsp;</td>
    <!--
	
	<div  id="detalle_chofer" style="width:410px; height:150px; overflow-y:scroll">
	-->
    <td width="429" valign="top">
	
	<div  style="z-index:999; cursor:default" onmousemove="javascript:finMovimiento(event);">
	<table width="429" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="429" height="22" style="font:Arial, Helvetica, sans-serif; font-size:10px; color:#000000">B&uacute;squeda
          <input type="text" name="valor_chofer"  id="valor_chofer" onkeyup="busqueda_chofer()"/>          <img src="../imagenes/ico_lupa.png" width="15" height="15" /></td>
        </tr>
   
      <tr>
        <td bgcolor="#F4F4F4">
            <table width="430" border="0" cellpadding="1" cellspacing="1">
              <tr  style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px">
                <td width="40" height="19" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>C&oacute;digo</strong></td>
                <td width="250" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Nombre</strong></td>
                <td width="50" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong><?php echo $etiqueta3 ?></strong></td>
                <td width="80" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong><?php echo $etiqueta4 ?></strong></td>
                <td width="10" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF">&nbsp;</td>
              </tr>
             
              <tr>
                <td colspan="5" align="center" style="border-bottom:#E5E5E5 solid 1px" >
				
					<div  id="detalle_chofer" style="width:435px; height:150px; overflow-y:scroll">
					  <table width="420" border="0" align="left" cellpadding="0" cellspacing="0">
                        <?php 
				$regvis=100;
				$pag=$_REQUEST['pag'];
				
				if($pag>=1) {
				$inicio=($pag-1)*$regvis;
				}else{
				$inicio=0;
				$pag=1;
				}
				$totalreg=mysql_num_rows(mysql_query($strSQL,$cn));
				$resultado = mysql_query($strSQL." limit ".$inicio.",".$regvis,$cn);
				//echo $strSQL." limit ".$inicio.",".$regvis;
			
			//$resultado=mysql_query($strSQL,$cn);
			$i=1;
			while($row=mysql_fetch_array($resultado)){
				
				$bgcolor="#F4F4F4";
				if($i%2==0){
				$bgcolor="#FFFFFF";
				}
			?>
                        <tr bgcolor="<?php echo $bgcolor;?>"  onmouseover="entrada(this)" onmouseout="entrada(this)" >
                          <td height="18" width="40" align="center" style="border-bottom:#E5E5E5 solid 1px" ><?php echo $row[$campo1]?></td>
						  
						  <?php if ($tipo=='modelo'){
						  
						 $tempCampo=$row[$campo3];
						 }else{ 
						 $tempCampo=$row[$campo5];
						 } ?>
                          <td width="250" style="border-bottom:#E5E5E5 solid 1px; color:#333333; "><a href="#" onclick="sel_chofer('<?php echo $row[$campo1]?>','<?php echo htmlspecialchars($row[$campo2]) ?>','<?php echo $tempCampo ?>')"><?php echo htmlspecialchars($row[$campo2])?>&nbsp;</a></td>
                          <td width="50" align="center" style="border-bottom:#E5E5E5 solid 1px" ><?php echo $row[$campo3]?>&nbsp;</td>
                          <td width="80" align="center" style="border-bottom:#E5E5E5 solid 1px"><?php echo $row[$campo4]?>&nbsp;</td>
                        </tr>
                        <?php 
			  $i++;
					  }
			?>
                      </table>
					</div>				</td>
              </tr>
            </table>       </td>
      </tr>
    </table>
	</div>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td ></td>
    <td valign="top">
	<div id="divpagina">
	<?php 
	$clase->paginar($totalreg,$pag,$regvis);
	?>
	</div>
	</td>
    <td>&nbsp;</td>
  </tr>
</table>
	 
	 
	<?php
	
	break;
	
	
	case "buscar_chofer":
	
	
		$tabla=$_REQUEST['tabla'];	
	   	$valor=$_REQUEST['valor'];
		
		if($valor!=""){
		$filtro1=" where nombre like '%$valor%' or  dni like '%$valor%' or licencia like '%$valor%' ";
		$filtro2=" where nombre like '%$valor%' or  ruc like '%$valor%' or placa like '%$valor%' ";
		$filtro3=" and razonsocial like '%$valor%' or  ruc like '%$valor%' or doc_iden like '%$valor%' ";
		$filtro4=" where (nombre like '%$valor%' or  idproducto like '%$valor%') and factorOT='N' ";
		$filtro5=" where nombre like '%$valor%' ";
		$filtro6=" and nombre like '%$valor%' ";
		}else{
		$filtro="";
		}
		
		if($tabla=='A'){
				$strSQL="select * from cliente where tipo_aux='C' ".$filtro3." and baja='N' order by razonsocial";
				$campo1="codcliente";
				$campo2="razonsocial";
				$campo3="ruc";      
				$campo4="doc_iden"; 
				$campo5="direccion"; 
		}else{
			if($tabla=='C'){
				$strSQL="select * from chofer ".$filtro1." order by nombre";
				$campo1="cod";
				$campo2="nombre";
				$campo3="dni";      
				$campo4="licencia"; 
				
	
			}else{
			   if($tabla=='P'){
					$strSQL="select * from producto ".$filtro4." order by nombre";
					$campo1="idproducto";
					$campo2="nombre";
					$campo3="und";       $etiqueta3="Und";
					$campo4="saldo".$_REQUEST['tienda'];     $etiqueta4="Stock";
					$campo5="saldo".$_REQUEST['tienda'];
					
					$titulo=" Productos ";
					
					
					}else{
						if($tabla=='AC'){
						$strSQL="select * from areacosto ".$filtro5." order by nombre";
						$campo1="id";
						$campo2="nombre";
						$campo3="und";       					 $etiqueta3=" ";
						//$campo4="saldo".$_REQUEST['id'];    	 $etiqueta4=" ";
						//$campo5="saldo".$_REQUEST['nombre'];
						
						$titulo=" Area Costo ";
						}else{
						
							if($tabla=='prov'){
							$strSQL="select * from cliente where tipo_aux='P' ".$filtro3." order by razonsocial";
							$campo1="codcliente";
							$campo2="razonsocial";
							$campo3="ruc";       					 $etiqueta3=" ";
							//$campo4="saldo".$_REQUEST['id'];    	 $etiqueta4=" ";
							//$campo5="saldo".$_REQUEST['nombre'];
							
							$titulo=" Area Costo ";
							}else{
								$strSQL="select * from transportista ".$filtro2." order by nombre";
								$campo1="id";
								$campo2="nombre";
								$campo3="ruc";       
								$campo4="placa";    
							}
			   }        }
			}		
		}
	?>
	
	<table width="420" border="0" align="left" cellpadding="0" cellspacing="0" id='tblproductos' >
              
              <?php 
									
				$regvis=100;
				$pag=$_REQUEST['pag'];
				
				if($pag>=1) {
				$inicio=($pag-1)*$regvis;
				}else{
				$inicio=0;
				$pag=1;
				}
				$totalreg=mysql_num_rows(mysql_query($strSQL));
				$resultado = mysql_query($strSQL." limit ".$inicio.",".$regvis,$cn);
			//$resultado=mysql_query($strSQL,$cn);
			//echo $strSQL." limit ".$inicio.",".$regvis;
			$i=1;
			while($row=mysql_fetch_array($resultado)){
				
				$bgcolor="#F4F4F4";
				if($i%2==0){
				$bgcolor="#FFFFFF";
				}
			?>  
			
			 <tr bgcolor="<?php echo $bgcolor;?>"  onmouseover="entrada(this)" onmouseout="entrada(this)" >
                          <td height="18" width="40" align="center" style="border-bottom:#E5E5E5 solid 1px" ><?php echo $row[$campo1]?></td>
                          <td width="250" style="border-bottom:#E5E5E5 solid 1px; color:#333333"><a href="#" onclick="sel_chofer('<?php echo $row[$campo1]?>','<?php echo htmlspecialchars($row[$campo2]) ?>','<?php echo $row[$campo5] ?>')"><?php echo htmlspecialchars($row[$campo2])?>&nbsp;</a></td>
                          <td width="50" align="center" style="border-bottom:#E5E5E5 solid 1px" ><?php echo $row[$campo3]?>&nbsp;</td>
                          <td width="80" align="center" style="border-bottom:#E5E5E5 solid 1px"><?php echo $row[$campo4]?>&nbsp;<a name="ancla<?php echo $i;?>" id="ancla"></a></td>
      </tr>
						
						
              <?php 
			  $i++;
			}
			?>
</table>
	<?php 
	
	
	echo "~";
	$clase->paginar($totalreg,$pag,$regvis);
	
	break;
	
	case "detSalMat":
	//echo $peticion;
	
	if($_REQUEST['accion']=='salir'){
	unset($_SESSION['xitem']);
	unset($_SESSION['xcodprod']);
	unset($_SESSION['xdesprod']);
	unset($_SESSION['xcantidad']);
	////nuevo precio
	unset($_SESSION['xprecio']);
	////nuevo serie_producto
	unset($_SESSION['xserieprod']);
	//break;	
	}
	if($_REQUEST['accion']=='eliminar'){
	unset($_SESSION['xitem'][$_REQUEST['item']]);
	unset($_SESSION['xcodprod'][$_REQUEST['item']-1]);
	unset($_SESSION['xdesprod'][$_REQUEST['item']-1]);
	unset($_SESSION['xcantidad'][$_REQUEST['item']-1]);
	////nuevo precio
	unset($_SESSION['xprecio'][$_REQUEST['item']-1]);
	////nuevo serie_producto
	unset($_SESSION['xserieprod'][$_REQUEST['item']-1]);
	}else{
	
	
	//--------control- de item-------
	
	
	$srtSQL="select * from det_mov where cod_cab='".$_REQUEST['codcab']."' and cod_prod='".$_REQUEST['codprod']."'";
	$resultado=mysql_query($srtSQL,$cn);
	$conta=mysql_num_rows($resultado);
	
	if($conta==0){
	echo "noexiste";
	die();
	}

	//-------------------------------
	
	
	$_SESSION['xitem'][]=count($_SESSION['xcodprod'])+1;
	$_SESSION['xcodprod'][]=$_REQUEST['codprod'];
	$_SESSION['xdesprod'][]=$_REQUEST['desprod'];
	$_SESSION['xcantidad'][]=$_REQUEST['cantidad'];
	$_SESSION['xprecio'][]=$_REQUEST['precio'];
	$_SESSION['xserieprod'][]=$_REQUEST['serie_prod'];
	//echo $_SESSION['xcodprod'][0];
	}
	//print_r($_SESSION['xitem']);
	?>
	
	  <table width="578" border="0" cellpadding="1" cellspacing="1">
          <tr style="background:url(../imagenes/bg_contentbase2.gif); background-position:100 60">
            <td width="74" align="center"><span class="Estilo8">Código</span></td>
            <td width="343"><span class="Estilo8">Descripción</span></td>
            <td width="58" align="center"><span class="Estilo8">Cantidad</span></td>
           <!-- <td width="58" align="center"><span class="Estilo8">Precio</span></td>-->
            <td width="17" align="center" class="Estilo8">A</td>
          </tr>
		  <?php 
		  //print_r($_SESSION['xcodprod']);
		  foreach ($_SESSION['xcodprod'] as $subkey=> $subvalue) {
		  ?>
          <tr>
            <td align="center" bgcolor="#F5F5F5"><?php echo $_SESSION['xcodprod'][$subkey] ?></td>
            <?php if(isset($_REQUEST['serie_prod'])){
				echo "<td align='left' bgcolor='#F5F5F5'>".$_SESSION['xdesprod'][$subkey]."<br>".$_SESSION['xserieprod'][$subkey+1]."</td>";
            }else{
            	echo "<td align='left' bgcolor='#F5F5F5'>".$_SESSION['xdesprod'][$subkey]."</td>";
			}?>
            <td align="center" bgcolor="#F5F5F5"><?php echo $_SESSION['xcantidad'][$subkey] ?></td>
           
		    <!--<td align="center" bgcolor="#F5F5F5"><input type="text" name="pre_det" id="pre_det" onkeyup="Modificar_Precio(event,this)" value="<?php //echo $_SESSION['xprecio'][$subkey] ?>" /></td>-->
			
            <td align="center" bgcolor="#F5F5F5"><a style="cursor:pointer" onclick="eliminar('<?php echo $_SESSION['xitem'][$subkey]?>')"><img src="../imgenes/eliminar.gif" width="14" height="14" /></a></td>
          </tr>
          <?php } ?>
</table>	
	
	<?php
	
	
	break;
	
	
	
	case "lista_transfConta":
	 ?>
	<table width="770" height="65" border="0" cellpadding="0" cellspacing="0">
      <tr style="background:url(imagenes/bg_contentbase2.gif) 100%; color:#FFFFFF">
        <td style="color:#FFFFFF; font-weight:bold; font-size:10px" width="78" height="18" >Nombre</td>
        <td style="color:#FFFFFF; font-weight:bold; font-size:10px" width="64">C. Costo</td>
        <td style="color:#FFFFFF; font-weight:bold; font-size:10px" width="61" >Aplicacion</td>
        <td style="color:#FFFFFF; font-weight:bold; font-size:10px" width="30" >Docs</td>
        <td style="color:#FFFFFF; font-weight:bold; font-size:10px" width="45" >Periodo</td>
        <td style="color:#FFFFFF; font-weight:bold; font-size:10px" width="142" >Fechap</td>
        <td style="color:#FFFFFF; font-weight:bold; font-size:10px"  width="207" >F.creacion</td>
        <td style="color:#FFFFFF; font-weight:bold; font-size:10px" width="100" >Archivo</td>
        <td style="color:#FFFFFF; font-weight:bold; font-size:10px" width="43" >Eliminar</td>
      </tr>
	  <?php 
	  
	  			$regvis=20;
				$pag=$_REQUEST['pag'];
				
				if($pag>=1) {
				$inicio=($pag-1)*$regvis;
				}else{
				$inicio=0;
				$pag=1;
				}
				
				
				if(isset($_REQUEST['eliminar'])){
				
				$strDelete="delete from contafiles where id='".$_REQUEST['id']."'";
				mysql_query($strDelete,$cn);
				
				$file = "contabilidad/transferencias/".$_REQUEST['archivo'];
				$do = unlink($file);
								
				}
				
				$strSQL="select *  from contafiles order by fcreacion desc";
				$totalreg=mysql_num_rows(mysql_query($strSQL,$cn));
				$resultado = mysql_query($strSQL." limit ".$inicio.",".$regvis,$cn);
				//echo $strSQL." limit ".$inicio.",".$regvis;
			
			//$resultado=mysql_query($strSQL,$cn);
			$i=1;
			while($row=mysql_fetch_array($resultado)){
				
				$bgcolor="#F4F4F4";
				if($i%2==0){
				$bgcolor="#FFFFFF";
				}
	  ?>
      <tr bgcolor="<?php echo $bgcolor ?>">
        <td class="borderBajo">&nbsp;<?php echo $row['nombre'] ?></td>
        <td class="borderBajo" align="center">&nbsp;<?php echo $row['cc'] ?></td>
        <td class="borderBajo" align="center">&nbsp;<?php echo $row['aplicacion'] ?></td>
        <td class="borderBajo">&nbsp;<?php echo $row['documentos'] ?></td>
        <td class="borderBajo" align="center">&nbsp;<?php echo $row['periodo'] ?></td>
        <td class="borderBajo">&nbsp;<?php echo substr($row['fechap'],0,10) ?></td>
        <td class="borderBajo">&nbsp;<?php echo $row['fcreacion'] ?></td>
        <td class="borderBajo">&nbsp;<a href="descargarFiles.php?ruta=contabilidad/transferencias/<?php echo $row['archivo'] ?>" target="_blank"><?php echo $row['archivo'] ?></a></td>
        <td align="center" class="borderBajo"><a style="cursor:pointer" onclick="eliminarFiles('<?php echo $row['id']; ?>','<?php echo $row['archivo']?>')" ><img src="imgenes/eliminar.png" width="14" height="14" /></a></td>
      </tr>
	  <?php
	   $i++;
	   }
	   ?>
	  
	   <tr>
        <td colspan="9">		</td>
      </tr>
</table>
	|
	<!--<div id="divpagina">-->
	<?php 
	$clase->paginar($totalreg,$pag,$regvis);
	?>
<!--	</div>-->	
		
	<?php
	break;
	
	case "referenciarPO":
	
					unset($_SESSION['productos'][0]);
				    unset($_SESSION['productos'][1]); 
				    unset($_SESSION['productos'][2]); 
					
					$sucursal=$_REQUEST['sucursal'];
					$doc=$_REQUEST['doc'];
					$serie=$_REQUEST['serie'];
					$numero=$_REQUEST['numero'];
					
					$codCabPO=$_REQUEST['codCabPO'];
													
					//$strSQL="select * from cab_mov where sucursal='$sucursal' and cod_ope='$doc' and serie='$serie' and Num_doc='$numero' ";
					$strSQL="select * from cab_mov where cod_cab='".$codCabPO."'";
					$resultado=mysql_query($strSQL,$cn);
					$row=mysql_fetch_array($resultado);
					$codigo=$row['cod_cab'];
					$cod_clie_ref=$row['cliente'];
					$moneda_doc=$row['moneda'];
					$impto=$row['impto1'];
					
					$strSQL2="select * from cliente where codcliente='$cod_clie_ref' ";
					$resultado2=mysql_query($strSQL2,$cn);
					$row2=mysql_fetch_array($resultado2);
					$des_clie_ref=$row2['razonsocial'];
									
									
					$strSQL3="select * from det_mov where cod_cab='$codigo' ";
					$resultado3=mysql_query($strSQL3,$cn);
					while($row3=mysql_fetch_array($resultado3)){
					  	
					  	if($row3['cod_prod']!='TEXTO'){
					  	$_SESSION['productos'][0][] = $row3['cod_prod'];
					  	$_SESSION['productos'][1][] = $row3['cantidad'];	
					 	$_SESSION['productos'][2][] = $row3['precio'];	
					 	$_SESSION['productos'][5][] = "ref";
						
						/*$strSQL_series="select * from series where producto='".$row3['cod_prod']."' and salida='".$codigo."' ";
						$resultado_series=mysql_query($strSQL_series,$cn);
							while($row_series=mysql_fetch_array($resultado_series)){
							
							 $_SESSION['seriesprod'][0][]=$row_series['serie'];
							 $_SESSION['seriesprod'][1][]="";
							 $_SESSION['seriesprod'][2][]=$row_series['producto'];
							
							}
							
						*/
					 	}else{
						$_SESSION['productos'][0][] = "";
						$_SESSION['productos'][1][] = "";
						$_SESSION['productos'][2][] = $row3['nom_prod'];
						$_SESSION['productos'][5][] = "ref";		
						}
						
					}	
					
				    if($codigo==''){
					$_SESSION['productos'][0][] = "";
					$_SESSION['productos'][1][] = "";
					$_SESSION['productos'][2][] = "";	
					$temp='N';
				    }						
					
										
			echo $temp.'?'.$codigo.'?'.$cod_clie_ref.'?'.$des_clie_ref.'?'.$moneda_doc.'?'.$impto.'?';	
	
	
	break;
	
	case "docExiste":
		$_REQUEST['sucursal'];
		$_REQUEST['tipo'];
		$_REQUEST['doc'];
		$_REQUEST['serie'];
		$_REQUEST['numero'];
		$_REQUEST['auxiliar'];
	    
		if($_REQUEST['tipo']=='2'){
		$registros=mysql_num_rows(mysql_query("select * from cab_mov where cod_ope='".$_REQUEST['doc']."' and tipo='".$_REQUEST['tipo']."' and  sucursal='".$_REQUEST['sucursal']."' and serie='".$_REQUEST['serie']."' and Num_doc='".$_REQUEST['numero']."' ",$cn));
		}else{
		$registros=mysql_num_rows(mysql_query("select * from cab_mov where cod_ope='".$_REQUEST['doc']."' and tipo='".$_REQUEST['tipo']."' and  sucursal='".$_REQUEST['sucursal']."' and serie='".$_REQUEST['serie']."' and Num_doc='".$_REQUEST['numero']."' and cliente='".$_REQUEST['auxiliar']."'",$cn));		
		}
		
		echo $registros;
	///	echo "select * from cab_mov where cod_ope='".$_REQUEST['doc']."' and tipo='".$_REQUEST['tipo']."' and  sucursal='".$_REQUEST['sucursal']."' and serie='".$_REQUEST['serie']."' and Num_doc='".$_REQUEST['numero']."' ";
	break;
	
	case "ConsCostoO":
	
	$costoOpe=$_REQUEST['costoOpe'];
	$codCabOT=$_REQUEST['CodDocOT'];
	
	$strSQL="select sum(d.imp_item) as totalCostoOpe from referencia r,det_mov d,cab_mov c where r.cod_cab_ref='".$codCabOT."' and r.cod_cab=d.cod_cab and  d.codanex='".$costoOpe."' and d.cod_cab=c.cod_cab and c.flag!='A' ";
	$resultado=mysql_query($strSQL,$cn);
	$row=mysql_fetch_array($resultado);
	echo $row['totalCostoOpe']; 
	break;
	
	case "existeOT":
	//echo "1dd";
 	$_REQUEST['serieOT'];
	$_REQUEST['numeroOT'];
	
	$strSQL="select * from cab_mov where cod_ope='OT' and serie='".$_REQUEST['serieOT']."' and Num_doc='".$_REQUEST['numeroOT']."' ";	
	$resultado=mysql_query($strSQL,$cn);
	$cont=mysql_num_rows($resultado);
	$row=mysql_fetch_array($resultado);
	//echo $strSQL;
	
	if($cont==0){
	$temp="0";
	}elseif($row['estadoOT']=='T'){
	$temp="1";
	}else{
	$temp="2";
	}
	echo $temp."-".$row['cod_cab'];	
	break;
	case "docxRef":
	?>
	
	<table width="568"  border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="24" height="19" align="center" bgcolor="#0078F0"><span class="Estilo21">OK</span></td>
                    <td width="115" align="center" bgcolor="#0078F0"><span class="Estilo21">Fecha</span></td>
                    <td width="28" align="center" bgcolor="#0078F0"><span class="Estilo21">Tipo</span></td>
                    <td width="83" align="center" bgcolor="#0078F0"><span class="Estilo21">N&uacute;mero</span></td>
                    <td width="41" align="center" bgcolor="#0078F0"><span class="Estilo21">Tienda</span></td>
                    <td width="173" bgcolor="#0078F0"><span class="Estilo21">Cliente</span></td>
                    <td width="31" align="center" bgcolor="#0078F0"><span class="Estilo21">Mon</span></td>
                    <td width="73" align="center" bgcolor="#0078F0"><span class="Estilo21">Total</span></td>
                  </tr>
                  <?php 
				  
				$strSQL="select * from cab_mov where tipo='".$_REQUEST['tipomov']."' and cliente='".$_REQUEST['codcliente']."' and sucursal='".$_REQUEST['sucursal']."' and flag_r='' and cod_ope!='TS' and flag!='A' and cod_ope='".$_REQUEST['doc']."' order by fecha";
				
				//echo $strSQL;
				$resultado=mysql_query($strSQL,$cn);
				while($row=mysql_fetch_array($resultado)){
				
				?>
                  <tr>
                    <td><input style="border:none; background:none" name="radiobutton" type="radio" value="radiobutton" onClick="cargarDoc('<?php echo $row['serie']?>','<?php echo $row['Num_doc']?>')"></td>
                    <td align="center"><?php echo extraefecha4($row['fecha'])?></td>
                    <td align="center"><?php echo $row['cod_ope']?></td>
                    <td align="center"><?php echo $row['serie']."-".$row['Num_doc']?></td>
                    <td align="center"><?php echo $row['tienda']?></td>
                    <td><?php   list($razonsocial)=mysql_fetch_row(mysql_query("select razonsocial from cliente where codcliente='".$row['cliente']."'")); echo $razonsocial;?></td>
                    <td align="center"><?php if($row['moneda']=='01')echo "S/.";else echo "US$." ?></td>
                    <td align="right"><?php echo number_format($row['total'],2) ?></td>
                  </tr>
                  <?php 
				}
				?>
</table>
	
	<?php 	
	break;
}	

mysql_close($cn);
?>