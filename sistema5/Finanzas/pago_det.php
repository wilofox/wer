<?php 
session_start();
include('../conex_inicial.php');

$referencia=$_REQUEST['referencia'];
//echo $referencia;

$strsql="select * from cab_mov where cod_cab='$referencia'";
$resultado=mysql_query($strsql,$cn);
$cont=mysql_num_rows($resultado);
$row=mysql_fetch_array($resultado);
//echo $cont;

$noperacion=$row['noperacion'];
$numero=$row['Num_doc'];
$serie=$row['serie'];
$flag=$row['flag'];
$tot=$row['total'];

//echo $numero;
$ruc=$row['ruc'];
$cliente=$row['cliente'];
$fecha=$row['fecha'];
$cod_ope=$row['cod_ope'];
$codsucursal=$row['sucursal'];
$codtienda=$row['tienda'];
$cod_vendedor=$row['cod_vendedor'];
$tipo_cambio=$row['tc'];
$moneda=$row['moneda'];
$fecha_aud=$row['fecha_aud'];
$nom_pc=$row['pc'];
$inafecto=$row['inafecto'];
$incluidoigv=$row['incluidoigv'];
$b_imp=$row['b_imp'];
$igv=$row['igv'];
$sal=$row['saldo'];

$sql2="Select * from pagos where referencia='".$referencia."'";
$con2=mysql_query($sql2,$cn);
$cargos=0;
$abonos=0;
while($row22=mysql_fetch_array($con2)){
	if($row22['tipo']=="A"){
		if($moneda=='01'){
			if($row22['moneda']=='dolares' || $row22['moneda']=='02'){
				$abonos=$abonos+($row22['monto']*$row22['tcambio']);
			}else{
				$abonos=$abonos+$row22['monto'];
			}
		}else{
			if($row22['moneda']=='soles' || $row22['moneda']=='01'){
				$abonos=$abonos+($row22['monto']/$row22['tcambio']);
			}else{
				$abonos=$abonos+$row22['monto'];
			}
		}
	}else{
		if($moneda=='01'){
			if($row22['moneda']=='dolares' || $row22['moneda']=='02'){
				$cargos=$cargos+($row22['monto']*$row22['tcambio']);
			}else{
				$cargos=$cargos+$row22['monto'];
			}
		}else{
			if($row22['moneda']=='soles' || $row22['moneda']=='01'){
				$cargos=$cargos+($row22['monto']/$row22['tcambio']);
			}else{
				$cargos=$cargos+$row22['monto'];
			}
		}
	}
}

$imp=$tot+$cargos;

if($inafecto=='S'){
	$texto_incl_igv=" DOC. INAFECTO ";
}else{

	if($incluidoigv=='S'){
	$texto_incl_igv=" INCLUIDO IGV";
	}else{
	$texto_incl_igv=" NO INCLUIDO IGV";
	}
}






if($moneda=='01'){
$mon_des="SOLES S/.";
$simbolo="S/.";
}else{
$mon_des="DOLARES US$.";
$simbolo="US$.";
}



//$importe=$row['total'];

	$strSQL_clie="select *  from cliente where codcliente='".$cliente."'";
	$resultado_clie=mysql_query($strSQL_clie,$cn);
	$row_clie=mysql_fetch_array($resultado_clie);
	$razonsocial=$row_clie['razonsocial'];
	$ruc=$row_clie['ruc'];
	$direccion=$row_clie['direccion'];
	
//	echo $strSQL_clie;
	
	$strSQL_ope="select *  from operacion where codigo='".$cod_ope."'";
	$resultado_ope=mysql_query($strSQL_ope,$cn);
	$row_ope=mysql_fetch_array($resultado_ope);
	$ticket=$row_ope['descripcion'];
	
	$strSQL_emp="select des_suc from sucursal where cod_suc='".$codsucursal."'";
	$resultado_emp=mysql_query($strSQL_emp,$cn);
	$row_emp=mysql_fetch_array($resultado_emp);
	$dessuc=$row_emp['des_suc'];
	
	
	
	$strSQL_tien="select des_tienda from tienda where cod_tienda='".$codtienda."'";
	$resultado_tien=mysql_query($strSQL_tien,$cn);
	$row_tien=mysql_fetch_array($resultado_tien);
	$destienda=$row_tien['des_tienda'];
	
	$empresa=$dessuc." / ".$destienda;
	
	$strSQL_vend="select usuario from usuarios where codigo='".$cod_vendedor."'";
	$resultado_vend=mysql_query($strSQL_vend,$cn);
	$row_vend=mysql_fetch_array($resultado_vend);
	
	$responsable=$row_vend['usuario'];
	
	$afecha=explode('-',trim(substr($fecha,0,10)));
	$fecha=$afecha[2]."-".$afecha[1]."-".$afecha[0]." ".substr($fecha,11,18);


?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>detalle</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {
	color: #FFFFFF;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo3 {
	color: #003366;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo7 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.Estilo12 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo21 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #FF0000; }
.Estilo24 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #FFFFFF; }
.Estilo25 {
	color: #FF0000;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style></head>

<body>
<table width="734" height="313" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="32" colspan="3" align="center" bgcolor="#003366"><span class="Estilo1"><?php echo strtoupper($ticket); ?></span></td>
    <?php if($flag=='A'){?>
  </tr>
  <tr>
    <td height="21" colspan="3" align="center" ><span class="Estilo21">( Anulado )</span></td>
  </tr>
  <?php }?>
  <tr>
    <td width="4" height="86">&nbsp;</td>
    <td width="636" style="padding-top:10px"><fieldset>
      <table width="625" height="95" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="297" height="19"><span class="Estilo7">Empresa/ Tienda: </span><span class="Estilo12"><?php echo $empresa; ?></span></td>
          <td width="182" rowspan="2"><span class="Estilo7">Fecha: </span><span class="Estilo12"><?php echo $fecha?></span></td>
          <td width="73" bgcolor="#FFFF99"><span class="Estilo7">Importe: </span><span class="Estilo2"><span class="Estilo7"><?php echo $simbolo."   ";?></span></span></td>
          <td width="73" align="right" bgcolor="#FFFF99"><span class="Estilo2"><?php echo number_format($tot,2);?></span></td>
        </tr>
        <tr>
          <td height="19"><span class="Estilo12"><span class="Estilo7">TD</span>: <?php echo $cod_ope." : ".$serie."-".$numero ?></span></td>
          <td bgcolor="#FFFF99"><!--
		<span class="Estilo12"><?php //echo "Nro.Operaci&oacute;n: ".str_pad($noperacion, 10, "0", STR_PAD_LEFT)?></span>-->
            <span class="Estilo7">Cargos: </span><span class="Estilo2"><span class="Estilo7"><?php echo $simbolo."   ";?></span></span></td>
          <td align="right" bgcolor="#FFFF99"><span class="Estilo2"><?php echo number_format($cargos,2);?></span></td>
        </tr>
        <tr>
          <td height="19"><span class="Estilo7">Se&ntilde;ores:</span><span class="Estilo12"> <?php echo $razonsocial; ?></span></td>
          <td><span class="Estilo7">Ruc:</span><span class="Estilo12"><?php echo $ruc; ?></span></td>
          <td bgcolor="#FFFF99"><span class="Estilo7">Total: </span><span class="Estilo2"><span class="Estilo7"><?php echo $simbolo."   ";?></span></span></td>
          <td align="right" bgcolor="#FFFF99"><span class="Estilo2"><?php echo number_format($imp,2);?></span></td>
        </tr>
        <tr>
          <td height="19"><span class="Estilo7">Direcci&oacute;n</span>:<span class="Estilo12"><?php echo $direccion; ?></span></td>
          <td><span class="Estilo7">Tc.</span><span class="Estilo12"><?php echo $tipo_cambio; ?></span> <span class="Estilo7">&nbsp;&nbsp;&nbsp;</span></td>
          <td bgcolor="#FFFF99"><span class="Estilo7">A Cta: </span><span class="Estilo2"><span class="Estilo7"><?php echo $simbolo."   ";?></span></span></td>
          <td align="right" bgcolor="#FFFF99"><span class="Estilo2"><?php echo number_format($abonos,2);?></span></td>
        </tr>
        <tr>
          <td height="19"><span class="Estilo7">Responsable: </span><span class="Estilo12"><?php echo $responsable?></span></td>
          <td><span class="Estilo7">Moneda:</span><span class="Estilo12"><?php echo $mon_des; ?></span></td>
          <td bgcolor="#FFFF99"><span class="Estilo7">Saldo: </span><span class="Estilo2"><span class="Estilo7"><?php echo $simbolo."   ";?></span></span></td>
          <td align="right" bgcolor="#FFFF99"><span class="Estilo2"><?php echo number_format($sal,2);?></span></td>
        </tr>
      </table>
    </fieldset></td>
    <td width="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="117">&nbsp;</td>
    <td><table width="711" height="81" border="0" cellpadding="1" cellspacing="1">
      <tr></tr>
      <tr>
        <td height="25" colspan="11"><span class="Estilo3">Detalle de Pagos: </span></td>
      </tr>
      <tr style="background:url(../imagenes/bg_contentbase2.gif);  background-position:100% 40%;">
        <td width="14" height="18" align="center" ><span class="Estilo24">T.</span></td>
        <td width="49" height="18" align="center" ><span class="Estilo24">T.D.</span></td>
        <td width="65" height="18" align="center" ><span class="Estilo24">Numero</span></td>
        <td width="25" height="18" align="center" ><span class="Estilo24">Moneda</span></td>
        <td width="54" height="18" align="center" ><span class="Estilo24">Recibido</span></td>
        <td width="57" align="center" ><span class="Estilo24">T.Cambio</span></td>
        <td width="57" align="center" ><span class="Estilo24">Monto</span></td>
        <td width="78" align="center" ><span class="Estilo24">Valorizado en</span></td>
        <td width="57" align="center" ><span class="Estilo24">F. Venc.</span></td>
        <td width="114" height="18" align="center" ><span class="Estilo24">Registro</span></td>
        <td width="114" align="center" ><span class="Estilo24">Obs</span></td>
      </tr>
      <?php 
	  
	  $strSQL4="select pa.*,tp.descripcion as td from pagos pa inner join t_pago tp on tp.id=pa.t_pago where pa.referencia='".$referencia."' order by pa.id";
 $resultado4=mysql_query($strSQL4,$cn);
 //echo $strSQL4;
$nitems=0;
 while($row4=mysql_fetch_array($resultado4)){
 $nitems=$nitems+1;
	  ?>
      <tr>
        <td valign="top" align="center" bgcolor="#EFEFEF" class="Estilo7"><?php echo $row4['tipo']; ?></td>
        <td valign="top" bgcolor="#EFEFEF"><span class="Estilo7"><?php echo $row4['td']; ?></span></td>
        <td valign="top"  align="center" bgcolor="#EFEFEF"><span class="Estilo7"><?php echo $row4['numero']; ?> </span></td>
        <td align="center" bgcolor="#EFEFEF" valign="top" ><span class="Estilo7">
          <?php if($row4['moneda']=='soles' || $row4['moneda']=='01'){
			  echo "(S/.)";
		  }else{
			  echo "(US$.)";
		  } ?>
        </span></td>
        <td align="center" bgcolor="#EFEFEF" valign="top"><span class="Estilo7"><?php echo $row4['fecha'];?></span></td>
        <td align="right" valign="top"  bgcolor="#EFEFEF"><span class="Estilo7"><?php echo number_format($row4['tcambio'],2);?></span></td>
        <td align="right" valign="top"  bgcolor="#EFEFEF"><span class="Estilo7"><?php echo number_format($row4['monto'],2);?></span></td>
        <td align="right" valign="top"  bgcolor="#EFEFEF"><span class="Estilo7">
          <?php 
		if($row4['moneda']=='soles' || $row4['moneda']=='01'){
			$impo=$row4['monto']/$row4['tcambio'];
			$impor=number_format($impo,2);
			echo "(US$.) ".$impor;
		}else{
			$impo=$row4['monto']*$row4['tcambio'];
			$impor=number_format($impo,2);
			echo "(S/.) ".$impor;
		}
		?>
        </span></td>
        <td align="right" valign="top"  bgcolor="#EFEFEF"><span class="Estilo7"><?php echo $row4['fechav'];?></span></td>
        <td align="right" valign="top"  bgcolor="#EFEFEF"><span class="Estilo7"><?php echo $row4['fechap'];?></span></td>
        <td align="center" valign="top"  bgcolor="#EFEFEF"><span class="Estilo7"><?php echo $row4['obs'];?></span></td>
        <?php //echo number_format($total,2); ?>
        <?php }
	  
	  ?>
      </table></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#EFEFEF" class="Estilo7" >&nbsp;</td>
    <td colspan="9" bgcolor="#EFEFEF"><span class="Estilo7" style="color:#0066FF; font-family:Arial, Helvetica, sans-serif; font-size:9px"><br>
      </span>
      <p></p></td>
  </tr>
</table>
</body>
</html>
