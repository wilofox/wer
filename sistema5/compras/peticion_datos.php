<?php 
session_start();
include('../conex_inicial.php');
include('../funciones/funciones.php');

$serie=$_REQUEST['serie'];
$numero=$_REQUEST['numero'];
$doc=$_REQUEST['doc'];
$sucursal=$_REQUEST['sucursal'];
$peticion=$_REQUEST['peticion'];
$auxiliar=$_REQUEST['auxiliar'];
$temp_doc=$_REQUEST['temp_doc'];
$responsable=$_REQUEST['responsable'];
$tipomov=$_REQUEST['tipomov'];
$tienda=$_REQUEST['tienda'];
$condicion=$_REQUEST['condicion'];
$femision=$_REQUEST['femision'];
$fvencimiento=$_REQUEST['fvencimiento'];
$monto=$_REQUEST['monto'];
$impuesto1=$_REQUEST['impuesto1'];
$total_doc=$_REQUEST['total_doc'];
$incluidoigv=$_REQUEST['incluidoigv'];
$moneda=$_REQUEST['tmoneda'];
$fecha_aud=gmdate('Y-m-d H:i:s',time()-18000);
$kardex_doc=$_REQUEST['kardex_doc'];
$act_kardex_doc=$_REQUEST['act_kardex_doc'];
	
$impto=$_REQUEST['impto']*100;
$transportista=$_REQUEST['transportista'];
$chofer=$_REQUEST['chofer'];
$nom_chofer=$_REQUEST['nom_chofer'];
$percepcion=$_REQUEST['percepcion'];
$porcen_percep=$_REQUEST['porcen_percep'];
$dirPartida=$_REQUEST['dirPartida'];
$dirDestino=$_REQUEST['dirDestino'];
$idAreaCosto=$_REQUEST['idAreaCosto'];
$numeroOT=$_REQUEST['numeroOT'];
$serieOT=$_REQUEST['serieOT'];

$obs1=$_REQUEST['obs1'];
$obs2=$_REQUEST['obs2'];
$obs3=$_REQUEST['obs3'];
$obs4=$_REQUEST['obs4'];
$obs5=$_REQUEST['obs5'];

$correlativo_ref=$_REQUEST['correlativo_ref'];
$serie_ref=$_REQUEST['serie_ref'];
$cod_cab_ref=$_REQUEST['cod_cab_ref'];
$fecharegis=$_REQUEST['fecharegis'];
$tipoDescuento=$_REQUEST['tipoDescuento'];

$campo="saldo".$tienda;
$campo0="costo_inven".$sucursal;

//$moneda="01";
//$tc="";

$temp_fecha=cambiarfecha($femision);
//echo $peticion;
switch($peticion){
	case "buscar_prov":
		$strSQL="select * from cab_mov where tipo='1' and  sucursal='$sucursal' and cod_ope='$doc' and serie='$serie' and Num_doc='$numero'";
		$resultado=mysql_query($strSQL,$cn);
		while($row=mysql_fetch_array($resultado)){
			$cadena=$cadena.$row['cliente']."-";
		}
		echo $cadena;	
		break;
	
	case "buscar_prov2":
		
		if(!isset($_REQUEST['auxiliar'])){
			$strSQL="select * from cab_mov where tipo='".$tipomov."' and  sucursal='$sucursal' and cod_ope='$doc' and serie='$serie' and Num_doc='$numero'";
		}else{	
			$strSQL="select * from cab_mov where tipo='".$tipomov."' and  sucursal='$sucursal' and cod_ope='$doc' and serie='$serie' and Num_doc='$numero' and cliente='$auxiliar'";
		}
		
		$resultado=mysql_query($strSQL,$cn);
		while($row=mysql_fetch_array($resultado)){
			$cadena=$row['cod_cab'];
		    $cadena2=$row['tienda'];
			$cadena3=$row['cod_vendedor'];
			$cadena4=$row['condicion'];
			$cadena5=extraefecha($row['fecha']);
			$cadena6=extraefecha($row['f_venc']);
			$cadena8=$row['incluidoigv'];
			$cadena9=$row['moneda'];
			$cadena10=$row['flag'];
			$cadena13=$row['flag_r'];
			$cadena15=$row['impto1'];
			$cadena16=$row['transportista'];
			$cadena17=$row['chofer'];
			$cadena18=$row['percepcion'];
			$cadena19=$row['cliente'];
			$cadena20=$row['numeroOT'];
			$cadena22=$row['obs1'];
			$cadena23=$row['obs2'];
			$cadena24=$row['obs3'];
			$cadena25=$row['obs4'];
			$cadena26=$row['obs5'];
			 
			$cadena27=$row['fecha_aud'];
			$cadena28=$row['pc'];
			$cadena29=$row['usuario'];
			 
			 
			$_SESSION['montoFlete']=$row['flete'];
			 
			 
			list($nom_transp)=mysql_fetch_row(mysql_query("select nombre from transportista where id='".$cadena16."'"));
			list($nom_chofer)=mysql_fetch_row(mysql_query("select nombre from chofer where cod='".$cadena17."'"));
			 
			 	 
			$strSQLAC="select * from areacosto where id='".$row['areaCosto']."'";
			$resultadoAC=mysql_query($strSQLAC,$cn);
			$rowAC=mysql_fetch_array($resultadoAC);
				
			$cadena21=$rowAC['nombre'];
			 
			if(!isset($_REQUEST['auxiliar'])){
				$strSQLx="select * from cliente where codcliente='".$row['cliente']."'";
				$resultadox=mysql_query($strSQLx,$cn);
				$rowx=mysql_fetch_array($resultadox);
				$cadena7=caracteres($rowx['razonsocial']);
			}
			 			 
		}
		
		
		//estados :  R=reservado  G=Guardado
		//tipomov : compras=1  ventas=2
		
		if($cadena==""){
			//verificando antes de reservar numero------------------------------
			if($tipomov==2){
				$strSQL2223="select * from tempdoc where sucursal='$sucursal' and doc='$doc' and serie='$serie'  and numero='$numero' ";
				$resultado2223=mysql_query($strSQL2223,$cn);
				$contador=mysql_num_rows($resultado2223);
				//$row2223=mysql_fetch_array($resultado2223);
			}else{
				$contador=0;
			}
			//echo $contador;
			//break;
			//echo $contx;
			//---------------------------------------------------------
			if($contador==0){
				$strSQL2="select  max(id) as id from tempdoc";
				$resultado2=mysql_query($strSQL2,$cn);
				$row2=mysql_fetch_array($resultado2);
				
				$id=$row2['id']+1;
				//$estado="R";
				//$strSQL3="DELETE FROM tempdoc WHERE estado='R' and doc='".$doc."' and tipodoc='".$tipomov."' and  serie='".$serie."' ";
				//mysql_query($strSQL3,$cn);				
				$strSQL3="insert into tempdoc(id,sucursal,tipodoc,doc,serie,numero,auxiliar,estado,usuario)values('".$id."','".$sucursal."','".$tipomov."','".$doc."','".$serie."','".$numero."','".$auxiliar."','R','".$_SESSION['codvendedor']."')";
				mysql_query($strSQL3,$cn);				
				echo $cadena=$id."?reservado?";	
			}else{
			    echo $cadena=$id."?noreservado?";	
			}
		}else{
			$strSQL_ref="select * from referencia where cod_cab='$cadena' ";
			$resultado_ref=mysql_query($strSQL_ref,$cn);
			$row=mysql_fetch_array($resultado_ref);
			$cadena11=$row['serie'];
			$cadena12=$row['correlativo'];
			$cadena14=$row['cod_cab_ref'];
			
			if($tipomov==2){
				$filtro=" and salida='".$cadena."' ";
				$filtro2=" and salida='".$cadena14."' ";
			}else{
				$filtro=" and ingreso='".$cadena."' ";
				$filtro2=" and ingreso='".$cadena14."' ";
			}
			$tserie="N";
			$strSQL3="select * from det_mov where cod_cab='$cadena' order by cod_det";
			$resultado3=mysql_query($strSQL3,$cn);
			while($row3=mysql_fetch_array($resultado3)){
				if($row3['cod_prod']!='TEXTO'){
					if($row3['codOferta']!='000000'){
						$_SESSION['boni'][0][]=$row3['cod_prod'];
						$_SESSION['boni'][1][]=$row3['nom_prod'];
						$_SESSION['boni'][2][]=$row3['unidad'];
						$_SESSION['boni'][3][]=$row3['cantidad'];
						$_SESSION['boni'][4][]=$row3['codOferta'];
					}else{
						$_SESSION['productos'][0][] = $row3['cod_prod'];
						$_SESSION['productos'][1][] = $row3['cantidad'];	
						$_SESSION['productos'][2][] = $row3['precio'];
						$_SESSION['productos'][3][] = $row3['notas'];	
						$_SESSION['productos'][4][] = $row3['unidad'];	
						
						$_SESSION['productos'][7][] = $row3['ancho'];	
						$_SESSION['productos'][8][] = $row3['largo'];	
						$_SESSION['productos'][9][] = $row3['mt2'];	
						$_SESSION['productos'][10][] = $row3['factor'];	
						$_SESSION['productos'][11][] = $row3['descOT'];	
						$_SESSION['productos'][13][] = "";	
						$_SESSION['productos'][14][]= "";	
						$_SESSION['productos'][20][]= count($_SESSION['productos'][20])+1;
						$_SESSION['productos'][21][]= $row3['desc1'];	
						$_SESSION['productos'][22][]= $row3['desc2'];
						$_SESSION['productos'][23][]= $row3['puntos'];
						$_SESSION['productos'][24][]= $row3['envases'];	
						
						$strSQL005="select * from series where producto='".$row3['cod_prod']."' ".$filtro;
						$resultado005=mysql_query($strSQL005,$cn);
						
						while($row005=mysql_fetch_array($resultado005)){	
							$_SESSION['seriesprod'][0][]=$row005['serie'];
							$_SESSION['seriesprod'][1][]=$fvenc;
							$_SESSION['seriesprod'][2][]=$row3['cod_prod'];
							$tserie="S";
						}
						if($cadena14!=''){
							$strSQL005="select * from series where producto='".$row3['cod_prod']."' ".$filtro2;
							$resultado005=mysql_query($strSQL005,$cn);
							
							while($row005=mysql_fetch_array($resultado005)){	
								$_SESSION['seriesprod'][0][]=$row005['serie'];
								$_SESSION['seriesprod'][1][]=$fvenc;
								$_SESSION['seriesprod'][2][]=$row3['cod_prod'];
								$tserie="S";
							}		
						}
								
					}	
				}else{
					$_SESSION['productos'][0][] = "";
					//$_SESSION['productos'][1][] = "";
					$_SESSION['productos'][1][] = $row3['cantidad'];	
					$_SESSION['productos'][2][] = $row3['precio'];
					$_SESSION['productos'][3][] = $row3['notas'];	
					$_SESSION['productos'][4][] = $row3['unidad'];
					$_SESSION['productos'][13][] = $row3['nom_prod'];	
					$_SESSION['productos'][14][]=$row3['prodpase'];
					$_SESSION['productos'][20][]= count($_SESSION['productos'][20])+1;
					$_SESSION['productos'][21][]= $row3['desc1'];
					$_SESSION['productos'][22][]= $row3['desc2'];
				}
			}
			echo $cadena=$cadena."?encontrado?".$cadena2."?".$cadena3."?".$cadena4."?".$cadena5."?".$cadena6."?".$cadena7."?".$cadena8."?".$cadena9."?".$cadena10."?".$cadena11."?".$cadena12."?".$cadena13."?".$cadena14."?".$cadena15."?".$cadena16."?".$cadena17."?".$cadena18."?".$cadena19."?".$cadena20."?".$cadena21."?".$nom_transp."?".$nom_chofer."?".$tserie."?".$cadena22."?".$cadena23."?".$cadena24."?".$cadena25."?".$cadena26."?".$cadena27."?".$cadena28."?".$cadena29."?";
		}
	break;	
	case "save_importacion":
	//-------------------------------------------------------------------------------------------
		$strSQL="select  max(cod_cab) as cod_cab from cab_mov";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$codigo=$row['cod_cab']+1;
		
		$strSQL2="select  *  from tempdoc  where id='$temp_doc'";
		$resultado2=mysql_query($strSQL2,$cn);
		$row2=mysql_fetch_array($resultado2);
		$sucursal=$row2['sucursal'];
		$doc=$row2['doc'];
		$serie=$row2['serie'];
		$numero=$row2['numero'];
		$auxiliar=$_REQUEST['auxiliar'];
		$items=count($_SESSION['productos'][0]);
	
	//-------------------Busca permiso de doc----------------------------------------------
		
		$strSQL_doc="select * from operacion where codigo='".$doc."' and  tipo='".$tipomov."' ";
		$resultado_doc=mysql_query($strSQL_doc,$cn);
		$row_doc=mysql_fetch_array($resultado_doc);
		  
		$permiso10=substr($row_doc['p1'],9,1);
		$permiso4=substr($row_doc['p1'],3,1);
		$act_kar_IS=$row_doc['kardex'];
		$deuda=substr($row_doc['p1'],4,1);
		//$impto=$row_doc['imp1'];
		  
		$valor_imp = 1 + ($impto/100); 
		$tc=$_SESSION['tc'];	
 		
		if($permiso10=='S'){	
			switch($act_kar_IS){
				case "I":
					$act_kar_IS="1";
					break;
				 
				case "S":
					$act_kar_IS="2";
					break;
				 
				default:
					$act_kar_IS="";
			}	
		}else{
			$act_kar_IS="";		
		}	
		
		if ($condicion==''){$condicion=1;}		
			//---------------------------------------------------------------	
			$strSQL3="insert into cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,caja,cliente,ruc,fecha,f_venc,moneda,impto1,tc,b_imp,igv,servicio,percepcion,total,saldo,tienda,sucursal,flag,flag_r,motivo,noperacion,items,condicion,incluidoigv,obs1,obs2,obs3,obs4,obs5,inafecto,fecha_aud,pc,kardex,deuda,transportista,chofer,dirPartida,dirDestino,numeroOT)values('".$codigo."','".$tipomov."','".$doc."','".$numero."','".$serie."','".$responsable."','".$caja."','".$auxiliar."','".$ruc."','".cambiarfecha($femision)."','".cambiarfecha($fvencimiento)."','".$moneda."','".$impto."','".$_SESSION['tc']."','".$monto."','".$impuesto1."','".$servicio."','".$percepcion."','".$total_doc."','".$saldo."','".$tienda."','".$sucursal."','".$flag."','".$flag_r."','".$motivo."','".$noperacion."','".$items."','".$condicion."','".$incluidoigv."','".$obs1."','".$obs2."','".$obs3."','".$obs4."','".$obs5."','".$permiso4."','".$fecha_aud."','".$_SESSION['pc_ingreso']."','".$permiso10."','".$deuda."','".$transportista."','".$chofer."','".$dirPartida."','".$dirDestino."','".$serieOT."-".$numeroOT."')"; 		
			mysql_query($strSQL3,$cn);
		
			foreach ($_SESSION['productos3'][0] as $subkey=> $subvalue) { /// detalle

				$imp_item=($_SESSION['productos3'][1][$subkey]*$_SESSION['productos3'][2][$subkey])-$_SESSION['productos3'][11][$subkey];
				$total_kardex='N';

				$strSQL4="select * from producto where cod_prod='".$subvalue."' ";
				$resultado4=mysql_query($strSQL4,$cn); 
				$rowX=mysql_num_rows($resultado4);
				if ($rowX==1){ //--- existe producto
					while($row4=mysql_fetch_array($resultado4)){
						$prod_igv=$row4['igv'];
						$und_pr=$row4['und'];
						$factor_pr=$row4['factor']; 
		
						if($tipomov=='1'){
			 				//-------------------------Calculo Costo Inventario subunidad----------------------------
							$strSQL_unid100="select * from unixprod where producto='".$row4['idproducto']."' and unidad='".$_SESSION['productos3'][4][$subkey]."'";
							$resultado_unid100=mysql_query($strSQL_unid100,$cn);
							$row_unid100=mysql_fetch_array($resultado_unid100);
							$factor_subund100=$row_unid100['factor'];
							if($factor_subund100=='' || $factor_subund100==0){
								$factor_subund100=1;
							}
							
							$imp_item=$imp_item/$factor_subund100;
							//-------------------------------------------------------------
							
							if($moneda=="02"){
								$imp_item2=$imp_item*$_SESSION['tc'];
							}else{
								$imp_item2=$imp_item;
							}
				 			
							if($permiso4=='N'){
								if($incluidoigv=='S' && $prod_igv=='S'){
									$imp_item2=$imp_item2/$valor_imp;
								}
							}
							$costo_inven1=calc_costo_inv($subvalue,$fecha_aud,$imp_item2,$_SESSION['productos3'][1][$subkey],$campo,$campo0);
							$strSQL_sal="select saldo_actual from det_mov d,cab_mov c where c.cod_cab=d.cod_cab and cod_prod='".$subvalue."' order by fechad desc,cod_det desc limit 1";
							
							$resultado_sal=mysql_query($strSQL_sal,$cn);
							$row_sal=mysql_fetch_array($resultado_sal);
							$salidas=$row_sal['saldo_actual'];		 				 
							$saldo_actual=$salidas+$_SESSION['productos3'][1][$subkey];
						}else{
							$strSQL_sal="select saldo_actual from det_mov d,cab_mov c where c.cod_cab=d.cod_cab and  cod_prod='".$subvalue."' order by fechad desc, cod_det desc limit 1";
							
							$resultado_sal=mysql_query($strSQL_sal,$cn);
							$row_sal=mysql_fetch_array($resultado_sal);
							$salidas=$row_sal['saldo_actual'];
							$saldo_actual=$salidas-$_SESSION['productos3'][1][$subkey];
						}
						
						$kardex_pro=$row4['kardex'];
						if($permiso10=='S'){
							if($kardex_pro=='S'){
								$total_kardex='S';
							}else{
								$total_kardex='N';
							}
						}
						$afecto=$row4['igv'];
						if($percepcion==0){
							$flag_percep='N';
							$porcen_percep_det=0;
						}else{
							if($porcen_percep!=0){
								$porcen_percep_det=$porcen_percep;
							}else{
								$porcen_percep_det=$row4['valor_percep'];
							}
							
							if($row4['agente_percep']=='S'){
								$flag_percep='S';
							}else{
								$flag_percep='N';
								$porcen_percep_det=0;
							}
						}
						$act_kar_IS='';
						$strSQL444="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,tcambio,moneda,precio,cantidad,imp_item,fechad,descargo,afectoigv,costo_inven,saldo_actual,notas,flag_kardex,unidad,flag_percep,porcen_percep,ancho,largo,mt2,factor,descOT,codanex,desc1) values('".$codigo."','".$tipomov."','".$doc."','".$serie."','".$numero."','".$auxiliar."','".$tienda."','".$sucursal."','".$row4['idproducto']."','".addslashes($row4['nombre'])."','".$tc."','".$moneda."','".$_SESSION['productos3'][2][$subkey]."','".$_SESSION['productos3'][1][$subkey]."','".$imp_item."','".cambiarfecha($femision)."','".$kardex_pro."','".$afecto."','".number_format($costo_inven1,2)."','".$saldo_actual."','".$_SESSION['productos3'][3][$subkey]."','".$act_kar_IS."','".$_SESSION['productos3'][4][$subkey]."','".$flag_percep."','".$porcen_percep_det."','".$_SESSION['productos3'][7][$subkey]."','".$_SESSION['productos3'][8][$subkey]."','".$_SESSION['productos3'][9][$subkey]."','".$_SESSION['productos3'][10][$subkey]."','".$_SESSION['productos3'][11][$subkey]."','".$_SESSION['productos3'][12][$subkey]."','".$desc1."')";
						mysql_query($strSQL444,$cn);
					}
				}else{ // no existe
					
					$strSQLZ="select  max(idproducto) as idproducto from producto";
					$resultadoZ=mysql_query($strSQLZ,$cn);
					$rowZ=mysql_fetch_array($resultadoZ);
					$idprod2=$rowZ['idproducto']+1;
					//verifica codigo vacios---------
					$resultados2rX = mysql_query("select * from producto order by idproducto ",$cn);
					$roxcountX=mysql_num_rows($resultados2rX);			
					
					for ($i = 1; $i <= $roxcountX; $i++) {
						$codT=str_pad($i, 6, "0", STR_PAD_LEFT);
						if ($stop==''){
							$rt = mysql_query("select * from producto where idproducto='".$codT."' ",$cn);
							$row2rt=mysql_fetch_array($rt);
							$roxT=mysql_num_rows($rt);
							if ($roxT==0){
								$idprod2=$codT;
								$stop='SI';
							}
						}
					}
					
					$idprod2=str_pad($idprod2, 6, "0", STR_PAD_LEFT);
					//verifica codigo vacios fin
					$campo="saldo".$tienda;
					$act_kar_IS='S';
					
					if ($moneda=='02'){
						$procostodolar=$tc*$_SESSION['productos3'][2][$subkey];
					}else{
						$procostodolar=$_SESSION['productos3'][2][$subkey];
					}
					//crear producto
					
					$strSQL444="
 insert into producto(idproducto,cod_prod,clasificacion ,categoria, subcategoria,nombre,und,factor,precio,igv,kardex,moneda,subunidad,series,
 garantia,agente_percep,valor_percep,factorOT,".$campo.",costo_inven1)
  values ('".$idprod2."','".$_SESSION['productos3'][0][$subkey]."'
 ,'".$_SESSION['productos3'][15][$subkey]."','".$_SESSION['productos3'][16][$subkey]."','".$_SESSION['productos3'][17][$subkey]."','".$_SESSION['productos3'][13][$subkey]."','".$_SESSION['productos3'][4][$subkey]."','1','0','S','".$act_kar_IS."','01','N','N','3','N','0','N','0','".$procostodolar."'
 )"; 

					//".$_SESSION['productos3'][1][$subkey]."  ---> $campo
 
					mysql_query($strSQL444,$cn);
					//insert det_mod
					//$idprod2='000000';
					$nomprod2=$_SESSION['productos3'][13][$subkey];
					$flag_percep='N';
					$kardex_pro='S';//S
					$afecto='S';
					//$costo_inven1='0';
					$saldo_actual=$_SESSION['productos3'][1][$subkey];
					$act_kar_IS='';
					
					//------------------------------------
					if($moneda=="02"){
						$imp_item2=$imp_item*$_SESSION['tc'];
					}else{
						$imp_item2=$imp_item;
					}				 						  
					if($permiso4=='N'){
						if($incluidoigv=='S' ){				  
							$imp_item2=$imp_item2/$valor_imp;
						}
					}					 
					$costo_inven1=calc_costo_inv($idprod2,$fecha_aud,$imp_item2,$_SESSION['productos3'][1][$subkey],$campo,$campo0);
					//$costo_inven1=$costo_inven1/1.18;				
					//------------------------------------
					
					$strSQL444="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,tcambio,moneda,precio,cantidad,imp_item,fechad,descargo,afectoigv,costo_inven,saldo_actual,notas,flag_kardex,unidad,flag_percep,porcen_percep,ancho,largo,mt2,factor,descOT,codanex,desc1) values('".$codigo."','".$tipomov."','".$doc."','".$serie."','".$numero."','".$auxiliar."','".$tienda."','".$sucursal."','".$idprod2."','".addslashes($nomprod2)."','".$tc."','".$moneda."','".$_SESSION['productos3'][2][$subkey]."','".$_SESSION['productos3'][1][$subkey]."','".$imp_item."','".cambiarfecha($femision)."','".$kardex_pro."','".$afecto."','".number_format($costo_inven1,2)."','".$saldo_actual."','".$_SESSION['productos3'][3][$subkey]."','".$act_kar_IS."','".$_SESSION['productos3'][4][$subkey]."','".$flag_percep."','".$porcen_percep_det."','".$_SESSION['productos3'][7][$subkey]."','".$_SESSION['productos3'][8][$subkey]."','".$_SESSION['productos3'][9][$subkey]."','".$_SESSION['productos3'][10][$subkey]."','".$_SESSION['productos3'][11][$subkey]."','".$_SESSION['productos3'][0][$subkey]."','".$desc1."')"; 
					
					mysql_query($strSQL444,$cn);
				}	// no existe fin
				
				$strSQL5="update tempdoc set estado='G' where id='$temp_doc'";
				mysql_query($strSQL5,$cn);
			} // fin de detalle
		break;
	case "save_doc":
	
		$serie=$_REQUEST['serie'];
		$numero=$_REQUEST['numero'];
		$doc=$_REQUEST['doc'];
		$sucursal=$_REQUEST['sucursal'];
		$auxiliar=$_REQUEST['auxiliar'];
		$tipomov=$_REQUEST['tipomov'];
		if($serie=="" || $numero=="" || $doc=="" || $sucursal=="" || $auxiliar=="" || $tienda==""){
			echo "error";
			break;
		}
		
		$registros100=0;
		if($tipomov==2){
			$strSQL100="select * from cab_mov where serie='".$serie."' and Num_doc='".$numero."' and cod_ope='".$doc."' and sucursal='".$sucursal."' ";
		}else{
			$strSQL100="select * from cab_mov where serie='".$serie."' and Num_doc='".$numero."' and cod_ope='".$doc."' and sucursal='".$sucursal."' and cliente='".$auxiliar."' ";
		}
		
		$resultado100=mysql_query($strSQL100,$cn);
		$registros100=mysql_num_rows($resultado100);
		$error="error";
		if($doc=='PV'){
			$error="numero";
		}
		if($registros100 > 0){
			echo $error;
			break;
		}
		
		//echo $strSQL100."<br>".$registros100;
		
		$flag_series='S';
		//$flag_ref='N';
		//echo $kardex_doc;
		
		if($serie_ref!="" && $correlativo_ref!="" && $cod_cab_ref!="" && $doc!='NC'){
			$strSQL123="select * from cab_mov where cod_cab='".$cod_cab_ref."'";
			$resultado123=mysql_query($strSQL123,$cn);
			$row123=mysql_fetch_array($resultado123);
			$kardex_doc_ref=$row123['kardex']; // kardex del documento de referencia.
		}else{
			$kardex_doc_ref='N';
		}
		
		if($act_kardex_doc=='S' && $kardex_doc_ref=='N'){
		
			foreach ($_SESSION['productos3'][0] as $subkey=> $subvalue) {
			
				$cant_prod=$_SESSION['productos3'][1][$subkey];
				$strSQL_prod="select kardex,nombre,series from producto where idproducto='".$subvalue."' ";
				$resultado_prod=mysql_query($strSQL_prod,$cn);
				$row_prod=mysql_fetch_array($resultado_prod);
						
				//	echo $strSQL_prod."<br>";
						
				if($row_prod['kardex']=='S'){
					$cant_series=0;
					if(isset($_SESSION['seriesprod'][2]) && $row_prod['series']=='S' ){
						foreach($_SESSION['seriesprod'][2] as $subkey2=> $subvalue2){	
							if($subvalue2==$subvalue){
								$cant_series++;
								if($tipomov=='1' && $doc!='NC'){
									$temp_serie=buscar_series($subvalue,$_SESSION['seriesprod'][0][$subkey2],$tienda);
									if($temp_serie > 0){
										$flag_series='N';
										$prod_no_coincide="serie ingresada:".$_SESSION['seriesprod'][0][$subkey2].":".$row_prod['nombre'];
										break;
									}
								}
							}
						}
					}else{ 
						if($row_prod['series']=='S') {
						//modifcacin rk para que acepte producto con serie sin stock 
							if ($_REQUEST['pds']=='S'){										
								$flag_series='N';
								$prod_no_coincide=$row_prod['nombre'].'1';
							}
						}
						break;				
					}
					
					if($flag_series=='N'){
						break;
					}
					//echo $cant_prod." = ".$cant_series."<br>";
					if($cant_prod!=$cant_series){
						$flag_series='N';
						$prod_no_coincide=$row_prod['nombre'].'2';
						break;				
					}
				}
			}
		}
		
		if($flag_series=='S' && $registros100==0){
			//--------------------------------------------------------------------------------
			$strSQL="select  max(cod_cab) as cod_cab from cab_mov";
			$resultado=mysql_query($strSQL,$cn);
			$row=mysql_fetch_array($resultado);
			$codigo=$row['cod_cab']+1;
			if($doc=='PV'){
				
				$strSQL="select max(Num_doc) as Num_do from cab_mov where tipo='$tipomov' and  sucursal='$sucursal' and cod_ope='$doc' and serie='".str_pad($serie,3, "0", STR_PAD_LEFT)."' and Num_doc>='".str_pad('1',7, "0", STR_PAD_LEFT)."' ";
				
				$resultado=mysql_query($strSQL,$cn);
				$row2=mysql_fetch_array($resultado);
				
				$serie=str_pad($serie,3,"0", STR_PAD_LEFT);
				$numero=str_pad($row2['Num_do']+1,7,"0", STR_PAD_LEFT);
				$auxiliar=$_REQUEST['auxiliar'];
				$items=count($_SESSION['productos'][0]);
			}else{
				$strSQL2="select  *  from tempdoc  where id='$temp_doc'";
				$resultado2=mysql_query($strSQL2,$cn);
				$row2=mysql_fetch_array($resultado2);
				$sucursal=$row2['sucursal'];
				$doc=$row2['doc'];
				$serie=$row2['serie'];
				$numero=$row2['numero'];
				$auxiliar=$_REQUEST['auxiliar'];
				$items=count($_SESSION['productos'][0]);
			}
			
			//-------------------Busca permiso de doc----------------------------------------------
			$strSQL_doc="select * from operacion where codigo='".$doc."' and  tipo='".$tipomov."' ";
			$resultado_doc=mysql_query($strSQL_doc,$cn);
			$row_doc=mysql_fetch_array($resultado_doc);
			
			$permiso10=substr($row_doc['p1'],9,1);
			$permiso4=substr($row_doc['p1'],3,1);
			$act_kar_IS=$row_doc['kardex'];
			$deuda=substr($row_doc['p1'],4,1);
			//$impto=$row_doc['imp1'];
			
			$valor_imp = 1 + ($impto/100);
			
			if($permiso10=='S'){
				switch($act_kar_IS){
					case "I":
						$act_kar_IS="1";
						break;
					case "S":
						$act_kar_IS="2";
						break;
					
					default:
						$act_kar_IS="";
				}
			}else{
				$act_kar_IS="";
			}
			
			//---------------------------------------------------------------
			
			//-------------------------------deuda de condiciones-----------------------------------
			$strSQLDetope="select * from detope where condicion='".$condicion."' and documento='".$doc."'";
			$resultadoDetope=mysql_query($strSQLDetope,$cn);
			$rowDetope=mysql_fetch_array($resultadoDetope);
			$condicionDeuda=$rowDetope['deuda'];
			
			$strSQLUsuarios="select substring(permiso,3,1) as vcredito from usuarios where codigo='".$_SESSION['codvendedor']."'";
			$resultadoUsuarios=mysql_query($strSQLUsuarios,$cn);
			$rowUsuarios=mysql_fetch_array($resultadoUsuarios);
			
			if($rowUsuarios['vcredito']=='N' && $condicionDeuda=='S' && $tipomov=='2' ){
				echo "vcredito";
				die();
			}
			
			//--------------------------------------------------------------------
			
			///---------------------referencias-----------------------
			if($serie_ref!="" && $correlativo_ref!="" && $cod_cab_ref!=""){
				$strSQL0025="select  max(id) as id from referencia";
				$resultado0025=mysql_query($strSQL0025,$cn);
				$row0025=mysql_fetch_array($resultado0025);
				$codigo_ref=$row0025['id']+1;
				
				$strSQL_ref="insert into referencia (id,cod_cab,serie,correlativo,cod_cab_ref)values('".$codigo_ref."','".$codigo."','".$serie_ref."','".$correlativo_ref."','".$cod_cab_ref."')";
				mysql_query($strSQL_ref,$cn);
				$flag_r="RA";
				
				$strSQL123="select * from cab_mov where cod_cab='".$cod_cab_ref."'";
				$resultado123=mysql_query($strSQL123,$cn);
				$row123=mysql_fetch_array($resultado123);
				$kardex_doc=$row123['kardex']; // kardex del documento de referencia.
				$doc_ref=$row123['cod_ope'];
				
				if($tipomov=='1' && ($doc_ref=='GR' || $doc_ref=='GI' || $doc_ref=='GC')){
					$strSQL_ref2="update cab_mov set flag_r=CONCAT(flag_r,'RO'),kardex='N' where cod_cab='".$cod_cab_ref."'";
					mysql_query($strSQL_ref2);
				}else{
					$strSQL_ref2="update cab_mov set flag_r=CONCAT(flag_r,'RO') where cod_cab='".$cod_cab_ref."'";
					mysql_query($strSQL_ref2);
				}
			}
			
			//******************************************************************
			
			//******************************************************************
			
			$estadoOT="";
			if($doc=='OS' || $doc=='OT') $estadoOT="P";
			
			// cambio 2013
			//$saldo=$total_doc;			
			
			$totalTemp = verificar_totales();
			
			//echo ."<--->".$total_doc;
			
			if(number_format($totalTemp,2,'.','') != $total_doc){
			echo "DifTotal";
			die();
			
			}		
			
			
			$strSQL3="insert into cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,caja,cliente,ruc,fecha,f_venc,moneda,impto1,tc,b_imp,igv,servicio,percepcion,total,saldo,tienda,sucursal,flag,flag_r,motivo,noperacion,items,condicion,incluidoigv,obs1,obs2,obs3,obs4,obs5,inafecto,fecha_aud,pc,kardex,deuda,transportista,chofer,dirPartida,dirDestino,numeroOT,fecharegis,flete,puntos,tipoDesc,estadoOT)values('".$codigo."','".$tipomov."','".$doc."','".$numero."','".$serie."','".$responsable."','".$caja."','".$auxiliar."','".$ruc."','".cambiarfecha($femision)."','".cambiarfecha($fvencimiento)."','".$moneda."','".$impto."','".$_SESSION['tc']."','".$monto."','".$impuesto1."','".$servicio."','".$percepcion."','".$total_doc."','".$saldo."','".$tienda."','".$sucursal."','".$flag."','".$flag_r."','".$motivo."','".$noperacion."','".$items."','".$condicion."','".$incluidoigv."','".$obs1."','".$obs2."','".$obs3."','".$obs4."','".$obs5."','".$permiso4."','".$fecha_aud."','".$_SESSION['pc_ingreso']."','".$permiso10."','".$deuda."','".$transportista."','".$chofer."','".$dirPartida."','".$dirDestino."','".$serieOT."-".$numeroOT."','".cambiarfecha($fecharegis)."','".$_SESSION['montoFlete']."','".$_SESSION['totalPuntosDoc']."','".$tipoDescuento."','".$estadoOT."')"; 		
			//mysql_query($strSQL3,$cn);
			$control_Error=mysql_query($strSQL3,$cn);
			
			if($control_Error){
			
			}else{
				echo "error";
				break;
			}
			
			//****************************** CAMBIO PAGOS ***********************************
			$saldo=0;
			$temppagos=0;
			
			//print_r($_SESSION['pagos'][0]);
			if(isset($_SESSION['pagos'][0])){
				foreach ($_SESSION['pagos'][0] as $subkey=> $subvalue) {
					$strSQL_pagos="select max(id) as id from pagos";
					$resultado_pagos=mysql_query($strSQL_pagos,$cn);
					$row_pagos=mysql_fetch_array($resultado_pagos);
					$id_pagos=str_pad($row_pagos['id']+1, 6, "0", STR_PAD_LEFT);
					
					if($_SESSION['pagos'][6][$subkey]!='' && $_SESSION['pagos'][6][$subkey]!=0 ){
						$montoPagos=number_format($_SESSION['pagos'][6][$subkey],2,'.','');
						$monedaPagos="02";
					}
					
					if($_SESSION['pagos'][4][$subkey]!='' && $_SESSION['pagos'][4][$subkey]!=0 ){
						$montoPagos=number_format($_SESSION['pagos'][4][$subkey],2,'.','');
						$monedaPagos="01";
					}
					
					$vuelto=$_REQUEST['vuelto'];
					$moneda_v=$_REQUEST['moneda_v'];
												
					$strSQ_pagos3="insert into pagos(id,tipo,t_pago,fecha,fechav,monto,moneda,fechap,tcambio,referencia,vuelto,moneda_v,pc,cod_user) values ('".$id_pagos."','".$_SESSION['pagos'][1][$subkey]."','".$_SESSION['pagos'][2][$subkey]."','".extraefecha($femision)."','".extraefecha($femision)."','".$montoPagos."','".$monedaPagos."','".$fecha_aud."',".$_SESSION['tc'].",'".$codigo."','".$vuelto."','".$moneda_v."','".$_SESSION['pc_ingreso']."','".$_SESSION['codvendedor']."')";
					//echo $strSQ_pagos3;
					mysql_query($strSQ_pagos3,$cn);
					if($_SESSION['pagos'][1][$subkey]=='A'){
					$temppagos=$temppagos+$montoPagos;
					}
					
				}//fin foreach
				
			$saldo=($total_doc+$percepcion)-$temppagos;
			if($saldo < 0){
			$saldo=0;
			}
				
			}else{
				
				if($deuda=='S'){	
					if($condicionDeuda=='S' ){
						$saldo=$total_doc;
					}
					
					if($condicionDeuda=='N' || $condicionDeuda==''){
						if($moneda=='02'){
							//$desc_moneda="dolares";
							$desc_moneda="02";
						}else{
							//$desc_moneda="soles";
							$desc_moneda="01";
						}
						
						//--------------------------------PAGOS----------------------------------------------
						
						/*if(isset($_SESSION['pagos'][0])){
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
								
								$vuelto=$_REQUEST['vuelto'];
								$moneda_v=$_REQUEST['moneda_v'];
													
								$strSQ_pagos3="insert into pagos(id,t_pago,fecha,fechav,monto,moneda,fechap,tcambio,referencia,vuelto,moneda_v,pc,cod_user) values ('".$id_pagos."','".$_SESSION['pagos'][2][$subkey]."','".extraefecha($femision)."','".extraefecha($femision)."',".$montoPagos.",'".$monedaPagos."','".$fecha_aud."',".$_SESSION['tc'].",'".$codigo."','".$vuelto."','".$moneda_v."','".$_SESSION['pc_ingreso']."','".$_SESSION['codvendedor']."')";
								//echo $strSQ3;
								mysql_query($strSQ_pagos3,$cn);
							}//fin foreach
							
						}*/
						
						//else{
							//$saldo=$total_doc;
							$strSQL_pagos="select max(id) as id from pagos";
							$resultado_pagos=mysql_query($strSQL_pagos,$cn);
							$row_pagos=mysql_fetch_array($resultado_pagos);
							$id_pagos=str_pad($row_pagos['id']+1, 6, "0", STR_PAD_LEFT);
							
							$strSQ_pagos3="insert into pagos(id,t_pago,numero,fecha,fechav,monto,moneda,fechap,tcambio,referencia,pc,cod_user) values ('".$id_pagos."',1,'CASH','".extraefecha($femision)."','".extraefecha($fvencimiento)."',".($total_doc+$percepcion).",'".$desc_moneda."','".$fecha_aud."',".$_SESSION['tc'].",'".$codigo."','".$_SESSION['pc_ingreso']."','".$_SESSION['codvendedor']."')";
							//echo $strSQ3;
							mysql_query($strSQ_pagos3,$cn);
						//}
						$saldo=0;					
						//-------------------------------------------------------------------------------
					}
				}	
				
				if($percepcion!=0){
					$strSQL_pagos="select max(id) as id from pagos";
					$resultado_pagos=mysql_query($strSQL_pagos,$cn);
					$row_pagos=mysql_fetch_array($resultado_pagos);
					$id_pagos=str_pad($row_pagos['id']+1, 6, "0", STR_PAD_LEFT);
										
					$strSQ_pagos3="insert into pagos(id,tipo,t_pago,fecha,fechav,monto,moneda,fechap,tcambio,referencia,pc,cod_user) values ('".$id_pagos."','C',15,'".extraefecha($femision)."','".extraefecha($fvencimiento)."',".$percepcion.",'".$moneda."','".$fecha_aud."',".$_SESSION['tc'].",'".$codigo."','".$_SESSION['pc_ingreso']."','".$_SESSION['codvendedor']."')";
					//echo $strSQ3;
					mysql_query($strSQ_pagos3,$cn);								
				}
			
			}//else if
				
			$update_saldo="update cab_mov set saldo='".$saldo."' where cod_cab='".$codigo."' ";
			mysql_query($update_saldo,$cn);
			
			//******************************************************************
			
			//print_r($_SESSION['productos3'][1]);
			
			$update_tranp="update transportista set chofer='".$chofer."',nom_chofer='".$nom_chofer."' where id='".$transportista."' ";
			mysql_query($update_tranp,$cn);
			if($doc=='PO'){
				$codAreasCosto=explode("|",$_REQUEST['codAreasCosto']);
				for ($i=1; $i<count($codAreasCosto); $i++){
					$strSQlProxArea="select * from procxarea where areacosto='".$codAreasCosto[$i]."' ";
					$resultProxArea=mysql_query($strSQlProxArea,$cn);
					while($rowProxArea=mysql_fetch_array($resultProxArea)){
						if($rowProxArea['moneda']=='02'){						
							$costoparcial=number_format($rowProxArea['costo1']*$_SESSION['tc'],2);				
						}else{
							$costoparcial=$rowProxArea['costo1'];
						}
						
						$insertActxPre="insert into activxpresu(codpresup,areacosto,procesos,tipocosto,moneda,costo,costoparcial) values('".$codigo."','".$rowProxArea['areacosto']."','".$rowProxArea['proceso']."','1','".$rowProxArea['moneda']."','".$rowProxArea['costo1']."','".$costoparcial."')";
						mysql_query($insertActxPre,$cn);
					}
				}
			}
			
			foreach ($_SESSION['productos3'][0] as $subkey=> $subvalue) {
				if($doc=='OT'){
					$imp_item=($_SESSION['productos3'][9][$subkey]*$_SESSION['productos3'][10][$subkey]*$_SESSION['productos3'][2][$subkey])-$_SESSION['productos3'][11][$subkey];
				}else{
					$imp_item=($_SESSION['productos3'][1][$subkey]*$_SESSION['productos3'][2][$subkey])-$_SESSION['productos3'][11][$subkey];
				}
				
				$strSQL4="select * from producto where idproducto='".$subvalue."' ";
				$resultado4=mysql_query($strSQL4,$cn);
				$total_kardex='N';
				
				while($row4=mysql_fetch_array($resultado4)){
					$prod_igv=$row4['igv'];
					$und_pr=$row4['und'];
					$factor_pr=$row4['factor'];
					$monedaProd=$row4['moneda'];
					$lotesProd=$row4['lotes'];
					
					if($tipomov=='1'){
						//-------------------------Calculo Costo Inventario subunidad----------------------------
						$strSQL_unid100="select * from unixprod where producto='".$row4['idproducto']."' and unidad='".$_SESSION['productos3'][4][$subkey]."'";
						$resultado_unid100=mysql_query($strSQL_unid100,$cn);
						$row_unid100=mysql_fetch_array($resultado_unid100);
						$factor_subund100=$row_unid100['factor'];
						if($factor_subund100=='' || $factor_subund100==0){
							$factor_subund100=1;
						}
						$imp_item=$imp_item/$factor_subund100;
						//-------------------------------------------------------------
						if($monedaProd!=$moneda){
							if($monedaProd=="02"){
								$montoPreRefe=$_SESSION['productos3'][2][$subkey]/$_SESSION['tc'];
							}else{
								$montoPreRefe=$_SESSION['productos3'][2][$subkey]*$_SESSION['tc'];
							}
						}else{
							$montoPreRefe=$_SESSION['productos3'][2][$subkey];
						}
						
						if($moneda=="02"){
							$imp_item2=$imp_item*$_SESSION['tc'];
						}else{
							$imp_item2=$imp_item;
						}
						
						if($permiso4=='N'){
							if($incluidoigv=='S' && $prod_igv=='S'){
								$imp_item2=$imp_item2/$valor_imp;
							}
						}
						
						$costo_inven1=calc_costo_inv($subvalue,$fecha_aud,$imp_item2,$_SESSION['productos3'][1][$subkey],$campo,$campo0);
						$strSQL_sal="select saldo_actual from det_mov d,cab_mov c where c.cod_cab=d.cod_cab and cod_prod='".$subvalue."' order by fechad desc,cod_det desc limit 1";
						
						$resultado_sal=mysql_query($strSQL_sal,$cn);
						$row_sal=mysql_fetch_array($resultado_sal);
						$salidas=$row_sal['saldo_actual'];
						$saldo_actual=$salidas+$_SESSION['productos3'][1][$subkey];
					}else{
						$strSQL_sal="select saldo_actual from det_mov d,cab_mov c where c.cod_cab=d.cod_cab and  cod_prod='".$subvalue."' order by fechad desc, cod_det desc limit 1";
						
						$resultado_sal=mysql_query($strSQL_sal,$cn);
						$row_sal=mysql_fetch_array($resultado_sal);
						$salidas=$row_sal['saldo_actual'];
						$saldo_actual=$salidas-$_SESSION['productos3'][1][$subkey];
					}
					
					$kardex_pro=$row4['kardex'];
					if($permiso10=='S'){
						if($kardex_pro=='S'){
							$total_kardex='S';
						}else{
							$total_kardex='N';
						}
					}
					
					$afecto=$row4['igv'];
					
					if($percepcion==0){
						$flag_percep='N';
						$porcen_percep_det=0;
					}else{
						if($porcen_percep!=0){
							$porcen_percep_det=$porcen_percep;
						}else{
							$porcen_percep_det=$row4['valor_percep'];
						}
						if($row4['agente_percep']=='S'){
							$flag_percep='S';
						}else{
							$flag_percep='N';
							$porcen_percep_det=0;
						}
					}
					
					/*
					$numero = 1.83; 
					echo round($numero,0);//2 
					$numero = 1.15; 
					echo round($numero,0);//1 
					*/
					
					if($doc=='OT'){
						$desc1=$imp_item-round($imp_item,0);
						$imp_item=round($imp_item,0);
					}else{
						//$desc1='0';//
						$desc1=$_SESSION['productos3'][21][$subkey];
						$desc2=$_SESSION['productos3'][22][$subkey];
						
						$imp_item=$imp_item-($imp_item*($_SESSION['productos'][21][$subkey]/100));
						$imp_item=$imp_item-($imp_item*($_SESSION['productos'][22][$subkey]/100));
					}
					
					$puntos=$_SESSION['productos3'][23][$subkey];
					$envases=$_SESSION['productos3'][24][$subkey];
					
					$strSQL444="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,tcambio,moneda,precio,cantidad,imp_item,fechad,descargo,afectoigv,costo_inven,saldo_actual,notas,flag_kardex,unidad,flag_percep,porcen_percep,ancho,largo,mt2,factor,descOT,codanex,desc1,desc2,puntos,envases,cod_model) values('".$codigo."','".$tipomov."','".$doc."','".$serie."','".$numero."','".$auxiliar."','".$tienda."','".$sucursal."','".$row4['idproducto']."','".addslashes($row4['nombre'])."','".$tc."','".$moneda."','".$_SESSION['productos3'][2][$subkey]."','".$_SESSION['productos3'][1][$subkey]."','".number_format($imp_item,2,'.','')."','".cambiarfecha($femision)."','".$kardex_pro."','".$afecto."','".number_format($costo_inven1,2)."','".$saldo_actual."','".$_SESSION['productos3'][3][$subkey]."','".$act_kar_IS."','".$_SESSION['productos3'][4][$subkey]."','".$flag_percep."','".$porcen_percep_det."','".$_SESSION['productos3'][7][$subkey]."','".$_SESSION['productos3'][8][$subkey]."','".$_SESSION['productos3'][9][$subkey]."','".$_SESSION['productos3'][10][$subkey]."','".$_SESSION['productos3'][11][$subkey]."','".$_SESSION['productos3'][12][$subkey]."','".$desc1."','".$desc2."','".$puntos."','".$envases."','".$_SESSION['productos3'][26][$subkey]."')";
					mysql_query($strSQL444,$cn);
					
					
					//---------------------------------------- LOTES ------------------------------------------
					
					if($lotesProd=='S'){
						
						
						
						
						if($tipomov=='1'){
							
							/*
							list($totLoteI)=mysql_fetch_row(mysql_query("select SUM(cant) from lotes where producto='".$row4['idproducto']."' and des_lote='".$_SESSION['productos3'][27][$subkey]."' and tipo='1' and tienda='".$tienda."'"));
							list($totLoteS)=mysql_fetch_row(mysql_query("select SUM(cant) from lotes where producto='".$row4['idproducto']."' and des_lote='".$_SESSION['productos3'][27][$subkey]."' and tipo='2' and tienda='".$tienda."'"));
							*/
							
							
							//list($saldoLoteAnt)=mysql_fetch_row(mysql_query("select saldo from lotes where producto='".$row4['idproducto']."' and des_lote='".$_SESSION['productos3'][27][$subkey]."'  and tienda='".$tienda."' order by id desc limit 1"));
							
							//if($saldoLoteAnt=='')$saldoLoteAnt=0;
							
							//$saldoLote=$saldoLoteAnt+$_SESSION['productos3'][1][$subkey];
							

							
							$precioCostoConv=$_SESSION['productos3'][2][$subkey];
							
							if($incluidoigv=='N'){
							$precioCostoConv=$_SESSION['productos3'][2][$subkey]*($_REQUEST['impto']+1);
							}
							
							if($moneda=='02'){
							$precioCostoConv=$precioCostoConv*$_SESSION['tc'];
							}
							
							
							$strSQLLotes="insert into lotes(cod_cab,tipo,producto,des_lote,venc_lote,tienda,cant,costo)values('".$codigo."','".$tipomov."','".$row4['idproducto']."','".$_SESSION['productos3'][27][$subkey]."','".formatofecha($_SESSION['productos3'][28][$subkey])."','".$tienda."','".$_SESSION['productos3'][1][$subkey]."','".$precioCostoConv."')";
							
							mysql_query($strSQLLotes,$cn);
							
							
							//***************** Tabla Consolidaddo *************************
							$resultadoLotes=mysql_query("select ingresos,salidas from lotes_cons where producto='".$row4['idproducto']."' and des_lote='".$_SESSION['productos3'][27][$subkey]."'  and tienda='".$tienda."'");
							$cont_reg=mysql_num_rows($resultadoLotes);							

								if($cont_reg==0){
									$ingresos=$_SESSION['productos3'][1][$subkey];
									$salidas=0;
									$existencia=$ingresos-$salidas;								
									$strSQLLotes="insert into lotes_cons(producto,des_lote,tienda,ingresos,salidas,existencia,venc_lote)values('".$row4['idproducto']."','".$_SESSION['productos3'][27][$subkey]."','".$tienda."','".$ingresos."','".$salidas."','".$existencia."','".formatofecha($_SESSION['productos3'][28][$subkey])."')";							
									mysql_query($strSQLLotes,$cn);
																		
								}else{	
												
									list($ingresos,$salidas)=mysql_fetch_row($resultadoLotes);
									$ingresos=$ingresos+$_SESSION['productos3'][1][$subkey];
									$existencia=$ingresos-$salidas;								
									$strSQLLotes="update lotes_cons set ingresos='".$ingresos."',salidas='".$salidas."',existencia='".$existencia."' where producto='".$row4['idproducto']."' and des_lote='".$_SESSION['productos3'][27][$subkey]."'  and tienda='".$tienda."' ";							
									mysql_query($strSQLLotes,$cn);							
								}
							//********************************************************
							
							
							
						}else{ // tipo 2
							
						
						
						$tempLote='N';
						//echo "impresion";
					//	print_r($_SESSION['lotes'][1]);
						
							if(isset($_SESSION['lotes'][0])){
								
								$temp_cant1=$_SESSION['productos3'][1][$subkey];
																
								asort($_SESSION['lotes'][1]);
								
								foreach ($_SESSION['lotes'][1] as $subkeyL=> $subvalueL) {	
								
									if($row4['idproducto']==$_SESSION['lotes'][2][$subkeyL]){
										
									
										list($des_lote,$venc_lote,$existencia)=mysql_fetch_row(mysql_query("select des_lote,venc_lote,existencia from lotes_cons where id='".$_SESSION['lotes'][0][$subkeyL]."'"));									
								

								if($existencia-$temp_cant1<0){
								$cantxLote=$existencia;
								$temp_cant1=$temp_cant1-$existencia;								
								}else{
								$cantxLote=$temp_cant1;	
								}
								
									$strSQLLotes="insert into lotes(cod_cab,tipo,producto,des_lote,venc_lote,tienda,cant)values('".$codigo."','".$tipomov."','".$row4['idproducto']."','".$des_lote."','".$venc_lote."','".$tienda."','".$cantxLote."')";			
									mysql_query($strSQLLotes,$cn);									
									
									$strSQLLotes2="update lotes_cons set salidas=salidas+'".$cantxLote."',existencia=existencia-'".$cantxLote."' where id='".$_SESSION['lotes'][0][$subkeyL]."' ";							
									mysql_query($strSQLLotes2,$cn);
									
									
									$tempLote='S';								
									
									}
								}
							}
							
							
							if($tempLote=='N'){
						
						
						$temp_cant1=$_SESSION['productos3'][1][$subkey];
							
						$strSQL="select * from lotes_cons where producto='".$row4['idproducto']."' and tienda='".$tienda."' and existencia > 0 order by id asc ";
						$resultado=mysql_query($strSQL,$cn);						
													
							while($rowL=mysql_fetch_array($resultado)){
									
								$temp_cant2=$rowL['existencia'];
								$temp_cant3=$temp_cant2-$temp_cant1;		
																
									if($temp_cant3<=0){									
										
										$strSQLLotes="insert into lotes(cod_cab,tipo,producto,des_lote,venc_lote,tienda,cant)values('".$codigo."','".$tipomov."','".$row4['idproducto']."','".$rowL['des_lote']."','".formatofecha($_SESSION['productos3'][28][$subkey])."','".$tienda."','".$temp_cant2."')";			
										mysql_query($strSQLLotes,$cn);									
										
										$strSQLLotes2="update lotes_cons set salidas=salidas+'".$temp_cant2."',existencia=existencia-'".$temp_cant2."' where id='".$rowL['id']."' ";							
										mysql_query($strSQLLotes2,$cn);
										
									}else{
									
										$strSQLLotes="insert into lotes(cod_cab,tipo,producto,des_lote,venc_lote,tienda,cant)values('".$codigo."','".$tipomov."','".$row4['idproducto']."','".$rowL['des_lote']."','".formatofecha($_SESSION['productos3'][28][$subkey])."','".$tienda."','".$temp_cant1."')";							
										mysql_query($strSQLLotes,$cn);
										
										$strSQLLotes2="update lotes_cons set salidas=salidas+'".$temp_cant1."',existencia=existencia-'".$temp_cant1."' where id='".$rowL['id']."' ";							
										mysql_query($strSQLLotes2,$cn);
										
										break;
										
									}
								
								$temp_cant1=abs($temp_cant3);
								
							
								
								}	
							}				
							
						}//tipo
					
					}// cierra lotes
					
									
					
					
					
					//-----------------------------------------OFERTAS----------------------------------------
					$oferta=$row4['oferta'];
					
					if($oferta=='S' && $tipomov==2){
						//echo "asf";
						if(isset($_SESSION['boni'][0])){
							foreach ($_SESSION['boni'][0] as $subkey2=> $subvalue2) {
								if($_SESSION['boni'][4][$subkey2]==$row4['idproducto']){
									$strSQL4O="select * from producto where idproducto='".$subvalue2."' ";
									$resultado4O=mysql_query($strSQL4O,$cn);
									$row4O=mysql_fetch_array($resultado4O);
									
									$prod_igv=$row4O['igv'];
									$kardex_proBon=$row4O['kardex'];
									$afectoBon=$row4O['igv'];
									
									//$saldo_actual='';
									$strSQL444="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,tcambio,moneda,precio,cantidad,imp_item,fechad,descargo,afectoigv,costo_inven,saldo_actual,notas,flag_kardex,unidad,flag_percep,porcen_percep,ancho,largo,mt2,factor,descOT,codanex,desc1,codOferta) values('".$codigo."','".$tipomov."','".$doc."','".$serie."','".$numero."','".$auxiliar."','".$tienda."','".$sucursal."','".$_SESSION['boni'][0][$subkey2]."','".addslashes($_SESSION['boni'][1][$subkey2])."','".$tc."','".$moneda."','0.00','".$_SESSION['boni'][3][$subkey2]."','0.00','".cambiarfecha($femision)."','".$kardex_proBon."','".$afectoBon."','".number_format($costo_inven1,2)."','".$saldo_actual."','','".$act_kar_IS."','".$_SESSION['boni'][2][$subkey2]."','".$flag_percep."','".$porcen_percep_det."','','','','','','','','".$_SESSION['boni'][4][$subkey2]."')";
									mysql_query($strSQL444,$cn);
									
									if($kardex_proBon=='S'){
										$strSQLKBon="update producto set saldo$tienda=saldo$tienda-".$_SESSION['boni'][3][$subkey2]." where idproducto='".$_SESSION['boni'][0][$subkey2]."'";
										mysql_query($strSQLKBon,$cn);
									}
								}
							}
						}
					}
					//-----------------------------------------------------------------------------------
					
					//-------------------control de kardex del producto----------------------------------
					
					if($total_kardex=='S'){
						if($tipomov!=$act_kar_IS && $act_kar_IS!="" ){
							$tipomov_temp=$act_kar_IS;
							$kardex_doc='';
						}else{
							$tipomov_temp=$tipomov;
						}
						
						if( ($kardex_doc=='' ||  $kardex_doc=='N') || $_SESSION['productos3'][5][$subkey]!='ref' ){
							//----------------subunidadesssss---------------------------
							if($und_pr != $_SESSION['productos3'][4][$subkey]){
								$strSQL_unid="select * from unixprod where producto='".$row4['idproducto']."' and unidad='".$_SESSION['productos3'][4][$subkey]."'";
								$resultado_unid=mysql_query($strSQL_unid,$cn);
								$row_unid=mysql_fetch_array($resultado_unid);
								$factor_subund=$row_unid['factor'];
								
								//$temp_subunidad=(($factor_subund)*$_SESSION['productos3'][1][$subkey]);
								$temp_subunidad=$_SESSION['productos3'][1][$subkey];
								if ($factor_subund<>""){
									if ($row_unid['mconv']=='P'){
										//procentual
										//$temp_subunidad=$temp_subunidad*($row4['factor']/$factor_subund);
										$temp_subunidad=$temp_subunidad*$factor_subund;
									}else{
										//nominal
										//$temp_subunidad=(($temp_subunidad*$factor_subund)*10)/$row4['factor'];
										$FacSbU = explode('.',$factor_subund);
										//echo $FacSbU[0]
										if($FacSbU[0]!='0'){
											$SuT1=$temp_subunidad*$FacSbU[0];	//5*1 - 5
											$SuT2=$temp_subunidad*$FacSbU[1];	//5*3 -	15
											$CatSu = explode('.',number_format($SuT2/$row4['factor'],3,'.','.'));//agrege para redondeo
											//$CatSu = explode('.',$SuT2/$row4['factor']); //15/12 - 1.25  /* 2.083
											$SuT1=$SuT1+$CatSu[0]; //5+1 - 6
											$SuT2=($CatSu[1]*$row4['factor'])/100; // (25*12)/100 - 3
											$SuT2= number_format($SuT2,0,'','');	 //agrege para redondeo
											$temp_subunidad=$SuT1.'.'.$SuT2 ; //6.3
										}else{
											$temp_subunidad=$temp_subunidad*$factor_subund;
											//echo $temp_subunidad." --> ".factor_subund;
										}
									}
								}
							}else{
								$temp_subunidad=$_SESSION['productos3'][1][$subkey];
							}
							//------------------------------------------------------------------
							
							if($tipomov_temp=='1'){
								$saldo1=$row4[$campo]+$temp_subunidad;
								if($_SESSION['actCostoRef']=='S'){
									$updCostoRef=" ,pre_ref='".$montoPreRefe."' ";
								}
								
							//$resp2=explode("?",recalculo2($codprod,gmdate("Y-m-d",time()-18000)," and c.tienda='".$rowTienda['cod_tienda']."'","1",substr($rowTienda['cod_tienda'],0,1),'recalculo'));			
								$strSQL40="update producto set $campo=".$saldo1.",$campo0='".$costo_inven1."'$updCostoRef where idproducto='".$subvalue."' ";
								//----------------------ingreso de series------------------------
									
								$ingreso=$codigo;
								$salida="";
								
								if(isset($_SESSION['seriesprod'][2])){
									foreach ($_SESSION['seriesprod'][2] as $subkey2=> $subvalue2) {
										if($subvalue2==$row4['idproducto']){
											$strSQL_series="insert into series(producto,serie,ingreso,salida,costo,fing,fvenc,tienda) values ('".$row4['idproducto']."','".strtoupper($_SESSION['seriesprod'][0][$subkey2])."','".$ingreso."','".$salida."','".$costo_inven1."','".cambiarfecha($femision)."','".formatofecha($_SESSION['seriesprod'][1][$subkey2])."','".$tienda."')";
											mysql_query($strSQL_series,$cn);
											//----------------Nota de creditooo---------------
											//if($tipomov!=$act_kar_IS && $act_kar_IS!="" ){
											//}
											//-------------------------------------------------
										}
									}
								}
							}else{
								//control de stock por modelo
								$strSQL4x="select md.* from modelo m,modelo_det md where m.cod_mod=md.cod_mod and  m.cod_prod='".$subvalue."' order by md.cod_mdet ";
								//echo $strSQL4x;
								$resultado4x=mysql_query($strSQL4x,$cn);
								$contModel=mysql_num_rows($resultado4x);
								if($contModel>0){
									
								}else{
									$saldo1=$row4[$campo]-$temp_subunidad;
									$strSQL40="update producto set $campo=".$saldo1." where idproducto='".$subvalue."' ";
								}
								$salida=$codigo;
								if(isset($_SESSION['seriesprod'][2])){
									foreach ($_SESSION['seriesprod'][2] as $subkey2=> $subvalue2) {
										if($subvalue2==$row4['idproducto']){
											
											//echo "select id from series where producto='".$row4['idproducto']."' and serie like '%".$txserie."' and (salida='' or salida='0') and tienda='".$tienda."' order by serie limit 1";
											
											$txserie=$_SESSION['seriesprod'][0][$subkey2];
											$id=mysql_fetch_array(mysql_query("select id from series where producto='".$row4['idproducto']."' and serie like '%".$txserie."' and (salida='' or salida='0') and tienda='".$tienda."' order by serie limit 1",$cn));
											$strSQL_series="update series set salida='".$salida."' where id='".$id[0]."' ";
											if(isset($_REQUEST['test'])){
												//echo $strSQL_series;
												//echo $txserie."----".$id[0];
											}
											mysql_query($strSQL_series,$cn);
										}
									}
								}
							}
							mysql_query($strSQL40,$cn);
							//echo $strSQL40;
						}
					}
				}
				if($subvalue==""){
					$strSQL_texto="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,tcambio,moneda,precio,cantidad,imp_item,fechad,descargo,costo_inven,saldo_actual,prodpase,flag_kardex,notas) values('".$codigo."','".$tipomov."','".$doc."','".$serie."','".$numero."','".$auxiliar."','".$tienda."','".$sucursal."','TEXTO','".$_SESSION['productos3'][13][$subkey]."','".$tc."','".$moneda."','".$_SESSION['productos3'][2][$subkey]."','".$_SESSION['productos3'][1][$subkey]."','".$imp_item."','".cambiarfecha($femision)."','N','','','".$_SESSION['productos3'][14][$subkey]."','".$tipomov."','".$_SESSION['productos3'][3][$subkey]."')";
					mysql_query($strSQL_texto,$cn);
				}
			}
			$strSQL5="update tempdoc set estado='G' where id='$temp_doc'";
			mysql_query($strSQL5,$cn);
		}else{
			echo $prod_no_coincide;
		}//primer if
		//echo $strSQL40;							
		break;				
		/*	
		case "generar_numero":
			  //$strSQL="select max(Num_doc) as Num_doc from cab_mov where sucursal='$sucursal' and cod_ope='$doc' and serie='$serie'";		  
			  $numero_ini=$_REQUEST['numero_ini'];
			  $numero_fin=$_REQUEST['numero_fin'];
										  
			   $strSQL="select max(numero) as Num_doc from tempdoc where tipodoc='$tipomov' and  sucursal='$sucursal' and doc='$doc' and serie='$serie' and numero>='".$numero_ini."' ";
	//		  str_pad($numero_ini,7, "0", STR_PAD_LEFT)
			  //echo $strSQL;
			$resultado=mysql_query($strSQL,$cn);
			$row=mysql_fetch_array($resultado);
			
			
			if($row['Num_doc']!=''){
			$cadena=$row['Num_doc']+1;
			}else{
				if($numero_ini==0){
					$cadena=$numero_ini+1;			
				}else{
					$cadena=$numero_ini;	
				}
			}		
			echo $cadena;
			
		   break;	
		*/
	case "generar_numero":
		//$strSQL="select max(Num_doc) as Num_doc from cab_mov where sucursal='$sucursal' and cod_ope='$doc' and serie='$serie'";
		$numero_ini=$_REQUEST['numero_ini'];
		$numero_fin=$_REQUEST['numero_fin'];
		
		//   $strSQL5="delete from tempdoc where estado='R' and tipodoc='$tipomov' and  sucursal='$sucursal' and doc='$doc' and serie='".str_pad($serie,3, "0", STR_PAD_LEFT)."' ";
//mysql_query($strSQL5,$cn);
		$strSQL="select max(numero) as Num_doc from tempdoc where tipodoc='$tipomov' and  sucursal='$sucursal' and doc='$doc' and serie='".str_pad($serie,3, "0", STR_PAD_LEFT)."' and numero>='".str_pad($numero_ini,7, "0", STR_PAD_LEFT)."' ";
		
		if(isset($_REQUEST['ptovta34'])){
			$strSQL="select max(Num_doc) as Num_doc from cab_mov where tipo='$tipomov' and  sucursal='$sucursal' and cod_ope='$doc' and serie='".str_pad($serie,3, "0", STR_PAD_LEFT)."' and Num_doc>='".str_pad($numero_ini,7, "0", STR_PAD_LEFT)."' ";
		}
		//str_pad($numero_ini,7, "0", STR_PAD_LEFT)
		//echo $strSQL;
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		
		if($row['Num_doc']!=''){
			$cadena=$row['Num_doc']+1;
		}else{
			if($numero_ini==0){
				$cadena=$numero_ini+1;
			}else{
				$cadena=$numero_ini;
			}
		}
		echo $cadena;
		break;
	
	case "verificar_numero":
		//Limipia el temp reservado
		$strSQL5="delete from tempdoc where estado='R' and usuario='".$_SESSION['codvendedor']."' ";
		mysql_query($strSQL5,$cn);
		$numero_ini=$_REQUEST['numero'];
		$CanDocImp=$_REQUEST['CanDocImp'];
		$strSQL="select * from tempdoc where tipodoc='$tipomov' and  sucursal='$sucursal' and doc='$doc' and serie='$serie' and numero='".$numero_ini."' ";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$MulfacT= mysql_num_rows($resultado);
		if ($MulfacT==0){
			echo $numero_ini;
			for ($f = 0; $f < $CanDocImp; $f++) {
				$numero = $numero_ini+$f;
				$auxiliar=$f+1;
				//-- crear temp
				$strSQL50="select max(id) as id from tempdoc";
				$resultado50=mysql_query($strSQL50,$cn);
				$row50=mysql_fetch_array($resultado50);
				$idX=$row50['id']+1;
				
				$strSQL="select * from tempdoc where tipodoc='$tipomov' and  sucursal='$sucursal' and doc='$doc' and serie='$serie' and numero='".$numero."' ";
				$resultado=mysql_query($strSQL,$cn);
				$row=mysql_fetch_array($resultado);
				$MulfacT= mysql_num_rows($resultado);
				if ($MulfacT==1 ){
					$strSQLN="select max(numero) as numero from tempdoc where tipodoc='$tipomov' and  sucursal='$sucursal' and doc='$doc' and serie='$serie' order by numero desc";
					$resultadoN=mysql_query($strSQLN,$cn);
					$rowN=mysql_fetch_array($resultadoN);
					$numero=$rowN['numero']+1;
					//$numero_ini=$numero;
				}
				$strSQL5="INSERT INTO tempdoc VALUES ('".$idX."', '".$sucursal."','".$tipomov."','".$doc."','".$serie."','".$numero."','".$auxiliar."','R','".$_SESSION['codvendedor']."');";
				mysql_query($strSQL5,$cn);
			}
		}else{
			echo 'gerenar';
		}
		break;
		
	case "eliminar_doc":
		$cont=0;
		$strSQL_doc="select * from operacion where codigo='".$doc."' and  tipo='".$tipomov."' ";
		$resultado_doc=mysql_query($strSQL_doc,$cn);
		$row_doc=mysql_fetch_array($resultado_doc);
		
		$permiso10=substr($row_doc['p1'],9,1);
		//$permiso4=substr($row_doc['p1'],3,1);
		$act_kar_IS=$row_doc['kardex'];
		//$deuda=substr($row_doc['p1'],4,1);
		//echo $permiso10."<>";
		
		if($permiso10=='S'){
			switch($act_kar_IS){
				case "I":
					$act_kar_IS="1";
					break;
				case "S":
					$act_kar_IS="2";
					break;
				default:
					$act_kar_IS="";
			}	
		}else{
			$act_kar_IS="";		
		}			
		 
		if($doc=='GR'){
			$strSQL="select * from cab_mov where Num_doc='$numero' and serie='$serie' and  sucursal='$sucursal' and tienda='$tienda' and cod_ope='$doc' ";
			$resultado=mysql_query($strSQL,$cn);
			$row=mysql_fetch_array($resultado);
			$esatdoOTGR=$row['estadoOT'];
			if($esatdoOTGR=='A' || $esatdoOTGR=='P'){
				echo "GenxTran";
				break;
			}
		}
		 
		if($tipomov=='1'){
			$strSQL="select cod_cab,flag_r,kardex,flag from cab_mov where Num_doc='$numero' and serie='$serie' and  sucursal='$sucursal' and tienda='$tienda' and cod_ope='$doc' and cliente='$auxiliar' ";
			$strSQL5="delete from tempdoc where numero='$numero' and serie='$serie' and  sucursal='$sucursal' and doc='$doc' and auxiliar='$auxiliar' ";
			$resultado=mysql_query($strSQL,$cn);
			$row=mysql_fetch_array($resultado);
			$codigo=$row['cod_cab'];
			$flag_r=$row['flag_r'];
			$kardex_doc=$row['kardex'];
			
			$strSQl_elim_serie="select * from  series where ingreso='".$codigo."' and salida!='' ";
			$resultado_elim_serie=mysql_query($strSQl_elim_serie,$cn);
			$cont=mysql_num_rows($resultado_elim_serie);
			
			if($cont > 0){
				echo "serie tiene salida";
				break;
			}
			
			if($flag_r=='RO'){
				echo "referencia";
				break;
			}else{
				//if($flag_r=='RA'){
					$strSQL_ref="select * from referencia where cod_cab='".$codigo."'";
					$resultado_ref=mysql_query($strSQL_ref,$cn);
					$contRef=mysql_num_rows($resultado_ref);
					if($contRef > 0){
						while($row_ref=mysql_fetch_array($resultado_ref)){
						
							$cod_ref=$row_ref['cod_cab_ref'];
							
							$strSQL_ref="select kardex from cab_mov where cod_cab='".$cod_ref."'";
							$resultado_ref=mysql_query($strSQL_ref,$cn);
							$row_ref=mysql_fetch_array($resultado_ref);
							$kardex_ref=$row_ref['kardex'];
							
							$update_ref="update cab_mov set flag_r='' where cod_cab='".$cod_ref."'";
							mysql_query($update_ref,$cn);
													
						}				
						$delete_ref="delete from referencia where cod_cab='".$codigo."' ";
						mysql_query($delete_ref,$cn);
					}
					
				//}
			}
			if($act_kar_IS!='' &&  $act_kar_IS!=$tipomov){
				$strSQl_elim_serie="select * from  series where ingreso='".$codigo."' and salida!='' ";
				$resultado_elim_serie=mysql_query($strSQl_elim_serie,$cn);
				$cont=mysql_num_rows($resultado_elim_serie);
				
				//$strSQL_delete_series="delete from series where ingreso='".$codigo."'";
				$strSQL_delete_series="update series set salida='',estado='F' where salida='".$codigo."' ";
				mysql_query($strSQL_delete_series,$cn);
			}else{
				$strSQL_delete_series="delete from series where ingreso='".$codigo."'";
				//$strSQL_delete_series="update series set salida='',estado='F' where salida='".$codigo."' ";
			}
		}else{
			$strSQL="select cod_cab,flag_r,kardex,flag from cab_mov where Num_doc='$numero' and serie='$serie' and  sucursal='$sucursal' and tienda='$tienda' and cod_ope='$doc' ";
			$resultado=mysql_query($strSQL,$cn);
			$row=mysql_fetch_array($resultado);
			$codigo=$row['cod_cab'];
			$flag_r=substr($row['flag_r'],0,2);
			$kardex_doc=$row['kardex'];
			$flag=$row['flag'];
			
			if($flag=='A'){
				$strSQL5="delete from tempdoc where numero='$numero' and serie='$serie' and  sucursal='$sucursal' and doc='$doc' ";
				$strSQL1="delete from cab_mov where cod_cab='$codigo'";
				$strSQL2="delete from det_mov where cod_cab='$codigo'";
				
				mysql_query($strSQL5,$cn);
				mysql_query($strSQL2,$cn);
				mysql_query($strSQL1,$cn);
				
				break;
			}
			
			if($flag_r=='RO'){
				echo "referencia";
				break;
			}else{
				if($flag_r=='RA'){
					$strSQL_ref="select * from referencia where cod_cab='".$codigo."'";
					$resultado_ref=mysql_query($strSQL_ref,$cn);
					while($row_ref=mysql_fetch_array($resultado_ref)){
					
					$cod_ref=$row_ref['cod_cab_ref'];
					
					$strSQL_ref2="select kardex from cab_mov where cod_cab='".$cod_ref."'";
					$resultado_ref2=mysql_query($strSQL_ref2,$cn);
					$row_ref2=mysql_fetch_array($resultado_ref2);
					$kardex_ref=$row_ref2['kardex'];
					
					$update_ref="update cab_mov set flag_r='' where cod_cab='".$cod_ref."'";
					mysql_query($update_ref,$cn);
					
						if($kardex_doc=='S'){
						$update_ref="update cab_mov set kardex='S' where cod_cab='".$cod_ref."'";
						mysql_query($update_ref,$cn);
						}		
					}
					$delete_ref="delete from referencia where cod_cab='".$codigo."' ";
					mysql_query($delete_ref,$cn);
				}
			}
			
			//echo $act_kar_IS."  ".$tipomov;
			if($act_kar_IS!='' &&  $act_kar_IS!=$tipomov){
				$strSQl_elim_serie="select * from  series where ingreso='".$codigo."' and salida!='' ";
				$resultado_elim_serie=mysql_query($strSQl_elim_serie,$cn);
				$cont=mysql_num_rows($resultado_elim_serie);
				
				$strSQL_delete_series="delete from series where ingreso='".$codigo."'";
				mysql_query($strSQL_delete_series,$cn);
			}else{
				$strSQL_delete_series="update series set salida='',estado='F' where salida='".$codigo."' ";
			}
			$strSQL5="delete from tempdoc where numero='$numero' and serie='$serie' and  sucursal='$sucursal' and doc='$doc' ";
		}
		if($cont==0){
			// echo "sdg".$cont;
			$strSQL3="select cod_prod,cantidad,descargo,flag_kardex,unidad from det_mov where cod_cab='$codigo'";
			$resultado3=mysql_query($strSQL3,$cn);
			
			while($row3=mysql_fetch_array($resultado3)){
				$cantidad=$row3['cantidad'];
				$cod_pro=$row3['cod_prod'];
				$kardex_prod=$row3['descargo'];
				$flag_kardex=$row3['flag_kardex'];
				
				if($kardex_ref=='S' && $tipomov==$flag_kardex){
					$kardex_doc='N';
				}
				
				$temp_tipomov=$tipomov;
				if($flag_kardex!=''){
					if($tipomov!=$flag_kardex){
						$temp_tipomov=$flag_kardex;
					}
				}
				
				if($kardex_doc=='S' && $kardex_prod=='S'){
					//----------------subunidadesssss---------------------------
					$strSQL4="select * from producto where idproducto='".$cod_pro."' ";
					$resultado4=mysql_query($strSQL4,$cn);
					while($row4=mysql_fetch_array($resultado4)){
						$und_pr=$row4['und'];
						$factor_pr=$row4['factor'];
					}
					//-----------------------------
					if($und_pr != $row3['unidad']){
						$strSQL_unid="select * from unixprod where producto='".$cod_pro."' and unidad='".$row3['unidad']."'";
						$resultado_unid=mysql_query($strSQL_unid,$cn);
						$row_unid=mysql_fetch_array($resultado_unid);
						$factor_subund=$row_unid['factor'];
						
						if ($row_unid['mconv']=='P'){
							//procentual
							//$cantidad=$cantidad*($factor_pr/$factor_subund);
							$cantidad=$cantidad*$factor_subund;
						}else{
							//nominal
							//$cantidad=(($cantidad*$factor_subund)*10)/$factor_pr;
							$FacSbU = explode('.',$factor_subund);
							//echo $FacSbU[0]
							$SuT1=$cantidad*$FacSbU[0];	//5*1 - 5
							$SuT2=$cantidad*$FacSbU[1];	//5*3 -	15
							$CatSu = explode('.',number_format($SuT2/$factor_pr,3,'.','.'));//agrege para redondeo
							//$CatSu = explode('.',$SuT2/$factor_pr); //15/12 - 1.25
							$SuT1=$SuT1+$CatSu[0]; //5+1 - 6
							$SuT2=($CatSu[1]*$factor_pr)/100; // (25*12)/100 - 3
							$SuT2= number_format($SuT2,0,'','');	 //agrege para redondeo
							$cantidad=$SuT1.'.'.$SuT2 ; //6.3
						}
					}else{
						$cantidad=$cantidad;
					}
					//------------------------------------------------------------------
					if($temp_tipomov=='1'){
						$strSQL4="update producto set $campo=$campo-$cantidad where idproducto='$cod_pro'";
					}else{
						$strSQL4="update producto set $campo=$campo+$cantidad where idproducto='$cod_pro'";
					}
				}
				mysql_query($strSQL4,$cn);
			}
			
			$strSQL1="delete from cab_mov where cod_cab='$codigo'";
			$strSQL2="delete from det_mov where cod_cab='$codigo'";
			$strSQL_delete_pagos="delete from pagos where referencia='$codigo'";
			
			mysql_query($strSQL1,$cn);
			mysql_query($strSQL2,$cn);
			mysql_query($strSQL5,$cn);
			mysql_query($strSQL_delete_series,$cn);
			mysql_query($strSQL_delete_pagos,$cn);
			//echo $strSQL4;
		}else{
			echo "serie tiene salida";
		}
		break;	
	
	case "anular_doc":
		$cont=0;
		$strSQL_doc="select * from operacion where codigo='".$doc."' and  tipo='".$tipomov."' ";
		$resultado_doc=mysql_query($strSQL_doc,$cn);
		$row_doc=mysql_fetch_array($resultado_doc);
		
		$permiso10=substr($row_doc['p1'],9,1);
		$act_kar_IS=$row_doc['kardex'];
		
		if($permiso10=='S'){
			switch($act_kar_IS){
				case "I":
					$act_kar_IS="1";
					break;
				case "S":
					$act_kar_IS="2";
					break;
				default:
					$act_kar_IS="";
			}
		}else{
			$act_kar_IS="";
		}
		
		if($doc=='GR'){
			$strSQL="select * from cab_mov where Num_doc='$numero' and serie='$serie' and  sucursal='$sucursal' and tienda='$tienda' and cod_ope='$doc' ";
			$resultado=mysql_query($strSQL,$cn);
			$row=mysql_fetch_array($resultado);
			$esatdoOTGR=$row['estadoOT'];
			if($esatdoOTGR=='A' || $esatdoOTGR=='P'){
				echo "GenxTran";
				break;
			}
		}
		
		if($tipomov=='1'){
		
		}else{
			$strSQL="select cod_cab,flag_r,kardex from cab_mov where Num_doc='$numero' and serie='$serie' and  sucursal='$sucursal' and tienda='$tienda' and cod_ope='$doc' ";
			$resultado=mysql_query($strSQL,$cn);
			$row=mysql_fetch_array($resultado);
			$codigo=$row['cod_cab'];
			$flag_r=$row['flag_r'];
			$kardex_doc=$row['kardex'];
			
			if($flag_r=='RO'){
				echo "referencia";
				break;
			}else{
				if($flag_r=='RA'){
					$strSQL_ref="select * from referencia where cod_cab='".$codigo."'";
					$resultado_ref=mysql_query($strSQL_ref,$cn);
					$row_ref=mysql_fetch_array($resultado_ref);
					$cod_ref=$row_ref['cod_cab_ref'];
					
					$strSQL_ref="select kardex from cab_mov where cod_cab='".$cod_ref."'";
					$resultado_ref=mysql_query($strSQL_ref,$cn);
					$row_ref=mysql_fetch_array($resultado_ref);
					$kardex_ref=$row_ref['kardex'];
					
					$update_ref="update cab_mov set flag_r='' where cod_cab='".$cod_ref."'";
					mysql_query($update_ref,$cn);
					
					$delete_ref="delete from referencia where cod_cab='".$codigo."' ";
					mysql_query($delete_ref,$cn);
				}
			}
			//echo $act_kar_IS."  ".$tipomov;
			if($act_kar_IS!='' &&  $act_kar_IS!=$tipomov){
				$strSQl_elim_serie="select * from  series where ingreso='".$codigo."' and salida!='' ";
				$resultado_elim_serie=mysql_query($strSQl_elim_serie,$cn);
				$cont=mysql_num_rows($resultado_elim_serie);
				
				$strSQL_delete_series="delete from series where ingreso='".$codigo."'";
				mysql_query($strSQL_delete_series,$cn);
			}else{
				$strSQL_delete_series="update series set salida='',estado='F' where salida='".$codigo."' ";
			}
			//	$strSQL5="delete from tempdoc where numero='$numero' and serie='$serie' and  sucursal='$sucursal' and doc='$doc' ";
		}
		
		if($cont==0){
			// echo "sdg".$cont;
			$strSQL3="select cod_prod,cantidad,descargo,flag_kardex,unidad from det_mov where cod_cab='$codigo'";
			$resultado3=mysql_query($strSQL3,$cn);
			
			while($row3=mysql_fetch_array($resultado3)){
				$cantidad=$row3['cantidad'];
				$cod_pro=$row3['cod_prod'];
				$kardex_prod=$row3['descargo'];
				$flag_kardex=$row3['flag_kardex'];
				
				if($kardex_ref=='S' && $tipomov==$flag_kardex){
					$kardex_doc='N';
				}
				$temp_tipomov=$tipomov;
				if($flag_kardex!=''){
					if($tipomov!=$flag_kardex){
						$temp_tipomov=$flag_kardex;
					}
				}
				
				//----------------subunidadesssss---------------------------
				$strSQL4="select * from producto where idproducto='".$cod_pro."' ";
				$resultado4=mysql_query($strSQL4,$cn);
				
				while($row4=mysql_fetch_array($resultado4)){
					$und_pr=$row4['und'];
					$factor_pr=$row4['factor'];
				}
				//-----------------------------
				if($und_pr != $row3['unidad']){
					$strSQL_unid="select * from unixprod where producto='".$cod_pro."' and unidad='".$row3['unidad']."'";
					$resultado_unid=mysql_query($strSQL_unid,$cn);
					$row_unid=mysql_fetch_array($resultado_unid);
					$factor_subund=$row_unid['factor'];
					
					if ($row_unid['mconv']=='P'){
						//procentual
						//$cantidad=$cantidad*($factor_pr/$factor_subund);
						$cantidad=$cantidad*$factor_subund;
					}else{
						//nominal
						//$cantidad=(($cantidad*$factor_subund)*10)/$factor_pr;
						$FacSbU = explode('.',$factor_subund);
						//echo $FacSbU[0]
						$SuT1=$cantidad*$FacSbU[0];	//5*1 - 5
						$SuT2=$cantidad*$FacSbU[1];	//5*3 -	15
						$CatSu = explode('.',number_format($SuT2/$factor_pr,3,'.','.'));//agrege para redondeo
						//$CatSu = explode('.',$SuT2/$factor_pr); //15/12 - 1.25
						$SuT1=$SuT1+$CatSu[0]; //5+1 - 6
						$SuT2=($CatSu[1]*$factor_pr)/100; // (25*12)/100 - 3
						$SuT2= number_format($SuT2,0,'','');	 //agrege para redondeo
						$cantidad=$SuT1.'.'.$SuT2 ; //6.3
					}
				}else{
					$cantidad=$cantidad;
				}
				
				//------------------------------------------------------------------						
				if($kardex_doc=='S' && $kardex_prod=='S'){
					if($temp_tipomov=='1'){
						$strSQL4="update producto set $campo=$campo-$cantidad where idproducto='$cod_pro'";
					}else{
						$strSQL4="update producto set $campo=$campo+$cantidad where idproducto='$cod_pro'";
					}
				}
				mysql_query($strSQL4,$cn);
			}
			$strSQL1="update cab_mov set flag='A' where cod_cab='$codigo'";
			$strSQL_delete_pagos="delete from pagos where referencia='$codigo'";
			
			mysql_query($strSQL1,$cn);
			//	mysql_query($strSQL2,$cn);
			//	mysql_query($strSQL5,$cn);
			mysql_query($strSQL_delete_series,$cn);
			mysql_query($strSQL_delete_pagos,$cn);
			//echo $strSQL4;
		}else{
			echo "serie tiene salida";
		}
		break;
	
	case "liberar_numero":	
		if($tipomov=='1'){
			$strSQL="delete from tempdoc where numero='$numero' and serie='$serie' and  sucursal='$sucursal' and doc='$doc' and auxiliar='$auxiliar' and estado='R' ";
		}else{
			$strSQL="delete from tempdoc where numero='$numero' and serie='$serie' and  sucursal='$sucursal' and doc='$doc' and estado='R'  ";
		}
		mysql_query($strSQL,$cn);
		//	echo $strSQL;
		break;
	
	case "filtro_aux":
		$ruc=$_REQUEST['ruc'];
		$razon=$_REQUEST['razon'];
		
		$resultado3=mysql_query("select * from cliente where ruc='$ruc'",$cn);
		$row3=mysql_fetch_array($resultado3);
		$tempAux='0';//mysql_num_rows($resultado3);	
		$codigo=$row3['codcliente'];
		$temprucA='';
		
		$strSQL="update cliente set baja='N' where codcliente='".$codigo."'";
		mysql_query($strSQL,$cn);
		echo $codigo."?".$razon."?".$tempAux."?".$strSQL."?".$temprucA;
		break;
	 
	case "save_aux":
		$ruc=$_REQUEST['ruc'];
		$dni=$_REQUEST['dni'];
		$razon=$_REQUEST['razon'];
		$contacto=$_REQUEST['contacto'];
		$cargo=$_REQUEST['cargo'];
		$direccion=$_REQUEST['direccion'];
		$persona=$_REQUEST['persona'];
		$tipo_aux=$_REQUEST['tipo_aux'];
		$accionAux=$_REQUEST['accionAux'];
		$codClie=$_REQUEST['codClie'];
		$telefono=$_REQUEST['telefono'];
		$chklider=$_REQUEST['chklider'];
		$codlider=$_REQUEST['codlider'];
		$tipoprov=$_REQUEST['tipoprov'];
		$email=$_REQUEST['email'];
		$condicion=$_REQUEST['condicion'];
		$responsable=$_REQUEST['responsable'];
		
		$razons=str_replace('amps','&',$razon);
		
		$resultado3=mysql_query("select max(codcliente) as codigo from cliente",$cn);
		$row3=mysql_fetch_array($resultado3);
		
		$codigo=$row3['codigo'];
		$codigo=str_pad($codigo+1,6,'0',STR_PAD_LEFT);
		
		if($accionAux=='e'){
			$strSQL="update cliente set razonsocial='".$razons."',ruc='".$ruc."',t_persona='".$persona."',doc_iden='".$dni."',direccion='".$direccion."',telefono='".$telefono."',email='".$email."',condicion='".$condicion."',responsable='".$responsable."',cargo='".$cargo."',contacto='".$contacto."' where codcliente='".$codClie."'";
			mysql_query($strSQL,$cn);
			$codigo=$codClie;
		}else{
			$tempAux=0;
			if($dni!=''){
				$resultado4=mysql_query("select * from cliente where doc_iden='".$dni."'",$cn);
				$row4=mysql_fetch_array($resultado4);
				$tempAux=mysql_num_rows($resultado4);
				$temprucA=$row4['baja'];
				$nomrazon=$row4['razonsocial'];
			}
			
			if($ruc!=''){
				$resultado4=mysql_query("select * from cliente where ruc='".$ruc."' and  (tipo_aux='".$tipo_aux."' or tipo_aux='A')  ",$cn);
				$row4=mysql_fetch_array($resultado4);
				$tempAux=mysql_num_rows($resultado4);
				$temprucA=$row4['baja'];
				$razon=caracteres($row4['razonsocial']);
			}
			
			if ($tempAux==0){
				$strSQL="insert into cliente(codcliente,tipo_aux,razonsocial,ruc,t_persona,doc_iden,contacto,cargo,direccion,telefono,lider,codlider,tipoprov,email,condicion,responsable) values('".$codigo."','".$tipo_aux."','".$razons."','".$ruc."','".$persona."','".$dni."','".$contacto."','".$cargo."','".$direccion."','".$telefono."','".$chklider."','".$codlider."','".$tipoprov."','".$email."','".$condicion."','".$responsable."') ";
				mysql_query($strSQL,$cn);
			}
		}
		echo $codigo."?".$razons."?".$tempAux."?".$strSQL."?".$temprucA."?".$condicion;
		break;
	
	case "gen_transf":
		$tienda2=$_REQUEST['tienda2'];
		$strSQL100="select *  from cab_mov where serie='".$serie."'  and Num_doc='".$numero."' and cod_ope='TS' ";
		$resultado100=mysql_query($strSQL100,$cn);
		$registros100=mysql_num_rows($resultado100);
		
		if($registros100 > 1){
			echo "error";
			break;
		}
		
		$flag_series='S';
		foreach($_SESSION['productos3'][0] as $subkey=> $subvalue) {
			$cant_prod=$_SESSION['productos3'][1][$subkey];
			//kardex,nombre,series
			$strSQL_prod="select * from producto where idproducto='".$subvalue."' ";
			$resultado_prod=mysql_query($strSQL_prod,$cn);
			$row_prod=mysql_fetch_array($resultado_prod);
			
			//	echo $strSQL_prod."<br>";
			if($row_prod['kardex']=='S'){
				$cant_series=0;
				if(isset($_SESSION['seriesprod'][2]) && $row_prod['series']=='S' ){
					foreach($_SESSION['seriesprod'][2] as $subkey2=> $subvalue2){
						if($subvalue2==$subvalue){
							$temp_serie=buscar_series($subvalue,$_SESSION['seriesprod'][0][$subkey2],$tienda2);
							if($temp_serie > 0){
								$flag_series='N';
								$prod_no_coincide="serie ingresada:".$_SESSION['seriesprod'][0][$subkey2].":".$row_prod['nombre'];
								break;
							}
							$cant_series++;
						}
					}
				}else{
					if($row_prod['series']=='S') {
						$flag_series='N';
						$prod_no_coincide=$row_prod['nombre'];
					}
					break;
				}
				
				if($flag_series=='N'){
					break;
				}
				
				//echo $cant_prod." = ".$cant_series."<br>";
				if($cant_prod!=$cant_series){
					$flag_series='N';
					$prod_no_coincide=$row_prod['nombre'];
					break;
				}
			}
		}//fin for each
		
		if($flag_series=='S') {
			$strSQL="select  max(cod_cab) as cod_cab from cab_mov";
			$resultado=mysql_query($strSQL,$cn);
			$row=mysql_fetch_array($resultado);
			$codigo=$row['cod_cab']+1;
			$codigo2=$codigo+1;
			
			$tienda=$_REQUEST['tienda'];
			$sucursal=substr($tienda,0,1);
			$doc="TS";
			
			$auxiliar="000000";
			$tipomov="2";
			$incluidoigv='S';
			$items=count($_SESSION['productos'][0]);
			
			$inafecto="S";
			$kardex="S";
			$deuda="N";
			
			$numero=str_pad($numero, 7, "0", STR_PAD_LEFT);
			
			$strSQL3="insert into cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,caja,cliente,ruc,fecha,f_venc,moneda,tc,b_imp,igv,servicio,total,saldo,tienda,sucursal,flag,motivo,noperacion,items,condicion,incluidoigv,fecha_aud,pc,inafecto,kardex,deuda)values('".$codigo."','".$tipomov."','".$doc."','".$numero."','".$serie."','".$responsable."','".$caja."','".$auxiliar."','".$ruc."','".cambiarfecha($femision)."','".cambiarfecha($fvencimiento)."','".$moneda."','".$tc."','".$monto."','".$impuesto1."','".$servicio."','".$total_doc."','".$saldo."','".$tienda."','".$sucursal."','".$flag."','".$motivo."','".$noperacion."','".$items."','".$condicion."','".$incluidoigv."','".$fecha_aud."','".$_SESSION['pc_ingreso']."','".$inafecto."','".$kardex."','".$deuda."')";
			mysql_query($strSQL3,$cn);
			
			$tienda2=$_REQUEST['tienda2'];
			$sucursal2=substr($tienda2,0,1);
			$tipomov="1";
			
			$strSQL2="insert into cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,caja,cliente,ruc,fecha,f_venc,moneda,tc,b_imp,igv,servicio,total,saldo,tienda,sucursal,flag,motivo,noperacion,items,condicion,incluidoigv,fecha_aud,pc,inafecto,kardex,deuda)values('".$codigo2."','".$tipomov."','".$doc."','".$numero."','".$serie."','".$responsable."','".$caja."','".$auxiliar."','".$ruc."','".cambiarfecha($femision)."','".cambiarfecha($fvencimiento)."','".$moneda."','".$tc."','".$monto."','".$impuesto1."','".$servicio."','".$total_doc."','".$saldo."','".$tienda2."','".$sucursal2."','".$flag."','".$motivo."','".$noperacion."','".$items."','".$condicion."','".$incluidoigv."','".$fecha_aud."','".$_SESSION['pc_ingreso']."','".$inafecto."','".$kardex."','".$deuda."')";
			mysql_query($strSQL2,$cn);
			// echo $strSQL2;
			
			//------------------------------------------------------------------
			//remplazar	  //$temp_subunidad    por --> 	  $_SESSION['productos3'][1][$subkey]
			foreach ($_SESSION['productos3'][0] as $subkey=> $subvalue) {
				$strSQL4="select * from producto where idproducto='".$subvalue."' ";
				$resultado4=mysql_query($strSQL4,$cn);
				while($row4=mysql_fetch_array($resultado4)){
					$descargo=$row4['kardex'];
					$costo_suc_origen=$row4['costo_inven'.$sucursal];
					
					$und_pr=$row4['und'];
					//	  $factor_pr=$row4['factor']; 
					//----------------subunidadesssss---------------------------
					
					if($und_pr != $_SESSION['productos3'][4][$subkey]){
						$strSQL_unid="select * from unixprod where producto='".$subvalue."' and unidad='".$_SESSION['productos3'][4][$subkey]."'";
						$resultado_unid=mysql_query($strSQL_unid,$cn);
						$row_unid=mysql_fetch_array($resultado_unid);
						$factor_subund=$row_unid['factor'];
						$temp_subunidad=$_SESSION['productos3'][1][$subkey];
						
						if ($row_unid['mconv']=='P'){
							//procentual
							//$temp_subunidad=$temp_subunidad*($row_prod['factor']/$factor_subund);
							$temp_subunidad=$temp_subunidad*$factor_subund;
						}else{
							//nominal
							//$temp_subunidad=(($temp_subunidad*$temp_subunidad)*10)/$row_prod['factor'];
							$FacSbU = explode('.',$factor_subund);
							//echo $FacSbU[0]
							$SuT1=$temp_subunidad*$FacSbU[0];	//5*1 - 5
							$SuT2=$temp_subunidad*$FacSbU[1];	//5*3 -	15
							$CatSu = explode('.',number_format($SuT2/$row4['factor'],3,'.','.'));//agrege para redondeo		
							//$CatSu = explode('.',$SuT2/$row_prod['factor']); //15/12 - 1.25
							$SuT1=$SuT1+$CatSu[0]; //5+1 - 6
							$SuT2=($CatSu[1]*$row4['factor'])/100; // (25*12)/100 - 3
							$SuT2= number_format($SuT2,0,'','');	 //agrege para redondeo
							$temp_subunidad=$SuT1.'.'.$SuT2 ; //6.3
						}
					}else{
						$temp_subunidad=$_SESSION['productos3'][1][$subkey];
					}
					$imp_item=$costo_suc_origen*$temp_subunidad;
					$moneda="01";
					$strSQL4="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,tcambio,moneda,precio,cantidad,imp_item,fechad,costo_inven,saldo_actual,unidad,descargo) values('".$codigo."','2','".$doc."','".$serie."','".$numero."','".$auxiliar."','".$tienda."','".$sucursal."','".$row4['idproducto']."','".addslashes($row4['nombre'])."','".$tc."','".$moneda."','".$costo_suc_origen."','".$temp_subunidad."','".$imp_item."','".cambiarfecha($femision)."','".number_format($costo_inven1,2)."','".$saldo_actual."','".$und_pr."','".$descargo."')";
					mysql_query($strSQL4,$cn);
					$campo="saldo".$tienda;
					
					//$strSQL4x="select md.* from modelo m,modelo_det md where m.cod_mod=md.cod_mod and  m.cod_prod='".$row4['idproducto']."' order by md.cod_mdet ";
					$strSQL4x="select * from modelo where cod_prod='".$row4['idproducto']."'";
					//echo $strSQL4x;
					$resultado4x=mysql_query($strSQL4x,$cn);
					$contModel=mysql_num_rows($resultado4x);
					if($contModel>0){
						
					}else{
						$strSQL6="update producto set $campo=$campo-".$temp_subunidad." where idproducto='".$subvalue."'";
						mysql_query($strSQL6,$cn);
						// echo $strSQL6;
		 			}
					
					//-----------------------------------------------------series--------------------------------------
					$salida=$codigo;
					if(isset($_SESSION['seriesprod'][2])){
						foreach ($_SESSION['seriesprod'][2] as $subkey2=> $subvalue2) {
							if($subvalue2==$row4['idproducto']){
							//	$txserie=str_replace("\'","||",$_SESSION['seriesprod'][0][$subkey2]);
							//	$txserie=str_replace("'","||",$_SESSION['seriesprod'][0][$subkey2]);
								$id=mysql_fetch_array(mysql_query("select id from series where producto='".$row4['idproducto']."' and serie like '%".$_SESSION['seriesprod'][0][$subkey2]."' and (salida='' or salida='0') and tienda='".$tienda."' order by serie limit 0,1",$cn));
								$strSQL_series="update series set salida='".$salida."' where id='".$id[0]."' ";
								//$strSQL_series="update series set salida='".$salida."' where producto='".$row4['idproducto']."' and serie='".$_SESSION['seriesprod'][0][$subkey2]."' and salida='' and tienda='".$tienda."' ";
								mysql_query($strSQL_series,$cn);
							}
						}
					}
					//-------------------------------------------------------------------------------------------------
				}
			}
			
			foreach ($_SESSION['productos3'][0] as $subkey=> $subvalue) {
				if($_SESSION['productos3'][26][$subkey]!='')continue;
				$strSQL4="select * from producto where idproducto='".$subvalue."' ";
				$resultado4=mysql_query($strSQL4,$cn);
				while($row4=mysql_fetch_array($resultado4)){
					$descargo=$row4['kardex'];
					// $costo_suc_origen=$row4['costo_inven'.$sucursal]*$temp_subunidad;
					$costo_suc_origen=$row4['costo_inven'.$sucursal];
					if($sucursal!=$sucursal2){
						$costo_inven1=calc_costo_inv($subvalue,$fecha_aud,$costo_suc_origen,$temp_subunidad,'saldo'.$tienda2,'costo_inven'.$sucursal2);
						$upd_costo_suc=",costo_inven".$sucursal2."='$costo_inven1'";
					}else{
						$upd_costo_suc=" ";
					}
					$und_pr=$row4['und'];
					//	  $factor_pr=$row4['factor']; 
					//----------------subunidadesssss---------------------------
					if($und_pr != $_SESSION['productos3'][4][$subkey]){
						$strSQL_unid="select * from unixprod where producto='".$subvalue."' and unidad='".$_SESSION['productos3'][4][$subkey]."'";
						$resultado_unid=mysql_query($strSQL_unid,$cn);
						$row_unid=mysql_fetch_array($resultado_unid);
						$factor_subund=$row_unid['factor'];
						
						$temp_subunidad=$_SESSION['productos3'][1][$subkey];
						
						if ($row_unid['mconv']=='P'){
							//procentual
							//$temp_subunidad=$temp_subunidad*($row_prod['factor']/$factor_subund);
							$temp_subunidad=$temp_subunidad*$factor_subund;
						}else{
							//nominal
							//$temp_subunidad=(($temp_subunidad*$temp_subunidad)*10)/$row_prod['factor'];
							$FacSbU = explode('.',$factor_subund);
							//echo $FacSbU[0]
							$SuT1=$temp_subunidad*$FacSbU[0];	//5*1 - 5 
							$SuT2=$temp_subunidad*$FacSbU[1];	//5*3 -	15
							$CatSu = explode('.',number_format($SuT2/$row4['factor'],3,'.','.'));//agrege para redondeo
							//$CatSu = explode('.',$SuT2/$row_prod['factor']); //15/12 - 1.25
							$SuT1=$SuT1+$CatSu[0]; //5+1 - 6
							$SuT2=($CatSu[1]*$row4['factor'])/100; // (25*12)/100 - 3
							$SuT2= number_format($SuT2,0,'','');	 //agrege para redondeo
							$temp_subunidad=$SuT1.'.'.$SuT2 ; //6.3
						}
					}else{
						$temp_subunidad=$_SESSION['productos3'][1][$subkey];
					}
					$imp_item=$costo_suc_origen*$temp_subunidad;
					$moneda="01";
					$costo_inven1=$costo_suc_origen;
					$strSQL5="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,tcambio,moneda,precio,cantidad,imp_item,fechad,costo_inven,saldo_actual,unidad,descargo) values('".$codigo2."','1','".$doc."','".$serie."','".$numero."','".$auxiliar."','".$tienda2."','".$sucursal2."','".$row4['idproducto']."','".addslashes($row4['nombre'])."','".$tc."','".$moneda."','".$costo_suc_origen."','".$temp_subunidad."','".$imp_item."','".cambiarfecha($femision)."','".$costo_inven1."','".$saldo_actual."','".$und_pr."','".$descargo."')";
					mysql_query($strSQL5,$cn);
					$campo="saldo".$tienda2;
					$strSQL6="update producto set $campo=$campo+".$temp_subunidad.$upd_costo_suc." where idproducto='".$subvalue."'";
					mysql_query($strSQL6,$cn);
					//echo $strSQL6;
					//-----------------------------------------------------series--------------------------------------
					$ingreso=$codigo2;
					$salida="";
					$costo_inventario_origen='costo_inven'.$sucursal;
					if(isset($_SESSION['seriesprod'][2])){
						foreach ($_SESSION['seriesprod'][2] as $subkey2=> $subvalue2) {
							if($subvalue2==$row4['idproducto']){
								
								$strSQL00="select fvenc from series where producto='".$row4['idproducto']."' and serie like '%".$_SESSION['seriesprod'][0][$subkey2]."' and salida='".$codigo."' and tienda='".$tienda."' order by serie limit 0,1";
								//$strSQL_series="update series set salida='".$salida."' where id='".$id[0]."' ";
								///GMY
								//$strSQL00="select fvenc from series  where producto='".$row4['idproducto']."' and serie='".$_SESSION['seriesprod'][0][$subkey2]."' and salida='".$codigo."' and tienda='".$tienda."' ";
								//////
								$resultado00=mysql_query($strSQL00,$cn);
								$row00=mysql_fetch_array($resultado00);
								///GMY
								//$strSQL_series="insert into series(producto,serie,ingreso,salida,costo,fvenc,tienda) values ('".$row4['idproducto']."','".strtoupper($_SESSION['seriesprod'][0][$subkey2])."','".$ingreso."','".$salida."','".$row4[$costo_inventario_origen]."','".$row00['fvenc']."','".$tienda2."')";
								////////////
								$txserie=$_SESSION['seriesprod'][0][$subkey2];
								$strSQL_series="insert into series(producto,serie,ingreso,salida,costo,fvenc,tienda) values ('".$row4['idproducto']."','".strtoupper($txserie)."','".$ingreso."','".$salida."','".$row4[$costo_inventario_origen]."','".$row00['fvenc']."','".$tienda2."')";
								mysql_query($strSQL_series,$cn);
							}
						}
					}
					//-------------------------------------------------------------------------------------------------
				}
			}
			$strSQL0="update tienda set estado='N' where cod_tienda='$tienda'";
			mysql_query($strSQL0,$cn);
			
			unset($_SESSION['seriesprod'][0]);
			unset($_SESSION['seriesprod'][1]);
			unset($_SESSION['seriesprod'][2]);
			
			unset($_SESSION['temp_series'][0]);
			unset($_SESSION['temp_series'][1]);
			unset($_SESSION['temp_series'][2]);
			
			//  echo $subvalue,$temp_fecha,$costo_suc_origen,$_SESSION['productos3'][1][$subkey],'saldo'.$tienda2,'costo_inven'.$sucursal2;
		}else{
			echo $prod_no_coincide;
		}
		break;
	 
	case "generar_numero_transf":
		//$strSQL="select max(Num_doc) as Num_doc from cab_mov where sucursal='$sucursal' and cod_ope='$doc' and serie='$serie'";
		$strSQL222="select * from tienda where cod_tienda='$tienda'";
		$resultado222=mysql_query($strSQL222,$cn);
		$row222=mysql_fetch_array($resultado222);
		if(trim($row222['usuario'])==trim($_SESSION['user'])){
			mysql_query("update tienda set estado='N',reserva='',usuario='' where cod_tienda='$tienda' or usuario='".$_SESSION['user']."'",$cn);
		}
		$strSQL222="select * from tienda where cod_tienda='$tienda'";
		$resultado222=mysql_query($strSQL222,$cn);
		$row222=mysql_fetch_array($resultado222);
		$strSQL223="select * from tienda where reserva='$serie'";
		$resultado223=mysql_query($strSQL223,$cn);
		$row223=mysql_fetch_array($resultado223);
		
		if($row223['estado']!=""){
			if($row223['estado']=="N"){
				$filtro=true;
			}else{
				$filtro=false;
			}
		}else{
			$filtro=true;
		}
		//$row222['estado']=='N' && 
		if($row222['estado']=='N' && $filtro){
			mysql_query("update tienda set estado='S',reserva='".$serie."',usuario='".$_SESSION['user']."' where cod_tienda='".$tienda."'",$cn);
			$strSQL="select max(Num_doc) as numero from cab_mov where sucursal='$sucursal' and cod_ope='TS' and serie='$serie'";
			// echo $strSQL;
			$resultado=mysql_query($strSQL,$cn);
			$row=mysql_fetch_array($resultado);
			$cadena=$row['numero']+1;
			echo $cadena;
			
			//if($row222['reserva']==""){
				
			//}
			//$strSQL0="update tienda set estado='S',usuario='".$_SESSION['user']."' where cod_tienda='$tienda'";
			//mysql_query($strSQL0,$cn);
		}else{
			if($filtro==true){
				echo "ocupado?".$row222['usuario']."?";
			}else{
				echo "ocupado?".$row223['usuario']."?";
			}
		}
		break;
	
	case "buscar_transf":
		$strSQL="select * from cab_mov where Num_doc='$numero' and sucursal='$sucursal' and cod_ope='TS' and serie='$serie' and tipo=2";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$cont=mysql_num_rows($resultado);
		
		if($cont==1){
			$strSQL2="select * from cab_mov where Num_doc='$numero' and cod_ope='TS' and serie='$serie' and tipo=1";
			$resultado2=mysql_query($strSQL2,$cn);
			$row2=mysql_fetch_array($resultado2);
			
			$cadena=$row['cod_cab'];
			$sucursal=$row['sucursal'];
			$tienda=$row['tienda'];
			$responsable=$row['cod_vendedor'];
			$fecha1=$row['fecha'];
			$condicion=$row['condicion'];
			$transportista=$row['fecha'];
			
			$sucursal2=$row2['sucursal'];
			$tienda2=$row2['tienda'];
			$cadena2=$row2['cod_cab'];
			
			$strSQL3="select * from det_mov where cod_cab='$cadena'";
			$resultado3=mysql_query($strSQL3,$cn);
			while($row3=mysql_fetch_array($resultado3)){
				$_SESSION['productos'][0][] = $row3['cod_prod'];
				$_SESSION['productos'][1][] = $row3['cantidad'];
				$_SESSION['productos'][2][] = $row3['precio'];
				$_SESSION['productos'][4][] = $row3['unidad'];
			}
			echo $sucursal."?".$tienda."?".$responsable."?".$fecha1."?".$condicion."?".$transportista."?".$sucursal2."?".$tienda2."?".$cadena."?".$cadena2."?";
		}else{
			echo $sucursal."?".$tienda."?".$responsable."?".$fecha1."?".$condicion."?".$transportista."?".$sucursal2."?".$tienda2."?".$cadena."?";
		}
		break;
		
	case "eliminar_transf":
		$doc_transf=$_REQUEST['cod_transf'];
		$doc_transf2=$_REQUEST['cod_transf2'];
		
		// echo  $doc_transf." ".$doc_transf2;break;
		$strSQL_serie="select * from series where ingreso='".$doc_transf2."' and (salida!=0 or salida!='')";
		$resultado=mysql_query($strSQL_serie,$cn);
		$cont=mysql_num_rows($resultado);
		
		if($cont==0){
			$strSQL="delete from cab_mov where cod_cab='$doc_transf'";
			mysql_query($strSQL,$cn);
			
			$strSQL="delete from cab_mov where cod_cab='$doc_transf2'";
			mysql_query($strSQL,$cn);
			
			$strSQL="delete from det_mov where cod_cab='$doc_transf'";
			mysql_query($strSQL,$cn);
			
			$strSQL="delete from det_mov where cod_cab='$doc_transf2'";
			mysql_query($strSQL,$cn);
			
			$tienda=$_REQUEST['tienda'];
			$tienda2=$_REQUEST['tienda2'];
			
			foreach ($_SESSION['productos3'][0] as $subkey=> $subvalue) {
				// $strSQL4="select * from producto where idproducto='".$subvalue."' ";
				// $resultado4=mysql_query($strSQL4,$cn);
				//while($row4=mysql_fetch_array($resultado4)){
				$campo="saldo".$tienda;
				$strSQL6="update producto set $campo=$campo+".$_SESSION['productos3'][1][$subkey]." where idproducto='".$subvalue."'";
				mysql_query($strSQL6,$cn);
				
				$campo2="saldo".$tienda2;
				$strSQL7="update producto set $campo2=$campo2-".$_SESSION['productos3'][1][$subkey]." where idproducto='".$subvalue."'";
				mysql_query($strSQL7,$cn);
				
				//$_SESSION['seriesprod'][0];
				//$_SESSION['seriesprod'][1];
				//$_SESSION['seriesprod'][2];
				// }
			}
			
			$strSQl_serie_destino="delete from series where ingreso='".$doc_transf2."'";
			mysql_query($strSQl_serie_destino,$cn);
			
			$strSQl_serie_ingreso="update series set salida='',estado='F' where salida='".$doc_transf."'";
			mysql_query($strSQl_serie_ingreso,$cn);
		}else{
			echo "serie tiene salida";
		}
		break;
		
	case "salir_transf":
		unset($_SESSION['productos']);
		unset($_SESSION['productos2']);
		unset($_SESSION['productos3']);
		
		$strSQL0="update tienda set estado='N',usuario='',reserva='' where cod_tienda='$tienda'";
		mysql_query($strSQL0,$cn);	
			
		if(isset($_SESSION['seriesprod'])){
			foreach ($_SESSION['seriesprod'][2] as $subkey=> $subvalue) {
				//$_SESSION['seriesprod'][0][$subkey]=$series[$j];
				//$_SESSION['seriesprod'][1][$subkey]=$fvenc;
				//$_SESSION['seriesprod'][2][$subkey]=$producto;
				
				$id=mysql_fetch_array(mysql_query("select id from series where producto='".$_SESSION['seriesprod'][2][$subkey]."' and serie like '%".$_SESSION['seriesprod'][0][$subkey2]."' and salida='' and tienda='".$tienda."' order by serie limit 1",$cn));
				echo $strSQL="update series set estado='F' where id='".$id[0]."'";
				//$strSQL="update series set estado='F' where tienda='".$tienda."' and producto='".$_SESSION['seriesprod'][2][$subkey]."' and serie='".$_SESSION['seriesprod'][0][$subkey]."' and salida='' ";
				mysql_query($strSQL,$cn);
			}
			unset($_SESSION['seriesprod'][0]);
			unset($_SESSION['seriesprod'][1]);
			unset($_SESSION['seriesprod'][2]);
			
			unset($_SESSION['temp_series'][0]);
			unset($_SESSION['temp_series'][1]);
			unset($_SESSION['temp_series'][2]);
		}
		// echo $strSQL0;
		break;
		 
	case  "cargar_cond":
		if ($_SESSION['nivel_usu']==1 || $_SESSION['nivel_usu']==6){ $disabled='disabled';}else{ $disabled='';}
		$combo="<select name='condicion' id='condicion' style='width:120' onFocus='enfocar_cbo(this);limpiar_enfoque(this)' onBlur='sumarFechaVen(this)' ".$disabled." >";
		$doc=$_REQUEST['doc'];
		$strSQL="select * from detope where documento='".$doc."' order by condicion";
		$resultado=mysql_query($strSQL,$cn);
		while($row=mysql_fetch_array($resultado)){
			if ($row['condicion']==$_REQUEST['condicion']){  $condicion='selected';}else{ $condicion=''; }
			$combo=$combo."<option value='".$row['condicion']."' ".$condicion." >".caracteres($row['descondi'])."</option>"	;
			$tempCond1=$tempCond1."-".$row['condicion'];
			$tempCond2=$tempCond2."-".$row['deuda'];
		}
		$combo=$combo."</select><input type='hidden' name='deudaCond' id='deudaCond' value='".$tempCond1."|".$tempCond2."'>";
		echo $combo;
		break;
		
	case  "cargar_cond2":
		if ($_SESSION['nivel_usu']==1 || $_SESSION['nivel_usu']==6){ $disabled='disabled';}else{ $disabled='';}
		$combo="<select name='aux_condicion' style='width:120' >";
		$doc=$_REQUEST['doc'];
		$strSQL="select * from detope where documento='".$doc."' order by condicion";
		$resultado=mysql_query($strSQL,$cn);
		while($row=mysql_fetch_array($resultado)){
			if ($row['condicion']==$_REQUEST['condicion']){  $condicion='selected';}else{ $condicion=''; }
			$combo=$combo."<option value='".$row['condicion']."' ".$condicion." >".caracteres($row['descondi'])."</option>"	;
			$tempCond1=$tempCond1."-".$row['condicion'];
			$tempCond2=$tempCond2."-".$row['deuda'];
		}
		$combo=$combo."</select>";
		echo $combo;
		break;
	
	case  "ing_series":
		$series=explode("_",$_REQUEST['series']);
		$fvenc=$_REQUEST['fvenc'];
		$producto=$_REQUEST['producto'];
		$accion=$_REQUEST['accion'];
		$estado_doc=$_REQUEST['estado_doc'];
		$temp_doc=$_REQUEST['temp_doc'];
		$tienda=$_REQUEST['tienda'];
		
		$j=1;
		$filtro=" serie='' ";
		for($i=1;$i<count($series);$i++){
			$filtro=$filtro." || serie='".$series[$i]."' ";
		}
		
		if($estado_doc=='CONSULTA'){
			$strSQL="select * from series where tienda='".$tienda."' and ingreso!='".$temp_doc."' and producto='".$producto."' and salida='' and (".$filtro.") limit 1";
			$resultado=mysql_query($strSQL,$cn);
			$cont=mysql_num_rows($resultado);
		}else{
			if($tipomov=1){
				$strSQL="select * from series where producto='".$producto."' and (salida='' or salida=0) and (".$filtro.") limit 1";
			}else{
				$strSQL="select * from series where tienda='".$tienda."' and producto='".$producto."' and (salida='' or salida=0) and (".$filtro.") limit 1";
			}
			$resultado=mysql_query($strSQL,$cn);
			$cont=mysql_num_rows($resultado);
		}
		
		if($cont==0){
			if($accion=='editar'){
				foreach ($_SESSION['seriesprod'][2] as $subkey=> $subvalue) {
					//echo $producto;
					if($subvalue==$producto){
						$_SESSION['seriesprod'][0][$subkey]=$series[$j];
						$_SESSION['seriesprod'][1][$subkey]=$fvenc;
						$_SESSION['seriesprod'][2][$subkey]=$producto;
						$j++;
					}
				}
			}else{
				unset($_SESSION['temp_series'][0]);
				unset($_SESSION['temp_series'][1]);
				unset($_SESSION['temp_series'][2]);
				
				for($i=1;$i<count($series);$i++){
					$_SESSION['temp_series'][0][]=$series[$i];
					$_SESSION['temp_series'][1][]=$fvenc;
					$_SESSION['temp_series'][2][]=$producto;
				}
			}
			//echo $producto;
		}else{
			$row=mysql_fetch_array($resultado);
			echo $row['serie'];
		}
		break;
		
	case "sal_series":
		$series=explode("_",$_REQUEST['series']);
		$producto=$_REQUEST['producto'];
		$accion=$_REQUEST['accion'];
		$tienda=$_REQUEST['tienda'];
		$fecha_venc=$_REQUEST['fecha_venc'];
		$j=1;
		//echo $accion; 
		if($accion=='editar'){
			foreach ($_SESSION['seriesprod'][2] as $subkey=> $subvalue) {
				//echo $producto;
				if($subvalue==$producto){
					$strSQL="update series set estado='F' where tienda='".$tienda."' and producto='".$producto."' and serie='".$_SESSION['seriesprod'][0][$subkey]."' ";
					mysql_query($strSQL,$cn);
					$_SESSION['seriesprod'][0][$subkey]=$series[$j];
					$_SESSION['seriesprod'][1][$subkey]=$fvenc;
					$_SESSION['seriesprod'][2][$subkey]=$producto;
					$strSQL="update series set estado='V' where tienda='".$tienda."' and producto='".$producto."' and serie='".$series[$j]."' ";
					mysql_query($strSQL,$cn);
					$j++;
				}
			}
		}else{
			for($i=1;$i<count($series);$i++){
				$_SESSION['temp_series'][0][]=$series[$i];
				//		 $_SESSION['temp_series'][1][]=$producto;
				$_SESSION['temp_series'][2][]=$producto;
				
				$strSQL="update series set estado='V' where tienda='".$tienda."' and producto='".$producto."' and serie='".$series[$i]."' ";
				mysql_query($strSQL,$cn);
			}
		}
		echo print_r($_SESSION['seriesprod']);
		break;
		
	case "cambiar_cant_series":
		$series=explode("_",$_REQUEST['series']);
		$producto=$_REQUEST['producto'];
		$cant=$_REQUEST['cant_nueva'];
		
		foreach ($_SESSION['seriesprod'][2] as $subkey=> $subvalue) {
			if($subvalue==$producto){
				unset($_SESSION['seriesprod'][0][$subkey]);
				unset($_SESSION['seriesprod'][1][$subkey]);
				unset($_SESSION['seriesprod'][2][$subkey]);
			}
		}
		
		for($i=1;$i<count($series);$i++){
			$_SESSION['seriesprod'][0][]=$series[$i];
			$_SESSION['seriesprod'][1][]="";
			$_SESSION['seriesprod'][2][]=$producto;
		}
		
		foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
			if($subvalue==$producto){
				$_SESSION['productos'][1][$subkey]=$cant;
			}
		}
		break;
		
	case "save_ptoventa":
		/*
		$strSQL="select  serie,numero_ini,numero_fin from docuser where usuario='".$_SESSION['codvendedor']."' and doc='".$doc."' and tipomov='2' and empresa='".$sucursal."' ";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$serie=$row['serie'];
		*/
		/*
		if($serie==""){
			$strSQL="select min(serie) as serie from cab_mov where sucursal='".$sucursal."' and cod_ope='".$doc."' ";
			$resultado=mysql_query($strSQL,$cn);
			$row=mysql_fetch_array($resultado);
			$serie=$row['serie'];
			if($serie==""){
				$serie='001';
			}
		}
		*/
		
		$strSQL="select * from docuser where pc='".$_SESSION['pc_ingreso']."' and usuario='".$_SESSION['codvendedor']."' ";
		$resultado=mysql_query($strSQL,$cn);
		//$row=mysql_fetch_array($resultado);
		$contColas=mysql_num_rows($resultado);
		if($contColas==0){
			echo "error_imp";die();
		}
		$strSQL="select * from docuser where pc='".$_SESSION['pc_ingreso']."' and usuario='".$_SESSION['codvendedor']."' and  doc='".$doc."' and tipomov='2' and empresa='".$sucursal."' ";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$serie=$row['serie'];
		/*if($doc=='TB'){
			$serie=$_SESSION['srapida']; //caja_serie
		}else{
			$serie=$_SESSION['smesa'];
		}
		if($serie==""){
			$serie='001';
		}*/
		$strSQL="select max(Num_doc) as numero from cab_mov where sucursal='".$sucursal."' and cod_ope='".$doc."' and tipo='".$tipomov."' and serie='".$serie."' ";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$numero=$row['numero']+1;
		
		$strSQL="select  max(cod_cab) as cod_cab from cab_mov";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$codigo=$row['cod_cab']+1;
		
		//-------------------Busca permiso de doc----------------------------------------------
		$strSQL_doc="select * from operacion where codigo='".$doc."' and  tipo='".$tipomov."' ";
		$resultado_doc=mysql_query($strSQL_doc,$cn);
		$row_doc=mysql_fetch_array($resultado_doc);
		$permiso10=substr($row_doc['p1'],9,1);
		$permiso4=substr($row_doc['p1'],3,1);
		$act_kar_IS=$row_doc['kardex'];
		$deuda=substr($row_doc['p1'],4,1);
		
		if($permiso10=='S'){
			switch($act_kar_IS){
				case "I":
					$act_kar_IS="1";
					break;
				case "S":
					$act_kar_IS="2";
					break;
					 
				default:
					$act_kar_IS="";
			}	
		}else{
			$act_kar_IS="";
		}
		
		$items=count($_SESSION['productos'][0]);
		$numero=str_pad($numero, 7, "0", STR_PAD_LEFT);
		//--------------------------cab_mov----------------------------------------------------------------	
		$transportista=$_REQUEST['transportista'];
		
		$strSQL3="insert into cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,caja,cliente,ruc,fecha,f_venc,moneda,impto1,tc,b_imp,igv,servicio,total,saldo,tienda,sucursal,flag,flag_r,motivo,noperacion,items,condicion,incluidoigv,obs1,obs2,obs3,obs4,obs5,inafecto,fecha_aud,pc,kardex,deuda,transportista,percepcion)values('".$codigo."','".$tipomov."','".$doc."','".$numero."','".$serie."','".$responsable."','".$caja."','".$auxiliar."','".$ruc."','".cambiarfecha($femision)."','".cambiarfecha($femision)."','".$moneda."','".$impto."','".$_SESSION['tc']."','".$monto."','".$impuesto1."','".$servicio."','".$total_doc."','".$saldo."','".$tienda."','".$sucursal."','".$flag."','".$flag_r."','".$motivo."','".$noperacion."','".$items."','".$condicion."','".$incluidoigv."','".$obs1."','".$obs2."','".$obs3."','".$obs4."','".$obs5."','".$permiso4."','".$fecha_aud."','".$_SESSION['pc_ingreso']."','".$permiso10."','".$deuda."','".$transportista."','".$percepcion."')";
		$control_Error=mysql_query($strSQL3,$cn);
		if($control_Error){
			
		}else{
			echo "error";
			break;
		}
		//-------------------------------------------------------------------------------------------------------
		//$fvencimiento
		
		//----------------------------------------------------------------------------------------------
		list($deudaCond)=mysql_fetch_row(mysql_query("select deuda from detope where documento='".$doc."' and  condicion='".$condicion."'"));
		// echo $deudaCond;
		if($deudaCond == 'S'){
			$saldo=$total_doc;
			$strSQL3="update cab_mov set saldo='".$saldo."' where cod_cab='".$codigo."' ";
			mysql_query($strSQL3,$cn);
		}else{
			$strSQL_pagos="select max(id) as id from pagos";
			$resultado_pagos=mysql_query($strSQL_pagos,$cn);
			$row_pagos=mysql_fetch_array($resultado_pagos);
			$id_pagos=str_pad($row_pagos['id']+1, 6, "0", STR_PAD_LEFT);
			//--------------------------pagos--------------------------------------------------------------------
			
			if(isset($_SESSION['pagos'][0])){
				foreach ( $_SESSION['pagos'][0] as $subkey=> $subvalue) {
					if($_SESSION['pagos'][6][$subkey]!='' && $_SESSION['pagos'][6][$subkey]!=0 ){
						$montoPagos=number_format($_SESSION['pagos'][6][$subkey],2);
						$monedaPagos="02";
					}
					if($_SESSION['pagos'][4][$subkey]!='' && $_SESSION['pagos'][4][$subkey]!=0 ){
						$montoPagos=number_format($_SESSION['pagos'][4][$subkey],2);
						$monedaPagos="01";
					}
					
					$vuelto=$_REQUEST['vuelto'];
					$moneda_v=$_REQUEST['moneda_v'];
					
					$strSQ_pagos3="insert into pagos(id,t_pago,fecha,fechav,monto,moneda,fechap,tcambio,referencia,vuelto,moneda_v,pc,cod_user) values ('".$id_pagos."','".$_SESSION['pagos'][2][$subkey]."','".extraefecha($femision)."','".extraefecha($femision)."',".$montoPagos.",'".$monedaPagos."','".$fecha_aud."',".$_SESSION['pagos'][5][$subkey].",'".$codigo."','".$vuelto."','".$moneda_v."','".$_SESSION['pc_ingreso']."','".$_SESSION['codvendedor']."')";
					//echo $strSQ3;
					mysql_query($strSQ_pagos3,$cn);
				}
			}else{
				$saldo=$total_doc;
				$strSQ_pagos3="insert into pagos(id,t_pago,fecha,fechav,monto,moneda,fechap,tcambio,referencia,vuelto,moneda_v,pc,cod_user) values ('".$id_pagos."','1','".extraefecha($femision)."','".extraefecha($femision)."',".($total_doc+$percepcion).",'".$moneda."','".$fecha_aud."','".$_SESSION['tc']."','".$codigo."','".$vuelto."','".$moneda_v."','".$_SESSION['pc_ingreso']."','".$_SESSION['codvendedor']."')";
				//echo $strSQ3;
				mysql_query($strSQ_pagos3,$cn);
			}
		}
		// echo $strSQ_pagos3;
		
		//------------insertar cargo percepciones----------------
		
		if($percepcion!=0){
			$strSQL_pagos="select max(id) as id from pagos";
			$resultado_pagos=mysql_query($strSQL_pagos,$cn);
			$row_pagos=mysql_fetch_array($resultado_pagos);
			$id_pagos=str_pad($row_pagos['id']+1, 6, "0", STR_PAD_LEFT);
			
			$strSQ_pagos3="insert into pagos(id,tipo,t_pago,fecha,fechav,monto,moneda,fechap,tcambio,referencia,pc,cod_user) values ('".$id_pagos."','C',15,'".extraefecha($femision)."','".extraefecha($fvencimiento)."',".$percepcion.",'".$moneda."','".$fecha_aud."',".$_SESSION['tc'].",'".$codigo."','".$_SESSION['pc_ingreso']."','".$_SESSION['codvendedor']."')";
			//echo $strSQ3;
			mysql_query($strSQ_pagos3,$cn);
		}
		
		//---------------------------------------
		if($doc!="PF"){
			echo "cod_cab:".$codigo;
		}
		$tempProdOE=0;
		foreach ($_SESSION['productos3'][0] as $subkey=> $subvalue) {
			$imp_item=$_SESSION['productos3'][1][$subkey]*$_SESSION['productos3'][2][$subkey];
			$strSQL4="select * from producto where idproducto='".$subvalue."' ";
			$resultado4=mysql_query($strSQL4,$cn);
			$total_kardex='N';
			while($row4=mysql_fetch_array($resultado4)){
				$prod_igv=$row4['igv'];
				$und_pr=$row4['und'];
				$factor_pr=$row4['factor'];
				$afecto_percep=$row4['agente_percep'];
				//---------------------------control de OE--------------------------
				if($_REQUEST['codcabOE']!='' && $tempProdOE==0 && $row4['series']=='N'){
					$strSQLOE="select * from det_mov where cod_cab='".$_REQUEST['codcabOE']."' and cod_prod='".$subvalue."'";
					$resultadoOE=mysql_query($strSQLOE,$cn);
					$contProd=mysql_num_rows($resultadoOE);
					if($contProd > 0 ){
						$tempProdOE=1;
					}
				}
				//--------------------------------------------------------------------
				
				/*if($tipomov=='1'){
					if($moneda=="02"){
						$imp_item2=$_SESSION['productos3'][1][$subkey]*$_SESSION['productos3'][2][$subkey]*$_SESSION['tc'];
					}else{
						$imp_item2=$imp_item;
					}
					if($permiso4=='N'){
						if($incluidoigv=='S' && $prod_igv=='S'){
							$imp_item2=$imp_item2/1.19;
						}
					}
					$costo_inven1=calc_costo_inv($subvalue,$fecha_aud,$imp_item2,$_SESSION['productos3'][1][$subkey],$campo,$campo0);
					$strSQL_sal="select saldo_actual from det_mov d,cab_mov c where c.cod_cab=d.cod_cab and cod_prod='".$subvalue."' order by fechad desc,cod_det desc limit 1";
					
					$resultado_sal=mysql_query($strSQL_sal,$cn);
					$row_sal=mysql_fetch_array($resultado_sal);
					$salidas=$row_sal['saldo_actual'];
					
					$saldo_actual=$salidas+$_SESSION['productos3'][1][$subkey];
				}else{*/
				
				$strSQL_sal="select saldo_actual from det_mov d,cab_mov c where c.cod_cab=d.cod_cab and  cod_prod='".$subvalue."' order by fechad desc, cod_det desc limit 1";
				$resultado_sal=mysql_query($strSQL_sal,$cn);
				$row_sal=mysql_fetch_array($resultado_sal);
				$salidas=$row_sal['saldo_actual'];
				$saldo_actual=$salidas-$_SESSION['productos3'][1][$subkey];
				// }
				
				$kardex_pro=$row4['kardex'];
				if($permiso10=='S'){
					if($kardex_pro=='S'){
						$total_kardex='S';
					}else{
						$total_kardex='N';
					}
				}
				
				$afecto=$row4['igv'];
				$strSQL444="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,tcambio,moneda,precio,cantidad,imp_item,fechad,descargo,afectoigv,costo_inven,saldo_actual,notas,flag_kardex,unidad,flag_percep) values('".$codigo."','".$tipomov."','".$doc."','".$serie."','".$numero."','".$auxiliar."','".$tienda."','".$sucursal."','".$row4['idproducto']."','".addslashes($row4['nombre'])."','".$tc."','".$moneda."','".$_SESSION['productos3'][2][$subkey]."','".$_SESSION['productos3'][1][$subkey]."','".$imp_item."','".cambiarfecha($femision)."','".$kardex_pro."','".$afecto."','".number_format($costo_inven1,2)."','".$saldo_actual."','".$_SESSION['productos3'][3][$subkey]."','".$act_kar_IS."','".$_SESSION['productos3'][4][$subkey]."','".$afecto_percep."')";
				mysql_query($strSQL444,$cn);
				
				//-------------------control de kardex del producto----------------------------------
				if($total_kardex=='S'){
					if($tipomov!=$act_kar_IS && $act_kar_IS!="" ){
						$tipomov_temp=$act_kar_IS;
						$kardex_doc='';
					}else{
						$tipomov_temp=$tipomov;
					}
					
					if( ($kardex_doc=='' ||  $kardex_doc=='N') || $_SESSION['productos3'][5][$subkey]!='ref' ){
						//----------------subunidadesssss---------------------------
						if($und_pr != $_SESSION['productos3'][4][$subkey]){
							$strSQL_unid="select * from unixprod where producto='".$row4['idproducto']."' and unidad='".$_SESSION['productos3'][4][$subkey]."'";
							$resultado_unid=mysql_query($strSQL_unid,$cn);
							$row_unid=mysql_fetch_array($resultado_unid);
							$factor_subund=$row_unid['factor'];
							
							$temp_subunidad=$_SESSION['productos3'][1][$subkey];
							
							if ($row_unid['mconv']=='P'){
								//procentual
								//$temp_subunidad=$temp_subunidad*($row4['factor']/$factor_subund);
								$temp_subunidad=$temp_subunidad*$factor_subund;
							}else{
								//nominal
								//$temp_subunidad=(($temp_subunidad*$factor_subund)*10)/$row4['factor'];
								$FacSbU = explode('.',$factor_subund);
								//echo $FacSbU[0]
								$SuT1=$temp_subunidad*$FacSbU[0];	//5*1 - 5
								$SuT2=$temp_subunidad*$FacSbU[1];	//5*3 -	15
								$CatSu = explode('.',number_format($SuT2/$row4['factor'],3,'.','.'));//agrege para redondeo
								//$CatSu = explode('.',$SuT2/$row4['factor']); //15/12 - 1.25
								$SuT1=$SuT1+$CatSu[0]; //5+1 - 6
								$SuT2=($CatSu[1]*$row4['factor'])/100; // (25*12)/100 - 3
								$SuT2= number_format($SuT2,0,'','');	 //agrege para redondeo
								$temp_subunidad=$SuT1.'.'.$SuT2 ; //6.3
							}
						}else{
							$temp_subunidad=$_SESSION['productos3'][1][$subkey];
						}
						
						//------------------------------------------------------------------		
						if($tipomov_temp=='1'){
							$saldo1=$row4[$campo]+$temp_subunidad;
							$strSQL40="update producto set $campo=".$saldo1.",$campo0='".$costo_inven1."' where idproducto='".$subvalue."' ";
							//-----------------------------ingreso de series----------------------------
							$ingreso=$codigo;
							$salida="";
							
							if(isset($_SESSION['seriesprod'][2])){
								foreach ($_SESSION['seriesprod'][2] as $subkey2=> $subvalue2) {
									if($subvalue2==$row4['idproducto']){
										//GMY
										$strSQL_series="insert into series(producto,serie,ingreso,salida,costo,fvenc,tienda) values ('".$row4['idproducto']."'".strtoupper($_SESSION['seriesprod'][0][$subkey2])."'','".$ingreso."','".$salida."','".$costo_inven1."','".formatofecha($_SESSION['seriesprod'][1][$subkey2])."','".$tienda."')";
										//////////////////
										//$strSQL_series="insert into series(producto,serie,ingreso,salida,costo,fvenc,tienda) values ('".$row4['idproducto']."','".strtoupper($_SESSION['seriesprod'][0][$subkey2])."','".$ingreso."','".$salida."','".$costo_inven1."','".formatofecha($_SESSION['seriesprod'][1][$subkey2])."','".$tienda."')";
										mysql_query($strSQL_series,$cn);
										//----------------Nota de creditooo---------------
										//if($tipomov!=$act_kar_IS && $act_kar_IS!="" ){
											
										//}
										//-------------------------------------------------
									}
								}
							}
						}else{
							$strSQL4x="select md.* from modelo m,modelo_det md where m.cod_mod=md.cod_mod and  m.cod_prod='".$subvalue."' order by md.cod_mdet ";
							//echo $strSQL4x;
							$resultado4x=mysql_query($strSQL4x,$cn);
							$contModel=mysql_num_rows($resultado4x);
							
							if($contModel>0){
								
							}else{
								$saldo1=$row4[$campo]-$temp_subunidad;
								$strSQL40="update producto set $campo=".$saldo1." where idproducto='".$subvalue."' ";
							}
							
							$salida=$codigo;
							if(isset($_SESSION['seriesprod'][2])){
								foreach ($_SESSION['seriesprod'][2] as $subkey2=> $subvalue2) {
									$filtroSer=" and salida='' ";
									if($subvalue2==$row4['idproducto']){
										
									
										if($_REQUEST['codcabOE']!=''){
											$strSQL3x="select * from series where salida='".$_REQUEST['codcabOE']."' and producto='".$row4['idproducto']."' and tienda='".$tienda."' and serie like '%".$_SESSION['seriesprod'][0][$subkey2]."' order by serie ";
											//GMY
											//$strSQL3x="select * from series where salida='".$_REQUEST['codcabOE']."' and producto='".$row4['idproducto']."' and tienda='".$tienda."' and serie='".$_SESSION['seriesprod'][0][$subkey2]."' ";
											/////////////
											$resultado3x=mysql_query($strSQL3x,$cn);
											$cont3x=mysql_num_rows($resultado3x);
											if($cont3x > 0){
												$tempProdOE=1;
												$filtroSer=" and salida='".$_REQUEST['codcabOE']."' ";
											}
										}
										$id=mysql_fetch_array(mysql_query("select id from series where producto='".$row4['idproducto']."' and tienda='".$tienda."' and serie like '%".$txserie."' ".$filtroSer." order by serie limit 0,1",$cn));
										$strSQL_series="update series set salida='".$salida."' where id='".$id[0]."' ";
										//GMY
										//$strSQL_series="update series set salida='".$salida."' where producto='".$row4['idproducto']."' and serie='".$_SESSION['seriesprod'][0][$subkey2]."' ".$filtroSer." and tienda='".$tienda."' ";
										//////////
										mysql_query($strSQL_series,$cn);
									}
								}
							}
						}
						mysql_query($strSQL40,$cn);
						//echo $strSQL40;
					}
				}
			}
			
			if($subvalue==""){
				/*$strSQL_texto="insert into det_mov(cod_cab,cod_prod,nom_prod,tcambio,moneda,precio,cantidad,imp_item,fechad,descargo,costo_inven,saldo_actual) values('".$codigo."','TEXTO','".$_SESSION['productos3'][2][$subkey]."','".$tc."','".$moneda."','','','','".cambiarfecha($femision)."','".$kardex_pro."','','')";
				mysql_query($strSQL_texto,$cn);*/
				$strSQL_texto="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,tcambio,moneda,precio,cantidad,imp_item,fechad,descargo,costo_inven,saldo_actual,prodpase,flag_kardex,notas) values('".$codigo."','".$tipomov."','".$doc."','".$serie."','".$numero."','".$auxiliar."','".$tienda."','".$sucursal."','TEXTO','".$_SESSION['productos3'][13][$subkey]."','".$tc."','".$moneda."','".$_SESSION['productos3'][2][$subkey]."','".$_SESSION['productos3'][1][$subkey]."','".$imp_item."','".cambiarfecha($femision)."','N','','','".$_SESSION['productos3'][14][$subkey]."','".$tipomov."','".$_SESSION['productos3'][3][$subkey]."')"; 
				mysql_query($strSQL_texto,$cn);
			}
		}			  
		//-----------------------------------cambio de estado de OE-----------------------------------
		
		list($serieOE,$numeroOE)=mysql_fetch_row(mysql_query("select serie,Num_doc from cab_mov where cod_cab='".$_REQUEST['codcabOE']."'"));
		
		if($tempProdOE==1){
			$updateOE="update cab_mov set estadoOT='V',flag='A',flag_r='RO' where cod_cab='".$_REQUEST['codcabOE']."'";
			mysql_query($updateOE,$cn);
			$updateOE="update cab_mov set flag_r='RA' where cod_cab='".$codigo."'";
			mysql_query($updateOE,$cn);
			
			$strSQL_ref="insert into referencia (cod_cab,serie,correlativo,cod_cab_ref)values('".$codigo."','".$serieOE."','".$numeroOE."','".$_REQUEST['codcabOE']."')";
			mysql_query($strSQL_ref,$cn);
			
			$strSQL_series="update series set salida='',estado='F' where  salida='".$_REQUEST['codcabOE']."' ";
			mysql_query($strSQL_series,$cn);
			
			$strSQLOE="select * from det_mov where cod_cab='".$_REQUEST['codcabOE']."'";
			$resultadoOE=mysql_query($strSQLOE,$cn);
			while($rowOE=mysql_fetch_array($resultadoOE)){
				$strSQL4="select * from producto where idproducto='".$rowOE['cod_prod']."' ";
				$resultado4=mysql_query($strSQL4,$cn);
				$row4=mysql_fetch_array($resultado4);
				
				$saldo1=$row4[$campo]+$rowOE['cantidad'];
				$strSQL40="update producto set $campo='".$saldo1."' where idproducto='".$rowOE['cod_prod']."' ";
				mysql_query($strSQL40,$cn);
			}
		}
		//---------------------------------------------------------------------------------------
		
		$strSQL50="select max(id) as id from tempdoc";
		$resultado50=mysql_query($strSQL50,$cn);
		$row50=mysql_fetch_array($resultado50);
		
		$strSQL5="insert intro tempdoc(id,sucursal,tipodoc,doc,serie,numero,auxiliar,estado,usuario)values('".$row50['id']."','".$sucursal."','".$tipomov."','".doc."','".serie."','".$numero."','".$auxiliar."','G','".$_SESSION['codvendedor']."')";
		//$strSQL5="update tempdoc set estado='G' where id='$temp_doc'";
		mysql_query($strSQL5,$cn);
		//echo $sucursal."?".$tipomov."?".$doc."?".$serie."?".$numero."?";
		break;
		
	case  "buscarFactorOT":
		 
		$item=$_REQUEST['producto'];
		//$mt2=$_REQUEST['mt2'];          
		$cantidad=$_REQUEST['cantidad'];
		$ancho=$_REQUEST['ancho'];
		$largo=$_REQUEST['largo'];
				
		//$temp_cant=	$cantidad/1000;
		
		if($cantidad>=10000 && $cantidad<=99999){
		$digito1=substr($cantidad,0,2);
		}else{
			if($cantidad>=100000){
			$digito1=substr($cantidad,0,3);
			}else{
			$digito1=substr($cantidad,0,1);
			}
		}
		
		$digito2=substr($cantidad,1,1);
		$divisor=$digito1.".".$digito2;
		$cantidad=$cantidad/$divisor;
		$mt2=($cantidad*$ancho*$largo*1.05)/10000;
		
		
		/*
		if($temp_cant>=2){
		
		
			if($ancho>$largo){
				$temp_ancho=$ancho;
				$temp_largo=$largo;
				
				$ancho=$temp_largo;
				$largo=$temp_ancho;
			}
			
		$strSQL="select * from factorot where ancho>='$ancho' and largo<='$largo' and item='".$item."'  order by  factor desc limit 1";		  
		$resultado=mysql_query($strSQL,$cn);	
		$row=mysql_fetch_array($resultado);
		$factor=$row['factor'];
		$preMinOt=$row['pre_min'];
		$desc1=$row['desc1'];
		$desc2=$row['desc2'];
		
		$ancho=$temp_ancho;
		$largo=$temp_largo;
				
		}else{		
		$strSQL="select * from factorot where $mt2 between m2_ini and m2_fin and item='".$item."'  ";		  
		$resultado=mysql_query($strSQL,$cn);	
		$row=mysql_fetch_array($resultado);
		$factor=$row['factor'];
		$preMinOt=$row['pre_min'];
		$desc1=$row['desc1'];
		$desc2=$row['desc2'];
		
		}
		*/
		
		$strSQL="select * from factorot where $mt2 between m2_ini and m2_fin and item='".$item."'  ";		  
		$resultado=mysql_query($strSQL,$cn);	
		$row=mysql_fetch_array($resultado);
		$factor=$row['factor'];
		$preMinOt=$row['pre_min'];
		$desc1=$row['desc1'];
		$desc2=$row['desc2'];
		
			
		echo $factor."-".$preMinOt."-".$desc1."-".$desc2."-".$strSQL;
  	 
		break;
		
		case "verDatosOT":
		
		$cod=$_REQUEST['producto'];
		
		 if(isset($_SESSION['productos3'][0])){
				foreach ($_SESSION['productos3'][0] as $subkey=> $subvalue) {
					if($subvalue==$cod){
					$ancho=$_SESSION['productos3'][7][$subkey]; 
					$largo=$_SESSION['productos3'][8][$subkey]; 
					$mt2=$_SESSION['productos3'][9][$subkey]; 
					$factor=$_SESSION['productos3'][10][$subkey]; 
					}
					
				}
		 } 			
			
		echo $ancho."-".$largo."-".$mt2."-".$factor."-";		
				
		break;
		case "save_pago":			
			$codigo=$_REQUEST['codigoDoc'];
			
			
		$strSQL="select ci from cab_mov where cod_cab='".$codigo."'";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$ci=$row['ci']+1;
//---------------------------------------------------------------------------------------------------

			
			
			$strSQL_del="delete from pagos where referencia='".$codigo."'";		
			mysql_query($strSQL_del,$cn);			
			
			
			
//--------------------------pagos--------------------------------------------------------------------							
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
			   
			   $vuelto=$_REQUEST['vuelto'];
			   $moneda_v=$_REQUEST['moneda_v'];
		// condicion para admitir solo pagos al contado		
	 $strSQ_pagos3="insert into pagos(id,t_pago,fecha,fechav,monto,moneda,fechap,tcambio,referencia,vuelto,moneda_v,pc,cod_user,obs,tipo) values ('".$id_pagos."','".$_SESSION['pagos'][2][$subkey]."','".extraefecha($_SESSION['pagos'][7][$subkey])."','".extraefecha($_SESSION['pagos'][7][$subkey])."',".str_replace(",", "", $montoPagos).",'".$monedaPagos."','".$fecha_aud."',".$_SESSION['pagos'][5][$subkey].",'".$codigo."','".$vuelto."','".$moneda_v."','".$_SESSION['pc_ingreso']."','".$_SESSION['codvendedor']."','".$_SESSION['pagos'][8][$subkey]."','".$_SESSION['pagos'][1][$subkey]."')";
			 //-insert
			 mysql_query($strSQ_pagos3,$cn);		
		}
//-------------------------fn de -pagos-----------------------------------------------------------------
		$saldo=$_REQUEST['total_doc']-$_REQUEST['acuenta'];
		$deuda='S';
		if ($saldo<0 || $saldo==0 ){
			$saldo=0;
			$deuda='N';
		}
	$strSQL_mod="update cab_mov set saldo='".$saldo."',deuda ='".$deuda."', ci='".$ci."'  where cod_cab='".$codigo."' ";		
				//-insert
				mysql_query($strSQL_mod,$cn);			
			echo "cod_cab:".$codigo.":".$ci;
					
		break;
		case "save_canjepago":			
		$codigo=$_REQUEST['codigoDoc'];

		$strSQL="select ci from cab_mov where cod_cab='".$codigo."'";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$ci=$row['ci']+1;
//-----------------------------------------------------------------------------------------		
			//2013
			//$strSQL_del="delete from pagos where referencia='".$codigo."'";		
			//mysql_query($strSQL_del,$cn);			
			
//--------------------------pagos-----------------------------------------------------------------
//pago de pv						
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
			   
			   $vuelto=$_REQUEST['vuelto'];
			   $moneda_v=$_REQUEST['moneda_v'];
		// condicion para admitir solo pagos al contado		
	 //$strSQ_pagos3="insert into pagos(id,t_pago,fecha,fechav,monto,moneda,fechap,tcambio,referencia,vuelto,moneda_v,pc,cod_user,obs) values ('".$id_pagos."','".$_SESSION['pagos'][2][$subkey]."','".extraefecha($_SESSION['pagos'][7][$subkey])."','".extraefecha($_SESSION['pagos'][7][$subkey])."',".str_replace(",", "", $montoPagos).",'".$monedaPagos."','".$fecha_aud."',".$_SESSION['pagos'][5][$subkey].",'".$codigo."','".$vuelto."','".$moneda_v."','".$_SESSION['pc_ingreso']."','".$_SESSION['codvendedor']."','".$_SESSION['pagos'][8][$subkey]."')";
	  $strSQ_pagos3="insert into pagos(id,t_pago,fecha,fechav,monto,moneda,fechap,tcambio,referencia,vuelto,moneda_v,pc,cod_user,obs,numero) values ('".$id_pagos."','26','".extraefecha($_SESSION['pagos'][7][$subkey])."','".extraefecha($_SESSION['pagos'][7][$subkey])."',".str_replace(",", "", $montoPagos).",'".$monedaPagos."','".$fecha_aud."',".$_SESSION['pagos'][5][$subkey].",'".$codigo."','".$vuelto."','".$moneda_v."','".$_SESSION['pc_ingreso']."','".$_SESSION['codvendedor']."','".$_SESSION['pagos'][8][$subkey]."','".$_REQUEST['doc']."-".$_REQUEST['numero']."-".$_REQUEST['serie']."')";
			 //-insert
			 mysql_query($strSQ_pagos3,$cn);				 	
		}
//pago de FC // BV
	$strSQL="select  max(cod_cab) as cod_cab from cab_mov";
	$resultado=mysql_query($strSQL,$cn);
	$row=mysql_fetch_array($resultado);
	$NewCod=$row['cod_cab']+1;	

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
			   
			   $vuelto=$_REQUEST['vuelto'];
			   $moneda_v=$_REQUEST['moneda_v'];
		// condicion para admitir solo pagos al contado		
	 $strSQ_pagos3="insert into pagos(id,t_pago,fecha,fechav,monto,moneda,fechap,tcambio,referencia,vuelto,moneda_v,pc,cod_user,obs,numero) values ('".$id_pagos."','".$_SESSION['pagos'][2][$subkey]."','".extraefecha($_SESSION['pagos'][7][$subkey])."','".extraefecha($_SESSION['pagos'][7][$subkey])."',".str_replace(",", "", $montoPagos).",'".$monedaPagos."','".$fecha_aud."',".$_SESSION['pagos'][5][$subkey].",'".$NewCod."','".$vuelto."','".$moneda_v."','".$_SESSION['pc_ingreso']."','".$_SESSION['codvendedor']."','".$_SESSION['pagos'][8][$subkey]."','".$_SESSION['pagos'][3][$subkey]."')";
			 //-insert
			 mysql_query($strSQ_pagos3,$cn);				 	
		}
		
		
		
//-------------------------fin de pagos-----------------------------------------------------------------
		$saldo=$_REQUEST['total_doc']-$_REQUEST['acuenta'];
		$deuda='S';
		if ($saldo<0 || $saldo==0 ){
			$saldo=0;
			$deuda='N';
		}
	$strSQL_mod="update cab_mov set saldo='".$saldo."',deuda ='".$deuda."', ci='".$ci."'  where cod_cab='".$codigo."' ";		
	//-insert
	mysql_query($strSQL_mod,$cn);			

	//crear factura o boleta 2013	//-----------------------------------------------
	//max cad_mod
	$saldoPV=$saldo;
	/*$strSQL="select  max(cod_cab) as cod_cab from cab_mov";
	$resultado=mysql_query($strSQL,$cn);
	$row=mysql_fetch_array($resultado);
	$NewCod=$row['cod_cab']+1;	*/
	if ($_REQUEST['doc']=='BV'){		
		$impto1='18';
		$total = $_REQUEST['acuenta'];
		$b_imp =$total;
		$igv='0';		
		$saldo='0';
		$ci='0';
	}else{
	   	$impto1='18';
		$total=$_REQUEST['acuenta'];
		$b_imp = $total/(($impto1/100)+1);
		$igv=$b_imp*($impto1/100);	
		$saldo='0';
		$ci='0';
	}
	
	
	//cabesera
	$strSQL_mod="INSERT INTO cab_mov (cod_cab,tipo,cod_ope,Num_doc, serie,cod_vendedor,caja,cliente,ruc,fecha,f_venc,moneda,impto1,tc,b_imp,igv,servicio,percepcion,flete,total,saldo,tienda,sucursal,flag,flag_r,motivo,noperacion,items,condicion,incluidoigv,obs1,obs2,obs3,obs4,obs5,inafecto,kardex,transportista,chofer,dirPartida,dirDestino,fecha_aud,pc,usuario,deuda,archivo,estadoOT,numeroOT,ci,fecharegis,puntos,tipoDesc,audita,multi_id)
     
	   SELECT
	             '".$NewCod."',tipo,'".$_REQUEST['doc']."','".$_REQUEST['numero']."','".$_REQUEST['serie']."',cod_vendedor,caja,cliente,ruc,'".cambiarfecha($femision)."','".cambiarfecha($fvencimiento)."',moneda,'".$impto1."',tc,'".$b_imp."','".$igv."',servicio,percepcion,flete,'".$total."','".$saldo."',tienda,sucursal,flag,flag_r,motivo,noperacion,items,condicion,incluidoigv,obs1,obs2,obs3,obs4,obs5,inafecto,kardex,transportista,chofer,dirPartida,dirDestino,fecha_aud,pc,usuario,deuda,archivo,estadoOT,numeroOT,'".$ci."',fecharegis,puntos,tipoDesc,audita,multi_id 
       FROM   cab_mov WHERE  cod_cab='".$codigo."' ";
		mysql_query($strSQL_mod,$cn);	
	//adicionar detalle descripcion
	if ($saldoPV==0){
		$txtDetIns='PAGO POR CANCELACIÓN';
	}else{
		$txtDetIns='PAGO A CUENTA';	
	}
		$strSQL_mod="INSERT INTO det_mov (cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,codanex,nom_prod,unidad,tcambio,moneda,precio,cantidad,imp_item,desc1,desc2,precosto,flag_percep,porcen_percep,notas,fechad,descargo,afectoigv,flag_kardex,costo_inven,saldo_actual,ancho,largo,mt2,factor,descOT,descOT_porc,prodpase,bajapase,fechabpase,codOferta,puntos,envases,cantdesp)
     
	   SELECT
	            '".$NewCod."',tipo,'".$_REQUEST['doc']."','".$_REQUEST['serie']."','".$_REQUEST['numero']."',auxiliar,tienda,sucursal,'TEXTO',codanex,'".$txtDetIns."','',tcambio,moneda,'".$total."','1','".$total."',desc1,desc2,precosto,flag_percep,porcen_percep,notas,fechad,'N','','2',costo_inven,'0',ancho,largo,mt2,factor,descOT,descOT_porc,prodpase,bajapase,fechabpase,codOferta,puntos,envases,cantdesp
       FROM   det_mov WHERE  cod_cab='".$codigo."' LIMIT 0 , 1 ";
		mysql_query($strSQL_mod,$cn);	
	
	
	//detalle		
	$strSQL_mod="INSERT INTO det_mov (cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,codanex,nom_prod,unidad,tcambio,moneda,precio,cantidad,imp_item,desc1,desc2,precosto,flag_percep,porcen_percep,notas,fechad,descargo,afectoigv,flag_kardex,costo_inven,saldo_actual,ancho,largo,mt2,factor,descOT,descOT_porc,prodpase,bajapase,fechabpase,codOferta,puntos,envases,cantdesp)
     
	   SELECT
	            '".$NewCod."',tipo,'".$_REQUEST['doc']."','".$_REQUEST['serie']."','".$_REQUEST['numero']."',auxiliar,tienda,sucursal,cod_prod,codanex,nom_prod,unidad,tcambio,moneda,'0.00',cantidad,'0.00',desc1,desc2,precosto,flag_percep,porcen_percep,notas,fechad,descargo,afectoigv,flag_kardex,costo_inven,'0',ancho,largo,mt2,factor,descOT,descOT_porc,prodpase,bajapase,fechabpase,codOferta,puntos,envases,cantdesp
       FROM   det_mov WHERE  cod_cab='".$codigo."' ";
		mysql_query($strSQL_mod,$cn);		
//----------------------------------------------------------------------------------	
//pago de PV y FA BV
/*$strSQL_mod="insert into pagos(id,tipo,t_pago,fecha,fechav,numero,monto,moneda,vuelto,moneda_v,fechap,tcambio,referencia,estado,obs,pc,cod_user,refer_letra) 

select * from pagos where referencia='".$codigo."'

";
			mysql_query($strSQL_mod,$cn);*/
			
		//---------------------------------------------------------------------
		//Referencia
		
		 list($seriePV,$numeroPV)=mysql_fetch_row(mysql_query("select serie,Num_doc from cab_mov where cod_cab='".$codigo."'"));
		
			$strSQL_mod="insert into referencia(cod_cab,serie,correlativo,cod_cab_ref) values ('".$NewCod."','".$seriePV."','".$numeroPV."','".$codigo."')";
			mysql_query($strSQL_mod,$cn);
		
		//---------------------------------------------------------------------
			echo "cod_cab:".$codigo.":".$ci;
					
		break;
//---------- Demo Y 
		case "save_MulFacventa2":

		$serie=$_REQUEST['serie'];
		$ruc=$_REQUEST['ruc'];
		//$numero=$_REQUEST['numero'];
		
		//----------------Deuda condicion--------------------------
		  $strSQLDetope="select * from detope where condicion='".$condicion."' and documento='".$doc."'";
		$resultadoDetope=mysql_query($strSQLDetope,$cn);
		$rowDetope=mysql_fetch_array($resultadoDetope);
		$condicionDeuda=$rowDetope['deuda'];
		//---------------------------------------------------------
		
	//-------------------Busca permiso de doc----------------------------------------------					
		  $strSQL_doc="select * from operacion where codigo='".$doc."' and  tipo='".$tipomov."' ";
		  $resultado_doc=mysql_query($strSQL_doc,$cn);
		  $row_doc=mysql_fetch_array($resultado_doc);
		  
		  $permiso10=substr($row_doc['p1'],9,1);
		  $permiso4=substr($row_doc['p1'],3,1);
		  $act_kar_IS=$row_doc['kardex'];
		  $deuda=substr($row_doc['p1'],4,1);
		  $items_fac=$row_doc['nitems'];

			if($permiso10=='S'){	
				 switch($act_kar_IS){
					 case "I":
					 $act_kar_IS="1";
					 break;
					 
					 case "S":
					 $act_kar_IS="2";
					 break;
					 
					 default:
					  $act_kar_IS="";
				 }	
			}else{
			$act_kar_IS="";		
			}			
				
		//echo $items_fac;  
		//echo  $items=count($_SESSION['productos3'][0]);
		//General numero de facturas
		$num_Doc_GenerarRk=round(count($_SESSION['productos3'][0])/$items_fac);
		$redondear=(count($_SESSION['productos3'][0])/$items_fac)-$num_Doc_GenerarRk;
		if ($redondear<0.5 && $redondear>0 ){
		$num_Doc_GenerarRk=$num_Doc_GenerarRk+1;
		}else{
		$num_Doc_GenerarRk=$num_Doc_GenerarRk;
		}
		//echo $num_Doc_GenerarRk;
		$NumDet=$items_fac-1;
		$d = 0;	
		$Pv=0;	
for ($i = 1; $i <= $num_Doc_GenerarRk; $i++) {

		$strSQL="select numero,id from tempdoc where sucursal='".$sucursal."' and doc='".$doc."'  and serie='".$serie."' and usuario='".$_SESSION['codvendedor']."' AND estado = 'R' and auxiliar='".$i."'  ";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$numero=$row['numero'];
		$tempdocid=$row['id'];

		$strSQL="select  max(cod_cab) as cod_cab from cab_mov";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$codigo=$row['cod_cab']+1;
		 
		$items=$items_fac;
		$numero=str_pad($numero, 7, "0", STR_PAD_LEFT);
		
 $strSQL3="insert into  cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,caja,cliente,ruc,fecha,f_venc,moneda,impto1,tc,b_imp,igv,servicio,total,saldo,tienda,sucursal,flag,flag_r,motivo,noperacion,items,condicion,incluidoigv,obs1,obs2,obs3,obs4,obs5,inafecto,fecha_aud,pc,kardex,deuda)values('".$codigo."','".$tipomov."','".$doc."','".$numero."','".$serie."','".$responsable."','".$caja."','".$auxiliar."','".$ruc."','".cambiarfecha($femision)."','".cambiarfecha($fvencimiento)."','".$moneda."','".$impto."','".$_SESSION['tc']."','".$monto."','".$impuesto1."','".$servicio."','".$total_doc."','".$saldo."','".$tienda."','".$sucursal."','".$flag."','".$flag_r."','".$motivo."','".$noperacion."','".$items."','".$condicion."','".$incluidoigv."','".$obs1."','".$obs2."','".$obs3."','".$obs4."','".$obs5."','".$permiso4."','".$fecha_aud."','".$_SESSION['pc_ingreso']."','".$permiso10."','".$deuda."')"; 
		 //-insert
		mysql_query($strSQL3,$cn);
		
		//************************* PAGOS **********************************
		if($condicionDeuda!='S'){
		
			$strSQL_pagos="select max(id) as id from pagos";
			$resultado_pagos=mysql_query($strSQL_pagos,$cn);
			$row_pagos=mysql_fetch_array($resultado_pagos);
			$id_pagos=str_pad($row_pagos['id']+1, 6, "0", STR_PAD_LEFT);				
							
				$strSQ_pagos3="insert into pagos(id,t_pago,numero,fecha,fechav,monto,moneda,fechap,tcambio,referencia,pc,cod_user) values ('".$id_pagos."',1,'CASH','".extraefecha($femision)."','".extraefecha($fvencimiento)."',".$total_doc.",'".$moneda."','".$fecha_aud."',".$_SESSION['tc'].",'".$codigo."','".$_SESSION['pc_ingreso']."','".$_SESSION['codvendedor']."')";
			//echo $strSQ3;
				mysql_query($strSQ_pagos3,$cn);
				
		}	
		//********************************************************************
		
		
//-----------------temp de documento -----------------------------
    	$strSQL5="UPDATE tempdoc SET auxiliar= '', estado = 'G' WHERE id='".$tempdocid."' ";
		 //-insert
		 mysql_query($strSQL5,$cn);
//---------------- fin Tempd--------------------------	 
	$codfac =$codfac.':'.$codigo; 
		$montoMilFac='0';	
		
		
for ($d ; $d <= $NumDet; $d++) {
			//insert datos de detalle 
			//echo $i.'>'.$_SESSION['productos3'][0][$d].'/';	
			//echo $d.'-'.$NumDet.'>'.$i.'/'  ;
//*--**-*--	-*-*--*-*-*-*--*-**-*-*-*-*-*-*-*-*-
		  $imp_item=$_SESSION['productos3'][1][$d]*$_SESSION['productos3'][2][$d];
    	  $strSQL4="select * from producto where idproducto='".$_SESSION['productos3'][0][$d]."' ";
		  $resultado4=mysql_query($strSQL4,$cn);		  
		  $total_kardex='N';	
	  
	while($row4=mysql_fetch_array($resultado4)){
		$prod_igv=$row4['igv'];
		$und_pr=$row4['und'];
		$factor_pr=$row4['factor']; 
		$kardex_pro=$row4['kardex'];
		$afecto=$row4['igv'];
		 
		$strSQL_sal="select saldo_actual from det_mov d,cab_mov c where c.cod_cab=d.cod_cab and  cod_prod='".$_SESSION['productos3'][0][$d]."' order by fechad desc, cod_det desc limit 1";
		
		 $resultado_sal=mysql_query($strSQL_sal,$cn);
		 $row_sal=mysql_fetch_array($resultado_sal);		 
		 $salidas=$row_sal['saldo_actual'];		 				 
		 $salo_actual=$salidas-$_SESSION['productos3'][1][$d];	
		 	 
		//Maneja kardex PV
		if ($_SESSION['productos3'][7][$d]=='N'){
			if($permiso10=='S'){
				if($kardex_pro=='S'){	
					$total_kardex='S';		
				}else{
					$total_kardex='N';		
				}
			}
		}else{
			if($permiso10=='S'){
				if($kardex_pro=='N'){	
					$total_kardex='S';		
				}else{
					$total_kardex='N';		
				}
			}
		}
		
		if($_SESSION['productos3'][1][$d]==0)continue;	
			
	 	$strSQL444="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,tcambio,moneda,precio,cantidad,imp_item,fechad,descargo,afectoigv,costo_inven,saldo_actual,notas,flag_kardex,unidad) values('".$codigo."','".$tipomov."','".$doc."','".$serie."','".$numero."','".$auxiliar."','".$tienda."','".$sucursal."','".$row4['idproducto']."','".addslashes($row4['nombre'])."','".$tc."','".$moneda."','".$_SESSION['productos3'][2][$d]."','".$_SESSION['productos3'][1][$d]."','".$imp_item."','".cambiarfecha($femision)."','".$kardex_pro."','".$afecto."','".number_format($costo_inven1,2)."','".$saldo_actual."','".$_SESSION['productos3'][3][$d]."','".$act_kar_IS."','".$_SESSION['productos3'][4][$d]."')"; 
			//-insert
		   	mysql_query($strSQL444,$cn);	
			
			
			
	$codigo_DocFac=$_SESSION['productos3'][6][$d];
// verificando la catidad de referencia ex existe 

		//actualizando cantidades en el documento referenciado(PV)
		$strSQLDetMov="update det_mov set cantdesp=cantdesp+'".$_SESSION['productos3'][1][$d]."' where cod_cab='".$codigo_DocFac."' and cod_prod='".$row4['idproducto']."'"; 
		mysql_query($strSQLDetMov,$cn);
				
		//-------------------------------------------------
	
			$codigo_DocFacX="<1>";	
			if ($_SESSION['productos3'][6][$d]<>$Xcoddet){
			$Xcoddet=$_SESSION['productos3'][6][$d];
					if ($d % $items_fac) {
						$codigo_DocFacX="<2>";			
					}					
			}	
			//crear referencia
	//-----------------referencia de documento -----------------------------
		$strSQL0025="select  max(id) as id from referencia";
		$resultado0025=mysql_query($strSQL0025,$cn);
		$row0025=mysql_fetch_array($resultado0025);
		$codigo_ref=$row0025['id']+1;	
		$codigo_ref2=$codigo;
		
		
		 list($serie_DocFac,$numero_DocFac)=mysql_fetch_row(mysql_query("select serie,Num_doc from cab_mov where cod_cab='".$codigo_DocFac."'"));
		
		
			if ($d % $items_fac) {
				if ($codigo_DocFacX=="<2>"){
			//echo	$codigo_DocFacX;
			$strSQL_ref="insert into referencia (id,cod_cab,serie,correlativo,cod_cab_ref)values('".$codigo_ref."','".$codigo_ref2."','".$serie_DocFac."','".$numero_DocFac."','".$codigo_DocFac."')";	//$_REQUEST['codigoDoc']
		//-insert
		mysql_query($strSQL_ref,$cn);
				}					
			}else{ 			
			//echo	$codigo_DocFacX;
			$strSQL_ref="insert into referencia (id,cod_cab,serie,correlativo,cod_cab_ref)values('".$codigo_ref."','".$codigo_ref2."','".$serie_DocFac."','".$numero_DocFac."','".$codigo_DocFac."')";	//$_REQUEST['codigoDoc']
		//-insert
		 mysql_query($strSQL_ref,$cn);
			}				
		//-----------------fin referencia de documento ----------------------------- 		
		
		//'-----actualiza el documento origen como referenciado
		$strSQL_ref2="update cab_mov set flag_r=CONCAT(flag_r,'RO') where cod_cab='".$codigo_DocFac."'"; 
		//-insert
		 mysql_query($strSQL_ref2);
		 //'-----actualiza el documento destino doc nuevos ccmo referenciado
		$strSQL_ref2="update cab_mov set flag_r=CONCAT(flag_r,'RA') where cod_cab='".$codigo_ref2."'";
		//-insert
		 mysql_query($strSQL_ref2);		
		//---------------- fin Ref Doc --------------------------
		
		//--------------	flag_kardex---Actualiza kardex
		$strSQL_ref2="update cab_mov set kardex ='N' where cod_cab='".$codigo_DocFac."'"; 
		mysql_query($strSQL_ref2);
		
		$strSQL_ref2="update det_mov set flag_kardex ='' where cod_cab='".$codigo_DocFac."'"; 
		mysql_query($strSQL_ref2);
		//----------------fin flag_kardex
		
						
			$montoMilFac=$montoMilFac + $imp_item;
	//-------------------control de kardex del producto----------------------------------
			if($total_kardex=='S'){	
			
				if($tipomov!=$act_kar_IS && $act_kar_IS!="" ){
				   $tipomov_temp=$act_kar_IS;	
				   $kardex_doc='';				
				}else{
				   $tipomov_temp=$tipomov;
				}  
				   if( ($kardex_doc=='' ||  $kardex_doc=='N') || $_SESSION['productos3'][5][$d]!='ref' ){
						//----------------subunidadesssss---------------------------	
						if($und_pr != $_SESSION['productos3'][4][$d]){
						
							$strSQL_unid="select * from unixprod where producto='".$row4['idproducto']."' 
							and unidad='".$_SESSION['productos3'][4][$d]."'";
							$resultado_unid=mysql_query($strSQL_unid,$cn);
							$row_unid=mysql_fetch_array($resultado_unid);
							$factor_subund=$row_unid['factor'];
																		
							$temp_subunidad=$_SESSION['productos3'][1][$d];
							 
								if ($row_unid['mconv']=='P'){
								//procentual
									 $temp_subunidad=$temp_subunidad*$factor_subund;
								}else{
								//nominal
									$FacSbU = explode('.',$factor_subund);
									$SuT1=$temp_subunidad*$FacSbU[0];	//5*1 - 5 
									$SuT2=$temp_subunidad*$FacSbU[1];	//5*3 -	15
									$CatSu = explode('.',number_format($SuT2/$row4['factor'],3,'.','.'));
									$SuT1=$SuT1+$CatSu[0]; //5+1 - 6
									$SuT2=($CatSu[1]*$row4['factor'])/100; // (25*12)/100 - 3
									$SuT2= number_format($SuT2,0,'','');	 //agrege para redondeo
									$temp_subunidad=$SuT1.'.'.$SuT2 ; //6.3
								}																							
						}else{
						 $temp_subunidad=$_SESSION['productos3'][1][$d];
						}
					//-----------------------Fin Sub Uni-------------------------------------------	
					
											
						if($tipomov_temp=='1'){														
								$saldo1=$row4[$campo]+$temp_subunidad;																						 								$strSQL40="update producto set $campo=".$saldo1.",$campo0='".$costo_inven1."' 								where idproducto='".$_SESSION['productos3'][0][$d]."' ";																	
								//-----------------------------ingreso de series----------------------------
								/*	$ingreso=$codigo;
								$salida="";
								
								if(isset($_SESSION['seriesprod'][2])){
									foreach ($_SESSION['seriesprod'][2] as $subkey2=> $subvalue2) {										 
										if($subvalue2==$row4['idproducto']){										
										$strSQL_series="insert into series(producto,serie,ingreso,salida,costo,fvenc,tienda) values ('".$row4['idproducto']."','".strtoupper($_SESSION['seriesprod'][0][$subkey2])."','".$ingreso."','".$salida."','".$costo_inven1."','".formatofecha($_SESSION['seriesprod'][1][$subkey2])."','".$tienda."')";
										//-insert
										//mysql_query($strSQL_series,$cn);								
										}
									}
							 	}			*/
							 	//-----------------------------fin ingreso de series----------------------------					
							 }else{							 		 
								 $saldo1=$row4[$campo]-$temp_subunidad;
								 $strSQL40="update producto set $campo=".$saldo1." where idproducto='".$_SESSION['productos3'][0][$d]."' ";
								//-----------------------------ingreso de series---------------------------- 	
								/*$salida=$codigo;
								if(isset($_SESSION['seriesprod'][2])){
									foreach ($_SESSION['seriesprod'][2] as $subkey2=> $subvalue2) {										 
										if($subvalue2==$row4['idproducto']){										
								$strSQL_series="update series set salida='".$salida."' where producto='".$row4['idproducto']."' and serie='".$_SESSION['seriesprod'][0][$subkey2]."' and salida='' and tienda='".$tienda."' ";		
									//-insert
									//mysql_query($strSQL_series,$cn);										
									  }
								   }	
								}	 	 */
								//-----------------------------fin ingreso de series----------------------------
							 }
						//-insert
						 mysql_query($strSQL40,$cn);						 
						// *-*-*-*-*-*--*------Fin de ingreso de series---------------------------------
					}	
					
					
						
				}			
				
				//-----UpdateSerie
					$strSQL_series="update series set salida='".$codigo."' where producto='".$row4['idproducto']."' and salida='".$_REQUEST['codigoDoc']."' and tienda='".$tienda."' ";
					
					echo $strSQL_series;
								//$codigo_DocFac	
							//-insert
							mysql_query($strSQL_series,$cn);
					//-----	fin UpdateSerie	
	 //-------------------//-------------------//-------------------
	}

			if($_SESSION['productos3'][0][$d]==" "){
			echo	$strSQL_texto="insert into det_mov(cod_cab,cod_prod,nom_prod,tcambio,moneda,precio,cantidad,imp_item,fechad,descargo,costo_inven,saldo_actual) values('".$codigo."','TEXTO','".$_SESSION['productos3'][2][$d]."','".$tc."','".$moneda."','','','','".cambiarfecha($femision)."','".$kardex_pro."','','')"; 
					//-insert
					mysql_query($strSQL_texto,$cn);		
			 }
//*-*-*-*-*-*--*-*-*-*-*-*-*-*-*-*-*-*--*-*--*-*-*-*-*-**--**-*--*-**--*-*-**-*-*-				
}	

		if (count($_SESSION['productos3'][0])>$d){
			$NumDet=$NumDet+$items_fac;
		}	

 //--------------------------pagos--------------------------------------------------------------------		  		
 		//$saldo=0;				
		$saldo=$total_doc;
		foreach ( $_SESSION['pagos'][0] as $subkey=> $subvalue) {		  
			   if($_SESSION['pagos'][6][$subkey]!='' && $_SESSION['pagos'][6][$subkey]!=0 ){
			   $montoPagos=number_format($_SESSION['pagos'][6][$subkey],2);
			   $monedaPagos="02";
			   }
			   if($_SESSION['pagos'][4][$subkey]!='' && $_SESSION['pagos'][4][$subkey]!=0 ){
			   $montoPagos=number_format($_SESSION['pagos'][4][$subkey],2);
			   $monedaPagos="01";
			   }			   			   
			   $vuelto=$_REQUEST['vuelto'];
			   $moneda_v=$_REQUEST['moneda_v'];		
			   
			   ///////////////////////NUEVO PROCEDIMIENTO///////////////////////
			   
			   /////////////////////////////////////////////////////////////////

if ($num_Doc_GenerarRk==1){	
	$strSQL_pagos="select max(id) as id from pagos";
	$resultado_pagos=mysql_query($strSQL_pagos,$cn);
	$row_pagos=mysql_fetch_array($resultado_pagos);
	$id_pagos=str_pad($row_pagos['id']+1, 6, "0", STR_PAD_LEFT);	
  			
	if ($_SESSION['pagos'][1][$subkey]<>'B'){						
		$strSQ_pagos3="insert into pagos(id,tipo,t_pago,fecha,fechav,monto,moneda,fechap,tcambio,referencia,vuelto,moneda_v,pc,cod_user) values ('".$id_pagos."','".$_SESSION['pagos'][1][$subkey]."','".$_SESSION['pagos'][2][$subkey]."','".extraefecha($femision)."','".extraefecha($femision)."',".$montoPagos.",'".$monedaPagos."','".$fecha_aud."',".$_SESSION['tc'].",'".$codigo."','".$vuelto."','".$moneda_v."','".$_SESSION['pc_ingreso']."','".$_SESSION['codvendedor']."')";
		//echo $strSQ_pagos3;
		mysql_query($strSQ_pagos3,$cn);
		if($_SESSION['pagos'][1][$subkey]=="C"){
			$saldo=$saldo+$montoPagos;	
		}else{
			$saldo=$saldo-$montoPagos;	
		}
	}	 
}else{
	if ($_SESSION['pagos'][1][$subkey]<>'B'){
		if ($i>1){
			if ($_SESSION['pagos'][2][$subkey]<7){	
				$strSQL_pagos="select max(id) as id from pagos";
				$resultado_pagos=mysql_query($strSQL_pagos,$cn);
				$row_pagos=mysql_fetch_array($resultado_pagos);
				$id_pagos=str_pad($row_pagos['id']+1, 6, "0", STR_PAD_LEFT);
				if ($_SESSION['pagos'][2][$subkey]==1 && $condicion=='2' ){ $TOLF=$TOLF-$montoPagos;}
					$strSQ_pagos3="insert into pagos(id,tipo,t_pago,fecha,fechav,monto,moneda,fechap,tcambio,referencia,vuelto,moneda_v,pc,cod_user) values ('".$id_pagos."','".$_SESSION['pagos'][1][$subkey]."','".$_SESSION['pagos'][2][$subkey]."','".extraefecha($femision)."','".extraefecha($femision)."',".$TOLF.",'".$monedaPagos."','".$fecha_aud."',".$_SESSION['tc'].",'".$CodPag."','0','".$moneda_v."','".$_SESSION['pc_ingreso']."','".$_SESSION['codvendedor']."')";
					//echo $strSQ_pagos3;
					mysql_query($strSQ_pagos3,$cn);
					$Pv=$Pv+$TOLF;	
					$saldo=0;
				}	  
			}	
		//echo '('.$i.'-'.$num_Doc_GenerarRk.')';
			if ($i==$num_Doc_GenerarRk && $condicion!='2' ){
				if ($_SESSION['pagos'][2][$subkey]==1){
					$montoPagos=$montoPagos-$Pv;
				}
				$strSQL_pagos="select max(id) as id from pagos";
				$resultado_pagos=mysql_query($strSQL_pagos,$cn);
				$row_pagos=mysql_fetch_array($resultado_pagos);
				$id_pagos=str_pad($row_pagos['id']+1, 6, "0", STR_PAD_LEFT);
						  
				$strSQ_pagos3="insert into pagos(id,tipo,t_pago,fecha,fechav,monto,moneda,fechap,tcambio,referencia,vuelto,moneda_v,pc,cod_user) values ('".$id_pagos."','".$_SESSION['pagos'][1][$subkey]."','".$_SESSION['pagos'][2][$subkey]."','".extraefecha($femision)."','".extraefecha($femision)."',".$montoPagos.",'".$monedaPagos."','".$fecha_aud."',".$_SESSION['tc'].",'".$codigo."','".$vuelto."','".$moneda_v."','".$_SESSION['pc_ingreso']."','".$_SESSION['codvendedor']."')";
			 	// echo $strSQ_pagos3;
				mysql_query($strSQ_pagos3,$cn);
				if($_SESSION['pagos'][1][$subkey]=="C"){
					$saldo=$saldo+$montoPagos;	
				}else{
			  		$saldo=$saldo-$montoPagos;	
				}
			  //$saldo=$montoPagos;
			}
		}			
	}		
			 		
}		//--------------------------------------------------------------------------------------------------------
	$CodPag=$codigo;

//-----------------inicio act cad_mov	 actualizar costo con y sin igv
	$BIF=$montoMilFac/(1+($impto/100));
	$IGVF=$montoMilFac-$BIF;
	$IGVF= number_format($IGVF, 2, '.', '');//str_replace(",", "", $IGVF);
	$BIF= number_format($BIF, 2, '.', '');//str_replace(",", "", $BIF);
	$TOLF=str_replace(",", "", $montoMilFac);
	
	///SOBRA///////////////////////////////////////////////////
	//if ($saldo==0){ $saldo=$saldo; }else{ $saldo=$TOLF-$saldo; }	
	//if ($condicion=='2' && $saldo==$TOLF){$saldo=$Pv; }
	//if ($condicion=='2' && $saldo=='0'){$saldo=$TOLF; }	
	////////////////////////////////////////////////////////////
	//echo $codigo.'-'.$saldo.''.$Pv;
	//echo $condicion.'-'.$saldo.'-'.$TOLF.'-'.$Pv;
	//$saldo=0;
	
	if($condicionDeuda!='S'){
	
	$saldo=0;
	$strSQLActFac="update cab_mov set b_imp='".$BIF."',igv='".$IGVF."',total='".$TOLF."',saldo='".$saldo."' where cod_cab='".$codigo."'";
	
	}else{
	
	$saldo=$TOLF;
	$strSQLActFac="update cab_mov set b_imp='".$BIF."',igv='".$IGVF."',total='".$TOLF."',saldo='".$saldo."' where cod_cab='".$codigo."'";
	}
	
	//if ($doc=='TF'){
	
	///}else{
	//	$strSQLActFac="update cab_mov set b_imp='".$TOLF."',igv='0',total='".$TOLF."',saldo='".$saldo."' where cod_cab='".$codigo."'";
	//}
	 //-insert
	 mysql_query($strSQLActFac,$cn);
	 
	 
//-----------------fin cad_mov		

	$sql="select * from det_mov where cod_cab='".$codigo."' and  cantdesp<cantidad"; // and flag_r='RO' 
	$resultadoX=mysql_query($sql,$cn);
	$tempCOnt=mysql_num_rows($resultadoX);
	if($tempCOnt==0 ){
	$strSQLActFac="update cab_mov set estadoOT='T' where cod_cab='".$codigo."'";
	mysql_query($strSQLActFac,$cn);
	}

}

//ELIMINAR PAGO Y FLETE RK

			// Numero de codigo a imprmir 
			echo "cod_cab".$codfac;
		
		break;
//---------- yedem		
case "save_MulFacventa":
		
	$strSQL="select  serie,numero_ini,numero_fin from docuser where usuario='".$_SESSION['codvendedor']."' and doc='".$doc."' and tipomov='2' and empresa='".$sucursal."' ";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$serie=$row['serie'];
		
		if($serie==""){
		$strSQL="select min(serie) as serie from cab_mov where sucursal='".$sucursal."' and cod_ope='".$doc."' ";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$serie=$row['serie'];
			if($serie==""){
			$serie='001';
			}
		}
		
		$strSQL="select max(Num_doc) as numero from cab_mov where sucursal='".$sucursal."' and cod_ope='".$doc."' and tipo='".$tipomov."' and serie='".$serie."' ";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$numero=$row['numero']+1;
		
				
		$strSQL="select  max(cod_cab) as cod_cab from cab_mov";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$codigo=$row['cod_cab']+1;
		
		//-------------------Busca permiso de doc----------------------------------------------					
		  $strSQL_doc="select * from operacion where codigo='".$doc."' and  tipo='".$tipomov."' ";
		  $resultado_doc=mysql_query($strSQL_doc,$cn);
		  $row_doc=mysql_fetch_array($resultado_doc);
		  
		  $permiso10=substr($row_doc['p1'],9,1);
		  $permiso4=substr($row_doc['p1'],3,1);
		  $act_kar_IS=$row_doc['kardex'];
		  $deuda=substr($row_doc['p1'],4,1);
		
			if($permiso10=='S'){	
				 switch($act_kar_IS){
					 case "I":
					 $act_kar_IS="1";
					 break;
					 
					 case "S":
					 $act_kar_IS="2";
					 break;
					 
					 default:
					  $act_kar_IS="";
				 }	
			}else{
			$act_kar_IS="";		
			}			
		
		
          $items=count($_SESSION['productos3'][0]);
		  $numero=str_pad($numero, 7, "0", STR_PAD_LEFT);
		  
//--------------------------pagos--------------------------------------------------------------------							
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
			   
			   
			   $vuelto=$_REQUEST['vuelto'];
			   $moneda_v=$_REQUEST['moneda_v'];
								
									
		$strSQ_pagos3="insert into pagos(id,t_pago,fecha,fechav,monto,moneda,fechap,tcambio,referencia,vuelto,moneda_v,pc,cod_user) values ('".$id_pagos."','".$_SESSION['pagos'][2][$subkey]."','".extraefecha($femision)."','".extraefecha($femision)."',".str_replace(",", "", $montoPagos).",'".$monedaPagos."','".$fecha_aud."',".$_SESSION['tc'].",'".$codigo."','".$vuelto."','".$moneda_v."','".$_SESSION['pc_ingreso']."','".$_SESSION['codvendedor']."')";
			  mysql_query($strSQ_pagos3,$cn);
			
		}
//--------------------------------------------------------------------------------------------------------
	  
		$strSQL3="insert into cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,caja,cliente,ruc,fecha,f_venc,moneda,impto1,tc,b_imp,igv,servicio,total,saldo,tienda,sucursal,flag,flag_r,motivo,noperacion,items,condicion,incluidoigv,obs1,obs2,obs3,obs4,obs5,inafecto,fecha_aud,pc,kardex,deuda)values('".$codigo."','".$tipomov."','".$doc."','".$numero."','".$serie."','".$responsable."','".$caja."','".$auxiliar."','".$ruc."','".cambiarfecha($femision)."','".cambiarfecha($fvencimiento)."','".$moneda."','".$impto."','".$_SESSION['tc']."','".$monto."','".$impuesto1."','".$servicio."','".$total_doc."','".$saldo."','".$tienda."','".$sucursal."','".$flag."','".$flag_r."','".$motivo."','".$noperacion."','".$items."','".$condicion."','".$incluidoigv."','".$obs1."','".$obs2."','".$obs3."','".$obs4."','".$obs5."','".$permiso4."','".$fecha_aud."','".$_SESSION['pc_ingreso']."','".$permiso10."','".$deuda."')"; 
		
			mysql_query($strSQL3,$cn);
		
		if($doc!="PF"){
		echo "cod_cab:".$codigo;
		}
		
		
	foreach ($_SESSION['productos3'][0] as $subkey=> $subvalue) {
			 		 
		  $imp_item=$_SESSION['productos3'][1][$subkey]*$_SESSION['productos3'][2][$subkey];
    	  $strSQL4="select * from producto where idproducto='".$subvalue."' ";
		  $resultado4=mysql_query($strSQL4,$cn);		  
		  $total_kardex='N';
			  
		while($row4=mysql_fetch_array($resultado4)){
		
		$prod_igv=$row4['igv'];
		$und_pr=$row4['und'];
		$factor_pr=$row4['factor']; 		  
		  
		   		$strSQL_sal="select saldo_actual from det_mov d,cab_mov c where c.cod_cab=d.cod_cab and  cod_prod='".$subvalue."' order by fechad desc, cod_det desc limit 1";
				 
				 $resultado_sal=mysql_query($strSQL_sal,$cn);
				 $row_sal=mysql_fetch_array($resultado_sal);		 
				 $salidas=$row_sal['saldo_actual'];		 				 
				 $saldo_actual=$salidas-$_SESSION['productos3'][1][$subkey];
			
		
			  $kardex_pro=$row4['kardex'];
				if($permiso10=='S'){
					if($kardex_pro=='S'){	
						$total_kardex='S';		
					}else{
						$total_kardex='N';		
					}
				}
		  
		  $afecto=$row4['igv'];
			  
		  $strSQL444="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,tcambio,moneda,precio,cantidad,imp_item,fechad,descargo,afectoigv,costo_inven,saldo_actual,notas,flag_kardex,unidad) values('".$codigo."','".$tipomov."','".$doc."','".$serie."','".$numero."','".$auxiliar."','".$tienda."','".$sucursal."','".$row4['idproducto']."','".addslashes($row4['nombre'])."','".$tc."','".$moneda."','".$_SESSION['productos3'][2][$subkey]."','".$_SESSION['productos3'][1][$subkey]."','".$imp_item."','".cambiarfecha($femision)."','".$kardex_pro."','".$afecto."','".number_format($costo_inven1,2)."','".$saldo_actual."','".$_SESSION['productos3'][3][$subkey]."','".$act_kar_IS."','".$_SESSION['productos3'][4][$subkey]."')"; 
		  	  
		   	mysql_query($strSQL444,$cn);	
			
	//-------------------control de kardex del producto----------------------------------
		  
		
				if($total_kardex=='S'){	
				
					if($tipomov!=$act_kar_IS && $act_kar_IS!="" ){
					   $tipomov_temp=$act_kar_IS;	
					   $kardex_doc='';				
					}else{
					   $tipomov_temp=$tipomov;
					}
					  
					   if( ($kardex_doc=='' ||  $kardex_doc=='N') || $_SESSION['productos3'][5][$subkey]!='ref' ){
					 
		//----------------subunidadesssss---------------------------
	
				if($und_pr != $_SESSION['productos3'][4][$subkey]){
				
					$strSQL_unid="select * from unixprod where producto='".$row4['idproducto']."' and unidad='".$_SESSION['productos3'][4][$subkey]."'";
					$resultado_unid=mysql_query($strSQL_unid,$cn);
					$row_unid=mysql_fetch_array($resultado_unid);
					$factor_subund=$row_unid['factor'];
																
					 $temp_subunidad=$_SESSION['productos3'][1][$subkey];
					 
						if ($row_unid['mconv']=='P'){
						//procentual
							 $temp_subunidad=$temp_subunidad*$factor_subund;
						}else{
						//nominal
							$FacSbU = explode('.',$factor_subund);
							$SuT1=$temp_subunidad*$FacSbU[0];	//5*1 - 5 
							$SuT2=$temp_subunidad*$FacSbU[1];	//5*3 -	15
					$CatSu = explode('.',number_format($SuT2/$row4['factor'],3,'.','.'));
							$SuT1=$SuT1+$CatSu[0]; //5+1 - 6
							$SuT2=($CatSu[1]*$row4['factor'])/100; // (25*12)/100 - 3
							$SuT2= number_format($SuT2,0,'','');	 //agrege para redondeo
							$temp_subunidad=$SuT1.'.'.$SuT2 ; //6.3
						}																							
				}else{
				 $temp_subunidad=$_SESSION['productos3'][1][$subkey];
				}

		//------------------------------------------------------------------		
								
							if($tipomov_temp=='1'){
														
								$saldo1=$row4[$campo]+$temp_subunidad;	
																							 
								$strSQL40="update producto set $campo=".$saldo1.",$campo0='".$costo_inven1."' where idproducto='".$subvalue."' ";
																	
								//-----------------------------ingreso de series----------------------------
									
								$ingreso=$codigo;
								$salida="";
								
								if(isset($_SESSION['seriesprod'][2])){
									foreach ($_SESSION['seriesprod'][2] as $subkey2=> $subvalue2) {
										 
										if($subvalue2==$row4['idproducto']){
										
										$strSQL_series="insert into series(producto,serie,ingreso,salida,costo,fvenc,tienda) values ('".$row4['idproducto']."','".strtoupper($_SESSION['seriesprod'][0][$subkey2])."','".$ingreso."','".$salida."','".$costo_inven1."','".formatofecha($_SESSION['seriesprod'][1][$subkey2])."','".$tienda."')";
										mysql_query($strSQL_series,$cn);
										//----------------Nota de creditooo---------------
											//if($tipomov!=$act_kar_IS && $act_kar_IS!="" ){
											   
											//}
										//-------------------------------------------------
										}
									}
							 	}											
							 						
							 }else{
							 		 
								 $saldo1=$row4[$campo]-$temp_subunidad;
								 $strSQL40="update producto set $campo=".$saldo1." where idproducto='".$subvalue."' ";
								 	
								$salida=$codigo;
								if(isset($_SESSION['seriesprod'][2])){
									foreach ($_SESSION['seriesprod'][2] as $subkey2=> $subvalue2) {
										 
										if($subvalue2==$row4['idproducto']){
										
										$strSQL_series="update series set salida='".$salida."' where producto='".$row4['idproducto']."' and serie='".$_SESSION['seriesprod'][0][$subkey2]."' and salida='' and tienda='".$tienda."' ";
										
									mysql_query($strSQL_series,$cn);
										
										}
									 }	
								}	 
								 
								 
							 }
																												 
						 mysql_query($strSQL40,$cn);
						 
					//echo $strSQL40;
					  }		  
				 } 
		     
		 }
		 		 	 
		 	  
			  if($subvalue==""){
			  					
				$strSQL_texto="insert into det_mov(cod_cab,cod_prod,nom_prod,tcambio,moneda,precio,cantidad,imp_item,fechad,descargo,costo_inven,saldo_actual) values('".$codigo."','TEXTO','".$_SESSION['productos3'][2][$subkey]."','".$tc."','".$moneda."','','','','".cambiarfecha($femision)."','".$kardex_pro."','','')"; 
		  	  
		  	mysql_query($strSQL_texto,$cn);		
			
			 }
		 

	}			
	
		$strSQL50="select max(id) as id from tempdoc";
		$resultado50=mysql_query($strSQL50,$cn);
		$row50=mysql_fetch_array($resultado50);
		
		$strSQL5="insert intro tempdoc(id,sucursal,tipodoc,doc,serie,numero,auxiliar,estado,usuario)values('".$row50['id']."','".$sucursal."','".$tipomov."','".doc."','".serie."','".$numero."','".$auxiliar."','G','".$_SESSION['codvendedor']."')";
		mysql_query($strSQL5,$cn);	

		// rem guardar referencia
		$SQLRef1="SELECT * FROM cab_mov ORDER BY cod_cab DESC ";
		$resultadoR=mysql_query($SQLRef1,$cn);
		$rowR=mysql_fetch_array($resultadoR);
		$codigo_ref2=$rowR['cod_cab'];
	
		$strSQL0025="select  max(id) as id from referencia";
		$resultado0025=mysql_query($strSQL0025,$cn);
		$row0025=mysql_fetch_array($resultado0025);
		$codigo_ref=$row0025['id']+1;
	
		$strSQL_ref="insert into referencia (id,cod_cab,serie,correlativo,cod_cab_ref)values('".$codigo_ref."','".$codigo_ref2."','".$_REQUEST['serie_ref']."','".$_REQUEST['correlativo_ref']."','".$_REQUEST['codigoDoc']."')";	
		mysql_query($strSQL_ref,$cn);
	
		$strSQL_ref2="update cab_mov set flag_r=CONCAT(flag_r,'RO') where cod_cab='".$_REQUEST['codigoDoc']."'";
		mysql_query($strSQL_ref2);
		$strSQL_ref2="update cab_mov set flag_r=CONCAT(flag_r,'RA') where cod_cab='".$codigo_ref2."'";
		mysql_query($strSQL_ref2);

	
			
		break;
////--------- fin yedem
		case "totales_MiltFac":	
		
$sqlMilFac="select * from cab_mov CM inner join det_mov DM on CM.cod_cab=DM.cod_cab
 where CM.cod_cab in (".stripslashes($_REQUEST['codigo']).") GROUP BY Num_doc "; 
$ResulMultifac = mysql_query($sqlMilFac,$cn); 

//echo $sqlMilFac;
//$rowMilFac=mysql_fetch_array($ResulMultifac);
while($rowMilFac=mysql_fetch_array($ResulMultifac)){
	 if ($rowMilFac['moneda']==$_REQUEST['moneda'] ){
			//$TotalMF=$TotalMF + number_format($rowMilFac['total'],2);
			$TotalMF=$TotalMF+$rowMilFac['total'];			
	 }else{
		   if ($rowMilFac['moneda']=='02'){
			$TotalMF=$TotalMF+($rowMilFac['total']*$_SESSION['tc']);
			//$TotalMF= $TotalMF+ number_format($rowMilFac['total'] * $_SESSION['tc'],2);					
			}elseif ($rowMilFac['moneda']=='01'){
			$TotalMF=$TotalMF+($rowMilFac['total']/$_SESSION['tc']);			
			//$TotalMF=$TotalMF+  number_format($rowMilFac['total'] / $_SESSION['tc'],2);	
			}				
	  }	  

}	
  		echo $TotalMF; 
 		//echo number_format($TotalMF,2);
		
	break;
		case "cla_cat_scat":
		
	$codigo=$_REQUEST['codigo'];
	$codigo2=$_REQUEST['codigo2'];
	$valor=$_REQUEST['valor'];
		
	if ($valor=='cat' ){ 
			$dat_clas=mysql_fetch_array(mysql_query("select * from clasificacion where idclasificacion=".$codigo));
			$nomclas=$dat_clas['des_clas'];
			$nomclas=substr($nomclas,0,3);
			$nomclas= str_replace(' ','',$nomclas);
			$nomclas= str_replace('.','',$nomclas);			
				if ($codigo!='999'){ $w=" where des_cat LIKE '".$nomclas.".%' ";}
			$resultados0 = mysql_query("select * from categoria ".$w." order by des_cat ",$cn);
			echo  "<select style=width:140px name=combocategoria onChange=cla_cat_scat('subcat') >";
			echo '<option selected="selected" value="999">---  '.$CatgNomEti2.' ---</option>';
			while($row0=mysql_fetch_array($resultados0))
			{	
			echo  '<option value="'.$row0['idCategoria'].'">'.$row0['des_cat'].'</option>';		
			}
			echo '</select>';	
	}if ($valor=='subcat' ){

			$dat_clas=mysql_fetch_array(mysql_query("select * from categoria where idCategoria=".$codigo2));
			$nomclas=$dat_clas['des_cat'];
			$nomclas=substr($nomclas,0,4);
			$nomclas= str_replace(' ','',$nomclas);
				if ($codigo2!='999'){ $w=" where des_subcateg LIKE '".$nomclas.".%' ";}
			$resultados0 = mysql_query("select * from subcategoria ".$w." order by des_subcateg ",$cn);
			echo  "<select style=width:140px name=combosubcategoria onChange=cargarproducto('') >";
			echo '<option selected="selected" value="999">---  '.$CatgNomEti3.' ---</option>';
			while($row0=mysql_fetch_array($resultados0))
			{	
			echo  '<option value="'.$row0['idsubcategoria'].'">'.$row0['des_subcateg'].'</option>';		
			}
			echo '</select>';	
			
	}
	
		break;
		case "save_SesionMilFac":
		
		if ($_REQUEST['insert']!='multifac' ){
		//echo  $_REQUEST['NumDc'].'--'.$_REQUEST['codigo'].'--'.$_REQUEST['codigoCli'];		
			$_SESSION['Multifactura'][0][] = $_REQUEST['NumDc']; 
			$_SESSION['Multifactura'][1][] = $_REQUEST['codigo']; 
			$_SESSION['Multifactura'][2][] = $_REQUEST['codigoCli']; 
			$_SESSION['Multifactura'][3][] = $_SESSION['codvendedor']; 
			unset($_SESSION['CodMultifacCli']);
		//-------------------------------------
			$strSQL3=" delete FROM tempmfac where codvendedor='".$_SESSION['codvendedor']."' or  codvendedor='' ";
			mysql_query($strSQL3,$cn);
		}else {
			 foreach ( $_SESSION['Multifactura'][0] as $subkey=> $subvalue) {
					//echo $_SESSION['Multifactura'][2][$subkey];
					$strSQL3="insert into tempmfac values('".$_SESSION['Multifactura'][0][$subkey]."','".$_SESSION['Multifactura'][1][$subkey]."','".$_SESSION['Multifactura'][2][$subkey]."','".$_SESSION['Multifactura'][3][$subkey]."' )";
					mysql_query($strSQL3,$cn);
			 }
		 //////////////////77
		 $strSQL="select *  from tempmfac where codvendedor='".$_SESSION['codvendedor']."'  group by codigoCli ";
			$resultado=mysql_query($strSQL,$cn);
			//$rowSM=mysql_fetch_array($resultado);
			while($row=mysql_fetch_array($resultado)){
				$_SESSION['CodMultifacCli'][0][] = $row['codigoCli'];
			}
			$numero = mysql_num_rows($resultado);
			echo $numero;
		 
		}
		
		    
		
		break;
			
		case "save_TN":

if (count($_SESSION['productos'][0])<>0){		// verificar que exista datos 

		$strSQL="select * from cab_mov where Num_doc='".$_REQUEST['numero']."' and cod_ope='".$_REQUEST['doc']."' and serie='".$_REQUEST['serie']."' ";
	 $resultado=mysql_query($strSQL,$cn);
     $row=mysql_fetch_array($resultado);
	 //$cont=mysql_num_rows($resultado);
	 $sucursal=$row['sucursal'];
	 $tienda=$row['tienda'];
	 $responsable=$row['cod_vendedor'];
	 $fvencimiento=gmdate('d-m-Y',time()-18000);
	 $femision=gmdate('d-m-Y',time()-18000);
	 $ruc=$row['ruc'];
	 $auxiliar=$row['cliente'];
	 $moneda=$row['moneda'];
	 $cod_cab_ref=$row['cod_cab'];

		
		$strSQL="select  max(cod_cab) as cod_cab from cab_mov";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$codigo=$row['cod_cab']+1;
		
		$strSQL="select  max(Num_doc) as Num_doc from cab_mov where cod_ope='TN' and serie='".$_REQUEST['codSNC']."' ";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$numero=$row['Num_doc']+1;
		$numero=str_pad($numero, 7, "0", STR_PAD_LEFT);
		$serieD=$_REQUEST['codSNC'];
		$igv=$_REQUEST['igv'];
		//Insert de cab_mov
		$strSQLNC="insert into cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,caja,cliente,ruc,fecha,f_venc,moneda,impto1,tc,b_imp,igv,servicio,total,saldo,tienda,sucursal,flag,motivo,noperacion,items,condicion,incluidoigv,fecha_aud,pc,inafecto,kardex,deuda)values('".$codigo."','2','TN','".$numero."','".$serieD."','".$responsable."','".$caja."','".$auxiliar."','".$ruc."','".cambiarfecha($femision)."','".cambiarfecha($fvencimiento)."','".$moneda."','".$igv."','".$tc."','".$monto."','".$impuesto1."','".$servicio."','".$total_doc."','".$saldo."','".$tienda."','".$sucursal."','".$flag."','".$motivo."','".$noperacion."','".$items."','".$condicion."','".$incluidoigv."','".$fecha_aud."','".$_SESSION['pc_ingreso']."','".$inafecto."','".$kardex."','".$deuda."')" ;
		//echo  $strSQLNC;
		mysql_query($strSQLNC,$cn);
		
		///Detalle de det_mov
//------------------------------------------------------*--------		--------------------
	  foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
	  	if ($_SESSION['productos'][6][$subkey]=='checked'){	
	      $strSQL4="select * from producto where idproducto='".$subvalue."' ";
		  $resultado4=mysql_query($strSQL4,$cn);
		  while($row4=mysql_fetch_array($resultado4)){
		  $descargo=$row4['kardex'];
		  $costo_suc_origen=$row4['costo_inven'.$sucursal]*$temp_subunidad;
		  
	 	  	   $und_pr=$row4['und'];
	  //----------------subunidadesssss---------------------------	
				if($und_pr != $_SESSION['productos'][4][$subkey]){
				
				$strSQL_unid="select * from unixprod where producto='".$subvalue."' and unidad='".$_SESSION['productos'][1][$subkey]."'";
					$resultado_unid=mysql_query($strSQL_unid,$cn);
					$row_unid=mysql_fetch_array($resultado_unid);
					$factor_subund=$row_unid['factor'];
																
					$temp_subunidad=$_SESSION['productos'][1][$subkey];
					
					if ($row_unid['mconv']=='P'){
					//procentual
						//$temp_subunidad=$temp_subunidad*($row_prod['factor']/$factor_subund);
						$temp_subunidad=$temp_subunidad*$factor_subund;
					}else{
					//nominal
					//$temp_subunidad=(($temp_subunidad*$temp_subunidad)*10)/$row_prod['factor'];
							$FacSbU = explode('.',$factor_subund);
							//echo $FacSbU[0]		
							$SuT1=$temp_subunidad*$FacSbU[0];	//5*1 - 5 
							$SuT2=$temp_subunidad*$FacSbU[1];	//5*3 -	15
				$CatSu = explode('.',number_format($SuT2/$row4['factor'],3,'.','.'));//agrege para redondeo		
							//$CatSu = explode('.',$SuT2/$row_prod['factor']); //15/12 - 1.25
							$SuT1=$SuT1+$CatSu[0]; //5+1 - 6
							$SuT2=($CatSu[1]*$row4['factor'])/100; // (25*12)/100 - 3
							$SuT2= number_format($SuT2,0,'','');	 //agrege para redondeo
							$temp_subunidad=$SuT1.'.'.$SuT2 ; //6.3
					}
				}else{
				 $temp_subunidad=$_SESSION['productos'][1][$subkey];
				}

		 	$strSQl="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,unidad,tcambio,moneda,precio,cantidad,imp_item,fechad,descargo,costo_inven,saldo_actual,prodpase,flag_kardex) values('".$codigo."','2','TN','".$serieD."','".$numero."','".$auxiliar."','".$tienda."','".$sucursal."','".$_SESSION['productos'][0][$subkey]."','".$_SESSION['productos'][5][$subkey]."','".$_SESSION['productos'][4][$subkey]."','".$tc."','".$moneda."','".$_SESSION['productos'][2][$subkey]."','".$_SESSION['productos'][1][$subkey]."','".$imp_item."','".cambiarfecha($femision)."','".$descargo."','','','','".$tipomov."')"; 
				//echo  $strSQl;
				mysql_query($strSQl,$cn);	  
		   		  
		   $campo="saldo".$tienda;		  
		   $strSQL6="update producto set $campo=$campo+".$temp_subunidad.$upd_costo_suc." where idproducto='".$subvalue."'";
		  mysql_query($strSQL6,$cn);		  
		   //-----------------------------------------------------series--------------------------------------
				/*$ingreso=$codigo2;
				$salida="";
				$costo_inventario_origen='costo_inven'.$sucursal;
				
				if(isset($_SESSION['seriesprod'][2])){
				
					foreach ($_SESSION['seriesprod'][2] as $subkey2=> $subvalue2) {
										 
						if($subvalue2==$row4['idproducto']){
							
							$strSQL00="select fvenc from series  where producto='".$row4['idproducto']."' and serie='".$_SESSION['seriesprod'][0][$subkey2]."' and salida='".$codigo."' and tienda='".$tienda."' ";
							$resultado00=mysql_query($strSQL00,$cn);
							$row00=mysql_fetch_array($resultado00);
										
							$strSQL_series="insert into series(producto,serie,ingreso,salida,costo,fvenc,tienda) values ('".$row4['idproducto']."','".strtoupper($_SESSION['seriesprod'][0][$subkey2])."','".$ingreso."','".$salida."','".$row4[$costo_inventario_origen]."','".$row00['fvenc']."','".$tienda2."')";
										
							//mysql_query($strSQL_series,$cn);
										
						}
					}
				}*/
		  //-------------------------------------------------------------------------------------------------
		  		
		  	}	  		  
		 }		  
	  }
//*--*-*-*-*-**----*-**********************************************************
		//Creando Referencia
		$strSQL_ref="insert into referencia (cod_cab,serie,correlativo,cod_cab_ref)values('".$codigo."','".$serieD."','".$numero."','".$cod_cab_ref."')";	
		mysql_query($strSQL_ref,$cn);
		
			//echo 'Guardando Nota de Credito';
			echo "cod_cab:".$codigo;
		}else{
			echo 'No se a creado Nota de Credito';
		}	
		break;
		
		case "buscar_cliente":
			$codigo=$_REQUEST['codigo'];
			$strSQl="select * from cliente where codcliente='".$codigo."' ";
			$resultado=mysql_query($strSQl,$cn);
			$row=mysql_fetch_array($resultado);
			$cont=mysql_num_rows($resultado);
			$cadena=$row['codcliente']."?".caracteres($row['razonsocial'])."?".$row['ruc']."?".caracteres($row['direccion'])."?".$row['t_persona']."?".$row['doc_iden']."?".$row['email']."?".$row['telefono']."?".$row['lider']."?".$row['codlider']."?".$row['tipoprov']."?".$row['email']."?".$row['responsable']."?".$row['condicion']."?".$row['contacto']."?".$row['cargo']."?";
			
			echo $cadena;
		break;
		
		case "saveTexto":
		
			$cod=$_REQUEST['pos'];
			$valor=$_REQUEST['valor'];
			
			foreach ($_SESSION['productos'][20] as $subkey=> $subvalue) {
				 
				if($subvalue==$cod){
				$_SESSION['productos'][13][$subkey]=$valor;

				}
			}
			
			echo $cod." ".$valor;
			
		break;
			 
	case  "anexo_datos": 
		//echo $_REQUEST['campo'];
		
		$strSQL="select * from producto where cod_prod='".$_REQUEST['campo']."'  ";
		$resultado=mysql_query($strSQL,$cn);
		$rowR=mysql_fetch_array($resultado);   
		echo $rowR['idproducto'].'|';
		echo $rowR['cod_prod'].'|';
		echo $rowR['nombre'].'|';
		echo $rowR['clasificacion'].'|';
		echo $rowR['categoria'].'|';
		echo $rowR['subcategoria'].'|';
		echo $rowR['und'].'|';
		echo $rowR['costo_inven1'].'|';
		
	break;
	case  "aprobar_improtacion": 
	 //echo  $numero.'--'.$auxiliar;
	 //act doc de importcion
	 $strSQL5="update det_mov set flag_kardex='1' where cod_cab='$numero' ";
	mysql_query($strSQL5,$cn);
	
	$strSQL5="update cab_mov set kardex='S' where cod_cab='$numero' ";
	mysql_query($strSQL5,$cn);
	//act kardex
	
	$strSQL="select * from det_mov where cod_cab='$numero'  ";
	$resultado=mysql_query($strSQL,$cn);
		  while($rowR=mysql_fetch_array($resultado)){
		  		$cod_p=$rowR['cod_prod'];
				$cant_p=$rowR['cantidad'];
				$tienda=$rowR['tienda'];				
				$campo="saldo".$tienda;
				
		  		$strSQLX="update producto set $campo=$campo+'$cant_p' 
				where idproducto='$cod_p' and kardex='S' ";
				mysql_query($strSQLX,$cn);	  
		  }
	
	break;	
	
	
	case  "verificarStock": 
	
	
	$camposaldo="saldo".$_REQUEST['tienda'];
	foreach ($_SESSION['productos3'][0] as $subkey=> $subvalue) {
		 	 		  		   		
		  $strSQL4="select * from producto where idproducto='".$subvalue."' ";
		  $resultado4=mysql_query($strSQL4,$cn);
		  $row4=mysql_fetch_array($resultado4);
		
  			if($_SESSION['productos3'][1][$subkey] > $row4[$camposaldo]){
			echo $row4['idproducto']."|".$row4[$camposaldo]."|".$row4['nombre'];
			die();
			}
	
	}
	break;	
	
	
	case  "verificarStock2":
	 
	      $camposaldo="saldo".$_REQUEST['tienda'];
		  
		  
	      $strSQL41="select * from det_mov where cod_cab='".$_REQUEST['codcab']."' ";
		  $resultado41=mysql_query($strSQL41,$cn);
	while($row41=mysql_fetch_array($resultado41)){
			 	 		  		   		
		  $strSQL4="select * from producto where idproducto='".$row41['cod_prod']."' ";
		  $resultado4=mysql_query($strSQL4,$cn);
		  $row4=mysql_fetch_array($resultado4);
		
  			if($row41['cantidad'] > $row4[$camposaldo]){
			echo $row4['idproducto']."|".$row4[$camposaldo]."|".$row4['nombre'];
			die();
			}
	
	}
	
	break;	
	
	case  "reporte_stock_PV":
	
	
	
	echo "
	<table width='550' height='137' border='0' cellpadding='0' cellspacing='0' bgcolor='#FFFFFF' style='border:#000000 solid 1px'>
    <tr>
      <td height='26' colspan='3' bgcolor='#CCCCCC'><span class='Estilo114 Estilo115'><strong>Control de Stock </strong></span></td>
      </tr>
    <tr>
      <td width='17'>&nbsp;</td>
      <td width='470'>&nbsp;</td>
      <td width='11'>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
	  
	  <table width='520' height='80' border='0'>
        <tr>
          <td width='250' height='23' bgcolor='#0099FF'><span class='Estilo114 Estilo32'>Producto</span></td>
		  <td width='30' height='23' bgcolor='#0099FF'><span class='Estilo114 Estilo32'>Und</span></td>
          <td width='75' bgcolor='#0099FF'><span class='Estilo114 Estilo32'>Cant Pedido </span></td>
          <td width='75' bgcolor='#0099FF'><span class='Estilo114 Estilo32'>Stock Actual </span></td>
          <td width='93' bgcolor='#0099FF'><span class='Estilo114 Estilo32'>Saldo Pendiente </span></td>
        </tr>
		
		";
		
		foreach ($_SESSION['productos3'][0] as $subkey=> $subvalue) {
		 
	 		  		   		
		  $strSQL4="select * from producto where idproducto='".$subvalue."' ";
		  $resultado4=mysql_query($strSQL4,$cn);
		  
		  $total_kardex='N';
		  
			  
		while($row4=mysql_fetch_array($resultado4)){
		
		$nombre=$row4['nombre'];
		$stock=$row4['saldo101'];
		$und=$row4['und'];
		$factor=$row4['factor'];
		
		
		 if ($und!=$_SESSION['productos3'][4][$subkey]){
			//$salidas=19;
			//echo "dg";
				$strSQL_unid="select * from unixprod where producto='".$idproducto."' and unidad='".$_SESSION['productos3'][4][$subkey]."'";
				$resultado_unid=mysql_query($strSQL_unid,$cn);
				$row_unid=mysql_fetch_array($resultado_unid);
				$factor_subund=$row_unid['factor'];
			//echo $factor_subund;
				 $salidas=$stock;
				if ($factor_subund<>""){
							if ($row_unid['mconv']=='P'){
							//procentual
								//$salidas=$salidas*($factor/$factor_subund);
								$salidas=$salidas*$factor_subund;
							}else{
							//echo "dddd";
							/*
								$FacSbU = explode('.',$factor_subund);
								$SuT1=$salidas*$FacSbU[0];	//5*1 - 5 
								$SuT2=$salidas*$FacSbU[1];	//5*3 -	15			
								echo $SuT2;
								$CatSu = explode('.',number_format($SuT2/$factor,3,'.','.'));
							*/	//echo $factor;
								/*
								//$CatSu = explode('.',$SuT2/$factor); //15/12 - 1.25						
								$SuT1=$SuT1+$CatSu[0]; //5+1 - 6
								$SuT2=($CatSu[1]*$factor)/100; // (25*12)/100 - 3
								$SuT2= number_format($SuT2,0,'','');			
								$salidas=$SuT1.'.'.$SuT2 ; //6.3
								*/
								//echo "$SuT2/$factor_subund";
								$salidas=$salidas/$factor_subund;
							}						
				}
				
				$stock=$salidas;
			}
		
		
		$saldo=$_SESSION['productos3'][1][$subkey]-$stock;
		
		//if($saldo<=0)$saldo=$_SESSION['productos3'][1][$subkey];
		if($stock<=0)$saldo=$_SESSION['productos3'][1][$subkey];
		
		if($saldo>0){
		$colorRow="#FF7777";
		$colortext="#FFFFFF";
		}else{
		 $colorRow="#F2F2F2";
		 $saldo=0;
		 $colortext="#000000";
		}
		
		 list($undDesc)=mysql_fetch_row(mysql_query("select nombre from unidades where id='".$_SESSION['productos3'][4][$subkey]."'"));
		
		echo "
        <tr bgcolor='".$colorRow."' >
          <td style='color:$colortext'>$nombre</td>
		  <td style='color:$colortext'>$undDesc</td>
          <td align='center' style='color:$colortext'>".$_SESSION['productos3'][1][$subkey]."</td>
          <td align='center' style='color:$colortext'>$stock</td>
          <td align='center' style='color:$colortext'>$saldo</td>
        </tr>
		";
		
		}
		
		}
		
		echo "
		
		<tr>
          <td colspan='4'>&nbsp</td>
          
          </tr>
         <tr>
          <td colspan='4'><input type='button' name='Submit6' value='Aceptar' onClick='aceptar_reporteStock()'>
            <input type='button' name='Submit7' value='Cancelar' onClick='rechazar_reporteStock()'></td>
          </tr>
		  
      </table></td>
      <td>&nbsp;</td>
    </tr>
  </table>
	
	";	
	break;
	
	
	case  "reporte_stock_PV2":
	
	
	
	echo "
	<table width='550' height='137' border='0' cellpadding='0' cellspacing='0' bgcolor='#FFFFFF' style='border:#000000 solid 1px'>
    <tr>
      <td height='26' colspan='3'>
	  
	  
	  <table width='100%' height='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='54' style='background:url(imagenes/img_panelbox/top_logo.gif) repeat-x scroll 0 0 transparent'>&nbsp;</td>
        <td width='456' style='background:url(imagenes/img_panelbox/top_m.gif) repeat-x scroll 0 0 transparent; '><table width='455' border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td   style='color:#FFFFFF; font:bold'><span >Control de Stock </span>
              <input name='tope' type='hidden' value='A' ></td>
            <td width='20' align='right' style='cursor:pointer' onClick='window.close()'><span  style='color:#FFFFFF; font:bold'>x</span></td>
          </tr>
        </table></td>
        <td width='6' style='background:url(imagenes/img_panelbox/top_r.gif) repeat-x scroll 0 0 transparent'></td>
      </tr>
    </table>
	  
	  
	  </td>
      </tr>
    <tr>
      <td width='17'>&nbsp;</td>
      <td width='470'>&nbsp;</td>
      <td width='11'>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
	  
	  <table width='520' height='80' border='0'>
        <tr>
          <td width='250' height='23' bgcolor='#0099FF'><span  style='color:#FFFFFF; font:bold'>Producto</span></td>
		  <td height='23' bgcolor='#0099FF'><span  style='color:#FFFFFF; font:bold'>Und</span></td>
          <td width='75' bgcolor='#0099FF'><span style='color:#FFFFFF; font:bold' aling='center'>Cant. Pedido </span></td>
		  <td width='75' bgcolor='#0099FF'><span style='color:#FFFFFF; font:bold'>Cant. Entregado </span></td>
		   <td width='75' bgcolor='#0099FF'><span style='color:#FFFFFF; font:bold'>Cant. Pendiente </span></td>
          <td width='75' bgcolor='#0099FF'><span style='color:#FFFFFF; font:bold'>Stock Actual </span></td>
          <td width='93' bgcolor='#0099FF'><span style='color:#FFFFFF; font:bold'>Cant. a Facturar </span></td>
        </tr>
		
		";
		
		foreach ($_SESSION['productos3'][0] as $subkey=> $subvalue) {
		 
	 		  		   		
		  $strSQL4="select * from producto where idproducto='".$subvalue."' ";
		  $resultado4=mysql_query($strSQL4,$cn);
		  
		  $total_kardex='N';
			  
		while($row4=mysql_fetch_array($resultado4)){
		
		$nombre=$row4['nombre'];
		$stock=$row4['saldo101'];
		$idproducto=$row4['idproducto'];
		$und=$row4['und'];
		$factor=$row4['factor'];
		
		  if ($und!=$_SESSION['productos3'][4][$subkey]){
			//$salidas=19;
			//echo "dg";
				$strSQL_unid="select * from unixprod where producto='".$idproducto."' and unidad='".$_SESSION['productos3'][4][$subkey]."'";
				$resultado_unid=mysql_query($strSQL_unid,$cn);
				$row_unid=mysql_fetch_array($resultado_unid);
				$factor_subund=$row_unid['factor'];
			//echo $factor_subund;
				 $salidas=$stock;
				if ($factor_subund<>""){
							if ($row_unid['mconv']=='P'){
							//procentual
								//$salidas=$salidas*($factor/$factor_subund);
								$salidas=$salidas*$factor_subund;
							}else{
							//echo "dddd";
							/*
								$FacSbU = explode('.',$factor_subund);
								$SuT1=$salidas*$FacSbU[0];	//5*1 - 5 
								$SuT2=$salidas*$FacSbU[1];	//5*3 -	15			
								echo $SuT2;
								$CatSu = explode('.',number_format($SuT2/$factor,3,'.','.'));
							*/	//echo $factor;
								/*
								//$CatSu = explode('.',$SuT2/$factor); //15/12 - 1.25						
								$SuT1=$SuT1+$CatSu[0]; //5+1 - 6
								$SuT2=($CatSu[1]*$factor)/100; // (25*12)/100 - 3
								$SuT2= number_format($SuT2,0,'','');			
								$salidas=$SuT1.'.'.$SuT2 ; //6.3
								*/
								//echo "$SuT2/$factor_subund";
								$salidas=$salidas/$factor_subund;
							}						
				}
				
				$stock=$salidas;
			}
		
		
		 list($undDesc)=mysql_fetch_row(mysql_query("select nombre from unidades where id='".$_SESSION['productos3'][4][$subkey]."'"));
		
		
		
		
		$saldo=$_SESSION['productos3'][1][$subkey]-$stock;
		//if($saldo<=0)$saldo=$_SESSION['productos3'][1][$subkey];
		if($stock<=0)$saldo=$_SESSION['productos3'][1][$subkey];
		
		if($saldo>0){
		/*
		$colorRow="#FF7777";
		$colortext="#FFFFFF";
		*/
		$colorRow="#F2F2F2";
		// $saldo=0;
		 $colortext="#000000";
		}else{
		
		 $colorRow="#F2F2F2";
		 $saldo=0;
		 $colortext="#000000";
		}
		
		if($stock<=0){
		$cantFact=0;
		}else{
		$cantFact=$_SESSION['productos3'][1][$subkey];
		}
		//if($stock>=$_SESSION['productos3'][1][$subkey])$cantFact=$_SESSION['productos3'][1][$subkey];
		
		 list($cantdesp)=mysql_fetch_row(mysql_query("select cantdesp from det_mov where cod_cab='".$_SESSION['productos3'][6][$subkey]."' and cod_prod='".$subvalue."'"));
	//	echo "select cantdesp from det_mov where cod_cab='".$_SESSION['productos3'][6][$subkey]."' and cod_prod='".$subvalue."'";
	
		$cantFact=$cantFact-$cantdesp;
		$cantpendiente=$_SESSION['productos3'][1][$subkey]-$cantdesp;
		echo "
        <tr bgcolor='".$colorRow."' >
          <td style='color:$colortext'>$nombre
		   <input name='codFact'  type='hidden' id='codFact' size='10' maxlength='7'  value='$idproducto' />
		  </td>
		  
		  <td style='color:$colortext'>$undDesc</td>
		  
          <td align='center' style='color:$colortext'>".$_SESSION['productos3'][1][$subkey]."
		  <input name='cantped'  type='hidden' id='cantped' size='10' maxlength='7'  value='".$_SESSION['productos3'][1][$subkey]."' />
		  </td>
		  <td align='center' style='color:$colortext'>
		  <input name='cantdesp'  type='hidden' id='cantdesp' size='10' maxlength='7'  value='$cantdesp' />
		  $cantdesp</td>
		  
		   <td align='center' style='color:$colortext'>$cantpendiente</td>
		  
          <td align='center' style='color:$colortext'>$stock
		  <input name='cantstock'  type='hidden' id='cantstock' size='10' maxlength='7'  value='$stock' />
		  </td>
		  
          <td align='center' style='color:$colortext'>
		   <input name='cantFact'  type='text' id='cantFact' size='10' maxlength='7' style='text-align:right'  value='$cantFact' onblur='validarCantFact(this)'/>
		  </td>
        </tr>";
		
		}
		
		}
		
		echo "
		
		<tr>
          <td colspan='4'>&nbsp</td>
          
          </tr>
         <tr>
          <td colspan='4'><input type='button' name='Submit6' value='Aceptar' onClick='aceptar_cantFact()'>
            <input type='button' name='Submit7' value='Cancelar' onClick='window.close()'></td>
          </tr>
		  
      </table></td>
      <td>&nbsp;</td>
    </tr>
  </table>
	
	";	
	break;
	
	
	case "save_cantFact":
	
	$total_doc=0;
	$acumCant=explode("|",$_REQUEST['acumCant']);
	$acumCod=explode("|",$_REQUEST['acumCod']);
	
	for($i=1;$i<count($acumCant);$i++){
	
		foreach ($_SESSION['productos3'][0] as $subkey=> $subvalue) {
							
				if($subvalue==$acumCod[$i]){
				
				$_SESSION['productos3'][1][$subkey] = $acumCant[$i];
				$total_doc=$total_doc+$_SESSION['productos3'][1][$subkey]*$_SESSION['productos3'][2][$subkey];
				}
		}
	
	}
	echo $total_doc;
	//echo $_SESSION['productos3'][2][$subkey]*
	//echo print_r($_SESSION['productos3'][1]);
	//echo print_r($_SESSION['productos3'][0]);	
	
	
	break;
	
	case "changePrice":
	
	$posicion=$_REQUEST['posicion'];
	$newPrecio=	$_REQUEST['newPrecio'];
	
	foreach ($_SESSION['productos3'][20] as $subkey=> $subvalue) {							
				if($subvalue==$posicion){				
				$_SESSION['productos3'][2][$subkey] = $newPrecio;				
				}
	}	
	break;
	
	
	case "controlOT":
		$sucursal=$_REQUEST['sucursal'];	
		$serieOT=$_REQUEST['serieOT'];	
		$numeroOT=$_REQUEST['numeroOT'];
		
		$strSQL="select * from cab_mov where sucursal='".$sucursal."' and serie='".$serieOT."' and Num_doc='".$numeroOT."' and cod_ope='OT' and tipo='2'";
		$resultado=mysql_query($strSQL);	
		$cont=mysql_num_rows($resultado);
		
		echo $cont;
	
	break;
	
	
	case "docsRepPercep";
	
	
				$data="<table  id='tblIn' border='0' cellspacing='1' cellpadding='1'>
                    <tr>
                      <td width='32' align='center' bgcolor='#0066CC'><span class='Estilo24'>ok</span></td>
                      <td width='38' align='center' bgcolor='#0066CC'><span class='Estilo24'>CD</span></td>
                      <td width='194' bgcolor='#0066CC'><span class='Estilo25'>Descripcion</span></td>
                    </tr>";
									
					$strSQl="select * from operacion where tipo='".$_REQUEST['aplicacion']."' order by descripcion";
					$resultado=mysql_query($strSQl,$cn);
					while($row=mysql_fetch_array($resultado)){
						
					
					$data.="<tr>
                      <td height='20' align='center' bgcolor='#F5F5F5'>
                      <input name='chkIngresos[]' id='Ingresos' type='checkbox' style='background:none; border:none' value='".$row['codigo']."' $marcar />                      </td>
                      <td align='center' bgcolor='#F5F5F5'><span class='Estilo27'>".$row['codigo']."</span></td>
                      <td bgcolor='#F5F5F5'><span class='Estilo27'>".$row['descripcion']."</span></td></tr>";
				 	}
				 
					 $data.="</table>";
	
					echo $data;
	break;
	
	
	case "Lotes_Salida_dispo":
	

		$tienda=$_REQUEST['tienda'];
		$producto=$_REQUEST['producto'];
		
		
		echo"<table width='439' border='0' cellpadding='0' cellspacing='0'>";         
			
			$strSQLLOt="select * from lotes_cons where existencia!=0 and tienda='".$tienda."' and producto='".$producto."'";
		//	$strSQLLOt="select * from lotes_cons where existencia!=0 and tienda='".$tienda."' ";
			$resultadoLot=mysql_query($strSQLLOt,$cn);
			//echo $strSQLLOt;
			while($rowLot=mysql_fetch_array($resultadoLot)){	
			
				list($costo)=mysql_fetch_row(mysql_query("select costo from lotes where producto='".$rowLot['producto']."' and des_lote='".$rowLot['des_lote']."' "));		 
			
            echo "<tr onClick='entradae2(this)' style='background:#ffffff'; ><td width='52' align='center'><input style='background:none; border:none' type='checkbox' name='checkboxLoteV' id='checkboxLoteV' onclick='this.checked=false' value='".$rowLot['id']."|".$rowLot['existencia']."'>
				</td>
                <td width='137' align='center'>".$rowLot['des_lote']."</td>
                <td width='113' align='center'> ".$rowLot['venc_lote']."</td>
                <td width='80' align='center'>".$rowLot['existencia']."</td>
				<td width='80' align='center'>".$costo."</td></tr>";
				            
				}			   
                 echo "<tr style='visibility=hidden'><td width='52' align='center'><input style='background:none; border:none; ' type='checkbox' name='checkboxLoteV' id='checkboxLoteV' onclick='' value=''>
				</td>
                <td width='157' align='center'></td>
                <td width='133' align='center'></td>
                <td align='center'></td>
				<td align='center'></td></tr>"
				; 				 
            echo"</table>";
			
	break;
	
	case "arrayLotesVentas":
	
	$producto=$_REQUEST['producto'];
	$codLote=explode("|",$_REQUEST['codLote']);
	$cantxLote=explode("|",$_REQUEST['cantxLote']);
	
	foreach ($codLote as $subkey=> $subvalue) {	
		if($subvalue!=''){
		$_SESSION['lotes'][0][$subkey]=$subvalue;
		$_SESSION['lotes'][1][$subkey]=$cantxLote[$subkey];
		$_SESSION['lotes'][2][$subkey]=$producto;
		}
	
	}
	
	//print_r($_SESSION['lotes'][1]);
	
	
	break;
	
	case "BucarCorrLote":
	
	$producto=$_REQUEST['producto'];
	
	//list($swicthpuntos,$cantpuntos)=mysql_fetch_row(mysql_query("select puntos,cantpuntos from categoria where idCategoria='".$idcategoria."'"));
	 
	
	$strSQL="select * from lotes where producto='".$producto."' order by id desc limit 1";
	$resultado=mysql_query($strSQL,$cn);
	$row=mysql_fetch_array($resultado);
	
	$LoteCorre=substr($row['des_lote'],3,3);
	$LoteCorre=str_pad($LoteCorre+1,3,"0",STR_PAD_LEFT);
		 
	echo $LoteCorre;
	
	break;	
	
			
} 

	
function calc_costo_inv($codigo_producto,$fecha_emi,$importe_sin_igv,$cantidad,$campo_tie,$campo_suc){

				include('../conex_inicial.php');
				/*
				 $strSQL_sal="select saldo_actual,costo_inven from det_mov where cod_prod='".$codigo_producto."' and costo_inven!=0  and  date(fechad) <= date('".$fecha_emi."') order by fechad desc, cod_det desc limit 1";
				 $resultado_sal=mysql_query($strSQL_sal,$cn);
				 $row_sal=mysql_fetch_array($resultado_sal);		 
				 $cont=mysql_num_rows($resultado_sal);
				// $costo_inv_ant=$row_sal['costo_inven']; 
				// $saldo_ant=$row_sal['saldo_actual']; 
				*/
				// if($cont==0){
				 $costo_inv_ant=0; 
				 $saldo_ant=0;
				 //}
				 
 				 $strSQL_sal2="select $campo_tie,$campo_suc from producto where idproducto='".$codigo_producto."'";
				 $resultado_sal2=mysql_query($strSQL_sal2,$cn);
				 $row_sal2=mysql_fetch_array($resultado_sal2);
				 $saldo_ant=$row_sal2[$campo_tie];
				 $costo_inv_ant=$row_sal2[$campo_suc]; 
						
				 if($saldo_ant >= 0 && $cantidad > 0){
				 $costo_inv=(($saldo_ant*$costo_inv_ant)+($importe_sin_igv))/($saldo_ant + $cantidad);
				 }
				 //return $costo_inv;
				// return  $strSQL_sal2;							
				//"(($saldo_ant*$costo_inv_ant)+($importe_sin_igv))/($saldo_ant + $cantidad)";
				return number_format($costo_inv,4,'.','');
				//saldo actual * precio/1.19
	}

	function calc_costo_inv_tranf($codigo_producto,$fecha_emi,$importe_sin_igv,$cantidad,$campo_tie,$campo_suc){
	
				include('../conex_inicial.php');
					
				$strSQL_sal="select saldo_actual,costo_inven from det_mov d,cab_mov c where cod_prod='".$codigo_producto."' and costo_inven!=0  and  date(fechad) <= date('".$fecha_emi."') and c.cod_cab=d.cod_cab and  c.tienda='$campo_tie' and c.sucursal='$campo_suc' order by fechad desc, cod_det desc limit 1";
				 $resultado_sal=mysql_query($strSQL_sal,$cn);
				 $row_sal=mysql_fetch_array($resultado_sal);		 
				 $cont=mysql_num_rows($resultado_sal);
				 $costo_inv_ant=$row_sal['costo_inven']; 
				 $saldo_ant=$row_sal['saldo_actual']; 
				 				 			  								 
				if($cont==0){
					$costo_inv_ant=0; 
					$saldo_ant=0;
				}
				 
				 $costo_inv=(($saldo_ant*$costo_inv_ant)+($importe_sin_igv))/($saldo_ant + $cantidad);
			//	 return $strSQL_sal;//milagros990986699
			//	 return "(($saldo_ant*$costo_inv_ant)+($importe_sin_igv))/($saldo_ant + $cantidad)";
				 return number_format($costo_inv,4,'.','');
			//	 saldo actual * precio/1.19
														
	}
	
	
	function buscar_series($producto,$serie,$tienda){
	
		include('../conex_inicial.php');
		$registros=0;
			
		$strSQL="select * from series where tienda='".$tienda."' and producto='".$producto."' and serie='".$serie."' and salida='0' ";			
		$resultado=mysql_query($strSQL,$cn);
		$registros=mysql_num_rows($resultado);
		
		return $registros;
			
	
	}	
	
	
function verificar_totales(){

	include('../conex_inicial.php');
	
	foreach ($_SESSION['productos3'][0] as $subkey=> $subvalue) {	
	   if($subvalue!=""){	 
		 $strSQL4="select * from producto where idproducto='".$subvalue."' ";
		 $resultado4=mysql_query($strSQL4,$cn);
		  while($row4=mysql_fetch_array($resultado4)){  
			
		  $items++;
		  $manejaserie=$row4['series'];
		  $percepcion=$row4['agente_percep'];
		  $valor_percep=$row4['valor_percep'];
		  $oferta=$row4['oferta'];
		  $idcategoria=$row4['categoria'];
		  $factorCant=$row4['factor'];		  
		  $stockItem=$row4[$saldoTienda];
		  
		  list($swicthpuntos,$cantpuntos)=mysql_fetch_row(mysql_query("select puntos,cantpuntos from categoria where idCategoria='".$idcategoria."'"));
		  ?><?php
		  
		  $k++;
			if($row4['igv']=='N'){
			$total_inafecto=$total_inafecto+$_SESSION['productos3'][1][$subkey] * $_SESSION['productos3'][2][$subkey] ;
			if($percep_suc=='S'){
					if($percep_doc=='S'){
			
						if($est_percep_clie!=0){
						$valor_percep=$por_percep_clie;
						}
							if($percepcion=='S'){
							$total_percepcion=$total_percepcion + ($total_inafecto*$valor_percep/100);
							$total_percepcion_2=$total_percepcion_2 + ($total_inafecto);						
							}
											
					}			
				}
			
				
			}else{			
			 $totalitem=$_SESSION['productos3'][1][$subkey] * $_SESSION['productos3'][2][$subkey] ;			 $xtotalitem=$_SESSION['productos3'][1][$subkey] * $_SESSION['productos3'][2][$subkey] ;
			 $valventa=$valventa + $_SESSION['productos3'][1][$subkey] * $_SESSION['productos3'][2][$subkey] ;
			 if($tipoDescDoc=='P'){
				 $tempDesc1=$totalitem*($_SESSION['productos'][21][$subkey]/100);
				 $tempDesc2=($totalitem-$tempDesc1)*($_SESSION['productos'][22][$subkey]/100);
			 }else{
				 $tempDesc1=$_SESSION['productos'][21][$subkey];
				 $tempDesc2=0;		 
			 }
			 if($tipoDescDoc=='P'){		 
				 $totalitem=$totalitem-($totalitem*($_SESSION['productos'][21][$subkey]/100));
				 $totalitem=$totalitem-($totalitem*($_SESSION['productos'][22][$subkey]/100));
			 }else{
				$totalitem=$totalitem-$_SESSION['productos'][21][$subkey];				
			 }
			 $total=$total + number_format($totalitem,2,'.','');
			 
			 $totalitem2=$_SESSION['productos'][1][$subkey] * $_SESSION['productos'][2][$subkey] ;
			 if($tipoDescDoc=='P'){
				 $totalitem2=$totalitem2-($totalitem2*($_SESSION['productos'][21][$subkey]/100));
				 $totalitem2=$totalitem2-($totalitem2*($_SESSION['productos'][22][$subkey]/100));
			 }else{
				 $totalitem2=$totalitem2-$_SESSION['productos'][21][$subkey];
			 }
			 $total2=$total2 + number_format($totalitem2,2,'.','');
			 
			 if($percep_suc=='S'){
						if($percep_doc=='S'){
					//echo "dg $totalitem $valor_percep";
							if($est_percep_clie!=0){
							$valor_percep=$por_percep_clie;
							}
								if($percepcion=='S'){
								$total_percepcion=$total_percepcion + ($totalitem*$valor_percep/100);
								$total_percepcion_2=$total_percepcion_2 + ($totalitem);			
								}
								}
								}
								}
					
				if($accion=="mostrarprod"){					
					if($estado=="A"){
						$verestado="ANULADO";
						}else{
							if(isset($_REQUEST['cargar_ref'])){
							$verestado="INGRESO";
							
								if($permiso27=='S'){			
									if($swicthpuntos=='C'){
									$totPuntos=$totPuntos+floor($_SESSION['productos3'][1][$subkey])*$cantpuntos;
									$_SESSION['productos3'][23][$subkey]=floor($_SESSION['productos3'][1][$subkey])*$cantpuntos;
									$_SESSION['productos2'][23][$subkey]=floor($_SESSION['productos3'][1][$subkey])*$cantpuntos;
									$_SESSION['productos'][23][$subkey]=floor($_SESSION['productos3'][1][$subkey])*$cantpuntos;
									}else{
									$totPuntos=$totPuntos+($xtotalitem)*$cantpuntos;
									$_SESSION['productos3'][23][$subkey]=($xtotalitem)*$cantpuntos;
									$_SESSION['productos2'][23][$subkey]=($xtotalitem)*$cantpuntos;
									$_SESSION['productos'][23][$subkey]=($xtotalitem)*$cantpuntos;
									}
																			
								}else{
									 $_SESSION['productos3'][23][$subkey]=0;
									 $_SESSION['productos2'][23][$subkey]=0;
									 $_SESSION['productos'][23][$subkey]=0;
								}
							
													
							}else{		
							$verestado="CONSULTA";	
						///----------------------------------------------------------								
								if($permiso27=='S'){			
									//if($swicthpuntos=='C'){									//$totPuntos=$totPuntos+floor($_SESSION['productos3'][1][$subkey])*$cantpuntos;
									$totPuntos=$totPuntos+$_SESSION['productos3'][23][$subkey];
									//}else{									
									
									//}
								}else{						
																								
								}
						//---------------------------------------------------------------					
							}
						}
				}else{
					$verestado="INGRESO";			
					
						if($permiso27=='S'){			
							if($swicthpuntos=='C'){
							$totPuntos=$totPuntos+floor($_SESSION['productos3'][1][$subkey])*$cantpuntos;
							$_SESSION['productos3'][23][$subkey]=floor($_SESSION['productos3'][1][$subkey])*$cantpuntos;
							$_SESSION['productos2'][23][$subkey]=floor($_SESSION['productos3'][1][$subkey])*$cantpuntos;
							$_SESSION['productos'][23][$subkey]=floor($_SESSION['productos3'][1][$subkey])*$cantpuntos;
							}else{
							$totPuntos=$totPuntos+($xtotalitem)*$cantpuntos;
							$_SESSION['productos3'][23][$subkey]=($xtotalitem)*$cantpuntos;
							$_SESSION['productos2'][23][$subkey]=($xtotalitem)*$cantpuntos;
							$_SESSION['productos'][23][$subkey]=($xtotalitem)*$cantpuntos;
							}
																	
						}else{
							 $_SESSION['productos3'][23][$subkey]=0;
							 $_SESSION['productos2'][23][$subkey]=0;
							 $_SESSION['productos'][23][$subkey]=0;
						}
				}
				if($oferta=='S' && $tipomov==2 && $aplicaBon=='S'){
				 
					   if($verestado=="INGRESO"){
					   if($_SESSION['busqOferta']=='C'){
						
						$filtro1=" and o.cod_prod='".$row4['clasificacion'].$row4['categoria']."' ";
						$filtro2=" and o.monto <='".$_SESSION['productos3'][1][$subkey]*$_SESSION['productos3'][2][$subkey]."' ";
						$campo1_o=" o.monto as cantOferta ";
						}else{
						$campo1_o=" o.cantidad as cantOferta ";
						$filtro1=" and o.cod_prod='".$row4['idproducto']."' ";
						$filtro2=" and o.cantidad <='".$_SESSION['productos3'][1][$subkey]."' ";
						}
						
											
				 $strSQLOferta="select $campo1_o,d.cantidad as cantBoni ,d.cod_prod as codprodBoni,o.cod_prod as codprodOferta,d.unidad as undBoni,d.nom_prod as nombreBoni,o.cod_ofe as codOferta from oferta o,oferta_det d where o.cod_ofe=d.cod_ofe ".$filtro1.$filtro2." and '".extraefecha($fechad)."' between substring(o.fecha_ini,1,10) and substring(o.fecha_fin,1,10) and (o.condicion='".$condicion."' || o.condicion=0) order by o.cantidad desc ";
						  
						 //echo $strSQLOferta;
						  $resultadoOferta=mysql_query($strSQLOferta);
							$temp="";
							$i=0;
							while($rowOferta=mysql_fetch_array($resultadoOferta)){
							 
							 
							 if($temp!=$rowOferta['codOferta'] && $i>0){
							 continue;
							 }
							 
							 $temp=$rowOferta['codOferta'];
							 $i++;
													 
														 
							 $tempCant=explode(".",$_SESSION['productos3'][1][$subkey]*$_SESSION['productos3'][2][$subkey] / $rowOferta['cantOferta']);
						 
							 $cantBoni=$tempCant[0]*$rowOferta['cantBoni'];	
							 $strSQL_subuni="select * from unidades where id='".$rowOferta['undBoni']."'";
			 
							  $resultado=mysql_query($strSQL_subuni,$cn); 
							  $row=mysql_fetch_array($resultado);
							  $unidOferta=$row['nombre'];
							  
							  $_SESSION['boni'][0][]=$rowOferta['codprodBoni'];
							  $_SESSION['boni'][1][]=$rowOferta['nombreBoni'];
							  $_SESSION['boni'][2][]=$rowOferta['undBoni'];
							  $_SESSION['boni'][3][]=$cantBoni;
							  $_SESSION['boni'][4][]=$rowOferta['codprodOferta'];
											
							}
							mysql_free_result($resultadoOferta);
							}else{}
					}
			}
			mysql_free_result($resultado4);
		}else{
		
		$tempTexto=$_SESSION['productos3'][20][$subkey];		  			 
			 
			 $totalitem=$_SESSION['productos3'][1][$subkey] * $_SESSION['productos3'][2][$subkey] ;
			 $total=$total + $totalitem;
			 //echo $totalitem."<br>";
			 $totalitem2=$_SESSION['productos'][1][$subkey] * $_SESSION['productos'][2][$subkey] ;
			 $total2=$total2 + $totalitem2;		 			 
		}
		  
	}	
	
	  if($tmoneda==02){
	  $total_percepcion_temp=$total_percepcion_2*$tc;
	  }else{
	  $total_percepcion_temp=$total_percepcion_2;
	  }
	
	  if($total_percepcion_temp < $min_percep_doc){
	  $total_percepcion=0;
	  }
	  
	  if(isset($_REQUEST['percep_recp'])){
	  $total_percepcion=$_REQUEST['percep_recp'];
	  }
	 
	  $total=number_format($total,2,".","");
  
  	  $valor_impto=$_REQUEST['impto']+1;
	
	 if($_REQUEST['incluidoigv']=='S'){ 
	 //echo "(  Incl.Impstos )";
	  $total=$total+$_SESSION['montoFlete'];
	  $monto=$total/$valor_impto+$total_inafecto;
	  $impuesto=($total+$total_inafecto)-$monto;
	  $total=$monto+$impuesto;
	  //$total=$monto+$impuesto+$total_percepcion;
	  //echo "$total/$valor_impto+$total_inafecto";
	  $monto2=$total2/$valor_impto+$total_inafecto;
	  $impuesto2=($total2+$total_inafecto)-$monto2;
	  //$total2=$monto2+$impuesto2+$total_percepcion;
	  $total2=$monto2+$impuesto2;
		
	 }else{
	 //echo "(  NO Incl.Impstos )"; 
	  $total=$total+$_SESSION['montoFlete'];
	  $monto=$total+$total_inafecto;
	  $impuesto=$_REQUEST['impto']*($total);
	  //$total=$monto+$impuesto+$total_percepcion;
	  $total=$monto+$impuesto;
	  
	  $monto2=$total2+$total_inafecto;
	  $impuesto2=$_REQUEST['impto']*($total2);
	  //$total2=$monto2+$impuesto2+$total_percepcion;
	  $total2=$monto2+$impuesto2;
	   
	 }
 
	  if($permiso4=='S'){
	  $doc_infecto=" style='visibility:hidden' ";
	  $incluidoigv='N';
	  
	  $monto=$total;
	  $impuesto=0.00;
	  $total=$monto+$impuesto;
	  
	  $monto2=$total2;
	  $impuesto2=0.00;
	  $total2=$monto2+$impuesto2;
		
	  }
	  
	  return $total;
		
}
	

mysql_close($cn);?>
