<?php
// Datos de conexión a la base de datos
$host = "localhost";
$usuario_db = "root";
$contrasena_db = "";
$nombre_db = "siste_reportes";

// Conexión a la base de datos
$conn = new mysqli($host, $usuario_db, $contrasena_db, $nombre_db);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Recuperar datos del formulario
$usuario_ingresado = $_POST["usuario"];
$contrasena_ingresada = $_POST["password"];
$contrasena_encriptada = md5($contrasena_ingresada);

// Consulta SQL para verificar las credenciales
$sql = "SELECT * FROM admin_usuarios WHERE (Usuario = '$usuario_ingresado' AND Contrasena = '$contrasena_ingresada') OR (Usuario = '$usuario_ingresado' AND Contrasena = MD5('$contrasena_ingresada'))";
$resultado = $conn->query($sql);

if ($resultado->num_rows == 1) {
    $row = $resultado->fetch_assoc();
    // Inicio de sesión exitoso
    session_start();
    $_SESSION["Rol"] = $row["Rol"]; // Establece el rol del usuario como la sesión
    header("Location: validacionrol.php"); // Redirige a la página principal
    exit();
} else {
    // Inicio de sesión fallido
    header("Location: Login.html?error=1"); // Redirige de vuelta al formulario de inicio de sesión
    exit();
}

// Cerrar la conexión a la base de datosf