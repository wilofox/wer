
<style>
.desc{width:100%;border:1px groove red}
</style>

<?php



require_once(dirname(__FILE__).'/exportar_pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 3);
$strContent="quinto";
$html2pdf->WriteHTML($strContent);
$html2pdf->Output("sample.pdf");
echo "PDF file is generated successfully!";
?>