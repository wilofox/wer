<?php 
session_start();
include('../conex_inicial.php');
include('../funciones/funciones.php');

$peticion=$_REQUEST['peticion'];

switch($peticion){
	
	case "listarActvOT":
	
	if(isset($_REQUEST['guardar'])){
	
	

	$numeroActv=$_REQUEST['numeroActv'];
	$fecha_aud=gmdate('Y-m-d H:i:s',time()-18000);
	
	$strSQL="insert into activxordent(cod_cab,numero,responsable,actividad,fecha,hora,tiempo,almacen,fecha_aud,usersist,pc,cantidad)values('".$_REQUEST['codcabOT']."','".$numeroActv."','".$_REQUEST['trabajador']."','".$_REQUEST['actividad']."','".formatofecha($_REQUEST['fecha'])."','".$_REQUEST['hora']."','".$_REQUEST['tiempo']."','".$_REQUEST['tienda']."','".$fecha_aud."','".$_SESSION['codvendedor']."','".$_SESSION['pc_ingreso']."','".$_REQUEST['cantidad']."')";
	mysql_query($strSQL,$cn);
	
	 }
	 
	 if(isset($_REQUEST['eliminar'])){
	 
	 $strSQL="delete from activxordent where id='".$_REQUEST['codigo']."'";
	 mysql_query($strSQL,$cn);
	 	 
	 }
	
	
	?>
	
	<table width="98%" height="25" border="0" cellpadding="1" cellspacing="1">
          <tr style="background:url(../imagenes/bg_contentbase4.gif); background-position:80px 60px">
            <td width="15" height="21">&nbsp;</td>
            <td width="97"><span class="Estilo12 Estilo45"><strong>Fecha</strong></span></td>
            <td width="88"><span class="Estilo12 Estilo45"><strong>Nro Doc.</strong></span></td>
            <td width="233"><span class="Estilo12 Estilo45"><strong>Actividad</strong></span></td>
            <td width="134"><span class="Estilo12 Estilo45"><strong>Trabajador</strong></span></td>
            <td width="77"><span class="Estilo12 Estilo45"><strong>Hora Inicio </strong></span></td>
            <td width="91"><span class="Estilo12 Estilo45"><strong>Tiempo</strong></span></td>
            <td width="64"><span class="Estilo12 Estilo45"><strong>Cantidad</strong></span></td>
            <td width="35">&nbsp;</td>
          </tr>	
		<?php 
		$strSQL="select * from activxordent where cod_cab='".$_REQUEST['codcabOT']."' and responsable='".$_REQUEST['trabajador']."' and fecha='".formatofecha($_REQUEST['fecha'])."'";
		//echo $strSQL;
		$resultado=mysql_query($strSQL,$cn);
		while($row=mysql_fetch_array($resultado)){
		
		?>
          <tr>
            <td height="21" bgcolor="#F4F4F4">&nbsp;</td>
            <td bgcolor="#F4F4F4" class="Estilo44"><?php echo $row['fecha']?></td>
            <td bgcolor="#F4F4F4" class="Estilo44"><?php echo $row['numero']?></td>
            <td bgcolor="#F4F4F4" class="Estilo44"><?php
			
	list($nombreActv)=mysql_fetch_row(mysql_query("select nombre from procesos  where id='".$row['actividad']."' "));
			 echo caracteres($nombreActv);
			 
			 ?></td>
            <td bgcolor="#F4F4F4" class="Estilo44"><?php 
				list($nombreResp)=mysql_fetch_row(mysql_query("select usuario from usuarios where codigo='".$row['responsable']."' "));
			 echo $nombreResp;
			
			?></td>
            <td bgcolor="#F4F4F4" class="Estilo44"><?php echo $row['hora']?></td>
            <td bgcolor="#F4F4F4" class="Estilo44"><?php 
			
			$temp=explode(":",$row['tiempo']);
			echo $temp[0]." horas ".$temp[1]." min"
			
			?></td>
            <td align="center" bgcolor="#F4F4F4" class="Estilo44"><?php 
			
			echo $row['cantidad'];
			
			?></td>
            <td align="center" bgcolor="#F4F4F4" class="Estilo44"><img style="cursor:pointer" onClick="eliminarActv('<?php echo $row['id']?>')" src="../imgenes/eliminar.png" width="16" height="16"></td>
          </tr>
		<?php 
		}
		?>  
</table>
	
	<?php 	
	break;
	
	
	
	
}

?>
