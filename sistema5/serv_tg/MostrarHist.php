<?php 
include_once('../conex_inicial.php');
include_once('../funciones/funciones.php');

$pro=$_REQUEST['prod'];
$cli=$_REQUEST['clie'];
$doc=$_REQUEST['docu'];
$ser=$_REQUEST['prodser'];
$sql=mysql_query("Select * from cliente where codcliente='$cli'",$cn);
$con=mysql_fetch_array($sql);
$cliente=caracteres($con['razonsocial']);
if($cli=="todos"){
	$cliente="todos";
}

if($prod=="todos"){
	$busqueda="buscar_pag2('')";
	$busquedap="buscar_pag2";
}else{
	$busqueda="buscar_pag('')";
	$busquedap="buscar_pag";
}

$sql=mysql_query("Select * from producto where substr(nombre,1,8)='SERVICIO' ",$cn);
$comboaux="<option value='todos'>Todos</option>";
while($row=mysql_fetch_array($sql)){
	$comboaux.="<option value='".$row['idproducto']."'>".$row['nombre']."</option>";
}

$sql=mysql_query("Select * from producto where idproducto='$pro'",$cn);
$con=mysql_fetch_array($sql);
$producto=$con['nombre'];
/*
$sql1=mysql_query("select cod_cab,cod_prod,nom_prod from det_mov where cod_prod='$pro' and (cod_ope='S1' or cod_ope='R1')");
$comboprod="<option value='T'>Todos</option>";
$produ="";
$c=0;
while($row1=mysql_fetch_array($sql1)){
	$sql2=mysql_query("Select cod_prod from det_mov where cod_cab ='".$row1['cod_cab']."' and SUBSTR(nom_prod,1,3)!='S/N' and SUBSTR(nom_prod,1,8)!='SERVICIO'");
//and SUBSTR(nom_prod,1,8)!='SERVICIO'
	if(mysql_num_rows($sql2)>0){
		$row2=mysql_fetch_array($sql2);
		$sql=mysql_query("Select * from producto where idproducto ='".$row2['cod_prod']."'");
		while($row=mysql_fetch_array($sql)){
			if($c==0){
				$produ="'".$row['idproducto'];
				$c=1;
			}else{
				$produ=$produ."','".$row['idproducto'];
			}
			$comboprod.="<option value='".$row['idproducto']."'>".caracteres($row['nombre'])."</option>";
		}
	}else{
		$produ="'".$row1['cod_prod'];
		$comboprod.="<option value='".$row1['cod_prod']."'>".caracteres($row['nom_prod'])."</option>";
	}
}
$produ.="'";
*/
$combosubc="<option value='T'>Todos</option>";
//$sql=mysql_query("Select * from subcategoria where idsubcategoria in(Select subcategoria from producto where idproducto in($produ))",$cn);
$sql=mysql_query("Select * from categoria",$cn);
while($row=mysql_fetch_array($sql)){
	$combosubc.="<option value='".$row['idCategoria']."'>".caracteres($row['des_cat'])."</option>";
}

//echo $produ;
/*
if($ser==""){
	$sql="SELECT cm.fecha AS fecha,dm.cod_prod,CONCAT(dm.cod_ope,' ',dm.serie,'-',dm.numero) AS documento,dm.cod_cab AS cab,(SELECT concat(cm.obs1,'|',ve.usuario) FROM cab_mov cm inner join usuarios ve on ve.codigo=cm.cod_vendedor INNER JOIN referencia ref ON ref.cod_cab=cm.cod_cab WHERE cod_cab_ref=cab) AS acciones,(SELECT SUBSTR(nom_prod,5) FROM det_mov WHERE cod_cab=cab AND SUBSTR(nom_prod,1,3)='S/N') AS serie,cm.obs1 AS observacion,cm.obs2 AS notas FROM det_mov dm INNER JOIN cab_mov cm ON cm.cod_cab=dm.cod_cab WHERE auxiliar='$cli' and cod_prod='$pro' and dm.cod_ope='$doc'";
}else{
	$sql="SELECT cm.fecha AS fecha,dm.cod_prod,CONCAT(dm.cod_ope,' ',dm.serie,'-',dm.numero) AS documento,dm.cod_cab AS cab,'$ser' AS serie,(SELECT concat(cm.obs1,'|',ve.usuario) FROM cab_mov cm inner join usuarios ve on ve.codigo=cm.cod_vendedor INNER JOIN referencia ref ON ref.cod_cab=cm.cod_cab WHERE cod_cab_ref=cab) AS acciones,cm.obs1 AS observacion,cm.obs2 AS notas FROM det_mov dm INNER JOIN series on series.ingreso=dm.cod_cab INNER JOIN cab_mov cm ON cm.cod_cab=dm.cod_cab WHERE auxiliar='$cli' and cod_prod='$pro' and dm.cod_ope='$doc' and series.serie='$ser'";
}
//echo $sql;
$con=mysql_query($sql,$cn);
*/
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Historial de Servicios/Garantias</title>
<script src="../Finanzas/miAJAXlib3.js" language="javascript"></script>

<link rel="stylesheet" type="text/css" media="all" href="../calendario/Style_calenda.css" title="win2k-cold-1" />

<script type="text/javascript" src="../calendario/calendar.js"></script>
<script type="text/javascript" src="../calendario/lang/calendar-en.js"></script>
<script type="text/javascript" src="../calendario/calendar-setup.js"></script>

<script language= "JavaScript">
var anchoCelda , altoCelda , contCeldas , pasoH , pasoV ,celdas1 , celdas2 ;
var dif = 2;

function iniciar(){
celdas1 = document.getElementById("filRell").getElementsByTagName( "td" ).length;
celdas2 = document.getElementById("encFil").getElementsByTagName( "td" ).length;
if(document.all) dif=0;

for (j=0; j < celdas1; j++){
var anchoEnc = 0;
var anchoTab = 0;

anchoEnc = document.getElementById( "encCol" ).getElementsByTagName( "td" ).item(j).offsetWidth;
anchoTab = document.getElementById( "filRell" ).getElementsByTagName( "td" ).item(j).offsetWidth;

anchoCelda = (anchoTab > anchoEnc) ?  document.getElementById("filRell").getElementsByTagName( "td" ).item(j).offsetWidth : document.getElementById("encCol").getElementsByTagName( "td" ).item(j).offsetWidth;

//if(anchoCelda < 40) anchoCelda = 40; //ANCHO MÃNIMO DE CELDA px

contCeldas = document.getElementById( "filRell" ).getElementsByTagName( "td" ).item(j).innerHTML;
//document.getElementById( "filRell" ).getElementsByTagName( "td" ).item(j).innerHTML = contCeldas+"<img style=\"height:0; width:"+anchoCelda+"px;\" class=\"rellH\">";
//document.getElementById( "filRell" ).getElementsByTagName( "td" ).item(j).style.width=document.getElementById( "filRell" ).getElementsByTagName( "td" ).item(j).style.width+anchoCelda;
document.getElementById( "filRell" ).getElementsByTagName( "td" ).item(j).style.width=anchoCelda;

contCeldas = document.getElementById( "encCol" ).getElementsByTagName( "td" ).item(j).innerHTML;
//document.getElementById( "encCol" ).getElementsByTagName( "td" ).item(j).innerHTML ="<img style=\"height:0; width:"+(anchoCelda-dif)+"px;\" class=\"rellH\"><br>"+contCeldas;
//document.getElementById( "encCol" ).getElementsByTagName( "td" ).item(j).style.width=document.getElementById( "encCol" ).getElementsByTagName( "td" ).item(j).style.width+anchoCelda-dif;
document.getElementById( "encCol" ).getElementsByTagName( "td" ).item(j).style.width=anchoCelda-dif;
}


document.getElementById("contenido").className = "tabla";


for (i=0; i < celdas2-1; i++){
var altoEnc = 0;
var altoTab = 0;
altoEnc = document.getElementById( "encFil" ).getElementsByTagName( "tr" ).item(i).getElementsByTagName( "td" ).item(0).offsetHeight;
altoTab = document.getElementById( "contenido" ).getElementsByTagName( "tr" ).item(i).getElementsByTagName( "td" ).item(0).offsetHeight;

altoCelda = (altoTab > altoEnc)? document.getElementById( "contenido" ).getElementsByTagName( "tr" ).item(i).getElementsByTagName( "td" ).item(0).offsetHeight : document.getElementById( "encFil" ).getElementsByTagName( "tr" ).item(i).getElementsByTagName( "td" ).item(0).offsetHeight;

document.getElementById( "contenido" ).getElementsByTagName( "tr" ).item(i).getElementsByTagName( "td" ).item(0).style.height = altoCelda+"px";

document.getElementById( "encFil" ).getElementsByTagName( "td" ).item(i).style.height = altoCelda+"px";
}
}

function desplaza(){
pasoH = document.getElementById("contenedor").scrollLeft;
pasoV = document.getElementById("contenedor").scrollTop;
document.getElementById("contEncCol").scrollLeft = pasoH;
document.getElementById("contEncFil").scrollTop = pasoV;
}

</script>
<style>
#alfabetos{border-collapse:collapse; background:buttonface;}

#alfabetos td{font:12px "arial" "helvetica" "sans-serif"; border:1px solid; text-align:center; vertical-align:top; }

html>body #contEncCol{overflow:-moz-scrollbars-vertical; background:#ccf; width:108em; //ANCHO TABLA}
* html #contEncCol{overflow:hidden; overflow-y:scroll; background:#ccf; width:108em; //ANCHO TABLA}

html>body #contEncFil{overflow:-moz-scrollbars-horizontal; background:#ccf; height:25em; //ALTO TABLA}
* html #contEncFil{overflow:hidden; overflow-x:scroll; background:#ccf; height:25em; //ALTO TABLA}

html>body #contEncCol{overflow:hidden; overflow-y:scroll; background:#ccf; width:108em; //ANCHO TABLA}
* html #contEncCol{overflow:hidden; overflow-y:scroll; background:#ccf; width:108em; //ANCHO TABLA}

html>body #contEncFil{overflow:hidden; overflow-x:scroll; background:#ccf; height:25em; //ALTO TABLA}
* html #contEncFil{overflow:hidden; overflow-x:scroll; background:#ccf; height:25em; //ALTO TABLA}

#contEncCol , #contEncFil{scrollbar-face-color:buttonface; scrollbar-highlight-color:buttonface; scrollbar-shadow-color:buttonface; scrollbar-arrow-color:buttonface; scrollbar-track-color:buttonface; scrollbar-base-color:buttonface; scrollbar-3dlight-color:buttonface; scrollbar-darkshadow-color:buttonface; }

#contenedor{overflow:scroll; width:108em; height:25em; //ANCHO Y ALTO TABLA}

#encCol td{text-align:center; vertical-align:middle; border:1px solid;}
#encFil {width:100%;}
#encCol {height:100%}

#contenido{background:#fff;}

#contenido td{text-align:left; white-space:nowrap;}

.tabla td{border:1px solid;}

.rellH{ position:relative; top:0; z-index:-1; border:1px solid red;}
</style>
</head>
<body onLoad="<?php echo $busqueda; ?>;setTimeout('iniciar()' ,500)">
<!--buscar_pag('');-->
<form id="form1" name="form1" method="post" action="">
<input type="hidden" name="carga" value="">
  <table width="1325" border="1">
  <!---->
    <tr>
      <td colspan="7" bgcolor="#336699" style=" color:#CCCCCC; font-size: 24px;" align="center">Historial de Servicio</td>
    </tr>
    <tr>
      <td width="84">Servicio:</td>
      <td colspan="6">
      <?php 
	  if($prod=="todos"){
		  echo "<select onchange=".$busqueda." name='tservi' id='tservi' style='height:20; width:400px; vertical-align:top'>".$comboaux."</select>";
	  }else{
		  echo $producto;
	  }?></td>
    </tr>
    <tr>
      <td>Cliente:</td>
      <td colspan="6"><?php if($cliente!="todos"){ echo $cliente; }else{ ?><select name="cliente" style="height:20; width:100px; vertical-align:top">
      <option value="ruc">Ruc</option>
      <option value="razonsocial" selected>Razon Social</option>
      <option value="cliente">Codigo</option>
	  </select><input name="cliente2" style="height:20; width:230px; vertical-align:top" onKeyUp="buscar_pag2('')"></td>
	  <?php }?>
    </tr>
    <tr>
      <td>Producto:</td>
      <td colspan="6"><select name="prod" style="height:20; width:100px; vertical-align:top" onChange="<?php echo $busqueda; ?>">
      <option value="cod_prod">Cod.Sist.</option>
      <option value="nom_prod" selected>Descripcion</option>
      <option value="cod_prod2">Cod.Anex.</option>
	  <?php //echo $comboprod;?></select><input name="prod2" style="height:20; width:230px; vertical-align:top" onKeyUp="<?php echo $busqueda; ?>"></td>
    </tr>
    <tr>
      <td>Marca:</td>
      <td colspan="6"><select name="subc" style="height:20; width:230px; vertical-align:top" onChange="<?php echo $busqueda; ?>">
	  <?php echo $combosubc;?></select></td>
    </tr>
    <tr>
      <td>Desde:</td>
      <td width="360"><input type="text" name="fec1" style="height:20; width:85px; vertical-align:top" onChange="<?php echo $busqueda; ?>" readonly value="<?php echo date('01-01-Y');?>">
      <button type="reset" id="f_trigger_b1" style="height:18; vertical-align:top" >...</button>
				<script type="text/javascript">
				Calendar.setup({
					inputField     :    "fec1",      
					ifFormat       :    "%d-%m-%Y",      
					showsTime      :    true,            
					button         :    "f_trigger_b1",   
					singleClick    :    true,           
					step           :    1                
				});
            </script>
      </td>
      <td width="61">Hasta:</td>
      <td width="310"><input type="text" name="fec2" style="height:20; width:85px; vertical-align:top" onChange="<?php echo $busqueda; ?>" readonly value="<?php echo date('d-m-Y');?>">
      <button type="reset" id="f_trigger_b2" style="height:18; vertical-align:top" >...</button>
				<script type="text/javascript">
				Calendar.setup({
					inputField     :    "fec2",      
					ifFormat       :    "%d-%m-%Y",      
					showsTime      :    true,            
					button         :    "f_trigger_b2",   
					singleClick    :    true,           
					step           :    1                
				});
            </script>
      </td>
      <td width="476" colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="7">&nbsp;</td>
    </tr>
    <tr bgcolor="#00CC99">
    <td colspan="7">
    <table id="alfabetos">
<tr>
<td width="18" height="31">&nbsp;</td>
<td colspan="7" align="right"><div id="contEncCol">
    	<table id="encCol" width="1420">
 			<tr>
			<?php if($_REQUEST['prod']=="todos"){ ?>
            <td width="68" height="31">Fecha</td><td width="32" height="31">Número</td><td width='130' height='31'>Servicio</td><td width="130" height="31">Producto</td><td width="82" height="31">Serie</td><td width="234" height="31">Observación</td><td width="230" height="31">Descripción</td><td width="68" height="31">Técnico</td><td width="250" height="31">Acciones</td>
            <?php }else{ ?>
            <td width="76" height="31">Fecha</td><td width="49" height="31">Número</td><td width="311" height="31">Producto</td><td width="96" height="31">Serie</td><td width="274" height="31">Observación</td><td width="267" height="31">Descripción</td><td width="125" height="31">Técnico</td><td width="62" height="31">Acciones</td>
            <?php }?>
            </tr>
		</table>
    </div></td>
</tr>
    <tr>
    <td height="31">
<div id="contEncFil">
 <table id="encFil">
    <?php //$reg=mysql_num_rows($con);
	//for($i=0;$i<$reg;$i++){
		echo "<tr><td height='31'>&nbsp;</td></tr>";
	//}
	?> 
 <tr><td height="31"> <!-- FILA VACÃA --> </td></tr>
 </table>
</div>
</td>
	<td colspan="7">
		<div id="contenedor" onscroll="desplaza()">
 		<table width="1420" id="contenido">

    <?php /*while($row=mysql_fetch_array($con)){
		$dato=explode("|",$row['acciones']);
		$tecnico=$dato[1];
		$acciones=$dato[0];*/?><?php /*?>
    <tr bgcolor="#FFFF99" onDblClick="Mostrar('<?php //echo $row['cab'];?>')">
      <td width="23" height="31"><?php //echo extraefecha2($row['fecha']);?></td>
      <td width="95" height="31"><?php //echo $row['documento'];?></td>
      <td width="72" height="31"><?php //echo $row['serie'];?></td>
      <td width="200" height="31"><?php //echo caracteres($row['observacion']);?></td>
      <td width="200" height="31"><?php //echo caracteres($row['notas']);?></td>
      <td width="109" height="31"><?php //echo caracteres($tecnico);?></td>
      <td width="200" height="31"><?php //echo caracteres($acciones);?></td>
    </tr>
    <td width="58"> <!-- FILA VACÃA --> </td><td width="63"> </td><td width="200"></td><td width="50"> </td><td width="216"> </td><td width="220"> </td><td width="120"> </td><td width="230">
    <?php //}?>
    <tr id="filRell">
<td width="58"> <!-- FILA VACÃA --> </td><td width="63"> </td><td width="200"></td><td width="50"> </td><td width="216"> </td><td width="220"> </td><td width="120"> </td><td width="230">
 </tr><?php */?>
  <tr>
<td> <!-- FILA VACÃA --> </td><td> </td><td></td><td> </td><td> </td><td> </td><td> </td><td></td><?php if($_REQUEST['prod']=="todos"){ ?><td></td><?php } ?>
  </tr>
    	</table>
	</div></td>
    <tr id="filRell">
	<?php if($_REQUEST['prod']=="todos"){ ?>
<td width="38"></td><td width="32"> <!-- FILA VACÃA --> </td><td width="40" height="31"></td><td width="55"> </td><td></td><td width="112"> </td><td width="116"> </td><td width="95"> </td><td width="360"> </td>
<?php }else{ ?>
<td width="60"></td><td width="70"> <!-- FILA VACÃA --> </td><td width="110"></td><td></td><td width="112"> </td><td width="112"> </td><td width="122"> </td><td width="340"> </td>
<?php }?>
    </tr>
    </table></td>
    </tr>
    <tr>
      <td height="23" colspan="8" align="center"><div id="paginacion"></div></td>
    </tr>
    <tr>
      <td height="23" colspan="8" align="center"><label>
        <input type="button" onClick="window.close();" name="Aceptar" id="Aceptar" value="Cerrar" />
      </label></td>
    </tr>
  </table>
</form>
</body>
</html>
<script language='javascript'>
function Imprimir(){
	prod="<?php echo $pro;?>";
	clie="<?php echo $cli;?>";
	docu="<?php echo $doc;?>";
	prodser="<?php echo $ser;?>";
	document.form1.action='MostrarHist.php?Imprimir=S';
	document.form1.submit();
}
function Mostrar(cod){
	window.open('../doc_detST.php?referencia='+cod,cod,"toolbar=no,status=no, menubar=no, scrollbars=yes,resizable=yes, width=520, height=320,left=300 top=250");
}
function validar_pag(pagina,total){
	if(isNaN(pagina.value)){
		pagina.value=1;
		eval("<?php echo $busquedap?>(1)");
		//buscar_pag(1);
	}else{
		if(pagina.value<total){
			pagina.value=pagina.value;
			eval("<?php echo $busquedap?>("+pagina.value+")");
			//buscar_prod(pagina.value);
		}else{
			eval("<?php echo $busquedap?>("+total+")");
			//buscar_pag(total);
		}
	}
}
function buscar_pag2(pagina){
	var servicio=document.form1.tservi.value;
	var bproducto=document.form1.prod.value;
	var producto=document.form1.prod2.value;
	var bcliente="cliente";//document.form1.cliente.value;
	var cliente="<?php echo $cli;?>";//document.form1.cliente2.value;
	if(cliente=='todos'){
		bcliente=document.form1.cliente.value;
		cliente=document.form1.cliente2.value;
	}
	//alert(cliente);
	var subc=document.form1.subc.value;
	if("R1"=="<?php echo $doc;?>"){
		var serie="S";
	}else{
		var serie="";
	}
	//alert(bcliente+" - "+cliente);
	doAjax('pedir_dato.php','&peticion=busca_historia&todos&tservi='+servicio+'&bproducto='+bproducto+'&bcliente='+bcliente+'&producto='+producto+'&cliente='+cliente+'&subcat='+subc+'&fecha1='+document.form1.fec1.value+'&fecha2='+document.form1.fec2.value+'&series='+serie+'&pag='+pagina,'mostrar_busq','GET','','','','');
}

function buscar_pag(pagina){
	var servicio="<?php echo $pro;?>";
	if("S"=="<?php echo $_REQUEST['Imprimir']?>"){
		var imprimir="&Imprimir";
	}else{
		var imprimir="";
	}
	var bproducto=document.form1.prod.value;
	var producto=document.form1.prod2.value;
	var bcliente="cliente";//document.form1.cliente.value;
	var cliente="<?php echo $cli;?>";//document.form1.cliente2.value;
	var subc=document.form1.subc.value;
	if("R1"=="<?php echo $doc;?>"){
		var serie="S";
	}else{
		var serie="";
	}
	//alert(bcliente+" - "+cliente);
	doAjax('pedir_dato.php','&peticion=busca_historia'+imprimir+'&tservi='+servicio+'&bproducto='+bproducto+'&bcliente='+bcliente+'&producto='+producto+'&cliente='+cliente+'&subcat='+subc+'&fecha1='+document.form1.fec1.value+'&fecha2='+document.form1.fec2.value+'&series='+serie+'&pag='+pagina,'mostrar_busq','GET','','','','');
}
function mostrar_busq(texto){
	//alert(texto);
	var datos=texto.split("|");
	document.getElementById('contEncFil').innerHTML=datos[0];
	document.getElementById('contenedor').innerHTML=datos[1];
	if(datos[2]=="Imprimir"){
		window.print();
	}else{
	document.getElementById('paginacion').innerHTML=datos[2];
	}
	celdas2 = document.getElementById("encFil").getElementsByTagName( "td" ).length;
	if(document.all) dif=0;

	for (i=0; i < celdas2-1; i++){
		var altoEnc = 0;
		var altoTab = 0;
		altoEnc = document.getElementById( "encFil" ).getElementsByTagName( "tr" ).item(i).getElementsByTagName( "td" ).item(0).offsetHeight;
		try{
		altoTab = document.getElementById( "contenido" ).getElementsByTagName( "tr" ).item(i).getElementsByTagName( "td" ).item(0).offsetHeight;
		}catch(e){
			alert(i);
		}
		altoCelda = (altoTab > altoEnc)? document.getElementById( "contenido" ).getElementsByTagName( "tr" ).item(i).getElementsByTagName( "td" ).item(0).offsetHeight : document.getElementById( "encFil" ).getElementsByTagName( "tr" ).item(i).getElementsByTagName( "td" ).item(0).offsetHeight;

		document.getElementById( "contenido" ).getElementsByTagName( "tr" ).item(i).getElementsByTagName( "td" ).item(0).style.height = altoCelda+"px";

document.getElementById( "encFil" ).getElementsByTagName( "td" ).item(i).style.height = altoCelda+"px";
	}
}
function validartecla(e){
	if(e.keyCode=13){
		//buscar_pag('');
		eval("<?php echo $busqueda?>");
	}
}
</script>