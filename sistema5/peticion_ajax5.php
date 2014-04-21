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
	$codigoPC=$_REQUEST['codigoPC'];
	
	$margen=0;
	//$strSQL= "select * from formatos where doc='".$_REQUEST['doc']."' and habilitar='S'  and sucursal='".$sucursal."' " ;
	$strSQL= "select * from formatos where doc='".$_REQUEST['doc']."' and tipo='".$_REQUEST['tipo']."' and habilitar='S'  and sucursal='".$sucursal."' and pc='".$codigoPC."' " ;
	//echo $strSQL;
	$resultado = mysql_query ($strSQL,$cn);
	while($row = mysql_fetch_array ($resultado)){
	
	echo "<div class='ui-widget-content' id='".$row['descripcion']."' style='border:#333333 solid 1px;width:".$row['ancho'].";height:".$row['alto']."; top:".$row['coordy']."; left:".($margen+$row['coordx'])."; position: absolute; cursor:move' onMouseMove='controlDiv(this)' onmousedown='entrarDiv(this)' onmouseup='salirDiv(this)'  ondblclick='selecDiv(this)' >".$row['descripcion']."</div>";
	//onMouseMove='moverDiv(this)'
	
	$ids=$ids."-".$row['descripcion'];
	$fontsize1=$row['fontsize'];
	$alturaDoc=$row['altura'];
	$fuente=$row['fuente'];
	$separacion=$row['separacion'];
	$anchoDoc=$row['anchodoc'];
	$alturaItems=$row['alturaItems'];
	$decimales=$row['decimales'];
	
	}
	
	echo "|". $ids."|".$fontsize1."|".$alturaDoc."|".$fuente."|".$separacion."|".$anchoDoc."|".$alturaItems."|".$decimales."|";
	?>
	
	  <table  width="148" border="0" cellspacing="1" cellpadding="0"   >
            <tr>
              <td width="27" align="center" bgcolor="#66CCCC"><span class="Estilo2">ok</span></td>
              <td width="121" bgcolor="#66CCCC"><span class="Estilo2">Nombre</span></td>
            </tr>
			
			<?php 
			//$resultados10 = mysql_query("select * from formatos where doc='".$_REQUEST['doc']."' and sucursal='".$sucursal."' order by descripcion ",$cn); 
			$resultados10 = mysql_query("select * from formatos where doc='".$_REQUEST['doc']."' and tipo='".$_REQUEST['tipo']."' and sucursal='".$sucursal."' and pc='".$codigoPC."' order by descripcion ",$cn); 
			//echo "select * from formatos where doc='".$_REQUEST['doc']."' and tipo='".$_REQUEST['tipo']."' and sucursal='".$sucursal."' and pc='".$codigoPC."' order by descripcion ";
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
	///Agregado GMY
	$tipo=$_REQUEST['tipo'];
	///////////////
	$doc=$_REQUEST['doc'];
	$sucursal=$_REQUEST['sucursal'];
	$acumulador=$_REQUEST['cadena1'].$_REQUEST['cadena2'].$_REQUEST['cadena3'].$_REQUEST['cadena4'].$_REQUEST['cadena5'];
	$fontsize1=$_REQUEST['fontsize1'];
	$alturaDoc=$_REQUEST['alturaDoc'];
	$fuente=$_REQUEST['fuente'];
	$separacion=$_REQUEST['separacion'];
	$anchoDoc=$_REQUEST['anchoDoc'];
	$alturaItems=$_REQUEST['alturaItems'];
	$acumulador3=$_REQUEST['acumulador3'];
	$camponew=$_REQUEST['camponew'];
	
	$codigoPC=$_REQUEST['codigoPC'];
	$decimales=$_REQUEST['decimales'];
		
	//$temp0=explode("~",$acumulador);	
	$temp=explode("|",$acumulador);	
	
	if($camponew!=''){

	$strSQL= "select * from formatos where doc='".$_REQUEST['doc']."' and tipo='".$_REQUEST['tipo']."'  and sucursal='".$sucursal."' and pc='".$codigoPC."' and  descripcion='".$camponew."'" ;
	//echo $strSQL;
	$resultado = mysql_query ($strSQL,$cn);
	$cont=mysql_num_rows($resultado);
	
	if($cont>0){
	echo "existe";
	die();
	}

	$strSQLInsert="insert into formatos(tipo,doc,descripcion,coordx,coordy,alto,ancho,habilitar,sucursal,fontsize,altura,pc)values ('".$_REQUEST['tipo']."','".$doc."','".$camponew."','10','10','10','10','N','".$sucursal."','".$fontsize1."','".$alturaDoc."','".$_REQUEST['codigoPC']."')";
	
	//echo $strSQLInsert;
	
	mysql_query($strSQLInsert,$cn);	

	}
	
		
	$strsSQL="update formatos set habilitar ='N',fontsize='".$fontsize1."',altura='".$alturaDoc."',fuente='".$fuente."',separacion='".$separacion."',anchodoc='".$anchoDoc."',alturaItems='".$alturaItems."',decimales='".$decimales."' where doc='".$doc."' and tipo='".$tipo."' and sucursal='".$sucursal."' and pc='".$codigoPC."' ";
			
	mysql_query($strsSQL,$cn);
			
	
		for($i=1;$i<count($temp);$i++){
		$temp2=explode("-",$temp[$i]);
		
		//$strsSQL="update formatos set coordx='".$temp2[1]."',coordy='".$temp2[2]."',ancho='".$temp2[3]."',alto='".$temp2[4]."' where doc='".$doc."' and descripcion='".$temp2[0]."' and sucursal='".$sucursal."'";
		$strsSQL="update formatos set habilitar ='S',coordx='".$temp2[1]."',coordy='".$temp2[2]."',ancho='".$temp2[3]."',alto='".$temp2[4]."' where doc='".$doc."' and descripcion='".$temp2[0]."' and tipo='".$tipo."' and sucursal='".$sucursal."' and pc='".$codigoPC."' ";
		
		//echo $strsSQL;
		
		mysql_query($strsSQL,$cn);
		
		}
		
	$tempx=explode("-",$temp0[1]);	
		
		//$strsSQL="update formatos set habilitar ='N',fontsize='".$fontsize1."',altura='".$alturaDoc."',fuente='".$fuente."',separacion='".$separacion."',anchodoc='".$anchoDoc."',alturaItems='".$alturaItems."' where doc='".$doc."'  and sucursal='".$sucursal."'";
		
		//echo count($tempx);
					
			$temp3=explode("|",$acumulador3);
			//echo count($temp3);
			for($i=1;$i<count($temp3);$i++){
			
			
			$strsSQL="update formatos set habilitar='S' where doc='".$doc."' and descripcion='".$temp3[$i]."' and tipo='".$tipo."' and sucursal='".$sucursal."' and pc='".$codigoPC."'";
			
			mysql_query($strsSQL,$cn);
			//echo $strsSQL;
			
			}
			
			//echo count($tempx);
		/*	
		if(count($tempx)>1){
			
					
			for($i=1;$i<count($tempx);$i++){				
			
			$strsSQL="update formatos set habilitar ='S' where descripcion='".$tempx[$i]."' and tipo='".$tipo."' and doc='".$doc."' and sucursal='".$sucursal."'";		
			mysql_query($strsSQL,$cn);
			
			//echo $strsSQL."<----->";
			
			}
		
		}else{
					
			for($i=1;$i<count($temp);$i++){
			$temp2=explode("-",$temp[$i]);
			
			$strsSQL="update formatos set habilitar='S' where doc='".$doc."' and descripcion='".$temp2[0]."' and tipo='".$tipo."' and sucursal='".$sucursal."'";
			
			mysql_query($strsSQL,$cn);
			echo $strsSQL;
			
			}
			
		}
		 */
		
	break;
	
	case "saveCopiaForm":
	
	$sucursal=$_REQUEST['sucursal'];
	$sucursal2=$_REQUEST['sucursal2'];	
	
	//$resultados10 = mysql_query("select * from formatos where doc='".$_REQUEST['doc']."' and sucursal='".$sucursal."' order by descripcion ",$cn); 
	$resultados10 = mysql_query("select * from formatos where doc='".$_REQUEST['doc']."' and tipo='".$_REQUEST['tipo']."' and sucursal='".$sucursal."' and pc='".$_REQUEST['codigoPC']."' order by descripcion ",$cn); 
			while($row10=mysql_fetch_array($resultados10))
			{
			
			$strSQL="insert into formatos(tipo,doc,descripcion,coordx,coordy,alto,ancho,habilitar,sucursal,fontsize,altura,pc)values ('".$_REQUEST['tipo2']."','".$_REQUEST['doc2']."','".$row10['descripcion']."','".$row10['coordx']."','".$row10['coordy']."','".$row10['alto']."','".$row10['ancho']."','".$row10['habilitar']."','".$sucursal2."','".$row10['fontsize']."','".$row10['altura']."','".$_REQUEST['codigoPC2']."')";
			
				mysql_query($strSQL,$cn);
			}
	
	
	break;
	
	case "eliminarForm":
		
		//$strSQL="delete from formatos where doc='".$_REQUEST['doc']."' and sucursal='".$_REQUEST['sucursal']."'";
		$strSQL="delete from formatos where doc='".$_REQUEST['doc']."' and sucursal='".$_REQUEST['sucursal']."' and tipo='".$_REQUEST['tipo']."' and pc='".$_REQUEST['codigoPC']."'";
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
	
	$valorProd=$_REQUEST['valorProd'];	
	$criterio=$_REQUEST['criterio'];	
			  	
	if(isset($_REQUEST['save'])){	
	$strSQL="insert into direc_aux(codcliente,direccion)values('".$valor."','".$nuevaDirec."')";
	mysql_query($strSQL,$cn);
	}
	
	if(isset($_REQUEST['eliminar'])){	
	$strSQL="delete from direc_aux where id='".$_REQUEST['codDirecElim']."'";
	mysql_query($strSQL,$cn);
	}
	
	if($valorProd!=''){
	
	if($criterio=="idproducto") $filtroProd=" and  cod_prod='".$valorProd."' ";
	if($criterio=="cod_prod") $filtroProd=" and  codanex='".$valorProd."' ";
	if($criterio=="nombre") $filtroProd=" and  nom_prod like '%".$valorProd."%' ";	
	
	}
	
	if($sucursal=='0'){
	$filtroS=" ";
	}else{
	$filtroS= " and cm.sucursal='".$sucursal."' ";
	}
	
	if($tienda=='0'){
	$filtroT=" ";
	}else{
	$filtroT= " and cm.tienda='".$tienda."' ";
	}
	
	
	$filtroSerie=" ";		
	if($serie!=''){	
	$filtroSerie=" and cm.serie='".$serie."' "; 
	}
	
	$filtroNumero=" ";
	if($numero!=''){	
	$filtroNumero=" and Num_doc='".$numero."' "; 
	}
	
	
	$strSQL="select * from cab_mov cm,cliente c, det_mov d where substring(fecha,1,10) between '$fecha1' and '$fecha2' $filtroS $filtroT $filtroSerie $filtroNumero and   c.codcliente=cm.cliente and cm.tipo='1' and c.razonsocial like '%".$proveedor."%' and flag!='A' and cm.cod_cab=d.cod_cab $filtroProd  group by cm.cod_cab order by cm.fecha desc";
	
		
		//echo $strSQL;
	
		
		
	 ?>
	 
	 <table width="751" height="201" border="0" cellpadding="0" cellspacing="0" style="border:#8BB1F8 solid 1px;">
  
  <tr>
    <td width="4" height="175">&nbsp;</td>
    <!--
	
	<div  id="detalle_chofer" style="width:410px; height:150px; overflow-y:scroll">
	-->
    <td colspan="2" valign="top">
	
	<div  style="z-index:999; cursor:default" >
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
				
				
				if($row['flag_r']!=''){
				
				 list($contDoc)=mysql_fetch_row(mysql_query("select count(cod_cab) from referencia where cod_cab='".$row['cod_cab']."'"));
				
					if($contDoc>0){
					continue;
					}
				}
				
				 list($des_suc)=mysql_fetch_row(mysql_query("select des_suc from sucursal where cod_suc='".$row['sucursal']."'"));
				 
				  list($des_tienda)=mysql_fetch_row(mysql_query("select des_tienda from tienda where cod_tienda='".$row['tienda']."'"));
				
			?>
                        <tr bgcolor="<?php echo $bgcolor;?>" onClick="entrada2(this);cargarDetalle('<?php echo $row['cod_cab']?>','<?php echo $row['cod_ope']?>','<?php echo $row['sucursal'] ?>','<?php echo $des_suc?>','<?php echo $row['tienda'] ?>','<?php echo $des_tienda ?>');"  ondblclick="doc_det('<?php echo $row['cod_cab']; ?>');">
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
	
	unset($_SESSION['temp_series'][0]);
    unset($_SESSION['temp_series'][2]);
		
		$strSQL="select d.*,p.*,d.precio as preciop from det_mov d,producto p where d.cod_prod=p.idproducto and d.cod_cab='".$cod."' order by cod_det";
		
		//echo $strSQL;
		
		
		
		
	 ?>
	 
	 <table width="751" height="201" border="0" cellpadding="0" cellspacing="0" style="border:#8BB1F8 solid 1px;">
  
  <tr>
    <td width="4" height="175">&nbsp;</td>
    <!--
	
	<div  id="detalle_chofer" style="width:410px; height:150px; overflow-y:scroll">
	-->
    <td colspan="2" valign="top">
	
	<div  style="z-index:999; cursor:default" >
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
                           
                                      <input name='precioprod'  type='hidden' id='precioprod' size='10' maxlength='7'  value='<?php echo $row['preciop']?>' />
                           						  </td>
                          <td width="56" align="center" style="border-bottom:#E5E5E5 solid 1px; color:#333333; "><?php echo $row['cantdesp']?>
						  <input name='cantdesp'  type='hidden' id='cantdesp' size='10' maxlength='7'  value='<?php echo $row['cantdesp']?>' />						  </td>
                          <td width="48" align="center" style="border-bottom:#E5E5E5 solid 1px; color:#333333; "><?php echo $row['cantidad']-$row['cantdesp']?></td>
                          <td width="75" align="center" style="border-bottom:#E5E5E5 solid 1px; color:#333333; "><?php echo $row[$tsaldo]?>
                            <input name='cantstock'  type='hidden' id='cantstock' size='10' maxlength='7'  value='<?php echo $row[$tsaldo]?>' /></td>
                          <td width="50" align="center" style="border-bottom:#E5E5E5 solid 1px; text-align:right" >
						  
						 
						  
						  <?php 
					  if($row['series']=='S'){
					  $eventoValidar="";
					  $campoLectura="readonly";
					  $fondoCaja=" background:#F2F2F2; color:#666666 ";
					  }else{
					  $eventoValidar="validarCantFact(this,'".$row['series']."','".$row['idproducto']."')";
					  $campoLectura="";
					  $fondoCaja="";
					  }
						  
						  
						  if($row['factor']>1){?>
						  
						  <input name="cantFact" id="cantFact" type="text" size="3" maxlength="10"  style="text-align:right; <?php echo $fondoCaja; ?>" onblur="<?php echo $eventoValidar?>"  onkeydown="validarNumero2(this,event)" value="0" <?php echo $campoLectura ?> />				  													  
						  <?php }else{?>
						    <input name="cantFact" id="cantFact" type="text" size="3" maxlength="10"  style="text-align:right; <?php echo $fondoCaja; ?>" onblur="<?php echo $eventoValidar?>"  onkeydown="validarNumero3(this,event)" value="0" <?php echo $campoLectura?> />               
						  
						  <?php }?>						  </td>
                          <td width="17" align="center" style="border-bottom:#E5E5E5 solid 1px; text-align:right" >
						  
						    <?php 
						  if($row['series']=='S'){						  
					    ?>
						  <img  title=" Seleccionar Series " style="cursor:pointer" onclick="ventanaSeries('<?php echo $row['idproducto']?>','<?php echo ($i-1) ?>','<?php echo ($row['cantidad']-$row['cantdesp'])?>')" src="imgenes/ico_edit.gif" width="14" height="14" />  
						<?php } ?>						  </td>
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
				
		
			 	list($sucursalO,$tiendaO,$serie_ref,$numero_ref)=mysql_fetch_row(mysql_query("select sucursal,tienda,serie,Num_doc from cab_mov where cod_cab='".$cod_cab_doc."'"));
		
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
		
		$strSQL3="insert into cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,caja,cliente,ruc,fecha,f_venc,moneda,impto1,tc,b_imp,igv,servicio,percepcion,total,saldo,tienda,sucursal,flag,flag_r,motivo,noperacion,items,condicion,incluidoigv,obs1,obs2,obs3,obs4,obs5,inafecto,fecha_aud,pc,kardex,deuda,transportista,chofer,dirPartida,dirDestino,numeroOT,fecharegis,flete,puntos,tipoDesc,estadoOT,modulo)values('".$codigo."','".$tipomov."','".$doc."','".$numero."','".$serie."','".$responsable."','".$caja."','".$auxiliar."','".$ruc."','".$femision."','".$fvencimiento."','".$moneda."','".$impto."','".$_SESSION['tc']."','".$monto."','".$impuesto1."','".$servicio."','".$percepcion."','".$total_doc."','".$saldo."','".$tiendaO."','".$sucursalO."','".$flag."','".$flag_r."','".$motivo."','".$noperacion."','".$items."','".$condicion."','".$incluidoigv."','".$obs1."','".$obs2."','".$obs3."','".$obs4."','".$obs5."','".$permiso4."','".$fecha_aud."','".$_SESSION['pc_ingreso']."','".$permiso10."','".$deuda."','".$transportista."','".$chofer."','".$dirPartida."','".$dirDestino."','".$serieOT."-".$numeroOT."','".$fecharegis."','".$_SESSION['montoFlete']."','".$_SESSION['totalPuntosDoc']."','".$tipoDescuento."','A','2')";
		 		
		mysql_query($strSQL3,$cn);			
		
		//--------------------------------				
		
				$strSQL2="select  max(id) as id from tempdoc";
				$resultado2=mysql_query($strSQL2,$cn);
				$row2=mysql_fetch_array($resultado2);
				
				$id=$row2['id']+1;
				//$estado="R";
				//$strSQL3="DELETE FROM tempdoc WHERE estado='R' and doc='".$doc."' and tipodoc='".$tipomov."' and  serie='".$serie."' ";
				//mysql_query($strSQL3,$cn);				
				$strSQL3="insert into tempdoc(id,sucursal,tipodoc,doc,serie,numero,auxiliar,estado,usuario)values('".$id."','".$sucursalO."','2','".$doc."','".$serie."','".$numero."','".$auxiliar."','G','".$_SESSION['codvendedor']."')";
				mysql_query($strSQL3,$cn);	
		
		//-------------------------------
	
		
	//-------------------------------detalle----------------------------------
		
	$acumCant=explode("|",$_REQUEST['acumCant']);
	$acumCod=explode("|",$_REQUEST['acumCod']);
	$acumPrecio=explode("|",$_REQUEST['acumPrecio']);
	
	for($i=1;$i<count($acumCant);$i++){
								
				list($und,$nomprod,$kardex_pro,$afecto)=mysql_fetch_row(mysql_query("select und,nombre,kardex,igv from producto where idproducto='".$acumCod[$i]."'"));		
				
				
				$precioprod=0;
				$imp_item=$precioprod*$acumCant[$i];
				
				  $strSQL444="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,tcambio,moneda,precio,cantidad,imp_item,fechad,descargo,afectoigv,costo_inven,saldo_actual,notas,flag_kardex,unidad,flag_percep,porcen_percep,ancho,largo,mt2,factor,descOT,codanex,desc1,desc2,puntos,envases) values('".$codigo."','".$tipomov."','".$doc."','".$serie."','".$numero."','".$auxiliar."','".$tiendaO."','".$sucursalO."','".$acumCod[$i]."','".addslashes($nomprod)."','".$tc."','".$moneda."','".$precioprod."','".$acumCant[$i]."','".number_format($imp_item,2,'.','')."','".$femision."','".$kardex_pro."','".$afecto."','".number_format($costo_inven1,2)."','".$saldo_actual."','','".$tipomov."','".$und."','".$flag_percep."','".$porcen_percep_det."','','','','','','','".$desc1."','".$desc2."','".$puntos."','".$envases."')"; 
		  	  
		   	mysql_query($strSQL444,$cn);
			
			
			$salida=$codigo;
			if(isset($_SESSION['temp_series'][2])){
				foreach ($_SESSION['temp_series'][2] as $subkey2=> $subvalue2) {
									 
					if($subvalue2==$acumCod[$i]){
									
					$strSQL_series="update series set salida='".$salida."' where producto='".$acumCod[$i]."' and serie='".$_SESSION['temp_series'][0][$subkey2]."' and salida='' and tienda='".$tiendaO."' ";
									
					mysql_query($strSQL_series,$cn);
									
					}
				}	
			}	
				
			
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
		
		$strSQL_ref="insert into referencia (id,cod_cab,serie,correlativo,cod_cab_ref)values('".$codigo_ref."','".$codigo."','".$serie_ref."','".$numero_ref."','".$cod_cab_doc."')";
		mysql_query($strSQL_ref,$cn);
		//$flag_r="RA";
	
		$strSQL_ref2="update cab_mov set flag_r='RA' where cod_cab='".$cod_cab_doc."'";
		mysql_query($strSQL_ref2);
		
		$strSQL_ref2="update cab_mov set items='".(count($acumCant)-1)."' where cod_cab='".$codigo."'";
		mysql_query($strSQL_ref2,$cn);
		
		
		$serie_ref=$serie;
		$numero_ref=$numero;
		$cod_doc_ref=$codigo;
		
		
	//*********************************  PARTE   GR INGRESO ********************************************************
	
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
		$permiso10='S';
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
		
		$strSQL3="insert into cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,caja,cliente,ruc,fecha,f_venc,moneda,impto1,tc,b_imp,igv,servicio,percepcion,total,saldo,tienda,sucursal,flag,flag_r,motivo,noperacion,items,condicion,incluidoigv,obs1,obs2,obs3,obs4,obs5,inafecto,fecha_aud,pc,kardex,deuda,transportista,chofer,dirPartida,dirDestino,numeroOT,fecharegis,flete,puntos,tipoDesc,estadoOT,modulo)values('".$codigo."','".$tipomov."','".$doc."','".$numero."','".$serie."','".$responsable."','".$caja."','".$auxiliar."','".$ruc."','".$femision."','".$fvencimiento."','".$moneda."','".$impto."','".$_SESSION['tc']."','".$monto."','".$impuesto1."','".$servicio."','".$percepcion."','".$total_doc."','".$saldo."','".$almacen_destino."','".$sucursal_destino."','".$flag."','".$flag_r."','".$motivo."','".$noperacion."','".$items."','".$condicion."','".$incluidoigv."','".$obs1."','".$obs2."','".$obs3."','".$obs4."','".$obs5."','".$permiso4."','".$fecha_aud."','".$_SESSION['pc_ingreso']."','".$permiso10."','".$deuda."','".$transportista."','".$chofer."','".$dirPartida."','".$dirDestino."','".$serieOT."-".$numeroOT."','".$fecharegis."','".$_SESSION['montoFlete']."','".$_SESSION['totalPuntosDoc']."','".$tipoDescuento."','P','2')";
		 		
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
		
				
	//-------------------------------detalle----------------------------------
		
	//$acumCant=explode("|",$_REQUEST['acumCant']);
	//$acumCod=explode("|",$_REQUEST['acumCod']);
	
	for($i=1;$i<count($acumCant);$i++){
								
				list($und,$nomprod,$kardex_pro,$afecto)=mysql_fetch_row(mysql_query("select und,nombre,kardex,igv from producto where idproducto='".$acumCod[$i]."'"));		
				
				
				$precioprod=0;
				$imp_item=$precioprod*$acumCant[$i];
				
				  $strSQL444="insert into det_mov(cod_cab,tipo,cod_ope,serie,numero,auxiliar,tienda,sucursal,cod_prod,nom_prod,tcambio,moneda,precio,cantidad,imp_item,fechad,descargo,afectoigv,costo_inven,saldo_actual,notas,flag_kardex,unidad,flag_percep,porcen_percep,ancho,largo,mt2,factor,descOT,codanex,desc1,desc2,puntos,envases) values('".$codigo."','".$tipomov."','".$doc."','".$serie."','".$numero."','".$auxiliar."','".$almacen_destino."','".$sucursal_destino."','".$acumCod[$i]."','".addslashes($nomprod)."','".$tc."','".$moneda."','".$acumPrecio[$i]."','".$acumCant[$i]."','".number_format($imp_item,2,'.','')."','".$femision."','".$kardex_pro."','".$afecto."','".number_format($costo_inven1,2)."','".$saldo_actual."','','".$tipomov."','".$und."','".$flag_percep."','".$porcen_percep_det."','','','','','','','".$desc1."','".$desc2."','".$puntos."','".$envases."')"; 
		  	  
		   	mysql_query($strSQL444,$cn);	
			
			//echo $strSQL444;
			/*
			 $campo="saldo".$almacen_destino;
			 $strSQL40="update producto set $campo=$campo + ".$acumCant[$i]." where idproducto='".$acumCod[$i]."' ";
			 mysql_query($strSQL40,$cn);
			*/
			
			//$strSQL401="update det_mov set cantdesp=cantdesp+'".$acumCant[$i]."' where cod_prod='".$acumCod[$i]."' and cod_cab='".cod_cab_doc."' ";
			//mysql_query($strSQL401,$cn);
			
			
			///********************************series*********************
			/*
			$ingreso=$codigo;
			$salida="";
			
			if(isset($_SESSION['temp_series'][2])){
				foreach ($_SESSION['temp_series'][2] as $subkey2=> $subvalue2) {
					 
					if($subvalue2==$acumCod[$i]){
					
					$strSQL_series="insert into series(producto,serie,ingreso,salida,costo,fing,fvenc,tienda) values ('".$acumCod[$i]."','".strtoupper( $_SESSION['temp_series'][0][$subkey2])."','".$ingreso."','".$salida."','".$costo_inven1."','".$femision."','".$femisionn."','".$almacen_destino."')";
					mysql_query($strSQL_series,$cn);
					//----------------Nota de creditooo---------------
						//if($tipomov!=$act_kar_IS && $act_kar_IS!="" ){
						   
						//}
					//-------------------------------------------------
					}
				}
			}
			*/
			///*********************************************************************
							
	}		
	
		$strSQL_ref2="update cab_mov set items='".(count($acumCant)-1)."' where cod_cab='".$codigo."'";
		mysql_query($strSQL_ref2,$cn);
		
		
		$strSQL0025="select  max(id) as id from referencia";
		$resultado0025=mysql_query($strSQL0025,$cn);
		$row0025=mysql_fetch_array($resultado0025);
		$codigo_ref=$row0025['id']+1;
		
		$strSQL_ref="insert into referencia (id,cod_cab,serie,correlativo,cod_cab_ref)values('".$codigo_ref."','".$codigo."','".$serie_ref."','".$numero_ref."','".$cod_doc_ref."')";
		mysql_query($strSQL_ref,$cn);
		
				
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
	
	$cod_suc_destino=$_REQUEST['cod_suc_destino'];
	
	list($rucSucO)=mysql_fetch_row(mysql_query("select ruc from sucursal where cod_suc='".$cod_suc_origen."'"));
	
	list($codclienteO)=mysql_fetch_row(mysql_query("select codcliente from cliente where ruc='".$rucSucO."'"));
	
	
	$strSQL="select * from cab_mov where tipo='2' and  sucursal='".$cod_suc_origen."' and cod_ope='GR' and serie='".str_pad($serieDocOrigen,3, "0", STR_PAD_LEFT)."' and  Num_doc='".str_pad($numeroDocOrigen,7, "0", STR_PAD_LEFT)."' ";
	 
	    $resultado=mysql_query($strSQL,$cn);
		$contReg=mysql_num_rows($resultado);
		
				
	$strSQL2="select * from cab_mov where tipo='1' and  sucursal='".$cod_suc_destino."' and cod_ope='GR' and serie='".str_pad($serieDocOrigen,3, "0", STR_PAD_LEFT)."' and  Num_doc='".str_pad($numeroDocOrigen,7, "0", STR_PAD_LEFT)."' and cliente='".$codclienteO."' ";
	 
	    $resultado2=mysql_query($strSQL2,$cn);
		$contReg2=mysql_num_rows($resultado2);	
			
		echo $contReg+$contReg2;
	
	break;
	
	case "aprobarGuiasIng":
	
	
	$codigoDoc=$_REQUEST['criterio'];
	
	
					list($cod_cab_ref)=mysql_fetch_row(mysql_query("select cod_cab_ref from referencia where cod_cab='".$codigoDoc."'"));
	
	
					$strSQL3="select * from det_mov where cod_cab='$codigoDoc' ";
					$resultado3=mysql_query($strSQL3,$cn);
					while($row3=mysql_fetch_array($resultado3)){
								
					//************************* Series ****************************
					
												
					$strSQL31="select * from series where producto='".$row3['cod_prod']."' and salida='".$cod_cab_ref."' ";
					$resultado31=mysql_query($strSQL31,$cn);
					while($row31=mysql_fetch_array($resultado31)){
							
							$strSQL_series="insert into series(producto,serie,ingreso,salida,costo,fing,fvenc,tienda) values ('".$row3['cod_prod']."','".$row31['serie']."','".$codigoDoc."','','".$costo_inven1."','".date("Y-m-d")."','".date("Y-m-d")."','".$row3['tienda']."')";
							mysql_query($strSQL_series,$cn);
									
					}
					
					//************************************************************
								
					//****************acutalizar costos promedio *******
					
					if($row['afectoigv']=='S'){
					$preciop=$row3['precio']/1.18;
					}else{
					$preciop=$row3['precio'];
					}
					
					$importe_sin_igv=$preciop*$row3['cantidad'];
					
					
					
					echo $row3['cod_prod']." - ".$fecha_aud." - ".$importe_sin_igv." - ".$row3['cantidad']." - ".'saldo'.$row3['tienda']." - ".'costo_inven'.$row3['sucursal'];
					
					$costo_inven1=calc_costo_inv($row3['cod_prod'],$fecha_aud,$importe_sin_igv,$row3['cantidad'],'saldo'.$row3['tienda'],'costo_inven'.$row3['sucursal']);
					
					$campoSuc='costo_inven'.$row3['sucursal'];
					
					//**********************************************
					
					
					
					$campo="saldo".$row3['tienda'];
					$strSQL40="update producto set $campo=$campo+".$row3['cantidad'].",$campoSuc='".$costo_inven1."' where idproducto='".$row3['cod_prod']."' ";
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
	
	case "ModificaCuentasDeudas":
		//echo $_REQUEST['it']."-".$_REQUEST['monto']."-".$_REQUEST['monto1'];
		$it=$_REQUEST['it'];
		$monto=$_REQUEST['monto'];
		$monto2=$_REQUEST['monto1'];
		$_SESSION['prog_pagos'][9][$it]=number_format($monto,2,".",""); //acta
		$_SESSION['prog_pagos'][10][$it]=number_format($monto2,2,".",""); //saldo final
		//echo $_SESSION['prog_pagos'][9][$it]."-".$_SESSION['prog_pagos'][10][$it];
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
	
	<table width="586" height="68" border="0" cellpadding="0" cellspacing="1">
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
			$strSQL="select c.cod_cab as cod_cab,c.tienda as tienda,c.cod_ope as cod_ope,c.serie as serie,c.Num_doc as Num_doc,c.f_venc as f_venc,c.moneda as moneda,c.saldo from cab_mov c inner join operacion op on op.codigo=c.cod_ope where c.cod_ope NOT IN('TN','NC') and c.saldo > 0 and c.tipo='1' and flag!='S' and c.sucursal='".$_REQUEST['sucursal']."' and c.cliente='".$_REQUEST['proveedor']."' and substr(op.p1,5,1)='S'";
			$strSQL.=" UNION select md.det_id as cod_cab,mc.cod_suc as tienda,md.cod_letra as cod_ope,' ' as serie,md.letra as Num_doc,md.fechavcto as f_venc,md.moneda as moneda,md.saldo from multicj mc inner join multi_det md on mc.multi_id=md.multi_id where md.saldo > 0 and mc.tipo='1' and mc.estado!='A' and mc.cod_suc='".$_REQUEST['sucursal']."' and mc.cliente='".$_REQUEST['proveedor']."'";
			//Aa
			//$strSQL="select * from cab_mov where saldo > 0 and tipo='1' and flag!='S' and sucursal='".$_REQUEST['sucursal']."' and cliente='".$_REQUEST['proveedor']."'";
			//echo $strSQL;
			$resultado=mysql_query($strSQL,$cn);
			$i=0;
			if(count($_SESSION['prog_pagos'][0])>0){
				foreach ($_SESSION['prog_pagos'][0] as $subkey=> $subvalue) {
					unset($_SESSION['prog_pagos'][0][$subkey]); //Identificador
					unset($_SESSION['prog_pagos'][1][$subkey]); //tienda
					unset($_SESSION['prog_pagos'][2][$subkey]); //codigo
					unset($_SESSION['prog_pagos'][3][$subkey]); //serie
					unset($_SESSION['prog_pagos'][4][$subkey]); //numero
					unset($_SESSION['prog_pagos'][5][$subkey]); //fecha vcto
					unset($_SESSION['prog_pagos'][6][$subkey]); //moneda
					unset($_SESSION['prog_pagos'][7][$subkey]); //saldo doc
					unset($_SESSION['prog_pagos'][8][$subkey]); //conversion
					unset($_SESSION['prog_pagos'][9][$subkey]); //acta
					unset($_SESSION['prog_pagos'][10][$subkey]); //saldo final
				}
			}
			while($row=mysql_fetch_array($resultado)){
			
			
			//echo "select mon_ac,acuenta,saldo,tc from progpagos_det p2,progpagos p1 where p1.id=id_progpagos and cod_cab='".$row['cod_cab']."' and cod_let='0' and estado!='A' union select mon_ac,acuenta,saldo,tc from progpagos_det p2,progpagos p1 where p1.id=id_progpagos and cod_let='".$row['cod_cab']."' and cod_cab='0' and estado!='A' ";
			$resultado3=mysql_query("select mon_ac,acuenta,saldo,tc from progpagos_det p2,progpagos p1 where p1.id=id_progpagos and cod_cab='".$row['cod_cab']."' and cod_let='0' and estado='E' union select mon_ac,acuenta,saldo,tc from progpagos_det p2,progpagos p1 where p1.id=id_progpagos and cod_let='".$row['cod_cab']."' and cod_cab='0' and estado='E' ");	
					
			$cont=mysql_num_rows($resultado3);		
			list($mon_ac,$acuenta,$saldo,$tc)=mysql_fetch_row($resultado3);
			//echo $cont;
			//echo $saldo."==0 && ".$cont.">0";
			
						
			if($saldo==0 && $cont>0){
				continue;		
			}else{
			
			
				if($row['moneda']==$mon_ac){
				
				$montoProgra=$acuenta;
				}else{
				//tcambio (programacion) / tc (programado)
				if($acuenta!=""){
					if($row['moneda']=='01'){
					$montoProgra=number_format($acuenta*$tc,2,'.','');					
					}else{
					$montoProgra=number_format($acuenta/$tc,2,'.','');
					}
				
				}else{
					$montoProgra=0.00;
				}
				}
			
			}
			
			 $deudaTemp=$row['saldo']-$montoProgra;
			 
			if($montoProgra==0){ $montoProgra=""; }	
			
			//$key=count($_SESSION['prog_pagos'][0]);
			$anul="";
			$anul2="";
			if($_REQUEST['valor']=="A"){
				$_SESSION['prog_pagos'][0][$i]="0";
				$_SESSION['prog_pagos'][1][$i]="101";
				$_SESSION['prog_pagos'][2][$i]="A";
				$_SESSION['prog_pagos'][3][$i]="000";
				$_SESSION['prog_pagos'][4][$i]="0000000";
				$_SESSION['prog_pagos'][5][$i]=0.00;
				$_SESSION['prog_pagos'][6][$i]="01";
				$_SESSION['prog_pagos'][7][$i]=0.00;
			}else{
				$_SESSION['prog_pagos'][0][$i]=$row['cod_cab'];
				$_SESSION['prog_pagos'][1][$i]=$row['tienda'];
				$_SESSION['prog_pagos'][2][$i]=$row['cod_ope'];
				$_SESSION['prog_pagos'][3][$i]=$row['serie'];
				$_SESSION['prog_pagos'][4][$i]=$row['Num_doc'];
				$_SESSION['prog_pagos'][5][$i]=substr($row['f_venc'],0,10);
				$_SESSION['prog_pagos'][6][$i]=$row['moneda'];
				$_SESSION['prog_pagos'][7][$i]=number_format($row['saldo'],2,'.','');
			}
			?>
                <tr disabled>
                  <td><span class="EstiloDetPagos"><?php echo $row['tienda']?></span></td>
                  <td><span class="EstiloDetPagos"><?php echo $row['cod_ope']?>
				  <input name="cod_ope[]" type="hidden" id="cod_ope" size="6" readonly="" style="font-size:11px; text-align:right" value="<?php echo $row['cod_ope']; ?>" />
				  </span></td>
                  <td><span class="EstiloDetPagos"><?php echo $row['serie'].$row['Num_doc']?></span>
				  <input name="serie[]" type="hidden" id="serie" size="6" readonly="" style="font-size:11px; text-align:right" value="<?php echo $row['serie']; ?>" />
				  <input name="numeroDoc[]" type="hidden" id="numeroDoc" size="6" readonly="" style="font-size:11px; text-align:right" value="<?php echo $row['Num_doc']; ?>" />				  </td>
                  <td><span class="EstiloDetPagos"><?php echo substr($row['f_venc'],0,10)?></span></td>
                  <td align="center"><span class="EstiloDetPagos"><?php 
				 if($row['moneda']=='01')echo "S/."; else echo "US$.";				  
				  ?></span>
				  <input name="mon_doc[]" type="hidden" id="mon_doc" size="6" readonly="" style="font-size:11px; text-align:right" value="<?php echo $row['moneda']; ?>" />				  </td>
                  <td align="right"><span class="EstiloDetPagos"><?php echo number_format($row['saldo'],2)?></span>
				  <input name="deuda[]" type="hidden" id="deuda" size="6" readonly="" style="font-size:11px; text-align:right" value="<?php echo number_format($row['saldo'],2,'.',''); ?>" />				  </td>
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
				  if($_REQUEST['valor']=="A"){
					  $_SESSION['prog_pagos'][8][0]=0.01;
					  $_SESSION['prog_pagos'][9][0]=0.01;
					  $_SESSION['prog_pagos'][10][0]=0.01;
				  }else{
					  $anul="cancelar(this,'".$conversion."','".$i."')";
					  $anul2="descancelar(this,'".$conversion."','".$i."')";
				  $_SESSION['prog_pagos'][8][$i]=$conversion;
				  $_SESSION['prog_pagos'][9][$i]=0.00;
				  $_SESSION['prog_pagos'][10][$i]=0.00;
				  }
				  ?>
				  
				  
                    <input name="convert[]" type="text" id="convert" size="6" readonly="" style="font-size:11px; text-align:right" value="<?php echo $conversion; ?>">
					
                  </span></td>
                  <td align="center"><input name="acuenta[]" type="text" id="acuenta" size="6" readonly="" style="font-size:11px; text-align:right"  /></td>
                  <td align="center"><input name="saldo[]" type="text" id="saldo" size="6" readonly="" style="font-size:11px; text-align:right"></td>
                  <td align="center"><span class="EstiloDetPagos">
				  <img <?php echo $disabled_audita; ?> style="cursor:pointer" src="../imagenes/revisado.png" width="20" height="21" alt=" Cancelar " onclick="<?php echo $anul; ?>" />
				  <img <?php echo $disabled_audita; ?> style="cursor:pointer" src="../imagenes/porrevisar.png" width="20" height="21" alt=" Por revisar " onclick="<?php echo $anul2; ?>" /></span></td>
                </tr>
                <?php 
				
				$i++; 
				} 
				?>
</table>
	
	<?php 
		
		
	break;
	
	
	case "tipoCheque":
	
	
	$strSQL="select pp.tipo as tipo, tp.descripcion as descrip from chequera pp inner join t_pago tp on tp.id=pp.tipo where pp.sucursal='".$_REQUEST['sucursal']."' and pp.cta_id='".$_REQUEST['cta_banco']."' and estado='A' group by tipo ";
	
	//echo $strSQL;
	$resultado=mysql_query($strSQL);
	//$contx=mysql_num_rows($resultado);
	?>
    <select name="tpago" onChange="cambiar_pago(this)"><option value="-">Seleccione Pago</option>
    <?php
	while($row=mysql_fetch_array($resultado)){
		?>
        <option value="<?php echo $row['tipo'] ?>"><?php echo $row['descrip'] ?></option>
        <?php
	}
	?>
    </select>
	<?php
		
	break;
	
	case "numeroCheque":
	
	
	$strSQL="select max(numero) as numero,tipo from progpagos where cuenta='".$_REQUEST['cta_banco']."' and sucursal='".$_REQUEST['sucursal']."' and tipo='".$_REQUEST['tipo']."' group by tipo ";
	
	//echo $strSQL;
	$resultado=mysql_query($strSQL);
	//$contx=mysql_num_rows($resultado);
	$row=mysql_fetch_array($resultado);
	$numero=str_pad($row['numero']+1,11,"0",STR_PAD_LEFT);
	$tipo_pago=$row['tipo'];
	
	//echo $contx;
	if($row['numero']!=''){
	
	$strSQL="select * from chequera where sucursal='".$_REQUEST['sucursal']."' and cta_id='".$_REQUEST['cta_banco']."' and num_ini<='".$numero."' and num_fin>='".$numero."'  and estado='A' and tipo='".$_REQUEST['tipo']."'";
	
	//echo $strSQL;
	$resultado=mysql_query($strSQL,$cn);
	$cont=mysql_num_rows($resultado);
	$tipo_pago=$row['tipo'];
	
	
	}else{
	
	$strSQL="select * from chequera where sucursal='".$_REQUEST['sucursal']."' and cta_id='".$_REQUEST['cta_banco']."'  and estado='A' and tipo='".$_REQUEST['tipo']."' order by num_ini desc";
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
	
	$sql=mysql_query("select estado from progpagos where id='".$_REQUEST['valor']."'",$cn);
	$est=mysql_fetch_array($sql);
	if($est['estado']=="E"){
	$strSQL="delete from progpagos where id='".$_REQUEST['valor']."'";
	mysql_query($strSQL,$cn);	
	//echo $strSQL;
	
	$strSQL="delete from progpagos_det where id_progpagos='".$_REQUEST['valor']."'";
	mysql_query($strSQL,$cn);
	}else{
		echo "Documento aprobado/anulado solo documentos en espera se pueden eliminar";
	}
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
		if($rowx['cod_let']!="0"){
			$campo="refer_letra";
			$codigo=$rowx['cod_let'];
			$campo2="det_id";
			$tabla="multi_det";
		}else{
			$campo="referencia";
			$codigo=$rowx['cod_cab'];
			$campo2="cod_cab";
			$tabla="cab_mov";
		}
		$numprog=$rowx['numero'];
		
		$fechaGiro=$rowx['fechavenc'];
		$fechaVenc=$rowx['fecha2'];
				
		$strSQ_pagos3="insert into pagos(id,t_pago,numero,fecha,fechav,monto,moneda,fechap,tcambio,".$campo.",vuelto,moneda_v,pc,cod_user) values ('".$id_pagos."','".$tpago."','".$numprog."','".$fechaGiro."','".$fechaVenc."',".$montoPagos.",'".$monedaPagos."','".$fecha_aud."',".$tcPagos.",'".$codigo."','".$vuelto."','".$moneda_v."','".$_SESSION['pc_ingreso']."','".$_SESSION['codvendedor']."')";
		mysql_query($strSQ_pagos3,$cn);		
		    $act_sal="update ".$tabla." set saldo='".$rowx['saldo']."' where ".$campo2."='".$codigo."'";
			mysql_query($act_sal,$cn);
		}else{
		
		//if($estado=='A'){
		if($rowx['cod_let']!="0"){
			$campo="refer_letra";
			$codigo=$rowx['cod_let'];
		}else{
			$campo="referencia";
			$codigo=$rowx['cod_cab'];
		}
		
		$strSQL="delete from pagos where ".$campo."='".$codigo."' and numero='".$rowx['numero']."'";
		mysql_query($strSQL,$cn);
				
		}
		///FALTA ACTUALIZAR SALDO DOCUMENTO/////////
		///////////GMY/////////26/11/2013///////////
				
	}		
			
	break;
	
	
	case "lista_prod_cuentas":
	
	
		if($_REQUEST['aplicacion']=='2'){
		$campo="ccontable2";
		}else{
		$campo="ccontable1";
		}
		
		if(isset($_REQUEST['valor'])){
			$filtro1=" where p.nombre like '%".$_REQUEST['valor']."%' ";
			}
	
	$strSQL="select $campo as cuentaconta, p.* from producto p $filtro1 order by p.idproducto ";
		
	//	echo $strSQL;
		
	 ?>
	 
	 <table width="599" height="232" border="0" cellpadding="0" cellspacing="0" >
  <tr >
    <td height="29" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000"></td>
    <td width="194" height="29" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000">Buscar
    <input type="text" name="nuevaDirec" id="nuevaDirec" onkeyup="buscarprod(this,event)" value="<?php echo $_REQUEST['valor']?>"/></td>
    <td width="410" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000"><input type="text" name="txtcopiar" id="txtcopiar" value="" />&nbsp;<input type="button" class="button" value="Copiar" name="btncopiar" id="btncopiar" onclick="copiar_cuentaProd()" /></td>
    <td width="4" height="29" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000"></td>
  </tr>
  <tr>
    <td width="4" height="180">&nbsp;</td>
    <!--
	
	<div  id="detalle_chofer" style="width:410px; height:150px; overflow-y:scroll">
    javascript:finMovimiento(event);
	-->
    <td colspan="2" valign="top">
	
	<div  style="z-index:999; cursor:default" onmousemove="">
	<table width="429" border="0" cellpadding="0" cellspacing="0">
      
   
      <tr>
        <td width="429" bgcolor="#F4F4F4">
            <table width="580" border="0" cellpadding="1" cellspacing="1">
              <tr  style="background:url(imagenes/bg_contentbase2.gif); background-position:100px 60px">
                <td width="66" height="19" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Id</strong></td>
                <td width="449" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Descripción</strong></td>
                
                
                <td width="75" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>
                <?php 
			  if($_REQUEST['aplicacion']==2){  
			  echo "Venta";
			  }else{
			  echo "Compra";
			  }
				?>
                
                
                </strong></td>
                
                <td width="1" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF">&nbsp;</td>
              </tr>
             
              <tr>
                <td colspan="4" align="left" style="border-bottom:#E5E5E5 solid 1px;" >
				
					<div  id="detalle_chofer" style="width:600px; height:150px; overflow-y:scroll">
					  <table width="579" height="20" border="0" align="left" cellpadding="0" cellspacing="0">
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
			$j=0;
			while($row=mysql_fetch_array($resultado)){
				
				$bgcolor="#F4F4F4";
				if($i%2==0){
				$bgcolor="#FFFFFF";
				}
				
				
			?>
            <!--entrada2(this)-->
                        <tr bgcolor="<?php echo $bgcolor;?>"  onmouseover="" onmouseout="" >
                          <td height="18" width="70" align="center" style="border-bottom:#E5E5E5 solid 1px" ><a href="#" ><?php echo $row['idproducto']?></a></td>
						  
						  <?php  ?>
                          <td width="405" align="left" style="border-bottom:#E5E5E5 solid 1px; color:#333333; "><?php echo caracteres(substr($row['nombre'],0,50))?></td>
                          <td width="54" align="center" style="border-bottom:#E5E5E5 solid 1px" ><input name="cuentaProd[]" type="text" id="cuentaProd_<?php echo $j;?>" size="7" value="<?php echo $row['cuentaconta']?>" />
                          <input name="codProd[]" type="hidden" id="codProd_<?php echo $j;?>" size="7" value="<?php echo $row['idproducto']?>" /></td>
                        </tr>
                        <?php 
			  $i++;
			  $j++;
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
	$clase->paginar($totalreg,$pag,$regvis,"cuentasProd");
	?>
	</div>	</td>
    <td>&nbsp;</td>
  </tr>
</table>
	 
	 
	<?php
	
	
	break;
	
	
	case "guardarcuentas":
	
	$aplicacion=$_REQUEST['aplicacion'];
	$cuentas=explode("|",$_REQUEST['cuentas']);
	$codigos=explode("|",$_REQUEST['codigos']);
	
	
		if($_REQUEST['aplicacion']=='2'){
		$campo="ccontable2";
		}else{
		$campo="ccontable1";
		}
	
	
	for($i=0;$i<count($cuentas);$i++){
		$strSQL="update producto set $campo='".$cuentas[$i]."' where idproducto='".$codigos[$i]."'";
		mysql_query($strSQL,$cn);
		//$consultas.=$strSQL."<br>";
	
	}
	//echo $consultas;
	break;
	
	case "guardarcuentas_tpago":
	
	$aplicacion=$_REQUEST['aplicacion'];
	$cuentas=explode("|",$_REQUEST['cuentas']);
	$cuentas2=explode("|",$_REQUEST['cuentas2']);
	$codigos=explode("|",$_REQUEST['codigos']);
	
	
		if($_REQUEST['aplicacion']=='2'){
		$campo="ccontable2";
		}else{
		$campo="ccontable1";
		}
	
	
	for($i=0;$i<count($cuentas);$i++){
		$strSQL="update t_pago set cc1='".$cuentas[$i]."',cc2='".$cuentas2[$i]."' where id='".$codigos[$i]."'";
		mysql_query($strSQL,$cn);
		//$consultas.=$strSQL."<br>";
	
	}
	//echo $consultas;
	break;
	
	case "series_dispo":	
	
		//echo '<form id="form_series" name="form_series" method="post" action="">';
	$idproducto=$_REQUEST['idproducto'];
	$tienda=$_REQUEST['cod_tienda_origen'];
	$cod_docIng=$_REQUEST['cod_cab_doc'];
	
	 $strSQL4="select * from producto where idproducto='".$idproducto."' ";
	 $resultado4=mysql_query($strSQL4,$cn);
	 //echo $strSQL4;
	$row4=mysql_fetch_array($resultado4);
	
	$contSerieSel=0;
	
	if(isset($_SESSION['temp_series'][0])){				
		foreach ($_SESSION['temp_series'][0] as $subkey=> $subvalue) {
			if($idproducto==$_SESSION['temp_series'][2][$subkey]){
			$contSerieSel++;															
			}							
		}					
	}
	
	
		
	?>

	<table width="305" height="90" border="0">
	  <tr>
	    <td width="414" height="25" >Producto: <strong style="font-size:12px">
	      <input type="hidden" name="cod_prod_serie" id="cod_prod_serie" value="<?php echo  $idproducto; ?>" />
        <?php echo $idproducto; ?>       - <?php echo strtoupper($row4['nombre'])?>
		
		<input name="seriesSel" id="seriesSel" type="hidden" size="5" value="0" />
	    </strong></td>
      </tr>
	  <tr>
	    <td height="25" >Serie:
        <input type="text" name="serieABuscar" id="serieABuscar" onkeyup="buscarSerie(this,event)" />
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Series Seleccionadas:
        <input name="contaSerie" id="contaSerie" type="text" size="2" style="border:none; background:none; color:#FF0000; text-decoration:underline" value="<?php echo $contSerieSel; ?>" /></td>
      </tr>
	  <tr>
	    <td align="center"><table id="tbl_series" width="295" border="0" cellpadding="1" cellspacing="1">
	      <tr style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px" >
	        <td align="center">
			<input style="border:none; background:none" type="checkbox" name="checkbox3" value="checkbox" id="checkbox3" onclick="marcarAll(this)" >
			</td>
	        <td width="248" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Series</strong></td>
          </tr>
          
          <?php 
		  
		  $strSQL='select *,replace(serie,"’","xx") AS serie2
 from series where tienda="'.$tienda.'" and producto="'.$idproducto.'" and (salida="" || salida=0 ) and ingreso="'.$cod_docIng.'"';
				
				echo $strSQL;
				$resultado=mysql_query($strSQL,$cn);
				//$i=0;
				//print_r($_SESSION['temp_series'][2]);
			$contSerieSel=0;	
			while($row=mysql_fetch_array($resultado)){
			
						
						$bgcolor="#FFFFFF";
						$checkbox=" ";
						
				if(isset($_SESSION['temp_series'][0])){
				
					foreach ($_SESSION['temp_series'][0] as $subkey=> $subvalue) {
								if($subvalue==$row['serie'] && $idproducto==$_SESSION['temp_series'][2][$subkey]){
								$bgcolor="#fff1bb";
								$checkbox=" checked='checked' ";	
								//$contSerieSel++;															
								}							
					}
					
				}
								
		  //$tepmSer=(caracteres(str_replace("’","&#8217;",$row['serie'])));
		 $tepmSer=((($row['serie2'])));
		  
		  ?>
	      <tr onClick="entradae(this)" style="background:<?php echo $bgcolor; ?>" >
	        <td width="31" align="center" ><input <?php echo $checkbox ?> style="border:none; background:none" type="checkbox" name="checkbox" value="checkbox" onclick="this.checked=false"  />
			</td>            
            
	        <td width="248" >
			<input name="" type="text" value="<?php echo strtoupper($tepmSer) ?>" />
			<?php echo ($tepmSer) ?></td>
          </tr>
          
          <?php 
          
			}
          
          ?>
          
        </table></td>
      </tr>
</table>
<!--</form>-->
	<?php
	
	break;
	
	case "sal_series":
		
		  
		$series=explode("_",$_REQUEST['series']);
		$producto=$_REQUEST['producto'];
		
		
		
		foreach ($_SESSION['temp_series'][2] as $subkey=> $subvalue) {
		//echo "$producto == $subvalue";
			if($producto==$subvalue){
			//echo $subvalue;
			unset($_SESSION['temp_series'][0][$subkey]);
			unset($_SESSION['temp_series'][2][$subkey]);
			
			}
		}					
		
			
			for($i=1;$i<count($series);$i++){
			 $_SESSION['temp_series'][0][]=$series[$i];
	//		 $_SESSION['temp_series'][1][]=$producto;
			 $_SESSION['temp_series'][2][]=$producto;
						
			//$strSQL="update series set estado='V' where tienda='".$tienda."' and producto='".$producto."' and serie='".$series[$i]."' ";
			//mysql_query($strSQL,$cn);
			 
			}			
	
		break;
		
		
		case "AnularGrxTraf":
		
		$codDocSal=$_REQUEST['CodDoc'];
		$condicion=$_REQUEST['condicion'];		
		
		list($cod_cab_ref)=mysql_fetch_row(mysql_query("select cod_cab from referencia where cod_cab_ref='".$codDocSal."'"));
		
		list($estadoOT)=mysql_fetch_row(mysql_query("select estadoOT from cab_mov where cod_cab='".$cod_cab_ref."'"));
		
		//echo "select estadoOT from cab_mov where cod_cab='".$cod_cab_ref."'";
		
		if($estadoOT!="P"){
			echo $estadoOT;
			
		}else{
		
			if($condicion=='A'){
			
				$delete1="update cab_mov set flag='A' where cod_cab='".$cod_cab_ref."'";
				mysql_query($delete1,$cn);			
				
				$delete2="update cab_mov set flag='A' where cod_cab='".$codDocSal."'";
				mysql_query($delete2,$cn);
					
			}
			
			if($condicion=='E'){
			
				$delete1="delete from cab_mov where cod_cab='".$cod_cab_ref."'";
				mysql_query($delete1,$cn);
				$delete2="delete from det_mov where cod_cab='".$cod_cab_ref."'";
				mysql_query($delete2,$cn);
				
				$delete3="delete from cab_mov where cod_cab='".$codDocSal."'";
				mysql_query($delete3,$cn);
				$delete4="delete from det_mov where cod_cab='".$codDocSal."'";
				mysql_query($delete4,$cn);	
					
			
			}	
			
			//$delete10="delete from series where ingreso='".$cod_cab_ref."'";
			//mysql_query($delete10,$cn);
			
			$delete11="update series set salida='' where salida='".$codDocSal."'";
			mysql_query($delete11,$cn);
			
		}

		
													
		break;	
		
		
		case "listaPagosCont":
		
		if($_REQUEST['aplicacion']=='2'){
		$campo="ccontable2";
		}else{
		$campo="ccontable1";
		}
		
		
	
	$strSQL=" select * from t_pago order by descripcion ";
		
	//	echo $strSQL;
		
	 ?>
	 
	 <table width="502" height="232" border="0" cellpadding="0" cellspacing="0" >
  <tr >
    <td height="29" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000"></td>
    <td width="189" height="29" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000">Buscar
    <input type="text" name="nuevaDirec" id="nuevaDirec" onkeyup="buscarprod(this,event)" value="<?php echo $_REQUEST['valor']?>"/></td>
    <td width="305" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000"><input type="text" name="txtcopiar" id="txtcopiar" value=""  style="visibility:hidden" />&nbsp;<input type="button" class="button" value="Copiar" name="btncopiar" id="btncopiar" onclick="copiar_cuentaProd()" style="visibility:hidden" /></td>
    <td width="101" height="29" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000"></td>
  </tr>
  <tr>
    <td width="4" height="180">&nbsp;</td>
    <!--
	
	<div  id="detalle_chofer" style="width:410px; height:150px; overflow-y:scroll">
    javascript:finMovimiento(event);
	-->
    <td colspan="2" valign="top">
	
	<div  style="z-index:999; cursor:default" onmousemove="">
	<table width="429" border="0" cellpadding="0" cellspacing="0">
      
   
      <tr>
        <td width="429" bgcolor="#F4F4F4">
            <table width="494" border="0" cellpadding="1" cellspacing="1">
              <tr  style="background:url(imagenes/bg_contentbase2.gif); background-position:100px 60px">
                <td width="46" height="19" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Id</strong></td>
                <td width="280" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Descripción</strong></td>
                
                
                <td width="67" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Cuenta S/.</strong></td>
                <td width="84" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Cuenta US$. </strong></td>
                
                <td width="1" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF">&nbsp;</td>
              </tr>
             
              <tr>
                <td colspan="5" align="left" style="border-bottom:#E5E5E5 solid 1px;" >
				
					<div  id="detalle_chofer" style="width:490px; height:150px; overflow-y:scroll">
					  <table width="470" height="20" border="0" align="left" cellpadding="0" cellspacing="0">
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
			$j=0;
			while($row=mysql_fetch_array($resultado)){
				
				$bgcolor="#F4F4F4";
				if($i%2==0){
				$bgcolor="#FFFFFF";
				}
				
				
			?>
            <!--entrada2(this)-->
                        <tr bgcolor="<?php echo $bgcolor;?>"  onmouseover="" onmouseout="" >
                          <td height="18" width="62" align="center" style="border-bottom:#E5E5E5 solid 1px" ><a href="#" ><?php echo $row['id']?></a></td>
						  
						  <?php  ?>
                          <td width="269" align="left" style="border-bottom:#E5E5E5 solid 1px; color:#333333; "><?php echo caracteres($row['descripcion'])?></td>
                          <td width="70" align="center" style="border-bottom:#E5E5E5 solid 1px; color:#333333; ">
						  
						  <input name="cuentaProd[]" type="text" id="cuentaProd_<?php echo $j;?>" value="<?php echo $row['cc1']?>" size="7" maxlength="11" />
                         
						  </td>
                          <td width="69" align="center" style="border-bottom:#E5E5E5 solid 1px" >
						  
                            <input name="cuentaProd2[]" type="text" id="cuentaProd2_<?php echo $j;?>" value="<?php echo $row['cc2']?>" size="7" maxlength="11" />
                          <input name="codProd[]" type="hidden" id="codProd_<?php echo $j;?>" size="7" value="<?php echo $row['id']?>" /></td>
                        </tr>
                        <?php 
			  $i++;
			  $j++;
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
	$clase->paginar($totalreg,$pag,$regvis,"cuentasProd");
	?>
	</div>	</td>
    <td>&nbsp;</td>
  </tr>
</table>
	 
	 
	<?php
	
	
	break;
	
	
	case "lisCuentaSunat":
	
		if($_REQUEST['aplicacion']=='1'){
		$campo=" idclasificacion,des_clas,codsunat ";
		$tabla=" clasificacion ";
		$order=" des_clas  "; 
		}
		
		if($_REQUEST['aplicacion']=='2'){
		$campo=" id,descripcion,codsunat ";		
		$tabla=" unidades "; 
		$order=" descripcion "; 
		}
		
		if($_REQUEST['aplicacion']=='3'){
		$campo=" codigo,nombre,codsunat1,codsunat2 ";		
		$tabla=" condicion "; 
		$order=" nombre "; 
		}
		
		
		
		if(isset($_REQUEST['valor'])){
			$filtro1=" where des_clas like '%".$_REQUEST['valor']."%' ";
			}
	
		$strSQL="select $campo from $tabla $filtro1 order by $order ";
		
	//	echo $strSQL;
		
	 ?>
	 
	 <table width="490" height="232" border="0" cellpadding="0" cellspacing="0" >
  <tr >
    <td height="29" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000"></td>
    <td width="194" height="29" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000">Buscar
    <input type="text" name="nuevaDirec" id="nuevaDirec" onkeyup="buscarprod(this,event)" value="<?php echo $_REQUEST['valor']?>"/></td>
    <td width="410" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000"><input type="text" name="txtcopiar" id="txtcopiar" value="" />&nbsp;<input type="button" class="button" value="Copiar" name="btncopiar" id="btncopiar" onclick="copiar_cuentaProd()" /></td>
    <td width="4" height="29" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000"></td>
  </tr>
  <tr>
    <td width="4" height="180">&nbsp;</td>
    <!--
	
	<div  id="detalle_chofer" style="width:410px; height:150px; overflow-y:scroll">
    javascript:finMovimiento(event);
	-->
    <td colspan="2" valign="top">
	
	<div  style="z-index:999; cursor:default" onmousemove="">
	<table width="429" border="0" cellpadding="0" cellspacing="0">
      
   
      <tr>
        <td width="429" bgcolor="#F4F4F4">
            <table width="494" border="0" cellpadding="1" cellspacing="1">
              <tr  style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px">
                <td width="50" height="19" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Id</strong></td>
                <td width="316" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Descripción</strong></td>
                
                
                <td width="114" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>
                <?php 
				
				if($_REQUEST['aplicacion']=='3'){
				echo "Compras - Ventas ";
				}else{
				echo "Sunat";
				}
			
				?>
                
                
                </strong></td>
                
                <td width="1" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF">&nbsp;</td>
              </tr>
             
              <tr>
                <td colspan="4" align="left" style="border-bottom:#E5E5E5 solid 1px;" >
				
					<div  id="detalle_chofer" style="width:490px; height:150px; overflow-y:scroll">
					  <table width="470" height="20" border="0" align="left" cellpadding="0" cellspacing="0">
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
			$j=0;
			while($row=mysql_fetch_array($resultado)){
				
				$bgcolor="#F4F4F4";
				if($i%2==0){
				$bgcolor="#FFFFFF";
				}
				
				
			?>
            <!--entrada2(this)-->
                        <tr bgcolor="<?php echo $bgcolor;?>"  onmouseover="" onmouseout="" >
                          <td height="18" width="63" align="center" style="border-bottom:#E5E5E5 solid 1px" ><a href="#" ><?php echo $row[0]?></a></td>
						  
						  <?php  ?>
                          <td width="307" align="left" style="border-bottom:#E5E5E5 solid 1px; color:#333333; "><?php echo caracteres(substr($row[1],0,50))?></td>
                          <td width="100" align="center" style="border-bottom:#E5E5E5 solid 1px" ><input name="cuentaProd[]" type="text" id="cuentaProd_<?php echo $j;?>" size="7" value="<?php echo $row[2]?>" style="text-align:center" />
						  <?php if($_REQUEST['aplicacion']=='3'){ ?>
						  <input name="cuentaProd2[]" type="text" id="cuentaProd2_<?php echo $j;?>" size="7" value="<?php echo $row[3]?>" style="text-align:center" />
						  <?php } ?>
                          <input name="codProd[]" type="hidden" id="codProd_<?php echo $j;?>" size="7" value="<?php echo $row[0]?>" /></td>
                        </tr>
                        <?php 
			  $i++;
			  $j++;
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
	$clase->paginar($totalreg,$pag,$regvis,"cuentasProd");
	?>
	</div>	</td>
    <td>&nbsp;</td>
  </tr>
</table>


	 <?php	
			
	break;
	
	
	case "saveCuentasKardex":
	
	$aplicacion=$_REQUEST['aplicacion'];
	$cuentas=explode("|",$_REQUEST['cuentas']);
	$codigos=explode("|",$_REQUEST['codigos']);
	$cuentas2=explode("|",$_REQUEST['cuentas2']);
	
	
		if($_REQUEST['aplicacion']=='1'){
		$campo1=" codsunat ";
		$campo2=" idclasificacion ";
		$tabla=" clasificacion ";		
		}
		
		if($_REQUEST['aplicacion']=='2'){
		$campo1=" codsunat ";		
		$campo2=" id ";
		$tabla=" unidades "; 		
		}
		
		if($_REQUEST['aplicacion']=='3'){
		$campo1=" codsunat1 ";
		$campo2=" codigo ";
		$campo3=" codsunat2 ";				
		$tabla=" condicion "; 
		
		}
	
	
	for($i=0;$i<count($cuentas);$i++){
	
		if($_REQUEST['aplicacion']=='3'){		
		$strSQL="update $tabla set $campo1='".$cuentas[$i]."', $campo3='".$cuentas2[$i]."' where $campo2='".$codigos[$i]."'";
		}else{
		$strSQL="update $tabla set $campo1='".$cuentas[$i]."' where $campo2='".$codigos[$i]."'";
		}												
		mysql_query($strSQL,$cn);
						
	}
	
	//echo $consultas;
	break;
	
	
	case "cuentasDeudas2":
	
	$tcambioProg=$_REQUEST["tcambiopago"];
	$monedaCuenta=$_REQUEST["monedaCuenta"];
	
	if($monedaCuenta=='02'){
	$titMon=" US$ ";
	}else{
	$titMon=" S/. ";
	}
	if($_REQUEST['tipomov']=='I'){
	$tipo='2';
	}else{
	$tipo='1';
	}
	
	?>
	<form action="" method="get" id="frm_doc" name="frm_doc">
	<table width="586" height="82" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
                <tr  bgcolor="#F9F9F9">
                  <td height="18" colspan="8" ><span class="Estilo6 Estilo22"><strong>Monto Disponible : </strong></span><span style="font:Arial, Helvetica, sans-serif; font-size:14px; color:#FF0000"><?php if(isset($_REQUEST['monto']) && $_REQUEST['monto']!=''){$montox=$_REQUEST['monto'];}else{$montox="0";}
				   echo $titMon." ".number_format($montox,2);?></span></td>
                  <td height="18" colspan="3" align="center" ><span class="Estilo6 Estilo22"><strong>Utilizado:
                    <input name="monto3" id="monto3" type="text" size="8" />
                  </strong></span></td>
                </tr>
                <tr bgcolor="#F9F9F9">
                  <td height="5" colspan="11" ></td>
                </tr>
                <tr style="background-image:url(../imagenes/grid3-hrow-over.gif)" bordercolor="#CCCCCC" bgcolor="#F9F9F9">
                  <td width="28" height="19" ><span class="Estilo22 Estilo6">Alm</span></td>
                  <td width="25"><span class="Estilo22 Estilo6">Td</span></td>
                  <td width="65" ><span class="Estilo22 Estilo6">N&uacute;mero</span></td>
                  <td width="71" ><span class="Estilo22 Estilo6">Fecha Vcto </span></td>
                  <td width="34" ><span class="Estilo22 Estilo6">Mon</span></td>
                  <td width="51" ><span class="Estilo22 Estilo6">Deuda</span></td>
                  <td width="62" ><span class="Estilo22 Estilo6">Programado</span></td>
                  <td width="57" align="center" ><span class="Estilo22 Estilo6">En  (<?php echo $titMon; ?>) </span></td>
                  <td width="57" ><span class="Estilo22 Estilo6">Acuenta</span></td>
                  <td width="43"><span class="Estilo22 Estilo6">Saldo</span></td>
                  <td width="52" ><span class="Estilo22 Estilo6">Acci&oacute;n</span></td>
                </tr>
                <?php 
			$strSQL="select c.cod_cab as cod_cab,c.tienda as tienda,c.cod_ope as cod_ope,c.serie as serie,c.Num_doc as Num_doc,c.f_venc as f_venc,c.moneda as moneda,c.saldo from cab_mov c inner join operacion op on op.codigo=c.cod_ope where c.cod_ope NOT IN('TN','NC') and c.saldo > 0 and c.tipo='".$tipo."' and flag!='S' and c.sucursal='".substr($_REQUEST['tienda'],0,1)."' and c.cliente='".$_REQUEST['auxiliar']."' and substr(op.p1,5,1)='S'";
			
			/*$strSQL.=" UNION select md.det_id as cod_cab,mc.cod_suc as tienda,md.cod_letra as cod_ope,' ' as serie,md.letra as Num_doc,md.fechavcto as f_venc,md.moneda as moneda,md.saldo from multicj mc inner join multi_det md on mc.multi_id=md.multi_id where md.saldo > 0 and mc.tipo='1' and mc.estado!='A' and mc.cod_suc='".$_REQUEST['sucursal']."' and mc.cliente='".$_REQUEST['proveedor']."'";
			*/
			//Aa
			//$strSQL="select * from cab_mov where saldo > 0 and tipo='1' and flag!='S' and sucursal='".$_REQUEST['sucursal']."' and cliente='".$_REQUEST['proveedor']."'";
			//echo $strSQL;
			$resultado=mysql_query($strSQL,$cn);
			$i=0;
			if(count($_SESSION['prog_pagos'][0])>0){
				foreach ($_SESSION['prog_pagos'][0] as $subkey=> $subvalue) {
					unset($_SESSION['prog_pagos'][0][$subkey]); //Identificador
					unset($_SESSION['prog_pagos'][1][$subkey]); //tienda
					unset($_SESSION['prog_pagos'][2][$subkey]); //codigo
					unset($_SESSION['prog_pagos'][3][$subkey]); //serie
					unset($_SESSION['prog_pagos'][4][$subkey]); //numero
					unset($_SESSION['prog_pagos'][5][$subkey]); //fecha vcto
					unset($_SESSION['prog_pagos'][6][$subkey]); //moneda
					unset($_SESSION['prog_pagos'][7][$subkey]); //saldo doc
					unset($_SESSION['prog_pagos'][8][$subkey]); //conversion
					unset($_SESSION['prog_pagos'][9][$subkey]); //acta
					unset($_SESSION['prog_pagos'][10][$subkey]); //saldo final
				}
			}
			while($row=mysql_fetch_array($resultado)){
			
			
			//echo "select mon_ac,acuenta,saldo,tc from progpagos_det p2,progpagos p1 where p1.id=id_progpagos and cod_cab='".$row['cod_cab']."' and cod_let='0' and estado!='A' union select mon_ac,acuenta,saldo,tc from progpagos_det p2,progpagos p1 where p1.id=id_progpagos and cod_let='".$row['cod_cab']."' and cod_cab='0' and estado!='A' ";
			$resultado3=mysql_query("select mon_ac,acuenta,saldo,tc from progpagos_det p2,progpagos p1 where p1.id=id_progpagos and cod_cab='".$row['cod_cab']."' and cod_let='0' and estado='E' union select mon_ac,acuenta,saldo,tc from progpagos_det p2,progpagos p1 where p1.id=id_progpagos and cod_let='".$row['cod_cab']."' and cod_cab='0' and estado='E' ");	
					
			$cont=mysql_num_rows($resultado3);		
			list($mon_ac,$acuenta,$saldo,$tc)=mysql_fetch_row($resultado3);
			//echo $cont;
			//echo $saldo."==0 && ".$cont.">0";
			
						
			if($saldo==0 && $cont>0){
				continue;		
			}else{
			
			
				if($row['moneda']==$mon_ac){
				
				$montoProgra=$acuenta;
				}else{
				//tcambio (programacion) / tc (programado)
				if($acuenta!=""){
					if($row['moneda']=='01'){
					$montoProgra=number_format($acuenta*$tc,2,'.','');					
					}else{
					$montoProgra=number_format($acuenta/$tc,2,'.','');
					}
				
				}else{
					$montoProgra=0.00;
				}
				}
			
			}
			
			 $deudaTemp=$row['saldo']-$montoProgra;
			 
			if($montoProgra==0){ $montoProgra=""; }	
			
			//$key=count($_SESSION['prog_pagos'][0]);
			$anul="";
			$anul2="";
			if($_REQUEST['valor']=="A"){
				$_SESSION['prog_pagos'][0][$i]="0";
				$_SESSION['prog_pagos'][1][$i]="101";
				$_SESSION['prog_pagos'][2][$i]="A";
				$_SESSION['prog_pagos'][3][$i]="000";
				$_SESSION['prog_pagos'][4][$i]="0000000";
				$_SESSION['prog_pagos'][5][$i]=0.00;
				$_SESSION['prog_pagos'][6][$i]="01";
				$_SESSION['prog_pagos'][7][$i]=0.00;
			}else{
				$_SESSION['prog_pagos'][0][$i]=$row['cod_cab'];
				$_SESSION['prog_pagos'][1][$i]=$row['tienda'];
				$_SESSION['prog_pagos'][2][$i]=$row['cod_ope'];
				$_SESSION['prog_pagos'][3][$i]=$row['serie'];
				$_SESSION['prog_pagos'][4][$i]=$row['Num_doc'];
				$_SESSION['prog_pagos'][5][$i]=substr($row['f_venc'],0,10);
				$_SESSION['prog_pagos'][6][$i]=$row['moneda'];
				$_SESSION['prog_pagos'][7][$i]=number_format($row['saldo'],2,'.','');
			}
			?>
                <tr disabled>
                  <td><span class="EstiloDetPagos"><?php echo $row['tienda']?></span></td>
                  <td><span class="EstiloDetPagos"><?php echo $row['cod_ope']?>
				  <input name="cod_ope[]" type="hidden" id="cod_ope" size="6" readonly="" style="font-size:11px; text-align:right" value="<?php echo $row['cod_ope']; ?>" />
				  </span></td>
                  <td><span class="EstiloDetPagos"><?php echo $row['serie'].$row['Num_doc']?></span>
				  <input name="serie[]" type="hidden" id="serie" size="6" readonly="" style="font-size:11px; text-align:right" value="<?php echo $row['serie']; ?>" />
				  <input name="numeroDoc[]" type="hidden" id="numeroDoc" size="6" readonly="" style="font-size:11px; text-align:right" value="<?php echo $row['Num_doc']; ?>" />				  </td>
                  <td><span class="EstiloDetPagos"><?php echo substr($row['f_venc'],0,10)?></span></td>
                  <td align="center"><span class="EstiloDetPagos"><?php 
				 if($row['moneda']=='01')echo "S/."; else echo "US$.";				  
				  ?></span>
				  <input name="mon_doc[]" type="hidden" id="mon_doc" size="6" readonly="" style="font-size:11px; text-align:right" value="<?php echo $row['moneda']; ?>" />				  </td>
                  <td align="right"><span class="EstiloDetPagos"><?php echo number_format($row['saldo'],2)?></span>
				  <input name="deuda[]" type="hidden" id="deuda" size="6" readonly="" style="font-size:11px; text-align:right" value="<?php echo number_format($row['saldo'],2,'.',''); ?>" />				  </td>
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
				  if($_REQUEST['valor']=="A"){
					  $_SESSION['prog_pagos'][8][0]=0.01;
					  $_SESSION['prog_pagos'][9][0]=0.01;
					  $_SESSION['prog_pagos'][10][0]=0.01;
				  }else{
					  $anul="cancelar(this,'".$conversion."','".$i."')";
					  $anul2="descancelar(this,'".$conversion."','".$i."')";
				  $_SESSION['prog_pagos'][8][$i]=$conversion;
				  $_SESSION['prog_pagos'][9][$i]=0.00;
				  $_SESSION['prog_pagos'][10][$i]=0.00;
				  }
				  ?>
				  
				  
                    <input name="convert[]" type="text" id="convert" size="6" readonly="" style="font-size:11px; text-align:right" value="<?php echo $conversion; ?>">
					
                  </span></td>
                  <td align="center"><input name="acuenta[]" type="text" id="acuenta" size="6" readonly="" style="font-size:11px; text-align:right"  /></td>
                  <td align="center"><input name="saldo[]" type="text" id="saldo" size="6" readonly="" style="font-size:11px; text-align:right"></td>
                  <td align="center"><span class="EstiloDetPagos">
				  <img <?php echo $disabled_audita; ?> style="cursor:pointer" src="../imagenes/revisado.png" width="20" height="21" alt=" Cancelar " onclick="<?php echo $anul; ?>" />
				  <img <?php echo $disabled_audita; ?> style="cursor:pointer" src="../imagenes/porrevisar.png" width="20" height="21" alt=" Por revisar " onclick="<?php echo $anul2; ?>" /></span></td>
                </tr>
                <?php 
				
				$i++; 
				} 
				?>
</table>
	</form>
	
	<?php 
		
		
	break;
	
	
	case "docCajaCh":
	
	$idcaja=$_REQUEST['idcaja'];
		
	?>	
	
	<fieldset><legend><span style="color:">Cuentas Corrientes</span></legend><br>
          <table width="558" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="558">
			  <div style="height:200px; overflow-y:scroll" id="lista_cuentasDeudas" >
			    <table width="592" height="10" border="0" cellpadding="0" cellspacing="1">
                  <tr style="background-image:url(../imagenes/grid3-hrow-over.gif)">
                    <td width="27" height="23" align="center"><span class="Estilo51 Estilo47 Estilo54 "><strong>O</strong></span></td>
                    <td width="24"><span class="Estilo51 Estilo47 Estilo54"><strong>Td</strong></span></td>
                    <td width="100" align="center"><span class="Estilo51 Estilo47 Estilo54"><strong>Numero</strong></span></td>
                    <td width="39" align="center"><span class="Estilo51 Estilo47 Estilo54"><strong>Mon</strong></span></td>
                    <td width="71" align="center"><span class="Estilo51 Estilo47 Estilo54"><strong>Importe</strong></span></td>
                    <td width="71" align="center"><span class="Estilo51 Estilo47 Estilo54"><strong>Prog. Anterior</strong></span></td>
                    <td width="77" align="center"><span class="Estilo51 Estilo47 Estilo54"><strong>Saldo Parcial</strong></span></td>
                    <td width="93" align="center"><span class="Estilo51 Estilo47 Estilo54"><strong>Saldo Final </strong></span></td>
                  </tr>
                  <?php 
			
			//$strSQL="select p2.numero as numeroDoc,p2.*,p1.* from progpagos_det p2,progpagos p1 where p1.id=id_progpagos and id_progpagos='".$_REQUEST['id']."' order by p2.id";
			$strSQL="select * from cajach_doc where id_cajach='".$idcaja."' order by id";
			//echo $strSQL;
			$resultado=mysql_query($strSQL,$cn);
			$i=0;
			while($row=mysql_fetch_array($resultado)){
			$sql_doc=mysql_query("Select moneda,total from cab_mov where cod_cab='".$row['cod_cab']."'",$cn);
			$row_doc=mysql_fetch_array($sql_doc);
			$mone_ori=$row_doc['moneda'];
			$sql_pag=mysql_query("Select pa.* from pagos pa where pa.referencia='".$row['cod_cab']."' and pa.numero!='".$row['numero']."'",$cn);
			//echo "Select pa.* from pagos pa where pa.referencia='".$row['cod_cab']."' and pa.numero!='".$row['numero']."'";
			$abo=0;
			$car=0;
			while($row_pag=mysql_fetch_array($sql_pag)){
				if($row_pag['moneda']!=$row_doc['moneda']){
					switch($row_pag['moneda']){
						case '01':
							//echo number_format($row_pag['monto'],2,'.','')."/".number_format($row_pag['tcambio'],4);
							$monto=number_format($row_pag['monto'],2,'.','')/number_format($row_pag['tcambio'],4,'.','');
							break;
						case '02':
							$monto=number_format($row_pag['monto'],2,'.','')*number_format($row_pag['tcambio'],2,'.','');
							break;
					}
				}else{
					$monto=number_format($row_pag['monto'],2,'.','');
				}
				switch($row_pag['tipo']){
					case 'A':
						$abo=number_format($abo,2,'.','')+number_format($monto,2,'.','');
						break;
					case 'C':
						$car=number_format($car,2,'.','')+number_format($monto,2,'.','');
						break;
				}
			}
			//$saldo=$row['deuda'];
			$saldo=(number_format($row_doc['total'],2,'.','')+number_format($car,2,'.',''))-number_format($abo,2,'.','');
			
			if($row['cod_ope']=="A"){
			?>
            <tr>
            <td colspan="8" style="letter-spacing:12px; color:#F00; font-size:28px; font-style:normal; text-align:center">ANULADO</td>
            </tr>
            <?php }else{
			?>
                  <tr>
                    <td height="19" align="center" bgcolor="#FFFFFF"><img src="../imagenes/ico_lupa.png" width="15" height="15" onClick="doc_det('<?php echo $row['cod_cab'];?>')"></td>
                    <td align="center" bgcolor="#FFFFFF"><span class="EstiloDetPagos"><?php echo $row['cod_ope']?></span></td>
                    <td align="center" bgcolor="#FFFFFF"><span class="EstiloDetPagos">
					<?php 
					
						echo $row['serie']." - ".$row['numero'];
					
					?></span></td>
                    <td align="center" bgcolor="#FFFFFF"><span class="EstiloDetPagos">
                      <?php 
				  
				  if($row['mon_doc']=='01')echo "S/."; else echo "US$.";
				  //echo "select if(p2.numero='0000000',p2.num_let,p2.numero) as numeroDoc,p2.*,p1.* from progpagos_det p2,progpagos p1 where p1.id=id_progpagos and cod_cab='".$row['cod_cab']."' and id_progpagos <='".$_REQUEST['id']."' order by p2.id";
				  
				  if($row['mon_doc']==$row['mon_ac']){
				  
				  $montoProg=$row['acuenta'];
				  
				  }else{
				  
					  if($row['mon_doc']=='01'){
					  $montoProg=$row['acuenta']*$row['tc'];
					  }else{
					  $montoProg=number_format($row['acuenta']/$row['tc'],2,".","");
					  }
				  
				  }
				  
				  ?>
                    </span></td>
                    <td align="right" bgcolor="#FFFFFF"><span class="EstiloDetPagos"><?php echo number_format($row['deuda'],2)?></span></td>
                    <td align="right" bgcolor="#FFFFFF"><span class="EstiloDetPagos"><?php 
					/*
					$strsqlprog=mysql_query("select if(p2.numero='0000000',p2.num_let,p2.numero) as numeroDoc,p2.*,p1.* from progpagos_det p2,progpagos p1 where p1.id=id_progpagos and cod_cab='".$row['cod_cab']."' and id_progpagos <'".$_REQUEST['id']."' and estado!='A' order by p2.id",$cn);
					$montoProg1=0;
					$progsx="";
					while($row_prog=mysql_fetch_array($strsqlprog)){
						if($row['mon_doc']==$row_prog['mon_ac']){
							$montoProg1+=number_format($row['acuenta'],2,'.','');
						}else{
							switch($row['mon_doc']){
								case '01':$montoProg1+=number_format($row_prog['acuenta']*$row_prog['tc'],2,'.','');break;
								case '02':$montoProg1+=number_format($row_prog['acuenta']/$row_prog['tc'],2,'.','');break;
							}
						}
						$progsx.=$row_prog['id_progpagos']."<br>";
					}
					echo number_format($montoProg1,2,'.',',');
					//."<br>".$progsx
					*/
					?></span></td>
                    <td align="right" bgcolor="#FFFFFF"><span class="EstiloDetPagos"><?php 
					$saldo=$saldo-$montoProg1;
					echo number_format($saldo,2);
					//number_format($row['deuda'],2);?></span></td>
                    <td align="right" bgcolor="#FFFFFF"><span class="EstiloDetPagos"><?php echo number_format($saldof,2)?></span></td>
                  </tr>
                  <?php 
				
				$i++; 
				} 
			}
				?>
                </table>
			  </div>			  </td>
            </tr>
          </table>
      </fieldset>
	
	<?php 
	
	break;
	
	
	
	
	}	
	
	
	
	function calc_costo_inv($codigo_producto,$fecha_emi,$importe_sin_igv,$cantidad,$campo_tie,$campo_suc){

				include('conex_inicial.php');
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
	
	
	
?>
