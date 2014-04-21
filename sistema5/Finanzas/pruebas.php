<?php
/*require_once("ds/AccesoBD.php");
$bx=new AccesoBD();
//$params = array("000001");, $params
//$bx->Query("SELECT * FROM cliente");
$bx->where('codcliente', 4);
$results = $bx->get('cliente');
//print_r($results);

//$results = $bx->rawQuery("SELECT * FROM cliente");
for($i=0;$i<count($results);$i++){
	echo $results[$i]['codcliente']."<br>";
}
//print_r($results); // contains array of returned rows

/*$sql="select * from clientes";
$tipxa=array("i");
$dato=array(1);
$lista=$bx->ejecutarConsultaP($sql,$tipxa,$dato);
print_r($lista);*/
include_once('mcc/MCheques.php');
$mc=new MCheques();
/*EJEMPLO DE INSERTAR
$mc->cta_id=1;
$mc->estado="A";
$mc->fecha_aut="2013-01-01";
$mc->feha_vcto="2013-03-30";
$mc->num_aut="12345678901234567890";
$mc->num_fin="300";
$mc->num_ini="201";
$mc->sucursal="01";
$mc->CambiarChequera();*/

/*EJEMPLO DE MODIFICAR
$mc->cheq_id=3;
$mc->cta_id=1;
$mc->estado="A";
$mc->fecha_aut="2013-01-01";
$mc->feha_vcto="2013-03-30";
$mc->num_aut="12345678901234567890";
$mc->num_fin="300";
$mc->num_ini="201";
$mc->sucursal="01";
$mc->CambiarChequera();*/

/*EJEMPLO DE ELIMINAR
$mc->cheq_id=3;
$mc->BorrarChequera();*/
$mc->cta_id=1;
$mc->sucursal="02";
$res=$mc->ListadoChequera();
print_r($res);

?>