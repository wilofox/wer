<?php
session_start();
include('seguridad.php');
include('conex_inicial.php');
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<!--------------------------------------------------------->

<!-------------------------------------------------------->


<!-------------------------------------->
<script type="text/javascript" src="flashobject.js"></script>
<script type="text/javascript" src="adjustmenu.js"></script>
<SCRIPT src="dmenu.js" type="text/javascript"></SCRIPT>
<script type="text/javascript" >

function open_menu()
{document.getElementById('color').style.height="100px";
}
function close_menu()
{document.getElementById('color').style.height="24px";
}

function recargar2(){
location.href="principal.php";
}

var desabilitar="";
var sucursal="";
var tienda="";
var usuarios="";
var caja="";
</script>


<?php 
$fecha=date('d/m/Y');

$strSQl="select * from cierre where fecha='$fecha'";
$resultado=mysql_query($strSQl,$cn);
$cont=mysql_num_rows($resultado);

if($cont!=0){
 ?>
 <script>desabilitar="_";</script>
 <?php 
 }
 
 if($_SESSION['nivel_usu']==1){
  ?>
  <script>
//  alert('entro');
 sucursal="_";
 tienda="_";
 usuarios="_";
 caja="_";
  </script>
 
 <?php }?>
 
 
 



<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administracion - PROLYAM</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
}
.Estilo3 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo4 {font-size: 12px}
-->
</style>
</head>

<body bgcolor="#E8E8E8">



<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4" align="right"><span class="Estilo2"><span class="Estilo4">
      Usuario</span>:</span> <span class="Estilo3"><?php echo $_SESSION['user'];?></span></td>
    <td width="4" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td width="192" height="74" rowspan="4"><img src="imgenes/mrsteak.jpg" width="192" height="70"></td>
    <td width="1" rowspan="4">	</td>
    <td width="532" rowspan="4" valign="top"><table width="301" height="0" border="0" cellpadding="0" cellspacing="0" bgcolor="#F2F3F2">
      <tr>
        <td> <!--<SCRIPT src="deluxe-menu.js"  type="text/javascript"></SCRIPT>-->
		<SCRIPT src="data-xp-1.js"  type="text/javascript"></SCRIPT></td>
      </tr>
	   <tr>
        <td>        <!--<SCRIPT src="deluxe-menu.js"  type="text/javascript"></SCRIPT>-->		</td>
      </tr>
    </table>
	
	<div  style="left:0px; top:-1px; width:60px; height:44px;position:relative;">
          <table width="58" height="41" border="0" cellpadding="0" cellspacing="0" bgcolor="#E8E8E8">
            <tr>
              <td width="100%" height="1" bgcolor="#E8E8E8" ></td>
            </tr>
            <tr>
              <td width="100%" height="1"></td>
            </tr>
            <tr>
              <td height="5"></td>
            </tr>
          </table>
      </div>  
	  
	  
	    </td>
    <td width="71"></td>
    <td height="74" rowspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="22" align="right"><span class="Estilo2"><a href="index.php">Salir</a></span></td>
  </tr>
  <tr>
    <td height="23"><?php //echo $_SESSION['des_caja'] // echo $_SESSION['srapida']." ".$_SESSION['smesa']?></td>
  </tr>
  <tr>
    <td height="23"></td>
  </tr>
  <tr>
    <td height="2" colspan="5"></td>
  </tr>
  <tr>
    <td colspan="5">
	
  <iframe width="800" height="450" id="principal"
name="principal" marginwidth=0 marginheight=0 src="cuerpo.php" 
frameborder=0  style="border:#000000;" > </iframe></td>
  </tr>
</table>

</body>
</html>

<?php //$_SESSION['user']=""?>
