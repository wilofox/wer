<?php
require_once("ds/AccesoBD.php");
class DCuentas{
	var $cta_id;
	var $sucursal;
	var $banco;
	var $moneda;
	var $titular;
	var $ctabco;
	var $user;
	var $pc;
	public function ListarCuentas(){
		$dx=new AccesoBD();
		//echo
		 $sql="select c.* from cuentas c inner join bancos b on c.banco_id=b.id where b.codigo=? and c.empresa=?";
		$param=array($this->banco,$this->sucursal);
		$lista=$dx->rawQuery($sql,$param);
		return $lista;
	}
	public function ListarCuentas2(){
		$dx=new AccesoBD();
		$sql="select c.*,b.descrip as banco,mo.simbolo as moneda from cuentas c inner join moneda mo on mo.id=c.moneda inner join bancos b on c.banco_id=b.id";
		//$param=array($this->banco,$this->sucursal);
		$lista=$dx->query($sql);
		return $lista;
	}
	public function ListarCuentas3(){
		$dx=new AccesoBD();
		$sql="select c.*,b.descrip as banco,mo.simbolo as moneda from cuentas c inner join moneda mo on mo.id=c.moneda inner join bancos b on c.banco_id=b.id where c.empresa=?";
		$param=array($this->sucursal);
		$lista=$dx->rawQuery($sql,$param);
		return $lista;
	}
	public function ListarMoneda(){
		$dx=new AccesoBD();
		$sql="select mo.* from moneda mo inner join cuentas cu on cu.moneda=mo.id where cu.cta_id=?";
		$param=array($this->cta_id);
		$lista=$dx->rawQuery($sql,$param);
		return $lista;
	}
}
?>