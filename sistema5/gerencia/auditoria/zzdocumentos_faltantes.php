<?php 
	include('../../conex_inicial.php'); 
	include('../../contabilidad/model/Mysql.php'); 
	include('../../contabilidad/model/Sucursal.php'); 
	include('../../contabilidad/model/Operacion.php');

	$objSucursal = new Sucursal;
	$arySucursales = $objSucursal->getRegistros();

	$objOperacion = new Operacion;
	$aryOperaciones = $objOperacion->getRegistrosXtipo(2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Documentos faltantes</title>
		<link href="../../styles.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="../../contabilidad/css/estilos.css">
		<link rel="stylesheet" type="text/css" href="../../contabilidad/css/ui-lightness/jquery-ui-1.8.18.custom.css">
		<script type="text/javascript" src="../../contabilidad/js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="../../contabilidad/js/jquery-ui-1.8.18.custom.min.js"></script>
		<script type="text/javascript" src="../../contabilidad/js/jquery.maskedinput-1.2.2.js"></script>        
		<script type="text/javascript" src="../../contabilidad/js/js.js"></script>
	    <style type="text/css">
<!--
.Estilo10 {
	color: #003366;
	font-size: 12px;
}
-->
        </style>
</head>
	<body>
	<table width="834" border="0" cellpadding="0" cellspacing="0">
 <tr  style="background:url(../../imagenes/white-top-bottom.gif)">
      <td width="834" height="27" colspan="11" style="border:#999999">
	  <span class="Estilo21 Estilo19 Estilo1 Estilo15"><strong> <span class="Estilo10">Administraci&oacute;n :: Documentos por Usuario</span><span class="text4">
        <input name="auxiliar" type="hidden" id="auxiliar" value="<?php echo $tipo_aux; ?>">
      </span></strong></span>	  </td>
    </tr>
      <tr>
        <td><div class="cnt-general">
          <input type="hidden" id="reportes" name="reportes" value="documentos_faltantes" />
          <div class="cnt-criterios">
            <div class="ruler">
              <div class="item">
                <label>Aplicación:</label>
                <select id="sleApp" name="sleApp">
                  <option value="1">Compras</option>
                  <option value="2" selected="selected">Ventas</option>
                </select>
              </div>
              <div class="item sucursal">
                <label>Sucursal:</label>
                <select id="sleSucursal" name="sleSucursal">
                  <?php for($x = 0 ; $x < count($arySucursales) ; $x++){ ?>
                  <option value="<?php echo $arySucursales[$x]['cod_suc'] ?>"
								<?php if($arySucursales[$x]['cod_suc']){ echo "selected='selected'";} ?>
								><?php echo $arySucursales[$x]['des_suc'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="item serie"> Documento:
                <select id="sleDocumento" name="sleDocumento">
                    <?php for($x = 0 ; $x < count($aryOperaciones) ; $x++){ ?>
                    <option value="<?php echo $aryOperaciones[$x]['codigo'] ?>" <?php if($aryOperaciones[$x]['codigo'] == 'BV'){ echo 'selected="selected"'; }?>><?php echo $aryOperaciones[$x]['descripcion'] ?></option>
                    <?php } ?>
                  </select>
              </div>
            </div>
            <div class="ruler">
              <div class="item"> Búsqueda
                <input id="rdoOpcion" name="rdoOpcion" class="rdoOpcion" type="radio" value="numeros" checked="checked" />
                Entre números /
                <input id="rdoOpcion" name="rdoOpcion" class="rdoOpcion" type="radio" value="fechas" />
                Entre fechas </div>
            </div>
            <div class="ruler especial">
              <div class="item">
                <label>Series:</label>
                <input type="text" id="txtSerie" name="txtSerie" value="001" onblur="ceros(this)" />
                <span>Del </span>
                <input type="text" id="serie_inicio" name="serie_inicio" value="0000001" onblur="ceros2(this)" />
                <span> al </span>
                <input type="text" id="serie_termino" name="serie_termino" value="0000002" onblur="ceros2(this)" />
              </div>
              <div class="item">
                <label>Rango de fechas:</label>
                <span>Del </span>
                <input type="text" id="inicio" name="inicio" value="<?=date('01-m-Y')?>" />
                <span> al </span>
                <input type="text" id="termino" name="termino" value="<?=date('d-m-Y')?>" />
              </div>
            </div>
            <div class="item botones">
              <div id="btnExportar" title="Exportar a excel"></div>
              <input type="image" id="btnProcesarDocumentosFaltantes" name="btnProcesarDocumentosFaltantes" value="Procesar" src="../../contabilidad/imgs/next.png" title="Aceptar" />
            </div>
          </div>
          <div id="cnt-resultados">
            <div id="progressbar"></div>
            <div id="resultados"></div>
          </div>
        </div></td>
      </tr>
    </table>
	<script>
			function ceros(obj) {
			  numCeros = '000'; // pon el nº de ceros que necesites
			  valor = obj.value;
			  valor = numCeros.substring(0,numCeros.length-valor.length)+valor;
			  obj.value = valor; 
			}
			
			function ceros2(obj) {
			  numCeros = '0000000'; // pon el nº de ceros que necesites
			  valor = obj.value;
			  valor = numCeros.substring(0,numCeros.length-valor.length)+valor;
			  obj.value = valor; 
			}
		</script>

	</body>
</html>