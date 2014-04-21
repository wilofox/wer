<?php 
session_start();
include('conex_inicial.php');

if(!isset($_REQUEST['sucursales'])){
$codsuc=1;
}else{
$codsuc=$_REQUEST['sucursales'];
}

if(isset($_POST['accion'])){
//echo "entro";
 $accion=$_POST['accion'];

				$codigo=$_REQUEST['codigo'];
				$des_tienda=$_REQUEST['des_tienda'];
				$telefono=$_REQUEST['telefono'];
				$direccion=$_REQUEST['direccion'];
				$cod_suc=$_REQUEST['sucursales'];
				$aplicaBon=$_REQUEST['checkbox'];
				//echo $codigo;
				
				if($aplicaBon=='')$aplicaBon='N';
				
	 if($accion=='n'){
			
						
		$strSQL2= "insert into tienda (cod_tienda,cod_suc,des_tienda,telefono,direccion,aplicaBon) values ('".$codigo."','".$cod_suc."','".$des_tienda."','".$telefono."','".$direccion."','".$aplicaBon."')";
				
				mysql_query($strSQL2);
	

				$campo="saldo".$codigo;
				$ant_campo=substr($codigo,0,1).str_pad((substr($codigo,1,2)-1),2,"0",STR_PAD_LEFT);
				//echo substr($codigo,0,1)."  ".str_pad((substr($codigo,1,2)-1),2,"0",STR_PAD_LEFT)."<br>";
				$ant_campo="saldo".$ant_campo;
				
				
			$strSQL_add="ALTER TABLE producto ADD $campo double NOT NULL AFTER $ant_campo " ;
			//echo $strSQL_add;
			mysql_query($strSQL_add,$cn);
			
			//	684126233  9086
				
	
			unset($accion);
				header("location: lista_tiendas.php?sucursales=$cod_suc");
		
			
	}

		if($accion=='e'){
		
	$strSQL="update tienda set des_tienda='".$des_tienda."',direccion='".$direccion."',telefono='".$telefono."',aplicaBon='".$aplicaBon."' where cod_tienda='".$codigo."'";
	
	//echo $strSQL;
	
	mysql_query($strSQL);
	}


}

?>
<script language="javascript" src="miAJAXlib2.js"></script>
<!--<script type="text/javascript" src="javascript/mover_div.js"></script>-->

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>administradores</title>
<link href="styles.css" rel="stylesheet" type="text/css">
<script src="jquery-1.2.6.js"></script>
<script src="jquery.hotkeys.js"></script>
<script>
	var scrollDivs = new Array();
	scrollDivs[0] = "sucursal";
	
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
		//alert(texto);
		var r = texto;
		document.getElementById('sucursal').innerHTML=r;
		document.getElementById('sucursal').style.visibility='visible';
		//alert('entro');
		//document.form1.txtnombre.focus();
	}
	
	function ocultar(){
		document.getElementById('sucursal').style.visibility='hidden';
		document.form1.accion.value='';
	}
	
	
	function graba(){
		document.form1.submit();
	}
	
	jQuery(document).bind('keydown', 'f2',function (evt){
		evt.keyCode = 0;
		evt.returnValue = false;
		graba();
	return false; });
	
	jQuery(document).bind('keydown', 'f3',function (evt){//jQuery('#_esc').addClass('dirty'); 
		evt.keyCode = 0;
		evt.returnValue = false;
		// alert("m");
		doAjax('new_tienda.php','accion=n&suc='+document.form1.sucursales.value,'nuevo_suc','get','0','1','','');
	return false; });
	
	jQuery(document).bind('keydown', 'esc',function (evt){
		// jQuery('#_esc').addClass('dirty'); 
		ocultar();
		evt.keyCode = 0;
		evt.returnValue = false;		
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
}
.Estilo15 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #FFFFFF; }
.Estilo16 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo18 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.Estilo34 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#003366;
	font-weight: bold;
}
.EstiloTexto1{
 font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#000000; font:bold;
}
-->
</style>
</head>


<?php 

?>


<body>
<form name="form1" method="post" action="lista_tiendas.php">
  <table width="100%" border="0">
    <tr style="background:url(imagenes/white-top-bottom.gif)">
       <td height="27" colspan="13" style="border:#999999">&nbsp;<span class="Estilo34">Administraci&oacute;n :: Locales / Tiendas </span></td>
    </tr>
    <tr>
      <td>
	  <table width="99%" height="21" border="0" cellpadding="0" cellspacing="0" style="border-bottom:#CCCCCC solid 1px">
        <tr>
          <td width="80" >
				<script>
					function entrar_btn(obj){
						obj.cells[0].style.backgroundImage="url(imagenes/bordes_boton1.gif)";
						obj.cells[1].style.backgroundImage="url(imagenes/bordes_boton2.gif)";
						obj.cells[2].style.backgroundImage="url(imagenes/bordes_boton2.gif)";
						//obj.cells[3].style.backgroundImage="url(../imagenes/bordes_boton3.gif)";
					}
					function salir_btn(obj){
						obj.cells[0].style.backgroundImage="";
						obj.cells[1].style.backgroundImage="";
						obj.cells[2].style.backgroundImage="";
						//obj.cells[3].style.backgroundImage="";
					}
				</script>
              <table title="Grabar [F2]" width="99" height="21" border="0" cellpadding="0" cellspacing="0">
                <tr  onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer;" onClick="graba()">
                  <td width="1" ></td>
                  <td width="15" ><span class="Estilo112"><img src="imgenes/revert.png" width="14" height="16"></span></td>
                  <td width="83" ><span class="Estilo112">Grabar<span class="Estilo113">[F2]</span></span></td>
                </tr>
            </table></td>
          <td width="76" ><table title="Nuevo[F3]" width="94" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="javascript: doAjax('new_tienda.php','accion=n&suc='+document.form1.sucursales.value,'nuevo_suc','get','0','1','','');" >
                <td width="1" ></td>
                <td width="15" align="center" ><span class="Estilo112"><img src="imagenes/nuevo.gif" width="14" height="16"></span></td>
                <td width="78" ><span class="Estilo112">Nuevo<span class="Estilo113">[F3]</span> </span></td>
              </tr>
          </table></td>
          <td width="79"><table  title="Salir [Esc]"width="89" height="21" border="0" cellpadding="0" cellspacing="0">
              <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="ocultar()" >
                <td width="1" ></td>
                <td width="16" ><img src="imagenes/salir.JPG"  width="16" height="16" border="0"></td>
                <td width="63" ><span class="Estilo112">Salir<span class="Estilo113">[Esc]</span></span></td>
                <td width="9" ></td>
              </tr>
          </table></td>
          <td width="56">&nbsp;</td>
          <td width="57">&nbsp;</td>
          <td width="51">&nbsp;</td>
          <td width="52">&nbsp;</td>
          <td width="141">&nbsp;</td>
        </tr>
      </table>
	  </td>
    </tr>
    <tr>
      <td><table width="659" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC" >


        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><span class="Estilo18">Empresas</span>
              <select name="sucursales" onChange="recargar();">
                <?php 
		
	
  $resultados1 = mysql_query("select * from sucursal order by des_suc ",$cn); 
while($row1=mysql_fetch_array($resultados1))
{
		?>
                <option value="<?php echo $row1['cod_suc'] ?>"><?php echo $row1['des_suc'] ?></option>
                <?php }?>
              </select>
              <script languaje="JavaScript" type="text/javascript">

     var valor1="<?php echo $codsuc?>";
     var i;
     for (i=0;i<document.form1.sucursales.options.length;i++)
        {
            if (document.form1.sucursales.options[i].value==valor1)
               {
               document.form1.sucursales.options[i].selected=true;
               }
        
        }

         </script>          </td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td width="11">&nbsp;</td>
        </tr>
        <tr height="20px" style="background:url(imagenes/sky_blue_grid.gif); border:#999999 solid 1px">

          <td width="87" align="center"  style=" border:#CCCCCC solid 1px" class="EstiloTexto1">C&oacute;digo</td>
          <td width="195" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Nombre</td>
          <td width="58"  style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Tel&eacute;fono</td>
          <td width="141" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Direcci&oacute;n</td>
          <td width="58" align="center" class="EstiloTexto1" style=" border:#CCCCCC solid 1px"><span class="EstiloTexto1" style=" border:#CCCCCC solid 1px">Oferta</span></td>
          <td colspan="2" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Acciones</td>
        </tr>
        <?php  
	
	//----------eliminando------------------------
	
	if(isset($_REQUEST['cod'])){
	//echo "codigo eliminado".$_REQUEST['cod'];
	$sql="select * from cab_mov where tienda='".$_REQUEST['cod']."'";
$total=mysql_num_rows(mysql_query($sql));
if($total==0){
	$strSQL="delete from tienda where cod_tienda='" . $_REQUEST['cod'] . "'";
	mysql_query($strSQL);
	echo "<script>alert('Tienda eliminada')</script>";
}else{
echo "<script>alert('Esta tienda no  se puede eliminar por que tiene documentos relacionados')</script>";
}
	}
	
	//-------------------------------------------
	
  $resultados = mysql_query("select * from tienda where cod_suc='$codsuc' order by cod_tienda ",$cn);
			 // echo "resultado".$resultado;
		//	  echo "select * from tienda where cod_suc='$codsuc' order by cod_tienda ";
while($row=mysql_fetch_array($resultados))
{
 ?>
        <tr  bgcolor="#FFFFFF" >
          <td align="center"><span class="Estilo12"><?php echo $row['cod_tienda'];?>&nbsp;</span></td>
          <td><span class="Estilo12"><?php echo $row['des_tienda'];?></span></td>
          <td><span class="Estilo12"><?php echo $row['telefono'];?></span></td>
          <td><span class="Estilo12"><?php echo $row['direccion'];?></span></td>
          <td align="center"><span class="Estilo12"><?php echo $row['aplicaBon'];?></span></td>
          <td width="42" align="center"><span class="Estilo13"><span class="Estilo12">&nbsp;<a href="javascript:editar('<?php echo $row['cod_tienda']?>');"><img src='imgenes/ico_edit.gif' border='0'></a></span></span></td>
          <td width="42" align="center"><span class="Estilo13"><span class="Estilo12"><a href="javascript:eliminar('<?php echo $row['cod_tienda']?>');"><img src="imgenes/eliminar.gif" border="0"></a></span></span></td>		  
        </tr>
        <?php  
			  
  }  
  mysql_free_result($resultados);
         		 
  ?>
        <tr>
          <td height="56" colspan="8">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
  <div id="sucursal" style="position:absolute; left:198px; top:100px; width:350px; height:180px; z-index:1; visibility:hidden"> </div>

  
</form>
</body>
	<script>
		function editar(cod){
			if(confirm('Esta seguro de modificar esta tienda puede tener docmentos relacionados')){
				doAjax('new_tienda.php','accion=e&cod='+cod,'nuevo_suc','get','0','1','','');
			}
		}
		function eliminar(cod){
			var suc=document.form1.sucursales.value;
			if(confirm('Esta seguro que desea eliminar este producto?')){
				location.href='lista_tiendas.php?sucursales='+suc+'&cod='+cod;
				//this.form1.submit();
			}
		//window.open('editar_producto.php?cod='+cod,'ventana','height=470 width=500');
		}
	</script>
</html>
