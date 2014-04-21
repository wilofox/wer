<?php
require_once("ds/AccesoBD.php");
class DSucursal{
	var $cod_suc;
	var $des_suc;
	var $ruc;
	var $telefono;
	var $direccion;
	var $descripcion;
	var $estado;
	var $percepcion;
	var $email;
	var $web;
	var $logo;
	
	public function ListarSucursal(){
		$dx=new AccesoBD();
		if(isset($this->cod_suc)){
			$dx->where('cod_suc', $this->cod_suc);
		}
		$lista = $dx->get('sucursal');
		return $lista;
	}
}
?>