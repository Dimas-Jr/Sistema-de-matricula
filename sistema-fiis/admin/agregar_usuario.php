<?php

session_start();

include '../db/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $correo = $_POST['correo'];
    $rol = $_POST['rol'];
    $contrasena = $_POST['contrasena'];

    if (empty($nombre_usuario) || empty($correo) || empty($rol) || empty($contrasena)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    $sql = "INSERT INTO usuarios (nombre_usuario, correo, rol, contrasena) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre_usuario, $correo, $rol, $contrasena);
    if ($stmt->execute()) {
        echo "Usuario agregado exitosamente.";
    } else {
        echo "Error al agregar usuario: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: usuarios.php"); 
    exit();
}
?>
