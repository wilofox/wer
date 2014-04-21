<?php 
session_start();
include('../conex_inicial.php');

  $fecha=$_REQUEST['fecha'];
  $tienda=$_REQUEST['tienda'];

if(isset($_REQUEST['accion'])){

$accion=$_REQUEST['accion'];

	if($accion=='grabar'){
		////////////////////
		$tienda=$_REQUEST['tienda'];
		$tpago=$_REQUEST['tpago'];
		$auxiliar=$_REQUEST['auxiliar'];		
		////////////////////
		$fecha=$_REQUEST['fecha'];
		$tipo=$_REQUEST['tipo'];
		$numero=$_REQUEST['numero'];
		$tcambio=$_REQUEST['tcambio'];
		$moneda=$_REQUEST['moneda'];
		$monto=$_REQUEST['monto'];	//number_format($_REQUEST['monto'],2);
		$obs=$_REQUEST['obs'];
		$pc=$_SESSION['pc_ingreso'];
		$cod_user=$_SESSION['codvendedor'];
		$fec_act=gmdate('Y-m-d H:i:s',time()-18000);
	
		//$strSQL1="select max(id) as codigo from flujo";
		$strSQL1="select max(idcaja) as codigo from cajach";
		$resultado1=mysql_query($strSQL1,$cn);
		$row1=mysql_fetch_array($resultado1);
		$codigo=$row1['codigo']+1;
		//str_pad($row1['codigo']+1, 11, "0", STR_PAD_LEFT);
		
		//$strSQL2="insert into flujo(id,fecha,tipo,numero,moneda,tc,monto,observaciones) values('".$codigo."','".$fecha."','".$tipo."','".$numero."','".$moneda."','".$tcambio."','".$monto."','".$obs."')";
		$strSQL2="insert into cajach(idcaja,cod_tienda,fecpago,tipmov,tippago,docpago,moneda,tipcambio,codclie,importe,Observa,registro,pc,cod_user) values('".$codigo."','".$tienda."','".$fecha."','".$tipo."','".$tpago."','".$numero."','".$moneda."','".$tcambio."','".$auxiliar."','".$monto."','".$obs."','$fec_act','$pc','$cod_user')";
		//echo $strSQL2;
		mysql_query($strSQL2);
	}


	if($accion=='eliminar'){
	//$strSQL3="delete from flujo where id='".$_REQUEST['id']."'";
	$id_c=substr($_REQUEST['id'],0,-4);
	$tienda=substr($_REQUEST['id'],-3);
	$strSQL3="delete from cajach where idcaja='".$id_c."'";
	mysql_query($strSQL3);
	}

}



?>

<table width="756" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="29" align="center" bgcolor="#0066CC"><span class="Estilo17">Tipo</span></td>
    <td width="50" align="center" bgcolor="#0066CC"><span class="Estilo17">Forma de Pago</span></td>
    <td width="53" align="center" bgcolor="#0066CC"><span class="Estilo17">Numero</span></td>
    <td width="229" align="center" bgcolor="#0066CC"><span class="Estilo17">Clie/Prov</span></td>
    <td width="69" align="center" bgcolor="#0066CC"><span class="Estilo17">Moneda</span></td>
    <td width="55" align="center" bgcolor="#0066CC"><span class="Estilo17">T.c.</span></td>
    <td width="52" align="center" bgcolor="#0066CC"><span class="Estilo17">Monto</span></td>
    <td width="157" align="center" bgcolor="#0066CC"><span class="Estilo17">Obs</span></td>
    <td width="34" align="center" bgcolor="#0066CC"><span class="Estilo17">A</span></td>
  </tr>
  <?php
  
  //$strSQL="select * from flujo where fecha='$fecha'";
  $strSQL="select * from cajach where fecpago='$fecha' and cod_tienda='$tienda'";
  //echo $strSQL;
  $resultado=mysql_query($strSQL,$cn);
  while($row=mysql_fetch_array($resultado)){
  ?>
  
  <tr id="<?php echo $row['idcaja'];?>">
    <td align="center" bgcolor="#EAEAEA"><span class="Estilo14"><?php echo $row['tipmov']?></span></td>
    <td bgcolor="#EAEAEA"><span class="Estilo14">
	<?php 
	$strSQL2="select * from t_pago where id='".$row['tippago']."'";
	$resultado2=mysql_query($strSQL2,$cn);
  	while($row2=mysql_fetch_array($resultado2)){
		echo $row2['descripcion'];
	}
	?></span></td>
    <td bgcolor="#EAEAEA"><span class="Estilo14"><?php echo $row['docpago']?></span></td>
    <td align="center" bgcolor="#EAEAEA"><span class="Estilo14"><?php 
	$aux=$row['codclie'];
	$des_aux=mysql_fetch_array(mysql_query("Select * from cliente where codcliente='".$row['codclie']."'",$cn));
	$tipo=$row['tipmov'];
	echo $aux." - ".$des_aux['razonsocial'];
	if($row['tipmov']=='A'){
		$desmov="Documentos Pendientes";
	}
	?>
    <input type="button" name="cancelar" onclick="cargar_docs('<?php echo $aux.",".$tipo.",".$row['idcaja'];?>')" value="Documentos Pendientes" /></span></td>
    <td align="center" bgcolor="#EAEAEA"><span class="Estilo14">
	<?php 
	if($row['moneda']=="1" || $row['moneda']=="01"){
		echo "S/.";
	}else{
		echo "US$.";
	}
	?>
    </span></td>
    <td bgcolor="#EAEAEA"><span class="Estilo14"><?php echo $row['tipcambio']?></span></td>
    <td align="right" bgcolor="#EAEAEA"><span class="Estilo14"><?php echo number_format($row['importe'],2)?></span></td>
    <td bgcolor="#EAEAEA"><span class="Estilo14"><?php echo $row['Observa']?></span></td>
    <td align="center" bgcolor="#EAEAEA"><a href="javascript:eliminar('<?php echo $row['idcaja'];?>,<?php echo $row['cod_tienda']?>')"><img src="imgenes/eliminar.gif" width="14" height="14" border="0" /></a></td>
  </tr>
  
  <?php }?>
  
  
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

