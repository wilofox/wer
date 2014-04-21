<?php
session_start();
include_once('../funciones/funciones.php');
switch($_REQUEST['opera']){
	case 'buscar':
		$contenido=file('http://www.sunat.gob.pe/w/wapS01Alias?ruc='.$_REQUEST['ruc']);
		for($i=0;$i<=count($contenido);$i++){
			$row .= $contenido[$i];
			$cx=explode("<small><b>",$row);
			if($cx[1]!=NULL){
				$temp=$cx[1];
				$cx1=explode("<br/></small>",$temp);
				if($cx1[0]!=NULL){
					$temp=explode("</b>",$cx1[0]);
					$datos[]=$temp[1];
					$etiquetas[]=$temp[0];
					$temp="";
				}
				$row="";
			}
		}
		//print_r($etiquetas);
		$estado="";
		for($i=0;$i<count($datos);$i++){
			if($i==0){
				$temp=explode("-",$datos[0]);
				$ruc=substr($temp[0],1,11)."|"; //Ruc
				$razon=caracteres(substr($temp[1],1,ltrim($temp[1])-1))."|";  //Razon social
			}
			if($i==2){
				if(ltrim(substr($datos[$i],0,6))=="ACTIVO"){//Estado
					$estado.="A";
				}
				$estado.="|";
			}
			if($i==4){
				$direccion=caracteres(substr($datos[$i],5,ltrim($datos[$i])-15))."|"; //Direccion
			}
			if($i==5){
				$telefono=substr($datos[$i],5,ltrim($datos[$i])-15); //Telefono
			}
		}
	break;
}
if($_REQUEST['opera']=="buscar"){
	echo $ruc.$razon.$estado.$direccion.$telefono;
}else{
	include_once('../Finanzas/mcc/MClientes.php');
	$mc=new MClientes();
	$mc->ruc=$_REQUEST['ruc'];
	switch($_REQUEST['opera']){
		case 'existe':
			$contenido=file('http://www.sunat.gob.pe/w/wapS01Alias?ruc='.$_REQUEST['ruc']);
			for($i=0;$i<=count($contenido);$i++){
				$row .= $contenido[$i];
				$cx=explode("<small><b>",$row);
				if($cx[1]!=NULL){
					$temp=$cx[1];
					$cx1=explode("<br/></small>",$temp);
					if($cx1[0]!=NULL){
						$temp=explode("</b>",$cx1[0]);
						$datos[]=$temp[1];
						$etiquetas[]=$temp[0];
						$temp="";
					}
					$row="";
				}
			}
			//print_r($etiquetas);
			$estado="";
			for($i=0;$i<count($datos);$i++){
				if($i==0){
					$temp=explode("-",$datos[0]);
					$ruc=substr($temp[0],1,11)."|"; //Ruc
					$razon=caracteres(substr($temp[1],1,ltrim($temp[1])-1))."|";  //Razon social
				}
				if($i==2){
					if(ltrim(substr($datos[$i],0,6))=="ACTIVO"){//Estado
						$estado.="A";
					}
					$estado.="|";
				}
				if($i==4){
					$direccion=caracteres(substr($datos[$i],5,ltrim($datos[$i])-15))."|"; //Direccion
				}
				if($i==5){
					$telefono=substr($datos[$i],5,ltrim($datos[$i])-15); //Telefono
				}
			}
			if($mc->BuscaRuc()){
				echo "S//".$ruc.$razon.$estado.$direccion.$telefono;
			}else{
				echo "N//".$ruc.$razon.$estado.$direccion.$telefono;
			}
			break;
		case 'actualiza':
			$mc->razonsocial=$_REQUEST['razon'];
			$mc->direccion=$_REQUEST['direccion'];
			$mc->telefono=$_REQUEST['telefono'];
			$ListaCliente=$mc->ActualizaRuc();
			echo $ListaCliente[0]['codcliente']."|".caracteres($ListaCliente[0]['razonsocial'])."|".$ListaCliente[0]['ruc']."|".$ListaCliente[0]['telefono']."|".$ListaCliente[0]['direccion'];
			break;
	}
}
?>