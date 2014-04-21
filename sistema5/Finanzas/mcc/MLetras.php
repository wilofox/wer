<?php
include_once("dacc/DLetras.php");
class MLetras{
	var $multi_id;
	var $cod_suc;
	var $tipo;
	var $fecha;
	var $numcje;
	var $cliente;
	var $codvendedor;
	var $moneda;
	var $tcambio;
	var $importe;
	var $canlet;
	var $estado;
	var $notas;
	var $banco_id;
	var $user;
	var $pc;
	var $iden;
	var $archivo;
	var $det_id;
	var $cod_letra;
	var $monto;
	var $letra;
	var $saldo;
	var $dias;
	var $fechavcto;
	var $user_anul;
	var $fechaanul;
	var $numbco;
	var $cab_mov;
	
	public function MostrarDatosCanje(){
		$dle=new DLetras();
		$dle->multi_id=$this->multi_id;
		$lista=$dle->ListarDatosCanje();
		return $lista;
	}
	public function MostrarTotalLetras(){
		$dle=new DLetras();
		$dle->multi_id=$this->multi_id;
		$lista=$dle->ObtenerTotalLetras();
		return $lista;
	}
	public function MostrarDocumentosCanje(){
		$dle=new DLetras();
		$dle->multi_id=$this->multi_id;
		$lista=$dle->ListarDocumentosCanje();
		return $lista;
	}
	public function MostrarLetrasCanje(){
		$dle=new DLetras();
		$dle->multi_id=$this->multi_id;
		$lista=$dle->ListarLetrasCanje();
		return $lista;
	}
	public function MostrarCondicion(){
		$dle=new DLetras();
		if(isset($this->estado)){
			$dle->estado=$this->estado;
		}
		$lista=$dle->ObtenerCondicionCanje();
		return $lista;
	}
	public function MostrarMoneda(){
		$dle=new DLetras();
		if(isset($this->moneda)){
			$dle->moneda=$this->moneda;
		}
		$lista=$dle->ObtenerMonedaCanje();
		return $lista;
	}
	public function MostrarDatosCliente(){
		$dle=new DLetras();
		if(isset($this->cliente)){
			$dle->cliente=$this->cliente;
		}
		$lista=$dle->ObtenerDatosCliente();
		return $lista;
	}
	public function MostrarClientesVencimiento($fecha1,$fecha2,$pag,$reg){
		$dle=new DLetras();
		$dle->tipo=$this->tipo;
		if($this->cod_suc!="T"){
			$dle->cod_suc=$this->cod_suc;
		}
		if($this->estado!="T"){
			$dle->estado=$this->estado;
		}
		if($this->moneda!="T"){
			$dle->moneda=$this->moneda;
		}
		$registros=number_format($reg,0,'.','');
		$con="";
		if($pag=='total'){
			$con='total';
			$pagx=number_format(0,0,'.','');
		}else{
			if($pag=='excel'){
				$pagx=0;
			}else{
			$pagx=number_format($pag,0,'.','');
			}
		}
		//echo "<br>".$pag."<br>";
		
		if($pagx==0){
			$pagx=1;
		}else{
			$pagx=$pag;
		}
		$ini=number_format($pagx,0,'.','')-1;
		//echo $ini."<br>";
		$inicio=$ini*$registros;
		//echo $inicio."<br>".$registros."<br>";
		if($pag!='excel'){
		$lista=$dle->ListarClientesVencimientoDias($fecha1,$fecha2,$inicio,$registros,$con);
		}else{
			$lista=$dle->ListarClientesVencimientoDias($fecha1,$fecha2,0,10000000,$con);
		}
		//$lista2=$dle->ListarClientesVencimientoDias($fecha1,$fecha2,0,$registros);
		return $lista;
	}
	public function MostrarDocumentosVencimiento($fecha1){
		$dle=new DLetras();
		$dle->cliente=$this->cliente;
		$dle->tipo=$this->tipo;
		if($this->cod_suc!="T"){
			$dle->cod_suc=$this->cod_suc;
		}
		if($this->estado!="T"){
			$dle->estado=$this->estado;
		}
		if($this->moneda!="T"){
			$dle->moneda=$this->moneda;
		}
		$lista=$dle->ListarDocumentosVencimiento($fecha1);
		return $lista;
	}
	public function MostrarLetrasVencimiento($fecha1){
		$dle=new DLetras();
		$dle->cliente=$this->cliente;
		$dle->tipo=$this->tipo;
		if($this->cod_suc!="T"){
			$dle->cod_suc=$this->cod_suc;
		}
		if($this->estado!="T"){
			$dle->estado=$this->estado;
		}
		if($this->moneda!="T"){
			$dle->moneda=$this->moneda;
		}
		$lista=$dle->ListarLetrasVencimiento($fecha1);
		return $lista;
	}
}
?>