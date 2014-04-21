<?
$codigo = $_REQUEST['CodDoc'];
$Valor = $_REQUEST['Fun'];
session_start();
include("../conex_inicial.php");
include('../funciones/funciones.php');
		
if(isset($_REQUEST['fec1']))
$fec1=$_REQUEST['fec1'];
if(isset($_REQUEST['txtMoti']))
$txtMoti=$_REQUEST['txtMoti'];
if(isset($_REQUEST['txtObsr']))
$txtObsr=$_REQUEST['txtObsr'];
if(isset($_REQUEST['cbresp']))
$cbores=$_REQUEST['cbresp'];
if(isset($_REQUEST['cbomon']))
$cbomon=$_REQUEST['cbomon'];
if(isset($_REQUEST['imptot']))
$txtimp=$_REQUEST['imptot'];
if(isset($_REQUEST['sprod']))
$cbosprod=$_REQUEST['sprod'];
if(isset($_REQUEST['ventana']))
$ventana=$_REQUEST['ventana'];
$fec_hor_act=date('Y-m-d H:i:s',time()-3600);
	
	//////////////TEST//////////////
/*	echo "<br>".$fec1;
	echo "<br>".$txtMoti;
	echo "<br>".$txtObsr;
	echo "<br>".$cbores;
	echo "<br>".$cbomon;
	echo "<br>".$txtimp;
	echo "<br>".$cbosprod;
	echo "<br>".$ventana;*/
	////////////////////////////
if(isset($_REQUEST['accion'])){	
	if($_REQUEST['accion']=='TRS'){

		$strSQL02=" UPDATE  cab_mov SET f_venc='".formatofecha($fec1)."', motivo='".$txtMoti."',estadoOT= 'T', flag_r='RARO' WHERE cod_cab='".$codigo."'  ";
		mysql_query($strSQL02,$cn);
		if(isset($_REQUEST['saldo_doc'])){
			$idp="Select max(id) from pagos";
			$nid=$id['0']+1;
			$nid=str_pad($nid, 6, "0", STR_PAD_LEFT);
			$fechas_p=formatofecha($fec1);
			$pagoz=$_REQUEST['saldo_doc'];
			$tca=$_SESSION['tc'];
			$modo=$_REQUEST['cbomon'];
			mysql_query("Insert into pagos (id,tipo,t_pago,fecha,fechav,numero,monto,moneda,vuelto,moneda_v,fechap,tcambio,referencia,estado) values('$nid','A','1','$fechas_p','$fechas_p',' ',$pagoz,'$modo',0,'$modo','$fec_hor_act','$tca','$codigo','')",$cn);
		}
		//echo "<br>".$strSQL02;
	
		//cabesera 
		$strSQL09="select max(cod_cab) as cod_cab from cab_mov  ";
		$resultado09=mysql_query($strSQL09,$cn);
		$row09=mysql_fetch_array($resultado09);
		$codref=$row09['cod_cab']+1;
				
		$strSQL08="select * from cab_mov  where	cod_cab='".$codigo."' ";
		$resultado08=mysql_query($strSQL08,$cn);
		$row08=mysql_fetch_array($resultado08);
		$ope1=substr($row08['cod_ope'],0,1);
		$tienda=$row08['tienda'];
				
		$strSQL07="select max(Num_doc)as  Num_doc from cab_mov where cod_ope='".$ope1."2' ";
		$resultado07=mysql_query($strSQL07,$cn);
		$row07=mysql_fetch_array($resultado07);
		$numdoc1=str_pad($row07['Num_doc']+1, 7, "0", STR_PAD_LEFT);
		
		if($row08['kardex']=='I'){
			$k="S";
		}else{
			$k="";
		}
		
		if($cbores!=$row08['cod_vendedor'] || $cbomon!=$row08['moneda'] || $txtimp!=$row08['total']){
		 	$strSQL03=" INSERT INTO cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,caja,cliente,ruc,fecha,f_venc,moneda,impto1,tc,b_imp,igv,servicio,percepcion,total,saldo,tienda,sucursal,condicion,kardex,incluidoigv,inafecto,fecha_aud,pc,usuario,deuda,flag,flag_r,motivo,noperacion,items,obs1,obs2,obs3,obs4,obs5,transportista,chofer,dirPartida,dirDestino,archivo,estadoOT,numeroOT) SELECT '".$codref."','2','".$ope1."2','".$numdoc1."','001', '".$cbores."',caja,cliente,ruc,fecha,f_venc,'".$cbomon."',impto1,tc,b_imp,igv,servicio ,percepcion,".$txtimp.",saldo,tienda,sucursal,condicion,'".$k."',incluidoigv,inafecto,'".$fec_hor_act."','".$_SESSION['pc_ingreso']."','".$_SESSION['codvendedor']."',deuda,'','','".$txtMoti."','',0,'".$txtMoti."',obs2,'','','','','','','','','',''  FROM cab_mov WHERE cod_cab='".$codigo."'  ";
		}else{
			$strSQL03=" INSERT INTO cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,caja,cliente,ruc,fecha,f_venc,moneda,impto1,tc,b_imp,igv,servicio,percepcion,total,saldo,tienda,sucursal,condicion,kardex,incluidoigv,inafecto,fecha_aud,pc,usuario,deuda,flag,flag_r,motivo,noperacion,items,obs1,obs2,obs3,obs4,obs5,transportista,chofer,dirPartida,dirDestino,archivo,estadoOT,numeroOT) SELECT '".$codref."','2','".$ope1."2','".$numdoc1."','001', cod_vendedor,caja,cliente,ruc,fecha,f_venc,moneda,impto1,tc,b_imp,igv,servicio ,percepcion,total,saldo,tienda,sucursal,condicion,'".$k."',incluidoigv,inafecto,'".$fec_hor_act."','".$_SESSION['pc_ingreso']."','".$_SESSION['codvendedor']."',deuda,'','','".$txtMoti."','',0,'".$txtMoti."',obs2,'','','','','','','','','',''  FROM cab_mov WHERE cod_cab='".$codigo."'  ";
		}
		mysql_query($strSQL03,$cn);
		//echo "<br>".$strSQL03;
		//detalle
		$sa="saldo_actual";
		//switch($ope1){
//			case "R":$sa="saldo_actual-1";break;
//		}
		if($cbores!=$row08['cod_vendedor'] || $cbomon!=$row08['moneda'] || $txtimp!=$row08['total']){
			$strSQL04=" INSERT INTO det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,codanex,nom_prod,unidad,tcambio,moneda,precio,cantidad,imp_item,precosto,flag_percep,porcen_percep,notas,fechad,descargo,afectoigv,flag_kardex,costo_inven,saldo_actual,ancho,largo,mt2,factor,descOT,descOT_porc,desc1) 	
	SELECT '".$codref."','2','".$ope1."2',serie,numero,auxiliar,tienda,sucursal,cod_prod,codanex,nom_prod,unidad,tcambio,'".$cbomon."',".$txtimp.",cantidad,".$txtimp.",precosto,flag_percep,porcen_percep,notas,'".$fec_hor_act."',descargo,afectoigv,2,costo_inven,".$sa.",ancho,largo,mt2,factor,descOT,descOT_porc,'0' FROM det_mov WHERE cod_cab='".$codigo."' order by cod_det ";
		}else{
			$strSQL04=" INSERT INTO det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,codanex,nom_prod,unidad,tcambio,moneda,precio,cantidad,imp_item,precosto,flag_percep,porcen_percep,notas,fechad,descargo,afectoigv,flag_kardex,costo_inven,saldo_actual,ancho,largo,mt2,factor,descOT,descOT_porc,desc1) 	
	SELECT '".$codref."','2','".$ope1."2',serie,numero,auxiliar,tienda,sucursal,cod_prod,codanex,nom_prod,unidad,tcambio,moneda,precio,cantidad,imp_item,precosto,flag_percep,porcen_percep,notas,'".$fec_hor_act."',descargo,afectoigv,2,costo_inven,".$sa.",ancho,largo,mt2,factor,descOT,descOT_porc,'0' FROM det_mov WHERE cod_cab='".$codigo."' order by cod_det ";
		}
		mysql_query($strSQL04,$cn);
		//echo "<br>".$strSQL04;

		$strSQL05=" INSERT INTO referencia(cod_cab,serie,correlativo,cod_cab_ref) VALUES('".$codref."','001','".$numdoc1."','".$codigo."')  ";
		mysql_query($strSQL05,$cn);
		//echo "<br>".$strSQL05;
		//acfecto a kardex
		if ($ope1=='R'){
    		$strSQL07="select * from det_mov where cod_cab='".$codigo."' ";
			$resultado07=mysql_query($strSQL07,$cn);
			$row07=mysql_fetch_array($resultado07);
			
			$strSQL01="select * from producto where idproducto='".$row07['cod_prod']."' and  kardex='S' ";
			$resultado01=mysql_query($strSQL01,$cn);
			$row01=mysql_fetch_array($resultado01);
			$CantPro=$row01['saldo'.$tienda.''];
			$CantPro=$CantPro-$row07['cantidad'];				
	
			$strSQL06="UPDATE producto SET saldo".$tienda." = '$CantPro' WHERE idproducto =".$row07['cod_prod']."  and  kardex='S' ";
			mysql_query($strSQL06,$cn);					
		//echo "<br>".$strSQL06;
	
			$strSQL42="update series set salida='".$codref."', estado='V' where producto='".$row07['cod_prod']."' and tienda='".$tienda."' and serie='".$cbosprod."' and salida=0 ";
			mysql_query($strSQL42,$cn);
			//echo "<br>".$strSQL42;
		}
	}elseif($_REQUEST['accion']=='T'){

		echo $strSQL02=" UPDATE  cab_mov SET f_venc='".formatofecha($fec1)."', motivo='".$txtMoti."',estadoOT= 'T' WHERE cod_cab='".$codigo."'  ";
		mysql_query($strSQL02,$cn);	
	}elseif($_REQUEST['accion']=='O'){
		$strSQL02=" UPDATE multicj SET notas='".$txtObsr."' WHERE multi_id='".$codigo."'  ";
		//,estadoOT= 'O'
		mysql_query($strSQL02,$cn);
	}elseif($_REQUEST['accion']=='A'){
		// obtenemos los datos del archivo 
		$tamano = $_FILES["archivo"]['size'];
		$tipo = $_FILES["archivo"]['type'];
		$archivo = $_FILES["archivo"]['name'];
		$prefijo = substr(md5(uniqid(rand())),0,6);
	
		if ($archivo != "") {
			// guardamos el archivo a la carpeta files
			$destino =  "files/".$prefijo."_".$archivo;
			if (copy($_FILES['archivo']['tmp_name'],$destino)) {
				$status = "Archivo subido: <b>".$archivo."</b>";
				//Actualizar data
				$strSQL02=" UPDATE multicj SET archivo='".$destino."' WHERE multi_id='".$codigo."'  ";
				mysql_query($strSQL02,$cn);
			} else {
				$status = "Error al subir el archivo";
			}
		} else {
			$status = "Error al subir archivo";
		}
		echo $status;
	}elseif($_REQUEST['accion']=='L'){
		$sql=mysql_query("Select * from multi_det where multi_id='".$codigo."'",$cn);
		while($rw_let2=mysql_fetch_array($sql)){
			$control1="cbocta".$rw_let2['det_id'];
			$control2="nrobco".$rw_let2['det_id'];
			if(isset($_REQUEST[$control1])){
				if($_REQUEST[$control1]!=""){
					//mysql_query("Update multicj set banco_id='".$_REQUEST[$control1]."' where multi_id='".$rw_let2['multi_id']."'",$cn);
					mysql_query("Update multi_det set numbco='".$_REQUEST[$control2]."', banco_id='".$_REQUEST[$control1]."' where det_id='".$rw_let2['det_id']."'",$cn);
					//echo $_REQUEST[$control1]."-".$_REQUEST[$control2]." : ".$rw_let2['det_id']."<br>";
				}
			}
		}
	}
}
// cargara datos 
$SQL="select mc.*,cl.razonsocial as auxiliar from multicj mc inner join cliente cl on cl.codcliente=mc.cliente where mc.multi_id='".$codigo."' ";
$Resul=mysql_query($SQL,$cn);
$rowC=mysql_fetch_array($Resul);
//echo $rowC['obs1'];	
	
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>
<title>:::PROLYAMRP::::</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 11px;
}
.Estilo10 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
	color: #0066CC;
}
.Estilo11 {color: #FFFFFF}
-->
</style></head>

<script type="text/javascript" src="../javascript/mover_div.js"></script>
<script language="javascript" src="../miAJAXlib2.js"></script>

<link href="../styles.css" rel="stylesheet" type="text/css">
<script>
var formato="rpt_serv_tec.php";
function guardar(Valor){
	if(Valor=="TRS"){
		if(document.formulario.cancelar == undefined){
			if(document.formulario.txtMoti.value==""){
				alert("Falta llenar las Acciones Realizadas");
				document.formulario.txtMoti.focus();
				document.formulario.txtMoti.select();
			}else{
				document.formulario.accion.value=Valor;
				document.formulario.submit();
			}
		}else{
			if(document.formulario.cancelar.checked){
				if(document.formulario.txtMoti.value==""){
					alert("Falta llenar las Acciones Realizadas");
					document.formulario.txtMoti.focus();
					document.formulario.txtMoti.select();
				}else{
					document.formulario.accion.value=Valor;
					document.formulario.submit();
				}
			}else{
				alert('Imposible Entregar sin Cancelar Saldo Pendiente');
			}
		}
	}else{
		document.formulario.accion.value=Valor;
		document.formulario.submit();
	}
}

function Cerrar(){
	//window.opener.location=window.opener.location;
	window.parent.opener.cargardatos('');
	//self.close();
	return false
}

var scrollDivs=new Array();
scrollDivs[0]="productos";

function marcar(){
	if(document.formulario.ckb.checked){
		for(var i=0;i<document.formulario.Ingresos.length;i++){
			document.formulario.Ingresos[i].checked=true;
		}	
	}else{
		for(var i=0;i<document.formulario.Ingresos.length;i++){
			document.formulario.Ingresos[i].checked=false;
		}		
	}
}

function Estado(){
	Valor='';
	if(document.formulario.ckb.checked){
		Valor=document.formulario.ckb.value;
	}else{
		for(var i=0;i<document.formulario.Ingresos.length;i++){
			if (document.formulario.Ingresos[i].checked){
				Valor=Valor+''+document.formulario.Ingresos[i].value;
			}
		}	
	}
	if (window.opener && !window.opener.closed)
    window.opener.document.form1.Estado.value = Valor;
 	window.parent.opener.cargardatos('');
	//window.close();
}

function imprimir(cod){
	if(confirm("Desea Imprimir el Comprobante?")){
		window.parent.opener.imprimirdoc(cod);
		close();
	}else{
		Cerrar();
	}
}
</script>
<?php
if(isset($_REQUEST['accion']) && $_REQUEST['accion']=='TRS'){/*
?>
<body onLoad="imprimir('<?php echo $codref; ?>')" onUnload="vaciar_sesiones()">
</body>
<?php
*/ 
}else{
?>
	<body onLoad="carga_div()" onUnload="vaciar_sesiones()">
	<br>
	<form name="formulario" method="post" action="" enctype="multipart/form-data">
	<input name="accion" type="hidden" id="accion" value="" size="5">
	<?	  
	if ($Valor=='EST'){
	?> 
	<table width="500" border="0">
	<tr>
		<td width="10">&nbsp;</td>
		<td width="576" align="center" bgcolor="#F5F5F5"><span class="Estilo10">
		<? 
		if ($ventana=='tg'){ 
			echo 'ESTADO';
		}else{ 
			echo 'ESTADO DE ORDEN DE TRABAJO'; 
		}
		?></span></td>
		<td width="10">&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><table width="155" border="0" align="center">
		<tr>
			<td><span class="Estilo1">Todos</span></td>
			<td><input name="ckb" type="checkbox" id="ckb"  style="border: 0px; background-color:#F9F9F9; "  onClick="marcar()" value="T" ></td>
		</tr>
		<tr>
			<td width="94"><span class="Estilo1">Pendiente : </span></td>
			<td width="51"><label><input name="chkIngresos[]" type="checkbox" id="Ingresos"  style="border: 0px; background-color:#F9F9F9; " value="P" checked></label></td>
		</tr>
		<tr>
			<td><span class="Estilo1">Terminado : </span></td>
			<td><input name="chkIngresos[]" type="checkbox" id="Ingresos"  style="border: 0px; background-color:#F9F9F9; " value="and estadoOT=T"></td>
		</tr>
		<tr>
			<td><span class="Estilo1">Anulado :</span></td>
			<td><input name="chkIngresos[]" type="checkbox" id="Ingresos"  style="border: 0px; background-color:#F9F9F9; " value="and flag=A"></td>
		</tr>
		<tr>
			<td><span class="Estilo1">Observado : </span></td>
			<td><input name="chkIngresos[]" type="checkbox" id="Ingresos"  style="border: 0px; background-color:#F9F9F9; " value="and estadoOT=O"></td>
		</tr>
		</table></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align="center"><input type="button" name="Submit2" value="     Guardar    " onClick="Estado()">
		<input type="button" name="Submit22" value="     Cancelar   " onClick="Cerrar()"></td>
		<td>&nbsp;</td>
	</tr>
	</table>
	<?
	}elseif ($Valor=='OBS'){
	?>	 
	<table width="500" border="0">
	<tr>
		<td width="10">&nbsp;</td>
		<td align="center" bgcolor="#F5F5F5"><span class="Estilo10">
		<? 
		//if ($ventana=='tg' || $ventana='SegCaja'){ 
		echo 'OBSERVADO';
		//} else { 
		//echo 'ORDEN DE TRABAJO OBSERVADO'; }
		?>
		</span></td>
		<td width="19">&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><table width="343" border="0" align="center">
		<tr>
			<td width="94" valign="top"><span class="Estilo1">Observado : </span></td>
			<td width="239"><label><textarea name="txtObsr" cols="25" rows="5" id="txtObsr"><?=$rowC['notas'];?></textarea></label></td>
		</tr>
		</table></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align="center"><input type="button" name="Submit2" value="     Guardar    " onClick="guardar('O');Cerrar()"><input type="button" name="Submit22" value="     Cancelar   " onClick="Cerrar()"></td>
		<td>&nbsp;</td>
	</tr>
	</table>
	<?
	}elseif ($Valor=='ADJ'){
	?>
	<table width="500" border="0">
	<tr>
		<td width="10">&nbsp;</td>
		<td align="center" bgcolor="#F5F5F5"><span class="Estilo10">
		<? //if ($ventana=='tg'){ 
		echo 'ADJUNTAR DOCUMENTO';
		//} else { 
		//echo 'ADJUNTAR DOCUMENTO A ORDEN DE TRABAJO'; }
		?></span></td>
		<td width="19">&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><table width="360" border="0" align="center">
		<tr>
			<td width="99"><span class="Estilo1">Adjuntar archivo  : </span></td>
			<td width="251"><input name="archivo" type="file" id="archivo" /></td>
		</tr>
		</table></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align="center" style="color:#FF0000"><?php echo $status;?></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align="center"><input type="button" name="Submit2" value="     Guardar    " onClick="guardar('A');Cerrar();"><input type="button" name="Submit22" value="     Cancelar   " onClick="Cerrar()"></td>
		<td>&nbsp;</td>
	</tr>
	</table>
	<?
	}elseif ($Valor=='TER'){
	?>	 
	<table width="500" border="0">
	<tr>
		<td width="10">&nbsp;</td>
		<td align="center" bgcolor="#F5F5F5"><span class="Estilo10">
		<? 
		echo 'ASIGNACION A BANCO';
		?></span></td>
		<td width="19">&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><table width="343" border="0" align="center">
		<tr>
			<td width="94" valign="top"><span class="Estilo1">Responsable : </span></td>
			<td width="239">
			<?php
			$rs=mysql_query("Select * from usuarios",$cn);
			while($resp=mysql_fetch_array($rs)){
				if($rowC['cod_vendedor']==$resp['codigo']){
					echo $resp[1];
				}
			}
			?>
			</td>
		</tr>
		<tr>
			<td width="94" valign="top"><span class="Estilo1">Importe : </span></td>
			<td width="239"><select name="cbomon" id="cbomon">
			<?php 
			$sql21="Select * from moneda";
			$rs21=mysql_query($sql21,$cn);
			while($row21=mysql_fetch_array($rs21)){
				$vari="";
				if($rowC['moneda']==$row21['id']){
					$vari=" Selected";
				}
				echo "<option value='".$row21['id']."'".$vari.">".$row21['descripcion']."</option>";
			}
			?></select>&nbsp;&nbsp;&nbsp;<label><input type="text" value="<?=number_format($rowC['total'],2)?>" name="imptot" id="imptot" maxlength="10" size="10"></label>
			<?php
			if($rowC['cod_ope']=="S1"){
				$sql_pag=mysql_query("Select * from pagos where tipo='A' and referencia='".$rowC['cod_cab']."'",$cn);
				while($res_pag=mysql_fetch_array($sql_pag)){
					$monto=number_format($res_pag['monto'],2);
					if($rowC['moneda']=="02" && $res_pag['moneda']=="01"){
						$monto=number_format($res_pag['monto']/$res_pag['tcambio'],2);
					}
					if($rowC['moneda']=="01" && $res_pag['moneda']=="02"){
						$monto=number_format($res_pag['monto']*$res_pag['tcambio'],2);
					}
					$pago=$monto+$pago;
				}
				$saldo=number_format($rowC['total']-$pago,2);
				if($saldo>0){
					echo "<br><label style='color:#F00'><input type='checkbox' name='cancelar' value='cancelar'>Cancelar Saldo Pendiente: ".$saldo."</label><input type=hidden name=saldo_doc value=".$saldo.">";
				}
			}
			?></td>
		</tr>
		<?php
  		//}
        ?>
		<tr>
			<td width="94" valign="top"><span class="Estilo1">Acciones : </span></td>
			<td width="239"><label><textarea name="txtMoti" cols="30" rows="5" id="txtMoti"><? echo $rowC['obs1'];?></textarea></label></td>
		</tr>
		<?php
		$re="";
		$sql3=mysql_query("Select * from det_mov where cod_cab='".$rowC['cod_cab']."' and substr(nom_prod,1,8)='SERVICIO'");
		if(mysql_num_rows($sql3)>0){
			$sql4=mysql_query("Select nom_prod as prod,(Select substr(nom_prod,4) from det_mov where cod_cab='".$rowC['cod_cab']."' and substr(nom_prod,1,3)='S/N') as serie,(Select nom_prod from det_mov where cod_cab='".$rowC['cod_cab']."' and substr(nom_prod,1,3)!='S/N' and substr(nom_prod,1,8)!='SERVICIO') as producto from det_mov where cod_cab='".$rowC['cod_cab']."' AND SUBSTR(nom_prod,1,8)='SERVICIO' ");
			$row4=mysql_fetch_array($sql4);
			$re="<tr><td width=94 valign=top><span class=Estilo1>Servicio: </span></td><td width=239>".$row4['prod']."</td></tr><tr><td width=94 valign=top><span class=Estilo1>Producto: </span></td><td width=239>".$row4['producto']."</td></tr>";
			if($row4['serie']!=""){
				$re.="<tr><td width=94 valign=top><span class=Estilo1>Serie: </span></td><td width=239><input type=text name=sprod2 id=sprod2 value='".$row4['serie']."'></td></tr>";
			}else{
				$re.="<tr><td width=94 valign=top><span class=Estilo1>Serie: </span></td></tr>";
			}
		}else{
			//if($rowC['cod_ope']=="R1"){
			$rsp=mysql_query("Select * from det_mov where cod_cab='".$rowC['cod_cab']."'",$cn);
			while($rowp=mysql_fetch_array($rsp)){
				$cprod=$rowp['cod_prod'];
				$tprod=$rowp['tienda'];
				$rss=mysql_query("Select * from series where producto='$cprod' and tienda='$tprod' and salida='0' and estado='F'",$cn);
				$rspp=mysql_query("Select * from producto where idproducto='$cprod'",$cn);
				$rowpp=mysql_fetch_array($rspp);
			}
			$re="<tr><td width=94 valign=top><span class=Estilo1>Producto: </span></td><td width=239>".$rowpp['nombre']."</td></tr>";
			if(mysql_num_rows($rss)>0){
				$re="<tr><td width=94 valign=top><span class=Estilo1>serie: </span></td><td width=239><select name=sprod id=sprod>";
				while($rows=mysql_fetch_array($rss)){
					$re.="<option value='".$rows['serie']."'>".$rows['serie']."</option>";
				}
				$re.="</select></td></tr>";
			}
		}
		echo $re;
		?>
		<tr>
			<td><span class="Estilo1">Fec. T&eacute;rmino : </span></td>
			<td><input name="fec1" type="text" size="10" maxlength="50" value="<?php echo date('d-m-Y')?>"><button type="reset" id="f_trigger_b2"  style="height:18" >...</button>
				<script type="text/javascript">
				Calendar.setup({
					inputField     :    "fec1",      
					ifFormat       :    "%d-%m-%Y",      
					showsTime      :    true,            
					button         :    "f_trigger_b2",   
					singleClick    :    true,           
					step           :    1                
				});
				</script></td>
		</tr>
		</table></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align="center">	  
		<? 
		if($ventana=='tg'){
		?>
		<input onClick="guardar('TRS');" type="button" name="Submit2" value="     Guardar    ">
		<? 
		}else{
		?>
		<input onClick="guardar('T');Cerrar();" type="button" name="Submit2" value="     Guardar    ">
		<?
        }
		?>
		<input type="button" name="Submit22" value="     Cancelar   " onClick="Cerrar()"></td>
		<td>&nbsp;</td>
	</tr>
	</table>
	<?
	}elseif ($Valor=='CON'){
	?>
	<table width="500" border="0">
	<tr>
		<td width="10">&nbsp;</td>
		<td align="center" bgcolor="#F5F5F5"><span class="Estilo10">CONSOLIDA EN UNIDADES Y TOTALES</span></td>
		<td width="19">&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><table width="100%" border="0" cellpadding="1" cellspacing="1">
		<tr>
			<td colspan="7">&nbsp;</td>
		</tr>
		<tr style="background:url(../imagenes/bg_contentbase2.gif);  background-position:100% 40%;">
			<td width="67" align="center" ><span class="Estilo24 Estilo11">Cod. Anex. </span></td>
			<td width="159" ><span class="Estilo24 Estilo11">Producto</span></td>
			<td width="36" align="center" ><span class="Estilo24 Estilo11">Und.</span></td>
			<td width="42" align="center" ><span class="Estilo24 Estilo11">Cant.</span></td>
			<td width="30" align="right" ><span class="Estilo24 Estilo11">Mod.</span></td>
			<td width="43" align="right" ><span class="Estilo24 Estilo11">P.Unit</span></td>
			<td width="58" align="right" ><span class="Estilo24 Estilo11">Total</span></td>
		</tr>
		<?php 
		$totalC;
		//$strSQL4="select cantidad,cod_prod,nom_prod,precio,unidad  from det_mov where cod_cab='".$codigo."' order by cod_det";
		$strSQL4="select cantidad,cod_prod,nom_prod,precio,unidad,moneda  from det_mov where cod_cab in (".$codigo.")   order by cod_det";
		$resultado4=mysql_query($strSQL4,$cn);
		// echo $strSQL4;
		$nitems=0;
		while($row4=mysql_fetch_array($resultado4)){
			$nitems=$nitems+1;
		?>
        <tr>
			<td valign="top" bgcolor="#EFEFEF" class="Estilo7" ><?php echo substr($row4['cod_prod'],0,50);?></td>
			<td bgcolor="#EFEFEF"><span class="Estilo7"><?php echo substr($row4['nom_prod'],0,50);?></span><span class="Estilo7" style="color:#0066FF; font-family:Arial, Helvetica, sans-serif; font-size:9px"><br>
			<?php
			$sqlx="SELECT serie from series WHERE producto=".$row4['cod_prod']." and tienda='".$codtienda."' and (ingreso ='".$referencia."' or salida='".$referencia."')";
			//echo $sqlx;
			$seriesx="";
			$resultadox=mysql_query($sqlx,$cn);
			if(mysql_num_rows($resultadox)){
				$c=0;
				while($rowx=mysql_fetch_array($resultadox)){
					$d=1;
					//$f=4*$d;
					if($c%4==0){
						$seriesx=$seriesx."<br>"; 
						$d++;
					}
					$seriesx=$seriesx.$rowx['serie'].",&nbsp;&nbsp;";	
					$c++;  
				}
				echo "Series::".$seriesx; 
			}
			?></span></p></td>
			<td valign="top"  align="center" bgcolor="#EFEFEF"><span class="Estilo7">
			<?php 
			$strUND="select * from unidades  where id='".$row4['unidad']."'";
			$resultadoUND=mysql_query($strUND,$cn);
			$rowUND=mysql_fetch_array($resultadoUND);
			echo $rowUND['nombre'];
			?></span></td>
			<td align="center" bgcolor="#EFEFEF" valign="top" ><span class="Estilo7">
			<?php 
			echo $row4['cantidad'];
			?></span></td>
			<td align="right" bgcolor="#EFEFEF" valign="top" >
			<?php 
			if ($row4['moneda']=='02'){
				echo 'US$.';
			}else{
				echo 'S/.';
			}	
			//echo $row4['moneda'];
			?></td>
			<td align="right" bgcolor="#EFEFEF" valign="top" ><span class="Estilo7">
			<?php 
			$strSQL40="select * from producto where idproducto='".$row4['cod_prod']."'";
			$resultado40=mysql_query($strSQL40,$cn);
			$row40=mysql_fetch_array($resultado40);
	
			$total=$row4['precio']*$row4['cantidad'];
			//	$importe=$importe+$total;
	
			if($_SESSION['nivel_usu']==2){
				echo '***';
			}else{
				echo number_format($row4['precio'],2);
			}
			?></span></td>
			<td align="right" valign="top"  bgcolor="#EFEFEF"><span class="Estilo7" >
			<?php 
			/*if ($row['moneda']==$moneda ||  $moneda == ''){
				echo  number_format($row['precio2'],2);	
			}else{
				if ($row['moneda']=='02'){
					echo  number_format($row['precio2'] * $_SESSION['tc'],2);					
				}
				if ($row['moneda']=='01'){
					echo  number_format($row['precio2'] / $_SESSION['tc'],2);	
				}				
			}*/
			if ($_SESSION['nivel_usu']==2){
				echo '***';
			}else{
				echo number_format($total,2);
				$totalC=$totalC+number_format($total,2);
			}
			?></span></td>
		</tr>
		<?php 
		}
	  	?>
		<tr>
			<td>&nbsp;</td>
			<td colspan="5" align="right"><span class="Estilo7">Total Consolidado <?php echo $simbolo;?> </span></td>
			<td align="right"><span class="Estilo2">
			<?php 
			if ($_SESSION['nivel_usu']==2){
				echo '***';
			}else{
				echo number_format($totalC,2);
			}	
			?></span></td>
		</tr>
		</table></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align="center"><input type="button" name="Submit22" value="     Cerrar   " onClick="self.close()"></td>
		<td>&nbsp;</td>
	</tr>
	</table>
	<?
	}elseif ($Valor=='LET'){
	?>	
    <table width="500" border="0">
	<tr>
		<td width="10">&nbsp;</td>
		<td align="center" bgcolor="#F5F5F5"><span class="Estilo10">
		<? 
		echo 'ASIGNACION A BANCO';
		?></span></td>
		<td width="19">&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><table border="0" align="center">
		<tr>
			<td width="117" valign="top"><span class="Estilo1">Responsable : </span></td>
			<td width="301">
			<?php
			$rs=mysql_query("Select * from usuarios",$cn);
			while($resp=mysql_fetch_array($rs)){
				if($rowC['codvendedor']==$resp['codigo']){
					echo $resp[1];
				}
			}
			?>
			</td>
		</tr>
        <tr>
			<td width="117" valign="top"><span class="Estilo1">
            <?php switch($rowC['tipo']){
				case '1':echo "Proveedor :";break;
				case '2':echo "Cliente :";break;
			}?></span></td>
			<td width="301"><?php echo $rowC['auxiliar'];?></td>
		</tr>
		<tr>
			<td width="117" valign="top"><span class="Estilo1">Importe : </span></td>
			<td width="301">
			<?php 
			$sql21="Select * from moneda";
			$rs21=mysql_query($sql21,$cn);
			$vari="";
			while($row21=mysql_fetch_array($rs21)){
				if($rowC['moneda']==$row21['id']){
					//$vari=" Selected";
					echo $vari=$row21['simbolo'];
				}
				//echo "<option value='".$row21['id']."'".$vari.">".$row21['descripcion']."</option>";
			}
			?>&nbsp;<label><?=number_format($rowC['importe'],2)?></label></td>
		</tr>
		<?php
  		//}
        ?>
		<tr>
			<td width="117" valign="top"><span class="Estilo1">Letras : </span></td>
			<td width="301"><label><? echo $rowC['canlet'];?></label></td>
		</tr>
        <tr>
			<td colspan="2" valign="top"><table border="1" bordercolor="#0000FF">
            <tr bgcolor="#CCCCCC">
            	<td width="70px"><span class="Estilo1">Letra</span></td>
                <td width="60px"><span class="Estilo1">F.Venc.</span></td>
                <td width="70px"><span class="Estilo1">Monto</span></td>
                <td width="100px"><span class="Estilo1">Banco</span></td>
                <td width="100px"><span class="Estilo1">N° de Banco</span></td>
			</tr>
            <?php
			$re="";
			$sql3=mysql_query("Select * from multi_det where multi_id='".$rowC['multi_id']."' order by det_id");
			while($rw_let=mysql_fetch_array($sql3)){
				if(($rw_let['monto']==$rw_let['saldo'])&& $rw_let['estado']==''){
					?>
					<tr>
						<td style="font-size:10px"><?=$rw_let['letra']?></td>
                        <td style="font-size:10px"><?=formatofecha($rw_let['fechavcto'])?></td>
                        <td style="font-size:10px"><?=$vari." ".number_format($rw_let['monto'],2)?></td>
                        <td style="font-size:10px"><select name="cbocta<?php echo $rw_let[1];?>" style="width:100px;" id="cbocta<?php echo $rw_let[1];?>">
						<?php 
						//$sql31=mysql_query("Select c.cta_id as id,concat(b.descrip,' (',m.simbolo,') ',c.ctabco) as cuenta from cuentas c inner join bancos b on c.banco_id=b.id inner join moneda m on m.id=c.moneda where c.empresa='".$rowC['cod_suc']."'",$cn);
						$sql31=mysql_query("Select * from bancos",$cn);
						if($rowC['banco_id']=='0'){
							echo "<option value=''>Seleccione</option>";
						}
						$sd="";
						while($rw31=mysql_fetch_array($sql31)){
							$sd="";
							//if($rw31['id']==$rowC['banco_id']){
							if($rw31['id']==$rw_let['banco_id']){	
								$sd=" Selected";
							}
							echo "<option value='".$rw31['id']."'".$sd.">".$rw31['descrip']."</option>";
						}
                        ?></select></td>
                        <td><input type="text" style="width:100px;" name="nrobco<?php echo $rw_let[1];?>" id="nrobco<?php echo $rw_let[1];?>" value="<?php echo $rw_let['numbco'];?>"></td>
					</tr>
                    <?php
				}else{
					$sty="";
					if($rw_let['monto']!=$rw_let['saldo']){
						$sty="style='background-color:#00F'";
					}
					if($rw_let['estado']=='A'){
						$sty="style='text-decoration:line-through;background-color:#F00;'";
					}
					if($rw_let['estado']=='P'){
						$sty="style='background-color:#090'";
					}
				?>
					<tr <?=$sty;?>>
						<td style="font-size:10px;color:#FFF;"><?=$rw_let['letra']?></td>
                        <td style="font-size:10px;color:#FFF;"><?=formatofecha($rw_let['fechavcto'])?></td>
                        <td style="font-size:10px;color:#FFF;"><?=$vari." ".number_format($rw_let['monto'],2)?></td>
                        <td style="font-size:10px;color:#FFF;"><?php 
						echo "-";
                        ?></select></td>
                        <td style="font-size:10px;color:#FFF;"><?php echo $rw_let['numbco'];?></td>
					</tr>
                    <?php
				}
			}?>
            </table></td>
		</tr>
        <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td width="1">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2"><table border="0">
			<tr>
            	<td width="60">LEYENDA:</td>
				<td width="59" bgcolor="#FF0000" style="text-decoration:line-through; color:#FFF"> Anulado</td>
			</tr>
            <tr>
            	<td>&nbsp;</td>
				<td bgcolor="#0000FF" style="color:#FFF"> Con Pagos</td>
			</tr>
            <tr>
            	<td>&nbsp;</td>
				<td bgcolor="#009900" style="color:#FFF"> Protestado</td>
			</tr>
            <tr>
            	<td>&nbsp;</td>
				<td> Sin Movimiento</td>
			</tr>
            </table></td>
		</tr>
		</table></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align="center">	  
		<? 
		if($ventana=='tg'){
		?>
		<input onClick="guardar('TRS');" type="button" name="Submit2" value="     Guardar    ">
		<? 
		}else{
		?>
		<input onClick="guardar('L');Cerrar();" type="button" name="Submit2" value="     Guardar    ">
		<?
        }
		?>
		<input type="button" name="Submit22" value="     Cancelar   " onClick="Cerrar()"></td>
		<td>&nbsp;</td>
	</tr>
	</table>
	<? 
	}
	?>
	<div id="productos" style="position:absolute; left:114px; top:139px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>
</form>
</body>
<?php
}
?>

</html>

<script>
function cambiar_chofer(param){
	doAjax('../peticion_ajax2.php','&peticion=mostrar_chofer&tabla='+param,'listaProd','get','0','1','','');
}

function listaProd(texto){
	//alert(texto);
	//document.getElementById('productos').style.zIndex='100';
	document.getElementById('productos').innerHTML=texto;
	document.getElementById('productos').style.visibility="visible";
}

function sel_chofer(codigo,nombre){
	document.formulario.codprod.value=codigo;
	document.formulario.desprod.value=nombre;
	salir();
}

function salir(){
	document.getElementById('productos').style.visibility="hidden";
	document.formulario.cantidad.focus();
}

var temp2="";
function entrada(objeto){
	//objeto.cells[0].childNodes[0].checked=true;
	//temp=objeto;
	if(objeto.style.background=='url(../imagenes/sky_blue_sel.png)'){
		//objeto.style.background=objeto.bgColor;
	}else{
		objeto.style.background='url(../imagenes/sky_blue_sel.png)';
		if(temp2!=''){
			//alert(temp.style.background);
			//alert(objeto.bgColor);
			temp2.style.background=temp2.bgColor;
		}
		temp2=objeto;
	}
}

function busqueda_chofer(pag){
	var tabla="P";
	var valor=document.formulario.valor_chofer.value;
	doAjax('../peticion_ajax2.php','&peticion=buscar_chofer&valor='+valor+'&tabla='+tabla+'&pag='+pag,'mostrar_bus_chofer','get','0','1','','');
}

function cargar_datos(pag){
	busqueda_chofer(pag);
}

function mostrar_bus_chofer(texto){
	temp=texto.split("~");
	document.getElementById('detalle_chofer').innerHTML=temp[0];
	document.getElementById('divpagina').innerHTML=temp[1];
}

function insertMat(){
	var codprod=document.formulario.codprod.value;
	var desprod=document.formulario.desprod.value;
	var cantidad=document.formulario.cantidad.value;
	doAjax('../peticion_ajax2.php','&peticion=detSalMat&codprod='+codprod+'&desprod='+desprod+'&cantidad='+cantidad,'rspta_detSalMat','get','0','1','','');
}

function rspta_detSalMat(texto){
	document.getElementById('detSalMat').innerHTML=texto;
	document.formulario.codprod.value="";
	document.formulario.desprod.value="";
	document.formulario.cantidad.value="";
	document.formulario.desprod.focus();
}

function vaciar_sesiones(){
	doAjax('../peticion_ajax2.php','&peticion=detSalMat&accion=salir','','get','0','1','','');
}

function eliminar(item){
	doAjax('../peticion_ajax2.php','&peticion=detSalMat&accion=eliminar&item='+item,'rspta_detSalMat','get','0','1','','');
}
</script>