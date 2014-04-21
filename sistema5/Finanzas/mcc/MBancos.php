<?php
include_once("dacc/DBancos.php");
class MBancos{
	var $cta_id;
	var $fecha;
	var $fecha2;
	var $tipo;
	var $cliente;
	var $fechavcto;
	var $codigo;
	var $importe;
	var $estado;
	var $detalle;
	var $user;
	var $pc;
	public function Movimiento(){
		$dba=new DBancos();
		$dba->cta_id=$this->cta_id;
		$dba->fecha=$this->fecha;
		$dba->fecha2=$this->fecha2;
		$lista=$dba->ListarMovimiento();
		return $lista;
	}
	public function Listarsuc(){
		$dba=new DBancos();
		$lista=$dba->Listarsucursal();
		return $lista;
	}
	public function Listarban(){
		$dba=new DBancos();
		$lista=$dba->Listarbancos();
		return $lista;
	}
	public function Listarmon(){
		$dba=new DBancos();
		$lista=$dba->Listarmonedas();
		return $lista;
	}
}
?>