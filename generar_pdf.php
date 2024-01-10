<?php
require_once('tcpdf/tcpdf.php'); // Asegúrate de tener la ruta correcta al archivo TCPDF.php
require_once('db.php'); // Incluye el archivo que contiene la conexión a la base de datos

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator('Creator');
$pdf->SetAuthor('Author');
$pdf->SetTitle('Tabla de Impresoras');
$pdf->SetSubject('Tabla de Impresoras');
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->AddPage();

$imageFile = 'Ayuntamiento.jpg';
$pdf->Image($imageFile, 10, 10, 40, '', 'JPG', '', 'T', false, 300);

$pdf->SetFont('helvetica', 'B', 16);
$pdf->SetXY(60, 15);
$pdf->Cell(0, 10, 'H. Ayuntamiento de Colima', 0, 1, 'R');

$pdf->SetFont('helvetica', '', 10);
$pdf->SetXY(60, 25);
$pdf->Cell(0, 10, 'Dirección: Calle Gregorio Torres Quintero 85', 0, 1, 'R');
$pdf->SetXY(60, 35);
$pdf->Cell(0, 10, 'Teléfono: 3123163800', 0, 1, 'R');
$pdf->SetXY(60, 45);
$pdf->Cell(0, 10, 'Correo: ejemplo@correo.com', 0, 1, 'R');



// Contenido
$html = '<h1></h1>';
$html .= '<table border="1">';
$html .= '<thead><tr><th> Id Reporte</th><th> Nombre del reportante</th><th> Area</th><th> Numero impresora </th><th> Fecha</th><th> Estado</th><th> Descripcion</th><th> Detalles</th></tr></thead>';
$html .= '<tbody>';

$query = "SELECT * FROM impresoras";
$result_tasks = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result_tasks)) {
    $html .= '<tr>';
    $html .= '<td>' . $row['ReporteImpresora_id'] . '</td>';
    $html .= '<td>' . $row['Nombre_Reportante'] . '</td>';
    $html .= '<td>' . $row['Area'] . '</td>';
    $html .= '<td>' . $row['NumeroImpresora'] . '</td>';
    $html .= '<td>' . $row['Fecha_Hora'] . '</td>';
    $html .= '<td class="' . (($row['Estado'] == 1) ? 'requiere-personal-verde' : 'requiere-personal-rojo') . '">' . (($row['Estado'] == 1) ? 'Terminado' : 'Pendiente') . '</td>';
    $html .= '<td>' . $row['Descripcion'] . '</td>';
    $html .= '<td>' . $row['Detalle_Pendiente'] . '</td>';
    $html .= '</tr>';
}

$html .= '</tbody></table>';

// Escribir el contenido HTML en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Nombre del archivo de salida
$fileName = 'tabla_impresoras.pdf';

// Salida del PDF (descargar directamente)
$pdf->Output($fileName, 'D');
