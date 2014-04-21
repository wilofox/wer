  <?php 
include('../conex_inicial.php');
$codsuc=$_REQUEST['codsuc'];

?>
<?
//Tipo
$tipo=$_REQUEST['tipo'];
$util=$_REQUEST['util'];
$reporte=$_REQUEST['reporte'];


if ($util=='cliente' and $reporte=='Consolidado' ){
?>
<table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><div align="right"><strong>Ordenado por: </strong></div></td>
                      <td><strong>
                        <select name="cmborden" id="cmborden" style="width:100" >
                          <option value="auxiliar" >C&oacute;d. Cliente</option>
                          <option value="razonsocial">Razon Social</option>
						  <option value="clasificacion">Clasificaci&oacute;n</option>
                        </select>
                      </strong></td>
                      <td><strong>
                       
                      </strong></td>
                    </tr>
                </table>
				<input type="hidden" name="cmbnum" id="cmbnum" value="" />
<?
}
elseif ($util=='cliente' and $reporte=='Detallado' ){
?>
<table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><div align="right"><strong>Ordenado por: </strong></div></td>
                      <td><strong>
                        <select name="cmborden" id="cmborden" style="width:100" >
                          <option value="auxiliar" >C&oacute;d. Cliente</option>
                          <option value="razonsocial">Razon Social</option>
                        </select>
                      </strong></td>
                      <td><strong>
                       
                      </strong></td>
                    </tr>
                </table>
				<input type="hidden" name="cmbnum" id="cmbnum" value="" />
<?
}
if ($util=='producto'){
?>
<table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><div align="right"><strong>Ordenado por: </strong></div></td>
                      <td><strong>
                        <select name="cmborden" id="cmborden" style="width:100"  onChange="activar('ord')" >
							  <option value="nom_prod" >Nom. Producto</option>
							  <option value="cod_Anexo">C&oacute;d. Anexo</option>
							  <option value="DM.cod_prod">C&oacute;d. Producto</option>
                        </select>
                      </strong></td>
                      <td><strong>
                        <select name="cmbnum" id="cmbnum" style="width:45" disabled>
						 <option value='P.cod_prod' >1</option>
						  <? for ($i = 2; $i <= 25; $i++) { 
				  		  echo "<option value='codanex".$i."' >$i</option>";
								}
						  ?>
                        </select>
                      </strong></td>
                    </tr>
                </table>
<?
}

if ($tipo=='almacen'){
?>
    <td colspan="2"><strong>
      <input name="ckb0" type="checkbox" id="ckb0" style="border: 0px; background-color:#F9F9F9; " onclick="activar('alm')" value="checkbox" checked="checked">
      Todos los Almacenes </strong></td>
  </tr>
  <tr>
    <td colspan="2">
    <select  style="width:240px;" name="almacen" onfocus="enfocar_cbo(this);limpiar_enfoque(this)" onChange="cambiar_enfoque(this);" disabled>
  <option value="0"></option>
         <?php 		
  $resultados1 = mysql_query("select * from tienda where cod_suc='$codsuc' order by des_tienda ",$cn);  // echo "select * from t0ienda where cod_suc='$codsuc' order by des_tienda";
while($row1=mysql_fetch_array($resultados1))
{
		?>			 
		<option value="<?php echo $row1['cod_tienda'] ?>"> <?php echo $row1['des_tienda'] ?></option>         <?php }?>
</select></td>

<? } 
if ($tipo=='almacen2'){
?>
<select  style="width:240px;" name="almacen" onfocus="enfocar_cbo(this);limpiar_enfoque(this)" onChange="cambiar_enfoque(this);" >
  <option value="0"></option>
         <?php 		
  $resultados1 = mysql_query("select * from tienda where cod_suc='$codsuc' order by des_tienda ",$cn);  // echo "select * from t0ienda where cod_suc='$codsuc' order by des_tienda";
while($row1=mysql_fetch_array($resultados1))
{
		?>			 
		<option value="<?php echo $row1['cod_tienda'] ?>"> <?php echo $row1['des_tienda'] ?></option>         <?php }?>
</select>

<? } ?>	  			  