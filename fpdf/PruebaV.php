<?php

require('./fpdf.php');

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      $this->Image('Ayuntamiento.jpg', 185, 5, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(45); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode('H. Ayuntamiento de colima'), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color

      /* UBICACION */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, 10, utf8_decode("Ubicación : Calle Gregorio Torres Quintero 85"), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode("Teléfono : 3123163800 "), 0, 0, '', 0);
      $this->Ln(5);

      /* COREEO */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Correo : "), 0, 0, '', 0);
      $this->Ln(5);
      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(0, 0, 0);
      $this->Cell(50); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("Reporte Prestamo "), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(0, 0, 0); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
   function TablaDatos($header, $data)
   {
      // Colores, ancho de línea y fuente en negrita
      $this->SetFillColor(0, 0, 0);
      $this->SetTextColor(255);
      $this->SetDrawColor(163, 163, 163);
      $this->SetLineWidth(.3);
      $this->SetFont('', 'B');

      // Cabecera
      foreach ($header as $col)
         $this->Cell(40, 7, $col, 1, 0, 'C', true);
      $this->Ln();

      // Datos
      $this->SetFillColor(224, 235, 255);
      $this->SetTextColor(0);
      $this->SetFont('');

      foreach ($data as $row) {
         foreach ($row as $col)
            $this->Cell(40, 6, $col, 1, 0, 'C');
         $this->Ln();
      }
   }
}

$pdf = new PDF();
$pdf->AddPage();
// Resto del código del encabezado y pie de página

$header = array('Prestamo_id', 'Receptor', 'FechaYHora', 'Catalogo', 'RequierePersonal', 'FechaDevolucion');

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "siste_reportes";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
   die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos de la tabla prestamo_equipos
$sql = "SELECT Prestamo_id, Receptor, FechaYHora, Catalogo, RequierePersonal, FechaDevolucion FROM prestamo_equipos";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
   while ($row = $result->fetch_assoc()) {
      $data[] = array(
         $row["Prestamo_id"],
         $row["Receptor"],
         $row["FechaYHora"],
         $row["Catalogo"],
         $row["RequierePersonal"],
         $row["FechaDevolucion"]
      );
   }
}

$conn->close();

$pdf->TablaDatos($header, $data);
$pdf->Output('Prueba.pdf', 'I');
