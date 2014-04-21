<?php 
include('conex_inicial.php');
include('funciones/fecha.php');
include('funciones/consolidado_ventas.php');
$titu ='Gerencia :: Ventas Consolidado :: Mensual'
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>

<link href="styles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/reporte.css"/>
<script language="javascript" src="js/prototype.js"></script>
<script language="javascript" src="js/reporte/ajax.js"></script>
<script language="javascript" src="js/reporte/reporte.js"></script>
<script language="javascript" src="miAJAXlib2.js"></script>

<style type="text/css">
<!--
.Estilo21 {color: #003366}
-->
</style>
</head>
<body onLoad="mostrar_consolidado('mostrar_busqueda','anio','mes','cod_suc','cod_tienda','codigo_caja','codigo_usuario','agrupacion' )">
<form name="form1" method="post" action="">
<table width="809" height="151" border="0" cellpadding="0" cellspacing="0" align="center"  >
  <tr>
    <td>
      <table width="793" height="192" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="19" height="34">&nbsp;</td>
          <td width="774"><label for="textfield"></label>
            <table width="590"  border="0" align="center"  class="tr_square2" >
              <tr style="background:url(imagenes/white-top-bottom.gif)"><td width="764" height="22" colspan="6" align="left" style="border:#999999"><span class="Estilo20 Estilo21"><?php echo $titu; ?></span></td>
        </tr>
              <tr>
                <td><? 	$ano_a = date('Y'); ?><div>ANIO:</div>
					<select id="anio" name="anio" class="FrmCmbChico">
					    <? for($a =	$ano_a ; $a >= 2008 ;$a-- ) { ?>
							<option value="<?=$a ?>" <? if( $ano_a == $a ){ ?> selected='selected' <? } ?> ><?=$a ?></option>
						<? } ?>  
					</select>
				</td>
                <td><div>MES:</div><? 	$mes_a = date('m'); ?>
					<select id="mes" name="mes" class="FrmCmbChico">
						<? for( $m =1 ; 12 >= $m ;$m++ ) { ?> 
							<option value="<?=$m?>" <? if( $mes_a == $m ){ ?> selected='selected' <? } ?> ><?=nombremes( $m ) ?> </option> 
						<? } ?>			  
				    </select>
				</td>
				<td><div>EMPRESA:</div>
					<select  name="cod_suc" id="cod_suc" onChange="cargar_combox();" class="FrmCmbGrande">
						<option value="to">Todos</option>
						<?  $rssuc = mysql_query("select cod_suc,des_suc from sucursal where estado='S' order by des_suc ",$cn);
							while(	$rowsuc	=	mysql_fetch_array(	$rssuc	)	){ ?>
						<option value="<?=$rowsuc['cod_suc'] ?>"><?=$rowsuc['des_suc'] ?></option>
						<? } ?>
					</select>
				</td>
				<td><div>AGRUPACION POR:</div>
					<select  name="agrupacion" id="agrupacion" class="FrmCmbChico" onChange="mostrar_consolidado('mostrar_busqueda','anio','mes','cod_suc','cod_tienda','codigo_caja','codigo_usuario','agrupacion' )" >
						<option value="ve">Vendedores</option>
						<option value="codsu">Codigos Sunat</option>
						<option value="doc">Documentos</option>
					</select>
				</td>
                </tr>
              <tr>
                <td>TIENDAS:
					  <div id="div_tienda">
						  <select name="cod_tienda" id="cod_tienda" class="FrmCmbChico" >
							<option value="to">Todos</option>
						  </select>
				    </div></td>
                <td><div>TERMINALES:</div>
					<select name="codigo_caja"id="codigo_caja" class="FrmCmbChico">
						<option value="to">Todos</option>
						<?	$rsca	=	mysql_query("select codigo,descripcion from caja order by descripcion",$cn);
							while(	$rowca	=	mysql_fetch_array( $rsca )){
						?>
						<option value="<?php echo $rowca['codigo']?>"><?php echo $rowca['descripcion']?></option>
						<? } ?>
					</select></td>
                <td><div>VENDEDORES:</div>			
					<select name="codigo_usuario" id="codigo_usuario" class="FrmCmbGrande">
						<option value = "to" >Todos</option>
						<?	$strSQL="select codigo,usuario from usuarios order by usuario";
							$resultado=mysql_query($strSQL,$cn);
							while($row=mysql_fetch_array($resultado)){
						?>
						<option value="<?php echo $row['codigo']?>"><?php echo $row['usuario']?></option>
						<? }?>
					</select></td>
                <td><center>
				  <div>
				    <div align="left">DOCUMENTOS</div>
				  </div>
				  <div align="left">
				    <input onClick="cargar_doc(event,this,'docincluir')"  name="btnInc" type="button" id="btnInc" value="   ?   " />
				    </div>
				</center></td>
              </tr>
              <tr>
                <td colspan="4">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="4"><div align="center">
                  <input type="button" name="Submit" value="Consultar" class="FrmBtn" 
				  onclick="mostrar_consolidado('mostrar_busqueda','anio','mes','cod_suc','cod_tienda','codigo_caja','codigo_usuario','agrupacion' )">
                </div></td>
              </tr>
              <tr>
                <td colspan="4">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td valign="top">&nbsp;
		  
		  </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<div align="center" id="mostrar_busqueda"></div>
<div id="auxiliares" style="position:absolute; left:274px; top:90px; width:300px; height:180px; z-index:2; visibility:hidden"></div>
<div id="docincluir" style="position:absolute; left:470px; top:113px; width:302px; height:180px; z-index:2; visibility:hidden"></div>
</form>
</body>
</html>
