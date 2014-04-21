<?php
	class Sucursal{

		private $cod_suc;
		private $des_suc;	
		private $ruc; 	
		private $telefono; 	
		private $direccion; 	
		private $descripcion; 	
		private $estado; 	
		private $percepcion;

		public function __construct($id = 0){
			$this->id = $id;
			if($this->id > 0){

				$sql = "SELECT 
						s.cod_suc,
						s.des_suc,
						s.ruc,
						s.telefono,
						s.direccion,
						s.descripcion,
						s.estado, 	
						s.percepcion
					FROM sucursal s
					WHERE s.cod_suc =".$id." ";

				$qry = new Consulta($sql);
				if($qry->NumeroRegistros() > 0){
					$rw = $qry->VerRegistro();
					$this->des_suc 		= $rw['des_suc'];
					$this->ruc			= $rw['ruc'];
					$this->telefono		= $rw['telefono'];
					$this->direccion	= $rw['direccion'];
					$this->descripcion	= $rw['descripcion'];
					$this->estado		= $rw['estado'];
					$this->percepcion	= $rw['percepcion'];
				}					
			}
		}

		public function __get($atributo){
			return $this->$atributo;
		}

		public function getRegistros(){
			$sql = "SELECT * FROM sucursal ORDER BY cod_suc DESC";
			$qry = new Consulta($sql);
			while( $rw = $qry->VerRegistro() ){
				$rst[] = array(
					'cod_suc'		=> $rw['cod_suc'],
					'des_suc'		=> $rw['des_suc']
				);
			}
			return $rst;
		}

	}
?>