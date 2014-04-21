<?php 
session_start();
include('conex_inicial.php');
include('funciones.php');

$tipo=$_REQUEST["tipo"];

if($tipo=='1'){
$titu="Log&iacute;stica :: Relación de Documentos de Compras";
//$dis="style='display:inline'";
}else{
$titu="Ventas :: Relación de Documentos de Ventas";
//$dis="style='display:none'";
}
$cod_user=$_SESSION["codvendedor"];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>

<style type="text/css">
<!--
.Estilo17 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #003366; }
.Estilo36 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color:#003366; font-weight: bold; }
.Estilo15 {color:#FFFFFF}
-->
</style>

    <script src="jquery-1.2.6.js"></script>
    <script src="jquery.hotkeys.js"></script>
	<script src="js/funciones_reportes.js"></script>
<script>
var user_tienda="<?php echo $_SESSION['user_tienda'] ?>";
var user_sucursal="<?php echo $_SESSION['user_sucursal'] ?>";

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
 
 jQuery(document).bind('keyup', 'return',function (evt){jQuery('#_return').addClass('dirty'); 

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
}

jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_esc').addClass('dirty'); 

//document.formulario.codprod.focus();
//alert("escape");
salir();
		
return false; });

// SE GUARDAN LOS DATOS
	function Guarda(){
	var temp1=0;
	var docRk ='';
	
	for(var i=0;i<document.form1.Ingresos.length;i++){	
		if(document.form1.Ingresos[i].checked){
		docRk+=document.form1.Ingresos[i].value+',';
		temp1=1;
		}		
	}
//alert(docRk);
			
	if(temp1==0){
	alert('Seleccione Documento');
	return false
	}
	var tipo=document.form1.tipo.value;
	if(tipo==1){
	var rep="REGISTRO_COMPRAS";
	}else{
	var rep="REGISTRO_VENTAS";
	}
    //if(confirm("Seguro de Aceptar configuración")){
	//alert(docRk+" "+rep);
			//document.form1.carga.value="S";
			doAjax('reportes/documentos.php','&docRk='+docRk+"&reporte="+rep,'tempk','get','0','1','','');
			//document.getElementById('docincluir').style.visibility='hidden';
	//}
}

function tempk(data){
//alert(data);

}

function salir(){

	if (document.getElementById('docincluir').style.visibility=='visible'){
	document.getElementById('docincluir').style.visibility='hidden';
	}else
	document.getElementById('auxiliares').style.visibility='hidden';
	
}

function validartecla2(e,valor,temp){
	if(document.getElementById(temp).style.visibility!='visible' ){
		//temp_busqueda2=document.form1.busqueda2.value;
		//alert(temp_busqueda2);
	document.form1.carga.value="S";
	var tipo=document.form1.tipo.value;
	if(tipo==1){
	var rep="REGISTRO_COMPRAS";
	}else{
	var rep="REGISTRO_VENTAS";
	}
doAjax('reportes/documentos.php','&temp='+temp+'&tipo='+tipo+"&reporte="+rep,'listadocumentos','get','0','1','','');
	
	}
}
function listadocumentos(texto){
	var r = texto;
	document.getElementById('docincluir').innerHTML=r;
	//document.getElementById('docincluir').rows[0].style.background='#fff1bb';
	document.getElementById('docincluir').style.visibility='visible';

}

function marcar(){
	
	if(document.form1.GrupoOpciones1[0].checked){
		for(var i=0;i<document.form1.Ingresos.length;i++){
		document.form1.Ingresos[i].checked=true;
		}	
	}else{
			for(var i=0;i<document.form1.Ingresos.length;i++){
			document.form1.Ingresos[i].checked=false;
			}		
	}
}
 </script>
</head>

<link href="styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-image: url(imagenes/bg3.jpg);
}
.Estilo19 {font-family: Arial, Helvetica, sans-serif}
.Estilo24 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo27 {color: #333333}
.Estilo30 {font-family: Verdana, Arial, Helvetica, sans-serif; color: #003366;}
.Estilo31 {font-size: 10px}
.Estilo10 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
.anulado  {text-decoration:line-through;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#990000; }
.Estilo100 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
.Estilo102 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #003366;
	font-weight: bold;
	font-size: 10px;
}
.Estilo104 {font-size: 10px; font-weight: bold; }

-->
</style>

<link rel="stylesheet" type="text/css" media="all" href="calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="calendario/calendar.js"></script>
<script type="text/javascript" src="calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendario/calendar-setup.js"></script>

<script language="javascript" src="miAJAXlib2.js"></script>

<script>

function iniciar(){

	if( (user_tienda.length==3 || user_sucursal!="0") && user_tienda!=0 ){
	//alert();
		seleccionar_cbo('sucursal',user_sucursal);
		doAjax('carga_cbo_tienda.php','&codsuc='+document.form1.sucursal.value,'cargar_cbo3','get','0','1','','')
	}
}
function cargar_cbo3(r){

    document.getElementById('cbo_tienda').innerHTML=r;
	
		
	if(user_tienda.length==3){
		seleccionar_cbo('almacen',user_tienda);
		//cargar_detalle('');
	}
		
		
}

function seleccionar_cbo(control,valor){
		
		 var valor1=valor;
         var i;
		// alert(valor1+" "+control);
	     for (i=0;i< eval("document.form1."+control+".options.length");i++)
        {
		//alert(eval("document.formulario."+control+".options[i].value")+" "+valor1);
         if (eval("document.form1."+control+".options[i].value=='"+valor1+"'"))
            {
		//	alert("entro");
			   eval("document.form1."+control+".options[i].selected=true");
            }
        
        }
		
		
		document.form1.sucursal.disabled=true;
		document.form1.almacen.disabled=true;
}

</script>

<body onLoad="iniciar()">

<form name="form1" id="form1" method="post" action="listado_reporte_pdf.php" target="_blank">
<input type="hidden" name="empresa_recuperada" id="empresa_recuperada" value="">
<input type="hidden" name="tienda_recuperada" id="tienda_recuperada" value=""> 
<input type="hidden" name="name_empresa" id="name_empresa" value="">

      <table width="791" border="0" cellpadding="0" cellspacing="0">
        <tr style="background:url(imagenes/white-top-bottom.gif)">
          <td width="791" height="21" colspan="6" align="left" style="border:#999999"><span class="Estilo100"><?php echo $titu; ?>
            <input type="hidden" name="tipo" id="tipo" value="<?php echo $tipo?>">
            <span class="Estilo36">
            <input type="hidden" name="carga" id="carga" value="S">
			<input name="tempauxprod"  type="hidden" value="auxiliares" size="15" />
            <span class="Estilo14 Estilo38">
            <input name="tipomov"  type="hidden" value="<?php echo $tipo; ?>" />
			<input name="cod_user" id="cod_user" type="hidden" value="<?php echo $cod_user; ?>" />
          </span></span></span></td>
        </tr>
        <tr >
          <td  colspan="6" align="left">
		  
		  <table width="788" border="0" cellpadding="0" cellspacing="0"  style="border:#CCCCCC solid 1px; padding-left:5px ">
            <tr>
              <td width="786"  align="left" valign="top">
			  
			  <table width="783" border="0" cellpadding="0" cellspacing="0">
                
                <tr style="background:url(../imagenes/botones.gif);">
                  <td width="153" rowspan="2">
				  
				  <table width="123" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="23">Del:                              </td>
                      <td width="76"><input  name="fecha" type="text" id="fecha" size="10"   maxlength="10" value="<?php if(isset($_REQUEST['fecha'])){echo $_REQUEST['fecha'];}else{ echo date('d-m-Y',time()-3600);} ?>"></td>
                      <td width="24"><button type="reset" id="f_trigger_b2" style="height:20px" >...</button>
                        <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b2",   
        singleClick    :    true,           
        step           :    1                
    });
                        </script></td>
                    </tr>
                    <tr>
                      <td>Al:                      </td>
                      <td><input  name="fecha2" type="text" id="fecha2" size="10"   maxlength="10" value="<?php if(isset($_REQUEST['fecha2'])){echo $_REQUEST['fecha2'];}else{ echo date('d-m-Y',time()-3600);} ?>"></td>
                      <td><button type="reset" id="f_trigger_b3" style="height:20px" >...</button>
                          <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha2",      
        ifFormat       :    "%d-%m-%Y",      
        showsTime      :    true,            
        button         :    "f_trigger_b3",   
        singleClick    :    true,           
        step           :    1                
    });
                        </script></td>
                    </tr>
                  </table>				  </td>
                  <td width="56" height="25" align="left"><span class="Estilo17 text5 text5 Estilo19 Estilo27 Estilo31"><span class="text5 text5 Estilo19 Estilo27 Estilo31  Estilo30"><span class="Estilo24">Empresa
                    
                  </span></span></span></td>
                  <td width="160" align="left"><span class="Estilo17 text5 text5 Estilo19 Estilo27 Estilo31"><span class="text5 text5 Estilo19 Estilo27 Estilo31  Estilo30"><span class="Estilo24">
                    <select style="width:160" id="sucursal" name="sucursal" onChange="doAjax('carga_cbo_tienda.php','&kardex=s&codsuc='+document.form1.sucursal.value,'cargar_cbo','get','0','1','','')" >
                      <option value="0">Todos</option>
                      <?php 
		
		 $resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn);
		 
		  
		while($row1=mysql_fetch_array($resultados1))
		{
		?>
                      <option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
                      <?php }?>
					  
					<script>
			 var valor1="<?php echo $_REQUEST['sucursal']?>";			
			 var i;
	 for (i=0;i<document.form1.sucursal.options.length;i++)
        {
		
            if (document.form1.sucursal.options[i].value==valor1)
               {
			   
               document.form1.sucursal.options[i].selected=true;
               }
        
        }
			      </script>                    
                    </select>
                  </span></span></span></td>
                  <td width="55" align="left"><span class="Estilo17 text5 text5 Estilo19 Estilo27 Estilo31"><span class="text5 text5 Estilo19 Estilo27 Estilo31  Estilo30"><span class="Estilo24">Vendedor</span></span></span></td>
                  <td width="120">                  <select style="width:120" name="vendedor" id="vendedor">
                    <option value="000">------ Todos ------</option>
                    <?php 
			$strSQL="select * from usuarios where codigo >=002";
			$resultado=mysql_query($strSQL,$cn);
			while($row=mysql_fetch_array($resultado)){
			
			?>
                    <option value="<?php echo $row['codigo']?>"><?php echo $row['usuario']?></option>
                    <?php 
			
			}?>
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
                  </select></td>
                  <td width="42">                <span class="Estilo17 text5 text5 Estilo19 Estilo27 Estilo31"><span class="text5 text5 Estilo19 Estilo27 Estilo31  Estilo30"><span class="Estilo24">Caja</span></span></span></td>
                  <td width="120"><select name="serie" id="serie" style="width:120">
                    <option value="000">------ Todos -------</option>
                    <?php 
			$strSQL="select * from caja";
			$resultado=mysql_query($strSQL,$cn);
			while($row=mysql_fetch_array($resultado)){
			
			?>
                    <option value="<?php echo $row['codigo']?>"><?php echo $row['descripcion']?></option>
                    <?php }?>
					
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
					
                  </select></td>
                  <td width="89"><input onClick="validartecla2(event,this,'docincluir')"  name="btnInc" type="button" id="btnInc" value="Documentos" /></td>
                </tr>
                <tr>
                  <td  align="left"><span class="Estilo17 text5 text5 Estilo19 Estilo27 Estilo31"><span class="text5 text5 Estilo19 Estilo27 Estilo31  Estilo30"><span class="Estilo24">Tienda</span></span></span></td>
                  <td align="left">
				  <div id="cbo_tienda">
				  <select  style="width:160" name="almacen" id="almacen" onBlur="">
                    <option value="0">Todos</option>
                  </select>
				  </div>				  </td>
                  <td align="left"><span class="Estilo17 text5 text5 Estilo19 Estilo27 Estilo31"><span class="text5 text5 Estilo19 Estilo27 Estilo31  Estilo30"><span class="Estilo24">Turno</span></span></span></td>
                  <td><select name="turno" id="turno" style="width:120">
                    <option value="0">------ Todos -------</option>
                    <option value="1">Turno 1</option>
                    <option value="2">Turno 2</option>
					
					<script>
			 var valor1="<?php echo $_REQUEST['turno']?>";
     var i;
	 for (i=0;i<document.form1.turno.options.length;i++)
        {
		
            if (document.form1.turno.options[i].value==valor1)
               {
			   
               document.form1.turno.options[i].selected=true;
               }
        
        }
			
			      </script>
					
                  </select></td>
                  <td ><span class="Estilo102">Cond.</span></td>
                  <td align="left" ><span class="Estilo15">
                    <select name="condicion" id="condicion" style="width:120" >
					<option value="0">------ Todos -------</option>
                      <?php 
		    $resultados11 = mysql_query("select * from condicion order by nombre ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
		  ?>
                      <option value="<?php echo $row11['codigo']?>"><?php echo caracteres($row11['nombre']);?></option>
                      <?php }?>
                    </select>
                  </span></td>
                  <td width="89"><input onClick="cargar_detalle('')" style="width:70px; cursor:pointer" type="button" name="Submit" value="Procesar" ></td>
                </tr>
                <tr>
                  <td  height="20px" rowspan="2"  valign="top">				  
				    <?php if($tipo==1){ ?>
				    <table border="0"><tr>
                      <td>
					  <input type="radio" name="fec" id="fec" value="fecha" checked="checked">&nbsp;F.Emi.
					  <input type="radio" name="fec" id="fec" value="fecharegis">&nbsp;F.Reg.</td>
                    </tr></table>
					<?php }else{?>
					
					<input type="checkbox" name="listapercep" id="listapercep" value="" style="background:none; border:none">
					
					<span class="Estilo104">Docs. con Percepci&oacute;n</span>
				  <?php }?>				  </td>
                  <td  align="left" valign="middle"><span class="Estilo17 text5 text5 Estilo19 Estilo27 Estilo31"><span class="text5 text5 Estilo19 Estilo27 Estilo31  Estilo30"><span class="Estilo24"><?php if($tipo==2){echo "Cliente:";}else{echo "Proveedor:";}?></span></span></span></td>
                  <td colspan="2" align="left" valign="top"><label>
                  <input autocomplete="off" name="cliente" id="cliente" type="text" size="25" maxlength="50" onKeyUp="validartecla(event,this,'auxiliares')">
                  <input name="cliente2" type="hidden" size="3"  value=""/></label></td>
                  <td colspan="3" rowspan="2" valign="top">
				  				  <input name="agrp" type="radio" id="agrp"  style="border: 0px; background-color:#F9F9F9; " value="v_normal" checked >
                    <span class="Estilo31"><strong> V. normal </strong></span>
	                <input  style="border: 0px; background-color:#F9F9F9; " type="radio" name="agrp" id="agrp" value="ag_dia" >
                    <span class="Estilo31"><strong> Agrupar x Dia </strong></span>
                    <input  style="border: 0px; background-color:#F9F9F9; " type="radio" name="agrp" id="agrp" value="ag_doc" >
                    <span class="Estilo31"><strong> Agrupar x Doc. </strong></span>				  </td>
                  <td colspan="2" rowspan="2" align="center" valign="top">&nbsp; <img style="cursor:pointer" onClick="enviar_excel2('');" src="imagenes/ico-excel.gif" width="20" height="20" alt="Exportar a excel" title="Exportar a excel">
<img style="cursor:pointer" onClick="cargar_pdf();" src="imagenes/pdfico.jpg" width="20" height="20" alt="Exportar a pdf" title="Exportar a pdf"> </td>
			    </tr>
                <tr>
                  <td  align="left" valign="middle"> <?php if($_SESSION['zonas']=='S'){ ?><span class="Estilo17 text5 text5 Estilo19 Estilo27 Estilo31"><span class="text5 text5 Estilo19 Estilo27 Estilo31  Estilo30"><span class="Estilo24">Zona :</span></span></span> <?php } ?></td>
                  <td colspan="2" align="left" valign="top"> <?php if($_SESSION['zonas']=='S'){ ?>
				  <select name="tZonas" style="width:200px" >
					<?php
					$resultados11 = mysql_query("select * from zonas order by codigo ",$cn); 
					while($row11=mysql_fetch_array($resultados11)){
					?>
						<option <?php echo $se; ?> value="<?php echo $row11['codigo']; ?>"><?php echo $row11['codigo']."-".$row11['zona'];?></option>
					<?php
                    }
					?></select>
                    <?php } ?></td>
                </tr>
                <tr>
                  <td height="19" valign="top"><input type="checkbox" name="sinreferencia" id="sinreferencia" value="" style="background:none; border:none">
                  <span class="Estilo104">Docs. sin Referencia </span></td>
                  <td colspan="3"  align="left" valign="top">
				   <?php if($tipo==2){ ?>
				  <input type="checkbox" name="soloanul" id="soloanul" value="" style="background:none; border:none">
                    <span class="Estilo104">Solo Anulados</span>
					<?php } ?>					<input type="checkbox" name="chkantes" id="chkantes" value="" style="background:none; border:none">
                    <span class="Estilo104">Formato Contable</span></td>
                  <td colspan="5" valign="top">&nbsp; <span class="Estilo104">N&uacute;mero Doc :
                      <input name="serieDoc" type="text" size="3" maxlength="3">
                    <input name="numeroDoc" type="text" size="7" maxlength="7">
                    </span></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        
        <tr>
          <td height="258" colspan="6" valign="top">
		  <div id="detalle" style="width:790px; height:310px; overflow:scroll">
   		     
		  </div>
		  
		  
		  </td>
        </tr>
        <tr>
          <td  colspan="6" valign="top">
		   <div id="paginacion" style="width:760px; height:20px;">
		 	     
		  </div>
		  
		  </td>
        </tr>
  </table>
      <div id="docincluir" style="position:absolute; left:470px; top:113px; width:302px; height:180px; z-index:2; visibility:hidden"> </div>    
</form>

    <div id="auxiliares" style="position:absolute; left:274px; top:90px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>
  <div id="productos" style="position:absolute; left:22px; top:192px; width:300px; height:180px; z-index:1; visibility:hidden"> </div>

</body>
</html>

<script>

function doc_det(valor){

window.open("doc_det2.php?referencia="+valor,"","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=320,left=300 top=250");

}

function entrada(objeto){
//document.getElementById('prueba').value=objeto.style.background;
//alert(objeto.style.background);

	if(objeto.style.background=='#fff1bb'){
//	alert('rrr');
	objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='#FFF1BB';
	
	}
//document.getElementById('prueba').value=objeto.style.background;
//est=0;
}


function cargar_cbo(texto){
var r = texto;
document.getElementById('cbo_tienda').innerHTML=r;
//document.form1.almacen.focus();
}

function enfocar_cbo(x){
}

function limpiar_enfoque(x){
}
function cambiar_enfoque(x){
}

/*
function enviar_excel(){

document.form1.action="reporte_venta4_excel.php";
document.form1.target="_blank";
document.form1.submit();
document.form1.action="";
document.form1.target="";

}
*/
function cargar_detalle(pagina){

var fecha=document.form1.fecha.value;
var fecha2=document.form1.fecha2.value;
//var fecha3=document.form1.fecha3.value;
var sucursal=document.form1.sucursal.value;
var almacen= document.form1.almacen.value;


var vendedor=document.form1.vendedor.value;
var turno=document.form1.turno.value;
var serie=document.form1.serie.value;
var condicion=document.form1.condicion.value;


    var agdoc = document.getElementsByName("agrp");
	for (var i=0; i < agdoc.length; i++) {
	
		if (agdoc[i].checked) {
			var ag_doc=agdoc[i].value;
		}
	}



var tipo=document.form1.tipo.value;
var cod_user=document.form1.cod_user.value;
if(document.form1.cliente.value!=''){
var cliente=document.form1.cliente2.value ;
}else{
var cliente="" ;
}
if(tipo=='1'){
	var fec = document.getElementsByName("fec");
	for (var i=0; i < fec.length; i++) {
	
		if (fec[i].checked) {
			var fecha3=fec[i].value;
		}
	}
}else{
	var fecha3='';
}

//alert(document.form1.listapercep.checked);
	if(document.form1.listapercep==undefined){
	var percepcion='N';
	var soloanul='N';
	
	}else{
	    if(tipo=='2'){
			if(document.form1.listapercep.checked){
			var percepcion='S';
			}else{
			var percepcion='N';
			}
			
			if(document.form1.soloanul.checked){
			var soloanul='S';
			}else{
			var soloanul='N';
			}
			
		}
	}
	
	if(document.form1.sinreferencia.checked){
	var sinreferencia="S";
	}else{
	var sinreferencia="N";
	}
	
	var archivo="";
	
	
	if(document.form1.chkantes.checked){
		archivo="det_rpt4.php";
	}else{
		//archivo="det_rpt4PF.php";
		//archivo="formatos/reportes_pdf/redoc.php";
		archivo="det_rpt4PF.php";
	}
	
	
	//alert(archivo);
	var serieDoc=document.form1.serieDoc.value;
	var numeroDoc=document.form1.numeroDoc.value;
	
	
	if((serieDoc=='' && numeroDoc!='') || (serieDoc!='' && numeroDoc=='') ){
	
	alert("La serie o número de documento no han sido ingresados ");
		
		if(serieDoc==''){
		document.form1.serieDoc.focus();
		document.form1.serieDoc.select();
		}else{
		document.form1.numeroDoc.focus();
		document.form1.numeroDoc.select();
		}
		
		return false;
	}

	
	//if(pagina=='X'){
	//alert(archivo);
		doAjax(archivo,'fecha='+fecha+'&fecha2='+fecha2+'&fecha3='+fecha3+'&sucursal='+sucursal+'&almacen='+almacen+'&vendedor='+vendedor+'&turno='+turno+'&serie='+serie+'&agdoc='+ag_doc+'&tipo='+tipo+'&cliente='+cliente+'&pagina='+pagina+'&coduser='+cod_user+'&condicion='+condicion+'&percepcion='+percepcion+'&sinreferencia='+sinreferencia+'&soloanul='+soloanul+'&serieDoc='+serieDoc+'&numeroDoc='+numeroDoc,'view_det','get','0','1','','');

	//}else{
//doAjax('det_rpt4.php','fecha='+fecha+'&fecha2='+fecha2+'&fecha3='+fecha3+'&sucursal='+sucursal+'&almacen='+almacen+'&vendedor='+vendedor+'&turno='+turno+'&serie='+serie+'&agdoc='+ag_doc+'&tipo='+tipo+'&cliente='+cliente+'&pagina='+pagina+'&coduser='+cod_user+'&condicion='+condicion+'&percepcion='+percepcion+'&sinreferencia='+sinreferencia+'&soloanul='+soloanul,'view_det','get','0','1','','');
//	}


}

function cargar_pdf(pagina){

var fecha=document.form1.fecha.value;
var fecha2=document.form1.fecha2.value;
//var fecha3=document.form1.fecha3.value;
var sucursal=document.form1.sucursal.value;
var almacen= document.form1.almacen.value;


var vendedor=document.form1.vendedor.value;
var turno=document.form1.turno.value;
var serie=document.form1.serie.value;
var condicion=document.form1.condicion.value;


    var agdoc = document.getElementsByName("agrp");
	for (var i=0; i < agdoc.length; i++) {
	
		if (agdoc[i].checked) {
			var ag_doc=agdoc[i].value;
		}
	}



var tipo=document.form1.tipo.value;
var cod_user=document.form1.cod_user.value;
if(document.form1.cliente.value!=''){
var cliente=document.form1.cliente2.value ;
}else{
var cliente="" ;
}
if(tipo=='1'){
	var fec = document.getElementsByName("fec");
	for (var i=0; i < fec.length; i++) {
	
		if (fec[i].checked) {
			var fecha3=fec[i].value;
		}
	}
}else{
	var fecha3='';
}

//alert(document.form1.listapercep.checked);
	if(document.form1.listapercep==undefined){
	var percepcion='N';
	var soloanul='N';
	
	}else{
	    if(tipo=='2'){
			if(document.form1.listapercep.checked){
			var percepcion='S';
			}else{
			var percepcion='N';
			}
			
			if(document.form1.soloanul.checked){
			var soloanul='S';
			}else{
			var soloanul='N';
			}
			
		}
	}
	
	if(document.form1.sinreferencia.checked){
	var sinreferencia="S";
	}else{
	var sinreferencia="N";
	}
	
	var archivo="";
	
	
	archivo="formatos/reportes_pdf/redoc.php";
		
	
	var serieDoc=document.form1.serieDoc.value;
	var numeroDoc=document.form1.numeroDoc.value;
	
	
	if((serieDoc=='' && numeroDoc!='') || (serieDoc!='' && numeroDoc=='') ){
	
	alert("La serie o número de documento no han sido ingresados ");
		
		if(serieDoc==''){
		document.form1.serieDoc.focus();
		document.form1.serieDoc.select();
		}else{
		document.form1.numeroDoc.focus();
		document.form1.numeroDoc.select();
		}
		
		return false;
	}

	win00 = window.open(archivo+'?fecha='+fecha+'&fecha2='+fecha2+'&fecha3='+fecha3+'&sucursal='+sucursal+'&almacen='+almacen+'&vendedor='+vendedor+'&turno='+turno+'&serie='+serie+'&agdoc='+ag_doc+'&tipo='+tipo+'&cliente='+cliente+'&pagina='+pagina+'&coduser='+cod_user+'&excel=&percepcion='+percepcion,"","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=620, height=520,left=50 top=50");


}

function enviar_excel(pagina){
	var fecha = document.form1.fecha.value;
	var fecha2 = document.form1.fecha2.value;
	var sucursal = document.form1.sucursal.value;
	var almacen = document.form1.almacen.value;
	var vendedor = document.form1.vendedor.value;
	var turno = document.form1.turno.value;
	var serie = document.form1.serie.value;
	var cod_user = document.form1.cod_user.value;
    var agdoc = document.getElementsByName("agrp");
	for (var i=0 ; i < agdoc.length ; i++) {
		if (agdoc[i].checked) {
			var ag_doc = agdoc[i].value;
		}
	}
	var tickets = "";
	var tipo = document.form1.tipo.value;
	if(document.form1.cliente.value != ''){
		var cliente = document.form1.cliente2.value ;
	}else{
		var cliente = "" ;
	}
	if(tipo == '1'){
		var fec = document.getElementsByName("fec");
		for (var i=0 ; i < fec.length ; i++) {
			if (fec[i].checked) {
				var fecha3=fec[i].value;
			}
		}
	}else{
		var fecha3 = '';
	}
	
	if(tipo=='2'){
	
		if(document.form1.listapercep.checked){
		var percepcion='S';
		}else{
		var percepcion='N';
		}
	}

	win00 = window.open('det_rpt4.php?fecha='+fecha+'&fecha2='+fecha2+'&fecha3='+fecha3+'&sucursal='+sucursal+'&almacen='+almacen+'&vendedor='+vendedor+'&turno='+turno+'&serie='+serie+'&agdoc='+ag_doc+'&tipo='+tipo+'&cliente='+cliente+'&pagina='+pagina+'&coduser='+cod_user+'&excel=&percepcion='+percepcion,"","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=620, height=520,left=50 top=50");
}

function enviar_excel2(pagina){
	var fecha = document.form1.fecha.value;
	var fecha2 = document.form1.fecha2.value;
	var sucursal = document.form1.sucursal.value;
	var almacen = document.form1.almacen.value;
	var vendedor = document.form1.vendedor.value;
	var turno = document.form1.turno.value;
	var serie = document.form1.serie.value;
	var cod_user = document.form1.cod_user.value;
    var agdoc = document.getElementsByName("agrp");
	for (var i=0 ; i < agdoc.length ; i++) {
		if (agdoc[i].checked) {
			var ag_doc = agdoc[i].value;
		}
	}
	var tickets = "";
	var tipo = document.form1.tipo.value;
	if(document.form1.cliente.value != ''){
		var cliente = document.form1.cliente2.value ;
	}else{
		var cliente = "" ;
	}
	if(tipo == '1'){
		var fec = document.getElementsByName("fec");
		for (var i=0 ; i < fec.length ; i++) {
			if (fec[i].checked) {
				var fecha3=fec[i].value;
			}
		}
	}else{
		var fecha3 = '';
	}
	
	if(tipo=='2'){
		
		if(document.form1.listapercep.checked){
		var percepcion='S';
		}else{
		var percepcion='N';
		}
		
		
	
	}
	
	//var soloanul=docum
	
	win00 = window.open('det_rpt4PF.php?fecha='+fecha+'&fecha2='+fecha2+'&fecha3='+fecha3+'&sucursal='+sucursal+'&almacen='+almacen+'&vendedor='+vendedor+'&turno='+turno+'&serie='+serie+'&agdoc='+ag_doc+'&tipo='+tipo+'&cliente='+cliente+'&pagina='+pagina+'&coduser='+cod_user+'&excel=&percepcion='+percepcion,"","toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=620, height=520,left=50 top=50");
}


function view_det(texto){

var r = texto.split('|');
document.getElementById('detalle').innerHTML=r[0];
document.form1.carga.value='S';
document.getElementById('paginacion').innerHTML=r[1];

}
</script>
<script language="javascript">
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
	
			doAjax('lista_aux_3.php','&temp='+temp+'&tipomov='+tipomov+'&modulo=tranf','listaprod','get','0','1','','');
		
		}else{
			var valor="";
			var temp_criterio;
			if(document.form1.tempauxprod.value=='auxiliares'){
			valor=document.form1.cliente.value;
			temp_criterio=temp_busqueda2;
		
			}
	
			var temp=document.form1.tempauxprod.value;
			var tipomov=document.form1.tipomov.value;
	
			
			
		doAjax('det_aux_3.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&criterio='+temp_criterio,'detalle_prod','get','0','1','','');
		
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
	doAjax('det_aux_3.php','&clasificacion=1&nomb_det='+valor+'&temp='+temp+'&tipomov='+tipomov+'&tienda='+tienda+'&criterio='+temp_criterio+'&prov_asoc=&moneda_doc='+moneda_doc,'detalle_prod','get','0','1','','');
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
/*	
function salir(){

	document.getElementById('auxiliares').style.visibility='hidden';
	
}*/


function audita(estado,referencia){

doAjax('peticion_ajax5.php','&estado='+estado+'&referencia='+referencia+"&peticion=auditaDoc",'rspta_audita','get','0','1','','');
}

function rspta_audita(texto){
var pag=document.form1.pag.value;
cargar_detalle(pag); 

}

</script>