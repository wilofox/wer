<?php 
	session_start();
	include ('../../conex_inicial.php'); 
	include('../../numero_letras.php');
	
	 $codigo='0';
	$codcab=explode(";",$_REQUEST['codcab']);
			for ($i=1; $i<count($codcab); $i++){
				 $codigo=$codigo.','.$codcab[$i];
			}

	//PARAMETROS PASADOS 
	$empresa 	=  	$_REQUEST['empresa'];
	$doc	 	=  	$_REQUEST['doc'];
	$serie 	 	=  	$_REQUEST['serie'];
	$numero  	=  	$_REQUEST['numero'];
	$vuelto		=	$_REQUEST['vuelto'];
	
	
	if(isset($_REQUEST['codcab'])){
	//$strcab		= 	"select * from cab_mov where cod_cab='".$_REQUEST['codcab']."' " ;
	$strcab		= 	"select * from cab_mov where cod_cab in (".$codigo.") " ;
	$resultado	=   mysql_query($strcab,$cn);
	$row		=   mysql_fetch_array($resultado);
	
	$empresa 	=  	$row['sucursal'];
	$doc	 	=  	$row['cod_ope'];
	$serie 	 	=  	$row['serie'];
	$numero  	=  	$row['Num_doc'];
	
	}
	
	
	//PARAMETROS 
	

	//DATOS DEL DOCUMENTO
	$strcab		= 	"select * from cab_mov where sucursal='".$empresa."' and cod_ope='".$doc."' and serie='".$serie."' and Num_doc='".$numero."' " ;
	$rscab 		= 	mysql_query ( $strcab,$cn	);
	$rowcab 	= 	mysql_fetch_array (	$rscab	);
	$igv 	    =   $rowcab['impto1']; //IGV
	$nom_aux1   =   $rowcab['cliente'];
	
	//echo "EGT".$strcab;
	
$fecha=date('Y-m-d H:i:s' ,time() - 3600);
	//DATOS DE MONEDA
	if( !empty($rowcab['moneda']))
	{	$strmo		= 	"select simbolo from moneda where id= ".$rowcab['moneda'] ;
		$rsmo		=	mysql_query ( $strmo ,$cn	);
		$rowmo 		= 	mysql_fetch_array ( $rsmo );
    }
	
	//DATOS DE SUCURSAL
	if( !empty($empresa))
	{	$stremp		= 	"select des_suc,ruc from sucursal where cod_suc = '".$empresa."' " ;
		$rsemp		=	mysql_query ( $stremp,$cn	);
		$rowemp 	= 	mysql_fetch_array ($rsemp);
    }
	
	//DATOS DE TIENDA
	if( !empty($rowcab['tienda']))
	{	$strti		= 	"select direccion,des_tienda,telefono from tienda where cod_tienda = '".$rowcab['tienda']."'" ;
		$rsti		=	mysql_query ( $strti,$cn	);
		$rowti 		= 	mysql_fetch_array ($rsti);
    }
	
	//DATOS DE CLIENTE
	if( !empty($nom_aux1))
	{	$strcli		= 	"select codcliente,razonsocial,ruc,direccion from cliente where codcliente = '".$nom_aux1."' " ;
		$rsccli	    = 	mysql_query ( $strcli,$cn	);
		$rowcli		= 	mysql_fetch_array (	$rsccli	);
    }
	
	//DATOS DE USUARIO DEL SISTEMA
	if( !empty($_SESSION['user']))
	{	$strusu		= 	"select usuario from usuarios where usuario= '".$_SESSION['user']."' " ;
		$rsusu 		= 	mysql_query (	$strusu,$cn	);
		$rowusu 	= 	mysql_fetch_array( $rsusu );
    }
	
	//TIPO DE DOCUMENTO
	if( !empty($doc))
	{	$strop	= 	"select * from operacion where codigo = '".$doc."' " ;
		$rsop	= 	mysql_query (	$strop,$cn	);
		$row_doc= 	mysql_fetch_array ($rsop);
	}
	$cola   =	$row_doc['cola']; 
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:::::IMPRIMIENDO::::</title>
<style type="text/css">
.Estilo40 {font-family: Geneva, Arial, Helvetica, sans-serif ; font-size: 11px;}
.Estilo50 {font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.EstiloItem{font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.Estilo55 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
</style>
</head>
<SCRIPT LANGUAGE="VBScript"> 
Sub window_onunload 
On Error Resume Next 
Set WB = nothing 
End Sub 
Sub vbPrintPage 
OLECMDID_PRINT = 6 
OLECMDEXECOPT_DONTPROMPTUSER = 2 
OLECMDEXECOPT_PROMPTUSER = 1 
On Error Resume Next 
WB.ExecWB OLECMDID_PRINT, OLECMDEXECOPT_DONTPROMPTUSER, OLECMDEXECOPT_PROMPTUSER 
End Sub 
</SCRIPT> 
<!--<script type="text/javascript" src="../javascript/colaimp.js"></script> -->
<script language="javascript">
var pc="<?php //echo $_SESSION['pc_ingreso'] ?>";
var cola="<?php // echo $cola?>";
function printer() 
{ 
vbPrintPage(); 
return false; 
} 
</script>
<!--onLoad="printer()"-->
<body   onLoad="printer()" >

<div id="installOK" style="width:240px">
 <table width="242" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <td colspan="3" align="center" ><span class="Estilo50">
       </span><span class="Estilo50"><?=$rowemp['des_suc']?></span><span class="Estilo50"><br> 
         R.U.C: <?=$rowemp['ruc']?><br>
      <?=$rowti['direccion']?> - <?=$rowti['des_tienda']?> - <?=$rowti['telefono']?></span></td>
   </tr>
   <tr>
    <td colspan="3"><table width="100%"  border="0" cellpadding="0" cellspacing="0">
    <?php /*?>  <tr>
        <td height="14"  align="center"><span class="Estilo50">Nro.Serie S/N &nbsp;<?php echo $_SESSION['registradora']; ?></span>       </td>
        </tr><?php */?>
    </table>	</td>
    </tr>
   <tr>
     <td height="18" colspan="3" align="center"><span class="Estilo50"><?php echo date('d-m-Y H:i:s' ,time() - 3600);?>&nbsp;
     <?php //echo "N/O: ". str_pad($rowcab['serie'], 3, "0", STR_PAD_LEFT);?></span></td>
   </tr>
   <tr>
     <td height="19" colspan="3" align="center">----------------------------------------</td>
   </tr>
   <tr>
     <td height="18" colspan="3" align="center"><span class="Estilo50">
       <?php  //if( empty($rowcli['ruc'] ) ){ echo "Ticket BOLETA Nro. ";}else{  echo "Ticket FACTURA Nro. ";  } ?>
      <?php //echo $serie."-".$numero ?>
	   <?php    echo "Ticket de Pago ";  ?>
	  </span>	   </td>
   </tr>
   <tr>
     <td height="19" colspan="3" align="center">--------------------------------------</td>
   </tr>
   <?php if(!empty($rowcli['ruc'])){?>
   <tr>
     <td colspan="3"><span class="Estilo50">Cliente:<?=$rowcli['razonsocial']	?><br>
       Ruc:<?=$rowcli['ruc']?><br>
       Dirección:<?=$rowcli['direccion']?></span></td>
   </tr>
   <?php /*?><tr>
    <td colspan="3" align="center">--------------------------------------</td>
    </tr><?php */?>
<?php }?>

<? if ($dat==''){ ?>
<?php /*?><tr>
     <td colspan="3" align="left" valign="baseline">	 
	
	<?php /*?> <table border="0" cellpadding="0" cellspacing="0">
         <tr>
           <td width="33"><span class="Estilo50">Cant</span></td>
           <td width="137"><div align="center"><span class="Estilo50"> Producto </span></div></td>
           <td width="66" align="right"><span class="Estilo50">Total S/. </span></td>
         </tr>
     </table><?php */?>
	 
	 </td>
   </tr>
   <tr>
     <td colspan="3" align="center">--------------------------------------</td>
   </tr><?php */?>
<?php
	//DATOS DE LOS PRODUCTOS Y SERVICIOS DEL DOCUMENTO
	//$strdet		= 	"select * from det_mov where cod_cab= '".$rowcab['cod_cab']."' " ;
	$strdet		= 	"select * from det_mov where cod_cab in (".$codigo.") " ;
	
	$rsdet 		= 	mysql_query ( $strdet,$cn );
	$montogeinafecto = 0 ; 

	while (	$rowdet = mysql_fetch_array ( $rsdet )	) {
	$montoafecto=0;  $montoinafecto = 0; $igvp = 0;
	if( $rowdet['moneda'] != '01' )	{ $montob  = $rowdet['imp_item']*$rowdet['tcambio']; }
	else 						   	{ $montob  = $rowdet['imp_item']; }

	//se le aplica IGV AFECTO
	if( $rowdet['afectoigv'] == 'S'){ $montoafecto  = $montob*100/(100+$igv);$igvp = $montoafecto*($igv/100); }
	//no se le aplica IGV INAFECTO
	else                            { $igvp = 0; $montoinafecto  = $montob ; }

	$montototal 		= 	$montoafecto + $montoinafecto+ $igvp;

	$montogeafecto 		+=	$montoafecto;
	$montogeinafecto	+=	$montoinafecto;
	$montogeigv 		+=  $igvp;
	$montoge    		+=	$montototal;

	//DATOS DE LOS PRODUCTOS Y SERVICIOS
	if(!empty($rowdet['cod_prod']))
	{	$strpro		= 	"select * from producto where idproducto= ".$rowdet['cod_prod'] ;
		$rspro 		= 	mysql_query ( $strpro,$cn );
		$rowpro 	= 	mysql_fetch_array ( $rspro );
    }
	
	//DATOS DE UNIDADES DEL PRODUCTO
	if(!empty($rowdet['unidad']))
	{	$struni		= 	"select * from unidades where id = ".$rowdet['unidad'] ;
		$rsuni	 	=	mysql_query ( $struni,$cn );
		$rowuni		= 	mysql_fetch_array ( $rsuni );
    }
	
	//DATOS DE PAGO 
	if(!empty($rowcab['cab_mov']))
	{
		$strpag		= 	"select vuelto from pagos where referencia = ".$rowcab['cab_mov'] ;
		echo "select vuelto from pagos where referencia = ".$rowcab['cab_mov'] ;
		$rspa	 	=	mysql_query ( $strpag,$cn );
		$rowpag		= 	mysql_fetch_array ( $rspag );		
	}
 ?>
 
 <?php /*?>   <td width="49"><span class="EstiloItem"><?=$rowdet['cantidad'].'('.$rowuni['nombre'].')';?></span></td>
    <td width="141"><span class="EstiloItem"><?=substr($rowpro['nombre'],0,20);?></span></td>
    <td width="52" align="right"><span class="Estilo50"><?=number_format($montototal,2);	?></span></td>
    </tr><?php */?>
	
  <?php 
}   

  ?>
    
  <?php /*?><tr>
    <td colspan="3" align="center">--------------------------------------</td>
    </tr><?php */?>
  <tr>
    <td colspan="2"><span class="Estilo50">Valor de Venta S/.
      <? //$rowmo['simbolo']?> 
      </span></td>
    <td align="right"><span class="Estilo50"><?php echo number_format($montogeafecto,2);?></span></td>
    </tr>
  <? if( $montogeinafecto != 0 ) { ?>	
  <tr colspan="2">
    <td colspan="2"><span class="Estilo50">Servicio</span></td>
    <td align="right"><span class="Estilo50"><?php echo number_format($montogeinafecto,2)?></span></td>
  </tr>	
   <? } ?>
  <tr>
    <td colspan="2"><span class="Estilo50">Igv : 
      <?=$igv.' %' ;?></span></td>
    <td align="right"><span class="Estilo50"><?php echo number_format($montogeigv,2) ?></span></td>
 </tr>
<? } 
//tike de pago
	$strpago	= 	"select * from pagos where referencia in (".$codigo.") " ;
	$resulpago	=   mysql_query($strpago,$cn);
	//$rowP		=   mysql_fetch_array($resulpago);
	//$monto 	=  	$rowP['monto'];
while($rowP=mysql_fetch_array($resulpago)){
	if ($rowP['t_pago']=='1'){
		$monto 	=  	$rowP['monto']+$monto;	
	}elseif ($rowP['t_pago']=='8'){
		$descuento 	=  	$rowP['monto']+$monto;
	}elseif ($rowP['t_pago']=='7'){
		$flete 	=  	$rowP['monto']+$monto;
	}
}

	/*$strcab		= 	"select sum(total) as total from cab_mov where cod_cab in (".$codigo.") " ;
	$resultado	=   mysql_query($strcab,$cn);
	$row		=   mysql_fetch_array($resultado);	
	$montoge 	=  	$row['total'];*/


echo $rowpag['vuelto'];
?>	
  <tr>
    <td colspan="2"><span class="Estilo50">TOTAL VENTA </span></td>
    <td align="right"><span class="Estilo50"><?php echo number_format($montoge,2);?></span></td>
    </tr>
  
  <tr>
    <td colspan="2"><span class="Estilo50">FLETE</span></td>
    <td align="right" class="Estilo50"><?php echo number_format($flete,2);?></td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo50">DESCUENTO</span></td>
    <td align="right" class="Estilo50"><?php echo number_format($descuento,2);?></td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo50">EFECTIVO</span></td>
    <td align="right" class="Estilo50"><?php echo number_format($monto,2);?></td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo50">DEUDA</span></td>
    <td align="right" class="Estilo50"><?php 
	$deuda=($montoge-$descuento+$flete+$_REQUEST['vuelto'])-$monto;
	if ($deuda>0){
	echo number_format($deuda,2);
	}else{
	echo '0.00';
	}
	?></td>
  </tr>
 <!-- <tr>
    <td colspan="2"><span class="Estilo50">IMPORTE RECIBIDO S/. </span></td>
    <td align="right" class="Estilo50"><?php echo number_format($_REQUEST['vuelto']+$montoge,2);?></td>
  </tr>-->
  <tr>
    <td colspan="2"><span class="Estilo50">VUELTO S/. <?php echo number_format($_REQUEST['vuelto'],2);?>
      <? //$rowmo['simbolo']?></span></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo50">USUARIO:<?=$rowusu['usuario'] ?></span></td>
    <td>&nbsp;</td>
  </tr>
 </table>
</div>
<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>
</body>
</html>