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
				$fecha=$_REQUEST['fec1'];
				$candia=$_REQUEST['dias'];
				$pagina=$_REQUEST['pagina'];
				$fechaini=extraefecha($fecha);
				$fechafin=suma_fecha($fechaini,number_format($candia,0,'',''));
				//echo $fechaini."//".$fechafin;
				$ListaClientes=$ml->MostrarClientesVencimiento($fechaini,$fechafin,$pagina);
				?>
                <table border="0">
                <tr>
                <?php
				for($i=strtotime($fechaini);$i<=strtotime($fechafin);$i=$i+86400){
					?>
                    <td style='font-size:12px' width="85">
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
				?>
                <table width="219" border="0" cellpadding="0" cellspacing="0">
                <?php 
					$conca="";
					$divs="<table border='0'>";
					for($i=0;$i<count($ListaClientes);$i++){
						?>
						<tr><td width="219" height="43" style="font-size:12px">
                        <?php
						$ml->cliente=$ListaClientes[$i]['codigo'];
						$ListaDatosClientes=$ml->MostrarDatosCliente();
						echo str_pad($ListaDatosClientes[0]['codcliente'],6,'0',STR_PAD_LEFT)." - ".caracteres($ListaDatosClientes[0]['razonsocial']);
						?></td></tr>
                        <?php
						$divs.="<tr><td  width='710' style='font-size:12px'><div id='progra".$ListaClientes[$i]['codigo']."'></div></td></tr>";
						if($i<count($ListaClientes)-1){
							$conca.=$ListaClientes[$i]['codigo'].",";
						}else{
							$conca.=$ListaClientes[$i]['codigo'];
						}
					}
					$divs.="</table>";
				?>
</table>
                <input type="hidden" name="codig" id="codig" value="<?php echo $conca;?>" />
                <?php
				echo "|".$divs;
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
		}
	;break;
}
?>