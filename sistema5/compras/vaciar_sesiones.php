<?php
session_start();
include('../conex_inicial.php');

	unset($_SESSION['productos']);
	unset($_SESSION['productos2']);
	unset($_SESSION['productos3']);
	unset($_SESSION['boni']);
	unset($_SESSION['pagos']);
	unset($_SESSION['montoFlete']);
	unset($_SESSION['totalPuntosDoc']);
	
	unset($_SESSION['lotes']);
	

		$numero=$_REQUEST['numero'];
		$serie=$_REQUEST['serie'];
		$sucursal=$_REQUEST['sucursal'];
		$doc=$_REQUEST['doc'];
		$auxiliar=$_REQUEST['auxiliar'];
		$tipomov=$_REQUEST['tipomov'];
		$tienda=$_REQUEST['tienda'];
		
		if($tipomov!=''){
		
				if($tipomov=='1'){
			
				$strSQL="delete from tempdoc where numero='$numero' and serie='$serie' and  sucursal='$sucursal' and doc='$doc' and auxiliar='$auxiliar' and estado='R' ";
						 
				 }else{
				
				$strSQL="delete from tempdoc where numero='$numero' and serie='$serie' and  sucursal='$sucursal' and doc='$doc' and estado='R' ";
						
				 }
				 
			mysql_query($strSQL,$cn);	
		}
		
		//echo $strSQL;
		
		//----------------------------limpiar series----------------------------------
		if(isset($_SESSION['seriesprod']) && count($_SESSION['seriesprod'][2])>0){
			foreach ($_SESSION['seriesprod'][2] as $subkey=> $subvalue) {
					  
		   			  //$_SESSION['seriesprod'][0][$subkey]=$series[$j];
					  //$_SESSION['seriesprod'][1][$subkey]=$fvenc;
					  //$_SESSION['seriesprod'][2][$subkey]=$producto;
					  
			$strSQL="update series set estado='F' where tienda='".$tienda."' and producto='".$_SESSION['seriesprod'][2][$subkey]."' and serie='".$_SESSION['seriesprod'][0][$subkey]."' and salida='' ";
			mysql_query($strSQL,$cn);				  
							
			}
			
			$strSQL="update series set estado='F' where (salida='0' or salida='') and estado='V'";
			mysql_query($strSQL,$cn);
			
						
			unset($_SESSION['seriesprod'][0]);
			unset($_SESSION['seriesprod'][1]);
			unset($_SESSION['seriesprod'][2]);
			
			unset($_SESSION['temp_series'][0]);
			unset($_SESSION['temp_series'][1]);
			unset($_SESSION['temp_series'][2]);
			
		}
		
			
		if(isset($_REQUEST['idtempdoc'])){
		
		$strSQL="delete from tempdoc where id='".$_REQUEST['idtempdoc']."' and estado='R' ";
		mysql_query($strSQL,$cn);	
		}	
			
		
		
		//----------------------------------------------------------------------------------
?>
<?php // mysql_close($cn);?>