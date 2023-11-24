<?php
include("db.php");

$Nombre_Reportante = '';
$Area = '';
$NumeroImpresora = '';
$Fecha_Hora = '';
$Descripcion = '';
$Estado = '';
$Detalle_Pendiente = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM impresoras WHERE ReporteImpresora_id=$id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $Nombre_Reportante = $row['Nombre_Reportante'];
        $Area = $row['Area'];
        $NumeroImpresora = $row['NumeroImpresora'];
        $Fecha_Hora = $row['Fecha_Hora'];
        $Descripcion = $row['Descripcion'];
        $Estado = $row['Estado'];
        $Detalle_Pendiente = $row['Detalle_Pendiente'];
    }
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $Nombre_Reportante = $_POST['Nombre_Reportante'];
    $Area = $_POST['Area'];
    $NumeroImpresora = $_POST['NumeroImpresora'];
    $Fecha_Hora = $_POST['Fecha_Hora'];
    $Descripcion = $_POST['Descripcion'];
    $Estado = $_POST['Estado'];
    $Detalle_Pendiente = $_POST['Detalle_Pendiente'];

    $query = "UPDATE impresoras SET Nombre_Reportante = '$Nombre_Reportante', Area = '$Area', NumeroImpresora = '$NumeroImpresora', Fecha_Hora = '$Fecha_Hora', Descripcion = '$Descripcion', Estado = '$Estado', Detalle_Pendiente = '$Detalle_Pendiente' WHERE ReporteImpresora_id =$id";

    mysqli_query($conn, $query);
    $_SESSION['message'] = 'Task Updated Successfully';
    $_SESSION['message_type'] = 'warning';
    header('Location: impresoras.php');
}
?>
<?php include('includes/header.php'); ?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="form-group">
                        <input name="Nombre_Reportante" type="text" class="form-control" value="<?php echo $Nombre_Reportante; ?>" placeholder="Nombre Reportante">
                    </div>
                    <div class="form-group">
                        <input name="Area" type="text" class="form-control" value="<?php echo $Area; ?>" placeholder="Área">
                    </div>
                    <div class="form-group">
                        <input name="NumeroImpresora" type="text" class="form-control" value="<?php echo $NumeroImpresora; ?>" placeholder="Número de Impresora">
                    </div>
                    <div class="form-group">
                        <input name="Fecha_Hora" type="text" class="form-control" value="<?php echo $Fecha_Hora; ?>" placeholder="Fecha y Hora">
                    </div>
                    <div class="form-group">
                        <input name="Descripcion" type="text" class="form-control" value="<?php echo $Descripcion; ?>" placeholder="Descripción">
                    </div>
                    <div class="form-group">
                        <input name="Estado" type="text" class="form-control" value="<?php echo $Estado; ?>" placeholder="Estado">
                    </div>
                    <div class="form-group">
                        <input name="Detalle_Pendiente" type="text" class="form-control" value="<?php echo $Detalle_Pendiente; ?>" placeholder="Detalle Pendiente">
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