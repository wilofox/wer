<?php
session_start();
include('conex_inicial.php');
include("funciones/funciones.php");

$ruta_imagen='imgenes/icon5.gif';
if(isset($_REQUEST['det_ref_cli'])){
	if($_REQUEST['accion']=='quitar'){
				
		$cod=$_REQUEST['cod'];
		$codigo=$_REQUEST['cod_ref'];
		$cod_clie_ref=$_REQUEST['codcliente_ref'];
		$des_clie_ref=$_REQUEST['descliente_ref'];
		//echo "d ?".$cod_clie_ref;
                					
	}else{
		if(isset($_REQUEST['sucursal'])){			
		$sucursal=$_REQUEST['sucursal'];
		}else{
			$sucursal="";
		}
		$doc=$_REQUEST['doc'];
		$serie=$_REQUEST['serie'];
		$numero=$_REQUEST['numero'];
		$cliente=$_REQUEST['cliente'];
		if(isset($_REQUEST['serie_prod'])){
			$serie_prod=$_REQUEST['serie_prod'];
		}else{
			$serie_prod=$_REQUEST['nom_prod'];
		}
		//$filtrodoc2="and (ca.cod_ope!='R1' or ca.cod_ope!='R2') and ca.flag!='A'";
		$filtrodoc2="and ca.cod_ope in (Select codigo from refope where documento='R1') and ca.flag!='A'";
		if($doc=='Todos'){
			//$filtrodoc="(ca.cod_ope!='R2' and  ca.cod_ope!='S2')";
			$filtrodoc="ca.cod_ope in (Select codigo from refope where documento='R1') and ca.flag!='A'";
		}else{
			//$filtrodoc="ca.cod_ope='$doc' and (ca.cod_ope!='R2' and  ca.cod_ope!='S2')";
			$filtrodoc="ca.cod_ope='$doc' and (ca.cod_ope in (Select codigo from refope where documento='R1') and ca.flag!='A')";
		}
		$filtronum="";
		if($serie!="" && $numero!=""){
			$filtronum="and ca.serie='$serie' and ca.Num_doc='$numero'";
		}
		if($sucursal!=""){
			$sucu="ca.sucursal='$sucursal' and ";
		}else{
			$sucu="";
		}
			if(isset($_REQUEST['serie_prod'])){
				$strSQL="select ca.* from cab_mov ca inner join det_mov dm on dm.cod_cab=ca.cod_cab inner join series se on se.producto=dm.cod_prod and se.salida=dm.cod_cab where ".$sucu.$filtrodoc." ".$filtronum." ".$filtrodoc2." and se.serie='$serie_prod' order by ca.fecha_aud desc";
			//and ca.cliente='$cliente'
			}else{
				if(isset($_REQUEST['nom_prod'])){
					$strSQL="select ca.* from cab_mov ca inner join det_mov dm on dm.cod_cab=ca.cod_cab inner join series se on se.producto=dm.cod_prod and se.salida=dm.cod_cab where ".$sucu.$filtrodoc." ".$filtronum." ".$filtrodoc2." and dm.nom_prod like '%".$serie_prod."%' order by ca.fecha_aud desc";
				}else{
					$strSQL="select ca.* from cab_mov ca where ".$sucu.$filtrodoc." ".$filtronum." ".$filtrodoc2." order by ca.fecha_aud desc";
				}
			//and cliente='$cliente'
			}
		//echo "A??????<table><tr><td>".$_REQUEST['serie_prod']."<br>".$strSQL."</tr></table>??";
		$resultado=mysql_query($strSQL,$cn);
		if(mysql_num_rows($resultado)==0){
			$temp="N2";
		}
		if($cliente!=""){
		$strSQL2="select * from cliente where codcliente='$cliente' ";
		$resultado2=mysql_query($strSQL2,$cn);
		$row2=mysql_fetch_array($resultado2);
		$des_clie_ref=$row2['razonsocial'];
		}else{
			$des_clie_ref="";
		}
		
		while($row=mysql_fetch_array($resultado)){
			$codigo=$row['cod_cab'];
			$cod_clie_ref=$row['cliente'];
			$moneda_doc=$row['moneda'];
			$impto=$row['impto1'];		
		}
	}	
    $re="<table width='474' border='0' cellpadding='1' cellspacing='1' bordercolor='#FFFFFF' bgcolor='#FFFFFF'>
        <tr  style='background:url(imagenes/bg_contentbase4.gif); background-position:100% 60%'>
          <td width='32' align='center'><span class='Estilo2 Estilo1 Estilo11'><strong>Doc</strong></span></td>
          <td width='200'><span class='Estilo2 Estilo1 Estilo11'><strong>Cliente</strong></span></td>
          <td width='117' align='center'><span class='Estilo2 Estilo1 Estilo11'><strong>Numero</strong></span></td>
          <td width='45' align='center'><span class='Estilo2 Estilo1 Estilo11'><strong>Total</strong></span></td>
          <td width='40' height='18' align='center'>&nbsp;</td>
          <td width='40'><span class='Estilo2 Estilo1 Estilo11'><strong>Ref.</strong></span></td>
        </tr>";
		if(isset($_REQUEST['serie_prod'])){
			if($cliente!=""){
				$strSQL="select ca.* from cab_mov ca inner join det_mov dm on dm.cod_cab=ca.cod_cab inner join series se on se.producto=dm.cod_prod and se.salida=dm.cod_cab where ".$sucu.$filtrodoc." ".$filtronum." and ca.flag!='A' and ca.cliente='$cliente' and se.serie='$serie_prod' and se.producto in (Select idproducto from producto where series='S')  order by ca.fecha desc";
			}else{
				$strSQL="select ca.*,se.producto as c_prod from cab_mov ca inner join det_mov dm on dm.cod_cab=ca.cod_cab inner join series se on se.producto=dm.cod_prod and se.salida=dm.cod_cab where ".$sucu.$filtrodoc." ".$filtronum." and ca.flag!='A' and se.serie='$serie_prod' and se.producto in (Select idproducto from producto where series='S')  order by ca.fecha desc";
			}
		}else{
			if(isset($_REQUEST['nom_prod'])){
				if($cliente!=""){
					$strSQL="select ca.* from cab_mov ca inner join det_mov dm on dm.cod_cab=ca.cod_cab inner join series se on se.producto=dm.cod_prod and se.salida=dm.cod_cab where ".$sucu.$filtrodoc." ".$filtronum." and ca.flag!='A' and ca.cliente='$cliente' and dm.nom_prod like '%".$serie_prod."%' order by ca.fecha desc";
				}else{
					$strSQL="select ca.* from cab_mov ca inner join det_mov dm on dm.cod_cab=ca.cod_cab inner join series se on se.producto=dm.cod_prod and se.salida=dm.cod_cab where ".$sucu.$filtrodoc." ".$filtronum." and ca.flag!='A' and dm.nom_prod like '%".$serie_prod."%' order by ca.fecha desc";
				}
			}else{
				if($cliente!=""){
					$strSQL="select ca.* from cab_mov ca where ".$sucu.$filtrodoc." ".$filtronum." and ca.flag!='A' and ca.cliente='$cliente' order by ca.fecha desc";
				}else{
					$strSQL="select ca.* from cab_mov ca where ".$sucu.$filtrodoc." ".$filtronum." and ca.flag!='A' order by ca.fecha desc";
				}
			}
		}
		//echo "A??????<table><tr><td>".$strSQL."</tr></table>??";
	$resultado=mysql_query($strSQL,$cn);
	while($row4=mysql_fetch_array($resultado)){
		//$re.="<tr><td>Select * from cliente where codcliente='".$row4['cliente']."'</tr>";
		$ccli=mysql_query("Select * from cliente where codcliente='".$row4['cliente']."'",$cn);
	 	$cliente2=mysql_fetch_array($ccli);
        $re.="<tr id='".$row4['cod_cab']."'>
          <td align='center' bgcolor='#FFFFFF' class='Estilo_det' >".$row4['cod_ope']."</td>
          <td bgcolor='#FFFFFF' class='Estilo_det' >";
		  if($des_clie_ref!=""){
		  	  $re.= $row4['cliente']."-".caracteres($des_clie_ref);
		  }else{
			  $re.= $row4['cliente']."-".caracteres($cliente2['razonsocial']);
		  }
		  $re.="</td>
          <td align='center' bgcolor='#FFFFFF' class='Estilo_det' >".$row4['serie']."-".$row4['Num_doc']." </td>
          <td align='right' bgcolor='#FFFFFF' class='Estilo_det' >".number_format($row4['total'],2)."</td>
          <td align='center' bgcolor='#FFFFFF'><a href=javascript:cargar_doc('".$row4['cod_cab']."')><img src='".$ruta_imagen."' width='14' height='14' border='0' /></a></td>
          <td align='right' bgcolor='#FFFFFF' class='Estilo_det' >".$row4['cod_cab']."&nbsp;</td>
        </tr>";
    }
	$re.="</table>"; 
	////SQL Prueba//////
	///$re=$strSQL;
	//////////
	if(mysql_num_rows($resultado)==0){
		$temp="N2";
	}
	//	echo "ddd ".$_REQUEST['cod_clie_ref'];
	echo $temp.'?'.$codigo.'?'.$cod_clie_ref.'?'.$des_clie_ref.'?'.$moneda_doc.'?'.$impto.'?'.$re;
}else{
	if(isset($_REQUEST['det_ref'])){
		if($_REQUEST['accion']=='quitar'){
			
			$cod=$_REQUEST['cod'];
			$codigo=$_REQUEST['cod_ref'];
			$cod_clie_ref=$_REQUEST['codcliente_ref'];
			$des_clie_ref=$_REQUEST['descliente_ref'];
					//echo "d ".$cod_clie_ref;
						
												
			foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
						 
				if($subvalue==$cod || $_SESSION['productos'][2][$subkey]==$cod){
					unset($_SESSION['productos'][0][$subkey]);
					unset($_SESSION['productos'][1][$subkey]); 
					unset($_SESSION['productos'][2][$subkey]);  
					unset($_SESSION['seriesprod'][0][$subkey]);
					unset($_SESSION['seriesprod'][1][$subkey]);
					unset($_SESSION['seriesprod'][2][$subkey]);
				}
		   	}
        }else{
			unset($_SESSION['productos'][0]);
			unset($_SESSION['productos'][1]); 
		    unset($_SESSION['productos'][2]);
			unset($_SESSION['seriesprod'][0]);
			unset($_SESSION['seriesprod'][1]);
			unset($_SESSION['seriesprod'][2]);
			if(isset($_REQUEST['sucural'])){
				$sucursal=$_REQUEST['sucursal'];
			}else{
				$sucursal="";
			}
			$doc=$_REQUEST['doc'];
			$serie=$_REQUEST['serie'];
			$numero=$_REQUEST['numero'];
			if(isset($_REQUEST['serie_prod'])){
				$serie_prod=$_REQUEST['serie_prod'];
			}else{
				$serie_prod=$_REQUEST['nom_prod'];
			}
			/*$filtrodoc2="and (ca.cod_ope!='R1' or ca.cod_ope!='R2' or ca.cod_ope!='S1' or ca.cod_ope!='S2') and ca.flag!='A'";
			if($doc==''){
				$filtrodoc="(ca.cod_ope!='R2' and  ca.cod_ope!='S2')";
			}else{
				$filtrodoc="ca.cod_ope='$doc' and (ca.cod_ope!='R2' and  ca.cod_ope!='S2')";
			}*/
			//$filtrodoc2="and (ca.cod_ope!='R1' or ca.cod_ope!='R2') and ca.flag!='A'";
			$filtrodoc2="and ca.cod_ope in (Select codigo from refope where documento='R1') and ca.flag!='A'";
			if($doc==''){
				//$filtrodoc="(ca.cod_ope!='R2' and  ca.cod_ope!='S2')";
				$filtrodoc="ca.cod_ope in (Select codigo from refope where documento='R1') and ca.flag!='A'";
			}else{
				//$filtrodoc="ca.cod_ope='$doc' and (ca.cod_ope!='R2' and  ca.cod_ope!='S2')";
				$filtrodoc="ca.cod_ope='$doc' and (ca.cod_ope in (Select codigo from refope where documento='R1') and ca.flag!='A')";
			}
		
			if($sucursal!=""){
				$sucu="ca.sucursal='$sucursal' and ";
			}else{
				$sucu="";
			}
			if(isset($_REQUEST['serie_prod'])){
				if($cliente!=""){
					$strSQL="select ca.* from cab_mov ca inner join det_mov dm on dm.cod_cab=ca.cod_cab inner join series se on se.producto=dm.cod_prod and se.salida=dm.cod_cab where ".$sucu.$filtrodoc." and ca.serie='$serie' and ca.Num_doc='$numero' and ca.cliente='$cliente' and se.serie='$serie_prod' and ca.flag!='A'";
				}else{
					$strSQL="select ca.* from cab_mov ca inner join det_mov dm on dm.cod_cab=ca.cod_cab inner join series se on se.producto=dm.cod_prod and se.salida=dm.cod_cab where ".$sucu.$filtrodoc." and ca.flag!='A' and ca.serie='$serie' and ca.Num_doc='$numero' and se.serie='$serie_prod'";	
				}
			}else{
				if(isset($_REQUEST['nom_prod'])){
					if($cliente!=""){
						$strSQL="select ca.* from cab_mov ca inner join det_mov dm on dm.cod_cab=ca.cod_cab inner join series se on se.producto=dm.cod_prod and se.salida=dm.cod_cab where ".$sucu.$filtrodoc." and ca.serie='$serie' and ca.Num_doc='$numero' and ca.cliente='$cliente' and dm.nom_prod like '%".$serie_prod."%' and ca.flag!='A'";
					}else{
						$strSQL="select ca.* from cab_mov ca inner join det_mov dm on dm.cod_cab=ca.cod_cab inner join series se on se.producto=dm.cod_prod and se.salida=dm.cod_cab where ".$sucu.$filtrodoc." and ca.flag!='A' and ca.serie='$serie' and ca.Num_doc='$numero' and dm.nom_prod like '%".$serie_prod."%'";	
					}
				}else{
					$strSQL="select ca.* from cab_mov ca where ".$sucu.$filtrodoc." and ca.flag!='A' and ca.serie='$serie' and ca.Num_doc='$numero' ";
				}
			}
			$resultado=mysql_query($strSQL,$cn);
			$row=mysql_fetch_array($resultado);
			if(mysql_num_rows($resultado)==0){
				$temp="N2";
			}
			$codigo=$row['cod_cab'];
			$cod_clie_ref=$row['cliente'];
			$moneda_doc=$row['moneda'];
			$impto=$row['impto1'];
					
			$strSQL2="select * from cliente where codcliente='$cod_clie_ref' ";
			$resultado2=mysql_query($strSQL2,$cn);
			$row2=mysql_fetch_array($resultado2);
			$des_clie_ref=$row2['razonsocial'];
									
			if(isset($_REQUEST['serie_prod'])){
				$strSQL3="select dt.*,se.*,se.serie as serie_prod from det_mov dt inner join series se on se.salida=dt.cod_cab and se.producto=dt.cod_prod where dt.cod_cab='$codigo' and se.serie='$serie_prod' ";
				$resultado3=mysql_query($strSQL3,$cn);
				while($row3=mysql_fetch_array($resultado3)){
					if($row3['cod_prod']!='TEXTO'){
						$_SESSION['productos'][0][] = $row3['cod_prod'];
						$_SESSION['productos'][1][] = "1";	
						$_SESSION['productos'][2][] = $row3['precio'];	
						$_SESSION['productos'][5][] = "ref";	
						$_SESSION['seriesprod'][0][]=$row3['serie_prod'];
			 			$_SESSION['seriesprod'][1][]="";
			  			$_SESSION['seriesprod'][2][]=$row3['producto'];
					}else{
						$_SESSION['productos'][0][] = "";
						$_SESSION['productos'][1][] = "";
						$_SESSION['productos'][2][] = $row3['nom_prod'];
						$_SESSION['productos'][5][] = "ref";
					}
				}
			}else{
				if(isset($_REQUEST['nom_prod'])){
					$strSQL3="select dt.* from det_mov dt where dt.cod_cab='$codigo' and dt.nom_prod like '%".$serie_prod."%' ";
				}else{
					$strSQL3="select dt.* from det_mov dt where dt.cod_cab='$codigo' ";
				}
				$resultado3=mysql_query($strSQL3,$cn);
				while($row3=mysql_fetch_array($resultado3)){
					if($row3['cod_prod']!='TEXTO'){
						$strSQL_series="select * from series where producto='".$row3['cod_prod']."' and salida='".$codigo."' ";
						$resultado_series=mysql_query($strSQL_series,$cn);
						while($row_series=mysql_fetch_array($resultado_series)){
							$_SESSION['productos'][0][] = $row3['cod_prod'];
							$_SESSION['productos'][1][] = "1";	
							$_SESSION['productos'][2][] = $row3['precio'];	
							$_SESSION['productos'][5][] = "ref";	
							$_SESSION['seriesprod'][0][]=$row_series['serie'];
			 				$_SESSION['seriesprod'][1][]="";
			  				$_SESSION['seriesprod'][2][]=$row_series['producto'];
						}
						$d=count($_SESSION['seriesprod'][2]);
						if($row3['cod_prod']==$_SESSION['seriesprod'][2][$d-1]){
							continue;
						}else{
							$_SESSION['productos'][0][] = $row3['cod_prod'];
							$_SESSION['productos'][1][] = $row3['cantidad'];	
							$_SESSION['productos'][2][] = $row3['precio'];	
							$_SESSION['productos'][5][] = "ref";
						}
					}else{
						$_SESSION['productos'][0][] = "";
						$_SESSION['productos'][1][] = "";
						$_SESSION['productos'][2][] = $row3['nom_prod'];
						$_SESSION['productos'][5][] = "ref";		
					}
				}	
			}
			if($codigo==''){
				$_SESSION['productos'][0][] = "";
				$_SESSION['productos'][1][] = "";
				$_SESSION['productos'][2][] = "";	
				$temp='N';
			}						
		}	
		$re="";								
		echo $temp.'?'.$codigo.'?'.$cod_clie_ref.'?'.$des_clie_ref.'?'.$moneda_doc.'?'.$impto.'?';
		?>
					
					<table width="474" border="0" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
        <tr  style="background:url(imagenes/bg_contentbase4.gif); background-position:100% 60%">
          <td width="32" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>Cod</strong></span></td>
          <td width="185"><span class="Estilo2 Estilo1 Estilo11"><strong>Descripci&oacute;n</strong></span></td>
          <td width="96"><span class="Estilo2 Estilo1 Estilo11"><strong>Serie</strong></span></td>
          <td width="36" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>Cant.</strong></span></td>
          <td width="40" height="18" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>PUnit.</strong></span></td>
          <td width="45" align="center"><span class="Estilo2 Estilo1 Estilo11"><strong>Total</strong></span></td>
          <td width="40">&nbsp;</td>
        </tr>
        <?php 
		$vserie=0;
		foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {

   			//if($subvalue!=""){
 
	 			$strSQL4="select * from producto where idproducto='".$subvalue."' ";
	 			$resultado4=mysql_query($strSQL4,$cn);
	 			while($row4=mysql_fetch_array($resultado4)){
	  
	 		?>
        <tr id="<?php echo $row4['idproducto'].$subkey?>">
          <td align="center" bgcolor="#FFFFFF" class="Estilo_det" ><?php echo $row4['idproducto']?></td>
          <td bgcolor="#FFFFFF" class="Estilo_det" ><?php echo caracteres($row4['nombre']);?></td>
          <?php	if($row4['series']=="S"){
	//		  		foreach ($_SESSION['seriesprod'][0] as $subkey2=> $subvalue2) {
						//$_SESSION['seriesprod'][2][$subkey2]
	//			  		if($_SESSION['seriesprod'][2][$subkey2]==$subvalue){
			  ?>
          <td bgcolor="#FFFFFF" class="Estilo_det" ><?php echo $_SESSION['seriesprod'][0][$vserie] ;
		  $vserie++;
	//	  				}
	//		  		}?></td>
          <?php	}else{ ?>
          <td bgcolor="#FFFFFF" class="Estilo_det" align="center" ></td>
          <?php	}?>
          <td align="center" bgcolor="#FFFFFF" class="Estilo_det" ><?php echo $_SESSION['productos'][1][$subkey] ; ?></td>
          <td align="right" bgcolor="#FFFFFF" class="Estilo_det" ><?php echo $_SESSION['productos'][2][$subkey] ; ?></td>
          <td align="right" bgcolor="#FFFFFF" class="Estilo_det" ><?php
		
		 				$totalitem=$_SESSION['productos'][1][$subkey] * $_SESSION['productos'][2][$subkey] ;
		 				$total=$total + $totalitem;
	
		 				$totalitem2=$_SESSION['productos'][1][$subkey] * $_SESSION['productos'][2][$subkey] ;
		 				$total2=$total2 + $totalitem2;
	
		 				echo number_format($totalitem,2);
		 
		 ?>          </td>
          <td align="center" bgcolor="#FFFFFF"><a href="javascript:selec_item('<?php echo $row4['idproducto'].$subkey?>')"><img src="<?php echo $ruta_imagen;?>" width="14" height="14" border="0" /></a></td>
        </tr>
        	<?php 
			/*	}
    		}else{
			?>
        <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
          <td align="center" bgcolor="#FFFFFF" >&nbsp;</td>
          <td bgcolor="#FFFFFF" ><?php echo $_SESSION['productos'][2][$subkey]; ?></td>
          <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
          <td align="right" bgcolor="#FFFFFF" >&nbsp;</td>
          <td align="right" bgcolor="#FFFFFF" >&nbsp;</td>
          <td align="center" bgcolor="#FFFFFF"><a href="javascript:quitar_items('<?php echo $_SESSION['productos'][2][$subkey]; ?>')"><img src="<?php echo $ruta_imagen;?>" width="14" height="14" border="0" /></a></td>
        </tr>
    <?php */
			}
		}
  	?>
      </table>				
	<?php 
	}
}
switch($_REQUEST['peticion']){
case "detSalMat":
	
	if($_REQUEST['accion']=='salir'){
		unset($_SESSION['garantias'][0]);
		unset($_SESSION['garantias'][1]);
		unset($_SESSION['garantias'][2]);
		unset($_SESSION['garantias'][3]);
		unset($_SESSION['garantias'][4]);
		unset($_SESSION['garantias'][5]);
		unset($_SESSION['garantias'][6]);	
	}
	if($_REQUEST['accion']=='eliminar'){
		/*unset($_SESSION['garantias'][0][$_REQUEST['item']-1]);
		unset($_SESSION['garantias'][1][$_REQUEST['item']-1]);
		unset($_SESSION['garantias'][2][$_REQUEST['item']-1]);
		unset($_SESSION['garantias'][3][$_REQUEST['item']-1]);
		unset($_SESSION['garantias'][4][$_REQUEST['item']-1]);
		unset($_SESSION['garantias'][5][$_REQUEST['item']-1]);
		unset($_SESSION['garantias'][6][$_REQUEST['item']-1]);*/
		unset($_SESSION['garantias'][0]);
		unset($_SESSION['garantias'][1]);
		unset($_SESSION['garantias'][2]);
		unset($_SESSION['garantias'][3]);
		unset($_SESSION['garantias'][4]);
		unset($_SESSION['garantias'][5]);
		unset($_SESSION['garantias'][6]);	
		
	}else{
		if(isset($_REQUEST['mod_precio'])){
			$item=$_REQUEST['item'];
			$_SESSION['garantias'][4][$item]=$_REQUEST['moneda'];
			$_SESSION['garantias'][5][$item]=$_REQUEST['precio'];
		}else{
			if(isset($_REQUEST['CambiaMoneda'])){
				$tc=$_SESSION['tc'];
				$mon=$_REQUEST['moneda'];
				$items=count($_SESSION['garantias'][0]);
				for($i=0;$i<=$items;$i++){
					if($_SESSION['garantias'][4][$i]=='02' && $mon=='01'){
						$_SESSION['garantias'][5][$i]=number_format($_SESSION['garantias'][5][$i]*$tc,2,".","");
					}else{
						if($_SESSION['garantias'][4][$i]=='01' && $mon=='02'){		
							$_SESSION['garantias'][5][$i]=number_format($_SESSION['garantias'][5][$i]/$tc,2,".","");
						}
					}
					$_SESSION['garantias'][4][$i]=$mon;
				}
			}else{
				//echo $prod['nombre'];
				$_SESSION['garantias'][0][]=count($_SESSION['garantias'][0])+1;
				$_SESSION['garantias'][1][]=$_REQUEST['tservi'];
				$_SESSION['garantias'][2][]="";
				$_SESSION['garantias'][3][]=$_REQUEST['cantidad'];
				$_SESSION['garantias'][4][]=$_REQUEST['moneda'];
				$_SESSION['garantias'][5][]=$_REQUEST['precio'];
				$_SESSION['garantias'][6][]="";
				$_SESSION['garantias'][0][]=count($_SESSION['garantias'][0])+1;
				$_SESSION['garantias'][1][]=$_REQUEST['codprod'];
				echo $_REQUEST['codprod'];
				if($_REQUEST['codprod']=="TEXTO"){
				$_SESSION['garantias'][2][]=$_REQUEST['descrip'];
				}else{
				$_SESSION['garantias'][2][]="";
				}
				//print_r($_SESSION['garantias'][2]);
				$_SESSION['garantias'][3][]=$_REQUEST['cantidad'];
				$_SESSION['garantias'][6][]=$_REQUEST['serie_prod'];
			}
		}
	}
	/*print_r($_SESSION['garantias'][6]);
	print_r($_SESSION['garantias'][1]);*/
	?>
	
	  <table width="578" border="0" cellpadding="1" cellspacing="1">
          <tr style="background:url(../imagenes/bg_contentbase2.gif); background-position:100 60">
            <td width="74" align="center"><span class="Estilo8">Codigo</span></td>
            <td width="343"><span class="Estilo8">Descripcion</span></td>
            <td width="58" align="center"><span class="Estilo8">Cantidad</span></td>
            <td width="58" align="center"><span class="Estilo8">Precio</span></td>
            <td width="17" align="center" class="Estilo8">A</td>
          </tr>
		  <?php 
		  /*print_r($_SESSION['garantias'][0]);
		  print_r($_SESSION['garantias'][1]);
		  print_r($_SESSION['garantias'][2]);
		  print_r($_SESSION['garantias'][3]);
		  print_r($_SESSION['garantias'][4]);
		  print_r($_SESSION['garantias'][5]);
		  print_r($_SESSION['garantias'][6]);*/
		if(isset($_SESSION['garantias'][0])){
			foreach ($_SESSION['garantias'][0] as $subkey=> $subvalue) {
				if($_SESSION['garantias'][1][$subkey]==""){
					unset($_SESSION['garantias'][2][$subkey]);
					unset($_SESSION['garantias'][3][$subkey]);
					unset($_SESSION['garantias'][4][$subkey]);
					//unset($_SESSION['garantias'][5][$subkey]);
					unset($_SESSION['garantias'][6][$subkey]);
					unset($_SESSION['garantias'][0][$subkey]);
					unset($_SESSION['garantias'][1][$subkey]);
			 	}
			}
			$a=0;
			foreach ($_SESSION['garantias'][1] as $subkey=> $subvalue) {
			?>
          <tr>
            <td align="center" bgcolor="#F5F5F5"><?php echo $_SESSION['garantias'][1][$subkey]?></td>
            <?php 
			if($_SESSION['garantias'][1][$subkey]=="TEXTO"){
				echo "<td align='left' bgcolor='#F5F5F5'>".caracteres($_SESSION['garantias'][2][$subkey])."</td>";
			}else{
				$consprod=mysql_query("Select * from producto where idproducto='".$_SESSION['garantias'][1][$subkey]."'",$cn);
				$prod=mysql_fetch_array($consprod);
				if(isset($_REQUEST['serie_prod'])||$_SESSION['garantias'][6][$subkey]){
					echo "<td align='left' bgcolor='#F5F5F5'>".caracteres($prod['nombre'])."<br>".$_SESSION['garantias'][6][$subkey]."</td>";
            	}else{
            		echo "<td align='left' bgcolor='#F5F5F5'>".caracteres($prod['nombre'])."</td>";
				}
			}?>
            <td align="center" bgcolor="#F5F5F5"><?php echo $_SESSION['garantias'][3][$subkey] ?></td>
            <?php //if($subkey==0){ 
			if($a==0){
			$tc=$_SESSION['tc'];
			if($_SESSION['garantias'][5][$subkey]==""){
				$_SESSION['garantias'][5][$subkey]=$prod['precio'];
			//echo $_SESSION['garantias'][4][$subkey]."==".$prod['moneda'];
				if($_SESSION['garantias'][4][$subkey]=='01'){
					switch($prod['moneda']){
						case '02':$_SESSION['garantias'][5][$subkey]=number_format($_SESSION['garantias'][5][$subkey]*$tc,2,".","");break;
						case '01':$_SESSION['garantias'][5][$subkey]=number_format($_SESSION['garantias'][5][$subkey],2,".","");break;
					}
				//echo $_SESSION['garantias'][4][$subkey];
				}else{
					switch($prod['moneda']){
						case '01':$_SESSION['garantias'][5][$subkey]=number_format($_SESSION['garantias'][5][$subkey]/$tc,2,".","");break;
						case '02':$_SESSION['garantias'][5][$subkey]=number_format($_SESSION['garantias'][5][$subkey],2,".","");break;
					}
				//echo $_SESSION['garantias'][4][$subkey];
				}
			}
			?>           
            <td align="center" bgcolor="#F5F5F5"><input type="text" onchange="Modificar_Precio(event,this,'<?php echo $subkey ?>')" name="pre_det" id="pre_det" onkeyup="Modificar_Precio(event,this,'<?php echo $subkey ?>')" value="<?php echo number_format($_SESSION['garantias'][5][$subkey],2,".","") ?>" /><input type="hidden" name="itpx" id="itpx" value="<?php echo $subkey ?>" /></td>
            <?php }else{ ?>
            <td align="center" bgcolor="#F5F5F5"></td>
            <?php }
			$a=1;?>
            <td align="center" bgcolor="#F5F5F5"><a style="cursor:pointer" onclick="eliminar('<?php echo $_SESSION['garantias'][0][$subkey]?>')"><img src="../imgenes/eliminar.gif" width="14" height="14" border="0" /></a></td>
          </tr>
          <?php } ?>
</table>	
	
	<?php
		  }
	
	break;
case 'Verifica': 

$serie_prod=$_REQUEST['serie_prod'];
/*if(isset($_REQUEST['sucursal'])){
	$sucursal=$_REQUEST['sucursal'];
}else{
	$sucursal="";
}*/
$doc=$_REQUEST['doc'];
$serie=$_REQUEST['serie'];
$serie=$_REQUEST['numero'];
$cliente=$_REQUEST['cliente'];
$cod_prod=$_REQUEST['cod_prod'];
$rpta="S";
$tip="";
/*if($sucursal!=""){
	$sucu=""
}else{
	
}*/
if(isset($_REQUEST['serie_prod'])){
	if($serie_prod!=""){
		$gen="from cab_mov ca inner join det_mov dm on ca.cod_cab=dm.cod_cab inner join series se on dm.cod_prod=se.producto and dm.tienda=se.tienda";
		//Empiezo por aberiguar si ya esta ingresada la Hoja de Garantia
		//$sqlr1="select re.* from referencia re inner join det_mov dm on re.cod_cab=dm.cod_cab where dm.cod_prod=$cod_prod and re.cod_cab in (Select ca.cod_cab $gen and dm.cod_cab=se.ingreso where se.serie='$serie_prod' and ca.cod_ope='R1' and estadoOT='')";
		$sqlr1="select ca.* from cab_mov ca inner join referencia re on re.cod_cab=ca.cod_cab where re.cod_cab 
in ( Select ca.cod_cab from cab_mov ca inner join det_mov dm on dm.cod_cab=ca.cod_cab inner join series se on dm.cod_prod=se.producto and dm.tienda=se.tienda and dm.cod_cab=se.salida where se.serie='$serie_prod' and ca.cod_ope='R2' and se.producto=$cod_prod)";
		//Averiguo si es que la Serie no ha salido del Almacen (Ultimo movimiento Compra)
		$sqling="select ca.* $gen where se.serie='$serie_prod' and se.producto=$cod_prod order by fecha desc limit 0,1";
		//Verifico si fue rechazado
		$sqlrec="Select ca.* $gen and dm.cod_cab=se.salida where se.serie='$serie_prod' and se.producto=$cod_prod and ca.cod_ope='Z1'";
	
		$reg_rec=mysql_num_rows(mysql_query($sqlrec,$cn));
		if($reg_rec>0){
			$tip="3";
		}else{
			$reg_r1=mysql_num_rows(mysql_query($sqlr1,$cn));
			if($reg_r1==0){
				$tip="1";
			}else{
				$row_ing=mysql_fetch_array(mysql_query($sqling,$cn));
				$reg_ing=mysql_num_rows(mysql_query($sqling,$cn));
				if($reg_ing>0){
					if($row_ing['tipo']=="1"){
						$tip="2";
					}
				}
			}
		}
		if($tip!=""){
			$rpta="N";
		}
	}else{
		$rpta="S";
	}
}
echo "$rpta?$tip?$sqlr1?";break;
//$sqlrec."?".$sqling."?".$sqlr1."?";break;
}
?>