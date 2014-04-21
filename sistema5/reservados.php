<?php 
session_start();
include('conex_inicial.php');

//$str_delete="delete from tempdoc where estado='R' and usuario='".$_SESSION['codvendedor']."'";
//mysql_query($str_delete,$cn);

//echo $_REQUEST['accion'];

if(isset($_REQUEST['accion'])){


if($_REQUEST['accion']=='Eliminar'){
  $str_delete="select * from tempdoc where estado='G' and doc!='GR' order by doc";
  $resultado=mysql_query($str_delete,$cn);
  
	  while($row=mysql_fetch_array($resultado)){  
		
		if($row['tipodoc']=='1'){
		$strSQL1="select * from cab_mov where sucursal='".$row['sucursal']."' and tipo='".$row['tipodoc']."' and serie='".$row['serie']."' and Num_doc='".$row['numero']."' and cod_ope='".$row['doc']."'   ";
		}else{
		$strSQL1="select * from cab_mov where sucursal='".$row['sucursal']."' and tipo='".$row['tipodoc']."' and serie='".$row['serie']."' and Num_doc='".$row['numero']."'  and cod_ope='".$row['doc']."'  ";
		}
		
		$resultado1=mysql_query($strSQL1,$cn);
		$cont=mysql_num_rows($resultado1);
		
			if($cont!=0){
			continue;
				
			}
			
			$strDelete="delete from tempdoc where id='".$row['id']."'";
			//echo $strDelete."<br>";
			mysql_query($strDelete,$cn);
		
		}
	
	
	}else{

		if($_REQUEST['accion']=='Eliminar_Docs'){
		
		  $str_delete="select * from tempdoc where estado='G' and doc!='GR' and auxiliar='' and tipodoc='1'  order by doc";
		  $resultado=mysql_query($str_delete,$cn);
	  
		  while($row=mysql_fetch_array($resultado)){  
			
			if($row['tipodoc']=='1'){
			$strSQL1="select * from cab_mov where sucursal='".$row['sucursal']."' and tipo='".$row['tipodoc']."' and serie='".$row['serie']."' and Num_doc='".$row['numero']."' and cod_ope='".$row['doc']."'  ";
			}else{
			$strSQL1="select * from cab_mov where sucursal='".$row['sucursal']."' and tipo='".$row['tipodoc']."' and serie='".$row['serie']."' and Num_doc='".$row['numero']."'  and cod_ope='".$row['doc']."'  ";
			}
			
			$resultado1=mysql_query($strSQL1,$cn);
			$cont=mysql_num_rows($resultado1);
			
			
			if($cont==0){
			continue;
			}
			
			$row_temp=mysql_fetch_array($resultado1);
			$auxilir_temp=$row_temp['cliente'];
			$strSQLUpdate="update tempdoc set auxiliar='".$auxilir_temp."' where id='".$row['id']."'";
			
			//echo $strSQLUpdate."<br>";
			
			mysql_query($strSQLUpdate,$cn);
		  }
		
		}else{
			
			  $str_delete="select * from cab_mov";
			  $resultado=mysql_query($str_delete,$cn);
			  while($row=mysql_fetch_array($resultado)){  
				
				
				$strSQL1="select * from det_mov where sucursal='".$row['sucursal']."' and tipo='".$row['tipo']."' and serie='".$row['serie']."' and numero='".$row['Num_doc']."' and cod_ope='".$row['cod_ope']."'  ";
				
				
				$resultado1=mysql_query($strSQL1,$cn);
				$cont=mysql_num_rows($resultado1);
			
				if($cont!=0){
				continue;
				}
				
				$strSQL="delete from  cab_mov where cod_cab='".$row['cod_cab']."'";
				
				mysql_query($strSQL,$cn);
			  }	
		
		
		}
	
	}

}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo3 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; }
.Estilo5 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; color: #0066CC; }
.Estilo10 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
-->
</style>
</head>
<script>
function enviarform(obj){
document.form1.accion.value=obj.value;
document.form1.submit();

}
</script>
<body>
<form name="form1" method="post" action="" >
  <span class="Estilo5">RESERVADOS</span>
  <table width="527" height="49" border="1">
    <tr>
      <td height="19" class="Estilo3">Sucursal</td>
      <td class="Estilo3">Tipo</td>
      <td class="Estilo3">Doc</td>
      <td class="Estilo3">Serie</td>
      <td class="Estilo3">Numero</td>
      <td class="Estilo3">Auxiliar</td>
      <td class="Estilo3">Usuario</td>
    </tr>
    <?php
  
  $str_delete="select * from tempdoc where estado='R' ";
  $resultado=mysql_query($str_delete,$cn);
  while($row=mysql_fetch_array($resultado)){
  
   ?>
    <tr>
      <td height="22"><?php echo $row['sucursal']?></td>
      <td><?php echo $row['tipodoc']?></td>
      <td><?php echo $row['doc']?></td>
      <td><?php echo $row['serie']?></td>
      <td><?php echo $row['numero']?></td>
      <td><?php echo $row['auxiliar']?></td>
      <td><?php echo $row['estado']?></td>
    </tr>
    <?php } 
  
  ?>
  </table>
  <span class="Estilo5">RESERVADOS (Sin cabecera)</span>
  <input type="button" name="eliminar2" id="eliminar2" value="Eliminar" onClick="enviarform(this)">
  <input type="hidden" name="accion" id="accion" >
  <table width="527" height="73" border="1">
    <tr>
      <td height="19" class="Estilo3">Sucursal</td>
      <td class="Estilo3">Tipo</td>
      <td class="Estilo3">Doc</td>
      <td class="Estilo3">Serie</td>
      <td class="Estilo3">Numero</td>
      <td class="Estilo3">Auxiliar</td>
      <td align="center" class="Estilo3">Usuario</td>
    </tr>
    <?php
  
  $str_delete="select * from tempdoc where estado='G' and doc!='GR' order by doc";
  $resultado=mysql_query($str_delete,$cn);
  $i=0;
  while($row=mysql_fetch_array($resultado)){  
  	
	if($row['tipodoc']=='1'){
  	$strSQL1="select * from cab_mov where sucursal='".$row['sucursal']."' and tipo='".$row['tipodoc']."' and serie='".$row['serie']."' and Num_doc='".$row['numero']."' and cod_ope='".$row['doc']."'   ";
	}else{
	$strSQL1="select * from cab_mov where sucursal='".$row['sucursal']."' and tipo='".$row['tipodoc']."' and serie='".$row['serie']."' and Num_doc='".$row['numero']."'  and cod_ope='".$row['doc']."'  ";
	}
	
	$resultado1=mysql_query($strSQL1,$cn);
	$cont=mysql_num_rows($resultado1);
	
	if($cont!=0){
	continue;
	}
  
  //echo $strSQL1;
   ?>
    <tr>
      <td height="22"><span class="Estilo10"><?php 
	  
	  list($nom_suc)=mysql_fetch_row(mysql_query("select des_suc from sucursal where cod_suc='".$row['sucursal']."'"));
	  
	  echo $nom_suc?>
	  </span></td>
      <td><span class="Estilo10"><?php  
	  
	  if($row['tipodoc']=='1'){
	  echo "compras";
	  }else{
	  echo "ventas";
	  }
	  
	  ?></span></td>
      <td><span class="Estilo10"><?php echo $row['doc']?></span></td>
      <td><span class="Estilo10"><?php echo $row['serie']?></span></td>
      <td><span class="Estilo10"><?php echo $row['numero']?></span></td>
      <td><span class="Estilo10"><?php echo $row['auxiliar']?></span></td>
      <td align="center"><span class="Estilo10">
        <?php 
	
	list($nom_usuario)=mysql_fetch_row(mysql_query("select usuario from usuarios where codigo='".$row['usuario']."'"));
	
	echo $nom_usuario;
	//echo $row['usuario']
	
	?>
      </span></td>
    </tr>
   
    <?php 
	$i++;
  } 
  
  ?>
  
   <tr>
      <td height="22" colspan="7" class="Estilo3">Total Item : <?php echo $i++; ?></td>
    </tr>
  </table>
  
   <span class="Estilo5">RESERVADOS (Con cabecera)</span>
   <input type="button" name="eliminar3" id="eliminar3" value="restaurar" onClick="enviarform(this)">
   <table width="527" height="73" border="1">
    <tr>
      <td height="19" class="Estilo3">Sucursal</td>
      <td class="Estilo3">Tipo</td>
      <td class="Estilo3">Doc</td>
      <td class="Estilo3">Serie</td>
      <td class="Estilo3">Numero</td>
      <td class="Estilo3">Auxiliar</td>
      <td align="center" class="Estilo3">Usuario</td>
    </tr>
    <?php
  
  $str_delete="select * from tempdoc where estado='G' and doc!='GR' and auxiliar='' and tipodoc='1'  order by doc";
  $resultado=mysql_query($str_delete,$cn);
  $i=0;
  while($row=mysql_fetch_array($resultado)){  
  	
	if($row['tipodoc']=='1'){
  	$strSQL1="select * from cab_mov where sucursal='".$row['sucursal']."' and tipo='".$row['tipodoc']."' and serie='".$row['serie']."' and Num_doc='".$row['numero']."' and cod_ope='".$row['doc']."'  ";
	}else{
	$strSQL1="select * from cab_mov where sucursal='".$row['sucursal']."' and tipo='".$row['tipodoc']."' and serie='".$row['serie']."' and Num_doc='".$row['numero']."'  and cod_ope='".$row['doc']."'  ";
	}
	
	$resultado1=mysql_query($strSQL1,$cn);
	$cont=mysql_num_rows($resultado1);

	if($cont==0){
	continue;
	}

  //echo $strSQL1;
   ?>
    <tr>
      <td height="22"><span class="Estilo10"><?php 
	  
	  list($nom_suc)=mysql_fetch_row(mysql_query("select des_suc from sucursal where cod_suc='".$row['sucursal']."'"));
	  
	  echo $nom_suc?>
	  </span></td>
      <td><span class="Estilo10"><?php  
	  
	  if($row['tipodoc']=='1'){
	  echo "compras";
	  }else{
	  echo "ventas";
	  }
	  
	  ?></span></td>
      <td><span class="Estilo10"><?php echo $row['doc']?></span></td>
      <td><span class="Estilo10"><?php echo $row['serie']?></span></td>
      <td><span class="Estilo10"><?php echo $row['numero']?></span></td>
      <td><span class="Estilo10"><?php echo $row['auxiliar']?></span></td>
      <td align="center"><span class="Estilo10">
        <?php 
	
	list($nom_usuario)=mysql_fetch_row(mysql_query("select usuario from usuarios where codigo='".$row['usuario']."'"));
	
	echo $nom_usuario;
	//echo $row['usuario']
	
	?>
      </span></td>
    </tr>
   
    <?php 
  } 
  
  ?>
   <tr>
      <td height="22" colspan="7" class="Estilo3">Total Item : <?php echo $i++; ?></td>
     </tr>
  </table>
  
   <span class="Estilo5">Cabecera sin Detalle </span>
   <input type="button" name="eliminar4" id="eliminar4" value="Eliminar_Docs" onClick="enviarform(this)">
   <table width="527" height="73" border="1">
    <tr>
      <td height="19" class="Estilo3">Sucursal</td>
      <td class="Estilo3">Tipo</td>
      <td class="Estilo3">Doc</td>
      <td class="Estilo3">Serie</td>
      <td class="Estilo3">Numero</td>
      <td class="Estilo3">Auxiliar</td>
      <td align="center" class="Estilo3">Usuario</td>
    </tr>
    <?php
  
  $str_delete="select * from cab_mov";
  $resultado=mysql_query($str_delete,$cn);
  $i=0;
  while($row=mysql_fetch_array($resultado)){  
  	
	
  	$strSQL1="select * from det_mov where sucursal='".$row['sucursal']."' and tipo='".$row['tipo']."' and serie='".$row['serie']."' and numero='".$row['Num_doc']."' and cod_ope='".$row['cod_ope']."'  ";
	
	
	$resultado1=mysql_query($strSQL1,$cn);
	$cont=mysql_num_rows($resultado1);

	if($cont!=0){
	continue;
	}

  //echo $strSQL1;
   ?>
    <tr>
      <td height="22"><span class="Estilo10"><?php 
	  
	  list($nom_suc)=mysql_fetch_row(mysql_query("select des_suc from sucursal where cod_suc='".$row['sucursal']."'"));
	  
	  echo $nom_suc?>
	  </span></td>
      <td><span class="Estilo10"><?php  
	  
	  if($row['tipodoc']=='1'){
	  echo "compras";
	  }else{
	  echo "ventas";
	  }
	  
	  ?></span></td>
      <td><span class="Estilo10"><?php echo $row['cod_ope']?></span></td>
      <td><span class="Estilo10"><?php echo $row['serie']?></span></td>
      <td><span class="Estilo10"><?php echo $row['Num_doc']?></span></td>
      <td><span class="Estilo10"><?php echo $row['auxiliar']?></span></td>
      <td align="center"><span class="Estilo10">
        <?php 
	
	list($nom_usuario)=mysql_fetch_row(mysql_query("select usuario from usuarios where codigo='".$row['usuario']."'"));
	
	echo $nom_usuario;
	//echo $row['usuario']
	
	?>
      </span></td>
    </tr>
   
    <?php 
  } 
  
  ?>
   <tr>
      <td height="22" colspan="7" class="Estilo3">Total Item : <?php echo $i++; ?></td>
     </tr>
  </table>
  
</form>
</body>

</html>
