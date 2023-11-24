<?php include('includes/header.php'); ?>
<?php
session_start();
if (!isset($_SESSION['Rol'])) {

    header('Location: ../Login.html');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="estilos.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet" />

    <!-- Estilos de los botones -->
    <link rel="stylesheet" href="uno.css" />
    <link rel="stylesheet" href="dos.css" />
    <link rel="stylesheet" href="tres.css" />
    <title>Reportes Colima</title>
</head>

<body>
    <div class="contenedor">
        <h1>Reportes</h1>
        <div class="contenedor-botones">
            <a href="impresoras.php">
                <button class="boton uno" onclick=""> <span>Fallos de impresoras</span> </button>
            </a>
            <a href="Tecnicos.php">
                <button class="boton dos"><span>Tecnicos y redes</span></button>
            </a>
            <a href="index.php">
                <button class="boton tres"><span>Prestamo equipos</span></button>
            </a>
            <div class="icono">
            </div>
        </div>

</body>
<script>
    function mostrarFechaYHora() {
        const fechaHoraElement = document.getElementById("fechaHora");
        const fechaHora = new Date();
        const opciones = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: 'numeric',
            minute: 'numeric',
            second: 'numeric'
        };
        const fechaHoraFormateada = fechaHora.toLocaleDateString('es-ES', opciones);
        fechaHoraElement.textContent = "" + fechaHoraFormateada;
    }

    // Llama a la función para mostrar la fecha y hora actual cuando se carga la página.
    mostrarFechaYHora();

    // Actualiza la fecha y hora cada segundo (1000 milisegundos).
    setInterval(mostrarFechaYHora, 1000);
</script>

</html>
<?php include('includes/footer.php'); ?>