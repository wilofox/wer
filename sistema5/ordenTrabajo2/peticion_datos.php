<?php 
session_start();
include('../conex_inicial.php');

$peticion=$_REQUEST['peticion'];
$accion=$_REQUEST['accion'];
$tipoMaterial=$_REQUEST['tipoMat'];
$nummasc=$_REQUEST['nummasc'];
$valorChk=$_REQUEST['valorChk'];
$tienda=$_REQUEST['tienda'];
$act=$_REQUEST['act'];

switch($peticion){
	case "saveItems":
	
	if($accion=='insertar'){
	$codprod=explode("|",$valorChk);
		foreach ($codprod as $subkey=> $subvalue) {
			if($subvalue!="" && $subvalue!="undefined"){
			$SQLinsert="insert into materiapxptermi(num_model,producto,cantidad,tipomat,tienda,tipomov)values ('".$nummasc."','".$subvalue."','".$cantidad."','".$tipoMaterial."','".$tienda."','".$act."')";
			//echo $SQLinsert;
			mysql_query($SQLinsert,$cn);
			}
		}
	}
	if($accion=='eliminar'){
			$SQLinsert="delete from materiapxptermi where id='".$_REQUEST['id']."'";
			//echo $SQLinsert;
			mysql_query($SQLinsert,$cn);
	}
	
	$strSQL="select * from materiapxptermi where num_model='".$nummasc."' and tipomat='".$tipoMaterial."' order by id";
	$resultado=mysql_query($strSQL,$cn);
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
<?php 
	}
	break;
	case "contenedor":
	
	$CodDoc=$_REQUEST['CodDoc'];
	
	$resultado=mysql_query("select cod_prod from det_mov where cod_cab='".$CodDoc."'",$cn);
	$cont=mysql_num_rows($resultado);
	while($row=mysql_fetch_array($resultado)){
	$arrayCodProd[]=$row["cod_prod"];	
	}
	//print_r($arrayCodProd);
	//echo $cont;
	
	for($i=1;$i<=$cont;$i++){
	
	if($_SESSION['SegProdTerm']=='S'){
	$temptipomat="4";
	}else{
	$temptipomat="1";	
	}
			
	list($nroModel)=mysql_fetch_row(mysql_query("select num_model from materiapxptermi where producto='".$arrayCodProd[$i-1]."' and tipomat='$temptipomat' order by id limit 1 "));
	
	?>
	

	<table width="580" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="8">&nbsp;</td>
    <td width="544">&nbsp;</td>
    <td width="8">&nbsp;</td>
  </tr>
  <tr>
    <td height="23">&nbsp;</td>
    <td><table width="561" height="54" border="0">
      <tr>
        <td width="77" height="23"><strong>Doc Ref </strong>: </td>
        <td width="119"><?php 
		
		
		 list($serie,$numero,$doc)=mysql_fetch_row(mysql_query("select serie,Num_doc,cod_ope from cab_mov where cod_cab='".$CodDoc."' "));
		 
		 echo $doc." ".$serie."-".$numero;
		 
		?>        </td>
        <td width="45"><strong>Fecha:</strong></td>
        <td width="160"><?php echo date('d-m-Y')?>
		 <input type="hidden" name="cont"  value="<?php echo $cont ?>"/>
          <input type="hidden" name="CodDoc"  value="<?php echo $CodDoc ?>"/>
		</td>
        <td width="138"></td>
      </tr>
      <tr>
        <td height="23">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="19">&nbsp;</td>
    <td><strong><strong>
	<?php 
		  list($cantidadT)=mysql_fetch_row(mysql_query("select cantidad from det_mov where cod_cab='".$CodDoc."' order by cod_det limit 1"));
	?>
      <input name="sumaCant<?php echo $i?>" id="sumaCant<?php echo $i?>" type="text"  value="<?php echo $cantidadT?>"/>
      <strong>
      <input name="sumaCant3<?php echo $i?>" id="sumaCant3<?php echo $i?>" type="text" />
      </strong></strong></strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="70">&nbsp;</td>
    <td>
	<fieldset>
	  <legend style="color:#FF0000"> <?php echo $ProdNomEti1?>  </legend>
      <table width="536" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="38" colspan="5" ><table width="532" height="27" border="0">
				<?php 
				$strSQL="select * from materiapxptermi where num_model='".$nroModel."' and tipomat='1' order by id limit 1 ";
				$resultado=mysql_query($strSQL,$cn);
				$cont=mysql_num_rows($resultado);
				$row=mysql_fetch_array($resultado);
				?>
                <tr>
                  <td width="50">Tienda:</td>
                  <td width="299"><?php 
				  list($nom_tienda,$cod_tienda)=mysql_fetch_row(mysql_query("select des_tienda,cod_tienda from tienda where cod_tienda='".$row['tienda']."'"));
				  echo $cod_tienda."-".$nom_tienda?>
                  <input type="hidden" name="tienda<?php echo $i?>" value="<?php echo $cod_tienda; ?>" /></td>
                  <td width="75">Ttipo Mov: : </td>
                  <td width="90"><?php echo $row['tipomov'] ?>
                  <input type="hidden" name="tipomov<?php echo $i?>" value="<?php echo $row['tipomov'] ?>" /></td>
                </tr>
              </table>  </td>
          </tr>
          <tr style="background:url(../imagenes/bg_contentbase2.gif) 100%">
            <td width="76" height="18" align="center" ><span class="Estilo5">Codigo</span></td>
            <td ><span class="Estilo5">Producto</span></td>
            <td align="center" ><span class="Estilo5">Und</span></td>
            <td width="80" align="center"><span class="Estilo5">Cantidad</span></td>
            <td width="61" align="center"><span class="Estilo5">Envases</span></td>
          </tr>
		  <?php 
		  	$resultado=mysql_query($strSQL,$cn);
		  	while($row=mysql_fetch_array($resultado)){
			list($nom_prod,$nomund)=mysql_fetch_row(mysql_query("select p.nombre,u.nombre as nomund from producto p,unidades u where p.und=u.id and p.idproducto='".$row['producto']."'"));
		  ?>
          <tr style="background:url(../imagenes/sky_blue_sel.png) ">
            <td align="center"><?php echo $row['producto']?>
            <input name="codigop<?php echo $i?>[]" id="codigop<?php echo $i?>"  type="hidden" size="10" style="text-align:right" onkeydown="validarNumero(this,event)"   onkeyup="sumarCant(this)" value="<?php echo $row['producto']?>"/></td>
            <td width="262"><?php echo $nom_prod; ?></td>
            <td width="57" align="center"><?php echo $nomund?></td>
            <td align="center">
			<?php
			  list($cantidad)=mysql_fetch_row(mysql_query("select cantidad from det_mov where cod_cab='".$CodDoc."' and cod_prod='".$row['producto']."' order by cod_det limit 1"));
				
			?>
			<input name="cantMat<?php echo $i?>[]" id="cantMat<?php echo $i?>"  type="text" size="10" style="text-align:right" onkeydown="validarNumero(this,event)"   onkeyup="sumarCant(this)" value="<?php echo $cantidad?>"/></td>
            <td align="center"><input name="cantEnvases<?php echo $i?>[]" id="cantEnvases<?php echo $i?>"  type="text" size="10" style="text-align:right" onkeydown="validarNumero(this,event)" /></td>
          </tr>
          <tr>
		  <?php } ?>
		  
            <td height="18" colspan="5" bgcolor="#F5F5F5"></td>
          </tr>
      </table>
	</fieldset></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="19">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="70">&nbsp;</td>
    <td><fieldset>
      <legend style="color:#FF0000"> <?php echo $ProdNomEti2?> </legend>
      <table width="536" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="38" colspan="5" ><table width="532" height="27" border="0">
              <?php 
				$strSQL="select * from materiapxptermi where num_model='".$nroModel."' and tipomat='2'  ";
				$resultado=mysql_query($strSQL,$cn);
				$cont=mysql_num_rows($resultado);
				$row=mysql_fetch_array($resultado);
				?>
              <tr>
                <td width="50">Tienda:</td>
                <td width="299"><?php 
				  list($nom_tienda,$cod_tienda)=mysql_fetch_row(mysql_query("select des_tienda,cod_tienda from tienda where cod_tienda='".$row['tienda']."'"));
				   echo $cod_tienda."-".$nom_tienda?>
                <input type="hidden" name="tienda3<?php echo $i?>" value="<?php echo $cod_tienda; ?>" /></td>
                <td width="75">Ttipo Mov: : </td>
                <td width="90"><?php echo $row['tipomov'] ?>
                <input type="hidden" name="tipomov3<?php echo $i?>" value="<?php echo $row['tipomov'] ?>" /></td>
              </tr>
          </table></td>
        </tr>
        <tr style="background:url(../imagenes/bg_contentbase2.gif) 100%">
          <td width="75" height="18" align="center" ><span class="Estilo5">Codigo</span></td>
          <td ><span class="Estilo5">Producto</span></td>
          <td align="center" ><span class="Estilo5">Und</span></td>
          <td width="82" align="center"><span class="Estilo5">Cantidad</span></td>
          <td width="60" align="center"><span class="Estilo5">Envases</span></td>
        </tr>
        <?php 
		  	$resultado=mysql_query($strSQL,$cn);
		  	while($row=mysql_fetch_array($resultado)){
			list($nom_prod,$nomund)=mysql_fetch_row(mysql_query("select p.nombre,u.nombre as nomund from producto p,unidades u where p.und=u.id and p.idproducto='".$row['producto']."'"));
		  ?>
        <tr >
          <td align="center"><?php echo $row['producto']?>
          <input name="codigop3<?php echo $i?>[]" id="codigop3<?php echo $i?>"  type="hidden" size="10" style="text-align:right" value="<?php echo $row['producto']?>"/></td>
          <td width="267"><?php echo $nom_prod; ?></td>
          <td width="52" align="center"><?php echo $nomund?></td>
          <td align="center"><input name="cantMat3<?php echo $i?>[]" id="cantMat3<?php echo $i?>"  type="text" size="10" style="text-align:right" onkeydown="validarNumero(this,event)"   onkeyup="sumarCant3(this)"/>
		  </td>
          <td align="center"><input name="cantEnvases3<?php echo $i?>[]" id="cantEnvases3<?php echo $i?>"  type="text" size="10" style="text-align:right" onkeydown="validarNumero(this,event)" /></td>
        </tr>
        <tr>
          <?php } ?>
          <td height="18" colspan="5" bgcolor="#F5F5F5"></td>
        </tr>
      </table>
    </fieldset></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="19">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="70">&nbsp;</td>
    <td><fieldset>
      <legend style="color:#FF0000"> <?php echo $ProdNomEti3?> </legend>
      <table width="536" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="38" colspan="5" ><table width="532" height="27" border="0">
              <?php 
				$strSQL="select * from materiapxptermi where num_model='".$nroModel."' and tipomat='3'  ";
				$resultado=mysql_query($strSQL,$cn);
				$cont=mysql_num_rows($resultado);
				$row=mysql_fetch_array($resultado);
				?>
              <tr>
                <td width="50">Tienda:</td>
                <td width="299"><?php 
				  list($nom_tienda)=mysql_fetch_row(mysql_query("select des_tienda from tienda where cod_tienda='".$row['tienda']."'"));
				  echo $nom_tienda?></td>
                <td width="75">Ttipo Mov: : </td>
                <td width="90"><?php echo $row['tipomov'] ?></td>
              </tr>
          </table></td>
        </tr>
        <tr style="background:url(../imagenes/bg_contentbase2.gif) 100%">
          <td width="76" height="18" align="center" ><span class="Estilo5">Codigo</span></td>
          <td ><span class="Estilo5">Producto</span></td>
          <td align="center" ><span class="Estilo5">Und</span></td>
          <td width="68" align="center"><span class="Estilo5">Cantidad</span></td>
          <td width="57" align="center"><span class="Estilo5">Envases</span></td>
        </tr>
        <?php 
		  	$resultado=mysql_query($strSQL,$cn);
		  	while($row=mysql_fetch_array($resultado)){
			list($nom_prod,$nomund)=mysql_fetch_row(mysql_query("select p.nombre,u.nombre as nomund from producto p,unidades u where p.und=u.id and p.idproducto='".$row['producto']."'"));
			
			$strSQLpt="select sum(d.cantidad) as cant,sum(d.envases) as envases from det_mov d,referencia r  where d.cod_prod='".$row['producto']."' and r.cod_cab='".$CodDoc."' and d.cod_cab=r.cod_cab_ref ";
			
			$resultadopt=mysql_query($strSQLpt,$cn);
			$rowpt=mysql_fetch_array($resultadopt);
			
		  ?>
        <tr >
          <td align="center"><?php echo $row['producto']?></td>
          <td width="280"><?php echo $nom_prod; ?></td>
          <td width="55" align="center"><?php echo $nomund?></td>
          <td align="center"><!--<input name="cantMat1_3" id="cantMat1_3"  type="text" size="10" style="text-align:right" onKeyDown="validarNumero(this,event)"/>-->
          <?php echo $rowpt['cant']; ?></td>
          <td align="center"><?php echo $rowpt['envases']; ?></td>
        </tr>
        <tr>
          <?php } ?>
          <td height="18" colspan="5" bgcolor="#F5F5F5"></td>
        </tr>
      </table>
    </fieldset></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="19">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td height="70">&nbsp;</td>
    <td><fieldset>
      <legend style="color:#FF0000"><?php echo $ProdNomEti4?></legend>
      <table width="536" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="38" colspan="5" ><table width="532" height="27" border="0">
              <?php 
				$strSQL="select * from materiapxptermi where num_model='".$nroModel."' and tipomat='4'  ";
				$resultado=mysql_query($strSQL,$cn);
				$cont=mysql_num_rows($resultado);
				$row=mysql_fetch_array($resultado);
				?>
              <tr>
                <td width="50">Tienda:</td>
                <td width="299"><?php 
				  list($nom_tienda)=mysql_fetch_row(mysql_query("select des_tienda from tienda where cod_tienda='".$row['tienda']."'"));
				  echo $nom_tienda?></td>
                <td width="75">Ttipo Mov: : </td>
                <td width="90"><?php echo $row['tipomov'] ?></td>
              </tr>
          </table></td>
        </tr>
        <tr style="background:url(../imagenes/bg_contentbase4.gif) 100%">
          <td width="77" height="18" align="center" ><span class="Estilo5">Codigo</span></td>
          <td ><span class="Estilo5">Producto</span></td>
          <td align="center" ><span class="Estilo5">Und</span></td>
          <td width="64" align="center"><span class="Estilo5">Cantidad</span></td>
          <td width="60" align="center"><span class="Estilo5">Envases</span></td>
        </tr>
        <?php 
		  	$resultado=mysql_query($strSQL,$cn);
		  	while($row=mysql_fetch_array($resultado)){
			list($nom_prod,$nomund)=mysql_fetch_row(mysql_query("select p.nombre,u.nombre as nomund from producto p,unidades u where p.und=u.id and p.idproducto='".$row['producto']."'"));
			
			
			$strSQLpt="select sum(d.cantidad) as cant,sum(d.envases) as envases from det_mov d,referencia r  where d.cod_prod='".$row['producto']."' and r.cod_cab='".$CodDoc."' and d.cod_cab=r.cod_cab_ref ";
			
			$resultadopt=mysql_query($strSQLpt,$cn);
			$rowpt=mysql_fetch_array($resultadopt);
			//echo $rowpt['cant']."<br>";
			
		  ?>
        <tr >
          <td align="center"><?php echo $row['producto']?></td>
          <td width="285"><?php echo $nom_prod; ?></td>
          <td width="50" align="center"><?php echo $nomund?></td>
          <td align="center">
		<!--  <input name="cantMat1_3" id="cantMat1_3"  type="text" size="10" style="text-align:right" onkeydown="validarNumero(this,event)" readonly="readonly"/>--><?php echo $rowpt['cant']; ?>		  </td>
          <td align="center"><?php echo $rowpt['envases']; ?></td>
        </tr>
        <tr>
          <?php } ?>
          <td height="18" colspan="5" bgcolor="#F5F5F5"></td>
        </tr>
      </table>
    </fieldset></td>
    <td>&nbsp;</td>
  </tr>
</table>
	|
		<?php 
		}
	break;
		
	case "Anular":
		
	$codigo=$_REQUEST['codDoc'];	
	$accion=$_REQUEST['accion'];	
	
	$strSQL="select * from referencia where cod_cab='".$codigo."'";
	$resultado=mysql_query($strSQL,$cn);
	$cont=mysql_num_rows($resultado);
	if($accion=='A'){
		if($cont==0){
		$strSQL1="update cab_mov set flag='A',estadoOT='' where cod_cab='$codigo'";
		mysql_query($strSQL1,$cn);
		}else{
		echo "N";	
		}
	}else{
	$strSQL1="update cab_mov set flag='',estadoOT='P' where cod_cab='$codigo'";
	mysql_query($strSQL1,$cn);
	}	
	//echo $strSQL1;
	break;
	
	case "eliminar_Entregas":
		
	$codigo=$_REQUEST['codDoc'];	
	$accion=$_REQUEST['accion'];	
	
	$strSQL="select * from det_mov d,cab_mov c where d.cod_cab='".$codigo."' and c.cod_cab=d.cod_cab";
	$resultado=mysql_query($strSQL,$cn);
	while($row=mysql_fetch_array($resultado)){
	$campo="saldo".$row['tienda'];
	$flag_kardex=$row['flag_kardex'];
		if($row['kardex']=='S'){
			if($flag_kardex=='1'){
			$srtSQLupd="update producto set $campo=$campo-".$row['cantidad']." where idproducto='".$row['idproducto']."'";
			}else{
			$srtSQLupd="update producto set $campo=$campo+".$row['cantidad']." where idproducto='".$row['idproducto']."'";			
			}
			mysql_query($srtSQLupd,$cn);		
		}
	}
		

		$strSQL1="delete from cab_mov where cod_cab='$codigo'";
		mysql_query($strSQL1,$cn);
		$strSQL1="delete from det_mov where cod_cab='$codigo'";
		mysql_query($strSQL1,$cn);
		$strSQL1="delete from referencia where cod_cab_ref='$codigo'";
		mysql_query($strSQL1,$cn);
		

	//echo $strSQL1;
	break;
	
	case "contenedor2":
	
	$CodDoc=$_REQUEST['CodDoc'];
	
	$resultado=mysql_query("select cod_prod from det_mov where cod_cab='".$CodDoc."'",$cn);
	$cont=mysql_num_rows($resultado);
	while($row=mysql_fetch_array($resultado)){
	$arrayCodProd[]=$row["cod_prod"];	
	}
	//print_r($arrayCodProd);
	//echo $cont;
	
	
			
	for($i=1;$i<=$cont;$i++){		
	list($nroModel)=mysql_fetch_row(mysql_query("select num_model from materiapxptermi where producto='".$arrayCodProd[$i-1]."' and tipomat='1' order by id limit 1 "));	
	
	list($nom_prod,$idproducto)=mysql_fetch_row(mysql_query("select nombre,idproducto from producto where idproducto='".$arrayCodProd[$i-1]."'"));
	?>
	<table width="580" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="8">&nbsp;</td>
    <td width="544">&nbsp;</td>
    <td width="8">&nbsp;</td>
  </tr>
  <tr>
    <td height="23">&nbsp;</td>
    <td><table width="561" height="54" border="0">
      <tr>
        <td width="77" height="23"><strong>Doc Ref </strong>: </td>
        <td width="119"><?php 
		
		
		 list($serie,$numero,$doc,$cliente)=mysql_fetch_row(mysql_query("select serie,Num_doc,cod_ope,cliente from cab_mov where cod_cab='".$CodDoc."' "));
		 
		 echo $doc." ".$serie."-".$numero;
		 
		?>        </td>
        <td width="45"><strong>Fecha:</strong></td>
        <td width="160"><?php echo date('d-m-Y')?>
          <input type="hidden" name="cont"  value="<?php echo $cont ?>"/>
          <input type="hidden" name="CodDoc"  value="<?php echo $CodDoc ?>"/></td>
        <td width="138">&nbsp;</td>
      </tr>
      <tr>
        <td height="23"><strong>Cliente: </strong></td>
        <td colspan="4">
		<?php 
			 list($nomcliente)=mysql_fetch_row(mysql_query("select razonsocial from cliente where codcliente='".$cliente."' "));
			 echo $nomcliente;
		?>		</td>
        </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td height="19">&nbsp;</td>
    <td><strong>&nbsp;</strong><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#0066FF"><strong><?php //echo $idproducto." - ".$nom_prod?>
      <input type="hidden" name="matpri<?php echo $i?>" value="<?php echo $idproducto; ?>" />
      <strong>
      <input name="sumaCant<?php echo $i?>" id="sumaCant<?php echo $i?>" type="hidden" />
      <strong>
      <input name="sumaCant3<?php echo $i?>" id="sumaCant3<?php echo $i?>" type="hidden" />
    </strong></strong></strong></span></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td height="70">&nbsp;</td>
    <td>
		<fieldset>
	  <legend style="color:#FF0000"> <?php echo $ProdNomEti1?>  </legend>
      <table width="536" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="38" colspan="4" ><table width="532" height="27" border="0">
				<?php 
				$strSQL="select * from materiapxptermi where num_model='".$nroModel."' and tipomat='1' order by id limit 1 ";
				$resultado=mysql_query($strSQL,$cn);
				$cont=mysql_num_rows($resultado);
				$row=mysql_fetch_array($resultado);
				?>
                <tr>
                  <td width="50">Tienda:</td>
                  <td width="299"><?php 
				  list($nom_tienda)=mysql_fetch_row(mysql_query("select des_tienda from tienda where cod_tienda='".$row['tienda']."'"));
				  echo $nom_tienda?></td>
                  <td width="75">Ttipo Mov: : </td>
                  <td width="90"><?php echo $row['tipomov'] ?></td>
                </tr>
              </table>  </td>
          </tr>
          <tr style="background:url(../imagenes/bg_contentbase2.gif) 100%">
            <td width="86" height="18" align="center" ><span class="Estilo5">Codigo</span></td>
            <td ><span class="Estilo5">Producto</span></td>
            <td align="center" ><span class="Estilo5">Und</span></td>
            <td width="62" align="center"><span class="Estilo5">Cantidad</span></td>
          </tr>
		  <?php 
		  	$resultado=mysql_query($strSQL,$cn);
		  	while($row=mysql_fetch_array($resultado)){
			list($nom_prod,$nomund)=mysql_fetch_row(mysql_query("select p.nombre,u.nombre as nomund from producto p,unidades u where p.und=u.id and p.idproducto='".$row['producto']."'"));
		  ?>
          <tr style="background:url(../imagenes/sky_blue_sel.png) ">
            <td height="23" align="center"><?php echo $row['producto']?></td>
            <td width="336"><strong><?php echo $nom_prod; ?></strong></td>
            <td width="52" align="center"><?php echo $nomund?></td>
            <td align="center">
			<?php
			  list($cantidad)=mysql_fetch_row(mysql_query("select cantidad from det_mov where cod_cab='".$CodDoc."' and cod_prod='".$row['producto']."' order by cod_det limit 1"));
				echo $cantidad;
			?>			</td>
          </tr>
          <tr>
		  <?php } ?>
		  
            <td height="18" colspan="4" bgcolor="#F5F5F5"></td>
          </tr>
      </table>
	</fieldset>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="70">&nbsp;</td>
    <td>
	<fieldset>
      <legend style="color:#FF0000"> <?php echo $ProdNomEti3?> </legend>
      <table width="536" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="38" colspan="5" ><table width="532" height="27" border="0">
              <?php 
				$strSQL="select * from materiapxptermi where num_model='".$nroModel."' and tipomat='3'  ";
				$resultado=mysql_query($strSQL,$cn);
				$cont=mysql_num_rows($resultado);
				$row=mysql_fetch_array($resultado);
				?>
              <tr>
                <td width="50">Tienda:</td>
                <td width="299"><?php 
				  list($nom_tienda,$cod_tienda)=mysql_fetch_row(mysql_query("select des_tienda,cod_tienda from tienda where cod_tienda='".$row['tienda']."'"));
				  echo $nom_tienda?>
                <input type="hidden" name="tienda3<?php echo $i?>" value="<?php echo $cod_tienda; ?>" /></td>
                <td width="75">Ttipo Mov: : </td>
                <td width="90"><?php echo $row['tipomov'] ?>
                <input type="hidden" name="tipomov3<?php echo $i?>" value="<?php echo $row['tipomov'] ?>" /></td>
              </tr>
          </table></td>
        </tr>
        <tr style="background:url(../imagenes/bg_contentbase2.gif) 100%">
          <td width="76" height="18" align="center" ><span class="Estilo5">Codigo</span></td>
          <td ><span class="Estilo5">Producto</span></td>
          <td align="center" ><span class="Estilo5">Und</span></td>
          <td width="77" align="center"><span class="Estilo5">Cantidad</span></td>
          <td width="63" align="center"><span class="Estilo5">Envases</span></td>
        </tr>
        <?php 
		  	$resultado=mysql_query($strSQL,$cn);
		  	while($row=mysql_fetch_array($resultado)){
			list($nom_prod,$nomund)=mysql_fetch_row(mysql_query("select p.nombre,u.nombre as nomund from producto p,unidades u where p.und=u.id and p.idproducto='".$row['producto']."'"));
		  ?>
        <tr >
          <td align="center"><?php echo $row['producto']?>
          <input name="codigop3<?php echo $i?>[]" id="codigop3<?php echo $i?>"  type="hidden" size="10" style="text-align:right" value="<?php echo $row['producto']?>"/></td>
          <td width="271"><?php echo $nom_prod; ?></td>
          <td width="49" align="center"><?php echo $nomund?></td>
          <td align="center"><input name="cantMat3<?php echo $i?>[]" id="cantMat3<?php echo $i?>"  type="text" size="10" style="text-align:right" onkeydown="validarNumero(this,event)"   onkeyup="sumarCant3(this)"/></td>
          <td align="center"><input name="cantEnvases3<?php echo $i?>[]" id="cantEnvases3<?php echo $i?>"  type="text" size="10" style="text-align:right" onkeydown="validarNumero(this,event)"></td>
        </tr>
        <tr>
          <?php } ?>
          <td height="18" colspan="5" bgcolor="#F5F5F5"></td>
        </tr>
      </table>
    </fieldset>
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="70">&nbsp;</td>
    <td><fieldset>
      <legend style="color:#FF0000"> Producto Terminado </legend>
      <table width="536" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="38" colspan="5" ><table width="532" height="27" border="0">
              <?php 
				$strSQL="select * from materiapxptermi where num_model='".$nroModel."' and tipomat='4'  ";
				$resultado=mysql_query($strSQL,$cn);
				$cont=mysql_num_rows($resultado);
				$row=mysql_fetch_array($resultado);
				?>
              <tr>
                <td width="50">Tienda:</td>
                <td width="299"><?php 
				  list($nom_tienda,$cod_tienda)=mysql_fetch_row(mysql_query("select des_tienda,cod_tienda from tienda where cod_tienda='".$row['tienda']."'"));
				  echo $cod_tienda."-".$nom_tienda?>
                <input type="hidden" name="tienda<?php echo $i?>" value="<?php echo $cod_tienda; ?>" /></td>
                <td width="75">Ttipo Mov: : </td>
                <td width="90"><?php echo $row['tipomov'] ?>
                <input type="hidden" name="tipomov<?php echo $i?>" value="<?php echo $row['tipomov'] ?>" /></td>
              </tr>
          </table></td>
        </tr>
        <tr style="background:url(../imagenes/bg_contentbase4.gif) 100%">
          <td width="76" height="18" align="center" ><span class="Estilo5">Codigo</span></td>
          <td ><span class="Estilo5">Producto</span></td>
          <td align="center" ><span class="Estilo5">Und</span></td>
          <td width="79" align="center"><span class="Estilo5">Cantidad</span></td>
          <td width="61" align="center"><span class="Estilo5">Envases</span></td>
        </tr>
        <?php 
		  	$resultado=mysql_query($strSQL,$cn);
		  	while($row=mysql_fetch_array($resultado)){
			list($nom_prod,$nomund)=mysql_fetch_row(mysql_query("select p.nombre,u.nombre as nomund from producto p,unidades u where p.und=u.id and p.idproducto='".$row['producto']."'"));
		  ?>
        <tr >
          <td align="center"><?php echo $row['producto']?>
          <input name="codigop<?php echo $i?>[]" id="codigop<?php echo $i?>"  type="hidden" size="10" style="text-align:right" onkeydown="validarNumero(this,event)"   onkeyup="sumarCant(this)" value="<?php echo $row['producto']?>"/></td>
          <td width="272"><?php echo $nom_prod; ?></td>
          <td width="48" align="center"><?php echo $nomund?></td>
          <td align="center">
		 <input name="cantMat<?php echo $i?>[]" id="cantMat<?php echo $i?>"  type="text" size="10" style="text-align:right" onkeydown="validarNumero(this,event)"   onkeyup="sumarCant(this)"/> 		 </td>
          <td align="center">
		  <input name="cantEnvases<?php echo $i?>[]" id="cantEnvases<?php echo $i?>"  type="text" size="10" style="text-align:right" onkeydown="validarNumero(this,event)" /></td>
        </tr>
        <tr>
          <?php } ?>
          <td height="18" colspan="5" bgcolor="#F5F5F5"></td>
        </tr>
      </table>
    </fieldset></td>
    <td>&nbsp;</td>
  </tr>
</table>
	|
	
	<?php
	}
	break;
		
}
	 ?>
