<?php 
//include('../seguridad.php');
session_start();
include('../conex_inicial.php');
include('../funciones/funciones.php');
$mcanje=$_REQUEST['mcanje'];
$prueba="";
$tipcampo="hidden";
if ($prueba!=""){
	$tipcampo="text";
}
$sql=mysql_query("Select multicj.*,cl.razonsocial as cliente2 from multicj inner join cliente cl on cl.codcliente=multicj.cliente where multi_id='$mcanje' ",$cn);
$row_c=mysql_fetch_array($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:Cancelacion de Letras:.</title>
	<script language="javascript" src="miAJAXlib3.js"></script>
	<script src="../jquery-1.2.6.js"></script>
    <script src="../jquery.hotkeys.js"></script>
        <link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
		<script type="text/javascript" src="../calendario/calendar.js"></script>
		<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
		<script type="text/javascript" src="../calendario/calendar-setup.js"></script>
<script language="javascript">

jQuery(document).bind('keyup', 'return',function (evt){jQuery('#_return').addClass('dirty'); 
	var nombreVariable=document.getElementById('MB_frame');
	try {
		//alert();
		if (typeof(eval(nombreVariable)) != 'undefined' ){
			if (eval(nombreVariable) != null){
				return false();
			}
		}
	} catch(e) { }			 
	switch(document.activeElement.name){
		case 'tope':document.form1.tpago.disabled="";document.form1.tpago.focus();break;
		case 'tpago':document.form1.numero_tarjeta.disabled="";document.form1.numero_tarjeta.focus();break;
		case 'numero_tarjeta':document.form1.soles.disabled="";document.form1.dolares.disabled="";document.form1.soles.focus();document.form1.soles.select();break;
		case 'soles':
			if(document.form1.soles.value==0){
				document.form1.dolares.focus();
				document.form1.dolares.select();
			}else{
				document.form1.fechadp.focus();document.form1.fechadp.select();
			}break;
		case 'dolares':
			if(document.form1.dolares.value==0){
				document.form1.soles.focus();
				document.form1.soles.select();
			}else{
				document.form1.fechadp.focus();document.form1.fechadp.select();
			}break;
		case 'fechadp':document.form1.obs.focus();document.form1.obs.select();break;
		case 'obs':insertar_pag(event);break;
	}
return false; });

function Letra(cod,valor){
	var let=cod;
	var ope=valor;
	if(ope=="Pa"){
		var cb="Mostrar";
	}else{
		var cb="ActualizarDet";
	}
	var divdet=cod;
	doAjax('operaciones.php','&Modulo=CancelaLetra&let='+let+'&ope='+ope+'&det='+divdet,cb,'GET','','','','');
}

function Pagar(){
}

function Mostrar(texto){
	resp=texto.split("~");
	//document.getElementById('pagos').innerHTML=resp[0];
	document.getElementById('tabla_pago').style.visibility='visible';
	document.form1.letra.value=resp[1];
	document.form1.referencia.value=resp[1];
	//alert(document.getElementById('det'+resp[1]).childNodes[7].innerHTML);
	document.form1.importe.value=document.getElementById('det'+resp[1]).childNodes[3].innerHTML;
	doAjax('lista_pago_cuenta.php','Modulo=CancelaLetra&referencia='+resp[1],'ActualizarPago','get','0','1','','');
}

function ActualizarPago(texto){
	//alert(texto);
	var r = texto;
	document.getElementById('pagos_d').innerHTML=r;
	document.getElementById('tope').focus();
	if(document.form1.moneda.value="01"){
		var importe=document.form1.pendiente_s.value;
	}else{
		var importe=document.form1.pendiente_d.value;
	}
	//alert(importe);
	doAjax('calcular2.php','accion=acuenta&Modulo=CancelaLetra&referencia='+document.form1.letra.value+'&importe='+document.form1.importe.value+'&mone_doc='+document.form1.moneda.value,'ActualizarSaldos','get','0','1','','');
}

function ActualizarSaldos(texto){
	datos=texto.split("?");
	document.form1.acta.value=datos[2];
	document.form1.cargos.value=datos[0];
	if(document.form1.moneda.value="01"){
		document.form1.pendiente_s.value=datos[3];
		//document.form1.pendiente_d.value=parseFloat(parseFloat(datos[3])/parseFloat(document.form1.tcambio2.value)).toFixed(2);
		document.form1.pendiente_d.value=parseFloat(parseFloat(datos[3])/parseFloat(document.form1.tcact2.value)).toFixed(2);
	}else{
		document.form1.pendiente_d.value=datos[3];
		document.form1.pendiente_s.value=parseFloat(parseFloat(datos[3])*parseFloat(document.form1.tcact2.value)).toFixed(2);
		//document.form1.pendiente_s.value=parseFloat(parseFloat(datos[3])*parseFloat(document.form1.tcambio2.value)).toFixed(2);
	}
	//alert(datos[4]);
	document.getElementById('acta'+datos[4]).innerHTML=parseFloat(datos[2]).toFixed(2);
	//document.getElementById('saldo'+datos[4]).innerHTML=parseFloat(datos[3]).toFixed(2);
	document.getElementById('saldo'+datos[4]).innerHTML=(parseFloat(document.getElementById('total'+datos[4]).innerHTML)-parseFloat(datos[2])).toFixed(2);
	limpiarPago();
	//document.getElementById('acta'+datos[4]).innerHTML=document.form1.pendiente_s.value;
}

function ActualizarDet(texto){
	//alert(texto);
	var resp=texto.split("~");
	switch(resp[0]){
		case 'A': var color="#FF0000"; var mensaje=resp[2];break;
		case 'P': var color="#009966"; var mensaje=resp[2];break;
		default: var color="#CCCCCC"; var mensaje=resp[2];break;
	}
	if(mensaje==""){
		if(resp[0]=="Pa"){
			Letra(resp[1],resp[0]);
		}else{
			document.getElementById('det'+resp[1]).style.backgroundColor=color;
		}
	}else{
		alert(mensaje);
	}
}

function c_soles(){
	//alert(document.form1.soles.value);
	if(document.form1.soles.value!="0"){
		document.form1.dolares.disabled=true;
	}else{
		document.form1.dolares.disabled=false;
	}
}

function c_dolares(){
	if(document.form1.dolares.value!="0"){
		document.form1.soles.disabled=true;
	}else{
		document.form1.soles.disabled=false;
	}
}

function eliminar_pago(codigo,tipo,monto,mone,tc){
	switch(document.form1.moneda.value){
		case '01':var val0=document.form1.pendiente_s.value;break;
		case '02':var val0=document.form1.pendiente_d.value;break;
	}
	if(tipo=='A'){
		if(document.form1.moneda.value=='01' && mone=='02'){
			var val1=monto*tc;
		}else{
			if(document.form1.moneda.value=='02' && mone=='01'){
				var val1=monto/tc;
			}else{
				var val1=monto;
			}
		}
		var saldof=parseFloat(val0)+parseFloat(val1);
	}else{
		if(document.form1.moneda.value=='01' && mone=='02'){
			var val1=monto*tc;
		}else{
			if(document.form1.moneda.value=='02' && mone=='01'){
				var val1=monto/tc;
			}else{
				var val1=monto;
			}
		}
		var saldof=parseFloat(val0)-parseFloat(val1);
	}
	var referencia=document.form1.referencia.value;
	var respuesta=confirm("confirma que desea eliminar este dato?")
	if(respuesta && (document.form1.nivel.value==4 || document.form1.nivel.value==5)  && saldof>=0)
	{
	
		doAjax('lista_pago_cuenta.php','Modulo=CancelaLetra&accion=eliminar&cod_pago='+codigo+'&referencia='+referencia,'ActualizarPago','get','0','1','','');
	}else{
		if((document.form1.nivel.value!=5 && document.form1.nivel.value!=4)  && saldof>=0){
			alert("No esta autorizado a eliminar pagos...Contacte con el Administrador de la Tienda");
		}else{
			alert("No se puede eliminar pago...verifique saldo");
		}
	}
}

function insertar_pag(e){
	//alert();
	if(e.keyCode == 13){
		if(document.form1.soles.value!=0 || document.form1.dolares.value!=0){
			var tipo=document.form1.tope.value;
			var tc=document.form1.tcact2.value;
			var fecha=document.form1.fechadp.value;
			var tpago=document.form1.tpago.value;
			var numero=document.form1.numero_tarjeta.value;
			var soles=parseFloat(document.form1.soles.value);
			var dolares=parseFloat(document.form1.dolares.value);
			var referencia=document.form1.referencia.value;
			//if(document.form1.soles!=0){
				//if(document.form1.moneda.value=='01'){
					//var saldo=parseFloat(document.form1.pendiente_s.value);
				//}else{
					//var saldo=parseFloat(document.form1.pendiente_d.value);
				//}
			/*}else{
				if(document.getElementById('saldos').innerHTML=='Saldo(US$.)'){
					var saldo=parseFloat(document.form1.pendiente_s.value);
				}else{
					var saldo=parseFloat(document.form1.pendiente_d.value);
				}
			}*/
			if(document.form1.soles.value>0.00){
				var saldo=parseFloat(document.form1.pendiente_s.value);
				var mon=document.form1.soles.value;
			}else{
				var saldo=parseFloat(document.form1.pendiente_d.value);
				var mon=document.form1.dolares.value;
			}
			if(tipo=='A'){
				var saldof=parseFloat(saldo)-parseFloat(mon);
			}else{
				var saldof=parseFloat(saldo)+parseFloat(mon);
			}
			//alert(saldof);
			if(saldof>=0){
			var obs=document.form1.obs.value;
				doAjax('lista_pago_cuenta.php','Modulo=CancelaLetra&referencia='+referencia+'&tpago='+tpago+'&tc='+tc+'&tipo='+tipo+'&fecha='+fecha+'&numero='+numero+'&soles='+soles+'&dolares='+dolares+'&accion=insertar&obs='+obs,'ActualizarPago','get','0','1','','');
			}else{
				alert("No es posible insertar este movimiento Importe mayor a Saldo Pendiente");
				document.form1.soles.value=0;
				document.form1.dolares.disabled=false;
				document.form1.soles.focus();
				document.form1.soles.select();
			}
		}else{
			alert("Ingrese Monto Valido");
			document.form1.dolares.disabled=false;
			document.form1.soles.focus();
			document.form1.soles.select();
		}
	}
}

function validarfecha(fecha){
	var fdoc=document.form1.fecha.value;
	if(!compare_dates(fdoc,fecha)){
		obtener_tc(fecha);
	}else{
		alert("Fecha de pago no puede ser menor a la Fecha del documento");
		var fact="<?php echo date('d/m/Y'); ?>";
		document.form1.fechadp.value=fact;
		return false;
	}
}

function compare_dates(fecha, fecha2)   
  {   
    var xMonth=fecha.substring(3, 5);   
    var xDay=fecha.substring(0, 2);   
    var xYear=fecha.substring(6,10);   
    var yMonth=fecha2.substring(3, 5);   
    var yDay=fecha2.substring(0, 2);   
    var yYear=fecha2.substring(6,10);   
    if (xYear > yYear)   
    {   
        return(true)   
    }   
    else  
    {   
      if (xYear == yYear)   
      {    
        if (xMonth> yMonth)   
        {   
            return(true)   
        }   
        else  
        {    
          if (xMonth == yMonth)   
          {   
            if (xDay > yDay)   
              return(true);   
            else  
              return(false);   
          }   
          else  
            return(false);   
        }   
      }   
      else  
        return(false);   
    }   
}

function obtener_tc(dato){
	var fecha=dato;
	doAjax('calcular2.php','accion=TC&fecha='+fecha,'colocar_tc','get','0','1','','');
}

function mostrarlet(cod,pag){
	//alert(cod);
	doAjax('operaciones.php','&Modulo=CancelaLetra&ListarLetra&cod='+cod+'&pagina='+pag,'letrax','GET','','','','');
}

function letrax(texto){
	//alert(texto);
	var datos=texto.split("|");
	document.getElementById('det_let').innerHTML=datos[0];
	document.getElementById('pagina_let').innerHTML=datos[1];
}

function colocar_tc(texto){
document.form1.tcact.value=texto;
document.form1.tcact2.value=texto;
	if(document.form1.moneda.value="01"){
		var mont=document.form1.pendiente_s.value;
		//document.form1.pendiente_d.value=parseFloat(parseFloat(datos[3])/parseFloat(document.form1.tcambio2.value)).toFixed(2);
		document.form1.pendiente_d.value=parseFloat(parseFloat(mont)/parseFloat(document.form1.tcact2.value)).toFixed(2);
	}else{
		var mont=document.form1.pendiente_d.value;
		document.form1.pendiente_s.value=parseFloat(parseFloat(mont)*parseFloat(document.form1.tcact2.value)).toFixed(2);
	//document.form1.pendiente_s.value=parseFloat(parseFloat(datos[3])*parseFloat(document.form1.tcambio2.value)).toFixed(2);
	}
}

function limpiarPago(){
	document.form1.numero_tarjeta.value="";
	document.form1.soles.value=0;
	document.form1.dolares.value=0;
	document.form1.tope.focus();		
}
</script>
<style type="text/css">

body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo9 {
	font-size: 10px;
	font-weight: bold;
}
.Estilo112 {color: #000000}
.Estilo113 {	color: #CC3300;
	font-weight: bold;
	font-size: 10px;
	font-family: Arial, Helvetica, sans-serif;
}
.Estilo15 {font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo25 {font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #FFFFFF; }
.Estilo27 {font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #003366; }
.Estilo28 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 10px;
}
.Estilo30 {font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #990000; }
-->
</style>

<link href="../styles.css" rel="stylesheet" type="text/css">
<style type="text/css">

body {
background-color:#F3F3F3;   
}
.Estilo13 {color: #0767C7}

.Estilo100 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
.texto1{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#FFF;
}
.texto2{
	font-family: Verdana,Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #000000;
}
</style>
</head>
<body>
<form id="form1" name="form1" method="post" action="">
  <table width="718" border="0" cellspacing="1">
    <tr>
    	<td width="7"></td>
      <td width="704" height="29" colspan="7" class="Estilo13">Cancelacion de Letras
      <input type="<?=$tipcampo?>" name="tcambio2" id="tcambio2" value="<?php echo $row_c['tcambio'];?>" />
      <input type="<?=$tipcampo?>" name="referencia" id="referencia" value="" />
      <input type="<?=$tipcampo?>" name="moneda" id="moneda" value="<?php echo $row_c['moneda'];?>" />
      <input type="<?=$tipcampo?>" name="pendiente_s" id="pendiente_s" value="" />
      <input type="<?=$tipcampo?>" name="pendiente_d" id="pendiente_d" value="" />
      <input type="<?=$tipcampo?>" name="letra" id="letra" value="" /> 
      <input type="<?=$tipcampo?>" name="importe" id="importe" value="" />
      <input type="<?=$tipcampo?>" name="cargos" id="cargos" value="" />
      <input type="<?=$tipcampo?>" name="acta" id="acta" value="" />
      <input type="<?=$tipcampo?>" name="nivel" id="nivel" value="<? echo $_SESSION['nivel_usu']?>" size="5" maxlength="5">
      <input type="<?=$tipcampo?>" name="fecha" id="fecha" value="<?php echo extraefecha($row_c['fecha']);?>" /></td>
    </tr>
    <tr>
    	<td></td>
      <td height="85" colspan="7" valign="top"><table width="692" border="0" cellpadding="0">
  <tr>
    <td width="81" height="19">N° Canje :</td>
    <td width="81"><?php echo $row_c['numcje']; ?></td>
    <td width="81">&nbsp;</td>
    <td width="81">&nbsp;</td>
    <td width="328" colspan="2" rowspan="5" align="center" valign="top"><table border="0" style="border-top:#CCC solid 1px;border-left:#CCC solid 1px;border-right:#CCC solid 1px;border-bottom:#CCC solid 1px">
      <tr bgcolor="#0033CC">
        <td width="19" class="texto1">&nbsp;</td>
        <td width="114" class="texto1">Documento</td>
        <td colspan="2" class="texto1">Monto</td>
      </tr>
	<?php 
	$sql=mysql_query("Select concat(cm.cod_ope,' ',cm.serie,'-',cm.Num_doc) as documento, mo.simbolo as simb, md.* from multi_doc md inner join cab_mov cm on cm.cod_cab=md.cab_mov inner join multicj mc on mc.multi_id=md.multi_id inner join moneda mo on mo.id=mc.moneda where md.multi_id='$mcanje'",$cn);
		while($row=mysql_fetch_array($sql)){	?>
      <tr bgcolor="#CCCCCC">
        <td class="texto2"><a href=""><img style="border:hidden" height="15" width="15" src="../imagenes/ico_lupa.png"></a></td>
        <td class="texto2"><?php echo $row['documento']; ?></td>
        <td width="20" align="left" class="texto2"><?php echo $row['simb']?></td>
        <td width="43" align="right" class="texto2"><?php echo number_format($row['monto'],2); ?></td>
      </tr>
      <?php } ?>
    </table></td>
    </tr>
  <tr>
    <td height="20">Fecha :</td>
    <td><?php echo extraefecha($row_c['fecha']);?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="21">Clientel:</td>
    <td colspan="3"><?php echo $row_c['cliente2']; ?></td>
    </tr>
  <tr>
    <td height="22">Monto Total:</td>
    <td colspan="3"><?php $sql="Select sum(monto) from multi_det where multi_id='$mcanje' and estado!=''";$rs=mysql_query($sql,$cn);$rw=mysql_fetch_array($rs);$anulado="";
	if($rw[0]>0){
		$anulado="  (Monto Anulado/Protestado: ".$rw[0].")";
	}
	echo $row_c['importe']; ?><span style="color:#F00"><?php echo $anulado;?></span></td>
    </tr>
</table>

      
      </td>
    </tr>
    <tr>
	    <td></td>
    	<td colspan="7"><table border="0" cellpadding="0">
		    <tr>
		      <td width="121" align="center" class="texto1" bgcolor="#0033CC">N&deg; Letra</td>
		      <td width="105" align="center" class="texto1" bgcolor="#0033CC">Fec. Vcto.</td>
		      <td width="62" align="center" class="texto1" bgcolor="#0033CC">Mon.</td>
		      <td width="85" align="center" class="texto1" bgcolor="#0033CC">Total</td>
		      <td width="85" align="center" class="texto1" bgcolor="#0033CC">A cta.</td>
		      <td width="85" align="center" class="texto1" bgcolor="#0033CC">Saldo</td>
		      <td width="137" align="center" class="texto1" bgcolor="#0033CC">Acciones</td>
		      <td width="20px" align="center"></td>
		    </tr>
		    <tr>
		    <td colspan="8"><div id="det_let" style="height:94px; width:auto; overflow-y:auto";>
            <script>mostrarlet('<?php echo $mcanje;?>','');</script>
            </div></td>
			</tr>
			<tr>
				<td colspan="8"><div id="pagina_let" style="height:auto; width:auto";></div></td>
			</tr>
		</table></td>
	</tr>
	<tr>
   	  <td></td>
      <td colspan="7" align="center"><table border="0" cellpadding="0" cellspacing="0"><tr>
      	<td align="center"><table id="tabla_pago" style="visibility:hidden" width="659" border="1" cellpadding="0" cellspacing="0">
		<tr bgcolor="#004993">
			<td width="700" align="left" bgcolor="#D8D8D8">
            	<table width="654" height="51" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  	<td width="50" align="center"><span class="Estilo27">T. Ope </span></td>
                  	<td width="122" align="center"><span class="Estilo27">T. Pago </span></td>
                  	<td width="72" align="center"><span class="Estilo27">Numero</span></td>
                  	<td width="57" align="center"><span class="Estilo27">Soles</span></td>
                  	<td width="57" align="center"><span class="Estilo27">Dolares</span></td>
                  	<td width="105" align="center"><span class="Estilo27">Fecha</span></td>
                  	<td width="51" align="center"><span class="Estilo27">T.C.</span></td>
                  	<td width="140" align="center"><span class="Estilo27">Obs.</span></td>
                </tr>
                <tr>
                	<td height="20" align="center"><select style="width:40px" id="tope" name="tope" onChange="colocar();">
                      <option value="A" selected="selected">A - Abono</option>
                      <option value="C">C - Cargo</option>
                    </select>
                  	<td height="35" align="center"><select style="width:120px" disabled="disabled" id="tpago" name="tpago" onChange="colocar();">
                  	<?php 
                      	$SQL33="Select * from t_pago";
				  		$consult2=mysql_query($SQL33,$cn);
				  		while($row33=mysql_fetch_array($consult2)){ ?>
                      	<option value="<?php echo $row33['id']; ?>"><?php echo $row33['descripcion']; ?></option>
                        <?php } ?></select></td>
                  	<td align="center"><input style="width:70px" disabled="disabled" name="numero_tarjeta" type="text" size="10" maxlength="15" ></td>
					<td align="center"><input disabled="disabled" style="width:50px" name="soles" type="text" size="10" maxlength="15" value="0" onKeyPress="c_soles()"></td>
                  	<td align="center"><input style="width:50px" disabled="disabled" name="dolares" type="text" size="10" maxlength="15" value="0" onKeyPress="c_dolares()" ></td>
                  	<td align="center"><input name="fechadp" id="fechadp" readonly type="text" size="10" maxlength="10" value="<?php echo date('d/m/Y')?>"  onChange="validarfecha(this.value)" >
                  	<button type="reset" id="f_trigger_b1" style="height:20px; width:20px; vertical-align:top" >...</button>
					<script type="text/javascript">
						Calendar.setup({
        				inputField     :    "fechadp",      
        				ifFormat       :    "%d/%m/%Y",      
        				showsTime      :    false,            
        				button         :    "f_trigger_b1",   
        				singleClick    :    true,           
        				step           :    1                
    					});
            		</script></td>
                 	<td align="center"><input style="width:40px" name="tcact2" type="text" id="tcact2" value="<?php echo $_SESSION['tc'];?>" size="7" maxlength="10">                                    
                  	<td align="center"><textarea style="width:130px; height:30px" name="obs" id="obs" cols="50" rows="3"></textarea>                  
				</tr>
              </table></td>
            </tr>
      </table></td>
    </tr>
        <tr>
          <td height="19" colspan="7">&nbsp;</td>
        </tr>
        <tr>
          <td height="19" colspan="7"><div id="pagos_d"></div></td>
          </tr>
        </table></td>
    </tr>
    </table>
</form>
</body>
</html>