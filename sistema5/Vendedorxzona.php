<?php 
session_start();
include('conex_inicial.php');
include('funciones/funciones.php');
?>
<script language="javascript" src="miAJAXlib2.js"></script>
<script type="text/javascript" src="javascript/mover_div.js"></script>

<script>
function act_aux(res){
location.href='maestro_cliente.php?auxiliar=<?php echo $_REQUEST['auxiliar'];?>';
}
</script>

<?php 
$tipo_aux=$_REQUEST['auxiliar'];

if($tipo_aux=='C'){
$texto="Clientes";
}else{
$texto="Proveedores";
}

//Tipo de proveedores////////
// 1=proveedor Local 
// 2=proveedor extranjero o importacion

if(isset($_REQUEST['accion'])){
//echo "entro";
  $accion=$_REQUEST['accion'];
  $codigo=$_REQUEST['codigo'];
  $razonsocial=$_REQUEST['razonsocial'];
  $ruc=$_REQUEST['ruc'];
  $nombres=$_REQUEST['nombres'];
  $apellidos=$_REQUEST['apellidos']; 
  $t_persona=$_REQUEST['t_persona'];
  $contacto=$_REQUEST['contacto'];
  $cargo=$_REQUEST['cargo'];
  $direccion=$_REQUEST['direccion'];
  $telefono=$_REQUEST['telefono'];
  $email=$_REQUEST['email'];
  $doc_iden=$_REQUEST['docu_iden'];
  $baja=$_REQUEST['baja'];
  $web=$_REQUEST['web'];
  $clas_clie=$_REQUEST['clas_clie'];  
  $condicion=$_REQUEST['condicion'];	
  $estado_percep=$_REQUEST['estado_percep']; 
  $por_percep=$_REQUEST['por_percep'];
  $lider=$_REQUEST['chklider'];
  $codlider=$_REQUEST['selectLider'];
  $tipoprov=$_REQUEST['tipoprov'];
  $responsable=$_REQUEST['responsable'];
  $idubigeo=$_REQUEST['idubigeo'];
  $idzonas=$_REQUEST['idzonas'];
  

      
  if(!isset($_REQUEST['estado_percep']) ){
  $estado_percep=0; 
  $por_percep=0;
  }    
  
  if($baja!='S'){
  $baja='N';
  }				
  if($lider!='S'){
  $lider='N';
  }	
		
	 if($accion=='n'){
			
						
			//----------------------------iamgenes-----------------------------
			
			if($t_persona=='natural'){
				if($doc_iden==''){
					$strSQL09="select * from cliente where doc_iden='NOEXISTE' ";	
				}else{
					$strSQL09="select * from cliente where doc_iden='$doc_iden' ";		
				}
				//$strSQL09="select * from cliente where doc_iden='$doc_iden' ";
				
			}else{
				$strSQL09="select * from cliente where ruc='$ruc' ";
			}			
			$resultados = mysql_query($strSQL09,$cn);
			$cont=mysql_num_rows($resultados);
			$row=mysql_fetch_array($resultados);
			$cod_clie=$row['codcliente'];
			
			//echo "cont".$cont;
					
			if($cont==0){
					
			$resultado3=mysql_query("select max(codcliente) as codigo from cliente",$cn);
			$row3=mysql_fetch_array($resultado3);
			
			$codigo=$row3['codigo'];
			$codigo=str_pad($codigo+1,6,'0',STR_PAD_LEFT);
			
			///Busca vacios
			$resultados2rX = mysql_query("select * from cliente order by codcliente",$cn);
			$roxcountX=mysql_num_rows($resultados2rX);			
			
			for ($i = 1; $i <= $roxcountX; $i++) {
			$codT=str_pad($i, 6, "0", STR_PAD_LEFT);
				if ($stop==''){	
				$rt = mysql_query("select * from cliente where codcliente='".$codT."' ",$cn);
				$row2rt=mysql_fetch_array($rt);
				$roxT=mysql_num_rows($rt);				
					if ($roxT==0){
						$codigo=$codT; 
						$stop='SI'; 
					}
				}
			}
			//fin de buscar vacios
			
								
			$strSQL2= "insert into cliente (codcliente,tipo_aux,razonsocial,ruc,telefono,nombres,apellidos,t_persona,doc_iden,direccion,email,contacto,cargo,baja,web,clas_clie,condicion,estado_percep,por_percep,lider,codlider,tipoprov,responsable,ubigeo,zona) values ('".$codigo."','".$_REQUEST['tAuxiliar']."','".$razonsocial."','".$ruc."','".$telefono."','".$nombres."' ,'".$apellidos."' ,'".$t_persona."' ,'".$doc_iden."' ,'".$direccion."' ,'".$email."' ,'".$contacto."','".$cargo."','".$baja."','".$web."','".$clas_clie."','".$condicion."','".$estado_percep."','".$por_percep."','".$lider."','".$codlider."','".$tipoprov."','".$responsable."','".$idubigeo."','".$_REQUEST['tZonas']."')";
				
			mysql_query($strSQL2);
			
				//echo "-->".$strSQL2;
			    unset($accion);
			//	header("location: maestro_cliente.php?auxiliar=$tipo_aux");
			}else{
			
				if($row['tipo_aux']==$tipo_aux || $row['tipo_aux']=='A'){
				echo "<script>alert('Ruc o DNI ya existen....')</script>";
				}else{
					if($row['tipo_aux']=='P'){
					echo "<script>if(confirm('Este Auxiliar ya se encuentra registrado como Proveedor...Desea agregarlo también como Cliente ?'))doAjax('new_cliente.php','upd_cod=".$cod_clie."','act_aux','get','0','1','','');</script>";
					}else{
					echo "<script>alert('Este Auxiliar ya se encuentra registrado como Cliente  ')</script>";
					}
				}
						
				
				
			}
			
	}

	if($accion=='e'){
	
	$strSQLW="select * from cliente  where codcliente='".$codigo."' ";
	$resultadoW=mysql_query($strSQLW,$cn);
	$rowW=mysql_fetch_array($resultadoW);
	/*
	if($rowW['tipo_aux']!=$_REQUEST['tAuxiliar']){
	 $selectMov="select * from cab_mov where cliente='".$codigo."'";
	 $resultadoMov=mysql_query($selectMov,$cn);
	 $cantRows=mysql_num_rows($resultadoMov);
	 if($_REQUEST['tAuxiliar']!='A'){
	 
	 }
	}
   */		
	
	$strSQL="update cliente set razonsocial='".$razonsocial."',ruc='".$ruc."',telefono='".$telefono."',nombres='".$nombres."' ,apellidos='".$apellidos."' ,t_persona='".$t_persona."' ,doc_iden='".$doc_iden."' ,direccion='".$direccion."' ,email='".$email."' ,contacto='".$contacto."' ,cargo='".$cargo."',baja='".$baja."',web='".$web."',clas_clie='".$clas_clie."',condicion='".$condicion."',estado_percep='".$estado_percep."',por_percep='".$por_percep."',tipo_aux='".$_REQUEST['tAuxiliar']."',lider='".$lider."',codlider='".$codlider."',tipoprov='".$tipoprov."',responsable='".$responsable."',ubigeo='".$idubigeo."',zona='".$_REQUEST['tZonas']."'  where codcliente='".$codigo."'";
	
	mysql_query($strSQL);
}
}

//----------eliminando------------------------
	
	if(isset($_REQUEST['cod'])){
	//echo "codigo eliminado".$_REQUEST['cod'];
	$strSQL0="select * from cab_mov where cliente='".$_REQUEST['cod']."'";
	$resultados0 = mysql_query($strSQL0,$cn);
	$cont_reg=mysql_num_rows($resultados0);	
		if($cont_reg==0){
			if($_REQUEST['tip']=="A"){
				$strSQL="update cliente set baja='S',fbaja='".date('Y-m-d')."' where codcliente='" . $_REQUEST['cod'] . "'";
				
				//echo $strSQL;
				
				mysql_query($strSQL,$cn);
				
			}else{
				if($_REQUEST['tip']=="E"){
					$strSQL="delete from cliente where codcliente='" . $_REQUEST['cod'] . "'";
					mysql_query($strSQL,$cn);
				}
			}
		}else{
			echo "<script>alert(' Este registro no se puede eliminar porque tiene movimientos ')</script>";
		}
	}

?>
<!--
este registro tiene movimientos  no se pude eliminar.
dar de baja
motivo fecha.
1.-cliente proveedor en baja
2.-no ubicado
3.-otro
-->

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>administradores</title>

<LINK href="pestanas/tab-view.css" type=text/css rel=stylesheet>
<SCRIPT src="pestanas/tab-view.js" type=text/javascript></SCRIPT>


<script src="jquery-1.2.6.js"></script>
<script src="jquery.hotkeys.js"></script>

<script language="JavaScript"> 
//(c) 1999-2001 Zone Web 
/*function click() { 
if (event.button==2) { 
alert ('Derechos Reservados a Prolyam Software.') 
} 
} 
document.onmousedown=click */
//--> 

 jQuery(document).bind('keydown', 'f1',function (evt){jQuery('#_f6').addClass('dirty');
 	evt.keyCode=0;
	evt.returnValue=false;	
 return false; }); 
 
 jQuery(document).bind('keydown', 'f2',function (evt){jQuery('#_f6').addClass('dirty');
 	evt.keyCode=0;
	evt.returnValue=false;
 return false; });
 
jQuery(document).bind('keydown', 'f3',function (evt){jQuery('#_f3').addClass('dirty');
 	evt.keyCode=0;
	evt.returnValue=false;
	doAjax('new_cliente.php','accion=n','nuevo_suc','get','0','1','','')
 return false; }); 
 
  jQuery(document).bind('keydown', 'f4',function (evt){jQuery('#_f6').addClass('dirty');
 	evt.keyCode=0;
	evt.returnValue=false;
	eliminar('E')
 return false; }); 
 
  jQuery(document).bind('keydown', 'f5',function (evt){jQuery('#_f6').addClass('dirty');
 	evt.keyCode=0;
	evt.returnValue=false;
	eliminar('A');
 return false; }); 
 
 jQuery(document).bind('keydown', 'f6',function (evt){jQuery('#_f6').addClass('dirty');
  	evt.keyCode=0;
	evt.returnValue=false;
	editar('actualizar');
 return false; }); 
 
 jQuery(document).bind('keydown', 'f7',function (evt){jQuery('#_f6').addClass('dirty');
 	evt.keyCode=0;
	evt.returnValue=false;
 return false; }); 
 
 jQuery(document).bind('keydown', 'f8',function (evt){jQuery('#_f6').addClass('dirty');
 	evt.keyCode=0;
	evt.returnValue=false;
 return false; }); 
 
 jQuery(document).bind('keydown', 'f9',function (evt){jQuery('#_f6').addClass('dirty');
 	evt.keyCode=0;
	evt.returnValue=false;
 return false; }); 
 jQuery(document).bind('keydown', 'f10',function (evt){jQuery('#_f6').addClass('dirty');
 	evt.keyCode=0;
	evt.returnValue=false;
 return false; }); 
 </script> 





<script>

var scrollDivs=new Array();
scrollDivs[0]="sucursal";
scrollDivs[1]="divUbigeo";

function recargar(){
document.form1.submit();
}

function nuevo_suc(texto){

//alert(texto);
var r = texto.split('pestana');
document.getElementById('dhtmlgoodies_tabView1').getElementsByTagName('DIV')[3].innerHTML=r[0];
document.getElementById('dhtmlgoodies_tabView1').getElementsByTagName('DIV')[4].innerHTML=r[1];
document.getElementById('sucursal').style.display='block';
seleccionar_combo();
seleccionar_combo2();
seleccionar_combo3();
seleccionar_combo4();
//seleccionar_combo2();

//alert('entro');
//document.form1.txtnombre.focus();

//initTabs('dhtmlgoodies_tabView1',Array('General','Datos adicionales'),0,500,200,Array(false,false));

//alert(dhtmlgoodies_tabObj);

}

function ocultar(){
document.getElementById('sucursal').style.display='none';
}


function seleccionar_combo(){

 	 var valor1=document.form1.t_persona2.value;;
     var i;
	 for (i=0;i<document.form1.t_persona.options.length;i++)
        {
		
            if (document.form1.t_persona.options[i].value==valor1)
               {
			   
               document.form1.t_persona.options[i].selected=true;
               }
        
        }
		
		cambiar_persona();
		
}
function seleccionar_combo2(){

 	 var valor1=document.form1.condicion2.value;;
     var i;
	 for (i=0;i<document.form1.condicion.options.length;i++)
        {
		
            if (document.form1.condicion.options[i].value==valor1)
               {
			   
               document.form1.condicion.options[i].selected=true;
               }
        
        }
		
	
		
}
function seleccionar_combo3(){

 	 var valor1=document.form1.responsable2.value;;
     var i;
	 for (i=0;i<document.form1.responsable.options.length;i++)
        {
		
            if (document.form1.responsable.options[i].value==valor1)
               {
			   
               document.form1.responsable.options[i].selected=true;
               }
        
        }
		
	
		
}
function seleccionar_combo4(){

 	 var valor1=document.form1.clas_clie2.value;;
     var i;
	 for (i=0;i<document.form1.clas_clie.options.length;i++)
        {
		
            if (document.form1.clas_clie.options[i].value==valor1)
               {
			   
               document.form1.clas_clie.options[i].selected=true;
               }
        
        }
		
	
		
}





function validar_datos(){
    var mov = "<? echo $_REQUEST['mov']; ?>";
	//alert(mov);
	var persona=document.form1.t_persona.value;
	//alert(persona);
	if(persona=='juridica'){
		
		//alert(document.form1.ruc.value.substring(0,2));
		if(document.form1.tipoprov.value=='1'){		
			if(!(document.form1.ruc.value.substring(0,2)>=10 &&  document.form1.ruc.value.substring(0,2)<=20)){
					//&&  ruc.substring(0,2)!='15'
				alert('Ingrese un número de ruc válido');
				return false;
				document.formulario.document.form1.ruc.value.select();
				document.formulario.document.form1.ruc.value.focus();
			}
		}
		
		if(document.form1.razonsocial.value==''){
		alert('Ingrese un nombre de cliente ó Razón social válida');
		return false;
		}
		
		if(document.form1.tipoprov.value=='1'){	
			if(document.form1.ruc.value=='' || document.form1.ruc.value.length!=11 ){
			alert('Ingrese un número de ruc válido');
			return false;
			}
		}
		
	}
	
	if(persona=='natural'){

		if(document.form1.razonsocial.value=='' ){
		alert('Ingrese un nombre de cliente ó Razón social válida');
		return false;
		}
		
		/*if(document.form1.docu_iden.value=='' || document.form1.docu_iden.value.length!=8 ){
		alert('Ingrese un número de documento válido');
		return false;
		}
		*/
	}
	
	//COMFIRMAR SI TIENE MOVIMIENTOS
    /*if( mov == 'ok' )
	{	if(confirm("**************   ESTE CLIENTE YA REALIZO MOVIMIENTOS  **************")){  return true;		}
		else{ return false; }
	}*/
	return true;
}
</script>




<link href="styles.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
body {
	background-image: url(imagenes/bg3.jpg);
}
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
.Estilo12 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color:#333333 }
.Estilo13 {font-size: 11px}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo21 {font-size: 12px; color: #000000; font-family: Arial, Helvetica, sans-serif; }
.Estilo22 {font-family: Tahoma, Arial}
.Estilo23 {font-size: 10px}
.Estilo24 {font-family: Arial, Helvetica, sans-serif}
.Estilo25 {font-family: Georgia, "Times New Roman", Times, serif}
.Estilo26 {font-family: "Times New Roman", Times, serif}
.Estilo27 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo28 {color: #000000}
.Estilo29 {color: #333333}
.Estilo30 {
	color: #000000;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 10px;
}
.Estilo16 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #FFFFFF;
}
.Estilo113 {color: #CC3300;
	font-weight: bold;
	font-size: 10px;
	font-family: Arial, Helvetica, sans-serif;
}


-->
</style>
</head>

<!--<body bgcolor="#FFFFFF" onLoad="cargar_reg();carga();">-->
<body bgcolor="#FFFFFF" onLoad="document.form1.valor.focus(); filtrar('');">

<form name="form1" method="post" action="maestro_cliente.php" onSubmit="return validar_datos();">
  <table width="760" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" >
    <tr  style="background:url(imagenes/white-top-bottom.gif)">
      <td width="1033" height="27" colspan="11" style="border:#999999">
	  <span class="Estilo1">Administraci&oacute;n :: Auxiliares :: <?php echo $texto?><span class="text4">
        <input name="auxiliar" type="hidden" id="auxiliar" value="<?php echo $tipo_aux; ?>">
      </span></span>	  </td>
    </tr>
    <tr style="background:url(imagenes/botones.gif)">
      <td height="30" colspan="11" >
	  
	  <table width="788" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="77" height="31">
		  <script>
		  function entrar_btn(obj){
		  obj.cells[0].style.backgroundImage="url(imagenes/bordes_boton1.gif)";
		  obj.cells[1].style.backgroundImage="url(imagenes/bordes_boton2.gif)";
		  obj.cells[2].style.backgroundImage="url(imagenes/bordes_boton2.gif)";
		  obj.cells[3].style.backgroundImage="url(imagenes/bordes_boton3.gif)";
		  
		  }
		  function salir_btn(obj){
		  obj.cells[0].style.backgroundImage="";
		  obj.cells[1].style.backgroundImage="";
		  obj.cells[2].style.backgroundImage="";
		  obj.cells[3].style.backgroundImage="";
		  
		  }
		  
		  
		  
		  </script>
		  <table title="Nuevo[F3]" width="71" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="javascript:nuevo()">
              <td width="3" ></td>
              <td width="18" align="center" ><span class="Estilo28"><img src="imagenes/nuevo.gif" width="14" height="16"></span></td>
              <td width="52" ><span class="Estilo28">Nuevo<span class="Estilo113">[F3]</span> </span></td>
              <td width="3" ></td>
            </tr>
          </table></td>
          <td width="82"><table width="75" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="editar('actualizar')">
              <td width="3" ></td>
              <td width="20" ><img src="imgenes/ico_edit.gif" alt="Editar" width="16" height="16" border="0"></td>
              <td width="48" ><span class="Estilo28">Editar<span class="Estilo113">[F6]</span></span></td>
              <td width="4" ></td>
            </tr>
          </table></td>
          <td width="88"><table width="100" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="eliminar('A')">
              <td width="3" ></td>
              <td width="17" ><span class="Estilo28"><img src="imgenes/debaja.png" width="16" height="16"></span></td>
              <td width="83" ><span class="Estilo28">Dar de Baja<span class="Estilo113">[F5]</span> </span></td>
              <td width="3" ></td>
            </tr>
          </table></td>
		  <td width="88"><table width="100" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="eliminar('E')">
              <td width="3" ></td>
              <td width="17" ><span class="Estilo28"><img src="imgenes/eliminar.png" width="16" height="16"></span></td>
              <td width="83" ><span class="Estilo28">Eliminar<span class="Estilo113">[F4]</span> </span></td>
              <td width="3" ></td>
            </tr>
          </table></td>
          <td width="349">
		  
		  <table width="85" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="act_aux('x')">
              <td width="3" ></td>
              <td width="20" ><span class="Estilo28"><img src="imgenes/refresh.png" width="16" height="16"></span></td>
              <td width="59" ><span class="Estilo28">Actualizar </span></td>
              <td width="3" ></td>
            </tr>
          </table></td>
          <td width="132">&nbsp;</td>
          <td width="92">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="27" colspan="11"><table width="275" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="37"><span class="Estilo7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Buscar</b>&nbsp;</span></td>
          <td width="115"  align="left"><select name="criterio">
              <option value="codcliente">Codigo Sistema</option>
              <option value="razonsocial" selected>Razon Social</option>
              <option value="ruc">Ruc</option>
			  <option value="direccion">Direcci&oacute;n</option>
			            </select></td>
          <td width="38"><span class="Estilo29"><input autocomplete="off" name="valor" type="text"  style="height:20; border-color:#CCCCCC" size="30" maxlength="100" onKeyUp="filtrar('')"></span></td>
          <td width="193" align="right"></td>
          <td width="44" align="left"><img src="imagenes/lupa5.gif" width="18" height="20"></td>
        </tr>
      </table></td>
    </tr>
    
    <tr bordercolor="#CCCCCC" >
      <td height="23" colspan="11" align="left" style="padding-left:05px;"  ><table width="800" height="23" border="0" cellpadding="1" cellspacing="1" style="border:#D8D8D8 solid 1px">
        <tr style="background-image:url(imagenes/grid3-hrow-over.gif)" bordercolor="#CCCCCC"  bgcolor="#F9F9F9" >
          <td width="14"  align="center">&nbsp;</td>
          <td class="Estilo30" colspan="2">Razon Social </td>
          <!--<td width="40" class="Estilo30">Tipo</td>-->
          <td class="Estilo30" colspan="2" >Ruc/Dni</td>
          <!--<td width="65" class="Estilo30">Dni</td>-->
          <td width="165" class="Estilo30">Direcci&oacute;n</td>
          <td width="94" class="Estilo30">Tel&eacute;fono</td>
          <!--<td width="76" class="Estilo30">Clasificacion</td>
		  <?php //if($tipo_aux=="C"){?><td width="73" class="Estilo30">Condicion</td><?php //} ?>-->
          <td width="61" class="Estilo30">Baja</td>
          <td width="43" align="left"><span class="Estilo30">Codigo</span></td>
        </tr>
      </table></td>
    </tr>
    <tr bordercolor="#CCCCCC" >
      <td colspan="11" align="left">
	  
<div id="detalle_aux"></div>  </td>
    </tr>
   
    
    <tr>
      <td height="56" colspan="11">&nbsp;</td>
    </tr>
  </table>
   <div id="sucursal" style="position:absolute; left:180px; top:90px; width:350px; height:280px; z-index:1; display:none">
   
    <table  width="500" height="282" border="1" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
  <td height="24" bgcolor="#003366">
    <span class="Estilo16">&nbsp;&nbsp;Datos Auxiliar    </span></td>
  </tr>
  
  
  <tr>
    <td width="583" valign="top">
	
<DIV id=dhtmlgoodies_tabView1>


<DIV class=dhtmlgoodies_aTab>
	
	<table width="489" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="5" align="right"></td>
      </tr>
      
      <tr>
        <td width="13" bgcolor="#FFE7D7">&nbsp;</td>
        <td colspan="2" bgcolor="#FFE7D7">&nbsp;</td>
        <td width="19" bgcolor="#FFE7D7">&nbsp;</td>
        <td width="8" bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td rowspan="8" bgcolor="#FFE7D7">&nbsp;&nbsp;</td>
        <td width="70" height="21" bgcolor="#FFE7D7" class="Estilo12">Codigo</td>
        <td width="379" bgcolor="#FFE7D7"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input  readonly="readonly" name="codigo" type="text"  style="height:18; font-size:10px; font:bold" size="10" value="<?php echo $codigo?>" />
        </strong></font> <span class="Estilo12">Persona</span>
        <select style="height:18; font-size:10px" name="t_persona" onChange="cambiar_persona()">
          <option value="natural">Natural</option>
          <option value="juridica">Jur&iacute;dica o Natural con ruc</option>
        </select>
          <input type="hidden" name="t_persona2" value="<?php echo  $t_persona; ?>" /></td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
        <td rowspan="8" bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td height="21" bgcolor="#FFE7D7" class="Estilo12">Cli./R. Soc. </td>
        <td bgcolor="#FFE7D7" class="Estilo12">
          <input autocomplete="off" name="razonsocial" type="text"  style="height:18; font-size:10px" value="<?php echo $razonsocial?>" size="46" maxlength="100" />
          Ruc &nbsp;&nbsp;
          <input autocomplete="off" name="ruc" disabled="disabled" type="text"  style="height:18; font-size:10px; margin:2px" value="<?php echo $ruc?>" size="15" maxlength="11" />        </td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td height="21" bgcolor="#FFE7D7" class="Estilo12">Doc Iden. </td>
        <td bgcolor="#FFE7D7" class="Estilo12">
          <input autocomplete="off" name="docu_iden" type="text"  style="height:18; font-size:10px" value="<?php echo $doc_iden?>" size="15" maxlength="8" />
        Telefonos
        <input name="telefono" type="text"  style="height:18; font-size:10px; margin-left:3px" value="<?php echo $telefono?>" size="15" maxlength="100" />
        Cargo 
        <input name="cargo" type="text"  style="height:18; font-size:10px" size="15" value="<?php echo $cargo?>" />        </td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td height="21" bgcolor="#FFE7D7" class="Estilo12">Direcci&oacute;n</td>
        <td bgcolor="#FFE7D7">
          <input name="direccion" type="text"  style="height:18; font-size:10px" value="<?php echo $direccion?>" size="46" maxlength="100" />        </td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      
      <tr>
        <td height="21" bgcolor="#FFE7D7" class="Estilo12">Contacto</td>
        <td height="22" bgcolor="#FFE7D7"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="contacto" type="text"  style="height:18; font-size:10px" value="<?php echo $contacto?>" size="46" maxlength="100" />
           &nbsp;
           <input  style="width:120; font-size:10px; margin:2px" type="button" name="Submit" value="Datos Adicionales" />
        </strong></font></td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td height="23" bgcolor="#FFE7D7" class="Estilo12">Email</td>
        <td height="23" bgcolor="#FFE7D7" class="Estilo12">
          <input name="email" type="text"  style="height:18; font-size:10px" value="<?php echo $email?>" size="31" maxlength="100" />
          &nbsp;Web
          <input name="email2" type="text"  style="height:18; font-size:10px" value="<?php echo $email?>" size="31" maxlength="100" />        </td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td height="42" colspan="2" bgcolor="#FFE7D7"><table width="459" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="158" height="12" class="Estilo12">Clasificaci&oacute;n</td>
            <td width="154" class="Estilo12">Condici&oacute;n</td>
            <td width="147" class="Estilo12">Responsable</td>
          </tr>
          <tr>
            <td><span class="Estilo15">
              <select name="clas_clie" style="width:140"  >
                <?php 
		    $resultados11 = mysql_query("select * from clas_clie order by nombre ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
		  ?>
                <option value="<?php echo $row11['codigo']?>"><?php echo $row11['nombre'];?></option>
                <?php }?>
              </select>
            </span></td>
            <td><span class="Estilo15">
              <select name="condicion" style="width:140" >
                <?php 
		    $resultados11 = mysql_query("select * from condicion order by nombre ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
		  ?>
                <option value="<?php echo $row11['codigo']?>"><?php echo $row11['nombre'];?></option>
                <?php }?>
              </select>
            </span></td>
            <td><span class="Estilo15">
              <select name="responsable" style="width:140" >
                <?php 
		    $resultados11 = mysql_query("select * from usuarios order by usuario ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
		  ?>
                <option value="<?php echo $row11['codigo']?>"><?php echo $row11['usuario'];?></option>
                <?php }?>
              </select>
            </span></td>
          </tr>
        </table></td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      
      
      <tr>
        <td height="19" colspan="2" bgcolor="#FFE7D7">
		<input type="hidden" name="accion" value="<?php echo $_REQUEST['accion']?>" />
          <font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Dar de Baja
          <input type="checkbox" name="baja" value="S" style="cursor:default; border:none " 
		  <?php if($baja=='S'){echo "checked=checked"; }?> />
          </strong></font></td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      
      <tr>
        <td bgcolor="#FFE7D7">&nbsp;</td>
        <td colspan="2" align="right" bgcolor="#FFE7D7"><label for="Submit"></label>
          <input style="font-size:10px" type="submit" name="guardar" value="Guardar" id="guardar">
          <input style="font-size:10px" type="button" name="Submit2" value="Cancelar" id="Submit2"  onclick="ocultar();"></td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      
    </table>
	
	</DIV>
  
	<DIV class=dhtmlgoodies_aTab>Content of tab 4<BR>
	</DIV>

	</DIV>
	
	
	
	</td>
  </tr>
</table>
	
		
  </div>

  
<div id="divUbigeo" style="position:absolute; left:200px; top:200px; width:300px; height:180px; z-index:2; visibility:hidden"> </div>
</form>
</body>



<script>

initTabs('dhtmlgoodies_tabView1',Array('General','Datos adicionales'),0,500,200,Array(false,false));

function editar(){
    var auctip ="<? echo $tipo_aux ?>";
	//if(confirm('Esta seguro de modificar este cliente ')){	
		
		if(document.form1.xaux.length >0){
		
	//	alert(document.form1.xaux.length);
		  for (var i=0;i<document.form1.xaux.length;i++){ 
			   if (document.form1.xaux[i].checked) {
			   var cod=document.form1.xaux[i].value;
			   break; 
			   }
				//  
			} 
		}else{	
		var cod=document.form1.xaux.value;
		}	
var aux="<?php echo $_REQUEST['auxiliar'] ?>";
			
doAjax('new_cliente.php','accion=e&cod='+cod+'&auctip='+auctip+'&aux='+aux,'nuevo_suc','get','0','1','','');
//}
}

function eliminar(tip){

	var mesa="";

	if(tip=='A'){
		mesa='Esta seguro que desea dar de baja a este auxiliar ';
	}else if(tip=='E'){
		mesa='Esta seguro que desea eliminar a este auxiliar ';
	}

	for (var i=0;i<document.form1.xaux.length;i++){ 
		if (document.form1.xaux[i].checked) {
			var cod=document.form1.xaux[i].value;
			break; 
		}
	}

	var auxiliar=document.form1.auxiliar.value;

	if(confirm(mesa)){
	var lnk = 'maestro_cliente.php?auxiliar='+auxiliar+'&cod='+cod+'&tip='+tip;
		//alert(lnk);
		location.href=lnk;
	}

}



function cambiar_persona(){
var persona=document.form1.t_persona.value;

	if(persona=='natural'){
	document.form1.ruc.disabled=true;
	document.form1.ruc.value='';
	document.form1.docu_iden.disabled=false;
	}else{
	document.form1.docu_iden.disabled=true;
	document.form1.docu_iden.value='';
	document.form1.ruc.disabled=false;
	}
}

var temp="";
function entrada(objeto){
//	objeto.style.background='url(imagenes/sky_blue_sel.png)';
	objeto.cells[0].childNodes[0].checked=true;
//	temp=objeto;
	if(objeto.style.background=='url(imagenes/sky_blue_sel.png)'){
	//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='url(imagenes/sky_blue_sel.png)';
	
	temp.style.background=temp.bgColor;;
	//'#E9F3FE';
	temp=objeto;
	}

}


function cargar_reg(){
document.getElementById('lista_aux').rows[0].style.background='url(sky_blue_sel.png)';
temp=document.getElementById('lista_aux').rows[0];
document.getElementById('lista_aux').rows[0].cells[0].childNodes[0].checked=true;
}


function filtrar(pagina){
var tipo_aux=document.form1.auxiliar.value;
var filtro=document.form1.valor.value;
var criterio=document.form1.criterio.value;
doAjax('new_cliente.php','filtro='+filtro+'&tipo_aux='+tipo_aux+'&criterio='+criterio+'&pagina='+pagina,'cargar_detalle','get','0','1','','');
}


function cargar_detalle(datos){
//alert(datos);
document.getElementById('detalle_aux').innerHTML=datos;
	if(document.getElementById('lista_aux').rows.length >0){
	cargar_reg();
	}

}

function nuevo(){
var aux="<?php echo $_REQUEST['auxiliar'] ?>";
//alert(aux);
doAjax('new_cliente.php','accion=n&aux='+aux,'nuevo_suc','get','0','1','','')
}

function activar_estados(control){

	if(control.checked){
	document.form1.estado_percep[0].disabled=false;
	document.form1.estado_percep[1].disabled=false;
	document.form1.estado_percep[2].disabled=false;
	document.form1.por_percep.disabled=false;
	document.form1.por_percep.focus();
	document.form1.por_percep.select();
	document.form1.estado_percep[0].checked=true;
	}else{
	
	document.form1.estado_percep[0].disabled=true;
	document.form1.estado_percep[1].disabled=true;
	document.form1.estado_percep[2].disabled=true;
	//document.form1.por_percep.value="0.00";
	document.form1.por_percep.disabled=true;
	}

}

function activar_porc(control){

	if(control.checked){	
//	alert();
		if(control.value=='3'){
		document.form1.por_percep.disabled=true;
		}else{
		document.form1.por_percep.disabled=false;
		}
	}	
}


function activarLider(obj){

	if(obj.checked){
	document.form1.selectLider.options[0].selected=true;
	document.form1.selectLider.disabled=true;		
	}else{
	document.form1.selectLider.disabled=false;
	}
	
	
}


function lista_ubigeo(param){

	var valor=document.form1.busqDist.value;	
	doAjax('peticion_ajax5.php','&peticion=ubigeo&valor='+valor,'listaProd','get','0','1','','');
	
}

function listaProd(texto){
document.getElementById('divUbigeo').innerHTML=texto;
document.getElementById('divUbigeo').style.visibility="visible";
}

function salir(){
document.getElementById('divUbigeo').style.visibility="hidden";
}

var temp2="";
	function entrada2(objeto){
	//objeto.cells[0].childNodes[0].checked=true;
	//temp=objeto;
		if(objeto.style.background=='url(imagenes/sky_blue_sel.png)'){
	//objeto.style.background=objeto.bgColor;
		}else{
		objeto.style.background='url(imagenes/sky_blue_sel.png)';
			if(temp2!=''){
			//alert(temp.style.background);
			//alert(objeto.bgColor);
			temp2.style.background=temp2.bgColor;
			}
			temp2=objeto;
		}	
}

function sel_item(coddist,codprov,coddep,dist,prov,depa,idubigeo){
document.form1.distrito.value=dist;
//document.form1.distrito2.value=coddist;
document.form1.provincia.value=prov;
//document.form1.provincia2.value=codprov;
document.form1.departamento.value=depa;
//document.form1.departamento2.value=coddep;
document.form1.idubigeo.value=idubigeo;
salir();
}

function otras_direc(){

	var valor=document.form1.codigo.value;	
	//alert(valor);
	doAjax('peticion_ajax5.php','&peticion=lista_otrasDirec&valor='+valor,'listaProd','get','0','1','','');
	
}

function insertarDirecNuevo(){

	var valor=document.form1.codigo.value;
	var nuevaDirec=document.form1.nuevaDirec.value;	
		
	doAjax('peticion_ajax5.php','&peticion=lista_otrasDirec&valor='+valor+'&save=&nuevaDirec='+nuevaDirec,'listaProd','get','0','1','','');

}

function eliminarDirec(valor2){

	var valor=document.form1.codigo.value;
	var codDirecElim=valor2;	
		
	doAjax('peticion_ajax5.php','&peticion=lista_otrasDirec&valor='+valor+'&eliminar=&codDirecElim='+codDirecElim,'listaProd','get','0','1','','');

}
</script>
</html>