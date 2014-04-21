<?
$codigo = $_REQUEST['CodDoc'];
$Valor = $_REQUEST['Fun'];
session_start();
include("../conex_inicial.php");
include('../funciones/funciones.php');
		
	$fec1=$_REQUEST['fec1'];
	$txtMoti=$_REQUEST['txtMoti'];
	$txtObsr=$_REQUEST['txtObsr'];
	$ventana=$_REQUEST['ventana'];
	
	
if($_REQUEST['accion']=='TRS'){

	$strSQL02=" UPDATE  cab_mov SET f_venc='".formatofecha($fec1)."', motivo='".$txtMoti."',estadoOT= 'T' WHERE cod_cab='".$codigo."'  ";
	mysql_query($strSQL02,$cn);
	
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

	 $strSQL03=" INSERT INTO cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,caja,
	cliente,ruc,fecha,f_venc,moneda,impto1,tc,b_imp,igv,servicio
	,percepcion,total,saldo,tienda,sucursal,condicion,kardex) SELECT '".$codref."','2','".$ope1."2','".$numdoc1."','001', cod_vendedor,caja,cliente,ruc,fecha,f_venc,moneda,impto1,tc,b_imp,igv,servicio ,percepcion,total,saldo,tienda,sucursal,condicion,kardex  FROM cab_mov WHERE cod_cab='".$codigo."'  ";
	mysql_query($strSQL03,$cn);
	//detalle

	 $strSQL04=" INSERT INTO det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,codanex,nom_prod,unidad,tcambio,moneda,precio,cantidad,imp_item,precosto,flag_percep,porcen_percep,notas,fechad,descargo,afectoigv,flag_kardex,costo_inven,saldo_actual,ancho,largo,mt2,factor,descOT,descOT_porc) 	
	SELECT '".$codref."','2','".$ope1."2',serie,numero,auxiliar,tienda,sucursal,cod_prod,codanex,nom_prod,unidad,tcambio,moneda,precio,cantidad,imp_item,precosto,flag_percep,porcen_percep,notas,fechad,descargo,afectoigv,flag_kardex,costo_inven,saldo_actual,ancho,largo,mt2,factor,descOT,descOT_porc FROM det_mov WHERE cod_cab='".$codigo."'  ";
	mysql_query($strSQL04,$cn);

	 $strSQL05=" INSERT INTO referencia(cod_cab,serie,correlativo,cod_cab_ref) VALUES('".$codigo."','001','".$numdoc1."','".$codref."')  ";
	mysql_query($strSQL05,$cn);
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
	 }	
	
	
}
if($_REQUEST['accion']=='T'){

	echo $strSQL02=" UPDATE  cab_mov SET f_venc='".formatofecha($fec1)."', motivo='".$txtMoti."',estadoOT= 'T' WHERE cod_cab='".$codigo."'  ";
	mysql_query($strSQL02,$cn);
	
	//---------------------------------------GENERAR OT------------------------------------------------------
	
    list($tipomov,$doc,$numero,$serie,$responsable,$caja,$auxiliar,$ruc,$femision,$fvencimiento,$moneda,$impto,$tipoCam,$monto,$impuesto1,$servicio,$percepcion,$total_doc,$saldo,$tienda,$sucursal,$flag,$flag_r,$motivo,$noperacion,$items,$condicion,$incluidoigv,$obs1,$obs2,$obs3,$obs4,$obs5,$permiso4,$fecha_aud,$pcingresox,$permiso10,$deuda,$transportista,$chofer,$dirPartida,$dirDestino,$numeroOT,$fecharegis)=mysql_fetch_row(mysql_query("select  tipo,cod_ope,Num_doc,serie,cod_vendedor,caja,cliente,ruc,fecha,f_venc,moneda,impto1,tc,b_imp,igv,servicio,percepcion,total,saldo,tienda,sucursal,flag,flag_r,motivo,noperacion,items,condicion,incluidoigv,obs1,obs2,obs3,obs4,obs5,inafecto,fecha_aud,pc,kardex,deuda,transportista,chofer,dirPartida,dirDestino,numeroOT,fecharegis from cab_mov where cod_cab='".$codigo."'"));

		$strSQL="select  max(cod_cab) as cod_cab from cab_mov";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$codigoOT=$row['cod_cab']+1;
		
		$strSQL="select  max(Num_doc) as Num_doc from cab_mov where serie='".$serie."' and cod_ope='OT'";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$correlativoOT=str_pad($row['Num_doc']+1, 7, "0", STR_PAD_LEFT);	

	$strSQL3="insert into cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,caja,cliente,ruc,fecha,f_venc,moneda,impto1,tc,b_imp,igv,servicio,percepcion,total,saldo,tienda,sucursal,flag,flag_r,motivo,noperacion,items,condicion,incluidoigv,obs1,obs2,obs3,obs4,obs5,inafecto,fecha_aud,pc,kardex,deuda,transportista,chofer,dirPartida,dirDestino,numeroOT,fecharegis)values('".$codigoOT."','".$tipomov."','OT','".$correlativoOT."','".$serie."','".$responsable."','".$caja."','".$auxiliar."','".$ruc."','".gmdate('Y-m-d H:i:s',time()-18000)."','".gmdate('Y-m-d H:i:s',time()-18000)."','".$moneda."','".$impto."','".$tipoCam."','".$monto."','".$impuesto1."','".$servicio."','".$percepcion."','".$total_doc."','".$saldo."','".$tienda."','".$sucursal."','".$flag."','".$flag_r."','".$motivo."','".$noperacion."','".$items."','".$condicion."','".$incluidoigv."','".$obs1."','".$obs2."','".$obs3."','".$obs4."','".$obs5."','".$permiso4."','".gmdate('Y-m-d H:i:s',time()-18000)."','".$pcingresox."','".$permiso10."','".$deuda."','".$transportista."','".$chofer."','".$dirPartida."','".$dirDestino."','".$numeroOT."','".$fecharegis."')"; 
		
	mysql_query($strSQL3,$cn);
		
		
		$strSQL="select * from det_mov where cod_cab='".$codigo."'";
		//echo $strSQL;
		$resultado=mysql_query($strSQL,$cn);
		while($row=mysql_fetch_array($resultado)){
		
		
		$strSQL444="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,tcambio,moneda,precio,cantidad,imp_item,fechad,descargo,afectoigv,costo_inven,saldo_actual,notas,flag_kardex,unidad,flag_percep,porcen_percep,ancho,largo,mt2,factor,descOT,codanex,desc1) values('".$codigoOT."','".$tipomov."','OT','".$serie."','".$correlativoOT."','".$auxiliar."','".$tienda."','".$sucursal."','".$row['cod_prod']."','".addslashes($row['nom_prod'])."','".$row['tcambio']."','".$row['moneda']."','".$row['precio']."','".$row['cantidad']."','".$row['imp_item']."','".gmdate('Y-m-d H:i:s',time()-18000)."','".$row['descargo']."','".$row['afectoigv']."','".$row['costo_inven']."','".$row['saldo_actual']."','".$row['notas']."','".$row['flag_kardex']."','".$row['unidad']."','".$row['flag_percep']."','".$row['porcen_percep']."','".$row['ancho']."','".$row['largo']."','".$row['mt2']."','".$row['factor']."','".$row['descOT']."','".$row['codanex']."','".$row['desc1']."')"; 
		  	  
		mysql_query($strSQL444,$cn);
				
		}
		
		$strSQL0025="select  max(id) as id from referencia";
		$resultado0025=mysql_query($strSQL0025,$cn);
		$row0025=mysql_fetch_array($resultado0025);
		$codigo_ref=$row0025['id']+1;
		
		$strSQL_ref="insert into referencia (id,cod_cab,serie,correlativo,cod_cab_ref)values('".$codigo_ref."','".$codigoOT."','".$serie."','".$numero."','".$codigo."')";	
		mysql_query($strSQL_ref,$cn);
		
		
		
	//-------------------------------------------------------------------------------------------------------	
	
	
		
		
	//--------------------------------------------------------------------------------------------------------	
	
	
}
if($_REQUEST['accion']=='O'){
	$strSQL02=" UPDATE  cab_mov SET obs1='".$txtObsr."' WHERE cod_cab='".$codigo."'  ";
	mysql_query($strSQL02,$cn);
}
if($_REQUEST['accion']=='A'){
	
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
		$strSQL02=" UPDATE  cab_mov SET archivo='".$destino."' WHERE cod_cab='".$codigo."'  ";
		mysql_query($strSQL02,$cn);
		} else {
			$status = "Error al subir el archivo";
		}
	} else {
		$status = "Error al subir archivo";
	}

}

// cargara datos 
$SQL="select * from cab_mov where cod_cab='".$codigo."' ";
	$Resul=mysql_query($SQL,$cn);
	$rowC=mysql_fetch_array($Resul);
	//echo $rowC['obs1'];	
	
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
function guardar(Valor){
	document.formulario.accion.value=Valor;
	document.formulario.submit();
}
function Cerrar(){
	//window.opener.location=window.opener.location;
	window.parent.opener.cargardatos('');
	self.close();
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
	window.close();
}

</script>
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
		 <? if ($ventana=='tg'){ 
		 echo 'ESTADO';
		 } else { 
		 echo 'ESTADO DE ORDEN DE TRABAJO'; }?></td>
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
               <td width="51"><label>
                 <input name="chkIngresos[]" type="checkbox" id="Ingresos"  style="border: 0px; background-color:#F9F9F9; " value="P" checked>
               </label></td>
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
		 
		 if ($ventana=='tg' || $ventana='SegCaja'){ 
		 echo 'OBSERVADO';
		 } else { 
		 echo 'ORDEN DE TRABAJO OBSERVADO'; }
		 
		 ?>
		 
		 </td>
         <td width="19">&nbsp;</td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td><table width="343" border="0" align="center">
             <tr>
               <td width="94" valign="top"><span class="Estilo1">Observado : </span></td>
               <td width="239"><label>
                 <textarea name="txtObsr" cols="25" rows="5" id="txtObsr"><?=$rowC['obs1'];?></textarea>
               </label></td>
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
         <td align="center"><input type="button" name="Submit2" value="     Guardar    " onClick="guardar('O')">
      <input type="button" name="Submit22" value="     Cancelar   " onClick="Cerrar()"></td>
         <td>&nbsp;</td>
       </tr>
     </table>
  <?
   }elseif ($Valor=='ADJ'){
  ?>
     <table width="500" border="0">
       <tr>
         <td width="10">&nbsp;</td>
         <td align="center" bgcolor="#F5F5F5"><span class="Estilo10"><? if ($ventana=='tg'){ 
		 echo 'ADJUNTAR DOCUMENTO';
		 } else { 
		 echo 'ADJUNTAR DOCUMENTO A ORDEN DE TRABAJO'; }?></td>
         <td width="19">&nbsp;</td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td><table width="360" border="0" align="center">
             <tr>
               <td width="99"><span class="Estilo1">Adjuntar archivo  : </span></td>
               <td width="251">
			   <input name="archivo" type="file" id="archivo" /></td>
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
         <td align="center">
		 <input type="button" name="Submit2" value="     Guardar    " onClick="guardar('A')">
      <input type="button" name="Submit22" value="     Cancelar   " onClick="Cerrar()"></td>
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
	   if ($ventana=='tg'){ 
		 echo 'ENTREGA O REPOSICIÓN';
		 }elseif ($ventana=='ts'){ 
		 echo 'APROBAR TRANSFERENCIA ';
		 }elseif($ventana=='SegCaja') {
		  echo 'Aprobar Documento'; 
		  }elseif($ventana=='PO') {
		  echo ' APROBAR PRESUPUESTO '; 
		  }else{
		  echo 'TERMINAR ORDEN DE TRABAJO'; 
		 }?></td>
       <td width="19">&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td><table width="343" border="0" align="center">
         <tr>
           <td width="94" valign="top"><span class="Estilo1">Motivo : </span></td>
           <td width="239"><label>
             <textarea name="txtMoti" cols="30" rows="5" id="txtMoti"><?=$rowC['motivo'];?></textarea>
           </label></td>
          </tr>
         <tr>
           <td><span class="Estilo1">Fecha : </span></td>
           <td><input name="fec1" type="text" size="10" maxlength="50" value="<?php echo date('d-m-Y')?>"  >
                <button type="reset" id="f_trigger_b2"  style="height:18" >...</button>
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
	   <? if($ventana=='tg'){	   ?>
<input onClick="guardar('TRS');Cerrar();" type="button" name="Submit2" value="     Guardar    ">
	<?	   }else{	?>
<input onClick="guardar('T');Cerrar();" type="button" name="Submit2" value="     Guardar    ">
	<?  }?>
	   
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
         <td>
		<table width="100%" border="0" cellpadding="1" cellspacing="1">
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
	  $strSQL4="select cantidad,cod_prod,nom_prod,precio,unidad,moneda  from det_mov where cod_cab in (".$codigo."0)   order by cod_det";
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
	  ?>
	   <?php echo "Series::".$seriesx; } ?></span></p></td>
        <td valign="top"  align="center" bgcolor="#EFEFEF"><span class="Estilo7"><?php 
		$strUND="select * from unidades  where id='".$row4['unidad']."'";
		$resultadoUND=mysql_query($strUND,$cn);
		$rowUND=mysql_fetch_array($resultadoUND);
		 echo $rowUND['nombre'];

			
		?></span></td>
        <td align="center" bgcolor="#EFEFEF" valign="top" ><span class="Estilo7"><?php echo $row4['cantidad'];?></span></td>
        <td align="right" bgcolor="#EFEFEF" valign="top" ><?php 
			  if ($row4['moneda']=='02'){echo 'US$.';}else{echo 'S/.';}	
		//echo $row4['moneda'];?></td>
        <td align="right" bgcolor="#EFEFEF" valign="top" ><span class="Estilo7"><?php 
	
	$strSQL40="select * from producto where idproducto='".$row4['cod_prod']."'";
 $resultado40=mysql_query($strSQL40,$cn);
	$row40=mysql_fetch_array($resultado40);
	
	$total=$row4['precio']*$row4['cantidad'];
//	$importe=$importe+$total;
	
	if ($_SESSION['nivel_usu']==2){
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
			  }*/?>
		<?php 
		if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	echo number_format($total,2);
	$totalC=$totalC+number_format($total,2);
	}
		 ?></span></td>
      </tr>
	  <?php }
	  
	  if($inafecto=='N'){
	  ?>
	  <?php  }?>
	  
      <tr>
        <td>&nbsp;</td>
        <td colspan="5" align="right"><span class="Estilo7">Total Consolidado <?php echo $simbolo;?> </span></td>
        <td align="right"><span class="Estilo2"><?php 
		if ($_SESSION['nivel_usu']==2){
	echo '***';
	}else{
	echo number_format($totalC,2);
	}	
		?></span></td>
      </tr>
    </table> 
		 
		 
		 </td>
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
      <input type="button" name="Submit22" value="     Cerrar   " onClick="self.close()"></td>
         <td>&nbsp;</td>
       </tr>
     </table>
   <?
   	  }
   ?>
     <div id="productos" style="position:absolute; left:114px; top:139px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>
</form>
</body>


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
