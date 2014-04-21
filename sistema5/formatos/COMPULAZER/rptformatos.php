<?php 
include ('../../conex_inicial.php'); 

$codigo =  "4";
$strSQL= "select * from cab_mov where cod_cab = '".$codigo."' " ;
$resultado = mysql_query ($strSQL,$cn);
$row = mysql_fetch_array ($resultado);
$nom_aux1 = $row ['cliente']; 
$moneda1 =  $row ['moneda']; 
$obs1 = $row ['obs1']; 
$obs2 = $row ['obs2']; 
$obs3 = $row ['obs3']; 
$obs4 = $row ['obs4']; 
$obs5 = $row ['obs5']; 


$fecha_emision1 = substr ($row ['fecha'],0,10); 
$f = explode("-",$fecha_emision1) ;
$f1 = $f[2]."-".$f[1]."-".$f[0];
$fecha_emision = $f1;

$nom_aux3 = $row ['cod_vendedor']; 
$nom_aux4 = $row ['condicion']; 
$m_total = number_format ($row ['total'],2); 
 

$strSQL1= "select * from cliente where codcliente = '".$nom_aux1."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$nom_aux = $row ['razonsocial']; 
$direc_aux =  $row ['direccion']; 
$dni_aux = $row ['doc_iden']; 
 

$strSQL1= "select * from cliente where codcliente = '".$nom_aux1."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$nom_aux = $row ['razonsocial']; 
$direc_aux =  $row ['direccion']; 
$dni_aux = $row ['doc_iden']; 



$strSQL1= "select * from usuarios where codigo= '".$nom_aux3."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$responsable = $row ['usuario']; 

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

$strSQL1= "select * from producto where idproducto= '".$P."' " ;
$resultado1 = mysql_query ($strSQL1,$cn);
$row = mysql_fetch_array ($resultado1);
$u = $row ['und']; 

$strSQL2= "select * from unidades where id = '".$u."' " ;
$resultado1 = mysql_query ($strSQL2,$cn);
$row = mysql_fetch_array ($resultado1);
$unid= $row ['nombre'];
//moneda S/ O US$/
if ($moneda1 = "01")
($moneda = "S/." );

else
($moneda = "US$");

//tipo de moneda

if ($moneda1 = "01")
($moneda_docu = " SOLES (S/.)" );

else
($moneda_docu = "DOLARES (US$)");


$p_tot = number_format ($cant * $p_unit,2)



?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 9px}
-->
</style>
</head>

<body>
<table width="100%" height="605" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="17%" height="21" class="Estilo1"><div align="left"><span class="Estilo1">DOCUMENTO</span></div></td>
    <td colspan="3" class="Estilo1"><?php echo $documento ?></td>
  </tr>
  <tr>
    <td height="19" class="Estilo1"><div align="left"><span class="Estilo1">N&ordm; DOCUMENTO </span></div></td>
    <td height="19" colspan="3" class="Estilo1"><?php echo $n_docu ?></td>
  </tr>
  <tr>
    <td height="19" class="Estilo1"><div align="left"><span class="Estilo1">SUCURSAL</span></div></td>
    <td height="19" colspan="3" class="Estilo1"><?php echo $sucursal ?></td>
  </tr>
  <tr>
    <td class="Estilo1"><div align="left"><span class="Estilo1">DIREC. SUCURSAL </span></div></td>
    <td class="Estilo1"><?php echo $direc_suc ?></td>
    <td class="Estilo1">COMENTARIO 1 </td>
    <td class="Estilo1"><?php echo $comentario1?></td>
  </tr>
  <tr>
    <td height="19" colspan="2" class="Estilo1"><div align="left"><span class="Estilo1">DATOS DEL ALMACEN </span></div></td>
    <td class="Estilo1">COMENTARIO 2 </td>
    <td class="Estilo1"><?php echo $comentario2 ?></td>
  </tr>
  <tr>
    <td height="19" class="Estilo1"><div align="left"><span class="Estilo1">DIREC. ALMACEN </span></div></td>
    <td height="19" class="Estilo1"><?php echo $alma_direc ?></td>
    <td height="19" class="Estilo1">OBS 1 </td>
    <td height="19" class="Estilo1"><?php echo $obs1 ?></td>
  </tr>
  <tr>
    <td height="19" class="Estilo1"><div align="left">NOMBRE</div></td>
    <td height="19" class="Estilo1"><?php echo $alma_nombre ?></td>
    <td height="19" class="Estilo1">OBS 2 </td>
    <td height="19" class="Estilo1"><?php echo $obs2 ?></td>
  </tr>
  <tr>
    <td height="19" class="Estilo1"><div align="left"><span class="Estilo1">DISTRITO</span></div></td>
    <td height="19" class="Estilo1"><?php echo $alma_distrito ?></td>
    <td height="19" class="Estilo1">OBS 3 </td>
    <td height="19" class="Estilo1"><?php echo $obs3 ?></td>
  </tr>
  <tr>
    <td height="19" class="Estilo1"><div align="left"><span class="Estilo1">PROVINCIA</span></div></td>
    <td height="19" class="Estilo1"><?php echo $alma_provincia ?></td>
    <td height="19" class="Estilo1">OBS 4 </td>
    <td height="19" class="Estilo1"><?php echo $obs4 ?></td>
  </tr>
  <tr>
    <td height="19" class="Estilo1"><div align="left"><span class="Estilo1">DEPARTAMENTO</span></div></td>
    <td height="19" class="Estilo1"><?php echo $alma_departamento ?></td>
    <td height="19" class="Estilo1">OBS 5 </td>
    <td height="19" class="Estilo1"><?php echo $obs5 ?></td>
  </tr>
  <tr>
    <td height="19" colspan="2" class="Estilo1"><div align="center"><span class="Estilo1">DATOS DEL AUXILIAR </span></div></td>
    <td colspan="2" class="Estilo1">NOTA<?php echo $nota ?> </td>
  </tr>
  <tr>
    <td height="19" class="Estilo1"><div align="left"><span class="Estilo1">SR.(S)</span></div></td>
    <td height="19" class="Estilo1"><?php echo $nom_aux ?></td>
    <td height="19" class="Estilo1">MONEDA</td>
    <td height="19" class="Estilo1"><?php echo $moneda_docu?></td>
  </tr>
  <tr>
    <td height="19" class="Estilo1"><div align="left"><span class="Estilo1">DIRECCION</span></div></td>
    <td height="19" class="Estilo1"><?php echo $direc_aux ?></td>
    <td height="19" class="Estilo1">&nbsp;</td>
    <td height="19" class="Estilo1">&nbsp;</td>
  </tr>
  <tr>
    <td height="19" class="Estilo1"><div align="left"><span class="Estilo1">RUC</span></div></td>
    <td width="13%" height="19" class="Estilo1"><?php echo $ruc_aux?></td>
    <td colspan="2" class="Estilo1"><div align="center">DATOS TRANSPORTISTA </div></td>
  </tr>
  <tr>
    <td height="19" class="Estilo1"><div align="left"><span class="Estilo1">DNI</span></div></td>
    <td height="19" class="Estilo1"><?php echo $dni_aux ?></td>
    <td width="21%" class="Estilo1"><div align="left">NOM. TRANSPORTISTA </div></td>
    <td width="49%" class="Estilo1"><?php echo $nom_trans ?></td>
  </tr>
  <tr>
    <td height="19" class="Estilo1"><div align="left"><span class="Estilo1">TELEFONO: </span></div></td>
    <td height="19" class="Estilo1"><?php echo $telef_aux ?></td>
    <td width="21%" class="Estilo1"><div align="left">RUC TRANSP </div></td>
    <td width="49%" class="Estilo1"><?php echo $ruc_trans ?></td>
  </tr>
  <tr>
    <td height="19" class="Estilo1"><div align="left">DOC. REFERECIA </div></td>
    <td height="19" class="Estilo1"><?php echo $doc_referencia ?></td>
    <td width="21%" class="Estilo1"><div align="left">PLACA</div></td>
    <td width="49%" class="Estilo1"><?php echo $placa_trans ?></td>
  </tr>
  <tr>
    <td height="19" class="Estilo1"><div align="left">FECHA DE EMISION </div></td>
    <td height="19" class="Estilo1"><?php echo $fecha_emision ?></td>
    <td width="21%" class="Estilo1"><div align="left">MARCA</div></td>
    <td width="49%" class="Estilo1"><?php echo $marca_trans ?></td>
  </tr>
  <tr>
    <td height="19" class="Estilo1"><div align="left">FECHA DE VENCIMIENTO </div></td>
    <td height="19" class="Estilo1"><?php echo $fecha_vencimiento ?></td>
    <td width="21%" class="Estilo1"><div align="left">CERTIFICA</div></td>
    <td width="49%" class="Estilo1"><?php echo $certifica_trans?></td>
  </tr>
  <tr>
    <td height="22" class="Estilo1"><div align="left">CONDICION:</div></td>
    <td height="22" class="Estilo1"><?php echo $condicion ?></td>
    <td width="21%" class="Estilo1"><div align="left">BREVETE</div></td>
    <td width="49%" class="Estilo1"><?php echo $brevete_trans ?></td>
  </tr>
  <tr>
    <td height="22" colspan="2" class="Estilo1">&nbsp;</td>
    <td class="Estilo1">DIRECCION TRANSPORTISTA </td>
    <td class="Estilo1"><?php echo $direc_trans ?></td>
  </tr>
  <tr>
    <td height="158" colspan="4"><table width="100%" height="158" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="3%" height="16"><div align="center"><span class="Estilo1">IT</span></div></td>
        <td width="7%" class="Estilo1"><div align="center">COD_PROLY</div></td>
        <td width="10%"><div align="center"><span class="Estilo1">COD_ANEXO</span></div></td>
        <td width="43%" class="Estilo1"><div align="center">DESCRIPCION</div></td>
        <td width="6%"><div align="center"><span class="Estilo1">CANT</span></div></td>
        <td width="8%"><div align="center"><span class="Estilo1">UNID.</span></div></td>
        <td width="7%"><div align="center"><span class="Estilo1">P. UNIT</span></div></td>
        <td width="7%"><div align="center"><span class="Estilo1">P.TOTAL</span></div></td>
        <td width="9%"><div align="center"><span class="Estilo1">NOTAS.</span></div></td>
      </tr>
      <tr>
        <td height="71"><div align="center" class="Estilo1"><?php echo $item?></div></td>
        <td><div align="center" class="Estilo1"><?php echo $cod_proly ?></div></td>
        <td><div align="center" class="Estilo1"><?php echo $cod_anexo ?></div></td>
        <td><div align="center" class="Estilo1"><?php echo $descripcion ?></div></td>
        <td><div align="center" class="Estilo1"><?php echo $cant ?><br>
        </div></td>
        <td><div align="center" class="Estilo1"><?php echo $unid ?></div></td>
        <td><div align="center" class="Estilo1"><?php echo $p_unit ?></div></td>
        <td><div align="center" class="Estilo1"><?php echo $p_tot ?></div></td>
        <td><div align="center" class="Estilo1"><?php echo $nota?></div></td>
      </tr>
      <tr>
        <td height="19" colspan="3"><div align="center"><span class="Estilo1">SON: </span></div></td>
        <td colspan="6"><?php echo $monto_letra ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="62" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="47%" class="Estilo1"><div align="center">RESPONSABLE</div></td>
        <td width="53%" class="Estilo1"><?php echo $responsable ?></td>
      </tr>
      <tr>
        <td class="Estilo1"><div align="center">USUARIO</div></td>
        <td class="Estilo1"><?php echo $usuario ?></td>
      </tr>


    </table></td>
    <td height="62" colspan="2"><table width="32%" height="69" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2" class="Estilo1"><div align="center">M. BRUTO </div></td>
        <td width="17%" class="Estilo1"><?php echo $moneda ?></td>
        <td width="40%" class="Estilo1"><?php echo $m_bruto ?></td>
      </tr>
      <tr>
        <td width="28%" class="Estilo1"><div align="center">I.G.V</div></td>
        <td width="15%" class="Estilo1"><div align="center"><?php echo $impuesto ?></div></td>
        <td class="Estilo1"><?php echo $moneda ?></td>
        <td class="Estilo1"><?php echo $igv ?></td>
      </tr>
      <tr>
        <td colspan="2" class="Estilo1"><div align="center">TOTAL</div></td>
        <td class="Estilo1"><?php echo $moneda ?></td>
        <td class="Estilo1"><?php echo $m_total ?></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
