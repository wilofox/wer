<?php
session_start();
include('conex_inicial.php');
// Primeros comprobamos el usuario.
$_SESSION['pc_ingreso']=$_REQUEST['pc'];
$_SESSION['mac_pc']=$_REQUEST['mac'];
$_SESSION['user_Windows']=$_REQUEST['userWin'];

//echo $_REQUEST['pc'];


	$contError=0;
	$rs2=mysql_query("show tables");
	while($arr2=mysql_fetch_array($rs2)){
		$rs3=mysql_query("check table ".$arr2[0].""); echo mysql_error();
		$arr3=mysql_fetch_array($rs3);
		if($arr3[2]=='error')$contError++;
	}


if($contError>0){
header('Location:index.php?rep=S');break;
}

$strSQl2="select * from caja where pc='".$_SESSION['pc_ingreso']."'";
//echo $strSQl2;

$resultado=mysql_query($strSQl2,$cn);
$cont=mysql_num_rows($resultado);
	while($row=mysql_fetch_array($resultado)){
	$_SESSION['terminal']=$row['descripcion'];
	$_SESSION['codterminal']=$row['codigo'];
	$_SESSION['caja_serie']=$row['serie1'];
	$_SESSION['registradora']=$row['maqreg'];
	$_SESSION['autSunat']=$row['sunat'];	
	}

mysql_free_result($resultado);

if($cont==0){
	
$strSQL3="insert into caja(descripcion,pc)  values('".$_SESSION['pc_ingreso']."','".$_SESSION['pc_ingreso']."')";
mysql_query($strSQL3,$cn);

	$strSQl2="select * from caja where pc='".$_SESSION['pc_ingreso']."'";
	$resultado=mysql_query($strSQl2,$cn);
	$cont=mysql_num_rows($resultado);
		while($row=mysql_fetch_array($resultado)){
		$_SESSION['terminal']=$row['descripcion'];
		$_SESSION['codterminal']=$row['codigo'];
		$_SESSION['caja_serie']=$row['serie1'];
		$_SESSION['registradora']=$row['maqreg'];
		$_SESSION['autSunat']=$row['sunat'];		
		}
				
		mysql_free_result($resultado);
}

$resultados = mysql_query("select * from usuarios ",$cn); 
			//  echo "resultado";
while($row=mysql_fetch_array($resultados))
{
//echo $_POST['usuario'] ."==". $row['usuario']."  ". $_POST['password'] ."==". $row['password']."<br>";

		if ($_POST['usuario'] == $row['usuario'] && $_POST['password'] == $row['password'])
		{
		
		 $_SESSION['temp_usu']=$_POST['usuario'];
		 $_SESSION['temp_pas']=$_POST['password'];
		
		if($row['acceso']=='N'){
		  header ('Location: index.php?e=p');
		  break;	break;	
		  die();
		}

//temporisador prolyam	rk ---------------------------------------------
	//permitir  acceso por menu
	$ht=$row['temporizador'];	

	//pedir tiempo
	$nivel=$row['nivel'];	
	$resultadosht = mysql_query("select * from nivel N inner join hor_trabajador H on N.id_ht=H.id_ht   where id_nivel='".$nivel."' ",$cn);
		$rowht=mysql_fetch_array($resultadosht);				
		$Hingreso=strtotime($rowht['h_ingreso']);
		$Hsalida=strtotime($rowht['h_salida']);		
		$hora=strtotime(gmdate('H:i:s',time()-18000));		
		//if ($Hingreso!=''  ){	
if ($ht!='S'){	
		if ($Hingreso!='' ){	
			if ($hora<=$Hingreso || $hora>=$Hsalida  ){
				//header ('Location: index.php?e=ht&sa='.$Hingreso.'&in='.$Hsalida.'&hr='.$hora);
				header ('Location: index.php?e=ht');
				break;	break;		
				die();
			}
		}
}			
//-----------------------------------------------------------------------------

	 		
		  /*
    	  if($row['estado']=='C' && $_POST['temp_conx']=='N'){
		  header ('Location: index.php?e=c');
		  break;	break;	
		  }
		*/
	     // Si es correcto comprobamos la contrasea.
		 // Si ambos datos son correctos guardamos estos datos en la sessin.
		 
		 $_SESSION['logeado'] = 'SI';
		 $_SESSION['user'] = $row['usuario'];
		 $_SESSION['codvendedor'] = $row['codigo'];
		 $caja=$row['caja'];
		 $_SESSION['nivel_usu']=$row['nivel'];
	 	 $_SESSION['filtro_busqueda']=$row['busqueda'];
		 $_SESSION['user_tienda']=$row['tienda'];
		 $_SESSION['user_sucursal']=$row['sucursal'];
		 $_SESSION['user_agenda']=$row['agenda'];
		 $_SESSION['busquedaAux']=$row['busaux']; 
		 $_SESSION['verProgP']=substr($row['permiso'],0,1);
		 $_SESSION['verProgP1']=substr($row['permiso'],1,1); 
		 $_SESSION['vcredito']=substr($row['permiso'],2,1); 
		 $_SESSION['perUsu_moneda']=substr($row['permiso'],3,1); 
		 $_SESSION['perUsu_impuesto']=substr($row['permiso'],4,1); 
		 
		 $_SESSION['usertemporizador']=$row['temporizador']; 		 
				 
		 //$_SESSION['tienda']="101";
		 //$_SESSION['sucursal']="1";
		 
		 //$user_sucursal=0
		
		// $_SESSION['serie']=$row['serie'];
		 // Redijimos a la pgina correcta.
		 //echo $row['pc']." - ".$_SESSION['pc_ingreso'];
		 
		 //----------------control de sistemas abiertos en una pc------------------------------
		 /*
		 if(trim($row['pc'])==trim($_SESSION['pc_ingreso']) && $row['estado']=='C'){
		 header ('Location: index.php?e=c');
		 die();
         }else{
		 $strSQL4="select * from usuarios where identificador='".$_SESSION['mac_pc']."|".$_SESSION['user_Windows']."' and estado='C' ";
		 $resultado4=mysql_query($strSQL4);
		 $contMacCon=mysql_num_rows($resultado4);
		 
		 if($contMacCon>0){
		 header ('Location: index.php?e=c');
		 die();
		 }
		
		 
		$strSQL00="update usuarios set estado='C',conexiones=1,pc='".$_SESSION['pc_ingreso']."',identificador='".$_SESSION['mac_pc']."|".$_SESSION['user_Windows']."' where codigo='".$row['codigo']."'";
		 mysql_query($strSQL00,$cn);
		 
		 $updateUser="update usuarios set estado='D' where codigo!='".$row['codigo']."'";
		 mysql_query($updateUser,$cn);
		 
		 }
		 */
		 
		 $strSQL00="update usuarios set estado='C',conexiones=1,pc='".$_SESSION['pc_ingreso']."',identificador='".$_SESSION['mac_pc']."|".$_SESSION['user_Windows']."' where codigo='".$row['codigo']."'";
		 mysql_query($strSQL00,$cn);
		 
		 
		 //-----------------------------------------------------------------------------------------
		 $str_delete="delete from tempdoc where estado='R' and usuario='".$_SESSION['codvendedor']."'";
		 mysql_query($str_delete,$cn);

/*
		$sql=mysql_query("select * from tempdoc where estado!='R' and usuario='".$_SESSION['codvendedor']."'",$cn);
		while($row=mysql_fetch_array($sql)){
			$sql_cons_doc=mysql_query("select * from cab_mov where cod_ope='".$row['doc']."' and tipo='".$row['tipodoc']."' and sucursal='".$row['sucursal']."' and serie='".$row['serie']."' and Num_doc='".$row['numero']."'",$cn);
			if(mysql_num_rows($sql_cons_doc)==0){
				$sql_del=mysql_query("delete from tempdoc where id='".$row['id']."'");
			}
		}
		
*/
		//echo $strSQL00;
		
		$resultados3 = mysql_query("select * from caja where pc='".$_SESSION['pc_ingreso']."' ",$cn);
		//$resultados3 = mysql_query("select * from caja where codigo='$caja' ",$cn);
		$row3=mysql_fetch_array($resultados3);
		
		$_SESSION['srapida']=$row3['serie1'];
		$_SESSION['smesa']=$row3['serie2'];
		$_SESSION['nfar']=$row3['num1_fa'];
		$_SESSION['nbvr']=$row3['num1_bv'];
		$_SESSION['nfam']=$row3['num2_fa'];
		$_SESSION['nbvm']=$row3['num2_bv'];
		$_SESSION['des_caja']=$row3['descripcion'];
		$_SESSION['cod_caja']=$row3['codigo'];
		
												
		 $_SESSION['temp_usu']="";
		 $_SESSION['temp_pas']="";
		// echo "hsdfhj";
		
		if($_SESSION['nivel_usu']=='6' && $_SESSION['user_tienda']!=''){
		
		
		$strSQL12="select * from caja where tienda='".$_SESSION['user_tienda']."' ";
		$resultado12=mysql_query($strSQL12,$cn);
		$cantreg=mysql_num_rows($resultado12);
		
			if($cantreg>0){
			$strSQLCaja="update caja set pc='".$_SESSION['pc_ingreso']."' where tienda='".$_SESSION['user_tienda']."'";
			}else{
			$strSQLCaja="insert into caja (descripcion,pc,tienda)values('caja ".$_SESSION['user_tienda']."','".$_SESSION['pc_ingreso']."','".$_SESSION['user_tienda']."') ";
			}
			mysql_query($strSQLCaja,$cn);
		}
		
		$strSQl0="select id,venta,compra,promedio from tcambio order by id desc limit 1";
//echo $strSQl0;
		$resultado0=mysql_query($strSQl0,$cn);
		$row0=mysql_fetch_array($resultado0);
		$strSQL00="insert into tcambio (fecha,venta,compra,promedio) values ('".$fecha."','".$row0['venta']."','".$row0['compra']."','".$row0['promedio']."')";
		mysql_query($strSQL00,$cn);
												
		header ('Location: principal.php');
		break;		
		
		}else{
		header ('Location: index.php');
		}
}


mysql_free_result($resultados);
// Si alguno de los datos ingresados son incorrectos redirigimos a la pgina de 

// error o de nuevo al formulario de ingreso.


?>

