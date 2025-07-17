<?php
session_start();
include_once("libreria/config.php");

// Validación básica
if (isset($_POST['usuario']) && isset($_POST['clave'])) {
    $user = $_POST['usuario'];
    $pass = md5($_POST['clave']); // Asegúrate que en la BD esté cifrada con md5

    $conexion = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$conexion) {
        die("Error al conectar con la base de datos.");
    }

    $sql = "SELECT id, user, rol FROM personas WHERE user='$user' AND passwd='$pass' LIMIT 1";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) == 1) {
        $datos = mysqli_fetch_assoc($resultado);
        $_SESSION['userid'] = $datos['id'];
        $_SESSION['username'] = $datos['user'];
        $_SESSION['rol'] = $datos['rol'];

        header("Location: index.php");
        exit();
    } else {
        header("Location: login.php?error=1");
        exit();
    }
} else {
    header("Location: login.php?error=1");
    exit();
}
