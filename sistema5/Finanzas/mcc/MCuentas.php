<?php
include_once("dacc/DCuentas.php");
class MCuentas{
	var $cta_id;
	var $sucursal;
	var $banco;
	var $moneda;
	var $titular;
	var $ctabco;
	var $user;
	var $pc;
	public function Listarcue(){
		$dcu=new DCuentas();
		$dcu->banco=$this->banco;
		$dcu->sucursal=$this->sucursal;
		if($this->banco=="s" && $this->sucursal=="s"){
			$lista=$dcu->ListarCuentas2();
		}else{
			if($this->banco=="s"){
				$lista=$dcu->ListarCuentas3();
			}else{
				$lista=$dcu->ListarCuentas();
			}
		}
		return $lista;
	}
	public function Listarmone(){
		$dcu=new DCuentas();
		$dcu->cta_id=$this->cta_id;
		$lista=$dcu->ListarMoneda();
		return $lista;
	}
}
?>