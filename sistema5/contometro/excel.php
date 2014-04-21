<?php 
session_start();
include('miclase.php');
$clase= new miclase('');

if(isset($_REQUEST['excel'])){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=excel.xls");
	$visible="style='visibility:hidden' ";
}			
				$fec1=$_REQUEST['fec1'];
				$fec2=$_REQUEST['fec2'];
				$cond=$_REQUEST['cond'];				
				$texto=$_REQUEST['texto'];
?>

<script language="javascript" src="../miAJAXlib2.js"></script>
<script type="text/javascript" src="javascript/mover_div.js"></script>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>administradores</title>


<script type="text/javascript" src="javascript/mover_div.js"></script>
    <script src="../jquery-1.2.6.js"></script>
	  <script src="../jquery.hotkeys.js"></script>
<script>
var temp_busqueda2="";
var scrollDivs=new Array();
scrollDivs[0]="sucursal";
//scrollDivs[1]="div2";


function entrada(objeto){
//document.getElementById('prueba').value=objeto.style.background;
//alert(objeto.style.background);
objeto.style.background='#FFF1BB';
//document.getElementById('prueba').value=objeto.style.background;
//est=0;
}

function salida(objeto){
//document.getElementById('prueba').value=objeto.style.background;
//alert(objeto.style.background);
objeto.style.background='#EEEEEE';
//document.getElementById('prueba').value=objeto.style.background;
//est=0;
}

function recargar(){
document.form1.submit();
}

function nuevo_suc(texto){
var r = texto;
document.getElementById('sucursal').innerHTML=r;
document.getElementById('sucursal').style.visibility='visible';
//alert('entro');
//document.form1.txtnombre.focus();
document.getElementById('btn2').disabled="";
Marcaje_Anterior();
}

function ocultar(){
document.getElementById('sucursal').style.visibility='hidden';
document.getElementById('btn2').disabled="disabled";
}


	
	function val_letras(e) { // 1
	//alert(e);
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-z\s]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
	}
	function val_numeros(e){
	    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[0-9.]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
	}

function detalle_prod(texto){
//alert(texto);
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
function salir(){

	document.getElementById('auxiliares').style.visibility='hidden';
	
}
function graba(){
if(($('#sucursal').css('visibility'))!='hidden'){
 if(validar()!=false){
 document.form1.submit();
}
}
}


jQuery(document).bind('keydown', 'f2',function (evt){
 event.keyCode=0;
	event.returnValue=false;
graba();
 
  return false; });
  
jQuery(document).bind('keydown', 'f3',function (evt){//jQuery('#_esc').addClass('dirty'); 
event.keyCode=0;
	event.returnValue=false;
//	alert("m");
 doAjax('new_hiscont.php','accion=n','nuevo_suc','get','0','1','','');
		
return false; });
jQuery(document).bind('keydown', 'esc',function (evt){

//jQuery('#_esc').addClass('dirty'); 
ocultar();
event.keyCode=0;
	event.returnValue=false;		
return false; });


jQuery(document).bind('keyup', 'up',function (evt){jQuery('#_up').addClass('dirty');

   if(document.getElementById('auxiliares').style.visibility=='visible'){

	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
	//alert(document.getElementById('tblproductos1').rows[i].style.background);
		if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb' && (i!=0) ){
		document.getElementById('tblproductos').rows[i].style.background=document.getElementById('tblproductos').rows[i].bgColor;
		document.getElementById('tblproductos').rows[i-1].style.background='#FFF1BB';
		
			
			location.href="#ancla"+(i-1);
			
			document.form1.producto.focus();
			
			if(i%4==0 && i!=0){
			//	capa_desplazar = $('detalle1');
		//	capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y - 60);
			}
			break;
		}
	  }
   }
         
 return false; });
 jQuery(document).bind('keyup', 'down',function (evt){jQuery('#_down').addClass('dirty');

	if(document.getElementById('auxiliares').style.visibility=='visible'){
 //alert('entro');
 //alert(document.getElementById('tblproductos').rows.length);
	for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
			
		//	alert(document.getElementById('tblproductos').rows.length);
			if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb' && (i!=document.getElementById('tblproductos').rows.length-1)){
			//alert(document.getElementById('TablaDatos').rows[i].style.background);
			document.getElementById('tblproductos').rows[i].style.background=document.getElementById('tblproductos').rows[i].bgColor;
			document.getElementById('tblproductos').rows[i+1].style.background='#FFF1BB';
			
			if(i%4==0 && i!=0){
			
			location.href="#ancla"+i;
			document.form1.producto.focus();
			//capa_desplazar = $('detalle1');
			//capa_desplazar.scrollTo(0, capa_desplazar.getSize().scroll.y + 60);
			}
			
			break;
				
			}
		}
 	}
	
	
 return false; });
 
 jQuery(document).bind('keyup', 'return',function (evt){jQuery('#_return').addClass('dirty'); 

	   if(document.getElementById('auxiliares').style.visibility=='visible'){

		for (var i=0;i<document.getElementById('tblproductos').rows.length;i++) { 
			if(document.getElementById('tblproductos').rows[i].style.background=='#fff1bb'){
		  // alert(document.getElementById('tblproductos').rows[i].cells[0].childNodes[0].innerHTML);
		var temp=document.getElementById('tblproductos').rows[i].cells[0].childNodes[0].childNodes[0].innerHTML;
		var temp1=document.getElementById('tblproductos').rows[i].cells[1].childNodes[0].innerHTML;
		
		//var doc=document.formulario.doc.value;
		//var ruc=document.getElementById('tblproductos').rows[i].cells[2].childNodes[0].childNodes[0].childNodes[0].childNodes[0].innerHTML;
		//alert(ruc);
			// if( (doc=='FA' || doc=='F1') && ruc==""  ){
			 //alert(" Cliente no tiene Ruc ");
			 //return false;
			 //}else{
			 

			 
			 temp1=temp1.replace('&amp;','&');
					
			 elegir2(temp,temp1);
			 //}		  

			}
		 }
	   }
	   
	   
	
			
return false; });
function elegir2(cod,des){
//alert(cod);
//razon.replace('&','amps')
des=des.replace('amps','&');

document.form1.producto.value=des;
document.form1.auxiliar2.value=cod;
document.getElementById('auxiliares').style.visibility='hidden';

}
jQuery(document).bind('keydown', 'esc',function (evt){jQuery('#_esc').addClass('dirty'); 

//document.formulario.codprod.focus();
//alert("escape");
salir();
		
return false; });

</script>

<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #990000;
	font-weight: bold;
}
.Estilo12 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo13 {font-size: 11px}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #F3F3F3;
	color:#000000;
}
.Estilo15 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #FFFFFF; }
.Estilo16 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
#paginacion,.paginacion {
    border: 0 solid;
    margin: 2px;
	font-size:14px;
	}
a.paginacion {
text-decoration:none;
	}
.Estilo112 {color: #000000}
.Estilo113 {color: #CC3300;
	font-weight: bold;
	font-size: 10px;
	font-family: Arial, Helvetica, sans-serif;
}

.Estilo34 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
.EstiloTexto1{
 font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#000000; font:bold;
}
.Estilo38 {	color: #0066CC;
	font-weight: bold;
}

-->
</style>
</head>


<body onLoad="cargar_datos(0)">
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC" >
    <tr>
      <td >&nbsp;</td>
      <td ><span class="Estilo1"></span></td>
      <td ><span class="Estilo16" >
	  <a href="javascript: doAjax('new_transportista.php','accion=n','nuevo_suc','get','0','1','','');"></a></span></td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" style="padding-left:100px;"><h2><b>Informe de Cont&oacute;metro y Tanques</b></h2></td>
    </tr>
    <tr>
      <td colspan="4" style="padding-left:100px;"><span style="color:#000000"><strong>Fecha: De <?php echo $fec1; ?> al <?php echo $fec2; ?></strong></span></td>
    </tr>
    <tr>
      <td colspan="4"><form name="formbuscar" method="post" action="?" onSubmit="return false">
        <input name="tempauxprod" type="hidden" id="tempauxprod" value="productos">
		   <input name="error" type="hidden" id="error">
           <input name="tipo" type="hidden" id="tipo" onKeyUp="cargar_datos()" value="<?php echo $cond; ?>" >
           <input name="texto" type="hidden" id="texto" onKeyUp="cargar_datos()" value="<?php echo $texto; ?>" >
           <input name="fec1" type="hidden" size="10" maxlength="50" value="<?php echo $fec1; ?>"  >
           <input name="fec2" type="hidden" size="10" maxlength="50"  value="<?php echo $fec2;?>" >
      </form></td>
    </tr>
    <tr><td colspan="5">
<?
	
	$where="";
	$regvis=2;

	if($pag>=1) {
	$inicio=($pag-1)*$regvis;
	}else{
	$inicio=0;
	$pag=1;
	}
	if($cond!=""){
	$where =" where $cond like '%$texto%'";
		if ($cond =="des_tienda"){
		$whereX =" and $cond like '%$texto%' ";
		}
	$where2=" and substring(fecha_his,1,10) between '".formatofecha($fec1)."'  and '".formatofecha($fec2)."' ";
	}
		
	$sql="SELECT * FROM isla I
INNER JOIN sucursal SU ON I.sucursal = SU.cod_suc
INNER JOIN tienda T ON I.tienda = T.cod_tienda
$where 
GROUP BY SU.cod_suc	";
	// order by des_tienda
	$ITE=0;
	$totalreg=mysql_num_rows(mysql_query($sql));
  	$resultados = mysql_query($sql." limit ".$inicio.",".$regvis);
   while($row=mysql_fetch_array($resultados)){
   	//echo '<br><div style="padding-left:40px; font-size:13px"><b>'.strtoupper($row['nom_surt']).' - EMPRESA:('.$row['des_suc'].')</b></div>';
	echo '<br><div style="padding-left:40px; font-size:13px"><b>>> EMPRESA: '.$row['des_suc'].' </b></div>';
//rem local -----------------------------------------
	$sqlL="select * from tienda  T
	inner join isla I on T.cod_tienda=I.tienda 	
	where cod_suc ='".$row['cod_suc']."' 
	$whereX
	group by  	cod_tienda	order by des_tienda";
	$ITL=0;
  	$resultadosL = mysql_query($sqlL);
   while($rowL=mysql_fetch_array($resultadosL)){
	echo '<div style="padding-left:40px; font-size:13px"><u><b> '.$rowL['des_tienda'].' </b></u></div>';

	
 	echo '<br>';

echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">';  
	/////--------------------------------------------------------------------------
  
   $sql2="select * from hist_contometro H
inner join manguera M on H.cod_manguera=M.id
inner join surtidor S on M.cod_surtidor=S.id
inner join tanques T on M.cod_tanques=T.id  
inner join isla I on S.cod_isla = I.id  
where I.tienda='".$rowL['cod_tienda']."' 
$where2
GROUP BY cod_manguera
  ";  

    // $where2
    $resultados2 = mysql_query($sql2);
	echo '<table border="0" >
<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
  <td align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">&nbsp;</td>
  <td colspan="7" class="EstiloTexto1" style=" border:#CCCCCC solid 1px" > HISTORIAL DE CONT&Oacute;METRO  </td>
  </tr>
    
<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
  <td  width="20" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">N&deg;</td>
  <td   width="120"  align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1" >Manguera</td>
  <td   width="80"  align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1" >Surtidor</td>
  <td   width="80"  align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1" >Precio</td>
  <td   width="80"  align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1" >Cont.Inicial</td>
  <td   width="80" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Cont.Final</td>
  <td   width="80" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Cantidad</td>
  <td   width="80" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Importe</td>	
	  
    </tr><tr><td colspan="8">
	<!--<div style="position:relative;height:250px;overflow:auto;border:0px solid;padding:0px;margin:0px;">-->
	
	<table border="0">' ;
	  $i=0;
	  $CT=0;
	  $IT=0;
	while($row2=mysql_fetch_array($resultados2)){
	$i++;
	 echo '<tr bgcolor="#FFFFFF">

		   <td width="20" align="center"><span class="Estilo12">'.$i.'</span></td>
		   <td width="120"><span class="Estilo12">'.$row2['nom_mang'].'</span></td>
		   <td width="80"><span class="Estilo12">'.$row2['nom_surt'].'</span></td>';
		 
		  $strSQL1="select * from producto  
		  where idproducto='".$row2['cod_prod']."' ";
		  $resultado4=mysql_query($strSQL1);
 		  $row2X=mysql_fetch_array($resultado4);		  
		  $precP=$row2X['precio'];
		   echo '<td width="80" align="right"><span class="Estilo12">'.number_format($row2X['precio'],3).'</span></td>';
		 
		  $strSQL1="select * from hist_contometro  
		  where cod_manguera='".$row2[9]."' and turno='1'  order by fecha_his desc ";
		  $resultado4=mysql_query($strSQL1);
 		  $row2X=mysql_fetch_array($resultado4);		  
		  $contoI=$row2X['cont_ini'];
		   if ($row2X['factor']>0) { $fator1=$row2X['factor'];}else{ $fator1='1';}
		   echo '<td width="80" align="right"><span class="Estilo12">'.$row2X['cont_ini'].'</span></td>';
		 
		  $strSQL1="select * from hist_contometro  
		  where cod_manguera='".$row2[9]."' and turno='2'  order by fecha_his desc";
		  $resultado4=mysql_query($strSQL1);
 		  $row2X=mysql_fetch_array($resultado4);		  
		  $contoF=$row2X['cont_fin'];
		  //-- vercion 1
		  /*if ($row2X['factor']>0) { $fator2=$row2X['factor'];}else{ $fator2='1';}
		  if ($fator2==$fator1){
		 	 $Cant=($contoF-$contoI)/$fator2 ;
		 	 $Impor=$precP*$Cant;
		  }else{
		    $Cant='<div style="color:#FF0000" title="Verifique factor de ambos turnos">0.00</div>';
			$Impor='<div style="color:#FF0000" title="Verifique factor de ambos turnos">0.00</div>';
		  }
		  $CT+=number_format($Cant, 2, '.', '');//$Cant;
		  $IT+=number_format($Impor, 2, '.', '');//$Impor;
		  
		  */	
		  //---------------------------------------
		  //-- vercion 2
		  if ($row2X['cont_fin']==''){
			$contoF=$row2['cont_fin'];
			$contoI=0;
			$fator2=$row2['6'];
			//echo $contoF.'//'.$contoI.'//'.$fator2 ;
			$Cant=($contoF-$contoI)/$fator2 ;
		    $Impor=$precP*$Cant;	  
		  
		  $CT+=number_format($Cant, 2, '.', '');//$Cant;
		  $IT+=number_format($Impor, 2, '.', '');//$Impor;
		  
		  }else{			
			$contoF=$row2X['cont_fin'];
			$fator2=$row2X['factor'];
			//echo $contoF.'//'.$contoI.'//'.$fator2 ;
			$Cant=($contoF-$contoI)/$fator2 ;
		 	$Impor=$precP*$Cant;	  
		  
		  $CT+=number_format($Cant, 2, '.', '');//$Cant;
		  $IT+=number_format($Impor, 2, '.', '');//$Impor;
		  
		  }
		  //---------------------------------------		  
		  
		  
		 // 	$contoF=$row2X['cont_fin'];  // -->   $cont_fin
		   echo '
		   <td width="80" align="right"><span class="Estilo12">'.$contoF.'</span></td>
		   <td width="80" align="right"><span class="Estilo12">'.number_format($Cant,2).'</span></td>
		   <td width="80" align="right"><span class="Estilo12">'.number_format($Impor,2).'</span></td>

		</tr>';
		$ITL+=number_format($Impor, 2, '.', '');//$Impor;	
		
	  }	
	  
	echo  "</table>";
	//Totales manguera
	echo '<table border="0" align="right">
    <tr >
      <td width="20">&nbsp;</td>
      <td width="120">&nbsp;</td>
      <td width="80">&nbsp;</td>      
      <td width="80">&nbsp;</td>  
	  <td width="80" style="color:#000000"><b>TOTAL :</b></td>      
      <td width="80" style="color:#000000" align="right">'.$CT.'</td>
      <td width="80" style="color:#000000" align="right">'.$IT.'</td>
    </tr>
</table>
';
	
	echo  "<!--</div>--></td></tr></table>";
	
///-------------------------------
echo '</td>
    <td valign="top">';
///-------------------------------	  varillaje
  
/*select HC.id,nom_tanq,max(fecha_his) as fecha_his,max(cantidad) as cantidad
,max(capacidad) as capacidad
   from hist_varillaje HC
   inner join tanques T on HC.cod_tanque=T.id 
   inner join usuarios U on HC.cod_vendedor=U.codigo   
   where cod_tanque in (select cod_tanques from surtidor S
inner join manguera M on S.id=M.cod_surtidor
where S.id='".$row['id']."' GROUP by cod_tanques,cod_surtidor )
 $where2  group by nom_tanq*/
 //echo $rowL['cod_tienda'];
   $sql2="
select  HC.id,cod_tanque,nom_tanq,max(fecha_his) as fecha_his,max(cantidad) as cantidad
,max(capacidad) as capacidad,l from hist_varillaje HC inner join tanques T on HC.cod_tanque=T.id 
 where  cod_tanque in (
 
select cod_tanques from manguera M 
inner join surtidor S on M.cod_surtidor=S.id
inner join isla I on S.cod_isla=I.id
where tienda='".$rowL['cod_tienda']."' group by cod_tanques
 
 ) $where2
group by cod_tanque
 
   ";  
   // 
   //order by HC.fecha_his desc
    
    $resultados2 = mysql_query($sql2);
	echo '<table border="0" >
<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
  <td align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">&nbsp;</td>
  <td colspan="7" class="EstiloTexto1" style=" border:#CCCCCC solid 1px" > HISTORIAL DE VARILLAJE  </td>
  </tr>
    
<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
  <td  width="30" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">N&deg;</td>
  <td   width="75"  align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1" >Fecha</td>
  <td   width="80"  align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1" >Tanque</td>  
  <td   width="70" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Varillaje(H)</td>	
  <td   width="70" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Vol. Disponible </td>
  <td   width="70" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Nivel</td>
    </tr><tr><td colspan="6">
	<!--<div style="position:relative;height:250px;overflow:auto;border:0px solid;padding:0px;margin:0px;">-->
	
	<table border="0">' ;
	  $i=0;
	while($row2=mysql_fetch_array($resultados2)){
	$i++;
	if ($row2['l']!='GLP'){
		$color="#FFFFFF";
	}else{
		$color="#CEF3FF";
	}
	 echo '<tr bgcolor="'.$color.'">

		   <td width="35" align="center"><span class="Estilo12">'.$row2['id2'].''.$i.'</span></td>
		   <td width="75"><span class="Estilo12">'.formatofecha(substr($row2['fecha_his'],0,10)).'</span></td>
		   <td width="80"><span class="Estilo12">'.$row2['nom_tanq'].'</span></td>';		 
		 
		 $strSQL1="select * from hist_varillaje  where id='".$row2['id']."'  ";
		  $resultado4=mysql_query($strSQL1);
 		  $row2X=mysql_fetch_array($resultado4); 		
			if ($row2X['l']!='GLP')	{
			  $R=$row2X['r'];//$rowX['radio'];//114.59155902617;
			  $H=$row2['cantidad'];//1;
			  $L=$row2X['l'];//$rowX['largo'];//120;
			  $G=$row2X['g'];//3.78541;
			$Formula=((((2*pi()*($R*$R)*(rad2deg(acos(($R-$H)/$R))))/360)-((sqrt(($R*$R)-(($R-$H)*($R-$H))))*($R-$H)))*$L)/($G*1000);	
				$varillaje=$row2['cantidad'];
				$capGalon=(number_format($Formula,2)*100)/$row2['capacidad'];
			}else{
				$Formula=$row2['cantidad'];
				$varillaje='';
				//echo $Formula.'//'.$row2['capacidad'];
				//number_format($Impor, 2, '.', '');//$Impor;	
				 $capGalon=($Formula*100)/$row2['capacidad'];
			}			
			
			//$altcapGalon='Capacidad del Tanque('.$row2['capacidad'].')  Nivel '.(number_format($Formula,2)*100)/$row2['capacidad'].'%';
			$altcapGalon='Capacidad del Tanque('.$row2['capacidad'].')  Nivel '.$capGalon.'%';
						
			if ($capGalon>=100){
				$imgG='1.jpg';
			}if ($capGalon<100){
				$imgG='2.jpg';
			}if ($capGalon<70){
				$imgG='3.jpg';
			}if ($capGalon<50){
				$imgG='4.jpg';
			}if ($capGalon<25){
				$imgG='5.jpg';
			}
			$capGalon='<img src="img/'.$imgG.'" width="68" height="43" alt="'.$altcapGalon.'"  />';
			
		   echo '<td width="70" align="right"><span class="Estilo12">'.$varillaje.'</span></td>
		   <td width="70" align="right"><span class="Estilo12">'.number_format($Formula,2).'</span></td>
			<td width="70"><span class="Estilo12">'.$capGalon.'</span></td>
			
			
		</tr>';
		  
	  }	
	echo  "</table><!--</div>--></td></tr></table>";
	///-------------------------------
	
	echo '</td>
  </tr>  
</table>';
	
  	}  /////-----------------------------------------------------------------------------------------
$ITE+=$ITL;
//Totales Local
	echo '
	<br>
	  <div  style="color:#FF0000;padding-left:420px;"><b>TOTAL POR EMPRESA  :</b>     
      '.$ITL.'</div>
';

}  //--- fin de local	

//Totales Emprsa
	echo '
	<br>
	  <div  style="color:#0066FF;padding-left:420px;"><b>TOTAL GENERAL :</b>     
       '.$ITE.'</div>
';

	

	
?>
	
	<div id="resultadox"></div><div id="paginacion"></div></td></tr>
</table>
  

</body>
<script>

var error;
function validar_dato(texto){
	error=texto;
	if (texto!=''){
	 	//alert(texto);
	}


}
function cargar_datos(pag){

var cond=document.formbuscar.tipo.value;
var texto=document.formbuscar.texto.value;
var fec1=document.formbuscar.fec1.value;
var fec2=document.formbuscar.fec2.value;

doAjax('lista_hiscont.php','ventana=ict&condicion='+cond+'&texto='+texto+'&fec1='+fec1+'&fec2='+fec2+'&pag='+pag,'view_det','get','0','1','','');

}
function view_det(texto){
//alert(texto);
var r = texto.split('|');
//alert(r[0]);
document.getElementById('resultado').innerHTML=r[0];
//document.form1.carga.value='N';
document.getElementById('paginacion').innerHTML=r[1];

}
</script>
</html>
