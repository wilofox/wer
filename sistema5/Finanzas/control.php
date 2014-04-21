<?php
include_once('mcc/MCheques.php');
include_once('mcc/MCuentas.php');
include_once('../funciones/funciones.php');
$accion=$_REQUEST['accion'];
if(isset($_REQUEST['valor'])){
$valor=$_REQUEST['valor'];
}
if(isset($_REQUEST['ope'])){
$ope=$_REQUEST['ope'];
}
if(isset($_REQUEST['suc'])){
$suc=$_REQUEST['suc'];
}
$cue=new MCuentas();
$che=new MCheques();
switch($accion){
	case 'combo': 
		switch($ope){
			case 'cuenta':
				$cue->banco=$valor;
				$cue->sucursal=$suc;
				$lista=$cue->Listarcue();
				?>
				<select style="width:200px;" id="cmbcuenta" name="cmbcuenta" onchange="sele_form('2',this)">
					<option value="0">Seleccione Cuenta</option>
				<?php
				for($i=0;$i<count($lista);$i++){
					echo "<option value='".$lista[$i]['cta_id']."'>".$lista[$i]['ctabco']."</option>";
				}
				?>
				</select>
		<?php echo "|cuenta_det"; break;
			case 'cuenta2':
				$cue->banco="s";
				$cue->sucursal=$suc;
				$lista=$cue->Listarcue();
				?>
				<span class="Estilo114"><select style="width:200px;" id="cuenta" name="cuenta">
					<option value="T">Todas de la empresa</option>
				<?php
				for($i=0;$i<count($lista);$i++){
				?>
            <option value="<?php echo $lista[$i]['cta_id'];?>"><?php echo $lista[$i]['banco']."&nbsp;&nbsp;&nbsp;".$lista[$i]['ctabco']."&nbsp;&nbsp;&nbsp;".$lista[$i]['moneda'];?></option>
            <?php }	?>
				</select></span>
			<?php
			break;
			case 'moneda':
				$cue->cta_id=$valor;
				$lista=$cue->Listarmone();
				echo $lista[0]['simbolo']." - ".strtoupper($lista[0]['descripcion']);
				echo "<input type='hidden' name='txtmone' id='txtmone' value='".$lista[0]['id']."'>|mone";
			break;
		}
		break;
	case 'guardarchequera':
		$che->sucursal=$_REQUEST['sucu'];
		$che->banco=$_REQUEST['banc'];
		$che->cta_id=$_REQUEST['cuen'];
		$che->tipo=$_REQUEST['tipo'];
		$che->num_aut=$_REQUEST['maut'];
		$che->fecha_aut=formatofecha($_REQUEST['faut']);
		$che->num_ini=$_REQUEST['nini'];
		$che->num_fin=$_REQUEST['nfin'];
		$che->feha_vcto=formatofecha($_REQUEST['fven']);
		$che->estado="";
		$che->CrearChequera();
		break;	
	case 'cambiarestado':
		//echo $_REQUEST['id'];
		$che->cheq_id=$_REQUEST['id'];
		$che->CambiarEstado();
		break;
}
?>