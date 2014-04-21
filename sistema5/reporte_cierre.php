<?php 
session_start();
include('conex_inicial.php');
include('funciones/funciones.php');

//$fecha=gmdate('Y-m-d',time()-18000);
$hora=gmdate('h:i:s a',time()-18000);

//$fecha="2011-11-02";
//$hora=date( 'H:i:s a' ,time() - 3600);
$t_doc='TB';

$tcierre=$_REQUEST['tcierre'];

$series=$tcierre;

if(isset($_REQUEST['responsable']) && $_REQUEST['responsable']==""){
$filtro=" ";
}

if(isset($_REQUEST['responsable']) && $_REQUEST['responsable']!=""){
$filtro= " and cod_vendedor='".$_REQUEST['responsable']."' ";
$codRespons=$_REQUEST['responsable'];
}

if(!isset($_REQUEST['responsable'])){
$filtro= " and cod_vendedor='".$_REQUEST['responsable2']."' ";
$codRespons=$_REQUEST['responsable2'];
}

if(!isset($_REQUEST['tcierre'])){
//$series=$_REQUEST['tcierre2'];
}

if($_SESSION['nivel_usu']=='4' || $_SESSION['nivel_usu']=='5' ){
	$deshabilitar="";
	$fecha_visible=" style='visibility:visible' ";
	$fecha=extraefecha4($_REQUEST['fecha']);
	$fecha_imp=$_REQUEST['fecha'];
}else{
	$deshabilitar="disabled='disabled'";
	$fecha_visible=" style='visibility:hidden' ";
	$fecha=gmdate('Y-m-d',time()-18000);
	$fecha_imp=gmdate('d-m-Y',time()-18000);
}

$strSQLC="select max(fecha) from cierre where caja='".$_REQUEST['tcierre']."' and operador='".$_REQUEST['responsable']."' ";

$resultadoC=mysql_query($strSQLC,$cn);
$rowC=mysql_fetch_array($resultadoC);

if($rowC[0]==NULL){
	$fechaIniCierre="0000-00-00 00:00:00";
}else{
	$fechaIniCierre=$rowC[0];
}
	$fechaFinCierre=extraefecha4($_REQUEST['fecha']);

for($j=0;$j<=2;$j++){	
	if($j==0) $t_doc='TB';
	if($j==1) $t_doc='TF';
	if($j==2) $t_doc='TN';

	$strSQL="select substring(fecha,1,10) as fecha,num_doc,serie from cab_mov where cod_cab=(select min(cod_cab) from cab_mov where substring(fecha,1,10)='$fecha' and cod_ope='$t_doc' and pc='$series' and flag!='A' $filtro ) or cod_cab=(select max(cod_cab) from cab_mov where fecha between '$fechaIniCierre' and '$fechaFinCierre' and cod_ope='$t_doc' and pc='$series' and flag!='A' $filtro ) ORDER BY num_doc";
					
	//echo $strSQL.'<br>';
			
	$resultado=mysql_query($strSQL,$cn);
	$cont=mysql_num_rows($resultado);
	$i=1;
	while($row=mysql_fetch_array($resultado)){
		if($i==1){$doc_ini_b[]=$row['serie']."-".$row['num_doc'];}
		if($i==2 or $cont==1){$doc_fin_b[]=$row['serie']."-".$row['num_doc'];}
		$i=$i+1;
		//$fecha=$row['fecha'];
		//$td1='BV';
	}
	
	if($cont==0){
		$doc_ini_b[]=$row['serie']."-".$row['num_doc'];
		$doc_fin_b[]=$row['serie']."-".$row['num_doc'];
		$i=$i+1;
	}
	
	mysql_free_result($resultado);
	
	$strSQL2="SELECT count(cod_cab) as cantidad,sum(b_imp) as importe,sum(igv) as igv,sum(servicio) as servicio, sum(total) as total,sum(percepcion) as percepcion  from cab_mov WHERE  fecha between '$fechaIniCierre' and '$fechaFinCierre'  and cod_ope='$t_doc' and pc='$series' and flag!='A' $filtro ";
	//echo $strSQL2."<br>";
	$resultado2=mysql_query($strSQL2,$cn);
	$row2=mysql_fetch_array($resultado2);
	$cantidad[]=$row2['cantidad'];
	$importe[]=$row2['importe'];
	$igv[]=$row2['igv'];
	$servicio[]=$row2['servicio'];
	$total[]=$row2['total'];
	$percepcion[]=$row2['percepcion'];
	
	
	mysql_free_result($resultado2);


	$strSQL3="select sum(total) as total, count(serie) as cantidad from cab_mov where fecha between '$fechaIniCierre' and '$fechaFinCierre' and cod_ope='$t_doc' and pc='$series' and flag='A' $filtro ";
	$resultado3=mysql_query($strSQL3,$cn);
	$row3=mysql_fetch_array($resultado3);
	$cant_anu[]=$row3['cantidad'];
	$total_anu[]=$row3['total'];

//$t_doc='TF';
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo18 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12; }
.Estilo19 {font-size: 12}
.Estilo21 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12; font-weight: bold; }
.Estilo22 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 11px;
}
.Estilo25 {color: #990000}
.Estilo26 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 10px;
}
-->
</style>
</head>

<link rel="stylesheet" type="text/css" media="all" href="calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="calendario/calendar.js"></script>
<script type="text/javascript" src="calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendario/calendar-setup.js"></script>


<link href="styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-image: url(imagenes/bg3.jpg);
}
-->
</style>


<body>

<form name="form1" method="post" action=""><br>
<input name="cerrado" type="hidden" value="<?php echo $rowCierre?>">
 <table width="214" height="304" border="0" align="right" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  
  <tr>
    <td height="29" colspan="4" align="center"><fieldset><legend>Opciones</legend>
        <table width="220" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="82" height="30"><span class="Estilo26">CAJA/PC : </span> </td>
            <td width="138">
			
			
			<select name="tcierre" style="width:120" <?php echo $deshabilitar ?> >
		  <?php 
			$marcar="";
		    $resultados11 = mysql_query("select * from caja order by codigo ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			$marcar="";
			if($row11['serie1']==$_SESSION['srapida']){
			$marcar=" selected='selected' ";
			}
			
		  ?>
           
              <option <?php echo $marcar?> value="<?php echo $row11['pc']?>"><?php echo $row11['descripcion'];?></option>
			  <?php }?>
            </select>
			<input name="tcierre2" type="hidden" value="<?php echo $_SESSION['srapida']?>" size="8">			</td>
          </tr>
          <tr>
            <td height="26"><span class="Estilo26">USUARIO</span>:</td>
            <td>
			
		
			
			<select name="responsable" style="width:120" <?php echo $deshabilitar ?> >
			<option value="">Todos</option>

		  <?php 
			$marcar="";
		    $resultados11 = mysql_query("select * from usuarios order by usuario ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			$marcar="";
			if($row11['codigo']==$_SESSION['codvendedor']){
			$marcar=" selected='selected' ";
			}
			
		  ?>
           
              <option <?php echo $marcar?> value="<?php echo $row11['codigo']?>"><?php echo $row11['usuario'];?></option>
			  <?php }?>
            </select>
			<input name="responsable2" type="hidden" size="8" value="<?php echo $_SESSION['codvendedor']?>">			</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr <?php echo $fecha_visible; ?>>
            <td><span class="Estilo26">FECHA:</span></td>
            <td>
            
            
<input  name="fecha" type="text" id="fecha" size="10"   maxlength="10" value="<?php if(isset($_REQUEST['fecha'])){echo $_REQUEST['fecha'];}else{ echo date('d-m-Y h:i:00',time()-3600);} ?>">            <button type="reset" id="f_trigger_b2" style="height:20px" >...</button>
               <script type="text/javascript">
						Calendar.setup({
							inputField     :    "fecha",      
							ifFormat       :    "%d-%m-%Y %H:%M:00",      
							showsTime      :    true,            
							button         :    "f_trigger_b2",   
							singleClick    :    true,           
							step           :    1                
						});
               </script>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input type="submit" name="Submit" value="Generar"></td>
          </tr>
        </table>
    </fieldset> </td>
  </tr>
  
  <tr>
    <td height="34" colspan="4" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center"><table width="146" border="1" bgcolor="#FFFFFF">
      <tr>
        <td width="162" align="center"><a  onClick="javascript:window.open('imprimir_cierre.php?cierreModo=PARCIAL&series=<?php echo $series?>&responsable=<?php echo $codRespons ?>','','width=1,height=1,top=0,left=0,scroolbars=no,directories=no,location=no,menubar =no,titlebar=no,toolbar=no')" href="#"><img src="imgenes/imprimir.gif" width="42" height="42" border="0"></a><span class="Estilo22"><br>
Cierre Parcial (x)</span> </td>
      </tr>
    </table></td>
   </tr>
  
  <tr>
    <td width="39">&nbsp;</td>
    <td width="39">&nbsp;</td>
    <td width="121" align="left"></td>
    <td width="15">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center">
	
	<?php 
	if($_SESSION['nivel_usu']==4 || $_SESSION['nivel_usu']==5){
	?>
	<table width="146" border="1" bgcolor="#FFFFFF">
      <tr>
        <td width="162" align="center"><a  onClick="javascript:cerrarCaja('<?php echo $series ?>','<?php echo $codRespons ?>')" href="#"><img src="imgenes/imprimir.gif" width="42" height="42" border="0"></a><span class="Estilo22"><br>
            <span class="Estilo25">Cierre Total (z)</span></span> </td>
      </tr>
    </table>
	<?php } ?>
	
	</td>
  </tr>
</table>
</form>


<table width="334" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="20">&nbsp;</td>
    <td width="298">&nbsp;</td>
    <td width="16">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table width="290" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tr>
        <td colspan="4" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4" align="center"><span class="Estilo21">CIERRE PARCIAL DE CAJA </span></td>
      </tr>
      <tr>
        <td colspan="4" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><span class="Estilo18">Maquina Registradora </span></td>
        <td width="7"><span class="Estilo18">:</span></td>
        <td width="99" align="right"><span class="Estilo18">FFGF007572</span></td>
      </tr>
      <tr>
        <td width="167"><span class="Estilo18">Fecha</span></td>
        <td width="17"><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $fecha_imp ?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Hora</span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $hora?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Tipo de Cambio </span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($tc,2)?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Pto. Venta </span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19">
		
		<?php
		 /*
		 $strSQLUser="select *  from caja where serie1='".$series."'";
		 $resultadoUser=mysql_query($strSQLUser,$cn);
		 $rowUser=mysql_fetch_array($resultadoUser);
		 echo $rowUser['descripcion'];
		 */
		  echo $series;
		 ?>
		
		</span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Operador</span></td>
        <td>&nbsp;</td>
        <td><span class="Estilo18">:</span></td>
        <td align="right">
		
		<?php
		 $strSQLUser="select * from usuarios where codigo='".$codRespons."'";
		 $resultadoUser=mysql_query($strSQLUser,$cn);
		 $rowUser=mysql_fetch_array($resultadoUser);
		 echo $rowUser['usuario'];
		 
		 ?>		</td>
      </tr>
      <tr>
        <td colspan="4"><span class="Estilo18">----------------------------------------------------------</span></td>
      </tr>
      <tr>
        <td colspan="4" align="center"><span class="Estilo21">REPORTE DE TICKETS BOLETA </span></td>
      </tr>
      <tr>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
      </tr>
      <tr>
        <td colspan="2"><span class="Estilo18">Nro de Transacciones </span><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $cantidad[0]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Nro Ticket Inicial </span></td>
        <td>&nbsp;</td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $doc_ini_b[0]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Nro Ticket Final </span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $doc_fin_b[0]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Valor de Venta </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $importe[0]?></span></td>
      </tr>
     <!--
	  <tr>
        <td><span class="Estilo18">Servicios(13%)</span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php //echo $servicio[0]?></span></td>
      </tr>
	-->	  
      <tr>
        <td><span class="Estilo18">I.G.V.</span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $igv[0]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Venta Total del D&iacute;a </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $total[0]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total Percepci&oacute;n</span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo18">:</span></td>
        <td align="right"><span class="Estilo19"><?php echo $percepcion[0]?></span></td>
      </tr>
      <tr>
        <td colspan="2"><span class="Estilo18">Nro Tickets Anulados </span><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $cant_anu[0];?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total Ticket Anulado </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($total_anu[0],2)?></span></td>
      </tr>
      <tr>
        <td colspan="4"><span class="Estilo18">----------------------------------------------------------</span></td>
      </tr>
      <tr>
        <td colspan="4" align="center"><span class="Estilo21">REPORTE DE TICKETS FACTURA </span></td>
      </tr>
      <tr>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
      </tr>
      <tr>
        <td colspan="2"><span class="Estilo18">Nro de Transacciones </span><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $cantidad[1]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Nro Ticket Inicial </span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $doc_ini_b[1]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Nro Ticket Final </span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $doc_fin_b[1]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Valor de Venta </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $importe[1]?></span></td>
      </tr>
     <!--
	  <tr>
        <td><span class="Estilo18">Servicios(13%)</span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php //echo $servicio[1]?></span></td>
      </tr>
	-->		  
      <tr>
        <td><span class="Estilo18">I.G.V.</span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $igv[1]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Venta Total del Dia </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($total[1],2)?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total Percepci&oacute;n </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo18">:</span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($percepcion[1],2)?></span></td>
      </tr>
      <tr>
        <td colspan="2"><span class="Estilo18">Nro Tickets Anulados </span><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $cant_anu[1]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total Ticket Anulado </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($total_anu[1],2)?></span></td>
      </tr>
      <tr>
        <td colspan="4"><span class="Estilo18">----------------------------------------------------------</span></td>
      </tr>
      <tr>
        <td colspan="4" align="center"><span class="Estilo21">REPORTE DE TICKETS NOTA CREDITO </span></td>
      </tr>
      <tr>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
      </tr>
      <tr>
        <td colspan="2"><span class="Estilo18">Nro de Transacciones </span><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $cantidad[2]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Nro Ticket Inicial </span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $doc_ini_b[2]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Nro Ticket Final </span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $doc_fin_b[2]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Valor de Venta </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $importe[2]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">I.G.V.</span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $igv[2]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Venta Total del Dia </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($total[2],2)?></span></td>
      </tr>
      <tr>
        <td colspan="2"><span class="Estilo18">Nro Tickets Anulados </span><span class="Estilo19"></span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo $cant_anu[2]?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total Ticket Anulado </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($total_anu[2],2)?></span></td>
      </tr>
      <tr>
        <td colspan="4"><span class="Estilo18">----------------------------------------------------------</span></td>
      </tr>
      <tr>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo18">Gran Total </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo18">:</span></td>
        <td><span class="Estilo19"></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total(z)</span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
      </tr>
      <tr>
        <td colspan="4"><span class="Estilo18">----------------------------------------------------------</span></td>
      </tr>
      <tr>
        <td height="24" colspan="4" align="center"><span class="Estilo21">RESUMEN DE VENTAS </span></td>
      </tr>
      <tr>
        <td height="24" colspan="4" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total Ticket. Boleta </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($total[0],2)?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total Ticket Factura </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($total[1],2)?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total Ticket Nota Credito </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td>:</td>
        <td align="right"><span class="Estilo19"><?php echo "-".number_format($total[2],2)?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total Boletas </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19">0.00</span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total Facturas </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19">0.00</span></td>
      </tr>
      <tr>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td align="right"><span class="Estilo18">----------</span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total General </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($total[0]+$total[1]-$total[2],2);?></span></td>
      </tr>
      <tr>
        <td colspan="4"><span class="Estilo18">----------------------------------------------------------</span></td>
      </tr>
      <tr>
        <td colspan="4" align="center"><span class="Estilo21">PLANILLA DE COBRANZA </span></td>
      </tr>
      <tr>
        <td colspan="4" align="center">&nbsp;</td>
      </tr>
      <?php 
	  
	  
	///--------------------------------Ticket Nota de credito--------------------------------------------------
	
	// ----DOCUMENTOS SOLES---
	$strSQLTN="select sum(total) as total from cab_mov c where cod_ope='TN' and  c.fecha between '$fechaIniCierre' and '$fechaFinCierre'  and c.pc='$series' and c.flag!='A' and c.moneda='01' $filtro ";
  //echo $strSQL2;
   $resultadoTN=mysql_query($strSQLTN,$cn);
  $rowTN=mysql_fetch_array($resultadoTN);
  $efectivo_TN_soles=$rowTN['total'];  
	 
	// echo  $efectivo_TN_soles;
	 
   // ----DOCUMENTOS DOLARES---
	$strSQLTN="select sum(total) as total from cab_mov c where cod_ope='TN' and  c.fecha between '$fechaIniCierre' and '$fechaFinCierre'  and c.pc='$series' and c.flag!='A' and c.moneda='02' $filtro ";
  //echo $strSQL2;
   $resultadoTN=mysql_query($strSQLTN,$cn);
  $rowTN=mysql_fetch_array($resultadoTN);
  $efectivo_TN_dolares=$rowTN['total'];  
	 
	// echo  $efectivo_TN_dolares;
	 
	 	 
  //---------------------------ventas por tipo de pagoo----------------------------------
  
  $strSQL="SELECT sum(total) as total, p.t_pago,t.descripcion from cab_mov,pagos p,t_pago t where t.id=p.t_pago and p.referencia=cod_cab and  cab_mov.fecha between '$fechaIniCierre' and '$fechaFinCierre' and cab_mov.pc='$series' and flag!='A' $filtro group by p.t_pago";
  //echo $strSQL;
  $resultado=mysql_query($strSQL,$cn);
  while($row=mysql_fetch_array($resultado)){
  
	$tot_pago[]=$row['total'];
	$descripcion[]=$row['descripcion'];	
	
	if($row['descripcion']=='Efectivo'){
	$efectivo=$row['total'];
	}
  }
  
  $efectivo=$efectivo-$efectivo_TN_soles;
  
  
  mysql_free_result($resultado);
  
  $strSQL2="select sum(monto) as total, sum(vuelto) as vuelto from cab_mov c,pagos p where t_pago='1' and p.moneda='01'and referencia=c.cod_cab and  c.fecha between '$fechaIniCierre' and '$fechaFinCierre'  and c.pc='$series' and c.flag!='A' $filtro ";
  //echo $strSQL2;
   $resultado2=mysql_query($strSQL2,$cn);
  $row2=mysql_fetch_array($resultado2);
  $efectivo_bruto=$row2['total']-$efectivo_TN_soles;
  $vuelto_soles=$row2['vuelto'];
  
  
  $strSQL3="select sum(monto) as dolares, sum(vuelto) as vuelto from cab_mov c,pagos p where t_pago='1' and p.moneda='02' and referencia=c.cod_cab and  c.fecha between '$fechaIniCierre' and '$fechaFinCierre'  and c.pc='$series' and c.flag!='A' $filtro ";
   $resultado3=mysql_query($strSQL3,$cn);
  $row3=mysql_fetch_array($resultado3);
  $dolares_bruto=$row3['dolares']-$efectivo_TN_dolares;
  $vuelto_dolares=$row3['vuelto'];
  
  ?>
      <tr>
        <td><span class="Estilo18">EFECTIVO </span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo19">&nbsp;&nbsp;&nbsp;S/.:</span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right"><span class="Estilo19"><?php echo number_format($efectivo_bruto,2)?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18"><span class="Estilo19">&nbsp;</span><span class="Estilo19">&nbsp;</span><span class="Estilo19">&nbsp;</span><span class="Estilo19"> </span>Vuelto</span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right"><span class="Estilo19"><?php echo number_format($vuelto_soles,2)?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18"><span class="Estilo19">&nbsp;</span><span class="Estilo19">&nbsp;</span><span class="Estilo19">&nbsp; </span>Neto</span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php
		 $tempTotal1=number_format($efectivo_bruto-$vuelto_soles,2);
		 echo number_format($efectivo_bruto-$vuelto_soles,2);
		 
		 ?></span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo19">&nbsp;</span><span class="Estilo19">&nbsp;</span><span class="Estilo19">&nbsp;</span>US$.:</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right"><span class="Estilo19"><?php echo number_format($dolares_bruto,2)?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18"><span class="Estilo19">&nbsp;</span><span class="Estilo19"> &nbsp; Neto U$. a S/. </span></span></td>
        <td><span class="Estilo19">.</span></td>
        <td>&nbsp;</td>
        <td align="right"><span class="Estilo19"><?php echo number_format($dolares_bruto*$tc,2)?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo18"><span class="Estilo19">&nbsp;</span><span class="Estilo19">&nbsp;&nbsp; Vuelto</span></span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right"><span class="Estilo19"><?php echo number_format($vuelto_dolares,2)?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo19">&nbsp;</span><span class="Estilo19">&nbsp;<span class="Estilo18">&nbsp; Neto</span></span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right"><span class="Estilo19"><?php
		 $tempTotal2=number_format(($dolares_bruto*$tc)-$vuelto_dolares,2);
		 echo number_format(($dolares_bruto*$tc)-$vuelto_dolares,2);
		 
		 ?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo19">&nbsp;</span><span class="Estilo19">&nbsp;</span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4"><span class="Estilo18">TARJETA EN SOLES </span></td>
      </tr>
      <tr>
        <td colspan="4"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <?php 
	// print_r($tot_pago);
	// print_r($descripcion);
	 for($k=0;$k<count($tot_pago);$k++){
	 
	    if($descripcion[$k]!='Efectivo'){
		$total_tarjeta=$total_tarjeta+$tot_pago[$k];
	 ?>
            <tr>
              <td width="58%"><span class="Estilo18"><?php echo $descripcion[$k]?></span></td>
              <td width="6%"><span class="Estilo19">S/.</span></td>
              <td width="3%"><span class="Estilo19"><span class="Estilo18">:</span></span></td>
              <td width="33%" align="right"><span class="Estilo19"><?php echo number_format($tot_pago[$k],2)?></span></td>
            </tr>
            <?php
	    }
	  }
	   ?>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right"><span class="Estilo18">----------</span></td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total Tarjeta </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($total_tarjeta,2)?></span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo18">Total General </span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($efectivo+$total_tarjeta,2)?></span></td>
      </tr>
      <tr>
        <td colspan="4"><span class="Estilo18">----------------------------------------------------------</span></td>
      </tr>
      <tr>
        <td colspan="4" align="center"><span class="Estilo19"><span class="Estilo21">ARQUEO DE CAJA </span></span></td>
      </tr>
      <tr>
        <td colspan="4" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo19"><span class="Estilo18">Total Efectivo </span></span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($tempTotal1+$tempTotal2,2); ?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo19"><span class="Estilo18">Total en Caja </span></span></td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($efectivo+$total_tarjeta,2)?></span></td>
      </tr>
      <tr>
        <td colspan="4"><span class="Estilo19"></span><span class="Estilo19"></span><span class="Estilo19"></span><span class="Estilo19">-----------------------------------------------------------------------</span></td>
      </tr>
      <tr>
        <td colspan="4" align="center"><span class="Estilo19"></span><span class="Estilo19"></span><span class="Estilo19"></span><span class="Estilo19"><span class="Estilo21">VENTAS POR PRODUCTO </span></span></td>
      </tr>
      <tr>
        <td colspan="4" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
      </tr>
      <tr>
        <td colspan="4"><span class="Estilo19"></span><span class="Estilo19"></span><span class="Estilo19"></span>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <?php 
  
  $strSQL="SELECT cod_prod, sum(if(c.cod_ope!='TN',cantidad,-cantidad))  as cantidad,nom_prod, sum(if(c.cod_ope!='TN',precio*cantidad , -precio*cantidad) ) as totales from cab_mov c,det_mov d where c.cod_cab=d.cod_cab and  c.fecha between '$fechaIniCierre' and '$fechaFinCierre'  and c.pc='$series' and c.flag!='A' $filtro group by cod_prod,nom_prod";
  
  //echo $strSQL;
  $resultado=mysql_query($strSQL,$cn);
  while($row=mysql_fetch_array($resultado)){
  
  $tot=$tot+$row['totales'];
  ?>
              <tr>
                <td width="74%"><span class="Estilo19"><span class="Estilo18"><?php echo substr($row['nom_prod'],0,26);?></span></span></td>
                <td width="14%"><span class="Estilo19"><?php echo $row['cantidad']?></span></td>
                <td width="12%" align="right"><span class="Estilo19"><?php echo number_format($row['totales'],2)?></span></td>
              </tr>
              <?php 
		}
		mysql_free_result($resultado); 
		
		?>
            </table>          </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right"><span class="Estilo18">----------</span></td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr>
        <td><span class="Estilo19"><span class="Estilo18">Total General</span></span> </td>
        <td><span class="Estilo19">S/.</span></td>
        <td><span class="Estilo19"><span class="Estilo18">:</span></span></td>
        <td align="right"><span class="Estilo19"><?php echo number_format($tot,2)?></span></td>
      </tr>
      <tr>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
      </tr>
      <tr>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
      </tr>
      <tr>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
      </tr>
      <tr>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
      </tr>
      <tr>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
      </tr>
      <tr>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
        <td><span class="Estilo19"></span></td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</body>
</html>
<script>

function cerrarCaja(series,responsable){
	
	var series="<?php echo $series; ?>";
	//alert(series);
	var responsable="<?php echo $_REQUEST['responsable'] ?>";
	var fecha="<?php echo $fechaFinCierre; ?>";
	
if(document.form1.cerrado.value==1){
	
	alert("Ya se realizó el cierre 'Z' para esta caja");
}else{

	if(confirm("Este tipo de cierre cerrará totalmente la caja por lo que no podrá realizar más ventas el día de hoy ")){
		window.open('imprimir_cierre.php?cierreModo=TOTAL&series='+series+'&responsable='+responsable+'&fecha='+fecha,'','width=1,height=1,top=0,left=0,scroolbars=no,directories=no,location=no,menubar =no,titlebar=no,toolbar=no')
		}
	}
	document.form1.cerrado.value=1;

}
</script>