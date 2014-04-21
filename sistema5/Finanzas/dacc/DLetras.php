<?php
require_once("ds/AccesoBD.php");
class DLetras{
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
	public function ListarDatosCanje(){
		$dx=new AccesoBD();
		$sql="SELECT mc.tipo as tipo, su.des_suc AS empresa, numcje AS numero,mc.estado as condicion, cl.razonsocial AS cliente, mc.fecha AS fecha, mc.tcambio AS tipcambio, mc.importe AS totalcanje, us.usuario AS usuario, mc.moneda as moneda FROM multicj mc INNER JOIN sucursal su ON su.cod_suc = mc.cod_suc INNER JOIN moneda mo ON mo.id = mc.moneda INNER JOIN usuarios us ON us.codigo = mc.user INNER JOIN cliente cl ON cl.codcliente = mc.cliente";
		//$param=array($this->multi_id);
		$dx->where('mc.multi_id', $this->multi_id);
		//$sql.="GROUP BY mc.multi_id";
		$lista=$dx->query($sql);
		return $lista;
	}
	public function ObtenerTotalLetras(){
		$dx=new AccesoBD();
		$sql="Select SUM(monto) as totalet from multi_det";
		$dx->where('multi_id', $this->multi_id);
		$lista=$dx->query($sql);
		return $lista;
	}
	public function ObtenerCondicionCanje(){
		$dx=new AccesoBD();
		$sql="Select * from condicion";
		if(isset($this->estado)){
			$dx->where('codigo', $this->estado);
		}
		$lista=$dx->query($sql);
		return $lista;
	}
	public function ObtenerMonedaCanje(){
		$dx=new AccesoBD();
		$sql="Select descripcion,simbolo from moneda";
		if(isset($this->moneda)){
			$dx->where('id', $this->moneda);
		}
		$lista=$dx->query($sql);
		return $lista;
	}
	public function ObtenerDatosCliente(){
		$dx=new AccesoBD();
		if(isset($this->cliente)){
			$dx->where('codcliente', $this->cliente);
		}
		$lista=$dx->get('cliente');
		return $lista;
	}
	public function ListarDocumentosCanje(){
		$dx=new AccesoBD();
		$sql="select ca.cod_ope as cod_docu,ca.serie as serie_docu,ca.Num_doc as num_docu, mo.simbolo as moneda, md.monto as total, ca.f_venc as fvencimiento from multi_doc md inner join cab_mov ca on ca.cod_cab=md.cab_mov inner join moneda mo on mo.id=ca.moneda where md.multi_id=? order by ca.f_venc ASC";
		$param=array($this->multi_id);
		$lista=$dx->rawQuery($sql,$param);
		return $lista;
	}
	public function ListarLetrasCanje(){
		$dx=new AccesoBD();
		$sql="SELECT md.cod_letra as cod_letra,md.letra as letra, mo.simbolo as moneda, md.monto AS importe, md.fechavcto AS fvencimiento, md.numbco AS num_banco, (SELECT descrip FROM bancos WHERE id = md.banco_id) AS banco FROM multi_det md INNER JOIN moneda mo ON mo.id = md.moneda where md.multi_id=? order by md.det_id ASC";
		$param=array($this->multi_id);
		$lista=$dx->rawQuery($sql,$param);
		return $lista;
	}
	public function ListarClientesVencimientoDias($fecha1,$fecha2,$ini,$regis,$total){
		$dx=new AccesoBD();
		//$sql="(Select cl.codcliente as codigo,cl.razonsocial as cliente, md.fechavcto as f_venc from cliente cl inner join multicj mc on mc.cliente=cl.codcliente inner join multi_det md on md.multi_id=mc.multi_id where md.saldo>0 and md.fechavcto between ? and ?) UNION (Select cl.codcliente as codigo,cl.razonsocial as cliente, cm.f_venc as f_venc from cliente cl inner join cab_mov cm on cm.cliente=cl.codcliente where cm.saldo>0 and substring(cm.f_venc,1,10) between ? and ?) order by cliente group by cliente limit ?,?";
		$where1="and mc.tipo=? ";
		$where2="and cm.tipo=? ";
		if($this->cod_suc!=""){
			$where1.="and mc.cod_suc=? ";
			$where2.="and cm.sucursal=? ";
			$t0=true;
		}
		if($this->estado!=""){
			$where1.="and mc.estado=? ";
			$where2.="and cm.condicion=? ";
			$t1=true;
		}
		if($this->moneda!=""){
			$where1.="and mc.moneda=? ";
			$where2.="and cm.moneda=? ";
			$t2=true;
		}
		if($total=='total'){
			$sql="(Select DISTINCT cl.codcliente as codigo,cl.razonsocial as rz from cliente cl inner join multicj mc on mc.cliente=cl.codcliente inner join multi_det md on md.multi_id=mc.multi_id where md.saldo>0 $where1 and md.fechavcto between ? and ?) UNION (Select DISTINCT cl.codcliente as codigo,cl.razonsocial as rz from cliente cl inner join cab_mov cm on cm.cliente=cl.codcliente where cm.saldo>0 $where2 and substring(cm.f_venc,1,10) between ? and ?) order by rz";
			if($t0 && $t1 && $t2){
				$param=array($this->tipo,$this->cod_suc,$this->estado,$this->moneda,$fecha1,$fecha2,$this->tipo,$this->cod_suc,$this->estado,$this->moneda,$fecha1,$fecha2);
			}else{
				if($t0 || $t1 || $t2){
					if($t1 && $t0){
						$param=array($this->tipo,$this->cod_suc,$this->estado,$fecha1,$fecha2,$this->tipo,$this->cod_suc,$this->estado,$fecha1,$fecha2);
					}else{
						if($t1){
							$param=array($this->tipo,$this->estado,$fecha1,$fecha2,$this->tipo,$this->estado,$fecha1,$fecha2);
						}else{
							if($t2 && $t0){
								$param=array($this->tipo,$this->cod_suc,$this->moneda,$fecha1,$fecha2,$this->tipo,$this->cod_suc,$this->moneda,$fecha1,$fecha2);
							}else{
								if($t2){
									$param=array($this->tipo,$this->moneda,$fecha1,$fecha2,$this->tipo,$this->moneda,$fecha1,$fecha2);
								}else{
									$param=array($this->tipo,$this->cod_suc,$fecha1,$fecha2,$this->tipo,$this->cod_suc,$fecha1,$fecha2);
								}
							}
						}
						
					}
				}else{
					$param=array($this->tipo,$fecha1,$fecha2,$this->tipo,$fecha1,$fecha2);
				}
			}
		}else{
			$sql="(Select DISTINCT cl.codcliente as codigo,cl.razonsocial as rz from cliente cl inner join multicj mc on mc.cliente=cl.codcliente inner join multi_det md on md.multi_id=mc.multi_id where md.saldo>0 $where1 and md.fechavcto between ? and ?) UNION (Select DISTINCT cl.codcliente as codigo,cl.razonsocial as rz from cliente cl inner join cab_mov cm on cm.cliente=cl.codcliente where cm.saldo>0 $where2 and substring(cm.f_venc,1,10) between ? and ?) order by rz limit ?,?";
			if($t0 && $t1 && $t2){
				$param=array($this->tipo,$this->cod_suc,$this->estado,$this->moneda,$fecha1,$fecha2,$this->tipo,$this->cod_suc,$this->estado,$this->moneda,$fecha1,$fecha2,$ini,$regis);
			}else{
				if($t0 || $t1 || $t2){
					if($t0 && $t1){
						$param=array($this->tipo,$this->cod_suc,$this->estado,$fecha1,$fecha2,$this->tipo,$this->cod_suc,$this->estado,$fecha1,$fecha2,$ini,$regis);
					}else{
						if($t1){
							$param=array($this->tipo,$this->estado,$fecha1,$fecha2,$this->tipo,$this->estado,$fecha1,$fecha2,$ini,$regis);
						}else{
							if($t0 && $t2){
								$param=array($this->tipo,$this->cod_suc,$this->moneda,$fecha1,$fecha2,$this->tipo,$this->cod_suc,$this->moneda,$fecha1,$fecha2,$ini,$regis);
							}else{
								if($t2){
									$param=array($this->tipo,$this->moneda,$fecha1,$fecha2,$this->tipo,$this->moneda,$fecha1,$fecha2,$ini,$regis);
								}else{
									if($t1 && $t2){
										$param=array($this->tipo,$this->estado,$this->moneda,$fecha1,$fecha2,$this->tipo,$this->estado,$this->moneda,$fecha1,$fecha2,$ini,$regis);
									}else{
										$param=array($this->tipo,$this->cod_suc,$fecha1,$fecha2,$this->tipo,$this->cod_suc,$fecha1,$fecha2,$ini,$regis);
									}
								}
							}
						}
					}
				}else{
					$param=array($this->tipo,$fecha1,$fecha2,$this->tipo,$fecha1,$fecha2,$ini,$regis);
				}
			}
		}
		//echo "<br>".$sql."<br>";
		//print_r($param);
		$lista=$dx->rawQuery($sql,$param);
		return $lista;
	}
	public function ListarDocumentosVencimiento($fecha1){
		$dx=new AccesoBD();
		//$sql="(Select cl.codcliente as codigo,cl.razonsocial as cliente, md.fechavcto as f_venc from cliente cl inner join multicj mc on mc.cliente=cl.codcliente inner join multi_det md on md.multi_id=mc.multi_id where md.saldo>0 and md.fechavcto between ? and ?) UNION (Select cl.codcliente as codigo,cl.razonsocial as cliente, cm.f_venc as f_venc from cliente cl inner join cab_mov cm on cm.cliente=cl.codcliente where cm.saldo>0 and substring(cm.f_venc,1,10) between ? and ?) order by cliente group by cliente limit ?,?";
		$sql2="where cl.codcliente=? and cm.saldo>0 and substring(cm.f_venc,1,10)=? and cm.tipo=? ";
		if($this->cod_suc!=""){
			$sql2.="and cm.sucursal=? ";
			$t0=true;
		}
		if($this->estado!=""){
			$sql2.="and cm.condicion=? ";
			$t1=true;
		}
		if($this->moneda!=""){
			$sql2.="and cm.moneda=? ";
			$t2=true;
		}
		$sql="(Select cm.cod_cab as cod, su.des_suc as sucu, cm.moneda as moneda, cm.cod_ope as cod_docu,cm.serie as serie_docu,cm.Num_doc as numero_docu,cm.saldo from cab_mov cm inner join cliente cl on cl.codcliente=cm.cliente inner join sucursal su on su.cod_suc=cm.sucursal ".$sql2.")";
		if($t0 && $t1 && $t2){
			$param=array($this->cliente,$fecha1,$this->tipo,$this->cod_suc,$this->estado,$this->moneda);
		}else{
			if($t1 && $t0){
				$param=array($this->cliente,$fecha1,$this->tipo,$this->cod_suc,$this->estado);
			}else{
				if($t1){
					$param=array($this->cliente,$fecha1,$this->tipo,$this->estado);
				}else{
					if($t2 && $t0){
						$param=array($this->cliente,$fecha1,$this->tipo,$this->cod_suc,$this->moneda);
					}else{
						if($t2){
							$param=array($this->cliente,$fecha1,$this->tipo,$this->moneda);
						}else{
							if($t1 && $t2){
								$param=array($this->cliente,$fecha1,$this->tipo,$this->estado,$this->moneda);
							}else{
								$param=array($this->cliente,$fecha1,$this->tipo,$this->cod_suc);
							}
						}
					}
				}
			}
		}
		
		//print_r($param);
		$lista=$dx->rawQuery($sql,$param);
		return $lista;
	}
	public function ListarLetrasVencimiento($fecha1){
		$dx=new AccesoBD();
		$sql2="where cl.codcliente=? and md.saldo>0 and md.fechavcto=? and mc.tipo=? ";
		if($this->cod_suc!=""){
			$sql2.="and mc.cod_suc=? ";
			$t0=true;
		}
		if($this->estado!=""){
			$sql2.="and mc.estado=? ";
			$t1=true;
		}
		if($this->moneda!=""){
			$sql2.="and mc.moneda=? ";
			$t2=true;
		}
		//$sql="(Select cl.codcliente as codigo,cl.razonsocial as cliente, md.fechavcto as f_venc from cliente cl inner join multicj mc on mc.cliente=cl.codcliente inner join multi_det md on md.multi_id=mc.multi_id where md.saldo>0 and md.fechavcto between ? and ?) UNION (Select cl.codcliente as codigo,cl.razonsocial as cliente, cm.f_venc as f_venc from cliente cl inner join cab_mov cm on cm.cliente=cl.codcliente where cm.saldo>0 and substring(cm.f_venc,1,10) between ? and ?) order by cliente group by cliente limit ?,?";
		$sql="(Select md.det_id as cod, md.moneda as moneda, su.des_suc as sucu, md.cod_letra as cod_docu, md.letra as numero_docu, md.saldo as saldo from multi_det md inner join multicj mc on mc.multi_id=md.multi_id inner join sucursal su on su.cod_suc=mc.cod_suc inner join cliente cl on cl.codcliente=mc.cliente ".$sql2.")";
		if($t0 && $t1 && $t2){
			$param=array($this->cliente,$fecha1,$this->tipo,$this->cod_suc,$this->estado,$this->moneda);
		}else{
			if($t1 && $t0){
				$param=array($this->cliente,$fecha1,$this->tipo,$this->cod_suc,$this->estado);
			}else{
				if($t1){
					$param=array($this->cliente,$fecha1,$this->tipo,$this->estado);
				}else{
					if($t2 && $t0){
						$param=array($this->cliente,$fecha1,$this->tipo,$this->cod_suc,$this->moneda);
					}else{
						if($t2){
							$param=array($this->cliente,$fecha1,$this->tipo,$this->moneda);
						}else{
							if($t1 && $t2){
								$param=array($this->cliente,$fecha1,$this->tipo,$this->estado,$this->moneda);
							}else{
								$param=array($this->cliente,$fecha1,$this->tipo,$this->cod_suc);
							}
						}
					}
				}
			}
		}
		//$param=array($this->cliente,$fecha1);
		//print_r($param);
		$lista=$dx->rawQuery($sql,$param);
		return $lista;
	}	
}
?>