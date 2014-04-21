<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>

<style type="text/css">
<!--
.Estilo100 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
-->
</style>
<?php
		include('../conex_inicial.php');
		include('../funciones/funciones.php');
list($n_tienda)=mysql_fetch_array(mysql_query("select des_tienda from tienda  where cod_tienda='".$_REQUEST['almacen']."'"));
if($_REQUEST['almacen']==0) $n_tienda="Todos"
	?>
</head>

<body onload="window.print()">
<table  border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td  align="center"></td>
    <td colspan="9" align="center"><h2><b>Reporte Seguimiento de Presupuesto</b></h2></td>
  </tr>
  <tr>
    <td  align="center"></td>
    <td  colspan="9"><strong>Tienda: <?php echo $n_tienda ?></strong></td>
  </tr>
	  <tr>
    <td  align="center"></td>
    <td colspan="9"><strong>Fecha: De <?php echo $_REQUEST['fec1'] ?> al <?php echo $_REQUEST['fec2'] ?></strong></td>
  </tr>
        <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px" bgcolor="#CCCCCC">
          <td   style=" border:#CCCCCC solid 1px" width="21" height="21" align="center" ><span class="texto2"><strong></strong></span></td>
          <td width="100" align="center"  style=" border:#CCCCCC solid 1px"><span class="texto2"><strong>Fec. de Emi </strong></span></td>
		    <td  style=" border:#CCCCCC solid 1px" width="130" ><span class="texto2"><strong>PC</strong></span></td>
		    <td  style=" border:#CCCCCC solid 1px" width="100" ><span class="texto2"><strong>N&uacute;mero</strong></span></td>
		  
          <td  style=" bor
		  der:#CCCCCC solid 1px" width="149" ><span class="texto2"><strong>Cliente<img src="../imgenes/arrowmain.gif" width="8" height="16" onClick="verOrder()" style="cursor:pointer"></strong></span>
		  		  &nbsp;
		  <div id="divOrder" style="position:absolute; left: 380px; top: 153px; height: 48px; width: 95px; visibility:hidden">
		    <table width="75" height="48" border="1"  bgcolor="#1DC0BC">
              <tr>
                <td><table width="92" border="0" cellpadding="0" cellspacing="0">
                  <tr  onMouseOver="entradaOrder(this)" onMouseOut="entradaOrder(this)" style="cursor:pointer" onClick="ordenar('C.razonsocial','asc')">
                    <td height="18" class="Estilo118 Estilo119 Estilo121" style="font:bold; color:#FFFFFF">&nbsp;Ascendente</td>
                  </tr>
                  <tr onMouseOver="entradaOrder(this)" onMouseOut="entradaOrder(this)" style="cursor:pointer" onClick="ordenar('C.razonsocial','desc')" >
                    <td height="18" class="Estilo118 Estilo119 Estilo121" style="font:bold; color:#FFFFFF">&nbsp;Descendente</td>
                  </tr>
                </table></td>
              </tr>
            </table>
		  </div>
		  </td>
          <td  style=" border:#CCCCCC solid 1px" width="30" ><span class="texto2"><strong>Mon</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="67" ><span class="texto2"><strong>Importe</strong></span></td>
          <td  style=" border:#CCCCCC solid 1px" width="86" ><span class="texto2"><strong>Vendedor</strong></span></td>
          <td width="123"  style=" border:#CCCCCC solid 1px" ><span class="texto2"><strong>Referencia</strong></span></td>
		            <td  style=" border:#CCCCCC solid 1px" width="24" align="center"><span class="texto1">
           <b>Est.</b>
          </span></td>
    </tr>
  <?php 

		//Borrar Sesion multifactura
		session_start();
		unset($_SESSION['Multifactura']);
		 //PAGINACION 1	
		 $registros = 100; 
		 $pagina = $_REQUEST['pagina']; 
			   
		//echo $pagina;

		if ($pagina=='') { 
		$inicio = 0; 
		$pagina = 1; 
		} 
		else { 
		$inicio = ($pagina - 1) * $registros; 
		} 
		//------------------------------------------
			
			$almacen=$_REQUEST['almacen'];
			$cliente=$_REQUEST['cliente'];
			$ruc=$_REQUEST['ruc'];
			$vendedor=$_REQUEST['vendedor'];
			$docref=$_REQUEST['docref'];
			$fec1=$_REQUEST['fec1'];
			$fec2=$_REQUEST['fec2'];
			$mosdocFac=$_REQUEST['mosdocFac'];
			$mosdocAnu=$_REQUEST['mosdocAnu'];
			$Estado=$_REQUEST['Estado'];
			$cmbmoneda=$_REQUEST['cmbmoneda'];
			$formaOrder=$_REQUEST['formaOrder'];
			$campoOrder=$_REQUEST['campoOrder'];
			
			if($campoOrder!="" && $formaOrder!=""){
			$filtroOrden=" order by  ".$campoOrder." ".$formaOrder; 
			}else{
			$filtroOrden=" order by fecha desc ";
			}

		if ($almacen=='0'){	
			$strSQL22="select * from tienda order by cod_tienda";
			$resultado22=mysql_query($strSQL22,$cn);
			while($row22=mysql_fetch_array($resultado22)){
			//echo  $saldos[]=",'".$row22['cod_tienda'].'';
			 $tiendas=$tiendas.$row22['cod_tienda'].",";
			}
		$tiendas2=substr($tiendas,0,strlen($tiendas)-1);
		$almacen1  =' tienda in('.$tiendas2.') ';		
		}else{
		$almacen1 = " tienda='$almacen' ";
		}	

if ($mosdocAnu<>''){			
 echo $SQLMosDoc=" and flag ='$mosdocAnu' ";
}

if ($Estado<>''){
		  if (trim($Estado)=='T'){
			 $SQLEstado ="";
		  }elseif (trim($Estado)=='P'){
			//$SQLEstado =" and flag_r <>'RA' and flag<>'A' and estadoOT<>'O' and estadoOT<>'T' "; 
			$SQLEstado =" and flag_r ='' and flag<>'A' ";
		  }elseif (trim($Estado)=='F'){
		  	$SQLEstado =" and flag_r <>'' ";
		  }else{			
			//$SQLEstado =$Estado;
			 $SQLEstado =" and flag='A' ";
		  }	
 }else{
	//$SQLEstado =" and flag_r <>'RA' and flag<>'A' and estadoOT<>'O' and estadoOT<>'T' ";
	$SQLEstado =" and flag_r =''  and flag<>'A' ";	  
 }
  
//echo $SQLEstado; 
  
if ($cmbmoneda==''){
	$Cmoneda='';
}else{
	$Cmoneda=" and moneda='".$cmbmoneda."' ";
}
 
 $SQLConsulta=" where $almacen1
 and cod_ope='$docref'
 and cod_vendedor like '%$vendedor%'
 and C.razonsocial like '%$cliente%'	
 and C.ruc like '%$ruc%'
 and substring(fecha,1,10) between '".formatofecha($fec1)."' and '".formatofecha($fec2)."'
 $SQLMosDoc $SQLEstado $Cmoneda
    ";

$resultados = mysql_query("select * from cab_mov CM
inner join cliente C on CM.cliente =C.codcliente 
$SQLConsulta
order by cod_ope" ,$cn);
$total_registros = mysql_num_rows($resultados); 
			
$strSQL="select * from cab_mov  CM
inner join cliente C on CM.cliente =C.codcliente 	
$SQLConsulta  $filtroOrden
LIMIT $inicio, $registros";
		
	//echo $strSQL;
						
			$j=0;
			$resultado=mysql_query($strSQL,$cn);
			

	$resultados2 =mysql_num_rows($resultado); 
	$total_paginas = ceil($total_registros / $registros); 
			
			while($row=mysql_fetch_array($resultado)){
						 
			 	$j++;
				if($j%2==0){
				$color_row='#FFFFFF';//'#E9F3FE';
				}else{
				$color_row='#FFFFFF';
				}	
// documentos anulados rojo
$AnRK='';	
$sql="select * from cab_mov 
where cod_cab  ='".$row['cod_cab']."' ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX['flag']=='A'){
		$color_row='#FF0000';
		$AnRK='2';
		$estado="A";
	}
}	
// documentos con serie (anulara y desanular no permite)
$sql="select * from series where producto in  (
select cod_prod from det_mov where cod_cab='".$row['cod_cab']."' )
and tienda='$almacen'  LIMIT 0, 1  ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	if ($rowX['id']<>''){
		$color_row='#D7FFF0';
		$AnRK='3';
		$estado="";
	}
}
 //documentos con Pagos (anulara y desanular no permite)
$sql="select *  from cab_mov where cod_cab='".$row['cod_cab']."'  and condicion='2'
 and flag <>'A'
LIMIT 0, 1  ";
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
		$color_row='#FFDFF4';
		$AnRK='3';
		$estado="";
}						 					
 //documentos facturado o canjeado
$sql="select * from referencia where cod_cab_ref='".$row['cod_cab']."'  
LIMIT 0, 1  "; // and flag_r='RO' 
$resultadoX=mysql_query($sql,$cn);
while($rowX=mysql_fetch_array($resultadoX)){
	//if ($rowX['flag_r']=='RO' || $rowX['flag_r']=='RORA'){
		$color_row='#0066FF';
		$AnRK='3';
		$estado="F";
	//}
}					 					
?>
			
  <tr  onClick="entrada(this)" ondblclick="doc_det(this)"  >
      <td width="24" align="center"><b><?=$j;?></b></td>
              <td class="texto1" align="center" ><?php echo substr($row['fecha'],0,10)?></td>
              <td class="texto1" ><?php echo $row['pc']; ?></td>
              <td class="texto1"><?php echo $row['serie'].'-'.$row['Num_doc']; ?></td>			   
              <td class="texto1"><?php //echo $row['cliente']; ?><?php echo substr(caracteres($row['razonsocial']),0,27); ?></td>
              <td align="center" class="texto1"><?  
			  if($moneda==''){
			  if ($row['moneda']=='02'){echo 'US$.';}else{echo 'S/.';}
			  }else{
			  if ($row['monedaSD']=='02'){echo 'US$.';}else{echo 'S/.';}
			  }
			   ?></td>
              <td align="right" class="texto1"><?php echo $row['total']?></td>
			  <td align="right" class="texto1"><?php 
			  $resultados11 = mysql_query("select * from usuarios where codigo='".$row['cod_vendedor']."' ",$cn); 
			  $rowSM=mysql_fetch_array($resultados11);
			  echo $rowSM['usuario'];
				?></td>
			  <td align="center" class="texto1"><?php 
			$strSQLSM="select * from referencia where cod_cab_ref='".$row['cod_cab']."' order by id desc ";
	$resultadoMS=mysql_query($strSQLSM,$cn);
	//$rowSM=mysql_fetch_array($resultadoMS);
	//echo $sucursal=$rowSM['serie'].'-'.$rowSM['correlativo'];
	while($rowSM=mysql_fetch_array($resultadoMS)){
	$codRefec=$rowSM['cod_cab'].',';
	//echo $codRefec;
		$strSQL2="select * from cab_mov where cod_cab in (".$codRefec."0) ";
		$resultado2=mysql_query($strSQL2,$cn);
		//$rowR=mysql_fetch_array($resultadoMS);   	
		while($rowR=mysql_fetch_array($resultado2)){
			if ($rowR['cod_cab']<>''){
				}echo $rowR['serie'].'-'.$rowR['Num_doc'].' | ';	
			
		}
	
	}
		
			   ?></td>	
			         <td align="center" class="texto1" >	  
	   <? echo $estado;?>	  </td>		 
  </tr>
  
  <?php }?>
</table>  
</body>
</html>
