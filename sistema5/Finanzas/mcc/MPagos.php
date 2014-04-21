<?php
include_once("../Finanzas/dacc/DPagos.php");
class MPagos{
	var $sucursal;
	var $tienda;
	var $pagos_id;
	var $tipo;
	var $t_pago;
	var $t_modalidad;
	var $fecha;
	var $fechav;
	var $numero;
	var $monto;
	var $moneda;
	var $vuelto;
	var $moneda_v;
	var $fechap;
	var $tcambio;
	var $referencia;
	var $estado;
	var $obs;
	var $pc;
	var $cod_user;
	var $refer_letra;
	
	public function ListadoPagos($fecha1,$fecha2){
		$dp=new DPagos();
		$dp->sucursal=$this->sucursal;
		$dp->fecha1=$fecha1;
		$dp->fecha2=$fecha2;
		$dp->tienda=$this->tienda;
		$dp->t_pago=$this->t_pago;
		$dp->t_modalidad=$this->t_modalidad;
		$lista=$dp->ListarPagos();
		return $lista;
	}
	
	public function ListadoTotales($fecha1,$fecha2){
		$dp=new DPagos();
		$dp->sucursal=$this->sucursal;
		$dp->fecha1=$fecha1;
		$dp->fecha2=$fecha2;
		$dp->tienda=$this->tienda;
		$dp->t_pago=$this->t_pago;
		$dp->t_modalidad=$this->t_modalidad;
		$lista=$dp->ListarTotales();
		return $lista;
	}
	
	public function RegistrarPago(){
		$dp=new DPagos();
		$nro=$dp->NuevoPago();
		$dp->pagos_id=$nro[0]['nuevo']+1;
		$dp->tipo=$this->tipo;
		$dp->t_pago=$this->t_pago;
		$dp->fecha=$this->fecha;
		$dp->fechav=$this->fechav;
		$dp->numero=$this->numero;
		$dp->monto=$this->monto;
		$dp->moneda=$this->moneda;
		$dp->vuelto=$this->vuelto;
		$dp->monedav=$this->monedav;
		$dp->fechap=$this->fechap;
		$dp->tcambio=$this->tcambio;
		$dp->referencia=$this->referencia;
		$dp->estado=$this->estado;
		$dp->obs=$this->obs;
		$dp->pc=$this->pc;
		$dp->cod_user=$this->cod_user;
		$dp->refer_letra=$this->refer_letra;
		$dp->InsertarPagos();
	}
	public function EliminarPago(){
		$dp=new DPagos();
		$dp->pagos_id=$this->pagos_id;
		$lista1=$dp->obtener_pago();
		$dp->referencia=$lista1[0]['referencia'];
		$lista2=$dp->obtener_documento();
		$monto_pago=$lista1[0]['monto'];
		$moneda_pago=$lista1[0]['moneda'];
		$tipcambio_pago=$lista1[0]['tcambio'];
		$tipo_pago=$lista1[0]['tipo'];
		$moneda_doc=$lista2[0]['moneda'];
		$saldo_doc=$lista2[0]['saldo'];
		if($moneda_pago!=$moneda_doc){
			switch($moneda_pago){
				case '01':$montox=number_format($monto_pago,2,'.','')/number_format($tipcambio_pago,2,'.','');break;
				case '02':$montox=number_format($monto_pago,2,'.','')*number_format($tipcambio_pago,2,'.','');break;
			}
		}else{
			$montox=number_format($monto_pago,2,'.','');
		}
		switch($tipo_pago){
			case 'A':$dp->saldo_doc=number_format($saldo_doc,2,'.','')+number_format($montox,2,'.','');break;
			case 'C':$dp->saldo_doc=number_format($saldo_doc,2,'.','')-number_format($montox,2,'.','');break;
		}
		$dp->ActualizarSaldo();
		$dp->EliminarPago();
	}
}
?>