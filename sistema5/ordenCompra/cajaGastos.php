<?php 
session_start();
include('../conex_inicial.php');
include('../funciones/funciones.php');
$codDoc=$_REQUEST['CodDoc'];
//echo $codDoc;


	if(isset($_REQUEST['numero'])){
		
		
		$strSQL="select  max(cod_cab) as cod_cab from cab_mov";
		$resultado=mysql_query($strSQL,$cn);
		$row=mysql_fetch_array($resultado);
		$codigo=$row['cod_cab']+1;
		
		$strSQL3="insert into cab_mov(cod_cab,tipo,cod_ope,Num_doc,serie,cod_vendedor,caja,cliente,ruc,fecha,f_venc,moneda,impto1,tc,b_imp,igv,servicio,percepcion,total,saldo,tienda,sucursal,flag,flag_r,motivo,noperacion,items,condicion,incluidoigv,obs1,obs2,obs3,obs4,obs5,inafecto,fecha_aud,pc,kardex,deuda,transportista,chofer,dirPartida,dirDestino,areaCosto)values('".$codigo."','1','".$_REQUEST['documento']."','".$_REQUEST['numero']."','".$_REQUEST['serie']."','".$_REQUEST['responsable']."','".$caja."','".$_REQUEST['codcliente']."','".$ruc."','".cambiarfecha($_REQUEST['fechaDoc'])."','".cambiarfecha($_REQUEST['fechaCaja'])."','".$_REQUEST['monedaDoc']."','".$impto."','".$_SESSION['tc']."','".$monto."','".$impuesto1."','".$servicio."','".$percepcion."','".$_REQUEST['importe']."','".$saldo."','".$tienda."','".$_REQUEST['sucOT']."','".$flag."','OT','".$motivo."','".$noperacion."','".$items."','".$condicion."','".$incluidoigv."','".$obs1."','".$obs2."','".$obs3."','".$obs4."','".$obs5."','".$permiso4."','".$fecha_aud."','".$_SESSION['pc_ingreso']."','".$permiso10."','".$deuda."','".$transportista."','".$chofer."','".$dirPartida."','".$dirDestino."','".$idAreaCosto."')";
		
	//echo $strSQL3;
	mysql_query($strSQL3,$cn);		
	}
	
	

	$strSQL07="select * from cab_mov where cod_cab='".$_REQUEST['CodDoc']."' ";
	//echo $strSQL07;
	$resultado07=mysql_query($strSQL07,$cn);
	$row07=mysql_fetch_array($resultado07);
	$serieOT=$row07['serie'];
	$numeroOT=$row07['Num_doc'];
	$clienteOT=$row07['cliente'];
	$sucursalOT=$row07['sucursal'];
	$codcabOT=$row07['cod_cab'];
	$monedaOT=$row07['moneda'];
	
	list($razonsocial)=mysql_fetch_row(mysql_query("select razonsocial from cliente where codcliente='".$clienteOT."'",$cn));

	//-----------------------------------------obteniendo PO-------------------------------
		
		list($codcabPO)=mysql_fetch_row(mysql_query("select cod_cab_ref from referencia r,cab_mov c where r.cod_cab='".$codcabOT."' and cod_cab_ref=c.cod_cab and cod_ope='PO' ",$cn));
		
		//echo $codcabPO;
	
	//-------------------------------------------------------------------------------------

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Caja Gastos Operativos</title>
<style type="text/css">
<!--
.Estilo1 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
	color: #0066FF;
}
.Estilo33 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo34 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
}
.Estilo35 {font-family: Arial, Helvetica, sans-serif}
.Estilo36 {font-size: 11px}
.Estilo41 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.Estilo42 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.Estilo47 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #FF0000;
	font-weight: bold;
}
.Estilo48 {color: #333333}
.Estilo49 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #333333; }
.Estilo15 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #990000;
}
-->
</style>
</head>
<script language="javascript" src="../miAJAXlib2.js"></script>
<link href="../styles.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../javascript/mover_div.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>

<script>
var scrollDivs=new Array();
scrollDivs[0]="proveedores";

</script>
<body>
<form name="form1" method="get" action="?">
  <table width="756" height="365" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="12" height="31" bgcolor="#E6E6E6">&nbsp;</td>
      <td width="734" align="center" bgcolor="#E6E6E6"><span class="Estilo1">Caja Gastos Operativos 
        <input type="hidden" name="CodDoc" id="CodDoc" value="<?php echo $_REQUEST['CodDoc'] ?>">
	    <input type="text" name="codcliente" id="codcliente">
        <input type="text" name="sucOT" id="sucOT" value="<?php echo $sucursalOT ?>">
      </span></td>
      <td width="10" bgcolor="#E6E6E6">&nbsp;</td>
    </tr>
    <tr>
      <td height="69">&nbsp;</td>
      <td align="left"><fieldset>
        <legend><span class="Estilo42">DOCUMENTO REFERENCIA</span></legend>
        <table width="598" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="280" height="27" valign="bottom"><span class="Estilo34">OT - </span>
                <input  readonly="readonly" name="serieOT" id="numeroOT" type="text" size="3" maxlength="10" value="<?php echo $serieOT ?>">
            <input  readonly="readonly" name="serieOT2" id="numeroOT" type="text" size="8" maxlength="7" value="<?php echo $numeroOT; ?>"></td>
            <td width="159" valign="bottom"><span class="Estilo41">Fecha:</span>
            <input name="txtFec" type="text" id="txtFec" value="<?php echo date('d-m-Y')?>" size="10" maxlength="10" readonly="readonly"></td>
            <td width="159" valign="bottom"><span class="Estilo41">Moneda:
              <input name="monedaOT" type="text" id="monedaOT" value="<?php echo $monedaOT ?>" size="10" maxlength="10" readonly="readonly">
            </span></td>
          </tr>
          <tr>
            <td height="27" colspan="3"><strong><span class="Estilo35"><span class="Estilo36">CLIENTE:</span>&nbsp;</span>&nbsp;</strong><span class="Estilo33"><?php echo $razonsocial?>.</span></td>
          </tr>
        </table>
      </fieldset></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="85">&nbsp;</td>
      <td><fieldset>
         
          <table width="721" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="699" height="34" colspan="3" valign="middle">
			   <span class="Estilo47"> COSTOS OPERATIVOS</span>
			    <select name="costooperativo" id="costooperativo" onChange="cambiarCostoO(this)">
			     <option value="0">---seleccionar---</option>
			  <?php 
			 $strSQL01="select costoope,costoparcial,nombre from costopexpresu c,costoperativo o where codpresup='".$codcabPO."' and c.costoope=o.id";
			//  echo $strSQL01;
			  $resultado01=mysql_query($strSQL01,$cn);
			  while($row01=mysql_fetch_array($resultado01)){
			  
			  ?>
			    <option value="<?php echo $row01['costoope']."-".$row01['costoparcial'] ?>"><?php echo $row01['nombre'] ?></option>
			  <?php } ?>
              </select></td>
            </tr>
            <tr>
              <td colspan="3"><table width="717" height="30" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="146"><span class="Estilo41">I<span class="Estilo48">mporte Presupuestado:</span> </span></td>
                  <td width="150"><input readonly="readonly" name="impPres" id="impPres" type="text" class="Estilo35" size="10"></td>
                  <td width="56"><span class="Estilo49">Utilizado:</span></td>
                  <td width="165"><input readonly="readonly" name="impUtil" id="impUtil" type="text" class="Estilo35" size="10"></td>
                  <td width="69"><span class="Estilo49">Disponible:</span></td>
                  <td width="131"><input readonly="readonly" name="impDisp" id="impDisp" type="text" class="Estilo35" size="10"></td>
                </tr>
              </table></td>
            </tr>
          </table>
        </fieldset></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="136">&nbsp;</td>
      <td height="136"><fieldset><legend class="Estilo42">DOCUMENTO DE INGRESO</legend>
          <table width="725" height="107" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="70" height="25" class="Estilo49">Fecha Doc : </td>
              <td width="139" class="Estilo41"><input name="fechaDoc" id="fechaDoc" type="text" size="10" value="<?php echo date('d-m-Y')?>">
                <button type="reset" id="f_trigger_b2"  style="height:18" >...</button>
                <script type="text/javascript">
				Calendar.setup({
					inputField     :    "fechaDoc",      
					ifFormat       :    "%d-%m-%Y",      
					showsTime      :    true,            
					button         :    "f_trigger_b2",   
					singleClick    :    true,           
					step           :    1                
				});
				
				function pasarCampo(obj,evento){
					if(evento.keyCode==13){
						if(obj.name=='serie'){
						document.form1.serie.value=ponerCeros(obj.value,3);
						var doc=document.form1.documento.value;
						var sucursal="<?php echo $sucursalOT ?>";
						var tipomov=1;
						
						doAjax('../compras/peticion_datos.php','&serie='+document.form1.serie.value+'&doc='+doc+'&sucursal='+sucursal+'&peticion=generar_numero&tipomov='+tipomov,'rpta_gen_numero','get','0','1','',''); 
						
						}
						if(obj.name=='numero'){
						document.form1.numero.value=ponerCeros(obj.value,7);
						document.form1.descliente.focus();
						}
					}
					
				}
				 function rpta_gen_numero(texto){
		  				  
				  document.form1.numero.value=ponerCeros(texto,7);
				  
				  document.form1.numero.focus();
				  document.form1.numero.select();
				  				  
				  }
				
				
				
				function ponerCeros(obj,i) {
					  while (obj.length<i){
						obj = '0'+obj;
						}
					//	alert(obj);
						return obj;
				}
				
				</script>			  </td>
              <td width="61" class="Estilo49">Numero</td>
              <td width="155" class="Estilo49"><input name="serie" id="serie" type="text" size="4"  onKeyUp="pasarCampo(this,event)" value="001">
				
              <input name="numero"  id="numero" type="text" size="10" onKeyUp="pasarCampo(this,event)"></td>
              <td width="76" class="Estilo49">Responsable</td>
              <td colspan="3" class="Estilo41"><span class="Estilo15">
                <select name="responsable" style="width:120" onChange="">
                  <?php 
			$marcar="";
		    $resultados11 = mysql_query("select * from usuarios order by usuario ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
			$marcar="";
			if($row11['codigo']==$_SESSION['codvendedor']){
			$marcar=" selected='selected' ";
			}
			
		  ?>
                  <option <?php echo $marcar?> value="<?php echo $row11['codigo']?>"><?php echo $row11['usuario'];?></option>
                  <?php }?>
                </select>
              </span></td>
            </tr>
            <tr>
              <td height="27" class="Estilo49">Fecha Caja: </td>
              <td class="Estilo41"><input name="fechaCaja" id="fechaCaja" type="text" size="10" value="<?php echo date('d-m-Y')?>">
			   <button type="reset" id="f_trigger_b1"  style="height:18" >...</button>
                <script type="text/javascript">
				Calendar.setup({
					inputField     :    "fechaCaja",      
					ifFormat       :    "%d-%m-%Y",      
					showsTime      :    true,            
					button         :    "f_trigger_b1",   
					singleClick    :    true,           
					step           :    1                
				});
				</script>			  </td>
              <td class="Estilo49">Proveedor</td>
              <td class="Estilo41"><input name="descliente" id="descliente" type="text" onKeyup="cambiar_chofer('prov')"></td>
              <td class="Estilo49">Moneda</td>
              <td width="89" class="Estilo41"><span class="Estilo48">
                <select name="monedaDoc">
                  <option value="01">Soles</option>
                  <option value="02">Dolares</option>
                  </select>
              </span></td>
              <td width="42" class="Estilo49">Tc.              </td>
              <td width="93" class="Estilo49"><input readonly="readonly" name="tcCajaPagos" id="tcCajaPagos" type="text" size="10" value="<?php echo $tc;?>"></td>
            </tr>
            <tr>
              <td height="27" class="Estilo49">Tipo Doc.: </td>
              <td class="Estilo41"><span class="Estilo48">
                <select name="documento" id="documento">
                  <option value="F1">Factura Compra</option>
                  <option value="B1">Boleta Compra</option>
                  <option value="VA">Varios</option>
                  </select>
              </span></td>
              <td class="Estilo49">impuesto</td>
              <td class="Estilo41"><span class="Estilo48">
                <select name="select2">
                  <option value="0">Incluido IGV</option>
                  <option value="1">Inafecto</option>
                  </select>
              </span></td>
              <td class="Estilo49">Importe</td>
              <td class="Estilo41"><input style="text-align:right" name="importe" type="text" size="10" value="0.00" onKeyUp="document.form1.pagado.value=document.form1.importe.value" ></td>
              <td class="Estilo49">Pagado              </td>
              <td class="Estilo49"><input style="text-align:right;background:#E6E6E6" name="pagado" type="text" size="10" readonly="readonly" ></td>
            </tr>
            <tr>
              <td height="28" class="Estilo49">Notas:</td>
              <td colspan="3" class="Estilo41"><input name="textfield6" type="text" size="55"></td>
              <td colspan="4" align="center" class="Estilo41">&nbsp;</td>
            </tr>
          </table></fieldset> </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td align="center"><input type="button" name="Submit" id="Submit" value=" GUARDAR DOCUMENTO" class="noprint" onClick="grabar();"></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <div id="proveedores" style="position:absolute; left:114px; top:139px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>
</form>
</body>
</html>
<script>

function grabar(){
document.form1.submit();
}


function cambiarCostoO(obj){
var temp=obj.value.split("-");
var costoOpe=temp[0];
document.form1.impPres.value=temp[1];
var CodDocOT=document.form1.CodDoc.value;
doAjax('../peticion_ajax2.php','&peticion=ConsCostoO&costoOpe='+costoOpe+'&codCabOT='+CodDocOT,'rptacambiarCostoO','get','0','1','','');
}

function rptacambiarCostoO(texto){
alert(texto);
}

function cambiar_chofer(param){
	//var tienda=document.formulario.tienda.value;	
	doAjax('../peticion_ajax2.php','&peticion=mostrar_chofer&tabla='+param,'listaProd','get','0','1','','');
	
}
function listaProd(texto){
ocultar_combos();
document.getElementById('proveedores').innerHTML=texto;
document.getElementById('proveedores').style.visibility="visible";

}
function busqueda_chofer(pag){

var tabla="prov";
var valor=document.form1.valor_chofer.value;
//var tienda=document.formulario.tienda.value;

doAjax('../peticion_ajax2.php','&peticion=buscar_chofer&valor='+valor+'&tabla='+tabla+'&pag='+pag,'mostrar_bus_chofer','get','0','1','','');
}

function cargar_datos(pag){
busqueda_chofer(pag);
}
function mostrar_bus_chofer(texto){
temp=texto.split("~");
document.getElementById('detalle_chofer').innerHTML=temp[0];
document.getElementById('divpagina').innerHTML=temp[1];

}

var temp2="";
	function entrada(objeto){
	//objeto.cells[0].childNodes[0].checked=true;
	//temp=objeto;
		if(objeto.style.background=='url(../imagenes/sky_blue_sel.png)'){
	//objeto.style.background=objeto.bgColor;
		}else{
		objeto.style.background='url(../imagenes/sky_blue_sel.png)';
			if(temp2!=''){
			//alert(temp.style.background);
			//alert(objeto.bgColor);
			temp2.style.background=temp2.bgColor;
			}
			temp2=objeto;
		}
	
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

function salir(){

document.getElementById('proveedores').style.visibility="hidden";
mostrar_combos();
}

function sel_chofer(codigo,nombre,stock){
	
		document.form1.descliente.value=nombre;
		document.form1.codcliente.value=codigo;
		
	
salir();
}

</script>