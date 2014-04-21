<?php 
session_start();
include('conex_inicial.php');
include("funciones/funciones.php");
include("administracion/miclase.php");


$clase= new miclase('s');

$peticion=$_REQUEST['peticion'];

switch($peticion){

	case "actConexion":
	
	$strSQl="update usuarios set estado='D' where identificador='".$_REQUEST['mac']."|".$_REQUEST['userWin']."'";				
	mysql_query($strSQl,$cn);
	echo $strSQl;	
	break;

	case "buscar_prod":

	
	if(isset($_REQUEST['save'])){		
			$codigo=$_REQUEST['cod_docu'];
			$strSQL_del="delete from detope where documento='".$codigo."'";
			mysql_query($strSQL_del,$cn);			
			$array_deuda=$_REQUEST['deuda'];			
			$_SESSION['array_des'][2][]=explode("-",$array_deuda);			
			echo $array_deuda;			
			foreach ($_SESSION['array_des'][0] as $subkey=> $subvalue) {			
				if($_SESSION['array_des'][1][$subkey]!=''){
				$strSQl="insert into detope(documento,condicion,descondi)values('".$codigo."','".$_SESSION['array_des'][0][$subkey]."','".$_SESSION['array_des'][1][$subkey]."') ";				
				mysql_query($strSQl,$cn);																
				}
 			 }	
	//echo $strSQL_del;		
	}else{				
	if(isset($_REQUEST['add'])){	
		if(isset($_REQUEST['delete'])){
			$condicion=$_REQUEST['condicion'];	
				foreach ($_SESSION['array_des'][0] as $subkey=> $subvalue) {					 
					if($subvalue==$cod || $_SESSION['array_des'][0][$subkey]==$condicion){
					unset($_SESSION['array_des'][0][$subkey]);
					unset($_SESSION['array_des'][1][$subkey]); 
					unset($_SESSION['array_des'][2][$subkey]); 			
					}							
				}		
	     }else{		
		$condicion=$_REQUEST['condicion'];
		$descondi=$_REQUEST['descondi'];
		$deuda=$_REQUEST['deuda'];		
		 $_SESSION['array_des'][0][] = $condicion;
		 $_SESSION['array_des'][1][] = $descondi;
		 $_SESSION['array_des'][2][] = $deuda;     		 
		} 	
		
		}else{
		
			if(isset($_REQUEST['det_ref'])){			
				if($_REQUEST['accion']=='quitar'){				
						$cod=$_REQUEST['cod'];
						$codigo=$_REQUEST['cod_ref'];
						$cod_clie_ref=$_REQUEST['codcliente_ref'];
						$des_clie_ref=$_REQUEST['descliente_ref'];			
												
						foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
						 
							if($subvalue==$cod || $_SESSION['productos'][2][$subkey]==$cod){
							unset($_SESSION['productos'][0][$subkey]);
							unset($_SESSION['productos'][1][$subkey]); 
							unset($_SESSION['productos'][2][$subkey]); 												
							}								
				    	}                					
				}elseif($_REQUEST['accion']=='update'){				 
						$cod=$_REQUEST['cod'];
						$codigo=$_REQUEST['cod_ref'];
						$cod_clie_ref=$_REQUEST['codcliente_ref'];
						$des_clie_ref=$_REQUEST['descliente_ref'];
						$cant_prod=$_REQUEST['cant_prod'];
						$ckbNC=$_REQUEST['ckbNC'];
						$ver = explode(',',$ckbNC);									
						foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {								
							if ($ver[$subkey+1]=='true'){
								$_SESSION['productos'][6][$subkey]="checked";	
							}else{
								$_SESSION['productos'][6][$subkey]="";	
							}							
							if (count($_SESSION['productos'][0])==1){
								$_SESSION['productos'][6][0]="checked";	
							}							
							if($subvalue==$cod || $_SESSION['productos'][2][$subkey]==$cod){						
								$_SESSION['productos'][1][$subkey]=$cant_prod;	
							}								
				    	}                					
				}else{					
					unset($_SESSION['productos'][0]);
				    unset($_SESSION['productos'][1]); 
				    unset($_SESSION['productos'][2]); 
					
					$sucursal=$_REQUEST['sucursal'];
					$doc=$_REQUEST['doc'];
					$serie=$_REQUEST['serie'];
					$numero=$_REQUEST['numero'];
								
					$strSQL="select * from cab_mov where sucursal='$sucursal' and cod_ope='$doc' and serie='$serie' and Num_doc='$numero' ";
					$resultado=mysql_query($strSQL,$cn);
					$row=mysql_fetch_array($resultado);
					$codigo=$row['cod_cab'];
					$cod_clie_ref=$row['cliente'];
					$moneda_doc=$row['moneda'];
					$impto=$row['impto1'];
					
					$strSQL2="select * from cliente where codcliente='$cod_clie_ref' ";
					$resultado2=mysql_query($strSQL2,$cn);
					$row2=mysql_fetch_array($resultado2);
					$des_clie_ref=$row2['razonsocial'];
									
					$strSQL3="select * from det_mov where cod_cab='$codigo' ";
					$resultado3=mysql_query($strSQL3,$cn);
					while($row3=mysql_fetch_array($resultado3)){
					  	
						//*-*-**-*Verificar que no tenga NT referenciados-*--*-*
		  			$strSQLCP="select * from det_mov where 
					cod_cab in ( select cod_cab from referencia where cod_cab_ref='$codigo' )
				 	and cod_prod='".$row3['cod_prod']."' ";
					$resultadoCP=mysql_query($strSQLCP,$cn);
					while($rowCP=mysql_fetch_array($resultadoCP)){
			  			$catPR=$catPR+$rowCP['cantidad'];
					}
			  			//*-*-*-*--*--*-*-						
						
					  	if($row3['cod_prod']!='TEXTO'){
							if ($row3['cantidad']<>$catPR){						
								$_SESSION['productos'][0][] = $row3['cod_prod'];
								$_SESSION['productos'][1][] = $row3['cantidad']-$catPR;	
								$_SESSION['productos'][2][] = $row3['precio'];
								$_SESSION['productos'][4][] = $row3['unidad'];	
								$_SESSION['productos'][5][] = $row3['nom_prod'];
								$_SESSION['productos'][6][] = $row3['ckb'];
								$_SESSION['productos'][7][] = $row3['cantidad']-$catPR;							
							}
						$catPR=0;
						
						$strSQL_series="select * from series where producto='".$row3['cod_prod']."' and salida='".$codigo."' ";
							$resultado_series=mysql_query($strSQL_series,$cn);
							while($row_series=mysql_fetch_array($resultado_series)){
							
							 $_SESSION['seriesprod'][0][]=$row_series['serie'];
							 $_SESSION['seriesprod'][1][]="";
							 $_SESSION['seriesprod'][2][]=$row_series['producto'];
							
							}
							
					 	}else{
						$_SESSION['productos'][0][] = "";
						$_SESSION['productos'][1][] = "";
						$_SESSION['productos'][2][] = $row3['nom_prod'];
						$_SESSION['productos'][5][] = "ref";		
						}						
					}	
					
				    if($codigo==''){
					$_SESSION['productos'][0][] = "";
					$_SESSION['productos'][1][] = "";
					$_SESSION['productos'][2][] = "";	
					$temp='N';
				    }						
				}	
										
			echo $temp.'?'.$codigo.'?'.$cod_clie_ref.'?'.caracteres($des_clie_ref).'?'.$moneda_doc.'?'.$impto.'?';				
			//	echo "ddd ".$_REQUEST['cod_clie_ref'];
				?>
<style type="text/css">
<!--
.Estilo2 {font-size: 12px}
.EstiloDetPagos {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo6 {font-size: 11px}
-->
</style>

<table width="474" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF" id="lista_prodCM">
  <?php 

if (count($_SESSION['productos'][0])<>0){ // si no hay registros* 
foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {

   if($subvalue!=""){ 
	 $strSQL4="select * from producto where idproducto='".$subvalue."' ";
	 $resultado4=mysql_query($strSQL4,$cn);
	 //echo $strSQL4;
	 while($row4=mysql_fetch_array($resultado4)){
	  
	 ?>
  <tr  onclick="enfocar_prod(this);doc_det(this)" ondblclick=""  >
    <td width="20" align="center" ><input style="border: 0px; background:none; " type="radio" name="XDato" value="<?php  echo $row4['idproducto']?>" />
    </td>
    <td width="49" align="center" class="Estilo_det" ><?php echo $row4['idproducto']?></td>
    <td width="207" class="Estilo_det" ><?php echo caracteres($row4['nombre']);?></td>
    <td width="45" align="center" class="Estilo_det" ><?php 
$resultados11 = mysql_query("select * from unidades where id='".$_SESSION['productos'][4][$subkey]."' ",$cn); 					   			$rowSM=mysql_fetch_array($resultados11);
			echo $rowSM['nombre'];
		   ?></td>
    <td width="44" align="center" class="Estilo_det" ><?=$_SESSION['productos'][1][$subkey]; ?></td>
    <td width="46" align="right" class="Estilo_det" ><?=$_SESSION['productos'][2][$subkey] ; ?> </td>
    <td width="63" align="right" class="Estilo_det" ><?php		
		 $totalitem=$_SESSION['productos'][1][$subkey] * $_SESSION['productos'][2][$subkey] ;
		 $total=$total + $totalitem;	
		 echo number_format($totalitem,2);		 
		 ?></td>
  </tr>
  <?php 
	     }
    
    }
} // si no hay registros* 
}
  
  ?>
</table>
<?php 
//----------------------------------------------------------------------------------------------
			}else{
			
			if( isset($_REQUEST['codDoc']) && $_REQUEST['codDoc']!=""){			
			$codDoc=$_REQUEST['codDoc'];
			$desDoc=$_REQUEST['desDoc'];
			$tipoDoc=$_REQUEST['tipoDoc'];			
		$strSQL="insert into operacion(codigo,tipo,descripcion)
		 values('".$codDoc."','".$tipoDoc."','".$desDoc."')";
			//echo $strSQL;
			mysql_query($strSQL,$cn);			
			}else{			
		
		$valor=$_REQUEST['valor'];
		$aplicacion=$_REQUEST['aplicacion'];
		
		$strSQL="select * from operacion where codigo='".$valor."' and tipo='$aplicacion' order by descripcion ";
		$resultados = mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultados);
		
		echo $row['codigo']."#". strtoupper($row['descripcion'])."#".$row['imp1']."#".$row['imp2']."#".$row['kardex']."#".substr($row['p1'],0,1)."#".substr($row['p1'],1,1)."#".substr($row['p1'],2,1)."#".substr($row['p1'],3,1)."#".substr($row['p1'],4,1)."#".substr($row['p1'],5,1)."#".substr($row['p1'],6,1)."#".substr($row['p1'],7,1)."#".substr($row['p1'],8,1)."#".substr($row['p1'],9,1)."#".substr($row['p1'],10,1)."#".substr($row['p1'],11,1)."#".substr($row['p1'],12,1)."#".substr($row['p1'],13,1)."#".substr($row['p1'],14,1)."#".substr($row['p1'],15,1)."#".substr($row['p1'],16,1)."#".substr($row['p1'],17,1)."#".substr($row['p1'],18,1)."#".$row['sunat']."#".$row['comentario1']."#".$row['comentario2']."#".$row['obs1']."#".$row['obs2']."#".$row['obs3']."#".$row['obs4']."#".$row['obs5']."#".$row['formato']."#".$row['nitems']."#".$row['cola']."#".$row['min_percep']."#".$row['moneda']."#";
		}
		
		}
		}
		
		}
break;
	case "cambio_producto":	
	
	$codprod=$_REQUEST['codprod'];
	$codDM=$_REQUEST['codDM'];
	//echo $codprod;
	$strSQL=" select * from producto where idproducto ='".$codprod."' ";
	$resultados = mysql_query($strSQL,$cn);
	$row=mysql_fetch_array($resultados);
	$des_prod=$row['nombre'];
	$idproducto=$row['idproducto'];
	
	$strSQLP = " select * from det_mov where cod_cab='".$codDM."' 
	and cod_prod='".$idproducto."' ";
	$SQLProdP = mysql_query($strSQLP,$cn); 
	$rowP=mysql_fetch_array($SQLProdP);
	$cantidadP= $rowP['cantidad'];
	$precioP= $rowP['precio'];
	$totalP= $cantidadP*$precioP;
		
	$des_prod="$des_prod  ( $cantidadP - ".number_format($totalP,2)." )";
	echo caracteres($des_prod).'?'.$idproducto.'?'.$cantidadP.'?'.$precioP.'?'.$totalP.'?';		
	
	 	 	
break;
	case "cambio_prodMC":	
	$codP=$_REQUEST['codP'];
 	$busqueda=$_REQUEST['busqueda'];
	$codprod=$_REQUEST['codprod'];
	$cantidadP=$_REQUEST['cantidadP'];
 	$precioP=$_REQUEST['precioP'];
	$totalP=$_REQUEST['totalP'];
	
	$monto=$_REQUEST['monto'];
	$prod=$_REQUEST['prod'];
	?>
	
	<table width="474" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF" id="prod_CM">
  <?php 
  
	 $strSQL4="select * from producto where  $busqueda like '%".$codprod."%' and idproducto<>'".$codP."' ";
	 	 $resultado4=mysql_query($strSQL4,$cn);
	 //echo $strSQL4;	 
	 while($row4=mysql_fetch_array($resultado4)){	  
		 
	 ?>
  <tr  onclick="enfocar_prod2(this);"  >
    <td width="20" align="center" ><input style="border: 0px; background:none; " type="radio" name="XDato2" value="<?php  echo $row4['idproducto']?>"  />
    </td>
    <td width="49" align="center" class="Estilo_det" ><?php echo $row4['idproducto']?></td>
    <td width="207" class="Estilo_det" ><?php echo caracteres($row4['nombre']);?></td>
    <td width="45" align="center" class="Estilo_det" ><?php 
$resultados11 = mysql_query("select * from unidades where id='".$row4['und']."' ",$cn); 					   			$rowSM=mysql_fetch_array($resultados11);
			echo $rowSM['nombre'];
		   ?></td>
    <td width="44" align="center" class="Estilo_det" ><input name="cant_det" type="text" id="cant_det"  style="text-align:center" onkeyup="Modificar_Precio(event,this,'<?php echo $subkey ?>',<?php echo $row4['idproducto']?>)"  value="<?
	if ($row4['idproducto']==$prod){
	echo $monto;
	}else{
	echo $cantidadP;
	}
	
	 ?>" size="4" />
   </td>
    <td width="46" align="right" class="Estilo_det" ><?=$row4['precio']; ?> </td>
    <td width="63" align="right" class="Estilo_det" ><?php		
	if ($row4['idproducto']==$prod){
	$totalitem=$monto * $row4['precio'] ;
	}else{
	$totalitem=$cantidadP * $row4['precio'] ;
	}
		 //$totalitem=$cantidadP * $row4['precio'] ;
		 $total=$total + $totalitem;	
		 echo number_format($totalitem,2);		 
		 ?></td>
  </tr>
  <?php 
	     }

  ?>
</table>
	
	<?
	break;
	
	case "repararBD":
	
	
	//------------------analizar y reparar tablas dañadas------------------------------
		
		
		

		$rs2 = mysql_query("show tables");
		while($arr2=mysql_fetch_array($rs2)){
	
				
			//	$rs3 = mysql_query("check table ".$arr2[0].""); echo mysql_error();
			//	$arr3=mysql_fetch_array($rs3);
					
			   $rs4 = mysql_query("repair table ".$arr2[0].""); echo mysql_error();
			   $arr4=mysql_fetch_array($rs4);
		
			
			//echo "<li>$arr2[0] <i>$arr3[2]  $arr3[1]</i> $arr3[3]</i> <b>$arr4[3]</b>";
		}

		include("backups/dump_db.php");
    //---------------------------------------------------------------------------------
	
	
	break;	
	
	case "ubigeo":
	
	$tabla=$_REQUEST['tabla'];	
	$valor=$_REQUEST['valor'];	   	
	
		   		$strSQL="select * from ubigeo where desdist like '$valor%' ";
				$campo1="desdist";
				$campo2="desprovi";
				$campo3="desdepa";      
				
				$titulo=" Ubicación - Auxiliares ";
	
		
	 ?>
	 
	 <table width="456" height="243" border="0" cellpadding="0" cellspacing="0" style="border:#8BB1F8 solid 1px; background:#E3F4F9;">
  <tr style="background:url(imagenes/aqua-hd-bg.gif)">
    <td height="23" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000">&nbsp;</td>
    <td height="23" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000"><strong>Lista de <?php echo $titulo;?> 
     
    </strong></td>
    <td width="16" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000" onclick="salir();">
	
	<font face="Arial, Helvetica, sans-serif" style="text-decoration:underline; font-size:11px; cursor:pointer" color="#0033FF"><strong>x</strong></font
	></td>
  </tr>
  <tr >
    <td height="10" colspan="3" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000"></td>
    </tr>
  <tr>
    <td width="9" height="189">&nbsp;</td>
    <!--
	
	<div  id="detalle_chofer" style="width:410px; height:150px; overflow-y:scroll">
	-->
    <td width="429" valign="top">
	
	<div  style="z-index:999; cursor:default" onmousemove="javascript:finMovimiento(event);">
	<table width="429" border="0" cellpadding="0" cellspacing="0">
      
   
      <tr>
        <td width="429" bgcolor="#F4F4F4">
            <table width="430" border="0" cellpadding="1" cellspacing="1">
              <tr  style="background:url(imagenes/bg_contentbase2.gif); background-position:100px 60px">
                <td width="140" height="19" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Distrito</strong></td>
                <td width="151" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Provincia</strong></td>
                <td width="134" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Departamento</strong></td>
                <td width="1" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF">&nbsp;</td>
              </tr>
             
              <tr>
                <td colspan="4" align="center" style="border-bottom:#E5E5E5 solid 1px" >
				
					<div  id="detalle_chofer" style="width:435px; height:150px; overflow-y:scroll">
					  <table width="420" border="0" align="left" cellpadding="0" cellspacing="0">
                        <?php 
				$regvis=100;
				$pag=$_REQUEST['pag'];
				
				if($pag>=1) {
				$inicio=($pag-1)*$regvis;
				}else{
				$inicio=0;
				$pag=1;
				}
				$totalreg=mysql_num_rows(mysql_query($strSQL,$cn));
				$resultado = mysql_query($strSQL." limit ".$inicio.",".$regvis,$cn);
				//echo $strSQL." limit ".$inicio.",".$regvis;
			
			//$resultado=mysql_query($strSQL,$cn);
			$i=1;
			while($row=mysql_fetch_array($resultado)){
				
				$bgcolor="#F4F4F4";
				if($i%2==0){
				$bgcolor="#FFFFFF";
				}
			?>
                        <tr bgcolor="<?php echo $bgcolor;?>"  onmouseover="entrada2(this)" onmouseout="entrada2(this)" >
                          <td height="18" width="140" align="center" style="border-bottom:#E5E5E5 solid 1px" ><a href="#" onclick="sel_item('<?php echo $row['coddist']?>','<?php echo $row['codprovi']?>','<?php echo $row['coddepa']?>','<?php echo caracteres($row['desdist'])?>','<?php echo caracteres($row['desprovi'])?>','<?php echo $row['desdepa']?>','<?php echo $row['id']?>')"><?php echo caracteres($row['desdist'])?></a></td>
						  
						  <?php  ?>
                          <td width="155" align="center" style="border-bottom:#E5E5E5 solid 1px; color:#333333; "><?php echo caracteres($row[$campo2])?></td>
                          <td width="125" align="center" style="border-bottom:#E5E5E5 solid 1px" ><?php echo $row[$campo3]?>&nbsp;</td>
                        </tr>
                        <?php 
			  $i++;
					  }
			?>
                      </table>
					</div>				</td>
              </tr>
            </table>       </td>
      </tr>
    </table>
	</div>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="19" ></td>
    <td valign="top">
	<div id="divpagina">
	<?php 
	$clase->paginar($totalreg,$pag,$regvis);
	?>
	</div>	</td>
    <td>&nbsp;</td>
  </tr>
</table>
	 
	 
	<?php
	
	break; 
	
	case "lista_otrasDirec":
	
	$tabla=$_REQUEST['tabla'];	
	$valor=$_REQUEST['valor'];	   	
	
		   		
	
	$tabla=$_REQUEST['tabla'];	
	$valor=$_REQUEST['valor'];
	$nuevaDirec=$_REQUEST['nuevaDirec'];	   	
	
	if(isset($_REQUEST['save'])){
	
	$strSQL="insert into direc_aux(codcliente,direccion)values('".$valor."','".$nuevaDirec."')";
	mysql_query($strSQL,$cn);
	//echo $strSQL;
	
	}
	
	if(isset($_REQUEST['eliminar'])){
	
	$strSQL="delete from direc_aux where id='".$_REQUEST['codDirecElim']."'";
	mysql_query($strSQL,$cn);
	//echo $strSQL;
	
	}
	
	
	$strSQL="select * from direc_aux where codcliente='".$valor."' order by direccion";
		
		//echo $strSQL;
		
	 ?>
	 
	 <table width="456" height="262" border="0" cellpadding="0" cellspacing="0" style="border:#8BB1F8 solid 1px; background:#E3F4F9;">
  <tr style="background:url(imagenes/aqua-hd-bg.gif)">
    <td height="23" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000">&nbsp;</td>
    <td height="23" colspan="2" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000"><strong>Lista de Direcciones </strong></td>
    <td width="9" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000" onclick="salir();">
	
	<font face="Arial, Helvetica, sans-serif" style="text-decoration:underline; font-size:11px; cursor:pointer" color="#0033FF"><strong>x</strong></font
	></td>
  </tr>
  <tr >
    <td height="29" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000"></td>
    <td width="197" height="29" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000">Buscar
    <input type="text" name="nuevaDirec" id="nuevaDirec"/></td>
    <td width="243" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000"><input type="button" name="Submit" value="Insertar como Nuevo" onclick="insertarDirecNuevo()" /></td>
    <td height="29" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000"></td>
  </tr>
  <tr>
    <td width="5" height="189">&nbsp;</td>
    <!--
	
	<div  id="detalle_chofer" style="width:410px; height:150px; overflow-y:scroll">
	-->
    <td colspan="2" valign="top">
	
	<div  style="z-index:999; cursor:default" onmousemove="javascript:finMovimiento(event);">
	<table width="429" border="0" cellpadding="0" cellspacing="0">
      
   
      <tr>
        <td width="429" bgcolor="#F4F4F4">
            <table width="430" border="0" cellpadding="1" cellspacing="1">
              <tr  style="background:url(imagenes/bg_contentbase2.gif); background-position:100px 60px">
                <td width="47" height="19" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Id</strong></td>
                <td width="331" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Dirección</strong></td>
                <td width="47" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Acci&oacute;n</strong></td>
                <td width="1" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF">&nbsp;</td>
              </tr>
             
              <tr>
                <td colspan="4" align="center" style="border-bottom:#E5E5E5 solid 1px" >
				
					<div  id="detalle_chofer" style="width:435px; height:150px; overflow-y:scroll">
					  <table width="420" border="0" align="left" cellpadding="0" cellspacing="0">
                        <?php 
				$regvis=100;
				$pag=$_REQUEST['pag'];
				
				if($pag>=1) {
				$inicio=($pag-1)*$regvis;
				}else{
				$inicio=0;
				$pag=1;
				}
				$totalreg=mysql_num_rows(mysql_query($strSQL,$cn));
				$resultado = mysql_query($strSQL." limit ".$inicio.",".$regvis,$cn);
				//echo $strSQL." limit ".$inicio.",".$regvis;
			
			//$resultado=mysql_query($strSQL,$cn);
			$i=1;
			while($row=mysql_fetch_array($resultado)){
				
				$bgcolor="#F4F4F4";
				if($i%2==0){
				$bgcolor="#FFFFFF";
				}
			?>
                        <tr bgcolor="<?php echo $bgcolor;?>"  onmouseover="entrada2(this)" onmouseout="entrada2(this)" >
                          <td height="18" width="49" align="center" style="border-bottom:#E5E5E5 solid 1px" ><a href="#" ><?php echo caracteres($row['id'])?></a></td>
						  
						  <?php  ?>
                          <td width="339" align="center" style="border-bottom:#E5E5E5 solid 1px; color:#333333; "><?php echo caracteres($row['direccion'])?></td>
                          <td width="32" align="center" style="border-bottom:#E5E5E5 solid 1px" ><img src="imgenes/eliminar.png" width="14" height="14" onclick="eliminarDirec('<?php echo $row['id'];?>')" style="cursor:pointer"/></td>
                        </tr>
                        <?php 
			  $i++;
					  }
			?>
                      </table>
					</div>				</td>
              </tr>
            </table>       </td>
      </tr>
    </table>
	</div>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="19" ></td>
    <td colspan="2" valign="top">
	<div id="divpagina">
	<?php 
	$clase->paginar($totalreg,$pag,$regvis);
	?>
	</div>	</td>
    <td>&nbsp;</td>
  </tr>
</table>
	 
	 
	<?php
	
	
	break;
	
	
	
	
	case "cargaFormato":
	
	$sucursal=$_REQUEST['sucursal'];
	
	$margen=0;
	$strSQL= "select * from formatos where doc='".$_REQUEST['doc']."' and habilitar='S'  and sucursal='".$sucursal."' " ;
	$resultado = mysql_query ($strSQL,$cn);
	while($row = mysql_fetch_array ($resultado)){
	
	echo "<div class='ui-widget-content' id='".$row['descripcion']."' style='border:#333333 solid 1px;width:".$row['ancho'].";height:".$row['alto']."; top:".$row['coordy']."; left:".($margen+$row['coordx'])."; position: absolute; cursor:move' onMouseMove='controlDiv(this)' >".$row['descripcion']."</div>";
	//onMouseMove='moverDiv(this)'
	
	$ids=$ids."-".$row['descripcion'];
	$fontsize1=$row['fontsize'];
	$alturaDoc=$row['altura'];
	$fuente=$row['fuente'];
	$separacion=$row['separacion'];
	$anchoDoc=$row['anchodoc'];
	$alturaItems=$row['alturaItems'];
	
	}
	
	echo "|". $ids."|".$fontsize1."|".$alturaDoc."|".$fuente."|".$separacion."|".$anchoDoc."|".$alturaItems."|";
	?>
	
	  <table width="148" border="0" cellspacing="1" cellpadding="0"   >
            <tr>
              <td width="27" align="center" bgcolor="#66CCCC"><span class="Estilo2">ok</span></td>
              <td width="121" bgcolor="#66CCCC"><span class="Estilo2">Nombre</span></td>
            </tr>
			
			<?php 
			
			$resultados10 = mysql_query("select * from formatos where doc='".$_REQUEST['doc']."' and sucursal='".$sucursal."' order by descripcion ",$cn); 
			while($row10=mysql_fetch_array($resultados10))
			{
			
			if($row10['habilitar']=='S'){
			$marcar='checked';
			}else{
			$marcar='';
			}
			?>
            <tr>
              <td height="22" align="center"><input <?php echo $marcar ?> style="background:none; border:none" type="checkbox" name="checkbox" id="checkbox" value="<?php echo $row10['descripcion']; ?>"></td>
              <td><?php echo $row10['descripcion'] ?></td>
            </tr>
			
			<?php }?>
      </table>
	
	
	<?php 
	
	
	break;
	case "saveFormato":
	
	$doc=$_REQUEST['doc'];
	$sucursal=$_REQUEST['sucursal'];
	$acumulador=$_REQUEST['acumulador'];
	$fontsize1=$_REQUEST['fontsize1'];
	$alturaDoc=$_REQUEST['alturaDoc'];
	$fuente=$_REQUEST['fuente'];
	$separacion=$_REQUEST['separacion'];
	$anchoDoc=$_REQUEST['anchoDoc'];
	$alturaItems=$_REQUEST['alturaItems'];
	
	
	$temp0=explode("~",$acumulador);	
	$temp=explode("|",$temp0[0]);	
		
	
	
		for($i=1;$i<count($temp);$i++){
		$temp2=explode("-",$temp[$i]);
		
		$strsSQL="update formatos set coordx='".$temp2[1]."',coordy='".$temp2[2]."',ancho='".$temp2[3]."',alto='".$temp2[4]."' where doc='".$doc."' and descripcion='".$temp2[0]."' and sucursal='".$sucursal."'";
		
		mysql_query($strsSQL,$cn);
		
		}
		
	$tempx=explode("-",$temp0[1]);	
		
		$strsSQL="update formatos set habilitar ='N',fontsize='".$fontsize1."',altura='".$alturaDoc."',fuente='".$fuente."',separacion='".$separacion."',anchodoc='".$anchoDoc."',alturaItems='".$alturaItems."' where doc='".$doc."'  and sucursal='".$sucursal."'";
		mysql_query($strsSQL,$cn);
		
		for($i=1;$i<count($tempx);$i++){				
		$strsSQL="update formatos set habilitar ='S' where descripcion='".$tempx[$i]."' and doc='".$doc."' and sucursal='".$sucursal."'";		
		mysql_query($strsSQL,$cn);
		
		}
		
		
		
		
	break;
	
	case "saveCopiaForm":
	
	$sucursal=$_REQUEST['sucursal'];
	$sucursal2=$_REQUEST['sucursal2'];	
	
	$resultados10 = mysql_query("select * from formatos where doc='".$_REQUEST['doc']."' and sucursal='".$sucursal."' order by descripcion ",$cn); 
			while($row10=mysql_fetch_array($resultados10))
			{
			
			$strSQL="insert into formatos(doc,descripcion,coordx,coordy,alto,ancho,habilitar,sucursal,fontsize,altura)values ('".$_REQUEST['doc2']."','".$row10['descripcion']."','".$row10['coordx']."','".$row10['coordy']."','".$row10['alto']."','".$row10['ancho']."','".$row10['habilitar']."','".$sucursal2."','".$row10['fontsize']."','".$row10['altura']."')";
			
				mysql_query($strSQL,$cn);
			}
	
	
	break;
	
	case "eliminarForm":
		
		$strSQL="delete from formatos where doc='".$_REQUEST['doc']."' and sucursal='".$_REQUEST['sucursal']."'";
		mysql_query($strSQL,$cn);
		
	break;
	
	
	case "cboDirec":
	
		$codcliente=$_REQUEST['codcliente'];		
		$strSQL="select * from direc_aux where codcliente='".$codcliente."' order by direccion";
		//echo $strSQL;
	?>
	<select name="cboOtrasDirec" id="cboOtrasDirec" onchange="cambiarOtraDirec(this)">
	
	<option value="0">Direccion por Defecto*</option>
	<?php 
	
	$resultado=mysql_query($strSQL,$cn);
	while($row=mysql_fetch_array($resultado)){
	?>
	
	  <option value="<?php echo $row['id']?>"><?php echo caracteres($row['direccion'])?></option>
	  <?php }?>
	  
    </select>
	
	
<?php 
	
	break;
	
	case "docsIng":
	
	$fecha1=formatofecha($_REQUEST['fecha1']);
	$fecha2=formatofecha($_REQUEST['fecha2']);
	$sucursal=$_REQUEST['sucursal'];
	$tienda=$_REQUEST['tienda'];
	$proveedor=$_REQUEST['proveedor'];
	$pag=$_REQUEST['pag'];		
	
	$serie=$_REQUEST['serie'];
	$numero=$_REQUEST['numero'];			   		
	
	
					
	if(isset($_REQUEST['save'])){	
	$strSQL="insert into direc_aux(codcliente,direccion)values('".$valor."','".$nuevaDirec."')";
	mysql_query($strSQL,$cn);
	}
	
	if(isset($_REQUEST['eliminar'])){	
	$strSQL="delete from direc_aux where id='".$_REQUEST['codDirecElim']."'";
	mysql_query($strSQL,$cn);
	}
	
	
	if($sucursal=='0'){
	$filtroS=" ";
	}else{
	$filtroS= " and sucursal='".$sucursal."' ";
	}
	
	if($tienda=='0'){
	$filtroT=" ";
	}else{
	$filtroT= " and tienda='".$tienda."' ";
	}
	
	
	$filtroSerie=" ";		
	if($serie!=''){	
	$filtroSerie=" and serie='".$serie."' "; 
	}
	
	$filtroNumero=" ";
	if($numero!=''){	
	$filtroNumero=" and Num_doc='".$numero."' "; 
	}
	
	
	$strSQL="select * from cab_mov cm,cliente c where substring(fecha,1,10) between '$fecha1' and '$fecha2' $filtroS $filtroT $filtroSerie $filtroNumero and   c.codcliente=cm.cliente and tipo='1' and c.razonsocial like '%".$proveedor."%' and flag!='A' order by cm.fecha desc";
	
		
		//echo $strSQL;
		
	 ?>
	 
	 <table width="751" height="201" border="0" cellpadding="0" cellspacing="0" style="border:#8BB1F8 solid 1px;">
  
  <tr>
    <td width="4" height="175">&nbsp;</td>
    <!--
	
	<div  id="detalle_chofer" style="width:410px; height:150px; overflow-y:scroll">
	-->
    <td colspan="2" valign="top">
	
	<div  style="z-index:999; cursor:default" onmousemove="javascript:finMovimiento(event);">
	<table width="429" border="0" cellpadding="0" cellspacing="0">
      
   
      <tr>
        <td width="429" bgcolor="#F4F4F4">
            <table width="737" border="0" cellpadding="1" cellspacing="1">
              <tr  style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px">
                <td width="16" height="19" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>OP</strong></td>
                <td width="109" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Fecha / Hora </strong></td>
                <td width="40" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Tienda</strong></td>
                <td width="34" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Tipo</strong></td>
                <td width="104" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Numero</strong></td>
                <td width="283" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Proveedor</strong></td>
                <td width="40" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Items</strong></td>
               
                <td width="92" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Responsable</strong></td>
              </tr>
             
              <tr>
                <td colspan="9" align="left" style="border-bottom:#E5E5E5 solid 1px" >
				
					<div  id="detalle_chofer" style="width:740px; height:150px; overflow-y:scroll">
					  <table id="tbl_productos" width="720" height="22" border="0" align="left" cellpadding="0" cellspacing="0">
                        <?php 
				$regvis=100;
				$pag=$_REQUEST['pag'];
				
				if($pag>=1) {
				$inicio=($pag-1)*$regvis;
				}else{
				$inicio=0;
				$pag=1;
				}
				$totalreg=mysql_num_rows(mysql_query($strSQL,$cn));
				$resultado = mysql_query($strSQL." limit ".$inicio.",".$regvis,$cn);
				//echo $strSQL." limit ".$inicio.",".$regvis;
			
			//$resultado=mysql_query($strSQL,$cn);
			$i=1;
			while($row=mysql_fetch_array($resultado)){
				
				$bgcolor="#F4F4F4";
				if($i%2==0){
				$bgcolor="#FFFFFF";
				}
				
				 list($des_suc)=mysql_fetch_row(mysql_query("select des_suc from sucursal where cod_suc='".$row['sucursal']."'"));
				 
				  list($des_tienda)=mysql_fetch_row(mysql_query("select des_tienda from tienda where cod_tienda='".$row['tienda']."'"));
				
			?>
                        <tr bgcolor="<?php echo $bgcolor;?>" onClick="entrada2(this);cargarDetalle('<?php echo $row['cod_cab']?>','<?php echo $row['cod_ope']?>','<?php echo $sucursal?>','<?php echo $des_suc?>','<?php echo $tienda ?>','<?php echo $des_tienda ?>');"  ondblclick="doc_det('<?php echo $row['cod_cab']; ?>');">
                        <td height="18" width="22" align="center" style="border-bottom:#E5E5E5 solid 1px" ><input name="xcodigo" type="radio" value="radiobutton" style="border:none; background:none"  /></td>
						  
						  <?php  ?>
                          <td width="106" align="center" style="border-bottom:#E5E5E5 solid 1px; color:#333333; "><a href="#" ><?php echo extraefecha4($row['fecha'])?></a></td>
                          <td width="44" align="center" style="border-bottom:#E5E5E5 solid 1px; color:#333333; "><?php echo $row['tienda']?></td>
                          <td width="52" align="center" style="border-bottom:#E5E5E5 solid 1px; color:#333333; "><?php echo $row['cod_ope']?></td>
                          <td width="112" align="center" style="border-bottom:#E5E5E5 solid 1px; color:#333333; "><?php echo $row['serie']."-".$row['Num_doc'] ?></td>
                          <td width="259" align="left" valign="middle" style="border-bottom:#E5E5E5 solid 1px; color:#333333; "><?php 
						  
						    list($des_aux)=mysql_fetch_row(mysql_query("select razonsocial from cliente where codcliente='".$row['cliente']."'"));
						  echo caracteres($des_aux);
						  
						  ?></td>
                          <td width="43" align="center" style="border-bottom:#E5E5E5 solid 1px; color:#333333; "><?php echo $row['items']?></td>
                         
                          <td width="82" align="center" style="border-bottom:#E5E5E5 solid 1px" ><span style="border-bottom:#E5E5E5 solid 1px; color:#333333; "><?php echo $row['cod_vendedor']?></span></td>
                        </tr>
                        <?php 
			  $i++;
					  }
			?>
                      </table>
					</div>				</td>
              </tr>
            </table>       </td>
      </tr>
    </table>
	</div>	</td>
    <td width="5"></td>
  </tr>
  <tr>
    <td height="19" ></td>
    <td colspan="2" valign="top">
	<div id="divpagina">
	<?php 
	$clase->paginar($totalreg,$pag,$regvis);
	?>
	</div>	</td>
    <td></td>
  </tr>
</table>
	 
	 
	<?php
	
	
	break;
	
	case "detallaDoc":
	
	$cod=$_REQUEST['cod'];
	
		
		$strSQL="select * from det_mov d,producto p where d.cod_prod=p.idproducto and d.cod_cab='".$cod."'";
		
		//echo $strSQL;
		
		
		
		
	 ?>
	 
	 <table width="751" height="201" border="0" cellpadding="0" cellspacing="0" style="border:#8BB1F8 solid 1px;">
  
  <tr>
    <td width="4" height="175">&nbsp;</td>
    <!--
	
	<div  id="detalle_chofer" style="width:410px; height:150px; overflow-y:scroll">
	-->
    <td colspan="2" valign="top">
	
	<div  style="z-index:999; cursor:default" onmousemove="javascript:finMovimiento(event);">
	<table width="429" border="0" cellpadding="0" cellspacing="0">
      
   
      <tr>
        <td width="429" bgcolor="#F4F4F4">
            <table width="737" border="0" cellpadding="1" cellspacing="1">
              <tr  style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px">
                <td width="16" height="19" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>OP</strong></td>
                <td width="43" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Codigo</strong></td>
                <td width="348" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Producto</strong></td>
                <td width="54" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Cantidad Doc. </strong></td>
                <td width="57" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Entregado</strong></td>
                <td width="46" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong><strong>Saldo Doc.</strong></strong></td>
                <td width="70" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Stock Actual</strong></td>
                <td width="84" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Cantidad a Transferir </strong></td>
              </tr>
             
              <tr>
                <td colspan="8" align="left" style="border-bottom:#E5E5E5 solid 1px" >
				
					<div  id="detalle_chofer" style="width:740px; height:150px; overflow-y:scroll">
					  <table width="723" height="22" border="0" align="left" cellpadding="0" cellspacing="0">
                        <?php 
				$regvis=100;
				$pag=$_REQUEST['pag'];
				
				if($pag>=1) {
				$inicio=($pag-1)*$regvis;
				}else{
				$inicio=0;
				$pag=1;
				}
				//$totalreg=mysql_num_rows(mysql_query($strSQL,$cn));
				$resultado = mysql_query($strSQL,$cn);
				//echo $strSQL." limit ".$inicio.",".$regvis;
			
			//$resultado=mysql_query($strSQL,$cn);
			$i=1;
			while($row=mysql_fetch_array($resultado)){
				
				$bgcolor="#F4F4F4";
				if($i%2==0){
				$bgcolor="#FFFFFF";
				}
				
				$tienda=$row['tienda'];
				$tsaldo="saldo".$tienda;
				
			?>
                        <tr bgcolor="<?php echo $bgcolor;?>"  >
                          <td height="18" width="24" align="center" style="border-bottom:#E5E5E5 solid 1px" ><input type="checkbox" name="checkbox2" value="checkbox" style="border:none; background:none" /></td>
						  
						  <?php  ?>
                          <td width="54" align="center" style="border-bottom:#E5E5E5 solid 1px; color:#333333; "><a href="#" ><?php echo $row['idproducto']?></a>
						  <input name='codFact'  type='hidden' id='codFact' size='10' maxlength='7'  value="<?php echo $row['idproducto'] ?>" />						  </td>
                          <td width="343" align="left" style="border-bottom:#E5E5E5 solid 1px; color:#333333; "><?php echo caracteres($row['nombre'])?>			</td>
                          <td width="56" align="center" style="border-bottom:#E5E5E5 solid 1px; color:#333333; "><?php echo $row['cantidad']?>						  
						   <input name='cantped'  type='hidden' id='cantped' size='10' maxlength='7'  value='<?php echo $row['cantidad']?>' />
						  </td>
                          <td width="56" align="center" style="border-bottom:#E5E5E5 solid 1px; color:#333333; "><?php echo $row['cantdesp']?>
						  <input name='cantdesp'  type='hidden' id='cantdesp' size='10' maxlength='7'  value='<?php echo $row['cantdesp']?>' />
						  </td>
                          <td width="48" align="center" style="border-bottom:#E5E5E5 solid 1px; color:#333333; "><?php echo $row['cantidad']-$row['cantdesp']?></td>
                          <td width="75" align="center" style="border-bottom:#E5E5E5 solid 1px; color:#333333; "><?php echo $row[$tsaldo]?>
                            <input name='cantstock'  type='hidden' id='cantstock' size='10' maxlength='7'  value='<?php echo $row[$tsaldo]?>' /></td>
                          <td width="67" align="center" style="border-bottom:#E5E5E5 solid 1px; text-align:right" >
						  <?php if($row['factor']>1){?>
						  
						  <input name="cantFact" id="cantFact" type="text" size="8" maxlength="10" onblur='validarCantFact(this)' style="text-align:right"  onkeydown="validarNumero2(this,event)" value="0" />
						  <?php }else{?>
						    <input name="cantFact" id="cantFact" type="text" size="8" maxlength="10" onblur='validarCantFact(this)' style="text-align:right"  onkeydown="validarNumero3(this,event)" value="0" />
						  
						  <?php }?>
						  </td>
                        </tr>
                        <?php 
			  $i++;
					  }
			?>
                      </table>
					</div>				</td>
              </tr>
            </table>       </td>
      </tr>
    </table>
	</div>	</td>
    <td width="5"></td>
  </tr>
  <tr>
    <td height="19" ></td>
    <td colspan="2" valign="top">
	</td>
    <td></td>
  </tr>
</table>
	 
	 
	<?php	
	break;	
	
	case "save_doc":
	
		$cod_cab_doc=$_REQUEST['cod_cab_doc'];
		$serieDocOrigen=$_REQUEST['serieDocOrigen'];
		$numeroDocOrigen=$_REQUEST['numeroDocOrigen'];
		
		$almacen_destino=$_REQUEST['almacen_destino'];
		$sucursal_destino=$_REQUEST['sucursal_destino'];
				
		
			 	list($sucursalO,$tiendaO)=mysql_fetch_row(mysql_query("select sucursal,tienda from cab_mov where cod_cab='".$cod_cab_doc."'"));
		
			$strSQL="select max(Num_doc) as Num_do from cab_mov where tipo='2' and  sucursal='$sucursalO' and cod_ope='GR' and serie='".str_pad($serieDocOrigen,3, "0", STR_PAD_LEFT)."' ";
		 //echo $strSQL;
			$resultado=mysql_query($strSQL,$cn);
			$row2=mysql_fetch_array($resultado);
				
				$serie=str_pad($serieDocOrigen,3,"0", STR_PAD_LEFT);
				//$numero=str_pad($row2['Num_do']+1,7,"0", STR_PAD_LEFT);
				
				$numero=str_pad($numeroDocOrigen,7,"0", STR_PAD_LEFT);
				
				
				 list($rucSucD,$des_sucD)=mysql_fetch_row(mysql_query("select ruc,des_suc from sucursal where cod_suc='".$sucursal_destino."'"));
				 
				 list($codclienteD)=mysql_fetch_row(mysql_query("select codcliente from cliente where ruc='".$rucSucD."'"));								 
				 list($direccionO)=mysql_fetch_row(mysql_query("select direccion from tienda where cod_tienda='".$tiendaO."'"));			
				 list($direccionD)=mysql_fetch_row(mysql_query("select direccion from tienda where cod_tienda='".$almacen_destino."'"));				
							
		
		$strSQL="select  max(cod_cab) as cod_cab from cab_mov";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$codigo=$row['cod_cab']+1;
				
		$doc='GR';
		$responsable=$_SESSION['codvendedor'];
		$auxiliar=$codclienteD;
		$femision=gmdate('Y-m-d H:i:s');
		$fvencimiento=gmdate('Y-m-d H:i:s');
		$moneda='01';
		$impto='18';
		$incluidoigv='S';
		
		if($sucursal_destino==$sucursalO){
		$condicion='3';
		}else{
		$condicion='36';
		}
		$dirPartida=$direccionO;
		$dirDestino=$direccionD;
		
		$fecharegis="";
		$permiso4='S';
		$fecha_aud=gmdate('Y-m-d H:i:s');
		$permiso10='S';
		$tipomov='2';
		$deuda='N';
		
		
		
		//*********************crear cliente********************************
		
		if($codclienteD=='' || $codclienteD=='0' || $codclienteD=='undefined' ){
		$resultado3=mysql_query("select max(codcliente) as codigo from cliente",$cn);
			$row3=mysql_fetch_array($resultado3);
			
			$auxiliar=$row3['codigo'];
			$auxiliar=str_pad($auxiliar+1,6,'0',STR_PAD_LEFT);
			
			$t_persona='juridica';
			
			$razonsocial=$des_sucD; 				
			$strSQL2= "insert into cliente (codcliente,tipo_aux,razonsocial,ruc,telefono,nombres,apellidos,t_persona,doc_iden,direccion,email,contacto,cargo,baja,web,clas_clie,condicion,estado_percep,por_percep,lider,codlider,tipoprov,responsable,ubigeo) values ('".$auxiliar."','A','".$razonsocial."','".$rucSucD."','".$telefono."','".$nombres."' ,'".$apellidos."' ,'".$t_persona."' ,'".$doc_iden."' ,'".$direccion."' ,'".$email."' ,'".$contacto."','".$cargo."','".$baja."','".$web."','".$clas_clie."','".$condicion."','".$estado_percep."','".$por_percep."','".$lider."','".$codlider."','".$tipoprov."','".$responsable."','".$idubigeo."')";
				
			mysql_query($strSQL2);
		}else{
		
		$srtUDT="update cliente set tipo_aux='A' where codcliente='".$auxiliar."'";		
		mysql_query($srtUDT,$cn);
				
		}
		
		//*-*************************************************************
		
		$strSQL3="insert into cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,caja,cliente,ruc,fecha,f_venc,moneda,impto1,tc,b_imp,igv,servicio,percepcion,total,saldo,tienda,sucursal,flag,flag_r,motivo,noperacion,items,condicion,incluidoigv,obs1,obs2,obs3,obs4,obs5,inafecto,fecha_aud,pc,kardex,deuda,transportista,chofer,dirPartida,dirDestino,numeroOT,fecharegis,flete,puntos,tipoDesc,estadoOT)values('".$codigo."','".$tipomov."','".$doc."','".$numero."','".$serie."','".$responsable."','".$caja."','".$auxiliar."','".$ruc."','".$femision."','".$fvencimiento."','".$moneda."','".$impto."','".$_SESSION['tc']."','".$monto."','".$impuesto1."','".$servicio."','".$percepcion."','".$total_doc."','".$saldo."','".$tiendaO."','".$sucursalO."','".$flag."','".$flag_r."','".$motivo."','".$noperacion."','".$items."','".$condicion."','".$incluidoigv."','".$obs1."','".$obs2."','".$obs3."','".$obs4."','".$obs5."','".$permiso4."','".$fecha_aud."','".$_SESSION['pc_ingreso']."','".$permiso10."','".$deuda."','".$transportista."','".$chofer."','".$dirPartida."','".$dirDestino."','".$serieOT."-".$numeroOT."','".$fecharegis."','".$_SESSION['montoFlete']."','".$_SESSION['totalPuntosDoc']."','".$tipoDescuento."','A')";
		 		
		mysql_query($strSQL3,$cn);
		
		
		//--------------------------------
		
		
				$strSQL2="select  max(id) as id from tempdoc";
				$resultado2=mysql_query($strSQL2,$cn);
				$row2=mysql_fetch_array($resultado2);
				
				$id=$row2['id']+1;
				//$estado="R";
				//$strSQL3="DELETE FROM tempdoc WHERE estado='R' and doc='".$doc."' and tipodoc='".$tipomov."' and  serie='".$serie."' ";
				//mysql_query($strSQL3,$cn);				
				$strSQL3="insert into tempdoc(id,sucursal,tipodoc,doc,serie,numero,auxiliar,estado,usuario)values('".$id."','".$sucursal_destino."','2','".$doc."','".$serie."','".$numero."','".$auxiliar."','G','".$_SESSION['codvendedor']."')";
				mysql_query($strSQL3,$cn);	
		
		//-------------------------------
	
		
	//-------------------------------detalle----------------------------------
		
	$acumCant=explode("|",$_REQUEST['acumCant']);
	$acumCod=explode("|",$_REQUEST['acumCod']);
	
	for($i=1;$i<count($acumCant);$i++){
								
				list($und,$nomprod,$kardex_pro,$afecto)=mysql_fetch_row(mysql_query("select und,nombre,kardex,igv from producto where idproducto='".$acumCod[$i]."'"));		
				
				
				$precioprod=0;
				$imp_item=$precioprod*$acumCant[$i];
				
				  $strSQL444="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,tcambio,moneda,precio,cantidad,imp_item,fechad,descargo,afectoigv,costo_inven,saldo_actual,notas,flag_kardex,unidad,flag_percep,porcen_percep,ancho,largo,mt2,factor,descOT,codanex,desc1,desc2,puntos,envases) values('".$codigo."','".$tipomov."','".$doc."','".$serie."','".$numero."','".$auxiliar."','".$tiendaO."','".$sucursalO."','".$acumCod[$i]."','".addslashes($nomprod)."','".$tc."','".$moneda."','".$precioprod."','".$acumCant[$i]."','".number_format($imp_item,2,'.','')."','".$femision."','".$kardex_pro."','".$afecto."','".number_format($costo_inven1,2)."','".$saldo_actual."','','".$tipomov."','".$und."','".$flag_percep."','".$porcen_percep_det."','','','','','','','".$desc1."','".$desc2."','".$puntos."','".$envases."')"; 
		  	  
		   	mysql_query($strSQL444,$cn);	
			
			//echo $strSQL444;
			
			 $campo="saldo".$tiendaO;
			 $strSQL40="update producto set $campo=$campo-".$acumCant[$i]." where idproducto='".$acumCod[$i]."' ";
			 mysql_query($strSQL40,$cn);
			
			$strSQL401="update det_mov set cantdesp=cantdesp+'".$acumCant[$i]."' where cod_prod='".$acumCod[$i]."' and cod_cab='".$cod_cab_doc."' ";
			mysql_query($strSQL401,$cn);
							
	}		
	
		$strSQL0025="select  max(id) as id from referencia";
		$resultado0025=mysql_query($strSQL0025,$cn);
		$row0025=mysql_fetch_array($resultado0025);
		$codigo_ref=$row0025['id']+1;
		
		$strSQL_ref="insert into referencia (id,cod_cab,serie,correlativo,cod_cab_ref)values('".$codigo_ref."','".$codigo."','".$serie."','".$numero."','".$cod_cab_doc."')";	
		mysql_query($strSQL_ref,$cn);
		//$flag_r="RA";
	
		$strSQL_ref2="update cab_mov set flag_r='RA' where cod_cab='".$cod_cab_doc."'";
		mysql_query($strSQL_ref2);
		
		$strSQL_ref2="update cab_mov set items='".(count($acumCant)-1)."' where cod_cab='".$codigo."'";
		mysql_query($strSQL_ref2,$cn);
		
		
	//*********************************parte   GR ingreso********************************************************
	
	/*
			 	list($sucursalO,$tiendaO)=mysql_fetch_row(mysql_query("select sucursal,tienda from cab_mov where cod_cab='".$cod_cab_doc."'"));
		
			$strSQL="select max(Num_doc) as Num_do from cab_mov where tipo='2' and  sucursal='$almacen_destino' and cod_ope='GR' and serie='".str_pad($serieDocOrigen,3, "0", STR_PAD_LEFT)."' ";
		 //echo $strSQL;
			$resultado=mysql_query($strSQL,$cn);
			$row2=mysql_fetch_array($resultado);
				
				$serie=str_pad($serieDocOrigen,3,"0", STR_PAD_LEFT);
				$numero=str_pad($row2['Num_do']+1,7,"0", STR_PAD_LEFT);
				
				
				 list($rucSucO)=mysql_fetch_row(mysql_query("select ruc from sucursal where cod_suc='".$sucursalO."'"));
												 
				 list($direccionO)=mysql_fetch_row(mysql_query("select direccion from tienda where cod_tienda='".$tiendaO."'"));			
		
		
		*/
				
				//list($rucSucO)=mysql_fetch_row(mysql_query("select ruc from sucursal where cod_suc='".$sucursalO."'"));
				 list($rucSucO,$des_sucD)=mysql_fetch_row(mysql_query("select ruc,des_suc from sucursal where cod_suc='".$sucursalO."'"));
				
				list($codclienteO)=mysql_fetch_row(mysql_query("select codcliente from cliente where ruc='".$rucSucO."'"));
				list($direccionD)=mysql_fetch_row(mysql_query("select direccion from tienda where cod_tienda='".$almacen_destino."'"));				
				
				list($direccionO)=mysql_fetch_row(mysql_query("select direccion from tienda where cod_tienda='".$tiendaO."'"));	
							
		
		$strSQL="select  max(cod_cab) as cod_cab from cab_mov";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$codigo=$row['cod_cab']+1;
				
		$doc='GR';
		$responsable=$_SESSION['codvendedor'];
		$auxiliar=$codclienteO;
		$femision=gmdate('Y-m-d H:i:s');
		$fvencimiento=gmdate('Y-m-d H:i:s');
		$moneda='01';
		$impto='18';
		$incluidoigv='S';
		
		if($sucursal_destino==$sucursalO){
		$condicion='3';		
		}else{
		$condicion='36';
		}
		
		$dirPartida=$direccionO;
		$dirDestino=$direccionD;
		
		$fecharegis="";
		$permiso4='S';
		$fecha_aud=gmdate('Y-m-d H:i:s');
		$permiso10='N';
		$tipomov='1';
		$deuda='N';
		
		
		//*********************crear cliente********************************
		
		if($codclienteO=='' || $codclienteO=='0' || $codclienteO=='undefined' ){
		$resultado3=mysql_query("select max(codcliente) as codigo from cliente",$cn);
			$row3=mysql_fetch_array($resultado3);
			
			$auxiliar=$row3['codigo'];
			$auxiliar=str_pad($auxiliar+1,6,'0',STR_PAD_LEFT);
			
			$razonsocial=$des_sucD;
			$t_persona='juridica';
			 				
			$strSQL2= "insert into cliente (codcliente,tipo_aux,razonsocial,ruc,telefono,nombres,apellidos,t_persona,doc_iden,direccion,email,contacto,cargo,baja,web,clas_clie,condicion,estado_percep,por_percep,lider,codlider,tipoprov,responsable,ubigeo) values ('".$auxiliar."','A','".$razonsocial."','".$rucSucO."','".$telefono."','".$nombres."' ,'".$apellidos."' ,'".$t_persona."' ,'".$doc_iden."' ,'".$direccion."' ,'".$email."' ,'".$contacto."','".$cargo."','".$baja."','".$web."','".$clas_clie."','".$condicion."','".$estado_percep."','".$por_percep."','".$lider."','".$codlider."','".$tipoprov."','".$responsable."','".$idubigeo."')";
				
			mysql_query($strSQL2);
		}else{
		
		$srtUDT="update cliente set tipo_aux='A' where codcliente='".$auxiliar."'";		
		mysql_query($srtUDT,$cn);
		}
		
		
		
				
		//**************************************************************
		
		
		$strSQL3="insert into cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,caja,cliente,ruc,fecha,f_venc,moneda,impto1,tc,b_imp,igv,servicio,percepcion,total,saldo,tienda,sucursal,flag,flag_r,motivo,noperacion,items,condicion,incluidoigv,obs1,obs2,obs3,obs4,obs5,inafecto,fecha_aud,pc,kardex,deuda,transportista,chofer,dirPartida,dirDestino,numeroOT,fecharegis,flete,puntos,tipoDesc,estadoOT)values('".$codigo."','".$tipomov."','".$doc."','".$numero."','".$serie."','".$responsable."','".$caja."','".$auxiliar."','".$ruc."','".$femision."','".$fvencimiento."','".$moneda."','".$impto."','".$_SESSION['tc']."','".$monto."','".$impuesto1."','".$servicio."','".$percepcion."','".$total_doc."','".$saldo."','".$almacen_destino."','".$sucursal_destino."','".$flag."','".$flag_r."','".$motivo."','".$noperacion."','".$items."','".$condicion."','".$incluidoigv."','".$obs1."','".$obs2."','".$obs3."','".$obs4."','".$obs5."','".$permiso4."','".$fecha_aud."','".$_SESSION['pc_ingreso']."','".$permiso10."','".$deuda."','".$transportista."','".$chofer."','".$dirPartida."','".$dirDestino."','".$serieOT."-".$numeroOT."','".$fecharegis."','".$_SESSION['montoFlete']."','".$_SESSION['totalPuntosDoc']."','".$tipoDescuento."','P')";
		 		
		mysql_query($strSQL3,$cn);
	
		
		//--------------------------------
		
		
				$strSQL2="select  max(id) as id from tempdoc";
				$resultado2=mysql_query($strSQL2,$cn);
				$row2=mysql_fetch_array($resultado2);
				
				$id=$row2['id']+1;
				//$estado="R";
				//$strSQL3="DELETE FROM tempdoc WHERE estado='R' and doc='".$doc."' and tipodoc='".$tipomov."' and  serie='".$serie."' ";
				//mysql_query($strSQL3,$cn);				
				$strSQL3="insert into tempdoc(id,sucursal,tipodoc,doc,serie,numero,auxiliar,estado,usuario)values('".$id."','".$sucursal_destino."','1','".$doc."','".$serie."','".$numero."','".$auxiliar."','G','".$_SESSION['codvendedor']."')";
				mysql_query($strSQL3,$cn);	
		
		//-------------------------------
		
		
		
		
		
	//-------------------------------detalle----------------------------------
		
	//$acumCant=explode("|",$_REQUEST['acumCant']);
	//$acumCod=explode("|",$_REQUEST['acumCod']);
	
	for($i=1;$i<count($acumCant);$i++){
								
				list($und,$nomprod,$kardex_pro,$afecto)=mysql_fetch_row(mysql_query("select und,nombre,kardex,igv from producto where idproducto='".$acumCod[$i]."'"));		
				
				
				$precioprod=0;
				$imp_item=$precioprod*$acumCant[$i];
				
				  $strSQL444="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,tcambio,moneda,precio,cantidad,imp_item,fechad,descargo,afectoigv,costo_inven,saldo_actual,notas,flag_kardex,unidad,flag_percep,porcen_percep,ancho,largo,mt2,factor,descOT,codanex,desc1,desc2,puntos,envases) values('".$codigo."','".$tipomov."','".$doc."','".$serie."','".$numero."','".$auxiliar."','".$almacen_destino."','".$sucursal_destino."','".$acumCod[$i]."','".addslashes($nomprod)."','".$tc."','".$moneda."','".$precioprod."','".$acumCant[$i]."','".number_format($imp_item,2,'.','')."','".$femision."','".$kardex_pro."','".$afecto."','".number_format($costo_inven1,2)."','".$saldo_actual."','','".$tipomov."','".$und."','".$flag_percep."','".$porcen_percep_det."','','','','','','','".$desc1."','".$desc2."','".$puntos."','".$envases."')"; 
		  	  
		   	mysql_query($strSQL444,$cn);	
			
			//echo $strSQL444;
			
			// $campo="saldo".$tienda;
			// $strSQL40="update producto set $campo=$campo-".$acumCant[$i]." where idproducto='".$acumCod[$i]."' ";
			 //mysql_query($strSQL40,$cn);
			
			//$strSQL401="update det_mov set cantdesp=cantdesp+'".$acumCant[$i]."' where cod_prod='".$acumCod[$i]."' and cod_cab='".cod_cab_doc."' ";
			//mysql_query($strSQL401,$cn);
							
	}		
	
		$strSQL_ref2="update cab_mov set items='".(count($acumCant)-1)."' where cod_cab='".$codigo."'";
		mysql_query($strSQL_ref2,$cn);
				
	//---------------------------------------------------------------------------
		
	
	break;
	
	
	case "genNumero":
	
	
	$serieDocOrigen=$_REQUEST['serieDocOrigen'];
	$cod_suc_origen=$_REQUEST['cod_suc_origen'];
	
	
	 $strSQL="select max(Num_doc) as Num_doc from cab_mov where tipo='2' and  sucursal='".$cod_suc_origen."' and cod_ope='GR' and serie='".str_pad($serieDocOrigen,3, "0", STR_PAD_LEFT)."' ";
	 
	    $resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		
		
		
		$cadena=str_pad($row['Num_doc']+1,7, "0", STR_PAD_LEFT);
		
		echo $cadena;
	
	break;
	
	
	case "validarNumero":
	
	
	$serieDocOrigen=$_REQUEST['serieDocOrigen'];
	$cod_suc_origen=$_REQUEST['cod_suc_origen'];
	
	$numeroDocOrigen=$_REQUEST['numeroDocOrigen'];
	
	 $strSQL="select * from cab_mov where tipo='2' and  sucursal='".$cod_suc_origen."' and cod_ope='GR' and serie='".str_pad($serieDocOrigen,3, "0", STR_PAD_LEFT)."' and  Num_doc='".str_pad($numeroDocOrigen,7, "0", STR_PAD_LEFT)."' ";
	 
	    $resultado=mysql_query($strSQL,$cn);
		$contReg=mysql_num_rows($resultado);
			
		echo $contReg;
	
	break;
	
	case "aprobarGuiasIng":
	
	
	$codigoDoc=$_REQUEST['criterio'];
	
					$strSQL3="select * from det_mov where cod_cab='$codigoDoc' ";
					$resultado3=mysql_query($strSQL3,$cn);
					while($row3=mysql_fetch_array($resultado3)){
								
					
					$campo="saldo".$row3['tienda'];
					$strSQL40="update producto set $campo=$campo+".$row3['cantidad']." where idproducto='".$row3['cod_prod']."' ";
			  	    mysql_query($strSQL40,$cn);
					//echo $strSQL40;
					}
					
					
					$strSQL41="update cab_mov set kardex='S', estadoOT='A' where cod_cab='".$codigoDoc."'";
					mysql_query($strSQL41,$cn);
					
					//echo " ".$strSQL41; 
	
	
	break;
	
	case "auditaDoc":
	
	
		$strSQL41="update cab_mov set audita='".$_REQUEST['estado']."' where cod_cab='".$_REQUEST['referencia']."'";
		mysql_query($strSQL41,$cn);
		
		
	break;
	
	
	case "cuentasDeudas":
	
	$tcambioProg=$_REQUEST["tcambioProg"];
	$monedaCuenta=$_REQUEST["monedaCuenta"];
	
	if($monedaCuenta=='02'){
	$titMon=" US$ ";
	}else{
	$titMon=" S/. ";
	}
	
	?>
	
	<table width="557" height="68" border="0" cellpadding="0" cellspacing="1">
                <tr>
                  <td width="28" height="23" bgcolor="#0099CC"><span class="Estilo22 Estilo6">Alm</span></td>
                  <td width="25" bgcolor="#0099CC"><span class="Estilo22 Estilo6">Td</span></td>
                  <td width="65" bgcolor="#0099CC"><span class="Estilo22 Estilo6">Numero</span></td>
                  <td width="71" bgcolor="#0099CC"><span class="Estilo22 Estilo6">Fecha Vcto </span></td>
                  <td width="34" bgcolor="#0099CC"><span class="Estilo22 Estilo6">Mon</span></td>
                  <td width="51" bgcolor="#0099CC"><span class="Estilo22 Estilo6">Deuda</span></td>
                  <td width="62" bgcolor="#0099CC"><span class="Estilo22 Estilo6">Programado</span></td>
                  <td width="57" align="center" bgcolor="#0099CC"><span class="Estilo22 Estilo6">En  (<?php echo $titMon; ?>) </span></td>
                  <td width="57" bgcolor="#0099CC"><span class="Estilo22 Estilo6">Acuenta</span></td>
                  <td width="43" bgcolor="#0099CC"><span class="Estilo22 Estilo6">Saldo</span></td>
                  <td width="52" bgcolor="#0099CC"><span class="Estilo22 Estilo6">Acci&oacute;n</span></td>
                </tr>
                <?php 
			
			$strSQL="select * from cab_mov where saldo > 0 and tipo='1' and flag!='S' and sucursal='".$_REQUEST['sucursal']."' and cliente='".$_REQUEST['proveedor']."'";
			//echo $strSQL;
			$resultado=mysql_query($strSQL,$cn);
			$i=0;
			while($row=mysql_fetch_array($resultado)){
			
			
			$resultado3=mysql_query("select mon_ac,acuenta,saldo,tc from progpagos_det p2,progpagos p1 where p1.id=id_progpagos and cod_cab='".$row['cod_cab']."' ");	
					
			$cont=mysql_num_rows($resultado3);		
			list($mon_ac,$acuenta,$saldo,$tc)=mysql_fetch_row($resultado3);
			//echo $cont;
			
			
						
			if($saldo==0 && $cont>0){
				continue;		
			}else{
			
			
				if($row['moneda']==$mon_ac){
				
				$montoProgra=$acuenta;
				}else{
				
					if($row['moneda']=='01'){
					$montoProgra=number_format($acuenta*$tc,2,'.','');					
					}else{
					$montoProgra=number_format($acuenta/$tc,2,'.','');
					}
				
				}
			
			}
			
			 $deudaTemp=$row['saldo']-$montoProgra;
			 
			if($montoProgra==0){ $montoProgra=""; }		
			
			?>
                <tr>
                  <td><span class="EstiloDetPagos"><?php echo $row['tienda']?></span></td>
                  <td><span class="EstiloDetPagos"><?php echo $row['cod_ope']?>
				  <input name="cod_ope[]" type="hidden" id="cod_ope" size="6" readonly="" style="font-size:11px; text-align:right" value="<?php echo $row['cod_ope']; ?>" />
				  </span></td>
                  <td><span class="EstiloDetPagos"><?php echo $row['serie'].$row['Num_doc']?></span>
				  <input name="serie[]" type="hidden" id="serie" size="6" readonly="" style="font-size:11px; text-align:right" value="<?php echo $row['serie']; ?>" />
				  <input name="numeroDoc[]" type="hidden" id="numeroDoc" size="6" readonly="" style="font-size:11px; text-align:right" value="<?php echo $row['Num_doc']; ?>" />
				  </td>
                  <td><span class="EstiloDetPagos"><?php echo substr($row['f_venc'],0,10)?></span></td>
                  <td align="center"><span class="EstiloDetPagos"><?php 
				  
				  if($row['moneda']=='01')echo "S/."; else echo "US$.";
				  
				  ?></span>
				  <input name="mon_doc[]" type="hidden" id="mon_doc" size="6" readonly="" style="font-size:11px; text-align:right" value="<?php echo $row['moneda']; ?>" />
				  
				  </td>
                  <td align="right"><span class="EstiloDetPagos"><?php echo number_format($row['saldo'],2)?></span>
				  <input name="deuda[]" type="hidden" id="deuda" size="6" readonly="" style="font-size:11px; text-align:right" value="<?php echo number_format($row['saldo'],2,'.',''); ?>" />
				  
				  </td>
                  <td align="right"><span class="EstiloDetPagos">
                    <input name="cod_cab[]" type="hidden" id="cod_cab" size="6" readonly="" style="font-size:11px; text-align:right" value="<?php echo $row['cod_cab']; ?>" />
					<span style="color:#FF0000"><?php echo $montoProgra?></span>
                  </span></td>
                  <td align="center"><span class="EstiloDetPagos">
				  
				  <?php 
				  
				  
				 
				  
				  if($row['moneda']==$monedaCuenta){
				  
				  $conversion=$deudaTemp;				  
				  
				  }else{
				  
					  if($monedaCuenta=='01'){					  
					   $conversion=number_format($deudaTemp*$tcambioProg,2,'.','');					  				  
					  }else{					  
					   $conversion=number_format($deudaTemp/$tcambioProg,2,'.','');					  
					  }
				  
				  }
				  
				  ?>
				  
				  
                    <input name="convert[]" type="text" id="convert" size="6" readonly="" style="font-size:11px; text-align:right" value="<?php echo $conversion; ?>">
					
                  </span></td>
                  <td align="center"><input name="acuenta[]" type="text" id="acuenta" size="6" readonly="" style="font-size:11px; text-align:right"  /></td>
                  <td align="center"><input name="saldo[]" type="text" id="saldo" size="6" readonly="" style="font-size:11px; text-align:right"></td>
                  <td align="center"><span class="EstiloDetPagos">
				  <img <?php echo $disabled_audita; ?> style="cursor:pointer" src="../imagenes/revisado.png" width="20" height="21" alt=" Cancelar " onclick="cancelar(this,'<?php echo $conversion; ?>','<?php echo $i; ?>')" />
				  <img <?php echo $disabled_audita; ?> style="cursor:pointer" src="../imagenes/porrevisar.png" width="20" height="21" alt=" Por revisar " onclick="descancelar(this,'<?php echo $conversion; ?>','<?php echo $i; ?>')" /></span></td>
                </tr>
                <?php 
				
				$i++; 
				} 
				?>
</table>
	
	<?php 
		
		
	break;
	
	
	case "numeroCheque":
	
	
	$strSQL="select max(numero) as numero,tipo from progpagos where cuenta='".$_REQUEST['cta_banco']."' and sucursal='".$_REQUEST['sucursal']."' group by tipo ";
	
	//echo $strSQL;
	$resultado=mysql_query($strSQL);
	//$contx=mysql_num_rows($resultado);
	$row=mysql_fetch_array($resultado);
	$numero=str_pad($row['numero']+1,11,"0",STR_PAD_LEFT);
	$tipo_pago=$row['tipo'];
	
	//echo $contx;
	if($row['numero']!=''){
	
	$strSQL="select * from chequera where sucursal='".$_REQUEST['sucursal']."' and cta_id='".$_REQUEST['cta_banco']."' and num_ini<='".$numero."' and num_fin>='".$numero."'  and estado='A'";
	
	//echo $strSQL;
	$resultado=mysql_query($strSQL,$cn);
	$cont=mysql_num_rows($resultado);
	$tipo_pago=$row['tipo'];
	
	
	}else{
	
	$strSQL="select * from chequera where sucursal='".$_REQUEST['sucursal']."' and cta_id='".$_REQUEST['cta_banco']."'  and estado='A' order by num_ini desc";
	$resultado=mysql_query($strSQL,$cn);
	$cont=mysql_num_rows($resultado);
	$row=mysql_fetch_array($resultado);
	$numero=str_pad($row['num_ini'],11,"0",STR_PAD_LEFT);
	$tipo_pago=$row['tipo'];
	
	}
	
	if($cont>0){
	echo $numero."|".$tipo_pago;
	}else{
	echo "";
	}		
	
	break;
	
	
	case "anularCheque":
	
	$strSQL="update progpagos set estado='A' where id='".$_REQUEST['valor']."'";
	mysql_query($strSQL,$cn);	
	//echo $strSQL;
		
	break;
		
	case "eliminarCheque":
	
	$strSQL="delete from progpagos where id='".$_REQUEST['valor']."'";
	mysql_query($strSQL,$cn);	
	//echo $strSQL;
	
	$strSQL="delete from progpagos_det where id_progpagos='".$_REQUEST['valor']."'";
	mysql_query($strSQL,$cn);
			
	break;
	
	
	case "validarNumCheque":
	
	
	$numero=$_REQUEST['numero'];
	
	
	$strSQL="select * from chequera where sucursal='".$_REQUEST['sucursal']."' and cta_id='".$_REQUEST['cta_banco']."' and num_ini<='".$numero."' and num_fin>='".$numero."'  and estado='A'";
	
	$resultado=mysql_query($strSQL,$cn);
	$cont=mysql_num_rows($resultado);
	//echo $strSQL;
	
	$strSQL="select * from progpagos where cuenta='".$_REQUEST['cta_banco']."' and sucursal='".$_REQUEST['sucursal']."' and numero='".$numero."' ";
	$resultado=mysql_query($strSQL);
	$contx=mysql_num_rows($resultado);
		
		if($cont>0 && $contx==0){	
		echo "S";
		}else{
		echo "N";
		}	
			
	break;
	
	case "cambiarEstado":
	
	$id=$_REQUEST['id'];
	$estado=$_REQUEST['estado'];		
	$strSQL="update progpagos set estado='".$estado."' where id='".$id."'"; 
	$resultado=mysql_query($strSQL);
	
	
	$strSQLx="select p2.*,p1.* from progpagos_det p2,progpagos p1 where p1.id=id_progpagos and id_progpagos='".$id."' ";
	$resultadox=mysql_query($strSQLx,$cn);
	
	while($rowx=mysql_fetch_array($resultadox)){
	
		if($estado=='T'){
		
		 $strSQL_pagos="select max(id) as id from pagos";
		 $resultado_pagos=mysql_query($strSQL_pagos,$cn);
		 $row_pagos=mysql_fetch_array($resultado_pagos);
		 $id_pagos=str_pad($row_pagos['id']+1, 6, "0", STR_PAD_LEFT);
				
		$fechaPago=$rowx['fechavenc'];
		$montoPagos=$rowx['acuenta'];
		$monedaPagos=$rowx['mon_ac'];
		$fecha_aud=date('Y-m-d h:i:s');
		$tpago=$rowx['tipo'];
		$tcPagos=$rowx['tc'];
		$codigo=$rowx['cod_cab'];
		
		$fechaGiro=$rowx['fechavenc'];
		$fechaVenc=$rowx['fecha2'];
				
		$strSQ_pagos3="insert into pagos(id,t_pago,fecha,fechav,monto,moneda,fechap,tcambio,referencia,vuelto,moneda_v,pc,cod_user) values ('".$id_pagos."','".$tpago."','".$fechaGiro."','".$fechaVenc."',".$montoPagos.",'".$monedaPagos."','".$fecha_aud."',".$tcPagos.",'".$codigo."','".$vuelto."','".$moneda_v."','".$_SESSION['pc_ingreso']."','".$_SESSION['codvendedor']."')";
		mysql_query($strSQ_pagos3,$cn);		
		
		}
		
		if($estado=='A'){
		
		$strSQL="delete from pagos where referencia='".$rowx['cod_cab']."'";
		mysql_query($strSQL,$cn);
				
		}	
				
	}		
			
	break;
	
	
	
	}
			   	
?>