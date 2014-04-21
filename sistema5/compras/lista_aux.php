<?php session_start();
include('../conex_inicial.php');
?>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo3 {font-size: 11px; font-family: Arial, Helvetica, sans-serif;}
-->
</style>
<?php 
$ocultar='';
if($_REQUEST['temp']=='auxiliares' && $_REQUEST['tipomov']==1){
$texto=" Proveedores ";
$detalle="detalle1";
$titulo="Ruc";
	$ocultar="style='display:none'";
}else{
	if($_REQUEST['temp']=='auxiliares' && $_REQUEST['tipomov']==2){
	$texto=" Clientes ";
	$detalle="detalle1";
	$titulo="Ruc";
	$ocultar="style='display:none'";
	}else{
	$texto=" Productos Generales ";
	$detalle="detalle";
	$titulo="Precio";
	}
}
//echo "det ".$detalle;
if(isset($_REQUEST['pto_venta'])){
$titu=" style='background:url(imagenes/aqua-hd-bg.gif)' ";
$titu2=" style='background-image:url(imagenes/grid3-hrow-over.gif)' ";
$ruta_img="imagenes";
$ruta_img2="imgenes/arrowmain.gif";
}else{
$titu=" style='background:url(../imagenes/aqua-hd-bg.gif)' ";
$titu2=" style='background-image:url(../imagenes/grid3-hrow-over.gif)' ";
$ruta_img="../imagenes";
$ruta_img2="../imgenes/arrowmain.gif";
}

//echo $titu;
//echo "det".$detalle;

if($_REQUEST['temp']=='auxiliares'){
$Wtabla1="620";
$Wtabla2="613";
$Wtabla3="588";
}else{
$Wtabla1="720";
$Wtabla2="713";
$Wtabla3="688";
}

$doc=$_REQUEST['doc'];
?>

<table  width="767" height="72" border="1" cellpadding="0" cellspacing="0" bgcolor="#95B8CC" ><!--85ADC5-->
  <tr>
    <td width="763">
	
	<table width="<?php echo '100%'//$Wtabla2 ?>" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="5" align="right"></td>
      </tr>
      <tr <?php echo $titu ?> >
        <td width="8" height="23">&nbsp;</td>
        <td width="344" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#333333"><strong>Lista de <?php echo $texto; ?></strong></font>		</td>
        <td width="400" >
		<?php 
		if($_REQUEST['temp']=='auxiliares'){
		if($_REQUEST['modulo']!='cajach'){
		?>
		<table width="185" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="92"><table title="Nuevo[F3]" width="75" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="ver_new_aux()">
              <td width="3" ></td>
              <td width="18" align="center" ><span class="Estilo112"><img src="<?php echo $ruta_img?>/nuevo.gif" width="14" height="16"></span></td>
              <td width="56" ><span class="Estilo112">Nuevo<span class="Estilo113">[F3]</span> </span></td>
              <td width="3" ></td>
            </tr>    
                </table></td>
    <td width="108"><table title="Nuevo[F3]" width="75" height="21" border="0" cellpadding="0" cellspacing="0">
		  <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="editCliente()">
              <td width="3" ></td>
              <td width="18" align="center" ><span class="Estilo112"><img src="<?php echo $ruta_img?>/nuevo.gif" width="14" height="16"></span></td>
              <td width="56" ><span class="Estilo112">Editar<span class="Estilo113">[F10]</span> </span></td>
              <td width="3" ></td>
            </tr>
        </table></td>
  </tr>
</table>

		
		  <?php }}else{?>
		  <table title="Nuevo[F3]" width="119" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onclick="func_f8()" >
              <td width="1" ></td>
              <td width="15" align="center" ><span class="Estilo112"><img src="<?php echo $ruta_img?>/nuevo.gif" width="14" height="16"></span></td>
              <td width="92" ><span class="Estilo112">Datos articulo<span class="Estilo113">[F8]</span> </span></td>
              <td width="11" ></td>
            </tr>
          </table>
		   <?php }?>
		  
		</td>
        <td colspan="2" onclick="salir()"><font face="Arial, Helvetica, sans-serif" style="text-decoration:underline; font-size:11px; cursor:pointer" color="#0033FF"><strong>x</strong></font></td>
        </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td colspan="2" align="center"><table width="<?php echo '100%'//$Wtabla3 ?>" border="1" align="left" cellpadding="0" cellspacing="0">
          <tr>  <td height="26" colspan="5">
		  
		  <?php
		if($_REQUEST['temp']=='productos'){
		
		?>
          		  <span  style="color:#FFFFFF; font:bold; font-size:9px">Buscar por: </span>
			 <select name="busqueda" onchange="enfocar_codprod()" style="width:90px">
				  
			   <option value="idproducto">C&oacute;digo Sistema</option>
			   <option value="nombre" selected="selected">Descripci&oacute;n</option>
			    <option value="cod_prod">C&oacute;digo Barras </option>
				
				<?php  
				if($_REQUEST['tipomov']==2){ 
				?>
				<option value="serie">Series</option>
				<?php 
				}
				?>
             </select>
						
			<select style="width:140px" name="comboclasificacion" onchange="filtros()" id="comboclasificacion" >
              <option selected="selected" value="999">--- <?php echo $CatgNomEti1;?> ---</option>
              <?php 
	  
	    $resultados0 = mysql_query("select * from clasificacion order by des_clas ",$cn);
			 // echo "resultado".$resultado;
			  
while($row0=mysql_fetch_array($resultados0))
{
		
	  ?>
              <option value="<?php echo $row0['idclasificacion']?>"><?php echo $row0['des_clas']?></option>
              <?php 
	 }
	 mysql_free_result($resultados0);
	 
	  ?>
              <script>
	   var valor1="<?php echo $clasificacion?>";
     var i;
	 for (i=0;i<document.form1.comboclasificacion.options.length;i++)
        {
		
            if (document.form1.comboclasificacion.options[i].value==valor1)
               {
			   
               document.form1.comboclasificacion.options[i].selected=true;
               }
        
        }
	                  </script>
            </select>
              <select style="width:140px" name="combocategoria" onchange="filtros()" id="combocategoria">
                <option selected="selected" value="999">--- <?php echo $CatgNomEti2 ?> ---</option>
                <?php 
	  
	    $resultados0 = mysql_query("select * from categoria order by des_cat ",$cn);
			 // echo "resultado".$resultado;
			  
while($row0=mysql_fetch_array($resultados0))
{
		
	  ?>
                <option value="<?php echo $row0['idCategoria']?>"><?php echo $row0['des_cat']?></option>
                <?php 
	 }
	  mysql_free_result($resultados0);
	  ?>
                <script>
			var valor1="<?php echo $categoria?>";
			var i;
			 for (i=0;i<document.form1.combocategoria.options.length;i++)
			{
			
				if (document.form1.combocategoria.options[i].value==valor1)
				   {
				   
				   document.form1.combocategoria.options[i].selected=true;
				   }
			
			}
	                  </script>
              </select>
              <select style="width:140px" name="combosubcategoria" onchange="filtros()" id="combosubcategoria">
                <option selected="selected" value="999">--- <?php echo $CatgNomEti3 ?> ---</option>
                <?php 
	  
	    $resultados0 = mysql_query("select * from subcategoria order by des_subcateg ",$cn);
			 // echo "resultado".$resultado;
			  
while($row0=mysql_fetch_array($resultados0))
{
		
	  ?>
                <option value="<?php echo $row0['idsubcategoria']?>"><?php echo $row0['des_subcateg']?></option>
                <?php 
	 }
	  mysql_free_result($resultados0);
	 
	  ?>
                <script>
	   var valor1="<?php echo $subcategoria?>";
     var i;
	 for (i=0;i<document.form1.combosubcategoria.options.length;i++)
        {
		
            if (document.form1.combosubcategoria.options[i].value==valor1)
               {
			   
               document.form1.combosubcategoria.options[i].selected=true;
               }
        
        }
	                  </script>
              </select>			  
			  <?php }else{?>
			  
			   
			   <span class="Estilo3" style="color:#FFFFFF">Buscar por:              </span>
			 <?php 
			 /*
			 $busdni="";
			 $busrazon="";
			 $busruc="";
			 
			 if($_SESSION['busquedaAux']=='razon'){$busrazon=" selected ";}
			 if($_SESSION['busquedaAux']=='ruc'){$busruc=" selected ";}
			 if($_SESSION['busquedaAux']=='dni'){$busdni=" selected ";}
			 */
			// echo $_SESSION['busquedaAux'];
			
			
			$busrazon=" selected ";
			
			switch($doc){
			
			case "FA":
				$busruc=" selected ";
			break;
			
			
			case "GR":
				$busruc=" selected ";
			break;
			
			
			}			
			 
			
			 ?> 
			 
			 <select name="busqueda2" id="busqueda2">
			 
			 
			   <option  value="codcliente">C&oacute;digo</option>
			   <option <?php echo $busrazon?> value="razonsocial">Raz&oacute;n Social</option>
			   <option <?php echo $busruc?> value="ruc">Ruc</option>
			   <option <?php echo $busdni?> value="doc_iden">Dni</option>
             </select>			
			
			  
			  <?php }?>
			  </td>
            </tr>
			
			<!--  
			style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px"
			-->
			
          <tr <?php echo $titu2; ?>>
            <td width="58" height="18" align="center" ><font face="Verdana, Arial, Helvetica, sans-serif" color="#333333" style="font-size:10px" ><strong>C&oacute;digo</strong></font></td>
            <td width="482" ><font face="Verdana, Arial, Helvetica, sans-serif" color="#333333" style="font-size:10px"><strong>
			
			<?php 
			if($_REQUEST['temp']=='productos'){
			?>
			Cod. Anexo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php } ?>
			Descripci&oacute;n
			
			</strong></font></td>
            <td width="71" align="center" ><font face="Verdana, Arial, Helvetica, sans-serif" color="#333333" style="font-size:10px"><strong><?php echo $titulo ?>(
              <label id="etiq_precio"><?php if($_REQUEST['cambiarPrecio']!=''){ echo $_REQUEST['cambiarPrecio'];}else{ echo "1";}?></label>)<img src="<?php echo $ruta_img2?>" width="8" height="16" style="cursor:pointer" onclick="verOrder()" /></strong></font></td>
			
		
			
            <td width="44" align="center" ><font face="Verdana, Arial, Helvetica, sans-serif" color="#333333" style="font-size:10px"><strong <?php echo $ocultar?> >Stock</strong></font></td>
			<td width="77" align="center" ><font face="Verdana, Arial, Helvetica, sans-serif" color="#333333" style="font-size:10px"><strong <?php echo $ocultar?> >Marca</strong></font></td>
          </tr>
		  
		  
        </table></td>
        <td width="6">&nbsp;</td>
        <td width="5">&nbsp;</td>
      </tr>
      <tr>
        <td height="166">&nbsp;&nbsp;</td>
        <td colspan="3" align="left" valign="top">
		
		<div id="<?php echo $detalle;?>" style="width:<?php echo '100%'//$Wtabla3 ?>px; height:170px; overflow-y:scroll" ></div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="5" height="2"></td>
        </tr>
      
	     <tr>
        <td height="10"></td>
        <td colspan="2"></td>
        <td></td>
      </tr>
    </table>
    </td>
  </tr>
  
</table>
<?php mysql_close($cn);?>
