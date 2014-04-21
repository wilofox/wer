<?php 
session_start();
include('../conex_inicial.php');
include('../funciones/funciones.php');
if(isset($_REQUEST['ModLetras'])){
	$marc="marc(this)";
	$calc="modifica_acta(this,event)";
	$save="save_doc()";
	$salir="cerrar()";
	$mostrarx="NO";
}else{
	$marc="cargar_docsd(this.value)";
	$calc="Recalcular(this,'cta',event)";
	$save="save_ref()";
	$salir="";
	$mostrarx="SI";
}
function Marca($ccab){
	$mc="";$ct=0;
	if(isset($_SESSION['pagos'][0])){
		if(count($_SESSION['pagos'][0])>0){
			foreach ($_SESSION['pagos'][0] as $subkey=> $subvalue) {
				if($ccab==$_SESSION['pagos'][0][$subkey]){
					$mc=" checked ";
					$ct=$_SESSION['pagos'][6][$subkey];
				}
			}
		} 
	}
	return $mc."|".$ct;
}	   
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
  <table width="602" height="429" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="4" height="52">&nbsp;</td>
      <td width="570"><table width="474" height="50" border="0" cellpadding="0" cellspacing="0" style="border:#999999 solid 1px">
          <tr>
            <td width="472" align="center"><table width="594" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="167" height="23"><span class="Estilo13">Tipo de Documento 
                    <input name="items" type="hidden" value="" size="8">
                    <input id="mone_origen" type="hidden" value="<?php if(isset($_REQUEST['moneda'])){echo $_REQUEST['moneda'];}?>" size="8">
                    <span style="font-size:11px">
                    <input name="des_cli_ref" type="hidden" value="" size="8">
                  </span></span></td>
                  <td width="162"><span class="Estilo13">Documento
                    
                      <input type="hidden" name="sucursal" value="<?php echo $_REQUEST['sucursal']?>">
                  <span style="font-size:11px"><?php if(isset($_REQUEST['moneda'])){echo $_REQUEST['moneda'];}?>
                  <input name="cod_ref" type="hidden" value="" size="21">
                  <input name="cod_cli_ref" type="hidden" value="" size="8">
                  </span></span></td>
                  <?php if($mostrarx=="SI"){ ?>
                  <td width="110"><span class="Estilo13">
                    Monto Disponible
                  </span></td>
                  <td width="73" align="center"><span style="color:#F00;" class="Estilo13">
                    T.C.
                  </span></td>
                  <td width="82" align="center"><span style="color:#F00" class="Estilo13">Valorizado en: </span></td>
                  <?php }else{ ?>
                  <td width="110"><span class="Estilo13"></span></td>
                  <td width="73" align="center"><span style="color:#F00;" class="Estilo13"></span></td>
                  <td width="82" align="center"><span style="color:#F00" class="Estilo13"></span></td>
                  <?php } ?>
                </tr>
                <tr>
                  <td><select style="width:160; font-size:8px" name="doc"  >
                  <option value="T">Todos</option>
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
                  <?php if($mostrarx=="SI"){ ?>
                  <td align="center" style="font-size:11px"><input disabled style="font-size:11px; text-align:right" maxlength="10" size="10" type="text" name="tot_disp" id="tot_disp" value="<?php echo $_REQUEST['monto'];?>"></td>
                  <td align="center"><input onKeyUp="Recalcular(this,'tc',event)" style="font-size:11px" maxlength="5" size="5" type="text" name="tc" id="tc" value="<?php echo $_SESSION['tc'];?>"></td>
                  <td align="center" style="font-size:11px"><?php if($_REQUEST['moneda']=="S/. "){echo "US$.";$valorizaen=$_REQUEST['monto']/$_SESSION['tc'];}else{echo "S/.";$valorizaen=$_REQUEST['monto']*$_SESSION['tc'];}?><input style="font-size:11px; text-align:right" disabled maxlength="10" size="10" type="text" name="valorizaen" id="valorizaen" value="<?php echo number_format($valorizaen,2);?>"></td>
                  <?php }else{ ?>
                  <td align="center" style="font-size:11px"><input disabled style="font-size:11px; text-align:right" maxlength="10" size="10" type="hidden" name="tot_disp" id="tot_disp" value=""></td>
                  <td align="center"><input onKeyUp="Recalcular(this,'tc',event)" style="font-size:11px" maxlength="5" size="5" type="hidden" name="tc" id="tc" value=""></td>
                  <td align="center" style="font-size:11px"><input style="font-size:11px; text-align:right" disabled maxlength="10" size="10" type="hidden" name="valorizaen" id="valorizaen" value=""></td>
                  <?php } ?>
                </tr>
            </table></td>
          </tr>
      </table></td>
      <td width="24">&nbsp;</td>
    </tr>
    <tr>
      <td height="345">&nbsp;</td>
      <td valign="top" style="border:#999999 solid 1px">
	  
	  <div id='det_doc' style="height:340; overflow:auto">
	  
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
		  $registros=13;
		  $limit="limit 0,".$registros;
		  
		  $consulta="SELECT ca.moneda as moneda,concat(ca.tienda,'-',ti.des_tienda) as tienda, ca.cod_cab AS cab, ca.cod_ope AS td, CONCAT(ca.serie,'-',ca.num_doc) AS documento, ca.fecha AS fec_doc, ca.f_venc AS fec_vcto, if(ca.saldo<>(ca.total+ca.percepcion),ca.saldo,(ca.total+percepcion)) AS mtotal, ca.saldo AS msaldo FROM cab_mov ca INNER JOIN tienda ti on ti.cod_tienda =ca.tienda INNER JOIN operacion ope ON ope.codigo=ca.cod_ope WHERE saldo>0.00 AND ca.flag!='A' AND SUBSTR(ope.p1,5,1)='S' and codigo!='TB' and codigo!='TF' and codigo!='TS' and cliente='".$cliente."' "; //AND cliente='002719'
			$result=mysql_query($consulta,$cn);
			$total_reg=mysql_num_rows($result);
			
			$total_paginas = ceil($total_reg / $registros);
			
			$result2=mysql_query($consulta.$limit,$cn);
			$pos=0;
			$total_deuda=0;
			while($row2=mysql_fetch_array($result2)){
		?>
		  <tr onDblClick="OrigenDoc('<?php echo $row2['cab'];?>')">
          	<?php 
			$marca=Marca($row2['cab']);
			$marcar=explode("|",$marca);
			?>
            <td><span class="Estilo11"><input type="checkbox"<?php //echo $dis; ?>value="<?php echo $row2['cab']; ?>" name="chkok" id="chkok" onClick="<?php echo $marc; ?>" <?php echo $marcar[0]; ?>></span></td>
            <td><span class="Estilo_det"><?php echo $row2['tienda'];?></span></td>
            <td><span class="Estilo_det"><?php echo $row2['td']; ?></span></td>
            <td><span class="Estilo_det"><?php echo $row2['documento']; ?></span></td>
            <td><span class="Estilo_det"><?php echo extraefecha($row2['fec_doc']); ?></span></td>
            <td><span class="Estilo_det"><?php echo extraefecha($row2['fec_vcto']); ?></span></td>
            <td align="center"><span class="Estilo_det"><?php if($row2['moneda']=='01'){echo "S/.";}else{echo "US$.";} ?></span></td>
            <td align="right"><span class="Estilo_det"><?php echo number_format($row2['mtotal'],2,".",""); ?></span></td>
            <td><span class="Estilo_det"><input onKeyUp="<?php echo $calc; ?>" style="text-align:right; font-size:11px" name="acta[<?php echo $pos;?>]" type="text" id="acta[]" value=" <?php if(isset($marcar[1])){echo number_format($marcar[1],2);}?>" size="10" maxlength="12"></span></td>
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
      <td height="24" rowspan="3">&nbsp;</td>
      <td><div id='paginacion'><table width="594" border="0"><tr><td width="270" class="Estilo_det">P&aacute;gina 1 de <?php echo $total_paginas;?> (Viendo del 1 al 13 de <?php echo $total_reg; ?> documentos)</td><td width="309" align="right" class="Estilo_det"> Pag: <b>1</b><?php for($i=2;$i<=$total_paginas;$i++){ echo " <a href='javascript:cargar(".$i.")'>".$i."</a>";}?></td></tr></table></div></td>
      <td>    
      <td width="10" rowspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td><input type="button" name="Submit" value="Aceptar" onClick="<?php echo $save;?>">
          <input type="button" name="Submit2" value="Cancelar" onClick="<?php echo $salir;?>"><span class="Estilo_det">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "Total Deuda"?><input style="text-align:right; font-size:11px" name="txttotal" id="txttotal" type="text" value="<?php echo number_format($total_deuda,2,".","");?>" size="15" maxlength="15"></span></td>
	  <td>      
    </tr>
  </table>
</form>
</body>
</html>

<script>
function marc(a){
	if(a.checked){
		//Cuando se Marca
		doAjax('operaciones.php','&accion=selectdoc&doc='+a.value+'&agregar','llenar','get','0','1','','');
	}else{
		//Cuando se desmarca
		doAjax('operaciones.php','&accion=selectdoc&doc='+a.value+'&quitar','llenar','get','0','1','','');
	}
}

function llenar(texto){
//alert(texto);
	rpta=texto.split("|");
	if(rpta[1]!=""){
		var chk=document.getElementById("form1").chkok;
		var de=chk.length;
		if(de==undefined){
			document.form1['acta[]'].value=parseFloat(rpta[0]).toFixed(2);
			document.form1['acta[]'].focus();
			document.form1['acta[]'].select();
		}else{
			for (var x=0; x < de; x++) {
				if(chk[x].value==rpta[1]){
					document.form1['acta['+x+']'].value=parseFloat(rpta[0]).toFixed(2);
					document.form1['acta['+x+']'].focus();
					document.form1['acta['+x+']'].select();
				}
			}
		}
	}else{
		var chk=document.getElementById("form1").chkok;
		var de=chk.length;
		if(de==undefined){
			document.form1['acta[]'].value=parseFloat(rpta[0]).toFixed(2);
			document.form1['acta[]'].focus();
			document.form1['acta[]'].select();
		}else{
			for (var x=0; x < de; x++) {
				if(chk[x].checked){
					document.form1['acta['+x+']'].value=parseFloat(rpta[0]).toFixed(2);
					document.form1['acta['+x+']'].focus();
					document.form1['acta['+x+']'].select();
					
				}
			}
		}
	}
}

function modifica_acta(d,e){
//alert();
	if(e.keyCode==13){
		cont=(d.name).split("[");
		numc=cont[1].split("]");
		var chk=document.form1.chkok[numc[0]];
		if(chk==undefined){
			var chk=document.form1.chkok;
		}
		//alert(d.value);
		//var chk=eval("document.getElementById('form1').chkok["+numc[0]+"]");
		var doc=chk.value;
		if(chk.checked){
			doAjax('operaciones.php','&accion=selectdoc&doc='+doc+'&acta='+d.value+'&it='+numc[0]+'&a_cta','rpta_acta','get','0','1','','');
		}else{
			chk.checked=true;
			doAjax('operaciones.php','&accion=selectdoc&doc='+doc+'&acta='+d.value+'&it='+numc[0]+'&a_cta&dc','rpta_acta','get','0','1','','');
		}
	}
}

function rpta_acta(texto){
	//alert(texto);
	pag=texto.split("|");
	if(pag[0]=="error"){
		alert("No puede ingresar un monto mayor al Saldo Pendiente");
		document.form1['acta['+pag[1]+']'].value=pag[2];
	}
}

function OrigenDoc(valor){
	window.open("../doc_det2.php?referencia="+valor,"","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=320,left=300 top=250");
}

function save_doc(){
	window.opener.cargar_pagos();
	window.close();
}

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

function doc_pagos(e){

   if(e.keyCode==13){
	
	generar_ceros(e,7,"numero");
	var doc=document.form1.doc.value;
	var numero=document.form1.numero.value;
	var serie=document.form1.serie.value;
	var cliente="<?php echo $_REQUEST['auxiliar']; ?>";
	var ope="<?php echo $marc."|".$calc."|";?>";
	var tipo="<?php echo $_REQUEST['tipomov'];?>";
	//alert(cliente);
	/*if (doc=="T"){
	doAjax('operaciones.php','&accion=filtrardoc&cliente='+cliente+'&doc='+doc+'&ope='+ope+'&numero=&serie=&a_cta&dc','rpta_doc','get','0','1','','');
	}else{*/
	doAjax('operaciones.php','&accion=filtrardoc&cliente='+cliente+'&doc='+doc+'&ope='+ope+'&tip='+tipo+'&numero='+numero+'&serie='+serie+'&a_cta&dc','rpta_doc','get','0','1','','');
	//}
    }
}

function cargar(pag){

	var doc=document.form1.doc.value;
	var numero=document.form1.numero.value;
	var serie=document.form1.serie.value;
	var cliente="<?php echo $_REQUEST['auxiliar']; ?>";
	var ope="<?php echo $marc."|".$calc."|";?>";
	var tipo="<?php echo $_REQUEST['tipomov'];?>";
	
	doAjax('operaciones.php','&accion=filtrardoc&cliente='+cliente+'&doc='+doc+'&ope='+ope+'&tip='+tipo+'&numero='+numero+'&serie='+serie+'&pagina='+pag+'&a_cta&dc','rpta_doc','get','0','1','','');
}

function rpta_doc(texto){
	//alert(texto);
	texto=texto.split("|");
	document.getElementById('det_doc').innerHTML=texto[0];
	document.getElementById('paginacion').innerHTML=texto[1];
	document.getElementById('txttotal').value=texto[2];
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

function cerrar(){
	//doAjax('operaciones.php','&accion=selectdoc&salir','','get','0','1','','');
	window.close();
}

</script>