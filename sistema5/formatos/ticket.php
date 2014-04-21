<?php 
	session_start();
	include ('../conex_inicial.php'); 
	include('../numero_letras.php');
		
	function extraefecha($valor){
	$afecha=explode('-',trim($valor));
	$afecha2=explode(' ',trim($afecha[2]));
	$nfecha=$afecha2[0]."-".$afecha[1]."-".$afecha[0]." ".$afecha2[1];
	return $nfecha;
	}
	
	//PARAMETROS PASADOS 
	$empresa 	=  	$_REQUEST['empresa'];
	$doc	 	=  	$_REQUEST['doc'];
	$serie 	 	=  	$_REQUEST['serie'];
	$numero  	=  	$_REQUEST['numero'];
	$vuelto		=	$_REQUEST['vuelto'];
	
	if(isset($_REQUEST['codcab'])){
	$strcab		= 	"select * from cab_mov where cod_cab='".$_REQUEST['codcab']."' " ;
	$resultado	=   mysql_query($strcab,$cn);
	$row		=   mysql_fetch_array($resultado);
	$codcab	    =   $row['cod_cab']; //IGV
	$empresa 	=  	$row['sucursal'];
	$doc	 	=  	$row['cod_ope'];
	$serie 	 	=  	$row['serie'];
	$numero  	=  	$row['Num_doc'];
	$flagAnu	=	$row['flag'];
	$estadoDoc	=	$row['estadoOT'];
	$transportista= $row['transportista'];
	}
	
	//PARAMETROS	
	//DATOS DEL DOCUMENTO
	
	$strcab		= 	"select * from cab_mov where sucursal='".$empresa."' and cod_ope='".$doc."' and serie='".$serie."' and Num_doc='".$numero."' " ;
	//echo $strcab;
	$rscab 		= 	mysql_query ( $strcab,$cn	);
	$rowcab 	= 	mysql_fetch_array (	$rscab	);
	$codcab	    =   $rowcab['cod_cab']; //IGV
	$igv 	    =   $rowcab['impto1']; //IGV
	$igv 	    =   $rowcab['impto1']; //IGV
	$nom_aux1   =   $rowcab['cliente'];
	$flagAnu	=	$rowcab['flag'];
	$estadoDoc	=	$rowcab['estadoOT'];
	//$
	$fecha= extraefecha($rowcab['fecha']);
	//echo "EGT".$strcab;
	
    //$fecha=date('Y-m-d H:i:s' ,time() - 3600);
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
		$rsti		=	mysql_query ($strti,$cn);
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
	//if( !empty($doc))
	//{	
	
		$strop	= 	"select * from operacion where codigo = '".$doc."' " ;
		$rsop	= 	mysql_query (	$strop,$cn	);
		$row_doc= 	mysql_fetch_array ($rsop);
	//}
	$cola   =	$row_doc['cola'];
	$descDoc=   $row_doc['descripcion'];
	$comentario2=   $row_doc['comentario2'];
	
	$strtransp	= 	"select * from transportista where id = '".$transportista."' " ;
	$rsTransp	= 	mysql_query ($strtransp,$cn);
	$row_transp= 	mysql_fetch_array($rsTransp);
	
	$nom_transp=$row_transp['nombre'];
	
	$strtransp	= 	"select * from pagos where referencia = '".$_REQUEST['codcab']."' " ;
	$rsTransp	= 	mysql_query ($strtransp,$cn);
	$rowpagos= 	mysql_fetch_array($rsTransp);
	
	//$vuelto=$rowpagos['nombre'];
	
			
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:::::IMPRIMIENDO::::</title>

<style type="text/css">
.Estilo40 {font-family: "Bookman Old Style" ; font-size: 12px;}
.Estilo50 {font-size: 12px; font-family: "Bookman Old Style"; }
.EstiloItem{font-size: 12px; font-family: "Bookman Old Style"; }
.Estilo55 {
	font-family: "Bookman Old Style";
	font-size: 12px;
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

<link rel="stylesheet" type="text/css" href="../utilitarios/demo.css"/>
<script type="text/javascript" src="../utilitarios/npProlyam.js"></script> 
<script type="text/javascript" src="../utilitarios/jquery-1.4.4.js"></script> 



<script language="javascript">
   var  objPlugin = new  npPlugin("plugin");
   /*
    function extract_link_href(aSourceHTML)
    {
        var regexp=/<link.*href\s*=\s*[\'\"]([^\"\']*)[\"\'][^>]*>/ig;
        var result;
        var sret="";
        while((result = regexp.exec(aSourceHTML)) != null) {
            sret+=result[1]+";";
        }
        return sret; 
    }

    function SaveHTML(url)
    {
        var url_links="";
        var alinks=new Array();
        var all_css =new Array();
        var s_url="";
        var all_html="";
       // alert(1);
        s_url=url;
        all_html="";
        if (s_url!=""){
               // alert(s_url);
                $.ajax({
                  type: "GET",
                  async:false,    
                  dataType: "text/html",          
                  url: s_url,//alinks[link],
                  complete: function( res, status ) {
                        // If successful, inject the HTML into all the matched elements
                        if ( status === "success" || status === "notmodified" ) 
                        {
                          //alert(res.responseText);
                          all_html=res.responseText;
                        }
                        //alert(res.responseText);
                        //alert(22);
                    }
                });        
        }
        // alert(20);
        if (all_html==""){
            alert("error al recuperar html base.... pf verifique");
            return ;
         }   
         
         url_links= extract_link_href(all_html);
        alinks= url_links.split(";");
        for (var link in alinks )
        {
            var s_url=alinks[link];
            //alert(s_url);
            if (s_url!=""){
                $.ajax({
                  type: "GET",
                  async:false,    
                 // contentType='application/x-www-form-urlencoded',
                  dataType: "text/html",          
                  url: s_url,//alinks[link],
                  complete: function( res, status ) {
                        // If successful, inject the HTML into all the matched elements
                        if ( status === "success" || status === "notmodified" ) 
                        {
                          all_css[s_url]=res.responseText;
                          //alert(res.responseText);
                        }
                        //all_css+=res.responseText;
                    }
                });        
            }
        }
        //alert("1");  
        //alert(all_html);
        objPlugin.saveDataHTML(url,all_html, "html");
        for (var v in  all_css)
        {
            //alert(all_css[v]);
            objPlugin.saveDataHTML(v,all_css[v], "css");
        } 
    } 
	
	*/
</script>


<?php
$url="ticket.php";
//$impresora="\\\\\\\\DESARROLLOWEB1\\\\Epson LX-300+";
//$impresora="PDF Complete";
$impresora=$cola;
$anchodoc='760';

$altura='2970';

//echo $impresora;
?>
<script language="javascript">

function printer() 
{ 
PrintHTMLSample()

} 

 function PrintHTMLSample()
    {
	  //alert(objPlugin.getPrinters());
	// var codcab="<?php echo $codcab ?>";
	// var vuelto="<?php echo $_REQUEST['vuelto']?>";
 	
	  //var url="ticket.php";
	 var url="<?php echo $url.'?empresa='.$empresa.'&doc='.$doc.'&serie='.$serie.'&numero='.$numero.'&codigoCab='.$codigo.'&vuelto=' ?>";
	  var impresora="<?php echo $impresora ?>";

	 // SaveHTML(url);
	 //alert(objPlugin.getPrinters());
	 //alert(url+ " "+impresora);
	 //var objCola=objPlugin.PrintHTML( url, impresora,'');
	 
	 objPlugin.PrintHTML( url, impresora, "<?php echo $altura.'|'.$anchodoc ?>");
	  //alert(objCola);
	   if(objCola=='OK'){
	   // window.close();
	   }	   
	   
	  // colocar la URL a imprimir
	  //SaveHTML(url)
      //objPlugin.PrintHTML(url,document.getElementById("printer").value);
	}

</script>

<!--onLoad="defrente()"-->
<!--
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
-->
<!--<script type="text/javascript" src="../javascript/colaimp.js"></script> -->
<script language="javascript">
/*
var pc="<?php //echo $_SESSION['pc_ingreso'] ?>";
var cola="<?php // echo $cola?>";

function printer() 
{ 
vbPrintPage(); 
return false; 
} 
*/
</script>

<body  onLoad="printer()" class="indent" >

   <!--[if IE]>
    <object CLASSID="CLSID:D59F4895-9DEE-471E-B176-6E7FC9E01130"
            id="plugin" 
            type="application/prolyam-plugin"  
            width="100" 
            height="10"  style="visibility:hidden;">
    </object>
    <![endif]-->
    <!--[if !IE]> <!-->
    <object id="plugin" 
            type="application/prolyam-plugin"  
            width="100" 
            height="10" style="visibility:hidden;">
    </object>
    <!--<![endif]-->

<div id="installOK" style="width:233px; padding-left:5px">
 <table width="233" border="0" cellpadding="0" cellspacing="0" align="center">    
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
       </span><span  style="font:Arial, Helvetica, sans-serif; font:12px"><?=$rowemp['des_suc']?></span><span class="Estilo50"><br> 
         R.U.C: <?=$rowemp['ruc']?><br>
      
	  <?=$rowti['direccion']?> - <?=$rowti['telefono']?>
	  
	  </span>
      <br></td>
    </tr>
   <tr>
    <td colspan="3"><table width="100%"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="18"  align="center"><span class="Estilo50"><br>
          Nro.Serie S/N &nbsp;<?php echo $_SESSION['registradora']; ?></span>       </td>
        </tr>
      <tr>
        <td height="24"  align="center"><span class="Estilo50">Autoriz.Sunat:<?php echo $_SESSION['autSunat']; ?></span></td>
      </tr>
    </table>	</td>
    </tr>
   <tr>
     <td height="34" colspan="3" align="center"><span class="Estilo50"><?php echo $fecha ?>&nbsp;
     <?php //echo "N/O: ". str_pad($rowcab['serie'], 3, "0", STR_PAD_LEFT);?></span></td>
   </tr>
   <tr>
     <td height="22" colspan="3" align="center">----------------------------------------</td>
   </tr>
   <tr>
     <td height="18" colspan="3" align="center"><span class="Estilo50">
       <?php  
	   
	   //if( empty($rowcli['ruc'] ) ){ echo "Ticket BOLETA Nro. ";}else{  echo "Ticket FACTURA Nro. ";  } 
	   echo $descDoc;
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
   <?php if(!empty($rowcli['ruc'])){?>
   <tr>
     <td colspan="3"><span class="Estilo50">Cliente:<?=$rowcli['razonsocial']	?><br>
       Ruc:<?=$rowcli['ruc']?><br>
       Dirección:<?=$rowcli['direccion']?></span></td>
   </tr>
   <tr>
    <td colspan="3">------------------------------------------------------</td>
    </tr>
<?php }?>
 <tr>
     <td colspan="3" align="left" valign="baseline">
	 <table width="230" border="0" cellpadding="0" cellspacing="0">
         <tr>
           <td width="43"><span class="Estilo50">Cant</span></td>
           <td width="170"><div align="center"><span class="Estilo50"> Producto </span></div></td>
           <td width="65" align="right"><span class="Estilo50">Total S/. </span></td>
         </tr>
     </table></td>
   </tr>
   <tr>
     <td colspan="3">------------------------------------------------------</td>
   </tr>
<?php
	//DATOS DE LOS PRODUCTOS Y SERVICIOS DEL DOCUMENTO
	$strdet		= 	"select * from det_mov where cod_cab= '".$rowcab['cod_cab']."' " ;
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
    <td width="46"><span class="EstiloItem"><?=$rowdet['cantidad'].'('.$rowuni['nombre'].')';?></span></td>
    <td width="138"><span class="EstiloItem"><?=substr($rowpro['nombre'],0,20);?></span></td>
    <td width="49" align="right"><span class="Estilo50"><?=number_format($montototal,2);	?></span></td>
    </tr>
  <?php 
}   
  ?>  
  <tr>
    <td colspan="3">------------------------------------------------------</td>
    </tr>
  <?php if($doc!='TB'){ ?>
  
  <tr>
    <td colspan="2"><span class="Estilo50">***Valor de Venta S/.
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
	
	 <?php } ?>
	
  <tr>
    <td colspan="2"><span class="Estilo50">TOTAL VENTA S/.
      <? //$rowmo['simbolo']?></span></td>
    <td align="right"><span class="Estilo50"><?php echo number_format($montoge,2);?></span></td>
    </tr>
  
  <tr>
    <td colspan="2"><span class="Estilo50">IMPORTE RECIBIDO S/. </span></td>
    <td align="right" class="Estilo50"><?php echo number_format($_REQUEST['vuelto']+$montoge,2);?></td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo50">VUELTO S/. <?php echo number_format($vuelto,2);?><? //$rowmo['simbolo']?></span></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo50">USUARIO:<?=$rowusu['usuario'] ?></span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="30" colspan="2" style=" display:none"><span class="Estilo50">TRANSPORTISTA: <?php echo $nom_transp?></span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">------------------------------------------------------</td>
    </tr>
  <tr>
    <td colspan="3" align="center"><span class="Estilo50"><?php echo $comentario2?><br>
    </span></td>
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
<?php /*?><OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT><?php */?>
</body>
</html>