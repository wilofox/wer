<?php 
session_start();
include('conex_inicial.php');
include('../funciones/funciones.php');
?>
<script language="javascript" src="../miAJAXlib2.js"></script>
<script type="text/javascript" src="../javascript/mover_div.js"></script>
<SCRIPT src="../javascript/popup.js" type=text/javascript></SCRIPT>

<script>
function recalculo_punto(res){
//location.href='maestro_transportista.php?x';
if (document.getElementById('txtCPlaca').value!=''){
	res=document.getElementById('txtCPlaca').value;
	peticion='rec_puntoUno';
}else{
	peticion='rec_punto';
}
//alert(res+'//'+peticion);
	if(confirm('Desea confirmar recalculo de puntos \n  Esto puede tardar unos minutos')){		
		Popup.showModal('modal');
		doAjax('peticion_datos.php','&peticion='+peticion+'&codigo='+res,'mostrar_recalculo','get','0','1','','');
	}	
		
}

function mostrar_recalculo(texto){
	//alert(texto);
	Popup.hide('modal');
	filtrar('');
	//location.href='maestro_transportista.php?x';
}
</script>

<?php 

if(isset($_REQUEST['accion'])){
//echo "entro";
  $accion=$_REQUEST['accion'];
  $codigo=$_REQUEST['codigo'];
  $placa=$_REQUEST['placa'];
  $vehiculo=$_REQUEST['vehiculo'];
  $nom_t1=$_REQUEST['nom_t1'];
  $ape_t1=$_REQUEST['ape_t1'];
  $fecnac_t1=formatofecha($_REQUEST['fecnac_t1']);
  $dni_t1=$_REQUEST['dni_t1'];
  $telf_t1=$_REQUEST['telf_t1'];
  $dir_t1=$_REQUEST['dir_t1'];
  $nom_t2=$_REQUEST['nom_t2'];
  $ape_t2=$_REQUEST['ape_t2'];
  $fecnac_t2=formatofecha($_REQUEST['fecnac_t2']);
  $dni_t2=$_REQUEST['dni_t2'];
  $telf_t2=$_REQUEST['telf_t2'];
  $dir_t2=$_REQUEST['dir_t2'];
  $fec_alta=formatofecha($_REQUEST['fec_alta']);
  $fec_baja=($_REQUEST['fec_baja']);
  $baja=$_REQUEST['baja'];
  $estcli=$_REQUEST['estcli'];

  if($baja=='S' ){
 	 $fec_baja=cambiarfecha($fecha);
  }			
	
		
	 if($accion=='n'){			
						
			//----------------------------iamgenes-----------------------------
			$strSQL09="select * from transp_cliente where placa='".$placa."' ";
			$resultados = mysql_query($strSQL09,$cn);
			$cont=mysql_num_rows($resultados);
			$row=mysql_fetch_array($resultados);
			$cod_clie=$row['cod_trans'];
			
			//echo "cont".$cont;
					
			if($cont==0 && strlen($placa)<>0){
					
			$resultado3=mysql_query("select max(cod_trans) as codigo from transp_cliente",$cn);
			$row3=mysql_fetch_array($resultado3);			
			$codigo=$row3['codigo'];
			$codigo=str_pad($codigo+1,7,'0',STR_PAD_LEFT);
								
		$strSQL2= "insert into transp_cliente (cod_trans,placa,vehiculo,nom_t1,ape_t1,fecnac_t1,dni_t1,telf_t1,dir_t1,nom_t2,ape_t2,fecnac_t2,dni_t2,telf_t2,dir_t2,fec_alta) values ('".$codigo."','".$placa."','".$vehiculo."','".$nom_t1."','".$ape_t1."','".$fecnac_t1."' ,'".$dni_t1."' ,'".$telf_t1."' ,'".$dir_t1."' ,'".$nom_t2."' ,'".$ape_t2."' ,'".$fecnac_t2."' ,'".$dni_t2."','".$telf_t2."','".$dir_t2."','".cambiarfecha($fecha)."')";
				
				mysql_query($strSQL2);
				
			    unset($accion);
			}else{
			
				if (strlen($placa)==""){
				echo "<script>alert('Falta llenar Placa')</script>";
				}else{
				echo "<script>alert('Placa ya existen....')</script>";
				}
				//if($row['tipo_aux']==$tipo_aux || $row['tipo_aux']=='A'){
			
				//}else{
					/*if($row['tipo_aux']=='P'){
					echo "<script>if(confirm('Este Auxiliar ya se encuentra registrado como Proveedor...Desea agregarlo también como Cliente ?'))doAjax('new_cliente.php','upd_cod=".$cod_clie."','act_aux','get','0','1','','');</script>";
					}else{
					echo "<script>alert('Este Auxiliar ya se encuentra registrado como Cliente  ')</script>";
					}*/
				//}
						
				
				
			}
			
	}

	if($accion=='e'){
	
 $strSQL="update transp_cliente set nom_t1='".$nom_t1."',ape_t1='".$ape_t1."',fecnac_t1='".$fecnac_t1."',dni_t1='".$dni_t1."',telf_t1='".$telf_t1."',dir_t1='".$dir_t1."',nom_t2='".$nom_t2."',ape_t2='".$ape_t2."',fecnac_t2='".$fecnac_t2."',dni_t2='".$dni_t2."',telf_t2='".$telf_t2."',dir_t2='".$dir_t2."',fec_baja='".$fec_baja."',estado='".$estcli."',fec_alta='".$fec_alta."' where cod_trans='".$codigo."'";

mysql_query($strSQL);
}
}

//----------Anular------------------------
	
	if(isset($_REQUEST['cod'])){
	//echo "codigo eliminado".$_REQUEST['cod'];
	$strSQL0="select * from punto_mov where cod_trans='".$_REQUEST['cod']."'";
	$resultados0 = mysql_query($strSQL0,$cn);
	$cont_reg=mysql_num_rows($resultados0);
			
			
		if($cont==0){
		$strSQL="update transp_cliente set fec_baja='".date('Y-m-d')."' where cod_trans='".$_REQUEST['cod']."'";
		mysql_query($strSQL);
		}else{
		echo "<script>alert(' Este registro no se puede Anular porque tiene movimientos ')</script>";
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

<LINK href="../pestanas/tab-view.css" type=text/css rel=stylesheet>
<SCRIPT src="../pestanas/tab-view.js" type=text/javascript></SCRIPT>


<script src="../jquery-1.2.6.js"></script>
<script src="../jquery.hotkeys.js"></script>

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
 	event.keyCode=0;
	event.returnValue=false;
 return false; }); 
 jQuery(document).bind('keydown', 'f2',function (evt){jQuery('#_f6').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
	HistPunt('');
 return false; });
 jQuery(document).bind('keydown', 'f3',function (evt){jQuery('#_f6').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
	doAjax('new_cliente.php','accion=n','nuevo_suc','get','0','1','','')
 return false; }); 
  jQuery(document).bind('keydown', 'f4',function (evt){jQuery('#_f6').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
	punto_canje(this)
 return false; }); 
  jQuery(document).bind('keydown', 'f5',function (evt){jQuery('#_f5').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
	eliminar();
 return false; }); 
 jQuery(document).bind('keydown', 'f6',function (evt){jQuery('#_f6').addClass('dirty');
  	event.keyCode=0;
	event.returnValue=false;
	editar('actualizar');
 return false; }); 
 jQuery(document).bind('keydown', 'f7',function (evt){jQuery('#_f7').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
 return false; }); 
 jQuery(document).bind('keydown', 'f8',function (evt){jQuery('#_f8').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
 return false; }); 
 jQuery(document).bind('keydown', 'f9',function (evt){jQuery('#_f9').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
	recalculo_punto('x');
 return false; }); 
 jQuery(document).bind('keydown', 'f10',function (evt){jQuery('#_f10').addClass('dirty');
 	event.keyCode=0;
	event.returnValue=false;
 return false; }); 
 </script> 





<script>

var scrollDivs=new Array();
scrollDivs[0]="sucursal";

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
		
}

function validar_datos(){
    var mov = "<? echo $_REQUEST['mov']; ?>";
}
function importar(){
var excel='csv';
		window.open("excel/Quick_CSV_import_example.php?excel="+excel,'ventana','height=350 width=600 top=100 left=200 status=yes scrollbars=yes');
//window.showModalDialog("Importar excel/excel/Quick_CSV_import_example.php?excel="+excel,"","dialogWidth:600px;dialogHeight:490px,top=100,left=200,status=yes,scrollbars=yes");
	filtrar('');
	
}
function cambiar_color1(obj){
obj.style.background='#FFF1BB';
obj.style.border='#C0C0C0 solid 1px';
}

function cambiar_color2(obj){
obj.style.background='#F3F3F3';
obj.style.border=' ';
}
</script>




<link href="../styles.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
body {
	background-image: url(../imagenes/bg3.jpg);
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

<body bgcolor="#FFFFFF" onLoad="document.form1.valor.focus(); filtrar('');">
<form name="form1" method="post" action="maestro_transportista.php" onSubmit="return validar_datos();">
  <table width="760" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" >
    <tr  style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="1033" height="27" colspan="11" style="border:#999999">
	  <span class="Estilo1">Maestro :: Listado de transportista clientes</span>
	  <input name="auxiliar" type="hidden" id="auxiliar" value="<?php echo $tipo_aux; ?>">	  
	  <input name="orden" type="hidden" size="5" value="asc">
	  <input name="ordenar" type="hidden" size="5" value=""> 
	  <!--<A onClick="Popup.showModal('modal');return false;" href="#">Show Modal 
      Popup</A> <BR>-->
	  </td>
    </tr>
    <tr style="background:url(../imagenes/botones.gif)">
      <td height="30" colspan="11" >
	  
	  <table width="800" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="75" height="31">
		  <script>
		  function entrar_btn(obj){
		  obj.cells[0].style.backgroundImage="url(../imagenes/bordes_boton1.gif)";
		  obj.cells[1].style.backgroundImage="url(../imagenes/bordes_boton2.gif)";
		  obj.cells[2].style.backgroundImage="url(../imagenes/bordes_boton2.gif)";
		  obj.cells[3].style.backgroundImage="url(../imagenes/bordes_boton3.gif)";
		  
		  }
		  function salir_btn(obj){
		  obj.cells[0].style.backgroundImage="";
		  obj.cells[1].style.backgroundImage="";
		  obj.cells[2].style.backgroundImage="";
		  obj.cells[3].style.backgroundImage="";
		  
		  }
		  
		  
		  
		  </script>
		  <table title="Nuevo[F3]" width="75" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="javascript:nuevo()">
              <td width="3" ></td>
              <td width="18" align="center" ><span class="Estilo28"><img src="../imagenes/nuevo.gif" width="14" height="16"></span></td>
              <td width="52" ><span class="Estilo28">Nuevo<span class="Estilo113">[F3]</span> </span></td>
              <td width="3" ></td>
            </tr>
          </table></td>
		  <!--onClick="editar('actualizar')"-->
          <td width="76"><table title="Canje por Puntos[F4]" width="75" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="punto_canje(this)">
              <td width="3" ></td>
              <td width="20" ><img src="../imgenes/email_edit.gif" alt="Editar" width="16" height="16" border="0"></td>
              <td width="48" ><span class="Estilo28">Canje<span class="Estilo113">[F4]</span></span></td>
              <td width="4" ></td>
            </tr>
          </table></td>
          <td width="101"><table title="Dara de Baja [F5]" width="100" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="eliminar()">
              <td width="3" ></td>
              <td width="17" ><span class="Estilo28"><img src="../imgenes/debaja.png" width="16" height="16"></span></td>
              <td width="83" ><span class="Estilo28">Dar de Baja<span class="Estilo113">[F5]</span> </span></td>
              <td width="3" ></td>
            </tr>
          </table></td>
          <td width="79"><table width="75" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="editar('actualizar')">
              <td width="3" ></td>
              <td width="20" ><img src="../imgenes/ico_edit.gif" alt="Editar" width="16" height="16" border="0"></td>
              <td width="48" ><span class="Estilo28">Editar<span class="Estilo113">[F6]</span></span></td>
              <td width="4" ></td>
            </tr>
          </table></td>
          <td width="92"><table title="Imprimir listado [F7]" width="89" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="imprimir()">
              <td width="3" ></td>
              <td width="16" ><img src="../imgenes/fileprint.png" alt="Editar" width="16" height="16" border="0"></td>
              <td width="65" ><span class="Estilo28">Imprimir<span class="Estilo113">[F7]</span></span></td>
              <td width="5" ></td>
            </tr>
          </table></td>
          <td width="96">
		  
		  
		  <table title="Recalcular Puntos acumulados [F9]" width="96" height="21" border="0" cellpadding="0" cellspacing="0">
            <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="recalculo_punto('x')">
              <td width="3" ></td>
              <td width="17" ><span class="Estilo28"><img src="../imgenes/refresh.png" width="16" height="16"></span></td>
              <td width="71" ><span class="Estilo28">Rec&aacute;lculo<span class="Estilo113">[F9]</span> </span></td>
              <td width="5" ></td>
            </tr>
          </table>		  </td>
          <td colspan="2" rowspan="2">

  <table width="86%" height="27" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="93%"><fieldset>
      <legend>Carga de Puntos: Archivo a importar(CSV)</legend>
      <table height="30" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="15" align="center"></td>
          <td><input name='Bot&oacute;n' type='button' class="Estilo30"  value="Importar" onClick="importar(this)" /></td>
        </tr>
      </table>
    </fieldset></td>
    <td width="7%">&nbsp;</td>
  </tr>
</table>

		  
		  </td>
          </tr>
        <tr>
          <td height="31" colspan="6"><table width="275" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="37"><span class="Estilo7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Buscar :</b>&nbsp;</span></td>
              <td width="115"  align="left"><select name="criterio">
                  <option value="cod_trans">Codigo Sistema</option>
                  <option value="placa" selected>Placa</option>
                  <option value="nom_t1">Titular N&ordm;1</option>
                  <option value="nom_t2">Titular N&ordm;2</option>
                  <option value="dni_t1">DNI Tit. N&ordm;1</option>
                  <option value="dni_t2">DNI Tit. N&ordm;2</option>
              </select></td>
              <td width="38"><span class="Estilo29">
                <input autocomplete="off" name="valor" type="text"  style="height:20; border-color:#CCCCCC" size="30" maxlength="100" onKeyUp="filtrar('')">
              </span></td>
              <td width="193" align="right"></td>
              <td width="44" align="left"><img src="../imagenes/lupa5.gif" width="18" height="20"></td>
              <td width="44" align="left"><input name="txtCPlaca" type="text" id="txtCPlaca" size="6" maxlength="10"></td>
            </tr>
          </table>
            </td>
          </tr>
      </table></td>
    </tr>
    
    <tr bordercolor="#CCCCCC" >
      <td height="23" colspan="11" align="left" style="padding-left:05px;"  >
	  
	  <table width="800" height="23" border="0" cellpadding="1" cellspacing="1" style="border:#D8D8D8 solid 1px">
          <tr style="background-image:url(../imagenes/grid3-hrow-over.gif)" bordercolor="#CCCCCC"  bgcolor="#F9F9F9" >
          <td width="17"  align="center" class="Estilo30">-|-</td>
          
          <td width="47" class="Estilo30" onClick="ordenamiento('placa')" onMouseOver="entradaOrderY(this)" onMouseOut="entradaOrderY(this)">Placa</td>
          <td width="199" class="Estilo30" onClick="ordenamiento('ape_t1')" onMouseOver="entradaOrderY(this)" onMouseOut="entradaOrderY(this)">Titular N&ordm;1</td>
          <td width="199" class="Estilo30" onClick="ordenamiento('ape_t2')" onMouseOver="entradaOrderY(this)" onMouseOut="entradaOrderY(this)">Titular N&ordm;2</td>
          <td width="73" class="Estilo30" onClick="ordenamiento('fec_alta')" onMouseOver="entradaOrderY(this)" onMouseOut="entradaOrderY(this)">Fec. Alta </td>
          <td width="71" class="Estilo30">Fec.Baja</td>
          <td width="84" class="Estilo30" onClick="ordenamiento('saldo_punto')" onMouseOver="entradaOrderY(this)" onMouseOut="entradaOrderY(this)">Saldo punto </td>
		  <?php if($tipo_aux=="C"){?><?php } ?>
          <td width="83" class="Estilo30" onClick="ordenamiento('total_punto')" onMouseOver="entradaOrderY(this)" onMouseOut="entradaOrderY(this)">Total punto </td>
		  </tr>
      </table></td>
    </tr>
    <tr bordercolor="#CCCCCC" >
      <td colspan="11" align="left">
	  
<div id="detalle_aux">

</div>

  </td>
    </tr>
   
    
    <tr>
      <td height="56" colspan="11"><table width="424" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="10">&nbsp;</td>
            <td width="193"><table width="178" height="27" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="91%">
			  <fieldset>
            <legend>Leyenda</legend>
            <table width="109%" height="46" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="32%" height="15" align="center"><table style="border:#999999 solid 1px"  width="25" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td  height="8" bgcolor="#FF4646"></td>
                    </tr>
                </table></td>
                <td width="68%"><span class="Estilo122">Baja</span></td>
              </tr>
              <tr>
                <td height="15" align="center"><table style="border:#999999 solid 1px"  width="25" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td  height="8" bgcolor="#D2EFCB"></td>
                  </tr>
                </table>                  </td>
                <td><span class="Estilo122">Activos</span></td>
              </tr>
              <tr>
                <td height="16" align="center"><table style="border:#000000 solid 1px"  width="25" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td  height="8" bgcolor="#ffffff"></td>
                  </tr>
                </table></td>
                <td>Inactivos</td>
              </tr>
            </table>
            </fieldset>			  </td>
              <td width="9%">&nbsp;</td>
            </tr>
          </table>              </td>
            <td width="221"><table onClick="HistPunt('')"  style="cursor:pointer" onMouseOver="cambiar_color1(this)" onMouseOut="cambiar_color2(this)" width="113" border="0" cellpadding="0" cellspacing="0"  id="btn1" title="Historia de puntos"  >
              <tr>
                <td width="104" align="center"><img  src="../images/view_choose.gif" width="22" height="22"></td>
              </tr>
              <tr>
                <td height="24" align="center"><span class="Estilo1"><span style="color:#FF0000">[F2]</span>Hist.Puntos </span></td>
              </tr>
            </table></td>
          </tr>
        </table>
        </td>
    </tr>
  </table>      
  <DIV id=modal style="BORDER-RIGHT: white 3px solid;  BORDER-TOP: white 3px solid; DISPLAY: none;   BORDER-LEFT: white 3px solid;  BORDER-BOTTOM: white 3px solid; BACKGROUND-COLOR:#003366; "> 
    
	  <table width="270" height="150" border="0">
  <tr>
    <td align="center" style="font:Arial, Helvetica, sans-serif; font:bold; font-size:12; color:#FFFFFF">Espere un momento por favor</td>
  </tr>
  <tr>
		<td align="center" valign="bottom" style="font:Arial, Helvetica, sans-serif; font:bold; font-size:10; color:#FFFFFF">RECALCULANDO PUNTOS...</td>
  </tr>
  <tr>
    <td align="center"> <img height="45" width="45" src="../imgenes/cargando.gif">	 </td>
	 <tr>
    <td align="center"> 	
	 <INPUT name="button" type=button onClick="Popup.hide('modal')" value=OK style=" visibility:hidden">	 </td>
  </tr>
</table>
  </DIV>
  
   <div id="sucursal" style="position:absolute; left:198px; top:80px; width:350px; height:280px; z-index:1; display:none">
   
    <table  width="500" height="282" border="1" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
  <td height="24" bgcolor="#003366">
    <span class="Estilo16">&nbsp;&nbsp;Datos del Transportista    </span></td>
  </tr>
  
  
  <tr>
    <td width="583" valign="top">
	
<DIV id=dhtmlgoodies_tabView1>


<DIV class=dhtmlgoodies_aTab>
	
	<table width="490" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="4" align="right"></td>
      </tr>
      
      <tr>
        <td width="13" bgcolor="#FFE7D7">&nbsp;</td>
        <td colspan="2" bgcolor="#FFE7D7">&nbsp;</td>
        <td width="19" bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td rowspan="11" bgcolor="#FFE7D7">&nbsp;&nbsp;</td>
        <td width="70" height="21" bgcolor="#FFE7D7" class="Estilo12">C&oacute;digo</td>
        <td width="379" bgcolor="#FFE7D7"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="codigo" type="text"  style="height:18; font-size:10px; font:bold" value="<?php echo $codigo?>" size="7" maxlength="7"  readonly="readonly" />&nbsp;&nbsp;&nbsp;
        </strong></font> <span class="Estilo12">Placa </span>
        <input name="placa" type="text" value="<?php echo  $placa; ?>" size="8" maxlength="8" />
        &nbsp;&nbsp;&nbsp;<span class="Estilo12">Vehiculo</span><span class="Estilo12">
        <input name="vehiculo" type="text" id="vehiculo" value="<?php echo  $vehiculo; ?>" size="18" />
        </span></td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td height="21" bgcolor="#FFE7D7" class="Estilo12">Titular-1 Nomb.</td>
        <td bgcolor="#FFE7D7" class="Estilo12"><hr>
          <input autocomplete="off" name="nom_t1" type="text"  style="height:18; font-size:10px" value="<?php echo $nom_t1 ?>" size="15" />
          &nbsp;&nbsp;Apellido          
          <input autocomplete="off" name="ape_t1" type="text"  style="height:18; font-size:10px; margin:2px" value="<?php echo $ape_t1 ?>" size="38" />        </td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td height="21" bgcolor="#FFE7D7" class="Estilo12">Doc Iden. </td>
        <td bgcolor="#FFE7D7" class="Estilo12">
          <input autocomplete="off" name="dni_t1" type="text"  style="height:18; font-size:10px" value="<?php echo $dni_t1 ?>" size="9" maxlength="8" />
        Telef.
        <input name="telf_t1" type="text" id="telf_t1"  style="height:18; font-size:10px; margin-left:3px" value="<?php echo $telf_t1?>" size="15" maxlength="100" />
        Fec.Nac. 
      <input name="fecnac_t1" type="text" size="10" maxlength="50" value="<?php echo $fecnac_t1 ?>" ></td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td height="21" bgcolor="#FFE7D7" class="Estilo12">Direcci&oacute;n</td>
        <td bgcolor="#FFE7D7">
          <input name="dir_t1" type="text" id="dir_t1"  style="height:18; font-size:10px" value="<?php echo $dir_t1 ?>" size="46" maxlength="100" />        </td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      
      <tr>
        <td height="22" bgcolor="#FFE7D7" class="Estilo12">Titular-2 Nomb.</td>
        <td height="22" bgcolor="#FFE7D7">
          <hr />
          <input name="nom_t2" type="text" id="nom_t2"  style="height:18; font-size:10px" value="<?php echo $nom_t2?>" size="15" />
           &nbsp;<span class="Estilo12">Apellido
           <input name="ape_t2" type="text" id="ape_t2"  style="height:18; font-size:10px; margin:2px" value="<?php echo $ape_t2 ?>" size="38" autocomplete="off" />
           </span></td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td height="23" bgcolor="#FFE7D7" class="Estilo12">Doc Iden.</td>
        <td height="23" bgcolor="#FFE7D7" class="Estilo12">
          <input name="dni_t2" type="text" id="dni_t2"  style="height:18; font-size:10px" value="<?php echo $dni_t2 ?>" size="9" maxlength="100" />
          &nbsp;Telef.
          <input name="telf_t2" type="text" id="telf_t2"  style="height:18; font-size:10px" value="<?php echo $telf_t2 ?>" size="15" maxlength="100" />
          Fec.Nac.
          <input name="fecnac_t2" type="text" id="fecnac_t2" value="<?php echo $fecnac_t2?>" size="10" maxlength="50"></td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td height="21" bgcolor="#FFE7D7" class="Estilo12">Direcci&oacute;n</td>
        <td bgcolor="#FFE7D7"><input name="dir_t2" type="text" id="dir_t2"  style="height:18; font-size:10px" value="<?php echo $dir_t2 ?>" size="46" maxlength="100" />
        </td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td height="19" colspan="2" bgcolor="#FFE7D7"><input type="hidden" name="accion" value="<?php echo $_REQUEST['accion']?>" />
          <font face="Verdana, Arial, Helvetica, sans-serif" size="1px" color="#FF0000" style="<?=$ocut_est;?>"><strong>Dar de Baja
          <input type="checkbox" name="baja" value="<?=$baja;?>" style="cursor:default; border:none; <?=$ocut_est;?>" 
		  <?php if($baja=='S'){echo "checked=checked"; }?> />
          <input style="background-color:#FFE7D7; color:#000000; text-align:center; <?php if($baja!='S'){echo "visibility:hidden"; }?> " name="fec_baja" type="text" id="fec_baja" value="<?php echo $fec_baja ?>" size="9" readonly />
		  <b style="color:#000000">Estado</b>
          <input type="checkbox" name="estcli" value="S" style="cursor:default; border:none;" 
		  <?php if($estcli=='S'){echo "checked=checked"; }?> />
		  <input name="fec_alta" type="text" id="fec_alta"  value="<?php echo $fec_alta ?>" size="10" maxlength="10" />
          </strong></font></td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      
      <tr>
        <td bgcolor="#FFE7D7">&nbsp;</td>
        <td colspan="2" align="right" bgcolor="#FFE7D7"><label for="Submit"></label>
          <input style="font-size:10px" type="submit" name="guardar" value="Guardar" id="guardar">
          <input style="font-size:10px" type="button" name="Submit2" value="Cancelar" id="Submit2"  onclick="ocultar();"></td>
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
</form>
</body>



<script>

initTabs('dhtmlgoodies_tabView1',Array('General','Historial de Canjes'),0,500,200,Array(false,false));

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

function HistPunt(){
	if(document.form1.xaux.length >0){		
			 for (var i=0;i<document.form1.xaux.length;i++){ 
			   if (document.form1.xaux[i].checked) {
			   		var cod=document.form1.xaux[i].value;
			  	 	break; 
			   }
			}
	}else{
		var cod=document.form1.xaux.value;
	}		
			window.showModalDialog("historial_punto.php?codigo="+cod,"","dialogWidth:600px;dialogHeight:490px,top=100,left=200,status=yes,scrollbars=yes");


}
function eliminar(){

          for (var i=0;i<document.form1.xaux.length;i++){ 
			   if (document.form1.xaux[i].checked) {
			   var cod=document.form1.xaux[i].value;
			   break; 
			   }
				//  
			}

	var auxiliar=document.form1.auxiliar.value;

	if(confirm('Esta seguro que desea dar de baja a este Cliente Transportista ')){
	location.href='maestro_transportista.php?auxiliar='+auxiliar+'&cod='+cod;
	//this.form1.submit();
	}
//window.open('editar_producto.php?cod='+cod,'ventana','height=470 width=500');
}
function punto_canje(valor){
		if(document.form1.xaux.length >0){		
		  for (var i=0;i<document.form1.xaux.length;i++){ 
			   if (document.form1.xaux[i].checked) {
			   var cod=document.form1.xaux[i].value;
			   var bloquear=document.form1.bloquear[i].value;
			   var bloquearX=document.form1.bloquearX[i].value;			   
			   break; 
			   }
			} 
		}else{	
			var cod=document.form1.xaux.value;
			var bloquear=document.form1.bloquear.value;
			var bloquearX=document.form1.bloquearX.value;
		}	
		if (bloquear=='S'){
		alert('No se puede crear canje el cliente esta de baja....')
		return false;
		}
		if (bloquearX=='S'){
		alert('No se puede crear canje estado deshabilitado....')
		return false;
		}
//
//window.open("gen_doc.php?codigo="+cod,'ventana','height=480 width=600 top=100 left=200 status=yes scrollbars=yes');
window.showModalDialog("gen_doc.php?codigo="+cod,"","dialogWidth:600px;dialogHeight:490px,top=100,left=200,status=yes,scrollbars=yes");
	filtrar('');

}

var temp="";
function entrada(objeto){
//	objeto.style.background='url(imagenes/sky_blue_sel.png)';
	objeto.cells[0].childNodes[0].checked=true;
//	temp=objeto;
	if(objeto.style.background=='url(../imagenes/sky_blue_sel.png)'){
	//objeto.style.background=objeto.bgColor;
	}else{
	objeto.style.background='url(../imagenes/sky_blue_sel.png)';
	
	temp.style.background=temp.bgColor;;
	//'#E9F3FE';
	temp=objeto;
	}

}


function cargar_reg(){
document.getElementById('lista_aux').rows[0].style.background='url(../sky_blue_sel.png)';
temp=document.getElementById('lista_aux').rows[0];
document.getElementById('lista_aux').rows[0].cells[0].childNodes[0].checked=true;
}

function ordenamiento(Campo){
var ordenar=Campo;
var orden=document.form1.orden.value;
document.form1.ordenar.value=Campo;
var pagina=document.form1.pag.value;
filtrar(pagina);
	if(orden=='asc'){
		document.form1.orden.value="desc";
	}else{
		document.form1.orden.value="asc";
	}	
		
}

function filtrar(pagina){
var tipo_aux=document.form1.auxiliar.value;
var filtro=document.form1.valor.value;
var criterio=document.form1.criterio.value;
var ordenar=document.form1.ordenar.value;
var orden=document.form1.orden.value;
doAjax('new_cliente.php','filtro='+filtro+'&tipo_aux='+tipo_aux+'&criterio='+criterio+'&ordenar='+ordenar+'&orden='+orden+'&pagina='+pagina,'cargar_detalle','get','0','1','','');
}

function changeValue(selectBox) {
  selectedItem = selectBox[selectBox.selectedIndex];
  filtrar(selectedItem.value);
  //alert( selectedItem.value);
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
doAjax('new_cliente.php','accion=n&aux='+aux,'nuevo_suc','get','0','1','','')
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
function entradaOrderY(objeto){
	if(objeto.style.background=='url(../imagenes/sky_blue_sel3.png)'){
	objeto.style.background='url(../imagenes/grid3-hrow-over.gif)';
	}else{
	objeto.style.background='url(../imagenes/sky_blue_sel3.png)';
	}
}
</script>
</html>
