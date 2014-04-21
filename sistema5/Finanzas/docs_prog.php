<?php session_start();
include('../conex_inicial.php');
include('../funciones/funciones.php');

$sucursal=$_REQUEST['sucursal'];
$fec1=$_REQUEST['fec1'];
list($nom_suc)=mysql_fetch_row(mysql_query("select des_suc from sucursal where cod_suc='".$sucursal."'"));
 
  
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Insertar programaci&oacute;n</title>
<style type="text/css">
<!--
.Estilo1 {
	font-size: 12px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
	color: #0066CC;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo12 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.Estilo18 {font-size: 11px; font-weight: bold; color: #0066CC; font-family: Arial, Helvetica, sans-serif;}
.Estilo22 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #FFFFFF; }
.EstiloDetPagos {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo6 {font-size: 11px}
-->
</style>
</head>

    <script src="../jquery-1.2.6.js"></script>
    <script src="../jquery.hotkeys.js"></script>
	
	
<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>

<script language="javascript" src="../miAJAXlib2.js"></script>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="596" height="421" border="0">
    <tr>
      <td height="23" colspan="3" bgcolor="#EAEAEA"><p><span class="Estilo1"> &nbsp;&nbsp;&nbsp;DOCUMENTACION ( Programacion de Pagos ) </span> </p></td>
    </tr>
    <tr>
      <td width="17" height="56">&nbsp;</td>
      <td width="562" valign="top"><table width="562" height="54" border="0">

        <tr>
          <td height="50" colspan="3"><fieldset>
            
            <table width="533" height="24" border="0">
              <tr>
                <td width="54"><span class="Estilo12">Sucursal: </span></td>
                <td width="355"><span class="Estilo12"><?php echo $nom_suc; ?>
                  <input name="tempauxprod"  type="hidden" value="auxiliares" size="15" />
                  <input name="tipomov"  type="hidden" value="1" />
                  <input name="sucursal"  type="hidden"  value="<?php echo $sucursal; ?>"/>
                  <input name="fecha1"  type="hidden"  value="<?php echo $fec1; ?>"/>
                  <input type="hidden" name="monedaCuenta">
                </span></td>
                <td width="110"><span class="Estilo12">Fecha: <?php echo $fec1; ?> </span></td>
              </tr>
            </table>
          </fieldset> </td>
          </tr>
        
        

      </table></td>
      <td width="3">&nbsp;</td>
    </tr>
    <tr>
      <td height="119">&nbsp;</td>
      <td><fieldset><legend><span class="Estilo18">Cuentas Corrientes</span></legend><br>
          <table width="558" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="558">
			  <div style="height:250px; overflow-y:scroll" id="lista_cuentasDeudas" >
			    <table width="592" height="45" border="0" cellpadding="0" cellspacing="1">
                  <tr>
                    <td width="28" height="23" align="center" bgcolor="#0099CC"><span class="Estilo22 Estilo6">O</span></td>
                    <td width="33" bgcolor="#0099CC"><span class="Estilo22 Estilo6">Td</span></td>
                    <td width="136" align="center" bgcolor="#0099CC"><span class="Estilo22 Estilo6">Numero</span></td>
                    <td width="41" align="center" bgcolor="#0099CC"><span class="Estilo22 Estilo6">Mon</span></td>
                    <td width="83" align="center" bgcolor="#0099CC"><span class="Estilo22 Estilo6">Importe</span></td>
                    <td width="78" align="center" bgcolor="#0099CC"><span class="Estilo22 Estilo6">Saldo</span></td>
                    <td width="95" align="center" bgcolor="#0099CC"><span class="Estilo22 Estilo6">Programado</span></td>
                    <td width="89" align="center" bgcolor="#0099CC"><span class="Estilo22 Estilo6">Saldo Final </span></td>
                  </tr>
                  <?php 
			
			//$strSQL="select p2.numero as numeroDoc,p2.*,p1.* from progpagos_det p2,progpagos p1 where p1.id=id_progpagos and id_progpagos='".$_REQUEST['id']."' order by p2.id";
			$strSQL="select if(p2.numero='0000000',p2.num_let,p2.numero) as numeroDoc,p2.*,p1.* from progpagos_det p2,progpagos p1 where p1.id=id_progpagos and id_progpagos='".$_REQUEST['id']."' order by p2.id";
			//echo $strSQL;
			$resultado=mysql_query($strSQL,$cn);
			$i=0;
			while($row=mysql_fetch_array($resultado)){
			$sql_doc=mysql_query("Select moneda,total from cab_mov where cod_cab='".$row['cod_cab']."'",$cn);
			$row_doc=mysql_fetch_array($sql_doc);
			$mone_ori=$row_doc['moneda'];
			$sql_pag=mysql_query("Select pa.* from pagos pa where pa.referencia='".$row['cod_cab']."' and pa.numero!='".$row['numero']."'",$cn);
			//echo "Select pa.* from pagos pa where pa.referencia='".$row['cod_cab']."' and pa.numero!='".$row['numero']."'";
			$abo=0;
			$car=0;
			while($row_pag=mysql_fetch_array($sql_pag)){
				if($row_pag['moneda']!=$row_doc['moneda']){
					switch($row_pag['moneda']){
						case '01':
							//echo number_format($row_pag['monto'],2,'.','')."/".number_format($row_pag['tcambio'],4);
							$monto=number_format($row_pag['monto'],2,'.','')/number_format($row_pag['tcambio'],4,'.','');
							break;
						case '02':
							$monto=number_format($row_pag['monto'],2,'.','')*number_format($row_pag['tcambio'],2,'.','');
							break;
					}
				}else{
					$monto=number_format($row_pag['monto'],2,'.','');
				}
				switch($row_pag['tipo']){
					case 'A':
						$abo=number_format($abo,2,'.','')+number_format($monto,2,'.','');
						break;
					case 'C':
						$car=number_format($car,2,'.','')+number_format($monto,2,'.','');
						break;
				}
			}
			//$saldo=$row['deuda'];
			$saldo=(number_format($row_doc['total'],2,'.','')+number_format($car,2,'.',''))-number_format($abo,2,'.','');
			
			if($row['cod_ope']=="A"){
			?>
            <tr>
            <td colspan="8" style="letter-spacing:12px; color:#F00; font-size:28px; font-style:normal; text-align:center">ANULADO</td>
            </tr>
            <?php }else{
			?>
                  <tr>
                    <td height="19" align="center"><img src="../imagenes/ico_lupa.png" width="15" height="15" onClick="doc_det('<?php echo $row['cod_cab'];?>')"></td>
                    <td align="center"><span class="EstiloDetPagos"><?php echo $row['cod_ope']?></span></td>
                    <td align="center"><span class="EstiloDetPagos">
					<?php 
					if($row['cod_let']!="0"){
						echo $row['numeroDoc'];
					}else{
						echo $row['serie']." - ".$row['numeroDoc'];
					}
					?></span></td>
                    <td align="center"><span class="EstiloDetPagos">
                      <?php 
				  
				  if($row['mon_doc']=='01')echo "S/."; else echo "US$.";
				  
				  if($row['mon_doc']==$row['mon_ac']){
				  
				  $montoProg=$row['acuenta'];
				  
				  }else{
				  
					  if($row['mon_doc']=='01'){
					  $montoProg=$row['acuenta']*$row['tc'];
					  }else{
					  $montoProg=number_format($row['acuenta']/$row['tc'],2,".","");
					  }
				  
				  }
				  
				  $saldof=$saldo-$montoProg;
				  ?>
                    </span></td>
                    <td align="right"><span class="EstiloDetPagos"><?php echo number_format($row['deuda'],2)?></span></td>
                    <td align="right"><span class="EstiloDetPagos"><?php echo number_format($saldo,2);
					//number_format($row['deuda'],2);?></span></td>
                    <td align="right"><span class="EstiloDetPagos"><?php 
					if($row['estado']=="A"){
						echo "----------------";
					}else{
						echo number_format($montoProg,2);
					}?></span></td>
                    <td align="right"><span class="EstiloDetPagos"><?php echo number_format($saldof,2)?></span></td>
                  </tr>
                  <?php 
				
				$i++; 
				} 
			}
				?>
                </table>
			  </div>			  </td>
            </tr>
          </table>
      </fieldset>
       </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>

<div id="auxiliares" style="position:absolute; left:82px; top:171px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>
  <div id="productos" style="position:absolute; left:22px; top:192px; width:300px; height:180px; z-index:1; visibility:hidden"> </div>

</body>
</html>

<script>

var temp_busqueda2="razonsocial";
function validartecla(e,valor,temp){

	var tipomov=document.form1.tipomov.value;
	document.form1.tempauxprod.value=temp;
	
		if(document.getElementById('auxiliares').style.visibility=='visible'){
		temp_busqueda2=document.formauxiliar.busqueda2.value;
	
		}
	
	var lentexto=document.form1.cliente.value.length;

	if(lentexto>=1){
	
	if ( ( (e.keyCode>=96) && (e.keyCode<=105) || (e.keyCode>=48) && (e.keyCode<=57) )  || ((e.keyCode>=65) && (e.keyCode<=90)) || e.keyCode==8 || e.keyCode==32 ) {
	

		
		
		if(document.getElementById(temp).style.visibility!='visible' ){
	
			doAjax('../lista_aux_3.php','&temp='+temp+'&tipomov='+tipomov+'&modulo=tranf&pagoprov','listaprod','get','0','1','','');
		
		}else{
			var valor="";
			var temp_criterio;
			if(document.form1.tempauxprod.value=='auxiliares'){
			valor=document.form1.cliente.value;
			temp_criterio=temp_busqueda2;
		
			}
	
			var temp=document.form1.tempauxprod.value;
			var tipomov=document.form1.tipomov.value;
	
			
			
		doAjax('../det_aux_3.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&criterio='+temp_criterio,'detalle_prod','get','0','1','','');
		
	//	doAjax('det_aux_3.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc='+document.formulario.prov_asoc.value+'&moneda_doc='+moneda_doc,'detalle_prod','get','0','1','','');
		 //alert('entro');
		}
		
		
	}
}else{
salir();
}
}

 
function listaprod(texto){

	var r = texto;
	var valor="";
	var temp_criterio='';
	
	if(document.form1.tempauxprod.value=='auxiliares'){
	document.getElementById('auxiliares').innerHTML=r;
	document.getElementById('auxiliares').style.visibility='visible';

	
	valor=document.form1.cliente.value; 
	  // alert(temp_busqueda2);
	temp_criterio=temp_busqueda2;
	selec_busq2();
	}
	
	
	var temp=document.form1.tempauxprod.value;
	var tipomov=document.form1.tipomov.value;
	var tienda;//=document.forms[0].almacen.value;
	var moneda_doc;//=document.forms[0].tmoneda.value;
	//document.formulario.prov_asoc.value
	//alert(temp_criterio);
	doAjax('../det_aux_3.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc=&moneda_doc='+moneda_doc,'detalle_prod','get','0','1','','');
				//doAjax('det_aux.php','&clasificacion=1&temp=auxiliares&tipomov='+document.formulario.tipomov.value+'&prov_asoc='+texto,'detalle_prod','get','0','1','','');
	
}		
	
function detalle_prod(texto){

	var r = texto;
	if(document.forms[0].tempauxprod.value=='auxiliares'){
	document.getElementById('detalle1').innerHTML=r;
	document.getElementById('tblproductos1').rows[0].style.background='#fff1bb';
	}
	if(document.forms[0].tempauxprod.value=='productos'){
	document.getElementById('detalle').innerHTML=r;
	document.getElementById('tblproductos').rows[0].style.background='#fff1bb';
	}

}

jQuery(document).bind('keyup', 'up',function (evt){jQuery('#_up').addClass('dirty');

	/*
	if(document.getElementById('auxiliares').style.visibility=='visible'){
	
		for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
		
			if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' || document.getElementById('tblproductos1').rows[i].style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' && (i!=0) ){
				document.getElementById('tblproductos1').rows[i].style.background=document.getElementById('tblproductos1').rows[i].bgColor;
				document.getElementById('tblproductos1').rows[i-1].style.background='#FFF1BB';
				location.href="#ancla"+(i-1);
				document.form1.cliente.focus();
				if(i%4==0 && i!=0){}
				break;
			}

		}
	
	}
**/
//alert();
if(document.getElementById('auxiliares').style.visibility=='visible'){
	
	for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
//	alert(document.getElementById('tblproductos').rows.length);
		if((document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' || document.getElementById('tblproductos1').rows[i].style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || document.getElementById('tblproductos1').rows[i].style.background=='rgb(255, 241, 187)') && (i!=0) ){
		document.getElementById('tblproductos1').rows[i].style.background=document.getElementById('tblproductos1').rows[i].bgColor;
		document.getElementById('tblproductos1').rows[i-1].style.background='#FFF1BB';
		
		//tempColor=document.getElementById('tblproductos1').rows[i-1];
			
			location.href="#ancla"+(i-1);
			document.form1.cliente.focus();
			
			if(i%4==0 && i!=0){
			//	capa_desplazar = $('detalle1');
		//	capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y - 60);
			}
			break;
		}
	  }
   }
      

	
	return false; 
});

 jQuery(document).bind('keyup', 'down',function (evt){jQuery('#_down').addClass('dirty');

	/*
	if(document.getElementById('auxiliares').style.visibility=='visible'){
 //alert('entro');
	for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
			
		//	alert(document.getElementById('tblproductos').rows.length);
			if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' || document.getElementById('tblproductos1').rows[i].style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' && (i!=document.getElementById('tblproductos1').rows.length-1)){
			//alert(document.getElementById('TablaDatos').rows[i].style.background);
			document.getElementById('tblproductos1').rows[i].style.background=document.getElementById('tblproductos1').rows[i].bgColor;
			document.getElementById('tblproductos1').rows[i+1].style.background='#FFF1BB';
			
			if(i%4==0 && i!=0){
			
			location.href="#ancla"+i;
			document.form1.cliente.focus();
			//capa_desplazar = $('detalle1');
			//capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y + 60);
			}
			
			break;
				
			}
		}
 	}
	*/
	if(document.getElementById('auxiliares').style.visibility=='visible'){
 //alert('entro');
	for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
			
		//	alert(document.getElementById('tblproductos').rows.length);
			if((document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' || document.getElementById('tblproductos1').rows[i].style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || document.getElementById('tblproductos1').rows[i].style.background=='rgb(255, 241, 187)') && (i!=document.getElementById('tblproductos1').rows.length-1)){
			//alert(document.getElementById('TablaDatos').rows[i].style.background);
			document.getElementById('tblproductos1').rows[i].style.background=document.getElementById('tblproductos1').rows[i].bgColor;
			document.getElementById('tblproductos1').rows[i+1].style.background='#FFF1BB';
			//tempColor=document.getElementById('tblproductos1').rows[i+1];
			
			if(i%4==0 && i!=0){
			
			location.href="#ancla"+i;
			document.form1.cliente.focus();
			//capa_desplazar = $('detalle1');
			//capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y + 60);
			}
			
			break;

				
			}
		}
 	}
	
 return false; });
 
 jQuery(document).bind('keydown', 'return',function (evt){jQuery('#_return').addClass('dirty'); 


/*
	   if(document.getElementById('auxiliares').style.visibility=='visible'){

		for (var i=0 ; i < document.getElementById('tblproductos1').rows.length ; i++) { 

		if( document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb' || document.getElementById('tblproductos1').rows[i].style.background == 'none repeat scroll 0% 0% rgb(255, 241, 187)'){

		if(navigator.appName == 'Microsoft Internet Explorer'){
			var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
			var temp1=document.getElementById('tblproductos1').rows[i].cells[1].childNodes[0].innerHTML;
			var ruc=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[0].childNodes[0].childNodes[0].childNodes[0].innerHTML;
		}else{

			var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[1].childNodes[1].innerHTML
			var temp1=document.getElementById('tblproductos1').rows[i].cells[1].childNodes[0].innerHTML;
			var ruc=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[1].childNodes[1].childNodes[0].childNodes[1].childNodes[0].innerHTML;
		}
			 temp1=temp1.replace('&amp;','&');
			
			 elegir2(temp,temp1);
			 //}		  
			}
		 }
	   }
	   
	  */ 
	///-----------------------------------------------------------------------
//alert(document.getElementById('auxiliares').style.visibility);	
	if(document.getElementById('auxiliares').style.visibility=='visible'){

		for (var i=0;i<document.getElementById('tblproductos1').rows.length;i++) { 
		
			if(document.getElementById('tblproductos1').rows[i].style.background=='#fff1bb'  || document.getElementById('tblproductos1').rows[i].style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || document.getElementById('tblproductos1').rows[i].style.background=='rgb(255, 241, 187)' ){
			   if(navigator.appName!='Microsoft Internet Explorer'){
	    var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[1].childNodes[1].innerHTML;
		var temp1=document.getElementById('tblproductos1').rows[i].cells[1].childNodes[0].innerHTML;
		var ruc=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[1].childNodes[1].childNodes[0].childNodes[1].childNodes[0].innerHTML;
		        }else{								
		var temp=document.getElementById('tblproductos1').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
		var temp1=document.getElementById('tblproductos1').rows[i].cells[1].childNodes[0].innerHTML;
		var ruc=document.getElementById('tblproductos1').rows[i].cells[2].childNodes[0].childNodes[0].childNodes[0].childNodes[0].innerHTML;
				}
				
			 temp1=temp1.replace('&amp;','&');
			 //alert(temp+" "+temp1);
			 elegir2(temp,temp1);
			
			}
		 }
	   }
	
			
return false; });
function elegir2(cod,des){
//razon.replace('&','amps')
des=des.replace('amps','&');
document.form1.cliente.value=des;
document.form1.cliente2.value=cod;
document.getElementById('auxiliares').style.visibility='hidden';
document.form1.importe.focus();
}

jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_esc').addClass('dirty'); 

//document.formulario.codprod.focus();
//alert("escape");
salir();
		
return false; });

function salir(){

	if (document.getElementById('docincluir').style.visibility=='visible'){
	document.getElementById('docincluir').style.visibility='hidden';
	}else
	document.getElementById('auxiliares').style.visibility='hidden';
	
}

function selec_busq2(){
	
	 var valor1=temp_busqueda2;

 
     var i;

	for (i=0;i<document.formauxiliar.busqueda2.options.length;i++)

        {
			
            if (document.formauxiliar.busqueda2.options[i].value==valor1)
               {
			   document.formauxiliar.busqueda2.options[i].selected=true;
               }
        
        }
	
	}

function cuentasDeudas(){

    document.form1.importe.disabled=true;
	
	document.form1.importe2.value=document.form1.importe.value;
	
	var sucursal=document.form1.sucursal.value;
	var fecha1=document.form1.fecha1.value;
	var proveedor=document.form1.cliente2.value;
	var monedaCuenta=document.form1.monedaCuenta.value;
	var tcambioProg=document.form1.tcambioProg.value;
	
	doAjax('../peticion_ajax5.php','&sucursal='+sucursal+"&fecha1="+fecha1+"&peticion=cuentasDeudas&proveedor="+proveedor+"&monedaCuenta="+monedaCuenta+"&tcambioProg="+tcambioProg,'rspta_cuentasDeudas','get','0','1','','');

}

function rspta_cuentasDeudas(data){

//document.getElementById('lista_cuentasDeudas').style.visibility='hidden';
document.getElementById('lista_cuentasDeudas').innerHTML=data;

}

var temp=0;

function cancelar(obj,saldo,pos){
//alert(temp);
	if(temp>0){
		if( (temp-saldo) >= 0){
		document.form1.acuenta[pos].value=parseFloat(saldo).toFixed(2);
		document.form1.saldo[pos].value=0.00;
		temp=temp-parseFloat(saldo);
			obj.parentNode.parentNode.parentNode.style.background="#fff1bb";		
		}else{
		document.form1.acuenta[pos].value=temp.toFixed(2);
		document.form1.saldo[pos].value=parseFloat(saldo)-temp;	
		    obj.parentNode.parentNode.parentNode.style.background="#fff1bb";
		temp=0;
		}
	}else{
	alert("No tiene saldo para cancelar");
	}

}

function descancelar(obj,saldo,pos){
				
		if(parseFloat(document.form1.acuenta[pos].value)>0){
		temp=temp+parseFloat(document.form1.acuenta[pos].value);
		document.form1.acuenta[pos].value=0.00;
		document.form1.saldo[pos].value=0.00;
		obj.parentNode.parentNode.parentNode.style.background="";	
		}

}

function activar(e){
	if(e.keyCode==13 && document.form1.importe.value!=''){
	document.form1.Submit.disabled=false;	
	}
}

function cambiar_cuenta(control){

	if(this.value!=0){
	
	var temp=document.form1.banco.value.split("-");
	document.form1.monedaCuenta.value=temp[1];
	}

}

function doc_det(valor){

window.open("../doc_det2.php?referencia="+valor,"","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=720, height=520,left=300 top=250");

}


</script>
