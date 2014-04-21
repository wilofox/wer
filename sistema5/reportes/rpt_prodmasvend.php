<?php 
include('../conex_inicial.php');
include('../funciones/funciones.php');
if($_REQUEST['formato']=="excel"){

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=excel.xls");
}

$fecha1=$_REQUEST['fecha1'];
$fecha2=$_REQUEST['fecha2'];
$sucursal=$_REQUEST['sucursal'];
$reporte=$_REQUEST['mostrar'];
$orden=$_REQUEST['orden'];
$chkSalidas=$_REQUEST['chkSalidas'];
$tiendasx=$_REQUEST['tiendas'];
$imprimir=$_REQUEST['imprimir'];
$clasificacion=$_REQUEST['clasificacion'];
$categoria=$_REQUEST['categoria'];
$subcategoria=$_REQUEST['subcategoria'];
$cant=$_REQUEST['cant'];

switch($imprimir){
	case 'cod_prod':$codigo="d.cod_prod as codigo,d.cod_prod as cod_prod";break;
	case 'cod_anexo':$codigo="d.cod_prod as codigo,if( p.cod_prod !='', p.cod_prod, if( p.codanex2 !='', p.codanex2, if( p.codanex3 !='', p.codanex3,''))) as cod_prod";break;
}

$limit=" limit 1,$cant";
$filtro=" where d.sucursal='$sucursal'";
$docs=explode("|",$chkSalidas);
for($i=0;$i<count($docs);$i++){
	if($i==0){
		$doc_r=$docs[$i];
	}else{
		if(trim($docs[$i])!=""){
			$doc_r=$doc_r."','".$docs[$i];
		}
	}
}
$filtro.=" and d.cod_ope in('".$doc_r."')";
$tiendax=explode("|",$tiendasx);
for($i=0;$i<count($tiendax);$i++){
	if($i==0){
		$tienda_r=$tiendax[$i];
	}else{
		if(trim($tiendax[$i])!=""){
			$tienda_r=$tienda_r."','".$tiendax[$i];
		}
	}
}
$filtro.=" and d.tienda in('$tienda_r')";
$filtro.=" and substring(d.fechad,1,10) between '".trim(formatofecha($fecha1))."' and '".trim(formatofecha($fecha2))."'";
if($clasificacion!="0"){
	$filtro.=" and p.clasificacion='$clasificacion'";	
}
if($categoria!="0"){
	$filtro.=" and p.categoria='$categoria'";	
}
if($subcategoria!="0"){
	$filtro.=" and p.subcategoria='$subcategoria'";	
}
$filtro_d=$filtro;
switch($orden){
	case 'cod_prod':$campo=0;$ord_array=false;break;
	case 'cod_anexo':$campo=1;$ord_array=false;break;
	case 'nom_prod':$campo=2;$ord_array=false;break;
	case 'mayor':$campo=3;$ord_array=true;break;
	case 'menor':$campo=3;$ord_array=false;break;
}
switch($reporte){
	case 'mas':$tit="MAS ";$orden_s=" order by cantidad desc";break;
	case 'menos':$tit="MENOS ";$orden_s=" order by cantidad asc";break;
}
$tit2=$cant." PRODUCTOS ".$tit." VENDIDOS";
$sql_gen="Select $codigo, sum(d.cantidad)as cantidad, d.unidad, d.nom_prod as nom_prod, cla.des_clas, cat.des_cat, subc.des_subcateg from det_mov d inner join producto p on p.idproducto=d.cod_prod inner join clasificacion cla on  cla.idclasificacion=p.clasificacion inner join categoria cat on cat.idcategoria=p.categoria inner join subcategoria subc on subc.idsubcategoria=p.subcategoria $filtro group by d.cod_prod $orden_s $limit";
$orden_t=$orden_s.$limit; //" group by d.cod_prod".
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.Estilo10 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }
.Estilo17 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #003366; }
.Estilo32 {color: #003366}
.Estilo13 {color: #0767C7}
.Estilo9 {	font-size: 10px;
	font-weight: bold;
}
-->
</style>
</head>

<link href="../styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	/*background-image: url(../imagenes/bg3.jpg);*/
}
.Estilo15 {color: #FFFFFF}
.Estilo19 {font-family: Arial, Helvetica, sans-serif}
.Estilo20 {
	font-size: 14px;
	font-weight: bold;
	color: #0066FF;
	font-family: Arial, Helvetica, sans-serif;
}
.Estilo21 {color: #FF6600}
.Estilo24 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo27 {color: #333333}
.Estilo30 {font-family: Verdana, Arial, Helvetica, sans-serif; color: #003366;}
.Estilo31 {font-size: 10px}
.anulado  {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#990000; }
-->
</style>
<body>
<div id="seleccion">
<table width="806" height="151" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="806"><form name="form1" method="post" action="">
    <input type="hidden" name="fecha1" id="fecha1" value="<?php echo $_REQUEST['fecha1'];?>">
    <input type="hidden" name="fecha2" id="fecha2" value="<?php echo $_REQUEST['fecha2'];?>">
    <input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_REQUEST['sucursal'];?>">
    <input type="hidden" name="mostrar" id="mostrat" value="<?php echo $_REQUEST['mostrar'];?>">
    <input type="hidden" name="orden" id="orden" value="<?php echo $_REQUEST['orden'];?>">
    <input type="hidden" name="chkSalidas" id="chkSalidas" value="<?php echo $_REQUEST['chkSalidas'];?>">
    <input type="hidden" name="tiendas" id="tiendas" value="<?php echo $_REQUEST['tiendas'];?>">
    <input type="hidden" name="imprimir" id="imprimir" value="<?php echo $_REQUEST['imprimir'];?>">
	<input type="hidden" name="clasificacion" id="clasificacion" value="<?php echo $_REQUEST['clasificacion'];?>">
    <input type="hidden" name="categoria" id="categoria" value="<?php echo $_REQUEST['categoria'];?>">
    <input type="hidden" name="subcategoria" id="subcategoria" value="<?php echo $_REQUEST['subcategoria'];?>">
    <input type="hidden" name="cant" id="cant" value="<?php echo $_REQUEST['cant'];?>">
      <table width="801" height="212" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="48">&nbsp;</td>
          <td colspan="7" align="center"><span class="Estilo20">PRODUCTOS <?php echo $tit ?>VENDIDOS</span></td>
        </tr>
        <tr>
          <td height="19">&nbsp;</td>
          <td colspan="7" align="center"><span class="anulado"><?php echo $tit2?></span>&nbsp;</td>
          </tr>
        <tr>
          <td width="5" height="23">&nbsp;</td>
          <td width="107">&nbsp;</td>
          <td width="113">&nbsp;</td>
          <td width="123" align="left">&nbsp;</td>
          <td width="81">&nbsp;</td>
          <?php if(isset($_REQUEST['formato'])){?>
          <td width="121" align="center">&nbsp;</td>
            <td width="116" align="center">&nbsp;</td>
		  <?php }else{?>
          <td width="121" align="center"><table  width="80%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" onClick="vista('vista')"  style="cursor:pointer; border:#09549F solid 1px">
            
            <tr>
              <td align="center"><span class="Estilo9 Estilo13"><span class="Estilo9"><img src="../imagenes/ico_lupa.png" width="16" height="16"></span>Vista Impresi&oacute;n </span></td>
            </tr>
          </table></td>
            <td width="116" align="center"><table  width="80%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" onClick="vista('excel')"  style="cursor:pointer; border:#09549F solid 1px">
            
            <tr>
              <td align="center"><span class="Estilo9 Estilo13"><span class="Estilo9"><img src="../imagenes/icono-excel.gif" width="16" height="16"></span>Vista Excel </span></td>
            </tr>
          </table></td>
          <?php }?>
          <td width="135">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="7">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="7" valign="top">
		  
		  <table width="795" border="0" cellpadding="1" cellspacing="1">
            <tr>
              <td width="87" rowspan="2" align="center" bgcolor="#006699"><span class="Estilo7 Estilo15">Codigo</span></td>
              <td width="413" rowspan="2" bgcolor="#006699"><span class="Estilo7 Estilo15">Descripci&oacute;n</span></td>
              <td width="58" rowspan="2" bgcolor="#006699"><span class="Estilo7 Estilo15">Cantidad</span></td>
              <td height="18" colspan="7" align="center" bgcolor="#006699"><span class="Estilo7 Estilo15">MOVIMIENTOS</span></td>
              </tr>
            <tr>
              <?php $tiendax=explode("|",$tiendasx);;
			  		$j=0;
					for($i=count(tiendax);$i>=0;$i--){
						if(trim($tiendax[$i])!=""){
							?> 
                            <td width="40" height="18" align="center" bgcolor="#006699"><span class="Estilo7 Estilo15"><?php echo $tiendax[$i];?></span></td>
							<?php
							$j++;
						}
					} 
					for($i=0;$i<7-$j;$i++){
					?> 
						<td width="6" align="center" bgcolor="#006699"><span class="Estilo7 Estilo15"></span></td>
						<?php
					}?>
              </tr>
			
			
			<?php 
				$rs_gen=mysql_query($sql_gen,$cn);
				$ke=0;
				while($arr2=mysql_fetch_array($rs_gen)){
					$arr[$ke][0]=$arr2['codigo'];
					$arr[$ke][1]=$arr2['cod_prod'];
					$arr[$ke][2]=$arr2['nom_prod'];
					$arr[$ke][3]=$arr2['cantidad'];
					$ke++;
				}
				$row=ordenarArray($arr,$campo,$ord_array);
				$total=0;
				foreach ($row as $subkey=> $subvalue){
			?>
						
            <tr>
              <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?php echo trim($row[$subkey][1])?></span></td>
              <td bgcolor="#F9F9F9"><span class="Estilo10"><?php $sql_prod=mysql_query("Select * from producto where idproducto='".trim($row[$subkey][0])."'",$cn);$rw_prod=mysql_fetch_array($sql_prod); echo trim($rw_prod['nombre'])?></span></td>
              <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?php echo $total_s=Calcular('',$filtro_d,trim($row[$subkey][0]),'');$total+=$total_s;?></span></td> 
			  <?php $tiendax=explode("|",$tiendasx);
			  		$j=0;
					for($i=count(tiendax);$i>=0;$i--){
						if(trim($tiendax[$i])!=""){
							?> 
                            <td width="40" height="18" align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?php echo $prec=Calcular($tiendax[$i],$filtro_d,trim($row[$subkey][0]),'');
							eval("\$tienda".$tiendax[$i]."+= ".$prec.";");?></span></td>
							<?php
							$j++;
						}
					} 
					for($i=0;$i<6-$j;$i++){
					?> 
						<td width="6" align="center" bgcolor="#F9F9F9"><span class="Estilo10"></span></td>
						<?php
					}?>
              </tr>
			

		  	<?php 
			
		}
			?>
			
		    <tr>
		      <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
		      <td colspan="2" bgcolor="#F9F9F9">&nbsp;</td>
		      <td align="center" bgcolor="#F9F9F9">&nbsp;</td>
		      <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
		      <td bgcolor="#F9F9F9">&nbsp;</td>
		      </tr>
		    <tr>
		      <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
              <td bgcolor="#F9F9F9"><span class="Estilo7">Total General</span></td>
              <td align="center" bgcolor="#F9F9F9"><span class="Estilo7"><?php echo $total;?></span></td>
              <?php $tiendax=explode("|",$tiendasx);
			  		$j=0;
					for($i=count(tiendax);$i>=0;$i--){
						if(trim($tiendax[$i])!=""){
							?> 
                            <td width="40" height="18" align="center" bgcolor="#F9F9F9"><span class="Estilo7"><?php $campos="tienda".$tiendax[$i];echo $$campos;?></span></td>
							<?php
							$j++;
						}
					} 
					for($i=0;$i<6-$j;$i++){
					?> 
						<td width="6" align="center" bgcolor="#F9F9F9"><span class="Estilo7"></span></td>
						<?php
					}?>
              </tr>
          </table></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      </form>
    </td>
  </tr>
</table>
</div>

<?php if($_REQUEST['formato']=='vista'){?>
<table>
	<tr>
    	<td align="left" bgcolor="#F2F2F2"><a href="#" onClick="javascript:imprSelec()"><img src="../imgenes/fileprint.png" width="25" height="25" border="0"> <span class="Estilo19">Imprimir Pag.</span> </a></td>
  	</tr>
</table>
<?php }?>
</body>
</html>


<script language="Javascript">
function imprSelec()
{
  var ficha = document.getElementById('seleccion');
  var ventimp = window.open(' ', 'popimpr');
  ventimp.document.write( ficha.innerHTML );
  ventimp.document.close();
  ventimp.print( );
  ventimp.close();
} 
</script> 

<script>

function vista(formato){
//alert(formato);
var fecha1=document.form1.fecha1.value;
var fecha2=document.form1.fecha2.value;
var sucursal=document.form1.sucursal.value;
var mostrar=document.form1.mostrar.value;
var orden=document.form1.orden.value;
var chkSalidas=document.form1.chkSalidas.value;
var tiendas=document.form1.tiendas.value;
var imprimir=document.form1.imprimir.value;
var clasificacion=document.form1.clasificacion.value;
var categoria=document.form1.categoria.value;
var subcategoria=document.form1.subcategoria.value;
var cant=document.form1.cant.value;

window.open("rpt_prodmasvend.php?fecha1="+fecha1+"&fecha2="+fecha2+"&sucursal="+sucursal+"&mostrar="+mostrar+"&orden="+orden+"&chkSalidas="+chkSalidas+"&tiendas="+tiendas+"&imprimir="+imprimir+"&clasificacion="+clasificacion+"&categoria="+categoria+"&subcategoria="+subcategoria+"&cant="+cant+"&formato="+formato,"vent2","toolbar=no,status=yes, menubar=no, scrollbars=no, width=700, height=700,left=50 top=50");
}




</script>
<?php 
function Calcular($tienda,$filtro,$codigo,$orden){
	$filtro_t="";
	$filtro_cod="";
	$filtro_orden="";
	if($tienda!=""){
		$filtro_t=" and d.tienda='".$tienda."'";
	}
	if($codigo!=""){
		$filtro_cod=" and d.cod_prod='".$codigo."'";
	}
	if($orden!=""){
		$filtro_orden=$orden;
	}
	$sql_res=mysql_query("Select d.cod_prod,d.cantidad,d.unidad from det_mov d inner join producto p on p.idproducto=d.cod_prod inner join clasificacion cla on  cla.idclasificacion=p.clasificacion inner join categoria cat on cat.idcategoria=p.categoria inner join subcategoria subc on subc.idsubcategoria=p.subcategoria $filtro $filtro_cod $filtro_t $filtro_orden");
	$cantidad_p=0.000;
	while($row_res=mysql_fetch_array($sql_res)){
		$sql1=mysql_query("Select * from unixprod where producto='".$row_res['cod_prod']."' and unidad='".$row_res['unidad']."'");
		$rw_1=mysql_fetch_array($sql1);
		$factor_p=1;
		if($rw_1['factor']!=""){
			$sql2=mysql_query("Select * from producto where idproducto='".$row_res['cod_prod']."'");
			$rw_2=mysql_fetch_array($sql2);
			$factor_p=number_format($rw_1['factor'],4,".","")/number_format($rw_2['factor'],4,".","");
		}
		$res=$row_res['cantidad']*$factor_p;
		$cantidad_p+=number_format($res,3,".","");
	}
	return $cantidad_p;
}
function ordenarArray ($Array, $field, $inverse) {  
	$position = array();  
	$newRow = array();  
	foreach ($Array as $key => $row) {  
		$position[$key]  = $row[$field];  
		$newRow[$key] = $row;  
	}  
	if ($inverse) {  
		arsort($position);  
	}  
	else {  
		asort($position);  
	}  
	$returnArray = array();  
	foreach ($position as $key => $pos) {       
		$returnArray[] = $newRow[$key];  
	}  
	return $returnArray;  
}
?>