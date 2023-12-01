<?php
require_once('tcpdf/tcpdf.php');
require_once('db.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator('Creator');
$pdf->SetAuthor('Author');
$pdf->SetTitle('Tabla de Tecnicoyredes');
$pdf->SetSubject('Tabla de Tecnicoyredes');
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

$html = '<h1></h1>';
$html .= '<table border="1">';
$html .= '<thead><tr><th>ReporteTecnicoID</th><th>AreaReporte</th><th>NombreReportante</th><th>QueReporta</th><th>Categoria</th><th>Estatus</th><th>Observaciones</th><th>Otros</th></tr></thead>';
$html .= '<tbody>';

$query = "SELECT * FROM tecnicoyredes";
$result_tasks = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result_tasks)) {
    $html .= '<tr>';
    $html .= '<td>' . $row['ReporteTecnicoID'] . '</td>';
    $html .= '<td>' . $row['AreaReporte'] . '</td>';
    $html .= '<td>' . $row['NombreReportante'] . '</td>';
    $html .= '<td>' . $row['QueReporta'] . '</td>';
    $html .= '<td>' . $row['Categoria'] . '</td>';
    $html .= '<td class="' . (($row['Estatus'] == 1) ? 'requiere-personal-verde' : 'requiere-personal-rojo') . '">' . (($row['Estatus'] == 1) ? 'Terminado' : 'Pendiente') . '</td>';
    $html .= '<td>' . $row['Observaciones'] . '</td>';
    $html .= '<td>' . $row['Otros'] . '</td>';
    $html .= '</tr>';
}

$html .= '</tbody></table>';

$pdf->writeHTML($html, true, false, true, false, '');

$fileName = 'tabla_tecnicoyredes.pdf';
$pdf->Output($fileName, 'D');
