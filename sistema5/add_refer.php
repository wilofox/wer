<?php 
include('conex_inicial.php');
include('funciones/funciones.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documentos de Referencia</title>
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
.Estilo_det {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color:#000000; }
.Estilo21 {color: #FFFFFF; font-weight: bold; }
</style></head>

<body  onLoad="javascript:document.form1.doc.focus()" >
<form name="form1" method="post" action="">
  <table width="601" height="494" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="19">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="197">&nbsp;</td>
      <td><fieldset>
      <legend>Documentos por Referenciar</legend>
          <table width="582" height="169" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="582" valign="top"><div style="height:150px; overflow-y:scroll" id="listaDocxRef">
                <table width="568" height="42"  border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="20" height="21" align="center" bgcolor="#0078F0"><span class="Estilo21">OK</span></td>
                    <td width="121" align="center" bgcolor="#0078F0"><span class="Estilo21">Fecha</span></td>
                    <td width="24" align="center" bgcolor="#0078F0"><span class="Estilo21">Tipo</span></td>
                    <td width="62" align="center" bgcolor="#0078F0"><span class="Estilo21">N&uacute;mero</span></td>
                    <td width="40" align="center" bgcolor="#0078F0"><span class="Estilo21">Tienda</span></td>
                    <td width="199" bgcolor="#0078F0"><span class="Estilo21">Cliente</span></td>
                    <td width="32" align="center" bgcolor="#0078F0"><span class="Estilo21">Mon</span></td>
                    <td width="70" align="center" bgcolor="#0078F0"><span class="Estilo21">Monto</span></td>
                  </tr>
                  <?php 
				  
				  $resultados10 = mysql_query("select * from refope where tipo='".$_REQUEST['tipomov']."' and documento='".$_REQUEST['doc']."'  order by descripcion  limit 1",$cn); 
			      $row10=mysql_fetch_array($resultados10) ;
				  				  
				  $strSQL="select * from cab_mov where tipo='".$_REQUEST['tipomov']."' and cliente='".$_REQUEST['codcliente']."' and sucursal='".$_REQUEST['sucursal']."'  and cod_ope!='TS' and flag!='A' and cod_ope='".$row10['codigo']."' order by fecha desc";
				
				//echo $strSQL;
				
				$resultado=mysql_query($strSQL,$cn);
				while($row=mysql_fetch_array($resultado)){
								
				//---------------------referencia//--------------
					$resultadoRef=mysql_query("select cod_cab from referencia where cod_cab_ref='".$row['cod_cab']."'",$cn);				
					$contRef=mysql_num_rows($resultadoRef);
					$rowRef=mysql_fetch_array($resultadoRef);		
					//echo $contRef;
				
					if($contRef > 0){
					
					list($cod_cabRef)=mysql_fetch_array(mysql_query("select cod_ope from cab_mov where cod_cab='".$rowRef['cod_cab']."'"));
					
						if($cod_cabRef==$_REQUEST['doc']){
						continue;
						}
						
						
					}	
								
				
				//list($cod_cabRef,$serieRef,$numeroRef)	=	mysql_fetch_array(mysql_query("select cod_ope,serie,Num_doc from cab_mov where cod_cab='".$row['cod_cab']."'"));
				
				
				
				
				
		
				?>
                  <tr>
                    <td><input style="border:none; background:none" name="radiobutton" type="radio" value="radiobutton" onClick="cargarDoc('<?php echo $row['serie']?>','<?php echo $row['Num_doc']?>')"></td>
                    <td align="center"><?php echo extraefecha4($row['fecha'])?></td>
                    <td align="center"><?php echo $row['cod_ope']?></td>
                    <td align="center"><?php echo $row['serie']."-".$row['Num_doc']?></td>
                    <td align="center"><?php echo $row['tienda']; ?></td>
                    <td><?php   list($razonsocial)=mysql_fetch_row(mysql_query("select razonsocial from cliente where codcliente='".$row['cliente']."'")); echo $razonsocial;?></td>
                    <td align="center"><?php  if($row['moneda']=='01')echo "S/.";else echo "US$." ?></td>
                    <td align="right"><?php echo number_format($row['total'],2) ?></td>
                  </tr>
                  <?php 
				}
				?>
                </table>
              </div></td>
            </tr>
        </table>
      </fieldset>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="10" height="65">&nbsp;</td>
      <td width="582"><table width="580" height="50" border="0" cellpadding="0" cellspacing="0" style="border:#999999 solid 1px">
          <tr>
            <td width="578" align="center"><table width="568" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="179"><span class="Estilo13">Tipo de Documento </span></td>
                  <td width="200"><span class="Estilo13">Documento
                    <input type="hidden" name="sucursal" value="<?php echo $_REQUEST['sucursal']?>">
                  </span></td>
                  <td width="150"><span class="Estilo13">
                    <input name="cod_ref" type="hidden" value="" size="8">
                    <input name="tienda" type="hidden" value="" size="8">
                    <input name="cod_cli_ref" type="hidden" value="" size="8">
                    <input name="des_cli_ref" type="hidden" value="" size="8">
					<input name="moneda_doc" id="moneda_doc" type="hidden" value="" size="8">
					
					
                    <input name="impto" id="impto" type="hidden" value="" size="8">
                    <input name="tipomov" id="tipomov" type="hidden" value="<?php echo $_REQUEST['tipomov']; ?>" size="8">
                  </span></td>
                </tr>
                <tr>
                  <td><select style="width:160" name="doc"   onChange="cargaDocxRef(this.value)">
                      <?php 
					  $tipomov=$_REQUEST['tipomov'];
					  $doc=$_REQUEST['doc'];
		   //$resultados10 = mysql_query("select * from operacion where tipo='$tipomov' and  codigo!='TS'  order by descripcion ",$cn); 
		   $resultados10 = mysql_query("select * from refope where tipo='$tipomov' and documento='".$doc."'  order by descripcion ",$cn); 
			while($row10=mysql_fetch_array($resultados10))
			{
			
		  ?>
                      <option value="<?php echo $row10['codigo']?>"><?php echo $row10['descripcion']?></option>
                      <?php }?>
                  </select></td>
                  <td>
				  <input name="serie" type="text" size="5" maxlength="3" onKeyUp="generar_ceros(event,3,'serie')">
				  <input autocomplete='off' name="numero" type="text" size="20" maxlength="7" onKeyUp="detalle_ref(event)"></td>
                  <td><span class="Estilo13">
                    <input name="obs1" id="obs1" type="hidden" value="" size="8">
                  </span><span class="Estilo13">
                  <input name="obs2" id="obs2" type="hidden" value="" size="8">
                  </span><span class="Estilo13">
                  <input name="obs3" id="obs3" type="hidden" value="" size="8">
                  </span><span class="Estilo13">
                  <input name="obs4" id="obs4" type="hidden" value="" size="8">
                  </span><span class="Estilo13">
                  <input name="obs5" id="obs5" type="hidden" value="" size="8">
                  </span></td>
                </tr>
            </table></td>
          </tr>
      </table></td>
      <td width="10">&nbsp;</td>
    </tr>
    <tr>
      <td height="190">&nbsp;</td>
      <td valign="top" style="border:#999999 solid 1px">
	  
	  <div id='det_doc' style="height:185; overflow:auto">
	  
	  <table width="579" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td width="32" height="18" bgcolor="#008A8A"><span class="Estilo11">Cod</span></td>
            <td width="281" bgcolor="#008A8A"><span class="Estilo11">Descripcion</span></td>
            <td width="36" bgcolor="#008A8A"><span class="Estilo11">Cant</span></td>
            <td width="40" bgcolor="#008A8A"><span class="Estilo11">Punit.</span></td>
            <td width="45" bgcolor="#008A8A"><span class="Estilo11">Total</span></td>
            <td width="40" align="center" bgcolor="#008A8A"><span class="Estilo11">A</span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
      </table>
	  </div>	  </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="button" name="Submit" value="Aceptar" onClick="save_ref()">
          <input type="button" name="Submit2" value="Cancelar" onClick="vaciar_sesiones();cerrar();"></td>
		  
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<script>

var prm_copiar_datos="<?php echo $_REQUEST['prm_copiar_datos']?>"

function cerrar(){
window.close();
}
function detalle_ref(e){

   if(e.keyCode==13){
	
	generar_ceros(e,7,"numero");
	
	doc=document.form1.doc.value;
	numero=document.form1.numero.value;
	serie=document.form1.serie.value;
	sucursal=document.form1.sucursal.value;
	docGen="<?php echo $_REQUEST['doc']; ?>";
	cliente="<?php echo $_REQUEST['codcliente']; ?>";

    doAjax('peticion_ajax.php','&serie='+serie+'&numero='+numero+'&doc='+doc+'&sucursal='+sucursal+'&det_ref'+'&accion=buscar&prm_copiar_datos='+prm_copiar_datos+'&docGen='+docGen+'&cliente='+cliente,'rpta_det_ref','get','0','1','',''); 
 
    }


}

function rpta_det_ref(texto){

	var temp=texto.split('?');	
	//alert(texto);
	
		
	if(temp[0]=='R'){	
	alert('Documento ya se encuentra referenciado ');
	
	}else{
		
		if(temp[0]=='N'){
		alert('Documento no Existe');
		document.getElementById('det_doc').innerHTML=temp[12];
		document.form1.cod_ref.value="";
		document.form1.cod_cli_ref.value="";
		document.form1.des_cli_ref.value="";
		document.form1.moneda_doc.value="";
		document.form1.impto.value="";	
		document.form1.tienda.value="";	
			
		}else{
		
		document.getElementById('det_doc').innerHTML=temp[12];
		document.form1.cod_ref.value=temp[1];
		document.form1.cod_cli_ref.value=temp[2];
		document.form1.des_cli_ref.value=temp[3];
		document.form1.moneda_doc.value=temp[4];
		document.form1.impto.value=temp[5];
		document.form1.obs1.value=temp[6];
		document.form1.obs2.value=temp[7];
		document.form1.obs3.value=temp[8];
		document.form1.obs4.value=temp[9];
		document.form1.obs5.value=temp[10];
		document.form1.tienda.value=temp[11];
			
		}
	  }
	
}

	function quitar_items(codigo){
	
	var cod_cli_ref=document.form1.cod_cli_ref.value;
	var des_cli_ref=document.form1.des_cli_ref.value;
	
doAjax('peticion_ajax.php','&cod='+codigo+'&det_ref'+'&accion=quitar&cod_ref='+document.form1.cod_ref.value+'&codcliente_ref='+cod_cli_ref+'&descliente_ref='+des_cli_ref,'rpta_det_ref','get','0','1','',''); 
	
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
		//	alert(obj);
			return obj;
		}		


function save_ref(){

var serie=document.form1.serie.value;
var numero=document.form1.numero.value;
var cod_cli_ref=document.form1.cod_cli_ref.value;
var des_cli_ref=document.form1.des_cli_ref.value;
var cod_cab_ref=document.form1.cod_ref.value;
var moneda_doc=document.form1.moneda_doc.value;
var impto=document.form1.impto.value;
var obs1=document.form1.obs1.value;
var obs2=document.form1.obs2.value;
var obs3=document.form1.obs3.value;
var obs4=document.form1.obs4.value;
var obs5=document.form1.obs5.value;
var tienda=document.form1.tienda.value;

window.opener.cargar_ref(serie,numero,cod_cli_ref,des_cli_ref,cod_cab_ref,moneda_doc,impto,obs1,obs2,obs3,obs4,obs5,tienda);
close();

}

	jQuery(document).bind('keydown', 'return',function (evt){jQuery('#_return').addClass('dirty'); 
	
	if(document.activeElement.name=='doc'){
		
		document.form1.serie.focus();	
	}
	
	return false; });

function vaciar_sesiones(){
doAjax('compras/vaciar_sesiones.php','','','get','0','1','','');
}


function cargarDoc(serie,numero){
document.form1.serie.value=serie;
document.form1.numero.value=numero;

	doc=document.form1.doc.value;
	numero=document.form1.numero.value;
	serie=document.form1.serie.value;
	sucursal=document.form1.sucursal.value;
	cliente="<?php echo $_REQUEST['codcliente']; ?>";
	
    doAjax('peticion_ajax.php','&serie='+serie+'&numero='+numero+'&doc='+doc+'&sucursal='+sucursal+'&det_ref'+'&accion=buscar&prm_copiar_datos='+prm_copiar_datos+'&cliente='+cliente,'rpta_det_ref','get','0','1','',''); 
}


function cargaDocxRef(doc){
		
	sucursal=document.form1.sucursal.value;
	codcliente="<?php echo $_REQUEST['codcliente']?>";
	tipomov="<?php echo $_REQUEST['tipomov']?>";
	
 doAjax('peticion_ajax2.php','&codcliente='+codcliente+'&tipomov='+tipomov+'&doc='+doc+'&sucursal='+sucursal+'&peticion=docxRef','rpta_cargaDocxRef','get','0','1','',''); 
}

function rpta_cargaDocxRef(data){
document.getElementById('listaDocxRef').innerHTML=data;
}


</script>