<?php
include("db.php");
$title = '';
$Receptor = '';
$Fecha = '';
$Catalogo = '';
$RequierePersonal = '';
$FechaDevolucion = '';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM prestamo_equipos WHERE Prestamo_id = $id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $title = $row['Dependencia'];
    $Receptor = $row['Receptor'];
    $Fecha = $row['FechaYHora'];
    $Catalogo = $row['Catalogo'];
    $RequierePersonal = $row['RequierePersonal'];
    $FechaDevolucion = $row['FechaDevolucion'];
  }
}

if (isset($_POST['update'])) {
  $id = $_GET['id'];
  $title = $_POST['title'];
  $Receptor = $_POST['Receptor'];
  $Fecha = $_POST['Fecha'];
  $Catalogo = $_POST['Catalogo'];
  $RequierePersonal = $_POST['RequierePersonal'];
  $FechaDevolucion = $_POST['FechaDevolucion'];

  $query = "UPDATE prestamo_equipos SET Dependencia = '$title', Receptor = '$Receptor', FechaYHora = '$Fecha', Catalogo = '$Catalogo', RequierePersonal = '$RequierePersonal', FechaDevolucion = '$FechaDevolucion' WHERE Prestamo_id = $id";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Task Updated Successfully';
  $_SESSION['message_type'] = 'warning';
  header('Location: index.php');
}

?>
<?php include('includes/header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
        <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
          <div class="form-group">
            <input name="title" type="text" class="form-control" value="<?php echo $title; ?>" placeholder="Dependencia">
          </div>
          <div class="form-group">
            <input name="Receptor" type="text" class="form-control" value="<?php echo $Receptor; ?>" placeholder="Receptor">
          </div>
          <div class="form-group">
            <input name="Fecha" type="text" class="form-control" value="<?php echo $Fecha; ?>" placeholder="Fecha Y Hora">
          </div>
          <div class="form-group">
            <input name="Catalogo" type="text" class="form-control" value="<?php echo $Catalogo; ?>" placeholder="Catalogo">
          </div>
          <div class="form-group">
            <input name="RequierePersonal" type="text" class="form-control" value="<?php echo $RequierePersonal; ?>" placeholder="Requiere Personal">
          </div>
          <div class="form-group">
            <input name="FechaDevolucion" type="text" class="form-control" value="<?php echo $FechaDevolucion; ?>" placeholder="Fecha de Devolucion">
          </div>
          <button class="btn-success" name="update">
            Update
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include('includes/footer.php'); ?>