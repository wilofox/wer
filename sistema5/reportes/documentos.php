<?php 
	session_start();
	include('../conex_inicial.php');
	include('../funciones/funciones.php');
	
	
	$docRk=$_REQUEST['docRk'];
	$tipo=$_REQUEST['tipo'];
	//echo "sdg".$docRk;
	$docRk=substr($docRk,0,strlen($docRk)-1).""; 

	if ($docRk != ''){
		$sql="Select * from temp where cod_user='".$_SESSION['codvendedor']."' and reporte='".$_REQUEST['reporte']."'";

	$rs=mysql_query($sql,$cn);
	$cont=mysql_num_rows($rs);	
	//echo $cont;
	if( $cont == 0 )
	{ if( !empty($_REQUEST['reporte']) &&  !empty ( $_SESSION['codvendedor'] ))
	  { 
	  mysql_query("insert into temp values ('".$_SESSION['codvendedor']."','','".$_REQUEST['reporte']."')");
	  } 
	}
		//echo "update temp set documentos=\"".$docRk."\" where cod_user='".$_SESSION['codvendedor']."' and reporte='".$_REQUEST['reporte']."'";
	mysql_query("update temp set documentos=\"".$docRk."\" where cod_user='".$_SESSION['codvendedor']."' and reporte='".$_REQUEST['reporte']."'");	
//	echo "update temp set documentos='".$docRk."' where cod_user='".$_SESSION['codvendedor']."' and reporte='".$_REQUEST['reporte']."'";
	}	
	$sql="Select * from temp where cod_user='".$_SESSION['codvendedor']."' and reporte='".$_REQUEST['reporte']."'";

	$rs=mysql_query($sql,$cn);
	while($row=mysql_fetch_array($rs)){$docuser=$row['documentos'];}
	
		
?>
<table width="315" height="120" border="0" cellpadding="0" cellspacing="0" bgcolor="#FCE1C5">
  <tr>
  <?php
  	if(isset($_REQUEST['pagos'])){
		echo "<td colspan=2 bgcolor=#999999><b style=color:#FFFFFF>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tipo de Pago</td>";
    }else{
	    echo "<td colspan=2 bgcolor=#999999><b style=color:#FFFFFF>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Documentos a Filtrar</td>";
	}
	/*if ($tipo==1)
	echo "Configuracion de Detalle de compras x Clientes</b>	";
	else
	echo "Configuracion de Detalle de ventas x Clientes</b>	";*/
	?>
    <td height="23"  onclick="salir()" bgcolor="#999999"><font face="Arial, Helvetica, sans-serif" style="text-decoration:underline; font-size:11px; cursor:pointer" color="#FF0000"><b>x</b></font></td>
  </tr>
  <tr>
    <td width="231">
<div style="padding-top:5px; padding-bottom:10px;"></div>
<div align="center" style="padding-bottom:10px;">
	<table width="194" border="0" cellpadding="1" cellspacing="1">
      <tr style=" color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:10px">
        <td width="39" align="center" bgcolor="#0066CC"><span style="color:#FFFFFF"><b>Incluir</b></span></td>
        <td width="159" align="center" bgcolor="#0066CC"><span style="color:#FFFFFF"><b>Documentos</b></span></td>
      </tr>

      <tr style=" color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:11px">
        <td colspan="2" align="center" bgcolor="#F5F5F5">

<div id="otros" style="width:190px; height:150px; overflow-y:scroll" >

		<table width="180" border="0" cellpadding="1" cellspacing="1">
  <?php 
  $c="codigo";
  $d="descripcion";
  if(isset($_REQUEST['pagos'])){
	  $d="nombre";
	  $c="id";
	  $sql="Select * from modalidad order by id asc";
  }else{
	  if(isset($_REQUEST['pagos2'])){
		  $d="descripcion";
		  $c="id";
		  $sql="Select * from t_pago order by id asc";
	  }else{
  		if ($tipo==1)
		$sql="Select * from operacion where tipo='1' order by descripcion asc";
		else
        $sql="Select * from operacion where tipo='2' order by descripcion asc";
	  }
  }
	$rs=mysql_query($sql,$cn);
	$cont=mysql_num_rows($rs);
	$doctot = '';
	
	while ($row=mysql_fetch_array($rs)){
    $doctot .= ( empty($doctot) )?$row[$c]:','.$row[$c];
//echo $docuser."-".$row['codigo'];
  ?>
  <tr style=" color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:11px">
    <td width="41" align="center" bgcolor="#F5F5F5">

	<input name="chkIngresos[]" id="Ingresos" type="checkbox" style="background:none; border:none" value="'<?php echo $row[$c]?>'" 		 <?php
	

	$ver = explode(',',$docuser);
	//echo "doc".$ver;
	for ($i=0;$i<count($ver);$i++){
	//echo "'".$row['codigo']."'==".$ver[$i];
		if ("'".$row[$c]."'"==$ver[$i]){
			echo 'checked';
		}			
	}
	?> />	</td>
    <td width="132"  bgcolor="#F5F5F5"><?php echo caracteres($row[$d]); ?></td>
  </tr>
  <?php } 
  
  if($cont==0){
  
  ?>
  <?php 
  }
  ?>
</table>
</div>		</td>
        </tr>

      <tr>
        <td bgcolor="#F5F5F5">&nbsp;</td>
        <td bgcolor="#F5F5F5">&nbsp;</td>
      </tr>
    </table>
</div>	<input name="GrupoOpciones1"  type="radio" id="GrupoOpciones1"  style="background:none; border:none"  onClick="marcar()" value="todos" <? if( str_replace("'", "", $docuser) == $doctot ) { ?> checked <? } ?> >
      Marcar todos 
        <input id="GrupoOpciones1" name="GrupoOpciones1" style="background:none; border:none" type="radio" value="ninguno"  onClick="marcar()">
        Desmarcar todos	</td>
    <td width="77" align="center"><input type="button" name="Submit" value=" Aceptar " onclick="Guarda();salir()"  />
      <br />
      <br />
	<input type="button" name="Submit2" value="   Salir   " onclick="salir()" /></td>
    <td width="10" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td style="color:#FF0000">&nbsp;<? //echo $docRk; ?></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
</table>
