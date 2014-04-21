<?php
include_once("../Finanzas/dacc/DClientes.php");
class MClientes{
	var $codcliente;
	var $razonsocial;
	var $ruc;
	var $direccion;
	var $telefono;
	public function BuscaRuc(){
		$dcl=new DClientes();
		$dcl->ruc=$this->ruc;
		$lista=$dcl->ConsultaRuc();
		if(count($lista)>=1){
			return true;
		}else{
			return false;
		}
	}
	public function ActualizaRuc(){
		$dcl=new DClientes();
		$dcl->ruc=$this->ruc;
		$r1=$this->razonsocial;
		$rz=str_replace('amp','&',$r1);
		$dcl->razonsocial=$rz;
		$dcl->telefono=$this->telefono;
		$dcl->direccion=$this->direccion;
		$lista=$dcl->ActualizaDatosRuc();
		return $lista;
	}
}
?>