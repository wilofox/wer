<?php 
include('../conex_inicial.php');
include('../funciones/funciones.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documentos Pendientes de Cancelacion</title>
<link href="styles.css" rel="stylesheet" type="text/css">

<script language="javascript" src="miAJAXlib2.js"></script>

    <script src="jquery-1.2.6.js"></script>
    <script src="jquery.hotkeys.js"></script>
	<script src="mootools-comprimido-1.11.js"></script>

<style type="text/css">
<!--
body {
	background-color:#F3F3F3;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo11 {font-family: Verdana, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FFFFFF; }
.Estilo13 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #000000; }
-->
.Estilo18 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold color:#FFFFFF; }
.Estilo_det {font-family: Arial, Helvetica, sans-serif; font-size: 10px; color:#000000; }
</style></head>

<body  onLoad="javascript:document.form1.doc.focus()" >
<form name="form1" id="form1" method="post" action="">
  <table width="602" height="293" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="4" height="52">&nbsp;</td>
      <td width="570"><table width="474" height="50" border="0" cellpadding="0" cellspacing="0" style="border:#999999 solid 1px">
          <tr>
            <td width="472" align="center"><table width="594" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="167" height="23"><span class="Estilo13">Tipo de Documento </span></td>
                  <td width="162"><span class="Estilo13">Documento
                    
                      <input type="hidden" name="sucursal" value="<?php echo $_REQUEST['sucursal']?>">
                  </span></td>
                  <td width="110"><span class="Estilo13">
                    <input name="cod_ref" type="hidden" value="" size="21">
                    <input name="cod_cli_ref" type="hidden" value="" size="8">
                    <input name="des_cli_ref" type="hidden" value="" size="8">
                    <input name="items" type="hidden" value="" size="8">
                    <input id="mone_origen" type="hidden" value="<?php echo $_REQUEST['moneda'];?>" size="8">
                    Monto Disponible
                  </span></td>
                  <td width="73" align="center"><span style="color:#F00;" class="Estilo13">
                    T.C.
                  </span></td>
                  <td width="82" align="center"><span style="color:#F00" class="Estilo13">Valorizado en: </span></td>
                </tr>
                <tr>
                  <td><select style="width:160; font-size:8px" name="doc"  >
                      <?php 
					  	if(isset($_REQUEST['caja'])){
							$dis=" disabled=false ";
						}else{
							$dis=" disabled=true ";
						}
					  $tipomov=$_REQUEST['tipomov'];
		   $resultados10 = mysql_query("select * from operacion where tipo='$tipomov' and SUBSTR(p1,5,1)='S' and codigo!='TB' and codigo!='TF' and codigo!='TS'  order by descripcion ",$cn); 
			while($row10=mysql_fetch_array($resultados10))
			{
			
		  ?>
                      <option value="<?php echo $row10['codigo']?>"><?php echo $row10['descripcion']?></option>
                      <?php }?>
                  </select></td>
                  <td><input style="font-size:8px" name="serie" type="text" size="5" maxlength="3" onKeyUp="generar_ceros(event,3,'serie')">                    <input style="font-size:8px" autocomplete='off' name="numero" type="text" size="20" maxlength="7" onKeyUp="doc_pagos(event)"></td>
                  <td align="center" style="font-size:11px"><?php echo $_REQUEST['moneda'];?><input disabled style="font-size:11px; text-align:right" maxlength="10" size="10" type="text" name="tot_disp" id="tot_disp" value="<?php echo $_REQUEST['monto'];?>"></td>
                  <td align="center"><input onKeyUp="Recalcular(this,'tc',event)" style="font-size:11px" maxlength="5" size="5" type="text" name="tc" id="tc" value="<?php echo $_SESSION['tc'];?>"></td>
                  <td align="center" style="font-size:11px"><?php if($_REQUEST['moneda']=="S/. "){echo "US$.";$valorizaen=$_REQUEST['monto']/$_SESSION['tc'];}else{echo "S/.";$valorizaen=$_REQUEST['monto']*$_SESSION['tc'];}?><input style="font-size:11px; text-align:right" disabled maxlength="10" size="10" type="text" name="valorizaen" id="valorizaen" value="<?php echo number_format($valorizaen,2);?>"></td>
                </tr>
            </table></td>
          </tr>
      </table></td>
      <td width="24">&nbsp;</td>
    </tr>
    <tr>
      <td height="207">&nbsp;</td>
      <td valign="top" style="border:#999999 solid 1px">
	  
	  <div id='det_doc' style="height:198; overflow:auto">
	  
	  <table width="593" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td width="22" bgcolor="#008A8A"><span class="Estilo11">ok</span></td>
            <td width="90" bgcolor="#008A8A"><span class="Estilo11">Tienda</span></td>
            <td width="20" height="18" bgcolor="#008A8A"><span class="Estilo11">Td</span></td>
            <td width="71" bgcolor="#008A8A"><span class="Estilo11">Documento</span></td>
            <td width="60" bgcolor="#008A8A"><span class="Estilo11">Fec.doc.</span></td>
            <td width="66" bgcolor="#008A8A"><span class="Estilo11">Fec.venc.</span></td>
            <td width="36" bgcolor="#008A8A"><span class="Estilo11">Mon.</span></td>
            <td width="70" bgcolor="#008A8A"><span class="Estilo11">Monto Total</span></td>
            <td width="59" bgcolor="#008A8A"><span class="Estilo11">A Cta.</span></td>
            <td width="68" bgcolor="#008A8A"><span class="Estilo11">Saldo</span></td>
          </tr>
          <?php
		  $cliente=$_REQUEST['auxiliar'];
		  $consulta="SELECT concat(ca.tienda,'-',ti.des_tienda) as tienda, ca.cod_cab AS cab, ca.cod_ope AS td, CONCAT(ca.serie,'-',ca.num_doc) AS documento, ca.fecha AS fec_doc, ca.f_venc AS fec_vcto, if(ca.saldo<ca.total,ca.saldo,ca.total) AS mtotal, ca.saldo AS msaldo FROM cab_mov ca INNER JOIN tienda ti on ti.cod_tienda =ca.tienda INNER JOIN operacion ope ON ope.codigo=ca.cod_ope WHERE saldo>0.00 AND SUBSTR(ope.p1,5,1)='S' and codigo!='TB' and codigo!='TF' and codigo!='TS' and cliente='".$cliente."'"; //AND cliente='002719'
			$result=mysql_query($consulta,$cn);
			$pos=0;
			$total_deuda=0;
			while($row2=mysql_fetch_array($result)){
		?>
		  <tr>
            <td><span class="Estilo11"><input type="checkbox"<?php //echo $dis; ?>value="<?php echo $row2['cab']; ?>" name="chkok" id="chkok" onClick="cargar_docsd(this.value)"></span></td>
            <td><span class="Estilo_det"><?php echo $row2['tienda'];?></span></td>
            <td><span class="Estilo_det"><?php echo $row2['td']; ?></span></td>
            <td><span class="Estilo_det"><?php echo $row2['documento']; ?></span></td>
            <td><span class="Estilo_det"><?php echo extraefecha($row2['fec_doc']); ?></span></td>
            <td><span class="Estilo_det"><?php echo extraefecha($row2['fec_vcto']); ?></span></td>
            <td align="center"><span class="Estilo_det"><?php if($row2['moneda']=='01'){echo "S/.";}else{echo "US$.";} ?></span></td>
            <td align="right"><span class="Estilo_det"><?php echo number_format($row2['mtotal'],2,".",""); ?></span></td>
            <td><span class="Estilo_det"><input onKeyUp="Recalcular(this,'cta',event)" style="text-align:right; font-size:11px" name="acta[<?php echo $pos;?>]" type="text" id="acta[]" value="0.00" size="10" maxlength="12"></span></td>
            <td><span class="Estilo_det"><input disabled style="text-align:right; font-size:11px" name="saldo[<?php echo $pos; $pos++;?>]" id="saldo[]" type="text" value="<?php echo number_format($row2['msaldo'],2,".",""); ?>" size="10" maxlength="12"></span></td>
          </tr>
          <?php
		  		$total_deuda=$row2['msaldo']+$total_deuda;
			}
		  ?>
      </table>
	  
	  </div>
	  </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="24" rowspan="2">&nbsp;</td>
      <td><input type="button" name="Submit" value="Aceptar" onClick="save_ref()">
          <input type="button" name="Submit2" value="Cancelar" onClick=""><span class="Estilo_det">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "Total Deuda"?><input style="text-align:right; font-size:11px" name="txttotal" id="txttotal" type="text" value="<?php echo number_format($total_deuda,2,".","");?>" size="15" maxlength="15"></span></td>
	  <td>
      <td width="10" rowspan="2">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>

<script>
function cargar_docsd(a){
	var chk=document.getElementById("form1").chkok;
	var de=chk.length;
	var texto="";
	var tot=0;
	var g=0;
	var devo=0;
	var monto_det=0;
	for (var x=0; x < de; x++) {
		mone=chk[x].parentNode.parentNode.parentNode.childNodes[6].childNodes[0].innerHTML;
		tdeuda=parseFloat(chk[x].parentNode.parentNode.parentNode.childNodes[7].childNodes[0].innerHTML);
		if (chk[x].checked) { 
			if(document.getElementById('tot_disp').value>0.00){
				texto=chk[x].value+","+texto;
				if((document.getElementById('mone_origen').value=="S/. " && mone=="US$.")||(document.getElementById('mone_origen').value=="US$. " && mone=="S/.")){
					campo="valorizaen";
				}else{
					campo="tot_disp";
				}
				if(tdeuda>=document.getElementById(campo).value && document.form1['acta['+x+']'].value=="0.00"){
					document.form1['acta['+x+']'].value=parseFloat(document.getElementById(campo).value);
					document.form1['saldo['+x+']'].value=tdeuda-parseFloat(document.getElementById(campo).value);
					document.getElementById('valorizaen').value="0.00";
					document.getElementById('tot_disp').value="0.00";
				}
				g++;
			}else{
				if(document.form1['acta['+x+']'].value=="0.00"){
					alert("No queda saldo Suficiente");
					chk[x].checked=false;
				}
			}
		}else{
			//Devuelve
			if((document.getElementById('mone_origen').value=="S/. " && mone=="US$.")){
				monto_tod=parseFloat(document.form1['acta['+x+']'].value)*document.getElementById('tc').value;
				monto_det=parseFloat(document.form1['acta['+x+']'].value)+monto_det;
			}else{
				if((document.getElementById('mone_origen').value=="US$. " && mone=="S/.")){
					monto_tod=parseFloat(document.form1['acta['+x+']'].value)/document.getElementById('tc').value
					monto_det=parseFloat(document.form1['acta['+x+']'].value)+monto_det;
				}
			}
			devo=monto_tod+parseFloat(devo);
			document.form1['acta['+x+']'].value="0.00";
			document.form1['saldo['+x+']'].value=parseFloat(tdeuda).toFixed(2);
		}
		
		tot=parseFloat(document.form1['saldo['+x+']'].value)+parseFloat(tot);
	}
	document.form1.cod_ref.value=texto;
	document.form1.items.value=g;
	document.getElementById('tot_disp').value=parseFloat(devo).toFixed(2);
	document.getElementById('valorizaen').value=parseFloat(monto_det).toFixed(2);
	document.form1.txttotal.value=parseFloat(tot).toFixed(2);
}

function detalle_ref(e){

   if(e.keyCode==13){
	
	generar_ceros(e,7,"numero");
	
	doc=document.form1.doc.value;
	numero=document.form1.numero.value;
	serie=document.form1.serie.value; 
    }
}
	
	function generar_ceros(e,ceros,control){
			var serie=document.form1.serie.value;
			var numero=document.form1.numero.value;
			
			if(e.keyCode==13 ){

				var valor="";
				if(control=='serie'){
				valor=serie
				}else{
				valor=numero
				}
				
				valor = parseFloat(valor);
				//alert(valor);
				if(isNaN(valor)){
				alert('Por favor digite un número válido');
				return false;
				}else{
				
				valor=valor.toString();
				}
						
			   if(control=='serie'){
				 document.form1.serie.value=ponerCeros(valor,ceros);
				 document.form1.numero.focus();
                 document.form1.numero.select();
				}
				if(control=='numero'){
				 document.form1.numero.value=ponerCeros(valor,ceros);
				}
				
			}  
	}	
	
	
	 function ponerCeros(obj,i) {
		  while (obj.length<i){
			obj = '0'+obj;
			}
			return obj;
		}		


function save_ref(){
var d=document.form1.cod_ref.value;
var itemd=document.form1.items.value;
//alert(d);
//window.opener.cargar_ref(serie,numero,cod_cli_ref,des_cli_ref,cod_cab_ref);
window.opener.amarrar_docs(d,itemd);
close();
}

/*	jQuery(document).bind('keydown', 'return',function (evt){jQuery('#_return').addClass('dirty'); 
	
	if(document.activeElement.name=='doc'){
		
		document.form1.serie.focus();	
	}
	
	return false; });
*/
//function vaciar_sesiones(){
//doAjax('compras/vaciar_sesiones.php','','','get','0','1','','');
//}

function Recalcular(control,tipo,e){
	if(e.keyCode==13){
		doAjax('compras/vaciar_sesiones.php','','','get','0','1','','');
	}
}

</script>