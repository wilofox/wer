<?php 
  session_start();
  include('../conex_inicial.php');
  include('../funciones/funciones.php');
  
 
	$idproducto=$_REQUEST['idproducto'];
	$tienda=$_REQUEST['cod_tienda_origen'];
	$cod_docIng=$_REQUEST['cod_cab_doc'];
	
	 $strSQL4="select * from producto where idproducto='".$idproducto."' ";
	 $resultado4=mysql_query($strSQL4,$cn);
	 //echo $strSQL4;
	$row4=mysql_fetch_array($resultado4);
	
	$contSerieSel=0;
	
	if(isset($_SESSION['temp_series'][0])){				
		foreach ($_SESSION['temp_series'][0] as $subkey=> $subvalue) {
			if($idproducto==$_SESSION['temp_series'][2][$subkey]){
			$contSerieSel++;															
			}							
		}					
	}
	
	
		
	?>

	<table width="305" height="90" border="0">
	  <tr>
	    <td width="414" height="25" >Producto: <strong style="font-size:12px">
	      <input type="hidden" name="cod_prod_serie" id="cod_prod_serie" value="<?php echo  $idproducto; ?>" />
        <?php echo $idproducto; ?>       - <?php echo strtoupper($row4['nombre'])?>
		
		<input name="seriesSel" id="seriesSel" type="hidden" size="5" value="0" />
	    </strong></td>
      </tr>
	  <tr>
	    <td height="25" >Serie:
        <input type="text" name="serieABuscar" id="serieABuscar" onkeyup="buscarSerie(this,event)" />
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Series Seleccionadas:
        <input name="contaSerie" id="contaSerie" type="text" size="2" style="border:none; background:none; color:#FF0000; text-decoration:underline" value="<?php echo $contSerieSel; ?>" /></td>
      </tr>
	  <tr>
	    <td align="center"><table id="tbl_series" width="295" border="0" cellpadding="1" cellspacing="1">
	      <tr style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px" >
	        <td align="center">
			<input style="border:none; background:none" type="checkbox" name="checkbox3" value="checkbox" id="checkbox3" onclick="marcarAll(this)" >
			</td>
	        <td width="248" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Series</strong></td>
          </tr>
          
          <?php 
		  
		  $strSQL='select * from series where tienda="'.$tienda.'" and producto="'.$idproducto.'" and (salida="" || salida=0 ) and ingreso="'.$cod_docIng.'"';
				
				//echo $strSQL;
				$resultado=mysql_query($strSQL,$cn);
				//$i=0;
				//print_r($_SESSION['temp_series'][2]);
			$contSerieSel=0;	
			while($row=mysql_fetch_array($resultado)){
			
						
						$bgcolor="#FFFFFF";
						$checkbox=" ";
						
				if(isset($_SESSION['temp_series'][0])){
				
					foreach ($_SESSION['temp_series'][0] as $subkey=> $subvalue) {
								if($subvalue==$row['serie'] && $idproducto==$_SESSION['temp_series'][2][$subkey]){
								$bgcolor="#fff1bb";
								$checkbox=" checked='checked' ";	
								//$contSerieSel++;															
								}							
					}
					
				}
								
		  $tepmSer=(caracteres(str_replace("’","&#8217;",$row['serie'])));
		// $tepmSer=((($row['serie2'])));
		  
		  ?>
	      <tr onClick="entradae(this)" style="background:<?php echo $bgcolor; ?>" >
	        <td width="31" align="center" ><input <?php echo $checkbox ?> style="border:none; background:none" type="checkbox" name="checkbox" value="checkbox" onclick="this.checked=false"  />
			</td>            
            
	        <td width="248" >
			<?php echo ($tepmSer) ?></td>
          </tr>
          
          <?php 
          
			}
          
          ?>
          
        </table></td>
      </tr>
</table>