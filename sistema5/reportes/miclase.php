
<?php
class miclase{
function miclase($param){
	if($param==''){
	include('../conex_inicial.php');
	}
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
<tr bordercolor="#CCCCCC">

      <td width="50" align="center" bgcolor="#0073AA"><span class="Estilo15">N.</span></td>
      <td width="170" bgcolor="#0073AA"><span class="Estilo15">Nombre</span></td>
      <td width="90" bgcolor="#0073AA"><span class="Estilo15">DNI</span></td>
      <td width="138" bgcolor="#0073AA"><span class="Estilo15">Licencia</span></td>
      <td width="150"  bgcolor="#0073AA"><span class="Estilo15">Fecha</span></td>
	  <td width="150" bgcolor="#0073AA"><span class="Estilo15">Direccion</span></td>
	  <td width="100" bgcolor="#0073AA"><span class="Estilo15">Telefono</span></td>
	  <td  width="100" bgcolor="#0073AA"><span class="Estilo15">Acciones</span></td>

    </tr></table><div style="position:relative;height:270px;overflow:auto"><table border="0">';
	while($row=mysql_fetch_array($resultados)){
	 echo '<tr  bgcolor="#EEEEEE" onMouseOver="entrada(this)" onMouseOut="salida(this)">

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
<tr bordercolor="#CCCCCC">

      <td width="50" align="center" bgcolor="#0073AA"><span class="Estilo15">N.</span></td>
      <td  width="180" bgcolor="#0073AA"><span class="Estilo15">Nombre</span></td>
      <td width="170" bgcolor="#0073AA"><span class="Estilo15">Direccion</span></td>
      <td width="100" bgcolor="#0073AA"><span class="Estilo15">Ruc</span></td>
      <td  width="100" bgcolor="#0073AA"><span class="Estilo15">Telefono</span></td>

	  <td  width="100"  bgcolor="#0073AA"><span class="Estilo15">Licencia</span></td>
	  <td  width="100"   colspan="2" bgcolor="#0073AA"><span class="Estilo15">Acciones</span></td>
    </tr></table><div style="position:relative;height:270px;overflow:auto"><table border="0" >' ;
	while($row=mysql_fetch_array($resultados)){
	//<td width="10"><span class="Estilo12">'.$row['web'].'</span></td>
	 echo '<tr  bgcolor="#EEEEEE" onMouseOver="entrada(this)" onMouseOut="salida(this)">

		  <td width="50" align="center"><span class="Estilo12">'.$row['id'].'</span></td>
		  <td width="180"><span class="Estilo12">'.$row['nombre'].'</span></td>
		  <td  width="180"><span class="Estilo12">'.$row['direccion'].'</span></td>
		  <td width="100"><span class="Estilo12">'.$row['ruc'].'</span></td>
		  <td width="100"><span class="Estilo12">'.$row['telefono'].'</span></td>
		  
		  <td width="100"> <span class="Estilo12">'.$row['lic_mtc'].'</span></td>
		  <td width="30" align="center"><a href=\'javascript:editar( "'.$row['id'].'");\'><img src="../imgenes/ico_edit.gif" border="0"></a></td>
		  <td width="30" align="center"><a href=\'javascript:eliminar("'.$row['id'].'");\'><img src="../imgenes/eliminar.gif" border="0"></a></td>
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
  $sql="select factorot.*,producto.nombre,categoria.des_cat from factorot inner join producto on factorot.item=producto.idproducto inner join categoria on producto.categoria=categoria.idCategoria $where  order by des_cat,id asc";
	$totalreg=mysql_num_rows(mysql_query($sql));
  $resultados = mysql_query($sql." limit ".$inicio.",".$regvis);
			 // echo "resultado".$resultado;
	echo '<table border="0">

<tr bordercolor="#CCCCCC">

      <td rowspan="2" width="50" align="center" bgcolor="#0073AA" align="center"><span class="Estilo15">N.</span></td>
      <td rowspan="2"  width="180" bgcolor="#0073AA" align="center"><span class="Estilo15">Item</span></td>
      <td rowspan="2" width="170" bgcolor="#0073AA" align="center"><span class="Estilo15">Nombre</span></td>
	  <td  colspan="2" bgcolor="#0073AA" align="center" ><span class="Estilo15">Rango M2</span></td>
    

	  <td  rowspan="2" width="100"  bgcolor="#0073AA" align="center"><span class="Estilo15">Factor</span></td>
	  <td  rowspan="2"width="100"   colspan="2" bgcolor="#0073AA" align="center"><span class="Estilo15">Acciones</span></td>
    </tr><tr>  <td  width="100" bgcolor="#0073AA" align="center"><span class="Estilo15">Inicial</span></td>
      <td  width="100" bgcolor="#0073AA" align="center"><span class="Estilo15">Final</span></td></tr></table><div style="position:relative;height:270px;overflow:auto"><table border="0" >' ;
	  $temcat="";
	while($row=mysql_fetch_array($resultados)){
	if($row['des_cat']!=$temcat){
 		echo '<tr  bgcolor="#EEEEEE"><td colspan="8"><b>'.$row['des_cat'].'</b<</td></tr>';
		}
	 echo '<tr  bgcolor="#EEEEEE" onMouseOver="entrada(this)" onMouseOut="salida(this)">

		  <td width="50" align="center"><span class="Estilo12">'.$row['id'].'</span></td>
		  <td width="153"><span class="Estilo12">'.$row['item'].'</span></td>
		  <td  width="153"><span class="Estilo12">'.$row['nombre'].'</span></td>
		  <td width="90"><span class="Estilo12">'.$row['m2_ini'].'</span></td>
		  <td width="90"><span class="Estilo12">'.$row['m2_fin'].'</span></td>
		  
		  <td width="90"> <span class="Estilo12">'.$row['factor'].'</span></td>
		  <td width="45" align="center"><a href=\'javascript:editar( "'.$row['id'].'");\'><img src="../imgenes/ico_edit.gif" border="0"></a></td>
		  <td width="45" align="center"><a href=\'javascript:eliminar("'.$row['id'].'");\'><img src="../imgenes/eliminar.gif" border="0"></a></td>
		</tr>';
		$temcat=$row['des_cat'];
	  }
 //echo  "<tr><td>".$this->paginar($totalreg,$pag)."</td></tr>";
 //  echo  "<tr><td >".$this->paginacion($totalreg,$pag,$regvis)."</td></tr>";
    echo  "</table></div>|<table border='0' width='100%'><tr><td >";
	//echo $totalreg."-".$pag."-".$regvis;
	 echo $this->paginar($totalreg,$pag,$regvis);
	echo "</td></tr></table>";
}

function consulta_factor($cod){
$strSQL4="select factorot.*,producto.nombre from factorot inner join producto on factorot.item=producto.idproducto  where id='$cod'";
  $resultado4=mysql_query($strSQL4);
  $row4=mysql_fetch_array($resultado4);
  return $row4;
 
}
function new_factor($idprod,$m2ini,$m2fin,$numfac){

//list($idcho,$nomcho)=explode("?",$cho);
	$strSQL2= "insert into factorot (item,m2_ini,m2_fin,factor) values ($idprod,$m2ini,$m2fin,$numfac)";
	//	echo $strSQL2;		
	mysql_query($strSQL2);
		$strSQL3= "update producto set factorOT='S' where idproducto=".$idprod;
		mysql_query($strSQL3);
			//unset($accion);
	//header("location: chofer.php");
	echo "<script>alert('Factor Agregado');location.href='mantFactorOT.php'</script>";
}

function act_factor($idfac,$idprod,$m2ini,$m2fin,$numfac){

$strSQL="update factorot set item=".$idprod.",m2_ini=".$m2ini.",m2_fin=".$m2fin.",factor=".$numfac." where id=".$idfac;

mysql_query($strSQL);
	echo "<script>alert('Factor Actualizado')</script>";
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

<tr bordercolor="#CCCCCC">

      <td  width="50" align="center" bgcolor="#0073AA" align="center"><span class="Estilo15">N.</span></td>
      <td   width="200" bgcolor="#0073AA" align="center"><span class="Estilo15">Nombre</span></td>
      <td  width="100" bgcolor="#0073AA" align="center"><span class="Estilo15">C. Sunat</span></td>
	  <td  width="100"    bgcolor="#0073AA" align="center"><span class="Estilo15">Acciones</span></td>
    </tr><tr><td colspan="5"><div style="position:relative;width:500px;height:310px;overflow:auto;border:0px solid;padding:0px;margin:0px;"><table border="0" align="left">' ;
	  $temcat="";
	while($row=mysql_fetch_array($resultados)){
	//if($row['des_cat']!=$temcat){
 		//echo '<tr  bgcolor="#EEEEEE"><td colspan="8"><b>'.$row['des_cat'].'</b<</td></tr>';
	//	}
	 echo '<tr  bgcolor="#EEEEEE" onMouseOver="entrada(this)" onMouseOut="salida(this)">

		  <td width="50" align="center"><span class="Estilo12">'.$row['codigo'].'</span></td>
		  <td width="200"><span class="Estilo12">'.$row['nombre'].'</span></td>
		  <td  width="110"><span class="Estilo12">'.$row['codsunat'].'</span></td>
		  <td width="100" align="center" ><a href=\'javascript:editar( "'.$row['codigo'].'");\'><img src="../imgenes/ico_edit.gif" border="0"></a></td>
		  
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
	echo "<script>alert('Condicion Actualizada')</script>";
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

<tr bordercolor="#CCCCCC">

      <td  width="50" align="center" bgcolor="#0073AA" align="center"><span class="Estilo15">N.</span></td>
      <td   width="70" bgcolor="#0073AA" align="center"><span class="Estilo15">Simbolo</span></td>
      <td  width="250" bgcolor="#0073AA" align="center"><span class="Estilo15">Nombre</span></td>
	  <td  width="100"   colspan="2" bgcolor="#0073AA" align="center"><span class="Estilo15">Acciones</span></td>
    </tr><tr><td colspan="5"><div style="position:relative;width:550px;height:310px;overflow:auto;border:0px solid;padding:0px;margin:0px;"><table border="0" align="left">' ;
	  $temcat="";
	while($row=mysql_fetch_array($resultados)){
	//if($row['des_cat']!=$temcat){
 		//echo '<tr  bgcolor="#EEEEEE"><td colspan="8"><b>'.$row['des_cat'].'</b<</td></tr>';
	//	}
	 echo '<tr  bgcolor="#EEEEEE" onMouseOver="entrada(this)" onMouseOut="salida(this)">

		  <td width="50" align="center"><span class="Estilo12">'.$row['id'].'</span></td>
		  <td width="110"><span class="Estilo12">'.$row['nombre'].'</span></td>
		  <td  width="280"><span class="Estilo12">'.$row['descripcion'].'</span></td>
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

function new_medidas($idunit,$simbolo,$nombre){

//list($idcho,$nomcho)=explode("?",$cho);
	$strSQL2= "insert into unidades values ($idunit,'$simbolo','$nombre')";
	//	echo $strSQL2;		
	mysql_query($strSQL2);
		
	echo "<script>alert('Unidad Agregada');location.href='m_unitmedida.php'</script>";
}

function act_medidas($idunit,$simbolo,$nombre){
/*echo "<script>if(confirm('Esta seguro que desea eliminar esta unidad?')){}</script>";*/
$strSQL="update unidades set nombre='".$simbolo."',descripcion='".$nombre."' where id=".$idunit;

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

function paginar($total_registros,$pagina,$registros){
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
echo '<table  border="0" cellpadding="0" cellspacing="0" style=" font-size:10px;font-weight:bold" width="100%"><tr><td  height="30" style=" font-size:10px;font-weight:bold" >Viendo del '.$del.' al '. $al .'(de '.$total_registros.' registros).</td><td  align="right" >';			  
 if(($pagina - 1) > 0) { 
echo "<a style='cursor:pointer' onclick='cargar_datos($pagina-1)'>< Anterior </a> "; 
} 

for ($i=1; $i<=$total_paginas; $i++){ 
//$inicio = ($i - 1) * $registros; 
	if ($pagina == $i) { 
	echo "<b style='color:#000000'>".$pagina."</b> "; 
	} else { 
	echo "<a style='cursor:pointer' href='#' onclick='cargar_datos($i);'>$i</a> "; 
	}
}
if(($pagina + 1)<=$total_paginas) { 
echo " <a style='cursor:pointer' onclick='cargar_datos($pagina+1)'>Siguiente ></a>"; 
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
//echo "pag_act".$pag_act."-";
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
echo "<table width='100%'  style='margin:10px; border:0px solid;position:relative; font-size:12px'><tr><td><label style='position:relative;left:0px;font-weight:bold;border:0px solid;'>Viendo del ".$del." al ". $al ."(de ".$total_reg." registros).</label><div style='position:absolute;right:0px;display:inline;border:0px solid;'><a class='paginacion' style='background:$colorbtn;color:#FFFFFF;font-weight:bold;padding:2px 10px;' href='javascript:cargar_datos($pag_prev);' >Prev</a>";//".str_replace("~",$num_reg_prev,$destino)."
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