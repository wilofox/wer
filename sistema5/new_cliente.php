<?php 
include('conex_inicial.php');
include('funciones/funciones.php');
$mov='';

$verz=$_REQUEST['verz'];
if($verz=="T"){
	$zona="";
}else{
	$zona=" and zona='".$verz."'";
}
//print_r($_REQUEST);
///echo "sdg".$_REQUEST['aux'];

//verificar si este prodcto tiene movimientos  
if( $_REQUEST['auctip'] == 'C' ){ $taux = 'C'; }
else                            { $taux = 'P'; }
if(!empty($_REQUEST['cod']))
{  	$rsdtmov		=	mysql_query("select DISTINCT(auxiliar)  from det_mov where auxiliar='".$_REQUEST['cod']."'",$cn);
//echo "select DISTINCT(auxiliar)  from det_mov where auxiliar='".$_REQUEST['cod']."'";
    if( mysql_num_rows($rsdtmov) >0 )
    {   $rowmov		=	mysql_fetch_array($rsdtmov);
	    $rsdtmovc	=	mysql_query("select codcliente from cliente where codcliente='".$rowmov['auxiliar']."' and( tipo_aux='".$taux."' or tipo_aux='A')",$cn);
//echo	"select codcliente from cliente where codcliente='".$rowmov['auxiliar']."' and( tipo_aux='".$taux."' or tipo_aux='A')"	;
		if( mysql_num_rows($rsdtmovc) > 0 ){	$mov		=	'ok';  }
    }
}


if(isset($_REQUEST['upd_cod'])){

	$strSQL_aux="update cliente set tipo_aux='A' where codcliente='".$_REQUEST['upd_cod']."'";
	mysql_query($strSQL_aux,$cn);
	
exit;

}else{

	if(isset($_REQUEST['filtro'])){
	
	  $tipo_aux=$_REQUEST['tipo_aux'];
	  $valor=$_REQUEST['filtro'];	
	  	    
	 ?>
<style type="text/css">
<!--
.Estilo15 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #990000;
}
-->
</style>

<div id="detalle" style="width:805px; height:250px; overflow:auto; padding-left:5px;"  >	
	<table id="lista_aux" width="800" border="0" cellpadding="0" cellspacing="1">
	  
	   <?php  
	   
	    //PAGINACION 1	
		 $registros = 300; 
		 $pagina = $_REQUEST['pagina']; 
		// echo $pagina;

		if ($pagina=='') { 
		$inicio = 0; 
		$pagina = 1; 
		} 
		else { 
		$inicio = ($pagina - 1) * $registros; 
		} 
	//-------------------------------------------
	

  
$criterio=$_REQUEST['criterio'];
                  $strSQL="select * from cliente where $criterio like '%$valor%' and (tipo_aux='$tipo_aux' or tipo_aux='A')".$zona."  order by razonsocial  ";
				  
//echo $strSQL;

	$j=0;

		
		$resultado = mysql_query($strSQL); 
		$total_registros = mysql_num_rows($resultado); 
		$resultado = mysql_query($strSQL." LIMIT $inicio, $registros"); 
			
		$resultados2 =mysql_num_rows($resultado); 
		$total_paginas = ceil($total_registros / $registros);   
	
		//  echo "resultado".$resultados;
			  
while($row=mysql_fetch_array($resultado))
{

list($clasificacion)=mysql_fetch_array(mysql_query("select nombre from clas_clie where codigo='".$row['clas_clie']."'"));
list($condicion)=mysql_fetch_array(mysql_query("select nombre from condicion where codigo='".$row['condicion']."'"));
 ?>
        <tr bordercolor="#CCCCCC"  bgcolor="#F9F9F9" onClick="entrada(this)" ondblclick="editar('actualizar')">
          <td width="26" align="center"><input style="border: 0px; background:none; " type="radio" name="xaux" value="<?php  echo $row['codcliente']?>" /></td>
          
          <td width="197" title="<?=$row['razonsocial'];?>"><span class="Estilo12"><?php  //caracteres(substr($row['razonsocial'], 0, 25));
		  		  echo caracteres($row['razonsocial']); ?></span></td>
          <!--<td width="34"><span class="Estilo12"><?php //if ($row['t_persona']=="juridica"){ echo 'JUR.'; }else{echo 'NAT.';} ?></span></td>-->
          <td width="67" ><span class="Estilo12"><?php if($row['ruc']!=""){
		  	echo $row['ruc'];
			}else{
			echo $row['doc_iden'];
			}?></span></td>
          <!--<td width="64"><span class="Estilo12"><?php //echo $row['doc_iden'];?></span></td>-->
          <td width="203" title="<?=caracteres($row['direccion']);?>"><span class="Estilo12"><?php echo caracteres($row['direccion']) ?></span></td>
		  <td width="83"><span class="Estilo12"><?php echo $row['telefono'];?></span></td>
          <!--<td width="83"><span class="Estilo12"><?php //echo $clasificacion;?></span></td>
		  <?php //if($tipo_aux=="C"){?><td width="83"><span class="Estilo12"><?php //echo $condicion;?></span></td><?php //}?>-->
		
          <td width="53"><div align="center"><span class="Estilo12"><?php echo $row['baja'];?></span></div></td>
		  <td width="46"><span class="Estilo12"><?php echo $row['codcliente'];?></span></td>
      </tr>
		
		<?php  
  
  }
  mysql_free_result($resultado);
  
  ?>
</table> 
</div> 

<table width="100%" height="21" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="311" height="21" align="left" valign="bottom" style="color:#999999"><span class="Estilo29">&nbsp;&nbsp;Viendo del <strong><?php echo $inicio+1?></strong> al <strong><?php echo $inicio+$resultados2 ?></strong> (de <strong><?php echo $total_registros?></strong> productos)</span>.</td>
    <td width="526" align="right" valign="bottom" style="color:#999999"><font style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:13px">
      <?php 
			  
 if(($pagina - 1) > 0) { 
echo "<a style='cursor:pointer' onclick='filtrar($pagina-1)'>< Anterior </a> "; 
} 

for ($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
	echo "<b style='color:#000000'>".$pagina."</b> "; 
	} else { 
	echo "<a style='cursor:pointer' href='#' onclick='filtrar($i)'>$i</a> "; 
	}
}
if(($pagina + 1)<=$total_paginas) { 
echo " <a style='cursor:pointer' onclick='filtrar($pagina+1)'>Siguiente ></a>"; 
} 
    ?>
      <input type="hidden" name="pag" value="<?php echo $pagina?>" />
    &nbsp;&nbsp;    </font> </td>
  </tr>
</table>	 
	 
	 
	<?php


	}else{


if($_REQUEST['accion']=='n'){
			//$resultado3=mysql_query("select max(codcliente) as codigo from cliente",$cn);
			//$row3=mysql_fetch_array($resultado3);
			
			//$codigo=$row3['codigo'];
			//$codigo=str_pad($codigo+1,6,'0',STR_PAD_LEFT);
			
}

$strSQL4="select * from cliente where codcliente='".$_REQUEST['cod']."'";
  $resultado4=mysql_query($strSQL4,$cn);
  while($row4=mysql_fetch_array($resultado4))
  {
  $codigo=$_REQUEST['cod'];
  $razonsocial=$row4['razonsocial'];
  $ruc=$row4['ruc'];
  $nombres=$row4['nombres'];
  $apellidos=$row4['apellidos']; 
  $t_persona=$row4['t_persona'];
  $contacto=$row4['contacto'];
  $cargo=$row4['cargo'];
  $direccion=$row4['direccion'];
  $telefono=$row4['telefono'];
  $email=$row4['email'];
  $doc_iden=$row4['doc_iden'];
  $baja=$row4['baja'];
  $estado_percep=$row4['estado_percep'];
  $por_percep=$row4['por_percep'];
  $tAuxiliar=$row4['tipo_aux'];
  $condicion=$row4['condicion'];
  $responsable=$row4['responsable'];
  $clas_clie=$row4['clas_clie'];
  $lider=$row4['lider'];
  $codlider=$row4['codlider'];
  $tipoprov=$row4['tipoprov'];
  $idubigeo=$row4['ubigeo'];
  $idzonas=$row4['zona'];
  $cel1=$row4['cel1'];
  $cel2=$row4['cel2'];
  $nombre_aval=$row4['nombre_aval'];
  $direccion_aval=$row4['direc_aval'];
  $telefono_aval=$row4['tel_aval'];
    
  $marcar0=" checked='checked' ";
  
	if($estado_percep==0){
	      $desab=" disabled='disabled' ";
		  $marcar0=" ";
	   }else{
	   		switch($estado_percep){
				case 1:
				$marcar1=" checked='checked' ";
				break;
				case 2:
				$marcar2=" checked='checked' ";
				break;
				case 3:
				$marcar3=" checked='checked' ";
				break;
			}
	   
	   }  
  	}
  
  	list($distrito,$provincia,$departamento)=mysql_fetch_array(mysql_query("select desdist,desprovi,desdepa from ubigeo where id='".$idubigeo."'"));
  
    ?>


	<table width="505" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="4" align="right"></td>
      </tr>
      
      <tr>
        <td width="13" bgcolor="#FFE7D7">&nbsp;</td>
        <td colspan="2" bgcolor="#FFE7D7">&nbsp;</td>
        <td width="19" bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td rowspan="9" bgcolor="#FFE7D7">&nbsp;&nbsp;</td>
        <td width="70" height="21" bgcolor="#FFE7D7" class="Estilo12">C&oacute;digo</td>
        <td width="379" bgcolor="#FFE7D7"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input  readonly="readonly" name="codigo" type="text"  style="height:18; font-size:10px; font:bold" size="10" value="<?php echo $codigo?>" />
        </strong></font> <span class="Estilo12">Persona</span>
        <select style="height:18; font-size:10px" name="t_persona" onchange="cambiar_persona()">
          <option value="natural">Natural</option>
          <option value="juridica">Jur&iacute;dica o Natural con ruc</option>
        </select>
          <input type="hidden" name="t_persona2" value="<?php echo  $t_persona; ?>" />
		  <input type="hidden" name="mov" id="mov" value="<?php echo  $mov; ?>" />
	      <input type="hidden" name="condicion2" value="<?php echo  $condicion; ?>" />
        <input type="hidden" name="responsable2" value="<?php echo  $responsable; ?>" />
        <input type="hidden" name="clas_clie2" value="<?php echo  $clas_clie; ?>" />
		<input type="hidden" name="idubigeo" value="<?php echo  $idubigeo; ?>" />		</td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td height="21" bgcolor="#FFE7D7" class="Estilo12">Cli./R. Soc. </td>
        <td bgcolor="#FFE7D7" class="Estilo12">
          <input autocomplete="off" name="razonsocial" type="text"  style="height:18; font-size:10px" value="<?php echo caracteres($razonsocial)?>" size="46" maxlength="100" />
          Ruc &nbsp;&nbsp;
          <input autocomplete="off" name="ruc" disabled="disabled" type="text"  style="height:18; font-size:10px; margin:2px" value="<?php echo $ruc?>" size="15" maxlength="11" />        </td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td height="21" bgcolor="#FFE7D7" class="Estilo12">Doc Iden. </td>
        <td bgcolor="#FFE7D7" class="Estilo12">
          <input autocomplete="off" name="docu_iden" type="text"  style="height:18; font-size:10px" value="<?php echo $doc_iden?>" size="15" maxlength="8" />
        Tel&eacute;fonos
        <input name="telefono" type="text"  style="height:18; font-size:10px; margin-left:3px" value="<?php echo $telefono?>" size="15" maxlength="20" />
        Cargo 
        <input name="cargo" type="text"  style="height:18; font-size:10px" size="15" value="<?php echo $cargo?>" />        </td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td height="21" bgcolor="#FFE7D7" class="Estilo12">Celular 1: </td>
        <td bgcolor="#FFE7D7" class="Estilo12"><input name="cel1" type="text"  style="height:18; font-size:10px" size="15" value="<?php echo $cel1?>" />
        Celular 2: 
        <input name="cel2" type="text"  style="height:18; font-size:10px" size="15" value="<?php echo $cel2?>" /></td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td height="21" bgcolor="#FFE7D7" class="Estilo12">Direcci&oacute;n</td>
        <td bgcolor="#FFE7D7">
          <input name="direccion" type="text"  style="height:18; font-size:10px" value="<?php echo caracteres($direccion)?>" size="46" maxlength="100" />
         <span style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#0066FF; text-decoration:underline; cursor:pointer" onclick="otras_direc()"> Otras Direcciones </span></td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      
      <tr>
        <td height="22" bgcolor="#FFE7D7" class="Estilo12">Contacto</td>
        <td height="22" bgcolor="#FFE7D7"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>
          <input name="contacto" type="text"  style="height:18; font-size:10px" value="<?php echo $contacto?>" size="46" maxlength="50" />
           &nbsp;
           <input  style="width:120; font-size:10px; margin:2px; visibility:hidden" type="button" name="Submit" value="Datos Adicionales" />
        </strong></font></td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td height="23" bgcolor="#FFE7D7" class="Estilo12">Email</td>
        <td height="23" bgcolor="#FFE7D7" class="Estilo12">
          <input name="email" type="text"  style="height:18; font-size:10px" value="<?php echo $email?>" size="31" maxlength="100" />
          &nbsp;Web
          <input name="web" type="text"  style="height:18; font-size:10px" value="<?php echo $web?>" size="31" maxlength="100" />        </td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td height="42" colspan="2" bgcolor="#FFE7D7"><table width="459" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="158" height="12" class="Estilo12">
			<?php 
			
			if($_REQUEST['aux']!='P'){
			echo "Clasificaci&oacute;n";
			?>
			
			<?php 
			}else{
			echo "Tipo Proveedor";
			}
			?>			</td>
			
			
            <td width="154" class="Estilo12">Condici&oacute;n</td>
            <td width="147" class="Estilo12">Responsable</td>
          </tr>
          <tr>
            <td>
			<?php 
			
			if($_REQUEST['aux']!='P'){
			
			?>
			<span class="Estilo15">
			
              <select name="clas_clie" style="width:140"  >
                <?php 
		    $resultados11 = mysql_query("select * from clas_clie order by nombre ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
		  ?>
                <option value="<?php echo $row11['codigo']?>"><?php echo caracteres($row11['nombre']);?></option>
                <?php }?>
              </select>
            </span>
			
			<?php }else{
			if($tipoprov=='2'){
			$tempmarc2=" selected ";
			$tempmarc1=" ";
			}else{
			$tempmarc1=" selected ";
			$tempmarc2=" ";
			}
			?>
			
			<font face="Verdana, Arial, Helvetica, sans-serif" size="1px">
			
			
			<select name="tipoprov"  style="width:120px">
              <option <?php echo $tempmarc1?> value="1" >Local</option>
              <option <?php echo $tempmarc2?> value="2">Importación</option>
            </select>
			</font>
			<?php 
			
			}?>			</td>
            <td><span class="Estilo15">
              <select name="condicion" style="width:140" >
                <?php 
		    $resultados11 = mysql_query("select * from condicion order by nombre ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
		  ?>
                <option value="<?php echo $row11['codigo']?>"><?php echo caracteres($row11['nombre']);?></option>
                <?php }?>
              </select>
            </span></td>
            <td><span class="Estilo15">
              <select name="responsable" style="width:140" >
                <?php 
		    $resultados11 = mysql_query("select * from usuarios order by usuario ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
		  ?>
                <option value="<?php echo $row11['codigo']?>"><?php echo $row11['usuario'];?></option>
                <?php }?>
              </select>
            </span></td>
          </tr>
        </table></td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      
      
      <tr>
        <td height="19" colspan="2" bgcolor="#FFE7D7"><input type="hidden" name="accion" value="<?php echo $_REQUEST['accion']?>" />
          <font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>Dar de Baja
          <input type="checkbox" name="baja" value="S" style="cursor:default; border:none " 
		  <?php if($baja=='S'){echo "checked=checked"; }?> />
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
	
	
    pestana
    <table width="506" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="5" align="right"></td>
      </tr>
      
      <tr>
        <td width="8" rowspan="6" bgcolor="#FFE7D7">&nbsp;&nbsp;</td>
        <td height="62" colspan="2" bgcolor="#FFE7D7" class="Estilo12">
		<fieldset>
		
		<legend style="height:20px">Ubicaci&oacute;n</legend>
		 <table width="471" border="0" cellpadding="0" cellspacing="0">
            
            <tr>
              <td width="146"><span class="Estilo12" style="color:#339966"><strong>B&uacute;squeda :</strong></span></td>
              <td width="109"><strong>Distrito</strong></td>
              <td width="107"><strong>Provincia </strong></td>
              <td width="109"><strong>Departamento</strong></td>
            </tr>
            <tr>
              <td><input  name="busqDist" type="text" size="20" onKeyup="lista_ubigeo('ubigeo')"/></td>
              <td><input style=" background:#F3F3F3;  border:#999999 solid 1px" name="distrito" type="text" size="15"  readonly="" value="<?php echo $distrito?>"/></td>
              <td><input style=" background:#F3F3F3;  border:#999999 solid 1px" name="provincia" type="text" size="15" readonly="" value="<?php echo $provincia?>"/></td>
              <td><input style=" background:#F3F3F3;  border:#999999 solid 1px" name="departamento" type="text" size="15" readonly="" value="<?php echo $departamento?>"/></td>
            </tr>
        </table>
        </fieldset></td>
        <td width="4" bgcolor="#FFE7D7" class="Estilo12"><font face="Verdana, Arial, Helvetica, sans-serif" size="1px"><strong>&nbsp;</strong></font></td>
        <td height="62" bgcolor="#FFE7D7" class="Estilo12">&nbsp;</td>
      </tr>
      <tr>
        <td width="473" colspan="2" valign="top" bgcolor="#FFE7D7" class="Estilo12"><fieldset><legend>
          <input <?php echo $marcar0 ; ?> type="checkbox" name="checkbox" value="checkbox" style="background:none; border:none" onclick="activar_estados(this)" />
        Estado Percepci&oacute;n</legend>
          <table width="460" border="0" cellpadding="0" cellspacing="0">
            <tr >
              <td width="12">&nbsp;</td>
              <td width="206" class="Estilo12"><input  <?php echo $desab." ".$marcar1 ?> style="background:none; border:none" name="estado_percep" type="radio" value="1" onclick="activar_porc(this)" />
              Agente de Percepci&oacute;n </td>
              <td width="20"><input <?php echo $desab." ".$marcar3 ?> style="background:none; border:none" name="estado_percep" type="radio" value="3"  onclick="activar_porc(this)"/></td>
              <td width="222" class="Estilo12">Cliente exonerado de Percepci&oacute;n</td>
            </tr>
            <tr class="Estilo12">
              <td>&nbsp;</td>
              <td class="Estilo12"><input <?php echo $desab." ".$marcar2 ?> name="estado_percep" type="radio" value="2" style="background:none; border:none" onclick="activar_porc(this)" />
                Cliente Zona de Emergencia </td>
              <td class="Estilo12">&nbsp;</td>
              <td class="Estilo12">Porcentaje 
              <input <?php echo $desab ?> name="por_percep" type="text" size="8" maxlength="10" value="<?php echo number_format($por_percep,2)?>" />
              %</td>
            </tr></table></fieldset></td>
        <td width="4" rowspan="3" bgcolor="#FFE7D7" class="Estilo12">&nbsp;</td>
        <td width="5" bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      
      <tr><td colspan="2" valign="top" bgcolor="#FFE7D7" class="Estilo12">
        <fieldset><legend>Datos de Aval</legend>
		
		<table width="487" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="68">Nombre:</td>
            <td width="198"><input name="nombre_aval" type="text" size="15"  value="<?php echo $nombre_aval?>"/></td>
            <td width="9">&nbsp;</td>
            <td width="212">Telefono: 
            <input name="telefono_aval" type="text" size="15"  value="<?php echo $telefono_aval?>"/></td>
          </tr>
          <tr>
            <td>Direcci&oacute;n:</td>
            <td colspan="3"><input name="direccion_aval" type="text" size="35" value="<?php echo $direccion_aval?>" /></td>
          </tr>
        </table>
        </fieldset></td>
        <td height="19" bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td width="473" valign="top" bgcolor="#FFE7D7" class="Estilo12">Tipo de Auxiliar
			<?php //echo "sdgh".$_REQUEST['aux'];	?>
          <select name="tAuxiliar" style="width:100px" >
		  		
			<?php
			
			if($tAuxiliar!=''){
			 if($tAuxiliar=='C') $selectC=' selected=selected ';
			 if($tAuxiliar=='P') $selectP=' selected=selected ';
			 if($tAuxiliar=='A') $selectA=' selected=selected ';
			}else{
			 if($_REQUEST['aux']=='C') $selectC=' selected=selected ';
			 if($_REQUEST['aux']=='P') $selectP=' selected=selected ';
			// if($_REQUEST['aux']=='A') $selectA=' selected=selected ';
			} 
			 
			?>	
		  
            <option <?php echo $selectC ?> value="C">Cliente</option>
            <option <?php echo $selectP ?> value="P">Proveedor</option>
            <option <?php echo $selectA ?> value="A">Cliente-Proveedor</option>
          </select>
          <label></label></td>
        <td width="473" valign="top" bgcolor="#FFE7D7" class="Estilo12">Zona:
          <select name="tZonas" style="width:100px" >
            <?php
			$resultados11 = mysql_query("select * from zonas order by codigo ",$cn); 
			while($row11=mysql_fetch_array($resultados11)){
				$se="";
				if($idzonas==$row11['codigo']){
					$se="selected";
				}
			?>
            <option <?php echo $se; ?> value="<?php echo $row11['codigo']; ?>"><?php echo $row11['codigo']."-".$row11['zona'];?></option>
            <?php
			}
			?>
          </select>
        <label></label></td>
        <td height="19" bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td height="19" colspan="2" bgcolor="#FFE7D7"><span class="Estilo12"> Cliente Lider
            <input type="checkbox" name="chklider" value="S" style="background:none; border:none"  <?php if($lider=='S'){echo "checked=checked"; }?> onclick="activarLider(this)"/>
&nbsp;&nbsp;&nbsp;Cliente  asociado a lider:
<label>
<select name="selectLider" id="selectLider" style="width:160px" <?php if($lider=='S'){echo "disabled"; }?>>
  <option value=""></option>
  <?php 
		  $strSql="select * from cliente where lider='S' ";
		  $resultado=mysql_query($strSql,$cn);
		  while($row=mysql_fetch_array($resultado)){		  		  
		  
			  if($row['codcliente']==$codlider){
			   ?>
  <option selected="selected" value="<?php echo $row['codcliente'] ?>"><?php echo $row['razonsocial'] ?></option>
  <?php 
			  }else{
			    ?>
  <option value="<?php echo $row['codcliente'] ?>"><?php echo $row['razonsocial'] ?></option>
  <?php 
		  	 }
			 
		  } ?>
</select>
</label>
        </span></td>
        <td height="19" bgcolor="#FFE7D7">&nbsp;</td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td height="19" colspan="3" bgcolor="#FFE7D7">&nbsp;</td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#FFE7D7">&nbsp;</td>
        <td colspan="3" align="right" bgcolor="#FFE7D7"><label for="Submit"></label>
            <input style="font-size:10px" type="submit" name="guardar2" value="Guardar" id="guardar2" />
            <input style="font-size:10px" type="button" name="Submit22" value="Cancelar" id="Submit22"  onclick="ocultar();" /></td>
        <td bgcolor="#FFE7D7">&nbsp;</td>
      </tr>
</table>
  pestana
    <?php 
}
}
?>