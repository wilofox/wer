<?
session_start();
include_once('../conex_inicial.php');
include('../funciones/funciones.php');
include('../administracion/miclase.php');
$clase= new miclase('s');

$tipo=$_REQUEST['tipo'];
$codigo=$_REQUEST['codigo'];	


if ($_REQUEST['Accion']=='G'){
	if ($tipo=='Editar'){
echo	$strSQLG="update procesos set alias='".$_REQUEST['proceso1']."',descripcion='".$_REQUEST['proceso2']."',cen_costo='".$_REQUEST['proceso3']."',tiempo='".$_REQUEST['proceso4']."',moneda='".$_REQUEST['proceso5']."',costo='".$_REQUEST['proceso6']."' where cod_proceso='$codigo'";
	}else{
echo	$strSQLG="INSERT INTO procesos VALUES (NULL ,'".$_REQUEST['proceso1']."','".$_REQUEST['proceso2']."',".$_REQUEST['proceso3'].",'".$_REQUEST['proceso4']."','".$_REQUEST['proceso5']."',".$_REQUEST['proceso6'].")";
	}
mysql_query($strSQLG,$cn);

}

 $strSQL="select * from procesos"; 	
					$campo1="cod_proceso";
					$campo2="alias";
					//$campo3="descripcion";    
					$campo3="cen_costo";
					$campo4="tiempo";
					$campo5="moneda";    
					$campo6="costo";    
		
?>

<table width="500" border="0" bgcolor="#FFFFFF" style="border:#8BB1F8 solid 1px; background:#E3F4F9;">
  <tr  style="background:url(../imagenes/aqua-hd-bg.gif)" >
    <td width="10" height="21">&nbsp;</td>
    <td width="576" align="center" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#000000"><b>Procesos</b></td>
    <td width="10" onclick="salir();"><font face="Arial, Helvetica, sans-serif" style="text-decoration:underline; font-size:11px; cursor:pointer" color="#0033FF"><strong>x</strong></font
	></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
<? if($tipo=='Listado'){ 
?>
<table width="440" border="0" align="left" cellpadding="0" cellspacing="0">
                        <?php 
				$regvis=100;
				$pag=$_REQUEST['pag'];
				
				if($pag>=1) {
				$inicio=($pag-1)*$regvis;
				}else{
				$inicio=0;
				$pag=1;
				}
				$totalreg=mysql_num_rows(mysql_query($strSQL,$cn));
				//$resultado = mysql_query($strSQL." limit ".$inicio.",".$regvis,$cn);
				$Resul = mysql_query($strSQL,$cn);
				//echo $strSQL." limit ".$inicio.",".$regvis;
			
			//$resultado=mysql_query($strSQL,$cn);
			$i=1;
			while($row=mysql_fetch_array($Resul)){
				$bgcolor="#F4F4F4";
				if($i%2==0){
				$bgcolor="#FFFFFF";
				}
			?>
                        <tr bgcolor="<?php echo $bgcolor;?>"  onmouseover="entrada(this)" onmouseout="entrada(this)" >
                          <td height="18" width="30" align="center" style="border-bottom:#E5E5E5 solid 1px" ><?php echo $row[$campo1]?></td>
                          <td width="136" style="border-bottom:#E5E5E5 solid 1px; color:#333333; "><span style="border-bottom:#E5E5E5 solid 1px"> <a href="#"  onclick="sel_chofer('<?php echo $row[$campo1]?>','<?php echo $row[$campo2] ?>','<?php echo $row[$campo5] ?>')" ><?php echo $row[$campo2]?></a>
                          </span></td>
                          <td width="86" style="border-bottom:#E5E5E5 solid 1px" ><?php 
						$strSQL="select * from centro_costo where id 	='".$row[$campo3]."' ";
						$resultado=mysql_query($strSQL,$cn);
						$rowC=mysql_fetch_array($resultado);
						echo $rowC['ccosto'];
						 // echo $row[$campo3]?></td>
                          <td width="57" style="border-bottom:#E5E5E5 solid 1px" ><?php echo $row[$campo4]?>&nbsp;</td>
                          <td width="35" align="center" style="border-bottom:#E5E5E5 solid 1px"><?php 
						  if ($row[$campo5]=='01'){
						  echo 'S./';
						  }else{
						  echo 'US$.';
						  }
						  //echo $row[$campo5]?></td>
                          <td width="66" align="center" style="border-bottom:#E5E5E5 solid 1px"><?php echo $row[$campo6]?></td>
                          <td width="30" align="center" style="border-bottom:#E5E5E5 solid 1px"><a href="#" onClick="javascript:Proceso('Editar',<?=$row[$campo1];?>)" ><img src="../imgenes/ico_edit.gif" alt="Editar" width="16" height="16" border="0"></a></td>
                        </tr>
                        <?php 
			  $i++;
			}
			?>
                      </table>
<? }?>	

<? 
//echo $tipo;  
if($tipo=='LisModelo'){ ?>	
	
	<table width="100%" border="0">
      <tr>
        <td width="460">
		<table width="100%" border="0">
          <tr>
            <td width="71%">Busqueda
              <input type="text" name="valor_chofer"  id="valor_chofer" onKeyUp="busqueda_procesos()"/>
              <img src="../imagenes/ico_lupa.png" width="15" height="15" /> </td>
            <td width="29%"><div align="right">
              <table width="73" height="21" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" title="Nuevo">
                <tr onMouseOver="entrar_btn(this);" onMouseOut="salir_btn(this)" style="cursor:pointer" onClick="javascript:Proceso('Nuevo',this)">
                  <td width="2" ></td>
                  <td width="16" align="center" ><span class="Estilo33"><img src="../imagenes/nuevo.gif" width="14" height="16"></span></td>
                  <td width="51" ><span class="Estilo33">Nuevo</span></td>
                  <td width="4" ></td>
                </tr>
              </table>
            </div></td>
          </tr>
        </table>
		</td>
        </tr>
      <tr>
        <td><table width="100%" border="0">
          <tr  style="background:url(../imagenes/bg_contentbase2.gif); background-position:100px 60px" >
            <td width="26" height="18" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Cod.</strong></td>
            <td width="134" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Alias</strong></td>
            <td width="79" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Cent. Costo </strong></td>
            <td width="66" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Tiempo</strong></td>
            <td width="25" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Mon</strong></td>
            <td width="71" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong>Costo</strong></td>
            <td width="39" style="font:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF"><strong></strong></td>
          </tr>
          <tr>
            <td colspan="7">
			<div  id="detalle_chofer" style="width:100%; height:135px; overflow-y:scroll">
					  <table width="440" border="0" align="left" cellpadding="0" cellspacing="0">
                        <?php 
				$regvis=100;
				$pag=$_REQUEST['pag'];
				
				if($pag>=1) {
				$inicio=($pag-1)*$regvis;
				}else{
				$inicio=0;
				$pag=1;
				}
				$totalreg=mysql_num_rows(mysql_query($strSQL,$cn));
				//$resultado = mysql_query($strSQL." limit ".$inicio.",".$regvis,$cn);
				$Resul = mysql_query($strSQL,$cn);
				//echo $strSQL." limit ".$inicio.",".$regvis;
			
			//$resultado=mysql_query($strSQL,$cn);
			$i=1;
			while($row=mysql_fetch_array($Resul)){
				$bgcolor="#F4F4F4";
				if($i%2==0){
				$bgcolor="#FFFFFF";
				}
			?>
                        <tr bgcolor="<?php echo $bgcolor;?>"  onmouseover="entrada(this)" onmouseout="entrada(this)" >
                          <td height="18" width="30" align="center" style="border-bottom:#E5E5E5 solid 1px" ><?php echo $row[$campo1]?></td>
                          <td width="136" style="border-bottom:#E5E5E5 solid 1px; color:#333333; "><span style="border-bottom:#E5E5E5 solid 1px"> <a href="#"  onclick="sel_chofer('<?php echo $row[$campo1]?>','<?php echo $row[$campo2] ?>','<?php echo $row[$campo5] ?>')" ><?php echo $row[$campo2]?></a>
                          </span></td>
                          <td width="86" style="border-bottom:#E5E5E5 solid 1px" ><?php 
						$strSQL="select * from centro_costo where id 	='".$row[$campo3]."' ";
						$resultado=mysql_query($strSQL,$cn);
						$rowC=mysql_fetch_array($resultado);
						echo $rowC['ccosto'];
						 // echo $row[$campo3]?></td>
                          <td width="57" style="border-bottom:#E5E5E5 solid 1px" ><?php echo $row[$campo4]?>&nbsp;</td>
                          <td width="35" align="center" style="border-bottom:#E5E5E5 solid 1px"><?php 
						  if ($row[$campo5]=='01'){
						  echo 'S./';
						  }else{
						  echo 'US$.';
						  }
						  //echo $row[$campo5]?></td>
                          <td width="66" align="center" style="border-bottom:#E5E5E5 solid 1px"><?php echo $row[$campo6]?></td>
                          <td width="30" align="center" style="border-bottom:#E5E5E5 solid 1px"><a href="#" onClick="javascript:Proceso('Editar',<?=$row[$campo1];?>)" ><img src="../imgenes/ico_edit.gif" alt="Editar" width="16" height="16" border="0"></a></td>
                        </tr>
                        <?php 
			  $i++;
			}
			?>
                      </table>
				  </div>			</td>
            </tr>
          <tr>
            <td colspan="7"><div id="divpagina">
	<?php 
		$clase->paginar($totalreg,$pag,$regvis);
	?>
	</div></td>
            </tr>
        </table></td>
        </tr>
    </table>
	<? }else{
	
	$strSQLP="select * from procesos where cod_proceso='".$codigo."' ";
	$resultadoP=mysql_query($strSQLP,$cn);
	$rowP=mysql_fetch_array($resultadoP);
	
	 ?>
	<table border="0">
      <tr>
        <td><div align="right"><span class="Estilo1">Alias : </span></div></td>
        <td colspan="3">
		<input name="proceso1" type="text" id="proceso1" value="<?=$rowP['alias'];?>" />		
		</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><div align="right"><span class="Estilo1">Descipción : </span></div></td>
        <td colspan="4" rowspan="2"><textarea name="proceso2" cols="40" id="proceso2"><?=$rowP['descripcion'];?></textarea>          
        <label></label></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td><div align="right"><span class="Estilo1">Centro de Costo  : </span></div></td>
        <td>   
		<select name="proceso3" id="proceso3" style="width:120px">
		<?php 
		
 			 $resultados1 = mysql_query("select * from centro_costo order by ccosto ",$cn); 
			while($row1=mysql_fetch_array($resultados1))
			{
		if ($row1['id']==$rowP['cen_costo']){
		?>
		 <option value="<?php echo $row1['id'] ?>" selected><?php echo $row1['ccosto']; ?></option>
		<?
		}else{
		?>
		 <option value="<?php echo $row1['id'] ?>"><?php echo $row1['ccosto']; ?></option>
		<?
		}
			 }?>
          </select>
        </span></td>
        <td>&nbsp;</td>
        <td><div align="right"><span class="Estilo1">Tiempo :</span></div></td>
        <td><input name="proceso4" type="text" id="proceso4" value="<?=$rowP['tiempo'];?>" size="10" /></td>
      </tr>
      <tr>
        <td><div align="right"><span class="Estilo1">Moneda : </span></div></td>
        <td><span class="Estilo12">
          <select name="proceso5" id="proceso5">
		  <? if ($rowP['moneda']=='02'){
		  $selec='selected';
		  }else{
		  $selec='';
		  }?>
            <option value="01">SOLES (S/.)</option>
            <option value="02" <?=$selec;?>>DOLARES (US$.)</option>
            <script>
	   var valor1="<?php echo $moneda?>";
     var i;
	 for (i=0;i<document.form1.moneda.options.length;i++)
        {
		
            if (document.form1.moneda.options[i].value==valor1)
               {
			   
               document.form1.moneda.options[i].selected=true;
               }
        
        }
	      </script>
          </select>
        </span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><div align="right"><span class="Estilo1">Costo : </span></div></td>
        <td><input name="proceso6" type="text" id="proceso6" value="<?=$rowP['costo'];?>" size="10" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
	<div style="padding-left:55px; padding-top:10px;">
	<?
	if ($tipo=='Editar'){
	?>
	<input type="button" name="Submit2" value="Guardar(F2)" onclick="GuardarProceso('<?=$tipo;?>',<?=$codigo;?>);salir();"/></div>
	<?
	}else{
	?>
	<input type="button" name="Submit2" value="Guardar(F2)" onclick="GuardarProceso('<?=$tipo;?>','');salir();"/>
	<?
	}
	 ?>
	 </div>
	 <?
	} ?>
	
	
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

