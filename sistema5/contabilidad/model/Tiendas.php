<?php
	class Tiendas{

		private $cod_tienda;
		private $cod_suc; 	
		private $des_tienda; 	
		private $telefono; 	
		private $direccion; 	
		private $estado; 	
		private $usuario; 	
		private $reserva;

		public function __construct($id = 0){
			$this->cod_tienda = $id;
			if($this->cod_tienda > 0){

				$sql = "SELECT 
						cod_tienda,
						cod_suc,
						des_tienda,
						telefono,
						direccion,
						estado,
						usuario, 	
						reserva
					FROM tienda
					WHERE cod_tienda =".$id." ";

				$qry = new Consulta($sql);
				if($qry->NumeroRegistros() > 0){
					$rw = $qry->VerRegistro();
					$this->cod_suc 		= $rw['cod_suc'];
					$this->des_tienda	= $rw['des_tienda'];
					$this->telefono		= $rw['telefono'];
					$this->direccion	= $rw['direccion'];
					$this->estado		= $rw['estado'];
					$this->usuario		= $rw['usuario'];
					$this->reserva		= $rw['reserva'];
				}
			}
		}

		public function __get($atributo){
			return $this->$atributo;
		}

		public function getRegistros(){
			$sql = "SELECT * FROM tienda ORDER BY cod_tienda DESC";
			$qry = new Consulta($sql);
			while( $rw = $qry->VerRegistro() ){
				$rst[] = array(
					'cod_tienda'	=> $rw['cod_tienda'],
					'des_tienda'	=> $rw['des_tienda']
				);
			}
			return $rst;
		}
		
		public function getRegistrosXSucursal($id){
			$sql = "SELECT * FROM tienda WHERE cod_suc = ".$id;
			$qry = new Consulta($sql);
			while( $rw = $qry->VerRegistro() ){
				$rst[] = array(
					'cod_tienda'	=> $rw['cod_tienda'],
					'des_tienda'	=> $rw['des_tienda']
				);
			}
			return $rst;
		}

		public function getTiendas_Json($id){
			$sql = "SELECT * FROM tienda WHERE cod_suc = ".$id;
			$query = new Consulta($sql);

			while( $rw = $query->VerRegistro() ){
				$result[] = array(
					'cod_tienda'	=> $rw['cod_tienda'],
					'des_tienda'	=> $rw['des_tienda']
				);
			}
			$respuesta['data'] = $result;
			$respuesta['error'] = 'ok';

			header('Content-type: text/plain');
			return json_encode($respuesta);
		}

	}
?>