<?php 
session_start();
include ('../conex_inicial.php');
$strSQL= "select * from cab_mov where cod_cab='".$_REQUEST['CodDoc']."' " ;
$resultado = mysql_query ($strSQL,$cn);
$row = mysql_fetch_array ($resultado);

$doc= $row['cod_ope'];

$strSQL_doc= "select * from operacion where codigo = '".$doc."' " ;
$resultado_doc = mysql_query ($strSQL_doc,$cn);
$row_doc = mysql_fetch_array ($resultado_doc);
$formato=$row_doc['formato'];

?>
<script>
location.href="<?php echo $formato."?codigoCab=".$_REQUEST['CodDoc']."&rpt_seg" ?>";
</script>