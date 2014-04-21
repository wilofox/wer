<?php
include_once("dacc/DCheques.php");
class MCheques{
	var $cheq_id;
	var $sucursal;
	var $fecha_aut;
	var $num_aut;
	var $num_ini;
	var $num_fin;
	var $estado;
	var $cta_id;
	var $feha_vcto;
	var $fecha1;
	var $fecha2;
	var $banco;
	var $tipo;
	public function ListadoChequera(){
		$dc=new DCheque();
		$dc->sucursal=$this->sucursal;
		//$dc->cta_id=$this->cta_id;
		$dc->estado=$this->estado;
		$dc->fecha1=$this->fecha1;
		$dc->fecha2=$this->fecha2;
		$dc->banco=$this->banco;
		$lista=$dc->ListarChequeras();
		return $lista;
	}
	public function CrearChequera(){
		$dc=new DCheque();
		$nro=$dc->NuevaChequera();
		$dc->cheq_id=$nro[0]['nuevo']+1;
		$dc->sucursal=$this->sucursal;
		$dc->fecha_aut=$this->fecha_aut;
		$dc->num_aut=$this->num_aut;
		$dc->num_ini=$this->num_ini;
		$dc->num_fin=$this->num_fin;
		$dc->estado=$this->estado;
		$dc->cta_id=$this->cta_id;
		$dc->tipo=$this->tipo;
		$dc->feha_vcto=$this->feha_vcto;
		$dc->InsertarChequeras();
	}
	public function CambiarChequera(){
		$dc=new DCheque();
		$dc->cheq_id=$this->cheq_id;
		$dc->sucursal=$this->sucursal;
		$dc->fecha_aut=$this->fecha_aut;
		$dc->num_aut=$this->num_aut;
		$dc->num_ini=$this->num_ini;
		$dc->num_fin=$this->num_fin;
		$dc->estado=$this->estado;
		$dc->cta_id=$this->cta_id;
		$dc->feha_vcto=$this->feha_vcto;
		$dc->ModificarChequeras();
	}
	public function Listartip(){
		$dc=new DCheque();
		$lista=$dc->ListarTipos();
		return $lista;
	}
	public function BorrarChequera(){
		$dc=new DCheque();
		$dc->cheq_id=$this->cheq_id;
		$dc->EliminarChequeras();
	}
	public function CambiarEstado(){
		$dc=new DCheque();
		$dc->cheq_id=$this->cheq_id;
		$lista=$dc->DatosChequera();
		switch($lista[0]['estado']){
			case 'A':$dc->estado="E";$dc->ActualizarEstado();break;
			case 'E':$dc->estado=" ";$dc->ActualizarEstado();break;
			default:$dc->cta_id=str_pad($lista[0]['cta_id'],6,"0",STR_PAD_LEFT);
			//$lis=$dc->ObtenerActivas();
			//print_r($lis);
			if(count($dc->ObtenerActivas())>0){
				echo ".";
			}else{
				$dc->estado="A";
				$dc->ActualizarEstado();
			}break;
		}
	}
}
?>