<?php 

session_start();

include ('../../conex_inicial.php'); 

include('../../numero_letras.php');


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

$año_fech = substr ($f[0],2,2);





$nom_aux3 = $row ['cod_vendedor']; 

$nom_aux4 = $row ['condicion']; 

$m_total = $row ['total']; 

 

$m_bruto  = $row ['b_imp']; 

$igv = $row ['igv']; 











$strSQL1= "select * from referencia where cod_cab = '".$codigo."' " ;

$resultado1 = mysql_query ($strSQL1,$cn);

$row = mysql_fetch_array ($resultado1);

$num_ref_ser = $row ['serie']; 

$num_ref_corr = $row ['correlativo']; 

$cod_cab_ref1 = $row ['cod_cab_ref']; 



$strSQL3= "select * from cab_mov where cod_cab= '".$cod_cab_ref1."' " ;



$resultado3 = mysql_query ($strSQL3,$cn);

$row = mysql_fetch_array ($resultado3);

$tip_docu_ref = $row ['cod_ope']; 



$strSQL1= "select * from cliente where codcliente = '".$nom_aux1."' " ;

$resultado1 = mysql_query ($strSQL1,$cn);

$row = mysql_fetch_array ($resultado1);

$nom_aux = $row ['razonsocial']; 

$direc_aux =  $row ['direccion']; 

$dni_aux = $row ['doc_iden']; 

//$ruc_aux = $row ['ruc']; 
$email_aux=$row ['email']; 

 

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

$p_unit = $row ['precio'];

$nota = substr($row ['notas'],0,15);



$strSQL1= "select * from producto where idproducto= '".$P."' " ;

$resultado1 = mysql_query ($strSQL1,$cn);

$row = mysql_fetch_array ($resultado1);

$u = $row ['und']; 



$strSQL2= "select * from unidades where id = '".$u."' " ;

$resultado1 = mysql_query ($strSQL2,$cn);

$row = mysql_fetch_array ($resultado1);

$unid= $row ['nombre'];



//if ($moneda1 = '01')

///($moneda = 'S/' );

//else	

//($moneda = 'US$');	



switch($moneda1)

{

case "01":

$moneda = "S/.";

break;



case "02":

$moneda = "US$";

break;

}

switch($moneda1)

{

case "01":

$monedalet = "NUEVOS SOLES";

break;



case "02":

$monedalet = "DOLARES AMERICANOS";

break;

}







switch($mes_fech)

 {

 

  	case "01":

    $mes_letra = "Enero";

	break;

	

	case "02":

    $mes_letra = "Febrero";

	break;

	

	case "03":

    $mes_letra = "Marzo";

	break;

	

	case "04":

    $mes_letra = "Abril";

	break;

	

	case "05":

    $mes_letra = "Mayo";

	break;

	

	case "06":

    $mes_letra = "Junio";

	break;

	

	case "07":

    $mes_letra = "Julio";

	break;

	

	case "08":

    $mes_letra = "Agosto";

	break;

	

	case "09":

    $mes_letra = "Setiembre";

	break;

	

	case "10":

    $mes_letra = "Octubre";

	break;

	

	case "11":

    $mes_letra = "Noviembre";

	break;

	

	case "12":

	$mes_letra = "Diciembre";

	break;

}



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
border:0mm;
padding:0mm 0mm;
font-size: 11px; 
font:Arial, Helvetica, sans-serif;

}
/*#contenedor{
position:relative;
top:0mm;
left:0mm;
width:100mm;
border:0px solid;
}*/
#contenedor{
position:relative;
top:0mm;
left:0mm;
height:100mm;
width:100mm;
border:0px solid;
}
#sec1{
position:relative;
height:50mm;
border:0px solid;
}
#serie{
	position:absolute;
	top:35.983mm;
	right:-28.575mm;
	border:0px solid;
	width: 100px;
}
#fecha{
	position:absolute;
	top:73.554mm;
	right:42.862mm;
	border:0px solid;
	width: 133px;
	height: 21px;
}
#cliente{
	position:absolute;
	top:60.854mm;
	left:22.225mm;
	border:0px solid;
	height: 16px;
}
#direccion{
position:absolute;
top:68.527mm;
left:22.225mm;
border:0px solid;
}
#email{
position:absolute;
top:3.704mm;
left:1.323mm;
border:0px solid;
}
#sec2{
position:relative;
height:100mm;
border:0px solid;
}
#detalle{
	position:absolute;
	top:17.992mm;
	left:4.762mm;
	border:0px solid;
	width: 505px;
	height: 217px;
}
#sec3{
position:relative;
height:20mm;
border:0px solid;
}
#total{
	position:absolute;
	top:27.781mm;
	right:-35.454mm;
	border:0px solid;
	height: 20px;
	width: 68px;
}
</style>



<style media="print">

.noprint     { display: none }

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



var pc="<?php echo $_SESSION['pc_ingreso'] ?>";

var cola="<?php echo $cola?>";



function printer() 

{ 

vbPrintPage(); 

return false; 

} 
</script>



<!--onLoad="defrente()"-->

<body onLoad="printer()" >



<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>
<div id="contenedor">
<div id="sec1">
<div id="serie"><?php echo $doc ?> / <?php echo $serie ?> - <?php echo $numero ?></div>
<div id="fecha">
  <table width="82" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="33" align="center" valign="middle"><?php echo $dia_fech ?></td>
        <td width="33" align="center" valign="middle"><?php echo $mes_fech?></td>
        <td width="33" align="center" valign="middle"><?php echo $año_fech ?></td>
      </tr>
    </table>
</div>
<div id="cliente"><?php echo strtoupper($nom_aux); ?></div>
<div id="direccion"><?php echo strtoupper($direc_aux); ?></div>
<div id="email"><?php echo $dni_aux ?></div>
</div>
<div id="sec2">
<div id="detalle">
  <table width="475" height="89"  border="0" align="left" cellpadding="0" cellspacing="0">

      <tr>

        <td width="51" align="center"><span style="visibility:hidden" align ="center">C</span></td>

       

        <td width="329" align="center"><span style="visibility:hidden" >DESCRIPCI&Oacute;N</span></td>

        <td width="46" align="center" class="Estilo3">&nbsp;</td>

        <td width="49" align="center"><span style="visibility:hidden" > I </span></td>
      </tr>

	  

	  <?php 	  

$strSQL= "select * from det_mov where cod_cab= '".$codigo."' " ;

$resultado = mysql_query ($strSQL,$cn);



while ($row = mysql_fetch_array ($resultado)) {



$cant= $row ['cantidad']; 

$P =  $row ['cod_prod'];

$descripcion =  $row ['nom_prod'];

$p_unit = $row ['precio'];

$p_tot = $cant * $p_unit;

	  

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

$strSQL4="select * from series where producto='".$P."' and tienda='".$tienda."' and salida='".$codigo."'";

$resultado4 = mysql_query ($strSQL4,$cn);

//$row4 = mysql_fetch_array ($resultado4);

//$acumulador = $row4 ['serie'];



//



//$acumulador = $row4 ['serie'].",";

//*********************************

//while($row=mysql_fetch_array($resultado4)){

//$acumulador=$acumulador.$row['serie'].", ";

//}

//$acumulador=substr($acumulador,0,strlen($acumulador)-2);



//echo $acumulador;



	  ?>

	

      <tr>

        <td  align="center" valign="top"><?php echo $cant ?></td>

        <td height="20" align="left" valign="top"><p class="Estilo7"><?php echo substr($descripcion,0,80);

		

		 if ($simanejaser == "S" )



				 {

		?>

         <br> <?php 

		$acumulador="";

		

		while($row4=mysql_fetch_array($resultado4)){

		$acumulador=$acumulador.$row4 ['serie'].", ";

		}

		$acumulador=substr($acumulador,0,strlen($acumulador)-2);

		

		//echo $acumulador;



		

	echo "S/N:".$acumulador;

	}

	?>

          

        </p></td>

        <td align="right" valign="top">&nbsp;<?php echo number_format($p_unit,2) ?></td>

        <td align="right" valign="top"  class="Estilo7" >&nbsp;<?php echo number_format($p_tot,2)?></td>
      </tr>

<?php 



}



?>	  

	  

      <tr>

        <td height="19" colspan="6">&nbsp;</td>
      </tr>

    </table>
</div>
</div>
<div id="sec3">
<div id="total"><?php echo $moneda." ".number_format($m_total,2) ?></div>
</div>
</div>
</body>

</html>

