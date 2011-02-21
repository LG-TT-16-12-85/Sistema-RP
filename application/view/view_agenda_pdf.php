<?php
require('fpdf_html.php');
$pdf=new PDF_HTML();
$titulo_fecha_actual = "Próximas visitas al Campus Monterrey.";
$pdf->PutHeader($titulo_fecha_actual, $fecha_actual);
$pdf->AddPage();
$pdf->SetFont('Arial', '', 9);
if(!$sin_datos){
    $pdf->WriteHTML('<p align="texto">PDF</p>');
}else{
    $pdf->WriteHTML('<p align="texto">'.$sin_datos.'</p>');
}
$pdf->Output();
?>