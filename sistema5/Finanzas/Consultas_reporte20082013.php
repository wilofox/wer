<?php
session_start();
include_once('../funciones/funciones.php');
$modulo=$_REQUEST['modulo'];
switch($modulo){
	case 'rptletvenc':
		include_once('mcc/MLetras.php');
		$ml=new MLetras();
		$operacion=$_REQUEST['operacion'];
		switch($operacion){
			case 'ListarClientes':
				echo "clientes1|";
				$tipo=$_REQUEST['tipo'];
				$sucursal=$_REQUEST['sucursal'];
				$estado=$_REQUEST['estado'];
				$moneda=$_REQUEST['moneda'];
				$ml->tipo=$tipo;
				$ml->cod_suc=$sucursal;
				$ml->estado=$estado;
				$ml->moneda=$moneda;
				$fecha=$_REQUEST['fec1'];
				$candia=$_REQUEST['dias'];
				if($_REQUEST['pagina']==''){
					$pagina=number_format(0,0,'.','');
				}else{
					$pagina=number_format($_REQUEST['pagina'],0,'.','');
				}
				$fechaini=extraefecha($fecha);
				$fechafin=suma_fecha($fechaini,number_format($candia,0,'',''));
				//echo "<br>".$pagina."<br>";
				//echo $fechaini."//".$fechafin;
				//echo $ml->MostrarClientesVencimiento($fechaini,$fechafin,$pagina);
				$registros=4;
				$ListaClientes=$ml->MostrarClientesVencimiento($fechaini,$fechafin,$pagina,$registros);
				$xwidth=85*($candia+1);
				?>
                <table border="0" width="<?php echo $xwidth; ?>" cellpadding="0" cellspacing="0">
                <tr style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
                <?php
				for($i=strtotime($fechaini);$i<=strtotime($fechafin);$i=$i+86400){
					?>
                    <td style='font-size:12px' width="85" height="40" align="center">
                    <?php
					$dia=date('Y-m-d',$i);
					$vdia=explode("||",diasemana($dia));
					echo $vdia[0]."<br>".$vdia[1];
					?>
                    </td>
					<?php
				}
				?>
                </tr>
                </table>
                <?php
				echo "|";
				//219 - 259 - 329
				echo "<table width='359' border='0' cellpadding='0' cellspacing='0'>";
					$conca="";
					$divs="<table border='0' style='width=auto'>";
					for($i=0;$i<count($ListaClientes);$i++){
						echo "<tr><td width='359' height='50' style='font-size:11px'>";
						$ml->cliente=$ListaClientes[$i]['codigo'];
						$ListaDatosClientes=$ml->MostrarDatosCliente();
						echo str_pad($ListaDatosClientes[0]['codcliente'],6,'0',STR_PAD_LEFT)." - ".caracteres($ListaDatosClientes[0]['razonsocial'])."</td></tr>";
						//710=7
						$xwidth=96*$candia;
						$width="width='".$xwidth."'";
						/*switch($candia){
							case 7:$width="width='710'";break;
							case 15:$width="width='1110'";break;
							case 30:$width="width='2110'";break;
						}*/
						$divs.="<tr><td ".$width." style='font-size:12px'><table border='0' ".$width."><tr>";
						$fc=strtotime(extraefecha($fecha));
						for($j=0;$j<=$candia;$j++){
							$nf=number_format($fc,0,'.','')+($j*86400);
							$tm_fecha=date('Y-m-d',$nf);
							$ListaDocumentos=$ml->MostrarDocumentosVencimiento($tm_fecha);
							$ListaLetras=$ml->MostrarLetrasVencimiento($tm_fecha);
							$divs.="<td width='98' height='43' align='center' style='font-size:12px'>";
							if(count($ListaDocumentos)!=0){
								$divs.="<a href=javascript:view_doc('doc','".$ml->cliente."','".$tm_fecha."')>".count($ListaDocumentos)." Docs.</a> <br>";
							}else{
								$divs.=" - Docs. <br>";
							}
							if(count($ListaLetras)!=0){
								$divs.="<a href=javascript:view_doc('let','".$ml->cliente."','".$tm_fecha."')>".count($ListaLetras)." Letras</a>";
							}else{
								$divs.=" - Letras";
							}
							$divs.="</td>";
						}
						$divs.="</tr></table>";
					}
				?>
</table>
                <input type="hidden" name="codig" id="codig" value="<?php echo $conca;?>" />
                <?php
				echo "|".$divs;
				echo "|";
				$listaxgeneral=$ml->MostrarClientesVencimiento($fechaini,$fechafin,'total',$registros);
				$total_reg=count($listaxgeneral);
				$total_paginas = ceil($total_reg / $registros);
				if($pagina==0){
					$pagina=1;
				}
				if ($pagina=='') { 
					$inicio = 0; 
					$pagina = 1; 
				} else { 
					$inicio = ($pagina - 1) * $registros; 
				}
				?>
                <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                	<td width="217">Viendo del <?php echo ($inicio+1) ?> al <?php if(($registros*$pagina)>$total_reg){ echo $total_reg;}else{ echo ($registros*$pagina);} ?> de <?php echo $total_reg; if($tipo==1){echo " Proveedores";}else{ echo " Clientes";} ?></td>
                    <td width="510" align="right">P&aacute;gina <?php 
						for($i=1;$i<=$total_paginas;$i++){
							if($i==$pagina){
								echo "<b> ".$i." </b>";
							}else{
								echo "<a href='javascript:CargarCliente($i)'> ".$i." </a>";
							}
						}
					?></td>
                </tr>
                </table>
                <?php
			break;
			case 'ConsultaPendiente':
				$codigo=$_REQUEST['codigo'];
				$fecha=$_REQUEST['fec1'];
				$candia=$_REQUEST['dias'];
				$clientex=explode(",",$codigo);
				$pos=number_format($_REQUEST['pos'],0,'.','');
				$ml->cliente=$clientex[$pos];
				echo "progra".$ml->cliente."|";
				?>
				<table border='0'>
                <tr>
                <?php
				/*$fc=strtotime(extraefecha($fecha));
				for($i=0;$i<=$candia;$i++){
					$nf=number_format($fc,0,'.','')+($i*86400);
					$tm_fecha=date('Y-m-d',$nf);
					$ListaDocumentos=$ml->MostrarDocumentosVencimiento($tm_fecha);
					$ListaLetras=$ml->MostrarLetrasVencimiento($tm_fecha);
					?>
                    <td width="90" align="center" style='font-size:12px'>
                    <?php 
					if(count($ListaDocumentos)!=0){
						echo "<a href=javascript:view_doc('doc','".$ml->cliente."','".$tm_fecha."')>".count($ListaDocumentos)." Docs.</a> <br>";
					}else{
						echo " - Docs. <br>";
					}
					if(count($ListaLetras)!=0){
						echo "<a href=javascript:view_doc('let','".$ml->cliente."','".$tm_fecha."')>".count($ListaLetras)." Letras</a>";
					}else{
						echo " - Letras";
					}
					?>
                    </td>
                    <?php
				}*/
				?>
                </tr>
                </table>
                <?php
				echo "|".(number_format($_REQUEST['pos'],0,'.','')+1);
				echo "|".count($clientex);
			break;
			case 'excel':
				case 'ListarClientes':
				$tipo=$_REQUEST['tipo'];
				$sucursal=$_REQUEST['sucursal'];
				$estado=$_REQUEST['estado'];
				$moneda=$_REQUEST['moneda'];
				$ml->tipo=$tipo;
				$ml->cod_suc=$sucursal;
				$ml->estado=$estado;
				$ml->moneda=$moneda;
				$fecha=$_REQUEST['fec1'];
				$candia=$_REQUEST['dias'];
				$pagina=$_REQUEST['pagina'];
				$fechaini=extraefecha($fecha);
				$fechafin=suma_fecha($fechaini,number_format($candia,0,'',''));
				$registros=7;
				$ListaClientes=$ml->MostrarClientesVencimiento($fechaini,$fechafin,$pagina,$registros);
				$xwidth=85*($candia+1);
				$titulo="Reporte de Cuentas de ";
				if($tipo=='1'){
					$titulo.="Pagos ";
				}else{
					$titulo.="Cobranzas ";
				}
				$titulo.=" a ".$candia." d&iacute;as";
				$div1="
	<table border='1'>
	<tr>
		<td colspan='".($candia+2)."' align='center' style='font-size:18px'>$titulo</td>
	</tr>
	<tr style='background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px'>
		<td height='40'>&nbsp;</td>
		<td height='40' colspan='".($candia+1)."' align='center'>Dias</td>
	</tr>			
	<tr style='background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px'>
		<td align='center' valign='top' height='40' style='background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px'>Cliente</td>
";
				for($i=strtotime($fechaini);$i<=strtotime($fechafin);$i=$i+86400){
                    $div1.="		<td style='font-size:12px' width='140' align='center'>";
					$dia=date('Y-m-d',$i);
					$vdia=explode("||",diasemana($dia));
					$div1.=$vdia[0]."<br>".$vdia[1];
                    $div1.="</td>
";
				}
                $div1.="
	</tr>
	";
				for($i=0;$i<count($ListaClientes);$i++){
	$div1.="<tr>
		<td style='font-size:12px' valign='center'>";
						$ml->cliente=$ListaClientes[$i]['codigo'];
						$ListaDatosClientes=$ml->MostrarDatosCliente();
						$div1.=str_pad($ListaDatosClientes[0]['codcliente'],6,'0',STR_PAD_LEFT)." - ".caracteres($ListaDatosClientes[0]['razonsocial'])."</td>
		";
						//710=7
						$fc=strtotime(extraefecha($fecha));
						for($j=0;$j<=$candia;$j++){
							$nf=number_format($fc,0,'.','')+($j*86400);
							$tm_fecha=date('Y-m-d',$nf);
							$ListaDocumentos=$ml->MostrarDocumentosVencimiento($tm_fecha);
							$ListaLetras=$ml->MostrarLetrasVencimiento($tm_fecha);
							$div1.="<td style='font-size:10px' valign='center'>";
							if(count($ListaDocumentos)!=0){
								$div1.="Doc : ".$ListaDocumentos[0]['cod_docu'];
								if($ListaDocumentos[0]['serie_docu']!=""){
									$div1.=" ".$ListaDocumentos[0]['serie_docu']."-".$ListaDocumentos[0]['numero_docu'];
								}else{
									$div1.=" ".$ListaDocumentos[0]['numero_docu'];
								}
								$div1.="<br>";
								$ml->moneda=$ListaDocumentos[0]['moneda'];
								$ListaMoneda=$ml->MostrarMoneda();
								$div1.="Saldo : ".$ListaMoneda[0]['simbolo']." ".$ListaDocumentos[0]['saldo'];
							}else{
								$div1.="&nbsp;-- Docs";
							}
							$div1.="<br>";
							if(count($ListaLetras)!=0){
								$div1.="Doc : ".$ListaLetras[0]['cod_docu'];
								if($ListaLetras[0]['serie_docu']!=""){
									$div1.=" ".$ListaLetras[0]['serie_docu']."-".$ListaLetras[0]['numero_docu'];
								}else{
									$div1.=" ".$ListaLetras[0]['numero_docu'];
								}
								$div1.="<br>";
								$ml->moneda=$ListaLetras[0]['moneda'];
								$ListaMoneda=$ml->MostrarMoneda();
								$div1.="Saldo : ".$ListaMoneda[0]['simbolo']." ".$ListaLetras[0]['saldo'];
							}else{
								$div1.="&nbsp;-- Letras.";
							}
							$div1.="</td>";
						}
						$div1.="</tr>";
					}
				$div2.="</table>";
				header("Content-type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename=excel.xls");
echo "
$div1
</table>";
			break;
		}
	;break;
}
?>