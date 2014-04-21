<?php 
session_start();
include ('../conex_inicial.php'); 
include('../numero_letras.php');

$empresa =  $_REQUEST['empresa'];
$doc=  $_REQUEST['doc'];
$serie =  $_REQUEST['serie'];
$numero =  $_REQUEST['numero'];




$strSQL= "select * from cab_mov where sucursal='$empresa ' and cod_ope='$doc'  and serie='$serie' and Num_doc='$numero' " ;


//echo $strSQL;

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
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo3 {font-size: 14px; font:Arial, Helvetica, sans-serif}
.Estilo7 {font-size: 14px; font:Arial, Helvetica, sans-serif}
.Estilo8 {font-size: 11px}
.Estilo1 {font-size: 9px}
-->
</style></head>


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

<body onLoad="defrente()"> 


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

<div id="installFailure" >
	
</div>


<div id="installOK">



<table width="766"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="653">&nbsp;</td>
    <td width="113" colspan="3" valign="bottom"><table style="display:none" width="94" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2"><div style="visibility:hidden"  align="left">R.U.C. N&ordf; 20528334181 </div></td>
      </tr>
      <tr>
        <td colspan="2"><div style="visibility:hidden"  align="left">BOLETA DE VENTA </div></td>
      </tr>
      <tr>
        <td width="31"><div style="visibility:hidden"  align="left">N&quot; 001 - </div></td>
        <td width="69"><div style="visibility:hidden"  align="left"></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="278" colspan="4" align="left"><table width="775"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="171"  class="Estilo8" style="visibility:hidden"  >&nbsp;</td>
        <td width="207"    class="Estilo8"   >&nbsp;</td>
        <td width="52"  align="right" valign="top" class="Estilo8"   >&nbsp;</td>
        <td width="16"  align="center" valign="top" class="Estilo8"   >&nbsp;</td>
        <td width="86"  class="Estilo8" style="visibility:hidden"  >&nbsp;</td>
        <td width="96"   align="center" valign="middle" class="Estilo8" ><span class="Estilo7"><br>
              <br>
          <br>
        </span></td>
        <td width="143" class="Estilo8"   align="center"><span class="Estilo7"><br>
              <br>
          <br>
          <br>
          <?php echo $doc ?> / <?php echo $serie ?>-<?php echo $numero ?>&nbsp;&nbsp;&nbsp;</span></td>
      </tr>

      <tr>
        <td width="171" height="19" align="center" valign="middle" class="Estilo8" ><span class="Estilo7"></span></td>
        <td width="207" class="Estilo8" style="visibility:hidden"  ><?php echo $fecha_emision ?></td>
      </tr>
      <tr>
        <td  align="center" valign="middle" class="Estilo8" >&nbsp;</td>
        <td width="207" class="Estilo8"><?php echo $nom_aux?></td>
      </tr>
      <tr>
        <td align="center" valign="middle" class="Estilo8" >&nbsp;</td>
        <td width="207" class="Estilo8"   ><?php echo strtoupper($direc_aux) ?></td>
      </tr>
      <tr>
        <td  align="center" valign="bottom" class="Estilo8"  >&nbsp;</td>
        <td  colspan="3" align="left" valign="middle"><span class="Estilo8"><?php echo strtoupper($direc_aux) ?></span></td>
        <td colspan="3" align="left" valign="middle" class="Estilo8">&nbsp;</td>
      </tr>
     
      <tr>
        <td class="Estilo8"  >&nbsp;</td>
		  <td class="Estilo8"  ><?php echo strtoupper($ruc_aux) ?></td>
		  <td height="26"  colspan="3" class="Estilo8"><?php echo $fecha_ref ?></td>  
		  <td height="26" class="Estilo8"><span class="Estilo7"><?php echo $num_ref_ser ?>-<?php echo $num_ref_corr?></span></td>
          <td height="26" class="Estilo8">&nbsp;</td>
          <td width="4" height="26" class="Estilo8">&nbsp;</td>
      </tr>
      <tr>
        <td  colspan="6" class="Estilo8">&nbsp;</td>
		  <td  colspan="3" class="Estilo8">&nbsp;</td>
      </tr>
      
    </table></td>
  </tr>
  <tr>
    <td  colspan="4" valign="top"><table width="777"  border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td   colspan="2"><div style="visibility:hidden" align="center"><span class="Estilo8">C&Oacute;DIGO</span></div></td>
        <td ><span style="visibility:hidden" class="Estilo3">DESCRIPCI&Oacute;N</span></td>
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
        <td width="141" align="center" valign="top"><span class="Estilo7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $cod_producto?></span></td>
        <td width="48" align="center" valign="top"><span class="Estilo7"><?php echo $cant ?></span></td>
        <td align="left"><p class="Estilo7"><?php echo $descripcion;
						
		 if ($simanejaser == "S")
				 {
		       		?>
				<br>            
  		<?php 
		$acumulador="";	
	
		while($row4=mysql_fetch_array($resultado4)){
		$acumulador=$acumulador.$row4['serie'].", ";
		}
		$acumulador=substr($acumulador,0,strlen($acumulador)-2);
		
		//echo $acumulador;
		
	echo "S/N:".$acumulador;
	}

	?>
          </p></td>
        </tr>
<?php 

}

?>	  
	  
      <tr>
        <td  colspan="3"><div align="left"></div></td>
        </tr>
    </table></td>
  </tr>
  
   <tr>
    <td height="104"  colspan="4" align="right" class="Estilo8"  >&nbsp;</td>
  </tr>
   
  
  
  
  <tr>
    <td   colspan="4" align="right"><table width="772" height="69" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="454">&nbsp;</td>
        <td width="121">&nbsp;</td>
        <td colspan="2"><span class="Estilo8"><?php echo strtoupper($direc_alma)?></span></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td width="99">&nbsp;</td>
        <td width="102">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>

<div id=idControls class="noprint">
	 <div id="idBtn">
     </div>
  </div>


</div>



</body>
</html>
