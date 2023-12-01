<?php
include("db.php");
include('includes/header.php');
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
          <th>Id préstamo</th>
          <th>Dependencia</th>
          <th>Receptor</th>
          <th>Fecha</th>
          <th>Producto</th>
          <th>Requiere personal</th>
          <th>Fecha devolución</th>
          <td>
            <!-- Botón para Generar PDF -->
            <a href="reportesprestamos.php" class="btn btn-primary">
              Generar PDF
            </a>
          </td>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = "SELECT * FROM prestamo_equipos";
        $result_tasks = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <tr>
            <td><?php echo $row['Prestamo_id']; ?></td>
            <td><?php echo $row['Dependencia']; ?></td>
            <td><?php echo $row['Receptor']; ?></td>
            <td><?php echo $row['FechaYHora']; ?></td>
            <td><?php echo $row['Catalogo']; ?></td>
            <td class="<?php echo ($row['RequierePersonal'] == 1) ? 'requiere-personal-rojo' : 'requiere-personal-verde'; ?>">
              <?php echo ($row['RequierePersonal'] == 1) ? 'Sí' : 'No'; ?>
            </td>

            <td><?php echo $row['FechaDevolucion']; ?></td>
            <td>
              <a href="edit.php?id=<?php echo $row['Prestamo_id'] ?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i> Editar
              </a>
              <a href="#" onclick="confirmDelete(<?php echo $row['Prestamo_id']; ?>)" class="btn btn-danger">
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
      window.location.href = "delete_task.php?id=" + prestamoId;
    }
    // Si el usuario cancela, no hace nada
  }
</script>

</html>

<?php include('includes/footer.php'); ?>