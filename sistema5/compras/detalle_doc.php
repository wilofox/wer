<?php 
session_start();
include('../conex_inicial.php');
include('../funciones/funciones.php');
$cod_prod=$_REQUEST['prod'];
$cantidad=$_REQUEST['cant'];
$accion=$_REQUEST['accion'];
$punitario=$_REQUEST['punitario'];

//echo "-->".$accion;

//unset($_SESSION['productos']);
//unset($_SESSION['productos2']);
//unset($_SESSION['productos3']);

//print_r($_SESSION['productos']);
//echo "<br>-->";print_r($_SESSION['productos'][0]);

//echo $cantidad;
//echo $cantidad." ".$punitario." ".$termino;
//echo $punitario." ".$cantidad;
//$cod=$_REQUEST['cod'];

$notas=$_REQUEST['notas'];
$total=0;
$fechad=$_REQUEST['fechaEmi'];
$incluidoigv=$_REQUEST['incluidoigv'];
$tmoneda=$_REQUEST['tmoneda'];
$estado=$_REQUEST['estado'];
//echo "-->".$estado;
$mon_ini=$_REQUEST['mon_ini'];
$permiso4=$_REQUEST['permiso4'];
$permiso10=$_REQUEST['permiso10'];
$presentacion=$_REQUEST['presentacion'];
$tienda=$_REQUEST['tienda'];
$precosto=$_REQUEST['precosto'];
$impto=$_REQUEST['impto'];
$valor_impto=$impto+1;
$num_impto=$impto*100;
$desabilitar="";
$total_doc=$_REQUEST['total_doc'];
$tipomov=$_REQUEST['tipomov'];
$codAnexProd=$_REQUEST['codAnexProd'];

$percep_suc=$_REQUEST['percep_suc'];
$percep_doc=$_REQUEST['percep_doc'];
$min_percep_doc=$_REQUEST['min_percep_doc'];
$est_percep_clie=$_REQUEST['est_percep_clie'];
$por_percep_clie=$_REQUEST['por_percep_clie'];
$condicion=$_REQUEST['condicion'];

$pcajas=$_REQUEST['pcajas'];

$termino=$_REQUEST['termino'];
$pase=$_REQUEST['pase'];

$permiso21=$_REQUEST['permiso21'];//mostrar descuentos
$tipoDesc=$_REQUEST['tipoDesc'];

$permiso27=$_REQUEST['permiso27'];//permiso sistema de puntos

$permiso28=$_REQUEST['permiso28'];//permiso control de envases
$tipoDescDoc=$_REQUEST['tipoDescuento'];//tipo de descuentos  --->  I=por importe   P=porcentual(%)

$stockProd=$_REQUEST['stockProd'];
$des_lote=$_REQUEST['des_lote'];
$venc_lote=$_REQUEST['venc_lote'];

//echo $permiso28." | ".$tipoDescDoc;
$ocularDesc="";
$ocularDesc2="";
if($permiso21!='S'){
$ocularDesc=" style='display:none' ";
$ocularDesc2=" style='display:none' ";
}
if($tipoDescDoc=='I'){
$ocularDesc2=" style='display:none' ";
}

$ocularEnvases="";
if($permiso28!='S'){
$ocularEnvases=" style='display:none' ";
}

if(isset($_REQUEST['flete'])){
//echo "<fg<";
$_SESSION['montoFlete']=$_REQUEST['flete'];
}

//echo $punitario;
 //echo "sag";
//echo $percep_suc."-".$percep_doc."-".$min_percep_doc."-".$est_percep_clie."-".$por_percep_clie."-";

if($pase=='N' && $cod_prod==''){
////se comento para cencarsac
//$cantidad="";
//$punitario="";
}

$saldoTienda="saldo".$tienda;
 list($aplicaBon)=mysql_fetch_row(mysql_query("select aplicaBon from tienda where cod_tienda='".$tienda."'"));
 
 
// echo "select aplicaBon from tienda where cod_tienda='".$tienda."'";

if($tmoneda==02){
$total_doc=$total_doc*$tc;
}

if(isset($_REQUEST['trans'])){
  $visible=" style='display:none' ";
  $ruta_imagen='imgenes/eliminar.gif';
  $ruta_titu=" style='background:url(imagenes/bg_contentbase2.gif); background-position:100px 45px' ";
  $desabilitar=" readonly='readonly' ";
  }else{
	  if(isset($_REQUEST['ptoventa'])){
	  $ruta_imagen='imgenes/eliminar.gif';
	  $ruta_titu=" style='background:url(imagenes/bg_contentbase2.gif); background-position:100px 45px' ";
	  //echo "sg";
	  }else{
	  $visible=" ";  
	  $ruta_imagen='../imgenes/eliminar.gif';
	  $ruta_titu=" style='background:url(../imagenes/bg_contentbase2.gif); background-position:100px 45px; ' ";
	  }
}  
  
$tc=$_SESSION['tc'];
$permiso_modifPrecio=$_REQUEST['permiso_modifPrecio'];
	//echo $permiso_modifPrecio;
?>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo111 {color: #006699}
.Estilo1 {color: #333333}
-->
</style>
<table width="779" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td   height="54" colspan="6">
	
	<div style="height:110px;  width:775px; overflow-y:scroll; overflow-x:hidden; border:#CCCCCC solid 1xp" >
      <table id="detalle_doc_gen" width="757" border="0" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#F2F2F2">
        <tr <?php echo $ruta_titu?> >
          <td width="45" align="center"><span class="Estilo31">C&oacute;digo</span></td>
          <td  width="350" ><span class="Estilo31">Descripci&oacute;n
            
          </span></td>
          <td width="41" align="center"><span class="Estilo31">UND</span></td>
          <td width="22" align="center"><span class="Estilo31">Cant.</span></td>
          <td width="22" align="center" <?php echo $ocularEnvases; ?>><span style="text-align:center" class="Estilo31">Envases</span></td>
          <td width="49" align="center"><span class="Estilo31">P. Unit.</span></td>
          <td width="45" align="center" <?php echo $ocularDesc?> ><span class="Estilo31">Dsc1 <?php if($tipoDescDoc=='P')echo "%"?></span></td>
          <td width="47" align="center" <?php echo $ocularDesc2?>><span class="Estilo31">Dsc 2 <?php if($tipoDescDoc=='P')echo "%"?></span></td>
          <td width="53" align="center"><span class="Estilo31">Total</span></td>
          <td width="45" align="center"><span class="Estilo31">Notas</span></td>
          <td width="29" align="center"><span class="Estilo31">E</span></td>
        </tr>
        <?php
		
		//echo $termino;
  if(isset($_REQUEST['cod_delete'])){

	$cod=$_REQUEST['cod'];
	
	
			foreach ($_SESSION['productos'][20] as $subkey=> $subvalue) {
				 
				if($subvalue==$cod || $_SESSION['productos'][20][$subkey]==$cod){
				unset($_SESSION['productos'][0][$subkey]);
				unset($_SESSION['productos'][1][$subkey]); 
				unset($_SESSION['productos'][2][$subkey]); 
				unset($_SESSION['productos'][3][$subkey]); 
				unset($_SESSION['productos'][4][$subkey]);
				unset($_SESSION['productos'][5][$subkey]); 
				unset($_SESSION['productos'][6][$subkey]);
				unset($_SESSION['productos'][12][$subkey]);
				unset($_SESSION['productos'][13][$subkey]); 
				unset($_SESSION['productos'][14][$subkey]);
				unset($_SESSION['productos'][20][$subkey]);
				unset($_SESSION['productos'][21][$subkey]);
				unset($_SESSION['productos'][22][$subkey]);
				unset($_SESSION['productos'][23][$subkey]);
				unset($_SESSION['productos'][24][$subkey]);
				unset($_SESSION['productos'][25][$subkey]);
				unset($_SESSION['productos'][26][$subkey]);
				unset($_SESSION['productos'][27][$subkey]);
				unset($_SESSION['productos'][28][$subkey]);     
				
				unset($_SESSION['productos2'][0][$subkey]);
				unset($_SESSION['productos2'][1][$subkey]); 
				unset($_SESSION['productos2'][2][$subkey]); 
				unset($_SESSION['productos2'][4][$subkey]); 
				unset($_SESSION['productos2'][5][$subkey]); 
				unset($_SESSION['productos2'][6][$subkey]); 
				unset($_SESSION['productos2'][12][$subkey]);
				unset($_SESSION['productos2'][13][$subkey]);
				unset($_SESSION['productos2'][14][$subkey]);
				unset($_SESSION['productos2'][20][$subkey]);
				unset($_SESSION['productos2'][21][$subkey]);
				unset($_SESSION['productos2'][22][$subkey]);
				unset($_SESSION['productos2'][23][$subkey]);
				unset($_SESSION['productos2'][24][$subkey]);
				unset($_SESSION['productos2'][25][$subkey]);
				unset($_SESSION['productos2'][26][$subkey]);
				unset($_SESSION['productos2'][27][$subkey]);
				unset($_SESSION['productos2'][28][$subkey]);
				
				
						if(isset($_SESSION['boni'][0])){
							foreach ($_SESSION['boni'][0] as $subkey2=> $subvalue2) {
							//echo "safd".$_SESSION['productos3'][0][$subkey];
								if($_SESSION['boni'][4][$subkey2]==$_SESSION['productos3'][0][$subkey]){
								
									unset($_SESSION['boni'][0][$subkey2]);
									unset($_SESSION['boni'][1][$subkey2]);
									unset($_SESSION['boni'][2][$subkey2]);
									unset($_SESSION['boni'][3][$subkey2]);
									unset($_SESSION['boni'][4][$subkey2]);
								}
							}
						}
						
				}
				//print_r($_SESSION['productos'][0]);
								
			}
			//******************modelos***************************************
			foreach ($_SESSION['productos'][20] as $subkey=> $subvalue) {
				 
				if($_SESSION['productos'][25][$subkey]==$cod){
				//echo "eliminado";
				unset($_SESSION['productos'][0][$subkey]);
				unset($_SESSION['productos'][1][$subkey]); 
				unset($_SESSION['productos'][2][$subkey]); 
				unset($_SESSION['productos'][3][$subkey]); 
				unset($_SESSION['productos'][4][$subkey]);
				unset($_SESSION['productos'][5][$subkey]); 
				unset($_SESSION['productos'][6][$subkey]);
				unset($_SESSION['productos'][12][$subkey]);
				unset($_SESSION['productos'][13][$subkey]); 
				unset($_SESSION['productos'][14][$subkey]);
				unset($_SESSION['productos'][20][$subkey]);
				unset($_SESSION['productos'][21][$subkey]);
				unset($_SESSION['productos'][22][$subkey]);
				unset($_SESSION['productos'][23][$subkey]);
				unset($_SESSION['productos'][24][$subkey]);
				unset($_SESSION['productos'][25][$subkey]);
				unset($_SESSION['productos'][26][$subkey]);
				unset($_SESSION['productos'][27][$subkey]);
				unset($_SESSION['productos'][28][$subkey]);
				   
				
				unset($_SESSION['productos2'][0][$subkey]);
				unset($_SESSION['productos2'][1][$subkey]); 
				unset($_SESSION['productos2'][2][$subkey]); 
				unset($_SESSION['productos2'][4][$subkey]); 
				unset($_SESSION['productos2'][5][$subkey]); 
				unset($_SESSION['productos2'][6][$subkey]); 
				unset($_SESSION['productos2'][12][$subkey]);
				unset($_SESSION['productos2'][13][$subkey]);
				unset($_SESSION['productos2'][14][$subkey]);
				unset($_SESSION['productos2'][20][$subkey]);
				unset($_SESSION['productos2'][21][$subkey]);
				unset($_SESSION['productos2'][22][$subkey]);
				unset($_SESSION['productos2'][23][$subkey]);
				unset($_SESSION['productos2'][24][$subkey]);
				unset($_SESSION['productos2'][25][$subkey]);
				unset($_SESSION['productos2'][26][$subkey]);
				unset($_SESSION['productos2'][27][$subkey]);
				unset($_SESSION['productos2'][28][$subkey]);
				
				
												
				}
				
								
			}
			//print_r($_SESSION['productos']);
			//**************************************************************
			
			//--------------------------------eliminar series*--------------------------
			//echo $cod;
		 if(isset($_SESSION['seriesprod'][2])){
				foreach ($_SESSION['seriesprod'][2] as $subkey=> $subvalue) {
					 
					if($subvalue==$_REQUEST['codSerie']){
							
					
					$strSQL="update series set estado='F' where tienda='".$tienda."' and salida='' and producto='".$_REQUEST['codSerie']."' and serie='".$_SESSION['seriesprod'][0][$subkey]."' ";
			mysql_query($strSQL,$cn);
					
				//	echo $strSQL."<br>";
					
					unset($_SESSION['seriesprod'][0][$subkey]);
					unset($_SESSION['seriesprod'][1][$subkey]); 
					unset($_SESSION['seriesprod'][2][$subkey]); 
					
					unset($_SESSION['seriesprod2'][0][$subkey]);
					unset($_SESSION['seriesprod2'][1][$subkey]); 
					unset($_SESSION['seriesprod2'][2][$subkey]); 
					
					}
				}
		 }
		 	
		 //----------reasignando numeros de orden ----------------------
			
			$m=1;
			foreach ($_SESSION['productos'][20] as $subkey=> $subvalue){
			
			$_SESSION['productos'][20][$subkey]=$m;
			
			$m++;
			}
			
		 //--------------------------------------------------------------
		 
			//----------------------------------------------------------------------------
		//	print_r($_SESSION['seriesprod'][0]);echo "<br>";
		//	print_r($_SESSION['seriesprod'][1]);echo "<br>";
		//	print_r($_SESSION['seriesprod'][2]);echo "<br>";
			
		
	if($tmoneda!=$mon_ini){	
	 $temp_array=1;	
	}else{
	 $temp_array=0;	
	}		
	
		

				
				
				//echo "des eli<br>";print_r($_SESSION['productos'][0]);
}else{


$posItem=$_REQUEST['pos'];
		
		//print_r($_SESSION['productos'][0]);echo "<br>";
		if(isset($_REQUEST['cambiar_precio'])){
		
		
		
		//$moneda_doc=$_REQUEST['moneda'];
		//$mon_ini=$_REQUEST['mon_ini'];
		$precio_nuevo=$_REQUEST['precio_nuevo'];
		$producto=str_pad($_REQUEST['producto'],6, "0", STR_PAD_LEFT);
		
		//echo $producto;
		//echo $mon_ini." ".$tmoneda." ".$precio_nuevo."    ";
		//echo $precio_nuevo;
		
		
			if($mon_ini==$tmoneda){
			
				foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
							
							
							if($_SESSION['productos'][20][$subkey]==$posItem){							
							
							$_SESSION['productos'][2][$subkey]= $precio_nuevo;
							}
				  if($tmoneda=='02'){
				  $_SESSION['productos'][6][$subkey]=$_SESSION['productos'][6][$subkey]*$tc; 
				  }else{
				  $_SESSION['productos'][6][$subkey]=$_SESSION['productos'][6][$subkey]; 
				  }		
				}
				
			//	 echo $producto;
				
			}else{
			
		
				foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
							if($subvalue==$producto){
							$_SESSION['productos2'][2][$subkey] = $precio_nuevo;
							
							//echo $tmoneda." ".$tc;
							if($tmoneda==02){
							$_SESSION['productos'][2][$subkey]=$precio_nuevo*$tc; 	
							//$_SESSION['productos'][6][$subkey]=	number_format(($_SESSION['productos'][6][$subkey]*$tc),4); 					
							}else{
							$_SESSION['productos'][2][$subkey]=$precio_nuevo/$tc; 
							//$_SESSION['productos'][6][$subkey]=	number_format(($_SESSION['productos'][6][$subkey]/$tc),4); 												
							}
						}								
				}
				
				
		   }
	
		}
		
		if(isset($_REQUEST['cambiar_cant'])){
		
		/*
		//echo "entro";
		//$moneda_doc=$_REQUEST['moneda'];
		//$mon_ini=$_REQUEST['mon_ini'];
		$cant_nuevo=$_REQUEST['cant_nuevo'];
		$producto=str_pad($_REQUEST['producto'],6, "0", STR_PAD_LEFT);
		
				
				foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
							
							
							if($_SESSION['productos'][20][$subkey]==$posItem){
							
							$_SESSION['productos'][1][$subkey]= $cant_nuevo;
							}
				 
				}
		
			*/
			
			
		
		$cant_nuevo=$_REQUEST['cant_nuevo'];
		$producto=str_pad($_REQUEST['producto'],6, "0", STR_PAD_LEFT);
		
				
				foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
							
							
							if($_SESSION['productos'][20][$subkey]==$posItem){
							
							$tempCant=$_SESSION['productos'][1][$subkey];
							$_SESSION['productos'][1][$subkey]= $cant_nuevo;
							
							
							//echo $_SESSION['productos'][25][$subkey];
								if($_SESSION['productos'][25][$subkey]=='S'){
								
									foreach ($_SESSION['productos'][0] as $subkey2=> $subvalue2) {
									
										if($_SESSION['productos'][25][$subkey2]==$posItem){
										
										$_SESSION['productos'][1][$subkey2]=$_SESSION['productos'][1][$subkey2]/$tempCant*$cant_nuevo;
										//$tempCant
										
										}
									
									}
									
								
								}
							
							}
				 
				}
	
		
	
		
			
			
		}
		
		
		if(isset($_REQUEST['cambiar_desc'])){
	
		$desc_nuevo=$_REQUEST['desc_nuevo'];
		$producto=str_pad($_REQUEST['producto'],6, "0", STR_PAD_LEFT);
		$cantEnvases=$_REQUEST['cantEnvases'];
		
		//echo $producto;
		//echo $mon_ini." ".$tmoneda." ".$precio_nuevo."    ";
		//echo $precio_nuevo;
				
				if($tipoDesc=='desc1Det'){
					foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
										
						if($subvalue==$producto){
						$_SESSION['productos'][21][$subkey]= $desc_nuevo;
						}
							 
					}
				}
				if($tipoDesc=='desc2Det'){
					foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
										
						if($subvalue==$producto){
						$_SESSION['productos'][22][$subkey]= $desc_nuevo;
						}
							 
					}
				}
				
				
				
				
				
				
	
		}
		if(isset($_REQUEST['ingEnvases'])){
				
					foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
										
						if($subvalue==$producto){
						$_SESSION['productos'][24][$subkey]= $cantEnvases;
						}
							 
					}
				
		}
		
		
		  			
	if($tmoneda!=$mon_ini){	
	 $temp_array=1;	
	}else{
	 $temp_array=0;	
	}	
			
			
		 if(isset($_SESSION['temp_series'][0])){
		  
			  foreach ($_SESSION['temp_series'][0] as $subkey=> $subvalue) {
			  			  
			  $_SESSION['seriesprod'][0][]=$_SESSION['temp_series'][0][$subkey];
			  $_SESSION['seriesprod'][1][]=$_SESSION['temp_series'][1][$subkey];
			  $_SESSION['seriesprod'][2][]=$_SESSION['temp_series'][2][$subkey];
			  }
						  			  		  
			  unset($_SESSION['temp_series'][0]);
			  unset($_SESSION['temp_series'][1]);
			  unset($_SESSION['temp_series'][2]);
		  }

         
		//	print_r($_SESSION['temp_series'][0]);echo "<br>";
		//	print_r($_SESSION['temp_series'][1]);echo "<br>";
		//	print_r($_SESSION['temp_series'][2]);echo "<br>";
			
			
  		 	//	 echo $temp_array."<br>";	
			//	 print_r($_SESSION['productos'][2]);
			//	 print_r($_SESSION['productos2'][2]);
				 
 			if($accion=="mostrarprod"){
				 	
					//$desabilitar="";
					if($estado=="A"){
						$verestado="ANULADO";
						$desabilitar=" readonly='readonly' ";
					}else{
							if(isset($_REQUEST['cargar_ref'])){
							$verestado="INGRESO";
					 	        if($_REQUEST['copiarDoc']=='S'){
								$desabilitar="  ";
								}
								
							}else{			  
								$verestado="CONSULTA";
								//$desabilitar=" readonly='readonly' ";
								$desabilitar=" disabled ";
								
							}
					 }
				 
				 
				/* $_SESSION['productos3'][0]=$_SESSION['productos2'][0];
				 $_SESSION['productos3'][1]=$_SESSION['productos2'][1];
				 $_SESSION['productos3'][2]=$_SESSION['productos2'][2];
				 $_SESSION['productos3'][3]=$_SESSION['productos2'][3];
				 $_SESSION['productos3'][4]=$_SESSION['productos2'][4];
				*/
				// echo "ddddddd";
				 $_SESSION['productos3'][0]=$_SESSION['productos'][0];
				 $_SESSION['productos3'][1]=$_SESSION['productos'][1];
				 $_SESSION['productos3'][2]=$_SESSION['productos'][2];
				 $_SESSION['productos3'][3]=$_SESSION['productos'][3];
				 $_SESSION['productos3'][4]=$_SESSION['productos'][4];
				 $_SESSION['productos3'][5]=$_SESSION['productos'][5];
				 $_SESSION['productos3'][6]=$_SESSION['productos'][6];
				 $_SESSION['productos3'][12]=$_SESSION['productos'][12];
				 $_SESSION['productos3'][13]=$_SESSION['productos'][13];
				 $_SESSION['productos3'][14]=$_SESSION['productos'][14];
				 $_SESSION['productos3'][20]=$_SESSION['productos'][20];
				 $_SESSION['productos3'][21]=$_SESSION['productos'][21];
				 $_SESSION['productos3'][22]=$_SESSION['productos'][22];
				 
				 $_SESSION['productos3'][24]=$_SESSION['productos'][24];
				 $_SESSION['productos3'][25]=$_SESSION['productos'][25];
				  $_SESSION['productos3'][26]=$_SESSION['productos'][26];
				  $_SESSION['productos3'][27]=$_SESSION['productos'][27];
				  $_SESSION['productos3'][28]=$_SESSION['productos'][28];
			
			
			}else{
				//echo "dsg";
				if($accion=="cambiar_dolar"){
							
					unset($_SESSION['productos2'][0]);
				    unset($_SESSION['productos2'][1]); 
				    unset($_SESSION['productos2'][2]); 
					unset($_SESSION['productos2'][3]); 
					unset($_SESSION['productos2'][4]);
					unset($_SESSION['productos2'][5]);
					unset($_SESSION['productos2'][6]);  
					unset($_SESSION['productos2'][12]);
					unset($_SESSION['productos2'][13]);  
					unset($_SESSION['productos2'][14]);  
					unset($_SESSION['productos2'][20]);  
					unset($_SESSION['productos2'][21]);  
					unset($_SESSION['productos2'][22]); 	
									
					unset($_SESSION['productos2'][24]); 
					unset($_SESSION['productos2'][25]);
					unset($_SESSION['productos2'][26]); 
					unset($_SESSION['productos2'][27]);
					unset($_SESSION['productos2'][28]);  
				
					  foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
						$_SESSION['productos2'][0][$subkey] = $subvalue;
						$_SESSION['productos2'][1][$subkey] = $_SESSION['productos'][1][$subkey];	
						$_SESSION['productos2'][3][$subkey]=  $_SESSION['productos'][3][$subkey];
						$_SESSION['productos2'][4][$subkey]=  $_SESSION['productos'][4][$subkey];
						$_SESSION['productos2'][5][$subkey]=  $_SESSION['productos'][5][$subkey];
						$_SESSION['productos2'][6][$subkey]=  $_SESSION['productos'][6][$subkey];
						$_SESSION['productos2'][12][$subkey]=  $_SESSION['productos'][12][$subkey];
						$_SESSION['productos2'][13][$subkey]=  $_SESSION['productos'][13][$subkey];
						$_SESSION['productos2'][14][$subkey]=  $_SESSION['productos'][14][$subkey];
						$_SESSION['productos2'][20][$subkey]=  $_SESSION['productos'][20][$subkey];
						
						$_SESSION['productos2'][21][$subkey]=  $_SESSION['productos'][21][$subkey];
						$_SESSION['productos2'][22][$subkey]=  $_SESSION['productos'][22][$subkey];
						
						$_SESSION['productos2'][24][$subkey]=  $_SESSION['productos'][24][$subkey];
						$_SESSION['productos2'][25][$subkey]=  $_SESSION['productos'][25][$subkey];
						$_SESSION['productos2'][26][$subkey]=  $_SESSION['productos'][26][$subkey];
						$_SESSION['productos2'][27][$subkey]=  $_SESSION['productos'][27][$subkey];
						$_SESSION['productos2'][28][$subkey]=  $_SESSION['productos'][28][$subkey];
							
						 
						 if($subvalue!=""){	
							
												
							 if($tmoneda!=$mon_ini){						
							
								if($tmoneda=='02'){
								$_SESSION['productos2'][2][$subkey] = number_format(($_SESSION['productos'][2][$subkey]/$tc),4,'.','');		
								}else{
								$_SESSION['productos2'][2][$subkey] = number_format(($_SESSION['productos'][2][$subkey]*$tc),4,'.','');					
								}
							}else{
							$_SESSION['productos2'][2][$subkey] = number_format($_SESSION['productos'][2][$subkey],4,'.','');				
							
							}
						}else{
						$_SESSION['productos2'][2][$subkey] = $_SESSION['productos'][2][$subkey];
						}
						
					  }
				 $temp_array=1;	
													
				}else{
					$repet_item='N';
									
					if($_REQUEST['esserie']=='S' && isset($_SESSION['productos'][0]) ){
						
						foreach ($_SESSION['productos'][0] as $subkey=> $subvalue) {
					    	if($subvalue==$cod_prod){
							$_SESSION['productos'][1][$subkey] = $_SESSION['productos'][1][$subkey] + $cantidad;
							$repet_item='S';
							}
						}
											
					}
					
					  if($tmoneda!=$mon_ini){	
						if($repet_item=='N'){
						
						$_SESSION['productos2'][0][] = $cod_prod;
						$_SESSION['productos2'][1][] = $cantidad;	
						$_SESSION['productos2'][2][] = $punitario;	
						$_SESSION['productos2'][3][] = $notas;
						$_SESSION['productos2'][4][] = $presentacion;
						$_SESSION['productos2'][5][] = $presentacion;
						$_SESSION['productos2'][6][] = $precosto;
						$_SESSION['productos2'][12][] = $codAnexProd;
						$_SESSION['productos2'][13][] = $termino;
						$_SESSION['productos2'][14][] = $pase;
						$_SESSION['productos2'][20][] = count($_SESSION['productos2'][20])+1;
						
						$_SESSION['productos2'][21][] = 0.00;
						$_SESSION['productos2'][22][] = 0.00;
						
						$_SESSION['productos2'][24][] = $pcajas;
						$_SESSION['productos2'][25][] = "";
						$_SESSION['productos2'][26][] = "";
						$_SESSION['productos2'][27][] = $des_lote;
						$_SESSION['productos2'][28][] = $venc_lote;
						
						
											
						if($tmoneda=='02'){
							$_SESSION['productos'][2][] = number_format(($punitario*$tc),4,'.','');		
						}else{
							$_SESSION['productos'][2][] = number_format(($punitario/$tc),4,'.','');					
						}
						
						$_SESSION['productos'][0][] = $cod_prod;
						$_SESSION['productos'][1][] = $cantidad;	
						//$_SESSION['productos'][2][] = $punitario;	
						$_SESSION['productos'][3][] = $notas;
						$_SESSION['productos'][4][] = $presentacion;
						$_SESSION['productos'][5][] = $presentacion;
						$_SESSION['productos'][6][] = $precosto;
						$_SESSION['productos'][12][] = $codAnexProd;
						$_SESSION['productos'][13][] = $termino;
						$_SESSION['productos'][14][] = $pase;
						$_SESSION['productos'][20][] = count($_SESSION['productos'][20])+1;
						
						$_SESSION['productos'][21][] = 0.00;
						$_SESSION['productos'][22][] = 0.00;
						
						$_SESSION['productos'][24][] = $pcajas;
						$_SESSION['productos'][25][] = "";
						$_SESSION['productos'][26][] = "";
						$_SESSION['productos'][27][] = $des_lote;
						$_SESSION['productos'][28][] = $venc_lote;
											
						}
						$temp_array=1;
					}else{
					
					//echo $cantidad." ".$punitario." ".$termino;
					
						$_SESSION['productos'][0][] = $cod_prod;
						$_SESSION['productos'][1][] = $cantidad;	
						$_SESSION['productos'][2][] = $punitario;	
						$_SESSION['productos'][3][] = $notas;
						$_SESSION['productos'][4][] = $presentacion;
						$_SESSION['productos'][5][] = $presentacion;
						$_SESSION['productos'][6][] = $precosto;
						$_SESSION['productos'][12][] = $codAnexProd;
						$_SESSION['productos'][13][] = $termino;
						$_SESSION['productos'][14][] = $pase;
						$_SESSION['productos'][20][] = count($_SESSION['productos'][20])+1;
						$_SESSION['productos'][21][] = 0.00;
						$_SESSION['productos'][22][] = 0.00;
						
						$_SESSION['productos'][24][] = $pcajas;
						
						$_SESSION['productos'][27][] = $des_lote;
						$_SESSION['productos'][28][] = $venc_lote;
						
						$temp_array=0;
												
						//******************************* modelos **********************
						$tempPosModel=count($_SESSION['productos'][20]);
						// unset($_SESSION['productos']);
						// echo"antes".
						//print_r($_SESSION['productos'][0])."<br><br>";
					
					$strSQL4x="select md.*,m.cantidad as factor from modelo m,modelo_det md where m.cod_mod=md.cod_mod and  m.cod_prod='".$cod_prod."' order by md.cod_mdet ";
					
					//echo $strSQL4x;
	 				$resultado4x=mysql_query($strSQL4x,$cn);
					$contModel=mysql_num_rows($resultado4x);
					
						if($contModel>0 && $stockProd <= 0){
						
						$_SESSION['productos'][25][] = "S";
						$_SESSION['productos'][26][]= "";
						
						//echo $cantidad;
							while($rowModel=mysql_fetch_array($resultado4x)){
							
							$tempFactor=$cantidad/$rowModel['factor'];
							
							$_SESSION['productos'][0][] = $rowModel['cod_prod'];
							$_SESSION['productos'][1][] = $rowModel['cantidad']*$tempFactor;	
							$_SESSION['productos'][2][] = $rowModel['precio'];	
							$_SESSION['productos'][3][] = $notas;
							$_SESSION['productos'][4][] = $rowModel['unidad'];
							$_SESSION['productos'][5][] = $rowModel['unidad'];
							$_SESSION['productos'][6][] = 0.00;
							$_SESSION['productos'][12][] = "";
							$_SESSION['productos'][13][] = "";
							$_SESSION['productos'][14][] = "";
							$_SESSION['productos'][20][] = count($_SESSION['productos'][20])+1;
							$_SESSION['productos'][21][] = 0.00;
							$_SESSION['productos'][22][] = 0.00;						
							$_SESSION['productos'][24][] = "";
							$_SESSION['productos'][25][] = $tempPosModel;
							
							$_SESSION['productos'][26][] = $cod_prod;
							$_SESSION['productos'][27][] = $des_lote;
							$_SESSION['productos'][28][] = $venc_lote;
							
							}
							
						//	print_r($_SESSION['productos'][0])."<br><br>";
												
						}else{
						$_SESSION['productos'][25][] = "";
						$_SESSION['productos'][26][] = "";
						
						}							
					
					//***********************************************************
						
						//print_r($_SESSION['productos'][0])."<br><br>";
					}	
							
				}
				
		   }
			
 	}	
	
	
 
 
 //print_r($_SESSION['productos'][0]) ;echo "  ".$tmoneda." ".$mon_ini;

 //  print_r($_SESSION['productos']);
	 
	 /*
	  if($accion=='eliminar'){
	 
	  }else{
	  $cont=0; 	
	  $strSQL1="select * from producto where cod_prod='$cod_prod'";
	  $resultado1=mysql_query($strSQL1,$cn);
	  $cont=mysql_num_rows($resultado1);
		  while($row1=mysql_fetch_array($resultado1)){
		   $nom_prod=$row1['nombre'];
		   $precio=$row1['precio'];
		   $unidad=$row1['nom_unid'];
		  }
		
	  mysql_free_result($resultado1);
	 	 	  
	  }
	  
	  */
 
// 	if(!isset($_REQUEST['cargar_ref'])){
/*
print_r($_SESSION['productos'][0]);
echo "<br>";
print_r($_SESSION['productos'][2]);
echo "<br>--$tmoneda  $mon_ini---$temp_array--<br>";
print_r($_SESSION['productos2'][0]);
echo "<br>";
print_r($_SESSION['productos2'][2]);
echo "<br>";
 */
//print_r($_SESSION['seriesprod'][0])."  ". print_r($_SESSION['seriesprod'][1])." ". print_r($_SESSION['seriesprod'][2]);


 //echo 
		 //unset($_SESSION['productos3']);
		 if($temp_array==1){
		//echo ">>>>";
		
		 $_SESSION['productos3'][0]=$_SESSION['productos2'][0];
		 $_SESSION['productos3'][1]=$_SESSION['productos2'][1];
		 $_SESSION['productos3'][2]=$_SESSION['productos2'][2];
		 $_SESSION['productos3'][3]=$_SESSION['productos2'][3];
         $_SESSION['productos3'][4]=$_SESSION['productos2'][4];
         $_SESSION['productos3'][5]=$_SESSION['productos2'][5];
		 $_SESSION['productos3'][6]=$_SESSION['productos2'][6];
		 $_SESSION['productos3'][12]=$_SESSION['productos2'][12];
		 $_SESSION['productos3'][13]=$_SESSION['productos2'][13];
		 $_SESSION['productos3'][14]=$_SESSION['productos2'][14];
	     $_SESSION['productos3'][20]=$_SESSION['productos2'][20];
		 $_SESSION['productos3'][21]=$_SESSION['productos2'][21];
		 $_SESSION['productos3'][22]=$_SESSION['productos2'][22];
		 $_SESSION['productos3'][23]=$_SESSION['productos2'][23];
		 $_SESSION['productos3'][24]=$_SESSION['productos2'][24];
		 $_SESSION['productos3'][25]=$_SESSION['productos2'][25];
		 $_SESSION['productos3'][26]=$_SESSION['productos2'][26];
		 $_SESSION['productos3'][27]=$_SESSION['productos2'][27];
		 $_SESSION['productos3'][28]=$_SESSION['productos2'][28];
		
		 }else{
		 
		 
		 $_SESSION['productos3'][0]=$_SESSION['productos'][0];
		 $_SESSION['productos3'][1]=$_SESSION['productos'][1];
		 $_SESSION['productos3'][2]=$_SESSION['productos'][2];
         $_SESSION['productos3'][3]=$_SESSION['productos'][3];
		 $_SESSION['productos3'][4]=$_SESSION['productos'][4];
 		 $_SESSION['productos3'][5]=$_SESSION['productos'][5];
		 $_SESSION['productos3'][6]=$_SESSION['productos'][6];
 		 $_SESSION['productos3'][12]=$_SESSION['productos'][12];
		 $_SESSION['productos3'][13]=$_SESSION['productos'][13];
		 $_SESSION['productos3'][14]=$_SESSION['productos'][14];
		 $_SESSION['productos3'][20]=$_SESSION['productos'][20];
		 $_SESSION['productos3'][21]=$_SESSION['productos'][21];
		 $_SESSION['productos3'][22]=$_SESSION['productos'][22];
		 $_SESSION['productos3'][23]=$_SESSION['productos'][23];
		 $_SESSION['productos3'][24]=$_SESSION['productos'][24];		 
		 $_SESSION['productos3'][25]=$_SESSION['productos'][25];
		 $_SESSION['productos3'][26]=$_SESSION['productos'][26];
		 $_SESSION['productos3'][27]=$_SESSION['productos'][27];
		 $_SESSION['productos3'][28]=$_SESSION['productos'][28];
		 
		 }
	 
//	} 

 $items=0;
 $total_inafecto=0;

 // print_r($_SESSION['productos'][0]);echo "<br>";
   
//print_r($_SESSION['productos3'][23]);echo "<br>";
/*
$_SESSION['productos3'][0]=array_reverse($_SESSION['productos3'][0]);
$_SESSION['productos3'][1]=array_reverse($_SESSION['productos3'][1]);
$_SESSION['productos3'][2]=array_reverse($_SESSION['productos3'][2]);
$_SESSION['productos3'][3]=array_reverse($_SESSION['productos3'][3]);
$_SESSION['productos3'][4]=array_reverse($_SESSION['productos3'][4]);
$_SESSION['productos3'][5]=array_reverse($_SESSION['productos3'][5]);
$_SESSION['productos3'][6]=array_reverse($_SESSION['productos3'][6]);
$_SESSION['productos3'][12]=array_reverse($_SESSION['productos3'][12]);
$_SESSION['productos3'][13]=array_reverse($_SESSION['productos3'][13]);
$_SESSION['productos3'][14]=array_reverse($_SESSION['productos3'][14]);
$_SESSION['productos3'][20]=array_reverse($_SESSION['productos3'][20]);
$_SESSION['productos3'][21]=array_reverse($_SESSION['productos3'][21]);
$_SESSION['productos3'][22]=array_reverse($_SESSION['productos3'][22]);
*/
      $k=1;
	  
	  
	 // asort($_SESSION['lotes']);
	  
if(isset($_SESSION['productos3'][0])){

foreach ($_SESSION['productos3'][0] as $subkey=> $subvalue) {

   if($subvalue!=""){
 
	 $strSQL4="select * from producto where idproducto='".$subvalue."' ";
	 $resultado4=mysql_query($strSQL4,$cn);
	 //echo $strSQL4;
	  
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
	  	  	  
	 // echo $AnexNomEti1;
?>
        <tr title="<?php echo "$AnexNomEti1 : ".$_SESSION['productos3'][12][$subkey]?>">
          <td align="center" bgcolor="#FFFFFF" class="Estilo_det" ><a name="anclax<?php echo $k;?>" id="anclax"  style='cursor=pointer; text-decoration:underline' onclick='espec_prod(this)'><?php echo $row4['idproducto']?></a></td>
          <td bgcolor="#FFFFFF" class="Estilo_det"  >
		  
		  <?php 
		   if($_SESSION['productos3'][25][$subkey]!='' && $_SESSION['productos3'][25][$subkey]!='S'){
		  		   
		   echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp";
		   
		   }
		  
		  echo caracteres($row4['nombre']);
		  
		  if($_SESSION['productos3'][25][$subkey]=='S'){
		  
		  echo "<span  style='color:#FF3300; font:bold'>*</span>";	  
		  
		  }
		  
		  ?>
		  
		  </td>
          <td align="center" bgcolor="#FFFFFF" class="Estilo_det" ><?php 
		  $strSQL_subuni="select * from unidades where id='".$_SESSION['productos3'][4][$subkey]."'";
		 // echo $strSQL_subuni;
		  $resultado=mysql_query($strSQL_subuni,$cn); 
		  $row=mysql_fetch_array($resultado);
		  echo $row['nombre'];
		   
		  ?>		  </td>
		  <td align="center" bgcolor="#FFFFFF" class="Estilo_det" ><?php 
		  
		 // echo $permiso;
		// echo $_REQUEST['cargar_ref'];
		//  if($_SESSION['productos3'][5][$subkey]!='ref'){
		  
			  //if($manejaserie=='S' && $permiso10=='S' ){
			  if(($manejaserie=='S' || $manejaLote=='S') && $permiso10=='S' ){
				
			//  echo "<a title='mostrar series' style='cursor:pointer; text-decoration:underline' onclick=editar_serie('".$row4['idproducto']."',this)>".$_SESSION['productos3'][1][$subkey]."</a>" ; 
			  
			  	  if($manejaserie=='S'){
			  echo "<a title='mostrar series' style='cursor:pointer; text-decoration:underline' onclick=editar_serie('".$row4['idproducto']."',this)>".$_SESSION['productos3'][1][$subkey]."</a>" ; 
				  }else{
			  echo "<a title='mostrar Lote' style='cursor:pointer; text-decoration:underline' onclick=editar_lote('".$_SESSION['productos3'][27][$subkey]."','".$_SESSION['productos3'][28][$subkey]."')>".$_SESSION['productos3'][1][$subkey]."</a>" ; 	  
				  }			  
			  
			  
			  }else{
			  
			 //echo $_SESSION['productos3'][25][$subkey]."--->".$_SESSION['productos3'][26][$subkey]." "; 
			  
			  if($_SESSION['productos3'][25][$subkey]=='S' || $_SESSION['productos3'][26][$subkey]==''){			
				$disabled_cant=' ';			
				}else{
				$disabled_cant=' disabled ';
				//$ocultar_precio=' visibility:hidden ';
			  }
			  
			  ?>
			  
			  <input <?php echo $desabilitar; echo $disabled_cant; ?> style="text-align:right" name="cant_det[]" type="text" id="cant_det" value="<?php echo number_format($_SESSION['productos3'][1][$subkey],4) ; ?>" size="8" maxlength="10" onkeyup="recalcular_cant(this,'<?php echo $_SESSION['productos3'][0][$subkey] ?>',event,'<?php echo $row4['precio5'] ?>','<?php echo $row4['moneda'] ?>','<?php echo $_SESSION['productos3'][1][$subkey]?>','<?php echo $_SESSION['productos3'][20][$subkey]?>')" onkeydown="prev_validarNumero2(this,event,'<?php echo $_SESSION['productos3'][4][$subkey]?>')" />
			  
			  	<input  style="text-align:right" name="cant_det2[]" type="hidden" id="cant_det2" value="<?php echo $stockItem; ?>" size="8" maxlength="10" />
			  
			  <?php 			  
			// echo $_SESSION['productos3'][20][$subkey];
			  }
			  
		 // }else{
		  //echo $_SESSION['productos3'][1][$subkey] ; 
		  //}	  
		  
		 /*
			  if($tmoneda=='02'){
			  $punit_conv=$_SESSION['productos3'][6][$subkey]/$tc;
			  }else{
			  $punit_conv=$_SESSION['productos3'][6][$subkey];
			  }
		*/	  
			  
			// print_r($_SESSION['productos3'][0][$subkey]); 
			
			$disabledCajas=" disabled ";
			if($factorCant==1000){
			$disabledCajas="";
			}
			
						  			  
		  ?>		  </td>
          <td width="60" align="center" bgcolor="#FFFFFF" class="Estilo_det" <?php echo $ocularEnvases; ?>>
		  <input  style="text-align:center" <?php echo $disabledCajas; ?> type="text" name="cantCajas" id="cantCajas" size="6" maxlength="10" onkeypress="ingEnvases(this,'<?php echo $_SESSION['productos3'][0][$subkey] ?>',event)" value="<?php if($_SESSION['productos3'][24][$subkey]=='')echo "0"; else echo $_SESSION['productos3'][24][$subkey];?>" />		  </td>
          <td width="49" align="right" bgcolor="#FFFFFF" class="Estilo_det" >
		  
		    <input name="precosto_det" type="hidden" id="precosto_det" value="<?php echo $punit_conv; ?>" size="8" maxlength="10" />
			<?php //if(isset($_REQUEST['copiar'])) $desabilitar=""; 
			//echo $_SESSION['productos3'][25][$subkey]."--->".$_SESSION['productos3'][26][$subkey]." "; 
			
			
			if($_SESSION['productos3'][25][$subkey]=='' && $_SESSION['productos3'][26][$subkey]==''){			
			$disabled_precio=' ';			
			}else{
			//$disabled_precio=' disabled ';
			
			}
			
			if($permiso_modifPrecio=='S'){
			$disabled_precio=' disabled ';			
			}
			
			?>
					
			<input <?php echo $desabilitar; echo $disabled_precio;?> style="text-align:right; <?php echo $ocultar_precio?>" name="punit_det[]" type="text" id="punit_det" value="<?php echo number_format($_SESSION['productos3'][2][$subkey],4) ; ?>" size="8" maxlength="10" onkeyup="recalcular_precios(this,'<?php echo $_SESSION['productos3'][0][$subkey] ?>',event,'<?php echo $row4['precio5'] ?>','<?php echo $row4['moneda'] ?>','<?php echo $_SESSION['productos3'][2][$subkey]?>','<?php echo $_SESSION['productos3'][1][$subkey]?>','<?php echo $_SESSION['productos3'][20][$subkey]?>')" />				
			
			</td>			
          <td  width="34" align="right" bgcolor="#FFFFFF" class="Estilo_det" <?php echo $ocularDesc?>><input <?php echo $desabilitar; ?> style="text-align:right" type="text" name="desc1Det" id="desc1Det" size="8" maxlength="10"  onkeypress="recalcular_desc(this,'<?php echo $_SESSION['productos3'][0][$subkey] ?>',event,'<?php echo $row4['precio5'] ?>','<?php echo $row4['moneda'] ?>','<?php echo $_SESSION['productos3'][21][$subkey]?>','<?php echo $_SESSION['productos3'][22][$subkey]?>','<?php echo $_SESSION['productos3'][2][$subkey]?>','<?php echo $_SESSION['productos3'][1][$subkey]?>',<?php echo $k; ?>)" value="<?php echo $_SESSION['productos3'][21][$subkey]?>" /></td>
		  
          <td width="36" align="right" bgcolor="#FFFFFF" class="Estilo_det" <?php echo $ocularDesc2?>><input style="text-align:right" <?php echo $desabilitar; ?> type="text" name="desc2Det" id="desc2Det" size="8" maxlength="10" onkeypress="recalcular_desc(this,'<?php echo $_SESSION['productos3'][0][$subkey] ?>',event,'<?php echo $row4['precio5'] ?>','<?php echo $row4['moneda'] ?>','<?php echo $_SESSION['productos3'][22][$subkey]?>','<?php echo $_SESSION['productos3'][21][$subkey]?>','<?php echo $_SESSION['productos3'][2][$subkey]?>','<?php echo $_SESSION['productos3'][1][$subkey]?>',<?php echo $k; ?>)" value="<?php echo $_SESSION['productos3'][22][$subkey]?>" /></td>
          <td align="right" bgcolor="#FFFFFF" class="Estilo_det" >
		   		
		  <?php		
		  $k++;
		if($row4['igv']=='N'){
		$total_inafecto=$total_inafecto+$_SESSION['productos3'][1][$subkey] * $_SESSION['productos3'][2][$subkey] ;
		//echo number_format($total_inafecto,2)." &nbsp;";
		echo number_format($_SESSION['productos3'][1][$subkey] * $_SESSION['productos3'][2][$subkey],2)." &nbsp;";
		
		//factor subunidad // factor subunidad diferente
			if($percep_suc=='S'){
				if($percep_doc=='S'){
			//echo "dg";
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
		
		 $totalitem=$_SESSION['productos3'][1][$subkey] * $_SESSION['productos3'][2][$subkey] ;
		 $xtotalitem=$_SESSION['productos3'][1][$subkey] * $_SESSION['productos3'][2][$subkey] ;
		 
		 $valventa=$valventa + $_SESSION['productos3'][1][$subkey] * $_SESSION['productos3'][2][$subkey] ;
		 
		 if($tipoDescDoc=='P'){
			 $tempDesc1=$totalitem*($_SESSION['productos'][21][$subkey]/100);
			 $tempDesc2=($totalitem-$tempDesc1)*($_SESSION['productos'][22][$subkey]/100);
		 }else{
			 $tempDesc1=$_SESSION['productos'][21][$subkey];
			 $tempDesc2=0;
		 
		 }
		 
		 //echo $tempDesc1." + ".$tempDesc1;
		 //$descTotal=$descTotal+($tempDesc1+$tempDesc2);
		 if($tipoDescDoc=='P'){		 
			 $totalitem=$totalitem-($totalitem*($_SESSION['productos'][21][$subkey]/100));
			 $totalitem=$totalitem-($totalitem*($_SESSION['productos'][22][$subkey]/100));
		 }else{
		 	$totalitem=$totalitem-$_SESSION['productos'][21][$subkey];
			
		 }
		 
		 
		 
		 $total=$total + number_format($totalitem,2,'.','');
		 //echo $totalitem."<br>";
		 $totalitem2=$_SESSION['productos'][1][$subkey] * $_SESSION['productos'][2][$subkey] ;
		 if($tipoDescDoc=='P'){
			 $totalitem2=$totalitem2-($totalitem2*($_SESSION['productos'][21][$subkey]/100));
			 $totalitem2=$totalitem2-($totalitem2*($_SESSION['productos'][22][$subkey]/100));
		 }else{
		     $totalitem2=$totalitem2-$_SESSION['productos'][21][$subkey];
			 //$totalitem2=$totalitem2-($totalitem2*($_SESSION['productos'][22][$subkey]/100));			 		 
		 }
		 
		 $total2=$total2 + number_format($totalitem2,2,'.','');
		 	  
		 ?>
		 
		 
		 <input <?php echo $desabilitar; echo $disabled_precio; ?> style="text-align:right" name="ptotal_det[]" type="text" id="ptotal_det" value="<?php echo number_format($totalitem,2) ; ?>" size="8" maxlength="10" onkeyup="recalcular_precios(this,'<?php echo $_SESSION['productos3'][0][$subkey] ?>',event,'<?php echo $row4['precio5'] ?>','<?php echo $row4['moneda'] ?>','<?php echo $_SESSION['productos3'][2][$subkey]?>','<?php echo $_SESSION['productos3'][1][$subkey]?>','<?php echo $_SESSION['productos3'][20][$subkey]?>')" />
		 
		 <?php  
		// echo number_format($totalitem,2)." &nbsp;";
		 /*
		 if($permiso27=='S'){
		  	 if($swicthpuntos=='V'){
				$totPuntos=$totPuntos+floor($totalitem)*$cantpuntos;
				
			 }
		 }	 
		*/	 
		 	
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
		 	
		
		 
		 ?>		 </td>
          <td align="left" bgcolor="#FFFFFF" style="cursor:pointer" class="Estilo_det" title="<?php echo $_SESSION['productos3'][3][$subkey] ; ?>" ><?php 
		  if($_SESSION['productos3'][3][$subkey]!=""){
		  echo  substr($_SESSION['productos3'][3][$subkey],0,6)."<span style='color:#0033FF'>...</span>" ; 
		  }
		  ?></td>
          <td align="center" bgcolor="#FFFFFF">
		  
		  <?php 
		 // if($_SESSION['productos3'][25][$subkey]=='' || $_SESSION['productos3'][25][$subkey]=='S'){
		  ?>		  		  
		  <a href="javascript:eliminar('<?php echo $_SESSION['productos3'][20][$subkey]?>','<?php echo $row4['idproducto'] ?>')"><img src="<?php echo $ruta_imagen;?>" alt="Eliminar Item" width="14" height="14" border="0" /></a>		  
		  <?php //} ?>
		  
		  </td>
        </tr>
        <?php 
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
								//if($swicthpuntos=='C'){
								//$totPuntos=$totPuntos+floor($_SESSION['productos3'][1][$subkey])*$cantpuntos;
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


		// echo $verestado;
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
						 						 
						 echo $_SESSION['productos3'][2][$subkey]*$_SESSION['productos3'][1][$subkey] / $rowOferta['cantOferta'];
						 
					     $tempCant=explode(".",$_SESSION['productos3'][1][$subkey]*$_SESSION['productos3'][2][$subkey] / $rowOferta['cantOferta']);
					 
					 	 $cantBoni=$tempCant[0]*$rowOferta['cantBoni'];	
					 	 $strSQL_subuni="select * from unidades where id='".$rowOferta['undBoni']."'";
		 // echo $strSQL_subuni;
						  $resultado=mysql_query($strSQL_subuni,$cn); 
						  $row=mysql_fetch_array($resultado);
						  $unidOferta=$row['nombre'];
						  
						  $_SESSION['boni'][0][]=$rowOferta['codprodBoni'];
						  $_SESSION['boni'][1][]=$rowOferta['nombreBoni'];
						  $_SESSION['boni'][2][]=$rowOferta['undBoni'];
						  $_SESSION['boni'][3][]=$cantBoni;
						  $_SESSION['boni'][4][]=$rowOferta['codprodOferta'];
						  					 
							echo "<tr bgcolor='#FFFFFF'>
							<td align='center' style='color:#0099FF'>".$rowOferta['codprodBoni']."</td>
							<td style='color:#0099FF'>".$rowOferta['nombreBoni']."</td>
							<td align='center' style='color:#0099FF'>".$unidOferta."</td>
							<td align='center' style='color:#0099FF'>".$cantBoni."</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							</tr>";
					
						} 
						
						mysql_free_result($resultadoOferta);
					//print_r($_SESSION['boni']) ;
					}else{
					///echo "asf";
					    if(isset($_SESSION['boni'][0])){
							foreach ($_SESSION['boni'][0] as $subkey2=> $subvalue2) {
								if($_SESSION['boni'][4][$subkey2]==$row4['idproducto']){
								echo "<tr bgcolor='#FFFFFF'>
								<td align='center' style='color:#0099FF'>".$_SESSION['boni'][0][$subkey2]."</td>
								<td style='color:#0099FF'>".$_SESSION['boni'][1][$subkey]."</td>
								<td align='center' style='color:#0099FF'>".$_SESSION['boni'][2][$subkey2]."</td>
								<td align='center' style='color:#0099FF'>".$_SESSION['boni'][3][$subkey2]."</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								</tr>";
								}
							
							}
						}
					
					}
					
		     }
		
		}
		
		mysql_free_result($resultado4);
		
    }else{
	
	
	?>
        <tr style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
          <td align="center" bgcolor="#FFFFFF" >&nbsp;</td>
          <td bgcolor="#FFFFFF" ><?php
		 	$tempTexto=$_SESSION['productos3'][20][$subkey];
		  echo "<input readonly ondblclick='editTexto(this)' onkeyup='saveTexto(this,event,\"$tempTexto\")' name='prodTexto[]' id='prodTexto' type='text' style='border:none' size='40' value='".$_SESSION['productos3'][13][$subkey]."'  />";
		  
		  if($_SESSION['productos3'][14][$subkey]=='S')echo "<span style='color:#FF0000'> &nbsp;(*)</span>";
		   ?></td>
          <td align="right" bgcolor="#FFFFFF" >&nbsp;</td>
          <td align="center" bgcolor="#FFFFFF"><?php  echo  $_SESSION['productos3'][1][$subkey] ;   ?></td>
          <td align="center" bgcolor="#FFFFFF" <?php echo $ocularEnvases; ?>>&nbsp;</td>
          <td align="left" bgcolor="#FFFFFF" ><input   readonly="" <?php //echo $desabilitar; ?> style="text-align:right; border:none" name="punit_det2[]" type="text" id="punit_det" value="<?php 
		  if($_SESSION['productos3'][14][$subkey]=='S'){
		  echo number_format($_SESSION['productos3'][2][$subkey],4) ; 
		  }else{
		  echo $_SESSION['productos3'][2][$subkey] ; 
		  }
		  ?>" size="8" maxlength="10" onkeyup="recalcular_precios(this,'<?php echo $_SESSION['productos3'][0][$subkey] ?>',event,'<?php echo $row4['precio5'] ?>','<?php echo $row4['moneda'] ?>','<?php echo $_SESSION['productos3'][2][$subkey]?>')" /></td>
			
          <td align="left" bgcolor="#FFFFFF" <?php echo $ocularDesc?> >&nbsp;</td>
          <td align="left" bgcolor="#FFFFFF" <?php echo $ocularDesc2?>>&nbsp;</td>
          <td align="right" bgcolor="#FFFFFF" ><?php 
         
		 $totalitem=$_SESSION['productos3'][1][$subkey] * $_SESSION['productos3'][2][$subkey] ;
		 $total=$total + $totalitem;
		 //echo $totalitem."<br>";
		 $totalitem2=$_SESSION['productos'][1][$subkey] * $_SESSION['productos'][2][$subkey] ;
		 $total2=$total2 + $totalitem2;
		 
		 if($_SESSION['productos3'][14][$subkey]=='S'){
		 echo number_format($totalitem,2)." &nbsp;";
		 }else{
		 //echo "";
		 echo number_format($totalitem,2)." &nbsp;";//cencarsac
		 }
		  
		  ?></td>
             <td align="left" bgcolor="#FFFFFF" style="cursor:pointer" class="Estilo_det" title="<?php echo $_SESSION['productos3'][3][$subkey] ; ?>" ><?php 
		  if($_SESSION['productos3'][3][$subkey]!=""){
		  echo  substr($_SESSION['productos3'][3][$subkey],0,6)."<span style='color:#0033FF'>...</span>" ; 
		  }
		  ?></td>
		  
          <td align="center" bgcolor="#FFFFFF"><a href="javascript:eliminar('<?php echo $_SESSION['productos3'][20][$subkey]; ?>')"><img src="<?php echo $ruta_imagen;?>" width="14" height="14" border="0" /></a></td>
        </tr>
        <?php 
	
	
	}
	  
}

}//fin if 

  if($tmoneda==02){
  $total_percepcion_temp=$total_percepcion_2*$tc;
  }else{
  $total_percepcion_temp=$total_percepcion_2;
  }
 // echo $total_percepcion_temp ." ". $min_percep_doc ;
  if($total_percepcion_temp < $min_percep_doc){
  $total_percepcion=0;
  }
  
  if(isset($_REQUEST['percep_recp'])){
  $total_percepcion=$_REQUEST['percep_recp'];
  }
 
  $total=number_format($total,2,".","");
  
  
	 if($incluidoigv=='S'){ 
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
	  $impuesto=$impto*($total);
	  //$total=$monto+$impuesto+$total_percepcion;
	  $total=$monto+$impuesto;
	  
	  $monto2=$total2+$total_inafecto;
	  $impuesto2=$impto*($total2);
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
     
//echo "moneda ".$tmoneda." ".$_REQUEST['tmoneda2']; 
if($tmoneda=="02" || $_REQUEST['tmoneda2']=="02"){
$simb_moneda="(US$.)";
}else{
$simb_moneda="(S/.)";
}


if($accion=="mostrarprod")
{
	
	if($estado=="A"){
		$verestado="ANULADO";
		}else{
			if(isset($_REQUEST['cargar_ref'])){
			$verestado="INGRESO";
			
			}else{		
		    $verestado="CONSULTA";
			
			
			
		    }
		}
}else{
	
	$verestado="INGRESO";
	
}



  
  ?>
      </table>
    </div></td>
  </tr>
  <tr>
    <td colspan="6" height="5"></td>
  </tr>
  <tr <?php echo $visible?> >
    <td height="26" align="left"  style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Nro. Items</td>
    <td align="left"  style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#0066CC"><strong id="nitems"><?php echo $items?></strong></td>
    <td align="center" valign="middle" bgcolor="<?php if($ocularDesc=="")echo "#FFEEA8"; else echo "";?>"  style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333; border:#CCCCCC solid 1px">	
	<div <?php echo $ocularDesc?> style="font-size:10px"> 
      V.Venta
	  
	  
      <input readonly="readonly" name="valventa" type="text" size="10" style="text-align:right; color:#999999"  value="<?php echo number_format($valventa,2);?>"/>
      T.Desc
	  
	  <?php //echo $valventa."-->".$total."+".$_SESSION['montoFlete'];?>
	  
	  
      <input readonly="readonly" name="descTotal" type="text" size="10" style="text-align:right;color:#999999"  value="<?php  
	  
	  if($incluidoigv=='S'){ 
	    echo number_format($valventa-$total+$_SESSION['montoFlete'],2);//number_format($descTotal,2);
	  }else{
	   echo number_format($valventa-$monto+$_SESSION['montoFlete'],2);//number_format($descTotal,2);
	  }//$monto
	  
	  
	  
	  ?>"/>
      Flete
      <input <?php echo $desabilitar; ?> onkeyup="ingFlete(event)"  name="flete" type="text" size="10" style="text-align:right"  value="<?php echo number_format($_SESSION['montoFlete'],2);?>"/>
     &nbsp;&nbsp;</span>	  	 </div>	  </td >
    <td align="right" valign="middle"  style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333"><span <?php echo $doc_infecto?> >&nbsp;SubTotal </span>&nbsp;&nbsp;
      <label style="color:#FF0000"><?php echo $simb_moneda; ?></label></td >
    <td align="center" valign="middle" <?php echo $doc_infecto?>><strong>
      <input readonly="readonly" name="monto2" type="text" size="10" style="text-align:right"  value="<?php echo number_format($monto,2);?>"/>
    </strong></td>
    <td valign="top">
	
	<strong>
      <input name="monto" type="hidden" size="10" style="text-align:right"  value="<?php echo number_format($monto,2,'.','');?>"/>
	  
	  
&nbsp;&nbsp; </strong>

<!--
<font style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333; text-decoration:underline"><a onclick="verDetTotales();" href="#">+Ver Detalles ...</a></font>
--></td>
  </tr>
  <tr <?php echo $visible?> >
    <td width="72" align="left"  style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333"><strong>Importe&nbsp;</strong> </td>
    <td width="102" align="left"  style="font:Arial, Helvetica, sans-serif; font-size:11px"><label style="color:#0066CC" id="incluyeimp">
      <?php
	  if($permiso4=='N'){
		   if($incluidoigv=='S'){ 
		   echo "(  Incl.Impstos )";
		   }else{ 
		   echo "(  NO Incl.Impstos )";
		   }
	  }else{
	  	   echo "<strong> INAFECTO </strong>";	
	  }
	   ?>
    </label></td>
    <td width="362" align="center"  style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333"><strong>Estado </strong></td >
        <td align="right" style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333"><span <?php echo $doc_infecto?>>Impuesto1(<?php echo $num_impto?>%) </span>&nbsp;&nbsp;<label style="color:#FF0000"><?php echo $simb_moneda; ?></label></td>
    <td align="center" <?php echo $doc_infecto?>><strong>
      <input readonly="readonly" name="impuesto2" type="text" size="10" style="text-align:right"  value="<?php echo number_format($impuesto,2) ;?>"/>
    </strong></td>
    <td><strong>
      <input name="impuesto1" type="hidden" size="10" style="text-align:right"  value="<?php echo number_format($impuesto,2,'.','') ;?>"/>
    </strong></td>
  </tr>
  <tr <?php echo $visible?> >
    <td align="left"  style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">Moneda<strong>&nbsp;</strong></td>
    <td align="left"  style="font:Arial, Helvetica, sans-serif; font-size:11px; "><label style="color:#FF0000" id="moneda"><?php echo $simb_moneda; ?></label></td>
    <td align="center"  style="font:Arial, Helvetica, sans-serif; font-size:11px; "><span style="font:Arial, Helvetica, sans-serif; font-size:11px;"><strong> (
      <label id="estado" style="color:#FF0000"><?php echo $verestado?></label>
      )
      <!-- <input name="estado" type="text" size="10" maxlength="20" value="" readonly="readonly"/>-->
    </strong></span></td>
    <td  align="right"  style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333"><span class="Estilo111" style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold">TOTAL DOC </span>&nbsp;&nbsp;<label style="color:#FF0000"><?php echo $simb_moneda; ?></label></td>
    <td  align="center"  ><strong>
      <input readonly="readonly" name="total_doc2" type="text" size="10" style="text-align:right"  value="<?php echo number_format($total,2);?>"/>
    </strong></td>
    <td><strong>
      <input name="total_doc" type="hidden" size="10" style="text-align:right"  value="<?php echo number_format($total,2,'.','');?>"/>
    </strong></td>
  </tr>
  <tr  <?php echo $visible?> >
    <td align="left"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">Tipo Cambio </span>&nbsp;</td>
    <td colspan="2" align="left"><input  readonly="readonly" name="text" type="text" id="tcambio" style=" text-align:left; color:#FF0000; background:none; border:none"  value="<?php echo $_SESSION['tc']  ;?>" size="5" maxlength="10"/><?php //echo $percep_suc." --> ".$percep_doc?><?php //echo $simb_moneda; ?></label>
    <input type="hidden" name="totalProdPercep"  id="totalProdPercep"  value="<?php echo $total_percepcion_temp; ?>"/></td>
    <td 
	<?php
	
	/*echo "<script>Alert('".$tipomov."==2 && ".$percep_suc."==S && ".$percep_doc."==S')</script>";*/
	if($tipomov==2 && $percep_suc=='S' && $percep_doc=='S'){
	echo "style='visibility:visible'";
	}else{ 
	echo "style='visibility:hidden'"; 
	}
				
	?>
	 width="147" align="right">
	 <span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold; color:#333333">Percepci&oacute;n</span>&nbsp;&nbsp;    </td>
	
	
    <td <?php if($tipomov==2 && $percep_suc=='S' && $percep_doc=='S'){echo "style='visibility:visible'";}else{ echo "style='visibility:hidden'"; } ?> width="79" align="center"><strong>
      <input readonly="readonly" name="percepcion" id="percepcion" type="text" size="10" style="text-align:right"  value="<?php echo number_format($total_percepcion,2) ;?>"/>
    </strong></td>
    <td width="17">&nbsp;</td>
  </tr>
  <tr  <?php echo $visible?> >
    <td align="left"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">
	
	<?php if($permiso27=='S'){ ?>
	Puntos
	<?php }?>
	</span></td>
    <td colspan="2" align="left" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#009966"><strong id="nitems"><?php
	
	 $_SESSION['totalPuntosDoc']=$totPuntos;
	 echo $totPuntos;
	 
	  ?></strong></td>
    <td <?php if($tipomov==1) echo "style='visibility:hidden' "; ?> align="right"><span class="Estilo111" style="font:Arial, Helvetica, sans-serif; font-size:11px; font:bold">TOTAL A PAGAR </span>&nbsp;&nbsp;<label style="color:#FF0000"><?php echo $simb_moneda; ?></label></td>
    <td <?php if($tipomov==1) echo "style='visibility:hidden' "; ?> align="center"><strong>
      <input readonly="readonly" name="totalpagar" id="totalpagar" type="text" size="10" style="text-align:right"  value="<?php echo number_format(($total_percepcion+$total),2,'.','') ;?>"/>
    </strong></td>
    <td><strong>
      <input readonly="readonly" name="totalpagar2" id="totalpagar2" type="hidden" size="10" style="text-align:right"  value="<?php echo number_format(($total_percepcion+$total),2) ;?>"/>
    </strong></td>
  </tr>
  <tr  <?php echo $visible?> >
    <td align="left"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#333333">Auditoria : </span></td>
    <td colspan="2" align="left" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#009966"><span style="font:Arial, Helvetica, sans-serif; font-size:10px; font:bold ; color:#0066CC"><span class="Estilo1">fecha</span> : <?php echo $_REQUEST['aud_fecha']?> <span class="Estilo1">&nbsp;&nbsp;pc</span>: <?php echo $_REQUEST['aud_pc']?> <span class="Estilo1">&nbsp;&nbsp;</span><span class="Estilo1">usuario</span>: <?php echo $_REQUEST['aud_usuario']?> </span></td>
    <td align="right">&nbsp;</td>
    <td  align="center">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<?php mysql_close($cn);?>