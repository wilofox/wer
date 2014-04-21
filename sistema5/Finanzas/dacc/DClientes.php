<?php
require_once("../Finanzas/ds/AccesoBD.php");
class DClientes{
	var $codcliente;
	var $razonsocial;
	var $ruc;
	var $telefono;
	var $direccion;
	
	public function ConsultaRuc(){
		$dx=new AccesoBD();
		$dx->where('ruc', $this->ruc);
		$lista = $dx->get('cliente');
		return $lista;
	}
	public function ActualizaDatosRuc(){
		$dx=new AccesoBD();
		$dx1=new AccesoBD();
		$dx->where('ruc', $this->ruc);
		$dx1->where('ruc', $this->ruc);
		$updateData = array('razonsocial' => $this->razonsocial,'telefono' => $this->telefono,'direccion' => $this->direccion);
		$dx->update('cliente', $updateData);
		$lista = $dx1->get('cliente');
		return $lista;
	}
}
?>