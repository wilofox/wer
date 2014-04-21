<?php 
session_start();
include("../conex_inicial.php");
include('../funciones/funciones.php');

 $codigo = $_REQUEST['CodDoc'];
 $txtFec = $_REQUEST['txtFec'];

 $tipodoc="2";
 $doc=$_REQUEST['doc'];
 $numero=$_REQUEST['numero'];
 $serie=$_REQUEST['serie'];
 $cod_vendedor=$_REQUEST['cod_vendedor'];
 $cliente=$_REQUEST['cliente'];
 $txtFecI=$_REQUEST['txtFecI'];
 $txtFecT=$_REQUEST['txtFecT'];
 $tienda=$_REQUEST['tienda'];
 $sucursal=$_REQUEST['sucursal'];
 $condicion=$_REQUEST['condicion'];
 $descripcion=$_REQUEST['descrip'];
 $observacion=$_REQUEST['observacion'];
 $fec_hor_act=date('Y-m-d H:i:s',time()-3600);
 //$_REQUEST['accion'];

//$strSQL01="select max(numero) as numero from tempdoc where sucursal='".$sucursal."' and tipodoc='".$tipodoc."' and doc='".$doc."' and serie='".$serie."' ";
if($_REQUEST['accion']=='C'){
$strSQL01="select max(Num_doc) as numero from cab_mov where tipo='".$tipodoc."' and cod_ope='". $doc."' and serie='".$serie."' ";
	$resultado01=mysql_query($strSQL01,$cn);
	$row01=mysql_fetch_array($resultado01);
	$numero=str_pad($row01['numero']+1, 7, "0", STR_PAD_LEFT);
 	$strSQL01="select moneda as mon from operacion where codigo='". $doc."' ";
 $resultado01=mysql_query($strSQL01,$cn);
	$row01=mysql_fetch_array($resultado01);
 echo  " <input readonly='readonly' name='num_correlativo' id='num_correlativo' type='text' size='10' maxlength='7' value='$numero'>|".$row01['mon'];
}

if($_REQUEST['accion']=='G'){
				
				$fec_hor_act=date('Y-m-d H:i:s',time()-3600);
				$moneda=$_REQUEST['moneda'];
				$total=0;
				$strSQL04="select  max(cod_cab) as id from cab_mov";
				$resultado04=mysql_query($strSQL04,$cn);
				$row04=mysql_fetch_array($resultado04);
				$cod_cab=$row04['id']+1;
				
				switch($doc){
					case 'R1':$kardex='S';$fkardex='1';$deuda='S';break;
					case 'S1':$kardex='';$fkardex='';$deuda='S';break;
					case 'R2':$kardex='S';$fkardex='2';$deuda='N';break;
					case 'S2':$kardex='';$fkardex='';$deuda='N';break;
				}
				/*
				if ($doc=='R1'){
				  $kardex='S';
				}*/
			
			$strSQL05="insert into cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,cliente,fecha,f_venc,tienda,sucursal,condicion,kardex,moneda,impto1,tc,incluidoigv,inafecto,fecha_aud,pc,usuario,deuda,obs1,obs2) values('".$cod_cab."','".$tipodoc."','".$doc."','".$numero."','".$serie."','".$cod_vendedor."','".$cliente."','".formatofecha($txtFecI)."','".formatofecha($txtFecT)."','".$tienda."','".$sucursal."','".$condicion."','$kardex','$moneda','18','".$_SESSION['tc']."','S','N','$fec_hor_act','".$_SESSION['pc_ingreso']."','".$_SESSION['codvendedor']."','$deuda','".$observacion."','".$descripcion."')";

			mysql_query($strSQL05,$cn);
								
			
			$unidad="07";
			$d=0;
			//foreach ($_SESSION['xcodprod'] as $subkey=> $subvalue) {			$_SESSION['xcodprod'][$subkey]
			foreach ($_SESSION['garantias'][0] as $subkey=> $subvalue) {
			//consulta si tines descargo
			$strSQLPr="select * from producto 
			where idproducto='".$_SESSION['garantias'][1][$subkey]."'  ";
			$resultadoPr=mysql_query($strSQLPr,$cn);
			$rowPr=mysql_fetch_array($resultadoPr);
			if($_SESSION['garantias'][5][$subkey]==''){
				$_SESSION['garantias'][5][$subkey]='0.00';
			}
			if($_SESSION['garantias'][1][$subkey]=="TEXTO"){
				$descrip=$_SESSION['garantias'][2][$subkey];
				$d=1;
			}else{
				$descrip=$rowPr['nombre'];
			}
			$strSQL06="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,unidad,cantidad,descargo,flag_kardex,afectoigv,imp_item,precio,moneda,tcambio,fechad,codanex,desc1,precosto,porcen_percep,notas,costo_inven,saldo_actual,ancho,largo,mt2,factor,descOT,descOT_porc) values('".$cod_cab."','".$tipodoc."','".$doc."','".$serie."','".$numero."','".$cliente."','".$tienda."','".$sucursal."','".$_SESSION['garantias'][1][$subkey]."','".$descrip."','".$unidad."','".$_SESSION['garantias'][3][$subkey]."','".$rowPr['kardex']."','$fkardex','S','".$_SESSION['garantias'][5][$subkey]."','".$_SESSION['garantias'][5][$subkey]."','$moneda','".$_SESSION['tc']."','$fec_hor_act','','','0.00','0.00','','0.00','0','0','0','0','0','','')";
			$total=$total+number_format($_SESSION['garantias'][5][$subkey],2,".","");
			mysql_query($strSQL06,$cn);
			if(isset($_REQUEST['serie_tec']) && $_REQUEST['serie_tec']!="" && $subkey>0 && ($d==0 || $doc=="S1")){
				$strSQL06="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,unidad,cantidad,descargo,flag_kardex,afectoigv,imp_item,precio,moneda,tcambio,fechad,codanex,desc1,precosto,porcen_percep,notas,costo_inven,saldo_actual,ancho,largo,mt2,factor,descOT,descOT_porc) values('".$cod_cab."','".$tipodoc."','".$doc."','".$serie."','".$numero."','".$cliente."','".$tienda."','".$sucursal."','','S/N ".$_REQUEST['serie_tec']."','','','','$fkardex','S','0.00','0.00','$moneda','".$_SESSION['tc']."','$fec_hor_act','','','0.00','0.00','','0.00','0','0','0','0','0','','')";
				mysql_query($strSQL06,$cn);
				$d=1;
			}
			//echo $strSQL06;
			
			}
			
	 if ($doc=='R1' || $doc=='R2'){
	 // consulta si e producto maneja descargo
		 	$strSQL01="select * from producto where idproducto='".$_SESSION['garantias'][1][$subkey]."' and  kardex='S' ";
			$resultado01=mysql_query($strSQL01,$cn);
			$row01=mysql_fetch_array($resultado01);
			$CantPro=$row01['saldo'.$tienda.''];
			$CantPro=$CantPro+$_SESSION['garantias'][3][$subkey];
			
			
			$strSQL07="UPDATE producto SET saldo".$tienda." = '$CantPro' WHERE idproducto =".$_SESSION['garantias'][1][$subkey]."  and  kardex='S' ";
			mysql_query($strSQL07,$cn);
			//Verifico si el Producto Maneja Serie
			if($row01['series']=='S'){
				switch ($doc){
					case 'R1':
					if($_SESSION['garantias'][6][$subkey]==""){
						$subkey++;
					}
					$strSQL08="Insert into series(producto,serie,ingreso,salida,tienda,fing,fvenc,estado) Values('".$_SESSION['garantias'][1][$subkey]."','".$_SESSION['garantias'][6][$subkey]."','".$cod_cab."','0','".$tienda."','".formatofecha($txtFecI)."','".formatofecha($txtFecT)."','F')";break;
					case 'R2':$ing_cab=$_REQUEST['codref'];$strSQL08="Update series set salida='".$cod_cab."',estado='V' where tienda='".$tienda."' and serie='".$_SESSION['garantias'][6][$subkey]."' and producto='".$_SESSION['garantias'][1][$subkey]."' and ingreso='".$ing_cab."'";break;
				}
				mysql_query($strSQL08);
			}
			
			if(isset($_REQUEST['referencia'])){
				$cod_ref=$_REQUEST['cod_ref'];
				$ser_ref=$_REQUEST['serie_ref'];
				$cor_ref=str_pad($_REQUEST['cor_ref'],7,"0",STR_PAD_LEFT);
				$sql0=mysql_fetch_array(mysql_query("Select flag_r from cab_mov where cod_cab=$cod_ref"));
				mysql_query("Update cab_mov set flag_r='".$sql0[0]."RO' where cod_cab=$cod_ref");
				mysql_query("Update cab_mov set flag_r='RA' where cod_cab=$cod_cab");
				mysql_query("Insert into referencia(cod_cab,serie,correlativo,cod_cab_ref) values('$cod_cab', '$ser_ref', '$cor_ref','$cod_ref')");
			}
			//echo "Guardado ..";//.$_SESSION['garantias'][1][$subkey];		
	}
	//Calculo Totales
	$b_imp=number_format($total/1.18,2,".","");
	$igv=number_format($total-$b_imp,2,".","");
	$total=number_format($b_imp+$igv,2,".","");
	mysql_query("Update cab_mov set b_imp='$b_imp', igv='$igv', total='$total' where cod_cab=$cod_cab");
	echo $cod_cab;
}
if(isset($_REQUEST['grabar_pagos'])){
	//echo print_r($_SESSION['pagos'][1])."<br>".print_r($_SESSION['pagos'][2])."<br>".print_r($_SESSION['pagos'][3])."<br>".print_r($_SESSION['pagos'][4])."<br>".print_r($_SESSION['pagos'][5])."<br>".print_r($_SESSION['pagos'][6])."<br>".print_r($_SESSION['pagos'][7]);
	foreach ( $_SESSION['pagos'][0] as $subkey=> $subvalue) {
		  
			  $strSQL_pagos="select max(id) as id from pagos";
			  $resultado_pagos=mysql_query($strSQL_pagos,$cn);
			  $row_pagos=mysql_fetch_array($resultado_pagos);
			  $id_pagos=str_pad($row_pagos['id']+1, 6, "0", STR_PAD_LEFT);
			   
			   if($_SESSION['pagos'][6][$subkey]!='' && $_SESSION['pagos'][6][$subkey]!=0 ){
			   $montoPagos=number_format($_SESSION['pagos'][6][$subkey],2);
			   $monedaPagos="02";
			   }
			   if($_SESSION['pagos'][4][$subkey]!='' && $_SESSION['pagos'][4][$subkey]!=0 ){
			   $montoPagos=number_format($_SESSION['pagos'][4][$subkey],2);
			   $monedaPagos="01";
			   }
			   
			   	$codigo=$_REQUEST['CodDoc'];
			   	$vuelto=$_REQUEST['vuelto'];
			   	$moneda_v=$_REQUEST['moneda_v'];
				$fechae=formatofecha($_SESSION['pagos'][7][$subkey]);
				$fechav=formatofecha($_SESSION['pagos'][7][$subkey]);
									
			$strSQ_pagos3="insert into pagos(id,t_pago,fecha,fechav,monto,moneda,fechap,tcambio,referencia,vuelto,moneda_v) values ('".$id_pagos."','".$_SESSION['pagos'][2][$subkey]."','".formatofecha($_SESSION['pagos'][7][$subkey])."','".formatofecha($_SESSION['pagos'][7][$subkey])."',".$montoPagos.",'".$monedaPagos."','".$fec_hor_act."',".$_SESSION['tc'].",'".$codigo."','".$vuelto."','".$moneda_v."')";
					//echo $strSQ3;
			  mysql_query($strSQ_pagos3,$cn);
			
		}
		if($vuelto > 0.00){
			$strSQL_pagos="select max(id) as id from pagos";
			$resultado_pagos=mysql_query($strSQL_pagos,$cn);
			$row_pagos=mysql_fetch_array($resultado_pagos);
			$id_pagos=str_pad($row_pagos['id']+1, 6, "0", STR_PAD_LEFT);
			  
			$strSQ_pagos3="insert into pagos(id,tipo,t_pago,fecha,fechav,monto,moneda,fechap,tcambio,referencia,vuelto,moneda_v) values ('".$id_pagos."','C','1','".$fechae."','".$fechav."',".$vuelto.",'".$moneda_v."','".$fec_hor_act."',".$_SESSION['tc'].",'".$codigo."','0','')";
					//echo $strSQ3;
			mysql_query($strSQ_pagos3,$cn);
		}
}
switch($_REQUEST['peticion']){
	case "save_aux":	
	 
		/*$ruc=$_REQUEST['ruc'];
		$dni=$_REQUEST['dni'];
		$razon=$_REQUEST['razon'];
		$contacto=$_REQUEST['contacto'];
		$cargo=$_REQUEST['cargo'];
		$direccion=$_REQUEST['direccion'];
		$persona=$_REQUEST['persona'];
		$tipo_aux=$_REQUEST['tipo_aux'];
		$correo=$_REQUEST['correo'];		
		$telefono=$_REQUEST['telefono'];		
		
			$resultado3=mysql_query("select max(codcliente) as codigo from cliente",$cn);
			$row3=mysql_fetch_array($resultado3);
			
			$codigo=$row3['codigo'];
			$codigo=str_pad($codigo+1,6,'0',STR_PAD_LEFT);
		
		$tempAux=0;
		if($dni!=''){
		$resultado4=mysql_query("select * from cliente where doc_iden='".$dni."'",$cn);
		$tempAux=mysql_num_rows($resultado4);
		}
		if($ruc!=''){
		$resultado4=mysql_query("select * from cliente where ruc='".$ruc."'",$cn);
		$tempAux=mysql_num_rows($resultado4);
		}
							
		$strSQL="insert into cliente(codcliente,tipo_aux,razonsocial,ruc,t_persona,doc_iden,contacto,cargo,direccion,telefono,email) values('".$codigo."','".$tipo_aux."','".$razon."','".$ruc."','".$persona."','".$dni."','".$contacto."','".$cargo."','".$direccion."','".$telefono."','".$correo."') ";
		mysql_query($strSQL,$cn);
		
			 echo $codigo."?".$razon."?".$tempAux;*/
		$ruc=$_REQUEST['ruc'];
		$dni=$_REQUEST['dni'];
		$razon=$_REQUEST['razon'];
		$contacto=$_REQUEST['contacto'];
		$cargo=$_REQUEST['cargo'];
		$direccion=$_REQUEST['direccion'];
		$persona=$_REQUEST['persona'];
		$tipo_aux=$_REQUEST['tipo_aux'];
		$correo=$_REQUEST['correo'];
		$telefono=$_REQUEST['telefono'];
		$accionAux=$_REQUEST['accionAux'];
		$codClie=$_REQUEST['codClie'];
		
		$razon=str_replace('amps','&',$razon);
		
			$resultado3=mysql_query("select max(codcliente) as codigo from cliente",$cn);
			$row3=mysql_fetch_array($resultado3);
			
			$codigo=$row3['codigo'];
			$codigo=str_pad($codigo+1,6,'0',STR_PAD_LEFT);
		
		
		if($accionAux=='e'){
		$strSQL="update cliente set razonsocial='".$razon."',ruc='".$ruc."',t_persona='".$persona."',doc_iden='".$dni."',direccion='".$direccion."',email='".$correo."',telefono='".$telefono."' where codcliente='".$codClie."'";
		mysql_query($strSQL,$cn);
		$codigo=$codClie;
		}else{
			
			$tempAux=0;
			if($dni!=''){
			$resultado4=mysql_query("select * from cliente where doc_iden='".$dni."'",$cn);
			$tempAux=mysql_num_rows($resultado4);
			}
			if($ruc!=''){
			$resultado4=mysql_query("select * from cliente where ruc='".$ruc."'",$cn);
			$tempAux=mysql_num_rows($resultado4);
			}
							
		$strSQL="insert into cliente(codcliente,tipo_aux,razonsocial,ruc,t_persona,doc_iden,contacto,cargo,direccion,email,telefono) values('".$codigo."','".$tipo_aux."','".$razon."','".$ruc."','".$persona."','".$dni."','".$contacto."','".$cargo."','".$direccion."','".$correo."','".$telefono."') ";
		mysql_query($strSQL,$cn);
		}
		
		
			 echo $codigo."?".$razon."?".$tempAux."?".$strSQL;		 
		
	 break;
	 case 'historia':
	 	$pro=$_REQUEST['prod'];
		$cli=$_REQUEST['clie'];
		$doc=$_REQUEST['docu'];
		$ser=$_REQUEST['prodser'];
		if($ser==""){
			$sql="Select dm.* from det_mov dm inner join cab_mov cm on cm.cod_cab=dm.cod_cab where auxiliar=$cli and cod_prod=$pro and dm.cod_ope='$doc'";
		}else{
			$sql="Select dm.* from det_mov dm inner join cab_mov cm on cm.cod_cab=dm.cod_cab inner join series on series.ingreso=dm.cod_cab where auxiliar=$cli and cod_prod=$pro and dm.cod_ope='$doc' and series.serie='$ser'";
		}
		$con=mysql_query($sql,$cn);
		if(mysql_num_rows($con)>0){
	 		echo "existe";
		}else{
			echo "pasa";
		}
		break;
		
		case 'busca_historia':
			$servi=$_REQUEST['tservi'];
			$bclie=$_REQUEST['bcliente'];
			$clien=$_REQUEST['cliente'];
			$bprod=$_REQUEST['bproducto'];
			$produ=$_REQUEST['producto'];
			$subca=$_REQUEST['subcat'];
			$fechi=$_REQUEST['fecha1'];
			$fechf=$_REQUEST['fecha2'];
			$ser=$_REQUEST['series'];
			$filtro="";
			if($clien!="" && $clien!="todos"){
				switch($bclie){
					case 'razonsocial':$filtro.=" like '%".$clien."%'";$bclie="cl.".$bclie;break;
					case 'ruc':$filtro.=" like '".$clien."%'";break;
					default:$filtro.=" like '%".$clien."'";break;
				}
				$filtro=" and $bclie".$filtro;
			}
			//echo "<tr><td height='31'>".$filtro."</td></tr>";
			if($produ!=""){
				switch($bprod){
					case 'cod_prod2':$filtro.="and (SELECT producto.cod_prod FROM producto inner join det_mov on producto.idproducto=det_mov.cod_prod WHERE cod_cab=cab AND SUBSTR(nom_prod,1,3)!='S/N' and substr(nom_prod,1,8)!='SERVICIO' and (cm.cod_ope='R1' or cm.cod_ope='S1')) like '%".$produ."%'";break;
					case 'nom_prod':$filtro.=" and (SELECT nom_prod FROM det_mov WHERE cod_cab=cab AND SUBSTR(nom_prod,1,3)!='S/N' and substr(nom_prod,1,8)!='SERVICIO' and (cm.cod_ope='R1' or cm.cod_ope='S1')) like '%".$produ."%'";break;
					default:$filtro.=" and (SELECT producto.idproducto FROM producto inner join det_mov on producto.idproducto=det_mov.cod_prod WHERE cod_cab=cab AND SUBSTR(nom_prod,1,3)!='S/N' and substr(nom_prod,1,8)!='SERVICIO' and (cm.cod_ope='R1' or cm.cod_ope='S1')) like '%".$produ."'";break;
				}
			}
			if($subca!="T"){
				$filtro.=" and dm.cod_cab in( select d.cod_cab from det_mov d inner join producto p on p.idproducto=d.cod_prod where p.categoria='$subca' )";
			}
			if(isset($_REQUEST['imprimir'])){
				$pagina='';
			}else{
				$pagina=$_REQUEST['pag'];
			}
			
			$registros=25;
			//$registros=1;
			
			if ($pagina=='') { 
				$inicio = 0; 
				$pagina = 1; 
			} else { 
				$inicio = ($pagina - 1) * $registros; 
			}
			
			if($servi=="todos" || isset($_REQUEST['todos'])){
				if($servi!="todos"){
					$cos2=" substr(dm.nom_prod,1,8)='SERVICIO' and dm.cod_prod='$servi' and";
				}else{
					$cos2=" substr(dm.nom_prod,1,8)='SERVICIO' and";
				}
				$busqueda="buscar_pag2";
			}else{
				$cos2=" dm.cod_prod='$servi' and";
				$busqueda="buscar_pag";
			}
			//Cambio para Mostrar o Ocultar Anulados//
			$SQLConsulta=" inner join cliente cl on cl.codcliente=cm.cliente where$cos2 substring(cm.fecha,1,10) between '".formatofecha($fechi)."' and '".formatofecha($fechf)."' $filtro and cm.flag!='A' and (cm.cod_ope='R1' or cm.cod_ope='S1') order by (Select cm.fecha from cab_mov cm INNER JOIN referencia ref ON ref.cod_cab=cm.cod_cab WHERE cod_cab_ref=cab AND cm.cod_ope='S2' and cm.flag!='A') asc";
			//////////////////////////////////////////
			if($ser==""){
			//det_mov dm INNER JOIN cab_mov cm
				$consultag="SELECT cm.estadoOT as flag,cm.fecha AS fecha,dm.cod_prod,CONCAT(dm.cod_ope,' ',dm.serie,'-',dm.numero) AS documento,dm.cod_cab AS cab,(SELECT concat(cm.obs1,'~',ve.usuario) FROM cab_mov cm inner join usuarios ve on ve.codigo=cm.cod_vendedor INNER JOIN referencia ref ON ref.cod_cab=cm.cod_cab WHERE cod_cab_ref=cab) AS acciones,(SELECT SUBSTR(nom_prod,5) FROM det_mov WHERE cod_cab=cab AND SUBSTR(nom_prod,1,3)='S/N') AS serie,(SELECT nom_prod FROM det_mov WHERE cod_cab=cab AND SUBSTR(nom_prod,1,3)!='S/N' and substr(nom_prod,1,8)!='SERVICIO') AS producto,(SELECT nom_prod FROM det_mov WHERE cod_cab=cab and substr(nom_prod,1,8)='SERVICIO') AS servicio,(SELECT producto.cod_prod FROM producto inner join det_mov on producto.idproducto=det_mov.cod_prod WHERE cod_cab=cab AND SUBSTR(nom_prod,1,3)!='S/N' and substr(nom_prod,1,8)!='SERVICIO') AS cod_proda,cm.obs1 AS observacion,cm.obs2 AS notas FROM cab_mov cm INNER JOIN det_mov dm ON cm.cod_cab=dm.cod_cab $SQLConsulta";
			}else{
			//FROM det_mov dm INNER JOIN series on series.ingreso=dm.cod_cab INNER JOIN cab_mov cm ON cm.cod_cab=dm.cod_cab
				$consultag="SELECT cm.estadoOT as flag,cm.fecha AS fecha,dm.cod_prod,CONCAT(dm.cod_ope,' ',dm.serie,'-',dm.numero) AS documento,dm.cod_cab AS cab,series.serie AS serie,(SELECT nom_prod FROM det_mov WHERE cod_cab=cab AND SUBSTR(nom_prod,1,3)!='S/N' and substr(nom_prod,1,8)!='SERVICIO') AS producto,(SELECT nom_prod FROM det_mov WHERE cod_cab=cab and substr(nom_prod,1,8)='SERVICIO') AS servicio,(SELECT producto.cod_prod FROM producto inner join det_mov on producto.idproducto=det_mov.cod_prod WHERE cod_cab=cab AND SUBSTR(nom_prod,1,3)!='S/N' and substr(nom_prod,1,8)!='SERVICIO') AS cod_proda,(SELECT concat(cm.obs1,'~',ve.usuario) FROM cab_mov cm inner join usuarios ve on ve.codigo=cm.cod_vendedor INNER JOIN referencia ref ON ref.cod_cab=cm.cod_cab WHERE cod_cab_ref=cab) AS acciones,cm.obs1 AS observacion,cm.obs2 AS notas FROM cab_mov cm INNER JOIN det_mov dm ON cm.cod_cab=dm.cod_cab INNER JOIN series on series.ingreso=dm.cod_cab $SQLConsulta";
			}
			//echo $consultag;
			if(isset($_REQUEST['imprimir'])){
				$resultado=mysql_query($consultag,$cn);
				$resultados2 =mysql_num_rows($resultado); 
			}else{
				$resultados = mysql_query($consultag,$cn);
				$total_registros = mysql_num_rows($resultados);
				$limit=" LIMIT $inicio, $registros";
							
				$resultado=mysql_query($consultag.$limit,$cn);
				$resultados2 =mysql_num_rows($resultado); 
				$total_paginas = ceil($total_registros / $registros); 
			}
		?>
        <table id="encFil">
    <?php $reg=$inicio+$resultados2;
	for($i=$inicio+1;$i<=$reg;$i++){
		echo "<tr><td height='31'>".$i."</td></tr>";
	}
	?> 
 <tr><td height="31"> <!-- FILA VACÍA --> </td></tr>
 </table>
 |
    	<table width="1420" id="contenido">
	<?php 
	while($row=mysql_fetch_array($resultado)){
		if($row['flag']=="T"){
			$fcolor="#0099FF";
		}else{
			$fcolor="#FFFF99";
		}
		$dato=explode("~",$row['acciones']);
		$tecnico=$dato[1];
		$acciones=$dato[0];?>
    <tr bgcolor="<?php echo $fcolor;?>" onDblClick="Mostrar('<?php echo $row['cab'];?>')">
      <td width="77" height="31"><?php echo extraefecha2($row['fecha']);?></td>
      <td width="96" height="31"><?php echo $row['documento'];?></td>
      <?php if($servi=="todos" || isset($_REQUEST['todos'])){ $med=138 ?>
      <td width="<?php echo $med;?>" height="31"><?php echo caracteres($row['servicio']);?></td>
	  <?php }else{
		  $med=277;
	  }?>
      <td width="<?php echo $med;?>" height="31"><?php echo caracteres($row['producto']);?></td>
      <td width="91" height="31"><?php echo $row['serie'];?></td>
      <td width="245" height="31"><?php echo caracteres($row['observacion']);?></td>
      <td width="239" height="31"><?php echo caracteres($row['notas']);?></td>
      <td width="116" height="31"><?php echo caracteres($tecnico);?></td>
      <td width="243" height="31"><?php echo caracteres($acciones);?></td>
    </tr>
    <?php }?>
    
    	</table>
     |
<table width="100%" height="21" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="311" height="21" align="left" valign="bottom" style="color:#333333"><span class="Estilo10">Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (de <strong><?php echo $total_registros?></strong> documentos)</span>.</td>
    <td width="116" align="right" valign="bottom" style="color:#999999"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:13px">Ir a pag. <input type="text" size="3" maxlength="3" value="<?php echo $pagina?>" onkeyup="validar_pag(this,<?php echo $total_paginas;?>);" /></font></td>
    <td width="410" align="right" valign="bottom" style="color:#999999"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:13px">
      <?php 
			  
 if(($pagina - 1) > 0) { 
 echo "<a style='cursor:pointer' onclick='$busqueda(1)'>< Primera </a> ";
//echo "<a style='cursor:pointer' onclick='buscar_prod($pagina-1)'>< Anterior </a> "; 
} 
//$total_paginas;
if($pagina+4<=$total_paginas){
	if($pagina>4){
	$inicio=$pagina-4;
	}else{
		$inicio=1;
	}
	$mostrar=$pagina+4;
}else{
	if(($pagina!=$total_paginas) && ($pagina+4<$total_paginas)){
	$inicio=$pagina-4;
	}else{
	$inicio=1;
	}
	$temp=$total_paginas-$pagina;
	$mostrar=$pagina+$temp;
}
for ($i=$inicio; $i<=$mostrar; $i++){ 
	if ($pagina == $i) { 
		echo "<b style='color:#000000'>".$pagina."</b> "; 
	} else { 
		echo "<a style='cursor:pointer' href='#' onclick='$busqueda($i)'>$i</a> "; 
	}
}

if(($pagina + 1)<=$total_paginas) { 
//echo " <a style='cursor:pointer' onclick='buscar_prod($pagina+1)'>Siguiente ></a>"; 
echo "<a style='cursor:pointer' onclick='$busqueda($total_paginas)'>Ultima ></a> ";
} 

			  ?>
      <input type="hidden" name="pag" value="<?php echo $pagina?>" />
    &nbsp;&nbsp;    </font> </td>
  </tr>
</table>
<?php  ;break;
}
?>