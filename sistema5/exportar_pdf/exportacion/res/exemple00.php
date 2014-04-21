<?php
$referencia=$_REQUEST["informacion_pdf"];
$strsql="select * from cab_mov where cod_cab='$referencia'";

$content=$strsql;
?>
<?php
$content.='<table width="200" border="1">
  <tr>
    <td>aaa</td>
    <td>aa</td>
    <td>aa</td>
  </tr>
  <tr>
    <td>aa</td>
    <td>aa</td>
    <td>aa</td>
  </tr>
  <tr>
    <td>aa</td>
    <td>aa</td>
    <td>aa</td>
  </tr>
</table>';
?>
<?php

echo "----->" .$content;

	/*	$fh = fopen('turbos/'.$url_tag, "w");
		fwrite($fh,$string);
		fclose($fh);*/

// convert to PDF
    require_once(dirname(__FILE__).'/../html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 3);
       // $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content);
        $html2pdf->Output('reporte.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
	
	?>