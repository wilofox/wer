<?php
include('conex_inicial.php');

$mostrar=$_REQUEST['mostrar'];

switch($mostrar){
	case 'docu':
		if($_REQUEST['tdoc']=="0"){
			$filtro_doc="";
			$tit="chkTodos[]";
			$tip="Todos";
		}else{
			$filtro_doc=" where tipo='".$_REQUEST['tdoc']."'";
			switch($_REQUEST['tdoc']){
				case '1':$tit="chkIngresos[]";$tip="Ingresos";break;
				case '2':$tit="chkSalidas[]";$tip="Salidas";break;
			}
		} ?>
		<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><fieldset><br>
				<legend>Selecci&oacute;n de documentos <?php echo $tip?></legend>
				<table width="250px" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="125"><div style="overflow-y:scroll;height:110px">
						<table  id="tblIn" border="0" cellspacing="1" cellpadding="1">
						<tr>
							<td width="32" align="center" bgcolor="#0066CC"><span class="Estilo24">ok</span></td>
							<td width="38" align="center" bgcolor="#0066CC"><span class="Estilo24">CD</span></td>
							<td width="194" bgcolor="#0066CC"><span class="Estilo25">Descripcion</span></td>
						</tr>
						<?php 
						$strSQl="select * from operacion $filtro_doc";
						$resultado=mysql_query($strSQl,$cn);
						while($row=mysql_fetch_array($resultado)){?>
						<tr>
							<td height="20" align="center" bgcolor="#F5F5F5"><input name="<?php echo $tit?>" id="<?php echo $tip?>" type="checkbox" style="background:none; border:none" value="<?php echo $row['codigo']?>"/></td>
							<td align="center" bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row['codigo']?></span></td>
							<td bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row['descripcion']?></span></td>
						</tr>
						<?php }?>
					</table>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					</div></td>
				</tr>
				</table>
				</fieldset></td>
			</tr>
			<tr>
				<td><input id="GrupoOpciones1" name="GrupoOpciones1"  style="background:none; border:none"  type="radio" value="todos"  onClick="marcar(this)">Marcar todos
				<input id="GrupoOpciones1" name="GrupoOpciones1" style="background:none; border:none" checked="checked" type="radio" value="ninguno"  onClick="marcar(this)">Desmarcar todos </td>
			</tr>
		</table>
		<?php break;
	case 'aux':
		if($_REQUEST['tipoaux']=="1"){
			$tcl=" tipo_aux in ('P','A')";
			$tit=" Proveedores";
		}else{
			$tcl=" tipo_aux in ('C','A')";
			$tit=" Clientes";
		}
		$valor=$_REQUEST['valor'];
		if($valor=='' && $_REQUEST['tbus']=='codcliente'){
			$filtro_b="";
		}else{
			switch($_REQUEST['tbus']){
				case 'codcliente':$valor_b="='".str_pad($valor,6,"0",STR_PAD_LEFT)."' ";break;
				case 'razonsocial':$valor_b=" like '%".$valor."%'";break;
				case 'ruc':$valor_b=" like '".$valor."%'";break;
			}
			$filtro_b=" and ".$_REQUEST['tbus'].$valor_b;
		}
		$orden=" order by ".$_REQUEST['tbus'];?>
		<table border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td><br><legend>Selecci&oacute;n de <?php echo $tit?></legend>
				<table width="480px" border="1" cellspacing="0" cellpadding="0">
					<tr>
						<td height="150"><div style="overflow-y:scroll;height:110px">
						<table  id="tblIn" border="0" cellspacing="1" cellpadding="1">
							<tr>
								<td width="32" align="center" bgcolor="#0066CC"><span class="Estilo24">ok</span></td>
								<td width="38" align="center" bgcolor="#0066CC"><span class="Estilo24">Codigo</span></td>
								<td width="300" bgcolor="#0066CC"><span class="Estilo25">Raz&oacute;n Social</span></td>
                                <td width="40" bgcolor="#0066CC"><span class="Estilo25">Ruc</span></td>
                                <td width="70" bgcolor="#0066CC"><span class="Estilo25">Telefono</span></td>
							</tr>
							<?php 
							$strSQl="select * from cliente where $tcl $filtro_b $orden";
							$resultado=mysql_query($strSQl,$cn);
							while($row=mysql_fetch_array($resultado)){?>
							<tr>
								<td height="20" align="center" bgcolor="#F5F5F5"><input name="chkTodos[]" id="chkTodos" type="checkbox" style="background:none; border:none" value="<?php echo $row['codcliente']?>"/></td>
								<td align="center" bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row['codcliente']?></span></td>
								<td bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row['razonsocial']?></span></td>
                                <td bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row['ruc']?></span></td>
                                <td bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row['telefono']?></span></td>
							</tr>
							<?php }?>
						</table>
						</div></td>
					</tr>
				</table>
                </td>
			</tr>
			<tr>
				<td align="center"><input id="GrupoOpciones12" name="GrupoOpciones12"  style="background:none; border:none"  type="radio" value="todos"  onClick="marcar_d(this)"> 
				Marcar todos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				     <input id="GrupoOpciones12" name="GrupoOpciones12" style="background:none; border:none" checked="checked" type="radio" value="ninguno"  onClick="marcar_d(this)"> Desmarcar todos </td>
			</tr>
			</table>
		<?php break;
	case 'categoria':
		?>
		<table border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="345"><input id="agrrep1" name="agrrep1"  style="background:none; border:none"  type="checkbox" value="categoria" checked="checked">Agrupado por Categoria<br /><input id="agrrep2" name="agrrep2"  style="background:none; border:none"  type="checkbox" value="subcategoria">Agrupado por Sub-Categoria</td>
				</tr>
                <tr>
					<td width="345">Filtrar x Clasificaci&oacute;n: <select name="cmbClasificacion" id="cmbClasificacion" >
                    <option value="0">Todas</option> 
                    <?php
					//onchange="MostrarFiltro3(this,'categoria','subcategoria')";
					$consulta=mysql_query("Select * from clasificacion order by des_clas",$cn);
					while($rowcl=mysql_fetch_array($consulta)){
						echo "<option value='".$rowcl[0]."'> ".strtoupper($rowcl[1])."</option>";
					}
					?>
                    </select></td>
				</tr>
				<tr>
					<td><table width="346" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="346" height="124"><div id="detfil" style="overflow-y:scroll;height:110px"><table  id="tblIn" border="0" cellspacing="1" cellpadding="1">
					<tr>
						<td width="32" align="center" bgcolor="#0066CC"><span class="Estilo24">ok</span></td>
						<td width="300" bgcolor="#0066CC"><span class="Estilo25">Clasificaci&oacute;n</span></td>
					</tr>
					<?php 
						$strSQl="select * from categoria order by des_cat";
							$resultado=mysql_query($strSQl,$cn);
							while($row=mysql_fetch_array($resultado)){?>
							<tr>
							  <td height="20" align="left" bgcolor="#F5F5F5"><input name="chkTodos[]" id="Todos" type="checkbox" style="background:none; border:none" value="<?php echo $row[0]?>"/></td>
								<td align="left" bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row[1]?></span></td>
							</tr>
							<?php }?>
						</table>
		    </div></td>
					</tr>
				</table>
				</fieldset></td>
			</tr>
			<tr>
				<td align="center"><input id="GrupoOpciones12" name="GrupoOpciones12"  style="background:none; border:none"  type="radio" value="todos"  onClick="marcar_d(this)"> 
				Marcar todos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				     <input id="GrupoOpciones12" name="GrupoOpciones12" style="background:none; border:none" checked="checked" type="radio" value="ninguno"  onClick="marcar_d(this)"> Desmarcar todos </td>
			</tr>
			</table>
		<?php break;		
	case 'subcategoria':
		?>
			<table border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="345"><input id="agrrep1" name="agrrep1"  style="background:none; border:none"  type="checkbox" value="categoria">Agrupado por Categoria<br /><input id="agrrep2" name="agrrep2"  style="background:none; border:none"  type="checkbox" value="subcategoria" checked="checked">Agrupado por Sub-Categoria</td>
				</tr>
                <tr>
					<td width="345">Filtrar x Categoria: <select name="cmbCategoria" id="cmbCategoria" >
                    <option value="0">Todas</option> 
                    <?php
					//onchange="MostrarFiltro3(this,'categoria','subcategoria')";
					$consulta=mysql_query("Select * from categoria order by des_cat",$cn);
					while($rowcl=mysql_fetch_array($consulta)){
						echo "<option value='".$rowcl[0]."'> ".strtoupper($rowcl[1])."</option>";
					}
					?>
                    </select></td>
				</tr>
				<tr>
					<td><table width="346" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="346" height="124"><div id="detfil" style="overflow-y:scroll;height:110px"><table  id="tblIn" border="0" cellspacing="1" cellpadding="1">
					<tr>
						<td width="32" align="center" bgcolor="#0066CC"><span class="Estilo24">ok</span></td>
						<td width="300" bgcolor="#0066CC"><span class="Estilo25">Clasificaci&oacute;n</span></td>
					</tr>
					<?php 
						$strSQl="select * from subcategoria order by des_subcateg";
							$resultado=mysql_query($strSQl,$cn);
							while($row=mysql_fetch_array($resultado)){?>
							<tr>
								<td height="20" align="left" bgcolor="#F5F5F5"><input name="chkTodos[]" id="Todos" type="checkbox" style="background:none; border:none" value="<?php echo $row[0]?>"/></td>
								<td align="left" bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row[1]?></span></td>
							</tr>
							<?php }?>
						</table>
		    </div></td>
					</tr>
				</table>
				</fieldset></td>
			</tr>
			<tr>
				<td align="center"><input id="GrupoOpciones12" name="GrupoOpciones12"  style="background:none; border:none"  type="radio" value="todos"  onClick="marcar_d(this)"> 
				Marcar todos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				     <input id="GrupoOpciones12" name="GrupoOpciones12" style="background:none; border:none" checked="checked" type="radio" value="ninguno"  onClick="marcar_d(this)"> Desmarcar todos </td>
			</tr>
			</table>
		<?php break;		
	case 'clasificacion':
		?>
			<table border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="345"><input id="agrrep1" name="agrrep1"  style="background:none; border:none"  type="checkbox" value="clasificacion" checked="checked">Agrupado por clasificacion<br /><input id="agrrep2" name="agrrep2"  style="background:none; border:none"  type="checkbox" value="categoria">Agrupado por categoria</td>
				</tr>
				<tr>
					<td><table width="346" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="346" height="124"><div id="detfil" style="overflow-y:scroll;height:110px"><table  id="tblIn" border="0" cellspacing="1" cellpadding="1">
					<tr>
						<td width="32" align="center" bgcolor="#0066CC"><span class="Estilo24">ok</span></td>
						<td width="300" bgcolor="#0066CC"><span class="Estilo25">Clasificaci&oacute;n</span></td>
					</tr>
					<?php 
						$strSQl="select * from clasificacion order by idclasificacion";
							$resultado=mysql_query($strSQl,$cn);
							while($row=mysql_fetch_array($resultado)){?>
							<tr>
								<td height="20" align="left" bgcolor="#F5F5F5"><input name="chkTodos[]" id="Todos" type="checkbox" style="background:none; border:none" value="<?php echo $row[0]?>"/></td>
								<td align="left" bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row[1]?></span></td>
							</tr>
							<?php }?>
						</table>
		    </div></td>
					</tr>
				</table>
				</fieldset></td>
			</tr>
			<tr>
				<td align="center"><input id="GrupoOpciones12" name="GrupoOpciones12"  style="background:none; border:none"  type="radio" value="todos"  onClick="marcar_d(this)"> 
				Marcar todos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				     <input id="GrupoOpciones12" name="GrupoOpciones12" style="background:none; border:none" checked="checked" type="radio" value="ninguno"  onClick="marcar_d(this)"> Desmarcar todos </td>
			</tr>
			</table>
		<?php break;
		case 'filtrado2':
			$filtro=$_REQUEST['fil'];
			$filtro2=$_REQUEST['fil2'];
			$filtrado=$_REQUEST['tfil'];
			$valor=$_REQUEST['valor'];
			switch($filtro2){
				case 'categoria':$orden="order by des_cat";break;
				case 'subcategoria':$orden="order by des_subcateg";break;
			}
			$titulo=strtoupper($filtro2)."s de ".strtoupper($filtro)." ".strtoupper($filtrado);
			?>
			<table  id="tblIn" border="0" cellspacing="1" cellpadding="1">
				<tr>
					<td width="32" align="center" bgcolor="#0066CC"><span class="Estilo24">ok</span></td>
					<td width="300" bgcolor="#0066CC"><span class="Estilo25"><?php echo $titulo?></span></td>
				</tr>
			<?php 
				$strSQl="select * from $filtro2 where id$filtro='".$valor."' $orden";
				$resultado=mysql_query($strSQl,$cn);
				while($row=mysql_fetch_array($resultado)){?>
				<tr>
					<td height="20" align="center" bgcolor="#F5F5F5"><input name="chkTodos[]" id="Todos" type="checkbox" style="background:none; border:none" value="<?php echo $row[0]?>"/></td>
					<td align="center" bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row[1]?></span></td>
				</tr>
				<?php }?>
			</table>
		<?php break;
		case 'tiendas':
			$valor=$_REQUEST['valor'];
			$titulo="Tiendas";
			?>
            <table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><fieldset><br>
				<legend>Seleccione Tienda </legend>
            <table width="250px" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="125"><div style="overflow-y:scroll;height:110px">
			<table  id="tblIn" border="0" align="center" cellspacing="1" cellpadding="1">
				<tr>
					<td width="32" align="center" bgcolor="#0066CC"><span class="Estilo24">ok</span></td>
					<td width="300" bgcolor="#0066CC"><span class="Estilo25"><?php echo $titulo?></span></td>
				</tr>
			<?php 
				$strSQl="select * from tienda where cod_suc='".$valor."' order by des_tienda";
				$resultado=mysql_query($strSQl,$cn);
				while($row=mysql_fetch_array($resultado)){?>
				<tr>
					<td height="20" align="center" bgcolor="#F5F5F5"><input name="chkTienda[]" id="Tienda" type="checkbox" style="background:none; border:none" value="<?php echo $row[0]?>"/></td>
					<td bgcolor="#F5F5F5"><span class="Estilo27"><?php echo $row[2]?></span></td>
				</tr>
				<?php }?>
			</table>
            </div></td></tr></table></fieldset></td></tr></table>
<?php }?>