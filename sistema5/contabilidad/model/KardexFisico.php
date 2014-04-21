<?php
	class KardexFisico{

		private $id;
		
		public function __construct($id = 0){}

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