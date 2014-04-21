<?php 
include('conex_inicial.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo2 {font-size: 11px}
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.Estilo10 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
-->
</style>
</head>

<link href="styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-image: url(imagenes/bg3.jpg);
}
.Estilo15 {color: #FFFFFF}
-->
</style>

<body>
<table width="809" height="151" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><form name="form1" method="post" action="">
      <table width="793" height="192" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="19" height="34">&nbsp;</td>
          <td width="774"><label for="textfield"></label>
            <span class="Estilo7">Fecha</span>
            <input name="fecha1" type="text" id="fecha1" size="10"  readonly="readonly" maxlength="10">
            <span class="Estilo2">(dd/mm/aaaa)</span>
            <select  name="mes">
              <option value="01">Enero 
              <option value="02">Febrero 
              <option value="03">Marzo 
              <option value="04">Abril 
              <option value="05">Mayo 
              <option value="06">Junio 
              <option value="07">Julio 
              <option value="08">Agosto 
              <option value="09">Septiembre 
              <option value="10">Octubre 
              <option value="11">Noviembre 
              <option value="12">Diciembre 
              </select>
			  
			  	<script>
			 var valor1="<?php echo $_REQUEST['mes']?>";
     var i;
	 for (i=0;i<document.form1.mes.options.length;i++)
        {
		
            if (document.form1.mes.options[i].value==valor1)
               {
			   
               document.form1.mes.options[i].selected=true;
               }
        
        }
			
			</script>
			  
            &nbsp;&nbsp;
            <select name="ano">
              <option value="2009">2009</option>
			   <option value="2010" selected>2010</option>
			    <option value="2011" selected>2011</option>
            </select>
            &nbsp;&nbsp;
				<script>
			 var valor1="<?php echo $_REQUEST['ano']?>";
     var i;
	 for (i=0;i<document.form1.ano.options.length;i++)
        {
		
            if (document.form1.ano.options[i].value==valor1)
               {
			   
               document.form1.ano.options[i].selected=true;
               }
        
        }
			
			</script>
			
			
            <select name="vendedor">
			
			<?php 
			$strSQL="select * from usuarios";
			$resultado=mysql_query($strSQL,$cn);
			while($row=mysql_fetch_array($resultado)){
			
			?>
			 <option value="<?php echo $row['codigo']?>"><?php echo $row['usuario']?></option>
            <?php }?>
			
			
			<script>
			 var valor1="<?php echo $_REQUEST['vendedor']?>";
     var i;
	 for (i=0;i<document.form1.vendedor.options.length;i++)
        {
		
            if (document.form1.vendedor.options[i].value==valor1)
               {
			   
               document.form1.vendedor.options[i].selected=true;
               }
        
        }
			
			</script>
            </select>
			
			
            &nbsp;&nbsp;
			
			
			
			
			    <select name="serie">
			
			 <option value="000">Todos los terminales</option>
			<?php 
			$strSQL="select * from caja";
			$resultado=mysql_query($strSQL,$cn);
			while($row=mysql_fetch_array($resultado)){
			
			?>
			 <option value="<?php echo $row['codigo']?>"><?php echo $row['descripcion']?></option>
            <?php }?>
            </select>
			
			
            &nbsp;&nbsp;
			<script>
			 var valor1="<?php echo $_REQUEST['serie']?>";
     var i;
	 for (i=0;i<document.form1.serie.options.length;i++)
        {
		
            if (document.form1.serie.options[i].value==valor1)
               {
			   
               document.form1.serie.options[i].selected=true;
               }
        
        }
			
			</script>
			
			
            <input type="submit" name="Submit" value="Consultar" ></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td valign="top">
		  
		  <table width="742" border="0" cellpadding="1" cellspacing="1">
            <tr>
              <td width="78" height="31" bgcolor="#006699"><span class="Estilo7 Estilo15">Fecha</span></td>
              <td width="26" bgcolor="#006699"><span class="Estilo7 Estilo15">T.D.</span></td>
              <td width="80" bgcolor="#006699"><span class="Estilo7 Estilo15">Doc-Ini</span></td>
              <td width="26" bgcolor="#006699"><span class="Estilo7 Estilo15">T.D.</span></td>
              <td width="99" bgcolor="#006699"><span class="Estilo7 Estilo15">Doc-FIn</span></td>
              <td  width="59" bgcolor="#006699"><span class="Estilo7 Estilo15">Cantidad</span></td>
              <td style="display:none" width="57" align="right" bgcolor="#006699"><span class="Estilo7 Estilo15">Importe</span></td>
              <td style="display:none" width="48" align="right" bgcolor="#006699"><span class="Estilo7 Estilo15">IGV</span></td>
              <td style="display:none" width="80" align="right" bgcolor="#006699"><span class="Estilo7 Estilo15">Servicio</span></td>
              <td width="76" align="right" bgcolor="#006699"><span class="Estilo7 Estilo15">Total (S/.)</span></td>
              <td width="79" align="right" bgcolor="#006699"><span class="Estilo7 Estilo15">Total(US$.)</span></td>
            </tr>
			
			
			<?php 

function UltimoDia($anho,$mes){ 
//echo $anho."-".$mes;
   if (((fmod($anho,4)==0) and (fmod($anho,100)!=0)) or (fmod($anho,400)==0)) { 
       $dias_febrero = 29; 
   } else { 
       $dias_febrero = 28; 
   } 
   switch($mes) { 
       case 01: return 31; break; 
       case 02: return $dias_febrero; break; 
       case 03: return 31; break; 
       case 04: return 30; break; 
       case 05: return 31; break; 
       case 06: return 30; break; 
       case 07: return 31; break; 
	   case '08': return 31; break; 
       case '09': return 30; break; 
       case 10: return 31; break; 
       case 11: return 30; break; 
       case 12: return 31; break; 
   } 
  /*
   if($mes=='08'){
   return 31;
   }
   if($mes=='09'){
   return 31; 
   }
   */
} 



//$fecha1=$_REQUEST['fecha1'];
//$fecha2=$_REQUEST['fecha2'];
$anhoo=$_REQUEST['ano'];
$mess=$_REQUEST['mes'];
$cant_dias=UltimoDia($anhoo,$mess);
$serie=$_REQUEST['serie'];
$vendedor=$_REQUEST['vendedor'];

if($serie!="000"){
$filtro=" and serie='$serie' ";
}else{
$filtro="";
}
//echo $cant_dias;
/*
$f=str_pad((substr($fecha1,0,2)+1),2,"0",STR_PAD_LEFT);
$fnueva=$f.substr($fecha1,2,9);
echo $fnueva;
*/


for ( $j = 1 ; $j <= $cant_dias ; $j ++) {
$dia=str_pad($j, 2, "0", STR_PAD_LEFT);
$fecha1=$anhoo."-".$mess."-".$dia;
//-------------------------------------------------------------------------------------------
$strSQL="select substring(fecha,1,10) as fecha,num_doc,serie,cod_cab,cod_ope,o.sunat from cab_mov  inner join operacion o where cod_cab=(select min(cod_cab) from cab_mov where substring(fecha,1,10)='$fecha1' and deuda='S' and cod_vendedor='$vendedor' ".$filtro." and flag!='A' ) or cod_cab=(select max(cod_cab) from cab_mov where substring(fecha,1,10)='$fecha1' and deuda='S' and cod_vendedor='$vendedor' ".$filtro." and flag!='A' ) ";
//echo $strSQL."<br><br/>";
$resultado=mysql_query($strSQL,$cn);
$cont=mysql_num_rows($resultado);
$i=1;
$cod_doc_ini="";
$cod_doc_fin="";

while($row=mysql_fetch_array($resultado)){
	if($i==1){
	$doc_ini_b=$row['serie']."-".$row['num_doc'];
	$cod_doc_ini=$row['cod_ope'];
	}
	if($i==2 or $cont==1){
	$doc_fin_b=$row['serie']."-".$row['num_doc'];
	$cod_doc_fin=$row['cod_ope'];
	}
	$i=$i+1;
	$fecha=$row['fecha'];
	//$td1='BV';
}

mysql_free_result($resultado);

$strSQL2="SELECT count(cod_cab) as cantidad,sum(b_imp) as importe,sum(igv) as igv,sum(servicio) as servicio, sum(total) as total  from cab_mov WHERE substring(fecha,1,10)='$fecha1' and deuda='S' and cod_vendedor='$vendedor' ".$filtro." and flag!='A' and moneda='02' order by fecha";
//echo $strSQL2;
$resultado2=mysql_query($strSQL2,$cn);
$row2=mysql_fetch_array($resultado2);
$cantidad=$row2['cantidad'];
//$importe=$row2['importe'];
//$igv=$row2['igv'];
//$servicio=$row2['servicio'];
$total=$row2['total'];
//echo $total;


$strSQL2="SELECT count(cod_cab) as cantidad,sum(b_imp) as importe,sum(igv) as igv,sum(servicio) as servicio, sum(total) as total  from cab_mov WHERE substring(fecha,1,10)='$fecha1' and deuda='S' and cod_vendedor='$vendedor' ".$filtro." and flag!='A' and moneda='01' order by fecha";
//echo $strSQL2;
$resultado2=mysql_query($strSQL2,$cn);
$row2=mysql_fetch_array($resultado2);
$total_dolares=$row2['total'];

//--------------------------------------------------------------------------------------------------
/*

$strSQL0="select substring(fecha,1,10) as fecha,num_doc,serie from cab_mov where cod_cab=(select min(cod_cab) from cab_mov where substring(fecha,1,10)='$fecha1' and cod_ope='FA' and cod_vendedor='$vendedor' ".$filtro." and flag!='A') or cod_cab=(select max(cod_cab) from cab_mov where substring(fecha,1,10)='$fecha1' and cod_ope='FA' and cod_vendedor='$vendedor' ".$filtro." and flag!='A')";
//echo $strSQL;
$resultado0=mysql_query($strSQL0,$cn);
$cont=mysql_num_rows($resultado0);
$i=1;
while($row0=mysql_fetch_array($resultado0)){
	if($i==1){$doc_ini_f=$row0['serie']."-".$row0['num_doc'];}
	if($i==2 or $cont==1){$doc_fin_f=$row0['serie']."-".$row0['num_doc'];}
	$i=$i+1;
	$fecha0=$row0['fecha'];
	$td2='FA';
}

mysql_free_result($resultado0);

$strSQL20="SELECT count(cod_cab) as cantidad,sum(b_imp) as importe,sum(igv) as igv,sum(servicio) as servicio, sum(total) as total  from cab_mov WHERE substring(fecha,1,10)='$fecha1' and cod_ope='FA' and cod_vendedor='$vendedor' ".$filtro." and flag!='A'";
//echo $strSQL2;
$resultado20=mysql_query($strSQL20,$cn);
$row20=mysql_fetch_array($resultado20);
$cantidad0=$row20['cantidad'];
$importe0=$row20['importe'];
$igv0=$row20['igv'];
$servicio0=$row20['servicio'];
$total0=number_format($row20['total'],2);
mysql_free_result($resultado20);

*/
//select * from cab_mov where tipo='2' and (cod_ope='TB' or cod_ope='TF') and flag!='A' and  substring(fecha,1,10) between '2010-06-01' and '2010-06-31'
?>
			
			
            <tr>
              <td bgcolor="#F9F9F9"><span class="Estilo10"><?php echo $fecha1 ?></span></td>
              <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?php echo $cod_doc_ini ?></span></td>
              <td bgcolor="#F9F9F9"><span class="Estilo10">
                <label for="select"><?php echo $doc_ini_b?></label>
              </span></td>
              <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?php echo $cod_doc_fin ?></span></td>
              <td bgcolor="#F9F9F9"><span class="Estilo10"><?php echo $doc_fin_b?></span></td>
              <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?php echo $cantidad?></span></td>
              <td style="display:none" align="right" bgcolor="#F9F9F9"><span class="Estilo10"><?php echo $importe?></span></td>
              <td style="display:none" align="right" bgcolor="#F9F9F9"><span class="Estilo10"><?php echo $igv?></span></td>
              <td style="display:none" align="right" bgcolor="#F9F9F9"><span class="Estilo10"><?php echo $servicio?></span></td>
              <td align="right" bgcolor="#F9F9F9"><span class="Estilo10"><?php echo number_format($total,2)?></span></td>
              <td align="right" bgcolor="#F9F9F9"><span class="Estilo10"><?php echo number_format($total_dolares,2)?></span></td>
            </tr>
		<?php /*?>	
            <tr>
              <td height="21" bgcolor="#F9F9F9"><span class="Estilo10"><?php echo $fecha1?></span></td>
              <td bgcolor="#F9F9F9"><span class="Estilo10"><?php echo $td2?></span></td>
              <td bgcolor="#F9F9F9"><span class="Estilo10">
                <label for="select"><?php echo $doc_ini_f?></label>
              </span></td>
              <td bgcolor="#F9F9F9"><span class="Estilo10"><?php echo $doc_fin_f?></span></td>
              <td align="center" bgcolor="#F9F9F9"><span class="Estilo10"><?php echo $cantidad0?></span></td>
              <td align="right" bgcolor="#F9F9F9"><span class="Estilo10"><?php echo $importe0?></span></td>
              <td align="right" bgcolor="#F9F9F9"><span class="Estilo10"><?php echo $igv0?></span></td>
              <td align="right" bgcolor="#F9F9F9"><span class="Estilo10"><?php echo $servicio0?></span></td>
              <td align="right" bgcolor="#F9F9F9"><span class="Estilo10"><?php echo $total0?></span></td>
              </tr><?php */?>
          
		  	<?php 
			$cantidad_tot=$cantidad_tot+$cantidad+$cantidad0;
			$importe_tot=$importe_tot+$importe0+$importe0;
			$igv_tot=$igv_tot+$igv+$igv0;
			$servicio_total=$servicio_total+$servicio+$servicio0;
			$total_tot=$total_tot+$total;
			$total_tot2=$total_tot2+$total_dolares;
			
			
			$td1="";
			$doc_ini_b="";
			$doc_fin_b="";
			$cantidad="";
			$importe="";
			$igv="";
			$servicio="";
			$total="";
			
			$td2="";
			$doc_ini_f="";
			$doc_fin_f="";
			$cantidad0="";
			$importe0="";
			$igv0="";
			$servicio0="";
			$total0="";
			
			
			}
			?>
			
		    <tr>
		      <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
		      <td bgcolor="#F9F9F9">&nbsp;</td>
		      <td colspan="2" bgcolor="#F9F9F9">&nbsp;</td>
		      <td bgcolor="#F9F9F9">&nbsp;</td>
		      <td align="center" bgcolor="#F9F9F9">&nbsp;</td>
		      <td style="display:none" align="right" bgcolor="#F9F9F9">&nbsp;</td>
		      <td style="display:none" align="right" bgcolor="#F9F9F9">&nbsp;</td>
		      <td style="display:none" align="right" bgcolor="#F9F9F9">&nbsp;</td>
		      <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
		      <td align="right" bgcolor="#F9F9F9">&nbsp;</td>
		    </tr>
		    <tr>
              <td height="21" bgcolor="#F9F9F9">&nbsp;</td>
              <td bgcolor="#F9F9F9">&nbsp;</td>
              <td colspan="2" bgcolor="#F9F9F9">&nbsp;</td>
              <td bgcolor="#F9F9F9"><span class="Estilo7">Total General</span> </td>
              <td align="center" bgcolor="#F9F9F9"><span class="Estilo7"><?php echo $cantidad_tot?></span></td>
              <td style="display:none" align="right" bgcolor="#F9F9F9"><span class="Estilo7"><?php echo number_format($importe_tot,2)?></span></td>
              <td  style="display:none" align="right" bgcolor="#F9F9F9"><span class="Estilo7"><?php echo number_format($igv_tot,2)?></span></td>
              <td style="display:none" align="right" bgcolor="#F9F9F9"><span class="Estilo7"><?php echo number_format($servicio_total,2)?></span></td>
              <td align="right" bgcolor="#F9F9F9"><span class="Estilo7"><?php echo number_format($total_tot,2)?></span></td>
              <td align="right" bgcolor="#F9F9F9"><span class="Estilo7"><?php echo number_format($total_tot2,2)?></span></td>
		    </tr>
          </table></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      </form>
    </td>
  </tr>
</table>



</body>
</html>
