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
                    <th>Área</th>
                    <th>Nombre del reportante</th>
                    <th>Qué reporta</th>
                    <th>Categoría</th>
                    <th>Estatus</th>
                    <th>Observaciones</th>
                    <th>Otros</th>
                    <td>
                        <!-- Botón para Generar PDF -->
                        <a href="reporteimpresoras.php" class="btn btn-primary">
                            Generar PDF
                        </a>
                    </td>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM tecnicoyredes";
                $result_tasks = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result_tasks)) { ?>
                    <tr>
                        <td><?php echo $row['ReporteTecnicoID']; ?></td>
                        <td><?php echo $row['AreaReporte']; ?></td>
                        <td><?php echo $row['NombreReportante']; ?></td>
                        <td><?php echo $row['QueReporta']; ?></td>
                        <td><?php echo $row['Categoria']; ?></td>
                        <td class="<?php echo ($row['Estatus'] == 1) ? 'requiere-personal-verde' : 'requiere-personal-rojo'; ?>">
                            <?php echo ($row['Estatus'] == 1) ? 'Terminado' : 'Pendiente'; ?>
                        </td>
                        <td><?php echo $row['Observaciones']; ?></td>
                        <td><?php echo $row['Otros']; ?></td>
                        <td>
                            <a href="editTecnicos.php?id=<?php echo $row['ReporteTecnicoID'] ?>" class="btn btn-secondary">
                                <i class="fas fa-marker"></i> Editar
                            </a>
                            <a href="#" onclick="confirmDelete(<?php echo $row['ReporteTecnicoID']; ?>)" class="btn btn-danger">
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
            window.location.href = "BorrarTecnico.php?id=" + prestamoId;
        }
        // Si el usuario cancela, no hace nada
    }
</script>

</html>

<?php include('includes/footer.php'); ?>