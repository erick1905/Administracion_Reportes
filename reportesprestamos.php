<?php
require_once('tcpdf/tcpdf.php');
require_once('db.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator('Creator');
$pdf->SetAuthor('Author');
$pdf->SetTitle('Tabla de Préstamos');
$pdf->SetSubject('Tabla de Préstamos');
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->AddPage();

$imageFile = 'Ayuntamiento.jpg';
$pdf->Image($imageFile, 10, 15, 40, '', 'JPG', '', 'T', false, 300);

$pdf->SetFont('helvetica', 'B', 16);
$pdf->SetXY(60, 15);
$pdf->Cell(0, 10, 'H. Ayuntamiento de Colima', 0, 1, 'R');

$pdf->SetFont('helvetica', '', 10);
$pdf->SetXY(60, 25);
$pdf->Cell(0, 10, 'Dirección: Calle Gregorio Torres Quintero 85', 0, 1, 'R');
$pdf->SetXY(60, 35);
$pdf->Cell(0, 10, 'Teléfono: 3123163844', 0, 1, 'R');
$pdf->SetXY(60, 45);
$pdf->Cell(0, 10, 'Correos:sistemas@colima.gob.mx o jose.llerenas@colima.gob.mx', 0, 1, 'R');

$html = '<h1></h1>';
$html .= '<table border="1">';
$html .= '<thead><tr><th>Prestamo_id</th><th>Dependencia</th><th>Receptor</th><th>FechaYHora</th><th>Catalogo</th><th>RequierePersonal</th><th>FechaDevolucion</th></tr></thead>';
$html .= '<tbody>';

$query = "SELECT * FROM prestamo_equipos";
$result_tasks = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result_tasks)) {
    $html .= '<tr>';
    $html .= '<td>' . $row['Prestamo_id'] . '</td>';
    $html .= '<td>' . $row['Dependencia'] . '</td>';
    $html .= '<td>' . $row['Receptor'] . '</td>';
    $html .= '<td>' . $row['FechaYHora'] . '</td>';
    $html .= '<td>' . $row['Catalogo'] . '</td>';
    $html .= '<td class="' . (($row['RequierePersonal'] == 1) ? 'requiere-personal-rojo' : 'requiere-personal-verde') . '">' . (($row['RequierePersonal'] == 1) ? 'Sí' : 'No') . '</td>';
    $html .= '<td>' . $row['FechaDevolucion'] . '</td>';
    $html .= '</tr>';
}

$html .= '</tbody></table>';

$pdf->writeHTML($html, true, false, true, false, '');

$fileName = 'tabla_prestamos.pdf';
$pdf->Output($fileName, 'D');
