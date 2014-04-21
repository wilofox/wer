<?php session_start();
		include('../conex_inicial.php');
		include('../funciones/funciones.php');
		

$id=$_REQUEST['id'];
//$tipocosto=$_REQUEST['tipocosto'];
$moneda=$_REQUEST['rbMoneda'];
$costo=$_REQUEST['costo'];
$cantidad=$_REQUEST['cantidad'];
$costoparcial=$_REQUEST['costoparcial'];
$nivel=$_REQUEST['nivel'];
$tipoCosto=$_REQUEST['rbTipoCosto'];

//print_r($tipoCosto);
//echo "-->".$tipoCosto;
//print_r($costo);

$chkProcesos=$_REQUEST['chkProcesos'];

		if($_REQUEST['accion']=='delete'){
		$strSQLDEL="delete from costopexpresu where id='".$_REQUEST['idActxpre']."' ";
		mysql_query($strSQLDEL);
		}
		
		if($_REQUEST['accion']=='save'){
			
			for($i=0; $i<count($id);$i++){
			
			
			//if($nivel[$i]=='1'){
			//$dias=$_REQUEST['viaticos1'];
			//$trabajadores=$_REQUEST['trabajadores1'];
			
			//}
			//if($nivel[$i]=='2'){
			$dias=$_REQUEST['ndias'];
			$trabajadores=$_REQUEST['ntrabajadores'];
			$despacho=$_REQUEST['despacho'];
			
			//echo "$dias $trabajadores";
			//}
			
				$strSQL="update costopexpresu set tipocosto='".$tipocosto[$i]."',moneda='".$moneda[$i]."',costo='".$costo[$i]."',cantidad='".$cantidad[$i]."',costoparcial='".$costoparcial[$i]."',dias='".$dias."',trabajadores='".$trabajadores."',despacho='".$despacho."' where id='".$id[$i]."' ";
				mysql_query($strSQL,$cn);
						
			}
			
		}
		
		if($_REQUEST['accion']=='insertCostos'){
			$codcabPre=$_REQUEST['codcabPre'];
			for($i=0; $i<count($chkProcesos);$i++){
			
				$strSQL="select * from costoperativo where id='".$chkProcesos[$i]."'";
				$resultado=mysql_query($strSQL,$cn);
				$row=mysql_fetch_array($resultado);
				
				$strSQLInsert="insert into costopexpresu(codpresup,costoope,tipocosto,moneda,costo,cantidad,costoparcial,nivel) values('".$codcabPre."','".$row['id']."','".$tipoCosto."','".$moneda."','".$row['costo1']."','1','".$row['costo1']."','".$row['nivel']."')";
				mysql_query($strSQLInsert,$cn);
				
				//echo $strSQLInsert;	
			}
		header("location: cOperxPresup.php?CodDoc=".$_REQUEST['codcabPre']." ");
		}
		
		
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Costos Operativos</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
	color: #0066FF;
}
.Estilo2 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 11px;
}
.Estilo12 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #464646; }
-->
</style>

<link href="../styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo13 {
	color: #333333;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.Estilo14 {
	font-size: 11px;
	color: #333333;
}
.Estilo17 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #333333;
}
.Estilo18 {color: #0066CC}
.Estilo29 {color: #FFFFFF; font-weight: bold; font-family: Tahoma, Arial; font-size: 11px; }
.Estilo30 {color: #000000}
.Estilo31 {color: #FF0000}
.Estilo32 {color: #0033CC}
-->
</style>
<style type="text/css" media="print" >
.noprint{
visibility:hidden;
}
.noprint2{
background: transparent; 
border:0px
}
</style>
<script language="javascript">
function printer() 
{ 
vbPrintPage(); 
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
<style type="text/css">
<!--
.Estilo33 {color: #0066FF}
.Estilo34 {font-size: 10px}
-->
</style>
</head>

<?php 


$referencia=$_REQUEST['CodDoc'];
$strsql="select * from cab_mov where cod_cab='$referencia'";
$resultado=mysql_query($strsql,$cn);
$cont=mysql_num_rows($resultado);
$row=mysql_fetch_array($resultado);
//echo $strsql;

$noperacion=$row['noperacion'];
$numero=$row['Num_doc'];
$serie=$row['serie'];
$flag=$row['flag'];

//echo $numero;
$ruc=$row['ruc'];
$cliente=$row['cliente'];
$fecha=$row['fecha'];
$cod_ope=$row['cod_ope'];
$codsucursal=$row['sucursal'];
$codtienda=$row['tienda'];
$cod_vendedor=$row['cod_vendedor'];
$tipo_cambio=$row['tc'];
$moneda=$row['moneda'];
$fecha_aud=$row['fecha_aud'];
$nom_pc=$row['pc'];
$inafecto=$row['inafecto'];
$incluidoigv=$row['incluidoigv'];
$b_imp=$row['b_imp'];
$igv=$row['igv'];
$impto=$row['impto1'];


$resultado33=mysql_query("select tipocosto,moneda from costopexpresu where codpresup='".$referencia."' order by nivel");
$contPres=mysql_num_rows($resultado33);

list($tcostop,$monedacos,$dias,$trabajadores,$despacho)=mysql_fetch_array(mysql_query("select tipocosto,moneda,dias,trabajadores,despacho from costopexpresu where codpresup='".$referencia."' order by nivel"));

 if($tcostop=='2'){
 $tempTipoCosto="PROVINCIA";
 $tipoCostoProvincia='checked'; 
 }else{
 $tempTipoCosto="LIMA";
 $tipoCostoLima='checked';
 } 
 if($contPres>0){
 $disabled="disabled";
 }
 
 if($monedacos=='02'){
 $tempMonedaCosto="DOLARES (US$.)";
 $monedaDolares='checked'; 
 }else{
 $tempMonedaCosto="SOLES (S/.)";
 $monedaSoles='checked';
 }   
 

?>

<script src="../jquery-1.2.6.js"></script>
<script src="../jquery.hotkeys.js"></script>

<link rel="stylesheet" type="text/css" href="../administracion/estilos.css" media="all" />
<script language="javascript" type="text/javascript" src="../administracion/csspopup2.js"></script>
	
<body onLoad="calcularMonTotal();">
<form name="form1" method="post" action="">
 <div id="capaPopUp" style="z-index:1;filter:alpha(opacity=40);-moz-opacity:.60;opacity:.60"></div>
     <div id="popUpDiv"><!--id="popUpDiv"-->
        <div id="capaContent">

<table width="400" height="200" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
	
	<table width="398">
      <tr style="background-image:url(../imagenes/title.png); background-position:100% 40%;">
        <td height="23" colspan="3" style="font:Arial, Helvetica, sans-serif; color:#CC6600; font-size:12px"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="310"><span class="Estilo13"><strong>&nbsp;COSTOS OPERATIVOS</strong></span></td>
            <td width="78" align="right"><table width="29" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td  align="right"><img id="cerrar2" onClick="javascript:void(0)" style="cursor:pointer" src="../imagenes/cerrar.jpg" width="23" height="21"></td>
          </tr>
		  
</table>

</td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td width="11" height="133">&nbsp;</td>
        <td width="354" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#003366" valign="top">
		
		<div style="height:250px; overflow-y:scroll">
		  <table width="354" border="0" cellpadding="1" cellspacing="1">
            <tr  >
              <td height="29" colspan="4" align="left" class="Estilo13"><table width="336" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="169"><strong><span class="Estilo32"><span class="Estilo33">Tipo Costo:</span>
                          <label> </label>
                    </span>
                        <label> &nbsp;</label>
                    </strong> </td>
                    <td width="167"><strong>
                      <label></label>
                      <span class="Estilo32"><span class="Estilo33">Moneda:</span>
                      <label> </label>
                      </span>
                      <label> &nbsp;</label>
</strong> </td>
                  </tr>
                  <tr>
                    <td><strong>
                      <label>
                      <input <?php echo $tipoCostoLima ?> style="background:none; border:none" name="rbTipoCosto" id="rbTipoCosto" type="radio" value="1" <?php echo $disabled ?>>
                      </label>
                      <span class="Estilo34">Lima</span>
                      <input <?php echo $tipoCostoProvincia ?> style="background:none; border:none" name="rbTipoCosto" id="rbTipoCosto" type="radio" value="2" <?php echo $disabled ?>>
                      <span class="Estilo34">Provincia</span></strong></td>
                    <td><strong>
                      <label>
                      <input <?php echo $tipoCostoLima ?> style="background:none; border:none" name="rbMoneda" id="rbMoneda" type="radio" value="01" <?php echo $disabled ?>>
                      </label>
                      <span class="Estilo34">Soles</span>
                      <input <?php echo $tipoCostoProvincia ?> style="background:none; border:none" name="rbMoneda" id="rbMoneda" type="radio" value="02" <?php echo $disabled ?>>
                      <span class="Estilo34">Dolares</span></strong></td>
                  </tr>
                </table></td>
              </tr>
            <tr  >
              <td height="20" colspan="4" align="left" class="Estilo13">&nbsp;</td>
            </tr>
            <tr  style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
              <td width="31" height="23" align="center" class="Estilo13">&nbsp;</td>
              <td width="52" align="center" class="Estilo13"><strong>id</strong></td>
              <td width="109" align="center" class="Estilo13"><strong>Nombre</strong></td>
              <td width="149" align="center" class="Estilo13"><strong>descripci&oacute;n</strong></td>
            </tr>
            <?php 
		  $strSQLProc="select co.id,co.nombre,co.descripcion from costoperativo co order by co.id";
		  $resultadoProc=mysql_query($strSQLProc,$cn);
		  //echo $strSQLProc;
		  while($rowProc=mysql_fetch_array($resultadoProc)){
		  ?>
            <tr>
              <td align="center" bgcolor="#F8F8F8"><input id="chkProcesos" style="border:none; background:none" type="checkbox" name="chkProcesos[]" value="<?php echo $rowProc['id']?>"></td>
              <td align="center" bgcolor="#F8F8F8" class="Estilo12"><?php echo $rowProc['id']?></td>
              <td bgcolor="#F8F8F8" class="Estilo12"><?php echo $rowProc['nombre']?></td>
              <td bgcolor="#F8F8F8" class="Estilo12"><?php echo $rowProc['descripcion']?></td>
            </tr>
            <?php }?>
          </table>
		</div>
		
		</td>
        <td width="17">&nbsp;</td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center"><input onClick="javascript:void(0);" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(../imagenes/boton_aplicar.gif) ; cursor:pointer" type="button" name="aplicarform" value="Aplicar"  id="anular" >
		
		&nbsp;&nbsp;&nbsp;
		
		<input onClick="javascript:void(0);" onMouseOver="cambiar_fondo(this,'e')" onMouseOut="cambiar_fondo(this,'s')" style="border:none; height:18px; width:96px; vertical-align:top;background-image:url(../imagenes/boton_aplicar.gif) ; cursor:pointer" type="button" name="cerrarform" value="Cancelar"  id="cerrar" >	</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</div>
</div>
</div>
  <table width="625" height="294" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="5" height="31" bgcolor="#E6E6E6">&nbsp;</td>
      <td colspan="2" align="center" bgcolor="#E6E6E6"><span class="Estilo1">Costos Operativos de Presupuesto 
        <input type="hidden" name="codcabPre" value="<?php echo  $_REQUEST['CodDoc'] ?>">
      </span></td>
      <td width="9" bgcolor="#E6E6E6">&nbsp;</td>
    </tr>
    <tr>
      <td height="71">&nbsp;</td>
      <td colspan="2" align="right"><fieldset>
        <table width="536" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="82" ><span class="Estilo13">Presup. N&ordm; : </span></td>
            <td width="246" ><span class="Estilo17"><?php echo $serie."-".$numero ?></span></td>
            <td width="208" class="Estilo13">Moneda:
              <?php 
			if($moneda=='01')echo $simMon="S/."; else echo $simMon="US$.";
			
			 ?>
                <input name="monedadoc" type="hidden" size="3" maxlength="5" value="<?php echo $moneda?>"></td>
          </tr>
          <tr>
            <td ><span class="text7 Estilo14">Cliente:</span></td>
            <td  class="Estilo17">
			<?php
			
			  $SQLClie="select * from cliente where codcliente='".$cliente."' " ;
			  $resultadoClie=mysql_query($SQLClie,$cn);
			  $rowClie=mysql_fetch_array($resultadoClie);
			  echo  $rowClie['razonsocial'];
			
			?>			</td>
            <td><span class="Estilo13">Tipo de Cambio</span>
            <input name="tcdoc" type="text" size="8" maxlength="8"  value="<?php echo $tipo_cambio?>" class="noprint2"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input name="accion" type="hidden" size="5" maxlength="5" value=""></td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </fieldset>	   </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
      <td width="160" height="19"  style="text-decoration:underline"><span class="Estilo2"><span class="Estilo18">COSTOS OPERATIVOS </span> 
          <input name="idActxpre" type="hidden" size="5" maxlength="5" value="" >
      </span></td>
      <td width="451" align="right"><input id="abrirPop" type="button" name="Submit2" value="Insertar Costos" onClick="javascript:void(0)" class="noprint"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="26">&nbsp;</td>
      <td height="26" bgcolor="#EBEBEB"><span class="Estilo30">Tipo de Costo :&nbsp;</span>
	    <span class="Estilo30"><strong>
	    <?php 
	     
	 echo $tempTipoCosto;
	  ?></strong></span>
	  <input name="inputTipoC" id="inputTipoC" type="hidden" value="<?php echo $tcostop?>">	  </td>
      <td height="26" bgcolor="#EBEBEB"><span class="Estilo30">Moneda:</span>
&nbsp;	    <span class="Estilo30"><strong>
	  <?php 
	    echo $tempMonedaCosto;
	  ?>
	    <input type="hidden" name="monedacosto" id="monedacosto" value="<?php echo $monedacos?>">
</strong></span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="26">&nbsp;</td>
      <td height="26" colspan="2" bgcolor="#EBEBEB"><span class="Estilo30">Nro. Dias: 
          <input name="ndias" id="ndias" type="text" size="10" maxlength="10" onKeyUp="calularParcial2(1,this)" value="<?php echo $dias?>">
      &nbsp;&nbsp;&nbsp;&nbsp;Nro. trabajadores: 
        <input name="ntrabajadores" id="ntrabajadores" type="text" size="10" maxlength="10" onKeyUp="calularParcial2(1,this);calularParcial2(2,this)" value="<?php echo $trabajadores?>" >
		
</span> <span class="Estilo30">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="Estilo30">Despacho :
<input name="despacho" id="despacho" type="text" size="10" maxlength="10" onKeyUp="calularParcial2(3,this)" value="<?php echo $despacho ?>">
</span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="45">&nbsp;</td>
      <td colspan="2">
	  <table id="tblCostos" width="610" border="0" cellpadding="0" cellspacing="1">
          <tr style="background:url(../imagenes/bg_contentbase4.gif) 100%">
            <td width="18">&nbsp;</td>
            <td width="254" height="23"><span class="Estilo29">Proceso</span></td>
            <td width="17" align="center">&nbsp;</td>
            <td width="17" align="center">&nbsp;</td>
            <td width="61" align="center"><span class="Estilo29">cantidad</span></td>
            <td width="60" align="center"><span class="Estilo29">costo</span></td>
            <td width="110" align="center"><span class="Estilo29">costo parcial</span></td>
            <td width="61" align="center"><span class="Estilo29">Accion</span></td>
          </tr>
          <?php
	  
	  $SQLActvPres="select * from costopexpresu where codpresup='".$referencia."' order by nivel" ;
	  $resultadoActvPres=mysql_query($SQLActvPres,$cn);
	  $nivelAgr="";
	  while($rowActvPres=mysql_fetch_array($resultadoActvPres)){
	  //echo $rowActvPres['nivel']; 
	  $dias=$rowActvPres['dias'];
	  $trabajadores=$rowActvPres['trabajadores'];
	  //echo $dias;
	  if($rowActvPres['nivel']!=$nivelAgr){
	  
	    if($rowActvPres['nivel']=='1'){
	     echo  "<tr><td colspan='8'  height='10px' style='color=#000000' bgcolor='#FCF0A0'><strong>VIATICOS</strong></td>
		
		</tr>";
		}
		if($rowActvPres['nivel']=='2'){
	   echo  "<tr><td colspan='8'  height='10px' style='color=#000000' bgcolor='#FCF0A0'><strong>DESPLIEGUE DEL PERSONAL</strong></td>
		
		</tr>";
		}
		if($rowActvPres['nivel']=='3'){
	    echo  "<tr><td colspan='8'  height='10px' style='color=#000000' bgcolor='#FCF0A0'><strong>DESPLIEGUE DE RECURSOS</strong></td>";
		}
		/*
		if($rowActvPres['nivel']=='1'){
	     echo  "<tr><td colspan='2'  height='10px' style='color=#000000' bgcolor='#FCF0A0'><strong>VIATICOS</strong></td>
		<td colspan='6' bgcolor='#FCF0A0'>Nro. Dias: <input name='viaticos1' id='viaticos1'  type='text' size='2' style='text-align:center;border:none; background:none; border-bottom:#0066FF solid 1px' maxlength='3' onKeyUp='calularParcial2(1)' value='$dias' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Nro. Trabajadores: <input onKeyUp='calularParcial2(1)' value='$trabajadores' name='trabajadores1' id='trabajadores1'  type='text' size='2'  style='text-align:center;border:none; background:none; border-bottom:#0066FF solid 1px' maxlength='3'> </td>
		</tr>";
		}
		if($rowActvPres['nivel']=='2'){
	   echo  "<tr><td colspan='2'  height='10px' style='color=#000000' bgcolor='#FCF0A0'><strong>TRANSPORTE</strong></td>
		<td colspan='6' bgcolor='#FCF0A0'>Nro. Dias: <input value='$dias' onKeyUp='calularParcial2(2)' name='viaticos2' id='viaticos2'  type='text' size='2' style='text-align:center;border:none; background:none; border-bottom:#0066FF solid 1px' maxlength='3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Nro. Trabajadores: <input value='$trabajadores' onKeyUp='calularParcial2(2)' name='trabajadores2' id='trabajadores2'  type='text' size='2'  style='text-align:center;border:none; background:none; border-bottom:#0066FF solid 1px' maxlength='3'> </td>
		</tr>";
		}
		if($rowActvPres['nivel']=='3'){
	    echo  "<tr><td colspan='8'  height='10px' style='color=#000000' bgcolor='#FCF0A0'><strong>OTROS</strong></td>";
		}
		*/
	  }
	  $nivelAgr=$rowActvPres['nivel'];
	  ?>
          <tr>
            <td bgcolor="#F5F5F5" ><input  style="text-align:right"  type="hidden" value="<?php echo $rowActvPres['nivel']?>" size="5" id="nivel" name="nivel[]"  class="noprint2"></td>
            <td height="20" bgcolor="#F5F5F5"><span class="Estilo12"><?php
			
			 $SQLCC="select * from costoperativo where id='".$rowActvPres['costoope']."' " ;
			  $resultadoCC=mysql_query($SQLCC,$cn);
			  $rowCC=mysql_fetch_array($resultadoCC);
			  	
				echo $rowCC['nombre'];
			 //echo 
			 
			 ?></span></td>
            <td align="center" bgcolor="#F5F5F5">
            <?php /*?>  <select name="tipocosto[]" id="tipocosto" class="noprint2">
			 
		           
				<?php 
			  if($rowActvPres['tipocosto']=='1'){
			  echo "<option value='1' selected='selected'>Propio</option>
			  <option value='2'>Subcontrata</option>";
			  }else{
			   echo "<option value='1' >Propio</option>
			  <option value='2' selected='selected'>Subcontrata</option>";
			  
			  }
			 
			  ?> 
		      </select>	<?php */?>			  </td>
            <td align="center" bgcolor="#F5F5F5">
             <?php /*?> <select name="moneda[]" id="moneda" onChange="calularParcial(this);" class="noprint2">
    				
				 <?php 
			  if($rowActvPres['moneda']=='01'){
			  echo "<option value='01' selected='selected'>S/.</option>
			  <option value='02'>US$.</option>";
			  }else{
			   echo "<option value='01' >S/.</option>
			  <option value='02' selected='selected'>US$.</option>";
			  
			  }
			 
			  ?>
              </select>	<?php */?>	    </td>
            <td align="right" bgcolor="#F5F5F5"><input  style="text-align:right"  type="text" value="<?php echo $rowActvPres['cantidad']?>" size="5" id="cantidad" name="cantidad[]" onKeyUp="calularParcial(this)" class="noprint2"></td>
            <td align="right" bgcolor="#F5F5F5"><input style="text-align:right"  onKeyUp="calularParcial(this)" type="text" value="<?php echo $rowActvPres['costo']?>" size="5" id="costo" name="costo[]" class="noprint2"></td>
            <td align="right" bgcolor="#F5F5F5"><input style="text-align:right"  type="text" value="<?php echo $rowActvPres['costoparcial']?>" size="5" id="costoparcial" name="costoparcial[]" class="noprint2">            </td>
            <td align="center" bgcolor="#F5F5F5"><img onClick="eliminar('<?php echo $rowActvPres['id'] ?>')" style="cursor:pointer"  src="../imgenes/eliminar.png" width="16" height="16" border="0" />
            <input name="id[]" id="id" type="hidden" size="5" maxlength="5" value="<?php echo $rowActvPres['id'] ?>"></td>
          </tr>
          <?php }?>
      </table></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
      <td colspan="2" align="right"><table width="383" border="0">
          <tr>
            <td align="center">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="200" align="right"><span class="Estilo2 Estilo31">Total Costos </span></td>
            <td width="116" align="right"><span class="Estilo2">
              <span class="Estilo30">
              <?php  echo $simMon; ?>
              </span></span>
              <span class="Estilo30">
              <input readonly="" style="text-align:right; "  name="totalCostos" type="text" size="10" maxlength="10" class="noprint2"  >
            </span>			</td>
            <td width="53">&nbsp;</td>
          </tr>
      </table></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
      <td colspan="2" align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
      <td colspan="2" align="center"><input type="button" name="Submit" value="      Guardar      " onClick="guardar()" class="noprint" style="">
        <label>
        <input type="button" name="Submit3" value="Imprimir" onClick="printer()" class="noprint">
      </label></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>
</body>
</html>

<script>

function calularParcial2(nivel,control){

	if(control.value==''){
	control.value=0;
	}
	if(nivel==3){
	//control.value=parseFloat(control.value)+1;
	}
	
	for (var i=1;i<document.getElementById('tblCostos').rows.length;i++) {
	temp=document.getElementById('tblCostos').rows[i].cells[0].childNodes[0].value;
//	alert(nivel+""+temp);
	
		if(nivel==temp){
		calularParcial(document.getElementById('tblCostos').rows[i].childNodes[0].childNodes[0]);
		}
	}
}

function calularParcial(obj){
moneda=document.form1.monedacosto.value;
var costo=parseFloat(obj.parentNode.parentNode.cells[4].childNodes[0].value);
var cantidad=parseFloat(obj.parentNode.parentNode.cells[5].childNodes[0].value);
var tcDoc=parseFloat(document.form1.tcdoc.value);
//alert(moneda);
//obj.parentNode.parentNode.cells[6].childNodes[0].value=parseFloat(cantidad*costo).toFixed(2);
var nivel=parseFloat(obj.parentNode.parentNode.cells[0].childNodes[0].value);
var dias=1;
var trabajadores=1
var despacho=1;
if(nivel==1){
dias=parseFloat(document.form1.ndias.value);
trabajadores=parseFloat(document.form1.ntrabajadores.value);
}
if(nivel==2){
//dias=1;
trabajadores=parseFloat(document.form1.ntrabajadores.value);
}
if(nivel==3){
//dias=1;
despacho=parseFloat(document.form1.despacho.value)+1;
}
//alert(trabajadores+" "+dias);

	if(moneda=='02'){
	obj.parentNode.parentNode.cells[6].childNodes[0].value=(cantidad*costo*tcDoc*dias*trabajadores*despacho).toFixed(2);	
	}else{
	obj.parentNode.parentNode.cells[6].childNodes[0].value=(cantidad*costo*dias*trabajadores*despacho).toFixed(2);
	}
	
calcularMonTotal();

}

function calcularMonTotal(){

var monedaDoc=document.form1.monedadoc.value;
var tcDoc=parseFloat(document.form1.tcdoc.value);
var moneda;
var totalGeneral=0;

	for (var i=1;i<document.getElementById('tblCostos').rows.length;i++) {
		
		if(document.getElementById('tblCostos').rows[i].cells.length ==8){
			//moneda=document.getElementById('tblCostos').rows[i].cells[3].childNodes[0].value;
			moneda=document.form1.monedacosto.value;
			cparcial=parseFloat(document.getElementById('tblCostos').rows[i].cells[6].childNodes[0].value);
			
			totalGeneral=totalGeneral + cparcial;
		
	/*	if(document.getElementById('tblCostos').rows[i].cells.length ==8){
		
		moneda=document.getElementById('tblCostos').rows[i].cells[3].childNodes[0].value;
		cparcial=parseFloat(document.getElementById('tblCostos').rows[i].cells[6].childNodes[0].value);
		
			if(monedaDoc==moneda){
				totalGeneral=parseFloat(totalGeneral) + parseFloat(cparcial);	
			}else{
			
				if(moneda=='01'){
				totalGeneral=parseFloat(totalGeneral) + parseFloat(cparcial/tcDoc);
				}else{
				totalGeneral=parseFloat(totalGeneral) + parseFloat(cparcial*tcDoc);
				}
					
			}
			//alert(totalGeneral);
		}*/	
		}
	}
	document.form1.totalCostos.value=parseFloat(totalGeneral).toFixed(2);

}

function ltrim(str, filter){
  filter || ( filter = '\\s|\\&nbsp;' );
  var pattern = new RegExp('^(' + filter + ')*', 'g');
  return str.replace(pattern, "");
}
function rtrim(str, filter){
  filter || ( filter = '\\s|\\&nbsp;' );
  var pattern = new RegExp('(' + filter + ')*$', 'g');
  return str.replace(pattern, "");
}
function trim(str, filter){
  filter || ( filter = '\\s|\\&nbsp;' );
  return ltrim(rtrim(str, filter), filter);
}


function eliminar(cod){
	document.form1.accion.value='delete';
	document.form1.idActxpre.value=cod;
	
	document.form1.submit();
}
function guardar(){
	document.form1.accion.value='save';
	document.form1.submit();
}

function cambiar_fondo(control,evento){

	if(evento=='e')
	control.style.backgroundImage='url(../imagenes/boton_aplicar2.gif)';
	else
	control.style.backgroundImage='url(../imagenes/boton_aplicar.gif)';

}
function cerrar_capa(){
	document.form1.accion.value='insertCostos';
	document.form1.submit();
}

function ocultar_combos(){	
	for(var i=0;i<document.form1.elements.length;i++){
	//alert(document.formulario.elements[i].type);
	 	if(document.form1.elements[i].type=="select-one"){
		 document.form1.elements[i].style.visibility="hidden";
		}
	}
}
function mostrar_combos(){	
	for(var i=0;i<document.form1.elements.length;i++){
	//alert(document.formulario.elements[i].type);
	 	if(document.form1.elements[i].type=="select-one"){
		 document.form1.elements[i].style.visibility="visible";
		}
	}
}

</script>
