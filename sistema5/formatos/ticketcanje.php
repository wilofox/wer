<?php session_start();
	include ('../conex_inicial.php'); 
	include('../numero_letras.php');
		
	function extraefecha($valor){
	$afecha=explode('-',trim($valor));
	$afecha2=explode(' ',trim($afecha[2]));
	$nfecha=$afecha2[0]."-".$afecha[1]."-".$afecha[0]." ".$afecha2[1];
	return $nfecha;
	}
	
	
	
	$empresa=substr($_REQUEST['tienda'],0,1);
	$tienda=$_REQUEST['tienda'];
	$cliente=$_REQUEST['cliente'];
	$codprod=$_REQUEST['codprod'];
	$fecha=$_REQUEST['fecha'];
	$serie=$_REQUEST['serie'];
	$numero=$_REQUEST['numero'];
	$efectivo=$_REQUEST['efectivo'];	
	$puntosD=$_REQUEST['puntosaldo'];
	$puntosC=$_REQUEST['punto'];
				
		if( !empty($empresa))
	{	$stremp		= 	"select des_suc,ruc from sucursal where cod_suc = '".$empresa."' " ;
		$rsemp		=	mysql_query ( $stremp,$cn	);
		$rowemp 	= 	mysql_fetch_array ($rsemp);
    }
	
	if( !empty($tienda))
	{	$stremp2		= 	"select des_suc,ruc from sucursal where cod_suc = '".$tienda."' " ;
		$rsemp2		=	mysql_query ( $stremp2,$cn	);
		$rowemp2 	= 	mysql_fetch_array ($rsemp2);
    }
	
		if( !empty($cliente))
	{	$strcli		= 	"select codcliente,razonsocial,ruc,direccion from cliente where codcliente = '".$cliente."' " ;
		$rsccli	    = 	mysql_query ( $strcli,$cn	);
		$rowcli		= 	mysql_fetch_array (	$rsccli	);
    }
	
	if(!empty($codprod))
	{	$strpro		= 	"select * from producto where idproducto='".$codprod."'" ;
		$rspro 		= 	mysql_query ( $strpro,$cn );
		$rowpro 	= 	mysql_fetch_array ( $rspro );
    }
	
	
			
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:::::IMPRIMIENDO::::</title>
<style type="text/css">
.Estilo40 {font-family: Geneva, Arial, Helvetica, sans-serif ; font-size: 16px;}
.Estilo50 {font-size: 16px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.EstiloItem{font-size: 16px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.Estilo55 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
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
<!--onLoad="defrente()"-->
<body  onLoad="printer()" >
<div id="installOK" style="width:240px;">
 <table width="242" border="0" cellpadding="0" cellspacing="0" align="center">    
    <?php if($flagAnu=='A'){?>
   <tr>
     <td colspan="3" align="center" ><span class="Estilo50">******** ANULADO *******</span></td>
   </tr>
   <?php }else{
	   if(isset($_REQUEST['reimp'])){?>
	   <tr>
		 <td colspan="3" align="center" ><span class="Estilo50">****** COPIA ORIGINAL *****</span></td>
	   </tr>
	   <?php }
   }?>   
   <tr>
     <td colspan="3" align="center" ><p><span class="Estilo50">
       </span><span class="Estilo50"><?=$rowemp['des_suc']?></span><span class="Estilo50"><br> 
         R.U.C: <?=$rowemp['ruc']?><br>
      
	  <?=$rowti['direccion']?> - <?=$rowti['telefono']?>
	  
	  </span>
      <br></td>
    </tr>
   <tr>
    <td colspan="3">&nbsp;</td>
    </tr>
   <tr>
     <td height="24" colspan="3" align="center"><span class="Estilo50"><?php echo $fecha ?>&nbsp;
     <?php //echo "N/O: ". str_pad($rowcab['serie'], 3, "0", STR_PAD_LEFT);?></span></td>
   </tr>
   <tr>
     <td height="22" colspan="3" align="center">----------------------------------------</td>
   </tr>
   <tr>
     <td height="18" colspan="3" align="center"><span class="Estilo50">
       <?php  
	   
	   //if( empty($rowcli['ruc'] ) ){ echo "Ticket BOLETA Nro. ";}else{  echo "Ticket FACTURA Nro. ";  } 
	   echo "CJ ";
	   /*
	   if($doc=='TB')echo $descDoc;
	   if($doc=='TF')echo $descDoc;
	   if($doc=='NV')echo $descDoc;
	   */
	   ?>
      <?php echo $serie."-".$numero ?></span>	   </td>
   </tr>
   <tr>
     <td height="23" colspan="3" align="center">----------------------------------------</td>
   </tr>
   <?php // if(!empty($rowcli['ruc'])){?>
   <tr>
     <td colspan="3"><span class="Estilo50">Cliente:<?=$rowcli['razonsocial']	?><br>
       Ruc:<?=$rowcli['ruc']?><br>
       Dirección:<?=$rowcli['direccion']?></span></td>
   </tr>
   <tr>
    <td colspan="3">----------------------------------------</td>
    </tr>
<?php //} ?>
 <tr>
     <td colspan="3" align="left" valign="baseline">
	 <table border="0" cellpadding="0" cellspacing="0">
         <tr>
           <td width="38"><span class="Estilo50">Cant</span></td>
           <td width="222"><div align="center"><span class="Estilo50"> Producto </span></div>             </td>
          </tr>
     </table></td>
   </tr>
   <tr>
     <td colspan="3">----------------------------------------</td>
   </tr>
<?php
	
 ?>
    <td width="29"><span class="EstiloItem"><?php echo "1" ?></span></td>
    <td width="246" colspan="2"><span class="EstiloItem"><?=$rowpro['nombre'];?></span></td>
    </tr>
  <?php 

  ?>  
  <tr>
    <td colspan="3">----------------------------------------</td>
    </tr>
  
  
  <tr>
    <td colspan="3"><span class="EstiloItem">Puntos Canjeados : </span><?php echo $puntosC?></td>
    </tr>
  <tr>
    <td colspan="3"><span class="EstiloItem">Efectivo : </span><?php echo $efectivo?></td>
    </tr>
  <tr>
    <td colspan="3"><span class="Estilo50">Puntos disponibles : </span><?php echo $puntosD?></td>
    </tr>

	
  <tr>
    <td colspan="3"><span class="Estilo50">USUARIO:<?php echo $_SESSION['codvendedor'] ?></span></td>
    </tr>
  
  <tr>
    <td colspan="3">----------------------------------------</td>
    </tr>
  <tr>
    <td colspan="3" align="center"><span class="Estilo50">Gracias por su Preferencia<br>
      Vuelva Pronto</span></td>
    </tr>
	  <?php if($flagAnu=='A'){?>
   <tr>
     <td colspan="3" align="center" ><span class="Estilo50">******** ANULADO *******</span></td>
   </tr>
   <?php }else{
	   if(isset($_REQUEST['reimp'])){?>
	   <tr>
		 <td colspan="3" align="center" ><span class="Estilo50">****** COPIA ORIGINAL *****</span></td>
	   </tr>
	   <?php }
   }?>
 </table>
</div>
<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>
</body>
</html>