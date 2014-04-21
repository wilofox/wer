<?php 
include('../conex_inicial.php');
$tipo=$_REQUEST['tipo'];

if($tipo=='1'){
$titu="Estado de Cuenta Corriente - Proveedores";
}else{
$titu="Estado de Cuenta Corriente - Clientes";
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.Estilo10 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;  }
.Estilo17 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #003366; }
.Estilo32 {color: #003366}
.Estilo35 {font-size: 11px}
.Estilo36 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
-->
</style>
</head>

<link href="../styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-image: url(../imagenes/bg3.jpg);
}
.Estilo15 {color: #FFFFFF}
.Estilo19 {font-family: Arial, Helvetica, sans-serif}
.Estilo20 {
	font-size: 12px;
	font-weight: bold;
	color: #0066FF;
	font-family: Arial, Helvetica, sans-serif;
}
.Estilo21 {color: #FF6600}
.Estilo24 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo27 {color: #333333}
.Estilo30 {font-family: Verdana, Arial, Helvetica, sans-serif; color: #003366;}
.Estilo31 {font-size: 10px}
.anulado  {text-decoration:line-through;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#990000; }
.Estilo33 {color: #000066}
.Estilo34 {color: #003399}
-->
</style>

<link rel="stylesheet" type="text/css" media="all" href="calendario/Style_calenda.css" title="win2k-cold-1" />
<script type="text/javascript" src="calendario/calendar.js"></script>
<script type="text/javascript" src="calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendario/calendar-setup.js"></script>

<script language="javascript" src="miAJAXlib2.js"></script>

<body>
<form name="form1" method="post" action="">
      <table width="764" height="386" border="0" cellpadding="0" cellspacing="0">
        <tr style="background:url(imagenes/white-top-bottom.gif)">
          <td width="764" height="22" colspan="6" align="left" style="border:#999999"><span class="Estilo20"><?php echo $titu; ?>
            <input type="hidden" name="tipo" value="<?php echo $tipo?>">
            <span class="Estilo36">
            <input type="hidden" name="carga" id="carga" value="N">
          </span></span></td>
        </tr>
        <tr >
          <td height="38" colspan="6" align="left"><table width="763" border="0" cellpadding="0" cellspacing="0"  style="border:#CCCCCC solid 1px; padding-left:5px ">
            <tr>
              <td width="761" align="left" valign="top">
			  
			  <table width="752" border="0" cellpadding="0" cellspacing="0">
                
                <tr style="background:url(imagenes/botones.gif);">
                  <td width="123" rowspan="2">
				  
				  <table width="123" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="23">Del:                              </td>
                      <td width="76"><input  name="fecha" type="text" id="fecha" size="10"   maxlength="10" value="<?php if(isset($_REQUEST['fecha'])){echo $_REQUEST['fecha'];}else{ echo date('Y-m-d',time()-3600);} ?>"></td>
                      <td width="24"><button type="reset" id="f_trigger_b2" style="height:20px" >...</button>
                        <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha",      
        ifFormat       :    "%Y-%m-%d",      
        showsTime      :    true,            
        button         :    "f_trigger_b2",   
        singleClick    :    true,           
        step           :    1                
    });
                        </script></td>
                    </tr>
                    <tr>
                      <td>Al:                      </td>
                      <td><input  name="fecha2" type="text" id="fecha2" size="10"   maxlength="10" value="<?php if(isset($_REQUEST['fecha2'])){echo $_REQUEST['fecha2'];}else{ echo date('Y-m-d',time()-3600);} ?>"></td>
                      <td><button type="reset" id="f_trigger_b3" style="height:20px" >...</button>
                          <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha2",      
        ifFormat       :    "%Y-%m-%d",      
        showsTime      :    true,            
        button         :    "f_trigger_b3",   
        singleClick    :    true,           
        step           :    1                
    });
                        </script></td>
                    </tr>
                  </table></td>
                  <td width="53" height="25" align="left"><span class="Estilo17 text5 text5 Estilo19 Estilo27 Estilo31"><span class="text5 text5 Estilo19 Estilo27 Estilo31  Estilo30"><span class="Estilo24">Empresa
                    
                  </span></span></span></td>
                  <td width="162" align="left"><span class="Estilo17 text5 text5 Estilo19 Estilo27 Estilo31"><span class="text5 text5 Estilo19 Estilo27 Estilo31  Estilo30"><span class="Estilo24">
                    <select style="width:160"  name="sucursal" onChange="doAjax('carga_cbo_tienda.php','&kardex=s&codsuc='+document.form1.sucursal.value,'cargar_cbo','get','0','1','','')" >
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
                  <td width="122">                  <select style="width:120" name="vendedor">
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
                  <td width="26">                <span class="Estilo17 text5 text5 Estilo19 Estilo27 Estilo31"><span class="text5 text5 Estilo19 Estilo27 Estilo31  Estilo30"><span class="Estilo24">Caja</span></span></span></td>
                  <td width="131"><select name="serie" style="width:120">
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
                  <td width="80">
				  <input onClick="cargar_detalle('')" style="width:70px; cursor:pointer" type="button" name="Submit" value="Procesar" >				  </td>
                </tr>
                <tr>
                  <td  align="left"><span class="Estilo17 text5 text5 Estilo19 Estilo27 Estilo31"><span class="text5 text5 Estilo19 Estilo27 Estilo31  Estilo30"><span class="Estilo24">Tienda</span></span></span></td>
                  <td align="left">
				  <div id="cbo_tienda">
				  <select  style="width:160" name="almacen"  onBlur="">
                    <option value="0">Todos</option>
                  </select>
				  </div>				  </td>
                  <td align="left"><span class="Estilo17 text5 text5 Estilo19 Estilo27 Estilo31"><span class="text5 text5 Estilo19 Estilo27 Estilo31  Estilo30"><span class="Estilo24">Turno</span></span></span></td>
                  <td><select name="turno" style="width:120">
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
                  <td colspan="2">
				  
				  <?php if($tipo=='2'){?>
				  <input <?php if($_REQUEST['tickets']!=''){?> checked="checked" <?php }?> style="border: 0px; background-color:#F9F9F9; " type="checkbox" name="tickets" id="tickets" value="checkbox">
                    <span class="Estilo31"><strong> Todos los Doc. </strong></span>
					<?php }else{?>
					 <input  checked="checked"  style="border: 0px; background-color:#F9F9F9; visibility:hidden " type="checkbox" name="tickets" id="tickets" value="checkbox">
					
					<?php }?>
										</td>
                  <td width="80"><img style="cursor:pointer" onClick="enviar_excel();" src="../imagenes/ico-excel.gif" width="20" height="20"></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        
        <tr>
          <td height="258" colspan="6" valign="top">
		  <div id="detalle" style="width:760px; height:300px; overflow:scroll">
   		     
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
     
</form>
 


</body>
</html>

<script>

function doc_det(valor){

window.open("doc_det2.php?referencia="+valor,"","toolbar=no,status=no, menubar=no, scrollbars=yes, width=520, height=320,left=300 top=250");

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


function enviar_excel(){

document.form1.action="reporte_venta4_excel.php";
document.form1.target="_blank";
document.form1.submit();
document.form1.action="";
document.form1.target="";

}

function cargar_detalle(pagina){

var fecha=document.form1.fecha.value;
var fecha2=document.form1.fecha2.value;
var sucursal=document.form1.sucursal.value;
var almacen= document.form1.almacen.value;
var vendedor=document.form1.vendedor.value;
var turno=document.form1.turno.value;
var serie=document.form1.serie.value;
var tickets=document.form1.tickets.checked;
//alert(tickets);
var tipo=document.form1.tipo.value;

doAjax('det_rpt2.php','fecha='+fecha+'&fecha2='+fecha2+'&sucursal='+sucursal+'&almacen='+almacen+'&vendedor='+vendedor+'&turno='+turno+'&serie='+serie+'&tickets='+tickets+'&tipo='+tipo+'&pagina='+pagina,'view_det','get','0','1','','');

}

function view_det(texto){

var r = texto.split('?');
document.getElementById('detalle').innerHTML=r[0];
document.form1.carga.value='N';
document.getElementById('paginacion').innerHTML=r[1];

}



</script>
