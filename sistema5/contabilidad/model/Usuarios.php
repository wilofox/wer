<?php
	class Usuarios{

		private $codigo;
		private $usuario;
		private $password;
		private $f_creacion; 	
		private $caja; 	
		private $nivel; 	
		private $estado;
		private $conexiones;
		private $pc;

		public function __construct($id = 0){
			$this->codigo = $id;
			if($this->codigo > 0){

				$sql = "SELECT 
						codigo,
						usuario,
						password,
						f_creacion,
						caja,
						nivel,
						estado, 	
						conexiones,
						pc
					FROM usuarios
					WHERE codigo =".$id." ";

				$qry = new Consulta($sql);
				if($qry->NumeroRegistros() > 0){
					$rw = $qry->VerRegistro();
					$this->codigo 		= $rw['codigo'];
					$this->usuario		= $rw['usuario'];
					$this->password		= $rw['password'];
					$this->f_creacion	= $rw['f_creacion'];
					$this->caja			= $rw['caja'];
					$this->nivel		= $rw['nivel'];
					$this->estado		= $rw['estado'];
					$this->conexiones	= $rw['conexiones'];
					$this->pc			= $rw['pc'];
				}
			}
		}

		public function __get($atributo){
			return $this->$atributo;
		}

		public function getRegistros(){
			$sql = "SELECT * FROM usuarios ORDER BY codigo DESC";
			$qry = new Consulta($sql);
			while( $rw = $qry->VerRegistro() ){
				$rst[] = array(
					'codigo'	=> $rw['codigo'],
					'usuario'	=> $rw['usuario']
				);
			}
			return $rst;
		}

	}
?>