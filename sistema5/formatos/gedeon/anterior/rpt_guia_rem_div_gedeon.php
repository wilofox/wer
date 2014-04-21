<?php 

session_start();

include ('../conex_inicial.php'); 

include('../numero_letras.php');
include('../funciones/funciones.php');


$empresa =  $_REQUEST['empresa'];

$doc=  $_REQUEST['doc'];

$serie =  $_REQUEST['serie'];

$numero =  $_REQUEST['numero'];

$strSQL= "select * from cab_mov where sucursal='$empresa ' and cod_ope='$doc'  and serie='$serie' and Num_doc='$numero' " ;

$resultado = mysql_query ($strSQL,$cn);

$row = mysql_fetch_array ($resultado);

$codigo= $row['cod_cab'];

$nom_aux1 = $row ['cliente']; 

$moneda1 =  $row ['moneda']; 

$obs1 = $row ['obs1']; 

$obs2 = $row ['obs2']; 

$obs3 = $row ['obs3']; 

$obs4 = $row ['obs4']; 

$obs5 = $row ['obs5'];

$tienda=$row ['tienda'];  



$fecha_emision1 = substr ($row ['fecha'],0,10); 

$f = explode("-",$fecha_emision1) ;

$dia_fech = $f[2];

$mes_fech = $f[1];

$año_fech = $f[0];



$f1 = $f[2]."-".$f[1]."-".$f[0];

$fecha_emision = $f1;





$nom_aux3 = $row ['cod_vendedor']; 

$nom_aux4 = $row ['condicion']; 

$cod_tienda = $row ['tienda']; 





$m_bruto  = number_format ($row ['b_imp'],2); 

$igv = number_format ($row ['igv'],2); 



$strSQL1= "select * from cliente where codcliente = '".$nom_aux1."' " ;

$resultado1 = mysql_query ($strSQL1,$cn);

$row = mysql_fetch_array ($resultado1);

$nom_aux = $row ['razonsocial']; 

$direc_aux =  $row ['direccion']; 

$dni_aux = $row ['doc_iden']; 

$ruc_aux = $row ['ruc']; 

$t_persona =$row ['t_persona']; 



$strSQL1= "select * from usuarios where codigo= '".$nom_aux3."' " ;

$resultado1 = mysql_query ($strSQL1,$cn);

$row = mysql_fetch_array ($resultado1);

$responsable = $row ['usuario']; 



$strSQL1= "select * from tienda where cod_tienda= '".$cod_tienda."' " ;

$resultado1 = mysql_query ($strSQL1,$cn);

$row = mysql_fetch_array ($resultado1);

$direc_alma = $row ['direccion'];

$nombre_tienda= $row ['des_tienda'];



 





$strSQL1= "select * from condicion where codigo= '".$nom_aux4."' " ;

$resultado1 = mysql_query ($strSQL1,$cn);

$row = mysql_fetch_array ($resultado1);

$condicion = $row ['nombre']; 



$strSQL1= "select * from det_mov where cod_cab= '".$codigo."' " ;

$resultado1 = mysql_query ($strSQL1,$cn);

$row = mysql_fetch_array ($resultado1);

$cant= $row ['cantidad']; 

$P =  $row ['cod_prod'];

$descripcion =  $row ['nom_prod'];

$p_unit = number_format ($row ['precio'],2);

$nota = substr($row ['notas'],0,15);



$strSQL1= "select * from producto where idproducto= '".$P."' " ;

$resultado1 = mysql_query ($strSQL1,$cn);

$row = mysql_fetch_array ($resultado1);

$u = $row ['und']; 





$strSQL2= "select * from unidades where id = '".$u."' " ;

$resultado1 = mysql_query ($strSQL2,$cn);

$row = mysql_fetch_array ($resultado1);

$unid= $row ['nombre'];





$strSQL1= "select * from referencia where cod_cab = '".$codigo."' " ;

$resultado1 = mysql_query ($strSQL1,$cn);

$row = mysql_fetch_array ($resultado1);

$num_ref_ser = $row ['serie']; 

$num_ref_corr = $row ['correlativo']; 

$cod_cab_ref = $row ['cod_cab_ref']; 







$strSQL3= "select * from cab_mov where cod_cab= '".$cod_cab_ref."' " ;







$resultado3 = mysql_query ($strSQL3,$cn);

$row = mysql_fetch_array ($resultado3);

$tip_docu_ref = $row ['cod_ope']; 

$fecha_ref = $row ['fecha']; 







if ($moneda1 == "01")

($moneda = "S/" );



else

($moneda = "US$");



if ($t_persona == "natural")

($ruc_aux = $dni_aux);



else

($ruc_aux = $ruc_aux);





$p_tot = number_format ($cant * $p_unit,2);



$val_fact = number_format($m_bruto - $val_descu,2);



$m_total = number_format($val_fact + $igv,2) ;





$strSQL_doc= "select * from operacion where codigo = '".$doc."' " ;

$resultado_doc = mysql_query ($strSQL_doc,$cn);

$row_doc = mysql_fetch_array ($resultado_doc);

$cola=$row_doc['cola'];







?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
*{
margin:0mm;
/*border:1mm;*/
padding:0mm 0mm;
font-size: 12px; 
font:Arial, Helvetica, sans-serif;

}
#contenedor{
position:relative;
top:0mm;
left:0mm;
width:168mm;
height:118mm;
border:1px solid;
}
#fecha{
position:absolute;
top:28mm;
left:24mm;
border:1px solid;
}
#partida{
position:absolute;
top:40mm;
left:6mm;
width:75mm;
text-indent:19mm;
border:1px solid;
}
#llegada{
position:absolute;
top:40mm;
left:86mm;
width:75mm;
text-indent:19mm;
border:1px solid;
}
#destino{
position:absolute;
top:52mm;
left:6mm;
width:75mm;
text-indent:19mm;
border:1px solid;
}
#ruc{
position:absolute;
top:60mm;
left:12mm;
border:1px solid;
}
#detalle{
position:absolute;
top:67mm;
left:2mm;
border:1px solid;
}
#total{
position:absolute;
top:198mm;
left:4mm;
border:1px solid;
}
</style>
</head>





<script LANGUAGE="JavaScript"> 

function printer() 

{ 

vbPrintPage() 

return false; 

} 

</script> 

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





<script src="../../javascript/colaimp.js"></script>



<script>



var pc="<?php echo $_SESSION['pc_ingreso'] ?>";

var cola="<?php echo $cola?>";



function printer() 

{ 

vbPrintPage() 

return false; 

} 



function defrente(){

window.focus();



	if(pc=="localhost"){

	viewinit1();

	Print(false, top);

	}else{

	printer();

	}

}



</script>

<!--onLoad="defrente()"-->

<body > 





<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>
<?php if($_SESSION['pc_ingreso']=='localhost'){ ?>
<object id="secmgr" style="display:none" viewastext classid="clsid:5445BE81-B796-11D2-B931-002018654E2E" codebase="http://www.prolyam.com/restaurante/javascript/smsx.cab#Version=6.5.439.37">

<param name="GUID" value="{0ADB2135-6917-470B-B615-330DB4AE3701}">

<param name="Path" value="http://www.meadroid.com/scriptx/sxlic.mlf">

<param name="Revision" value="0">

<param name="PerUser" value="true">

</object>



<object id="factory" style="display:none" viewastext classid="clsid:1663ED61-23EB-11D2-B92F-008048FDD814" codebase="http://codestore.meadroid.com/products/scriptx/binary.ashx?version=6,5,439,50&filename=smsx.cab&x2ref=http://www.meadroid.com/scriptx/docs/samples/basic.asp#Version=6,5,439,50">

</object>

<?php }?>
<div id="contenedor">
<div id="fecha">
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="30" align="center" valign="middle"><?php echo $dia_fech;?></td>
      <td width="30" align="center" valign="middle"><?php echo $mes_fech;?></td>
      <td width="40" align="center" valign="middle"><?php echo $año_fech;?></td>
    </tr>
  </table>
</div>
<div id="serie"><?php echo $doc ?> / <?php echo $serie ?>-<?php echo $numero ?></div>
<div id="partida"><?php echo strtoupper($direc_alma)."-".$empresa; ?></div>
<div id="llegada"><?php echo strtoupper($direc_aux); ?></div>
<div id="destino"><?php echo $nom_aux?></div>
<div id="ruc">  <table width="75"  border="0" cellpadding="0" cellspacing="0">
  <tr>
      <td width="100">&nbsp;</td>
      <td width="20"><?php echo $ruc_aux; ?></td>
      <td width="50">&nbsp;</td>
      <td width="20"><?php echo $dni_aux; ?></td>
  </tr>
  </table>
</div>
<div id="detalle">
  <table width="614"  border="1" align="left" cellpadding="0" cellspacing="0">
    <tr>
      <td width="490" ><span style="visibility:hidden" class="Estilo7">DESCRIPCI&Oacute;N</span></td>
      <td width="48" >&nbsp;</td>
      <td width="133" >&nbsp;</td>
      <td width="104" >&nbsp;</td>
      <td width="138" >&nbsp;</td>
    </tr>
    <?php 	  

$strSQL= "select * from det_mov where cod_cab= '".$codigo."' " ;

$resultado = mysql_query ($strSQL,$cn);



while ($row = mysql_fetch_array ($resultado)) {



$cant= $row ['cantidad']; 

$P =  $row ['cod_prod'];

$descripcion =  $row ['nom_prod'];

$p_unit = number_format ($row ['precio'],2);

	  

$strSQL1= "select * from producto where idproducto= '".$P."' " ;

$resultado1 = mysql_query ($strSQL1,$cn);

$row1 = mysql_fetch_array ($resultado1);

$u = $row1 ['und']; 

$cod_producto=$row1 ['idproducto']; 

$simanejaser = $row1 ['series']; 



$strSQL2= "select * from unidades where id = '".$u."' " ;

$resultado2 = mysql_query ($strSQL2,$cn);

$row2 = mysql_fetch_array ($resultado2);

$unid= $row2 ['nombre'];

/*

$strSQL3= "select * from tienda where cod_suc = '".$empresa."' " ;

$resultado3 = mysql_query ($strSQL3,$cn);

$row3 = mysql_fetch_array ($resultado3);

$tienda= $row3 ['cod_tienda'];

*/

$p_tot = number_format ($cant * $p_unit,2);





$strSQL4="select distinct(se.id),se.* from series se inner join referencia re on re.cod_cab_ref=se.salida inner join det_mov det on det.cod_cab=re.cod_cab_ref and det.cod_prod=se.producto inner join cab_mov ca on re.cod_cab=ca.cod_cab where det.cod_prod='".$P."' and se.tienda='".$tienda."' and ca.cod_cab='".$codigo."'";

$resultado4 = mysql_query ($strSQL4,$cn);

	  ?>
    <tr>
      <td  align="left" valign="top"><span class="Estilo7">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $descripcion;?>&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="Estilo7"></td>
      <td align="center" valign="top"><?php echo $unid; ?></td>
      <td align="center" valign="top"><?php echo $cant ?></td>
      <td align="center" valign="top">&nbsp;</td>
      <td align="center" valign="top">&nbsp;</td>
    </tr>
    <?php 



}



?>
    <tr>
      <td  colspan="27"><div align="left"></div></td>
    </tr>
  </table>
</div>
</div>
</body>

</html>

