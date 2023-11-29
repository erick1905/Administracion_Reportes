<?php include("db.php"); ?>

<?php include('includes/header.php'); ?>
<?php
if (!isset($_SESSION['Rol'])) {
    header('Location: Login.html');
    exit;
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"> <!-- Si tienes un archivo CSS externo -->
    <style>
        /* Estilos personalizados para centrar la tabla y subirla hacia arriba */
        .center-table {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 63vh;
            /* Asegura que ocupa la altura completa de la ventana */
            padding-top: 1px;
            /* Ajusta el espacio superior para subir la tabla hacia arriba */
        }

        .custom-table {
            font-size: 20px;
            /* Tamaño de fuente más grande */
            width: 80%;
            /* Ancho de la tabla del 80% del c
      ontenedor */
        }

        .requiere-personal-verde {
            background-color: #4CAF50;
            /* Verde */
            color: white;
        }

        .requiere-personal-rojo {
            background-color: #f44336;
            /* Rojo */
            color: white;
        }
    </style>
</head>

<body>
    <div class="center-table">
        <table class="table table-bordered custom-table">

            <thead>
                <tr>
                    <th>Id Reporte</th>
                    <th>Nombre del reportante:</th>
                    <th>Area</th>
                    <th>Numero impresora</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Descripcion</th>
                    <th>Detalles:</th>
                    <td>
                        <!-- Botón para Generar PDF -->
                        <a href="generar_pdf.php" class="btn btn-primary">
                            Generar PDF
                        </a>
                    </td>

                </tr>

            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM impresoras";
                $result_tasks = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result_tasks)) { ?>
                    <tr>
                        <td><?php echo $row['ReporteImpresora_id']; ?></td>
                        <td><?php echo $row['Nombre_Reportante']; ?></td>
                        <td><?php echo $row['Area']; ?></td>
                        <td><?php echo $row['NumeroImpresora']; ?></td>
                        <td><?php echo $row['Fecha_Hora']; ?></td>
                        <td class="<?php echo ($row['Estado'] == 1) ? 'requiere-personal-verde' : 'requiere-personal-rojo'; ?>">
                            <?php echo ($row['Estado'] == 1) ? 'Terminado' : 'Pendiente'; ?>
                        </td>
                        <td><?php echo $row['Descripcion']; ?></td>
                        <td><?php echo $row['Detalle_Pendiente']; ?></td>
                        <td>
                            <a href="editImpresoras.php?id=<?php echo $row['ReporteImpresora_id'] ?>" class="btn btn-secondary">
                                <i class="fas fa-marker"></i> Editar
                            </a>
                            <a href="#" onclick="confirmDelete(<?php echo $row['ReporteImpresora_id']; ?>)" class="btn btn-danger">
                                <i class="far fa-trash-alt"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
<script>
    function confirmDelete(prestamoId) {
        var confirmDelete = confirm("¿Estás seguro de que deseas eliminar este prestamo?");

        if (confirmDelete) {
            // Si el usuario confirma, redirige al script de eliminación con el id del prestamo
            window.location.href = "Borrarimpresora.php?id=" + prestamoId;
        }
        // Si el usuario cancela, no hace nada
    }
</script>

</html>

<?php include('includes/footer.php'); ?>