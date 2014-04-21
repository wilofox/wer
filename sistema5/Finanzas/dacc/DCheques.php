<?php
require_once("ds/AccesoBD.php");
class DCheque{
	var $cheq_id;
	var $sucursal;
	var $fecha_aut;
	var $num_aut;
	var $num_ini;
	var $num_fin;
	var $estado;
	var $cta_id;
	var $feha_vcto;
	var $fecha1;
	var $fecha2;
	var $banco;
	var $tipo;
	public function ListarChequeras(){
		$dx=new AccesoBD();
		if($this->estado!=""){
			$fe=" and c.estado=?";
			$params = array($this->banco, $this->sucursal, $this->estado, $this->fecha1, $this->fecha2);
		}else{
			$fe="";
			$params = array($this->banco, $this->sucursal, $this->fecha1, $this->fecha2);
		}
		//print_r($params);
		$sql="SELECT c.*,s.des_suc AS suc,cu.*,mo.simbolo as simbolo FROM chequera c INNER JOIN sucursal s ON s.cod_suc=c.sucursal INNER JOIN cuentas cu ON cu.cta_id=c.cta_id INNER JOIN bancos b ON b.id=cu.banco_id INNER JOIN moneda mo ON mo.id=cu.moneda where b.codigo=? and c.sucursal=?".$fe." and c.fecha_aut between ? and ? order by c.fecha_aut desc";
		//echo $sql;
		$lista = $dx->rawQuery($sql, $params);
		if(count($lista)==0){
			$lista[0]["cheq_id"]="Sin Chequeras";
			$lista[0]["estado"]="N";
		}
		return $lista;
	}
	public function InsertarChequeras(){
		$dx=new AccesoBD();
		$insertData = array('cheq_id' => $this->cheq_id,'sucursal' => $this->sucursal,'fecha_aut' => $this->fecha_aut,'num_aut' => $this->num_aut,'num_ini' => $this->num_ini,'num_fin' => $this->num_fin,'estado' => $this->estado,'cta_id' => $this->cta_id,'fecha_vcto' => $this->feha_vcto,'tipo' => $this->tipo);
		//print_r($insertData);
		$dx->insert('chequera', $insertData);
	}
	public function ModificarChequeras(){
		$dx=new AccesoBD();
		$updateData = array('sucursal' => $this->sucursal,'fecha_aut' => $this->fecha_aut,'num_aut' => $this->num_aut,'num_ini' => $this->num_ini,'num_fin' => $this->num_fin,'estado' => $this->estado,'cta_id' => $this->cta_id,'fecha_vcto' => $this->feha_vcto,'tipo' => $this->tipo);
		$dx->where('cheq_id', (int)$this->cheq_id);
		$dx->update('chequera', $updateData);
	}
	public function EliminarChequeras(){
		$dx=new AccesoBD();
		$dx->where('cheq_id', (int)$this->cheq_id);
		$dx->delete('chequera');
	}
	public function ListarTipos(){
		$dx=new AccesoBD();
		$dx->where('modalidad', 2);
		$lista = $dx->get('t_pago');
		return $lista;
	}
	public function NuevaChequera(){
		$dx=new AccesoBD();
		$lista=$dx->query('SELECT max(cheq_id) as nuevo from chequera');
		if(count($lista)>0){
			return $lista;
		}else{
			$lista[0]["nuevo"]=0;
			return $lista;
		}
	}
	public function DatosChequera(){
		$dx=new AccesoBD();
		$dx->where('cheq_id', $this->cheq_id);
		$lista = $dx->get('chequera');
		return $lista;
	}
	public function ObtenerActivas(){
		$dx=new AccesoBD();
		//echo $this->cta_id;
		$dx->where('cta_id', $this->cta_id);
		$dx->where('tipo', $this->tipo);
		$dx->where('estado', "A");
		$lista = $dx->get('chequera');
		return $lista;
	}
	public function ActualizarEstado(){
		$dx=new AccesoBD();
		$updateData = array('estado' => $this->estado);
		//echo $this->cheq_id;
		$dx->where('cheq_id', (int)$this->cheq_id);
		$dx->update('chequera', $updateData);
	}
}
?>