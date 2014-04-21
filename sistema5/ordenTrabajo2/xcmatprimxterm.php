<?php session_start();
		include('../conex_inicial.php');
		include('../funciones/funciones.php');
		
		
		
			if(isset($_REQUEST['new'])){
			$strSQL12="select max(num_model) as numero from materiapxptermi";
			$resultado12=mysql_query($strSQL12,$cn);
			$row12=mysql_fetch_array($resultado12);
			$numeroMasc=str_pad($row12['numero']+1,7,"0",STR_PAD_LENGTH);
			
			}else{
			    if(isset($_REQUEST['nummasc'])){
		
				$strSQL12="select * from materiapxptermi where  num_model='".$_REQUEST['nummasc']."'";
				$resultado12=mysql_query($strSQL12,$cn);
				$cantReg=mysql_num_rows($resultado12);	
				//echo $strSQL12;
					if($cantReg==0){
						$strSQL12="select max(num_model) as numero from materiapxptermi";
						$resultado12=mysql_query($strSQL12,$cn);
						$row12=mysql_fetch_array($resultado12);
						//echo $row12['numero'];
						//$numeroMasc= str_pad($row12['numero']+1,7,"0",STR_PAD_LENGTH);
						$numeroMasc=str_pad($row12['numero'],7,"0",STR_PAD_LENGTH);
					}else{//echo "dasf";
					$numeroMasc=$_REQUEST['nummasc'];
					}
				}else{
				$strSQL12="select max(num_model) as numero from materiapxptermi";
				$resultado12=mysql_query($strSQL12,$cn);
				$row12=mysql_fetch_array($resultado12);
				$numeroMasc=str_pad($row12['numero'],7,"0",STR_PAD_LENGTH);
				}
		   }
				
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Actividades de Obra</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
	color: #0066FF;
}
-->
</style>

<link href="../styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo13 {
	color: #333333;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.Estilo30 {color: #000000}
-->
</style>
<style type="text/css" media="print" >
.noprint{
visibility:hidden;
}
.noprint2{
background: transparent; 
border:0px
}
img { behavior: url(../ventas/iepngfix.htc); }
</style>
<script language="javascript">
function printer() 
{ 
vbPrintPage(); 
return false; 
} 
</script>
<SCRIPT LANGUAGE="VBScript"> 
Sub window_onunload 
On Error Resume Next 
Set WB = nothing 
End Sub 
Sub vbPrintPage 
OLECMDID_PRINT = 6 
OLECMDEXECOPT_DONTPROMPTUSER = 2 
OLECMDEXECOPT_PROMPTUSER = 1 
On Error Resume Next 
WB.ExecWB OLECMDID_PRINT, OLECMDEXECOPT_DONTPROMPTUSER, OLECMDEXECOPT_PROMPTUSER 
End Sub 
</SCRIPT>
<style type="text/css">
<!--
.Estilo35 {font-family: Arial, Helvetica, sans-serif}
.Estilo36 {color: #FFFFFF}
.Estilo113 {	color: #CC3300;
	font-weight: bold;
	font-size: 10px;
	font-family: Arial, Helvetica, sans-serif;
}
.Estilo114 {
	color: #003366;
	font-size: 12px;
}
.Estilo118 {color: #003366}
-->
</style>
</head>


<!--
<script src="../jquery-1.2.6.js"></script>
<script src="../jquery.hotkeys.js"></script>
<link rel="stylesheet" type="text/css" href="../administracion/estilos.css" media="all" />-->
<!--<script language="javascript" type="text/javascript" src="../administracion/csspopup2.js"></script>-->

	<script language="javascript" src="../Finanzas/miAJAXlib3.js"></script>
	<script src="../jquery-1.2.6.js"></script>
    <script src="../jquery.hotkeys.js"></script>
	<script type="text/javascript" src="../modalbox/lib/prototype.js"></script>
	<script type="text/javascript" src="../modalbox/lib/scriptaculous.js?load=effects"></script>	
	<script type="text/javascript" src="../modalbox/modalbox2.js"></script>
	<link rel="stylesheet" href="../modalbox/modalbox.css" type="text/css" />


<body style="vertical-align:top">
<form name="form1" id="form1" method="post" action="?">
  <table width="785" height="737" border="0" cellpadding="0" cellspacing="0">
  <tr  style="background:url(../imagenes/white-top-bottom.gif)">
      <td width="1033" height="27" colspan="11" style="border:#999999">
	  <span class="Estilo21 Estilo19 Estilo1 Estilo15 Estilo114"><span class="Estilo21 Estilo19 Estilo15 Estilo118"><strong> Ventas :: &Oacute;rdenes de Trabajo de Producci&oacute;n :: Transformaci&oacute;n / Producto Terminados
        <input name="auxiliar" type="hidden" id="auxiliar" value="<?php echo $tipo_aux; ?>">
      </strong></span></span>	  </td>
    </tr>
    <tr>
      <td width="6" height="20" rowspan="2" bgcolor="#E6E6E6">&nbsp;</td>
      <td width="61" align="center" bgcolor="#E6E6E6"><br></td>
      <td width="578" align="center" bgcolor="#E6E6E6">&nbsp;</td>
      <td align="center" bgcolor="#E6E6E6">&nbsp;</td>
      <td  width="9" rowspan="2" bgcolor="#E6E6E6">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" bgcolor="#E6E6E6"><br></td>
      <td align="center" bgcolor="#E6E6E6"><span class="Estilo30"><strong>Mascara Nº</strong>
          <?php // echo $numeroMasc?>
      </span>
        <input name="nummasc" type="text" onKeyPress="enviar(event)" size="8" maxlength="7" value="<?php echo $numeroMasc ?>"></td>
      <td align="center" bgcolor="#E6E6E6"><input type="button" name="Submit" value="Nueva Mascara" onClick="nuevaMasc()"></td>
    </tr>
    <tr>
      <td height="83">&nbsp;</td>
      <td colspan="3"><fieldset>
	  <legend style="color:#FF0000"> Materia Prima (ITEMS) </legend>
        <table width="609" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="38" colspan="3" ><table width="532" height="27" border="0">
                <tr>
                  <td width="38">Tienda:</td>
                  <td width="164">
				  
				  <?php 
				$disabled=" ";
				$strSQL="select * from materiapxptermi where num_model='".$numeroMasc."' and tipomat='1' order by id";
				$resultado=mysql_query($strSQL,$cn);
				$resultado2=mysql_query($strSQL,$cn);
				$cont=mysql_num_rows($resultado);
				if($cont>0){
				$disabled=" disabled ";
				}
				
				?>
				      <select <?php echo $disabled ?> name="tienda1" style="width:150"   >
	  <?php 
					  
					  
						$resultados11 = mysql_query("select * from tienda order by des_tienda ",$cn); 
						while($row11=mysql_fetch_array($resultados11)){
						
						$marcar=" ";
						if($_SESSION['user_tienda']==$row11['cod_tienda']){
							$marcar=" selected ";		
						}
					  ?>
		  		
		  
                      <option <?php echo $marcar; ?> value="<?php echo $row11['cod_tienda']?>"><?php echo $row11['des_tienda'];?></option>
                      <?php }?>
                    </select>				  </td>
                  <td width="72">Actualizar en: </td>
                  <td width="129">
				  <select  <?php echo $disabled ?>  name="act1">
				  <?php 
				  $row=mysql_fetch_array($resultado2);
				  $selectI=" ";
				  $selectS=" ";
				  $selectN=" ";
				  if($row['tipomov']=='I')$selectI=" selected ";
				  if($row['tipomov']=='S')$selectS=" selected ";
				  if($row['tipomov']=='')$selectN=" selected "; 
				  
				  ?>
                    <option <?php echo $selectI; ?> value="I">Ingreso</option>
                    <option <?php echo $selectS; ?> value="S">Salida</option>
					
                    <option <?php echo $selectN; ?>>Ninguno</option>
                  </select>
				  
				  </td>				  
                  <td width="107"><table title="Agregar Producto[F3]" onClick="addProd('1')" width="100" height="21" border="0" cellpadding="0" cellspacing="0">
                    <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer">
                      <td width="3" ></td>
                      <td width="20" ><img src="../imagenes/btnAdd.png" width="23" height="23"></td>
                      <td width="72" ><span class="Estilo30"> &nbsp;Agregar <span class="Estilo113">[F3]</span></span></td>
                      <td width="5" ></td>
                    </tr>
                  </table></td>
                </tr>
              </table>  </td>
          </tr>
          <tr style="background:url(../imagenes/bg_contentbase2.gif) 100%">
            <td width="82" height="18" align="center" ><span class="Estilo35 Estilo36"><strong>Codigo</strong></span></td>
            <td width="400"  class="Estilo13 Estilo35 Estilo36">Producto</td>
            <td width="54">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" bgcolor="#F5F5F5"><div id="capa_mat1" style="overflow-y:scroll; height:70px">
			<?php
			
			while($row=mysql_fetch_array($resultado)){
			list($nom_prod)=mysql_fetch_row(mysql_query("select nombre from producto where idproducto='".$row['producto']."'"));
	
			?>
			<table width="609" border="0" cellpadding="0" cellspacing="0">
				  <tr>
					<td width="75" align="center" bgcolor="#FFFFFF"><?php echo $row['producto']?></td>
					<td width="409" bgcolor="#FFFFFF"><?php echo $nom_prod; ?></td>
				    <td width="36" align="center" bgcolor="#FFFFFF"><img style="cursor:pointer" onClick="eliminarMat('<?php echo $row['id'] ?>','<?php echo $row['tipomat'] ?>')" src="../imgenes/eliminar.png" width="12" height="12"></td>
				  </tr>
			</table>
			<?php }?>
			</div></td>
          </tr>
        </table>
      </fieldset> </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="83">&nbsp;</td>
      <td colspan="3"><fieldset>
        <legend> Insumos Qu&iacute;micos </legend>
        <table width="536" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="38" colspan="3" ><table width="532" height="27" border="0">
              <tr>
                <td width="38">Tienda:</td>
                <td width="164">
				<?php 
				$disabled=" ";
				$strSQL="select * from materiapxptermi where num_model='".$numeroMasc."' and tipomat='2' order by id";
				$resultado=mysql_query($strSQL,$cn);
				$resultado2=mysql_query($strSQL,$cn);
				$cont=mysql_num_rows($resultado);
				if($cont>0){
				$disabled=" disabled ";
				}
				
				?>
				<select <?php echo $disabled ?> name="tienda2" style="width:150"   >
                    <?php 
					  
					  
						$resultados11 = mysql_query("select * from tienda order by des_tienda ",$cn); 
						while($row11=mysql_fetch_array($resultados11)){
						
						$marcar=" ";
						if($_SESSION['user_tienda']==$row11['cod_tienda']){
							$marcar=" selected ";		
						}
					  ?>
                    <option <?php echo $marcar; ?> value="<?php echo $row11['cod_tienda']?>"><?php echo $row11['des_tienda'];?></option>
                    <?php }?>
                  </select>                </td>
                <td width="72">Actualizar en: </td>
                <td width="129">
				<select  <?php echo $disabled ?>  name="act2">
                  <?php 
				  $row=mysql_fetch_array($resultado2);
				  $selectI=" ";
				  $selectS=" ";
				  $selectN=" ";
				  if($row['tipomov']=='I')$selectI=" selected ";
				  if($row['tipomov']=='S')$selectS=" selected ";
				  if($row['tipomov']=='')$selectN=" selected "; 
				  
				  ?>
                    <option <?php echo $selectI; ?> value="I">Ingreso</option>
                    <option <?php echo $selectS; ?> value="S">Salida</option>
					
                    <option <?php echo $selectN; ?>>Ninguno</option>
                  </select> 
				  
				  </td>
                <td width="107"><table title="Agregar Producto[F3]" onClick="addProd('2')" width="100" height="21" border="0" cellpadding="0" cellspacing="0">
                    <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer">
                      <td width="3" ></td>
                      <td width="20" ><img src="../imagenes/btnAdd.png" width="23" height="23"></td>
                      <td width="72" ><span class="Estilo30"> &nbsp;Agregar <span class="Estilo113">[F3]</span></span></td>
                      <td width="5" ></td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr style="background:url(../imagenes/bg_contentbase4.gif) 100%">
            <td width="82" height="18" align="center" ><span class="Estilo35 Estilo36"><strong>codigo</strong></span></td>
            <td width="398"  class="Estilo13 Estilo35 Estilo36">Producto</td>
            <td width="56">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" bgcolor="#F5F5F5"><div id="capa_mat2" style="overflow-y:scroll; height:70px">
			<?php
			
			while($row=mysql_fetch_array($resultado)){
			list($nom_prod)=mysql_fetch_row(mysql_query("select nombre from producto where idproducto='".$row['producto']."'"));
	
			?>
		<table width="520" border="0" cellpadding="0" cellspacing="0">
				  <tr>
					<td width="75" align="center" bgcolor="#FFFFFF"><?php echo $row['producto']?></td>
					<td width="409" bgcolor="#FFFFFF"><?php echo $nom_prod; ?></td>
				    <td width="36" align="center" bgcolor="#FFFFFF"><img style="cursor:pointer" onClick="eliminarMat('<?php echo $row['id'] ?>','<?php echo $row['tipomat'] ?>')" src="../imgenes/eliminar.png" width="12" height="12"></td>
				  </tr>
			</table>
			<?php }?>
			
			</div></td>
          </tr>
        </table>
        </fieldset>               </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="83">&nbsp;</td>
      <td colspan="3"><fieldset>
        <legend> Material de Empaque </legend>
        <table width="536" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="38" colspan="3" ><table width="532" height="27" border="0">
              <tr>
                <td width="38">Tienda:</td>
                <td width="164">
				<?php 
				$disabled=" ";
				$strSQL="select * from materiapxptermi where num_model='".$numeroMasc."' and tipomat='3' order by id";
				$resultado=mysql_query($strSQL,$cn);
				$resultado2=mysql_query($strSQL,$cn);
				$cont=mysql_num_rows($resultado);
				if($cont>0){
				$disabled=" disabled ";
				}
				
				?>
				<select <?php echo $disabled ?> name="tienda3" style="width:150"  >
                    <?php 
					  
					  
						$resultados11 = mysql_query("select * from tienda order by des_tienda ",$cn); 
						while($row11=mysql_fetch_array($resultados11)){
						
						$marcar=" ";
						if($_SESSION['user_tienda']==$row11['cod_tienda']){
							$marcar=" selected ";		
						}
					  ?>
                    <option <?php echo $marcar; ?> value="<?php echo $row11['cod_tienda']?>"><?php echo $row11['des_tienda'];?></option>
                    <?php }?>
                  </select>                </td>
                <td width="72">Actualizar en: </td>
                <td width="129">
				
				<select <?php echo $disabled ?>  name="act3">
                  <?php 
				  $row=mysql_fetch_array($resultado2);
				  $selectI=" ";
				  $selectS=" ";
				  $selectN=" ";
				  if($row['tipomov']=='I')$selectI=" selected ";
				  if($row['tipomov']=='S')$selectS=" selected ";
				  if($row['tipomov']=='')$selectN=" selected "; 
				  
				  ?>
                    <option <?php echo $selectI; ?> value="I">Ingreso</option>
                    <option <?php echo $selectS; ?> value="S">Salida</option>
					
                    <option <?php echo $selectN; ?>>Ninguno</option>
                  </select>
				  
				  </td>
                <td width="107"><table title="Agregar Producto[F3]" onClick="addProd('3')" width="100" height="21" border="0" cellpadding="0" cellspacing="0">
                    <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer">
                      <td width="3" ></td>
                      <td width="20" ><img src="../imagenes/btnAdd.png" width="23" height="23"></td>
                      <td width="72" ><span class="Estilo30"> &nbsp;Agregar <span class="Estilo113">[F3]</span></span></td>
                      <td width="5" ></td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr style="background:url(../imagenes/bg_contentbase4.gif) 100%">
            <td width="82" height="18" align="center" ><span class="Estilo35 Estilo36"><strong>codigo</strong></span></td>
            <td width="397"  class="Estilo13 Estilo35 Estilo36">Producto</td>
            <td width="57">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" bgcolor="#F5F5F5"><div id="capa_mat3" style="overflow-y:scroll; height:70px">
			<?php
		
			while($row=mysql_fetch_array($resultado)){
			list($nom_prod)=mysql_fetch_row(mysql_query("select nombre from producto where idproducto='".$row['producto']."'"));
	
			?>
			<table width="520" border="0" cellpadding="0" cellspacing="0">
				  <tr>
					<td width="75" align="center" bgcolor="#FFFFFF"><?php echo $row['producto']?></td>
					<td width="409" bgcolor="#FFFFFF"><?php echo $nom_prod; ?></td>
				    <td width="36" align="center" bgcolor="#FFFFFF"><img style="cursor:pointer" onClick="eliminarMat('<?php echo $row['id'] ?>','<?php echo $row['tipomat'] ?>')" src="../imgenes/eliminar.png" width="12" height="12"></td>
				  </tr>
			</table>
			<?php }?>
			</div></td>
          </tr>
        </table>
        </fieldset>             </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="83">&nbsp;</td>
      <td colspan="3"><fieldset>
        <legend> Producto Terminado </legend>
        <table width="536" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="38" colspan="3" ><table width="532" height="27" border="0">
              <tr>
                <td width="38">Tienda:</td>
                <td width="164">
				<?php 
				$disabled=" ";
				$strSQL="select * from materiapxptermi where num_model='".$numeroMasc."' and tipomat='4' order by id";
				$resultado=mysql_query($strSQL,$cn);
				$cont=mysql_num_rows($resultado);
				if($cont>0){
				$disabled=" disabled ";
				}
				
				?>
				<select <?php echo $disabled ?> name="tienda4" style="width:150"   >
				
                    <?php 
					    
					  
						$resultados11 = mysql_query("select * from tienda order by des_tienda ",$cn); 
						while($row11=mysql_fetch_array($resultados11)){
						
						$marcar=" ";
						if($_SESSION['user_tienda']==$row11['cod_tienda']){
							$marcar=" selected ";		
						}
					  ?>
                    <option <?php echo $marcar; ?> value="<?php echo $row11['cod_tienda']?>"><?php echo $row11['des_tienda'];?></option>
                    <?php }?>
                  </select>                </td>
                <td width="72">Actualizar en: </td>
                <td width="129">
				
				<select <?php echo $disabled ?>  name="act4">
				<?php 
				  $row=mysql_fetch_array($resultado2);
				  $selectI=" ";
				  $selectS=" ";
				  $selectN=" ";
				  if($row['tipomov']=='I')$selectI=" selected ";
				  if($row['tipomov']=='S')$selectS=" selected ";
				  if($row['tipomov']=='')$selectN=" selected "; 
				  
				  ?>
                    <option <?php echo $selectI; ?> value="I">Ingreso</option>
                    <option <?php echo $selectS; ?> value="S">Salida</option>					
                    <option <?php echo $selectN; ?>>Ninguno</option>
                 </select>
				  
                  </td>
                <td width="107"><table title="Agregar Producto[F3]" onClick="addProd('4')" width="100" height="21" border="0" cellpadding="0" cellspacing="0">
                    <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer">
                      <td width="3" ></td>
                      <td width="20" ><img src="../imagenes/btnAdd.png" width="23" height="23"></td>
                      <td width="72" ><span class="Estilo30"> &nbsp;Agregar <span class="Estilo113">[F3]</span></span></td>
                      <td width="5" ></td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr style="background:url(../imagenes/bg_contentbase4.gif) 100%">
            <td width="82" height="18" align="center" ><span class="Estilo35 Estilo36"><strong>codigo</strong></span></td>
            <td width="396"  class="Estilo13 Estilo35 Estilo36">Producto</td>
            <td width="58">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" bgcolor="#F5F5F5"><div id="capa_mat4" style="overflow-y:scroll; height:70px">
			<?php
			
			while($row=mysql_fetch_array($resultado)){
			list($nom_prod)=mysql_fetch_row(mysql_query("select nombre from producto where idproducto='".$row['producto']."'"));
	
			?>
			<table width="520" border="0" cellpadding="0" cellspacing="0">
				  <tr>
					<td width="75" align="center" bgcolor="#FFFFFF"><?php echo $row['producto']?></td>
					<td width="409" bgcolor="#FFFFFF"><?php echo $nom_prod; ?></td>
				    <td width="36" align="center" bgcolor="#FFFFFF"><img style="cursor:pointer" onClick="eliminarMat('<?php echo $row['id'] ?>','<?php echo $row['tipomat'] ?>')" src="../imgenes/eliminar.png" width="12" height="12"></td>
				  </tr>
			</table>
			<?php }?>
			</div></td>
          </tr>
        </table>
        </fieldset>      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="83">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
      <td height="19" colspan="2">&nbsp;</td>
      <td width="131" align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    
    <tr>
      <td height="19">&nbsp;</td>
      <td colspan="3" align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>

<DIV id=modal style="BORDER-RIGHT: white 3px solid;  BORDER-TOP: white 3px solid; DISPLAY: none;   BORDER-LEFT: white 3px solid;  BORDER-BOTTOM: white 3px solid; BACKGROUND-COLOR:#003366; "> 
   
<table width="270" height="150" border="0">
  <tr>
    <td align="center" style="font:Arial, Helvetica, sans-serif; font:bold; font-size:12; color:#FFFFFF">Espere un momento por favor</td>
  </tr>
  <tr>
    <td align="center" valign="bottom" style="font:Arial, Helvetica, sans-serif; font:bold; font-size:10; color:#FFFFFF">Procesando Datos...</td>
  </tr>
  <tr>
    <td align="center"> <img height="45" width="45" src="../imgenes/cargando.gif">	 </td>
	 <tr>
    <td align="center"> 	
	 <INPUT name="button" type=button onClick="Popup.hide('modal')" value=OK>	 </td>
  </tr>
</table>
    </DIV>
<OBJECT ID="WB" WIDTH="0" HEIGHT="0" CLASSID="clsid:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></OBJECT>
</body>
</html>




<script>

 <?php  
	  if($cantReg==0 && isset($_REQUEST['nummasc'])){
	  echo "alert('El numero de mascara solicitado no existe')";
	  }
	  
  ?>

function calularParcial(obj){

//var moneda=obj.parentNode.parentNode.cells[3].childNodes[0].value;
moneda=document.form1.monedacosto.value;
var costo=obj.parentNode.parentNode.cells[6].childNodes[0].value;
var cantidad=obj.parentNode.parentNode.cells[5].childNodes[0].value;
var tcDoc=parseFloat(document.form1.tcdoc.value);
//alert(moneda);
	if(moneda=='02'){
	obj.parentNode.parentNode.cells[7].childNodes[0].value=parseFloat(cantidad)*(costo)*tcDoc;	
	}else{
	obj.parentNode.parentNode.cells[7].childNodes[0].value=parseFloat(cantidad)*(costo);
	}
calcularMonTotal();

}

function calcularMonTotal(){

var monedaDoc=document.form1.monedadoc.value;
var tcDoc=parseFloat(document.form1.tcdoc.value);
var moneda;
var totalGeneral=0;

	for (var i=1;i<document.getElementById('tblCostos').rows.length;i++) {
	
	//moneda=document.getElementById('tblCostos').rows[i].cells[3].childNodes[0].value;
	cparcial=parseFloat(document.getElementById('tblCostos').rows[i].cells[7].childNodes[0].value);
	totalGeneral=parseFloat(totalGeneral) + parseFloat(cparcial);
/*	
		if(monedaDoc==moneda){
			totalGeneral=parseFloat(totalGeneral) + parseFloat(cparcial);	
		}else{
		
			if(moneda=='01'){
			totalGeneral=parseFloat(totalGeneral) + parseFloat(cparcial/tcDoc);
			}else{
			totalGeneral=parseFloat(totalGeneral) + parseFloat(cparcial*tcDoc);
			}
				
		}
	*/	//alert(totalGeneral);
	
	}
	document.form1.totalCostos.value=totalGeneral.toFixed(2);



}

function ltrim(str, filter){
  filter || ( filter = '\\s|\\&nbsp;' );
  var pattern = new RegExp('^(' + filter + ')*', 'g');
  return str.replace(pattern, "");
}
function rtrim(str, filter){
  filter || ( filter = '\\s|\\&nbsp;' );
  var pattern = new RegExp('(' + filter + ')*$', 'g');
  return str.replace(pattern, "");
}
function trim(str, filter){
  filter || ( filter = '\\s|\\&nbsp;' );
  return ltrim(rtrim(str, filter), filter);
}


function eliminar(cod){

if(document.getElementById('tblCostos').rows.length>2){
	document.form1.accion.value='delete';
	document.form1.idActxpre.value=cod;
	document.form1.submit();
}else{
alert("Debe haber al menos una actividad ingresada");
}
	
}
function guardar(){
	document.form1.accion.value='save';
	document.form1.submit();
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

function cambiar_fondo(control,evento){

	if(evento=='e')
	control.style.backgroundImage='url(../imagenes/boton_aplicar2.gif)';
	else
	control.style.backgroundImage='url(../imagenes/boton_aplicar.gif)';

}
function cerrar_capa(){
	document.form1.accion.value='insertProcesos';
	document.form1.submit();
}

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
  
  
  function addProd(valor){
  
	  if(valor==4){
	  var agrupado=2;
	  }else{
	  var agrupado=1;
	  }
  	
	  var randomnumber=Math.floor(Math.random()*99999);
	  Modalbox.show('materiaprima.php?ran='+randomnumber+'&agrupado='+agrupado+'&tipoMat='+valor, {title: 'Materia Prima / Insumos ', width: 500}); 
  
  }
  
  
  function entradae(objeto){
		//alert(objeto);
		if(document.activeElement.type=='text' || document.activeElement.type=='checkbox' ){
		//alert("");
			if(navigator.appName!='Microsoft Internet Explorer'){
			objeto.cells[0].childNodes[1].checked=false;
			}else{
			objeto.cells[0].childNodes[0].checked=false;
			}
		}
		//alert(objeto.innerHTML);
			if(objeto.style.background=='#fff1bb'  || objeto.style.background=='none repeat scroll 0% 0% rgb(255, 241, 187)' || objeto.style.background=='rgb(255, 241, 187)'){
			//alert(objeto.bgColor);
			objeto.style.background='#ffffff';
				if(navigator.appName!='Microsoft Internet Explorer'){
				objeto.cells[0].childNodes[1].checked=false;
				}else{
				objeto.cells[0].childNodes[0].checked=false;
				}
				
			//document.getElementById("label_cant_selec").innerHTML=contorl_item_selec();
			//document.form_series.cant_selec.value=contorl_item_selec();
			}else{
			  //alert(contorl_item_selec() +" "+ document.form_series.cant_req.value);
				
			
			objeto.style.background='#FFF1BB';
			if(navigator.appName!='Microsoft Internet Explorer'){
			objeto.cells[0].childNodes[1].checked=true;
			}else{
			objeto.cells[0].childNodes[0].checked=true;
			}
			//document.getElementById("label_cant_selec").innerHTML=contorl_item_selec();
			//document.form_series.cant_selec.value=contorl_item_selec();
			}
	
	}
  
  

  
  function aceptarMP(){
  
  if (document.form_series.checkbox.length==undefined){
		if (document.form_series.checkbox.checked  ){
			var valorChk=document.form_series.checkbox.value;
		}	
	}else{
		for(var i=0;i<document.form_series.checkbox.length;i++){
			if (document.form_series.checkbox[i].checked){
				var valorChk=valorChk+"|"+document.form_series.checkbox[i].value;
			}	
		}
	}		
   // alert(valorChk);
	
	var accion="insertar";
	var tipoMat=document.form_series.tipoMat.value;
	var nummasc= document.form1.nummasc.value;
	
	if (tipoMat=='1'){
		var tienda=document.form1.tienda1.value;
		var act=document.form1.act1.value;
	}
	if (tipoMat==2){
		var tienda=document.form1.tienda2.value;
		var act=document.form1.act2.value;
	}
	if (tipoMat==3){
		var tienda=document.form1.tienda3.value;
		var act=document.form1.act3.value;
	}
	if (tipoMat==4){
		var tienda=document.form1.tienda4.value;
		var act=document.form1.act4.value;
	}
	//alert(tipoMat);
    doAjax('peticion_datos.php','&peticion=saveItems&tipoMat='+tipoMat+'&accion='+accion+'&nummasc='+nummasc+'&valorChk='+valorChk+'&tienda='+tienda+'&act='+act,'rspta_aceptarMP'+tipoMat,'get','0','1','capa_mat'+tipoMat,'');
    Modalbox.hide();
  }
  
  function rspta_aceptarMP1(data){
 // alert(data);
  document.getElementById("capa_mat1").innerHTML=data;
  document.form1.tienda1.disabled=true;
  document.form1.act1.disabled=true;
  
  }
  
   function rspta_aceptarMP2(data){
 // alert(data);
  document.getElementById("capa_mat2").innerHTML=data;
  document.form1.tienda2.disabled=true;
  document.form1.act2.disabled=true;

  }
   function rspta_aceptarMP3(data){
 // alert(data);
  document.getElementById("capa_mat3").innerHTML=data;
  document.form1.tienda3.disabled=true;
  document.form1.act3.disabled=true;
  
  }
   function rspta_aceptarMP4(data){
 // alert(data);
  document.getElementById("capa_mat4").innerHTML=data;
  document.form1.tienda4.disabled=true;
  document.form1.act4.disabled=true;
  
  }
  
  

  
  
  function eliminarMat(id,tipoMat){
  
  var accion="eliminar";
	//var tipoMat=document.form_series.tipoMat.value;
	var nummasc= document.form1.nummasc.value;
		
	//alert(tipoMat);
    doAjax('peticion_datos.php','&peticion=saveItems&tipoMat='+tipoMat+'&accion='+accion+'&nummasc='+nummasc+'&id='+id,'rspta_aceptarMP'+tipoMat,'get','0','1','capa_mat'+tipoMat,'');
    
  }
  
  function enviar(e){
  
	 // if(e.keyCode==13){
		//document.form1.submit();	  
	  //}

  }
  
  function nuevaMasc(){
  
  location.href="matprimxterm.php?new";
  
  }
  
  function buscarProd(valor){
  //alert();
  var agrupado=document.form_series.agrupado.value;
   doAjax('materiaprima.php','&valor='+valor.value+'&buscar&agrupado='+agrupado,'rpta_buscarProd','get','0','1','','');
    
  }
  
  function rpta_buscarProd(texto){  
  
  document.getElementById('listaProd').innerHTML=texto;  
  }
  
    
</script>
