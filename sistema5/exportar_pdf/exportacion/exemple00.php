<?php
session_start();
$_SESSION['nivel_usu']="5";
    include('../conex_inicial.php');
   
	$referencia=$_REQUEST["informacion_pdf"];
	$strsql="select * from cab_mov where cod_cab='$referencia'";
    echo $strsql  . "<br>";
	
	$resultado=mysql_query($strsql,$cn);
	
	while($fila=mysql_fetch_array($resultado)){
	     echo "----->" . $fila[0];
	}
	
	$cont=mysql_num_rows($resultado);
	
	echo "------>A" . $cont . "<br>";
	$row=mysql_fetch_array($resultado);
	
    $content=$cont; 



  /*  // convert to PDF
    require_once(dirname(__FILE__).'/../html2pdf.class.php');
    try
    {
		$html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 3);
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->writeHTML($content);
		$html2pdf->Output('exemple03.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }*/
?>
