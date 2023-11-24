<?php
session_start();

if (!isset($_SESSION['Rol'])) {
    header('Location: Login.html');
    exit;
} else {
    if ($_SESSION['Rol'] === 'Super') {
        header('Location: botones.php');
        exit;
    }
    if ($_SESSION['Rol'] === 'Prestamos') {
        header('Location: index.php');
        exit;
    }
    if ($_SESSION['Rol'] === 'Impresoras') {
        header('Location: impresoras.php');
        exit;
    }
    if ($_SESSION['Rol'] === 'Tecnico') {
        header('Location: Tecnicos.php');
        exit;
    }
}
