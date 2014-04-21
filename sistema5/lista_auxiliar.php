<?php 
	include('conex_inicial.php');
	include("funciones/funciones.php");

	// if(isset($_REQUEST['ptoventa'])){
	$background1="url(imagenes/bg_contentbase2.gif)";
	$background2="url(imagenes/boton_aplicar.gif)";
	//}else{
	//$background1="url(../imagenes/bg_contentbase2.gif)";
	//$background2="url(../imagenes/boton_aplicar.gif)";
	//}
	$tipomov=$_REQUEST['tipomov'];
	//echo "--->".$_GET['buton'];
?>

<style type="text/css">
<!--
body {
	background-image: url(imagenes/bg3.jpg);
}
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
.Estilo12 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color:#333333 }
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo28 {color: #000000}
.Estilo29 {color: #333333}


-->
</style>

<table width="10" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><form name="form_clientes" method="post" action="">
      <table width="477" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" >
        <tr style="background:url(imagenes/botones.gif)">
          <td width="7161" colspan="11"  valign="top"><table 
		  <? if($tipomov=='1'){ echo 'style="visibility:hidden"'; } ?> 
		   width="419" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="82" ><script>
		  function entrar_btn(obj){
		  obj.cells[0].style.backgroundImage="url(imagenes/bordes_boton1.gif)";
		  obj.cells[1].style.backgroundImage="url(imagenes/bordes_boton2.gif)";
		  obj.cells[2].style.backgroundImage="url(imagenes/bordes_boton2.gif)";
		  obj.cells[3].style.backgroundImage="url(imagenes/bordes_boton3.gif)";
		  
		  }
		  function salir_btn(obj){
		  obj.cells[0].style.backgroundImage="";
		  obj.cells[1].style.backgroundImage="";
		  obj.cells[2].style.backgroundImage="";
		  obj.cells[3].style.backgroundImage="";
		  
		  }
		  </script>
                    <table title="Nuevo[F3]" width="74" height="21" border="0" cellpadding="0" cellspacing="0">
                      <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="javascript:nuevo_auxiliar('n')">
                        <td width="3" ></td>
                        <td width="18" align="center" ><span class="Estilo28"><img src="imagenes/nuevo.gif" width="14" height="16" /></span></td>
                        <td width="55" ><span  style="font-size:11px; color:#333333">Nuevo</span><span  style="font-size:10px; color:#FF0000">[F3]</span></td>
                        <td width="3" ></td>
                      </tr>
                  </table></td>
                <td width="75"><table width="75" height="21" border="0" cellpadding="0" cellspacing="0">
                    <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="javascript:nuevo_auxiliar('e')">
                      <td width="3" ></td>
                      <td width="20" ><img src="imgenes/ico_edit.gif" alt="Editar" width="16" height="16" border="0" /></td>
                      <td width="48" ><span style="font-size:11px; color:#333333">Editar</span><span style="font-size:10px; color:#FF0000">[F6]</span></td>
                      <td width="4" ></td>
                    </tr>
                </table></td>
                <td width="107" align="center"><table style="display:none" width="100" height="21" border="0" cellpadding="0" cellspacing="0">
                    <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="">
                      <td width="3" ></td>
                      <td width="17" ><span class="Estilo28"><img src="imgenes/debaja.png" width="16" height="16" /></span></td>
                      <td width="83" ><span class="Estilo28"><span style="font-size:11px; color:#333333">Dar de Baja</span><span style="font-size:10px; color:#FF0000">[F5]</span> </span></td>
                      <td width="3" ></td>
                    </tr>
                </table></td>
                <td width="104"><table width="85" height="21" border="0" cellpadding="0" cellspacing="0">
                    <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="">
                      <td width="3" ></td>
                      <td width="20" ><span class="Estilo28"><img src="imgenes/refresh.png" width="16" height="16" /></span></td>
                      <td width="59" ><span style="font-size:11px; color:#333333">Actualizar </span></td>
                      <td width="3" ></td>
                    </tr>
                </table></td>
                <td width="283"><span style="border:#999999"><span class="Estilo1"><?php echo $texto?><span class="text4">
                  <input name="auxiliar" type="hidden" id="auxiliar" value="<?php echo $tipo_aux; ?>" />
                  <input name="cod_aux_sel" type="hidden" id="cod_aux_sel" value="" size="6"  />
                </span></span></span></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td height="5" colspan="11"></td>
        </tr>
        <tr>
          <td height="20" colspan="11"><table width="275" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="38"><span class="Estilo29">Buscar:</span></td>
                <td width="193" align="right"><input autocomplete="off" name="valor" id="valor" type="text"  style="height:20; border-color:#CCCCCC" size="30" maxlength="100" onKeyUp="filtrar()" /></td>
                <td width="44" align="left"><img src="imagenes/lupa5.gif" width="18" height="20" /></td>
              </tr>
          </table>
            <span class="text4">
            <input name="nom_aux_sel" type="hidden" id="nom_aux_sel" value="" size="6"  />
            </span><span class="text4">
            <input name="ruc_aux_sel" type="hidden" id="ruc_aux_sel" value="" size="6"  />
            </span><span class="text4">
            <input name="dir_aux_sel" type="hidden" id="dir_aux_sel" value="" size="6"  />
			</span><span class="text4">
            <input name="dir_aux_sel2" type="hidden" id="dir_aux_sel2" value="" />
			 <input name="tpersonaClie" type="hidden" id="tpersonaClie" value="" />
			</span></td>
        </tr>
        <tr bordercolor="#CCCCCC" >
          <td height="23" colspan="11" align="left"  ><table width="474" height="23" border="0" cellpadding="1" cellspacing="1" style="border:#D8D8D8 solid 1px">
              <tr style="background-image:url(imagenes/grid3-hrow-over.gif)" bordercolor="#CCCCCC"  bgcolor="#F9F9F9" >
                <td width="33"  align="center">&nbsp;</td>
                <td width="58" align="left"><span  style="font:Arial, Helvetica, sans-serif; color:#333333; font-size:10px"><strong>Codigo</strong></span></td>
                <td width="246" style="font:Arial, Helvetica, sans-serif; color:#333333; font-size:10px"><strong>Razon Social </strong></td>
                <td width="72" style="font:Arial, Helvetica, sans-serif; color:#333333; font-size:10px"><strong>Ruc</strong></td>
                <td width="47" style="font:Arial, Helvetica, sans-serif; color:#333333; font-size:10px"><strong>Dni</strong></td>
				<td width="1"></td>
              </tr>
          </table></td>
        </tr>
        <tr bordercolor="#CCCCCC" >
          <td colspan="11" align="left"><div id="detalle_aux" style="height:230px">
              <table id="lista_aux" width="472" border="0" cellpadding="0" cellspacing="1">
                <?php  
	
	
	//-------------------------------------------
	if($tipomov=='1'){
		$W="tipo_aux='P' or tipo_aux='A' ";
	}else{
		$W="tipo_aux='C' or tipo_aux='A' ";
	}
	
  $resultados = mysql_query("select * from cliente where $W order by razonsocial limit 10 ",$cn);
			 //echo "resultado".$resultado;
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
                  <td width="51"><span  style="color:#333333"><?php echo $row['codcliente'];?></span></td>
                  <td width="265"><span style="color:#333333"><?php echo caracteres($row['razonsocial']);?></span></td>
                  <td width="55"><span style="color:#333333"><?php echo $row['ruc'];?></span></td>
                  <td width="58"><span style="color:#333333"><?php echo $row['doc_iden'];?></span></td>
				  <td width="1" height="1" style=" font-size:1px; color:#FFFFFF;"><span><?php echo $row['direccion'];?></span></td>
				  <td width="1" height="1" style=" font-size:1px; color:#FFFFFF; display:none"><span><?php echo $row['t_persona'];?></span></td>
                </tr>
                <?php  
 
 $i++; 
  }
  mysql_free_result($resultados);
  
  ?>
              </table>
          </div></td>
        </tr>
        <tr>
          <td height="8" colspan="11" align="center"></td>
        </tr>
		
        <tr>	
          <td height="26" colspan="11" align="center">
		  		
			<?php if(!isset($_REQUEST['gen_multifac'])){ ?>	  
		  <input <?php echo $disable ?>  onclick="<?php echo $_REQUEST['buton'];?>();" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:<?php echo $background2;?> ; cursor:pointer; color:#126B96; font:bold; font-size:10px" type="button" name="Submit" value="Aceptar" />
		             
           <input onClick="Modalbox.hide(); return false;" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:<?php echo $background2?> ; cursor:pointer;color:#126B96; font:bold; font-size:10px" type="button" name="Submit" value="Cancelar" />
				<?php }else{ ?>		
				
				<input <?php echo $disable ?>  onclick="<?php echo $_REQUEST['buton'];?>();" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:<?php echo $background2;?> ; cursor:pointer; color:#126B96; font:bold; font-size:10px" type="button" name="Submit" value="Aceptar" />
		             
           <input onClick="btn_cancelar()" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:<?php echo $background2?> ; cursor:pointer;color:#126B96; font:bold; font-size:10px" type="button" name="Submit" value="Cancelar" />
				
				
				<?php } ?>		
				</td>
        </tr>
	
		
		
		
		
		
      </table>
    </form></td>
  </tr>
</table>

