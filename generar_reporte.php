<?php
require_once('tcpdf/tcpdf.php');
require_once('db.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator('Creator');
$pdf->SetAuthor('Author');
$pdf->SetTitle('Información de Préstamo');
$pdf->SetSubject('Información de Préstamo');
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
$pdf->Cell(0, 10, 'Correos: sistemas@colima.gob.mx o jose.llerenas@colima.gob.mx', 0, 1, 'R');

$id_prestamo = $_GET['id'] ?? null;

if ($id_prestamo) {
    $query = "SELECT * FROM prestamo_equipos WHERE Prestamo_id = $id_prestamo";
    $result_tasks = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result_tasks)) {
        $receptor = $row['Receptor'];
        $fechaHora = $row['FechaYHora'];
        $dependencia = $row['Dependencia'];
        $catalogo = $row['Catalogo'];
        $fechaDevolucion = $row['FechaDevolucion'];

        $text = "\n\nMediante este documento se le entrega a $receptor el día $fechaHora perteneciente a la dependencia: $dependencia, se le entregan en préstamo: $catalogo con la fecha de devolución $fechaDevolucion.\n\n\n\n\n\n\n\n_______________Receptor\n\n\n\n\n\n______________Encargado de préstamo\n\n\n\n\n\n_______________Sello de entregado\n\n\n\n\n\n\n\n\n\n\n\n\n\n\nEl presente hace constar que $receptor tiene bajo su resguardo el equipo antes señalado. Deberá ser entregado y en las mismas condiciones en las que lo recibe.";
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Write(0, $text);
    }
}

$fileName = 'informacion_prestamo_' . $id_prestamo . '.pdf';
$pdf->Output($fileName, 'D');
?>