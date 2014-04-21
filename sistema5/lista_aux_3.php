<?php session_start();
include_once('conex_inicial.php');

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

if(isset($_REQUEST['pagoprov'])){
$titu=" style='background:url(../imagenes/aqua-hd-bg.gif)' ";
$titu2=" style='background-image:url(../imagenes/grid3-hrow-over.gif)' ";
}else{
$titu=" style='background:url(imagenes/aqua-hd-bg.gif)' ";
$titu2=" style='background-image:url(imagenes/grid3-hrow-over.gif)' ";
}

?>
<form name="formauxiliar" id="formauxiliar" method="post" action="">
<table  width="495" height="72" border="1" cellpadding="0" cellspacing="0" bgcolor="#FCE1C5"><!--FFD3B7-->
  <tr>
    <td width="491">
	
	<table width="490" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="4" align="right"></td>
      </tr>
      <tr <?php echo $titu ?> >
        <td width="17" height="23">&nbsp;</td>
        <td width="464" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#333333"><strong>Lista de <?php echo $texto; ?></strong></font></td>
        <td colspan="2" onclick="salir()"><font face="Arial, Helvetica, sans-serif" style="text-decoration:underline; font-size:11px; cursor:pointer" color="#0033FF"><strong>x</strong></font></td>
        </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td align="center"><table width="462" border="0" align="left" cellpadding="0" cellspacing="0">
			<!--  
			style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px"
			-->
			
          <tr <?php echo $titu2; ?>>
            <td width="79" height="18" ><font face="Verdana, Arial, Helvetica, sans-serif" color="#333333" style="font-size:10px" ><strong>C&oacute;digo</strong></font></td>
            <td width="266" ><font face="Verdana, Arial, Helvetica, sans-serif" color="#333333" style="font-size:10px"><strong>Descripci&oacute;n</strong></font></td>
            <td width="36" align="right" ><font face="Verdana, Arial, Helvetica, sans-serif" color="#333333" style="font-size:10px"><strong><?php echo $titulo ?></strong></font></td>
            <td  width="81" align="center" ><font face="Verdana, Arial, Helvetica, sans-serif" color="#333333" style="font-size:10px"><strong <?php echo $ocultar?> >Stock</strong></font></td>
          </tr>
		  
		  
        </table></td>
        <td width="4">&nbsp;</td>
        <td width="5">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;</td>
        <td colspan="2" align="left"><div id="<?php echo $detalle;?>" style="width:465px; height:120px; overflow-y:scroll" ></div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4" height="5"></td>
        </tr>
      <tr>
        <td></td>
        <td><?php
		if($_REQUEST['temp']=='auxiliares'){
		
		?>
		 <table width="100%" height="28" border="0" cellpadding="0" cellspacing="0" bgcolor="#E4E4E4" style="border:#A6CFFD solid 1px">
          
          <tr>
            <td width="204" height="19" align="center"><span class="Estilo3">Buscar por: 
              </span>
			  
			 <select name="busqueda2">
			   <option value="codcliente">Codigo</option>
			   <option value="razonsocial" selected="selected">Razon Social</option>
			    <option value="ruc">Ruc</option>
				<option value="doc_iden">Dni</option>
				
             </select>			 </td>
			
            <td width="257"></td>
          </tr>
        </table>
		
		<?php 
		}		?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
	     <tr>
        <td height="10"></td>
        <td></td>
        <td></td>
      </tr>
    </table>
    </td>
  </tr>
  
</table>
</form>