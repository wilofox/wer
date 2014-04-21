<?php
require_once("ds/AccesoBD.php");
class DBancos{
	var $cta_id;
	var $fecha;
	var $tipo;
	var $cliente;
	var $fechavcto;
	var $codigo;
	var $importe;
	var $estado;
	var $detalle;
	var $user;
	var $pc;
	public function ListarMovimiento(){
		$dx=new AccesoBD();
		$sql="select * from movbcos where cta_id=? and fecha=?";
		$param=array($this->cta_id,$this->fecha);
		$lista=$dx->rawQuery($sql,$param);
		if(count($lista)==0){
			$lista[0]["mov_id"]="Sin Movimiento";
		}
		return $lista;
	}
	public function Listarsucursal(){
		$dx=new AccesoBD();
		$lista = $dx->get('sucursal');
		return $lista;
	}
	public function Listarbancos(){
		$dx=new AccesoBD();
		$lista = $dx->get('bancos');
		return $lista;
	}
	public function Listarmonedas(){
		$dx=new AccesoBD();
		$lista = $dx->get('moneda');
		return $lista;
	}
}
?>