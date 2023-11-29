<?php
require_once('tcpdf/tcpdf.php');

//Crear el ticket
// Inicializar la clase TCPDF
$pdf = new TCPDF('P', 'mm', 'Letter', true, 'UTF-8');

// Agregar una página
$pdf->AddPage();

// Establecer el título
$pdf->SetTitle('Ticket de Venta');

// Crear el contenido del ticket
$html = '<h1>Ticket de Venta</h1>';
$html .= '<p>Producto: '  . '</p>';
$html .= '<p>Cantidad: '  . '</p>';
$html .= '<p>Cliente: ' . '</p>';

// Agregar el contenido al PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Salida del PDF (descarga o visualización)
$pdf->Output('ticket_venta.pdf', 'I');
