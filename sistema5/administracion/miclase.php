<?php
class miclase{
var $mc_db;
var $mc_user;
var $mc_ps;
function miclase($param=""){
	if($param==''){
	include('../conex_inicial.php');
	include('../funciones/funciones.php');

$this->mc_db=$database_conexion ;
$this->mc_user=$username_conexion ;
$this->mc_ps=$password_conexion ;

	}
	
}

function ConsultaDatos($strSQL){
		
		$resultados=mysql_query($strSQL);
		$row=mysql_fetch_array($resultados);
		$cont=mysql_num_rows($resultados);
		return $row;
}


function listar_chofer($condicion,$texto,$pag){
	
	$where="";
	$regvis=20;

	if($pag>=1) {
	$inicio=($pag-1)*$regvis;
	}else{
	$inicio=0;
	$pag=1;
	}
		//echo  $inicio;
	if($condicion!=""){
	$where =" where $condicion like '%$texto%'";
	}
	//echo "select * from chofer $where order by cod asc";
	$sql="select * from chofer $where order by cod asc ";
	$totalreg=mysql_num_rows(mysql_query($sql));
	
	
  $resultados = mysql_query($sql."limit ".$inicio.",".$regvis);
			 // echo "resultado".$resultado;
	//echo "<tr><td colspan='8'>p<table style='position:relative;height:100px;overflow:auto'><table>"	;  
	echo '<table border="0" >
<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">

      <td width="50" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">N.</td>
      <td width="170" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Nombre</td>
      <td width="90" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">DNI</td>
      <td width="138" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Licencia</td>
      <td width="150" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Fecha</td>
	  <td width="150" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Direccion</td>
	  <td width="100" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Telefono</td>
	  <td  width="100" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Acciones</td>

    </tr></table><div style="position:relative;height:270px;overflow:auto"><table border="0">';
	while($row=mysql_fetch_array($resultados)){
	 echo '<tr  bgcolor="#FFFFFF">

		  <td width="50" align="center"><span class="Estilo12">'.$row['cod'].'</span></td>
		  <td width="157"><span class="Estilo12">'.$row['nombre'].'</span></td>
		  <td width="90"><span class="Estilo12">'.$row['dni'].'</span></td>
		  <td width="138"><span class="Estilo12">'.$row['licencia'].'</span></td>
		  <td width="150"><span class="Estilo12">'.$row['fecha_nac'].'</span></td>
		  <td width="150"><span class="Estilo12">'.$row['direccion'].'</span></td>
		  <td width="100"><span class="Estilo12">'.$row['telefono'].'</span></td>
		  <td width="40"><a href=\'javascript:editar( "'.$row['cod'].'");\'><img src="../imgenes/ico_edit.gif" border="0"></a></td>
		  <td width="40"><a href=\'javascript:eliminar("'.$row['cod'].'");\'><img src="../imgenes/eliminar.gif" border="0"></a></td>
		</tr>';
	  }
 //echo  "<tr><td>".$this->paginar($totalreg,$pag,$regvis)."</td></tr>";
 // echo  "<tr><td >".$this->paginacion($totalreg,$pag,$regvis)."</td></tr>";
    echo  "</table></div>|<table border='0' width='100%'><tr><td >";
	 echo $this->paginar($totalreg,$pag,$regvis);
	echo "</td></tr></table>";
}
function lis_chofer(){
  $resultados = mysql_query("select * from chofer order by cod asc");
 echo '<select name="schofer">';
  	while($row=mysql_fetch_array($resultados)){
	echo '<option value=\''.$row["cod"].'?'.$row["nombre"].'\'>'.$row["nombre"].'</option>';
	}
 echo '</select>';
}
function listar_transportista($condicion,$texto,$pag){
		$where="";
		
	$regvis=20;

	if($pag>=1) {
	$inicio=($pag-1)*$regvis;
	}else{
	$inicio=0;
	$pag=1;
	}
	if($condicion!=""){
	$where =" where $condicion like '%$texto%'";
	}
	//echo "select * from transportista $where order by id asc";
	$sql="select * from transportista $where order by id asc";
	$totalreg=mysql_num_rows(mysql_query($sql));
  $resultados = mysql_query($sql." limit ".$inicio.",".$regvis);
			 // echo "resultado".$resultado;
	echo '<table border="0">
<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">

      <td width="50" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">N.</td>
      <td  width="180" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Nombre</td>
      <td width="170" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Direccion</td>
      <td width="100" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Ruc</td>
      <td  width="100" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Telefono</td>
	  <td  width="100" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Licencia</td>
	  <td  width="100"   colspan="2" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Acciones</td>
    </tr></table><div style="position:relative;height:250px;overflow:auto"><table border="0" >' ;
	while($row=mysql_fetch_array($resultados)){
	//<td width="10"><span class="Estilo12">'.$row['web'].'</span></td>
	 echo '<tr bgcolor="#FFFFFF" >

		  <td width="50" align="center"><span class="Estilo12">'.$row['id'].'</span></td>
		  <td width="170"><span class="Estilo12">'.$row['nombre'].'</span></td>
		  <td  width="160"><span class="Estilo12">'.$row['direccion'].'</span></td>
		  <td width="90"><span class="Estilo12">'.$row['ruc'].'</span></td>
		  <td width="100"><span class="Estilo12">'.$row['telefono'].'</span></td>
		  
		  <td width="100"> <span class="Estilo12">'.$row['lic_mtc'].'</span></td>
		  <td width="45" align="center"><a href=\'javascript:editar( "'.$row['id'].'");\'><img src="../imgenes/ico_edit.gif" border="0"></a></td>
		  <td width="45" align="center"><a href=\'javascript:eliminar("'.$row['id'].'");\'><img src="../imgenes/eliminar.gif" border="0"></a></td>
		</tr>';
	  }
 //echo  "<tr><td>".$this->paginar($totalreg,$pag)."</td></tr>";
 //  echo  "<tr><td >".$this->paginacion($totalreg,$pag,$regvis)."</td></tr>";
    echo  "</table></div>|<table border='0' width='100%'><tr><td >";
	 echo $this->paginar($totalreg,$pag,$regvis);
	echo "</td></tr></table>";
}

function cod_autogenerado($campo,$tabla){
	$resultado3=mysql_query("select max($campo) as codigo from $tabla");
	$row3=mysql_fetch_array($resultado3);
			
	$codigo=$row3['codigo'];
	$codigo=$codigo+1;
	return $codigo;
			
}

function cod_autogenerado2($campo,$tabla,$tipo){
	$resultado3=mysql_query("select max(substr($campo,2)) as codigo from $tabla where substr($campo,1,1)='".$tipo."'");
	$row3=mysql_fetch_array($resultado3);
			
	$codigo=$row3['codigo'];
	$codigo=$codigo+1;
	return $tipo.str_pad($codigo,3,"0",STR_PAD_LEFT);
			
}

function consulta_chofer($cod){
$strSQL4="select * from chofer where cod='$cod'";
  $resultado4=mysql_query($strSQL4);
  $row4=mysql_fetch_array($resultado4);
  return $row4;
 
}
function consulta_transportista($cod){
$strSQL4="select * from transportista where id='$cod'";
  $resultado4=mysql_query($strSQL4);
  $row4=mysql_fetch_array($resultado4);
  return $row4;
 
}
function new_chofer($nombre,$dni,$licencia,$fecha,$direccion,$telefono){
	$strSQL2= "insert into chofer (nombre,dni,licencia,fecha_nac,direccion,telefono) values ('$nombre','$dni','$licencia','$fecha','$direccion','$telefono')";
	//echo $strSQL2	;		
	mysql_query($strSQL2);
			//unset($accion);
	//header("location: chofer.php");
	echo "<script>location.href='chofer.php'</script>";
}
function act_chofer($codigo,$nombre,$dni,$licencia,$fecha,$direccion,$telefono){

$strSQL="update chofer set nombre='".$nombre."',dni='".$dni."',licencia='".$licencia."',fecha_nac='".$fecha."',direccion='".$direccion."',telefono='".$telefono."' where cod='".$codigo."'";

mysql_query($strSQL);
}

function elim_chofer($codigo){
$sql="select * from cab_mov where chofer='".$codigo."'";
$total=mysql_num_rows(mysql_query($sql));
if($total==0){
$strSQL="delete from chofer where cod='".$codigo."'";
mysql_query($strSQL);
}else{
echo "<script>alert('Este chofer no se puede eliminar tiene documentos asociados')</script>";
}
}

function new_tra($nom,$dir,$ruc,$tel,$web,$lic,$veh,$mar,$pla,$cho){

list($idcho,$nomcho)=explode("?",$cho);
	$strSQL2= "insert into transportista (nombre,direccion,ruc,telefono,web,lic_mtc,vehiculo,marca,placa,chofer,nom_chofer) values ('$nom','$dir','$ruc','$tel','$web','$lic','$veh','$mar','$pla','$idcho','$nomcho')";
	//	echo $strSQL2;		
	mysql_query($strSQL2);
			//unset($accion);
	//header("location: chofer.php");
	echo "<script>location.href='transportista.php'</script>";
}

function act_tra($cod,$nom,$dir,$ruc,$tel,$web,$lic,$veh,$mar,$pla,$cho){

$strSQL="update transportista set nombre='".$nom."',direccion='".$dir."',ruc='".$ruc."',telefono='".$tel."',web='".$web."',lic_mtc='".$lic."',vehiculo='".$veh."',marca='".$mar."',placa='".$pla."',chofer='".$cho."' where id='".$cod."'";

mysql_query($strSQL);
}
function elim_tra($codigo){
//echo $codigo;
$sql="select * from cab_mov where transportista='".$codigo."'";
$total=mysql_num_rows(mysql_query($sql));
	if($total==0){
	$strSQL="delete from transportista where id='".$codigo."'";
	mysql_query($strSQL);
	}else{
	echo "<script>alert('Este transportista no se puede eliminar tiene documentos asociados')</script>";
	}
}

function listar_factor($condicion,$texto,$pag){
		$where="";
	//	echo $condicion; 
	$regvis=20;

	if($pag>=1) {
	$inicio=($pag-1)*$regvis;
	}else{
	$inicio=0;
	$pag=1;
	}
	if($condicion!=""){
	$where =" where $condicion like '%$texto%'";
	}
	//echo "select * from transportista $where order by id asc";
  $sql="select factorot.*,producto.nombre as nombpro from factorot inner join producto on factorot.item=producto.idproducto $where  order by producto.nombre,id asc";
	$totalreg=mysql_num_rows(mysql_query($sql));
  $resultados = mysql_query($sql." limit ".$inicio.",".$regvis);
		//  echo $sql." limit ".$inicio.",".$regvis;
	echo '
	<table border="0" width="720" align="right" ><tr><td style="padding-left:30px">
			<table width="670" border="0" cellpadding="0" cellspacing="1" bordercolor="#000000">
	
			   <tr bordercolor="#CCCCCC" style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px">
				<td rowspan="2" width="70" align="center"  ><span class="EstiloYeden2">N.</span></td>
				<td rowspan="2" width="100"  align="center"><span class="EstiloYeden2">Ancho</span></td>
				<td rowspan="2" width="100" bgcolor="#0073AA" align="center"><span class="EstiloYeden2">Largo</span></td>
				<td colspan="2" width="200"  align="center" ><span class="EstiloYeden2">Rango M2</span></td>
				<td rowspan="2" width="100"  align="center"><span class="EstiloYeden2">Factor</span></td>
				<td rowspan="2" width="100" colspan="2"  align="center"><span class="EstiloYeden2">Acciones</span></td>
			  </tr>
			  <tr style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px">
				<td  width="50"  align="center"><span class="EstiloYeden2">Inicial</span></td>
				<td  width="50"  align="center"><span class="EstiloYeden2">Final</span></td>
			  </tr>
			 </table>
		 </td></tr></table><br><br>
	  ' ;
	  $temcat="";
	  // <div style="position:relative;height:270px;overflow:auto">
	  $i=0;
	  echo '<ul id="browser" class="filetree ">';
	  
	while($row=mysql_fetch_array($resultados)){
		if($row['nombpro']!=$temcat){
 			if($i!=0){
			echo '  </span></li>
					</ul>
				  </li>
				';
			
			}
			
		
			echo '<li>
				<span class="folder Estilo_titu_icoC">
				<table width="700"  border="0">
				  <tr class="Estilo_titu_icoC">
					<td width="350"><strong>'.$row['item'].' - '.$row['nombpro'].'</strong></td>
					<td width="120" bgcolor="#F5F5F5"  >Precio min. S/. </td>
					<td width="20" bgcolor="#F5F5F5" >
					
					<input type="hidden" id="codprodOT" name="codprodOT[]" value="'.$row['item'].'"/>
					<input  name="pre_min[]" id="pre_min" type="text" size="5" maxlength="9" style="height:12px; font-size:10px; text-align:right " value="'.number_format($row['pre_min'],2).'" />
					</td>
					<td width="100" bgcolor="#F5F5F5" align="right" style="border:#FFFFFF solid 1px" >
					Cant.> 5000 
					</td>
					<td width="11" bgcolor="#F5F5F5" >
					<input name="desc1[]" type="text" size="5" maxlength="9" style="height:12px; font-size:10px; text-align:right " id="desc1" value="'.number_format($row['desc1'],3).'" />%
					</td>
					
					<td width="100" bgcolor="#F5F5F5" align="right" >
					Cant. >10000 
					</td>
					<td width="11" bgcolor="#F5F5F5" >
					<input name="desc2[]" type="text" size="5" maxlength="9" style="height:12px; font-size:10px; text-align:right " id="desc2" value="'.number_format($row['desc2'],3).'" />%
					</td>
					
					<td width="100" bgcolor="#F5F5F5" align="right" >
					Factor Conv.
					</td>
					<td width="11" bgcolor="#F5F5F5" >
					<input name="fconver[]" type="text" size="5" maxlength="9" style="height:12px; font-size:10px; text-align:right " id="fconver" value="'.$row['factorConv'].'" />
					</td>
					
				  </tr>
				  
				  			  
</table>
				</span>
			<ul><li><span class="file">';
		$i++;		
		}
		
		
	 echo '<table width="670"  style="vertical-align:top" border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#000000">
	 		<tr  bgcolor="#EEEEEE" onMouseOver="entrada(this)" onMouseOut="salida(this)">
			  <td width="70" align="center"><span class="EstiloYeden">'.$row['id'].'</span></td>
			  <td width="100" align="center"><span class="EstiloYeden">'.$row['ancho'].'</span></td>
			  <td width="100" align="center"><span class="EstiloYeden">'.$row['largo'].'</span></td>
			  <td width="100" align="center"><span class="EstiloYeden">'.$row['m2_ini'].'</span></td>
			  <td width="100" align="center"><span class="EstiloYeden">'.$row['m2_fin'].'</span></td>		  
			  <td width="100" align="center"><span class="EstiloYeden">'.$row['factor'].'</span></td>
			  <td width="50"  align="center"><a href=\'javascript:editar( "'.$row['id'].'");\'><img src="../imgenes/ico_edit.gif" border="0"></a></td>
			  <td width="50"  align="center"><a href=\'javascript:eliminar("'.$row['id'].'");\'><img src="../imgenes/eliminar.gif" border="0"></a></td>
			</tr>
		</table>';
		
		
		
		$temcat=$row['nombpro'];
	  }
 //echo  "<tr><td>".$this->paginar($totalreg,$pag)."</td></tr>";
 //  echo  "<tr><td >".$this->paginacion($totalreg,$pag,$regvis)."</td></tr>";
    echo  "
	 </span></li></ul></li>
	</ul></table>|<table border='0' width='100%'><tr><td >";
	//echo $totalreg."-".$pag."-".$regvis;
	 echo $this->paginar($totalreg,$pag,$regvis);
	echo "</td></tr></table>";
}



function consulta_factor($cod){
$strSQL4="select factorot.id,factorot.item,factorot.ancho,factorot.largo,factorot.m2_ini,factorot.m2_fin,factorot.factor,producto.nombre from factorot inner join producto on factorot.item=producto.idproducto  where id='$cod'";
  $resultado4=mysql_query($strSQL4);
  $row4=mysql_fetch_array($resultado4);
  return $row4;
 
}
function new_factor($idprod,$anc,$lar,$m2ini,$m2fin,$numfac){

//list($idcho,$nomcho)=explode("?",$cho);
	$strSQL2= "insert into factorot (item,ancho,largo,m2_ini,m2_fin,factor) values ($idprod,$anc,$lar,$m2ini,$m2fin,$numfac)";
		echo $strSQL2;		
	mysql_query($strSQL2);
		$strSQL3= "update producto set factorOT='S' where idproducto=".$idprod;
		mysql_query($strSQL3);
			//unset($accion);
	//header("location: chofer.php");
	echo "<script>alert('Factor Agregado');location.href='mantFactorOT.php'</script>";
}

function act_factor($idfac,$idprod,$anc,$lar,$m2ini,$m2fin,$numfac){

$strSQL="update factorot set item=".$idprod.",ancho=".$anc.",largo=".$lar.",m2_ini=".$m2ini.",m2_fin=".$m2fin.",factor=".$numfac." where id=".$idfac;

mysql_query($strSQL);
	/*echo "<script>alert('Factor Actualizado')</script>";*/
}

function elim_factor($codigo){
//echo $codigo;
//$sql="select * from cab_mov where transportista='".$codigo."'";
//$total=mysql_num_rows(mysql_query($sql));
//if($total==0){
$strSQL="delete from factorot where id='".$codigo."'";
mysql_query($strSQL);
echo "<script>alert('Este factor ha sido eliminado');location.href='mantFactorOT.php'</script>";
//}else{
/*echo "<script>alert('Este transportista no se puede eliminar tiene documentos asociados')</script>";*/
//}
}

function listar_condicion($condicion,$texto,$pag){
		$where="";
	//	echo $condicion; 
	$regvis=20;

	if($pag>=1) {
	$inicio=($pag-1)*$regvis;
	}else{
	$inicio=0;
	$pag=1;
	}
	if($condicion!=""){
	$where =" where $condicion like '%$texto%'";
	}
	//echo "select * from transportista $where order by id asc";
  $sql="select * from condicion $where  order by codigo";
	$totalreg=mysql_num_rows(mysql_query($sql));
  $resultados = mysql_query($sql." limit ".$inicio.",".$regvis);
			 // echo "resultado".$resultado;
	echo '<table border="0" align="center">

<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">

      <td  width="50" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">N.</td>
      <td   width="200" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Nombre</td>
      <td  width="100" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">C. Sunat</td>
	  <td  width="100" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Acciones</td>
    </tr><tr><td colspan="5"><div style="position:relative;width:500px;height:280px;overflow:auto;border:0px solid;padding:0px;margin:0px;"><table border="0" align="left">' ;
	  $temcat="";
	while($row=mysql_fetch_array($resultados)){
	//if($row['des_cat']!=$temcat){
 		//echo '<tr  bgcolor="#EEEEEE"><td colspan="8"><b>'.$row['des_cat'].'</b<</td></tr>';
	//	}
	$codigo=$row['codigo'];
	 echo "<tr  bgcolor='#FFFFFF'>

		  <td width='50' align='center'><span class='Estilo12'>".$row['codigo']."</span></td>
		  <td width='200'><span class='Estilo12'>".caracteres($row['nombre'])."</span></td>
		  <td  width='110'><span class='Estilo12'>".$row['codsunat']."</span></td>
		  <td width='100' align='center'><a href='javascript:editar($codigo)'><img src='../imgenes/ico_edit.gif' border='0'></a></td>
		  
		</tr>";
		//$temcat=$row['des_cat'];
	  }
    echo  "</table></div></td></tr></table>|	
	<table  border='0' width='100%'><tr>
	<td width='150'>&nbsp;</td>
	<td> ";
	//echo $totalreg."-".$pag."-".$regvis;
	 echo $this->paginar($totalreg,$pag,$regvis);
	 
	echo "</td>
	<td  width='150'>&nbsp;</td>
	</tr></table>";
}

function consulta_condicion($cod){
$strSQL4="select * from condicion   where codigo=".$cod;
  $resultado4=mysql_query($strSQL4);
  $row4=mysql_fetch_array($resultado4);
  return $row4;
 
}

function new_condicion($idcond,$nombre,$csunat){

//list($idcho,$nomcho)=explode("?",$cho);
	$strSQL2= "insert into condicion (nombre,codsunat) values ('$nombre','$csunat')";
	//	echo $strSQL2;		
	mysql_query($strSQL2);
		
	echo "<script>alert('Condicion Agregada');location.href='m_condicion.php'</script>";
}

function act_condicion($idcond,$nombre,$csunat){

$strSQL="update condicion set nombre='".$nombre."',codsunat='".$csunat."' where codigo=".$idcond;

mysql_query($strSQL);
	echo "<script>alert('Condicion Actualizada');location.href='m_condicion;</script>";
}

function elim_condicion($codigo){
//echo $codigo;
//$sql="select * from cab_mov where transportista='".$codigo."'";
//$total=mysql_num_rows(mysql_query($sql));
//if($total==0){
$strSQL="delete from condicion where codigo=".$codigo;
mysql_query($strSQL);
echo "<script>alert('Esta condicion ha sido eliminada');location.href='m_condicion.php'</script>";
//}else{
/*echo "<script>alert('Este transportista no se puede eliminar tiene documentos asociados')</script>";*/
//}
}

function listar_clasificacion($condicion,$texto,$pag){
		$where="";
	//	echo $condicion; 
	$regvis=20;

	if($pag>=1) {
	$inicio=($pag-1)*$regvis;
	}else{
	$inicio=0;
	$pag=1;
	}
	if($condicion!=""){
	$where =" where $condicion like '%$texto%'";
	}
	//echo "select * from transportista $where order by id asc";
  $sql="select * from clas_clie $where  order by codigo";
	$totalreg=mysql_num_rows(mysql_query($sql));
  $resultados = mysql_query($sql." limit ".$inicio.",".$regvis);
			 // echo "resultado".$resultado;
	echo '<table border="0" align="center">

<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">

      <td  width="50" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">N.</td>
      <td  width="200" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Nombre</td>
      <td  width="100" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Precio</td>
	  <td  width="100" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Tipo</td>
	  <td  width="100" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Acciones</td>
    </tr><tr><td colspan="5"><div style="position:relative;width:600px;height:250px;overflow:auto;border:0px solid;padding:0px;margin:0px;"><table border="0" align="left">' ;
	  $temcat="";
	while($row=mysql_fetch_array($resultados)){
	//if($row['des_cat']!=$temcat){
 		//echo '<tr  bgcolor="#EEEEEE"><td colspan="8"><b>'.$row['des_cat'].'</b<</td></tr>';
	//	}
	$codigo=$row['codigo'];
	 echo "<tr bgcolor='#FFFFFF'>

		  <td width='50' align='center'><span class='Estilo12'>".$row['codigo']."</span></td>
		  <td width='200'><span class='Estilo12'>".caracteres($row['nombre'])."</span></td>
		  <td  width='110'><span class='Estilo12'>".$row['precio']."</span></td>
		   <td  width='110'><span class='Estilo12'>".$row['tipo']."</span></td>
		  <td width='120' align='center'><a href='javascript:editar($codigo)'><img src='../imgenes/ico_edit.gif' border='0'></a></td>
		  
		</tr>";
		//$temcat=$row['des_cat'];
	  }
 //echo  "<tr><td>".$this->paginar($totalreg,$pag)."</td></tr>";
 //  echo  "<tr><td >".$this->paginacion($totalreg,$pag,$regvis)."</td></tr>";


	
	    echo  "</table></div></td></tr></table>|	
	<table  border='0' width='100%'><tr>
	<td width='100'>&nbsp;</td>
	<td> ";
	//echo $totalreg."-".$pag."-".$regvis;
	 echo $this->paginar($totalreg,$pag,$regvis);
	 
	echo "</td>
	<td  width='100'>&nbsp;</td>
	</tr></table>";


}


function consulta_clasificacion($cod){
$strSQL4="select * from clas_clie   where codigo=".$cod;
  $resultado4=mysql_query($strSQL4);
  $row4=mysql_fetch_array($resultado4);
  return $row4;
 
}

function new_clasificacion($idcond,$nombre,$cprecio,$ctipo){

//list($idcho,$nomcho)=explode("?",$cho);
	$strSQL2= "insert into clas_clie (nombre,precio,tipo) values ('$nombre','$cprecio','$ctipo')";
	//	echo $strSQL2;		
	mysql_query($strSQL2);
		
	echo "<script>alert('Clasificacion Agregada');location.href='m_clasificacion.php'</script>";
}

function act_clasificacion($idcond,$nombre,$cprecio,$ctipo){

$strSQL="update clas_clie set nombre='".$nombre."',precio='".$cprecio."',tipo='".$ctipo."' where codigo=".$idcond;

mysql_query($strSQL);
	echo "<script>alert('Clasificacion Actualizada');location.href='m_clasificacion';</script>";
}

function listar_medidas($condicion,$texto,$pag){
		$where="";
	//	echo $condicion; 
	$regvis=20;

	if($pag>=1) {
	$inicio=($pag-1)*$regvis;
	}else{
	$inicio=0;
	$pag=1;
	}
	if($condicion!=""){
	$where =" where $condicion like '%$texto%'";
	}
	//echo "select * from transportista $where order by id asc";
  $sql="select * from unidades $where  order by id";
 //echo $sql;
	$totalreg=mysql_num_rows(mysql_query($sql));
  $resultados = mysql_query($sql." limit ".$inicio.",".$regvis);
			 // echo "resultado".$resultado;
	echo '<table border="0" align="center">

<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">

      <td  width="50" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">N.</td>
      <td   width="50" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Unidad</td>
      <td  width="250" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Nombre</td>
	  <td  width="50" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Factor</td>
	  <td  width="100"   colspan="2" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Acciones</td>
    </tr>
	<tr><td colspan="6">
	<div style="position:relative;width:650px;height:250px;overflow:auto;border:0px solid;padding:0px;margin:0px;"><table border="0" align="left">' ;
	  $temcat="";
	while($row=mysql_fetch_array($resultados)){
	//if($row['des_cat']!=$temcat){
 		//echo '<tr  bgcolor="#EEEEEE"><td colspan="8"><b>'.$row['des_cat'].'</b<</td></tr>';
	//	}
	 echo '<tr bgcolor="#FFFFFF">

		  <td width="60" align="center"><span class="Estilo12">'.$row['id'].'</span></td>
		  <td width="80"><span class="Estilo12">'.caracteres($row['nombre']).'</span></td>
		  <td  width="270"><span class="Estilo12">'.caracteres($row['descripcion']).'</span></td>
		  <td  width="80"><span class="Estilo12">'.$row['factorSub'].'</span></td>
		  <td width="60" align="center"><a href=\'javascript:editar( "'.$row['id'].'");\'><img src="../imgenes/ico_edit.gif" border="0"></a></td>
		  <td width="50" align="center"><a href=\'javascript:eliminar("'.$row['id'].'");\'><img src="../imgenes/eliminar.gif" border="0"></a></td>
		</tr>';
		//$temcat=$row['des_cat'];
	  }

	    echo  "</table></div></td></tr></table>|	
	<table  border='0' width='100%'><tr>
	<td width='100'>&nbsp;</td>
	<td> ";
	//echo $totalreg."-".$pag."-".$regvis;
	 echo $this->paginar($totalreg,$pag,$regvis);
	 
	echo "</td>
	<td  width='100'>&nbsp;</td>
	</tr></table>";
}

function new_medidas($idunit,$simbolo,$nombre,$factorSub){

//list($idcho,$nomcho)=explode("?",$cho);
	$strSQL2= "insert into unidades values ($idunit,'$simbolo','$nombre','$factorSub')";
	//	echo $strSQL2;		
	mysql_query($strSQL2);
		
	echo "<script>alert('Unidad Agregada');location.href='m_unitmedida.php'</script>";
}

function act_medidas($idunit,$simbolo,$nombre,$factorSub){
/*echo "<script>if(confirm('Esta seguro que desea eliminar esta unidad?')){}</script>";*/
$strSQL="update unidades set nombre='".$simbolo."',descripcion='".$nombre."',factorSub='".$factorSub."' where id=".$idunit;

mysql_query($strSQL);
	echo "<script>alert('Unidad Actualizada')</script>";
/*echo "<script>}</script>";*/
}

function elim_medidas($codigo){
//echo $codigo;
//$sql="select * from cab_mov where transportista='".$codigo."'";
//$total=mysql_num_rows(mysql_query($sql));
//if($total==0){
	$tdoc=mysql_num_rows(mysql_query("select  * from producto where und='" .$codigo . "'"));
	//echo 	$tdoc;
	if($tdoc==0){
$strSQL="delete from unidades where id=".$codigo;
mysql_query($strSQL);
echo "<script>alert('Esta Unidad ha sido eliminada');location.href='m_unitmedida.php'</script>";
}else{
		echo "<script>alert('Esta Unidad no se puede eliminar tiene productos relacionados');location.href='m_unitmedida.php'</script>";
		}

}

function consulta_medidas($cod){
$strSQL4="select * from unidades   where id=".$cod;
  $resultado4=mysql_query($strSQL4);
  $row4=mysql_fetch_array($resultado4);
  return $row4;
 
}

function listar_costos($condicion,$texto,$pag){
		$where="";
	//	echo $condicion; 
	$regvis=20;

	if($pag>=1) {
	$inicio=($pag-1)*$regvis;
	}else{
	$inicio=0;
	$pag=1;
	}
	if($condicion!=""){
	$where =" where $condicion like '%$texto%'";
	}
	//echo "select * from transportista $where order by id asc";
  $sql="select * from centro_costo $where  order by id";
 //echo $sql;
	$totalreg=mysql_num_rows(mysql_query($sql));
  $resultados = mysql_query($sql." limit ".$inicio.",".$regvis);
			 // echo "resultado".$resultado;
	

	
	echo '<table border="0" align="center" cellpadding="1" cellspacing="1">

<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">

      <td  width="52" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">N.</td>
      <td   width="150" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Costo</td>
	  <td  width="90" colspan="2" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Acciones</td>
    </tr><tr><td colspan="5"><div style="position:relative;height:200px;overflow:auto;border:0px solid;padding:0px;margin:0px;"><table border="0" align="left">' ;
	  $temcat="";
	while($row=mysql_fetch_array($resultados)){

	 echo '<tr bgcolor="#FFFFFF" >

		  <td width="50" align="center"><span class="Estilo12">'.$row['id'].'</span></td>
		  <td width="200"><span class="Estilo12">'.caracteres($row['ccosto']).'</span></td>
		  <td width="45" align="center"><a href=\'javascript:editar( "'.$row['id'].'");\'><img src="../imgenes/ico_edit.gif" border="0"></a></td>
		  <td width="45" align="center"><a href=\'javascript:eliminar("'.$row['id'].'");\'><img src="../imgenes/eliminar.gif" border="0"></a></td>
		</tr>';
		//$temcat=$row['des_cat'];
	  }

	
	 //echo  "<tr><td>".$this->paginar($totalreg,$pag)."</td></tr>";
 //  echo  "<tr><td >".$this->paginacion($totalreg,$pag,$regvis)."</td></tr>";
    echo  "</table></div></td></tr></table>|	
	<table  border='0' width='100%'><tr>
	<td width='200'>&nbsp;</td>
	<td> ";
	//echo $totalreg."-".$pag."-".$regvis;
	 echo $this->paginar($totalreg,$pag,$regvis);
	 
	echo "</td>
	<td  width='200'>&nbsp;</td>
	</tr></table>";
	

}

function consulta_costos($cod){
$strSQL4="select * from centro_costo   where id=".$cod;
  $resultado4=mysql_query($strSQL4);
  $row4=mysql_fetch_array($resultado4);
  return $row4;
 
}

function c_ccosto($id){
$strSQL4="select id,ccosto from centro_costo";
  $resultado4=mysql_query($strSQL4);
  $elemento.="<select id='c_costo' name='c_costo'>";
  $elemento.="<option value=''>Seleccionar</option>";
  while($row4=mysql_fetch_array($resultado4)){

  $elemento.="<option value='".$row4['id']."'";
    if($id==$row4['id']) {
	$elemento.=' selected="selected" ';
	}
    $elemento.=">".$row4['ccosto']."</option>";
  } 
  $elemento.="</select>";
   return $elemento;
 
}
function new_costos($idcosto,$ncosto){

//list($idcho,$nomcho)=explode("?",$cho);
	$strSQL2= "insert into centro_costo (id,ccosto) values ($idcosto,'$ncosto')";
	//	echo $strSQL2;		
	mysql_query($strSQL2);
		
	echo "<script>alert('Costo Agregado');location.href='m_costo.php'</script>";
}

function act_costos($idcosto,$ncosto){
/*echo "<script>if(confirm('Esta seguro que desea eliminar esta unidad?')){}</script>";*/
$strSQL="update centro_costo set ccosto='".$ncosto."' where id=".$idcosto;

mysql_query($strSQL);
	echo "<script>alert('Costo Actualizado')</script>";
/*echo "<script>}</script>";*/
}

function elim_costos($codigo){
//echo $codigo;
//$sql="select * from cab_mov where transportista='".$codigo."'";
//$total=mysql_num_rows(mysql_query($sql));
//if($total==0){
	//$tdoc=mysql_num_rows(mysql_query("select  * from producto where und='" .$codigo . "'"));
	//echo 	$tdoc;
	//if($tdoc==0){
$strSQL="delete from centro_costo where id=".$codigo;
mysql_query($strSQL);
echo "<script>alert('Este Costo ha sido eliminado');location.href='m_costo.php'</script>";
//}else{
		/*echo "<script>alert('Esta Unidad no se puede eliminar tiene productos relacionados');location.href='m_unitmedida.php'</script>";*/
		//}

}

function listar_area_costos($condicion,$texto,$pag){
		$where="";
	//	echo $condicion; 
	$regvis=20;

	if($pag>=1) {
	$inicio=($pag-1)*$regvis;
	}else{
	$inicio=0;
	$pag=1;
	}
	if($condicion!=""){
	$where =" where $condicion like '%$texto%'";
	}
	//echo "select * from transportista $where order by id asc";
  $sql="select * from areacosto $where  order by id";
 //echo $sql;
	$totalreg=mysql_num_rows(mysql_query($sql));
  $resultados = mysql_query($sql." limit ".$inicio.",".$regvis);
			 // echo "resultado".$resultado;
	echo '<table border="0" align="center" cellpadding="1" cellspacing="1">

<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px" >
	  <td  width="45" align="center" align="center" style=" border:#CCCCCC solid 1px">&nbsp;</td>	
      <td  class="EstiloTexto1" width="40" align="center"  align="center" style=" border:#CCCCCC solid 1px">N.</td>
      <td style=" border:#CCCCCC solid 1px" class="EstiloTexto1" width="165" align="center">Tipos de Negocio</td>
	  <td  style=" border:#CCCCCC solid 1px" class="EstiloTexto1" width="90" align="center">Acciones</td>
    </tr><tr><td colspan="5"><div style="position:relative;height:105px;overflow:auto;border:0px solid;padding:0px;margin:0px;">
	<table border="0" align="left" cellpadding="0" cellspacing="1">' ;
	  $temcat="";
	while($row=mysql_fetch_array($resultados)){

	 echo '<tr  bgcolor="#FFFFFF" onclick="entrada(this);cargar_datos2(0)">
		  <td  width="52" align="center"  align="center">
		  <input style="border: 0px; background:none;  " type="radio" name="xarea" value="" />
		  </td>
		  <td width="50" align="center"><span class="Estilo12">'.$row['id'].'</span></td>
		  <td width="200"><span class="Estilo12">'.caracteres($row['nombre']).'</span></td>
		  <td width="90" align="center"><a href=\'javascript:editar( "'.$row['id'].'");\'><img src="../imgenes/ico_edit.gif" border="0"></a></td>

		</tr>';
		//$temcat=$row['des_cat'];
	  }
 //echo  "<tr><td>".$this->paginar($totalreg,$pag)."</td></tr>";
 //  echo  "<tr><td >".$this->paginacion($totalreg,$pag,$regvis)."</td></tr>";
    echo  "</table></div></td></tr></table>|
	
	<table  border='0' width='100%'><tr>
	<td width='90'>&nbsp;</td>
	<td> ";
	//echo $totalreg."-".$pag."-".$regvis;
	 echo $this->paginar($totalreg,$pag,$regvis);
	 
	echo "</td>
	<td  width='90'>&nbsp;</td>
	</tr></table>";
}

function lisProxArea($condicion,$texto,$pag,$codArea,$paramArray,$accion){
		
	//	echo $condicion; 
	
	
	if($accion=='addProc'){
		$arrayCodProc=explode('|',$paramArray);
		
		for ($i=1; $i<count($arrayCodProc); $i++){ 
		$strInsert="insert into procxarea(areacosto,proceso,moneda,cc) values('".$codArea."','".$arrayCodProc[$i]."','01','1')";
		mysql_query($strInsert);
		}
	
	}
	
	if($accion=='editProc'){
		$arrayCodProc=explode('|',$paramArray);
		
		$strUpdate="update procxarea set costo1='".$arrayCodProc[1]."',costo2='".$arrayCodProc[2]."',cc='".$arrayCodProc[3]."',orden='".$arrayCodProc[4]."',unidad='".$arrayCodProc[5]."' where id='".$arrayCodProc[0]."'";
		mysql_query($strUpdate);
		
	//	echo $strUpdate;
	}
	
	if($accion=='deleteProc'){
	$arrayCodProc=$paramArray;
	$strDelete="delete from procxarea where id='".$arrayCodProc."'";
	mysql_query($strDelete);
	}
	
	$where="";	
	$regvis=20;

	if($pag>=1) {
	$inicio=($pag-1)*$regvis;
	}else{
	$inicio=0;
	$pag=1;
	}
	if($condicion!=""){
	$where =" and $condicion like '%$texto%'";
	}
	//echo "select * from transportista $where order by id asc";
  $sql="select * from procxarea where areacosto='".$codArea."' order by orden";
 //echo $sql;
	$totalreg=mysql_num_rows(mysql_query($sql));
    $resultados = mysql_query($sql." limit ".$inicio.",".$regvis);
	$contResult=mysql_num_rows($resultados);
			 // echo "resultado".$resultado;
	echo '<br><table border="0" align="center" cellpadding="1" cellspacing="1" width="700px" >

<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px" >
	  <td  width="60" align="center" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Orden</td>	
      <td  style=" border:#CCCCCC solid 1px" class="EstiloTexto1" width="200" align="center">Proceso</td>
      <td style=" border:#CCCCCC solid 1px" class="EstiloTexto1" width="60" align="center">Moneda</td>
	  <td style=" border:#CCCCCC solid 1px" class="EstiloTexto1" width="60" align="center">Unidad</td>
	  <td  style=" border:#CCCCCC solid 1px" class="EstiloTexto1" width="60" align="center">Propio</td>
	  <td  style=" border:#CCCCCC solid 1px" class="EstiloTexto1" width="60" align="center">Subcontrata</td>
	  <td  style=" border:#CCCCCC solid 1px" class="EstiloTexto1" width="160" align="center">Centro Costo</td>
	  <td  style=" border:#CCCCCC solid 1px" class="EstiloTexto1" width="80" align="center">Acciones</td>
	  
    </tr>
	<tr><td colspan="5">
	
	<div style="position:relative;height:105px;overflow-y:scroll;border:0px solid;padding:0px;margin:0px;">
	
	<table border="0" align="left" cellpadding="1" cellspacing="1"  width="680px" >' ;
	  $temcat="";
	  if($contResult==0){
	   echo '<tr  bgcolor="#FFFFFF">
		  <td align="center">Esta area no tiene procesos...</td>
		  </tr>
		  ';
		  
	  }
	  
	while($row=mysql_fetch_array($resultados)){

		$strSQLProc="select * from procesos where id='".$row['proceso']."'";
		$rowProc=$this->ConsultaDatos($strSQLProc);
		$nombreProc=$rowProc['nombre'];
				
	 echo '<tr  bgcolor="#FFFFFF" onclick="entrada2(this)">
		  <td width="60" align="center" class="Estilo12"><input readonly  style="border:none; background:none;width=40px " name="" type="text" value="'.$row['orden'].'" /></td>
		  <td width="160" align="center" class="Estilo12">'.caracteres($nombreProc).'</td>
		  <td width="60" class="Estilo12">'.$row['moneda'].'</td>';
		  
		   echo '<td width="60" class="Estilo12"><select name="unidad" id="unidad" style="width:50px" disabled>';
		  		$strSQLCC="select * from unidades order by nombre ";
				//$rowProcCC=$this->ConsultaDatos($strSQLCC);
				//echo $rowProcCC;
				$resultadoCC=mysql_query($strSQLCC);
				
				while($rowProcCC=mysql_fetch_array($resultadoCC)){
					
				  if($row['unidad']==$rowProcCC['id']){
				  echo '<option selected value='.$rowProcCC['id'].'>'.$rowProcCC['nombre'].'</option>';
				  }else{	
				  echo '<option value='.$rowProcCC['id'].'>'.$rowProcCC['nombre'].'</option>';
				  }
				  			 
		 		}
		  
		echo' </select></td> <td width="60" class="Estilo12"><input readonly  style="border:none; background:none;width=40px " name="" type="text" value="'.number_format($row['costo1'],2).'" /></td>
		  <td width="60"><input readonly  style="border:none; background:none;width=40px " name="" type="text" value="'.number_format($row['costo2'],2).'" /></td>
		  				  
		  <td width="160">';
		  
		  //  where id='".$row['cc']."'
		  echo '<select name="cc" style="width:140px" disabled>';
		  		$strSQLCC="select * from centro_costo order by ccosto ";
				//$rowProcCC=$this->ConsultaDatos($strSQLCC);
				//echo $rowProcCC;
				$resultadoCC=mysql_query($strSQLCC);
				
				while($rowProcCC=mysql_fetch_array($resultadoCC)){
					
				  if($row['cc']==$rowProcCC['id']){
				  echo '<option selected value='.$rowProcCC['id'].'>'.$rowProcCC['ccosto'].'</option>';
				  }else{	
				  echo '<option value='.$rowProcCC['id'].'>'.$rowProcCC['ccosto'].'</option>';
				  }
				  			 
		 		}
				
		  echo '</select></td>
		  <td  width="35" align="center" style="display:block">
		 <img style="cursor:pointer" title="Editar"  onclick=\'javascript:editarRow( "'.$row['id'].'",this);\' src="../imgenes/ico_edit.gif" border="0">
		 </td>
		 <td  width="35" align="center" style="display:none">
		 <img style="cursor:pointer"  width="16" height="16" title="Guardar"  onclick=\'javascript:saveRow( "'.$row['id'].'",this);\' src="../imgenes/revert.png" border="0">
		 	 </td>
		 <td  width="35" align="center">	 
		  <img style="cursor:pointer" title="Delete"  onclick=\'javascript:deleteRow( "'.$row['id'].'",this);\' src="../imgenes/eliminar.gif" border="0">
		  </td>

		</tr>';
		//$temcat=$row['des_cat'];
	  }
 //echo  "<tr><td>".$this->paginar($totalreg,$pag)."</td></tr>";
 //  echo  "<tr><td >".$this->paginacion($totalreg,$pag,$regvis)."</td></tr>";
    echo  "</table></div></td></tr></table>|
	
	<table align='center'  border='0' width='700px'><tr>
	
	<td> ";
	//echo $totalreg."-".$pag."-".$regvis;
	 echo $this->paginar($totalreg,$pag,$regvis);
	 
	echo "</td>
	
	</tr></table>";
}



function consulta_area_costos($cod){
$strSQL4="select * from areacosto   where id=".$cod;
//echo $strSQL4;
  $resultado4=mysql_query($strSQL4);
  $row4=mysql_fetch_array($resultado4);
  return $row4;
 
}

function consulta_DatosTabla($cod,$tabla){
$strSQL4="select * from $tabla  where id=".$cod;
//echo $strSQL4;
  $resultado4=mysql_query($strSQL4);
  $row4=mysql_fetch_array($resultado4);
  return $row4;
 
}

/*
function consulta_area_costos($cod){
$strSQL4="select * from areacosto   where id=".$cod;
//echo $strSQL4;
  $resultado4=mysql_query($strSQL4);
  $row4=mysql_fetch_array($resultado4);
  return $row4;
 
}
*/
function new_area_costos($idcosto,$ncosto){

//list($idcho,$nomcho)=explode("?",$cho);
	$strSQL2= "insert into areacosto (id,nombre)values ($idcosto,'$ncosto')";
	//	echo $strSQL2;		
	mysql_query($strSQL2);
		
	echo "<script>alert('Costo Agregado');location.href='m_area_costo.php'</script>";
}

function act_area_costos($idcosto,$ncosto){
/*echo "<script>if(confirm('Esta seguro que desea eliminar esta unidad?')){}</script>";*/
$strSQL="update areacosto set nombre='".$ncosto."' where id=".$idcosto;

mysql_query($strSQL);
	echo "<script>alert('Costo Actualizado')</script>";
/*echo "<script>}</script>";*/
}

function save_factUtil($id,$descripcion,$factor1,$factor2,$factor3,$factor4){

//list($idcho,$nomcho)=explode("?",$cho);
	$strSQL2= "insert into factorutilidad (id,conceptos,factor1,factor2,factor3,factor4)values ($idcosto,'$descripcion','$factor1','$factor2','$factor3','$factor4')";
	//	echo $strSQL2;		
	mysql_query($strSQL2);
		
	/*echo "<script>alert('Costo Agregado');location.href='m_area_costo.php'</script>";*/
}

function update_factUtil($id,$descripcion,$factor1,$factor2,$factor3,$factor4){
/*echo "<script>if(confirm('Esta seguro que desea eliminar esta unidad?')){}</script>";*/
$strSQL="update factorutilidad set conceptos='".$descripcion."',factor1='".$factor1."',factor2='".$factor2."',factor3='".$factor3."',factor4='".$factor4."' where id=".$id;
//echo $strSQL;
mysql_query($strSQL);
	/*echo "<script>alert('Costo Actualizado')</script>";*/
/*echo "<script>}</script>";*/
}


function listar_procesos($condicion,$texto,$pag){
		$where="";
	//	echo $condicion; 
	$regvis=20;

	if($pag>=1) {
	$inicio=($pag-1)*$regvis;
	}else{
	$inicio=0;
	$pag=1;
	}
	if($condicion!=""){
	$where =" where $condicion like '%$texto%'";
	}
	//echo "select * from transportista $where order by id asc";
  $sql="select * from procesos $where  order by id";
 //echo $sql;
	$totalreg=mysql_num_rows(mysql_query($sql));
  $resultados = mysql_query($sql." limit ".$inicio.",".$regvis);
			 // echo "resultado".$resultado;
	echo '<table border="0" align="center">

<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">

      <td  width="52" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">N.</td>
      <td   width="150"  align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1" >Nombre</td>
	  <td   width="150" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Descripcion</td>
	  <td  width="90" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Acciones</td>
    </tr><tr><td colspan="5"><div style="position:relative;height:280px;overflow:auto;border:0px solid;padding:0px;margin:0px;"><table border="0" align="left">' ;
	  $temcat="";
	while($row=mysql_fetch_array($resultados)){

	 echo '<tr bgcolor="#FFFFFF">

		  <td width="70" align="center"><span class="Estilo12">'.$row['id'].'</span></td>
		  <td width="200"><span class="Estilo12">'.caracteres($row['nombre']).'</span></td>
		   <td width="200"><span class="Estilo12">'.caracteres($row['descripcion']).'</span></td>
		  <td width="55" align="center"><a href=\'javascript:editar( "'.$row['id'].'");\'><img src="../imgenes/ico_edit.gif" border="0"></a></td>
		  <td width="55" align="center"><a href=\'javascript:eliminar("'.$row['id'].'");\'><img src="../imgenes/eliminar.gif" border="0"></a></td>

		</tr>';
		//$temcat=$row['des_cat'];
	  }
	
	echo  "</table></div></td></tr></table>|
	
	<table  border='0' width='100%'><tr>
	<td width='90'>&nbsp;</td>
	<td> ";
	//echo $totalreg."-".$pag."-".$regvis;
	 echo $this->paginar($totalreg,$pag,$regvis);
	 
	echo "</td>
	<td  width='90'>&nbsp;</td>
	</tr></table>";
}

function consulta_procesos($cod){
$strSQL4="select * from procesos   where id=".$cod;
//echo $strSQL4;
  $resultado4=mysql_query($strSQL4);
  $row4=mysql_fetch_array($resultado4);
  return $row4;
 
}

function new_procesos($idpro,$nnombre,$ndescripcion){

//list($idcho,$nomcho)=explode("?",$cho);
	$strSQL2= "insert into procesos (id,nombre,descripcion)values ($idpro,'$nnombre','$ndescripcion')";
	//	echo $strSQL2;		
	mysql_query($strSQL2);
		
	echo "<script>alert('Proceso Agregado');location.href='procesos.php'</script>";
}

function act_procesos($idpro,$nnombre,$ndescripcion){
/*echo "<script>if(confirm('Esta seguro que desea eliminar esta unidad?')){}</script>";*/
$strSQL="update procesos set nombre='".$nnombre."',descripcion='".$ndescripcion."' where id=".$idpro;

mysql_query($strSQL);
	echo "<script>alert('Proceso Actualizado');location.href='procesos.php'</script>";
/*echo "<script>}</script>";*/
}

function elim_procesos($codigo){

$strSQL="delete from procesos where id=".$codigo;
mysql_query($strSQL);
echo "<script>alert('Este Proceso ha sido eliminado');location.href='procesos.php'</script>";


}

function listar_coperativo($condicion,$texto,$pag){
		$where="";
	//	echo $condicion; 
	$regvis=20;

	if($pag>=1) {
	$inicio=($pag-1)*$regvis;
	}else{
	$inicio=0;
	$pag=1;
	}
	if($condicion!=""){
	$where =" where $condicion like '%$texto%'";
	}
	//echo "select * from transportista $where order by id asc";
  $sql="select * from costoperativo $where  order by id";
 //echo $sql;
	$totalreg=mysql_num_rows(mysql_query($sql));
  $resultados = mysql_query($sql." limit ".$inicio.",".$regvis);
			 // echo "resultado".$resultado;
	echo '<table border="0" align="center"  cellpadding="1" cellspacing="1">

<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">

      <td  width="52" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">N.</td>
      <td   width="150" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Nombre</td>
	  <td   width="150" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Descripcion</td>
	<td   width="150" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">C. Costo</td>
	<td   width="150" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">T. Costo</td>
	<td   width="150" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Lima</td>
	<td   width="150" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Provincia</td>
	<td   width="90" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Acciones</td>
    </tr><tr><td colspan="8"><div style="position:relative;height:250px;overflow:auto;border:0px solid;padding:0px;margin:0px;"><table border="0" align="left">' ;
	  $temcat="";
	while($row=mysql_fetch_array($resultados)){

	 echo '<tr  bgcolor="#FFFFFF" >

		  <td width="50" align="center"><span class="Estilo12">'.$row['id'].'</span></td>
		  <td width="200"><span class="Estilo12">'.caracteres($row['nombre']).'</span></td>
		   <td width="200"><span class="Estilo12">'.caracteres($row['descripcion']).'</span></td>
			<td width="200"><span class="Estilo12">'.$row['cc'].'</span></td>
			<td width="200"><span class="Estilo12">'.$row['costoDI'].'</span></td>
			<td width="200"><span class="Estilo12">'.$row['costo1'].'</span></td>
			<td width="200"><span class="Estilo12">'.$row['costo2'].'</span></td>
		  <td width="45" align="center"><a href=\'javascript:editar( "'.$row['id'].'");\'><img src="../imgenes/ico_edit.gif" border="0"></a></td>
		  <td width="45" align="center"><a href=\'javascript:eliminar("'.$row['id'].'");\'><img src="../imgenes/eliminar.gif" border="0"></a></td>

		</tr>';
		//$temcat=$row['des_cat'];
	  }
 //echo  "<tr><td>".$this->paginar($totalreg,$pag)."</td></tr>";
 //  echo  "<tr><td >".$this->paginacion($totalreg,$pag,$regvis)."</td></tr>";
    echo  "</table></div></td></tr></table>|<table border='0' width='100%'><tr><td >";
	//echo $totalreg."-".$pag."-".$regvis;
	 echo $this->paginar($totalreg,$pag,$regvis);
	echo "</td></tr></table>";
}

function consulta_coperativo($cod){
$strSQL4="select id,nombre,descripcion,cc,costoDI,costo1,costo2,moneda,concepto,nivel from costoperativo   where id=".$cod;
//echo $strSQL4;
  $resultado4=mysql_query($strSQL4);
  $row4=mysql_fetch_array($resultado4);
  list($res)=mysql_fetch_array(mysql_query("select nombre from producto where idproducto=".$row4['concepto']));
  $row4['nom_prod']=$res;
  return $row4;
 
}



function new_coperativo($idpro,$nnombre,$ndescripcion,$nc_costo,$ntcosto,$ncosto1,$ncosto2,$nmon,$nconcepto,$nivel){

//list($idcho,$nomcho)=explode("?",$cho);
	$strSQL2= "insert into costoperativo (id,nombre,descripcion,cc,costoDI,costo1,costo2,moneda,concepto,nivel)values ($idpro,'$nnombre','$ndescripcion',$nc_costo,'$ntcosto','$ncosto1','$ncosto2','$nmon',$nconcepto,$nivel)";
		//echo $strSQL2;		
	mysql_query($strSQL2);
		
	echo "<script>alert('Costo Operativo Agregado');location.href='cOperativo.php'</script>";
}

function act_coperativo($idpro,$nnombre,$ndescripcion,$nc_costo,$ntcosto,$ncosto1,$ncosto2,$nmon,$nconcepto,$nivel){
/*echo "<script>if(confirm('Esta seguro que desea eliminar esta unidad?')){}</script>";*/
$strSQL="update costoperativo set nombre='".$nnombre."',descripcion='".$ndescripcion."',cc=".$nc_costo.",costoDI='".$ntcosto."',costo1='".$ncosto1."',costo2='".$ncosto2."',moneda='".$nmon."',concepto='".$nconcepto."',nivel='".$nivel."' where id=".$idpro;

//echo $strSQL;
mysql_query($strSQL);
	echo "<script>alert('Costo Operativo Actualizado');location.href='cOperativo.php'</script>";
/*echo "<script>}</script>";*/
}

function elim_coperativo($codigo){

$strSQL="delete from costoperativo where id=".$codigo;
mysql_query($strSQL);
echo "<script>alert('Este Costo Operativo ha sido eliminado');location.href='cOperativo.php'</script>";


}

function tblFactUtil($condicion,$texto,$pag){
		$where="";
		//echo $condicion; 
	$regvis=20;

	if($pag>=1) {
	$inicio=($pag-1)*$regvis;
	}else{
	$inicio=0;
	$pag=1;
	}
	if($texto!=""){
	$where =" where $condicion like '%$texto%'";
	}
	//echo "select * from transportista $where order by id asc";
  $sql="select * from factorutilidad  $where  order by id";
 //echo $sql;
	$totalreg=mysql_num_rows(mysql_query($sql));
  $resultados = mysql_query($sql." limit ".$inicio.",".$regvis);
			 // echo "resultado".$sql;
	echo '<table width="800" border="0" align="center" cellpadding="1" cellspacing="1">

<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px" >
	  <td  width="25" align="center" align="center" style=" border:#CCCCCC solid 1px">&nbsp;</td>	
      <td width="25" class="EstiloTexto1"  align="center"  align="center" style=" border:#CCCCCC solid 1px">N.</td>
      <td width="250" style=" border:#CCCCCC solid 1px" class="EstiloTexto1" align="center">Descripción</td>
	        <td width="100" style=" border:#CCCCCC solid 1px" class="EstiloTexto1"  align="center">15 Dias</td>
			<td width="100" style=" border:#CCCCCC solid 1px" class="EstiloTexto1"  align="center">30 Dias</td>
			<td width="100" style=" border:#CCCCCC solid 1px" class="EstiloTexto1"  align="center">45 Dias</td>
			<td width="100" style=" border:#CCCCCC solid 1px" class="EstiloTexto1"  align="center">60 Dias</td>
							  
	  <td width="100" style=" border:#CCCCCC solid 1px" class="EstiloTexto1"  align="center">Acciones</td>
	  
    </tr>
	
	<tr>
	<td colspan="8">
	<div  style="position:relative;width:800px;height:150px;overflow-y:scroll;border:0px solid;padding:0px;margin:0px;">
	
	<table width="780" border="0" align="left" cellpadding="1" cellspacing="1">' ;
	  $temcat="";
	while($row=mysql_fetch_array($resultados)){

	 echo '<tr  bgcolor="#FFFFFF" onclick="entrada(this);">
		  <td width="25"  align="center"  align="center">
		  <input style="border: 0px; background:none;  " type="radio" name="xarea" value="" />
		  </td>
		  <td width="25"  align="center"><span class="Estilo12">'.$row['id'].'</span></td>
		  <td width="250" ><span class="Estilo12">'.caracteres($row['conceptos']).'</span></td>
		  <td width="100" ><span class="Estilo12">'.$row['factor1'].'%</span></td>
		  <td width="100" ><span class="Estilo12">'.$row['factor2'].'%</span></td>
		  <td width="100" ><span class="Estilo12">'.$row['factor3'].'%</span></td>
		  <td width="100" ><span class="Estilo12">'.$row['factor4'].'%</span></td>
		  
		  <td width="80" align="center"><a href=\'javascript:editar( "'.$row['id'].'");\'><img src="../imgenes/ico_edit.gif" border="0"></a></td>

		</tr>';
		//$temcat=$row['des_cat'];
	  }
 //echo  "<tr><td>".$this->paginar($totalreg,$pag)."</td></tr>";
 //  echo  "<tr><td >".$this->paginacion($totalreg,$pag,$regvis)."</td></tr>";
    echo  "</table></div></td></tr></table>|
	
	<table width='100%' border='0' ><tr>
	<td>&nbsp;</td>
	<td> ";
	//echo $totalreg."-".$pag."-".$regvis;
	 echo $this->paginar($totalreg,$pag,$regvis);
	 
	echo "</td>
	<td >&nbsp;</td>
	</tr></table>";
}


function listar_tpagos($condicion,$texto,$pag){
		$where="";
	//	echo $condicion; 
	$regvis=20;

	if($pag>=1) {
	$inicio=($pag-1)*$regvis;
	}else{
	$inicio=0;
	$pag=1;
	}
	if($condicion!=""){
	$where =" where $condicion like '%$texto%'";
	}
	//echo "select * from transportista $where order by id asc";
  $sql="select * from t_pago $where  order by id";
 //echo $sql;
	$totalreg=mysql_num_rows(mysql_query($sql));
  $resultados = mysql_query($sql." limit ".$inicio.",".$regvis);
			 // echo "resultado".$resultado;
	echo '<table border="0" align="center"  cellpadding="1" cellspacing="1">

<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">

      <td  width="42" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">N.</td>
      <td   width="40" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Cod</td>
	  <td   width="150" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Descripcion</td>
	<td   width="150" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Formato</td>
	<td   width="75" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Cola</td>
	<td   width="75" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Modalidad</td>
	
	<td   width="90" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Acciones</td>
    </tr><tr><td colspan="8"><div style="position:relative;height:200px;overflow:auto;border:0px solid;padding:0px;margin:0px;"><table border="0" align="left">' ;
	  $temcat="";
	while($row=mysql_fetch_array($resultados)){

	 echo '<tr  bgcolor="#FFFFFF" >

		  <td width="50" align="center"><span class="Estilo12">'.$row['id'].'</span></td>
		  <td width="50"><span class="Estilo12">'.$row['codigo'].'</span></td>
		   <td width="200"><span class="Estilo12">'.caracteres($row['descripcion']).'</span></td>
			<td width="180"><span class="Estilo12">'.$row['formato'].'</span></td>
			<td width="100"><span class="Estilo12">'.$row['cola'].'</span></td>
			<td width="100"><span class="Estilo12">'.$row['modalidad'].'</span></td>
		  <td width="45" align="center"><a href=\'javascript:editar( "'.$row['id'].'");\'><img src="../imgenes/ico_edit.gif" border="0"></a></td>
		  <td width="45" align="center"><a href=\'javascript:eliminar("'.$row['id'].'");\'><img src="../imgenes/eliminar.gif" border="0"></a></td>

		</tr>';
		//$temcat=$row['des_cat'];
	  }
 //echo  "<tr><td>".$this->paginar($totalreg,$pag)."</td></tr>";
 //  echo  "<tr><td >".$this->paginacion($totalreg,$pag,$regvis)."</td></tr>";
    echo  "</table></div></td></tr></table>|<table border='0' width='100%'><tr><td >";
	//echo $totalreg."-".$pag."-".$regvis;
	 echo $this->paginar($totalreg,$pag,$regvis);
	echo "</td></tr></table>";
}

function consulta_tpagos($cod){
$strSQL4="select id,codigo,descripcion,formato,cola,modalidad,cc1,cc2 from t_pago where id='".$cod."'";
//echo $strSQL4;
  $resultado4=mysql_query($strSQL4);
  $row4=mysql_fetch_array($resultado4);
  return $row4;
 
}

function new_tpagos($id,$ncodigo,$ndescripcion,$nformato,$ncola,$modalidad,$cc1,$cc2){

//list($idcho,$nomcho)=explode("?",$cho);
	$strSQL2= "insert into t_pago (id,codigo,descripcion,formato,cola,modalidad,cc1,cc2)values ($id,'$ncodigo','$ndescripcion','$nformato','$ncola','$modalidad','$cc1','$cc2')";
		//echo $strSQL2;		
	mysql_query($strSQL2);
		
	echo "<script>alert('Tipo de Pago Agregado');location.href='tPagos.php'</script>";
}

function act_tpagos($id,$ncodigo,$ndescripcion,$nformato,$ncola,$modalidad,$cc1,$cc2){
/*echo "<script>if(confirm('Esta seguro que desea eliminar esta unidad?')){}</script>";*/
$strSQL="update t_pago set codigo='".$ncodigo."',descripcion='".$ndescripcion."',formato='".$nformato."',cola='".$ncola."',modalidad='".$modalidad."',cc1='".$cc1."',cc2='".$cc2."' where id=".$id;
//echo $strSQL;
mysql_query($strSQL);
	echo "<script>alert('Tipo de Pago Actualizado');location.href='tPagos.php'</script>";
/*echo "<script>}</script>";*/
}

function elim_tpagos($codigo){

$strSQL="delete from t_pago where id=".$codigo;
mysql_query($strSQL);
echo "<script>alert('Este Tipo dePago ha sido eliminado');location.href='tPagos.php'</script>";
}

function listar_bancos($condicion,$texto,$pag){
		$where="";
	//	echo $condicion; 
	$regvis=20;

	if($pag>=1) {
	$inicio=($pag-1)*$regvis;
	}else{
	$inicio=0;
	$pag=1;
	}
	if($condicion!=""){
	$where =" where $condicion like '%$texto%'";
	}
	//echo "select * from transportista $where order by id asc";
  $sql="select * from bancos $where  order by id";
 //echo $sql;
	$totalreg=mysql_num_rows(mysql_query($sql));
  $resultados = mysql_query($sql." limit ".$inicio.",".$regvis);
			 // echo "resultado".$resultado;
	echo '<table border="0" align="center"  cellpadding="1" cellspacing="1">

<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">

      <td  width="42" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">N.</td>
      <td   width="40" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Cod</td>
	  <td   width="150" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Descripcion</td>
	<td   width="90" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Acciones</td>
    </tr><tr><td colspan="8"><div style="position:relative;height:200px;overflow:auto;border:0px solid;padding:0px;margin:0px;"><table border="0" align="left">' ;
	  $temcat="";
	while($row=mysql_fetch_array($resultados)){

	 echo '<tr  bgcolor="#FFFFFF" >

		  <td width="50" align="center"><span class="Estilo12">'.$row['id'].'</span></td>
		  <td width="50"><span class="Estilo12">'.$row['codigo'].'</span></td>
		   <td width="200"><span class="Estilo12">'.caracteres($row['descrip']).'</span></td>
		  <td width="45" align="center"><a href=\'javascript:editar( "'.$row['id'].'");\'><img src="../imgenes/ico_edit.gif" border="0"></a></td>
		  <td width="45" align="center"><a href=\'javascript:eliminar("'.$row['id'].'");\'><img src="../imgenes/eliminar.gif" border="0"></a></td>

		</tr>';
		//$temcat=$row['des_cat'];
	  }
 //echo  "<tr><td>".$this->paginar($totalreg,$pag)."</td></tr>";
 //  echo  "<tr><td >".$this->paginacion($totalreg,$pag,$regvis)."</td></tr>";
    echo  "</table></div></td></tr></table>|<table border='0' width='100%'><tr><td >";
	//echo $totalreg."-".$pag."-".$regvis;
	 echo $this->paginar($totalreg,$pag,$regvis);
	echo "</td></tr></table>";
}

function consulta_bancos($cod){
$strSQL4="select id,descrip,codigo from bancos where id=".$cod;
//echo $strSQL4;
  $resultado4=mysql_query($strSQL4);
  $row4=mysql_fetch_array($resultado4);
  return $row4;
 
}

function new_bancos($ncodigo,$ndescripcion){

//list($idcho,$nomcho)=explode("?",$cho);
	$strSQL2= "insert into bancos (codigo,descrip)values ('$ncodigo','$ndescripcion')";
		//echo $strSQL2;		
	mysql_query($strSQL2);
		
	echo "<script>alert('Banco Agregado');location.href='m_bancos.php'</script>";
}

function act_bancos($id,$ndescripcion){
/*echo "<script>if(confirm('Esta seguro que desea eliminar esta unidad?')){}</script>";*/
$strSQL="update bancos set descrip='".$ndescripcion."' where id=".$id;
//echo $strSQL;
mysql_query($strSQL);
	echo "<script>alert('Banco Actualizado');location.href='m_bancos.php'</script>";
/*echo "<script>}</script>";*/
}

function elim_bancos($codigo){
$strSQL="delete from bancos where id=".$codigo;
//echo $strSQL;
mysql_query($strSQL);
echo "<script>alert('Este Banco ha sido eliminado');location.href='m_bancos.php'</script>";
}

function listar_zonas($condicion,$texto,$pag){
	$where="";
	//	echo $condicion; 
	$regvis=20;

	if($pag>=1) {
	$inicio=($pag-1)*$regvis;
	}else{
	$inicio=0;
	$pag=1;
	}
	if($condicion!=""){
	$where =" where $condicion like '%$texto%'";
	}
	//echo "select * from transportista $where order by id asc";
  $sql="select * from zonas $where order by codigo";
 //echo $sql;
	$totalreg=mysql_num_rows(mysql_query($sql));
  $resultados = mysql_query($sql." limit ".$inicio.",".$regvis);
			 // echo "resultado".$resultado;
	echo '<table border="0" align="center"  cellpadding="1" cellspacing="1">

<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">

      <td  width="42" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1"></td>
      <td   width="40" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Cod</td>
	  <td   width="150" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Descripcion</td>
	<td   width="90" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Acciones</td>
    </tr><tr><td colspan="8"><div style="position:relative;height:200px;overflow:auto;border:0px solid;padding:0px;margin:0px;"><table border="0" align="left">' ;
	  $temcat="";
	while($row=mysql_fetch_array($resultados)){

	 echo '<tr  bgcolor="#FFFFFF" >

		  <td width="50" align="center"><span class="Estilo12"></span></td>
		  <td width="50"><span class="Estilo12">'.$row['codigo'].'</span></td>
		   <td width="200"><span class="Estilo12">'.caracteres($row['zona']).'</span></td>
		  <td width="45" align="center"><a href=\'javascript:editar( "'.$row['codigo'].'");\'><img src="../imgenes/ico_edit.gif" border="0"></a></td>
		  <td width="45" align="center"><a href=\'javascript:eliminar("'.$row['codigo'].'");\'><img src="../imgenes/eliminar.gif" border="0"></a></td>

		</tr>';
		//$temcat=$row['des_cat'];
	  }
 //echo  "<tr><td>".$this->paginar($totalreg,$pag)."</td></tr>";
 //  echo  "<tr><td >".$this->paginacion($totalreg,$pag,$regvis)."</td></tr>";
    echo  "</table></div></td></tr></table>|<table border='0' width='100%'><tr><td >";
	//echo $totalreg."-".$pag."-".$regvis;
	 echo $this->paginar($totalreg,$pag,$regvis);
	echo "</td></tr></table>";
}

function consulta_zonas($cod){
$strSQL4="select codigo,zona from zonas where codigo='".$cod."'";
echo $strSQL4;
  $resultado4=mysql_query($strSQL4);
  $row4=mysql_fetch_array($resultado4);
  return $row4;
 
}

function new_zonas($ncodigo,$ndescripcion){

//list($idcho,$nomcho)=explode("?",$cho);
	$strSQL2= "insert into zonas (codigo,zona)values ('$ncodigo','$ndescripcion')";
		//echo $strSQL2;		
	mysql_query($strSQL2);
		
	echo "<script>alert('Zona Agregada');location.href='m_zonas.php'</script>";
}

function act_zonas($id,$ndescripcion){
/*echo "<script>if(confirm('Esta seguro que desea eliminar esta unidad?')){}</script>";*/
$strSQL="update zonas set zona='".$ndescripcion."' where codigo='".$id."'";
//echo $strSQL;
mysql_query($strSQL);
	echo "<script>alert('Zona Actualizada');location.href='m_zonas.php'</script>";
/*echo "<script>}</script>";*/
}

function elim_zonas($codigo){
$strSQL="delete from zonas where codigo='".$codigo."'";
//echo $strSQL;
mysql_query($strSQL);
echo "<script>alert('Esta Zona ha sido eliminada');location.href='m_zonas.php'</script>";
}

function listar_ctasb($condicion,$texto,$pag){
		$where="";
	//	echo $condicion; 
	$regvis=20;

	if($pag>=1) {
	$inicio=($pag-1)*$regvis;
	}else{
	$inicio=0;
	$pag=1;
	}
	if($condicion!=""){
	$where =" where $condicion like '%$texto%'";
	}
	//echo "select * from transportista $where order by id asc";
  $sql="select b.descrip as banco,c.*,mo.simbolo as mone from cuentas c inner join moneda mo on mo.id=c.moneda inner join bancos b on b.id=c.banco_id $where  order by c.cta_id";
 //echo $sql;
	$totalreg=mysql_num_rows(mysql_query($sql));
  $resultados = mysql_query($sql." limit ".$inicio.",".$regvis);
			 // echo "resultado".$resultado;
	echo '<table border="0" align="center"  cellpadding="1" cellspacing="1">

<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">

      <td  width="50" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Cod</td>
      <td   width="116" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Cuenta</td>
	  <td   width="180" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Titular</td>
      <td   width="50" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Moneda</td>
      <td   width="120" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Banco</td>
	<td   width="90" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Acciones</td>
    </tr><tr><td colspan="8"><div style="position:relative;height:200px;overflow:auto;border:0px solid;padding:0px;margin:0px;"><table border="0" align="left" cellpadding="1" cellspacing="1">' ;
	  $temcat="";
	while($row=mysql_fetch_array($resultados)){

	 echo '<tr  bgcolor="#FFFFFF" >

		  <td width="50" align="center"><span class="Estilo12">'.$row['cta_id'].'</span></td>
          <td width="118"><span class="Estilo12">'.caracteres($row['ctabco']).'</span></td>
		   <td width="182"><span class="Estilo12">'.caracteres($row['titular']).'</span></td>
           <td width="52" align="center"><span class="Estilo12">'.$row['mone'].'</span></td>
           <td width="122"><span class="Estilo12">'.$row['banco'].'</span></td>
		  <td width="42" align="center"><a href=\'javascript:editar( "'.$row['cta_id'].'");\'><img src="../imgenes/ico_edit.gif" border="0"></a></td>
		  <td width="42" align="center"><a href=\'javascript:eliminar("'.$row['cta_id'].'");\'><img src="../imgenes/eliminar.gif" border="0"></a></td>

		</tr>';
		//$temcat=$row['des_cat'];
	  }
 //echo  "<tr><td>".$this->paginar($totalreg,$pag)."</td></tr>";
 //  echo  "<tr><td >".$this->paginacion($totalreg,$pag,$regvis)."</td></tr>";
    echo  "</table></div></td></tr></table>|<table border='0' width='100%'><tr><td >";
	//echo $totalreg."-".$pag."-".$regvis;
	 echo $this->paginar($totalreg,$pag,$regvis);
	echo "</td></tr></table>";
}

function consulta_ctasb($cod){
$strSQL4="select cta_id,titular,banco_id,moneda,ctabco,empresa from cuentas where cta_id=".$cod;
//echo $strSQL4;
  $resultado4=mysql_query($strSQL4);
  $row4=mysql_fetch_array($resultado4);
  return $row4;
 
}

function new_ctasb($id,$ndescripcion,$nbanco,$nmoneda,$ncuenta,$sucursal){

//list($idcho,$nomcho)=explode("?",$cho);
	$strSQL2= "insert into cuentas (cta_id,titular,banco_id,moneda,ctabco,empresa)values ('$id','$ndescripcion','$nbanco','$nmoneda','$ncuenta','$sucursal')";
		//echo $strSQL2;		
	mysql_query($strSQL2);
		
	echo "<script>alert('Cuenta Agregada');location.href='m_ctasb.php'</script>";
}

function act_ctasb($id,$ndescripcion,$nbanco,$nmoneda,$ncuenta,$sucursal){
/*echo "<script>if(confirm('Esta seguro que desea eliminar esta unidad?')){}</script>";*/
$strSQL="update cuentas set titular='".$ndescripcion."',banco_id='".$nbanco."',moneda='".$nmoneda."',ctabco='".$ncuenta."',empresa='".$sucursal."' where cta_id=".$id;
echo $strSQL;
mysql_query($strSQL);
	echo "<script>alert('Cuenta Actualizada');location.href='m_ctasb.php'</script>";
/*echo "<script>}</script>";*/
}

function elim_ctasb($codigo){
$strSQL=mysql_query("Select * from movbcos where cta_id=".$codigo);
    if(mysql_num_rows($strSQL)>0){
        echo "<script>alert('Esta Cuenta Tiene Movimientos no ha sido eliminada');location.href='m_ctasb.php'</script>";    
    }else{
        $strSQL="delete from cuentas where cta_id=".$codigo;
        //echo $strSQL;
        mysql_query($strSQL);
        echo "<script>alert('Esta Cuenta ha sido eliminada');location.href='m_ctasb.php'</script>";    
    }
}

function c_moneda($id){
$strSQL4="select id,simbolo from moneda";
  $resultado4=mysql_query($strSQL4);
  $elemento.="<select id='c_moneda' name='c_moneda'>";
 // $elemento.="<option value=''>Seleccionar</option>";
  while($row4=mysql_fetch_array($resultado4)){

  $elemento.="<option value='".$row4['id']."'";
    if($id==$row4['id']) {
	$elemento.=' selected="selected" ';
	}
    $elemento.=">".$row4['simbolo']."</option>";
  } 
  $elemento.="</select>";
   return $elemento;
 
}
function c_prod_concepto($id){
$strSQL4="select idproducto,nombre from producto where concepto='S'";
  $resultado4=mysql_query($strSQL4);
  $elemento.="<select id='c_concepto' name='c_concepto'>";
  $elemento.="<option value=''>Seleccionar</option>";
  while($row4=mysql_fetch_array($resultado4)){

  $elemento.="<option value='".$row4['idproducto']."'";
    if($id==$row4['idproducto']) {
	$elemento.=' selected="selected" ';
	}
    $elemento.=">".$row4['nombre']."</option>";
  } 
  $elemento.="</select>";
   return $elemento;
 
}

function crear_backup2(){

/*$usuario="root";
$passwd="1";
$bd="datablanco";
list($empresa)=mysql_fetch_array(mysql_query("select des_suc from sucursal"));
$empresa=str_replace(" ","_",$empresa );
$filename=$empresa."_".date("d-m-Y");
$executa = "D:\AppServ\MySQL\bin\mysqldump -u $usuario --password=$passwd -B $bd > $filename.sql";
system($executa, $resultado);*/
	
require('../pclzip.lib.php');
$filename="ejemplo";
$zip = new PclZip($filename.".zip");
$zip->create($filename.'.txt');
//$zip->add($filename.'.txt',PCLZIP_OPT_REMOVE_PATH, 'dev');

 header("Pragma: public"); 
 header("Expires: 0"); 
 header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
 header("Cache-Control: public"); 
 header("Content-Description: File Transfer"); 
 header("Content-type: application/octet-stream"); 
 header("Content-Disposition: attachment; filename=ejemplo.zip"); 
 header("Content-Transfer-Encoding: binary"); 
 header("Content-Length: ".filesize('ejemplo.zip')); 
 /*ob_end_flush(); 
 @readfile($filepath.$filename); 
  

header("Pragma: no-cache");
header("Expires: 0");
header("Content-Transfer-Encoding: binary");
header ("Content-Type: application / pdf"); 
header("Content-type: application/force-download");
header("Content-Disposition: attachment; filename=".$filename."_".date("h-i-sA").".zip");*/
	ob_clean();
 	readfile($filename.".zip");

 	flush(); 
	//unlink($filename.".zip");
	//unlink($filename.".sql");
	exit;

}

function crear_backup(){


$usuario=$this->mc_user;
$passwd=$this->mc_ps;
$bd=$this->mc_db;
list($empresa)=mysql_fetch_array(mysql_query("select des_suc from sucursal"));
$empresa=str_replace(" ","_",$empresa );
$filename=$empresa."_".date("d-m-Y")."_".date("h-i-sA").".sql";
$executa = "D:\AppServ\MySQL\bin\mysqldump -u $usuario --password=$passwd  -B $bd > $filename";
system($executa, $resultado);


header("Pragma: public"); 
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Cache-Control: public"); 
header("Content-Description: File Transfer"); 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$filename);
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize($filename)); 

	ob_clean();
 	readfile($filename);

 	flush(); 
	//unlink($GLOBALS['filezip']);
	unlink($filename);
	exit;

}
function restaurar_backup(){
//echo $_FILES['txtfile']['name'];
//echo "importar";
if($_FILES['txtfile']['name']!=""){



$fileName = $_FILES['txtfile']['name'];
$tmpName  = $_FILES['txtfile']['tmp_name'];
$tipo_archivo = $_FILES['txtfile']['type'];
$fileName =str_replace(" ","_",$fileName );
//$archivo="../backups/".$fileName;
$ext = substr($fileName,strrpos ( $fileName , "." )); 
if($ext==".sql"){
move_uploaded_file($tmpName,$fileName);
$usuario=$this->mc_user;
$passwd=$this->mc_ps;
$bd="datablanco_rj";

$executa = "D:\AppServ\MySQL\bin\mysql -u $usuario --password=$passwd $bd < $fileName";
system($executa, $resultado);
/*
$query=mysql_query("LOAD DATA INFILE '$archivo' INTO TABLE $tab FIELDS TERMINATED BY ',' optionally enclosed by '\"' LINES TERMINATED BY '\n' ");
//echo $query;
if($query){
unlink($archivo);
	echo "<script>alert('La operacion se realizo con exito');location.href='backup.php';</script>";
}else{
    echo "<script>alert('Error : verificar q el archivo cumpla con los requerimientos');location.href='backup.php';</script>";
}*/
    //Incluimos la libreria   
/* require('../pclzip.lib.php'); 
 //forma de llamar la clase   
// echo $archivo;
 $archive = new PclZip("ejemplo.zip");  
 //Ejecutamos la funcion extract   
 /*if ($archive->extract(PCLZIP_OPT_PATH, 'restore',PCLZIP_OPT_REMOVE_PATH, 'install/release') == 0) {    //PCLZIP_OPT_PATH, '',PCLZIP_OPT_REMOVE_PATH, 'temp_install'
  die("Error : ".$archive->errorInfo(true));  
   }*/
   
  /* if ($archive->extract(PCLZIP_OPT_PATH, 'data', 
                        PCLZIP_OPT_REMOVE_PATH, 'temp_install') == 0) { 
    die("Error : ".$archive->errorInfo(true)); 
  }  */
}else{
echo "Solo se permiten archivo  *.zip";
}
}
}
function mostrar_tablas(){
$sql="show tables";
$query=mysql_query($sql);
echo  "<select id='cbotabla' name='cbotabla' disabled=disabled'>";
echo "<option value=''>Seleccionar</option>";
while($data=mysql_fetch_array($query)){
echo "<option value='$data[0]'>$data[0]</option>";
}
echo "</select>";
}
function restaurar_backup_tab($tab){
if(!is_dir("../backups")) mkdir("../backups");
$fileName = $_FILES['txtfiletab']['name'];
$tmpName  = $_FILES['txtfiletab']['tmp_name'];
$tipo_archivo = $_FILES['txtfiletab']['type'];
$fileName =str_replace(" ","_",$fileName );

$ruta=str_replace('\\',"/",dirname(dirname(__FILE__)));
$archivo=$ruta."/backups/".$fileName;
$ext = substr($fileName,strrpos ( $fileName , "." ));
if($ext==".csv" && $tab!=""){
//echo $fileName = $_FILES['txtfiletab']['name'];
move_uploaded_file($tmpName,$archivo);
//echo "LOAD DATA INFILE '$archivo' INTO TABLE $tab FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\n' ";
$query=mysql_query("LOAD DATA INFILE '$archivo' INTO TABLE $tab FIELDS TERMINATED BY ',' optionally enclosed by '\"' LINES TERMINATED BY '\n' ");
//echo $query;
if($query){
unlink($archivo);
	echo "<script>alert('La operacion se realizo con exito');location.href='backup.php';</script>";
}else{
    echo "<script>alert('Error : verificar q el archivo cumpla con los requerimientos');location.href='backup.php';</script>";
}
}else{
echo "<script>alert('solo se permiten archivos *.csv');location.href='backup.php';</script>";
}
}
function paginar($total_registros,$pagina,$registros,$ventana=NULL){
//echo  $total_registros;
	    //PAGINACION 1	
		 //$registros =3; 
		// $pagina = $_REQUEST['pagina']; 
		// echo $pagina;

		if ($pagina=='') { 
		$inicio = 0; 
	//	$pagina = 1; 
		} 
		else { 
		$inicio = ($pagina - 1) * $registros; 
		} 

		$total_paginas = ceil($total_registros / $registros);   
		$del=$inicio+1;
		if($total_registros>=($pagina*$registros)){
	
		$al=$pagina*$registros;
		}else{
	$al=$total_registros;
		}
//  
	if($ventana!=NULL){
		$funcion_evento="cargar_datos2";
		}else{
		$funcion_evento="cargar_datos";	
		}

echo '<table  border="0" cellpadding="0" cellspacing="0"  width="100%" >
<tr>
<td  height="30"  >Viendo del '.$del.' al '. $al .'(de '.$total_registros.' registros).</td><td  align="right" >';			  
 if(($pagina - 1) > 0) { 
echo "<a style='cursor:pointer' onclick='$funcion_evento($pagina-1)'>< Anterior </a> "; 
} 

for ($i=1; $i<=$total_paginas; $i++){ 
//$inicio = ($i - 1) * $registros; 
	if ($pagina == $i) { 
	echo "<b style='color:#000000'>".$pagina."</b> "; 
	} else { 
	echo "<a style='cursor:pointer' href='#' onclick='$funcion_evento($i);'>$i</a> "; 
	}
}
if(($pagina + 1)<=$total_paginas) { 
echo " <a style='cursor:pointer' onclick='$funcion_evento($pagina+1)'>Siguiente ></a>"; 
} 
 echo "&nbsp;&nbsp;</td>
  </tr>
</table>";
}


function paginacion($total_reg,$pag_act,$registros){
//echo $pag_act;
$destino;$pag_vis=5;
//$registros=3;
$colorbtn="#0073AA";
$colorpag="#CCCCCC";
//$total_pag=intval($total_reg/30);

//if(($total_reg%30)>0){
//$total_pag++;
//}
$total_pag = ceil($total_reg / $registros);
$ult_pag=$total_pag;   
//if($destino=="pag_ofertas"){$destino="javascript:car_cont('ofertas.php?ps=~','contenido')";}
//if($destino=="c_buscar"){$destino="javascript:c_buscar(~)";}
//if($destino=="c_buscaremp"){$destino="javascript:c_buscaremp(~)";}
if($pag_act>1) {$pag_prev=$pag_act-1;}else{$pag_prev=$pag_act;}
if($total_pag>1){

//$pag_act=$num_reg/30;
//$valini=$pag_act-2;
//$valfinal=$pag_act+2;
if($total_pag>6){
$valini=$pag_act-2;
}else{
$valini=1;
}

if($total_pag>=5 ){
echo "pag_act".$pag_act."-";
if($pag_act>=5){
if(($pag_act+2)<$total_pag){
$valfinal=$pag_act+2;
}else{
$valfinal=$total_pag-1;
}
}else{
$valfinal=5;
}
//$valfinal=5;
}else{
$valfinal=$total_pag;
}

if($valini<=1){
//$valfinal=$valfinal+abs($valini);
$valini=2;
}elseif($valini>($total_pag-5)){
$valini=$total_pag-4;
}
//if($valfinal<=$total_pag){
//$valfinal=$valini+4;
//}
/*if($valfinal>=$total_pag){
$valfinal=$total_pag-1;
}else{
$valfinal=$valini+3;
}*/
//echo  $total_pag."-".$valini."-".$valfinal;
//}
//$valini=$total_pag-5;


//}


//$y=$valini*30;
//echo $valini."-".$valfinal;
//if($ult_pag<$pag_act+3) {

	if ($pag_act=='') { 
		$inicio = 0; 
	//	$pagina = 1; 
		} 
		else { 
		$inicio = ($pag_act - 1) * $registros; 
		} 

$del=$inicio+1;
		if($total_reg>=($pag_act*$registros)){
	
		$al=$pag_act*$registros;
		}else{
	$al=$total_reg;
		}
echo "<table width='100%'  style='margin:10px; border:0px solid;position:relative'><tr><td><label style='position:relative;left:0px;font-weight:bold;border:0px solid;'>Viendo del ".$del." al ". $al ."(de ".$total_reg." registros).</label><div style='position:absolute;right:0px;display:inline;border:0px solid;'><a class='paginacion' style='background:$colorbtn;color:#FFFFFF;font-weight:bold;padding:2px 10px;' href='javascript:cargar_datos($pag_prev);' >Prev</a>";//".str_replace("~",$num_reg_prev,$destino)."
//if(($pag_act-3)>1) {
if($valini>2) {

echo "<a class='paginacion' style='font-weight:bold;padding:2px 4px' href='javascript:cargar_datos(1);' ><font color='#000000'>1</font></a><label>...</label>";
}else{
if($pag_act==1){

$style="style='background:$colorpag;font-weight:bold;padding:2px 4px'";
}else{
$style="style='font-weight:bold;padding:2px 4px'";
}


echo "<a class='paginacion' $style href='javascript:cargar_datos(1);' ><font color='#000000'>1</font></a>";}

if($total_pag<=$pag_vis){
$pag_vis=$total_pag;
}

//for($z=1;$z<=$pag_vis;$z++){
for($a=$valini;$a<=$valfinal;$a++){
//$a=$valini++;

if($pag_act==$a){

$style="style='background:$colorpag;font-weight:bold;padding:2px 4px'";
}else{
$style="style='font-weight:bold;padding:2px 4px'";
}
//if($a<$total_pag){$x=$a+1;}



echo "<a class='paginacion' $style href='javascript:cargar_datos($a);' ><font color='#000000'>".$a."</font></a>";
//$y+=30;
}

//if($ult_pag>$pag_vis && $a<$total_pag) {
if($ult_pag>6){
//if($pag_act>=5 && $valfinal) {
if($valini>=($total_pag-5)) {
echo "val";
echo "<label>...</label><a class='paginacion' style='font-weight:bold;padding:2px 4px'  href='javascript:cargar_datos($total_pag);' ><font color='#000000'>".$total_pag."</font></a>";


}else{
if($pag_act==$ult_pag ){

$style="style='background:$colorpag;font-weight:bold;padding:2px 4px'";
}else{
$style="style='font-weight:bold;padding:2px 4px'";
}

echo "<a class='paginacion' $style href='javascript:cargar_datos($total_pag);' ><font color='#000000'>".$total_pag."</font></a>";
}
}

if($pag_act<$ult_pag) {
$pag_next=$pag_act+1;


}else{
$pag_next=$pag_act;
}
echo "<a class='paginacion' style='background:$colorbtn;color:#FFFFFF;font-weight:bold;padding:2px 10px;' href='javascript:cargar_datos($pag_next);' >Next</a>";
echo "</div></td></tr></table>";
}
}


}

?>