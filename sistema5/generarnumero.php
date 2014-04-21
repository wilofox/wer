<?php 
session_start();
include('conex_inicial.php');
//$_SESSION['serie']='001';
$cod_operacion=$_REQUEST['operacion'];
//$servicio=$_REQUEST['servicio'];
if($cod_operacion=='TB' || $cod_operacion=='NV' || $cod_operacion=='B0'){
$series=$_SESSION['srapida']; //caja_serie
}else{
$series=$_SESSION['smesa'];
}

$empresa=$_REQUEST['sucursal'];
if(!isset($_REQUEST['sucursal']))$empresa=$_SESSION['user_sucursal'];

			$strSQL="select * from docuser where pc='".$_SESSION['pc_ingreso']."' and usuario='".$_SESSION['codvendedor']."' and  doc='".$cod_operacion."' and tipomov='2' and empresa='".$empresa."' ";			
			$resultado=mysql_query($strSQL,$cn);
			$row=mysql_fetch_array($resultado);
			$series=$row['serie'];
				
			//	echo $strSQL;					
			//$contColas=mysql_num_rows($resultado);
			
  $strSQL33="select max(num_doc) as codigo from cab_mov where cod_ope='$cod_operacion' and serie='$series' and sucursal='".$empresa."'";
  $resultado33=mysql_query($strSQL33,$cn);
  $row33=mysql_fetch_array($resultado33);
  $var33=$row33['codigo']+1;
  $num_doc=str_pad($var33, 7, "0", STR_PAD_LEFT);
  //mysql_free_result($resultado33);

echo $num_doc."-".$series."-";
mysql_close($cn);
?>
