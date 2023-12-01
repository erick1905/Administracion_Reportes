<?php
include("db.php");

$AreaReporte = '';
$NombreReportante = '';
$QueReporta = '';
$Categoria = '';
$Estatus = '';
$Observaciones = '';
$Otros = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM tecnicoyredes WHERE ReporteTecnicoID = $id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $AreaReporte = $row['AreaReporte'];
        $NombreReportante = $row['NombreReportante'];
        $QueReporta = $row['QueReporta'];
        $Categoria = $row['Categoria'];
        $Estatus = $row['Estatus'];
        $Observaciones = $row['Observaciones'];
        $Otros = $row['Otros'];
    }
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $AreaReporte = $_POST['AreaReporte'];
    $NombreReportante = $_POST['NombreReportante'];
    $QueReporta = $_POST['QueReporta'];
    $Categoria = $_POST['Categoria'];
    $Estatus = $_POST['Estatus'];
    $Observaciones = $_POST['Observaciones'];
    $Otros = $_POST['Otros'];

    $query = "UPDATE tecnicoyredes SET AreaReporte = '$AreaReporte', NombreReportante = '$NombreReportante', QueReporta = '$QueReporta', Categoria = '$Categoria', Estatus = '$Estatus', Observaciones = '$Observaciones', Otros = '$Otros' WHERE ReporteTecnicoID = $id";
    mysqli_query($conn, $query);
    $_SESSION['message'] = 'Task Updated Successfully';
    $_SESSION['message_type'] = 'warning';
    header('Location: Tecnicos.php');
}
?>

<?php include('includes/header.php'); ?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="editTecnicos.php?id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="form-group">
                        <input name="AreaReporte" type="text" class="form-control" value="<?php echo $AreaReporte; ?>" placeholder="Area de Reporte">
                    </div>
                    <div class="form-group">
                        <input name="NombreReportante" type="text" class="form-control" value="<?php echo $NombreReportante; ?>" placeholder="Nombre del Reportante">
                    </div>
                    <div class="form-group">
                        <input name="QueReporta" type="text" class="form-control" value="<?php echo $QueReporta; ?>" placeholder="Qué Reporta">
                    </div>
                    <div class="form-group">
                        <input name="Categoria" type="text" class="form-control" value="<?php echo $Categoria; ?>" placeholder="Categoría">
                    </div>
                    <div class="form-group">
                        <input name="Estatus" type="text" class="form-control" value="<?php echo $Estatus; ?>" placeholder="Estatus">
                    </div>
                    <div class="form-group">
                        <input name="Observaciones" type="text" class="form-control" value="<?php echo $Observaciones; ?>" placeholder="Observaciones">
                    </div>
                    <div class="form-group">
                        <input name="Otros" type="text" class="form-control" value="<?php echo $Otros; ?>" placeholder="Otros">
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