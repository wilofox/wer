<?php 
include('conex_inicial.php');
include('funciones/funciones.php');
$tipo=$_REQUEST['tipo'];

if($tipo=='1'){
$titu="Libro de  Compras / Ingresos <br/> De ".$_REQUEST['fecha']."  al ".$_REQUEST['fecha2'] ;
}else{
$titu="Relación de Documentos Salidas / Ventas";
}

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=excel.xls");
//session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.Estilo10 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo17 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #003366; }
.Estilo32 {color: #003366}
.Estilo35 {font-size: 11px}
-->
</style>
</head>

<link href="styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-image: url(imagenes/bg3.jpg);
}
.Estilo15 {color: #FFFFFF}
.Estilo19 {font-family: Arial, Helvetica, sans-serif}
.Estilo20 {
	font-size: 16px;
	font-weight: bold;
	color: #0066FF;
	font-family: Arial, Helvetica, sans-serif;
}
.Estilo21 {color: #FF6600}
.Estilo24 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo27 {color: #333333}
.Estilo30 {font-family: Verdana, Arial, Helvetica, sans-serif; color: #003366;}
.Estilo31 {font-size: 10px}
.anulado  {text-decoration:line-through;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#990000; }
.Estilo33 {color: #000066}
.Estilo34 {color: #003399}
-->
</style>

<link rel="stylesheet" type="text/css" media="all" href="calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="calendario/calendar.js"></script>
<script type="text/javascript" src="calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendario/calendar-setup.js"></script>

<script language="javascript" src="miAJAXlib2.js"></script>

<body>
<table width="892" height="151" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="788"><form name="form1" method="post" action="">
      <table width="892" height="254" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="5" height="19">&nbsp;</td>
          <td width="779" colspan="6" align="center"><span class="Estilo20"><h3><?php echo $titu; ?></h3></span></td>
        </tr>
        <tr>
          <td height="19">&nbsp;</td>
          <td colspan="6" align="left">&nbsp;</td>
        </tr>
        
        <tr>
          <td height="216">&nbsp;</td>
          <td colspan="6" valign="top">
		  
		  <table width="893" border="1" cellpadding="1" cellspacing="1">
            <tr>
              <td width="100" height="18" bgcolor="#006699"><span style="color:#FFFFFF">Fecha Canc.&nbsp;&nbsp;&nbsp;</span></td>
              <td width="34" bgcolor="#006699"><span style="color:#FFFFFF">Doc.</span></td>
              <td width="34" bgcolor="#006699"><span style="color:#FFFFFF">RUC</span></td>
              <td width="34" bgcolor="#006699"><span style="color:#FFFFFF">Razon social</span></td>
              <td width="166" bgcolor="#006699"><span style="color:#FFFFFF">Nro. Documento </span></td>
              <td width="48" align="center" bgcolor="#006699"><span style="color:#FFFFFF">Items</span></td>
              <td width="81" align="center" bgcolor="#006699"><span style="color:#FFFFFF">Importe</span></td>
              <td width="60" align="right" bgcolor="#006699"><span style="color:#FFFFFF">IGV</span></td>
              <td width="83" align="right" bgcolor="#006699"><span style="color:#FFFFFF">Total</span></td>
            </tr>
			
			
			<?php 
			
			$fecha1=$_REQUEST['fecha'];
			$fecha2=$_REQUEST['fecha2'];
			$sucursal=$_REQUEST['sucursal'];
			$tienda=$_REQUEST['almacen'];
			
			$tot_importe=0;
			$tot_igv=0;
			$tot_tot=0;
			$tot_item=0;
			
			$vendedor=$_REQUEST['vendedor'];
			if($vendedor!="000" && $vendedor!="to"){
			$filtro1=" and cod_vendedor='$vendedor' ";
			}else{
			$filtro1="";
			}
			
			$serie=$_REQUEST['serie'];
			if($serie!="000" && $serie!="to"){
			$filtro2=" and serie='$serie' ";
			}else{
			$filtro2="";
			}
			
			$turno=$_REQUEST['turno'];
			if($turno!="000"){
			
			$temp_turno=$_REQUEST['turno'];
			$strsql="select * from turno where id='$temp_turno'";
			$resultado=mysql_query($strsql,$cn);
			$row=mysql_fetch_array($resultado);
			$hinicio=$row['hinicio'];
			$hfin=$row['hfin'];
			//$fecha=date('d/m/Y');
			
			$filtro3=" and substring(fecha,12,9) between '$hinicio' and '$hfin' ";
			
			}else{
			$filtro3="";
			}			
			
			if($_REQUEST['tickets']=='' and $tipo=='2'){
			$filtro4=" and ( cod_ope='TB' or cod_ope='TF' ) ";
			}else{
			$filtro4='';
			}			
			
			if($sucursal==0){
			$filtro5="";
			}else{
				if($tienda==0){
				$filtro5=" and sucursal='$sucursal' ";					
				}else{
				$filtro5=" and sucursal='$sucursal' and tienda='$tienda' ";					
				}
				
			}
			
			
			$cant_tfa=0;
			$tot_tfa=0;
			$cant_tbv=0;
			$tot_tbv=0;
			$cant_tanu=0;
			$total_tanu=0;
			//echo "Select documentos from temp where cod_user='".$_SESSION['codvendedor']."' and reporte='LIBRO_COMPRAS'";

			$rstemp	=	mysql_query("Select documentos from temp where cod_user='".$_REQUEST['coduser']."' and reporte='LIBRO_COMPRAS'",$cn);
	$rowtemp=	mysql_fetch_array($rstemp);
	if( !empty( $rowtemp['documentos'] ) ) $filtro56 = " ".$rowtemp['documentos'];
			
			//$strSQL="select * from cab_mov cm inner join operacion o on cm.cod_ope=o.codigo and o.codigo in (".$filtro56.")  where cm.tipo='$tipo' and substring(cm.fecha,1,10) between '$fecha1' and '$fecha2' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5." and o.sunat !='' order by o.sunat,cm.fecha";
			
				$strSQL = "select cab_mov.*,cliente.tipo_aux,cliente.razonsocial,cliente.ruc,operacion.sunat 
				from cab_mov inner join cliente on cliente=codcliente inner join operacion  on operacion.codigo=cab_mov.cod_ope  and operacion.codigo in (".$filtro56.") 
				where cab_mov.tipo='".$tipo."' and substring(fecha,1,10) between '".formatofecha($fecha1)."' and '".formatofecha($fecha2)."' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5.$filtro6." and operacion.sunat!='' 
				order by operacion.sunat,fecha ";
				
			//echo $strSQL;
			//echo "select * from cab_mov cm inner join operacion o on cm.cod_ope=o.codigo where cm.tipo='$tipo' and substring(cm.fecha,1,10) between '$fecha1' and '$fecha2' ".$filtro1.$filtro2.$filtro3.$filtro4.$filtro5." and o.sunat !='' order by cm.cod_cab ";		
			$resultado=mysql_query($strSQL,$cn);
			while($row=mysql_fetch_array($resultado)){
			
			$fecha1=substr($row['fecha'],0,10);
			$td=$row['cod_ope'];
			$documento=$row['serie']." - ".$row['Num_doc'];	
			$ruc=$row['ruc'];
			$razon=$row['razonsocial'];
			$importe=$row['b_imp'];
			$igv=$row['igv'];
			$total=$row['total'];
			$noperacion=$row['noperacion'];
			$items=$row['items'];
			$flag=$row['flag'];
			$referencia=$row['cod_cab'];
			
			//echo
			
			if($flag!='A'){
			
			$tot_importe=$tot_importe+$importe;
			$tot_igv=$tot_igv+$igv;
			$tot_tot=$tot_tot+$total;	
			$tot_item=$tot_item+$items;
			
			if($td=='TB'){
			$cant_tbv=$cant_tbv+1;
			$tot_tbv=$tot_tbv+$total;
			}else{
			$cant_tfa=$cant_tfa+1;
			$tot_tfa=$tot_tfa+$total;
			}
			?>
			
			
            <tr bgcolor="#F9F9F9" onClick="entrada(this)">
              <td align="left" ><span class="Estilo10"><?php echo formatofecha($fecha1)?></span></td>
              <td ><span class="Estilo10"><?php echo $td?></span></td>
			  <td><span class="Estilo10"><?php echo $ruc ?></span></td>
			  <td><span class="Estilo10"><?php echo $razon ?></span></td>
              <td ><span class="Estilo10">
                <label for="select"><?php echo $documento ?></label>
              </span></td>
              <td align="center"><span class="Estilo10"><?php echo $items?></span></td>
              <td align="right" ><span class="Estilo10"><?php echo $importe?></span></td>
              <td align="right" ><span class="Estilo10"><?php echo $igv?></span></td>
              <td align="right" ><span class="Estilo10"><?php echo number_format($total,2)?></span></td>
            </tr>
			

		  	<?php 
			
		}else{
			$cant_tanu=$cant_tanu+1;
			$total_tanu=$total_tanu+$total;
			?>
			
			<tr bgcolor="#F9F9F9" onClick="entrada(this)">
			  <td align="left" ><font color="#FF0000" style="text-decoration:line-through"><?php echo $fecha1?></font></td>
              <td ><font color="#FF0000" style="text-decoration:line-through"><?php echo $td?></font></td>
              <td ><font color="#FF0000" style="text-decoration:line-through"><?php echo $documento?></font></td>
              <td colspan="4" align="center" >ANULADO</td>
              </tr>
			
			
			
			<?php 
		}}
		
		
		
		
		
			?>
			
		    <tr>
			  <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
			  <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
		      <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
		      <td bgcolor="#F9F9F9">&nbsp;</td>
		      <td bgcolor="#F9F9F9">&nbsp;</td>
		      <td bgcolor="#F9F9F9">&nbsp;</td>
		      <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
		      <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
		      <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
		    </tr>
		    <tr>
			  <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
			  <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
		      <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
		      <td bgcolor="#F9F9F9">&nbsp;</td>
		      <td bgcolor="#F9F9F9"><strong>Total Ticket Boleta&nbsp;&nbsp; (<?php echo $cant_tbv; ?>) </strong></td>
		      <td align="center" bgcolor="#F9F9F9">&nbsp;</td>
		      <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
		      <td align="right" bgcolor="#F9F9F9">S/.</td>
		      <td align="right" bgcolor="#F9F9F9"><strong><?php echo number_format($tot_tbv,2); ?></strong></td>
		      </tr>
		    <tr>
			  <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
			  <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
		      <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
		      <td bgcolor="#F9F9F9">&nbsp;</td>
		      <td bgcolor="#F9F9F9"><strong>Total Ticket factura&nbsp;&nbsp; (<?php echo $cant_tfa; ?>) </strong></td>
		      <td align="center" bgcolor="#F9F9F9">&nbsp;</td>
		      <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
		      <td align="right" bgcolor="#F9F9F9">S/.</td>
		      <td align="right" bgcolor="#F9F9F9"><strong><?php echo number_format($tot_tfa,2); ?></strong></td>
		      </tr>
		    <tr>
			  <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
			  <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
		      <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
		      <td bgcolor="#F9F9F9">&nbsp;</td>
		      <td bgcolor="#F9F9F9"><strong> Ticket Anulados&nbsp; (<?php echo $cant_tanu; ?>) </strong></td>
		      <td align="center" bgcolor="#F9F9F9">&nbsp;</td>
		      <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
		      <td align="right" bgcolor="#F9F9F9">S/.</td>
		      <td align="right" bgcolor="#F9F9F9"><strong><?php echo number_format($total_tanu,2); ?></strong></td>
		      </tr>
		    <tr>
			  <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
			  <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
		      <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
		      <td bgcolor="#F9F9F9">&nbsp;</td>
		      <td colspan="5" bgcolor="#F9F9F9">----------------------------------------------------------------------------------------------------------------------------------</td>
		      </tr>
		    <tr>
			  <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
			  <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
		      <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
              <td bgcolor="#F9F9F9">&nbsp;</td>
              <td bgcolor="#F9F9F9"><span class="Estilo7 Estilo33">Total General &nbsp;(<?php echo $cant_tfa+$cant_tbv; ?>)</span></td>
              <td align="center" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo $tot_item?></span></td>
              <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo number_format($tot_importe,2)?></span></td>
              <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo number_format($tot_igv,2)?></span></td>
              <td align="right" bgcolor="#F9F9F9"><span class="Estilo7 Estilo34"><?php echo number_format($tot_tot,2)?></span></td>
		    </tr>
          </table></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      </form>
    </td>
  </tr>
</table>



</body>
</html>

<script>

function doc_det(valor){

window.open("doc_det.php?referencia="+valor,"","toolbar=no,status=no, menubar=no, scrollbars=yes, width=520, height=320,left=300 top=250");

}

function entrada(objeto){
//document.getElementById('prueba').value=objeto.style.background;
//alert(objeto.style.background);

	if(objeto.style.background=='#fff1bb'){
//	alert('rrr');
	objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='#FFF1BB';
	
	}
//document.getElementById('prueba').value=objeto.style.background;
//est=0;
}


function cargar_cbo(texto){
var r = texto;
document.getElementById('cbo_tienda').innerHTML=r;
//document.form1.almacen.focus();
}

function enfocar_cbo(x){
}

function limpiar_enfoque(x){
}
function cambiar_enfoque(x){
}


</script>
