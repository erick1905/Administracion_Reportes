<?php
include("db.php");
$title = '';
$Receptor = '';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM prestamo_equipos WHERE Prestamo_id=$id";
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

  $query = "UPDATE prestamo_equipos set Dependencia = '$title', Receptor = '$Receptor' WHERE Prestamo_id =$id";
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
            <input name="title" type="text" class="form-control" value="<?php echo $title; ?>" placeholder="Update Title">
          </div>
          <div class="form-group">
            <input name="Receptor" type="text" class="form-control" value="<?php echo $Receptor; ?>" placeholder="Update Title">
          </div>
          <div class="form-group">
            <input name="Fecha" type="text" class="form-control" value="<?php echo $Fecha; ?>" placeholder="Update Title">
          </div>
          <div class="form-group">
            <input name="Catalogo" type="text" class="form-control" value="<?php echo $Catalogo; ?>" placeholder="Update Title">
          </div>
          <div class="form-group">
            <input name="RequierePersonal" type="text" class="form-control" value="<?php echo $RequierePersonal; ?>" placeholder="Update Title">
          </div>
          <div class="form-group">
            <input name="FechaDevolucion" type="text" class="form-control" value="<?php echo $FechaDevolucion; ?>" placeholder="Update Title">
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