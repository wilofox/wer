<?php
	class Operacion{

		private $codigo;
		private $tipo;
		private $descripcion;

		public function __construct($id = ''){
			$this->codigo = $id;
			if($this->codigo != ''){

				$sql = "SELECT 
						o.codigo,
						o.tipo,
						o.descripcion
					FROM operacion o
					WHERE o.codigo = '".$id."'";

				$qry = new Consulta($sql);
				if($qry->NumeroRegistros() > 0){
					$rw = $qry->VerRegistro();
					$this->tipo 		= $rw['tipo'];
					$this->descripcion 	= $rw['descripcion'];
				}					
			}
		}

		public function __get($atributo){
			return $this->$atributo;
		}

		public function getRegistros(){
			$sql = "SELECT 
						o.codigo,
						o.tipo,
						o.descripcion
					FROM operacion o
					ORDER BY o.codigo ASC";

			$qry = new Consulta($sql);
			while( $rw = $qry->VerRegistro() ){
				$rst[] = array(
					'codigo'		=> $rw['codigo'],
					'tipo'			=> $rw['tipo'],
					'descripcion'	=> $rw['descripcion']
				);
			}
			return $rst;
		}

		public function getRegistrosXtipo($tipo){
			$sql = "SELECT 
						o.codigo,
						o.tipo,
						o.descripcion
					FROM operacion o
					WHERE o.tipo = ".$tipo."
					ORDER BY o.codigo ASC";

			$qry = new Consulta($sql);
			while( $rw = $qry->VerRegistro() ){
				$rst[] = array(
					'codigo'		=> $rw['codigo'],
					'tipo'			=> $rw['tipo'],
					'descripcion'	=> $rw['descripcion']
				);
			}
			return $rst;
		}

		public function getOperacion_Json($tipo){
			$sql = "SELECT 
						o.codigo,
						o.tipo,
						o.descripcion
					FROM operacion o
					WHERE o.tipo = ".$tipo."
					ORDER BY o.codigo ASC";

			$qry = new Consulta($sql);
			while( $rw = $qry->VerRegistro() ){
				$rst[] = array(
					'codigo'		=> $rw['codigo'],
					'tipo'			=> $rw['tipo'],
					'descripcion'	=> $rw['descripcion']
				);
			}
			$respuesta['data'] = $rst;
			$respuesta['error'] = 'ok';

			header('Content-type: text/plain');
			return json_encode($respuesta);
		}

	}
?>