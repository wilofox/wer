<?php
	class Producto{

		private $id;
		private $cod_prod;
		private $clasificacion;
		private $nombre;
		private $und;
		private $factor;
		private $factorCompra;

		public function __construct($id = 0){
			$this->id = $id;
			if($this->id > 0){

				$sql = "SELECT 
						p.idproducto,
						p.clasificacion,
						p.cod_prod,
						p.nombre,
						p.und,
						p.factor,
						p.factorCompra
					FROM producto p
					WHERE p.idproducto =".$id." ";

				$qry = new Consulta($sql);
				if($qry->NumeroRegistros() > 0){

					$rw = $qry->VerRegistro();
					$this->id 				= $rw['idproducto'];
					$this->cod_prod 		= $rw['cod_prod'];
					$this->clasificacion 	= $rw['clasificacion'];
					$this->nombre 			= $rw['nombre'];
					$this->und 				= $rw['und'];
					$this->factor 			= $rw['factor'];
					$this->factorCompra 	= $rw['factorCompra'];
				}					
			}
		}

		public function __get($atributo){
			return $this->$atributo;
		}

		public function getRegistros(){
			$sql = "SELECT 
						p.idproducto,
						p.cod_prod,
						p.clasificacion,
						p.nombre,
						p.und,
						p.factor,
						p.factorCompra
					FROM producto p
					ORDER BY p.idproducto ASC";

			$qry = new Consulta($sql);
			while( $rw = $qry->VerRegistro() ){
				$rst[] = array(
					'idproducto'	=> $rw['idproducto'],
					'cod_prod'		=> $rw['cod_prod'],
					'clasificacion'	=> $rw['clasificacion'],
					'nombre'		=> $rw['nombre'],
					'und'			=> $rw['und'],
					'factor'		=> $rw['factor'],
					'factorCompra'	=> $rw['factorCompra']
				);
			}
			return $rst;
		}

		public function detalle_kardex($filtro_multi, $codigo, $fecha1, $fecha2){
		
			$sql = "
				SELECT 
					c.flag_r AS flag_r,
					c.incluidoigv AS incluidoigv,
					c.serie AS serie,
					Num_doc AS Num_doc,
					c.cod_ope AS cod_ope,
					cliente AS cliente,
					fecha AS fecha,
					c.tienda AS tienda,
					c.tipo AS tipo,
					cantidad AS cantidad,
					c.cod_cab AS referencia,
					precio AS precio,
					costo_inven AS costo_inven,
					flag_kardex AS flag_kardex,
					afectoigv AS afectoigv,
					c.moneda AS moneda,
					c.tc AS tc,
					c.inafecto AS inafecto,
					d.cod_det AS cod_det,
					impto1 AS impto1,
					unidad AS unidad
				FROM 
					cab_mov c,
					det_mov d 
				WHERE 
					flag != 'A' 
					AND ".$filtro_multi." c.cod_cab = d.cod_cab 
					AND cod_prod = '".$codigo."' 
					AND date(fechad) between '".formatofecha($fecha1)."' 
					AND '".formatofecha($fecha2)."'
					AND kardex = 'S' 
					ORDER BY substring(fechad,1,10), flag_kardex, substring(fechad,12,19)";

			$qry = new Consulta($sql);
			while( $rw = $qry->VerRegistro() ){
				$rst[] = array(
					'flag_r'		=> $rw['flag_r'],
					'incluidoigv'	=> $rw['incluidoigv'],
					'serie'			=> $rw['serie'],
					'Num_doc'		=> $rw['Num_doc'],
					'cod_ope'		=> $rw['cod_ope'],
					'cliente'		=> $rw['cliente'],
					'fecha'			=> formatofecha(substr($rw['fecha'],0,10)),
					'tienda'		=> $rw['tienda'],
					'tipo'			=> $rw['tipo'],
					'cantidad'		=> $rw['cantidad'],
					'referencia'	=> $rw['referencia'],
					'precio'		=> $rw['precio'],
					'costo_inven'	=> $rw['costo_inven'],
					'flag_kardex'	=> $rw['flag_kardex'],
					'afectoigv'		=> $rw['afectoigv'],
					'moneda'		=> $rw['moneda'],
					'tc'			=> $rw['tc'],
					'inafecto'		=> $rw['inafecto'],
					'cod_det'		=> $rw['cod_det'],
					'impto1'		=> $rw['impto1'],
					'unidad'		=> $rw['unidad']
				);
			}
			return $rst;
		
		}

	}
?>