<?php
session_start();
include('../conex_inicial.php');
include('../funciones/funciones.php');
if(isset($_REQUEST['Modulo'])){
$modulo=$_REQUEST['Modulo'];
}else{
	$modulo="";
}
switch($modulo){
	case 'Creditos':
			switch($_REQUEST['accionx']){
				case 'condiciones':
					$dis='';
					if($_REQUEST['niv']!="6" && $_REQUEST['niv']!="9" && $_REQUEST['niv']!="5" && $_REQUEST['niv']!="4"  ){
						$dis="disabled='disabled'";
					}
					 echo "<select style='width:130' $dis name='condicion' id='condicion' onchange='cambiar_cond(this)'>";
					 
					$StrCondi="Select * from detope where documento='".$_REQUEST['doc']."' order by descondi";
					$conCondi=mysql_query($StrCondi,$cn);
					while($rowcondi=mysql_fetch_array($conCondi)){
						echo "<option value='".$rowcondi['condicion']."-".$rowcondi['deuda']."'>".caracteres($rowcondi['descondi'])."</option>";
					}
					echo "</select>";
					break;
										
				case 'numero':
					$docu=$_REQUEST['doc'];
					$sucu=$_REQUEST['suc'];
					$user=$_REQUEST['user'];
					$tipo=$_REQUEST['tipo'];
					$wherex="";
					if($sucu!="" && $sucu!="0" ){
						$wherex="and empresa='".$sucu."'";
					}
					$SQL32="Select * from docuser inner join operacion op on op.codigo=docuser.doc where substr(op.p1,5,1)='S' and op.tipo='".$tipo."' and op.codigo='".$docu."' and usuario='".$_SESSION['codvendedor']."' $wherex";
					//echo $SQL32;
					
					$res=mysql_query($SQL32,$cn);
					$row=mysql_fetch_array($res);
					if($row['serie']!=''){
					echo str_pad($row['serie'],3,"0",STR_PAD_RIGHT);
					}
					break;
					
					case 'save_tipopago':
					
					$id=$_REQUEST['id'];
					$t_pago=$_REQUEST['t_pago'];
					$campo=$_REQUEST['campo'];
					
					if($campo=='1'){
					$strSQL="update pagos set t_pago='".$t_pago."' where id='".$id."'";
					mysql_query($strSQL,$cn);	
					}
					
					if($campo=='2'){					
					$strSQL="update pagos set numero='".$t_pago."' where id='".$id."'";
					mysql_query($strSQL,$cn);	
					}
					
					if($campo=='3'){					
					$strSQL="update pagos set obs='".$t_pago."' where id='".$id."'";
					mysql_query($strSQL,$cn);	
					}
					
					
					
					
					break;
					
				default:echo "error";break;
			}
		break;
	case 'SalirLetra':
		if(count($_SESSION['pagoslet'][0])>0){
			foreach ($_SESSION['pagoslet'][0] as $subkey=> $subvalue) {
				unset($_SESSION['pagoslet'][0][$subkey]);
				unset($_SESSION['pagoslet'][1][$subkey]);
				unset($_SESSION['pagoslet'][2][$subkey]);
				unset($_SESSION['pagoslet'][3][$subkey]);
				unset($_SESSION['pagoslet'][4][$subkey]);
				unset($_SESSION['pagoslet'][5][$subkey]);
				unset($_SESSION['pagoslet'][6][$subkey]);
				unset($_SESSION['disable'][0][$subkey]);
			}
		}
		if(count($_SESSION['pagos'][0])>0){
			foreach ($_SESSION['pagos'][0] as $subkey=> $subvalue) {
				unset($_SESSION['pagos'][0][$subkey]);
				unset($_SESSION['pagos'][1][$subkey]);
				unset($_SESSION['pagos'][2][$subkey]);
				unset($_SESSION['pagos'][3][$subkey]);
				unset($_SESSION['pagos'][4][$subkey]);
				unset($_SESSION['pagos'][5][$subkey]);
				unset($_SESSION['pagos'][6][$subkey]);
				unset($_SESSION['pagos'][7][$subkey]);
			}
		};break;
	case 'AnularLetra':
		$let=$_REQUEST['CodDoc'];
		$ope=$_REQUEST['Condicion'];
		switch($ope){
			case 'A': 
			$sql=mysql_query("Select * from multi_det where multi_id='$let' and estado ='P'",$cn);
			
			$rs=mysql_query("Select * from pagos pa where pa.refer_letra='$letra'",$cn);
			//echo $sql;
			if(mysql_num_rows($sql)>0 || mysql_num_rows($rs)>0){
				echo "El Multicanje tiene letras Protestadas/Canceladas";
			}else{
				$sql="Update from multi_det set estado='A' where multi_id='$let'";
			}
			break;
		}
	;break;
	case 'CancelaLetra':
		//echo $_REQUEST['cod'];
		if(isset($_REQUEST['ListarLetra'])){
			$multic=$_REQUEST['cod'];
			$registros=3;
			if(isset($_REQUEST['pagina'])){
				if($_REQUEST['pagina']==''){
					$pagina=1;
					$inicio=0;
				}else{
					$pagina=$_REQUEST['pagina'];
					$inicio=($pagina-1)*$registros;
				}
			}else{
				$pagina=1;
				$inicio=0;
			}
			$limit=" limit ".$inicio.",".$registros;
			?>
			<table width="679" border="0">
			    <?php $sql="Select md.*,mo.simbolo as sim from multi_det md inner join moneda mo on mo.id=md.moneda where multi_id='$multic' order by det_id";
				$rs=mysql_query($sql,$cn);
				$total_reg=mysql_num_rows($rs);
				
				$total_paginas = ceil($total_reg / $registros);
				//echo $sql.$limit;
				$rs2=mysql_query($sql.$limit,$cn);
				
				
				while($row=mysql_fetch_array($rs2)){	
					if($row['saldo']==0.00){
						$color="#0033FF";
					}else{
					//."<br>";
					switch($row['estado']){
						case 'A':$color="#FF0000";break;
						case 'P':$color="#009966";break;
						default:$color="#CCCCCC";break;
					}
				}?>
				<tr bgcolor="<?php echo $color; ?>" id="det<?php echo $row['det_id']; ?>">
					<td width="114" align="left" class="texto2"><?php echo $row['letra']; ?></td>
					<td width="101" align="center" class="texto2"><?php echo formatofecha($row['fechavcto']); ?></td>
					<td width="58" align="center" class="texto2"><?php echo $row['sim']; ?></td>
					<td width="82" align="right" class="texto2" id="total<?php echo $row['det_id']; ?>"><?php echo $row['monto']; ?></td>
					<td width="80" align="right" class="texto2" id="acta<?php echo $row['det_id']; ?>"><?php 
					$acta=0.00;
					$sql_pago=mysql_query("Select * from pagos where refer_letra='".$row['det_id']."'",$cn); 
					while($row_cta=mysql_fetch_array($sql_pago)){
						$monto=number_format($row_cta['monto'],2);
						if($row['moneda']=='02' && $row_cta['moneda']=='01'){
							$monto=number_format($row_cta['monto']/$row_cta['tcambio'],2);
						}
						if($row['moneda']=='01' && $row_cta['moneda']=='02'){
							$monto=number_format($row_cta['monto']*$row_cta['tcambio'],2);
						}
						$acta=$monto+$acta;
					}
					echo number_format($acta,2);
					?></td>
					<td width="82" align="right" class="texto2" id="saldo<?php echo $row['det_id']; ?>"><?php echo number_format($row['saldo'],2); ?></td>
					<td width="129" align="center" class="texto2"><a href="javascript:Letra('<?php echo $row['det_id'];?>','C')" title="Pagar"><img style="border:hidden" src="../imgenes/ico_edit.gif" /></a>&nbsp;&nbsp;<?php /*?><a href="javascript:Letra('<?php echo $row['det_id'];?>','A')" title="Anular"><img style="border:hidden" src="../imgenes/debaja.png" /></a>&nbsp;&nbsp;<a href="javascript:Letra('<?php echo $row['det_id'];?>','P')" title="Protestar"><img style="border:hidden" src="../imgenes/eliminar.png" /></a><?php */?></td>
				</tr>
				<?php }	?>
			</table>
            |
<table border="0">
			<tr>
				<td valign="top" width="214" height="35">Viendo del <?php echo ($inicio+1);?> al <?php if(($inicio+$registros)<$total_reg){echo ($inicio+$registros);}else{echo $total_reg;}?> de <?php echo ($total_reg); ?></td>
                <td width="449" valign="top" align="right">P&aacute;gina 
				<?php for($i=1;$i<=$total_paginas;$i++){
					if($i==$pagina){
						echo "<b>".$i."</b>&nbsp;";
					}else{
						echo "<a href=javascript:mostrarlet('".$multic."','".$i."')>".$i."</a>&nbsp;";
					}
				}?></td>
			</tr>
            </table>
            <?php
		}else{
			$operacion=$_REQUEST['ope'];
			$letra=$_REQUEST['let'];
			$div=$_REQUEST['det'];
			//echo $operacion;
			if($operacion!="C"){
				echo "$operacion~$det~";
				$sql="Select * from pagos pa where pa.refer_letra='$letra'";
				$rs=mysql_query($sql,$cn);
				//echo $sql;
				if(mysql_num_rows($rs)>0){
					echo "No se puede Completar esta Accion porque existen Pagos";
				}else{
					$ql="Select estado from multi_det where det_id='$letra'";
					$s=mysql_query($ql,$cn);
					$r=mysql_fetch_array($s);
					$ac1="";
					switch($r[0]){
						case 'P':$ac1="Protestar";break;
						case 'A':$ac1="Anular";break;
						default:$ac1="";break;
					}
					if($ac1==""){
						$sql=mysql_query("Select * from multi_det where det_id='$letra'",$cn);
						$row=mysql_fetch_array($sql);
						switch($operacion){
							case 'A':$obs="Por Anulacion de Letra N° ".$row['letra'];break;
							case 'P':$obs="Por Protesto de Letra N° ".$row['letra'];break;
							default:$obs="";break;
						}
						if($obs!=""){
							$moneda=$row['moneda'];
							$let=mysql_query("Select sum(if(estado!='P' and estado!='A',monto,0)) as total from multi_det where multi_id='".$row['multi_id']."'",$cn);
							$rw_let=mysql_fetch_array($let);
							$total_let=$rw_let['total'];
							$total=$row['monto'];
							///Porcentaje a Restar x Documento
							$porc_mon=($total*100)/$total_let;
							//////////////////////////////////
							$doc=mysql_query("Select md.*,mc.tcambio as tca from multi_doc md inner join multicj mc on mc.multi_id=md.multi_id where md.multi_id='".$row['multi_id']."'",$cn);
							$can_doc=mysql_num_rows($doc);
							$total_doc=0.00;
							$ind=0;
							while($rw_doc=mysql_fetch_array($doc)){
								$var="monto".$ind;
								$var2="codigo".$ind;
								$var3="tcamb".$ind;
								$var4="multi".$ind;
								$total_doc=number_format($rw_doc['monto'],2,'.','');
								$$var=($total_doc*$porc_mon)/100;
								$$var2=$rw_doc['cab_mov'];
								$$var3=$rw_doc['tca'];
								$$var4=$rw_doc['multi_id'];
								$sql=mysql_query("Select max(id) from pagos",$cn);
								$ro=mysql_fetch_array($sql);
								$id=str_pad($ro[0]+1,6,"0",STR_PAD_LEFT);
								mysql_query("insert into pagos (id,tipo,t_pago,fecha,fechav,numero,monto,moneda,vuelto,moneda_v,fechap,tcambio,referencia,estado,obs,pc,cod_user,refer_letra) values('".$id."','C','16','".date('Y-m-d')."','".date('Y-m-d')."','',".number_format($$var,2,'.','').",'".$moneda."',0,'".$moneda."','".date('Y-m-d H:m:i')."','".$$var3."','".$$var2."','','$obs','".$_SESSION['pc_ingreso']."','".$_SESSION['codvendedor']."','')",$cn);
								mysql_query("update multi_doc set monto=(monto-".number_format($$var,2,'.','').") where multi_id='".$$var4."' and cab_mov='".$$var2."'",$cn);
								$ind++;
							}
							$val4=$operacion;
							$sql="update multi_det set estado='$val4' where det_id='$letra'";
							mysql_query($sql,$cn);
						}
					}else{
						echo "No se puede $ac1 esta Letra ya esta Protestada/Anulada";
					}
				}
			}else{ 
				$sql="Select estado from multi_det where det_id='$letra'";
				$rs=mysql_query($sql,$cn);
				$row=mysql_fetch_array($rs);
				switch($row[0]){
					case 'P':$mensaje="Imposible Realizar Pagos a Letra Protestada";break;
					case 'A':$mensaje="Imposible Realizar Pagos a Letra Anulada";break;
					default:$mensaje="";break;
				}
			 echo "Pa~$det~$mensaje";
			}
		}
	break;
	default:
		$accion=$_REQUEST['accion'];
		if(isset($_REQUEST['tipo'])){
		$tip=$_REQUEST['tipo'];
		}else{
			$tip="";
		}
		if(isset($_REQUEST['sucu'])){
		$suc=$_REQUEST['sucu'];
		}else{
			$suc="";
		}
		if(isset($_REQUEST['num'])){
		$num=$_REQUEST['num'];
		}else{
			$num="";
		}
		if(isset($_REQUEST['aux'])){
		$cli=$_REQUEST['aux'];
		}else{
			$cli="";
		}
		if(isset($_REQUEST['doc'])){
		$doc=$_REQUEST['doc'];
		}else{
			$doc="";
		}
		if(isset($_REQUEST['acta'])){
		$mpa=$_REQUEST['acta'];
		}else{
			$mpa="";
		}

		switch($accion){
			case 'filtrardoc': 
				$num=$_REQUEST['numero'];
				$serie=$_REQUEST['serie'];
				$cliente=$_REQUEST['cliente'];
				$tipo=$_REQUEST['tip'];
				$registros=13;
				$oper=explode("|",$_REQUEST['ope']);
				if(isset($_REQUEST['pagina'])){
					if($_REQUEST['pagina']==''){
						$pagina=1;
						$inicio=0;
					}else{
						$pagina=$_REQUEST['pagina'];
						$inicio=($pagina-1)*$registros;
					}
				}else{
					$pagina=1;
					$inicio=0;
				}
				$limit="limit ".$inicio.",".$registros;
				?>
				<table width="593" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td width="22" bgcolor="#008A8A"><span class="Estilo11">ok</span></td>
            <td width="90" bgcolor="#008A8A"><span class="Estilo11">Tienda</span></td>
            <td width="20" height="18" bgcolor="#008A8A"><span class="Estilo11">Td</span></td>
            <td width="71" bgcolor="#008A8A"><span class="Estilo11">Documento</span></td>
            <td width="60" bgcolor="#008A8A"><span class="Estilo11">Fec.doc.</span></td>
            <td width="66" bgcolor="#008A8A"><span class="Estilo11">Fec.venc.</span></td>
            <td width="36" bgcolor="#008A8A"><span class="Estilo11">Mon.</span></td>
            <td width="70" bgcolor="#008A8A"><span class="Estilo11">Monto Total</span></td>
            <td width="59" bgcolor="#008A8A"><span class="Estilo11">A Cta.</span></td>
            <td width="68" bgcolor="#008A8A"><span class="Estilo11">Saldo</span></td>
          </tr>
          <?php
		  $subf1="";$subf2="";
		  if($serie!="000" && $serie!=""){
		  $subf1=" and ca.serie='".$serie."'";
		  }
		  if($num!="000" && $num!=""){
		  $subf2=" and ca.Num_doc='".$num."'";
		  }
		  if($doc=="T"){
		  $filtro="".$subf1.$subf2;
		  }else{
		  $filtro=" and ca.cod_ope='".$doc."'".$subf1.$subf2;
		  }
		  $consulta="SELECT ca.moneda as moneda,concat(ca.tienda,'-',ti.des_tienda) as tienda, ca.cod_cab AS cab, ca.cod_ope AS td, CONCAT(ca.serie,'-',ca.num_doc) AS documento, ca.fecha AS fec_doc, ca.f_venc AS fec_vcto, if(ca.saldo<>(ca.total+ca.percepcion),ca.saldo,(ca.total+ca.percepcion)) AS mtotal, ca.saldo AS msaldo FROM cab_mov ca INNER JOIN tienda ti on ti.cod_tienda =ca.tienda INNER JOIN operacion ope ON ope.codigo=ca.cod_ope WHERE saldo>0.00 AND SUBSTR(ope.p1,5,1)='S' and ca.flag!='A' and ope.tipo='".$tipo."' and codigo!='TB' and codigo!='TF' and codigo!='TS' and ca.cliente='".$cliente."'".$filtro;
			$result=mysql_query($consulta,$cn);
			$total_reg=mysql_num_rows($result);
			
			$total_paginas = ceil($total_reg / $registros);
			
			$result2=mysql_query($consulta.$limit,$cn);
			
			$pos=0;
			$total_deuda=0;
			while($row2=mysql_fetch_array($result2)){
		?>
		  <tr ondblclick="OrigenDoc('<?php echo $row2['cab'];?>')">
          	<?php 
			$mc="";$ct=0;
			//echo count($_SESSION['pagos'][0]);
			if(count($_SESSION['pagos'][0])>0){
				foreach ($_SESSION['pagos'][0] as $subkey=> $subvalue) {
					if($row2['cab']==$_SESSION['pagos'][0][$subkey]){
						$mc=" checked ";
						$ct=$_SESSION['pagos'][6][$subkey];
					}
				}
			} ?>
            <td><span class="Estilo11"><input type="checkbox" value="<?php echo $row2['cab']; ?>" name="chkok" id="chkok" onClick="<?php echo $oper[0];?>" <?php echo $mc; ?>></span></td>
            <td><span class="Estilo_det"><?php echo $row2['tienda'];?></span></td>
            <td><span class="Estilo_det"><?php echo $row2['td']; ?></span></td>
            <td><span class="Estilo_det"><?php echo $row2['documento']; ?></span></td>
            <td><span class="Estilo_det"><?php echo extraefecha($row2['fec_doc']); ?></span></td>
            <td><span class="Estilo_det"><?php echo extraefecha($row2['fec_vcto']); ?></span></td>
            <td align="center"><span class="Estilo_det"><?php if($row2['moneda']=='01'){echo "S/.";}else{echo "US$.";} ?></span></td>
            <td align="right"><span class="Estilo_det"><?php echo number_format($row2['mtotal'],2,".",""); ?></span></td>
            <td><span class="Estilo_det"><input onKeyUp="<?php echo $oper[1];//$calc; ?>" style="text-align:right; font-size:11px" name="acta[<?php echo $pos;?>]" type="text" id="acta[]" value=" <?php echo number_format($ct,2,'.','');?>" size="10" maxlength="12"></span></td>
            <td><span class="Estilo_det"><input disabled style="text-align:right; font-size:11px" name="saldo[<?php echo $pos; $pos++;?>]" id="saldo[]" type="text" value="<?php echo number_format($row2['msaldo'],2,".",""); ?>" size="10" maxlength="12"></span></td>
          </tr>
          <?php
		  		$total_deuda=$row2['msaldo']+$total_deuda;
			}
		  ?>
      </table>
      <?php
				echo "|";
				?>
				<table border="0"><tr><td width="270" class="Estilo_det">P&aacute;gina <?php echo $pagina;?> de <?php echo $total_paginas;?> (Viendo del <?php echo $inicio+1; ?> al <?php $muestra=$inicio+$registros; if($muestra>$total_reg){ echo $total_reg;}else{echo $muestra;} ?> de <?php echo $total_reg; ?> documentos)</td><td width="309" class="Estilo_det" align="right"> Pag: <?php for($i=1;$i<=$total_paginas;$i++){ if($i==$pagina){echo " <b>".$i."</b>";}else{echo " <a href='javascript:cargar(".$i.")'>".$i."</a>";}}?></td></tr></table>
                <?php echo "|".number_format($total_deuda,2,".","");
				;break;
			case 'calcularcuotas':
				$tot=$_REQUEST['total'];
				$can=$_REQUEST['cuo'];
				$doc=$_REQUEST['docu'];
				if($_REQUEST['mon']=="01"){
					$mone="S/.";
				}else{
					$mone="US$.";
				}
				$sql=mysql_query("Select descripcion from t_pago where codigo='$doc'",$cn);
				$row=mysql_fetch_array($sql);
				if($can>0){
					$cuot=$tot/$can;
					$cuota=number_format($cuot,2,'.','');
				}else{
					$can=0;$cuota=0.00;
				}
				echo "$can ".$row[0]." de $mone     $cuota";
			break;
			case 'buscarcanje':
			//echo "Select * from multicj where tipo='$tip' and numcje='$num' and cod_suc='$suc'";
				$sql=mysql_query("Select * from multicj where tipo='$tip' and numcje='$num' and cod_suc='$suc'",$cn);
				if(mysql_num_rows($sql)>0){
					echo "existe|";
				}else{
					echo "no existe|";
				}
			;break;
			case 'buscarpendiente':
				$sql=mysql_query("Select ca.* from cab_mov ca inner join operacion op on op.codigo=ca.cod_ope where SUBSTR(op.p1,5,1)='S' and ca.tipo='$tip' and ca.cliente='$cli' and ca.sucursal='$suc' and ca.saldo>0",$cn);
				if(mysql_num_rows($sql)>0){
					echo "ex";
				}else{
					echo "Este cliente no tiene cuentas Pedientes";
				}
			;break;
			case 'selectdoc':
				if(isset($_REQUEST['agregar'])){
					/*$i=count($_SESSION['pagos'][0]);
					$_SESSION['pagos'][0][]=$doc;
					$_SESSION['pagos'][7][]=$i;
					*/
					$sql=mysql_query("Select cm.*,mon.simbolo as mone from cab_mov cm inner join moneda mon on mon.id=cm.moneda where cod_cab='".$doc."'",$cn);
					$docum=mysql_fetch_array($sql);
					//if(isset($_REQUEST['dc'])){
						$_SESSION['pagos'][0][]=$docum['cod_cab'];
						$_SESSION['pagos'][1][]=$docum['cod_ope'];
						$_SESSION['pagos'][2][]=$docum['serie']."-".$docum['Num_doc'];
						$_SESSION['pagos'][3][]=$docum['fecha'];
						$_SESSION['pagos'][4][]=$docum['mone'];
						$_SESSION['pagos'][5][]=$docum['saldo'];
						$_SESSION['pagos'][6][]=$docum['saldo'];
						$_SESSION['pagos'][7][]=count($_SESSION['pagos'][7]);
					//}
					echo $docum['saldo']."|".$doc;
				}
				if(isset($_REQUEST['quitar'])){
					foreach ($_SESSION['pagos'][0] as $subkey=> $subvalue) {	
						if($_SESSION['pagos'][0][$subkey]==$doc){
							unset($_SESSION['pagos'][0][$subkey]);
							unset($_SESSION['pagos'][1][$subkey]);
							unset($_SESSION['pagos'][2][$subkey]);
							unset($_SESSION['pagos'][3][$subkey]);
							unset($_SESSION['pagos'][4][$subkey]);
							unset($_SESSION['pagos'][5][$subkey]);
							unset($_SESSION['pagos'][6][$subkey]);
							unset($_SESSION['pagos'][7][$subkey]);
						}
					}
					echo 0.00."|".$doc;
				}
				if(isset($_REQUEST['a_cta'])){
					$sql=mysql_query("Select cm.*,mon.simbolo as mone from cab_mov cm inner join moneda mon on mon.id=cm.moneda where cod_cab='".$doc."'",$cn);
					$docum=mysql_fetch_array($sql);
					if(isset($_REQUEST['dc'])){
						if($docum['saldo']<$mpa){
							echo "error|".$_REQUEST['it']."|".$docum['saldo'];
						}else{
							$_SESSION['pagos'][0][]=$docum['cod_cab'];
							$_SESSION['pagos'][1][]=$docum['cod_ope'];
							$_SESSION['pagos'][2][]=$docum['serie']."-".$docum['Num_doc'];
							$_SESSION['pagos'][3][]=$docum['fecha'];
							$_SESSION['pagos'][4][]=$docum['mone'];
							$_SESSION['pagos'][5][]=$docum['saldo'];
							$_SESSION['pagos'][6][]=$mpa;
							$_SESSION['pagos'][7][]=count($_SESSION['pagos'][7]);
						}
					}else{
						foreach ($_SESSION['pagos'][0] as $subkey=> $subvalue) {	
							if($_SESSION['pagos'][0][$subkey]==$doc){
								if($docum['saldo']<$mpa){
									echo "error|".$_REQUEST['it']."|".$docum['saldo'];
								}else{
									$_SESSION['pagos'][1][$subkey]=$docum['cod_ope'];
									$_SESSION['pagos'][2][$subkey]=$docum['serie']."-".$docum['Num_doc'];
									$_SESSION['pagos'][3][$subkey]=$docum['fecha'];
									$_SESSION['pagos'][4][$subkey]=$docum['mone'];
									$_SESSION['pagos'][5][$subkey]=$docum['saldo'];
									$_SESSION['pagos'][6][$subkey]=$mpa;
								}
							}
						}
					}
				}
				if(isset($_REQUEST['salir'])){
					if(count($_SESSION['pagos'][0]>0)){
						foreach ($_SESSION['pagos'][0] as $subkey=> $subvalue) {	
							unset($_SESSION['pagos'][0][$subkey]);
							unset($_SESSION['pagos'][1][$subkey]);
							unset($_SESSION['pagos'][2][$subkey]);
							unset($_SESSION['pagos'][3][$subkey]);
							unset($_SESSION['pagos'][4][$subkey]);
							unset($_SESSION['pagos'][5][$subkey]);
							unset($_SESSION['pagos'][6][$subkey]);
							unset($_SESSION['pagos'][7][$subkey]);
						}
					}
					if(count($_SESSION['pagoslet'][0]>0)){
						foreach ($_SESSION['pagoslet'][0] as $subkey=> $subvalue) {
							unset($_SESSION['pagoslet'][0][$subkey]);
							unset($_SESSION['pagoslet'][1][$subkey]);
							unset($_SESSION['pagoslet'][2][$subkey]);
							unset($_SESSION['pagoslet'][3][$subkey]);
							unset($_SESSION['pagoslet'][4][$subkey]);
							unset($_SESSION['pagoslet'][5][$subkey]);
							unset($_SESSION['pagoslet'][6][$subkey]);
							unset($_SESSION['disable'][0][$subkey]);
						}
					}
				}
			break;
			case 'mostrardoc':
			$tot=0;
			if(isset($_REQUEST['referencia'])){
				$func="OrigenDoc";
				$img_ico="../imagenes/ico_lupa.png";
			}else{
				$func="EliminarDoc";
				$img_ico="../imgenes/eliminar.png";
			}
			if(isset($_SESSION['pagos'][0])){
			?>
		    <table border="0">
		    <?php
				foreach ($_SESSION['pagos'][0] as $subkey=> $subvalue) {
			?>
		    <tr>
				<td width="18" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3"><?php echo $_SESSION['pagos'][1][$subkey];?></font>
				<td width="56" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3"><?php echo $_SESSION['pagos'][2][$subkey];?></font>
				<td width="49" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3"><?php echo extraefecha($_SESSION['pagos'][3][$subkey]);?></font>
				<td width="60" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3"><?php echo $_SESSION['pagos'][4][$subkey]."  ".$_SESSION['pagos'][5][$subkey];?></font>
				<td width="52" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3"><?php echo $_SESSION['pagos'][4][$subkey]."  ".number_format($_SESSION['pagos'][6][$subkey],2,'.','');
				if($_REQUEST['moneda']=="01" && trim($_SESSION['pagos'][4][$subkey])=="US$."){
					$subt=$_SESSION['pagos'][6][$subkey]*$_REQUEST['tcam'];
				}else{
					if($_REQUEST['moneda']=="02" && trim($_SESSION['pagos'][4][$subkey])=="S/."){
						$subt=$_SESSION['pagos'][6][$subkey]/$_REQUEST['tcam'];
					}else{
						$subt=$_SESSION['pagos'][6][$subkey];
					}
				}
				$tot=$tot+$subt;
				?></font>
				<td width="10" bgcolor="#33FFCC" style="border-color:#09C"><img onclick="<?php echo $func;?>('<?php echo $_SESSION['pagos'][0][$subkey];?>')" src="<?php echo $img_ico?>" width="15" height="15" /></td>
		    </tr>
		    <?php
				}
			?>
			</table>
			<?php
            }
			?>
			
			|
		    <table width="265" border="0">
		    <tr>
				<td width="53" bgcolor="#FFFFFF" style="border-color:#09C">      
				<td width="92" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3">Total a Importe </font>
			  <td width="106" align="right" bgcolor="#33FFCC" style="border-color:#09C"><div id="totalc" align="right"><?php echo number_format($tot,2,'.','');?></div>			</tr>
			<tr>
				<td bgcolor="#FFFFFF" style="border-color:#09C">      
				<td bgcolor="#33FFCC" style="border-color:#09C"><font size="-3">Valor Canjeado</font>
			  <td bgcolor="#33FFCC" style="border-color:#09C" align="right"><div id="abonosc" align="right">0.00</div>			</tr>
			<tr>
				<td bgcolor="#FFFFFF" style="border-color:#09C">      
				<td bgcolor="#33FFCC" style="border-color:#09C"><font size="-3">Valor por Ajustar</font>
			  <td bgcolor="#33FFCC" style="border-color:#09C" align="right"><div id="saldoc" align="right"><?php echo number_format($tot,2,'.','');?></div>			</tr>
			</table>
			|
			<table width="350" border="3" bordercolor="#0033CC">
			<tr>
				<td colspan="3" bgcolor="#33FFCC" style="border-color:#09C">      
				Documentos (Letras)
				<td colspan="4" align="center" bgcolor="#33FFCC" style="border-color:#09C"><input type="button" name="genlet" id="genlet" onclick="GeneradorLetras()" value="Generar" disabled>
			</tr>
			<tr>
				<td width="16" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3">Doc</font>
				<td width="61" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3">Numero</font>
				<td width="70" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3">Monto</font>
			  <td width="48" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3">Fec.Venc.</font>
			  <td width="30" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3">Dias</font>
			  <td width="23" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3">Elim.</font>
			  <td width="52" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3">Imp.</font>
			</tr>
			<tr>
				<td height="21" colspan="7" bgcolor="#FFFFFF" style="border-color:#09C" valign="top"><div id="letrasdet" style="overflow:scroll; height:110px;" align="right"></div>	
			</tr>
			<?php echo "</table>|".number_format($tot,2,'.','');break;
			/// ERROR EN ALGUN LADO ELIMINA TODO... NO USAR
			case 'eliminardoc':
			if(isset($_REQUEST['referencia'])){
				$func="OrigenDoc";
				$img_ico="../imagenes/ico_lupa.png";
			}else{
				$func="EliminarDoc";
				$img_ico="../imgenes/eliminar.png";
			}
				$tot=0;
			?>
			<table border="0">
			<?php
				foreach ($_SESSION['pagos'][0] as $subkey=> $subvalue) {
					if($_SESSION['pagos'][0][$subkey]==$doc){
						unset($_SESSION['pagos'][0][$subkey]);
						unset($_SESSION['pagos'][1][$subkey]);
						unset($_SESSION['pagos'][2][$subkey]);
						unset($_SESSION['pagos'][3][$subkey]);
						unset($_SESSION['pagos'][4][$subkey]);
						unset($_SESSION['pagos'][5][$subkey]);
						unset($_SESSION['pagos'][6][$subkey]);
						unset($_SESSION['pagos'][7][$subkey]);
					}
					if($_SESSION['pagos'][1][$subkey]!=""){ ?>
					<tr>
						<td width="18" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3"><?php echo $_SESSION['pagos'][1][$subkey];?></font>
						<td width="56" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3"><?php echo $_SESSION['pagos'][2][$subkey];?></font>
						<td width="49" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3"><?php echo extraefecha($_SESSION['pagos'][3][$subkey]);?></font>
						<td width="60" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3"><?php echo $_SESSION['pagos'][4][$subkey]."  ".$_SESSION['pagos'][5][$subkey];?></font>
						<td width="52" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3"><?php echo $_SESSION['pagos'][4][$subkey]."  ".number_format($_SESSION['pagos'][6][$subkey],2,'.','');
						if($_REQUEST['moneda']=="01" && trim($_SESSION['pagos'][4][$subkey])=="US$."){
							$subt=$_SESSION['pagos'][6][$subkey]*$_REQUEST['tcam'];
						}else{
							if($_REQUEST['moneda']=="02" && trim($_SESSION['pagos'][4][$subkey])=="S/."){
								$subt=$_SESSION['pagos'][6][$subkey]/$_REQUEST['tcam'];
							}else{
								$subt=$_SESSION['pagos'][6][$subkey];
							}
						}
						$tot=$tot+$subt;
						?></font>
						<td width="10" bgcolor="#33FFCC" style="border-color:#09C"><img onclick="<?php echo $func;?>('<?php echo $_SESSION['pagos'][0][$subkey];?>')" src="<?php echo $img_ico; ?>"  width="15" height="15"/></td>
				    </tr>
			    <?php
					}
				}
			?>
			</table>
			|
			<table border="0">
		    <tr>
				<td width="53" bgcolor="#FFFFFF" style="border-color:#09C">      
				<td width="92" height="20" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3">Total Importe </font>
				<td width="106" align="right" bgcolor="#33FFCC" style="border-color:#09C"><div id="totalc" align="right"><?php echo number_format($tot,2,'.','');?></div>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" style="border-color:#09C">      
				<td bgcolor="#33FFCC" style="border-color:#09C"><font size="-3">Valor Canjeado</font>
				<td bgcolor="#33FFCC" style="border-color:#09C" align="right"><div id="abonosc" align="right">0.00</div>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" style="border-color:#09C">      
				<td bgcolor="#33FFCC" style="border-color:#09C"><font size="-3">Valor por Ajustar</font>
				<td bgcolor="#33FFCC" style="border-color:#09C" align="right"><div id="saldoc" align="right"><?php echo number_format($tot,2,'.','');?></div>
			</tr>
			</table>
    		|
<table width="350" border="3" bordercolor="#0033CC">
			<tr>
				<td colspan="3" bgcolor="#33FFCC" style="border-color:#09C">      
				Documentos (Letras)
				<td colspan="4" align="center" bgcolor="#33FFCC" style="border-color:#09C"><input type="button" name="genlet" id="genlet" onclick="GeneradorLetras()" value="Generar" disabled>
			</tr>
			<tr>
				<td width="20" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3">Doc</font>
				<td width="68" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3">Numero</font>
				<td width="99" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3">Monto</font>
			  <td width="48" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3">Fec.Venc.</font>
			  <td width="28" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3">Dias</font>
			  <td width="21" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3">Elim.</font>
			  <td width="30" bgcolor="#33FFCC" style="border-color:#09C"><font size="-3">Imp.</font>
			</tr>
			<tr>
				<td height="21" colspan="7" bgcolor="#FFFFFF" style="border-color:#09C" valign="top"><div id="letrasdet" align="right" style="width:350; height:50px"></div></td>
                <?php /* EN CASO DE QUERER RECARGAR ?><table border="0">
			    	<?php
					if(count($_SESSION['pagoslet'][0])>0 && count($_SESSION['pagos'][0])>0){
						foreach ($_SESSION['pagoslet'][0] as $subkey=> $subvalue) {?>
						<tr>
							<td width="34"><font size="-3"><?php echo $_SESSION['pagoslet'][1][$subkey];?></font>
							<td width="67"><font size="-3"><?php echo $_SESSION['pagoslet'][2][$subkey];?></font>
							<td width="53"><font size="-3"><?php echo $_SESSION['pagoslet'][3][$subkey];?></font>
							<td width="50"><font size="-3"><?php echo $_SESSION['pagoslet'][4][$subkey];?></font>
							<td width="49"><font size="-3"><?php echo $_SESSION['pagoslet'][5][$subkey];?></font>
							<td width="36" onclick="ElimLet('<?php echo $_SESSION['pagoslet'][0][$subkey];?>')"><font size="-3"> X</font>
							<td width="31" onclick="ImprimirLet('<?php echo $_SESSION['pagoslet'][0][$subkey];?>')"><font size="-3"> I</font>
						</tr>
						<?php }
					}?>
					</table><?php */?>
			</tr>
<?php echo "</table>|".number_format($tot,2,'.','');break;
			case "mostrarletras":
			if(isset($_SESSION['pagoslet'][0])){
				if(count($_SESSION['pagoslet'][0])>0){
					foreach ($_SESSION['pagoslet'][0] as $subkey=> $subvalue) {
						unset($_SESSION['pagoslet'][0][$subkey]);
						unset($_SESSION['pagoslet'][1][$subkey]);
						unset($_SESSION['pagoslet'][2][$subkey]);
						unset($_SESSION['pagoslet'][3][$subkey]);
						unset($_SESSION['pagoslet'][4][$subkey]);
						unset($_SESSION['pagoslet'][5][$subkey]);
						unset($_SESSION['pagoslet'][6][$subkey]);
						unset($_SESSION['disable'][0][$subkey]);
					}
				}
			}
				$cj=number_format($_REQUEST['canje']);
				$numcuo=$_REQUEST['cuo'];
				$moneda=$_REQUEST['mon'];
				$total=$_REQUEST['total'];
				$doc=$_REQUEST['docu'];
				$fec=$_REQUEST['fecha'];
				$dias=$_REQUEST['dvenc'];
				$tcu=$total/$numcuo;
				$cuota=number_format($tcu,2,'.','');
				//$sql=mysql_query("Select codigo from t_pago where ";
				for($i=0;$i<$numcuo;$i++){
					$cdias=$dias*($i+1);
					$nfecha=suma_fecha(formatofecharay($fec),$cdias);
					$_SESSION['pagoslet'][0][]=$i;
					$_SESSION['pagoslet'][1][]=$doc;
					$_SESSION['pagoslet'][2][]=$doc."-".$cj."-".($i+1);
					$_SESSION['pagoslet'][3][]=$cuota;
					$_SESSION['pagoslet'][4][]=formatobarrafecha($nfecha);
					$_SESSION['pagoslet'][5][]=$cdias;
					$_SESSION['pagoslet'][6][]="";
					$_SESSION['disable'][0][]="";
				}
				$tot=0;
				$saldo=0;
				?>
<table width="350" border="0">
					<?php foreach ($_SESSION['pagoslet'][0] as $subkey=> $subvalue) {?>
					<tr>
						<td width="19"><font size="-3"><?php echo $_SESSION['pagoslet'][1][$subkey];?></font>
						<td width="56">
                        <?php if($_REQUEST['tipo']=='1'){ ?>
                        <input style="font-size:9px" onkeyup="RecalcularLetra(this,event,'<?php echo $subkey;?>')" size="8" height="12" type="text" name="numlet[]" id="numlet[]" value="<?php echo $_SESSION['pagoslet'][2][$subkey];?>">
                        <?php }else{ ?>
                        <input style="font-size:9px" onkeyup="RecalcularLetra(this,event,'<?php echo $subkey;?>')" size="8" height="12" type="hidden" name="numlet[]" id="numlet[]" value="<?php echo $_SESSION['pagoslet'][2][$subkey];?>"><?php echo $_SESSION['pagoslet'][2][$subkey];
						}?>
						<td width="56"><input style="font-size:9px" onkeyup="RecalcularLetra(this,event,'<?php echo $subkey;?>')" size="8" height="12" type="text" name="monto[]" id="monto[]" value="<?php echo $_SESSION['pagoslet'][3][$subkey];?>"><?php $tot=number_format($_SESSION['pagoslet'][3][$subkey],2,'.','')+number_format($tot,2,'.','');?></font>
						<td width="54"><font size="-3"><input style="font-size:9px" onkeyup="RecalcularLetra(this,event,'<?php echo $subkey;?>')" size="8" height="12" type="text" name="fecha[]" id="fecha[]" value="<?php echo $_SESSION['pagoslet'][4][$subkey];?>"><?php //echo $_SESSION['pagoslet'][4][$subkey];?></font>
						<td width="29"><font size="-3"><input style="font-size:9px" onkeyup="RecalcularLetra(this,event,'<?php echo $subkey;?>')" size="4" height="12" type="text" name="dias[]" id="dias[]" value="<?php echo $_SESSION['pagoslet'][5][$subkey];?>"><?php //echo $_SESSION['pagoslet'][5][$subkey];?></font>
						<td width="22"><img onclick="ElimLet('<?php echo $_SESSION['pagoslet'][0][$subkey];?>')" src="../imgenes/eliminar.png" /></td>
						<td width="23"><img onclick="ImprimirLet('<?php echo $_SESSION['pagoslet'][0][$subkey];?>')" src="../imgenes/fileprint.gif" style="height:20px" />
					</tr>
					<?php }?>
</table>
				|
				<?php
				$saldo=number_format($total,2,'.','')-number_format($tot,2,'.','');
				echo number_format($tot,2,'.','')."|".number_format($saldo,2,'.','');
				;break;
			case'MostrarLetra2':
				$total=$_REQUEST['total'];
				$tot=0;
				$saldo=0;
				?>
<table width="350" border="0">
					<?php foreach ($_SESSION['pagoslet'][0] as $subkey=> $subvalue) {?>
					<tr>
						<td width="19"><font size="-3"><?php echo $_SESSION['pagoslet'][1][$subkey];?></font>
						<td width="56">
                        <?php if($_REQUEST['tipo']=='1'){ ?>
                        <input style="font-size:9px" onkeyup="RecalcularLetra(this,event,'<?php echo $subkey;?>')" size="8" height="12" type="text" name="numlet[]" id="numlet[]" value="<?php echo $_SESSION['pagoslet'][2][$subkey];?>">
                        <?php }else{ ?>
                        <input style="font-size:9px" onkeyup="RecalcularLetra(this,event,'<?php echo $subkey;?>')" size="8" height="12" type="hidden" name="numlet[]" id="numlet[]" value="<?php echo $_SESSION['pagoslet'][2][$subkey];?>"><?php echo $_SESSION['pagoslet'][2][$subkey];
						}?>
						<td width="56"><input style="font-size:9px" onkeyup="RecalcularLetra(this,event,'<?php echo $subkey;?>')" size="8" height="12" type="text" name="monto[]" id="monto[]" value="<?php echo $_SESSION['pagoslet'][3][$subkey];?>"><?php $tot=number_format($_SESSION['pagoslet'][3][$subkey],2,'.','')+number_format($tot,2,'.','');?></font>
						<td width="54"><font size="-3"><input style="font-size:9px" onkeyup="RecalcularLetra(this,event,'<?php echo $subkey;?>')" size="8" height="12" type="text" name="fecha[]" id="fecha[]" value="<?php echo $_SESSION['pagoslet'][4][$subkey];?>"><?php //echo $_SESSION['pagoslet'][4][$subkey];?></font>
						<td width="29"><font size="-3">
						    <input style="font-size:9px" onkeyup="RecalcularLetra(this,event,'<?php echo $subkey;?>')" size="4" height="12" type="text" name="dias[]" id="dias[]" value="<?php echo $_SESSION['pagoslet'][5][$subkey];?>" />
					    <?php //echo $_SESSION['pagoslet'][5][$subkey];?></font>
				    <td width="22"><img onclick="ElimLet('<?php echo $_SESSION['pagoslet'][0][$subkey];?>')" src="../imgenes/eliminar.png" /></td>
						<td width="23"><img onclick="ImprimirLet('<?php echo $_SESSION['pagoslet'][0][$subkey];?>')" src="../imgenes/fileprint.gif" style="height:20px" />
					</tr>
					<?php }?>
</table>
				|
				<?php
				$saldo=number_format($total,2,'.','')-number_format($tot,2,'.','');
				echo number_format($tot,2,'.','')."|".number_format($saldo,2,'.','');
				;break;
			case 'modificarletra':
				switch($_REQUEST['tip']){
					case 'numlet': $pos=2; $dator=$_REQUEST['dato']; break;
					case 'monto': $pos=3; $dator=$_REQUEST['dato']; break;
					case 'fecha': $pos=4; $dator=formatofecharay($_REQUEST['dato']); if(strlen($dator)>10){
						$dator=formatofecha($_REQUEST['dato']);
					}
					$fecha1=formatofecharay($_REQUEST['fechac']); $ndias=restaFechas2($fecha1,$dator); $_SESSION['pagoslet'][($pos+1)][$_REQUEST['num']]=$ndias; break;
					case 'dias': $pos=5; $datod=$_REQUEST['dato']; $fecha1=formatofecharay($_REQUEST['fechac']); $nfecha=suma_fecha($fecha1,$datod); $_SESSION['pagoslet'][($pos-1)][$_REQUEST['num']]=formatobarrafecha($nfecha); break;
				}
				$_SESSION['pagoslet'][$pos][$_REQUEST['num']]=$_REQUEST['dato'];
				$tot=0;
				foreach ($_SESSION['pagoslet'][0] as $subkey=> $subvalue) {
					$tot=$_SESSION['pagoslet'][3][$subkey]+$tot;
				}
				//print_r($_SESSION['pagoslet']);
				if($_REQUEST['tip']=='fecha'){
					$_SESSION['pagoslet'][$pos][$_REQUEST['num']]=formatobarrafecha($dator);
				echo $ndias;
				}
				echo "|".number_format($tot,2,'.','');
				;break;
			case 'guardarmultic':
				$canlet=count($_SESSION['pagoslet'][0]);	
				$candoc=count($_SESSION['pagos'][0]);
				if($candoc>0 && $canlet>0){
					$sql=mysql_query("Select max(multi_id) from multicj",$cn);
					$row=mysql_fetch_array($sql);
					$cod_multi=$row[0]+1;
					$numero=$_REQUEST['num'];
					$tipo=$_REQUEST['tip'];
					$cliente=$_REQUEST['clie'];
					$sucursal=$_REQUEST['sucu'];
					$fecha=formatofecharay($_REQUEST['fech']);
					$tcambio=$_REQUEST['tcam'];
					$responsable=$_REQUEST['resp'];
					$condicion=$_REQUEST['cond'];
					$moneda=$_REQUEST['mone'];
					$totalc=$_REQUEST['tota'];
					$canlet=count($_SESSION['pagoslet'][0]);
					$usu=$_SESSION['codvendedor'];
					$iden=$_SESSION['mac_pc'];
					$pc=$_SESSION['pc_ingreso'];
					$audit=date('Y-m-d H:i:s');
					$sql_cab=mysql_query("insert into multicj(multi_id,cod_suc,tipo,fecha,numcje,cliente,codvendedor,moneda,tcambio,importe,canlet,estado,notas,banco_id,user,pc,iden,audit) values('$cod_multi','$sucursal','$tipo','$fecha','$numero','$cliente','$responsable','$moneda','$tcambio','$totalc','$canlet','$condicion','','','$usu','$pc','$iden','$audit')",$cn);
					$sact=0;
					foreach ($_SESSION['pagos'][0] as $subkey=> $subvalue) {
						$sql=mysql_query("Select max(id) from pagos",$cn);
						$row=mysql_fetch_array($sql);
						$cod_pago=str_pad(($row[0]+1),6,STR_PAD_LEFT);
						switch($_SESSION['pagos'][4][$subkey]){
							case 'S/.':$mone_pago="01";break;
							case 'US$.':$mone_pago="02";break;
						}
						$sql=mysql_query("insert into pagos (id, tipo, t_pago, fecha, fechav, numero, monto, moneda, vuelto, moneda_v, fechap, tcambio, referencia, estado, obs, pc, cod_user) values('$cod_pago','A','CA','$fecha','$fecha','CANJE LE','".$_SESSION['pagos'][6][$subkey]."','$mone_pago','0','','$audit','$tcambio','".$_SESSION['pagos'][0][$subkey]."','','MULTICANJE N° $numero','$pc','$usu')",$cn); 
						$sql=mysql_query("Insert into multi_doc (multi_id,cab_mov,monto) values('$cod_multi','".$_SESSION['pagos'][0][$subkey]."','".$_SESSION['pagos'][6][$subkey]."')",$cn);
						$sql=mysql_query("Select saldo from cab_mov where cod_cab='".$_SESSION['pagos'][0][$subkey]."'",$cn);
						$rw=mysql_fetch_array($sql);
						$saldo=number_format($rw[0],2,'.','') - number_format($_SESSION['pagos'][6][$subkey],2,'.','');
						$sql=mysql_query("update cab_mov set saldo='$saldo' where cod_cab='".$_SESSION['pagos'][0][$subkey]."'",$cn);
					}
					foreach ($_SESSION['pagoslet'][0] as $subkey=> $subvalue) {
						$sql=mysql_query("Select max(det_id) from multi_det",$cn);
						$row=mysql_fetch_array($sql);
						$cod_multi_det=$row[0]+1;
						$sql=mysql_query("Insert into multi_det (multi_id, det_id, cod_letra, letra, moneda, monto, saldo, dias, fechavcto, estado, numbco) values('$cod_multi','$cod_multi_det','".$_SESSION['pagoslet'][1][$subkey]."','".$_SESSION['pagoslet'][2][$subkey]."','$moneda','".$_SESSION['pagoslet'][3][$subkey]."','".$_SESSION['pagoslet'][3][$subkey]."','".$_SESSION['pagoslet'][5][$subkey]."','".formatofecharay($_SESSION['pagoslet'][4][$subkey])."','','')",$cn);
					}
					echo "Multicanje N° $numero guardado Exitosamente!!!";
				}else{
					echo "error|No se ha seleccionado documentos/letras|";
				}
				break;
			case 'recuperarmulti':
				$sql=mysql_query("Select * from multicj where numcje='$num' and tipo='$tip' and cod_suc='$suc'",$cn);
				$row=mysql_fetch_array($sql);
				$sql_ven=mysql_query("Select usuario from usuarios where codigo='".$row['user']."'",$cn);
				$rw_ven=mysql_fetch_array($sql_ven);
				$sql_det=mysql_query("Select * from multi_det where multi_id='".$row['multi_id']."' order by det_id",$cn);
				if(isset($_SESSION['pagoslet'][0][0])){
					foreach ($_SESSION['pagoslet'][0] as $subkey=> $subvalue) {
						unset($_SESSION['pagoslet'][0][$subkey]);
						unset($_SESSION['pagoslet'][1][$subkey]);
						unset($_SESSION['pagoslet'][2][$subkey]);
						unset($_SESSION['pagoslet'][3][$subkey]);
						unset($_SESSION['pagoslet'][4][$subkey]);
						unset($_SESSION['pagoslet'][5][$subkey]);
						unset($_SESSION['pagoslet'][6][$subkey]);
						unset($_SESSION['pagoslet'][7][$subkey]);
						unset($_SESSION['disable'][0][$subkey]);
					}
				}
				while($rw_det=mysql_fetch_array($sql_det)){
					$xi=count($_SESSION['pagoslet'][0]);
					//$_SESSION['pagoslet'][0][]=$xi;
					$_SESSION['pagoslet'][0][]=$rw_det['det_id'];
					$_SESSION['pagoslet'][1][]=$rw_det['cod_letra'];
					$_SESSION['pagoslet'][2][]=$rw_det['letra'];
					$_SESSION['pagoslet'][3][]=$rw_det['monto'];
					$_SESSION['pagoslet'][4][]=$rw_det['fechavcto'];
					$_SESSION['pagoslet'][5][]=$rw_det['dias'];
					$_SESSION['pagoslet'][6][]=$rw_det['estado'];
					$sql=mysql_query("Select * from pagos where refer_letra='".$rw_det['det_id']."'",$cn);
					if(mysql_num_rows($sql)>0){
						$_SESSION['disable'][0][]="disabled=disabled";
					}else{
						$_SESSION['disable'][0][]="";
					}
				}
				$sql_doc=mysql_query("Select * from multi_doc where multi_id='".$row['multi_id']."'",$cn);
				if(isset($_SESSION['pagos'][0])){
				foreach ($_SESSION['pagos'][0] as $subkey=> $subvalue) {
					unset($_SESSION['pagos'][0][$subkey]);
					unset($_SESSION['pagos'][1][$subkey]);
					unset($_SESSION['pagos'][2][$subkey]);
					unset($_SESSION['pagos'][3][$subkey]);
					unset($_SESSION['pagos'][4][$subkey]);
					unset($_SESSION['pagos'][5][$subkey]);
					unset($_SESSION['pagos'][6][$subkey]);
					unset($_SESSION['pagos'][7][$subkey]);
					//unset($disabled[$subkey]);
				}
				}
				$total_doc=0;
				while($rw_doc=mysql_fetch_array($sql_doc)){
					$sql_cab=mysql_query("Select ca.*,mo.simbolo as mone from cab_mov ca inner join moneda mo on mo.id=ca.moneda where cod_cab='".$rw_doc['cab_mov']."'",$cn);
					$rw_cab=mysql_fetch_array($sql_cab);
					$_SESSION['pagos'][0][]=$rw_cab['cod_cab'];
					$_SESSION['pagos'][1][]=$rw_cab['cod_ope'];
					$_SESSION['pagos'][2][]=$rw_cab['serie']."-".$rw_cab['Num_doc'];
					$_SESSION['pagos'][3][]=$rw_cab['fecha'];
					$_SESSION['pagos'][4][]=$rw_cab['mone'];
					$_SESSION['pagos'][5][]=$rw_cab['total'];
					$_SESSION['pagos'][6][]=$rw_doc['monto'];
					//echo "|".$row['moneda']."!=".$rw_cab['moneda'];
					if($row['moneda']!=$rw_cab['moneda']){
						switch($row['moneda']){
							case '01':$montox=number_format($rw_doc['monto'],2,'.','')*number_format($row['tcambio'],3,'.','');break;
							case '02':$montox=number_format($rw_doc['monto'],2,'.','')/number_format($row['tcambio'],3,'.','');break;
						}
					}else{
						$montox=$rw_doc['monto'];
					}
					$total_doc+=number_format($montox,2,'.','');
					$_SESSION['pagos'][7][]=count($_SESSION['pagos'][7]);
				}
				$sql_cli=mysql_query("Select razonsocial from cliente where codcliente='".$row['cliente']."'",$cn);
				$rw_cli=mysql_fetch_array($sql_cli);
				if(!isset($notas)){
					$notas="";
				}
				if(!isset($banco_id)){
					$banco_id="";
				}
				echo extraefecha2($row['fecha'])."|".$row['cliente']."|".$rw_cli[0]."|".$row['moneda']."|".$row['codvendedor']."|".$row['tcambio']."|".$row['importe']." (Monto Anulado/Protestado: ".number_format($row['importe']-$total_doc,2,'.','').")|".$row['estado']."|".$notas."|".$banco_id."| Realizado por: ".$rw_ven[0]." <br> Terminal: ".$row['PC']." Fecha/Hora: ".$row['audit']."|".$total_doc;
				break;
			case 'recuperar':
				$total=$_REQUEST['total_mon'];
				$tot=0;
				$saldo=0;
				?>
				<table width="350" border="0">
					<?php foreach ($_SESSION['pagoslet'][0] as $subkey=> $subvalue) {
						switch($_SESSION['pagoslet'][6][$subkey]){
							case 'A':$color="#FF0000";break;
							case 'P':$color="#009966";break;
							default:$color="";break;
						}
						$cod=$_SESSION['pagoslet'][1][$subkey];
						$num=$_SESSION['pagoslet'][2][$subkey];
						$dias=$_SESSION['pagoslet'][5][$subkey];
						?>
					<tr bgcolor="<?php echo $color;?>">
						<td width="24"><font size="-3"><?php echo $cod;?></font></td>
						<td width="67" align="center" valign="middle"><input style="font-size:9px; width:65px" <?php echo $_SESSION['disable'][0][$subkey];?> onkeyup="RecalcularLetra(this,event,'<?php echo $subkey;?>')" height="12" type="text" name="numlet[]" id="numlet[]" value="<?php echo $num;?>"></td>
						<td width="64" align="center"><input style="font-size:9px; width:46px" <?php echo $_SESSION['disable'][0][$subkey];?> onkeyup="RecalcularLetra(this,event,'<?php echo $subkey;?>')" height="12" type="text" name="monto[]2" id="monto[]2" value="<?php echo $_SESSION['pagoslet'][3][$subkey];?>" /></td>
						<td width="70"><input style="font-size:9px; width:70px" <?php echo $_SESSION['disable'][0][$subkey];?> onkeyup="RecalcularLetra(this,event,'<?php echo $subkey;?>')" height="12" type="text" name="fecha[]" id="fecha[]" value="<?php echo formatobarrafecha($_SESSION['pagoslet'][4][$subkey]);?>"></td>
						<td width="34" align="center" valign="middle"><font size="-3"><?php echo $dias;?>
						  <?php if($color==""){$tot=$_SESSION['pagoslet'][3][$subkey]+$tot;}?>
					  </font></td>
						<td width="35" align="center" valign="middle"><img src="../imgenes/eliminar.png" onclick="ElimLet('<?php echo $_SESSION['pagoslet'][0][$subkey];?>')" /></td>
						<td width="26"><img height="22" width="22" onclick="ImprimirLet('<?php echo $_SESSION['pagoslet'][0][$subkey];?>')" src="../imgenes/fileprint.gif" />
					</tr>
					<?php }?>
				</table>
				|
				<?php
					$saldo=$total-$tot;
					echo number_format($tot,2,'.','')."|".number_format($saldo,2,'.','');
					break;
					
					
					
			}
	;break;
}
?>