<?php
	class Clientes{

		private $codcliente;
		private $tipo_aux;
		private $razonsocial;
		private $ruc;
		private $nombres;
		private $apellidos;
		private $t_persona; 	
		private $doc_iden;
		private $contacto;
		private $cargo;
		private $direccion;
		private $telefono;
		private $email;
		private $web;
		private $baja;
		private $fbaja;
		private $clas_clie;
		private $condicion;
		private $estado_percep;
		private $por_percep;

		public function __construct($id = 0){
			$this->codigo = $id;
			if($this->codigo > 0){

				$sql = "SELECT 
						codcliente,
						tipo_aux,
						razonsocial,
						ruc,
						nombres,
						apellidos,
						t_persona, 	
						doc_iden,
						contacto,
						cargo,
						direccion,
						telefono,
						email,
						web,
						baja,
						fbaja,
						clas_clie,
						condicion,
						estado_percep,
						por_percep
					FROM cliente
					WHERE codcliente =".$id." ";

				$qry = new Consulta($sql);
				if($qry->NumeroRegistros() > 0){
					$rw = $qry->VerRegistro();
					$this->codcliente 		= $rw['codcliente'];
					$this->tipo_aux			= $rw['tipo_aux'];
					$this->razonsocial		= $rw['razonsocial'];
					$this->ruc				= $rw['ruc'];
					$this->nombres			= $rw['nombres'];
					$this->apellidos		= $rw['apellidos'];
					$this->t_persona		= $rw['t_persona'];
					$this->doc_iden			= $rw['doc_iden'];
					$this->contacto			= $rw['contacto'];
					$this->cargo			= $rw['cargo'];
					$this->direccion		= $rw['direccion'];
					$this->telefono			= $rw['telefono'];
					$this->email			= $rw['email'];
					$this->web				= $rw['web'];
					$this->baja				= $rw['baja'];
					$this->fbaja			= $rw['fbaja'];
					$this->clas_clie		= $rw['clas_clie'];
					$this->condicion		= $rw['condicion'];
					$this->estado_percep	= $rw['estado_percep'];
					$this->por_percep		= $rw['por_percep'];
				}
			}
		}

		public function __get($atributo){
			return $this->$atributo;
		}

		public function getRegistros(){
			$sql = "SELECT * FROM cliente ORDER BY codcliente ASC";
			$qry = new Consulta($sql);
			while( $rw = $qry->VerRegistro() ){
				$rst[] = array(
					'codcliente'	=> $rw['codcliente'],
					'tipo_aux'	=> $rw['tipo_aux'],
					'razonsocial'	=> $rw['razonsocial'],
					'ruc'	=> $rw['ruc'],
					'nombres'	=> $rw['nombres'],
					'apellidos'	=> $rw['apellidos'],
					't_persona'	=> $rw['t_persona'],
					'doc_iden'	=> $rw['doc_iden'],
					'contacto'	=> $rw['contacto'],
					'cargo'	=> $rw['cargo'],
					'direccion'	=> $rw['direccion'],
					'telefono'	=> $rw['telefono'],
					'email'	=> $rw['email'],
					'web'	=> $rw['web'],
					'baja'	=> $rw['baja'],
					'fbaja'	=> $rw['fbaja'],
					'clas_clie'	=> $rw['clas_clie'],
					'condicion'	=> $rw['condicion'],
					'estado_percep'	=> $rw['estado_percep'],
					'por_percep'	=> $rw['por_percep']
				);
			}
			return $rst;
		}

	}
?>