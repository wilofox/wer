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

function cod_autogenerado($campo,$tabla){
	$resultado3=mysql_query("select max($campo) as codigo from $tabla");
	$row3=mysql_fetch_array($resultado3);
			
	$codigo=$row3['codigo'];
	$codigo=$codigo+1;
	return $codigo;
			
}
function new_hiscontometro($codigo,$fecha,$c_usuario,$pc,$c_manguera,$turno,$factor,$contoini,$contometro){
//list($idcho,$nomcho)=explode("?",$cho);
	$strSQL2= "insert into hist_contometro 
	(id,cod_manguera,fecha_his ,turno,cod_vendedor ,pc,factor,cont_ini,cont_fin)values 
	($codigo,'$c_manguera','$fecha','$turno','$c_usuario','$pc','$factor','$contoini','$contometro')";
	mysql_query($strSQL2);
	echo "<script>location.href='hist_contometro.php'</script>";
}
function act_hiscontometro($codigo,$fecha,$c_manguera,$turno,$factor,$contometro){

$strSQL="update hist_contometro set cod_manguera='".$c_manguera."',turno='".$turno."',factor='".$factor."',cont_fin='".$contometro."'  where id='".$codigo."'";
mysql_query($strSQL);
echo "<script>location.href='hist_contometro.php'</script>";
}
function elim_hiscontometro($codigo){
$strSQL="delete from hist_contometro where id=".$codigo;
mysql_query($strSQL);
echo "<script>location.href='hist_contometro.php'</script>";
}

function new_hisvarillaje($codigo,$fecha,$c_usuario,$pc,$c_tanque,$contometro,$R,$L,$G){
//list($idcho,$nomcho)=explode("?",$cho);
	$strSQL2= "insert into hist_varillaje 
	(id,cod_tanque,fecha_his,cod_vendedor,pc,cantidad,r,l,g)values 
	($codigo,'$c_tanque','$fecha','$c_usuario','$pc','$contometro','".$R."','".$L."','".$G."')";
	mysql_query($strSQL2);
	echo "<script>location.href='hist_varillaje.php'</script>";
}
function act_hisvarillaje($codigo,$fecha,$c_tanque,$contometro,$R,$L,$G){

  	$strSQL="update hist_varillaje set cod_tanque='".$c_tanque."',cantidad='".$contometro."',r='".$R."',l='".$L."',g='".$G."'

where id='".$codigo."'";
mysql_query($strSQL);
echo "<script>location.href='hist_varillaje.php'</script>";
}
function elim_hisvarillaje($codigo){
$strSQL="delete from hist_varillaje where id=".$codigo;
mysql_query($strSQL);
echo "<script>location.href='hist_varillaje.php'</script>";
}


function listar_histcontometro($condicion,$texto,$fec1,$fec2,$tipo2,$texto2,$pag){
	$where="";
	$regvis=20;

	if($pag>=1) {
	$inicio=($pag-1)*$regvis;
	}else{
	$inicio=0;
	$pag=1;
	}
	//echo $tipo2.'//'.$texto2;
	if($condicion!=""){
	$where =" where $condicion like '%$texto%'";
	$where.=" and substring(fecha_his,1,10) between '".formatofecha($fec1)."'  and '".formatofecha($fec2)."' ";
		if ($texto2!=""){
			if ($tipo2=='sucursal'){
			$where.=" and $tipo2 in (select cod_suc from $tipo2 where des_suc like '%$texto2%' )";
			}else{
			$where.=" and $tipo2 in (select cod_tienda from $tipo2 where des_tienda like '%$texto2%' )";
			}
		}
	}

   $sql="select HC.id,nom_mang,fecha_his,usuario,turno,HC.pc,HC.factor,cont_ini,cont_fin from hist_contometro HC
   inner join manguera M on HC.cod_manguera=M.id
   inner join usuarios U on HC.cod_vendedor=U.codigo   
   $where  order by HC.fecha_his desc";
   
 //echo $sql;
	$totalreg=mysql_num_rows(mysql_query($sql));
  $resultados = mysql_query($sql." limit ".$inicio.",".$regvis);
			 // echo "resultado".$resultado;
	echo '<table border="0" align="center">

<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">

      <td  width="35" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">N&deg;</td>
      <td   width="110"  align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1" >Fecha - Hora</td>
	  <td   width="80"  align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1" >Manguera</td>
	  <td   width="70" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Responsable</td>
	  <td   width="40" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Turno</td>
	  <td   width="90" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">PC</td>
	  <td   width="70" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Mar.Contometro </td>
	  <td  width="50" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Acciones</td>
    </tr><tr><td colspan="8"><div style="position:relative;height:250px;overflow:auto;border:0px solid;padding:0px;margin:0px;"><table border="0" align="left">' ;
	  $temcat="";
	while($row=mysql_fetch_array($resultados)){

	 echo '<tr bgcolor="#FFFFFF">

		  <td width="35" align="center"><span class="Estilo12">'.$row['id'].'</span></td>
		  <td width="125"><span class="Estilo12">'.formatofecha(substr($row['fecha_his'],0,10)).' '.substr($row['fecha_his'],11,20).'</span></td>
		  <td width="100"><span class="Estilo12">'.$row['nom_mang'].'</span></td>		   
		   <td width="80"><span class="Estilo12">'.$row['usuario'].'</span></td>
		   <td width="50"><span class="Estilo12">Turno'.$row['turno'].'</span></td>
		   <td width="80"><span class="Estilo12">'.$row['pc'].'</span></td>
		   <td width="80" align="right"><span class="Estilo12">'.$row['cont_fin'].'</span></td>
		  <td width="25" align="center"><a href=\'javascript:editar( "'.$row['id'].'");\'><img src="../imgenes/ico_edit.gif" border="0"></a></td>
		  <td width="25" align="center"><a href=\'javascript:eliminar("'.$row['id'].'");\'><img src="../imgenes/eliminar.gif" border="0"></a></td>

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
function listar_informeContTanq($condicion,$texto,$fec1,$fec2,$pag){
	$where="";
	$regvis=2;

	if($pag>=1) {
	$inicio=($pag-1)*$regvis;
	}else{
	$inicio=0;
	$pag=1;
	}
	if($condicion!=""){
	$where =" where $condicion like '%$texto%'";
		if ($condicion =="des_tienda"){
		$whereX =" and $condicion like '%$texto%' ";
		}
	$where2=" and substring(fecha_his,1,10) between '".formatofecha($fec1)."'  and '".formatofecha($fec2)."' ";
	}
		
	$sql="SELECT * FROM isla I
INNER JOIN sucursal SU ON I.sucursal = SU.cod_suc
INNER JOIN tienda T ON I.tienda = T.cod_tienda
$where 
GROUP BY SU.cod_suc	";
	// order by des_tienda
	$ITE=0;
	$totalreg=mysql_num_rows(mysql_query($sql));
  	$resultados = mysql_query($sql." limit ".$inicio.",".$regvis);
   while($row=mysql_fetch_array($resultados)){
   	//echo '<br><div style="padding-left:40px; font-size:13px"><b>'.strtoupper($row['nom_surt']).' - EMPRESA:('.$row['des_suc'].')</b></div>';
	echo '<br><div style="padding-left:40px; font-size:13px"><b>>> EMPRESA: '.$row['des_suc'].' </b></div>';
//rem local -----------------------------------------
	$sqlL="select * from tienda  T
	inner join isla I on T.cod_tienda=I.tienda 	
	where cod_suc ='".$row['cod_suc']."' 
	$whereX
	group by  	cod_tienda	order by des_tienda";
	$ITL=0;
  	$resultadosL = mysql_query($sqlL);
   while($rowL=mysql_fetch_array($resultadosL)){
	echo '<div style="padding-left:40px; font-size:13px"><u><b> '.$rowL['des_tienda'].' </b></u></div>';

	
 	echo '<br>';

echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">';  
	/////--------------------------------------------------------------------------
  
   $sql2="select * from hist_contometro H
inner join manguera M on H.cod_manguera=M.id
inner join surtidor S on M.cod_surtidor=S.id
inner join tanques T on M.cod_tanques=T.id  
inner join isla I on S.cod_isla = I.id  
where I.tienda='".$rowL['cod_tienda']."' 
$where2
GROUP BY cod_manguera
  ";  

    // $where2
    $resultados2 = mysql_query($sql2);
	echo '<table border="0" >
<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
  <td align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">&nbsp;</td>
  <td colspan="7" class="EstiloTexto1" style=" border:#CCCCCC solid 1px" > HISTORIAL DE CONT&Oacute;METRO  </td>
  </tr>
    
<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
  <td  width="20" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">N&deg;</td>
  <td   width="120"  align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1" >Manguera</td>
  <td   width="80"  align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1" >Surtidor</td>
  <td   width="80"  align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1" >Precio</td>
  <td   width="80"  align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1" >Cont.Inicial</td>
  <td   width="80" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Cont.Final</td>
  <td   width="80" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Cantidad</td>
  <td   width="80" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Importe</td>	
	  
    </tr><tr><td colspan="8">
	<!--<div style="position:relative;height:250px;overflow:auto;border:0px solid;padding:0px;margin:0px;">-->
	
	<table border="0">' ;
	  $i=0;
	  $CT=0;
	  $IT=0;
	while($row2=mysql_fetch_array($resultados2)){
	$i++;
	 echo '<tr bgcolor="#FFFFFF">

		   <td width="20" align="center"><span class="Estilo12">'.$i.'</span></td>
		   <td width="120"><span class="Estilo12">'.$row2['nom_mang'].'</span></td>
		   <td width="80"><span class="Estilo12">'.$row2['nom_surt'].'</span></td>';
		 
		  $strSQL1="select * from producto  
		  where idproducto='".$row2['cod_prod']."' ";
		  $resultado4=mysql_query($strSQL1);
 		  $row2X=mysql_fetch_array($resultado4);		  
		  $precP=$row2X['precio'];
		   echo '<td width="80" align="right"><span class="Estilo12">'.number_format($row2X['precio'],3).'</span></td>';
		 
		  $strSQL1="select * from hist_contometro  
		  where cod_manguera='".$row2[9]."' and turno='1'  order by fecha_his desc ";
		  $resultado4=mysql_query($strSQL1);
 		  $row2X=mysql_fetch_array($resultado4);		  
		  $contoI=$row2X['cont_ini'];
		   if ($row2X['factor']>0) { $fator1=$row2X['factor'];}else{ $fator1='1';}
		   echo '<td width="80" align="right"><span class="Estilo12">'.$row2X['cont_ini'].'</span></td>';
		 
		  $strSQL1="select * from hist_contometro  
		  where cod_manguera='".$row2[9]."' and turno='2'  order by fecha_his desc";
		  $resultado4=mysql_query($strSQL1);
 		  $row2X=mysql_fetch_array($resultado4);		  
		  $contoF=$row2X['cont_fin'];
		  //-- vercion 1
		  /*if ($row2X['factor']>0) { $fator2=$row2X['factor'];}else{ $fator2='1';}
		  if ($fator2==$fator1){
		 	 $Cant=($contoF-$contoI)/$fator2 ;
		 	 $Impor=$precP*$Cant;
		  }else{
		    $Cant='<div style="color:#FF0000" title="Verifique factor de ambos turnos">0.00</div>';
			$Impor='<div style="color:#FF0000" title="Verifique factor de ambos turnos">0.00</div>';
		  }
		  $CT+=number_format($Cant, 2, '.', '');//$Cant;
		  $IT+=number_format($Impor, 2, '.', '');//$Impor;
		  
		  */	
		  //---------------------------------------
		  //-- vercion 2
		  if ($row2X['cont_fin']==''){
			$contoF=$row2['cont_fin'];
			$contoI=0;
			$fator2=$row2['6'];
			//echo $contoF.'//'.$contoI.'//'.$fator2 ;
			$Cant=($contoF-$contoI)/$fator2 ;
		    $Impor=$precP*$Cant;	  
		  
		  $CT+=number_format($Cant, 2, '.', '');//$Cant;
		  $IT+=number_format($Impor, 2, '.', '');//$Impor;
		  
		  }else{			
			$contoF=$row2X['cont_fin'];
			$fator2=$row2X['factor'];
			//echo $contoF.'//'.$contoI.'//'.$fator2 ;
			$Cant=($contoF-$contoI)/$fator2 ;
		 	$Impor=$precP*$Cant;	  
		  
		  $CT+=number_format($Cant, 2, '.', '');//$Cant;
		  $IT+=number_format($Impor, 2, '.', '');//$Impor;
		  
		  }
		  //---------------------------------------		  
		  
		  
		 // 	$contoF=$row2X['cont_fin'];  // -->   $cont_fin
		   echo '
		   <td width="80" align="right"><span class="Estilo12">'.$contoF.'</span></td>
		   <td width="80" align="right"><span class="Estilo12">'.number_format($Cant,2).'</span></td>
		   <td width="80" align="right"><span class="Estilo12">'.number_format($Impor,2).'</span></td>

		</tr>';
		$ITL+=number_format($Impor, 2, '.', '');//$Impor;	
		
	  }	
	  
	echo  "</table>";
	//Totales manguera
	echo '<table border="0" align="right">
    <tr >
      <td width="20">&nbsp;</td>
      <td width="120">&nbsp;</td>
      <td width="80">&nbsp;</td>      
      <td width="80">&nbsp;</td>  
	  <td width="80" style="color:#000000"><b>TOTAL :</b></td>      
      <td width="80" style="color:#000000" align="right">'.$CT.'</td>
      <td width="80" style="color:#000000" align="right">'.$IT.'</td>
    </tr>
</table>
';
	
	echo  "<!--</div>--></td></tr></table>";
	
///-------------------------------
echo '</td>
    <td valign="top">';
///-------------------------------	  varillaje
  
/*select HC.id,nom_tanq,max(fecha_his) as fecha_his,max(cantidad) as cantidad
,max(capacidad) as capacidad
   from hist_varillaje HC
   inner join tanques T on HC.cod_tanque=T.id 
   inner join usuarios U on HC.cod_vendedor=U.codigo   
   where cod_tanque in (select cod_tanques from surtidor S
inner join manguera M on S.id=M.cod_surtidor
where S.id='".$row['id']."' GROUP by cod_tanques,cod_surtidor )
 $where2  group by nom_tanq*/
 //echo $rowL['cod_tienda'];
   $sql2="
select  HC.id,cod_tanque,nom_tanq,max(fecha_his) as fecha_his,max(cantidad) as cantidad
,max(capacidad) as capacidad,capacidad,l from hist_varillaje HC inner join tanques T on HC.cod_tanque=T.id 
 where  cod_tanque in (
 
select cod_tanques from manguera M 
inner join surtidor S on M.cod_surtidor=S.id
inner join isla I on S.cod_isla=I.id
where tienda='".$rowL['cod_tienda']."' group by cod_tanques
 
 ) $where2
group by cod_tanque
 
   ";  
   // 
   //order by HC.fecha_his desc
    
    $resultados2 = mysql_query($sql2);
	echo '<table border="0" >
<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
  <td align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">&nbsp;</td>
  <td colspan="7" class="EstiloTexto1" style=" border:#CCCCCC solid 1px" > HISTORIAL DE VARILLAJE  </td>
  </tr>
    
<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">
  <td  width="30" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">N&deg;</td>
  <td   width="75"  align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1" >Fecha</td>
  <td   width="80"  align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1" >Tanque</td>  
  <td   width="70" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Varillaje(H)</td>	
  <td   width="70" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Vol. Disponible </td>
  <td   width="70" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Nivel</td>
    </tr><tr><td colspan="6">
	<!--<div style="position:relative;height:250px;overflow:auto;border:0px solid;padding:0px;margin:0px;">-->
	
	<table border="0">' ;
	  $i=0;
	while($row2=mysql_fetch_array($resultados2)){
	$i++;
	if ($row2['l']!='GLP'){
		$color="#FFFFFF";
	}else{
		$color="#CEF3FF";
	}
	 echo '<tr bgcolor="'.$color.'">

		   <td width="35" align="center"><span class="Estilo12">'.$row2['cantidad'].''.$i.'</span></td>
		   <td width="75"><span class="Estilo12">'.formatofecha(substr($row2['fecha_his'],0,10)).'</span></td>
		   <td width="80"><span class="Estilo12">'.$row2['nom_tanq'].'</span></td>';		 
		 
		  $strSQL1="select * from hist_varillaje  where id='".$row2['id']."'  ";
		  $resultado4=mysql_query($strSQL1);
 		  $row2X=mysql_fetch_array($resultado4); 		
			if ($row2X['l']!='GLP')	{
			  $R=$row2X['r'];//$rowX['radio'];//114.59155902617;
			  $H=$row2['cantidad'];//1;
			  $L=$row2X['l'];//$rowX['largo'];//120;
			  $G=$row2X['g'];//3.78541;
			$Formula=((((2*pi()*($R*$R)*(rad2deg(acos(($R-$H)/$R))))/360)-((sqrt(($R*$R)-(($R-$H)*($R-$H))))*($R-$H)))*$L)/($G*1000);	
				$varillaje=$row2['cantidad'];
				$capGalon=(number_format($Formula,2)*100)/$row2['capacidad'];
			}else{
				$Formula=$row2['cantidad'];
				$varillaje='';
				//echo $Formula.'//'.$row2['capacidad'];
				//number_format($Impor, 2, '.', '');//$Impor;	
				 $capGalon=($Formula*100)/$row2['capacidad'];
			}			
			
			//$altcapGalon='Capacidad del Tanque('.$row2['capacidad'].')  Nivel '.(number_format($Formula,2)*100)/$row2['capacidad'].'%';
			$altcapGalon='Capacidad del Tanque('.$row2['capacidad'].')  Nivel '.$capGalon.'%';
						
			if ($capGalon>=100){
				$imgG='1.jpg';
			}if ($capGalon<100){
				$imgG='2.jpg';
			}if ($capGalon<70){
				$imgG='3.jpg';
			}if ($capGalon<50){
				$imgG='4.jpg';
			}if ($capGalon<25){
				$imgG='5.jpg';
			}
			$capGalon='<img src="img/'.$imgG.'" width="68" height="43" alt="'.$altcapGalon.'"  />';
			
		   echo '<td width="70" align="right"><span class="Estilo12">'.$varillaje.'</span></td>
		   <td width="70" align="right"><span class="Estilo12">'.number_format($Formula,2).'</span></td>
			<td width="70"><span class="Estilo12">'.$capGalon.'</span></td>
			
			
		</tr>';
		  
	  }	
	echo  "</table><!--</div>--></td></tr></table>";
///-------------------------------
	
	echo '</td>
  </tr>  
</table>';
	
  	}  /////-----------------------------------------------------------------------------------------
$ITE+=$ITL;
//Totales Local
	echo '
	<br>
	  <div  style="color:#FF0000;padding-left:420px;"><b>TOTAL POR EMPRESA :</b>     
      '.$ITL.'</div>
';

}  //--- fin de local	

//Totales Emprsa
	echo '
	<br>
	  <div  style="color:#0066FF;padding-left:420px;"><b>TOTAL GENERAL :</b>     
       '.$ITE.'</div>
';

	
	echo "|<table  border='0' width='100%'><tr>
	<td width='90'>&nbsp;</td>
	<td> ";
	 echo $this->paginar($totalreg,$pag,$regvis);
	 echo "</td>
	<td  width='90'>&nbsp;</td>
	</tr></table>";
}

function consulta_histcontometro($cod){
$strSQL4="select * from hist_contometro  where id=".$cod;
//echo $strSQL4;
  $resultado4=mysql_query($strSQL4);
  $row4=mysql_fetch_array($resultado4);
  return $row4;
 
}
function consulta_histvarillaje($cod){
$strSQL4="select * from hist_varillaje  where id=".$cod;
//echo $strSQL4;
  $resultado4=mysql_query($strSQL4);
  $row4=mysql_fetch_array($resultado4);
  return $row4;
 
}
function manguera_lis($id){
$strSQL4="select * from manguera order by id  ";
  $resultado4=mysql_query($strSQL4);
  $elemento.="<select id='c_manguera' name='c_manguera' onChange='mangueraSelec(this);' style='width:125px' >";
 // $elemento.="<option value=''>Seleccionar</option>";
  while($row4=mysql_fetch_array($resultado4)){

  $elemento.="<option value='".$row4['id']."'";
    if($id==$row4['id']) {
	$elemento.=' selected="selected" ';
	}
    $elemento.=">".$row4['nom_mang']."</option>";
  } 
  $elemento.="</select>";
   return $elemento;
 
}
function manguera_lis2($id,$id2){
$strSQL4="select M.id,nom_mang,M.serial,cod_tanques,cod_surtidor,factor from manguera M
inner join surtidor S on M.cod_surtidor=S.id
inner join isla I on S.cod_isla=I.id 
where tienda='$id' and sucursal='$id2'
order by M.id  ";
  $resultado4=mysql_query($strSQL4);
  $elemento.="<select id='c_manguera' name='c_manguera' onChange='mangueraSelec(this);' style='width:125px' >";
 // $elemento.="<option value=''>Seleccionar</option>";
  while($row4=mysql_fetch_array($resultado4)){

  $elemento.="<option value='".$row4['id']."'";
    if($id==$row4['id']) {
	$elemento.=' selected="selected" ';
	}
    $elemento.=">".$row4['nom_mang']."</option>";
  } 
  $elemento.="</select>";
   return $elemento;
 
}
function tanque_lis($id){
$strSQL4="select * from tanques 

order by id 
 ";
// where cod_prod in (select idproducto from producto WHERE substring(nombre,1,3)<>'GLP' )

  $resultado4=mysql_query($strSQL4);
  $elemento.="<select id='c_tanque' name='c_tanque' onChange='tanqueSelec(this)' >";
 // $elemento.="<option value=''>Seleccionar</option>";
  while($row4=mysql_fetch_array($resultado4)){

  $elemento.="<option value='".$row4['id']."'";
    if($id==$row4['id']) {
	$elemento.=' selected="selected" ';
	}
    $elemento.=">".$row4['nom_tanq']."</option>";
  } 
  $elemento.="</select>";
   return $elemento;
 
}
function usuario_lis($id){
$strSQL4="select * from usuarios order by usuario  ";
  $resultado4=mysql_query($strSQL4);
  $elemento.="<select id='c_usuario' name='c_usuario' style='width:125px'>";
 // $elemento.="<option value=''>Seleccionar</option>";
  while($row4=mysql_fetch_array($resultado4)){

  $elemento.="<option value='".$row4['codigo']."'";
    if($id==$row4['codigo']) {
	$elemento.=' selected="selected" ';
	}
    $elemento.=">".$row4['usuario']."</option>";
  } 
  $elemento.="</select>";
   return $elemento;
 
}
function sucrusal_lis($id){
$strSQL4="select * from sucursal order by cod_suc  ";
  $resultado4=mysql_query($strSQL4);
  $elemento.="<select id='c_sucursal' name='c_sucursal' style='width:125px' onChange='sucursalSelec(this);' >";
 // $elemento.="<option value=''>Seleccionar</option>";
  while($row4=mysql_fetch_array($resultado4)){

  $elemento.="<option value='".$row4['cod_suc']."'";
    if($id==$row4['cod_suc']) {
	$elemento.=' selected="selected" ';
	}
    $elemento.=">".$row4['des_suc']."</option>";
  } 
  $elemento.="</select>";
   return $elemento;
}
function tienda_lis($id){
 $strSQL4="select * from tienda where cod_suc='$id' order by cod_tienda   ";
  $resultado4=mysql_query($strSQL4);
  $elemento.="<select id='c_tienda' name='c_tienda' style='width:125px' onChange='tiendaSelec(this);'>";
 // $elemento.="<option value=''>Seleccionar</option>";
  while($row4=mysql_fetch_array($resultado4)){

  $elemento.="<option value='".$row4['cod_tienda']."'";
    if($id==$row4['cod_tienda']) {
	$elemento.=' selected="selected" ';
	}
    $elemento.=">".$row4['des_tienda']."</option>";
  } 
  $elemento.="</select>";
   return $elemento;
}
function validar_manguera($id,$fecha,$manuera,$turno,$contometraje){

 $strSQL1="select * from hist_contometro 
 where id='".$id."'  ";
 $resultado4=mysql_query($strSQL1);
 $row=mysql_fetch_array($resultado4);
 $Act=$row['id'];
 $turC=$row['turno']-1;
 if ($Act<>''){
 	$Wc=" and  turno='".$turC."' ";
 }
  //validar fecha 
  if ($fecha<date('d-m-Y')){
 	 echo 'La fecha no debe ser menor al ultimo Contrometro Ingresado   ';
  }
 //parte 2 
 $strSQL1="select * from hist_contometro 
 where cod_manguera='".$manuera."' ".$Wc." order by  fecha_his desc";
 $resultado4=mysql_query($strSQL1);
 $row=mysql_fetch_array($resultado4);
//echo $row['cont_fin'];
 if ($row['cont_fin']>=$contometraje ){ 	
 	echo 'Contrometro debe ser mayor que ';	
	echo $row['cont_fin'];
	echo '  // ';
 } 
  
 //parte 2
 $strSQL1="select * from hist_contometro 
 where substring(fecha_his,1,10)='".formatofecha($fecha)."' and cod_manguera='".$manuera."'  order by  fecha_his desc";
 $resultado4=mysql_query($strSQL1);
 $row=mysql_fetch_array($resultado4);
 if ($row['turno']==''){
 	if ($turno<>1){
	echo 'Ingrese Contrometro de Turno1 ';
	}
 }else if ($row['turno']=='1'){
 	if ($turno<>2){
 	echo 'Ingrese Contrometro de Turno2 '; 
	}
 }else if ($row['turno']=='2' && $Act=='' ){
 	echo 'Contometro Turno'.$turno.' ya  ingresado';
 }
 
  
  
}
function marcajeI_manguera($id,$fecha,$manuera,$turno,$contometraje){

 $strSQL1="select * from hist_contometro 
 where id='".$id."'  ";
 $resultado4=mysql_query($strSQL1);
 $row=mysql_fetch_array($resultado4);
 $Act=$row['id'];
 $turC=$row['turno']-1;
 if ($Act<>''){
 	$Wc=" and  turno='".$turC."' ";
 }
  
 //parte 2 
$strSQL1="select * from hist_contometro 
 where cod_manguera='".$manuera."' ".$Wc." order by  fecha_his desc";
 $resultado4=mysql_query($strSQL1);
 $row=mysql_fetch_array($resultado4);
//echo $row['cantidad'];
 if ($row['cont_fin']>=$contometraje ){
	$cat=$row['cont_fin'];
 } 
  
 if ($cat==''){
 	echo '0';
 }else{
 	echo $cat;
 }
  echo '|';
 
  $strSQLX=" select * from manguera where id='".$manuera."' ";
  $resultadoX=mysql_query($strSQLX);
  $rowX=mysql_fetch_array($resultadoX);
 
  if ($rowX['factor']==0){
	   if ($turno=='2' and formatofecha($fecha)==substr($row['fecha_his'],0,10)  ){ //date('d-m-Y')
		  echo $row['factor'];
	  }
  }else{
  	 echo $rowX['factor'];
  }
  
}
function manguera_datos($id){
  /*$strSQL4="select M.id,M.serial,nom_surt,nom_isl,I.ubicacion AS ui ,nom_tanq,T.ubicacion as ut,num_compartimientos,nombre from manguera M
  inner join surtidor S on M.cod_surtidor=S.id
  inner join isla I on S.cod_isla=I.id  
  inner join tanques T on M.cod_tanques=T.id  
  inner join producto P on T.cod_prod=P.idproducto    
  where M.id ='".$id."' ";*/
  $strSQL4="select * from manguera M
  inner join surtidor S on M.cod_surtidor=S.id  
  inner join tanques T on M.cod_tanques=T.id  
  inner join isla I on S.cod_isla=I.id  
  inner join producto P on T.cod_prod=P.idproducto    
  where M.id ='".$id."' ";
  
  $resultado4=mysql_query($strSQL4);
  $rowM=mysql_fetch_array($resultado4);
  //echo $rowM['serial']; 
				
  $elemento.=" ";

    $elemento.='
	<table width="100%" height="46" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="2%" align="center">&nbsp;</td>
                              <td width="15%" height="15" align="center"><div align="left"><b>SERIAL :</b></div></td>
                              <td width="38%"> '.$rowM['serial'].'</td>
                              <td width="1%">&nbsp;</td>
                              <td width="23%"><div align="left"><b>SURTIDOR : </b></div></td>
                              <td width="21%">'.$rowM['nom_surt'].'</td>
                            </tr>
                            <tr>
                              <td align="center">&nbsp;</td>
                              <td height="15" align="center"><div align="left"><b>ISLA : </b></div></td>
                              <td>'.$rowM['nom_isl'].'</td>
                              <td>&nbsp;</td>
                              <td><div align="left"><b>TANQUE : </b></div></td>
                              <td>'.$rowM['nom_tanq'].'</td>
                            </tr>
                            
                            <tr>
                              <td align="center">&nbsp;</td>
                              <td height="16" align="center"><div align="left"><b>PRODUCTO : </b></div></td>
                              <td colspan="4">'.$rowM['nombre'].'  &nbsp;&nbsp;&nbsp;<b>PRECIO : </b>'. number_format($rowM['precio'],3).'</td>
                            </tr>
                            
                          </table>
	';

  $elemento.="</select>";
 //$elemento.= '|';
 //$elemento.= $rowM[5];
   return $elemento;
 
}
function tanque_datos($id){
  /*$strSQL4="select M.id,M.serial,nom_surt,nom_isl,nom_tanq,num_compartimientos,
  nombre,T.largo,T.radio,T.capacidad from manguera M
  inner join surtidor S on M.cod_surtidor=S.id
  inner join isla I on S.cod_isla=I.id  
  inner join tanques T on M.cod_tanques=T.id  
  inner join producto P on T.cod_prod=P.idproducto    
  where M.id ='".$id."' ";*/
  $strSQL4="select * FROM tanques T  
  inner join producto P on T.cod_prod=P.idproducto    
  where T.id ='".$id."' ";
  
  $resultado4=mysql_query($strSQL4);
  $rowM=mysql_fetch_array($resultado4);
  //echo $rowM['serial']; 
  $elemento.=" ";



    $elemento.='	
<table width="100%" height="55" border="0" cellpadding="0" cellspacing="0">  
							<tr>
							  <td width="1%" align="center">&nbsp;</td>
                              <td width="21%" align="center"><div align="left"><b>PRODUCTO : </b></div></td>
                              <td colspan="4">'.$rowM['nombre'].'</td>
                            </tr>';
                 if (substr($rowM['nombre'],0,3)=='GLP'){
				 		$elemento.='						
                            <tr>
                              <td align="center">&nbsp;</td>
							  <td><div align="left"><b>CAPACIDAD : </b></div></td>
                              <td>'.$rowM['capacidad'].'</td>                              
                              <td>&nbsp;</td>
                              <td align="center"><div align="left"><b>&nbsp;</b></div></td>
                              <td><label id="GalonesX"></label></td>
                            </tr>
							<tr>
                              <td align="center">&nbsp;</td>
                              <td align="center"><div align="left"><b>&nbsp; </b></div></td>
                              <td width="26%"><label id="LargoX" style="visibility:hidden"></label></td>
                              <td width="6%">&nbsp;</td>
                              <td width="18%"><div align="left"><b>&nbsp; </b></div></td>
                              <td width="28%"><label id="RadioX"></label></td>
                            </tr>	
							';
				 }else{           
							$elemento.='<tr>
                              <td align="center">&nbsp;</td>
                              <td align="center"><div align="left"><b>LARGO(L) : </b></div></td>
                              <td width="26%"><label id="LargoX">'.$rowM['largo'].'</label></td>
                              <td width="6%">&nbsp;</td>
                              <td width="18%"><div align="left"><b>RADIO(R) : </b></div></td>
                              <td width="28%"><label id="RadioX">'.$rowM['radio'].'</label></td>
                            </tr>							
                            <tr>
                              <td align="center">&nbsp;</td>
                              <td align="center"><div align="left"><b>GALONES(G) : </b></div></td>
                              <td><label id="GalonesX">3.78541</label></td>
                              <td>&nbsp;</td>
                              <td><div align="left"><b>CAPACIDAD : </b></div></td>
                              <td>'.$rowM['capacidad'].'</td>
                            </tr>'; 
					}		
							                 
                          $elemento.='</table>

	';

  $elemento.="</select>";
  //$elemento.="|";
  //$elemento.=substr($rowM['nombre'],0,3);
 
   return $elemento;
 
}
function tipo_tanque($id){
	
  $strSQL4="select * FROM tanques T  
  inner join producto P on T.cod_prod=P.idproducto    
  where T.id ='".$id."' ";
    
  $resultado4=mysql_query($strSQL4);
  $rowM=mysql_fetch_array($resultado4);
  $elemento.=strtoupper(substr($rowM['nombre'],0,3));
  return $elemento;
   
}
function listar_isla($condicion,$texto,$pag){
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
  $sql="select * from isla $where  order by id";
 //echo $sql;
	$totalreg=mysql_num_rows(mysql_query($sql));
  $resultados = mysql_query($sql." limit ".$inicio.",".$regvis);
			 // echo "resultado".$resultado;
	echo '<table border="0" align="center">

<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">

      <td  width="40" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">N.</td>
      <td   width="70"  align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1" >Nombre</td>
	  <td   width="70" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Ubicacion</td>  <td   width="70" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Empresa</td>
	  <td   width="70" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Tienda</td>
	  <td  width="50" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Acciones</td>
    </tr><tr><td colspan="6"><div style="position:relative;height:210px;overflow:auto;border:0px solid;padding:0px;margin:0px;"><table border="0" align="left">' ;
	  $temcat="";
	while($row=mysql_fetch_array($resultados)){

	 echo '<tr bgcolor="#FFFFFF">

		  <td width="70" align="center"><span class="Estilo12">'.$row['id'].'</span></td>
		  <td width="100"><span class="Estilo12">'.$row['nom_isl'].'</span></td>
		   <td width="100"><span class="Estilo12">'.$row['ubicacion'].'</span></td>';
	  
	  $strSQL1="select * from sucursal  where cod_suc='".$row['sucursal']."'  ";
 $resultado4=mysql_query($strSQL1);
 $rowX=mysql_fetch_array($resultado4);
 $empresa=$rowX['cod_suc'].'-'.$rowX['des_suc'];	
  
   $strSQL1="select * from tienda  where cod_tienda='".$row['tienda']."'  ";
 $resultado4=mysql_query($strSQL1);
 $rowX=mysql_fetch_array($resultado4);
 $tienda=$rowX['cod_tienda'].'-'.$rowX['des_tienda'];	  
	  
echo'	  
		<td width="100"><span class="Estilo12">'.$empresa.'</span></td>
		<td width="100"><span class="Estilo12">'.$tienda.'</span></td>
		  <td width="25" align="center"><a href=\'javascript:editar( "'.$row['id'].'");\'><img src="../imgenes/ico_edit.gif" border="0"></a></td>
		  <td width="25" align="center"><a href=\'javascript:eliminar("'.$row['id'].'");\'><img src="../imgenes/eliminar.gif" border="0"></a></td>

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
function listar_tanque($condicion,$texto,$pag){
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
  $sql="select * from tanques $where  order by id";
 //echo $sql;
	$totalreg=mysql_num_rows(mysql_query($sql));
  $resultados = mysql_query($sql." limit ".$inicio.",".$regvis);
			 // echo "resultado".$resultado;
	echo '<table border="0" align="center">

<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">

      <td  width="40" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">N.</td>
      <td   width="70"  align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1" >Nombre</td>
	  <td   width="150" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Producto</td>
	  <td   width="70" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Capacidad</td>
	  <td  width="50" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Acciones</td>
    </tr><tr><td colspan="8"><div style="position:relative;height:210px;overflow:auto;border:0px solid;padding:0px;margin:0px;"><table border="0" align="left">' ;
	  $temcat="";
	while($row=mysql_fetch_array($resultados)){

	 echo '<tr bgcolor="#FFFFFF">

		  <td width="70" align="center"><span class="Estilo12">'.$row['id'].'</span></td>
		  <td width="100"><span class="Estilo12">'.$row['nom_tanq'].'</span></td>
		  ';

 $strSQL1="select * from producto  where idproducto='".$row['cod_prod']."'  ";
 $resultado4=mysql_query($strSQL1);
 $rowX=mysql_fetch_array($resultado4);
 $produc=$rowX['idproducto'].'-'.$rowX['nombre'];	
 	   
		echo'
		 <td width="250"><span class="Estilo12">'.$produc.'</span></td>
		 <td width="100"><span class="Estilo12">'.$row['capacidad'].'</span></td>		 
		 <td width="25" align="center"><a href=\'javascript:editar( "'.$row['id'].'");\'><img src="../imgenes/ico_edit.gif" border="0"></a></td>
		  <td width="25" align="center"><a href=\'javascript:eliminar("'.$row['id'].'");\'><img src="../imgenes/eliminar.gif" border="0"></a></td>

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
function listar_surtidor($condicion,$texto,$pag){
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
  $sql="select * from surtidor $where  order by id";
 //echo $sql;
	$totalreg=mysql_num_rows(mysql_query($sql));
  $resultados = mysql_query($sql." limit ".$inicio.",".$regvis);
			 // echo "resultado".$resultado;
	echo '<table border="0" align="center">

<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">

      <td  width="40" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">N.</td>
      <td   width="70"  align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1" >Nombre</td>
	  <td   width="70" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Serial</td>
	  <td   width="70" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Isla</td>
	  <td  width="50" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Acciones</td>
    </tr><tr><td colspan="6"><div style="position:relative;height:210px;overflow:auto;border:0px solid;padding:0px;margin:0px;"><table border="0" align="left">' ;
	  $temcat="";
	while($row=mysql_fetch_array($resultados)){

	 echo '<tr bgcolor="#FFFFFF">

		  <td width="70" align="center"><span class="Estilo12">'.$row['id'].'</span></td>
		  <td width="100"><span class="Estilo12">'.$row['nom_surt'].'</span></td>
		  ';
 $strSQL1="select * from isla  where id='".$row['cod_isla']."'  ";
 $resultado4=mysql_query($strSQL1);
 $rowX=mysql_fetch_array($resultado4);
 $isla=$rowX['id'].'-'.$rowX['nom_isl'];		   
		   
		echo'
		 <td width="100"><span class="Estilo12">'.$row['serial'].'</span></td>		 
		 <td width="100"><span class="Estilo12">'.$isla.'</span></td>  
		
		 <td width="25" align="center"><a href=\'javascript:editar( "'.$row['id'].'");\'><img src="../imgenes/ico_edit.gif" border="0"></a></td>
		  <td width="25" align="center"><a href=\'javascript:eliminar("'.$row['id'].'");\'><img src="../imgenes/eliminar.gif" border="0"></a></td>

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
function listar_manguera($condicion,$texto,$pag){
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
  $sql="select * from manguera $where  order by id";
 //echo $sql;
	$totalreg=mysql_num_rows(mysql_query($sql));
  $resultados = mysql_query($sql." limit ".$inicio.",".$regvis);
			 // echo "resultado".$resultado;
	echo '<table border="0" align="center">

<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">

      <td  width="40" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">N.</td>
      <td   width="70"  align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1" >Nombre</td>
	  <td   width="70" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Serial</td>
	  <td   width="70" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Tanque</td>
	  <td   width="70" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Surtidor</td>
	  <td   width="70" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Factor</td>
	  <td  width="50" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Acciones</td>
    </tr><tr><td colspan="7"><div style="position:relative;height:210px;overflow:auto;border:0px solid;padding:0px;margin:0px;"><table border="0" align="left">' ;
	  $temcat="";
	while($row=mysql_fetch_array($resultados)){

	 echo '<tr bgcolor="#FFFFFF">

		  <td width="70" align="center"><span class="Estilo12">'.$row['id'].'</span></td>
		  <td width="100"><span class="Estilo12">'.$row['nom_mang'].'</span></td>
		  ';
 $strSQL1="select * from tanques  where id='".$row['cod_tanques']."'  ";
 $resultado4=mysql_query($strSQL1);
 $rowX=mysql_fetch_array($resultado4);
 $tanque=$rowX['id'].'-'.$rowX['nom_tanq'];
 	
 $strSQL1="select * from surtidor  where id='".$row['cod_surtidor']."'  ";
 $resultado4=mysql_query($strSQL1);
 $rowY=mysql_fetch_array($resultado4);
 $surtidor=$rowY['id'].'-'.$rowY['nom_surt'];	   
		   
		echo'
		 <td width="100"><span class="Estilo12">'.$row['serial'].'</span></td>		 
		 <td width="100"><span class="Estilo12">'.$tanque.'</span></td>  
		  <td width="100"><span class="Estilo12">'.$surtidor.'</span></td> 
		   <td width="100"><span class="Estilo12">'.$row['factor'].'</span></td>  
		
		 <td width="25" align="center"><a href=\'javascript:editar( "'.$row['id'].'");\'><img src="../imgenes/ico_edit.gif" border="0"></a></td>
		  <td width="25" align="center"><a href=\'javascript:eliminar("'.$row['id'].'");\'><img src="../imgenes/eliminar.gif" border="0"></a></td>

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

function consulta_isla($cod){
$strSQL4="select * from isla  where id=".$cod;
//echo $strSQL4;
  $resultado4=mysql_query($strSQL4);
  $row4=mysql_fetch_array($resultado4);
  return $row4;
 
}
function consulta_tanque($cod){
$strSQL4="select * from tanques   where id=".$cod;
//echo $strSQL4;
  $resultado4=mysql_query($strSQL4);
  $row4=mysql_fetch_array($resultado4);
  return $row4;
 
}
function consulta_surtidor($cod){
$strSQL4="select * from surtidor   where id=".$cod;
//echo $strSQL4;
  $resultado4=mysql_query($strSQL4);
  $row4=mysql_fetch_array($resultado4);
  return $row4;
 
}
function consulta_manguera($cod){
$strSQL4="select * from manguera   where id=".$cod;
//echo $strSQL4;
  $resultado4=mysql_query($strSQL4);
  $row4=mysql_fetch_array($resultado4);
  return $row4;
 
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

function new_isla($idpro,$nnombre,$ndescripcion,$ntienda,$nsucursal){

	$strSQL2= "insert into isla (id,nom_isl,ubicacion,tienda,sucursal)values ($idpro,'$nnombre','$ndescripcion','$ntienda','$nsucursal')";
	mysql_query($strSQL2);
		
	echo "<script>alert('Proceso Agregado');location.href='isla.php'</script>";
}

function act_isla($idpro,$nnombre,$ndescripcion,$ntienda,$nsucursal){
$strSQL="update isla set nom_isl='".$nnombre."',ubicacion='".$ndescripcion."',tienda='".$ntienda."',sucursal='".$nsucursal."' where id=".$idpro;

mysql_query($strSQL);
	echo "<script>alert('Proceso Actualizado');location.href='isla.php'</script>";

}

function elim_isla($codigo){

$strSQL="delete from isla where id=".$codigo;
mysql_query($strSQL);
echo "<script>alert('Este Proceso ha sido eliminado');location.href='isla.php'</script>";
}


function new_tanque($idpro,$nnombre,$ndescripcion,$nproducto,$ncapacidad,$nubiacion,$nlargo,$nradio){

	$strSQL2= "insert into tanques (id,nom_tanq,num_compartimientos,cod_prod,capacidad,ubicacion,largo,radio)values ($idpro,'$nnombre','$ndescripcion','$nproducto','$ncapacidad','$nubiacion','$nlargo','$nradio')";
	mysql_query($strSQL2);
		
	echo "<script>alert('Proceso Agregado');location.href='tanque.php'</script>";
}

function act_tanque($idpro,$nnombre,$ndescripcion,$nproducto,$ncapacidad,$nubiacion,$nlargo,$nradio){
$strSQL="update tanques set nom_tanq='".$nnombre."',num_compartimientos='".$ndescripcion."',cod_prod='".$nproducto."',capacidad='".$ncapacidad."',ubicacion='".$nubiacion."' ,largo='".$nlargo."',radio='".$nradio."' where id=".$idpro;

mysql_query($strSQL);
	echo "<script>alert('Proceso Actualizado');location.href='tanque.php'</script>";

}

function elim_tanque($codigo){

$strSQL="delete from tanques where id=".$codigo;
mysql_query($strSQL);
echo "<script>alert('Este Proceso ha sido eliminado');location.href='tanque.php'</script>";
}

function new_surtidor($idpro,$nnombre,$nserial,$nisla){

	$strSQL2= "insert into surtidor (id,nom_surt,serial,cod_isla)values ($idpro,'$nnombre','$nserial','$nisla')";
	mysql_query($strSQL2);
		
	echo "<script>alert('Proceso Agregado');location.href='surtidor.php'</script>";
}

function act_surtidor($idpro,$nnombre,$nserial,$nisla){
$strSQL="update surtidor set nom_surt='".$nnombre."',serial='".$nserial."',cod_isla='".$nisla."' where id=".$idpro;

mysql_query($strSQL);
	echo "<script>alert('Proceso Actualizado');location.href='surtidor.php'</script>";

}

function elim_surtidor($codigo){

$strSQL="delete from surtidor where id=".$codigo;
mysql_query($strSQL);
echo "<script>alert('Este Proceso ha sido eliminado');location.href='surtidor.php'</script>";
}

function new_manguera($idpro,$nnombre,$nserial,$ntanque,$nsurtidor,$nfactor){
	$strSQL2= "insert into manguera (id,nom_mang,serial,cod_tanques,cod_surtidor,factor)values ($idpro,'$nnombre','$nserial','$ntanque','$nsurtidor','$nfactor')";
	mysql_query($strSQL2);
		
	echo "<script>alert('Proceso Agregado');location.href='manguera.php'</script>";
}

function act_manguera($idpro,$nnombre,$nserial,$ntanque,$nsurtidor,$nfactor){
$strSQL="update manguera set nom_mang='".$nnombre."',serial='".$nserial."',cod_tanques='".$ntanque."',cod_surtidor='".$nsurtidor."',factor='".$nfactor."' where id=".$idpro;

mysql_query($strSQL);
	echo "<script>alert('Proceso Actualizado');location.href='manguera.php'</script>";

}

function elim_manguera($codigo){

$strSQL="delete from manguera where id=".$codigo;
mysql_query($strSQL);
echo "<script>alert('Este Proceso ha sido eliminado');location.href='manguera.php'</script>";
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
	<td   width="150" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Propio</td>
	<td   width="150" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Subcontrata</td>
	<td   width="50" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Acciones</td>
    </tr><tr><td colspan="8"><div style="position:relative;height:250px;overflow:auto;border:0px solid;padding:0px;margin:0px;"><table border="0" align="left">' ;
	  $temcat="";
	while($row=mysql_fetch_array($resultados)){

	 echo '<tr  bgcolor="#FFFFFF" >

		  <td width="50" align="center"><span class="Estilo12">'.$row['id'].'</span></td>
		  <td width="200"><span class="Estilo12">'.$row['nombre'].'</span></td>
		   <td width="200"><span class="Estilo12">'.$row['descripcion'].'</span></td>
			<td width="200"><span class="Estilo12">'.$row['cc'].'</span></td>
			<td width="200"><span class="Estilo12">'.$row['costoDI'].'</span></td>
			<td width="200"><span class="Estilo12">'.$row['costo1'].'</span></td>
			<td width="200"><span class="Estilo12">'.$row['costo2'].'</span></td>
		  <td width="25" align="center"><a href=\'javascript:editar( "'.$row['id'].'");\'><img src="../imgenes/ico_edit.gif" border="0"></a></td>
		  <td width="25" align="center"><a href=\'javascript:eliminar("'.$row['id'].'");\'><img src="../imgenes/eliminar.gif" border="0"></a></td>

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
							  
	  <td width="50" style=" border:#CCCCCC solid 1px" class="EstiloTexto1"  align="center">Acciones</td>
	  
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
		  <td width="250" ><span class="Estilo12">'.$row['conceptos'].'</span></td>
		  <td width="100" ><span class="Estilo12">'.$row['factor1'].'%</span></td>
		  <td width="100" ><span class="Estilo12">'.$row['factor2'].'%</span></td>
		  <td width="100" ><span class="Estilo12">'.$row['factor3'].'%</span></td>
		  <td width="100" ><span class="Estilo12">'.$row['factor4'].'%</span></td>
		  
		  <td width="50" align="center"><a href=\'javascript:editar( "'.$row['id'].'");\'><img src="../imgenes/ico_edit.gif" border="0"></a></td>

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
	
	<td   width="50" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Acciones</td>
    </tr><tr><td colspan="8"><div style="position:relative;height:200px;overflow:auto;border:0px solid;padding:0px;margin:0px;"><table border="0" align="left">' ;
	  $temcat="";
	while($row=mysql_fetch_array($resultados)){

	 echo '<tr  bgcolor="#FFFFFF" >

		  <td width="50" align="center"><span class="Estilo12">'.$row['id'].'</span></td>
		  <td width="50"><span class="Estilo12">'.$row['codigo'].'</span></td>
		   <td width="200"><span class="Estilo12">'.$row['descripcion'].'</span></td>
			<td width="180"><span class="Estilo12">'.$row['formato'].'</span></td>
			<td width="100"><span class="Estilo12">'.$row['cola'].'</span></td>
			<td width="100"><span class="Estilo12">'.$row['modalidad'].'</span></td>
		  <td width="25" align="center"><a href=\'javascript:editar( "'.$row['id'].'");\'><img src="../imgenes/ico_edit.gif" border="0"></a></td>
		  <td width="25" align="center"><a href=\'javascript:eliminar("'.$row['id'].'");\'><img src="../imgenes/eliminar.gif" border="0"></a></td>

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
$strSQL4="select id,codigo,descripcion,formato,cola,modalidad from t_pago   where id=".$cod;
//echo $strSQL4;
  $resultado4=mysql_query($strSQL4);
  $row4=mysql_fetch_array($resultado4);
  return $row4;
 
}

function listar_histvarillaje($condicion,$texto,$fec1,$fec2,$tipo2,$texto2,$pag){
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
	$where.=" and substring(fecha_his,1,10) between '".formatofecha($fec1)."'  and '".formatofecha($fec2)."' ";
		
		if ($texto2!=""){
			if ($tipo2=='sucursal'){
			$where.=" and $tipo2 in (select cod_suc from $tipo2 where des_suc like '%$texto2%' )";
			}else{
			$where.=" and $tipo2 in (select cod_tienda from $tipo2 where des_tienda like '%$texto2%' )";
			}
		}
	
	}
	//echo "select * from transportista $where order by id asc";
   $sql="select HC.id,nom_tanq,fecha_his,usuario,HC.pc,cantidad,M.id as cod_tanque,r,l,g from hist_varillaje HC
   inner join tanques M on HC.cod_tanque=M.id
   inner join usuarios U on HC.cod_vendedor=U.codigo   
   $where  order by HC.fecha_his desc";
   
 //echo $sql;
	$totalreg=mysql_num_rows(mysql_query($sql));
  $resultados = mysql_query($sql." limit ".$inicio.",".$regvis);
			 // echo "resultado".$resultado;
	echo '<table border="0" align="center">

<tr height="20px" style="background:url(../imagenes/sky_blue_grid.gif); border:#999999 solid 1px">

      <td  width="20" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">N&deg;</td>
      <td   width="110"  align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1" >Fecha - Hora</td>
	  <td   width="70"  align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1" >Tanque</td>
	  <td   width="70" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Responsable</td>
	  <td   width="70" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">PC</td>
	  <td   width="70" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Volumen Actual </td>
	  <td   width="70" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Varillaje Altura(H)</td>
	  <td   width="70" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Volumen G.</td>
	  <td  width="50" align="center" style=" border:#CCCCCC solid 1px" class="EstiloTexto1">Acciones</td>
    </tr><tr><td colspan="9"><div style="position:relative;height:250px;overflow:auto;border:0px solid;padding:0px;margin:0px;"><table border="0" align="left">' ;
	  $temcat="";
	while($row=mysql_fetch_array($resultados)){
	if ($row['l']!='GLP'){
		$color="#FFFFFF";
	}else{
		$color="#CEF3FF";
	}
	 echo '<tr bgcolor="'.$color.'">

		  <td width="20" align="center"><span class="Estilo12">'.$row['id'].'</span></td>
		  <td width="125"><span class="Estilo12">'.formatofecha(substr($row['fecha_his'],0,10)).' '.substr($row['fecha_his'],11,20).'</span></td>
		  <td width="80"><span class="Estilo12">'.$row['nom_tanq'].'</span></td>		   
		   <td width="90"><span class="Estilo12">'.$row['usuario'].'</span></td>
		   <td width="90"><span class="Estilo12">'.$row['pc'].'</span></td>';	
	$capacidad='--';	
	$capacidadGLP=$row['cantidad'];
	$Formula=$row['cantidad'];
if ($row['l']!='GLP'){	
	$strSQL1="select * from tanques  where id='".$row['cod_tanque']."'  ";
 	$resultado4=mysql_query($strSQL1);
 	$rowX=mysql_fetch_array($resultado4);
		 
			  $R=$row['r'];//$rowX['radio'];//114.59155902617;
			  $H=$row['cantidad'];//1;
			  $L=$row['l'];//$rowX['largo'];//120;
			  $G=$row['g'];//3.78541;

			$Formula=((((2*pi()*($R*$R)*(rad2deg(acos(($R-$H)/$R))))/360)-((sqrt(($R*$R)-(($R-$H)*($R-$H))))*($R-$H)))*$L)/($G*1000);
	$capacidad=$row['cantidad'];
	$capacidadGLP='--';
	
}
		   echo '
		   <td width="80" align="right"><span class="Estilo12">'.$capacidadGLP.'</span></td>
		   <td width="80" align="right"><span class="Estilo12">'.$capacidad.'</span></td>
		   <td width="80" align="right"><span class="Estilo12">'.number_format($Formula,2).'</span></td>
		  <td width="25" align="center"><a href=\'javascript:editar( "'.$row['id'].'");\'><img src="../imgenes/ico_edit.gif" border="0"></a></td>
		  <td width="25" align="center"><a href=\'javascript:eliminar("'.$row['id'].'");\'><img src="../imgenes/eliminar.gif" border="0"></a></td>

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
echo '<table  border="0" cellpadding="0" cellspacing="0"  width="100%" >
<tr>
<td  height="30"  >Viendo del '.$del.' al '. $al .'(de '.$total_registros.' registros).</td><td  align="right" >';			  
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